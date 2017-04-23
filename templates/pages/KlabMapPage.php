<?php
/**
 * Created by PhpStorm.
 * User: aino
 * Date: 23.4.2017
 * Time: 17:59
 */

namespace Roots\Sage\KlabPage;


use Roots\Sage\KlabPostSection\KlabMapSectionSection;

class KlabMapPage extends KlabDefaultPage
{
    public function echoPage()
    {
        $map = new KlabMapSectionSection();
        $map->setContent(get_the_content());
        $map->run();

    }

}