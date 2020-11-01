<?php

describe( 'filter: escape', function() {
	it( 'shoulds return the value escaped', function() {
		$value = '<br>';
		$current = v( $value, "escape($value)" );
		$expected = '&lt;br&gt;';
		expect( $current )->toBe( $expected );
	} );
} );
