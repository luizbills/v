<?php

// Return a formatted date (default: Y-m-d)
return function ( $value, $args ) {
	$format = _v_get( $args, 0, 'Y-m-d' );
	return \date( $format, (int) $value );
};
