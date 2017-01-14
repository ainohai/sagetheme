<?php

namespace Roots\Sage\KlabNewsBlock;
use Roots\Sage\KlabTemplFunctions;

function echoNewsBlock ($wpQuery)
{
    global $post;
    $blockName = 'news';

    if ($wpQuery->have_posts()) { ?>

        <section class="<?php echo KlabTemplFunctions\constructSectionClasses($wpQuery, 'news'); ?>">

        <?php
        while ($wpQuery->have_posts()) : $wpQuery->the_post();
            global $post;
            ?>

            <div class="mdl-grid editableContent <?php echo $blockName; ?>"
                 data-postTypeSlug="<?php echo get_post_type($post); ?>"
                 data-id="<?php $post->ID; ?>">




                <?php if (has_post_thumbnail($post->ID)) { ?>
                    <div class="mdl-cell mdl-cell--5-col mdl-card <?php echo $blockName; ?>__image">
                        <div class="mdl-card__media"  style="background-image: url('<?php echo the_post_thumbnail_url()?>'">
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="mdl-cell mdl-cell--5-col mdl-layout--large-screen-only mdl-card <?php echo $blockName; ?>__image">
                        <div class="mdl-card__media">
                            <h2><?php the_title() ?></h2>
                        </div>
                    </div>
                <?php } ?>



                <div class="mdl-cell mdl-card mdl-cell--7-col <?php echo $blockName; ?>__text">
                    <h2 class="mdl-card__title-text"><?php the_title() ?></h2>
                    <div class="mdl-card__supporting-text"><?php the_content(); ?></div>
                </div>
            </div>


        <?php endwhile;
    }
    ?>

    </section>

    <?php $wpQuery->reset_postdata();
}