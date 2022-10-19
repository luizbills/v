<?php

describe( 'filter: rpad', function() {
	it( 'shoulds right pad a string to a certain length with another string', function() {
		$current = v( '1', 'rpad(5,-)' );
		$expected = '1----';
		expect( $current )->toBe( $expected );
	} );
} );
