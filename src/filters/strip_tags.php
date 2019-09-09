<?php

// Remove <script> and <style> tags
return function ( $value, $args ) {
	return \strip_tags( \v( $value, 'raw', 'safe_html' ) );
};
