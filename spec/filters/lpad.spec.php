<?php

describe( 'filter: lpad', function() {
	it( 'shoulds left pad a string to a certain length with another string', function() {
		$current = v( '1', 'lpad(5,-)' );
		$expected = '----1';
		expect( $current )->toBe( $expected );
	} );
} );
