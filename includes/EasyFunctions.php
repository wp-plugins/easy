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
		$output = array_merge($default_query, $args);;
	return $output;
}

//~ Change post type
function EasyControl_b2046_post_type($default_query, $values){
	$output = $default_query;
		mydump($values);
		$args = array(
			'post_type' => $values
		);
		//~ rewrite the default data with our own
		$output = array_merge($default_query, $args);;
	return $output;
}


//~ 
//~ 
//~ VIEW FUNCTIONS - creates front end content
//~ EasyView_*
//~ 

//~ This extension si to build the title of the desired object
function EasyView_b2046_post_title($post_id, $values){
	$out = '';
	if($values == 0){
			$out .= the_title('<h3>', '</h3>', false);
	}
	else{
			$out .= '<h3><a href="'.get_permalink($post_id).'">'.get_the_title($post_id).'</a></h3>';
	}
	return $out;
}

//~ This extension si to build contet or excerpt,...
function EasyView_b2046_post_content($post_id, $values){
	$out = '<div class="entry-content">';
	if($values == 'content'){
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
	$post_categories = wp_get_post_categories( $post_id );
	$cats = array();
	$out = '';
	if($values == 0){
		foreach($post_categories as $c){
			$cat = get_category( $c );
			$cat_link = get_category_link($c);
			$cat_name = $cat->name;
			$out .= '<a href="'.$cat_link.'">'.$cat->name.'</a>';
			if (end($post_categories) != $c){
				$out .= ', ';
				}
		}
	}else{
		$out .= '<ul>';
			foreach($post_categories as $c){
			$cat = get_category( $c );
			$cat_link = get_category_link($c);
			$cat_name = $cat->name;
			$out .= '<li><a href="'.$cat_link.'">'.$cat->name.'</a></li>';
		}
		$out .='</ul>';
		}
	return $out;
}

//~ edit link
function EasyView_b2046_edit_link($post_id, $values){
	$out = '';
		$link =  get_edit_post_link($post_id);
		if($values == 0){
			$out = '<a class="edit_link" href="'.$link.'"></a>';
		}else{
			$out = '<span class="edit_link"></span><a href="'.$link.'">'.__('Edit').'</a> '.$post_id.'</span>';
		}
	return $out;
}

//~ get images
//~ 
function EasyView_b2046_post_image($post_id, $values){
	$out = '';
	$att_id =get_post_thumbnail_id($post_id);
	if(!empty($att_id)){
		$image_url = wp_get_attachment_image_src( $att_id, $values);
		$out = '<img src="'.$image_url[0].'" alt="'.get_the_title($post_id).'" />';
	}
	return $out;
}


