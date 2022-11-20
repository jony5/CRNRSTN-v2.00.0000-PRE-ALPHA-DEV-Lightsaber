<?php
/*
// J5
// Code is Poetry */
$channel_constant = $this->oCRNRSTN_USR->return_set_bits($this->oCRNRSTN_USR->system_output_channel_constants);

switch($channel_constant[0]){
    case CRNRSTN_UI_MOBILE:

        //
        // MOBILE DEVICE EXPERIENCE
        echo 'hello mobi world!';
        //$this->oCRNRSTN_USR->returnSrvrRespStatus(420);
        //exit();

    break;
    case CRNRSTN_UI_TABLET:

        //
        // TABLET DEVICE EXPERIENCE
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
                    //$oMiniNav->configureLink('streams', $this->oCRNRSTN_USR->crnrstn_http_endpoint.'dashboard/streams/?kid=' . $this->oCRNRSTN_USR->oHTTP_MGR->extractData($_GET, 'kid'));
                    //$oMiniNav->configureLink('obs clients', $this->oCRNRSTN_USR->crnrstn_http_endpoint.'dashboard/obs/');
                    //$oMiniNav->configureLink('logs', $this->oCRNRSTN_USR->crnrstn_http_endpoint.'dashboard/logs/');
                    //$oMiniNav->configureLink('refresh', $this->oCRNRSTN_USR->crnrstn_http_endpoint.'dashboard/');

                    break;
                case '320':
                    //
                    // SAINT SERVING TRANSLATION
                    $oMiniNav = new miniNav('translation_saint', $this->oCRNRSTN_USR);
                    //$oMiniNav->configureLink('streams', $this->oCRNRSTN_USR->crnrstn_http_endpoint.'dashboard/streams/?kid=' . $this->oCRNRSTN_USR->oHTTP_MGR->extractData($_GET, 'kid'));
                    $oMiniNav->configureLink('logs', $this->oCRNRSTN_USR->crnrstn_http_endpoint.'dashboard/logs/');
                    $oMiniNav->configureLink('refresh', $this->oCRNRSTN_USR->crnrstn_http_endpoint.'dashboard/');

                    break;

            }

            //$tmp_formUnique = $this->oCRNRSTN_USR->generate_new_key(4);
            //$tmp_pageName_Header = 'home ::';
            //require($this->oCRNRSTN_USR->crnrstn_http_endpoint.'/common/inc/search/search.mobi.inc.php');
            //require($this->oCRNRSTN_USR->crnrstn_http_endpoint.'/common/inc/nav/sidenav.mobi.inc.php');
            //require($this->oCRNRSTN_USR->crnrstn_http_endpoint.'/common/inc/header/header.mobi.inc.php');

            ?>

            <!--
            //
            // BEGIN MAIN CONTENT -->
            <div role="main" class="ui-content" id="myPage">
                <?php
                echo 'hello world tablet!';
                ?>

            </div><!-- /content -->

            <?php
            require($this->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$this->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR').'/common/inc/footer/footer.inc.php');

            ?>

        </div><!-- /page -->

        </body>
        </html>
        <?php

    break;
    default:
        // CRNRSTN_UI_DESKTOP:

        //
        // DESKTOP EXPERIENCE
        //$this->oCRNRSTN_USR->returnSrvrRespStatus(503);
        $tmp_array = array();
        $tmp_array[] = 'crnrstn_mit=true';
        $tmp_mit_lnk = $this->oCRNRSTN_USR->append_url_param($tmp_array);

        $tmp_array_encry = array();
        $tmp_array_encry[] = 'crnrstn_l=' . $this->oCRNRSTN_USR->param_tunnel_encrypt('config_wordpress');

        $tmp_array_dash_encry = array();
        $tmp_array_dash_encry[] = 'crnrstn_l=' . $this->oCRNRSTN_USR->param_tunnel_encrypt('dashboard');

        $tmp_lnk_config_wordpress = $this->oCRNRSTN_USR->append_url_param($tmp_array_encry, true);

        $tmp_lnk_welcome = $this->oCRNRSTN_USR->append_url_param($tmp_array_dash_encry, true);

        $tmp_str = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        ' . $this->oCRNRSTN_USR->return_creative('CRNRSTN_FAVICON') . '
        ' . $this->oCRNRSTN_USR->ui_content_module_out(CRNRSTN_JS_FRAMEWORK_JQUERY_UI) .
            $this->oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_CSS_MAIN_DESKTOP & CRNRSTN_UI_JS_MAIN) . '
    </head>
    <body class="crnrstn-disable-scrolling">
    <div class="crnrstn_body_wrapper">
        <div class="crnrstn_body_shell">
            <div class="crnrstn_hdr_branding_shell">
                <div class="crnrstn_logo_bg_wrapper" onclick="load_page(\'' . $tmp_lnk_welcome . '\');">
                    <div class="crnrstn_logo_bg" style="background-image:url(\'' . $this->oCRNRSTN_USR->return_creative('CRNRSTN_LOGO', CRNRSTN_UI_IMG_PNG) . '\');"></div>
                </div>
                
                <div class="crnrstn_branding_elem_wrapper">
                    <div class="crnrstn_branding_elem_content">
                        <div class="crnrstn_branding_elem_shell">' . $this->oCRNRSTN_USR->return_branding_creative(true).'</div>
                    </div>
                </div>
    
                <div class="crnrstn_cb_5"></div>
                    
            </div>
            
            <div class="crnrstn_left_nav_abs_wrapper">
                <div class="crnrstn_left_nav_rel_wrapper">
                    
                    <div class="crnrstn_left_nav_col_wrapper">
                        <div class="crnrstn_left_nav_button_wrapper">
                            <ul>
                                <li><div class="crnrstn_left_nav_li_btn_shell">System Information</div></li>
                                <div class="crnrstn_cb_10"></div>
                                <li><div class="crnrstn_left_nav_li_btn_shell">C<span class="the_R_in_crnrstn">R</span>NRSTN :: Configuration</div></li>
                                <div class="crnrstn_cb_10"></div>
                                <li onclick="load_page(\'' . $tmp_lnk_config_wordpress . '\');"><div class="crnrstn_left_nav_li_btn_shell crnrstn_nav_active">WordPress<span style="crnrstn_wp_btn_reg_mrk">&reg;</span> Configuration</li>
                                <div class="crnrstn_cb_10"></div>
                                <li><div class="crnrstn_left_nav_li_btn_shell">PHP Configuration</li>
                                <div class="crnrstn_cb_10"></div>
                                <li><div class="crnrstn_left_nav_li_btn_shell">SOAP Configuration</li>
                                <div class="crnrstn_cb_10"></div>
                                <li><div class="crnrstn_left_nav_li_btn_shell">HTML CSS Validator</li>
                                <div class="crnrstn_cb_10"></div>
                                <li><div class="crnrstn_left_nav_li_btn_shell">License</li>
                                <div class="crnrstn_cb_10"></div>
                                <li><div class="crnrstn_left_nav_li_btn_shell">C<span class="the_R_in_crnrstn">R</span>NRSTN :: Debug Trace</li>
                                <div class="crnrstn_cb_10"></div>
                                <li><div class="crnrstn_left_nav_li_btn_shell">Native PHP Error Logs</div></li>
                            </ul>
                            <div class="crnrstn_cb_10"></div>
                        </div>
                    </div>
                </div>
            </div>
    
          
            <div class="crnrstn_right_section_abs_out_wrapper">
            <div id="crnrstn_right_section_abs_wrapper" class="crnrstn_right_section_abs_wrapper">
                <div class="crnrstn_right_section_rel_wrapper">
                    <h1>Welcome to C<span class="the_R_in_crnrstn">R</span>NRSTN ::</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In 
            vitae molestie lorem. Morbi bibendum fermentum semper. Sed 
            eget lobortis nisi. Sed fringilla purus et nunc molestie, in 
            condimentum est mattis.</p>
            
                    <p>Orci varius natoque penatibus et magnis dis parturient montes, 
            nascetur ridiculus mus. Pellentesque nisi justo, cursus fringilla 
            enim sit amet, condimentum tristique urna. Aliquam imperdiet 
            ex tempor mi accumsan, et gravida ante pellentesque. Nullam 
            eleifend accumsan tellus at maximus. Morbi finibus porta quam, 
            eget tempor velit aliquam vitae. Suspendisse potenti. Nullam 
            sit amet rhoncus eros.</p>
            
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In 
            vitae molestie lorem. Morbi bibendum fermentum semper. Sed 
            eget lobortis nisi. Sed fringilla purus et nunc molestie, in 
            condimentum est mattis.</p>
            
                    <p>Orci varius natoque penatibus et magnis dis parturient montes, 
            nascetur ridiculus mus. Pellentesque nisi justo, cursus fringilla 
            enim sit amet, condimentum tristique urna. Aliquam imperdiet 
            ex tempor mi accumsan, et gravida ante pellentesque. Nullam 
            eleifend accumsan tellus at maximus. Morbi finibus porta quam, 
            eget tempor velit aliquam vitae. Suspendisse potenti. Nullam 
            sit amet rhoncus eros.</p>
            
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In 
            vitae molestie lorem. Morbi bibendum fermentum semper. Sed 
            eget lobortis nisi. Sed fringilla purus et nunc molestie, in 
            condimentum est mattis.</p>
            
                    <p>Orci varius natoque penatibus et magnis dis parturient montes, 
            nascetur ridiculus mus. Pellentesque nisi justo, cursus fringilla 
            enim sit amet, condimentum tristique urna. Aliquam imperdiet 
            ex tempor mi accumsan, et gravida ante pellentesque. Nullam 
            eleifend accumsan tellus at maximus. Morbi finibus porta quam, 
            eget tempor velit aliquam vitae. Suspendisse potenti. Nullam 
            sit amet rhoncus eros.</p>
            
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In 
            vitae molestie lorem. Morbi bibendum fermentum semper. Sed 
            eget lobortis nisi. Sed fringilla purus et nunc molestie, in 
            condimentum est mattis.</p>
            
                    <p>Orci varius natoque penatibus et magnis dis parturient montes, 
            nascetur ridiculus mus. Pellentesque nisi justo, cursus fringilla 
            enim sit amet, condimentum tristique urna. Aliquam imperdiet 
            ex tempor mi accumsan, et gravida ante pellentesque. Nullam 
            eleifend accumsan tellus at maximus. Morbi finibus porta quam, 
            eget tempor velit aliquam vitae. Suspendisse potenti. Nullam 
            sit amet rhoncus eros.</p>
            
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In 
            vitae molestie lorem. Morbi bibendum fermentum semper. Sed 
            eget lobortis nisi. Sed fringilla purus et nunc molestie, in 
            condimentum est mattis.</p>
            
                    <p>Orci varius natoque penatibus et magnis dis parturient montes, 
            nascetur ridiculus mus. Pellentesque nisi justo, cursus fringilla 
            enim sit amet, condimentum tristique urna. Aliquam imperdiet 
            ex tempor mi accumsan, et gravida ante pellentesque. Nullam 
            eleifend accumsan tellus at maximus. Morbi finibus porta quam, 
            eget tempor velit aliquam vitae. Suspendisse potenti. Nullam 
            sit amet rhoncus eros.</p>
                    </div>      
                     
                </div>
            </div>
            
            <div class="crnrstn_cb_10"></div>
                        
            <div id="crnrstn_footer_abs_wrapper" class="crnrstn_footer_abs_wrapper">
                <div class="crnrstn_footer_rel_wrapper">
                    <div class="crnrstn_cb_10"></div>
                    
                    <div class="crnrstn_footer_content_wrapper">
                    
                        <div class="crnrstn_meta_time_stats_wrapper">
                                        
                            <div class="crnrstn_meta_time_stats_content">
                            
                                <div id="crnrstn_meta00_' . $this->page_serial.'" class="crnrstn_meta_time_stats">[' . $this->oCRNRSTN_USR->return_micro_time().' '.date('T').'] [rtime ' . $this->oCRNRSTN_USR->wall_time().' secs] [wtime <span id="crnrstn_wtime_' . $this->page_serial.'"></span>] <div class="crnrstn_meta_5_logo">' . $this->oCRNRSTN_USR->return_creative('FIVE', CRNRSTN_UI_IMG_HTML_WRAPPED).'</div></div>
                  
                            </div>  
                              
                            <div class="crnrstn_cb"></div>
                                
                        </div>
                        
                        <div class="crnrstn_cb_20"></div>
                
                        <div class="crnrstn_copyright_shell">&copy; 2012-'.date('Y').' Jonathan \'J5\' Harris :: All Rights Reserved in accordance with<br>the latest version of the <a href="' . $tmp_mit_lnk.'" target="_self">MIT License</a>.</div>
                        
                        <div class="crnrstn_cb_40"></div>
                    
                    </div>
                    
                </div>
                
            </div>
            
        </div>
       
        <div id="crnrstn_j5_wolf_pup_outter_wrap" class="crnrstn_j5_wolf_pup_outter_wrap">
            <divc class="crnrstn_j5_wolf_pup_inner_wrap">
                ' . $this->oCRNRSTN_USR->return_creative('J5_WOLF_PUP_RAND').'
            </divc>
        </div>
        
        <div class="crnrstn_cb"></div>
        
    </div>

    ' . $this->oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_TAG_ANALYTICS).'
    ' . $this->oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_TAG_ENGAGEMENT).'
    
    </body>
    </html>';

    break;

}