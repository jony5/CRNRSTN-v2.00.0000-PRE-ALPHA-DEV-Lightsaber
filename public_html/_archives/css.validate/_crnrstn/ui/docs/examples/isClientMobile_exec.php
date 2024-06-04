<?php
/*
// J5
// Code is Poetry */

//
// PASSING TRUE ALLOWS TABLET COMPUTERS TO BE DETECTED AS MOBILE.
$iAmMobile = self::$oCRNRSTN_USR->isClientMobile(true);

if($iAmMobile){
    //
    // MOBILE/TABLET DEVICE EXPERIENCE
    $tmp_html_out .= 'I am mobile!';

}else{
    //
    // DESKTOP EXPERIENCE
    $tmp_html_out .= 'I am not mobile!';

}