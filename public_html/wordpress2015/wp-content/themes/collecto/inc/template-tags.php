<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package collecto
 */

if ( ! function_exists( 'collecto_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function collecto_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'collecto' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'collecto' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'collecto_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function collecto_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', '' ) );
		if ( $categories_list && collecto_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'collecto' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}
	}

		if ( 'jetpack-portfolio' == get_post_type() ) {
			$tags_list = get_the_term_list( get_the_ID(), 'jetpack-portfolio-tag', '', ', ', '');
		} else {
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'collecto' ) );
		}
		if ( $tags_list ) {
			printf( '<span class="tags-links"><span>%1$s</span>%2$s</span>', esc_html__( 'Tags: ', 'collecto' ), $tags_list ); // WPCS: XSS OK.
		}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'collecto' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'collecto' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

if ( ! function_exists( 'collecto_single_meta' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function collecto_single_meta() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	if ( 'jetpack-portfolio' == get_post_type() ) {
		$categories_list = get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '', ', ', '' );
	} else {
		$categories_list = get_the_category_list( ', ' );
	}

	$time_categories = sprintf( '<p class="entry-date">%s</p><p><span class="entry-date">%s</span><span class="cat-links">%s%s</span></p>', esc_html__( 'Posted on', 'collecto' ) , '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>', esc_html__( ' in ', 'collecto' ), $categories_list
	);

	$byline = sprintf( '<p>%s</p><p>%s</p>', esc_html__( 'Author', 'collecto' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<div class="posted-on">' . $time_categories . '</div><div class="byline"> ' . $byline . '</div>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'collecto_archive_meta' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function collecto_archive_meta() {
	echo '<div class="archive-meta">';

	if ( 'jetpack-portfolio' == get_post_type() ) {
		$categories_list = get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '', ', ', '' );
	} else {
		$categories_list = get_the_category_list( ', ' );
	}

	if ( $categories_list && collecto_categorized_blog() ) {
		printf( '<span class="cat-links">' . $categories_list . '</span>' ); // WPCS: XSS OK.
	}

	$byline = sprintf(
		esc_html_x( 'Posted by %s', 'post author', 'collecto' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline"> ' . $byline . '</span></div>'; // WPCS: XSS OK.


}
endif;

/**
 * Footer Menu
 *
 * @since collecto 1.0
 */
function collecto_footer_menu() {
	if ( has_nav_menu( 'menu-2' ) ) :

		$args = array(
			'theme_location'  => 'menu-2',
			'container_class' => 'footer-navigation'
		);

		wp_nav_menu( $args );

	endif;
}


/**
 * Custom post navigation
 *
 * @since collecto 1.0
 */
function collecto_post_navigation() {
	$post_navigation      = '';
	$prev_post_navigation = '';
	$next_post_navigation = '';
	$previous_post        = get_previous_post();
	$next_post            = get_next_post();

	// Previous post
	if ( !empty( $previous_post ) ) {

		$prev_text 		= esc_html__( 'Previous', 'collecto' );
		$prev_post_text = '<a href="' . esc_url( get_permalink( $previous_post->ID ) ) . '"><span class="prev-trig"><i class="icon-left"></i>' . $prev_text . '</span>';

		$prev_post_navigation = '<div class="nav-previous">';
		$prev_post_navigation .= $prev_post_text;
		$prev_post_navigation .= '<div class="prev-title">';
			$prev_post_navigation .= '<span class="post-title">' . esc_html( $previous_post->post_title ) . '</span>';
		$prev_post_navigation .= '</div></div></a>';
	}

	// Next post
	if ( !empty( $next_post ) ) {

		$next_text 		= esc_html__( 'Next', 'collecto' );
		$next_post_text = '<a href="' . esc_url( get_permalink( $next_post->ID ) ) . '"><span class="next-trig">' . $next_text . '<i class="icon-right"></i></span>';

		$next_post_navigation = '<div class="nav-next">';
		$next_post_navigation .= $next_post_text;
		$next_post_navigation .= '<div class="next-title">';
			$next_post_navigation .= '<span class="post-title">' . esc_html( $next_post->post_title ) . '</span>';
		$next_post_navigation .= '</div></div></a>';
	}

	// Post navigation
	$post_navigation = $prev_post_navigation . $next_post_navigation;

	echo _navigation_markup( $post_navigation );
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function collecto_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'collecto_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'collecto_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so collecto_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so collecto_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in collecto_categorized_blog.
 */
function collecto_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'collecto_categories' );
}
add_action( 'edit_category', 'collecto_category_transient_flusher' );
add_action( 'save_post',     'collecto_category_transient_flusher' );


/**
 * Generate and display Footer widgets
 *
 * @since collecto 1.0
 */
function collecto_footer_widgets() {

	$footer_sidebars = array(
		'sidebar-2',
		'sidebar-3'
	);

	foreach ( $footer_sidebars as $footer_sidebar ) {

		if ( is_active_sidebar( $footer_sidebar ) ) { ?>

			<div class="col-xs-12 col-sm-6 col-md-5 col-lg-4 widget-area">
				<?php dynamic_sidebar( $footer_sidebar ); ?>
			</div>

		<?php

		}

	}

}

/**
 * Displays post featured image
 *
 * @since  collecto 1.0
 */
function collecto_featured_image() {

	if ( has_post_thumbnail() ) :

		if ( is_single() ) { ?>

			<div class="featured-content featured-image">
				<?php the_post_thumbnail( 'collecto-single-post' ); ?>
			</div>

		<?php } else { ?>

			<div class="featured-content featured-image">

				<?php

					if (is_post_type_archive('jetpack-portfolio') || is_tax('jetpack-portfolio-type') || is_tax('jetpack-portfolio-tag')) {
						$thumb_size = 'collecto-portfolio-archive';
					} else if (is_sticky()) {
						$thumb_size = 'collecto-archive-sticky';
					} else {
						$thumb_size = 'collecto-archive';
					}
				?>

				<?php if ( 'image' == get_post_format() ) {

					$thumb_id        = get_post_thumbnail_id();
					$thumb_url_array = wp_get_attachment_image_src( $thumb_id, 'full', true );
					$thumb_url       = $thumb_url_array[0];

				?>
					<a href="<?php echo esc_url( $thumb_url ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" class="thickbox">
						<?php the_post_thumbnail($thumb_size); ?>
					</a>

				<?php } else { ?>

					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($thumb_size); ?></a>

				<?php } ?>

			</div>

		<?php }

	else :

		return;

	endif;
}

/**
 * Displays post featured image for hero positioned: slider or last post
 *
 * @since  collecto 1.0
 */
function collecto_hero_featured_image() {

	if ( has_post_thumbnail() ) :

		?>

		<div class="featured-content featured-image">

			<?php if ( 'image' == get_post_format() ) {

				$thumb_id        = get_post_thumbnail_id();
				$thumb_url_array = wp_get_attachment_image_src( $thumb_id, 'full', true );
				$thumb_url       = $thumb_url_array[0];

			?>
				<a href="<?php echo esc_url( $thumb_url ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" class="thickbox">
					<?php the_post_thumbnail(); ?>
				</a>

			<?php } else { ?>

				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>

			<?php } ?>

		</div>

		<?php

	else :

		return;

	endif;

}

/**
 * Displays post featured image
 *
 * @since  collecto 1.0
 */
function collecto_featured_media() {

	if ( 'gallery' == get_post_format() ) :

		if ( get_post_gallery() && ! post_password_required() ) { ?>

			<div class="featured-content entry-gallery">
				<?php echo get_post_gallery(); ?>
			</div><!-- .entry-gallery -->

		<?php } else {

			collecto_featured_image();

		}

	elseif ( 'video' == get_post_format() ) :

		if ( collecto_get_embeded_media() ) { ?>

			<div class="featured-content entry-video">
				<div class="video-sizer">
					<?php echo collecto_get_embeded_media(); ?>
				</div>
			</div><!-- .entry-video -->

		<?php } else {

			collecto_featured_image();

		}

	else :

		collecto_featured_image();

	endif;

}

/**
 * Display the archive title based on the queried object.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function collecto_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( get_the_author() );
	} elseif ( is_year() ) {
		$title = sprintf( get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'collecto' ) )  );
	} elseif ( is_month() ) {
		$title = sprintf( get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'collecto' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'collecto' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = esc_html_x( 'Asides', 'post format archive title', 'collecto' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = esc_html_x( 'Galleries', 'post format archive title', 'collecto' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = esc_html_x( 'Images', 'post format archive title', 'collecto' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = esc_html_x( 'Videos', 'post format archive title', 'collecto' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = esc_html_x( 'Quotes', 'post format archive title', 'collecto' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = esc_html_x( 'Links', 'post format archive title', 'collecto' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = esc_html_x( 'Statuses', 'post format archive title', 'collecto' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = esc_html_x( 'Audio', 'post format archive title', 'collecto' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = esc_html_x( 'Chats', 'post format archive title', 'collecto' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( esc_html__( '%s', 'collecto' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( esc_html__( '%1$s: %2$s', 'collecto' ), $tax->labels->singular_name, '<span>' . single_term_title( '', false ) . '</span>' );
	} else {
		$title = esc_html__( 'Archives', 'collecto' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;  // WPCS: XSS OK.
	}
}




/**
 * Dispalys Author Box under single post content
 *
 * @since  collecto 1.0
 */
function collecto_author_box() {

	$author_box = get_theme_mod( 'author_box_setting', 1 );

	if ( $author_box ) :

		?>
			<section class="author-box">
				<div class="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), $size = '150' ); ?>
				</div>
				<div class="author-info">
					<?php printf( '<p>%1$s</p>', esc_html( get_the_author_meta( 'description' ) ) ); ?>
				</div>
			</section>

		<?php

	endif;

}

/**
 * collecto custom paging function
 *
 * Creates and displays custom page numbering pagination in bottom of archives
 *
 * @since collecto 1.0
 */
function collecto_numbers_pagination() {

	global $wp_query, $wp_rewrite, $project_query;

	$paging_query = $wp_query;

	/** Stop execution if there's only 1 page */
	if( $paging_query->max_num_pages <= 1 )
		return;


	$paging_query->query_vars['paged'] > 1 ? $current = $paging_query->query_vars['paged'] : $current = 1;

	if ( is_page_template( 'templates/gallery-page.php' ) ) {
		$paging_query = $project_query;
		$paging_query->query['paged'] > 1 ? $current = $paging_query->query['paged'] : $current = 1;
	}

	$pagination = array(
		'base'      => @add_query_arg( 'paged', '%#%' ),
		'format'    => '',
		'total'     => $paging_query->max_num_pages,
		'current'   => $current,
		'end_size'           => 1,
		'mid_size'           => 4,
		'type'      => 'list',
		'before_page_number' => '0',
		'after_page_number'  => '<span class="navigation-line"></span>',
		'prev_next' => false
	);

	if ( $wp_rewrite->using_permalinks() )
		$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

	if ( ! empty( $paging_query->query_vars['s'] ) ) {
		$pagination['add_args'] = array( 's' => get_query_var( 's' ) );
	}

	// Display pagination
	printf( '<nav class="navigation paging-navigation"><h4 class="screen-reader-text">%1$s</h4>%2$s</nav>',
		esc_html__( 'Page navigation', 'collecto' ),
		paginate_links( $pagination )
	);

}


// Change Fonts

function collecto_change_fonts() {

	// Get all customizer font settings
	$headings_font_family   = get_theme_mod( 'headings_font_family', 'default' );
	$primary_font_family  = get_theme_mod( 'primary_font_family', 'default' );
	$secondary_font_family = get_theme_mod( 'secondary_font_family', 'default' );

	$change_fonts_style = '';

	// Headings
	if ( 'default' != $headings_font_family ) {

		$headings_font_weight = get_theme_mod( 'headings_font_weight', 'normal' );
		$headings_font_italic = false;

		if ( strpos( $headings_font_weight, 'italic' ) !== false ) {
			$headings_font_italic = true;
			$headings_font_weight = str_replace( 'italic', '', $headings_font_weight );
		}

		if ( 'regular' == $headings_font_weight ) {
			$headings_font_weight = '';
		}

		if ( $headings_font_italic ) {
			$headings_font_italic_css = 'font-style: italic;';
		} else {
			$headings_font_italic_css = 'font-style: normal;';
		}

		$change_fonts_style .= '

			h1, h1>a, h2, h2>a, h3, h3>a, h4, h4>a, h5, h5>a, h6, h6>a,
			.site-title {
					font-family: '. esc_html( $headings_font_family ) .', "Times New Roman", Times, serif;
					font-weight: '. esc_html( $headings_font_weight == '' ? 'normal' : $headings_font_weight ).';
					'. $headings_font_italic_css .'
			}

		';

	}

	// Primary
	if ( 'default' != $primary_font_family ) {

		$primary_font_weight = get_theme_mod( 'primary_font_weight', 'normal' );
		$primary_font_italic = false;

		if ( strpos( $primary_font_weight, 'italic' ) !== false ) {
			$primary_font_italic = true;
			$primary_font_weight = str_replace( 'italic', '', $primary_font_weight );
		}

		if ( 'regular' == $primary_font_weight ) {
			$primary_font_weight = '';
		}

		if ( $primary_font_italic ) {
			$primary_font_italic_css = 'font-style: italic;';
		} else {
			$primary_font_italic_css = 'font-style: normal;';
		}

		$change_fonts_style .= '

			body,
			.pingback .url, cite, .hamburger-menu .main-navigation .menu,
			.masonry .format-quote blockquote,
			body .milestone-countdown .difference {
				font-family: '.esc_html( $primary_font_family ).', "Times New Roman", Times, serif;
				font-weight: '.esc_html( $primary_font_weight == '' ? 'normal' : $primary_font_weight ).';
				'. $primary_font_italic_css .'
			}

		';
	}

	// Secondary
	if ( 'default' != $secondary_font_family ) {

		$secondary_font_weight = get_theme_mod( 'secondary_font_weight', 'normal' );
		$secondary_font_italic = false;

		if ( strpos( $secondary_font_weight, 'italic' ) !== false ) {
			$secondary_font_italic = true;
			$secondary_font_weight = str_replace( 'italic', '', $secondary_font_weight );
		}

		if ( 'regular' == $secondary_font_weight ) {
			$secondary_font_weight = '';
		}

		if ( $secondary_font_italic ) {
			$secondary_font_italic_css = 'font-style: italic;';
		} else {
			$secondary_font_italic_css = 'font-style: normal;';
		}

		$change_fonts_style .= '

			blockquote, q,
			.dropcap,
			.main-navigation, .archive-meta, .wp-caption .wp-caption-text, .entry-meta,
			.widget_rss .rss-date, body .milestone-header,
			body:not(.search) .masonry article.jetpack-portfolio .entry-title a,
			.single-jetpack-portfolio .entry-footer-small,
			div.sharedaddy h3.sd-title,
			body .sd-social-icon .sd-content ul li a.sd-button,
			body .sd-social-text .sd-content ul li a.sd-button,
			body .sd-content ul li a.sd-button,
			body .sd-content ul li .option a.share-ustom,
			body .sd-content ul li.preview-item div.option.option-smart-off a,
			body .sd-content ul li.advanced a.share-more,
			body .sd-social-icon-text .sd-content ul li a.sd-button,
			body .sd-social-official .sd-content>ul>li>a.sd-button,
			body #sharing_email .sharing_send,
			body .sd-social-official .sd-content>ul>li .digg_button >a,
			.footer-bottom-line,
			.comments-title span,
			.archive .page-header span,
			.comment-list .reply,
			.comment-list .comment-metadata,
			.pingback,
			body #jp-relatedposts .jp-relatedposts-items .jp-relatedposts-post .jp-relatedposts-post-context,
			body #jp-relatedposts .jp-relatedposts-items .jp-relatedposts-post .jp-relatedposts-post-date,
			body .contact-form label span,
			.read-more-link,
			.comments-area .comment-author,
			.hero-slider-wrapper .slick-dots button,
			.paging-navigation a:not(.next):not(.prev),
			.paging-navigation span.current,
			.page-links,
			.post-format-type {
				font-family: '.esc_html( $secondary_font_family ).', Verdana, Geneva, sans-serif;
			}

			body:not(.hamburger-menu) .main-navigation-center .nav-menu > li > a,
			body:not(.hamburger-menu) .main-navigation-center .menu > li > a,
			.entry-content a {
				font-weight: '.esc_html( $secondary_font_weight == '' ? 'normal' : $secondary_font_weight ).';
				'. $secondary_font_italic_css .'
			}

		';

	}

	if ( 'default' != $headings_font_family || 'default' != $primary_font_family || 'default' != $secondary_font_family ) {

		return $change_fonts_style;

	}

}

