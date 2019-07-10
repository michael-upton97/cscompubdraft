<?php
/**
 * @link              http://www.deepenbajracharya.com.np
 * @since             1.0.0
 * @package           Inactive Logout
 *
 * Plugin Name:       Inactive Logout
 * Plugin URI:        https://www.deepenbajracharya.com.np
 * Description:       Automatically logout idle user sessions, even if they are on the front end! Fully configurable & easy to use.
 * Version:           1.9.1
 * Author:            Deepen Bajracharya
 * Author URI:        https://www.deepenbajracharya.com.np
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       inactive-logout
 * Domain Path:       /lang
 **/

// Not Permission to agree more or less then given.
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

define( 'INA_PLUGIN_ABS_NAME', plugin_basename( __FILE__ ) );

// The main plugin class.
require_once dirname( __FILE__ ) . '/src/class-inactive-logout-main.php';

add_action( 'plugins_loaded', array( 'Inactive_Logout_Main', 'instance' ), 99 );
register_activation_hook( __FILE__, array( 'Inactive_Logout_Main', 'ina_activate' ) );
register_deactivation_hook( __FILE__, array( 'Inactive_Logout_Main', 'ina_deactivate' ) );
