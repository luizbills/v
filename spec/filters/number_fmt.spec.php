<?php

describe( 'filter: number_fmt', function() {
	it( 'shoulds format a number', function() {
		$current = v( '1200', 'number_fmt(2,.,_)' );
		$expected = '1_200.00';
		expect( $current )->toBe( $expected );
	} );
} );
