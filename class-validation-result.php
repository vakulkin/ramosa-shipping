<?php

class ValidationResult {
	private $should_hide;
	private $matched_range;

	public function __construct( $should_hide, $matched_range = null ) {
		$this->should_hide = $should_hide;
		$this->matched_range = $matched_range;
	}

	public function should_hide() {
		return $this->should_hide;
	}

	public function get_matched_range() {
		return $this->matched_range;
	}

	public function has_matched_range() {
		return $this->matched_range !== null;
	}

	public static function hide() {
		return new self( true, null );
	}

	public static function show( $matched_range ) {
		return new self( false, $matched_range );
	}
}
