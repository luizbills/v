<?php

describe( 'filter: url_encode', function() {
	it( 'shoulds encodes a string to be used in a query part of a URL', function() {
		$current = v( 'a?b c', 'url_encode' );
		$expected = 'a%3Fb+c';
		expect( $current )->toBe( $expected );
	} );
} );
