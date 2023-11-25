<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

//
// HTML FOOTER OUTPUT.
// PASS TRUE TO SPOOL DESIRED CONTENT TO BE OUTPUTTED LATER
// INTO THE HTML FOOTER VIA system_output_footer_html().
$oCRNRSTN->system_output_footer_html(CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY, true);
$oCRNRSTN->system_output_footer_html(CRNRSTN_RESPONSE_REPORT, true);
$oCRNRSTN->system_output_footer_html(CRNRSTN_RESOURCE_DOCUMENTATION, true);

//
// HTML HEAD OUTPUT.
//$oCRNRSTN->system_output_head_html(CRNRSTN_JS_FRAMEWORK_BACKBONE, true);  // THROWS DOM INIT ERROR. LEAD DEV IS...SOON TO BE ADDING FRAMEWORK DEPENDENCIES.
$oCRNRSTN->system_output_head_html(CRNRSTN_CLIENT_SSDTLA_DEBUG, true, true);
?>
<!DOCTYPE html>
<html lang="<?php echo $oCRNRSTN->iso_language_html(); ?>">
<head>
    <title>CRNRSTN :: v<?php echo $oCRNRSTN->version_crnrstn(); ?></title>
    <?php echo $oCRNRSTN->system_output_head_html(CRNRSTN_CSS_MAIN_DESKTOP); ?>

</head>
<body>
<!--
Sunday April  30, 2023 @ 0359 hrs
DATA STORAGE AUTHORIZATIONS ::
DEFINITIONS OF INTEGER CONSTANTS AND DEFINITIONS OF
RECOGNIZED COMBINATIONS OF THE SAME.
-----
case 'session':
    case CRNRSTN_AUTHORIZE_ALL:
    case CRNRSTN_AUTHORIZE_SESSION:
    case CRNRSTN_AUTHORIZE_SESSION & CRNRSTN_AUTHORIZE_RUNTIME:
    case CRNRSTN_AUTHORIZE_SESSION & CRNRSTN_AUTHORIZE_DATABASE:

case 'runtime':
    case CRNRSTN_AUTHORIZE_ALL:
    case CRNRSTN_AUTHORIZE_RUNTIME:
    case CRNRSTN_AUTHORIZE_SESSION & CRNRSTN_AUTHORIZE_RUNTIME:
    case CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_RUNTIME:
    case CRNRSTN_AUTHORIZE_COOKIE & CRNRSTN_AUTHORIZE_RUNTIME:

NOTE:
    AFFECTED CRNRSTN :: METHODS INCLUDE THE FOLLOWING:
    - public function add_resource($data_key, $data_value = NULL, $data_type_family = 'CRNRSTN::RESOURCE', $data_auth_profile = CRNRSTN_AUTHORIZE_RUNTIME, $index = NULL, $ttl = 60, $spool_resource = false, $env_key = NULL)
    - public function input_data_value($data_val, $data_key, $data_type_family = 'CRNRSTN::RESOURCE', $index = NULL, $data_auth_profile = CRNRSTN_AUTHORIZE_ALL, $ttl = 60, $spool_resource = false, $env_key = NULL)
    - public function channel_access_is_authorized($channel, $data_auth_profile)
    - public function add_ssdtla_resource($data_key, $data_value, $data_type_family = 'CRNRSTN::RESOURCE', $data_auth_profile = NULL, $index = NULL, $ttl = NULL)


