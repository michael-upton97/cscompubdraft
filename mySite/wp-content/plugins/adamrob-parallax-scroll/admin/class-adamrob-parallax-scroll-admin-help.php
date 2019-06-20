<?php

/**
 * Class for displaying help texts
 *
 * @link       http://www.adamrob.co.uk
 * @since      3.0.0
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/admin
 */

/**
 * Class for displaying help texts
 *
 * Provides the hooks required for help tabs
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/admin
 * @author     adamrob <adam@adamrob.co.uk>
 */
class Adamrob_Parallax_Scroll_Admin_Help extends Adamrob_Parallax_Scroll_Admin_Base{


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
	 * Creates the help tabs for post type
 	 *
	 * @since    3.0.0
	 * @access   public
	 */
	public function add_help_tabs(){

		$screen = get_current_screen();

		// Return early if we're not on the book post type.
		if ( $this->get_post_type_key() != $screen->post_type ) return;

		/**
		 * Setup each tab with its own args array.
		 * 
		 * @var array 	$tab {
		 * 		   		Required. Array to hold tabs data.
 	 	 *     			@type string $id 		ID tag of the tab. 
 	 	 *              @type string $title 	Title for the tab.
 	 	 *              @type string $content 	The HTML markup for the tab.
		 */
		$maintab = array(
			'id'      => $this->get_plugin_name() . 'help_tab_new', 
			'title'   => esc_html_x("What's New", 'Whats new help tab title', $this->get_plugin_name() ), 		
			'content' => $this->get_tab_whatsnew(), 
		);
		$createtab = array(
			'id'      => $this->get_plugin_name() . 'help_tab_create', 		
			'title'   => esc_html_x("Create New Parallax", 'Create help tab title', $this->get_plugin_name() ),
			'content' => $this->get_tab_create(),
		);
		$optionstab = array(
			'id'      => $this->get_plugin_name() . 'help_tab_options', 
			'title'   => esc_html_x("Parallax Options", 'Options help tab title', $this->get_plugin_name() ),
			'content' => $this->get_tab_options(), 
		);
		$stylestab = array(
			'id'      => $this->get_plugin_name() . 'help_tab_style', 	
			'title'   => esc_html_x("Extending Styles", 'Styles help tab title', $this->get_plugin_name() ), 
			'content' => $this->get_tab_style(),  
		);
		$fullwidthtab = array(
			'id'      => $this->get_plugin_name() . 'help_tab_fullwidth', 
			'title'   => esc_html_x("Full Width Issues", 'Full width help tab title', $this->get_plugin_name() ),
			'content' => $this->get_tab_fullwidth(),  
		);
	  
		// Add the help tab.
		$screen->add_help_tab( $maintab );
		$screen->add_help_tab( $createtab );
		$screen->add_help_tab( $optionstab );
		$screen->add_help_tab( $stylestab );
		$screen->add_help_tab( $fullwidthtab );        

	}


	/**
	 * Adds essentially a metabox below the title so
	 * we can show a bit of help text
	 *
	 * @since  	 3.0.0
	 * @access   public
	 * @return 	 echo    Echos the HTML markup
	 */
	public function get_title_help( $post ) {

	    // Return early if we're not on the book post type.
	    if ( $this->get_post_type_key() != $post->post_type )
	        return;


	    $result = include_once( 'partials/help/adamrob-parallax-scroll-help-posttype-title.php' );

	}


	/**
	 * Returns the whats new section tab for help box
	 *
	 * @since  3.0.0
	 * @access private 
	 * @return string    HTML Markup of the help tab 
	 */
	private function get_tab_whatsnew(){

		/** Buffer the output */
		ob_start();

    	$result = include_once( 'partials/help/adamrob-parallax-scroll-help-posttype-new.php' );
    	//if ( $result ) $errorcode = 3;
        
        /** get the buffered output */
        return ob_get_clean();
	}

	/**
	 * Returns the creating section tab for help box
	 *
	 * @since  3.0.0 
	 * @access private 
	 * @return string    HTML Markup of the help tab 
	 */
	private function get_tab_create(){

		/** Buffer the output */
		ob_start();

    	$result = include_once( 'partials/help/adamrob-parallax-scroll-help-posttype-create.php' );
    	//if ( $result ) $errorcode = 3;
        
        /** get the buffered output */
        return ob_get_clean();
	}

	/**
	 * Returns the whats options section tab for help box
	 *
	 * @since  3.0.0 
	 * @access private 
	 * @return string    HTML Markup of the help tab 
	 */
	private function get_tab_options(){

		/** Buffer the output */
		ob_start();

    	$result = include_once( 'partials/help/adamrob-parallax-scroll-help-posttype-options.php' );
    	//if ( $result ) $errorcode = 3;
        
        /** get the buffered output */
        return ob_get_clean();
	}

	/**
	 * Returns the style section tab for help box
	 *
	 * @since  3.0.0 
	 * @access private 
	 * @return string    HTML Markup of the help tab 
	 */
	private function get_tab_style(){

		/** Buffer the output */
		ob_start();

    	$result = include_once( 'partials/help/adamrob-parallax-scroll-help-posttype-style.php' );
    	//if ( $result ) $errorcode = 3;
        
        /** get the buffered output */
        return ob_get_clean();
	}

	/**
	 * Returns the full width section tab for help box
	 *
	 * @since  3.0.0 
	 * @access private 
	 * @return string    HTML Markup of the help tab 
	 */
	private function get_tab_fullwidth(){

		/** Buffer the output */
		ob_start();

    	$result = include_once( 'partials/help/adamrob-parallax-scroll-help-posttype-fullwidth.php' );
    	//if ( $result ) $errorcode = 3;
        
        /** get the buffered output */
        return ob_get_clean();
	}

}
