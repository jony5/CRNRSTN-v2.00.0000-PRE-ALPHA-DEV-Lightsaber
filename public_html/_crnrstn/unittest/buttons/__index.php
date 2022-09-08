<?php

/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

function openssl_error_return(&$err_array, $lnum, $err_key){

    while($tmp_openssl_err_msg = openssl_error_string())
        $err_array[$lnum][$err_key][] = '<div class="crnrstn_log_entry">' . $tmp_openssl_err_msg . '</div>';

}

function openssl_error_string_return($openssl_err_queue_ARRAY){

    $tmp_str_out = '';

    foreach($openssl_err_queue_ARRAY as $lnum => $arr0){

        foreach($arr0 as $src => $arr1) {

            $tmp_str_out .= '<div class="crnrstn_cb_15"></div>';
            $tmp_str_out .= '<div class="crnrstn_log_entry">OpenSSL Error Queue Jettison [' . $lnum . ' ' . $src. ']:</div>';

            foreach($arr1 as $index => $tmp_openssl_err_msg){

                $tmp_str_out .= $tmp_openssl_err_msg;

            }

        }

    }

    return $tmp_str_out;

}


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
$oCRNRSTN_UNITTEST_MGR = new crnrstn_unit_test_manager($oCRNRSTN_USR);

//error_log('28 curl index die() crc32(\'Subliminal\')=' . $oCRNRSTN_USR->crcINT('Subliminal'));  //  07/05/2022 @ 1537hrs
//error_log('29 curl index die() ID=[' . $oCRNRSTN_USR->generate_new_key(64) . ']');
//die();

//
// ENABLE THIS PAGE TO RECEIVE HTTP POST/GET DATA
if($oCRNRSTN_USR->receive_form_integration_packet()){

    if($oCRNRSTN_USR->isvalid_data_validation_check('POST')){

        $tmp_received_POST_data =  true;

        //
        // PREPARE RECEIVED INPUT PARAMETERS FOR DATABASE QUERY
        $tmp_crnrstn_curl_uri_endpoint = $oCRNRSTN_USR->return_http_form_integration_input_val('crnrstn_curl_uri_endpoint');
        $tmp_crnrstn_curl_batch_save = $oCRNRSTN_USR->return_http_form_integration_input_val('crnrstn_curl_batch_save');
        $tmp_crnrstn_curl_batch_count = $oCRNRSTN_USR->return_http_form_integration_input_val('crnrstn_curl_batch_count');

        $tmp_crnrstn_curl_enable_unit_test_automation = $oCRNRSTN_USR->return_http_form_integration_input_val('crnrstn_curl_enable_unit_test_automation');
        $tmp_crnrstn_curl_unit_test_automation_freq_secs = $oCRNRSTN_USR->return_http_form_integration_input_val('crnrstn_curl_unit_test_automation_freq_secs');

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

            $oCRNRSTN_USR->init_input_listener('curl', 'crnrstn_curl_batch_uri_' . $tmp_batch_preview_cnt);

            $tmp_batch_preview_cnt++;

            if($tmp_crnrstn_curl_batch_count > 0){

                for($i = 0; $i < $tmp_crnrstn_curl_batch_count; $i++){

                    $tmp_crnrstn_curl_uri_endpoint = $oCRNRSTN_USR->return_http_form_integration_input_val('crnrstn_curl_batch_uri_' . $i);

                    $tmp_crnrstn_curl_batch_preview .= '<div class="crnrstn_log_entry">[rtime ' . $oCRNRSTN_UNITTEST_MGR->rtime('curl', md5($tmp_crnrstn_curl_uri_endpoint)).'] ' .  $tmp_crnrstn_curl_uri_endpoint . '</div>

                    <input type="hidden" name="crnrstn_curl_batch_uri_' . $tmp_batch_preview_cnt . '" value="' .  $tmp_crnrstn_curl_uri_endpoint . '">';

                    $oCRNRSTN_USR->init_input_listener('curl', 'crnrstn_curl_batch_uri_' . $tmp_batch_preview_cnt);

                    $tmp_batch_preview_cnt++;

                }

            }

        }

        $oCRNRSTN_USR->init_hidden_input_listener('curl', 'crnrstn_curl_batch_count', true, $tmp_batch_preview_cnt);

        if($tmp_crnrstn_curl_enable_unit_test_automation == "automation_on"){

            $tmp_crnrstn_curl_enable_unit_test_automation = "checked";

        }else{

            $tmp_crnrstn_curl_enable_unit_test_automation = "";

        }

    }else{

        //
        // FORM INPUT ERROR HANDLING. CAN MANUALLY HANDLE REDIRECTS HERE IF DESIRED.
        $tmp_err_array = $oCRNRSTN_USR->return_err_data_validation_check('POST');
        $test = '';

        foreach($tmp_err_array as $key=>$val){

            $test .= $val . '<br>';

        }

    }

}