Saturday April 22, 2023 @ 0619 hrs
SYSTEM IMAGES RETURN ::
DEFINITIONS OF INTEGER CONSTANTS AND DEFINITIONS OF
RECOGNIZED COMBINATIONS OF THE SAME.
-----
case 'CRNRSTN_IMG'                          XXXX                RETURNS A GZIPPED (OPTIONALLY) PNG OR JPG (*CONFIGURATION DRIVEN) FILE.
case 'CRNRSTN_PNG'                          XXXX                RETURNS A GZIPPED (OPTIONALLY) PNG FILE.
case 'CRNRSTN_JPEG'                         XXXX                RETURNS A GZIPPED (OPTIONALLY) JPG FILE.
case 'CRNRSTN_BASE64_PNG'                   XXXX                RETURNS data:image/jpg;base64 STRING DATA.
case 'CRNRSTN_BASE64_JPEG'                  XXXX                RETURNS data:image/jpg;base64 STRING DATA.
case 'CRNRSTN_STRING'                       XXXX                RETURNS PNG OR JPG (CONFIGURATION DRIVEN) IMAGE URL STRING DATA.
case 'CRNRSTN_HTML'                         XXXX                RETURNS PNG, JPG, OR BASE64 (CONFIGURATION DRIVEN) HTML WRAPPED <IMG> DATA.
case 'CRNRSTN_ASSET_MODE_BASE64'            XXXX                RETURNS data:image/png;base64 OR data:image/jpg;base64 (CONFIGURATION DRIVEN) STRING DATA.
case 'CRNRSTN_ASSET_MODE_PNG'               XXXX                RETURNS A GZIPPED (OPTIONALLY) PNG FILE.
case 'CRNRSTN_ASSET_MODE_JPEG'              XXXX                RETURNS A GZIPPED (OPTIONALLY) JPG FILE.
case 'CRNRSTN_UI_IMG_SOAP_DATA_TUNNEL'      XXXX                CRNRSTN :: SOAP SERVICES DATA TUNNEL LAYER - DATA TRANSLATION SUPPORT.
            {barney}_{smaug}

XXXX    CRNRSTN_HTML & CRNRSTN_ASSET_MODE_BASE64        RETURNS HTML <IMG> WRAPPED data:image/png;base64 OR data:image/jpg;base64 (CONFIGURATION DRIVEN) STRING DATA.
XXXX    CRNRSTN_HTML & CRNRSTN_BASE64_PNG			    RETURNS HTML <IMG> WRAPPED data:image/png;base64 STRING DATA.
XXXX    CRNRSTN_HTML & CRNRSTN_BASE64_JPEG		        RETURNS HTML <IMG> WRAPPED data:image/jpg;base64 STRING DATA.
XXXX    CRNRSTN_HTML & CRNRSTN_PNG                      RETURNS HTML <IMG> WRAPPED PNG URL STRING DATA.
XXXX    CRNRSTN_HTML & CRNRSTN_JPEG                     RETURNS HTML <IMG> WRAPPED JPEG URL STRING DATA.

NOTE:
    AFFECTED CRNRSTN :: METHODS INCLUDE THE FOLLOWING:
    - public function return_branding_creative($strip_formatting = false, $output_mode = CRNRSTN_HTML)
    - public function return_system_image($system_asset_constant, $width = NULL, $height = NULL, $hyperlink = NULL, $alt = NULL, $title = NULL, $target = NULL, $output_mode = CRNRSTN_STRING, $url_params_ARRAY = NULL)
    - public function return_creative($media_element_key, $output_mode = NULL, $creative_mode = NULL)

* CONFIGURATION DRIVEN:
  See $oCRNRSTN->config_init_system_asset_mode() in _crnrstn.config.inc.php.
  The default image compression format/mode (PNG, JPG, or BASE64) can be changed in
  the configuration file of CRNRSTN ::

* Please note: This is not yet committed to the GitHub repository, and the
  above DEFINITIONS are still being implemented on top of CRNRSTN :: PLAID.
  CRNRSTN :: PLAID is a savagely trimmed down, process streamlined, OOP, and
  accelerated version of the previous asset mapping and resource [JS,CSS,PNG,
  JPEG,MAP] serving architecture.

