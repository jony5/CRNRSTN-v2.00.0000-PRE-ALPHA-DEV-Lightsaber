<?php
/*
// J5
// Code is Poetry */
$device_type_bit = $this->oCRNRSTN->device_type_bit();

$tmp_html_out .= 'Current device type integer constant: ' . $device_type_bit . '.<br><br>';

//
// GET THE STRING REPRESENTATION OF THE INTEGER CONSTANT.
$tmp_device_type_str = $this->oCRNRSTN->return_int_const_profile($device_type_bit, 'STRING');

if($this->oCRNRSTN->is_bit_set($device_type_bit)){

    $tmp_html_out .= 'The bit has been flipped for the device type integer constant, ' . $tmp_device_type_str . '.';

}else{

    $tmp_html_out .= $tmp_device_type_str . ' does not have it\'s bit flipped.';

}