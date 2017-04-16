<?php

namespace Roots\Sage\KlabTemplFunctions;

use Roots\Sage\KlabFullPicSingleCol;

function getEditPostButtonInLoop($anchor) {
    return '<a class="adminEdit" href="' . get_edit_post_link() .'#'. $anchor .'"><button class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored adminEdit__button">
            <i class="material-icons">edit</i>
        </button></a>';
}

function getPageContentClasses(){
    return " page-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col";
}

//TODO: Remove wpquery from params.
function constructSectionClasses ($sectionName, $gridSpacing = true, $noGrid = false, $modifierArray = null) {

    $classes = (!$noGrid) ? 'mdl-grid' : '';
    if (!$gridSpacing){
        $classes .= ' mdl-grid--no-spacing';
    }

    $classes .= ' postSection';

    if (!empty($sectionName )) {
        $classes .= ' postSection--'.$sectionName;
    }

    if (!empty($modifierArray)) {
        foreach ($modifierArray as $modifier) {
            $classes .= ' '.$modifier;
        }
    }

    /*if ($postType === 'page' && is_admin()) {
        $classes .= ' pageTemplate-';
        $wpQuery->is_front_page() ?  $classes .= 'front_page':
            $classes .= get_post_meta( $postId, '_wp_page_template', true );
    }*/

    return $classes;
}

function getPostsOrderedByTaxonomyCats($taxonomyName, $wpQuery)
{
    $resultArray = array();
    while ($wpQuery->have_posts()) : $wpQuery->the_post();
        global $post;

        $postTaxonomyCategories = get_the_terms($post->ID, $taxonomyName);
        //print_r($postTaxonomyCategories);
        if (!empty($postTaxonomyCategories)) {

            foreach ($postTaxonomyCategories as $category) {

                if (!array_key_exists($category->slug, $resultArray)) {
                    $resultArray[$category->slug] = array($post);
                } else {
                    array_push($resultArray[$category->slug], $post);
                }
            }
        }
    endwhile;

    return $resultArray;
}
//for debugging purposes
function dumpPostData($wpQuery) {
     if ($wpQuery->have_posts()) { ?>

        <section class = "<?php echo constructSectionClasses ('dump'); ?>">

        <?php
        while ($wpQuery->have_posts()) : $wpQuery->the_post();
            global $post; print_r(get_the_terms($post->ID, 'labMemberPosition'));
            ?>

            <article class="editableContent" data-postTypeSlug="<?php echo get_post_type($post); ?>"
                     data-id="<?php the_ID(); ?>">
                <?php get_template_part('templates/page', 'header'); ?>
                <?php if (has_post_thumbnail($post->ID)): ?>
                    <?php the_post_thumbnail('thumbnail');?>
                <?php endif; ?>
                <?php get_template_part('templates/content', 'page'); ?>

                <div>
                <h4>Metadatas</h4>
                <ul>
                <?php $metadataArray =  get_post_meta( $post->ID);
                 foreach ($metadataArray as $key => $value) {

                echo '<li>
                    <strong>'. $key .'</strong> : '; print_r($value);
                    echo '
                </li>';

            } ?></ul></div>
            </article>

        <?php endwhile;
    } ?>
    </section>
<?php }

function getPageHeaderAndContent ($wpQuery, $showHeader = true, $showFeaturedImg = true)
{

    if ($wpQuery->have_posts()) { ?>

        <section class = "<?php echo constructSectionClasses ('pageHeaderAndContent'); ?>">

        <?php
        while ($wpQuery->have_posts()) : $wpQuery->the_post();
            global $post;
            ?>

            <article class="editableContent" data-postTypeSlug="<?php echo get_post_type($post); ?>"
                     data-id="<?php the_ID(); ?>">
                <?php $showHeader ? get_template_part('templates/page', 'header') : ''; ?>
                <?php if ($showFeaturedImg && has_post_thumbnail($post->ID)): ?>
                    <?php the_post_thumbnail('thumbnail');?>
                <?php endif; ?>
                <?php get_template_part('templates/content', 'page'); ?>
            </article>

        <?php endwhile;
    }
    ?>

    </section>

    <?php $wpQuery->reset_postdata();

}
?>