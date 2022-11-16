<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

$oCRNRSTN->framework_integrations_client_packet(CRNRSTN_RESOURCE_DOCUMENTATION, true);

?>
<!doctype html>
<html lang="<?php echo $oCRNRSTN->country_iso_code(); ?>">
<head>
    <title>CRNRSTN :: v<?php echo $oCRNRSTN->version_crnrstn(); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <?php echo $oCRNRSTN->return_creative('CRNRSTN_FAVICON', CRNRSTN_UI_IMG_HTML_WRAPPED) . '
        ' . $oCRNRSTN->ui_content_module_out(CRNRSTN_UI_JS_JQUERY_UI) . '
        ' . $oCRNRSTN->ui_content_module_out(CRNRSTN_UI_CSS_MAIN_DESKTOP & CRNRSTN_UI_JS_MAIN_DESKTOP);
    ?>
</head>
<body>
<div class="crnrstn_system_default_page_wrapper">
    <div class="crnrstn_system_default_page_logo"><?php echo $oCRNRSTN->return_system_image('CRNRSTN_LOGO', '', 70, NULL, NULL, NULL, NULL, CRNRSTN_UI_IMG_HTML_WRAPPED); ?></div>

    <div class="crnrstn_general_content_title">
        <h2>C<span class="the_R_in_crnrstn">R</span>NRSTN :: version <?php echo $oCRNRSTN->version_crnrstn(); ?></h2>
    </div>
    <p>Welcome to C<span class="the_R_in_crnrstn">R</span>NRSTN ::.<br><br>This is the intro demo page for a vanilla install.</p>
    <div class="crnrstn_cb_40"></div>
    <div class="crnrstn_general_content_title">
        <h3>Demonstration ::</h3>
        <p>Pulling custom data out of the system resource configuration *file:</p>
        <div class="crnrstn_cb_5"></div>
        <div class="crnrstn_cb_10" style="border-top: 3px solid #000; width: 70%;"></div>
    </div>
    <div style="padding:0 0 20px 20px; font-family: Courier New, Courier, monospace;"><strong>WETHRBUG_APP</strong> = <?php echo $oCRNRSTN->get_resource('WETHRBUG_APP'); ?></div>
    <p>* <em>'/_crnrstn/_config/config.system_resource.secure/_crnrstn.system_resource.inc.php'</em></p>

    <div class="crnrstn_cb_40"></div>
    <div class="crnrstn_general_content_title">
        <h3>Recent Activity ::</h3>
        <p>For now, current activity related to the direction of the project will be posted here:</p>
        <div class="crnrstn_cb_5"></div>
        <div class="crnrstn_cb_10" style="border-top: 3px solid #000; width: 70%;"></div>
    </div>
    <div class="crnrstn_general_post_log_shell">
        <ul>
            <li><p style="font-family: Courier New, Courier, monospace; font-size: 13px; color: #333;">There are currently no posts to display.</p></li>

        </ul>

    </div>

    <div class="crnrstn_cb_40"></div>
    <div>
        <div style="float: left; padding: 15px 20px 0 0;">
            <p>Check out the C<span class="the_R_in_crnrstn">R</span>NRSTN :: v1.0.0 <a href="<?php echo $oCRNRSTN->return_sticky_link('https://www.facebook.com/media/set/?set=a.10152398953669503.1073741836.586549502&type=1&l=4ba17e313a','crnrstn_photo_album_facebook'); ?>" target="_blank" style="text-decoration:none; color: #0066CC; text-decoration:underline;">Facebook</a> photo album!</p>
        </div>
        <div style="float: left;">
            <?php
            echo $oCRNRSTN->return_sticky_media_link('FACEBOOK_MEDIUM', 'https://www.facebook.com/media/set/?set=a.10152398953669503.1073741836.586549502&type=1&l=4ba17e313a');
            ?>
        </div>
    </div>

    <div class="crnrstn_cb_20"></div>
    <pre style="font-size:10px; height:200px; overflow:hidden; padding:0;"><?php echo $oCRNRSTN->return_CRNRSTN_ASCII_ART();  ?></pre>

</div>

<div class="crnrstn_cb_20"></div>
<div class="crnrstn_general_copyright_shell">&copy; 2012-<?php echo date('Y'); ?> Jonathan 'J5' Harris :: All Rights Reserved in accordance with<br>the latest version of the <a id="crnrstn_general_mit_lnk" href="#" onclick="oCRNRSTN_JS.crnrstn_interact_ui_ux('onclick', this); return false;" target="_self">MIT License</a>.</div>

<div class="crnrstn_cb_40"></div>
<div id="crnrstn_j5_wolf_pup_outter_wrap" class="crnrstn_j5_wolf_pup_outter_wrap">
    <div id="crnrstn_j5_wolf_pup_inner_wrap" class="crnrstn_j5_wolf_pup_inner_wrap">
        <?php echo $oCRNRSTN->return_creative('J5_WOLF_PUP_RAND', CRNRSTN_UI_IMG_HTML_WRAPPED); ?>
    </div>
</div>

<?php 
    echo  $oCRNRSTN->framework_integrations_client_packet(); 
?>
</body>
</html>