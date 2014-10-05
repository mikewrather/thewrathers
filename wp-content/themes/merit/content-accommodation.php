<?php
/**
 * Template for displaying posts in the accommodation post type.
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
?>

<?php if ( ! is_single() ) : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="post-content">
			<div class="thumbnail">
				<div class="view effect">
					<?php
					// Let's get the featured image
					if ( has_post_thumbnail() ) {
						the_post_thumbnail('accommodation-thumb');
					} else {
						echo '<img src="http://placehold.it/375x250/&text=No+Thumbnail" alt="" />';
					}
					?>
					<div class="mask"></div>
				</div>
			</div>
			
			<div class="post-wrapper">
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), 5, '...' ); ?></a></h2>

				<p><?php echo wp_trim_words( get_the_excerpt(), 25, '...'); ?></p>
				
				<div class="meta">
					<?php
					// Get field object
					$field = get_field_object('accommodation_access');
					$value = get_field('accommodation_access');
					?>

					<span class="location"><i class="fa fa-home"></i> <?php echo get_field('accommodation_location'); ?></span>

				</div>
			</div>
		</div>
	</article>
<?php endif; ?>


<?php if ( is_single() ) : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'accommodation-post'); ?>>
		<div class="meta">
			<?php
			// Get field object
			$field = get_field_object('accommodation_access');
			$value = get_field('accommodation_access');
			?>

            <span class="location"><i class="fa fa-home"></i> <?php echo wp_trim_words(get_field('accommodation_location'),50,'...'); ?></span><br/><br />
            <span class="location"><i class="fa fa-phone"></i> <?php echo get_field('phone_number'); ?></span><br /><br />
            <span class="location"><i class="fa fa-globe"></i><a href="<?php echo get_field('website'); ?>"><?php echo wp_trim_words( get_the_title(), 5, '...' ); ?> website</a></span>

        </div>
		
		<div class="content-holder">
			<div class="post-detail">
				<?php the_content(); ?>
			</div>
		
			<h3 class="title"><?php _e('Where it\'s at', 'merit'); ?></h3>
			<div id="map-wrapper" data-map-name="<?php the_title(); ?>" data-map-address="<?php the_field('accommodation_location'); ?>" data-map-image="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>" data-map-lat="" data-map-lng="" data-map-zoom="16"></div>

		</div>
	</article>
<?php endif; ?>