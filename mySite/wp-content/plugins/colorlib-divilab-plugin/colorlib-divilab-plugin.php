<?php 
/*
Plugin Name: Colorlib Plugin
Description: Quick Custom Solution Plugin for Implementing Custom Solution.
Version: 1.0.0
Author: Colorlib
Author URI: https://colorlib.com
License: GNU General Public License (Version 2 - GPLv2)
*/

function add_custom_scripts(){ ?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$('.shapely_home_parallax:first-child section').append("<div id='parallax-arrow'><i class='fa fa-angle-double-down' aria-hidden='true'></i></div>");
                        var second_child = $('.shapely_home_parallax:first-child').next().attr('id');
                       
		});
	</script>
<?php }
add_action('wp_footer', 'add_custom_scripts', 99);

function add_custom_styles(){ ?>
	<style type="text/css">
#parallax-arrow {
    background: #fff0;
    padding: 4px 12px;
    color: #0e1015;
    position: fixed;
    left: 47.8%;
    bottom: 0;
    font-size: 40px;
    cursor: pointer;
    z-index: 100;
    display: none;
}
	</style>
<?php }
add_action('wp_footer', 'add_custom_styles');
