<?php
/**
 * Template for displaying search forms in collecto
 *
 * taken from Twenty Sixteen theme
 *
 * @package WordPress
 * @subpackage collecto
 * @since Twenty Sixteen 1.0
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'collecto' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'collecto' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<input type="submit" class="search-submit" value="<?php echo _x( 'Search', 'submit button', 'collecto' ); ?>"/>
</form>
