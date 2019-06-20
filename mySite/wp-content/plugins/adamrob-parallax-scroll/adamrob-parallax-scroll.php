<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.adamrob.co.uk
 * @since             3.0.0
 * @since   		  3.0.1 	Bug Fixes
 * @package           Adamrob_Parallax_Scroll
 *
 * @wordpress-plugin
 * Plugin Name:       Parallax Scroll by adamrob.co.uk
 * Plugin URI:        https://www.adamrob.co.uk/parallax-scroll
 * Description:       Easily create a page header or even a post with a parallax scrolling background image, with just a shortcode! Visit adamrob.co.uk for more information and support.
 * Version:           3.0.1
 * Author:            adamrob
 * Author URI:        https://www.adamrob.co.uk
 * License:           GPL-2.0+
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       adamrob-parallax-scroll
 * Domain Path:       /languages
 */

/**
 * Copyright 2019 adamrob (www.adamrob.co.uk)
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as 
 * published by the Free Software Foundation.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, 
 * INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A 
 * PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT 
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION 
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE 
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

/********************************
** VERSION HISTORY
**
** V0.3 - 14OCT20124 - Fixed ZIndex bug present when plugin
**                      used on certain themes.
**                  - Enclosed external script calls.
**
** V0.4 - 11NOV2014 - Added mobile disable options
**                  - Added full width Option
**                  - Fixed shortcode in content not working
**
** V1.0 - 13JAN2015 - Java script code dropped. Parallax now 
**                      now achieved using CSS.
**
** V1.1 - 10JAN2015 - Fixed full width issue where if more than one parallax
**                      was in a single post it would fail to size correctly
**
** V1.2 - 2FEB2015 - Added Help Menus
**                      Added image size property
**
** V1.3 - 3FEB2015 - Fixed menu position bug.
**
** V1.4 - 24FEB2015 - Added Mobile Sizing Options
**
** V2.0 - 8APR2016 - Added call for scroll JScript
**
** V3.0.0 and onwards
** 7MAR2019
** All further upgrade notices/comments will now be placed in the @since tag
** of each function/var change.
** furth documentation will be kept on the SVN and bitbucket repositorys.
**
********************************/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Using Semantic Versioning 2.0.0 - SemVer - https://semver.org
 */
define( 'PLUGIN_PARALLAXSCROLL_VERSION', '3.0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-adamrob-parallax-scroll-activator.php
 */
function activate_adamrob_parallax_scroll() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-adamrob-parallax-scroll-activator.php';
	Adamrob_Parallax_Scroll_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-adamrob-parallax-scroll-deactivator.php
 */
function deactivate_adamrob_parallax_scroll() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-adamrob-parallax-scroll-deactivator.php';
	Adamrob_Parallax_Scroll_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_adamrob_parallax_scroll' );
register_deactivation_hook( __FILE__, 'deactivate_adamrob_parallax_scroll' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-adamrob-parallax-scroll.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    3.0.0
 */
function run_adamrob_parallax_scroll() {

	$plugin = new Adamrob_Parallax_Scroll(PLUGIN_PARALLAXSCROLL_VERSION);
	$plugin->run();

}
run_adamrob_parallax_scroll();
