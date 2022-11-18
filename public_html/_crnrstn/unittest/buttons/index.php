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
$oCRNRSTN_UNITTEST_MGR = new crnrstn_unit_test_manager($oCRNRSTN);

//error_log('28 curl index die() crc32(\'Subliminal\')=' . $oCRNRSTN->crcINT('Subliminal'));  //  07/05/2022 @ 1537hrs
//error_log('29 curl index die() ID=[' . $oCRNRSTN->generate_new_key(64) . ']');
//die();

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

$oCRNRSTN->openssl_digest()
$oCRNRSTN->openssl_public_encrypt($config)
$oCRNRSTN->openssl_private_encrypt()
$oCRNRSTN->openssl_decrypt()
$oCRNRSTN->openssl_error_string();
=======
public function openssl_digest($passphrase, ){


}

=======
$oCRNRSTN->openssl_public_encrypt()
$oCRNRSTN->openssl_private_decrypt()

$oCRNRSTN->openssl_private_encrypt()
$oCRNRSTN->openssl_public_decrypt()
$oCRNRSTN
$oCRNRSTN

*/
$data = 'J5, my boy!';

$tmp_password_A = $oCRNRSTN->generate_new_key(64);
$tmp_password_A = openssl_digest($tmp_password_A, $oCRNRSTN->return_openssl_digest_method(), true);

$tmp_password_B = $oCRNRSTN->generate_new_key(64);
$tmp_password_B = openssl_digest($tmp_password_B, $oCRNRSTN->return_openssl_digest_method(), true);

$tmp_password_D = $oCRNRSTN->generate_new_key(64);
$tmp_password_D = openssl_digest($tmp_password_D, $oCRNRSTN->return_openssl_digest_method(), true);

//
// GET AND/OR CLEAR ANY OPENSSL ERR
openssl_error_return($openssl_err_queue_ARRAY,__LINE__, '--openssl_digest');

