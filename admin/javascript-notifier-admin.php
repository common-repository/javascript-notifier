<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function javascript_notifier_action_links( $links ) {
	array_unshift( $links, '<a href="' . esc_url( get_admin_url( null, 'options-general.php?page=javascript-notifier-settings' ) ) . '">' . __( 'Settings' ) . '</a>' );
	return $links;
}

add_action( 'admin_enqueue_scripts',
	function() {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'javascript-notifier-admin', plugins_url( 'js/javascript-notifier-admin.js', __FILE__ ), array( 'wp-color-picker' ), JAVASCRIPT_NOTIFIER_VERSION );
	} );

add_action( 'admin_init',
	function() {
		register_setting( 'javascript-notifier-settings', 'javascript_notifier_settings' );
	} );

add_action( 'admin_menu',
	function() {
		add_options_page( __( 'JavaScript Notifier Settings', 'javascript-notifier' ), 'JavaScript Notifier', 'administrator', 'javascript-notifier-settings',
			function() {
				$settings = get_option( 'javascript_notifier_settings' );
				$block = $settings['block'];
?>
<div class="wrap">
<h2><?php _e( 'JavaScript Notifier Settings', 'javascript-notifier' ); ?></h2>
<p><?php _e( 'JavaScript Notifier allows you to inform visitors that your website requires JavaScript.', 'javascript-notifier' ); ?></p>
<form method="post" action="options.php">
<?php settings_fields( 'javascript-notifier-settings' ); ?>
<?php do_settings_sections( 'javascript-notifier-settings' ); ?>
<table class="form-table">
	<tr valign="top">
	<th scope="row"><?php _e( 'Notification Message', 'javascript-notifier' ); ?></th>
	<td><input type="text" size="60" name="javascript_notifier_settings[message]" value="<?php echo esc_html( $settings['message'] ); ?>" /></td>
	</tr>
	<tr valign="top">
	<th scope="row"><?php _e( 'Blocking Mode', 'javascript-notifier' ); ?></th>
	<td><input type="checkbox" name="javascript_notifier_settings[block]" <?php checked( $block, 'on' ); ?> /> <?php _e( 'Block entire website as long as JavaScript is disabled', 'javascript-notifier' ) ?></td>
	</tr>
	<tr valign="top">
	<th scope="row"><?php _e( 'Text Color', 'javascript-notifier' ); ?></th>
	<td><input type="text" name="javascript_notifier_settings[fg_color]" value="<?php echo esc_attr( $settings['fg_color'] ); ?>" class="wp_color_picker" data-default-color="#<?php echo( $block ? 'ffb226' : 'ffffff' ); ?>" /></td>
	</tr>
	<tr valign="top">
	<th scope="row"><?php _e( 'Background Color', 'javascript-notifier' ); ?></th>
	<td><input type="text" name="javascript_notifier_settings[bg_color]" value="<?php echo esc_attr( $settings['bg_color'] ); ?>" class="wp_color_picker" data-default-color="#<?php echo( $block ? '000000' : 'e95e18' ); ?>" /></td>
	</tr>
	<tr valign="top">
	<th scope="row"><?php _e( 'Font Size', 'javascript-notifier' ); ?></th>
	<td><input style="width:70px" type="number" name="javascript_notifier_settings[font_size]" min="0" step="1" required="true" value="<?php echo esc_attr( $settings['font_size'] ); ?>" />&nbsp;&#37;</td>
	</tr>
	<tr valign="top">
	<th scope="row"><?php _e( 'Opacity', 'javascript-notifier' ); ?></th>
	<td><input style="width:60px" type="number" name="javascript_notifier_settings[opacity]" min="0" max="1" step="0.01" required="true" value="<?php echo esc_attr( $settings['opacity'] ); ?>" />&nbsp;&nbsp;[&nbsp;<?php _e( 'min: 0 (transparent), max: 1 (opaque)', 'javascript-notifier' ); ?>&nbsp;]</td>
	</tr>
	<tr valign="top">
	<th scope="row"><?php _e( 'Custom CSS', 'javascript-notifier' ); ?></th>
	<td><input type="text" size="60" name="javascript_notifier_settings[custom_css]" value="<?php echo esc_html( $settings['custom_css'] ); ?>" /></td>
	</tr>
</table>
<?php submit_button(); ?>
</form>
</div>
<?php
			} );
	} );
