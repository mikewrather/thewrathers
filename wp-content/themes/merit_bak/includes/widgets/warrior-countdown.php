<?php
/**
 * Countdown widget
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */

// Widgets
add_action( 'widgets_init', 'warrior_countdown_widget' );

// Register our widget
function warrior_countdown_widget() {
	register_widget( 'Warrior_Countdown' );
}

// Warrior Countdown Widget
class Warrior_Countdown extends WP_Widget {


	//  Setting up the widget
	function Warrior_Countdown() {
		$widget_ops  = array( 'classname' => 'home-countdown', 'description' => __('Warrior Countdown Widget', 'merit') );
		$control_ops = array( 'id_base' => 'warrior_countdown' );

		$this->WP_Widget( 'warrior_countdown', __('Home: Warrior Countdown', 'merit'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		global $merit_option;

		extract( $args );
		
		echo $before_widget;
?>
		<div id="countdown-widget" class="parallax" data-stellar-background-ratio="0.5">
			<div class="container">
            	<?php if ( $merit_option['wedding_date'] ) : ?>
					<h2 class="section-title"><?php _e('It\'s Happening', 'merit'); ?></h2>
					<div id="countdown" data-stellar-ratio="0.5">
						<div id="timer">
							<div class="number-container"><div class="number">{yn}</div> <div class="text">{yl}</div></div>
							<div class="number-container"><div class="number">{on}</div> <div class="text">{ol}</div></div>
							<div class="number-container"><div class="number">{dn}</div> <div class="text">{dl}</div></div>
							<div class="number-container"><div class="number">{hnn}</div> <div class="text">{hl}</div></div>
							<div class="number-container"><div class="number">{mnn}</div> <div class="text">{ml}</div></div>
							<div class="number-container"><div class="number">{snn}</div> <div class="text">{sl}</div></div>
						</div>
					</div>
	        	<?php else: ?>
					<p><?php _e('Error: You need to set the wedding date & time from the theme options.', 'merit'); ?></p>
				<?php endif; ?>
			</div>
		</div>

<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array() );
	?>
		<p><small><?php printf( __('This data taken from <a href="%s" target="_blank">Theme Options</a>.', 'merit'), admin_url('admin.php?page=warriorpanel&tab=1') ); ?></small></p>
	<?php
	}
}

?>