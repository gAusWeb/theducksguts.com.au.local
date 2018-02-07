<?php
/**
 * Create and define the shortcodes
 *
 * @package ZillaShortcodes
 * @since  1.0
 */

/* Row --- */

if ( !function_exists( 'row' ) ) {
	function row( $atts, $content = null ) {
		return '<div class="row-columns">' . do_shortcode( $content ) . '</div>';
	}
	add_shortcode( 'row', 'row' );
}


/* Column Shortcodes --- */

if ( !function_exists( 'column' ) ) {
	function column( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'column' => 'one-third'
		), $atts ) );

		switch ( $column ) {
			case 'one-third':
				$column_class = 'column-md-4';
				break;
			case 'two-third':
				$column_class = 'column-md-8';
				break;
			case 'one-half':
				$column_class = 'column-md-6';
				break;
			case 'one-fourth':
				$column_class = 'column-md-3';
				break;
			case 'three-fourth':
				$column_class = 'column-md-9';
				break;
			case 'one-sixth':
				$column_class = 'column-lg-2 column-md-3';
				break;
			case 'five-sixth':
				$column_class = 'column-lg-10 column-md-9';
				break;
		}

		return '<div class="' . $column_class . '">' . do_shortcode( $content ) . '</div>';
	}
	add_shortcode( 'column', 'column' );
}

/* Buttons --- */

if ( !function_exists( 'button' ) ) {
	function button( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'url'    => '#',
			'target' => '_self',
			'style'  => 'grey',
			'size'   => 'small',
			'type'   => 'round'
	    ), $atts ) );

	   return '<a target="' . $target . '" class="tk-btn ' . $size . ' ' . $style . ' ' . $type . '" href="' . $url . '">' . do_shortcode( $content ) . '</a>';
	}
	add_shortcode( 'button', 'button' );
}

/* Dropcap --- */

if ( !function_exists( 'dropcap' ) ) {
    function dropcap( $atts, $content = null ) {
        extract( shortcode_atts( array(
			'style' => '',
        ), $atts ) );

        return '<span class="dropcap-' . $style . '">' . do_shortcode( $content ) . '</span>';
    }
    add_shortcode( 'dropcap', 'dropcap' );
}

/* Fullwidth Section --- */

if ( !function_exists( 'fullwidth' ) ) {
	function fullwidth( $atts, $content = null ) {
		extract(  shortcode_atts( array(
			'backgroundcolor'  => '#fff',
			'imagebackground'  => '',
			'backgroundrepeat' => ''
	    ), $atts ) );

	    return '<div class="column-md-12 fullwidth-section" style="background-color:' . $backgroundcolor . '; background-image:url(' . $imagebackground . '); background-repeat:' . $backgroundrepeat . ';">' . do_shortcode( $content ) . '</div>';

	}
	add_shortcode( 'fullwidth', 'fullwidth' );
}

/* Alerts --- */

if ( !function_exists( 'infobox' ) ) {
	function infobox( $atts, $content = null ) {
		extract(  shortcode_atts( array(
			'style'   => 'white'
	    ), $atts ) );

	   return '<div class="tksc-alert-box ' . $style . '">' . do_shortcode( $content ) . '<i class="close-infobox"></i></div>';
	}
	add_shortcode( 'infobox', 'infobox' );
}

/* Progress Bar --- */

if ( !function_exists( 'progress_bar' ) ) {
    function progress_bar( $atts, $content = null ) {
        extract( shortcode_atts( array(
			'style'          => '#',
			'bar_percentage' => ''
        ), $atts ) );

        return '<p class="progress-info">' . do_shortcode( $content) . '</p>
	            <div class="tk-progress">
	                <div class="bar" data-width="' . $bar_percentage . '%"></div>
	                <span class="bar-percentage"></span>
	            </div>';
    }
    add_shortcode( 'progressbar', 'progress_bar' );
}

/* Toggle Shortcodes --- */

if ( !function_exists( 'toggle' ) ) {
	function toggle( $atts, $content = null ) {
	    extract( shortcode_atts( array(
			'title' => 'Title goes here',
			'state' => 'opened'
	    ), $atts ) );

        return '<div data-state="' . $state . '" class="tk_toggle ' . $state . ' " background:transparent;">
		            <h5 class="tab-head">' . $title . '<i class="icon-tg-acc"></i></h5>
		            <div class="tab-body close cf">
		                <div class="tabs-content"><p>' . do_shortcode( $content ) . '</p></div>
		            </div>
		        </div>';
	}
	add_shortcode( 'toggle', 'toggle' );
}

