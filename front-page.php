<?php use Roots\Sage\KlabEchoNews;
use Roots\Sage\KlabFullPicSingleCol;

class KlabFrontEntryPage extends \Roots\Sage\KlabPage\KlabDefaultEntryPage {
    public function run()
    {
        $this->echoPage();
        $this->echoAfterPage();
    }

    protected function echoAfterPage()
    {
        $news = new KlabEchoNews\KlabNews();
        $news->echoPosts();
    }
}
while (have_posts()) : the_post();
$thisPage = new KlabFrontEntryPage();
$thisPage->run();
endwhile;

?>


