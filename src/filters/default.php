<?php

// Return a default value if empty string is passed
return function ( $value, $args ) {
	$default = (string) _v_get( $args, 0 );
	if ( '' == $default ) {
		throw new InvalidArgumentException( 'Invalid argument for default filter' );
	}
	return '' !== $value ? $value : $default;
};
