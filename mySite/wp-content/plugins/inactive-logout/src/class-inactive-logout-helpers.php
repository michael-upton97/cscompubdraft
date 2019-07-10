<?php
/**
 * File contains functions for logout helpers.
 *
 * @package inactive-logout
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Class with a few helpers
 */
class Inactive_Logout_Helpers {

	/**
	 * Class instance.
	 *
	 * @access protected
	 *
	 * @var $instance
	 */
	protected static $instance;

	/**
	 * Return class instance.
	 *
	 * @return static Instance of class.
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Define constant if not already set.
	 *
	 * @param  string $name Constant name.
	 * @param  string|bool $value Constant value.
	 *
	 * @since   2.0.0
	 *
	 * @author  Deepen Bajracharya
	 */
	public function ina_define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
	 * Convert seconds to minutes.
	 *
	 * @param int $value Number of seconds.
	 *
	 * @return string
	 */
	public function ina_convert_to_minutes( $value ) {
		$minutes = floor( $value / 60 );

		return $minutes . ' ' . esc_html__( 'Minute(s)', 'inactive-logout' );
	}

	/**
	 * Manages reloading page.
	 */
	public function ina_reload() {
		?>
        <script type="text/javascript">location.reload();</script>
		<?php
	}

	/**
	 * Get all roles.
	 *
	 * @return array List of roles.
	 */
	public function ina_get_all_roles() {
		$result = array();

		$roles = get_editable_roles();
		foreach ( $roles as $role => $role_name ) {
			$result[ $role ] = $role_name['name'];
		}

		return $result;
	}

	/**
	 * Get All Pages and Posts
	 *
	 * @since  1.2.0
	 * @return array
	 */
	public function ina_get_all_pages_posts() {
		$result = array();
		$pages  = get_posts( array(
			'order'          => 'ASC',
			'posts_per_page' => - 1,
			'post_type'      => array(
				'post',
				'page',
			),
			'post_status'    => 'publish',
		) );

		if ( ! empty( $pages ) ) {
			foreach ( $pages as $page ) {
				$result[] = array(
					'ID'        => $page->ID,
					'title'     => $page->post_title,
					'permalink' => get_the_permalink( $page->ID ),
					'post_type' => $page->post_type,
				);
			}
		}

		return $result;
	}

	/**
	 * Check role is available in settings for multi-user.
	 *
	 * @param null|string $role Name of role, default is null.
	 *
	 * @return bool Returns true if passed role is available, Otherwise false.
	 */
	public function ina_check_role_enabledfor_multiuser( $role = null ) {
		$selected = false;
		if ( ! empty( $role ) ) {
			$ina_multiuser_settings = get_option( '__ina_multiusers_settings' );
			if ( ! empty( $ina_multiuser_settings ) ) {
				foreach ( $ina_multiuser_settings as $ina_multiuser_setting ) {
					if ( in_array( $role, $ina_multiuser_setting, true ) ) {
						$selected = true;
					}
				}
			}
		}

		return $selected;
	}

	/**
	 * Check to disable the Inactive for certain user role
	 *
	 * @author  Deepen
	 * @return BOOL
	 */
	public function ina_check_user_role() {
		$user                          = wp_get_current_user();
		$ina_roles                     = get_option( '__ina_multiusers_settings' );
		$result                        = false;
		$ina_multiuser_timeout_enabled = get_option( '__ina_enable_timeout_multiusers' );
		if ( $ina_roles && ! empty( $ina_multiuser_timeout_enabled ) ) {
			foreach ( $ina_roles as $role ) {
				if ( 1 === intval( $role['disabled_feature'] ) ) {
					if ( in_array( $role['role'], (array) $user->roles, true ) ) {
						$result = true;
					}
				}
			}
		}

		return $result;
	}

	/**
	 * Check to disable the Inactive for certain user role
	 *
	 * @author  Deepen
	 * @since   1.6.0
	 * @return BOOL
	 */
	public function ina_check_user_role_concurrent_login() {
		$user      = wp_get_current_user();
		$ina_roles = get_option( '__ina_multiusers_settings' );
		$result    = false;
		if ( $ina_roles ) {
			foreach ( $ina_roles as $role ) {
				if ( ! empty( $role['disabled_concurrent_login'] ) && 1 === intval( $role['disabled_concurrent_login'] ) ) {
					if ( in_array( $role['role'], (array) $user->roles, true ) ) {
						$result = true;
					}
				}
			}
		}

		return $result;
	}

	public function show_plugin_like() {
		if ( ! in_array( 'inactive-logout-addon/inactive-logout-addon.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			?>
            <div class="ina-admin-notice ina-admin-notice-warning">
                <h3><?php esc_html_e( 'Like this plugin ?', 'inactive-logout' ); ?></h3>
                <p>
					<?php
					// translators: anchor tag.
					printf( esc_html__( 'Please consider giving a %s if you found this useful at wordpress.org.', 'inactive-logout' ), '<a href="https://wordpress.org/support/plugin/inactive-logout/reviews/#new-post">5 star thumbs up</a>' );
					?>
                </p>
            </div>
			<?php
		}
	}

	public function show_plugin_referrals() {
		if ( ! in_array( 'inactive-logout-addon/inactive-logout-addon.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			?>
            <div id="message" class="notice notice-warning">
                <h4><?php esc_html_e( 'Do you know what your users are doing when logged in to your WordPress site?', 'inactive-logout' ); ?></h4>
                <p>
					<?php
					// translators: anchor tag.
					printf( esc_html__( 'We recommend you to install the %s plugin to keep a log of what users do when they are logged in to your WordPress website.', 'inactive-logout' ), '<a href="https://en-gb.wordpress.org/plugins/wp-security-audit-log/">WP Security Audit Log</a>' );
					?>
                </p>
            </div>
			<?php
		}
	}
}

function ina_helpers() {
	return Inactive_Logout_Helpers::instance();
}

ina_helpers();