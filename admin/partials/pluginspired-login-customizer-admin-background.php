<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://pluginspired.com/
 * @since      1.0.2
 *
 * @package    PlugInspired_Login_Customizer
 * @subpackage PlugInspired_Login_Customizer/admin/partials
 */
?>
<div id="pluginspired-login-customizer-wrap" class="wrap">

	<h1><?php _e('PlugInspired Login Customizer', $this->plugin_name); ?> <small><?php echo $this->version; ?></small></h1>

	<?php echo $this->get_top_static_notice(); ?>

	<?php if( isset($_GET['settings-updated']) ) { ?>
    <div class="notice notice-success is-dismissible">
        <p><strong><?php _e('Settings saved.') ?></strong></p>
    </div>
	<?php } ?>

	<div class="main-left">

		<form id="pluginspired_settings" method="post" action="options.php">

			<div class="tab-container">

				<ul class="tabs">
					<li class="tab-link"><a href="<?php echo admin_url( 'admin.php?page=pluginspired-login-customizer' ); ?>"><?php _e('Colors &amp; Styles') ?></a></li>
					<li class="tab-link"><a href="<?php echo admin_url( 'admin.php?page=pluginspired-login-customizer-logo' ); ?>"><?php _e('Logo') ?></a></li>
					<li class="tab-link current"><a href="<?php echo admin_url( 'admin.php?page=pluginspired-login-customizer-background' ); ?>"><?php _e('Background') ?></a></li>
				</ul>

				<div class="tab-content current">

					<?php
            settings_fields( 'pluginspired_login_customizer_background_settings_group' );
            do_settings_sections( 'pluginspired_login_customizer_background_settings_group' );
            submit_button();
          ?>

				</div>

			</div><!-- container -->
		</form>

	</div>

	<div class="main-right">

		<div class="banners">

			<a href="https://pluginspired.com/wordpress-plugins/premium/login-customizer-pro/" target="_blank">
				<img src="<?php echo $this->url; ?>images/pluginspired-login-customizer-pro-banner.png" alt="Go pro for additional features" />
			</a>

		</div>

	</div>

</div>
