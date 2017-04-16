<?php
/**
 * Created by PhpStorm.
 * User: aino
 * Date: 13.4.2017
 * Time: 21:36
 */

namespace Roots\Sage\FullPageImage;

use Roots\Sage\KlabPostSection;
use Roots\Sage\KlabTemplFunctions;
use Roots\Sage\Setup\EditAnchors;


class KlabFullPageImage extends KlabPostSection\KlabAbstractPostSection
{
    const FULL_SINGLE_PIC = 'fullSinglePic';

    private $title;
    private $backgroundImageUrl;

    public function __construct() {
        parent::__construct(self::FULL_SINGLE_PIC, null, false);
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param mixed $backgroundImageUrl
     */
    public function setBackgroundImageUrl($backgroundImageUrl)
    {
        $this->backgroundImageUrl = $backgroundImageUrl;
    }

    public function echoContent() {

        ?>

        <div class="mdl-card mdl-cell--12-col">

            <div class="mdl-card__media"
                <?php echo (!empty($this->backgroundImageUrl)) ?  'style="background-image: url('. $this->backgroundImageUrl .'"' : '' ?>
            >

                <?php $this->echoEditButton(); ?>

                <?php if (isset($this)) { ?>
                    <div class="mdl-card__title">
                        <h1 class="mdl-card__title-text">

                            <?php echo $this->title; ?>

                        </h1>
                    </div>
                <?php } ?>

            </div>

        </div>

    <?php }


    private function echoEditButton() {
        if( current_user_can('editor') || current_user_can('administrator')) {
            echo '<div class="absoluteEditButton">';
            echo KlabTemplFunctions\getEditPostButtonInLoop(EditAnchors::getThumbnailAnchor());
            echo '</div>';
        }
    }

}?>


