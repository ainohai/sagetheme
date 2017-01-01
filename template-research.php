<?php
/**
 * Template Name: Research Template
 */
?>

<?php
use Roots\Sage\KlabMiddleNoPic;
use Roots\Sage\KlabSidePic;
use Roots\Sage\KlabNavMenus;
?>

<?php global $wp_query;
global $post;
$currentPage=$post->ID;

?>
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--9-col">
        <?php

        KlabMiddleNoPic\echoBlock($wp_query, null, false);

        $childQuery = new WP_Query();
        $childQuery->query(array(
            'post_type' => 'page',
            'post_parent'    => $currentPage,
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC',
        ));

        KlabMiddleNoPic\echoBlock($childQuery);

        $researchTopicsQuery = new WP_Query();
        $researchTopicsQuery->query(array(
            'post_type' => 'klab_research_topic',
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC',
        ));

        KlabMiddleNoPic\echoBlock($researchTopicsQuery, array(['key'=>'klab_research_topic_klabResearchDescription']), true, true); ?>

    </div>
<div class="mdl-cell mdl-cell--3-col">
    <?php KlabNavMenus\echoOnPageLinks($researchTopicsQuery); ?>
</div>
</div>