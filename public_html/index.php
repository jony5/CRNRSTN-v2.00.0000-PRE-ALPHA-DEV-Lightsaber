<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

//
// PASS TRUE TO SPOOL DESIRED CONTENT TO BE OUTPUTTED LATER
// INTO THE HTML FOOTER VIA system_output_footer_html()
$oCRNRSTN->system_output_footer_html(CRNRSTN_REPORT_RESPONSE_RETURN, true);
$oCRNRSTN->system_output_footer_html(CRNRSTN_RESOURCE_DOCUMENTATION, true);

//
// HEAD OUTPUT
//$oCRNRSTN->system_output_head_html(CRNRSTN_JS_FRAMEWORK_JQUERY, true, true, true);
//$oCRNRSTN->system_output_head_html(CRNRSTN_JS_FRAMEWORK_JQUERY_UI, true);

?>
<!DOCTYPE html>
<html lang="<?php echo $oCRNRSTN->iso_language_html(); ?>">
<head>
    <title>CRNRSTN :: v<?php echo $oCRNRSTN->version_crnrstn(); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <?php echo $oCRNRSTN->return_creative('CRNRSTN_FAVICON', CRNRSTN_UI_IMG_HTML_WRAPPED); ?>
    <?php echo $oCRNRSTN->system_output_head_html(); ?>
    <?php echo $oCRNRSTN->system_output_head_html(CRNRSTN_UI_CSS_MAIN_DESKTOP); ?>

