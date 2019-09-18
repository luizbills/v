<?php

return function ( $value, $args ) {
	$string = $args->get( 0 );
	return $value . $string;
};
