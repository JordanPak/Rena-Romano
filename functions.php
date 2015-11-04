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
    wp_enqueue_script( 'pushy', get_stylesheet_directory_uri() . '/js/pushy.min.js', array( 'jquery' ), CHILD_THEME_VERSION );

} // renaromano_global_scripts()



add_action( 'genesis_header', 'rena_mobile_menu_button', 14 );
/**
 * RenaRomano Mobile Menu Button
 * Outputs the Primary Navigation Menu Button for the Pushy Menu
 *
 * @author Jordan Pakrosnis
 */
function rena_mobile_menu_button() {

    // Output Button
    ?>

    <div id="rena-mobile-topnav">

        <a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
            <i class="fa fa-shopping-cart"></i>

            <?php
                if( WC()->cart->cart_contents_count > 0 ) {
                    echo '<span>' . WC()->cart->cart_contents_count . '</span>';
                }
            ?>

        </a><button type="button" class="menu-btn">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

    </div><!-- /#rena-mobile-topnav -->

    <?php

} // rena_mobile_menu_button()



add_action( 'genesis_before', 'rena_mobile_menu' );
/**
 * RenaRomano Mobile Menu Button
 * Outputs the Primary Navigation Menu Button for the Pushy Menu
 *
 * @author Jordan Pakrosnis
 */
function rena_mobile_menu() {

    // Configure Menu
    $mobile_menu_args = array(
        'menu'              => 'Main Menu',
        'container'         => 'nav',
        'container_class'   => 'pushy pushy-right nav-primary',
        'menu_id'           => 'mobile-menu',
        'menu_class'        => 'genesis-nav-menu',
        'echo'              => true,
        'depth'             => 1,
    );

    // Output Menu
    wp_nav_menu( $mobile_menu_args );


    // Output Site Overlay
    echo '<div class="site-overlay"></div>';

} // rena_mobile_menu()



//-- HEADER CONTACT --//
add_action( 'genesis_header', 'rena_header_contact', 9 );
/**
 * Header Contact Info
 *
 * @author Jordan Pakrosnis
 */
function rena_header_contact() {

    echo '<div class="header-contact">';

        // Social Icons
        genesis_widget_area( 'jimbo-social' );

        // Phone
        // echo '<div class="header-social-icons"><i class="fa fa-facebook-square"></i><i class="fa fa-twitter"></i><i class="fa fa-linkedin"></i><i class="fa fa-youtube-play"></i></div><span class="header-contact-phone"><i class="fa fa-phone"></i>&nbsp;&nbsp;239-896-2504</span>';
        echo '<span class="header-contact-phone"><i class="fa fa-phone"></i>&nbsp;&nbsp;239-896-2504</span>';

    // Close Wrap
    echo '</div>';

} // rena_header_contact()



//-- SITE-HEADER TOP WIDGET AREA //
genesis_register_sidebar( array(
	'id'            => 'jimbo-social',
	'name'          => __( 'Site Header - Social Icons', 'renaromano' ),
	'description'   => __( 'For Genesis Easy Social Icons', 'renaromano' ),
) );


//-- HEADER INTRO WIDGET AREA --//
genesis_register_sidebar( array(
	'id'            => 'home-intro',
	'name'          => __( 'Home Intro', 'renaromano' ),
	'description'   => __( '"Featured Section" at the top of the home page.', 'renaromano' ),
    'before_widget' => '<div class="widget-area home-intro">',
    'after_widget' => '</div>'
) );


//-- HOME SERVICES  WIDGET AREA --//
genesis_register_sidebar( array(
	'id'            => 'home-services',
	'name'          => __( 'Home Services', 'renaromano' ),
	'description'   => __( 'Three "Service" features on the home page.', 'renaromano' ),
    'before_widget' => '<div class="widget">',
    'after_widget' => '</div>'
) );


//-- HOME - MORE  WIDGET AREA --//
genesis_register_sidebar( array(
	'id'            => 'home-more',
	'name'          => __( 'Home - More', 'renaromano' ),
	'description'   => __( 'Area under Home Services', 'renaromano' ),
    'before_widget' => '<div class="widget">',
    'after_widget' => '</div>'
) );


//-- WOOCOMMERCE SUPPORT (Uses Plugin) --//
add_theme_support( 'genesis-connect-woocommerce' );


//* Change the footer text
add_filter('genesis_footer_creds_text', 'sp_footer_creds_filter');
function sp_footer_creds_filter( $creds ) {

	$creds = '[footer_copyright] Rena Romano. <span>Built on WordPress/Genesis by <a href="http://JordanPak.com/" target="_BLANK" title="Jordan Pakrosnis">Jordan Pakrosnis</a></span>';

	return $creds;
} // sp_footer_creds_filter
