<?php

// logs the $value (only in debug mode)
return function ( $value, $args ) {
	$id = $args->get( 0, null );
	\error_log( '[v log filter output' . ( null !== $id ? " @ $id" : '' ) . "] $value" );
	return $value;
};
