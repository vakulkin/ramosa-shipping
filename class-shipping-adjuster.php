<?php

class ShippingAdjuster
{
    private $shipping_pricing_manager;
    private $unit_converter;
    private $cart_analyzer;
    private $rate_id_to_key = [];

    public function __construct()
    {
        $this->shipping_pricing_manager = new ShippingPricingManager();
        $this->unit_converter = new UnitConverter();
        $this->cart_analyzer = new CartAnalyzer($this->unit_converter);

        // Hook into WooCommerce package rates to adjust shipping costs
        add_filter('woocommerce_package_rates', array( $this, 'mapping_rate_id_to_key' ), 10, 2);
        add_filter('woocommerce_package_rates', array( $this, 'adjust_shipping_rates' ), 20, 2);
        add_action('woocommerce_checkout_update_order_review', [ $this, 'reset_shipping_cache' ]);

        // Filter payment gateways based on shipping method
        add_filter('woocommerce_available_payment_gateways', array( $this, 'filter_payment_gateways' ));

        // Enqueue shipping styles
        add_action('wp_enqueue_scripts', array( $this, 'enqueue_ramosa_shipping_styles' ));

        // Validate cart items before calculate totals
        add_action('woocommerce_before_calculate_totals', array( $this, 'validate_cart_items' ));

        add_filter('woocommerce_cart_needs_shipping', array( $this, 'disable_shipping_calculation' ));
    }

    public function disable_shipping_calculation($needs_shipping)
    {
        if (is_cart()) {
            return false;
        }
        return $needs_shipping;
    }

    public function reset_shipping_cache()
    {
        if (! function_exists('WC') || ! WC()->cart || ! WC()->session) {
            return;
        }

        $packages = WC()->cart->get_shipping_packages();
        foreach ($packages as $key => $value) {
            $sessionKey = "shipping_for_package_$key";
            WC()->session->set($sessionKey, null);
        }
    }

    public function enqueue_ramosa_shipping_styles()
    {
        if (is_cart() || is_checkout()) {
            wp_enqueue_style('ramosa-shipping-styles', plugin_dir_url(__FILE__) . 'ramosa-shipping.css');
        }
    }

