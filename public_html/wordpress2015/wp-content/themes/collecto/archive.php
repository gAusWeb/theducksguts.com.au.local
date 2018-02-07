<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package collecto
 */

get_header(); ?>

	<div id="primary" class="content-area container container-wrapper">
		<main id="main" class="site-main" role="main">

					<?php
					if ( have_posts() ) : ?>

						<header class="page-header">
							<?php
								collecto_archive_title( '<h1 class="page-title">', '</h1>' );
								the_archive_description( '<div class="archive-description">', '</div>' );
							?>
						</header><!-- .page-header -->
						<div class="container">
							<div id="post-load" class="row masonry">
								<div class="grid-sizer"></div>
								<div class="lines">
									<span></span>
									<span></span>
									<span></span>
									<span></span>
								</div>

									<?php
									/* Start the Loop */
									while ( have_posts() ) : the_post();

										/*
										 * Include the Post-Format-specific template for the content.
										 * If you want to override this in a child theme, then include a file
										 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
										 */
										get_template_part( 'template-parts/content', get_post_format() );

									endwhile;
									?>
							</div><!-- .row -->
						</div><!-- .container -->
						<?php collecto_numbers_pagination(); ?>
						<?php
					else :

						get_template_part( 'template-parts/content', 'none' );

					endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
