<?php

/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

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
        body                                        { padding: 0;  margin: 0;}
        .the_R_in_crnrstn                           { color:#F90000; }
        .crnrstn_logo_wrapper                       { padding: 15px 0 20px 15px; }

        .crnrstn_j5_wolf_pup_outter_wrap            { float:right; padding:420px 0 0 0; margin:0; width:100%;}
        .crnrstn_j5_wolf_pup_inner_wrap             { position: absolute; width:98%; z-index: 2; text-align: right; padding-top: 20px;}
        .crnrstn_signin_copyright_shell             { width:578px; text-align: center; margin:0 auto; font-size: 12px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; color: #333;}
        .crnrstn_signin_copyright_shell a           { text-decoration:none; color: #0066CC; text-decoration:underline;}

    </style>
</head>
<body>
<div>

    <div class="crnrstn_logo_wrapper"><img src="<?php echo $oCRNRSTN->return_creative('CRNRSTN_LOGO', CRNRSTN_UI_IMG_BASE64_PNG); ?>" height="70" alt="CRNRSTN :: v<?php echo $oCRNRSTN->version_crnrstn(); ?>" title="CRNRSTN :: v<?php echo $oCRNRSTN->version_crnrstn(); ?>"></div>

    <?php
    $tmp_data = 'This is an OpenSSL encryption test. Please repeat to confirm.';
    //$oCRNRSTN->print_r('$oCRNRSTN->error_log(\'Output content.\', __LINE__, __METHOD__, __FILE__, INT_CONSTANT_LOG_SILO);', '$oCRNRSTN->error_log()', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
    $tmp_encrypted_data = $oCRNRSTN->data_encrypt($tmp_data);
    $tmp_decrypted_output = $oCRNRSTN->data_decrypt($tmp_encrypted_data);

    $oCRNRSTN->print_r('$tmp_decrypt_output=[' . $tmp_decrypted_output . '] $tmp_encrypted_data=[' . $tmp_encrypted_data . '].', 'OpenSSL Integrations Testing',CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

    //$oCRNRSTN->print_r('$oCRNRSTN->error_log(\'Output content.\', __LINE__, __METHOD__, __FILE__, INT_CONSTANT_LOG_SILO);', '$oCRNRSTN->error_log()', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

    ?>
    <div class="crnrstn_cb_100"></div>
    <div class="crnrstn_signin_copyright_shell">&copy; 2012-<?php echo date('Y'); ?> Jonathan 'J5' Harris :: <?php echo $oCRNRSTN->multi_lang_content_return('COPY_ALL_RIGHTS_PART1') . '<br>' . $oCRNRSTN->multi_lang_content_return('COPY_ALL_RIGHTS_PART2'); ?> <a id="crnrstn_txt_lnk_mit" href="#" target="_self" onclick="oCRNRSTN_JS.crnrstn_interact_ui_ux('onclick', this);"><?php echo $oCRNRSTN->multi_lang_content_return('COPY_ALL_RIGHTS_PART_MIT'); ?></a>.</div>
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

    echo $oCRNRSTN->framework_integrations_client_packet(CRNRSTN_RESOURCE_DOCUMENTATION);
    //echo $oCRNRSTN->framework_integrations_client_packet();
    ?>

</div>
</body>
</html>