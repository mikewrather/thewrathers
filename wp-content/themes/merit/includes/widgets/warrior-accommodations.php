<?php
/**
 * accommodations widget
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
 
// Widgets
if ( function_exists( 'merit_accommodation_register' ) ) {
	add_action( 'widgets_init', 'warrior_accommodations_widget' );
}

// Register our widget
function warrior_accommodations_widget() {
	register_widget( 'Warrior_accommodations' );
}

// Warrior accommodations Widget
class Warrior_accommodations extends WP_Widget {
	//  Setting up the widget
	function Warrior_accommodations() {
		$widget_ops  = array( 'classname' => 'home-accommodations', 'description' => __('Warrior accommodations Widget', 'merit') );
		$control_ops = array( 'id_base' => 'warrior_accommodations' );

		$this->WP_Widget( 'warrior_accommodations', __('Home: Warrior accommodations', 'merit'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$warrior_accommodations_title		= apply_filters('widget_title', $instance['warrior_accommodations_title']);
		$warrior_accommodations_sub_title	= $instance['warrior_accommodations_sub_title'];
		$warrior_accommodations_count 		= !empty($instance['warrior_accommodations_count']) ? absint( $instance['warrior_accommodations_count'] ) : 3;
		
		$args = array(
			'post_type' => 'accommodation',
			'post_status' => 'publish',
			'posts_per_page' => $warrior_accommodations_count
		);
		$accommodation_query = new WP_Query();
		$accommodation_query->query($args);
		if ( $accommodation_query->have_posts() ) :

		echo $before_widget;
?>
		<div id="accommodations-widget">
			<?php echo $before_title . $warrior_accommodations_title . $after_title; ?>
			<div class="container">
				<?php if( $warrior_accommodations_sub_title != '' ) : ?>
					<h4 class="sub-title"><?php echo $warrior_accommodations_sub_title; ?></h4>
				<?php endif; ?>

				<div class="post-grid">
					<?php while( $accommodation_query->have_posts() ) : $accommodation_query->the_post(); ?>
						<article <?php post_class(); ?>>
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
									</div>


                                </div>
								
								<div class="post-wrapper">
									<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo wp_trim_words( get_the_title(), 5, '...' ); ?></a></h2>
									
									<p><?php echo wp_trim_words( get_the_excerpt(), 23, '...'); ?></p>

									<div class="meta">
										<?php
										// Get field object
										$field = get_field_object('accommodation_access');
										$value = get_field('accommodation_access');
										?>

                                        <span class="location"><i class="fa fa-home"></i> <?php echo wp_trim_words(get_field('accommodation_location'),5,'...'); ?></span>
                                        <span class="location"><i class="fa fa-phone"></i> <?php echo get_field('phone_number'); ?></span>
                                        <span class="location"><i class="fa fa-globe"></i><a href="<?php echo get_field('website'); ?>"><?php echo wp_trim_words( get_the_title(), 5, '...' ); ?> website</a></span>
                                        </div>
								</div>
                                <div class="view effect map thumbnail">
                                    <image class="accommodation-map" src="http://maps.googleapis.com/maps/api/staticmap?<?php
                                    ?>center=<?php echo get_field('accommodation_location');
                                    ?>&zoom=16<?php
                                    ?>&size=570x350<?php
                                    ?>&maptype=roadmap<?php
                                    ?>&markers=color:red%7Clabel:A%7C<?php
                                    echo get_field('accommodation_location'); ?>" />

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

		$instance['warrior_accommodations_title']			= esc_attr( $new_instance['warrior_accommodations_title'] );
		$instance['warrior_accommodations_sub_title']		= esc_attr( $new_instance['warrior_accommodations_sub_title'] );
		$instance['warrior_accommodations_count']			= (int) $new_instance['warrior_accommodations_count'];

		return $instance;
	}

	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array('warrior_accommodations_title' => __('The accommodations', 'merit'), 'warrior_accommodations_sub_title' => __('This is just and example text to add below the section title. You can add any text to suit your needs. HTML tags are being stripped.', 'merit'), 'warrior_accommodations_count' => 3 ) );
	?>
        <p>
            <label for="<?php echo $this->get_field_id( 'warrior_accommodations_title' ); ?>"><?php _e('Widget Title:', 'merit'); ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'warrior_accommodations_title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'warrior_accommodations_title' ); ?>" value="<?php echo $instance['warrior_accommodations_title']; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'warrior_accommodations_sub_title' ); ?>"><?php _e('Widget Sub Title:', 'merit'); ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'warrior_accommodations_sub_title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'warrior_accommodations_sub_title' ); ?>" value="<?php echo $instance['warrior_accommodations_sub_title']; ?>" />
        </p>
 		<p>
			<label for="<?php echo $this->get_field_id( 'warrior_accommodations_count' ); ?>"><?php _e('Number of Post to be Displayed:', 'merit'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'warrior_accommodations_count' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'warrior_accommodations_count' ); ?>" value="<?php echo $instance['warrior_accommodations_count']; ?>" />
		</p>
		<p><?php printf( __('The accommodations data are taken from <a href="%s" target="_blank">accommodation post type</a>.', 'merit'), admin_url('edit.php?post_type=accommodation') ); ?></p>
	<?php
	}
}

?>