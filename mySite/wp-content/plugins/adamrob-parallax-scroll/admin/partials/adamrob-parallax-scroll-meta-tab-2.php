<?php

/**
 * HTML markup for meta data tab 2
 *
 * @link       http://www.adamrob.co.uk
 * @since      3.0.0
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/admin/partials
 */
?>


<div class="inside hidden">
    <?php
    	foreach ( $this->meta_fields as $field) {

    		/* we are only interested in tab 2 */
    		if( $field->tab === 1){

    			/* Return the markup for the field */
    			$field->get_markup();

    		}
            
    	}
    ?>

</div>