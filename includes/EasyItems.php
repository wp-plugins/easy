<?php 

// item is build out off
// 'id' => (array('actual values'), array('possible values'))

// ------------------------------------------------------------------- // 
//                   declare some variations first
// ------------------------------------------------------------------- // 

// specify the roles
$levels = array( 
	'all' => __('Anyone') ,
	'level_0' => __('Subcriber'),
	'level_1' => __('Contributor'),
	'level_4' => __('Author'),
	'level_7' => __('Editor'),
	'level_10' => __('Administrator')
	);

// get all public post types
$args_types=array(
	'public'	=> true, // publicaly visible
	//'_builtin' => false, // only not built in
	//'capability_type' => 'post' // and only types of post
); 

//~ get all post types
$post_types = get_post_types($args_types,'objects'); 
$post_types_allowed = array();
$i = 0;
foreach($post_types as $post_t){
	$choices = array(
				'ui_type' => 'check_box', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => array($post_t->name => $post_t->labels->singular_name),
				'esc' => 'stip_tags',
				'value' => ''
			);
	$post_types_allowed[$i] = $choices;
	$i++;
}

// object title choices
$object_title_choices =array(
	'0' => __('no link'),
	'1' => __('Link to "post"')
);
// Object title extrension choices
$object_tiitle_extension_choices = array(
	'h1' => 'h1',
	'h2' => 'h2',
	'h3' => 'h3',
	'h4' => 'h4',
	'h5' => 'h5',
);
// Specify scafolding type tpes
$scafolding_types =array(
	'0' => __('Default scaffolding'),
	'1' => __('One per row'),
	'2' => __('Many per row')
	); // default, one per row, many per row
	
$content_choices = array(
	'content'=>'content',
	'excerpt'=>'excerpt'
);

//~ 
//~ show categories as
//~
$show_post_categories = array(
	'0' => 'links',
	'1' => 'list'
);

//~ 
//~ get images
//~ 

