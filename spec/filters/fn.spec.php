<?php

describe( 'filter: fn', function() {
	it( 'shoulds call the function in first argument passing the value as argument', function() {
		$current = v( ' A ', 'fn(trim)' );
		$expected = 'A';
		expect( $current )->toBe( $expected );
	} );
} );
