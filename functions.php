<?php
function thememota_supports() {
    add_theme_support('title-tag');
    add_theme_support('menus');
    register_nav_menu('header','En tête');
    register_nav_menu('footer','Pied de page');
    add_theme_support('custom-logo');
}
add_action('after_setup_theme','thememota_supports');

function enqueue_jquery() {
 wp_enqueue_script('jquery-js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', array('jquery'), '3.7.1', true);
}
add_action('wp_enqueue_scripts', 'enqueue_jquery');

function thememota_supports_scripts(){
    wp_enqueue_style('style',get_template_directory_uri() . '/style/style.css');
    wp_enqueue_script('menu_mobile', get_template_directory_uri() . '/js/openclosemenu.js', array(), '1.0.0', true);
    wp_enqueue_script('modale', get_template_directory_uri() . '/js/modale.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '1.0.0', true);
    }
add_action('wp_enqueue_scripts', 'thememota_supports_scripts');

