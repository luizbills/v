<?php

// make the $value content uppercase
return function ( $value, $args ) {
	$encoding = _v_get( $args, 0, 'UTF-8' );
	return mb_strtoupper( $value, $encoding );
};
