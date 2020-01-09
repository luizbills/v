<?php
describe( 'filter: safe_html', function() {
	it( 'shoulds remove all script, style, link and iframe tags', function() {
		$bad_html = '<p>ok</p>'; // good html
		$bad_html .= '<script>return;</script>'; // bad
		$bad_html .= '<script/>'; // bad
		$bad_html .= '<style>a {}</style>'; // bad
		$bad_html .= '<link href="">'; // bad
		$bad_html .= '<iframe src="https://github.com">'; // bad
		$bad_html .= ' '; // don't trim

		$current = v( $bad_html, 'safe_html', 'raw' );
		$expected = '<p>ok</p> ';
		expect( $current )->toBe( $expected );
	} );
} );
