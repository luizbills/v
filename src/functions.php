<?php

use luizbills\v\Engine;

function v ( $value, ...$filters ) {
	return Engine::get_instance()->run_filters( $value, $filters );
}

function v_register_filter ( $name, $callback, $context = null ) {
	return Engine::get_instance()->register_filter( $name, $callback, $context );
}

function v_set_context ( $context ) {
	return Engine::get_instance()->set_context( $context );
}

function v_reset_context () {
	return Engine::get_instance()->reset_context();
}

// private helper
function _v_get ( $array, $key, $default = null ) {
	return isset( $array[ $key ] ) ? $array[ $key ] : $default;
}

function _v_strip_evil_tags ( $html ) {
	$html = preg_replace( '/<(script|style)[^>]*?>.*?<\/\\1>/si', '', $html );
	$html = preg_replace( '/<(iframe|link)[^>]*?>/si', '', $html );
	return $html;
}