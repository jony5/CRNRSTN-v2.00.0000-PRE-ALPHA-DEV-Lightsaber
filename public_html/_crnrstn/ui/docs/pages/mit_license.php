<?php
/*
// J5
// Code is Poetry */
//$channel_constant = $this->oCRNRSTN->return_set_bits($this->oCRNRSTN->system_output_channel_constants);
$channel_constant = $this->oCRNRSTN->device_type_bit;
//error_log(__LINE__ . ' mit lic ['. print_r($this->oCRNRSTN_USR->system_output_channel_constants, true).'] $channel_constant=' . print_r($channel_constant, true));

switch($channel_constant){
    case CRNRSTN_UI_MOBILE:
        //
        // MOBILE DEVICE EXPERIENCE
        $tmp_str = 'hello mobi world!';
        $tmp_str = '';

    break;
    case CRNRSTN_UI_TABLET:

        //
        // TABLET DEVICE EXPERIENCE
        /*
         * To prefetch a page, add the data-prefetch attribute to a link that points to the page.
         * data-prefetch="true"
         * */
        $tmp_str = 'hello tablet world!';
        if(1==2) {
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <?php
                include_once($this->oCRNRSTN_USR->get_resource("DOCUMENT_ROOT") . $this->oCRNRSTN_USR->get_resource("DOCUMENT_ROOT_DIR") . '/common/inc/head/head.inc.php');
                ?>
            </head>

            <body>
            <div data-role="page" id="myPage">
                <?php

                //$tmp_HTML = $oSideBitch_Usr->returnPageHTML($tmp_page_serial, 'mobile');

                //$tmp_formUnique = $this->oCRNRSTN_USR->generate_new_key(4);
                //$tmp_pageName_Header =  strtolower($oSideBitch_Usr->getCategory($tmp_page_serial)).' ::';
                //require($this->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$this->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR').'/common/inc/search/search.mobi.inc.php');
                //require($this->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$this->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR').'/common/inc/nav/sidenav.mobi.inc.php');
                //require($this->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$this->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR').'/common/inc/header/header.mobi.inc.php');


                $tmp = '420';
                switch ($tmp) {
                    case '420':
                        //
                        // AV SERVICE SAINT
                        //$oMiniNav = new miniNav('avservice_saint', $this->oCRNRSTN_USR);
                        //$oMiniNav->configureLink('streams', $this->oCRNRSTN_USR->crnrstn_resources_http_path.'dashboard/streams/?kid=' . $this->oCRNRSTN_USR->oHTTP_MGR->extractData($_GET, 'kid'));
                        //$oMiniNav->configureLink('obs clients', $this->oCRNRSTN_USR->crnrstn_resources_http_path.'dashboard/obs/');
                        //$oMiniNav->configureLink('logs', $this->oCRNRSTN_USR->crnrstn_resources_http_path.'dashboard/logs/');
                        //$oMiniNav->configureLink('refresh', $this->oCRNRSTN_USR->crnrstn_resources_http_path.'dashboard/');

                        break;
                    case '320':
                        //
                        // SAINT SERVING TRANSLATION
                        $oMiniNav = new miniNav('translation_saint', $this->oCRNRSTN_USR);
                        //$oMiniNav->configureLink('streams', $this->oCRNRSTN_USR->crnrstn_resources_http_path.'dashboard/streams/?kid=' . $this->oCRNRSTN_USR->oHTTP_MGR->extractData($_GET, 'kid'));
                        $oMiniNav->configureLink('logs', $this->oCRNRSTN_USR->crnrstn_resources_http_path . 'dashboard/logs/');
                        $oMiniNav->configureLink('refresh', $this->oCRNRSTN_USR->crnrstn_resources_http_path . 'dashboard/');

                        break;

                }

                //$tmp_formUnique = $this->oCRNRSTN_USR->generate_new_key(4);
                //$tmp_pageName_Header = 'home ::';
                //require($this->oCRNRSTN_USR->crnrstn_resources_http_path.'/common/inc/search/search.mobi.inc.php');
                //require($this->oCRNRSTN_USR->crnrstn_resources_http_path.'/common/inc/nav/sidenav.mobi.inc.php');
                //require($this->oCRNRSTN_USR->crnrstn_resources_http_path.'/common/inc/header/header.mobi.inc.php');

                ?>

                <!--
                //
                // BEGIN MAIN CONTENT -->
                <div role="main" class="ui-content" id="myPage">
                    <?php
                    echo 'hello tablet world!';
                    ?>

                </div><!-- /content -->

                <?php
                require($this->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT') . $this->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR') . '/common/inc/footer/footer.inc.php');

                ?>

            </div><!-- /page -->

            </body>
            </html>

            <?php
        }

    break;
    default:
        // CRNRSTN_UI_DESKTOP:

        //
        // DESKTOP EXPERIENCE
        //$this->oCRNRSTN_USR->returnSrvrRespStatus(503);
        // input_data_value($crnrstn_images_http_dir, 'crnrstn_resources_http_path', 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES', 0, NULL, $env_key);
