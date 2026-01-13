<?php

class ShippingRange {
    public $categories; // Array of strings (e.g., ['mozaiki'])
    public $tiers;      // Array of PricingTier objects

    public function __construct($categories, $tiers) {
        $this->categories = $categories;
        $this->tiers = $tiers;
    }
}