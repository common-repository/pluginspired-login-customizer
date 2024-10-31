<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://pluginspired.com/
 * @since      1.0.2
 * @package    PlugInspired_Login_Customizer
 * @subpackage PlugInspired_Login_Customizer/public
 * @author     Robert Cummings <robert@pluginspired.com>
 */
class PlugInspired_Login_Customizer_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.2
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.2
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The url of the plugin.
	 *
	 * @since    1.0.2
	 * @access   protected
	 * @var      string    $url    The url of the plugin.
	 */
	private $url;

	/**
	 * The path of the plugin.
	 *
	 * @since    1.0.2
	 * @access   protected
	 * @var      string    $path    The path of the plugin.
	 */
	private $path;

	/**
	 * The basename of the plugin.
	 *
	 * @since    1.0.2
	 * @access   protected
	 * @var      string    $basename    The basename of the plugin.
	 */
	private $basename;

	/**
	 * The settings of the plugin.
	 *
	 * @since    1.0.2
	 * @access   protected
	 * @var      string    $settings    The settings of the plugin.
	 */
	private $settings;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.2
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $url, $path, $basename, $settings ) {

		$this->plugin_name 	= $plugin_name;
		$this->version 			= $version;
		$this->url    			= $url;
		$this->path   			= $path;
		$this->basename 		= $basename;
		$this->settings 		= $settings;

	}

	/**
	 * Load custom styles on the login page.
	 *
	 * @since 	1.0.2
	 */
	public function add_login_css() {

		echo '<style>';
		// Normalize the logo width to allow for better results with varying image sizes.
		echo '.login h1 a { width: 100%; background-size: contain; }';
		// If logo image is set
		if ( isset($this->settings['logo']['logo_image_url']) && !empty($this->settings['logo']['logo_image_url']) )
		{
			$url = $this->settings['logo']['logo_image_url'];
			$size = getimagesize($url);
			echo '.login h1 a { background-image: url('.$url.'); }';
		}
		// If background color is set
		if ( isset($this->settings['background']['background_color']) && !empty($this->settings['background']['background_color']) )
		{
			echo 'body, html { background-color: '.$this->settings['background']['background_color'].'; }';
		}
		// If background image is set
		if ( isset($this->settings['background']['background_image_url']) && !empty($this->settings['background']['background_image_url']) )
		{
			echo 'body, html { background-image: url('.$this->settings['background']['background_image_url'].'); }';
		}
		// If background image size is set
		if ( isset($this->settings['background']['background_image_size']) && !empty($this->settings['background']['background_image_size']) )
		{
			echo 'body, html { background-size: '.$this->settings['background']['background_image_size'].'; }';
		}
		// If background image repeat is set
		if ( isset($this->settings['background']['background_image_repeat']) && !empty($this->settings['background']['background_image_repeat']) )
		{
			echo 'body, html { background-repeat: '.$this->settings['background']['background_image_repeat'].'; }';
		}
		// If box color is set
		if ( isset($this->settings['colors']['box_color']) && !empty($this->settings['colors']['box_color']) )
		{
			echo '.login form { background: '.$this->settings['colors']['box_color'].' none repeat scroll 0% 0%; }';
		}
		// If field label color is set
		if ( isset($this->settings['colors']['field_label_color']) && !empty($this->settings['colors']['field_label_color']) )
		{
			echo '.login label { color: '.$this->settings['colors']['field_label_color'].'; }';
		}
		// If field focus border color is set
		if ( isset($this->settings['colors']['field_focus_border_color']) && !empty($this->settings['colors']['field_focus_border_color']) )
		{
			echo 'input[type=checkbox]:focus, input[type=color]:focus, input[type=date]:focus, input[type=datetime-local]:focus, input[type=datetime]:focus, input[type=email]:focus, input[type=month]:focus, input[type=number]:focus, input[type=password]:focus, input[type=radio]:focus, input[type=search]:focus, input[type=tel]:focus, input[type=text]:focus, input[type=time]:focus, input[type=url]:focus, input[type=week]:focus, select:focus, textarea:focus { border-color: '.$this->settings['colors']['field_focus_border_color'].'; -webkit-box-shadow: 0 0 2px '.$this->settings['colors']['field_focus_border_color'].'; -moz-box-shadow: 0 0 2px '.$this->settings['colors']['field_focus_border_color'].'; box-shadow: 0 0 2px '.$this->settings['colors']['field_focus_border_color'].'; }';
		}
		// If button color is set
		if ( isset($this->settings['colors']['button_color']) && !empty($this->settings['colors']['button_color']) )
		{
			echo '.login .button-primary { background-color: '.$this->settings['colors']['button_color'].'; -webkit-box-shadow: none; -moz-box-shadow: none; box-shadow: none; text-shadow: none; border-color: '.$this->settings['colors']['button_color'].'; }';
		}
		// If button text color is set
		if ( isset($this->settings['colors']['button_text_color']) && !empty($this->settings['colors']['button_text_color']) )
		{
			echo '.login .button-primary { color: '.$this->settings['colors']['button_text_color'].'; }';
		}
		// If button hover color is set
		if ( isset($this->settings['colors']['button_hover_color']) && !empty($this->settings['colors']['button_hover_color']) )
		{
			echo '.login .button-primary:hover, .login .button-primary:focus { background-color: '.$this->settings['colors']['button_hover_color'].'; -webkit-box-shadow: none; -moz-box-shadow: none; box-shadow: none; text-shadow: none; border-color: '.$this->settings['colors']['button_hover_color'].'; }';
		}
		// If button hover text color is set
		if ( isset($this->settings['colors']['button_hover_text_color']) && !empty($this->settings['colors']['button_hover_text_color']) )
		{
			echo '.login .button-primary:hover, .login .button-primary:focus { color: '.$this->settings['colors']['button_hover_text_color'].'; }';
		}
		// If link color is set
		if ( isset($this->settings['colors']['link_color']) && !empty($this->settings['colors']['link_color']) )
		{
			echo '.login #backtoblog a, .login #nav a, .login h1 a { color: '.$this->settings['colors']['link_color'].'; }';
		}
		// If link hover color is set
		if ( isset($this->settings['colors']['link_hover_color']) && !empty($this->settings['colors']['link_hover_color']) )
		{
			echo '.login #backtoblog a:hover, .login #nav a:hover, .login h1 a:hover { color: '.$this->settings['colors']['link_hover_color'].'; }';
		}
		// If message box border color is set
		if ( isset($this->settings['colors']['message_box_border_color']) && !empty($this->settings['colors']['message_box_border_color']) )
		{
			echo '.login .message { border-left:4px solid '.$this->settings['colors']['message_box_border_color'].'; }';
		}
		// If error box border color is set
		if ( isset($this->settings['colors']['error_box_border_color']) && !empty($this->settings['colors']['error_box_border_color']) )
		{
			echo '.login #login_error { border-left:4px solid '.$this->settings['colors']['error_box_border_color'].'; }';
		}
		// If set to round login box corners
		if ( isset($this->settings['colors']['round_box_corners']) && $this->settings['colors']['round_box_corners'] )
		{
			echo '.login form { -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; }';
		}
		echo '</style>';

	}

	/**
	 * Change logo link on the login page.
	 *
	 * @since 	1.0.2
	 */
	public function change_logo_url( $url ) {

		if ( isset($this->settings['logo']['logo_link']) && !empty($this->settings['logo']['logo_link']) )
		{
			$url = esc_url( get_permalink( $this->settings['logo']['logo_link'] ) );
			return $url;
		}
		else
		{
			return site_url();
		}

	}

	/**
	 * Change logo title on the login page.
	 *
	 * @since 	1.0.2
	 */
	public function change_logo_title( $title ) {

		if ( isset($this->settings['logo']['logo_title']) && !empty($this->settings['logo']['logo_title']) )
		{
			return $this->settings['logo']['logo_title'];
		}
		else
		{
			return $title;
		}

	}

}
