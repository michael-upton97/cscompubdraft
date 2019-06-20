<?php

/**
 * Child class for check box fields
 * data and functions
 *
 * @link       http://www.adamrob.co.uk
 * @since      3.0.0
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/admin/metafields
 */

/**
 * Child class for check box fields
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/admin/metafields
 * @author     adamrob <adam@adamrob.co.uk>
 */
class Adamrob_Parallax_Scroll_Meta_Fields_CheckBox extends Adamrob_Parallax_Scroll_Meta_Fields {


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    3.0.0
	 */
	public function __construct( 
						$tab,
						$order,
						$label,
						$desc,
						$id
					) {

		/** Set parent data */
		$this->type 	= 'checkbox';
		$this->tab 		= $tab;
		$this->order 	= $order;
		$this->label 	= $label;
		$this->desc 	= $desc;

		$this->set_id( $id);

	}


	/**
	 * Returns the required HTML markup to display
	 * the numeric field on a page
	 * 
	 * @param  boolean $echo Set wether the markup should be echoed
	 * @return string
	 */
	public function get_markup( $echo = true){

		$markup = '<p class="meta-row-field-block" >';
		$markup = $markup . '<label for="' . $this->id . '" class="meta-row-title">' . $this->label . '</label>';
		$markup = $markup . '<input type="checkbox" name="' . $this->id . '" id="' . $this->id . '" ' . ($this->get_value() ? ' checked="checked"' : '') . '/>
                    <label for="' . $this->id . '">' . $this->desc . '</label>';
        $markup = $markup . '</p>';

        /** Echo or return the markup */
        if( $echo ){
        	echo $markup;
        }
        else{
        	return $markup;
        }

	}

	/**
	 * Returns the current value of the field
	 * fully sanatised for the datatype
	 * 
	 * @return mixed The fields value
	 */
	private function get_value(){

        /** Return the value and sanatise */
        return $this->sanitize_boolean( $this->get_raw_value( get_the_ID() ) );

	}

	/**
	 * Checks the POST data for valid data and saves /
	 * deletes if required
	 *
	 * @since   3.0.0
	 * @param    int    $post_id    The ID of the post containing the meta data
	 * @return  void
	 */
	public function save_value($post_id){

	    if ( $this->post_value_exists() ) {

	        $this->update_post_meta(
	            $post_id,
	            $this->sanitize_boolean( $_POST[ $this->id ] )
	        );
	 
	    } else {
	        $this->delete_post_meta( $post_id);
	    }	

	}

	/**
	 * Sanatise function for booleans
	 *
	 * @since  3.0.0 
	 * @param  boolean $var    
	 * @return boolean 			Sanatised bool
	 */
	private function sanitize_boolean($var){
		//Sanitizes and validates a URL

		//check something was passed in
		if (!isset($var)){
			return(null);
		}

		$sanitized_val = $var;

		/** Remove any markup language */
		$sanitized_val = esc_attr( $sanitized_val );

		//Check type
		//if ( ! is_bool($sanitized_val) ){
		//	return(null);
		//}

		//Trim
		$val=trim($sanitized_val);

		if ( ! $sanitized_val === 'on' ){
			return(null);
		}

		/** Sanatise */
		/*
		//$sanitized_val=filter_var($sanitized_val, FILTER_VALIDATE_BOOLEAN);

		//Now check
		if ( $sanitized_val === false ) {
			//not valid
			return(null);
		} else {
			//valid
			return($sanitized_val);
		}
		*/

		return($sanitized_val);
		//Something not right?
		return(null);
	}

}
