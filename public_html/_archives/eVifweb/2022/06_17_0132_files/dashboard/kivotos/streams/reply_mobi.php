<?php


// LOL...THIS WAS CRUSHING MY LOG OUTPUTS...SO I HAD TO KILL IT FOR THE TIME BEING. I THINK WE CAN LET IT LOOSE NOW....ABOUT TO TAME IT.
//error_log("reply_mobi (5) IFRAME reply form sending....die()");
//die();
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
$oUSER->prepLangElem($tmp_lang_elem);

//
// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');

//
// RETRIEVE RESPONSE OBJECT
$tmp_serial_handle = 'K_STREAM';

error_log("reply_mobi (25) stream reply form getKivotosStreamData() call....");
$oDB_RESP = $oUSER->getKivotosStreamData($tmp_serial_handle);

//
// HANDLE FILE STREAM REPLY RESPONSES
if($oCRNRSTN_ENV->oHTTP_MGR->issetParam($_GET, 'srid')){
    $tmp_stream_reply_status = 'active';
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
        <!--
        //
        // BEGIN MAIN CONTENT -->
        <div role="main" class="ui-content">
            <?php
            if(isset($tmp_stream_reply_status)){
                echo "<h3>Success!</h3>";
                echo "<div id='reply_redirect' class='hidden'>http://172.16.225.128/evifweb/dashboard/kivotos/streams/?kid=5oxHrsivZJPmH6c3uSBDOeM9AwaM18YGtSoL8uUtObOFkO6iI2uxTS9A9T8uEvXGYKEdSF</div>";

            }else {

                ?>

                <div id="reply_stream_input">
                    <form action="#" method="post" name="create_stream" id="create_stream" enctype="multipart/form-data"
                          data-ajax="false">
                        <label for="stream">Reply to stream</label>
                        <textarea cols="40" rows="3" name="stream" id="stream" style="width:88%;"></textarea>
                        <div class="frm_errstatus stream"
                             style="width:100%; display:none;"><?php echo $oUSER->getLangElem('TEXT_REQUIRED'); ?></div>
                        <p style="padding-top: 0; margin-top: 0;"><a href="#" id="open-popup_mention"
                                                                     class="clickable-area"
                                                                     style="text-decoration:none; text-underline:none;">@mention</a>
                            <a id="stream_file_attach_lnk" href="#" style="text-decoration:none; text-underline:none;"
                               onclick="evifweb_display_stream_toggle_fileAttach();">@attachFile</a></p>

                        <!-- NEED TO HIDE ON LOAD AND REVEAL ON CLICK-->
                        <div id="stream_file_attach" style="width:88%;">
                            <label for="assetname">asset name <span class="req_star">*</span></label>
                            <input type="text" name="assetname" id="assetname" value="">
                            <div class="frm_errstatus assetname"
                                 style="width:100%; display:none;"><?php echo $oUSER->getLangElem('TEXT_REQUIRED'); ?></div>

                            <label for="assetfile">attach file <span class="req_star">*</span></label>
                            <input type="file" name="assetfile" id="assetfile" value="">
                            <div class="frm_errstatus assetfile"
                                 style="width:100%; display:none;"><?php echo $oUSER->getLangElem('TEXT_REQUIRED'); ?></div>
                            <div class="cb"></div>
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
                                for ($i = 0; $i < $tmp_loop_size; $i++) {

                                    //
                                    // IF CLIENT/USER ACCESS SPECIFIED, LIMIT DISPLAY USER TO ONLY EXPLICIT ALLOW.
                                    $tmp_USERS_USERID = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i);
                                    if ($oDB_RESP->ping_value_existence($oDB_RESP->return_serial($tmp_serial_handle), 'USERS_CLIENT_ASSOC', 'USER_ID', $tmp_USERS_USERID)) {

                                        //
                                        // LETS WORK ON GETTING THE DATA WE NEED TO SUPPORT THIS...THEN COME BACK...
                                        if ($oDB_RESP->flag_isset_for_userClient($oDB_RESP->return_serial($tmp_serial_handle), $tmp_USERS_USERID)) {
                                            $tmp_loop_1_size = $oDB_RESP->return_UserClientAssocCnt($oDB_RESP->return_serial($tmp_serial_handle), $tmp_USERS_USERID);
                                            for ($ii = 0; $ii < $tmp_loop_1_size; $ii++) {
                                                if ($oDB_RESP->ping_user_client_assoc($oDB_RESP->return_serial($tmp_serial_handle), $tmp_USERS_USERID, $tmp_CLIENTS_CLIENT_ID) && !isset($tmp_userDisplay[$tmp_USERS_USERID])) {

                                                    $tmpOutputHTML .= '<p><a href="#" onclick="evifweb_form_component_content_append(\'popup_mention\',\'textarea\',\'stream\',\'stream_mentions_eid\',\'' . $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i) . '\',\'' . $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i) . '=' . $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)) . '\');">' . $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i) . " " . $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i) . '</a>, e<span class="the_V">V</span>ifweb</p>';

                                                    $tmp_userDisplay[$tmp_USERS_USERID] = 1;
                                                }
                                            }

                                        } else {

                                            //
                                            // USER CLIENT RELATION NOT SPECIFIED. ONLY DISPLAY USER IF APPROVED EVIFWEB USER PERMISSIONS ID.
                                            # $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)
                                            if ($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i) > 160 && !($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i) == 405)) {

                                                $tmpOutputHTML .= '<p><a href="#" onclick="evifweb_form_component_content_append(\'popup_mention\',\'textarea\',\'stream\',\'stream_mentions_eid\',\'' . $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i) . '\',\'' . $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i) . '=' . $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)) . '\');">' . $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i) . " " . $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i) . '</a>, e<span class="the_V">V</span>ifweb</p>';

                                                $tmp_userDisplay[$tmp_USERS_USERID] = 1;
                                            }

                                        }
                                    } else {

                                        //
                                        // USER CLIENT RELATION NOT SPECIFIED. ONLY DISPLAY USER IF APPROVED EVIFWEB USER PERMISSIONS ID.
                                        if ($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i) > 160 && !($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i) == 405)) {

                                            $tmpOutputHTML .= '<p><a href="#" onclick="evifweb_form_component_content_append(\'popup_mention\',\'textarea\',\'stream\',\'stream_mentions_eid\',\'' . $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i) . '\',\'' . $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i) . '=' . $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)) . '\');">' . $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i) . " " . $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i) . '</a>, e<span class="the_V">V</span>ifweb</p>';

                                            $tmp_userDisplay[$tmp_USERS_USERID] = 1;
                                        }
                                    }
                                }

                                echo $tmpOutputHTML;

                                ?>
                            </div>
                        </div>
                        <script>
                            $.mobile.document.on("click", "#open-popup_mention", function (evt) {
                                $("#popup_mention").popup("open", {x: evt.pageX, y: evt.pageY});

                                $("#popup_mention").popup({
                                    afterclose: function (event, ui) {
                                        $('#stream').focus();
                                    }
                                });

                                evt.preventDefault();
                            });

                            $("#create_stream").submit(function (event) {
                                //
                                // VALIDATE FORM
                                return validateForm('create_stream');
                            });
                        </script>
                        <div class="hidden"
                             id="ASSET_POST_ENDPOINT"><?php echo $oCRNRSTN_ENV->getEnvParam('ASSET_POST_ENDPOINT'); ?></div>
                        <div class="hidden" id="stream_file_attach_copy">@attachFile</div>
                        <div class="hidden" id="stream_file_cancel_copy">@removeFile</div>
                        <div class="cb_5"></div>
                        <button class="ui-shadow ui-btn ui-corner-all" type="submit" id="submit" style="width:88%;">
                            SUBMIT REPLY
                        </button>
                        <input type="hidden" name="postid" value="create_reply_stream">
                        <input type="hidden" name="osi" id="osi"
                               value="">
                        <input type="hidden" name="sme" id="stream_mentions_eid" value="">
                        <input type="hidden" name="stk"
                               value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt('KIVOTOS'); ?>">
                        <input type="hidden" name="cid"
                               value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'CLIENT_ID')); ?>">
                        <input type="hidden" name="kid"
                               value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'kid')); ?>">
                        <input type="hidden" name="upload_auth_key" id="upload_auth_key"
                               value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->getEnvParam('ASSET_UPLOAD_AUTHKEY')); ?>">
                        <input type="hidden" name="at" id="at"
                               value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt('STREAM'); ?>">
                        <input type="hidden" name="uid" id="uid"
                               value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('USERID')); ?>">
                        <input type="hidden" name="sid" id="sid"
                               value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt(session_id()); ?>">
                        <input type="hidden" name="uip" id="uip"
                               value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($_SERVER['REMOTE_ADDR']); ?>">
                        <input type="hidden" name="channel" id="channel"
                               value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('DEVICETYPE')); ?>">
                        <input type="hidden" name="ic" id="ic"
                               value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'CLIENTS', $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'CLIENT_ID'), 'LANGCODE')); ?>">
                        <input type="hidden" name="dload_endpoint" id="dload_endpoint"
                               value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->getEnvParam('ASSET_DLOAD_ENDPOINT')); ?>">
                        <input type="hidden" name="preview_endpoint" id="preview_endpoint"
                               value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->getEnvParam('ASSET_PREVIEW_ENDPOINT')); ?>">

                    </form>
                    <div class="cb"></div>
                </div>

                <?php

            }
            ?>
            <div class="cb"></div>
        </div><!-- /content -->

    </div><!-- /page -->

    </body>
    </html>

    <?php
}
?>
