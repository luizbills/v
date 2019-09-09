<?php

// Format a number with grouped thousands
// see: https://www.php.net/manual/en/function.number-format.php
return function ( $value, $args ) {
	$decimals_qty = _v_get( $args, 0, 0 );
	$decimal_point = _v_get( $args, 1, '.' );
	$thousands_separator = _v_get( $args, 2, ',' );
	return number_format( $value, $decimals, $decimal_point, $thousands_separator );
};
