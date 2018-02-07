<?php
/**
 * Customizer Custom Colors
 *
 * Here you can define your own CSS rules
 *
 * @package  collecto
 */

/*
 *
 * Sections
 *
 */
$wp_customize->add_section( 'collecto_colors_section', array(
    'title'    => esc_html__( 'General Theme Colors', 'collecto' ),
    'priority' => 0,
    'panel'    => 'collecto_colors_panel'
) );


/**
 *
 * Settings
 *
 */

/* GENERAL COLORS */

// Main theme color
$wp_customize->add_setting( 'collecto_main_color', array(
    'default'           => '#eee',
    'sanitize_callback' => 'collecto_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'collecto_main_color',
        array(
            'label'    => esc_html__( 'Lines Color', 'collecto' ),
            'section'  => 'collecto_colors_section',
            'priority' => 0
        ) )
);

// Body BG color
$wp_customize->add_setting( 'collecto_body_bg_color', array(
    'default'           => '#fff',
    'sanitize_callback' => 'collecto_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'collecto_body_bg_color',
        array(
            'label'    => esc_html__( 'Background Color', 'collecto' ),
            'section'  => 'collecto_colors_section',
            'priority' => 0
        ) )
);

// Headings color
$wp_customize->add_setting( 'collecto_heading_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'collecto_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'collecto_heading_color',
        array(
            'label'    => esc_html__( 'Headings Color', 'collecto' ),
            'section'  => 'collecto_colors_section',
            'priority' => 1
        ) )
);

// Paragraph color
$wp_customize->add_setting( 'collecto_paragraph_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'collecto_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'collecto_paragraph_color',
        array(
            'label'    => esc_html__( 'Paragraph / Text Color', 'collecto' ),
            'section'  => 'collecto_colors_section',
            'priority' => 3
        ) )
);

// Meta Link color
$wp_customize->add_setting( 'collecto_meta_link_color', array(
    'default'           => '#121212',
    'sanitize_callback' => 'collecto_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'collecto_meta_link_color',
        array(
            'label'    => esc_html__( 'Link Color', 'collecto' ),
            'section'  => 'collecto_colors_section',
            'priority' => 6
        ) )
);
