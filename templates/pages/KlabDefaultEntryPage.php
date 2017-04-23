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

    public function __construct()
    {
        parent::__construct();
    }

    public function echoPage() {

        $this->echoHeaderPic();

        $contentInBox = new KlabContentInBox(true, true);
        $contentInBox->setContent(get_the_content());
        $contentInBox->run();

    }

    public function echoHeaderPic() {
        $headerPic = new KlabFullPageImage();
        $headerPic->setBackgroundImageUrl($this->getImageUrl());
        $headerPic->setCaption($this->getImageCaption());
        $title = is_front_page() ? get_bloginfo( 'name', 'display' ) : get_the_title();
        $headerPic->setTitle($title);
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

        <div class="mdl-grid sideBar">
            <aside class="mdl-cell mdl-cell--3-col mdl-cell--hide-phone mdl-cell--hide-tablet sideBarNav">
                <?php $researchTopics->echoResearchTopicNav(); ?>
            </aside>

            <div class="mdl-cell mdl-cell--9-col mdl-cell--12-col-phone mdl-cell--12-col-tablet sideBarContent">
                <?php $researchTopics->echoPosts(); ?>
            </div>
        </div>
        <?php
    }
}

class KlabPublicationPage extends \Roots\Sage\KlabPage\KlabDefaultEntryPage
{

    const BLOCK_FOR_FULL_ARTICLE_LIST ='allPublicationsList';

    public function echoPage()
    {

        $this->echoHeaderPic();

        $contentInBox = new \Roots\Sage\ContentInBox\KlabSelectedPubs(true, true, false);
        $contentInBox->setContent(get_the_content());
        $contentInBox->run();

    }

    protected function echoAfterPage()
    {
        echo '<section class="'. \Roots\Sage\KlabTemplFunctions\constructWrapperSectionClasses() .'">';
        echo '<div class="'. \Roots\Sage\KlabTemplFunctions\constructWrapperSectionClasses(self::BLOCK_FOR_FULL_ARTICLE_LIST, false) .'">';

        $publications = new \Roots\Sage\KlabEchoPostType\KlabPublications(false);
        $publications->echoPosts();

        echo '</div>';
        echo '</section>';
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