<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

//
// CRNRSTN :: LOADS WITH $_SERVER DATA.
$system_SERVER_NAME = $oCRNRSTN->get_resource('SERVER_NAME');
echo 'SERVER_NAME: ' . $system_SERVER_NAME . '<br><br>';

//
// CUSTOM DATA.
$fruit = array('apple', 'orange', 'squash');
$veggies = '';

//
// STORE DATA.
$ddo_key_FRUIT = $oCRNRSTN->add_system_resource('potentially_fruit', $fruit);
$ddo_key_VEGGIES = $oCRNRSTN->add_system_resource('surely_not_fruit', $veggies);

//
// OUTPUT THE SYSTEM POINTER TO THE DATA STORAGE LOCATION (DDO KEY).
echo 'DDO key [FRUIT]: <span style="font-size: 70%;">' . $ddo_key_FRUIT . '</span><br><br>';
echo 'DDO key [VEGGIES]: <span style="font-size: 70%;">' . $ddo_key_VEGGIES . '</span><br><br>';

//
// GET SYSTEM RESOURCES.
$system_fruit = $oCRNRSTN->get_resource('potentially_fruit');
$system_veggies = $oCRNRSTN->get_resource('surely_not_fruit');

echo 'var_dump(potentially_fruit): ' . $oCRNRSTN->var_dump($system_fruit) . '<br><br>';
echo 'var_dump(surely_not_fruit): ' . $oCRNRSTN->var_dump($system_veggies);

?>