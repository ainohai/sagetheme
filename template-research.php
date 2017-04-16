<?php
/**
 * Template Name: Research Template
 */
?>

<?php
use Roots\Sage\KlabResearchTopic;
use Roots\Sage\KlabNavMenus;
use Roots\Sage\KlabFullPicSingleCol;

class KlabResearchEntryPage extends \Roots\Sage\KlabPage\KlabDefaultEntryPage
{

    protected function echoAfterPage()
    {
        $researchTopics = new KlabResearchTopic\KlabResearchTopic();
        ?>

        <div class="mdl-grid sideBar">
            <aside class="mdl-cell mdl-cell--3-col mdl-cell--hide-phone mdl-cell--hide-tablet sideBarNav">
                <?php $researchTopics->echoResearchTopicNav(); ?>
            </aside>

            <div class="mdl-cell mdl-cell--9-col mdl-cell--12-col-phone mdl-cell--12-col-tablet sideBarContent">
                <?php $researchTopics->echoPosts(); ?>
            </div>
        </div>
<?php
    }
}

while (have_posts()) : the_post();
$thisPage = new KlabResearchEntryPage();
$thisPage->run();
endwhile;
?>
