<?php

// Return a default value if empty string is passed
return function ($value, $args) {
    $default = (string) $args->get(0);
    if ( null === $default || '' == $default ) {
		throw new \InvalidArgumentException( 'Argument 1 should not be a empty string or null' );
    }
    return ! empty( $value ) ? $value : $default;
};
