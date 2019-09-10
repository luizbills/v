<?php

use luizbills\v\Engine;

function v ( $value, ...$filters ) {
	return Engine::get_instance()->run_filters( $value, ...$filters );
}

function v_register_filter ( string $name, callable $callback, string $context = '' ) {
	Engine::get_instance()->register_filter( $name, $callback, $context );
}

function v_set_context ( string $context ) {
	Engine::get_instance()->set_context( $context );
}

function v_reset_context () {
	Engine::get_instance()->reset_context();
}

function v_load_default_filters ( array $extension ) {
	Engine::get_instance()->load( $extension );
}
