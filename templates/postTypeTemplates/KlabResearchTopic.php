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
        parent::__construct(self::POST_TYPE_SLUG, self::BLOCK_MODIFIER, null, true);
    }

    protected function echoWpLoopContents() {

        global $post;

        $abstractSection = new KlabContentInBox(false, false, false, false, array('-abstractText'), $post->post_name);
        $abstractSection->setContent(get_the_content());
        $abstractSection->setTitle(get_the_title());
        $abstractSection->setImage(get_the_post_thumbnail());
        $abstractSection->run();

        $researchDetailSection = new KlabContentInBox(false, false);
        $researchDescr = get_post_meta($post->ID, 'klab_research_topic_klabResearchDescription', true);
        $researchDetailSection->setContent(wp_kses_post($researchDescr));
        $researchDetailSection->run();

    }

    public function echoResearchTopicNav () {
        $wpQuery = $this->wpQuery;

        if ($wpQuery->have_posts()) {
            global $post;

            echo '<div class="researchTopicNav">';
            echo '<h4>Research topics</h4>';
            echo '<ul class="mdl-list">';

            while ($wpQuery->have_posts()) : $wpQuery->the_post();

                echo '<li class="mdl-list__item"><a href="#' . $post->post_name . '">'. $post->post_title .'</a></li>';
            endwhile;

            echo '</ul></div>';

        }

        $wpQuery->reset_postdata();
    }
}
?>