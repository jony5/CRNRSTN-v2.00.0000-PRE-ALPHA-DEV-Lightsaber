<?php
/*
// 5 ::
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');

//
// INITIALIZE WEB PAGE
// HTTP/S AND DIRECTORY
// PATH ROOTS.
//
// Saturday, June 8, 2024 @ 1440 hrs.
$tmp_root_path = $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR');
$tmp_http_root = $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');

if($oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_GET)){

    $tmp_demo = $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'demo');

    $tmp_body_style = "background-image: url('" . $tmp_http_root . "common/imgs/overlay_OBS_demo_bg2.png');";

}

$oLogger = new crnrstn_logging();

//
// RETRIEVE OVERLAY STATE FROM DB
// DATABASE REQUEST/RESPONSE PROCESSING
$tmp_serial_handle = 'OVERLAY_DATUM';
$oDB_RESP = $oUSER->getOverlayStateDatum($tmp_serial_handle);


error_log('26 - resp processed...');
/*
# STAGE DYNAMIC VARS FOR HTML/CSS INSERTION
// MINI
$tmp_mini_profile_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial('OVERLAY_DATUM'), 'OVERLAY_MGMT', 'MINI_PROFILE_ID');
$tmp_fullscrn_profile_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial('OVERLAY_DATUM'), 'OVERLAY_MGMT', 'FULLSCREEN_PROFILE_ID');

$tmp_mini_state = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'MINI_STATE');
$tmp_fullscreen_state = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'FULLSCREEN_STATE');
$tmp_modifier_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'MODIFIER_ID');

if($tmp_fullscreen_state=='0' || $tmp_fullscreen_state=='3'){

    $tmp_full_init_display = 'display:none;';
    $tmp_full_init_display = 'opacity: 0.0';
}else{

    $tmp_full_init_display = NULL;
}


if($tmp_mini_state=='0' || $tmp_mini_state=='3' || $tmp_mini_state=='2'){

    $tmp_mini_init_display = 'display:none;';
    $tmp_mini_init_display = 'opacity: 0.0';
}else{

    $tmp_mini_init_display = NULL;
}

$tmp_mini_bgcolor = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_CONFIG', 'HEXCOLOR');
$tmp_mini_opacity = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_CONFIG', 'OPACITY');

$tmp_fullscrn_bgcolor = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'HEXCOLOR');
$tmp_fullscrn_opacity = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'OPACITY');
$tmp_fullscrn_width = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'DEFAULT_WIDTH');
$tmp_fullscrn_height = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'DEFAULT_HEIGHT');



$tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE_ID');
for($i=0; $i<$tmp_loop_size; $i++){
    $tmp_profile_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE_ID', 'PROFILE_ID', $i);

    if($tmp_mini_profile_id==$tmp_profile_id){

        //
        // LOAD PARAMS FROM THIS PROFILE
        $tmp_mini_message_title = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE_ID', 'MESSAGE_TITLE_BLOB', $i);
        $tmp_mini_message_number = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE_ID', 'MESSAGE_NUMBER_BLOB', $i);
        $tmp_mini_message_speaker = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE_ID', 'MESSAGE_SPEAKER_BLOB', $i);
        $tmp_mini_conference_title = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE_ID', 'CONFERENCE_TITLE_BLOB', $i);

        $tmp_mini_width = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE_ID', 'OVERLAY_WIDTH', $i);
        $tmp_mini_height = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE_ID', 'OVERLAY_HEIGHT', $i);
        $tmp_mini_content_width = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE_ID', 'INNER_CONTENT_WIDTH', $i);
        $tmp_mini_margin_left = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE_ID', 'MARGIN_LEFT', $i);
        $tmp_mini_margin_right = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE_ID', 'MARGIN_RIGHT', $i);
        $tmp_mini_top = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE_ID', 'ABS_PX_FROM_TOP', $i);
        $tmp_mini_left = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE_ID', 'ABS_PX_FROM_LEFT', $i);
    }
}


$tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PROFILE_ID');
for($i=0; $i<$tmp_loop_size; $i++){
    $tmp_profile_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PROFILE_ID', 'PROFILE_ID', $i);

    if($tmp_fullscrn_profile_id==$tmp_profile_id){

        $tmp_full_profile_name = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PROFILE_ID', 'PROFILE_NAME', $i);
        $tmp_full_page_header = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PROFILE_ID', 'PAGE_HEADER', $i);
        $tmp_full_page_title = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PROFILE_ID', 'PAGE_TITLE', $i);
        $tmp_full_page_code = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PROFILE_ID', 'PAGE_CODE_BLOB', $i);

    }

}
*/