/* Tabs Shortcodes --- */

if ( !function_exists( 'tabs' ) ) {
	function tabs( $atts, $content = null ) {
		$defaults = array();
		extract( shortcode_atts( $defaults, $atts ) );

		STATIC $i = 0;
		$i++;

		// Extract the tab titles for use in the tab widget.
		preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );

		$tab_titles = array();
		if( isset( $matches[1]) ){ $tab_titles = $matches[1]; }

		$output = '';

		if ( count( $tab_titles) ) {
		    $output .= '<div id="tk-tabs-'. $i .'" class="tk-shortcode-tabs">';
			$output .= '<ul class="nav tk-nav-tabs tk_tabs">';

			foreach( $tab_titles as $tab ){
				$output .= '<li><a href="#tk-tab-'. sanitize_title( $tab[0] ) .'"><h5>' . $tab[0] . '</h5></a></li>';
			}

		    $output .= '</ul>';
		    $output .= '<div class="tab-content"><div class="tab-pane"><div class="tabs-content">';
		    $output .= do_shortcode( $content );
		    $output .= '</div></div></div></div>';
		}
		else {
			$output .= do_shortcode( $content );
		}

		return $output;
	}
	add_shortcode( 'tabs', 'tabs' );
}

if ( !function_exists( 'tab' ) ) {
	function tab( $atts, $content = null ) {
		$defaults = array( 'title' => 'Tab' );
		extract(  shortcode_atts( $defaults, $atts ) );

		return '<div id="tk-tab-'. sanitize_title( $title ) .'" class="tk-tab"><p>'. do_shortcode( $content ) .'</p></div>';
	}
	add_shortcode( 'tab', 'tab' );
}

/* Accordion Shortcodes --- */

if ( !function_exists( 'accordion' ) ) {
	function accordion( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'accordions' => '',
        ), $atts ) );

		$output          = '';
		$tk_unique_class = uniqid( 'tk_', false );
		$output         .= '<div class="tk_accordion_wrapper">';
		$myContent       = do_shortcode( $content );
		$output         .= $myContent;
		$output         .= '</div>';

        return $output;
	}
	add_shortcode( 'accordion', 'accordion' );
}

if ( !function_exists( 'accordions' ) ) {
	// Insert panes for each tab title
    function accordions( $atts, $content = null ) {
        extract( shortcode_atts( array(
			'title' => '',
			'state' => 'closed'
        ), $atts ) );

        $output = '<div class="tk_accordion ' . $state . '">
		                <h5 class="tab-head">' . $title . '<i class="icon-tg-acc"></i></h5>
		                <div class="tab-body cf">
		                    <div class="tabs-content"><p>' . do_shortcode( $content ) . '</p></div>
		                </div>
		            </div>';

        return $output;
    }
    add_shortcode( 'accordions', 'accordions' );
}

/* Icons Shortcodes--- */

if ( !function_exists( 'icon' ) ) {
	function icon( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'size'  => 'large',
			'image' => 'icon-circle',
			'url'   => ''
	    ), $atts ) );

		if( $size == 'extra-large' ) {
			$size_class = 'fa-5x';
		}
		else if ( $size == 'large' ) {
			$size_class = 'fa-4x';
		}
		else if ( $size == 'medium' ) {
			$size_class = 'fa-3x';
		}
		else if ( $size == 'small' ) {
			$size_class = 'fa-2x';
		}
		else if ( $size == 'extra-small' ) {
			$size_class = 'fa-lg';
		}
		else {
			$size_class = '';
		}

		( $size == 'large' ) ? $border = '<i class="circle-border"></i>' : $border = '';

        if( $url !="") {
            return '<a class="tk-icon-link" href=" '. $url . ' "><i class="'. $size_class . ' ' . $image . '">' . $border . '</i></a>';
        }
        else {
            return '<i class="'. $size_class . ' ' . $image . '">' . $border . '</i>';
        }
	}
	add_shortcode( 'icon', 'icon' );
}

?>