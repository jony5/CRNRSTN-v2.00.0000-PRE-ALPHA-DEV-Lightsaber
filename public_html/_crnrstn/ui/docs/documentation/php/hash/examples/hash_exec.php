<?php
/*
// J5
// Code is Poetry */
$data = "The quick brown fox jumped over the lazy dog.";

//
// HASH THE DATA ACCORDING TO DEFAULT HASH SETTINGS.
$data_hashed_sys_default = $this->oCRNRSTN->hash($data);

$tmp_html_out .= $data .'<br><br>';
$tmp_html_out .= $this->oCRNRSTN->system_hash_algo() . ' (system default): ' . $data_hashed_sys_default .'<br><br><br>';

//
// MD5 HASH THE SAME DATA.
$data_hashed_md5 = $this->oCRNRSTN->hash($data, 'md5');
$tmp_html_out .= $data .'<br><br>';
$tmp_html_out .= 'MD5: ' . $data_hashed_md5 . '<br><br>';

//
// SERVER'S AVAILABLE HASH ALGORITHM :: DISCOVERY DEMONSTRATION.
$methods = $this->oCRNRSTN->openssl_get_cipher_methods(false, false);

$tmp_html_out .= $this->oCRNRSTN->var_dump($methods);