<?php
/**
 * Gallery album widget
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */

// Widgets
if ( function_exists( 'merit_gallery_register' ) ) {
	add_action( 'widgets_init', 'warrior_gallery_widget' );
}

// Register our widget
function warrior_gallery_widget() {
	register_widget( 'Warrior_Gallery' );
}

// Warrior Gallery Widget
class Warrior_Gallery extends WP_Widget {


	//  Setting up the widget
	function Warrior_Gallery() {
		$widget_ops  = array( 'classname' => 'home-gallery', 'description' => __('Warrior Gallery ALbum Widget', 'merit') );
		$control_ops = array( 'id_base' => 'warrior_gallery' );

		$this->WP_Widget( 'warrior_gallery', __('Home: Warrior Gallery Album', 'merit'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		global $shortname;

		extract( $args );

		$warrior_gallery_title = apply_filters('widget_title', $instance['warrior_gallery_title']);
		$warrior_gallery_count = !empty($instance['warrior_gallery_count']) ? absint( $instance['warrior_gallery_count'] ) : 8;
		
		$args = array(
			'post_type' => 'gallery',
			'post_status' => 'publish',
			'posts_per_page' => $warrior_gallery_count
		);
		$gallery_query = new WP_Query();
		$gallery_query->query($args);
		if ( $gallery_query->have_posts() ) :

		echo $before_widget;

?>
		<div id="gallery-widget"><br/><br/>
            <?php echo $before_title . $warrior_gallery_title . $after_title; ?>
            <div class="container">
			<div class="gal">
				<ul>
					<?php while( $gallery_query->have_posts() ) : $gallery_query->the_post(); ?>
						<?php
						if ( has_post_thumbnail() ) :
							$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
							$args = array( 'numberposts' => null, 'order' => 'ASC', 'post_type' => 'attachment', 'post_status' => null, 'post_mime_type' => 'image', 'post_parent' => get_the_ID(), 'showposts' => -1 );
							$attachments = get_posts($args);
							$others = array();
						?>
							<li>

								<div class="view effect" onclick="location.href='<?php echo get_field('reg_link'); ?>';">
									<?php the_post_thumbnail('small-thumb'); ?>
									<div class="mask"></div>  
									<div class="content">
										<a href="<?php echo get_field('reg_link'); ?>" class="" rel="prettyPhoto<?php echo ( count($others) ? '['.get_the_ID().']' : '' ); ?>" title="<?php the_title(); ?>"></a>
									</div>
								</div>
							</li>
						<?php else : ?>
							<li>
								<a href="<?php the_permalink(); ?>" rel="bookmark"><i class="fa fa-search"></i></a>
								<img src="http://placehold.it/320x200/&amp;text=No+Thumbnail"/>
							</li>
						<?php endif; ?>
					<?php endwhile; ?><br/><br/><br/>
				</ul>
			</div>
            </div>
			<div class="clearfix"></div>
		</div>
<?php
	echo $after_widget;
	
	endif;
	wp_reset_postdata();
	}

	function update( $new_instance, $old_instance ) {
		global $shortname;

		$instance = $old_instance;

		$instance['warrior_gallery_title']	= esc_attr( $new_instance['warrior_gallery_title'] );
		$instance['warrior_gallery_count']	= (int) $new_instance['warrior_gallery_count'];

		return $instance;
	}

	function form( $instance ) {
		global $shortname;

		$instance = wp_parse_args( (array) $instance, array('warrior_gallery_title' => __('Photo Gallery', 'merit'), 'warrior_gallery_count' => 8 ) );
	?>
        <p>
            <label for="<?php echo $this->get_field_id( 'warrior_gallery_title' ); ?>"><?php _e('Widget Title:', 'merit'); ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'warrior_gallery_title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'warrior_gallery_title' ); ?>" value="<?php echo $instance['warrior_gallery_title']; ?>" />
        </p>
 		<p>
			<label for="<?php echo $this->get_field_id( 'warrior_gallery_count' ); ?>"><?php _e('Number of Album to be Displayed:', 'merit'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'warrior_gallery_count' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'warrior_gallery_count' ); ?>" value="<?php echo $instance['warrior_gallery_count']; ?>" />
		</p>
		<p><?php printf( __('The gallery data are taken from <a href="%s" target="_blank">Gallery post type</a>.', 'merit'), admin_url('edit.php?post_type=gallery') ); ?></p>
	<?php
	}
}

?>