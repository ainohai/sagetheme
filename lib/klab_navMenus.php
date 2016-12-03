<?php
/**
 * Created by PhpStorm.
 * User: aino
 * Date: 27.11.2016
 * Time: 21:49
 */
namespace Roots\Sage\KlabNavMenus;

add_action( 'init', __NAMESPACE__ . '\\registerLabHomePageMenu' );
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
};
?>