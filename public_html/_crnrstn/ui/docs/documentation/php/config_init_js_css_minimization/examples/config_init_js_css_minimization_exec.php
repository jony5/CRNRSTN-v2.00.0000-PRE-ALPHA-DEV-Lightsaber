<?php
/*
// J5
// Code is Poetry */

if($this->oCRNRSTN->is_bit_set(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS)){

    $tmp_html_out .= 'PROD ACTIVE. Loading filename.min.js and filename.min.css resources.';

}else{

    $tmp_html_out .= 'DEV ACTIVE. Loading filename.js and filename.css resources.';

}