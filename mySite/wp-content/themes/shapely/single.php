<?php
/**
 * The template for displaying all single posts.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Shapely
 */

get_header(); ?>
<?php 
$layout_class = shapely_get_layout_class(); 
// if statement added to only show sidebar for higher level users
if( ! (current_user_can( 'administrator' ) || current_user_can( 'acom' )) ) : 
	($layout_class = 'full-width');
endif;
?>
	<div class="row">
		<?php
		if ( 'sidebar-left' == $layout_class ) :
			get_sidebar();
		endif;
		?>
		<div id="primary" class="col-md-8 mb-xs-24 <?php if($layout_class == 'full-width') : echo 'custom-full-width '; endif; echo esc_attr( $layout_class ); ?>">
			<?php
			while ( have_posts() ) :
				
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
					if (get_comments_number() && ( current_user_can( 'member' ) || current_user_can( 'acom' ) || current_user_can( 'administrator' ))) {
					?><div> Please Note: Comments are only visible for site members, please do not share or duplicate them. </div>
					<hr>
				<?php }}
				
				the_post();

				get_template_part( 'template-parts/content' );
			endwhile; // End of the loop.

			?>
		</div><!-- #primary -->
		<?php
		if ( 'sidebar-right' == $layout_class ) :
			get_sidebar();
		endif;
		?>
	</div>
<?php
get_footer();


