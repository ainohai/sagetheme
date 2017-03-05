<?php namespace Roots\Sage\KlabLabContentSide;

function echoContent ($blockModifier, $title, $content = null) {

global $post;
$blockName = 'contentSide'; ?>

<div class="mdl-grid editableContent <?php echo $blockName . ' ' .$blockName .'--' .$blockModifier?>"
     data-postTypeSlug="<?php echo get_post_type($post); ?>"
     data-id="<?php $post->ID; ?>">
    <div class="mdl-cell mdl-cell--12-col mdl-card <?php echo $blockName . "__content"; ?>">
        <div class="mdl-card__title">
            <h2 class="mdl-card__title-text"><?php echo $title; ?></h2>
        </div>
        <div class="mdl-card__supporting-text"><?php
            if (!empty($content)) {
                echo apply_filters( 'the_content', wp_kses_post( $content ) );
            }
            else {
                the_content();
            }

            ?>
        </div>

    </div>

</div>
<?php
}
?>