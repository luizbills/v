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

		foreach ( $filters as $full_expression ) {
			$parts = \explode( '(', trim( $full_expression ) );
			$name = \array_shift( $parts );

			// skip the `raw` filter
			if ( 'raw' === $name ) continue;

			$callback = $this->get_filter( $name );
			$expression_arguments = count( $parts ) > 0 ? '(' . implode( '(', $parts ) : '';
			$arguments = $this->parse_arguments( $expression_arguments );
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

		throw new \InvalidArgumentException( "Unexpected `$name` filter in `$ctx` context" );
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
			throw new \InvalidArgumentException( 'The first argument should return a function that returns a array' );
		}

		foreach ( $filters as $name => $callback ) {
			$this->native_filters[ $name ] = $callback;
		}
	}

	protected function get_default_filters () {
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

	protected function parse_arguments ( $expression_arguments ) {
		if ( '' != $expression_arguments ) {
			if ( $expression_arguments[0] != '(' || $expression_arguments[-1] != ')' ) {
				throw new \RuntimeException( "Invalid filter arguments expression" );
			}

			// get the value between '(' and ')'
			$values = \preg_replace('/(^\(|\)$)/', '', $expression_arguments );

			// remove breaklines
			$values = \str_replace( [ "\n", "\r" ], '', $values );

			// remove whitespaces after quotes
			$values = \preg_replace( '/\s+,/', ',', $values );

			// replace escaped quotes
			$quote_placeholder = '{' . md5( time() ). '}';
			$values = \preg_replace( '/\\\"/', $quote_placeholder, $values );

			// check for unclosed quotes
			\preg_match_all( '/"/', $values, $matches );
			// the quantity of quotes should be an even number
			if ( count( $matches[0] ) % 2 ) {
				throw new \RuntimeException( "Unclosed string in filter arguments" );
			}

			// parse arguments as CSV line
			$values = \str_getcsv( $values, ',', '"' );
			// restore the escaped commas
			foreach ( $values as $key => $value) {
				$values[ $key ] =  \str_replace( $quote_placeholder, '"', $values[ $key ] );
			}

			return $values;
		}
		return [];
	}

	protected function get_context_filters ( $ctx ) {
		return isset( $this->custom_filters[ $ctx ] ) ? $this->custom_filters[ $ctx ] : null;
	}
}
