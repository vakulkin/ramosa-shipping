<?php

class ShippingMethod {

    public $ranges;
    public $max_dimensions;
    public $max_value;
    public $allow_multiple_packages;
    public $sample_price;
    public $sample_only;
    public $cod;
    
    public function __construct( $ranges, $max_dimensions, $max_value, $allow_multiple_packages, $sample_price, $sample_only, $cod ) {
        $this->ranges = $ranges;
        $this->max_dimensions = $max_dimensions;
        $this->max_value = $max_value;
        $this->allow_multiple_packages = $allow_multiple_packages;
        $this->sample_price = $sample_price;
        $this->sample_only = $sample_only;
        $this->cod = $cod;
    }
}