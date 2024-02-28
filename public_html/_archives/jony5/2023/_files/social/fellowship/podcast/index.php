<?php

/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');


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



?>
<!doctype html>
<html lang="en">
<head>
<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.inc.php');
?>
</head>

<body>
<?php
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/contact/contact.inc.php');
	?>
<div id="body_wrapper">
	<!-- HEAD CONTENT -->
	<?php
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/topnav.inc.php');
	?>
	<div class="cb"></div>
    
    <!-- LIFESTYLE BANNER -->
    <?php
    require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/lifestyle/banner_component.inc.php');
    ?>

    <div id="banner_lifestyle_dropshadow" style="background-image:url(<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/dropshadow.gif);">
    	<div id="banner_lifestyle_dropshadow_corner"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/dropshadow_corner.gif" width="6" height="6" alt=""></div>
    </div>
    
    <div id="user_transaction_wrapper" class="user_transaction_wrapper" style="display:none;">
        <div class="user_transaction_content">
            <div id="user_transaction_status_msg" class="<?php echo $oUSER->transStatusMessage_ARRAY[0]; ?>"><?php echo $oUSER->transStatusMessage_ARRAY[1]; ?></div>
        </div>
    </div>
    
    <!-- SUB NAV -->
    <div id="subnav_wrapper">
    	<div class="subnav_lnk_wrapper"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>social/networking/facebook/" target="_self">networking</a></div>
        <div class="subnav_lnk_wrapper sel">fellowship</div>
        <div class="cb"></div>
    </div>
    
    <div class="cb_30"></div>
    <!-- PAGE CONTENT -->
    <div id="content_wrapper">
    	<div id="vert_nav_wrapper">
    		<div class="vert_nav_lnk_wrapper sel">podcast</div>
            <div class="vert_nav_lnk_wrapper"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>social/fellowship/conferences/" target="_self">conferences</a></div>
            <div class="vert_nav_lnk_wrapper"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>social/fellowship/bibles-for-america/" target="_self">free Bibles</a></div>
            <div class="vert_nav_lnk_wrapper"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>social/fellowship/flying/" target="_self">we can fly!</a></div>
        
        </div>
    
    	<div id="content">
    		<div class="content_title">Daily Living Stream Ministry Podcast</div>
            <div class="content_copy">
            	<div class="col" style="width:900px;">
                	<p>Click <a href="#" target="_blank" onClick="launch_popup('<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>social/fellowship/podcast/listen.php','500','340','lsm_aud')">here</a> to listen to the radio program entitled <em><?php echo  $lsm_podcast_ARRAY[0][0]; ?></em>.</p>
                    <div id="podcast_listen_wrapper">
                    	<div id="podcast_listen_btn" onClick="launch_popup('<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>social/fellowship/podcast/listen.php','500','340','lsm_aud')">LISTEN</div>
                		<div id="podcast_listen_icon" onClick="launch_popup('<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>social/fellowship/podcast/listen.php','500','340','lsm_aud')"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/listen_icon.png" width="29" height="28" alt="Listen" title="Speaker" /></div>
                    	<div class="cb"></div>
                    </div>
                    <div class="cb_10"></div>
                    <p><strong>Life-Study of the Bible with Witness Lee</strong> is a 30-minute radio broadcast composed of excerpts from Witness Lee's spoken ministry that focuses 
                    on the enjoyment of the divine life as revealed in the Scriptures. The ministry portions are followed by a discussion of the portion presented, including questions and answers.</p>
                 	
                	<p>This radio broadcast is now available as a podcast. Listen to a new podcast every day!</p>
                </div>
                 
            </div>
            
            
            <div class="cb"></div>
            <div class="content_hr"></div>
            <div class="content_title">Subscribe to the podcast</div>
            <div class="content_copy">
            	<div class="col" style="width:900px;">
           			<p>To automatically receive future podcats to your RSS reader, follow these instructions:
                    <ul>
                        <li>Right-click on the RSS feed icon here <a href="http://www.lsmradio.com/rss/today.rss" target="_blank"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_rss.gif" width="30" height="30" alt="RSS" title="RSS"></a></li>
                        <li>Select Copy Link Location (or Copy Shortcut)</li>
                        <li>Then paste the shortcut into your RSS reader</li>
                    </ul>
                    </p>
                    <p>RSS URL: http://www.lsmradio.com/rss/today.rss</p>
                 </div>
            </div>
            
            
    	</div><!-- END PAGE CONTENT -->
    	
    </div>
    
    <div class="cb_30"></div>
    <?php
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/footer/footer.inc.php');
 	#error_log("END OF FILE - PODCAST")
	?>
    <div class="cb_50"></div>
    

</div>
</body>
</html>