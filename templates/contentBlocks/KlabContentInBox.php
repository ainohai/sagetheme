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
    const OVER_IMAGE_MODIFIER = '-overImage';
    const WITH_BACKGROUND_MODIFIER ='-hasBackground';
    const BIG_TEXT_MODIFIER = '-bigText';

    public function __construct($overImage = false, $hasBackground = false, $bigText = false, $noGridSpacing = false)
    {
        $modifierArray = [];
        if ($overImage) { array_push($modifierArray, self::OVER_IMAGE_MODIFIER); }
        if ($hasBackground) { array_push($modifierArray, self::WITH_BACKGROUND_MODIFIER);}
        if ($bigText) { array_push($modifierArray, self::BIG_TEXT_MODIFIER);}

        parent::__construct(self::CONTENT_IN_BOX, $modifierArray, !$noGridSpacing);

    }


    public function setAndFilterContent($content){
        $this->content = apply_filters( 'the_content', wp_kses_post($content));
    }

    public function echoContent()
    {
        ?>
        <div class="mdl-cell mdl-card mdl-cell--12-col">

            <?php
            echo (!empty($this->title)) ?
                '<div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">'
                . $this->title .
                '</h2>
                </div>' : ''; ?>

            <?php
            echo (!empty($this->image)) ?
                '<div class="mdl-card__media">' .
                $this->image
                . '</div>'
                : ''; ?>

            <?php    echo (!empty($this->content)) ?
                '<div class="mdl-card__supporting-text">' .
                $this->filterPostContent($this->content)
                . '</div>'
                : ''; ?>


        </div>
        <?php
    }


}
?>