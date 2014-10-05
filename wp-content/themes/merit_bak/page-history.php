<?php
/**
 * Template Name: History
 * 
 * Template for displaying posts in the History post type.
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
		<div class="full-width-content timeline">
			<?php
				$args = array(
					'post_type' => 'history',
					'post_status' => 'publish', 
					'orderby' => 'meta_value',
					'order' => 'ASC',
					'posts_per_page' => -1,
					'meta_key' => 'history_date'
				);
				$wp_query = new WP_Query();
				$wp_query->query($args);
				if ( $wp_query->have_posts() ) :
					echo '<ul class="clearfix">';
					$i = 1;
					while( $wp_query->have_posts() ) :
						$wp_query->the_post();
						echo '<li class="' . ( $i%2 != 0 ? 'odd' : 'even' ) . '">';
						get_template_part( 'content', 'history' );
						echo '</li>';
						$i = $i + 1;
					endwhile;
					echo '</ul>';
				endif;
			?>
		</div>
	</div>

<?php get_footer(); ?>