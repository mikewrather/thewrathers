<?php
/**
 * Template for displaying posts in the post, default style.
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?>>
	<?php if ( is_single() ) : ?>
		<div class="title-holder">
			<?php the_title( '<h1 class="post-title">', '</h1>' ); ?>
			<?php merit_post_meta(); ?>
		</div>
	<?php endif; ?>

	<?php if ( ! is_single() ) : ?>
		<div class="thumbnail">
			<?php
			// Get featured image
			if ( has_post_thumbnail() ) {
				the_post_thumbnail('large-thumb');
			} else {
				echo '<img src="http://placehold.it/600x375/&text=No+Thumbnail" alt="" />';
			}
			?>
		</div>
	<?php endif; ?>

	<?php if ( is_single() ) : ?>
		<div class="content-holder">
			<div class="post-detail">
				<?php
					the_content();
					wp_link_pages( array( 'before' => '<p class="page-links"><span class="page-links-title">' . __( 'Pages:', 'merit' ) . '</span>', 'after' => '</p>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
				?>
			</div>
	
			<?php the_tags(__('<p class="tags">Tags: ', 'merit'), ', ', '<p/>'); ?>
		</div>
	<?php else : ?>
		<div class="post-wrapper">
			<div class="post-content">
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<?php merit_post_meta(); ?>
				<?php the_excerpt(); ?>
			</div>
		</div>
	<?php endif; ?>
</article>