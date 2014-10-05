<?php
/**
 * Template for displaying posts in the History post type.
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('timeline-post'); ?>>
	<div class="meta">
		<span class="date"><i class="fa fa-calendar"></i> <?php echo date_i18n( get_option('date_format'), strtotime( get_field('history_date') ) ); ?></span>
		<?php if ( get_field('history_location') ) { ?>
			<span class="location"><i class="fa fa-map-marker"></i> <?php echo get_field('history_location'); ?></span>
		<?php } ?>
	</div>
	<div class="moment">
		<?php if ( has_post_thumbnail() ) : ?> 
		<div class="thumbnail">
			<?php the_post_thumbnail('medium-thumb'); ?>
		</div>
		<?php endif; ?>
		<div class="post-wrapper">
			<?php the_title( '<h3 class="post-title">', '</h3>' ); ?>
			<?php echo wpautop( get_field('history_content') ); ?>
		</div>
	</div>
</article>