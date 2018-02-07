/**
 * Enable social sharing icons and sorting them
 */

jQuery(document).ready( function($) {

    $( '#social-enabled' ).sortable( {
        receive: function( event, ui ) {
            var position = ui.item.index();
            var service = ui.item.attr('id');
            var hidden_input = $( '#social-services .'+service );
            var hidden_input_position = $( '#social-services .'+service+'_pos' );
            hidden_input.attr('value', 'on');
            hidden_input_position.attr('value', position);

        },
        update: function( event, ui ) {
            $(this).find( 'div.social-service' ).enableSelection();   // Fixes a problem with Chrome
            var position = ui.item.index();
            var service = ui.item.attr('id');
            var hidden_input_position = $( '#social-services .'+service+'_pos' );
            hidden_input_position.attr('value', position);

            $.map(
                $(this).find( 'div.social-service' ), function(el) {
                    var enabled_service = $(el).attr('id');
                    var enabled_position = $(el).index();
                    var enabled_input_position = $( '#social-services .'+enabled_service+'_pos' );
                    enabled_input_position.attr('value', enabled_position);
                }
            );

        },
        helper: function( event, ui ) {
            return ui.clone();
        },
        start: function( /*event, ui*/ ) {
            $( 'div.social-service' ).disableSelection();   // Fixes a problem with Chrome
        },
        placeholder: 'dropzone',
        opacity: 0.8,
        delay: 150,
        forcePlaceholderSize: true,
        items: 'div.social-service',
        connectWith: '#social-catalog, #social-enabled'
    } );

    $( '#social-catalog' ).sortable( {
        opacity: 0.8,
        delay: 150,
        cursor: 'move',
        connectWith: '#social-enabled',
        placeholder: 'dropzone',
        forcePlaceholderSize: true,
        receive: function( event, ui ) {
            var service = ui.item.attr('id');
            var hidden_input = $( '#social-services .'+service );
            hidden_input.attr('value', 'off');
        }
    } );

});