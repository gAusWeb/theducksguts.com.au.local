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

	<header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h5 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' );
		endif;
		?>

		<?php
			collecto_archive_meta();
		?>

	</header><!-- .entry-header -->

	<?php collecto_hero_featured_image(); ?>

</article><!-- #post-## -->
