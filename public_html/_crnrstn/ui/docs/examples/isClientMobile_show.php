<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

//
// PASSING TRUE ALLOWS TABLET COMPUTERS TO BE DETECTED AS MOBILE.
$iAmMobile = $oCRNRSTN_USR->is_mobile(true);

if($iAmMobile){
    //
    // MOBILE/TABLET DEVICE EXPERIENCE
    echo 'I am mobile!';

}else{
    //
    // DESKTOP EXPERIENCE
    echo 'I am not mobile!';

}

?>