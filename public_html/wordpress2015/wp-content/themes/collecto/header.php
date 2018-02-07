<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package collecto
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<!--[if IE]><html class="ie"><![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'collecto' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">

			<?php if (has_custom_logo()) {
				the_custom_logo();
				?>
			<div class="site-information">
				<?php
			};
				if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
				endif;

				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
				<?php
				endif; ?>
			<?php if (has_custom_logo()) { ?>
			</div>
			<?php }; ?>
		</div><!-- .site-branding -->
	</header><!-- #masthead -->


	<div class="primary-side theme-side">
		<?php if ( is_active_sidebar('sidebar-1') ) : ?>
			<div class="sidebar-button">
				<button class="sidebar-toggle">
					<span class="screen-reader-text"><?php esc_html_e( 'toggle open/close sidebar', 'collecto' ); ?></span>
					<i class="icon-sidebar"></i>
					<i class="icon-close"></i>
				</button>
			</div>
			<div class="sidebar-hide-scroll">
				<?php get_sidebar(); ?>
			</div>
		<?php endif; ?>

		<div class="main-navigation-center clear">
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
					<p class="open-menu"><?php esc_html_e( 'Menu', 'collecto' ); ?></p>
					<p class="close-menu"><i class="icon-close"></i><?php esc_html_e( 'Close', 'collecto' ); ?></p>
				</button>
				<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
			</nav><!-- #site-navigation -->
		</div>
	</div>

	<aside class="secondary-side theme-side">
		<!-- Search form -->
		<div class="search-wrap">
			<?php
			printf( '<div class="search-instructions">%1$s</div>',
				esc_html__( 'Enter Keyword and Press Return to Search', 'collecto' )
			);

			get_search_form();
			?>
		</div>
		<div class="search-button">
			<button class="big-search-trigger">
					<span class="screen-reader-text"><?php esc_html_e( 'open search form', 'collecto' ); ?></span>
				<i class="icon-search"></i>
			</button>
			<button class="big-search-close">
				<span class="screen-reader-text"><?php esc_html_e( 'close search form', 'collecto' ); ?></span>
				<i class="icon-close"></i>
			</button>
		</div>
	</aside>


	<div id="content" class="site-content">
