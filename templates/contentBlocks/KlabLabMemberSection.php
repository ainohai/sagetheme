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

        $this->justAList = $justAList;
    }

    public function run()
    {
        if (!$this->justAList) {
            parent::run();
        }
        else {
            ?>
            <li class="mdl-cell mdl-cell--4-col mdl-list__item mdl-list__item--two-line <?php echo $this::BLOCK_NAME . "__content" ?>">
                <?php
                $this->echoContent();
                ?>

            </li>

            <?php
        }

    }

    public function echoContent()
    {
        if ($this->justAList === false) {
            $this->echoFullMemberInfo();
        }
        else {
            $this->echoJustAList();
        }
    }

    public function echoFullMemberInfo() { ?>
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

        <div class="mdl-card__title">
            <h3 class="mdl-card__title-text"><?php echo $this->labMemberName ; ?></h3></br>

        <?php

        echo '<span class="'. $this::BLOCK_NAME .'__title mdl-card__subtitle-text">'. $this->labMemberTitle .'</span>';
        echo '<span class="'. $this::BLOCK_NAME .'__currentPosition mdl-card__subtitle-text">'. $this->labMemberCurrentPosition .'</span>';
        ?>
        </div>

        <div class="mdl-card__supporting-text">
            <?php
            echo $this->labMemberDescription; ?></div>

        </div><?php
    }

    public function echoJustAList() { ?>

        <div class="mdl-list__item-primary-content">

        <span><?php echo $this->labMemberName ; ?></span>

        <?php

        echo '<span class="'. $this::BLOCK_NAME .'__currentPosition mdl-list__item-sub-title">'. $this->labMemberCurrentPosition .'</span>';
        ?>
        </div>

        <?php
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