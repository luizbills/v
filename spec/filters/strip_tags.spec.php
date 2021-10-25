<?php
describe( 'filter: strip_tags', function() {
	it( 'shoulds remove all HTML tags', function() {
		$current = v( '<p>Hello</p>', 'strip_tags' );
		$expected = 'Hello';
		expect( $current )->toBe( $expected );
	} );
} );
