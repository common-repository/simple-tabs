<?php
/*
Plugin Name: Simple Tabs
Plugin URI: http://www.gyanganit/plugins/simple-tabs.zip
Description:A Simple Accordion/tabs using wordpress custom post
Version: 1.0
Version: The Plugin's Version Number, e.g.: 1.0
Author: Renu Sharma
Author URI: http://indiainfotech.com
License: A "Slug" license name e.g. GPL2
*/

/*  Copyright 2012  Simple tabs - Renu Sharma (email : renu@indiainfotech.com)
 
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.
 
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
 
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
add_action('init', function(){
    $labels = array(
        'name' => _x('Simpletabs', 'post type general name'),
        'singular_name' => _x('Question', 'post type singular name'),
        'add_new' => _x('Add New Tab', 'Tab'),
        'add_new_item' => __('Add New Tab'),
        'edit_item' => __('Edit Tab'),
        'new_item' => __('New Tab'),
        'all_items' => __('All  Tabs'),
        'view_item' => __('View Tabs'),
        'search_items' => __('Search FAQ'),
        'not_found' => __('No Tab found'),
        'not_found_in_trash' => __('No Tab found in Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Simpletabs'

    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes')
    );
    register_post_type('Simpletabs', $args);
});
    wp_register_style('wptuts-jquery-ui-style', WP_PLUGIN_URL.'/simple-tabs/css/style-tabs.css');
    wp_enqueue_style('wptuts-jquery-ui-style');
	    wp_register_script('wptuts-custom-js', WP_PLUGIN_URL.'/simple-tabs/js/simple-tabs.js', array('jquery-ui-accordion'), '', true);
    wp_enqueue_script('wptuts-custom-js');
function  reg_simpletabs(){
}
add_shortcode('Simpletabs', function(){
    $posts = get_posts(array(
        'numberposts' => 10,
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'post_type' => 'Simpletabs',
    ));
    $faq = '<div class="container">'; ///Open the container
    foreach ( $posts as $post ){

        $tabs .= sprintf(('<h2 class="acc_trigger"><a href="">%1$s</a></h3><div class="acc_container">%2$s</div>'), // Generate the markup for each Question
            $post->post_title,
            wpautop($post->post_content)
        );
    }
    $tabs .= '</div>'; //Close the Container
    return $tabs; //Return the HTML
});
//add_action( 'after_setup_theme', 'purple_bellies_theme_setup', 11 );
register_activation_hook( __FILE__, 'reg_simpletabs' );