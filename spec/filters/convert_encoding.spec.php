<?php

describe( 'filter: convert_encoding', function() {
	it( 'shoulds convert the encoding', function() {
		$target_encoding = 'UTF-7';

		// to target encoding
		$current = v( 'á', "convert_encoding($target_encoding)" );
		$expected = mb_convert_encoding( 'á', $target_encoding );
		expect( $current )->toBe( $expected );

		// to target encoding from a specific encoding
		$current = v( 'á', "convert_encoding($target_encoding)", "convert_encoding(UTF-8, $target_encoding)"  );
		$expected = 'á';
		expect( $current )->toBe( $expected );
	} );
} );