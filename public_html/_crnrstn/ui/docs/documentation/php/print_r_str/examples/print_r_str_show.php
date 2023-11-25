<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

$data = "The quick brown fox jumped over the lazy dog.";

//
// PASSING NULL FOR $theme_profile WILL ALLOW THE DEFAULT THEME
// PROFILE TO BE APPLIED.
$output_str = $oCRNRSTN->print_r_str($data, 'A demo title');

echo $output_str;

?>