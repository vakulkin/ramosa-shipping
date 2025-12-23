<?php
/**
 * Plugin Name: Ramosa Shipping Adjustment
 * Description: Adjusts delivery price based on the total weight of products in the cart.
 * Version: 1.0
 */

require_once plugin_dir_path( __FILE__ ) . 'class-shipping-method.php';
require_once plugin_dir_path( __FILE__ ) . 'class-shipping-pricing-manager.php';
require_once plugin_dir_path( __FILE__ ) . 'class-unit-converter.php';
require_once plugin_dir_path( __FILE__ ) . 'class-cart-analyzer.php';
require_once plugin_dir_path( __FILE__ ) . 'class-shipping-adjuster.php';

// Initialize the plugin
new ShippingAdjuster();

