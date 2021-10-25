<?php


if ( ! function_exists( 'mb_ucfirst' ) ) :
function mb_ucfirst ( $string ) {
	$encoding = mb_internal_encoding();
	$first = mb_substr( $string, 0, 1, $encoding );
	$then = mb_substr( $string, 1, null, $encoding );
	return mb_strtoupper( $first, $encoding ) . $then;
}
endif;

// Make a value's first character uppercase.
// You can capitalize all words passing 'all' as first argument
return function ( $value, $args ) {
	$all = $args->get( 0 );

	if ( 'all' == $all ) {
		$words = \explode( ' ', $value );
		return \implode( ' ', \array_map( 'mb_ucfirst', $words ) );
	}
	return \mb_ucfirst( (string) $value );
};
