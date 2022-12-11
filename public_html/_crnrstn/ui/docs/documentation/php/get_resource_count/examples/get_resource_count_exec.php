<?php
/*
// J5
// Code is Poetry */
$fruit = array('apple', 'orange', 'a bag of some rocks');
$veggies = NULL;

//
// STORE DATA
$this->oCRNRSTN->add_system_resource('potentially_fruit', $fruit);
$this->oCRNRSTN->add_system_resource('surely_not_fruit', $veggies);

//
// COUNTS AFTER DATA STORAGE
$count_entries_FRUIT = $this->oCRNRSTN->get_resource_count('potentially_fruit');
$count_entries_VEGGIES = $this->oCRNRSTN->get_resource_count('surely_not_fruit');
$tmp_html_out .= 'Entries [FRUIT]: ' . $count_entries_FRUIT . '<br>';
$tmp_html_out .= 'Entries [VEGGIES]: ' . $count_entries_VEGGIES . '<br><br>';

//
// SIMULATE SOME APPLICATION ACTIVITY
$tmp_serial = $this->oCRNRSTN->generate_new_key(26);
$this->oCRNRSTN->add_system_resource('potentially_fruit', $tmp_serial . '-FRUIT');
$this->oCRNRSTN->add_system_resource('surely_not_fruit', $tmp_serial . '-VEGGIES');

//
// SIMULATE A LITTLE MORE APPLICATION ACTIVITY
for($i = 0; $i < 40; $i++){

    $tmp_serial = $this->oCRNRSTN->generate_new_key(26);
    $this->oCRNRSTN->add_system_resource('potentially_fruit', $tmp_serial . '-FRUITSMOOTHIE');

}

//
// COUNTS AFTER APPLICATION ACTIVITY
$count_entries_FRUIT = $this->oCRNRSTN->get_resource_count('potentially_fruit');
$count_entries_VEGGIES = $this->oCRNRSTN->get_resource_count('surely_not_fruit');
$tmp_html_out .= 'Entries [FRUIT]: ' . $count_entries_FRUIT . '<br>';
$tmp_html_out .= 'Entries [VEGGIES]: ' . $count_entries_VEGGIES . '<br><br>';

//
// FRUITS
for($i = 0; $i < $count_entries_FRUIT; $i++){

    //
    // EXTRACTING DATA BY INDEX
    $system_fruit = $this->oCRNRSTN->get_resource('potentially_fruit', $i);

    $tmp_html_out .= 'Item[FRUIT] ' . $i . ': ' . $this->oCRNRSTN->var_dump($system_fruit);

}

//
// VEGGIES
for($i = 0; $i < $count_entries_VEGGIES; $i++){

    //
    // EXTRACTING DATA BY INDEX
    $system_not_fruit = $this->oCRNRSTN->get_resource('surely_not_fruit', $i);

    $tmp_html_out .= 'Item[VEGGIES] ' . $i . ': ' . $this->oCRNRSTN->var_dump($system_not_fruit);

}