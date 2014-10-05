<?php
/**
 * Function to register widget areas
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
if ( ! function_exists( 'warrior_register_sidebars' ) ) {
	function warrior_register_sidebars(){
		if ( function_exists('register_sidebar') ) {

			// Sidebar Widget
			register_sidebar(array(
				'name' 			=> __('Sidebar', 'merit'),
				'before_widget'	=> '<div id="widget-%1$s" class="block %2$s">',
				'after_widget' 	=> '</div>',
				'before_title' 	=> '<h3 class="sidebar-heading">',
				'after_title' 	=> '</h3>',
			));

			// Homepage Widget
			register_sidebar(array(
				'name' 			=> __('Homepage', 'merit'),
				'before_widget' => '<section id="widget-%1$s" class="home-widget %2$s clearfix">',
				'after_widget' 	=> '</section>',
				'before_title' 	=> '<h2 class="section-title">',
				'after_title' 	=> '</h2>',
			));

		}
	}
}


/**
 * Function to remove default widgets after theme switch
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
if ( ! function_exists( 'warrior_removed_default_widgets' ) ) {
	function warrior_removed_default_widgets(){
		global $wp_registered_sidebars;
		$widgets = get_option('sidebars_widgets');
		foreach ($wp_registered_sidebars as $sidebar=>$value) {
			unset($widgets[$sidebar]);
		}
		update_option('sidebars_widgets', $widgets);
	}
}

if ( is_admin() && $pagenow == 'themes.php' && isset($_GET['activated'] ) )
	add_action( 'admin_init', 'warrior_removed_default_widgets' );

// Load Custom Widgets
include_once( get_template_directory() . '/includes/widgets/warrior-about-couple.php' );
include_once( get_template_directory() . '/includes/widgets/warrior-couple-tweets.php' );
include_once( get_template_directory() . '/includes/widgets/warrior-blog.php' );
include_once( get_template_directory() . '/includes/widgets/warrior-events.php' );
include_once( get_template_directory() . '/includes/widgets/warrior-accommodations.php' );
include_once( get_template_directory() . '/includes/widgets/warrior-testimonial.php' );
include_once( get_template_directory() . '/includes/widgets/warrior-countdown.php' );
include_once( get_template_directory() . '/includes/widgets/warrior-gallery.php' );
include_once( get_template_directory() . '/includes/widgets/warrior-rsvp.php' );
include_once( get_template_directory() . '/includes/widgets/warrior-map.php' );
