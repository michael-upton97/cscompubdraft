<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.adamrob.co.uk
 * @since      3.0.0
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and requires an instance
 * of the loader object so this admin class can add its
 * own WP hooks for its child classes.
 *
 * Each part of the admin area should be treated as an object
 * and as such have its own class, eg, post type, help pages etc.
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/admin
 * @author     adamrob <adam@adamrob.co.uk>
 */
class Adamrob_Parallax_Scroll_Admin extends Adamrob_Parallax_Scroll_Admin_Base{

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
	 * Holds an object array all the sub objects (classes)
	 * instantiated in the admin area.
	 *
	 * @since    3.0.0
	 * @access   private
	 * @var      object 	$plugin_keys 
	 */
	private $instantiated_objects;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    3.0.0
	 * @param    string    $plugin_name    The name of this plugin.
	 * @param    string    $version        The version of this plugin.
	 * @param 	 object    $loader         An instance of the loader class
	 * @param 	 string    $shortcode_key  The shortcode key
	 */
	public function __construct( $plugin_name, $version, Adamrob_Parallax_Scroll_Loader $loader, $plugin_keys ) {

		/** Pass the mandatory arguments to the parent class where they are processed/stored */
		parent::__construct( $plugin_name, $version, $plugin_keys );

		$this->loader = $loader;

		$this->load_dependencies();
		$this->instantiate_classes();
		$this->define_posttype_hooks();
		$this->define_metadata_hooks();
		$this->define_help_hooks();

	}


	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Adamrob_Parallax_Scroll_Post_Type. 	Defines custom post type for parallax'
	 * - Adamrob_Parallax_Scroll_Meta_Box. 		Defines all custom meta for post type.
	 * - Adamrob_Parallax_Scroll_Admin_Help.	Defines all required help tabs for admin area.
	 *
	 * @since    3.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for defining all actions that occur in the admin areas postype.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-adamrob-parallax-scroll-post-type.php';

		/**
		 * The class responsible for defining all actions that occur for the post types meta data
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-adamrob-parallax-scroll-meta-box.php';

		/**
		 * The class responsible for defining all actions that occur for the help tabs.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-adamrob-parallax-scroll-admin-help.php';

	}

	/**
	 * Instantiates and creates a reference for required admin classes.
	 *
	 * @since    3.0.0
	 * @access   private
	 */
	private function instantiate_classes() {

		$this->instantiated_objects = array();

		/**
		 * Instantiate the post type class
		 */
		$this->instantiated_objects['post_type'] = new Adamrob_Parallax_Scroll_Post_Type( 
														$this->get_plugin_name(), 
														$this->get_version(), 
														$this->get_plugin_keys() 
													 );

		/**
		 * Instantiate the meta data class
		 */
		$this->instantiated_objects['post_type_meta'] = new Adamrob_Parallax_Scroll_Meta_Box( 
														$this->get_plugin_name(), 
														$this->get_version(), 
														$this->get_plugin_keys() 
													);

		/**
		 * Instantiate the help class
		 */
		$this->instantiated_objects['help'] = new Adamrob_Parallax_Scroll_Admin_Help( 
														$this->get_plugin_name(), 
														$this->get_version(),
														$this->get_plugin_keys() 
													);

		/** Convert the array to an object so we can access it as an object */
		$this->instantiated_objects = (object) $this->instantiated_objects;

	}

	/**
	 * Register all of the hooks related to the post type functionality
	 * of the plugin.
	 *
	 * @since    3.0.0
	 * @access   private
	 */
	private function define_posttype_hooks() {


		$this->loader->add_action( 
			'init', 
			$this->instantiated_objects->post_type, 
			'add_post_type' 
		);

		$this->loader->add_filter( 
			'manage_' . $this->get_post_type_key() . '_posts_columns', 
			$this->instantiated_objects->post_type, 
			'display_columns' 
		);
		
		$this->loader->add_action( 
			'manage_' . $this->get_post_type_key() . '_posts_custom_column', 
			$this->instantiated_objects->post_type, 
			'custom_columns_output',
			10,
			2 
		);

	}

