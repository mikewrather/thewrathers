<?php
/**
 * Template for displaying header part.
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
?>
<?php global $merit_option; ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title('|',true,''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable = yes" >
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!-- Start: Loading Spinner -->
<div id="spinner">
	<div class="spinner">
		<div class="double-bounce1"></div>
		<div class="double-bounce2"></div>
	</div>
</div>
<!-- End: Loading Spinner -->

<div id="main-wrapper">
    <!-- Start: Header -->
    <header id="main-header">
		<?php if( is_home() || is_front_page() ) : ?>
	        <!-- Start: Slider -->
			<div id="logo">
				<?php merit_logo(); ?>
				<?php if( !empty($merit_option['wedding_date']) ) { ?>
				<div class="text"><?php _e('Are Getting Married', 'merit'); ?></div>
				<span class="wedding-date"><?php echo date('F d, Y', strtotime( $merit_option['wedding_date'] ) ); ?></span>
				<?php } ?>
			</div>

			<div id="home-sliders">
				<div class="slides-container">
					<?php
					// Let's fetch the slideshow images
					$args = array(
						'post_type' => 'slideshow',
						'post_status' => 'publish',
						'posts_per_page' => -1
					);
					
					$slideshow_query = new WP_Query();
					$slideshow_query->query($args);

					if ( $slideshow_query->have_posts() ) {
						while( $slideshow_query->have_posts() ) {
							$slideshow_query->the_post();

							if ( has_post_thumbnail()) {
								$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
								echo '<img src="'. $large_image_url[0] .'" alt="" />';
							}
						}
					}
					wp_reset_postdata();
					?>
				</div>
			</div>
			<!-- End: Slider -->

	        <!-- Start: Navigation -->
	        <nav id="main-menu">
				<?php
				if ( has_nav_menu( 'main-menu' ) )
					wp_nav_menu( array ( 'theme_location' => 'main-menu', 'container' => null, 'menu_class' => 'main', 'depth' => 3 ) );
				?>
	        </nav>
	        <!-- End: Navigation -->
	    <?php else: ?>
	        <!-- Start: Navigation -->
	        <nav id="main-menu" class="not-home">
				<?php
				if ( has_nav_menu( 'main-menu' ) )
					wp_nav_menu( array ( 'theme_location' => 'main-menu', 'container' => null, 'menu_class' => 'main', 'depth' => 3 ) );
				?>
	        </nav>
	        <!-- End: Navigation -->
    	<?php endif; ?>
    </header>
    <!-- End: Header -->

    <!-- Start: Main Content -->
	<?php if ( is_page_template('page-gallery.php') || is_page_template('page-home.php') || is_tax('gallery_type') ) : ?>
		<div id="main-content">
	<?php else : ?>
		<?php if ( is_page_template('page-history.php') ) : ?>
			<div id="main-content" class="<?php merit_content_class(); ?>" data-stellar-background-ratio="0.1">
		<?php else : ?>
			<div id="main-content" class="<?php merit_content_class(); ?>">
		<?php endif; ?>
	<?php endif; ?>
	