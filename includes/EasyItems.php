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
$object_title_extension_choices = array(
	'0' => 'raw text',
	'h1' => 'h1',
	'h2' => 'h2',
	'h3' => 'h3',
	'h4' => 'h4',
	'h5' => 'h5',
	'div' => 'div'
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

$image_links = array(
	'nolink' => 'no link',
	'objectlink' => 'object link',
);
$image_links = array_merge($image_links, $list_of_image_sizes);

//~ 
//~ Meta show choices
//~ 
$meta_show_choices = array(
	'0' => 'text',
	'1' => 'list',
);
$post_statuses = array(
	'publish' => 'publish', //a published post or page.
	'pending' => 'pending', //post is pending review.
	'draft' => 'draft', //a post in draft status.
	'auto-draft' => 'auto-draft', //- a newly created post, with no content.
	'future' => 'future', //- a post to publish in the future.
	'private' =>'private', //- not visible to users who are not logged in.
	'inherit' => 'inherit', //- a revision. see get_children.
	'trash' => 'trash', //- post is in trashbin (available with Version 2.9).
	'any' => 'any'
);
//~ categoris control
$category_controls = array(
	'cat' => 'cat', //(int) - use category id.
	//~ 'category_name' => 'category_name', //(string) - use category slug (NOT name).
	'category__and' => 'category__and', //(array) - use category id.
	'category__in' => 'category__in', //(array) - use category id.
	'category__not_in' => 'category__not_in', // (array) - use category id.
);
// ------------------------------------------------------------------- // 
//                         Build the VIEW array
// ------------------------------------------------------------------- // 
$EasyItems = array(
	// category controls
	'b2046_category_controls' => array(
		'block' => 'control', // 0 = general, 1 = view, 2 = logic 
		'item_title' => __('Category','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Control by','p_2046s_easy_widget'),
				'ui_type' => 'select_box', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => $category_controls,
				'value' => 'cat',
				'esc' => 'stip_tags'
			),
			array(
				'ui_note' => __('cat IDs (separate by coma)', 'p_2046s_easy_widget'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' => '',
				'esc' => 'stip_tags'
			)
		)
	),
	// scaffolding
	'b2046_scafold_type' => array(
		'position' =>1,
		'block' => 'general', // 0 = general, 1 = view, 2 = logic 
		'item_title' => __('Surrounding widget scafold type','p_2046s_easy_widget'),
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
	// scaffolding
	'b2046_scafold_row_class' => array(
		'position' => 3,
		'block' => 'general', // 0 = general, 1 = view, 2 = logic 
		'item_title' => __('','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('row class', 'p_2046s_easy_widget'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' => '',
				'esc' => 'stip_tags'
			)
		)
	),
	// scaffolding
	'b2046_scafolding_column_class' => array(
		'position' => 4,
		'block' => 'general', // 0 = general, 1 = view, 2 = logic 
		'item_title' => __('','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('each (column) class', 'p_2046s_easy_widget'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' => '',
				'esc' => 'stip_tags'
			)
		)
	),
	// widget title
	'b2046_title' => array(
		'position' => 0,
		'block' => 'general', // 0 = general, 1 = view, 2 = logic 
		'item_title' => __('Name','p_2046s_easy_widget'),
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
		'position' => 2,
		'block' => 'general', // 0 = general, 1 = view, 2 = logic 
		'item_title' => __('Widget description','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Widget intention. Used for administrative purposes.', 'p_2046s_easy_widget'),
				'ui_type' => 'textarea', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' => '',
				'esc' => 'stip_tags'
			)
		)
	),
	// who can see the vidget on the front end
	'b2046_general_visibility' => array( 
		// general
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
		'block' => 'control', // 0 = general, 1 = view, 2 = logic 
		'item_title' => __('Post type','p_2046s_easy_widget'),
		// gui
		'gui' => $post_types_allowed
	),
	
	'b2046_post_title' => array(
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
				'ui_note' => __('Scafolding', 'p_2046s_easy_widget'),
				'ui_type' => 'select_box', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea, hidden
				'esc' => 'stip_tags',
				'choices' => $object_title_extension_choices,
				'value' => $object_title_extension_choices['h1']
			),
			array(
				'ui_note' => __('custom class', 'p_2046s_easy_widget'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea, hidden
				'esc' => 'stip_tags',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_post_content' => array(
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
	'b2046_post_offset' => array(
		'block' => 'control', // 0 = general, 1 = view, 2 = logic 
		'item_title' => __('Post offset','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Number', 'p_2046s_easy_widget'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea, hidden
				'esc' => 'stip_tags',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_post_status' => array(
		'block' => 'control', // 0 = general, 1 = view, 2 = logic 
		'item_title' => __('Post status','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_type' => 'select_box', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea, hidden
				'esc' => 'stip_tags',
				'choices' => $post_statuses,
				'value' => 'publish'
			)
		)
	),
	'b2046_post_categories' => array(
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
				'ui_type' => 'check_box', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea, hidden
				'esc' => 'stip_tags',
				'choices' => array(1 => __('Show count')),
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
				'ui_note' => __('Link image to','p_2046s_easy_widget'),
				'ui_type' => 'select_box', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea, hidden
				'esc' => 'stip_tags',
				'choices' => $image_links,
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
	'b2046_object_meta' => array(
		'block' => 'view', // 0 = general, 1 = view, 2 = logic 
		'item_title' => __('Meta','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Show as', 'p_2046s_easy_widget'),
				'ui_type' => 'select_box', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea, hidden
				'esc' => 'stip_tags',
				'choices' => $meta_show_choices,
				'value' => ''
			),
			array(
				'ui_note' => __('meta key', 'p_2046s_easy_widget'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea, hidden
				'esc' => 'stip_tags',
				'choices' => '',
				'value' => ''
			),
			//~ array(
				//~ 'ui_note' => __('meta value', 'p_2046s_easy_widget'),
				//~ 'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea, hidden
				//~ 'esc' => 'stip_tags',
				//~ 'choices' => '',
				//~ 'value' => ''
			//~ ),
			array(
				'ui_note' => __('separator', 'p_2046s_easy_widget'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea, hidden
				'esc' => 'stip_tags',
				'choices' => '',
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
	'b2046_textfield' => array(
		'block' => 'view', // 0 = general, 1 = view, 2 = logic 
		'item_title' => __('Text','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Some text', 'p_2046s_easy_widget'),
				'ui_type' => 'textarea', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' => '',
				'esc' => 'stip_tags'
			),
			array(
				'ui_note' => __('class', 'p_2046s_easy_widget'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea, hidden
				'esc' => 'stip_tags',
				'choices' => '',
				'value' => ''
			)
		),
		
	),
	'b2046_shortcode' => array(
		'block' => 'view', // 0 = general, 1 = view, 2 = logic 
		'item_title' => __('Shortcode','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('[shortcode]', 'p_2046s_easy_widget'),
				'ui_type' => 'textarea', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' => '',
				'esc' => 'stip_tags'
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
	'b2046_comments_number' => array(
		'block' => 'view', // 0 = general, 1 = view, 2 = logic 
		'item_title' => __('Comments number','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('class', 'p_2046s_easy_widget'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea, hidden
				'esc' => 'stip_tags',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_comments_template' => array(
		'block' => 'view', // 0 = general, 1 = view, 2 = logic 
		'item_title' => __('Comments','p_2046s_easy_widget'),
		// gui
		'gui' => array(
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

