<?php

return function ( $value, $args ) {
	$url = $args->get( 0, '#' );
	$class = $args->get( 1, '' );
	$target = $args->get( 2, '' );
	$follow = $args->get( 3, '' );

	$url = filter_var( $url, FILTER_SANITIZE_URL );
	$class = filter_var( $class, FILTER_SANITIZE_STRING );
	$target = '_blank' === $target ? $target : filter_var( $target, FILTER_SANITIZE_URL );

	$html = "<a href=\"$url\" class=\"$class\"";
	if ( $target ) {
		$html .= " target=\"$target\"";
		if ( $follow !== 'follow' ) {
			$html .= ' rel="nofollow noopener"';
		}
	}

	return $html . ">$value</a>";
};
