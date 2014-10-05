<?php
/**
 * Template for displaying single posts in the Accommodation post type.
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
?>

<?php get_header(); ?>

	<div class="page-title">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</div>
			
	<div class="container">
		<?php get_template_part( 'includes/breadcrumb' ); // display breadcrumb ?>

		<div class="full-width-content">
			<?php
			while ( have_posts() ) {
				the_post();
				get_template_part( 'content', 'accommodation' );
			}
			?>
		</div>
	</div>

<?php get_footer(); ?>