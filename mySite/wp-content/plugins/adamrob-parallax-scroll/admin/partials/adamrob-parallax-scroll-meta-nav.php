<?php

/**
 * Provide a admin area meta data navigation view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.adamrob.co.uk
 * @since      3.0.0
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/admin/partials
 */
?>


<div id="adamrob-parallax-scroll-meta-navigation">
    <h2 class="nav-tab-wrapper current">
        <a class="nav-tab nav-tab-active" href="javascript:;">Style Options</a>
        <a class="nav-tab" href="javascript:;">Parallax Engine</a>
        <a class="nav-tab" href="javascript:;">Mobile Options</a>
    </h2>

    <?php
        include_once( 'adamrob-parallax-scroll-meta-tab-1.php' );
        include_once( 'adamrob-parallax-scroll-meta-tab-2.php' );
        include_once( 'adamrob-parallax-scroll-meta-tab-3.php' );
    ?>
</div>