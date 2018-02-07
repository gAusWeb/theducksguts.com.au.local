<?php
/**
 * collecto Theme Customizer.
 *
 * @package collecto
 */

/**
 * Customizer Sanitization and custom function
 */
require get_template_directory() . '/inc/customizer/functions/customizer-sanitization.php';
require get_template_directory() . '/inc/customizer/functions/customizer-functions.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function collecto_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Remove default Colors section
	$wp_customize->remove_section( 'colors' );

	// Remove default Header options except Display header text option
	$wp_customize->remove_control( 'header_image' );
	$wp_customize->remove_control( 'header_textcolor' );

	/**
	 * PANELS
	 */
	// Colors Panel
	$wp_customize->add_panel( 'collecto_colors_panel', array(
		'title'       => esc_html__( 'Color Settings', 'collecto' ),
		'description' => esc_html__( 'For customizing theme colors', 'collecto' ),
		'priority'    => 190
	) );


	/**
	 * SECTIONS AND SETTINGS
	 */

	// Colors
	require get_template_directory() . '/inc/customizer/settings/customizer-colors.php';

	// Google fonts
	require get_template_directory() . '/inc/customizer/settings/customizer-google-fonts.php';

	// Theme options
	require get_template_directory() . '/inc/customizer/settings/customizer-settings.php';

}
add_action( 'customize_register', 'collecto_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function collecto_customize_preview_js() {
	wp_enqueue_script( 'collecto-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'collecto_customize_preview_js' );
