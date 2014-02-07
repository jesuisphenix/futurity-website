<?php 
register_nav_menus( array(
		'primary'   => __( 'Top primary menu', 'futurity pro' ),
		
	) );

add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );

$gallery_labels = array(
    'name' => _x('Portfolio', 'post type general name'),
    'singular_name' => _x('Element', 'post type singular name'),
    'add_new' => _x('Add New', 'gallery'),
    'add_new_item' => __("Add New Element"),
    'edit_item' => __("Edit Element"),
    'new_item' => __("New Element"),
    'view_item' => __("View Element"),
    'search_items' => __("Search Element"),
    'not_found' =>  __('No portfolio\'s found'),
    'not_found_in_trash' => __('No portfolio\'s found in Trash'), 
    'parent_item_colon' => ''
        
);
$gallery_args = array(
    'labels' => $gallery_labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    'hierarchical' => false,
    'menu_position' => null,
    'capability_type' => 'post',
    'supports' => array('title', 'excerpt', 'editor', 'thumbnail')
); 
register_post_type('Portfolio', $gallery_args);
if ( function_exists( 'add_theme_support')){
    add_theme_support( 'post-thumbnails' );
}

?>