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
    { ?>
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
?>