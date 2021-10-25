<?php

return function ( $value, $args ) {
	return preg_replace( "/[^\s\pL]/u", '', $value );
};
