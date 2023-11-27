<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT.'_crnrstn.config.inc.php');

require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/security/secure.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');

require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/language/lang.inc.php');

//
// LANGUAGE SUPPORT
$oUSER->prepLangElem('SITE_TITLE|SITE_TITLE_STYLED|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|ERR_REQ_COMPANYNAME|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP|TEXT_REQUIRED');

//
// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');

//
// DATABASE REQUEST/RESPONSE PROCESSING
$tmp_serial_handle = 'ASSET_PRE';
$oDB_RESP = $oUSER->getAssetPreviewData($tmp_serial_handle);

if(!$oUSER->isSSL()){
    $tmp_curr_uri = urlencode($oCRNRSTN_ENV->paramTunnelEncrypt("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"));
}else{
    $tmp_curr_uri = urlencode($oCRNRSTN_ENV->paramTunnelEncrypt("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"));

}

if($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("DEVICETYPE")=="m"){
?>
<!DOCTYPE html>
<html lang="<?php echo strtolower($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("LANGCODE")); ?>">
<head>
<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.mobi.inc.php');
?>
</head>

<body>

<div data-role="page" id="myPage">
    <?php
	$tmp_formUnique = $oUSER->generateNewKey(4);

    require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/classes/mininav.inc.php');								// CUSTOM NAV CLASS
    $oMiniNav = new miniNav('asset_main');
    $oMiniNav->configureLink('back', $oCRNRSTN_ENV->paramTunnelDecrypt($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'ruri')));
    $oMiniNav->configureLink('download', $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'DLOAD_END_POINT').'?tunnelEncrypt='.urlencode($oCRNRSTN_ENV->paramTunnelEncrypt('&aid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'ASSET_ID').'&cid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'CLIENT_ID').'&kid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'KIVOTOS_ID').'&uid='.$oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("USERID").'&ip='.$_SERVER['REMOTE_ADDR'].'&sid='.session_id(),'This_is_asset_download')));
    $oMiniNav->configureLink('view', $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'PREVIEW_END_POINT').'?tunnelEncrypt='.urlencode($oCRNRSTN_ENV->paramTunnelEncrypt('&aid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'ASSET_ID').'&cid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'CLIENT_ID').'&kid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'KIVOTOS_ID').'&uid='.$oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("USERID").'&ip='.$_SERVER['REMOTE_ADDR'].'&sid='.session_id(),'This_is_asset_download')));

    //
	// CURRENT ASSET?
    if($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'ISACTIVE')==4){
		$mobileNotice = '<p class="the_V"><a href="'.$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/kivotos/asset/preview/?tunnelEncrypt='.urlencode($oCRNRSTN_ENV->paramTunnelEncrypt('&kid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'KIVOTOS_ID').'&aid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'NEXT_VERSION').'&cid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'CLIENT_ID').'&uid='.$oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("USERID"))).'" data-ajax="false">Click here</a> to view the most current version of this asset.</p>';
	}else{

        $oMiniNav->configureLink('new_version', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/kivotos/asset/newversion/?tunnelEncrypt='.urlencode($oCRNRSTN_ENV->paramTunnelEncrypt('&aid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'ASSET_ID').'&cid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'CLIENT_ID').'&kid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'KIVOTOS_ID'))).'&ruri='.$tmp_curr_uri);

    }
	
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/search/search.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/dashboard.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header.mobi.inc.php');
	?>
    
    <!-- 
    //
    // BEGIN MAIN CONTENT -->
	<div role="main" class="ui-content">
		<h3><?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'NAME'); ?></h3>
		<p><?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'DESCRIPTION'); ?></p>
        <p><strong>Date Uploaded:</strong> <?php echo date("m.d.Y \a\\t H:i:s", strtotime($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'DATECREATED'))); ?></p>
        <p><strong>Owner:</strong> <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'account/dashboard/?uid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID'); ?>" data-ajax="false"><?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB'); ?></a> <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'account/dashboard/?uid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID'); ?>" data-ajax="false"><?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB'); ?></a></p>
        <p><strong>Assigned To:</strong> User Name <a href="#" id="open-popup_assign" class="clickable-area" style="text-decoration:none; text-underline:none;">(edit)</a></p>
        <p><strong>Watching:</strong> ALERTS ON <a href="#" data-ajax="false">(edit)</a></p>
        <p><strong>Status:</strong> OPEN <a href="#" id="open-popup_status" class="clickable-area" style="text-decoration:none; text-underline:none;">(edit)</a></p>
        <p><strong>File Type:</strong> <?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'FILE_MIME_TYPE'); ?></p>
        <p><strong>File Extension:</strong> .<?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'FILE_EXT'); ?></p>
        <p><strong>File Size:</strong> <?php echo $oUSER->formatBytes($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'FILE_SIZE'),3); ?></p>
        <!-- MAYBE I CAN PUT THESE TWO(BELOW) INTO A POPUP TOOL TIP. -->
        <p><strong>File Integrity:</strong> <a href="#popupInfo" data-rel="popup" data-transition="pop" title="view">(view)</a></p>
        <style>
            .ui-btn.my-tooltip-btn,
            .ui-btn.my-tooltip-btn:hover,
            .ui-btn.my-tooltip-btn:active {
                background: none;
                border: 0;
            }

        </style>
        <div data-role="popup" id="popupInfo" class="ui-content" data-theme="a">
            <h3>File Integrity Checksums</h3>
            <hr>
            <p><strong>MD5:</strong><br><?php echo strtolower($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'FILE_MD5')); ?></p>
            <p><strong>SHA1:</strong><br><?php echo strtolower($oUSER->stringBreak($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'FILE_SHA1'), 20)); ?></p>
        </div>


        <div data-role="popup" id="popup_assign" data-arrow="true">
            <p><strong>Assign to user</strong></p>
            <input data-type="search" id="divOfAssigned-input">
            <!-- form_component_insert_append([popupID],[id],[type],[value to append]) -->
            <!-- WE COULD PUT A JQUERY MOBILE FILTER COMPONENT HERE IF THE # OF NAMES GETS TOO BIG FOR USABILITY. WE SHOULD TEST TO
            SEE WHERE IT STARTS TO SUCK...HOW MANY USER REFERENCES -->
            <!-- STREAM MANAGER CLASS SHOULD ALSO HANDLE THE @MENTIONS -->
            <div class="stream_mentions" data-filter="true" data-input="#divOfAssigned-input">
                <?php
                $tmp_CLIENTS_CLIENT_ID = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'CLIENT_ID');
                $tmpOutputHTML = "";
                $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'USERS');
                for($i=0; $i<$tmp_loop_size; $i++){

                    //
                    // IF CLIENT/USER ACCESS SPECIFIED, LIMIT DISPLAY USER TO ONLY EXPLICIT ALLOW.
                    $tmp_USERS_USERID = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i);
                    if($oDB_RESP->ping_value_existence($oDB_RESP->return_serial($tmp_serial_handle), 'USERS_CLIENT_ASSOC','USER_ID', $tmp_USERS_USERID)){

                        //
                        // LETS WORK ON GETTING THE DATA WE NEED TO SUPPORT THIS...THEN COME BACK...
                        if($oDB_RESP->flag_isset_for_userClient($oDB_RESP->return_serial($tmp_serial_handle), $tmp_USERS_USERID)){
                            $tmp_loop_1_size = $oDB_RESP->return_UserClientAssocCnt($oDB_RESP->return_serial($tmp_serial_handle), $tmp_USERS_USERID);
                            for($ii=0;$ii<$tmp_loop_1_size;$ii++){
                                if($oDB_RESP->ping_user_client_assoc($oDB_RESP->return_serial($tmp_serial_handle), $tmp_USERS_USERID, $tmp_CLIENTS_CLIENT_ID) && !isset($tmp_userDisplay[$tmp_USERS_USERID])){

                                    $tmpOutputHTML .= '<p><a href="#" onclick="evifweb_asset_assign_update(\'popup_mention\',\'textarea\',\'stream\',\'stream_mentions_eid\',\''.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'\',\''.$oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)).'\');">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</a>, e<span class="the_V">V</span>ifweb</p>';

                                    $tmp_userDisplay[$tmp_USERS_USERID] = 1;
                                }
                            }

                        }else{

                            //
                            // USER CLIENT RELATION NOT SPECIFIED. ONLY DISPLAY USER IF APPROVED EVIFWEB USER PERMISSIONS ID.
                            # $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)
                            if($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)>160 && !($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)==405)){

                                $tmpOutputHTML .= '<p><a href="#" onclick="evifweb_asset_assign_update(\'popup_mention\',\'textarea\',\'stream\',\'stream_mentions_eid\',\''.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'\',\''.$oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)).'\');">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</a>, e<span class="the_V">V</span>ifweb</p>';

                                $tmp_userDisplay[$tmp_USERS_USERID] = 1;
                            }

                        }
                    }else{

                        //
                        // USER CLIENT RELATION NOT SPECIFIED. ONLY DISPLAY USER IF APPROVED EVIFWEB USER PERMISSIONS ID.
                        if($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)>160 && !($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)==405)){

                            $tmpOutputHTML .= '<p><a href="#" onclick="evifweb_asset_assign_update(\'popup_mention\',\'textarea\',\'stream\',\'stream_mentions_eid\',\''.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'\',\''.$oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)).'\');">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</a>, e<span class="the_V">V</span>ifweb</p>';

                            $tmp_userDisplay[$tmp_USERS_USERID] = 1;
                        }
                    }
                }

                echo $tmpOutputHTML;

                ?>
            </div>
        </div>

        <div data-role="popup" id="popup_status" data-arrow="true">
            <p><strong>Change status</strong></p>
            <input data-type="search" id="divOfStatus-input">
            <!-- form_component_insert_append([popupID],[id],[type],[value to append]) -->
            <!-- WE COULD PUT A JQUERY MOBILE FILTER COMPONENT HERE IF THE # OF NAMES GETS TOO BIG FOR USABILITY. WE SHOULD TEST TO
            SEE WHERE IT STARTS TO SUCK...HOW MANY USER REFERENCES -->
            <!-- STREAM MANAGER CLASS SHOULD ALSO HANDLE THE @MENTIONS -->
            <div class="stream_mentions" data-filter="true" data-input="#divOfStatus-input">
                <?php
                $tmp_CLIENTS_CLIENT_ID = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'CLIENT_ID');
                $tmpOutputHTML = "";
                $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'USERS');
                for($i=0; $i<$tmp_loop_size; $i++){

                    //
                    // IF CLIENT/USER ACCESS SPECIFIED, LIMIT DISPLAY USER TO ONLY EXPLICIT ALLOW.
                    $tmp_USERS_USERID = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i);
                    if($oDB_RESP->ping_value_existence($oDB_RESP->return_serial($tmp_serial_handle), 'USERS_CLIENT_ASSOC','USER_ID', $tmp_USERS_USERID)){

                        //
                        // LETS WORK ON GETTING THE DATA WE NEED TO SUPPORT THIS...THEN COME BACK...
                        if($oDB_RESP->flag_isset_for_userClient($oDB_RESP->return_serial($tmp_serial_handle), $tmp_USERS_USERID)){
                            $tmp_loop_1_size = $oDB_RESP->return_UserClientAssocCnt($oDB_RESP->return_serial($tmp_serial_handle), $tmp_USERS_USERID);
                            for($ii=0;$ii<$tmp_loop_1_size;$ii++){
                                if($oDB_RESP->ping_user_client_assoc($oDB_RESP->return_serial($tmp_serial_handle), $tmp_USERS_USERID, $tmp_CLIENTS_CLIENT_ID) && !isset($tmp_userDisplay[$tmp_USERS_USERID])){

                                    $tmpOutputHTML .= '<p><a href="#" onclick="evifweb_asset_assign_update(\'popup_mention\',\'textarea\',\'stream\',\'stream_mentions_eid\',\''.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'\',\''.$oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)).'\');">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</a>, e<span class="the_V">V</span>ifweb</p>';

                                    $tmp_userDisplay[$tmp_USERS_USERID] = 1;
                                }
                            }

                        }else{

                            //
                            // USER CLIENT RELATION NOT SPECIFIED. ONLY DISPLAY USER IF APPROVED EVIFWEB USER PERMISSIONS ID.
                            # $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)
                            if($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)>160 && !($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)==405)){

                                $tmpOutputHTML .= '<p><a href="#" onclick="evifweb_asset_assign_update(\'popup_mention\',\'textarea\',\'stream\',\'stream_mentions_eid\',\''.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'\',\''.$oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)).'\');">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</a>, e<span class="the_V">V</span>ifweb</p>';

                                $tmp_userDisplay[$tmp_USERS_USERID] = 1;
                            }

                        }
                    }else{

                        //
                        // USER CLIENT RELATION NOT SPECIFIED. ONLY DISPLAY USER IF APPROVED EVIFWEB USER PERMISSIONS ID.
                        if($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)>160 && !($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)==405)){

                            $tmpOutputHTML .= '<p><a href="#" onclick="evifweb_asset_assign_update(\'popup_mention\',\'textarea\',\'stream\',\'stream_mentions_eid\',\''.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'\',\''.$oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)).'\');">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</a>, e<span class="the_V">V</span>ifweb</p>';

                            $tmp_userDisplay[$tmp_USERS_USERID] = 1;
                        }
                    }
                }

                echo $tmpOutputHTML;

                ?>
            </div>
        </div>

        <div class="cb_10"></div>
        <div id="new_stream_lnk"><a href="#" data-ajax="false" style="text-decoration: none; text-underline: none; padding-top:0px; margin-top:0px; font-weight:normal;" onclick="evifweb_display_new_stream();">New Stream</a></div>
        <div id="new_stream_input">
            <form action="#" method="post" name="create_stream" id="create_stream"  enctype="multipart/form-data" data-ajax="false">
                <label for="stream">Start a stream</label>
                <textarea cols="40" rows="3" name="stream" id="stream"></textarea>
                <div class="frm_errstatus stream" style="width:100%; display:none;"><?php echo $oUSER->getLangElem('TEXT_REQUIRED'); ?></div>
                <p style="padding-top: 0; margin-top: 0;"><a href="#" id="open-popup_mention" class="clickable-area" style="text-decoration:none; text-underline:none;">@mention</a> <a id="stream_file_attach_lnk" href="#" style="text-decoration:none; text-underline:none;" onclick="evifweb_display_stream_toggle_fileAttach();">@attachFile</a></p>

                <!-- NEED TO HIDE ON LOAD AND REVEAL ON CLICK-->
                <div id="stream_file_attach">
                    <label for="assetname">asset name <span class="req_star">*</span></label>
                    <input type="text" name="assetname" id="assetname" value="">
                    <div class="frm_errstatus assetname" style="width:100%; display:none;"><?php echo $oUSER->getLangElem('TEXT_REQUIRED'); ?></div>

                    <label for="assetfile">attach file <span class="req_star">*</span></label>
                    <input type="file" name="assetfile" id="assetfile" value="">
                    <div class="frm_errstatus assetfile" style="width:100%; display:none;"><?php echo $oUSER->getLangElem('TEXT_REQUIRED'); ?></div>
                </div>

                <div data-role="popup" id="popup_mention" data-arrow="true">
                    <p><strong>Insert user mention</strong></p>
                    <input data-type="search" id="divOfMentions-input">
                    <!-- form_component_insert_append([popupID],[id],[type],[value to append]) -->
                    <!-- WE COULD PUT A JQUERY MOBILE FILTER COMPONENT HERE IF THE # OF NAMES GETS TOO BIG FOR USABILITY. WE SHOULD TEST TO
                    SEE WHERE IT STARTS TO SUCK...HOW MANY USER REFERENCES -->
                    <!-- STREAM MANAGER CLASS SHOULD ALSO HANDLE THE @MENTIONS -->
                    <div class="stream_mentions" data-filter="true" data-input="#divOfMentions-input">
                        <?php
                        #$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', 0);
                        $tmp_CLIENTS_CLIENT_ID = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'CLIENT_ID');
                        $tmpOutputHTML = "";
                        $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'USERS');
                        for($i=0; $i<$tmp_loop_size; $i++){

                            //
                            // IF CLIENT/USER ACCESS SPECIFIED, LIMIT DISPLAY USER TO ONLY EXPLICIT ALLOW.
                            $tmp_USERS_USERID = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i);
                            if($oDB_RESP->ping_value_existence($oDB_RESP->return_serial($tmp_serial_handle), 'USERS_CLIENT_ASSOC','USER_ID', $tmp_USERS_USERID)){

                                //
                                // LETS WORK ON GETTING THE DATA WE NEED TO SUPPORT THIS...THEN COME BACK...
                                if($oDB_RESP->flag_isset_for_userClient($oDB_RESP->return_serial($tmp_serial_handle), $tmp_USERS_USERID)){
                                    $tmp_loop_1_size = $oDB_RESP->return_UserClientAssocCnt($oDB_RESP->return_serial($tmp_serial_handle), $tmp_USERS_USERID);
                                    for($ii=0;$ii<$tmp_loop_1_size;$ii++){
                                        if($oDB_RESP->ping_user_client_assoc($oDB_RESP->return_serial($tmp_serial_handle), $tmp_USERS_USERID, $tmp_CLIENTS_CLIENT_ID) && !isset($tmp_userDisplay[$tmp_USERS_USERID])){

                                            $tmpOutputHTML .= '<p><a href="#" onclick="evifweb_form_component_content_append(\'popup_mention\',\'textarea\',\'stream\',\'stream_mentions_eid\',\''.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'\',\''.$oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)).'\');">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</a>, e<span class="the_V">V</span>ifweb</p>';

                                            $tmp_userDisplay[$tmp_USERS_USERID] = 1;
                                        }
                                    }

                                }else{

                                    //
                                    // USER CLIENT RELATION NOT SPECIFIED. ONLY DISPLAY USER IF APPROVED EVIFWEB USER PERMISSIONS ID.
                                    # $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)
                                    if($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)>160 && !($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)==405)){

                                        $tmpOutputHTML .= '<p><a href="#" onclick="evifweb_form_component_content_append(\'popup_mention\',\'textarea\',\'stream\',\'stream_mentions_eid\',\''.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'\',\''.$oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)).'\');">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</a>, e<span class="the_V">V</span>ifweb</p>';

                                        $tmp_userDisplay[$tmp_USERS_USERID] = 1;
                                    }

                                }
                            }else{

                                //
                                // USER CLIENT RELATION NOT SPECIFIED. ONLY DISPLAY USER IF APPROVED EVIFWEB USER PERMISSIONS ID.
                                if($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)>160 && !($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)==405)){

                                    $tmpOutputHTML .= '<p><a href="#" onclick="evifweb_form_component_content_append(\'popup_mention\',\'textarea\',\'stream\',\'stream_mentions_eid\',\''.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'\',\''.$oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)).'\');">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</a>, e<span class="the_V">V</span>ifweb</p>';

                                    $tmp_userDisplay[$tmp_USERS_USERID] = 1;
                                }
                            }
                        }

                        echo $tmpOutputHTML;

                        ?>
                    </div>
                </div>
                <script>
                    $.mobile.document.on( "click", "#open-popup_assign", function( evt ) {
                        $( "#popup_assign" ).popup( "open", { x: evt.pageX, y: evt.pageY } );

                        $( "#popup_assign" ).popup({
                            afterclose: function( event, ui ) {
                                //$('#stream').focus();
                            }
                        });

                        evt.preventDefault();
                    });

                    $.mobile.document.on( "click", "#open-popup_status", function( evt ) {
                        $( "#popup_status" ).popup( "open", { x: evt.pageX, y: evt.pageY } );

                        $( "#popup_status" ).popup({
                            afterclose: function( event, ui ) {
                                //$('#stream').focus();
                            }
                        });

                        evt.preventDefault();
                    });

                    $.mobile.document.on( "click", "#open-popup_mention", function( evt ) {
                        $( "#popup_mention" ).popup( "open", { x: evt.pageX, y: evt.pageY } );

                        $( "#popup_mention" ).popup({
                            afterclose: function( event, ui ) {
                                $('#stream').focus();
                            }
                        });

                        evt.preventDefault();
                    });

                    $( "#create_stream" ).submit(function( event ) {
                        //
                        // VALIDATE FORM
                        return validateForm('create_stream');
                    });
                </script>
                <div class="hidden" style=" border-top:2px dashed #000;" id="ASSET_POST_ENDPOINT"><?php echo $oCRNRSTN_ENV->getEnvParam('ASSET_POST_ENDPOINT'); ?></div>
                <div class="hidden" id="stream_file_attach_copy">@attachFile</div>
                <div class="hidden" id="stream_file_cancel_copy">@removeFile</div>
                <div class="cb_5"></div>
                <button class="ui-shadow ui-btn ui-corner-all" type="submit" id="submit">SUBMIT STREAM</button>
                <input type="hidden" name="postid" value="create_stream">
                <input type="hidden" name="sme" id="stream_mentions_eid" value="">
                <input type="hidden" name="stk" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt('ASSET'); ?>">
                <input type="hidden" name="cid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'CLIENT_ID')); ?>">
                <input type="hidden" name="kid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'KIVOTOS_ID')); ?>">
                <input type="hidden" name="aid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'ASSET_ID')); ?>">
                <input type="hidden" name="upload_auth_key" id="upload_auth_key" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->getEnvParam('ASSET_UPLOAD_AUTHKEY')); ?>">
                <input type="hidden" name="at" id="at" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt('STREAM'); ?>">
                <input type="hidden" name="uid" id="uid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('USERID')); ?>">
                <input type="hidden" name="sid" id="sid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt(session_id()); ?>">
                <input type="hidden" name="uip" id="uip" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($_SERVER['REMOTE_ADDR']); ?>">
                <input type="hidden" name="channel" id="channel" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('DEVICETYPE')); ?>">
                <input type="hidden" name="ic" id="ic" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'CLIENTS', $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'CLIENT_ID'), 'LANGCODE')); ?>">
                <input type="hidden" name="dload_endpoint" id="dload_endpoint" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->getEnvParam('ASSET_DLOAD_ENDPOINT')); ?>">
                <input type="hidden" name="preview_endpoint" id="preview_endpoint" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->getEnvParam('ASSET_PREVIEW_ENDPOINT')); ?>">

            </form>

            <div class="cb_20"></div>
        </div>
        <input type="search" name="stream_search" id="stream_search" value="" placeholder="Search streams..."  style="padding-top:3px; margin-top:0px;">
        <div class="stream_hr"></div>
        <div class="cb_10"></div>

        <?php

        //
        // SO I THINK WHAT IS HERE IS ACCEPTABLE. WHEN IT COMES TO STREAM IMPLEMENTATION ON A PAGE, THIS IS ALL THAT IS REQUIRED.
        $oSTREAM_MGR = new stream_manager($oCRNRSTN_ENV, $oUSER);
        $tmp_stream_type = 'ASSET';
        $tmp_resp_obj_profile = 'ASSETS';          // THIS WILL TELL US WHAT DATA TO PULL FROM DB RESPONSE OBJECT. PIPE DELIM.
        $tmp_resp_obj_profile_key_fields = 'ASSET_ID';    // THIS WILL TELL US KEY FIELD FOR DATA PROFILE. PIPE DELIM.

        echo $oSTREAM_MGR->return_streams('WEB', $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("DEVICETYPE"), $tmp_stream_type, $tmp_resp_obj_profile, $tmp_resp_obj_profile_key_fields, $oDB_RESP->return_serial($tmp_serial_handle), $oDB_RESP);
        echo '<div id="stream_dom_handles" class="hidden">'.$oSTREAM_MGR->stream_vert_flow_DOM_handles.'</div>';
        ?>






        <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/kivotos/?kid=<?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'KIVOTOS_ID'); ?>" class="ui-alt-icon ui-btn ui-shadow ui-icon-back ui-btn-icon-left">Back to kivot&oacute;s</a>
        <div class="cb_10"></div>
        <?php
		if($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'PREVIOUS_VERSIONS')!=""){
			
			//
			// PARSE PIPE DELIM ARRAY TO USABLE DATA STRUCTURE
			$tmp_pv_array = explode("|", $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'PREVIOUS_VERSIONS'));
			$tmp_prev_asset_array = array();
			
			#error_log("(174) PREVIOUS_VERSIONS->".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'PREVIOUS_VERSIONS'));

            //
            // A SEPARATE RESPONSE OBJECT
            $tmp_serial_handle_pv = 'ASSET_PREV_VER';
            $oDB_RESP = $oUSER->loadAssetPrevVersions($tmp_pv_array,$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'CLIENT_ID'),$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'KIVOTOS_ID'),$oDB_RESP,$tmp_serial_handle_pv);
			
		?>
        
        <ul data-role="listview" data-inset="true">
        	<li data-role="list-divider">Previous versions:</li>
            <?php
            // ONE THING I NEED TO CONSIDER. THE ORDER NEEDS TO BE REVERSABLE. SO MAY NEED SPECIAL METHOD FOR THAT. WE WILL SEE.
			#$tmp_assetVerData = array_reverse($tmp_assetVerData);
            $tmp_profile_ARRAY = $oDB_RESP->return_profiles($oDB_RESP->return_serial($tmp_serial_handle_pv));       # THE SERIAL IN POSITION "1" IS FOR DATABASE RESPONSE #2

            $tmp_SELECT_profile_loop_size = sizeof($tmp_profile_ARRAY);
            $tmp_ver_cnt = $tmp_SELECT_profile_loop_size;
            for($i=$tmp_SELECT_profile_loop_size-1;$i>-1;$i--){ # COULD IT BE THAT EASY?
                # LET'S TEST FOR THIS ERR OUTPUT HERE...I THINK WE CAN GET THIS FAR...BUT WE HAVE DONE LOTS WITH NO TESTING....SO WE SHALL SEE.
                error_log("asset preview (236) PREV VERSION ASSET_ID[".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle_pv), $tmp_profile_ARRAY[$i], 'ASSET_ID', 0)."]");
            ?>
                <li><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/kivotos/asset/preview/?tunnelEncrypt=".urlencode($oCRNRSTN_ENV->paramTunnelEncrypt('&kid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle_pv), $tmp_profile_ARRAY[$i], 'KIVOTOS_ID').'&aid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle_pv), $tmp_profile_ARRAY[$i], 'ASSET_ID').'&cid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle_pv), $tmp_profile_ARRAY[$i], 'CLIENT_ID').'&uid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle_pv), $tmp_profile_ARRAY[$i], 'USER_ID'))); ?>&prev=true" data-ajax="false">v<?php echo $tmp_ver_cnt; ?> :: <?php echo date("m.d.Y \a\\t H:i:s", strtotime($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle_pv), $tmp_profile_ARRAY[$i], 'DATECREATED'))); ?></a></li>

                <?php
                $tmp_ver_cnt--;
            }

			?>
        </ul>
		<?php
		}
		?>
        <div class="cb_20"></div>
        <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/delete/?kid="; ?>" class="ui-btn ui-icon-alert ui-btn-icon-left ui-corner-all" style="background-color:#F00; text-shadow:none; color:#FFF;">Delete Asset</a>
	</div><!-- /content -->
    

	<?php
    require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/footer/ftr.mobi.inc.php');
    
    ?>

