<?php

/**
 * HTML markup for post type help tab: Options
 *
 * @link       http://www.adamrob.co.uk
 * @since      3.0.0
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/admin/partials/help
 */
?>


<H1>Parallax Scroll by adamrob.co.uk</H1>
<H3>Options</H3>
<p>
	<h3>Style</h3>
	<ul>
		<li>
			<b>Enter a post title</b>
			<br/>
			This will be the main title which is displayed over the parallax background. The title can also be hidden. See header style point below.
		</li>
		<li>
			<b>Enter some content</b> <i>optional</i>
			<br/>
			Add some content if required, just like any other post/page.
		</li>
		<li>
			<b>Add Feature Image</b>
			<br/>
			The feature image is your parallax background
		</li>
		<li>
			<b>Parallax Height</b> <i>optional</i>
			<br/>
			Enter a height in pixels you would like the parallax to be. Setting this option will aut-size the parallax based on the content entered. Minimum height is always 100px
		</li>
		<li>
			<b>Parallax Image Size</b> <i>optional</i>
			<br/>
			The parallax image will be scaled based on this value. Specify the width in pixels. Set to 0 to auto set the size of the image (recommended)
		</li>
		<li>
			<b>Horizontal Position</b>
			<br/>
			The horizontal position of the header on the parallax background.
		</li>
		<li>
			<b>Vertical Position</b>
			<br/>
			The vertical position of the header on the parallax background. This setting is ignored if post content is specified.</li>
		<li>
			<b>Header Style</b> <i>optional</i>
			<br/>
			Enter the inline CSS style required for the header eg. font-weight: bold; font-size: large;<br>If you would like to hide the header, type: display: none; 
		</li>
		<li>
			<b>Full Width</b> <i>optional</i>
			<br/>
	        Display the parallax across the full width of the page. This is a work around to get a full width parallax if its not already. This may not work on some themes. Please see the full width help menu for more information.
	    </li>
	</ul>
</p>

<p>
	<h3>Parallax Settings</h3>
	<ul>
		<li>Parallax Speed <i>optional</i>
			<br/>
	        Enter the scrolling speed of the parallax background image. Values between 1 and 10 are valid, 1 being the slowest speed and 10 the quickest. Setting a value of 0 will disable the scrolling of the parallax image, instead leaving the image static.
	    </li>
		<li>Use Parallax.js
			<br/>
	        Parallax.js uses java script to render the parallax effect. The plugin below version 1.0 used to be built around this. It may provide improved performance, responsive images and improved mobile options; however it may also introduce cross platform issues. If the parallax effect does not work as required without this being enabled, try enabling it. It is down to user preference to enable or not. (Please note parallax.js was written by picelcog <a href="https://github.com/pixelcog/parallax.js/">Link</a>
	    </li>
	</ul>
</p>


<p>
	<h3>Mobile Settings</h3>
	<ul>
		<li><b>Mobile: Disable Image</b> <i>optional</i>
			<br/>
			Parallax Scroll can only render the background image on mobile devices with no animation. Select this option if you would rather the background image not display at all on mobile devices.
		</li>
		<li><b>Mobile: Disable Parallax</b> <i>optional</i>
			<br/>
			Parallax Scroll can only render the background image on mobile devices with no animation. Select this option if you would rather not show the entire parallax (including content) when on a mobile device.
		</li>
		<li><b>Mobile: Image Size</b> <i>optional</i>
			<br/>
			Set a size here to scale the image size when on a mobile device. Specify the width in pixels. Set to 0 to auto set the size of the image.
		</li>
	</ul>
</p>
