<?php
/**
 * Created by PhpStorm.
 * User: aino
 * Date: 27.11.2016
 * Time: 21:49
 */
namespace Roots\Sage\KlabNavMenus;

/*add_action( 'init', __NAMESPACE__ . '\\registerLabHomePageMenu' );
//add_action('save_post',  __NAMESPACE__ . '\\updateLabHomePageMenu' );

const klab_primaryNavName = 'klab-home-primary-menu';

//TO DO: UPDATE MENU ON SAVE_POST
function registerLabHomePageMenu() {

    //wp_delete_nav_menu( $primaryNavName );
    if ( !is_nav_menu( klab_primaryNavName )) {
        $menuId = wp_create_nav_menu(klab_primaryNavName);

        $frontPageId = get_option('page_on_front');
        $navMenuPages = getPageAndItsChildren($frontPageId);


        foreach ($navMenuPages as $navMenuPage ){

            updateMenuItem($navMenuPage, $menuId);
        }

       if( !has_nav_menu( klab_primaryNavName ) ){

            $locations = get_theme_mod('nav_menu_locations');
            $locations[klab_primaryNavName] = $menuId;
            set_theme_mod( 'nav_menu_locations', $locations );
       }

    }
}

function updateLabHomePageMenu($post_id)
{
    $menu_obj = get_term_by( 'name', klab_primaryNavName, 'nav_menu' );
    updateMenuItem(get_post($post_id), $menu_obj->term_id);

}

/*Post names etc are already updated, but does not work when page is added(=new child) or removed
 * function updateMenuItem ($post, $menuId){
    $menuStatus = get_post_status( $post->ID ) ? 'publish' : 'draft';
    $menu_item_data = array(

        'menu-item-object-id' => $post->ID,
        'menu-item-parent-id' => 0,
        'menu-item-object' => 'page',
        'menu-item-type'      => 'post_type',
        'menu-item-status'    => $menuStatus

    );

    wp_update_nav_menu_item( $menuId, 0, $menu_item_data);

}*/
define("FOR_PATIENTS_ID", 3677);
define("FOR_PATIENTS_PARENT_ID", 3949);
define("LAB_HOME_PARENT_ID", 3946);

function echoPrimaryNavigation () {

    global $post;

    $parentPageId = $post->post_parent ? $post->post_parent : $post->ID;
    $frontPageId = get_option( 'page_on_front' );
    $navMenuPages = getPageChildren($parentPageId);

    if (!empty($navMenuPages)) {
        $navModifier = $parentPageId == FOR_PATIENTS_PARENT_ID  ? ' primaryNav--lightBg' : '';
        echo '<nav class="mdl-navigation primaryNav '. $navModifier .'" >';
        foreach ($navMenuPages as $navMenuPage) {
            echo '<a class="mdl-navigation__link mdl-navigation__link--weighted';
            if ($post->post_name === $navMenuPage->post_name) {
                echo ' active';
            }
            echo '" href = "'. get_post_permalink($navMenuPage->ID).'" >';
            if ($navMenuPage->ID == $frontPageId ) {
                echo "Home";
            }
            else {
                echo $navMenuPage->post_title;
            }
            echo '</a >';
        }
        echo '<div class="mdl-layout-spacer"></div>';

        $linkId = ($post->post_parent == LAB_HOME_PARENT_ID || $post->ID == $frontPageId) ? FOR_PATIENTS_ID : $frontPageId;
        $linkPost = get_post($linkId);
        echo '<a class="mdl-navigation__link mdl-navigation__link--weighted contrast" href="'. get_post_permalink($linkId).'">';
        echo $linkPost->post_title;
        echo '</a>';
        echo '</nav >';

        /*$linkPostID = $post->post_parent === $frontPageId ?
        echo '';
        echo '<a></a>';
</button>*/
    }
}

function getPageChildren($pageId) {
    /*$wpQuery = new \WP_Query;
    $parent = $wpQuery->query(array(
            'page_id' => $pageId
        )
    );*/

    $wpQuery = new \WP_Query();
    return $wpQuery->query(array(
        'post_type' => 'page',
        'post_parent'    => $pageId,
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC',
    ));

    //return array_merge($parent, $children);

}

function echoIntraLinks() {
    $wpQuery = new \WP_Query();
    $intraLinks = $wpQuery->query(array(
        'post_type' => 'klab_intra_links',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC',
    ));


    if (!empty($intraLinks)) {
        echo '<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect klab-intralinkList" for="klab-intraLinks">';
        foreach ($intraLinks as $link) {
            $meta = get_post_meta( $link->ID);
            //print_r($meta);

            echo '<a class="" 
                 href = "'. $meta['klab_intra_links_klabLinkUrl'][0] .'" ><li class="mdl-menu__item">'
                .$link->post_title.'</li></a >';
        }

        if (is_user_logged_in()) {


            echo '<a href="' . get_admin_url() . '"><li class="mdl-menu__item">Admin area </li></a> ';
            echo '<a href="' . admin_url( 'edit.php?post_type=klab_intra_links') . '"><li class="mdl-menu__item">Edit these links </li> </a>';
            echo '<a href="' . wp_logout_url() . '"><li class="mdl-menu__item">Logout </li> </a>';
        }
        else {
            echo '<a href="' . wp_login_url() . '"><li class="mdl-menu__item">Edit site  </li></a>';

        }
        echo '</ul>';
    }

}

?>