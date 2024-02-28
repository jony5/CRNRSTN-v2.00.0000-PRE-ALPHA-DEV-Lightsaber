<?php

/* 
// J5
// Code is Poetry */

require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/social/fellowship/avsvc_overlay/admin/inc/session/session.inc.php');

//
// RETRIEVE OVERLAY STATE FROM DB
// DATABASE REQUEST/RESPONSE PROCESSING
$tmp_serial_handle = 'OVERLAY_DATUM';
$oDB_RESP = $oUSER->getOverlayStateDatum($tmp_serial_handle);

$tmp_HTML_mini_output = '';
$tmp_mini_profile_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial('OVERLAY_DATUM'), 'OVERLAY_MGMT', 'MINI_PROFILE_ID');

$tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE');
for($i=0; $i<$tmp_loop_size; $i++){
    $tmp_profile_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'PROFILE_ID', $i);

    if($tmp_mini_profile_id==$tmp_profile_id){

        $tmp_mini_state = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'MINI_STATE');
        $tmp_fullscreen_state = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'FULLSCREEN_STATE');
        $tmp_modifier_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'MODIFIER_ID');

        $tmp_mini_bgcolor = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_CONFIG', 'HEXCOLOR');
        $tmp_mini_opacity = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_CONFIG', 'OPACITY');

        $tmp_fullscrn_bgcolor = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'HEXCOLOR');
        $tmp_fullscrn_opacity = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'OPACITY');
        $tmp_fullscrn_width = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'DEFAULT_WIDTH');
        $tmp_fullscrn_height = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'DEFAULT_HEIGHT');


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


        $tmp_profile_state = 'active';
    }else{

        $tmp_profile_state = "";

        $tmp_mini_state = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'MINI_STATE');
        $tmp_fullscreen_state = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'FULLSCREEN_STATE');
        $tmp_modifier_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'MODIFIER_ID');

        $tmp_mini_bgcolor = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_CONFIG', 'HEXCOLOR');
        $tmp_mini_opacity = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_CONFIG', 'OPACITY');

        $tmp_fullscrn_bgcolor = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'HEXCOLOR');
        $tmp_fullscrn_opacity = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'OPACITY');
        $tmp_fullscrn_width = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'DEFAULT_WIDTH');
        $tmp_fullscrn_height = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'DEFAULT_HEIGHT');


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


    }

    /*
    <div class="sub_sub_section_elem_wrapper">
            <div class="sub_sect_elem"><div class="super_able_elem">Message 2</div><div class="state_superscript"></div></div>
            <div class="sub_sect_elem_admin_lnk"><a href="#" target="_blank">view</a></div>
            <div class="sub_sect_elem_admin_lnk"><a href="#" target="_blank">edit</a></div>
            <div class="sub_sect_elem_mod">last modified 08/12/2019 at 1543hrs</div>
            <div class="cb"></div>
        </div>

        <div class="sub_sub_section_elem_wrapper">
            <div class="sub_sect_elem"><div class="super_able_elem">Message 3</div><div class="state_superscript">ACTIVE</div></div>
            <div class="sub_sect_elem_admin_lnk"><a href="#" target="_blank">view</a></div>
            <div class="sub_sect_elem_admin_lnk"><a href="#" target="_blank">edit</a></div>
            <div class="sub_sect_elem_mod">last modified 08/12/2019 at 1543hrs</div>
            <div class="cb"></div>
        </div>
    */

}

?>
<!doctype html>
<html lang="en">
<head>
    <?php
    require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/social/fellowship/avsvc_overlay/admin/inc/head/head.inc.php');
    ?>
</head>
<body>
    <div class="main_content_wrapper">
        <?php
        require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/social/fellowship/avsvc_overlay/admin/inc/nav_global_hdr/nav.inc.php');
        ?>
        <div class="overlay_mgmt_title">OBS :: Dynamic Overlay State Management</div>

        <?php
        switch($tmp_fullscreen_state){
            case '1':
            case '4':
            case '5':
            case '6':
                ?>
                <div class="admin_section_title">Manage Full Screen Overlay</div>
                    <div class="mgmt_lnk_btn" onclick="applyUpdate(this);" avreqid="hideovrly_fullscrn">HIDE OVERLAY</div>

                    <div class="cb_30"></div>
                    <div class="admin_section_title">Solid Color Controls</div>
                    <div class="mgmt_lnk_btn" onclick="applyUpdate(this);" avreqid="bluescrn">ACTIVATE BLUE SCREEN</div>
                    <div class="mgmt_lnk_btn" onclick="applyUpdate(this);" avreqid="whitescrn">ACTIVATE WHITE SCREEN</div>
                    <div class="mgmt_lnk_btn" onclick="applyUpdate(this);" avreqid="blackscrn">ACTIVATE BLACK SCREEN</div>

        <?php

            break;
            case '0':
            case '3':

                ?>
                    <div class="admin_section_title">Manage Full Screen Overlay</div>
                    <div class="mgmt_lnk_btn" onclick="applyUpdate(this);" avreqid="showovrly_fullscrn">SHOW OVERLAY</div>


                <div class="cb_30"></div>
                <div class="admin_section_title">Solid Color Controls</div>
                <div class="mgmt_lnk_btn" onclick="applyUpdate(this);" avreqid="bluescrn">ACTIVATE BLUE SCREEN</div>
                <div class="mgmt_lnk_btn" onclick="applyUpdate(this);" avreqid="whitescrn">ACTIVATE WHITE SCREEN</div>
                <div class="mgmt_lnk_btn" onclick="applyUpdate(this);" avreqid="blackscrn">ACTIVATE BLACK SCREEN</div>
                <?php

            break;
            default:

                ?>

                <div class="admin_section_title">Manage Full Screen Overlay</div>
                <div class="mgmt_lnk_btn" onclick="applyUpdate(this);" avreqid="hideovrly_fullscrn">HIDE OVERLAY</div>

                <div class="cb_30"></div>
                <div class="admin_section_title">Solid Color Controls</div>
                <div class="mgmt_lnk_btn" onclick="applyUpdate(this);" avreqid="bluescrn">ACTIVATE BLUE SCREEN</div>
                <div class="mgmt_lnk_btn" onclick="applyUpdate(this);" avreqid="whitescrn">ACTIVATE WHITE SCREEN</div>
                <div class="mgmt_lnk_btn" onclick="applyUpdate(this);" avreqid="blackscrn">ACTIVATE BLACK SCREEN</div>

                <?php
            break;


        }

        ?>

        <div id="ajax_root" class="hidden"><?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?></div>
        <div id="script_popup_lock" class="hidden">OFF</div>
        <div class="cb_30"></div>
    </div>
</body>
</html>