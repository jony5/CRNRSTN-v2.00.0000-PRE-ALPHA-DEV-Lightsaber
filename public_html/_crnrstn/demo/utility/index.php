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
        //$this->oCRNRSTN->print_r('LOAD ASSET[' . $data_type_constant . ']['.print_r(self::$image_filesystem_meta_ARRAY, true).'].', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
                        $this->oCRNRSTN->error_log('Failure opening [' . $tmp_filename . '] for inclusion. Attempting to repair the BASE64 file system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

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
<body>

<div id="crnrstn_curl_data_storage" style="padding:0 10px 10px 20px; width:810px;">

    <div style="font-weight: bold; font-size: 25px; padding: 10px 0 0 0; color: #FFF;">C<span class="the_R_in_crnrstn">R</span>NRSTN :: UI Interact Button Events UX Laboratory</div>
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

            //echo '<img src="' . $oCRNRSTN->return_creative('MYSQL_DOLPHIN', CRNRSTN_UI_IMG_BASE64) .'" height="100" >';

            echo '<div style="float: right;"><img src="' . $oCRNRSTN->return_creative('REDHAT_LOGO', CRNRSTN_UI_IMG_BASE64) . '" width="103" ></div><div class="crnrstn_cb_10" style="border-bottom: 2px solid #dbdbdb;"></div>';
            echo '<div class="crnrstn_cb_30"></div>';

            echo '<div style="font-weight: bold; font-size: 20px;">Web ::</div><div class="crnrstn_cb"></div>';
            echo 'Here is the small (26px height) social media sticky link: ' . $oCRNRSTN->return_icon_social_link('SOUNDCLOUD_SMALL', 'https://soundcloud.com/jonathan-harris-772368100');
            echo '<div class="crnrstn_cb"></div>Here is the medium (50px height) social media sticky link: ' . $oCRNRSTN->return_icon_social_link('SOUNDCLOUD_MEDIUM', 'https://soundcloud.com/jonathan-harris-772368100');
            echo '<div class="crnrstn_cb"></div>Here is the large (76px height) social media sticky link: ' . $oCRNRSTN->return_icon_social_link('SOUNDCLOUD_LARGE', 'https://soundcloud.com/jonathan-harris-772368100');

            echo '<div class="crnrstn_cb_30"></div>';

            echo '<div style="font-weight: bold; font-size: 20px;">Email ::</div><div class="crnrstn_cb"></div>';
            echo 'Here is the small (26px height) social media sticky link: ' . $oCRNRSTN->return_icon_social_link('SOUNDCLOUD_SMALL', 'https://soundcloud.com/jonathan-harris-772368100', '_blank', true);
            echo '<div class="crnrstn_cb"></div>Here is the medium (50px height) social media sticky link: ' . $oCRNRSTN->return_icon_social_link('SOUNDCLOUD_MEDIUM', 'https://soundcloud.com/jonathan-harris-772368100', '_blank', true);
            echo '<div class="crnrstn_cb"></div>Here is the large (76px height) social media sticky link: ' . $oCRNRSTN->return_icon_social_link('SOUNDCLOUD_LARGE', 'https://soundcloud.com/jonathan-harris-772368100', '_blank', true);

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

        // LJHigh
        // 2875768619
        $tmp_SOCIAL_ID = $oCRNRSTN->generate_new_key(64);

        echo '<div class="crnrstn_cb_10"></div>';
        echo '<div class="crnrstn_log_entry">';
        echo $oCRNRSTN->return_micro_time();
        echo '</div>';

        echo '<div class="crnrstn_cb_10"></div>';
        echo '<div class="crnrstn_log_entry">SOCIAL_ID 0 [' . $tmp_SOCIAL_ID . '][<input type="checkbox" style="width: 20px;">]';
        echo '</div>';

        echo '<div class="crnrstn_cb_10"></div>';
        echo '<div class="crnrstn_log_entry">SOCIAL_ID_CRC 0 [' . $oCRNRSTN->crcINT($tmp_SOCIAL_ID) . ']';
        echo '</div>';

        $tmp_SOCIAL_ID = $oCRNRSTN->generate_new_key(64);

        echo '<div class="crnrstn_cb_10"></div>';
        echo '<div class="crnrstn_log_entry">SOCIAL_ID 1 [' . $tmp_SOCIAL_ID . '][<input type="checkbox" style="width: 20px;">]';
        echo '</div>';

        echo '<div class="crnrstn_cb_10"></div>';
        echo '<div class="crnrstn_log_entry">SOCIAL_ID_CRC 1 [' . $oCRNRSTN->crcINT($tmp_SOCIAL_ID) . ']';
        echo '</div>';

        echo '<div class="crnrstn_cb_10"></div>';
        echo '<div class="crnrstn_log_entry">SOCIAL_MEDIA_KEY :: [profile][1300][' . $oCRNRSTN->crcINT('profile') . ']';
        echo '</div>';

        echo '<div class="crnrstn_cb_10"></div>';
        echo '<div class="crnrstn_log_entry">SOCIAL_MEDIA_KEY :: [archives][1400][' . $oCRNRSTN->crcINT('archives') . ']';
        echo '</div>';

        ?>
    </div>

</div>

<div class="crnrstn_cb_15"></div>

<form action="#" method="post" name="curl" id="curl"  enctype="multipart/form-data">

    <?php
    echo $oCRNRSTN->ui_content_module_out(CRNRSTN_UI_FORM_INTEGRATION_PACKET, 'curl');
    ?>
</form>

<div class="crnrstn_signin_copyright_shell">&copy; 2012-<?php echo date('Y'); ?> Jonathan 'J5' Harris :: <?php echo $oCRNRSTN->get_lang_copy('COPY_ALL_RIGHTS_PART1') . '<br>' . $oCRNRSTN->get_lang_copy('COPY_ALL_RIGHTS_PART2'); ?> <a href="<?php echo $tmp_http_root; ?>&crnrstn_mit=true" target="_self"><?php echo $oCRNRSTN->get_lang_copy('COPY_ALL_RIGHTS_PART_MIT'); ?></a>.</div>

<div style="width:700px;">
    <div class="crnrstn_j5_wolf_pup_outter_wrap">
        <div class="crnrstn_j5_wolf_pup_inner_wrap">
            <?php
            echo $oCRNRSTN->return_creative('J5_WOLF_PUP_RAND');
            ?>
        </div>
    </div>
</div>

<?php

echo $oCRNRSTN->ui_content_module_out(CRNRSTN_UI_SOAP_DATA_TUNNEL);
echo $oCRNRSTN->ui_content_module_out(CRNRSTN_UI_INTERACT);

?>
</body>
</html>