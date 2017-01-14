<?php

namespace Roots\Sage\KlabMiddleNoPic;
use Roots\Sage\KlabTemplFunctions;

function echoBlock ($wpQuery, $metadataArray = null, $showTitle = true, $showPic = false)
{

    if ($wpQuery->have_posts()) { ?>

        <?php
        while ($wpQuery->have_posts()) : $wpQuery->the_post();
            global $post;

            echoContent($showTitle, $showPic);
            KlabTemplFunctions\echoMetaMiddle($post, $metadataArray);

        endwhile;
    }
    ?>


    <?php $wpQuery->reset_postdata();
}

//call from loop.
function echoContent($showTitle, $showPic, $content = null, $title = null) {
global $post; ?>

<?php $blockName = 'middleNoPic'; ?>
<div class="mdl-grid  <?php echo $blockName; ?> editableContent" data-postTypeSlug="<?php echo get_post_type($post); ?>"
                 data-id="<?php $post->ID;?>" >
<div class="mdl-card mdl-cell--12-col">
    <?php if ($showTitle) { ?>
        <h2>
            <?php if (!empty($title)) { echo $title; }
            else { the_title(); } ?></h2>
    <?php } ?>

    <div class="mdl-card__supporting-text"><?php
        if($content != null) {
            echo apply_filters( 'the_content', wp_kses_post( $content ) );
        } else { the_content(); } ?></div>


    <?php if ($showPic && has_post_thumbnail($post->ID)) { ?>

        <div class="mdl-card__media">
            <?php the_post_thumbnail( 'large' ); ?>
        </div>


    <?php } ?>
</div>
</div>

<?php } ?>