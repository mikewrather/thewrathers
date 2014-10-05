<?php
/**
 * Template for displaying posts in the Gallery post type.
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
?>

<?php
$add_class[] = 'mix';
$gallery_categories = get_the_terms( get_the_ID(), 'gallery_type' );
if ( $gallery_categories ) {
	foreach ( $gallery_categories as $gallery_category ) {
		$add_class[] = $gallery_category->slug;
	}
}
?>

<li id="post-<?php the_ID(); ?>" <?php post_class( implode(' ', $add_class) ); ?>>
	<div class="thumbnail">
		<?php
		if ( has_post_thumbnail() ) :
			$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
			$args = array( 'numberposts' => null, 'order' => 'ASC', 'post_type' => 'attachment', 'post_status' => null, 'post_mime_type' => 'image', 'post_parent' => get_the_ID(), 'showposts' => -1 );
			$attachments = get_posts($args);
			$others = array();
			if ($attachments) {
				echo '<div class="hidden" style="display: none;">';
				foreach ($attachments as $attachment) {
					$other_image = wp_get_attachment_image_src( $attachment->ID, 'large' );
					if ( $other_image[0] != $large_image_url[0] ) {
						echo '<a rel="prettyPhoto['.get_the_ID().']" href="'. $other_image[0] .'" title="'. $attachment->post_title .'"></a>';
						$others[] = $attachment->ID;
					}
				}
				echo '</div>';
			}
		?>

		<?php endif; ?>
		

		<div class="view effect">
			<?php
			// Get featured image
			if ( has_post_thumbnail() ) {
				the_post_thumbnail('small-thumb');
			} else { 
				echo '<img src="http://placehold.it/320x200/&text=No+Thumbnail" alt="" />';
			}
			?>
			<div class="mask"></div>
			<div class="content">  
				<a href="<?php echo $large_image_url[0]; ?>" class="info" rel="prettyPhoto<?php echo ( count($others) ? '['.get_the_ID().']' : '' ); ?>" title="<?php the_title(); ?>"><i class="fa fa-search"></i></a>  
			</div>  
		</div>

	</div>
	<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
</li>