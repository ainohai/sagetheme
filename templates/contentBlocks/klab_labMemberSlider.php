<?php namespace Roots\Sage\KlabLabMemberSlider;
use Roots\Sage\KlabTemplFunctions;
use Roots\Sage\KlabFullPicSingleCol;

function echoBlock ($wpQuery, $title=null)
{


    if ($wpQuery->have_posts()) {

        $blockModifier = 'imageSlider';
        ?>

        <section class="<?php echo KlabTemplFunctions\constructSectionClasses($wpQuery, $blockModifier, false); ?>">

            <ul class="rslides">

            <?php
            while ($wpQuery->have_posts()) : $wpQuery->the_post();
                global $post; ?>

                <li>
                    <div class="captionContainer">
                        <p class="caption"><?php the_title() ?></p>
                    </div>
                    <?php KlabFullPicSingleCol\echoContent(true, true, false, 'labMemberSlider', null, $title); ?>
                </li>

    <?php        endwhile;
            ?>
            </ul>
        </section>
    <?php }
    ?>


    <?php $wpQuery->reset_postdata();

}?>