<?php namespace Roots\Sage\KlabResearchTopic;
use Roots\Sage\ContentInBox\KlabContentInBox;
use Roots\Sage\KlabEchoPostType\KlabAbstractEchoPostType;
use Roots\Sage\KlabTemplFunctions;

class KlabResearchTopic extends KlabAbstractEchoPostType
{
    const POST_TYPE_SLUG = 'klab_research_topic';
    const BLOCK_MODIFIER = 'research';

    public function __construct()
    {
        parent::__construct(self::POST_TYPE_SLUG, self::BLOCK_MODIFIER);
    }

    protected function echoWpLoop() {

        global $post;

        $abstractSection = new KlabContentInBox(false, false);
        $abstractSection->setContent(get_the_content());
        $abstractSection->setTitle(get_the_title());
        $abstractSection->setImage(get_the_post_thumbnail());
        $abstractSection->run();

        $researchDetailSection = new KlabContentInBox(false, false);
        $researchDescr = get_post_meta($post->ID, 'klab_research_topic_klabResearchDescription', true);
        $researchDetailSection->setContent(wp_kses_post($researchDescr));
        $researchDetailSection->run();

        /*    $this->echoContent('abstract');
            if (self::POST_TYPE_SLUG == $post->post_type) {
                $researchDescr = get_post_meta($post->ID, 'klab_research_topic_klabResearchDescription', true);
                $this->echoContent('reseachTopicDetails', false, $researchDescr);
            }
        */

    }

//call from loop.
    private function echoContent($blockModifier, $showTitle = true, $content = null)
    {
        global $post; ?>

        <?php $blockNames = 'researchCol'; ?>
        <?php if (!empty($blockModifier) && $blockModifier != null) {

        $blockNames = $blockNames . ' ' . $blockNames . '--' . $blockModifier;
    } ?>
        <div class="mdl-card mdl-cell--12-col <?php echo $blockNames; ?>">

            <?php if ($showTitle) { ?>
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text"><?php the_title(); ?></h2>
                </div>
                <div class="mdl-card__media">
                    <?php the_post_thumbnail('large'); ?>
                   <?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?>
                </div>
            <?php } ?>

            <div class="mdl-card__supporting-text">
                <?php if ($content != null) {
                    echo apply_filters('the_content', wp_kses_post($content));
                } else {
                    the_content();
                }
                ?>
            </div>
        </div>

    <?php }

    public function echoResearchTopicNav () {
        $wpQuery = $this->wpQuery;

        if ($wpQuery->have_posts()) {
            global $post;

            echo '<ul class="mdl-list researchTopicNav">';

            while ($wpQuery->have_posts()) : $wpQuery->the_post();

                echo '<li class="mdl-list__item"><a href="#' . $post->post_name . '">'. $post->post_title .'</a></li>';
            endwhile;

            echo '</ul>';

        }

        $wpQuery->reset_postdata();
    }
}
?>
