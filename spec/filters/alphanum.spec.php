<?php

describe( 'filter: alphanum', function() {
	it( 'shoulds remove all non-alphabetic and non-numeric characters', function() {
		$current = v( 'A bc)d$é8', 'alphanum' );
		$expected = 'Abcdé8';
		expect( $current )->toBe( $expected );
	} );
} );
