<?php
/*
// J5
// Code is Poetry */
$channel_constant = $this->oCRNRSTN_USR->return_set_bits($this->oCRNRSTN_USR->system_device_channel_constants());

switch($channel_constant[0]){
    case CRNRSTN_CHANNEL_MOBILE:

        //
        // MOBILE DEVICE EXPERIENCE
        echo 'hello mobi world!';
        //$this->oCRNRSTN_USR->returnSrvrRespStatus(420);
        //exit();

    break;
    case CRNRSTN_CHANNEL_TABLET:

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
        // CRNRSTN_CHANNEL_DESKTOP:

        //
        // DESKTOP EXPERIENCE
        //$this->oCRNRSTN_USR->returnSrvrRespStatus(503);
        $tmp_array = array();
        $tmp_array[] = 'crnrstn_mit=true';

        $tmp_mit_lnk = $this->oCRNRSTN_USR->append_url_param($tmp_array);


        $tmp_array_encry = array();
        $tmp_array_encry[] = 'crnrstn_l=config_wordpress';

        $tmp_array_dash_encry = array();
        $tmp_array_dash_encry[] = 'crnrstn_l=dashboard';

        $tmp_lnk_config_wordpress = $this->oCRNRSTN_USR->append_url_param($tmp_array_encry, true);

        $tmp_lnk_welcome = $this->oCRNRSTN_USR->append_url_param($tmp_array_dash_encry, true);

        error_log(__LINE__ . ' config_wp is loading.....');

        $tmp_str = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        ' . $this->oCRNRSTN_USR->return_creative('CRNRSTN_FAVICON') . '
        ' . $this->oCRNRSTN_USR->ui_content_module_out(CRNRSTN_JS_FRAMEWORK_JQUERY_UI) .
            $this->oCRNRSTN_USR->ui_content_module_out(CRNRSTN_CSS_MAIN_DESKTOP & CRNRSTN_JS_MAIN) . '
    </head>
    <body class="crnrstn-disable-scrolling">
    <div class="crnrstn_body_wrapper">
        <div class="crnrstn_body_shell">
            <div class="crnrstn_hdr_branding_shell">
                <div class="crnrstn_logo_bg_wrapper" onclick="load_page(\'' . $tmp_lnk_welcome . '\');">
                    <div class="crnrstn_logo_bg" style="background-image:url(\'' . $this->oCRNRSTN_USR->return_creative('CRNRSTN_LOGO', CRNRSTN_PNG) . '\');"></div>
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
                        <h1>C<span class="the_R_in_crnrstn">R</span>NRSTN :: WordPress Configuration</h1>
                        <pre><code>// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define(\'DB_NAME\', \'' . $this->oCRNRSTN_USR->wp_db_name() . '\');

/** MySQL database username */
define(\'DB_USER\', \'' . $this->oCRNRSTN_USR->wp_db_user() . '\');

/** MySQL database password */
define(\'DB_PASSWORD\', \'*****\');

/** MySQL hostname */
define(\'DB_HOST\', \'' . $this->oCRNRSTN_USR->wp_db_host() . '\');

/** Database Charset to use in creating database tables. */
define(\'DB_CHARSET\', \'' . $this->oCRNRSTN_USR->wp_db_charset() . '\');

/** The Database Collate type. Don\'t change this if in doubt. */
define(\'DB_COLLATE\', \'' . $this->oCRNRSTN_USR->wp_db_collate() . '\');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all 
 * existing cookies. This will force all users to have to log 
 * in again.
 *
 * @since 2.6.0
 */
define(\'AUTH_KEY\',         \'' . htmlentities($this->oCRNRSTN_USR->wp_auth_key()) . '\');   
define(\'SECURE_AUTH_KEY\',  \'' . htmlentities($this->oCRNRSTN_USR->wp_secure_auth_key()) . '\');   
define(\'LOGGED_IN_KEY\',    \'' . htmlentities($this->oCRNRSTN_USR->wp_logged_in_key()) . '\');   
define(\'NONCE_KEY\',        \'' . htmlentities($this->oCRNRSTN_USR->wp_nonce_key()) . '\');   
define(\'AUTH_SALT\',        \'' . htmlentities($this->oCRNRSTN_USR->wp_auth_salt()) . '\');   
define(\'SECURE_AUTH_SALT\', \'' . htmlentities($this->oCRNRSTN_USR->wp_secure_auth_salt()) . '\');   
define(\'LOGGED_IN_SALT\',   \'' . htmlentities($this->oCRNRSTN_USR->wp_logged_in_salt()) . '\');   
define(\'NONCE_SALT\',       \'' . htmlentities($this->oCRNRSTN_USR->wp_nonce_salt()) . '\');   

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you 
 * give each a unique prefix. Only numbers, letters, and 
 * underscores please!
 */
$table_prefix  = \'' . $this->oCRNRSTN_USR->wp_table_prefix() . '\';    

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during 
 * development. It is strongly recommended that plugin and 
 * theme developers use WP_DEBUG in their 
 * development environments.
 *
 * For information on other constants that can be used for 
 * debugging, visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define(\'WP_DEBUG\', \'' . $this->oCRNRSTN_USR->tidy_boolean($this->oCRNRSTN_USR->wp_debug(), 'string') . '\');   

</code></pre>
                
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
                            
                                <div id="crnrstn_meta00_' . $this->page_serial.'" class="crnrstn_meta_time_stats">[' . $this->oCRNRSTN_USR->return_micro_time().' '.date('T').'] [rtime ' . $this->oCRNRSTN_USR->wall_time().' secs] [wtime <span id="crnrstn_wtime_' . $this->page_serial.'"></span>] <div class="crnrstn_meta_5_logo">' . $this->oCRNRSTN_USR->return_creative('FIVE', CRNRSTN_HTML).'</div></div>
                  
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
       
        <div class="crnrstn_j5_wolf_pup_outter_wrap">
            <div class="crnrstn_j5_wolf_pup_inner_wrap">
                ' . $this->oCRNRSTN_USR->return_creative('J5_WOLF_PUP_RAND').'
            </div>
        </div>
        
        <div class="crnrstn_cb"></div>
        
    </div>

    ' . $this->oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_TAG_ANALYTICS).'
    ' . $this->oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_TAG_ENGAGEMENT).'
    
    </body>
    </html>';

    break;

}