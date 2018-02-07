<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package collecto
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function collecto_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Get blog layout setting
	$site_branding = get_theme_mod( 'site-branding', 'scroll' );

	if ( $site_branding == 'fixed') {
		$classes[] = 'fixed-site-header';
	}

	return $classes;
}
add_filter( 'body_class', 'collecto_body_classes' );


/**
 * Check for embed content in post and extract
 *
 * @since collecto 1.0
 */
function collecto_get_embeded_media() {
	$content   = get_the_content();
	$embeds    = get_media_embedded_in_content( $content );
	$video_url = wp_extract_urls( $content );

	if ( !empty( $embeds ) ) {

		// Check what is the first embed containg video tag, youtube or vimeo
		foreach( $embeds as $embed ) {
			if ( strpos( $embed, 'video' ) || strpos( $embed, 'youtube' ) || strpos( $embed, 'vimeo' ) ) {

				$id   = 'collecto' . rand();
				$href = "#TB_inline?height=640&width=1000&inlineId=" . $id;

				if ( !is_single() && has_post_thumbnail() ) {

					$video_url = '<div id="' . $id . '" style="display:none;">' . $embed . '</div>';
					$video_url .= '<div class="featured-content featured-image"><a class="thickbox" title="' . get_the_title() . '" href="' . $href . '">' . get_the_post_thumbnail() . '</a></div>';

					return $video_url;

				} else {

					return $embed;

				}

			}
		}

	} else {

		if ( $video_url ) {

			if ( strpos( $video_url[0], 'youtube' ) || strpos( $video_url[0], 'vimeo' ) ) {

				$id   = 'collecto' . rand();
				$href = "#TB_inline?height=640&width=1000&inlineId=" . $id;

				if ( !is_single() && has_post_thumbnail() ) {

					$video_url = '<div id="' . $id . '" style="display:none;">' . wp_oembed_get( $video_url[0] ) . '</div>';
					$video_url .= '<div class="featured-content featured-image"><a class="thickbox" title="' . get_the_title() . '" href="' . $href . '">' . get_the_post_thumbnail() . '</a></div>';

					return $video_url;

				} else {

					return wp_oembed_get( $video_url[0] );

				}

			}

		} else {
			// No video embedded found
			return $content;
		}
	}
}

/**
 * Filter content for Gallery and Video post format
 *
 * @since  collecto 1.0
 */
function collecto_remove_video($content) {

	if ( 'video' == get_post_format() ) {
		$embed_content = get_media_embedded_in_content( $content );
		$media_urls    = wp_extract_urls( $content );

		if ( $embed_content ) {

			$content = str_replace( $embed_content, '', $content );

		}

		if ( $media_urls ) {

			foreach ($media_urls as $url) {

				if ( strpos( $url, 'youtube' ) !== false || strpos( $url, 'vimeo' ) !== false ) {

					$content = str_replace( $url, '', $content );
				}
			}
		}
	}

	return $content;
}

add_filter( 'the_content', 'collecto_remove_video' );

function collecto_filter_post_content( $content ) {

	if ( 'page' != get_post_type() ) :


		if ( 'gallery' == get_post_format() ) {
			$regex   = '/\[gallery.*]/';
			$content = preg_replace( $regex, '', $content, -1 );
		}

	endif;

	return $content;
}
add_filter( 'the_content', 'collecto_filter_post_content', 1, 1 );

/**
 * Remove parenthesses from excerpt
 *
 * @since collecto 1.0
 */
function collecto_excerpt_more( $more ) {
	return;
}
add_filter( 'excerpt_more', 'collecto_excerpt_more' );


/**
 * Add read more text to excerpt
 *
 * @since collecto 1.0
 */
function collecto_add_read_more_excerpt( $excerpt ) {
	$read_more_txt = sprintf(
		/* translators: %s: Name of current post. */
		wp_kses( __( 'Read More', 'collecto' ), array( 'span' => array( 'class' => array() ) ) ),
		the_title( '<span class="screen-reader-text">"', '"</span>', false )
	);

	return $excerpt . '<a class="read-more-link" href=" ' . esc_url( get_permalink() ) . ' ">' . $read_more_txt . '</a>';
}
add_filter( 'the_excerpt', 'collecto_add_read_more_excerpt' );

/**
 * Parenthesses remove
 *
 * Removes parenthesses from category and archives widget
 *
 * @since collecto 1.0
 */
function collecto_categories_postcount_filter( $variable ) {
	$variable = str_replace( '(', '<span class="post_count"> ', $variable );
	$variable = str_replace( ')', '</span>', $variable );
	return $variable;
}
add_filter( 'wp_list_categories','collecto_categories_postcount_filter' );

function collecto_archives_postcount_filter( $variable ) {
	$variable = str_replace( '(', '<span class="post_count"> ', $variable );
	$variable = str_replace( ')', '</span>', $variable );
	return $variable;
}
add_filter( 'get_archives_link','collecto_archives_postcount_filter' );


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function collecto_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'collecto_pingback_header' );

/**
 * Get title of page that uses portfolio template
 *
 * @return  String [Page title]
 */
function collecto_return_portfolio_page( $type ) {
	$pages = get_pages( array(
		'meta_key'   => '_wp_page_template',
		'meta_value' => 'templates/gallery-page.php'
	) );

	if ( !empty( $pages ) ) {
		if ( 'id' == $type ) {
			return $pages[0]->ID;
		} else {
			return $pages[0]->post_title;
		}
	}
}

/* Convert hexdec color string to rgb(a) string */

function collecto_hex2rgba( $color, $opacity = false ) {

	$default = 'rgb(0,0,0)';

	//Return default if no color provided
	if ( empty( $color ) ) {
		return $default;
	}

	//Sanitize $color if "#" is provided
	if ( $color[0] == '#' ) {
		$color = substr( $color, 1 );
	}

	//Check if color has 6 or 3 characters and get values
	if ( strlen( $color ) == 6) {
		$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	} elseif ( strlen( $color ) == 3 ) {
		$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	} else {
		return $default;
	}

	//Convert hexadec to rgb
	$rgb =  array_map( 'hexdec', $hex );

	//Check if opacity is set(rgba or rgb)
	if ( $opacity ) {
		if ( abs( $opacity ) > 1 ) {
			$opacity = 1.0;
		}
		$output = 'rgba(' . implode( ",", $rgb ) . ',' . $opacity . ')';
	} else {
		$output = 'rgb(' . implode( ",",$rgb ) . ')';
	}

	// Return rgb(a) color string
	return $output;
}

/**
 * Do shortcode function instead calling do_shortcode
 *
 */
function collecto_do_shortcode_function( $tag, array $atts = array(), $content = null ) {

	 global $shortcode_tags;

	 if ( ! isset( $shortcode_tags[ $tag ] ) )
			 return false;

	 return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
}
