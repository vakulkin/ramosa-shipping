<?php

require_once 'class-pricing-tier.php';
require_once 'class-shipping-range.php';
require_once 'class-validation-result.php';

class ShippingPricingManager {
	private $pricing_ranges;

	public function __construct() {
		$this->initialize_pricing_ranges();
	}

	private function initialize_pricing_ranges() {
		$this->pricing_ranges = [
			'Przesyłka paletowa Geodis' => new ShippingMethod(
				[
					new ShippingRange(
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
					new ShippingRange(
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
					new ShippingRange(
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
					new ShippingRange(
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
					new ShippingRange(
						[ 'mozaiki' ],
						[
							new PricingTier( 0, 10, 80 ),
							new PricingTier( 10, 20, 85 ),
							new PricingTier( 20, 30, 95 ),
						]
					),
					new ShippingRange(
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
					new ShippingRange(
						[ 'mozaiki' ],
						[
							new PricingTier( 0, 10, 110 ),
							new PricingTier( 10, 20, 115 ),
							new PricingTier( 20, 30, 125 ),
						]
					),
					new ShippingRange(
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
					new ShippingRange(
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
					new ShippingRange(
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
					new ShippingRange(
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

	public function calculate_cost( $total_weight, $tiers ) {
		$new_cost = null;
		
		// Find the matching tier for the total weight
		foreach ( $tiers as $tier ) {
			$min = $tier->min_weight;
			$max = $tier->max_weight;
			$price = $tier->cost;
			
			if ( $total_weight >= $min && $total_weight <= $max ) {
				$new_cost = $price;
				break;
			}
		}

		// If no tier matched and weight > 0, calculate based on multiple packages
		if ( $new_cost === null && $total_weight > 0 && count( $tiers ) > 0 ) {
			$last_tier = end( $tiers );
			$last_max = $last_tier->max_weight;
			$last_cost = $last_tier->cost;
			
			$num_full = floor( $total_weight / ( $last_max ? $last_max : 1 ) );
			$remainder = $total_weight % $last_max;
			$remainder_cost = 0;
			
			if ( $remainder > 0 ) {
				foreach ( $tiers as $tier ) {
					$min = $tier->min_weight;
					$max = $tier->max_weight;
					$price = $tier->cost;
					
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

	public function find_valid_range( $package, $total_weight, $total_value, $pricing_data, $unit_converter, $cart_analyzer ) {
		if ( ! $this->has_valid_ranges( $pricing_data ) ) {
			return ValidationResult::hide();
		}

		foreach ( $pricing_data->ranges as $range ) {
			if ( ! $this->is_shipping_range( $range ) ) {
				continue;
			}

			if ( ! $this->matches_categories( $range, $package, $cart_analyzer ) ) {
				continue;
			}

			if ( ! $this->fits_dimensions( $package, $pricing_data->max_dimensions, $unit_converter ) ) {
				continue;
			}

			if ( ! $this->is_within_max_value( $total_value, $pricing_data->max_value ) ) {
				continue;
			}

			if ( $this->exceeds_weight_limit( $range, $total_weight, $pricing_data->allow_multiple_packages ) ) {
				return ValidationResult::hide();
			}

			return ValidationResult::show( $range );
		}

		return ValidationResult::hide();
	}

	private function has_valid_ranges( $pricing_data ) {
		return is_array( $pricing_data->ranges ) && count( $pricing_data->ranges ) > 0;
	}

	private function is_shipping_range( $range ) {
		return is_object( $range ) && isset( $range->categories );
	}

	private function matches_categories( $range, $package, $cart_analyzer ) {
		if ( empty( $range->categories ) ) {
			return true;
		}

		foreach ( $range->categories as $category_slug ) {
			if ( $cart_analyzer->cart_has_category( $package, $category_slug ) ) {
				return true;
			}
		}

		return false;
	}

	private function fits_dimensions( $package, $max_dimensions, $unit_converter ) {
		if ( $max_dimensions === null ) {
			return true;
		}

		foreach ( $package['contents'] as $item ) {
			$product = $item['data'];
			if ( ! $this->product_fits_dimensions( $product, $max_dimensions, $unit_converter ) ) {
				return false;
			}
		}

		return true;
	}

	private function is_within_max_value( $total_value, $max_value ) {
		return $max_value === null || $total_value <= $max_value;
	}

	private function exceeds_weight_limit( $range, $total_weight, $allow_multiple_packages ) {
		if ( $allow_multiple_packages ) {
			return false;
		}

		$max_weight_limit = $this->get_max_weight_from_range( $range );
		
		return $max_weight_limit !== null && $total_weight > $max_weight_limit;
	}

	private function get_max_weight_from_range( $range ) {
		if ( empty( $range->tiers ) ) {
			return null;
		}

		$last_tier = end( $range->tiers );
		return $last_tier->max_weight;
	}
}
