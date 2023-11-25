<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

$oCRNRSTN->set_mobile();

//
// A DIRECT CHECK ON THE FLIPPED BIT FOR MOBILE.
if($oCRNRSTN->is_bit_set(CRNRSTN_CHANNEL_MOBILE) === true){

    echo 'Mobile is like just totally gonna send it!';

}

?>