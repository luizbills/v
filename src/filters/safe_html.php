<?php

// Remove <script> and <style> tags
return function ( $value, $args ) {
	return _v_strip_evil_tags( $value );
};
