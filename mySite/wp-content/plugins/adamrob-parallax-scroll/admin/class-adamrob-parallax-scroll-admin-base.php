<?php

/**
 * The base/parent admin class for child objects
 * in the admin area
 *
 * @link       http://www.adamrob.co.uk
 * @since      3.0.0
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/admin
 */

/**
 * The base/parent admin class for child objects
 * in the admin area
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/admin
 * @author     adamrob <adam@adamrob.co.uk>
 */
abstract class Adamrob_Parallax_Scroll_Admin_Base{

	/**
	 * The ID of this plugin.
	 *
	 * @since    3.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    3.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Holds an object array of the plugins keys.
	 *
	 * @since    3.0.0
	 * @access   private
	 * @var      object 	$plugin_keys 
	 */
	private $plugin_keys;


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    3.0.0
	 * @param    string    $plugin_name       The name of this plugin.
	 * @param    string    $version           The version of this plugin.
	 * @param    object    $plugin_keys       An object converted array that stores the plugins keys.
	 */
	public function __construct( $plugin_name, $version, $plugin_keys ) {
		
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->plugin_keys = $plugin_keys;

	}

	/**
	 * add_admin_notice
	 *
	 * Saves the required message to the admin
	 * message array with a timeout period.
	 * The admin messages will then be shown as 
	 * part of the show_admin_notice function in
	 * admin class
	 * 
	 * @since 	3.0.0
	 */
	protected function add_admin_notice( $message ){

		/** Return the current list of notices */
		$notices = get_transient( $this->get_admin_notice_key() );
	                
        if ( $notices === false ) {
                $new_notices[] = $message;
                set_transient( $this->get_admin_notice_key(), $new_notices, 120 );
        } else {
                $notices[] = $message;
                set_transient( $this->get_admin_notice_key(), $notices, 120 );
        }
	}


	/**
	 * Plugin upgrade detected
	 * 
	 * The admin class will call this function when an update
	 * has been detected. The object can then perform any
	 * necersary jobs for that upgrade.
	 *
	 * This function should be overriden by the child class
	 *
	 * @since  3.0.0
	 */
	protected function plugin_upgrade_tasks(){
		return;
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     3.0.0
	 * @access    protected 
	 * @return    string    The name of the plugin.
	 */
	protected function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     3.0.0
	 * @access    protected 
	 * @return    string    The version number of the plugin.
	 */
	protected function get_version() {
		return $this->version;
	}

	/**
	 * Retrieve the keys object
	 *
	 * @since     3.0.0
	 * @access    protected 
	 * @return    string    Object array of the plugins keys
	 */
	protected function get_plugin_keys() {
		return $this->plugin_keys;
	}

	/**
	 * Retrieve the shortcode key for the plugin.
	 *
	 * @since     3.0.0
	 * @access    protected 
	 * @return    string    shortcode key
	 */
	protected function get_shortcode_key() {
		return $this->plugin_keys->shortcode_key;
	}

	/**
	 * Retrieve the postype key for the plugin.
	 *
	 * @since     3.0.0
	 * @access    protected 
	 * @return    string    posttype key
	 */
	protected function get_post_type_key() {
		return $this->plugin_keys->post_type_key;
	}

	/**
	 * Retrieve the admin notice settings key.
	 *
	 * @since     3.0.0
	 * @access    protected 
	 * @return    string    admin notice key
	 */
	protected function get_admin_notice_key() {
		return $this->plugin_keys->admin_notice_key;
	}

	/**
	 * Retrieve the post types meta data key.
	 *
	 * @since     3.0.0
	 * @access    protected 
	 * @return    string    meta key
	 */
	protected function get_post_meta_key() {
		return $this->plugin_keys->post_meta_key;
	}

	/**
	 * Retrieve the object array of private option keys.
	 *
	 * @since     3.0.0
	 * @access    protected 
	 * @return    object    object array of private setting keys
	 */
	protected function get_private_option_keys() {
		return $this->plugin_keys->private_options;
	}

}