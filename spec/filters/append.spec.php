<?php

describe( 'filter: append', function() {
	it( 'shoulds appends a string', function() {
		$current = v( 'a', 'append(bc)' );
		$expected = 'abc';
		expect( $current )->toBe( $expected );
	} );
} );
