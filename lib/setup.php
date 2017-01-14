<?php

namespace Roots\Sage\Setup;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
  // Enable features from Soil when plugin is activated
  // https://roots.io/plugins/soil/
  //add_theme_support('soil-clean-up');
  //add_theme_support('soil-nav-walker');
  //add_theme_support('soil-nice-search');
  //add_theme_support('soil-jquery-cdn');
  //add_theme_support('soil-relative-urls');

  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain('sage', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'sage'),
      'klab-home-primary-menu' => __( 'Home Page Primary Menu' )
  ]);

  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');

  // Enable post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Enable HTML5 markup support
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  // Use main stylesheet for visual editor
  // To add custom styles edit /assets/styles/layouts/_tinymce.scss
  add_editor_style(Assets\asset_path('styles/main.css'));
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init() {
  register_sidebar([
    'name'          => __('Primary', 'sage'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Footer', 'sage'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

/**
 * Determine which pages should NOT display the sidebar
 */
function display_sidebar() {
  static $display;

  isset($display) || $display = !in_array(true, [
    // The sidebar will NOT be displayed if ANY of the following return true.
    // @link https://codex.wordpress.org/Conditional_Tags
    is_404(),
    is_front_page(),
    is_page(),
    is_page_template('template-custom.php'),
  ]);

  return apply_filters('sage/display_sidebar', $display);
}

/**
 * Theme assets
 */
function assets() {

    wp_enqueue_style('material-design-lite-icons/css', 'https://fonts.googleapis.com/icon?family=Material+Icons', false, null);
    wp_enqueue_style('material-design-lite/css', 'https://code.getmdl.io/1.3.0/material.min.css', false, null);
    wp_enqueue_script('material-design-lite/js', 'https://code.getmdl.io/1.3.0/material.min.js', null, null, false);

    wp_enqueue_style('sage/css', Assets\asset_path('styles/main.css'), false, null);

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  if (is_user_logged_in() ) {
      wp_enqueue_script('tinymce/js', '//cdn.tinymce.com/4/tinymce.min.js', null, null, true);
	  wp_enqueue_script('klabAdmin/js', Assets\asset_path('scripts/klabAdmin.js'), array(), 0.1, true);
  }
  else {
	  wp_enqueue_script('klab/js', Assets\asset_path('scripts/klab.js'), array(), 0.1, true);
  }

  wp_enqueue_script('axios/js', 'https://unpkg.com/axios/dist/axios.min.js', null, null, true);
  wp_enqueue_script('sage/js', Assets\asset_path('scripts/main.js'), ['jquery'], null, true);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);

/**
 * Removes width and height attributes from image tags
 *
 * @param string $html
 *
 * @return string
 */
//function remove_image_size_attributes($html ) {
//   return preg_replace( '/(width|height)="\d*"/', '', $html );
//}

// Remove image size attributes from post thumbnails
//add_filter( 'post_thumbnail_html', __NAMESPACE__ . '\\remove_image_size_attributes' );

// Remove image size attributes from images added to a WordPress post
//add_filter( 'image_send_to_editor', __NAMESPACE__ . '\\remove_image_size_attributes' );


//to add defer to loading of scripts - use defer to keep loading order
/*function script_tag_defer($tag, $handle) {
    if (is_admin()){
        return $tag;
    }
    if (strpos($tag, '/wp-includes/js/jquery/jquery')) {
        return $tag;
    }
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 9.') !==false) {
        return $tag;
    }
    else {
        return str_replace(' src',' defer src', $tag);
    }
}
add_filter('script_loader_tag', __NAMESPACE__ . '\\script_tag_defer',10,2);

*/