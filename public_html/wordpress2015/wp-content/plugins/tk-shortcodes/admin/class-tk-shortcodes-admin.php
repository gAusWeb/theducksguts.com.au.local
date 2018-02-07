<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.themeskingdom.com
 * @since      2.0.0
 *
 * @package    Tk_Shortcodes
 * @subpackage Tk_Shortcodes/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tk_Shortcodes
 * @subpackage Tk_Shortcodes/admin
 * @author     Themes Kingdom <info@themeskingdom.com>
 */
class Tk_Shortcodes_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    2.0.0
	 * @param    string    $plugin_name       The name of this plugin.
	 * @param    string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name . '-fa', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tk-shortcodes-admin.css', array(), $this->version, 'all' );
		// Add the color picker css file
		wp_enqueue_style( 'wp-color-picker' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_scripts() {

		// Add the color picker script
        wp_enqueue_script( 'wp-color-picker' );
        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tk-admin-scripts.js', array(), $this->version, false );
	}

}
