<?php

describe( 'filter: format', function() {
	it( 'shoulds return the value formatted by sprintf', function() {
		$value = '%s!';
		$current = v( $value, "format(ok)" );
		$expected = 'ok!';
		expect( $current )->toBe( $expected );
	} );
} );
