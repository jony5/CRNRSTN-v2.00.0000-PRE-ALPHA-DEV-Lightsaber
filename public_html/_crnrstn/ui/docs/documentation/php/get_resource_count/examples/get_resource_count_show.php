<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

$fruit = array('apple', 'orange', 'a bag of some rocks');
$veggies = NULL;

//
// STORE DATA
$oCRNRSTN->add_system_resource('potentially_fruit', $fruit);
$oCRNRSTN->add_system_resource('surely_not_fruit', $veggies);

//
// COUNTS AFTER DATA STORAGE
$count_entries_FRUIT = $oCRNRSTN->get_resource_count('potentially_fruit');
$count_entries_VEGGIES = $oCRNRSTN->get_resource_count('surely_not_fruit');
echo 'Entries [FRUIT]: ' . $count_entries_FRUIT . '<br>';
echo 'Entries [VEGGIES]: ' . $count_entries_VEGGIES . '<br><br>';

//
// SIMULATE SOME APPLICATION ACTIVITY
$tmp_serial = $oCRNRSTN->generate_new_key(26);
$oCRNRSTN->add_system_resource('potentially_fruit', $tmp_serial . '-FRUIT');
$oCRNRSTN->add_system_resource('surely_not_fruit', $tmp_serial . '-VEGGIES');

//
// SIMULATE A LITTLE MORE APPLICATION ACTIVITY
for($i = 0; $i < 40; $i++){

    $tmp_serial = $oCRNRSTN->generate_new_key(26);
    $oCRNRSTN->add_system_resource('potentially_fruit', $tmp_serial . '-FRUITSMOOTHIE');

}

//
// COUNTS AFTER APPLICATION ACTIVITY
$count_entries_FRUIT = $oCRNRSTN->get_resource_count('potentially_fruit');
$count_entries_VEGGIES = $oCRNRSTN->get_resource_count('surely_not_fruit');
echo 'Entries [FRUIT]: ' . $count_entries_FRUIT . '<br>';
echo 'Entries [VEGGIES]: ' . $count_entries_VEGGIES . '<br><br>';

//
// FRUITS
for($i = 0; $i < $count_entries_FRUIT; $i++){

    //
    // EXTRACTING DATA BY INDEX
    $system_fruit = $oCRNRSTN->get_resource('potentially_fruit', $i);

    echo 'Item[FRUIT] ' . $i . ': ' . $oCRNRSTN->var_dump($system_fruit);

}

//
// VEGGIES
for($i = 0; $i < $count_entries_VEGGIES; $i++){

    //
    // EXTRACTING DATA BY INDEX
    $system_not_fruit = $oCRNRSTN->get_resource('surely_not_fruit', $i);

    echo 'Item[VEGGIES] ' . $i . ': ' . $oCRNRSTN->var_dump($system_not_fruit);

}
?>