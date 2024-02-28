<?php

/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');


if($oCRNRSTN_ENV->getEnvParam('SSL_ENABLED')){

    //
    // SSL_ENABLED - FORCE SSL


}else{

    //
    // NO SSL_ENABLED - NO SSL ALLOWED
    if(is_ssl()){

        //
        // REDIRECT HTTPS TO HTTP
        header("Location: http://jony5.com/social/fellowship/seblend_popup/");
        die();

    }

}


// SOURCE :: https://stackoverflow.com/questions/7304182/detecting-ssl-with-php
// FROM WordPress tho
function is_ssl() {
    if ( isset($_SERVER['HTTPS']) ) {
        if ( 'on' == strtolower($_SERVER['HTTPS']) )
            return true;
        if ( '1' == $_SERVER['HTTPS'] )
            return true;
    } elseif ( isset($_SERVER['SERVER_PORT']) && ( '443' == $_SERVER['SERVER_PORT'] ) ) {
        return true;
    }
    return false;
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Language" content="en-us" />
    <meta name="distribution" content="Global" />
    <meta name="ROBOTS" content="NOINDEX, NOFOLLOW">

    <title>AV OBS Meeting Overlay</title>
    <script type="text/javascript" language="javascript" src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/js/lib/frameworks/prototype/1.7.3/prototype.js" ></script>
    <script type="text/javascript" language="javascript" src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/js/lib/frameworks/scriptaculous/1.9.0/scriptaculous.js" ></script>
    <script type="text/javascript" language="javascript" src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/js/seblend/form.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/js/seblend/main.js"></script>

    <style>

        *									{ border:0px; padding:0px; margin:0px; font-family:Arial, Helvetica, sans-serif;}
        body 								{ background-color: transparent; padding:0px; margin:0px; width:620px;}
        p									{ padding-top:5px; padding-bottom:5px; font-size:16px; line-height:23px;}
        blockquote							{ padding-left:15px; font-size:13px;}
        li									{ margin-left:20px;}
        a                                   { color:#0066CC;}

        .seblend_overlay_wrapper            { width:100%; height:400px; background-color: #F9F6F9; opacity: 0.6; position: absolute; z-index: 2;}
        .seblend_content_wrapper            { width:500px; padding: 10px; margin-left:50px; color:#000; position: absolute; z-index: 3;}
        .message_meta_wrapper               { padding-top: 10px; color:#000;}
        .message_title                      { font-size:20px; color:#000;}
        .message_meta                       { font-weight: bold; font-size:16px; float: left; color:#000;}
        .conference_title                   { font-weight: bold; font-size:16px; float: right; color:#000;}
        .message_time                       { font-weight: bold; font-size:26px; float: right; color:#000; padding-top: 10px;}

        #message_time_wrapper               {}
        
        /*UTILITY*/
        .hidden								{ width:0px; height:0px; position:absolute; left:-2000px; overflow:hidden;}
        .cb 								{ display:block; clear:both; height:0px; line-height:0px; overflow:hidden; width:100%; font-size:1px;}
        .cb_5	 							{ display:block; clear:both; height:5px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_10	 							{ display:block; clear:both; height:10px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_15	 							{ display:block; clear:both; height:15px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_20								{ display:block; clear:both; height:20px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_30								{ display:block; clear:both; height:30px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_40								{ display:block; clear:both; height:40px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_50	 							{ display:block; clear:both; height:50px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_75								{ display:block; clear:both; height:75px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_100 							{ display:block; clear:both; height:100px; line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_200								{ display:block; clear:both; height:200px; line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}

    </style>
</head>

<body>
    <div class="seblend_overlay_wrapper"></div>

    <div class="seblend_content_wrapper">
        <div id="msg_title" class="message_title">The Ultimate Revelation of Jesus Christ and the  Vision of the Enthroned Christ as the Administrator  in God's Universal Government</div>
        <div class="cb"></div>
        <div class="message_meta_wrapper">
            <div class="message_meta">Message <span id="msg_num">01</span> - <span id="msg_spkr">RK0</span></div>
            <div id="conf_title" class="conference_title">2019 SE Blending Conference</div>
            <div class="cb"></div>
        </div>
        <div class="cb"></div>
        <div id="message_time_wrapper" class="message_time">0:00:00</div>
        <div class="cb"></div>
    </div>

    <div id="test_mode" class="cb"></div>
    <div id="sid" class="hidden"><?php echo session_id(); ?></div>
    <div id="ajax_root" class="hidden"><?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?></div>

</body>
</html>