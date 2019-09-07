<?php

// Make a value's first character uppercase.
// You can capitalize all words passing 'all' as first argument
return function ( $value, $args ) {

	$all = _v_get( $args, 0, '' );
	if ( 'all' == $all ) {
		$words = explode( ' ', $value );
		return implode( ' ', array_map( 'ucfirst', $words ) );
	}
	return ucfirst( $value );
};
