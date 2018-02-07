<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package collecto
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 */
function collecto_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'wrapper'        => false,
		'container'      => 'post-load',
		'render'         => 'collecto_infinite_scroll_render',
		'footer_widgets' => array('sidebar-2','sidebar-3'),
		'footer'         => 'page',
		'type'           => 'scroll'
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for portfolio custom post type
	add_theme_support( 'jetpack-portfolio' );

	// Add Featured Content Support
	add_theme_support( 'featured-content', array(
		'filter'    => 'collecto_get_featured_posts',
		'max_posts' => 8,
	) );

	// Add support for Content Options.
	add_theme_support( 'jetpack-content-options', array(
		'blog-display' => 'excerpt',
		'post-details' => array(
			'stylesheet' => 'collecto-style',
			'author'     => '.byline, .author-box',
			'date'       => '.entry-date',
			'categories' => '.cat-links',
			'tags'       => '.tags-links'
		),
	) );

}

add_action( 'after_setup_theme', 'collecto_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function collecto_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) {
		    get_template_part( 'template-parts/content', 'search' );
		} elseif ( get_post_type() == 'jetpack-portfolio' ) {
			get_template_part( 'template-parts/content', 'portfolio' );
		} else {
		    get_template_part( 'template-parts/content', get_post_format() );
		}
	}
}

/**
 * Filter Jetpack's Related Post thumbnail size.
 *
 * @param  $size (array) - Current width and height of thumbnail.
 * @return $size (array) - New width and height of thumbnail.
*/
function custom_jetpack_relatedposts_filter_thumbnail_size( $size ) {
	$size = array(
		'width'  => 600,
		'height' => 9999
	);
	return $size;
}
add_filter( 'jetpack_relatedposts_filter_thumbnail_size', 'custom_jetpack_relatedposts_filter_thumbnail_size' );


/**
 * Featured posts filter function
 */
function collecto_get_featured_posts() {
    return apply_filters( 'collecto_get_featured_posts', array() );
}

/**
 * A helper conditional function that returns a boolean value.
 */
function collecto_has_featured_posts() {
	return ( bool ) collecto_get_featured_posts();
}

/**
 * Set size of widget area width for gallery widget
 */
function jetpackcom_custom_gallery_content_width(){
    return 335;
}
add_filter( 'gallery_widget_content_width', 'jetpackcom_custom_gallery_content_width' );
