<?php

/*
// J5
// Code is Poetry */
ini_set('max_input_time', '0');
ini_set('max_execution_time', '0');
ini_set('memory_limit','100M');
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

        //for($i=0;$i<45;$i++){
            echo '<div style="padding:5px; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">';
            echo $oUSER->locale_typosearch_mysql_import();
            echo '</div>';


       // }

    }

}catch( Exception $e ) {

    //
    // SEND THIS THROUGH THE LOGGER OBJECT
    $oLogger->captureNotice('us zip code csv import [cron job]', LOG_EMERG, $e->getMessage());

    echo 'HOOOSTON...VE HAF PROBLEM!';
}