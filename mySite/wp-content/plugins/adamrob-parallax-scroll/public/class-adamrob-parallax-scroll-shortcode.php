<?php

/**
 * Class for creating and rendering the shortcode
 *
 * @link       https://www.adamrob.co.uk
 * @since      3.0.0
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/public
 */

/**
 * Class for creating and rendering the shortcode
 *
 * Provides the hooks required for creating the shortcode
 *
 * @package    Adamrob_Parallax_Scroll
 * @subpackage Adamrob_Parallax_Scroll/public
 * @author     adamrob <adam@adamrob.co.uk>
 */
class Adamrob_Parallax_Scroll_Shortcode {

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
	 * Shortcode CSS key
	 * Holds the CSS that is common against all parallax methods
	 *
	 * @since    3.0.0
	 * @access   private
	 * @var      string    $shortcode_css_key
	 */
	private $shortcode_css_key;


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    3.0.0
	 * @param    string    $plugin_name       The name of this plugin.
	 * @param    string    $version           The version of this plugin.
	 * @param    string    $shortcode_key     The shortcode key for the plugin. 
	 * @param    string    $post_type_key     The post type key for the plugin. 
	 */
	public function __construct( $plugin_name, $version, $shortcode_key, $post_type_key ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->shortcode_key = $shortcode_key;
		$this->post_type_key = $post_type_key;

		$this->shortcode_css_key = $this->plugin_name . '-sc-css';
	}

	/**
	 * Register the stylesheets for the shortcode.
	 *
	 * @since    3.0.0
	 */
	public function register_styles() {

		wp_register_style( 
			$this->shortcode_css_key, 
			plugin_dir_url( __FILE__ ) . 'css/adamrob-parallax-scroll-shortcode.css', 
			array(), 
			$this->version, 
			'all' 
		);

		/**
		 * @deprecated  3.5.0    To be replaced with newer and better version
		 */
		wp_register_style( 
			'parallax-CSS', 
			plugin_dir_url( __FILE__ ) . 'css/adamrob-parallax-scroll-parallax-legacy.css', 
			array(), 
			$this->version, 
			'all' 
		);

	}

	/**
	 * Register the scripts for the shortcode.
	 *
	 * @since    3.0.0
	 */
	public function register_scripts() {

		wp_register_script( 
			'parallax-script-fullwidth', 
			plugin_dir_url( __FILE__ ) . 'js/adamrob-parallax-scroll-fullwidth.js', 
			array( 'jquery' ), 
			$this->version, 
			false 
		);


		/**
		 * @deprecated  3.6.0    To be replaced with newer and better version
		 */
		wp_register_script( 
			'parallax-script-scroll', 
			plugin_dir_url( __FILE__ ) . 'js/adamrob-parallax-scroll-scroll.js', 
			array( 'jquery' ), 
			$this->version, 
			false 
		);

		/**
		 * @deprecated  3.6.0    To be replaced with newer and better version
		 */
		wp_register_script( 
			'parallax-script', 
			plugin_dir_url( __FILE__ ) . 'js/parallax/parallax.min.js', 
			array( 'jquery' ), 
			$this->version, 
			false 
		);

	}


