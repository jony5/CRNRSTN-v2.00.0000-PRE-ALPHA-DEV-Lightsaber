<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

$data = "The quick brown fox jumped over the lazy dog.";

$data_hashed = $oCRNRSTN->hash($data);

echo $data .'<br><br>';
echo $data_hashed;

?>