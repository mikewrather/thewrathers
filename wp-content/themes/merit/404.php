<?php
/**
 * Template for displaying Page post type.
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
?>

<?php get_header(); ?>

<div class="page-title">
	<h1><?php _e('Page not Found', 'merit');  ?></h1>
</div>
    
<div class="container">
	<div class="full-width-content">
		<p><?php _e('The page you\'re looking for is not available. The page may have been deleted or unpublished. Please use the search form below to search the page you are looking for.', 'merit');?></p>
		<?php get_template_part('searchform'); ?>
	</div>
</div>

<?php get_footer(); ?>