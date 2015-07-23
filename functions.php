<?php

//------------------------//
//  START GENESIS ENGINE  //
//------------------------//
include_once( get_template_directory() . '/lib/init.php' );



//-------------===--------//
//  RENA ROMANO INCLUDES  //
//---------------===------//


// SHORTCODES
//require_once( CHILD_DIR . '/inc/shortcodes/file.php' );


// CHILD THEME STUFF
define( 'CHILD_THEME_NAME', 'RenaRomano' );
define( 'CHILD_THEME_URL', 'http://RenaRomano.com/' );
define( 'CHILD_THEME_VERSION', '2.0.0' );


// ENQUEUE GLOBAL STYLES
add_action( 'wp_enqueue_scripts', 'renaromano_global_styles' );
function renaromano_global_styles() {
    
    // Google Fonts
//    wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Droid+Serif:400,700|Roboto:400,400italic,700,700italic|Oswald', array(), CHILD_THEME_VERSION );
    
    // Font Awesome
    wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', array(), CHILD_THEME_VERSION );
    
} // renaromano_global_styles()


// ENQUEUE GLOBAL SCRIPTS
add_action( 'wp_enqueue_scripts', 'renaromano_global_scripts' );
function renaromano_global_scripts() {
    
    // Pushy
//    wp_enqueue_script( 'pushy', get_stylesheet_directory_uri() . '/inc/js/pushy.min.js', array( 'jquery' ), CHILD_THEME_VERSION );
    
} // renaromano_global_scripts()