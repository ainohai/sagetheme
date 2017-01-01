<?php

namespace Roots\Sage\KlabTemplFunctions;

use Roots\Sage\KlabMiddleNoPic;

function getPageHeaderAndContent ($wpQuery, $showHeader = true, $showFeaturedImg = true)
{

    if ($wpQuery->have_posts()) { ?>

        <section class = "<?php echo constructSectionClasses ($wpQuery); ?>">

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

function getPageContentClasses(){
    return " page-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col";
}

function constructPostClasses () {

}

function constructSectionClasses ($wpQuery) {
    $postsArray = $wpQuery->get_posts();
    $postId = $postsArray[0]->ID;
    $postType = $postsArray[0]->post_type;
    $pageTemplate = '';

    $classes = 'postSection';
    $classes .= ' postType-'.$postType;
   //$classes .= ' firstPostId-'.$postId;

    if ($postType === 'page') {
        $classes .= ' pageTemplate-';
        $wpQuery->is_front_page() ?  $classes .= 'front_page':
            $classes .= get_post_meta( $postId, '_wp_page_template', true );
    }

    return $classes;
}

function echoMetaMiddle($post, $metadataArray) {
    if (!empty($metadataArray)) {
                //print_r(get_post_meta($post->ID));
                foreach ($metadataArray as $metas) {
                    $meta = get_post_meta( $post->ID, $metas['key'], true );
                    if (!empty($metas['title'])) {
                        KlabMiddleNoPic\echoContent(true, false, $meta, $metas['title']);
                    } else {
                        KlabMiddleNoPic\echoContent(false, false, $meta);
                    }
                }
            }
}

//for debugging purposes
function dumpPostData($wpQuery) {
     if ($wpQuery->have_posts()) { ?>

        <section class = "<?php echo constructSectionClasses ($wpQuery); ?>">

        <?php
        while ($wpQuery->have_posts()) : $wpQuery->the_post();
            global $post;
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


?>