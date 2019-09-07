<?php

// logs the $value (only in debug mode)
return function ( $value, $args ) {
	$id = _v_get( $args, 0 );
	error_log( "[v log filter output] $value" . ( $id ? " (ID: $id)" : '' ) );
	return $value;
};
