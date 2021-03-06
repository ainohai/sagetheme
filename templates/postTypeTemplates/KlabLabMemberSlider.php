<?php namespace Roots\Sage\KlabLabMemberSlider;
use Roots\Sage\KlabEchoPostType\KlabAbstractEchoPostType;
use Roots\Sage\KlabPage\KlabDefaultEntryPage;

class KlabLabMemberSlider extends KlabAbstractEchoPostType
{
    const POST_TYPE_SLUG = 'klab_lab_slideshow';
    const BLOCK_MODIFIER = 'imageSlider';
    private $pageTitle;

    public function __construct()
    {
        parent::__construct(self::POST_TYPE_SLUG, self::BLOCK_MODIFIER);
        parent::setSectionArgs(array('gridSpacing' => 'false'));

    }

    protected function echoPostContent ()
    { ?>

        <?php
        echo '<ul class="rslides">';
        parent::echoPostContent();
        echo '</ul>';
    }

    protected function echoWpLoopContents ()
    { ?>
        <li>
            <div class="captionContainer">
                <p class="caption"><?php the_title() ?></p>
            </div>

            <?php
            $slide = new KlabDefaultEntryPage(true);
            $slide->echoHeaderPic(); ?>
        </li>

        <?php
    }

    public function setPageTitle($pageTitle) {
        $this->pageTitle = $pageTitle;
    }
}?>