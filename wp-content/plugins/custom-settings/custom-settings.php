<?php

/*
Plugin Name: Custom Settings
Plugin URI: wordpress codex
Description: Register Side Bars
Author: wordpress codex
Version: 1
Author URI: https://wordpress.com
*/

// $new_general_setting = new new_general_setting();

// class new_general_setting {
//     function new_general_setting( ) {
//         add_filter( 'admin_init' , array( &$this , 'register_fields' ) );
//     }
//     function register_fields() {
//         register_setting( 'general', 'bout_location', 'esc_attr' );
//         add_settings_field('bou_location', '<label for="bout_location">'.__('Bout Location?' , 'bout_location' ).'</label>' , array(&$this, 'fields_html') , 'general' );
//         register_setting( 'general', 'background_image', 'esc_attr' );
//         add_settings_field('bg_image', '<label for="background_image">'.__('Background Image?' , 'background_image' ).'</label>' , array(&$this, 'fields_html') , 'general' );

//     }
//     function fields_html() {
//         $value = get_option( 'bout_location', '' );
//         echo '<input type="text" id="bout_location" name="bout_location" value="' . $value . '" />';
//         $value1 = get_option( 'background_image', '' );
//         echo '<input type="text" id="background_image" name="background_image" value="' . $value1 . '" />';
//     }
// }

function my_custom_admin_styles() {
  echo '<style>
    input.long-text {
        width:45rem;
    }
  </style>';
}

add_action('admin_head', 'my_custom_admin_styles');

add_filter('admin_init', 'my_general_settings_register_fields');

    function my_general_settings_register_fields()
    {
        register_setting('general', 'bout_map', 'esc_attr');
        add_settings_field('bout_map', '<label for="bout_map">'.__('Bout Map URL' , 'bout_map' ).'</label>' , 'bout_map_html', 'general');

        register_setting('general', 'background_image', 'esc_attr');
        add_settings_field('background_image', '<label for="background_image">'.__('Site Background Image' , 'background_image' ).'</label>' , 'background_image_html', 'general');

        register_setting('general', 'site_logo', 'esc_attr');
        add_settings_field('site_logo', '<label for="site_logo">'.__('Site Logo Image <br/><small>(*.png, *.gif)<br/><span style="color:red">(required)</span></small>' , 'site_logo' ).'</label>' , 'site_logo_html', 'general');

        register_setting('general', 'site_logo_vector', 'esc_attr');
        add_settings_field('site_logo_vector', '<label for="site_logo_vector">'.__('Site Logo Vector<br/><small>(*.svg)<br/>(optional)</small>' , 'site_logo_vector' ).'</label>' , 'site_logo_vector', 'general');

    }

    function bout_map_html()
    {
        $bout_map = get_option( 'bout_map', '' );
        echo '<input type="text" class="long-text" id="bout_map" name="bout_map" value="' . $bout_map . '" />';
    }

    function background_image_html()
    {
        $background_image = get_option( 'background_image', '' );
        echo '<input type="text" class="long-text" id="background_image" name="background_image" value="' . $background_image . '" />';
    }

    function site_logo_html()
    {
        $site_logo = get_option( 'site_logo', '' );
        echo '<input type="text" class="long-text" id="site_logo" name="site_logo" value="' . $site_logo . '" />';
    }

    function site_logo_vector()
    {
        $site_logo_vector = get_option( 'site_logo_vector', '' );
        echo '<input type="text" class="long-text" id="site_logo_vector" name="site_logo_vector" value="' . $site_logo_vector . '" />';
    }

?>