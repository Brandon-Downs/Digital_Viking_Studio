<?php

// Buttons shortcode config
$col_shortcodes['button'] = array(
	'params' => array(
		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Button URL', 'framework'),
			'desc' => __('Add the button\'s url eg http://example.com', 'framework')
		),
		'style' => array(
			'type' => 'select',
			'label' => __('Button\'s Style', 'framework'),
			'desc' => __('Select the button\'s style, ie the buttons colour', 'framework'),
			'options' => array(
				'white' => 'White',
				'black' => 'Black',
				'green' => 'Green',
				'blue' => 'Blue',				
				'purple' => 'Purple',
				'red' => 'Red',
				'orange' => 'Orange',
				'gray' => 'Gray'					
			)
		),		
		'content' => array(
			'std' => 'Button Text',
			'type' => 'text',
			'label' => __('Button\'s Text', 'framework'),
			'desc' => __('Add the button\'s text', 'framework'),
		)
	),
	'shortcode' => '[button url="{{url}}" style="{{style}}"] {{content}} [/button]',
	'popup_title' => __('Insert Button Shortcode', 'framework')
);

// Alerts shortcode config
$col_shortcodes['alert'] = array(
	'params' => array(
		'style' => array(
			'type' => 'select',
			'label' => __('Alert\'s Style', 'framework'),
			'desc' => __('Select the slter\'s style, ie the alert colour', 'framework'),
			'options' => array(
				'blue' => 'Blue',
				'red' => 'Red',
				'yellow' => 'Yellow',
				'green' => 'Green'
			)
		),
		'content' => array(
			'std' => 'Your Alert!',
			'type' => 'textarea',
			'label' => __('Alert\'s Text', 'framework'),
			'desc' => __('Add the alert\'s text', 'framework'),
		)
		
	),
	'shortcode' => '[alert style="{{style}}"] {{content}} [/alert]',
	'popup_title' => __('Insert Alert Shortcode', 'framework')
);

// Toggle content shortcode config
$col_shortcodes['toggle'] = array(
	'params' => array(
		'title' => array(
			'type' => 'text',
			'label' => __('Toggle Content Title', 'framework'),
			'desc' => __('Add the title that will go above the toggle content', 'framework'),
			'std' => 'Title'
		),
		'content' => array(
			'std' => 'Content',
			'type' => 'textarea',
			'label' => __('Toggle Content', 'framework'),
			'desc' => __('Add the toggle content.', 'framework'),
		)
		
	),
	'shortcode' => '[toggle title="{{title}}"] {{content}} [/toggle]',
	'popup_title' => __('Insert Toggle Content Shortcode', 'framework')
);

// Tabs
$col_shortcodes['tabs'] = array(
    'params' => array(),
    'no_preview' => true,
    'shortcode' => '[tabs] {{child_shortcode}}  [/tabs]',
    'popup_title' => __('Insert Tabbed Shortcode', 'framework'),
    
    'child_shortcode' => array(
        'params' => array(
            'title' => array(
                'std' => '',
                'type' => 'text',
                'label' => __('Tab Title', 'framework'),
                'desc' => __('Title of the tab', 'framework'),
            ),
            'content' => array(
                'std' => '',
                'type' => 'textarea',
                'label' => __('Tab Content', 'framework'),
                'desc' => __('Add the tabs content', 'framework')
            )
        ),
        'shortcode' => '[tab title="{{title}}"] {{content}} [/tab]',
        'clone_button' => __('Add Tab', 'framework')
    )
);


// columns
$col_shortcodes['columns'] = array(
	'params' => array(),
	'shortcode' => ' {{child_shortcode}} ', // as there is no wrapper shortcode
	'popup_title' => __('Insert Columns Shortcode', 'framework'),
	'no_preview' => true,
	
	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'column' => array(
				'type' => 'select',
				'label' => __('Column Type', 'framework'),
				'desc' => __('Select the type, ie width of the column.', 'framework'),
				'options' => array(
					'one_third' => 'One Third',
					'one_third_last' => 'One Third Last',
					'two_third' => 'Two Thirds',
					'two_third_last' => 'Two Thirds Last',
					'one_half' => 'One Half',
					'one_half_last' => 'One Half Last',
					'one_fourth' => 'One Fourth',
					'one_fourth_last' => 'One Fourth Last',
					'three_fourth' => 'Three Fourth',
					'three_fourth_last' => 'Three Fourth Last',
					'one_fifth' => 'One Fifth',
					'one_fifth_last' => 'One Fifth Last',
					'two_fifth' => 'Two Fifth',
					'two_fifth_last' => 'Two Fifth Last',
					'three_fifth' => 'Three Fifth',
					'three_fifth_last' => 'Three Fifth Last',
					'four_fifth' => 'Four Fifth',
					'four_fifth_last' => 'Four Fifth Last',
					'one_sixth' => 'One Sixth',
					'one_sixth_last' => 'One Sixth Last',
					'five_sixth' => 'Five Sixth',
					'five_sixth_last' => 'Five Sixth Last'
				)
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __('Column Content', 'framework'),
				'desc' => __('Add the column content.', 'framework'),
			)
		),
		'shortcode' => '[{{column}}] {{content}} [/{{column}}] ',
		'clone_button' => __('Add Column', 'framework')
	)
);

?>