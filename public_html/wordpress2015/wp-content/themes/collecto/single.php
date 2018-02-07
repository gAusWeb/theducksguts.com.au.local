<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package collecto
 */

get_header(); ?>

	<div id="primary" class="content-area container container-wrapper">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'single' );

			?>
			</article><!-- #post-## -->
			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) { ?>
				<?php comments_template();
			};

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->

		<?php
			if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
				echo '<div class="related-holder container container-medium">';
			    echo collecto_do_shortcode_function('jetpack-related-posts');
			    echo '</div>';
			}
		?>
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
