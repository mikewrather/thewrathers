<?php/** * Template for displaying image attachment. * * @package WordPress * @subpackage Merit * @since Merit 1.0.0 */// Retrieve attachment metadata.$metadata = wp_get_attachment_metadata();?><?php get_header(); ?><div class="page-title">	<h1><?php the_title(); ?></h1></div>    <div class="container">	<div class="full-width-content">		<?php get_template_part( 'includes/breadcrumb' ); // display breadcrumb ?>				<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?>>			<?php			// Get the attachment image			if ( wp_attachment_is_image( $post->id ) ) {				$att_image = wp_get_attachment_image_src( $post->id, "full");        		        		echo '<a href="'. wp_get_attachment_url($post->id) .'" title="'. get_the_title() .'" rel="attachment"><img src="'. $att_image[0] .'" class="attachment-large" /></a>';        	} else {        		echo '<a href="'. wp_get_attachment_url($post->ID) .'" title="'. esc_html( get_the_title($post->ID), 1 ) .'" rel="attachment">'. basename($post->guid) .'</a>';        	}        	?>		</article>		<?php comments_template( '', true ); ?>	</div></div><?php get_footer(); ?>