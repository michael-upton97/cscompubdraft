<?php

/**
 * Child class fo
 * data and functions
 *
 * @link       http://www.adamrob.co.uk
 * @since      3.0.0
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/admin/metafields
 */

/**
 * Child class for number fields
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/admin/metafields
 * @author     adamrob <adam@adamrob.co.uk>
 */
class Adamrob_Parallax_Scroll_Meta_Fields_Number extends Adamrob_Parallax_Scroll_Meta_Fields {

	/**
	 * Minimum value allowed in field.
	 *
	 * @since    3.0.0
	 * @access   protected
	 * @var      integer    $min    
	 */
	protected $min;

	/**
	 * Maximum value allowed in field.
	 *
	 * @since    3.0.0
	 * @access   protected
	 * @var      integer    $max
	 */
	protected $max;

	/**
	 * Holds whether the field is an int or a real
	 *
	 * @since    3.0.0
	 * @access   protected
	 * @var      string    $datatype 	integer/float
	 */
	protected $datatype;

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
						$min,
						$max,
						$datatype
					) {

		/** Set parent data */
		$this->type 	= 'number';
		$this->tab 		= $tab;
		$this->order 	= $order;
		$this->label 	= $label;
		$this->desc 	= $desc;

		$this->set_id( $id);
		
		/** Set number data */
		$this->min 		= $min;
		$this->max 		= $max;
		$this->datatype = $datatype;

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
		$markup = $markup . '<input type="number" name="' . $this->id . '" id="' . $this->id . '" value="' . $this->get_value() . '" size="30" min="' . $this->min . '" max="' . $this->max . '" class="regular-text" />
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

        /** sanatise based on data type */
		if ($this->datatype === 'integer'){

			return $this->sanitize_int( $this->get_raw_value( get_the_ID() ) );

		} elseif ($this->datatype === 'float'){

			return  $this->sanitize_float( $this->get_raw_value( get_the_ID() ) );

		} else {

			return 0;

		}

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
	 
	        /** sanatise based on data type */
			if ($this->datatype === 'integer'){

				$value = $this->sanitize_int( $_POST[ $this->id ] );

			} elseif ($this->datatype === 'float'){

				$value = $this->sanitize_float( $_POST[ $this->id ] );

			} else {

				$value = 0;

			}


	        $this->update_post_meta(
	            $post_id,
	            $value
	        );
	 
	    } else {
	        $this->delete_post_meta( $post_id);
	    }	

	}

	/**
	 * Sanatise function for integers
	 *
	 * @since  3.0.0 
	 * @param  integer $var    
	 * @return integer 			Sanatised int
	 */
	private function sanitize_int($var){

		/** Ensure there is a value */
		if (!isset($var)){
			return(null);
		}

		$sanitized_val = $var;

		/** Remove any markup language */
		$sanitized_val = esc_attr( $sanitized_val );

		/** Check the type is correct */
		if ( ! is_numeric($sanitized_val)){
			return(null);
		}

		/** trim the value. Ints have no spaces! */
		$sanitized_val = trim( $sanitized_val );

		/** check value fits within min/max */
		if ( $this->min != null && $sanitized_val < $this->min ){
			$sanitized_val = $this->min;
		}
		if ( $this->max != null && $sanitized_val > $this->max ){
			$sanitized_val = $this->max;
		}

		/** Sanatise */
		$sanitized_val = filter_var($sanitized_val, FILTER_SANITIZE_NUMBER_INT);
		$sanitized_val = filter_var($sanitized_val, FILTER_VALIDATE_INT);

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

	/**
	 * Sanatise function for floating point
	 *
	 * @since  3.0.0 
	 * @param  float $var    
	 * @return float 			Sanatised float
	 */
	private function sanitize_float($var){

		/** Ensure there is a value */
		if (!isset($var)){
			return(null);
		}

		$sanitized_val = $var;

		/** Remove any markup language */
		$sanitized_val = esc_attr( $sanitized_val );

		/** Check the type is correct */
		if ( gettype($sanitized_val) != "double" ){
			return(null);
		}

		/** trim the value. Ints have no spaces! */
		$sanitized_val = trim( $sanitized_val );

		/** check value fits within min/max */
		if ( $this->min != null && $sanitized_val < $this->min ){
			$sanitized_val = $this->min;
		}
		if ( $this->max != null && $sanitized_val > $this->max ){
			$sanitized_val = $this->max;
		}

		/** Sanatise */
		$sanitized_val = filter_var($sanitized_val, FILTER_SANITIZE_NUMBER_FLOAT);
		$sanitized_val = filter_var($sanitized_val, FILTER_VALIDATE_FLOAT);

		//Now check
		if ( $sanitized_val === false) {
			//not valid
			return(null);
		} else {
			//valid
			return($sanitized_val);
		}

		//Something not right?
		return(null);
	}

}
