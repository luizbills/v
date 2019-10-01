<?php

describe( 'filter: trim', function() {
	it( 'shoulds trim all whitespace from the beginning and end of a string', function() {
		$current = v( '  Hello!  ', 'trim' );
		$expected = 'Hello!';
		expect( $current )->toBe( $expected );
	} );
} );
