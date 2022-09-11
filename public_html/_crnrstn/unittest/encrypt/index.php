<?php

/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

//
// INITIALIZATION
$tmp_received_POST_data = false;
$tmp_crnrstn_openssl_cipher = '';
$tmp_crnrstn_openssl_algorithm = '';
$tmp_crnrstn_openssl_secret_key = NULL;
$tmp_crnrstn_openssl_options = '';
$tmp_crnrstn_openssl_raw_data = '';
$tmp_secret_key_previous = '';
$tmp_crnrstn_openssl_refresh_secret_key = '';
$tmp_secret_key = $oCRNRSTN->generate_new_key(64, -2);
$tmp_crnrstn_openssl_enable_unit_test_automation = '';
$tmp_crnrstn_openssl_unit_test_automation_freq_secs = '';
$tmp_crnrstn_openssl_profile_randomization = '';
$tmp_rotate_cipher = '';
$tmp_rotate_algorithm = '';
$tmp_rotate_all = '';
$tmp_option_raw_data = '';
$tmp_option_zero_padding = '';
$tmp_option_both = '';
$tmp_option_default = '';

$cipher_ARRAY = array();
$algorithm_ARRAY = array();
$cipher_dom_log_ARRAY = array();
$cipher_dom_combo_ARRAY = array();
$cipher_dom_chkbx_ARRAY = array();
$cipher_dom_chkbx_state_ARRAY = array();
$algorithm_dom_log_ARRAY = array();
$algorithm_dom_combo_ARRAY = array();
$algorithm_dom_chkbx_ARRAY = array();
$algorithm_dom_chkbx_state_ARRAY = array();
$automation_frequency_secs_value_ARRAY = array(5, 10, 20, 30, 40, 50, 60, 120, 240, 300);
$automation_frequency_title_value_ARRAY = array('Every 5 seconds', 'Every 10 seconds', 'Every 20 seconds', 'Every 30 seconds', 'Every 40 seconds', 'Every 50 seconds', 'Every 60 seconds', 'Every 2 minutes', 'Every 4 minutes', 'Every 5 minutes');

//
// TEST ENCRYPTION OUTPUT PERFORMANCE OF THE RECEIVED OPENSSL PROFILE
$oCRNRSTN_UNITTEST_MGR = new crnrstn_unit_test_manager($oCRNRSTN);

