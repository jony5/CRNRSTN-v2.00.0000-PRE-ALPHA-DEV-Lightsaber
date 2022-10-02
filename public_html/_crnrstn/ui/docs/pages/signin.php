<?php
/*
// J5
// Code is Poetry */
//$this->oCRNRSTN_USR->initialize_authorization('signin');
error_log(__LINE__ . ' signin PAGE LOAD CALLED....');

//
// INITIALIZE CRNRSTN TO CATCH THE FORM(S) ON THIS PAGE. THEREFORE, NEED TO THROW  SOME THINGS.
// ID THE FORM FOR ALL PARAMS TO BE ASSOCIATED.
# SHOULD BE A UNIQUE HANDLE TO THE FORM PROFILE. IT DETERMINES WHAT POTENTIAL POST/GET
# PARAMETERS FOR WHICH CRNRSTN SHOULD BE LISTENING.
# $this->oCRNRSTN_USR->initializeFormHandling({crnrstn_pssdtl_packet}, {TUNNEL_PROTOCOL});

$tmp_form_serial = $this->oCRNRSTN_USR->generate_new_key(5);

//
// THESE ARE THE INPUT FIELDS TO WHICH WE WILL LOOK
# THESE FIELDS ARE NOT HIDDEN. THEY WILL NOT/CANNOT BE
# ENCRYPTED INITIALLY.
# $this->oCRNRSTN_USR->form_input_add({crnrstn_pssdtl_packet}, {HTML_DOM_FORM_INPUT_NAME}}, {IS_REQUIRED});
$this->oCRNRSTN_USR->form_input_add('crnrstn_signin_flagship', 'crnrstn_auth_e', true);
$this->oCRNRSTN_USR->form_input_add('crnrstn_signin_flagship', 'crnrstn_auth_pwd', true);

$err_uri = 'l=e';
$success_uri = 'l=s';
$this->oCRNRSTN_USR->add_validation_redirect('crnrstn_signin_flagship', '*', '*', $err_uri, $success_uri);

$this->oCRNRSTN_USR->init_validation_message('crnrstn_signin_flagship', 'crnrstn_auth_e', 'EMAIL_REQUIRED', $this->oCRNRSTN_USR->get_lang_copy('EMAIL_REQUIRED'));
$this->oCRNRSTN_USR->init_validation_message('crnrstn_signin_flagship', 'crnrstn_auth_pwd', 'PASSWORD_REQUIRED', $this->oCRNRSTN_USR->get_lang_copy('PASSWORD_REQUIRED'));
//$this->oCRNRSTN_USR->init_validation_message('crnrstn_signin_flagship','crnrstn_auth_e', 'Email is required.');
//$this->oCRNRSTN_USR->init_validation_message('crnrstn_signin_flagship','crnrstn_auth_pwd', 'Password is required.');

//
// THESE FIELDS ARE HIDDEN INPUT FIELDS. WE CAN TUNNEL
// ENCRYPT THE DATA GOING HERE.
# $this->oCRNRSTN_USR->form_hidden_input_add({crnrstn_pssdtl_packet}, {HTML_DOM_FORM_INPUT_NAME}, {IS_REQUIRED}, {DEFAULT_VALUE <-notrequired}, {HTML_DOM_FORM_INPUT_ID <-notrequired});
$this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_signin_flagship', 'crnrstn_country_iso_code', true, $this->oCRNRSTN_USR->country_iso_code, 'crnrstn_country_iso_code');
$this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_signin_flagship', 'crnrstn_php_sessionid', true, session_id(), 'crnrstn_php_sessionid');

$channel_constant = $this->oCRNRSTN_USR->return_set_bits($this->oCRNRSTN_USR->system_output_channel_constants);

