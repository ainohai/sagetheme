<?php
use Roots\Sage\ContentInBox\KlabContentInBox;
$contentInBox = new KlabContentInBox(false, false);
$contentInBox->setContent("Sorry, the page you were searching wasn't found.");
$contentInBox->run(); ?>