</div><!-- /page -->

</body>
</html>
	
<?php
}else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.inc.php');
?>
</head>

<body>

<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/dashboard.inc.php');
?>

<main id="content">
<div id="dashboard_content_shell">
    <div class="cb_10"></div>

    <div id="form_shell" class="signin_shell">
        <div id="form_box">
            <div class="cb_10"></div>
            <div class="evif_logo_form"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/evifweb_logo_sm.gif" width="42" height="23" alt="eVifweb" title="5"></div>
            <div id="form_title">upload asset</div>
            <div class="cb_5"></div>
            <div class="form_element_label">Add an asset to the extranet.</div>
            <div class="cb_30"></div>
        
            <form action="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/admin/client/" method="post" name="new_client" id="new_client"  enctype="multipart/form-data" >
                <div class="form_input_shell">
                    <div id="companyname_form_element_label" class="form_element_label">company name / business group <span class="req_star">*</span></div>
                    <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="companyname" type="text" id="companyname" size="20" maxlength="100" value="" style="width:375px;" /></div>
                    <div class="cb"></div>
                    <div class="input_validation_copy_shell"><div id="companyname_input_validation_copy" class="input_validation_copy"><?php echo $oUSER->getLangElem('ERR_REQ_COMPANYNAME'); ?></div></div>
                    <div class="cb"></div>
                </div>
                <div class="cb_20"></div>
                <div id="submit_shell" class="form_submit_shell" style="width:180px;">
                <div id="new_client_submit_btn" class="form_submit_btn" onMouseOver="mycrnrstn_fhandler.submitBtnMouseOver(this); return false;" onMouseOut="mycrnrstn_fhandler.submitBtnMouseOut(this); return false;">CREATE CLIENT</div>
                </div>
                <div class="cb_40"></div>
                <div class="hidden">
                    <input name="submitin" type="submit" value="submit" onClick="mycrnrstn_fhandler.formSubmit('new_client'); return false;">
                    <div id="login_main_errmsg"></div>
                    <div id="feedback_max_char_cnt">2000</div>
                </div>
                  
            </form>
            
        </div>
    </div>


</div>
</main>

<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/footer/ftr.inc.php');
?>
</body>
</html>
<?php
}
?>
