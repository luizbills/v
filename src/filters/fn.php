<?php

return function ( $value, $args ) {
	$function = $args->get( 0 );
	return call_user_func( $function, $value );
};