	/**
	 * Returns the required markup for the shortcode
 	 *
	 * @since    3.0.0
	 * @since    3.0.1	Fix. Wrong parameter used for mobile image size
	 */
	public function show_shortcode($atts){
		
		/** @var integer Error code store */
		$errorcode = 0;

		/** Extract the parameters passed in */
		extract( shortcode_atts(
					        array(
					            'id' => '0',
					        ), 
					        $atts )
	    );

	    /** Sanatise the passed in shortcode parameters */
	    $postid = intval($id);
	    if ($postid==0 || !is_int($postid)){ 
	        $errorcode=1;
	    }

	    /** enque the style sheet */
	    wp_enqueue_style($this->shortcode_css_key);

   
	    /** Setup a WP query to retrieve the posts */
	    if ( $errorcode === 0){

    		/** Buffer the output */
			ob_start();

		    /** Set up the arguments for query */
		    $args = array( 'page_id' => $postid,
		                    'post_type' => array( $this->post_type_key ) );
		    //Look up the header
		    $post = new WP_Query( $args );

		    /** Check a post exists and then loop through all */
		    if ( $post->have_posts() ) {
		        while ( $post->have_posts() ) {
		            
		            /** set post object */
		            $post->the_post();

		            /** Make sure there is a thumbnail image */
		            if ( !has_post_thumbnail() ) { 
		                $errorcode = 2;
		                break;
		            }

		            /** Retrieve the parameters */
		            $parameters = $this->get_meta_parameters($post);

		            /** Check if its enabled */
		            if ($parameters['disableparallax'] && wp_is_mobile()){
		                break;
		            }

		            //*Create IDs for parralax and container divs
		            $parallaxFWStyleClass='';//_'.$postid;
        		    $containerFWStyleClass='';//_'.$postid;

        		    /** enque the style sheet */
        		    wp_enqueue_style('parallax-CSS');

		            //Check if full width is enabled
		            if ($parameters['fullwidth']){
		            	//include full width java script
		            	wp_enqueue_script( 'parallax-script-fullwidth' );

		            	//Rename IDs
		            	$parallaxFWStyleClass='adamrob_parallax_fullwidth ';
		            	$containerFWStyleClass='adamrob_parallax_container_fullwidth ';

		                //Send parameters to script
		                wp_localize_script('parallax-script-fullwidth', 'parallax_script_options', array(
		                    'parallaxdivid' => $parallaxFWStyleClass,
		                    'parallaxcontainerid' => $containerFWStyleClass
		                ));

		        	}

			      	//Check if Scroll Is Enabled
		        	$parallaxScrollingClass='';
		            if ($parameters['scrollspeed']>0 && $parameters['scrollspeed'] < 9 && $parameters['usejs']==false){
		            	//include  java script
		            	wp_enqueue_script( 'parallax-script-scroll' );

						$parallaxScrollingClass='adamrob_parallax_scrolling ';

		                //Send parameters to script
		                wp_localize_script('parallax-script-scroll', 'parallax_script_scroll_options', array(
		                    'parallaxcontainerid' => $parallaxScrollingClass
		                ));

		        	}

		        	//Check if we should use parallax.js to achieve effect
		        	if ($parameters['usejs']==true){
		        		//Attach script
		        		wp_enqueue_script( 'parallax-script' );
		        	}	

		            //Build the style tag for the parallax container
		            $parallaxStyle='';
		            if ($parameters['height']!==100){
		                //Use user defined height
		                $parallaxStyle='height:'.$parameters['height'].'px;';
		            }elseif($parameters['height']!==100 && $parameters['content'] ==""){
		                //Define the minimum height if no post content.
		                //If there is post content, use min height from css
		                $parallaxStyle='height:100px;';
		            }

		            //Enable parallax image?
		            $ParallaxImgStyle='';
		            if (!$parameters['disableimg'] || wp_is_mobile()===FALSE){
		                //Only show parallax if not on mobile.
		                //or on a mobile and user wants it
		                $ParallaxImgStyle='background-image: url('.$parameters['thumb_url'].');';
		            }

		            //build style tag for background size
		            $ParallaxSizeStyle='background-size: cover;';
		            if (wp_is_mobile()==FALSE && $parameters['imgsize']>0){
		                //if user not on mobile and wants to change the size
		                $ParallaxSizeStyle='background-size: '.$parameters['imgsize'].'px;';
		            }elseif(wp_is_mobile()&&isset($parameters['mobpsize'])&&$parameters['mobpsize']==0){
		                //User is on mobile and wants to auto size
		                //$ParallaxSizeStyle='background-size: 100% 100%;';
		                $ParallaxSizeStyle='background-size: cover; background-attachment: scroll;';
		            }elseif(wp_is_mobile()&&isset($parameters['mobpsize'])&&$parameters['mobpsize']>0){
		                //User is on mobile and wants to use a different size
		                $ParallaxSizeStyle='background-size: '.$parameters['mobpsize'].'px;background-repeat: no-repeat; background-attachment: scroll;';
		            }		        	        			        	


		            /** build the markup */
		            if ( ! $parameters['usejs'] ){
		            	$result = include( 'partials/adamrob-parallax-scroll-public-parallax-css-legacy.php' );
		            	//if ( $result ) $errorcode = 3;
		            }

		            if ( $parameters['usejs'] ){
		            	$result = include( 'partials/adamrob-parallax-scroll-public-parallax-js-legacy.php' );
		            	//if ( $result ) $errorcode = 4;
		            }
		        }
		    }
		}

		/** Reset the query Data */
        wp_reset_postdata();

        /** get the buffered output */
        $markup = ob_get_clean();

		/** Shortcode Output */
		if ( $errorcode !== 0){

			return $this->display_error($errorcode);
		}

		/** All is good. Send the output */
		return $markup;
	}

/**
  ob_start();
  ?> <your contents/html/(maybe in separate file to include) code etc> <?php
  return ob_get_clean();
 */

