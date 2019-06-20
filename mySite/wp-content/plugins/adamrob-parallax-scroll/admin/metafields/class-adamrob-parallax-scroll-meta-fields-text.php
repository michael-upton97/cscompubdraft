<?php

/**
 * Child class for text fields
 * data and functions
 *
 * @link       http://www.adamrob.co.uk
 * @since      3.0.0
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/admin/metafields
 */

/**
 * Child class for text fields
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/admin/metafields
 * @author     adamrob <adam@adamrob.co.uk>
 */
class Adamrob_Parallax_Scroll_Meta_Fields_Text extends Adamrob_Parallax_Scroll_Meta_Fields {

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
		$this->type 	= 'text';
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
		$markup = $markup . '<input type="text" name="' . $this->id . '" id="' . $this->id . '" value="' . $this->get_value() . '" size="30" class="regular-text" />
                    <br />
                    <span class="description meta-row-description">' . $this->desc . '</span>';
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

		return $this->sanitize_string( $this->get_raw_value( get_the_ID() ) );

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
	            $this->sanitize_string( $_POST[ $this->id ] )
	        );
	 
	    } else {
	        $this->delete_post_meta( $post_id);
	    }	

	}

	/**
	 * Sanatise function for option strings
	 *
	 * @since  3.0.0 
	 * @param  string $var    
	 * @return string 			Sanatised string
	 */
	private function sanitize_string($var){
		//Sanitizes and validates a string
		//$url="Is Peter <smart> & funny?";
		//becomes "Is Peter &lt;smart&gt; &amp; funny?"

		//check something was passed in
		if (!isset($var)){
			return(null);
		}

		$sanitized_val = $var;

		/** Remove any markup language */
		$sanitized_val = esc_attr( $sanitized_val );

		//Check type
		if ( gettype( $sanitized_val ) != "string" ){
			return(null);
		}

		//Trim
		$sanitized_val = trim( $sanitized_val );

		//Sanitize
		$sanitized_val = filter_var( $sanitized_val, FILTER_SANITIZE_STRING);
		
		//Now check
		if ($sanitized_val===false) {
			//value is not int
			//not valid
			return(null);
		} else {
			return($sanitized_val);
		}

		//Something not right?
		return(null);
	}

}
