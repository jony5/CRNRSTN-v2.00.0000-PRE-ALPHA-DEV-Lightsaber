<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
//include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');

function getUrlContent($url){

    // https%3A%2F%2Fapi.weather.gov%2Fpoints%2F39.7456%2C-97.08920

    $header=array(
        'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36',
        'X-Requested-With: XMLHttpRequest',
        'Host: api.weather.gov',
        'Accept: application/json',
        'Accept-Language: en-US,en;q=0.9,zh-CN;q=0.8,zh;q=0.7',
        'Accept-Encoding: gzip,deflate',
        'Content-Type: application/json; charset=utf-8',
        'Referer: http://wethrbug.jony5.com/',
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
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch,CURLOPT_HTTPHEADER,$header);

    $data = curl_exec($ch);
    //$obj = json_encode($data);
    //$data = utf8_encode($data);
    //$obj = json_decode($data);

    //self::$oLogger->captureNotice('user->getUrlContent()->object data', LOG_NOTICE, $url."||".$obj->{'@context'});

    //$data = json_decode($data, true);
    //self::$oLogger->captureNotice('user->getUrlContent()->json_decode data', LOG_NOTICE, $url."||".$data);

    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    //echo $httpcode;

    curl_close($ch);
    return ($httpcode>=200 && $httpcode<300) ? $data : false;
}

$tmp_uri = 'https://api.weather.gov/points/39.7456,-97.0892';

$json_XY_geo_response = getUrlContent($tmp_uri);
//var_dump(json_decode($json_XY_geo_response, true));

//$json_XY_geo_response = utf8_decode($json_XY_geo_response);
var_dump(utf8_encode($json_XY_geo_response));
//print_r($json_XY_geo_response);