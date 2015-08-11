<?php

//------------------------//
//  START GENESIS ENGINE  //
//------------------------//
include_once( get_template_directory() . '/lib/init.php' );



//-----------------------//
//  EXTRA GENESIS STUFF  //
//-----------------------//

// HTML5 Markup Structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

// Viewport Meta Tag
add_theme_support( 'genesis-responsive-viewport' );



//------------------------//
//  RENA ROMANO INCLUDES  //
//------------------------//


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
    wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic,900italic,900', array(), CHILD_THEME_VERSION );
    
    // Font Awesome
    wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', array(), CHILD_THEME_VERSION );
    
} // renaromano_global_styles()


// ENQUEUE GLOBAL SCRIPTS
add_action( 'wp_enqueue_scripts', 'renaromano_global_scripts' );
function renaromano_global_scripts() {
    
    // Pushy
//    wp_enqueue_script( 'pushy', get_stylesheet_directory_uri() . '/inc/js/pushy.min.js', array( 'jquery' ), CHILD_THEME_VERSION );
    
} // renaromano_global_scripts()



//-- HEADER BG --//

add_action( 'genesis_before_header', 'rena_header_bg' );
/**
 * Header Background
 *
 * @author Jordan Pakrosnis
 */
function rena_header_bg() {
    
    echo '<div id="header-bg"></div>';
    
} // rena_header_background()
