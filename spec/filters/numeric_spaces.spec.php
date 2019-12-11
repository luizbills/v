<?php

describe( 'filter: numeric_spaces', function() {
	it( 'shoulds remove all non-numeric chars, but leave white spaces', function() {
		$current = v( '12#3. 456a', 'numeric_spaces' );
		$expected = '123 456';
		expect( $current )->toBe( $expected );
	} );
} );
