<?php

/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

/*
CRNRSTN :: R&D
CONFIGURATION OF OUTPUT FORMAT FOR MAPPED ASSETS

CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64
CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_PNG
CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_JPEG



---
CRNRSTN_UI_IMG_HTML_WRAPPED
CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_PNG
CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_JPEG
CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_JPEG
CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_PNG

CRNRSTN_UI_IMG_PNG
CRNRSTN_ASSET_MODE_PNG
CRNRSTN_UI_IMG_JPEG
CRNRSTN_ASSET_MODE_JPEG

case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_BASE64_JPEG
case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64 & CRNRSTN_UI_IMG_JPEG
case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64
case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64 & CRNRSTN_UI_IMG_PNG
case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_BASE64
case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_BASE64_PNG
case CRNRSTN_ASSET_MODE_BASE64
case CRNRSTN_UI_IMG_BASE64
case CRNRSTN_ASSET_MODE_BASE64
case CRNRSTN_UI_IMG_BASE64_PNG
case CRNRSTN_UI_IMG_BASE64_JPEG

*/

//echo $oCRNRSTN->return_system_image('CRNRSTN_LOGO', '', 250, NULL, NULL, NULL, NULL, CRNRSTN_UI_IMG_HTML_WRAPPED);
//echo $oCRNRSTN->return_sticky_media_link('SOUNDCLOUD_LARGE', 'https://soundcloud.com/jonathan-harris-772368100', '_blank', false);

//
// SYNC BASE64 TO SYSTEM/SOCIAL SITUATION FOR PNG AND JPEG.
//$oCRNRSTN->system_base64_synchronize();

$oCRNRSTN->framework_integrations_client_packet(CRNRSTN_RESOURCE_DOCUMENTATION, true);

echo $oCRNRSTN->ui_module_out('MIT_license');
////echo $oCRNRSTN->return_creative('CRNRSTN_FAVICON', CRNRSTN_UI_IMG_HTML_WRAPPED);