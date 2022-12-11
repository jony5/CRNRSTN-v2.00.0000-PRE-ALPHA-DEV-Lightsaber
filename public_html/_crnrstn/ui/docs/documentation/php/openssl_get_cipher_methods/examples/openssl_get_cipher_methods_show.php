<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

$cipher_ARRAY = $oCRNRSTN->openssl_get_cipher_methods();

foreach($cipher_ARRAY as $index => $cipher){

    echo $cipher . '<br>';

}

?>
