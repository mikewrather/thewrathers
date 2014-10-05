<?php
/**
* List of theme support functions
*/


// Check if the function exist
if ( function_exists( 'add_theme_support' ) ) {
	// Add post thumbnail feature
	add_theme_support( 'post-thumbnails' );
	add_image_size('xsmall-thumb', 70, 70, true); // extra small thumb
	add_image_size('small-thumb', 320, 200, true); // small thumb
	add_image_size('medium-thumb', 430, 270, true); // medium thumb
	add_image_size('large-thumb', 600, 375, true); // large thumb
	add_image_size('xlarge-thumb', 1200, 600, true); // extra large thumb
	add_image_size('event-thumb', 375, 250, true); // event thumb
	add_image_size('testimonial-photo', 130, 130, true); // testimonial photo
	
	// Add WordPress navigation menus
	add_theme_support('nav-menus');
	register_nav_menus( array(
		'main-menu' => __( 'Main Menu', 'merit' ),
	) );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Add custom background feature 
	add_theme_support( 'custom-background' );
}


/**
 * Function to enable localization
 * Text domain is set to to theme name in lower case
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
if( ! function_exists('warrior_localization') ) {
	function warrior_localization(){
	    load_theme_textdomain('merit', get_template_directory() . '/lang');
	}
}
add_action('after_setup_theme', 'warrior_localization');


// Set maximum image width displayed in a single post or page
if ( ! isset( $content_width ) ) {
	$content_width = 620;
}