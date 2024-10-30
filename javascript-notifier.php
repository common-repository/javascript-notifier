<?php
/**
 * Plugin Name: JavaScript Notifier
 * Plugin URI: https://wordpress.org/plugins/javascript-notifier
 * Description: Notify visitors of your website if 1st-party JavaScript is disabled. Block entire site, if required.
 * Version: 1.2.8
 * Author: freemp
 * Author URI: https://profiles.wordpress.org/freemp
 * Text Domain: javascript-notifier
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'JAVASCRIPT_NOTIFIER_VERSION', '1.2.8' );

if ( is_admin() ) {
	require_once dirname( __FILE__ ) . '/admin/javascript-notifier-admin.php';
	add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'javascript_notifier_action_links' );
}

add_action( 'plugins_loaded',
	function() {
		load_plugin_textdomain( 'javascript-notifier', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
		/* Create settings array. Process legacy options, if required. */
		if ( false === get_option( 'javascript_notifier_settings' ) ) {
			$settings = array();
			$settings['message'] = get_option( 'javascript_notifier_message' );
			if ( false === $settings['message'] )
				$settings['message'] = __( 'Please enable JavaScript in your browser.', 'javascript-notifier' );
			else delete_option( 'javascript_notifier_message' );
			$settings['block'] = get_option( 'javascript_notifier_block' );
			if ( false === $settings['block'] )
				$settings['block'] = '';
			else delete_option( 'javascript_notifier_block' );
			$settings['fg_color'] = get_option( 'javascript_notifier_fg_color' );
			if ( false === $settings['fg_color'] )
				$settings['fg_color'] = '#ffffff';
			else delete_option( 'javascript_notifier_fg_color' );
			$settings['bg_color'] = get_option( 'javascript_notifier_bg_color' );
			if ( false == $settings['bg_color'] )
				$settings['bg_color'] = '#e95e18';
			else delete_option( 'javascript_notifier_bg_color' );
			$settings['font_size'] = get_option( 'javascript_notifier_font_size' );
			if ( false === $settings['font_size'] )
				$settings['font_size'] = '100';
			else {
				// Convert to percent
				$settings['font_size'] = ( string ) round( 100 * $settings['font_size'] );
				delete_option( 'javascript_notifier_font_size' );
			}
			$settings['opacity'] = get_option( 'javascript_notifier_opacity' );
			if ( false === $settings['opacity'] )
				$settings['opacity'] = '1';
			else delete_option( 'javascript_notifier_opacity' );
			$settings['custom_css'] = get_option( 'javascript_notifier_custom_css' );
			if ( false === $settings['custom_css'] )
				$settings['custom_css'] = '';
			else delete_option( 'javascript_notifier_custom_css' );
			// Save settings array
			add_option( 'javascript_notifier_settings', $settings );
		}
	} );

add_action( 'wp_enqueue_scripts',
	function() {
		wp_enqueue_style( 'javascript-notifier', plugins_url( 'css/javascript-notifier.css', __FILE__ ), array(), JAVASCRIPT_NOTIFIER_VERSION );
	} );

add_action( 'wp_footer',
	function() {
		$settings = get_option( 'javascript_notifier_settings' );
		$block = $settings['block'] ?? '';
		$style = 'style="background-color:' . $settings['bg_color'] . ';color:' . $settings['fg_color'] . ';font-size:' . $settings['font_size'] . '%;opacity:' . $settings['opacity'] . ';' . $settings['custom_css'] . '"';
?>
<!-- JavaScript Notifier -->
<?php if( $block ) : ?><div class="javascript_notifier" id="javascript_notifier_block" <?php echo $style; ?>><div id="javascript_notifier_block_2"><div id="javascript_notifier_block_3"><?php else : ?><div class="javascript_notifier" id="javascript_notifier_bar" <?php echo $style; ?>><?php endif; ?><strong><?php echo $settings['message']; ?></strong></div><?php if( $block ) : ?></div></div><?php endif; ?>
<script id="hide-javascript-notifier-js" type="application/javascript">
document.getElementById('javascript_notifier_<?php echo( $block ? 'block' : 'bar' ); ?>').style.setProperty('display', 'none', 'important');
</script>
<!-- End JavaScript Notifier -->
<?php
	}, 1 );