//
// ENABLE THIS PAGE TO RECEIVE HTTP POST/GET DATA
if($oCRNRSTN->receive_form_integration_packet()){

    if($oCRNRSTN->isvalid_data_validation_check('POST')){

        $tmp_received_POST_data =  true;

        //
        // PREPARE RECEIVED INPUT PARAMETERS FOR DATABASE QUERY
        $tmp_crnrstn_openssl_cipher = $oCRNRSTN->return_http_form_integration_input_val('crnrstn_openssl_cipher');
        $tmp_crnrstn_openssl_algorithm = $oCRNRSTN->return_http_form_integration_input_val('crnrstn_openssl_algorithm');
        $tmp_crnrstn_openssl_secret_key = $oCRNRSTN->return_http_form_integration_input_val('crnrstn_openssl_secret_key');
        $tmp_crnrstn_openssl_options = $oCRNRSTN->return_http_form_integration_input_val('crnrstn_openssl_options');
        $tmp_crnrstn_openssl_raw_data = $oCRNRSTN->return_http_form_integration_input_val('crnrstn_openssl_raw_data');
        $tmp_crnrstn_openssl_refresh_secret_key = $oCRNRSTN->return_http_form_integration_input_val('crnrstn_openssl_refresh_secret_key');
        $tmp_crnrstn_openssl_enable_unit_test_automation = $oCRNRSTN->return_http_form_integration_input_val('crnrstn_openssl_enable_unit_test_automation');
        $tmp_crnrstn_openssl_unit_test_automation_freq_secs = $oCRNRSTN->return_http_form_integration_input_val('crnrstn_openssl_unit_test_automation_freq_secs');
        $tmp_crnrstn_openssl_profile_randomization = $oCRNRSTN->return_http_form_integration_input_val('crnrstn_openssl_profile_randomization');

        if($tmp_crnrstn_openssl_refresh_secret_key == "regenerate_key"){

            $tmp_crnrstn_openssl_refresh_secret_key = "checked";

        }else{

            $tmp_secret_key = $tmp_crnrstn_openssl_secret_key;

        }

        if($tmp_crnrstn_openssl_enable_unit_test_automation == "automation_on"){

            $tmp_crnrstn_openssl_enable_unit_test_automation = "checked";

        }else{

            $tmp_crnrstn_openssl_enable_unit_test_automation = "";

        }

        switch($tmp_crnrstn_openssl_profile_randomization){
            case 'rotate_cipher':

                $tmp_rotate_cipher = 'selected';

            break;
            case 'rotate_algorithm':

                $tmp_rotate_algorithm = 'selected';

            break;
            case 'rotate_all':

                $tmp_rotate_all = 'selected';

            break;

        }

        switch($tmp_crnrstn_openssl_options){
            case 'OPENSSL_RAW_DATA':

                $tmp_option_raw_data = 'selected';

            break;
            case 'OPENSSL_ZERO_PADDING':

                $tmp_option_zero_padding = 'selected';

            break;
            case 'OPENSSL_RAW_DATA|OPENSSL_ZERO_PADDING':

                $tmp_option_both = 'selected';

            break;
            case '0':

                $tmp_option_default = 'selected';

            break;

        }

        if(strlen($tmp_crnrstn_openssl_raw_data) > 0){

            $oCRNRSTN_UNITTEST_MGR->configure_unit_test('openssl_mysql_storage_performance', $tmp_crnrstn_openssl_raw_data, $tmp_crnrstn_openssl_cipher, $tmp_crnrstn_openssl_algorithm, $tmp_crnrstn_openssl_secret_key, $tmp_crnrstn_openssl_options);
            $oCRNRSTN_UNITTEST_MGR->execute_unit_test();

        }else{

            $oCRNRSTN_UNITTEST_MGR->configure_unit_test('openssl_mysql_storage_performance', NULL, $tmp_crnrstn_openssl_cipher, $tmp_crnrstn_openssl_algorithm, $tmp_crnrstn_openssl_secret_key, $tmp_crnrstn_openssl_options);
            $oCRNRSTN_UNITTEST_MGR->execute_unit_test();

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
# $this->oCRNRSTN_USR->form_input_add({CRNRSTN_FORM_HANDLE}, {HTML_DOM_FORM_INPUT_NAME}}, {IS_REQUIRED});
$oCRNRSTN->form_input_add('openssl_mysql_storage_performance', 'crnrstn_openssl_cipher', true);
$oCRNRSTN->form_input_add('openssl_mysql_storage_performance', 'crnrstn_openssl_algorithm', true);
$oCRNRSTN->form_input_add('openssl_mysql_storage_performance', 'crnrstn_openssl_secret_key');
$oCRNRSTN->form_input_add('openssl_mysql_storage_performance', 'crnrstn_openssl_options', true);
$oCRNRSTN->form_input_add('openssl_mysql_storage_performance', 'crnrstn_openssl_raw_data');
$oCRNRSTN->form_input_add('openssl_mysql_storage_performance', 'crnrstn_openssl_refresh_secret_key');
$oCRNRSTN->form_input_add('openssl_mysql_storage_performance', 'crnrstn_openssl_enable_unit_test_automation');
$oCRNRSTN->form_input_add('openssl_mysql_storage_performance', 'crnrstn_openssl_unit_test_automation_freq_secs');
$oCRNRSTN->form_input_add('openssl_mysql_storage_performance', 'crnrstn_openssl_profile_randomization');

$tmp_array = $oCRNRSTN->openssl_get_cipher_methods();
foreach ($tmp_array as $key1 => $data1) {

    $cipher_ARRAY[] = $data1;
    $cipher_dom_log_ARRAY[$data1] = '<div class="crnrstn_log_entry">' . $data1 . "</div>";

    if($tmp_received_POST_data){

        $tmp_checked_dom_flag = '';
        $tmp_chx_val = $oCRNRSTN->return_http_form_integration_input_val('crnrstn_openssl_cipher_' . $data1 . '_chkbx');

        if(strlen($tmp_chx_val) > 0){

            $cipher_dom_chkbx_state_ARRAY[$data1] = 1;
            $tmp_checked_dom_flag = 'checked';

        }

        $cipher_dom_chkbx_ARRAY[$data1] = '<input type="checkbox" style="width: 20px;" name="crnrstn_openssl_cipher_' . $data1 . '_chkbx" value="' . $data1 . '" ' . $tmp_checked_dom_flag . '>';

    }else{

        $cipher_dom_chkbx_state_ARRAY[$data1] = 1;
        $cipher_dom_chkbx_ARRAY[$data1] = '<input type="checkbox" style="width: 20px;" name="crnrstn_openssl_cipher_' . $data1 . '_chkbx" value="' . $data1 . '" checked>';

    }

    if($tmp_crnrstn_openssl_cipher == $data1){

        $cipher_dom_combo_ARRAY[$data1] = '<option value="'  . $data1 .  '" selected>'  . $data1 .  '</option>';

    }else{

        $cipher_dom_combo_ARRAY[$data1] = '<option value="'  . $data1 .  '">'  . $data1 .  '</option>';

    }

    $oCRNRSTN->form_input_add('openssl_mysql_storage_performance', 'crnrstn_openssl_cipher_' . $data1 . '_chkbx');

}

$tmp_array = hash_algos();
foreach ($tmp_array as $key1 => $data1) {

    $algorithm_ARRAY[] = $data1;
    $algorithm_dom_log_ARRAY[$data1] = '<div class="crnrstn_log_entry">' . $data1 . "</div>";
    $algorithm_dom_chkbx_ARRAY[$data1] = '<input type="checkbox" style="width: 20px;" name="crnrstn_openssl_algorithm_' . $data1 . '_chkbx" value="' . $data1 . '" checked>';

    if($tmp_received_POST_data){

        $tmp_checked_dom_flag = '';
        $tmp_chx_val = $oCRNRSTN->return_http_form_integration_input_val('crnrstn_openssl_algorithm_' . $data1 . '_chkbx');

        if(strlen($tmp_chx_val) > 0){

            $algorithm_dom_chkbx_state_ARRAY[$data1] = 1;
            $tmp_checked_dom_flag = 'checked';

        }

        $algorithm_dom_chkbx_ARRAY[$data1] = '<input type="checkbox" style="width: 20px;" name="crnrstn_openssl_algorithm_' . $data1 . '_chkbx" value="' . $data1 . '" ' . $tmp_checked_dom_flag . '>';

    }else{

        $algorithm_dom_chkbx_state_ARRAY[$data1] = 1;
        $algorithm_dom_chkbx_ARRAY[$data1] = '<input type="checkbox" style="width: 20px;" name="crnrstn_openssl_algorithm_' . $data1 . '_chkbx" value="' . $data1 . '" checked>';

    }

    if($tmp_crnrstn_openssl_algorithm == $data1){

        $algorithm_dom_combo_ARRAY[$data1] = '<option value="'  . $data1 .  '" selected>'  . $data1 .  '</option>';

    }else{

        $algorithm_dom_combo_ARRAY[$data1] = '<option value="'  . $data1 .  '">'  . $data1 .  '</option>';

    }

    $oCRNRSTN->form_input_add('openssl_mysql_storage_performance', 'crnrstn_openssl_algorithm_' . $data1 . '_chkbx');

}


?>
<!DOCTYPE html>
<html lang="<?php echo $oCRNRSTN->country_iso_code(); ?>">
<head>
<title>CRNRSTN :: <?php echo $oCRNRSTN->version_crnrstn(); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php echo $oCRNRSTN->return_creative('CRNRSTN_FAVICON'); ?>
<?php echo $oCRNRSTN->ui_content_module_out(CRNRSTN_UI_JS_JQUERY) .
    $oCRNRSTN->ui_content_module_out(CRNRSTN_UI_JS_JQUERY_UI).
    $oCRNRSTN->ui_content_module_out(CRNRSTN_UI_CSS_MAIN_DESKTOP & CRNRSTN_UI_JS_MAIN_DESKTOP); ?>
<style type="text/css">
    *                                           { }
    .the_R_in_crnrstn                           { color:#F90000; }
    .crnrstn_activity_log                       { opacity: 0; }
    .crnrstn_log_output_wrapper                 { background-color:#04050A; border:3px solid #9F9393; padding:10px; margin:10px 10px 0 0; width:800px; height:190px; overflow:scroll;}
    .crnrstn_log_output                         { width:2000px; }
    .crnrstn_log_entry                          { display:block; clear:both; text-align: left; color:#7AF94F; font-size:12px; font-family: "Courier New", Courier, monospace; }
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

    /*UTILITY*/
    .crnrstn_hidden						        { width:0; height:0; position:absolute; left:-2000px; overflow:hidden;}
    .crnrstn_cb 								{ display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px;}
    .crnrstn_cb_3                               { display:block; clear:both; height:3px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_5	 							{ display:block; clear:both; height:5px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_10	 							{ display:block; clear:both; height:10px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
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
echo $oCRNRSTN_UNITTEST_MGR->return_automation_initialization('openssl_mysql_storage_performance');
?>
</head>
<body>
<div id="crnrstn_openssl_data_storage" style="Cpadding:0 10px 10px 20px; width:810px;">

    <div style="font-weight: bold; font-size: 25px; padding: 10px 0 0 0;">MySQL Database Storage Requirements :: OpenSSL Encryption</div>
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

    <form action="#" method="post" name="openssl_mysql_storage_performance" id="openssl_mysql_storage_performance"  enctype="multipart/form-data" >

        <div style="width:100%;">
            <div style="float: left; width: 200px;">
                <div class="crnrstn_field_input_wrapper">
                    <div class="crnrstn_field_input_title">
                        OpenSSL Cipher
                        <div class="crnrstn_input_title_lnk_expand_wrapper">

                            <div id="crnrstn_cipher_dom_filter_lnk_expand" class="crnrstn_input_title_lnk_expand" onclick="$('#crnrstn_cipher_dom_chkbx_ARRAY').toggle('linear');">+ filter</div>
                            <div class="crnrstn_cb"></div>

                            <div style="position: relative;">
                                <div id="crnrstn_cipher_dom_chkbx_ARRAY" style="display:none; position:absolute; left: 25px; top: 9px; width: 200px; border-left: 5px solid #1677e0; border-top: 1px solid #9a9292; border-right: 1px solid #9a9292; border-bottom: 1px solid #9a9292; background-color: #FFF; overflow: scroll; height: 300px;">
                                    <div class="crnrstn_field_input_array_wrapper" style="padding:0 0 0 10px; width: 190px;">
                                        <?php
                                        foreach ($cipher_dom_chkbx_ARRAY as $key1 => $data1) {

                                            echo '<div class="crnrstn_field_input_array_elem">
                                                <div style="float: left; padding: 5px 0 0 2px;">' . $data1 . '</div> 
                                                <div style="float: left; width: 150px; font-size: 12px; padding:13px 0 0 10px;">' . $key1 . '</div>
                                            </div><div class="crnrstn_cb"></div>';

                                        }
                                        ?>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <select name="crnrstn_openssl_cipher">
                        <option value="">- Select</option>
                        <?php
                        foreach ($cipher_dom_combo_ARRAY as $key1 => $data1) {

                            if(isset($cipher_dom_chkbx_state_ARRAY[$key1])){

                                echo $data1;

                            }

                        }
                        ?>
                    </select>
                    <div class="crnrstn_cb"></div>

                </div>
            </div>

            <div style="float: left; padding: 0 0 0 30px;">
                <div class="crnrstn_field_input_wrapper">
                    <div class="crnrstn_field_input_title">
                        HMAC Hash Algorithm
                        <div class="crnrstn_input_title_lnk_expand_wrapper">

                            <div id="crnrstn_algorithm_dom_filter_lnk_expand" class="crnrstn_input_title_lnk_expand" onclick="$('#crnrstn_algorithm_dom_chkbx_ARRAY').toggle('linear');">+ filter</div>
                            <div class="crnrstn_cb"></div>
                            <div style="position: relative;">
                                <div id="crnrstn_algorithm_dom_chkbx_ARRAY" style="display:none; position:absolute; left: 25px; top: 9px; width: 200px; border-left: 5px solid #1677e0; border-top: 1px solid #9a9292; border-right: 1px solid #9a9292; border-bottom: 1px solid #9a9292; background-color: #FFF; overflow: scroll; height: 300px;">
                                    <div class="crnrstn_field_input_array_wrapper" style="padding:0 0 0 10px; width: 190px;">
                                        <?php
                                        foreach ($algorithm_dom_chkbx_ARRAY as $key1 => $data1) {

                                            echo '<div class="crnrstn_field_input_array_elem">
                                                <div style="float: left; padding: 5px 0 0 2px;">' . $data1 . '</div> 
                                                <div style="float: left; width: 120px; font-size: 12px; padding:13px 0 0 10px;">' . $key1 . '</div>
                                            </div><div class="crnrstn_cb"></div>';

                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <select name="crnrstn_openssl_algorithm">
                        <option value="">- Select</option>
                        <?php
                        foreach ($algorithm_dom_combo_ARRAY as $key1 => $data1) {

                            if(isset($algorithm_dom_chkbx_state_ARRAY[$key1])){

                                echo $data1;

                            }

                        }
                        ?>
                    </select>
                    <div class="crnrstn_cb"></div>

                </div>
            </div>
        </div>

        <?php
        if(!is_null($tmp_crnrstn_openssl_secret_key)){

            $tmp_secret_key_previous = '<div class="crnrstn_cb_3"></div><div style="font-size: 11px;"><strong>Previous Value:</strong> <span style="color: #9a9292;">' . $tmp_crnrstn_openssl_secret_key . '</span></div>';

        }
        ?>
        <div class="crnrstn_cb_15"></div>

        <div class="crnrstn_field_input_wrapper">
            <div style="width:100%;">
                <div class="crnrstn_field_input_title">Password (secret key)</div>
                <div class="crnrstn_cb"></div>
                <div style="float: left;"><input type="password" name="crnrstn_openssl_secret_key" style="width:500px;" value="<?php echo $tmp_secret_key; ?>"></div>
                <div style="float: left; width: 20px; padding: 5px 0 0 20px;"><input type="checkbox" style="width: 20px;" name="crnrstn_openssl_refresh_secret_key" value="regenerate_key" <?php echo $tmp_crnrstn_openssl_refresh_secret_key;?>></div>
                <div style="float: left; width: 80px; font-size: 12px; padding:13px 0 0 10px; cursor: pointer;" onclick="oCRNRSTN_JS.log_activity('[lnum 448] DOM click[' + this.innerHTML +  '] :: reporting for duty.', oCRNRSTN_JS.CRNRSTN_DEBUG_VERBOSE);">Refresh Key</div>
                <div class="crnrstn_cb"></div>
            </div>
            <div class="crnrstn_cb"></div>

            <?php
            echo $tmp_secret_key_previous;
            ?>
        </div>
        <div class="crnrstn_cb_15"></div>

        <!-- https://www.php.net/manual/en/function.openssl-encrypt.php -->
        <!-- options is a bitwise disjunction of the flags OPENSSL_RAW_DATA and OPENSSL_ZERO_PADDING. -->
        <div class="crnrstn_field_input_wrapper">
            <div class="crnrstn_field_input_title">Options</div>
            <select name="crnrstn_openssl_options">
                <option value="0" <?php echo $tmp_option_default; ?>>0 - DEFAULT VALUE</option>
                <option value="OPENSSL_RAW_DATA" <?php echo $tmp_option_raw_data; ?>>OPENSSL_RAW_DATA</option>
                <option value="OPENSSL_ZERO_PADDING" <?php echo $tmp_option_zero_padding; ?>>OPENSSL_ZERO_PADDING</option>
                <option value="OPENSSL_RAW_DATA|OPENSSL_ZERO_PADDING" <?php echo $tmp_option_both; ?>>OPENSSL_RAW_DATA and OPENSSL_ZERO_PADDING</option>
            </select>
        </div>
        <div class="crnrstn_cb_15"></div>

        <div class="crnrstn_field_input_wrapper">
            <div class="crnrstn_field_input_title">
                Unit Test Dataset Profiles
                <span id="crnrst_add_btn" class="toggleUnit_copy" onmouseover="crnrstn_interact_btn(this, 'ON'); return false;" onmouseout="crnrstn_interact_btn(this, 'OFF'); return false;" onmousedown="crnrstn_interact_btn(this, 'MOUSE_DOWN'); return false;" onmouseup="crnrstn_interact_btn(this, 'MOUSE_UP'); return false;" onclick="crnrstn_interact_btn(this, 'CLICK'); crnrstn_add_unittest_openssl_dataset_input('openssl_mysql_storage_performance'); return false;"><?php echo $oCRNRSTN->get_lang_copy('BUTTON_TEXT_ADD'); ?></span>
                <div id="crnrstn_unittest_openssl_dataset_input_wrapper"></div>
            </div>
        </div>
        <div class="crnrstn_cb_20"></div>

        <div class="crnrstn_field_input_wrapper">
            <div class="crnrstn_field_input_title">Optional Data for Encryption</div>
            <textarea type="text" name="crnrstn_openssl_raw_data"><?php echo $tmp_crnrstn_openssl_raw_data; ?></textarea>
        </div>
        <div class="crnrstn_cb_20"></div>

        <div class="crnrstn_field_input_wrapper">
            <div style="width:100%;">
            <div style="float: left; padding-top: 10px;">
                <input style="width:100px;" type="submit" value="<?php echo $oCRNRSTN->get_lang_copy('BUTTON_TEXT_SUBMIT'); ?>">
                <div class="crnrstn_cb_10"></div>
                <div style="float: left; width: 100px; font-size: 12px; font-style: italic; line-height: 17px; padding:0 0 0 0;">14 secs before next POST.<br> <a href="#" style="text-decoration: none; color:#0066CC; text-decoration:underline;">Cancel</a></div>
            </div>
            <div style="float: left; width: 420px; border:5px solid #FF0000; padding:20px 10px 20px 10px; margin-left: 20px;">
                <div style="float: left; width: 20px; padding:0px 0 0 20px;"><input type="checkbox" style="width:20px;" name="crnrstn_openssl_enable_unit_test_automation" value="automation_on" <?php echo $tmp_crnrstn_openssl_enable_unit_test_automation; ?>></div>
                <div style="float: left; width: 120px; font-size: 12px; padding:8px 0 0 10px;">Enable Automation</div>
                <div style="float: left; width: 100px; font-size: 12px; padding:0 0 0 10px;">
                    <select name="crnrstn_openssl_unit_test_automation_freq_secs">
                        <option value="">- Select Automation Frequency</option>

                        <?php
                        $tmp_cnt = count($automation_frequency_secs_value_ARRAY);
                        for($i = 0; $i < $tmp_cnt; $i++){

                            $tmp_selected = '';
                            if($automation_frequency_secs_value_ARRAY[$i] == $tmp_crnrstn_openssl_unit_test_automation_freq_secs){

                                $tmp_selected = 'selected';

                            }else{

                                echo '<!-- NO MATCH[' . $automation_frequency_secs_value_ARRAY[$i] . '|' . $tmp_crnrstn_openssl_unit_test_automation_freq_secs . '] -->';

                            }

                            echo '<option value="' . $automation_frequency_secs_value_ARRAY[$i] . '" ' . $tmp_selected  . '>' . $automation_frequency_title_value_ARRAY[$i] . '</option>';

                        }

                        ?>
                    </select>
                </div>
                <div class="crnrstn_cb_10"></div>
                <div style="float: left; font-size: 12px; padding:0 0 0 20px;">
                    <select name="crnrstn_openssl_profile_randomization">
                        <option value="rotate_cipher" <?php echo $tmp_rotate_cipher; ?>>Randomize OpenSSL Cipher</option>
                        <option value="rotate_algorithm" <?php echo $tmp_rotate_algorithm; ?>>Randomize Hash Algorithm</option>
                        <option value="rotate_all" <?php echo $tmp_rotate_all; ?>>Randomize OpenSSL Cipher and Hash Algorithm</option>
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
        <?php

        echo $oCRNRSTN->ui_content_module_out(CRNRSTN_UI_FORM_INTEGRATION_PACKET, 'openssl_mysql_storage_performance');

        ?>

    </form>

    <?php
    if($oCRNRSTN_UNITTEST_MGR->isset_report('openssl_mysql_storage_performance')){
    ?>

    <div class="crnrstn_cb_30"></div>

    <div class="crnrstn_page_subtitle">Data Storage Requirements Performance Report ::</div>

    <?php

        echo $oCRNRSTN_UNITTEST_MGR->return_report('openssl_mysql_storage_performance', 'HTML_INJECTION');

    }
    ?>

    <div class="crnrstn_cb_30"></div>

    <div class="crnrstn_page_subtitle">SERVER's Available OpenSSL Ciphers ::</div>
    Here is a list of available ciphers and aliases that can be used by C<span class="the_R_in_crnrstn">R</span>NRSTN :: to
    enable execution of data_decrypt()/data_encrypt(). See: <em>/_crnrstn/_config/config.encryption.secure/_crnrstn.encryption.inc.php</em>.<br>

    <div class="crnrstn_activity_log crnrstn_log_output_wrapper" style="opacity: 1;">
        <div class="crnrstn_activity_log_output crnrstn_log_output">

            <?php
            $tmp_array = $oCRNRSTN->openssl_get_cipher_methods();
            foreach($tmp_array as $key1 => $data1){

                echo '<div class="crnrstn_log_entry">' .  $data1 . "</div>";

            }
            ?>

        </div>
    </div>

    <div class="crnrstn_cb_30"></div>

    <div class="crnrstn_page_subtitle">SERVER's Available Hash Algorithms ::</div>
    Here is a list of available hash algorithms that can be used by
    C<span class="the_R_in_crnrstn">R</span>NRSTN :: when using the HMAC library to generate a
    keyed hash value. See: <em>/_crnrstn/_config/config.encryption.secure/_crnrstn.encryption.inc.php</em>.<br>


    <div class="crnrstn_activity_log crnrstn_log_output_wrapper" style="opacity: 1;">
        <div class="crnrstn_activity_log_output crnrstn_log_output">

            <?php
            $tmp_array = hash_algos();
            foreach($tmp_array as $key1 => $data1){

                echo '<div class="crnrstn_log_entry">' .  $data1 . "</div>";

            }
            ?>

        </div>
    </div>

    <div class="crnrstn_cb_20"></div>

    <div class="crnrstn_signin_copyright_shell">&copy; 2012-<?php echo date('Y'); ?> Jonathan 'J5' Harris :: <?php echo $oCRNRSTN->get_lang_copy('COPY_ALL_RIGHTS_PART1') . '<br>' . $oCRNRSTN->get_lang_copy('COPY_ALL_RIGHTS_PART2'); ?> <a href="<?php echo $tmp_http_root; ?>&crnrstn_mit=true" target="_self"><?php echo $oCRNRSTN->get_lang_copy('COPY_ALL_RIGHTS_PART_MIT'); ?></a>.</div>

    <div style="width:700px;">
        <div class="crnrstn_j5_wolf_pup_outter_wrap">
            <div class="crnrstn_j5_wolf_pup_inner_wrap">
                <?php
                echo $oCRNRSTN->return_creative('J5_WOLF_PUP_RAND', CRNRSTN_UI_IMG_BASE64_PNG_HTML_WRAPPED);
                ?>
            </div>
        </div>
    </div>
</div>

<?php

    //echo $oCRNRSTN->framework_integrations_client_packet();

?>
</body>
</html>