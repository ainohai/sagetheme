<?php

namespace Roots\Sage\KlabFullPicSingleCol;
use Roots\Sage\KlabTemplFunctions;
use Roots\Sage\Setup\EditAnchors;

define('FULL_SINGLE_PIC','fullSinglePic');
define('SINGLE_CONTENT','content');

function echoBlock ($wpQuery, $metadataArray = null, $showTitle = true, $showPic = true, $showContent = true)
{
    global $wp_query;

    if ($wpQuery->have_posts()) {
        $postsArray = $wpQuery->get_posts();
        $blockModifier = ($showPic && !$showContent) ? FULL_SINGLE_PIC : SINGLE_CONTENT;?>


        <section class="<?php echo KlabTemplFunctions\constructSectionClasses($wp_query, $blockModifier, !$showPic); ?>">

            <?php
            while ($wpQuery->have_posts()) : $wpQuery->the_post();
                global $post;

                echoContent($showTitle, $showPic, $showContent, $blockModifier);
                echoMetaMiddle($post, $metadataArray);

            endwhile;
            ?>
        </section>
    <?php }
    ?>


    <?php $wpQuery->reset_postdata();
}

//call from loop.
function echoContent($showTitle, $showPic, $showContent = true, $blockModifier = null, $content = null, $title = null) {
    global $post; ?>

    <?php $blockNames = 'middleSingleCol'; ?>
    <?php if (!empty($blockModifier) && $blockModifier != null && $blockModifier != '' ) {
        $blockNames = $blockNames . ' ' . $blockNames . '--' . $blockModifier;
    } ?>
    <div class="mdl-card mdl-cell--12-col <?php echo $blockNames; ?> editableContent"
         data-postTypeSlug="<?php echo get_post_type($post); ?>"
         data-id="<?php $post->ID;?>">

        <?php if ($showPic) {
            $imageUrl = null;
            if (has_post_thumbnail($post->ID)) {
                $imageUrl = get_the_post_thumbnail_url();
            }
            else {
                $imageUrl = get_the_post_thumbnail_url(get_option('page_on_front'));

            } ?>

            <div class="mdl-card__media" style="background-image: url('<?php echo $imageUrl ?>'">
                <?php if( current_user_can('editor') || current_user_can('administrator')) {
                    echo '<div class="absoluteEditButton">';
                    echo KlabTemplFunctions\getEditPostButtonInLoop(EditAnchors::getThumbnailAnchor());
                    echo '</div>';
                } ?>
                <?php if ($showTitle) { ?>
                    <div class="mdl-card__title">
                        <h1 class="mdl-card__title-text">
                            <?php if (empty($title)) {
                                (is_front_page()) ? bloginfo('name') : the_title();
                            } else {
                                echo $title;
                            } ?>

                        </h1>
                    </div>
                <?php } ?>

            </div>


        <?php } ?>

        <?php if ($showTitle && !$showPic) { ?>
            <h2>
                <?php
                if (!empty($title)) { echo $title; }
                else { the_title(); } ?>
            </h2>
        <?php } ?>

        <?php
        if ($showContent) {
            if ($content != null) {
                echo apply_filters('the_content', wp_kses_post($content));
            } else {
                the_content();
            }
        }?>

    </div>

<?php }

function echoMetaMiddle($post, $metadataArray) {
    if (!empty($metadataArray)) {
//print_r(get_post_meta($post->ID));
        foreach ($metadataArray as $metas) {
            $meta = get_post_meta( $post->ID, $metas['key'], true );
            if (!empty($metas['title'])) {
                echoContent(true, false, true, null, $meta, $metas['title']);
            } else {
                echoContent(false, false, true, null, $meta);
            }
        }
    }
}

?>
