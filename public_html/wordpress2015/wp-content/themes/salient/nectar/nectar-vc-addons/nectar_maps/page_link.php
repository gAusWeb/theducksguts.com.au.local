<?php 

$vc_is_wp_version_3_6_more = version_compare(preg_replace('/^([\d\.]+)(\-.*$)/', '$1', get_bloginfo('version')), '3.6') >= 0;

return array(
	  "name" => __("Menu Link", "js_composer"),
	  "base" => "page_link",
	  "allowed_container_element" => 'vc_row',
	  "is_container" => true,
	  "content_element" => false,
	  "params" => array(
	    array(
	      "admin_label" => false,
	      "type" => "textfield",
	      "heading" => __("Link Text", "js_composer"),
	      "param_name" => "title",
	      "description" => __("Enter the text that will be displayed for your link", "js_composer")
	    ),
	    array(
	      "admin_label" => true,
	      "type" => "textfield",
	      "heading" => __("Link URL", "js_composer"),
	      "param_name" => "link_url",
	      "description" => __("Enter the URL that will be used for your link", "js_composer")
	    ),
	     array(
	      "type" => "checkbox",
		  "class" => "",
		  "heading" => "Open Link In New Tab",
		  "value" => array("Yes, please" => "true" ),
		  "param_name" => "link_new_tab",
		  "description" => ""
	    ),
	    array(
	      "type" => "tab_id",
	      "heading" => __("Page Link ID", "js_composer"),
	      "param_name" => "id"
	    )
	  ),
	  'js_view' => ($vc_is_wp_version_3_6_more ? 'VcTabView' : 'VcTabView35')
	);

	?>