<?php
/**
 * Created by PhpStorm.
 * User: aino
 * Date: 23.4.2017
 * Time: 10:33
 */

namespace Roots\Sage\KlabPostSection;


class KlabLabMemberSection extends KlabAbstractPostSection
{
    const BLOCK_NAME = 'klabLabMember';
    private $labMemberImage;
    private $labMemberName;
    private $labMemberTitle;
    private $labMemberCurrentPosition;
    private $labMemberDescription;
    private $justAList;

    public function __construct($justAList)
    {
        parent::__construct($this::BLOCK_NAME);
        $this->justAList;
    }

    public function echoContent()
    {

        ?>

        <div class="mdl-cell  mdl-card mdl-cell--3-col">
            <div class="mdl-card__media">
                <?php if (!empty($this->labMemberImage)) { ?>
                    <?php  echo $this->labMemberImage;  ?>
                <?php } else { ?>
                    <i class="material-icons  mdl-list__item-avatar">person</i>
                <?php }?>
            </div>

        </div>

    <div class="mdl-cell mdl-cell--9-col mdl-card <?php echo $this::BLOCK_NAME . "__content" ?>">

        <h3 class="mdl-card__title-text"><?php echo $this->labMemberName ; ?></h3>

        <?php

        echo '<span class="'. $this::BLOCK_NAME .'__title">'. $this->labMemberTitle .'</span>';
        echo '<span class="'. $this::BLOCK_NAME .'__currentPosition">'. $this->labMemberCurrentPosition .'</span>';
        ?>
        <div class="mdl-card__supporting-text">
            <?php
            echo '<p>'. $this->labMemberDescription . '</p>'?></div>

        </div><?php

    }

    /**
     * @param mixed $labMemberImage
     */
    public function setLabMemberImage($labMemberImage)
    {
        $this->labMemberImage = $labMemberImage;
    }

    /**
     * @param mixed $labMemberName
     */
    public function setLabMemberName($labMemberName)
    {
        $this->labMemberName = $labMemberName;
    }

    /**
     * @param mixed $labMemberTitle
     */
    public function setLabMemberTitle($labMemberTitle)
    {
        $this->labMemberTitle = $labMemberTitle;
    }

    /**
     * @param mixed $labMemberCurrentPosition
     */
    public function setLabMemberCurrentPosition($labMemberCurrentPosition)
    {
        $this->labMemberCurrentPosition = $labMemberCurrentPosition;
    }

    /**
     * @param mixed $labMemberDescription
     */
    public function setLabMemberDescription($labMemberDescription)
    {
        $this->labMemberDescription = $labMemberDescription;
    }

}