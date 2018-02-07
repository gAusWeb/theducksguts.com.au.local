<?php
/**
 * Plugin Name: TK Shortcodes
 * Plugin URI:  http://www.themeskingdom.com
 * Description: Simple plugin that allows you to add beautiful and useful shortcodes to your content.
 * Version:     2.0
 * Author:      ThemesKingdom
 * Author URI:  http://www.themeskingdom.com
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: tkingdom
 * Domain Path: /languages
 * @link        http://www.themeskingdom.com
 * @since       2.0.0
 * @package     Tk_Shortcodes
 *
 * @wordpress-plugin
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tk-shortcodes.php';

/**
 * Load Translaton Text Domain
 */
function tk_shortcodes_load_plugin_textdomain() {
    load_plugin_textdomain( 'tkingdom', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'tk_shortcodes_load_plugin_textdomain' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    2.0.0
 */
function run_tk_shortcodes() {

	$plugin = new Tk_Shortcodes();
	$plugin->run();

}
run_tk_shortcodes();
