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
        'before_widget' => '<div class="middle-item-wrapper small-12 large-6 columns no-padding"><div class="middle-item">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h2 class="rounded">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => 'Home Right Sidebar',
        'id'            => 'home_right_sidebar',
        'before_widget' => '<div class="right-item-bg middle-item-wrapper small-12 large-6 columns no-padding"><div class="middle-item">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h2 class="rounded">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => 'Join Us Sidebar',
        'id'            => 'join_us_sidebar',
        'before_widget' => '<div class="columns small-12 no-padding">',
        'after_widget'  => '</div>',
       'before_title'  => '<h2 class="rounded">',
       'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => 'Derby FAQ Sidebar',
        'id'            => 'derby_faq_sidebar',
        'before_widget' => '<div class="columns small-12 no-padding">',
        'after_widget'  => '</div>',
       'before_title'  => '<h2 class="rounded">',
       'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => 'ScoreBoards Sidebar',
        'id'            => 'scoreboards_sidebar',
        'before_widget' => '<div class="columns small-12 no-padding">',
        'after_widget'  => '</div>',
       'before_title'  => '<h2 class="rounded">',
       'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => 'Sponsor Packages Sidebar',
        'id'            => 'sponsor_packages_sidebar',
        'before_widget' => '<div class="columns small-12 no-padding">',
        'after_widget'  => '</div>',
       'before_title'  => '<h2 class="rounded">',
       'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => 'Footer Social Area',
        'id'            => 'footer_social_area',
        'before_widget' => '<div class="columns small-4 no-padding">',
        'after_widget'  => '</div>',
       'before_title'  => '<div class="footer-social-title">',
       'after_title'   => '</div>',
    ) );

}

add_action( 'widgets_init', 'arphabet_widgets_init' );

?>