$oCRNRSTN_USR->form_serialize_new('curl');
$tmp_form_serial = $oCRNRSTN_USR->generate_new_key(5);
$tmp_http_root = $oCRNRSTN_USR->current_location();

//
// THESE ARE THE INPUT FIELDS TO WHICH WE WILL LOOK
# THESE FIELDS ARE NOT HIDDEN. THEY WILL NOT/CANNOT BE
# ENCRYPTED INITIALLY.
# $this->oCRNRSTN_USR->init_input_listener({CRNRSTN_FORM_HANDLE}, {HTML_DOM_FORM_INPUT_NAME}}, {IS_REQUIRED});
$oCRNRSTN_USR->init_input_listener('curl', 'crnrstn_curl_uri_endpoint');
$oCRNRSTN_USR->init_input_listener('curl', 'crnrstn_curl_batch_save');
$oCRNRSTN_USR->init_input_listener('curl', 'crnrstn_curl_batch_count');
$oCRNRSTN_USR->init_input_listener('curl', 'crnrstn_curl_enable_unit_test_automation');
$oCRNRSTN_USR->init_input_listener('curl', 'crnrstn_curl_unit_test_automation_freq_secs');

$openssl_err_queue_ARRAY = array();
$public_key_res = 'NULL';
$encrypted_data_private  = 'NULL';
$encrypted_data_public = 'NULL';
$decrypted_data_public  = 'NULL';
$decrypted_data_private = 'NULL';

//
// GET AND/OR CLEAR ANY OPENSSL ERR
openssl_error_return($openssl_err_queue_ARRAY,__LINE__, '--PRE-INITIALIZATION');

//$config = array(
//    "digest_alg" => "sha512",
//    "private_key_bits" => 4096,
//    "private_key_type" => OPENSSL_KEYTYPE_RSA,
//);
//
//// Create the private and public key
//$res = openssl_pkey_new($config);
//
//// Extract the private key from $res to $private_key_pem
//openssl_pkey_export($res, $private_key_pem);
//
//// Extract the public key from $res to $pubKey
//$pubKey = openssl_pkey_get_details($res);
//$pubKey = $pubKey["key"];
//
//$data = 'J5, my boy!';
//
//// Encrypt the data to $encrypted using the public key
//openssl_public_encrypt($data, $encrypted, $pubKey);
//
//// Decrypt the data using the private key and store the results in $decrypted
//openssl_private_decrypt($encrypted, $decrypted, $private_key_pem);
//
//echo $encrypted;
//echo $decrypted;


/*

$oCRNRSTN_USR->openssl_digest()
$oCRNRSTN_USR->openssl_public_encrypt($config)
$oCRNRSTN_USR->openssl_private_encrypt()
$oCRNRSTN_USR->openssl_decrypt()
$oCRNRSTN_USR->openssl_error_string();
=======
public function openssl_digest($passphrase, ){


}

=======
$oCRNRSTN_USR->openssl_public_encrypt()
$oCRNRSTN_USR->openssl_private_decrypt()

$oCRNRSTN_USR->openssl_private_encrypt()
$oCRNRSTN_USR->openssl_public_decrypt()
$oCRNRSTN_USR
$oCRNRSTN_USR

*/
$data = 'J5, my boy!';

$tmp_password_A = $oCRNRSTN_USR->generate_new_key(64);
$tmp_password_A = openssl_digest($tmp_password_A, $oCRNRSTN_USR->return_openssl_digest_method(), true);

$tmp_password_B = $oCRNRSTN_USR->generate_new_key(64);
$tmp_password_B = openssl_digest($tmp_password_B, $oCRNRSTN_USR->return_openssl_digest_method(), true);

$tmp_password_D = $oCRNRSTN_USR->generate_new_key(64);
$tmp_password_D = openssl_digest($tmp_password_D, $oCRNRSTN_USR->return_openssl_digest_method(), true);

//
// GET AND/OR CLEAR ANY OPENSSL ERR
openssl_error_return($openssl_err_queue_ARRAY,__LINE__, '--openssl_digest');

$config = array(
    'digest_alg' => $oCRNRSTN_USR->return_openssl_digest_method(),
    'private_key_bits' => 4096,
    'private_key_type' => OPENSSL_KEYTYPE_RSA,
);

