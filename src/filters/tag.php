<?php

return function ( $value, $args ) {
    $tag = $args->get( 0, null );
    $class = $args->get( 1, null );
	$id = $args->get( 2, null );

    return '<'
        . $tag
        . ( ! is_null( $id ) ? ' id="' . $id . '"' : '' )
        . ( ! is_null( $class ) ? ' class="' . $class . '"' : '' )
        . '>'
        . $value
        . '</' .$tag . '>';
};
