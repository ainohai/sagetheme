<?php
/**
 * Template Name: Research Template
 */
?>

<?php
use Roots\Sage\KlabResearchTopic;
use Roots\Sage\KlabNavMenus;
use Roots\Sage\KlabFullPicSingleCol;
?>

<?php global $wp_query;
global $post;
$currentPage=$post->ID;

$researchTopicsQuery = new WP_Query();
$researchTopicsQuery->query(array(
    'post_type' => 'klab_research_topic',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC',
));

?>
<?php KlabFullPicSingleCol\echoBlock($wp_query, null, true, true, false);

?>
<div class="mdl-grid research-topics">
    <aside class="mdl-cell mdl-cell--3-col mdl-cell--hide-phone mdl-cell--hide-tablet research__sidebar">

        <?php KlabNavMenus\echoOnPageLinks($researchTopicsQuery);

        ?>
    </aside>
    <div class="mdl-cell mdl-cell--9-col mdl-cell--12-col-phone mdl-cell--12-col-tablet research__mainContent">
        <?php KlabResearchTopic\echoBlock($wp_query, false, false); ?>
        <?php $childQuery = new WP_Query();
        $childQuery->query(array(
        'post_type' => 'page',
        'post_parent'    => $currentPage,
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC',
        ));

        KlabResearchTopic\echoBlock($childQuery); ?>
        <?php

        KlabResearchTopic\echoBlock($researchTopicsQuery); ?>

    </div>

</div>
