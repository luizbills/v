<?php

return function ( $value, $args ) {
	$tag = (string) $args->get( 0 );
	$class = $args->get( 1, '' );
	$id = $args->get( 2, '' );

	if ( '' == $tag ) {
		throw new InvalidArgumentException( 'First argument of "tag" filter must be a non-empty string' );
	}

	return "<$tag id='$id' class='$class'>$value</$tag>";
};
