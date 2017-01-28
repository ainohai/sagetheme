<?php

namespace Roots\Sage\KlabFullPicSingleCol;
use Roots\Sage\KlabTemplFunctions;

function echoBlock ($wpQuery, $metadataArray = null, $showTitle = true, $showPic = true, $showContent = true)
{
    global $wp_query;

    if ($wpQuery->have_posts()) {
        $postsArray = $wpQuery->get_posts();
        $blockModifier = $postsArray[0]->slug;?>


        <section class="<?php echo KlabTemplFunctions\constructSectionClasses($wp_query, $blockModifier, false); ?>">

            <?php
            while ($wpQuery->have_posts()) : $wpQuery->the_post();
                global $post;

                echoContent($showTitle, $showPic, $showContent, $blockModifier);
                echoMetaMiddle($post, $metadataArray);

            endwhile;
            ?>
        </section>
    <?php }
    ?>


    <?php $wpQuery->reset_postdata();
}

//call from loop.
function echoContent($showTitle, $showPic, $showContent = true, $blockModifier = null, $content = null, $title = null) {
    global $post; ?>

    <?php $blockNames = 'middleSingleCol'; ?>
    <?php if (!empty($blockModifier) && $blockModifier != null ) {
        $blockNames = $blockNames . ' ' . $blockNames . '--' . $blockModifier;
    } ?>
    <div class="mdl-card mdl-cell--12-col <?php echo $blockNames; ?> editableContent"
         data-postTypeSlug="<?php echo get_post_type($post); ?>"
         data-id="<?php $post->ID;?>">

        <?php if ($showPic) {
            $imageUrl = null;
            if (has_post_thumbnail($post->ID)) {
                $imageUrl = get_the_post_thumbnail_url();
            }
            else {
                $imageUrl = get_the_post_thumbnail_url(get_option('page_on_front'));

            } ?>

            <div class="mdl-card__media" style="background-image: url('<?php echo $imageUrl ?>'">
                <?php if($showTitle) { ?>
                    <div class="mdl-card__title">
                        <h1 class="mdl-card__title-text"><?php (is_front_page()) ? bloginfo('name') : the_title() ; ?></h1>
                    </div>
                <?php }?>
            </div>


        <?php } ?>
        <div class="mdl-grid">
            <div class="mdl-cell--8-col mdl-cell--1-offset-desktop mdl-card__supporting-text">
                <?php if ($showTitle && !$showPic) { ?>
                    <h2>
                        <?php
                        if (!empty($title)) { echo $title; }
                        else { the_title(); } ?>
                    </h2>
                <?php } ?>

                <?php
                if ($showContent) {
                    if ($content != null) {
                        echo apply_filters('the_content', wp_kses_post($content));
                    } else {
                        the_content();
                    }
                }?>
            </div>
        </div>
    </div>

<?php }

function echoMetaMiddle($post, $metadataArray) {
    if (!empty($metadataArray)) {
//print_r(get_post_meta($post->ID));
        foreach ($metadataArray as $metas) {
            $meta = get_post_meta( $post->ID, $metas['key'], true );
            if (!empty($metas['title'])) {
                echoContent(true, false, true, null, $meta, $metas['title']);
            } else {
                echoContent(false, false, true, null, $meta);
            }
        }
    }
}

?>
