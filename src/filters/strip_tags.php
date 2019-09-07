<?php

// Remove <script> and <style> tags
return function ( $value, $args ) {
	$value = _v_strip_evil_tags( $value );
	return strip_tags( $value );
};