switch($channel_constant[0]){
    case '12345':
        //
        // MOBILE DEVICE EXPERIENCE
        $tmp_str = 'hello mobi world!';
        //$this->oCRNRSTN_USR->returnSrvrRespStatus(420);
        //exit();

    break;
    case 'null':

        //
        // TABLET DEVICE EXPERIENCE
        $tmp_str = 'hello tablet world!';

        if(1 == 2){

            //
            // MOBILE/TABLET DEVICE EXPERIENCE
            /*
             * To prefetch a page, add the data-prefetch attribute to a link that points to the page.
             * data-prefetch="true"
             * */
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <?php
                include_once($this->oCRNRSTN_USR->get_resource("DOCUMENT_ROOT").$this->oCRNRSTN_USR->get_resource("DOCUMENT_ROOT_DIR").'/common/inc/head/head.inc.php');
                ?>
            </head>

            <body>
            <div data-role="page" id="myPage">
                <?php

                //$tmp_HTML = $oSideBitch_Usr->return_page_html($tmp_page_serial, 'mobile');

                //$tmp_formUnique = $this->oCRNRSTN_USR->generate_new_key(4);
                //$tmp_pageName_Header =  strtolower($oSideBitch_Usr->get_category($tmp_page_serial)).' ::';
                //require($this->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$this->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR').'/common/inc/search/search.mobi.inc.php');
                //require($this->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$this->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR').'/common/inc/nav/sidenav.mobi.inc.php');
                //require($this->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$this->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR').'/common/inc/header/header.mobi.inc.php');

                $tmp = '420';
                switch($tmp){
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
                        $oMiniNav->configureLink('logs', $this->oCRNRSTN_USR->crnrstn_resources_http_path.'dashboard/logs/');
                        $oMiniNav->configureLink('refresh', $this->oCRNRSTN_USR->crnrstn_resources_http_path.'dashboard/');

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
                    echo 'hello world mobi!';
                    ?>

                </div><!-- /content -->

                <?php
                require($this->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$this->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR').'/common/inc/footer/footer.inc.php');

                ?>

            </div><!-- /page -->

            </body>
            </html>
            <?php

        }

    break;
    case CRNRSTN_UI_MOBILE:
    case CRNRSTN_UI_TABLET:
    default:
        // CRNRSTN_UI_DESKTOP:

        //
        // DESKTOP EXPERIENCE
        //$this->oCRNRSTN_USR->returnSrvrRespStatus(503);

        $tmp_http_root = $this->oCRNRSTN_USR->current_location();

        $tmp_str = '<!DOCTYPE html>
        <html lang="' . $this->oCRNRSTN_USR->country_iso_code . '">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            ' . $this->oCRNRSTN_USR->return_creative('CRNRSTN_FAVICON') . '
            ' . $this->oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_JS_JQUERY_UI) .
                $this->oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_CSS_MAIN_DESKTOP & CRNRSTN_UI_JS_MAIN_DESKTOP) . '
        </head>
        <body>
        <div class="crnrstn_body_wrapper">
    
            <div class="crnrstn_dyn_signin_hdr_branding_shell">
    
                <div class="crnrstn_env_select_wrapper">
                    <div class="crnrstn_env_select_component_wrapper">
                        <select name="crnrstn_host_endpoint" style="height: 15px; font-size: 11px; display:inline;">
                            <option value="0">-</option>
                            <option value="7">Apache v' . $this->oCRNRSTN_USR->version_apache() . '</option>
                            <option value="8">MySQLi v' . $this->oCRNRSTN_USR->version_mysqli() . '</option>
                            <option value="9">PHP v' . $this->oCRNRSTN_USR->version_php() .'</option>
                        </select>
                    </div>
                    <div class="crnrstn_cb"></div>
                    <div class="crnrstn_static_hdr_branding_shell">
                        <div class="crnrstn_static_hdr_branding_copy">C<span class="the_R_in_crnrstn">R</span>NRSTN :: v' . $this->oCRNRSTN_USR->version_crnrstn() . '</div>
                    </div>
    
                </div>
    
                <div class="crnrstn_dyn_branding_elem_wrapper signin">
                    <div class="crnrstn_dyn_branding_elem_shell">' . $this->oCRNRSTN_USR->return_branding_creative(true) . '</div>
                </div>
    
                    <div class="crnrstn_cb_5"></div>
                    
            </div>
    
            <div class="crnrstn_section_outter_wrapper signin">
                <div id="crnrstn_signin_bdr01_' . $this->page_serial . '"  class="crnrstn_section_inner_wrapper signin">
    
                    <div class="crnrstn_signin_meta_time_stats_wrapper">
                        <div id="crnrstn_signin_meta00_' . $this->page_serial . '" class="crnrstn_signin_meta_time_stats">[' . $this->oCRNRSTN_USR->return_micro_time() . ' ' . date('T') . '] [rtime ' . $this->oCRNRSTN_USR->wall_time() . ' secs] [wtime <span id="crnrstn_wtime_' . $this->page_serial . '"></span>]</div>
                        <div id="crnrstn_signin_meta01_' . $this->page_serial . '" class="crnrstn_signin_meta_5_logo">' . $this->oCRNRSTN_USR->return_creative('5') . '</div>
    
                        <div class="crnrstn_signin_backdrop_logo">' . $this->oCRNRSTN_USR->return_creative('CRNRSTN_LOGO') . '</div>
    
                        <div class="crnrstn_cb"></div>
                    </div>
    
                    <div class="crnrstn_cb"></div>
    
                    <div class="crnrstn_signin_form_outter_wrapper">
    
                        <div class="crnrstn_signin_form_inner_wrapper">
    
                            <div class="crnrstn_signin_form_inner_wrapper_rel">
    
                                <form id="crnrstn_signin_flagship_' . $this->page_serial . '" name="crnrstn_signin_flagship" action="#" method="post" enctype="multipart/form-data">
    
                                    <div class="crnrstn_signin_email_input_component">
    
                                        <div class="crnrstn_err_wrap_outter_email crnrstn_err_wrap">
                                            <div class="crnrstn_err_wrap_inner_email">
                                                <div class="crnrstn_err_wrap_email" style="background-image:url(\'' . $this->oCRNRSTN_USR->return_creative('CRNRSTN_LOGO', CRNRSTN_UI_IMG_PNG) . '\');">
                                                    <div id="crnrstn_auth_e_ERR" class="crnrstn_err_wrap_copy">Email is Required.&nbsp;&nbsp;&nbsp;</div>
                                                </div>
                                            </div>
    
                                        </div>
    
                                        <div class="crnrstn_bdr_input_err">
                                            <div class="crnrstn_bdr_input_err_gapper">
                                                <div class="crnrstn_input_outter_wrapper">
                                                    <div class="crnrstn_input_inner_wrapper">
                                                        <input type="text" name="crnrstn_auth_e" id="crnrstn_auth_e_' . $this->page_serial . '" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="crnrstn_cb"></div>
    
                                        </div>
    
                                        <div class="crnrstn_form_input_label signin"><label for="crnrstn_auth_e">' . $this->oCRNRSTN_USR->get_lang_copy('INPUT_LABEL_EMAIL') . ' <span class="crnrstn_form_input_label_req_star">*</span></label></div>
                                        <div class="crnrstn_cb"></div>
    
                                    </div>
                                    
                                    <div class="crnrstn_cb"></div>
                                
                                    <div class="crnrstn_signin_password_input_component">
                                    
                                    <div class="crnrstn_err_wrap_outter_password crnrstn_err_wrap">
                                        <div class="crnrstn_err_wrap_inner_password">
                                            <div class="crnrstn_err_wrap_password" style="background-image:url(\'' . $this->oCRNRSTN_USR->return_creative('CRNRSTN_LOGO', CRNRSTN_UI_IMG_PNG) . '\');">
                                                <div id="crnrstn_auth_pwd_ERR" class="crnrstn_err_wrap_copy">Password is Required&nbsp;&nbsp;&nbsp;</div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="crnrstn_bdr_input_err">
                                        <div class="crnrstn_bdr_input_err_gapper">
                                            <div class="crnrstn_input_outter_wrapper">
                                                <div class="crnrstn_input_inner_wrapper">
                                                    <input type="password" name="crnrstn_auth_pwd" id="crnrstn_auth_pwd_' . $this->page_serial . '" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="crnrstn_cb"></div>
                                    </div>
                                    
                                    </div>
    
                                    <div class="crnrstn_form_input_label signin"><label for="crnrstn_auth_pwd">' . $this->oCRNRSTN_USR->get_lang_copy('INPUT_LABEL_PASSWORD') . ' <span class="crnrstn_form_input_label_req_star">*</span></label></div>
        
                                    <div class="crnrstn_cb_10"></div>
                                    
                                    <div class="crnrstn_signin_module_wrapper">
                                           
                                        <div class="crnrstn_signin_button_wrapper">
                                            <button type="submit" id="submit_' . $this->page_serial . '">' . $this->oCRNRSTN_USR->get_lang_copy('BTN_TEXT_SIGN_IN') . '</button>
                                        </div>
    
                                        <div class="crnrstn_signin_create_account_copy">' . $this->oCRNRSTN_USR->get_lang_copy('COPY_PART1_NEED_TO') . ' <a href="#" target="_self">' . $this->oCRNRSTN_USR->get_lang_copy('COPY_PART2_CREATE_ACCOUNT') . '</a> ' . $this->oCRNRSTN_USR->get_lang_copy('COPY_PART_x_OR') . '<br><a href="#" target="_self">' . $this->oCRNRSTN_USR->get_lang_copy('COPY_PART3_FORGET_PWD') . '</a>?</div>
    
                                        <div class="crnrstn_cb"></div>
    
                                        <div class="crnrstn_signin_module_stats_wrapper">
                                            <div class="crnrstn_signin_module_stats_ip_wrapper">' . $this->oCRNRSTN_USR->get_lang_copy('COPY_YOUR_IP') . ' :: <span class="crnrstn_signin_module_stats_ip">' . $this->oCRNRSTN_USR->return_client_ip() . '</span></div>
                                            <div class="crnrstn_signin_module_stats_attempts">' . $this->oCRNRSTN_USR->get_lang_copy('COPY_LOGIN_ATTEMPTS') . ' :: ' . $this->oCRNRSTN_USR->account_max_login_attempts() . '</div>
                                            <div class="crnrstn_signin_module_stats_remaining">' . $this->oCRNRSTN_USR->get_lang_copy('COPY_ATTEMPTS_REMAINING') . ' :: <span id="crnrstn_signin_module_stats_remaining_cnt" class="crnrstn_signin_module_stats_remaining_cnt">' . $this->oCRNRSTN_USR->account_remaining_login_attempts() . '</span></div>
                                            <!--<div style="text-align:right; color: #000; font-size:10px; font-family: Courier, monospace">Access denied :: <span style="color: #F90000;">30 min</span></div>-->
    
                                        </div>
                                        
                                        <div class="crnrstn_cb"></div>
    
                                    </div>
    
                                    <div class="crnrstn_frm_errstatus crnrstn_email_req_mobile" style="width:100%; display:none;">Email is required.</div>
                                    <div class="crnrstn_frm_errstatus crnrstn_email_invalid_mobile" style="width:100%; display:none;">Email is invalid.</div>
                                    <div class="crnrstn_frm_errstatus crnrstn_pwd_req_mobile" style="width:100%; display:none;">Password is required.</div>
                                    <div class="crnrstn_frm_errstatus crnrstn_account_locked" style="width:100%; display:none;">Login invalid.</div>
                                    <div class="crnrstn_frm_errstatus crnrstn_account_locked" style="width:100%; display:none;">Account locked.</div>
                                    <div class="crnrstn_frm_errstatus crnrstn_account_admin_deleted" style="width:100%; display:none;">Account admin deleted.</div>
                                    <div class="crnrstn_frm_errstatus crnrstn_account_user_deleted" style="width:100%; display:none;">Account user deleted.</div>
                                    <div class="crnrstn_frm_errstatus crnrstn_account_activate" style="width:100%; display:none;">The account has not yet been activated. <a href="' . $this->oCRNRSTN_USR->crnrstn_resources_http_path . 'account/activate/resend/" target="_self" style="text-decoration:none; color:#06C;text-decoration:underline;">Click here</a> to resend your activation email.</div>
                                   
                                    <div class="crnrstn_hidden">
                                        <div id="crnrstn_rtime_src_' . $this->page_serial . '"></div>
                                        <div id="crnrstn_wtime_src_' . $this->page_serial . '">0:00:00</div>
                                    </div>
                                   
                                    ' . $this->oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_FORM_INTEGRATION_PACKET, 'crnrstn_signin_flagship') . '
                                    
                                </form>
    
                            </div>
    
                        </div>
    
                    </div>
    
                </div>
    
            </div>
    
            <div class="crnrstn_signin_reflection_wrapper">
                <div class="crnrstn_signin_reflection_wrapper_rel">
                    <div class="crnrstn_signin_reflection_img_shell">' . $this->oCRNRSTN_USR->return_creative('BG_ELEMENT_REFLECTION_SIGNING') . '</div>
                </div>
            </div>
            
            <div class="crnrstn_cb_20"></div>
    
            <div class="crnrstn_signin_copyright_shell">&copy; 2012-' . date('Y') . ' Jonathan \'J5\' Harris :: ' . $this->oCRNRSTN_USR->get_lang_copy('COPY_ALL_RIGHTS_PART1') . '<br> ' . $this->oCRNRSTN_USR->get_lang_copy('COPY_ALL_RIGHTS_PART2') . ' <a href="' . $tmp_http_root . '&crnrstn_mit=true" target="_self">' . $this->oCRNRSTN_USR->get_lang_copy('COPY_ALL_RIGHTS_PART_MIT') . '</a>.</div>
            
            <div class="crnrstn_cb_40"></div>
    
            <div class="crnrstn_j5_wolf_pup_outter_wrap">
                <div class="crnrstn_j5_wolf_pup_inner_wrap">
                    ' . $this->oCRNRSTN_USR->return_creative('J5_WOLF_PUP_RAND') . '
                </div>
            </div>
    
            <div class="crnrstn_cb"></div>
            <div class="crnrstn_hidden_">
                <div id="ui_module_alerts_out">' . $this->oCRNRSTN_USR->ui_module_alerts_out() . '</div>
            </div>
    
        </div>
    
        ' . $this->oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_TAG_ANALYTICS) . '
        ' . $this->oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_TAG_ENGAGEMENT) . '
        
        </body>
        </html>';

    break;

}