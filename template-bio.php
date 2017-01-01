<?php
/**
 * Template Name: Bio
 */
?>
<?php
use Roots\Sage\KlabMiddleNoPic;
use Roots\Sage\KlabSidePic;
?>

<?php global $wp_query;
    global $post;
    $currentPage=$post->ID;?>

<?php KlabSidePic\echoBlock($wp_query, array(['key'=>'page_biodetails'], ['key'=>'page_cv', 'title' => 'CV']), false, array(), array(400, 550)); ?>

<?php
$wpQuery = new WP_Query();
$children = $wpQuery->query(array(
                                    'post_type' => 'page',
                                    'post_parent'    => $currentPage,
                                    'posts_per_page' => -1,
                                    'orderby' => 'menu_order',
                                    'order' => 'ASC',
));

KlabMiddleNoPic\echoBlock($wpQuery);
?>