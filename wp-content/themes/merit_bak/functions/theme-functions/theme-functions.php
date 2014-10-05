<?php
/**
 * Function to load comment list
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
if ( ! function_exists( 'warrior_comment_list' ) ) {
	function warrior_comment_list($comment, $args, $depth) {
		global $post;
		$author_post_id = $post->post_author;
		$GLOBALS['comment'] = $comment;

		// Allowed html tags will be display
		$allowed_html = array(
			'a' => array( 'href' => array(), 'title' => array() ),
			'abbr' => array( 'title' => array() ),
			'acronym' => array( 'title' => array() ),
			'strong' => array(),
			'b' => array(),
			'blockquote' => array( 'cite' => array() ),
			'cite' => array(),
			'code' => array(),
			'del' => array( 'datetime' => array() ),
			'em' => array(),
			'i' => array(),
			'q' => array( 'cite' => array() ),
			'strike' => array(),
			'ul' => array(),
			'ol' => array(),
			'li' => array()
		);

		switch ( $comment->comment_type ) :
			case '' :
	?>
	<li id="comment-<?php comment_ID() ?>" <?php comment_class(); ?>>
		<div class="thumbnail">
			<?php echo get_avatar( $comment, 60 ); ?>
		</div>
		<div class="detail">
			<div class="comment-head">
				<span class="username"><?php comment_author_link(); ?></span>
				<div class="meta">
					<a href="<?php echo get_comment_link(); ?>"><i class="fa fa-clock-o"></i><?php echo get_comment_date() .' '. get_comment_time(); ?></a>
					<?php edit_comment_link(__('Edit Comment', 'merit'), ' - ', ''); ?>
				</div>
			</div>
			<?php if ($comment->comment_approved == '0') : ?>
			<div class="comment-waiting">
				<p><?php _e('Your comment is now awaiting moderation.', 'merit'); ?></p>
			</div>
			<?php endif; ?>
			<?php echo apply_filters('comment_text', wp_kses( get_comment_text(), $allowed_html ) );  ?>
			<?php echo comment_reply_link(array('depth' => $depth, 'max_depth' => $args['max_depth']));  ?>			
		</div>
	<?php
			break;
			case 'pingback'  :
			case 'trackback' :
	?>
	<li id="comment-<?php comment_ID() ?>" <?php comment_class(); ?>>
		<div class="detail">
			<div class="comment-head">
				<div class="meta">
					<a href="<?php echo get_comment_link(); ?>"><i class="fa fa-clock-o"></i><?php echo get_comment_date() .' '. get_comment_time(); ?></a>
					<?php edit_comment_link(__('Edit Comment', 'merit'), ' - ', ''); ?>
				</div>
			</div>
			<?php if ($comment->comment_approved == '0') : ?>
			<div class="comment-waiting">
				<p><?php _e('Your comment is now awaiting moderation.', 'merit'); ?></p>
			</div>
			<?php endif; ?>
			<p><?php comment_author_link(); ?></p>
		</div>
	<?php
			break;
		endswitch;
	}
}



/**
 * Function to add site favicon
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
if ( ! function_exists( 'warrior_add_favicon' ) ) {
	function warrior_add_favicon() {
		global $merit_option;

		if ( ! $merit_option['favicon'] )
			return false;
	?>
	<link rel="shortcut icon" href="<?php echo esc_url( $merit_option['favicon']['url'] ); ?>" />
	<?php
	}
}
add_action( 'wp_head', 'warrior_add_favicon', 5 );


/**
 * Function to build site logo
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
if ( ! function_exists( 'merit_logo' ) ) {
	function merit_logo() {
		global $merit_option;

		if ( $merit_option['logo_type'] == '1' && is_home() && is_front_page() )
			echo '<div class="logo-symbol"></div>';
			
		if ( $merit_option['logo_type'] == '1' ) :
			if ( $merit_option['logo_text'] != '' )
				$logo = $merit_option['logo_text'];
			else
				$logo = get_bloginfo('name');
		else :
			$logo = '<img src="' . esc_url( $merit_option['logo_image']['url'] ) . '" alt="' . get_bloginfo('name') . '" />';
		endif;
			
		echo '<div class="couplesname">' . $logo . '</div>';
	}
}


/**
 * Function to collect the title of the current page
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
if ( ! function_exists( 'warrior_archive_title' ) ) {
	function warrior_archive_title() {
		global $wp_query;

		$title = '';
		if ( is_category() ) :
			$title = sprintf( __( 'Category Archives: %s', 'merit' ), single_cat_title( '', false ) );
		elseif ( is_tag() ) :
			$title = sprintf( __( 'Tag Archives: %s', 'merit' ), single_tag_title( '', false ) );
		elseif ( is_tax() ) :
			$title = sprintf( __( '%s Archives', 'merit' ), get_post_format_string( get_post_format() ) );
		elseif ( is_day() ) :
			$title = sprintf( __( 'Daily Archives: %s', 'merit' ), get_the_date() );
		elseif ( is_month() ) :
			$title = sprintf( __( 'Monthly Archives: %s', 'merit' ), get_the_date( 'F Y' ) );
		elseif ( is_year() ) :
			$title = sprintf( __( 'Yearly Archives: %s', 'merit' ), get_the_date( 'Y' ) );
		elseif ( is_author() ) :
			$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
			$title = sprintf( __( 'Author Archives: %s', 'merit' ), get_the_author_meta( 'display_name', $author->ID ) );
		elseif ( is_search() ) :
			if ( $wp_query->found_posts ) {
				$title = sprintf( __( 'Search Results for: %s', 'merit' ), esc_attr( get_search_query() ) );
			} else {
				$title = sprintf( __( 'No Results for: %s', 'merit' ), esc_attr( get_search_query() ) );
			}
		elseif ( is_404() ) :
			$title = __( 'Not Found', 'merit' );
		else :
			$title = __( 'Blog', 'merit' );
		endif;
		
		return $title;
	}
}



/**
 * Function to display post meta
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
if ( ! function_exists( 'merit_post_meta' ) ) {
	function merit_post_meta() {
		global $post;
		$time = '<a href="' . get_permalink() . '">' . sprintf( __('%s ago', 'merit'), human_time_diff( get_the_time('U'), current_time('timestamp') ) ) . '</a>';
		$author = '<a href="' . get_author_posts_url($post->post_author) . '">' . get_the_author() . '</a>';
?>
		<div class="meta">
			<span><i class="fa fa-calendar"></i> <?php echo $time; ?></span>
			<span><i class="fa fa-male"></i> <?php echo $author; ?></span>
			<span><i class="fa fa-tags"></i> <?php the_category(', '); ?></span>
		</div>
<?php
	}
}

/**
 * Function to define #main-content classes
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
if ( ! function_exists( 'merit_content_class' ) ) {
	function merit_content_class() {
		$class[] = 'page';		
		if ( is_single() ) {
			$class[] = 'single-page';
		} elseif ( is_page_template('page-history.php') ) {
			$class[] = 'timeline-page';
			$class[] = 'parallax';
		} else {
			$class[] = 'blog-page';
		}
		
		echo implode( ' ', $class );
	}
}

/**
 * Function to get twitter update
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
if( ! function_exists('warrior_get_recent_tweets') ) {
	function warrior_get_recent_tweets( $screen_name = '', $consumer_key = '', $consumer_secret = '', $tweets_count = 5 ) {

		if ( !$screen_name)
			return false;
		
		// some variables
		$token = get_option('warriorTwitterToken'.$screen_name);

		// get recent tweets from cache
		$recent_tweets = get_transient('warriorRecentTweets'.$screen_name);

		// cache version does not exist or expired
		if (false === $recent_tweets) {

			// getting new auth bearer only if we don't have one
			if(!$token) {

				// preparing credentials
				$credentials = $consumer_key . ':' . $consumer_secret;
				$toSend = base64_encode($credentials);
	 
				// http post arguments
				$args = array(
					'method' => 'POST',
					'httpversion' => '1.1',
					'blocking' => true,
					'headers' => array(
						'Authorization' => 'Basic ' . $toSend,
						'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8'
					),
					'body' => array( 'grant_type' => 'client_credentials' )
				);
	 
				add_filter('https_ssl_verify', '__return_false');
				$response = wp_remote_post('https://api.twitter.com/oauth2/token', $args);

				$keys = json_decode(wp_remote_retrieve_body($response));

				if($keys) {
					// saving token to wp_options table
					update_option('warriorTwitterToken'.$screen_name, $keys->access_token);
					$token = $keys->access_token;
				}
			}

			// we have bearer token wether we obtained it from API or from options
			$args = array(
				'httpversion' => '1.1',
				'blocking' => true,
				'headers' => array(
					'Authorization' => "Bearer $token"
				)
			);

			add_filter('https_ssl_verify', '__return_false');
			$api_url = "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=$screen_name&count=$tweets_count";
			$response = wp_remote_get($api_url, $args);
	 
			if (!is_wp_error($response)) {
				$tweets = json_decode(wp_remote_retrieve_body($response));

				if(!empty($tweets)){
					for($i=0; $i<count($tweets); $i++){
						$recent_tweets[] = array(
							'text' 						=> $tweets[$i]->text, 
							'created_at' 				=> $tweets[$i]->created_at, 
							'status_id' 				=> $tweets[$i]->id_str
						);
					}
				}			
			}
			
			// cache for an hour
			set_transient('warriorRecentTweets'.$screen_name, $recent_tweets, 1*60*60);
		}

		return $recent_tweets;

	}
}

/**
 * Function to replace replace permalink on tweet
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */

