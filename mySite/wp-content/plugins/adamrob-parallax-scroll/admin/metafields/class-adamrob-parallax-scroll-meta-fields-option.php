<?php

/**
 * Child class for option fields
 * data and functions
 *
 * @link       http://www.adamrob.co.uk
 * @since      3.0.0
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/admin/metafields
 */

/**
 * Child class for option fields
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/admin/metafields
 * @author     adamrob <adam@adamrob.co.uk>
 */
class Adamrob_Parallax_Scroll_Meta_Fields_Option extends Adamrob_Parallax_Scroll_Meta_Fields {

	/**
	 * Array containing the valid options
	 * EG: array (
	 *               'one' 	=> array (
	 *                   'label' => 'Left',
	 *                   'value' => 'left'
	 *               ),
	 *               'two' 	=> array (
	 *                   'label' => 'Centre',
	 *                   'value' => 'center'
	 *               ),
	 *               'three' => array (
	 *                   'label' => 'Right',
	 *                   'value' => 'right'
	 *               )
	 *
	 * @since    3.0.0
	 * @access   protected
	 * @var      array 	$options
 	 * }    
	 */
	protected $options;


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
						$id,
						$options
					) {

		/** Set parent data */
		$this->type 	= 'option';
		$this->tab 		= $tab;
		$this->order 	= $order;
		$this->label 	= $label;
		$this->desc 	= $desc;

		$this->set_id( $id);
		
		/** Set number data */
		$this->options 	= $options;

	}


	/**
	 * Returns the required HTML markup to display
	 * the numeric field on a page
	 * 
	 * @param  boolean $echo Set wether the markup should be echoed
	 * @return string
	 */
	public function get_markup( $echo = true){

        $value = $this->get_value();

		$markup = '<p class="meta-row-field-block" >';
		$markup = $markup . '<label for="' . $this->id . '" class="meta-row-title">' . $this->label . '</label>';
        $markup = $markup .'<select name="' . $this->id . '" id="' . $this->id . '" class="regular-text" >';
                
        foreach ($this->options as $option) {
        	
        	$markup = $markup . '<option value="' . $option['value'] . '"' . (($this->get_value() == $option['value']) ? ' selected="selected"' : '') . '>' . $option['label'] . '</option>';
        }

        $markup = $markup . '</select><br /><span class="description meta-row-description">' . $this->desc . '</span>';
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

		return $this->sanitize_option( $this->get_raw_value( get_the_ID() ) );

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
	            $this->sanitize_option( $_POST[ $this->id ] )
	        );
	 
	    } else {
	        $this->delete_post_meta( $post_id);
	    }	

	}

	/**
	 * Sanatise function for option fields
	 *
	 * @since  3.0.0 
	 * @param  string $var    
	 * @return string 			Sanatised string
	 */
	private function sanitize_option($var){
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
