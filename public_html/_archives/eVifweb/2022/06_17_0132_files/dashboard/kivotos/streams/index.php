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
$tmp_lang_elem = 'SITE_TITLE|SITE_TITLE_STYLED|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP|LABEL_LAST_LOGIN';
$tmp_lang_elem .= '|INPUT_TITLE_FIRST_NAME|INPUT_TITLE_LAST_NAME|INPUT_TITLE_JOB_TITLE|INPUT_TITLE_ISO_CODE|INPUT_TITLE_EMAIL|PAGE_TITLE_USER_SETTINGS|PAGE_USER_SETTINGS_DESCR|TEXT_REQUIRED';
$tmp_lang_elem .= '|FINITE_EXP_YEAR|FINITE_EXP_YEARS|FINITE_EXP_Y|FINITE_EXP_WEEK|FINITE_EXP_WEEKS|FINITE_EXP_W|FINITE_EXP_DAY|FINITE_EXP_DAYS|FINITE_EXP_D|FINITE_EXP_HOUR|FINITE_EXP_HOURS|FINITE_EXP_H|FINITE_EXP_MINUTE|FINITE_EXP_MINUTES|FINITE_EXP_M|FINITE_EXP_SECOND|FINITE_EXP_SECONDS|FINITE_EXP_S|FINITE_EXP_AND|FINITE_EXP_AGO';
$oUSER->prepLangElem($tmp_lang_elem);

//
// THIS IS WHERE WE COULD INITIALIZE $oCRNRSTN_ENV->FINITE_EXPRESS OBJECT WITH LANG SITUATION
// MAYBE PASS ARRAY['YEAR','MONTH','']
// WELL, THE LANG DATA WILL ALL BE IN THE oDB_RESP OBJECT. SO I GUESS WE COULD PASS THAT GUY IN HERE?
// PASS IN $oUSER. THIS REALLY BITES FOR CRNRSTN. IMPLICATIONS ARE THAT NOT SO EASY TO STANDARDIZE THE OPEN SOURCE
// TOOL (CRNRSTN) TO INCLUDE THIS FUNCTIONALITY WITHOUT BEING SOOOO SPECIFIC. I DON'T REALLY WANT TO
// SHARE MY USER CLASS. WOULD NEED TO BUILD A CLEAN MIT LICENSABLE VERSION OF IT FOR THIS PURPOSE.
// THE OTHER OPTION IS TO PULL oFINITE_EXPRESS OUT OF CRNRSTN AND INSTANTIATE WITHIN USER CLASS.
// WELL, IF PHP COMMUNITY WANTS TO SUPPORT MULT LANG THROUGH CRNRSTN USING oFINITE_EXPRESS, THEN IT
// WILL BE MORE INVOLVED. WE CAN HAVE ENGLISH DEFAULT W/O ANY CONFIGURATION SO NO WORRIES FOR MOST USE OF CRNRSTN??
$oCRNRSTN_ENV->oFINITE_EXPRESS->configure_language($oUSER);       // THERE SHOULD BE NO DATABASE HIT INCURRED HERE. EITHER PASS IN OBJECT, ARRAY, OR STRING WITH NEEDED DATA.

//
// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');

