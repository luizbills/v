<?php

describe( 'filter: alphanum', function() {
	it( 'shoulds remove all non-alphabetic and non-numeric characters, but leaves dashes and underscores', function() {
		$current = v( '_A bc)d$é-8', 'alphanum' );
		$expected = '_Abcdé-8';
		expect( $current )->toBe( $expected );
	} );
} );
