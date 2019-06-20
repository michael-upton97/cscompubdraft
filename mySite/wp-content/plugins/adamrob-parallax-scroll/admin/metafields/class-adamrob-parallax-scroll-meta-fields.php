<?php

/**
 * Parent abstract class to hold common meta data field
 * data and functions
 *
 * @link       http://www.adamrob.co.uk
 * @since      3.0.0
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/admin/metafields
 */

/**
 * Parent abstract class to hold common meta data field
 * data and functions
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/admin/metafields
 * @author     adamrob <adam@adamrob.co.uk>
 */
abstract class Adamrob_Parallax_Scroll_Meta_Fields {

	/**
	 * Tab number field should belong to.
	 *
	 * @since    3.0.0
	 * @access   public
	 * @var      integer    $tab    
	 */
	public $tab;

	/**
	 * Order number the field should appear within the tab.
	 *
	 * @since    3.0.0
	 * @deprecated 3.1.0 Since the re-write to OOP this is no longer required.
	 * @access   public
	 * @var      integer    $order
	 */
	public $order;

	/**
	 * Label text for the field
	 *
	 * @since    3.0.0
	 * @access   public
	 * @var      string    $label
	 */
	public $label;

	/**
	 * Description text for the field
	 *
	 * @since    3.0.0
	 * @access   public
	 * @var      string    $desc
	 */
	public $desc;

	/**
	 * ID for the field
	 *
	 * @since    3.0.0
	 * @access   public
	 * @var      string    $id
	 */
	public $id;

	/**
	 * field type.
	 *
	 * @since    3.0.0
	 * @deprecated 3.1.0 Since the re-write to OOP this is no longer required. The class dictates the type
	 * @access   public
	 * @var      string    $type
	 */
	public $type;


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    3.0.0
	 */
	public function __construct() {
		return;
	}

	/**
	 * Sets the ID of the field
	 *
	 * @since    3.0.0
	 * @var  	 string 	Required ID of the field
	 */
	protected function set_id( $id ) {

		$this->id = 'parallax_meta_' . $id;

	}

	/**
	 * Returns the raw meta data value for the field
	 *
	 * @since   3.0.0
	 * @access   protected
	 * @param    int    $post_id    The ID of the post containing the meta data
	 * @return  string value
	 */
	protected function get_raw_value($post_id){

        /** Return the value and sanatise */
        return get_post_meta( $post_id, $this->id, true);

	}

	/**
	 * Determines whether or not a value exists in the $_POST collection
	 * identified by the specified key.
	 *
	 * @since   3.0.0
	 * @access   protected
	 * @return  bool              True if the value exists; otherwise, false.
	 */
	protected function post_value_exists() {
	    return ! empty( $_POST[ $this->id ] );
	}

	/**
	 * Deletes the specified meta data associated with the specified post ID 
	 * based on the incoming key.
	 *
	 * @since    3.0.0
	 * @access   protected
	 * @param    int    $post_id    The ID of the post containing the meta data
	 */
	protected function delete_post_meta( $post_id ) {
	     
	    if ( '' !== $this->get_raw_value( $post_id ) ) {
	        delete_post_meta( $post_id, $this->id );
	    }
	     
	}

	/**
	 * Updates/Saves the specified meta data associated with the specified post ID 
	 * based on the incoming key.
	 *
	 * @since    3.0.0
	 * @access   protected
	 * @param    int    $post_id    The ID of the post containing the meta data
	 */
	protected function update_post_meta( $post_id, $meta_value ) {
	     
	    if ( is_array( $_POST[ $this->id ] ) ) {
	        $meta_value = array_filter( $_POST[ $this->id ] );
	    }
	 
	    update_post_meta( $post_id, $this->id, $meta_value );
	}

}
