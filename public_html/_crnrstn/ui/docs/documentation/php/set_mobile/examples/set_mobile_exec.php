<?php
/*
// J5
// Code is Poetry */
$tmp_html_out .= 'Setting mobile to: isFujitsuTablet().<br>';

$this->oCRNRSTN->set_mobile('isFujitsuTablet()');

if($this->oCRNRSTN->is_bit_set(CRNRSTN_CHANNEL_MOBILE)){

    $tmp_html_out .= 'Mobile is like just totally gonna send it!';

}