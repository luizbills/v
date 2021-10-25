<?php

describe( 'filter: prepend', function() {
	it( 'shoulds prepends a string', function() {
		$current = v( 'c', 'prepend(ab)' );
		$expected = 'abc';
		expect( $current )->toBe( $expected );
	} );
} );
