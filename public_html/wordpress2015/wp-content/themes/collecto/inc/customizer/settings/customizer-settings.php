<?php
/**
 * Customization of theme layout
 *
 * @package collecto
 */

/**
 * Settings
 */

// Slider width
$wp_customize->add_setting( 'site-branding', array(
    'default'           => 'scroll',
    'sanitize_callback' => 'collecto_sanitize_identity_scroll'
) );

$wp_customize->add_control( 'site-branding', array(
    'label'       => esc_html__( 'Scrolling Settings', 'collecto' ),
    'priority'    => 40,
    'section'     => 'title_tagline',
    'type'        => 'radio',
    'choices'     => array(
        'scroll' => esc_html__( 'Normal', 'collecto' ),
        'fixed' => esc_html__( 'Sticky', 'collecto' )
    ),
) );
