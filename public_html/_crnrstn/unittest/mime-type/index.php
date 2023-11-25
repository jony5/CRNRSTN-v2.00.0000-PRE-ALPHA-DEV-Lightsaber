<?php
//if(substr(PHP_OS, 0, 3) == 'WIN'){
//
//    //
//    // Tuesday, June 6, 2023 @ 1234 hrs.
//    // FIRST SUCCESSFUL "OS DETECTION TOGGLE TEST"
//    // OF WINDOWS vs LINUX HOSTING FOR
//    // CRNRSTN :: LIGHTSABER.
//    //
//    // I DO NOT HAVE WINDOWS COMMANDS YET.
//    //exec('for %I in ("'.$file.'") do @echo %~zI', $output);
//    //$return = $output[0];
//
//    echo '<div style="padding: 20px 0 0 20px; font-family: Arial, Helvetica, sans-serif; font-size: 18px; color:#333;">
//' . __LINE__ . ' index<br><br>
//HELLO C<span style="color:#F90000;">R</span>NRSTN ::<br>
//THIS IS php v' . phpversion() . ' by XAMPP RUNNING ON WIN XP!</div>';
//
//}else{
//
//    echo '<div style="padding: 20px 0 0 20px; font-family: Arial, Helvetica, sans-serif; font-size: 18px; color:#333;">
//' . __LINE__ . ' index<br><br>
//HELLO C<span style="color:#F90000;">R</span>NRSTN ::<br>
//THIS IS php v' . phpversion() . '!</div>';
//
//}
//
//die();

/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

//
// Sunday, June 4, 2023 @ 1726 hrs.
// CRNRSTN :: LOCAL FILE SYSTEM INTEGRATIONS TESTING.
// THIS PUTS LOCAL FILES ONTO CRNRSTN :: PLAID, AND IT DEFINES A DIRECTORY AS ROOT FOR FILE BROWSING BY ADMIN.
$oCRNRSTN->config_integrate_file_system('BLUEHOST_EVIFWEB','https://evifweb.com/common/', '/var/evifwebc1/public_html/evifweb.com/common/', CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_SESSION, 120);
$oCRNRSTN->config_integrate_file_system('LOCALHOST_PC', 'http://172.16.225.138/evifweb.com/common/', '/var/www/html/evifweb.com/common/', CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_SESSION, 120);      // WINDOWS XP VM WARE - MACBOOK PRO CHAD [eVifweb].
$oCRNRSTN->config_integrate_file_system('LOCALHOST_CHAD_MACBOOKPRO', 'http://172.16.225.139/evifweb.com/common/', '/var/www/html/evifweb.com/common/', CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_SESSION, 120);

//
// Sunday, September 10, 2023 @ 1720 hrs.
// REGARDING CRNRSTN :: LOCAL FILE SYSTEM INTEGRATIONS.
// AS AN EXPANSION OF THE NATIVE CRNRSTN :: FRAMEWORK (JS/CSS) DIRECTORY BROWSING
// WITH CUSTOM FILE ICONS + MGMT THAT IS IN SCOPE FOR CRNRSTN :: FRAMEWORK
// DOCUMENTATION, THE config_integrate_file_system() DEFINED RESOURCES ARE TO BE
// EXPOSED TO AN ADMIN AUTHENTICATED SESSION FOR REMOTE DIRECTORY BROWSING VIA
// THE CRNRSTN :: SOAP-SERVICES REAL-TIME SESSION CAST SERVICES LAYER (SSRT-SCSL).
//
// PLZ SEE _crnrstn/class/ui/crnrstn.ui_html_manager.inc.php, [LINE 94].
// FINISHING SYSTEM IMAGES WILL ALLOW FOR DEVELOPMENT OF THE CRNRSTN :: SSRT-SCSL.

