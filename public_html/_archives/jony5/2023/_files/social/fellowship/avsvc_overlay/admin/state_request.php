<?php

/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');

//
// RETRIEVE OVERLAY STATE FROM DB
// DATABASE REQUEST/RESPONSE PROCESSING
$tmp_serial_handle = 'OVERLAY_DATUM';
$oDB_RESP = $oUSER->getOverlayStateDatum($tmp_serial_handle);

$tmp_overlay_response = NULL;
$tmp_fullscreen_overlay_response = NULL;

$oLogger = new crnrstn_logging();

# STAGE DYNAMIC VARS FOR HTML/CSS INSERTION
// MINI
$tmp_mini_profile_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial('OVERLAY_DATUM'), 'OVERLAY_MGMT', 'MINI_PROFILE');
$tmp_fullscreen_profile_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial('OVERLAY_DATUM'), 'OVERLAY_MGMT', 'FULLSCREEN_PROFILE');


$tmp_copy_timer = file_get_contents($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/social/fellowship/avsvc_overlay/_lib/_source/copy_initialize_timer.txt', FILE_USE_INCLUDE_PATH);
$tmp_delim = "<||>";

$tmp_mini_state = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'MINI_STATE');
$tmp_fullscreen_state = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'FULLSCREEN_STATE');
$tmp_modifier_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'MODIFIER_ID');

$tmp_mini_bgcolor = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_CONFIG', 'HEXCOLOR');
$tmp_mini_opacity = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_CONFIG', 'OPACITY');

$tmp_fullscrn_bgcolor = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'HEXCOLOR');
$tmp_fullscrn_opacity = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'OPACITY');



$tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PROFILE');
for($i=0; $i<$tmp_loop_size; $i++){
    $tmp_profile_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PROFILE', 'PROFILE_ID', $i);

    if($tmp_fullscreen_profile_id==$tmp_profile_id){

        $tmp_fullscrn_page_header = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PROFILE', 'PAGE_HEADER_BLOB', $i);
        $tmp_fullscrn_page_title = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PROFILE', 'PAGE_TITLE_BLOB', $i);
        $tmp_fullscrn_page_code = urldecode($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PROFILE', 'PAGE_CODE_BLOB', $i));

        // error_log('102');
        if(!$oCRNRSTN_ENV->oSESSION_MGR->issetSessionParam("MINI_STATE")){

            //
            // INITIALIZE SESSION
            $oCRNRSTN_ENV->oSESSION_MGR->setSessionParam("MINI_STATE", $tmp_mini_state);
            $oCRNRSTN_ENV->oSESSION_MGR->setSessionParam("FULLSCREEN_STATE", $tmp_fullscreen_state);
            $oCRNRSTN_ENV->oSESSION_MGR->setSessionParam("MODIFIER_ID", $tmp_modifier_id);

            // error_log('111');
        }else{

            // error_log(114);
            //
            // INITIALIZE SESSION
            $tmp_sess_mini_state = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("MINI_STATE");
            $tmp_sess_fullscreen_state = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("FULLSCREEN_STATE");
            $tmp_sess_modifier_id = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("MODIFIER_ID");

            #  || $tmp_fullscreen_state!=$tmp_sess_fullscreen_state
            //if($tmp_mini_state!=$tmp_sess_mini_state){
            if(1!=2){
                //error_log(122);
                //
                // CHANGE DETECTED - FORMAT RESPONSE

                # var delim_output = resp.split("<||>");
                $tmp_fullscreen_overlay_response = $tmp_fullscrn_page_header.$tmp_delim.$tmp_fullscrn_page_title.$tmp_delim.$tmp_fullscrn_page_code.$tmp_delim;


            }

        }

    }
}



$tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE');
for($i=0; $i<$tmp_loop_size; $i++){
    $tmp_profile_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'PROFILE_ID', $i);

    if($tmp_mini_profile_id==$tmp_profile_id){

        $tmp_mini_message_title = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'MESSAGE_TITLE_BLOB', $i);
        $tmp_mini_message_number = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'MESSAGE_NUMBER_BLOB', $i);
        $tmp_mini_message_speaker = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'MESSAGE_SPEAKER_BLOB', $i);
        $tmp_mini_conference_title = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'CONFERENCE_TITLE_BLOB', $i);

        $tmp_mini_width = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'OVERLAY_WIDTH', $i);
        $tmp_mini_height = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'OVERLAY_HEIGHT', $i);
        $tmp_mini_content_width = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'INNER_CONTENT_WIDTH', $i);
        $tmp_mini_margin_left = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'MARGIN_LEFT', $i);
        $tmp_mini_margin_right = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'MARGIN_RIGHT', $i);
        $tmp_mini_top = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'ABS_PX_FROM_TOP', $i);
        $tmp_mini_left = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'ABS_PX_FROM_LEFT', $i);

       // error_log('102');
        if(!$oCRNRSTN_ENV->oSESSION_MGR->issetSessionParam("MINI_STATE")){

            //
            // INITIALIZE SESSION
            $oCRNRSTN_ENV->oSESSION_MGR->setSessionParam("MINI_STATE", $tmp_mini_state);
            $oCRNRSTN_ENV->oSESSION_MGR->setSessionParam("FULLSCREEN_STATE", $tmp_fullscreen_state);
            $oCRNRSTN_ENV->oSESSION_MGR->setSessionParam("MODIFIER_ID", $tmp_modifier_id);

           // error_log('111');
        }else{

           // error_log(114);
            //
            // INITIALIZE SESSION
            $tmp_sess_mini_state = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("MINI_STATE");
            $tmp_sess_fullscreen_state = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("FULLSCREEN_STATE");
            $tmp_sess_modifier_id = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("MODIFIER_ID");

            //error_log(122);
            //
            // CHANGE DETECTED - FORMAT RESPONSE
            $tmp_overlay_response = $tmp_mini_state.$tmp_delim.$tmp_fullscreen_state.$tmp_delim.$tmp_modifier_id.$tmp_delim.$tmp_mini_opacity.$tmp_delim. $tmp_fullscrn_opacity.$tmp_delim. $tmp_mini_bgcolor.$tmp_delim. $tmp_fullscrn_bgcolor.$tmp_delim. $tmp_mini_conference_title.$tmp_delim.$tmp_mini_message_title.$tmp_delim.$tmp_mini_message_number.$tmp_delim.$tmp_mini_message_speaker.$tmp_delim.$tmp_copy_timer.$tmp_delim;


                /*
                 * novum_mini_state_html = delim_output[0];
			novum_full_state_html = delim_output[1];
			novum_mod_id_html = delim_output[2];
			novum_mini_opacity_html = delim_output[3];
			novum_fullscreen_opacity_html = delim_output[4];
			novum_mini_bgcolor_html = delim_output[5];
			novum_fullscreen_bgcolor_html = delim_output[6];
                 * */




        }

    }
}


echo $tmp_fullscreen_overlay_response.$tmp_overlay_response;