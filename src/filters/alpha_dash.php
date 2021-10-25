<?php

return function ( $value, $args ) {
	return preg_replace( "/[^-_\pL]/u", '', $value );
};
