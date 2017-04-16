<?php
/**
 * Template Name: Lab Member Template
 */
?>

<?php use Roots\Sage\KlabTemplFunctions;
use Roots\Sage\KlabFullPicSingleCol;
use Roots\Sage\KlabLabMemberSlider;
use Roots\Sage\KlabLabContentSide;
use Roots\Sage\KlabLabMembers\KlabLabMembers;
?>

<?php
class KlabLabMemberSliderPage extends \Roots\Sage\KlabPage\KlabDefaultPage
{
    public function echoPage()
    {
        $mainContent = new Roots\Sage\ContentInBox\KlabContentInBox();
        $mainContent->setContent(get_the_content());

        $sliderPosts = new KlabLabMemberSlider\KlabLabMemberSlider();
        $sliderPosts->setPageTitle(get_the_title());
        $sliderPosts->echoPosts();

        $mainContent->run();

    }

    protected function echoAfterPage()
    {
        $labMembers = new KlabLabMembers();
        $labMembers->echoPosts();
    }
}

while (have_posts()) : the_post();
    $thisPage = new KlabLabMemberSliderPage();
    $thisPage->run();
endwhile;
