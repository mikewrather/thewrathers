<?php
/**
 * Template Name: Full Width
 * 
 * Template for displaying Page post type, without sidebar.
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
		<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?>>
			<?php
				while ( have_posts() ) {
					the_post();
					the_content();
					wp_link_pages( array( 'before' => '<p class="page-links"><span class="page-links-title">' . __( 'Pages:', 'merit' ) . '</span>', 'after' => '</p>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
				}
			?>
		</article>
		<?php comments_template( '', true ); ?>
	</div>
</div>

<?php get_footer(); ?>