// Generate a new private (and public) key pair
$private_key_resource_PRIVATE = openssl_pkey_new($config);

$tmp_details_ARRAY = openssl_pkey_get_details($private_key_resource_PRIVATE);

//
// GET AND/OR CLEAR ANY OPENSSL ERR
openssl_error_return($openssl_err_queue_ARRAY,__LINE__, '--openssl_pkey_new');

//while ($tmp_openssl_err_msg = openssl_error_string())
//    $openssl_err_queue_ARRAY[__LINE__][] = '<div class="crnrstn_log_entry">' . $tmp_openssl_err_msg . '</div>';

// Extract the private key from $private_key_resource to $private_key_pem
openssl_pkey_export($private_key_resource_PRIVATE, $private_key_pem_PRIVATE, $tmp_password_A);

//
// GET AND/OR CLEAR ANY OPENSSL ERR
openssl_error_return($openssl_err_queue_ARRAY,__LINE__, '--openssl_pkey_export');

$public_key_pem_PRIVATE = openssl_pkey_get_details($private_key_resource_PRIVATE)['key'];

//
// GET AND/OR CLEAR ANY OPENSSL ERR
openssl_error_return($openssl_err_queue_ARRAY,__LINE__, '--openssl_pkey_get_details');

$public_key_resource_PRIVATE = openssl_pkey_get_public($public_key_pem_PRIVATE);

//
// GET AND/OR CLEAR ANY OPENSSL ERR
openssl_error_return($openssl_err_queue_ARRAY,__LINE__, '--openssl_pkey_get_public');

// Encrypt the data to (string) $encrypted_data_public using the public resource
//openssl_public_encrypt($data, $encrypted_data_public, $public_key_pem_PRIVATE);
openssl_public_encrypt($data, $encrypted_data_public, $public_key_resource_PRIVATE);

//
// GET AND/OR CLEAR ANY OPENSSL ERR
openssl_error_return($openssl_err_queue_ARRAY,__LINE__, '--openssl_public_encrypt');

// Decrypt the data using the private key and store the results in $decrypted_data_private
//openssl_private_decrypt($encrypted_data_public, $decrypted_data_private, array($private_key_pem_PRIVATE, $tmp_password_B));
openssl_private_decrypt($encrypted_data_public, $decrypted_data_private, array($private_key_pem_PRIVATE, $tmp_password_A));

//
// GET AND/OR CLEAR ANY OPENSSL ERR
openssl_error_return($openssl_err_queue_ARRAY,__LINE__, '--openssl_private_decrypt');

///////
// Generate a new private (and public) key pair
$private_key_resource_PUBLIC = openssl_pkey_new($config);
$private_key_resource_PUBLIC2 = openssl_pkey_new($config);

//
// GET AND/OR CLEAR ANY OPENSSL ERR
openssl_error_return($openssl_err_queue_ARRAY,__LINE__, '--openssl_private_decrypt');

// Extract the private key from $private_key_resource to $private_key_pem
openssl_pkey_export($private_key_resource_PUBLIC, $private_key_pem_PUBLIC, $tmp_password_B);
openssl_pkey_export($private_key_resource_PUBLIC2, $private_key_pem_PUBLIC2);

//
// GET AND/OR CLEAR ANY OPENSSL ERR
openssl_error_return($openssl_err_queue_ARRAY,__LINE__, '--openssl_pkey_export');

//$private_key_res = openssl_pkey_get_private($private_key_resource, $tmp_password_B);

$private_key_resource_PUBLIC = openssl_pkey_get_private($private_key_resource_PUBLIC, $tmp_password_B);
$private_key_resource_PUBLIC2 = openssl_pkey_get_private($private_key_resource_PUBLIC2);

//
// GET AND/OR CLEAR ANY OPENSSL ERR
openssl_error_return($openssl_err_queue_ARRAY,__LINE__, '--openssl_pkey_get_private');

$public_key_pem_PUBLIC = openssl_pkey_get_details($private_key_resource_PUBLIC)['key'];
$public_key_pem_PUBLIC2 = openssl_pkey_get_details($private_key_resource_PUBLIC2)['key'];

//
// GET AND/OR CLEAR ANY OPENSSL ERR
openssl_error_return($openssl_err_queue_ARRAY,__LINE__, '--openssl_pkey_get_private');

//$public_key_resource_PUBLIC = openssl_pkey_get_public($private_key_pem_PUBLIC);

