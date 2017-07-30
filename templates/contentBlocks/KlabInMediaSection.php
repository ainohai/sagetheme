<?php
/**
 * Created by PhpStorm.
 * User: aino
 * Date: 23.4.2017
 * Time: 10:33
 */

namespace Roots\Sage\KlabPostSection;


class KlabInMediaSection extends KlabAbstractPostSection
{
    const BLOCK_NAME = 'klabInMedia';
    private $url;
    private $siteName;

    public function __construct()
    {
        parent::__construct($this::BLOCK_NAME);

    }

    public function echoContent()
    {
        ?>
        <div class="mdl-cell mdl-cell--3-col">
            <div class="postSection__media">
        <?php  if (!empty($this->image)) {
                   echo '<a href="'. $this->url .'">';
                   echo $this->image;
                    echo '</a>';
             }?>
            </div>

        </div>

    <div class="mdl-cell mdl-cell--9-col  <?php echo $this::BLOCK_NAME . "__content" ?>">

        <div class="postSection__title">
            <a href="<?php echo $this->url ?>">
                <h3 class="postSection__title-text"><?php echo $this->title ; ?></h3>
            </a>
        <?php

        echo '<span class="'. $this::BLOCK_NAME .'__title postSection__subtitle-text">'. $this->siteName .'</span>';
                ?>
        </div>

        <div class="postSection__supporting-text">
            <?php
            echo $this->content; ?></div>

        </div><?php
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @param mixed $siteName
     */
    public function setSiteName($siteName)
    {
        $this->siteName = $siteName;
    }



}