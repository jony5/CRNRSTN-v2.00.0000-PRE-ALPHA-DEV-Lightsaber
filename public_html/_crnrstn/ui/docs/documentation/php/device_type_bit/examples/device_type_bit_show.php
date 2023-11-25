<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

$device_type_bit = $oCRNRSTN->device_type_bit();

echo 'Current device type integer constant: ' . $device_type_bit . '.<br><br>';

//
// GET THE STRING REPRESENTATION OF THE INTEGER CONSTANT.
$tmp_device_type_str = $oCRNRSTN->return_int_const_profile($device_type_bit, 'STRING');

if($oCRNRSTN->is_bit_set($device_type_bit)){

    echo 'The bit has been flipped for the device type integer constant, ' . $tmp_device_type_str . '.';

}else{

    echo $tmp_device_type_str . ' does not have it\'s bit flipped.';

}

?>