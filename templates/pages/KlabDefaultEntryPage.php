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

class KlabDefaultEntryPage extends KlabDefaultPage
{

    public function __construct()
    {
        parent::__construct();
    }

    public function echoPage() {

        $headerPic = new KlabFullPageImage();
        $headerPic->setTitle(get_the_title());
        $headerPic->setBackgroundImageUrl($this->getImageUrl());
        $title = is_front_page() ? get_bloginfo( 'name', 'display' ) : get_the_title();
        $headerPic->setTitle($title);
        $headerPic->run();

        $contentInBox = new KlabContentInBox(true, true);
        $contentInBox->setContent(get_the_content());
        $contentInBox->run();

    }

    private function getImageUrl() {

        global $post;

        if (has_post_thumbnail($post->ID)) {
            return get_the_post_thumbnail_url();
        }
        else {
            return get_the_post_thumbnail_url(get_option('page_on_front'));
        }
    }

}