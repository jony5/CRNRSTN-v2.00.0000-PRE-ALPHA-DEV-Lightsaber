<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

$fruit = array('apple', 'orange', 'tomato');
$veggies = NULL;

//
// STORE DATA
$ddo_key_FRUIT = $oCRNRSTN->add_resource('potentially_fruit', $fruit);
$ddo_key_VEGGIES = $oCRNRSTN->add_resource('surely_not_fruit', $veggies);

//
// THE SYSTEM POINTER TO THE DATA STORAGE LOCATION
echo 'DDO key [FRUIT]: <span style="font-size: 70%;">' . $ddo_key_FRUIT . '</span><br><br>';
echo 'DDO key [VEGGIES]: <span style="font-size: 70%;">' . $ddo_key_VEGGIES . '</span><br><br>';

//
// EXTRACT THE SYSTEM RESOURCE
$system_fruit = $oCRNRSTN->get_resource('potentially_fruit');
$system_veggies = $oCRNRSTN->get_resource('surely_not_fruit');

echo 'var_dump(potentially_fruit): ' . $oCRNRSTN->var_dump($system_fruit) . '<br><br>';
echo 'var_dump(surely_not_fruit): ' . $oCRNRSTN->var_dump($system_veggies);


?>