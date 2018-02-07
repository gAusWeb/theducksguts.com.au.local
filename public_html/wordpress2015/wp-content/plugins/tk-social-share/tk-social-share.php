<?php
/*
  Plugin Name: TK Social Share
  Plugin URI: http://www.themeskingdom.com
  Description: Displays Social Share Icons in content when activated. Supports: Facebook, Pinterest, Twitter, Google+, StumbleUpon, Reddit, LinkedIn
  Version: 1.1
  Author: Themes Kingdom
  Author URI: http://www.themeskingdom.com
  License: GPLv2+
  Text Domain: tkingdom
*/

// Begin plugin code

require_once( 'tk-social-counter.php' );

class TK_Social_Share extends TK_Social_Counter {

    public $sharing_icons = array(
        'facebook',
        'twitter',
        'google',
        'pinterest',
        'stumbleupon',
        'linkedin',
        'reddit',
        'mail'
    );

    // Constructor
    function __construct() {
        add_action( 'admin_menu', array( $this, 'tkss_add_menu' ) );
        add_action( 'admin_init', array( $this, 'tkss_settings' ) );
        add_action( 'add_meta_boxes', array( $this, 'tkss_add_metabox' ) );
        add_action( 'save_post', array( $this, 'tkss_save_metabox' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'tkss_load_admin_scripts' ) );
        add_action( 'init', array( $this, 'tkss_register_scripts' ) );
        add_action( 'plugins_loaded', array( $this, 'tksc_load_plugin_textdomain' ) );

        // Add Social share to bottom of content
        add_filter( 'the_content', array( $this, 'tkss_display_social_share' ) );

        // Set default optons values
        register_activation_hook( __FILE__, array( $this, 'tkss_set_defaults' ) );
    }

    public function tkss_load_admin_scripts() {
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'jquery-ui-draggable' );
        wp_enqueue_script( 'jquery-ui-droppable' );
        wp_enqueue_script( 'jquery-ui-sortable' );

