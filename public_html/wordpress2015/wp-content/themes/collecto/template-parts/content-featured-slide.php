<?php
/**
 * Template part for displaying featured posts in featured posts slider
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package collecto
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php collecto_hero_featured_image(); ?>

	<div class="entry-text">
		<header class="entry-header">
			<?php
			collecto_archive_meta();


			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h5 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' );
			endif;
			?>

		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				the_excerpt();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'collecto' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->
