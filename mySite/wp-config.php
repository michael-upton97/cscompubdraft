<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'draft-db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'lu2 q++e7Fx]F5#T[p7K.0XL{F|8Ik#-JoJQDVB&av<|IKeZZN_}Y}YF:QRq@Vet' );
define( 'SECURE_AUTH_KEY',  '>46b4[#W_.)15F|Xkq}_`1J>(Ay@HudNUj(JA-6zG7o;Bb@JY9/;PbftdQrt!eC7' );
define( 'LOGGED_IN_KEY',    '.L$^)saA!.~eQWcx9XDwpXX}J<% Z:j/=gM%s@pzl RqI$fJXsJC@YUQ|7NWP=G[' );
define( 'NONCE_KEY',        '27T8Y1HLn*Tq_hDv([TV`Ti640 &Kh}&jZIQsOA8oKb`$ JrU{YWG>|]l&i^Agr)' );
define( 'AUTH_SALT',        'DTBpQV?qdMe<L5AZI.G>+h.l&d5b%3v3 $~s:C@ZN<3wMFbZ- <oh- gJC3C*])f' );
define( 'SECURE_AUTH_SALT', 'Sv10IFAJz(2zO=MGdt9x-1#j*r3{;Ui`Z_4n1_gbw~kSijvke8QWXUC6Ii~|;%oZ' );
define( 'LOGGED_IN_SALT',   '>Qw2U:=[=5xfu!1jW6_?(}-e8B{1)4^{?SJ0$^HQtqpnJ7{H%jiZ4YfFS<o7j |W' );
define( 'NONCE_SALT',       ')/`eZ_in]h5H>1fd`6AIn[Fog?f%o-8f.Q{3&wFk^/e|$Ou5jzhD}2_MJkjT{tKm' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );

define( 'WPMS_ON', true );
define( 'WPMS_SMTP_PASS', 'H0neyB@dger' );
