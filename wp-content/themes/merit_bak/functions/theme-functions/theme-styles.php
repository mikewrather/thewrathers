<?php
/**
 * Function to load JS & CSS files
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */

if ( ! function_exists( 'warrior_enqueue_scripts' ) ) {
	function warrior_enqueue_scripts() {
		global $merit_option;

		// Load all Javascript files
		wp_enqueue_script('jquery');

		if ( is_singular() ) {
			wp_enqueue_script( 'comment-reply' );
		}

		wp_enqueue_script('superfish', get_template_directory_uri() .'/js/superfish.js', '', '1.4.8', true);
		wp_enqueue_script('stellar', get_template_directory_uri() .'/js/jquery.stellar.min.js', '', '0.6.2', true);
		wp_enqueue_script('superslides', get_template_directory_uri() .'/js/jquery.superslides.min.js', '', '0.6.2', true);
		wp_enqueue_script('backstretch', get_template_directory_uri() .'/js/jquery.backstretch.min.js', '', '2.0.4', true);
		wp_enqueue_script('countdown', get_template_directory_uri() .'/js/jquery.countdown.min.js', '', '1.6.3', true);
		wp_enqueue_script('prettyPhoto', get_template_directory_uri() .'/js/jquery.prettyPhoto.js', '', '3.1.5', true);
		wp_enqueue_script('mixitup', get_template_directory_uri() .'/js/jquery.mixitup.min.js', '', '1.5.4', true);
		wp_enqueue_script('flexverticalcenter', get_template_directory_uri() .'/js/jquery.flexverticalcenter.js', '', null, true);
		wp_enqueue_script('mobilemenu', get_template_directory_uri() .'/js/jquery.mobilemenu.js', '', '1.1', true);
		wp_enqueue_script('flexslider', get_template_directory_uri() .'/js/jquery.flexslider-min.js', '', '2.2.2', true);
		wp_enqueue_script('wow', get_template_directory_uri() .'/js/wow.min.js', '', '0.1.6', true);
		wp_enqueue_script('google-maps', 'http://maps.google.com/maps/api/js?sensor=false', '', null, true);
		wp_enqueue_script('functions', get_template_directory_uri() .'/js/functions.js', '', null, true);
			
		// Localize script
		if( !empty($merit_option['wedding_date']) ) {
			$wedding_date_time = $merit_option['wedding_date'] . (!empty($merit_option['wedding_time']) ? $merit_option['wedding_time'] : '00:00');
			$wedding_date_time = date('F, d Y H:i', strtotime( $wedding_date_time ) );
		} else {
			$wedding_date_time = '';
		}

		wp_localize_script('functions', '_warrior', array(
			'countdown_time' => $wedding_date_time,
			'countup_title' => __("We've Been Married For", 'merit'),
			'map_marker_icon' => get_template_directory_uri() . '/images/map-marker.png',
			'map_marker_shadow' => get_template_directory_uri() . '/images/map-marker-shadow.png'
		));

		// Load all CSS files
		wp_enqueue_style('normalize', get_template_directory_uri() .'/css/normalize.css', array(), '3.0.1', 'all');
		wp_enqueue_style('style', get_stylesheet_directory_uri() .'/style.css', array(), null, 'all');
		wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.0.3', 'all' );
		wp_enqueue_style('prettyPhoto', get_template_directory_uri() .'/css/prettyPhoto.css', array(), null, 'all');
		wp_enqueue_style('flexslider', get_template_directory_uri() .'/css/flexslider.css', array(), '2.2.0', 'all');
		wp_enqueue_style('animate', get_template_directory_uri() .'/css/animate.min.css', array(), null, 'all');
		wp_enqueue_style('responsive', get_template_directory_uri() .'/css/responsive.css', array(), null, 'all');

		// Localize script
		if( $merit_option['rtl_support'] == '1' ) {
			wp_enqueue_style('rtl', get_stylesheet_directory_uri() .'/css/rtl.css', array(), null, 'all');
		}

		// Load custom CSS file
		wp_enqueue_style('custom', get_template_directory_uri() .'/custom.css', array(), null, 'screen');
	}
}
add_action( 'wp_enqueue_scripts', 'warrior_enqueue_scripts' );


/**
 * Function to load JS & CSS files on wp-admin
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
if ( ! function_exists( 'warrior_enqueue_scripts_admin' ) ) {
	function warrior_enqueue_scripts_admin() {
		global $merit_option, $pagenow;

		wp_enqueue_style( 'jquery-ui', get_template_directory_uri() .'/css/jquery-ui.css', array(), '1.10.3', 'screen' );
		wp_enqueue_style( 'jquery-ui-timepicker-addon', get_template_directory_uri() .'/css/jquery-ui-timepicker-addon.css', array(), '1.4.3', 'screen' );

		if( $pagenow == 'widgets.php' ) {
			wp_enqueue_media();
			wp_enqueue_script('widget-script', get_template_directory_uri() . '/js/widget-script.js', null, null, true);
		}

		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'timepicker', get_template_directory_uri() . '/js/jquery-ui-timepicker-addon.js', '', '1.4.3', true );
	}
}
add_action( 'admin_enqueue_scripts', 'warrior_enqueue_scripts_admin' );


/**
 * Function to add style & script code on wp-admin
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
if ( ! function_exists( 'warrior_add_scripts_admin' ) ) {
	function warrior_add_scripts_admin() {
		?>
		<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery('#acf-field-event_date').datetimepicker({ dateFormat: "yy/mm/dd", timeFormat: "HH:mm" });
		});
		</script>
		<?php
	}
}
add_action( 'admin_footer', 'warrior_add_scripts_admin' );

/**
 * Function to generate the several styles from theme options
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
if ( ! function_exists( 'warrior_add_styles_theme_options' ) ) {
	function warrior_add_styles_theme_options() {
		global $merit_option;
		?>
		<style type="text/css">
			.home-testimonial .testimonial .text:after {
				border-color: <?php echo $merit_option['testimonial_quote_bubble_bg']['background-color']; ?> transparent !important;
			}
			
			<?php if( get_background_color() ) : ?>
			.page-title:after {
				border-bottom-color: #<?php echo get_background_color(); ?> !important;
			}
			<?php endif; ?>

			nav#main-menu,
			nav#main-menu.not-home {
				opacity: <?php echo $merit_option['menu_bg_opacity']; ?> !important;
				filter: alpha(opacity=<?php echo ($merit_option['menu_bg_opacity'])*100; ?>) !important;
			}
		</style>
		<?php
	}
}
add_action( 'wp_enqueue_scripts', 'warrior_add_styles_theme_options' );