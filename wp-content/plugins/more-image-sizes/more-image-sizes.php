<?php
/*
Plugin Name: More Image Sizes
Plugin URI: wordpress codex
Description: widget
Author: wordpress codex
Version: 1
Author URI: https://wordpress.com

*/

    add_theme_support( 'post-thumbnails' );

    if ( function_exists( 'add_image_size' ) ) {
        add_image_size( 'medium', 1200, 1200); // width, height, crop
        add_image_size( 'large', 1800, 1800);
        add_image_size( 'xlarge', 2400, 2400);
        add_image_size( 'xxlarge', 3000, 3000);
    }

    add_filter('image_size_names_choose', 'my_image_sizes');

    function my_image_sizes($sizes) {
        $addsizes = array(
            'medium' => __( 'medium' ),
            'large' => __( 'large' ),
            'xlarge' => __( 'xlarge' ),
            'xxlarge' => __( 'xxlarge' )
        );

        $newsizes = array_merge($sizes, $addsizes);
        return $newsizes;
    }

?>