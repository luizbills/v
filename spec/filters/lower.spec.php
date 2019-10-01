<?php

describe( 'filter: lower', function() {
	it( 'shoulds make all characters lower case', function() {
		$current = v( 'Ab CD', 'lower' );
		$expected = 'ab cd';
		expect( $current )->toBe( $expected );
	} );
} );
