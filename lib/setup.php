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

    wp_enqueue_style( 'klab-google-fonts/css', 'https://fonts.googleapis.com/css?family=Open+Sans', false );
    wp_enqueue_style('material-design-lite-icons/css', 'https://fonts.googleapis.com/icon?family=Material+Icons', false, null);
    wp_enqueue_style('material-design-lite/css', 'https://code.getmdl.io/1.3.0/material.min.css', null, false, 'screen');
    wp_enqueue_script('material-design-lite/js', 'https://code.getmdl.io/1.3.0/material.min.js', null, null, false);

    wp_enqueue_style('sage/css', Assets\asset_path('styles/main.css'), false, null);

    wp_enqueue_style( 'klab-old-ie/css', Assets\asset_path("styles/klab-old-ie.css"), null );
    wp_style_add_data( 'klab-old-ie/css', 'conditional', 'lt IE 10' );

    wp_enqueue_style( 'klab-print', Assets\asset_path("styles/klab-print.css"), null, false, "print");

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    if (is_page('contact')) {
        wp_enqueue_script('googlemaps/js', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyANdMVnsOgw9R0277hHHWlyOxJylPKcJOc&callback=initMap', ['sage/js'], null, true);
    }

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

/*add_filter('the_title',
    function($content) use ($titleAnchor) {
        return klab_addEditButton($content, $titleAnchor);
    }
);*/

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

add_action('admin_head',  __NAMESPACE__ . '\\klab_customAdminCss');

function klab_customAdminCss() {
    echo '<style>
    #wpbody-content #cpto #cpt_info_box, #wpbody-content #cpt_info_box {
      display:none;
    } 
  </style>';
}



////////////SHORTCODES
function klab_imageLinkShortCode( $atts ) {
    $a = shortcode_atts( array(
        'image_title_in_media_library' => '',
        'link_text' => '',
        'url' => '',
    ), $atts );

    if ($a['url'] == '') {
        echo "url needs to be given as you want to make a link";
    }

    if ($a['image_title_in_media_library'] != '') {
        $imageUrl = null;
        global $post;
        $args = array('post_type' => 'attachment', 'posts_per_page' => -1, 'post_status' => 'any', 'post_parent' => null);
        $attachments = get_posts($args);
        if ($attachments) {
            foreach ($attachments as $image) {
                if ($image->post_title == $a['image_title_in_media_library']) {
                    $imageUrl = wp_get_attachment_url($image->ID);
                    break;
                }
            }
            wp_reset_postdata();
        }

        if ($imageUrl == null) {
            return "Image with the name you gave was not found.";
        }

        return '<div class="linkImage">
                <a href = "'. $a['url'].'">
                    <img src="'. $imageUrl.'"/>
                    <span>'. $a['link_text'] .'</span>
                </a></div>';
    }

    return '<div class="linkImage">
                <a href = "'. $a['url'].'">
                    <span>'. $a['link_text'] .'</span>
                </a></div>';
}

add_shortcode( 'link', __NAMESPACE__ . '\\klab_imageLinkShortCode' );

function klab_mediaLinkShortCode( $atts ) {
    $a = shortcode_atts( array(
        'url' => '',
        'title' => ''
    ), $atts );

    if ($a['url'] == '') {
        echo "url needs to be given as you want to make a link";
    }
    $title = is_empty($a['title']) ? $a['url'] : $a['title'];

    return '<div class="unfurlLink">
                <a href = "'. $a['url'].'">
                    <span>'. $title .'</span>
                </a></div>';
}

add_shortcode( 'media_link', __NAMESPACE__ . '\\klab_mediaLinkShortCode' );


function klab_addTinyMCEbuttons() {
    if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
        return;
    }

    if ( get_user_option( 'rich_editing' ) !== 'true' ) {
        return;
    }

    add_filter( 'mce_external_plugins',  __NAMESPACE__ . '\\klab_addLinkButtons' );
    add_filter( 'mce_buttons',  __NAMESPACE__ . '\\klab_registerLinkButtons' );

}

if ( ! function_exists( 'klab_addLinkButtons' ) ) {
    function klab_addLinkButtons( $plugin_array ) {
        $plugin_array['linkWithImage'] = Assets\asset_path('scripts/tinymce_buttons.js');
        return $plugin_array;
    }
}

