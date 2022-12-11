<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

$data = "The quick brown fox jumped over the lazy dog.";

//
// HASH THE DATA ACCORDING TO DEFAULT HASH SETTINGS.
$data_hashed_sys_default = $oCRNRSTN->hash($data);

echo $data .'<br><br>';
echo $oCRNRSTN->system_hash_algo() . ' (system default): ' . $data_hashed_sys_default .'<br><br><br>';

//
// MD5 HASH THE SAME DATA.
$data_hashed_md5 = $oCRNRSTN->hash($data, 'md5');
echo $data .'<br><br>';
echo 'MD5: ' . $data_hashed_md5 . '<br><br>';

//
// SERVER'S AVAILABLE HASH ALGORITHM :: DISCOVERY DEMONSTRATION.
$methods = $oCRNRSTN->openssl_get_cipher_methods(false, false);

echo $oCRNRSTN->var_dump($methods);

?>