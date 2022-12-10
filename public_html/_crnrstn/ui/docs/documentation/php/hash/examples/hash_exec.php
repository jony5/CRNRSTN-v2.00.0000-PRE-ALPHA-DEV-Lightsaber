<?php
/*
// J5
// Code is Poetry */

$data = "The quick brown fox jumped over the lazy dog.";

$data_hashed = $this->oCRNRSTN->hash($data);

$tmp_html_out .= $data .'<br><br>';
$tmp_html_out .= $data_hashed;

//
// SERVER'S AVAILABLE HASH ALGORITHM :: DISCOVERY DEMONSTRATION
$methods = $this->oCRNRSTN->openssl_get_cipher_methods();

$tmp_html_out .= $this->oCRNRSTN->var_dump($methods);
