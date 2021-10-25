<?php

describe( 'filter: alpha', function() {
	it( 'shoulds remove all non-alphabetic characters', function() {
		$current = v( 'A bc)d$8é', 'alpha' );
		$expected = 'Abcdé';
		expect( $current )->toBe( $expected );
	} );
} );
