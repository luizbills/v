<?php

describe( 'filter: mask', function() {
	it( 'shoulds put a mask', function() {
		$current = v( '01012020', 'mask(##/##/####)' );
		$expected = '01/01/2020';
		expect( $current )->toBe( $expected );
	} );

	it( 'shoulds respect the mask size', function() {
		$current = v( '0101202099999', 'mask(##/##/####)' );
		$expected = '01/01/2020';
		expect( $current )->toBe( $expected );
	} );
} );