//
// HTML HEAD OUTPUT :: 3RD PARTY JS/CSS FRAMEWORKS.
// PASS TRUE TO SPOOL DESIRED CONTENT TO BE OUTPUTTED LATER.
// INTO THE HTML FOOTER VIA system_output_footer_html().
$oCRNRSTN->system_output_head_html(CRNRSTN_CSS_MAIN_DESKTOP, true);
$oCRNRSTN->system_output_head_html(CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS, true);
$oCRNRSTN->system_output_head_html(CRNRSTN_JS_FRAMEWORK_JQUERY_UI, true);
//$oCRNRSTN->system_output_head_html(CRNRSTN_CLIENT_SSDTLA_DEBUG, true, true);

/*
//
// Friday, June 9, 2023 @ 0220 hrs.
// NEW FRAMEWORKS (SOME OF THEM) TO TEST AND/OR SETUP
// NECESSARY DEPENDENCIES AND REQUIRED FILE MAPPINGS:
// $oCRNRSTN->system_output_head_html(CRNRSTN_JS_FRAMEWORK_MITHRIL_CDN, true);
-----
    CRNRSTN_JS_FRAMEWORK_SWFOBJECT_DOT_JS
    CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS
    CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_2_11_3
    CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY
    CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_2_10_0
    CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_2_10_0
    CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_2_03_3
    CRNRSTN_JS_FRAMEWORK_JQUERY_MOBILE
    CRNRSTN_JS_FRAMEWORK_MITHRIL_CDN
    CRNRSTN_JS_FRAMEWORK_BACKBONE
    CRNRSTN_JS_FRAMEWORK_REACT_CDN
    CRNRSTN_JS_FRAMEWORK_JQUERY_3_7_0
    CRNRSTN_JS_FRAMEWORK_JQUERY_3_6_1
    CRNRSTN_JS_FRAMEWORK_UNDERSCORE
    CRNRSTN_JS_FRAMEWORK_UNDERSCORE_UMD
    CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_UMD
    CRNRSTN_JS_FRAMEWORK_UNDERSCORE_ESM
    CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_ESM
    CRNRSTN_JS_FRAMEWORK_UNDERSCORE_UMD_EDGE
    CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_UMD_CDN
    CRNRSTN_JS_FRAMEWORK_UNDERSCORE_ESM_EDGE
    CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_ESM_CDN
    CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_UMD_UNPKG
    CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_ESM_UNPKG
    CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_UMD_PAGECDN
    CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_ESM_PAGECDN
    CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_UMD_CDNJS
    CRNRSTN_JS_FRAMEWORK_UNDERSCORE_1_13_6_ESM_CDNJS

*/

//
// HTML FOOTER OUTPUT.
// PASS TRUE TO SPOOL DESIRED CONTENT TO BE OUTPUTTED LATER
// INTO THE HTML FOOTER VIA system_output_footer_html().
//$oCRNRSTN->system_output_footer_html(CRNRSTN_RESPONSE_REPORT, true);
//$oCRNRSTN->system_output_footer_html(CRNRSTN_RESOURCE_DOCUMENTATION, true);

?>
<!DOCTYPE html>
<html lang="<?php echo $oCRNRSTN->iso_language_html(); ?>">
<head>
    <title>eVifweb</title>
    <?php
    
    //echo $oCRNRSTN->system_output_file_html('../favicon.ico');    // POWERED BY CRNRSTN :: FILE MIME-TYPE DETECTION AND META ENRICHMENT SERVICES LAYER.
    //echo $oCRNRSTN->system_output_file_html('../favicon.ico', CRNRSTN_FAVICON);

    //
    // CRNRSTN :: 3RD PARTY FRAMEWORK INTEGRATIONS.
    //echo $oCRNRSTN->system_output_head_html();

    //
    // Sunday, June 4, 2023 @ 1722 hrs.
    // CRNRSTN :: LOCAL FILE SYSTEM INTEGRATIONS.
    // echo $oCRNRSTN->system_output_file_html('/css/main.css', CRNRSTN_CSS);
    // echo $oCRNRSTN->system_output_file_html('/js/main.js', CRNRSTN_JS);

    ?>
</head>
<?php
echo '<body>';
echo '<div style="padding:10px 0 20px 20px; line-height: 10px; ">
            <pre><code style="overflow-wrap: break-word; font-family: "Courier New", Courier, monospace; font-size:12px; color: #333; text-shadow: 1px 1px 2px #ECECEC, 0 0 1em #ECECEC, 0 0 0.2em #ECECEC;">';
