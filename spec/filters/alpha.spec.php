<?php

describe( 'filter: alpha', function() {
	it( 'shoulds remove all non-alphabetic characters', function() {
		$current = v( 'A bc)d$8', 'alpha' );
		$expected = 'Abcd';
		expect( $current )->toBe( $expected );
	} );
} );
