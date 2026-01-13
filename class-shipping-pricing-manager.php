<?php

require_once 'class-pricing-tier.php';
require_once 'class-shipping-option.php';

class ShippingPricingManager {
	private $pricing_ranges;

	public function __construct() {
		$this->initialize_pricing_ranges();
	}

	private function initialize_pricing_ranges() {
		$this->pricing_ranges = [
			'Przesyłka paletowa Geodis' => new ShippingMethod(
				[
					new ShippingOption(
						[],
						[
							new PricingTier( 0, 100, 150 ),
							new PricingTier( 100, 200, 160 ),
							new PricingTier( 200, 300, 180 ),
							new PricingTier( 300, 400, 205 ),
							new PricingTier( 400, 500, 215 ),
							new PricingTier( 500, 700, 225 ),
							new PricingTier( 900, 1000, 245 ),
							new PricingTier( 1000, 1100, 265 ),
							new PricingTier( 1100, 1250, 305 ),
							new PricingTier( 1250, 1450, 355 ),
							new PricingTier( 1450, 1650, 455 ),
							new PricingTier( 1650, 2000, 585 ),
							new PricingTier( 2000, 3000, 705 ),
							new PricingTier( 3000, 4000, 855 ),
							new PricingTier( 4000, 5000, 1155 ),
							new PricingTier( 5000, 6000, 1305 ),
							new PricingTier( 7000, 8000, 1455 ),
							new PricingTier( 8000, 9000, 1755 ),
							new PricingTier( 10000, 11000, 2005 ),
							new PricingTier( 12000, 13000, 2505 ),
							new PricingTier( 13000, 14000, 2755 ),
							new PricingTier( 14000, 15000, 3005 ),
							new PricingTier( 15000, 16000, 3255 ),
							new PricingTier( 16000, 17000, 3505 ),
							new PricingTier( 17000, 22000, 4755 ),
						]
					)
				],
				null,
				null,
				true,
				null,
				false,
				false
			),
			'Przesyłka paletowa Geodis (za pobraniem)' => new ShippingMethod(
				[
					new ShippingOption(
						[],
						[
							new PricingTier( 0, 100, 180 ),
							new PricingTier( 100, 200, 190 ),
							new PricingTier( 200, 300, 210 ),
							new PricingTier( 300, 400, 235 ),
							new PricingTier( 400, 500, 245 ),
							new PricingTier( 500, 700, 255 ),
							new PricingTier( 700, 900, 265 ),
							new PricingTier( 900, 1000, 275 ),
							new PricingTier( 1000, 1100, 295 ),
							new PricingTier( 1100, 1250, 335 ),
							new PricingTier( 1250, 1450, 385 ),
							new PricingTier( 1450, 1650, 485 ),
							new PricingTier( 1650, 2000, 615 ),
							new PricingTier( 2000, 3000, 735 ),
							new PricingTier( 3000, 4000, 885 ),
							new PricingTier( 4000, 5000, 1035 ),
							new PricingTier( 5000, 6000, 1185 ),
							new PricingTier( 6000, 7000, 1335 ),
							new PricingTier( 7000, 8000, 1485 ),
						]
					)
				],
				null,
				9000,
				true,
				null,
				false,
				true
			),
			'Paleta Geodis' => new ShippingMethod(
				[
					new ShippingOption(
						[],
						[
							new PricingTier( 0, 100, 95 ),
							new PricingTier( 100, 300, 125 ),
						]
					)
				],
				[
					'second_largest' => 60,
					'largest' => 80,
				],
				null,
				false,
				null,
				false,
				false
			),
			'Paleta Geodis (za pobraniem)' => new ShippingMethod(
				[
					new ShippingOption(
						[],
						[
							new PricingTier( 0, 100, 125 ),
							new PricingTier( 100, 300, 155 ),
						]
					)
				],
				[
					'second_largest' => 60,
					'largest' => 80,
				],
				9000,
				false,
				null,
				false,
				true
			),
			'Paczka Geodis' => new ShippingMethod(
				[
					new ShippingOption(
						[ 'mozaiki' ],
						[
							new PricingTier( 0, 10, 80 ),
							new PricingTier( 10, 20, 85 ),
							new PricingTier( 20, 30, 95 ),
						]
					),
					new ShippingOption(
						[ 'listwy' ],
						[
							new PricingTier( 0, 30, 80 ),
						]
					),
				],
				null,
				null,
				false,
				null,
				false,
				false
			),
			'Paczka Geodis (za pobraniem)' => new ShippingMethod(
				[
					new ShippingOption(
						[ 'mozaiki' ],
						[
							new PricingTier( 0, 10, 110 ),
							new PricingTier( 10, 20, 115 ),
							new PricingTier( 20, 30, 125 ),
						]
					),
					new ShippingOption(
						[ 'listwy' ],
						[
							new PricingTier( 0, 30, 110 ),
						]
					),
				],
				null,
				9000,
				false,
				null,
				false,
				true
			),
			'Paczkomat Inpost' => new ShippingMethod(
				[
					new ShippingOption(
						[ 'mozaiki', 'listwy' ],
						[
							new PricingTier( 0, 30, 25 ),
						]
					)
				],
				[
					'largest' => 60,
					'second_largest' => null,
				],
				null,
				false,
				50,
				false,
				false
			),
			'Paczkomat Inpost (za pobraniem)' => new ShippingMethod(
				[
					new ShippingOption(
						[ 'mozaiki', 'listwy' ],
						[
							new PricingTier( 0, 30, 35 ),
						]
					)
				],
				[
					'largest' => 60,
					'second_largest' => null,
				],
				9000,
				false,
				null,
				false,
				true
			),
			'Kurier Inpost' => new ShippingMethod(
				[
					new ShippingOption(
						[],
						[
							new PricingTier( 0, 30, 30 ),
						]
					)
				],
				null,
				null,
				false,
				50,
				true,
				false
			),
		];
	}

