<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package collecto
 */

get_header(); ?>

	<div id="primary" class="content-area container container-wrapper">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&#8217;t be found.', 'collecto' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content entry-content container container-xs">
					<p>
						<?php esc_html_e( 'There&#8217;s nothing to be found here.', 'collecto' ); ?>
						<a href="<?php echo get_home_url(); ?>"><?php esc_html_e( 'Go back home', 'collecto' ); ?></a>
						<?php esc_html_e( ' and try your luck there.', 'collecto' ); ?>
					</p>


				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
