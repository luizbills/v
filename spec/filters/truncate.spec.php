<?php

describe( 'filter: truncate', function() {
	it( 'shoulds return part of string (size = 1st argument)', function() {
		$current = v( 'ábcdefgh', 'truncate(3)' );
		$expected = 'ábc';
		expect( $current )->toBe( $expected );
	} );
} );
