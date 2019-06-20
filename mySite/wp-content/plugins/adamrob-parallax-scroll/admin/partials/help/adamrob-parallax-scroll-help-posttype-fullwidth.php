<?php

/**
 * HTML markup for post type help tab: Fullwidth
 *
 * @link       http://www.adamrob.co.uk
 * @since      3.0.0
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/admin/partials/help
 */
?>


<H1>Parallax Scroll by adamrob.co.uk</H1>
<H3>Full Width Issues</H3>
<p>
	Parallax scroll has been written to work across as many different themes as possible, however as everyones wordpress setup is different, and every theme is different it is very difficult if not near impossible to guarente that the plugin will work on every site. Parallax scroll is built and tested using the standard wordpress themes; this is the only base line that is availble to work against; therfore if you are having issues, please test it against the standard theme to check if its a fault with the plugin or the theme.
</p>
<p>
	The full width issue is a common one, where the parallax does not span the full width of the page. Parallax scroll is designed to be full width out of the box. As standard it will size to the full width of the post. If this doesn't work as required, a full width option is availble. This is a bit of a hack to resize the parallax to the full width of the content area of the page/post. Because this is a bit of a hack, it may not appear correctly for everyone.
</p>
<p>
	Why is this an issue on some themes? Well some themes, even though they claim are full width themes, are not actually full width at all. A lot of themes will actually be setup using divs with margins either side. They trick you into thinking its full width by setting the colors and borders to the same color. Unfortunatly, on themes like this its impossible for me to cater for, however you can modify the fullwidth.js script to target the specific width required yourself.
</p>
