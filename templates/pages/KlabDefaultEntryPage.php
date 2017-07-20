<?php
/**
 * Created by PhpStorm.
 * User: aino
 * Date: 13.4.2017
 * Time: 17:44
 */

namespace Roots\Sage\KlabPage;

use Roots\Sage\ContentInBox\KlabContentInBox;
use Roots\Sage\FullPageImage\KlabFullPageImage;
use Roots\Sage\KlabResearchTopic\KlabResearchTopic;

class KlabDefaultEntryPage extends KlabDefaultPage
{
    private $noTitleOnPic;

    public function __construct($noTitleOnPic = false)
    {
        parent::__construct();
        $this->noTitleOnPic = $noTitleOnPic;
    }

    public function echoPage() {

        $this->echoHeaderPic();

        $contentInBox = new KlabContentInBox();
        $contentInBox->setContent(get_the_content());
        $contentInBox->run();
        if (!empty(get_the_content())) {
            \Roots\Sage\KlabTemplFunctions\echoDivider();
        }
    }

    public function echoHeaderPic() {
        $headerPic = new KlabFullPageImage();
        $headerPic->setBackgroundImageUrl($this->getImageUrl());
        $headerPic->setCaption($this->getImageCaption());
        if (!$this->noTitleOnPic) {
            $title = is_front_page() ? get_bloginfo('name', 'display') : get_the_title();
            $headerPic->setTitle($title);
        }
        $headerPic->run();
    }

    protected function getImageUrl() {

        global $post;

        if (has_post_thumbnail($post->ID)) {
            return get_the_post_thumbnail_url();
        }
        else {
            return get_the_post_thumbnail_url(get_option('page_on_front'));
        }
    }

    protected function getImageCaption() {
        global $post;
        if (has_post_thumbnail($post->ID)) {
            return get_post(get_post_thumbnail_id($post))->post_excerpt;
        }
        else {
            return get_post(get_post_thumbnail_id((get_option('page_on_front'))))->post_excerpt;
        }
    }

}

class KlabResearchEntryPage extends \Roots\Sage\KlabPage\KlabDefaultEntryPage
{

    protected function echoAfterPage()
    {
        $researchTopics = new KlabResearchTopic();
        ?>
        <section class="<?php echo \Roots\Sage\KlabTemplFunctions\constructWrapperSectionClasses(); ?>">
        <div class="mdl-grid sideBar">
            <aside class="mdl-cell mdl-cell--3-col mdl-cell--hide-phone mdl-cell--hide-tablet sideBarNav">
                <?php $researchTopics->echoResearchTopicNav(); ?>
            </aside>

            <div class="mdl-cell mdl-cell--9-col mdl-cell--12-col-phone mdl-cell--12-col-tablet sideBarContent">
                <?php $researchTopics->echoPosts(); ?>
            </div>
        </div>
        </section>
        <?php
    }
}

class KlabPublicationPage extends \Roots\Sage\KlabPage\KlabDefaultEntryPage
{

    const BLOCK_FOR_FULL_ARTICLE_LIST ='allPublicationsList';

    protected function echoAfterPage()
    {

        $this->echoPubsList(true);

        \Roots\Sage\KlabTemplFunctions\echoDivider();

        $this->echoPubsList(false);

    }

    private function echoPubsList($justSelectedPubs){

        global $post;
        $metadataArray =  get_post_meta( $post->ID);

        $description = "";
        if ($justSelectedPubs) {
            $description = isset($metadataArray["page_selectedPubsListInfo"]) ? $metadataArray["page_selectedPubsListInfo"][0] :'';
        }
        else {
            $description = isset($metadataArray["page_fullPubsListInfo"]) ? $metadataArray["page_fullPubsListInfo"][0] : '';
        }

        echo '<section class="'. \Roots\Sage\KlabTemplFunctions\constructWrapperSectionClasses() .'">';
        echo '<div class="'. \Roots\Sage\KlabTemplFunctions\constructSectionClasses(self::BLOCK_FOR_FULL_ARTICLE_LIST, true, false) .'">';

        $publications = new \Roots\Sage\KlabEchoPostType\KlabPublications(apply_filters( 'the_content', wp_kses_post($description)), $justSelectedPubs);
        $publications->echoPosts();

        echo '</div>';
        echo '</section>';

        wp_reset_postdata();

    }
}

class KlabTutkimuksemmeChildPage extends \Roots\Sage\KlabPage\KlabDefaultEntryPage
{
    public function echoPage()
    {
        global $post;
        if (has_post_thumbnail($post->ID)) {
            $headerPic = new \Roots\Sage\FullPageImage\KlabFullPageImage(true);
            $headerPic->setBackgroundImageUrl($this->getImageUrl());
            $headerPic->setCaption($this->getImageCaption());

            $headerPic->run();
        }

        $mainContent = new KlabContentInBox();
        $mainContent->setContent(get_the_content());

        $mainContent->run();

    }

}?>