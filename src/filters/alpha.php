<?php

// Remove all non-alphabetic characters
return function ( $value, $args ) {
	return preg_replace( "/[^\pL]/u", '', $value );
};
