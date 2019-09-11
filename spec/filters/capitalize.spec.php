<?php

describe( 'filter: capitalize', function() {
	it( 'shoulds capitalize the first letter, by default', function() {
		$current = v( 'ab cd', 'capitalize' );
		$expected = 'Ab cd';
		expect( $current )->toBe( $expected );
	} );

	it( 'shoulds capitalize the first letter of each word if the argument 1 is "all"', function() {
		$current = v( 'ab cd', 'capitalize(all)' );
		$expected = 'Ab Cd';
		expect( $current )->toBe( $expected );
	} );
} );