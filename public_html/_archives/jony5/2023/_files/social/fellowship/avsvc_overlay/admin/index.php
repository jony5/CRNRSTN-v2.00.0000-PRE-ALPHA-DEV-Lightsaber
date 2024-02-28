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

$tmp_active_mini_profile_name = '';
$tmp_active_full_profile_name = '';
$tmp_HTML_mini_output = '';
$tmp_HTML_full_output = '';

$tmp_mini_profile_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial('OVERLAY_DATUM'), 'OVERLAY_MGMT', 'MINI_PROFILE_ID');
$tmp_fullscrn_profile_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial('OVERLAY_DATUM'), 'OVERLAY_MGMT', 'FULLSCREEN_PROFILE_ID');

$tmp_mini_state = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'MINI_STATE');
$tmp_fullscreen_state = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'FULLSCREEN_STATE');
$tmp_modifier_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'MODIFIER_ID');

$tmp_mini_bgcolor = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_CONFIG', 'HEXCOLOR');
$tmp_mini_opacity = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_CONFIG', 'OPACITY');

$tmp_fullscrn_bgcolor = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'HEXCOLOR');
$tmp_fullscrn_opacity = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'OPACITY');
$tmp_fullscrn_width = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'DEFAULT_WIDTH');
$tmp_fullscrn_height = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'DEFAULT_HEIGHT');


$tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PROFILE');
for($i=0; $i<$tmp_loop_size; $i++){
    $tmp_profile_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PROFILE', 'PROFILE_ID', $i);

    if($tmp_fullscrn_profile_id==$tmp_profile_id){

        $tmp_full_profile_name = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PROFILE', 'PROFILE_NAME', $i);
        $tmp_full_page_header = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PROFILE', 'PAGE_HEADER', $i);
        $tmp_full_page_title = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PROFILE', 'PAGE_TITLE', $i);
        $tmp_full_page_code = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PROFILE', 'PAGE_CODE_BLOB', $i);

        //$tmp_mini_width = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'OVERLAY_WIDTH', $i);
        //$tmp_mini_height = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'OVERLAY_HEIGHT', $i);
        //$tmp_mini_content_width = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'INNER_CONTENT_WIDTH', $i);
        //$tmp_mini_margin_left = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'MARGIN_LEFT', $i);
        //$tmp_mini_margin_right = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'MARGIN_RIGHT', $i);
        //$tmp_mini_top = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'ABS_PX_FROM_TOP', $i);
        //$tmp_mini_left = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'ABS_PX_FROM_LEFT', $i);

        $tmp_profile_state = 'active';
    }else{

        $tmp_profile_state = "";

        $tmp_full_profile_name = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PROFILE', 'PROFILE_NAME', $i);
        $tmp_full_page_header = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PROFILE', 'PAGE_HEADER', $i);
        $tmp_full_page_title = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PROFILE', 'PAGE_TITLE', $i);
        $tmp_full_page_code = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PROFILE', 'PAGE_CODE_BLOB', $i);


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

    switch($tmp_profile_state){
        case 'active':
            $tmp_active_full_profile_name = $tmp_full_profile_name;
            $tmp_HTML_full_output .= '
            <div class="sub_sub_section_elem_wrapper">
                <div class="sub_sect_elem"><div class="super_able_elem">'.$tmp_full_profile_name.'</div><div class="state_superscript">ACTIVE</div></div>
                <div class="sub_sect_elem_admin_lnk"><a href="#" target="_blank">view</a></div>
                <div class="sub_sect_elem_admin_lnk"><a href="#" target="_blank">edit</a></div>
                <div class="sub_sect_elem_mod" style="padding-left: 90px;">last modified '.$oUSER->processPrettyDate($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PROFILE', 'DATEMODIFIED', $i), date("m/d/Y \a\\t hi", strtotime($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PROFILE', 'DATEMODIFIED', $i))), "N/A" ).'hrs</div>
                <div class="cb"></div>
            </div>
            ';

            break;
        default:

            $tmp_HTML_full_output .= '
            <div class="sub_sub_section_elem_wrapper">
                <div class="sub_sect_elem"><div class="super_able_elem">'.$tmp_full_profile_name.'</div><div class="state_superscript"></div></div>
                <div class="sub_sect_elem_admin_lnk"><a href="#" target="_blank">view</a></div>
                <div class="sub_sect_elem_admin_lnk"><a href="#" target="_blank">edit</a></div>
                <div class="sub_sect_elem_admin_lnk"><a href="'.$oUSER->getEnvParam("ROOT_PATH_CLIENT_HTTP").$oUSER->getEnvParam("ROOT_PATH_CLIENT_HTTP_DIR").'social/fellowship/avsvc_overlay/admin/management/fullscreen/activate/?avreqid=activate_full_profile&pid='.$tmp_profile_id.'&name='.urlencode($tmp_full_profile_name).'" target="_self">activate</a></div>
                <div class="sub_sect_elem_mod">last modified '.$oUSER->processPrettyDate($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PROFILE', 'DATEMODIFIED', $i), date("m/d/Y \a\\t hi", strtotime($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PROFILE', 'DATEMODIFIED', $i))), "N/A" ).'hrs</div>
                <div class="cb"></div>
            </div>';

            break;
    }
}



$tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE');
for($i=0; $i<$tmp_loop_size; $i++){
    $tmp_profile_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'PROFILE_ID', $i);

    if($tmp_mini_profile_id==$tmp_profile_id){

        $tmp_mini_profile_name = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'PROFILE_NAME', $i);
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


        $tmp_mini_profile_name = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'PROFILE_NAME', $i);
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

    switch($tmp_profile_state){
        case 'active':
            $tmp_active_mini_profile_name = $tmp_mini_profile_name;
            $tmp_HTML_mini_output .= '
            <div class="sub_sub_section_elem_wrapper">
                <div class="sub_sect_elem"><div class="super_able_elem">'.$tmp_mini_profile_name.'</div><div class="state_superscript">ACTIVE</div></div>
                <div class="sub_sect_elem_admin_lnk"><a href="#" target="_blank">view</a></div>
                <div class="sub_sect_elem_admin_lnk"><a href="#" target="_blank">edit</a></div>
                <div class="sub_sect_elem_mod" style="padding-left: 90px;">last modified '.$oUSER->processPrettyDate($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'DATEMODIFIED', $i), date("m/d/Y \a\\t hi", strtotime($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'DATEMODIFIED', $i))), "N/A" ).'hrs</div>
                <div class="cb"></div>
            </div>
            ';

        break;
        default:

            $tmp_HTML_mini_output .= '
            <div class="sub_sub_section_elem_wrapper">
                <div class="sub_sect_elem"><div class="super_able_elem">'.$tmp_mini_profile_name.'</div><div class="state_superscript"></div></div>
                <div class="sub_sect_elem_admin_lnk"><a href="#" target="_blank">view</a></div>
                <div class="sub_sect_elem_admin_lnk"><a href="#" target="_blank">edit</a></div>
                <div class="sub_sect_elem_admin_lnk"><a href="'.$oUSER->getEnvParam("ROOT_PATH_CLIENT_HTTP").$oUSER->getEnvParam("ROOT_PATH_CLIENT_HTTP_DIR").'social/fellowship/avsvc_overlay/admin/management/mini/activate/?avreqid=activate_mini_profile&pid='.$tmp_profile_id.'&name='.urlencode($tmp_mini_profile_name).'" target="_self">activate</a></div>
                <div class="sub_sect_elem_mod">last modified '.$oUSER->processPrettyDate($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'DATEMODIFIED', $i), date("m/d/Y \a\\t hi", strtotime($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'DATEMODIFIED', $i))), "N/A" ).'hrs</div>
                <div class="cb"></div>
            </div>';

        break;
    }
}

//
// VIEW STATE UI - MAIN
if($oDB_RESP->return_data_element($oDB_RESP->return_serial('OVERLAY_DATUM'), 'OVERLAY_MGMT', 'FULLSCREEN_STATE')=='1' || $oDB_RESP->return_data_element($oDB_RESP->return_serial('OVERLAY_DATUM'), 'OVERLAY_MGMT', 'FULLSCREEN_STATE')=='5'){
    $tmp_fullscreen_state = 'sub_sect_elem_state sel';
    $tmp_state[0] = 'VISIBLE';
    $tmp_full_live = 'LIVE';

}else{

    $tmp_fullscreen_state = 'sub_sect_elem_state';
    $tmp_state[0] = 'HIDDEN';
    $tmp_full_live = '';
}

//
// VIEW STATE UI - MINI
if($oDB_RESP->return_data_element($oDB_RESP->return_serial('OVERLAY_DATUM'), 'OVERLAY_MGMT', 'MINI_STATE')=='1' || $oDB_RESP->return_data_element($oDB_RESP->return_serial('OVERLAY_DATUM'), 'OVERLAY_MGMT', 'MINI_STATE')=='5' ){

    $tmp_mini_state = 'sub_sect_elem_state sel';
    $tmp_state[1] = 'VISIBLE';
    $tmp_mini_live = 'LIVE';

}else{

    $tmp_mini_state = 'sub_sect_elem_state';
    $tmp_state[1] = 'HIDDEN';
    $tmp_mini_live = '';
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

        <div class="admin_section_title">Current State &nbsp;&nbsp;&nbsp;<span class="admin_lnk"><a href="#" target="_blank">view</a></span></div>

        <div class="sub_section_elem_wrapper">
            <div class="sub_sect_elem">Full Screen Overlay Status</div>
            <div class="<?php echo $tmp_fullscreen_state; ?>"><?php echo $tmp_state[0]; ?></div>
            <div class="cb"></div>
        </div>
        <div class="sub_section_elem_wrapper">
            <div class="sub_sect_elem">Mini Overlay Status</div>
            <div class="<?php echo $tmp_mini_state; ?>"><?php echo $tmp_state[1]; ?></div>
            <div class="cb"></div>
        </div>


        <div class="admin_section_title">Manage State</div>

        <div class="sub_section_elem_wrapper">
            <div class="sub_sect_elem"><div class="super_able_elem">Full Screen Overlay</div><div class="state_superscript"><?php echo $tmp_full_live; ?></div></div>
            <div class="sub_sect_elem_admin_lnk"><a href="#" target="_blank">view</a></div>
            <div class="sub_sect_elem_admin_lnk" style="width:70px;"><a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>social/fellowship/avsvc_overlay/admin/management/fullscreen/manage/edit/" target="_self">manage</a></div>
            <div class="sub_sect_elem_mod">:: <span class="elem_curr_profile"><?php echo $tmp_active_full_profile_name;  ?></span></div>
            <div class="cb"></div>
        </div>

        <div class="sub_section_elem_wrapper">
            <div class="sub_sect_elem"><div class="super_able_elem">Mini Overlay</div><div class="state_superscript"><?php echo $tmp_mini_live; ?></div></div>
            <div class="sub_sect_elem_admin_lnk"><a href="#" target="_blank">view</a></div>
            <div class="sub_sect_elem_admin_lnk" style="width:70px;"><a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>social/fellowship/avsvc_overlay/admin/management/mini/manage/edit/" target="_self">manage</a></div>
            <div class="sub_sect_elem_mod">:: <span class=" class="elem_curr_profile""><?php echo $tmp_active_mini_profile_name; ?></span></div>
            <div class="cb"></div>
        </div>

        <div class="admin_section_title">Saved Profiles</div>

        <div class="sub_section_elem_wrapper">
            <div class="sub_sect_profile_elem"><div class="super_able_elem">Full Screen Overlay</div><div class="state_superscript"><?php echo $tmp_full_live; ?></div></div>
            <div class="sub_sect_elem_admin_lnk"><a href="./management/fullscreen/new/" target="_self">new</a></div>
            <div class="sub_sect_elem_mod"></div>
            <div class="cb"></div>
        </div>

        <?php echo $tmp_HTML_full_output;  ?>

        <div class="cb_10"></div>
        <div class="sub_section_elem_wrapper">
            <div class="sub_sect_profile_elem"><div class="super_able_elem">Mini Overlay</div><div class="state_superscript"><?php echo $tmp_mini_live; ?></div></div>
            <div class="sub_sect_elem_admin_lnk"><a href="./management/mini/new/" target="_self">new</a></div>
            <div class="sub_sect_elem_mod"></div>
            <div class="cb"></div>
        </div>

        <?php echo $tmp_HTML_mini_output;  ?>

    </div>
</body>
</html>