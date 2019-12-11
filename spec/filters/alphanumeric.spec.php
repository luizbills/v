<?php

describe( 'filter: alpha', function() {
	it( 'shoulds remove all non-alphabetic and non-numeric characters', function() {
		$current = v( 'A bc)d$8', 'alphanumeric' );
		$expected = 'Abcd8';
		expect( $current )->toBe( $expected );
	} );
} );
