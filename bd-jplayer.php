<?php
/*
Plugin Name: Ben's jPlayer
Plugin URI: http://bendeschamps.com
Description: Plugin to enable a stock jPlayer setup in WordPress
Version: 0.1
Author: Ben Deschamps
Author URI: http://bendeschamps.com
License: GPLv2
*/

/* Registering the jplayer jscripts */

function bd_jplayer_scripts_method(){
  if ( !is_admin() ){
 
    // jplayer files
    wp_enqueue_script(
		      'jplayer',
		      plugins_url( '/js/jquery.jplayer.min.js', __FILE__ ),
		      array('jquery')
	             );

    // jplayer-playlist files
    wp_enqueue_script(
		      'jplayer-playlist',
		      plugins_url( '/js/jplayer.playlist.min.js', __FILE__ ),
		      array('jquery')
	             );

    /* // Enqueue single player */
    /* wp_enqueue_script( */
    /* 		      'jplayer-jquerything', */
    /* 		      plugins_url( '/js/bd-jplayer-include.js', __FILE__ ), */
    /* 		      array('jquery') */
    /* 	             ); */

    //    Enqueue jplayer-playlist
    /* wp_enqueue_script( */
    /* 		      'jplayer-jp-playlist', */
    /* 		      plugins_url( '/js/bd-jp-playlist.js', __FILE__ ), */
    /* 		      array('jquery') */
    /* 	             ); */

  }
}
add_action('wp_enqueue_scripts', 'bd_jplayer_scripts_method');

/* Registering the stylesheet for jplayer (Blue Monday): */

add_action( 'wp_enqueue_scripts', 'bd_register_plugin_styles' );

function bd_register_plugin_styles(){

  wp_register_style( 'blue-monday-style', plugins_url( 'bd-jplayer/css/jplayer.blue.monday.css' ) );
  wp_enqueue_style( 'blue-monday-style' );
}

// Trying to make a function out of the do_theme_redirect stuff for the playlist_html:
//add_filter( 'template_include', 'bd_jplayer_playlist_html' );

/* function bd_jplayer_playlist_html(){ */
/* $plugindir = dirname( __FILE__ ); */
/* $playlist_html_template = $plugindir . '/includes/templates/playlist_html.php'; */
/* return $playlist_html_template; */
/* // return get_template_part( '', $plugindir . '/includes/templates/playlist_html.php'); */
/* } */

// From http://stackoverflow.com/questions/4647604/wp-use-file-in-plugin-directory-as-custom-page-template
// (with my customizations of course)
// Actually this one is a bit better I think, as it's using single_template instead of template_redirect:
// I can use the same one for song as well.

function get_album_post_type_template($single_template) {
 global $post;

 if ($post->post_type == 'album') {
      $single_template = dirname( __FILE__ ) . '/includes/templates/single-album.php';
 }
 return $single_template;
}

add_filter( "single_template", "get_album_post_type_template" ) ;

//Template fallback
/* add_action("template_redirect", 'bd_jplayer_theme_redirect'); */

/* function bd_jplayer_theme_redirect() { */
/*     global $wp; */
/*     $plugindir = dirname( __FILE__ ); */

/*     //A Specific Custom Post Type */
/*     if ($wp->query_vars["post_type"] == 'album') { */
/*         $templatefilename = 'single-album.php'; */
/*         if (file_exists(TEMPLATEPATH . '/' . $templatefilename)) { */
/*             $return_template = TEMPLATEPATH . '/' . $templatefilename; */
/*         } else { */
/*             $return_template = $plugindir . '/includes/templates/' . $templatefilename; */
/*         } */
/*         do_theme_redirect($return_template); */
/*     } */
/* } */

// This is very ugly, and causes all sorts of side effects. I think there's a better way to do this.
function do_theme_redirect($url) {
    global $post, $wp_query;
    if (have_posts()) {
        include($url);
        die();
    } else {
        $wp_query->is_404 = true;
    }
}

?>