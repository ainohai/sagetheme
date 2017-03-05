<?php

namespace Roots\Sage\Setup;

use Roots\Sage\Assets;
use Roots\Sage\KlabTemplFunctions;

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

    add_filter('show_admin_bar', '__return_false');
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
  if (is_page('contact')) {
      wp_enqueue_script('googlemaps/js', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyANdMVnsOgw9R0277hHHWlyOxJylPKcJOc&callback=initMap', ['sage/js'], null, true);
  }

  if (is_user_logged_in() ) {
      //wp_enqueue_script('tinymce/js', '//cdn.tinymce.com/4/tinymce.min.js', null, null, true);
	  wp_enqueue_script('klabAdmin/js', Assets\asset_path('scripts/klabAdmin.js'), array(), 0.1, true);
  }
  else {
	  wp_enqueue_script('klab/js', Assets\asset_path('scripts/klab.js'), array(), 0.1, true);
  }

  wp_enqueue_script('axios/js', 'https://unpkg.com/axios/dist/axios.min.js', null, null, true);
  wp_enqueue_script('sage/js', Assets\asset_path('scripts/main.js'), ['jquery'], null, true);
    wp_enqueue_script('sage/js', Assets\asset_path('scripts/main.js'), ['jquery'], null, true);

}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);

class EditAnchors {
    const CONTENT_ANCHOR = 'wp-content-editor-container';
    const TITLE_ANCHOR = 'title';
    const THUMBNAIL_ANCHOR = 'set-post-thumbnail';

    static function getContentAnchor() {
        return self::CONTENT_ANCHOR;
    }
    static function getTitleAnchor() {
        return self::TITLE_ANCHOR;
    }
    static function getThumbnailAnchor() {
        return self::THUMBNAIL_ANCHOR;
    }
}

$contentAnchor = EditAnchors::getContentAnchor();
$titleAnchor = EditAnchors::getTitleAnchor();
$thumbnailAnchor = EditAnchors::getThumbnailAnchor();

add_filter('the_content',
    function($content) use ($contentAnchor) {
        return klab_addEditButton($content, $contentAnchor);
    }
);

add_filter('the_title',
    function($content) use ($titleAnchor) {
        return klab_addEditButton($content, $titleAnchor);
    }
);

add_filter('post_thumbnail_html',
    function($content) use ($thumbnailAnchor) {
        return klab_addEditButton($content, $thumbnailAnchor);
    }
);

//admin edit button
function klab_addEditButton($content, $anchor) {
    //is_admin checks if user is in admin panel
    $beforecontent = (( current_user_can('editor') || current_user_can('administrator')) && !is_admin() ) ?
        KlabTemplFunctions\getEditPostButtonInLoop($anchor) : '';
    return $beforecontent . $content;

}

function klab_loginRedirect( $redirect_to, $request, $user ) {
    //is there a user to check?
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        //check for admins
        if ( in_array( 'administrator', $user->roles ) ) {
            // redirect them to the default place
            return $redirect_to;
        } else {
            return home_url();
        }
    } else {
        return $redirect_to;
    }
}

add_filter( 'login_redirect',  __NAMESPACE__ . '\\klab_loginRedirect', 10, 3 );
//add_filter('the_content', __NAMESPACE__ . '\\klab_addEditButtonToContent');
/*
//admin edit button
function klab_addEditButtonToTitle($content) {
    $beforecontent =
        '<button class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored">
            <i class="material-icons">edit</i>
        </button>';
    return $beforecontent . $content;

}
add_filter('the_title', __NAMESPACE__ . '\\klab_addEditButtonToTitle');

//admin edit button
function klab_addEditButtonToThumbnail($html) {
    $beforecontent =
        '<button class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored">
            <i class="material-icons">edit</i>
        </button>';
    return $beforecontent . $html;


}
add_filter('post_thumbnail_html', __NAMESPACE__ . '\\klab_addEditButtonToThumbnail');
*/
