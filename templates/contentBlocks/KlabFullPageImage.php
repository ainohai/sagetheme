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

    private $backgroundImageUrl;
    private $caption;
    const HAS_MAX_HEIGHT = '-maxHeight';

    public function __construct($hasMaxHeight = false) {
        $modifierArray = null;
        if ($hasMaxHeight) {
            $modifierArray = array ($this::HAS_MAX_HEIGHT);
        }
        parent::__construct(self::FULL_SINGLE_PIC, $modifierArray, false);
    }

    /**
     * @param mixed $backgroundImageUrl
     */
    public function setBackgroundImageUrl($backgroundImageUrl)
    {
        $this->backgroundImageUrl = $backgroundImageUrl;
    }

    /**
     * @param mixed $caption
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;
    }

    public function echoContent() {

        ?>

        <div class="mdl-card mdl-cell--12-col">

            <div class="postSection__media"
                <?php echo (!empty($this->backgroundImageUrl)) ?  'style="background-image: url('. $this->backgroundImageUrl .'"' : '' ?>
            >

                <?php $this->echoEditButton(); ?>

                <?php if (isset($this->title)) { ?>
                    <div class="postSection__title">
                        <h1 class="postSection__title-text">

                            <?php echo $this->title; ?>

                        </h1>
                    </div>
                <?php } ?>

            </div>

        </div>
        <?php if (isset($this->caption) && $this->caption != '') { ?>
            <div class="fullPageImgCaption"><span class="caption"><?php echo $this->caption; ?> </span></div>
        <?php } ?>
    <?php }


    private function echoEditButton() {
        if( current_user_can('editor') || current_user_can('administrator')) {
            echo '<div class="absoluteEditButton">';
            echo KlabTemplFunctions\getEditPostButtonInLoop(EditAnchors::getThumbnailAnchor());
            echo '</div>';
        }
    }

}?>