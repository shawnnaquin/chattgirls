<?php

/*
Plugin Name: ACF Cond Logic for Personnell
Plugin URI: http://pommebelle.com
Description: ACF Cond Logic for Personnell
Author: Shawn Naquin
Version: 1
Author URI: https://pommebelle.com
*/

function my_acf_admin_enqueue_scripts() {

    // register style
    wp_register_style( 'foo-styles',  plugin_dir_url( __FILE__ ) . 'acf-logic.css' );
    wp_enqueue_style( 'foo-styles' );


    // register script
    wp_register_script( 'foo-styles',  plugin_dir_url( __FILE__ ) . 'acf-logic.js' );
    wp_enqueue_script( 'foo-styles' );

}

add_action( 'acf/input/admin_enqueue_scripts', 'my_acf_admin_enqueue_scripts' );
