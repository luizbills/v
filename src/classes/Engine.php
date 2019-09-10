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
		$this->load_extension( $this->get_default_filters() );
		$this->reset_context();
	}

	public static function get_instance () : self {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function run_filters ( $value, ...$filters ) {
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
			if ( 'raw' == $name ) continue;

			$callback = $this->get_filter_callback( $name );
			$expression_arguments = count( $parts ) > 0 ? '(' . implode( '(', $parts ) : '';
			$arguments = new Arguments( $expression_arguments );
			$value = \call_user_func( $callback, $value, $arguments );
		}

		return $value;
	}

	public function get_filter_callback ( string $name ) : callable {
		$result = null;
		$ctx = $this->current_context;
		$filters = $this->get_context_filters( $ctx );

		if ( isset( $filters ) && isset( $filters[ $name ] ) ) {
			return $filters[ $name ];
		}
		elseif ( isset( $this->native_filters[ $name ] ) ) {
			return $this->native_filters[ $name ];
		}

		throw new \InvalidArgumentException( __METHOD__ . ": unexpected `$name` filter in `$ctx` context" );
	}

	public function register_filter ( string $name, callable $callback, string $context = '' ) {
		$name = \trim( $name );

		if ( '' === $context ) {
			$context = self::ROOT_CONTEXT;
		}

		if ( ! isset( $this->custom_filters[ $context ] ) ) {
			$this->custom_filters[ $context ] = [];
		}

		$this->custom_filters[ $context ][ $name ] = $callback;
	}

	public function set_context ( string $context ) {
		$this->current_context = $context;
	}

	public function reset_context () {
		$this->current_context = self::ROOT_CONTEXT;
	}

	public function load_extension ( array $filters ) {
		foreach ( $filters as $name => $callback ) {
			$this->native_filters[ $name ] = $callback;
		}
	}

	protected function get_default_filters () : array {
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

	protected function get_context_filters ( string $ctx ) {
		return isset( $this->custom_filters[ $ctx ] ) ? $this->custom_filters[ $ctx ] : null;
	}
}
