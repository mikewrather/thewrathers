<?php
/**
 * Template for displaying Yoast breadcrumb
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
?>

<?php
if ( function_exists( 'yoast_breadcrumb' ) ) {
	yoast_breadcrumb('<div class="breadcrumb">','</div>');
}
?>