//error_log('210 button ' . print_r($public_key_pem_PUBLIC, true));
//error_log('210 button ' . print_r($private_key_resource_PUBLIC, true));
//die();

// Encrypt the data to (string) $encrypted_data_private using the private resource
//openssl_private_encrypt($data, $encrypted_data_private, $private_key_resource_PRIVATE);
openssl_private_encrypt($data, $encrypted_data_private, $private_key_resource_PUBLIC2);

//
// GET AND/OR CLEAR ANY OPENSSL ERR
openssl_error_return($openssl_err_queue_ARRAY,__LINE__, '--openssl_private_encrypt');

$private_key_resource_PUBLIC2 = openssl_pkey_get_private($private_key_resource_PUBLIC2, $tmp_password_B);

//
// GET AND/OR CLEAR ANY OPENSSL ERR
openssl_error_return($openssl_err_queue_ARRAY,__LINE__, '--openssl_pkey_get_private');

$public_key_pem_PUBLIC2 = openssl_pkey_get_details($private_key_resource_PUBLIC2)['key'];

//
// GET AND/OR CLEAR ANY OPENSSL ERR
openssl_error_return($openssl_err_queue_ARRAY,__LINE__, '--openssl_pkey_get_details');

// Decrypt the data using the public key and store the results in $decrypted_data_public
//openssl_public_decrypt($encrypted_data_private, $decrypted_data_public, array($public_key_resource_PRIVATE, $tmp_password_B));
openssl_public_decrypt($encrypted_data_private, $decrypted_data_public, array($public_key_pem_PUBLIC2, $tmp_password_A));
//openssl_public_decrypt($encrypted_data_private, $decrypted_data_public, $public_key_pem_PUBLIC2);

//error_log('180 buttons $public_key_pem=' . print_r($public_key_pem, true));
//error_log('181 buttons $private_key_pem=' . print_r($private_key_pem, true));
//error_log('182 buttons $private_key_res=' . print_r($private_key_res, true));
//die();

//
// GET AND/OR CLEAR ANY OPENSSL ERR
openssl_error_return($openssl_err_queue_ARRAY,__LINE__, '--openssl_public_decrypt');

?>
<!DOCTYPE html>
<html lang="<?php echo $oCRNRSTN_USR->country_iso_code; ?>">
<head>
<title>CRNRSTN :: <?php echo $oCRNRSTN_USR->version_crnrstn(); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php echo $oCRNRSTN_USR->return_creative('CRNRSTN_FAVICON'); ?>
<?php echo $oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_JS_JQUERY) .
    $oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_JS_JQUERY_UI).
    $oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_CSS_MAIN_DESKTOP & CRNRSTN_UI_JS_MAIN_DESKTOP); ?>
