<?php

//~ returns two scafolding classes
function EasyView_b2046_scafolding($value, $custom_class){ // custom_class will come with when will work the multi input
	$out = array('','');
	if(isset($value)){
		 if ($value == '1'){
			 //~ Hard definied just for now
			 $out[0] = 'row';
			 $out[1] = 'span12';
		}elseif($value == '2'){
			$out[0] = '';
			$out[1] = 'row';
		}
	}else{
			$out[0] = '';
			$out[1] = '';
	}
	return $out;
}


//~ 
//~ 
//~ ONTROL FUNCTIONS - creates front end content
//~ EasyControl_*
//~

 //~ change number of posts to be seen 
function EasyControl_b2046_post_number($default_query, $values){
	$output = $default_query;
		$args = array(
			'posts_per_page' => $values
		);
		//~ rewrite the default data with our own
		$output = $args;
	return $output;
}

//~ offset posts
function EasyControl_b2046_post_offset($default_query, $values){
	$output = $default_query;
		$args = array(
			'offset' => $values
		);
		//~ rewrite the default data with our own
		$output = $args;
	return $output;
}

//~ Change post type
function EasyControl_b2046_post_type($default_query, $values){
	$output = $default_query;
		$args = array(
			'post_type' => $values
		);
		//~ rewrite the default data with our own
		$output =  $args;
	return $output;
}
//~  post status
function EasyControl_b2046_post_status($default_query, $values){
	$output = $default_query;
		$args = array(
			'post_status' => $values
		);
		//~ rewrite the default data with our own
		$output =  $args;
	return $output;
}
//~ category control
function EasyControl_b2046_category_controls($default_query, $values){
	$output = $default_query;
	$control = $values[0];
	$cats = $values[1];
	if($control == 'cat'){
		$putre_cat_ids = Easy_2046_builder::f2046_id_cleaner_to_string($cats);
	}else{
		$putre_cat_ids = Easy_2046_builder::f2046_id_cleaner_to_array($cats);
	}
	$args = array(
		$control => $putre_cat_ids
	);
	//~ rewrite the default data with our own
	$output =  $args;
	return $output;
}


//~ 
//~ 
//~ VIEW FUNCTIONS - creates front end content
//~ EasyView_*
//~ 

//~ This extension si to build the title of the desired object
function EasyView_b2046_post_title($post_id, $values){
	$link = $values[0];
	$scafold = $values[1];
	$class = $values[2]; 
	$out = '';

	if($scafold != '0'){
		$out .= '<'.$scafold.' class="'.$class.'">';
	}
	
	if($link == 0){
		$out .= get_the_title($post_id);
	}else{
		$out .= '<a href="'.get_permalink($post_id).'">'.get_the_title($post_id).'</a>';
	}
	
	if($scafold !='0'){
		$out .= '</'.$scafold.'>';
	}
			
	return $out;
}

//~ This extension si to build contet or excerpt,...
function EasyView_b2046_post_content($post_id, $values){
	$content_type = $values[0];
	$class = $values[1];
	$out = '<div class="entry-content '.$class.'">';
	if($content_type == 'content'){
			$out .= apply_filters('the_content',get_the_content());
	}
	else{
			$out .= get_the_excerpt();
	}
	$out .= '</div>';
	return $out;
}
//~ List post categories
function EasyView_b2046_post_categories($post_id, $values){
	$cat_count = $values[1];
	$class = $values[2];
	$post_categories = wp_get_post_categories( $post_id );
	$cats = array();
	$out = '';
	if($values[0] == 0){
		if(!empty($class)){
			$out .='<div class="'.$class.'">';
		}
		foreach($post_categories as $c){
			$cat = get_category( $c );
			if($cat_count == 1){
				$count = ' ('.$cat->count.')';
			}
			$cat_link = get_category_link($c);
			$cat_name = $cat->name;
			$out .= '<a href="'.$cat_link.'">'.$cat->name.'</a>'.$count;
			if (end($post_categories) != $c){
				$out .= ', ';
				}
		}
		if(!empty($class)){
			$out .='</div>';
		}
	}else{
		$out .= '<ul class="'.$class.'">';
		foreach($post_categories as $c){
			$cat = get_category( $c );
			if($cat_count == 1){
				$count = ' ('.$cat->count.')';
			}
			
			$cat_link = get_category_link($c);
			$out .= '<li class="'.$cat->category_nicename.'"><a href="'.$cat_link.'">'.$cat->name.'</a>'.$count.'</li>';
		}
		$out .='</ul>';
		}
	return $out;
}

