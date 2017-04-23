<?php
/**
 * Created by PhpStorm.
 * User: aino
 * Date: 23.4.2017
 * Time: 18:02
 */

namespace Roots\Sage\KlabPage;


use Roots\Sage\KlabPostSection\KlabBigSidePicSection;
use Roots\Sage\KlabPostSection\KlabContentSide;

class KlabBigSidePic extends KlabDefaultPage
{
    public function echoPage()
    {
        global $post;

        $sidePic = new KlabBigSidePicSection();
        $sidePic->setContent(get_the_content());
        $sidePic->setImage(get_the_post_thumbnail($post->ID, 'medium'));
        $sidePic->setImageCaption(get_post(get_post_thumbnail_id($post))->post_excerpt);
        $sidePic->setTitle(get_the_title());
        $sidePic->run();

    }

}

class KlabBioPage extends KlabBigSidePic {
    const CV_TITLE = 'CV';

    public function echoAfterPage()
    {
        global $post;

        $metadataArray =  get_post_meta( $post->ID);
        $cvContent = isset($metadataArray["page_cv"]) ? $metadataArray["page_cv"][0] :'';

        $contentPage = new KlabContentSide();
        $contentPage->setContent(apply_filters( 'the_content', wp_kses_post($cvContent)));
        $contentPage->setTitle($this::CV_TITLE);

        echo '<section class="'. \Roots\Sage\KlabTemplFunctions\constructWrapperSectionClasses() .'">';
        $contentPage->run();
        echo '</section>';

    }
}