<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.adamrob.co.uk
 * @since      3.0.0
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and requires an instance
 * of the loader object so this admin class can add its
 * own WP hooks for its child classes
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/public
 * @author     adamrob <adam@adamrob.co.uk>
 */
class Adamrob_Parallax_Scroll_Public {

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
	 * An instance of the loader class
	 *
	 * The loader class is used to load all WP hooks
	 *
	 * @since    3.0.0
	 * @access   private
	 * @var      object()    $loader
	 */
	private $loader;

	/**
	 * Holds the key for the shortcode
	 *
	 * @since 	3.0.0
	 * @var   	string 	   $shortcode_key
	 */
	private $shortcode_key;

	/**
	 * The post type key
	 *
	 * @since    3.0.0
	 * @access   private
	 * @var      string    $post_type_key    The post type key.
	 */
	private $post_type_key;

	/**
	 * Holds an instance of the shortcode class
	 *
	 * @since 	3.0.0
	 * @var   	Adamrob_Parallax_Scroll_Shortcode 	   $plugin_shortcode
	 */
	protected $plugin_shortcode;


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, Adamrob_Parallax_Scroll_Loader $loader, $shortcode_key, $post_type_key ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->loader = $loader;
		$this->shortcode_key = $shortcode_key;
		$this->post_type_key = $post_type_key;

		$this->load_dependencies();
		$this->instantiate_classes();
		$this->define_shortcode_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Adamrob_Parallax_Scroll_Shortcode. Defines the shortcode for displaying parallax'
	 *
	 * @since    3.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for defining all actions that occur in the admin areas postype.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-adamrob-parallax-scroll-shortcode.php';

	}

	/**
	 * Instantiates and creates a reference for required public classes.
	 *
	 *
	 * @since    3.0.0
	 * @access   private
	 */
	private function instantiate_classes() {

		/**
		 * Instantiate the post type class
		 */
		$this->plugin_shortcode = new Adamrob_Parallax_Scroll_Shortcode( 
														$this->plugin_name, 
														$this->version, 
														$this->shortcode_key,
														$this->post_type_key 
													 );

	}


	/**
	 * Register all of the hooks related to the shortcode functionality
	 * of the plugin.
	 *
	 * @since    3.0.0
	 * @access   private
	 */
	private function define_shortcode_hooks() {

		$this->loader->add_action( 
			'wp_enqueue_scripts', 
			$this->plugin_shortcode,
			 'register_styles' 
		);

		$this->loader->add_action( 
			'wp_enqueue_scripts', 
			$this->plugin_shortcode,
			 'register_scripts' 
		);

		$this->loader->add_shortcode( 
			$this->shortcode_key, 
			$this->plugin_shortcode, 
			'show_shortcode'
		);

	}

}
