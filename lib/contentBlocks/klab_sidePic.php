<?php

namespace Roots\Sage\KlabSidePic;
use Roots\Sage\KlabTemplFunctions;
use Roots\Sage\KlabMiddleNoPic;

function echoBlock ($wpQuery, $metadataArray=null, $showTitle = false)
{
    global $post;
    $blockName = 'sidePic';
    if ($wpQuery->have_posts()) { ?>

        <section class="<?php echo KlabTemplFunctions\constructSectionClasses($wpQuery); ?>">

        <?php
        while ($wpQuery->have_posts()) : $wpQuery->the_post();
            global $post;
            ?>

            <div class="editableContent mdl-grid <?php echo $blockName; ?>"
                     data-postTypeSlug="<?php echo get_post_type($post); ?>"
                     data-id="<?php $post->ID; ?>">

                <?php if (has_post_thumbnail($post->ID)) { ?>

                    <div class="mdl-card__media mdl-cell--5-col">
                       <?php  the_post_thumbnail('medium');  ?>
                    </div>

                <?php } ?>



                <div class="mdl-cell--7-col <?php echo $blockName . "__content" ?>"
                <?php if($showTitle) { ?>
                    <h1 class="mdl-card__title-text "><?php the_title() ?></h1>
                <?php } ?>
                <div class="mdl-card__supporting-text"><?php the_content(); ?></div>

                <?php if (!empty($metadataArray)) {
                    foreach ($metadataArray as $metas) {
                        $meta = get_post_meta( $post->ID, $metas['key'], true );
                        if (!empty($metas['title'])) {
                            KlabMiddleNoPic\echoContent($blockName, true, false, $meta, $metas['title']);
                        } else {
                            KlabMiddleNoPic\echoContent($blockName, false, false, $meta);
                        }
                    }
            } ?>

            </div>

        <?php endwhile;
    }
    ?>

    </section>

    <?php $wpQuery->reset_postdata();
}
