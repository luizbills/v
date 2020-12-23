<img src="https://i.postimg.cc/rw3HtgB8/v-logo.png" alt="project logo" width="200"/>

# v

[![Latest Stable Version](https://poser.pugx.org/luizbills/v/v/stable)](https://packagist.org/packages/luizbills/v)
[![Build Status](https://travis-ci.org/luizbills/v.svg?branch=master)](https://travis-ci.org/luizbills/v)
[![License](https://poser.pugx.org/luizbills/v/license)](https://packagist.org/packages/luizbills/v)

Simple variable filter and formatter pipe

## Requirements

- PHP 7.1+
- mbstring extension

## Install

```
composer require luizbills/v --prefer-dist
```

## Usage

Use the `v($value, ...$filters)` function to filter your template values.

```php
?>
Name: <?= v( 'luiz', 'upper' ) ?> <!-- Name: LUIZ -->
```

## Features

- By default, all values are escaped.

```php
<?php

// escape by default
echo v( '<p>hello</p>' ); // => &lt;p&gt;hello&lt;/p&gt;

// same as
echo v( '<p>hello</p>', 'escape' ); // => &lt;p&gt;hello&lt;/p&gt;

// or you can strip all tags
echo v( '<p>hello</p>', 'strip_tags' ); // => hello

// or strip only "evil" tags: <script>, <style>, <iframe> and <link>
echo v( '<p>hello</p><script>evilFunc();</script>', 'safe_html' ); // => &lt;p&gt;hello&lt;/p&gt;

// and to disable autoescaping, use the `raw` filter
echo v( '<p>hello</p>', 'raw' ); // => <p>hello</p>
```

- The filter arguments has optional string quoting.

```php
<?php
// you can do like this
echo v( 1567973782, 'date("d/m/Y")' ); // => 08/09/2019

// or like this (without double-quotes)
echo v( 1567973782, 'date(d/m/Y)' ); // => 08/09/2019

// Note: always use double-quotes if you need whitespaces in your argument,
// otherwise they will be deleted (with `trim`).
```

- Several [built-in filters](src/filters).

- Create your own filters!

```php
<?php
function repeat_callback ( $value, $args ) {
	$times = (int) $args->get( 0 ); // get the first argument
	return str_repeat( $value, $times );
}
v_register_filter( 'repeat', 'repeat_callback' );

function exclaim_callback ( $value, $args ) {
	return $value . '!';
}
v_register_filter( 'exclaim', 'exclaim_callback' );

echo v( 'Ha', 'repeat(5)', 'exclaim' ); // => HaHaHaHaHa!

// you can also overwrite the built-in filters

// default `date` filter
echo v( 1567973782, 'date("Y")' ); // => 2019

// custom `date` filter
function my_date_callback ( $value, $args ) {
	$format = $args->get( 0 );
	return 'date: ' . date( $format, $value );
}
v_register_filter( 'date', 'my_date_callback' );

echo v( 1567973782, 'date("Y")' ); // => date: 2019
```

- Or just use any function

```php
// inline function
$upper = function ( $value ) {
	return strtoupper( $value );
}
echo v( 'ok', $upper ); // => OK

// or global functions (add an @ before)
echo v( 'ok', '@strtoupper' ); // => OK

// or methods
echo v( 'ok', [ 'MyClass', 'my_method' ] );
```

- *Context setter* to avoid conflicts with another applications/modules/plugins that are also using this library.

```php
<?php
// The `v_register_filter` accepts an optional third argument called 'context'.
// Note: the default context is 'root'.

function exclaim_callback_v1 ( $value, $args ) {
	return $value . '!';
}
v_register_filter( 'exclaim', 'exclaim_callback_v1' ); // context = "root"

function exclaim_callback_v2 ( $value, $args ) {
	return $value . '!!!!!';
}
v_register_filter( 'exclaim', 'exclaim_callback_v2', 'v2' ); // context = "v2"

echo v( 'foo', 'exclaim' ); // => foo!

// change the context to "v2"
v_set_context( 'v2' );
echo v( 'foo', 'exclaim' ); // => foo!!!!!

// reset the context
v_reset_context(); // same as: v_set_context( 'root' );
echo v( 'foo', 'exclaim' ); // => foo!

// note: all built-in (or default) filters are available in any context
```

- Extendable. Use the `v_load_extension` to override or implement more **default filters** (filters that will be available in any context).

```php
<?php
// this function accepts an Array, where each key is a filter
v_load_extension( [
	// `exclaim` is now a default filter
	'exclaim' => function ( $value, $args ) {
		return $value . '!';
	}
] );
```

- Debug easily!

```php
<?php
// use the `log` filter to log the current value with error_log function
echo v( 'hello', 'upper', 'log' );
// => logs: [v log] (string) "HELLO"

// You can also pass a ID to log filter, this help you identify outputs
echo v( 'hello', 'log(before upper)', 'upper' );
// => logs: [v log @ before upper] (string) "hello"

```

## LICENSE

MIT
