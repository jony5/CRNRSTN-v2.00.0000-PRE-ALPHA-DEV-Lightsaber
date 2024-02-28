<?php
/* 
// J5
// Code is Poetry */

$oCarousel = new banner_carousel($oCRNRSTN_ENV);
$tmp_html = $oCarousel->return_random_image_HTML($oCRNRSTN_ENV->getEnvParam('BANNER_IMAGES_DIR'));
echo $tmp_html;

