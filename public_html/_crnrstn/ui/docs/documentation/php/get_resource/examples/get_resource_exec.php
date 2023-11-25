<?php
/*
// J5
// Code is Poetry */
//
// CRNRSTN :: LOADS WITH $_SERVER DATA
$system_SERVER_NAME = $this->oCRNRSTN->get_resource('SERVER_NAME');
$tmp_html_out .= 'SERVER_NAME: ' . $system_SERVER_NAME . '<br><br>';

//
// CUSTOM DATA
$fruit = array('apple', 'orange', 'squash');
$veggies = '';

//
// STORE ARRAY DATA, AND RECEIVE THE DDO KEY IF NEEDED
$ddo_key_FRUIT = $this->oCRNRSTN->add_resource('potentially_fruit', $fruit);
$ddo_key_VEGGIES = $this->oCRNRSTN->add_resource('surely_not_fruit', $veggies);

//
// OUTPUT THE SYSTEM POINTER TO THE DATA STORAGE LOCATION (DDO KEY)
$tmp_html_out .= 'DDO key [FRUIT]: <span style="font-size: 70%;">' . $ddo_key_FRUIT . '</span><br><br>';
$tmp_html_out .= 'DDO key [VEGGIES]: <span style="font-size: 70%;">' . $ddo_key_VEGGIES . '</span><br><br>';

$system_fruit = $this->oCRNRSTN->get_resource('potentially_fruit');
$system_veggies = $this->oCRNRSTN->get_resource('surely_not_fruit');

$tmp_html_out .= 'var_dump(potentially_fruit): ' . $this->oCRNRSTN->var_dump($system_fruit) . '<br><br>';
$tmp_html_out .= 'var_dump(surely_not_fruit): ' . $this->oCRNRSTN->var_dump($system_veggies);