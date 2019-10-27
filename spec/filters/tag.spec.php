<?php

describe( 'filter: tag', function() {
	it( 'shoulds make the value into an html tag', function() {
		$current = v( 'My Title', 'tag(h1, "my-id", "my-class")', 'raw' );
		$expected = '<h1 id="my-id" class="my-class">My Title</h1>';
		expect( $current )->toBe( $expected );
	} );
} );