//
// RETRIEVE RESPONSE OBJECT
$tmp_serial_handle = 'K_STREAM';
$oDB_RESP = $oUSER->getKivotosStreamData($tmp_serial_handle);

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
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/classes/mininav.inc.php');
	$oMiniNav = new miniNav('kivotosDetails');
	$oMiniNav->configureLink('details', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/kivotos/?kid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'kid'));
	$oMiniNav->configureLink('streams', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/kivotos/streams/?kid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'kid'),true);
	$oMiniNav->configureLink('logs', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/kivotos/logs/?kid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'kid'));
	$oMiniNav->configureLink('refresh', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/kivotos/streams/?kid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'kid'));

	$tmp_formUnique = $oUSER->generateNewKey(4);
    #$tmp_clientName_Header = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'CLIENTS', 'COMPANYNAME_BLOB');
    $tmp_clientName_Header = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'CLIENTS', $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'CLIENT_ID'), 'COMPANYNAME_BLOB');
    require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/search/search.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/dashboard.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header.mobi.inc.php');
	?>
    
    <!-- 
    //
    // BEGIN MAIN CONTENT -->
	<div role="main" class="ui-content">

        <h3 style=" padding-bottom:0px; margin-bottom:0px;"><?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'NAME'); ?></h3>
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
                        $tmp_CLIENTS_CLIENT_ID = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'CLIENT_ID');
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
                <input type="hidden" name="stk" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt('KIVOTOS'); ?>">
                <input type="hidden" name="cid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'CLIENT_ID')); ?>">
                <input type="hidden" name="kid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'kid')); ?>">
                <input type="hidden" name="upload_auth_key" id="upload_auth_key" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->getEnvParam('ASSET_UPLOAD_AUTHKEY')); ?>">
                <input type="hidden" name="at" id="at" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt('STREAM'); ?>">
                <input type="hidden" name="uid" id="uid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('USERID')); ?>">
                <input type="hidden" name="sid" id="sid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt(session_id()); ?>">
                <input type="hidden" name="uip" id="uip" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($_SERVER['REMOTE_ADDR']); ?>">
                <input type="hidden" name="channel" id="channel" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('DEVICETYPE')); ?>">
                <input type="hidden" name="ic" id="ic" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'CLIENTS', $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'CLIENT_ID'), 'LANGCODE')); ?>">
                <input type="hidden" name="dload_endpoint" id="dload_endpoint" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->getEnvParam('ASSET_DLOAD_ENDPOINT')); ?>">
                <input type="hidden" name="preview_endpoint" id="preview_endpoint" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->getEnvParam('ASSET_PREVIEW_ENDPOINT')); ?>">

            </form>

            <div class="cb_20"></div>
        </div>
        <input type="search" name="stream_search" id="stream_search" value="" placeholder="Search streams..."  style="padding-top:3px; margin-top:0px;">

        <?php
        if($oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_POST)) {
            if ($oCRNRSTN_ENV->oHTTP_MGR->issetParam($_POST, 'toggle_asset_stream')) {
                $tmp_asset_hide = $oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, 'toggle_asset_stream');
            }else{

                $tmp_asset_hide = 0;
            }

        }else{
            $tmp_asset_hide = 0;

        }

        switch($tmp_asset_hide){
            case "1":
                $tmp_combo = '<option value="0">No</option>
        <option value="1" selected="">Yes</option>';
            break;
            default:
                $tmp_combo = '<option value="0" selected="">No</option>
        <option value="1">Yes</option>';
            break;

        }

        ?>
        <table>
            <tr>
                <td><form action="#" method="post" name="toggle_asset_stream" id="toggle_asset_stream"  enctype="multipart/form-data" data-ajax="false">
                        <select name="toggle_asset_stream" id="toggle_asset_stream" data-role="slider" data-mini="true" onchange="evifweb_stream_toggle_assets('toggle_asset_stream');">
                        <?php echo $tmp_combo; ?>
                    </select></form></td>
                <td><p style="padding-top:9px; margin-top:0px;">&nbsp;Hide asset streams</p></td>
            </tr>

        </table>
        <div class="stream_hr"></div>
        <div class="cb_10"></div>

        <!--
        It would be OK to use table structure here....but let's try to take another approach to see how it goes.
        -->
        <?php

        //
        // SO I THINK WHAT IS HERE IS ACCEPTABLE. WHEN IT COMES TO STREAM IMPLEMENTATION ON A PAGE, THIS IS ALL THAT IS REQUIRED.
        $oSTREAM_MGR = new stream_manager($oCRNRSTN_ENV, $oUSER);
        $tmp_stream_type = 'KIVOTOS';
        $tmp_resp_obj_profile = 'KIVOTOS';          // THIS WILL TELL US WHAT DATA TO PULL FROM DB RESPONSE OBJECT. PIPE DELIM.
        $tmp_resp_obj_profile_key_fields = 'KIVOTOS_ID';    // THIS WILL TELL US KEY FIELD FOR DATA PROFILE. PIPE DELIM.

        echo $oSTREAM_MGR->return_streams('WEB', $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("DEVICETYPE"), $tmp_stream_type, $tmp_resp_obj_profile, $tmp_resp_obj_profile_key_fields, $oDB_RESP->return_serial($tmp_serial_handle), $oDB_RESP);
        echo '<div id="stream_dom_handles" class="hidden">'.$oSTREAM_MGR->stream_vert_flow_DOM_handles.'</div>';

        if(1==2) {
            ?>
            <div id="stream_output_wrapper">
                <!-- n=0 streams -->
                <div id="stream_00_wrapper">
                    <div id="stream_vert_flow_00" class="vert_flow_wrapper">
                        <div id="stream_vert_flow_00_repeat"
                             style="background-image: url('<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/stream_raw_repeat_block_2px_01.png'); background-repeat: repeat-y; width:17px; overflow: hidden;"></div>
                        <div class="stream_vert_flow_cap"
                             style="background-image: url('<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/stream_raw_cap_block_2px_01.png'); background-repeat: none; width:17px; height: 68px; overflow: hidden;"></div>
                    </div>
                    <div id="stream_order_00_wrapper" class="stream_order_wrapper">
                        <!-- THE HEIGHT OF THIS ELEMENT IS USED TO CALCULATE HEIGHT OF REPEATING STREAM CREATIVE CONTAINER -->
                        <div class="single_stream_wrapper">
                            <div class="stream_content" onclick="evifweb_set_stream_content_style_height();"><a
                                        href="#">@JonathanHarris</a> can we update the color of the
                                background to make it align more to the logo
                                border and logo font color?
                            </div>
                            <div class="stream_owner">by <a href="#">Sally Johnson</a></div>
                            <div class="stream_stamp_reply_wrapper">
                                <div class="stream_timestamp">9.30.2018 @ 1340</div>
                                <div class="stream_reply"><a href="#">(5)</a> <a href="#">Reply</a></div>
                            </div>
                            <div class="cb_5"></div>
                            <div class="stream_hr"></div>
                        </div>


                        <!-- AN ORDER 1 (FEEDER) STREAM -->
                        <div id="stream_01_wrapper">
                            <div id="stream_vert_flow_01" class="vert_flow_wrapper">
                                <div id="stream_vert_flow_01_repeat"
                                     style="background-image: url('<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/stream_raw_repeat_block_2px_01.png'); background-repeat: repeat-y; width:17px; overflow: hidden;"></div>
                                <div class="stream_vert_flow_cap"
                                     style="height:68px; background-image: url('<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/stream_raw_cap_block_2px_01.png'); background-repeat: none; width:17px; height: 68px; overflow: hidden;"></div>
                            </div>

                            <div id="stream_order_01_wrapper" class="stream_order_wrapper">
                                <div class="single_stream_wrapper">
                                    <div class="stream_content" onclick="evifweb_set_stream_content_style_height();"><a
                                                href="#">@SallyJohnson</a> yes, no problem. The
                                        creative has been updated and is assigned
                                        to you for review and approvals.
                                    </div>
                                    <div class="stream_owner">by <a href="#">Jonathan Harris</a></div>
                                    <div class="stream_stamp_reply_wrapper">
                                        <div class="stream_timestamp">9.30.2018 @ 1440</div>
                                        <div class="stream_reply"><a href="#">(3)</a> <a href="#">Reply</a></div>
                                    </div>
                                    <div class="cb"></div>
                                    <div><em>Modified 9.30.2018 @ 1440</em></div>
                                    <div class="cb"></div>
                                    <div class="stream_edit_lnk"><a href="#">[edit]</a></div>
                                    <div class="cb_5"></div>
                                    <div class="stream_hr"></div>
                                </div>

                                <div id="stream_02_wrapper">
                                    <div id="stream_vert_flow_02" class="vert_flow_wrapper">
                                        <div id="stream_vert_flow_02_repeat"
                                             style="background-image: url('<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/stream_raw_repeat_block_2px_01.png'); background-repeat: repeat-y; width:17px; overflow: hidden;"></div>
                                        <div class="stream_vert_flow_cap"
                                             style="height:68px; background-image: url('<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/stream_raw_cap_block_2px_01.png'); background-repeat: none; width:17px; height: 68px; overflow: hidden;"></div>
                                    </div>

                                    <div id="stream_order_02_wrapper" class="stream_order_wrapper">
                                        <div class="single_stream_wrapper">
                                            <div class="stream_content"
                                                 onclick="evifweb_set_stream_content_style_height();"><a href="#">@JonathanHarris</a>
                                                thank you!
                                            </div>
                                            <div class="stream_owner">by <a href="#">Sally Johnson</a></div>
                                            <div class="stream_stamp_reply_wrapper">
                                                <div class="stream_timestamp">9.30.2018 @ 1450</div>
                                                <div class="stream_reply"><a href="#">(9)</a> <a href="#">Reply</a>
                                                </div>
                                            </div>
                                            <div class="cb"></div>
                                            <div class="stream_edit_lnk"><a href="#">[edit]</a></div>
                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="cb_10"></div>
                        <!-- BACK TO ORDER 0 STREAM -->
                        <div class="single_stream_wrapper">
                            <div class="stream_content"><a href="#">@JonathanHarris</a> can we update the color of the
                                background to make it align more to the logo
                                border and logo font color?
                            </div>
                            <div class="stream_owner">by <a href="#">Sally Johnson</a></div>
                            <div class="stream_stamp_reply_wrapper">
                                <div class="stream_timestamp">9.30.2018 @ 1340</div>
                                <div class="stream_reply"><a href="#">(5)</a> <a href="#">Reply</a></div>
                            </div>
                            <div class="cb"></div>
                            <div class="stream_edit_lnk"><a href="#">[edit]</a></div>
                            <div class="cb_5"></div>
                            <div class="stream_hr"></div>
                        </div>


                        <div class="single_stream_wrapper">
                            <div class="stream_content"><a href="#">@JonathanHarris</a> can we update the color of the
                                background to make it align more to the logo
                                border and logo font color?
                            </div>
                            <div class="stream_owner">by Sally Johnson</div>
                            <div class="stream_stamp_reply_wrapper">
                                <div class="stream_timestamp">9.30.2018 @ 1340</div>
                                <div class="stream_reply">(5) Reply</div>
                            </div>
                            <div class="cb_5"></div>
                            <div class="stream_hr"></div>
                        </div>


                        <div class="single_stream_wrapper">
                            <div class="stream_content"><a href="#">@JonathanHarris</a> can we update the color of the
                                background to make it align more to the logo
                                border and logo font color?
                            </div>
                            <div class="stream_owner">by Sally Johnson</div>
                            <div class="stream_stamp_reply_wrapper">
                                <div class="stream_timestamp">9.30.2018 @ 1340</div>
                                <div class="stream_reply">(5) Reply</div>
                            </div>
                            <div class="cb_5"></div>
                            <!--<div class="stream_hr"></div> NOT ON LAST ELEMENT -->
                        </div>


                    </div>
                </div>
            </div>
            <?php

        }
        ?>

		<div class="cb_30"></div>
        <div data-role="navbar" data-iconpos="bottom">
            <ul>
                <li><a href="#" data-icon="arrow-l" class="ui-alt-icon">Previous</a></li>
                <li><a href="#" data-icon="arrow-r" class="ui-alt-icon">Next</a></li>
            </ul>
        </div><!-- /navbar -->
        <div class="cb_20"></div>

        <script>
            // popup examples
            $( document ).on( "pagecreate", function() {
                // The window width and height are decreased by 30 to take the tolerance of 15 pixels at each side into account
                function scale( width, height, padding, border ) {
                    var scrWidth = $( window ).width() - 30,
                        scrHeight = $( window ).height() - 30,
                        ifrPadding = 2 * padding,
                        ifrBorder = 2 * border,
                        ifrWidth = width + ifrPadding + ifrBorder,
                        ifrHeight = height + ifrPadding + ifrBorder,
                        h, w;
                    if ( ifrWidth < scrWidth && ifrHeight < scrHeight ) {
                        w = ifrWidth;
                        h = ifrHeight;
                    } else if ( ( ifrWidth / scrWidth ) > ( ifrHeight / scrHeight ) ) {
                        w = scrWidth;
                        h = ( scrWidth / ifrWidth ) * ifrHeight;
                    } else {
                        h = scrHeight;
                        w = ( scrHeight / ifrHeight ) * ifrWidth;
                    }
                    return {
                        'width': w - ( ifrPadding + ifrBorder ),
                        'height': h - ( ifrPadding + ifrBorder )
                    };
                };
                $( ".ui-popup iframe" )
                    .attr( "width", 0 )
                    .attr( "height", "auto" );
                $( "#<?php echo $oSTREAM_MGR->returnReplyformID(); ?> iframe" ).contents().find( "#reply_stream_input" )
                    .css( { "width" : 0, "height" : 0 } );
                $( "#<?php echo $oSTREAM_MGR->returnReplyformID(); ?>" ).on({
                    popupbeforeposition: function() {
                        var size = scale( 480, 320, 0, 1 ),
                            w = size.width,
                            h = size.height;
                        $( "#<?php echo $oSTREAM_MGR->returnReplyformID(); ?> iframe" )
                            .attr( "width", w )
                            .attr( "height", h );
                        $( "#popupMap iframe" ).contents().find( "#reply_stream_input" )
                            .css( { "width": w, "height" : h } );
                    },
                    popupafterclose: function() {
                        $( "#<?php echo $oSTREAM_MGR->returnReplyformID(); ?> iframe" )
                            .attr( "width", 0 )
                            .attr( "height", 0 );
                        $( "#<?php echo $oSTREAM_MGR->returnReplyformID(); ?> iframe" ).contents().find( "#reply_stream_input" )
                            .css( { "width": 0, "height" : 0 } );
                    }
                });
            });

        </script>
        

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
	<div id="dashboard_page_title"><?php echo $oUSER->getLangElem('PAGE_TITLE_USER_SETTINGS'); ?></div>
    <div class="cb_10"></div>
    <div><?php echo $oUSER->getLangElem('PAGE_USER_SETTINGS_DESCR'); ?></div>
    <div class="cb_10"></div>
    <table>
    <tr>
    	<td style="padding-right:10px;"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/";  ?>" data-ajax="false">Back to Users</a></td>
		<td style="padding-right:10px;"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/pwdreset/?uid=".$tmp_userData['USERID']; ?>">Reset Password</a></td>
                
                <?php
				if($tmp_userData['ISACTIVE']==6){
				?>
                <td style="padding-right:10px;"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/accntunlock/?uid=".$tmp_userData['USERID']; ?>">Unlock Account</a></td>
					
                <?php
				}else{
				?>
                <td style="padding-right:10px;"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/accntlock/?uid=".$tmp_userData['USERID']; ?>">Lock Account</a></td>
                
                <?php
				}
				?>
				<td style="padding-right:10px;"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/delete/?uid=".$tmp_userData['USERID']; ?>" style="background-color:#F00; color:#FFF; padding:5px;">Delete Account</a></td>
				
    </tr>
    </table>
    <!-- 
    //
    // BEGIN MAIN CONTENT -->
	<div role="main" class="ui-content">		
        <div class="ui-corner-all custom-corners">
            <div class="ui-bar ui-bar-a">
                <h4>Account Type</h4>
            </div>
            <div class="ui-body ui-body-a">
            <p>
        		<?php
				$tmp_userPermissionTypeArray = array('Basic Client Account' => 50,'Client Admin' => 100,
													 'Media' => 200,'Creative' => 300,'Technology' => 320, 'eCRM' => 325,
													 'Account Services' => 350,'Admin - Accnt Services' =>380,
													 'Finance' => 390, 'HR' => 395,
													 'Translation' => 405,'System Admin' => 410,'System Admin 420' => 420
					);
				
				?>
                <form action="#" method="post" name="edit_permissionType" id="edit_permissionType"  enctype="multipart/form-data" >
                    <select name="permissions_id" onChange="mycrnrstn_fhandler.evifweb_accountTypeSelect();">
                        <?php
                        foreach($tmp_userPermissionTypeArray as $tmp_type=>$tmp_id){
                            if($tmp_id==$tmp_userData['USER_PERMISSIONS_ID']){
                                $tmp_sel = "selected";
                            }else{
                                $tmp_sel = NULL;
                            }
                        ?>
                        <option value="<?php echo $tmp_id; ?>" <?php echo $tmp_sel; ?>><?php echo $tmp_type; ?></option>
                        
                        <?php
                        }
                        ?>
                        
                    </select>
                    <input type="hidden" name="postid" value="edit_permissionType">
                    <input type="hidden" name="uid" id="uid" value="<?php echo $tmp_userData['USERID']; ?>">
                    <input type="hidden" name="fname" value="<?php echo $tmp_userData['FIRSTNAME_BLOB']; ?>">
                    <input type="hidden" name="lname" value="<?php echo $tmp_userData['LASTNAME_BLOB']; ?>">
                </form>
                
                </p>            
            
            </div>
        </div>


        <div class="ui-corner-all custom-corners">
            <div class="ui-bar ui-bar-a">
                <h4>Account Information</h4>
            </div>
            <div class="ui-body ui-body-a">
            	<div class="copy"><strong><?php echo $oUSER->getLangElem('LABEL_LAST_LOGIN'); ?></strong> <span style="font-weight:normal;"><?php echo date("m.d.Y H:i:s", strtotime($tmp_userData['LASTLOGIN'])); ?></span></div>
                <div class="copy"><strong>IP:</strong> <span style="font-weight:normal;"><?php echo $tmp_userData['LASTLOGIN_IP']; ?></span></div>

                    <div class="copy"><strong><?php echo $oUSER->getLangElem('INPUT_TITLE_FIRST_NAME'); ?>:</strong>&nbsp;<a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/settings/edit/?uid=".$tmp_userData['USERID'];  ?>"><span style="font-weight:normal;"><?php echo $tmp_userData['FIRSTNAME_BLOB']; ?></span></a></div>
                    <div class="copy"><strong><?php echo $oUSER->getLangElem('INPUT_TITLE_LAST_NAME'); ?>:</strong>&nbsp;<a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/settings/edit/?uid=".$tmp_userData['USERID'];  ?>"><span style="font-weight:normal;"><?php echo $tmp_userData['LASTNAME_BLOB']; ?></span></a></div>
                    <div class="copy"><strong><?php echo $oUSER->getLangElem('INPUT_TITLE_JOB_TITLE'); ?>:</strong>&nbsp;<a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/settings/edit/?uid=".$tmp_userData['USERID'];  ?>"><span style="font-weight:normal;"><?php echo $tmp_userData['JOBTITLE_BLOB']; ?></span></a></div>
                    <div class="copy"><strong><?php echo $oUSER->getLangElem('INPUT_TITLE_EMAIL'); ?>:</strong>&nbsp;<a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/settings/edit/?uid=".$tmp_userData['USERID'];  ?>"><span style="font-weight:normal;"><?php echo $tmp_userData['EMAIL']; ?></span></a></div>
                    <div class="copy"><strong><?php echo $oUSER->getLangElem('INPUT_TITLE_ISO_CODE'); ?></strong>:&nbsp;<span style="font-weight:normal;"><?php echo $tmp_userData['LANGCODE']; ?></span></div>
                    <?php
					if($tmp_userData['ISACTIVE']==5){
					?>
                    <div class="copy"><strong>Status:</strong> <span style="font-weight:normal;"><span class="the_R">Account not email verified.</span></div>
                    
                    <?php
					}

					if(sizeof($tmp_clientData)>0){
					?>
                    <div class="copy"><strong>Approved Client Access</strong></div>
                    
                    <?php
					}
					if(sizeof($tmp_clientData)>0){
						$tmp_loop_size11 = sizeof($tmp_clientData);
						for($i=0;$i<$tmp_loop_size11;$i++){
							if($tmp_userClient[$tmp_clientData[$i]['CLIENT_ID']]==1){
								$tmp_clientFlag = 1;
							?>
							<div class="copy"><?php echo $tmp_clientData[$i]['COMPANYNAME_BLOB']; ?>&nbsp;<a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/settings/accessdelete/?uid=".$tmp_userData['USERID']."&cid=".$tmp_clientData[$i]['CLIENT_ID'];  ?>" data-ajax="false">(remove access)</a></div>
                            
                            <?php
							}
						}
					}
					
					if(!isset($tmp_clientFlag)){
						switch($tmp_userData['USER_PERMISSIONS_ID']){
							case 420:
							case 410:
							case 380:
							case 350:
							case 320:
							case 300:
							case 200:
								echo '<div class="copy">Access to all clients.</div>';
							
							
							break;
							default:
								echo '<div class="copy">No client access.</div>';
							
							break;
						
						}
					
					}
						
					
					?>
                    
                    <div class="copy"><h4>Add Client Access</h4></div>
                    <form action="#" method="post" name="add_clientAccess" id="add_clientAccess"  enctype="multipart/form-data" >
                        <select name="clientToAccess" onChange="mycrnrstn_fhandler.evifweb_clientAccess_ADD();">
                            <option value="" selected>Select Client</option>
                            <option value="ALL">All Clients</option>
                            
                        <?php
                        if(sizeof($tmp_clientData)>0){
							$tmp_loop_size35 = sizeof($tmp_clientData);
                            for($i=0;$i<$tmp_loop_size35;$i++){
                                ?>
                                <option value="<?php echo $tmp_clientData[$i]['CLIENT_ID'];  ?>"><?php echo $tmp_clientData[$i]['COMPANYNAME_BLOB']; ?></option>
                                <?php
                            }
                        }
                        
                        ?>
                        </select>
                        <input type="hidden" name="postid" value="add_clientAccess">
                   		<input type="hidden" name="uid" value="<?php echo $tmp_userData['USERID']; ?>">
                        <input type="hidden" name="user_permissions_id" value="<?php echo $tmp_userData['USER_PERMISSIONS_ID']; ?>">
                    	<input type="hidden" name="fname" value="<?php echo $tmp_userData['FIRSTNAME_BLOB']; ?>">
                   		<input type="hidden" name="lname" value="<?php echo $tmp_userData['LASTNAME_BLOB']; ?>">
                    </form>
                    <div class="cb_20"></div>
                
            </div>
        </div>

	</div><!-- /content -->

    
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
