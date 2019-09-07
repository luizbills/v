<?php

// returns the length of $value content
return function ( $value, $args ) {
	$encoding = _v_get( $args, 0, null );
	if ( null !== $encoding ) {
		return mb_strlen( $value, $encoding );
	}
	return mb_strlen( $value );
};
