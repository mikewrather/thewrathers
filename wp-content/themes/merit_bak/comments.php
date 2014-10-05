<?php
/**
 * Template for displaying comments
 *
 * @package WordPress
 * @subpackage Merit
 * @since Merit 1.0.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<?php if ( have_comments() ) : ?>

    <div id="comments" class="comments holder">
		<div class="wrapper">
			<h4 class="widget-title"><i class="fa fa-comments"></i><?php comments_number( __('No Comments', 'merit'), __('1 Comment', 'merit'), __('% Comments', 'merit') ); ?></h4>
    
        <ul>
            <?php wp_list_comments('callback=warrior_comment_list'); ?>
        </ul>
        
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation clearfix">
				<span class="prev"><?php previous_comments_link(__('&larr; Previous', 'merit'), 0); ?></span>
				<span class="next"><?php next_comments_link(__('Next &rarr;', 'merit'), 0); ?></span>
			</div>	
		<?php endif; ?>
			
		</div>
    </div>
		
<?php endif; ?> 

<?php if ( comments_open() ) : ?>

	<div class="comment-form holder">
		<div class="wrapper">
		<?php
			$comment_fields = array(
				'author'	=> '<div class="form-group"><input type="text" class="form-control" name="author" id="author" value="" placeholder="'. __('Name', 'merit') .'" /><span class="required">*</span></div>',
				'email'		=> '<div class="form-group"><input type="text" class="form-control" name="email" id="email" value="" placeholder="'. __('Email', 'merit') .'" /><span class="required">*</span></div>',
				'url'		=> '<div class="form-group"><input type="text" class="form-control" name="url" id="url" value="" placeholder="'. __('Website URL', 'merit') .'" /></div>',
			);
			comment_form( array(
				'comment_notes_before'	=>	'',
				'comment_notes_after'	=>	'',
				'label_submit'			=>	__( 'Submit', 'merit' ),
				'cancel_reply_link'		=>  __( 'Cancel Reply', 'merit' ),
				'fields'				=> $comment_fields,
				'comment_field'			=>	'<div class="form-group"><textarea class="form-control" name="comment" id="comment" placeholder="'. __('Message...', 'merit') .'" row="10"></textarea><span class="required">*</span></div>'
			) );
		?>
		</div>
	</div>

<?php endif; ?>