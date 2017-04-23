<?php
/**
 * Created by PhpStorm.
 * User: aino
 * Date: 23.4.2017
 * Time: 18:59
 */

namespace Roots\Sage\KlabPage;


use Roots\Sage\KlabPostSection\KlabContentSide;

class KlabTitleAndContentPage extends KlabDefaultPage
{
    public function echoPage()
    {
        $contentPage = new KlabContentSide();
        $contentPage->setContent(get_the_content());
        $contentPage->setTitle(get_the_title());
        $contentPage->run();

    }

}