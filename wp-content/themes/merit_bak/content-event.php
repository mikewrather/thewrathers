<?php
/**
 * Template for displaying posts in the Event post type.
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
						the_post_thumbnail('event-thumb');
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
					$field = get_field_object('event_access');
					$value = get_field('event_access');
					?>

					<span class="date"><i class="fa fa-calendar"></i> <?php echo date_i18n( get_option('date_format') . ' ' . get_option('time_format'), strtotime( get_field('event_date') ) ); ?></span>

					<?php if( get_field('event_access') ) : // Check if event_access field has value ?>
						<span class="access">
							<?php if( get_field('event_access') == 'invitation') : ?>
								<i class="fa fa-envelope-o"></i>
							<?php elseif( get_field('event_access') == 'public') : ?>
								<i class="fa fa-group"></i>
							<?php else: ?>
								<i class="fa fa-lock"></i> 
							<?php endif; ?>
						
							<?php echo $field['choices'][ $value ]; ?>
						</span>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</article>
<?php endif; ?>


<?php if ( is_single() ) : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'event-post'); ?>>
		<div class="meta">
			<?php
			// Get field object
			$field = get_field_object('event_access');
			$value = get_field('event_access');
			?>

			<span><i class="fa fa-calendar"></i> <?php echo date_i18n( get_option('date_format') . ' ' . get_option('time_format'), strtotime( get_field('event_date') ) ); ?></span>

			<?php if( get_field('event_access') ) : // Check if event_access field has value ?>
				<span>
					<?php if( get_field('event_access') == 'invitation') : ?>
						<i class="fa fa-envelope-o"></i>
					<?php elseif( get_field('event_access') == 'public') : ?>
						<i class="fa fa-group"></i>
					<?php else: ?>
						<i class="fa fa-lock"></i> 
					<?php endif; ?>
				
					<?php echo $field['choices'][ $value ]; ?>
				</span>
			<?php endif; ?>
		</div>
		
		<div class="content-holder">
			<div class="post-detail">
				<?php the_content(); ?>
			</div>
		
			<h3 class="title"><?php _e('Event Location on the Map', 'merit'); ?></h3>
			<div id="map-wrapper" data-map-name="<?php the_title(); ?>" data-map-address="<?php the_field('event_location'); ?>" data-map-image="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>" data-map-lat="" data-map-lng="" data-map-zoom="16"></div>

		</div>
	</article>
<?php endif; ?>