if($oCRNRSTN_ENV->getEnvParam('SSL_ENABLED')){

    //
    // SSL_ENABLED - FORCE SSL


}else{

    //
    // NO SSL_ENABLED - NO SSL ALLOWED
    if(is_ssl()){

        //
        // REDIRECT HTTPS TO HTTP
        header("Location: ".$tmp_http_root."/social/fellowship/avsvc_overlay/");
       // die();

    }

}

// SOURCE :: https://stackoverflow.com/questions/7304182/detecting-ssl-with-php
// FROM WordPress tho
function is_ssl(){

    if(isset($_SERVER['HTTPS'])){
        if('on' == strtolower($_SERVER['HTTPS']))
            return true;
        if('1' == $_SERVER['HTTPS'])
            return true;
    }elseif(isset($_SERVER['SERVER_PORT']) && ( '443' == $_SERVER['SERVER_PORT'])){

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
    <script type="text/javascript" language="javascript" src="<?php echo $tmp_http_root; ?>common/js/lib/frameworks/prototype/1.7.3/prototype.js" ></script>
    <script type="text/javascript" language="javascript" src="<?php echo $tmp_http_root; ?>common/js/lib/frameworks/scriptaculous/1.9.0/scriptaculous.js" ></script>
    <script type="text/javascript" language="javascript" src="<?php echo $tmp_http_root; ?>common/js/seblend/form.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo $tmp_http_root; ?>common/js/seblend/overlay_ctrl.js"></script>

    <style>
        *									{ border:0; padding:0; margin:0; }   /*font-family:Arial, Helvetica, sans-serif;*/
        body 								{ background-color: transparent; padding:0; margin:0; font: medium "Lucida Grande", "Lucida Sans Unicode", Verdana, sans-serif;} /*width:620px;*/
        p									{ padding-top:5px; padding-bottom:5px; font-size:16px; line-height:23px;}
        blockquote							{ padding-left:15px; font-size:13px;}
        li									{ margin-left:20px;}
        a                                   { color:#0066CC;}

        <?php
         $tmp_copy_leader_space = 300;
         $tmp_mini_content_width = 390;
         $tmp_mini_width = 490;
         $tmp_mini_margin_right = 0;
         ?>

        .main_overlay_handle                { opacity: 0.0;}
        .mini_overlay_handle                { position:absolute; top:<?php echo '650';  ?>px; left:<?php echo '-80'; ?>px;}

        .seblend_overlay_wrapper            { width:<?php echo '4000'; ?>px; height:<?php echo '4000'; ?>px; background-color: <?php echo '#FFFFFF'; ?>; opacity: <?php echo '0.9'; ?>; position: absolute;  text-align: center; margin:0px auto; z-index: 5;}
        .seblend_mini_overlay_wrapper       { width:<?php echo '490'; ?>px; height:<?php echo '60';  ?>px; background-color: <?php echo '#FFFFFF'; ?>; opacity: <?php echo '1.0'; ?>; position: absolute; z-index: 2; border:3px solid #666666; border-left:0; }

        .seblend_overlay_content_wrapper    {  position: absolute; width:100%; text-align: center; margin:0px auto; z-index: 6;}
        .seblend_minioverlay_content_wrapper    { width:<?php echo '390'; ?>px; height:70px; padding-top: 13px; padding-left:10px; padding-right: 0px; margin-left:<?php echo '90'; ?>px; margin-right:<?php echo '0'; ?>px; color:#000; position: absolute; overflow:hidden; }
        .scroll_extension_ui_mitigator        { float: left; left:130px; width:<?php echo '355'; ?>px; height:50px;  position:absolute; overflow: hidden;}

        .left_copy_fade                     { position: absolute; z-index:11; float:left; width:33px; height:50px; padding-left: 200px; padding-top: 13px; overflow:hidden;}
        .right_copy_fade                    { position: absolute; float:left; z-index:17; width:33px; height:50px; padding-left: 465px; padding-top: 13px; overflow:hidden;} /*padding-left:359px*/
        .mini_content_wrapper_scroll_content  { position:absolute; float:left; width:7500px; height:50px; text-align: left; padding-left:<?php echo '300'; ?>px; z-index:10; }

        /*avoverlay_fade_left*/
        .overlay_content_shell              { width:100%; text-align: center; margin: 0px auto;}
        .overlay_content                    { position: absolute; text-align: left; width: 700px;}

        .main_copy_header                   { text-align: center; }
        .main_document_title                { text-align: center;}

        .schedule_day_title                 { padding:20px 0 20px 0; font-weight: bold;}
        .schedule_element_wrapper           { padding:0px 0 8px 0;}
        .schedule_element_time              { float: left; padding:0 0px 0 30px; width:125px;}
        .schedule_element_activity          { float: left;}

        .message_title                      { float: left; font-size:19px; color:#000; padding-right:30px; }
        .message_meta                       { float: left; font-weight: bold; font-size:19px; color:#1A182D; padding-right:30px; }
        .conference_title                   { float: left; font-weight: bold; font-size:19px; color:#1A182D; padding-right:30px; }
        .lang_pack_buffer                   { float: left; font-weight: bold; font-size:19px; color:#FFF; padding-top: 10px; padding-right:60px; }
        .message_time                       { float: left; font-weight: bold; font-size:26px; color:#1A182D; padding-top: 8px; position:absolute; z-index: 12;}

        #message_time_wrapper               { }

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

<body id="body_handle">
   <div id="main_overlay_handle" class="main_overlay_handle">
        <div class="seblend_overlay_wrapper"></div>
        <div class="seblend_overlay_content_wrapper">
            <div id="overlay_content_shell" class="overlay_content_shell">
                <div id="overlay_content" class="overlay_content">
                    <!-- <div class="cb_20"></div>
                    <div id="fullscrn_page_header" class="main_copy_header">
                        <h3>[tmp_full_page_header]</h3>
                    </div>
                    <div class="cb_30"></div>
                    <div id="fullscrn_document_title"  class="main_document_title"><h1>[tmp_full_page_title]</h1></div>
                    <div class="cb_15"></div>

                    <div id="fullscrn_page_code">[tmp_full_page_code]</div> -->
                </div>
            </div>
        </div>
   </div>

   <div id="mini_overlay_handle" class="mini_overlay_handle">
       <div id="seblend_mini_overlay_wrapper" class="seblend_mini_overlay_wrapper"></div>
       <div id="right_gate_fade" class="right_copy_fade"><img src="<?php echo $tmp_http_root; ?>common/imgs/avoverlay_fade_29_right.png" width="33" height="50" border="0" alt="fade" title="fade"></div>
       <div id="left_gate_fade" class="left_copy_fade"><img src="<?php echo $tmp_http_root; ?>common/imgs/avoverlay_fade_29_left.png" width="33" height="50" border="0" alt="fade" title="fade"></div>
       <div id="seblend_minioverlay_content_wrapper" class="seblend_minioverlay_content_wrapper">
           <div id="message_time_wrapper" class="message_time">0:00:00</div>
           <div id="scroll_extension_ui_mitigator" class="scroll_extension_ui_mitigator">
               <div id="scroll_handle"  class="mini_content_wrapper_scroll_content">
                    <!--
                    <div id="msg_title" class="message_title">title</div>
                    <div class="message_meta">Message <span id="msg_num">message</span></div>
                    <div id="conf_title" class="conference_title">conference</div>
                   <div id="conference_date" class="conference_title">date</div> -->

               </div>
           </div>
           <div class="cb"></div>
        </div>
   </div>

   <div id="mini_state" class="hidden">hideovrly_rt</div>
   <div id="full_state" class="hidden"></div>
   <div id="mod_id" class="hidden"></div>
   <div id="mini_opacity" class="hidden"></div>
   <div id="fullscreen_opacity" class="hidden"></div>
   <div id="mini_bgcolor" class="hidden"></div>
   <div id="fullscreen_bgcolor" class="hidden"></div>
   <div id="message_time_burnout" class="hidden"></div>
   <div id="script_popup_lock" class="hidden">OFF</div>
   <div id="lang_pack_rotate_lock" class="hidden">ON</div>

   <div id="overlay_dyn_flags_container">


   </div>

   <div id="timer_lck" class="hidden">OFF</div>
   <div id="cache_bust" class="hidden"><?php echo $oUSER->generateNewKey(25); ?></div>
   <div id="timer_UI_update_lck" class="hidden" >OFF</div>
   <div id="mini_UI_update_lck" class="hidden" >OFF</div>
   <div id="show_fullscrn_lck" class="hidden" >OFF</div>
   <div id="hide_fullscrn_lck" class="hidden" >OFF</div>
   <div id="demo_bg_img" class="hidden"><?php echo $tmp_body_style; ?></div>

   <div id="test_mode" class="cb"></div>
   <div id="sid" class="hidden"><?php echo session_id(); ?></div>
   <div id="ajax_root" class="hidden"><?php echo $tmp_http_root; ?></div>
   <div id="mov" class="hidden" >false</div>
   <div id="tov" class="hidden" >true</div>
   <div id="cov" class="hidden" >true</div>
   <div id="full_mov" class="hidden" >true</div>
   <div id="full_cov" class="hidden" >false</div>
   <div id="ui_retardation_handle" class="hidden"></div>
   <div id="full_ui_retardation_handle" class="hidden"></div>
</body>
</html>