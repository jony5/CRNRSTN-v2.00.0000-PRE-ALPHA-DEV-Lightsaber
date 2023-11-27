<?php

/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');
//
// CURL BASSDRIVE NOW PLAYING INFO
function getUrlContent($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    $data = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return ($httpcode>=200 && $httpcode<300) ? $data : false;
}

function strip_unwanted($str){
    $patterns = array();
    $patterns[0] = '- ';
    $replacements = array();
    $replacements[0] = '';
    $str = str_replace($patterns, $replacements, $str);
    return $str;
}

if($oCRNRSTN_ENV->getEnvParam('BASSDRIVE_INTEGRATE')){
    $tmp_nowplaying_info = getUrlContent("http://bassdrive.com/now-playing.php");
    #Now Playing: Vibration Sessions <span class="player-host">-  hosted by Bank</span>
    #error_log("topnav.inc.php (22) Now Playing: ".$tmp_nowplaying_info);
    $chopped_to_array = explode("Now Playing: ", $tmp_nowplaying_info);

    $chopped_to_array[0] = strip_unwanted($chopped_to_array[0]);
    #error_log("topnav.inc.php (25) Now Playing: -->".$chopped_to_array[0]);

    // Crucial-Xtra Sessions August 16th 2019 -
}else{
    //$chopped_to_array[0] = "Local host test...";
    $tmp_nowplaying_info = getUrlContent("http://bassdrive.com/now-playing.php");
    #Now Playing: Vibration Sessions <span class="player-host">-  hosted by Bank</span>
    #error_log("topnav.inc.php (22) Now Playing: ".$tmp_nowplaying_info);
    $chopped_to_array = explode("Now Playing: ", $tmp_nowplaying_info);

    $chopped_to_array[0] = strip_unwanted($chopped_to_array[0]);


}

?>

<div id="nowplaying_title">NOW PLAYING</div>
                <div id="stream_info"><?php echo $chopped_to_array[0]; ?></div>
<div id="stream_listen_btn" onclick="launch_popup('http://bassdrive.com/pop-up/','500','340')">LISTEN</div>
<div id="stream_listen_icon" onclick="launch_popup('http://bassdrive.com/pop-up/','500','340')"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/listen_icon.png" width="29" height="28" alt="Listen" title="Speaker" /></div>
<div class="cb"></div>
<div id="stream_m3u"><a href="http://bassdrive.com/bassdrive3.m3u">AAC+</a>&nbsp;&nbsp;&nbsp;<a href="http://bassdrive.com/bassdrive6.m3u">56K</a>&nbsp;&nbsp;&nbsp;<a href="http://bassdrive.com/bassdrive.m3u">128K</a>&nbsp;&nbsp;&nbsp;<span onclick="launch_popup('http://bassdrive.com/pop-up/','500','340')"><a href="#">WEB PLAYER</a></span></div>