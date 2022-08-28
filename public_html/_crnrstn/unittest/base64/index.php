<?php

/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

$oCRNRSTN->system_base64_synchronize('success_chk');

//
// THIS WILL SYNC ALL (~120 IMAGE) BASE64 FILES WITH THE CURRENT PNG AND JPEG (~33 SECS).
//$oCRNRSTN->system_base64_synchronize();

//$DOCUMENT_ROOT = $oCRNRSTN->get_resource('DOCUMENT_ROOT');
//$DOCUMENT_ROOT_DIR = $oCRNRSTN->get_resource('DOCUMENT_ROOT_DIR');
//$oCRNRSTN->system_base64_synchronize('elem_shadow_btm.png');

//$oCRNRSTN->print_r('System image processing using the params "run" and "auth_id".', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
echo  '<div style="padding: 40px;">' . $oCRNRSTN->return_creative('SUCCESS_CHECK', CRNRSTN_UI_IMG_BASE64_PNG_HTML_WRAPPED) . '</div>';
//echo  $oCRNRSTN->return_creative('SUCCESS_CHECK', CRNRSTN_UI_IMG_BASE64_PNG_HTML_WRAPPED);
//echo '<img src="' . $oCRNRSTN->return_creative('SUCCESS_CHECK', CRNRSTN_UI_IMG_PNG) . '" width="100" height="100">';

die();

//$oCRNRSTN->system_base64_synchronize('success_chk.png');
//$oCRNRSTN->system_base64_synchronize('success_chk');
//$oCRNRSTN->system_base64_synchronize('success_chk.jpg');
//$oCRNRSTN->system_base64_synchronize('success_chk.RREWE.RERR.RERW.jpeg');
//$oCRNRSTN->system_base64_synchronize('SUCCESS_CHECK');
//$oCRNRSTN->system_base64_synchronize('err_x');
//$oCRNRSTN->system_base64_synchronize('success_chk.jpg2');

//
// BASE64 IMAGE HELPER where, ?crnrstn_to_base64=imgs/png/j5_wolf_pup_lil_5_pts.png
//if($tmp_html = $oCRNRSTN->base64_asset_path_listener()){
//
//    return $tmp_html;
//
//}

$oCRNRSTN->init_form_handling('crnrstn_image_to_encode');

