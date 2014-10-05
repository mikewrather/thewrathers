<?php
/**
 * Template Name: Events
 * 
 * Template for displaying posts in the Event post type.
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
?>

<?php get_header(); ?>

	<div class="page-title">
		<h1><?php the_title(); ?></h1>
	</div>
	
	<div class="container">
		<?php get_template_part( 'includes/breadcrumb' ); // display breadcrumb ?>
			
		<div class="full-width-content events-grid">
			<div class="post-grid">
				<?php
				if ( get_query_var('paged') ) {
					$paged = get_query_var('paged');
				} elseif ( get_query_var('page') ) {
					$paged = get_query_var('page');
				} else {
					$paged = 1;
				}

				$args = array(
					'post_type' => 'event',
					'post_status' => 'publish', 
					'paged' => $paged
				);

				$wp_query = new WP_Query();
				$wp_query->query($args);

				if ( $wp_query->have_posts() ) {
					while( $wp_query->have_posts() ) {
						$wp_query->the_post();
						get_template_part( 'content', 'event' );
					}
					get_template_part( 'includes/pagination' );
				}
				?>
			</div>
		</div>
	</div>

<?php get_footer(); ?>