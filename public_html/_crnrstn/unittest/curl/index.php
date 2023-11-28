<?php
/**
* @package CRNRSTN

// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

echo '[lnum ' . __LINE__ . ']  die();';
die();

//
// INITIALIZATION
$tmp_received_POST_data = false;
$tmp_crnrstn_curl_uri_endpoint = '';
$tmp_crnrstn_curl_batch_save = '';
$tmp_crnrstn_curl_batch_preview = '';
$tmp_crnrstn_curl_batch_count = 0;
$tmp_batch_preview_cnt = 0;

$tmp_crnrstn_curl_enable_unit_test_automation = '';
$tmp_crnrstn_curl_unit_test_automation_freq_secs = '';

$automation_frequency_secs_value_ARRAY = array(5, 10, 20, 30, 40, 50, 60, 120, 240, 300);
$automation_frequency_title_value_ARRAY = array('Every 5 seconds', 'Every 10 seconds', 'Every 20 seconds', 'Every 30 seconds', 'Every 40 seconds', 'Every 50 seconds', 'Every 60 seconds', 'Every 2 minutes', 'Every 4 minutes', 'Every 5 minutes');

//
// TEST ENCRYPTION OUTPUT PERFORMANCE OF THE RECEIVED OPENSSL PROFILE
$oCRNRSTN_UNITTEST_MGR = new crnrstn_unit_test_manager($oCRNRSTN);

//error_log('28 curl index die() crc32(\'Subliminal\')=' . $oCRNRSTN->crcINT('Subliminal'));  //  07/05/2022 @ 1537hrs
//error_log('29 curl index die() ID=[' . $oCRNRSTN->generate_new_key(64) . ']');
//die();
//
// ENABLE THIS PAGE TO RECEIVE HTTP POST/GET DATA
if($oCRNRSTN->receive_form_integration_packet()){

    if($oCRNRSTN->isvalid_data_validation_check('POST')){

        $tmp_received_POST_data =  true;

        //
        // PREPARE RECEIVED INPUT PARAMETERS FOR DATABASE QUERY
        $tmp_crnrstn_curl_uri_endpoint = $oCRNRSTN->return_form_submitted_value('crnrstn_curl_uri_endpoint');
        $tmp_crnrstn_curl_batch_save = $oCRNRSTN->return_form_submitted_value('crnrstn_curl_batch_save');
        $tmp_crnrstn_curl_batch_count = $oCRNRSTN->return_form_submitted_value('crnrstn_curl_batch_count');

        $tmp_crnrstn_curl_enable_unit_test_automation = $oCRNRSTN->return_form_submitted_value('crnrstn_curl_enable_unit_test_automation');
        $tmp_crnrstn_curl_unit_test_automation_freq_secs = $oCRNRSTN->return_form_submitted_value('crnrstn_curl_unit_test_automation_freq_secs');

        if(strlen($tmp_crnrstn_curl_uri_endpoint) > 0){

            $oCRNRSTN_UNITTEST_MGR->configure_unit_test('curl', $tmp_crnrstn_curl_uri_endpoint, $tmp_crnrstn_curl_batch_count);
            $oCRNRSTN_UNITTEST_MGR->execute_unit_test();

            //
            // ADD TO BATCH PREVIEW WINDOW?
            if($tmp_crnrstn_curl_batch_save == "batch_save") {

                $tmp_crnrstn_curl_batch_save = "checked";

            }

            $tmp_crnrstn_curl_batch_preview .= '<div class="crnrstn_log_entry">[rtime ' . $oCRNRSTN_UNITTEST_MGR->rtime('curl', md5($tmp_crnrstn_curl_uri_endpoint)).'] ' .  $tmp_crnrstn_curl_uri_endpoint . '</div>

            <input type="hidden" name="crnrstn_curl_batch_uri_' . $tmp_batch_preview_cnt . '" value="' .  $tmp_crnrstn_curl_uri_endpoint . '">';

            $oCRNRSTN->form_input_add('curl', 'crnrstn_curl_batch_uri_' . $tmp_batch_preview_cnt);

            $tmp_batch_preview_cnt++;

            if($tmp_crnrstn_curl_batch_count > 0){

                for($i = 0; $i < $tmp_crnrstn_curl_batch_count; $i++){

                    $tmp_crnrstn_curl_uri_endpoint = $oCRNRSTN->return_form_submitted_value('crnrstn_curl_batch_uri_' . $i);

                    $tmp_crnrstn_curl_batch_preview .= '<div class="crnrstn_log_entry">[rtime ' . $oCRNRSTN_UNITTEST_MGR->rtime('curl', md5($tmp_crnrstn_curl_uri_endpoint)).'] ' .  $tmp_crnrstn_curl_uri_endpoint . '</div>

                    <input type="hidden" name="crnrstn_curl_batch_uri_' . $tmp_batch_preview_cnt . '" value="' .  $tmp_crnrstn_curl_uri_endpoint . '">';

                    $oCRNRSTN->form_input_add('curl', 'crnrstn_curl_batch_uri_' . $tmp_batch_preview_cnt);

                    $tmp_batch_preview_cnt++;

                }

            }

        }

        $oCRNRSTN->form_hidden_input_add('curl', 'crnrstn_curl_batch_count', true, $tmp_batch_preview_cnt);

        if($tmp_crnrstn_curl_enable_unit_test_automation == "automation_on"){

            $tmp_crnrstn_curl_enable_unit_test_automation = "checked";

        }else{

            $tmp_crnrstn_curl_enable_unit_test_automation = "";

        }

    }else{

        //
        // FORM INPUT ERROR HANDLING. CAN MANUALLY HANDLE REDIRECTS HERE IF DESIRED.
        $tmp_err_array = $oCRNRSTN->return_err_data_validation_check('POST');
        $test = '';

        foreach($tmp_err_array as $key=>$val){

            $test .= $val.'<br>';

        }

    }

}

$tmp_form_serial = $oCRNRSTN->generate_new_key(5);
$tmp_http_root = $oCRNRSTN->current_location();

//
// THESE ARE THE INPUT FIELDS TO WHICH WE WILL LOOK
# THESE FIELDS ARE NOT HIDDEN. THEY WILL NOT/CANNOT BE
# ENCRYPTED INITIALLY.
# $this->oCRNRSTN_USR->form_input_add({crnrstn_pssdtl_packet}, {HTML_DOM_FORM_INPUT_NAME}}, {IS_REQUIRED});
$oCRNRSTN->form_input_add('curl', 'crnrstn_curl_uri_endpoint');
$oCRNRSTN->form_input_add('curl', 'crnrstn_curl_batch_save');
$oCRNRSTN->form_input_add('curl', 'crnrstn_curl_batch_count');
$oCRNRSTN->form_input_add('curl', 'crnrstn_curl_enable_unit_test_automation');
$oCRNRSTN->form_input_add('curl', 'crnrstn_curl_unit_test_automation_freq_secs');

?>
<!DOCTYPE html>
<html lang="<?php echo $oCRNRSTN->iso_language_profile(); ?>">
<head>
<title>CRNRSTN :: <?php echo $oCRNRSTN->version_crnrstn(); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php echo $oCRNRSTN->return_creative('CRNRSTN_FAVICON'); ?>
<?php echo $oCRNRSTN->ui_content_module_out(CRNRSTN_JS_FRAMEWORK_JQUERY) .
    $oCRNRSTN->ui_content_module_out(CRNRSTN_JS_FRAMEWORK_JQUERY_UI).
    $oCRNRSTN->ui_content_module_out(CRNRSTN_CSS_MAIN_DESKTOP & CRNRSTN_JS_MAIN); ?>
<style>
    *                                           {}
    .the_R_in_crnrstn                           { color:#F90000; }
    .crnrstn_j5_wolf_pup_outter_wrap            { float:right; padding:420px 0 0 0; margin:0; width:100%;}
    .crnrstn_j5_wolf_pup_inner_wrap             { position: absolute; width:98%; z-index: 2; text-align: right; padding-top: 20px;}
    .crnrstn_signin_copyright_shell             { width:578px; text-align: center; margin:0 auto; font-size: 12px; line-height: 18px; color: #666;}
    .crnrstn_signin_copyright_shell a           { text-decoration:none; color: #0066CC; text-decoration:underline;}

    /*PAGE*/
    .crnrstn_page_subtitle                      { font-weight: bold; font-size: 20px; padding: 10px 0 10px 0; }

    /*DGF*/
    .crnrstn_field_input_title                  { font-size:16px; }
    .crnrstn_input_title_lnk_expand_wrapper     { float: right; }
    .crnrstn_input_title_lnk_expand             {color: #0066CC; cursor: pointer; font-weight: bold; font-size: 12px; padding:3px 0 0 20px;}
    .crnrstn_field_input_wrapper input          { font-size:13px; height:25px; /*width:500px;*/ margin: 3px 0 0 0; padding:3px 5px 3px 5px; }
    .crnrstn_field_input_wrapper select         { font-size:13px; height:25px; margin: 3px 0 0 0; }
    .crnrstn_field_input_wrapper textarea       { font-size:13px; height:75px; width:500px; margin: 3px 0 0 0; padding:3px 5px 3px 5px; }

    /*RESULT SET*/
    #script_shell0                      { width:100%; text-align:center; margin:0px auto;}
    #script_shell1                      { width:1200px; text-align:center; margin:0px auto;}
    #script_popup_wrapper               { position:relative;}
    #script_popup                       { position: absolute; z-index: 36; left:180px; width:760px;}

    #script_wrapper                     { border: 1px solid #000; background-color: #FFF; padding:0px; margin:0px auto; width:670px;float:left;}
    #script_vnav_wrapper                { width:100%; clear:both; border-bottom:1px solid #CCC;}
    .script_vnav_link                   { font-size: 25px; font-weight:normal; float:left; padding:6px 8px 6px 8px; cursor: pointer;}
    .script_vnav_link.now               { color:#FFF; font-weight:bold; background-color: #F90000;}
    #script_footer_wrapper              { text-align:center; font-size: 13px; padding-bottom: 20px;}
    #script_loading_book_icon           { text-align: center; margin:0px auto;}
    #script_loading                     { text-align: center; margin:0px auto;padding:20px 0 25px 0;}
    #script_close                       { float:left; width:34px; padding:5px 8px 5px 0px; background-color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:25px; font-weight:bold; color:#FFF; border-top:2px solid #A60000; border-right:2px solid #A60000; border-bottom:2px solid #A60000; border-left:1px solid #A60000; cursor:pointer;}

    .script_vv_wrapper                  { width:95%; padding-top:20px; text-align: left; background-color:transparent;}
    .script_footnote_wrapper            { width:95%; text-align: left; background-color:transparent;}

    .script_book_title                  { font-size:25px; font-weight:bold; padding-left:25px; color:#584957;}
    .script_verse_wrapper               { padding-left:25px; line-height: 25px;}
    .script_verse_reference             { float:left; width:70px; padding-right:10px; font-size:20px;}
    .script_verse_copy                  { float:left; font-size: 17px; width:85%}
    .script_verse_copy em               { color:#696969; }

    .script_ftnt_title                  { font-size: 17px; font-weight:normal; padding-left:25px;}
    .script_ftnt_wrapper                { padding-left:25px; line-height: 20px;}
    .script_ftnt_reference              { float:left; width:70px; padding-right:10px; font-size:20px;}
    .script_ftnt_copy                   { float:left; font-size: 15px; width:75%}

    .script_lnk a                       { text-decoration:none;}
    .script_lnk                         { text-decoration:none;}
    .script_sup                         { vertical-align: super; font-size: 13px; line-height: 5px; color:#F90000; font-weight:bold;}
    .short_br                           { line-height: 2px; padding:0; margin:0; clear:both; overflow:hidden;}
    .script_ref_num                     { font-weight:bold;}
    .script_ref_num.hymn_stanza         { float: left;}
    .stanza_copy                        { float: left; padding-left: 10px; }
    .stanza_copy .chords                { font-weight: bold; font-size: 12px;}

    #script_scroll                      { overflow:scroll; max-height: 350px; /*border-bottom:2px solid #EBEBEB;*/ background-color:transparent; }
    .script_fade_shell0                 { position: relative;}
    .script_fade_bdr                    { position: absolute; height:7px; top:-7px; background-color: transparent; background-repeat: repeat-x; background-image: url("http://jony5.com/common/imgs/scriptures_fade_edge_grey.png"); width:100%; border-bottom:1px solid #666;}
    .content_copy h3                    { line-height: 26px; padding:20px 0 20px 0;}


    /*UTILITY*/
    .crnrstn_hidden                             { width:0; height:0; position:absolute; left:-2000px; overflow:hidden;}
    .crnrstn_cb                             { display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px;}
    .crnrstn_cb_3                               { display:block; clear:both; height:3px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_5	                      	{ display:block; clear:both; height:5px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_10	                      	{ display:block; clear:both; height:10px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_15	 							{ display:block; clear:both; height:15px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_20								{ display:block; clear:both; height:20px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_30								{ display:block; clear:both; height:30px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_40								{ display:block; clear:both; height:40px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_50	 							{ display:block; clear:both; height:50px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_75								{ display:block; clear:both; height:75px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_100 							{ display:block; clear:both; height:100px; line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_200				                { display:block; clear:both; height:200px; line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}

</style>
<?php
echo $oCRNRSTN_UNITTEST_MGR->return_automation_initialization('curl');
?>
</head>
<body>
<div id="crnrstn_curl_data_storage" style="font-family:Arial, Helvetica, sans-serif; padding:0 10px 10px 20px; width:810px;">

    <div style="font-weight: bold; font-size: 25px; padding: 10px 0 0 0;">C<span class="the_R_in_crnrstn">R</span>NRSTN :: CURL v7.58.0</div>
    <div class="crnrstn_cb"></div>
    <div style="font-size: 11px; font-weight: normal; padding: 5px 0 0 0; color: #9a9292;">
        <?php
        echo $oCRNRSTN->proper_version('LINUX') .
            ', ' . $oCRNRSTN->proper_version('APACHE') .
            ', ' . $oCRNRSTN->proper_version('MYSQLI') .
            ', ' . $oCRNRSTN->proper_version('PHP') .
            ', ' . $oCRNRSTN->proper_version('OPENSSL') .
            ', ' . $oCRNRSTN->proper_version('SOAP') .
            ', C<span class="the_R_in_crnrstn">R</span>NRSTN :: v' . $oCRNRSTN->version_crnrstn();  ?>
    </div>
    <div class="crnrstn_cb_15"></div>

    <form action="#" method="post" name="curl" id="curl"  enctype="multipart/form-data">

        <div style="width:100%;">

            <?php
            if(strlen($tmp_crnrstn_curl_uri_endpoint) > 0 || $tmp_crnrstn_curl_batch_count > 0){
            ?>

            <div class="crnrstn_activity_log crnrstn_log_output_wrapper" style="opacity: 1;">
                <div class="crnrstn_activity_log_output crnrstn_log_output">

                    <?php
                    echo $tmp_crnrstn_curl_batch_preview;
                    ?>

                </div>
            </div>

            <div class="crnrstn_cb_15"></div>

            <?php
            }
            ?>

            <div class="crnrstn_field_input_wrapper">
                <div style="width:100%;">
                    <div class="crnrstn_field_input_title">Endpoint URI</div>
                    <div class="crnrstn_cb"></div>
                    <div style="float: left;"><input type="text" name="crnrstn_curl_uri_endpoint" style="width:500px;" value="" placeholder="Enter URI"></div>
                    <div style="float: left; width: 20px; padding: 5px 0 0 20px;"><input type="checkbox" style="width: 20px;" name="crnrstn_curl_batch_save" value="batch_save" <?php echo $tmp_crnrstn_curl_batch_save;?>></div>
                    <div style="float: left; width: 110px; font-size: 12px; padding:13px 0 0 10px; cursor: pointer;" onclick="oCRNRSTN_JS.log_activity('[lnum 448] DOM click[' + this.innerHTML +  '] :: reporting for duty.', oCRNRSTN_JS.CRNRSTN_DEBUG_VERBOSE);"><?php echo $oCRNRSTN->multi_lang_content_return('CHKBX_TEXT_PROCESS_TO_BATCH'); ?></div>
                    <div class="crnrstn_cb"></div>
                </div>
                <div class="crnrstn_cb"></div>
            </div>

            <div class="crnrstn_cb_20"></div>

            <div class="crnrstn_field_input_wrapper">
                <div style="width:100%;">
                    <div style="float: left; padding-top: 10px;">
                        <input style="width:100px;" type="submit" value="<?php echo $oCRNRSTN->multi_lang_content_return('BUTTON_TEXT_SUBMIT'); ?>">
                        <div class="crnrstn_cb_10"></div>
                        <div style="float: left; width: 100px; font-size: 12px; font-style: italic; line-height: 17px; padding:0 0 0 0;">14 secs before next POST.<br> <a href="#" style="text-decoration: none; color:#0066CC; text-decoration:underline;">Cancel</a></div>
                    </div>
                    <div style="float: left; width: 420px; border:5px solid #FF0000; padding:20px 10px 20px 10px; margin-left: 20px;">
                        <div style="float: left; width: 20px; padding:0px 0 0 20px;"><input type="checkbox" style="width:20px;" name="crnrstn_curl_enable_unit_test_automation" value="automation_on" <?php echo $tmp_crnrstn_curl_enable_unit_test_automation; ?>></div>
                        <div style="float: left; width: 120px; font-size: 12px; padding:8px 0 0 10px;">Enable Automation</div>
                        <div style="float: left; width: 100px; font-size: 12px; padding:0 0 0 10px;">
                            <select name="crnrstn_curl_unit_test_automation_freq_secs">
                                <option value="">- Select Automation Frequency</option>

                                <?php
                                $tmp_cnt = count($automation_frequency_secs_value_ARRAY);
                                for($i = 0; $i < $tmp_cnt; $i++){

                                    $tmp_selected = '';
                                    if($automation_frequency_secs_value_ARRAY[$i] == $tmp_crnrstn_curl_unit_test_automation_freq_secs){

                                        $tmp_selected = 'selected';

                                    }else{

                                        echo '<!-- NO MATCH[' . $automation_frequency_secs_value_ARRAY[$i] . '|' . $tmp_crnrstn_curl_unit_test_automation_freq_secs . '] -->';

                                    }

                                    echo '<option value="' . $automation_frequency_secs_value_ARRAY[$i] . '" ' . $tmp_selected  . '>' . $automation_frequency_title_value_ARRAY[$i] . '</option>';

                                }

                                ?>

                            </select>
                        </div>

                        <div style="float: right; font-size: 12px; padding:0 0 0 10px;">
                            <div style="position:absolute; padding: 0 0 0 30px;">

                                <?php

                                echo $oCRNRSTN->return_branding_creative(true);

                                ?>

                            </div>
                        </div>

                        <div class="crnrstn_cb"></div>
                    </div>

                </div>

            </div>

        <div class="crnrstn_cb_15"></div>

        </div>
        <?php
        echo $oCRNRSTN->ui_content_module_out(CRNRSTN_UI_FORM_INTEGRATION_PACKET, 'curl');
        ?>
    </form>

    <?php
    if($oCRNRSTN_UNITTEST_MGR->isset_report('curl')){
    ?>

    <div class="crnrstn_cb"></div>
    <div class="crnrstn_page_subtitle">C<span class="the_R_in_crnrstn">R</span>NRSTN :: CURL Results RAW Output</div>

    <?php

    echo $oCRNRSTN_UNITTEST_MGR->return_report('curl', 'HTML_INJECTION');

    }

    ?>

    <div class="crnrstn_cb_20"></div>

    <div class="crnrstn_signin_copyright_shell">&copy; 2012-<?php echo date('Y'); ?> Jonathan 'J5' Harris :: <?php echo $oCRNRSTN->multi_lang_content_return('COPY_ALL_RIGHTS_PART1') . '<br>' . $oCRNRSTN->multi_lang_content_return('COPY_ALL_RIGHTS_PART2'); ?> <a id="crnrstn_txt_lnk_mit" href="#" target="_self" onclick="oCRNRSTN_JS.crnrstn_interact_ui_ux('onclick', this);"><?php echo $oCRNRSTN->multi_lang_content_return('COPY_ALL_RIGHTS_PART_MIT'); ?></a>.</div>

    <div style="width:700px;">
        <div id="crnrstn_j5_wolf_pup_outter_wrap" class="crnrstn_j5_wolf_pup_outter_wrap">
            <div id="crnrstn_j5_wolf_pup_inner_wrap" class="crnrstn_j5_wolf_pup_inner_wrap">
                <?php
                echo $oCRNRSTN->return_creative('J5_WOLF_PUP_RAND', CRNRSTN_HTML);
                ?>
            </div>
        </div>
    </div>
</div>

<?php

    //echo $oCRNRSTN->system_output_footer_html();

?>
</body>
</html>