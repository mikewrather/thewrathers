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