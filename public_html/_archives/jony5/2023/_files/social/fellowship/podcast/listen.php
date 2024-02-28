<?php

/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');

function str_sanitize($str, $type){

    $patterns = array();
    $replacements = array();

    $type = strtolower($type);

    switch ($type) {
        case 'lsm_podcast':

            $patterns[0] = 'http://';
            $replacements[0] = 'https://';

            break;

    }

    $str = str_replace($patterns, $replacements, $str);

    return $str;

}

/*$ts = date("Y-m-d H:i:s", time()-60*60*6);
$myfile = fopen("lsm_urls_rev.txt", "r") or die("Unable to open file!");
$tmp_cnt=0;
while(!feof($myfile)) {
  $query .= 'INSERT INTO `lsm_podcasts` (`URI`,`DATEMODIFIED`) VALUES ("'.fgets($myfile).'","'.$ts.'");';
  $tmp_cnt++;
}

#echo "Total Count: ".$tmp_cnt;
#echo $query;
fclose($myfile);
*/			

//
// PULL CURRENT MP3 URI FROM LSM RSS FEED
//$xml=("http://www.lsmradio.com/rss/today.rss");
//$xmlDoc = new DOMDocument();
//$xmlDoc->load($xml);
//$channel=$xmlDoc->getElementsByTagName('channel')->item(0);
//$channel_title = $channel->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
//
//$x=$xmlDoc->getElementsByTagName('item');
//for ($i=0; $i<=0; $i++) {
//  $item_title = $x->item($i)->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
//  $item_link = $x->item($i)->getElementsByTagName('guid')->item(0)->childNodes->item(0)->nodeValue;
//}

//
// GET DAILY PODCAST
$lsm_podcast_ARRAY = $oUSER->getDailyPodcast($oCRNRSTN_ENV);
#$tmp_output = $oUSER->rotateDailyPodcast();
$lsm_podcast_ARRAY[0][1] = str_sanitize($lsm_podcast_ARRAY[0][1], 'lsm_podcast');

?>
<!doctype html>
<html lang="en">
<head>
<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.inc.php');
?>

    <script>
        $('#lsm_audio').ready(function() {
            tmp_html = '<p><audio controls="controls" autoplay id="audio-199-1" preload="none" style="width: 100%;"><source type="audio/mpeg" src="<?php echo  $lsm_podcast_ARRAY[0][1]; ?>" /><a href="<?php echo  $lsm_podcast_ARRAY[0][1]; ?>"><?php echo  $lsm_podcast_ARRAY[0][1]; ?></a></audio></p>';

            var objAudioDiv = document.createElement('div');
            objAudioDiv.setAttribute('id', 'aud');
            objAudioDiv.setAttribute('class','podcast_listen_wrapper');

            $( "#lsm_audio" ).append( objAudioDiv );

            objAudioDiv.innerHTML = tmp_html;

        });
    </script>
</head>

<body style="min-width:250px;">
<div id="body_wrapper">
    <div style="width:400px; text-align:center; margin:0px auto;">
        <p><a target="_blank" href="http://www.lifestudy.com/"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/lsm_logo_sm01.gif" alt="Living Stream Ministry" width="240" height="200" class="alignnone size-full wp-image-16"></a></p>

        <div>Now playing :: <?php echo $lsm_podcast_ARRAY[0][0]; ?></div>
        <!--[if lt IE 9]><script>document.createElement('audio');</script><![endif]-->
        <div id="lsm_audio"></div>

        <div class="cb_20"></div>

    </div>
    <div id="footer_wrapper" style="width:350px;">
        <div id="footer-copyright" style="margin-left:10px;"></div>
        <div id="5_footer"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>" target="_self"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/5.gif" width="16" height="16" alt="J5" title="J5" /></a></div>
    </div>
    <div class="cb_20"></div>
</div>
</body>
</html>