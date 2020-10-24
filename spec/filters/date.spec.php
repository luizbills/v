<?php

describe( 'filter: date', function() {
	it( 'shoulds receive a timestamp and returns a date', function() {
		$now = time();
		$current = v( $now, 'date' );
		$expected = date( 'Y-m-d', $now );
		expect( $current )->toBe( $expected );
	} );

	it( 'shoulds receive a timestamp and returns a formatted date', function() {
		$now = time();
		$format = 'Y';
		$current = v( $now, "date($format)" );
		$expected = date( $format, $now );
		expect( $current )->toBe( $expected );
	} );
} );
