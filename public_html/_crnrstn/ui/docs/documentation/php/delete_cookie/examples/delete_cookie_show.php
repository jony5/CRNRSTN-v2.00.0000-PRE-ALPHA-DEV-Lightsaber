<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

//
// GENERATE A NEW KEY
$tmp_serial = $oCRNRSTN->generate_new_key(42, '01');

echo $tmp_serial;

?>