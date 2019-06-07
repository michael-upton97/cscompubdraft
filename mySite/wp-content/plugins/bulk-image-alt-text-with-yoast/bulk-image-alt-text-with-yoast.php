<?php

/*
* Plugin Name: BIALTY - Bulk Image Alt Text (Alt tag, Alt Attribute) with Yoast SEO + WooCommerce
* Description: Auto-add Alt texts, also called Alt Tags or Alt Attributes, from YOAST SEO Focus Keyword field (or page/post/product title) with your page/post/product title, to all images contained on your pages, posts, products, portfolios for better Google Ranking on search engines – Fully compatible with Woocommerce
* Author: Pagup
* Version: 1.2.3
* Author URI: https://pagup.com/
* Text Domain: bialty
* Domain Path: /languages/
*/
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
function bialty_fs()
{
    global  $bialty_fs ;
    
    if ( !isset( $bialty_fs ) ) {
        // Include Freemius SDK.
        require_once dirname( __FILE__ ) . '/vendor/freemius/start.php';
        $bialty_fs = fs_dynamic_init( array(
            'id'              => '2602',
            'slug'            => 'bulk-image-alt-text-with-yoast',
            'type'            => 'plugin',
            'public_key'      => 'pk_a805c7e6685744c85d7e720fd230d',
            'is_premium'      => false,
            'has_addons'      => false,
            'has_paid_plans'  => true,
            'has_affiliation' => 'selected',
            'menu'            => array(
            'slug'           => 'bialty',
            'override_exact' => true,
            'first-path'     => 'options-general.php?page=bialty',
            'support'        => false,
            'parent'         => array(
            'slug' => 'options-general.php',
        ),
        ),
            'is_live'         => true,
        ) );
    }
    
    return $bialty_fs;
}

// Init Freemius.
bialty_fs();
// Signal that SDK was initiated.
do_action( 'bialty_fs_loaded' );
function bialty_fs_settings_url()
{
    return admin_url( 'options-general.php?page=bialty&tab=bialty-settings' );
}

bialty_fs()->add_filter( 'connect_url', 'bialty_fs_settings_url' );
bialty_fs()->add_filter( 'after_skip_url', 'bialty_fs_settings_url' );
bialty_fs()->add_filter( 'after_connect_url', 'bialty_fs_settings_url' );
bialty_fs()->add_filter( 'after_pending_connect_url', 'bialty_fs_settings_url' );
// freemius opt-in
function bialty_fs_custom_connect_message(
    $message,
    $user_first_name,
    $product_title,
    $user_login,
    $site_link,
    $freemius_link
)
{
    $break = "<br><br>";
    return sprintf( esc_html__( 'Hey %1$s, %2$s Click on Allow & Continue to start optimizing your images with ALT tags :)!  Don\'t spend hours at adding manually alt tags to your images. BIALTY will use your YOAST settings automatically to get better results on search engines and improve your SEO. %2$s Never miss an important update -- opt-in to our security and feature updates notifications. %2$s See you on the other side.', 'bialty' ), $user_first_name, $break );
}

bialty_fs()->add_filter(
    'connect_message',
    'bialty_fs_custom_connect_message',
    10,
    6
);
class bialty
{
    function __construct()
    {
        // making sure we have the right paths...
        // making sure we have the right paths...
        
        if ( !defined( 'WP_PLUGIN_URL' ) ) {
            if ( !defined( 'WP_CONTENT_DIR' ) ) {
                define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
            }
            if ( !defined( 'WP_CONTENT_URL' ) ) {
                define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
            }
            if ( !defined( 'WP_PLUGIN_DIR' ) ) {
                define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );
            }
            define( 'WP_PLUGIN_URL', WP_CONTENT_URL . '/plugins' );
        }
        