* WHY PLAID? With CRNRSTN :: PLAID, when building the HTML page with <img src="./960_24_col.css">, a
  multi-channel write will put the data also into SESSION. CRNRSTN :: PLAID does all writes multi-
  channel. When the browser loads the page, and then sends a second request to SERVER for the
  960_24_col.css file, the data needed to get that file will be already HOT IN SESSION and ready for
  immediate return to client (proper 200) with LUDICROUS speed.

  Does a 3 second TTL on page load data seem long enough? What about 56KB DIAL UP? I would hate
  to TTL expire the 960_24_col.css CACHE on the server before the browser could ask for the image
  and get the benefit of the same. Maybe 12 second TTL...then ANY AJAX touch would clear the cache
  on __destruct().

 plaid_cache[
    [OMITTED::HEADER...]
    -----
    [filename] => 960_24_col.css
    [request_family] => css
    [asset_meta_key] => _lib/frameworks/960_grid_system/code/css
    [output_mode] => 7207
    [raw_output_mode] => 7207
    [meta_path] => _lib/frameworks/960_grid_system/code/css
    [file_ext] => css
    -----
    [OMITTED::CACHE ACCELERATION PERFORMANCE REPORT with MEMORY
       USAGE, CPU LOAD, RUNTIME, AND TIMESTAMP RELEVANT TO THE
       RETURN OF n+1 "960_24_col.css RESPONSES" TO THE CLIENT.]

    - Where n+1 is set by admin in CRNRSTN :: settings. Default atm is 5.
    - Where maximum bytes per channel [session, runtime, database, cookie,
      ssdtla] is set by admin in CRNRSTN :: settings.

  CRNRSTN :: SYSTEM SETTINGS
  _crnrstn/_config/_config.defaults/_crnrstn.system_settings.inc.php


 [NOT PUBLIC MATERIAL YET] CONFIGURATION FILE EXCERPT [_crnrstn.config.inc.php]
 ...
 * $oCRNRSTN->config_init_system_asset_mode($env_key = CRNRSTN_RESOURCE_ALL, $system_asset_mode = CRNRSTN_ASSET_MODE_BASE64)
 * DESCRIPTION :: Configure the HTML email image handling profile for CRNRSTN :: system notifications.
 * OPTIONS ::
 * CRNRSTN_ASSET_MODE_PNG:      ALL CRNRSTN :: system images load the PNG versions of the file.
 * CRNRSTN_ASSET_MODE_JPEG:     ALL CRNRSTN :: system images load the JPG version of the file.
 * CRNRSTN_ASSET_MODE_BASE64:   ALL CRNRSTN :: system images and ALL CRNRSTN :: integrated 3rd
 *                              party JS Frameworks, and CSS Frameworks load as embedded within
 *                              the HTML. This makes mobile FAAAASST.
 * ...
*/

//
// Spaceballs - They've gone into plaid
// https://www.youtube.com/watch?v=mk7VWcuVOf0

*/
-->
<div class="crnrstn_default_landing_page_wrapper">
    <div class="crnrstn_default_landing_page_logo"><?php echo $oCRNRSTN->return_system_image('CRNRSTN_LOGO', '', 70, NULL, NULL, NULL, NULL, CRNRSTN_HTML); ?></div>

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
                        architecture of C<span class="the_R_in_crnrstn">R</span>NRSTN :: This is definitely a rough
                        pass, friends.</p>

                        <p>A second pass will need to be made in order to clear all of the 404 return responses from broken
                        library dependencies (mostly images...png, gif, jpg). As is the case with any vanilla application, a URL
                        from C<span class="the_R_in_crnrstn">R</span>NRSTN :: which points directly to any JS
                        framework's source on the server will enable that framework to access all of it's own supporting
                        assets as intended,...itself. So, for example, a JS application (running in the browser) would
                        know where to find all of it's &quot;internal&quot; images. This would be the fruit borne from
                        operating according to a more traditional approach...or (in this case) the fruit of setting
                        <span class="crnrstn_general_post_code_copy">$tunneling_active = false</span>
                        when calling <span class="crnrstn_general_post_code_copy">$oC<span class="the_R_in_crnrstn">R</span>NRSTN->config_init_asset_map_js()</span>.
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
    <div class="crnrstn_cb_20" style="color:#2e2e31;"></div>
    <pre style="font-size:10px; height:200px; overflow:hidden; padding:0;"><?php echo $oCRNRSTN->return_CRNRSTN_ASCII_ART(); ?></pre>

    <?php
    //
    // CRNRSTN :: APPLICATION ACCELERATION PERFORMANCE REPORT.
    //echo $oCRNRSTN->cache_usage_report();
    ?>

    <?php
    echo '<div style="line-height:25px; padding: 20px 0 0 10px; font-family: Courier New, Courier, monospace; font-size: 18px; color: #333;">
' . $oCRNRSTN->return_system_image('CRNRSTN_LOGO', '', 300, NULL, NULL, NULL, NULL, CRNRSTN_HTML);

    echo '
<div class="crnrstn_cb"></div>
[' . $oCRNRSTN->return_micro_time() . '][rtime '. $oCRNRSTN->wall_time()  . ' secs]
<div class="crnrstn_cb_20"></div>';
    echo print_r(CRNRSTN_IMG, true) . ' <IMG> CRNRSTN_IMG<br>
';
    echo print_r(CRNRSTN_PNG, true) . ' <IMG> CRNRSTN_PNG<br>
';
    echo print_r(CRNRSTN_JPEG, true) . ' <IMG> CRNRSTN_JPEG<br>
';
    echo print_r(CRNRSTN_BASE64_PNG, true) . ' <IMG> CRNRSTN_BASE64_PNG<br>
';
    echo print_r(CRNRSTN_BASE64_JPEG, true) . ' <IMG> CRNRSTN_BASE64_JPEG<br>
';
    echo print_r(CRNRSTN_STRING, true) . ' <IMG> CRNRSTN_STRING<br>
';
    echo print_r(CRNRSTN_HTML, true) . ' <IMG> CRNRSTN_HTML<br>
';
    echo print_r(CRNRSTN_ASSET_MODE_BASE64, true) . ' <IMG> CRNRSTN_ASSET_MODE_BASE64<br>
';
    echo print_r(CRNRSTN_ASSET_MODE_PNG, true) . ' <IMG> CRNRSTN_ASSET_MODE_PNG<br>
';
    echo print_r(CRNRSTN_ASSET_MODE_JPEG, true) . ' <IMG> CRNRSTN_ASSET_MODE_JPEG<br><br>
';
    echo print_r(CRNRSTN_HTML & CRNRSTN_ASSET_MODE_BASE64, true) . ' <IMG> CRNRSTN_HTML & CRNRSTN_ASSET_MODE_BASE64<br>
';
    echo print_r(CRNRSTN_HTML & CRNRSTN_BASE64_PNG, true) . ' <IMG> CRNRSTN_HTML & CRNRSTN_BASE64_PNG<br>
';
    echo print_r(CRNRSTN_HTML & CRNRSTN_BASE64_JPEG, true) . ' <IMG> CRNRSTN_HTML & CRNRSTN_BASE64_JPEG<br>
';
    echo print_r(CRNRSTN_HTML & CRNRSTN_PNG, true) . ' <IMG> CRNRSTN_HTML & CRNRSTN_PNG<br>
';
    echo print_r(CRNRSTN_HTML & CRNRSTN_JPEG, true) . ' <IMG> CRNRSTN_HTML & CRNRSTN_JPEG
';

    echo  '<br><br>
';
    echo 'request_serial = ' . $oCRNRSTN->request_serial . '
<div class="crnrstn_cb_5"></div>
';
    echo 'request_id = ' . $oCRNRSTN->request_id . '
<div class="crnrstn_cb_5"></div>
';

    $tmp_ARRAY = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11);
    ?>
    <pre>
    <code style="font-weight: normal;">