<style type="text/css">
    *                                           { font-family:Arial, Helvetica, sans-serif;}
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
    .crnrstn_field_input_title                  { font-size:16px; color: #FFF; }
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

</style>
<?php
echo $oCRNRSTN_UNITTEST_MGR->return_automation_initialization('curl');
?>
</head>
<body style="background-image: url('./imgs/bg_rr_00.png'); background-repeat: no-repeat;">

<div id="crnrstn_curl_data_storage" style="padding:0 10px 10px 20px; width:810px;">

    <div style="font-weight: bold; font-size: 25px; padding: 10px 0 0 0; color: #FFF;">C<span class="the_R_in_crnrstn">R</span>NRSTN :: UI Interact Button Events UX Laboratory</div>
    <div class="crnrstn_cb"></div>
    <div style="font-size: 11px; font-weight: normal; padding: 5px 0 0 0; color: #c2bfbf;">
        <?php
        echo $oCRNRSTN_USR->proper_version('LINUX') .
            ', ' . $oCRNRSTN_USR->proper_version('APACHE') .
            ', ' . $oCRNRSTN_USR->proper_version('MYSQLI') .
            ', ' . $oCRNRSTN_USR->proper_version('PHP') .
            ', ' . $oCRNRSTN_USR->proper_version('OPENSSL') .
            ', ' . $oCRNRSTN_USR->proper_version('SOAP') .
            ', C<span class="the_R_in_crnrstn">R</span>NRSTN :: v' . $oCRNRSTN_USR->version_crnrstn(); ?>
    </div>
    <div class="crnrstn_cb_100"></div>
    <div class="crnrstn_cb_10"></div>
    <div style="text-align:left; background-color: #04050A; border: 3px solid #9F9393; width: 780px; height: 379px; overflow: scroll; padding: 15px 20px 15px 20px;">

        <div class="crnrstn_log_entry">Private key encrypted data:</div>
        <div class="crnrstn_log_entry" style="width: 758px; overflow: scroll;">
            <div style="width: 800px;"><?php echo $encrypted_data_private; ?></div>
        </div>
        <div class="crnrstn_cb_15"></div>

        <div class="crnrstn_log_entry">Public key encrypted data:</div>
        <div class="crnrstn_log_entry" style="width: 758px; overflow: scroll;">
            <div style="width: 800px;"><?php echo $encrypted_data_public; ?></div>
        </div>
        <div class="crnrstn_cb_15"></div>

        <div class="crnrstn_log_entry"><?php echo nl2br($private_key_pem_PRIVATE); ?></div>
        <div class="crnrstn_cb_15"></div>

        <div class="crnrstn_log_entry"><?php echo nl2br($public_key_pem_PRIVATE); ?></div>
        <div class="crnrstn_cb_15"></div>

        <div class="crnrstn_log_entry"><?php echo nl2br($private_key_pem_PUBLIC); ?></div>
        <div class="crnrstn_cb_15"></div>

        <div class="crnrstn_log_entry"><?php echo nl2br($public_key_pem_PUBLIC); ?></div>
        <div class="crnrstn_cb_15"></div>

        <div class="crnrstn_log_entry">Private key decrypted data:</div>
        <div class="crnrstn_log_entry"><?php echo $decrypted_data_private; ?></div>

        <div class="crnrstn_cb_15"></div>
        <div class="crnrstn_log_entry">Public key decrypted data:</div>
        <div class="crnrstn_log_entry"><?php echo $decrypted_data_public; ?></div>

        <div class="crnrstn_cb_15"></div>
        <div class="crnrstn_log_entry">Key details:</div>
        <?php

        foreach ($tmp_details_ARRAY as $index => $val){

            echo '<div class="crnrstn_log_entry">';
            echo print_r($index, true);
            echo '::</div>';

            if(is_array($val)){

                foreach ($val as $index2 => $val2){

                    echo '<div class="crnrstn_log_entry">--';
                    echo print_r($index2, true);
                    echo '</div>';

                    if($index2  === 'n'){

                        echo '<div class="crnrstn_log_entry">[Modulus (HEXADECIMAL)]</div>';
                        echo '<div class="crnrstn_log_entry">' . $val2 . '<br>---<br>' . print_r(bin2hex($val2), true) . '</div>';

                        //echo '<div class="crnrstn_log_entry">' . print_r(bin2hex($val2), true) . '</div><div class="crnrstn_cb_10"></div>';
                        //echo '<div class="crnrstn_log_entry">' . print_r(sprintf("%02x",ord(fgetc($val2)))) . '</div><div class="crnrstn_cb_10"></div>';
                        //echo '<div class="crnrstn_log_entry">' . print_r(sprintf("%02X", bin2hex($val2))) . '</div><div class="crnrstn_cb_10"></div>';

                        echo '<div class="crnrstn_cb_10"></div>';

                    }else{

                        echo '<div class="crnrstn_log_entry">';
                        echo print_r($val2, true);
                        echo '</div><div class="crnrstn_cb_10"></div>';

                    }

                }

            }else{

                echo '<div class="crnrstn_log_entry">';
                echo print_r(nl2br($val), true);
                echo '</div>';

            }

            echo '<div class="crnrstn_cb_5"></div>';

        }

        //
        // GET AND/OR CLEAR ANY OPENSSL ERR
        openssl_error_return($openssl_err_queue_ARRAY,__LINE__, '--END');

        echo openssl_error_string_return($openssl_err_queue_ARRAY);

        // LJHigh
        // 2875768619
        $tmp_SOCIAL_ID = $oCRNRSTN_USR->generate_new_key(64);

        echo '<div class="crnrstn_cb_10"></div>';
        echo '<div class="crnrstn_log_entry">';
        echo $oCRNRSTN_USR->return_micro_time();
        echo '</div>';

        echo '<div class="crnrstn_cb_10"></div>';
        echo '<div class="crnrstn_log_entry">SOCIAL_ID 0 [' . $tmp_SOCIAL_ID . '][<input type="checkbox" style="width: 20px;">]';
        echo '</div>';

        echo '<div class="crnrstn_cb_10"></div>';
        echo '<div class="crnrstn_log_entry">SOCIAL_ID_CRC 0 [' . $oCRNRSTN_USR->crcINT($tmp_SOCIAL_ID) . ']';
        echo '</div>';

        $tmp_SOCIAL_ID = $oCRNRSTN_USR->generate_new_key(64);

        echo '<div class="crnrstn_cb_10"></div>';
        echo '<div class="crnrstn_log_entry">SOCIAL_ID 1 [' . $tmp_SOCIAL_ID . '][<input type="checkbox" style="width: 20px;">]';
        echo '</div>';

        echo '<div class="crnrstn_cb_10"></div>';
        echo '<div class="crnrstn_log_entry">SOCIAL_ID_CRC 1 [' . $oCRNRSTN_USR->crcINT($tmp_SOCIAL_ID) . ']';
        echo '</div>';

        echo '<div class="crnrstn_cb_10"></div>';
        echo '<div class="crnrstn_log_entry">SOCIAL_MEDIA_KEY :: [profile][1300][' . $oCRNRSTN_USR->crcINT('profile') . ']';
        echo '</div>';

        echo '<div class="crnrstn_cb_10"></div>';
        echo '<div class="crnrstn_log_entry">SOCIAL_MEDIA_KEY :: [archives][1400][' . $oCRNRSTN_USR->crcINT('archives') . ']';
        echo '</div>';

        ?>
    </div>

</div>

    <div class="crnrstn_cb_15"></div>

    <form action="#" method="post" name="curl" id="curl"  enctype="multipart/form-data">

        <?php
        echo $oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_FORM_INTEGRATION_PACKET, 'curl');
        ?>
    </form>

    <div class="crnrstn_cb_200"></div>
    <div class="crnrstn_cb_200"></div>
    <div class="crnrstn_cb_200"></div>

    <div class="crnrstn_signin_copyright_shell">&copy; 2012-<?php echo date('Y'); ?> Jonathan 'J5' Harris :: <?php echo $oCRNRSTN_USR->get_lang_copy('COPY_ALL_RIGHTS_PART1') . '<br>' . $oCRNRSTN_USR->get_lang_copy('COPY_ALL_RIGHTS_PART2'); ?> <a href="<?php echo $tmp_http_root; ?>&crnrstn_mit=true" target="_self"><?php echo $oCRNRSTN_USR->get_lang_copy('COPY_ALL_RIGHTS_PART_MIT'); ?></a>.</div>

    <div style="width:700px;">
        <div class="crnrstn_j5_wolf_pup_outter_wrap">
            <div class="crnrstn_j5_wolf_pup_inner_wrap">
                <?php
                echo $oCRNRSTN_USR->return_creative('J5_WOLF_PUP_RAND');
                ?>
            </div>
        </div>
    </div>

