<?php

class UnitConverter {

    private $weight_unit;
    private $dimension_unit;

    public function __construct() {
        $this->load_dynamic_settings();
    }

    private function load_dynamic_settings() {
        $this->weight_unit = get_option( 'woocommerce_weight_unit', 'kg' );
        $this->dimension_unit = get_option( 'woocommerce_dimension_unit', 'cm' );
    }

    public function convert_weight_to_kg( $weight ) {
        switch ( $this->weight_unit ) {
            case 'kg':
                return $weight;
            case 'g':
                return $weight / 1000;
            case 'lbs':
                return $weight * 0.453592;
            case 'oz':
                return $weight * 0.0283495;
            default:
                return $weight; // assume kg
        }
    }

    public function convert_dimension_to_cm( $dim ) {
        switch ( $this->dimension_unit ) {
            case 'cm':
                return $dim;
            case 'mm':
                return $dim / 10;
            case 'm':
                return $dim * 100;
            case 'in':
                return $dim * 2.54;
            case 'yd':
                return $dim * 91.44;
            default:
                return $dim; // assume cm
        }
    }
}