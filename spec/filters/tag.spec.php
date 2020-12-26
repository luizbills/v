<?php

describe( 'filter: tag', function() {
	it( 'shoulds make the value into an html tag', function() {
		$current = v( 'My Title', 'tag("h1", "my-class1 my-class2", "my-id")', 'raw' );
		$expected = "<h1 class='my-class1 my-class2' id='my-id'>My Title</h1>";
		expect( $current )->toBe( $expected );
	} );
} );
