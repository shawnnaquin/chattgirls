<?php
/*
Plugin Name: add menu item to admin menu
Plugin URI: wordpress codex
Description: add menu item to admin menu
Author: wordpress codex
Version: 1
Author URI: https://wordpress.com
*/

add_action( 'admin_menu', 'my_admin_menu' );

function my_admin_menu() {
    add_menu_page( 'Personell', 'Personell', 'read', 'edit.php?post_type=volunteer', '', 'dashicons-groups', 50  );
    add_menu_page( 'Sponsors', 'Sponsors', 'read', 'edit.php?post_type=sponsor', '', 'dashicons-awards', 50  );

}

?>