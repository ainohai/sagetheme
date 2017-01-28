<?php namespace Roots\Sage\KlabResearchTopic;
use Roots\Sage\KlabTemplFunctions;

function echoBlock ($wpQuery, $showTitle = true, $researchTopic=true)
{
    global $wp_query;

    if ($wpQuery->have_posts()) {

        $blockModifier = 'reseach';
        $editorBlock = ($researchTopic) ? 'abstract' : 'content';
        ?>

        <section class="<?php echo KlabTemplFunctions\constructSectionClasses($wp_query, $blockModifier); ?>">

            <?php
            while ($wpQuery->have_posts()) : $wpQuery->the_post();
                global $post;

                echoContent($editorBlock, $showTitle);
                if ('klab_research_topic' == $post->post_type) {
                    $contentBlock = 'reseachTopicDetails';
                    $researchDescr = get_post_meta($post->ID, 'klab_research_topic_klabResearchDescription', true);
                    echoContent($contentBlock, false, $researchDescr);
                }

            endwhile;
            ?>
        </section>
    <?php }
    ?>


    <?php $wpQuery->reset_postdata();
}

//call from loop.
function echoContent($blockModifier, $showTitle, $content = null) {
    global $post; ?>

    <?php $blockNames = 'researchCol'; ?>
    <?php if (!empty($blockModifier) && $blockModifier != null ) {

        $blockNames = $blockNames . ' ' . $blockNames . '--' . $blockModifier;
    } ?>
    <div class="mdl-card mdl-cell--12-col <?php echo $blockNames; ?> editableContent"
         data-postTypeSlug="<?php echo get_post_type($post); ?>"
         data-id="<?php echo $post->ID;?>"
         id = "<?php echo  $post->post_name ?>">

        <?php if($showTitle) { ?>
        <div class="mdl-card__title">
            <h2 class="mdl-card__title-text"><?php  the_title(); ?></h2>

        </div>
        <?php } ?>

        <div class="mdl-card__supporting-text">
            <?php  if ($content != null) {
                echo apply_filters('the_content', wp_kses_post($content));
            } else {
                the_content();
            }
            ?>
        </div>
    </div>

<?php }

?>
