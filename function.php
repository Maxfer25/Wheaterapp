<?php

function register_style(){
    wp_register_style('wheather_style',plugin_dir_url(__FILE__) . 'admin/css/index.css', false);
    wp_enqueue_style('weather_style');
    //wp_register_script('weather_script',plugin_dir_url(__FILE__) . 'public/src/index.js', true);
    //wp_register_script('weather_script',plugin_dir_url(__FILE__) . 'public/src/store.js', true);
    //wp_register_script('weather_script',plugin_dir_url(__FILE__) . 'public/src/UI.js', true);
    //wp_register_script('weather_script',plugin_dir_url(__FILE__) . 'public/src/weather.js', true);
    wp_register_script('weather_script', plugins_url('/public/dist/bundle.js', __FILE__), [], '', true);
    wp_enqueue_script('weather_script');
}

add_action('admin_enqueue_scripts', 'register_style');

add_action('wp_enqueue_scripts', 'register_style');
