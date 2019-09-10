<?php

// logs the $value (only in debug mode)
return function ( $value, $args ) {
	$id = $args->get( 0, null );

	switch ( \gettype( $value ) ) {
		case 'boolean':
			$value = $value ? true : false;
			break;

		default:
			$value = print_r( $value, true );
	}
	\error_log( '[v log filter output' . ( null !== $id ? " @ $id" : '' ) . "] $value" );

	return $value;
};
