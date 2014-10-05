<?php
/**
 * Template for displaying single posts.
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
?>

<?php get_header(); ?>

<div class="page-title">
	<h1><?php _e('Blog', 'merit') ?></h1>
</div>
		
<div class="container">
	<?php get_template_part( 'includes/breadcrumb' ); // display breadcrumb ?>

	<div class="content">
		<div id="left-content">
			<?php
			while ( have_posts() ) {
				the_post();
				get_template_part( 'content' );
				comments_template( '', true );
			}
			?>
		</div>
		<?php get_sidebar(); ?>
		<div class="clearfix"></div>
	</div>
</div>

<?php get_footer(); ?>