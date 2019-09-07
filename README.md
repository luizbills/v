# v

Simple variable filter pipe

## Requirements

- PHP 7+
- `mbstring` extension

## Install

```
composer require luizbills/v
```

## Usage

Use the `v(value, ...filters)` function to filter your template values.

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
echo v( '<p>hello</p>', 'strip_tags' ); // => &lt;p&gt;hello&lt;/p&gt;

// or only strip evil tags: <script>, <style>, <iframe> and <link>
echo v( '<p>hello</p><script>evil_func();</script>', 'safe_html' ); // => &lt;p&gt;hello&lt;/p&gt;

// and to not escape, use the `raw` filter
echo v( '<p>hello</p><script>evil_func();</script>', 'safe_html', 'raw' ); // => <p>hello</p>
```

- Several [built-in filters](src/filters).

- Create your own filters!

```php
<?php

function repeat_callback ( $value, $args ) {
	$n = (int) $args[0];
	return str_repeat( $value, $n );
}
v_register_filter( 'repeat', 'repeat_callback' );

function exclaim_callback ( $value, $args ) {
	return $value . '!';
}
v_register_filter( 'exclaim', 'exclaim_callback' );

echo v( 'Ha', 'repeat(5)', 'exclaim' ); // => HaHaHaHaHa!

// you can also overwrite the built-in filters

// default `length` filter
echo v( 'hello', 'length' ); // => 5

function my_length_callback ( $value, $args ) {
	return 'length of ' . $value . ' is ' . strlen( $value );
}
v_register_filter( 'length', 'my_length_callback' );

// custom length
echo v( 'hello', 'length' ); // => length of hello is 5
```

- Avoid conflicts with another applications/modules/plugins that are also using this library.

```php
<?php
// The `v_register_filter` accepts an optional third argument called 'context'.
// Note: the default context is 'root'.

// follow this example
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

// note: all built-in filters are available in any context
```

- Debug easily!

```php
<?php
// use the `log` filter to log the current value with error_log function
echo v( 'hello', 'upper', 'log' );
// => logs: [v log filter output] HELLO

// You can also pass a ID to log filter, this help you identify outputs
echo v( 'hello', 'log(before upper)', 'upper' );
// => logs: [v log filter output] hello (ID: before upper)

```

## LICENSE

MIT
