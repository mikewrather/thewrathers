<?php
/**
 * Template for displaying footer section.
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */
?>

<?php global $merit_option; // load theme option global variable ?>

    </div>
    <!-- End: Main Content -->

    <!-- Start: Footer -->
    <footer id="footer" class="clearfix">
        <div class="container">
            <span class="copyright"><?php printf( __( 'Copyright %1$s. %2$s', 'merit' ), date_i18n('Y'), get_bloginfo('name') ); ?></span>
            <span class="author"><?php printf( __( 'Powered by %1$s. Designed by %2$s', 'merit' ), '<a href="http://wordpress.org">WordPress</a>','<a href="http://www.themewarrior.com"><img src="'. get_template_directory_uri() .'/images/themewarrior.png" alt="" /></a>' ); ?></span>
        </div>
    </footer>
    <!-- End: Footer -->
</div>

<script>
	
		jQuery(function($){
			$.stellar({
				horizontalScrolling: false,
				verticalOffset: 40,
				responsive: true
			});
		});

</script>

<?php
// Load tracking code from theme options
if( isset($merit_option['tracking_code']) ) {
    echo $merit_option['tracking_code'];
}

// Load custom CSS from theme options
if( isset( $merit_option['custom_css'] ) ) {
    echo '<style type="text/css">';
    echo $merit_option['custom_css'];
    echo '</style>';
}
?>

<?php wp_footer(); ?>
</body>
</html>