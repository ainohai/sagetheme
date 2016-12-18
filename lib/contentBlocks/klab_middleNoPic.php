<?php

namespace Roots\Sage\KlabMiddleNoPic;
use Roots\Sage\KlabTemplFunctions;

function echoBlock ($wpQuery, $showTitle = true, $showPic = false)
{
    global $post;
    $blockName = 'middleNoPic';
    if ($wpQuery->have_posts()) { ?>

        <section class="<?php echo KlabTemplFunctions\constructSectionClasses($wpQuery); ?>">

        <?php
        while ($wpQuery->have_posts()) : $wpQuery->the_post();
            global $post;
            ?>

            <div class="editableContent <?php echo $blockName; ?>"
                 data-postTypeSlug="<?php echo get_post_type($post); ?>"
                 data-id="<?php $post->ID; ?>">

               <?php  echoContent($blockName, $showTitle, $showPic); ?>
            </div>

        <?php endwhile;
    }
    ?>

    </section>

    <?php $wpQuery->reset_postdata();
}

function echoContent($blockName, $showTitle, $showPic, $content = null, $title = null) {
global $post; ?>

<div class="mdl-grid  <?php echo $blockName; ?>__text">

    <?php if ($showTitle) { ?>
        <h1 class="mdl-cell--8-col mdl-cell--2-offset">
            <?php if (!empty($title)) { echo $title; }
            else { the_title(); } ?></h1>
    <?php } ?>

    <div class=" mdl-cell--8-col mdl-cell--2-offset"><?php
        if(!empty($content)) {
            echo wpautop($content);
        } else { the_content(); } ?></div>


    <?php if ($showPic && has_post_thumbnail($post->ID)) { ?>

        <div class=" mdl-cell--10-col mdl-cell--1-offset"  style="background-image: url('<?php echo the_post_thumbnail_url()?>'">
        </div>


    <?php } ?>

</div>

<?php } ?>