<?php
/**
 * Creates the admin interface to add shortcodes to the editor
 *
 * @package  ZillaShortcodes
 * @since 2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * TKSC_Admin_Insert class
 */
class TKSC_Admin_Insert {

	/**
	 * __construct function
	 *
	 * @access public
	 * @return  void
	 */
	public function __construct() {
		add_action( 'media_buttons', array( $this, 'media_buttons' ), 20 );
		add_action( 'admin_footer', array( $this, 'tksc_popup_html' ) );
	}

	/**
	 * media_buttons function
	 *
	 * @access public
	 * @return void
	 */
	public function media_buttons( $editor_id = 'content' ) {
		global $pagenow;

		// Only run on add/edit screens
		if ( in_array( $pagenow, array('post.php', 'page.php', 'post-new.php', 'post-edit.php') ) ) {
			$output = '<a href="#TB_inline?width=4000&amp;inlineId=tk-choose-shortcode" class="thickbox button tk-thicbox" title="' . __( 'TK Shortcodes', 'tkingdom' ) . '">' . __( 'TK Shortcodes', 'tkingdom' ) . '</a>';
		}
		echo $output;
	}

	/**
	 * Build out the input fields for shortcode content
	 * @param  string $key
	 * @param  array $param the parameters of the input
	 * @return void
	 */
	public function tksc_build_fields($key, $param) {
		$html = '<tr>';
		$html .= '<td class="label">' . $param['label'] . ':</td>';
		switch( $param['type'] )
		{
			case 'text' :

				// prepare
				$output = '<td><label class="screen-reader-text" for="' . $key .'">' . $param['label'] . '</label>';
				$output .= '<input type="text" class="tk-form-text tk-input" name="' . $key . '" id="' . $key . '" value="' . $param['std'] . '" />' . "\n";
				$output .= '<span class="tk-form-desc">' . $param['desc'] . '</span></td>' . "\n";

				// append
				$html .= $output;

				break;

			case 'textarea' :

				// prepare
				$output = '<td><label class="screen-reader-text" for="' . $key .'">' . $param['label'] . '</label>';
				$output .= '<textarea rows="10" cols="30" name="' . $key . '" id="' . $key . '" class="tk-form-textarea tk-input">' . $param['std'] . '</textarea>' . "\n";
				$output .= '<span class="tk-form-desc">' . $param['desc'] . '</span></td>' . "\n";

				// append
				$html .= $output;

				break;

			case 'select' :

				// prepare
				$output = '<td><label class="screen-reader-text" for="' . $key .'">' . $param['label'] . '</label>';
				$output .= '<select name="' . $key . '" id="' . $key . '" class="tk-form-select tk-input">' . "\n";

				foreach( $param['options'] as $value => $option )
				{
					$output .= '<option value="' . $value . '">' . $option . '</option>' . "\n";
				}

				$output .= '</select>' . "\n";
				$output .= '<span class="tk-form-desc">' . $param['desc'] . '</span></td>' . "\n";

				// append
				$html .= $output;

				break;

			case 'icons' :


                $output = '<input id="' . $key . '" name="' . $key . '" type="hidden"  class="icon-value popup-input" />' . "\n";
                $output .= '<div class="icon-option">';
                $values = $param['values'];
                foreach( $values as $value ){
                    $output .= '<div class="ico-holder"><i class="fa '.$value.'" rel = "'.$value.'" ></i></div>';
                }
                $output .= '</div>';
                ?>
                <script type="text/javascript">
                    jQuery(document).ready(function(){
                        jQuery( '.icon-option i' ).click(function() {
                            jQuery('.icon-value').val(jQuery(this).attr("class"));
                        });

                        jQuery('.ico-holder').click(function() {
                            jQuery('.ico-holder').removeClass('active');
                            jQuery(this).addClass('active');
                        });
                    })


                </script>
                <?php

                $html .= $output;
                //$this->print_shortcode($output);

                break;

			case 'colorpicker' :

				$output = '<td><label class="screen-reader-text" for="' . $key .'">' . $param['label'] . '</label>';
                $output .= '<input id="' . $key . '" name="' . $key . '" type="text"  class="colorpicker popup-input" />' . "\n";

                ?>
                <script type="text/javascript">
                    jQuery(document).ready(function(){
                        jQuery( '#<?php echo $key;?>' ).wpColorPicker();
                    })
                </script>
                <?php

                // append
				$html .= $output;

                break;

			case 'checkbox' :

				// prepare
				$output = '<td><label class="screen-reader-text" for="' . $key .'">' . $param['label'] . '</label>';
				$output .= '<input type="checkbox" name="' . $key . '" id="' . $key . '" class="tk-form-checkbox tk-input"' . ( $param['default'] ? 'checked' : '' ) . '>' . "\n";
				$output .= '<span class="tk-form-desc">' . $param['desc'] . '</span></td>';

				$html .= $output;

				break;

			default :
				break;
		}
		$html .= '</tr>';

		return $html;
	}

