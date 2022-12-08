<?php
/*
// J5
// Code is Poetry */

$this->oCRNRSTN->grant_permissions_fwrite();

if($this->oCRNRSTN->is_bit_set(CRNRSTN_CHANNEL_TABLET)){

    $tmp_html_out .= 'Got tablet?';

}