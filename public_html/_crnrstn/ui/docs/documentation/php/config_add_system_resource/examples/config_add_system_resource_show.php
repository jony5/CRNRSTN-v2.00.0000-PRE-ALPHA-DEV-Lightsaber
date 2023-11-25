<?php
/*
// J5
// Code is Poetry */
//
// SEE CRNRSTN :: CONFIGURATION FOR USE OF config_add_resource.
// /_crnrstn/_config/config.system_resource.secure/_crnrstn.system_resource.inc.php
/////

$fruit = array('apple', 'orange', 'tomato');

//
// STORE DATA DURING THE CONFIGURATION SITUATION.
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'potentially_fruit', $fruit);
// NOTE $THIS NOTATION. SEE CRNRSTN :: CONFIGURATION FOR USE OF config_add_resource().

//
// EXTRACT THE SYSTEM RESOURCE.
$system_fruit = $oCRNRSTN->get_resource('potentially_fruit');

echo 'var_dump(potentially_fruit): ' . $oCRNRSTN->var_dump($system_fruit);

?>