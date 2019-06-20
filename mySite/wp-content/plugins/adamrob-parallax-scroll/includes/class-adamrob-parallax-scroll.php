<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://www.adamrob.co.uk
 * @since      3.0.0
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      3.0.0
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/includes
 * @author     adamrob <adam@adamrob.co.uk>
 */
class Adamrob_Parallax_Scroll {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    3.0.0
	 * @access   private
	 * @var      Adamrob_Parallax_Scroll_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	private $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    3.0.0
	 * @access   private
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	private $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    3.0.0
	 * @access   private
	 * @var      string    $version    The current version of the plugin.
	 */
	private $version;

	/**
	 * Holds an object array of the plugins keys.
	 *
	 * @since    3.0.0
	 * @access   private
	 * @var      object 	$plugin_keys {
 	 * 		Required. An object encoded array of the plugin keys.
 	 *     	@type string $shortcode_key 	The shortcode key. 
 	 *      @type string $post_type_key 	The post type key.
 	 *      @type string $admin_notice_key 	The admin notice key.
 	 *      @type string $post_meta_key 	The post types meta key.
 	 *      @type object $private_options 	Holds an object array of all private option keys.
	 */
	private $plugin_keys;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    3.0.0
	 */
	public function __construct($version) {
		
		$this->version = $version;
		$this->plugin_name 	 = 'adamrob-parallax-scroll';
		$this->plugin_keys = $this->build_plugin_keys();

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Adamrob_Parallax_Scroll_Loader. Orchestrates the hooks of the plugin.
	 * - Adamrob_Parallax_Scroll_i18n. Defines internationalization functionality.
	 * - Adamrob_Parallax_Scroll_admin. Defines all hooks required for admin area'
	 * - Adamrob_Parallax_Scroll_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    3.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-adamrob-parallax-scroll-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-adamrob-parallax-scroll-i18n.php';

		/**
		 * The parent class for all admin classes
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-adamrob-parallax-scroll-admin-base.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-adamrob-parallax-scroll-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-adamrob-parallax-scroll-public.php';

		/* Instantiate the loader object class */
		$this->loader = new Adamrob_Parallax_Scroll_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Adamrob_Parallax_Scroll_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    3.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Adamrob_Parallax_Scroll_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    3.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		if ( ! is_admin() ) return;

		/*
		 * Create the admin class
		 * and add the required wordpress hooks
		 */
		$plugin_admin = new Adamrob_Parallax_Scroll_Admin( 
									$this->get_plugin_name(), 
									$this->get_version(), 
									$this->get_loader(),
									$this->get_plugin_keys() 
								);

		$this->loader->add_action( 'admin_init', $plugin_admin, 'check_update_version' );
		$this->loader->add_action( 'admin_notices', $plugin_admin, 'show_admin_notice' );
		$this->loader->add_filter( 'plugin_row_meta', $plugin_admin, 'show_plugin_row_meta', 10, 2 );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    3.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Adamrob_Parallax_Scroll_Public( 
										$this->get_plugin_name(), 
										$this->get_version(),
										$this->get_loader(),
										$this->get_shortcode_key(),
										$this->get_post_type_key() 
									);

	}


	/**
	 * Builds an object array of the keys required 
	 * for the plugin.
	 *
	 * @since  3.0.0
	 * @return object 	$plugin_keys {
 	 * 		Required. An object encoded array of the plugin keys.
 	 *     	@type string $shortcode_key 	The shortcode key. 
 	 *      @type string $post_type_key 	The post type key.
 	 *      @type string $admin_notice_key 	The admin notice key.
 	 *      @type string $post_meta_key 	The post types meta key.
 	 *      @type object $private_options 	Holds an object array of all private option keys.
	 */
	private function build_plugin_keys(){

		$pvtoptionkeys = array(
						'version' 	=> $this->get_plugin_name() . '-op-version' 
						);

		$keysarray = array(
					'shortcode_key' 		=> 'parallax-scroll',
					'post_type_key' 		=> 'parallax_scroll',
					'admin_notice_key' 		=> $this->get_plugin_name() . '-admin-notice',
					'post_meta_key' 		=> 'parallax_scroll_meta',
					'private_options'		=> (object) $pvtoptionkeys
					);

		/** Convert the array to an object so we can access it as an object */
		return (object) $keysarray;
	}


	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    3.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     3.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     3.0.0
	 * @return    Adamrob_Parallax_Scroll_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     3.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Retrieve the shortcode key for the plugin.
	 *
	 * @since     3.0.0
	 * @return    string    shortcode key
	 */
	public function get_shortcode_key() {
		return $this->plugin_keys->shortcode_key;
	}

	/**
	 * Retrieve the postype key for the plugin.
	 *
	 * @since     3.0.0
	 * @return    string    posttype key
	 */
	public function get_post_type_key() {
		return $this->plugin_keys->post_type_key;
	}

	/**
	 * Retrieve the keys object
	 *
	 * @since     3.0.0
	 * @access    public 
	 * @return    string    Object array of the plugins keys
	 */
	public function get_plugin_keys() {
		return $this->plugin_keys;
	}

}