if( ! function_exists('warrior_twitter_links') ) {
	function warrior_twitter_links($tweet_text) {
		$tweet_text = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $tweet_text);
		$tweet_text = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $tweet_text);
		$tweet_text = preg_replace("/@(\w+)/", "<a href=\"http://twitter.com/\\1\" target=\"_blank\">@\\1</a>", $tweet_text);
		$tweet_text = preg_replace("/#(\w+)/", "<a href=\"http://twitter.com/search?q=\\1\" target=\"_blank\">#\\1</a>", $tweet_text);
		return $tweet_text;
	}
}

/**
 * Function to move meta box position
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
if( ! function_exists('meta_box_position') ) {
	function meta_box_position() {
		remove_meta_box( 'postimagediv', 'gallery', 'side' );
		remove_meta_box( 'postimagediv', 'slideshow', 'side' );
		add_meta_box('postimagediv', __('Gallery Cover', 'merit'), 'post_thumbnail_meta_box', 'gallery', 'normal', 'high');
		add_meta_box('postimagediv', __('Set Slideshow Image', 'merit'), 'post_thumbnail_meta_box', 'slideshow', 'normal', 'high');

	}
}
add_action('do_meta_boxes', 'meta_box_position');

/**
 * Function to change the default WordPress gallery image size
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
remove_shortcode('gallery');
add_shortcode('gallery', 'warrior_custom_size_gallery');

function warrior_custom_size_gallery($attr) {
    $attr['size'] = 'small-thumb'; // Ubah ke thumbnail, medium, large atau ukuran custom via add_image_size()
    return gallery_shortcode($attr);
}