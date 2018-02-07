<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package collecto
 */

get_header(); ?>

	<?php if ( is_home() && !is_paged() ) : ?>
		<!-- Featured posts slider -->
		<div class="hero-slider-sizer">
			<div class="hero-slider-clip">
				<div class="hero-slider-wrapper container container-wrapper <?php if ( collecto_has_featured_posts() ) : echo 'center-vertically'; endif; ?>">
						<div class="hero-slider-center <?php if ( !collecto_has_featured_posts() ) : echo 'center-vertically'; endif; ?>">

							<?php if ( collecto_has_featured_posts() ) { ?>
								<div class="featured-slider">

									<?php
										// Load featured images
										$featured_posts = collecto_get_featured_posts();

										foreach ( (array) $featured_posts as $post ) : setup_postdata( $post );
											// Include the featured content template.
											get_template_part( 'template-parts/content', 'featured-slide' );
										endforeach;

										wp_reset_postdata();

									?>
								</div>
								<?php
							} else {
								?>
								<div class="last-post">
								<?php
									$args = array(
										'numberposts' => 1,
										'post_status' => 'publish'
									);

									$last_post = wp_get_recent_posts( $args, OBJECT );

									foreach ( (array) $last_post as $post ) : setup_postdata( $post );
										// Include the featured content template.
										get_template_part( 'template-parts/content', 'hero-slide' );
									endforeach;
								?>

								</div>

								<?php
							} ?>
						</div>
				</div>
				<span class="black-bg container container-wrapper"></span>
			</div>
		</div>

	<?php endif; ?>

	<div id="primary" class="content-area container container-wrapper">
		<main id="main" class="site-main" role="main">
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
				if ( have_posts() ) :

					if ( is_home() && ! is_front_page() ) : ?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>

					<?php
					endif;

					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );

					endwhile;

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>

				</div><!-- .row -->
			</div><!-- .container -->
			<?php collecto_numbers_pagination(); ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
