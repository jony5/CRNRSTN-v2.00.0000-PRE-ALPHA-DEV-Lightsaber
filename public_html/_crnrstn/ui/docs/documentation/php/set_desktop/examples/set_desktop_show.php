<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

$oCRNRSTN->set_desktop();

//
// A DIRECT CHECK ON THE FLIPPED BIT FOR DESKTOP.
if($oCRNRSTN->is_bit_set(CRNRSTN_CHANNEL_DESKTOP) === true){

    echo 'Look, ma. I\'m flagged as desktop!';

}

?>