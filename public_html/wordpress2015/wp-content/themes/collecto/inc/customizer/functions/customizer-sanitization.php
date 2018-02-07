<?php
/**
 * Customizer sanitization functions
 *
 * @package collecto
 */

/**
 * Sanitize checkbox
 */
function collecto_sanitize_checkbox( $checkbox ) {
    if ( $checkbox ) {
        $checkbox = 1;
    } else {
        $checkbox = false;
    }
    return $checkbox;
}

/**
 * Sanitize selection.
 */
function collecto_sanitize_select( $selection ) {
    return $selection;
}


/**
 * Sanitize the dropdown pages.
 *
 * @param interger $input.
 * @return interger.
 */
function collecto_sanitize_dropdown_pages( $input ) {
    if ( is_numeric( $input ) ) {
        return intval( $input );
    }
}


/**
 * Sanitize text
 */
function collecto_sanitize_text( $text ) {
    return esc_html( $text );
}

/**
 * Sanitize colors
 */
function collecto_sanitize_color( $hex, $default = '' ) {
    if ( collecto_of_validate_hex( $hex ) ) {
        return $hex;
    }
    return $default;
}

function collecto_of_validate_hex( $hex ) {
    $hex = trim( $hex );
    /* Strip recognized prefixes. */
    if ( 0 === strpos( $hex, '#' ) ) {
        $hex = substr( $hex, 1 );
    }
    elseif ( 0 === strpos( $hex, '%23' ) ) {
        $hex = substr( $hex, 3 );
    }
    /* Regex match. */
    if ( 0 === preg_match( '/^[0-9a-fA-F]{6}$/', $hex ) ) {
        return false;
    }
    else {
        return true;
    }
}

/**
 * Sanitize site identity scrolling settings
 */
function collecto_sanitize_identity_scroll( $selection ) {
    if ( !in_array( $selection, array( 'scroll', 'fixed' ) ) ) {
        $selection = 'scroll';
    } else {
        return $selection;
    }
}

