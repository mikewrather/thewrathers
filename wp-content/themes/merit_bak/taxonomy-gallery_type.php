<?php
/**
 * Template for displaying taxonomy from gallery_type taxonomy
 * 
 * Template for displaying Gallery post format.
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
?>

<?php get_header(); ?>

	<div class="page-title">
		<?php $term = $wp_query->queried_object; ?>
		<h1><?php echo $term->name; ?></h1>
	</div>
			
	<div class="container">
		<?php
			if ( have_posts() ) {
				echo '<ul class="gallery three-column">';
				while( have_posts() ) {
					the_post();
					get_template_part( 'content', 'gallery' );
				}
				echo '</ul>';
				get_template_part( 'includes/pagination' );
			}
		?>
	</div>

<?php get_footer(); ?>