<?php
/**
 * Created by PhpStorm.
 * User: aino
 * Date: 14.4.2017
 * Time: 8:15
 */

namespace Roots\Sage\ContentInBox;

use Roots\Sage\KlabPostSection\KlabAbstractPostSection;

class KlabContentInBox extends KlabAbstractPostSection
{

    const CONTENT_IN_BOX = 'contentInBox';

    public function __construct($overImage = false, $hasBackground = false, $bigText = false, $noGridSpacing = false, $modifierArray = null, $sectionId = null)
    {

        parent::__construct(self::CONTENT_IN_BOX, $modifierArray, !$noGridSpacing, false, $sectionId);

    }


    public function setAndFilterContent($content){
        $this->content = apply_filters( 'the_content', wp_kses_post($content));
    }

    public function echoContent()
    {
        ?>
        <div class="mdl-cell  mdl-cell--12-col">

            <?php
            echo (!empty($this->title)) ?
                '<div class="postSection__title">
                    <h2 class="postSection__title-text">'
                . $this->title .
                '</h2>
                </div>' : ''; ?>

            <?php
            echo (!empty($this->image)) ?
                '<div class="postSection__media">' .
                $this->image
                . '</div>'
                : ''; ?>

            <?php    echo (!empty($this->content)) ?
                '<div class="postSection__supporting-text">' .
                $this->filterPostContent($this->content)
                . '</div>'
                : ''; ?>


        </div>
        <?php
    }


}
?>