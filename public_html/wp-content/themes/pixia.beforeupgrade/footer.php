
	</div><!-- /#wrap -->
    <div class="push"></div>
    </div><!-- #ultra_wrapper -->
    <div class="footer">
    </div>
  	<script type="text/javascript">
		/*jQuery('img').load(function()
		{
			if (jQuery(this).hasClass('desaturated_image'))
			{
				jQuery(this).removeClass('desaturated_image');
				jQuery(this).parent().addClass('desaturated_before');
				var img = document.getElementById(jQuery(this).attr('id'));
				Pixastic.process(img, "desaturate", {average : false});	
			}
		});*/
    	jQuery(document).ready(function()
        {
        	//CALL MAIN JSCRIPT FUNCTION
         	pixia_init();	
			jQuery( "#accordion" ).accordion();
       	});
  	</script>
    <?php
        $pixia_frontend_options=get_option('pixia_theme_options');
    ?>

    <div id="contactform-icon">
        <img alt="" src="<?php echo get_template_directory_uri(); ?>/images/contactform-icon.png">
    </div>
    <div id="contactform">
        <div id="contactform-close">
            <img alt="" src="#">
        </div>
        <div class="single_entry_title">
            <h2><header_font>Contact us</header_font></h2>
        </div>
        <form action="" id="contact-form" method="post">
            <label>
                <input type="text" class="pk_contact_highlighted" name="c_name" id="c_name" 
                            placeholder="<?php _e($pixia_frontend_options['contact_name_text'], 'pixia');_e($pixia_frontend_options['required_text'], 'pixia'); ?>" />
            </label>
            <label>
                <input type="text" class="pk_contact_highlighted" name="c_email" id="c_email" size="28"                             placeholder="<?php _e($pixia_frontend_options['contact_email_text'], 'pixia');_e($pixia_frontend_options['required_text'], 'pixia'); ?>" />
            </label>
            <label>
                <input type="text" class="pk_contact_highlighted" name="c_subject" id="c_subject" size="28"
                            placeholder="<?php _e($pixia_frontend_options['contact_subject_text'], 'pixia'); ?>" />
            </label>
            <label>
                <textarea class="pk_contact_highlighted" name="c_message" id="c_message"
                            onfocus="if(this.value=='<?php _e($pixia_frontend_options['contact_message_text'], 'pixia'); ?>')this.value=''" 
                        onblur="if(this.value=='')this.value='<?php _e($pixia_frontend_options['contact_message_text'], 'pixia'); ?>'"><?php _e($pixia_frontend_options['contact_message_text'], 'pixia'); ?></textarea>
            </label>
            <p></p>
            <input type="hidden" id="full_subject" name="full_subject" value="" />
            <input type="hidden" name="rec_email" value="<?php echo $pixia_frontend_options['email_address']; ?>" />
            <div class="cf"></div>
            <div id="contact_ok">Processing...</div>
            <div id="contactform-submit">
                <div class="theme_button" id="submit_message_div">
                    <a href="#" class="" >Submit&nbsp;&nbsp;</a>
                </div>
                <div class="triangle"></div>
            </div>
        </form>
    </div>

 	<?php wp_footer(); ?>
  	<?php pirenko_footer(); ?>

</body>
</html>