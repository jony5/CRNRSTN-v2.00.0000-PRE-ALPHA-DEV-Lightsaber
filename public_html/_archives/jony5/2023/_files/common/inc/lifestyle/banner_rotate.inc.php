<?php
/* 
// J5
// Code is Poetry */

require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');

$tmp_xml_mode = $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'xml');
$oCarousel = new banner_carousel($oCRNRSTN_ENV);

error_log('12 - tmp_xml_mode='.$tmp_xml_mode);
if(strtolower($tmp_xml_mode)=='true' || $tmp_xml_mode == true){

    $tmp_html = $oCarousel->return_image_xml($oCRNRSTN_ENV->getEnvParam('BANNER_IMAGES_DIR'));
    echo $tmp_html;

}else{

    $tmp_html = $oCarousel->return_random_image_HTML($oCRNRSTN_ENV->getEnvParam('BANNER_IMAGES_DIR'));
    echo $tmp_html;

}