$config = array(
    'digest_alg' => $oCRNRSTN->return_openssl_digest_method(),
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
<html lang="<?php echo $oCRNRSTN->country_iso_code(); ?>">
<head>
<title>CRNRSTN :: <?php echo $oCRNRSTN->version_crnrstn(); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php echo $oCRNRSTN->return_creative('CRNRSTN_FAVICON'); ?>
<?php echo $oCRNRSTN->ui_content_module_out(CRNRSTN_UI_JS_JQUERY) .
    $oCRNRSTN->ui_content_module_out(CRNRSTN_UI_JS_JQUERY_UI).
    $oCRNRSTN->ui_content_module_out(CRNRSTN_UI_CSS_MAIN_DESKTOP & CRNRSTN_UI_JS_MAIN_DESKTOP); ?>
<style>
    *                                           { }
    .the_R_in_crnrstn                           { color:#F90000; }
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

<div id="crnrstn_curl_data_storage" style="font-family:Arial, Helvetica, sans-serif; padding:0 10px 10px 20px; width:810px;">

    <div style="font-weight: bold; font-size: 25px; padding: 10px 0 0 0; color: #FFF;">C<span class="the_R_in_crnrstn">R</span>NRSTN :: Interact UI Button Events UX Laboratory</div>
    <div class="crnrstn_cb"></div>
    <div style="font-size: 11px; font-weight: normal; padding: 5px 0 0 0; color: #c2bfbf;">
        <?php
        echo $oCRNRSTN->proper_version('LINUX') .
            ', ' . $oCRNRSTN->proper_version('APACHE') .
            ', ' . $oCRNRSTN->proper_version('MYSQLI') .
            ', ' . $oCRNRSTN->proper_version('PHP') .
            ', ' . $oCRNRSTN->proper_version('OPENSSL') .
            ', ' . $oCRNRSTN->proper_version('SOAP') .
            ', C<span class="the_R_in_crnrstn">R</span>NRSTN :: v' . $oCRNRSTN->version_crnrstn(); ?>
    </div>
    <div class="crnrstn_cb_50"></div>
    <div style="border: 5px solid #F100DB; background-color: #FFF; width:100%; padding: 0 0 20px 0;">
        <div style="padding: 10px 20px 10px 20px;">
        <?php

        /*
        ARCHIVES
        BANDCAMP
        BASSDRIVE
        BEATPORT
        DISCOGS
        FACEBOOK
        HISTORY
        INSTAGRAM
        JSON
        LINKEDIN
        MIXCLOUD
        PAYPAL
        ROLLDABEATS
        SOUNDCLOUD
        SPOTIFY
        TWITTER
        WWW
        YOUTUBE

        */
        //echo '<img src="' . $oCRNRSTN->return_creative('MYSQL_DOLPHIN', CRNRSTN_UI_IMG_BASE64) .'" height="100">';

        echo '<div style="float: right;"><img src="' . $oCRNRSTN->return_creative('REDHAT_LOGO', CRNRSTN_UI_IMG_BASE64) . '" width="103"></div><div class="crnrstn_cb_10" style="border-bottom: 2px solid #dbdbdb;"></div>';
        echo '<div class="crnrstn_cb_30"></div>';

        echo '<div style="font-weight: bold; font-size: 20px;">Web ::</div><div class="crnrstn_cb"></div>';
        echo 'Here is the sticky link: <a href="' . $oCRNRSTN->return_sticky_link('https://soundcloud.com/jonathan-harris-772368100','soundcloud_social_media_lnk').'" target="_blank">click here</a>';
        echo '<div class="crnrstn_cb"></div>Here is the small (26px height) social media sticky link: ' . $oCRNRSTN->return_sticky_media_link('SOUNDCLOUD_SMALL', 'https://soundcloud.com/jonathan-harris-772368100');
        echo '<div class="crnrstn_cb"></div>Here is the medium (50px height) social media sticky link: ' . $oCRNRSTN->return_sticky_media_link('SOUNDCLOUD_MEDIUM', 'https://soundcloud.com/jonathan-harris-772368100');
        echo '<div class="crnrstn_cb"></div>Here is the large (76px height) social media sticky link: ' . $oCRNRSTN->return_sticky_media_link('SOUNDCLOUD_LARGE', 'https://soundcloud.com/jonathan-harris-772368100');

        echo '<div class="crnrstn_cb_30"></div>';

        echo '<div style="font-weight: bold; font-size: 20px;">Email ::</div><div class="crnrstn_cb"></div>';
        echo 'Here is the small (26px height) social media sticky link: ' . $oCRNRSTN->return_sticky_media_link('SOUNDCLOUD_SMALL', 'https://soundcloud.com/jonathan-harris-772368100', '_blank', true);
        echo '<div class="crnrstn_cb"></div>Here is the medium (50px height) social media sticky link: ' . $oCRNRSTN->return_sticky_media_link('SOUNDCLOUD_MEDIUM', 'https://soundcloud.com/jonathan-harris-772368100', '_blank', true);
        echo '<div class="crnrstn_cb"></div>Here is the large (76px height) social media sticky link: ' . $oCRNRSTN->return_sticky_media_link('SOUNDCLOUD_LARGE', 'https://soundcloud.com/jonathan-harris-772368100', '_blank', true);

        echo '<div class="crnrstn_cb_10"></div>';

        ?>
        </div>
    </div>
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

        echo '<div class="crnrstn_cb_10"></div>';
        echo '<div class="crnrstn_log_entry">';
        echo $oCRNRSTN->return_micro_time();
        echo '</div>';

        ?>
    </div>

</div>

    <div class="crnrstn_cb_15"></div>

    <div class="crnrstn_cb_200"></div>
    <div class="crnrstn_cb_200"></div>
    <div class="crnrstn_cb_200"></div>

    <div class="crnrstn_signin_copyright_shell">&copy; 2012-<?php echo date('Y'); ?> Jonathan 'J5' Harris :: <?php echo $oCRNRSTN->multi_lang_content_return('COPY_ALL_RIGHTS_PART1') . '<br>' . $oCRNRSTN->multi_lang_content_return('COPY_ALL_RIGHTS_PART2'); ?> <a id="crnrstn_txt_lnk_mit" href="#" target="_self" onclick="oCRNRSTN_JS.crnrstn_interact_ui_ux('onclick', this);"><?php echo $oCRNRSTN->multi_lang_content_return('COPY_ALL_RIGHTS_PART_MIT'); ?></a>.</div>

    <div style="width:700px;">
        <div id="crnrstn_j5_wolf_pup_outter_wrap" class="crnrstn_j5_wolf_pup_outter_wrap">
            <div id="crnrstn_j5_wolf_pup_inner_wrap" class="crnrstn_j5_wolf_pup_inner_wrap">
                <?php
                echo $oCRNRSTN->return_creative('J5_WOLF_PUP_RAND', CRNRSTN_UI_IMG_HTML_WRAPPED);
                ?>
            </div>
        </div>
    </div>

<?php

echo $oCRNRSTN->system_output_footer_html(CRNRSTN_RESOURCE_DOCUMENTATION);

?>
</body>
</html>