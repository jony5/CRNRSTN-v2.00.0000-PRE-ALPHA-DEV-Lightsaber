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
    //   If you return, I will restore you;
    // You will stand before Me;
    //   And if you bring out the precious from the worthless,
    // You will be as My mouth;
    //   They will turn to you,
    //   But you will not turn to them.
    // And I will make you to this people
    //   A fortified wall of bronze;
    // And they will fight against you,
    //   But they will not prevail against you;
    // For I am with you
    //   To save you and deliver you,
    //   Declares Jehovah.
    // And I will deliver you from the hand of the wicked
    //   And redeem you from the hand of those who terrorize.
    //
    // - Jeremiah 15:19-21
    //
    //
    // And to the messenger of the church in Philadelphia write:
    //
    //   These things says the Holy One, the true One, the One
    //   who has the key of David, the One who opens and no
    //   one will shut, and shuts and no one opens:
    //
    //   I know your works; behold, I have put before you an
    //   opened door which no one can shut, because you have a
    //   little power and have kept My word and have not denied
    //   My name.
    //
    //   Behold, I will make those of the synagogue of Satan,
    //   those who call themselves Jews and are not, but lie––
    //   behold, I will cause them to come and fall prostrate
    //   before your feet and to know that I have loved you.
    //
    //   Because you have kept the word of My endurance, I also
    //   will keep you out of the hour of trial, which is about
    //   to come on the whole inhabited earth, to try them who
    //   dwell on the earth. I come quickly; hold fast what you
    //   have that no one take your crown.
    //
    //   He who overcomes, him I will make a pillar in the
    //   temple of My God, and he shall by no means go out
    //   anymore, and I will write upon him the name of My God
    //   and the name of the city of My God, the New Jerusalem,
    //   which descends out of heaven from My God, and
    //   My new name.
    //
    //   He who has an ear, let him hear what the Spirit says
    //   to the churches.
    //
    //  - Revelation 3:7-13
    echo "<div style='padding:20px;'><h1>Hello Wethrbug!</h1></div>";

    $auth_creds = $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'auth');

    if($auth_creds=='f2bcfcda1c478e'){

        # US_GOV_ZIPCODE_CSV_SOURCE_URI
        echo $oUSER->mysql_import_us_geo_zipcode_data();

    }

}catch( Exception $e ) {

    //
    // SEND THIS THROUGH THE LOGGER OBJECT
    $oLogger->captureNotice('us zip code csv import [cron job]', LOG_EMERG, $e->getMessage());

    echo 'HOOOSTON...VE HAF PROBLEM!';
}