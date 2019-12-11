<?php

describe( 'filter: alphanum', function() {
	it( 'shoulds remove all non-alphabetic and non-numeric characters', function() {
		$current = v( 'A bc)d$8', 'alphanum' );
		$expected = 'Abcd8';
		expect( $current )->toBe( $expected );
	} );
} );
