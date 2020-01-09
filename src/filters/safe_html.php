<?php

// Remove <script> and <style> tags
return function ( $value, $args ) {
	// remove iframe and link tags
	$value = \preg_replace( '/<(iframe|link)[^>]*?>/si', '', (string) $value );
	// remove script and style tags
	$value = \preg_replace( '/<(script|style)[^>]*?>.*?<\/\\1>/si', '', (string) $value );
	$value = \preg_replace( '/<(script|style)[^>]*?>/si', '', (string) $value );

	return $value;
};
