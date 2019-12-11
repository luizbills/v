<?php

describe( 'filter: numeric', function() {
	it( 'shoulds remove all non-numeric characters', function() {
		$current = v( '12#3. 456a', 'numeric' );
		$expected = '123456';
		expect( $current )->toBe( $expected );
	} );
} );
