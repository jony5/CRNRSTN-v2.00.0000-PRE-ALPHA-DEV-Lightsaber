<?php

/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

$tmp_selection = rand(0, count($oCRNRSTN->system_theme_style_constants_ARRAY) - 1);

$tmp_theme_style = NULL;
foreach($oCRNRSTN->system_theme_style_constants_ARRAY as $index => $int_const){

    if($tmp_selection == $index){

        $tmp_theme_style = $int_const;

        $tmp_theme_style_ARRAY = $oCRNRSTN->return_constant_profile_ARRAY($tmp_theme_style);
        $tmp_theme_style_nom = $tmp_theme_style_ARRAY['STRING'];
        $tmp_theme_style_int = $tmp_theme_style_ARRAY['INTEGER'];

        break 1;

    }
}

/*
DEMO TOPICS ::
- DATA STORAGE AND RETRIEVAL
- STICKY LINKS
- SOCIAL MEDIA LINKS
- EXCEPTION HANDLING
- TUNNEL ENCRYPTION
- UTILITY METHODS
    ~ DATETIME
    ~ STRING MANIPULATION
    ~ ERROR LOG
    ~ PRINT_R
    ~ FORMAT NUMBERS


$oCRNRSTN->set_timezone_default('America/New_York');
$oCRNRSTN->ini_set('max_execution_time', 60);
$oCRNRSTN->ini_set('memory_limit', '300M');
$oCRNRSTN->config_add_environment('BLUEHOST', E_ALL & ~E_NOTICE & ~E_STRICT);
...
*/

?>

