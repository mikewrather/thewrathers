<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
?>

<?php get_header(); ?>

	<div class="page-title">
		<h1><?php echo warrior_archive_title(); ?></h1>
	</div>
	
	<div class="container">
		<div class="layout-content">
			<div id="left-content">
				<?php
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();
							get_template_part( 'content' );
						}
						get_template_part( 'includes/pagination' );
					} else {
						_e('The page you\'re looking for is not available. The page may have been deleted or unpublished.', 'merit');
					}
				?>
			</div>
			<?php get_sidebar(); ?>
			<div class="clearfix"></div>
		</div>
	</div>

<?php get_footer(); ?>