<?php

return function ( $value, $args ) {
	return preg_replace( "/[^0-9\pL]/u", '', $value );
};
