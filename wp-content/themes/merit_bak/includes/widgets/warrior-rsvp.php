<?php
/**
 * RSVP widget
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */

// Widgets
if ( function_exists( 'warrior_rsvp_widget' ) ) {
	add_action( 'widgets_init', 'warrior_rsvp_widget' );
}

// Register our widget
function warrior_rsvp_widget() {
	register_widget( 'Warrior_RSVP' );
}

// Warrior RSVP Widget
class Warrior_RSVP extends WP_Widget {
	//  Setting up the widget
	function Warrior_RSVP() {
		$widget_ops  = array( 'classname' => 'home-rsvp', 'description' => __('RSVP form Widget', 'merit') );
		$control_ops = array( 'id_base' => 'warrior_rsvp' );

		$this->WP_Widget( 'warrior_rsvp', __('Home: Warrior RSVP', 'merit'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		global $merit_option;

		extract( $args );
		
		$warrior_rsvp_title 		= apply_filters('widget_title', $instance['warrior_rsvp_title']);
		$warrior_rsvp_form_id 		= !empty($instance['warrior_rsvp_form_id']) ? absint( $instance['warrior_rsvp_form_id'] ) : 1919;

		echo $before_widget;
?>		
		<div id="rsvp-widget">
			<div class="container">
				<?php echo $before_title . $warrior_rsvp_title . $after_title; ?>

				<div class="rsvp-holder">
					<?php echo do_shortcode('[contact-form-7 id="'. $warrior_rsvp_form_id .'"]' ); ?>
				</div>

				<div class="clearfix"></div>
			</div>
		</div>

<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['warrior_rsvp_title']	= strip_tags( $new_instance['warrior_rsvp_title'] );
		$instance['warrior_rsvp_form_id']	= strip_tags( $new_instance['warrior_rsvp_form_id'] );

		return $instance;
	}

	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array('warrior_rsvp_title' => __('Don\'t Forget to RSVP', 'merit'), 'warrior_rsvp_form_id' => '1919', 'warrior_rsvp_text' => __('You can change this text from the widget setting.', 'merit') ) );
	?>
        <p>
            <label for="<?php echo $this->get_field_id( 'warrior_rsvp_title' ); ?>"><?php _e('Widget Title:', 'merit'); ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'warrior_rsvp_title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'warrior_rsvp_title' ); ?>" value="<?php echo $instance['warrior_rsvp_title']; ?>" />
        </p>
		<p>
			<label for="<?php echo $this->get_field_id( 'warrior_rsvp_form_id' ); ?>"><?php _e('Contact Form 7 ID:', 'merit'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'warrior_rsvp_form_id' ); ?>" name="<?php echo $this->get_field_name( 'warrior_rsvp_form_id' ); ?>" value="<?php echo $instance['warrior_rsvp_form_id']; ?>" />
		</p>
		<p><small><?php printf( __('Type in the form ID from Contact Form 7 that will use to display the RSVP form. You can see the form ID from <a href="%s" target="_blank">this page</a>. Please refer to <a class="thickbox" href="%s">screenshot</a> for more detail.', 'merit'), admin_url('admin.php?page=wpcf7'), get_stylesheet_directory_uri() .'/images/help/contact-form7-id.jpg' ); ?></small></p>
		<p><small><?php printf( __('All submission will be sent to the email address set on <a href="%s" target="_blank">theme options</a>.', 'merit'), admin_url('admin.php?page=warriorpanel&tab=0') ); ?></small></p>
	<?php
	}
}
?>