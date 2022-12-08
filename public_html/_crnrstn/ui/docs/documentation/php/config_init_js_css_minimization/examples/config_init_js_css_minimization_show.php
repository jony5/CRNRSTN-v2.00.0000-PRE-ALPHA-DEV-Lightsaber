<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

//
// THIS LINE WITHIN THE CONFIGURATION FILE SPECIFIES THAT A CHAD
// MACBOOK PRO LAMP STACK IS *NOT* TO LOAD THE PROD VERSIONS OF JS/CSS.
// THEREFORE, DEVELOPMENT VERSIONS OF ANY REQUESTED FRAMEWORK RESOURCES WILL BE USED.
$oCRNRSTN->config_init_js_css_minimization('LOCALHOST_CHAD_MACBOOKPRO', false);

//
// CAUTION: ONLY LOCALHOST_CHAD_MACBOOKPRO WILL RUN THIS CORRECTLY. CUSTOM CONFIG
// SETTINGS FOR THE RUNNING ENVIRONMENT WILL DRIVE THE BELOW.
//
// HERE IS A QUICK CHECK TO SEE IF THE BIT IS FLIPPED.
if($oCRNRSTN->is_bit_set(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS)){

    echo 'PROD ACTIVE. Loading filename.min.js and filename.min.css resources.';

}else{

    echo 'DEV ACTIVE. Loading filename.js and filename.css resources.';

}

?>