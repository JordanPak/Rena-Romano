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

// Remove Edit Link
add_filter( 'edit_post_link', '__return_false' );

// Unregister Unneeded Layouts and Sidebars
unregister_sidebar( 'sidebar-alt' );
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );



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
        genesis_widget_area( 'header-social' );

        // Phone
        echo '<a href="tel:+1-813-614-3720" class="header-contact-phone"><i class="fa fa-phone"></i>&nbsp;&nbsp;813-614-3720</a>';

    // Close Wrap
    echo '</div>';

} // rena_header_contact()



//-- SITE-HEADER TOP WIDGET AREA //
genesis_register_sidebar( array(
	'id'            => 'header-social',
	'name'          => __( 'Site Header - Social Icons', 'renaromano' ),
	'description'   => __( 'For Simple Social Icons Widget', 'renaromano' ),
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

	$creds =	'[footer_copyright] Rena Romano. &nbsp; ' .
				'<span>' .
					'Built with &nbsp;<a target="_BLANK" title="WordPress" href="https://wordpress.org/"><i class="fa fa-wordpress"></i></a>&nbsp; &amp; <a target="_BLANK" href="http://studiopress.com">Genesis</a> ' .
					'by <a class="jordanpak" href="http://jordanpak.com/" target="_BLANK" title="Jordan Pakrosnis">JordanPak</a>' .
				'</span>';
	return $creds;

} // sp_footer_creds_filter


add_filter( 'the_content_more_link', 'rena_read_more_link' );
/**
* Customize Read More Link
*
* @package RenaRomano
* @since 1.0.0
*
* @return string
*/
function rena_read_more_link() {
	return '<p><a class="more-link button button-sm" href="' . get_permalink() . '">Continue Reading</a></p>';
}


add_filter( 'genesis_post_info', 'rena_post_info_filter' );
/**
* Customize Post Meta
*
* @package RenaRomano
* @since 1.0.0
*
* @return string
*/
function rena_post_info_filter( $post_info ) {
	$post_info = '[post_date format="M j, Y"]<span class="post-info-separator">|</span>[post_categories before="" sep=", "]';
	return $post_info;
}


add_filter( 'genesis_post_meta', 'rena_post_meta_filter' );
/**
* Customize Post Footer Meta
*
* @package RenaRomano
* @since 1.0.0
*
* @return string
*/
function rena_post_meta_filter( $post_meta ) {
    $post_meta = '';
	return $post_meta;
}


// THEME COLOR META //
add_action( 'genesis_meta', 'rr_meta_theme_color', 13 );
function rr_meta_theme_color() {

	echo '<meta name="theme-color" content="#00567c">';

} // rr_meta_theme_color()


// Add strong and em compatibility with [s] and [e]
function html_widget_title( $title ) {

	// HTML tag opening/closing brackets
	$title = str_replace( '[', '<', $title );
	$title = str_replace( '[/', '</', $title );

	// <strong></strong>
	$title = str_replace( 's]', 'strong>', $title );

	// <em></em>
	$title = str_replace( 'e]', 'em>', $title );

	return $title;
} // html_widget_title()
add_filter( 'widget_title', 'html_widget_title' );


// add_filter( 'woocommerce_product_single_add_to_cart_text', 'rena_custom_cart_button_text' );
// function rena_custom_cart_button_text() {
//
// 		global $product;
// 		global $post;
//
// 		$price = get_post_meta( get_the_ID(), '_price', true );
// 		$post_name = $post->post_name;
//
// 		if ( $post_name == "puppet-no-more" ) {
// 			return __( 'Signed Paperback - $' . $price, 'woocommerce' );
// 		}
//
// 		else {
//         	return __( 'My Button Text', 'woocommerce' );
// 		}
//
// } // rena_custom_cart_button_text();
