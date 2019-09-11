<?php

use luizbills\v\Engine;

describe( 'Engine', function() {
	beforeAll( function () {
		$this->engine = Engine::get_instance();
	} );

	it( 'is a Singleton', function() {
		$current = $this->engine;
		$expected = Engine::get_instance();
		expect( $current )->toBe( $expected );
	} );
} );