<?php

/**
 * Define the internationalization functionality.
 *
 * @link       http://pluginspired.com/
 * @since      1.0.2
 * @package    PlugInspired_Login_Customizer
 * @subpackage PlugInspired_Login_Customizer/includes
 * @author     Robert Cummings <robert@pluginspired.com>
 */
class PlugInspired_Login_Customizer_i18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.2
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'pluginspired-login-customizer',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}

}