<?php

echo $oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_SOAP_DATA_TUNNEL);

?>

<div id="crnrstn_ui_interact_wrapper" class="crnrstn_ui_interact_wrapper">
    <div class="crnrstn_ui_interact">

        <div id="crnrstn_ui_interact_bg_border" class="crnrstn_ui_interact_bg_border">

        </div>

        <div id="crnrstn_ui_interact_bg_border_edge" class="crnrstn_ui_interact_bg_border_edge" style="border: 1px solid #FFF;">

        </div>

        <div style="position:relative; height:106px;">

            <div id="crnrstn_ui_interact_primary_navgroup_wrapper" class="crnrstn_ui_interact_primary_navgroup_wrapper">

                <div id="crnrstn_ui_interact_primary_nav_menu" class="crnrstn_ui_interact_primary_navgroup_lnk_border">

                    <div id="crnrstn_ui_interact_primary_nav_img_shell_menu_inactive" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="../../../_crnrstn/ui/imgs/png/primary_nav_seriesblue00_120x120_menu_inactive.png" width="40" height="40" alt="Menu" title="Navigation to Menu"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_menu_hvr"  class="crnrstn_ui_interact_primary_nav_img_shell"><img src="../../../_crnrstn/ui/imgs/png/primary_nav_seriesblue00_120x120_menu_hvr.png" width="40" height="40" alt="Menu" title="Navigation to Menu"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_menu_click"  class="crnrstn_ui_interact_primary_nav_img_shell"><img src="../../../_crnrstn/ui/imgs/png/primary_nav_seriesblue00_120x120_menu_click.png" width="40" height="40" alt="Menu" title="Navigation to Menu"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_menu"  class="crnrstn_ui_interact_primary_nav_img_shell crnrstn_ui_interact_active"><img src="../../../_crnrstn/ui/imgs/png/primary_nav_seriesblue00_120x120_menu.png" width="40" height="40" alt="Menu" title="Navigation to Menu"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_menu_glass_case"  class="crnrstn_ui_interact_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_ui_interact_ux('onmouseover', this);" onmouseout="oCRNRSTN_JS.crnrstn_ui_interact_ux('onmouseout', this);" onmousedown="oCRNRSTN_JS.crnrstn_ui_interact_ux('onmousedown', this);" onmouseup="oCRNRSTN_JS.crnrstn_ui_interact_ux('onmouseup', this);"><img src="../../../_crnrstn/ui/imgs/gif/x.gif" width="40" height="40" alt="Menu" title="Navigation to Menu"></div>

                </div>

                <div id="crnrstn_ui_interact_primary_nav_close_x" class="crnrstn_ui_interact_primary_navgroup_lnk_border">

                    <div id="crnrstn_ui_interact_primary_nav_img_shell_close_x_inactive"  class="crnrstn_ui_interact_primary_nav_img_shell"><img src="../../../_crnrstn/ui/imgs/png/primary_nav_seriesblue00_120x120_close_x_inactive.png" width="40" height="40" alt="Close" title="Navigation to Close"></div class="crnrstn_ui_interact_primary_nav_img_shell">
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_close_x_hvr"  class="crnrstn_ui_interact_primary_nav_img_shell"><img src="../../../_crnrstn/ui/imgs/png/primary_nav_seriesblue00_120x120_close_x_hvr.png" width="40" height="40" alt="Close" title="Navigation to Close"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_close_x_click"  class="crnrstn_ui_interact_primary_nav_img_shell"><img src="../../../_crnrstn/ui/imgs/png/primary_nav_seriesblue00_120x120_close_x_click.png" width="40" height="40" alt="Close" title="Navigation to Close"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_close_x"  class="crnrstn_ui_interact_primary_nav_img_shell crnrstn_ui_interact_active"><img src="../../../_crnrstn/ui/imgs/png/primary_nav_seriesblue00_120x120_close_x.png" width="40" height="40" alt="Close" title="Navigation to Close"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_close_x_glass_case"  class="crnrstn_ui_interact_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_ui_interact_ux('onmouseover', this);" onmouseout="oCRNRSTN_JS.crnrstn_ui_interact_ux('onmouseout', this);" onmousedown="oCRNRSTN_JS.crnrstn_ui_interact_ux('onmousedown', this);" onmouseup="oCRNRSTN_JS.crnrstn_ui_interact_ux('onmouseup', this);"><img src="../../../_crnrstn/ui/imgs/gif/x.gif" width="40" height="40" alt="Close" title="Navigation to Close"></div>

                </div>

                <div id="crnrstn_ui_interact_primary_nav_fs_expand" class="crnrstn_ui_interact_primary_navgroup_lnk_border">

                    <div id="crnrstn_ui_interact_primary_nav_img_shell_fs_expand_inactive"  class="crnrstn_ui_interact_primary_nav_img_shell"><img src="../../../_crnrstn/ui/imgs/png/primary_nav_seriesblue00_120x120_fs_expand_inactive.png" width="40" height="40" alt="FullScreen" title="Navigation to Full Screen"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_fs_expand_hvr"  class="crnrstn_ui_interact_primary_nav_img_shell"><img src="../../../_crnrstn/ui/imgs/png/primary_nav_seriesblue00_120x120_fs_expand_hvr.png" width="40" height="40" alt="FullScreen" title="Navigation to Full Screen"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_fs_expand_click"  class="crnrstn_ui_interact_primary_nav_img_shell"><img src="../../../_crnrstn/ui/imgs/png/primary_nav_seriesblue00_120x120_fs_expand_click.png" width="40" height="40" alt="FullScreen" title="Navigation to Full Screen"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_fs_expand"  class="crnrstn_ui_interact_primary_nav_img_shell crnrstn_ui_interact_active"><img src="../../../_crnrstn/ui/imgs/png/primary_nav_seriesblue00_120x120_fs_expand.png" width="40" height="40" alt="FullScreen" title="Navigation to Full Screen"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_fs_expand_glass_case"  class="crnrstn_ui_interact_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_ui_interact_ux('onmouseover', this);" onmouseout="oCRNRSTN_JS.crnrstn_ui_interact_ux('onmouseout', this);" onmousedown="oCRNRSTN_JS.crnrstn_ui_interact_ux('onmousedown', this);" onmouseup="oCRNRSTN_JS.crnrstn_ui_interact_ux('onmouseup', this);"><img src="../../../_crnrstn/ui/imgs/gif/x.gif" width="40" height="40" alt="FullScreen" title="Navigation to Full Screen"></div>

                </div>

                <div id="crnrstn_ui_interact_primary_nav_minimize" class="crnrstn_ui_interact_primary_navgroup_lnk_border">

                    <div id="crnrstn_ui_interact_primary_nav_img_shell_minimize_inactive" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="../../../_crnrstn/ui/imgs/png/primary_nav_seriesblue00_120x120_minimize_inactive.png" width="40" height="40" alt="5" title="eVifweb development"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_minimize_hvr" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="../../../_crnrstn/ui/imgs/png/primary_nav_seriesblue00_120x120_minimize_hvr.png" width="40" height="40" alt="5" title="eVifweb development"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_minimize_click" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="../../../_crnrstn/ui/imgs/png/primary_nav_seriesblue00_120x120_minimize_click.png" width="40" height="40" alt="5" title="eVifweb development"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_minimize" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="../../../_crnrstn/ui/imgs/png/primary_nav_seriesblue00_120x120_minimize.png" width="40" height="40" alt="5" title="eVifweb development"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_minimize_fivedev_sm" class="crnrstn_ui_interact_primary_nav_img_shell crnrstn_ui_interact_active"><img src="../../../_crnrstn/ui/imgs/png/primary_nav_seriesblue00_120x120_minimize_fivedev_sm.png" width="40" height="40" alt="5" title="eVifweb development"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_minimize_glass_case" class="crnrstn_ui_interact_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_ui_interact_ux('onmouseover', this);" onmouseout="oCRNRSTN_JS.crnrstn_ui_interact_ux('onmouseout', this);" onmousedown="oCRNRSTN_JS.crnrstn_ui_interact_ux('onmousedown', this);" onmouseup="oCRNRSTN_JS.crnrstn_ui_interact_ux('onmouseup', this);"><img src="../../../_crnrstn/ui/imgs/gif/x.gif" width="40" height="40" alt="5" title="eVifweb development"></div>

                </div>

            </div>
            <div class="crnrstn_cb"></div>
        </div>

        <div class="crnrstn_cb"></div>

        <div style="position:relative;">
            <div style="position:absolute; z-index:68; margin: 2px 0 0 16px; border: 1px solid #FFF;">
                <div id="crnrstn_ui_interact_bg_solid" class="crnrstn_ui_interact_bg_solid" onclick="oCRNRSTN_JS.sign_in_transition_via_micro_expansion();">
                    <?php echo $oCRNRSTN_USR->return_creative('MESSAGE_CONVERSATION_BUBBLE_MICRO_THUMB_BLUE00', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED); ?>
                    <div class="crnrstn_cb"></div>
                </div>
            </div>
            <div class="crnrstn_cb"></div>

        </div>

        <div id="crnrstn_ui_interact_content_wrapper" class="crnrstn_ui_interact_content_wrapper">
            <div id="crnrstn_ui_interact_signin_frm_username" class="crnrstn_ui_interact_signin_frm_lbl"><?php echo $oCRNRSTN_USR->get_lang_copy('FORM_LABEL_USERNAME'); ?></div>
            <div class="crnrstn_cb_5"></div>
            <input type="text" name="username" value="">
            <div class="crnrstn_cb_15"></div>
            <div id="crnrstn_ui_interact_signin_frm_password" class="crnrstn_ui_interact_signin_frm_lbl"><?php echo $oCRNRSTN_USR->get_lang_copy('FORM_LABEL_PASSWORD_OPTIONAL'); ?></div>
            <div class="crnrstn_cb_5"></div>
            <input type="password" name="password" value="">
            <div class="crnrstn_cb_10"></div>

            <div class="crnrstn_ui_interact_signin_frm_chkbx_eula"><input type="checkbox" style="width: 20px;" name="crnrstn_signin_chkbx_eula_accept" value="eula_i_agree"></div>
            <div class="crnrstn_ui_interact_signin_frm_lbl_eula"><a href="#"><?php echo $oCRNRSTN_USR->get_lang_copy('FORM_LNK_TXT_EULA'); ?></a></div>

            <div class="crnrstn_cb_10"></div>

            <div class="crnrstn_ui_interact_frm_submit" onclick="oCRNRSTN_JS.sign_in_form_submit_via_micro_expansion();">
                <div id="crnrstn_ui_interact_signin_frm_btn_submit" class="crnrstn_ui_interact_signin_frm_btn_submit"><?php echo $oCRNRSTN_USR->get_lang_copy('FORM_BUTTON_TEXT_CONNECT'); ?>'</div>
            </div>
        </div>
    </div>
</div>
</body>
</html>