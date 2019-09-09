<?php

// Escape $value
return function ( $value, $args ) {
	return \htmlspecialchars( $value, ENT_QUOTES );
};
