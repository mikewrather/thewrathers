<?php
/**
 * Testimonials widget
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
 
// Widgets
if ( function_exists( 'merit_testimonial_register' ) ) {
	add_action( 'widgets_init', 'warrior_testimonial_widget' );
}

// Register our widget
function warrior_testimonial_widget() {
	register_widget( 'Warrior_Testimonial' );
}

// Warrior Testimonial Widget
class Warrior_Testimonial extends WP_Widget {


	//  Setting up the widget
	function Warrior_Testimonial() {
		$widget_ops  = array( 'classname' => 'home-testimonial', 'description' => __('Warrior Testimonials Widget', 'merit') );
		$control_ops = array( 'id_base' => 'warrior_testimonial' );

		$this->WP_Widget( 'warrior_testimonial', __('Home: Warrior Testimonials', 'merit'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {

		extract( $args );

		$warrior_testimonial_title	= apply_filters('widget_title', $instance['warrior_testimonial_title']);
		$warrior_testimonial_count = !empty($instance['warrior_testimonial_count']) ? absint( $instance['warrior_testimonial_count'] ) : 4;
		
		$args = array(
			'post_type' => 'testimonial',
			'post_status' => 'publish',
			'posts_per_page' => $warrior_testimonial_count
		);
		$testimonial_query = new WP_Query();
		$testimonial_query->query($args);
		if ( $testimonial_query->have_posts() ) :

		echo $before_widget;
?>
		<div id="testimonial-widget">
			<div class="container">
				<?php echo $before_title . $warrior_testimonial_title . $after_title; ?>
				<div class="testimonial">
					<ul class="slides">
					<?php while( $testimonial_query->have_posts() ) : $testimonial_query->the_post(); ?>
						<li>
							<div class="text">
								<div class="quote"><?php the_field('testimonial_content'); ?></div>
							</div>

							<div class="person-info">
								<div class="thumbnail">
									<?php
									// Get featured image
									if ( has_post_thumbnail() ) {
										the_post_thumbnail('testimonial-photo');
									} else {
										echo '<img src="http://placehold.it/130x130/&text=No+Thumbnail" alt="" />';
									}
									?>
								</div>

								<div class="info">
									<h3 class="title"><?php the_title(); ?></h3>
									<p class="relation"><?php the_field('testimonial_relationship'); ?></p>
								</div>
							</div>
						</li>
					<?php endwhile; ?>
					</ul>
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

		$instance['warrior_testimonial_title']	= esc_attr( $new_instance['warrior_testimonial_title'] );
		$instance['warrior_testimonial_count']	= (int) $new_instance['warrior_testimonial_count'];

		return $instance;
	}

	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array('warrior_testimonial_title' => __('Testimonials', 'merit'), 'warrior_testimonial_count' => 4 ) );
	?>
        <p>
            <label for="<?php echo $this->get_field_id( 'warrior_testimonial_title' ); ?>"><?php _e('Widget Title:', 'merit'); ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'warrior_testimonial_title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'warrior_testimonial_title' ); ?>" value="<?php echo $instance['warrior_testimonial_title']; ?>" />
        </p>
 		<p>
			<label for="<?php echo $this->get_field_id( 'warrior_testimonial_count' ); ?>"><?php _e('Number of Post to be Displayed:', 'merit'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'warrior_testimonial_count' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'warrior_testimonial_count' ); ?>" value="<?php echo $instance['warrior_testimonial_count']; ?>" />
		</p>
		<p><?php printf( __('The testimonials data are taken from <a href="%s" target="_blank">Testimonial post type</a>.', 'merit'), admin_url('edit.php?post_type=testimonial') ); ?></p>
	<?php
	}
}

?>