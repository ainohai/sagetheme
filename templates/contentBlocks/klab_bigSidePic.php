<?php namespace Roots\Sage\KlabBigSidePic;

function echoContent($blockModifier) {

    $blockName = 'bigSidePic';

    global $post;
    ?>

    <div class="mdl-grid editableContent <?php echo $blockName .' '. $blockName .'--' . $blockModifier; ?>"
         data-postTypeSlug="<?php echo get_post_type($post); ?>"
         data-id="<?php $post->ID; ?>">


        <div class="mdl-cell  mdl-card mdl-cell--5-col">
            <div class="mdl-card__media" <?php if($blockModifier == 'contact') echo 'id="map"';?>>
                <?php if($blockModifier != 'contact') {
                    the_post_thumbnail('medium');
                }
                ?>

            </div>
        </div>

        <div class="mdl-cell mdl-cell--7-col mdl-card <?php echo $blockName . "__content" ?>">
            <div class="mdl-card__supporting-text">
                <?php
                the_content();
                ?></div>

        </div>

    </div>

<?php } ?>