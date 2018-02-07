<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package collecto
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer container-wrapper container" role="contentinfo">
		<?php

		if ( is_active_sidebar( 'sidebar-2' ) or is_active_sidebar( 'sidebar-3' ) ) { ?>

			<div class="footer-widget-holder container container-medium">
				<div class="row">
					<?php collecto_footer_widgets(); ?>
					<div class="footer-branding col-xs-12 col-sm-12 col-md-2">
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					</div>
				</div>
			</div>

		<?php

		} ?>

		<div class="footer-bottom-line container container-medium">
			<div class="site-info">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'collecto' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'collecto' ), 'WordPress' ); ?></a>
				<span class="sep"> | </span>
				<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'collecto' ), 'collecto', '<a href="https://themeskingdom.com" rel="designer">Themes Kingdom</a>' ); ?>
			</div><!-- .site-info -->

			<?php collecto_footer_menu() ?>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->
<span class="black-overlay"></span>
<?php wp_footer(); ?>

</body>
</html>
