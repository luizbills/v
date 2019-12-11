<?php

return function ( $value, $args ) {
	$size = $args->get( 0, 1 );
	$enconding = $args->get( 1, mb_internal_encoding() );
	return \mb_substr( $value, 0, $size, $enconding );
};
