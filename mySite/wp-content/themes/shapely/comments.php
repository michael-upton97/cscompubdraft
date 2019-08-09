<?php if (is_user_logged_in()): ?>
<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Shapely
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>



<div id="comments" class="comments-area comments  nolist">
	<?php if ( have_comments() && (current_user_can( 'administrator') || current_user_can( 'member') || current_user_can( 'acom')) ): ?>
		<h4 class="comments-title">
			<?php
			$comments_number = get_comments_number();
				/* translators: %s: post title */
			echo ("<hr>COMMITTEE OFFICE COMMENTS:");
			/*
			if ( '1' === $comments_number ) {
				/* translators: %s: post title 
				echo _x( '1 COMMENT', 'comments title', 'shapely' );
			} else {
				printf(
					/* translators: number of comments 
					_nx(
						'%1$s COMMENT',
						'%1$s COMMENTS',
						$comments_number,
						'comments title',
						'shapely'
					),
					number_format_i18n( $comments_number )
				);
			}*/
			?>
		</h4>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'shapely' ); ?></h2>
				<div class="nav-links">

					<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'shapely' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'shapely' ) ); ?></div>

				</div><!-- .nav-links -->
			</nav><!-- #comment-nav-above -->
		<?php endif; ?>

		<?php add_filter( 'comment_reply_link', 'shapely_reply_link_class' ); ?>
		<ul class="comments-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 75,
					'callback'    => 'shapely_cb_comment',
				)
			);
			?>
		</ul><!-- .comment-list -->
		<?php remove_filter( 'comment_reply_link', 'shapely_reply_link_class' ); ?>

      

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'shapely' ); ?></h2>
				<div class="nav-links">

					<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'shapely' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'shapely' ) ); ?></div>

				</div><!-- .nav-links -->
			</nav><!-- #comment-nav-below -->
			<?php
      endif; // Check for comment navigation.

      
      

	endif; // Check for have_comments() and users.



	// If comments are closed and there are comments, let's leave a little note, shall we?
   if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
   ?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'shapely' ); ?></p>
		<?php
	endif;
   
  
	if ( current_user_can( 'administrator') ) :
	/* comment form */
	$comments_args = shapely_custom_comment_form();
	comment_form( $comments_args );
	endif	?>





</div><!-- #comments -->
<?php endif; ?>