	public function get_method_by_pricing_key( $key ) {
		return $this->pricing_ranges[ $key ] ?? null;
	}

	public function calculate_cost( $total_weight, $weight_ranges ) {
		$new_cost = null;
		foreach ( $weight_ranges as $range ) {
			if ( $range instanceof ShippingOption ) {
				foreach ( $range->tiers as $tier ) {
					$min = $tier->min_weight;
					$max = $tier->max_weight;
					$price = $tier->cost;
					if ( $total_weight >= $min && $total_weight <= $max ) {
						$new_cost = $price;
						break 2;
					}
				}
			}
		}

		if ( $new_cost === null && $total_weight > 0 ) {
			$last_range = end( $weight_ranges );
			if ( $last_range instanceof PricingTier ) {
				$last_max = $last_range->max_weight;
				$last_cost = $last_range->cost;
			} else {
				$last_max = $last_range[1];
				$last_cost = $last_range[2];
			}
			$num_full = floor( $total_weight / ( $last_max ? $last_max : 1 ) );
			$remainder = $total_weight % $last_max;
			$remainder_cost = 0;
			if ( $remainder > 0 ) {
				foreach ( $weight_ranges as $range ) {
					if ( $range instanceof PricingTier ) {
						$min = $range->min_weight;
						$max = $range->max_weight;
						$price = $range->cost;
					} else {
						list( $min, $max, $price ) = $range;
					}
					if ( $remainder >= $min && $remainder <= $max ) {
						$remainder_cost = $price;
						break;
					}
				}
			}
			$new_cost = $num_full * $last_cost + $remainder_cost;
		}

		return $new_cost;
	}

