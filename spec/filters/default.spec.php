<?php

describe( 'filter: default', function() {
	it( 'shoulds return the first argument if a falsy value is passed', function() {
		$default = 'OK';
		$value = '';
		$current = v( $value, "default($default)" );
		$expected = $default;
		expect( $current )->toBe( $expected );
	} );

	it( 'shoulds return the value argument if a not falsy value is passed', function() {
		$default = 'OK';
		$value = 'not empty';
		$current = v( $value, "default($default)" );
		$expected = $value;
		expect( $current )->toBe( $expected );
	} );
} );
