<?php

namespace Roots\Sage\KlabNewsBlock;
use Roots\Sage\KlabTemplFunctions;

function echoNewsBlock ($wpQuery)
{
    global $post;
    $blockName = 'news';

    if ($wpQuery->have_posts()) { ?>

        <section class="<?php echo KlabTemplFunctions\constructSectionClasses($wpQuery); ?>">

        <?php
        while ($wpQuery->have_posts()) : $wpQuery->the_post();
            global $post;
            ?>

            <article class="mdl-grid editableContent <?php echo $blockName; ?>"
                     data-postTypeSlug="<?php echo get_post_type($post); ?>"
                     data-id="<?php $post->ID; ?>">

                <?php if (has_post_thumbnail($post->ID)): ?>
                    <style>#<?php echo $blockName . '-' . $post->ID;?>{
                    background-image: url('<?php echo the_post_thumbnail_url()?>') }</style>
                <?php endif; ?>

                    <div class="mdl-cell mdl-cell--5-col mdl-card <?php echo $blockName; ?>__image">
                        <div class="mdl-card__media"  style="background-image: url('<?php echo the_post_thumbnail_url()?>'">


            <?php if (!has_post_thumbnail($post->ID)): ?>
                            <h2><?php the_title() ?></h2>
                <?php endif; ?>
                            </div>
                    </div>

                <div class="mdl-cell mdl-cell--7-col editable" data-inputType = "textArea" data-apiKey = "content:rendered">
                    <h2 class="mdl-card__title-text">the_title() </h2>
                    <?php the_content(); ?>
                    </div>
                </div>
            </article>

        <?php endwhile;
    }
    ?>

    </section>

    <?php $wpQuery->reset_postdata();
}