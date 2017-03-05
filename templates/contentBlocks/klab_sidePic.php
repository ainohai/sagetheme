<?php

namespace Roots\Sage\KlabSidePic;
use Roots\Sage\KlabTemplFunctions;
use Roots\Sage\KlabFullPicSingleCol;

function echoBlock ($wpQuery, $metadataArray=null, $showTitle = false, $classes = null, $imageSize = 'thumbnail') {

    $blockName = 'sidePic';
    if ($wpQuery->have_posts()) { ?>

        <section class="<?php echo $blockName . ' ' .KlabTemplFunctions\constructSectionClasses($wpQuery, 'bio'); ?>">

        <?php
        while ($wpQuery->have_posts()) : $wpQuery->the_post();
            global $post;
            ?>
            <?php echoContent ($showTitle, $imageSize); ?>
            <div class="sidePic--metaContent">
                <?php KlabTemplFunctions\echoMetaMiddle($post, $metadataArray); ?>
            </div>
<?php
        endwhile;
    }
    ?>

    </section>

    <?php $wpQuery->reset_postdata();
}

function echoContent ($showTitle = false, $imageSize = 'thumbnail') {
    $blockName = 'sidePic--mainContent';
    global $post; ?>

    <div class="editableContent mdl-grid <?php echo $blockName; ?>"
         data-postTypeSlug="<?php echo get_post_type($post); ?>"
         data-id="<?php echo $post->ID; ?>" id="<?php echo $post->post_name ?>">

        <?php if (has_post_thumbnail($post->ID)) { ?>

            <div class="mdl-cell  mdl-card mdl-cell--5-col">
                <div class="mdl-card__media">
                    <?php  the_post_thumbnail($imageSize);  ?>
                </div>
            </div>

        <?php } ?>

        <div class="mdl-cell mdl-cell--7-col mdl-card <?php echo $blockName . "__content" ?>">
            <?php if($showTitle) { ?>
                <h1 class="mdl-card__title-text"><?php the_title() ?></h1>
            <?php } ?>
            <div class="mdl-card__supporting-text"><?php the_content(); ?></div>

        </div>
    </div>

<?php } ?>