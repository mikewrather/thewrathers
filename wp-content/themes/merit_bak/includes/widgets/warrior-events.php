<?php
/**
 * Events widget
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
 
// Widgets
if ( function_exists( 'merit_event_register' ) ) {
	add_action( 'widgets_init', 'warrior_events_widget' );
}

// Register our widget
function warrior_events_widget() {
	register_widget( 'Warrior_Events' );
}

// Warrior Events Widget
class Warrior_Events extends WP_Widget {
	//  Setting up the widget
	function Warrior_Events() {
		$widget_ops  = array( 'classname' => 'home-events', 'description' => __('Warrior Events Widget', 'merit') );
		$control_ops = array( 'id_base' => 'warrior_events' );

		$this->WP_Widget( 'warrior_events', __('Home: Warrior Events', 'merit'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$warrior_events_title		= apply_filters('widget_title', $instance['warrior_events_title']);
		$warrior_events_sub_title	= $instance['warrior_events_sub_title'];
		$warrior_events_count 		= !empty($instance['warrior_events_count']) ? absint( $instance['warrior_events_count'] ) : 3;
		
		$args = array(
			'post_type' => 'event',
			'post_status' => 'publish',
			'posts_per_page' => $warrior_events_count
		);
		$event_query = new WP_Query();
		$event_query->query($args);
		if ( $event_query->have_posts() ) :

		echo $before_widget;
?>
		<div id="events-widget">
			<?php echo $before_title . $warrior_events_title . $after_title; ?>
			<div class="container">
				<?php if( $warrior_events_sub_title != '' ) : ?>
					<h4 class="sub-title"><?php echo $warrior_events_sub_title; ?></h4>
				<?php endif; ?>

				<div class="post-grid">
					<?php while( $event_query->have_posts() ) : $event_query->the_post(); ?>
						<article <?php post_class(); ?>>
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
									<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo wp_trim_words( get_the_title(), 5, '...' ); ?></a></h2>
									
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
					<?php endwhile; ?>
				</div>
			</div>
		</div>
<?php
	echo $after_widget;
	
	endif;
	wp_reset_postdata();
	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['warrior_events_title']			= esc_attr( $new_instance['warrior_events_title'] );
		$instance['warrior_events_sub_title']		= esc_attr( $new_instance['warrior_events_sub_title'] );
		$instance['warrior_events_count']			= (int) $new_instance['warrior_events_count'];

		return $instance;
	}

	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array('warrior_events_title' => __('The Events', 'merit'), 'warrior_events_sub_title' => __('This is just and example text to add below the section title. You can add any text to suit your needs. HTML tags are being stripped.', 'merit'), 'warrior_events_count' => 3 ) );
	?>
        <p>
            <label for="<?php echo $this->get_field_id( 'warrior_events_title' ); ?>"><?php _e('Widget Title:', 'merit'); ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'warrior_events_title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'warrior_events_title' ); ?>" value="<?php echo $instance['warrior_events_title']; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'warrior_events_sub_title' ); ?>"><?php _e('Widget Sub Title:', 'merit'); ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'warrior_events_sub_title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'warrior_events_sub_title' ); ?>" value="<?php echo $instance['warrior_events_sub_title']; ?>" />
        </p>
 		<p>
			<label for="<?php echo $this->get_field_id( 'warrior_events_count' ); ?>"><?php _e('Number of Post to be Displayed:', 'merit'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'warrior_events_count' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'warrior_events_count' ); ?>" value="<?php echo $instance['warrior_events_count']; ?>" />
		</p>
		<p><?php printf( __('The events data are taken from <a href="%s" target="_blank">Event post type</a>.', 'merit'), admin_url('edit.php?post_type=event') ); ?></p>
	<?php
	}
}

?>