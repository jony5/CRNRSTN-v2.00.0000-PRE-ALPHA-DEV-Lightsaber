<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

if($oCRNRSTN->is_mobile()){

    echo 'YAY. I am MOBILE!<br><br>';

}

//
// A DIRECT CHECK ON THE FLIPPED BIT FOR MOBILE
// CAN ALSO CONFIRM THE SITUATION.
if($oCRNRSTN->is_bit_set(CRNRSTN_CHANNEL_MOBILE) === true){

    echo 'Hold my beer, I\'m flagged as mobile!<br><br>';

}

//
// PASSING TRUE WILL CAUSE MATCHED TABLET DEVICES TO RETURN BOOLEAN TRUE
// JUST LIKE MOBILE.
if(!$oCRNRSTN->is_mobile(true)){

    echo 'Well, I am neither TABLET nor MOBILE.';

}

?>