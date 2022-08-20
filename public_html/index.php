<?php

/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

echo $oCRNRSTN->ui_module_out('MIT_license');

//$crnrstn_png = '/var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/ui/imgs/png/apache_feather_logo.png';
//$file_extension_jpg = $file_extension_png = pathinfo($crnrstn_png, PATHINFO_EXTENSION);
//
//if(is_file($crnrstn_png)){
//
//    //
//    // BASE64 THIS PNG
//    $img_binary = fread(fopen($crnrstn_png, 'r'), $oCRNRSTN->find_filesize($crnrstn_png));
//    $base64_encode_png = 'data:image/.png;base64,' . base64_encode($img_binary);
//
//
//}
//
//echo $base64_encode_png;