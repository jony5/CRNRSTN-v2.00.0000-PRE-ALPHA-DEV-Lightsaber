<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

$lang_iso = $oCRNRSTN->country_iso_code();
echo 'Current language:' . $lang_iso;

?>