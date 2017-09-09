<?php
/**
 * Created by PhpStorm.
 * User: aino
 * Date: 13.4.2017
 * Time: 21:25
 */

namespace Roots\Sage\KlabPostSection;

use Roots\Sage\KlabTemplFunctions;


abstract class KlabAbstractPostSection
{
    protected $sectionName;
    protected $modifierArray;
    private $gridSpacing;
    private $noGrid;
    protected $sectionId;

    protected $title;
    protected $content;
    protected $image;
    protected $imageCaption;


    public function __construct($sectionName, $modifierArray = null, $gridSpacing = true, $noGrid = false, $sectionId = null)
    {
        $this->sectionName = $sectionName;
        $this->gridSpacing = $gridSpacing;
        $this->noGrid = $noGrid;
        $this->modifierArray = $modifierArray;
        $this->sectionId = $sectionId;

    }

    public function run()
    {
?>

        <div class="<?php echo KlabTemplFunctions\constructSectionClasses($this->sectionName, $this->gridSpacing, $this->noGrid, $this->modifierArray); ?>"
             <?php if (!empty($this->sectionId)) {echo 'id="'.$this->sectionId.'"';} ?>
        >

            <?php
            $this->echoContent();
            ?>

        </div>

        <?php

    }

    abstract public function echoContent();

    protected function filterPostContent ($content) {
        $content = apply_filters( 'the_content', $content);
        $content = str_replace( ']]>', ']]&gt;', $content );
        return $content;
    }

    protected function echoImageAndCaption () {
        echo $this->image;
        echo '<span class="caption">' . $this->imageCaption . '</span>';
    }

    private function addImageCaption() {
        global $post;
        if (has_post_thumbnail($post->ID)) {
           $this->imageCaption = get_post(get_post_thumbnail_id($post))->post_excerpt;
        }
}

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $this->filterPostContent($content);
    }

    /**
     * @param mixed $image
     */
    public function setImage($image, $setCaption = true)
    {
        $this->image = $image;
        if ($setCaption) {
            $this->addImageCaption();
        }
    }

    /**
     * @param mixed $imageCaption
     */
    public function setImageCaption($imageCaption)
    {
        $this->imageCaption = $imageCaption;
    }

    /**
     * @param null $modifierArray
     */
    public function setModifierArray($modifierArray)
    {
        $this->modifierArray = $modifierArray;
    }

}

class KlabContentSide extends KlabAbstractPostSection
{
    const CONTENT_SIDE = 'contentSide';

    public function __construct()
    {
        parent::__construct($this::CONTENT_SIDE);
    }

    public function echoContent()
    {
        echo '<div class="mdl-cell mdl-cell--12-col  '. $this::CONTENT_SIDE . '__content">';
        echo '<div class="postSection__title">';
        echo '<h2 class="postSection__title-text">'. $this->title .'</h2>';
        echo '</div>';

        echo '<div class="postSection__supporting-text">';
        echo $this->content;
        echo '</div>';
        echo '</div>';

    }

}


class KlabBigSidePicSection extends KlabAbstractPostSection
{
    const BIG_SIDE_PIC = 'bigSidePic';

    public function __construct()
    {
        parent::__construct($this::BIG_SIDE_PIC);
    }


    public function echoContent()
    {
        echo '<div class=" mdl-cell mdl-cell--5-col">';

        $this->echoSidePanel();

        echo '</div>';

        echo '<div class=" mdl-cell mdl-cell--7-col '. $this::BIG_SIDE_PIC .'__content" >';
        echo '<div class="postSection__supporting-text">';

        echo $this->content;

        echo '</div>';
        echo '</div>';

    }

    protected function echoSidePanel() {
        $this->echoImageAndCaption();
    }

}

class KlabMapSectionSection extends KlabBigSidePicSection  {

    protected function echoSidePanel()
    {
        echo '<div class="postSection__media" id="map">';
        echo '</div>';
    }
}

?>