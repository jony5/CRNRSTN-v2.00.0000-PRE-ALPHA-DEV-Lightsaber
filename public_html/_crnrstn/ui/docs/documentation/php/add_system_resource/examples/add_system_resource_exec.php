<?php
/*
// J5
// Code is Poetry */
$fruit = array('apple', 'orange', 'tomato');
$veggies = NULL;

//
// STORE THE DATA WITH A KEY TO ACCESS THE DATA FROM
// THE CRNRSTN :: DECOUPLED DATA OBJECT (DDO).
$ddo_key_FRUIT = $this->oCRNRSTN->add_resource('potentially_fruit', $fruit);
$ddo_key_VEGGIES = $this->oCRNRSTN->add_resource('surely_not_fruit', $veggies);

//
// THE SYSTEM POINTER TO THE DATA STORAGE LOCATION
$tmp_html_out .= 'DDO key [FRUIT]: <span style="font-size: 70%;">' . $ddo_key_FRUIT . '</span><br><br>';
$tmp_html_out .= 'DDO key [VEGGIES]: <span style="font-size: 70%;">' . $ddo_key_VEGGIES . '</span><br><br>';

//
// EXTRACT THE SYSTEM RESOURCE
$system_fruit = $this->oCRNRSTN->get_resource('potentially_fruit');
$system_veggies = $this->oCRNRSTN->get_resource('surely_not_fruit');

$tmp_html_out .= 'var_dump(potentially_fruit): ' . $this->oCRNRSTN->var_dump($system_fruit, 'var_dump(potentially_fruit)') . '<br><br>';
$tmp_html_out .= 'var_dump(surely_not_fruit): ' . $this->oCRNRSTN->var_dump($system_veggies, 'var_dump(surely_not_fruit)');