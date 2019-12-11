<?php

describe( 'filter: alpha_dash', function() {
	it( 'shoulds remove all non-alphabetic chars but leaves dashes and underscores', function() {
		$current = v( 'A_b )-c$8', 'alpha_dash' );
		$expected = 'A_b-c';
		expect( $current )->toBe( $expected );
	} );
} );
