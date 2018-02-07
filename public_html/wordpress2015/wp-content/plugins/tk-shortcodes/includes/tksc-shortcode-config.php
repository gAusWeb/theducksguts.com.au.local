<?php
/**
 * Define the shortcode parameters
 *
 * @package Tk_Shortcodes
 * @since 1.0
 */


/* Button Config --- */

$tk_shortcodes['button'] = array(
	'title'    => __( 'Button', 'tkingdom' ),
	'id'       => 'tk-button-shortcode',
	'template' => '[button {{attributes}}] {{content}} [/button]',
	'params'   => array(
		'url' => array(
			'std'   => 'http://example.com',
			'type'  => 'text',
			'label' => __( 'Button URL', 'tkingdom' ),
			'desc'  => __( 'Add the button\'s url eg http://example.com', 'tkingdom' )
		),
		'style' => array(
			'type'    => 'select',
			'label'   => __( 'Button Style', 'tkingdom' ),
			'desc'    => __( 'Select the button\'s style, ie the button\'s colour', 'tkingdom' ),
			'options' => array(
				'default'          => __( 'Grey', 'tkingdom' ),
				'tksc-btn-warning' => __( 'Yellow', 'tkingdom' ),
				'tksc-btn-inverse' => __( 'Black', 'tkingdom' ),
				'tksc-btn-primary' => __( 'Transparent', 'tkingdom' ),
				'tksc-btn-info'    => __( 'Light Blue', 'tkingdom' ),
				'tksc-btn-danger'  => __( 'Red', 'tkingdom' ),
				'tksc-btn-success' => __( 'Green', 'tkingdom' )
			)
		),
		'size' => array(
			'type'    => 'select',
			'label'   => __( 'Button Size', 'tkingdom' ),
			'desc'    => __( 'Select the button\'s size', 'tkingdom' ),
			'options' => array(
                ''          => __( 'Default', 'tkingdom' ),
                'tksc-btn-large' => __( 'Large', 'tkingdom' ),
                'tksc-btn-small' => __( 'Small', 'tkingdom' ),
                'tksc-btn-mini'  => __( 'Mini', 'tkingdom' )
			)
		),
		'type' => array(
			'type'    => 'select',
			'label'   => __( 'Button Type', 'tkingdom' ),
			'desc'    => __( 'Select the button\'s type', 'tkingdom' ),
			'options' => array(
				'round'  => 'Round',
				'square' => 'Square'
			)
		),
		'target' => array(
			'type'    => 'select',
			'label'   => __( 'Button Target', 'tkingdom' ),
			'desc'    => __( 'Set the browser behavior for the click action.', 'tkingdom' ),
			'options' => array(
				'_self'  => 'Same window',
				'_blank' => 'New window'
			)
		),
		'content' => array(
			'std'   => 'Button Text',
			'type'  => 'text',
			'label' => __( 'Button\'s Text', 'tkingdom' ),
			'desc'  => __( 'Add the button\'s text', 'tkingdom' ),
		)
	)
);

/* Dropcap -- */

$tk_shortcodes['dropcap'] = array(
	'template' => '[dropcap {{attributes}}] {{content}} [/dropcap]',
	'title'    => __( 'Dropcap', 'tkingdom' ),
	'id'       => 'tk-dropcap-shortcode',
	'params'   => array(
        'style' => array(
            'type'  => 'select',
            'label' => __( 'Type of dropcap', 'tkingdom' ),
            'desc'  => __( 'Select the dropcap type', 'tkingdom' ),
            'options' => array(
                'background'    => 'With Background',
                'no-background' => 'Without Background'
            )
        ),
        'content' => array(
            'std'   => __( 'A', 'tkingdom' ),
            'type'  => 'textarea',
            'label' => __( 'Insert starting letter to use as dropcap.', 'tkingdom' ),
            'desc'  => '',
            'options' => array(
                'rows'  => '1',
                'width' => '10%'
            )
        )
    )
);

/* Column Row --- */

$tk_shortcodes['row'] = array(
	'title'    => __( 'Row', 'tkingdom' ),
	'id'       => 'tk-row-shortcode',
	'template' => '[row][/row]',
	'notes'    => __( 'Add columns inside this row to clear floats!', 'tkingdom' ),
 	'params'   => array()
);

/* Columns Config --- */

