<?php
/**
 * Template for displaying search form.
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
?>

<div class="search-box">
	<form method="get" action="<?php echo home_url(); ?>">
		<p><input class="form-control" type="text" name="s" value="<?php the_search_query(); ?>" placeholder="<?php _e(' Search...', 'merit' ); ?>"/></p>
		<p class="submit"><button class="btn" type="submit"><?php _e('Search', 'merit'); ?></button></p>
	</form>
</div>