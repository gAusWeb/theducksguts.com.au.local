<?php
/**
 * Change colors regarding user choices in customizer
 *
 * @package collecto
 */


function collecto_change_colors() {

/**
 * GENERAL THEME COLORS
 */

$body_bg_color            = get_theme_mod( 'collecto_body_bg_color', '#fff' );
$main_color               = get_theme_mod( 'collecto_main_color', '#eee' );
$heading_color            = get_theme_mod( 'collecto_heading_color', '#000' );
$paragraph_color          = get_theme_mod( 'collecto_paragraph_color', '#121212' );
$meta_link_color          = get_theme_mod( 'collecto_meta_link_color', '#000' );

$change_colors_style = '

    /* Body BG color */

    body,
    .sidebar-open .primary-side,
    .primary-side.first-lvl-open,
    .sidebar-hide-scroll,
    .hero-slider-wrapper,
    .masonry article.sticky.post:before,
    .search .masonry article.sticky:before,
    .hamburger-menu .main-navigation>div,
    #TB_overlay {
        background-color:'. esc_attr( $body_bg_color ) .';
    }

    .comment-list .reply a,
    body .milestone-header {
        color:'. esc_attr( $body_bg_color ) . ';
    }

    /* Main - lines color */

    body .milestone-header,
    hr,
    .lines span {
        background-color:'. esc_attr( $main_color ) .';
    }

    .widget table {
        border-left-color:'. esc_attr( $main_color ) .';
        border-right-color:'. esc_attr( $main_color ) .';
    }

    .masonry .animate.post,
    .search .masonry .animate,
    .widget_goodreads div[class^="gr_custom_container"],
    body .milestone-header,
    body .milestone-countdown,
    body .milestone-message {
        border-color: '. esc_attr( $main_color ) .';
    }

    abbr,
    acronym,
    .widget_goodreads div[class^="gr_custom_each_container"],
    .paging-navigation,
    .entry-content thead,
    .comment-content thead,
    body .widget_authors > ul > li,
    .paging-navigation {
        border-bottom-color: '. esc_attr( $main_color ) .';
    }

    @media screen and (min-width: 1200px) {
        .single-post .entry-content,
        .single-post .comment-wrapper {
            border-left-color: '. esc_attr( $main_color ) .';
            border-right-color: '. esc_attr( $main_color ) .';
        }
    }
    @media screen and (min-width: 1201px) {
        body:not(.single-jetpack-portfolio) #jp-relatedposts {
            border-right-color: '. esc_attr( $main_color ) .';
        }
    }
    @media screen and (max-width: 900px) {
        .single-post .meta-author,
        .single-post .posts-navigation {
            border-bottom: '. esc_attr( $main_color ) .';
        }
    }
    @media screen and (max-width: 550px) {
        #secondary {
            border-top: '. esc_attr( $main_color ) .';
        }
    }

    /* Headings color */

    h1, h2, h3, h4, h5, h6,
    h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
    h1 a:visited, h2 a:visited, h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited,
    h2.widget-title,
    .entry-content h1,
    .entry-content h2,
    .entry-content h3,
    .entry-content h4,
    .entry-content h5,
    .entry-content h6,
    .nav-links,
    .masonry .format-quote blockquote,
    .masonry .format-link .entry-content a,
    .site-title,
    .site-title a,
    .site-title a:visited,
    .site-title a:hover,
    .site-title a:focus,
    body:not(.search) .masonry article.jetpack-portfolio .entry-header a:hover,
    .search .page-header span {
        color: '. esc_attr( $heading_color ) .';
    }

    /* Headings hover color */

    h1 a:hover,
    h2 a:hover,
    h3 a:hover,
    h4 a:hover,
    h5 a:hover,
    h6 a:hover,
    body:not(.search) .masonry article.jetpack-portfolio .entry-title a,
    .search .page-header .page-title {
        color:'. collecto_hex2rgba( $heading_color , 0.4 ) .';
    }

    @media screen and (min-width: 1200px) {
        .blog .masonry .featured-image:hover ~ .entry-header .entry-title a, .archive:not(.tax-jetpack-portfolio-type) .masonry .featured-image:hover ~ .entry-header .entry-title a, .search .masonry .featured-image:hover ~ .entry-header .entry-title a, .search .masonry .featured-image:hover ~ .entry-text .entry-title a, .blog .masonry .entry-title a:hover, .archive:not(.tax-jetpack-portfolio-type) .masonry .entry-title a:hover, .search .masonry .entry-title a:hover, .jp-relatedposts-post-a:hover ~ h4 a, .jp-relatedposts-post-a:hover {
            border-bottom-color: '. esc_attr( $heading_color ) .';
        }
    }

    /* Paragraph color */

    pre,
    mark, ins {
        background-color: '. collecto_hex2rgba( $paragraph_color , 0.08 ) .';
    }

    body,
    body:not(.single-jetpack-portfolio) .archive-meta,
    body #infinite-footer .blog-credits,
    div.sharedaddy div h3.sd-title,
    .paging-navigation,
    .paging-navigation a:hover, .paging-navigation a:active,
    body .milestone-countdown, body .milestone-message {
        color: '. esc_attr( $paragraph_color ) .';
    }

    .site-info,
    .single-jetpack-portfolio .tags-links {
        color:'. collecto_hex2rgba( $paragraph_color , 0.5 ) .';
    }

    .widget_text {
        color:'. collecto_hex2rgba( $paragraph_color , 0.8 ) .';
    }

    label.checkbox:before,
    input[type="checkbox"] + label:before,
    label.radio:before,
    input[type="radio"] + label:before,
    .entry-content table,
    .comment-content table,
    .entry-content td,
    .entry-content th,
    .comment-content td,
    .comment-content th,
    .entry-content tfoot,
    .comment-content tfoot,
    code, kbd, pre, samp {
        border-color: '. esc_attr( $paragraph_color ) .';
    }

    label.radio:before, input[type="radio"] + label:before,
    .checkbox.checked:before,
    input[type="checkbox"]:checked + label:before,
    .single .tags-links span {
        color: '. esc_attr( $paragraph_color ) .';
    }

    .checkbox.checked:hover:before,
    input[type="checkbox"]:hover:checked + label:before,
    .paging-navigation span .navigation-line,
    .paging-navigation a:hover .navigation-line,
    label.checkbox:hover:before,
    input[type="checkbox"] + label:hover:before,
    label.radio:hover:before,
    input[type="radio"] + label:hover:before {
        background-color: '. esc_attr( $paragraph_color ) .';
    }

    .paging-navigation a, .paging-navigation .dots,
    .paging-navigation a:visited, .paging-navigation .dots:visited {
        color: '. collecto_hex2rgba( $paragraph_color , 0.3 ) .';
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="url"]:focus,
    input[type="password"]:focus,
    input[type="search"]:focus,
    input[type="number"]:focus,
    input[type="tel"]:focus,
    input[type="range"]:focus,
    input[type="date"]:focus,
    input[type="month"]:focus,
    input[type="week"]:focus,
    input[type="time"]:focus,
    input[type="datetime"]:focus,
    input[type="datetime-local"]:focus,
    input[type="color"]:focus,
    textarea:focus,
    input[type="text"]:hover,
    input[type="email"]:hover,
    input[type="url"]:hover,
    input[type="password"]:hover,
    input[type="search"]:hover,
    input[type="number"]:hover,
    input[type="tel"]:hover,
    input[type="range"]:hover,
    input[type="date"]:hover,
    input[type="month"]:hover,
    input[type="week"]:hover,
    input[type="time"]:hover,
    input[type="datetime"]:hover,
    input[type="datetime-local"]:hover,
    input[type="color"]:hover,
    textarea:hover,
    .entry-content thead,
    .comment-content thead,
    body .widget_authors > ul > li,
    div #infinite-handle span {
        border-color: '. esc_attr( $paragraph_color ) .';
        color:  '. esc_attr( $paragraph_color ) .';
    }

    input[type="text"],
    input[type="email"],
    input[type="url"],
    input[type="password"],
    input[type="search"],
    input[type="number"],
    input[type="tel"],
    input[type="range"],
    input[type="date"],
    input[type="month"],
    input[type="week"],
    input[type="time"],
    input[type="datetime"],
    input[type="datetime-local"],
    input[type="color"],
    textarea,
    body .contact-form label {
        border-color:'. collecto_hex2rgba( $paragraph_color, 0.4 ) .';
        color: '. collecto_hex2rgba( $paragraph_color , 0.8 ) .';
    }

    button:hover,
    input[type="button"]:hover,
    input[type="reset"]:hover,
    input[type="submit"]:hover,
    div #infinite-handle span:hover {
        background: '. esc_attr( $paragraph_color ) .';
        color: '. esc_attr( $body_bg_color ) .';
    }
    input[type="button"],
    input[type="reset"],
    input[type="submit"] {
        border-color: '. esc_attr( $paragraph_color ) .';
        color:'. collecto_hex2rgba( $paragraph_color , 0.8 ) .';
    }

    /* Meta color */

    a,
    a:visited,
    body:not(.single-jetpack-portfolio) .archive-meta a,
    .main-navigation ul a:hover,
    .main-navigation ul a.focus,
    body #infinite-footer .blog-info a:hover,
    body #infinite-footer .blog-credits a:hover,
    .site-info a,
    .edit-link a:after,
    .logged-in-as, .logged-in-as a, .comment-notes,
    .comment-metadata a,
    .widget_wpcom_social_media_icons_widget a,
    .cat-links,
    .single .tags-links,
    .theme-side button:not(.dropdown-toggle):hover,
    .theme-side button:not(.dropdown-toggle):focus,
    .theme-side button:not(.dropdown-toggle):active,
    .posts-navigation a:active,
    .posts-navigation a:hover,
    .posts-navigation a:focus,
    .widget ul li a:hover,
    .entry-content a:active,
    .entry-content a:hover,
    .entry-content a:focus {
        color:'. collecto_hex2rgba( $meta_link_color, 0.7 ) .';
    }

    .widget ul li a,
    .entry-content a,
    .entry-content a:visited {
        color:'. esc_attr( $meta_link_color ) .';
    }

    button,
    a:hover, a:active, a:focus,
    body:not(.single-jetpack-portfolio) .archive-meta a:hover,
    body:not(.single-jetpack-portfolio) .archive-meta a:focus,
    a.read-more-link,
    a.read-more-link:hover,
    a.read-more-link:focus,
    .read-more-link:before,
    .hero-slider-wrapper .slick-dots button:hover,
    .hero-slider-wrapper .slick-dots button:focus,
    .hero-slider-wrapper .slick-dots button:active,
    .main-navigation-center .nav-menu,
    .main-navigation-center .menu,
    #infinite-footer .blog-info a,
    body #infinite-footer .blog-credits a,
    .site-info a:hover,
    .site-info a:focus,
    .site-info a:active,
    .single .tags-links a:hover,
    .single .tags-links a:focus,
    .single .tags-links a:active,
    .edit-link,
    .edit-link a:hover:after,
    .logged-in-as a:hover,
    .logged-in-as a:focus,
    .comment-metadata a:hover,
    .widget_wpcom_social_media_icons_widget a:focus,
    .widget_wpcom_social_media_icons_widget a:hover,
    .main-navigation ul ul a,
    .hamburger-menu .main-navigation a,
    .main-navigation-center .nav-menu > li > a,
    .main-navigation-center .menu > li > a,
    .posts-navigation a,
    .posts-navigation a:visited {
        color:'. esc_attr( $meta_link_color ) .';
    }

    body div div div.slideshow-controls a, body div div div.slideshow-controls a:hover,
    body .sd-social-icon .sd-content ul li a.sd-button, body .sd-social-text .sd-content ul li a.sd-button, body .sd-content ul li a.sd-button, body .sd-content ul li .option a.share-ustom, body .sd-content ul li.preview-item div.option.option-smart-off a, body .sd-content ul li.advanced a.share-more, body .sd-social-icon-text .sd-content ul li a.sd-button, body .sd-social-official .sd-content>ul>li>a.sd-button, body #sharing_email .sharing_send, body .sd-social-official .sd-content>ul>li .digg_button >a {
        color:'. esc_attr( $meta_link_color ) .' !important;
    }

    body .sd-social-icon .sd-content ul li a.sd-button:hover, body .sd-social-icon .sd-content ul li a.sd-button:active, body .sd-social-text .sd-content ul li a.sd-button:hover, body .sd-social-text .sd-content ul li a.sd-button:active, body .sd-social-icon-text .sd-content ul li a.sd-button:hover, body .sd-social-icon-text .sd-content ul li a.sd-button:active, body .sd-social-official .sd-content>ul>li>a.sd-button:hover, body .sd-social-official .sd-content>ul>li>a.sd-button:active, body .sd-social-official .sd-content>ul>li .digg_button>a:hover, body .sd-social-official .sd-content>ul>li .digg_button>a:active {
        color:'. collecto_hex2rgba( $meta_link_color, 0.3 ) .' !important;
    }

    .hero-slider-wrapper .slick-dots .slick-active:after,
    .dropdown-toggle .h-line,
    .dropdown-toggle .v-line,
    .comment-list .reply:hover {
        background:'. esc_attr( $meta_link_color ) .';
    }

    body:not(.hamburger-menu) .main-navigation ul a:hover + .dropdown-toggle .h-line,
    body:not(.hamburger-menu) .main-navigation ul a:hover + .dropdown-toggle .v-line,
    body:not(.hamburger-menu) .main-navigation ul a.focus + .dropdown-toggle .h-line,
    body:not(.hamburger-menu) .main-navigation ul a.focus + .dropdown-toggle .v-line,
    .comment-list .reply {
        background: '. collecto_hex2rgba( $meta_link_color, 0.3 ) .';
    }

    @media screen and (max-width: 550px) {
        .hero-slider-wrapper .slick-dots li:after {
            background: '. collecto_hex2rgba( $meta_link_color, 0.3 ) .';
        }
    }

    @media screen and (max-width: 1200px) {
        .blog .hero-slider-sizer ~ .content-area {
            border-top-color: '. esc_attr( $main_color ) .';
        }
    }

    @media screen and (min-width: 1201px) {
        body:not(.hamburger-menu) .main-navigation ul.menu:hover > li > a,
        body:not(.hamburger-menu) .main-navigation ul.nav-menu:hover > li > a {
            color: '. collecto_hex2rgba( $meta_link_color, 0.4 ) .';
        }

        body:not(.hamburger-menu) .main-navigation ul.menu:hover > li > .dropdown-toggle span, body:not(.hamburger-menu) .main-navigation ul.nav-menu:hover > li > .dropdown-toggle span {
            background: '. collecto_hex2rgba( $meta_link_color, 0.4 ) .';
        }
    }

    ::-moz-selection { /* Gecko Browsers */
        background: '. esc_attr( $paragraph_color ) .';
        color: '. esc_attr( $body_bg_color ) .';
    }
    ::selection {  /* WebKit/Blink Browsers */
        background: '. esc_attr( $paragraph_color ) .';
        color: '. esc_attr( $body_bg_color ) .';
    }

    ';

    return $change_colors_style;

}

?>
