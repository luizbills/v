<?php

namespace luizbills\v;

final class Engine {
	const ROOT_CONTEXT = 'root';

	protected static $instance = null;

	protected $native_filters = [];
	protected $custom_filters = [];
	protected $current_context = null;

	protected function __construct () {
		// load default filters
		$this->load( [ $this, 'get_default_filters' ] );
		$this->reset_context();
	}

	public static function get_instance () {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function run_filters ( $value, $filters = [] ) {
		// ensure $value is a string
		$value = (string) $value;

		if ( \count( $filters ) > 0 ) {
			// trim all filter expressions
			$filters = \array_filter( $filters, 'trim' );

			// by default, any html in $value will be escaped
			// but the `raw` filter prevent this
			$has_raw = \preg_grep( '/(^raw$)|(^raw\()/', $filters );
			$has_escape = \preg_grep( '/(^escape$)|(^escape\()/', $filters );
			if ( ! $has_raw && ! $has_escape ) {
				$filters = \array_merge( $filters, [ 'escape' ] );
			}
		} else {
			$filters = [ 'escape' ];
		}

		foreach ( $filters as $expression ) {
			$name = \trim( \explode( '(', $expression )[0] );

			// skip the `raw` filter
			if ( 'raw' === $name ) continue;

			$callback = $this->get_filter( $name );
			$matches = null;
			$has_arguments = \preg_match( '/\(.*?\)/', $expression, $matches );
			$arguments = [];

			if ( $has_arguments > 0 ) {
				// get the value between '(' and ')'
				$values = \preg_replace('/(^\(|\)$)/', '', $matches[0] );
				// remove breaklines
				$values = \str_replace( [ "\n", "\r" ], '', $values );

				// separate by comma
				$argument_values = \str_getcsv( $values, ',', '"' );

				foreach ( $argument_values as $arg ) {
					$arg = \preg_replace('/(^"|"$)/', '', $arg );
					$arguments[] = $arg;
				}
			}
			$value = \call_user_func( $callback, $value, $arguments );
		}

		return $value;
	}

	public function get_filter ( $name ) {
		$result = null;
		$ctx = $this->current_context;
		$filters = $this->get_context_filters( $ctx );

		if ( isset( $filters ) && isset( $filters[ $name ] ) ) {
			return $filters[ $name ];
		}
		elseif ( isset( $this->native_filters[ $name ] ) ) {
			return $this->native_filters[ $name ];
		}

		throw new InvalidArgumentException( "unexpected `$name` filter in `$ctx` context" );
	}

	public function register_filter ( $name, $callback, $context = null ) {
		$name = \trim( $name );

		if ( null === $context ) {
			$context = self::ROOT_CONTEXT;
		}

		if ( ! isset( $this->custom_filters[ $context ] ) ) {
			$this->custom_filters[ $context ] = [];
		}

		$this->custom_filters[ $context ][ $name ] = $callback;
	}

	public function set_context ( $context ) {
		$this->current_context = $context;
	}

	public function reset_context () {
		$this->current_context = 'root';
	}
	
	public function load ( $extension ) {
		$filters = $extension();
		
		if ( ! is_array( $filters ) ) {
			throw new Exception( 'The first argument should return a function that returns a array' );
		}
		
		foreach ( $filters as $name => $callback ) {
			$this->native_filters[ $name ] = $callback;
		}
	}

	public function get_default_filters () {
		$dir = __DIR__ . '/../filters/';
		$files = \scandir( $dir );
		$engine = $this;
		$filters = [];

		unset( $files[ array_search( '.', $files, true ) ] );
		unset( $files[ array_search( '..', $files, true ) ] );

		foreach ( $files as $file ) {
			$name = str_replace( '.php', '', $file );
			$callback = include $dir . $file;
			$filters[ $name ] = $callback;
		}
		
		return $filters;
	}
	
	protected function get_context_filters ( $ctx ) {
		return isset( $this->custom_filters[ $ctx ] ) ? $this->custom_filters[ $ctx ] : null;
	}
}
