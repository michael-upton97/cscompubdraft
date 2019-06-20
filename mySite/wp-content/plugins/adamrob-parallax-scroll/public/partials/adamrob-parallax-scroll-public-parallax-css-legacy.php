<?php

/**
 * Provides HTML markup for displaying parallax post in LEGACY CSS style
 *
 *
 * @link       http://www.adamrob.co.uk
 * @since      3.0.0
 * @since      3.0.1    Fix. echos was missing from the initial full width div declaration
 * @deprecated 3.5.0    Legacy CSS option is to be superseeded by newer version
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/public/partials
 */
?>

<?php
//Give the entire plugin a container if we are full width
if ($parameters['fullwidth']){ ?>
    <div id="parallax_container<?php echo $postid ?>" class="parallax-window-container <?php echo $parallaxFWStyleClass ?>">
<?php
};

//use CSS Only Parallax
if(wp_is_mobile()&&isset($parameters['mobpsize'])){
?>

<section id="parallax_<?php echo $postid ?>" class="<?php echo $parallaxFWStyleClass ?>" style="<?php echo $parallaxStyle ?> <?php echo $ParallaxImgStyle ?> <?php echo $ParallaxSizeStyle ?>">

<?php 
}else{ 
?>

<section id="parallax_<?php echo $postid ?>" class="adamrob_parallax <?php echo $parallaxFWStyleClass ?> <?php echo $parallaxScrollingClass ?>" style="<?php echo $parallaxStyle ?> <?php echo $ParallaxImgStyle ?> <?php echo $ParallaxSizeStyle ?>" speed="<?php echo $parameters['scrollspeed'] ?>">

<?php
}
?>

	<div id="parallax_<?php echo $postid ?>_content" class="adamrob_pcontainer" style="<?php echo $parallaxStyle ?>">

<?php
	if ($parameters['content']==""){ 
	?>

		<table style="width:100%; height:100%; border-style:none; margin:0;">
			<tr>
				<td class="parallax-header" style="text-align:<?php echo $parameters['hpos'] ?>; vertical-align:<?php echo $parameters['vpos'] ?>; padding:20px; border-style:none;">
					<div id="parallax_<?php echo $postid ?>_posttitle" class="adamrob_parallax_posttitle" style="<?php echo $parameters['headerstyle'] ?>">
						<?php echo $parameters['title'] ?>
					</div>
				</td>
			</tr>
		</table>

	<?php 
	}else{ 
	?>

		<div id="parallax_<?php echo $postid ?>_posttitle" class="adamrob_parallax_posttitle" style="text-align:<?php echo $parameters['hpos'] ?>; padding:20px;">
			<div style="<?php echo $parameters['headerstyle'] ?>">
				<?php echo $parameters['title'] ?>
			</div>
		</div>

		<div id="parallax_<?php echo $postid ?>_postcontent" class="adamrob_parallax_postcontent" id="<?php echo $postid ?>_parallax_content_post" style="padding:20px;">
			<?php echo $parameters['content'] ?>
		</div>

	<?php 
	} 
?>


	</div>

</section>
	
	<?php
	//If we are full width close the container
	if ($parameters['fullwidth']){ ?>
	    </div>
	<?php } ?>