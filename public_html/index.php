<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

/*
CRNRSTN_CSS_FRAMEWORK_SIMPLE_GRID
CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM
CRNRSTN_CSS_FRAMEWORK_FOUNDATION
CRNRSTN_CSS_FRAMEWORK_HTML5_BOILERPLATE
CRNRSTN_CSS_FRAMEWORK_RESPONSIVE_GRID_SYSTEM
CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC
CRNRSTN_CSS_FRAMEWORK_DEAD_SIMPLE_GRID
CRNRSTN_CSS_FRAMEWORK_SKELETON
CRNRSTN_CSS_FRAMEWORK_RWDGRID
CRNRSTN_JS_FRAMEWORK_REACT
CRNRSTN_JS_FRAMEWORK_MITHRIL
CRNRSTN_JS_FRAMEWORK_PROTOTYPE
CRNRSTN_JS_FRAMEWORK_SCRIPTACULOUS
CRNRSTN_JS_FRAMEWORK_PROTOTYPE & CRNRSTN_JS_FRAMEWORK_SCRIPTACULOUS
CRNRSTN_JS_FRAMEWORK_MOOFX
CRNRSTN_JS_FRAMEWORK_BACKBONE

*/

// HTML HEAD.
// PASS TRUE TO SPOOL DESIRED CONTENT (DOCUMENTATION INCOMING) TO BE
// OUTPUTTED LATER INTO THE HTML HEAD VIA system_output_head_html()
$oCRNRSTN->system_output_head_html(CRNRSTN_UI_JS_JQUERY_UI, true);
$oCRNRSTN->system_output_head_html(CRNRSTN_UI_CSS_MAIN_DESKTOP & CRNRSTN_UI_JS_MAIN_DESKTOP, true);

// HTML FOOTER.
// PASS TRUE TO SPOOL DESIRED CONTENT (DOCUMENTATION INCOMING) TO BE
// OUTPUTTED LATER INTO THE HTML FOOTER VIA system_output_footer_html()
$oCRNRSTN->system_output_footer_html(CRNRSTN_RESOURCE_DOCUMENTATION, true);

?>
<!doctype html>
<html lang="<?php echo $oCRNRSTN->country_iso_code(); ?>">
<head>
    <title>CRNRSTN :: v<?php echo $oCRNRSTN->version_crnrstn(); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <?php echo $oCRNRSTN->return_creative('CRNRSTN_FAVICON', CRNRSTN_UI_IMG_HTML_WRAPPED); ?>
    <?php echo $oCRNRSTN->system_output_head_html(); ?>

