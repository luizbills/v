<?php

describe( 'filter: link', function() {
	it( 'shoulds create a HTML anchor', function() {
		$current = v( 'PHP', 'link("https://www.php.net")', 'raw' );
		$expected = '<a href="https://www.php.net" class="">PHP</a>';
		expect( $current )->toBe( $expected );
	} );

	it( 'shoulds sanitize the 2nd argument, the link "class" parameter', function() {
		$current = v( 'PHP', 'link("https://www.php.net", "link<")', 'raw' );
		$expected = '<a href="https://www.php.net" class="link">PHP</a>';
		expect( $current )->toBe( $expected );
	} );

	it( 'shoulds use the 3rd argument as "target"', function() {
		$current = v( 'PHP', 'link("https://www.php.net", "link", "_blank")', 'raw' );
		$expected = '<a href="https://www.php.net" class="link" target="_blank" rel="nofollow noopener">PHP</a>';
		expect( $current )->toBe( $expected );
	} );

	it( 'shoulds add rel="nofollow" if the 4rd argument is not "follow"', function() {
		$current = v( 'PHP', 'link("https://www.php.net", "link", "_blank", "follow")', 'raw' );
		$expected = '<a href="https://www.php.net" class="link" target="_blank">PHP</a>';
		expect( $current )->toBe( $expected );
	} );
} );
