<?php

// Remove <script> and <style> tags
return function ( $value, $args ) {
	// remove iframe and link tags
	$value = \preg_replace( '/<(iframe|link)[^>]*?>/si', '', $value );
	// remove script and style tags
	return \preg_replace( '/<(script|style)[^>]*?>.*?<\/\\1>/si', '', $value );
};
