<?php

namespace Roots\Sage\KlabTemplFunctions;

use Roots\Sage\KlabFullPicSingleCol;

function getEditPostButtonInLoop($anchor) {
    return '<a class="adminEdit" href="' . get_edit_post_link() .'#'. $anchor .'"><button class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored adminEdit__button">
            <i class="material-icons">edit</i>
        </button></a>';
}

function editPostTypeButtons($postTypeSlug){
    if (!post_type_exists($postTypeSlug)){
        return false;
    }
    if( !current_user_can('editor') && !current_user_can('administrator')) {
        return;
    }
    $postTypeInfo = get_post_type_object( $postTypeSlug );
    //print_r($postTypeInfo);
    ?>

    <div class="adminEdit adminEdit--modPostsButtons">
        <h3> <?php echo $postTypeInfo->labels->name ?> </h3>
        <a href =" <?php echo admin_url( 'edit.php?post_type='.$postTypeSlug); ?>"
        <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
            <?php echo $postTypeInfo->labels->all_items ?>
        </button>
        </a>
        <a href =" <?php echo admin_url( 'post-new.php?post_type='.$postTypeSlug); ?>"
        <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
            <?php echo $postTypeInfo->labels->add_new ?>
        </button>
        </a>
    </div>
    <?php
}

function getPageContentClasses(){
    return " page-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col";
}

function constructSectionClasses ($wpQuery, $sectionName, $gridSpacing = true, $noGrid = false) {
    $postsArray = $wpQuery->get_posts();
    $postId = $postsArray[0]->ID;
    $postType = $postsArray[0]->post_type;


    $classes = (!$noGrid) ? 'mdl-grid' : '';
    if (!$gridSpacing){
        $classes .= ' mdl-grid--no-spacing';
    }
    $classes .= ' postSection postSection--'.$sectionName;

    if ($postType === 'page' && is_admin()) {
        $classes .= ' pageTemplate-';
        $wpQuery->is_front_page() ?  $classes .= 'front_page':
            $classes .= get_post_meta( $postId, '_wp_page_template', true );
    }

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

        <section class = "<?php echo constructSectionClasses ($wpQuery, 'dump'); ?>">

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

        <section class = "<?php echo constructSectionClasses ($wpQuery, 'pageHeaderAndContent'); ?>">

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