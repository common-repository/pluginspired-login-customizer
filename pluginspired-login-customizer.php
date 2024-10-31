<?php
/**
 * PlugInspired Login Customizer
 *
 * @link              https://wordpress.org/plugins/pluginspired-login-customizer/
 * @since             1.0.2
 * @package           PlugInspired_Login_Customizer
 * @author     				Robert Cummings <robert@pluginspired.com>
 *
 * @wordpress-plugin
 * Plugin Name:       PlugInspired Login Customizer
 * Plugin URI:        https://wordpress.org/plugins/pluginspired-login-customizer/
 * Description:       Easily customize the default WordPress login, registration and forgot password pages for your site or blog. Including the colors, logo, and background. If you have any issues, please <a href="https://pluginspired.com/support/">create a support ticket</a>. We always try to promptly resolve any issues you may encounter.
 * Version:           1.0.4
 * Author:            PlugInspired
 * Author URI:        http://pluginspired.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pluginspired-login-customizer
 * Domain Path:       /languages
 *
 * PlugInspired Login Customizer is free software: you can redistribute it
 * and/or modify it under the terms of the GNU General Public License as
 * published by the Free Software Foundation, either version 2 of the License,
 * or any later version.
 *
 * PlugInspired Login Customizer is distributed in the hope that it will be
 * useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General
 * Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * PlugInspired Login Customizer. If not, see http://www.gnu.org/licenses/gpl-2.0.txt.
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-pluginspired-login-customizer.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.2
 */
function run_pluginspired_login_customizer() {

	$plugin = new PlugInspired_Login_Customizer();
	$plugin->run();

}
run_pluginspired_login_customizer();
