<?php

// Return a formatted string
// see: https://www.php.net/manual/en/function.sprintf.php
return function ( $value, $args ) {
	return call_user_func_array( 'sprintf', array_merge( [ $value ], $args ) );
};