if ( ! function_exists( 'klab_registerLinkButtons' ) ) {
    function klab_registerLinkButtons( $buttons ) {
        array_push( $buttons, 'linkWithImage' );
        return $buttons;
    }
}


add_action( 'init', __NAMESPACE__ . '\\klab_addTinyMCEbuttons');



//Function used to programmatically add alumnis.
/*function programmatically_create_post() {

    $names = ["Tarja Välimäki",
        "Anni Viheriäranta",
        "Ekaterina Virkunen",
        "Johanna Englund",
        "Liina Nevalaita",
        "Vilja Eskelinen",
        "Katriina Muona",
        "Mikko Myllynen",
        "Sirkku Saarikoski",
        "Heini Natri",
        "Misa Imai",
        "Yan Yan",
        "Essi Havula",
        "Sauli Toikka",
        "Anne Mäkelä",
        "Katja Suomi",
        "Elina Enlund",
        "Harriet Gullsten",
        "Marjukka",
        "Jaakko",
        "Amit Cohen",
        "Juho",
        "Kaisu",
        "Niklas Ekman",
        "Annika Hau"];

    // Initialize the page ID to -1. This indicates no action has been taken.
    $post_id = -1;

    //object(WP_Post)#742 (24) { ["ID"]=> int(3970)
    // ["post_author"]=> string(1) "1"
    // ["post_date"]=> string(19) "2016-04-16 18:16:09"
    // ["post_date_gmt"]=> string(19) "2016-04-16 18:16:09"
    // ["post_content"]=> string(0) ""
    // ["post_title"]=> string(116) "MYC-induced apoptosis in mammary epithelial cells is associated with repression of lineage-specific gene signatures." ["post_excerpt"]=> string(0) "" ["post_status"]=> string(7) "publish" ["comment_status"]=> string(6) "closed" ["ping_status"]=> string(6) "closed" ["post_password"]=> string(0) "" ["post_name"]=> string(117) "myc-induced-apoptosis-in-mammary-epithelial-cells-is-associated-with-repression-of-lineage-specific-gene-signatures-2" ["to_ping"]=> string(0) "" ["pinged"]=> string(0) ""
    // ["post_modified"]=> string(19) "2016-04-16 19:43:34"
    // ["post_modified_gmt"]=> string(19) "2016-04-16 19:43:34" ["post_content_filtered"]=> string(0) "" ["post_parent"]=> int(0) ["guid"]=> string(168) "http://52.18.72.234/klefstromlab/klab_publication/myc-induced-apoptosis-in-mammary-epithelial-cells-is-associated-with-repression-of-lineage-specific-gene-signatures-2/" ["menu_order"]=> int(0) ["post_type"]=> string(16) "klab_publication" ["post_mime_type"]=> string(0) "" ["comment_count"]=> string(1) "0" ["filter"]=> string(3) "raw"

    // Setup the author, slug, and title for the post
    foreach ( $names as $name ) {

        $author_id = 1;
        $title = $name;

        if (null == get_page_by_title($title, OBJECT, 'klab_lab_member')) {

            // Set the post ID so that we know the post was created successfully
            $post_id = wp_insert_post(
                array(
                    'post_date' => '2016-04-16 18:16:09',
                    'post_date_gmt' => '2016-04-16 18:16:09',
                    'post_modified' => '2016-04-16 19:43:34',
                    'post_modified_gmt' => '2016-04-16 19:43:34',
                    'comment_status' => 'closed',
                    'ping_status' => 'closed',
                    'post_author' => $author_id,
                    'post_title' => $title,
                    'post_status' => 'publish',
                    'post_type' => 'klab_lab_member'
                )
            );

            $term_taxonomy_ids = wp_set_object_terms($post_id, array(836), 'labMemberPosition', true);

            var_dump($term_taxonomy_ids);
            var_dump(get_post($post_id));

            // Otherwise, we'll stop
        } else {

            // Arbitrarily use -2 to indicate that the page with the title already exists
            $post_id = -2;
            echo "already exists";

        } // end if
    }

}
add_filter( 'init', __NAMESPACE__ . '\\programmatically_create_post' );*/


?>