//        error_log(__LINE__ . ' [' . get_class($this->oCRNRSTN_USR) . '] crnrstn_resources_http_path=' . $this->oCRNRSTN->get_resource('crnrstn_resources_http_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES') . '. die();');
//        die();

        $tmp_http_root = $this->oCRNRSTN->current_location();

        $tmp_str = '<!DOCTYPE html>
    <html lang="' . $this->oCRNRSTN->country_iso_code() . '">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        ' . $this->oCRNRSTN->return_creative('CRNRSTN_FAVICON') . '
        ' . $this->oCRNRSTN->ui_content_module_out(CRNRSTN_UI_JS_JQUERY_UI) .
            $this->oCRNRSTN->ui_content_module_out(CRNRSTN_UI_CSS_MAIN_DESKTOP & CRNRSTN_UI_JS_MAIN_DESKTOP) . '
    </head>
    <body>
    <div class="crnrstn_body_wrapper">

        <div class="crnrstn_dyn_signin_hdr_branding_shell">

            <div class="crnrstn_env_select_wrapper">
                <div class="crnrstn_env_select_component_wrapper">
                    <select name="crnrstn_host_endpoint" style="height: 15px; font-size: 11px; display:inline;">
                        <option value="0">-</option>
                        <option value="7">Apache v' . $this->oCRNRSTN->version_apache() . '</option>
                        <option value="8">MySQLi v' . $this->oCRNRSTN->version_mysqli() . '</option>
                        <option value="9">PHP v' . $this->oCRNRSTN->version_php() . '</option>
                    </select>
                </div>
                <div class="crnrstn_cb"></div>
                <div class="crnrstn_static_hdr_branding_shell">
                    <div class="crnrstn_static_hdr_branding_copy">C<span class="the_R_in_crnrstn">R</span>NRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . '</div>
                </div>

            </div>

            <div class="crnrstn_dyn_branding_elem_wrapper signin">
                <div class="crnrstn_dyn_branding_elem_shell">' . $this->oCRNRSTN->return_branding_creative(true, CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED) . '</div>
            </div>

                <div class="crnrstn_cb_5"></div>
                
        </div>

        <div class="crnrstn_section_outter_wrapper signin">
            <div id="crnrstn_signin_bdr01_' . $this->page_serial . '"  class="crnrstn_section_inner_wrapper signin">

                <div class="crnrstn_signin_meta_time_stats_wrapper">
                    <div id="crnrstn_signin_meta00_' . $this->page_serial . '" class="crnrstn_signin_meta_time_stats">[' . $this->oCRNRSTN->return_micro_time() . ' ' . date('T') . '] [rtime ' . $this->oCRNRSTN->wall_time() . ' secs]</div>
                    <div id="crnrstn_signin_meta01_' . $this->page_serial . '" class="crnrstn_signin_meta_5_logo">' . $this->oCRNRSTN->return_creative('5', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED) . '</div>

                    <div class="crnrstn_signin_backdrop_logo">' . $this->oCRNRSTN->return_system_image('CRNRSTN_LOGO', 250, '', '', '', '', '', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED) . '</div>

                    <div class="crnrstn_cb"></div>
                </div>

                <div class="crnrstn_cb"></div>

                <div class="crnrstn_signin_form_outter_wrapper">

                    <div class="crnrstn_signin_form_inner_wrapper crnrstn_mit_landing">

                        <div class="crnrstn_signin_form_inner_wrapper_rel">

                            <div class="crnrstn_mit_back_copy_outter_shell">
                                <div class="crnrstn_mit_back_copy_inner_shell">
                                    <!--<a href="' . $this->oCRNRSTN_USR->return_back_link() . '" target="_self" class="crnrstn_mit_copy_back">BACK</a>-->
                                </div>
                            </div>
                            
                            <div class="crnrstn_mit_license_wrapper">
                                <code><pre>MIT License
                               
Copyright (c) 2012-' . date('Y') . ' Jonathan \'J5\' Harris

Permission is hereby granted, free of charge, to any person obtaining 
a copy of this software and associated documentation files (the 
"Software"), to deal in the Software without restriction, including 
without limitation the rights to use, copy, modify, merge, publish, 
distribute, sublicense, and/or sell copies of the Software, and to 
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be 
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, 
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF 
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. 
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY 
CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, 
TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE 
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
</pre></code>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="crnrstn_signin_reflection_wrapper">
            <div class="crnrstn_signin_reflection_wrapper_rel">
                <div class="crnrstn_signin_reflection_img_shell">' . $this->oCRNRSTN->return_creative('BG_ELEMENT_REFLECTION_SIGNIN', CRNRSTN_UI_IMG_BASE64_PNG_HTML_WRAPPED) . '</div>
            </div>
        </div>
        
        <div class="crnrstn_cb_20"></div>

        <div class="crnrstn_signin_copyright_shell">&copy; 2012-' . date('Y') . ' Jonathan \'J5\' Harris :: All Rights Reserved in accordance with<br>the latest version of the <a href="#" target="_self">MIT License</a>.</div>
        
        <div class="crnrstn_cb_40"></div>

        <div class="crnrstn_j5_wolf_pup_outter_wrap">
            <div class="crnrstn_j5_wolf_pup_inner_wrap">
                ' . $this->oCRNRSTN->return_creative('J5_WOLF_PUP_RAND', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED) . '
            </div>
        </div>

        <div class="crnrstn_cb"></div>

    </div>
    
    ' . $this->oCRNRSTN->framework_integrations_client_packet() . '
    </body>
    </html>';

    break;

}