	/**
	 * Register all of the hooks related to the meta data functionality
	 * of the plugin.
	 *
	 * @since    3.0.0
	 * @access   private
	 */
	private function define_metadata_hooks() {
		
		$this->loader->add_action( 
			'admin_enqueue_scripts', 
			$this->instantiated_objects->post_type_meta,
			 'register_styles' 
		);

		$this->loader->add_action( 
			'admin_enqueue_scripts', 
			$this->instantiated_objects->post_type_meta,
			 'register_scripts' 
		);

		$this->loader->add_action( 
			'add_meta_boxes', 
			$this->instantiated_objects->post_type_meta,
			 'add_meta_box' 
		);

		$this->loader->add_action( 
			'save_post', 
			$this->instantiated_objects->post_type_meta,
			 'save_post' 
		);

	}

	/**
	 * Register all of the hooks related to the help functionality
	 * of the plugin.
	 *
	 * @since    3.0.0
	 * @access   private
	 */
	private function define_help_hooks() {
		
		$this->loader->add_action( 
			'admin_head', 
			$this->instantiated_objects->help,
			 'add_help_tabs' 
		);

		$this->loader->add_action( 
			'edit_form_after_title', 
			$this->instantiated_objects->help,
			 'get_title_help' 
		);

	}

	/**
     * Show admin notices
     * 
     * @since    3.0.0
     * @access   public
     */
    public function show_admin_notice() {

        $notices = get_transient( $this->get_admin_notice_key() );
        if ( $notices !== false ) {
            foreach ( $notices as $notice ) {
                    echo '<div class="notice notice-success is-dismissible"><p>' . $notice . '</p></div>';
            }

            delete_transient( $this->get_admin_notice_key() );
        }
    }

    /**
     * Checks plugin version on update and shows appropriate message.
     * Also fires out an update call to all instantiated classes under the
     * admin base class
     *
     * @since   3.0.0
     * @access   public
     */
    public function check_update_version() {

        // Current version
        $current_version = get_option( $this->get_private_option_keys()->version );

        //Their version is older
        if ( $current_version && version_compare( $current_version, $this->get_version(), '<' ) ) {

        	/** Call the update script in each admin object */
        	foreach ( $this->instantiated_objects as $object ) {
        		$object->plugin_upgrade_tasks();
        	}

        }

        /**
         * No version setting exists.
         */
        if ( ! $current_version ) {

            $this->add_admin_notice(
                					sprintf(
                						wp_kses(
                							_x('Thankyou for upgrading Parallax Scroll. For further information and support please visit <a href="%s">adamrob.co.uk</a>'
                								,'Generic upgrade message'
                								,$this->get_plugin_name()
                								)
											, array( 'a' => array( 'href' => array() ) )
											)
            							, esc_url( 'https://adamrob.co.uk' )
    									) 
                					);

        }

        /** Save the current version. */
        update_option( $this->get_private_option_keys()->version, $this->get_version() );

    }


    /**
     * Adds additional links to the plugin author row
     * meta on the plugin page
     *
     * @since  3.0.0
     * @param  array $links {
 	 * 		Required. The array having default links for the plugin.
 	 *     	@type string $key 		The links key. 
 	 *      @type string $markup 	The link markup.
     * @param  string $file  The name of the plugin file. Required
     * @return array         The required array of links to display
     */
	public function show_plugin_row_meta( $links, $file ) {

		/** Check if its this plugin */
		if ( strpos( $file, $this->get_plugin_name() ) !== false){

			$new_links = array(
						//'donate' => '<a href="donation_url" target="_blank">Donate</a>',
	                    'social' => '<a href="https://twitter.com/adamrob_me" target="_blank">
	                    				<img src="https://adamrob.co.uk:443/wp-content/themes/salient/nectar/options/img/social/Twitter.png" height="20" width="20" align="bottom">
                    				</a> 
                    				<a href="https://profiles.wordpress.org/adamrob/" target="_blank">
                    					<img src="https://adamrob.co.uk:443/wp-content/themes/salient/nectar/options/img/social/WordPress.png" height="20" width="20" align="bottom">
                					</a> 
                					<a href="linkedin.com/in/adam-rob" target="_blank">
                						<img src="https://adamrob.co.uk:443/wp-content/themes/salient/nectar/options/img/social/LinkedIn.png" height="20" width="20" align="bottom">
            						</a> 
            						<a href="https://bitbucket.org/adamrob/" target="_blank">
            						<img src="https://adamrob.co.uk:443/wp-content/themes/salient/nectar/options/img/social/GitHub.png" height="20" width="20" align="bottom">
            						</a>'
					);
			
			$links = array_merge( $links, $new_links );
		}
	
		
		return $links;
	}

}