$tk_shortcodes['columns'] = array(
	'title'    => __( 'Columns', 'tkingdom' ),
	'id'       => 'tk-columns-shortcode',
	'template' => ' {{child_shortcode}} ', // There is no wrapper shortcode
	'notes'    => __( 'Click \'Add Column\' to add a new column. Drag and drop to reorder columns.', 'tkingdom' ),
	'params'   => array(),
	'child_shortcode' => array(
		'params' => array(
			'column' => array(
				'type'    => 'select',
				'label'   => __( 'Column Type', 'tkingdom' ),
				'desc'    => __( 'Select the width of the column.', 'tkingdom' ),
				'options' => array(
					'one-third'    => __( 'One Third', 'tkingdom' ),
					'two-third'    => __( 'Two Thirds', 'tkingdom' ),
					'one-half'     => __( 'One Half', 'tkingdom' ),
					'one-fourth'   => __( 'One Fourth', 'tkingdom' ),
					'three-fourth' => __( 'Three Fourth', 'tkingdom' ),
					'one-sixth'    => __( 'One Sixth', 'tkingdom' ),
					'five-sixth'   => __( 'Five Sixth', 'tkingdom' )
				)
			),
			'content' => array(
				'std'   => __( 'Column content', 'tkingdom' ),
				'type'  => 'textarea',
				'label' => __( 'Column Content', 'tkingdom' ),
				'desc'  => ''
			)
		),
		'template'     => '[column {{attributes}}] {{content}} [/column]',
		'clone_button' => __( 'Add Column', 'tkingdom' )
	)
);

/* Fullwidth Section --- */

$tk_shortcodes['fullwidth'] = array(
	'title'    => __( 'Fullwidth Section', 'tkingdom' ),
	'id'       => 'tk-fullwidth-shortcode',
	'template' => '[fullwidth {{attributes}}] {{content}} [/fullwidth]',
	'params'   => array(
        'backgroundcolor' => array(
            'type'  => 'colorpicker',
            'label' => __( 'Background Color', 'tkingdom' ),
            'desc'  => __( '', 'tkingdom' ),
            'value' => '',
        ),
        'content' => array(
            'std'     => '',
            'type'    => 'textarea',
            'label'   => __( 'Add Content', 'tkingdom' ),
            'desc'    => '',
            'options' => array(
                'rows'  => '12',
                'width' => '100%'
            )
        ),
        'imagebackground' => array(
            'std'     => '',
            'type'    => 'text',
            'label'   => __( 'Image Url', 'tkingdom' ),
            'desc'    => __( 'Place image url', 'tkingdom' ),
            'options' => array(
                'width' => '65%'
            )
        ),
        'backgroundrepeat' => array(
            'type'    => 'select',
            'label'   => __( 'Background Image Repeat', 'tkingdom' ),
            'desc'    => __( 'Select if image would repeat and stay fixed or centered', 'tkingdom' ),
            'options' => array(
                'repeat'    => 'Repeat',
                'no-repeat' => 'No Repeat (centered)'
            )
        ),

    ),
);

/* InfoBox Config --- */

$tk_shortcodes['infobox'] = array(
	'title'    => __( 'InfoBox', 'tkingdom' ),
	'id'       => 'tk-tksc-alert-shortcode',
	'template' => '[infobox {{attributes}}] {{content}} [/infobox]',
	'params' => array(
		'style' => array(
			'type'  => 'select',
			'label' => __( 'Message Box Style', 'tkingdom' ),
			'desc'  => __( 'Select the type of the message box.', 'tkingdom' ),
			'options' => array(
                'tksc-alert-default'      => __( 'Default Message', 'tkingdom' ),
                'tksc-alert-announcement' => __( 'Announcement Message', 'tkingdom' ),
                'tksc-alert-error'        => __( 'Error Message', 'tkingdom' ),
                'tksc-alert-success'      => __( 'Success Message', 'tkingdom' ),
                'tksc-alert-warning'      => __( 'Warning Message', 'tkingdom' ),
                'tksc-alert-info'         => __( 'Information Message', 'tkingdom' )
			)
		),
		'content' => array(
			'std'     => 'Insert yor text',
			'type'    => 'textarea',
			'label'   => __( 'Insert your text', 'tkingdom' ),
			'desc'    => '',
			'value'   => '',
			'options' => array(
                'rows'  => '10',
                'width' => '100%'
            )
		)

	)
);

/* Progress Bar --- */

$tk_shortcodes['progressbar'] = array(
	'title'    => __( 'Progress Bar', 'tkingdom' ),
	'id'       => 'tk-progressbar-shortcode',
	'template' => '[progressbar {{attributes}}] {{content}} [/progressbar]',
		'params' => array(
            'bar_percentage' => array(
                'type'  => 'text',
                'label' => __( 'Progress Bar Percentage', 'tkingdom' ),
                'desc'  => __( '% (0 - 100)', 'tkingdom' ),
                'std'   => __( '', 'tkingdom' ),
                'options' => array(
                    'width' => '20%'
                )
            ),
            'content' => array(
                'std'   => '',
                'type'  => 'textarea',
                'label' => __( 'Progress title', 'tkingdom' ),
                'desc'  => '',
                'options' => array(
                    'rows'  => '10',
                    'width' => '100%'
                )
            )
        ),
);

