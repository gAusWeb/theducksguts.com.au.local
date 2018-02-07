<?php

        include_once(TEMPLATEPATH . '/inc/plugins/vt_resize.php');
        function pixia_scripts() 
        {
                $prk_theme = wp_get_theme();
                wp_enqueue_style('pixia_custom_style', get_template_directory_uri() . '/css/custom.css', false, $prk_theme->Version);
                $pixia_frontend_options=get_option('pixia_theme_options');
                if ($pixia_frontend_options['responsive']=="true") 
                {
                        wp_enqueue_style('pirenko_responsive_style', get_template_directory_uri() . '/css/responsive.css', false, null);
                }
                wp_enqueue_style('pixia_other_styles', get_template_directory_uri() . '/css/other.css', false, $prk_theme->Version);
        
                if (is_single() && comments_open() && get_option('thread_comments')) 
                {
                        wp_enqueue_script('comment-reply');
                }
        
                wp_register_script('pixia_main', get_template_directory_uri() . '/js/main.js', array('jquery'), null, false);
                wp_register_script('pixia_other', get_template_directory_uri() . '/js/other.js', array('jquery'), $prk_theme->Version, true);

                wp_enqueue_script('pixia_main');
                wp_enqueue_script('pixia_other');
                                
                //INCLUDE SCRIPT FROM WORDPRESS CORE
                wp_enqueue_script('jquery-ui-accordion');
                wp_enqueue_script('jquery-ui-tabs');
                wp_enqueue_script('jquery-ui-button');
                wp_enqueue_script('jquery-color');
                
                //POST LIKE SCRIPTS
                wp_localize_script('pixia_main', 'ajax_var', array(
                'url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('ajax-nonce')
                ));
	}
	
	add_action('wp_enqueue_scripts', 'pixia_scripts', 100);
	
	//ADD CUSTOM SCRIPTS FOR THE BACKEND
	function pixia_admin_scripts() 
	{
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_register_script('my-upload', get_template_directory_uri() .'/js/admin_scripts.js', array('jquery','media-upload','thickbox'));
		wp_enqueue_script('my-upload');
		wp_register_script('c_picker', get_template_directory_uri() .'/inc/admin/colorpicker.js', array('jquery'), null, false);
		wp_enqueue_script('c_picker');
		wp_register_style( 'c_picker_css', get_template_directory_uri() . '/inc/admin/colorpicker.css' );
		wp_enqueue_style('c_picker_css');
	}
	
	function pixia_admin_styles() 
	{
		wp_enqueue_style('thickbox');
	}
	
	add_action('admin_print_scripts', 'pixia_admin_scripts');
	add_action('admin_print_styles', 'pixia_admin_styles');
?>