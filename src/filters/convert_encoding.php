<?php

// The convert_encoding filter converts a string from one encoding to another.
// The first argument is the expected output charset and the second one is the input charset:
return function ( $value, $args ) {
	$to = _v_get( $args, 0, null );
	$from = _v_get( $args, 1, 'UTF-8' );
	if ( null === $to ) {
		throw new InvalidArgumentException( 'Invalid first argument for convert_encoding filter' );
	}
	return \mb_convert_encoding( $value, $to, $from );
};