/* Toggle Config --- */

$tk_shortcodes['toggle'] = array(
	'title'    => __( 'Toggle', 'tkingdom' ),
	'id'       => 'tk-toggle-shortcode',
	'template' => ' {{child_shortcode}} ', // There is no wrapper shortcode
	'notes'    => __( 'Click \'Add Toggle\' to add a new toggle. Drag and drop to reorder toggles.', 'tkingdom' ),
	'params'   => array(),
	'child_shortcode' => array(
		        'params' => array(
		            'title' => array(
		                'type'  => 'text',
		                'label' => __( 'Toggle Title', 'tkingdom' ),
		                'desc'  => '',
		                'std'   => 'Title',
		                'options' => array(
		                    'width' => '100%'
		                )
		            ),
		            'state' => array(
						'type'  => 'select',
						'std'   => '',
						'label' => __( 'Toggle State', 'tkingdom' ),
						'desc'  => __( 'Select the state of the toggle on page load', 'tkingdom' ),
						'options' => array(
							'opened' => 'Open',
							'closed' => 'Closed'
						)
					),
		            'content' => array(
		                'std'   => 'Content',
		                'type'  => 'textarea',
		                'label' => __( 'Toggle Content', 'tkingdom' ),
		                'desc'  => '',
		                'options' => array(
		                    'rows'  => '10',
		                    'width' => '100%'
		                )
		            )
		        ),

		'template'     => '[toggle {{attributes}}] {{content}} [/toggle]',
		'clone_button' => __( 'Add Toggle', 'tkingdom' )

		),
);


/* Tabs Config --- */

$tk_shortcodes['tabs'] = array(
	'title'    => __( 'Tabbed content', 'tkingdom' ),
	'id'       => 'tk-tabs-shortcode',
	'template' => '[tabs] {{child_shortcode}} [/tabs]',
	'notes'    => __( 'Click \'Add Tab\' to add a new tab. Drag and drop to reorder tabs.', 'tkingdom' ),
	'params'   => array(),
    'child_shortcode' => array(
		        'params' => array(
		        	'title' => array(
						'std'   => __( 'Title', 'tkingdom' ),
						'type'  => 'text',
						'label' => __( 'Tab Title', 'tkingdom' ),
						'desc'  => '',
            		),
		            'content' => array(
						'std'   => __( 'Tab Content', 'tkingdom' ),
						'type'  => 'textarea',
						'label' => __( 'Tab Content', 'tkingdom' ),
						'desc'  => ''
		            )
				),
		'template'     => '[tab {{attributes}}] {{content}} [/tab]',
		'clone_button' => __( 'Add Tab', 'tkingdom' ),
    ),
);

/* Accordion Config --- */

$tk_shortcodes['accordion'] = array(
	'title'    => __( 'Accordion content', 'tkingdom' ),
	'id'       => 'tk-accordion-shortcode',
	'template' => '[accordion] {{child_shortcode}} [/accordion]',
	'notes'    => __( 'Click \'Add Accordion\' to add a new accordion. Drag and drop to reorder accordion.', 'tkingdom' ),
	'params'   => array(),
    'child_shortcode' => array(
		        'params' => array(
		        	'title' => array(
						'std'   => __( 'Title', 'tkingdom' ),
						'type'  => 'text',
						'label' => __( 'Accordion Title', 'tkingdom' ),
						'desc'  => '',
            		),
            		'state' => array(
						'type'  => 'select',
						'std'   => 'closed',
						'label' => __( 'Accordion State', 'tkingdom' ),
						'desc'  => __( 'Select the state of the accordion on page load', 'tkingdom' ),
						'options' => array(
							'closed' => 'Closed',
							'opened' => 'Open'
						)
					),
		            'content' => array(
						'std'   => __( 'Accordion Content', 'tkingdom' ),
						'type'  => 'textarea',
						'label' => __( 'Accordion Content', 'tkingdom' ),
						'desc'  => ''
		            )
				),
		'template'     => '[accordions {{attributes}}] {{content}} [/accordions]',
		'clone_button' => __( 'Add Accordion', 'tkingdom' ),
    ),
);

        //Icon
