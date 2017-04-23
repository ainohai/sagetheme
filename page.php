<?php
use Roots\Sage\KlabPage;

while (have_posts()) : the_post();
    $thisPage = new KlabPage\KlabDefaultEntryPage();
    $thisPage->run();
endwhile;
?>