//~ edit link
function EasyView_b2046_edit_link($post_id, $values){
	$value = $values[0];
	$class = $values[1];
	$out = '';
		$link =  get_edit_post_link($post_id);
		if($value == 0){
			$out = '<a class="edit_link '.$class.'" href="'.$link.'">'.__('Edit').'</a>';
		}else{
			$out = '<span class="edit_link '.$class.'"><a href="'.$link.'">'.__('Edit').'</a> '.$post_id.'</span>';
		}
	return $out;
}

//~ get images
//~ 
function EasyView_b2046_post_image($post_id, $values){
	$image = $values[0];
	$link = $values[1];
	$class = $values[2];
	$out = '';
	$att_id =get_post_thumbnail_id($post_id);
	
	if($link == 'objectlink'){
		$url = get_permalink($post_id);
	}elseif($link != 'objectlink' || $link != 'nolink'){
		$img_obj = wp_get_attachment_image_src( $att_id, $link);
		$url = $img_obj[0];
	}
	
	if(!empty($att_id)){
		$image_url = wp_get_attachment_image_src( $att_id, $image);
		if(!empty($class)){
			$out .= '<div class="'.$class.'">';
		}
		if($link != 'nolink'){
			$out .= '<a href="'.$url.'">';
		}
		
		$out .= '<img src="'.$image_url[0].'" alt="'.get_the_title($post_id).'" />';
		
		if($link != 'nolink'){
			$out .= '</a>';
		}
		if(!empty($class)){
			$out .= '</div>';
		}
	}
	return $out;
}

//~ 
//~ custom meta data
//~ 
function EasyView_b2046_object_meta($post_id, $values){
	$out = '';
	$show_as = $values[0];
	$meta_key = $values[1];
	//~ $meta_val = $values[2];
	$separator = $values[2];
	$class = $values[3];
	
	//~ $post_meta_keys = get_post_custom_keys($post_id);
	$post_meta_values = get_post_custom_values($meta_key, $post_id);
	if(!empty($post_meta_values)){
		//~ show as raw text
		if($show_as == 0){
			$out .= '<div class="'.$class.'">';
			foreach ( $post_meta_values as $key) {
				$out .= $key; 
				$out .= $separator;
			}
			$out .= '</div>';
		}
		//~ show as link to archives
		else{
			$out .='<ul class="'.$class.'">';
			foreach ($post_meta_values as $key) {
				$out .= '<li class="'.$meta_key.'">'.$key.'</li>'; 
				$out .= $separator;
			}
			$out .= '</ul>';
		}
		
	}
	
	return $out;
}

//~ 
//~ Simple text
//~ 
function EasyView_b2046_textfield($post_id, $values){
	$value = $values[0];
	$class = $values[1];
	$out = '';
		if(!empty($value) && !empty($class)){
			$out .= '<div class="'.$class.'">'.$value.'</div>';
		}elseif(!empty($value)){
			$out .= $value;
		}
	return $out;
}

//~ 
//~ Shortcode 
//~ 

function EasyView_b2046_shortcode($post_id, $values){
	$value = $values[0];
	$class = $values[1];
	$out = '';
		if(!empty($value) && !empty($class)){
			$out .= '<div class="'.$class.'">'.do_shortcode($value).'</div>';
		}elseif(!empty($value)){
			$out .= do_shortcode($value);
		}
	return $out;
}

//~ 
//~ Comments number
//~ 

function EasyView_b2046_comments_number($post_id, $values){
	$class = $values[0];
	$out = '';
		if(!empty($value) && !empty($class)){
			$out .= '<div class="'.$class.'">'.get_comments_number($post_id).'</div>';
		}elseif(!empty($value)){
			$out .= get_comments_number($post_id);
		}
	return $out;
}

//~ 
//~ Comments number
//~ 

function EasyView_b2046_comments_template($post_id, $values){
	$class = $values[0];
	$out = '';
		if(!empty($class)){
			$out .= '<div class="'.$class.'">'.comments_template().'</div>';
		}else{
			$out .= comments_template();
			
		}
	return $out;
}
//~ 
//~ Permissions
//~ 

function EasyControl_b2046_general_visibility($post_id, $values){
	$out = array();
		$out = $values;
	return $out;
}
