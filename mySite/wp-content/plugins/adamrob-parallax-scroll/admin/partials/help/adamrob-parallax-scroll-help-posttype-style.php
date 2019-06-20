<?php

/**
 * HTML markup for post type help tab: Style
 *
 * @link       http://www.adamrob.co.uk
 * @since      3.0.0
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/admin/partials/help
 */
?>


<H1>Parallax Scroll by adamrob.co.uk</H1>
<H3>Extending with CSS styles</H3>
<p>
	If you define a title and/or content, the following can be used to change the styles:
	<ul>
		<li><b>"adamrob_parallax_posttitle"</b> <i>CSS Class</i>
			<br/>
	        Use this class to alter the div the header is contained in. The class can be entered into your theme CSS or can be altered in the plugin css. Altering the plugin CSS will mean any future updates will overrite your code.
		</li>
		<li><b>"adamrob_parallax_postcontent"</b> <i>CSS Class</i>
			<br/>
	        Use this class to alter the div the content is contained in. The class can be entered into your theme CSS or can be altered in the plugin css. Altering the plugin CSS will mean any future updates will overrite your code.
		</li>
	</ul>
	<br/>
	In addition, parallax' can be targeted directly using the ID of the parallax. This is usefull when you want to change the style of only 1 or a selection of parallax'
	<ul>
		<li><b>"parallax_<"ID">_posttitle"</b> <i>ID</i>
			<br/>
	        Replace <"ID"> with the ID number of your parallax you want to target (ie, the same ID number as used in the shortcode). Use this ID to alter the div the header is contained in for the specific parallax. The CSS can be entered into your theme CSS or can be altered in the plugin css. Altering the plugin CSS will mean any future updates will overrite your code.
	    </li>
		<li><b>"parallax_<"ID">_postcontent"</b> <i>ID</i>
			<br/>
	        Replace <"ID"> with the ID number of your parallax you want to target (ie, the same ID number as used in the shortcode). Use this ID to alter the div the content is contained in for the specific parallax. The CSS can be entered into your theme CSS or can be altered in the plugin css. Altering the plugin CSS will mean any future updates will overrite your code.
	    </li>
	</ul>
</p>