    public function validate_cart_items($cart)
    {
        foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
            $product = $cart_item['data'];
            if (! $this->is_product_valid($product)) {
                $cart->remove_cart_item($cart_item_key);
                // wc_add_notice( sprintf( 'Product "%s" has been removed from your cart because it is missing weight and at least 2 dimensions.', $product->get_name() ), 'error' );
            }
        }
    }

    private function is_product_valid($product)
    {
        $weight = $product->get_weight();
        $length = $product->get_length();
        $width = $product->get_width();
        $height = $product->get_height();

        $dimensions_count = 0;
        if (! empty($length)) {
            $dimensions_count++;
        }
        if (! empty($width)) {
            $dimensions_count++;
        }
        if (! empty($height)) {
            $dimensions_count++;
        }

        return ! (empty($weight) && $dimensions_count < 2);
    }

    public function mapping_rate_id_to_key($rates, $package)
    {
        // This method is called by a hook to build the mapping
        foreach ($rates as $rate_key => $rate) {
            $this->rate_id_to_key[ $rate->id ] = $rate->label;
        }
        return $rates;
    }

    public function get_pricing_key_by_method_id($method_id)
    {
        return $this->rate_id_to_key[ $method_id ] ?? null;
    }

    public function get_pricing_data_for_method($rate_id)
    {
        $key = $this->rate_id_to_key[ $rate_id ] ?? null;
        return $this->shipping_pricing_manager->get_method_by_pricing_key($key);
    }

    public function filter_payment_gateways($gateways)
    {
        if (! function_exists('WC') || ! WC()->session) {
            return $gateways;
        }

        $chosen_methods = WC()->session->get('chosen_shipping_methods');
        if (! $chosen_methods || ! isset($chosen_methods[0])) {
            return $gateways;
        }

        $chosen_method_id = $chosen_methods[0];
        $pricing_key = $this->get_pricing_key_by_method_id($chosen_method_id);

        if (! $pricing_key) {
            return $gateways;
        }

        $method = $this->shipping_pricing_manager->get_method_by_pricing_key($pricing_key);

        return $this->get_filtered_gateways($gateways, $method);
    }

    private function get_filtered_gateways($gateways, $method)
    {
        if ($method && $method->cod) {
            // For COD shipping, keep only COD payment
            $allowed_gateways = [ 'cod' ];
            foreach ($gateways as $id => $gateway) {
                if (! in_array($id, $allowed_gateways)) {
                    unset($gateways[ $id ]);
                }
            }
        } else {
            // For non-COD shipping, remove COD payment
            unset($gateways['cod']);
        }

        return $gateways;
    }

    public function adjust_shipping_rates($rates, $package)
    {
        // Check if this is a sample-only order
        $is_sample_order = $this->is_sample_order();

        // Then, adjust based on weight for remaining rates
        $total_weight = $this->cart_analyzer->calculate_total_weight($package);
        $total_value = $this->cart_analyzer->calculate_total_value($package);

        foreach ($rates as $rate_key => $rate) {
            $pricing_data = $this->get_pricing_data_for_method($rate->id);
            if ($pricing_data === null) {
                unset($rates[ $rate_key ]);
                continue;
            }

            // Process shipping options based on categories
            $found = $this->process_shipping_options($pricing_data, $package);
            if (! $found) {
                unset($rates[ $rate_key ]);
                continue;
            }

            // Apply pricing based on order type
            if ($is_sample_order) {
                $this->apply_sample_pricing($rates, $rate_key, $pricing_data);
            } else {
                $this->apply_regular_pricing($rates, $rate_key, $rate, $pricing_data, $package, $total_weight, $total_value);
            }
        }

        return $rates;
    }

    private function is_sample_order()
    {
        if (class_exists('Sample_Products_Ordering')) {
            $sample_plugin = Sample_Products_Ordering::instance();
            $composition = $sample_plugin->get_cart_composition();
            return $composition['has_samples'] && ! $composition['has_regular'];
        }
        return false;
    }

    private function process_shipping_options(&$pricing_data, $package)
    {
        if (is_array($pricing_data->ranges) && count($pricing_data->ranges) > 0) {
            foreach ($pricing_data->ranges as $option) {
                $matches = empty($option->categories);
                if (! $matches && $option->categories) {
                    foreach ($option->categories as $category_slug) {
                        if ($this->cart_analyzer->cart_has_category($package, $category_slug)) {
                            $matches = true;
                            break;
                        }
                    }
                }
                if ($matches) {
                    // Convert tiers to array format for compatibility
                    $pricing_data->ranges = array_map(function ($tier) {
                        return [ $tier->min_weight, $tier->max_weight, $tier->cost ];
                    }, $option->tiers);
                    return true;
                }
            }
        }
        return false;
    }

    private function apply_sample_pricing(&$rates, $rate_key, $pricing_data)
    {
        if ($pricing_data->sample_price !== null) {
            $rates[ $rate_key ]->cost = $pricing_data->sample_price;
        } else {
            unset($rates[ $rate_key ]);
        }
    }

    private function apply_regular_pricing(&$rates, $rate_key, $rate, $pricing_data, $package, $total_weight, $total_value)
    {
        // Hide sample-only methods
        if ($pricing_data->sample_only) {
            unset($rates[ $rate_key ]);
            return;
        }
        // Check if the rate should be hidden based on weight, value, or dimensions
        if ($this->shipping_pricing_manager->should_hide_rate($package, $total_weight, $total_value, $pricing_data, $this->unit_converter)) {
            unset($rates[ $rate_key ]);
            return;
        }

        // Apply weight-based adjustments
        $weight_ranges = $pricing_data->ranges;
        $new_cost = $this->shipping_pricing_manager->calculate_cost($total_weight, $weight_ranges);
        if ($new_cost !== null) {
            $rates[ $rate_key ]->cost = $new_cost;
            $rates[ $rate_key ]->label = $rate->label . ' - ' . $total_weight . ' kg';
        }
    }
}