        // end if
        // stuff to do on plugin activation/deactivation
        //register_activation_hook(__FILE__, array(&$this, 'bialty_activate'));
        register_deactivation_hook( __FILE__, array( &$this, 'bialty_deactivate' ) );
        //add quick links to plugin settings
        $plugin = plugin_basename( __FILE__ );
        if ( is_admin() ) {
            add_filter( "plugin_action_links_{$plugin}", array( &$this, 'bialty_setting_link' ) );
        }
    }
    
    // end function __construct()
    // quick setting link in plugin section
    function bialty_setting_link( $links )
    {
        $settings_link = '<a href="options-general.php?page=bialty">Settings</a>';
        array_unshift( $links, $settings_link );
        return $links;
    }
    
    // end function setting_link()
    // register options
    function bialty_options()
    {
        $bialty_options = get_option( 'bialty' );
        return $bialty_options;
    }
    
    // end function bialty_options()
    // removed settings (if checked) on plugin deactivation
    function bialty_deactivate()
    {
        $bialty_options = $this->bialty_options();
        if ( $bialty_options['remove_settings'] ) {
            delete_option( 'bialty' );
        }
    }

}
// end class
$bialty = new bialty();
function bialty_buffer( $content )
{
    global  $bialty, $post ;
    $bialty_options = $bialty->bialty_options();
    
    if ( class_exists( 'WPSEO_Meta' ) ) {
        $focus_keyword = WPSEO_Meta::get_value( 'focuskw', $post->ID );
    } else {
        $focus_keyword = "";
    }
    
    $post_title = get_the_title( $post->ID );
    $site_title = "";
    $replace_fkw = "";
    $replace_both = '$1' . get_the_title( $post->ID ) . $site_title . '$2';
    if ( isset( $bialty_options['add_site_title'] ) && !empty($bialty_options['add_site_title']) ) {
        //define site title
        $site_title = ", " . get_bloginfo( 'name' );
    }
    // define post title for alt text
    $replace_title = '$1' . get_the_title( $post->ID ) . '$2';
    // if yoast options class exists
    
    if ( class_exists( 'WPSEO_Options' ) ) {
        // define focus keyword and site title for alt text
        $replace_fkw = '$1' . $focus_keyword . $site_title . '$2';
        // define focus keyword, post title and site title for alt text
        $replace_both = '$1' . $focus_keyword . ', ' . $post_title . $site_title . '$2';
    }
    
    // custom alt keyword
    $bialty_custom_alt = get_post_meta( $post->ID, 'use_bialty_alt', true );
    $custom_alt_kw = get_post_meta( $post->ID, 'bialty_cs_alt', true );
    $replace_ckw = '$1' . $custom_alt_kw . '$2';
    // disable bialty
    //$disable_bialty = get_post_meta($post->ID, 'disable_bialty', true);
    $pattern1 = '~(<img.*? alt=")("[^>]*>)~i';
    // if alt empty
    $pattern2 = '~(<img\\s(?:[^<]*?\\s)?alt=")[^"]+("[^<]*?>)~i';
    // if alt not empty
    $pattern3 = '~(<img.*? alt=")[^"]*("[^>]*>)~i';
    // replace all
    
    if ( empty(get_post_meta( $post->ID, 'disable_bialty', true )) ) {
        // replace not empty alt text
        
        if ( isset( $bialty_options['alt_not_empty'] ) && !empty($bialty_options['alt_not_empty']) && $bialty_options['alt_not_empty'] == "alt_not_empty_fkw" ) {
            if ( is_singular( array( 'post', 'page' ) ) || is_home() ) {
                $content = preg_replace( $pattern2, $replace_fkw, $content );
            }
        } elseif ( isset( $bialty_options['alt_not_empty'] ) && !empty($bialty_options['alt_not_empty']) && $bialty_options['alt_not_empty'] == "alt_not_empty_title" ) {
            if ( is_singular( array( 'post', 'page' ) ) || is_home() ) {
                $content = preg_replace( $pattern2, $replace_title, $content );
            }
        } elseif ( empty($bialty_options['alt_not_empty']) || $bialty_options['alt_not_empty'] == "alt_not_empty_both" ) {
            if ( is_singular( array( 'post', 'page' ) ) || is_home() ) {
                $content = preg_replace( $pattern2, $replace_both, $content );
            }
        }
        
        // replace empty alt text
        
        if ( isset( $bialty_options['alt_empty'] ) && !empty($bialty_options['alt_empty']) && $bialty_options['alt_empty'] == "alt_empty_fkw" ) {
            if ( is_singular( array( 'post', 'page' ) ) || is_home() ) {
                $content = preg_replace( $pattern1, $replace_fkw, $content );
            }
        } elseif ( isset( $bialty_options['alt_empty'] ) && !empty($bialty_options['alt_empty']) && $bialty_options['alt_empty'] == "alt_empty_title" ) {
            if ( is_singular( array( 'post', 'page' ) ) || is_home() ) {
                $content = preg_replace( $pattern1, $replace_title, $content );
            }
        } elseif ( empty($bialty_options['alt_empty']) || $bialty_options['alt_empty'] == "alt_empty_both" ) {
            if ( is_singular( array( 'post', 'page' ) ) || is_home() ) {
                $content = preg_replace( $pattern1, $replace_both, $content );
            }
        }
        
        // replace with custom alt text
        if ( $bialty_custom_alt == true && !empty($custom_alt_kw) ) {
            if ( is_singular( array( 'post', 'page' ) ) || is_home() ) {
                $content = preg_replace( $pattern3, $replace_ckw, $content );
            }
        }
    }
    
    // end pro
    return $content;
}

function bialty_buffer_start()
{
    ob_start( "bialty_buffer" );
}

function bialty_buffer_end()
{
    ob_end_flush();
}

add_action( 'wp_head', 'bialty_buffer_start' );
add_action( 'wp_footer', 'bialty_buffer_end' );
// admin notifications
include_once dirname( __FILE__ ) . '/inc/notices.php';
add_action( 'init', 'bialty_textdomain' );
function bialty_textdomain()
{
    load_plugin_textdomain( 'bialty', false, basename( dirname( __FILE__ ) ) . '/languages' );
}

if ( is_admin() ) {
    include_once dirname( __FILE__ ) . '/bulk-image-alt-text-with-yoast-admin.php';
}