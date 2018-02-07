(function( $ ) {
    'use strict';

        jQuery(document).ready(function(){

            /**
             * --------------------------------
             *  Button Live Preview
             * --------------------------------
             */

            var buttonShortCodeBox = $('#tk-button-shortcode');
            var btnStyle           = buttonShortCodeBox.find('#style');
            var btnSize            = buttonShortCodeBox.find('#size');
            var btnType            = buttonShortCodeBox.find('#type');
            var btnText            = buttonShortCodeBox.find('#content');
            var btnClass           = btnStyle.val();
            var btnSized           = btnSize.val();
            var btnTyped           = btnType.val();
            var btnTextd           = btnText.val();
            var button             = '<a class="tk-btn ' + btnSized +' '+ btnClass +' '+ btnTyped +'" href="#"> '+ btnTextd +' </a>';
            var previewHolder      = '<div class="shortcode-preview"></div>';
            buttonShortCodeBox.append(previewHolder);
            buttonShortCodeBox.find('.shortcode-preview').append(button);

            btnStyle.change(function(){
                var btnClass = $(this).val();
                var btnSized = btnSize.val();
                var btnTyped = btnType.val();
                var btnTextd = btnText.val();
                var button   = '<a class="tk-btn ' + btnSized +' '+ btnClass +' '+ btnTyped +'" href="#"> '+ btnTextd +' </a>';
                buttonShortCodeBox.find('.shortcode-preview').empty();
                buttonShortCodeBox.find('.shortcode-preview').append(button);
            });

            btnSize.change(function(){
                var btnClass = btnStyle.val();
                var btnSized = $(this).val();
                var btnTyped = btnType.val();
                var btnTextd = btnText.val();
                var button   = '<a class="tk-btn ' + btnSized +' '+ btnClass +' '+ btnTyped +'" href="#"> '+ btnTextd +' </a>';
                buttonShortCodeBox.find('.shortcode-preview').empty();
                buttonShortCodeBox.find('.shortcode-preview').append(button);
            });

            btnType.change(function(){
                var btnClass = btnStyle.val();
                var btnSized = btnSize.val();
                var btnTyped = $(this).val();
                var btnTextd = btnText.val();
                var button   = '<a class="tk-btn ' + btnSized +' '+ btnClass +' '+ btnTyped +'" href="#"> '+ btnTextd +' </a>';
                buttonShortCodeBox.find('.shortcode-preview').empty();
                buttonShortCodeBox.find('.shortcode-preview').append(button);
            });

            btnText.keyup(function(){
                var btnClass = btnStyle.val();
                var btnSized = btnSize.val();
                var btnTyped = btnType.val();
                var btnTextd = $(this).val();
                var button   = '<a class="tk-btn ' + btnSized +' '+ btnClass +' '+ btnTyped +'" href="#"> '+ btnTextd +' </a>';
                buttonShortCodeBox.find('.shortcode-preview').empty();
                buttonShortCodeBox.find('.shortcode-preview').append(button);
            });

            /**
             * --------------------------------
             *  Infobox Live Preview
             * --------------------------------
             */

             var infoShortCodeBox = $('#tk-alert-shortcode');
             var infoboxStyle     = infoShortCodeBox.find('#style');
             var infoboxText      = infoShortCodeBox.find('#content');
             var infoboxTextVal   = infoboxText.val();
             var infoClass        = infoboxStyle.val();
             var infobox          = '<div class="tksc-alert-box ' + infoClass + '" style="outline: none;">' + infoboxTextVal + '<i class="close-infobox"></i></div>';
             infoShortCodeBox.append(previewHolder);
             infoShortCodeBox.find('.shortcode-preview').append(infobox);

             infoboxStyle.change(function(){
                var infoClass   = $(this).val();
                var infoboxText = infoShortCodeBox.find('#content').val();
                var infobox     = '<div class="tksc-alert-box ' + infoClass + '" style="outline: none;">' + infoboxText + '<i class="close-infobox"></i></div>';
                infoShortCodeBox.find('.shortcode-preview').empty();
                infoShortCodeBox.find('.shortcode-preview').append(infobox);
             });

             infoboxText.keyup(function(){
                var infoClass   = infoShortCodeBox.find('#style').val();
                var infoboxText = $(this).val();
                var infobox     = '<div class="tksc-alert-box ' + infoClass + '" style="outline: none;">' + infoboxText + '<i class="close-infobox"></i></div>';
                infoShortCodeBox.find('.shortcode-preview').empty();
                infoShortCodeBox.find('.shortcode-preview').append(infobox);
             });

            /**
             * --------------------------------
             *  Dropcap Live Preview
             * --------------------------------
             */

            var dropcapShortCodeBox = $('#tk-dropcap-shortcode');
            var dropcapStyle        = dropcapShortCodeBox.find('#style');
            var dropcapText         = dropcapShortCodeBox.find('#content');
            var dropcapClass        = dropcapStyle.val();
            var dropcapTextVal      = dropcapText.val();
            var dropcap             = '<span class="dropcap-' + dropcapClass + '" style="outline: none;">' + dropcapTextVal + '</span><div style="clear:both;"></div>';
            dropcapShortCodeBox.append(previewHolder);
            dropcapShortCodeBox.find('.shortcode-preview').append(dropcap);

            dropcapStyle.change(function(){
                var dropcapClass = $(this).val();
                var dropcapText  = dropcapShortCodeBox.find('#content').val();
                var dropcap      = '<span class="dropcap-' + dropcapClass + '" style="outline: none;">' + dropcapText + '</span><div style="clear:both;"></div>';
                dropcapShortCodeBox.find('.shortcode-preview').empty();
                dropcapShortCodeBox.find('.shortcode-preview').append(dropcap);
            });

            dropcapText.keyup(function(){
                var dropcapClass = dropcapShortCodeBox.find('#style').val();
                var dropcapText  = $(this).val();
                var dropcap      = '<span class="dropcap-' + dropcapClass + '" style="outline: none;">' + dropcapText + '</span><div style="clear:both;"></div>';
                dropcapShortCodeBox.find('.shortcode-preview').empty();
                dropcapShortCodeBox.find('.shortcode-preview').append(dropcap);
            });

        });

})( jQuery );