<?php
$tmp_html_delim = '<div class="crnrstn_cb_5"></div>';
echo $oCRNRSTN->mem_report($tmp_ARRAY, 'TEXT', NULL, false, true, '. ', $tmp_html_delim);
?>

    </code>
</pre>

    <?php
    echo '
<div class="crnrstn_cb"></div>
[' . $oCRNRSTN->return_micro_time() . '][rtime '. $oCRNRSTN->wall_time()  . ' secs]
<div class="crnrstn_cb_20"></div>';
    ?>
</div>
</div>
<div class="crnrstn_cb_20"></div>
<div class="crnrstn_general_copyright_shell">&copy; 2012-<?php echo date('Y'); ?> Jonathan 'J5' Harris :: <?php echo $oCRNRSTN->multi_lang_content_return('COPY_ALL_RIGHTS_PART1'); ?><br><?php echo $oCRNRSTN->multi_lang_content_return('COPY_ALL_RIGHTS_PART2'); ?> <a id="crnrstn_general_mit_lnk" href="#" onclick="oCRNRSTN_JS.crnrstn_interact_ui_ux('onclick', this); return false;" target="_self"><?php echo $oCRNRSTN->multi_lang_content_return('COPY_ALL_RIGHTS_PART_MIT'); ?></a>.</div>

<div class="crnrstn_cb_40"></div>
<div id="crnrstn_j5_wolf_pup_outter_wrap" class="crnrstn_j5_wolf_pup_outter_wrap">
    <div id="crnrstn_j5_wolf_pup_inner_wrap" class="crnrstn_j5_wolf_pup_inner_wrap">
        <?php echo $oCRNRSTN->return_creative('J5_WOLF_PUP_RAND', CRNRSTN_HTML); ?>
    </div>
</div>
<?php
    echo $oCRNRSTN->system_output_footer_html();
?>
</body>
</html>