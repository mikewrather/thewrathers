<?php
/**
 * Template for displaying single posts in the Gallery post type.
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
		<div class="full-width-content">

			<?php get_template_part( 'includes/breadcrumb' ); // display breadcrumb ?>
			
			<?php
				while ( have_posts() ) {
					the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?>>
				<?php the_content(); ?>
			</article>
			<?php
				}
			?>
		</div>
	</div>

<?php get_footer(); ?>