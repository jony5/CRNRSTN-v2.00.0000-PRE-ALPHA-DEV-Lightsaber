<?php
/*
// J5
// Code is Poetry */
//
// RETRIEVE JUST WHAT IS NEEDED...FROM WHAT IS AVAILABLE.
$constant_description = $this->oCRNRSTN->return_int_const_profile(CRNRSTN_JS_FRAMEWORK_JQUERY_UI_1_12_1, 'DESCRIPTION');
$tmp_html_out .= 'Description: <br>' . $constant_description . '<br><br>';

$constant_profile_ARRAY = $this->oCRNRSTN->return_int_const_profile(CRNRSTN_JS_FRAMEWORK_JQUERY_UI_1_12_1);

$tmp_html_out .= $this->oCRNRSTN->var_dump($constant_profile_ARRAY) . '<br><br>';