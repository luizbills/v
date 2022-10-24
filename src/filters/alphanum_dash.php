<?php

return function ( $value, $args ) {
	return preg_replace( "/[^-_0-9\pL]/u", '', $value );
};
