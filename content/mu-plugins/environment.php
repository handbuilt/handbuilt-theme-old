<?php

/**
 * Hand Built is always the theme
 */
$environment_defined_theme = function() {
	return 'hand-built';
};

add_filter( 'template', $environment_defined_theme );
add_filter( 'stylesheet', $environment_defined_theme );

add_filter( 'pre_option_blogname', function() {
	return 'Hand Built';
});

add_filter( 'pre_option_blogdescription', function(){
	return 'Custom WordPress development, code review, data migrations, and consulting services from Daniel Bachhuber.';
});