<?php

class CartAnalyzer
{
    private $unit_converter;

    public function __construct($unit_converter)
    {
        $this->unit_converter = $unit_converter;
    }

    public function calculate_total_weight($package)
    {
        $total_weight = 0;
        foreach ($package['contents'] as $item) {
            $product = $item['data'];
            $weight = $product->get_weight();
            if ($weight) {
                // Convert to kg
                $weight_in_kg = $this->unit_converter->convert_weight_to_kg($weight);
                $total_weight += $weight_in_kg * $item['quantity'];
            }
        }
        return $total_weight;
    }

    public function calculate_total_value($package)
    {
        $total_value = 0;
        foreach ($package['contents'] as $item) {
            $total_value += $item['line_total'] + $item['line_tax'];
        }
        return $total_value;
    }

    public function cart_has_category($package, $category_slug)
    {
        foreach ($package['contents'] as $item) {
            $product = $item['data'];
            if ($this->product_in_category($product, $category_slug)) {
                return true;
            }
        }
        return false;
    }

    private function product_in_category($product, $category_slug)
    {
        $categories = $product->get_category_ids();
        foreach ($categories as $cat_id) {
            $cat = get_term($cat_id, 'product_cat');
            if ($cat && ($cat->slug === $category_slug || $this->is_wpml_translation_of($cat, $category_slug))) {
                return true;
            }
        }
        return false;
    }

    private function is_wpml_translation_of($cat, $original_slug)
    {
        // Check if WPML is active
        if (! function_exists('icl_object_id')) {
            return false;
        }
        // Get the original term ID
        $original_id = icl_object_id($cat->term_id, 'product_cat', false, 'pl'); // assuming Polish is default
        if ($original_id) {
            $original_cat = get_term($original_id, 'product_cat');
            if ($original_cat && $original_cat->slug === $original_slug) {
                return true;
            }
        }
        return false;
    }
}
