<?php

// put a mask
// eg.
// Date Mask = ##/##/##
return function ( $value, $args ) {
	$mask = $args->get( 0 );

	return vsprintf(
		str_replace( '#', '%s', $mask ),
		str_split( $value )
	);
};
