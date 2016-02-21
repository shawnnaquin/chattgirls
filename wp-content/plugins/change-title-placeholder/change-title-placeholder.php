<?php

/*
Plugin Name: Change Title Placeholders
Plugin URI: wordpress snippets
Description: Change Title Placeholders
Author: wordpress codex
Version: 1
Author URI: http://wp-snippets.com/change-enter-title-here-text-for-custom-post-type/
*/

function change_default_title( $title ){
    $screen = get_current_screen();
    $the_types = array("coach", "trainer", "volunteer", "skater", "official", "announcer", "sponsor"); 

    foreach ($the_types as $value) {
         if  ( $screen->post_type == $value ) {
              return 'Enter Name Here';
         }
    }
}
 
add_filter( 'enter_title_here', 'change_default_title' );

?>