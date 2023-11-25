<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

//
// RETRIEVE JUST WHAT IS NEEDED...FROM WHAT IS AVAILABLE.
$constant_description = $oCRNRSTN->return_int_const_profile(CRNRSTN_JS_FRAMEWORK_JQUERY_UI_1_12_1, 'DESCRIPTION');
echo 'Description: <br>' . $constant_description . '<br><br>';

//
// PASSING JUST AN INTEGER CONSTANT WILL RETURN ALL
// AVAILABLE PROFILE META AS AN ARRAY.
$constant_profile_ARRAY = $oCRNRSTN->return_int_const_profile(CRNRSTN_JS_FRAMEWORK_JQUERY_UI_1_12_1);

echo $oCRNRSTN->var_dump($constant_profile_ARRAY) . '<br><br>';

?>