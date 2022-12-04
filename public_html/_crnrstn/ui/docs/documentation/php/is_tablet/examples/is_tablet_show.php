<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

//
// PASSING TRUE WILL CAUSE MATCHED MOBILE DEVICES TO RETURN BOOLEAN TRUE
// JUST LIKE TABLETS.
if($oCRNRSTN->is_tablet(true)){

    echo 'YAY. I am TABLET! (...but, I also could be mobile.)<br><br>';

}

if(!$oCRNRSTN->is_tablet()){

    echo 'Well, I surely am not TABLET.';

}

?>