<?php

/*
// J5
// Code is Poetry */
ini_set('max_input_time', '0');
ini_set('max_execution_time', '0');
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');

$oLogger = new crnrstn_logging();

try{

    //
    // Therefore thus says Jehovah,
    // If you return, I will restore you;
    // You will stand before Me;
    // And if you bring out the precious from the worthless,
    // You will be as My mouth;
    // They will turn to you,
    // But you will not turn to them. - Jeremiah 15:19

    echo "<div style='padding:20px;'><h1>Hello Wethrbug!</h1></div>";

    $auth_creds = $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'auth');

    if($auth_creds=='f2bcfcda1c478e'){

        # US_GOV_ZIPCODE_CSV_SOURCE_URI
        echo $oUSER->sync_us_state_province_data();

    }

}catch( Exception $e ) {

    //
    // SEND THIS THROUGH THE LOGGER OBJECT
    $oLogger->captureNotice('us zip code csv import [cron job]', LOG_EMERG, $e->getMessage());

    echo 'HOOOSTON...VE HAF PROBLEM!';
}