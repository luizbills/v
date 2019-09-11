<?php

describe( 'functions', function() {
	describe( 'v', function () {
		it( 'shoulds escape any html code by default', function() {
			$current = v( '<p>' );
			$expected = '&lt;p&gt;';
			expect( $current )->toBe( $expected );
		} );

		it( 'shoulds not escape by default if the "raw" filter has been passed', function() {
			$current = v( '<p>', 'raw' );
			$expected = '<p>';
			expect( $current )->toBe( $expected );
		} );

		it( 'shoulds escape if the "escape" filter has been passed', function() {
			$current = v( '<p>', 'raw', 'escape' );
			$expected = '&lt;p&gt;';
			expect( $current )->toBe( $expected );
		} );

		it( 'shoulds accept several arguments', function() {
			$current = v( '  <p>  ', 'trim', 'upper', 'raw' );
			$expected = '<P>';
			expect( $current )->toBe( $expected );
		} );
	} );

	describe( 'v_register_filter', function () {
		it( 'shoulds register a new filter', function() {
			v_register_filter( 'new', function ( $value, $args ) {
				return $value . 'works';
			});

			$current = v( '', 'new' );
			$expected = 'works';
			expect( $current )->toBe( $expected );
		} );

		it( 'shoulds can overrides a existing filter', function() {
			$current = v( 'test', 'capitalize' );
			$expected = 'Test';
			expect( $current )->toBe( $expected );

			// new capitalize filter
			v_register_filter( 'capitalize', function ( $value, $args ) {
				return 'overwritten';
			});

			$current = v( '', 'capitalize' );
			$expected = 'overwritten';
			expect( $current )->toBe( $expected );
		} );
	} );
} );