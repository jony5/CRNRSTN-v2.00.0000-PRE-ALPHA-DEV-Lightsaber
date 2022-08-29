<?php

/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

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

$oCRNRSTN->print_r('LOAD ASSET[' . $data_type_constant . ']['.print_r(self::$image_filesystem_meta_ARRAY, true).'].', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
$oCRNRSTN->error_log('Failure opening [' . $tmp_filename . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

*/

//
// FORMATTING NUMBERS WITH CRNRSTN ::

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
        .the_R_in_crnrstn                           { color:#F90000; }
        .crnrstn_logo_wrapper                       { padding: 15px 0 20px 15px; }

        .crnrstn_activity_log                       { opacity: 0; }
        .crnrstn_log_output_wrapper                 { background-color:#04050A; border:3px solid #9F9393; padding:10px; margin:10px 10px 0 0; width:800px; height:190px; overflow:scroll;}
        .crnrstn_log_output                         { width:2000px; }
        .crnrstn_log_entry                          { display:block; clear:both; text-align: left; color:#7AF94F; font-size:12px; font-family: "Courier New", Courier, monospace; }
        .crnrstn_j5_wolf_pup_outter_wrap            { float:right; padding:420px 0 0 0; margin:0; width:100%;}
        .crnrstn_j5_wolf_pup_inner_wrap             { position: absolute; width:98%; z-index: 2; text-align: right; padding-top: 20px;}
        .crnrstn_signin_copyright_shell             { width:578px; text-align: center; margin:0 auto; font-size: 12px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; color: #333;}
        .crnrstn_signin_copyright_shell a           { text-decoration:none; color: #0066CC; text-decoration:underline;}

    </style>
</head>
<body>
<div class="crnrstn_logo_wrapper"><img src="<?php echo $oCRNRSTN->return_creative('BG_ELEMENT_LOGO_SIGNIN', CRNRSTN_UI_IMG_BASE64_PNG); ?>" height="70" alt="CRNRSTN :: v<?php echo $oCRNRSTN->version_crnrstn(); ?>" title="CRNRSTN :: v<?php echo $oCRNRSTN->version_crnrstn(); ?>" ></div>

<?php

$oCRNRSTN->print_r('$oCRNRSTN->print_r(\'Output content.\', \'Output title.\', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);', '$oCRNRSTN->print_r()', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
$oCRNRSTN->print_r('$oCRNRSTN->error_log(\'Output content.\', __LINE__, __METHOD__, __FILE__, INT_CONSTANT);', '$oCRNRSTN->error_log()', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

?>

<div class="crnrstn_cb_200"></div>
<?php
//
//echo '
//
//    <div style="text-align: left; font-family:Courier New, Courier, monospace; font-size:15px; line-height:23px; border-bottom: 0px solid #FFF;">//
//        <br>// ' . $oCRNRSTN->oCRNRSTN_LANG_MGR->get_lang_copy('PLEASE_ENTER_A_CONFIG_SERIAL') . '
//        <br>// ' . $oCRNRSTN->oCRNRSTN_LANG_MGR->get_lang_copy('FOR_REFERENCE_PLEASE_SEE') . ' ' . CRNRSTN_ROOT . '/_crnrstn.config.inc.php [lnum 141].' . '
//        <br>$CRNRSTN_config_serial = \'' . $oCRNRSTN->generate_new_key(64, -3) . '\';
//        <br>// <a href="#"  style="font-family:Courier New, Courier, monospace; color: #0066CC;">' . $oCRNRSTN->oCRNRSTN_LANG_MGR->get_lang_copy('CLICK_HERE') . '</a> to copy the 64 ' . $oCRNRSTN->oCRNRSTN_LANG_MGR->get_lang_copy('TO_COPY_THE_CHAR_SERIAL_TO_CLIPBOARD') . '.
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

<div class="crnrstn_signin_copyright_shell">&copy; 2012-<?php echo date('Y'); ?> Jonathan 'J5' Harris :: <?php echo $oCRNRSTN->get_lang_copy('COPY_ALL_RIGHTS_PART1') . '<br>' . $oCRNRSTN->get_lang_copy('COPY_ALL_RIGHTS_PART2'); ?> <a href="./?crnrstn_mit=true" target="_self"><?php echo $oCRNRSTN->get_lang_copy('COPY_ALL_RIGHTS_PART_MIT'); ?></a>.</div>

<div style="width:700px;">
    <div class="crnrstn_j5_wolf_pup_outter_wrap">
        <div class="crnrstn_j5_wolf_pup_inner_wrap">
            <?php
            echo $oCRNRSTN->return_creative('J5_WOLF_PUP_RAND', CRNRSTN_UI_IMG_BASE64_PNG_HTML_WRAPPED);
            ?>
        </div>
    </div>
</div>

<?php

//echo $oCRNRSTN->ui_content_module_out(CRNRSTN_UI_SOAP_DATA_TUNNEL);
//echo $oCRNRSTN->ui_content_module_out(CRNRSTN_UI_INTERACT);

?>
</body>
</html>