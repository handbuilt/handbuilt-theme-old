<?php

/**
 * Hand Built is always the theme
 */
$environment_defined_theme = function() {
	return 'hand-built';
};

add_filter( 'template', $environment_defined_theme );
add_filter( 'stylesheet', $environment_defined_theme );