echo $oCRNRSTN->return_report_module_out(CRNRSTN_RESPONSE_REPORT);
echo '</code></pre></div>';
echo $oCRNRSTN->return_system_files_lab_html_report();
echo '</body></html>';

die();
?>


<div class="eVifweb_body_shell_rel" style="display: none;">
    <div class="eVifweb_body_shell_abs">

        <div class="eVifweb_body_content_rel">
            <div class="eVifweb_body_content_abs">

                <div class="eVifweb_5_reflect_logo">
                    <?php echo $oCRNRSTN->system_output_file_html('/imgs/reflection_of_5.png', CRNRSTN_HTML, '75', '', '5', '5', '/', '_self'); ?>
                </div>

                <div class="eVifweb_body_copy">
                    <p>Founded in my senior year of college in Jan of 2004, e<span class="the_V_in_evifweb">V</span>ifweb
                        development is a nimble full service web development and digital marketing operation ready to
                        bring results to the table. Whether your organization is looking to grow its opt in email
                        subscriber list or refresh an existing company website, let Evifweb exceed your expectations
                        with quality work which you would otherwise expect to have come from a full service digital
                        agency 300 deep.</p>

                    <div class="crnrstn_cb_20"></div>

                    <blockquote>
                        <h1>&quot;Let six years of award winning and
                            industry leading campaign engineering
                            and execution in the digital advertising
                            space at the fortune 500 level work
                            for you.&quot;</h1>
                    </blockquote>

                    <div class="crnrstn_cb_20"></div>

                    <p>I worked under the umbrella of Moxie in Atlanta, GA for six years...where I contributed
                        to projects for clients such as Home Depot, TruGreen, Verizon Wireless, and UPS.
                        After my exodus from Moxie, I took a sabbatical to reconnect with the foundations of
                        my faith and ultimately launch the CRNRSTN Suite :: PHP class library, I have now
                        returned full circle to re-open the doors of Evifweb Development to do what I
                        love...web development and digital marketing. This market re-entrance comes with a
                        broadened list of service offerings and performance expectations that have been
                        calibrated by the fortune 500.</p>

                    <div class="crnrstn_cb_20"></div>

                    <blockquote>
                        <h1>&quot;Allow 16+ years of full stack PHP
                            development experience to make
                            the digital dreams of your
                            company a reality.&quot;</h1>
                    </blockquote>
                </div>

                <div class="eVifweb_copyright">
                    <p>&copy;<?php echo date('Y'); ?> e<span class="the_V_in_evifweb">V</span>ifweb</p>
                </div>
            </div>
        </div>

        <div class="eVifweb_crnrstn_logo_bg_rel">
            <div class="eVifweb_crnrstn_logo_bg_abs">

            <?php
            echo $oCRNRSTN->return_system_image('CRNRSTN_LOGO', '', '', NULL, 'CRNRSTN :: v' . $oCRNRSTN->version_crnrstn(), 'CRNRSTN :: v' . $oCRNRSTN->version_crnrstn(), NULL, CRNRSTN_HTML);
            ?>

            </div>
        </div>

    </div>

    <div class="eVifweb_codeview_rel">
        <div class="eVifweb_codeview_abs">

            <code>
            <pre>

            <?php
            echo $oCRNRSTN->system_output_file_html('/imgs/reflection_of_5_ARIEL_NORMAL.gif', CRNRSTN_HTML & CRNRSTN_BASE64, '', '', '', '5', '5');
            //echo $oCRNRSTN->download_file_system('/imgs/reflection_of_5_ARIEL_NORMAL.gif', CRNRSTN_HTML & CRNRSTN_BASE64);
            //echo $oCRNRSTN->details_file_system('/imgs/reflection_of_5_ARIEL_NORMAL.gif', CRNRSTN_HTML & CRNRSTN_BASE64);

            ?>

            </pre>
            </code>

        </div>
    </div>

    <?php
        echo $oCRNRSTN->system_output_footer_html();
    ?>
</div>
</body>
</html>
