<?php

return function ( $value, $args ) {
    $len = (int) $args->get( 0 );
    $char = $args->get( 1, '0' );
    return str_pad( $value, $len, $char, STR_PAD_LEFT );
};
