<?php
/*
// J5
// Code is Poetry */
$cipher_ARRAY = $this->oCRNRSTN->openssl_get_cipher_methods();

foreach($cipher_ARRAY as $index => $cipher){

    $tmp_html_out .= $cipher . '<br>';

}