<!DOCTYPE html>
<html lang="<?php echo $oCRNRSTN->iso_language_profile(); ?>">
<head>
    <title>CRNRSTN :: <?php echo $oCRNRSTN->version_crnrstn(); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <?php echo $oCRNRSTN->return_creative('CRNRSTN_FAVICON'); ?>
    <?php echo $oCRNRSTN->ui_content_module_out(CRNRSTN_JS_FRAMEWORK_JQUERY) .
        $oCRNRSTN->ui_content_module_out(CRNRSTN_JS_FRAMEWORK_JQUERY_UI).
        $oCRNRSTN->ui_content_module_out(CRNRSTN_UI_CSS_MAIN_DESKTOP & CRNRSTN_UI_JS_MAIN); ?>
    <style>
        .the_R_in_crnrstn                           { color:#F90000; }
        .crnrstn_logo_wrapper                       { padding: 15px 0 20px 15px; }

        .crnrstn_j5_wolf_pup_outter_wrap            { float:right; padding:420px 0 0 0; margin:0; width:100%;}
        .crnrstn_j5_wolf_pup_inner_wrap             { position: absolute; width:98%; z-index: 2; text-align: right; padding-top: 20px;}
        .crnrstn_signin_copyright_shell             { width:578px; text-align: center; margin:0 auto; font-size: 12px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; color: #333;}
        .crnrstn_signin_copyright_shell a           { text-decoration:none; color: #0066CC; text-decoration:underline;}

    </style>
</head>
<body>
<div id="crnrstn_top_shell_<?php echo $oCRNRSTN->session_salt(); ?>"><a id="__crnrstn_top_<?php echo $oCRNRSTN->session_salt(); ?>"></a></div>
<div class="crnrstn_logo_wrapper"><img src="<?php echo $oCRNRSTN->return_creative('CRNRSTN_LOGO', CRNRSTN_UI_IMG_BASE64_PNG); ?>" height="70" alt="CRNRSTN :: v<?php echo $oCRNRSTN->version_crnrstn(); ?>" title="CRNRSTN :: v<?php echo $oCRNRSTN->version_crnrstn(); ?>"></div>

<?php
/*
user form_input_add
$tmp_dtf_FORM_HANDLE = 'CRNRSTN_SYSTEM_RESOURCE::FORM_HANDLE::' . $tmp_form_handle_hash . '::' . $tmp_field_input_name_hash;
if(!$this->oCRNRSTN->isset_data_key('FORM_INPUT_NAME', $tmp_dtf_FORM_HANDLE)){






*/

echo '<div style="font-size:25px; padding: 0 0 20px 20px; font-family:Arial, Helvetica, sans-serif; font-weight: bold;">Theme: <span style="font-weight: normal;">' . $tmp_theme_style_nom  . '</span></div>';

$tmp_str = '<!DOCTYPE html>
<html lang="en">
<head>
    <title>CRNRSTN ::</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
    <p>hello HTML!</p>
</body>
</html>';
$oCRNRSTN->print_r($tmp_str, 'CRNRSTN :: HTML SNIPPET TEST.', $tmp_theme_style_int, __LINE__, __METHOD__, __FILE__);



$tmp_str = '$tmp_hash = $oCRNRSTN->hash($data, \'crc32\');';
$oCRNRSTN->print_r($tmp_str, 'CRNRSTN :: CODE NOTES. USE OF crnrstn::hash()', $tmp_theme_style_int, __LINE__, __METHOD__, __FILE__);

$tmp_str = '/*
    CRNRSTN :: ORDER OF OPERATIONS (PREFERENCE) FOR SPECIFICATION OF
    AUTHORIZED DATA ARCHITECTURES FOR DATA HANDLING. DSJPCR. 
    
    RUNTIME ONLY (R) IS THE DEFAULT FOR ALL DATA PUT INTO THE SYSTEM.
    
    DATA HANDLING ARCHITECTURES
    0 :: D :: DATABASE (MySQLi Connection Required)
    1 :: S :: SSDTL PACKET (SOAP WRAPPED PSSDTL PACKET. THE BROWSER IS A SERVER.)
    2 :: J :: PSSDTL PACKET (OPENSSL ENCRYPTED JSON OBJECT)
    3 :: P :: $_SERVER SESSION (PHP SESSION ARRAY SUPER GLOBAL)
    4 :: C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)
    5 :: R :: RUNTIME ONLY
    
    * COOKIE DID NOT MAKE THE LIST...BUT "C" IS ACCOUNTED FOR IN THE ABOVE!  :)

    DSJPCR
    
    SYSTEM RESOURCE DATA HANDLING ARCHITECTURE INTEGER CONSTANTS ::
    CRNRSTN_AUTHORIZE_RUNTIME_ONLY
    CRNRSTN_AUTHORIZE_ALL
    CRNRSTN_AUTHORIZE_DATABASE
    CRNRSTN_AUTHORIZE_SSDTLA
    CRNRSTN_AUTHORIZE_PSSDTLA
    CRNRSTN_AUTHORIZE_SESSION
    CRNRSTN_AUTHORIZE_COOKIE
    CRNRSTN_AUTHORIZE_SOAP
    CRNRSTN_AUTHORIZE_GET
    CRNRSTN_AUTHORIZE_ISEMAIL
    CRNRSTN_AUTHORIZE_ISPASSWORD
   
    Example ::
    $oCRNRSTN->config_add_system_resource(\'BLUEHOST\', \'ROOT_PATH_CLIENT_HTTP\', \'http://jony5.com/\', CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
    For demonstration of use, see: /_crnrstn/_config/config.system_resource.secure/_crnrstn.system_resource.inc.php
    
*/';
$oCRNRSTN->print_r($tmp_str, 'CRNRSTN :: CODE NOTES. crnrstn::', $tmp_theme_style_int, __LINE__, __METHOD__, __FILE__);

$oCRNRSTN->print_r('$this->env_key = $oCRNRSTN->get_server_env(\'hash\');', 'crnrstn::get_server_env()', $tmp_theme_style_int, __LINE__, __METHOD__, __FILE__);

$oCRNRSTN->print_r('$this->config_serial_hash = $oCRNRSTN->get_server_config_serial(\'hash\');', 'crnrstn::get_server_config_serial()', $tmp_theme_style_int, __LINE__, __METHOD__, __FILE__);


$tmp_str = '$tmp_data_key = \'crnrstn_pssdtl_packet\';
$tmp_data_type_family = \'CRNRSTN_SYSTEM_RESOURCE::FORM_HANDLE::\' . md5($crnrstn_form_handle);
if(!$this->oCRNRSTN->isset_data_key($crnrstn_form_handle, $tmp_data_type_family)){

    // add_system_resource($data_key, $data_value, $data_type_family = \'CRNRSTN::RESOURCE\', $data_auth_profile = CRNRSTN_AUTHORIZE_RUNTIME_ONLY){
    $this->oCRNRSTN->add_system_resource($tmp_data_key, \'data_value_here\', $tmp_data_type_family, CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
    
}';

$oCRNRSTN->print_r($tmp_str, 'CRNRSTN :: SNIPPET FROM crnrstn_usr::form_serialize_new()', $tmp_theme_style_int, __LINE__, __METHOD__, __FILE__);

$tmp_str = '$oCRNRSTN->get_resource($data_key, $index = NULL, $data_type_family = \'CRNRSTN::RESOURCE\', $data_auth_request = CRNRSTN_OUTPUT_RUNTIME);';
$oCRNRSTN->print_r($tmp_str, 'CRNRSTN :: SNIPPET FROM crnrstn::retrieve_data_value()', $tmp_theme_style_int, __LINE__, __METHOD__, __FILE__);

$tmp_str = '$this->oCRNRSTN->retrieve_data_count(\'FORM_INPUT_FIELD_NAME\', $tmp_data_type_family)';
$oCRNRSTN->print_r($tmp_str, 'crnrstn::retrieve_data_count()', $tmp_theme_style_int, __LINE__, __METHOD__, __FILE__);

$tmp_str = 'if($oCRNRSTN->isset_data_key($data_key, $data_type_family){

// where, public function isset_data_key($data_key, $data_type_family = \'CRNRSTN::RESOURCE\', $env_key = NULL){}

}
';
$oCRNRSTN->print_r($tmp_str, 'CRNRSTN :: SNIPPET FROM crnrstn::isset_data_key()', $tmp_theme_style_int, __LINE__, __METHOD__, __FILE__);

$tmp_str = '$http_transport_protocol = strtoupper($transport_protocol);
$http_transport_protocol = $this->string_sanitize($http_transport_protocol, \'http_protocol_simple\');

if($http_transport_protocol != \'GET\' && $http_transport_protocol != \'POST\') {
    
    //
    // HOOOSTON...VE HAF PROBLEM!
    throw new Exception(\'CRNRSTN :: Form handling configuration error :: unable to detect transport_protocol[POST/GET] from the provided value of \' . $transport_protocol . \'.\');

}';

$oCRNRSTN->print_r($tmp_str, 'CRNRSTN :: SNIPPET FROM crnrstn_usr::form_serialize_new()', $tmp_theme_style_int, __LINE__, __METHOD__, __FILE__);


$tmp_str = '$tmp_stripe_key_ARRAY = $oCRNRSTN->return_stripe_key_ARRAY(\'$env_key\', \'$encrypt_cipher\', \'$encrypt_secret_key\', \'$hmac_alg\');
$tmp_param_err_str_ARRAY = $oCRNRSTN->return_regression_stripe_ARRAY(\'MISSING_STRING_DATA\', $tmp_stripe_key_ARRAY, $env_key, $encrypt_cipher, $encrypt_secret_key, $hmac_alg);

$tmp_param_missing_str = $tmp_param_err_str_ARRAY[\'string\'];
$tmp_param_missing_ARRAY = $tmp_param_err_str_ARRAY[\'index_array\'];

if(count($tmp_param_missing_ARRAY) > 0){

    $oCRNRSTN->error_log(\'Missing required \' . $data_type_title . \' encryption information to complete \' . __METHOD__ .\'. \'. $tmp_param_missing_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

    throw new Exception(\'CRNRSTN :: initialization ERROR :: \' . __METHOD__ . \' was called but was missing parameter information and so encryption was not able to be initialized. Some parameters are required. \' . $tmp_param_missing_str);

}';

$oCRNRSTN->print_r($tmp_str, 'CRNRSTN :: SNIPPET FROM crnrstn::apply_encryption_profile()', $tmp_theme_style_int, __LINE__, __METHOD__, __FILE__);


$tmp_str = '//
// CALCULATE MINIMUM BYTES REQUIRED FOR NEW FILE
$tmp_minimum_bytes_required = strlen($tmp_data_str_out);

// TODO :: BEFORE THROWING HARD EXCEPTION, PUT A "DISK FULL WARNING BUFFER" INSIDE grant_permissions_fwrite().
// ASK CRNRSTN :: TO GRANT PERMISSIONS FOR fwrite()
if(!$this->oCRNRSTN->grant_permissions_fwrite($tmp_filepath, $tmp_minimum_bytes_required)){

    //
    // HOOOSTON...VE HAF PROBLEM!
    $this->oCRNRSTN->error_log(\'WARNING. Disk space exceeds \' . $this->oCRNRSTN->get_disk_performance_metric(\'maximum_disk_use\') . \'% minimum allocation of free space. File write [\' . $tmp_filepath . \'] stopped. CRNRSTN :: is configured to stop file writes when allocation of free space on disk exceeds specified limits.\', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY_DISK);

    $this->oCRNRSTN->print_r(\'WARNING. Disk space exceeds \' . $this->oCRNRSTN->get_disk_performance_metric(\'maximum_disk_use\') . \'% minimum allocation of free space. File write [\' . $tmp_filepath . \'] stopped. CRNRSTN :: is configured to stop file writes when allocation of free space on disk exceeds specified limits.\', \'Image Processing.\', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
    
    throw new Exception(\'WARNING. Disk space exceeds \' . $this->oCRNRSTN->get_disk_performance_metric(\'maximum_disk_use\') . \'% minimum allocation of free space. File write [\' . $tmp_filepath . \'] stopped. CRNRSTN :: is configured to stop file writes when allocation of free space on disk exceeds specified limits.\');

}';
$oCRNRSTN->print_r($tmp_str, 'CRNRSTN :: SNIPPET FROM crnrstn_system_image_asset_manager::system_base64_write()', $tmp_theme_style_int, __LINE__, __METHOD__, __FILE__);

$tmp_str = '$_SESSION[\'CRNRSTN_\' . $this->oCRNRSTN->get_server_config_serial(\'hash\')][\'CRNRSTN_EXCEPTION_PREFIX\'] = __CLASS__ . \'::\' . __METHOD__ . \'() attempted to fopen \' . $tmp_filepath . \' after the write permissions to related to same were first chmod to \' . str_pad($mkdir_mode, \'4\', \'0\', STR_PAD_LEFT) . \'. An attempt to open was again made, but \';
if($resource_file = fopen($tmp_filepath, \'w\')){

    $_SESSION[\'CRNRSTN_\'. $this->oCRNRSTN->get_server_config_serial(\'hash\')][\'CRNRSTN_EXCEPTION_PREFIX\'] = \'\';

    fwrite($resource_file, $tmp_data_str_out);
    fclose($resource_file);

    $this->oCRNRSTN->error_log(\'Success. System write of BASE64 file is complete. File: \' . $tmp_filename . \'.\', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

}';

$oCRNRSTN->print_r($tmp_str, 'CRNRSTN :: SNIPPET FROM crnrstn_system_image_asset_manager::system_base64_write()', $tmp_theme_style_int, __LINE__, __METHOD__, __FILE__);


$oCRNRSTN->print_r('$oCRNRSTN->print_r(\'Output content.\', NULL, CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);', '$oCRNRSTN->print_r()', $tmp_theme_style_int, __LINE__, __METHOD__, __FILE__);

$oCRNRSTN->print_r('$tmp_str = $oCRNRSTN->print_r_str(\'Output content.\', \'Output title.\', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);', '$oCRNRSTN->print_r_str()', $tmp_theme_style_int, __LINE__, __METHOD__, __FILE__);

$oCRNRSTN->print_r('$oCRNRSTN->error_log(\'Output content.\', __LINE__, __METHOD__, __FILE__, INT_CONSTANT_LOG_SILO);', '$oCRNRSTN->error_log()', $tmp_theme_style_int, __LINE__, __METHOD__, __FILE__);

$oCRNRSTN->print_r('echo $oCRNRSTN->return_system_image(\'CRNRSTN_LOGO\', \'\', 1000, \'http://jony5.com/\', \'J5 MY BOY!\', \'title text\', \'_blank\', CRNRSTN_UI_IMG_HTML_WRAPPED);', '$oCRNRSTN->return_system_image()',$tmp_theme_style_int, __LINE__, __METHOD__, __FILE__);

$oCRNRSTN->print_r('echo $oCRNRSTN->return_youtube_embed(\'https://www.youtube.com/watch?v=NePb9UWK8Yg\', 560, 315, true);', '$oCRNRSTN->return_youtube_embed()',$tmp_theme_style_int, __LINE__, __METHOD__, __FILE__);

$oCRNRSTN->print_r('$oCRNRSTN->get_resource(\'DOCUMENT_ROOT\')', '$oCRNRSTN->get_resource()', $tmp_theme_style_int, __LINE__, __METHOD__, __FILE__);

//$oCRNRSTN->system_base64_synchronize();
//$oCRNRSTN->system_base64_synchronize('CRNRSTN_LOGO');
$oCRNRSTN->system_base64_integrate(CRNRSTN_ROOT . '/_crnrstn/demo/common/imgs/j5_my_boy/_thumb/', 5);

//
// SEND -1 AS $char_selection FOR USE OF *ALL* CHARACTERS IN RANDOM KEY
// GENERATION...ALL EXCEPT THE SEQUENCE \e ESCAPE KEY (ESC or 0x1B (27) in
// ASCII) AND NOT SPLITTING HAIRS CHOOSING BETWEEN SEQUENCE \n LINEFEED (LF or
// 0x0A (10) in ASCII) AND THE SEQUENCE \r CARRIAGE RETURN (CR or 0x0D
// (13) in ASCII)...AND ALSO SCREW BOTH \f FORM FEED (FF or 0x0C (12)
// in ASCII) AND \v VERTICAL TAB (VT or 0x0B (11) in ASCII) SEQUENCES.
//
// ALSO, CHECK OUT $char_selection=-2, AND $char_selection=-3.
// $char_selection=-3 IS THE NICEST(NO: QUOTES, COMMAS,...ETC.)...WITH
// THE MOST DISTINCT NUMBER OF CHARACTERS FOR A SERIAL, IMHO.
//
// https://www.php.net/manual/en/language.types.string.php#language.types.string.syntax.double

//return $this->oCRNRSTN->generate_new_key($len, $char_selection);


//echo $oCRNRSTN->return_system_image('CRNRSTN_LOGO', '', 1000, 'http://jony5.com/', 'J5 MY BOY!', 'AWESOME!', '_blank', CRNRSTN_UI_IMG_HTML_WRAPPED);

?>

<div class="crnrstn_cb_200"></div>
<?php
//
//echo '
//
//    <div style="text-align: left; font-family:Courier New, Courier, monospace; font-size:15px; line-height:23px; border-bottom: 0px solid #FFF;">//
//        <br>// ' . $oCRNRSTN->multi_lang_content_return('PLEASE_ENTER_A_CONFIG_SERIAL') . '
//        <br>// ' . $oCRNRSTN->multi_lang_content_return('FOR_REFERENCE_PLEASE_SEE') . ' ' . CRNRSTN_ROOT . '/_crnrstn.config.inc.php [lnum 141].' . '
//        <br>$CRNRSTN_config_serial = \'' . $oCRNRSTN->generate_new_key(64, -3) . '\';
//        <br>// <a href="#"  style="font-family:Courier New, Courier, monospace; color: #0066CC;">' . $oCRNRSTN->multi_lang_content_return('CLICK_HERE') . '</a> to copy the 64 ' . $oCRNRSTN->multi_lang_content_return('TO_COPY_THE_CHAR_SERIAL_TO_CLIPBOARD') . '.
//        <br>
//
//    </div>
//
//    <div class="crnrstn_cb_5"></div>
//    <div style="text-align: left; font-family:Courier New, Courier, monospace; font-size:15px; line-height:23px; border-bottom: 0px solid #FFF;">[' . $oCRNRSTN->return_micro_time() . '] [rtime ' . $oCRNRSTN->wall_time() .' secs]</div>';

?>
<!---->
<!--<div id="crnrstn_curl_data_storage" style="padding:0 10px 10px 20px; width:810px;">-->
<!---->
<!--    <div style="font-weight: bold; font-size: 25px; padding: 10px 0 0 0; color: #333;">C<span class="the_R_in_crnrstn">R</span>NRSTN ::</div>-->
<!--    <div class="crnrstn_cb"></div>-->
<!--    <div style="font-size: 11px; font-weight: normal; padding: 5px 0 0 0; color: #5c5c5c;">-->
<!--        --><?php
//        echo $oCRNRSTN->proper_version('LINUX') .
//            ', ' . $oCRNRSTN->proper_version('APACHE') .
//            ', ' . $oCRNRSTN->proper_version('MYSQLI') .
//            ', ' . $oCRNRSTN->proper_version('PHP') .
//            ', ' . $oCRNRSTN->proper_version('OPENSSL') .
//            ', ' . $oCRNRSTN->proper_version('SOAP') .
//            ', C<span class="the_R_in_crnrstn">R</span>NRSTN :: v' . $oCRNRSTN->version_crnrstn(); ?>
<!--    </div>-->
<!---->
<!--    <div class="crnrstn_cb_10"></div>-->
<!--    <div style="text-align:left; background-color: #04050A; border: 3px solid #9F9393; width: 780px; height: 379px; overflow: scroll; padding: 15px 20px 15px 20px;">-->
<!---->
<!--        <div class="crnrstn_log_entry">Private key encrypted data:</div>-->
<!--        <div class="crnrstn_log_entry" style="width: 758px; overflow: scroll;">-->
<!--            <div style="width: 800px;">1234567890</div>-->
<!--        </div>-->
<!--        <div class="crnrstn_cb_15"></div>-->
<!---->
<!--        ?>-->
<!--    </div>-->
<!---->
<!--</div>-->
<!---->
<!--<div class="crnrstn_cb_15"></div>-->
<!---->
<!--<form action="#" method="post" name="curl" id="curl"  enctype="multipart/form-data">-->
<!---->
<!--    --><?php
//    //echo $oCRNRSTN->ui_content_module_out(CRNRSTN_UI_FORM_INTEGRATION_PACKET, 'curl');
//    ?>
<!--</form>-->

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