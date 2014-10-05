<?php
/**
 * Template Name: Gallery
 * 
 * Template for displaying posts in the Gallery post type.
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
?>

<?php get_header(); ?>

<div class="page-title">
	<h1><?php the_title(); ?></h1>
</div>


<div class="container">
	<?php get_template_part( 'includes/breadcrumb' ); // display breadcrumb ?>
			
	<?php
	$terms = get_terms('gallery_type', 'hide_empty=0');
	if ( $terms ) :
	?>
	<div class="filter-holder">
		<a class="filter current" data-filter="all"><?php _e('All', 'merit'); ?></a> 
		<?php foreach ( $terms as $term ) : ?>
			<a class="filter" data-filter="<?php echo $term->slug; ?>"><?php echo $term->name; ?></a>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>
	
	<?php
	// Get gallery items
	$args = array(
		'post_type' => 'gallery',
		'post_status' => 'publish', 
		'showposts'		=> -1
	);
	$wp_query = new WP_Query();
	$wp_query->query($args);

	if ( $wp_query->have_posts() ) {
		echo '<ul class="gallery three-column">';
		while( $wp_query->have_posts() ) {
			$wp_query->the_post();
			get_template_part( 'content', 'gallery' );
		}
		echo '</ul>';
		get_template_part( 'includes/pagination' );
	}
	?>
</div>

<?php get_footer(); ?>