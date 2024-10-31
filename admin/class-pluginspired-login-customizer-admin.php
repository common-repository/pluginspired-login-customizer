<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://pluginspired.com/
 * @since      1.0.2
 * @package    PlugInspired_Login_Customizer
 * @subpackage PlugInspired_Login_Customizer/admin
 * @author     Robert Cummings <robert@pluginspired.com>
 */
class PlugInspired_Login_Customizer_Admin {

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
	 * @since			1.0.2
	 * @param			string    $plugin_name       The name of this plugin.
	 * @param			string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $url, $path, $basename, $settings ) {

		$this->plugin_name 			= $plugin_name;
		$this->version 					= $version;
		$this->url    					= $url;
		$this->path   					= $path;
		$this->basename 				= $basename;
		$this->settings 				= $settings;

	}

	/**
	 * Add plugin settings link to plugin actions.
	 *
	 * @since 	1.0.2
 	*
 	* @param	string  $links	Current links
 	* @return string	Links, now with new links added
	 */
	public function add_action_links ( $links ) {

		$plugin_links = array(
			'<a href="' . admin_url( 'admin.php?page=pluginspired-login-customizer' ) . '">'.__('Settings', $this->plugin_name).'</a>'
		);
		return array_merge( $links, $plugin_links );

	}

	/**
	* Add links to plugin details.
	*
	* @since	1.0.3
	*
	* @param	string  $links	Current links
	* @param	string  $file		File in use
	* @return string	Links, now with new links added
	*/
	public function add_meta_links( $links, $file ) {

		if ( strpos( $file, 'pluginspired-login-customizer.php' ) !== false ) {

			$links = array_merge( $links, array( '<a href="https://pluginspired.com/wordpress-plugins/premium/login-customizer-pro/" target="_blank">' . __( 'Go Pro', $this->plugin_name ) . '</a>' ) );

			$links = array_merge( $links, array( '<a href="https://pluginspired.com/support/" target="_blank">' . __( 'Support', $this->plugin_name ) . '</a>' ) );

			$links = array_merge( $links, array( '<a href="https://pluginspired.com/donate/" target="_blank">' . __( 'Donate', $this->plugin_name ) . '</a>' ) );

			$links = array_merge( $links, array( '<a href="https://wordpress.org/support/view/plugin-reviews/pluginspired-login-customizer?filter=5#postform" target="_blank" title="' . __( 'Leave PlugInspired Login Customizer a 5-star rating on WordPress.org', $this->plugin_name ) . '" data-rated="' . __( 'Thanks :)', $this->plugin_name ) . '">★★★★★</a>' ) );

		}

		return $links;
	}

	/**
	* Get the top static notice for settings pages.
	*
	* @since	1.0.3
	*
	* @return string	The top static notice for settings pages.
	*/
	public function get_top_static_notice() {

		$return = '<div class="notice notice-success">';
	    $return .= '<p>'. __( 'If you like this plugin, please leave it a <a href="https://wordpress.org/support/view/plugin-reviews/pluginspired-login-customizer?filter=5#postform" target="_blank" title="Leave PlugInspired Login Customizer a 5-star rating on WordPress.org" data-rated="Thanks :)">★★★★★</a> rating and consider <a href="https://pluginspired.com/donate/" title="Donate with PayPal or Bitcoin and help make PlugInspired Login Customizer better" target="_blank"><b>making a donation</b></a>. Even the smallest donations are appreciated!', $this->plugin_name ) .'</p>';
	  $return .= '</div>';

		return $return;
	}

	/**
	 * Set up admin dashboard menu item.
	 *
	 * @since 	1.0.2
	 */
	public function add_admin_menu_item() {

		add_menu_page(
				__( 'PlugInspired Login Customizer', $this->plugin_name ),
				__( 'Login', $this->plugin_name ),
				'manage_options',
				'pluginspired-login-customizer',
				array( $this, 'settings_page' ),
				'dashicons-admin-customizer',
				'59.2233'
		);

		add_submenu_page(
				'pluginspired-login-customizer',
				__( 'Colors & Styles &lsaquo; PlugInspired Login Customizer', $this->plugin_name ),
				__( 'Colors & Styles', $this->plugin_name ),
				'manage_options',
				'pluginspired-login-customizer',
				array( $this, 'settings_page' )
		);

		add_submenu_page(
				'pluginspired-login-customizer',
				__( 'Logo &lsaquo; PlugInspired Login Customizer', $this->plugin_name ),
				__( 'Logo', $this->plugin_name ),
				'manage_options',
				'pluginspired-login-customizer-logo',
				array( $this, 'settings_page_logo' )
		);

		add_submenu_page(
				'pluginspired-login-customizer',
				__( 'Background &lsaquo; PlugInspired Login Customizer', $this->plugin_name ),
				__( 'Background', $this->plugin_name ),
				'manage_options',
				'pluginspired-login-customizer-background',
				array( $this, 'settings_page_background' )
		);

	}

	/**
	 * Register plugin settings with WordPress.
	 *
	 * @since 	1.0.2
	 */
	public function add_settings() {

		global $wp_roles;

		/* Colors & Styles */
		register_setting('pluginspired_login_customizer_colors_settings_group', 'pluginspired_login_customizer_colors_settings');

		add_settings_section(
        'pluginspired_login_customizer_colors_settings_section',
        __( 'Colors & Styles', $this->plugin_name ),
				function() {},
        'pluginspired_login_customizer_colors_settings_group'
    );

    add_settings_field(
        'pluginspired_login_customizer_colors_settings[round_box_corners]',
        __( 'Round Login Box Corners?', $this->plugin_name ),
        function() {
					echo '<p class="description">';
						echo '<input name="pluginspired_login_customizer_colors_settings[round_box_corners]" type="checkbox" value="1" ' . checked( 1, $this->settings['colors']['round_box_corners'], false ) . '>';
						 _e('Check this if you want to round the corners of the login box.', $this->plugin_name);
					echo '</p>';
				},
        'pluginspired_login_customizer_colors_settings_group',
        'pluginspired_login_customizer_colors_settings_section'
    );

    add_settings_field(
        'pluginspired_login_customizer_colors_settings[box_color]',
        __( 'Login Box Color', $this->plugin_name ),
        function() {
					echo '<input type="text" name="pluginspired_login_customizer_colors_settings[box_color]"
           value="' . $this->settings['colors']['box_color'] . '" class="regular-text color-field">';
					echo '<p class="description">';
						 _e('The background color of the login box. Leave blank to use the default color.', $this->plugin_name);
					echo '</p>';
				},
        'pluginspired_login_customizer_colors_settings_group',
        'pluginspired_login_customizer_colors_settings_section'
    );

    add_settings_field(
        'pluginspired_login_customizer_colors_settings[field_label_color]',
        __( 'Field Label Color', $this->plugin_name ),
        function() {
					echo '<input type="text" name="pluginspired_login_customizer_colors_settings[field_label_color]"
           value="' . $this->settings['colors']['field_label_color'] . '" class="regular-text color-field">';
					echo '<p class="description">';
						 _e('The color of the field labels. Leave blank to use the default color.', $this->plugin_name);
					echo '</p>';
				},
        'pluginspired_login_customizer_colors_settings_group',
        'pluginspired_login_customizer_colors_settings_section'
    );

    add_settings_field(
        'pluginspired_login_customizer_colors_settings[field_focus_border_color]',
        __( 'Field Focus Border Color', $this->plugin_name ),
        function() {
					echo '<input type="text" name="pluginspired_login_customizer_colors_settings[field_focus_border_color]"
           value="' . $this->settings['colors']['field_focus_border_color'] . '" class="regular-text color-field">';
					echo '<p class="description">';
						 _e('The border and glow color of a focused field. Leave blank to use the default color.', $this->plugin_name);
					echo '</p>';
				},
        'pluginspired_login_customizer_colors_settings_group',
        'pluginspired_login_customizer_colors_settings_section'
    );

    add_settings_field(
        'pluginspired_login_customizer_colors_settings[button_color]',
        __( 'Button Color', $this->plugin_name ),
        function() {
					echo '<input type="text" name="pluginspired_login_customizer_colors_settings[button_color]"
           value="' . $this->settings['colors']['button_color'] . '" class="regular-text color-field">';
					echo '<p class="description">';
						 _e('The color of the submit button. Leave blank to use the default color.', $this->plugin_name);
					echo '</p>';
				},
        'pluginspired_login_customizer_colors_settings_group',
        'pluginspired_login_customizer_colors_settings_section'
    );

    add_settings_field(
        'pluginspired_login_customizer_colors_settings[button_text_color]',
        __( 'Button Text Color', $this->plugin_name ),
        function() {
					echo '<input type="text" name="pluginspired_login_customizer_colors_settings[button_text_color]"
           value="' . $this->settings['colors']['button_text_color'] . '" class="regular-text color-field">';
					echo '<p class="description">';
						 _e('The color of the submit button text. Leave blank to use the default color.', $this->plugin_name);
					echo '</p>';
				},
        'pluginspired_login_customizer_colors_settings_group',
        'pluginspired_login_customizer_colors_settings_section'
    );

    add_settings_field(
        'pluginspired_login_customizer_colors_settings[button_hover_color]',
        __( 'Button Hover Color', $this->plugin_name ),
        function() {
					echo '<input type="text" name="pluginspired_login_customizer_colors_settings[button_hover_color]"
           value="' . $this->settings['colors']['button_hover_color'] . '" class="regular-text color-field">';
					echo '<p class="description">';
						 _e('The color of the submit button when hovered over. Leave blank to use the default color.', $this->plugin_name);
					echo '</p>';
				},
        'pluginspired_login_customizer_colors_settings_group',
        'pluginspired_login_customizer_colors_settings_section'
    );

    add_settings_field(
        'pluginspired_login_customizer_colors_settings[button_hover_text_color]',
        __( 'Button Hover Text Color', $this->plugin_name ),
        function() {
					echo '<input type="text" name="pluginspired_login_customizer_colors_settings[button_hover_text_color]"
           value="' . $this->settings['colors']['button_hover_text_color'] . '" class="regular-text color-field">';
					echo '<p class="description">';
						 _e('The color of the submit button text when hovered over. Leave blank to use the default color.', $this->plugin_name);
					echo '</p>';
				},
        'pluginspired_login_customizer_colors_settings_group',
        'pluginspired_login_customizer_colors_settings_section'
    );

    add_settings_field(
        'pluginspired_login_customizer_colors_settings[link_color]',
        __( 'Link Color', $this->plugin_name ),
        function() {
					echo '<input type="text" name="pluginspired_login_customizer_colors_settings[link_color]"
           value="' . $this->settings['colors']['link_color'] . '" class="regular-text color-field">';
					echo '<p class="description">';
						 _e('The color of text links under the login box. Leave blank to use the default color.', $this->plugin_name);
					echo '</p>';
				},
        'pluginspired_login_customizer_colors_settings_group',
        'pluginspired_login_customizer_colors_settings_section'
    );

    add_settings_field(
        'pluginspired_login_customizer_colors_settings[link_hover_color]',
        __( 'Link Hover Color', $this->plugin_name ),
        function() {
					echo '<input type="text" name="pluginspired_login_customizer_colors_settings[link_hover_color]"
           value="' . $this->settings['colors']['link_hover_color'] . '" class="regular-text color-field">';
					echo '<p class="description">';
						 _e('The color of the text links under the login box when hovered over. Leave blank to use the default color.', $this->plugin_name);
					echo '</p>';
				},
        'pluginspired_login_customizer_colors_settings_group',
        'pluginspired_login_customizer_colors_settings_section'
    );

    add_settings_field(
        'pluginspired_login_customizer_colors_settings[message_box_border_color]',
        __( 'Notice Box Border Color', $this->plugin_name ),
        function() {
					echo '<input type="text" name="pluginspired_login_customizer_colors_settings[message_box_border_color]"
           value="' . $this->settings['colors']['message_box_border_color'] . '" class="regular-text color-field">';
					echo '<p class="description">';
						 _e('The color of the border on the notice box. Leave blank to use the default color.', $this->plugin_name);
					echo '</p>';
				},
        'pluginspired_login_customizer_colors_settings_group',
        'pluginspired_login_customizer_colors_settings_section'
    );

    add_settings_field(
        'pluginspired_login_customizer_colors_settings[error_box_border_color]',
        __( 'Error Box Border Color', $this->plugin_name ),
        function() {
					echo '<input type="text" name="pluginspired_login_customizer_colors_settings[error_box_border_color]"
           value="' . $this->settings['colors']['error_box_border_color'] . '" class="regular-text color-field">';
					echo '<p class="description">';
						 _e('The color of the border on the error box. Leave blank to use the default color.', $this->plugin_name);
					echo '</p>';
				},
        'pluginspired_login_customizer_colors_settings_group',
        'pluginspired_login_customizer_colors_settings_section'
    );

		/* Logo */
		register_setting('pluginspired_login_customizer_logo_settings_group', 'pluginspired_login_customizer_logo_settings');

		add_settings_section(
        'pluginspired_login_customizer_logo_settings_section',
        __( 'Logo', $this->plugin_name ),
				function() {},
        'pluginspired_login_customizer_logo_settings_group'
    );

    add_settings_field(
        'pluginspired_login_customizer_logo_settings[logo_image_url]',
        __( 'Logo Image', $this->plugin_name ),
        function() {
					$logo_image = ((isset($this->settings['logo']['logo_image_url']) && !empty($this->settings['logo']['logo_image_url']))? $this->settings['logo']['logo_image_url'] : '' );
					echo '<div class="image_preview">';
						echo '<img src="' . ((!empty($logo_image))? $logo_image : '' ) . '" style="max-width:320px; '.((empty($logo_image))? 'display:none;' : '' ).'">';
						echo '<input type="hidden" name="pluginspired_login_customizer_logo_settings[logo_image_url]" value="' . ((!empty($logo_image))? $logo_image : '' ) . '" class="image_field">';
	 				echo '</div>';
					echo '<a class="button-primary add_image_button">' . ((empty($logo_image))? __('Add Image', $this->plugin_name ) : __('Change Image', $this->plugin_name )) .'</a>';
					echo '<a class="button-secondary remove_image_button" '. ((empty($logo_image))? 'style="display: none;"':'') . '>' . __('Remove Image', $this->plugin_name ) .'</a>';
				},
        'pluginspired_login_customizer_logo_settings_group',
        'pluginspired_login_customizer_logo_settings_section'
    );

    add_settings_field(
        'pluginspired_login_customizer_logo_settings[logo_title]',
        __( 'Logo Title', $this->plugin_name ),
        function() {
					echo '<input type="text" name="pluginspired_login_customizer_logo_settings[logo_title]"
           value="' . $this->settings['logo']['logo_title'] . '" class="regular-text">';
					echo '<p class="description">';
						 _e('Enter a custom value to use as the title for your logo. Leave blank to use the default title.', $this->plugin_name);
					echo '</p>';
				},
        'pluginspired_login_customizer_logo_settings_group',
        'pluginspired_login_customizer_logo_settings_section'
    );

    add_settings_field(
        'pluginspired_login_customizer_logo_settings[logo_link]',
        __( 'Logo Link', $this->plugin_name ),
        function() {
					$args = array(
				    'selected'              => ( isset($this->settings['logo']['logo_link']) && !empty($this->settings['logo']['logo_link']) )? $this->settings['logo']['logo_link'] : '',
				    'echo'                  => 1,
				    'name'                  => 'pluginspired_login_customizer_logo_settings[logo_link]',
				    'id'                    => 'pluginspired_login_customizer_logo_settings[logo_link]',
				    'show_option_none'      => __('Select...', $this->plugin_name),
				    'option_none_value'     => null,
					);
					wp_dropdown_pages( $args );
					echo '<p class="description">';
						 _e('Choose the page you would like the logo to link to. Leave un-selected to use the default link.', $this->plugin_name);
					echo '</p>';
				},
        'pluginspired_login_customizer_logo_settings_group',
        'pluginspired_login_customizer_logo_settings_section'
    );

		/* Background */
		register_setting('pluginspired_login_customizer_background_settings_group', 'pluginspired_login_customizer_background_settings');

		add_settings_section(
        'pluginspired_login_customizer_background_settings_section',
        __( 'Background', $this->plugin_name ),
				function() {},
        'pluginspired_login_customizer_background_settings_group'
    );

    add_settings_field(
        'pluginspired_login_customizer_background_settings[background_color]',
        __( 'Background Color', $this->plugin_name ),
        function() {
					echo '<input type="text" name="pluginspired_login_customizer_background_settings[background_color]"
           value="' . $this->settings['background']['background_color'] . '" class="regular-text color-field">';
					echo '<p class="description">';
						 _e('The background color for your login page. Leave blank to use the default color.', $this->plugin_name);
					echo '</p>';
				},
        'pluginspired_login_customizer_background_settings_group',
        'pluginspired_login_customizer_background_settings_section'
    );

    add_settings_field(
        'pluginspired_login_customizer_logo_settings[background_image_url]',
        __( 'Background Image', $this->plugin_name ),
        function() {
					$background_image = ((isset($this->settings['background']['background_image_url']) && !empty($this->settings['background']['background_image_url']))? $this->settings['background']['background_image_url'] : '' );
					echo '<div class="image_preview">';
						echo '<img src="' . ((!empty($background_image))? $background_image : '' ) . '" style="max-width:100%; '.((empty($background_image))? 'display:none;' : '' ).'">';
						echo '<input type="hidden" name="pluginspired_login_customizer_background_settings[background_image_url]" value="' . ((!empty($background_image))? $background_image : '' ) . '" class="image_field">';
	 				echo '</div>';
					echo '<a class="button-primary add_image_button">' . ((empty($background_image))? __('Add Image', $this->plugin_name ) : __('Change Image', $this->plugin_name )) .'</a>';
					echo '<a class="button-secondary remove_image_button" '. ((empty($background_image))? 'style="display: none;"':'') . '>' . __('Remove Image', $this->plugin_name ) .'</a>';
				},
        'pluginspired_login_customizer_background_settings_group',
        'pluginspired_login_customizer_background_settings_section'
    );

    add_settings_field(
        'pluginspired_login_customizer_background_settings[background_image_size]',
        __( 'Background Image Size', $this->plugin_name ),
        function() {
					echo '<select name="pluginspired_login_customizer_background_settings[background_image_size]" id="pluginspired_login_customizer_background_settings[background_image_size]">';
						echo '<option value="">'.__('Select...', $this->plugin_name).'</option>';
						echo '<option value="cover" '.((isset($this->settings['background']['background_image_size']) && !empty($this->settings['background']['background_image_size']) && $this->settings['background']['background_image_size'] == 'cover')?'selected':'').'>'.__('Cover', $this->plugin_name).'</option>';
						echo '<option value="contain" '.((isset($this->settings['background']['background_image_size']) && !empty($this->settings['background']['background_image_size']) && $this->settings['background']['background_image_size'] == 'contain')?'selected':'').'>'.__('Contain', $this->plugin_name).'</option>';
					echo '</select>';
					echo '<p class="description">';
						echo __('This is normally used when you have a larger, full-screen background image. If this is the case, select "Cover" for the best results.', $this->plugin_name);
					echo '</p>';
				},
        'pluginspired_login_customizer_background_settings_group',
        'pluginspired_login_customizer_background_settings_section'
    );

    add_settings_field(
        'pluginspired_login_customizer_background_settings[background_image_repeat]',
        __( 'Background Image Repeat', $this->plugin_name ),
        function() {
					echo '<select name="pluginspired_login_customizer_background_settings[background_image_repeat]" id="pluginspired_login_customizer_background_settings[background_image_repeat]">';
						echo '<option value="">'.__('Select...', $this->plugin_name).'</option>';
						echo '<option value="no-repeat" '.((isset($this->settings['background']['background_image_repeat']) && !empty($this->settings['background']['background_image_repeat']) && $this->settings['background']['background_image_repeat'] == 'no-repeat')?'selected':'').'>'.__('No Repeat', $this->plugin_name).'</option>';
						echo '<option value="repeat-x" '.((isset($this->settings['background']['background_image_repeat']) && !empty($this->settings['background']['background_image_repeat']) && $this->settings['background']['background_image_repeat'] == 'repeat-x')?'selected':'').'>'.__('Repeat Horizontally', $this->plugin_name).'</option>';
						echo '<option value="repeat-y" '.((isset($this->settings['background']['background_image_repeat']) && !empty($this->settings['background']['background_image_repeat']) && $this->settings['background']['background_image_repeat'] == 'repeat-y')?'selected':'').'>'.__('Repeat Vertically', $this->plugin_name).'</option>';
						echo '<option value="repeat" '.((isset($this->settings['background']['background_image_repeat']) && !empty($this->settings['background']['background_image_repeat']) && $this->settings['background']['background_image_repeat'] == 'repeat')?'selected':'').'>'.__('Repeat', $this->plugin_name).'</option>';
					echo '</select>';
					echo '<p class="description">';
						echo __('This is normally used when you have a smaller, tile-able background image. If this is the case, select "Repeat" for the best results.', $this->plugin_name);
					echo '</p>';
				},
        'pluginspired_login_customizer_background_settings_group',
        'pluginspired_login_customizer_background_settings_section'
    );

	}

	/**
	 * Create the default settings page.
	 *
	 * @since 	1.0.2
	 */
	public function settings_page() {

		// Get the view for the plugin settings page
		require plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/pluginspired-login-customizer-admin-colors.php';

	}

	/**
	 * Create the logo settings page.
	 *
	 * @since 	1.0.2
	 */
	public function settings_page_logo() {

		// Load the WordPress media handling scripts
		wp_enqueue_media();

		// Get the view for the plugin settings page
		require plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/pluginspired-login-customizer-admin-logo.php';

	}

	/**
	 * Create the background settings page.
	 *
	 * @since 	1.0.2
	 */
	public function settings_page_background() {

		// Load the WordPress media handling scripts
		wp_enqueue_media();

		// Get the view for the plugin settings page
		require plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/pluginspired-login-customizer-admin-background.php';

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.2
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in PlugInspired_Login_Customizer_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The PlugInspired_Login_Customizer_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		// The wordpress color picker
		wp_enqueue_style( 'wp-color-picker' );

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/pluginspired-login-customizer-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.2
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in PlugInspired_Login_Customizer_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The PlugInspired_Login_Customizer_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pluginspired-login-customizer-admin.js', array( 'jquery', 'wp-color-picker' ), $this->version, true );

	}

}
