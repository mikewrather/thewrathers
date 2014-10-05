<?php
/*
Plugin Name: Merit Plugin
Plugin URI: http://www.themewarrior.com
Description: Plugin for Merit WordPress theme
Version: 1.0.0
Author: ThemeWarrior
Author URI: http://www.themewarrior.com
License: GPL
*/


// Theme Localization
load_plugin_textdomain( 'merit', false, dirname( plugin_basename( __FILE__ ) ) . '/lang' );

// Slideshow Custom Post Type
add_action('init', 'merit_slideshows_register');
 
function merit_slideshows_register() {
	$labels = array(
		'name' => __('Slideshows', 'merit'),
		'singular_name' => __('Slideshow', 'merit'),
		'add_new' => __('Add New', 'merit'),
		'add_new_item' => __('Add New Slideshow', 'merit'),
		'edit_item' => __('Edit Slideshow', 'merit'),
		'new_item' => __('New Slideshow', 'merit'),
		'view_item' => __('View Slideshow', 'merit'),
		'search_items' => __('Search Slideshow', 'merit'),
		'not_found' =>  __('Nothing found', 'merit'),
		'not_found_in_trash' => __('Nothing found in Trash', 'merit'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'slideshow', 'with_front' => true ),
		'capability_type' => 'page',
		'hierarchical' => false,
		'menu_position' => 30,
		'supports' => array('title','author','thumbnail')
	  ); 
 
	register_post_type( 'slideshow' , $args );
}


// Gallery Custom Post Type
add_action('init', 'merit_gallery_register');
 
function merit_gallery_register() {
	$labels = array(
		'name' => __('Gallery', 'merit'),
		'singular_name' => __('Gallery', 'merit'),
		'add_new' => __('Add New', 'merit'),
		'add_new_item' => __('Add New Gallery', 'merit'),
		'edit_item' => __('Edit Gallery', 'merit'),
		'new_item' => __('New Gallery', 'merit'),
		'view_item' => __('View Gallery', 'merit'),
		'search_items' => __('Search Gallery', 'merit'),
		'not_found' =>  __('Nothing found', 'merit'),
		'not_found_in_trash' => __('Nothing found in Trash', 'merit'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'gallery', 'with_front' => false ),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 30,
		'taxonomies' => array('gallery_type'),
		'supports' => array('title','editor','author','thumbnail')
	  ); 
 
	register_post_type( 'gallery' , $args );
}

// Custom Taxonomy
add_action( 'init', 'merit_gallery_taxonomies', 0 );

function merit_gallery_taxonomies() {	
	register_taxonomy('gallery_type', 'gallery', array( 'hierarchical' => true, 'label' => __('Gallery Categories', 'merit'), 'show_ui' => true, 'query_var' => true, 'rewrite' => array('slug' => 'gallery-type'), 'singular_label' => __('Gallery Category', 'merit')) );
}


// Event Custom Post Type
add_action('init', 'merit_event_register');
 
function merit_event_register() {
	$labels = array(
		'name' => __('Events', 'merit'),
		'singular_name' => __('Event', 'merit'),
		'add_new' => __('Add New', 'merit'),
		'add_new_item' => __('Add New Event', 'merit'),
		'edit_item' => __('Edit Event', 'merit'),
		'new_item' => __('New Event', 'merit'),
		'view_item' => __('View Event', 'merit'),
		'search_items' => __('Search Event', 'merit'),
		'not_found' =>  __('Nothing found', 'merit'),
		'not_found_in_trash' => __('Nothing found in Trash', 'merit'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'event', 'with_front' => true ),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 30,
		'supports' => array('title','editor','author','thumbnail')
	  ); 
 
	register_post_type( 'event' , $args );
}

// Event Custom Post Type
add_action('init', 'merit_accommodation_register');

function merit_accommodation_register() {
    $labels = array(
        'name' => __('Accommodations', 'merit'),
        'singular_name' => __('Accommodation', 'merit'),
        'add_new' => __('Add New', 'merit'),
        'add_new_item' => __('Add New Accommodation', 'merit'),
        'edit_item' => __('Edit Accommodation', 'merit'),
        'new_item' => __('New Accommodation', 'merit'),
        'view_item' => __('View Accommodation', 'merit'),
        'search_items' => __('Search Accommodation', 'merit'),
        'not_found' =>  __('Nothing found', 'merit'),
        'not_found_in_trash' => __('Nothing found in Trash', 'merit'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'accommodation', 'with_front' => true ),
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 30,
        'supports' => array('title','editor','author','thumbnail')
    );

    register_post_type( 'accommodation' , $args );
}


// Testimonial Custom Post Type
add_action('init', 'merit_testimonial_register');
 
function merit_testimonial_register() {
	$labels = array(
		'name' => __('Testimonials', 'merit'),
		'singular_name' => __('Testimonial', 'merit'),
		'add_new' => __('Add New', 'merit'),
		'add_new_item' => __('Add New Testimonial', 'merit'),
		'edit_item' => __('Edit Testimonial', 'merit'),
		'new_item' => __('New Testimonial', 'merit'),
		'view_item' => __('View Testimonial', 'merit'),
		'search_items' => __('Search Testimonial', 'merit'),
		'not_found' =>  __('Nothing found', 'merit'),
		'not_found_in_trash' => __('Nothing found in Trash', 'merit'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'testimonial', 'with_front' => true ),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 30,
		'supports' => array('title','author','thumbnail')
	  ); 
 
	register_post_type( 'testimonial' , $args );
}


// History Custom Post Type
add_action('init', 'merit_history_register');
 
function merit_history_register() {
	$labels = array(
		'name' => __('History', 'merit'),
		'singular_name' => __('History', 'merit'),
		'add_new' => __('Add New', 'merit'),
		'add_new_item' => __('Add New History', 'merit'),
		'edit_item' => __('Edit History', 'merit'),
		'new_item' => __('New History', 'merit'),
		'view_item' => __('View History', 'merit'),
		'search_items' => __('Search History', 'merit'),
		'not_found' =>  __('Nothing found', 'merit'),
		'not_found_in_trash' => __('Nothing found in Trash', 'merit'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'history', 'with_front' => true ),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 30,
		'supports' => array('title','author','thumbnail')
	  ); 
 
	register_post_type( 'history' , $args );
}