        // Add TK Social Share JavaScript
        wp_enqueue_script( 'tkss-js-scripts', plugin_dir_url( __FILE__ ) . '/js/tkss-social-share.js', false, false, true );
    }

    /**
     * Load Translaton Text Domain
     */
    public function tksc_load_plugin_textdomain() {
        load_plugin_textdomain( 'tkingdom', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
    }

    /*
     * Actions perform at loading of admin menu
     */
    public function tkss_add_menu() {
        add_menu_page( 'TK Social Share', 'TK Social Share', 'manage_options', 'tk-social-share-dashboard', array( $this, 'tkss_page_settings' ), 'dashicons-share' );
    }

    /**
     * Sets up default sharing options to "on"
     */
    public function tkss_set_defaults() {
        add_option( 'tkss_page_sharing', 'on' );
        add_option( 'tkss_post_sharing', 'on' );
        add_option( 'tkss_display_bottom_sharing', 'on' );
        add_option( 'tkss_icons_sharing', 'basic' );

        add_option( 'tkss_facebook', 'on' );
        add_option( 'tkss_facebook_position', '1' );
        add_option( 'tkss_twitter', 'on' );
        add_option( 'tkss_twitter_position', '2' );
        add_option( 'tkss_google', 'on' );
        add_option( 'tkss_google_position', '3' );
        add_option( 'tkss_pinterest', 'off' );
        add_option( 'tkss_pinterest_position', '4' );
        add_option( 'tkss_stumbleupon', 'off' );
        add_option( 'tkss_stumbleupon_position', '5' );
        add_option( 'tkss_linkedin', 'off' );
        add_option( 'tkss_linkedin_position', '6' );
        add_option( 'tkss_reddit', 'off' );
        add_option( 'tkss_reddit_position', '7' );
        add_option( 'tkss_mail', 'on' );
        add_option( 'tkss_mail_position', '8' );

        $all_posts = new WP_Query( array(
            'post_type'   => array( 'post', 'page' ),
            'post_status' => 'publish'
        ) );

        if ( $all_posts->have_posts() ) :
            while ( $all_posts->have_posts() ) : $all_posts->the_post();
                update_post_meta( get_the_ID(), 'enable_global_sharing', 'on' );
            endwhile;
        endif;

    }

    /**
     * Add styles and scripts for plugin
     */
    public function tkss_register_scripts() {
        // Add Plugin Stylesheets
        wp_register_style( 'tkss-style', plugin_dir_url( __FILE__ ) . 'css/style.css' );
        wp_enqueue_style( 'tkss-style' );

        $icons_sharing = get_option( 'tkss_icons_sharing' );

        if ( 'basic' == $icons_sharing ) {
            // Colored CSS
            wp_register_style( 'tkss-cl-css', plugin_dir_url( __FILE__ ) . 'css/basic-icons.css' );
            wp_enqueue_style( 'tkss-cl-css' );
        }
        if ( 'rounded' == $icons_sharing ) {
            // Colored CSS
            wp_register_style( 'tkss-cl-css', plugin_dir_url( __FILE__ ) . 'css/rounded-icons.css' );
            wp_enqueue_style( 'tkss-cl-css' );
        }
        if ( 'colored' == $icons_sharing ) {
            // Colored CSS
            wp_register_style( 'tkss-cl-css', plugin_dir_url( __FILE__ ) . 'css/colored-icons.css' );
            wp_enqueue_style( 'tkss-cl-css' );
        }
    }

    /*
     * Actions perform on loading of menu pages
     */
    public function tkss_page_settings() { ?>

        <div class="wrap">

            <h2 class="plugin-heading">
                <span class="plugin-heading-icon dashicons dashicons-share"></span> <?php _e( 'TK Social Sharing Settings', 'tkingdom' ); ?>
            </h2>

            <?php
                $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general_settings';
            ?>

            <h2 class="nav-tab-wrapper">
                <a href="?page=tk-social-share-dashboard&amp;tab=general_settings" class="<?php if ( 'general_settings' == $active_tab ) { echo 'active'; } ?> nav-tab"><?php _e( 'General Settings', 'tkingdom' ); ?></a>
                <a href="?page=tk-social-share-dashboard&amp;tab=social_settings" class="<?php if ( 'social_settings' == $active_tab ) { echo 'active'; } ?> nav-tab"><?php _e( 'Social Settings', 'tkingdom' ) ?></a>
                <a href="?page=tk-social-share-dashboard&amp;tab=display_settings" class="<?php if ( 'display_settings' == $active_tab ) { echo 'active'; } ?> nav-tab"><?php _e( 'Display Settings', 'tkingdom' ) ?></a>
            </h2>

            <form method="post" action="options.php">

                <?php

                    add_settings_section( 'tkss_general_settings', __( 'General Settings', 'tkingdom' ), array( $this, 'tkss_general_section' ), 'tk-social-share-dashboard' );
                    add_settings_section( 'tkss_social_settings', __( 'Social Settings', 'tkingdom' ), array( $this, 'tkss_social_section' ), 'tk-social-share-settings' );
                    add_settings_section( 'tkss_display_settings', __( 'Display Settings', 'tkingdom' ), array( $this, 'tkss_display_section' ), 'tk-social-display-settings' );

                    if ( 'general_settings' == $active_tab ) {
                        settings_fields( 'tk-social-share-settings-group' );
                        do_settings_sections( 'tk-social-share-dashboard' );
                    }
                    elseif ( 'social_settings' == $active_tab ) {
                        settings_fields( 'tk-social-share-social-group' );
                        do_settings_sections( 'tk-social-share-settings' );
                    }
                    else {
                        settings_fields( 'tk-social-share-display-group' );
                        do_settings_sections( 'tk-social-display-settings' );
                    }
                ?>

                <?php submit_button( ); ?>

            </form>
        </div>

    <?php
    }

    public function tkss_general_section() { ?>

        <small><?php _e( 'Check which type of sharing you want to enable', 'tkingdom' ); ?></small>

        <hr />

        <table class="form-table">
            <tr valign="top">
                <th scope="row"><?php _e( 'Enable Page Sharing', 'tkingdom' ); ?></th>
                <?php
                    $checked = '';
                    if ( 'on' == get_option( 'tkss_page_sharing' ) ) {
                        $checked = 'checked';
                    }
                ?>
                <td class="input-checkbox"><input type="checkbox" name="tkss_page_sharing" value="on" <?php echo $checked; ?> /></td>
                <td><small><?php _e( 'Enables sharing icons on Pages', 'tkingdom' ); ?></small></td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e( 'Enable Post Sharing', 'tkingdom' ); ?></th>
                <?php
                    $checked = '';
                    if ( 'on' == get_option( 'tkss_post_sharing' ) ) {
                        $checked = 'checked';
                    }
                ?>
                <td class="input-checkbox"><input type="checkbox" name="tkss_post_sharing" value="on" <?php echo $checked; ?> /></td>
                <td><small><?php _e( 'Enables sharing icons on Posts', 'tkingdom' ); ?></small></td>
            </tr>

            <?php

                /*$registered_post_types = get_post_types();

                if ( !empty( $registered_post_types ) ) { ?>
                    <tr>
                        <th scope="row" colspan="3"><?php _e( 'Enable Sharing on post types:', 'tkingdom' ); ?></th>
                    </tr>
                    <tr>
                        <td>
                            <?php foreach ( $registered_post_types as $registered_post_type ) {
                                echo '<p><input type="checkbox" /> ' . $registered_post_type . '</p>';
                            } ?>
                        </td>
                    </tr>

            <?php

                }*/
            ?>

            <tr valign="top">
                <th scope="row"><?php _e( 'Enable Sharing On Archives', 'tkingdom' ); ?></th>
                <?php
                    $checked = '';
                    if ( 'on' == get_option( 'tkss_archives_sharing' ) ) {
                        $checked = 'checked';
                    }
                ?>
                <td class="input-checkbox"><input type="checkbox" name="tkss_archives_sharing" value="on" <?php echo $checked; ?> /></td>
                <td><small><?php _e( 'Enables sharing icons on Archives', 'tkingdom' ); ?></small></td>
            </tr>
        </table>

        <hr />

    <?php
    }

    public function tkss_social_section() { ?>
        <small><?php _e( 'Enable or disable social services you want to use simply by using Drag and Drop techinque.', 'tkingdom' ); ?></small>

        <hr>

        <div id="social-services">

            <div class="widget-liquid-left">
                <div id="widgets-left">
                    <div class="widgets-holder-wrap">
                        <div class="widgets-holder">
                            <div class="sidebar-name">
                                <h3 align="center"><?php _e( 'Available services', 'tkingdom' ); ?></h3>
                            </div>
                            <div class="sidebar-description">
                                <?php _e( 'Drag and Drop items to the right container to enable service', 'tkingdom' ); ?>
                            </div>
                            <div id="widget-list">
                                <div id="social-catalog">
                                    <?php
                                        foreach ( $this->sharing_icons as $sharing_icon_disabled ) {
                                            if ( 'on' != get_option( 'tkss_' . $sharing_icon_disabled ) ) { ?>
                                                <div class="social-service widget" id="<?php echo esc_attr( $sharing_icon_disabled ); ?>">
                                                    <div class="widget-top">
                                                        <div class="widget-title">
                                                            <h4>
                                                                <?php echo ucfirst( $sharing_icon_disabled ); ?>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget-liquid-right">

                <div id="widgets-right" class="single-sidebar">
                    <div class="sidebars-column-1">
                        <div class="widgets-holder-wrap">
                            <div class="sidebar-name">
                                <h3 align="center"><?php _e( 'Enabled services', 'tkingdom' ); ?></h3>
                            </div>
                            <div class="sidebar-description">
                                <?php _e( 'Drag and Drop items to re-arrange order of appareance', 'tkingdom' ); ?>
                            </div>

                            <div id="social-enabled" class="clearfix">
                                <?php

                                    foreach ( $this->sharing_icons as $sharing_icon_enabled ) {
                                        if ( 'on' == get_option( 'tkss_' . $sharing_icon_enabled ) ) {
                                            $position = get_option( 'tkss_' . $sharing_icon_enabled . '_position' );
                                            $services_array[$position] = $sharing_icon_enabled;
                                        }
                                    }

                                    if ( !empty( $services_array ) ) :
                                            ksort( $services_array );

                                            foreach ( $services_array as $service_array ) {
                                                $enabled_services[] = $service_array;
                                            }

                                            foreach ( $enabled_services as $enabled_service ) : ?>
                                                <div class="social-service widget" id="<?php echo esc_attr( $enabled_service ); ?>">
                                                    <div class="widget-top">
                                                        <div class="widget-title">
                                                            <h4>
                                                                <?php echo ucfirst( $enabled_service ); ?>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php
                                            endforeach;
                                    endif;
                                    ?>
                            </div>

                        </div>
                    </div>
                </div>

            </div><!-- widget-liquid-right -->

            <?php

                foreach ( $this->sharing_icons as $sharing_icon ) {
                    $value    = get_option( 'tkss_' . $sharing_icon );
                    $position = get_option( 'tkss_' . $sharing_icon . '_position' );
            ?>
                    <input type="hidden" class="<?php echo esc_attr( $sharing_icon ); ?>" name="tkss_<?php echo esc_attr( $sharing_icon ); ?>" value="<?php echo esc_attr( $value ); ?>">
                    <input type="hidden" class="<?php echo esc_attr( $sharing_icon ); ?>_pos" name="tkss_<?php echo esc_attr( $sharing_icon ); ?>_position" value="<?php echo esc_attr( $position ); ?>">
            <?php
                }

            ?>

        </div>

        <div style="clear:both;"></div>

        <br />
        <hr />

    <?php
    }

    public function tkss_display_section() { ?>
        <small><?php _e( 'Set social sharing display options', 'tkingdom' ); ?></small>

            <hr />

            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e( 'Display on top of content', 'tkingdom' ); ?></th>
                    <?php
                        $checked = '';
                        if ( 'on' == get_option( 'tkss_display_top_sharing' ) ) {
                            $checked = 'checked';
                        }
                    ?>
                    <td class="input-checkbox"><input type="checkbox" name="tkss_display_top_sharing" value="on" <?php echo $checked; ?> /></td>
                    <td><small><?php _e( 'Displays social share box on top of content', 'tkingdom' ); ?></small></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e( 'Display on bottom of content', 'tkingdom' ); ?></th>
                    <?php
                        $checked = '';
                        if ( 'on' == get_option( 'tkss_display_bottom_sharing' ) ) {
                            $checked = 'checked';
                        }
                    ?>
                    <td class="input-checkbox"><input type="checkbox" name="tkss_display_bottom_sharing" value="on" <?php echo $checked; ?> /></td>
                    <td><small><?php _e( 'Displays social share box on bottom of content', 'tkingdom' ); ?></small></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e( 'Display share count', 'tkingdom' ); ?></th>
                    <?php
                        $checked = '';
                        if ( 'on' == get_option( 'tkss_display_share_count' ) ) {
                            $checked = 'checked';
                        }
                    ?>
                    <td class="input-checkbox"><input type="checkbox" name="tkss_display_share_count" value="on" <?php echo $checked; ?> /></td>
                    <td><small><?php _e( 'Displays social share count next to social icons', 'tkingdom' ); ?></small></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e( 'Display total share count', 'tkingdom' ); ?></th>
                    <?php
                        $checked = '';
                        if ( 'on' == get_option( 'tkss_display_total_share_count' ) ) {
                            $checked = 'checked';
                        }
                    ?>
                    <td class="input-checkbox"><input type="checkbox" name="tkss_display_total_share_count" value="on" <?php echo $checked; ?> /></td>
                    <td><small><?php _e( 'Displays total share count before social icons', 'tkingdom' ); ?></small></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e( 'Display share box title', 'tkingdom' ); ?></th>
                    <?php
                        $title = '';
                        if ( get_option( 'tkss_display_share_title' ) ) {
                            $title = get_option( 'tkss_display_share_title' );
                        }
                    ?>
                    <td colspan="2" class="input-checkbox">
                        <input type="text" name="tkss_display_share_title" value="<?php echo $title; ?>" />
                        <small><?php _e( 'Displays share box title on top', 'tkingdom' ); ?></small>
                    </td>
                </tr>
            </table>

            <hr />

            <h3><?php _e( 'Sharing Icons Style', 'tkingdom' ); ?></h3>
            <small><?php _e( 'Select icon designs for sharing box', 'tkingdom' ); ?></small>

            <hr />

            <table class="form-table">
                <tr valign="top">
                    <?php
                        $checked = '';
                        if ( 'text' == get_option( 'tkss_icons_content' ) ) {
                            $checked = 'checked';
                        }
                    ?>
                    <td class="input-checkbox">
                        <input type="checkbox" name="tkss_icons_content" value="text" <?php echo $checked; ?> />
                    </td>
                    <td>
                        <?php _e( 'Displays text insted of icons on share links', 'tkingdom' ); ?>
                    </td>
                </tr>
                <tr valign="top">
                    <?php
                        $checked = '';
                        if ( 'basic' == get_option( 'tkss_icons_sharing' ) ) {
                            $checked = 'checked';
                        }
                    ?>
                    <td class="input-checkbox">
                        <input type="radio" name="tkss_icons_sharing" value="basic" <?php echo $checked; ?> />
                    </td>
                    <td>
                        <img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/basic-icons.jpg'; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <?php
                        $checked = '';
                        if ( 'rounded' == get_option( 'tkss_icons_sharing' ) ) {
                            $checked = 'checked';
                        }
                    ?>
                    <td class="input-checkbox">
                        <input type="radio" name="tkss_icons_sharing" value="rounded" <?php echo $checked; ?> />
                    </td>
                    <td>
                        <img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/rounded-icons.jpg'; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <?php
                        $checked = '';
                        if ( 'colored' == get_option( 'tkss_icons_sharing' ) ) {
                            $checked = 'checked';
                        }
                    ?>
                    <td class="input-checkbox">
                        <input type="radio" name="tkss_icons_sharing" value="colored" <?php echo $checked; ?> />
                    </td>
                    <td>
                        <img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/colored-icons.jpg'; ?>" />
                    </td>
                </tr>

            </table>

            <br />
            <hr />


    <?php
    }

    /**
     * Register PLugin Settings
     */
    public function tkss_settings() {
        // General Settings
        register_setting( 'tk-social-share-settings-group', 'tkss_page_sharing' );
        register_setting( 'tk-social-share-settings-group', 'tkss_post_sharing' );
        register_setting( 'tk-social-share-settings-group', 'tkss_archives_sharing' );

        // Social Settings
        register_setting( 'tk-social-share-social-group', 'tkss_facebook' );
        register_setting( 'tk-social-share-social-group', 'tkss_facebook_position' );
        register_setting( 'tk-social-share-social-group', 'tkss_twitter' );
        register_setting( 'tk-social-share-social-group', 'tkss_twitter_position' );
        register_setting( 'tk-social-share-social-group', 'tkss_google' );
        register_setting( 'tk-social-share-social-group', 'tkss_google_position' );
        register_setting( 'tk-social-share-social-group', 'tkss_pinterest' );
        register_setting( 'tk-social-share-social-group', 'tkss_pinterest_position' );
        register_setting( 'tk-social-share-social-group', 'tkss_stumbleupon' );
        register_setting( 'tk-social-share-social-group', 'tkss_stumbleupon_position' );
        register_setting( 'tk-social-share-social-group', 'tkss_linkedin' );
        register_setting( 'tk-social-share-social-group', 'tkss_linkedin_position' );
        register_setting( 'tk-social-share-social-group', 'tkss_reddit' );
        register_setting( 'tk-social-share-social-group', 'tkss_reddit_position' );
        register_setting( 'tk-social-share-social-group', 'tkss_mail' );
        register_setting( 'tk-social-share-social-group', 'tkss_mail_position' );

        // Display Settings
        register_setting( 'tk-social-share-display-group', 'tkss_display_top_sharing' );
        register_setting( 'tk-social-share-display-group', 'tkss_display_bottom_sharing' );
        register_setting( 'tk-social-share-display-group', 'tkss_display_share_count' );
        register_setting( 'tk-social-share-display-group', 'tkss_display_total_share_count' );
        register_setting( 'tk-social-share-display-group', 'tkss_display_share_title' );
        register_setting( 'tk-social-share-display-group', 'tkss_icons_sharing' );
        register_setting( 'tk-social-share-display-group', 'tkss_icons_content' );
    }

    public function tkss_add_metabox() {
        $screens = array( 'post', 'page' );
        foreach ( $screens as $screen ) {
            add_meta_box( 'tkss_display_box', 'Enable TK Sharing Box', array( $this, 'tkss_metabox_sharing' ), $screen, 'normal', 'high' );
        }
    }

    public function tkss_metabox_sharing() {
        wp_nonce_field( __FILE__, 'tkss_nonce' );
        $tkss_stored_meta = get_post_meta( get_the_ID(), 'enable_global_sharing', true );
        ?>
        <p>
            <label for="enable_global_sharing">
                <input type="checkbox" name="enable_global_sharing" id="enable_global_sharing" value="on" <?php if ( 'on' == $tkss_stored_meta ) { ?> checked <?php } ?> />
                <?php _e( 'Enable sharing on this post / page', 'tkingdom' ); ?>
            </label>
        </p>

        <?php
    }

    /**
     * Saves the custom meta input
     */
    public function tkss_save_metabox( $post_id ) {

        $post_id = get_the_ID();

        // Checks save status
        $is_autosave    = wp_is_post_autosave( $post_id );
        $is_revision    = wp_is_post_revision( $post_id );
        $is_valid_nonce = ( isset( $_POST[ 'tkss_nonce' ] ) && wp_verify_nonce( $_POST[ 'tkss_nonce' ], __FILE__ ) ) ? 'true' : 'false';

        // Exits script depending on save status
        if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
            return;
        }

        // Checks for input and sanitizes/saves if needed
        if ( isset( $_POST[ 'enable_global_sharing' ] ) ) {
            update_post_meta( $post_id, 'enable_global_sharing', $_POST['enable_global_sharing'] );
        }
        else {
            update_post_meta( $post_id, 'enable_global_sharing', 'off' );
        }

    }

    /**
     * Function that generates and attaches share box to content
     * @param  String $content Post/Page content
     * @return String          Post/Page content
     */
    public function tkss_display_social_share( $content ) {

        // Get values
        $page_sharing         = get_option( 'tkss_page_sharing' );
        $post_sharing         = get_option( 'tkss_post_sharing' );
        $archives_sharing     = get_option( 'tkss_archives_sharing' );
        $share_count          = get_option( 'tkss_display_share_count' );
        $share_count_class    = $share_count == 'on' ? 'counter-on' : '';
        $share_title          = get_option( 'tkss_display_share_title' );
        $enabled_services_set = get_option( 'tkss_icons_sharing' );
        $total_share_count    = get_option( 'tkss_display_total_share_count' );
        $content_class        = get_option( 'tkss_icons_content' ) == 'text' ? 'text' : 'icons';
        $tkss_stored_meta     = get_post_meta( get_the_ID(), 'enable_global_sharing', true );
        $pin_image            = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
        $link                 = get_permalink();
        $title                = get_the_title();

        // Filter content
        if ( ( 'post' == get_post_type() && 'on' == $post_sharing && !is_home() && !is_archive() && !is_page() ) || ( 'page' == get_post_type() && 'on' == $page_sharing ) ) {
            $display_icons = true;
        }
        elseif ( 'post' == get_post_type() && 'on' == $archives_sharing ) {
            $display_icons = true;
        }
        else {
            $display_icons = false;
        }

            if ( $display_icons ) :

                if ( 'on' == $tkss_stored_meta ) {

                    $sharing_box = '<div class="tkss-post-share ' . $content_class . ' ' . $share_count_class .'">';

                        if ( '' != $share_title ) {
                            $sharing_box .= '<h6>' . $share_title . '</h6>';
                        }

                        foreach ( $this->sharing_icons as $sharing_icon ) {
                            if ( 'on' == get_option( 'tkss_' . $sharing_icon ) ) {
                                $position                  = get_option( 'tkss_' . $sharing_icon . '_position' );
                                $services_array[$position] = $sharing_icon;
                            }
                        }

                        if ( !empty( $services_array ) ) :

                                $total_shares = $this->tkss_total_sharing_count();

                                if ( 'on' == $total_share_count && 0 != $total_shares ) {
                                    $sharing_box .= '<div class="share-total-count"><span>' . $total_shares . '</span><span> ' . __( 'Shares', 'tkingdom' ) . '</span></div>';
                                }

                                ksort( $services_array );

                                foreach ( $services_array as $service_array ) {
                                    $enabled_services[] = $service_array;
                                }

                                foreach ( $enabled_services as $enabled_service ) :

                                    // Set URLs
                                    switch ( $enabled_service ) {
                                        case 'facebook':
                                            $url = 'https://www.facebook.com/sharer/sharer.php?u=' . $link;
                                            break;
                                        case 'twitter':
                                            $url = 'https://twitter.com/home?status=Check%20out%20this%20article:%20' . $title . '%20-%20' . $link;
                                            break;
                                        case 'google':
                                            $url = 'https://plus.google.com/share?url=' . $link;
                                            break;
                                        case 'pinterest':
                                            $url = 'https://pinterest.com/pin/create/button/?url=' .$link. '&media=' . $pin_image . '&description=' . $title;
                                            break;
                                        case 'stumbleupon':
                                            $url = 'http://www.stumbleupon.com/submit?url=' . $link . '&title=' . $title;
                                            break;
                                        case 'linkedin':
                                            $url = 'http://www.linkedin.com/shareArticle?mini=true&url=' . $link;
                                            break;
                                        case 'reddit':
                                            $url = 'http://www.reddit.com/submit?url=' . $link . '&title=' . $title . 'via%20URL';
                                            break;
                                        case 'mail':
                                            $url = 'mailto:?Subject=' . $title . '&Body=I%20saw%20this%20and%20thought%20of%20you!%20' . $link;
                                            break;
                                    }

                                    /* Display sharing icons */
                                    $sharing_box .= '<div class="single-soc-share-link">';
                                        $sharing_box .= '<a href="' . $url . '" title="' . __( 'Share on', 'tkingdom' ) . ' ' . ucfirst( $enabled_service ) . '" target="_blank">';

                                            $sharing_box .= '<span>' . ucfirst( $enabled_service ) . '</span>';
                                            $sharing_box .= '<i class="icon-' . $enabled_service . '"></i>';

                                            // Share Count
                                            if ( 'on' == $share_count && 'mail' != $enabled_service ) {
                                                $sharing_box .= '<span class="counter">' . $this->tkss_sharing_count( $enabled_service ) . '</span>';
                                            }
                                        $sharing_box .= '</a>';
                                    $sharing_box .= '</div>';

                                endforeach;

                            $sharing_box .= '</div>';

                        endif;

                }

                if ( isset( $sharing_box ) ) {
                    // Display options
                    $display_top    = get_option( 'tkss_display_top_sharing' );
                    $display_bottom = get_option( 'tkss_display_bottom_sharing' );

                    if ( 'on' == $display_top && 'on' != $display_bottom ) {
                        $content = $sharing_box . $content;
                    }
                    elseif ( 'on' == $display_bottom && 'on' != $display_top ) {
                        $content = $content . $sharing_box;
                    }
                    elseif ( 'on' == $display_bottom && 'on' == $display_top ) {
                        $content = $sharing_box . $content . $sharing_box;
                    }
                    else {
                        $content = $content;
                    }
                }

            endif;

        return $content;

    }

}

new TK_Social_Share();
