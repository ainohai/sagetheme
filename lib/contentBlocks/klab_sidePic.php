<?php

namespace Roots\Sage\KlabSidePic;
use Roots\Sage\KlabTemplFunctions;
use Roots\Sage\KlabMiddleNoPic;

function echoBlock ($wpQuery, $metadataArray=null, $showTitle = false, $classes = null, $imageSize = 'medium') {

    $blockName = 'sidePic';
    if ($wpQuery->have_posts()) { ?>

        <section class="<?php echo $blockName . ' ' .KlabTemplFunctions\constructSectionClasses($wpQuery); ?>">

        <?php
        while ($wpQuery->have_posts()) : $wpQuery->the_post();
            global $post;
            ?>
            <?php echoContent ($showTitle, $imageSize);

            KlabTemplFunctions\echoMetaMiddle($post, $metadataArray);

        endwhile;
    }
    ?>

    </section>

    <?php $wpQuery->reset_postdata();
}

function echoContent ($showTitle = false, $imageSize = 'medium') {
    $blockName = 'sidePic';
    global $post; ?>

    <div class="editableContent mdl-grid <?php echo $blockName; ?>"
         data-postTypeSlug="<?php echo get_post_type($post); ?>"
         data-id="<?php echo $post->ID; ?>" id="<?php echo $post->post_name ?>">

        <?php if (has_post_thumbnail($post->ID)) { ?>

            <div class="mdl-card__media mdl-cell--5-col">
                <?php  the_post_thumbnail($imageSize);  ?>
            </div>

        <?php } ?>

        <div class="mdl-cell--7-col <?php echo $blockName . "__content" ?>"
        <?php if($showTitle) { ?>
            <h1 class="mdl-card__title-text "><?php the_title() ?></h1>
        <?php } ?>
        <div class="mdl-card__supporting-text"><?php the_content(); ?></div>

    </div>

<?php } ?>