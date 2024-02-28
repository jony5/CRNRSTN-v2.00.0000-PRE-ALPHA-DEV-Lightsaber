<?php

/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');

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
    <link rel="stylesheet" href="http://jony5.com/common/css/seblend/main.css" type="text/css" />

    <script type="text/javascript" language="javascript" src="http://<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/js/lib/frameworks/prototype/1.7.3/prototype.js" ></script>
    <script type="text/javascript" language="javascript" src="http://<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/js/lib/frameworks/scriptaculous/1.9.0/scriptaculous.js" ></script>
    <script type="text/javascript" language="javascript" src="http://<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/js/form/form.js"></script>
    <script type="text/javascript" language="javascript" src="http://<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/js/seblend/main.js"></script>
</head>

<body>
<div class="seblend_overlay_wrapper"></div>

<div class="seblend_content_wrapper">
    <div class="message_title">The Ultimate Revelation of Jesus Christ and the  Vision of the Enthroned Christ as the Administrator  in God's Universal Government</div>
    <div class="cb"></div>
    <div class="message_meta_wrapper">
        <div class="message_meta">Message 01 - RK</div>
        <div class="conference_title">2019 SE Blending Conference</div>
        <div class="cb"></div>
    </div>
    <div class="cb"></div>
    <div id="message_time_wrapper" class="message_time">0:00:00</div>
    <div class="cb"></div>
</div>

<div class="cb"></div>
<div id="ajax_root" class="hidden"><?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?></div>

</body>
</html>