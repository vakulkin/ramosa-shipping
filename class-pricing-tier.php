<?php

class PricingTier {
    public $min_weight;
    public $max_weight;
    public $cost;

    public function __construct($min_weight, $max_weight, $cost) {
        $this->min_weight = $min_weight;
        $this->max_weight = $max_weight;
        $this->cost = $cost;
    }
}