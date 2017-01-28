<?php

namespace Roots\Sage\KlabNewsBlock;
use Roots\Sage\KlabTemplFunctions;
use Roots\Sage\KlabSingleColCard;

function echoNewsBlock ($wpQuery)
{
    global $post;
    $blockName = 'news';

    if ($wpQuery->have_posts()) {
        $totalPostCount = $wpQuery->post_count;
         if ($totalPostCount > 1) { ?>
            <section class="<?php echo KlabTemplFunctions\constructSectionClasses($wpQuery, $blockName); ?>">

            <?php
        }

        $i = $totalPostCount;
        while ($wpQuery->have_posts()) : $wpQuery->the_post();
            global $post;
            $i = --$i;

            if ($i != 0) {
                ?>

                <div class="mdl-grid editableContent <?php echo $blockName; ?>"
                     data-postTypeSlug="<?php echo get_post_type($post); ?>"
                     data-id="<?php $post->ID; ?>">

                    <?php if (has_post_thumbnail($post->ID)) { ?>
                        <div class="mdl-cell mdl-cell--3-col mdl-card <?php echo $blockName; ?>__image">
                            <div class="mdl-card__media"  style="background-image: url('<?php echo the_post_thumbnail_url()?>'">
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="mdl-cell mdl-cell--3-col mdl-layout--large-screen-only mdl-card <?php echo $blockName; ?>__image">
                            <div class="mdl-card__media">
                                <h2><?php the_title() ?></h2>
                            </div>
                        </div>
                    <?php } ?>



                    <div class="mdl-cell mdl-card mdl-cell--9-col <?php echo $blockName; ?>__text">
                        <h2 class="mdl-card__title-text"><?php the_title() ?></h2>
                        <div class="mdl-card__supporting-text"><?php the_content(); ?></div>
                    </div>
                </div>
                <?php
                // only one post left.
            } else {
                echo ($totalPostCount > 1) ? '</section>' : '';
                ?>
                <div class= "mdl-grid">

                <section  class="mdl-cell mdl-cell--6-col  <?php echo KlabTemplFunctions\constructSectionClasses($wpQuery, $blockName, true, true); ?>">
                <?php KlabSingleColCard\echoContent(true, true, 'singleNews'); ?>
                </section>
                <?php }
                ?>

                <?php endwhile;
            }
    ?>


    <?php //contents of custom facebook feed plugin ?>
    <section class="mdl-cell mdl-cell--6-col postSection postSection--facebookFeed">
        <div class="mdl-card">

            <h2 class="mdl-card__title-text">Klefström lab on facebook </h2>
            <?php echo do_shortcode('[custom-facebook-feed]'); ?>
        </div>

    </section>
    </div> <!--end mdl-grid -->

    <?php $wpQuery->reset_postdata();
}