<?php

/**
 * Class for creating of meta box on post type
 *
 * @link       http://www.adamrob.co.uk
 * @since      3.0.0
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/admin
 */

/**
 * Class for creating of meta box on post type
 *
 * provice hooks required for meta box operation, and renders the content
 * by including the markup from its associated view.
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/admin
 * @author     adamrob <adam@adamrob.co.uk>
 */
class Adamrob_Parallax_Scroll_Meta_Box extends Adamrob_Parallax_Scroll_Admin_Base{


	/**
	 * An array containing references to all the field classes required
	 *
	 * @since    3.0.0
	 * @access   private
	 * @var 	 array 	$meta_fields
	 * 
	 */
	private $meta_fields;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    3.0.0
	 * @param    string    $plugin_name       The name of this plugin.
	 * @param    string    $version   		  The version of this plugin.
	 * @param    object    $plugin_keys       An object converted array that stores the plugins keys.
	 */
	public function __construct( $plugin_name, $version, $plugin_keys ) {
		
		/** Pass the mandatory arguments to the parent class where they are processed/stored */
		parent::__construct( $plugin_name, $version, $plugin_keys );

		$this->load_dependencies();
		$this->meta_fields = $this->get_meta_fields();

	}

	/**
	 * Load the required dependencies for this class.
	 *
	 * Include the following files:
	 *
	 * - Adamrob_Parallax_Scroll_Meta_Fields. Abstract parent class for all meta fields.
	 * - Adamrob_Parallax_Scroll_Meta_Fields_Number. Child class for number fields.
	 *
	 * @since    3.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * Abstract parent class for all meta fields.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/metafields/class-adamrob-parallax-scroll-meta-fields.php';

		/**
		 * Child class' for fields.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/metafields/class-adamrob-parallax-scroll-meta-fields-number.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/metafields/class-adamrob-parallax-scroll-meta-fields-text.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/metafields/class-adamrob-parallax-scroll-meta-fields-textarea.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/metafields/class-adamrob-parallax-scroll-meta-fields-checkbox.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/metafields/class-adamrob-parallax-scroll-meta-fields-option.php';

	}

	/**
	 * Register the stylesheets for the meta data area.
	 *
	 * @since    3.0.0
	 */
	public function register_styles() {

		wp_register_style( 
			$this->get_css_handle(), 
			plugin_dir_url( __FILE__ ) . 'css/adamrob-parallax-scroll-meta.css', 
			array(), 
			$this->get_version(), 
			'all' 
		);

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    3.0.0
	 */
	public function register_scripts() {

		wp_register_script( 
			$this->get_js_handle(), 
			plugin_dir_url( __FILE__ ) . 'js/adamrob-parallax-scroll-meta.js', 
			array( 'jquery' ), 
			$this->get_version(), 
			false 
		);

	}

	/**
	 * Creates the metabox
	 *
	 * @since    3.0.0
	 */
	public function add_meta_box(){
        
		//add the meta box
        add_meta_box(
            $this->get_post_meta_key(), 														// $id
            esc_html_x('Parallax Scroll Options', 'MetaBox Title', $this->get_plugin_name()), 	// $title - Translate and escape html
            array( $this, 'display_meta_box' ),													// $callback
            $this->get_post_type_key(), 														// $page / Post type
            'normal',							 												// $context
            'high'); 																			// $priority - Place as high as we can
	}

    /**
     * Renders the content of the meta box.
     *
     * @since    3.0.0
     */
    public function display_meta_box() {

    	/** Include the CSS and JS for the meta box */
    	wp_enqueue_style( $this->get_css_handle() );
    	wp_enqueue_script( $this->get_js_handle() );

    	/** Add a nonce field for security */
        wp_nonce_field( 'parallax_scroll_meta_save', 'parallax_scroll_meta_nonce' );

    	/** Include the tabbed navigation */
    	include_once( 'partials/adamrob-parallax-scroll-meta-nav.php' );

    }

	/**
	 * Sanitizes and serializes the information associated with this post.
	 *
	 * @since    3.0.0
	 * @param    int    $post_id    The ID of the post that's currently being edited.
	 */
	public function save_post( $post_id ) {
	 
	    /* Ensure we are working with the correct post type and the has the permission to save */
	    if ( ! $this->user_can_save( $post_id, 'parallax_scroll_meta_nonce', 'parallax_scroll_meta_save' ) ) {
	        return;
	    }

	    /** Loop through each defined field and call save function */
    	foreach ( $this->meta_fields as $field) {
			$field->save_value( $post_id );
    	}

	}

	/**
	 * Verifies that the post type that's being saved is actually a parallax scroll post 
	 *
	 * @since       3.0.0
	 * @access      private
	 * @return      bool      Return if the current post type is a post; false, otherwise.
	 */
	private function is_valid_post_type() {
	    return ! empty( $_POST['post_type'] ) && $this->get_post_type_key() == $_POST['post_type'];
	}


	/**
	 * Determines whether or not the current user has the ability to save meta data associated with this post.
	 *
	 * @since       3.0.0
	 * @access      private
	 * @param       int     $post_id      The ID of the post being save
	 * @param       string  $nonce_action The name of the action associated with the nonce.
	 * @param       string  $nonce_id     The ID of the nonce field.
	 * @return      bool                  Whether or not the user has the ability to save this post.
	 */
	private function user_can_save( $post_id, $nonce_action, $nonce_id ) {
	 
	    $is_autosave = wp_is_post_autosave( $post_id );
	    $is_revision = wp_is_post_revision( $post_id );
	    $is_valid_nonce = ( isset( $_POST[ $nonce_action ] ) && wp_verify_nonce( $_POST[ $nonce_action ], $nonce_id ) );
	    $is_valid_permissions = current_user_can( 'edit_post', $post_id) && current_user_can('edit_page', $post_id);
	 
	    // Return true if the user is able to save; otherwise, false.
	    return ! ( $is_autosave || $is_revision ) && $this->is_valid_post_type() && $is_valid_nonce && $is_valid_permissions;
	 
	}
 
    /**
     * Returns the handle for the css file required
     * for this class
     *
     * @since 	3.0.0
     * @return 	string 	The CSS handle for this class
     */
    private function get_css_handle(){
    	return $this->get_plugin_name() . '-css-meta';
    }

    /**
     * Returns the handle for the java script file required
     * for the meta tabs
     *
     * @since 	3.0.0
     * @return 	string 	The JS handle for meta tabs
     */
    private function get_js_handle(){
    	return $this->get_plugin_name() . '-js-meta';
    }

    /**
     * Returns the required fields for the meta box
     *
     * @since  3.0.0 
     * @return array 	Array of field object classes
     */
    private function get_meta_fields(){
    	
		$fields = array();

    	$fields[] = new Adamrob_Parallax_Scroll_Meta_Fields_Number(
    									0,
    									0,
    									'Parallax Height',
										'The height the parallax element should be in pixels. Set to 0 to auto set the height based on the post content. Minimum height is always 100px',
										'height',
										0,
										2000,
										'integer'
									);

    	$fields[] = new Adamrob_Parallax_Scroll_Meta_Fields_Number(
    									0,
    									1,
    									'Parallax Image Size',
										'The parallax image size will be scaled based on this value. Specify the width in pixels. Set to 0 to auto set the size of the image (recommended)',
										'pheight',
										0,
										2000,
										'integer'
									);

    	$fields[] = new Adamrob_Parallax_Scroll_Meta_Fields_Option(
    									0,
    									2,
    									'Horizontal Position',
										'The horizontal position of the header on the parallax background.',
										'hpos',
										array (
							                'one' 	=> array (
							                    'label' => 'Left',
							                    'value' => 'left'
							                ),
							                'two' 	=> array (
							                    'label' => 'Centre',
							                    'value' => 'center'
							                ),
							                'three' => array (
							                    'label' => 'Right',
							                    'value' => 'right'
						                	)
						                )
									);

    	$fields[] = new Adamrob_Parallax_Scroll_Meta_Fields_Option(
    									0,
    									3,
    									'Vertical Position',
										'The vertical position of the header on the parallax background. This setting is ignored if post content is specified.',
										'vpos',
										array (
							                'one' 	=> array (
							                    'label' => 'Top',
							                    'value' => 'top'
							                ),
							                'two' 	=> array (
							                    'label' => 'Middle',
							                    'value' => 'middle'
							                ),
							                'three' => array (
							                    'label' => 'Bottom',
							                    'value' => 'bottom'
							                )
							            )
									);

    	$fields[] = new Adamrob_Parallax_Scroll_Meta_Fields_TextArea(
    									0,
    									4,
    									'Header Style',
										'Enter the inline CSS style required for the header eg. font-weight: bold; font-size: large;',
										'hstyle',
										0,
										10000
									);

    	$fields[] = new Adamrob_Parallax_Scroll_Meta_Fields_CheckBox(
    									0,
    									5,
    									'Full Width',
										'Display the parallax across the full width of the page. This is a work around to get a full width parallax if its not already. This may not work on some themes.',
										'FullWidth'
									);

    	$fields[] = new Adamrob_Parallax_Scroll_Meta_Fields_Number(
    									1,
    									0,
    									'Parallax Speed',
										'The speed of the scrolling background. Value between 1 to 10. 10 being the quickest speed setting. Setting 0 will disable background scrolling',
										'speed',
										0,
										10,
										'integer'
									);

    	$fields[] = new Adamrob_Parallax_Scroll_Meta_Fields_CheckBox(
    									1,
    									1,
    									'Use Parallax.JS',
										'Selecting this option will use parallax.js as the parallax engine. Select if the CSS parallax doesnt work as you require. Note that some of the other options may not work as desired with this setting',
										'parallaxjs'
									);

    	$fields[] = new Adamrob_Parallax_Scroll_Meta_Fields_CheckBox(
    									2,
    									0,
    									'Mobile: Disable Parallax Image',
										'Select this option if you would rather the background image not display at all on mobile devices.',
										'DisableParImg'
									);

    	$fields[] = new Adamrob_Parallax_Scroll_Meta_Fields_CheckBox(
    									2,
    									1,
    									'Mobile: Disable Entire Parallax',
										'Select this option if you would rather not display any of the parallax content when on mobile device.',
										'DisableParallax'
									);

    	$fields[] = new Adamrob_Parallax_Scroll_Meta_Fields_Number(
    									2,
    									2,
    									'Mobile: Image Size',
										'Set a size here to scale the image size when on a mobile device. Specify the width in pixels. Set to 0 to auto set the size of the image.',
										'pheightmob',
										0,
										2000,
										'integer'
									);

		return $fields;

    }

}
