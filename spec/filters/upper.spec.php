<?php

describe( 'filter: upper', function() {
	it( 'shoulds make all characters upper case', function() {
		$current = v( 'Ab CD', 'upper' );
		$expected = 'AB CD';
		expect( $current )->toBe( $expected );
	} );
} );
