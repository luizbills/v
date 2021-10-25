<?php

describe( 'filter: capitalize', function() {
	it( 'shoulds capitalize the first letter, by default', function() {
		$current = v( 'áb cd', 'capitalize' );
		$expected = 'Áb cd';
		expect( $current )->toBe( $expected );
	} );

	it( 'shoulds capitalize the first letter of each word if the argument 1 is "all"', function() {
		$current = v( 'ab éf ui', 'capitalize(all)' );
		$expected = 'Ab Éf Ui';
		expect( $current )->toBe( $expected );
	} );
} );
