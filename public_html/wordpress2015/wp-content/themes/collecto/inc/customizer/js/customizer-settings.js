(function($) { 'use strict';

	function retreive_font_weight( font_type ) {

		var font_selector = $( '#customize-control-' + font_type + '_font_family select' ),
			font_selected = font_selector.val(),
			weight_select;

		if ( 'default' != font_selected ) {

    		$.ajax({
	            type: 'POST',
	            url: js_vars.admin_url,
	            dataType: 'json',
	            data: {
	            	action: 'collecto_generate_font_weight',
	            	selected_font: font_selected
	            },
	            success: function( response ) {

	            	var result = eval( response ),
	            	    select_options = '';

					for ( var index in result ) {

						var selected_variant            = '',
							headings_selected_variant   = js_vars.headings_font_variant,
							primary_selected_variant    = js_vars.primary_font_variant,
							secondary_selected_variant  = js_vars.secondary_font_variant;

						switch ( font_type ) {
							case 'headings' :
								if ( result[index] == headings_selected_variant ) {
									selected_variant = 'selected="selected"';
								}
								break;
							case 'primary' :
								if ( result[index] == primary_selected_variant ) {
									selected_variant = 'selected="selected"';
								}
								break;
							case 'secondary' :
								if ( result[index] == secondary_selected_variant ) {
									selected_variant = 'selected="selected"';
								}
								break;
							default :
								selected_variant = '';
						}

						select_options += '<option value="' + result[index] + '" ' + selected_variant + '>' + result[index] + '</option>';
					}

					weight_select = $( '#customize-control-' + font_type + '_font_weight select' );
					weight_select.empty();
					weight_select.append( select_options );

	            }

	       	} );

       	} else {
       		weight_select = $( '#customize-control-' + font_type + '_font_weight select' );
       		weight_select.empty();
       		weight_select.append( '<option value="default">' + js_vars.default_text + '</option>' );
       	}

	}

    $(window).load(function(){

    	/**
    	 * On load set selected font family and weight
    	 */
    	retreive_font_weight( 'headings' );
		retreive_font_weight( 'primary' );
		retreive_font_weight( 'secondary' );

    	/**
    	 * Select font and generate weight for it
    	 */
    	var headings_font_select   = $( '#customize-control-headings_font_family select' ),
	    	primary_font_select = $( '#customize-control-primary_font_family select' ),
	    	secondary_font_select = $( '#customize-control-secondary_font_family select' );

    	headings_font_select.on( 'change', function(){
    		retreive_font_weight( 'headings' );
    	} );

    	primary_font_select.on( 'change', function(){
    		retreive_font_weight( 'primary' );
    	} );

    	secondary_font_select.on( 'change', function(){
    		retreive_font_weight( 'secondary' );
    	} );

    } ); // End Document Ready

} )(jQuery);
