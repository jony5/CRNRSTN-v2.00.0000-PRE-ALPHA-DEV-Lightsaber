<?php
/* 
// J5
// Code is Poetry */

require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');

$oCarousel = new banner_carousel($oCRNRSTN_ENV, 1200);
$tmp_html = $oCarousel->return_random_image_HTML($oCRNRSTN_ENV->getEnvParam('BANNER_IMAGES_DIR'));

/*
$tmp_header_meta = $oCarousel->return_meta_for_header_array();

foreach($tmp_header_meta as $key => $val){

    header($val);
}

#header('image_disp_cnt: 5');
#header('ttl_scan_delta: 0.0008756383827');
#header('img_scan_cnt: 922');

*/

echo $tmp_html;