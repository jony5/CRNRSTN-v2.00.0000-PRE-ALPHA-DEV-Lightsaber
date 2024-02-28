<?php

/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');

$oCarousel = new banner_carousel($oCRNRSTN_ENV);
$tmp_html = $oCarousel->return_image_check($oUSER->getEnvParam('BANNER_IMAGES_DIR'));

echo $tmp_html;