<?php
/**
 * About Couple widget
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */

// Widgets
add_action( 'widgets_init', 'warrior_about_couple_widget' );

// Register our widget
function warrior_about_couple_widget() {
	register_widget( 'Warrior_About_Couple' );
}

// Warrior Abou the Couple Widget
class Warrior_About_Couple extends WP_Widget {


	//  Setting up the widget
	function Warrior_About_Couple() {
		$widget_ops  = array( 'classname' => 'about_couple', 'description' => __('Warrior About Couple Widget', 'merit') );
		$control_ops = array( 'id_base' => 'warrior_about_couple' );

		$this->WP_Widget( 'warrior_about_couple', __('Home: Warrior About Couple', 'merit'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		global $shortname, $merit_option;

		extract( $args );

		$warrior_about_couple_title	= apply_filters('widget_title', $instance['warrior_about_couple_title']);
		
		echo $before_widget;
?>
		<?php echo $before_title . $warrior_about_couple_title . $after_title; ?>
		
		<div class="container">
			<span class="and">&amp;</span>
			
			<div class="couple groom">
				<div class="thumb">
					<div class="thumbnail">
						<img src="<?php echo ( $merit_option['photo_groom']['url'] ? esc_url( $merit_option['photo_groom']['url'] ) : 'http://placehold.it/200x200/f5f5f5/666666/&text=Groom&' ); ?>" alt="" />
					</div>
				</div>
				<?php if ( $merit_option['name_groom'] ) : ?>
					<div class="title"><h2><?php echo esc_attr( $merit_option['name_groom'] ); ?></h2></div>
				<?php endif; ?>
				<div class="excerpt">
					<?php echo wpautop( esc_attr( $merit_option['about_groom'] ) ); ?>
				</div>

				<div class="social">
					<?php
					if ( $merit_option['url_facebook_groom'] ) echo '<a href="'.esc_url( $merit_option['url_facebook_groom'] ).'"><i class="fa fa-facebook"></i></a>';
					if ( $merit_option['url_twitter_groom'] ) echo '<a href="'.esc_url( $merit_option['url_twitter_groom'] ).'"><i class="fa fa-twitter"></i></a>';
					if ( $merit_option['url_gplus_groom'] ) echo '<a href="'.esc_url( $merit_option['url_gplus_groom'] ).'"><i class="fa fa-google-plus"></i></a>';
					if ( $merit_option['url_pinterest_groom'] ) echo '<a href="'.esc_url( $merit_option['url_pinterest_groom'] ).'"><i class="fa fa-pinterest"></i></a>';
					if ( $merit_option['url_youtube_groom'] ) echo '<a href="'.esc_url( $merit_option['url_youtube_groom'] ).'"><i class="fa fa-youtube"></i></a>';
					if ( $merit_option['url_flickr_groom'] ) echo '<a href="'.esc_url( $merit_option['url_flickr_groom'] ).'"><i class="fa fa-flickr"></i></a>';
					?>
				</div>
			</div>
			<div class="couple bride">
				<div class="thumb">
					<div class="thumbnail">
						<img src="<?php echo ( $merit_option['photo_bride']['url'] ? esc_url( $merit_option['photo_bride']['url'] ) : 'http://placehold.it/200x200/f5f5f5/666666&text=Bride' ); ?>" alt="" />
					</div>
				</div>
				<?php if ( $merit_option['name_bride'] ) : ?>
					<div class="title"><h2><?php echo esc_attr( $merit_option['name_bride'] ); ?></h2></div>
				<?php endif; ?>
				<div class="excerpt">
					<?php echo wpautop( esc_attr( $merit_option['about_bride'] ) ); ?>
				</div>
					
				<div class="social">
					<?php
					if ( $merit_option['url_facebook_bride'] ) echo '<a href="'.esc_url( $merit_option['url_facebook_bride'] ).'"><i class="fa fa-facebook"></i></a>';
					if ( $merit_option['url_twitter_bride'] ) echo '<a href="'.esc_url( $merit_option['url_twitter_bride'] ).'"><i class="fa fa-twitter"></i></a>';
					if ( $merit_option['url_gplus_bride'] ) echo '<a href="'.esc_url( $merit_option['url_gplus_bride'] ).'"><i class="fa fa-google-plus"></i></a>';
					if ( $merit_option['url_pinterest_bride'] ) echo '<a href="'.esc_url( $merit_option['url_pinterest_bride'] ).'"><i class="fa fa-pinterest"></i></a>';
					if ( $merit_option['url_youtube_bride'] ) echo '<a href="'.esc_url( $merit_option['url_youtube_bride'] ).'"><i class="fa fa-youtube"></i></a>';
					if ( $merit_option['url_flickr_bride'] ) echo '<a href="'.esc_url( $merit_option['url_flickr_bride'] ).'"><i class="fa fa-flickr"></i></a>';
					?>
				</div>
			</div>
		</div>
<?php
	echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		global $shortname;

		$instance = $old_instance;

		$instance['warrior_about_couple_title']	= esc_attr( $new_instance['warrior_about_couple_title'] );

		return $instance;
	}

	function form( $instance ) {
		global $shortname;

		$instance = wp_parse_args( (array) $instance, array('warrior_about_couple_title' => __('The Happy Couple', 'merit') ) );
	?>
        <p>
            <label for="<?php echo $this->get_field_id( 'warrior_about_couple_title' ); ?>"><?php _e('Widget Title:', 'merit'); ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'warrior_about_couple_title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'warrior_about_couple_title' ); ?>" value="<?php echo $instance['warrior_about_couple_title']; ?>" />
        </p>
		<p><?php printf( __('The data taken from <a href="%s" target="_blank">Theme Options</a>.', 'merit'), admin_url('admin.php?page=warriorpanel&tab=2') ); ?></p>
	<?php
	}
}

?>