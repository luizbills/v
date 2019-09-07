<?php

// make the $value content lowercase
return function ( $value, $args ) {
	$encoding = _v_get( $args, 0, 'UTF-8' );
	return mb_strtolower( $value, $encoding );
};