</head>
<body>
<div class="crnrstn_default_landing_page_wrapper">
    <div class="crnrstn_default_landing_page_logo"><?php echo $oCRNRSTN->return_system_image('CRNRSTN_LOGO', '', 70, NULL, NULL, NULL, NULL, CRNRSTN_UI_IMG_HTML_WRAPPED); ?></div>

    <div class="crnrstn_default_landing_content_title">
        <h1>C<span class="the_R_in_crnrstn">R</span>NRSTN :: <?php echo $oCRNRSTN->version_crnrstn(); ?></h1>
    </div>

    <p><?php echo $oCRNRSTN->multi_lang_content_return('DEFAULT_LANDING_TITLE_WELCOME'); ?>
        <br><br>
        <?php echo $oCRNRSTN->multi_lang_content_return('DEFAULT_LANDING_TITLE_DESCRIPTION'); ?>

    </p>

    <div class="crnrstn_cb_40"></div>
    <div class="crnrstn_default_landing_content_title">
        <h2><?php echo $oCRNRSTN->multi_lang_content_return('DEFAULT_LANDING_TITLE_RECENT_ACTIVITY'); ?></h2>
        <p><?php echo $oCRNRSTN->multi_lang_content_return('DEFAULT_LANDING_RECENT_ACTIVITY_DESCRIPTION'); ?></p>
        <div class="crnrstn_cb_5"></div>
        <div class="crnrstn_default_landing_content_border_major"><div class="crnrstn_cb_5"></div></div>
    </div>
    <div class="crnrstn_general_post_log_shell">
        <ul>
            <!--<li><p style="font-family: Courier New, Courier, monospace; font-size: 13px; color: #333;"><?php echo $oCRNRSTN->multi_lang_content_return('DEFAULT_LANDING_RECENT_ACTIVITY_CRICKETS_CHIRPING'); ?></p></li>-->

            <li>
                <div class="crnrstn_general_post_recent_activity_shell">
                    <div class="crnrstn_general_post_recent_activity_date">Monday, November 21, 2022 @ 1003 hrs</div>
                    <div class="crnrstn_general_post_recent_activity_copy"><p>The project has received about twenty (20)
                        new system constants (integer), and these will be used to seamlessly drive planned third party
                        JS and CSS framework integrations. The current project lead is in the middle of making a rough
                        pass through all of these new resources to set them squarely on top of the asset mapping
                        architecture of C<span class="the_R_in_crnrstn">R</span>NRSTN ::. This is definitely a rough
                        pass, friends.</p>

                        <p>A second pass will need to be made in order to clear all of the 404 return responses from broken
                        library dependencies (mostly images...png, gif, jpg). As is the case with any vanilla application, a URL
                        from C<span class="the_R_in_crnrstn">R</span>NRSTN :: which points directly to any JS
                        framework's source on the server will enable that framework to access all of it's own supporting
                        assets as intended,...itself. So, for example, a JS application (running in the browser) would
                        know where to find all of it's &quot;internal&quot; images. This would be the fruit borne from
                        operating according to a more traditional approach...or (in this case) the fruit of setting
                        <span class="crnrstn_general_post_code_copy">$tunneling_active = false</span>
                        when calling <span class="crnrstn_general_post_code_copy">$oC<span class="the_R_in_crnrstn">R</span>NRSTN->config_init_asset_mapping_js()</span>.
                        </p>
                        <blockquote>On a side note...by default, <span class="crnrstn_general_post_code_copy">$tunneling_active</span>
                        is set to TRUE,...which is the lead dev's recommendation and which will eventually allow C<span class="the_R_in_crnrstn">R</span>NRSTN ::
                        to do some pretty cool shit like bind resources to sessions and quietly return ANY resource from
                        ANY authorized server (think...spontaneous file server).</blockquote>

                        <p>In our case, however, 404 error are being returned after the use of a URL to a JS framework
                        that takes C<span class="the_R_in_crnrstn">R</span>NRSTN :: itself as the intended endpoint
                        and...consequently and among other things...exposes no specific information about the location of
                        the resource being requested. In fact, a filename (or filename plus one (1) directory) is the
                        most that ever need be revealed. Therefore, in all of these situations, I...I mean...the current lead
                        developer will need to have C<span class="the_R_in_crnrstn">R</span>NRSTN :: step up and do the
                        work of providing these resources directly to said JS framework...on top of having already
                        made C<span class="the_R_in_crnrstn">R</span>NRSTN :: to do the work of providing the very JS
                        framework that is now seeking said resources.</p>

                        <p>With great power comes great responsibility, my friends.</p>

                    </div>
                    <div class="crnrstn_general_post_recent_activity_datestamp"><p>[2022-11-21 10:03:29.330436]</p></div>

                </div>

            </li>
        </ul>

    </div>
    <div class="crnrstn_default_landing_content_footer">
        <div class="crnrstn_cb_5"></div>
        <div class="crnrstn_default_landing_content_border_minor"><div class="crnrstn_cb_15"></div></div>
        <div class="crnrstn_default_landing_recent_activity_creative"><?php echo $oCRNRSTN->return_branding_creative(); ?></div>

    </div>

    <div class="crnrstn_cb_40"></div>
    <div class="crnrstn_default_landing_content_title">
        <h2><?php echo $oCRNRSTN->multi_lang_content_return('DEFAULT_LANDING_TITLE_DEMONSTRATION'); ?></h2>
        <p><?php echo $oCRNRSTN->multi_lang_content_return('DEFAULT_LANDING_DEMONSTRATION_DESCRIPTION'); ?> <sup class="crnrstn_documentation_page_stats_sup">&dagger;</sup><?php echo $oCRNRSTN->multi_lang_content_return('DEFAULT_LANDING_TEXT_FILE'); ?>:</p>
        <div class="crnrstn_cb_5"></div>
        <div class="crnrstn_default_landing_content_border_major"><div class="crnrstn_cb_5"></div></div>
    </div>
    <div style="padding:0 0 20px 20px; font-family: Courier New, Courier, monospace;"><strong>WETHRBUG_APP</strong> = <?php echo $oCRNRSTN->get_resource('WETHRBUG_APP'); ?></div>
    <div class="crnrstn_cb_30"></div>

    <div class="crnrstn_general_dagger_key_shell">
        <div class="crnrstn_general_dagger_key_dag">&dagger;</div>
        <div class="crnrstn_general_dagger_key_description"><p><em><?php echo $oCRNRSTN->multi_lang_content_return('DEFAULT_LANDING_TEXT_SEE'); ?> '/_crnrstn/_config/config.system_resource.secure/_crnrstn.system_resource.inc.php'</em>.</p></div>
        <div class="crnrstn_cb"></div>

    </div>
    <div class="crnrstn_cb_40"></div>
    <div>
        <div style="float: left; padding: 15px 20px 0 0;">
            <p><?php echo $oCRNRSTN->multi_lang_content_return('DEFAULT_LANDING_TEXT_CHECK_OUT'); ?> <a href="<?php echo $oCRNRSTN->return_sticky_link('https://www.facebook.com/media/set/?set=a.10152398953669503.1073741836.586549502&type=1&l=4ba17e313a','crnrstn_landing_photo_album_facebook'); ?>" target="_blank" style="text-decoration:none; color: #0066CC; text-decoration:underline;">Facebook</a> <?php echo $oCRNRSTN->multi_lang_content_return('DEFAULT_LANDING_TEXT_PHOTO_ALBUM'); ?>!</p>
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