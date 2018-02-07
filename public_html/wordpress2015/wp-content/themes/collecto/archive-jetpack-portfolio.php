<?php
/**
 * Displays gallery archives
 *
 * @package collecto
 */
get_header(); ?>

		<div id="primary" class="content-area container container-wrapper">
			<main id="main" class="site-main container container-medium" role="main">

				<?php collecto_archive_title( '<h1 class="page-title">', '</h1>' ); ?>

				<?php if ( have_posts() ) : ?>

						<div class="gallery-wrapper clear">

							<div class="container container-medium">
								<div class="masonry row gallery" id="post-load">

									<div class="grid-sizer"></div>

									<?php
										while ( have_posts() ) : the_post();

											get_template_part( 'template-parts/content', 'portfolio' );

										endwhile;
									?>

								</div><!-- .masonry -->

								<?php
									collecto_numbers_pagination();
									wp_reset_postdata();
								?>

							</div><!-- .container -->
						</div><!-- .wrapper -->


					<?php else : ?>

						<section class="no-results not-found">

							<header class="page-header">
								<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'collecto' ); ?></h1>
							</header>
							<div class="page-content">
								<?php if ( current_user_can( 'publish_posts' ) ) : ?>

									<p><?php printf( wp_kses( __( 'Ready to publish your first project? <a href="%1$s">Get started here</a>.', 'collecto' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php?post_type=jetpack-portfolio' ) ) ); ?></p>

								<?php else : ?>

									<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'collecto' ); ?></p>
									<?php get_search_form(); ?>
									<div class="search-instructions"><?php esc_html_e( 'Press Enter / Return to begin your search.', 'collecto' ); ?></div>

								<?php endif; ?>
							</div>

						</section>

					<?php endif; ?>

			</main>
		</div>

<?php get_footer(); ?>
