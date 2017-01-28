<?php
namespace Roots\Sage\KlabSingleColCard;

function echoContent($showTitle, $showPic, $blockModifier = null) {
    global $post; ?>

    <?php $blockNames = 'singleColCard'; ?>
    <?php if (!empty($blockModifier)) {
        $blockNames = $blockNames . ' ' . $blockNames . '--' . $blockModifier;
    } ?>
    <div class="mdl-card <?php echo $blockNames; ?> editableContent"
         data-postTypeSlug="<?php echo get_post_type($post); ?>"
         data-id="<?php $post->ID;?>">

        <?php if ($showPic) {

            if (has_post_thumbnail($post->ID)) {
                $imageUrl = get_the_post_thumbnail_url(); ?>
                <div class="mdl-card__media" style="background-image: url('<?php echo $imageUrl ?>'">

                </div>
            <?php } ?>
        <?php } ?>

        <?php if ($showTitle) { ?>
            <h2  class="mdl-card__title-text">
                <?php the_title(); ?>
            </h2>
        <?php } ?>


        <div class ="mdl-card__supporting-text">
            <?php the_content(); ?>
        </div>

    </div>

<?php } ?>