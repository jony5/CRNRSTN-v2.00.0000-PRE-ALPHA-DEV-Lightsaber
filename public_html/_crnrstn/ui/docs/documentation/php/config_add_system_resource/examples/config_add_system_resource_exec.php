<?php
/*
// J5
// Code is Poetry */

$fruit = array('apple', 'orange', 'tomato');

//
// STORE DATA DURING THE CONFIGURATION SITUATION
$this->oCRNRSTN->add_resource('potentially_fruit', $fruit);

//
// EXTRACT THE SYSTEM RESOURCE
$system_fruit = $this->oCRNRSTN->get_resource('potentially_fruit');

$tmp_html_out .= 'var_dump(potentially_fruit): ' . $this->oCRNRSTN->var_dump($system_fruit);