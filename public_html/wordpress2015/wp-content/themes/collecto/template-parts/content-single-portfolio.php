<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package collecto
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'container container-medium'); ?>>


	<header class="entry-header">
		<?php collecto_archive_meta() ?>

		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h5 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' );
		endif;
		?>

		<div class="entry-meta">
			<?php collecto_posted_on() ?>
		</div>
	</header><!-- .entry-header -->

	<?php collecto_featured_media(); ?>

	<div class="entry-content container container-xs">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'collecto' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'collecto' ),
				'after'  => '</div>',
			) );
		?>
		<div class="entry-footer">

			<?php collecto_entry_footer(); ?>

			<div class="entry-footer-small">
				<?php collecto_single_meta(); ?>
			</div>

		</div>
	</div><!-- .entry-content -->

	<div class="navigation-wrapper container container-xs">
		<?php collecto_post_navigation(); ?>
	</div>

