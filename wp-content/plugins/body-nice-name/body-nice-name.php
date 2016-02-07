<?php
/*
Plugin Name: body-nice-name
Plugin URI: https://css-tricks.com/snippets/wordpress/add-category-name-body_class/
Description: Add Category Name to body_class
Author: CHRIS COYIER
Version: 1
Author URI: https://css-tricks.com
*/

add_filter('body_class','add_category_to_single');

function add_category_to_single($classes) {
  if (!is_admin() && is_single() ) {
    global $post;
    foreach((get_the_category($post->ID)) as $category) {
      // add category slug to the $classes array
      $classes[] = $category->category_nicename;
    }
  }
  // return the $classes array
  return $classes;
}

?>