<?php
/*
 * Template Name: Home
 */


// REMOVE SIDEBAR & POST CONTENT //
//remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
//remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
//remove_action( 'genesis_loop', 'genesis_do_loop' );



// HOME INTRO WIDGET AREA //
add_action( 'genesis_before_content', 'rena_home_intro' );
function rena_home_intro() {

    genesis_widget_area( 'home-intro' );
    
    // For Testing/Preview
//    echo '<div class="content" style="width: 100%;"><div class="entry" style="width: 100%; color: #333; text-align: left; line-height:40px; font-size:2.75em; font-weight: 300; background: url(\'http://sb.dev/renaromano/wp-content/uploads/2015/08/Headshot-1.jpg\') white right top no-repeat; padding: 100px; padding-bottom: 150px; box-shadow: inset 0 -8px #fff;"><b style="border-bottom: 2px solid #F2488A;">Energize</b> &amp; <b style="border-bottom: 2px solid #F2488A;">Inspire</b> your audience<small style="font-size: .55em;"><br>by delivering <b style="font-size:.75em;">POWERFUL</b> presentations</small><br><br><a style="background: none; border: 2px solid #F2488A; color: #F2488A; font-weight: 700; letter-spacing: 1px; padding: 7px 18px;" href="#" class="button"><i class="fa fa-lg fa-book" style="position: relative; top: 1px;"></i>&nbsp;&nbsp;&nbsp;GET STARTED</a></div></div>';
    
} // rena_home_intro()



//-- LOAD FRAMEWORK --//
genesis();