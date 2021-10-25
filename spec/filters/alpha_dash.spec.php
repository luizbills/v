<?php

describe( 'filter: alpha_dash', function() {
	it( 'shoulds remove all non-alphabetic chars but leaves dashes and underscores', function() {
		$current = v( 'Á_b )-c$8', 'alpha_dash' );
		$expected = 'Á_b-c';
		expect( $current )->toBe( $expected );
	} );
} );
