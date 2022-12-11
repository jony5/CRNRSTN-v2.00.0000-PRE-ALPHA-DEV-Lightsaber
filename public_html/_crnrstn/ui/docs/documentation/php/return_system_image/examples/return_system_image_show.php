<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

//$oCRNRSTN->grant_permissions_fwrite();

//
// A QUICK CHECK ON THE FLIPPED BIT FOR TABLET.
if($oCRNRSTN->is_bit_set(CRNRSTN_CHANNEL_TABLET)){

    echo 'Got tablet?';

}

?>