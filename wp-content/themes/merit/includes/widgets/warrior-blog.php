<?php
/**
 * Blog widget
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
 
// Widgets
add_action( 'widgets_init', 'warrior_blog_widget' );

// Register our widget
function warrior_blog_widget() {
	register_widget( 'Warrior_Blog' );
}

// Warrior Blog Widget
class Warrior_Blog extends WP_Widget {


	//  Setting up the widget
	function Warrior_Blog() {
		$widget_ops  = array( 'classname' => 'home-blog', 'description' => __('Warrior Blog Widget', 'merit') );
		$control_ops = array( 'id_base' => 'warrior_blog' );

		$this->WP_Widget( 'warrior_blog', __('Home: Warrior Blog', 'merit'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$warrior_blog_title			= apply_filters('widget_title', $instance['warrior_blog_title']);
		$warrior_blog_sub_title	  	= $instance['warrior_blog_sub_title'];
		$warrior_blog_count 		= !empty($instance['warrior_blog_count']) ? absint( $instance['warrior_blog_count'] ) : 3;
		
		$args = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => $warrior_blog_count
		);
		$blog_query = new WP_Query();
		$blog_query->query($args);
		if ( $blog_query->have_posts() ) :

		echo $before_widget;
?>
		<div id="blog-widget">
			<?php echo $before_title . $warrior_blog_title . $after_title; ?>
			<div class="container">
				<?php if( $warrior_blog_sub_title != '' ) : ?>
					<h4 class="sub-title"><?php echo $warrior_blog_sub_title; ?></h4>
				<?php endif; ?>

				<div class="post-grid">
					<?php while( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
						<article <?php post_class(); ?>>
							<div class="post-content">
								<div class="thumbnail">
									<div class="view effect">
										<?php
										// Let's get the featured image
										if ( has_post_thumbnail() ) {
											the_post_thumbnail('event-thumb');
										} else {
											echo '<img src="http://placehold.it/333x222/&text=No+Thumbnail" alt="" />';
										}
										?>
										<div class="mask"></div>
									</div>
								</div>
								
								<div class="post-wrapper">
									<?php echo get_avatar( get_the_author_meta( 'ID' ), 50 ); ?>
									<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo wp_trim_words( get_the_title(), 5, '...' ); ?></a></h2>
									<p><?php echo wp_trim_words( get_the_excerpt(), 25, '...'); ?></p>
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

		$instance['warrior_blog_title']			= esc_attr( $new_instance['warrior_blog_title'] );
		$instance['warrior_blog_count']			= (int) $new_instance['warrior_blog_count'];
		$instance['warrior_blog_sub_title']		= esc_attr( $new_instance['warrior_blog_sub_title'] );

		return $instance;
	}

	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array('warrior_blog_title' => __('The Blog', 'merit'), 'warrior_blog_sub_title' => __('This is just and example text to add below the section title. You can add any text to suit your needs. HTML tags are being stripped.', 'merit'), 'warrior_blog_count' => 3 ) );
	?>
        <p>
            <label for="<?php echo $this->get_field_id( 'warrior_blog_title' ); ?>"><?php _e('Widget Title:', 'merit'); ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'warrior_blog_title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'warrior_blog_title' ); ?>" value="<?php echo $instance['warrior_blog_title']; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'warrior_blog_sub_title' ); ?>"><?php _e('Widget Sub Title:', 'merit'); ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'warrior_blog_sub_title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'warrior_blog_sub_title' ); ?>" value="<?php echo $instance['warrior_blog_sub_title']; ?>" />
        </p>
 		<p>
			<label for="<?php echo $this->get_field_id( 'warrior_blog_count' ); ?>"><?php _e('Number of Post to be Displayed:', 'merit'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'warrior_blog_count' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'warrior_blog_count' ); ?>" value="<?php echo $instance['warrior_blog_count']; ?>" />
		</p>
	<?php
	}
}

?>