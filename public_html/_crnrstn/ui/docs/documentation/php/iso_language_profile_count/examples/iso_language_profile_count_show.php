<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

$lang_iso_count = $oCRNRSTN->iso_language_profile_count();
echo 'Count of language profiles: ' . $lang_iso_count;

?>