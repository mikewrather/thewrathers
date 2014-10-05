<?php
/**
 * Template for displaying pagination
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
?>

<?php global $wp_query; if($wp_query->max_num_pages > 1) : ?>
<div class="pagination">
<?php
	if( function_exists('wp_pagenavi') ):
		wp_pagenavi();
	else:
		previous_posts_link( __('<i class="fa fa-chevron-left"></i>previous', 'merit') );
		next_posts_link( __('next<i class="fa fa-chevron-right"></i>', 'merit') );
	endif
?>
</div>
<?php endif; ?>