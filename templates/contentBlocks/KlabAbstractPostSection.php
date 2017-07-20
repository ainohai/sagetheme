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


    public function __construct($sectionName, $modifierArray = null, $gridSpacing = true, $noGrid = false)
    {
        $this->sectionName = $sectionName;
        $this->gridSpacing = $gridSpacing;
        $this->noGrid = $noGrid;
        $this->modifierArray = $modifierArray;

    }

    public function run()
    {
?>

        <div class="<?php echo KlabTemplFunctions\constructSectionClasses($this->sectionName, $this->gridSpacing, $this->noGrid, $this->modifierArray); ?>">

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

}

class KlabContentSide extends KlabAbstractPostSection
{
    const CONTENT_SIDE = 'contentSide';
    private $content;
    private $title;

    public function __construct()
    {
        parent::__construct($this::CONTENT_SIDE);
    }

    public function echoContent()
    {
        echo '<div class="mdl-cell mdl-cell--12-col mdl-card '. $this::CONTENT_SIDE . '__content">';
        echo '<div class="mdl-card__title">';
        echo '<h2 class="mdl-card__title-text">'. $this->title .'</h2>';
        echo '</div>';

        echo '<div class="mdl-card__supporting-text">';
        echo $this->content;
        echo '</div>';
        echo '</div>';

    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $this->filterPostContent($content);
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

}





class KlabBigSidePicSection extends KlabAbstractPostSection
{
    const BIG_SIDE_PIC = 'bigSidePic';
    private $title;
    private $content;
    private $image;
    private $imageCaption;

    public function __construct()
    {
        parent::__construct($this::BIG_SIDE_PIC);
    }


    public function echoContent()
    {
        echo '<div class="mdl-card mdl-cell mdl-cell--5-col">';

        $this->echoSidePanel();

        echo '</div>';

        echo '<div class="mdl-card mdl-cell mdl-cell--7-col '. $this::BIG_SIDE_PIC .'__content" >';
        echo '<div class="mdl-card__supporting-text">';

        echo $this->content;

        echo '</div>';
        echo '</div>';

    }

    protected function echoSidePanel () {

        echo $this->image;
        echo '<span class="caption">' . $this->imageCaption . '</span>';

        //the_post_thumbnail('medium');
        //echo '<span class="caption">' .get_post(get_post_thumbnail_id($post))->post_excerpt . '</span>';
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
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @param mixed $imageCaption
     */
    public function setImageCaption($imageCaption)
    {
        $this->imageCaption = $imageCaption;
    }

}

class KlabMapSectionSection extends KlabBigSidePicSection  {

    protected function echoSidePanel()
    {
        echo '<div class="mdl-card__media" id="map">';
        echo '</div>';
    }
}

?>