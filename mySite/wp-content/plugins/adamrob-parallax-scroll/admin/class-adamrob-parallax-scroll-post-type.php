<?php

/**
 * Class for creating the parallax scroll post type
 *
 * @link       http://www.adamrob.co.uk
 * @since      3.0.0
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/admin
 */

/**
 * Class for creating the parallax scroll post type
 *
 * Provides the hooks required for creating the post type
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/admin
 * @author     adamrob <adam@adamrob.co.uk>
 */
class Adamrob_Parallax_Scroll_Post_Type extends Adamrob_Parallax_Scroll_Admin_Base{

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    3.0.0
	 * @param    string    $plugin_name       The name of this plugin.
	 * @param    string    $version           The version of this plugin.
	 * @param    object    $plugin_keys       An object converted array that stores the plugins keys. 
	 */
	public function __construct( $plugin_name, $version, $plugin_keys ) {

		/** Pass the mandatory arguments to the parent class where they are processed/stored */
		parent::__construct( $plugin_name, $version, $plugin_keys );

	}

	/**
	 * Creates the post type
	 *
	 * Requires an add action hook with tag 'init'
	 * This class is instanced in the main plugin include.
	 * That instance should then be passed to the loader class to initiate the hook
 	 *
	 * @since    3.0.0
	 */
	public function add_post_type(){
        
        //Build the require labels for post type
		$labels = array(
	        'name' 				 => esc_html_x( 'Parallax Scroll', 'post type name', $this->get_plugin_name() ),
	        'singular_name' 	 => esc_html_x( 'Parallax Scroll', 'post type singular name', $this->get_plugin_name() ),
	        'add_new' 			 => esc_html__( 'Add New' , $this->get_plugin_name()),
	        'add_new_item' 		 => esc_html__( 'Add New Parallax', $this->get_plugin_name() ),
	        'edit_item' 		 => esc_html__( 'Edit Parallax', $this->get_plugin_name() ),
	        'new_item' 			 => esc_html__( 'New Parallax', $this->get_plugin_name() ),
	        'view_item' 		 => esc_html__( 'View Parallax', $this->get_plugin_name() ),
	        'search_items' 		 => esc_html_x( 'Search Parallax Items', 'post type search items', $this->get_plugin_name() ),
	        'not_found' 		 => esc_html_x( 'No parallax items found', 'post type not found', $this->get_plugin_name() ),
	        'not_found_in_trash' => esc_html_x( 'No parallax items found in Trash', 'post type not found in trash', $this->get_plugin_name() ),
	        'parent_item_colon'  => esc_html_x( 'Parent Parallax:', 'post type parent colon', $this->get_plugin_name() ),
	        'menu_name' 		 => esc_html_x( 'Parallax Scroll', 'post type menu name', $this->get_plugin_name() ),
    	);

		//build arguemnts for post type
	    $args = array(
	        'labels' 				=> $labels,
	        'hierarchical' 			=> false,
	        'description' 			=> 'Parallax Scroll',
	        'supports' 				=> array( 'title', 'editor', 'thumbnail' ),
	        'public' 				=> false, //cam this be false??
	        'show_ui' 				=> true,
	        'show_in_menu' 			=> true,
	        'menu_position' 		=> NULL, //default pos below comments
	        'menu_icon' 			=> 'dashicons-slides',
	        'show_in_nav_menus' 	=> false,
	        'publicly_queryable' 	=> false,
	        'exclude_from_search' 	=> true,
	        'has_archive' 			=> false,
	        'query_var' 			=> true,
	        'can_export' 			=> true,
	        'rewrite' 				=> true,
	        'capability_type' 		=> 'page'
	    );

	    //register the post type
	    register_post_type( $this->get_post_type_key(), $args );
	}

	/**
	 * Defines the columns we require on the post type
	 *
	 * Requires an add filter hook with tag 'manage_<posttypekey>_posts_columns'
	 * This class is instanced in the main plugin include.
	 * That instance should then be passed to the loader class to initiate the hook
	 *
	 * 'manage_edit-<posttypekey>_columns' supplanted by 'manage_<posttypekey>_posts_columns' as of WP3.1
	 *
 	 *
	 * @since    3.0.0
 	 * @param 	 array 	$columns {
 	 * 		Required. Post type columns.
 	 *     	@type string $key The column key. 
 	 *      @type string $title The column title.
 	 * }
	 */
    public function display_columns($columns) {

    	/*
    	 * discard the default columns and rebuild the array
		 * with our new columns required in admin 
		 */
		$columns=array(
	    	'cb'		=> '<input type="checkbox" />',
	    	'title' 	=> esc_html__('Parallax Name', $this->get_plugin_name()),
		    'shortcode' => esc_html__('Shortcode', $this->get_plugin_name()),
		    'author' 	=> esc_html__('Author', $this->get_plugin_name()),
	    	'date' 		=> esc_html__('Date', $this->get_plugin_name())
    	);
    	return $columns;
    }
 

	/**
	 * This function should be called whenever a value for a custom column should be output for a custom post type
	 *
	 * Requires an add filter hook with tag 'manage_${post_type}_posts_custom_columns'
	 * This class is instanced in the main plugin include.
	 * That instance should then be passed to the loader class to initiate the hook
	 *
 	 *
	 * @since    3.0.0
	 * @param 	 string   $column_name    Required    The name of the column to display
	 * @param 	 int      $post_id        Required    The ID of the current post. Can also be taken from the global $post->ID
	 */
 	public function custom_columns_output($column_name, $post_id){
	    
 		/*
 		 * Display the shortcode required to show that particular
 		 * parallax in the shortcode column
 		 */

	    switch ($column_name) {
		    case 'shortcode'  :
		        echo '[' . $this->get_shortcode_key() . ' id="' . $post_id . '"]';
	            break;
		 
		    default:
		        break;
	    }

 	}

}
