<?php
/*
Plugin Name: WeatherApp
Plugin URI: 
Description: Plugin de ejemplo del post de como crear un plugin en WordPress
Version:1.0
Author: Max
Author URI:
License: MIT 
*/

defined('ABSPATH') or die("Bye bye");

define('WPC_RUTA',plugin_dir_path(__FILE__));

/**
 * LLamado a la carpeta public a cada archivo 
 */
   require ('function.php');
   require ('public/src/index.php');
   require (WPC_RUTA.'include\opciones.php');