$intermediate_image_sizes = get_intermediate_image_sizes();
$list_of_image_sizes = array();
foreach($intermediate_image_sizes as $key){
	$list_of_image_sizes[$key] = $key;
}
// ------------------------------------------------------------------- // 
//                         Build the VIEW array
// ------------------------------------------------------------------- // 
$EasyItems = array(
	// who can see the vidget on the front end
	'b2046_general_visibility' => array( 
		// general
		'id' => 0,
		'position' => 2,
		'block' => 'control', // 0 = general, 1 = view, 2 = logic 
		'item_title' => __('Permissions','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Who will be able to see the widget result.','p_2046s_easy_widget'),
				'ui_type' => 'select_box', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea. 6 hidden
				'choices' => $levels,
				'value' => '',
				'esc' => 'stip_tags'
			)
		),
	),
	// post_types
	'b2046_post_type' => array(
		'id' => 0,
		'position' => 1,
		'block' => 'control', // 0 = general, 1 = view, 2 = logic 
		'item_title' => __('Post type','p_2046s_easy_widget'),
		// gui
		'gui' => $post_types_allowed
	),
	// scaffolding
	'b2046_scafolding' => array(
		'id' => 0,
		'position' => 4,
		'block' => 'general', // 0 = general, 1 = view, 2 = logic 
		'item_title' => __('Scafolding','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Select type','p_2046s_easy_widget'),
				'ui_type' => 'select_box', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => $scafolding_types,
				'value' => $scafolding_types[0],
				'esc' => 'stip_tags'
			)
		)
	),
	// widget title
	'b2046_title' => array(
		'id' => '0',
		'position' => 0,
		'block' => 'general', // 0 = general, 1 = view, 2 = logic 
		'item_title' => __('Widget title','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Admin widget title', 'p_2046s_easy_widget'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' => '',
				'esc' => 'stip_tags'
			)
		),
		'w_title' => '',  // this extra parametr tells the input builder to put in the element additional id
	),
	// widget note
	'b2046_note' => array(
		'id' => 0,
		'position' => 4,
		'block' => 'general', // 0 = general, 1 = view, 2 = logic 
		'item_title' => __('Widget description','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Widget intention. Used for administrative purpose.', 'p_2046s_easy_widget'),
				'ui_type' => 'textarea', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' => '',
				'esc' => 'stip_tags'
			)
		)
	),
	// Object title
	// TODO : html H*
	
	'b2046_post_title' => array(
		'id' => 0,
		'position' => 1,
		'block' => 'view', // 0 = general, 1 = view, 2 = logic 
		'item_title' => __('Title','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_type' => 'select_box', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea, hidden
				'esc' => 'stip_tags',
				'choices' => $object_title_choices,
				'value' => $object_title_choices[0]
			),
			array(
				'ui_type' => 'select_box', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea, hidden
				'esc' => 'stip_tags',
				'choices' => $object_tiitle_extension_choices,
				'value' => $object_tiitle_extension_choices['h1']
			),
			array(
				'ui_note' => __('class', 'p_2046s_easy_widget'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea, hidden
				'esc' => 'stip_tags',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_post_content' => array(
		'id' => 0,
		'position' => 1,
		'block' => 'view', // 0 = general, 1 = view, 2 = logic 
		'item_title' => __('Content','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_type' => 'select_box', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea, hidden
				'esc' => 'stip_tags',
				'choices' => $content_choices,
				'value' => $content_choices['content']
			),
			array(
				'ui_note' => __('class', 'p_2046s_easy_widget'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea, hidden
				'esc' => 'stip_tags',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_post_number' => array(
		'id' => 0,
		'position' => 1,
		'block' => 'control', // 0 = general, 1 = view, 2 = logic 
		'item_title' => __('Post number','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Number of objects.', 'p_2046s_easy_widget'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea, hidden
				'esc' => 'stip_tags',
				'choices' => '',
				'value' => '1'
			)
		)
	),
	'b2046_post_categories' => array(
		'id' => 0,
		'position' => 1,
		'block' => 'view', // 0 = general, 1 = view, 2 = logic 
		'item_title' => __('Post categories','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_type' => 'select_box', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea, hidden
				'esc' => 'stip_tags',
				'choices' => $show_post_categories,
				'value' => 0
			),
			array(
				'ui_note' => __('class', 'p_2046s_easy_widget'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea, hidden
				'esc' => 'stip_tags',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_post_image' => array(
		'id' => 0,
		'position' => 3,
		'block' => 'view', // 0 = general, 1 = view, 2 = logic 
		'item_title' => __('Image','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Get featured image.','p_2046s_easy_widget'),
				'ui_type' => 'select_box', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea, hidden
				'esc' => 'stip_tags',
				'choices' => $list_of_image_sizes,
				'value' => ''
			),
			array(
				'ui_note' => __('class', 'p_2046s_easy_widget'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea, hidden
				'esc' => 'stip_tags',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_edit_link' => array(
		'id' => 0,
		'position' => 3,
		'block' => 'view', // 0 = general, 1 = view, 2 = logic 
		'item_title' => __('Edit link','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_type' => 'select_box', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea, hidden
				'esc' => 'stip_tags',
				'choices' => array(
					'0' => 'Link',
					'1' => 'Link with ID'
				),
				'value' => 0
			),
			array(
				'ui_note' => __('class', 'p_2046s_easy_widget'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea, hidden
				'esc' => 'stip_tags',
				'choices' => '',
				'value' => ''
			)
		)
	),
	// 
	// Bricks is the storage for elements in charge. Both Views & Controls.
	// The data are stored in:
	// array (
	// 	'object_unique_name' => 'xyz',  // "post_title" or something
	// 	'position' => '0',
	// 	'value' => array() // the array of values as they where sorted in the default input array
	// 	)
	// 
	'b2046_bricks'=> array()
);

