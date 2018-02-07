<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package collecto
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php collecto_featured_media(); ?>

	<header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h5 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' );
		endif;

		if ( ! 'link' == get_post_format() && ! 'quote' == get_post_format() ) :
			collecto_archive_meta();
		endif;
		?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		if ( 'link' == get_post_format() || 'quote' == get_post_format() ) :
			the_content();
		else :
			the_excerpt();
		endif;
		?>
	</div><!-- .entry-content -->
	<?php
		if ( 'link' == get_post_format() ) {
			?>
				<p class="post-format-type"><a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark"> <?php echo esc_html__('Link', 'collecto'); ?> </a></p>
			<?php
			collecto_archive_meta();
		} else if ('quote' == get_post_format() ) {
			?>
				<p class="post-format-type"><a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark"> <?php echo esc_html__('Quote', 'collecto'); ?> </a></p>
			<?php
			collecto_archive_meta();
		};

	?>
</article><!-- #post-## -->
