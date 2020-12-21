<?php

describe( 'filter: wrap', function() {
	it( 'shoulds preppend the first argument and append the second', function() {
		$current = v( 'x', 'wrap([,])' );
		$expected = '[x]';
		expect( $current )->toBe( $expected );
	} );

	it( 'shoulds add the first argument before and after, if the second argument is omitted', function() {
		$current = v( 'x', "wrap(#)" );
		$expected = "#x#";
		expect( $current )->toBe( $expected );
	} );
} );
