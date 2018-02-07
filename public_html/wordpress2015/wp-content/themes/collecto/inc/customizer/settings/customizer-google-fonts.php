<?php
/**
 * Customize Google Fonts
 *
 * @package collecto
 */

/* --- Section --- */

// Front Page Slider Section
$wp_customize->add_section( 'google_fonts_section', array(
	'title'       => esc_html__( 'Font Settings', 'collecto' ),
	'description' => esc_html__( 'Choose fonts for your content', 'collecto' ),
	'priority'    => 200
) );

/* --- Settings --- */
$wp_customize->add_setting( 'headings_font_family', array(
	'default'           => 'default',
	'sanitize_callback' => 'collecto_sanitize_select'
) );

$wp_customize->add_control( 'headings_font_family', array(
	'type'     => 'select',
	'label'    => esc_html__( 'Headings Font Family', 'collecto' ),
	'section'  => 'google_fonts_section',
	'priority' => 0,
	'choices'  => collecto_list_google_fonts()
) );

/* font weight */

$wp_customize->add_setting( 'headings_font_weight', array(
	'default'           => 'normal',
	'sanitize_callback' => 'collecto_sanitize_select'
) );

$wp_customize->add_control( 'headings_font_weight', array(
	'type'     => 'select',
	'label'    => esc_html__( 'Headings Font Weight', 'collecto' ),
	'section'  => 'google_fonts_section',
	'priority' => 1,
	'choices'  => array(
		'default' => 'Default'
	)
) );

// Divider
$wp_customize->add_setting( 'collecto_second_cta_divider0', array(
    'sanitize_callback' => 'collecto_sanitize_text',
) );

// Divider
$wp_customize->add_control( new WP_Customize_Divider_Control(
    $wp_customize,
    'collecto_second_cta_divider0',
        array(
            'section'  => 'google_fonts_section',
            'priority' => 2
        )
) );

// Primary font family
$wp_customize->add_setting( 'primary_font_family', array(
	'default'           => 'default',
	'sanitize_callback' => 'collecto_sanitize_select'
) );

$wp_customize->add_control( 'primary_font_family', array(
	'type'     => 'select',
	'label'    => esc_html__( 'Primary Font Family', 'collecto' ),
	'section'  => 'google_fonts_section',
	'priority' => 3,
	'choices'  => collecto_list_google_fonts()
) );

/* font weight */

$wp_customize->add_setting( 'primary_font_weight', array(
	'default'           => 'normal',
	'sanitize_callback' => 'collecto_sanitize_select'
) );

$wp_customize->add_control( 'primary_font_weight', array(
	'type'     => 'select',
	'label'    => esc_html__( 'Primary Font Weight', 'collecto' ),
	'section'  => 'google_fonts_section',
	'priority' => 4,
	'choices'  => array(
		'default' => 'Default'
	)
) );

// Divider
$wp_customize->add_setting( 'collecto_second_cta_divider1', array(
    'sanitize_callback' => 'collecto_sanitize_text',
) );

// Divider
$wp_customize->add_control( new WP_Customize_Divider_Control(
    $wp_customize,
    'collecto_second_cta_divider1',
        array(
            'section'  => 'google_fonts_section',
            'priority' => 5
        )
) );

// Secondary font family
$wp_customize->add_setting( 'secondary_font_family', array(
	'default'           => 'default',
	'sanitize_callback' => 'collecto_sanitize_select'
) );

$wp_customize->add_control( 'secondary_font_family', array(
	'type'     => 'select',
	'label'    => esc_html__( 'Secondary Font Family', 'collecto' ),
	'section'  => 'google_fonts_section',
	'priority' => 6,
	'choices'  => collecto_list_google_fonts()
) );

/* font weight */

$wp_customize->add_setting( 'secondary_font_weight', array(
	'default'           => 'normal',
	'sanitize_callback' => 'collecto_sanitize_select'
) );

$wp_customize->add_control( 'secondary_font_weight', array(
	'type'     => 'select',
	'label'    => esc_html__( 'Secondary Font Weight', 'collecto' ),
	'section'  => 'google_fonts_section',
	'priority' => 7,
	'choices'  => array(
		'default' => 'Default'
	)
) );
