<?php
/*
// J5
// Code is Poetry */
$oCRNRSTN_CSS_VALIDATOR = new crnrstn_communications_css_standard($this->oCRNRSTN);
$tmp_str = $oCRNRSTN_CSS_VALIDATOR->return_css_validator_input_form_HTML();
unset($oCRNRSTN_CSS_VALIDATOR);