	/**
	 * Popup window
	 *
	 * Print the footer code needed for the Insert Shortcode Popup
	 *
	 * @since 2.0
	 * @global $pagenow
	 * @return void Prints HTML
	 */
	function tksc_popup_html() {
		global $pagenow;
		include( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/tksc-shortcode-config.php');

		// Only run in add/edit screens
		if ( in_array( $pagenow, array( 'post.php', 'page.php', 'post-new.php', 'post-edit.php' ) ) ) { ?>

			<script type="text/javascript">
				function tkscInsertShortcode() {
					// Grab input content, build the shortcodes, and insert them
					// into the content editor
					var select = jQuery('#select-tk-shortcode').val(),
						type            = select.replace('tk-', '').replace('-shortcode', ''),
						template        = jQuery('#' + select).data('shortcode-template'),
						childTemplate   = jQuery('#' + select).data('shortcode-child-template'),
						tables          = jQuery('#' + select).find('table').not('.tk-clone-template'),
						attributes      = '',
						content         = '',
						contentToEditor = '';

					// go over each table, build the shortcode content
					for (var i = 0; i < tables.length; i++) {
						var elems = jQuery(tables[i]).find('input, select, textarea');

						// Build an attributes string by mapping over the input
						// fields in a given table.
						attributes = jQuery.map(elems, function(el, index) {
							var $el = jQuery(el);

							console.log(el);

							if( $el.attr('id') === 'content' ) {
								content = $el.val();
								return '';
							} else if( $el.attr('id') === 'last' ) {
								if( $el.is(':checked') ) {
									return $el.attr('id') + '="true"';
								} else {
									return '';
								}
							} else {
								return $el.attr('id') + '="' + $el.val() + '"';
							}
						});
						attributes = attributes.join(' ').trim();

						// Place the attributes and content within the provided
						// shortcode template
						if( childTemplate ) {
							// Run the replace on attributes for columns because the
							// attributes are really the shortcodes
							contentToEditor += childTemplate.replace('{{attributes}}', attributes).replace('{{attributes}}', attributes).replace('{{content}}', content);
						} else {
							// Run the replace on attributes for columns because the
							// attributes are really the shortcodes
							contentToEditor += template.replace('{{attributes}}', attributes).replace('{{attributes}}', attributes).replace('{{content}}', content);
						}
					};

					// Insert built content into the parent template
					if( childTemplate ) {
						contentToEditor = template.replace('{{child_shortcode}}', contentToEditor);
					}

					// Send the shortcode to the content editor and reset the fields
					window.send_to_editor( contentToEditor );
					tkscResetFields();
				}

				// Set the inputs to empty state
				function tkscResetFields() {
					jQuery('#tk-shortcode-title').text('');
					jQuery('#tk-shortcode-wrap').find('input[type=text], select').val('');
					jQuery('#tk-shortcode-wrap').find('textarea').text('');
					jQuery('.tk-was-cloned').remove();
					jQuery('.tk-shortcode-type').hide();
				}

				// Function to redraw the thickbox for new content
				function tkscResizeTB() {
					var	ajaxCont = jQuery('#TB_ajaxContent'),
						tbWindow = jQuery('#TB_window'),
						zillaPopup = jQuery('#tk-shortcode-wrap');

					ajaxCont.css({
						height: (tbWindow.outerHeight()-47),
						overflow: 'auto', // IMPORTANT
						width: (tbWindow.outerWidth() - 30)
					});
				}

				// Simple function to clone an included template
				function tkscCloneContent(el) {
					var clone = jQuery(el).find('.tk-clone-template').clone().removeClass('hidden tk-clone-template').removeAttr('id').addClass('tk-was-cloned');

					jQuery(el).append(clone);
				}

				jQuery(document).ready(function($) {
					var $shortcodes = $('.tk-shortcode-type').hide(),
						$title = $('#tk-shortcode-title');

					// Show the selected shortcode input fields
	                $('#select-tk-shortcode').change(function () {
	                	var text = $(this).find('option:selected').text();

	                	$shortcodes.hide();
	                	$title.text(text);
	                    $('#' + $(this).val()).show();
	                    tkscResizeTB();
	                });

	                // Clone a set of input fields
	                $('.clone-content').on('click', function() {
						var el = $(this).siblings('.tk-sortable');

						tkscCloneContent(el);
						tkscResizeTB();
						$('.tk-sortable').sortable('refresh');
					});

	                // Remove a set of input fields
					$('.tk-shortcode-type').on('click', '.tk-remove' ,function() {
						$(this).closest('table').remove();
					});

					// Make content sortable using the jQuery UI Sortable method
					$('.tk-sortable').sortable({
						items: 'table:not(".hidden")',
						placeholder: 'tk-sortable-placeholder'
					});
	            });
			</script>

			<div id="tk-choose-shortcode" style="display: none;">
				<div id="tk-shortcode-wrap" class="wrap tk-shortcode-wrap">
					<div class="tk-shortcode-select">
						<label for="tk-shortcode"><?php _e('Select the shortcode type', 'tkingdom'); ?></label>
						<select name="tk-shortcode" id="select-tk-shortcode">
							<option><?php _e('Select Shortcode', 'tkingdom'); ?></option>
							<?php foreach( $tk_shortcodes as $shortcode ) {
								echo '<option data-title="' . $shortcode['title'] . '" value="' . $shortcode['id'] . '">' . $shortcode['title'] . '</option>';
							} ?>
						</select>
					</div>

					<h3 id="tk-shortcode-title"></h3>

				<?php

				$html = '';
				$clone_button = array( 'show' => false );

				// Loop through each shortcode building content
				foreach( $tk_shortcodes as $key => $shortcode ) {

					// Add shortcode templates to be used when building with JS
					$shortcode_template = ' data-shortcode-template="' . $shortcode['template'] . '"';
					if( array_key_exists('child_shortcode', $shortcode ) ) {
						$shortcode_template .= ' data-shortcode-child-template="' . $shortcode['child_shortcode']['template'] . '"';
					}

					// Individual shortcode 'block'
					$html .= '<div id="' . $shortcode['id'] . '" class="tk-shortcode-type" ' . $shortcode_template . '>';

					// If shortcode has children, it can be cloned and is sortable.
					// Add a hidden clone template, and set clone button to be displayed.
					if( array_key_exists('child_shortcode', $shortcode ) ) {
						$html .= (isset($shortcode['child_shortcode']['shortcode']) ? $shortcode['child_shortcode']['shortcode'] : null);
						$shortcode['params'] = $shortcode['child_shortcode']['params'];
						$clone_button['show'] = true;
						$clone_button['text'] = $shortcode['child_shortcode']['clone_button'];
						$html .= '<div class="tk-sortable">';
						$html .= '<table id="clone-' . $shortcode['id'] . '" class="hidden tk-clone-template"><tbody>';
						foreach( $shortcode['params'] as $key => $param ) {
							$html .= $this->tksc_build_fields($key, $param);
						}
						if( $clone_button['show'] ) {
							$html .= '<tr><td colspan="2"><a href="#" class="tk-remove">' . __('Remove', 'tkingdom') . '</a></td></tr>';
						}
						$html .= '</tbody></table>';
					}

					// Build the actual shortcode input fields
					$html .= '<table><tbody>';
					foreach( $shortcode['params'] as $key => $param ) {
						$html .= $this->tksc_build_fields($key, $param);
					}

					// Add a link to remove a content block
					if( $clone_button['show'] ) {
						$html .= '<tr><td colspan="2"><a href="#" class="tk-remove">' . __('Remove', 'tkingdom') . '</a></td></tr>';
					}
					$html .= '</tbody></table>';

					// Close out the sortable div and display the clone button as needed
					if( $clone_button['show'] ) {
						$html .= '</div>';
						$html .= '<a id="add-' . $shortcode['id'] . '" href="#" class="button-secondary clone-content">' . $clone_button['text'] . '</a>';
						$clone_button['show'] = false;
					}

					// Display notes if provided
					if( array_key_exists('notes', $shortcode) ) {
						$html .= '<p class="tk-notes">' . $shortcode['notes'] . '</p>';
					}
					$html .= '</div>';
				}

				echo $html;
				?>

				<p class="submit">
					<input type="button" id="tk-insert-shortcode" class="button-primary" value="<?php _e('Insert Shortcode', 'tkingdom'); ?>" onclick="tkscInsertShortcode();" />
					<a href="#" id="tk-cancel-shortcode-insert" class="button-secondary tk-cancel-shortcode-insert" onclick="tb_remove();"><?php _e('Cancel', 'tkingdom'); ?></a>
				</p>
				</div>
			</div>

		<?php
		}
	}
}

new TKSC_Admin_Insert();