</head>
<body>
<div class="crnrstn_system_default_page_wrapper">
    <div class="crnrstn_system_default_page_logo"><?php echo $oCRNRSTN->return_system_image('CRNRSTN_LOGO', '', 70, NULL, NULL, NULL, NULL, CRNRSTN_UI_IMG_HTML_WRAPPED); ?></div>

    <div class="crnrstn_general_content_title">
        <h2>C<span class="the_R_in_crnrstn">R</span>NRSTN :: <?php echo $oCRNRSTN->version_crnrstn(); ?></h2>
    </div>

    <p><?php echo $oCRNRSTN->multi_lang_content_return('DEFAULT_LANDING_TITLE_WELCOME'); ?>
        <br><br>
        <?php echo $oCRNRSTN->multi_lang_content_return('DEFAULT_LANDING_TITLE_DESCRIPTION'); ?>
    </p>
    <div class="crnrstn_cb_40"></div>
    <div class="crnrstn_general_content_title">
        <h3><?php echo $oCRNRSTN->multi_lang_content_return('DEFAULT_LANDING_TITLE_DEMONSTRATION'); ?></h3>
        <p><?php echo $oCRNRSTN->multi_lang_content_return('DEFAULT_LANDING_DEMONSTRATION_DESCRIPTION'); ?> <sup class="crnrstn_documentation_page_stats_sup">&dagger;</sup><?php echo $oCRNRSTN->multi_lang_content_return('DEFAULT_LANDING_TEXT_FILE'); ?>:</p>
        <div class="crnrstn_cb_5"></div>
        <div class="crnrstn_cb_10" style="border-top: 3px solid #000; width: 70%;"></div>
    </div>
    <div style="padding:0 0 20px 20px; font-family: Courier New, Courier, monospace;"><strong>WETHRBUG_APP</strong> = <?php echo $oCRNRSTN->get_resource('WETHRBUG_APP'); ?></div>

    <div class="crnrstn_general_dagger_key_shell">
        <div class="crnrstn_general_dagger_key_dag">&dagger;</div>
        <div class="crnrstn_general_dagger_key_description"><p><em><?php echo $oCRNRSTN->multi_lang_content_return('DEFAULT_LANDING_TEXT_SEE'); ?> '/_crnrstn/_config/config.system_resource.secure/_crnrstn.system_resource.inc.php'</em>.</p></div>
        <div class="crnrstn_cb"></div>

    </div>
    <div class="crnrstn_cb_40"></div>
    <div class="crnrstn_general_content_title">
        <h3><?php echo $oCRNRSTN->multi_lang_content_return('DEFAULT_LANDING_TITLE_RECENT_ACTIVITY'); ?></h3>
        <p><?php echo $oCRNRSTN->multi_lang_content_return('DEFAULT_LANDING_RECENT_ACTIVITY_DESCRIPTION'); ?></p>
        <div class="crnrstn_cb_5"></div>
        <div class="crnrstn_cb_10" style="border-top: 3px solid #000; width: 70%;"></div>
    </div>
    <div class="crnrstn_general_post_log_shell">
        <ul>
            <li><p style="font-family: Courier New, Courier, monospace; font-size: 13px; color: #333;"><?php echo $oCRNRSTN->multi_lang_content_return('DEFAULT_LANDING_RECENT_ACTIVITY_CRICKETS'); ?></p></li>

        </ul>

    </div>

    <div class="crnrstn_cb_40"></div>
    <div>
        <div style="float: left; padding: 15px 20px 0 0;">
            <p><?php echo $oCRNRSTN->multi_lang_content_return('DEFAULT_LANDING_TEXT_CHECK_OUT'); ?> <a href="<?php echo $oCRNRSTN->return_sticky_link('https://www.facebook.com/media/set/?set=a.10152398953669503.1073741836.586549502&type=1&l=4ba17e313a','crnrstn_photo_album_facebook'); ?>" target="_blank" style="text-decoration:none; color: #0066CC; text-decoration:underline;">Facebook</a> <?php echo $oCRNRSTN->multi_lang_content_return('DEFAULT_LANDING_TEXT_PHOTO_ALBUM'); ?>!</p>
        </div>
        <div style="float: left;">
            <?php
            echo $oCRNRSTN->return_sticky_media_link('FACEBOOK_MEDIUM', 'https://www.facebook.com/media/set/?set=a.10152398953669503.1073741836.586549502&type=1&l=4ba17e313a');
            ?>
        </div>
    </div>

    <div class="crnrstn_cb_20"></div>
    <pre style="font-size:10px; height:200px; overflow:hidden; padding:0;"><?php echo $oCRNRSTN->return_CRNRSTN_ASCII_ART(); ?></pre>

</div>

<div class="crnrstn_cb_20"></div>
<div class="crnrstn_general_copyright_shell">&copy; 2012-<?php echo date('Y'); ?> Jonathan 'J5' Harris :: <?php echo $oCRNRSTN->multi_lang_content_return('COPY_ALL_RIGHTS_PART1'); ?><br><?php echo $oCRNRSTN->multi_lang_content_return('COPY_ALL_RIGHTS_PART2'); ?> <a id="crnrstn_general_mit_lnk" href="#" onclick="oCRNRSTN_JS.crnrstn_interact_ui_ux('onclick', this); return false;" target="_self"><?php echo $oCRNRSTN->multi_lang_content_return('COPY_ALL_RIGHTS_PART_MIT'); ?></a>.</div>

<div class="crnrstn_cb_40"></div>
<div id="crnrstn_j5_wolf_pup_outter_wrap" class="crnrstn_j5_wolf_pup_outter_wrap">
    <div id="crnrstn_j5_wolf_pup_inner_wrap" class="crnrstn_j5_wolf_pup_inner_wrap">
        <?php echo $oCRNRSTN->return_creative('J5_WOLF_PUP_RAND', CRNRSTN_UI_IMG_HTML_WRAPPED); ?>
    </div>
</div>

<?php 
    echo $oCRNRSTN->system_output_footer_html();
?>
</body>
</html>