$tk_shortcodes['icon'] = array(
		'title'    => __( 'Icon', 'tkingdom' ),
		'id'       => 'tk-icon-shortcode',
		'template' => '[icon {{attributes}}] {{content}} [/icon]',
		'notes'    => __( 'Choose your icon by clicking on it and enter details', 'tkingdom' ),
		'params'   => array(
                'image' => array(
                    'type'  => 'icons',
                    'desc'  => __( 'Choose icon', 'tkingdom' ),
                    'label' => __( 'Choose your icon above', 'tkingdom' ),
                    'values'=> array(
                      'icon-glass'                => 'fa-glass',
                      'icon-music'                => 'fa-music',
                      'icon-search'               => 'fa-search',
                      'icon-envelope'             => 'fa-envelope-o',
                      'icon-heart'                => 'fa-heart',
                      'icon-star'                 => 'fa-star',
                      'icon-star'                 => 'fa-star',
                      'icon-star-o'               => 'fa-star-o',
                      'icon-user'                 => 'fa-user',
                      'icon-film'                 => 'fa-film',
                      'icon-th-large'             => 'fa-th-large',
                      'icon-th'                   => 'fa-th',
                      'icon-th-list'              => 'fa-th-list',
                      'icon-check'                => 'fa-check',
                      'icon-times'                => 'fa-times',
                      'icon-search-plus'          => 'fa-search-plus',
                      'icon-search-minus'         => 'fa-search-minus',
                      'icon-power-off'            => 'fa-power-off',
                      'icon-signal'               => 'fa-signal',
                      'icon-gear'                 => 'fa-gear',
                      'icon-cog'                  => 'fa-cog fa-spin',
                      'icon-trash-o'              => 'fa-trash-o',
                      'icon-home'                 => 'fa-home',
                      'icon-file-o'               => 'fa-file-o',
                      'icon-clock-o'              => 'fa-clock-o',
                      'icon-road'                 => 'fa-road',
                      'icon-download'             => 'fa-download',
                      'icon-arrow-circle-o-down'  => 'fa-arrow-circle-o-down',
                      'icon-arrow-circle-o-up'    => 'fa-arrow-circle-o-up',
                      'icon-inbox'                => 'fa-inbox',
                      'icon-play-circle-o'        => 'fa-play-circle-o',
                      'icon-rotate-right'         => 'fa-rotate-right',
                      'icon-refresh'              => 'fa-refresh fa-spin',
                      'icon-list-alt'             => 'fa-list-alt',
                      'icon-lock'                 => 'fa-lock',
                      'icon-flag'                 => 'fa-flag',
                      'icon-headphones'           => 'fa-headphones',
                      'icon-volume-off'           => 'fa-volume-off',
                      'icon-volume-down'          => 'fa-volume-down',
                      'icon-volume-up'            => 'fa-volume-up',
                      'icon-qrcode'               => 'fa-qrcode',
                      'icon-barcode'              => 'fa-barcode',
                      'icon-tag'                  => 'fa-tag',
                      'icon-tags'                 => 'fa-tags',
                      'icon-book'                 => 'fa-book',
                      'icon-bookmark'             => 'fa-bookmark',
                      'icon-print'                => 'fa-print',
                      'icon-camera'               => 'fa-camera',
                      'icon-font'                 => 'fa-font',
                      'icon-bold'                 => 'fa-bold',
                      'icon-italic'               => 'fa-italic',
                      'icon-text-height'          => 'fa-text-height',
                      'icon-text-width'           => 'fa-text-width',
                      'icon-align-left'           => 'fa-align-left',
                      'icon-align-center'         => 'fa-align-center',
                      'icon-align-right'          => 'fa-align-right',
                      'icon-align-justify'        => 'fa-align-justify',
                      'icon-list'                 => 'fa-list',
                      'icon-outdent'              => 'fa-outdent',
                      'icon-indent'               => 'fa-indent',
                      'icon-video-camera'         => 'fa-video-camera',
                      'icon-picture-o'            => 'fa-picture-o',
                      'icon-pencil'               => 'fa-pencil',
                      'icon-map-marker'           => 'fa-map-marker',
                      'icon-adjust'               => 'fa-adjust',
                      'icon-tint'                 => 'fa-tint',
                      'icon-edit'                 => 'fa-edit',
                      'icon-share-square-o'       => 'fa-share-square-o',
                      'icon-check-square-o'       => 'fa-check-square-o',
                      'icon-arrows'               => 'fa-arrows',
                      'icon-step-backward'        => 'fa-step-backward',
                      'icon-fast-backward'        => 'fa-fast-backward',
                      'icon-backward'             => 'fa-backward',
                      'icon-play'                 => 'fa-play',
                      'icon-pause'                => 'fa-pause',
                      'icon-stop'                 => 'fa-stop',
                      'icon-forward'              => 'fa-forward',
                      'icon-fast-forward'         => 'fa-fast-forward',
                      'icon-step-forward'         => 'fa-step-forward',
                      'icon-eject'                => 'fa-eject',
                      'icon-chevron-left'         => 'fa-chevron-left',
                      'icon-chevron-right'        => 'fa-chevron-right',
                      'icon-plus-circle'          => 'fa-plus-circle',
                      'icon-minus-circle'         => 'fa-minus-circle',
                      'icon-times-circle'         => 'fa-times-circle',
                      'icon-check-circle'         => 'fa-check-circle',
                      'icon-question-circle'      => 'fa-question-circle',
                      'icon-info-circle'          => 'fa-info-circle',
                      'icon-crosshairs'           => 'fa-crosshairs',
                      'icon-times-circle-o'       => 'fa-times-circle-o',
                      'icon-check-circle-o'       => 'fa-check-circle-o',
                      'icon-ban'                  => 'fa-ban',
                      'icon-arrow-left'           => 'fa-arrow-left',
                      'icon-arrow-left'           => 'fa-arrow-left',
                      'icon-arrow-right'          => 'fa-arrow-right',
                      'icon-arrow-up'             => 'fa-arrow-up',
                      'icon-arrow-down'           => 'fa-arrow-down',
                      'icon-share'                => 'fa-share',
                      'icon-expand'               => 'fa-expand',
                      'icon-compress'             => 'fa-compress',
                      'icon-plus'                 => 'fa-plus',
                      'icon-minus'                => 'fa-minus',
                      'icon-asterisk'             => 'fa-asterisk',
                      'icon-exclamation-circle'   => 'fa-exclamation-circle',
                      'icon-gift'                 => 'fa-gift',
                      'icon-leaf'                 => 'fa-leaf',
                      'icon-fire'                 => 'fa-fire',
                      'icon-eye'                  => 'fa-eye',
                      'icon-eye-slash'            => 'fa-eye-slash',
                      'icon-warning'              => 'fa-warning',
                      'icon-plane'                => 'fa-plane',
                      'icon-calendar'             => 'fa-calendar',
                      'icon-random'               => 'fa-random',
                      'icon-comment'              => 'fa-comment',
                      'icon-magnet'               => 'fa-magnet',
                      'icon-chevron-up'           => 'fa-chevron-up',
                      'icon-chevron-down'         => 'fa-chevron-down',
                      'icon-retweet'              => 'fa-retweet',
                      'icon-shopping-cart'        => 'fa-shopping-cart',
                      'icon-folder'               => 'fa-folder',
                      'icon-folder-open'          => 'fa-folder-open',
                      'icon-arrows-v'             => 'fa-arrows-v',
                      'icon-arrows-h'             => 'fa-arrows-h',
                      'icon-bar-chart-o'          => 'fa-bar-chart-o',
                      'icon-twitter-square'       => 'fa-twitter-square',
                      'icon-facebook-square'      => 'fa-facebook-square',
                      'icon-camera-retro'         => 'fa-camera-retro',
                      'icon-key'                  => 'fa-key',
                      'icon-gears'                => 'fa-gears',
                      'icon-comments'             => 'fa-comments',
                      'icon-thumbs-o-up'          => 'fa-thumbs-o-up',
                      'icon-thumbs-o-down'        => 'fa-thumbs-o-down',
                      'icon-heart-o'              => 'fa-heart-o',
                      'icon-sign-out'             => 'fa-sign-out',
                      'icon-linkedin-square'      => 'fa-linkedin-square',
                      'icon-thumb-tack'           => 'fa-thumb-tack',
                      'icon-external-link'        => 'fa-external-link',
                      'icon-sign-in'              => 'fa-sign-in',
                      'icon-trophy'               => 'fa-trophy',
                      'icon-github-square'        => 'fa-github-square',
                      'icon-upload'               => 'fa-upload',
                      'icon-lemon-o'              => 'fa-lemon-o ',
                      'icon-phone'                => 'fa-phone',
                      'icon-square-o'             => 'fa-square-o',
                      'icon-bookmark-o'           => 'fa-bookmark-o',
                      'icon-phone-square'         => 'fa-phone-square',
                      'icon-twitter'              => 'fa-twitter',
                      'icon-facebook'             => 'fa-facebook',
                      'icon-github'               => 'fa-github',
                      'icon-unlock'               => 'fa-unlock',
                      'icon-credit-card'          => 'fa-credit-card',
                      'icon-rss'                  => 'fa-rss',
                      'icon-hdd-o'                => 'fa-hdd-o',
                      'icon-bullhorn'             => 'fa-bullhorn',
                      'icon-bell'                 => 'fa-bell',
                      'icon-certificate'          => 'fa-certificate',
                      'icon-hand-o-right'         => 'fa-hand-o-right',
                      'icon-hand-o-left'          => 'fa-hand-o-left',
                      'icon-hand-o-up'            => 'fa-hand-o-up',
                      'icon-hand-o-down'          => 'fa-hand-o-down',
                      'icon-arrow-circle-left'    => 'fa-arrow-circle-left',
                      'icon-arrow-circle-right'   => 'fa-arrow-circle-right',
                      'icon-arrow-circle-up'      => 'fa-arrow-circle-up',
                      'icon-arrow-circle-down'    => 'fa-arrow-circle-down',
                      'icon-globe'                => 'fa-globe',
                      'icon-wrench'               => 'fa-wrench',
                      'icon-tasks'                => 'fa-tasks',
                      'icon-filter'               => 'fa-filter',
                      'icon-briefcase'            => 'fa-briefcase',
                      'icon-arrows-alt'           => 'fa-arrows-alt',
                      'icon-group'                => 'fa-group',
                      'icon-link'                 => 'fa-link',
                      'icon-cloud'                => 'fa-cloud',
                      'icon-flask'                => 'fa-flask',
                      'icon-cut'                  => 'fa-cut',
                      'icon-files-o'              => 'fa-files-o',
                      'icon-paperclip'            => 'fa-paperclip',
                      'icon-save'                 => 'fa-save',
                      'icon-bars'                 => 'fa-bars',
                      'icon-list-ul'              => 'fa-list-ul',
                      'icon-list-ol'              => 'fa-list-ol',
                      'icon-strikethrough'        => 'fa-strikethrough',
                      'icon-underline'            => 'fa-underline',
                      'icon-table'                => 'fa-table',
                      'icon-magic'                => 'fa-magic',
                      'icon-truck'                => 'fa-truck',
                      'icon-pinterest'            => 'fa-pinterest',
                      'icon-pinterest-square'     => 'fa-pinterest-square',
                      'icon-google-plus-square'   => 'fa-google-plus-square',
                      'icon-google-plus'          => 'fa-google-plus',
                      'icon-money'                => 'fa-money',
                      'icon-caret-down'           => 'fa-caret-down',
                      'icon-caret-up'             => 'fa-caret-up',
                      'icon-caret-left'           => 'fa-caret-left',
                      'icon-caret-right'          => 'fa-caret-right',
                      'icon-columns'              => 'fa-columns',
                      'icon-sort'                 => 'fa-sort',
                      'icon-sort-asc'             => 'fa-sort-asc',
                      'icon-sort-desc'            => 'fa-sort-desc',
                      'icon-envelope'             => 'fa-envelope',
                      'icon-linkedin'             => 'fa-linkedin',
                      'icon-undo'                 => 'fa-undo',
                      'icon-gavel'                => 'fa-gavel',
                      'icon-tachometer'           => 'fa-tachometer',
                      'icon-comment-o'            => 'fa-comment-o',
                      'icon-comments-o'           => 'fa-comments-o',
                      'icon-bolt'                 => 'fa-bolt',
                      'icon-sitemap'              => 'fa-sitemap',
                      'icon-umbrella'             => 'fa-umbrella',
                      'icon-clipboard'            => 'fa-clipboard',
                      'icon-lightbulb-o'          => 'fa-lightbulb-o',
                      'icon-exchange'             => 'fa-exchange',
                      'icon-cloud-download'       => 'fa-cloud-download',
                      'icon-cloud-upload'         => 'fa-cloud-upload',
                      'icon-user-md'              => 'fa-user-md',
                      'icon-stethoscope'          => 'fa-stethoscope',
                      'icon-suitcase'             => 'fa-suitcase',
                      'icon-bell-o'               => 'fa-bell-o',
                      'icon-coffee'               => 'fa-coffee',
                      'icon-cutlery'              => 'fa-cutlery',
                      'icon-file-text-o'          => 'fa-file-text-o',
                      'icon-building-o'           => 'fa-building-o',
                      'icon-hospital-o'           => 'fa-hospital-o',
                      'icon-ambulance'            => 'fa-ambulance',
                      'icon-medkit'               => 'fa-medkit',
                      'icon-fighter-jet'          => 'fa-fighter-jet',
                      'icon-beer'                 => 'fa-beer',
                      'icon-h-square'             => 'fa-h-square',
                      'icon-plus-square'          => 'fa-plus-square',
                      'icon-angle-double-left'    => 'fa-angle-double-left',
                      'icon-angle-double-right'   => 'fa-angle-double-right',
                      'icon-angle-double-up'      => 'fa-angle-double-up',
                      'icon-angle-double-down'    => 'fa-angle-double-down',
                      'icon-angle-left'           => 'fa-angle-left',
                      'icon-angle-right'          => 'fa-angle-right',
                      'icon-angle-up'             => 'fa-angle-up',
                      'icon-angle-down'           => 'fa-angle-down',
                      'icon-desktop'              => 'fa-desktop',
                      'icon-laptop'               => 'fa-laptop',
                      'icon-tablet'               => 'fa-tablet',
                      'icon-mobile-phone'         => 'fa-mobile-phone',
                      'icon-circle-o'             => 'fa-circle-o',
                      'icon-quote-left'           => 'fa-quote-left',
                      'icon-quote-right'          => 'fa-quote-right',
                      'icon-spinner'              => 'fa-spinner fa-spin',
                      'icon-circle'               => 'fa-circle',
                      'icon-reply'                => 'fa-reply',
                      'icon-github-alt'           => 'fa-github-alt',
                      'icon-folder-o'             => 'fa-folder-o',
                      'icon-folder-open-o'        => 'fa-folder-open-o',
                      'icon-smile-o'              => 'fa-smile-o',
                      'icon-frown-o'              => 'fa-frown-o',
                      'icon-meh-o'                => 'fa-meh-o',
                      'icon-gamepad'              => 'fa-gamepad',
                      'icon-keyboard-o'           => 'fa-keyboard-o',
                      'icon-flag-o'               => 'fa-flag-o',
                      'icon-flag-checkered'       => 'fa-flag-checkered',
                      'icon-terminal'             => 'fa-terminal',
                      'icon-code'                 => 'fa-code',
                      'icon-reply-all'            => 'fa-reply-all',
                      'icon-star-half-o'          => 'fa-star-half-o',
                      'icon-location-arrow'       => 'fa-location-arrow',
                      'icon-crop'                 => 'fa-crop',
                      'icon-code-fork'            => 'fa-code-fork',
                      'icon-unlink'               => 'fa-unlink',
                      'icon-question'             => 'fa-question',
                      'icon-info'                 => 'fa-info',
                      'icon-exclamation'          => 'fa-exclamation',
                      'icon-superscript'          => 'fa-superscript',
                      'icon-subscript'            => 'fa-subscript',
                      'icon-eraser'               => 'fa-eraser',
                      'icon-puzzle-piece'         => 'fa-puzzle-piece',
                      'icon-microphone'           => 'fa-microphone',
                      'icon-microphone-slash'     => 'fa-microphone-slash',
                      'icon-shield'               => 'fa-shield',
                      'icon-calendar-o'           => 'fa-calendar-o',
                      'icon-fire-extinguisher'    => 'fa-fire-extinguisher',
                      'icon-rocket'               => 'fa-rocket',
                      'icon-maxcdn'               => 'fa-maxcdn',
                      'icon-chevron-circle-left'  => 'fa-chevron-circle-left',
                      'icon-chevron-circle-right' => 'fa-chevron-circle-right',
                      'icon-chevron-circle-up'    => 'fa-chevron-circle-up',
                      'icon-chevron-circle-down'  => 'fa-chevron-circle-down',
                      'icon-html5'                => 'fa-html5',
                      'icon-css3'                 => 'fa-css3',
                      'icon-anchor'               => 'fa-anchor',
                      'icon-unlock-alt'           => 'fa-unlock-alt',
                      'icon-bullseye'             => 'fa-bullseye',
                      'icon-ellipsis-h'           => 'fa-ellipsis-h',
                      'icon-ellipsis-v'           => 'fa-ellipsis-v',
                      'icon-rss-square'           => 'fa-rss-square',
                      'icon-play-circle'          => 'fa-play-circle',
                      'icon-ticket'               => 'fa-ticket',
                      'icon-minus-square'         => 'fa-minus-square',
                      'icon-minus-square-o'       => 'fa-minus-square-o',
                      'icon-level-up'             => 'fa-level-up',
                      'icon-level-down'           => 'fa-level-down',
                      'icon-check-square'         => 'fa-check-square',
                      'icon-pencil-square'        => 'fa-pencil-square',
                      'icon-external-link-square' => 'fa-external-link-square',
                      'icon-share-square'         => 'fa-share-square',
                      'icon-compass'              => 'fa-compass',
                      'icon-toggle-down'          => 'fa-toggle-down',
                      'icon-toggle-up'            => 'fa-toggle-up',
                      'icon-toggle-right'         => 'fa-toggle-right',
                      'icon-toggle-left'          => 'fa-toggle-left',
                      'icon-euro'                 => 'fa-euro',
                      'icon-gbp'                  => 'fa-gbp',
                      'icon-dollar'               => 'fa-dollar',
                      'icon-rupee'                => 'fa-rupee',
                      'icon-cny'                  => 'fa-cny',
                      'icon-ruble'                => 'fa-ruble',
                      'icon-won'                  => 'fa-won',
                      'icon-bitcoin'              => 'fa-bitcoin',
                      'icon-file'                 => 'fa-file',
                      'icon-file-text'            => 'fa-file-text',
                      'icon-sort-alpha-asc'       => 'fa-sort-alpha-asc',
                      'icon-sort-alpha-desc'      => 'fa-sort-alpha-desc',
                      'icon-sort-amount-asc'      => 'fa-sort-amount-asc',
                      'icon-sort-amount-desc'     => 'fa-sort-amount-desc',
                      'icon-sort-numeric-asc'     => 'fa-sort-numeric-asc',
                      'icon-sort-numeric-desc'    => 'fa-sort-numeric-desc',
                      'icon-thumbs-up'            => 'fa-thumbs-up',
                      'icon-thumbs-down'          => 'fa-thumbs-down',
                      'icon-youtube-square'       => 'fa-youtube-square',
                      'icon-youtube'              => 'fa-youtube',
                      'icon-xing'                 => 'fa-xing',
                      'icon-xing-square'          => 'fa-xing-square',
                      'icon-youtube-play'         => 'fa-youtube-play',
                      'icon-dropbox'              => 'fa-dropbox',
                      'icon-stack-overflow'       => 'fa-stack-overflow',
                      'icon-instagram'            => 'fa-instagram',
                      'icon-flickr'               => 'fa-flickr',
                      'icon-adn'                  => 'fa-adn',
                      'icon-bitbucket'            => 'fa-bitbucket',
                      'icon-bitbucket-square'     => 'fa-bitbucket-square',
                      'icon-tumblr'               => 'fa-tumblr',
                      'icon-tumblr-square'        => 'fa-tumblr-square',
                      'icon-long-arrow-down'      => 'fa-long-arrow-down',
                      'icon-long-arrow-up'        => 'fa-long-arrow-up',
                      'icon-long-arrow-left'      => 'fa-long-arrow-left',
                      'icon-long-arrow-right'     => 'fa-long-arrow-right',
                      'icon-apple'                => 'fa-apple',
                      'icon-windows'              => 'fa-windows',
                      'icon-android'              => 'fa-android',
                      'icon-linux'                => 'fa-linux',
                      'icon-dribbble'             => 'fa-dribbble',
                      'icon-skype'                => 'fa-skype',
                      'icon-foursquare'           => 'fa-foursquare',
                      'icon-trello'               => 'fa-trello',
                      'icon-female'               => 'fa-female',
                      'icon-male'                 => 'fa-male',
                      'icon-gittip'               => 'fa-gittip',
                      'icon-sun-o'                => 'fa-sun-o',
                      'icon-moon-o'               => 'fa-moon-o',
                      'icon-archive'              => 'fa-archive',
                      'icon-bug'                  => 'fa-bug',
                      'icon-vk'                   => 'fa-vk',
                      'icon-weibo'                => 'fa-weibo',
                      'icon-renren'               => 'fa-renren',
                      'icon-pagelines'            => 'fa-pagelines',
                      'icon-stack-exchange'       => 'fa-stack-exchange',
                      'icon-arrow-circle-o-right' => 'fa-arrow-circle-o-right',
                      'icon-arrow-circle-o-left'  => 'fa-arrow-circle-o-left',
                      'icon-dot-circle-o'         => 'fa-dot-circle-o',
                      'icon-wheelchair'           => 'fa-wheelchair',
                      'icon-vimeo-square'         => 'fa-vimeo-square',
                      'icon-turkish-lira'         => 'fa-turkish-lira',
                      'icon-plus-square-o'        => 'fa-plus-square-o'
                    )

                ),
                'size' => array(
                    'type'  => 'select',
                    'label' => __( 'Icon Size', 'tkingdom' ),
                    'desc'  => __( 'Select icon size', 'tkingdom' ),
                    'options' => array(
                        'none'        =>'Select Icon Size',
                        'tiny'        => 'Tiny',
                        'extra-small' => 'Extra Small',
                        'small'       => 'Small',
                        'medium'      => 'Medium',
                        'large'       => 'Large',
                        'extra-large' => 'Extra Large',
                    )
                ),
                'url' => array(
                    'std'   => '',
                    'type'  => 'text',
                    'label' => __( 'Icon URL', 'tkingdom' ),
                    'desc'  => 'example: http://www.themeskingdom.com',
                    'options' => array(
                        'width' => '98px'
                    )
                ),

             )
        );