	private function product_fits_dimensions( $product, $max_dimensions, $unit_converter ) {
		if ( $max_dimensions === null ) {
			return true;
		}

		$length = $product->get_length();
		$width = $product->get_width();
		$height = $product->get_height();

		// Collect available dimensions
		$dims = array_filter( [ $length, $width, $height ], function ( $dim ) {
			return $dim !== '' && $dim !== null && $dim !== false;
		} );

		// Need at least 2 dimensions
		if ( count( $dims ) < 2 ) {
			return false;
		}

		// Convert to cm and sort
		$dims = array_map( function ( $dim ) use ( $unit_converter ) {
			return $unit_converter->convert_dimension_to_cm( $dim );
		}, $dims );
		rsort( $dims );

		return ( $max_dimensions['second_largest'] === null || $dims[1] <= $max_dimensions['second_largest'] )
			&& ( $max_dimensions['largest'] === null || $dims[0] <= $max_dimensions['largest'] );
	}

	public function should_hide_rate( $package, $total_weight, $total_value, $pricing_data, $unit_converter, $cart_analyzer ) {

		// Check if at least one shipping option satisfies the conditions
		$has_valid_option = false;
		$max_weight_limit = null;

		if ( is_array( $pricing_data->ranges ) && count( $pricing_data->ranges ) > 0 ) {
			foreach ( $pricing_data->ranges as $option ) {
				// Check if option is a ShippingOption object (not already converted to array)
				if ( ! is_object( $option ) || ! isset( $option->categories ) ) {
					continue;
				}

				// Check category match
				$matches = empty( $option->categories );
				if ( ! $matches && $option->categories ) {
					foreach ( $option->categories as $category_slug ) {
						if ( $cart_analyzer->cart_has_category( $package, $category_slug ) ) {
							$matches = true;
							break;
						}
					}
				}

				if ( ! $matches ) {
					continue;
				}

				// Check dimensions for this option
				$dimensions_ok = true;
				if ( $pricing_data->max_dimensions !== null ) {
					foreach ( $package['contents'] as $item ) {
						$product = $item['data'];
						if ( ! $this->product_fits_dimensions( $product, $pricing_data->max_dimensions, $unit_converter ) ) {
							$dimensions_ok = false;
							break;
						}
					}
				}

				if ( ! $dimensions_ok ) {
					continue;
				}

				// Check max value for this option
				if ( $pricing_data->max_value !== null && $total_value > $pricing_data->max_value ) {
					continue;
				}

				// This option satisfies all conditions except weight
				$has_valid_option = true;

				// Get max weight limit from this option's last tier
				if ( ! $pricing_data->allow_multiple_packages && ! empty( $option->tiers ) ) {
					$last_tier = end( $option->tiers );
					$max_weight_limit = $last_tier->max_weight;
				}

				// If we found a valid option, we can stop checking
				break;
			}
		}

		// If no option satisfies the conditions (category, dimensions, value), hide the rate
		if ( ! $has_valid_option ) {
			return true;
		}

		// Check weight limit - hide shipping method if weight exceeds limit and multiple packages not allowed
		if ( $max_weight_limit !== null && $total_weight > $max_weight_limit ) {
			return true;
		}

		return false;
	}

	/**
	 * Find and return the matching shipping option from the pricing data
	 * This is used by the shipping adjuster to get the correct option for pricing
	 */
	// public function find_matching_option( $pricing_data, $package, $cart_analyzer ) {
	// 	if ( ! is_array( $pricing_data->ranges ) || count( $pricing_data->ranges ) === 0 ) {
	// 		return null;
	// 	}

	// 	foreach ( $pricing_data->ranges as $option ) {
	// 		// Check if option is a ShippingOption object
	// 		if ( ! is_object( $option ) || ! isset( $option->categories ) ) {
	// 			continue;
	// 		}

	// 		$matches = empty( $option->categories );
	// 		if ( ! $matches && $option->categories ) {
	// 			foreach ( $option->categories as $category_slug ) {
	// 				if ( $cart_analyzer->cart_has_category( $package, $category_slug ) ) {
	// 					$matches = true;
	// 					break;
	// 				}
	// 			}
	// 		}

	// 		if ( $matches ) {
	// 			return $option;
	// 		}
	// 	}

	// 	return null;
	// }
}
