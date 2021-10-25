<?php

describe( 'filter: alpha_spaces', function() {
	it( 'shoulds remove all non-alphabetic chars but leaves white spaces', function() {
		$current = v( "Á b%&c\n", 'alpha_spaces' );
		$expected = "Á bc\n";
		expect( $current )->toBe( $expected );
	} );
} );
