<?php
/**
 * collecto functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package collecto
 */

if ( ! function_exists( 'collecto_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function collecto_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on collecto, use a find and replace
	 * to change 'collecto' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'collecto', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	add_theme_support( 'custom-header', array(
		'wp-head-callback' => 'collecto_header_style',
	) );

	/**
	 * Add excerpt functionality to pages
	 */
	add_post_type_support( 'page', 'excerpt' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * Define image sizes
	 */
	add_image_size( 'collecto-single-post', 1000 );
	add_image_size( 'collecto-archive-sticky', 900 );
	add_image_size( 'collecto-archive', 450 );
	add_image_size( 'collecto-portfolio-archive', 350 );

	/**
	 * Increase image quality compression
	 */
	add_filter( 'jpeg_quality', function() {
		return 100;
	} );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'collecto' ),
		'menu-2' => esc_html__( 'Footer menu', 'collecto' )
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'video',
		'gallery',
		'quote',
		'link'
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 400,
		'height'      => 150,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'collecto_setup' );

// add css for hideing header text
function collecto_header_style() {
	/*
	 * If header text is set to display, let's bail.
	 */
	if ( display_header_text() ) {
		return;
	}
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	</style>
	<?php
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function collecto_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'collecto_content_width', 720 );
}
add_action( 'after_setup_theme', 'collecto_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function collecto_widgets_init() {

	// Define sidebars
	$sidebars = array(
		'sidebar-1' => esc_html__( 'Sidebar', 'collecto' ),
		'sidebar-2' => esc_html__( 'Footer Widgets 1', 'collecto' ),
		'sidebar-3' => esc_html__( 'Footer Widgets 2', 'collecto' )
	);

	// Loop through each sidebar and register
	foreach ( $sidebars as $sidebar_id => $sidebar_name ) {
		register_sidebar( array(
			'name'          => esc_html($sidebar_name),
			'id'            => esc_html($sidebar_id),
			'description'   => sprintf( esc_html__( 'Widget area for %s', 'collecto' ), $sidebar_name ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}
}
add_action( 'widgets_init', 'collecto_widgets_init' );

/**
 * Remove jetpack related posts from its place
 * it is placed inside single.php via d-_shortcode
 *
 * @link https://jetpack.com/support/related-posts/customize-related-posts/#delete
 */
function jetpackme_remove_rp() {
    if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
        $jprp = Jetpack_RelatedPosts::init();
        $callback = array( $jprp, 'filter_add_target_to_dom' );
        remove_filter( 'the_content', $callback, 40 );
    }
}
add_filter( 'wp', 'jetpackme_remove_rp', 20 );

/**
 * Enable related posts for jetpack portfolio posts
 *
 * @link https://jetpack.com/support/related-posts/customize-related-posts/#related-posts-custom-post-types
 */
function collecto_allow_my_post_types($allowed_post_types) {
    $allowed_post_types[] = 'jetpack-portfolio';
    return $allowed_post_types;
}
add_filter( 'rest_api_allowed_post_types', 'collecto_allow_my_post_types' );

/**
 * Enqueue scripts and styles.
 */
function collecto_scripts() {

	// theme default Google Fonts
	wp_enqueue_style( 'collecto-google-font-enqueue', collecto_google_font_url(), array(), null );
	wp_enqueue_style( 'collecto-local-font-enqueue', collecto_local_font_url(), array(), null );

	// Style
	wp_enqueue_style( 'collecto-style', get_stylesheet_uri() );

	// Change Fonts Style

	$change_fonts_style = wp_strip_all_tags( collecto_change_fonts() );
	wp_add_inline_style( 'collecto-style', $change_fonts_style );

	// Change Colors Style

	$change_colors_style = wp_strip_all_tags( collecto_change_colors() );
	wp_add_inline_style( 'collecto-style', $change_colors_style );

	// Scripts

	wp_enqueue_script( 'collecto-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'collecto-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/slick.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	// Main JS file
	wp_enqueue_script( 'collecto-call-scripts', get_template_directory_uri() . '/js/common.js', array( 'jquery', 'masonry', 'thickbox' ), false, true );

	// Change google fonts

	// Get all customizer font settings
	$headings_font_family   = get_theme_mod( 'headings_font_family', 'default' );
	$primary_font_family  = get_theme_mod( 'primary_font_family', 'default' );
	$secondary_font_family = get_theme_mod( 'secondary_font_family', 'default' );

	if ( 'default' != $headings_font_family ) {
		wp_enqueue_style( 'collecto-headings-font', collecto_generate_headings_google_font_url(), array(), '1.0.0' );
	}
	if ( 'default' != $primary_font_family ) {
		wp_enqueue_style( 'collecto-primary-font', collecto_generate_primary_google_font_url(), array(), '1.0.0' );
	}
	if ( 'default' != $secondary_font_family ) {
		wp_enqueue_style( 'collecto-secondary-font', collecto_generate_secondary_google_font_url(), array(), '1.0.0' );
	}

}
add_action( 'wp_enqueue_scripts', 'collecto_scripts' );


/**
 * Enqueue admin scripts
 */
function collecto_add_admin_scripts() {
	// Admin styles
	wp_enqueue_style( 'collecto-admin-css', get_template_directory_uri() . '/inc/admin/admin.css' );
	wp_enqueue_style( 'wp-color-picker' );

	// Admin scripts
	wp_enqueue_media();
	wp_enqueue_script( 'my-upload' );
	wp_enqueue_script( 'jquery-ui' );
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_script( 'collecto-admin-js', get_template_directory_uri() . '/inc/admin/admin.js' );

	// Customizer settings
	wp_enqueue_script( 'collecto-admin-scripts', get_template_directory_uri() . '/inc/customizer/js/customizer-settings.js', array(), false, false );

	$js_vars = array(
		'url'                     => get_template_directory_uri(),
		'admin_url'               => admin_url( 'admin-ajax.php' ),
		'nonce'                   => wp_create_nonce( 'ajax-nonce' ),
		'default_text'            => esc_html__( 'Theme default', 'collecto' ),
		'headings_font_variant'   => get_theme_mod( 'headings_font_weight', 'default' ),
		'primary_font_variant'    => get_theme_mod( 'primary_font_weight', 'default' ),
		'secondary_font_variant'  => get_theme_mod( 'secondary_font_weight', 'default' )
	);
	wp_localize_script( 'collecto-admin-scripts', 'js_vars', $js_vars );
}
add_action( 'admin_enqueue_scripts', 'collecto_add_admin_scripts' );


/**
 * Generate theme default Font URLs
 */

function collecto_google_font_url() {
	$google_fonts_url = '';

	/* Translators: If there are characters in your language that are not
	* supported by Playfair Display, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$playfair_display = esc_html_x( 'on', 'Playfair Display font: on or off', 'collecto' );

	if ( 'off' === $playfair_display ) {

		return;

	} else {

		$font_families = array();

		$font_families[] = 'Playfair+Display:400,400i,700,700i';

		$query_args = array(
			'family' => implode( '|', $font_families ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$google_fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );


		return $google_fonts_url;

	}
}

function collecto_local_font_url() {

	/* Translators: If there are characters in your language that are not
	* supported by HK Grotesk, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$hk_grotesk     = esc_html_x( 'on', 'HK Grotesk font: on or off', 'collecto' );

	if ( 'off' === $hk_grotesk ) {

		return;

	} else {

		return get_stylesheet_directory_uri() . '/assets/fonts/hk-grotesk/stylesheet.css';

	}
}

/**
 * Generate headings google font url
 */
function collecto_generate_headings_google_font_url() {
	$headings_font_family   = get_theme_mod( 'headings_font_family', 'default' );
	$fonts_url = '';
	$headings_font_weight = get_theme_mod( 'headings_font_weight', 'normal' );

	if ( 'regular' == $headings_font_weight ) {
		$headings_font_weight = '';
	}

	$fonts_url = esc_url('https://fonts.googleapis.com/css?family='.str_replace( ' ', '+', $headings_font_family ).':'. $headings_font_weight.'');
	return $fonts_url;
}

/**
 * Generate paragraph google font url
 */
function collecto_generate_primary_google_font_url() {
	$primary_font_family  = get_theme_mod( 'primary_font_family', 'default' );
	$fonts_url = '';
	$primary_font_weight = get_theme_mod( 'primary_font_weight', 'normal' );

	if ( 'regular' == $primary_font_weight ) {
		$primary_font_weight = '';
	}

	$fonts_url = esc_url('https://fonts.googleapis.com/css?family='.str_replace( ' ', '+', $primary_font_family ).':'. $primary_font_weight.'');
	return $fonts_url;
}

/**
 * Generate navigation google font url
 */
function collecto_generate_secondary_google_font_url() {
	$secondary_font_family = get_theme_mod( 'secondary_font_family', 'default' );
	$fonts_url = '';
	$secondary_font_weight = get_theme_mod( 'secondary_font_weight', 'normal' );

	if ( 'regular' == $secondary_font_weight ) {
		$secondary_font_weight = '';
	}

	$fonts_url = esc_url('https://fonts.googleapis.com/css?family='.str_replace( ' ', '+', $secondary_font_family ).':'. $secondary_font_weight.'');
	return $fonts_url;
}

/**
 * One click demo import settings
 */
function collecto_import_files() {
  return array(
    array(
      'import_file_name'           => 'collecto Demo',
      'import_file_url'            => get_template_directory_uri().'/import/content.xml',
      'import_widget_file_url'     => get_template_directory_uri().'/import/widgets.json',
      'import_customizer_file_url' => get_template_directory_uri().'/import/customizer.dat',
      'import_preview_image_url'   => get_template_directory_uri().'/import/screenshot.png',
      'import_notice'              => __( 'You can speed up development of your site by importing our sample site content like posts and images. The imported images are copyrighted and are for demo use only. Please replace them with your own images after importing.', 'collecto' ),
    ),
  );
}
add_filter( 'pt-ocdi/import_files', 'collecto_import_files' );

require get_template_directory() . '/inc/change-colors.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Plugin activation script
 */
require get_template_directory() . '/inc/plugin-activation.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
