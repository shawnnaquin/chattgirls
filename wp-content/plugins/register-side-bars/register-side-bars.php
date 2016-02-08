<?php
/*
Plugin Name: Register Side Bars
Plugin URI: wordpress codex
Description: Register Side Bars
Author: wordpress codex
Version: 1
Author URI: https://wordpress.com
*/

function arphabet_widgets_init() {

    register_sidebar( array(
        'name'          => 'Home Middle Sidebar',
        'id'            => 'home_middle_sidebar',
        'before_widget' => '<div class="middle-item-wrapper small-12 large-6 columns"><div class="middle-item">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h2 class="rounded">',
        'after_title'   => '</h2>',
    ) );

}

add_action( 'widgets_init', 'arphabet_widgets_init' );

?>