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

function echoPrimaryNavigation () {

    $frontPageId = get_option( 'page_on_front' );
    $navMenuPages = getPageAndItsChildren($frontPageId);
    global $post;
    $currentSlug=!empty($post) ? $post->post_name : null;
    if (!empty($navMenuPages)) {
        echo '<nav class="mdl-navigation" >';
        foreach ($navMenuPages as $navMenuPage) {
            echo '<a class="mdl-navigation__link';
            if ($currentSlug === $navMenuPage->post_name) {
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
        echo '</nav >';
    }
}

function getPageAndItsChildren($pageId) {
    $wpQuery = new \WP_Query;
    $parent = $wpQuery->query(array(
            'page_id' => $pageId
        )
    );

    $wpQuery2 = new \WP_Query();
    $children = $wpQuery2->query(array(
        'post_type' => 'page',
        'post_parent'    => $pageId,
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC',
    ));

    return array_merge($parent, $children);
}

function echoIntraLinks() {
    $wpQuery = new \WP_Query();
    $intraLinks = $wpQuery->query(array(
        'post_type' => 'klab_intra_links',
        'posts_per_page' => -1,
        'orderby' => 'modified',
        'order' => 'ASC',
    ));


    if (!empty($intraLinks)) {
        echo '<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect intraLinkList" for="klab_intra_links">';
        foreach ($intraLinks as $link) {
            $meta = get_post_meta( $link->ID);
            //print_r($meta);

            echo '<li class="mdl-menu__item"><a class="" 
                 href = "'. $meta['klab_intra_links_klabLinkUrl'][0] .'" >'
                .$link->post_title.'</a ></li>';
        }
        echo '</ul>';
    }

}

function echoOnPageLinks ($wpQuery) {
    if ($wpQuery->have_posts()) {
        global $post;
       // echo '<div class="mdl-layout mdl-layout--fixed-drawer">';
       // echo '<div class="mdl-layout__drawer" aria-hidden="true">';
        echo '<ul class="mdl-list">';

        while ($wpQuery->have_posts()) : $wpQuery->the_post();

            echo '<li class="mdl-list__item"><a href="#' . $post->post_name . '">'. $post->post_title .'</a></li>';
        endwhile;

        echo '</ul>';
        //echo '</div>';
        //echo '</div>';
    }

    $wpQuery->reset_postdata();
}

?>