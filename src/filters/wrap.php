<?php

// Prepends the first argument,
// and appends the second argument (default: same as the first)
return function ( $value, $args ) {
	$before = (string) _v_get( $args, 0, '' );
	$after = _v_get( $args, 1, $before );
	return $before . $value . $after;
};
