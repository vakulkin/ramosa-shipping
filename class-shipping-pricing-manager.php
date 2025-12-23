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
				null,
				null,
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
				null,
				300,
				9000,
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
				null,
				300,
				9000,
				false,
				null,
				false,
				true
			),
			'Paczka Geodis' => new ShippingMethod(
				[
					new ShippingOption(
						[ 'mosaiki' ],
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
					new ShippingOption(
						[],
						[
							new PricingTier( 0, 30, 20 ),
						]
					),
				],
				null,
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
						[ 'mosaiki' ],
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
					new ShippingOption(
						[],
						[
							new PricingTier( 0, 30, 30 ),
						]
					),
				],
				null,
				null,
				null,
				false,
				null,
				false,
				true
			),
			'Paczkomat Inpost' => new ShippingMethod(
				[
					new ShippingOption(
						[],
						[
							new PricingTier( 0, 30, 25 ),
						]
					)
				],
				[
					'second_largest' => 80,
					'largest' => 60,
				],
				null,
				null,
				false,
				50,
				false,
				false
			),
			'paczkomat_inpost_cod' => new ShippingMethod(
				[
					new ShippingOption(
						[],
						[
							new PricingTier( 0, 30, 35 ),
						]
					)
				],
				[
					'second_largest' => 80,
					'largest' => 60,
				],
				null,
				null,
				false,
				null,
				false,
				true
			),
			'kurier_inpost_non_cod' => new ShippingMethod(
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
			if ( $range instanceof PricingTier ) {
				$min = $range->min_weight;
				$max = $range->max_weight;
				$price = $range->cost;
			} else {
				list( $min, $max, $price ) = $range;
			}
			if ( $total_weight >= $min && $total_weight <= $max ) {
				$new_cost = $price;
				break;
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
		if ( ! $length || ! $width || ! $height ) {
			return false;
		}
		$length = $unit_converter->convert_dimension_to_cm( $length );
		$width = $unit_converter->convert_dimension_to_cm( $width );
		$height = $unit_converter->convert_dimension_to_cm( $height );
		$dims = [ $length, $width, $height ];
		sort( $dims );
		return ( $max_dimensions['second_largest'] === null || $dims[1] <= $max_dimensions['second_largest'] )
			&& ( $max_dimensions['largest'] === null || $dims[2] <= $max_dimensions['largest'] );
	}

	public function should_hide_rate( $package, $total_weight, $total_value, $pricing_data, $unit_converter ) {
		// Determine effective weight limit
		$max_weight_limit = $pricing_data->max_weight;
		if ( $max_weight_limit === null && ! $pricing_data->allow_multiple_packages ) {
			$last_range = end( $pricing_data->ranges );
			$max_weight_limit = $last_range[1];
		}

		// Check weight limit
		if ( $max_weight_limit !== null && $total_weight > $max_weight_limit ) {
			return true;
		}

		if ( $pricing_data->max_value !== null && $total_value > $pricing_data->max_value ) {
			return true;
		}

		// Check dimensions for paczkomat type
		if ( $pricing_data->max_dimensions !== null ) {
			foreach ( $package['contents'] as $item ) {
				$product = $item['data'];
				if ( ! $this->product_fits_dimensions( $product, $pricing_data->max_dimensions, $unit_converter ) ) {
					return true;
				}
			}
		}

		return false;
	}
}