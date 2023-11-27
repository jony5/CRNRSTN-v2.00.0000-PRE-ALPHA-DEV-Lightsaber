<?php

/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');

//
// CURL BASSDRIVE NOW PLAYING INFO
function getUrlContent($url, $oCRNRSTN_ENV){

    $debugMode = 0;
    $oLogger = new crnrstn_logging($debugMode);

    $header=array(
        'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36',
        'X-Requested-With: XMLHttpRequest',
        'Host: www.bassdrive.com',
        'Accept: text/html, */*; q=0.01',
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
        'Accept-Language: en-US,en;q=0.9,zh-CN;q=0.8,zh;q=0.7',
        'Accept-Encoding: gzip,deflate',
        'Referer: '.$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'),
        'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7',
        'Keep-Alive: 115',
        'Connection: keep-alive',
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    //curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    //curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch,CURLOPT_HTTPHEADER,$header);

    //$data = curl_exec($ch);
    if( ! $data = curl_exec($ch)){
        
        error_log(__LINE__ . ' proxy/bassdrive/ [ERROR] getUrlContent() Fired CURL :: [' . print_r(curl_error($ch), true ) . ']');

        //$oLogger->captureNotice('[ERROR] WEB Fired Request Resulting in CURL :: /_proxy/bassdrive/', LOG_CRIT, curl_error($ch));
    }

    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return ($httpcode>=200 && $httpcode<300) ? $data : false;
}

function applySpecialFormatting($str){
    $patterns = array();
    $patterns[0] = ' LIVE';
    $patterns[1] = ' Live ';
    $patterns[2] = ' live ';
    $patterns[3] = 'LIVE!!!';
    $patterns[4] = 'www.Facebook.com/NateReflect';

    $replacements = array();
    $replacements[0] = ' <span style="color:#F00; font-weight: bold;">LIVE</span>';
    $replacements[1] = ' <span style="color:#F00; font-weight: bold;">LIVE</span>';
    $replacements[2] = ' <span style="color:#F00; font-weight: bold;">LIVE</span>';
    $replacements[3] = ' <span style="color:#F00; font-weight: bold;">LIVE!!!</span>';
    $replacements[4] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/NateReflect" target="_blank">www.Facebook.com/NateReflect</a>';

    $str = str_replace($patterns, $replacements, $str);
    return $str;
}


header('Content-Type: application/json; charset=UTF-8');
header('Cache-Control: no-store');
header('Access-Control-Allow-Origin: *');
$tmp_json = getUrlContent('http://www.bassdrive.com/relays.js', $oCRNRSTN_ENV);
$tmp_relay_json = $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/_proxy/bassdrive/relay.js';

//echo print_r($tmp_json, true);
echo $tmp_json;

if (file_exists($tmp_relay_json)) {
    //
    // DELETE THE FILE
    unlink($tmp_relay_json);

    //
    // UPDATE XML FILE WITH NEW DATA
    $file_handle = fopen($tmp_relay_json, 'a');
    $tmp_prof_xml_status = fwrite($file_handle, $tmp_json);
    fclose($file_handle);

} else {

    //
    // UPDATE XML FILE WITH NEW DATA
    $file_handle = fopen($tmp_relay_json, 'a');
    $tmp_prof_xml_status = fwrite($file_handle, $tmp_json);
    fclose($file_handle);

}