if($oCRNRSTN->initialize_crnrstn_svc_http(true, false)) {

    $oCRNRSTN->error_log('System is initialized to received form data.]', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

    if($oCRNRSTN->isset_crnrstn_svc_http()) {

        $oCRNRSTN->error_log('CRNRSTN :: POST DATA PACKET HAS BEEN RECEIVED.]', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        $oCRNRSTN->error_log('CRNRSTN :: checking base64 on [' . $oCRNRSTN->return_http_form_integration_input_val('crnrstn_image_to_process_name') . ']', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

    }else{

        $oCRNRSTN->error_log('CRNRSTN :: POST DATA PACKET HAS NOT BEEN RECEIVED.]', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

    }

}

$oCRNRSTN->init_input_listener('crnrstn_image_to_encode', 'crnrstn_resource_filecache_version_php', false);
$oCRNRSTN->init_input_listener('crnrstn_image_to_encode', 'crnrstn_resource_filecache_version_png', false);
$oCRNRSTN->init_input_listener('crnrstn_image_to_encode', 'crnrstn_resource_filecache_version_jpg', false);

?>
<!DOCTYPE html>
<html lang="<?php echo $oCRNRSTN->country_iso_code(); ?>">
<head>
<title>CRNRSTN :: <?php echo $oCRNRSTN->version_crnrstn(); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php echo $oCRNRSTN->return_creative('CRNRSTN_FAVICON'); ?>
<?php echo $oCRNRSTN->ui_content_module_out(CRNRSTN_UI_JS_JQUERY) .
    $oCRNRSTN->ui_content_module_out(CRNRSTN_UI_JS_JQUERY_UI); ?>
<style type="text/css">

    body                                        { }
    p                                           { padding:10px 0 0 20px; font-size: 18px;}
    .debug_output				                { font-size:10px; height:200px; overflow:scroll; padding:10px 0 0 20px;}

    .the_R_in_crnrstn                           { color:#F90000; }

    .crnrstn_activity_log                       { opacity: 0; }
    .crnrstn_log_output_wrapper                 { background-color:#04050A; border:3px solid #9F9393; padding:10px; margin:10px 10px 0 0; width:800px; height:190px; overflow:scroll;}
    .crnrstn_log_output                         { width:2000px; }
    .crnrstn_log_entry                          { display:block; clear:both; text-align: left; color:#7AF94F; font-size:12px; font-family: "Courier New", Courier, monospace; line-height: 17px; }

    .crnrstn_j5_wolf_pup_outter_wrap            { float:right; padding:200px 0 0 0; margin:0; width:100%;}
    .crnrstn_j5_wolf_pup_inner_wrap             { position: absolute; width:100%; z-index: 2; text-align: right; padding-top: 20px;}
    .crnrstn_signin_copyright_shell             { width:578px; text-align: center; margin:0 auto; font-size: 12px; line-height: 18px; color: #666;}
    .crnrstn_signin_copyright_shell a           { text-decoration:none; color: #0066CC; text-decoration:underline;}

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

</style>
<script>

    function copy_base64_output() {

        //
        // SOURCE :: https://stackoverflow.com/questions/1173194/select-all-div-text-with-single-mouse-click
        // AUTHOR :: Denis Sadowski :: https://stackoverflow.com/users/136482/denis-sadowski
        if (document.selection) { // IE

            var range = document.body.createTextRange();
            range.moveToElementText(document.getElementById("base64_encoding"));
            range.select();

        } else if (window.getSelection) {

            var range = document.createRange();
            range.selectNode(document.getElementById("base64_encoding"));
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);

        }

        //
        // SOURCE :: https://www.w3schools.com/howto/howto_js_copy_clipboard.asp
        /* Copy the text inside the text field */
        document.execCommand('copy');

        /* Alert the copied text */
        alert("Copied the text: " + $('#base64_encoding').html());

    }

</script>
</head>
<body>
<div style="text-align: center; margin:0px auto;">
    <div class="crnrstn_cb_20"></div>
    <div style="padding:0 0 5px 0; width: 523px; text-align: center; margin: 0 auto;">
        <div style="text-align: right; font-family: Arial, Helvetica, sans-serif;">
            <a href="#" onclick="<?php echo $oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . '?' . $oCRNRSTN->get_resource('CRNRSTN_SYSTEM_DATA_GET') . '=' . $oCRNRSTN->data_encrypt($oCRNRSTN->return_http_form_integration_input_val('crnrstn_image_to_process_name')); ?>" style="color: #06C; float: left;">Refresh base64</a>
            <a href="#" onclick="<?php echo $oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . '?' . $oCRNRSTN->get_resource('CRNRSTN_SYSTEM_DATA_GET') . '=' . $oCRNRSTN->data_encrypt($oCRNRSTN->return_http_form_integration_input_val('crnrstn_image_to_process_name')); ?>" style="color: #06C; float: left; padding: 0 0 0 20px;">Refresh jpg</a>
            <a href="#" onclick="copy_base64_output();" style="color: #06C; text-align: right;">Copy to clipboard</a>
        </div>
    </div>

    <div style="text-align:center; margin: 0 auto; background-color: #04050A; border: 3px solid #9F9393; width: 520px;padding: 15px 0 0 0;">

        <div class="crnrstn_log_entry" style="border-bottom: 2px solid #F90000;">

            <div style="float: right; padding: 2px 20px 10px 0;"><img src="<?php echo $oCRNRSTN->return_creative('CRNRSTN_R_LG', CRNRSTN_UI_IMG_BASE64);  ?>" width="22" height="30" alt="R" title="CRNRSTN :: v<?php echo $oCRNRSTN->version_crnrstn(); ?>"></div>
            <div class="crnrstn_cb"></div>

        </div>

        <div style="padding:0 20px 0 20px;">

            <div style="height: 170px; overflow: scroll;">

                <div id="base64_encoding" class="crnrstn_log_entry" style="overflow-wrap: break-word; padding: 4px 0 0 0; width: 100%;"><?php

                    $tmp_base64_encoding = 'Database encrypt(\'STATUS 200\')<br>';
                    $tmp_base64_encoding .= $oCRNRSTN->data_encrypt('STATUS 200', CRNRSTN_ENCRYPT_DATABASE);
                    $tmp_base64_encoding .= '<br>--<br><br>';
                    $tmp_base64_encoding = 'Tunnel encrypt(\'STATUS 200\')<br>';
                    $tmp_base64_encoding .= $oCRNRSTN->data_encrypt('STATUS 200');
                    $tmp_base64_encoding .= '<br>--<br><br>';

//                    if($oCRNRSTN->isset_encryption(CRNRSTN_ENCRYPT_TUNNEL)){
//
//                        $tmp_filename = $oCRNRSTN->return_http_form_integration_input_val('crnrstn_image_to_process_name');
//
//                        if(strlen($tmp_filename) > 0){
//
//                            $tmp_base64_encoding = $oCRNRSTN->encode_image($tmp_filename);
//                            //echo $tmp_base64_encoding;
//
//                        }
//
//                    }

                    echo $tmp_base64_encoding;

                    ?></div>

            </div>

        </div>

        <div class="crnrstn_log_entry" style="height: 50px; border-top: 2px solid #FFF; padding: 0 20px 0 20px; ">

            <div class="crnrstn_cb_20"></div>
            <div style="float: left;"><?php echo $oCRNRSTN->wall_time(); ?> seconds</div>
            <div style="float: right; padding: 0 5px 0 0;"><?php echo $oCRNRSTN->return_micro_time(); ?></div>

        </div>

    </div>
    <div style="padding:5px 0 0 0; width: 523px; text-align: center; margin: 0 auto;">
        <div style="float: left;">
            <?php echo $oCRNRSTN->return_branding_creative(false, CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED); ?>
        </div>
        <div style="float: right;">
            <span style="text-align: right; font-family: Arial, Helvetica, sans-serif;"><?php echo $oCRNRSTN->return_http_form_integration_input_val('crnrstn_image_to_process_name'); ?></span>
        </div>
        <div class="crnrstn_cb"></div>
    </div>

    <div class="crnrstn_cb_30"></div>
    <form action="./?<?php echo $oCRNRSTN->data_decrypt($oCRNRSTN->get_resource('CRNRSTN_SYSTEM_DATA_GET')); ?>=#" method="post" enctype="multipart/form-data" id="crnrstn_image_to_encode" name="crnrstn_image_to_encode" data-ajax="false">
        <div style="padding-bottom: 20px;">
            <input id="crnrstn_image_to_process_name" name="crnrstn_image_to_process_name" placeholder="<?php $oCRNRSTN->get_lang_copy('SYSTEM_IMAGE_SYNC_ENTER_JPG_PNG') ?>" value="">
        </div>

        <div style="padding-bottom: 20px;">
            <input type="file" name="crnrstn_image_to_process_file" id="crnrstn_image_to_process_file" value="">
        </div>

        <button type="submit" style="width:150px; height:30px; text-align: center; font-weight: bold;" onclick="crnrstn_validate();">ENCODE</button>
        <input type="hidden" name="fs" value="<?php echo $oCRNRSTN->generate_new_key(100, '01') ?>">
        <?php

        echo $oCRNRSTN->ui_content_module_out(CRNRSTN_UI_FORM_INTEGRATION_PACKET, 'crnrstn_image_to_encode');

        if($tmp_filename = $oCRNRSTN->return_http_form_integration_input_val('crnrstn_image_to_process_name')){

            $tmp_str_array = array();
            $tmp_found_img_ping_type = false;
            $tmp_file_path = $oCRNRSTN->get_resource('DOCUMENT_ROOT') . $oCRNRSTN->get_resource('DOCUMENT_ROOT_DIR') . '/_crnrstn/ui/imgs/png/' . $tmp_filename;

            if(is_file($tmp_file_path)){

                //
                // CHECK ELECTRUM FOR BETTER WAY TO HANDLE FILE EXT, FILE NAMING, ETC.
                $pos_png = stripos($tmp_file_path, '.png');
                if ($pos_png !== false) {

                    $tmp_found_img_ping_type = true;
                    $tmp_cache_version_png = $oCRNRSTN->resource_filecache_version(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/png/' . $tmp_filename);
                    $tmp_str_array[] = '<input type="hidden" id="crnrstn_resource_filecache_version_png" name="crnrstn_resource_filecache_version_png" value="' . $tmp_cache_version_png. '">';

                }

                $pos_jpg = stripos($tmp_file_path, '.jpg');
                $pos_jpeg = stripos($tmp_file_path, '.jpeg');
                if ($pos_jpg !== false || $pos_jpeg !== false) {

                    $tmp_found_img_ping_type = true;
                    $tmp_cache_version_jpg = $oCRNRSTN->resource_filecache_version(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/jpg/' . $tmp_filename);
                    $tmp_str_array[] = '<input type="hidden"  id="crnrstn_resource_filecache_version_jpg" name="crnrstn_resource_filecache_version_jpg" value="' . $tmp_cache_version_png . '">';

                }

                $pos_php = stripos($tmp_file_path, '.php');
                if ($pos_php !== false) {

                    $tmp_found_img_ping_type = true;
                    $tmp_cache_version_php = $oCRNRSTN->resource_filecache_version(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/' . $tmp_filename);
                    $tmp_str_array[] = '<input type="hidden"  id="crnrstn_resource_filecache_version_php" name="crnrstn_resource_filecache_version_php" value="' . $tmp_cache_version_png . '">';

                }

            }

            if(count($tmp_str_array) > 0){

                foreach($tmp_str_array as $input_array_index => $input_html){

                    echo $input_html;

                }

            }

        }

        $tmp_js = '
        <script>

            function crnrstn_validate(){

                if(crnrstn_valid_form()){

                    document.getElementById(\'crnrstn_image_to_encode\').submit();

                }

            }

            function crnrstn_valid_form(){

                if($("#crnrstn_image_to_process_name").value() != "" || $("#crnrstn_image_to_process_file").value() != "" ){

                    return true;

                }else{

                    //document.getElementById("ugc_html_content_err").style.display = \'inline\';
                    //document.getElementById("crnrstn_validate_submit").style.borderColor = "#F90000";

                    return false;

                }

            }

        </script>';

        echo $tmp_js;
        ?>

    </form>

    <div class="crnrstn_cb_20"></div>
    <div style="text-align: center; margin: 0 auto; width: 745px;">

        <pre class="debug_output" style="text-align: left;">
<?php echo $oCRNRSTN->return_CRNRSTN_ASCII_ART(8); ?>
        </pre>

    </div>

    <div class="crnrstn_cb_5"></div>

    <?php
    echo ' <img src="' . $tmp_base64_encoding . '" />';
    ?>

    <div class="crnrstn_cb_75"></div>



</div>

<div class="crnrstn_j5_wolf_pup_outter_wrap">
    <div class="crnrstn_j5_wolf_pup_inner_wrap">
        <?php
        echo $oCRNRSTN->return_creative('J5_WOLF_PUP_RAND');
        ?>
    </div>
</div>
<?php

    echo $oCRNRSTN->ui_content_module_out(CRNRSTN_UI_SOAP_DATA_TUNNEL);

?>
</body>
</html>