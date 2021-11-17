<?php

include(WPC_RUTA.'admin/menu-opciones.php');
function wp_menuwather(){

add_menu_page( 'WPC',  'WeatherApp',  'manage_options', 'weatherapp', 'vieweather',  'dashicons-cloud', 69);
}

add_action( 'admin_menu', 'wp_menuwather' );