  	/**
  	 * Returns an error string for the given error code
  	 *
  	 * @since  3.0.0
  	 * @param  int  	$errorcode 
  	 * @return string 	Error text
  	 */
  	private function get_error_text($errorcode){

  		switch ( (string) $errorcode ) {
  			case '1':
  				return 'Invalid Parallax ID';
  				break;

			case '2':
  				return 'No Feature Image Defined! Please specify your background image in the featured image meta box on the admin page. For more information please see the help menu from the parallax scroll admin pages.';
  				break;
  			
			case '3':
  				return 'An error has occured trying to display more than one parallax of type CSS. Include once failed';
  				break;

 			case '4':
  				return 'An error has occured trying to display more than one parallax of type JAVA. Include once failed';
  				break;

  			default:
  				return 'No error text available for code: ' . $errorcode;
  				break;
  		}
  	}

  	
  	/**
  	 * Generates HTML markup for displaying an
  	 * error message
  	 *
  	 * @since  3.0.0
  	 * @param  int  	$errorcode 
  	 * @return string 	Error markup
  	 */
  	private function display_error($errorcode){

  		/** Buffer the output */
  		ob_start();

  		?>
			<div class="alert alert-danger fade in">
			    <strong>Parallax Error!</strong> <?php echo $this->get_error_text($errorcode) ?>
			</div>
		<?php

		/** Return buffered output */
		return ob_get_clean();
  	}


  	/**
  	 * Queries the post and returns the required
  	 * parallax settings from the meta data
  	 *
  	 * @since  3.0.0
  	 * @return array 	{
 	 * 		Array of the parallax settings
 	 *     	@type string 	$thumb_url  		URL of the parallax image. 
 	 *      @type int  		$height 			Parallax Height.
 	 *      @type string	$vpos 				Vertical Position.
 	 *      @type string	$hpos 				Horizontal Position.
 	 *      @type int		$imgsize 			Image Size.
 	 *      @type int 		$mobpsize 			Image size when on mobile.
 	 *      @type bool 		$disableimg 		Disables the image element when on mobile.
 	 *      @type bool 		$disableparallax	Disables entire parallax when on mobile.
 	 *      @type string	$headerstyle		Inline CSS style for the header.
 	 *      @type string	$content			The posts content.
 	 *      @type bool 		$fullwidth 			Enable the full width.
 	 *      @type int 		$scrollspeed 		The parallax Scroll Speed.
 	 *      @type bool 		$usejs 				Use javascript engine.
 	 *      @type string 	$title 				The posts title.
  	 */
  	private function get_meta_parameters($post){

  		$parrs = array();

        //Get thumbnail url
        $thumb_id = get_post_thumbnail_id();
        $thumb_url_array = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);
        $parrs['thumb_url'] = $thumb_url_array[0];

        //Get the height
        $pheight = absint(get_post_meta(get_the_id(), 'parallax_meta_height', true));
        //Check the height
        if ( $pheight==0 || $pheight<100 ){
            //Set minimum height
            $pheight = 100;
        }
        $parrs['height'] = $pheight;

        //Get v pos
        $vpos = esc_attr(get_post_meta(get_the_id(), 'parallax_meta_vpos', true));
        //Check for value
        if ($vpos == ''){
            $vpos='middle';
        }
        $parrs['vpos'] = $vpos;

        //Get h pos
        $hpos = esc_attr(get_post_meta(get_the_id(), 'parallax_meta_hpos', true));
        //Check for value
        if ($hpos == ''){
            $hpos='center';
        }
        $parrs['hpos'] = $hpos;

        //Get parallaz image size
        $psize = absint(get_post_meta(get_the_id(), 'parallax_meta_pheight', true));
        $mobpsize = absint(get_post_meta(get_the_id(), 'parallax_meta_pheightmob', true));
        $parrs['imgsize'] = $psize;
        $parrs['mobimgsize'] = $mobpsize;

        //Get parallax disable options
        $disableParImg=esc_attr(get_post_meta(get_the_id(), 'parallax_meta_DisableParImg', true));
        $disablePar=esc_attr(get_post_meta(get_the_id(), 'parallax_meta_DisableParallax', true));
        $parrs['disableimg'] = $disableParImg;
        $parrs['disableparallax'] = $disablePar;

        //Get style
        $hStyle = esc_html(get_post_meta(get_the_id(), 'parallax_meta_hstyle', true));
        $parrs['headerstyle'] = $hStyle;

        //Get post content
        $theContent=apply_filters('the_content',get_the_content());
        $parrs['content'] = $theContent;

        //Get the full width option
        $fullWidthEnable=esc_attr(get_post_meta(get_the_id(), 'parallax_meta_FullWidth', true));
        $parrs['fullwidth'] = $fullWidthEnable;

        //Get background scroll speed
        $bgScrollSpeed = absint(get_post_meta(get_the_id(), 'parallax_meta_speed', true));
        $parrs['scrollspeed'] = $bgScrollSpeed;

        //Are we using parallax.js?
        $parallaxJS = esc_attr(get_post_meta(get_the_id(), 'parallax_meta_parallaxjs', true));
        $parrs['usejs'] = $parallaxJS;

        $TheTitle = esc_html(wp_strip_all_tags(get_the_title(),true));
        $parrs['title'] = $TheTitle;

        return $parrs;
  	}
}