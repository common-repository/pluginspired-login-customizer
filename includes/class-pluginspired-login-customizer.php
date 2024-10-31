<?php

/**
 * The core plugin class.
 *
 * @link       http://pluginspired.com/
 * @since      1.0.2
 * @package    PlugInspired_Login_Customizer
 * @subpackage PlugInspired_Login_Customizer/includes
 * @author     Robert Cummings <robert@pluginspired.com>
 */
class PlugInspired_Login_Customizer {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.2
	 * @access   protected
	 * @var      PlugInspired_Login_Customizer_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.2
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.2
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * The url of the plugin.
	 *
	 * @since    1.0.2
	 * @access   protected
	 * @var      string    $url    The url of the plugin.
	 */
	protected $url;

	/**
	 * The path of the plugin.
	 *
	 * @since    1.0.2
	 * @access   protected
	 * @var      string    $path    The path of the plugin.
	 */
	protected $path;

	/**
	 * The basename of the plugin.
	 *
	 * @since    1.0.2
	 * @access   protected
	 * @var      string    $basename    The basename of the plugin.
	 */
	protected $basename;

	/**
	 * The settings of the plugin.
	 *
	 * @since    1.0.2
	 * @access   protected
	 * @var      string    $settings    The settings of the plugin.
	 */
	protected $settings;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * @since    1.0.2
	 */
	public function __construct() {

		$this->plugin_name 	= 'pluginspired-login-customizer';
		$this->version 			= '1.0.3';
		$this->url    			= plugin_dir_url(	__FILE__ );
		$this->path   			= plugin_dir_path( __FILE__ );
		$this->basename 		= plugin_basename( __FILE__ );
		$this->settings 		= array(
			'colors' 			=> get_option( 'pluginspired_login_customizer_colors_settings' ),
			'logo' 				=> get_option( 'pluginspired_login_customizer_logo_settings' ),
			'background' 	=> get_option( 'pluginspired_login_customizer_background_settings' )
		);

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * @since    1.0.2
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-pluginspired-login-customizer-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-pluginspired-login-customizer-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-pluginspired-login-customizer-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-pluginspired-login-customizer-public.php';

		$this->loader = new PlugInspired_Login_Customizer_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * @since    1.0.2
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new PlugInspired_Login_Customizer_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.2
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new PlugInspired_Login_Customizer_Admin(
			$this->get_plugin_name(),
			$this->get_version(),
			$this->get_url(),
			$this->get_path(),
			$this->get_basename(),
			$this->get_settings()
		);

		/* Actions */
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_init', 						$plugin_admin, 'add_settings' );
		$this->loader->add_action( 'admin_menu', 						$plugin_admin, 'add_admin_menu_item' );

		/* Filters */
		$plugin_file_url = $this->plugin_name . '/pluginspired-login-customizer.php';
		$this->loader->add_filter( 'plugin_action_links_' . $plugin_file_url, $plugin_admin, 'add_action_links' );
		$this->loader->add_filter( 'plugin_row_meta', $plugin_admin, 'add_meta_links', 10, 2 );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.2
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new PlugInspired_Login_Customizer_Public(
			$this->get_plugin_name(),
			$this->get_version(),
			$this->get_url(),
			$this->get_path(),
			$this->get_basename(),
			$this->get_settings()
		);

		/* Actions */
		$this->loader->add_action( 'login_head', 					$plugin_public, 'add_login_css' );

		/* Filters */
		$this->loader->add_filter( 'login_headerurl', 		$plugin_public, 'change_logo_url' );
		$this->loader->add_filter( 'login_headertitle', 	$plugin_public, 'change_logo_title' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.2
	 */
	public function run() {

		$this->loader->run();

	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.2
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {

		return $this->plugin_name;

	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.2
	 * @return    PlugInspired_Login_Customizer_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {

		return $this->loader;

	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.2
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {

		return $this->version;

	}

	/**
	 * Retrieve the url of the plugin.
	 *
	 * @since     1.0.2
	 * @return    string    The url of the plugin.
	 */
	public function get_url() {

		return $this->url;

	}

	/**
	 * Retrieve the path of the plugin.
	 *
	 * @since     1.0.2
	 * @return    string    The path of the plugin.
	 */
	public function get_path() {

		return $this->path;

	}

	/**
	 * Retrieve the basename of the plugin.
	 *
	 * @since     1.0.2
	 * @return    string    The basename of the plugin.
	 */
	public function get_basename() {

		return $this->basename;

	}

	/**
	 * Retrieve the settings of the plugin.
	 *
	 * @since     1.0.2
	 * @return    string    The settings of the plugin.
	 */
	public function get_settings() {

		return $this->settings;

	}

}
