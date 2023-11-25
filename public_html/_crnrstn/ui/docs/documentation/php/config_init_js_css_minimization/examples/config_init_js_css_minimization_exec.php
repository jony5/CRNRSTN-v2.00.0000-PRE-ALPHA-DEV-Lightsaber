<?php
/*
// J5
// Code is Poetry */

if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) === true){

    $tmp_html_out .= 'PROD ACTIVE. Loading filename.min.js and filename.min.css resources.';

}else{

    $tmp_html_out .= 'DEV ACTIVE. Loading filename.js and filename.css resources.';

}