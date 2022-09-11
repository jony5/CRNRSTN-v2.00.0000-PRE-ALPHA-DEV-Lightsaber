<?php
/*
// J5
// Code is Poetry */
#
#  CRNRSTN ::
#  VERSION :: 2.00.0000 PRE-ALPHA-DEV
#  DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#  AUTHOR :: Jonathan 'J5' Harris, Lead Full Stack Developer
#  URI :: http://crnrstn.evifweb.com/
#  DESCRIPTION :: CRNRSTN :: An Open Source PHP Class Library providing a robust services interface layer to both
#       facilitate, augment, and enhance the operations of code base for an application across multiple hosting
#       environments. Copyright (C) 2012-2021 eVifweb development.
#  OVERVIEW :: CRNRSTN :: is an open source PHP class library that facilitates the operation of an application within
#       multiple server environments (e.g. localhost, stage, preprod, and production). With this tool, data and
#       functionality with characteristics that inherently create distinctions from one environment to the next...such
#       as IP address restrictions, error logging profiles, and database authentication credentials...can all be
#       managed through one framework for an entire application. Once CRNRSTN :: has been configured for your different
#       hosting environments, seamlessly release a web application from one environment to the next without having to
#       change your code-base to account for environmentally specific parameters. Receive the benefit of a robust and
#       polished framework for bubbling up exception notifications through any output of your choosing. Take advantage
#       of the CRNRSTN :: SOAP Services layer supporting many to 1 proxy messaging relationships between slave and
#       master servers; regarding server communications i.e. notifications, some architectures will depend on one
#       master to support the communications needs of many slaves with respect their roles and responsibilities in
#       regards to sending an email. With CRNRSTN ::, slaves configured to log exceptions via EMAIL_PROXY will send
#       all of their internal system notifications to one master server (proxy) which server would posses the (if
#       necessary) SMTP credentials for authorization to access and execute more restricted communications
#       protocols of the network.
#  LICENSE :: MIT
#       Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
#       documentation files (the "Software"), to deal in the Software without restriction, including without limitation
#       the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software,
#       and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
#
#       The above copyright notice and this permission notice shall be included in all copies or substantial portions
#       of the Software.
#
#       THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
#       TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
#       THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF
#       CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
#       DEALINGS IN THE SOFTWARE.
#
# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: crnrstn_environment
#  VERSION :: 2.00.0000
#  DATE :: September 11, 2012 @ 1720hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: Used to be the first one to know who you are,...thx for this,...crnrstn. 8/20/2022 @ 0410 hrs
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_environment {

    private static $config_serial;
    public $config_serial_hash;

    protected $oLogger;

    private static $oLog_ProfileManager;

    private static $lang_content_ARRAY = array();
    private static $sys_logging_profile_ARRAY = array();
    private static $sys_logging_meta_ARRAY = array();
    private static $system_database_table_prefix = 'crnrstn_';

    public $env_key;
    public $env_key_hash;
    protected $system_hash_algo;
    public $total_bytes_encrypted = 0;

    public $oCRNRSTN;
    public $oCRNRSTN_USR;
    protected $oCRNRSTN_DEV_INPUT_CONTROLLER;
    protected $oCRNRSTN_BITFLIP_MGR;
    public $oCRNRSTN_IPSECURITY_MGR;
    public $oSESSION_MGR;
    public $oCOOKIE_MGR;

    public $oHTTP_MGR;
    public $oFINITE_EXPRESS;
    public $oCRNRSTN_LANG_MGR;
    public $oCRNRSTN_ASSET_MGR;
    public $oCRNRSTN_MEDIA_CONVERTOR;

    private static $sess_env_param_ARRAY = array();
    private static $m_starttime = array();
    public $encryptableDataTypes = array();
    private static $openssl_digest_profile;
    public $system_resource_constants = array();
    public $system_theme_style_constants_ARRAY = array();
    public $system_output_profile_constants = array();
    public $system_output_channel_constants = array();
    private static $system_creative_element_keys_ARRAY = array();
    private static $weighted_elements_keys_ARRAY = array();
    public $soap_permissions_file_path_ARRAY = array();
    public $response_header_attribute_ARRAY = array();
    
    private static $requestProtocol;

    public $log_silo_profile;
    public $starttime;
    public $oWildCardResource_ARRAY = array();
    public $wildCardResource_filePath = array();
    public $ini_set_ARRAY = array();
    public $env_key_ARRAY = array();
    protected $is_soap_data_tunnel_endpoint = false;
    public $destruct_output;
    public $sys_notices_creative_mode = 'ALL_HTML';
    public $system_setting_jpg_image_quality = 100;  // 0 = worst / smaller file, 100 = better / bigger file

    protected $oSOAP_services_access_manager = array();
    protected $oSOAP_services_oClient_manager = array();
    protected $oSOAP_services_oAuth_manager = array();

    protected $oAdminAccount_ARRAY = array();

    public $cache_ttl_default = 80;
    public $useCURL_default = true;
    protected $max_login_attempts = 10;
    protected $max_seconds_inactive = 600;
    public $operating_system;
    public $process_id;
    private static $process_id_perf_stat_ARRAY = array();

    public function __construct($oCRNRSTN, $instanceType = NULL, $WORDPRESS_debug_mode = NULL) {

        $this->oCRNRSTN = $oCRNRSTN;
        $this->env_key = $oCRNRSTN->get_server_env();
        $this->env_key_hash = $oCRNRSTN->get_server_env('hash');
        $this->system_hash_algo = $oCRNRSTN->system_hash_algorithm();
        $this->starttime = $oCRNRSTN->starttime;
        self::$system_database_table_prefix = $oCRNRSTN->system_database_table_prefix;
        $this->sys_notices_creative_mode = $oCRNRSTN->sys_notices_creative_mode;
        $this->oCRNRSTN_BITFLIP_MGR = $oCRNRSTN->oCRNRSTN_BITFLIP_MGR;
        $this->oCRNRSTN_LANG_MGR = $oCRNRSTN->oCRNRSTN_LANG_MGR;

        $this->operating_system = $oCRNRSTN->operating_system;
        self::$openssl_digest_profile = $oCRNRSTN->return_openssl_digest_method();
        $this->process_id = $oCRNRSTN->process_id;

        //
        // INITIALIZE ENCRYPTION PROFILE
        $this->init_encrypt_profile($oCRNRSTN);

        $this->system_resource_constants = $oCRNRSTN->system_resource_constants();
        $this->system_theme_style_constants_ARRAY = $oCRNRSTN->system_theme_style_constants_ARRAY;
        $this->system_output_profile_constants = $oCRNRSTN->system_output_profile_constants;
        $this->system_output_channel_constants = $oCRNRSTN->system_output_channel_constants;

        self::$system_creative_element_keys_ARRAY = $oCRNRSTN->system_creative_element_keys_ARRAY;
        self::$weighted_elements_keys_ARRAY = $oCRNRSTN->weighted_elements_keys_ARRAY;

        self::$lang_content_ARRAY = $oCRNRSTN->return_lang_content_ARRAY();

        $this->ini_set_ARRAY = $oCRNRSTN->ini_set_ARRAY;
        $this->response_header_attribute_ARRAY = $oCRNRSTN->response_header_attribute_ARRAY;

        //
        // ROLL OVER ENVIRONMENT NAMES
        $this->env_key_ARRAY = $oCRNRSTN->env_key_ARRAY;

        //
        // ROLL OVER SOAP PERMISSIONS
        $this->soap_permissions_file_path_ARRAY = $oCRNRSTN->soap_permissions_file_path_ARRAY;

        //
        // ROLL OVER DEBUG/ERROR_LOG TRACE FROM CRNRSTN OBJECT AND THEN CONTINUE TO APPEND
        self::$m_starttime = $oCRNRSTN->return_m_start_time();

        $this->log_silo_profile = $oCRNRSTN->log_silo_profile;

        self::$oLog_ProfileManager = $oCRNRSTN->return_oLog_ProfileManager();
        self::$oLog_ProfileManager->sync_to_environment($oCRNRSTN, $this);

        $this->config_serial_hash = $oCRNRSTN->get_server_config_serial('hash');
        self::$config_serial = $oCRNRSTN->get_server_config_serial('raw');
        $this->oCRNRSTN_MEDIA_CONVERTOR = $oCRNRSTN->oCRNRSTN_MEDIA_CONVERTOR;

        $this->oLogger = new crnrstn_logging(__CLASS__, $this);

        //
        // TODO :: OBJECT INSTANTIATION REFACTORING TO SUPPORT PERSISTENCE OF STATE
        // COOKIE MANAGER SHOULD INSTANTIATE LOOKING FOR COOKIE::SSDTLA INTEGRATIONS FROM BROWSER...
        // SESSION MANAGER SHOULD INSTANTIATE LOOKING FOR...FROM SESSION....ETC. Thursday, August 18, 2022 @ 0247 hrs
        //$this->oCOOKIE_MGR = new crnrstn_cookie_manager();

        $this->oHTTP_MGR = new crnrstn_http_manager($oCRNRSTN, $this);
        $this->oFINITE_EXPRESS = new finite_expression();

        // August 20, 2022 @ 0418 hrs
        // UNTIL WE GET SESSION MGMT NAILED DOWN (DATABASE, COOKIE, SSDTLA, PSSDTLA, AND SESSION) THIS WILL
        // ALWAYS EVALUATE TO TRUE. NO SESSION PINGS, YET). RUNTIME OPERATION GOES FROM 0-100 WITH NO
        // SESSION CACHE ASSISTANCE AND IS UP TO 1 SECONDS FASTER ON PAGE LOADS! AND THIS LOW-LEVEL REFACTORING
        // OPERATION IS NOT EVEN COMPLETE, YET.
        if(!($instanceType == 'session_initialization_ping')){
            
            try{

                //
                //  DETERMINE KEY DESIGNATING THE RUNNING ENVIRONMENT, WHERE KEY = hash(env key)
                if($this->env_key_hash == ''){

                    //
                    // WE DON'T HAVE THE ENVIRONMENT DETECTED. THROW EXCEPTION.
                    // HOOOSTON...VE HAF PROBLEM!
                    //throw new Exception('CRNRSTN :: environmental configuration error :: unable to detect environment on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ').');
                    $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('CRNRSTN :: environmental configuration error :: unable to detect environment on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ').', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                    $this->oCRNRSTN->system_terminate('detection');

                    //error_log(__LINE__ . ' env ' . __METHOD__ . ' going out on 503.');
                    //$this->return_server_response_code(503, $this->return_CRNRSTN_ASCII_ART());
                    exit();

                }else{

                    // TODO :: DO NOT RUN THIS AGAIN. FIGURE SOMETHING ELSE OUT.
                    // FLASH WILD CARD RESOURCES OBJECT ARRAY TO ENVIRONMENTAL CLASS OBJECT
                    //$this->initializeWildCardResource($oCRNRSTN);

                    //$this->oSESSION_MGR = new crnrstn_session_manager($oCRNRSTN);

                    $this->oCRNRSTN_IPSECURITY_MGR = clone $oCRNRSTN->oCRNRSTN_IPSECURITY_MGR;
                    unset($oCRNRSTN->oCRNRSTN_IPSECURITY_MGR);

                    //
                    // WE HAVE SELECTED ENVIRONMENT KEY. INITIALIZE. CONFIG KEY AND ENV KEY.
                    // FLASH CONFIG KEY AND ENV KEY TO SESSION.
                    $this->initRuntimeConfig();

                    //
                    // INITIALIZE ERROR REPORTING FOR THIS ENVIRONMENT
                    $this->initializeErrorReporting($oCRNRSTN);

                    //
                    // INITIALIZE ENVIRONMENTAL LOGGING BEHAVIOR
                    $this->initEnvLoggingProfile($oCRNRSTN);

                    //
                    // INITIALIZE IP ADDRESS RESTRICTIONS from grantExclusiveAccess()
                    if(isset($oCRNRSTN->grant_accessIP_ARRAY[$this->config_serial_hash][$this->env_key_hash])){

                        $this->initExclusiveAccess($oCRNRSTN);

                    }

                    //
                    // INITIALIZE IP ADDRESS RESTRICTIONS from denyAccess()
                    if(isset($oCRNRSTN->deny_accessIP_ARRAY[$this->config_serial_hash][$this->env_key_hash])){

                        $this->initDenyAccess($oCRNRSTN);

                    }

                    //
                    // INITIALIZE ADMINISTRATOR ACCESS
                    if(isset($oCRNRSTN->add_admin_creds_ARRAY[$this->config_serial_hash][$this->env_key_hash])){

                        $this->initAdminAccess($oCRNRSTN);

                    }

                    //
                    // BEFORE ALLOCATING ADDITIONAL MEMORY RESOURCES, PROCESS IP AUTHENTICATION
                    if(isset($oCRNRSTN->grant_accessIP_ARRAY[$this->config_serial_hash][$this->env_key_hash]) || isset($oCRNRSTN->deny_accessIP_ARRAY[$this->config_serial_hash][$this->env_key_hash])){
                        //error_log(__LINE__ . ' env env_key=[' . $this->env_key . ']. die();');

                        $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('We have IP restrictions to process and apply for CRNRSTN :: config_serial_hash [' . $this->config_serial_hash . '] and environment key [' . $this->env_key_hash . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
                        //error_log(__LINE__ . ' env env_key=[' . $this->env_key . ']. die();');

                        if(!$this->oCRNRSTN_IPSECURITY_MGR->authorizeEnvAccess($this, $this->env_key_hash)){
                            error_log(__LINE__ . ' env authorizeEnvAccess() DENINED ON env_key=[' . $this->env_key . ']. die();');

                            die();
                            //
                            // WE COULD PERHAPS USE A MORE GRACEFUL WAY TO TRANSITION TO ERR...BUT THIS WORKS
                            // THE METHOD return_server_response_code() CONTAINS SOME CUSTOM HTML FOR OUTPUT IF YOU WANT TO TWEAK ITS DESIGN
                            // PERHAPS SOME FUTURE RELEASE OF CRNRSTN CAN
                            $this->return_server_response_code(403, $this->return_CRNRSTN_ASCII_ART());
                            exit();

                        }

                    }else{

                        $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('There are NO IP restrictions to process and apply for CRNRSTN :: config_serial_hash [' . $this->config_serial_hash . '] and environment key [' . $this->env_key_hash . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                    }

                    // TODO :: THIS IS CHANGING
                    // INITIALIZE SOAP AUTHORIZATION PROFILES FOR THIS ENVIRONMENT
                    //$this->initSOAPAuthorizationProfiles();

                    // TODO :: THIS IS CHANGING
                    // INITIALIZE WORDPRESS CONFIGURATION PROFILE(S) FOR THIS ENVIRONMENT
                    //$this->init_wp_config($oCRNRSTN);

                    // TODO :: THIS IS CHANGING
                    // INITIALIZE ANALYTICS CONFIGURATION PROFILE(S) FOR THIS ENVIRONMENT
                    //$this->init_analytics_config($oCRNRSTN);

                    // TODO :: THIS IS CHANGING
                    // INITIALIZE ENGAGEMENT TRACKING CONFIGURATION PROFILE(S) FOR THIS ENVIRONMENT
                    //$this->init_engagement_config($oCRNRSTN);

                    //
                    // INSTANTIATE USER CLASS OBJECT
                    $this->oCRNRSTN_USR = $this->return_ENV_oCRNRSTN_USR($WORDPRESS_debug_mode);

                    //
                    // INITIALIZE UI INTERACT PROFILE
                    $this->init_ui_interact_profile();

                    $this->oCRNRSTN->framework_integrations_client_packet(CRNRSTN_UI_SOAP_DATA_TUNNEL, true);

                    /*
                    CRNRSTN :: ORDER OF OPERATIONS (PREFERENCE) FOR SELECTION OF
                    SESSION CHANNEL / DATA TUNNEL LAYER ARCHITECTURE
                    0 :: D :: DATABASE (MySQLi Connection)
                    1 :: S :: SSDTL PACKET (SOAP OBJECT)
                    2 :: J :: PSSDTL PACKET (JSON OBJECT)
                    3 :: P :: PHP $_SERVER SESSION (PHP SESSION ARRAY SUPER GLOBAL)
                    4 :: C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)

                    DSJPC
                    
                    */

//                    //
//                    // INITIALIZE CRNRSTN :: SOAP SERVICES DATA TUNNEL LAYER PACKET - DSJPC
//                    // NOTE: DATABASE DATA STORAGE FORMAT WILL SHADOW/SUPPORT USE OF (S) AND (P)
//                    // ON A SESSION TO SESSION BASIS.
//                    $this->init_ssdtla_session_data_packet();

                    //
                    // END OF CRNRSTN :: ENVIRONMENTAL CONFIG OPERATION
                    $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('You have reached the end of the CRNRSTN :: environmental detection and configuration process.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                }

            }catch(Exception $e){

                //
                // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
                $oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

                return false;

            }

        }else{
            
            //
            // THIS IS A SIMPLE CONFIG CHECK.
            $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log(__METHOD__ . ' performing simple config check prior to loading of define_env_resource() in the CRNRSTN :: config file . ', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
            
        }

    }

    //
    // SOURCE :: https://aloneonahill.com/blog/if-php-were-british/
    // AUTHOR :: https://aloneonahill.com/blog/about-dave/
    public function hello_world($type, $is_bastard = true){

        try{

            if($is_bastard){

                $str = 'Hello World.'; // bastard dialect

            }else{

                $str = 'Good morrow, fellow subjects of the Crown.';

            }

            error_log(__LINE__ . ' ' . get_class() . ' exception! ' . $str);
            throw new Exception('CRNRSTN :: v' . $this->version_crnrstn() . ' :: ' . $str . ' This is an exception handling test from ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ').');

            if($this->oCRNRSTN_BITFLIP_MGR->is_bit_set(CRNRSTN_SCREEN_TEXT)){

                $str .= '<br><br>' . $this->oCRNRSTN_BITFLIP_MGR->bit_stringout();

            }

            if(file_exists('/proc/' . $this->process_id)){

                //$this->print_r(self::$process_id_perf_stat_ARRAY[0], "PID Testing :: [".$this->operating_system."][running]PID ".$this->process_id, CRNRSTN_HTML, __LINE__, __METHOD__, __FILE__);

            }else{

                //$this->print_r(self::$process_id_perf_stat_ARRAY[0], "PID Testing :: [dead]PID ".$this->process_id, CRNRSTN_HTML, __LINE__, __METHOD__, __FILE__);

            }

            return $str;

        } catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function CRNRSTN_debug_mode(){

        return $this->oCRNRSTN->CRNRSTN_debug_mode();

    }

    public function PHPMAILER_debug_mode(){

        return $this->oCRNRSTN->PHPMAILER_debug_mode();

    }

    public function WORDPRESS_debug_mode(){

        return $this->oCRNRSTN->WORDPRESS_debug_mode();
        //return $this->retrieve_data_value(__METHOD__);

    }

    public function version_crnrstn(){

        return $this->oCRNRSTN->version_crnrstn();

    }

    public function version_apache(){

        return $this->oCRNRSTN->version_apache();

    }

    public function version_apache_sysimg(){

        return $this->oCRNRSTN->version_apache_sysimg();

    }

    public function version_php(){

        return $this->oCRNRSTN->version_php();

    }

    public function version_soap(){

        return $this->oCRNRSTN->version_soap();

    }

    public function version_mysqli(){

        return $this->oCRNRSTN->version_mysqli();

    }

    public function version_openssl(){

        return $this->oCRNRSTN->version_openssl();

    }

    public function version_linux(){

        return $this->oCRNRSTN->version_linux();

    }

    private function return_prefixed_ddo_key($resource_key, $env_key, $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL'){

        error_log(__LINE__ . ' env ' . __METHOD__ . ' die();');
        die();

        // $env_key = CRNRSTN_RESOURCE_ALL
        $tmp_dataset_prefix_str = $this->return_dataset_nomination_prefix('string', $this->config_serial_hash, $env_key, $data_type_family);

        return $tmp_dataset_prefix_str . $resource_key;

    }

    public function return_openssl_digest_method(){

        return self::$openssl_digest_profile;

    }

    private function init_encrypt_profile($oCRNRSTN){

        //
        // INITIALIZE ARRAY OF ENCRYPTABLE DATATYPES
        $this->encryptableDataTypes = $oCRNRSTN->return_encryptable_data_types();

    }

    public function get_lang_copy($message_key){

        return $this->oCRNRSTN_LANG_MGR->get_lang_copy($message_key);

    }

    public function sync_device_detected(){

        return $this->oHTTP_MGR->sync_device_detected();

    }

//    public function return_crnrstn_language_manager($oCRNRSTN_USR, $header_language_attribute){
//
//        $this->oCRNRSTN_LANG_MGR->initialize_oCRNRSTN_USR($oCRNRSTN_USR);
//
//        return $this->oCRNRSTN_LANG_MGR;
//
//    }

//    public function return_client_accept_language_array($header_accept_language){
//
//        return $this->oHTTP_MGR->return_client_accept_language_array($this->oCRNRSTN_LANG_MGR, $header_accept_language);
//
//    }

    public function return_admin_ARRAY(){

        return $this->oAdminAccount_ARRAY;

    }

    public function update_admin_ARRAY($oAdmin_account_array){

        $this->oAdminAccount_ARRAY = $oAdmin_account_array;

    }

    public function ui_content_module_out($integer_constant){

        switch($integer_constant){
            case CRNRSTN_UI_INTERACT:

                $tmp_array = $this->return_output_CRNRSTN_UI_INTERACT();
                $tmp_output = '';

                //
                // LOAD OUTPUT
                foreach($tmp_array as $key => $resource_content){

                    $tmp_output .= $resource_content;

                }

                return $tmp_output;

            break;
            case CRNRSTN_UI_SOAP_DATA_TUNNEL:

                $tmp_array = $this->return_output_CRNRSTN_UI_SOAP_DATA_TUNNEL();
                $tmp_output = '';

                //
                // LOAD OUTPUT
                foreach($tmp_array as $key => $resource_content){

                    $tmp_output .= $resource_content;

                }

                return $tmp_output;

            break;
            case CRNRSTN_UI_CSS_MAIN_DESKTOP & CRNRSTN_UI_JS_MAIN_DESKTOP:

                $tmp_array_CSS = $this->return_output_CRNRSTN_UI_CSS(CRNRSTN_UI_CSS_MAIN_DESKTOP);
                $tmp_array_JS = $this->return_output_CRNRSTN_UI_JS(CRNRSTN_UI_JS_MAIN_DESKTOP);
                $tmp_output = '';

                //
                // LOAD OUTPUT
                foreach($tmp_array_CSS as $key => $resource_content){

                    $tmp_output .= $resource_content;

                }

                foreach($tmp_array_JS as $key => $resource_content){

                    $tmp_output .= $resource_content;

                }

                return $tmp_output;

            break;
            case CRNRSTN_UI_CSS_MAIN_TABLET & CRNRSTN_UI_JS_MAIN_TABLET:

                $tmp_array_CSS = $this->return_output_CRNRSTN_UI_CSS(CRNRSTN_UI_CSS_MAIN_TABLET);
                $tmp_array_JS = $this->return_output_CRNRSTN_UI_JS(CRNRSTN_UI_JS_MAIN_TABLET);
                $tmp_output = '';

                //
                // LOAD OUTPUT
                foreach($tmp_array_CSS as $key => $resource_content){

                    $tmp_output .= $resource_content;

                }

                foreach($tmp_array_JS as $key => $resource_content){

                    $tmp_output .= $resource_content;

                }

                return $tmp_output;

            break;
            case CRNRSTN_UI_CSS_MAIN_MOBILE & CRNRSTN_UI_JS_MAIN_MOBILE:

                $tmp_array_CSS = $this->return_output_CRNRSTN_UI_CSS(CRNRSTN_UI_CSS_MAIN_MOBILE);
                $tmp_array_JS = $this->return_output_CRNRSTN_UI_JS(CRNRSTN_UI_JS_MAIN_MOBILE);
                $tmp_output = '';

                //
                // LOAD OUTPUT
                foreach($tmp_array_CSS as $key => $resource_content){

                    $tmp_output .= $resource_content;

                }

                foreach($tmp_array_JS as $key => $resource_content){

                    $tmp_output .= $resource_content;

                }

                return $tmp_output;

            break;
            case CRNRSTN_UI_CSS_MAIN_DESKTOP:
            case CRNRSTN_UI_CSS_MAIN_TABLET:
            case CRNRSTN_UI_CSS_MAIN_MOBILE:

                $tmp_array = $this->return_output_CRNRSTN_UI_CSS($integer_constant);
                $tmp_output = '';

                //
                // LOAD OUTPUT
                foreach($tmp_array as $key => $resource_content){

                    $tmp_output .= $resource_content;

                }

                return $tmp_output;

            break;
            case CRNRSTN_UI_JS_MAIN_DESKTOP:
            case CRNRSTN_UI_JS_MAIN_TABLET:
            case CRNRSTN_UI_JS_MAIN_MOBILE:
            case CRNRSTN_UI_JS_JQUERY_1_11_1:
            case CRNRSTN_UI_JS_JQUERY:
            case CRNRSTN_UI_JS_JQUERY_UI:
            case CRNRSTN_UI_JS_JQUERY_MOBILE:
            case CRNRSTN_UI_JS_LIGHTBOX_DOT_JS:
            case CRNRSTN_UI_JS_LIGHTBOX_DOT_JS_PLUS_JQUERY:

                //
                // PLEASE CHECK THE CONFIG FILE (WHERE $CRNRSTN_config_serial = '' WAS UPDATED) AND ALSO
                // MAKE AN UPDATE TO:
                $tmp_array = $this->return_output_CRNRSTN_UI_JS($integer_constant);
                $tmp_output = '';

                //
                // LOAD OUTPUT
                foreach($tmp_array as $key => $resource_content){

                    $tmp_output .= $resource_content;

                }

                return $tmp_output;

            break;
            case CRNRSTN_UI_TAG_ANALYTICS:

                $tmp_array = $this->return_output_CRNRSTN_UI_TAG_ANALYTICS();
                $tmp_output = '';

                //
                // LOAD OUTPUT
                foreach($tmp_array as $key => $resource_content){

                    $tmp_output .= $resource_content;

                }

                return $tmp_output;

            break;
            case CRNRSTN_UI_TAG_ENGAGEMENT:

                $tmp_array = $this->return_output_CRNRSTN_UI_TAG_ENGAGEMENT();
                $tmp_output = '';

                //
                // LOAD OUTPUT
                foreach($tmp_array as $key => $resource_content){

                    $tmp_output .= $resource_content;

                }

                return $tmp_output;

            break;
            case CRNRSTN_RESOURCE_DOCUMENTATION:

                //$this->oCRNRSTN->print_r_str($integer_constant, 'ui_content_module_out $integer_constant.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

                $tmp_array = $this->return_output_CRNRSTN_UI_DOCUMENTATION();
                $tmp_output = '';

                //
                // LOAD OUTPUT
                foreach($tmp_array as $key => $resource_content){

                    $tmp_output .= $resource_content;

                }

                return $tmp_output;

            break;
            default:

                $this->error_log('The requested UI content module...honoring the provided integer constant, "' . $integer_constant . '", could not be found.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);
                return '';

            break;

        }

    }

    public function is_soap_data_tunnel_endpoint($set_value = NULL){

        if(isset($set_value)){

            $this->is_soap_data_tunnel_endpoint = $set_value;

            return true;

        }else{

            return $this->is_soap_data_tunnel_endpoint;

        }

    }

    private function return_output_CRNRSTN_UI_JS($integer_constant){

        try{

            $asset_mode_ARRAY = $this->return_set_bits($this->system_output_profile_constants);

            $tmp_str_array = array();

            switch($asset_mode_ARRAY[0]){
                case CRNRSTN_ASSET_MODE_PNG:
                case CRNRSTN_ASSET_MODE_JPEG:

                    $tmp_str_array[] = '
<!-- BEGIN CRNRSTN :: v' . $this->oCRNRSTN_USR->version_crnrstn() . ' UI JS + CSS MODULE OUTPUT :: ' . $this->oCRNRSTN_USR->return_micro_time() . ' -->
';

                    switch ($integer_constant){
                        case CRNRSTN_UI_JS_MAIN_DESKTOP:

                            $tmp_cache_verA = $this->oCRNRSTN_USR->resource_filecache_version(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.min.css');
                            $tmp_cache_ver = $this->oCRNRSTN_USR->resource_filecache_version(CRNRSTN_ROOT . '/_crnrstn/ui/js/crnrstn.main_desktop.js');

                            $tmp_str_array[] = '<!-- lightbox 2.11.3 CSS :: lightbox.js included WITH crnrstn.main_desktop.js -->
<link rel="stylesheet" href="' . $this->oCRNRSTN->crnrstn_resources_http_path() . 'ui/js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.min.css?v=420.00.' . filesize(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.min.css') . '.' . $tmp_cache_verA . '"></style>
';
                            $tmp_str_array[] = '<!-- ' . $this->oCRNRSTN_USR->proper_version() . ' :: DESKTOP JS :: ' . $this->oCRNRSTN_USR->return_micro_time() . ' -->
<script src="' . $this->oCRNRSTN->crnrstn_resources_http_path() . 'ui/js/crnrstn.main_desktop.js?v=420.00.' . $tmp_cache_ver . '"></script>
';
                            break;
                        case CRNRSTN_UI_JS_MAIN_TABLET:

                            $tmp_cache_verA = $this->oCRNRSTN_USR->resource_filecache_version(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.min.css');

                            $tmp_cache_ver = $this->oCRNRSTN_USR->resource_filecache_version(CRNRSTN_ROOT . '/_crnrstn/ui/js/crnrstn.main_tablet.js');
                            $tmp_str_array[] = '<!-- lightbox 2.11.3 CSS :: lightbox.js included WITH crnrstn.main_desktop.js -->
<link rel="stylesheet" href="' . $this->oCRNRSTN->crnrstn_resources_http_path() . 'ui/js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.min.css?v=420.00.' . filesize(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.min.css') . '.' . $tmp_cache_verA . '"></style>
';
                            $tmp_str_array[] = '<!-- CRNRSTN :: v' . $this->oCRNRSTN_USR->version_crnrstn() . ' :: TABLET JS :: ' . $this->oCRNRSTN_USR->return_micro_time() . ' -->
<script src="' . $this->oCRNRSTN->crnrstn_resources_http_path() . 'ui/js/crnrstn.main_tablet.js?v=420.00.' . $tmp_cache_ver . '"></script>
';
                            break;
                        case CRNRSTN_UI_JS_MAIN_MOBILE:

                            $tmp_cache_verA = $this->oCRNRSTN_USR->resource_filecache_version(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.min.css');

                            $tmp_cache_ver = $this->oCRNRSTN_USR->resource_filecache_version(CRNRSTN_ROOT . '/_crnrstn/ui/js/crnrstn.main_mobi.js');
                            $tmp_str_array[] = '<!-- lightbox 2.11.3 CSS :: lightbox.js included WITH crnrstn.main_desktop.js -->
<link rel="stylesheet" href="' . $this->oCRNRSTN->crnrstn_resources_http_path() . 'ui/js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.min.css?v=420.00.' . filesize(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.min.css') . '.' . $tmp_cache_verA . '"></style>
';
                            $tmp_str_array[] = '<!-- CRNRSTN :: v' . $this->oCRNRSTN_USR->version_crnrstn() . ' :: MOBI JS :: ' . $this->oCRNRSTN_USR->return_micro_time() . ' -->
<script src="' . $this->oCRNRSTN->crnrstn_resources_http_path() . 'ui/js/crnrstn.main_mobi.js?v=420.00.' . $tmp_cache_ver . '"></script>
';
                            break;
                        case CRNRSTN_UI_JS_JQUERY:

                            $tmp_cache_ver = $this->oCRNRSTN_USR->resource_filecache_version(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery/3.6.0/jquery-3.6.0.min.js');
                            $tmp_str_array[] = '<!-- jquery 3.6.0 -->
<script src="' . $this->oCRNRSTN->crnrstn_resources_http_path() . 'ui/js/_lib/frameworks/jquery/3.6.0/jquery-3.6.0.min.js?v=420.00.' . $tmp_cache_ver . '"></script>
';

                        break;
                        case CRNRSTN_UI_JS_JQUERY_UI:

                            $tmp_path = $this->oCRNRSTN->crnrstn_resources_http_path();

                            $tmp_cache_ver = $this->oCRNRSTN_USR->resource_filecache_version(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery_ui/1.12.1/jquery-ui-1.12.1/jquery-ui.min.css');
                            $tmp_str_array[] = '<!-- jquery ui css 1.12.1 -->
<link rel="stylesheet" href="' . $tmp_path . 'ui/js/_lib/frameworks/jquery_ui/1.12.1/jquery-ui-1.12.1/jquery-ui.min.css?v=420.00.' . $tmp_cache_ver . '"></style>
';

                            $tmp_cache_ver = $this->oCRNRSTN_USR->resource_filecache_version(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery/3.6.0/jquery-3.6.0.min.js');
                            $tmp_str_array[] = '<!-- jquery 3.6.0 -->
<script src="' . $tmp_path . 'ui/js/_lib/frameworks/jquery/3.6.0/jquery-3.6.0.min.js?v=420.00.' . $tmp_cache_ver . '"></script>
';

                            if($tmp_path === '\\'){

                                $this->oCRNRSTN->error_log('CRNRSTN_UI_JS_JQUERY_UI cannot be returned. $oCRNRSTN->init_sys_comm_img_HTTP_DIR() has not been initialized.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);

                                //
                                // HOOOSTON...VE HAF PROBLEM!
                                throw new Exception('Content for CRNRSTN_UI_JS_JQUERY_UI cannot be returned. $oCRNRSTN->init_sys_comm_img_HTTP_DIR() has not been initialized within the config file [' . CRNRSTN_ROOT . '/_crnrstn.config.inc.php].');

                            }

                        break;
                        case CRNRSTN_UI_JS_JQUERY_MOBILE:

                            $tmp_cache_verA = $this->oCRNRSTN_USR->resource_filecache_version(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.css');
                            $tmp_cache_verB = $this->oCRNRSTN_USR->resource_filecache_version(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery/1.11.1/jquery-1.11.1.min.js');
                            $tmp_cache_verC = $this->oCRNRSTN_USR->resource_filecache_version(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/index.js');
                            $tmp_cache_verD = $this->oCRNRSTN_USR->resource_filecache_version(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js');

                            $tmp_str_array[] = '<!-- jquery.mobile 1.4.5 CSS -->
<link rel="stylesheet" href="' . $this->oCRNRSTN->crnrstn_resources_http_path() . 'ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile.structure-1.4.5.min.css?v=420.00.' . $tmp_cache_verA . '">
';
                            $tmp_str_array[] = '<!-- jquery 1.11.1 -->
<script src="' . $this->oCRNRSTN->crnrstn_resources_http_path() . 'ui/js/_lib/frameworks/jquery/1.11.1/jquery-1.11.1.min.js?v=420.00.' . $tmp_cache_verB . '"></script>
<!-- jquery.mobile 1.4.5 mobile helpmate -->
<script src="' . $this->oCRNRSTN->crnrstn_resources_http_path() . 'ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/index.js?v=420.00.' . $tmp_cache_verC . '"></script>
<!-- jquery.mobile 1.4.5 -->
<script src="' . $this->oCRNRSTN->crnrstn_resources_http_path() . 'ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js?v=420.00.' . $tmp_cache_verD . '"></script>
';

                            break;
                        case CRNRSTN_UI_JS_LIGHTBOX_DOT_JS_PLUS_JQUERY:

                            $tmp_cache_verA = $this->oCRNRSTN_USR->resource_filecache_version(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.min.css');

                            $tmp_cache_verB = $this->oCRNRSTN_USR->resource_filecache_version(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.css');

                            $tmp_str_array[] = '<!-- lightbox 2.11.3 CSS -->
<link rel="stylesheet" href="' . $this->oCRNRSTN->crnrstn_resources_http_path() . 'ui/js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.min.css?v=420.00.' . $tmp_cache_verA . '"></style>
';

                            $tmp_str_array[] = '<!-- lightbox 2.11.3 plus jquery.min.js -->
<script type="application/javascript" src="' . $this->oCRNRSTN->crnrstn_resources_http_path() . 'ui/js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/js/lightbox-plus-jquery.min.js?v=420.00.' . $tmp_cache_verB . '"></script>
';

                            break;
                        case CRNRSTN_UI_JS_LIGHTBOX_DOT_JS:

                            $tmp_cache_verA = $this->oCRNRSTN_USR->resource_filecache_version(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.min.css');
                            $tmp_cache_verB = $this->oCRNRSTN_USR->resource_filecache_version(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/js/lightbox.min.js');

                            $tmp_str_array[] = '<!-- lightbox 2.11.3 CSS -->
<link rel="stylesheet" href="' . $this->oCRNRSTN->crnrstn_resources_http_path() . 'ui/js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.min.css?v=420.00.' . filesize(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.min.css') . '.' . $tmp_cache_verA . '"></style>
';

                            $tmp_str_array[] = '<!-- lightbox 2.11.3 -->
<script type="application/javascript" src="' . $this->oCRNRSTN->crnrstn_resources_http_path() . 'ui/js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/js/lightbox.min.js?v=420.00.' . $tmp_cache_verB . '"></script>
';

                            break;

                    }

                    $tmp_str_array[] = '<!-- END CRNRSTN :: v' . $this->oCRNRSTN_USR->version_crnrstn() . ' :: UI JS + CSS MODULE OUTPUT -->
';

                break;
                default:

                    //
                    // CRNRSTN_ASSET_MODE_BASE64
                    $tmp_str_array[] = '
<!-- BEGIN CRNRSTN :: v' . $this->oCRNRSTN_USR->version_crnrstn() . ' :: UI JS + CSS MODULE OUTPUT :: ' . $this->oCRNRSTN_USR->return_micro_time() . ' -->
';

                    switch ($integer_constant){
                        case CRNRSTN_UI_JS_MAIN_DESKTOP:

                            $tmp_str_array[] = '<!-- CRNRSTN :: v' . $this->oCRNRSTN_USR->version_crnrstn() . ' :: DESKTOP JS :: ' . $this->oCRNRSTN_USR->return_micro_time() . ' --><script> //<!--
' . file_get_contents(CRNRSTN_ROOT . '/_crnrstn/ui/js/crnrstn.main_desktop.js') . '
// --> 
</script>
';
                            break;
                        case CRNRSTN_UI_JS_MAIN_TABLET:

                            $tmp_str_array[] = '<!-- CRNRSTN :: v' . $this->oCRNRSTN_USR->version_crnrstn() . ' :: TABLET JS :: ' . $this->oCRNRSTN_USR->return_micro_time() . ' --><script> //<!--
' . file_get_contents(CRNRSTN_ROOT . '/_crnrstn/ui/js/crnrstn.main_tablet.js') . '
// --> 
</script>
';
                            break;
                        case CRNRSTN_UI_JS_MAIN_MOBILE:

                            $tmp_str_array[] = '<!-- CRNRSTN :: v' . $this->oCRNRSTN_USR->version_crnrstn() . ' :: MOBI JS :: ' . $this->oCRNRSTN_USR->return_micro_time() . ' --><script> //<!--
' . file_get_contents(CRNRSTN_ROOT . '/_crnrstn/ui/js/crnrstn.main_mobi.js') . '
// --> 
</script>
';

                            break;
                        case CRNRSTN_UI_JS_JQUERY:

                            $tmp_str_array[] = '<!-- jquery 3.6.0 --><script> //<!--
' . file_get_contents(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery/3.6.0/jquery-3.6.0.min.js') . '
// --> 
</script>
';
                            break;
                        case CRNRSTN_UI_JS_JQUERY_UI:

                            $tmp_str_array[] = '<!-- jquery ui 1.12.1 --><style>
' . file_get_contents(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery_ui/1.12.1/jquery-ui-1.12.1/jquery-ui.min.css') . '
</style>
';
                            $tmp_str_array[] = '<!-- jquery 3.6.0 --><script> //<!--
' . file_get_contents(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery/3.6.0/jquery-3.6.0.min.js') . '
// --> 
</script>
';
                            break;
                        case CRNRSTN_UI_JS_JQUERY_MOBILE:

                            $tmp_str_array[] = '<!-- jquery.mobile 1.4.5 CSS --><style>
' . file_get_contents(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.css') . '
</style>
';

                            $tmp_str_array[] = '<!-- jquery 1.11.1 --><script> //<!--
' . file_get_contents(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery/1.11.1/jquery-1.11.1.min.js').'
// --> 
</script>
';

                            $tmp_str_array[] = '<!-- jquery.mobile 1.4.5 helpmate --><script> //<!--
' . file_get_contents(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/index.js').'
// --> 
</script>
';
                            $tmp_str_array[] = '<!-- jquery.mobile 1.4.5 --><script> //<!--
' . file_get_contents(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js') . '
// --> 
</script>
';
                            break;
                        case CRNRSTN_UI_JS_LIGHTBOX_DOT_JS_PLUS_JQUERY:

                            $tmp_str_array[] = '<!-- lightbox 2.11.3 CSS --><style>
' . file_get_contents(CRNRSTN_ROOT . 'js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.min.css').'
</style>
';

                            $tmp_str_array[] = '<!-- lightbox 2.11.3 plus jquery.min.js --><script> //<!--
' . file_get_contents(CRNRSTN_ROOT . 'js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/js/lightbox-plus-jquery.min.js').'
// --> 
</script>
';
                            break;
                        case CRNRSTN_UI_JS_LIGHTBOX_DOT_JS:

                            $tmp_str_array[] = '<!-- lightbox 2.11.3 CSS --><style>
' . file_get_contents(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.min.css') . '
</style>
';
                            $tmp_str_array[] = '<!-- lightbox 2.11.3 --><script> //<!--
' . file_get_contents(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/js/lightbox.min.js').'
// --> 
</script>
';
                            break;

                    }

                    $tmp_str_array[] = '<!-- END CRNRSTN :: v' . $this->oCRNRSTN_USR->version_crnrstn() . ' :: UI JS + CSS MODULE OUTPUT -->
';

                    break;

            }

            return $tmp_str_array;

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return $tmp_str_array;

        }

    }

    private function return_output_CRNRSTN_UI_CSS($integer_constant){

        $asset_mode_ARRAY = $this->return_set_bits($this->system_output_profile_constants);

        $tmp_str_array = array();

        switch($asset_mode_ARRAY[0]){
            case CRNRSTN_ASSET_MODE_PNG:
            case CRNRSTN_ASSET_MODE_JPEG:

                $tmp_str_array[] = '
<!-- BEGIN CRNRSTN :: v' . $this->oCRNRSTN_USR->version_crnrstn() . ' :: UI CSS MODULE OUTPUT :: ' . $this->oCRNRSTN_USR->return_micro_time() . ' -->
';

                switch ($integer_constant){
                    case CRNRSTN_UI_CSS_MAIN_DESKTOP:

                        $tmp_path = $this->oCRNRSTN->crnrstn_resources_http_path();

                        if($tmp_path === '\\'){

                            $this->error_log('CRNRSTN_UI_CSS_MAIN_DESKTOP cannot be returned. $oCRNRSTN->init_sys_comm_img_HTTP_DIR() has not been initialized.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);

                        }

                        $tmp_cache_ver = $this->oCRNRSTN_USR->resource_filecache_version(CRNRSTN_ROOT . '/_crnrstn/ui/css/crnrstn.main_desktop.css');
                        $tmp_str_array[] = '<!-- CRNRSTN :: v' . $this->oCRNRSTN_USR->version_crnrstn() . ' :: DESKTOP CSS :: ' . $this->oCRNRSTN_USR->return_micro_time() . ' -->
<link rel="stylesheet" href="' . $tmp_path . 'ui/css/crnrstn.main_desktop.css?v=420.00.' . $tmp_cache_ver . '">
';

                    break;
                    case CRNRSTN_UI_CSS_MAIN_TABLET:

                        $tmp_cache_ver = $this->oCRNRSTN_USR->resource_filecache_version(CRNRSTN_ROOT . '/_crnrstn/ui/css/crnrstn.main_tablet.css');
                        $tmp_str_array[] = '<!-- CRNRSTN :: v' . $this->oCRNRSTN_USR->version_crnrstn() . ' :: TABLET CSS :: ' . $this->oCRNRSTN_USR->return_micro_time() . ' -->
<link rel="stylesheet" href="' . $this->oCRNRSTN->crnrstn_resources_http_path() . 'ui/css/crnrstn.main_tablet.css?v=420.00.' . $tmp_cache_ver . '">
';
                    break;
                    case CRNRSTN_UI_CSS_MAIN_MOBILE:

                        $tmp_cache_ver = $this->oCRNRSTN_USR->resource_filecache_version(CRNRSTN_ROOT . '/_crnrstn/ui/css/crnrstn.main_mobile.css');
                        $tmp_str_array[] = '<!-- CRNRSTN :: v' . $this->oCRNRSTN_USR->version_crnrstn() . ' :: MOBILE CSS :: ' . $this->oCRNRSTN_USR->return_micro_time() . ' -->
<link rel="stylesheet" href="' . $this->oCRNRSTN->crnrstn_resources_http_path() . 'ui/css/crnrstn.main_mobile.css?v=420.00.' . $tmp_cache_ver . '">
';
                    break;

                }

                $tmp_str_array[] = '<!-- END CRNRSTN :: v' . $this->oCRNRSTN_USR->version_crnrstn() . ' :: UI CSS MODULE OUTPUT -->
';

            break;
            default:

                //
                // CRNRSTN_ASSET_MODE_BASE64
                $tmp_str_array[] = '
<!-- BEGIN CRNRSTN :: v' . $this->oCRNRSTN_USR->version_crnrstn() . ' :: UI CSS MODULE OUTPUT :: ' . $this->oCRNRSTN_USR->return_micro_time() . ' -->
';

                switch ($integer_constant){
                    case CRNRSTN_UI_CSS_MAIN_DESKTOP:

                        $tmp_str_array[] = '<!-- CRNRSTN :: v' . $this->oCRNRSTN_USR->version_crnrstn() . ' :: DESKTOP CSS :: ' . $this->oCRNRSTN_USR->return_micro_time() . ' --><style>
' . file_get_contents(CRNRSTN_ROOT . '/_crnrstn/ui/css/crnrstn.main_desktop.css') . '
</style>
';
                    break;
                    case CRNRSTN_UI_CSS_MAIN_TABLET:

                        $tmp_str_array[] = '<!-- CRNRSTN :: v' . $this->oCRNRSTN_USR->version_crnrstn() . ' :: TABLET CSS :: ' . $this->oCRNRSTN_USR->return_micro_time() . ' --><style>
' . file_get_contents(CRNRSTN_ROOT . '/_crnrstn/ui/css/crnrstn.main_tablet.css') . '
</style>
';
                    break;
                    case CRNRSTN_UI_CSS_MAIN_MOBILE:

                        $tmp_str_array[] = '<!-- CRNRSTN :: v' . $this->oCRNRSTN_USR->version_crnrstn() . ' :: MOBILE CSS :: ' . $this->oCRNRSTN_USR->return_micro_time() . ' --><style>
' . file_get_contents(CRNRSTN_ROOT . '/_crnrstn/ui/css/crnrstn.main_mobile.css') . '
</style>
';
                    break;

                }

                $tmp_str_array[] = '<!-- END CRNRSTN :: v' . $this->oCRNRSTN_USR->version_crnrstn() . ' :: UI CSS MODULE OUTPUT -->
';

                break;

        }

        return $tmp_str_array;

    }

    private function return_output_CRNRSTN_UI_INTERACT(){

        $tmp_str_array[] = '
<!-- BEGIN CRNRSTN :: v' . $this->oCRNRSTN_USR->version_crnrstn() . ' :: UI INTERACT MODULE OUTPUT :: ' . $this->oCRNRSTN_USR->return_micro_time() . ' -->
';
        $tmp_str_array[] = '<div id="crnrstn_ui_interact_wrapper" class="crnrstn_ui_interact_wrapper">
    <div class="crnrstn_ui_interact">

        <div id="crnrstn_ui_interact_bg_border" class="crnrstn_ui_interact_bg_border"></div>

        <div id="crnrstn_ui_interact_bg_border_edge" class="crnrstn_ui_interact_bg_border_edge" style="border: 1px solid #FFF;"></div>

        <div style="position:relative; height:106px;">

            <div id="crnrstn_ui_interact_primary_navgroup_wrapper" class="crnrstn_ui_interact_primary_navgroup_wrapper">

                <div id="crnrstn_ui_interact_primary_nav_menu" class="crnrstn_ui_interact_primary_navgroup_lnk_border">

                    <div id="crnrstn_ui_interact_primary_nav_img_shell_menu_inactive" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_MENU_INACTIVE', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_MENU') . '"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_menu_hvr" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_MENU_HOVER', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_MENU') . '"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_menu_click" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_MENU_CLICK', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_MENU') . '"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_menu" class="crnrstn_ui_interact_primary_nav_img_shell crnrstn_ui_interact_active"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_MENU', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_MENU') . '"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_menu_glass_case" class="crnrstn_ui_interact_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmouseout\', this);" onmousedown="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmousedown\', this);" onmouseup="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmouseup\', this);"><img src="' . $this->return_creative('TRANSPARENT_1X1', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_MENU') . '"></div>

                </div>

                <div id="crnrstn_ui_interact_primary_nav_close_x" class="crnrstn_ui_interact_primary_navgroup_lnk_border">

                    <div id="crnrstn_ui_interact_primary_nav_img_shell_close_x_inactive" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_CLOSE_X_INACTIVE', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_close_x_hvr" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_CLOSE_X_HOVER', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_close_x_click" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_CLOSE_X_CLICK', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_close_x" class="crnrstn_ui_interact_primary_nav_img_shell crnrstn_ui_interact_active"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_CLOSE_X', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_close_x_glass_case" class="crnrstn_ui_interact_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmouseout\', this);" onmousedown="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmousedown\', this);" onmouseup="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmouseup\', this);"><img src="' . $this->return_creative('TRANSPARENT_1X1', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div>

                </div>

                <div id="crnrstn_ui_interact_primary_nav_fs_expand" class="crnrstn_ui_interact_primary_navgroup_lnk_border">

                    <div id="crnrstn_ui_interact_primary_nav_img_shell_fs_expand_inactive" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_INACTIVE', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_fs_expand_hvr" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_HOVER', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_fs_expand_click" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_CLICK', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_fs_expand" class="crnrstn_ui_interact_primary_nav_img_shell crnrstn_ui_interact_active"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_fs_expand_glass_case" class="crnrstn_ui_interact_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmouseout\', this);" onmousedown="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmousedown\', this);" onmouseup="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmouseup\', this);"><img src="' . $this->return_creative('TRANSPARENT_1X1', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div>

                </div>

                <div id="crnrstn_ui_interact_primary_nav_minimize" class="crnrstn_ui_interact_primary_navgroup_lnk_border">

                    <div id="crnrstn_ui_interact_primary_nav_img_shell_minimize_inactive" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE_INACTIVE', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_MINIMIZE') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_MINIMIZE') . '"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_minimize_hvr" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE_HOVER', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_MINIMIZE') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_MINIMIZE') . '"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_minimize_click" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE_CLICK', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_MINIMIZE') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_MINIMIZE') . '"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_minimize" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_MINIMIZE') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_MINIMIZE') . '"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_minimize_fivedev_sm" class="crnrstn_ui_interact_primary_nav_img_shell crnrstn_ui_interact_active"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV_SMALL', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_FIVEDEV') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_FIVEDEV') . '"></div>
                    <div id="crnrstn_ui_interact_primary_nav_img_shell_minimize_glass_case" class="crnrstn_ui_interact_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmouseout\', this);" onmousedown="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmousedown\', this);" onmouseup="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmouseup\', this);"><img src="' . $this->return_creative('TRANSPARENT_1X1', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_FIVEDEV') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_FIVEDEV') . '"></div>

                </div>

            </div>
            <div class="crnrstn_cb"></div>
        </div>

        <div class="crnrstn_cb"></div>

        <div style="position:relative;">
            <div style="position:absolute; z-index:68; margin: 2px 0 0 16px; border: 1px solid #FFF;">
                <div id="crnrstn_ui_interact_bg_solid" class="crnrstn_ui_interact_bg_solid" onclick="oCRNRSTN_JS.sign_in_transition_via_micro_expansion();">
                    ' . $this->return_creative('MESSAGE_CONVERSATION_BUBBLE_MICRO_THUMB_BLUE00', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED) . '
                    <div class="crnrstn_cb"></div>
                </div>
            </div>
            <div class="crnrstn_cb"></div>

        </div>

        <div id="crnrstn_ui_interact_content_wrapper" class="crnrstn_ui_interact_content_wrapper">
            <div id="crnrstn_ui_interact_signin_frm_username" class="crnrstn_ui_interact_signin_frm_lbl">' . $this->get_lang_copy('FORM_LABEL_USERNAME') . '</div>
            <div class="crnrstn_cb_5"></div>
            <input type="text" name="username" value="">
            <div class="crnrstn_cb_15"></div>
            <div id="crnrstn_ui_interact_signin_frm_password" class="crnrstn_ui_interact_signin_frm_lbl">' . $this->get_lang_copy('FORM_LABEL_PASSWORD_OPTIONAL') . '</div>
            <div class="crnrstn_cb_5"></div>
            <input type="password" name="password" value="">
            <div class="crnrstn_cb_10"></div>

            <div class="crnrstn_ui_interact_signin_frm_chkbx_eula"><input type="checkbox" style="width: 20px;" name="crnrstn_signin_chkbx_eula_accept" value="eula_i_agree"></div>
            <div class="crnrstn_ui_interact_signin_frm_lbl_eula"><a href="#">' . $this->get_lang_copy('FORM_LNK_TXT_EULA') . '</a></div>

            <div class="crnrstn_cb_10"></div>

            <div class="crnrstn_ui_interact_frm_submit" onclick="oCRNRSTN_JS.sign_in_form_submit_via_micro_expansion();">
                <div id="crnrstn_ui_interact_signin_frm_btn_submit" class="crnrstn_ui_interact_signin_frm_btn_submit">' . $this->get_lang_copy('FORM_BUTTON_TEXT_CONNECT') . '</div>
            </div>
        </div>
    </div>
</div>
';

        $tmp_str_array[] = '<!-- END CRNRSTN :: v' . $this->oCRNRSTN_USR->version_crnrstn() . ' :: UI INTERACT MODULE OUTPUT -->
';

        return $tmp_str_array;

    }

    private function return_output_CRNRSTN_UI_SOAP_DATA_TUNNEL(){

        /*
        <theme_configuration>
            <canvas z_index="60" window_edge_padding="20" outline_border_edge_line_width="2" outline_border_edge_line_style="solid" outline_border_edge_line_color="#767676" border_width="10" border_color="#FFF" border_opacity="0.3" background_color="#FFF" background_opacity="1" inner_content_edge_padding="25" checksum="' . $this->hash('60202solid#76767610#FFF0.3#FFF125') . '"></canvas>
            <mini_canvas left="84%" width="100" height="70" hash="' . $this->hash('10070') . '"></mini_canvas>
            <signin_canvas width="260" height="305" checksum="' . $this->hash('260305') . '"></signin_canvas>
            <main_canvas width="1080" height="760" checksum="' . $this->hash('1080760') . '"></main_canvas>
            <eula_canvas width="700" height="400" checksum="' . $this->hash('700400') . '"></eula_canvas>
            <mit_license_canvas width="500" height="400" checksum="' . $this->hash('500400') . '"></mit_license_canvas>
        </theme_configuration>

        ()
        */

        error_log(__LINE__ . ' env running [' . __METHOD__ . '].');

        //$tmp_oNUSOAP_BASE = $this->oCRNRSTN_USR->return_oNUSOAP_BASE();
        $this->oCRNRSTN_USR->form_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_request_serialization_key', 'crnrstn_request_serialization_key', '',CRNRSTN_INPUT_REQUIRED);
        $this->oCRNRSTN_USR->form_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_request_serialization_hash', 'crnrstn_request_serialization_hash', '', CRNRSTN_INPUT_REQUIRED);
        $this->oCRNRSTN_USR->form_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_resource_filecache_version', 'crnrstn_resource_filecache_version');
        $this->oCRNRSTN_USR->form_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_interact_ui_link_text_click', 'crnrstn_interact_ui_link_text_click');
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_session', true, $this->oCRNRSTN_USR->return_serialized_soap_data_tunnel_session('crnrstn_session_json'), 'crnrstn_session');
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_srvc_form_serial', true, $this->oCRNRSTN_USR->generate_new_key(64), 'crnrstn_soap_srvc_form_serial');
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_srvc_timestamp', true, $this->oCRNRSTN_USR->return_micro_time(), 'crnrstn_soap_srvc_timestamp');
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_srvc_ttl', true, $this->oCRNRSTN_USR->return_soap_data_tunnel_session_ttl(), 'crnrstn_soap_srvc_ttl');
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_srvc_user_agent', true, $_SERVER['HTTP_USER_AGENT'], 'crnrstn_soap_srvc_user_agent');
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_srvc_server_ip', true, $_SERVER['SERVER_ADDR'], 'crnrstn_soap_srvc_server_ip');
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_srvc_client_ip', true, $this->oCRNRSTN->return_client_ip(), 'crnrstn_soap_srvc_client_ip');
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_srvc_stime', true, $this->starttime, 'crnrstn_soap_srvc_stime');
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_srvc_rtime', true, $this->wall_time(), 'crnrstn_soap_srvc_rtime');
        //$this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_srvc_protocol_version', true, $this->oCRNRSTN_USR->proper_version('SOAP'), 'crnrstn_soap_srvc_protocol_version');
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_php_sessionid', true, session_id());
        //$this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_srvc_encoding', true, $tmp_oNUSOAP_BASE->soap_defencoding, 'crnrstn_soap_srvc_protocol_version');
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_client_auth_key', true, $this->oCRNRSTN->generate_new_key(64), 'crnrstn_client_auth_key');
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_client_id', true, $_SESSION['CRNRSTN_CLIENT_ID_' . $this->config_serial_hash], 'crnrstn_client_id');

        $tmp_str_array[] = '
<!-- BEGIN ' . $this->oCRNRSTN_USR->proper_version() . ' :: UI SOAP-SERVICES DATA TUNNEL MODULE OUTPUT :: ' . $this->oCRNRSTN->return_micro_time() . ' -->
';

        $tmp_str_array[] = '<div id="crnrstn_soap_data_tunnel_form_shell" class="crnrstn_hidden">
    <form action="' . $this->oCRNRSTN->crnrstn_resources_http_path() . 'soa/tunnel/?' . $this->oCRNRSTN->session_salt() . '=" method="post" id="crnrstn_soap_data_tunnel_frm" name="crnrstn_soap_data_tunnel_frm" enctype="multipart/form-data" >
        <textarea id="crnrstn_soap_srvc_data" name="crnrstn_soap_srvc_data" cols="130" rows="5">CRNRSTN :: SOAP-SERVICES DATA TUNNEL LAYER PACKET (SSDTLP)</textarea>
        <button type="submit">SUBMIT</button>
        <input type="hidden" id="crnrstn_request_ajax_root" name="crnrstn_request_ajax_root" value="' . $this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP') . $this->oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . '?'. $this->oCRNRSTN->session_salt().'=">
        <input type="hidden" id="crnrstn_interact_ui_link_text_click" name="crnrstn_interact_ui_link_text_click" value="">
        <input type="hidden" id="crnrstn_request_serialization_key" name="crnrstn_request_serialization_key" value="">
        <input type="hidden" id="crnrstn_request_serialization_checksum" name="crnrstn_request_serialization_checksum" value="">';

         $tmp_str_array[] = $this->oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_FORM_INTEGRATION_PACKET, 'crnrstn_soap_data_tunnel_form') . '
    </form>
</div>';

        $tmp_str_array[] = '<!-- END ' . $this->oCRNRSTN_USR->proper_version() . ' :: UI SOAP-SERVICES DATA TUNNEL MODULE OUTPUT -->
';
        return $tmp_str_array;

    }

    private function return_output_CRNRSTN_UI_TAG_ANALYTICS(){

        $tmp_str_array[] = '
<!-- BEGIN CRNRSTN :: v' . $this->oCRNRSTN_USR->version_crnrstn() . ' :: UI ANALYTICS SEO MODULE OUTPUT :: ' . $this->oCRNRSTN_USR->return_micro_time() . ' -->
';
        $tmp_str_array[] = $this->getEnvParam('CRNRSTN_ANALYTICS_SEO_HTML','CRNRSTN::ANALYTICS::INTEGRATIONS');

        $tmp_str_array[] = '<!-- END CRNRSTN :: v' . $this->oCRNRSTN_USR->version_crnrstn() . ' :: UI ANALYTICS SEO MODULE OUTPUT -->
';
        return $tmp_str_array;

    }

    private function return_output_CRNRSTN_UI_TAG_ENGAGEMENT(){

        $tmp_str_array[] = '
<!-- BEGIN CRNRSTN :: v' . $this->oCRNRSTN_USR->version_crnrstn() . ' :: UI ENGAGEMENT TAG MODULE OUTPUT :: ' . $this->oCRNRSTN_USR->return_micro_time() . ' -->
';
        $tmp_str_array[] = $this->getEnvParam('CRNRSTN_ENGAGEMENT_TAG_HTML','CRNRSTN::ENGAGEMENT::INTEGRATIONS');

        $tmp_str_array[] = '<!-- END CRNRSTN :: v' . $this->oCRNRSTN_USR->version_crnrstn() . ' :: UI ENGAGEMENT TAG MODULE OUTPUT -->
';
        return $tmp_str_array;

    }

    private function return_documentation_side_nav_link_ARRAY(){

        $tmp_str = '';

        $tmp_scraped_filename_ARRAY = $this->oCRNRSTN->better_scandir(CRNRSTN_ROOT . '/_crnrstn/ui/docs/documentation/');

        $tmp_img_cnt = sizeof($tmp_scraped_filename_ARRAY);
        for($i = 0; $i < $tmp_img_cnt; $i++){

            $tmp_pos_php = strpos($tmp_scraped_filename_ARRAY[$i], '.php');
            $tmp_pos_ds_store = strpos($tmp_scraped_filename_ARRAY[$i], 'DS_Store');

            if(($tmp_pos_php !== false) && ($tmp_pos_ds_store === false)){

                $tmp_filename = $this->oCRNRSTN->strrtrim($tmp_scraped_filename_ARRAY[$i], '.php');

                $tmp_str .= '<li><a rel="crnrstn_documentation_side_nav_' . $this->oCRNRSTN->session_salt() . '" data-crnrstn="' . $tmp_filename . '" id="crnrstn_text_lnk_' . $this->oCRNRSTN->hash($tmp_filename, 'md5') . '" href="#' . $tmp_filename . '" onclick="oCRNRSTN_JS.toggle_full_overlay(); return false;" title="' . $tmp_filename . '">' . $tmp_filename . '</a></li>
';

            }

        }

        return $tmp_str;

    }

    private function return_output_CRNRSTN_UI_DOCUMENTATION(){

        $tmp_str_array[] = '
<!-- BEGIN ' . $this->oCRNRSTN_USR->proper_version() . ' :: DOCUMENTATION MODULE OUTPUT :: ' . $this->oCRNRSTN->return_micro_time() . ' -->
';

        $tmp_str_array[] = '        <div id="crnrstn_ui_documentation_side_nav_src" class="crnrstn_hidden">
            <!-- SOURCE :: https://www.w3schools.com/howto/howto_css_fixed_sidebar.asp -->
            
            <div id="crnrstn_interact_ui_side_nav_logo" class="crnrstn_interact_ui_side_nav_logo" onmouseover="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmouseout\', this);" onclick="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onclick\', this);">
                
                <div id="crnrstn_interact_ui_side_nav_logo_img_bg" class="crnrstn_interact_ui_bg_layer" style="width:2000px; height:2000px;"></div>

                <div class="crnrstn_interact_ui_side_nav_logo_bar_rel">
                    <div id="crnrstn_interact_ui_side_nav_logo_bar" class="crnrstn_interact_ui_side_nav_logo_bar"></div>
                </div>
                
                <div id="crnrstn_interact_ui_side_nav_logo_img_wrapper" class="crnrstn_interact_ui_side_nav_logo_img_wrapper">
                    
                    <div id="crnrstn_interact_ui_side_nav_logo_img_rel" class="crnrstn_interact_ui_side_nav_logo_img_rel" style="width:80px; height:50px;">
                    
                        <div id="crnrstn_interact_ui_side_nav_logo_img" class="crnrstn_interact_ui_side_nav_logo_img">' . $this->oCRNRSTN->return_system_image('CRNRSTN_LOGO', 40, '', '', '', '', NULL, CRNRSTN_UI_IMG_BASE64_PNG_HTML_WRAPPED) . '</div>
                        <div class="crnrstn_cb"></div>

                    </div>
                    <div class="crnrstn_cb"></div>
                </div>
            <div class="crnrstn_cb"></div>
            </div>
           
            <div id="crnrstn_interact_ui_side_nav" class="crnrstn_interact_ui_side_nav">
                <ul>
                    <!--<li><a id="crnrstn_text_lnk_' . $this->oCRNRSTN->hash('error_log', 'md5') . '" href="#error_log" onclick="oCRNRSTN_JS.toggle_full_overlay(); return false;">error_log</a></li>-->
                    ' . $this->return_documentation_side_nav_link_ARRAY() . '
                </ul>                
                <div class="crnrstn_cb_20"></div>
                <div>' . $this->oCRNRSTN->return_system_image('5', 30, '', '', '', '', 30, CRNRSTN_UI_IMG_BASE64_PNG_HTML_WRAPPED) . '</div>
                <div class="crnrstn_cb_100"></div>

           </div>
              
        </div>
        ';
        $tmp_str_array[] = '<!-- END CRNRSTN :: v' . $this->oCRNRSTN_USR->version_crnrstn() . ' :: DOCUMENTATION MODULE OUTPUT -->
';

        return $tmp_str_array;

    }

    public function return_sys_logging_profile(){

        return self::$sys_logging_profile_ARRAY;

    }

    public function return_sys_logging_meta(){

        return self::$sys_logging_meta_ARRAY;

    }

    private function return_file_path_user_class(){

        return CRNRSTN_ROOT . '/_crnrstn/class/user/crnrstn.user.inc.php';

        //
        // CLASS DEFINITION BY SUPPORTED PHP VERSION
        if(version_compare('8' , $this->oCRNRSTN->version_php()) < 1){

            //
            // PHP 8.0
            return CRNRSTN_ROOT . '/_crnrstn/class/user/crnrstn.user_PHP8.0.inc.php';
            //$this->print_r('PHP ' . $this->version_php.' >= 8.0...'.CRNRSTN_ROOT . '/_crnrstn/class/user/crnrstn.user_PHP8.0.inc.php', 'version_php oCRNRSTN_USR driver', CRNRSTN_HTML, __LINE__, __METHOD__, __FILE__);

        }else{

            if(version_compare('7' , $this->oCRNRSTN->version_php()) < 1){

                //
                // PHP 7.0
                return CRNRSTN_ROOT . '/_crnrstn/class/user/crnrstn.user_PHP7.0.inc.php';
                //$this->print_r('PHP ' . $this->version_php.' >= 7.0...'.CRNRSTN_ROOT . '/_crnrstn/class/user/crnrstn.user_PHP7.0.inc.php', 'version_php oCRNRSTN_USR driver', CRNRSTN_HTML, __LINE__, __METHOD__, __FILE__);

            }else{

                //
                // PHP < 7.0 (e.g. 5.5)
                return CRNRSTN_ROOT . '/_crnrstn/class/user/crnrstn.user_PHP5.5.inc.php';
                //$this->print_r('PHP ' . $this->version_php.' < 7.0...'.CRNRSTN_ROOT . '/_crnrstn/class/user/crnrstn.user_PHP5.5.inc.php', 'version_php oCRNRSTN_USR driver', CRNRSTN_HTML, __LINE__, __METHOD__, __FILE__);

            }

        }

    }

    public function return_ENV_oCRNRSTN_USR($WORDPRESS_debug_mode = NULL){

        //
        // WILL NEED TO UPDATE THIS SWITCH TO ACCEPT ANY NEW DEBUG CONSTANT
        // FOR WORDPRESS.
        switch ($WORDPRESS_debug_mode){
            case CRNRSTN_WORDPRESS_DEBUG:

                //$this->oCRNRSTN->retrieve_data_value($data_key, $data_type_family, $index);
                $this->oCRNRSTN->input_data_value($this->env_key, 'WORDPRESS_debug_mode', $WORDPRESS_debug_mode, '');

                $this->toggle_bit(CRNRSTN_WORDPRESS_DEBUG);

            break;

        }

        if(!isset($this->oCRNRSTN_USR)){

            $tmp_user_class_file_path = $this->return_file_path_user_class();
            require($tmp_user_class_file_path);

            $this->oCRNRSTN_USR = new crnrstn_user($this->oCRNRSTN, $this);

        }

        if(!isset($this->oCRNRSTN->oCRNRSTN_TRM)){

            // THIS IS BOUND TO THIRD PARTY SERVICE ON CONSTRUCTION. BREAK DEPENDENCY BEFORE NEXT USE.
            // INSTANTIATE TRANSACTION RESPONSE MANAGER
            //$this->oCRNRSTN->oCRNRSTN_TRM = new crnrstn_ui_tunnel_response_manager($this->oCRNRSTN);

        }

        return $this->oCRNRSTN_USR;

    }

    public function return_oCRNRSTN_USR(){

        if(!isset($this->oCRNRSTN_USR)){

            $tmp_user_class_file_path = $this->return_file_path_user_class();
            require($tmp_user_class_file_path);

            $this->oCRNRSTN_USR = new crnrstn_user($this->oCRNRSTN, $this);

        }

        return $this->oCRNRSTN_USR;

    }

    public function return_serialized_bit_nom($bit_family){

        switch($bit_family){
            case 'CLIENT_REQUESTED_PERMISSIONS':

                //$this->print_r(print_r($this->oSOAP_services_oClient_manager, true),'SERIALIZED BIT NOMINATION TEST',NULL, __LINE__,__METHOD__,__FILE__);

                //self::$oCRNRSTN_ENV->return_serialized_bit_nom($bit_family);

            break;
            case 'SERVER_AUTH_CONN_PERMISSIONS':

            break;
            case 'SERVER_AUTH_CLIENT_PERMISSIONS':

            break;

        }

        return false;

    }

    public function return_serialized_bit_value($bitwise_object_array_index_serial, $integer_constant){

        return $this->oCRNRSTN_BITFLIP_MGR->return_serialized_bit_value($bitwise_object_array_index_serial, $integer_constant);

    }

    public function return_bit_constant($const_nom){

        return $this->oCRNRSTN_BITFLIP_MGR->return_bit_constant($const_nom);

    }

    public function serialized_bit_stringin($const_nom, $int_string){

        return $this->oCRNRSTN_BITFLIP_MGR->serialized_bit_stringin($const_nom, $int_string);

    }

    public function serialized_bit_stringout($const_nom){

        return $this->oCRNRSTN_BITFLIP_MGR->serialized_bit_stringout($const_nom);

    }

    public function initialize_serialized_bit($const_nom, $integer_const, $default_state = true){

        return $this->oCRNRSTN_BITFLIP_MGR->initialize_serialized_bit($const_nom, $integer_const, $default_state);

    }

    public function serialized_is_bit_set($const_nom, $integer_const){

        return $this->oCRNRSTN_BITFLIP_MGR->serialized_is_bit_set($const_nom, $integer_const);

    }

    public function bit_stringin($int_string){

        return $this->oCRNRSTN_BITFLIP_MGR->bit_stringin($int_string);

    }

    public function bit_stringout(){

        return $this->oCRNRSTN_BITFLIP_MGR->bit_stringout();

    }

    public function toggle_bit($integer_const, $target_state = NULL){

        return $this->oCRNRSTN_BITFLIP_MGR->toggle_bit($integer_const, $target_state);

    }

    public function toggle_serialized_bit($const_nom, $integer_const){

        return $this->oCRNRSTN_BITFLIP_MGR->toggle_serialized_bit($const_nom, $integer_const);

    }

    public function initialize_bit($const_nom, $default_state = true){

        return $this->oCRNRSTN_BITFLIP_MGR->initialize_bit($const_nom, $default_state);

    }

    public function is_bit_set($const){

        return $this->oCRNRSTN_BITFLIP_MGR->is_bit_set($const);

    }

    public function return_oLog_ProfileManager(){

        return self::$oLog_ProfileManager;

    }

    public function chunkPageData($tmp_page_content, $max_len, $encoding = 'UTF-8'){

        $oChunkRestrictData = new crnrstn_chunk_restrictor($tmp_page_content, $max_len, $this, $encoding);

        return $oChunkRestrictData;

    }

    public function return_stripe_key_ARRAY($var_0, $var_1 = NULL, $var_2 = NULL, $var_3 = NULL, $var_4 = NULL, $var_5 = NULL, $var_6 = NULL, $var_7 = NULL, $var_8 = NULL, $var_9 = NULL, $var_10 = NULL, $var_11 = NULL){

        $key_count = 0;
        $tmp_str_ARRAY = array();
        $tmp_str_ARRAY[] = $var_0;

        $key_count++;
        if(isset($var_1)){

            $tmp_str_ARRAY[] = $var_1;

        }

        if($key_count > sizeof($tmp_str_ARRAY)) return $tmp_str_ARRAY;

        $key_count++;
        if(isset($var_2)){

            $tmp_str_ARRAY[] = $var_2;

        }

        if($key_count > sizeof($tmp_str_ARRAY)) return $tmp_str_ARRAY;

        $key_count++;
        if(isset($var_3)){

            $tmp_str_ARRAY[] = $var_3;

        }

        if($key_count > sizeof($tmp_str_ARRAY)) return $tmp_str_ARRAY;

        $key_count++;
        if(isset($var_4)){

            $tmp_str_ARRAY[] = $var_4;

        }

        if($key_count > sizeof($tmp_str_ARRAY)) return $tmp_str_ARRAY;

        $key_count++;
        if(isset($var_5)){

            $tmp_str_ARRAY[] = $var_5;

        }

        if($key_count > sizeof($tmp_str_ARRAY)) return $tmp_str_ARRAY;

        $key_count++;
        if(isset($var_6)){

            $tmp_str_ARRAY[] = $var_6;

        }

        if($key_count > sizeof($tmp_str_ARRAY)) return $tmp_str_ARRAY;

        $key_count++;
        if(isset($var_7)){

            $tmp_str_ARRAY[] = $var_7;

        }

        if($key_count > sizeof($tmp_str_ARRAY)) return $tmp_str_ARRAY;

        $key_count++;
        if(isset($var_8)){

            $tmp_str_ARRAY[] = $var_8;

        }

        if($key_count > sizeof($tmp_str_ARRAY)) return $tmp_str_ARRAY;

        $key_count++;
        if(isset($var_9)){

            $tmp_str_ARRAY[] = $var_9;

        }

        if($key_count > sizeof($tmp_str_ARRAY)) return $tmp_str_ARRAY;

        $key_count++;
        if(isset($var_10)){

            $tmp_str_ARRAY[] = $var_10;

        }

        if($key_count > sizeof($tmp_str_ARRAY)) return $tmp_str_ARRAY;

        $key_count++;
        if(isset($var_11)){

            $tmp_str_ARRAY[] = $var_11;

        }

        if($key_count > sizeof($tmp_str_ARRAY)) return $tmp_str_ARRAY;

        return $tmp_str_ARRAY;

    }

    private function output_regression_stripe_ARRAY($result_str, $result_array, $output_format = 'array'){

        $tmp_ARRAY = array();
        $tmp_ARRAY['string'] = $result_str;
        $tmp_ARRAY['index_array'] = $result_array;

        if($output_format != 'array'){

            return $tmp_ARRAY['string'];

        }

        return $tmp_ARRAY;

    }


    public function return_regression_stripe_ARRAY($operation_type, $data_key_ARRAY, $var_0 = NULL, $var_1 = NULL, $var_2 = NULL, $var_3 = NULL, $var_4 = NULL, $var_5 = NULL, $var_6 = NULL, $var_7 = NULL, $var_8 = NULL, $var_9 = NULL, $var_10 = NULL, $var_11 = NULL){

        $tmp_total_index = count($data_key_ARRAY);
        $tmp_var_index_pos = 0;
        $tmp_str_out = '';
        $tmp_array_out_ARRAY = array();

        switch($operation_type){
            case 'HAS_STRING_DATA':

                if(isset($var_0)){

                    if(strlen($var_0) > 0){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is not an empty string. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(isset($var_1)){

                    if(strlen($var_1) > 0){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is not an empty string. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(isset($var_2)){

                    if(strlen($var_2) > 0){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is not an empty string. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(isset($var_3)){

                    if(strlen($var_3) > 0){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is not an empty string. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(isset($var_4)){

                    if(strlen($var_4) > 0){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is not an empty string. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(isset($var_5)){

                    if(strlen($var_5) > 0){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is not an empty string. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(isset($var_6)){

                    if(strlen($var_6) > 0){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is not an empty string. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(isset($var_7)){

                    if(strlen($var_7) > 0){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is not an empty string. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(isset($var_8)){

                    if(strlen($var_8) > 0){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is not an empty string. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(isset($var_9)){

                    if(strlen($var_9) > 0){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is not an empty string. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(isset($var_10)){

                    if(strlen($var_10) > 0){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is not an empty string. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(isset($var_11)){

                    if(strlen($var_11) > 0){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is not an empty string. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }

                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

            break;
            case 'MISSING_STRING_DATA':

                if(isset($var_0)){

                    if($var_0 == ''){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is empty. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }else{

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(isset($var_1)){

                    if($var_1 == ''){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is empty. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }else{

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(isset($var_2)){

                    if($var_2 == ''){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is empty. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }else{

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(isset($var_3)){

                    if($var_3 == ''){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is empty. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }else{

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(isset($var_4)){

                    if($var_4 == ''){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is empty. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }else{

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(isset($var_5)){

                    if($var_5 == ''){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is empty. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }else{

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(isset($var_6)){

                    if($var_6 == ''){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is empty. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }else{

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(isset($var_7)){

                    if($var_7 == ''){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is empty. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }else{

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(isset($var_8)){

                    if($var_8 == ''){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is empty. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }else{

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(isset($var_9)){

                    if($var_9 == ''){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is empty. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }else{

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(isset($var_10)){

                    if($var_10 == ''){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is empty. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }else{

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(isset($var_11)){

                    if($var_11 == ''){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is empty. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }else{

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

            break;
            default:

                // $operation_type = 'IS_NULL'
                // CHECK FOR IS NULL
                if(!isset($var_0)){

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(!isset($var_1)){

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(!isset($var_2)){

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(!isset($var_3)){

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(!isset($var_4)){

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(!isset($var_5)){

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(!isset($var_6)){

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(!isset($var_7)){

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(!isset($var_8)){

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(!isset($var_9)){

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(!isset($var_10)){

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

                if(!isset($var_11)){

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                if($tmp_var_index_pos >= $tmp_total_index) return $this->output_regression_stripe_ARRAY(rtrim($tmp_str_out), $tmp_array_out_ARRAY);

            break;

        }

        $tmp_final_out_ARRAY = array();
        $tmp_final_out_ARRAY['string'] = $tmp_str_out;
        $tmp_final_out_ARRAY['index_array'] = $tmp_array_out_ARRAY;

        return $tmp_final_out_ARRAY;

    }

//    private function remove_previous_sess_env_detect_data($oCRNRSTN){
//
//        $oCRNRSTN->oLog_output_ARRAY = $this->oLog_output_ARRAY;
//
//        $oCRNRSTN->remove_previous_sess_env_detect_data();
//
//        $this->oLog_output_ARRAY = $oCRNRSTN->oLog_output_ARRAY;
//
//    }

    public function get_server_config_serial($output_format){

        if($output_format === 'hash'){

            return $this->config_serial_hash;

        }

        return self::$config_serial;

    }

    public function safe_getServerArrayVar($param, $oCRNRSTN_USR = NULL){

        if($this->isset_ServerArrayVar($param)){

            return $this->getServerArrayVar($param, $oCRNRSTN_USR);

        }else{

            return false;

        }
    }

    public function isset_ServerArrayVar($param){

        if(isset($_SERVER[$param])){

            return true;

        }else{

            return false;

        }

    }

    public function getServerArrayVar($param, $oCRNRSTN_USR = NULL){

        try {

            if(!isset($_SERVER[$param])){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('The requested $_SERVER super global parameter [' . $param . '] cannot be found.');

            }else{

                return $_SERVER[$param];

            }

        }catch(Exception $e){

            if(isset($oCRNRSTN_USR)){

                //
                // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
                $oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            }else{

                //
                // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
                $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            }

            return false;

        }

    }

    public function return_client_header_value($header_attribute, $index){

        return $this->oHTTP_MGR->return_client_header_value($header_attribute, $index);

    }

    public function issetHTTP($transport_protocol){

        if(is_array($transport_protocol)){

            return $this->oHTTP_MGR->issetHTTP($transport_protocol);

        }

        switch($transport_protocol){
            case 'GET':

                $super_global = $_GET;

            break;
            default:

                //
                // POST
                $super_global = $_POST;

            break;

        }

        return $this->oHTTP_MGR->issetHTTP($super_global);

    }

    public function return_SOAP_svc_config_param($param_key){

        foreach($this->oSOAP_services_access_manager as $serial => $oSOAP_svc_mgr){

            return $oSOAP_svc_mgr->return_soap_encryption_config_param($param_key);

        }

    }

    public function return_SOAP_svc_oClient_meta($param_key, $CRNRSTN_SOAP_SVC_USERNAME, $CRNRSTN_SOAP_SVC_PASSWORD){

        foreach($this->oSOAP_services_oClient_manager as $serial => $oSOAP_oClient){

            $tmp_un = $oSOAP_oClient->return_username();
            $tmp_pwd = $oSOAP_oClient->return_password();
            //error_log(__LINE__ . ' env - [' . $param_key . '][' . $tmp_un . '][' . $CRNRSTN_SOAP_SVC_USERNAME . '][' . $tmp_pwd . '][' . $CRNRSTN_SOAP_SVC_PASSWORD . ']');
            if($tmp_un == $CRNRSTN_SOAP_SVC_USERNAME && $this->validate_pwd_hash_login($tmp_pwd, $CRNRSTN_SOAP_SVC_PASSWORD)){

                $tmp_soap_encryption_config_ARRAY = $oSOAP_oClient->return_soap_services_soap_encryption_config();

                switch($param_key){
                    case 'SOAP_ENCRYPT_CIPHER':

                        return $tmp_soap_encryption_config_ARRAY['encryptCipher'];

                    break;
                    case 'SOAP_ENCRYPT_SECRET_KEY':

                        return $tmp_soap_encryption_config_ARRAY['encryptSecretKey'];

                    break;
                    case 'SOAP_ENCRYPT_HMAC_ALG':

                        return $tmp_soap_encryption_config_ARRAY['hmac_alg'];

                    break;
                    case 'SOAP_ENCRYPT_OPTIONS':

                        return $tmp_soap_encryption_config_ARRAY['encryptOptions'];

                    break;
                    default:

                        return $tmp_soap_encryption_config_ARRAY;

                    break;

                }

            }

        }

        return false;

    }

    private function ___init_wp_config($oCRNRSTN){

        if(!!$oCRNRSTN->wp_config_file_path_ARRAY[$this->config_serial_hash][$oCRNRSTN->hash(CRNRSTN_RESOURCE_ALL)]){

            foreach($oCRNRSTN->wp_config_file_path_ARRAY[$this->config_serial_hash][$oCRNRSTN->hash(CRNRSTN_RESOURCE_ALL)] as $key => $wp_config_file_path){

                if(is_file($wp_config_file_path)){

                    $oWildCardResource_ARRAY = array();

                    //
                    // EXTRACT PROFILE FROM FILE
                    $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('We have a file to include and process for the initialization of WordPress profiles authorized to connect to CRNRSTN :: [' . $this->soap_permissions_file_path_ARRAY[$this->config_serial_hash][$oCRNRSTN->hash(CRNRSTN_RESOURCE_ALL)][$key] . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                    include_once($wp_config_file_path);

                    $this->oWildCardResource_ARRAY[$this->config_serial_hash][CRNRSTN_LOG_ALL][] = $oWildCardResource_ARRAY;

                }else{

                    error_log(__LINE__ . ' env NOT A WP CONFIG FILE [' . $wp_config_file_path . ']');

                }

            }

        }else{

            if(!!$oCRNRSTN->wp_config_file_path_ARRAY[$this->config_serial_hash][$this->env_key_hash]){

                foreach($oCRNRSTN->wp_config_file_path_ARRAY[$this->config_serial_hash][$this->env_key_hash] as $key => $wp_config_file_path){

                    if(is_file($wp_config_file_path)){

                        $oWildCardResource_ARRAY = array();

                        //
                        // EXTRACT PROFILE FROM FILE
                        $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('We have a file to include and process for the initialization of WordPress profiles authorized to connect to CRNRSTN :: [' . $this->soap_permissions_file_path_ARRAY[$this->config_serial_hash][$this->env_key_hash][$key] . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                        include_once($wp_config_file_path);

                        $this->oWildCardResource_ARRAY[$this->config_serial_hash][CRNRSTN_LOG_ALL][] = $oWildCardResource_ARRAY;

                    }else{

                        error_log(__LINE__ . ' env NOT A WP CONFIG FILE [' . $wp_config_file_path . ']');

                    }

                }

            }else{

                error_log(__LINE__ . ' env NO WP CONFIG.');

            }

        }

    }

    private function init_analytics_config($oCRNRSTN){

        if(!!$oCRNRSTN->analytics_config_file_path_ARRAY[$this->config_serial_hash][$oCRNRSTN->hash(CRNRSTN_RESOURCE_ALL)]){

            foreach($oCRNRSTN->analytics_config_file_path_ARRAY[$this->config_serial_hash][$oCRNRSTN->hash(CRNRSTN_RESOURCE_ALL)] as $key => $analytics_config_file_path){

                if(is_file($analytics_config_file_path)){

                    $oWildCardResource_ARRAY = array();

                    //
                    // EXTRACT PROFILE FROM FILE
                    $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('We have a file to include and process for the initialization of analytics SEO profiles from the CRNRSTN :: configuration file [' . $oCRNRSTN->analytics_config_file_path_ARRAY[$this->config_serial_hash][$oCRNRSTN->hash(CRNRSTN_RESOURCE_ALL)][$key] . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                    include_once($analytics_config_file_path);

                    $this->oWildCardResource_ARRAY[$this->config_serial_hash][CRNRSTN_LOG_ALL][] = $oWildCardResource_ARRAY;

                }else{

                    error_log(__LINE__ . ' env NOT AN ANALYTICS SEO CONFIG FILE [' . $analytics_config_file_path . ']');

                }

            }

        }else{

            if(!!$oCRNRSTN->analytics_config_file_path_ARRAY[$this->config_serial_hash][$this->env_key_hash]){

                foreach($oCRNRSTN->analytics_config_file_path_ARRAY[$this->config_serial_hash][$this->env_key_hash] as $key => $analytics_config_file_path){

                    if(is_file($analytics_config_file_path)){

                        $oWildCardResource_ARRAY = array();

                        //
                        // EXTRACT PROFILE FROM FILE
                        $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('We have a file to include and process for the initialization of analytics SEO profiles from the CRNRSTN :: configuration file [' . $oCRNRSTN->analytics_config_file_path_ARRAY[$this->config_serial_hash][$this->env_key_hash][$key] . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                        include_once($analytics_config_file_path);

                        $this->oWildCardResource_ARRAY[$this->config_serial_hash][CRNRSTN_LOG_ALL][] = $oWildCardResource_ARRAY;

                    }else{

                        error_log(__LINE__ . ' env NOT AN ANALYTICS SEO CONFIG FILE [' . $analytics_config_file_path . ']');

                    }

                }

            }else{

                error_log(__LINE__ . ' env NO ANALYTICS SEO CONFIGURED.');

            }

        }

    }

    public function return_serialized_soap_data_tunnel_session($packet_type = 'crnrstn_session_json'){

        /*
        crnrstn_session
        SESSION_ID              char(26)
        SESSION_ID_CRC32        int(11) unsigned
        SERIAL_ID               char(128)
        SERIAL_ID_CRC32         int(11) unsigned
        SERIAL                  char(128)
        SERIAL_CRC32            int(11) unsigned
        ISACTIVE                tinyint(2) default 1
        CLIENT_ID               char(100)
        SERVER_IP               int(11) unsigned
        CLIENT_IP               int(11) unsigned
        DEVICE_TYPE_CONSTANT    int(11)
        DEVICE_TYPE             varchar(25) null allowed
        HTTP_USER_AGENT         varchar(500) null allowed
        ACCEPT_LANGUAGE         varchar(150) null allowed
        HTTP_REFERER	        varchar(500) null allowed
        DATEMODIFIED            datetime
        DATECREATED             timestamp default _CURRENT_TIMESTAMP
        */

        if($this->oCRNRSTN_USR->isset_query_result_set_key('CRNRSTN_SESSION_DATA')){

            error_log(__LINE__ . ' ui trans CRNRSTN_SESSION_DATA isset_query_result_set IS SET! die();');
            die();
            $tmp_session_count = $this->oCRNRSTN_USR->return_record_count('CRNRSTN_SESSION_DATA');

            if($tmp_session_count > 0){

                // crnrstn_sessions TABLE DATA
                $tmp_client_ip = $this->oCRNRSTN_USR->return_client_ip();
                $tmp_session_id = session_id();
                $tmp_SESSION_ID = $this->oCRNRSTN_USR->return_database_value('CRNRSTN_SESSION_DATA', 'SESSION_ID', 0, true);
                $tmp_SERVER_IP = $this->oCRNRSTN_USR->return_database_value('CRNRSTN_SESSION_DATA', 'SERVER_IP', 0, true);
                $tmp_CLIENT_ID = $this->oCRNRSTN_USR->return_database_value('CRNRSTN_SESSION_DATA', 'CLIENT_ID', 0, true);
                $tmp_CLIENT_IP = $this->oCRNRSTN_USR->return_database_value('CRNRSTN_SESSION_DATA', 'CLIENT_IP', 0, true);
                $tmp_CRNRSTN_SESSION_DATA_DATEMODIFIED = $this->oCRNRSTN_USR->return_database_value('CRNRSTN_SESSION_DATA', 'DATEMODIFIED', 0, true);
                $tmp_CRNRSTN_SESSION_DATA_DATECREATED = $this->oCRNRSTN_USR->return_database_value('CRNRSTN_SESSION_DATA', 'DATECREATED', 0, true);

            }else{

                error_log(__LINE__ . ' ui trans CRNRSTN_SESSION_DATA HAS NO SESSION DATA.');

                $tmp_client_id = $this->oCRNRSTN_USR->return_http_form_integration_input_val('crnrstn_client_id');
                $ts_json = $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN_USR->return_query_date_time_stamp());

                // crnrstn_sessions TABLE DATA
                $tmp_client_ip = $this->oCRNRSTN_USR->return_client_ip();
                $tmp_session_id = session_id();
                $tmp_SESSION_ID = $tmp_session_id;
                $tmp_SERVER_IP = $this->oCRNRSTN->return_clean_json_string($_SERVER['SERVER_ADDR']);
                $tmp_CLIENT_ID = $this->oCRNRSTN->return_clean_json_string($tmp_client_id);
                $tmp_CLIENT_IP = $this->oCRNRSTN->return_client_ip();
                $tmp_CRNRSTN_SESSION_DATA_DATEMODIFIED = $ts_json;
                $tmp_CRNRSTN_SESSION_DATA_DATECREATED = $ts_json;

            }

        }else{

            error_log(__LINE__ . ' ui trans CRNRSTN_SESSION_DATA isset_query_result_set IS NOT SET!');

            $tmp_client_id = $this->oCRNRSTN_USR->return_http_form_integration_input_val('crnrstn_client_id');
            $ts_json = $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN_USR->return_query_date_time_stamp());

            // crnrstn_sessions TABLE DATA
            $tmp_client_ip = $this->oCRNRSTN_USR->return_client_ip();
            $tmp_session_id = session_id();
            $tmp_SESSION_ID = $tmp_session_id;
            $tmp_SERVER_IP = $this->oCRNRSTN->return_clean_json_string($_SERVER['SERVER_ADDR']);
            $tmp_CLIENT_ID = $this->oCRNRSTN->return_clean_json_string($tmp_client_id);
            $tmp_CLIENT_IP = $this->oCRNRSTN_USR->return_client_ip();
            $tmp_CRNRSTN_SESSION_DATA_DATEMODIFIED = $ts_json;
            $tmp_CRNRSTN_SESSION_DATA_DATECREATED = $ts_json;

        }

        error_log(__LINE__ . ' ui trans $tmp_SESSION_ID=' . $tmp_SESSION_ID);

        if($tmp_client_ip != $tmp_CLIENT_IP && strlen($tmp_CLIENT_IP) > 0){

            //
            // SOFT ALERT SINCE NO USER AUTHENTICATED EXPERIENCE
            $tmp_STATUS_TARGET_ELEMENT = 'null';
            $tmp_STATUS = '200';
            $tmp_STATUS_CODE = '418';
            $tmp_STATUS_MESSAGE = 'I\'m a teapot';
            $tmp_ERROR_CODE = '2227';
            $tmp_ERROR_MESSAGE = 'The client IP address has straight deviated from the CRNRSTN :: PSEUDO-SOAP
                    -SERVICES Data Tunnel Layer session initialization profile. No immediate action needs 
                    to be taken at this time.';

        }else{

            if($tmp_session_id != $tmp_SESSION_ID && strlen($tmp_SESSION_ID) > 0){

                //
                // SOFT ALERT SINCE NO USER AUTHENTICATED EXPERIENCE
                $tmp_STATUS_TARGET_ELEMENT = 'null';
                $tmp_STATUS = '200';
                $tmp_STATUS_CODE = '418';
                $tmp_STATUS_MESSAGE = 'I\'m a teapot';
                $tmp_ERROR_CODE = '2228';
                $tmp_ERROR_MESSAGE = 'The SESSION profile of the CRNRSTN :: PSEUDO-SOAP-SERVICES 
                    Data Tunnel Layer Packet has straight deviated from the server process currently running the 
                    PSSDTL profile[' . $tmp_session_id . '][' . $tmp_SESSION_ID.']. No immediate action needs to be taken at this time.';

            }else{

                $tmp_STATUS_TARGET_ELEMENT = 'null';
                $tmp_STATUS = '200';
                $tmp_STATUS_CODE = '420';
                $tmp_STATUS_MESSAGE = 'Enhance Your Calm';
                $tmp_ERROR_CODE = '0';
                $tmp_ERROR_MESSAGE = '0';

            }

        }

        /*

        ' . $CANVAS_PROFILE_CONTENT . '
        ' . $CANVAS_PROFILE_LOCK . '
        ' . $CANVAS_PROFILE_LOCK_TTL . '
        ' . $CANVAS_PROFILE_LOCK_ISACTIVE . '

        ' . $CANVAS_PROFILES_DIMENSION_POSITION_CHECKSUM . '
        ' . $CANVAS_PROFILES_DIMENSION_POSITION_CONTENT . '

        ' . $CANVAS_PROFILES_DIMENSION_POSITION_LOCK . '
        ' . $CANVAS_PROFILES_DIMENSION_POSITION_LOCK_TTL . '
        ' . $CANVAS_PROFILES_DIMENSION_POSITION_LOCK_ISACTIVE . '

         * */

        // crnrstn_jony5_content_version_checksums TABLE DATA
        $CHECKSUM_PROFILE_ID = '"CHECKSUM_PROFILE_ID" : ' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'CHECKSUM_PROFILE_ID', 0, true) . ',';
        $PROGRAM_KEY = '"PROGRAM_KEY" : ' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'PROGRAM_KEY', 0, true) . ',';
        $DEVICE_TYPE_CHANNEL = '"DEVICE_TYPE_CHANNEL" : ' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'DEVICE_TYPE_CHANNEL', 0, true) . ',';

        $CANVAS_PROFILE_HASH = '"CANVAS_PROFILE_HASH" : "' . $this->oCRNRSTN_USR->return_ui_interact_canvas_profile_checksum() . '",';
        $CANVAS_PROFILE_CONTENT = '"CANVAS_PROFILE_CONTENT" : "' . $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN_USR->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILE_CONTENT')) . '",';
        $CANVAS_PROFILE_LOCK = '"CANVAS_PROFILE_LOCK" : "' . $this->oCRNRSTN_USR->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILE_LOCK') . '",';
        $CANVAS_PROFILE_LOCK_TTL = '"CANVAS_PROFILE_LOCK_TTL" : "' . $this->oCRNRSTN_USR->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILE_LOCK_TTL') . '",';
        $CANVAS_PROFILE_LOCK_ISACTIVE = '"CANVAS_PROFILE_LOCK_ISACTIVE" : "' . $this->oCRNRSTN_USR->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILE_LOCK_ISACTIVE') . '",';

        $CANVAS_PROFILES_DIMENSION_POSITION_CHECKSUM = '"CANVAS_PROFILES_DIMENSION_POSITION_CHECKSUM" : "' . $this->oCRNRSTN_USR->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILES_DIMENSION_POSITION_CHECKSUM') . '",';
        $CANVAS_PROFILES_DIMENSION_POSITION_CONTENT = '"CANVAS_PROFILES_DIMENSION_POSITION_CONTENT" : "' . $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN_USR->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILES_DIMENSION_POSITION_CONTENT')) . '",';
        $CANVAS_PROFILES_DIMENSION_POSITION_LOCK = '"CANVAS_PROFILES_DIMENSION_POSITION_LOCK" : "' . $this->oCRNRSTN_USR->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILES_DIMENSION_POSITION_LOCK') . '",';
        $CANVAS_PROFILES_DIMENSION_POSITION_LOCK_TTL = '"CANVAS_PROFILES_DIMENSION_POSITION_LOCK_TTL" : "' . $this->oCRNRSTN_USR->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILES_DIMENSION_POSITION_LOCK_TTL') . '",';
        $CANVAS_PROFILES_DIMENSION_POSITION_LOCK_ISACTIVE = '"CANVAS_PROFILES_DIMENSION_POSITION_LOCK_ISACTIVE" : "' . $this->oCRNRSTN_USR->return_ui_interact_canvas_profile_checksum('CANVAS_PROFILES_DIMENSION_POSITION_LOCK_ISACTIVE') . '",';

        $CONTENT_CHECKSUM_TTL = '"CONTENT_CHECKSUM_TTL" : "' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'CONTENT_CHECKSUM_TTL', 0, true) . '",';
        $TITLE_CHECKSUM = '"TITLE_CHECKSUM" : "' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'TITLE_CHECKSUM', 0, true) . '",';
        $TITLE_CONTENT = '"TITLE_CONTENT" : ' . $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'TITLE_CONTENT', 0, true)) . ',';
        $TITLE_CONTENT_LOCK = '"TITLE_CONTENT_LOCK" : "' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'TITLE_CONTENT_LOCK', 0, true) . '",';
        $TITLE_CONTENT_LOCK_TTL = '"TITLE_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'TITLE_CONTENT_LOCK_TTL', 0, true) . '",';
        $TITLE_CONTENT_LOCK_ISACTIVE = '"TITLE_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'TITLE_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
        $SOCIAL_CHECKSUM = '"SOCIAL_CHECKSUM" : "' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'SOCIAL_CHECKSUM', 0, true) . '",';
        $SOCIAL_CONTENT = '"SOCIAL_CONTENT" : ' . $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'SOCIAL_CONTENT', 0, true)) . ',';
        $SOCIAL_CONTENT_LOCK = '"SOCIAL_CONTENT_LOCK" : "' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'SOCIAL_CONTENT_LOCK', 0, true) . '",';
        $SOCIAL_CONTENT_LOCK_TTL = '"SOCIAL_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'SOCIAL_CONTENT_LOCK_TTL', 0, true) . '",';
        $SOCIAL_CONTENT_LOCK_ISACTIVE = '"SOCIAL_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'SOCIAL_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
        $COLORS_CHECKSUM = '"COLORS_CHECKSUM" : "' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'COLORS_CHECKSUM', 0, true) . '",';
        $COLORS_CONTENT = '"COLORS_CONTENT" : ' . $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'COLORS_CONTENT', 0, true)) . ',';
        $COLORS_CONTENT_LOCK = '"COLORS_CONTENT_LOCK" : "' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'COLORS_CONTENT_LOCK', 0, true) . '",';
        $COLORS_CONTENT_LOCK_TTL = '"COLORS_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'COLORS_CONTENT_LOCK_TTL', 0, true) . '",';
        $COLORS_CONTENT_LOCK_ISACTIVE = '"COLORS_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'COLORS_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
        $STATS_CHECKSUM = '"STATS_CHECKSUM" : "' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'STATS_CHECKSUM', 0, true) . '",';
        $STATS_CONTENT = '"STATS_CONTENT" : ' . $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'STATS_CONTENT', 0, true)) . ',';
        $STATS_CONTENT_LOCK = '"STATS_CONTENT_LOCK" : "' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'STATS_CONTENT_LOCK', 0, true) . '",';
        $STATS_CONTENT_LOCK_TTL = '"STATS_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'STATS_CONTENT_LOCK_TTL', 0, true) . '",';
        $STATS_CONTENT_LOCK_ISACTIVE = '"STATS_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'STATS_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
        $RELAY_CHECKSUM = '"RELAY_CHECKSUM" : "' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'RELAY_CHECKSUM', 0, true) . '",';
        $RELAY_CONTENT = '"RELAY_CONTENT" : ' . $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'RELAY_CONTENT', 0, true)) . ',';
        $RELAY_CONTENT_LOCK = '"RELAY_CONTENT_LOCK" : "' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'RELAY_CONTENT_LOCK', 0, true) . '",';
        $RELAY_CONTENT_LOCK_TTL = '"RELAY_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'RELAY_CONTENT_LOCK_TTL', 0, true) . '",';
        $RELAY_CONTENT_LOCK_ISACTIVE = '"RELAY_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'RELAY_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
        $REPORTING_CHECKSUM = '"REPORTING_CHECKSUM" : "' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'REPORTING_CHECKSUM', 0, true) . '",';
        $REPORTING_CONTENT = '"REPORTING_CONTENT" : ' . $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'REPORTING_CONTENT', 0, true)) . ',';
        $REPORTING_CONTENT_LOCK = '"REPORTING_CONTENT_LOCK" : "' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'REPORTING_CONTENT_LOCK', 0, true) . '",';
        $REPORTING_CONTENT_LOCK_TTL = '"REPORTING_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'REPORTING_CONTENT_LOCK_TTL', 0, true) . '",';
        $REPORTING_CONTENT_LOCK_ISACTIVE = '"REPORTING_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'REPORTING_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
        $WILDCARD_CHECKSUM = '"WILDCARD_CHECKSUM" : "' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'WILDCARD_CHECKSUM', 0, true) . '",';
        $WILDCARD_CONTENT = '"WILDCARD_CONTENT" : ' . $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'WILDCARD_CONTENT', 0, true)) . ',';
        $WILDCARD_CONTENT_LOCK = '"WILDCARD_CONTENT_LOCK" : "' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'WILDCARD_CONTENT_LOCK', 0, true) . '",';
        $WILDCARD_CONTENT_LOCK_TTL = '"WILDCARD_CONTENT_LOCK_TTL" : "' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'WILDCARD_CONTENT_LOCK_TTL', 0, true) . '",';
        $WILDCARD_CONTENT_LOCK_ISACTIVE = '"WILDCARD_CONTENT_LOCK_ISACTIVE" : "' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'WILDCARD_CONTENT_LOCK_ISACTIVE', 0, true) . '",';
        $tmp_CRNRSTN_CACHE_CHECKSUM_TTL_DATA_DATEMODIFIED = '"DATEMODIFIED" : ' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'DATEMODIFIED', 0, true) . ',';
        $tmp_CRNRSTN_CACHE_CHECKSUM_TTL_DATA_DATECREATED = '"DATECREATED" : ' . $this->oCRNRSTN_USR->return_database_value('CRNRSTN_CACHE_CHECKSUM_TTL_DATA', 'DATECREATED', 0, true) . ',';

        $tmp_CRNRSTN_ENVIRONMENTAL_RESOURCE_CONFIGURATION = $this->oSESSION_MGR->return_session_oDDO_profile('pssdtl');

        $tmp_json_data = '';

        switch($packet_type){
            case 'crnrstn_session_json':

                //$tmp_crnrstn_session = $this->oCRNRSTN_USR->return_http_form_integration_input_val('crnrstn_session');
                /*

                12/18/2021 1311 hrs
                ORIGINAL JONY5.COM JSON SOURCE OBJECT BELOW.
                THANK YOU FOR YOUR SERVICES.

                $tmp_json_data = '{
                                   "ui_sync_controller_threads" : [
                                        {
                                        ' . $TITLE_CHECKSUM . '
                                        ' . $SOCIAL_CHECKSUM . '
                                        ' . $COLORS_CHECKSUM . '
                                        ' . $STATS_CHECKSUM . '
                                        "jony5_lifestyle_banner_checksum" : "8/16/2021 0345 :: Miss you, J5...my boy!"
                                        }
                                   ]
                                }';

                */

                // DO WE EVEN NEED THE xxxxx_CONTENT DATA HERE SINCE THIS ENCRYPTED
                // PACKET WILL NOT BE USED BY THE BROWSER?
                $tmp_json_data = '{
                    "oCRNRSTN_SESSION" : [
                        {
                        "SESSION_ID" : "' . $tmp_SESSION_ID . '",
                        "CLIENT_ID" : "' . $tmp_CLIENT_ID . '",
                        "CLIENT_IP" : "' . $tmp_CLIENT_IP . '", 
                        "SERVER_IP" : ' . $tmp_SERVER_IP . ',
                        "EDGE_SERVER_IP" : ' . $this->oCRNRSTN->return_clean_json_string($_SERVER['SERVER_ADDR']) . ',
                        "SESSION_ID_DATEMODIFIED" : ' . $tmp_CRNRSTN_SESSION_DATA_DATEMODIFIED . ',
                        "SESSION_ID_DATECREATED" : ' . $tmp_CRNRSTN_SESSION_DATA_DATECREATED . ',
                        "STATUS_REPORT" : [
                            {
                            "STATUS_TARGET_ELEMENT" : ' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS_TARGET_ELEMENT) . ',
                            "STATUS" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS) . '",
                            "STATUS_CODE" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS_CODE) . '",
                            "STATUS_MESSAGE" : ' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS_MESSAGE) . ',
                            "ERROR_CODE" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_ERROR_CODE) . '",
                            "ERROR_MESSAGE" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_ERROR_MESSAGE) . '"
                            },{
                            "STATUS_TARGET_ELEMENT" : ' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS_TARGET_ELEMENT) . ',
                            "STATUS" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS) . '",
                            "STATUS_CODE" : "1234567890",
                            "STATUS_MESSAGE" : ' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS_MESSAGE) . ',
                            "ERROR_CODE" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_ERROR_CODE) . '",
                            "ERROR_MESSAGE" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_ERROR_MESSAGE) . '"
                            },{
                            "STATUS_TARGET_ELEMENT" : ' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS_TARGET_ELEMENT) . ',
                            "STATUS" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS) . '",
                            "STATUS_CODE" : "0987654321",
                            "STATUS_MESSAGE" : ' . $this->oCRNRSTN->return_clean_json_string($tmp_STATUS_MESSAGE) . ',
                            "ERROR_CODE" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_ERROR_CODE) . '",
                            "ERROR_MESSAGE" : "' . $this->oCRNRSTN->return_clean_json_string($tmp_ERROR_MESSAGE) . '"
                            }],
                        "UI_SYNC_CONTROLLER_THREADS" : [
                            {
                            ' . $CHECKSUM_PROFILE_ID . '
                            ' . $PROGRAM_KEY . '
                            ' . $DEVICE_TYPE_CHANNEL . '
                            ' . $CANVAS_PROFILE_CONTENT . '
                            ' . $CANVAS_PROFILE_HASH . '
                            ' . $CANVAS_PROFILE_LOCK . '
                            ' . $CANVAS_PROFILE_LOCK_TTL . '
                            ' . $CANVAS_PROFILE_LOCK_ISACTIVE . '
                            ' . $CANVAS_PROFILES_DIMENSION_POSITION_CONTENT . '
                            ' . $CANVAS_PROFILES_DIMENSION_POSITION_CHECKSUM . '
                            ' . $CANVAS_PROFILES_DIMENSION_POSITION_LOCK . '
                            ' . $CANVAS_PROFILES_DIMENSION_POSITION_LOCK_TTL . '
                            ' . $CANVAS_PROFILES_DIMENSION_POSITION_LOCK_ISACTIVE . '
                            ' . $CONTENT_CHECKSUM_TTL . '
                            ' . $TITLE_CONTENT . '
                            ' . $TITLE_CHECKSUM . '
                            ' . $TITLE_CONTENT_LOCK . '
                            ' . $TITLE_CONTENT_LOCK_TTL . '
                            ' . $TITLE_CONTENT_LOCK_ISACTIVE . '
                            ' . $SOCIAL_CONTENT . '
                            ' . $SOCIAL_CHECKSUM . '
                            ' . $SOCIAL_CONTENT_LOCK . '
                            ' . $SOCIAL_CONTENT_LOCK_TTL . '
                            ' . $SOCIAL_CONTENT_LOCK_ISACTIVE . '
                            ' . $COLORS_CONTENT . '
                            ' . $COLORS_CHECKSUM . '
                            ' . $COLORS_CONTENT_LOCK . '
                            ' . $COLORS_CONTENT_LOCK_TTL . '
                            ' . $COLORS_CONTENT_LOCK_ISACTIVE . '
                            ' . $STATS_CONTENT . '
                            ' . $STATS_CHECKSUM . '
                            ' . $STATS_CONTENT_LOCK . '
                            ' . $STATS_CONTENT_LOCK_TTL . '
                            ' . $STATS_CONTENT_LOCK_ISACTIVE . '
                            ' . $RELAY_CONTENT . '
                            ' . $RELAY_CHECKSUM . '
                            ' . $RELAY_CONTENT_LOCK . '
                            ' . $RELAY_CONTENT_LOCK_TTL . '
                            ' . $RELAY_CONTENT_LOCK_ISACTIVE . '
                            ' . $REPORTING_CONTENT . '
                            ' . $REPORTING_CHECKSUM . '
                            ' . $REPORTING_CONTENT_LOCK . '
                            ' . $REPORTING_CONTENT_LOCK_TTL . '
                            ' . $REPORTING_CONTENT_LOCK_ISACTIVE . '
                            ' . $WILDCARD_CONTENT . '
                            ' . $WILDCARD_CHECKSUM . '
                            ' . $WILDCARD_CONTENT_LOCK . '
                            ' . $WILDCARD_CONTENT_LOCK_TTL . '
                            ' . $WILDCARD_CONTENT_LOCK_ISACTIVE . '
                            ' . $tmp_CRNRSTN_CACHE_CHECKSUM_TTL_DATA_DATEMODIFIED . '
                            ' . $tmp_CRNRSTN_CACHE_CHECKSUM_TTL_DATA_DATECREATED . '                                      
                             "jony5_lifestyle_banner_checksum" : "8/16/2021 0345 :: Miss you, J5...my boy!"
                             
                        }],
                        "ENVIRONMENTAL_CONFIGURATION" : [
                            {
                            ' . $tmp_CRNRSTN_ENVIRONMENTAL_RESOURCE_CONFIGURATION . '                                      
                             "jony5_lifestyle_banner_checksum" : "8/16/2021 0345 :: Miss you, J5...my boy!"
                             
                        }]
                        
                    }]
             
                }';

                break;

        }

        return $tmp_json_data;

    }

    private function init_ssdtla_session_data_packet(){

        $this->oSESSION_MGR->init_session();

        /*
        CRNRSTN :: ORDER OF OPERATIONS (PREFERENCE) FOR SELECTION OF
        SESSION CHANNEL DATA TUNNEL LAYER ARCHITECTURE
        0 :: D :: DATABASE SESSION TABLE (MySQLi Connection)
        1 :: S :: SSDTL PACKET (SOAP OBJECT)
        2 :: J :: PSSDTL PACKET (JSON OBJECT)
        3 :: P :: $_SERVER SESSION (PHP SESSION ARRAY SUPER GLOBAL)
        4 :: C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)

        DSJPC
        */

        //
        // INITIALIZE CRNRSTN :: SOAP SERVICES DATA TUNNEL LAYER PACKET - DSJPC
        // NOTE: DATABASE DATA STORAGE FORMAT WILL SHADOW USE OF S01 AND P02
        // ON A SESSION TO SESSION BASIS.
        $tmp_pssdtl_session_packet = $this->return_serialized_soap_data_tunnel_session('crnrstn_session_json');

        error_log(__LINE__ . ' env ' . __METHOD__ . ' $tmp_pssdtl_session_packet::[' . $tmp_pssdtl_session_packet . '] die();');

        die();
        //self::$system_database_table_prefix

    }

    private function init_ui_interact_profile(){

        /*

        <theme_configuration>
        <canvas z_index="60" window_edge_padding="20" outline_border_edge_line_width="2" outline_border_edge_line_style="solid" outline_border_edge_line_color="#767676" border_width="10" border_color="#FFF" border_opacity="0.3" background_color="#FFF" background_opacity="1" inner_content_edge_padding="25" checksum="' . $this->hash('60202solid#76767610#FFF0.3#FFF125') . '"></canvas>
        <mini_canvas left="84%" width="100" height="70" checksum="' . $this->hash('10070') . '"></mini_canvas>
        <signin_canvas width="260" height="305" checksum="' . $this->hash('260305') . '"></signin_canvas>
        <main_canvas width="1080" height="760" checksum="' . $this->hash('1080760') . '"></main_canvas>
        <eula_canvas width="700" height="400" checksum="' . $this->hash('700400') . '"></eula_canvas>
        <mit_license_canvas width="500" height="400" checksum="' . $this->hash('500400') . '"></mit_license_canvas>
        </theme_configuration>

        TODO :: NEED TO PASS DYNAMIC ID="crnrstn_xxxx" TO THE oCRNRSTN_USR FOR XML RETURN.
        TODO :: SEE LINE 2196 USER :: return_ui_interact_profile() :: RETURN XML WITH CUSTOM NAV IDS FROM oENV

        oENV LINE 1219 :: return_output_CRNRSTN_UI_INTERACT() OUTPUT BELOW FOR NOTES ON WHAT TO INITIALIZE...:
        <div id="crnrstn_ui_interact_primary_nav_menu" class="crnrstn_ui_interact_primary_navgroup_lnk_border">

            <div id="crnrstn_ui_interact_primary_nav_img_shell_menu_inactive" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_MENU_INACTIVE', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_MENU') . '"></div>
            <div id="crnrstn_ui_interact_primary_nav_img_shell_menu_hvr" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_MENU_HOVER', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_MENU') . '"></div>
            <div id="crnrstn_ui_interact_primary_nav_img_shell_menu_click" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_MENU_CLICK', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_MENU') . '"></div>
            <div id="crnrstn_ui_interact_primary_nav_img_shell_menu" class="crnrstn_ui_interact_primary_nav_img_shell crnrstn_ui_interact_active"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_MENU', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_MENU') . '"></div>
            <div id="crnrstn_ui_interact_primary_nav_img_shell_menu_glass_case" class="crnrstn_ui_interact_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmouseout\', this);" onmousedown="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmousedown\', this);" onmouseup="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmouseup\', this);"><img src="' . $this->return_creative('TRANSPARENT_1X1', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_MENU') . '"></div>

        </div>

        <div id="crnrstn_ui_interact_primary_nav_close_x" class="crnrstn_ui_interact_primary_navgroup_lnk_border">

            <div id="crnrstn_ui_interact_primary_nav_img_shell_close_x_inactive" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_CLOSE_X_INACTIVE', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div>
            <div id="crnrstn_ui_interact_primary_nav_img_shell_close_x_hvr" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_CLOSE_X_HOVER', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div>
            <div id="crnrstn_ui_interact_primary_nav_img_shell_close_x_click" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_CLOSE_X_CLICK', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div>
            <div id="crnrstn_ui_interact_primary_nav_img_shell_close_x" class="crnrstn_ui_interact_primary_nav_img_shell crnrstn_ui_interact_active"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_CLOSE_X', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div>
            <div id="crnrstn_ui_interact_primary_nav_img_shell_close_x_glass_case" class="crnrstn_ui_interact_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmouseout\', this);" onmousedown="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmousedown\', this);" onmouseup="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmouseup\', this);"><img src="' . $this->return_creative('TRANSPARENT_1X1', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div>

        </div>

        <div id="crnrstn_ui_interact_primary_nav_fs_expand" class="crnrstn_ui_interact_primary_navgroup_lnk_border">

            <div id="crnrstn_ui_interact_primary_nav_img_shell_fs_expand_inactive" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_INACTIVE', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div>
            <div id="crnrstn_ui_interact_primary_nav_img_shell_fs_expand_hvr" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_HOVER', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div>
            <div id="crnrstn_ui_interact_primary_nav_img_shell_fs_expand_click" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_CLICK', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div>
            <div id="crnrstn_ui_interact_primary_nav_img_shell_fs_expand" class="crnrstn_ui_interact_primary_nav_img_shell crnrstn_ui_interact_active"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div>
            <div id="crnrstn_ui_interact_primary_nav_img_shell_fs_expand_glass_case" class="crnrstn_ui_interact_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmouseout\', this);" onmousedown="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmousedown\', this);" onmouseup="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmouseup\', this);"><img src="' . $this->return_creative('TRANSPARENT_1X1', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div>

        </div>

        <div id="crnrstn_ui_interact_primary_nav_minimize" class="crnrstn_ui_interact_primary_navgroup_lnk_border">

            <div id="crnrstn_ui_interact_primary_nav_img_shell_minimize_inactive" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE_INACTIVE', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_MINIMIZE') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_MINIMIZE') . '"></div>
            <div id="crnrstn_ui_interact_primary_nav_img_shell_minimize_hvr" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE_HOVER', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_MINIMIZE') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_MINIMIZE') . '"></div>
            <div id="crnrstn_ui_interact_primary_nav_img_shell_minimize_click" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE_CLICK', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_MINIMIZE') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_MINIMIZE') . '"></div>
            <div id="crnrstn_ui_interact_primary_nav_img_shell_minimize" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_MINIMIZE') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_MINIMIZE') . '"></div>
            <div id="crnrstn_ui_interact_primary_nav_img_shell_minimize_fivedev_sm" class="crnrstn_ui_interact_primary_nav_img_shell crnrstn_ui_interact_active"><img src="' . $this->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV_SMALL', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_FIVEDEV') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_FIVEDEV') . '"></div>
            <div id="crnrstn_ui_interact_primary_nav_img_shell_minimize_glass_case" class="crnrstn_ui_interact_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmouseout\', this);" onmousedown="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmousedown\', this);" onmouseup="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmouseup\', this);"><img src="' . $this->return_creative('TRANSPARENT_1X1', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->get_lang_copy('UI_PRIMARY_NAV_ALT_FIVEDEV') . '" title="' . $this->get_lang_copy('UI_PRIMARY_NAV_TITLE_FIVEDEV') . '"></div>

        </div>


        */

    }

    private function init_engagement_config($oCRNRSTN){

        if(!!$oCRNRSTN->engagement_config_file_path_ARRAY[$this->config_serial_hash][$oCRNRSTN->hash(CRNRSTN_RESOURCE_ALL)]){

            foreach($oCRNRSTN->engagement_config_file_path_ARRAY[$this->config_serial_hash][$oCRNRSTN->hash(CRNRSTN_RESOURCE_ALL)] as $key => $engagement_config_file_path){

                if(is_file($engagement_config_file_path)){

                    $oWildCardResource_ARRAY = array();

                    //
                    // EXTRACT ACCESS-BY-IP AUTHORIZATION PROFILE FROM FILE
                    $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('We have a file to include and process for the initialization of engagement tag profiles from the CRNRSTN :: configuration file [' . $oCRNRSTN->engagement_config_file_path_ARRAY[$this->config_serial_hash][$oCRNRSTN->hash(CRNRSTN_RESOURCE_ALL)][$key] . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                    include_once($engagement_config_file_path);

                    $this->oWildCardResource_ARRAY[$this->config_serial_hash][CRNRSTN_LOG_ALL][] = $oWildCardResource_ARRAY;

                }else{

                    error_log(__LINE__ . ' env NOT AN ENGAGEMENT TRACKING CONFIG FILE [' . $engagement_config_file_path . ']');

                }

            }

        }else{

            if(!!$oCRNRSTN->engagement_config_file_path_ARRAY[$this->config_serial_hash][$this->env_key_hash]){

                foreach($oCRNRSTN->engagement_config_file_path_ARRAY[$this->config_serial_hash][$this->env_key_hash] as $key => $engagement_config_file_path){

                    if(is_file($engagement_config_file_path)){

                        $oWildCardResource_ARRAY = array();

                        //
                        // EXTRACT ACCESS-BY-IP AUTHORIZATION PROFILE FROM FILE
                        $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('We have a file to include and process for the initialization of engagement tag profiles from the CRNRSTN :: configuration file [' . $oCRNRSTN->engagement_config_file_path_ARRAY[$this->config_serial_hash][$this->env_key_hash][$key] . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                        include_once($engagement_config_file_path);

                        $this->oWildCardResource_ARRAY[$this->config_serial_hash][CRNRSTN_LOG_ALL][] = $oWildCardResource_ARRAY;

                    }else{

                        error_log(__LINE__ . ' env NOT AN ENGAGEMENT TRACKING CONFIG FILE [' . $engagement_config_file_path . ']');

                    }

                }

            }else{

                error_log(__LINE__ . ' env NO ENGAGEMENT TRACKING CONFIGURED.');

            }

        }

    }

    private function __initSOAPAuthorizationProfiles(){

        if(!!$this->soap_permissions_file_path_ARRAY[$this->config_serial_hash][$this->hash(CRNRSTN_RESOURCE_ALL)]){

            foreach($this->soap_permissions_file_path_ARRAY[$this->config_serial_hash][$this->hash(CRNRSTN_RESOURCE_ALL)] as $key => $soap_config_file_path){

                if(is_file($soap_config_file_path)){

                    //
                    // EXTRACT ACCESS-BY-IP AUTHORIZATION PROFILE FROM FILE
                    $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('We have a file to include and process for the initialization of endpoint profiles authorized to connect to the CRNRSTN :: SOAP Services layer [' . $this->soap_permissions_file_path_ARRAY[$this->config_serial_hash][$this->hash(CRNRSTN_RESOURCE_ALL)][$key] . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
                    //include_once($this->soap_permissions_file_path_ARRAY[$this->hash($this->config_serial_hash)][$this->env_key_hash][$key]);
                    include_once($soap_config_file_path);

                }else{

                    error_log(__LINE__ . ' env NOT A SOAP AUTH CONFIG FILE [' . $soap_config_file_path . ']');

                }

            }

        }else{

            if(!!$this->soap_permissions_file_path_ARRAY[$this->config_serial_hash][$this->env_key_hash]){

                foreach($this->soap_permissions_file_path_ARRAY[$this->config_serial_hash][$this->env_key_hash] as $key => $soap_config_file_path){

                    if(is_file($soap_config_file_path)){

                        //
                        // EXTRACT ACCESS-BY-IP AUTHORIZATION PROFILE FROM FILE
                        $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('We have a file to include and process for the initialization of endpoint profiles authorized to connect to the CRNRSTN :: SOAP Services layer [' . $this->soap_permissions_file_path_ARRAY[$this->config_serial_hash][$this->env_key_hash][$key] . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
                        //include_once($this->soap_permissions_file_path_ARRAY[$this->config_serial_hash][$this->env_key_hash][$key]);
                        include_once($soap_config_file_path);

                    }else{

                        error_log(__LINE__ . ' env NOT A SOAP AUTH CONFIG FILE [' . $soap_config_file_path . ']');

                    }

                }

            }else{

                error_log(__LINE__ . ' env NO SOAP AUTH CONFIG.');

            }

        }

    }

    public function update_SOAP_services_oAuth($SOAP_oAuth){

        $this->oSOAP_services_oAuth_manager[$SOAP_oAuth->serial] = $SOAP_oAuth;

        return true;

    }

    public function update_SOAP_services_oClient($SOAP_oClient){

        $this->oSOAP_services_oClient_manager[$SOAP_oClient->serial] = $SOAP_oClient;

        return true;

    }

    public function update_SOAP_services_oAuth_update_permissions($origin_oAuth_serial, $services_authorization_group_key, $integer_constant){

        $tmp_array = array();

        foreach($this->oSOAP_services_oAuth_manager as $serial => $SOAP_oAuth){

            if($SOAP_oAuth->services_authorization_group_key == $services_authorization_group_key){

                if($serial != $origin_oAuth_serial){

                    $tmp_bit_state_nomination = 'CRNRSTN_SOAP_AUTH_MGR_' . $serial;
                    $this->oCRNRSTN_USR->oCRNRSTN_BITFLIP_MGR->initialize_serialized_bit($tmp_bit_state_nomination, $integer_constant);

                    $SOAP_oAuth->sync_update_permissions($integer_constant);

                }

            }

            $tmp_array[$serial] = $SOAP_oAuth;

        }

        $this->oSOAP_services_oAuth_manager = $tmp_array;

    }

    public function update_SOAP_services_oClient_update_permissions($origin_oClient_serial, $services_client_group_key, $integer_constant){

        $tmp_array = array();

        foreach($this->oSOAP_services_oClient_manager as $serial => $SOAP_oClient){

            if($SOAP_oClient->services_client_group_key == $services_client_group_key){

                if($serial != $origin_oClient_serial){

                    $tmp_bit_state_nomination = 'CRNRSTN_SOAP_CLIENT_MGR_' . $serial;
                    $this->oCRNRSTN_USR->oCRNRSTN_BITFLIP_MGR->initialize_serialized_bit($tmp_bit_state_nomination, $integer_constant);

                    $SOAP_oClient->sync_update_permissions($integer_constant);

                }

            }

            $tmp_array[$serial] = $SOAP_oClient;

        }

        $this->oSOAP_services_oClient_manager = $tmp_array;

    }

    public function update_SOAP_services_oAuth_soap_encryption_config($origin_oAuth_serial, $services_authorization_group_key, $encryptCipher, $encryptSecretKey, $hmac_alg, $encryptOptions){

        $tmp_array = array();
        $encryptSecretKey = $this->hash($encryptSecretKey, 'md5');

        foreach($this->oSOAP_services_oAuth_manager as $serial => $SOAP_oAuth) {

            if($SOAP_oAuth->services_authorization_group_key == $services_authorization_group_key) {

                if($serial != $origin_oAuth_serial){

                    $SOAP_oAuth->sync_soap_encryption_config($encryptCipher, $encryptSecretKey, $hmac_alg, $encryptOptions);

                }

            }

            $tmp_array[$serial] = $SOAP_oAuth;

        }

        $this->oSOAP_services_oAuth_manager = $tmp_array;

    }

    public function update_SOAP_services_oClient_soap_encryption_config($origin_oClient_serial, $services_client_group_key, $encryptCipher, $encryptSecretKey, $hmac_alg, $encryptOptions){

        $tmp_array = array();

        $encryptSecretKey = $this->hash($encryptSecretKey, 'md5');

        foreach($this->oSOAP_services_oClient_manager as $serial => $SOAP_oClient) {

            if($SOAP_oClient->services_client_group_key == $services_client_group_key) {

                if($serial != $origin_oClient_serial){

                    $SOAP_oClient->sync_soap_encryption_config($encryptCipher, $encryptSecretKey, $hmac_alg, $encryptOptions);

                }

            }

            $tmp_array[$serial] = $SOAP_oClient;

        }

        $this->oSOAP_services_oClient_manager = $tmp_array;

    }

    public function update_SOAP_services_oClient_activate_SOAP_method($origin_oAuth_serial, $services_client_group_key, $soap_services_method_activate_ARRAY, $soap_services_method_deactivate_ARRAY){

        $tmp_array = array();

        foreach($this->oSOAP_services_oClient_manager as $serial => $SOAP_oClient) {

            if($SOAP_oClient->services_client_group_key == $services_client_group_key) {

                if($serial != $origin_oAuth_serial){

                    $SOAP_oClient->sync_activate_SOAP_method($soap_services_method_activate_ARRAY, $soap_services_method_deactivate_ARRAY);
                    $SOAP_oClient->sync_deactivate_SOAP_method($soap_services_method_deactivate_ARRAY);

                }

            }

            $tmp_array[$serial] = $SOAP_oClient;

        }

        $this->oSOAP_services_oClient_manager = $tmp_array;

    }

    public function update_SOAP_services_oClient_deactivate_SOAP_method($origin_oAuth_serial, $services_client_group_key, $soap_services_method_deactivate_ARRAY){

        $tmp_array = array();

        foreach($this->oSOAP_services_oClient_manager as $serial => $SOAP_oClient) {

            if($SOAP_oClient->services_client_group_key == $services_client_group_key) {

                if($serial != $origin_oAuth_serial){

                    $SOAP_oClient->sync_deactivate_SOAP_method($soap_services_method_deactivate_ARRAY);

                }

            }

            $tmp_array[$serial] = $SOAP_oClient;

        }

        $this->oSOAP_services_oClient_manager = $tmp_array;

    }

    public function update_SOAP_services_oAuth_IP_denyAccess($origin_oAuth_serial, $services_authorization_group_key, $ip_auth_denial_ARRAY){

        $tmp_array = array();

        foreach($this->oSOAP_services_oAuth_manager as $serial => $SOAP_oAuth) {

            if($SOAP_oAuth->services_authorization_group_key == $services_authorization_group_key) {

                if($SOAP_oAuth->serial != $origin_oAuth_serial){

                    $SOAP_oAuth->sync_IP_denyAccess($ip_auth_denial_ARRAY);

                }

            }

            $tmp_array[$serial] = $SOAP_oAuth;

        }

        $this->oSOAP_services_oAuth_manager = $tmp_array;

    }

    public function update_SOAP_services_oClient_IP_denyAccess($origin_oClient_serial, $services_client_group_key, $ip){

        $tmp_array = array();

        foreach($this->oSOAP_services_oClient_manager as $serial => $SOAP_oClient) {

            if ($SOAP_oClient->services_client_group_key == $services_client_group_key) {

                if($SOAP_oClient->serial != $origin_oClient_serial) {

                    $SOAP_oClient->sync_IP_denyAccess($ip);
                }

            }

            $tmp_array[$serial] = $SOAP_oClient;

        }

        $this->oSOAP_services_oClient_manager = $tmp_array;

    }

    public function update_SOAP_services_oAuth_IP_exclusiveAccess($origin_oAuth_serial, $services_authorization_group_key, $ip){

        $tmp_array = array();

        foreach($this->oSOAP_services_oAuth_manager as $serial => $SOAP_oAuth) {

            if($SOAP_oAuth->services_authorization_group_key == $services_authorization_group_key) {

                if($serial != $origin_oAuth_serial){

                    $SOAP_oAuth->sync_IP_exclusiveAccess($ip);

                }

            }

            $tmp_array[$serial] = $SOAP_oAuth;

        }

        $this->oSOAP_services_oAuth_manager = $tmp_array;

    }

    public function update_SOAP_services_oClient_IP_exclusiveAccess($origin_oClient_serial, $services_client_group_key, $ip){

        $tmp_array = array();

        foreach($this->oSOAP_services_oClient_manager as $serial => $SOAP_oClient) {

            if($SOAP_oClient->services_client_group_key == $services_client_group_key) {

                if($serial != $origin_oClient_serial) {

                    $SOAP_oClient->sync_IP_exclusiveAccess($ip);

                }

            }

            $tmp_array[$serial] = $SOAP_oClient;

        }

        $this->oSOAP_services_oClient_manager = $tmp_array;

    }

    public function update_SOAP_services_access_manager($oSOAP_svc_mgr){

        $this->oSOAP_services_access_manager[$oSOAP_svc_mgr->serial] = $oSOAP_svc_mgr;

        return true;

    }

    public function return_SOAP_SVC_debugMode(){

        foreach($this->oSOAP_services_access_manager as $serial => $oSOAP_svc_mgr){

            //error_log(__LINE__ . ' env - [' . $serial . '][' . is_object($oSOAP_svc_mgr) . '][' . $oSOAP_svc_mgr->CRNRSTN_NUSOAP_SVC_debugMode . ']');
            return $oSOAP_svc_mgr->CRNRSTN_NUSOAP_SVC_debugMode;

        }

    }

    public function isAuthorized_SOAP_request($CRNRSTN_SOAP_SVC_AUTH_KEY, $USERNAME, $PASSWORD, $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES, $CRNRSTN_SOAP_SVC_METHOD_REQUESTED, $CRNRSTN_SOAP_ACTION_TYPE){

        //$AUTHORIZATION_GRANTED = false;
        $AUTHORIZATION_GRANTED_oAUTH = false;
        $AUTHORIZATION_GRANTED_oCLIENT = false;

        foreach($this->oSOAP_services_access_manager as $serial => $oSOAP_svc_mgr){

            error_log(__LINE__ . ' env - RUN isAuthorized_oAuth()...');
            if($oSOAP_svc_mgr->isAuthorized_oAuth($CRNRSTN_SOAP_SVC_AUTH_KEY, $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES)){

                $AUTHORIZATION_GRANTED_oAUTH = true;

            }

            error_log(__LINE__ . ' env - RUN isAuthorized_oClient()...');
            if($oSOAP_svc_mgr->isAuthorized_oClient($USERNAME, $PASSWORD, $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES, $CRNRSTN_SOAP_SVC_METHOD_REQUESTED, $CRNRSTN_SOAP_ACTION_TYPE)){

                $AUTHORIZATION_GRANTED_oCLIENT = true;

            }

        }

        if($AUTHORIZATION_GRANTED_oAUTH && $AUTHORIZATION_GRANTED_oCLIENT){

            error_log(__LINE__ . ' SERVER (env) - proxy login successful.');
            return true;

        }else{

            error_log(__LINE__ . ' SERVER (env) - proxy login denied.');
            return false;

        }

    }

    private function initEnvLoggingProfile($oCRNRSTN){

        //
        // DETECTED RESOURCE KEY
        if(isset($this->env_key_hash)){

            //
            // CLEAR OUT BITS FOR NEW LOGGING PROFILE DATA
            foreach($this->system_resource_constants as $key => $integer_constant){

                //
                // LET'S TRY THIS. OTHERWISE WE HAVE TO READ() AND THEN TOGGLE() IF TRUE.
                $this->initialize_bit($integer_constant, false);

            }

            //
            // RETRIEVE LOGGING PROFILE DATA FROM CRNRSTN ::
            self::$sys_logging_profile_ARRAY = $oCRNRSTN->return_logging_profile($this->env_key_hash);
            self::$sys_logging_meta_ARRAY = $oCRNRSTN->return_logging_meta($this->env_key_hash);

            //
            // PROCESS BITWISE DATA FOR LOGGING PROFILE
            foreach(self::$sys_logging_profile_ARRAY as $key => $int_const_profile){

                //error_log(__LINE__ . ' env init bit const (int) ' . $int_const_profile . '.');
                $this->initialize_bit($int_const_profile, true);

            }

            //
            // NOW THAT WE HAVE LOGGING PROFILE DATA...SYNC LOGGING PROFILE MANAGER
            self::$oLog_ProfileManager->sync_to_environment($oCRNRSTN, $this);

            $this->oLogger->sync_olog_profile_manager(self::$oLog_ProfileManager);

        }

    }
    
    private function initRuntimeConfig(){

        //$this->oSESSION_MGR->oCRNRSTN_SESSION_DDO->add($this->env_key_hash,'CRNRSTN_' . $this->config_serial_hash . 'CRNRSTN_ENV_KEY_CRC');

        //
        // INITIALIZE CONFIG AND ENV KEYS.
        #$_SESSION['CRNRSTN_CONFIG_SERIAL_HASH'] = $this->config_serial_hash;  # MOVED TO CRNRSTN __construct() @ ~line 105
        //$_SESSION['CRNRSTN_' . $this->config_serial_hash]['CRNRSTN_ENV_KEY_CRC'] = $this->env_key_hash;
        $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('Initialize session[' . session_id() . '] with CRNRSTN :: config_serial_hash [' . $this->config_serial_hash . '] and environmental resource key [' . $this->env_key_hash . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        
    }
    
    private function initializeErrorReporting($oCRNRSTN){

        $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('Initialize server error_reporting() to [' . $oCRNRSTN->env_err_reporting_profile_ARRAY[$this->config_serial_hash][$this->env_key_hash] . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        error_reporting((int) $oCRNRSTN->env_err_reporting_profile_ARRAY[$this->config_serial_hash][$this->env_key_hash]);

    }

    private function initExclusiveAccess($oCRNRSTN){
        
        //
        // PROCESS IP ADDRESS ACCESS AND RESTRICTION FOR SELECTED ENVIRONMENT
        if(is_file($oCRNRSTN->grant_accessIP_ARRAY[$this->config_serial_hash][$this->env_key_hash])){
            
            //
            // EXTRACT ACCESS-BY-IP AUTHORIZATION PROFILE FROM FILE
            $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('We have a file to include and process for exclusive access IP restrictions at [' . $oCRNRSTN->grant_accessIP_ARRAY[$this->config_serial_hash][$this->env_key_hash] . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
            include_once($oCRNRSTN->grant_accessIP_ARRAY[$this->config_serial_hash][$this->env_key_hash]);
            
        }else{
            
            //
            // DO WE HAVE ANY IP DATA TO PROCESS
            if($oCRNRSTN->grant_accessIP_ARRAY[$this->config_serial_hash][$this->env_key_hash] != ''){

                $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('Process grant exclusive access IP[' . $oCRNRSTN->grant_accessIP_ARRAY[$this->config_serial_hash][$this->env_key_hash] . '] for this connection.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
                $this->oCRNRSTN_IPSECURITY_MGR->grantAccessWKey($this->env_key_hash, $oCRNRSTN->grant_accessIP_ARRAY[$this->config_serial_hash][$this->env_key_hash]);

            }else{

                //
                // NO IP ADDRESSES PROVIDED. NOTHING TO DO HERE.
            }

        }

    }
    
    private function initDenyAccess($oCRNRSTN){

        if(is_file($oCRNRSTN->deny_accessIP_ARRAY[$this->config_serial_hash][$this->env_key_hash])){
            
            //
            // EXTRACT ACCESS-BY-IP AUTHORIZATION PROFILE FROM FILE
            $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('We have a file to include and process for deny access IP restrictions at [' . $oCRNRSTN->deny_accessIP_ARRAY[$this->config_serial_hash][$this->env_key_hash] . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
            include_once($oCRNRSTN->deny_accessIP_ARRAY[$this->config_serial_hash][$this->env_key_hash]);
                
        }else{

            if($oCRNRSTN->deny_accessIP_ARRAY[$this->config_serial_hash][$this->env_key_hash] != ""){

                $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('Process deny access IP[' . $oCRNRSTN->deny_accessIP_ARRAY[$this->config_serial_hash][$this->env_key_hash] . '] for this connection.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
                $this->oCRNRSTN_IPSECURITY_MGR->denyAccessWKey($this->env_key_hash, $oCRNRSTN->deny_accessIP_ARRAY[$this->config_serial_hash][$this->env_key_hash]);

            }else{
                
                //
                // NO IP ADDRESSES PROVIDED. NOTHING TO DO HERE.
            }

        }

    }

    private function initAdminAccess($oCRNRSTN){

        $tmp_cnt = sizeof($oCRNRSTN->add_admin_creds_ARRAY[$this->config_serial_hash][$this->env_key_hash]['email']);

        for($i = 0; $i < $tmp_cnt; $i++){

            $tmp_email = $oCRNRSTN->add_admin_creds_ARRAY[$this->config_serial_hash][$this->env_key_hash]['email'][$i];
            $tmp_pwdhash = $oCRNRSTN->add_admin_creds_ARRAY[$this->config_serial_hash][$this->env_key_hash]['pwdhash'][$i];
            $tmp_ttl = $oCRNRSTN->add_admin_creds_ARRAY[$this->config_serial_hash][$this->env_key_hash]['ttl'][$i];

            if(isset($oCRNRSTN->add_admin_creds_ARRAY[$this->config_serial_hash][$this->env_key_hash]['max_login_attempts'][$i])){

                $this->max_login_attempts = $oCRNRSTN->add_admin_creds_ARRAY[$this->config_serial_hash][$this->env_key_hash]['max_login_attempts'][$i];

            }else{

                $this->max_login_attempts = 10;

            }

            if(isset($oCRNRSTN->add_admin_creds_ARRAY[$this->config_serial_hash][$this->env_key_hash]['seconds_inactive'][$i])){

                $this->max_seconds_inactive = $oCRNRSTN->add_admin_creds_ARRAY[$this->config_serial_hash][$this->env_key_hash]['seconds_inactive'][$i];

            }else{

                $this->max_seconds_inactive = 900;

            }

            $this->add_administrative_account($tmp_email, $tmp_pwdhash, $tmp_ttl);

        }

        return true;

    }

    private function add_administrative_account($email, $pwdhash, $ttl){

        $tmp_oAdmin = new crnrstn_administrative_account($this, $email, $pwdhash, $ttl, $this->max_login_attempts, $this->max_seconds_inactive);
        $tmp_serial = $tmp_oAdmin->account_get_resource('serial');
        $this->oAdminAccount_ARRAY[$tmp_serial] = $tmp_oAdmin;

        return true;

    }

    public function return_max_login_attempts(){

        return $this->max_login_attempts;

    }

    public function return_max_seconds_inactive(){

        return $this->max_seconds_inactive;

    }

    public function return_login_attempts(){

        return 0;

    }
    
    public function return_env_key_hash(){
        
        //
        // RETURN RESOURCE KEY FOR DETECTED ENVIRONMENT
        return $this->env_key_hash;

    }

    public function hash($data, $algorithm = NULL){

        return $this->oCRNRSTN->hash($data, $algorithm);

    }

    public function isset_encryption($encryption_channel){

        return $this->oCRNRSTN->oCRNRSTN_BITFLIP_MGR->is_bit_set($encryption_channel);

    }

    private function return_data_encrypted($data, $encryption_channel, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override){

        try{

            $this->total_bytes_encrypted += strlen($data);

            switch($encryption_channel){
                case CRNRSTN_ENCRYPT_TUNNEL:

                    $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::TUNNEL_ENCRYPTION';

                break;
                case CRNRSTN_ENCRYPT_DATABASE:

                    $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::DATABASE_ENCRYPTION';

                break;
                case CRNRSTN_ENCRYPT_SESSION:

                    $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::SESSION_ENCRYPTION';

                break;
                case CRNRSTN_ENCRYPT_COOKIE:

                    $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::COOKIE_ENCRYPTION';

                break;
                case CRNRSTN_ENCRYPT_SOAP:

                    $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::SOAP_ENCRYPTION';

                break;
                case CRNRSTN_ENCRYPT_OERSL:

                    $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::OERSL_ENCRYPTION';

                break;
                default:
                    //
                    // CRNRSTN_ENCRYPT_TUNNEL

                    //
                    // RETRIEVE DATA
                    // self::$oCRNRSTN_CONFIG_MGR->input_data_value($encrypt_cipher, 'encrypt_cipher','CRNRSTN_SYSTEM_CHANNEL::TUNNEL_ENCRYPTION',NULL,CRNRSTN_AUTHORIZE_RUNTIME_ONLY, $env_key);
                    $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::TUNNEL_ENCRYPTION';
                    $this->error_log('Unknown encryption channel constant provided to ' . __METHOD__ .'. Tunnel encryption profile has been applied.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                break;

            }

            $tmp_encrypt_cipher = $this->oCRNRSTN->get_resource('encrypt_cipher', 0, $data_type_family);
            $tmp_encrypt_secret_key = $this->oCRNRSTN->get_resource('encrypt_secret_key', 0, $data_type_family);
            $tmp_encrypt_options = $this->oCRNRSTN->get_resource('encrypt_options', 0, $data_type_family);
            $tmp_hmac_alg = $this->oCRNRSTN->get_resource('hmac_alg', 0, $data_type_family);

            if(isset($cipher_override) || strlen($tmp_encrypt_cipher) > 0){

                if(!isset($secret_key_override)){

                    //error_log('2902 tunnelParamEncrypt - secret_key from session...');
                    $secret_key = $tmp_encrypt_secret_key;

                }else{

                    $secret_key = $secret_key_override;
                    $secret_key = openssl_digest($secret_key, self::$openssl_digest_profile, true);

                }

                //
                // ENABLE CIPHER OVERRIDE :: v2.0.0
                if(!isset($cipher_override)){

                    //error_log('2916 tunnelParamEncrypt - cipher from session...');
                    $encrypt_cipher = $tmp_encrypt_cipher;

                }else{

                    $encrypt_cipher = $cipher_override;

                }

                //
                // ENABLE OPTIONS BITWISE OVERRIDE :: v2.0.0
                if(!isset($options_bitwise_override)){

                    //error_log('2942 tunnelParamEncrypt - bitwise from session...');
                    $options_bitwise = $tmp_encrypt_options;

                }else{

                    $options_bitwise = $options_bitwise_override;

                }

                //
                // ENABLE HMAC ALG OVERRIDE :: v2.0.0
                if(!isset($hmac_algorithm_override)){

                    //error_log('2929 tunnelParamEncrypt - hmac from session...');
                    $hmac_algorithm = $tmp_hmac_alg;

                }else{

                    $hmac_algorithm = $hmac_algorithm_override;

                }


                #
                # Source: http://php.net/manual/en/function.openssl-encrypt.php
                #
                $ivlen = openssl_cipher_iv_length($cipher = $encrypt_cipher);
                $iv = openssl_random_pseudo_bytes($ivlen);
                $ciphertext_raw = openssl_encrypt($data, $encrypt_cipher, $secret_key, $options = $options_bitwise, $iv);
                $hmac = hash_hmac($hmac_algorithm, $ciphertext_raw, $secret_key, $as_binary = true);
                $ciphertext = base64_encode($iv . $hmac . $ciphertext_raw);

                //$this->oCRNRSTN->print_r('$ciphertext=[' . strlen($ciphertext) . '] $cipher=[' . $encrypt_cipher . '] $secret_key=[' . $secret_key . '] $options_bitwise=[' . $options_bitwise . '] $hmac_algorithm=[' . $hmac_algorithm . '] $data_len=[' . strlen($data) . '].', 'OpenSSL Integrations Testing',CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

                return $ciphertext;

            }else{

                //
                // DETERMINE WHO ALL IS MISSING DATA
                if(!isset($secret_key_override)){

                    $secret_key = $tmp_encrypt_secret_key;

                }else{

                    $secret_key = $secret_key_override;
                    $secret_key = openssl_digest($secret_key, self::$openssl_digest_profile, true);

                }

                if(!isset($cipher_override)){

                    $cipher = $tmp_encrypt_cipher;

                }else{

                    $cipher = $cipher_override;

                }

                if(!isset($hmac_algorithm_override)){

                    $hmac_algorithm = $tmp_hmac_alg;

                }else{

                    $hmac_algorithm = $hmac_algorithm_override;

                }

                $tmp_stripe_key_ARRAY = $this->return_stripe_key_ARRAY('$secret_key', '$cipher', '$hmac_algorithm');
                $tmp_param_err_str_ARRAY = $this->return_regression_stripe_ARRAY('MISSING_STRING_DATA', $tmp_stripe_key_ARRAY, $secret_key, $cipher, $hmac_algorithm);

                $tmp_param_missing_str = $tmp_param_err_str_ARRAY['string'];
                $this->error_log('Encryption of data aborted due missing of parameters. ' . $tmp_param_missing_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                return $data;

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return NULL;

        }

    }

    private function return_data_decrypted($data, $encryption_channel, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override){

        try{

            switch($encryption_channel){
                case CRNRSTN_ENCRYPT_TUNNEL:

                    $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::TUNNEL_ENCRYPTION';

                break;
                case CRNRSTN_ENCRYPT_DATABASE:

                    $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::DATABASE_ENCRYPTION';

                break;
                case CRNRSTN_ENCRYPT_SESSION:

                    $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::SESSION_ENCRYPTION';

                break;
                case CRNRSTN_ENCRYPT_COOKIE:

                    $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::COOKIE_ENCRYPTION';

                break;
                case CRNRSTN_ENCRYPT_SOAP:

                    $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::SOAP_ENCRYPTION';

                break;
                case CRNRSTN_ENCRYPT_OERSL:

                    $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::OERSL_ENCRYPTION';

                break;
                default:
                    //
                    // CRNRSTN_ENCRYPT_TUNNEL

                    //
                    // RETRIEVE DATA
                    // self::$oCRNRSTN_CONFIG_MGR->input_data_value($encrypt_cipher, 'encrypt_cipher','CRNRSTN_SYSTEM_CHANNEL::TUNNEL_ENCRYPTION',NULL,CRNRSTN_AUTHORIZE_RUNTIME_ONLY, $env_key);
                    $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::TUNNEL_ENCRYPTION';
                    $this->error_log('Unknown decryption channel constant provided to ' . __METHOD__ .'. Tunnel encryption profile has been applied.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                break;

            }

            $tmp_encrypt_cipher = $this->oCRNRSTN->get_resource('encrypt_cipher', 0, $data_type_family);
            $tmp_encrypt_secret_key = $this->oCRNRSTN->get_resource('encrypt_secret_key', 0, $data_type_family);
            $tmp_encrypt_options = $this->oCRNRSTN->get_resource('encrypt_options', 0, $data_type_family);
            $tmp_hmac_alg = $this->oCRNRSTN->get_resource('hmac_alg', 0, $data_type_family);

            if(isset($cipher_override) || strlen($tmp_encrypt_cipher) > 0){

                //
                // ENABLE CIPHER OVERRIDE :: v2.0.0
                if(!isset($cipher_override)){

                    $encrypt_cipher = $tmp_encrypt_cipher;

                }else{

                    $encrypt_cipher = $cipher_override;

                }

                if(!isset($secret_key_override)){

                    $secret_key = $tmp_encrypt_secret_key;

                }else{

                    $secret_key = $secret_key_override;
                    $secret_key = openssl_digest($secret_key, self::$openssl_digest_profile, true);

                }

                //
                // ENABLE OPTIONS BITWISE OVERRIDE :: v2.0.0
                if(!isset($options_bitwise_override)){

                    $options_bitwise = $tmp_encrypt_options;

                }else{

                    $options_bitwise = $options_bitwise_override;

                }

                //
                // ENABLE HMAC ALG OVERRIDE :: v2.0.0
                if(!isset($hmac_algorithm_override)){

                    $hmac_alg = $tmp_hmac_alg;

                }else{

                    $hmac_alg = $hmac_algorithm_override;

                }

                //$this->oCRNRSTN->print_r('$cipher=[' . $encrypt_cipher . '] $secret_key=[' . $secret_key . '] $options_bitwise=[' . $options_bitwise . '] $hmac_algorithm=[' . $hmac_alg . '] $data_len=[' . strlen($data) . '].', 'OpenSSL Integrations Testing',CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

                #
                # Source: http://php.net/manual/en/function.openssl-encrypt.php
                #
                $c = base64_decode($data);
                $ivlen = openssl_cipher_iv_length($cipher = $encrypt_cipher);
                $iv = substr($c, 0, $ivlen);
                $hmac = substr($c, $ivlen, $sha2len = 32);
                $ciphertext_raw = substr($c, $ivlen + $sha2len);
                $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $secret_key, $options = $options_bitwise, $iv);
                $calcmac = hash_hmac($hmac_alg, $ciphertext_raw, $secret_key, $as_binary = true);

                if(hash_equals($hmac, $calcmac))//PHP 5.6+ timing attack safe comparison
                {
                    return $original_plaintext;

                }else{

                    //$this->oCRNRSTN->print_r('die(); $cipher=[' . $encrypt_cipher . '] $secret_key=[' . $secret_key . '] $options_bitwise=[' . $options_bitwise . '] $hmac_algorithm=[' . $hmac_alg . '] $data_len=[' . strlen($data) . '].', 'OpenSSL Integrations Testing',CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

                    //die();

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('CRNRSTN :: Data Decryption Notice :: Oops. Something went wrong. Hash_equals comparison failed during data decryption.');

                }

            }else{

                //
                // DETERMINE WHO ALL IS MISSING DATA
                if(!isset($secret_key_override)){

                    $secret_key = $tmp_encrypt_secret_key;

                }else{

                    $secret_key = $secret_key_override;
                    $secret_key = openssl_digest($secret_key, self::$openssl_digest_profile, true);

                }

                if(!isset($cipher_override)){

                    $cipher = $tmp_encrypt_cipher;

                }else{

                    $cipher = $cipher_override;

                }

                if(!isset($hmac_algorithm_override)){

                    $hmac_algorithm = $tmp_hmac_alg;

                }else{

                    $hmac_algorithm = $hmac_algorithm_override;

                }

                $tmp_stripe_key_ARRAY = $this->return_stripe_key_ARRAY('$secret_key', '$cipher', '$hmac_algorithm');
                $tmp_param_err_str_ARRAY = $this->return_regression_stripe_ARRAY('MISSING_STRING_DATA', $tmp_stripe_key_ARRAY, $secret_key, $cipher, $hmac_algorithm);

                $tmp_param_missing_str = $tmp_param_err_str_ARRAY['string'];
                $this->error_log('Decryption of data aborted due to missing of parameters. ' . $tmp_param_missing_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                die();

                //
                // NO ENCRYPTION. RETURN VAL
                return $data;

            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return NULL;

        }

        return NULL;

    }

    public function data_encrypt($data = NULL, $encryption_channel = CRNRSTN_ENCRYPT_TUNNEL, $cipher_override = NULL, $secret_key_override = NULL, $hmac_algorithm_override = NULL, $options_bitwise_override = NULL){

        /*
        CRNRSTN_ENCRYPT_TUNNEL
        CRNRSTN_ENCRYPT_DATABASE
        CRNRSTN_ENCRYPT_SESSION
        CRNRSTN_ENCRYPT_COOKIE
        CRNRSTN_ENCRYPT_SOAP
        CRNRSTN_ENCRYPT_OERSL
        */

        try{

            if(isset($data)){

                //
                // DATA TYPE MUST BE ENCRYPTABLE...AND SAFE FOR URI
                if(in_array(gettype($data), $this->encryptableDataTypes)){

                    $tmp_encrypt_val = $this->return_data_encrypted($data, $encryption_channel, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);

                    //
                    // MAKE SAFE FOR URI PASSTHROUGH.
                    $tmp_encrypt_val = urlencode($tmp_encrypt_val);

                    return $tmp_encrypt_val;

                }else{

                    //
                    // NOT ENCRYPTABLE
                    return NULL;

                }

            }else{

                //
                // NOT ENCRYPTABLE
                return NULL;

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

        return NULL;

    }

    public function data_decrypt($data = NULL, $encryption_channel = CRNRSTN_ENCRYPT_TUNNEL, $cipher_override = NULL, $secret_key_override = NULL, $hmac_algorithm_override = NULL, $options_bitwise_override = NULL){

        try{

            if(!isset($data) || $data == ''){

                return NULL;

            }else{

                //
                // BACK OUT OF URL ENCODING
                $data = urldecode($data);

                return $this->return_data_decrypted($data, $encryption_channel, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);

            }

        }catch( Exception $e ){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return NULL;

        }

    }

    public function return_encrypt_settings($val, $encryption_channel = CRNRSTN_ENCRYPT_TUNNEL, $cipher_override = NULL, $secret_key_override = NULL, $hmac_algorithm_override = NULL, $options_bitwise_override = NULL){

        $tmp_settings_array = array();
        $tmp_settings_array['raw data length'] = strlen($val);

        switch($encryption_channel){
            case CRNRSTN_ENCRYPT_TUNNEL:

                $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::TUNNEL_ENCRYPTION';

            break;
            case CRNRSTN_ENCRYPT_DATABASE:

                $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::DATABASE_ENCRYPTION';

            break;
            case CRNRSTN_ENCRYPT_SESSION:

                $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::SESSION_ENCRYPTION';

            break;
            case CRNRSTN_ENCRYPT_COOKIE:

                $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::COOKIE_ENCRYPTION';

            break;
            case CRNRSTN_ENCRYPT_SOAP:

                $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::SOAP_ENCRYPTION';

                break;
            case CRNRSTN_ENCRYPT_OERSL:

                $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::OERSL_ENCRYPTION';

            break;
            default:
                //
                // CRNRSTN_ENCRYPT_TUNNEL

                //
                // RETRIEVE DATA
                // self::$oCRNRSTN_CONFIG_MGR->input_data_value($encrypt_cipher, 'encrypt_cipher','CRNRSTN_SYSTEM_CHANNEL::TUNNEL_ENCRYPTION',NULL,CRNRSTN_AUTHORIZE_RUNTIME_ONLY, $env_key);
                $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::TUNNEL_ENCRYPTION';
                $this->error_log('Unknown encryption channel constant provided to ' . __METHOD__ .'. Tunnel encryption profile has been applied.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

            break;

        }

        $tmp_encrypt_cipher = $this->oCRNRSTN->get_resource('encrypt_cipher', 0, $data_type_family);

        if(isset($cipher_override) || $tmp_encrypt_cipher != ''){

            //
            // RETRIEVE DATA FROM SESSION DDO

            $tmp_encrypt_secret_key = $this->oCRNRSTN->get_resource('encrypt_secret_key', 0, $data_type_family);
            $tmp_encrypt_options = $this->oCRNRSTN->get_resource('encrypt_options', 0, $data_type_family);
            $tmp_hmac_alg = $this->oCRNRSTN->get_resource('hmac_alg', 0, $data_type_family);

            //
            // ENABLE CIPHER OVERRIDE :: v2.0.0
            if(!isset($cipher_override)){

                //error_log('2757 tunnelParamEncrypt - cipher from session...');
                $cipher = $tmp_encrypt_cipher;

            }else{

                $cipher = $cipher_override;

            }

            $tmp_settings_array['cipher'] = $cipher;

            if(!isset($secret_key_override)){

                //error_log('2741 tunnelParamEncrypt - secret_key from session...');
                $secret_key = $tmp_encrypt_secret_key;

            }else{

                $secret_key = $secret_key_override;
                $secret_key = openssl_digest($secret_key, self::$openssl_digest_profile, true);

            }

            $tmp_settings_array['secret_key'] = $secret_key;

            //
            // ENABLE OPTIONS BITWISE OVERRIDE :: v2.0.0
            if(!isset($options_bitwise_override)){

                //error_log('2787 tunnelParamEncrypt - bitwise from session...');
                $options_bitwise = $tmp_encrypt_options;

            }else{

                $options_bitwise = $options_bitwise_override;

            }

            $tmp_settings_array['options_bitwise'] = $options_bitwise;

            //
            // ENABLE HMAC ALG OVERRIDE :: v2.0.0
            if(!isset($hmac_algorithm_override)){

                //error_log('2772 tunnelParamEncrypt - hmac from session...');
                $hmac_algorithm = $tmp_hmac_alg;

            }else{

                $hmac_algorithm = $hmac_algorithm_override;

            }

            $tmp_settings_array['hmac_algorithm'] = $hmac_algorithm;

            #
            # Source: http://php.net/manual/en/function.openssl-encrypt.php
            #
            $ivlen = openssl_cipher_iv_length($cipher);
            $iv = openssl_random_pseudo_bytes($ivlen);
            $ciphertext_raw = openssl_encrypt($val, $cipher, $secret_key, $options = $options_bitwise, $iv);
            $hmac = hash_hmac($hmac_algorithm, $ciphertext_raw, $secret_key, $as_binary = true);
            $ciphertext = base64_encode($iv . $hmac . $ciphertext_raw);

            $tmp_settings_array['output data length'] = strlen($ciphertext);

        }else{

            $tmp_settings_array['output data length'] = strlen($val);

        }

        $tmp_settings_array['raw data'] = $val;

        return $tmp_settings_array;

    }

    public function return_decrypt_settings($data, $encryption_channel = CRNRSTN_ENCRYPT_TUNNEL, $cipher_override = NULL, $secret_key_override = NULL, $hmac_algorithm_override = NULL, $options_bitwise_override = NULL){

        try{

            $tmp_settings_array = array();
            $tmp_settings_array['raw data length'] = strlen($data);

            if(!isset($data) || $data == ''){

                $tmp_settings_array['results'] = 'SUCCESS';
                return $tmp_settings_array;

            }else{

                //
                // BACK OUT OF URL ENCODING
                $data = urldecode($data);

                return $this->decrypt_settings($data, $encryption_channel, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return NULL;

        }

    }

    //
    // RUN THIS TO CHECK TECH SUIT COMPATIBILITY OF CURRENT OR CUSTOM ENCRYPTION PROFILE
    // CONTENTS OF RETURN ARRAY ::
    // - $encrypt_profile_array['raw data length']   // strlen() OF PROVIDED VALUE TO ENCRYPT
    // - $encrypt_profile_array['cipher']
    // - $encrypt_profile_array['secret_key']
    // - $encrypt_profile_array['options_bitwise']
    // - $encrypt_profile_array['hmac_algorithm']
    // - $encrypt_profile_array['digest']
    // - $encrypt_profile_array['results']  ...SUCCESS" or "hash_equals FAIL :: ERROR"
    public function decrypt_settings($val, $encryption_channel, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override){

        $encrypt_profile_array = array();
        $encrypt_profile_array['raw data length'] = strlen($val);

        switch($encryption_channel){
            case CRNRSTN_ENCRYPT_TUNNEL:

                $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::TUNNEL_ENCRYPTION';

            break;
            case CRNRSTN_ENCRYPT_DATABASE:

                $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::DATABASE_ENCRYPTION';

            break;
            case CRNRSTN_ENCRYPT_SESSION:

                $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::SESSION_ENCRYPTION';

            break;
            case CRNRSTN_ENCRYPT_COOKIE:

                $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::COOKIE_ENCRYPTION';

            break;
            case CRNRSTN_ENCRYPT_SOAP:

                $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::SOAP_ENCRYPTION';

            break;
            case CRNRSTN_ENCRYPT_OERSL:

                $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::OERSL_ENCRYPTION';

            break;
            default:
                //
                // CRNRSTN_ENCRYPT_TUNNEL

                //
                // RETRIEVE DATA
                // self::$oCRNRSTN_CONFIG_MGR->input_data_value($encrypt_cipher, 'encrypt_cipher','CRNRSTN_SYSTEM_CHANNEL::TUNNEL_ENCRYPTION',NULL,CRNRSTN_AUTHORIZE_RUNTIME_ONLY, $env_key);
                $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::TUNNEL_ENCRYPTION';
                $this->error_log('Unknown encryption channel constant provided to ' . __METHOD__ .'. Tunnel encryption profile has been applied.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

            break;

        }

        $tmp_encrypt_cipher = $this->oCRNRSTN->get_resource('encrypt_cipher', 0, $data_type_family);

        if(isset($cipher_override) || $tmp_encrypt_cipher != ''){

            //
            // RETRIEVE DATA FROM SESSION CONFIG MANAGER
            $tmp_encrypt_secret_key = $this->oCRNRSTN->get_resource('encrypt_secret_key', 0, $data_type_family);
            $tmp_encrypt_options = $this->oCRNRSTN->get_resource('encrypt_options', 0, $data_type_family);
            $tmp_hmac_alg = $this->oCRNRSTN->get_resource('hmac_alg', 0, $data_type_family);

            //
            // ENABLE CIPHER OVERRIDE :: v2.0.0
            if(!isset($cipher_override)){

                $cipher = $tmp_encrypt_cipher;

            }else{

                $cipher = $cipher_override;

            }

            $encrypt_profile_array['cipher'] = $cipher;

            if(!isset($secret_key_override)){

                $secret_key = $tmp_encrypt_secret_key;

            }else{

                $secret_key = $secret_key_override;
                $secret_key = openssl_digest($secret_key, self::$openssl_digest_profile, true);

            }

            $encrypt_profile_array['digest'] = self::$openssl_digest_profile;
            $encrypt_profile_array['secret_key'] = $secret_key;

            //
            // ENABLE OPTIONS BITWISE OVERRIDE :: v2.0.0
            if(!isset($options_bitwise_override)){

                $options_bitwise = $tmp_encrypt_options;

            }else{

                $options_bitwise = $options_bitwise_override;

            }

            $encrypt_profile_array['options_bitwise'] = $options_bitwise;

            //
            // ENABLE HMAC ALG OVERRIDE :: v2.0.0
            if(!isset($hmac_algorithm_override)){

                $hmac_algorithm = $tmp_hmac_alg;

            }else{

                $hmac_algorithm = $hmac_algorithm_override;

            }

            $encrypt_profile_array['hmac_algorithm'] = $hmac_algorithm;

            #
            # Source: http://php.net/manual/en/function.openssl-encrypt.php
            #
            $c = base64_decode($val);
            $ivlen = openssl_cipher_iv_length($cipher);
            $iv = substr($c, 0, $ivlen);
            $hmac = substr($c, $ivlen, $sha2len = 32);
            $ciphertext_raw = substr($c, $ivlen + $sha2len);
            $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $secret_key, $options = $options_bitwise, $iv);
            $calcmac = hash_hmac($hmac_algorithm, $ciphertext_raw, $secret_key, $as_binary = true);

            if (hash_equals($hmac, $calcmac))//PHP 5.6+ timing attack safe comparison
            {

                $encrypt_profile_array['results'] = 'SUCCESS';

            }else{

                $encrypt_profile_array['results'] = 'hash_equals FAIL :: ERROR';

            }

        }else{

            //
            // NO ENCRYPTION. RETURN VAL
            $encrypt_profile_array['results'] = 'SUCCESS';

        }

        return $encrypt_profile_array;

    }

    private function define_wildcard_resource($key){

        $oWildCardResource = new crnrstn_wildcard_resource($key, $this);

        return $oWildCardResource;

    }

    private function initializeWildCardResource($oCRNRSTN){

        $env_key = $this->env_key;

        if(!!$oCRNRSTN->wildCardResource_filePath_ARRAY[$this->config_serial_hash][$this->oCRNRSTN->hash(CRNRSTN_RESOURCE_ALL)]){

            $this->wildCardResource_filePath = $oCRNRSTN->wildCardResource_filePath_ARRAY[$this->config_serial_hash][$this->oCRNRSTN->hash(CRNRSTN_RESOURCE_ALL)];

        }else{

            if(!!$oCRNRSTN->wildCardResource_filePath_ARRAY[$this->config_serial_hash][$this->env_key_hash]){

                $this->wildCardResource_filePath = $oCRNRSTN->wildCardResource_filePath_ARRAY[$this->config_serial_hash][$this->env_key_hash];

            }

        }

        $oWildCardResource_ARRAY = array();

        try{

            if(is_file($this->wildCardResource_filePath)){

                //
                // INITIALIZE WILDCARD RESOURCES
                $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('Storing initialized Wild Card Resources at [' . $this->wildCardResource_filePath . '] in memory for this environment [' . $this->env_key_hash . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                include_once($this->wildCardResource_filePath);

                $this->oWildCardResource_ARRAY[$this->config_serial_hash][CRNRSTN_LOG_ALL][] = $oWildCardResource_ARRAY;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('CRNRSTN :: wildcard resource file cannot be loaded, because it [' . $this->wildCardResource_filePath . '] is not a file.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return NULL;

    }

    public function augmentWCR_array($oWCR){

        $tmp_array = $this->oWildCardResource_ARRAY[$this->config_serial_hash][CRNRSTN_LOG_ALL];
        $tmp_array[$oWCR->return_resource_key()] = $oWCR;
        $this->oWildCardResource_ARRAY[$this->config_serial_hash][CRNRSTN_LOG_ALL] = $tmp_array;

    }
    
    public function return_server_response_code($error_code, $crnrstn_html_burn = NULL){

        //
        // Source: http://php.net/manual/en/function.http-response-code.php
        // Source of source: Wikipedia "List_of_HTTP_status_codes"
        $http_status_codes = array(100 => 'Continue', 101 => 'Switching Protocols', 102 => 'Processing', 200 => 'OK', 201 => 'Created', 202 => 'Accepted', 203 => 'Non-Authoritative Information', 204 => 'No Content', 205 => 'Reset Content', 206 => 'Partial Content', 207 => 'Multi-Status', 300 => 'Multiple Choices', 301 => 'Moved Permanently', 302 => 'Found', 303 => 'See Other', 304 => 'Not Modified', 305 => 'Use Proxy', 306 => '(Unused)', 307 => 'Temporary Redirect', 308 => 'Permanent Redirect', 400 => 'Bad Request', 401 => 'Unauthorized', 402 => 'Payment Required', 403 => 'Forbidden', 404 => 'Not Found', 405 => 'Method Not Allowed', 406 => 'Not Acceptable', 407 => 'Proxy Authentication Required', 408 => 'Request Timeout', 409 => 'Conflict', 410 => 'Gone', 411 => 'Length Required', 412 => 'Precondition Failed', 413 => 'Request Entity Too Large', 414 => 'Request-URI Too Long', 415 => 'Unsupported Media Type', 416 => 'Requested Range Not Satisfiable', 417 => 'Expectation Failed', 418 => 'I\'m a teapot', 419 => 'Authentication Timeout', 420 => 'Enhance Your Calm', 422 => 'Unprocessable Entity', 423 => 'Locked', 424 => 'Failed Dependency', 424 => 'Method Failure', 425 => 'Unordered Collection', 426 => 'Upgrade Required', 428 => 'Precondition Required', 429 => 'Too Many Requests', 431 => 'Request Header Fields Too Large', 444 => 'No Response', 449 => 'Retry With', 450 => 'Blocked by Windows Parental Controls', 451 => 'Unavailable For Legal Reasons', 494 => 'Request Header Too Large', 495 => 'Cert Error', 496 => 'No Cert', 497 => 'HTTP to HTTPS', 499 => 'Client Closed Request', 500 => 'Internal Server Error', 501 => 'Not Implemented', 502 => 'Bad Gateway', 503 => 'Service Unavailable', 504 => 'Gateway Timeout', 505 => 'HTTP Version Not Supported', 506 => 'Variant Also Negotiates', 507 => 'Insufficient Storage', 508 => 'Loop Detected', 509 => 'Bandwidth Limit Exceeded', 510 => 'Not Extended', 511 => 'Network Authentication Required', 598 => 'Network read timeout error', 599 => 'Network connect timeout error');

        if(!isset($crnrstn_html_burn)){
            /*
            There are two special-case header calls. The first is a header that starts with
            the string "HTTP/" (case is not significant), which will be used to figure out the
            HTTP status code to send. For example, if you have configured Apache to use a PHP
            script to handle requests for missing files (using the ErrorDocument directive),
            you may want to make sure that your script generates the proper status code.
            */
            header($_SERVER['SERVER_PROTOCOL'] . ' ' . $error_code . ' ' . $http_status_codes[$error_code]);
            exit();

        }

        header($this->getServerArrayVar('SERVER_PROTOCOL') . ' ' . $error_code . ' ' . $http_status_codes[$error_code]);

        //
        // THO WE HAVE SINCE MIGRATED TO BITWISE, I AM LEAVING THIS SWITCH AS IS...FOR FUTURE WHITE LABELING INTEGRATIONS.
        switch($this->sys_notices_creative_mode){
            case 'ALL_IMAGE':
            case 'ALL_IMAGE_LOGO_OFF':

                $str = '<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    ' . $this->return_creative('CRNRSTN_FAVICON') . '
    <title>' . $error_code . ' ' . $http_status_codes[$error_code] . '</title>
</head>
<body style="background-color: #FFF; width:100%; text-align: left; margin:0px auto;">
<div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px; border-bottom: 2px solid #F90000;"></div>
<div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px; border-bottom: 1px solid #DB1717;"></div>

<div style=\'width:96%; margin:0 0 0 0; padding:6px 2% 0 2%; color:#FFF; font-family:"trebuchet MS", Verdana, sans-serif;background-color:#BEBEBE; height:30px; line-height: 28px;\'><h1 style="font-size: 30px; overflow: hidden; height:23px; padding-top:7px; margin-top: 0;">Server Error</h1></div>
<div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px; border-top: 2px solid #FFF;"></div>

<div style="height:5px; '.$this->return_creative('BG_ELEMENT_RESPONSE_CODE', CRNRSTN_UI_IMG_BASE64).' background-repeat: repeat-x;">
    <div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px;"></div>
</div>

<div style="padding:100px 0 300px 100px; float:left; font-family:arial; font-weight:bold; font-size:11px;">' . $error_code . ' ' . $http_status_codes[$error_code] . '</div>
<!--
<div style="position:absolute; padding:200px 0 0 10px; float:left;"><pre>

' . $crnrstn_html_burn . '

</pre></div>
-->
<div style="padding:16px 2% 0 0; float:right; width:260px;">
    <div style="float:right; ">
        ' . $this->return_component_branding_creative(true, CRNRSTN_UI_IMG_BASE64_PNG_HTML_WRAPPED) . '
    </div>
</div>

<div style="float:right; padding:420px 0 0 0; margin:0; width:100%;">
    <div style="position: absolute; width:100%; text-align: right; background-color: #FFF; padding-top: 20px;">
        ' . $this->return_creative('J5_WOLF_PUP_RAND') . '
    </div>
</div>

<div style="height:0px; width:100%; clear:both; display: block; overflow: hidden;"></div>

</body>
</html>';

            break;
            case 'ALL_HTML_LOGO_OFF':
            case 'ALL_HTML':
            default:

                $str = '<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>' . $error_code . ' ' . $http_status_codes[$error_code] . '</title>
</head>
<body style="background-color: #FFF; text-align: left; margin:0px auto; border: 0; padding:0; margin:0; font-family:Arial, Helvetica, sans-serif; ">
<div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px; border-bottom: 2px solid #F90000;"></div>
<div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px; border-bottom: 1px solid #DB1717;"></div>

<div style=\'width:96%; margin:0 0 0 0; padding:6px 2% 0 2%; color:#FFF; font-family:"trebuchet MS", Verdana, sans-serif;background-color:#BEBEBE; height:30px; line-height: 28px;\'><h1 style="font-size: 30px; overflow: hidden; height:23px; padding-top:7px; margin-top: 0;">Server Error</h1></div>
<div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px; border-top: 2px solid #FFF;"></div>

<div style="height:5px; '.$this->return_creative('BG_ELEMENT_RESPONSE_CODE', CRNRSTN_UI_IMG_BASE64).' background-repeat: repeat-x;">
    <div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px;"></div>
</div>

<div style="padding:100px 0 300px 100px; float:left; font-family:arial; font-weight:bold; font-size:11px;">' . $error_code . ' ' . $http_status_codes[$error_code] . '</div>
<!--
<div style="position:absolute; padding:200px 0 0 10px; float:left;"><pre>

' . $crnrstn_html_burn . '

</pre></div>
-->
<div style="padding:16px 2% 0 0; float:right; width:260px;">
    <div style="float:right; ">
        ' . $this->return_component_branding_creative(true, CRNRSTN_UI_IMG_BASE64_PNG_HTML_WRAPPED) . '
    </div>
</div>

<div style="float:right; padding:420px 0 0 0; margin:0; width:100%;">
    <div style="position: absolute; width:100%; text-align: right; background-color: #FFF; padding-top: 20px;">
        ' . $this->return_creative('J5_WOLF_PUP_RAND') . '
    </div>
</div>

<div style="height:0px; width:100%; clear:both; display: block; overflow: hidden;"></div>

</body>
</html>';

            break;

        }
        
        echo $str;
        
        exit();

    }

    public function get_resource_count($data_key, $data_type_family, $env_key){

        return $this->oCRNRSTN->get_resource_count($data_key, $data_type_family, $env_key);

    }

    public function retrieve_data_value($data_key, $index = NULL, $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL', $env_key = NULL, $soap_transport = false){

        return $this->oCRNRSTN->retrieve_data_value($data_key, $data_type_family, $index, $env_key, $soap_transport);

    }

    public function __getEnvParam($paramName, $index = 0, $wildCardKey = NULL, $soap_transport = false){

        if(is_string($index)){

            error_log(__LINE__ . ' env getEnvParam(\'' . $paramName . '\') needs the "inndex = 0" added. thx, bro! die();');
            die();

        }

        try{

            //
            // CHECK FOR EXISTENCE OF PARAMETER WITHIN WILD CARD RESOURCE
            if(isset($wildCardKey)){

                if(isset($this->oWildCardResource_ARRAY[$this->config_serial_hash][CRNRSTN_LOG_ALL])) {

                    $tmp_oWCR_ARRAY = $this->oWildCardResource_ARRAY[$this->config_serial_hash][CRNRSTN_LOG_ALL];

                    foreach($tmp_oWCR_ARRAY as $key => $oWCR){

                        if(isset($oWCR[$wildCardKey])){

                            //error_log(__LINE__ . ' env WE HAVE A SET WCR KEY IN OBJ_ARRAY $wildCardKey=' . $wildCardKey);
                            $oWCR = $oWCR[$wildCardKey];

                            $tmp_oDDO = $oWCR->get_attribute($wildCardKey, $paramName, $soap_transport);

                            switch($tmp_oDDO->preach('type', $paramName)){
                                case 'int':

                                    return (int) $tmp_oDDO->preach('value', $paramName);

                                break;
                                case 'integer':

                                    return (integer) $tmp_oDDO->preach('value', $paramName);

                                break;
                                case 'bool':

                                    if($soap_transport){

                                        return $tmp_oDDO->preach('value', $paramName);

                                    }else{

                                        return $this->boolean_conversion($tmp_oDDO->preach('value', $paramName));

                                    }

                                break;
                                case 'boolean':

                                    if($soap_transport){

                                        return $tmp_oDDO->preach('value', $paramName);

                                    }else{

                                        return $this->boolean_conversion($tmp_oDDO->preach('value', $paramName));

                                    }

                                break;
                                case 'float':

                                    return (float) $tmp_oDDO->preach('value', $paramName);

                                break;
                                case 'double':

                                    return (double) $tmp_oDDO->preach('value', $paramName);

                                break;
                                case 'real':

                                    return (float) $tmp_oDDO->preach('value', $paramName);

                                break;
                                case 'string':

                                    return (string) $tmp_oDDO->preach('value', $paramName);

                                break;
                                case 'array':

                                    return (array) $tmp_oDDO->preach('value', $paramName);

                                break;
                                case 'object':

                                    return (object) $tmp_oDDO->preach('value', $paramName);

                                break;
                                case 'NULL':

                                    return NULL;

                                break;
                                default:

                                    return $tmp_oDDO->preach('value', $paramName);

                                break;

                            }

                        }

                    }

//                    if(!isset($tmp_oWCR_ARRAY[$wildCardKey])){
//
//                        error_log(__LINE__ . ' die env after print_r');
//                        print_r($wildCardKey);
//                        print_r($tmp_oWCR_ARRAY);
//                        die();
//                        $this->error_log('The requested WCR (wild card resource), "' . $wildCardKey . '", has not been configured for this environment (e.g. NULL WCR array index, here)...albeit there are other environments CRNRSTN :: is currently configured to support here which have had at least one (1) WCR defined and initialized therein (so...there is that).', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);
//
//                        //
//                        // HOOOSTON...VE HAF PROBLEM!
//                        throw new Exception('The requested WCR (wild card resource), "' . $wildCardKey . '", has not been configured for this environment (e.g. NULL WCR array index, here)...albeit there are other environments CRNRSTN :: is currently configured to support here which have had at least one (1) WCR defined and initialized therein (so...there is that).');
//
//                    }else{
//
//                        $tmp_oWCR = $tmp_oWCR_ARRAY[$wildCardKey];
//
//                        if ($tmp_oWCR->isset_WCR($wildCardKey, $paramName)) {
//
//                            //
//                            // PARAM HAS BEEN DEFINED WITHIN WILD CARD RESOURCE
//                            $tmp_oDDO = $tmp_oWCR->get_attribute($wildCardKey, $paramName, $soap_transport);
//
//                            //$tmp_oDDO
//                            //preach('isset', key). ..
//                            //preach('type')
//                            //preach('value')
//                            switch($tmp_oDDO->preach('type', $paramName)){
//                                case 'int':
//
//                                    return (int) $tmp_oDDO->preach('value', $paramName);
//
//                                break;
//                                case 'integer':
//
//                                    return (integer) $tmp_oDDO->preach('value', $paramName);
//
//                                break;
//                                case 'bool':
//
//                                    if($soap_transport){
//
//                                        return $tmp_oDDO->preach('value', $paramName);
//
//                                    }else{
//
//                                        return $this->boolean_conversion($tmp_oDDO->preach('value', $paramName));
//
//                                    }
//
//                                break;
//                                case 'boolean':
//
//                                    if($soap_transport){
//
//                                        return $tmp_oDDO->preach('value', $paramName);
//
//                                    }else{
//
//                                        return $this->boolean_conversion($tmp_oDDO->preach('value', $paramName));
//
//                                    }
//
//                                break;
//                                case 'float':
//
//                                    return (float) $tmp_oDDO->preach('value', $paramName);
//
//                                break;
//                                case 'double':
//
//                                    return (double) $tmp_oDDO->preach('value', $paramName);
//
//                                break;
//                                case 'real':
//
//                                    return (float) $tmp_oDDO->preach('value', $paramName);
//
//                                break;
//                                case 'string':
//
//                                    return (string) $tmp_oDDO->preach('value', $paramName);
//
//                                break;
//                                case 'array':
//
//                                    return (array) $tmp_oDDO->preach('value', $paramName);
//
//                                break;
//                                case 'object':
//
//                                    return (object) $tmp_oDDO->preach('value', $paramName);
//
//                                break;
//                                case 'NULL':
//
//                                    return NULL;
//
//                                break;
//                                default:
//
//                                    return $tmp_oDDO->preach('value', $paramName);
//
//                                break;
//
//                            }
//
//                        } else {
//
//                            $this->error_log('The "' . $paramName . '" parameter has been requested from wild card resource (i.e. WCR), "' . $wildCardKey . '", but this parameter was not found to have been initialized therein via oWCR->add_attribute().', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);
//
//                            //
//                            // HOOOSTON...VE HAF PROBLEM!
//                            throw new Exception('The "' . $paramName . '" parameter has been requested from wild card resource (i.e. WCR), "' . $wildCardKey . '", but this parameter was not found to have been initialized therein via oWCR->add_attribute().');
//
//                        }
//
//                    }

                }else{

                    $this->error_log('The wild card resource (i.e. WCR), "' . $wildCardKey . '", has been requested, but no WCR of the kind has been configured for this environment.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('The wild card resource (i.e. WCR), "' . $wildCardKey . '", has been requested, but no WCR of the kind has been configured for this environment.');

                }

            }else{

                if(!isset(self::$sess_env_param_ARRAY[$paramName])){

                    self::$sess_env_param_ARRAY[$paramName] = $this->oSESSION_MGR->get_session_param($paramName, $soap_transport);

                }

                return self::$sess_env_param_ARRAY[$paramName];

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    /**
    * @see http://php.net/manual/en/function.openssl-encrypt.php
    */
    public function openssl_get_cipher_methods(){
        $ciphers             = openssl_get_cipher_methods();
        $ciphers_and_aliases = openssl_get_cipher_methods(true);
        $cipher_aliases      = array_diff($ciphers_and_aliases, $ciphers);
        
        //
        // ECB MODE SHOULD BE AVOIDED
        $ciphers = array_filter($ciphers, function($n){ return stripos($n, 'ecb') === FALSE; });
        
        //
        // AT LEAST AS EARLY AS AUG 2016, OPENSSL DECLARED THE FOLLOWING WEAK: RC2, RC4, DES, 3DES, MD5 based
        $ciphers = array_filter($ciphers, function($c){ return stripos($c, 'des') === FALSE; });
        $ciphers = array_filter($ciphers, function($c){ return stripos($c, 'rc2') === FALSE; });
        $ciphers = array_filter($ciphers, function($c){ return stripos($c, 'rc4') === FALSE; });
        $ciphers = array_filter($ciphers, function($c){ return stripos($c, 'md5') === FALSE; });
        $cipher_aliases = array_filter($cipher_aliases, function($c){ return stripos($c, 'des') === FALSE; });
        $cipher_aliases = array_filter($cipher_aliases, function($c){ return stripos($c, 'rc2') === FALSE; });
        $mergedCiphers = array_merge($ciphers, $cipher_aliases);
        
        return $mergedCiphers;
        
    }

    public function return_micro_time(){

        return $this->oLogger->returnMicroTime();

    }
    
    public function wall_time(){

        $timediff = $this->microtime_float() - $this->starttime;
        
        return substr($timediff,0,-8);
        
    }
    
    public function monitoringDeltaTimeFor($watchKey, $decimal = 8){
        
        if(!isset(self::$m_starttime[$watchKey])){

            self::$m_starttime[$watchKey] = $this->microtime_float();
            $timediff = self::$m_starttime[$watchKey] - self::$m_starttime[$watchKey];

            $len = $decimal * -1;

            return substr($timediff,0, $len);

            //return 0.0;

        }else{

            $timediff = $this->microtime_float() - self::$m_starttime[$watchKey];

            $len = $decimal * -1;

            return substr($timediff,0, $len);

            //return substr($timediff,0,-8);

        }
    }
    
    //
    // SOURCE :: http://www.php.net/manual/en/function.microtime.php
    private function microtime_float(){

        list($usec, $sec) = explode(' ', microtime());
        return ((float) $usec + (float) $sec);

    }
    
    //
    // RETURN HTTP/S PATH OF CURRENT SCRIPT
    public function current_location(){

        if(isset($_SERVER['HTTPS'])){

            if($_SERVER['HTTPS'] && ($_SERVER['HTTPS'] != 'off')){

                self::$requestProtocol='https://';

            }else{

                if(isset($_SERVER['HTTP_X_FORWARDED_PROTO'])){

                    if( !empty( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' ){

                        self::$requestProtocol='https://';

                    }else{

                        self::$requestProtocol='http://';

                    }

                }else{

                    self::$requestProtocol='http://';

                }
            }

        }else{

            self::$requestProtocol='http://';

        }
        
        return self::$requestProtocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

    }

    //
    // METHOD SOURCE :: Stack Overflow :: https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
    // Contributor :: https://stackoverflow.com/users/1698153/scott
    public function generate_new_key($len = 32, $char_selection = NULL){

        //
        // SEND -1 AS $char_selection FOR USE OF *ALL* CHARACTERS IN RANDOM KEY
        // GENERATION...EXCEPT THE SEQUENCE \e ESCAPE KEY (ESC or 0x1B (27) in
        // ASCII) AND NOT SPLITTING HAIRS BETWEEN SEQUENCE \n LINEFEED (LF or
        // 0x0A (10) in ASCII) AND SEQUENCE \r CARRIAGE RETURN (CR or 0x0D
        // (13) in ASCII) AND ALSO SCREW BOTH \f FORM FEED (FF or 0x0C (12) in
        // ASCII) AND \v VERTICAL TAB (VT or 0x0B (11) in ASCII) SEQUENCES.
        //
        // ALSO, CHECK OUT $char_selection=-2, AND $char_selection=-3.
        // $char_selection=-3 IS THE NICEST(NO: QUOTES, COMMAS,...ETC.)...WITH
        // THE MOST DISTINCT NUMBER OF CHARACTERS FOR A SERIAL, IMHO.
        //
        // https://www.php.net/manual/en/language.types.string.php#language.types.string.syntax.double

        return $this->oCRNRSTN->generate_new_key($len, $char_selection);

    }

    //
    // METHOD SOURCE :: Stack Overflow :: https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
    // Contributor :: https://stackoverflow.com/users/4895359/yumoji
    private function crypto_rand_secure($min, $max){

        $range = $max - $min;

        if($range < 1) return $min;             // not so random...

        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1;          // length in bytes
        $bits = (int) $log + 1;                 // length in bits
        $filter = (int) (1 << $bits) - 1;       // set all lower bits to 1

        do{

            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter;              // discard irrelevant bits

        }while($rnd > $range);

        return $min + $rnd;

    }

    public function return_CRNRSTN_ASCII_ART($index = NULL){

        return $this->oCRNRSTN->return_CRNRSTN_ASCII_ART($index);

    }

    public function elapsed_delta_time_for($watchKey, $decimal = 8){

        return $this->monitoringDeltaTimeFor($watchKey, $decimal);

    }

    public function return_pretty_delta_time($delta_secs, $microsecs = 0, $mode = 'ELAPSED_VERBOSE'){

        $microsecs = '0.' . $microsecs;

        switch($mode){
            case 'ELAPSED':

                $tmp_output = $this->elapsed($delta_secs, $microsecs);

            break;
            case 'ELAPSED_VERBOSE':

                $tmp_output = $this->elapsed_verbose($delta_secs, $microsecs);

            break;

        }

        return $tmp_output;

    }

    # SOURCE :: http://php.net/manual/en/function.time.php
    public function elapsed_from_current($secs){

        $ts = time();
        $delta_secs = $ts-$secs;

        $bit = array(
            self::$lang_content_ARRAY['Y'] => $delta_secs / 31556926 % 12,
            self::$lang_content_ARRAY['W'] => $delta_secs / 604800 % 52,
            self::$lang_content_ARRAY['D'] => $delta_secs / 86400 % 7,
            self::$lang_content_ARRAY['H'] => $delta_secs / 3600 % 24,
            self::$lang_content_ARRAY['M'] => $delta_secs / 60 % 60,
            self::$lang_content_ARRAY['S'] => $delta_secs % 60
        );

        //
        // LET'S CONFIRM LANG OPERATION
        //error_log("(146) Y->" . self::$lang_content_ARRAY['Y']);      // shows 1...not y...

        foreach($bit as $k => $v){

            if($v > 0){

                //
                // PUT IN CURFEW FOR TIME GRANULARITY
                if($k == self::$lang_content_ARRAY['Y'] || $k == self::$lang_content_ARRAY['W'] || ($k == self::$lang_content_ARRAY['D'] && $v > 1)){

                    //
                    // RETURN DEFAULT DATE FORMAT
                    if(isset($format_override)){

                        return date($format_override, $secs);

                    }else{

                        return date('m.d.Y @ H:i:s', $secs);

                    }

                }else{

                    $ret[] = $v . $k;

                }

            }

        }

        if(!isset($ret)){

            $ret[] = 'just now.';

        }else{

            if(sizeof($ret) == 0){

                $ret[] = 'just now.';

            }else{

                $ret[] = self::$lang_content_ARRAY['AGO'];

            }

        }

        return join(' ', $ret);

    }

    private function elapsed($delta_secs, $microsecs = 0){

        $bit = array(
            self::$lang_content_ARRAY['Y'] => $delta_secs / 31556926 % 12,
            self::$lang_content_ARRAY['W'] => $delta_secs / 604800 % 52,
            self::$lang_content_ARRAY['D'] => $delta_secs / 86400 % 7,
            self::$lang_content_ARRAY['H'] => $delta_secs / 3600 % 24,
            self::$lang_content_ARRAY['M'] => $delta_secs / 60 % 60,
            self::$lang_content_ARRAY['S'] => ($delta_secs % 60) + $microsecs
        );

        //
        // LET'S CONFIRM LANG OPERATION
        //error_log("(146) Y->" . self::$lang_content_ARRAY['Y']);      // shows 1...not y...

        foreach($bit as $k => $v){
            if($v > 0){
                //
                // PUT IN CURFEW FOR TIME GRANULARITY
                if($k == self::$lang_content_ARRAY['Y'] || $k == self::$lang_content_ARRAY['W'] || ($k == self::$lang_content_ARRAY['D'] && $v > 1)){

                    //
                    // RETURN DEFAULT DATE FORMAT
                    if(isset($format_override)){

                        return date($format_override, $delta_secs);

                    }else{

                        return date('m.d.Y @ H:i:s', $delta_secs);
                    }

                }else{

                    $ret[] = $v . $k;

                }

            }

        }

        if(!isset($ret)){

            $ret[] = 'just now.';

        }else{

            if(sizeof($ret)==0){

                $ret[] = 'just now.';

            }else{

                $ret[] = self::$lang_content_ARRAY['AGO'];

            }

        }

        return join(' ', $ret);

    }

    # SOURCE :: http://php.net/manual/en/function.time.php
    private function elapsed_verbose($delta_secs, $microsecs = 0){

        //
        // THIS SHOULD BE EXPOSED TO THE LANGUAGE ENGINE OF THE EVIFWEB CLIENT EXTRANET. NOT HARD CODED ENGLISH....OH MY. WHAT A REQUIREMENT THIS IS.
        // RE-CRNRSTN, IT MAY NOT BE APPROPRIATE TO PUSH LANG CONSIDERATIONS. WELL, MAYBE....THIS WOULD BE A FIRST FOR CRNRSTN...
        // I DON'T WANT TO PROCEED UNTIL I AM CLEAR ABOUT LANG SUPPORT DIRECTION FOR THIS. THERE ARE IMPLICATIONS.
        // TO REALLY TAKE CARE OF THE PEOPLE, DON'T FORGET SINGULAR AND PLURAL SUPPORT FOR MULTIPLE LANG...SO 2x THE NUMBER OF FORMATS...

        //
        // WE NEED TO APPROACH THIS DIFFERENTLY TO ALLOW FOR PLURAL
        $bit = array(
            '0'        => $delta_secs / 31556926 % 12,
            '1'        => $delta_secs / 604800 % 52,
            '2'        => $delta_secs / 86400 % 7,
            '3'        => $delta_secs / 3600 % 24,
            '4'        => $delta_secs / 60 % 60,
            '5'        => ($delta_secs % 60) + $microsecs
        );

        $bit_singular = array(
            '0'     => ' ' . self::$lang_content_ARRAY['YEAR'],
            '1'     => ' ' . self::$lang_content_ARRAY['WEEK'],
            '2'     => ' ' . self::$lang_content_ARRAY['DAY'],
            '3'     => ' ' . self::$lang_content_ARRAY['HOUR'],
            '4'     => ' ' . self::$lang_content_ARRAY['MINUTE'],
            '5'     => ' ' . self::$lang_content_ARRAY['SECOND']
        );

        $bit_plural = array(
            '0'     => ' ' . self::$lang_content_ARRAY['YEARS'],
            '1'     => ' ' . self::$lang_content_ARRAY['WEEKS'],
            '2'     => ' ' . self::$lang_content_ARRAY['DAYS'],
            '3'     => ' ' . self::$lang_content_ARRAY['HOURS'],
            '4'     => ' ' . self::$lang_content_ARRAY['MINUTES'],
            '5'     => ' ' . self::$lang_content_ARRAY['SECONDS']
        );

        foreach($bit as $k => $v){

            if($v > 1){

                $ret[] = $v . $bit_plural[$k];
                //error_log('finite (194) test ->' . $bit_plural[$k]);

            }else{

                if($v == 1){

                    $ret[] = $v . $bit_singular[$k];
                    //error_log('finite (200) test ->' . $bit_singular[$k]);

                }

            }

        }

        //foreach($bit_singular as $k => $v){
        //    if($v > 1)$ret[] = $v . $k . 's';           // APPENDING AN S FOR PLURAL IS PRIMARILY ENGLISH. WE CAN'T RELY ON THIS APPEND FOR OUR PURPOSES.
        //    if($v == 1)$ret[] = $v . $k;
        //}

        if(isset($ret)){

            array_splice($ret, count($ret) - 1, 0, self::$lang_content_ARRAY['AND']);

            $tmp_output = trim(join(' ', $ret));

            $tmp_output = ltrim($tmp_output, 'and');

        }else{

            $tmp_output = $this->wall_time();

            $tmp_output .= ' secs';

        }

        return $tmp_output;

    }

    private function elapsed_verbose_from_current($secs){

        $ts = time();
        $delta_secs = $ts - $secs;

        //
        // THIS SHOULD BE EXPOSED TO THE LANGUAGE ENGINE OF THE EVIFWEB CLIENT EXTRANET. NOT HARD CODED ENGLISH....OH MY. WHAT A REQUIREMENT THIS IS.
        // RE-CRNRSTN, IT MAY NOT BE APPROPRIATE TO PUSH LANG CONSIDERATIONS. WELL, MAYBE....THIS WOULD BE A FIRST FOR CRNRSTN...
        // I DON'T WANT TO PROCEED UNTIL I AM CLEAR ABOUT LANG SUPPORT DIRECTION FOR THIS. THERE ARE IMPLICATIONS.
        // TO REALLY TAKE CARE OF THE PEOPLE, DON'T FORGET SINGULAR AND PLURAL SUPPORT FOR MULTIPLE LANG...SO 2x THE NUMBER OF FORMATS...

        //
        // WE NEED TO APPROACH THIS DIFFERENTLY TO ALLOW FOR PLURAL
        $bit = array(
            '0'        => $delta_secs / 31556926 % 12,
            '1'        => $delta_secs / 604800 % 52,
            '2'        => $delta_secs / 86400 % 7,
            '3'        => $delta_secs / 3600 % 24,
            '4'        => $delta_secs / 60 % 60,
            '5'        => $delta_secs % 60
        );

        $bit_singular = array(
            '0'     => ' ' . self::$lang_content_ARRAY['YEAR'],
            '1'     => ' ' . self::$lang_content_ARRAY['WEEK'],
            '2'     => ' ' . self::$lang_content_ARRAY['DAY'],
            '3'     => ' ' . self::$lang_content_ARRAY['HOUR'],
            '4'     => ' ' . self::$lang_content_ARRAY['MINUTE'],
            '5'     => ' ' . self::$lang_content_ARRAY['SECOND']
        );

        $bit_plural = array(
            '0'     => ' ' . self::$lang_content_ARRAY['YEARS'],
            '1'     => ' ' . self::$lang_content_ARRAY['WEEKS'],
            '2'     => ' ' . self::$lang_content_ARRAY['DAYS'],
            '3'     => ' ' . self::$lang_content_ARRAY['HOURS'],
            '4'     => ' ' . self::$lang_content_ARRAY['MINUTES'],
            '5'     => ' ' . self::$lang_content_ARRAY['SECONDS']
        );

        foreach($bit as $k => $v){

            if($v > 1){

                $ret[] = $v . $bit_plural[$k];
                //error_log("finite (194) test ->".$bit_plural[$k]);

            }else{

                if($v == 1){

                    $ret[] = $v . $bit_singular[$k];
                    //error_log("finite (200) test ->".$bit_singular[$k]);

                }

            }

        }

        //foreach($bit_singular as $k => $v){
        //    if($v > 1)$ret[] = $v . $k . 's';           // APPENDING AN S FOR PLURAL IS PRIMARILY ENGLISH. WE CAN'T RELY ON THIS APPEND FOR OUR PURPOSES.
        //    if($v == 1)$ret[] = $v . $k;
        //}

        array_splice($ret, count($ret) - 1, 0, self::$lang_content_ARRAY['AND']);
        $ret[] = self::$lang_content_ARRAY['AGO'];

        return join(' ', $ret);

    }

    public function error_log($str, $line_num = NULL, $method = NULL, $file = NULL, $log_silo_key = NULL){

        //
        // Thursday, August 18, 2022 @ 0224 hrs
        return $this->oCRNRSTN->error_log($str, $line_num, $method, $file, $log_silo_key);

    }

    public function return_set_serialized_bits($const_nom, $integer_constants_array){

        $tmp_array = array();

        foreach($integer_constants_array as $key => $int_constant){

            if($this->oCRNRSTN_BITFLIP_MGR->serialized_is_bit_set($const_nom, $int_constant)){

                $tmp_array[] = $int_constant;

            }

        }

        return $tmp_array;

    }

    public function return_set_bits($constants_int_ARRAY){

        //$this->oCRNRSTN_BITWISE->set($integer_constant);
        //$this->oCRNRSTN_BITWISE->toggle($integer_constant);
        //$this->oCRNRSTN_BITWISE->read($integer_constant);
        //$this->oCRNRSTN_BITWISE->remove($integer_constant)
        //$this->oCRNRSTN_BITWISE->stringout()
        //$this->oCRNRSTN_BITFLIP_MGR->set($integer_constant, true);

        $tmp_array = array();

        foreach($constants_int_ARRAY as $key => $int_constant){

            if($this->oCRNRSTN_BITFLIP_MGR->is_bit_set($int_constant)){

                $tmp_array[] = $int_constant;

            }

        }

        return $tmp_array;

    }

    public function print_r_str($expression, $title = NULL, $theme_style = NULL, $line_num = NULL, $method = NULL, $file = NULL){

        return $this->oCRNRSTN->print_r_str($expression, $title, $theme_style, $line_num, $method, $file);

    }

    public function print_r($expression, $title = NULL, $theme_style = NULL, $line_num = NULL, $method = NULL, $file = NULL){

        return $this->oCRNRSTN->print_r($expression, $title, $theme_style, $line_num, $method, $file);

    }

    public function return_component_branding_creative($strip_formatting = false, $output_mode = NULL){

        $tmp_int = rand(0, sizeof(self::$weighted_elements_keys_ARRAY) - 1);

        //error_log(__LINE__ . ' env ' . __METHOD__ . '[' . $tmp_int . '][' . self::$weighted_elements_keys_ARRAY[$tmp_int] . ']');

        if($strip_formatting){

            if(self::$weighted_elements_keys_ARRAY[$tmp_int] == 'CRNRSTN ::'){

                $creative = '<div style="padding:4px 0 5px 5px; text-align:left; font-family: Courier New, Courier, monospace; font-size:11px;">C<span style="color:#F00;">R</span>NRSTN :: v' . $this->version_crnrstn() . '</div>';

            }else{

                //error_log(__LINE__ . ' env ' . __METHOD__ . ' [img=' . self::$weighted_elements_keys_ARRAY[$tmp_int] . '][$output_mode=' . $output_mode . '].');
                //$creative = '<span style="font-family: Courier New, Courier, monospace; font-size:11px;">' . $this->return_creative(self::$weighted_elements_keys_ARRAY[$tmp_int], $output_mode) . '</span>';
                $creative = $this->return_creative(self::$weighted_elements_keys_ARRAY[$tmp_int], $output_mode);

            }

        }else{

            if(self::$weighted_elements_keys_ARRAY[$tmp_int] == 'CRNRSTN ::'){

                $creative = '<div style="float:left; padding:4px 0 5px 5px; text-align:left; font-family: Courier New, Courier, monospace; font-size:11px;">C<span style="color:#F00;">R</span>NRSTN :: v' . $this->version_crnrstn() . '</div>';

            }else{

                //error_log(__LINE__ . ' env ' . __METHOD__ . ' [img=' . self::$weighted_elements_keys_ARRAY[$tmp_int] . '][$output_mode=' . $output_mode . '].');
                $creative = '<div style="float:left; padding:4px 0 5px 5px; text-align:left; font-family: Courier New, Courier, monospace; font-size:11px;">' . $this->return_creative(self::$weighted_elements_keys_ARRAY[$tmp_int], $output_mode) . '</div>';

            }

        }

        return $creative;

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.base64-encode.php
    // AUTHOR :: luke at lukeoliff.com :: https://www.php.net/manual/en/function.base64-encode.php#105200
    public function base64_encode_image ($filename, $filetype) {

        if (is_file($filename) || (is_string($filename) && $filename != '')) {

            $imgbinary = fread(fopen($filename, 'r'), $this->find_filesize($filename));

            return 'data:image/' . $filetype . ';base64,' . base64_encode($imgbinary);

        }

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.filesize.php
    // AUTHOR :: C0nw0nk :: https://www.php.net/manual/en/function.filesize.php#119435
    public function find_filesize($file){

        if(substr(PHP_OS, 0, 3) == 'WIN'){

            exec('for %I in ("' . $file . '") do @echo %~zI', $output);
            $return = $output[0];

        }else{

            $return = filesize($file);

            // SOURCE :: https://www.php.net/manual/en/function.filesize.php
            // AUTHOR :: synnus at gmail dot com :: https://www.php.net/manual/en/function.filesize.php#121437
            //$fsobj = new COM("Scripting.FileSystemObject");
            //$f = $fsobj->GetFile($file);
            //$return = $f->Size;

        }

        return $return;

    }

    public function client_agent_is($key, $userAgent = null, $httpHeaders = null){

        return $this->oHTTP_MGR->is($key, $userAgent, $httpHeaders);

    }

    public function system_base64_synchronize($data_key = NULL){

        return $this->oCRNRSTN_MEDIA_CONVERTOR->system_base64_synchronize($data_key);

    }

    public function system_base64_integrate($dir_filepath, $img_batch_size){

        $tmp_current_batch = $tmp_batch_size = $img_batch_size;
        $tmp_filtered_filename_ARRAY = array();
        $tmp_processed_filename_ARRAY = array();

        $tmp_request_salt = $this->oCRNRSTN->generate_new_key(26);

        //$this->oCRNRSTN->print_r($dir_filepath, 'system_base64_integrate processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
        if(is_dir($dir_filepath)){

            //
            // SOURCE - LOCAL_DIR
            if(is_readable($dir_filepath)){

                $this->oCRNRSTN->print_r('THIS IS A READABLE DIRECTORY: ' . $dir_filepath, 'is_readable().', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

                //
                // SCAN DIR FOR IMAGE FILE CONTENT

                /*
                lnum 94 :: crnrstn_asset_validator::__construct($type, $ext, $mime)
                switch($type){
                case 'CREATIVE':
                $this->add_auth_mime_type('jpg','image/jpeg');
                $this->add_auth_mime_type('jpg','image/pjpeg');
                $this->add_auth_mime_type('jpeg','image/jpeg');
                $this->add_auth_mime_type('jpeg','image/pjpeg');
                $this->add_auth_mime_type('jpg2','image/jpeg');
                $this->add_auth_mime_type('gif','image/gif');
                $this->add_auth_mime_type('bmp','image/bmp');
                $this->add_auth_mime_type('bmp','image/x-windows-bmp');
                $this->add_auth_mime_type('jpe','application/rtf');
                $this->add_auth_mime_type('jpe','image/jpeg');
                $this->add_auth_mime_type('jpe','image/pjpeg');
                $this->add_auth_mime_type('jpe','application/rtf');
                $this->add_auth_mime_type('jfif','image/pipeg');
                $this->add_auth_mime_type('tif','image/tiff');
                $this->add_auth_mime_type('tif','image/x-tiff');
                $this->add_auth_mime_type('tiff','application/vnd.ms-works');
                $this->add_auth_mime_type('ico','image/x-icon');
                $this->add_auth_mime_type('svg','image/svg+xml');
                $this->add_auth_mime_type('pic','image/pict');
                $this->add_auth_mime_type('pict','image/pict');
                $this->add_auth_mime_type('png','image/png');

                */

                $this->oCRNRSTN->print_r('Scanning Images: ' . $dir_filepath, 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
                $this->oCRNRSTN->error_log('CRNRSTN :: BASE64 services scanning system images: ' . $dir_filepath, __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                $tmp_scraped_filename_ARRAY = $this->oCRNRSTN->better_scandir($dir_filepath);

//                $tmp = array_pop($tmp_scraped_filename_ARRAY);
//                $tmp = array_pop($tmp_scraped_filename_ARRAY);

                //oCRNRSTN_ASSET_MGR
                // CUSTOM IMAGES
                $tmp_img_cnt = sizeof($tmp_scraped_filename_ARRAY);
                for($i = 0; $i < $tmp_img_cnt; $i++){

                    $this->oCRNRSTN->print_r('FILE[' . $i . ' of ' . $tmp_img_cnt . ']: ' . $tmp_scraped_filename_ARRAY[$i], 'oCRNRSTN_ASSET_MGR::is_approved_mime_type().', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

//                    if($this->oCRNRSTN->oCRNRSTN_PERFORMANCE_REGULATOR->is_approved_mime_type(CRNRSTN_RESOURCE_IMAGE, $dir_filepath, $tmp_scraped_filename_ARRAY[$i])){
//
//                        $this->oCRNRSTN->print_r('APPROVED FILE: ' . $tmp_scraped_filename_ARRAY[$i], 'oCRNRSTN_PERFORMANCE_REGULATOR::is_approved_mime_type().', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
//
//                        die();
//
//                    }else{
//
//                        $this->oCRNRSTN->print_r('UNAUTHORIZED FILE TYPE: ' . $tmp_scraped_filename_ARRAY[$i], 'oCRNRSTN_PERFORMANCE_REGULATOR::is_approved_mime_type().', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
//
//                        die();
//
//                    }

                }


                return true;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                //$this->oCRNRSTN->error_log('CRNRSTN :: has experienced permissions related errors attempting to read from the source directory, ' . $dir_path . '.');
                $this->oCRNRSTN->print_r('NOT READABLE DIRECTORY: ' . $dir_filepath, 'is_readable().', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

            }

        }else{

            //
            // HOOOSTON...VE HAF PROBLEM!
            //$this->oCRNRSTN->oCRNRSTN->error_log('CRNRSTN :: has experienced errors attempting to find the source directory, ' . $dir_path . ', within the local file system.');
            $this->oCRNRSTN->print_r('NOT A DIRECTORY: ' . $dir_filepath, 'is_dir(). ', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

            if(is_file($dir_filepath) && strlen($dir_filepath) > 0){

                $this->oCRNRSTN->print_r('THIS IS A FILE: ' . $dir_filepath, 'is_file(). ', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

            }else{

                $this->oCRNRSTN->print_r('NOT A FILE: ' . $dir_filepath, 'is_file(). ', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

            }

        }




        die();



        //$this->oCRNRSTN->print_r('Images count: [' . count($tmp_filtered_filename_ARRAY) . '].', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

        $tmp_oMEDIA_CONVERTOR = new crnrstn_system_image_asset_manager($this->oCRNRSTN);

        foreach($tmp_filtered_filename_ARRAY as $index => $tmp_filename){

            $pos_dot = stripos($tmp_filename, '.');
            if($pos_dot !== false){

                $img_name = '';

                //
                // WE HAVE POTENTIAL FILENAME DOT
                $tmp_filename_ARRAY = explode('.', $tmp_filename);
                $tmp_original_file_extension_clean = array_pop($tmp_filename_ARRAY);   // $tmp_filename IS NOW ARRAY RETURN
                foreach($tmp_filename_ARRAY as $index_img_=> $val_img){

                    $img_name .= $val_img . '.';

                }

                $img_name = $this->oCRNRSTN->strrtrim($img_name, '.');

            }

            if(!isset($tmp_flagged_filename_ARRAY[$img_name])){

                $tmp_current_batch--;


                if($tmp_current_batch < 0){

                    $tmp_current_batch = $tmp_batch_size;
                    $tmp_oMEDIA_CONVERTOR = new crnrstn_system_image_asset_manager($this->oCRNRSTN);

                }

                if($tmp_oMEDIA_CONVERTOR->system_base64_synchronize($tmp_filename)){

                    //$this->oCRNRSTN->print_r('Processed image: [' . $tmp_filename . '].', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
                    $tmp_processed_filename_ARRAY[] = $tmp_filename;
                    $tmp_flagged_filename_ARRAY[$img_name] = 1;

                }

            }

        }

        //$this->oCRNRSTN->print_r('Processed Images [skipped=' . $tmp_skipped . '] [err=' . $tmp_err_cnt . '][' . print_r($tmp_processed_filename_ARRAY, true) . '].', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

        return true;





        return $this->oCRNRSTN_MEDIA_CONVERTOR->system_base64_integrate($dir_path, $img_batch_size);

    }

    public function system_base64_synchronize_batch($img_batch_size = 5){

        $tmp_current_batch = $tmp_batch_size = $img_batch_size;
        $tmp_filtered_filename_ARRAY = array();
        $tmp_processed_filename_ARRAY = array();

        $tmp_dir_path_PNG = CRNRSTN_ROOT . '/_crnrstn/ui/imgs/png/';
        $tmp_dir_path_JPEG = CRNRSTN_ROOT . '/_crnrstn/ui/imgs/jpg/';

        //$this->oCRNRSTN->print_r('Scanning Images: ' . $tmp_dir_path_PNG, 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
        $this->oCRNRSTN->error_log('CRNRSTN :: BASE64 services scanning system images: ' . $tmp_dir_path_PNG, __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
        $tmp_scraped_filename_PNG_ARRAY = $this->oCRNRSTN->better_scandir($tmp_dir_path_PNG);

        //$this->oCRNRSTN->print_r('Scanning Images: ' . $tmp_dir_path_JPEG, 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
        $this->oCRNRSTN->error_log('CRNRSTN :: BASE64 services scanning system images: ' . $tmp_dir_path_JPEG, __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
        $tmp_scraped_filename_JPEG_ARRAY = $this->oCRNRSTN->better_scandir($tmp_dir_path_JPEG);

//        $tmp = array_pop($tmp_scraped_filename_PNG_ARRAY);
//        $tmp = array_pop($tmp_scraped_filename_PNG_ARRAY);
//        $tmp = array_pop($tmp_scraped_filename_JPEG_ARRAY);
//        $tmp = array_pop($tmp_scraped_filename_JPEG_ARRAY);

        // PNG
        $tmp_img_cnt = sizeof($tmp_scraped_filename_PNG_ARRAY);
        for($i = 0; $i < $tmp_img_cnt; $i++){

            $tmp_pos_png = strpos($tmp_scraped_filename_PNG_ARRAY[$i], '.png');
            $tmp_pos_ds_store = strpos($tmp_scraped_filename_PNG_ARRAY[$i], 'DS_Store');

            if(($tmp_pos_png !== false) && ($tmp_pos_ds_store === false)){

                $tmp_filtered_filename_ARRAY[] = $tmp_scraped_filename_PNG_ARRAY[$i];

            }else{

                $tmp_skipped_filename_ARRAY[] = $tmp_scraped_filename_PNG_ARRAY[$i];

            }

        }

        // JPEG
        $tmp_img_cnt = sizeof($tmp_scraped_filename_JPEG_ARRAY);
        for($i = 0; $i < $tmp_img_cnt; $i++){

            $tmp_pos_jpg = strpos($tmp_scraped_filename_JPEG_ARRAY[$i], '.jpg');
            $tmp_pos_jpeg = strpos($tmp_scraped_filename_JPEG_ARRAY[$i], '.jpeg');
            $tmp_pos_jpg2 = strpos($tmp_scraped_filename_JPEG_ARRAY[$i], '.jpg2');
            $tmp_pos_ds_store = strpos($tmp_scraped_filename_JPEG_ARRAY[$i], 'DS_Store');

            if((($tmp_pos_jpg !== false) || ($tmp_pos_jpeg !== false) || ($tmp_pos_jpg2 !== false)) && ($tmp_pos_ds_store === false)){

                $tmp_filtered_filename_ARRAY[] = $tmp_scraped_filename_JPEG_ARRAY[$i];

            }else{

                $tmp_skipped_filename_ARRAY[] = $tmp_scraped_filename_JPEG_ARRAY[$i];

            }

        }

        //$this->oCRNRSTN->print_r('Images count: [' . count($tmp_filtered_filename_ARRAY) . '].', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

        $tmp_oMEDIA_CONVERTOR = new crnrstn_system_image_asset_manager($this->oCRNRSTN);

        foreach($tmp_filtered_filename_ARRAY as $index => $tmp_filename){

            $pos_dot = stripos($tmp_filename, '.');
            if($pos_dot !== false){

                $img_name = '';

                //
                // WE HAVE POTENTIAL FILENAME DOT
                $tmp_filename_ARRAY = explode('.', $tmp_filename);
                $tmp_original_file_extension_clean = array_pop($tmp_filename_ARRAY);   // $tmp_filename IS NOW ARRAY RETURN
                foreach($tmp_filename_ARRAY as $index_img_=> $val_img){

                    $img_name .= $val_img . '.';

                }

                $img_name = $this->oCRNRSTN->strrtrim($img_name, '.');

            }

            if(!isset($tmp_flagged_filename_ARRAY[$img_name])){

                $tmp_current_batch--;


                if($tmp_current_batch < 0){

                    $tmp_current_batch = $tmp_batch_size;
                    $tmp_oMEDIA_CONVERTOR = new crnrstn_system_image_asset_manager($this->oCRNRSTN);

                }

                if($tmp_oMEDIA_CONVERTOR->system_base64_synchronize($tmp_filename)){

                    //$this->oCRNRSTN->print_r('Processed image: [' . $tmp_filename . '].', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
                    $tmp_processed_filename_ARRAY[] = $tmp_filename;
                    $tmp_flagged_filename_ARRAY[$img_name] = 1;

                }

            }

        }

        //$this->oCRNRSTN->print_r('Processed Images [skipped=' . $tmp_skipped . '] [err=' . $tmp_err_cnt . '][' . print_r($tmp_processed_filename_ARRAY, true) . '].', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

        return true;

    }

    public function return_creative($creative_element_key, $image_output_mode = NULL){

        return $this->oCRNRSTN_MEDIA_CONVERTOR->return_creative($creative_element_key, $image_output_mode);

    }

    public function catch_exception($exception_obj, $syslog_constant = LOG_DEBUG, $method = NULL, $namespace = NULL, $output_profile = NULL, $output_profile_override_meta = NULL, $wcr_override_pipe = NULL){

        $tmp_err_trace_str = $this->return_PHP_exception_trace_pretty($exception_obj->getTraceAsString());

        if(strlen($tmp_err_trace_str) > 0){

            $this->error_log('PHP native exception output log trace received ::' . $tmp_err_trace_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        }

        //
        // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
        $this->oLogger->catch_exception($exception_obj, $syslog_constant, $method, $namespace, $output_profile, $output_profile_override_meta, $wcr_override_pipe, $this);

    }

    public function return_PHP_exception_trace_pretty($exception_obj_trace_str, $format = 'ERROR_LOG'){

        switch($format){
            case 'HTML':

                $exception_obj_trace_str = $this->proper_replace('\n', '<br>', $exception_obj_trace_str);
                $exception_obj_trace_str = $this->proper_replace('
', '<br>', $exception_obj_trace_str);

            break;
            case 'TEXT':

                $exception_obj_trace_str = $this->proper_replace('\n', '
', $exception_obj_trace_str);

            break;
            default:

                //
                // DO NOTHING :: STRAIGHT UNPROCESSED PHP NATIVE OUT

            break;

        }

        return $exception_obj_trace_str;

    }

    public function return_lang_content_ARRAY(){

        return self::$lang_content_ARRAY;

    }

    public function strSanitize($str, $type){

        $patterns = array();
        $replacements = array();

        $type = strtolower($type);

        try {

            switch ($type) {
                case 'max_storage_utilization':

                    $patterns[0] = '%';
                    $patterns[1] = 'percent';
                    $patterns[2] = ' ';
                    $patterns[3] = '!';

                    $replacements[0] = '';
                    $replacements[1] = '';
                    $replacements[2] = '';
                    $replacements[3] = '';

                    break;
                case 'email_private':
                    $tmp_new_post_at_ARRAY = array();
                    $clean_str = '';
                    $last_dot_flag = false;
                    $tmp_at_split_ARRAY = explode('@', $str);
                    $tmp_post_at_len = strlen($tmp_at_split_ARRAY[1]);
                    $tmp_str_ARRAY = $this->str_split_unicode($str);
                    $tmp_post_at_str_ARRAY = $this->str_split_unicode($tmp_at_split_ARRAY[1]);
                    $tmp_post_at_str_rev_ARRAY = array_reverse($tmp_post_at_str_ARRAY);

                    //
                    // PREP POST @ SITUATION
                    for($i = 0; $i < $tmp_post_at_len; $i++){

                        if(!$last_dot_flag){

                            if($tmp_post_at_str_rev_ARRAY[$i] == '.'){

                                $last_dot_flag = true;

                            }

                            $tmp_new_post_at_ARRAY[] = $tmp_post_at_str_rev_ARRAY[$i];

                            if($last_dot_flag){

                                $i = $tmp_post_at_len + 420;
                                $tmp_new_post_at_ARRAY = array_reverse($tmp_new_post_at_ARRAY);

                            }

                        }

                    }

                    $tmp_str_len = sizeof($tmp_str_ARRAY);

                    for($i = 0; $i < $tmp_str_len; $i++){

                        if($i == 0){

                            $clean_str .= $tmp_str_ARRAY[$i] . '*****';

                        }else{

                            if($tmp_str_ARRAY[$i] == '@'){

                                $at_flag = true;
                                $tmp_plus_one = $i + 1;
                                $clean_str .= $tmp_str_ARRAY[$i].$tmp_str_ARRAY[$tmp_plus_one] . '*****';
                                $clean_str .= implode($tmp_new_post_at_ARRAY);
                                $i = $tmp_str_len + 420;

                            }

                        }

                    }

                    return $clean_str;

                break;
                case 'custom_mobi_detect_alg':

                    $patterns[0] = '(';
                    $patterns[1] = ')';
                    $replacements[0] = '';
                    $replacements[1] = '';

                break;
                case 'http_protocol_simple':

                    $patterns[0] = '_';
                    $patterns[1] = '$';
                    $patterns[2] = ' ';
                    $replacements[0] = '';
                    $replacements[1] = '';
                    $replacements[2] = '';

                break;
                case 'select_statement':

                    $patterns[0] = "`";
                    $replacements[0] = '';

                break;
                case 'select_field_name':

                    $patterns[0] = "
";
                    $patterns[1] = '"';
                    $patterns[2] = '=';
                    $patterns[3] = '{';
                    $patterns[4] = '}';
                    $patterns[5] = '(';
                    $patterns[6] = ')';
                    $patterns[7] = ' ';
                    $patterns[8] = '    ';
                    $patterns[9] = ',';
                    $patterns[10] = '\n';
                    $patterns[11] = '\r';
                    $patterns[12] = '\'';
                    $patterns[13] = '/';
                    $patterns[14] = '#';
                    $patterns[15] = ';';
                    $patterns[16] = ':';
                    $patterns[17] = '>';

                    $replacements = array();
                    $replacements[0] = '';
                    $replacements[1] = '';
                    $replacements[2] = '';
                    $replacements[3] = '';
                    $replacements[4] = '';
                    $replacements[5] = '';
                    $replacements[6] = '';
                    $replacements[7] = '';
                    $replacements[8] = '';
                    $replacements[9] = '';
                    $replacements[10] = '';
                    $replacements[11] = '';
                    $replacements[12] = '';
                    $replacements[13] = '';
                    $replacements[14] = '';
                    $replacements[15] = '';
                    $replacements[16] = '';
                    $replacements[17] = '';

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unable to determine string sanitization algorithm [' . $type . '] for the content[' . $str . '].');

                break;
            }

            $str = str_replace($patterns, $replacements, $str);

            return $str;


        } catch (Exception $e) {

            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function return_logPriorityPretty($logPriority, $format = 'TEXT'){

        $tmp_output_format = trim(strtoupper($format));

        if($tmp_output_format == 'HTML'){
            //'LOG_EMERG</span>:: system is unusable.</span>'

            switch($logPriority){
                case 0:

                    $tmp_priority_const = 'LOG_EMERG';
                    $tmp_priority_msg = ':: system is unusable.';

                break;
                case 1:

                    $tmp_priority_const = 'LOG_ALERT';
                    $tmp_priority_msg = ':: action must be taken immediately.';

                break;
                case 2:

                    $tmp_priority_const = 'LOG_CRIT';
                    $tmp_priority_msg = ':: critical conditions encountered.';

                break;
                case 3:

                    $tmp_priority_const = 'LOG_ERR';
                    $tmp_priority_msg = ':: error conditions encountered.';

                break;
                case 4:

                    $tmp_priority_const = 'LOG_WARNING';
                    $tmp_priority_msg = ':: warning conditions encountered.';

                break;
                case 5:

                    $tmp_priority_const = 'LOG_NOTICE';
                    $tmp_priority_msg = ':: normal, but significant, condition encountered.';

                break;
                case 6:

                    $tmp_priority_const = 'LOG_INFO';
                    $tmp_priority_msg = ':: informational message.';

                break;
                case 7:

                    $tmp_priority_const = 'LOG_DEBUG';
                    $tmp_priority_msg = ':: debug-level message.';

                break;
                default:

                    $tmp_priority_const = 'UNKNOWN';
                    $tmp_priority_msg = '';

                break;
            }

            $tmp_priority = '<span style="font-family:Arial, Helvetica, sans-serif; font-size:15px; text-align:left; color:#F90000; font-weight: bold;">' . $tmp_priority_const . '</span>&nbsp;<span style="font-family:Arial, Helvetica, sans-serif; font-size:15px; text-align:left; color:#000; font-weight: bold;">' . $tmp_priority_msg . '</span>';

        }else{

            switch($logPriority){
                case 0:

                    $tmp_priority = 'LOG_EMERG :: system is unusable.';

                break;
                case 1:

                    $tmp_priority = 'LOG_ALERT :: action must be taken immediately';

                break;
                case 2:

                    $tmp_priority = 'LOG_CRIT :: critical conditions encountered';

                break;
                case 3:

                    $tmp_priority = 'LOG_ERR :: error conditions encountered';

                break;
                case 4:

                    $tmp_priority = 'LOG_WARNING :: warning conditions encountered';

                break;
                case 5:

                    $tmp_priority = 'LOG_NOTICE :: normal, but significant, condition encountered';

                break;
                case 6:

                    $tmp_priority = 'LOG_INFO :: informational message';

                break;
                case 7:

                    $tmp_priority = 'LOG_DEBUG :: debug-level message';

                break;
                default:

                    $tmp_priority = 'UNKNOWN';

                break;
            }

        }

        return $tmp_priority;

    }

    public function proper_replace($pattern, $replacement, $original_str){

        $pattern_array[0] = $pattern;
        $replacement_array[0] = $replacement;

        $original_str = str_replace($pattern_array, $replacement_array, $original_str);

        return $original_str;

    }

    public function tidy_boolean($val){

        if(is_bool($val) === true){

            return $val;

        }else{

            if(!isset($val)){

                return false;

            }else{

                return $this->boolean_conversion($val);

            }

        }

    }

    /**
     * Check "Booleanic" Conditions :)
     *
     * @param  [mixed]  $variable  Can be anything (string, bool, integer, etc.)
     * @return [boolean]           Returns TRUE  for "1", "true", "on" and "yes"
     *                             Returns FALSE for "0", "false", "off" and "no"
     *                             Returns NULL otherwise.
     *
     * SOURCE :: https://www.php.net/manual/en/function.is-bool.php
     * AUTHOR :: Julio Marchi :: https://www.php.net/manual/en/function.is-bool.php#124179
     */
    public function boolean_conversion($variable = NULL){

        if (!isset($variable)) return null;
        return filter_var($variable, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

    }

    public function string_sanitize($str, $type){

        $patterns = array();
        $replacements = array();

        $type = strtolower($type);

        try {

            switch ($type) {
                case 'max_storage_utilization':

                    $patterns[0] = '%';
                    $patterns[1] = 'percent';
                    $patterns[2] = ' ';
                    $patterns[3] = '!';

                    $replacements[0] = '';
                    $replacements[1] = '';
                    $replacements[2] = '';
                    $replacements[3] = '';

                break;
                case 'email_private':

                    $tmp_new_post_at_ARRAY = array();
                    $clean_str = '';
                    $last_dot_flag = false;
                    $tmp_at_split_ARRAY = explode('@', $str);
                    $tmp_post_at_len = strlen($tmp_at_split_ARRAY[1]);
                    $tmp_str_ARRAY = $this->str_split_unicode($str);
                    $tmp_post_at_str_ARRAY = $this->str_split_unicode($tmp_at_split_ARRAY[1]);
                    $tmp_post_at_str_rev_ARRAY = array_reverse($tmp_post_at_str_ARRAY);

                    //
                    // PREP POST @ SITUATION
                    for($i = 0; $i < $tmp_post_at_len; $i++){

                        if(!$last_dot_flag){

                            if($tmp_post_at_str_rev_ARRAY[$i] == '.'){

                                $last_dot_flag = true;

                            }

                            $tmp_new_post_at_ARRAY[] = $tmp_post_at_str_rev_ARRAY[$i];

                            if($last_dot_flag){

                                $i = $tmp_post_at_len + 420;
                                $tmp_new_post_at_ARRAY = array_reverse($tmp_new_post_at_ARRAY);

                            }

                        }

                    }

                    $tmp_str_len = sizeof($tmp_str_ARRAY);

                    for($i=0; $i<$tmp_str_len; $i++){

                        if($i == 0){

                            $clean_str .= $tmp_str_ARRAY[$i] . '*****';

                        }else{

                            if($tmp_str_ARRAY[$i] == '@'){

                                $at_flag = true;
                                $tmp_plus_one = $i + 1;
                                $clean_str .= $tmp_str_ARRAY[$i].$tmp_str_ARRAY[$tmp_plus_one] . '*****';
                                $clean_str .= implode($tmp_new_post_at_ARRAY);
                                $i = $tmp_str_len + 420;

                            }

                        }

                    }

                    return $clean_str;

                break;
                case 'custom_mobi_detect_alg':

                    $patterns[0] = '(';
                    $patterns[1] = ')';
                    $replacements[0] = '';
                    $replacements[1] = '';

                break;
                case 'http_protocol_simple':

                    $patterns[0] = '_';
                    $patterns[1] = '$';
                    $patterns[2] = ' ';
                    $replacements[0] = '';
                    $replacements[1] = '';
                    $replacements[2] = '';

                break;
                case 'select_statement':

                    $patterns[0] = "`";
                    $replacements[0] = '';

                break;
                case 'select_field_name':

                    $patterns[0] = "
";
                    $patterns[1] = '"';
                    $patterns[2] = '=';
                    $patterns[3] = '{';
                    $patterns[4] = '}';
                    $patterns[5] = '(';
                    $patterns[6] = ')';
                    $patterns[7] = ' ';
                    $patterns[8] = '    ';
                    $patterns[9] = ',';
                    $patterns[10] = '\n';
                    $patterns[11] = '\r';
                    $patterns[12] = '\'';
                    $patterns[13] = '/';
                    $patterns[14] = '#';
                    $patterns[15] = ';';
                    $patterns[16] = ':';
                    $patterns[17] = '>';

                    $replacements = array();
                    $replacements[0] = '';
                    $replacements[1] = '';
                    $replacements[2] = '';
                    $replacements[3] = '';
                    $replacements[4] = '';
                    $replacements[5] = '';
                    $replacements[6] = '';
                    $replacements[7] = '';
                    $replacements[8] = '';
                    $replacements[9] = '';
                    $replacements[10] = '';
                    $replacements[11] = '';
                    $replacements[12] = '';
                    $replacements[13] = '';
                    $replacements[14] = '';
                    $replacements[15] = '';
                    $replacements[16] = '';
                    $replacements[17] = '';

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unable to determine string sanitization algorithm [' . $type . '] for the content[' . $str . '].');

                break;
            }

            $str = str_replace($patterns, $replacements, $str);

            return $str;


        } catch (Exception $e) {

            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function validate_pwd_hash_login($user_submitted_password, $database_result_pwd_hash){

        return password_verify($user_submitted_password, $database_result_pwd_hash);

    }

    public function create_pwd_hash_for_storage($user_submitted_password){

        /**
         * CONSIDER RUNNING benchmark_bestPasswordHashCost() AND THEN UPDATE
         * THIS METHOD, ACCORDINGLY FOR 'cost' => ???
         * You want to set the highest cost that you can without slowing down
         * you server too much. 8-10 is a good baseline, and more is good if your servers
         * are fast enough. benchmark_bestPasswordHashCost() aims for ≤ 50 milliseconds
         * stretching time, which is a good baseline for systems handling interactive logins.
         *
         * Caution :: Using the PASSWORD_BCRYPT as the algorithm, will result in the password
         * parameter being truncated to a maximum length of 72 bytes.
         *
         * PASSWORD_BCRYPT - Use the CRYPT_BLOWFISH algorithm to create the hash. This will
         * produce a standard crypt() compatible hash using the "$2y$" identifier. The result
         * will always be a 60 character string, or false on failure.
         */

        $options = [
            'cost' => 9,
        ];

        return password_hash($user_submitted_password, PASSWORD_BCRYPT, $options);

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.highlight-string.php
    // AUTHOR :: stanislav dot eckert at vizson dot de :: https://www.php.net/manual/en/function.highlight-string.php#118550
    public function highlight_text($text, $theme_style = CRNRSTN_UI_PHPNIGHT){

        return $this->oCRNRSTN->highlight_text($text, $theme_style);

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.str-split.php
    // AUTHOR :: qeremy [atta] gmail [dotta] com :: https://www.php.net/manual/en/function.str-split.php#113274
    public function str_split_unicode($str, $length = 1) {

        $tmp = preg_split('~~u', $str, -1, PREG_SPLIT_NO_EMPTY);

        if ($length > 1) {

            $chunks = array_chunk($tmp, $length);

            foreach ($chunks as $i => $chunk) {

                $chunks[$i] = join('', (array) $chunk);

            }

            $tmp = $chunks;

        }

        return $tmp;

    }

    //
    // SOURCE :: http://php.net/manual/en/function.mkdir.php
    // AUTHOR :: kungla at gmail dot com :: http://php.net/manual/en/function.mkdir.php#68207
    public function mkdir_r($dirName, $mode=777){

        try{

            $mode = octdec(str_pad($mode,4,'0',STR_PAD_LEFT));
            $mode = (int) $mode;

            $dirs = explode('/', $dirName);
            $dir = '';
            foreach($dirs as $part) {

                $dir .= $part . '/';

                if (!is_dir($dir) && strlen($dir) > 0) {

                    if(!mkdir($dir, $mode)){

                        $error = error_get_last();

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception($error['message'] . ' mkdir_r() failed to mkdir :: ' . $dir);

                    }

                }

            }

            return true;

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function input_data_value($data_value, $data_key, $data_type_family, $index, $data_auth_profile, $env_key){

        $this->oCRNRSTN->input_data_value($data_value, $data_key, $data_type_family, $index, $data_auth_profile, $env_key);

    }

    public function return_sticky_link($url, $meta_params_ARRAY = NULL){

        $tmp_array = array();
        $tmp_flag_array = array();

        $tmp_array[] = 'crnrstn_l=crnrstn';
        $tmp_array[] = 'crnrstn_r=' . urlencode($this->data_encrypt($url));
        $tmp_flag_array['crnrstn_l'] = 1;
        $tmp_flag_array['crnrstn_r'] = 1;

        if(isset($meta_params_ARRAY)){

            if(is_array($meta_params_ARRAY)){

                foreach($meta_params_ARRAY as $key => $value){

                    if(!isset($tmp_flag_array[$key])){

                        $tmp_flag_array[$key] = 1;

                        $tmp_array[] = $value;

                    }

                }

            }else{

                if(is_string($meta_params_ARRAY)){

                    if(!isset($tmp_flag_array['crnrstn_m'])){

                        $tmp_flag_array['crnrstn_m'] = 1;

                        $tmp_array[] = 'crnrstn_m=' . urlencode($meta_params_ARRAY);

                    }

                }

            }

        }

        return $this->append_url_param($tmp_array);

    }

    public function explode_url($uri){

        /*
        parse_url()
        This function is intended specifically for the purpose of
        parsing URLs and not URIs. However, to comply with PHP's
        backwards compatibility requirements it makes an exception
        for the file:// scheme where triple slashes (file:///...)
        are allowed. For any other scheme this is invalid.

        This function may not give correct results for relative URLs.

        array(8) {
            ["scheme"]=>
            string(4) "http"
            ["host"]=>
            string(8) "hostname"
            ["port"]=>
            int(9090)
            ["user"]=>
            string(8) "username"
            ["pass"]=>
            string(8) "password"
            ["path"]=>
            string(5) "/path"
            ["query"]=>
            string(9) "arg=value"
            ["fragment"]=>
            string(6) "anchor"
        }


        $str = "first=value&arr[]=foo+bar&arr[]=baz";

        parse_str($str, $output);
        echo $output['first'];  // value
        echo $output['arr'][0]; // foo bar
        echo $output['arr'][1]; // baz

        */

        $tmp_scheme = '';
        $tmp_host = '';
        $tmp_path = '';
        $tmp_url_parse_array = $this->mb_parse_url($uri);

        $tmp_uri_ARRAY = array();

        if(isset($tmp_url_parse_array['scheme'])){

            $tmp_scheme = $tmp_url_parse_array['scheme'];

        }

        if(isset($tmp_url_parse_array['host'])){

            $tmp_host = $tmp_url_parse_array['host'];

        }

        if(isset($tmp_url_parse_array['path'])){

            $tmp_path = $tmp_url_parse_array['path'];

        }

        $tmp_uri_ARRAY['root'] = $tmp_scheme . '://' . $tmp_host . $tmp_path;

        //error_log(__LINE__ . ' user $tmp_url_parse_array=' . print_r($tmp_url_parse_array, true));

        if(isset($tmp_url_parse_array['query'])){

            parse_str($tmp_url_parse_array['query'], $params_ARRAY);

            $tmp_uri_ARRAY['param'] = $params_ARRAY;

        }else{

            $params_ARRAY = array();
            $tmp_uri_ARRAY['param'] = $params_ARRAY;

        }

        return $tmp_uri_ARRAY;

    }

    public function append_url_param($param_ARRAY, $tunnel_encrypt = true, $no_encrypt_param_ARRAY = NULL, $include_no_encrypt = true){

        //error_log(__LINE__ . ' user append_url_param=' . print_r($param_ARRAY, true));

        if($this->isSSL()){

            $tmp_lnk = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        }else{

            $tmp_lnk = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        }

        $tmp_lnk_explode_ARRAY = $this->explode_url($tmp_lnk);

        /*
        $tmp_lnk_explode_ARRAY['root']
        $tmp_lnk_explode_ARRAY['param']

        echo $tmp_lnk_explode_ARRAY['param']['first'];  // value
        echo $tmp_lnk_explode_ARRAY['param']['arr'][0]; // foo bar
        echo $tmp_lnk_explode_ARRAY['param']['arr'][1]; // baz
        */

        $tmp_flag_param_ARRAY = array();
        $tmp_encrypted_params_pipe = '';
        $tmp_return_str = $tmp_lnk_explode_ARRAY['root'];

        $param_concatenator = '?';

        //
        // ADD ANY *NEW* URL PARAMS
        foreach($param_ARRAY as $key => $value){

            //if(!isset($tmp_flag_param_ARRAY[$this->return_param_name($value)]) && ($key != 'crnrstn_encrypt_tunnel')){
            if($this->return_param_name($value) != 'crnrstn_encrypt_tunnel'){

                $tmp_flag_param_ARRAY[$this->return_param_name($value)] = 1;

                $tmp_return_str .= $param_concatenator . $this->url_param_append($value, $tunnel_encrypt);

                if($tunnel_encrypt){

                    $tmp_encrypted_params_pipe .= $key . '|';

                }

                if($param_concatenator == '?'){

                    $param_concatenator = '&';

                }

            }

        }

        if(isset($no_encrypt_param_ARRAY) && $include_no_encrypt == true){

            foreach($no_encrypt_param_ARRAY as $key => $value){

                //if(!isset($tmp_flag_param_ARRAY[$this->return_param_name($value)]) && ($key != 'crnrstn_encrypt_tunnel')){
                if($this->return_param_name($value) != 'crnrstn_encrypt_tunnel'){

                    $tmp_flag_param_ARRAY[$this->return_param_name($value)] = 1;

                    $tmp_return_str .= $param_concatenator . $this->url_param_append($value, false);

                    if($tunnel_encrypt){

                        $tmp_encrypted_params_pipe .= $key . '|';

                    }

                    if($param_concatenator == '?'){

                        $param_concatenator = '&';

                    }

                }

            }

        }

        //
        // KEEP ALL ORIGINAL URL PARAMS
        foreach($tmp_lnk_explode_ARRAY['param'] as $key00 => $value00){

            if(!isset($tmp_flag_param_ARRAY[$key00]) && ($key00 != 'crnrstn_encrypt_tunnel')){

                if(isset($no_encrypt_param_ARRAY) && $include_no_encrypt == false){

                    $tmp_spoiled = false;

                    foreach ($no_encrypt_param_ARRAY as $key01 => $value01) {

                        if ($key01 == $key00) {

                            $tmp_spoiled = true;

                        }

                    }

                    if(!$tmp_spoiled){

                        $tmp_flag_param_ARRAY[$key00] = 1;

                        $tmp_return_str .= $param_concatenator . $this->url_param_append($key00 . '=' . $value00, $tunnel_encrypt);

                        if($tunnel_encrypt){

                            $tmp_encrypted_params_pipe .= $key00 . '|';

                        }

                        if($param_concatenator == '?'){

                            $param_concatenator = '&';

                        }

                    }

                }else{

                    $tmp_flag_param_ARRAY[$key00] = 1;

                    $tmp_return_str .= $param_concatenator . $this->url_param_append($key00 . '=' . $value00, $tunnel_encrypt);

                    if($tunnel_encrypt){

                        $tmp_encrypted_params_pipe .= $key00 . '|';

                    }

                    if($param_concatenator == '?'){

                        $param_concatenator = '&';

                    }

                }

            }

        }

        if(isset($no_encrypt_param_ARRAY)){

            foreach($no_encrypt_param_ARRAY as $key => $value00){

                $tmp_flag_param_ARRAY[$this->return_param_name($value00)] = 1;

                $tmp_return_str .= $param_concatenator . $this->url_param_append($value00, false);

            }

        }

        if($tunnel_encrypt){

            $tmp_return_str .= $param_concatenator . 'crnrstn_encrypt_tunnel=' . urlencode($this->data_encrypt($tmp_encrypted_params_pipe));

        }

        return $tmp_return_str;

    }

    private function url_param_append($param_str, $tunnel_encrypt){

        if($tunnel_encrypt){

            $tmp_str = '';
            $tmp_array = explode('=', $param_str);

            $tmp_str .= $tmp_array[0];
            $tmp_str .= '=';

            if(isset($tmp_array[1])){

                //
                // EXCLUDE crnrstn_m FROM ENCRYPTION FOR LINK IDENTIFICATION WITHIN ANALYTICS
                if($tmp_array[0] != 'crnrstn_m'){

                    $tmp_str .= urlencode($this->data_encrypt($tmp_array[1]));

                }else{

                    $tmp_str .= $tmp_array[1];

                }

            }else{

                $tmp_str .= $this->data_encrypt('');

            }

            return $tmp_str;

        }else{

            $tmp_str = '';
            $tmp_array = explode('=', $param_str);

            $tmp_str .= $tmp_array[0];
            $tmp_str .= '=';

            if(isset($tmp_array[1])){

                $tmp_str .= urlencode($tmp_array[1]);

            }

            return $tmp_str;

        }

    }

    private function return_param_name($param_str){

        $tmp_array = explode('=', $param_str);

        return $tmp_array[0];

    }

    //
    // SOURCE :: https://stackoverflow.com/questions/5100189/use-php-to-check-if-page-was-accessed-with-ssl
    // AUTHOR :: https://stackoverflow.com/users/887067/saeven
    public function isSSL(){

        if( !empty( $_SERVER['HTTPS'] ) && ($_SERVER['HTTPS'] != 'off') )
            return true;

        if( !empty( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' )
            return true;

        return false;

    }

    /**
     * UTF-8 aware parse_url() replacement.
     *
     * @return array
     *
     * SOURCE :: https://www.php.net/manual/en/function.parse-url.php
     * AUTHOR :: lauris () lauris ! lv :: https://www.php.net/manual/en/function.parse-url.php#114817
     */
    private function mb_parse_url($url){

        $enc_url = preg_replace_callback(
            '%[^:/@?&=#]+%usD',
            function ($matches)
            {
                return urlencode($matches[0]);
            },
            $url
        );

        $parts = parse_url($enc_url);

        if($parts === false){

            throw new \InvalidArgumentException('Malformed URL: ' . $url);

        }

        foreach($parts as $name => $value){

            $parts[$name] = urldecode($value);

        }

        return $parts;

    }

    public function __destruct() {

        $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('goodbye crnrstn :: ' . __CLASS__ . '::' . __METHOD__ . ' called. [rtime ' . $this->wall_time() . ' secs][bytes_encrypted ' . $this->oCRNRSTN->format_bytes($this->total_bytes_encrypted, 5) . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);

    }

}

# # C # R # N # R # S # T # N # : : # # ##
#  CLASS :: crnrstn_administrative_account
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: Tuesday Feb 16, 2021 @ 2242hrs
#  DESCRIPTION :: Holds administrative account access credentials for CRNRSTN ::.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
class crnrstn_administrative_account {

    protected $oLogger;
    protected $oCRNRSTN_n;

    protected $email;
    protected $pwdhash;
    protected $ttl;
    protected $max_login_attempts = 10;
    protected $max_seconds_inactive = 10;
    protected $session_start_time;
    protected $last_modified_date;
    protected $session_ip_address;

    protected $is_logged_in = false;
    protected $serial;

    public function __construct($oCRNRSTN_ENV, $email, $pwdhash, $ttl, $max_login_attempts, $max_seconds_inactive) {

        $this->oCRNRSTN_n = $oCRNRSTN_ENV;
        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN_n);

        $this->email = $email;
        $this->pwdhash = $pwdhash;
        $this->ttl = $ttl;
        $this->max_login_attempts = $max_login_attempts;
        $this->max_seconds_inactive = $max_seconds_inactive;
        $this->session_ip_address = $this->oCRNRSTN_n->oCRNRSTN_IPSECURITY_MGR->clientIpAddress();

        $this->serial = $this->oCRNRSTN_n->hash(trim(strtolower($email)), 'md5');

        $this->oCRNRSTN_n->oLog_output_ARRAY[] = $this->oCRNRSTN_n->error_log('Instantiating an administrative account with email=' . $this->oCRNRSTN_n->string_sanitize($this->email, 'email_private') . ' for the ' . $this->oCRNRSTN_n->env_key . ' environment.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        $this->refresh_modified_date();

    }

    private function refresh_modified_date(){

        $this->last_modified_date = $this->oCRNRSTN_n->return_micro_time();

    }

//    public function return_session_ip_address(){
//
//        return $this->session_ip_address;
//
//    }

//    public function maintain_valid_session(){
//
//
//        if($this->monitor_inactivity() && $this->monitor_ip_address() && $this->is_logged_in){
//
//            $this->refresh_modified_date();
//
//            return true;
//
//        }else{
//
//            return false;
//
//        }
//
//    }

//    private function monitor_inactivity(){
//
//        if($this->max_seconds_inactive < $this->oCRNRSTN_n->elapsed_from_current(strtotime($this->last_modified_date))){
//
//            return false;
//
//        }else{
//
//            return true;
//
//        }
//
//    }

//    private function monitor_ip_address(){
//
//        if($this->session_ip_address != $this->oCRNRSTN_n->oCRNRSTN_IPSECURITY_MGR->clientIpAddress()){
//
//            return false;
//
//        }else{
//
//            return true;
//
//        }
//
//    }

    public function account_get_resource($data_type){

        $data_type = strtolower(trim($data_type));

        switch($data_type){
            case 'serial':

                return $this->serial;

            break;
            case 'email':

                return $this->email;

            break;
            case 'ttl':

                return $this->ttl;

            break;
            case 'max_login_attempts':

                return $this->max_login_attempts;

            break;
            case 'max_seconds_inactive':

                return $this->max_seconds_inactive;

            break;
            case 'session_start_time':

                return $this->session_start_time;

            break;
            case 'session_ip_address':

                return $this->session_ip_address;

            break;
            default:

                return -1;

            break;
        }

    }

    public function is_valid($email, $pwd_hash){

        $tmp_email_lower = trim(strtolower($email));
        $tmp_sys_email_lower = $this->email;

        if (strcmp($tmp_email_lower, $tmp_sys_email_lower) !== 0) {

            return false;

        }else{

            $tmp_config_pwd_hash_cmp = $this->oCRNRSTN_n->create_pwd_hash_for_storage($this->pwdhash);

            if($this->oCRNRSTN_n->validate_pwd_hash_login($pwd_hash, $tmp_config_pwd_hash_cmp)){

                $this->session_start_time = $this->oCRNRSTN_n->return_micro_time();

                return true;

            }

        }

        return false;

    }

    public function is_logged_in($status_override = NULL){

        if(!isset($status_override)){

            return $this->is_logged_in;

        }else{

            if(is_bool($status_override)){

                $this->is_logged_in = $status_override;

            }else{

                return false;

            }

            return true;

        }

    }

    public function return_serial(){

        return $this->serial;

    }

    public function return_max_login_attempts(){

        return $this->max_login_attempts;

    }

    public function return_seconds_inactive(){

        return $this->max_seconds_inactive;

    }

    public function __destruct() {

    }

}

# # C # R # N # R # S # T # N # : : # # ##
#  CLASS :: crnrstn_wildcard_resource
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: Monday Sept 7, 2020 @ 1539hrs
#  DESCRIPTION :: This is version 1.0 of the CRNRSTN :: Decoupled Data Object.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
class crnrstn_wildcard_resource {

    protected $oLogger;
    private static $oCRNRSTN_n;

    protected $oDataTransportLayer;

    protected $env_key;
    protected $resource_key;
    protected $attribute_key_ARRAY = array();
    protected $attribute_datatype_ARRAY = array();
    protected $attribute_set_flag_ARRAY = array();

    public function __construct($resource_key, $oCRNRSTN) {

        // $oCRNRSTN OR $oCRNRSTN_ENV or $oCRNRSTN_USR
        self::$oCRNRSTN_n = $oCRNRSTN;
        $this->oLogger = new crnrstn_logging(__CLASS__, self::$oCRNRSTN_n);

        if(get_class($oCRNRSTN) != 'crnrstn'){

            $this->env_key = self::$oCRNRSTN_n->env_key;
            //error_log('1476 [' .  get_class($oCRNRSTN).']['.$this->env_key .  '] - '. __CLASS__);

        }

        $this->resource_key = $resource_key;
        self::$oCRNRSTN_n->oLog_output_ARRAY[] = self::$oCRNRSTN_n->error_log('Instantiating a ' . $resource_key . ' wild card resource for the ' . $this->env_key . ' environment.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        $this->oDataTransportLayer = new crnrstn_decoupled_data_object(self::$oCRNRSTN_n, $this->resource_key, 'WCR_RESOURCE_KEY');

    }

    public function return_resource_key(){

        return $this->resource_key;

    }

    public function add_attribute($attribute_key, $attribute_value){

        //self::$oCRNRSTN_n->oLog_output_ARRAY[] = self::$oCRNRSTN_n->error_log('Adding ->' . $attribute_key . '<- data attribute to the ' . $this->resource_key . ' wild card resource for the ' . $this->env_key . ' environment.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $env_key_hash = self::$oCRNRSTN_n->hash($this->resource_key);
        $attribute_key_crc = self::$oCRNRSTN_n->hash($attribute_key);

        $this->oDataTransportLayer->add($attribute_value, $attribute_key);
        $this->attribute_key_ARRAY[$env_key_hash][$attribute_key_crc] = $attribute_value;
        //error_log(__LINE__ . ' env add_attribute name[' . $attribute_key . '|' . self::$oCRNRSTN_n->crcINT($attribute_key) . '] val[' . print_r($attribute_value, true) . ']');
        $this->attribute_set_flag_ARRAY[$env_key_hash][$attribute_key_crc] = 1;

    }

    public function isset_WCR($WCR_key, $attribute_key){

        $tmp_wc_key_crc = self::$oCRNRSTN_n->hash($WCR_key);
        $attribute_key_crc = self::$oCRNRSTN_n->hash($attribute_key);

        if(isset($this->attribute_set_flag_ARRAY[$tmp_wc_key_crc][$attribute_key_crc])){

            return true;

        }else{

            return false;

        }

    }

    // USED IN CONTEXT OF "GET A VALUE"
    public function get_attribute($wildCardKey, $attribute_key, $soap_transport = false){

        //
        // THROWING AN EXCEPTION HERE CAN CAUSE ETERNAL LOOP.
        //try{
        $tmp_wc_key_crc = self::$oCRNRSTN_n->hash($wildCardKey);
        $attribute_key_crc = self::$oCRNRSTN_n->hash($attribute_key);

        if($soap_transport){

            //error_log(__LINE__ . ' env - [' . $wildCardKey . '] ' . $attribute_key);
            $tmp_data_type = strtolower($this->get_data_type($wildCardKey, $attribute_key));
            $tmp_data = $this->attribute_key_ARRAY[$tmp_wc_key_crc][$attribute_key_crc];
            //error_log(__LINE__ . ' env - [' . $tmp_data_type . '] ' . $tmp_data);

            switch($tmp_data_type){
                case 'bool':
                case 'boolean':

                    if($tmp_data){

                        error_log(__METHOD__ . ' ' . __LINE__ . ' TRACE THIS BOOLEAN REFACTOR [STRING ==> INT(1)] TO THE CRNRSTN :: SOAP SERVICES LAYER...AND THEN DELETE THIS TRACE.');
                        return 1;

                    }else{

                        error_log(__METHOD__ . ' ' . __LINE__ . ' TRACE THIS BOOLEAN REFACTOR [STRING ==> INT(0)] TO THE CRNRSTN :: SOAP SERVICES LAYER...AND THEN DELETE THIS TRACE.');
                        return 0;

                    }

                break;
                default:

                    return $tmp_data;

                break;

            }

        }else{

            /*

            $env_key_hash = self::$oCRNRSTN_n->hash($this->resource_key);
            $attribute_key_crc = self::$oCRNRSTN_n->hash($attribute_key);

            $this->oDataTransportLayer->add($attribute_value, $attribute_key);
            $this->attribute_key_ARRAY[$env_key_hash][$attribute_key_crc] = $attribute_value;
             * */

            //if(isset($this->attribute_key_ARRAY[$tmp_wc_key_crc][$attribute_key_crc])){

                //
                // FULL CONVERSION TO DDO :: Tuesday, April 20, 2021 1254hrs
                // "Cause I don't send my music to no garbage DJs
                // They get me." - KRS ONE
                // SOURCE :: https://www.youtube.com/watch?v=fTmDeRsS9to
                // TITLE :: Krs One - Mad Crew

                return $this->oDataTransportLayer;

            //}else{

            //    error_log(__LINE__ .' env die() ['.$tmp_wc_key_crc.']['.$attribute_key_crc.'] attribute_key_ARRAY='.print_r($this->attribute_key_ARRAY, true));

            //    die();
                //
                // HOOOSTON...VE HAF PROBLEM!
                //throw new Exception('An unknown wild card resource by attribute key, "'.$attribute_key.'" and by wild card key '.$wildCardKey.' has been requested.');
            //    self::$oCRNRSTN_n->error_log('An unknown wild card resource by wild card key '.$wildCardKey.' and by attribute key, "'.$attribute_key.'" has been requested.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

           //     return false;

            //}

        }

    }

    public function get_data_type($wildCardKey, $attribute_key){

        //
        // THROWING AN EXCEPTION HERE CAN CAUSE ETERNAL LOOP.
        //try{

        $tmp_wc_key_crc = self::$oCRNRSTN_n->hash($wildCardKey);
        $attribute_key_crc = self::$oCRNRSTN_n->hash($attribute_key);

        if(isset($this->attribute_key_ARRAY[$tmp_wc_key_crc][$attribute_key_crc])){

            if(isset($this->attribute_datatype_ARRAY[$tmp_wc_key_crc][$attribute_key_crc])){

                return $this->attribute_datatype_ARRAY[$tmp_wc_key_crc][$attribute_key_crc];

            }else{

                $tmp_data = $this->attribute_key_ARRAY[$tmp_wc_key_crc][$attribute_key_crc];

                $this->attribute_datatype_ARRAY[$tmp_wc_key_crc][$attribute_key_crc] = gettype($tmp_data);

                return $this->attribute_datatype_ARRAY[$tmp_wc_key_crc][$attribute_key_crc];

            }

        }else{

            //
            // HOOOSTON...VE HAF PROBLEM!
            //throw new Exception('An unknown wild card resource by attribute key, "' . $attribute_key . '" and by wild card key ' . $wildCardKey . ' has been requested.');
            self::$oCRNRSTN_n->error_log('Data type for an unknown wild card resource by wild card key "' . $wildCardKey . '" and attribute key, "' . $attribute_key . '" has been requested.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

            return NULL;

        }

    }

    public function __destruct() {

    }

}

# # C # R # N # R # S # T # N # : : # # ##
#  CLASS :: crnrstn_decoupled_data_object
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: Monday November 3, 2020 @ 2035hrs
#  DESCRIPTION :: Enhance data portability and meta integrity by storing variable data as objects.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
class crnrstn_decoupled_data_object {

    protected $oLogger;
    public $oCRNRSTN;
    public $oCRNRSTN_USR;

    public $ttl_profile_ARRAY = array();
    public $data_auth_profile_ARRAY = array();
    public $data_value_ARRAY = array();
    public $data_type_ARRAY = array();
    public $data_flag_ARRAY = array();
    protected $data_type_lock;
    protected $data_type;
    protected $total_bytes_stored = 0;

    public $soap_encrypt_cipher;
    public $soap_encrypt_secret_key;
    public $soap_encrypt_hmac_alg;
    public $soap_encrypt_options;
    public $soap_encrypt_digest;

    protected $soap_decrypt_cipher;
    protected $soap_decrypt_secret_key;
    protected $soap_decrypt_hmac_alg;
    protected $soap_decrypt_options;
    protected $soap_decrypt_digest;

    public function __construct($oCRNRSTN_n, $data_value = NULL, $data_key = NULL, $data_auth_profile = CRNRSTN_AUTHORIZE_RUNTIME_ONLY, $data_type_lock = false) {

        $this->oCRNRSTN = $oCRNRSTN_n;

        if(get_class($oCRNRSTN_n) == 'crnrstn_user'){

            //error_log(__LINE__ . ' env ' . __METHOD__ . ' $oCRNRSTN_n=[' . get_class($oCRNRSTN_n) . ']');

            $this->oCRNRSTN_USR = $oCRNRSTN_n;
            $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN_USR);

        }else{

            //error_log(__LINE__ . ' env ' . __METHOD__ . ' $oCRNRSTN_n=[' . get_class($oCRNRSTN_n) . ']');
            $this->oCRNRSTN = $oCRNRSTN_n;
            $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN);

        }

        $this->data_type_lock = $data_type_lock;

        if($this->data_type_lock){

            $this->data_type = strtolower(gettype($data_value));

        }

        if(!isset($data_key)){

            $data_key = '';

        }

        if(is_bool($data_value) === true){

            $this->data_type_ARRAY[$data_key][] = 'bool';
            $this->data_flag_ARRAY[$data_key][] = 1;

        }else{

            $this->data_type_ARRAY[$data_key][] = strtolower(gettype($data_value));
            $this->data_flag_ARRAY[$data_key][] = 1;

        }

        /*
        // https://www.php.net/manual/en/function.gettype.php
        gettype()
        Possible values for the returned string are:
            "bool"
            "int"
            "double" (for historical reasons "double" is returned in case of a float, and not simply "float")
            "string"
            "array"
            "object"
            "resource"
            "resource (closed)" as of PHP 7.2.0
            "NULL"
            "unknown type"

        // https://www.php.net/manual/en/language.types.type-juggling.php#language.types.typecasting
        The casts allowed are:
            (int), (integer) - cast to int
            (bool), (boolean) - cast to bool
            (float), (double), (real) - cast to float
            (string) - cast to string
            (array) - cast to array
            (object) - cast to object
            (unset) - cast to NULL. The (unset) cast has been deprecated as
                of PHP 7.2.0. Note that the (unset) cast is the same as
                assigning the value NULL to the variable or call. The (unset)
                cast is removed as of PHP 8.0.0.
         * */

        switch($this->data_type_ARRAY[$data_key]){
            case 'int':

                $this->data_auth_profile_ARRAY[$data_key][] = $data_auth_profile;
                $this->data_type_ARRAY[$data_key][] = (int) $data_value;
                $this->data_value_ARRAY[$data_key][] = (int) $data_value;

            break;
            case 'integer':

                $this->data_auth_profile_ARRAY[$data_key][] = $data_auth_profile;
                $this->data_value_ARRAY[$data_key][] = (integer) $data_value;

            break;
            case 'bool':
            case 'boolean':

                if($data_value){

                    $this->data_auth_profile_ARRAY[$data_key][] = $data_auth_profile;
                    $this->data_value_ARRAY[$data_key][] = 'true';

                }else{

                    $this->data_auth_profile_ARRAY[$data_key][] = $data_auth_profile;
                    $this->data_value_ARRAY[$data_key][] = 'false';

                }

            break;
            case 'double':

                $this->data_auth_profile_ARRAY[$data_key][] = $data_auth_profile;
                $this->data_value_ARRAY[$data_key][] = (double) $data_value;

            break;
            case 'float':

                $this->data_auth_profile_ARRAY[$data_key][] = $data_auth_profile;
                $this->data_value_ARRAY[$data_key][] = (float) $data_value;

            break;
            case 'string':

                $this->data_auth_profile_ARRAY[$data_key][] = $data_auth_profile;
                $this->data_value_ARRAY[$data_key][] = (string) $data_value;

            break;
            case 'array':

                $this->data_auth_profile_ARRAY[$data_key][] = $data_auth_profile;
                $this->data_value_ARRAY[$data_key][] = (array) $data_value;

            break;
            case 'object':

                $this->data_auth_profile_ARRAY[$data_key][] = $data_auth_profile;
                $this->data_value_ARRAY[$data_key][] = (object) $data_value;

            break;
            case 'resource':

                $this->data_auth_profile_ARRAY[$data_key][] = $data_auth_profile;
                $this->data_value_ARRAY[$data_key][] = $data_value;

            break;
            case 'resource (closed)':

                $this->data_auth_profile_ARRAY[$data_key][] = $data_auth_profile;
                $this->data_value_ARRAY[$data_key][] = $data_value;

            break;
            case 'null':

                $this->data_auth_profile_ARRAY[$data_key][] = $data_auth_profile;
                $this->data_value_ARRAY[$data_key][] = NULL;

            break;
            case 'unknown type':

                $this->data_auth_profile_ARRAY[$data_key][] = $data_auth_profile;
                $this->data_value_ARRAY[$data_key][] = $data_value;

            break;
            default:

                $this->data_auth_profile_ARRAY[$data_key][] = $data_auth_profile;
                $this->data_value_ARRAY[$data_key][] = $data_value;

            break;

        }

    }

    public function return_total_bytes_stored(){

        return $this->total_bytes_stored;

    }

    public function count($data_key){

        if(strlen($this->oCRNRSTN->get_server_env()) > 0){

            //$this->oCRNRSTN->print_r('$data_key=[' . $data_key . ']. . $this->data_value_ARRAY=[' . print_r($this->data_value_ARRAY, true) . ']. $tmp_db_profile_cnt=[' . $tmp_db_profile_cnt . ']', 'Output title.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

            $tmp_cnt = sizeof($this->data_value_ARRAY[$data_key]);

            return $tmp_cnt;

        }

        return false;

    }

    public function report($ddo_attribute = 'total_count'){

        return count($this->data_flag_ARRAY);

    }

    public function ttutu(){

        foreach($this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY as $index => $data_key_hash){

            $tmp_str .= $this->oCRNRSTN->oCRNRSTN_CONFIG_MGR->oCRNRSTN_CONFIG_DDO->preach('crnrstn_data_packet', $data_key_hash, CRNRSTN_OUTPUT_PSSDTLA, $index = 0);

        }



    }

    public function preach($data_attribute = 'value', $data_key = NULL, $data_auth_request = CRNRSTN_OUTPUT_RUNTIME, $index = 0){

        //error_log(__LINE__ . ' env ddo->' . __METHOD__ . ':: $index=' . $index . ' $data_attribute=' . $data_attribute  . '. $data_key=' . $data_key . '.');
        //error_log(__LINE__ . ' env ddo->' . __METHOD__ . ':: $this->data_value_ARRAY=' . print_r($this->data_value_ARRAY, true) . '.');
        //error_log(__LINE__ . ' env ddo $data_attribute=[' . $data_attribute . ']. $data_key=[' . $data_key . ']. $soap_transport=[' . $soap_transport . ']. $index=[' . $index . '].');

//        if($data_key == 'ac7971ddce7e6720466d7fb07d03cdf6fd017a508d87ac7132d7d5d11a34f077db'){
//
//            $this->oCRNRSTN->print_r('$data_value=[' . $data_value . ']. $data_key=[' . $data_key . ']. $index=[' . $index . '].', NULL, CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
//
//            $tmp_array = array();
//            $tmp_array[] = '12345';
//            $tmp = strlen($tmp_array);
//
//            die();
//
//        }

        if(isset($this->data_auth_profile_ARRAY[$data_key][$index])){

            if(!$this->oCRNRSTN->isset_auth_profile($data_auth_request, $this->data_auth_profile_ARRAY[$data_key][$index])){

                return $this->oCRNRSTN->session_salt();

            }

        }

        if(!isset($data_key)){

            $data_key = '';

        }

        switch($data_attribute){
            case 'crnrstn_data_packet':

                $tmp_count = 0;
                $line_wrap = $tmp_line_wrap_cnt = 3;

                $tmp_crnrstn_data_packet_out = '"crnrstn_data_packet" : [
                        ';
                $tmp_data_packet_parameter_out = '"crnrstn_data_packet_parameters" : [
                        ';

                $tmp_str = '';

                foreach($this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY as $fihp_index => $fihp_data_key){

                    $tmp_str .= $this->preach('pssdtl_packet', $fihp_data_key, $data_auth_request);

                }

                $tmp_str = $this->oCRNRSTN->strrtrim($tmp_str, ',');

                $tmp_close = '
                ]';

                return $tmp_crnrstn_data_packet_out . $tmp_data_packet_parameter_out . $tmp_str . $tmp_close . $tmp_close;

            break;
            case 'pssdtl_packet';

                $tmp_str_out = '';

//                $tmp_count = 0;
//                $tmp_meta_str_out = '';
//                $tmp_str_out = '';
//                $line_wrap = $tmp_line_wrap_cnt = 3;
//
//                $tmp_meta_str_out .= '"crnrstn_system_configuration_parameter_index" : [
//                        ';
//                $tmp_str_out .= '"crnrstn_system_configuration_parameter" : [
//                        ';



                    // WE DO NOT PASS DATA VALUE (OR SENSITIVE META ABOUT VALUE) TO CLIENT...IF ANYTHING SAVE PSSDTLP.
                    // AND I IMAGINE THE SAME KIND OF RULES WOULD APPLY TO SSDTLP
                    if(isset($this->data_value_ARRAY[$data_key][$index])){

                        $tmp_val = $this->data_value_ARRAY[$data_key][$index];
                        $tmp_val_len = strlen($tmp_val);

                    }

                    //
                    // Friday, August 5, 2022 2241 hrs
                    // IF WE'RE TALKING SSDTLP, THEN WE NEED TO FUCK WITH SOAP
                    // OBJECTS NOW (YEAH, FUCK JSON!)...WHICH I AM NOT...AT THE MOMENT.
                    //
                    // Sunday, September 11, 2022 0230 hrs.
                    // WE WILL WRAP THE PSSDTL WITH THE SSDTL. SO SOAP-WRAPPED PSSDTLP IS #WINNING.
                    // A CRNRSTN :: DATA PACKET IS AN ENCRYPTED JSON OBJECT WRAPPED IN A SOAP OBJECT. FUCK YEAH! JSON!
                    // CRNRSTN :: DATA PACKET IS A THING NOW.

                    error_log(__LINE__ . ' ddo packet $data_key=[' . $data_key . ']. $index=[' . $index . ']. ttl_profile_ARRAY=[' . print_r($this->ttl_profile_ARRAY[$data_key], true) . '].');
                    error_log(__LINE__ . ' ddo packet TYPE=[' . $this->data_type_ARRAY[$data_key][$index] . '] BYTES=[' . $tmp_val_len . '] TTL=[' . $this->oCRNRSTN->return_clean_json_string($this->ttl_profile_ARRAY[$data_key][$index]) . '] AUTH_PROFILE=[' . $this->oCRNRSTN->return_clean_json_string($this->data_auth_profile_ARRAY[$data_key][$index]) . ']');
                    $tmp_str_out .= '
                    {
                        "HASH" : "' . $this->oCRNRSTN->hash($data_key . $this->oCRNRSTN->hash($this->data_value_ARRAY[$data_key][$index], 'md5') . $this->data_type_ARRAY[$data_key][$index], 'md5') . '",
                        "BYTES" : "' . $tmp_val_len . '",
                        "KEY" : "' . $this->oCRNRSTN->return_clean_json_string($data_key) . '",
                        "TYPE" : "' . $this->data_type_ARRAY[$data_key][$index] . '",
                        "VALUE" : ' . $this->oCRNRSTN->return_clean_json_string($tmp_val) . ',
                        "TTL" : ' . $this->oCRNRSTN->return_clean_json_string($this->ttl_profile_ARRAY[$data_key][$index]) . ',
                        "AUTH_PROFILE" : ' . $this->oCRNRSTN->return_clean_json_string($this->data_auth_profile_ARRAY[$data_key][$index]) . '
                    },';

                    error_log(__LINE__ . ' ddo type=[' . $this->data_type_ARRAY[$data_key][$index] . '].');

                return $tmp_str_out;

            break;
            case 'isset':

                if(isset($this->data_flag_ARRAY[$data_key][$index])){

                    return $this->data_flag_ARRAY[$data_key][$index];

                }else{

                    return false;

                }

            break;
            case 'auth_profile':

                return $this->data_auth_profile_ARRAY[$data_key][$index];

            break;
            case 'type':

                return $this->data_type_ARRAY[$data_key][$index];

            break;
            case 'value':

                //if($data_key == '1832337717::2678415634::404079999::version_php'){

                    //error_log(__LINE__ . ' env ' . __METHOD__ . ':: [' . $index . ']' . $data_key . '.');

                //}

                //if($data_key == '6780e3fb74e6d79e416ede7df352e02400fe55271e3959ba0996cb47b525cac8db'){

                    //$this->oCRNRSTN->print_r('$data_key=[' . $data_key . ']. $index=[' . $index . '].', NULL, CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
                    //error_log(__LINE__ . ' env DDO::' . __METHOD__ . '() $data_key=[' . $data_key . ']. $index=[' . $index . '].');
                //}

                if(isset($this->data_value_ARRAY[$data_key][$index])){

                    switch($this->data_type_ARRAY[$data_key][$index]){
                        case 'int':

                            return (int) $this->data_value_ARRAY[$data_key][$index];

                        break;
                        case 'integer':

                            return (integer) $this->data_value_ARRAY[$data_key][$index];

                        break;
                        case 'bool':

                            if($data_auth_request == CRNRSTN_OUTPUT_SOAP){

                                return $this->data_value_ARRAY[$data_key][$index];

                            }else{

                                return $this->oCRNRSTN->boolean_conversion($this->data_value_ARRAY[$data_key][$index]);

                            }

                        break;
                        case 'boolean':

                            if($data_auth_request == CRNRSTN_OUTPUT_SOAP){

                                return $this->data_value_ARRAY[$data_key][$index];

                            }else{

                                return $this->oCRNRSTN->boolean_conversion($this->data_value_ARRAY[$data_key][$index]);

                            }

                        break;
                        case 'float':

                            return (float) $this->data_value_ARRAY[$data_key][$index];

                        break;
                        case 'double':

                            return (double) $this->data_value_ARRAY[$data_key][$index];

                        break;
                        case 'real':

                            return (float) $this->data_value_ARRAY[$data_key][$index];

                        break;
                        case 'string':

                            return (string) $this->data_value_ARRAY[$data_key][$index];

                        break;
                        case 'array':

                            return (array) $this->data_value_ARRAY[$data_key][$index];

                        break;
                        case 'object':

                            return (object) $this->data_value_ARRAY[$data_key][$index];

                        break;
                        case 'NULL':

                            return NULL;

                        break;
                        default:

                            //error_log(__LINE__ .' env ddo - RETURN DEFAULT ['.$data_key.']');
                            return $this->data_value_ARRAY[$data_key][$index];

                        break;

                    }

                }else{

                    //
                    // TODO :: SHOULD THIS RETURN SOMETHING TIED TO THE SESSION FOR PROPER
                    // TODO :: DETERMINATION OF "NO DATA TO RETURN"
                    // BOOLEAN FALSE WILL RETURN (string) 'false'
                    //error_log(__LINE__ .' env ddo - return false... NOT SET ['.$data_key.']');
                    //return false;
                    return $this->oCRNRSTN->session_salt('NO_MATCH');

                }

            break;
            default:

                //error_log(__LINE__ .' env ddo - RETURN DEFAULT VALUE ['.$data_key.']');
                return $this->data_value_ARRAY[$data_key][$index];

            break;

        }

    }

    public function add($data_value, $data_key = NULL, $index = NULL, $data_auth_profile = CRNRSTN_AUTHORIZE_RUNTIME_ONLY, $default_ttl = 60){

//        if($data_key == 'ac7971ddce7e6720466d7fb07d03cdf6fd017a508d87ac7132d7d5d11a34f077db'){
//
//            $this->oCRNRSTN->print_r('$data_value=[' . $data_value . ']. $data_key=[' . $data_key . ']. $index=[' . $index . '].', NULL, CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
//
//            $tmp_array = array();
//            $tmp_array[] = '12345';
//            $tmp = strlen($tmp_array);
//
//            die();
//
//        }

        if(is_string($data_value)){

            $this->total_bytes_stored += strlen($data_value);

        }

        if(!isset($data_key)){

            $data_key = '';

        }

        //
        // PROCESS DATA META
        if(!isset($this->data_type)) {

            if(isset($index)){

                $data_type = strtolower(gettype($data_value));
                $this->ttl_profile_ARRAY[$data_key][$index] = $default_ttl;
                $this->data_auth_profile_ARRAY[$data_key][$index] = $data_auth_profile;
                $this->data_type_ARRAY[$data_key][$index] = $data_type;
                $this->data_flag_ARRAY[$data_key][$index] = 1;

            }else{

                $data_type = strtolower(gettype($data_value));
                $this->data_auth_profile_ARRAY[$data_key][] = $data_auth_profile;
                $this->ttl_profile_ARRAY[$data_key][] = $default_ttl;
                $this->data_type_ARRAY[$data_key][] = $data_type;
                $this->data_flag_ARRAY[$data_key][] = 1;

                //error_log(__LINE__ . ' env ddo ' . __METHOD__ . ' data_type=[' . $data_type . ']');

            }

        }else{

            if(isset($index)){

                $data_type = $this->data_type;
                $this->data_auth_profile_ARRAY[$data_key][$index] = $data_auth_profile;
                $this->ttl_profile_ARRAY[$data_key][$index] = $default_ttl;
                $this->data_type_ARRAY[$data_key][$index] = $data_type;
                $this->data_flag_ARRAY[$data_key][$index] = 1;

            }else{

                $data_type = $this->data_type;
                $this->data_auth_profile_ARRAY[$data_key][] = $data_auth_profile;
                $this->ttl_profile_ARRAY[$data_key][] = $default_ttl;
                $this->data_type_ARRAY[$data_key][] = $data_type;
                $this->data_flag_ARRAY[$data_key][] = 1;

                //error_log(__LINE__ . ' env ddo SET IN STONE data_type WILL ALWAYS=[' . $data_type . ']');

            }

        }

        //
        // PROCESS DATA_VALUE
        switch($data_type){
            case 'int':

                if(isset($index)){

                    $this->data_value_ARRAY[$data_key][$index] = (int) $data_value;

                }else{

                    $this->data_value_ARRAY[$data_key][] = (int) $data_value;

                }

            break;
            case 'integer':

                if(isset($index)){

                    $this->data_value_ARRAY[$data_key][$index] = (integer) $data_value;

                }else{

                    $this->data_value_ARRAY[$data_key][] = (integer) $data_value;

                }

            break;
            case 'bool':
            case 'boolean':

                if(isset($index)){

                    // strings 'true' or 'false'
                    if(is_bool($data_value) === true){

                        if($data_value){

                            $this->data_value_ARRAY[$data_key][$index] = 1;

                        }else{

                            $this->data_value_ARRAY[$data_key][$index] = 0;

                        }

                    }else{

                        if(boolval($data_value)){

                            $this->data_value_ARRAY[$data_key][$index] = 1;

                        }else{

                            $this->data_value_ARRAY[$data_key][$index] = 0;

                        }

                    }

                }else{

                    // strings 'true' or 'false'
                    if(is_bool($data_value) === true){

                        if($data_value){
                            //error_log(__LINE__ .' env ddo - BOOL['.$data_key.']['.$data_value . ']true');

                            $this->data_value_ARRAY[$data_key][] = 1;

                        }else{
                            //error_log(__LINE__ .' env ddo - BOOL['.$data_key.']['.$data_value . ']false');

                            $this->data_value_ARRAY[$data_key][] = 0;

                        }

                    }else{

                        if(boolval($data_value)){
                            //error_log(__LINE__ .' env ddo - BOOL['.$data_key.']['.$data_value . ']true');

                            $this->data_value_ARRAY[$data_key][] = 1;

                        }else{
                            //error_log(__LINE__ .' env ddo - BOOL['.$data_key.']['.$data_value . ']false');

                            $this->data_value_ARRAY[$data_key][] = 0;

                        }

                    }

                }

            break;
            case 'double':

                if(isset($index)){

                    $this->data_value_ARRAY[$data_key][$index] = (double) $data_value;

                }else{

                    $this->data_value_ARRAY[$data_key][] = (double) $data_value;

                }


            break;
            case 'string':

                if(isset($index)){

                    $this->data_value_ARRAY[$data_key][$index] = (string) $data_value;

                }else{

                    $this->data_value_ARRAY[$data_key][] = (string) $data_value;

                }

            break;
            case 'array':

                if(isset($index)){

                    $this->data_value_ARRAY[$data_key][$index] = (array) $data_value;

                }else{

                    $this->data_value_ARRAY[$data_key][] = (array) $data_value;

                }

            break;
            case 'object':

                if(isset($index)){

                    $this->data_value_ARRAY[$data_key][$index] = (object) $data_value;

                }else{

                    $this->data_value_ARRAY[$data_key][] = (object) $data_value;

                }

            break;
            case 'resource':

                if(isset($index)){

                    $this->data_value_ARRAY[$data_key][$index] = $data_value;

                }else{

                    $this->data_value_ARRAY[$data_key][] = $data_value;

                }

            break;
            case 'resource (closed)':

                if(isset($index)){

                    $this->data_value_ARRAY[$data_key][$index] = $data_value;

                }else{

                    $this->data_value_ARRAY[$data_key][] = $data_value;

                }

            break;
            case 'null':

                if(isset($index)){

                    $this->data_value_ARRAY[$data_key][$index] = NULL;

                }else{

                    $this->data_value_ARRAY[$data_key][] = NULL;

                }

            break;
            case 'unknown type':

                if(isset($index)){

                    $this->data_value_ARRAY[$data_key][$index] = $data_value;

                }else{

                    $this->data_value_ARRAY[$data_key][] = $data_value;

                }

            break;
            default:

                if(isset($index)){

                    $this->data_value_ARRAY[$data_key][$index] = $data_value;

                }else{

                    $this->data_value_ARRAY[$data_key][] = $data_value;

                }

            break;

        }

        return $data_key;

    }

    /**
     * Check "Booleanic" Conditions :)
     *
     * @param  [mixed]  $variable  Can be anything (string, bol, integer, etc.)
     * @return [boolean]           Returns TRUE  for "1", "true", "on" and "yes"
     *                             Returns FALSE for "0", "false", "off" and "no"
     *                             Returns NULL otherwise.
     *
     * SOURCE :: https://www.php.net/manual/en/function.is-bool.php
     * AUTHOR :: Julio Marchi :: https://www.php.net/manual/en/function.is-bool.php#124179
     */
    public function boolean_conversion($variable = NULL, $data_key = NULL, $index = 0){

        if(!isset($data_key)){

            $data_key = '';

        }

        if(isset($variable)){

            if (!isset($variable)) return null;
            return filter_var($variable, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        }else{

            if (!isset($this->attribute_value)) return null;
            return filter_var($this->data_value_ARRAY[$data_key][$index], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        }

    }

    public function generate_SOAP_request_object($method, $SOAP_response = NULL){

        switch($method){
            case 'REQUESTED_RESOURCES':

                /*
                'oCRNRSTN_SOAP_SVC_REQUESTED_RESOURCES' => array('name' => 'oCRNRSTN_SOAP_SVC_REQUESTED_RESOURCES',
                'type' => 'tns:oCRNRSTN_RESOURCE_CONSTANTS'),

                'oCRNRSTN_RESOURCE_CONSTANTS',
                array(
                'CONSTANT_NOM'=> array('name' => 'CONSTANT_NOM', 'type' => 'xsd:string'),
                'CONSTANT_VALUE'=> array('name' => 'CONSTANT_VALUE', 'type' => 'xsd:string')
                */

                if(isset($this->oCRNRSTN_USR)){

                    foreach($this->oCRNRSTN_USR->system_resource_constants as $key => $integer_const){

                        //
                        // IF BIT IS SET, ADD TO SOAP OBJECT
                        if($this->oCRNRSTN_USR->serialized_is_bit_set('CRNRSTN_CLIENT_SOAP_PERMS_REQUESTED', $integer_const)){

                            error_log(__LINE__ . ' env ddo A SET GO TO SOAP $integer_const=' . $integer_const);

                        }

                    }

                }else{

                    foreach($this->oCRNRSTN->system_resource_constants as $key => $integer_const){

                        //
                        // IF BIT IS SET, ADD TO SOAP OBJECT
                        if($this->oCRNRSTN->serialized_is_bit_set('CRNRSTN_CLIENT_SOAP_PERMS_REQUESTED', $integer_const)){

                            error_log(__LINE__ . ' env ddo A SET GO TO SOAP $integer_const=' . $integer_const);

                        }

                    }

                }

            break;
            case 'tunnelEncryptCalibrationRequest':

                $tmp_SOAP_ENCRYPT_CIPHER = $this->preach('value', 'SOAP_ENCRYPT_CIPHER');
                $tmp_SOAP_ENCRYPT_HMAC_ALG = $this->preach('value', 'SOAP_ENCRYPT_HMAC_ALG');
                $tmp_SOAP_ENCRYPT_OPTIONS = $this->preach('value', 'SOAP_ENCRYPT_OPTIONS');

                if(isset($this->oCRNRSTN_USR)){

                    $this->soap_encrypt_secret_key = $this->oCRNRSTN_USR->generate_new_key(42);

                }else{

                    $this->soap_encrypt_secret_key = $this->oCRNRSTN->generate_new_key(42);

                }

                $SOAP_request_ARRAY = array();
                $SOAP_request = array('oTunnelEncryptionCalibrationRequest' =>
                    array(
                        'CRNRSTN_PACKET_IS_ENCRYPTED' => 'FALSE',
                        'SERVER_NAME_SOAP_CLIENT' => $_SERVER['SERVER_NAME'],
                        'SERVER_ADDRESS_SOAP_CLIENT' => $_SERVER['SERVER_ADDR'],
                        'SOAP_ENCRYPT_CIPHER' => $tmp_SOAP_ENCRYPT_CIPHER,
                        'SOAP_ENCRYPT_SECRET_KEY' => $this->soap_encrypt_secret_key,
                        'SOAP_ENCRYPT_HMAC_ALG' => $tmp_SOAP_ENCRYPT_HMAC_ALG,
                        'SOAP_ENCRYPT_OPTIONS' => $tmp_SOAP_ENCRYPT_OPTIONS

                    ));

                $SOAP_request_ARRAY[] = $SOAP_request;

            break;
            case 'mayItakeTheKingsHighway':

                /*
                [CRNRSTN_PACKET_IS_ENCRYPTED] => TRUE
                [CRNRSTN_SOAP_SVC_AUTH_KEY] => C4e%2FKEvzq8tpaEoRhlp20pbKLftlcQzDyyYW4w8YgbmwOnrbOAf8wTT9VV6IvRkQIxfcpBEFvcRSldasa0P9%2B%2BVAFSw7BWxCahk%3D
                [CRNRSTN_SOAP_SVC_USERNAME] => N1FIuB0wom3xnLg6d%2FVWwqxtg5xdUHLmQWYhJmRJBnQJU1%2BEjnl887TFZgZ6Y8neMKodY36IW7sR60DBEkEKJhgBoVX7PrlzpGI%3D
                [CRNRSTN_SOAP_SVC_PASSWORD] => %2BOZnHTtSymFq1d4r3ojYQxGY3RvEu%2FER8N%2Fv%2FDPg1Gc6GCjMz%2BOtf3m6GEggHlP%2Bgzn0AnjahuEhqkenzSPgvv99O%2Fg6el3fAM1zHBv2U%2B79TvHyQTfA%2BAsGk7cqCIh6djojRGD8lV%2BAY3lK
                [CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES] => gBtFmWy%2BQzlwSH%2Bnvrrm417BHBRxNykIOZTcVY072aDXRggzdx6RvNUqcOYphM2zLLg0LO4%3D
                [CRNRSTN_SOAP_SVC_METHOD_REQUESTED] => r563IcIKdKEHoGCiNgpLPSJZah7CP49oGy3HtJZHYcxU0fFohrvI0uv61JFhZGy02%2Fk7gxyTMMcQ3zKv3IHm7rtbkGBmWSI%3D
                [CRNRSTN_SOAP_ACTION_TYPE] => eSlHSDrZXm4ISAZh7DWddLjxYFpzORcemD9sx7dcNs6aHVIKRsi0fZaersIHO2QkNWfLLN5hruAYCkcY1%2BTGh%2BBdxEDk8g%3D%3D
                [SERVER_NAME_SOAP_CLIENT] => m1v4gx%2FEFFlxH401Tag2OBPIDZm4eVUN9ZvH7vmOc3zyJJ8WlhEv5Y7y9x0txcFZ5RysEYhtaO%2BddHby9k4%3D
                [SERVER_ADDRESS_SOAP_CLIENT]
                SOAP_SERVICES_AUTH_STATUS
                */

                $tmp_SOAP_ENCRYPT_CIPHER = $this->preach('value', 'SOAP_ENCRYPT_CIPHER');
                $tmp_SOAP_ENCRYPT_SECRET_KEY = $this->soap_encrypt_secret_key;
                $tmp_SOAP_ENCRYPT_HMAC_ALG = $this->preach('value', 'SOAP_ENCRYPT_HMAC_ALG');
                $tmp_SOAP_ENCRYPT_OPTIONS = $this->preach('value', 'SOAP_ENCRYPT_OPTIONS');

                if(isset($this->oCRNRSTN_USR)){

                    $tmp_SOAP_SERVICES_AUTH_STATUS = $this->oCRNRSTN_USR->data_decrypt($SOAP_response['SOAP_SERVICES_AUTH_STATUS'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_SOAP_ENCRYPT_CIPHER_resp = $this->oCRNRSTN_USR->data_decrypt($SOAP_response['SOAP_ENCRYPT_CIPHER'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_SOAP_ENCRYPT_HMAC_ALG_resp = $this->oCRNRSTN_USR->data_decrypt($SOAP_response['SOAP_ENCRYPT_HMAC_ALG'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_SOAP_ENCRYPT_OPTIONS_resp = $this->oCRNRSTN_USR->data_decrypt($SOAP_response['SOAP_ENCRYPT_OPTIONS'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                }else{

                    $tmp_SOAP_SERVICES_AUTH_STATUS = $this->oCRNRSTN->data_decrypt($SOAP_response['SOAP_SERVICES_AUTH_STATUS'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_SOAP_ENCRYPT_CIPHER_resp = $this->oCRNRSTN->data_decrypt($SOAP_response['SOAP_ENCRYPT_CIPHER'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_SOAP_ENCRYPT_HMAC_ALG_resp = $this->oCRNRSTN->data_decrypt($SOAP_response['SOAP_ENCRYPT_HMAC_ALG'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_SOAP_ENCRYPT_OPTIONS_resp = $this->oCRNRSTN->data_decrypt($SOAP_response['SOAP_ENCRYPT_OPTIONS'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                }


//              error_log(__LINE__ .' '.get_class($this->oCRNRSTN));
//              die();

                //$tmp_serialized_bit_nom = $this->oCRNRSTN->return_serialized_bit_nom('CLIENT_REQUESTED_PERMISSIONS'); // CLIENT_REQUESTED_PERMISSIONS, SERVER_AUTH_CONN_PERMISSIONS, SERVER_AUTH_CLIENT_PERMISSIONS

                //   crnrstn_soap_services_client_manager
             //   $tmp_bit_state_nomination = 'CRNRSTN_CLIENT_SOAP_PERMS_REQUESTED';
                //$this->oCRNRSTN_USR->oCRNRSTN_BITFLIP_MGR->initialize_serialized_bit($tmp_bit_state_nomination, CRNRSTN_RESOURCE_OPENSOURCE);
                error_log(__LINE__ .' env ddo class='.get_class($this->oCRNRSTN));

                //$tmp_SOAP_SVC_REQUESTED_RESOURCES = $this->oCRNRSTN->serialized_bit_stringout('CRNRSTN_CLIENT_SOAP_PERMS_REQUESTED');
                //error_log(__LINE__ .' $tmp_SOAP_SVC_REQUESTED_RESOURCES='.$tmp_SOAP_SVC_REQUESTED_RESOURCES);
                // $this->oCRNRSTN->print_r($tmp_SOAP_SVC_REQUESTED_RESOURCES,'SOAP CRNRSTN_CLIENT_SOAP_PERMS_REQUESTED TEST',NULL, __LINE__,__METHOD__,__FILE__);

                //$tmp_SOAP_SVC_REQUESTED_RESOURCES = $this->oCRNRSTN->data_decrypt($SOAP_response['SOAP_ENCRYPT_OPTIONS'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
//                $tmp_STATUS_CODE = $this->oCRNRSTN->data_decrypt($SOAP_response['STATUS_CODE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
//                $tmp_STATUS_MESSAGE = $this->oCRNRSTN->data_decrypt($SOAP_response['STATUS_MESSAGE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
//                $tmp_ISERROR_CODE = $this->oCRNRSTN->data_decrypt($SOAP_response['ISERROR_CODE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
//                $tmp_ISERROR_MESSAGE = $this->oCRNRSTN->data_decrypt($SOAP_response['ISERROR_MESSAGE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
//                $tmp_DATE_RECEIVED_SOAP_REQUEST = $this->oCRNRSTN->data_decrypt($SOAP_response['DATE_RECEIVED_SOAP_REQUEST'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
//                $tmp_SERVER_NAME_SOAP_SERVER = $this->oCRNRSTN->data_decrypt($SOAP_response['SERVER_NAME_SOAP_SERVER'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
//                $tmp_SERVER_ADDRESS_SOAP_SERVER = $this->oCRNRSTN->data_decrypt($SOAP_response['SERVER_ADDRESS_SOAP_SERVER'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
//                $tmp_DATE_CREATED_SOAP_RESPONSE = $this->oCRNRSTN->data_decrypt($SOAP_response['DATE_CREATED_SOAP_RESPONSE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                //error_log(__LINE__ .' env - mayItakeTheKingsHighway ENCRYPT-B USERNAME ['.$tmp_SOAP_ENCRYPT_CIPHER_resp.']['.$this->soap_encrypt_secret_key.']['.$tmp_SOAP_ENCRYPT_HMAC_ALG_resp.']['.$tmp_SOAP_ENCRYPT_OPTIONS_resp.']');

                $tmp_SOAP_ENCRYPT_CIPHER = $tmp_SOAP_ENCRYPT_CIPHER_resp;

                if(isset($this->oCRNRSTN_USR)){

                    $this->soap_encrypt_secret_key = $this->oCRNRSTN->hash($this->oCRNRSTN_USR->get_resource('CRNRSTN_SOAP_SVC_ENCRYPTION_KEY', 'CRNRSTN::INTEGRATIONS'), 'md5');
                    $tmp_SOAP_ENCRYPT_HMAC_ALG = $tmp_SOAP_ENCRYPT_HMAC_ALG_resp;
                    $tmp_SOAP_ENCRYPT_OPTIONS = $tmp_SOAP_ENCRYPT_OPTIONS_resp;

                    $tmp_requested_resources_SOAP_OBJECT = $this->generate_SOAP_request_object('REQUESTED_RESOURCES');

                    $SOAP_request_ARRAY = array();
                    $SOAP_request = array('oKingsHighwayAuthRequest' =>
                        array(
                            'CRNRSTN_PACKET_IS_ENCRYPTED' => 'TRUE',
                            'CRNRSTN_SOAP_SVC_AUTH_KEY' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->get_resource('CRNRSTN_SOAP_SVC_AUTH_KEY', 'CRNRSTN::INTEGRATIONS'), CRNRSTN_ENCRYPT_SOAP , $tmp_SOAP_ENCRYPT_CIPHER_resp, $this->soap_encrypt_secret_key, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp),
                            'CRNRSTN_SOAP_SVC_USERNAME' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->get_resource('CRNRSTN_SOAP_SVC_USERNAME', 'CRNRSTN::INTEGRATIONS'), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $this->soap_encrypt_secret_key, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp),
                            'CRNRSTN_SOAP_SVC_PASSWORD' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->create_pwd_hash_for_storage($this->oCRNRSTN->hash($this->preach('value', 'CRNRSTN_SOAP_SVC_PASSWORD'), 'md5')), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $this->soap_encrypt_secret_key, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp),
                            'oCRNRSTN_SOAP_SVC_REQUESTED_RESOURCES' => $tmp_requested_resources_SOAP_OBJECT,
                            'CRNRSTN_SOAP_SVC_METHOD_REQUESTED' => $this->oCRNRSTN_USR->data_encrypt('mayItakeTheKingsHighway', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER, $this->soap_encrypt_secret_key, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp),
                            'CRNRSTN_SOAP_ACTION_TYPE' => $this->oCRNRSTN_USR->data_encrypt('EXCEPTION_NOTIFICATION', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $this->soap_encrypt_secret_key, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp),
                            'SERVER_NAME_SOAP_CLIENT' => $this->oCRNRSTN_USR->data_encrypt($_SERVER['SERVER_NAME'], CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $this->soap_encrypt_secret_key, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp),
                            'SERVER_ADDRESS_SOAP_CLIENT' => $this->oCRNRSTN_USR->data_encrypt($_SERVER['SERVER_ADDR'], CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $this->soap_encrypt_secret_key, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp)

                        ));

                }else{

                    $this->soap_encrypt_secret_key = $this->oCRNRSTN->hash($this->oCRNRSTN->get_resource('CRNRSTN_SOAP_SVC_ENCRYPTION_KEY', 'CRNRSTN::INTEGRATIONS'), 'md5');
                    $tmp_SOAP_ENCRYPT_HMAC_ALG = $tmp_SOAP_ENCRYPT_HMAC_ALG_resp;
                    $tmp_SOAP_ENCRYPT_OPTIONS = $tmp_SOAP_ENCRYPT_OPTIONS_resp;
                    //error_log(__LINE__ .' env ddo - mayItakeTheKingsHighway ENCRYPT-A USERNAME ['.$tmp_SOAP_ENCRYPT_CIPHER.']['.$this->soap_encrypt_secret_key.']['.$tmp_SOAP_ENCRYPT_HMAC_ALG.']['.$tmp_SOAP_ENCRYPT_OPTIONS.']');

                    $tmp_requested_resources_SOAP_OBJECT = $this->generate_SOAP_request_object('REQUESTED_RESOURCES');

                    $SOAP_request_ARRAY = array();
                    $SOAP_request = array('oKingsHighwayAuthRequest' =>
                        array(
                            'CRNRSTN_PACKET_IS_ENCRYPTED' => 'TRUE',
                            'CRNRSTN_SOAP_SVC_AUTH_KEY' => $this->oCRNRSTN->data_encrypt($this->oCRNRSTN->get_resource('CRNRSTN_SOAP_SVC_AUTH_KEY', 'CRNRSTN::INTEGRATIONS'), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $this->soap_encrypt_secret_key, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp),
                            'CRNRSTN_SOAP_SVC_USERNAME' => $this->oCRNRSTN->data_encrypt($this->oCRNRSTN->get_resource('CRNRSTN_SOAP_SVC_USERNAME', 'CRNRSTN::INTEGRATIONS'), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $this->soap_encrypt_secret_key, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp),
                            'CRNRSTN_SOAP_SVC_PASSWORD' => $this->oCRNRSTN->data_encrypt($this->oCRNRSTN->create_pwd_hash_for_storage($this->oCRNRSTN->hash($this->preach('value', 'CRNRSTN_SOAP_SVC_PASSWORD'), 'md5')), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $this->soap_encrypt_secret_key, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp),
                            'oCRNRSTN_SOAP_SVC_REQUESTED_RESOURCES' => $tmp_requested_resources_SOAP_OBJECT,
                            'CRNRSTN_SOAP_SVC_METHOD_REQUESTED' => $this->oCRNRSTN->data_encrypt('mayItakeTheKingsHighway', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER, $this->soap_encrypt_secret_key, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp),
                            'CRNRSTN_SOAP_ACTION_TYPE' => $this->oCRNRSTN->data_encrypt('EXCEPTION_NOTIFICATION', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $this->soap_encrypt_secret_key, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp),
                            'SERVER_NAME_SOAP_CLIENT' => $this->oCRNRSTN->data_encrypt($_SERVER['SERVER_NAME'], CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $this->soap_encrypt_secret_key, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp),
                            'SERVER_ADDRESS_SOAP_CLIENT' => $this->oCRNRSTN->data_encrypt($_SERVER['SERVER_ADDR'], CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $this->soap_encrypt_secret_key, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp)

                        ));

                }

                //print_r(__LINE__ .' env ddo $SOAP_request='.print_r($SOAP_request, true));

                $SOAP_request_ARRAY[] = $SOAP_request;

            break;
            case 'takeTheKingsHighway':

                $tmp_SOAP_ENCRYPT_CIPHER = $this->soap_encrypt_cipher;
                $tmp_SOAP_ENCRYPT_SECRET_KEY = $this->oCRNRSTN->hash($this->preach('value', 'CRNRSTN_SOAP_SVC_ENCRYPTION_KEY'), 'md5');
                $tmp_SOAP_ENCRYPT_HMAC_ALG = $this->soap_encrypt_hmac_alg;
                $tmp_SOAP_ENCRYPT_OPTIONS = $this->soap_encrypt_options;

                if(isset($this->oCRNRSTN_USR)){

                    $tmp_CRNRSTN_SOAP_SVC_AUTH_KEY = $this->oCRNRSTN_USR->data_decrypt($SOAP_response['CRNRSTN_SOAP_SVC_AUTH_KEY'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_CRNRSTN_SOAP_SVC_USERNAME = $this->oCRNRSTN_USR->data_decrypt($SOAP_response['CRNRSTN_SOAP_SVC_USERNAME'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_SOAP_SERVICES_AUTH_STATUS = $this->oCRNRSTN_USR->data_decrypt($SOAP_response['SOAP_SERVICES_AUTH_STATUS'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                    $tmp_SOAP_ENCRYPT_CIPHER_resp = $this->oCRNRSTN_USR->data_decrypt($SOAP_response['SOAP_ENCRYPT_CIPHER'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_SOAP_ENCRYPT_SECRET_KEY_resp = $this->oCRNRSTN_USR->data_decrypt($SOAP_response['SOAP_ENCRYPT_SECRET_KEY'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_SOAP_ENCRYPT_HMAC_ALG_resp = $this->oCRNRSTN_USR->data_decrypt($SOAP_response['SOAP_ENCRYPT_HMAC_ALG'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_SOAP_ENCRYPT_OPTIONS_resp = $this->oCRNRSTN_USR->data_decrypt($SOAP_response['SOAP_ENCRYPT_OPTIONS'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                    $tmp_STATUS_CODE = $this->oCRNRSTN_USR->data_decrypt($SOAP_response['STATUS_CODE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_STATUS_MESSAGE = $this->oCRNRSTN_USR->data_decrypt($SOAP_response['STATUS_MESSAGE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_ISERROR_CODE = $this->oCRNRSTN_USR->data_decrypt($SOAP_response['ISERROR_CODE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_ISERROR_MESSAGE = $this->oCRNRSTN_USR->data_decrypt($SOAP_response['ISERROR_MESSAGE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_DATE_RECEIVED_SOAP_REQUEST = $this->oCRNRSTN_USR->data_decrypt($SOAP_response['DATE_RECEIVED_SOAP_REQUEST'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_SERVER_NAME_SOAP_SERVER = $this->oCRNRSTN_USR->data_decrypt($SOAP_response['SERVER_NAME_SOAP_SERVER'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_SERVER_ADDRESS_SOAP_SERVER = $this->oCRNRSTN_USR->data_decrypt($SOAP_response['SERVER_ADDRESS_SOAP_SERVER'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_DATE_CREATED_SOAP_RESPONSE = $this->oCRNRSTN_USR->data_decrypt($SOAP_response['DATE_CREATED_SOAP_RESPONSE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_SERVER_NAME_SOAP_CLIENT = $this->oCRNRSTN_USR->data_decrypt($SOAP_response['SERVER_NAME_SOAP_CLIENT'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_SERVER_ADDRESS_SOAP_CLIENT = $this->oCRNRSTN_USR->data_decrypt($SOAP_response['SERVER_ADDRESS_SOAP_CLIENT'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                    $this->oCRNRSTN_USR->print_r($tmp_ISERROR_CODE.' :: '.$tmp_ISERROR_MESSAGE, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY ::', NULL, __LINE__, __METHOD__, __FILE__);

                }else{

                    $tmp_CRNRSTN_SOAP_SVC_AUTH_KEY = $this->oCRNRSTN->data_decrypt($SOAP_response['CRNRSTN_SOAP_SVC_AUTH_KEY'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_CRNRSTN_SOAP_SVC_USERNAME = $this->oCRNRSTN->data_decrypt($SOAP_response['CRNRSTN_SOAP_SVC_USERNAME'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_SOAP_SERVICES_AUTH_STATUS = $this->oCRNRSTN->data_decrypt($SOAP_response['SOAP_SERVICES_AUTH_STATUS'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                    $tmp_SOAP_ENCRYPT_CIPHER_resp = $this->oCRNRSTN->data_decrypt($SOAP_response['SOAP_ENCRYPT_CIPHER'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_SOAP_ENCRYPT_SECRET_KEY_resp = $this->oCRNRSTN->data_decrypt($SOAP_response['SOAP_ENCRYPT_SECRET_KEY'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_SOAP_ENCRYPT_HMAC_ALG_resp = $this->oCRNRSTN->data_decrypt($SOAP_response['SOAP_ENCRYPT_HMAC_ALG'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_SOAP_ENCRYPT_OPTIONS_resp = $this->oCRNRSTN->data_decrypt($SOAP_response['SOAP_ENCRYPT_OPTIONS'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                    $tmp_STATUS_CODE = $this->oCRNRSTN->data_decrypt($SOAP_response['STATUS_CODE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_STATUS_MESSAGE = $this->oCRNRSTN->data_decrypt($SOAP_response['STATUS_MESSAGE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_ISERROR_CODE = $this->oCRNRSTN->data_decrypt($SOAP_response['ISERROR_CODE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_ISERROR_MESSAGE = $this->oCRNRSTN->data_decrypt($SOAP_response['ISERROR_MESSAGE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_DATE_RECEIVED_SOAP_REQUEST = $this->oCRNRSTN->data_decrypt($SOAP_response['DATE_RECEIVED_SOAP_REQUEST'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_SERVER_NAME_SOAP_SERVER = $this->oCRNRSTN->data_decrypt($SOAP_response['SERVER_NAME_SOAP_SERVER'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_SERVER_ADDRESS_SOAP_SERVER = $this->oCRNRSTN->data_decrypt($SOAP_response['SERVER_ADDRESS_SOAP_SERVER'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_DATE_CREATED_SOAP_RESPONSE = $this->oCRNRSTN->data_decrypt($SOAP_response['DATE_CREATED_SOAP_RESPONSE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_SERVER_NAME_SOAP_CLIENT = $this->oCRNRSTN->data_decrypt($SOAP_response['SERVER_NAME_SOAP_CLIENT'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_SERVER_ADDRESS_SOAP_CLIENT = $this->oCRNRSTN->data_decrypt($SOAP_response['SERVER_ADDRESS_SOAP_CLIENT'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                    $this->oCRNRSTN->print_r($tmp_ISERROR_CODE.' :: '.$tmp_ISERROR_MESSAGE, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY ::', NULL, __LINE__, __METHOD__, __FILE__);

                }

                $tmp_SOAP_ENCRYPT_SECRET_KEY_resp = $this->preach('value', 'SOAP_ENCRYPT_SECRET_KEY_CONNECTION');

                if($tmp_SOAP_ENCRYPT_SECRET_KEY_resp == ''){

                    //
                    // IF CLIENT HAS NO PERSONAL SECRET KEY...ATTEMPT TO FALL BACK ON ENVIRONMENT SECRET KEY.
                    $tmp_SOAP_ENCRYPT_CIPHER_resp = $this->soap_encrypt_cipher;
                    $tmp_SOAP_ENCRYPT_SECRET_KEY_resp = $this->oCRNRSTN->hash($this->preach('value', 'CRNRSTN_SOAP_SVC_ENCRYPTION_KEY'), 'md5');
                    $tmp_SOAP_ENCRYPT_HMAC_ALG_resp = $this->soap_encrypt_hmac_alg;
                    $tmp_SOAP_ENCRYPT_OPTIONS_resp = $this->soap_encrypt_options;

                }

                error_log(__LINE__ . ' env ddo - CLIENT ENCRYPT SENDING VIA -->' . $tmp_SOAP_ENCRYPT_CIPHER . '][' . $tmp_SOAP_ENCRYPT_SECRET_KEY . '][' . $tmp_SOAP_ENCRYPT_HMAC_ALG . '][' . $tmp_SOAP_ENCRYPT_OPTIONS . ']');

                $SOAP_request_ARRAY = array();

                $tmp_recipient_email_cnt = $this->count('RECIPIENT_EMAIL');
                for($i = 0; $i < $tmp_recipient_email_cnt; $i++){

                    $tmp_curr = 1 + $i;
                    error_log(__LINE__ . ' CLIENT - PROXY email ' . $i . '.');

                    if(isset($this->oCRNRSTN_USR)){

                        $SOAP_request = array('oKingsHighwayNotification' =>
                            array(
                                'CRNRSTN_PACKET_IS_ENCRYPTED' => 'TRUE',
                                'CRNRSTN_SOAP_ACTION_TYPE' => $this->oCRNRSTN_USR->data_encrypt('EXCEPTION_NOTIFICATION', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp),
                                'CRNRSTN_SOAP_SVC_METHOD_REQUESTED' => $this->oCRNRSTN_USR->data_encrypt('mayItakeTheKingsHighway|takeTheKingsHighway', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp),
                                'SERVER_NAME_SOAP_CLIENT' => $this->oCRNRSTN_USR->data_encrypt($_SERVER['SERVER_NAME'], CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp),
                                'SERVER_ADDRESS_SOAP_CLIENT' => $this->oCRNRSTN_USR->data_encrypt($_SERVER['SERVER_ADDR'], CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp),
                                'CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES' => $this->oCRNRSTN_USR->data_encrypt('EMAIL', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp)

                            ));

                        $this->oCRNRSTN_USR->print_r($SOAP_request, 'CLIENT REQUEST ASSEMBLY TEST (' . $tmp_curr . ' of ' . $tmp_recipient_email_cnt . '[tmp_recipient_email_cnt]) - KING\'S HIGHWAY ::', NULL,  __LINE__, __METHOD__, __FILE__);

                        if($this->preach('isset', 'CRNRSTN_SOAP_SVC_AUTH_KEY')){

                            error_log(__LINE__ . ' env ddo - encrypt CRNRSTN_SOAP_SVC_AUTH_KEY for oKingsHighwayNotification [' . $tmp_SOAP_ENCRYPT_CIPHER_resp . '][' . $tmp_SOAP_ENCRYPT_SECRET_KEY_resp . '][' . $tmp_SOAP_ENCRYPT_HMAC_ALG_resp . '][' . $tmp_SOAP_ENCRYPT_OPTIONS_resp . ']');
                            $SOAP_request['oKingsHighwayNotification']['CRNRSTN_SOAP_SVC_AUTH_KEY'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'CRNRSTN_SOAP_SVC_AUTH_KEY', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'CRNRSTN_SOAP_SVC_USERNAME')){

                            error_log(__LINE__ . ' env ddo - encrypt username for oKingsHighwayNotification [' . $tmp_SOAP_ENCRYPT_CIPHER . '][' . $tmp_SOAP_ENCRYPT_SECRET_KEY . '][' . $tmp_SOAP_ENCRYPT_HMAC_ALG . '][' . $tmp_SOAP_ENCRYPT_OPTIONS . ']');
                            $SOAP_request['oKingsHighwayNotification']['CRNRSTN_SOAP_SVC_USERNAME'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'CRNRSTN_SOAP_SVC_USERNAME', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                        }

                        if($this->preach('isset', 'CRNRSTN_SOAP_SVC_PASSWORD')){

                            $SOAP_request['oKingsHighwayNotification']['CRNRSTN_SOAP_SVC_PASSWORD'] = $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->create_pwd_hash_for_storage($this->oCRNRSTN->hash($this->preach('value', 'CRNRSTN_SOAP_SVC_PASSWORD', true), 'md5')), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                        }

                        if($this->preach('isset', 'EMAIL_PROTOCOL')){

                            error_log(__LINE__ . ' env ddo - EMAIL_PROTOCOL');

                            $SOAP_request['oKingsHighwayNotification']['EMAIL_PROTOCOL']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'EMAIL_PROTOCOL', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['EMAIL_PROTOCOL']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'EMAIL_PROTOCOL', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'EMAIL_PROTOCOL', true));
                            $SOAP_request['oKingsHighwayNotification']['EMAIL_PROTOCOL']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_AUTH')){

                            error_log(__LINE__ .' env ddo - SMTP_AUTH');

                            $SOAP_request['oKingsHighwayNotification']['SMTP_AUTH']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'SMTP_AUTH', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_AUTH']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'SMTP_AUTH', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'SMTP_AUTH', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_AUTH']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_SERVER')){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_SERVER']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'SMTP_SERVER', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_SERVER']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'SMTP_SERVER', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'SMTP_SERVER', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_SERVER']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_PORT_OUTGOING')){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_PORT_OUTGOING']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'SMTP_PORT_OUTGOING', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_PORT_OUTGOING']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'SMTP_PORT_OUTGOING', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'SMTP_PORT_OUTGOING', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_PORT_OUTGOING']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_USERNAME')){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_USERNAME']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'SMTP_USERNAME', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_USERNAME']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'SMTP_USERNAME', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'SMTP_USERNAME', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_USERNAME']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_PASSWORD')){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_PASSWORD']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'SMTP_PASSWORD', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_PASSWORD']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'SMTP_PASSWORD', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'SMTP_PASSWORD', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_PASSWORD']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_KEEPALIVE')){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_KEEPALIVE']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'SMTP_KEEPALIVE', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_KEEPALIVE']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'SMTP_KEEPALIVE', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'SMTP_KEEPALIVE', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_KEEPALIVE']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_SECURE')){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_SECURE']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'SMTP_SECURE', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_SECURE']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'SMTP_SECURE', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'SMTP_SECURE', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_SECURE']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_AUTOTLS')){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_AUTOTLS']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'SMTP_AUTOTLS', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_AUTOTLS']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'SMTP_AUTOTLS', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'SMTP_AUTOTLS', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_AUTOTLS']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_TIMEOUT')){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_TIMEOUT']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'SMTP_TIMEOUT', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_TIMEOUT']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'SMTP_TIMEOUT', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'SMTP_TIMEOUT', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_TIMEOUT']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'DIBYA_SAHOO_SSL_CERT_BYPASS')){

                            $SOAP_request['oKingsHighwayNotification']['DIBYA_SAHOO_SSL_CERT_BYPASS']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'DIBYA_SAHOO_SSL_CERT_BYPASS', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['DIBYA_SAHOO_SSL_CERT_BYPASS']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'DIBYA_SAHOO_SSL_CERT_BYPASS', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'DIBYA_SAHOO_SSL_CERT_BYPASS', true));
                            $SOAP_request['oKingsHighwayNotification']['DIBYA_SAHOO_SSL_CERT_BYPASS']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'DUP_SUPPRESS')){

                            $SOAP_request['oKingsHighwayNotification']['DUP_SUPPRESS']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'DUP_SUPPRESS', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['DUP_SUPPRESS']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'DUP_SUPPRESS', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'DUP_SUPPRESS', true));
                            $SOAP_request['oKingsHighwayNotification']['DUP_SUPPRESS']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'CHARSET')){

                            $SOAP_request['oKingsHighwayNotification']['CHARSET']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'CHARSET', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['CHARSET']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'CHARSET', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'CHARSET', true));
                            $SOAP_request['oKingsHighwayNotification']['CHARSET']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'MESSAGE_ENCODING')){

                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_ENCODING']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'MESSAGE_ENCODING', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_ENCODING']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'MESSAGE_ENCODING', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'MESSAGE_ENCODING', true));
                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_ENCODING']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'ALLOW_EMPTY')){

                            $SOAP_request['oKingsHighwayNotification']['ALLOW_EMPTY']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'ALLOW_EMPTY', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['ALLOW_EMPTY']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'ALLOW_EMPTY', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'ALLOW_EMPTY', true));
                            $SOAP_request['oKingsHighwayNotification']['ALLOW_EMPTY']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'TRY_OTHER_EMAIL_METHODS_ON_ERR')){

                            $SOAP_request['oKingsHighwayNotification']['TRY_OTHER_EMAIL_METHODS_ON_ERR']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'TRY_OTHER_EMAIL_METHODS_ON_ERR', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['TRY_OTHER_EMAIL_METHODS_ON_ERR']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'TRY_OTHER_EMAIL_METHODS_ON_ERR', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'TRY_OTHER_EMAIL_METHODS_ON_ERR', true));
                            error_log(__LINE__ . ' env ddo - TRY_OTHER_EMAIL_METHODS_ON_ERR[' . $tmp_len . ']');

                            $SOAP_request['oKingsHighwayNotification']['TRY_OTHER_EMAIL_METHODS_ON_ERR']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                    }else{

                        $SOAP_request = array('oKingsHighwayNotification' =>
                            array(
                                'CRNRSTN_PACKET_IS_ENCRYPTED' => 'TRUE',
                                'CRNRSTN_SOAP_ACTION_TYPE' => $this->oCRNRSTN->data_encrypt('EXCEPTION_NOTIFICATION', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp),
                                'CRNRSTN_SOAP_SVC_METHOD_REQUESTED' => $this->oCRNRSTN->data_encrypt('mayItakeTheKingsHighway|takeTheKingsHighway', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp),
                                'SERVER_NAME_SOAP_CLIENT' => $this->oCRNRSTN->data_encrypt($_SERVER['SERVER_NAME'], CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp),
                                'SERVER_ADDRESS_SOAP_CLIENT' => $this->oCRNRSTN->data_encrypt($_SERVER['SERVER_ADDR'], CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp),
                                'CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES' => $this->oCRNRSTN->data_encrypt('EMAIL', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp)

                            ));

                        $this->oCRNRSTN->print_r($SOAP_request, 'CLIENT REQUEST ASSEMBLY TEST (' . $tmp_curr . ' of ' . $tmp_recipient_email_cnt . '[tmp_recipient_email_cnt]) - KING\'S HIGHWAY ::', NULL, __LINE__, __METHOD__, __FILE__);

                        if($this->preach('isset', 'CRNRSTN_SOAP_SVC_AUTH_KEY')){

                            error_log(__LINE__ . ' env ddo - encrypt CRNRSTN_SOAP_SVC_AUTH_KEY for oKingsHighwayNotification [' . $tmp_SOAP_ENCRYPT_CIPHER_resp . '][' . $tmp_SOAP_ENCRYPT_SECRET_KEY_resp . '][' . $tmp_SOAP_ENCRYPT_HMAC_ALG_resp . '][' . $tmp_SOAP_ENCRYPT_OPTIONS_resp . ']');
                            $SOAP_request['oKingsHighwayNotification']['CRNRSTN_SOAP_SVC_AUTH_KEY'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'CRNRSTN_SOAP_SVC_AUTH_KEY', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'CRNRSTN_SOAP_SVC_USERNAME')){

                            error_log(__LINE__ . ' env ddo - encrypt username for oKingsHighwayNotification [' . $tmp_SOAP_ENCRYPT_CIPHER . '][' . $tmp_SOAP_ENCRYPT_SECRET_KEY . '][' . $tmp_SOAP_ENCRYPT_HMAC_ALG . '][' . $tmp_SOAP_ENCRYPT_OPTIONS . ']');
                            $SOAP_request['oKingsHighwayNotification']['CRNRSTN_SOAP_SVC_USERNAME'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'CRNRSTN_SOAP_SVC_USERNAME', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                        }

                        if($this->preach('isset', 'CRNRSTN_SOAP_SVC_PASSWORD')){

                            $SOAP_request['oKingsHighwayNotification']['CRNRSTN_SOAP_SVC_PASSWORD'] = $this->oCRNRSTN->data_encrypt($this->oCRNRSTN->create_pwd_hash_for_storage($this->oCRNRSTN->hash($this->preach('value', 'CRNRSTN_SOAP_SVC_PASSWORD', true), 'md5')), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                        }

                        if($this->preach('isset', 'EMAIL_PROTOCOL')){

                            error_log(__LINE__ . ' env ddo - EMAIL_PROTOCOL');

                            $SOAP_request['oKingsHighwayNotification']['EMAIL_PROTOCOL']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'EMAIL_PROTOCOL', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['EMAIL_PROTOCOL']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'EMAIL_PROTOCOL', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'EMAIL_PROTOCOL', true));
                            $SOAP_request['oKingsHighwayNotification']['EMAIL_PROTOCOL']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_AUTH')){

                            error_log(__LINE__ . ' env ddo - SMTP_AUTH');

                            $SOAP_request['oKingsHighwayNotification']['SMTP_AUTH']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'SMTP_AUTH', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_AUTH']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'SMTP_AUTH', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'SMTP_AUTH', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_AUTH']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_SERVER')){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_SERVER']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'SMTP_SERVER', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_SERVER']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'SMTP_SERVER', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'SMTP_SERVER', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_SERVER']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_PORT_OUTGOING')){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_PORT_OUTGOING']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'SMTP_PORT_OUTGOING', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_PORT_OUTGOING']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'SMTP_PORT_OUTGOING', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'SMTP_PORT_OUTGOING', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_PORT_OUTGOING']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_USERNAME')){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_USERNAME']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'SMTP_USERNAME', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_USERNAME']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'SMTP_USERNAME', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'SMTP_USERNAME', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_USERNAME']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_PASSWORD')){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_PASSWORD']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'SMTP_PASSWORD', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_PASSWORD']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'SMTP_PASSWORD', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'SMTP_PASSWORD', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_PASSWORD']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_KEEPALIVE')){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_KEEPALIVE']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'SMTP_KEEPALIVE', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_KEEPALIVE']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'SMTP_KEEPALIVE', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'SMTP_KEEPALIVE', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_KEEPALIVE']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_SECURE')){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_SECURE']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'SMTP_SECURE', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_SECURE']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'SMTP_SECURE', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'SMTP_SECURE', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_SECURE']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_AUTOTLS')){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_AUTOTLS']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'SMTP_AUTOTLS', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_AUTOTLS']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'SMTP_AUTOTLS', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'SMTP_AUTOTLS', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_AUTOTLS']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_TIMEOUT')){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_TIMEOUT']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'SMTP_TIMEOUT', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_TIMEOUT']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'SMTP_TIMEOUT', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'SMTP_TIMEOUT', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_TIMEOUT']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'DIBYA_SAHOO_SSL_CERT_BYPASS')){

                            $SOAP_request['oKingsHighwayNotification']['DIBYA_SAHOO_SSL_CERT_BYPASS']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'DIBYA_SAHOO_SSL_CERT_BYPASS', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['DIBYA_SAHOO_SSL_CERT_BYPASS']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'DIBYA_SAHOO_SSL_CERT_BYPASS', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'DIBYA_SAHOO_SSL_CERT_BYPASS', true));
                            $SOAP_request['oKingsHighwayNotification']['DIBYA_SAHOO_SSL_CERT_BYPASS']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'DUP_SUPPRESS')){

                            $SOAP_request['oKingsHighwayNotification']['DUP_SUPPRESS']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'DUP_SUPPRESS', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['DUP_SUPPRESS']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'DUP_SUPPRESS', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'DUP_SUPPRESS', true));
                            $SOAP_request['oKingsHighwayNotification']['DUP_SUPPRESS']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'CHARSET')){

                            $SOAP_request['oKingsHighwayNotification']['CHARSET']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'CHARSET', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['CHARSET']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'CHARSET', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'CHARSET', true));
                            $SOAP_request['oKingsHighwayNotification']['CHARSET']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'MESSAGE_ENCODING')){

                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_ENCODING']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'MESSAGE_ENCODING', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_ENCODING']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'MESSAGE_ENCODING', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'MESSAGE_ENCODING', true));
                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_ENCODING']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'ALLOW_EMPTY')){

                            $SOAP_request['oKingsHighwayNotification']['ALLOW_EMPTY']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'ALLOW_EMPTY', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['ALLOW_EMPTY']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'ALLOW_EMPTY', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'ALLOW_EMPTY', true));
                            $SOAP_request['oKingsHighwayNotification']['ALLOW_EMPTY']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'TRY_OTHER_EMAIL_METHODS_ON_ERR')){

                            $SOAP_request['oKingsHighwayNotification']['TRY_OTHER_EMAIL_METHODS_ON_ERR']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'TRY_OTHER_EMAIL_METHODS_ON_ERR', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['TRY_OTHER_EMAIL_METHODS_ON_ERR']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'TRY_OTHER_EMAIL_METHODS_ON_ERR', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'TRY_OTHER_EMAIL_METHODS_ON_ERR', true));
                            error_log(__LINE__ . ' env ddo - TRY_OTHER_EMAIL_METHODS_ON_ERR[' . $tmp_len . ']');

                            $SOAP_request['oKingsHighwayNotification']['TRY_OTHER_EMAIL_METHODS_ON_ERR']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                    }


                    /*
                     $server->wsdl->addComplexType(
                        'oEmailArray',
                        'complexType',
                        'array',
                        '',
                        'SOAP-ENC:Array',
                        array(),
                        array(
                            array(
                                'ref' => 'SOAP-ENC:arrayType',
                                'wsdl:arrayType' => 'tns:oEmail[]'
                            )
                        ),
                        'tns:oEmail'
                    );

                    $server->wsdl->addComplexType(
                        'oEmail',
                        'complexType',
                        'struct',
                        'all',
                        '',
                        array(
                            'EMAIL_PROXY_SERIAL' => array( 'name' => 'EMAIL_PROXY_SERIAL', 'type' => 'tns:oSOAP_Data' ),
                            'EMAIL' => array( 'name' => 'EMAIL', 'type' => 'tns:oSOAP_Data' ),
                            'NAME' => array( 'name' => 'NAME', 'type' => 'tns:oSOAP_Data' ),
                            'FIRSTNAME' => array( 'name' => 'FIRSTNAME', 'type' => 'tns:oSOAP_Data' ),
                            'LASTNAME' => array( 'name' => 'LASTNAME', 'type' => 'tns:oSOAP_Data' )
                        )
                    );

                    $server->wsdl->addComplexType(
                        'oSOAP_Data',
                        'complexType',
                        'struct',
                        'all',
                        '',
                        array(
                            'CONTENT' => array( 'name' => 'CONTENT', 'type' => 'xsd:string' ),
                            'TYPE' => array( 'name' => 'TYPE', 'type' => 'xsd:string' ),
                            'LENGTH' => array( 'name' => 'LENGTH', 'type' => 'xsd:string' )
                        )
                    );

                    'oSENDER' => array( 'name' => 'oSENDER', 'type' => 'tns:oEmailArray' ),
                    'oREPLYTO' => array('name' => 'oREPLYTO', 'type' => 'tns:oEmailArray' ),
                    'oCC' => array('name' => 'oCC', 'type' => 'tns:oEmailArray' ),
                    'oBCC' => array('name' => 'oBCC', 'type' => 'tns:oEmailArray' ),

                    REPLYTO_EMAIL
                    REPLYTO_NAME

                    CC_EMAIL
                    CC_NAME

                    BCC_EMAIL
                    BCC_NAME

                    FROM_EMAIL
                    FROM_NAME
                     * */

                    if(isset($this->oCRNRSTN_USR)){

                        // 'oRECIPIENT' => array( 'name' => 'oRECIPIENT', 'type' => 'tns:oEmailArray'),
                        if($this->preach('isset', 'RECIPIENT_EMAIL', $i)){

                            $tmp_md5_email = $this->oCRNRSTN->hash($this->preach('value', 'RECIPIENT_EMAIL', true, $i), 'md5');
                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['EMAIL_PROXY_SERIAL']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($tmp_md5_email, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['EMAIL_PROXY_SERIAL']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt(strlen($tmp_md5_email), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['EMAIL_PROXY_SERIAL']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt('string', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['EMAIL']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'RECIPIENT_EMAIL', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['EMAIL']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt(strlen($this->preach('value', 'RECIPIENT_EMAIL', true, $i)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['EMAIL']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'RECIPIENT_EMAIL', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['NAME']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'RECIPIENT_NAME', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['NAME']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt(strlen($this->preach('value', 'RECIPIENT_NAME', true, $i)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['NAME']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'RECIPIENT_NAME', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        // 'oSENDER' => array( 'name' => 'oSENDER', 'type' => 'tns:oEmailArray'),
                        if($this->preach('isset', 'FROM_EMAIL')){

                            $tmp_cnt = $this->count('FROM_EMAIL');

                            for($ii = 0; $ii < $tmp_cnt; $ii++){

                                $tmp_md5_email = $this->oCRNRSTN->hash($this->preach('value', 'FROM_EMAIL', true, $ii), 'md5');
                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['EMAIL_PROXY_SERIAL']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($tmp_md5_email, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['EMAIL_PROXY_SERIAL']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt(strlen($tmp_md5_email), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['EMAIL_PROXY_SERIAL']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt('string', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['EMAIL']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'FROM_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['EMAIL']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt(strlen($this->preach('value', 'FROM_EMAIL', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['EMAIL']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'FROM_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['NAME']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'FROM_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['NAME']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt(strlen($this->preach('value', 'FROM_NAME', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['NAME']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'FROM_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            }

                        }

                        // 'oREPLYTO' => array('name' => 'oREPLYTO', 'type' => 'tns:oEmailArray'),
                        if($this->preach('isset', 'REPLYTO_EMAIL')){

                            $tmp_cnt = $this->count('REPLYTO_EMAIL');

                            for($ii = 0; $ii < $tmp_cnt; $ii++){

                                $tmp_md5_email = $this->oCRNRSTN->hash($this->preach('value', 'REPLYTO_EMAIL', true, $ii), 'md5');
                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['EMAIL_PROXY_SERIAL']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($tmp_md5_email, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['EMAIL_PROXY_SERIAL']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt(strlen($tmp_md5_email), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['EMAIL_PROXY_SERIAL']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt('string', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['EMAIL']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'REPLYTO_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['EMAIL']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt(strlen($this->preach('value', 'REPLYTO_EMAIL', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['EMAIL']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'REPLYTO_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['NAME']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'REPLYTO_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['NAME']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt(strlen($this->preach('value', 'REPLYTO_NAME', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['NAME']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'REPLYTO_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            }

                        }

                        // 'oCC' => array('name' => 'oCC', 'type' => 'tns:oEmailArray'),
                        if($this->preach('isset', 'CC_EMAIL')){

                            $tmp_cnt = $this->count('CC_EMAIL');

                            for($ii = 0; $ii < $tmp_cnt; $ii++){

                                $tmp_md5_email = $this->oCRNRSTN->hash($this->preach('value', 'CC_EMAIL', true, $ii), 'md5');
                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['EMAIL_PROXY_SERIAL']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($tmp_md5_email, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['EMAIL_PROXY_SERIAL']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt(strlen($tmp_md5_email), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['EMAIL_PROXY_SERIAL']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt('string', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['EMAIL']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'CC_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['EMAIL']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt(strlen($this->preach('value', 'CC_EMAIL', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['EMAIL']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'CC_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['NAME']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'CC_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['NAME']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt(strlen($this->preach('value', 'CC_NAME', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['NAME']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'CC_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            }

                        }

                        // 'oBCC' => array('name' => 'oBCC', 'type' => 'tns:oEmailArray' ),
                        if($this->preach('isset', 'BCC_EMAIL')){

                            $tmp_cnt = $this->count('BCC_EMAIL');

                            for($ii = 0; $ii < $tmp_cnt; $ii++){

                                $tmp_md5_email = $this->oCRNRSTN->hash($this->preach('value', 'BCC_EMAIL', true, $ii), 'md5');
                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['EMAIL_PROXY_SERIAL']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($tmp_md5_email, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['EMAIL_PROXY_SERIAL']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt(strlen($tmp_md5_email), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['EMAIL_PROXY_SERIAL']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt('string', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['EMAIL']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'BCC_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['EMAIL']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt(strlen($this->preach('value', 'BCC_EMAIL', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['EMAIL']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'BCC_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['NAME']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'BCC_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['NAME']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt(strlen($this->preach('value', 'BCC_NAME', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['NAME']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'BCC_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            }

                        }

                        if($this->preach('isset', 'MESSAGE_SUBJECT', $i)){

                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_SUBJECT']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'MESSAGE_SUBJECT', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_SUBJECT']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'MESSAGE_SUBJECT', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'MESSAGE_SUBJECT', true, $i));
                            //error_log(__LINE__ . ' env - MESSAGE_SUBJECT[' . $tmp_len . '] [' . $this->preach('value', 'MESSAGE_SUBJECT', true, $i) . ']');

                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_SUBJECT']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'MESSAGE_BODY_HTML', $i)){

                            //error_log($this->count('MESSAGE_BODY_HTML') . ' CLIENT BUILD REQUEST - MESSAGE_BODY_HTML string count ::');
                            //error_log(__LINE__ . ' CLIENT - HTML ENCRYPT LEN=' . strlen($this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'MESSAGE_BODY_HTML', true, $i), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp)));

                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_BODY_HTML']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'MESSAGE_BODY_HTML', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp); // $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'MESSAGE_BODY_HTML', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_BODY_HTML']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'MESSAGE_BODY_HTML', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'MESSAGE_BODY_HTML', true, $i));
                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_BODY_HTML']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'MESSAGE_BODY_TEXT', $i)){

                            //error_log($this->count('MESSAGE_BODY_TEXT') . ' CLIENT BUILD REQUEST - MESSAGE_BODY_TEXT string count[' . $i . ']=' . strlen($this->preach('value', 'MESSAGE_BODY_TEXT', true, $i)) . ' ::');

                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_BODY_TEXT']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('value', 'MESSAGE_BODY_TEXT', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_BODY_TEXT']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'MESSAGE_BODY_TEXT', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'MESSAGE_BODY_TEXT', true, $i));
                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_BODY_TEXT']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                    }else{

                        // 'oRECIPIENT' => array( 'name' => 'oRECIPIENT', 'type' => 'tns:oEmailArray' ),
                        if($this->preach('isset', 'RECIPIENT_EMAIL', $i)){

                            $tmp_md5_email = $this->oCRNRSTN->hash($this->preach('value', 'RECIPIENT_EMAIL', true, $i), 'md5');
                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['EMAIL_PROXY_SERIAL']['CONTENT'] = $this->oCRNRSTN->data_encrypt($tmp_md5_email, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['EMAIL_PROXY_SERIAL']['LENGTH'] = $this->oCRNRSTN->data_encrypt(strlen($tmp_md5_email), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['EMAIL_PROXY_SERIAL']['TYPE'] = $this->oCRNRSTN->data_encrypt('string', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['EMAIL']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'RECIPIENT_EMAIL', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['EMAIL']['LENGTH'] = $this->oCRNRSTN->data_encrypt(strlen($this->preach('value', 'RECIPIENT_EMAIL', true, $i)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['EMAIL']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'RECIPIENT_EMAIL', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['NAME']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'RECIPIENT_NAME', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['NAME']['LENGTH'] = $this->oCRNRSTN->data_encrypt(strlen($this->preach('value', 'RECIPIENT_NAME', true, $i)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['NAME']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'RECIPIENT_NAME', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        // 'oSENDER' => array( 'name' => 'oSENDER', 'type' => 'tns:oEmailArray' ),
                        if($this->preach('isset', 'FROM_EMAIL')){

                            $tmp_cnt = $this->count('FROM_EMAIL');

                            for($ii = 0; $ii < $tmp_cnt; $ii++){

                                $tmp_md5_email = $this->oCRNRSTN->hash($this->preach('value', 'FROM_EMAIL', true, $ii), 'md5');
                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['EMAIL_PROXY_SERIAL']['CONTENT'] = $this->oCRNRSTN->data_encrypt($tmp_md5_email, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['EMAIL_PROXY_SERIAL']['LENGTH'] = $this->oCRNRSTN->data_encrypt(strlen($tmp_md5_email), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['EMAIL_PROXY_SERIAL']['TYPE'] = $this->oCRNRSTN->data_encrypt('string', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['EMAIL']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'FROM_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['EMAIL']['LENGTH'] = $this->oCRNRSTN->data_encrypt(strlen($this->preach('value', 'FROM_EMAIL', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['EMAIL']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'FROM_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['NAME']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'FROM_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['NAME']['LENGTH'] = $this->oCRNRSTN->data_encrypt(strlen($this->preach('value', 'FROM_NAME', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['NAME']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'FROM_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            }

                        }

                        // 'oREPLYTO' => array('name' => 'oREPLYTO', 'type' => 'tns:oEmailArray' ),
                        if($this->preach('isset', 'REPLYTO_EMAIL')){

                            $tmp_cnt = $this->count('REPLYTO_EMAIL');

                            for($ii = 0; $ii < $tmp_cnt; $ii++){

                                $tmp_md5_email = $this->oCRNRSTN->hash($this->preach('value', 'REPLYTO_EMAIL', true, $ii), 'md5');
                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['EMAIL_PROXY_SERIAL']['CONTENT'] = $this->oCRNRSTN->data_encrypt($tmp_md5_email, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['EMAIL_PROXY_SERIAL']['LENGTH'] = $this->oCRNRSTN->data_encrypt(strlen($tmp_md5_email), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['EMAIL_PROXY_SERIAL']['TYPE'] = $this->oCRNRSTN->data_encrypt('string', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['EMAIL']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'REPLYTO_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['EMAIL']['LENGTH'] = $this->oCRNRSTN->data_encrypt(strlen($this->preach('value', 'REPLYTO_EMAIL', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['EMAIL']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'REPLYTO_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['NAME']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'REPLYTO_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['NAME']['LENGTH'] = $this->oCRNRSTN->data_encrypt(strlen($this->preach('value', 'REPLYTO_NAME', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['NAME']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'REPLYTO_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            }

                        }

                        // 'oCC' => array('name' => 'oCC', 'type' => 'tns:oEmailArray' ),
                        if($this->preach('isset', 'CC_EMAIL')){

                            $tmp_cnt = $this->count('CC_EMAIL');

                            for($ii = 0; $ii < $tmp_cnt; $ii++){

                                $tmp_md5_email = $this->oCRNRSTN->hash($this->preach('value', 'CC_EMAIL', true, $ii), 'md5');
                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['EMAIL_PROXY_SERIAL']['CONTENT'] = $this->oCRNRSTN->data_encrypt($tmp_md5_email, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['EMAIL_PROXY_SERIAL']['LENGTH'] = $this->oCRNRSTN->data_encrypt(strlen($tmp_md5_email), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['EMAIL_PROXY_SERIAL']['TYPE'] = $this->oCRNRSTN->data_encrypt('string', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['EMAIL']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'CC_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['EMAIL']['LENGTH'] = $this->oCRNRSTN->data_encrypt(strlen($this->preach('value', 'CC_EMAIL', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['EMAIL']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'CC_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['NAME']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'CC_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['NAME']['LENGTH'] = $this->oCRNRSTN->data_encrypt(strlen($this->preach('value', 'CC_NAME', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['NAME']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'CC_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            }

                        }

                        // 'oBCC' => array('name' => 'oBCC', 'type' => 'tns:oEmailArray' ),
                        if($this->preach('isset', 'BCC_EMAIL')){

                            $tmp_cnt = $this->count('BCC_EMAIL');

                            for($ii = 0; $ii < $tmp_cnt; $ii++){

                                $tmp_md5_email = $this->oCRNRSTN->hash($this->preach('value', 'BCC_EMAIL', true, $ii), 'md5');
                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['EMAIL_PROXY_SERIAL']['CONTENT'] = $this->oCRNRSTN->data_encrypt($tmp_md5_email, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['EMAIL_PROXY_SERIAL']['LENGTH'] = $this->oCRNRSTN->data_encrypt(strlen($tmp_md5_email), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['EMAIL_PROXY_SERIAL']['TYPE'] = $this->oCRNRSTN->data_encrypt('string', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['EMAIL']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'BCC_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['EMAIL']['LENGTH'] = $this->oCRNRSTN->data_encrypt(strlen($this->preach('value', 'BCC_EMAIL', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['EMAIL']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'BCC_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['NAME']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'BCC_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['NAME']['LENGTH'] = $this->oCRNRSTN->data_encrypt(strlen($this->preach('value', 'BCC_NAME', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['NAME']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'BCC_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            }

                        }

                        if($this->preach('isset', 'MESSAGE_SUBJECT', $i)){

                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_SUBJECT']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'MESSAGE_SUBJECT', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_SUBJECT']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'MESSAGE_SUBJECT', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'MESSAGE_SUBJECT', true, $i));
                            //error_log(__LINE__ . ' env - MESSAGE_SUBJECT[' . $tmp_len . '] [' . $this->preach('value', 'MESSAGE_SUBJECT', true, $i) . ']');

                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_SUBJECT']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'MESSAGE_BODY_HTML', $i)){

                            //error_log($this->count('MESSAGE_BODY_HTML') . ' CLIENT BUILD REQUEST - MESSAGE_BODY_HTML string count ::');
                            //error_log(__LINE__ . ' CLIENT - HTML ENCRYPT LEN=' . strlen($this->oCRNRSTN->data_encrypt($this->preach('value', 'MESSAGE_BODY_HTML', true, $i), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp)));

                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_BODY_HTML']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'MESSAGE_BODY_HTML', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp); // $this->oCRNRSTN->data_encrypt($this->preach('value', 'MESSAGE_BODY_HTML', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_BODY_HTML']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'MESSAGE_BODY_HTML', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'MESSAGE_BODY_HTML', true, $i));
                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_BODY_HTML']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'MESSAGE_BODY_TEXT', $i)){

                            //error_log($this->count('MESSAGE_BODY_TEXT') . ' CLIENT BUILD REQUEST - MESSAGE_BODY_TEXT string count[' . $i . ']=' . strlen($this->preach('value', 'MESSAGE_BODY_TEXT', true, $i)) . ' ::');

                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_BODY_TEXT']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('value', 'MESSAGE_BODY_TEXT', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_BODY_TEXT']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'MESSAGE_BODY_TEXT', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('value', 'MESSAGE_BODY_TEXT', true, $i));
                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_BODY_TEXT']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                    }

                    $SOAP_request_ARRAY[] = $SOAP_request;

                }

                break;

        }

        return $SOAP_request_ARRAY;

    }

    public function set_decryption_profile($SOAP_ENCRYPT_CIPHER, $SOAP_ENCRYPT_SECRET_KEY, $SOAP_ENCRYPT_HMAC_ALG, $SOAP_ENCRYPT_OPTIONS){

        $this->soap_encrypt_cipher = $SOAP_ENCRYPT_CIPHER;
        $this->soap_encrypt_secret_key = $SOAP_ENCRYPT_SECRET_KEY;
        $this->soap_encrypt_hmac_alg = $SOAP_ENCRYPT_HMAC_ALG;
        $this->soap_encrypt_options = $SOAP_ENCRYPT_OPTIONS;

        $this->soap_decrypt_cipher = $SOAP_ENCRYPT_CIPHER;
        $this->soap_decrypt_secret_key = $SOAP_ENCRYPT_SECRET_KEY;
        $this->soap_decrypt_hmac_alg = $SOAP_ENCRYPT_HMAC_ALG;
        $this->soap_decrypt_options = $SOAP_ENCRYPT_OPTIONS;

    }

    public function consume_SOAP_data_object($soap_data_object, $object_name, $object_type){

        switch($object_type){
            case 'tns:oSOAP_Data':

                //error_log(__LINE__ . ' SERVER - decrypting ' . $object_name . ' data as tyep=' . $object_type);
                //error_log(__LINE__ . ' SERVER [' . $soap_data_object['CONTENT'] . '][' . $soap_data_object['TYPE'] . '][' . $soap_data_object['LENGTH'] . ']');
                //error_log(__LINE__ . ' SERVER - ENCRYPT profile[' . $this->soap_encrypt_cipher . '][' . $this->soap_encrypt_secret_key . '][' . $this->soap_encrypt_hmac_alg . '][' . $this->soap_encrypt_options . ']');
                error_log(__LINE__ . ' SERVER - ' . $object_name . ' | ' . $object_type);
                ///error_log(__LINE__ . ' SERVER - DECRYPT [TYPE=' . gettype($soap_data_object['CONTENT']) . '][' . $soap_data_object['CONTENT'] . '] profile[' . $this->soap_decrypt_cipher . '][' . $this->soap_decrypt_secret_key . '][' . $this->soap_decrypt_hmac_alg . '][' . $this->soap_decrypt_options . ']');

                //
                // DECRYPT SOAP OBJECT DATA
                if(isset($this->oCRNRSTN_USR)){

                    $tmp_content = $this->oCRNRSTN_USR->data_decrypt($soap_data_object['CONTENT'], CRNRSTN_ENCRYPT_SOAP, true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);
                    $tmp_type = $this->oCRNRSTN_USR->data_decrypt($soap_data_object['TYPE'], CRNRSTN_ENCRYPT_SOAP, true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);
                    $tmp_len = $this->oCRNRSTN_USR->data_decrypt($soap_data_object['LENGTH'], CRNRSTN_ENCRYPT_SOAP, true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);

                }else{

                    $tmp_content = $this->oCRNRSTN->data_decrypt($soap_data_object['CONTENT'], CRNRSTN_ENCRYPT_SOAP, true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);
                    $tmp_type = $this->oCRNRSTN->data_decrypt($soap_data_object['TYPE'], CRNRSTN_ENCRYPT_SOAP, true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);
                    $tmp_len = $this->oCRNRSTN->data_decrypt($soap_data_object['LENGTH'], CRNRSTN_ENCRYPT_SOAP, true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);

                }

                error_log(__LINE__ . ' SERVER - [' . $object_name . '][' . $tmp_len . '!=' . strlen($tmp_content) . '][' . $tmp_type . ']');
                if((int) $tmp_len != strlen($tmp_content)){

                    //
                    // DATA CORRUPTION. TERMINATE.
                    error_log(__LINE__ . ' SERVER - DATA CORRUPTION[' . $object_name . '][' . $object_type . ']. TERMINATE. Content[' . $tmp_content . '|[' . $tmp_type . ']] of len[' . strlen($tmp_content) . '] !=SOAP len[' . $tmp_len . ']');
                    return false;

                }else{

                    //
                    // CONSUME SOAP STRING DATA INTO DTL WITH TYPE RECOGNITION.
                    return $this->injest_SOAP_request_param($tmp_content, $tmp_type, $object_name);

                }

            break;
            case 'tns:oEmailArray':

                $tmp_obj_cnt = sizeof($soap_data_object);

                switch($object_name){
                    case 'oRECIPIENT':

                        $tmp_email_nom = 'RECIPIENT_EMAIL';
                        $tmp_name_nom = 'RECIPIENT_NAME';

                    break;
                    case 'oSENDER':

                        $tmp_email_nom = 'FROM_EMAIL';
                        $tmp_name_nom = 'FROM_NAME';

                    break;
                    case 'oREPLYTO':

                        $tmp_email_nom = 'REPLYTO_EMAIL';
                        $tmp_name_nom = 'REPLYTO_NAME';

                    break;
                    case 'oCC':

                        $tmp_email_nom = 'CC_EMAIL';
                        $tmp_name_nom = 'CC_NAME';

                    break;
                    case 'oBCC':

                        //error_log(__LINE__);
                        $tmp_email_nom = 'BCC_EMAIL';
                        $tmp_name_nom = 'BCC_NAME';

                    break;

                }

                for($i = 0; $i < $tmp_obj_cnt; $i++){

                    //
                    // DECRYPT SOAP OBJECT DATA
                    if(isset($this->oCRNRSTN_USR)){

                        $tmp_EMAIL_PROXY_SERIAL_content = $this->oCRNRSTN_USR->data_decrypt($soap_data_object[$i]['EMAIL_PROXY_SERIAL']['CONTENT'], CRNRSTN_ENCRYPT_SOAP, true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);
                        $tmp_EMAIL_PROXY_SERIAL_type = $this->oCRNRSTN_USR->data_decrypt($soap_data_object[$i]['EMAIL_PROXY_SERIAL']['TYPE'], CRNRSTN_ENCRYPT_SOAP, true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);
                        $tmp_EMAIL_PROXY_SERIAL_len = $this->oCRNRSTN_USR->data_decrypt($soap_data_object[$i]['EMAIL_PROXY_SERIAL']['LENGTH'], CRNRSTN_ENCRYPT_SOAP, true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);

                        //
                        // DECRYPT SOAP OBJECT DATA
                        $tmp_EMAIL_content = $this->oCRNRSTN_USR->data_decrypt($soap_data_object[$i]['EMAIL']['CONTENT'], CRNRSTN_ENCRYPT_SOAP, true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);
                        $tmp_EMAIL_type = $this->oCRNRSTN_USR->data_decrypt($soap_data_object[$i]['EMAIL']['TYPE'], CRNRSTN_ENCRYPT_SOAP, true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);
                        $tmp_EMAIL_len = $this->oCRNRSTN_USR->data_decrypt($soap_data_object[$i]['EMAIL']['LENGTH'], CRNRSTN_ENCRYPT_SOAP, true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);

                        //
                        // DECRYPT SOAP OBJECT DATA
                        $tmp_NAME_content = $this->oCRNRSTN_USR->data_decrypt($soap_data_object[$i]['NAME']['CONTENT'], CRNRSTN_ENCRYPT_SOAP, true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);
                        $tmp_NAME_type = $this->oCRNRSTN_USR->data_decrypt($soap_data_object[$i]['NAME']['TYPE'], CRNRSTN_ENCRYPT_SOAP, true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);
                        $tmp_NAME_len = $this->oCRNRSTN_USR->data_decrypt($soap_data_object[$i]['NAME']['LENGTH'], CRNRSTN_ENCRYPT_SOAP, true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);

                    }else{

                        $tmp_EMAIL_PROXY_SERIAL_content = $this->oCRNRSTN->data_decrypt($soap_data_object[$i]['EMAIL_PROXY_SERIAL']['CONTENT'], CRNRSTN_ENCRYPT_SOAP, true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);
                        $tmp_EMAIL_PROXY_SERIAL_type = $this->oCRNRSTN->data_decrypt($soap_data_object[$i]['EMAIL_PROXY_SERIAL']['TYPE'], CRNRSTN_ENCRYPT_SOAP, true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);
                        $tmp_EMAIL_PROXY_SERIAL_len = $this->oCRNRSTN->data_decrypt($soap_data_object[$i]['EMAIL_PROXY_SERIAL']['LENGTH'], CRNRSTN_ENCRYPT_SOAP, true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);

                        //
                        // DECRYPT SOAP OBJECT DATA
                        $tmp_EMAIL_content = $this->oCRNRSTN->data_decrypt($soap_data_object[$i]['EMAIL']['CONTENT'], CRNRSTN_ENCRYPT_SOAP, true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);
                        $tmp_EMAIL_type = $this->oCRNRSTN->data_decrypt($soap_data_object[$i]['EMAIL']['TYPE'], CRNRSTN_ENCRYPT_SOAP, true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);
                        $tmp_EMAIL_len = $this->oCRNRSTN->data_decrypt($soap_data_object[$i]['EMAIL']['LENGTH'], CRNRSTN_ENCRYPT_SOAP, true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);

                        //
                        // DECRYPT SOAP OBJECT DATA
                        $tmp_NAME_content = $this->oCRNRSTN->data_decrypt($soap_data_object[$i]['NAME']['CONTENT'], CRNRSTN_ENCRYPT_SOAP, true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);
                        $tmp_NAME_type = $this->oCRNRSTN->data_decrypt($soap_data_object[$i]['NAME']['TYPE'], CRNRSTN_ENCRYPT_SOAP, true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);
                        $tmp_NAME_len = $this->oCRNRSTN->data_decrypt($soap_data_object[$i]['NAME']['LENGTH'], CRNRSTN_ENCRYPT_SOAP, true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);

                    }

                    if((int) $tmp_EMAIL_PROXY_SERIAL_len != strlen($tmp_EMAIL_PROXY_SERIAL_content)){

                        //
                        // DATA CORRUPTION. TERMINATE.
                        error_log(__LINE__ . ' SERVER - DATA CORRUPTION[' . $object_name . '][' . $object_type . ']. TERMINATE. Content[' . $tmp_EMAIL_PROXY_SERIAL_content . '|[' . $tmp_EMAIL_PROXY_SERIAL_type . ']] of len[' . strlen($tmp_EMAIL_PROXY_SERIAL_content) . '] !=SOAP len[' . $tmp_EMAIL_PROXY_SERIAL_len . ']');
                        return false;

                    }else{

                        if((int) $tmp_EMAIL_len != strlen($tmp_EMAIL_content)){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            error_log(__LINE__ . ' SERVER - DATA CORRUPTION[' . $object_name . '][' . $object_type . ']. TERMINATE. Content[' . $tmp_EMAIL_content . '|[' . $tmp_EMAIL_type . ']] of len[' . strlen($tmp_EMAIL_content) . '] !=SOAP len[' . $tmp_EMAIL_len . ']');
                            return false;

                        }else{

                            if((int) $tmp_NAME_len != strlen($tmp_NAME_content)){

                                //
                                // DATA CORRUPTION. TERMINATE.
                                error_log(__LINE__ . ' SERVER - DATA CORRUPTION[' . $object_name . '][' . $object_type . ']. TERMINATE. Content[' . $tmp_NAME_content . '|[' . $tmp_NAME_type . ']] of len[' . strlen($tmp_NAME_content) . '] !=SOAP len[' . $tmp_NAME_len . ']');
                                return false;

                            }else{

                                //
                                // CONSUME SOAP STRING DATA INTO DTL WITH TYPE RECOGNITION.
                                $this->injest_SOAP_request_param($tmp_EMAIL_PROXY_SERIAL_content, $tmp_EMAIL_PROXY_SERIAL_type, 'EMAIL_PROXY_SERIAL');
                                $this->injest_SOAP_request_param($tmp_NAME_content, $tmp_NAME_type, $tmp_name_nom);

                                return $this->injest_SOAP_request_param($tmp_EMAIL_content, $tmp_EMAIL_type, $tmp_email_nom);

                            }

                        }

                    }

                }

            break;
            case 'xsd:string':

                if(isset($this->oCRNRSTN_USR)){

                    $tmp_content = $this->oCRNRSTN_USR->data_decrypt($soap_data_object, CRNRSTN_ENCRYPT_SOAP, true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);

                }else{

                    $tmp_content = $this->oCRNRSTN->data_decrypt($soap_data_object, CRNRSTN_ENCRYPT_SOAP, true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);

                }

                return $this->injest_SOAP_request_param($tmp_content, 'string', $object_name);

            break;

        }

        return true;

    }

    private function injest_SOAP_request_param($content, $type, $object_name){

        error_log(__LINE__ . ' env SERVER ddo injest_SOAP_request_param [' . $type . '][' . $object_name . ']');

        switch($type){
            case 'int':

                $content = (int) $content;

            break;
            case 'integer':

                $content = (integer) $content;

            break;
            case 'bool':
            case 'boolean':

                // strings 'true' or 'false'
                if($content == 'true'){

                    error_log(__LINE__ . ' env SERVER ddo - BOOL[' . $object_name . '][' . $content . ']true');

                    $content = true;

                }else{

                    error_log(__LINE__ . ' env SERVER ddo - BOOL[' . $object_name . '][' . $content . ']false');

                    $content = false;

                }

            break;
            case 'double':

                $content = (double) $content;

            break;
            case 'string':

                $content = (string) $content;

            break;
            case 'array':

                error_log(__LINE__ . ' env SERVER ddo - ARRAY[' . $object_name . '][' . $content . ']array');

                //$content = (array) $content;
                $content = (string) $type;

            break;
            case 'object':

                error_log(__LINE__ . ' env SERVER ddo - OBJECT[' . $object_name . '][' . $content . ']object');

                //$content = (object) $content;
                $content = (string) $type;

            break;
            case 'resource':
            case 'resource (closed)':

                error_log(__LINE__ . ' env SERVER ddo - RESOURCE/RESOURCE (CLOSED)[' . $object_name . '][' . $content . ']object');

                //$content = $content;
                $content = (string) $type;

            break;
            case 'null':

                error_log(__LINE__ . ' env SERVER ddo - NULL[' . $object_name . '][' . $content . ']null');

                $content = NULL;

            break;
            case 'unknown type':
            default:

                error_log(__LINE__ . ' env SERVER ddo - SURE, I BELIEVE IN YOU.[' . $object_name . '][' . $content . ']');

                //
                // SURE, I BELIEVE IN YOU.
                //$content = $content;

            break;

        }

        $this->add($content, $object_name);

        return true;

    }

    public function __destruct() {

    }

}

# # C # R # N # R # S # T # N # : : # # ##
#  CLASS :: crnrstn_logging_oprofile_manager
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: Monday October 26, 2020 @ 2054hrs
#  DESCRIPTION ::
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
class crnrstn_logging_oprofile_manager {
    
    protected $oLogger;

    protected $env_key;
    protected $resource_key;
    protected $config_serial_hash;

    protected $oLog_profiles_ARRAY = array();
    protected $log_profiles_ARRAY = array();
    protected $logging_profile_pack;
    protected $oWildCardResource_ARRAY = array();

    protected $profile_endpoint_criteria_ARRAY = array();

    public function __construct($sys_logging_profile_pack, $oCRNRSTN) {

        /*
        $sys_logging_profile_pack['sys_logging_profile_ARRAY'] = ARRAY[self::$oCRNRSTN_n->hash($this->config_serial_hash)][self::$resource_key];
        $sys_logging_profile_pack['sys_logging_meta_ARRAY'] = ARRAY[self::$oCRNRSTN_n->hash($this->config_serial_hash)][self::$resource_key];
        $sys_logging_profile_pack['sys_logging_wcr_ARRAY'] = ARRAY[self::$oCRNRSTN_n->hash($this->config_serial_hash)][CRNRSTN_LOG_ALL];
        */

        $this->config_serial_hash = $oCRNRSTN->get_server_config_serial('hash');

        $this->oWildCardResource_ARRAY = $oCRNRSTN->oWildCardResource_ARRAY;

        $this->build_sys_wcr_profile_criteria();

        $this->load_system_profiles();

        $this->logging_profile_pack = $sys_logging_profile_pack;

        $this->spool_up_logging_profiles($oCRNRSTN);

        $this->oLogger = new crnrstn_logging(__CLASS__, $oCRNRSTN);

        // $oCRNRSTN->oLog_output_ARRAY[] = $oCRNRSTN->error_log('Instantiating logging output profile manager within this environment.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

    }

    public function return_olog_profile($profile_key){

        foreach ($this->oLog_profiles_ARRAY as $key => $oLog_profile) {

            if ($oLog_profile->isValid) {

                error_log(__LINE__ . ' env VALID log profile [' . $profile_key . '][' . $key . '][' . $oLog_profile->logging_profile . ']');
                if ($profile_key == $oLog_profile->logging_profile) {

                    return $oLog_profile;

                }

            }else{

                error_log(__LINE__ . ' env !INVALID! log profile [' . $profile_key . '][' . $key . '][' . $oLog_profile->logging_profile . ']');

            }
        }

        return false;

    }

    public function notification_go($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj){

        foreach($this->oLog_profiles_ARRAY as $key => $oLog_profile){

            switch(get_class($oCRNRSTN_n)){
                case 'crnrstn_user':
                case 'crnrstn_environment':
                case 'crnrstn':

                    if($oCRNRSTN_n->is_bit_set($oLog_profile->logging_profile)){

                        //
                        // SOURCE :: https://www.youtube.com/watch?v=83KR_UBWdPI
                        // TITLE :: Arcade Fire - No Cars Go
                        if (!$oLog_profile->no_cars_tification_go($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj)) {

                            error_log('Error processing the following message through logging profile (int) ' . $oLog_profile->logging_profile . '. :: ' . $tmp_exception_output_str);

                            die();

                        }

                    }

                break;

            }

        }

    }

    private function build_sys_wcr_profile_criteria(){

        $this->profile_endpoint_criteria_ARRAY = array();

        //
        // EMAIL
        $log_profile_key = CRNRSTN_LOG_EMAIL;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['EMAIL_PROTOCOL'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['TRY_OTHER_EMAIL_METHODS_ON_ERR'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_AUTH'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_SERVER'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_PORT_OUTGOING'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_USERNAME'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_PASSWORD'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_TIMEOUT'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_KEEPALIVE'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_SECURE'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_AUTOTLS'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_AUTOTLS'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['DIBYA_SAHOO_SSL_CERT_BYPASS'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SENDMAIL_PATH'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['USE_SENDMAIL_OPTIONS'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['ALLOW_EMPTY'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FROM_NAME'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['REPLYTO_NAME_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CC_NAME_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['BCC_NAME_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['RECIPIENTS_NAME_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FROM_EMAIL'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['REPLYTO_EMAIL_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CC_EMAIL_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['BCC_EMAIL_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['RECIPIENTS_EMAIL_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SUBJECT_LINE'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['MESSAGE_BODY_HTML'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['MESSAGE_BODY_TEXT'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['WORDWRAP'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['ISHTML'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['PRIORITY'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CHARSET'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['MESSAGE_ENCODING'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['DUP_SUPPRESS'] = 1;

        //
        // EMAIL_PROXY
        $log_profile_key = CRNRSTN_LOG_EMAIL_PROXY;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CRNRSTN_SOAP_SVC_AUTH_KEY'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CRNRSTN_SOAP_SVC_USERNAME'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CRNRSTN_SOAP_SVC_PASSWORD'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CRNRSTN_SOAP_SVC_ENCRYPTION_KEY'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_SECRET_KEY_CONNECTION'] = 1;

        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOA_NAMESPACE'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['WSDL_URI'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['WSDL_CACHE_TTL'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['NUSOAP_USECURL'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_CIPHER'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_OPTIONS'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_HMAC_ALG'] = 1;

        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['EMAIL_PROTOCOL'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['TRY_OTHER_EMAIL_METHODS_ON_ERR'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_AUTH'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_SERVER'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_PORT_OUTGOING'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_USERNAME'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_PASSWORD'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_TIMEOUT'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_KEEPALIVE'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_SECURE'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_AUTOTLS'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_AUTOTLS'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['DIBYA_SAHOO_SSL_CERT_BYPASS'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SENDMAIL_PATH'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['USE_SENDMAIL_OPTIONS'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['ALLOW_EMPTY'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FROM_NAME'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['REPLYTO_NAME_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CC_NAME_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['BCC_NAME_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['RECIPIENTS_NAME_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FROM_EMAIL'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['REPLYTO_EMAIL_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CC_EMAIL_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['BCC_EMAIL_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['RECIPIENTS_EMAIL_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SUBJECT_LINE'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['MESSAGE_BODY_HTML'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['MESSAGE_BODY_TEXT'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['WORDWRAP'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['ISHTML'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['PRIORITY'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CHARSET'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['MESSAGE_ENCODING'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['DUP_SUPPRESS'] = 1;

        //
        // FILE
        $log_profile_key = CRNRSTN_LOG_FILE;
        //$this->profile_endpoint_criteria_ARRAY[$log_profile_key]['LOCAL_DIR_PATH'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['LOCAL_DIR_FILEPATH'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['LOCAL_MKDIR_MODE'] = 1;

        //
        // FTP
        $log_profile_key = CRNRSTN_LOG_FILE_FTP;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_SERVER'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_USERNAME'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_PASSWORD'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_PORT'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_TIMEOUT'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_IS_SSL'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_USE_PASV'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_USE_PASV_ADDR'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_DISABLE_AUTOSEEK'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_DIR_PATH'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_MKDIR_MODE'] = 1;

        //
        // OPEN_SOURCE
        $log_profile_key = CRNRSTN_RESOURCE_OPENSOURCE;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CRNRSTN_SOAP_SVC_AUTH_KEY'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CRNRSTN_SOAP_SVC_USERNAME'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CRNRSTN_SOAP_SVC_PASSWORD'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOA_NAMESPACE'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['WSDL_URI'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['WSDL_CACHE_TTL'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['NUSOAP_USECURL'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CRNRSTN_SOAP_SVC_ENCRYPTION_KEY'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_SECRET_KEY_CONNECTION'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_CIPHER'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_OPTIONS'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_HMAC_ALG'] = 1;

        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['ZIPCODE'] = 1;


        //
        // XXXXX
        //$log_profile_key = 'XXXXX';
        //$this->profile_endpoint_criteria_ARRAY[$log_profile_key]['PORT'] = 1;
        //$this->profile_endpoint_criteria_ARRAY[$log_profile_key]['USERNAME'] = 1;
        //$this->profile_endpoint_criteria_ARRAY[$log_profile_key]['PASSWORD'] = 1;

    }

    private function is_WCR_key($sys_logging_wcr_ARRAY, $str){

        //if(isset($this->oWildCardResource_ARRAY)){
        // error_log('2448 env - is_WCR_key() TEST NEW !!ARRAY FORK AGAINST ARRAY sizeof>0, where sizeof='.sizeof($this->oWildCardResource_ARRAY[self::$oCRNRSTN_n->hash($this->config_serial_hash)]));

        //
        // SOURCE :: https://www.php.net/manual/en/language.types.boolean.php
        // AUTHOR :: artktec at gmail dot com :: https://www.php.net/manual/en/language.types.boolean.php#78099
        // This can be a substitute for count($array) > 0 or !(empty($array)) to check to see if an array is empty or not (you would use: !!$array).
        if(!!$sys_logging_wcr_ARRAY){

            foreach ($sys_logging_wcr_ARRAY as $key0 => $chunkArray0) {

                foreach($chunkArray0 as $key => $oWCR){

                    if($str == $oWCR->return_resource_key()){

                        return $oWCR;

                    }

                }

            }

        }

        return false;

    }

                                                    # EMAIL, E@E.COM, FALSE
                                                    # EMAIL, WCR_KEY, TRUE
    private function oLog_profile_endpoint_update($profile, $value, $oWCR = NULL){

        foreach($this->oLog_profiles_ARRAY as $key => $oLog_profile){

            if($profile == $oLog_profile->return_profile()){

                //
                // WCR?
                if(is_object($oWCR)){

                    switch($profile){
                        case CRNRSTN_LOG_EMAIL:

                            error_log(__LINE__ . ' env - RUN receive_profile_EMAIL_WCR() ' . $oLog_profile->return_profile());

                            //
                            // ADD WCR DATA TO oLog_profile
                            $oLog_profile->receive_profile_EMAIL_WCR($oWCR, $value);
                            $oLog_profile->isValid = true;

                        break;
                        case CRNRSTN_LOG_EMAIL_PROXY:

                            error_log(__LINE__ . ' env - RUN receive_profile_EMAIL_PROXY_WCR() ' . $oLog_profile->return_profile());

                            $oLog_profile->receive_profile_EMAIL_PROXY_WCR($oWCR, $value);
                            $oLog_profile->isValid = true;

                        break;
                        case CRNRSTN_LOG_FILE_FTP:

                            error_log(__LINE__ . ' env - RUN receive_profile_FTP_WCR() ' . $oLog_profile->return_profile());

                            $oLog_profile->receive_profile_FTP_WCR($oWCR, $value);
                            $oLog_profile->isValid = true;

                        break;
                        case CRNRSTN_LOG_FILE:

                            //error_log(__LINE__ . ' env - RUN receive_profile_FILE_WCR() [' . $value . '] ' . $oLog_profile->return_profile());

                            $oLog_profile->receive_profile_FILE_WCR($oWCR, $value);
                            $oLog_profile->isValid = true;
                            //error_log(__LINE__ .' env - WE RAN receive_profile_FILE_WCR() ['.$value . ']');

                        break;
                        case CRNRSTN_RESOURCE_OPENSOURCE:

                            error_log(__LINE__ . ' env - RUN receive_profile_RESOURCE_OPENSOURCE_WCR() ' . $oLog_profile->return_profile());

                            $oLog_profile->receive_profile_RESOURCE_OPENSOURCE_WCR($oWCR, $value);
                            $oLog_profile->isValid = true;

                        break;

                    }

                }else{

                    //
                    // ADD RAW DATA TO oLog_profile
                    switch($profile){
                        case CRNRSTN_LOG_EMAIL:
                        case CRNRSTN_LOG_EMAIL_PROXY:

                            error_log(__LINE__ . ' env - RUN receive_profile_EMAIL() ' . $oLog_profile->return_profile());

                            //
                            // ADD DATA TO oLog_profile
                            $oLog_profile->receive_profile_EMAIL($value, 'RECIPIENTS_EMAIL_PIPED');
                            $oLog_profile->isValid = true;

                        break;
                        case CRNRSTN_LOG_FILE:

                            error_log(__LINE__ . ' env - RUN receive_profile_FILE() ' . $oLog_profile->return_profile());

                            $oLog_profile->receive_profile_FILE($value);
                            $oLog_profile->isValid = true;

                        break;

                    }

                }

            }

        }

        return true;

    }

    public function consume_init_profile_pack($init_profile_pack){

        /*
        init_profile_pack_ARRAY ::
        $init_profile_pack['sys_logging_profile_ARRAY'] = self::$sys_logging_profile_ARRAY[self::$oCRNRSTN_n->hash($this->config_serial_hash)][CRNRSTN_LOG_ALL];
        $init_profile_pack['sys_logging_meta_ARRAY'] = self::$sys_logging_meta_ARRAY[self::$oCRNRSTN_n->hash($this->config_serial_hash)][CRNRSTN_LOG_ALL];
        $init_profile_pack['sys_logging_wcr_ARRAY'] = $this->oWildCardResource_ARRAY[self::$oCRNRSTN_n->hash($this->config_serial_hash)][CRNRSTN_LOG_ALL];
        */

        if(isset($init_profile_pack['sys_logging_meta_ARRAY'])){

            foreach ($init_profile_pack['sys_logging_meta_ARRAY'] as $key => $value) {

                //error_log(__LINE__ . ' env - HOW MANY META DATA PROCESS? [' . $init_profile_pack['sys_logging_meta_ARRAY'][$key] . '] FOR DATA ' . $value);
                //error_log(__LINE__ . ' env - (int) ' . print_r($init_profile_pack['sys_logging_profile_ARRAY'][$key], true) . ' HANDLE META VALUE ' . print_r($value, true));

                switch($init_profile_pack['sys_logging_profile_ARRAY'][$key]){
                    case CRNRSTN_LOG_EMAIL:

                        $pos_at = strpos($value, '@');

                        //error_log(__LINE__ . ' env [' . get_class() . '] ping. wcr=' . print_r($this->oWildCardResource_ARRAY, true));
                        if($pos_at !== false){

//                            if($this->is_WCR_key($value)){

//                                error_log(__LINE__ . ' env [' . get_class() . '] ping.');
//                                //
//                                // PROCESS FOR WCR
//                                $tmp_oWCR = $this->is_WCR_key($value);
//                                if(is_array($tmp_oWCR)){
//
//                                    foreach($tmp_oWCR as $wcr_key => $oWCR){
//
//                                        if($value == $oWCR->return_resource_key()){
//
//                                            //
//                                            // PROCESS FOR WCR
//                                            error_log(__LINE__ . ' env - PROCESS[' . $init_profile_pack['sys_logging_meta_ARRAY'][$key] . '] FOR WCR ' . $value);
//                                            $this->oLog_profile_endpoint_update($init_profile_pack['sys_logging_meta_ARRAY'][$key], $value, $oWCR);
//
//                                        }
//
//                                    }
//
//                                }
//
//                                error_log(__LINE__ . ' env [' . get_class() . '] ping.');
//
//                            }

                            //else{

                                //
                                // PROCESS FOR EMAIL ADDRESS
                                //error_log(__LINE__ . ' env - PROCESS['.$init_profile_pack['sys_logging_meta_ARRAY'][$key] . '] FOR EMAIL_ADDR ' . $value);
                                $this->oLog_profile_endpoint_update($init_profile_pack['sys_logging_profile_ARRAY'][$key], $value);

                            //}

                        }else{

                            $tmp_oWCR = $this->is_WCR_key($init_profile_pack['sys_logging_wcr_ARRAY'], $value);

                            if(is_object($tmp_oWCR)){

                                error_log(__LINE__ . ' env - PROCESS[' . $init_profile_pack['sys_logging_meta_ARRAY'][$key] . '] FOR WCR ' . $value);

                                $this->oLog_profile_endpoint_update($init_profile_pack['sys_logging_profile_ARRAY'][$key], $value, $tmp_oWCR);

                            }

                        }

                    break;
                    case CRNRSTN_LOG_EMAIL_PROXY:

                        $pos_at = strpos($value, '@');
                        if($pos_at !== false){

                            //
                            // PROCESS FOR EMAIL ADDRESS
                            //error_log(__LINE__ . ' env - PROCESS[' . $init_profile_pack['sys_logging_meta_ARRAY'][$key] . '] FOR EMAIL_ADDR ' . $value);
                            $this->oLog_profile_endpoint_update($init_profile_pack['sys_logging_profile_ARRAY'][$key], $value);

                        }else{

                            $tmp_oWCR = $this->is_WCR_key($init_profile_pack['sys_logging_wcr_ARRAY'], $value);

                            if(is_object($tmp_oWCR)){

                                error_log(__LINE__ . ' env - PROCESS[' . $init_profile_pack['sys_logging_meta_ARRAY'][$key] . '] FOR WCR ' . $value);

                                $this->oLog_profile_endpoint_update($init_profile_pack['sys_logging_profile_ARRAY'][$key], $value, $tmp_oWCR);

                            }

                        }

                    break;
                    case CRNRSTN_LOG_FILE:
                    case CRNRSTN_RESOURCE_OPENSOURCE:

                        $tmp_oWCR = $this->is_WCR_key($init_profile_pack['sys_logging_wcr_ARRAY'], $value);

                        if(is_object($tmp_oWCR)){

                            error_log(__LINE__ . ' env - PROCESS[' . $init_profile_pack['sys_logging_meta_ARRAY'][$key] . '] FOR WCR ' . $value);
                            $this->oLog_profile_endpoint_update($init_profile_pack['sys_logging_profile_ARRAY'][$key], $value, $tmp_oWCR);

                        }else{

                            error_log(__LINE__ . ' env - PROCESS[' . $init_profile_pack['sys_logging_meta_ARRAY'][$key] . '] FOR PATH ' . $value);
                            $this->oLog_profile_endpoint_update($init_profile_pack['sys_logging_profile_ARRAY'][$key], $value);

                        }

                    break;
//                    case CRNRSTN_RESOURCE_OPENSOURCE:
//
//                        $tmp_oWCR = $this->is_WCR_key($init_profile_pack['sys_logging_wcr_ARRAY'], $value);
//                        if(is_object($tmp_oWCR)){
//
//                            error_log(__LINE__ . ' env - PROCESS[' . $init_profile_pack['sys_logging_meta_ARRAY'][$key] . '] FOR WCR ' . $value);
//                            $this->oLog_profile_endpoint_update($init_profile_pack['sys_logging_profile_ARRAY'][$key], $value, $tmp_oWCR);
//
//                        }else{
//
//                            error_log(__LINE__ . ' env - PROCESS[' . $init_profile_pack['sys_logging_meta_ARRAY'][$key] . '] FOR PATH ' . $value);
//                            $this->oLog_profile_endpoint_update($init_profile_pack['sys_logging_profile_ARRAY'][$key], $value);
//
//                        }
//
//                    break;
                    case CRNRSTN_LOG_FILE_FTP:

                        $tmp_oWCR = $this->is_WCR_key($init_profile_pack['sys_logging_wcr_ARRAY'], $value);

                        if(is_object($tmp_oWCR)){

                            $tmp_wcr_key = $tmp_oWCR->return_resource_key();

                            $this->oLog_profile_endpoint_update($init_profile_pack['sys_logging_profile_ARRAY'][$key], $value, $tmp_oWCR);

                            //
                            // CHECK oWCR FOR ANY OTHER RELEVANT ENDPOINT DATA
                            // DETECT oWCR ENDPOINT [TYPE=EMAIL] FROM FIELD EMAIL_PROTOCOL IN WCR EMAIL TEMPLATE
                            if($tmp_oWCR->isset_WCR($tmp_wcr_key, 'EMAIL_PROTOCOL') && (CRNRSTN_LOG_EMAIL != $init_profile_pack['sys_logging_profile_ARRAY'][$key])){

                                //error_log(__LINE__ . ' env - PROCESS[WCR] update oLog_profile_endpoint_update() ...has EMAIL_PROTOCOL ' . $tmp_wcr_key);

                                //
                                // WCR FOR EMAIL OF TRACE
                                $this->oLog_profile_endpoint_update(CRNRSTN_LOG_EMAIL, $tmp_wcr_key, $tmp_oWCR);

                            }

                            //
                            // DETECT WCR ENDPOINT [TYPE=FTP] FROM FIELD FTP_SERVER IN WCR FTP TEMPLATE
                            if($tmp_oWCR->isset_WCR($tmp_wcr_key, 'FTP_SERVER') && (CRNRSTN_LOG_FILE_FTP != $init_profile_pack['sys_logging_profile_ARRAY'][$key])) {

                                //
                                // WCR FOR FTP OF TRACE IN FILE
                                $this->oLog_profile_endpoint_update(CRNRSTN_LOG_FILE_FTP, $tmp_wcr_key, $tmp_oWCR);

                            }

                            //
                            // DETECT WCR ENDPOINT [TYPE=EMAIL_PROXY] FROM FIELD FTP_SERVER IN WCR EMAIL_PROXY TEMPLATE
                            if($tmp_oWCR->isset_WCR($tmp_wcr_key, 'WSDL_URI') && (CRNRSTN_LOG_EMAIL_PROXY != $init_profile_pack['sys_logging_profile_ARRAY'][$key])) {

                                //
                                // WCR FOR EMAIL_PROXY OF TRACE IN FILE
                                $this->oLog_profile_endpoint_update(CRNRSTN_LOG_EMAIL_PROXY, $tmp_wcr_key, $tmp_oWCR);

                            }

                            // DETECT WCR ENDPOINT [TYPE=FILE] FROM FIELD LOCAL_DIR_PATH IN WCR FILE TEMPLATE
                            if(($tmp_oWCR->isset_WCR($tmp_wcr_key, 'LOCAL_DIR_FILEPATH') || $tmp_oWCR->isset_WCR($tmp_wcr_key, 'LOCAL_DIR_,KJIUPATH')) && (CRNRSTN_LOG_FILE != $init_profile_pack['sys_logging_profile_ARRAY'][$key])) {

                                //
                                // WCR FOR FILE WRITE OF TRACE IN FILE
                                $this->oLog_profile_endpoint_update(CRNRSTN_LOG_FILE, $tmp_wcr_key, $tmp_oWCR);

                            }

                        }

                    break;

                }

            }

        }else{

            //error_log(__LINE__ .' env - sys_logging_meta_ARRAY NOT set...');

        }

    }

    public function sync_to_environment($oCRNRSTN = NULL, $oCRNRSTN_ENV = NULL, $oCRNRSTN_USR = NULL){

        $tmp_array = array();

        if(!isset($oCRNRSTN_ENV)){

            foreach($this->oLog_profiles_ARRAY as $key => $oLog_profile){

                //
                // LOAD CRNRSTN :: OBJ INTO EACH LOGGING PROFILE OBJECT
                $oLog_profile->load_CRNRSTN_ENV($oCRNRSTN);

                $tmp_array[] = $oLog_profile;

            }

            $this->oLog_profiles_ARRAY = $tmp_array;

        }else{

            foreach($this->oLog_profiles_ARRAY as $key => $oLog_profile){

                //
                // LOAD CRNRSTN_ENV OBJ INTO EACH LOGGING PROFILE OBJECT
                $oLog_profile->load_CRNRSTN_ENV($oCRNRSTN_ENV);

                $tmp_array[] = $oLog_profile;

            }

            $this->oLog_profiles_ARRAY = $tmp_array;

        }

    }

    private function spool_up_logging_profiles($oCRNRSTN){

        foreach($this->log_profiles_ARRAY as $key => $profile){

            $tmp_oLoggingProfile = new crnrstn_logging_oprofile($profile, $this->config_serial_hash, $this->profile_endpoint_criteria_ARRAY, $oCRNRSTN);

            $this->oLog_profiles_ARRAY[] = $tmp_oLoggingProfile;

        }

    }

    /*
    private function objectify_profiles($oCRNRSTN){

        foreach($this->log_profiles_ARRAY as $key => $profile){

            $tmp_oLoggingProfile = new crnrstn_logging_oprofile($profile, $this->config_serial_hash, $oCRNRSTN);

            switch($profile){
                case 'DEFAULT':

                break;
                case 'EMAIL':

                    $tmp_oLoggingProfile->consume_logging_profile_pack($profile);

                    //$tmp_oLoggingProfile->load_EMAIL_endpoint_data();

                break;
                case 'EMAIL_PROXY':

                    $tmp_oLoggingProfile->consume_logging_profile_pack($profile);

                    $tmp_oLoggingProfile->load_EMAIL_PROXY_endpoint_data();

                break;
                case 'FILE':

                    $tmp_oLoggingProfile->consume_logging_profile_pack($profile);

                    $tmp_oLoggingProfile->load_FILE_endpoint_data();

                break;
                case 'SCREEN_TEXT':

                    $tmp_oLoggingProfile->consume_logging_profile_pack($profile);

                    $tmp_oLoggingProfile->load_SCREEN_TEXT_endpoint_data();

                break;
                case 'SCREEN':
                case 'SCREEN_HTML':

                    $tmp_oLoggingProfile->consume_logging_profile_pack($profile);

                    $tmp_oLoggingProfile->load_SCREEN_HTML_endpoint_data();

                break;
                case 'SCREEN_HTML_HIDDEN':

                    $tmp_oLoggingProfile->consume_logging_profile_pack($profile);

                    $tmp_oLoggingProfile->load_SCREEN_HTML_HIDDEN_endpoint_data();

                break;
                case 'SPLUNK':

                    $tmp_oLoggingProfile->consume_logging_profile_pack($profile);

                    $tmp_oLoggingProfile->load_SPLUNK_endpoint_data();

                break;
                default:
                    //
                    // ALSO DEFAULT

                break;

            }

            $this->oLog_profiles_ARRAY[] = $tmp_oLoggingProfile;

        }

    }
    */

    private function load_system_profiles(){

        $this->log_profiles_ARRAY[] = CRNRSTN_LOG_ELECTRUM;  // n + 1 DESTINATIONS
        $this->log_profiles_ARRAY[] = CRNRSTN_LOG_EMAIL_PROXY;
        $this->log_profiles_ARRAY[] = CRNRSTN_LOG_EMAIL;
        $this->log_profiles_ARRAY[] = CRNRSTN_LOG_FILE_FTP;
        $this->log_profiles_ARRAY[] = CRNRSTN_LOG_FILE;
        $this->log_profiles_ARRAY[] = CRNRSTN_LOG_SCREEN_TEXT;
        $this->log_profiles_ARRAY[] = CRNRSTN_LOG_SCREEN;
        $this->log_profiles_ARRAY[] = CRNRSTN_LOG_SCREEN_HTML;
        $this->log_profiles_ARRAY[] = CRNRSTN_LOG_SCREEN_HTML_HIDDEN;
        $this->log_profiles_ARRAY[] = CRNRSTN_LOG_DEFAULT;
        $this->log_profiles_ARRAY[] = CRNRSTN_RESOURCE_OPENSOURCE;

    }

    public function __destruct() {

    }

}

# # C # R # N # R # S # T # N # : : # # ##
#  CLASS :: crnrstn_logging_oprofile
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: Monday October 26, 2020 @ 2101hrs
#  DESCRIPTION ::
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
class crnrstn_logging_oprofile{

    protected $oLogger;
    protected $oSoapClient;
    protected $oSoapDataTransportLayer;
    private static $oCRNRSTN_n;
    protected $oLog_output_manager;

    public $logging_profile;
    public $isValid = false;

    protected $resource_key;
    protected $config_serial_hash;

    protected $profile_endpoint_criteria_ARRAY = array();
    protected $profile_endpoint_data_ARRAY = array();
    protected $profile_endpoint_set_flag_ARRAY = array();
    protected $wcr_profiles_cnt = 0;

    protected $mail_protocol_flag_ARRAY = array();
    protected $tmp_mail_protocol_options_ARRAY = array('SENDMAIL', 'MAIL', 'QMAIL', 'SMTP');
    protected $tmp_mail_protocol_options_cnt = 4;

    public function __construct($logging_profile, $config_serial_hash, $profile_endpoint_criteria_ARRAY, $oCRNRSTN){

        /**
         TODO :: EXPIRE WCR DRIVEN CONTENT WITH ANY MODIFICATION OF THE SAME TO FORCE REFRESH
         *       BEFORE FINAL OUTPUT.
         */

        self::$oCRNRSTN_n = $oCRNRSTN;

        $this->oLogger = new crnrstn_logging(__CLASS__, self::$oCRNRSTN_n);

        $this->profile_endpoint_criteria_ARRAY = $profile_endpoint_criteria_ARRAY;
        $this->logging_profile = $logging_profile;
        //$this->resource_key = $resource_key;
        $this->config_serial_hash = $config_serial_hash;

        //$this->active_by_default($logging_profile);

    }

    public function return_profile_endpoint_data(){

        return $this->profile_endpoint_data_ARRAY;

    }

    //
    // SOURCE :: https://www.youtube.com/watch?v=u4-PGjwdARg
    // TITLE :: Arcade Fire - No Cars Go (BEST version ever - Pinkpop 2014)
    private function no_cars_go_EMAIL_PROXY($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj){

        $tmp_data_tunnel_session_serial = $oCRNRSTN_n->generate_new_key();  // 32
        $this->oSoapDataTransportLayer = new crnrstn_decoupled_data_object($oCRNRSTN_n, $tmp_data_tunnel_session_serial, 'SOAP_DTL_SERIAL');

        $tmp_ISHTML = true;
        $tmp_exception_msg = $exception_obj->getMessage();
        $tmp_exception_linenum = $exception_obj->getLine();

        $this->load_log_output_mgr($oCRNRSTN_n);

        //
        // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
        foreach($this->profile_endpoint_data_ARRAY as $config_version => $chunkArray0){

            foreach($chunkArray0 as $data_attribute => $chunkArray1){

                //error_log(__LINE__ . ' env - ' . $data_attribute . ' with value size=[' . sizeof($chunkArray1) . ']');

                foreach($chunkArray1 as $content_count => $attribute_content){

                    if(isset($this->profile_endpoint_set_flag_ARRAY[$config_version][$data_attribute][$content_count])){

                        //error_log(__LINE__ . ' env - [' . sizeof($chunkArray1) . '] [' . $config_version . '] [' . $data_attribute . '] [' . $content_count . '] [' . $attribute_content . ']');

                        switch($data_attribute){
                            case 'EMAIL_PROTOCOL':

                                //error_log(__LINE__ . ' env - adding to SSDTL...email protocol=' . $attribute_content);
                                $this->oSoapDataTransportLayer->add(trim(strtoupper($attribute_content)), $data_attribute);

                            break;
                            case 'SMTP_AUTH':

                                $this->oSoapDataTransportLayer->add((bool) $oCRNRSTN_n->tidy_boolean($attribute_content), $data_attribute);

                            break;
                            case 'SMTP_KEEPALIVE':

                                //error_log(__LINE__ . ' env - adding to SSDTL...email SMTP_KEEPALIVE=' . $attribute_content);
                                $this->oSoapDataTransportLayer->add((bool) $oCRNRSTN_n->tidy_boolean($attribute_content), $data_attribute);

                            break;
                            case 'SMTP_AUTOTLS':

                                $this->oSoapDataTransportLayer->add((bool) $oCRNRSTN_n->tidy_boolean($attribute_content), $data_attribute);

                            break;
                            case 'SMTP_TIMEOUT':

                                $this->oSoapDataTransportLayer->add((int) $attribute_content, $data_attribute);

                            break;
                            case 'DIBYA_SAHOO_SSL_CERT_BYPASS':

                                $this->oSoapDataTransportLayer->add((bool) $oCRNRSTN_n->tidy_boolean($attribute_content), $data_attribute);

                            break;
                            case 'USE_SENDMAIL_OPTIONS':

                                $this->oSoapDataTransportLayer->add((bool) $oCRNRSTN_n->tidy_boolean($attribute_content), $data_attribute);

                            break;
                            case 'WORDWRAP':

                                $this->oSoapDataTransportLayer->add((int) $attribute_content, $data_attribute);

                            break;
                            case 'ISHTML':

                                $tmp_ISHTML = (bool) $oCRNRSTN_n->tidy_boolean($attribute_content);

                                $this->oSoapDataTransportLayer->add((bool) $tmp_ISHTML, $data_attribute);

                            break;
                            case 'PRIORITY':

                                $tmp_PRIORITY = $attribute_content;

                                $priority = trim(strtoupper($tmp_PRIORITY));

                                switch($priority){
                                    case '1':
                                    case 1:
                                    case 'HIGH':

                                        $tmp_PRIORITY = 1;

                                    break;
                                    case '3':
                                    case 3:
                                    case 'NORMAL':

                                        $tmp_PRIORITY = 3;

                                    break;
                                    case '5':
                                    case 5:
                                    case 'LOW':

                                        $tmp_PRIORITY = 5;

                                    break;
                                    default:

                                        $tmp_PRIORITY = 3;

                                        //
                                        // HOOOSTON...VE HAF PROBLEM!
                                        $oCRNRSTN_n->error_log('The provided priority level of "' . $tmp_PRIORITY . '" is invalid; NORMAL priority has been applied. Options include, "HIGH" or 1, "NORMAL" or 3 and "LOW" or 5.', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                    break;

                                }

                                $this->oSoapDataTransportLayer->add($tmp_PRIORITY, $data_attribute);

                            break;
                            case 'DUP_SUPPRESS':

                                $this->oSoapDataTransportLayer->add((bool) $oCRNRSTN_n->tidy_boolean($attribute_content), $data_attribute);

                            break;
                            case 'ALLOW_EMPTY':

                                //error_log(__LINE__ . ' env - adding to SSDTL...email ALLOW_EMPTY=' . $attribute_content);
                                $this->oSoapDataTransportLayer->add((bool) $oCRNRSTN_n->tidy_boolean($attribute_content), $data_attribute);

                            break;
                            case 'TRY_OTHER_EMAIL_METHODS_ON_ERR':

                                //error_log(__LINE__ . ' env - adding to SSDTL...TRY_OTHER_EMAIL_METHODS_ON_ERR=' . $oCRNRSTN_n->tidy_boolean($attribute_content));
                                $this->oSoapDataTransportLayer->add((bool) $oCRNRSTN_n->tidy_boolean($attribute_content), $data_attribute);

                            break;
                            default:

                                //error_log(__LINE__ . ' env - oSoapDataTransportLayer add(' . $data_attribute . ')=(' . $attribute_content . ')');
                                $this->oSoapDataTransportLayer->add($attribute_content, $data_attribute);

                            break;

                        }

                    }

                }

            }

        }

        //
        // GET N COUNT OF RECIPIENT EMAIL ADDRESSES?
        $tmp_recipient_email_cnt = $this->oSoapDataTransportLayer->count('RECIPIENT_EMAIL');

        //error_log(__LINE__ .' env - recipient email cnt = '.$tmp_recipient_email_cnt);

        //for($i=0; $i<$tmp_recipient_email_cnt; $i++){
        // $tmp_email = $this->oSoapDataTransportLayer->preach('value', 'RECIPIENT_EMAIL', false, $i);
        // $tmp_name = $this->oSoapDataTransportLayer->preach('value', 'RECIPIENT_NAME', false, $i);
        // error_log(__LINE__ .' env - ['.$tmp_name . '] ['.self::$oCRNRSTN_n->string_sanitize($tmp_email, 'email_private').']');
        //}

        //
        // CONSTANTS
        $tmp_php_trace_TEXT = $oCRNRSTN_n->return_PHP_exception_trace_pretty($exception_obj->getTraceAsString(), 'TEXT');
        $tmp_log_constant_TEXT = $oCRNRSTN_n->return_logPriorityPretty($syslog_constant);
        $tmp_crnrstn_trace_TEXT = $this->oLog_output_manager->return_log_trace_output_str('EMAIL_TEXT');

        if($tmp_ISHTML){

            $tmp_php_trace_HTML = $oCRNRSTN_n->return_PHP_exception_trace_pretty($exception_obj->getTraceAsString(), 'HTML');
            $tmp_log_constant_HTML = $oCRNRSTN_n->return_logPriorityPretty($syslog_constant, 'HTML');
            $tmp_crnrstn_trace_HTML = $this->oLog_output_manager->return_log_trace_output_str('EMAIL_HTML');

        }

        switch(get_class($oCRNRSTN_n)){
            case 'crnrstn_user':
            case 'crnrstn_environment':
            case 'crnrstn':

                //
                // LOOP THROUGH N COUNT TO BUILD N CUSTOM EMAIL (SUBJECT, HTML, TEXT). AND STORE CONTENT WITHIN SOAP DTL.
                for ($i = 0; $i < $tmp_recipient_email_cnt; $i++) {

                    $oCRNRSTN_GABRIEL = new crnrstn_messenger_from_north($i, 'mail', NULL, NULL, NULL, $oCRNRSTN_n);
                    $tmp_email = $this->oSoapDataTransportLayer->preach('value', 'RECIPIENT_EMAIL', false, $i);

                    //error_log(__LINE__ . ' env - building [' . $i . '] of [' . $tmp_recipient_email_cnt . '] message for ' . self::$oCRNRSTN_n->string_sanitize($tmp_email, 'email_private'));

                    //
                    // PREPARE TEXT VERSION
                    $tmp_TEXT_Body = $oCRNRSTN_GABRIEL->return_CRNRSTN_SysMsgTEXTBody('EXCEPTION_NOTIFICATION::SOAP_TUNNEL');
                    $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{SYSTEM_LOG_INTEGER_CONSTANT}', $tmp_log_constant_TEXT, $tmp_TEXT_Body);
                    $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{MESSAGE}', $tmp_exception_msg, $tmp_TEXT_Body);
                    $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{LINE_NUM}', $tmp_exception_linenum, $tmp_TEXT_Body);
                    $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{METHOD}', $exception_method, $tmp_TEXT_Body);
                    $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{PHP_TRACE}', $tmp_php_trace_TEXT, $tmp_TEXT_Body);
                    $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{SYSTEM_TIME}', $exception_systemtime, $tmp_TEXT_Body);
                    $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{PROCESS_RUN_TIME}', $exception_runtime, $tmp_TEXT_Body);
                    $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{EMAIL}', $tmp_email, $tmp_TEXT_Body);
                    $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{LOG_TRACE}', $tmp_crnrstn_trace_TEXT, $tmp_TEXT_Body);

                    $tmp_MESSAGE_SUBJECT = 'Exception Notification from ' . $_SERVER['SERVER_NAME'] . ' via CRNRSTN ::';
                    $this->oSoapDataTransportLayer->add($tmp_MESSAGE_SUBJECT, 'MESSAGE_SUBJECT');
                    $tmp_TEXT_Body = trim($tmp_TEXT_Body);
                    $this->oSoapDataTransportLayer->add($tmp_TEXT_Body, 'MESSAGE_BODY_TEXT');

                    if ($tmp_ISHTML) {

                        //
                        // PREPARE HTML VERSION
                        $tmp_HTML_Body = $oCRNRSTN_GABRIEL->return_CRNRSTN_SysMsgHTMLBody('EXCEPTION_NOTIFICATION::SOAP_TUNNEL');
                        $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{SYSTEM_LOG_INTEGER_CONSTANT}', $tmp_log_constant_HTML, $tmp_HTML_Body);
                        $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{MESSAGE}', $tmp_exception_msg, $tmp_HTML_Body);
                        $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{LINE_NUM}', $tmp_exception_linenum, $tmp_HTML_Body);
                        $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{METHOD}', $exception_method, $tmp_HTML_Body);
                        $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{PHP_TRACE}', $tmp_php_trace_HTML, $tmp_HTML_Body);
                        $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{SYSTEM_TIME}', $exception_systemtime, $tmp_HTML_Body);
                        $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{PROCESS_RUN_TIME}', $exception_runtime, $tmp_HTML_Body);
                        $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{EMAIL}', $tmp_email, $tmp_HTML_Body);
                        $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{LOG_TRACE}', $tmp_crnrstn_trace_HTML, $tmp_HTML_Body);

                        $tmp_HTML_Body = trim($tmp_HTML_Body);
                        $this->oSoapDataTransportLayer->add($tmp_HTML_Body, 'MESSAGE_BODY_HTML');

                    }

                }

                //
                // DONE. BUILD SOAP REQUEST AND SEND TO PROXY.
                $SOAP_endpoint = $this->oSoapDataTransportLayer->preach('value', 'WSDL_URI');

                $SOAP_request = $this->oSoapDataTransportLayer->generate_SOAP_request_object('tunnelEncryptCalibrationRequest', NULL);

                //self::$oCRNRSTN_n->print_r($SOAP_request, 'CLIENT REQUEST :: oTunnelEncryptionCalibrationRequest', NULL, __LINE__, __METHOD__, __FILE__);

                //
                // SUBMIT SERVICES REQUEST [LIMIT OF 65535 bytes]
                $tmp_response = $this->client_send_CRNRSTN_SOAP_REQUEST('tunnelEncryptCalibrationRequest', $SOAP_request[0], $SOAP_endpoint);

                self::$oCRNRSTN_n->print_r($tmp_response, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest', NULL, __LINE__, __METHOD__, __FILE__);

                if($tmp_response['CRNRSTN_PACKET_IS_ENCRYPTED'] != 'TRUE'){

                    //
                    // UNABLE TO CONTINUE. ENCRYPTION IS REQUIRED. HANDLE AS ERROR.
                    error_log(__LINE__ . ' env ' . __METHOD__ . ' - SOAP err CRNRSTN_PACKET_IS_ENCRYPTED != TRUE');
                    die();

                }else{

                    $tmp_SOAP_ENCRYPT_CIPHER = $this->oSoapDataTransportLayer->preach('value', 'SOAP_ENCRYPT_CIPHER');
                    $tmp_SOAP_ENCRYPT_SECRET_KEY = $this->oSoapDataTransportLayer->soap_encrypt_secret_key;
                    $tmp_SOAP_ENCRYPT_HMAC_ALG = $this->oSoapDataTransportLayer->preach('value', 'SOAP_ENCRYPT_HMAC_ALG');
                    $tmp_SOAP_ENCRYPT_OPTIONS = $this->oSoapDataTransportLayer->preach('value', 'SOAP_ENCRYPT_OPTIONS');

                    $tmp_SOAP_SERVICES_AUTH_STATUS = self::$oCRNRSTN_n->data_decrypt($tmp_response['SOAP_SERVICES_AUTH_STATUS'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_SOAP_ENCRYPT_CIPHER_resp = self::$oCRNRSTN_n->data_decrypt($tmp_response['SOAP_ENCRYPT_CIPHER'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_SOAP_ENCRYPT_HMAC_ALG_resp = self::$oCRNRSTN_n->data_decrypt($tmp_response['SOAP_ENCRYPT_HMAC_ALG'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_SOAP_ENCRYPT_OPTIONS_resp = self::$oCRNRSTN_n->data_decrypt($tmp_response['SOAP_ENCRYPT_OPTIONS'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_STATUS_CODE = self::$oCRNRSTN_n->data_decrypt($tmp_response['STATUS_CODE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_STATUS_MESSAGE = self::$oCRNRSTN_n->data_decrypt($tmp_response['STATUS_MESSAGE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_ISERROR_CODE = self::$oCRNRSTN_n->data_decrypt($tmp_response['ISERROR_CODE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_ISERROR_MESSAGE = self::$oCRNRSTN_n->data_decrypt($tmp_response['ISERROR_MESSAGE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_DATE_RECEIVED_SOAP_REQUEST = self::$oCRNRSTN_n->data_decrypt($tmp_response['DATE_RECEIVED_SOAP_REQUEST'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_SERVER_NAME_SOAP_SERVER = self::$oCRNRSTN_n->data_decrypt($tmp_response['SERVER_NAME_SOAP_SERVER'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_SERVER_ADDRESS_SOAP_SERVER = self::$oCRNRSTN_n->data_decrypt($tmp_response['SERVER_ADDRESS_SOAP_SERVER'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_DATE_CREATED_SOAP_RESPONSE = self::$oCRNRSTN_n->data_decrypt($tmp_response['DATE_CREATED_SOAP_RESPONSE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                    /*

                    NEED TO UPDATE PARAMETER ORDER TO THE NEW BEFORE RUNNING THIS
                    self::$oCRNRSTN_n->print_r($tmp_SOAP_SERVICES_AUTH_STATUS, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: SOAP_SERVICES_AUTH_STATUS');
                    self::$oCRNRSTN_n->print_r($tmp_SOAP_ENCRYPT_CIPHER_resp, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: SOAP_ENCRYPT_CIPHER');
                    self::$oCRNRSTN_n->print_r($tmp_SOAP_ENCRYPT_HMAC_ALG_resp, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: SOAP_ENCRYPT_HMAC_ALG');
                    self::$oCRNRSTN_n->print_r($tmp_SOAP_ENCRYPT_OPTIONS_resp, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: SOAP_ENCRYPT_OPTIONS');
                    self::$oCRNRSTN_n->print_r($tmp_STATUS_CODE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: STATUS_CODE');
                    self::$oCRNRSTN_n->print_r($tmp_STATUS_MESSAGE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: STATUS_MESSAGE');
                    self::$oCRNRSTN_n->print_r($tmp_ISERROR_CODE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: ISERROR_CODE');
                    self::$oCRNRSTN_n->print_r($tmp_ISERROR_MESSAGE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: ISERROR_MESSAGE');
                    self::$oCRNRSTN_n->print_r($tmp_DATE_RECEIVED_SOAP_REQUEST, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: DATE_RECEIVED_SOAP_REQUEST');
                    self::$oCRNRSTN_n->print_r($tmp_SERVER_NAME_SOAP_SERVER, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: SERVER_NAME_SOAP_SERVER');
                    self::$oCRNRSTN_n->print_r($tmp_SERVER_ADDRESS_SOAP_SERVER, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: SERVER_ADDRESS_SOAP_SERVER');
                    self::$oCRNRSTN_n->print_r($tmp_DATE_CREATED_SOAP_RESPONSE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: DATE_CREATED_SOAP_RESPONSE');
                    */

                    if($tmp_SOAP_SERVICES_AUTH_STATUS == 'AUTHORIZATION GRANTED'){

                        $SOAP_request = $this->oSoapDataTransportLayer->generate_SOAP_request_object('mayItakeTheKingsHighway', $tmp_response);

                        /*
                        'CRNRSTN_PACKET_IS_ENCRYPTED' => array( 'name' => 'CRNRSTN_PACKET_IS_ENCRYPTED', 'type' => 'xsd:string' ),
                        'CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES' => array( 'name' => 'CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES', 'type' => 'xsd:string' ),
                        'CRNRSTN_SOAP_SVC_METHOD_REQUESTED' => array( 'name' => 'CRNRSTN_SOAP_SVC_METHOD_REQUESTED', 'type' => 'xsd:string' ),
                        'CRNRSTN_SOAP_ACTION_TYPE' => array( 'name' => 'CRNRSTN_SOAP_ACTION_TYPE', 'type' => 'xsd:string' ),
                        'CRNRSTN_SOAP_SVC_AUTH_KEY' => array( 'name' => 'CRNRSTN_SOAP_SVC_AUTH_KEY', 'type' => 'xsd:string' ),
                        'USERNAME' => array( 'name' => 'USERNAME', 'type' => 'xsd:string' ),
                        'PASSWORD' => array( 'name' => 'PASSWORD', 'type' => 'xsd:string' ),
                        'CRNRSTN_NOTIFICATION_TYPE' => array( 'name' => 'CRNRSTN_NOTIFICATION_TYPE', 'type' => 'xsd:string' ),
                        'SOAP_ENCRYPT_CIPHER' => array( 'name' => 'SOAP_ENCRYPT_CIPHER', 'type' => 'xsd:string' ),
                        'SOAP_ENCRYPT_SECRET_KEY' => array( 'name' => 'SOAP_ENCRYPT_SECRET_KEY', 'type' => 'xsd:string' ),
                        'SOAP_ENCRYPT_HMAC_ALG' => array( 'name' => 'SOAP_ENCRYPT_HMAC_ALG', 'type' => 'xsd:string' ),
                        'SOAP_ENCRYPT_OPTIONS' => array( 'name' => 'SOAP_ENCRYPT_OPTIONS', 'type' => 'xsd:string' )
                         * */

                        self::$oCRNRSTN_n->print_r($SOAP_endpoint, '', NULL, __LINE__, __METHOD__, __FILE__);

                        //
                        // SUBMIT SERVICES REQUEST [LIMIT OF 65535 bytes]
                        $tmp_response = $this->client_send_CRNRSTN_SOAP_REQUEST('mayItakeTheKingsHighway', $SOAP_request[0], $SOAP_endpoint);

                        //self::$oCRNRSTN_n->print_r($SOAP_request, 'CLIENT REQUEST :: mayItakeTheKingsHighway', NULL, __LINE__, __METHOD__, __FILE__);
                        //self::$oCRNRSTN_n->print_r($this->returnClientRequest(), 'CLIENT REQUEST :: oKingsHighwayAuthRequest', NULL, __LINE__, __METHOD__, __FILE__);
                        self::$oCRNRSTN_n->print_r($tmp_response, 'SERVER RESPONSE :: mayItakeTheKingsHighway', NULL, __LINE__, __METHOD__, __FILE__);

                        $tmp_CRNRSTN_PACKET_IS_ENCRYPTED = $tmp_response['CRNRSTN_PACKET_IS_ENCRYPTED'];
                        if($tmp_CRNRSTN_PACKET_IS_ENCRYPTED != 'TRUE'){

                            //
                            // ENCRYPTION REQUIRED - DO NOT CONTINUE.

                        }else{

                            $tmp_SOAP_ENCRYPT_CIPHER = $this->oSoapDataTransportLayer->preach('value', 'SOAP_ENCRYPT_CIPHER');
                            $tmp_SOAP_ENCRYPT_SECRET_KEY_resp = $this->oSoapDataTransportLayer->soap_encrypt_secret_key;
                            $tmp_SOAP_ENCRYPT_HMAC_ALG = $this->oSoapDataTransportLayer->preach('value', 'SOAP_ENCRYPT_HMAC_ALG');
                            $tmp_SOAP_ENCRYPT_OPTIONS = $this->oSoapDataTransportLayer->preach('value', 'SOAP_ENCRYPT_OPTIONS');

                            $tmp_SOAP_ENCRYPT_SECRET_KEY = $this->oSoapDataTransportLayer->preach('value', 'CRNRSTN_SOAP_SVC_ENCRYPTION_KEY');

                            //mayItakeTheKingsHighway decrypt with [AES-192-OFB][for_a_stranger-this-Is-the_soap-encrypti0n-key][sha256][1]

                            //
                            // DECRYPT SOAP OBJECT
                            //$tmp_CRNRSTN_SOAP_SVC_AUTH_KEY = self::$oCRNRSTN_n->data_decrypt($tmp_response['CRNRSTN_SOAP_SVC_AUTH_KEY'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_CRNRSTN_SOAP_SVC_USERNAME = self::$oCRNRSTN_n->data_decrypt($tmp_response['CRNRSTN_SOAP_SVC_USERNAME'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            self::$oCRNRSTN_n->print_r('SOAP_SERVICES_AUTH_STATUS = ' . $tmp_response['SOAP_SERVICES_AUTH_STATUS'] . ' [' . $tmp_SOAP_ENCRYPT_CIPHER_resp . '] [' . $tmp_SOAP_ENCRYPT_SECRET_KEY_resp . '][' . $this->oSoapDataTransportLayer->soap_encrypt_secret_key . ']', 'SERVER RESPONSE DECRYPT :: mayItakeTheKingsHighway', NULL, __LINE__, __METHOD__, __FILE__);
                            //error_log(__LINE__ .' env data_decrypt(1/2) ['.$tmp_SOAP_ENCRYPT_CIPHER_resp.']['.$tmp_SOAP_ENCRYPT_SECRET_KEY_resp.']['.$tmp_SOAP_ENCRYPT_HMAC_ALG_resp.']['.$tmp_SOAP_ENCRYPT_OPTIONS_resp.']');
                            $tmp_SOAP_SERVICES_AUTH_STATUS = self::$oCRNRSTN_n->data_decrypt($tmp_response['SOAP_SERVICES_AUTH_STATUS'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            //error_log(__LINE__ .' env data_decrypt(2/2) ['.$tmp_SOAP_ENCRYPT_CIPHER_resp.']['.$tmp_SOAP_ENCRYPT_SECRET_KEY_resp.']['.$tmp_SOAP_ENCRYPT_HMAC_ALG_resp.']['.$tmp_SOAP_ENCRYPT_OPTIONS_resp.']');

                            self::$oCRNRSTN_n->print_r('SOAP_SERVICES_AUTH_STATUS = '.$tmp_SOAP_SERVICES_AUTH_STATUS, 'SERVER RESPONSE DECRYPT :: mayItakeTheKingsHighway', NULL, __LINE__, __METHOD__, __FILE__);
                            //$tmp_SOAP_ENCRYPT_CIPHER_resp = self::$oCRNRSTN_n->data_decrypt($tmp_response['SOAP_ENCRYPT_CIPHER'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_SOAP_ENCRYPT_SECRET_KEY_resp = self::$oCRNRSTN_n->data_decrypt($tmp_response['SOAP_ENCRYPT_SECRET_KEY'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_SOAP_ENCRYPT_HMAC_ALG_resp = self::$oCRNRSTN_n->data_decrypt($tmp_response['SOAP_ENCRYPT_HMAC_ALG'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_SOAP_ENCRYPT_OPTIONS_resp = self::$oCRNRSTN_n->data_decrypt($tmp_response['SOAP_ENCRYPT_OPTIONS'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                            //$tmp_STATUS_CODE = self::$oCRNRSTN_n->data_decrypt($tmp_response['STATUS_CODE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_STATUS_MESSAGE = self::$oCRNRSTN_n->data_decrypt($tmp_response['STATUS_MESSAGE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_ISERROR_CODE = self::$oCRNRSTN_n->data_decrypt($tmp_response['ISERROR_CODE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_ISERROR_MESSAGE = self::$oCRNRSTN_n->data_decrypt($tmp_response['ISERROR_MESSAGE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_DATE_RECEIVED_SOAP_REQUEST = self::$oCRNRSTN_n->data_decrypt($tmp_response['DATE_RECEIVED_SOAP_REQUEST'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_SERVER_NAME_SOAP_SERVER = self::$oCRNRSTN_n->data_decrypt($tmp_response['SERVER_NAME_SOAP_SERVER'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_SERVER_ADDRESS_SOAP_SERVER = self::$oCRNRSTN_n->data_decrypt($tmp_response['SERVER_ADDRESS_SOAP_SERVER'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_DATE_CREATED_SOAP_RESPONSE = self::$oCRNRSTN_n->data_decrypt($tmp_response['DATE_CREATED_SOAP_RESPONSE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_SERVER_NAME_SOAP_CLIENT = self::$oCRNRSTN_n->data_decrypt($tmp_response['SERVER_NAME_SOAP_CLIENT'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_SERVER_ADDRESS_SOAP_CLIENT = self::$oCRNRSTN_n->data_decrypt($tmp_response['SERVER_ADDRESS_SOAP_CLIENT'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                            /*
                             DO NOT RUN UNTIL BRINGING INPUT PARAM ORDER INTO TO NEW SEQUENCE
                            self::$oCRNRSTN_n->print_r($tmp_CRNRSTN_SOAP_SVC_AUTH_KEY, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: CRNRSTN_SOAP_SVC_AUTH_KEY');
                            self::$oCRNRSTN_n->print_r($tmp_CRNRSTN_SOAP_SVC_USERNAME, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: CRNRSTN_SOAP_SVC_USERNAME');
                            self::$oCRNRSTN_n->print_r($tmp_SOAP_SERVICES_AUTH_STATUS, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SOAP_SERVICES_AUTH_STATUS');
                            self::$oCRNRSTN_n->print_r($tmp_SOAP_ENCRYPT_CIPHER_resp, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SOAP_ENCRYPT_CIPHER');
                            self::$oCRNRSTN_n->print_r($tmp_SOAP_ENCRYPT_SECRET_KEY_resp, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SOAP_ENCRYPT_SECRET_KEY');
                            self::$oCRNRSTN_n->print_r($tmp_SOAP_ENCRYPT_HMAC_ALG_resp, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SOAP_ENCRYPT_HMAC_ALG');
                            self::$oCRNRSTN_n->print_r($tmp_SOAP_ENCRYPT_OPTIONS_resp, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SOAP_ENCRYPT_OPTIONS');
                            self::$oCRNRSTN_n->print_r($tmp_STATUS_CODE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: STATUS_CODE');
                            self::$oCRNRSTN_n->print_r($tmp_STATUS_MESSAGE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: STATUS_MESSAGE');
                            self::$oCRNRSTN_n->print_r($tmp_ISERROR_CODE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: ISERROR_CODE');
                            self::$oCRNRSTN_n->print_r($tmp_ISERROR_MESSAGE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: ISERROR_MESSAGE');
                            self::$oCRNRSTN_n->print_r($tmp_DATE_RECEIVED_SOAP_REQUEST, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: DATE_RECEIVED_SOAP_REQUEST');
                            self::$oCRNRSTN_n->print_r($tmp_SERVER_NAME_SOAP_SERVER, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SERVER_NAME_SOAP_SERVER');
                            self::$oCRNRSTN_n->print_r($tmp_SERVER_ADDRESS_SOAP_SERVER, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SERVER_ADDRESS_SOAP_SERVER');
                            self::$oCRNRSTN_n->print_r($tmp_DATE_CREATED_SOAP_RESPONSE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: DATE_CREATED_SOAP_RESPONSE');
                            self::$oCRNRSTN_n->print_r($tmp_SERVER_NAME_SOAP_CLIENT, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SERVER_NAME_SOAP_CLIENT');
                            self::$oCRNRSTN_n->print_r($tmp_SERVER_ADDRESS_SOAP_CLIENT, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SERVER_ADDRESS_SOAP_CLIENT');
                            */

                            self::$oCRNRSTN_n->print_r($tmp_SOAP_SERVICES_AUTH_STATUS, 'SERVER RESPONSE :: mayItakeTheKingsHighway', NULL, __LINE__, __METHOD__, __FILE__);
                            if($tmp_SOAP_SERVICES_AUTH_STATUS == 'AUTHORIZATION GRANTED'){

                                //
                                // BUILD PAYLOAD SOAP REQUEST :: takeTheKingsHighway
                                $this->oSoapDataTransportLayer->soap_encrypt_cipher = $tmp_SOAP_ENCRYPT_CIPHER_resp;
                                $this->oSoapDataTransportLayer->soap_encrypt_hmac_alg = $tmp_SOAP_ENCRYPT_HMAC_ALG_resp;
                                $this->oSoapDataTransportLayer->soap_encrypt_options = $tmp_SOAP_ENCRYPT_OPTIONS_resp;

                                $SOAP_request = $this->oSoapDataTransportLayer->generate_SOAP_request_object('takeTheKingsHighway', $tmp_response);

                                //self::$oCRNRSTN_n->print_r($SOAP_request, 'CLIENT REQUEST :: takeTheKingsHighway', NULL, __LINE__, __METHOD__, __FILE__);

                                error_log(__LINE__ . ' env - READY TO takeTheKingsHighway TO SERVER.');

                                //
                                // SUBMIT SERVICES REQUEST [LIMIT OF 65535 bytes]
                                $tmp_request_cnt = sizeof($SOAP_request);
                                //error_log(__LINE__ . ' env - READY TO SEND count=' . $tmp_request_cnt . ' TO SERVER.');

                                for($ii = 0; $ii < $tmp_request_cnt; $ii++){

                                    $tmp_cur = 1 + $ii;
                                    $tmp_response = $this->client_send_CRNRSTN_SOAP_REQUEST('takeTheKingsHighway', $SOAP_request[$ii], $SOAP_endpoint);
                                    self::$oCRNRSTN_n->print_r($tmp_response, 'CLIENT - SERVER RESPONSE :: takeTheKingsHighway ' . $tmp_cur . ' of ' . $tmp_request_cnt, NULL, __LINE__, __METHOD__, __FILE__);

                                }

                               // error_log(__LINE__ . ' env - WE JUST TOOK takeTheKingsHighway ' . $ii . ' times!');

                            }

                        }

                    }else{

                        error_log(__LINE__ . ' env - authorization NOT granted...');
                        $tmp_STATUS_CODE = self::$oCRNRSTN_n->data_decrypt($tmp_response['STATUS_CODE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                        $tmp_STATUS_MESSAGE = self::$oCRNRSTN_n->data_decrypt($tmp_response['STATUS_MESSAGE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                        $tmp_ISERROR_CODE = self::$oCRNRSTN_n->data_decrypt($tmp_response['ISERROR_CODE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                        $tmp_ISERROR_MESSAGE = self::$oCRNRSTN_n->data_decrypt($tmp_response['ISERROR_MESSAGE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                        self::$oCRNRSTN_n->error_log('CRNRSTN :: SOAP Services proxy error. Error Code: ' . $tmp_ISERROR_CODE . ' :: Error Message: ' . $tmp_ISERROR_MESSAGE . ' :: Status Code: ' . $tmp_STATUS_CODE . ' :: Status Message: ' . $tmp_STATUS_MESSAGE, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_SOAP_SERVICES');

                    }

                    return true;

                }

            break;

        }

        return true;

    }

    public function returnClientRequest(){

        return $this->oSoapClient->returnClientRequest();

    }

    //
    // SOURCE :: https://www.youtube.com/watch?v=83KR_UBWdPI
    // TITLE :: Arcade Fire - No Cars Go
    private function no_cars_go_EMAIL($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj){

        $tmp_exception_msg = $exception_obj->getMessage();
        $tmp_exception_linenum = $exception_obj->getLine();

        error_log(__LINE__ . ' env no_cars_go_EMAIL() [' . $exception_method . '][' . $syslog_constant . ']' . $tmp_exception_output_str . ' ' . $tmp_exception_msg . ' ' . $tmp_exception_linenum);

        $this->load_log_output_mgr($oCRNRSTN_n);

        $tmp_sent_suppression = array();
        $config_data_ARRAY = array();

        //
        // PHPMAILER DEFAULT VALUES
        $tmp_DUP_SUPPRESS = true;  // CRNRSTN DEFAULT
        $tmp_ALLOW_EMPTY = false;
        $tmp_SMTP_KEEPALIVE = false;
        $tmp_isHTML = true;
        $tmp_SMTP_TIMEOUT = 300;
        $tmp_PRIORITY = 3;
        $tmp_WORDWRAP = 52;
        $tmp_EMAIL_PROTOCOL = 'mail';
        $tmp_TRY_OTHER_EMAIL_METHODS_ON_ERR = true;
        $tmp_SMTP_AUTH = false;
        $tmp_SMTP_SERVER = 'localhost';
        $tmp_SMTP_PORT_OUTGOING = 25;
        $tmp_SMTP_USERNAME = '';
        $tmp_SMTP_PASSWORD = '';
        $tmp_CHARSET = 'iso-8859-1';
        $tmp_MESSAGE_ENCODING = '8bit';
        $tmp_SMTP_SECURE = '';
        $tmp_SMTP_AUTOTLS = true;
        //$tmp_FROM_EMAIL = 'root@localhost';
        $tmp_FROM_EMAIL = 'no_reply@'.$_SERVER['SERVER_NAME'];
        $tmp_FROM_NAME = 'CRNRSTN System Mailer';
        $tmp_RECIPIENT_EMAIL = array();
        $tmp_RECIPIENT_NAME = array();
        $tmp_REPLYTO_EMAIL = array();
        $tmp_REPLYTO_NAME = array();
        $tmp_CC_EMAIL = array();
        $tmp_CC_NAME = array();
        $tmp_BCC_EMAIL = array();
        $tmp_BCC_NAME = array();
        $tmp_SENDMAIL_PATH = '/usr/sbin/sendmail';
        $tmp_USE_SENDMAIL_OPTIONS = true;
        $tmp_DIBYA_SAHOO_SSL_CERT_BYPASS = true;

        //$tmp_size = sizeof($this->profile_endpoint_data_ARRAY);

        //error_log(__LINE__ . ' env profile_endpoint_data_ARRAY=' . print_r($this->profile_endpoint_data_ARRAY, true));

        //
        // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
        foreach($this->profile_endpoint_data_ARRAY as $config_version => $chunkArray0){

            //error_log(__LINE__ . ' env - should be (more than one) ' . $tmp_size . '...config_version=' . $config_version);

            foreach($chunkArray0 as $data_attribute => $chunkArray1){

                foreach($chunkArray1 as $content_count => $oDDO){

                    //error_log(__LINE__ . ' env - die() [' . $config_version . '] [' . $data_attribute . '] [' . $content_count . '] [' . get_class($oDDO) . ']');
//    public function preach($data_attribute = 'value', $data_key = NULL, $soap_transport=false, $index = 0){
                    switch($data_attribute){
                        case 'RECIPIENT_EMAIL':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach RECIPIENT_EMAIL cnt=' . $oDDO->count($data_attribute));

                                $tmp_RECIPIENT_EMAIL[] = $oDDO->preach('value', $data_attribute);

                            }else{

                                $tmp_RECIPIENT_EMAIL[] = $oDDO;

                            }

                        break;
                        case 'RECIPIENT_NAME':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach $tmp_RECIPIENT_NAME cnt=' . $oDDO->count($data_attribute));

                                $tmp_RECIPIENT_NAME[] = $oDDO->preach('value', $data_attribute);

                            }else{

                                $tmp_RECIPIENT_NAME[] = $oDDO;

                            }

                        break;
                        case 'FROM_EMAIL':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach FROM_EMAIL cnt=' . $oDDO->count($data_attribute));

                                $tmp_FROM_EMAIL = $oDDO->preach('value', $data_attribute);

                            }else{

                                $tmp_FROM_EMAIL = $oDDO;

                            }

                        break;
                        case 'FROM_NAME':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach FROM_NAME cnt=' . $oDDO->count($data_attribute));
                                $tmp_FROM_NAME = $oDDO->preach('value', $data_attribute);

                            }else{

                                $tmp_FROM_NAME = $oDDO;

                            }

                        break;
                        case 'REPLYTO_EMAIL':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach REPLYTO_EMAIL cnt=' . $oDDO->count($data_attribute));

                                $tmp_REPLYTO_EMAIL[] = $oDDO->preach('value', $data_attribute);

                            }else{

                                $tmp_REPLYTO_EMAIL[] = $oDDO;

                            }

                        break;
                        case 'REPLYTO_NAME':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach REPLYTO_NAME cnt=' . $oDDO->count($data_attribute));

                                $tmp_REPLYTO_NAME[] = $oDDO->preach('value', $data_attribute);

                            }else{

                                $tmp_REPLYTO_NAME[] = $oDDO;

                            }

                        break;
                        case 'CC_EMAIL':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach CC_EMAIL cnt=' . $oDDO->count($data_attribute));

                                $tmp_CC_EMAIL[] = $oDDO->preach('value', $data_attribute);

                            }else{

                                $tmp_CC_EMAIL[] = $oDDO;

                            }

                        break;
                        case 'CC_NAME':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach CC_NAME cnt=' . $oDDO->count($data_attribute));

                                $tmp_CC_NAME[] = $oDDO->preach('value', $data_attribute);

                            }else{

                                $tmp_CC_NAME[] = $oDDO;

                            }

                        break;
                        case 'BCC_EMAIL':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach BCC_EMAIL cnt=' . $oDDO->count($data_attribute));

                                $tmp_BCC_EMAIL[] = $oDDO->preach('value', $data_attribute);

                            }else{

                                $tmp_BCC_EMAIL[] = $oDDO;

                            }

                        break;
                        case 'BCC_NAME':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach BCC_NAME cnt=' . $oDDO->count($data_attribute));

                                $tmp_BCC_NAME[] = $oDDO->preach('value', $data_attribute);

                            }else{

                                $tmp_BCC_NAME[] = $oDDO;

                            }

                        break;
                        case 'SMTP_KEEPALIVE':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach [' . $oDDO->count($data_attribute) . '] SMTP_KEEPALIVE=' . $oDDO->preach('type', $data_attribute));

                                $tmp_SMTP_KEEPALIVE = (bool) $oCRNRSTN_n->tidy_boolean($oDDO->preach('value', $data_attribute));

                            }else{

                                $tmp_SMTP_KEEPALIVE = (bool) $oCRNRSTN_n->tidy_boolean($oDDO);

                            }

                        break;
                        case 'DUP_SUPPRESS':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach [' . $oDDO->count($data_attribute) . '] DUP_SUPPRESS=' . $oDDO->preach('type', $data_attribute));

                                $tmp_DUP_SUPPRESS = (bool) $oCRNRSTN_n->tidy_boolean($oDDO->preach('value', $data_attribute));

                            }else{

                                $tmp_DUP_SUPPRESS = (bool) $oCRNRSTN_n->tidy_boolean($oDDO);

                            }

                        break;
                        case 'ALLOW_EMPTY':

                            if(is_object($oDDO)){

                                $tmp_ALLOW_EMPTY = (bool) $oCRNRSTN_n->tidy_boolean($oDDO->preach('value', $data_attribute));

                            }else{

                                $tmp_ALLOW_EMPTY = (bool) $oCRNRSTN_n->tidy_boolean($oDDO);

                            }

                        break;
                        case 'ISHTML':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach [' . $oDDO->count($data_attribute) . '] ISHTML=' . $oDDO->preach('type', $data_attribute));

                                $tmp_isHTML = (bool) $oCRNRSTN_n->tidy_boolean($oDDO->preach('value', $data_attribute));

                            }else{

                                $tmp_isHTML = (bool) $oCRNRSTN_n->tidy_boolean($oDDO);

                            }

                        break;
                        case 'SMTP_TIMEOUT':

                            if(is_object($oDDO)){

                                $tmp_SMTP_TIMEOUT = (int) $oDDO->preach('value', $data_attribute);

                            }else{

                                $tmp_SMTP_TIMEOUT = (int) $oDDO;

                            }

                        break;
                        case 'PRIORITY':

                            if(is_object($oDDO)){

                                if($oDDO->preach('type', $data_attribute) == 'string'){

                                    $tmp_PRIORITY = (string) $oDDO->preach('value', $data_attribute);

                                }else{

                                    $tmp_PRIORITY = (int) $oDDO->preach('value', $data_attribute);

                                }

                            }else{

                                $tmp_PRIORITY = $oDDO;

                            }

                            $priority = trim(strtoupper($tmp_PRIORITY));

                            switch($priority){
                                case '1':
                                case 1:
                                case 'HIGH':

                                    $tmp_PRIORITY = 1;

                                break;
                                case '3':
                                case 3:
                                case 'NORMAL':

                                    $tmp_PRIORITY = 3;

                                break;
                                case '5':
                                case 5:
                                case 'LOW':

                                    $tmp_PRIORITY = 5;

                                break;
                                default:

                                    $tmp_PRIORITY = 3;

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    $oCRNRSTN_n->error_log('The provided priority level of "' . $priority . '" is invalid; NORMAL priority has been applied. Options include, "HIGH" or 1, "NORMAL" or 3 and "LOW" or 5.', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                break;

                            }

                        break;
                        case 'WORDWRAP':

                            if(is_object($oDDO)){

                                $tmp_WORDWRAP = (int) $oDDO->preach('value', $data_attribute);

                            }else{

                                $tmp_WORDWRAP = (int) $oDDO;

                            }

                        break;
                        case 'EMAIL_PROTOCOL':

                            if(is_object($oDDO)){

                                $tmp_EMAIL_PROTOCOL = trim(strtoupper($oDDO->preach('value', $data_attribute)));

                            }else{

                                $tmp_EMAIL_PROTOCOL = trim(strtoupper($oDDO));

                            }

                        break;
                        case 'CHARSET':

                            if(is_object($oDDO)){

                                $tmp_CHARSET = $oDDO->preach('value', $data_attribute);

                            }else{

                                $tmp_CHARSET = $oDDO;

                            }

                        break;
                        case 'MESSAGE_ENCODING':

                            if(is_object($oDDO)){

                                $tmp_MESSAGE_ENCODING = $oDDO->preach('value', $data_attribute);

                            }else{

                                $tmp_MESSAGE_ENCODING = $oDDO;

                            }

                        break;
                        case 'SMTP_SECURE':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach [' . $oDDO->count($data_attribute) . '] SMTP_AUTH=' . $oDDO->preach('type', $data_attribute));

                                $tmp_SMTP_SECURE = strtolower(trim($oDDO->preach('value', $data_attribute)));

                            }else{

                                $tmp_SMTP_SECURE = $oDDO;

                            }

                        break;
                        case 'SMTP_AUTOTLS':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach [' . $oDDO->count($data_attribute) . '] SMTP_AUTOTLS=' . $oDDO->preach('type', $data_attribute));

                                $tmp_SMTP_AUTOTLS = (bool) $oCRNRSTN_n->tidy_boolean($oDDO->preach('value', $data_attribute));

                            }else{

                                $tmp_SMTP_AUTOTLS = (bool) $oCRNRSTN_n->tidy_boolean($oDDO);

                            }

                        break;
                        case 'SMTP_AUTH':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach [' . $oDDO->count($data_attribute) . '] SMTP_AUTH=' . $oDDO->preach('type', $data_attribute));

                                $tmp_SMTP_AUTH = (bool) $oCRNRSTN_n->tidy_boolean($oDDO->preach('value', $data_attribute));

                            }else{

                                $tmp_SMTP_AUTH = (bool) $oCRNRSTN_n->tidy_boolean($oDDO);

                            }

                        break;
                        case 'SMTP_SERVER':

                            if(is_object($oDDO)){

                                $tmp_SMTP_SERVER = $oDDO->preach('value', $data_attribute);

                            }else{

                                $tmp_SMTP_SERVER = $oDDO;

                            }

                        break;
                        case 'SMTP_PORT_OUTGOING':

                            if(is_object($oDDO)){

                                $tmp_SMTP_PORT_OUTGOING = $oDDO->preach('value', $data_attribute);

                            }else{

                                $tmp_SMTP_PORT_OUTGOING = $oDDO;

                            }

                        break;
                        case 'SMTP_USERNAME':

                            if(is_object($oDDO)){

                                $tmp_SMTP_USERNAME = $oDDO->preach('value', $data_attribute);

                            }else{

                                $tmp_SMTP_USERNAME = $oDDO;

                            }

                        break;
                        case 'SMTP_PASSWORD':

                            if(is_object($oDDO)){

                                $tmp_SMTP_PASSWORD = $oDDO->preach('value', $data_attribute);

                            }else{

                                $tmp_SMTP_PASSWORD = $oDDO;

                            }

                        break;
                        case 'SENDMAIL_PATH':

                            if(is_object($oDDO)){

                                $tmp_SENDMAIL_PATH = $oDDO->preach('value', $data_attribute);

                            }else{

                                $tmp_SENDMAIL_PATH = $oDDO;

                            }

                        break;
                        case 'USE_SENDMAIL_OPTIONS':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach [' . $oDDO->count($data_attribute) . '] USE_SENDMAIL_OPTIONS=' . $oDDO->preach('type', $data_attribute));

                                $tmp_USE_SENDMAIL_OPTIONS = (bool) $oCRNRSTN_n->tidy_boolean($oDDO->preach('value', $data_attribute));

                            }else{

                                $tmp_USE_SENDMAIL_OPTIONS = (bool) $oCRNRSTN_n->tidy_boolean($oDDO);

                            }

                        break;
                        case 'DIBYA_SAHOO_SSL_CERT_BYPASS':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach DIBYA_SAHOO_SSL_CERT_BYPASS [' . $oDDO->count($data_attribute) . ']  DIBYA_SAHOO_SSL_CERT_BYPASS=' . $oDDO->preach('type', $data_attribute));

                                $tmp_DIBYA_SAHOO_SSL_CERT_BYPASS = (bool) $oCRNRSTN_n->tidy_boolean($oDDO->preach('value', $data_attribute));

                            }else{

                                $tmp_DIBYA_SAHOO_SSL_CERT_BYPASS = (bool) $oCRNRSTN_n->tidy_boolean($oDDO);

                            }

                        break;
                        case 'TRY_OTHER_EMAIL_METHODS_ON_ERR':

                            if(is_object($oDDO)){

                                $tmp_TRY_OTHER_EMAIL_METHODS_ON_ERR = (bool) $oCRNRSTN_n->tidy_boolean($oDDO->preach('value', $data_attribute));

                            }else{

                                $tmp_TRY_OTHER_EMAIL_METHODS_ON_ERR = (bool) $oCRNRSTN_n->tidy_boolean($oDDO);

                            }

                        break;

                    }

                }

            }

        }

        //$tmp_config_version_cnt = sizeof($config_data_ARRAY);
        error_log(__LINE__ . ' env class to send email = ' . get_class($oCRNRSTN_n));
        //error_log(__LINE__ . ' $tmp_config_version_cnt=' . $tmp_config_version_cnt);
        //for($config_vs=0; $config_vs < $tmp_config_version_cnt; $config_vs++) {

            $tmp_oGabriel_serial = $oCRNRSTN_n->generate_new_key(50);

            switch(get_class($oCRNRSTN_n)){
                case 'crnrstn_user':
                case 'crnrstn_environment':
                case 'crnrstn':

                    $tmp_recipient_cnt = count($tmp_RECIPIENT_EMAIL);

                    for ($i = 0; $i < $tmp_recipient_cnt; $i++) {

                        error_log(__LINE__ . ' processing recipient email=' . $tmp_RECIPIENT_EMAIL[$i]);

                        if(!($tmp_DUP_SUPPRESS && isset($tmp_sent_suppression[strtolower($tmp_RECIPIENT_EMAIL[$i])]))){

                            if($tmp_DUP_SUPPRESS){

                                $tmp_sent_suppression[strtolower($tmp_RECIPIENT_EMAIL[$i])] = 1;

                            }

                            $oCRNRSTN_GABRIEL = new crnrstn_messenger_from_north($tmp_oGabriel_serial, $tmp_EMAIL_PROTOCOL, $tmp_SMTP_USERNAME, $tmp_SMTP_PASSWORD, $tmp_SMTP_PORT_OUTGOING, $oCRNRSTN_n);

                            $crnrstn_phpmailer = new \PHPMailer\crnrstn_PHPMailer\crnrstn_PHPMailer($oCRNRSTN_n);
                            $crnrstn_phpmailer->Mailer = strtolower($tmp_EMAIL_PROTOCOL);  // "mail", "qmail", "sendmail", or "smtp".

                            $crnrstn_phpmailer->Priority = $tmp_PRIORITY;
                            $crnrstn_phpmailer->CharSet = $tmp_CHARSET;
                            $crnrstn_phpmailer->Encoding = $tmp_MESSAGE_ENCODING;
                            $crnrstn_phpmailer->Sendmail = $tmp_SENDMAIL_PATH;
                            $crnrstn_phpmailer->UseSendmailOptions = $tmp_USE_SENDMAIL_OPTIONS;

                            if($tmp_isHTML){

                                $crnrstn_phpmailer->isHTML();

                            }

                            $crnrstn_phpmailer->WordWrap = $tmp_WORDWRAP;
                            $crnrstn_phpmailer->AllowEmpty = $tmp_ALLOW_EMPTY;

                            $crnrstn_phpmailer->setFrom($tmp_FROM_EMAIL, $tmp_FROM_NAME);

                            //error_log(__LINE__ . ' env - Adding setFrom:' . $tmp_FROM_NAME . ' ' . $tmp_FROM_EMAIL);
                            //$crnrstn_phpmailer->From = $config_data_ARRAY[$config_vs]['FROM_EMAIL'][0];
                            //$crnrstn_phpmailer->FromName = $config_data_ARRAY[$config_vs]['FROM_NAME'][0];

                            $tmp_e_cnt = sizeof($tmp_REPLYTO_EMAIL);
                            if($tmp_e_cnt > 0){

                                for($e_pos=0; $e_pos<$tmp_e_cnt; $e_pos++){

                                    $crnrstn_phpmailer->addReplyTo($tmp_REPLYTO_EMAIL[$e_pos], $tmp_REPLYTO_NAME[$e_pos]);
                                    //error_log(__LINE__ . ' env - Adding ReplyTo:' . $tmp_REPLYTO_NAME[$e_pos] . ' ' . $tmp_REPLYTO_EMAIL[$e_pos]);

                                }

                            }

                            $tmp_e_cnt = sizeof($tmp_CC_EMAIL);
                            if($tmp_e_cnt > 0){

                                for($e_pos=0; $e_pos<$tmp_e_cnt; $e_pos++){

                                    $crnrstn_phpmailer->addCC($tmp_CC_EMAIL[$e_pos], $tmp_CC_NAME[$e_pos]);
                                    //error_log(__LINE__ . ' env - Adding CC:' . $tmp_CC_NAME[$e_pos] . ' ' . $tmp_CC_EMAIL[$e_pos]);

                                }

                            }

                            $tmp_e_cnt = sizeof($tmp_BCC_EMAIL);
                            if($tmp_e_cnt > 0){

                                for($e_pos=0; $e_pos<$tmp_e_cnt; $e_pos++){

                                    $crnrstn_phpmailer->addBCC($tmp_BCC_EMAIL[$e_pos], $tmp_BCC_NAME[$e_pos]);
                                    error_log(__LINE__ . ' env - Adding BCC:' . $tmp_BCC_NAME[$e_pos] . ' ' . $tmp_BCC_EMAIL[$e_pos]);

                                }

                            }

                            switch($tmp_EMAIL_PROTOCOL){
                                case 'SMTP':

                                    $crnrstn_phpmailer->Timeout = $tmp_SMTP_TIMEOUT;
                                    $crnrstn_phpmailer->SMTPKeepAlive = $tmp_SMTP_KEEPALIVE;
                                    $crnrstn_phpmailer->SMTPSecure = $tmp_SMTP_SECURE;
                                    $crnrstn_phpmailer->SMTPAutoTLS = $tmp_SMTP_AUTOTLS;

                                    if($tmp_SMTP_AUTH){

                                        $crnrstn_phpmailer->SMTPAuth = true;
                                        $crnrstn_phpmailer->Username = $tmp_SMTP_USERNAME;
                                        $crnrstn_phpmailer->Password = $tmp_SMTP_PASSWORD;
                                        $crnrstn_phpmailer->Host = $tmp_SMTP_SERVER;
                                        $crnrstn_phpmailer->Port = $tmp_SMTP_PORT_OUTGOING;

                                    }

                                    if($tmp_DIBYA_SAHOO_SSL_CERT_BYPASS){

                                        //
                                        // WORK AROUND FOR PHPMAILER SSL CERT VERIFICATION *ERRORS INTRODUCED
                                        // THROUGH THE STRICTER SSL BEHAVIOR THAT CAME WITH THE RELEASE OF PHP 5.6
                                        // SOURCE :: https://pepipost.com/tutorials/phpmailer-smtp-error-could-not-connect-to-smtp-host/
                                        // AUTHOR :: https://pepipost.com/tutorials/author/dibya-sahoo/
                                        // DETAIL :: https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting#certificate-verification-failure
                                        // * You may not see this error; In implicit encryption mode (SMTPS) it may be
                                        // hidden because there isn't a way for the channel to show messages - SMTP+STARTTLS
                                        // is generally easier to debug because of this.
                                        $crnrstn_phpmailer->SMTPOptions = array(
                                            'ssl' => array(
                                                'verify_peer' => false,
                                                'verify_peer_name' => false,
                                                'allow_self_signed' => true
                                            )
                                        );

                                        error_log(__LINE__ . ' env - DIBYA_SAHOO_SSL_CERT_BYPASS HAS BEEN APPLIED.');

                                    }else{

                                        error_log(__LINE__ . ' env - DIBYA_SAHOO_SSL_CERT_BYPASS HAS BEEN BYPASSED.');

                                    }

                                break;
                                case 'SENDMAIL':

                                    $crnrstn_phpmailer->isSendmail();

                                break;
                                case 'QMAIL':

                                    $crnrstn_phpmailer->isQmail();

                                break;
                                case 'MAIL':

                                    $crnrstn_phpmailer->isMail();

                                break;

                            }

                            //
                            // CONSTANTS
                            $tmp_php_trace_TEXT = $oCRNRSTN_n->return_PHP_exception_trace_pretty($exception_obj->getTraceAsString(), 'TEXT');
                            $tmp_log_constant_TEXT = $oCRNRSTN_n->return_logPriorityPretty($syslog_constant);
                            $tmp_crnrstn_trace_TEXT = $this->oLog_output_manager->return_log_trace_output_str('EMAIL_TEXT');
                            $crnrstn_phpmailer->Subject = 'Exception Notification from ' . $_SERVER['SERVER_NAME'] . ' via CRNRSTN ::';

                            if($tmp_isHTML){

                                $tmp_php_trace_HTML = $oCRNRSTN_n->return_PHP_exception_trace_pretty($exception_obj->getTraceAsString(), 'HTML');
                                $tmp_log_constant_HTML = $oCRNRSTN_n->return_logPriorityPretty($syslog_constant, 'HTML');
                                $tmp_crnrstn_trace_HTML = $this->oLog_output_manager->return_log_trace_output_str('EMAIL_HTML');

                            }

                            if (isset($tmp_RECIPIENT_NAME[$i])) {

                                $tmp_name = $tmp_RECIPIENT_NAME[$i];

                            } else {

                                $tmp_name = '';

                            }

                            error_log(__LINE__ . ' env - Adding Recipient:' . $tmp_name . ' ' . $oCRNRSTN_n->string_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private'));
                            $crnrstn_phpmailer->AddAddress($tmp_RECIPIENT_EMAIL[$i], $tmp_name);

                            //
                            // PREPARE TEXT VERSION
                            $tmp_TEXT_Body = $oCRNRSTN_GABRIEL->return_CRNRSTN_SysMsgTEXTBody('EXCEPTION_NOTIFICATION');
                            $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{SYSTEM_LOG_INTEGER_CONSTANT}', $tmp_log_constant_TEXT, $tmp_TEXT_Body);
                            $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{MESSAGE}', $tmp_exception_msg, $tmp_TEXT_Body);
                            $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{LINE_NUM}', $tmp_exception_linenum, $tmp_TEXT_Body);
                            $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{METHOD}', $exception_method, $tmp_TEXT_Body);
                            $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{PHP_TRACE}', $tmp_php_trace_TEXT, $tmp_TEXT_Body);
                            $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{SYSTEM_TIME}', $exception_systemtime, $tmp_TEXT_Body);
                            $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{PROCESS_RUN_TIME}', $exception_runtime, $tmp_TEXT_Body);
                            $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{EMAIL}', $tmp_RECIPIENT_EMAIL[$i], $tmp_TEXT_Body);
                            $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{LOG_TRACE}', $tmp_crnrstn_trace_TEXT, $tmp_TEXT_Body);

                            $crnrstn_phpmailer->AltBody = $tmp_TEXT_Body;

                            if ($tmp_isHTML) {

                                //
                                // PREPARE HTML VERSION
                                $tmp_HTML_Body = $oCRNRSTN_GABRIEL->return_CRNRSTN_SysMsgHTMLBody('EXCEPTION_NOTIFICATION');
                                $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{SYSTEM_LOG_INTEGER_CONSTANT}', $tmp_log_constant_HTML, $tmp_HTML_Body);
                                $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{MESSAGE}', $tmp_exception_msg, $tmp_HTML_Body);
                                $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{LINE_NUM}', $tmp_exception_linenum, $tmp_HTML_Body);
                                $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{METHOD}', $exception_method, $tmp_HTML_Body);
                                $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{PHP_TRACE}', $tmp_php_trace_HTML, $tmp_HTML_Body);
                                $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{SYSTEM_TIME}', $exception_systemtime, $tmp_HTML_Body);
                                $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{PROCESS_RUN_TIME}', $exception_runtime, $tmp_HTML_Body);
                                $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{EMAIL}', $tmp_RECIPIENT_EMAIL[$i], $tmp_HTML_Body);
                                $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{LOG_TRACE}', $tmp_crnrstn_trace_HTML, $tmp_HTML_Body);

                                $crnrstn_phpmailer->Body = $tmp_HTML_Body;

                            }

                            error_log(__LINE__ . ' env - crnrstn_phpmailer->send()');

                            $crnrstn_phpmailer->Mailer = strtolower($tmp_EMAIL_PROTOCOL);  // "mail", "qmail", "sendmail", or "smtp".

                            if(!$crnrstn_phpmailer->Send()){

                                if($tmp_TRY_OTHER_EMAIL_METHODS_ON_ERR){

                                    $oCRNRSTN_n->error_log('An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->string_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Graceful degradation to secondary email send protocol is commencing due to: ' . $crnrstn_phpmailer->ErrorInfo, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                                    error_log(__LINE__ . ' - An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->string_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Graceful degradation to secondary email send protocol is commencing due to: ' . $crnrstn_phpmailer->ErrorInfo);

                                    $crnrstn_phpmailer = $this->next_mail_protocol_option($crnrstn_phpmailer);
                                    if(!$crnrstn_phpmailer->Send()){

                                        $oCRNRSTN_n->error_log('An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->string_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Graceful degradation to tertiary email send protocol is commencing due to: ' . $crnrstn_phpmailer->ErrorInfo, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                                        error_log(__LINE__ . ' - An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->string_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Graceful degradation to tertiary email send protocol is commencing due to: ' . $crnrstn_phpmailer->ErrorInfo);

                                        $crnrstn_phpmailer = $this->next_mail_protocol_option($crnrstn_phpmailer);
                                        if(!$crnrstn_phpmailer->Send()){

                                            $oCRNRSTN_n->error_log('An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->string_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Graceful degradation to quatiary email send protocol is commencing due to: ' . $crnrstn_phpmailer->ErrorInfo, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                                            error_log(__LINE__ . ' - An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->string_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Graceful degradation to quatiary email send protocol is commencing due to: ' . $crnrstn_phpmailer->ErrorInfo);

                                            $crnrstn_phpmailer = $this->next_mail_protocol_option($crnrstn_phpmailer);
                                            if(!$crnrstn_phpmailer->Send()){

                                                $oCRNRSTN_n->error_log('An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->string_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Graceful degradation to pentiary email send protocol is commencing due to: ' . $crnrstn_phpmailer->ErrorInfo, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                                                error_log(__LINE__ . ' - An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->string_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Graceful degradation to pentiary email send protocol is commencing due to: ' . $crnrstn_phpmailer->ErrorInfo);

                                                $crnrstn_phpmailer = $this->next_mail_protocol_option($crnrstn_phpmailer);
                                                if(!$crnrstn_phpmailer->Send()) {

                                                    //
                                                    // ...on my usage of the term "hexapolynomial"...as being of the
                                                    // same ilk as usages (contained also herein) of secondary,
                                                    // tertiary, etc...I feel pretty good standing in the shadow
                                                    // of the following...
                                                    //
                                                    // - J5, November 9, 2020 0845hrs
                                                    //
                                                    // SOURCE :: https://ieeexplore.ieee.org/abstract/document/9195628
                                                    // AUTHOR :: https://ieeexplore.ieee.org/author/37086360445
                                                    // This paper discusses twice continuously differentiable and three times
                                                    // continuously differentiable approximations with polynomial and
                                                    // non-polynomial splines. To construct the approximation, a polynomial and
                                                    // non-polynomial local basis of the second level and the sixth order
                                                    // approximation is constructed. We call the approximation a second level
                                                    // approximation because it uses the first and the second derivatives of the
                                                    // function. The non-polynomial approximation has the properties of
                                                    // polynomial and trigonometric functions. Here we have also constructed a
                                                    // non-polynomial interpolating spline which has the first, the second and
                                                    // the third continuous derivative. This approximation uses the values of
                                                    // the function at the nodes, the values of the first derivative of the
                                                    // function at the nodes and the values of the second derivative of the
                                                    // function at the ends of the interval [a, b]. The theorems of the
                                                    // approximations are given. Numerical examples are given.
                                                    //
                                                    // - I. G. Burova,
                                                    // St. Petersburg State University,
                                                    // Dept. of Computational Mathematics

                                                    $oCRNRSTN_n->error_log('An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->string_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Attempting final graceful degradation...hexapolynomial in nature...albeit CRNRSTN :: has, at this point, already measured and found to be wanting the fifth (5th) and final email send use case of the four (4) official and available protocols for things of this nature per /crnrstn_PHPMailer/. TLDR; ...an empty string will now be sent as the mailer protocol, and the results for which what one would hope...could only be the best. ' . $crnrstn_phpmailer->ErrorInfo, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                                                    error_log(__LINE__ . 'An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->string_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Attempting final graceful degradation...hexapolynomial in nature...albeit CRNRSTN :: has, at this point, already measured and found to be wanting the fifth (5th) and final email send use case of the four (4) official and available protocols for things of this nature per /crnrstn_PHPMailer/. TLDR; ...an empty string will now be sent as the mailer protocol, and the results for which what one would hope...could only be the best. ' . $crnrstn_phpmailer->ErrorInfo);

                                                    $crnrstn_phpmailer = $this->next_mail_protocol_option($crnrstn_phpmailer);
                                                    if (!$crnrstn_phpmailer->Send()) {

                                                        $oCRNRSTN_n->error_log('An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->string_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . '. Abandoning email delivery efforts due to: ' . $crnrstn_phpmailer->ErrorInfo, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                                                        error_log(__LINE__ . ' - An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->string_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . '. Abandoning email delivery efforts due to: ' . $crnrstn_phpmailer->ErrorInfo);

                                                    }

                                                }

                                            }

                                        }else{

                                            error_log(__LINE__ . ' - A SUCCESS was experienced while attempting to send an email to ' . $oCRNRSTN_n->string_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '.');

                                        }

                                    }else{

                                        error_log(__LINE__ . ' - A SUCCESS was experienced while attempting to send an email to ' . $oCRNRSTN_n->string_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '.');

                                    }

                                }else{

                                    $oCRNRSTN_n->error_log('An error was experienced while attempting to send an email to '.$oCRNRSTN_n->string_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Abandoning email delivery efforts due to: ' . $crnrstn_phpmailer->ErrorInfo, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                                    error_log(__LINE__ . ' - An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->string_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Abandoning email delivery efforts due to: ' . $crnrstn_phpmailer->ErrorInfo);

                                }

                            }else{

                                error_log(__LINE__ . ' - A SUCCESS was experienced while attempting to send an email to ' . $oCRNRSTN_n->string_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '.');

                            }

                            array_splice($this->mail_protocol_flag_ARRAY, 0);

                            //
                            // CLEAR SEND DATA (ALSO ANY MESSAGE ATTACHMENTS CLEARED)
                            $crnrstn_phpmailer->ClearAddresses();

                        }

                    }

                    if(isset($tmp_SMTP_KEEPALIVE)){

                        if($tmp_SMTP_KEEPALIVE){

                            $crnrstn_phpmailer->smtpClose();

                        }

                    }

                break;
            }

        //}

        return true;

    }

    private function no_cars_go_FILE($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj){

        $this->load_log_output_mgr($oCRNRSTN_n);

        $tmp_LOCAL_DIR_FILEPATH = array();
        $tmp_LOCAL_MKDIR_MODE = array();

        //
        // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
        foreach($this->profile_endpoint_data_ARRAY as $config_version => $chunkArray0){

            //error_log(__LINE__ . ' env - should be (more than one) ' . $tmp_size . '...config_version=' . $config_version);

            foreach($chunkArray0 as $data_attribute => $chunkArray1){

                foreach($chunkArray1 as $content_count => $oDDO){

                    switch($data_attribute){
                        case 'LOCAL_DIR_PATH':
                        case 'LOCAL_DIR_FILEPATH':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach LOCAL_DIR_FILEPATH cnt=' . $oDDO->count($data_attribute));

                                $tmp_LOCAL_DIR_FILEPATH[] = $oDDO->preach('value', $data_attribute);

                            }else{

                                $tmp_LOCAL_DIR_FILEPATH[] = $oDDO;

                            }

                        break;
                        case 'LOCAL_MKDIR_MODE':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach LOCAL_DIR_FILEPATH cnt=' . $oDDO->count($data_attribute));

                                $tmp_LOCAL_MKDIR_MODE[] = $oDDO->preach('value', $data_attribute);

                            }else{

                                $tmp_LOCAL_MKDIR_MODE[] = $oDDO;

                            }

                        break;

                    }

                    //error_log(__LINE__ . ' env - [' . $config_version . '] [' . $data_attribute . '] [' . $content_count . '] [' . $oDDO . ']');

                }

            }

        }

        switch(get_class($oCRNRSTN_n)){
            case 'crnrstn_user':
            case 'crnrstn_environment':
            case 'crnrstn':

            //
            // CONSTANTS
            $tmp_php_trace_TEXT = $oCRNRSTN_n->return_PHP_exception_trace_pretty($exception_obj->getTraceAsString(), 'TEXT');
            $tmp_log_constant_TEXT = $oCRNRSTN_n->return_logPriorityPretty($syslog_constant);
            $tmp_crnrstn_trace_TEXT = $this->oLog_output_manager->return_log_trace_output_str('FILE', 0);

            //$tmp_config_version_cnt = sizeof($config_data_ARRAY);
            //error_log(__LINE__ . ' env class to log to file is ' . get_class($oCRNRSTN_n) . ' and the logging object profile integer type is ' . $this->logging_profile);

            $tmp_log_output = $tmp_crnrstn_trace_TEXT . '
' . $tmp_php_trace_TEXT . '
';

            //
            // CHECK FILE SPECIFIC ARRAY AND PUSH TO ALL.
            foreach ($tmp_LOCAL_DIR_FILEPATH as $key => $log_filepath){

                if(isset($tmp_LOCAL_MKDIR_MODE[$key])){

                    $this->output_to_local_file($oCRNRSTN_n, $tmp_log_output, $log_filepath, $tmp_LOCAL_MKDIR_MODE[$key]);

                }else{

                    $this->output_to_local_file($oCRNRSTN_n, $tmp_log_output, $log_filepath);

                }

            }

            break;
        }

        return true;

    }

    private function no_cars_go_LOG_FILE_FTP($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj){

        $this->load_log_output_mgr($oCRNRSTN_n);

        $tmp_val_tunnel_ARRAY = array();

        //
        // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
        foreach($this->profile_endpoint_data_ARRAY as $config_version => $chunkArray0){

            //error_log(__LINE__ . ' env - should be (more than one) ' . $tmp_size . '...config_version=' . $config_version);

            foreach($chunkArray0 as $data_attribute => $chunkArray1){

                foreach($chunkArray1 as $content_count => $oDDO){

                    switch($data_attribute){
                        case 'FTP_SERVER':

                            $tmp_FTP_SERVER = $oDDO->preach('value', $data_attribute);;

                        break;
                        case 'FTP_USERNAME':

                            $tmp_FTP_USERNAME = $oDDO->preach('value', $data_attribute);;

                        break;
                        case 'FTP_PASSWORD':

                            $tmp_FTP_PASSWORD = $oDDO->preach('value', $data_attribute);;

                        break;
                        case 'FTP_PORT':

                            $tmp_FTP_PORT = $oDDO->preach('value', $data_attribute);;

                        break;
                        case 'FTP_TIMEOUT':

                            $tmp_FTP_IS_SSL = $oDDO->preach('value', $data_attribute);

                        break;
                        case 'FTP_IS_SSL':

                            $tmp_FTP_IS_SSL = $oDDO->preach('value', $data_attribute);

                        break;
                        case 'FTP_USE_PASV':

                            $tmp_FTP_USE_PASV = $oDDO->preach('value', $data_attribute);

                        break;
                        case 'FTP_USE_PASV_ADDR':

                            $tmp_FTP_USE_PASV_ADDR = $oDDO->preach('value', $data_attribute);

                        break;
                        case 'FTP_DISABLE_AUTOSEEK':

                            $tmp_FTP_DISABLE_AUTOSEEK = $oDDO->preach('value', $data_attribute);

                        break;
                        case 'FTP_DIR_PATH':

                            $tmp_FTP_DIR_PATH = $oDDO->preach('value', $data_attribute);

                        break;
                        case 'FTP_MKDIR_MODE':

                            $tmp_FTP_MKDIR_MODE = $oDDO->preach('value', $data_attribute);

                        break;

                    }

                }

            }

        }

        //
        // READY TO CREATE FILE AND SEND VIA CRNRSTN :: ELECTRUM
        switch(get_class($oCRNRSTN_n)){
            case 'crnrstn_user':
            case 'crnrstn_environment':
            case 'crnrstn':

                //
                // CONSTANTS
                $tmp_php_trace_TEXT = $oCRNRSTN_n->return_PHP_exception_trace_pretty($exception_obj->getTraceAsString(), 'TEXT');
                $tmp_log_constant_TEXT = $oCRNRSTN_n->return_logPriorityPretty($syslog_constant);
                $tmp_crnrstn_trace_TEXT = $this->oLog_output_manager->return_log_trace_output_str('FILE', 0);

                //$tmp_config_version_cnt = sizeof($config_data_ARRAY);
                error_log(__LINE__ . ' env class to log to FTP_FILE is ' . get_class($oCRNRSTN_n) . ' and the logging object profile integer type is ' . $this->logging_profile);

                $tmp_log_output = $tmp_crnrstn_trace_TEXT . '
' . $tmp_php_trace_TEXT . '
';

                //
                // CHECK FILE SPECIFIC ARRAY AND PUSH TO ALL.
                foreach ($tmp_val_tunnel_ARRAY as $config_ver => $attribute_array){

                    $this->output_to_file_ftp($oCRNRSTN_n, $tmp_log_output, $attribute_array);

                }

            break;

        }

        return true;

    }

    private function no_cars_go_SCREEN_HTML($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj){

        $this->load_log_output_mgr($oCRNRSTN_n);

        //
        // CONSTANTS
        $tmp_php_trace_TEXT = $oCRNRSTN_n->return_PHP_exception_trace_pretty($exception_obj->getTraceAsString(), 'TEXT');
        $tmp_log_constant_TEXT = $oCRNRSTN_n->return_logPriorityPretty($syslog_constant);
        $tmp_crnrstn_trace_TEXT = $this->oLog_output_manager->return_log_trace_output_str('FILE', 0);

        $tmp_log_output = $tmp_crnrstn_trace_TEXT . '
' . $tmp_php_trace_TEXT . '
';
        error_log(__LINE__ . ' env no_cars_go_SCREEN_HTML() [' . get_class($oCRNRSTN_n) . '] self class=' . get_class(self::$oCRNRSTN_n));
//die();
        $oCRNRSTN_n->destruct_output .= $oCRNRSTN_n->print_r_str($tmp_log_output, $tmp_log_constant_TEXT, NULL, __LINE__, __METHOD__, __FILE__);
        self::$oCRNRSTN_n = $oCRNRSTN_n;

        return true;

    }

    private function no_cars_go_SCREEN_TEXT($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj){

        $this->load_log_output_mgr($oCRNRSTN_n);

        //
        // CONSTANTS
        $tmp_php_trace_TEXT = $oCRNRSTN_n->return_PHP_exception_trace_pretty($exception_obj->getTraceAsString(), 'TEXT');
        $tmp_log_constant_TEXT = $oCRNRSTN_n->return_logPriorityPretty($syslog_constant);
        $tmp_crnrstn_trace_TEXT = $this->oLog_output_manager->return_log_trace_output_str('SCREEN_TEXT', 74);

        $tmp_log_output = $tmp_crnrstn_trace_TEXT . '
' . $tmp_php_trace_TEXT . '
';

        $oCRNRSTN_n->destruct_output .= $tmp_log_output;

        return true;

    }

    private function no_cars_go_SCREEN_HTML_HIDDEN($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj){

        $this->load_log_output_mgr($oCRNRSTN_n);

        switch(get_class($oCRNRSTN_n)){
            case 'crnrstn_user':
            case 'crnrstn_environment':
            case 'crnrstn':

                //
                // CONSTANTS
                $tmp_php_trace_TEXT = $oCRNRSTN_n->return_PHP_exception_trace_pretty($exception_obj->getTraceAsString(), 'TEXT');
                $tmp_log_constant_TEXT = $oCRNRSTN_n->return_logPriorityPretty($syslog_constant);
                $tmp_crnrstn_trace_TEXT = $this->oLog_output_manager->return_log_trace_output_str('FILE', 0);

                $tmp_log_output = $tmp_crnrstn_trace_TEXT . '
' . $tmp_php_trace_TEXT . '
';

                $tmp_hidden_html = '<!--
' . htmlentities($tmp_log_output) . '
-->
';

                $oCRNRSTN_n->destruct_output .= $tmp_hidden_html;

            break;

        }

        return true;

    }

    private function no_cars_go_DEFAULT($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj){

        $this->load_log_output_mgr($oCRNRSTN_n);

        switch(get_class($oCRNRSTN_n)){
            case 'crnrstn_user':
            case 'crnrstn_environment':
            case 'crnrstn':

                //
                // CONSTANTS
                $tmp_php_trace_TEXT = $oCRNRSTN_n->return_PHP_exception_trace_pretty($exception_obj->getTraceAsString(), 'TEXT');
                $tmp_log_constant_TEXT = $oCRNRSTN_n->return_logPriorityPretty($syslog_constant);
                $tmp_crnrstn_trace_TEXT = $this->oLog_output_manager->return_log_trace_output_str('ERROR_LOG', 0);

                error_log($tmp_crnrstn_trace_TEXT);
                error_log($tmp_php_trace_TEXT);

            break;

        }

        return true;

    }

    private function output_to_file_ftp($oCRNRSTN_n, $tmp_log_output, $attribute_array){

        //error_log(__LINE__ . ' env output_to_file_ftp [' . $tmp_log_output . ']]');

//        $tmp_FTP_SERVER = array();
//        $tmp_FTP_USERNAME = array();
//        $tmp_FTP_PASSWORD = array();
//        $tmp_FTP_PORT = array();
//        $tmp_FTP_TIMEOUT = array();
//        $tmp_FTP_IS_SSL = array();
//        $tmp_FTP_USE_PASV = array();
//        $tmp_FTP_USE_PASV_ADDR = array();
//        $tmp_FTP_DISABLE_AUTOSEEK = array();
//        $tmp_FTP_DIR_PATH = array();
//        $tmp_FTP_MKDIR_MODE = array();

        foreach($this->profile_endpoint_criteria_ARRAY[CRNRSTN_LOG_FILE_FTP] as $key => $value){

            //error_log(__LINE__ . ' env profile_endpoint_criteria_ARRAY [' . print_r($key,true) . '] [' . print_r($value,true) . ']');

            if(isset($attribute_array[$key])){

                if(is_object($attribute_array[$key][0])){

                    error_log(__LINE__ . ' env output_to_file_ftp [' . $key . '][OBJECT]');

                }else{

                    error_log(__LINE__ . ' env output_to_file_ftp [' . $key . '][' . print_r($attribute_array[$key][0], true) . ']');

                }

            }else{

                error_log(__LINE__ . ' env output_to_file_ftp NO SET=[' . $key . '][' . print_r($attribute_array[$key], true) . ']');

            }

        }

        // self::$crnrstn_tmp_dir

        switch(get_class($oCRNRSTN_n)){
            case 'crnrstn':

                if($tmp_crnrstn_tmp_dir = $oCRNRSTN_n->return_tmp()){

                    error_log(__LINE__ . ' env Ready to write to /tmp ....the error log file for FTP delivery (See wind_cloud_fire line 3088 area).');

                    $file_source_path = $this->output_to_local_file($oCRNRSTN_n, $tmp_log_output, $tmp_crnrstn_tmp_dir);

                    error_log(__LINE__ . ' env Completed write of file [' . $file_source_path . '][' . $oCRNRSTN_n->format_bytes(filesize($file_source_path)) . ']');

                }else{

                    error_log(__LINE__ . ' env Unable to write /tmp error log file for FTP delivery due to missing embryonic /tmp dir.');

                }

            break;
            default:

                error_log(__LINE__ . ' env DEFAULT!!!');

            break;

        }

        $ftp_stream_target = NULL;

//        if(self::$oCRNRSTN_n->file_local_send_by_ftp($ftp_stream_target, $file_source_path, $oEndpoint_serial_SOURCE, $oEndpoint_serial_DESTINATION, $oElectrum_STATS)){
//
//            //if($this->fileMove_DIR_DF($dest_ftp_stream, $dest_FTP_ROOT_DIR_PATH, $this->DESTINATION_FILE_PATH, $SOURCE_filePath)){
//
//            $this->is_transferred = true;
//
//            //self::$oCRNRSTN_USR->error_log('oWheel TMP file write TO FTP SUCCESS. REMOVE TMP FILE.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');
//
//        }else{
//
//            $error = error_get_last();
//            self::$oCRNRSTN_n->error_log('oWheel fileMove_DF() ERROR :: '.$error['message'], __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');
//
//        }

        unlink($file_source_path);

    }

    private function output_to_local_file($oCRNRSTN_n, $str, $file_path, $mkdir_permissons_mode = 775){

        if(is_dir($file_path)){

            if($this->validate_DIR_endpoint('DESTINATION', $file_path, $mkdir_permissons_mode)){

                //
                // WE HAVE A DIRECTORY PATH...NO FILE NAME PROVIDED; CREATE ONE.
                $tmp_filename = 'crnrstn_errlog_' . $_SERVER['SERVER_NAME'];

                $file_path = rtrim($file_path,DIRECTORY_SEPARATOR);

                $file_path = $file_path.DIRECTORY_SEPARATOR.$tmp_filename . '.txt';

            }else{

                //
                // CRNRSTN :: CANNOT WRITE LOG FILE DUE TO END POINT NOT VALID
                self::$oCRNRSTN_n->error_log('Unable to write data to local directory file, ' . $file_path . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY_FILE);

                return false;

            }

        }else{

            //
            // WE HAVE PROPER FILE PATH.
            $tmp_sniffed_dir = dirname($file_path);

            if(!$this->validate_DIR_endpoint('DESTINATION', $tmp_sniffed_dir, $mkdir_permissons_mode)){

                self::$oCRNRSTN_n->error_log('Unable to write data to local directory file, ' . $file_path . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY_FILE);

                return false;

            }

        }

        //
        // VALIDATE FILE PATH ON FILE OPEN FOR APPEND
        if($fp = fopen($file_path, 'a')){

            fwrite($fp, $str);
            fclose($fp);

            return $file_path;

        }else{

            //
            // MODIFY DIRECTORY PERMISSIONS
            self::$oCRNRSTN_n->error_log('CRNRSTN :: Unable to locate the provided path and/or open/create file for write only (i.e. append) at filepath="' . $file_path . '".', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY_FILE);

            return false;

        }

    }

    private function validate_DIR_endpoint($flow_type, $dir_path, $mkdir_mode = 775){

        switch($flow_type) {
            case 'SOURCE':

                if(is_dir($dir_path)){

                    //
                    // SOURCE - LOCAL_DIR
                    if(is_readable($dir_path)){

                        return true;

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        self::$oCRNRSTN_n->error_log('CRNRSTN :: has experienced permissions related errors attempting to read from the source directory, ' . $dir_path . '.');

                    }

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    self::$oCRNRSTN_n->error_log('CRNRSTN :: has experienced errors attempting to find the source directory, ' . $dir_path . ', within the local file system.');

                }

            break;
            default:

                //
                // DESTINATION - LOCAL_DIR
                if(is_dir($dir_path)){

                    if(is_writable($dir_path)){

                        //error_log(__LINE__ . ' ' . __METHOD__ . ' env THE DIRECTORY IS WRITABLE!');

                        return true;

                    }else{

                        error_log(__LINE__ . ' ' . __METHOD__ . ' env THE DIRECTORY IS **NOT** WRITABLE!');

                        //
                        // ATTEMPT TO CHANGE PERMISSIONS AND CHECK AGAIN
                        // BEFORE COMPLETELY GIVING UP
                        $tmp_current_perms = substr(decoct( fileperms($dir_path) ), 2);
                        $tmp_config_serial_hash = self::$oCRNRSTN_n->config_serial_hash;

                        $_SESSION['CRNRSTN_' . $tmp_config_serial_hash]['CRNRSTN_EXCEPTION_PREFIX'] = 'CRNRSTN :: has experienced permissions related error as the destination directory, ' . $dir_path . ' (' . $tmp_current_perms . '), is NOT writable to ' . $mkdir_mode . ', and furthermore ';
                        if(chmod($dir_path, $mkdir_mode)){

                            $_SESSION['CRNRSTN_'. $tmp_config_serial_hash]['CRNRSTN_EXCEPTION_PREFIX'] = '';
                            return true;

                        }else{

                            $tmp_current_perms = substr(decoct( fileperms($dir_path) ), 2);

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            self::$oCRNRSTN_n->error_log('CRNRSTN :: has experienced permissions related error as the destination directory, ' . $dir_path . ', is NOT writable with current permissions as ' . $tmp_current_perms . '.');

                        }

                    }

                }else{

                    //
                    // ATTEMPT TO MAKE DIRECTORY
                    // BEFORE COMPLETELY GIVING UP
                    if (!self::$oCRNRSTN_n->mkdir_r($dir_path, $mkdir_mode)) {

                        $mkdir_mode = octdec( str_pad($mkdir_mode,4,'0',STR_PAD_LEFT) );

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        self::$oCRNRSTN_n->error_log('CRNRSTN :: has experienced error as the destination directory, ' . $dir_path . ', does NOT exist, and it could NOT be created as ' . $mkdir_mode . '.');

                    }else{

                        return true;

                    }

                }

            break;

        }

        return false;

    }

    //
    // SOURCE :: https://www.youtube.com/watch?v=83KR_UBWdPI
    // TITLE :: Arcade Fire - No Cars Go
    public function no_cars_tification_go($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj){

        switch($this->logging_profile){
            case CRNRSTN_LOG_SCREEN:
            case CRNRSTN_LOG_SCREEN_HTML:

                return $this->no_cars_go_SCREEN_HTML($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj);

            break;
            case CRNRSTN_LOG_SCREEN_TEXT:

                return $this->no_cars_go_SCREEN_TEXT($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj);

            break;
            case CRNRSTN_LOG_SCREEN_HTML_HIDDEN:

                return $this->no_cars_go_SCREEN_HTML_HIDDEN($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj);

            break;
            case CRNRSTN_LOG_EMAIL:

                //
                // DEFAULT CRNRSTN CONFIGURATION - RECOMMENDATION FOR CONFIG PRIORITY ::
                // EMAIL_PRIMARY = [n] USER SELECTION
                // EMAIL_SECONDARY = SENDMAIL (NO AUTHENTICATION) WITH CRNRSTN WCR CONFIGURATION
                // EMAIL_TERTIARY = MAIL (NO AUTHENTICATION) WITH CRNRSTN WCR CONFIGURATION
                // *EMAIL_QUATIARY = QMAIL (NO AUTHENTICATION) WITH CRNRSTN WCR CONFIGURATION
                // *EMAIL_PENTIARY = UNAUTHENTICATED SMTP WITH CRNRSTN WCR CONFIGURATION
                // *EMAIL_HEXAPOLYNOMIALLY = NULL MODE FIRE
                // * UNTESTED

                return $this->no_cars_go_EMAIL($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj);

            break;
            case CRNRSTN_LOG_EMAIL_PROXY:

                /*
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CRNRSTN_SOAP_SVC_AUTH_KEY'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CRNRSTN_PROXY_CONNECTION_ID'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOA_NAMESPACE'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['WSDL_URI'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['WSDL_CACHE_TTL'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['NUSOAP_USECURL'] = 1;

                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_SECRET_KEY'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_CIPHER'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_OPTIONS'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_HMAC_ALG'] = 1;

                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['EMAIL_PROTOCOL'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_AUTH'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_SERVER'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_PORT_OUTGOING'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_USERNAME'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_PASSWORD'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_TIMEOUT'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_KEEPALIVE'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_SECURE'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_AUTOTLS'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_AUTOTLS'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['DIBYA_SAHOO_SSL_CERT_BYPASS'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SENDMAIL_PATH'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['USE_SENDMAIL_OPTIONS'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['ALLOW_EMPTY'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FROM_NAME'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['REPLYTO_NAME_PIPED'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CC_NAME_PIPED'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['BCC_NAME_PIPED'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['RECIPIENTS_NAME_PIPED'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FROM_EMAIL'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['REPLYTO_EMAIL_PIPED'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CC_EMAIL_PIPED'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['BCC_EMAIL_PIPED'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['RECIPIENTS_EMAIL_PIPED'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SUBJECT_LINE'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['MESSAGE_BODY_HTML'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['MESSAGE_BODY_TEXT'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['WORDWRAP'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['ISHTML'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['PRIORITY'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CHARSET'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['MESSAGE_ENCODING'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['DUP_SUPPRESS'] = 1;
                 * */
                //error_log(__LINE__ . ' env - would run no_cars_go_EMAIL_PROXY() now for :: ' . $tmp_exception_output_str);
                //$tmp_resp = $this->no_cars_go_EMAIL_PROXY($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj);
                //error_log(__LINE__ . ' env - no_cars_go_EMAIL_PROXY return=[' . $tmp_resp . ']');
                //die();

                return $this->no_cars_go_EMAIL_PROXY($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj);

            break;
            case CRNRSTN_LOG_FILE:

                return $this->no_cars_go_FILE($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj);

            break;
            case CRNRSTN_LOG_FILE_FTP:

                return $this->no_cars_go_LOG_FILE_FTP($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj);

            break;
            case CRNRSTN_LOG_DEFAULT:
            default:

                //error_log(__LINE__ . ' env ABOUT TO TRY TO no_cars_go_DEFAULT()...');

                //
                // NATIVE PHP ERROR LOGGING
                return $this->no_cars_go_DEFAULT($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj);

            break;

        }

        return false;

    }

    public function client_send_CRNRSTN_SOAP_REQUEST($SOAP_method, $SOAP_request, $SOAP_endpoint=NULL){

        if(!isset($SOAP_endpoint)){

            $SOAP_endpoint = $this->oSoapDataTransportLayer->preach('value', 'WSDL_URI');

        }

        $WSDL_cache_ttl = $this->oSoapDataTransportLayer->preach('value', 'WSDL_CACHE_TTL');
        $nusoap_useCURL = $this->oSoapDataTransportLayer->preach('value', 'NUSOAP_USECURL');

        //
        // INSTANTIATE SOAP CLIENT
        $this->oSoapClient = new crnrstn_soap_client_manager(self::$oCRNRSTN_n, $SOAP_endpoint, $WSDL_cache_ttl, $nusoap_useCURL);

        //return $this->oSoapClient->sendRequest_SOAP($SOAP_method, $SOAP_request);
        self::$oCRNRSTN_n->print_r($SOAP_request, 'SEND CLIENT REQUEST :: ' . $SOAP_method, NULL, __LINE__, __METHOD__, __FILE__);
        $tmp_resp = $this->oSoapClient->sendRequest_SOAP($SOAP_method, $SOAP_request);
        self::$oCRNRSTN_n->print_r($tmp_resp, 'OUTPUT SERVER RESPONSE :: ' . $SOAP_method, NULL, __LINE__, __METHOD__, __FILE__);

        $tmp_title = 'Description: ' . $SOAP_method . ' returnError output.';
        $tmp_err = $this->oSoapClient->returnError();
        $tmp_arr = array();
        $tmp_arr[] = $tmp_title;
        $tmp_arr[] = $tmp_err;

        self::$oCRNRSTN_n->print_r($tmp_arr, 'SERVER RESPONSE :: ' . $SOAP_method . ' oSoapClient->returnError', NULL, __LINE__, __METHOD__, __FILE__);
        //self::$oCRNRSTN_n->print_r($this->oSoapClient->returnClientResponse(), 'SERVER RESPONSE :: ' . $SOAP_method . ' oSoapClient->returnClientResponse', NULL, __LINE__, __METHOD__, __FILE__);
        //self::$oCRNRSTN_n->print_r($this->oSoapClient->returnClientGetDebug(), 'SERVER RESPONSE :: ' . $SOAP_method . ' oSoapClient->returnClientGetDebug', NULL, __LINE__, __METHOD__, __FILE__);

        return $tmp_resp;
        //die();
    }

    private function next_mail_protocol_option($crnrstn_phpmailer){

        for($i = 0; $i < $this->tmp_mail_protocol_options_cnt; $i++){

            if(!isset($this->mail_protocol_flag_ARRAY[$this->tmp_mail_protocol_options_ARRAY[$i]])){

                $this->mail_protocol_flag_ARRAY[$this->tmp_mail_protocol_options_ARRAY[$i]] = 1;

                switch($this->tmp_mail_protocol_options_ARRAY[$i]){
                    case 'SMTP':

                        $crnrstn_phpmailer->SMTPAuth = false;
                        $crnrstn_phpmailer->Mailer = strtolower($this->tmp_mail_protocol_options_ARRAY[$i]);

                    break;
                    default:

                        $crnrstn_phpmailer->Mailer = strtolower($this->tmp_mail_protocol_options_ARRAY[$i]);

                    break;
                }

                return $crnrstn_phpmailer;

            }

        }

        $crnrstn_phpmailer->SMTPAuth = false;
        $crnrstn_phpmailer->Mailer = '';

        return $crnrstn_phpmailer;

    }

    public function receive_profile_EMAIL_WCR($oWCR, $WCR_key){

        $this->isValid = true;

        //
        // I AM EMAIL PROFILE. RECEIVE EMAIL WCR DATA.
        $this->wcr_profiles_cnt++;

        //error_log(__LINE__ . ' profile_endpoint_criteria_ARRAY=' . print_r($this->profile_endpoint_criteria_ARRAY, true));

        //
        // *ALL* POSSIBLE EMAIL WCR KEYS
        foreach($this->profile_endpoint_criteria_ARRAY[CRNRSTN_LOG_EMAIL] as $param_key => $value){

            //error_log(__LINE__ . ' env - Checking for existence of ' . $param_key . ' data within config init oWCR, ' . $WCR_key);

            if($oWCR->isset_WCR($WCR_key, $param_key)){

                //error_log(__LINE__ . ' env - Found existence of ' . $param_key . ' data within config init oWCR, ' . $WCR_key);
                $tmp_wcr_data = $oWCR->get_attribute($WCR_key, $param_key);

                if(is_object($tmp_wcr_data)){

                    switch($param_key){
                        case 'RECIPIENTS_NAME_PIPED':
                        case 'REPLYTO_NAME_PIPED':
                        case 'CC_NAME_PIPED':
                        case 'BCC_NAME_PIPED':
                        break;
                        case 'RECIPIENTS_EMAIL_PIPED':

                            $tmp_name_array = array();
                            $tmp_name_data = $oWCR->get_attribute($WCR_key, 'RECIPIENTS_NAME_PIPED');

                            //preach('isset', key). ..
                            //preach('type')
                            //preach('value')

                            if($tmp_name_data->preach('isset', $param_key)){

                                $tmp_name_array = explode('|', $tmp_name_data->preach('value', $param_key));

                            }

                            $this->receive_profile_EMAIL($tmp_wcr_data, $param_key, $tmp_name_array);

                        break;
                        case 'REPLYTO_EMAIL_PIPED':

                            $tmp_name_array = array();
                            $tmp_name_data = $oWCR->get_attribute($WCR_key, 'REPLYTO_NAME_PIPED');

                            if($tmp_name_data->preach('isset', $param_key)){

                                $tmp_name_array = explode('|', $tmp_name_data->preach('value', $param_key));

                            }

                            $this->receive_profile_EMAIL($tmp_wcr_data, $param_key, $tmp_name_array);

                        break;
                        case 'CC_EMAIL_PIPED':

                            $tmp_name_array = array();
                            $tmp_name_data = $oWCR->get_attribute($WCR_key, 'CC_NAME_PIPED');

                            if($tmp_name_data->preach('isset', $param_key)){

                                $tmp_name_array = explode('|', $tmp_name_data->preach('value', $param_key));

                            }

                            $this->receive_profile_EMAIL($tmp_wcr_data, $param_key, $tmp_name_array);

                        break;
                        case 'BCC_EMAIL_PIPED':

                            $tmp_name_array = array();
                            $tmp_name_data = $oWCR->get_attribute($WCR_key, 'BCC_NAME_PIPED');

                            if($tmp_name_data->preach('isset', $param_key)){

                                $tmp_name_array = explode('|', $tmp_name_data->preach('isset', $param_key));

                            }

                            $this->receive_profile_EMAIL($tmp_wcr_data, $param_key, $tmp_name_array);

                        break;
                        default:

                            //error_log(__LINE__ . ' env - profile_endpoint_data_ARRAY storing[' . $this->wcr_profiles_cnt . '][' . $param_key . '][' . get_class($tmp_wcr_data) . ']');
                            $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt][strtoupper($param_key)][] = $tmp_wcr_data;
                            $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt][strtoupper($param_key)][] = 1;

                        break;

                    }

                }

            }

        }

    }

    public function receive_profile_EMAIL($oDDO, $param_key, $name_array = NULL){

        $this->isValid = true;

        //
        // I AM EMAIL PROFILE. RECEIVE EMAIL DATA.
        #$oWCR->add_attribute('RECIPIENTS_EMAIL_PIPED', 'Jonathan J5 Harris c00000101@gmail.com|jharris@eVifweb.com');
        #$oWCR->add_attribute('RECIPIENTS_NAME_PIPED', '|Jonathan J5 Harris');
        //error_log(__LINE__ . ' - I AM EMAIL PROFILE. RECEIVE EMAIL DATA. ' . $oDDO);
        if(is_object($oDDO)){

            $tmp_email_name_ARRAY = $this->reformat_pipe_data(CRNRSTN_LOG_EMAIL, $oDDO->preach('value', $param_key));

        }else{

            $tmp_email_name_ARRAY = $this->reformat_pipe_data(CRNRSTN_LOG_EMAIL, $oDDO);

        }

        #$tmp_email_name_ARRAY['email'][]
        #$tmp_email_name_ARRAY['name'][]

        //return $tmp_email_name_ARRAY;
        $tmp_e_cnt = sizeof($tmp_email_name_ARRAY['email']);
        for($i = 0; $i < $tmp_e_cnt; $i++){

            switch($param_key){
                case 'RECIPIENTS_EMAIL_PIPED':

                    //error_log(__LINE__ . ' env - storing RECIPIENT_EMAIL [' . $this->wcr_profiles_cnt . '][' . $param_key . '][' . self::$oCRNRSTN_n->string_sanitize($tmp_email_name_ARRAY['email'][$i], 'email_private') . ']');
                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['RECIPIENT_EMAIL'][] = $tmp_email_name_ARRAY['email'][$i];
                    $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['RECIPIENT_EMAIL'][] = 1;

                    if(isset($name_array[$i])){

                        if($name_array[$i] != ''){

                            //error_log(__LINE__ . ' env - [' . $param_key.'] name[' . $i . ']' . $name_array[$i]);
                            $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['RECIPIENT_NAME'][] = $name_array[$i];
                            $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['RECIPIENT_NAME'][] = 1;

                        }else{

                            if(isset($tmp_email_name_ARRAY['name'][$i])){

                                if($tmp_email_name_ARRAY['name'][$i] !=''){

                                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['RECIPIENT_NAME'][] = $tmp_email_name_ARRAY['name'][$i];

                                }else{

                                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['RECIPIENT_NAME'][] = '';

                                }

                                $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['RECIPIENT_NAME'][] = 1;

                            }

                        }

                    }else{

                        if(isset($tmp_email_name_ARRAY['name'][$i])){

                            if($tmp_email_name_ARRAY['name'][$i] != ''){

                                $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['RECIPIENT_NAME'][] = $tmp_email_name_ARRAY['name'][$i];

                            }else{

                                $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['RECIPIENT_NAME'][] = '';

                            }

                            $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['RECIPIENT_NAME'][] = 1;

                        }

                    }

                break;
                case 'REPLYTO_EMAIL_PIPED':

                    //error_log(__LINE__ . ' env - storing REPLYTO_EMAIL_PIPED [' . $this->wcr_profiles_cnt . '][' . $param_key . '][' . self::$oCRNRSTN_n->string_sanitize($tmp_email_name_ARRAY['email'][$i], 'email_private') . ']');
                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['REPLYTO_EMAIL'][] = $tmp_email_name_ARRAY['email'][$i];
                    $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['REPLYTO_EMAIL'][] = 1;

                    if(isset($name_array)){

                        if(isset($name_array[$i])){

                            $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['REPLYTO_NAME'][] = $name_array[$i];
                            $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['REPLYTO_NAME'][] = 1;

                        }else{

                            if(isset($tmp_email_name_ARRAY['name'][$i])){

                                if($tmp_email_name_ARRAY['name'][$i] != ''){

                                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['REPLYTO_NAME'][] = $tmp_email_name_ARRAY['name'][$i];
                                    $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['REPLYTO_NAME'][] = 1;

                                }else{

                                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['REPLYTO_NAME'][] = '';
                                    $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['REPLYTO_NAME'][] = 1;

                                }

                            }

                        }

                    }

                break;
                case 'CC_EMAIL_PIPED':

                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['CC_EMAIL'][] = $tmp_email_name_ARRAY['email'][$i];
                    $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['CC_EMAIL'][] = 1;

                    if(isset($name_array)){

                        if(isset($name_array[$i])){

                            //error_log(__LINE__ . ' env - CC_EMAIL_PIPED name data[' . $i . '] saved=' . $name_array[$i]);
                            $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['CC_NAME'][] = $name_array[$i];
                            $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['CC_NAME'][] = 1;

                        }else{

                            if(isset($tmp_email_name_ARRAY['name'][$i])){

                                if($tmp_email_name_ARRAY['name'][$i] != ''){

                                    //error_log(__LINE__ . ' env - CC_EMAIL_PIPED WCR name data[' . $i . '] saved=' . $tmp_email_name_ARRAY['name'][$i]);
                                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['CC_NAME'][] = $tmp_email_name_ARRAY['name'][$i];

                                }else{

                                    //error_log(__LINE__ . ' env - CC_EMAIL_PIPED WCR name data[' . $i . '] saved=[\'\']');
                                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['CC_NAME'][] = '';

                                }

                                $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['CC_NAME'][] = 1;

                            }

                        }

                    }

                break;
                case 'BCC_EMAIL_PIPED':

                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['BCC_EMAIL'][] = $tmp_email_name_ARRAY['email'][$i];
                    $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['BCC_EMAIL'][] = 1;

                    if(isset($name_array)){

                        if(isset($name_array[$i])){

                            $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['BCC_NAME'][] = $name_array[$i];
                            $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['BCC_NAME'][] = 1;

                        }else{

                            if(isset($tmp_email_name_ARRAY['name'][$i])){

                                if($tmp_email_name_ARRAY['name'][$i] != ''){

                                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['BCC_NAME'][] = $tmp_email_name_ARRAY['name'][$i];

                                }else{

                                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['BCC_NAME'][] = '';

                                }

                                $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['BCC_NAME'][] = 1;

                            }

                        }

                    }

                break;

            }

        }

    }

    public function receive_profile_RESOURCE_OPENSOURCE_WCR($oWCR, $WCR_key){

        $this->isValid = true;

        //
        // I AM FTP PROFILE. RECEIVE FTP WCR DATA.
        //error_log('3343 - I AM FTP PROFILE. RECEIVE FTP WCR DATA. '.$WCR_key);
        $this->wcr_profiles_cnt++;

        //
        // *ALL* POSSIBLE FTP WCR KEYS
        foreach($this->profile_endpoint_criteria_ARRAY[CRNRSTN_RESOURCE_OPENSOURCE] as $param_key => $value){

            if($oWCR->isset_WCR($WCR_key, $param_key)){

                //
                // WCR DATA CAN BE DDO_OBJECT, INT, DOUBLE, STRING
                $tmp_wcr_data = $oWCR->get_attribute($WCR_key, $param_key);
                self::$oCRNRSTN_n->error_log('We have received CRNRSTN_RESOURCE_OPENSOURCE DATA ' . $param_key . '=[' . print_r($tmp_wcr_data, true) . '] from wcr=' . $WCR_key . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_RESOURCE_OPENSOURCE);

                //error_log(__LINE__ . ' ' . __METHOD__ . ' env STORING OBJECT [' . $param_key . ']=' . print_r($tmp_wcr_data, true));
                $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt][strtoupper($param_key)][] = $tmp_wcr_data;
                $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt][strtoupper($param_key)][] = 1;

            }

        }

    }

    public function receive_profile_EMAIL_PROXY_WCR($oWCR, $WCR_key){

        $this->isValid = true;

        //
        // I AM EMAIL_PROXY PROFILE. RECEIVE EMAIL_PROXY WCR DATA.
        //error_log(__LINE__ . ' env - I AM EMAIL_PROXY[WCR] PROFILE. RECEIVE EMAIL WCR DATA. ' . $WCR_key);
        $this->wcr_profiles_cnt++;

        //
        // *ALL* POSSIBLE EMAIL_PROXY WCR KEYS
        foreach($this->profile_endpoint_criteria_ARRAY[CRNRSTN_LOG_EMAIL_PROXY] as $param_key => $value){

            // $this->profile_endpoint_criteria_ARRAY[CRNRSTN_LOG_EMAIL_PROXY]['ISHTML'] = 1;
            if($oWCR->isset_WCR($WCR_key, $param_key)){

                $tmp_wcr_data = $oWCR->get_attribute($WCR_key, $param_key, true);

                switch($param_key){
                    case 'RECIPIENTS_NAME_PIPED':
                    case 'REPLYTO_NAME_PIPED':
                    case 'CC_NAME_PIPED':
                    case 'BCC_NAME_PIPED':
                    break;
                    case 'RECIPIENTS_EMAIL_PIPED':

                        $tmp_name_array = array();
                        $tmp_name_data = $oWCR->get_attribute($WCR_key, 'RECIPIENTS_NAME_PIPED');

                        if($tmp_name_data->preach('isset', $param_key)){

                            $tmp_name_array = explode('|', $tmp_name_data->preach('value', $param_key));

                        }

                        //$tmp_email_array = $this->receive_profile_EMAIL($tmp_wcr_data, $param_key);
                        $this->receive_profile_EMAIL($tmp_wcr_data, $param_key, $tmp_name_array);

                    break;
                    case 'REPLYTO_EMAIL_PIPED':

                        $tmp_name_array = array();
                        $tmp_name_data = $oWCR->get_attribute($WCR_key, 'REPLYTO_NAME_PIPED');

                        if($tmp_name_data->preach('isset', $param_key)){

                            $tmp_name_array = explode('|', $tmp_name_data->preach('value', $param_key));

                        }

                        //$tmp_email_array = $this->receive_profile_EMAIL($tmp_wcr_data, $param_key);
                        $this->receive_profile_EMAIL($tmp_wcr_data, $param_key, $tmp_name_array);

                    break;
                    case 'CC_EMAIL_PIPED':

                        $tmp_name_array = array();
                        $tmp_name_data = $oWCR->get_attribute($WCR_key, 'CC_NAME_PIPED');

                        if($tmp_name_data->preach('isset', $param_key)){

                            $tmp_name_array = explode('|', $tmp_name_data->preach('value', $param_key));

                        }

                        $this->receive_profile_EMAIL($tmp_wcr_data, $param_key, $tmp_name_array);

                    break;
                    case 'BCC_EMAIL_PIPED':

                        $tmp_name_array = array();$tmp_name_data = $oWCR->get_attribute($WCR_key, 'BCC_NAME_PIPED');

                        if($tmp_name_data->preach('isset', $param_key)){

                            $tmp_name_array = explode('|', $tmp_name_data->preach('value', $param_key));

                        }

                        $this->receive_profile_EMAIL($tmp_wcr_data, $param_key, $tmp_name_array);

                    break;
                    default:

                        //error_log(__LINE__ . ' env - [' . $this->wcr_profiles_cnt . '][' . strtoupper($param_key) . '][' . $tmp_wcr_data . ']');
                        $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt][strtoupper($param_key)][] = $tmp_wcr_data;
                        $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt][strtoupper($param_key)][] = 1;

                    break;

                }

            }

        }

    }

    public function receive_profile_FTP_WCR($oWCR, $WCR_key){

        $this->isValid = true;

        //
        // I AM FTP PROFILE. RECEIVE FTP WCR DATA.
        //error_log('3343 - I AM FTP PROFILE. RECEIVE FTP WCR DATA. '.$WCR_key);
        $this->wcr_profiles_cnt++;

        //
        // *ALL* POSSIBLE FTP WCR KEYS
        foreach($this->profile_endpoint_criteria_ARRAY[CRNRSTN_LOG_FILE_FTP] as $param_key => $value){

            if($oWCR->isset_WCR($WCR_key, $param_key)){

                //
                // WCR DATA CAN BE DDO_OBJECT, INT, DOUBLE, STRING
                $tmp_wcr_data = $oWCR->get_attribute($WCR_key, $param_key);

                //error_log(__LINE__ . ' ' . __METHOD__ . ' env STORING OBJECT [' . $param_key . ']=' . print_r($tmp_wcr_data, true));
                $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt][strtoupper($param_key)][] = $tmp_wcr_data;
                $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt][strtoupper($param_key)][] = 1;

            }

        }

    }

    public function receive_profile_FILE_WCR($oWCR, $WCR_key){

        $this->isValid = true;

        //
        // I AM FILE PROFILE. RECEIVE FILE WCR DATA.
        //error_log(__LINE__ . ' env - I AM FILE[WCR] PROFILE. RECEIVE FILE WCR DATA. ' . $WCR_key);
        $this->wcr_profiles_cnt++;

        //
        // *ALL* POSSIBLE FILE WCR KEYS
        foreach($this->profile_endpoint_criteria_ARRAY[CRNRSTN_LOG_FILE] as $param_key => $value){

            $tmp_wcr_data = $oWCR->get_attribute($WCR_key, $param_key);

            if(is_object($tmp_wcr_data)){

                //error_log(__LINE__ . ' env - Data from WCR[' . $WCR_key . '] @ [' . $param_key . ']=[' . $tmp_wcr_data . ']');
                $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt][strtoupper($param_key)][] = $tmp_wcr_data;
                $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt][strtoupper($param_key)][] = 1;

            }

        }

    }

    public function receive_profile_FILE($data){

        $this->isValid = true;

        //
        // I AM FILE PROFILE. RECEIVE FILE DATA.
        //error_log(__LINE__ . ' env - I AM FILE PROFILE. RECEIVE FILE DATA. ' . $data);
        $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['LOCAL_DIR_PATH'][] = $data;
        $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['LOCAL_DIR_PATH'][] = 1;

    }

    public function return_profile(){

        return $this->logging_profile;

    }

    private function active_by_default($logging_profile){

        switch($logging_profile){
            case CRNRSTN_LOG_DEFAULT:
            case CRNRSTN_LOG_SCREEN_TEXT:
            case CRNRSTN_LOG_SCREEN:
            case CRNRSTN_LOG_SCREEN_HTML:
            case CRNRSTN_LOG_SCREEN_HTML_HIDDEN:

                //$this->isValid = true;

            break;

        }

    }

    private function reformat_pipe_data($profile_key, $data){

        $tmp_array = array();

        switch($profile_key){
            case CRNRSTN_LOG_EMAIL:
            case CRNRSTN_LOG_EMAIL_PROXY:

                $tmp_pipe_to_array = explode('|', $data);

                if(count($tmp_pipe_to_array) < 2){

                    $tmp_pipe_to_array = explode(',', $data);

                }

                foreach ($tmp_pipe_to_array as $key => $email_data){

                    $email_data = trim($email_data);

                    //
                    // @ SYMBOL ?. IF NO...SKIP...MAYBE LOG.
                    $pos_at = strpos($email_data, '@');
                    if($pos_at!==false){

                        //error_log(__LINE__ . ' env - WE HAVE EMAIL IN ' . $email_data);

                        //
                        // WE HAVE EMAIL. CHECK FOR SPACES AS INDICATION OF PRESENCE OF NAME DATA
                        $pos_space = strpos($email_data, ' ');
                        if($pos_space === false){

                            //
                            // NO NAME DATA? CHECK FOR COMMA.
                            $pos_comma = strpos($email_data, ',');
                            if($pos_comma === false){

                                //
                                // YEP. JUST EMAIL.
                                $tmp_array['email'][] = $email_data;
                                $tmp_array['name'][] = '';

                            }else{

                                $tmp_name = '';

                                //
                                // EXPLODE ON COMMA AND PROCESS FOR SINGLE EMAIL AND NAME COMBO.
                                $tmp_comma_to_array = explode(',', $email_data);
                                foreach($tmp_comma_to_array as $commaKey => $comma_delim_data){

                                    $pos_at = strpos($comma_delim_data, '@');
                                    if($pos_at !== false){

                                        //
                                        // PROCESS EMAIL.
                                        $tmp_email = $comma_delim_data;

                                    }else{

                                        //
                                        // PROCESS NAME.
                                        if($comma_delim_data != ''){

                                            $tmp_name .= $comma_delim_data.' ';

                                        }

                                    }

                                }

                                $tmp_name = rtrim($tmp_name, ' ');

                                $tmp_array['email'][] = $tmp_email;
                                $tmp_array['name'][] = $tmp_name;

                            }

                        }else{

                            $tmp_name = '';
                            //error_log(__LINE__ . ' env - WE HAVE NAME DATA IN ' . $email_data);

                            //
                            // CHECK FOR NAME AND EMAIL DUE TO SPACE.
                            $tmp_space_to_array = explode(' ', $email_data);
                            foreach($tmp_space_to_array as $spaceKey => $space_delim_data){

                                $pos_at = strpos($space_delim_data, '@');
                                if($pos_at !== false){

                                    //
                                    // PROCESS EMAIL.
                                    $tmp_email = $space_delim_data;

                                }else{

                                    //
                                    // PROCESS NAME.
                                    if($space_delim_data != ''){

                                        $tmp_name .= $space_delim_data . ' ';
                                        //error_log(__LINE__ . ' env - BUILDING NAME=>' . $tmp_name);

                                    }

                                }

                            }

                            $tmp_name = rtrim($tmp_name, ' ');

                            $tmp_array['email'][] = $tmp_email;
                            $tmp_array['name'][] = $tmp_name;
                            //error_log(__LINE__ . ' env - ADDING NAME to tmp_array[\'name\']=>' . $tmp_name);

                        }

                    }else{

                        //
                        // NO EMAIL DATA IN THIS DATA!
                        if(is_object(self::$oCRNRSTN_n)){

                            self::$oCRNRSTN_n->error_log('The provided ' . $profile_key . ' data "' . $data . '" does not contain an email address, and it will be ignored.', __LINE__, __METHOD__, __FILE__,CRNRSTN_SETTINGS_CRNRSTN);

                        }

                    }

                }

            break;

        }

        //
        // $tmp_array['email'][]
        // $tmp_array['name'][]
        //error_log(__LINE__ . ' env - returning tmp_array[\'email\'] & [\'name\']');

        return $tmp_array;

    }

    public function load_CRNRSTN_ENV($oCRNRSTN_ENV){

        self::$oCRNRSTN_n = $oCRNRSTN_ENV;

    }

    private function load_log_output_mgr($oCRNRSTN_n){

        $this->oLog_output_manager = new crnrstn_log_output_manager($oCRNRSTN_n);

    }

    public function __destruct() {

    }

}

# # C # R # N # R # S # T # N # : : # # ##
#  CLASS :: crnrstn_soap_services_authorization_manager
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: Thursday November 12, 2020 @ 1645hrs
#  DESCRIPTION :: Manage CRNRSTN :: SOAP Services layer authorization keys.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
class crnrstn_soap_services_authorization_manager{

    protected $oLogger;
    private static $oCRNRSTN_ENV;

    public $serial;
    public $services_authorization_group_key;
    public $ISACTIVE = false;
    protected $resource_key;

    protected $ip_auth_denial_ARRAY = array();
    protected $ip_auth_ARRAY = array();

    protected $soap_services_auth_key_ARRAY = array();
    protected $soap_services_resource_denyaccess_ARRAY = array();
    protected $soap_services_resource_access_ARRAY = array();

    protected $encryptCipher;
    protected $encryptSecretKey;
    protected $encryptOptions;
    protected $hmac_alg;

    public function __construct($env_key, $SOAP_AuthKey, $oCRNRSTN_ENV){

        self::$oCRNRSTN_ENV = $oCRNRSTN_ENV;

        $this->oLogger = new crnrstn_logging(__CLASS__, self::$oCRNRSTN_ENV);

        $this->serial = self::$oCRNRSTN_ENV->generate_new_key(50);

        $tmp_resource_key = self::$oCRNRSTN_ENV->return_env_key_hash();

        if(self::$oCRNRSTN_ENV->hash($env_key) == $tmp_resource_key){

            $this->resource_key = $tmp_resource_key;
            $this->ISACTIVE = true;

            $this->soap_services_auth_key_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $SOAP_AuthKey;

            self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);

        }

    }

    public function return_soap_services_IP_access_ARRAY(){

        return $this->ip_auth_ARRAY;

    }

    public function return_soap_services_IP_denyaccess_ARRAY(){

        return $this->ip_auth_denial_ARRAY;

    }

    public function return_soap_services_auth_key_ARRAY(){

        return $this->soap_services_auth_key_ARRAY;

    }

    public function return_soap_services_resource_denyaccess_ARRAY(){

        return $this->soap_services_resource_denyaccess_ARRAY;

    }

    public function return_soap_services_resource_access_ARRAY(){

        return $this->soap_services_resource_access_ARRAY;

    }

    public function sync_IP_denyAccess($ip){

        $this->ip_auth_denial_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $ip;

        self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);

    }

    public function sync_IP_exclusiveAccess($ip){

        $this->ip_auth_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $ip;

        self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);

    }

    public function sync_update_permissions($integer_constant){

//        foreach($soap_services_resource_access_ARRAY as $key => $resource){
//
//            $this->soap_services_resource_access_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $resource;
//
//        }
//
//        foreach($soap_services_resource_denyaccess_ARRAY as $key => $resource){
//
//            $this->soap_services_resource_denyaccess_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $resource;
//
//        }

        $tmp_bit_state_nomination = 'CRNRSTN_SOAP_AUTH_MGR_' . $this->serial;
        $this->oCRNRSTN_USR->oCRNRSTN_BITFLIP_MGR->initialize_serialized_bit($tmp_bit_state_nomination, $integer_constant);

        self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);

    }

    public function sync_soap_encryption_config($encryptCipher, $encryptSecretKey, $hmac_alg, $encryptOptions){

        $this->encryptCipher = $encryptCipher;
        $this->encryptSecretKey = $encryptSecretKey;
        $this->hmac_alg = $hmac_alg;
        $this->encryptOptions = $encryptOptions;

    }

    //
    // SOAP SERVICE $authorized_resource_pipe
    public function update_permissions($integer_constant){

        if($this->ISACTIVE) {

            //$this->oCRNRSTN_BITWISE->set($integer_constant);
            //$this->oCRNRSTN_BITWISE->toggle($integer_constant);
            //$this->oCRNRSTN_BITWISE->read($integer_constant);
            //$this->oCRNRSTN_BITWISE->remove($integer_constant)
            //$this->oCRNRSTN_BITWISE->stringout()
            //$this->oCRNRSTN_BITFLIP_MGR->set($integer_constant, true);

            // REMOVE WHEN DONE
//          $this->soap_services_resource_denyaccess_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $tmp_clean_profile;
//          $this->soap_services_resource_access_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = trim($tmp_resource_access_profile_ARRAY[$i]);

//
//            $tmp_resource_access_profile_ARRAY = explode('|', $authorized_resource_pipe);
//            $tmp_cnt = sizeof($tmp_resource_access_profile_ARRAY);
//            $tmp_accept_array = array();
//            $tmp_deny_array = array();
//
//            for ($i = 0; $i < $tmp_cnt; $i++) {
//
//                //
//                // CHECK FOR NOT
//                $pos_silo_tilde = strpos($tmp_resource_access_profile_ARRAY[$i], '~');
//
//                if ($pos_silo_tilde !== false) {
//
//                    //
//                    // HONOR THE NEGATION
//                    // STRIP ~ AND TRIM
//                    $tmp_clean_silo_negation = self::$oCRNRSTN_ENV->proper_replace('~', '', $tmp_resource_access_profile_ARRAY[$i]);
//                    $tmp_clean_profile = trim($tmp_clean_silo_negation);
//
//                    error_log(__LINE__ . ' env - negation of resource ' . $tmp_clean_profile . ' added [' . self::$oCRNRSTN_ENV->config_serial_hash . '][' . $this->resource_key . '][' . $this->serial . '].');
//
//                } else {
//
//                    $this->soap_services_resource_access_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = trim($tmp_resource_access_profile_ARRAY[$i]);
//
//                }
//
//                if(isset($this->services_authorization_group_key)){
//
//                    if ($pos_silo_tilde !== false) {
//
//                        //
//                        // HONOR THE NEGATION
//                        // STRIP ~ AND TRIM
//                        $tmp_clean_silo_negation = self::$oCRNRSTN_ENV->proper_replace('~', '', $tmp_resource_access_profile_ARRAY[$i]);
//                        $tmp_clean_profile = trim($tmp_clean_silo_negation);
//                        $tmp_deny_array[] = $tmp_clean_profile;
//
//                        error_log(__LINE__ . ' env - negation of resource ' . $tmp_clean_profile . ' added [' . self::$oCRNRSTN_ENV->config_serial_hash . '][' . $this->resource_key . '][' . $this->serial . '].');
//
//                    } else {
//
//                        $tmp_accept_array[] = trim($tmp_resource_access_profile_ARRAY[$i]);
//
//                    }
//
//                }
//
//            }

            if(isset($this->services_authorization_group_key)){

                $tmp_bit_state_nomination = 'CRNRSTN_SOAP_AUTH_MGR_' . $this->serial;
                self::$oCRNRSTN_ENV->oCRNRSTN_BITFLIP_MGR->initialize_serialized_bit($tmp_bit_state_nomination, $integer_constant);

                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);
                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth_update_permissions($this->serial, $this->services_authorization_group_key, $integer_constant);

            }else{

                $tmp_bit_state_nomination = 'CRNRSTN_SOAP_AUTH_MGR_' . $this->serial;
                self::$oCRNRSTN_ENV->initialize_serialized_bit($tmp_bit_state_nomination, $integer_constant);

                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);

            }

        }

    }

    public function override_soap_encryption_config($encryptCipher, $encryptSecretKey, $hmac_alg, $encryptOptions){

        if($this->ISACTIVE){

            $this->encryptCipher = $encryptCipher;
            $this->encryptSecretKey = $encryptSecretKey;
            $this->hmac_alg = $hmac_alg;
            $this->encryptOptions = $encryptOptions;

            if(isset($this->services_authorization_group_key)){

                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);
                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth_soap_encryption_config($this->serial, $this->services_authorization_group_key, $this->encryptCipher, $this->encryptSecretKey, $this->hmac_alg, $this->encryptOptions);

            }else{

                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);

            }

        }

    }

    public function IP_exclusiveAccess($ip){

        if($this->ISACTIVE) {

            $this->ip_auth_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $ip;

            if(isset($this->services_authorization_group_key)){

                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);
                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth_IP_exclusiveAccess($this->serial, $this->services_authorization_group_key, $ip);

            }else{

                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);

            }

        }

    }

    public function IP_denyAccess($ip){

        if($this->ISACTIVE) {

            $this->ip_auth_denial_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $ip;

            if(isset($this->services_authorization_group_key)){

                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);
                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth_IP_denyAccess($this->serial, $this->services_authorization_group_key, $this->ip_auth_denial_ARRAY);

            }else{

                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);

            }

        }

    }

    public function init_services_authorization_group_key(){

        if($this->ISACTIVE) {

            $this->services_authorization_group_key = self::$oCRNRSTN_ENV->generate_new_key(50);

        }

    }

    public function sync_to_services_authorization_group_key($services_authorization_group_key){

        if($this->ISACTIVE) {

            $this->services_authorization_group_key = $services_authorization_group_key;

        }

    }

    public function __destruct() {

    }

}

# # C # R # N # R # S # T # N # : : # # ##
#  CLASS :: crnrstn_soap_services_client_manager
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: Thursday November 12, 2020 @ 1646hrs
#  DESCRIPTION :: Manage CRNRSTN :: SOAP Services layer client authentication.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
class crnrstn_soap_services_client_manager{

    protected $oLogger;
    private static $oCRNRSTN_ENV;
    public $ISACTIVE = false;

    protected $resource_key;

    public $serial;
    public $services_client_group_key;
    public $CRNRSTN_NUSOAP_SVC_debugMode = 0;
    protected $soap_services_username_ARRAY = array();
    protected $soap_services_password_ARRAY = array();
    protected $soap_services_method_deactivate_ARRAY = array();
    protected $soap_services_method_activate_ARRAY = array();

    protected $ip_auth_ARRAY = array();
    protected $ip_auth_denial_ARRAY = array();

    protected $soap_services_resource_denyaccess_ARRAY = array();
    protected $soap_services_resource_access_ARRAY = array();

    protected $encryptCipher;
    protected $encryptSecretKey;
    protected $hmac_alg;
    protected $encryptOptions;

    public function __construct($env_key, $username, $password, $CRNRSTN_NUSOAP_SVC_debugMode, $oCRNRSTN_ENV){

        self::$oCRNRSTN_ENV = $oCRNRSTN_ENV;

        $this->oLogger = new crnrstn_logging(__CLASS__, self::$oCRNRSTN_ENV);

        if(is_null($username)){


        }else{

            $this->CRNRSTN_NUSOAP_SVC_debugMode = $CRNRSTN_NUSOAP_SVC_debugMode;

            $this->serial = self::$oCRNRSTN_ENV->generate_new_key(50);

            if(self::$oCRNRSTN_ENV->hash($env_key) == self::$oCRNRSTN_ENV->return_env_key_hash()){

                $this->resource_key = self::$oCRNRSTN_ENV->return_env_key_hash();
                $this->ISACTIVE = true;

                $this->soap_services_username_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $username;
                $this->soap_services_password_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $this->oCRNRSTN->hash($password, 'md5');

                self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);

            }

        }

    }

    public function return_soap_services_soap_encryption_config(){

        $tmp_array = array();

        //error_log(__LINE__ . ' env - this->encryptCipher = ' . $this->encryptCipher);
        $tmp_array['encryptCipher'] = $this->encryptCipher;
        $tmp_array['encryptSecretKey'] = $this->encryptSecretKey;
        $tmp_array['hmac_alg'] = $this->hmac_alg;
        $tmp_array['encryptOptions'] = $this->encryptOptions;

        return $tmp_array;

    }

    public function return_soap_services_method_activate_ARRAY(){

        return $this->soap_services_method_activate_ARRAY;

    }

    public function return_soap_services_method_deactivate_ARRAY(){

        return $this->soap_services_method_deactivate_ARRAY;

    }

    public function return_soap_services_username_ARRAY(){

        return $this->soap_services_username_ARRAY;

    }

    public function return_soap_services_password_ARRAY(){

        return $this->soap_services_password_ARRAY;

    }

    public function return_soap_services_resource_denyaccess_ARRAY(){

        return $this->soap_services_resource_denyaccess_ARRAY;

    }

    public function return_soap_services_resource_access_ARRAY(){

        return $this->soap_services_resource_access_ARRAY;

    }

    public function return_soap_services_IP_access_ARRAY(){

        return $this->ip_auth_ARRAY;

    }

    public function return_soap_services_IP_denyaccess_ARRAY(){

        return $this->ip_auth_denial_ARRAY;

    }

    public function return_username(){

        return $this->soap_services_username_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][0];

    }

    public function return_password(){

        return $this->soap_services_password_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][0];

    }

    public function sync_update_permissions($integer_constant){

//        foreach($soap_services_resource_access_ARRAY as $key => $resource){
//
//            $this->soap_services_resource_access_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $resource;
//
//        }
//
//        foreach($soap_services_resource_denyaccess_ARRAY as $key => $resource){
//
//            $this->soap_services_resource_denyaccess_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $resource;
//
//        }

        $tmp_bit_state_nomination = 'CRNRSTN_SOAP_CLIENT_MGR_' . $this->serial;
        self::$oCRNRSTN_ENV->oCRNRSTN_BITFLIP_MGR->initialize_serialized_bit($tmp_bit_state_nomination, $integer_constant);

        self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);

    }

    public function sync_soap_encryption_config($encryptCipher, $encryptSecretKey, $hmac_alg, $encryptOptions){

        $this->encryptCipher = $encryptCipher;
        $this->encryptSecretKey = $encryptSecretKey;
        $this->hmac_alg = $hmac_alg;
        $this->encryptOptions = $encryptOptions;

        self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);

    }

    public function sync_activate_SOAP_method($soap_services_method_activate_ARRAY, $soap_services_method_deactivate_ARRAY){

        foreach($soap_services_method_deactivate_ARRAY as $key => $method){

            $this->soap_services_method_deactivate_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $method;

        }

        foreach($soap_services_method_activate_ARRAY as $key => $method){

            $this->soap_services_method_activate_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $method;

        }

        self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);

    }

    public function sync_deactivate_SOAP_method($soap_services_method_deactivate_ARRAY){

        foreach($soap_services_method_deactivate_ARRAY as $key => $method){

            $this->soap_services_method_deactivate_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $method;

        }

        self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);

    }

    public function sync_IP_denyAccess($ip){

        $this->ip_auth_denial_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $ip;

        self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);

    }

    public function sync_IP_exclusiveAccess($ip){

        $this->ip_auth_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $ip;

        self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);

    }

    //
    // CLIENT
    public function update_permissions($integer_constant){

        if($this->ISACTIVE) {

//
//
//            $tmp_resource_access_profile_ARRAY = explode('|', $authorized_resource_pipe);
//            $tmp_cnt = sizeof($tmp_resource_access_profile_ARRAY);
//            $tmp_grant_array = array();
//            $tmp_deny_array = array();
//
//            for ($i = 0; $i < $tmp_cnt; $i++) {
//
//                //
//                // CHECK FOR NOT
//                $pos_silo_tilde = strpos($tmp_resource_access_profile_ARRAY[$i], '~');
//
//                if ($pos_silo_tilde !== false) {
//
//                    //
//                    // HONOR THE NEGATION
//                    // STRIP ~ AND TRIM
//                    $tmp_clean_silo_negation = self::$oCRNRSTN_ENV->proper_replace('~', '', $tmp_resource_access_profile_ARRAY[$i]);
//                    $tmp_clean_profile = trim($tmp_clean_silo_negation);
//                    $this->soap_services_resource_denyaccess_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $tmp_clean_profile;
//
//                } else {
//
//                    $this->soap_services_resource_access_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $tmp_resource_access_profile_ARRAY[$i];
//
//                }
//
//                if(isset($this->services_client_group_key)){
//
//                    if ($pos_silo_tilde !== false) {
//
//                        //
//                        // HONOR THE NEGATION
//                        // STRIP ~ AND TRIM
//                        $tmp_clean_silo_negation = self::$oCRNRSTN_ENV->proper_replace('~', '', $tmp_resource_access_profile_ARRAY[$i]);
//                        $tmp_clean_profile = trim($tmp_clean_silo_negation);
//                        $tmp_deny_array[] = $tmp_clean_profile;
//
//                    } else {
//
//                        $tmp_grant_array[] = trim($tmp_resource_access_profile_ARRAY[$i]);
//
//                    }
//
//                }
//
//            }

            if(isset($this->services_client_group_key)){

                $tmp_bit_state_nomination = 'CRNRSTN_SOAP_CLIENT_MGR_' . $this->serial;
                self::$oCRNRSTN_ENV->oCRNRSTN_BITFLIP_MGR->initialize_serialized_bit($tmp_bit_state_nomination, $integer_constant);

                self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);
                self::$oCRNRSTN_ENV->update_SOAP_services_oClient_update_permissions($this->serial, $this->services_client_group_key, $integer_constant);

            }else{

                $tmp_bit_state_nomination = 'CRNRSTN_SOAP_CLIENT_MGR_' . $this->serial;
                self::$oCRNRSTN_ENV->initialize_serialized_bit($tmp_bit_state_nomination, $integer_constant);

                self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);

            }

        }

    }

    public function override_soap_encryption_config($encryptCipher, $encryptSecretKey, $hmac_alg, $encryptOptions){

        if($this->ISACTIVE){

            $this->encryptCipher = $encryptCipher;
            $this->encryptSecretKey = $encryptSecretKey;
            $this->hmac_alg = $hmac_alg;
            $this->encryptOptions = $encryptOptions;

            if(isset($this->services_client_group_key)){

                //error_log(__LINE__ . ' env oClient GROUP override_soap_encryption_config [' . $encryptCipher . '][' . $encryptSecretKey . '][' . $hmac_alg . '][' . $encryptOptions . ']');
                self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);
                self::$oCRNRSTN_ENV->update_SOAP_services_oClient_soap_encryption_config($this->serial, $this->services_client_group_key, $this->encryptCipher, $this->encryptSecretKey, $this->hmac_alg, $this->encryptOptions);

            }else{

                //error_log(__LINE__ . ' env oClient SINGLE override_soap_encryption_config [' . $encryptCipher . '][' . $encryptSecretKey . '][' . $hmac_alg . '][' . $encryptOptions . ']');
                self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);

            }

        }

    }

    public function activate_SOAP_method($method){

        if($this->ISACTIVE){

            $tmp_method_access_profile_ARRAY = explode('|', $method);
            $tmp_cnt = sizeof($tmp_method_access_profile_ARRAY);
            $tmp_group_activate_ARRAY = array();
            $tmp_group_deactivate_ARRAY = array();

            for ($i = 0; $i < $tmp_cnt; $i++) {

                $pos_tilde = strpos($tmp_method_access_profile_ARRAY[$i],'~');
                if($pos_tilde !== false){

                    $tmp_clean_method_negation = self::$oCRNRSTN_ENV->proper_replace('~', '', $tmp_method_access_profile_ARRAY[$i]);
                    $tmp_clean_method_negation = trim($tmp_clean_method_negation);
                    $this->soap_services_method_deactivate_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $tmp_clean_method_negation;

                }else{

                    $this->soap_services_method_activate_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $tmp_method_access_profile_ARRAY[$i];

                }

                if(isset($this->services_client_group_key)){
                    if($pos_tilde !== false){

                        $tmp_clean_method_negation = self::$oCRNRSTN_ENV->proper_replace('~', '', $tmp_method_access_profile_ARRAY[$i]);
                        $tmp_clean_method_negation = trim($tmp_clean_method_negation);
                        $tmp_group_deactivate_ARRAY[] = $tmp_clean_method_negation;

                    }else{

                        $tmp_group_activate_ARRAY[] = $tmp_method_access_profile_ARRAY[$i];

                    }

                }

            }

            if(isset($this->services_client_group_key)){

                self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);
                self::$oCRNRSTN_ENV->update_SOAP_services_oClient_activate_SOAP_method($this->serial, $this->services_client_group_key, $tmp_group_activate_ARRAY, $tmp_group_deactivate_ARRAY);

            }else{

                self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);

            }

        }

    }

    public function deactivate_SOAP_method($method){

        if($this->ISACTIVE){

            $tmp_method_access_profile_ARRAY = explode('|', $method);
            $tmp_cnt = sizeof($tmp_method_access_profile_ARRAY);
            $tmp_deny_array = array();

            for ($i = 0; $i < $tmp_cnt; $i++) {

                $pos_tilde = strpos($tmp_method_access_profile_ARRAY[$i],'~');
                if($pos_tilde !== false){

                    $tmp_clean_method_negation = self::$oCRNRSTN_ENV->proper_replace('~', '', $tmp_method_access_profile_ARRAY[$i]);
                    $tmp_clean_method_negation = trim($tmp_clean_method_negation);
                    $this->soap_services_method_deactivate_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $tmp_clean_method_negation;

                }else{

                    $this->soap_services_method_deactivate_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $tmp_method_access_profile_ARRAY[$i];

                }

                if(isset($this->services_authorization_group_key)){

                    if($pos_tilde !== false){

                        $tmp_clean_method_negation = self::$oCRNRSTN_ENV->proper_replace('~', '', $tmp_method_access_profile_ARRAY[$i]);
                        $tmp_clean_method_negation = trim($tmp_clean_method_negation);
                        $tmp_deny_array[] = $tmp_clean_method_negation;

                    }else{

                        $tmp_deny_array[] = $tmp_method_access_profile_ARRAY[$i];

                    }

                }

            }

            if(isset($this->services_client_group_key)){

                self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);
                self::$oCRNRSTN_ENV->update_SOAP_services_oClient_deactivate_SOAP_method($this->serial, $this->services_client_group_key, $tmp_deny_array);

            }else{

                self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);

            }

        }

    }

    public function IP_exclusiveAccess($ip){

        if($this->ISACTIVE){

            $this->ip_auth_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $ip;

            if(isset($this->services_client_group_key)){

                self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);
                self::$oCRNRSTN_ENV->update_SOAP_services_oClient_IP_exclusiveAccess($this->serial, $this->services_client_group_key, $ip);

            }else{

                self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);

            }

        }

    }

    public function IP_denyAccess($ip){

        if($this->ISACTIVE){

            $this->ip_auth_denial_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $ip;

            if(isset($this->services_client_group_key)){

                self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);
                self::$oCRNRSTN_ENV->update_SOAP_services_oClient_IP_denyAccess($this->serial, $this->services_client_group_key, $ip);

            }else{

                self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);

            }

        }
        
    }

    public function init_services_client_group(){

        if($this->ISACTIVE) {

            $this->services_client_group_key = self::$oCRNRSTN_ENV->generate_new_key(50);

        }

    }

    public function sync_to_services_client_group($services_client_group_key){

        if($this->ISACTIVE) {

            $this->services_client_group_key = $services_client_group_key;

        }

    }

    public function __destruct() {

    }

}

# # C # R # N # R # S # T # N # : : # # ##
#  CLASS :: crnrstn_soap_services_access_manager
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: Friday November 13, 2020 @ 1352hrs
#  DESCRIPTION :: Manage SOAP handshake and alignment to and with CRNRSTN :: SOAP Services layer and determine
#  authorization for access unto the same.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
class crnrstn_soap_services_access_manager{

    protected $oLogger;
    private static $oCRNRSTN_ENV;

    protected $encryptCipher;
    protected $encryptSecretKey;
    protected $encryptOptions;
    protected $hmac_alg;
    public $CRNRSTN_NUSOAP_SVC_debugMode;
    public $ISACTIVE = false;

    protected $SOAP_oAuth_ARRAY = array();
    protected $SOAP_oClient_ARRAY = array();

    public $serial;

    public function __construct($env_key, $CRNRSTN_NUSOAP_SVC_debugMode, $oCRNRSTN_ENV){

        if($oCRNRSTN_ENV->hash($env_key) == $oCRNRSTN_ENV->return_env_key_hash()){

            self::$oCRNRSTN_ENV = $oCRNRSTN_ENV;

            $this->oLogger = new crnrstn_logging(__CLASS__, self::$oCRNRSTN_ENV);

            $this->serial = self::$oCRNRSTN_ENV->generate_new_key(50);

            error_log(__LINE__ . ' ' . $env_key . ' crnrstn_soap_services_access_manager (env) construct() is active for ' . $this->serial . '.');
            $this->ISACTIVE = true;

            $this->CRNRSTN_NUSOAP_SVC_debugMode = $CRNRSTN_NUSOAP_SVC_debugMode;

            self::$oCRNRSTN_ENV->update_SOAP_services_access_manager($this);

            $this->resource_key = '';

        }else{

            //error_log(__LINE__ . ' ' . __METHOD__ . ' $env_key is not match ...so construct end...' . $env_key);

        }

    }

    public function isAuthorized_oAuth($CRNRSTN_SOAP_SVC_AUTH_KEY, $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES){

        //
        // SUPPORT FOR OPEN PROXY
        $tmp_is_authorized = true;

        error_log(__LINE__ . ' env - checking oAuth [' . $CRNRSTN_SOAP_SVC_AUTH_KEY . '][' . $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES . ']');
        foreach($this->SOAP_oAuth_ARRAY as $serial => $SOAP_oAuth){

            $wildcard_honor = false;

            if(!isset($mandatory_match_fulfilled_flag)){

                $mandatory_match_fulfilled_flag = false;

            }

            if($SOAP_oAuth->ISACTIVE){

                //
                // NOT JUST IS VALID CHECK.
                // AGGREGATE ALL AUTH CHECKS HERE (LIST THEM), AND THEN, TRACE ALL DATA DEPENDENCIES...BRING THEM HERE.
                $tmp_return_soap_services_auth_key_ARRAY = $SOAP_oAuth->return_soap_services_auth_key_ARRAY();

                //self::$oCRNRSTN_ENV->print_r('AUTH KEY=' . print_r($tmp_return_soap_services_auth_key_ARRAY, true), 'CRNRSTN :: v' . $oCRNRSTN_USR->version_crnrstn() . ' SOAP AUTH :: ', __LINE__, __METHOD__, __FILE__);

                //$tmp_bit_state_nomination = 'CRNRSTN_SOAP_AUTH_MGR_' . $this->serial;
                //self::$oCRNRSTN_ENV->initialize_serialized_bit($tmp_bit_state_nomination, $integer_constant);

                //$tmp_return_soap_services_resource_denyaccess_ARRAY = $SOAP_oAuth->return_soap_services_resource_denyaccess_ARRAY();
                //$tmp_return_soap_services_resource_access_ARRAY = $SOAP_oAuth->return_soap_services_resource_access_ARRAY();

                //error_log(__LINE__ . ' SERVER env die() - [' . $serial . '] ::' . print_r($tmp_return_soap_services_auth_key_ARRAY, true));

                //$tmp_requested_resources_ARRAY = explode('|', $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES);

                if((in_array(CRNRSTN_RESOURCE_ALL, $tmp_return_soap_services_auth_key_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oAuth->serial])) || (in_array(CRNRSTN_RESOURCE_ALL, $tmp_return_soap_services_auth_key_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oAuth->serial]))){

                    //
                    // WILDCARD AUTH KEY PROVIDED. ANY AUTH KEY (INCLUDING NULL) IS ACCEPTABLE.
                    $wildcard_honor = true;

                }

                if(isset($tmp_return_soap_services_auth_key_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oAuth->serial])){

                    foreach ($tmp_return_soap_services_auth_key_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oAuth->serial] as $key0 => $auth_key) {

                        //error_log(__LINE__ . ' env - [' . $auth_key . ']==[' . $CRNRSTN_SOAP_SVC_AUTH_KEY . ']');
                        if($auth_key == $CRNRSTN_SOAP_SVC_AUTH_KEY || $wildcard_honor){
                            //
                            // WE HAVE CRNRSTN :: SOAP SERVICES LAYER oAuth OBJECT TO VERIFY THIS REQUEST AGAINST
                            //error_log(__LINE__ . ' SERVER env - soap_services_auth_key [' . $SOAP_oAuth->serial . '] VALIDATION GOING IN FOR ' . $auth_key);
                            $mandatory_match_fulfilled_flag = true;
//
//                            //
//                            // DENY ACCESS
//                            if(isset($tmp_return_soap_services_resource_denyaccess_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oAuth->serial])){
//
//                                //error_log(__LINE__ . ' SERVER env - we have tmp_return_soap_services_resource_denyaccess_ARRAY data[' . sizeof($tmp_return_soap_services_resource_denyaccess_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oAuth->serial]) . '].');
//                                foreach($tmp_return_soap_services_resource_denyaccess_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()] as $key1 => $SOAP_resource){
//
//                                    //error_log(__LINE__ . ' SERVER env - looking to honor denial of ' . $SOAP_resource . ', if requested.');
//
//                                    //
//                                    // IS THE CLIENT ASKING FOR RESOURCES WHICH ARE DENIED TO THIS AUTHORIZATION KEY?
//                                    if(in_array($SOAP_resource, $tmp_requested_resources_ARRAY)){
//
//                                        error_log(__LINE__ . ' SERVER env - ACCESS DENIED ON ACCOUNT OF THE ' . $SOAP_resource . ' CRNRSTN :: SOAP SERVICES RESOURCE THAT IS REQUESTED...NOTE THAT ' . $SOAP_resource . ' HAS ALSO BEEN CONFIGURED AT THIS PROXY PROFILE TO BE DENIED TO THIS AUTH KEY.');
//                                        $tmp_is_authorized = false;
//
//                                    }
//
//                                }
//
//                            }

                            //if($tmp_is_authorized){

                            $tmp_SOAP_resource = true;

                            //$tmp_bit_state_nomination = 'CRNRSTN_SOAP_AUTH_MGR_' . $this->serial;
                            //self::$oCRNRSTN_ENV->initialize_serialized_bit($tmp_bit_state_nomination, $integer_constant);

                            //error_log(__LINE__ . ' ' . __METHOD__ . ' ' . self::$oCRNRSTN_ENV->print_r_str('hello 0101010010101!', 'BIT DRIVEN CLIENT AUTH :: isAuthorized_oAuth()', NULL, __LINE__, __METHOD__, __FILE__));
                            //die();

                            //
                            // CHECK FOR FLIPPED BITS
                            $tmp_bit_state_nomination = 'CRNRSTN_SOAP_AUTH_MGR_' . $SOAP_oAuth->serial;
                            $tmp_soap_auth_resource_ARRAY = self::$oCRNRSTN_ENV->return_set_serialized_bits($tmp_bit_state_nomination, self::$oCRNRSTN_ENV->system_resource_constants);

//                          error_log(__LINE__ . ' env '. print_r($tmp_soap_auth_resource_ARRAY, true));
//                          die();

                            if(isset($tmp_return_soap_services_resource_access_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oAuth->serial])){

                                // $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES is the new $tmp_requested_resources_ARRAY.
                                // HOW MANY CONSTANTS YOU HOLDING??
                                $tmp_requested_resources_ARRAY = $tmp_return_soap_services_resource_access_ARRAY = array();
                                foreach($tmp_requested_resources_ARRAY as $key2 => $resource_req){

                                    error_log(__LINE__ . ' env - $resource_req=' . $resource_req);
                                    $tmp_SOAP_resource = false;

                                    foreach($tmp_return_soap_services_resource_access_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oAuth->serial] as $key1 => $SOAP_resource){
                                        error_log(__LINE__ . ' env - $SOAP_resource=' . print_r($SOAP_resource, true));

                                        if($SOAP_resource == $resource_req){

                                            error_log(__LINE__ . ' SERVER env - soap_services_auth_key GRANT RESOURCE ACCESS = TRUE for ' . $SOAP_resource);
                                            $tmp_SOAP_resource = true;

                                        }

                                    }

                                    //
                                    // ALL REQUESTED RESOURCES MUST BE LISTED AS AUTHORIZED FOR THIS AUTHORIZATION KEY.
                                    if(!$tmp_SOAP_resource){

                                        error_log(__LINE__ .' SERVER env - ACCESS DENIED ON ACCOUNT OF RESOURCE REQUESTED NOT BEING FOUND WITHIN THE PROXY PROFILE CONFIGURATION FOR THIS AUTH KEY.');
                                        $tmp_is_authorized = false;

                                    }

                                }

                            }

                            //}

                        }

                    }

                }

                if($tmp_is_authorized){

                    $tmp_return_soap_services_IP_denyaccess_ARRAY = $SOAP_oAuth->return_soap_services_IP_denyaccess_ARRAY();

                    //
                    // CHECK IP ACCESS - DENY
                    if(isset($tmp_return_soap_services_IP_denyaccess_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oAuth->serial])){

                        foreach($tmp_return_soap_services_IP_denyaccess_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oAuth->serial] as $key1 => $ip){

                            error_log(__LINE__ . ' SERVER env - checking denyIPAccess() on ' . $ip);
                            if(self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->denyIPAccess($ip)){

                                error_log(__LINE__ . ' SERVER env - BY IP...YOU ARE TO BE DENIED...' . self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->clientIpAddress());
                                $tmp_is_authorized = false;

                            }

                        }

                    }

                }

                if($tmp_is_authorized){

                    $tmp_return_soap_services_IP_access_ARRAY = $SOAP_oAuth->return_soap_services_IP_access_ARRAY();

                    //
                    // CHECK IP ACCESS - EXCLUSIVE ACCESS
                    if(isset($tmp_return_soap_services_IP_access_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oAuth->serial])){

                        foreach($tmp_return_soap_services_IP_access_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oAuth->serial] as $key => $ip){

                            //if(is_array($ip)){

                            //    self::$oCRNRSTN_ENV->print_r($ip, '', NULL, __LINE__, __METHOD__, __FILE__);
                            //    error_log(__LINE__ . ' SERVER env - die()::[' . $key . '] ' . print_r($ip, true));
                            //    die();

                            //}

                            //error_log(__LINE__ . ' SERVER env checking exclusiveAccess() on ' . $ip);
                            if(self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->exclusiveAccess($ip)){

                                //error_log(__LINE__ . ' SERVER env - BY IP...YOU ARE TO BE GRANTED ACCESS...' . self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->clientIpAddress());

                            }else{

                                error_log(__LINE__ . ' SERVER env - BY IP...YOU ARE TO BE DENIED...' . self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->clientIpAddress());
                                $tmp_is_authorized = false;

                            }

                        }

                    }

                }

            }

        }

        if($tmp_is_authorized && isset($mandatory_match_fulfilled_flag)){

            if(!$mandatory_match_fulfilled_flag){

                error_log(__LINE__ . ' SERVER env - THIS IS NOT AN OPEN PROXY. ACCESS DENIED ON ACCOUNT OF AT LEAST ONE AUTH KEY BEING CONFIGURED AT PROXY, BUT NO SUBSEQUENT MANDATORY MATCH WAS FULFILLED BY THE CLIENT.');
                $tmp_is_authorized = false;

            }

        }

        error_log(__LINE__ . ' SERVER env - returning oAuth validation result of [' . $tmp_is_authorized . '].');
        return $tmp_is_authorized;

    }

    public function isAuthorized_oClient($USERNAME, $PASSWORD, $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES, $CRNRSTN_SOAP_SVC_METHOD_REQUESTED, $CRNRSTN_SOAP_ACTION_TYPE){

        //
        // SUPPORT FOR OPEN PROXY
        $tmp_is_authorized = true;

        error_log(__LINE__ . ' SERVER env - checking oClient [' . $USERNAME . '][' . $PASSWORD . '][' . $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES . '][' . $CRNRSTN_SOAP_SVC_METHOD_REQUESTED . '][' . $CRNRSTN_SOAP_ACTION_TYPE . ']');

        //
        // CONVERT STRING BACK INTO BITWISE
        self::$oCRNRSTN_ENV->serialized_bit_stringin('CRNRSTN_CLIENT_SOAP_PERMS_REQUESTED', $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES);

        if(self::$oCRNRSTN_ENV->serialized_is_bit_set('CRNRSTN_CLIENT_SOAP_PERMS_REQUESTED', CRNRSTN_RESOURCE_OPENSOURCE)){

            error_log(__LINE__ . ' SERVER env - serialized_bit_stringin SET CRNRSTN_RESOURCE_OPENSOURCE=TRUE');


        }else{

            error_log(__LINE__ . ' SERVER env - serialized_bit_stringin DID NOT SET CRNRSTN_RESOURCE_OPENSOURCE');

        }

        foreach($this->SOAP_oClient_ARRAY as $serial => $SOAP_oClient){

            if(!isset($mandatory_match_fulfilled_flag)){

                $mandatory_match_fulfilled_flag = false;

            }

            if($SOAP_oClient->ISACTIVE){

                //
                // NOT JUST IS VALID CHECK.
                // AGGREGATE ALL AUTH CHECKS HERE (LIST THEM), AND THEN, TRACE ALL DATA DEPENDENCIES...BRING THEM HERE.
                $tmp_return_soap_services_username_ARRAY = $SOAP_oClient->return_soap_services_username_ARRAY();
                $tmp_return_soap_services_password_ARRAY = $SOAP_oClient->return_soap_services_password_ARRAY();
                $tmp_return_soap_services_resource_denyaccess_ARRAY = $SOAP_oClient->return_soap_services_resource_denyaccess_ARRAY();
                $tmp_return_soap_services_resource_access_ARRAY = $SOAP_oClient->return_soap_services_resource_access_ARRAY();
                $tmp_return_soap_services_method_activate_ARRAY = $SOAP_oClient->return_soap_services_method_activate_ARRAY();
                $tmp_return_soap_services_method_deactivate_ARRAY = $SOAP_oClient->return_soap_services_method_deactivate_ARRAY();

                $tmp_requested_resources_ARRAY = explode('|', $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES);

                if(isset($tmp_return_soap_services_username_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial])){

                    foreach ($tmp_return_soap_services_username_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial] as $key0 => $username) {

                        self::$oCRNRSTN_ENV->print_r('[' . $username . '][' . $USERNAME . ']', 'SERVER (env) :: isAuthorized_oClient', NULL, __LINE__, __METHOD__, __FILE__);
                        if($username == $USERNAME){

                            if(self::$oCRNRSTN_ENV->validate_pwd_hash_login($tmp_return_soap_services_password_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial][$key0], $PASSWORD)){

                                error_log(__LINE__ . ' SERVER env - CRNRSTN :: SOAP SERVICES CLIENT LOGIN VALID. [' . $USERNAME . '][' . $PASSWORD . '][' . $tmp_return_soap_services_password_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial][$key0] . ']');

                            }else{

                                error_log(__LINE__ . ' SERVER env - CRNRSTN :: SOAP SERVICES CLIENT LOGIN INVALID. [' . $USERNAME . '][' . $PASSWORD . '][' . $tmp_return_soap_services_password_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial][$key0] . ']');

                            }

                            //
                            // WE HAVE CRNRSTN :: SOAP SERVICES LAYER oAuth OBJECT TO VERIFY THIS REQUEST AGAINST
                            error_log(__LINE__ . ' SERVER env - isAuthorized_oClient [' . $SOAP_oClient->serial . '] VALIDATION GOING IN FOR ' . $username);
                            $mandatory_match_fulfilled_flag = true;

                            //
                            // DENY ACCESS
                            if(isset($tmp_return_soap_services_resource_denyaccess_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial])){

                                error_log(__LINE__ . ' SERVER env - we have tmp_return_soap_services_resource_denyaccess_ARRAY data[' . sizeof($tmp_return_soap_services_resource_denyaccess_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial]) . '].');
                                foreach($tmp_return_soap_services_resource_denyaccess_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()] as $key1 => $SOAP_resource){

                                    error_log(__LINE__ . ' SERVER env - looking to honor denial of ' . $SOAP_resource . ', if requested.');

                                    //
                                    // IS THE CLIENT ASKING FOR RESOURCES WHICH ARE DENIED TO THIS AUTHORIZATION KEY?
                                    if(in_array($SOAP_resource, $tmp_requested_resources_ARRAY)){

                                        error_log(__LINE__ . ' SERVER env - ACCESS DENIED ON ACCOUNT OF THE ' . $SOAP_resource . ' CRNRSTN :: SOAP SERVICES RESOURCE THAT IS REQUESTED...NOTE THAT ' . $SOAP_resource . ' HAS ALSO BEEN CONFIGURED AT THIS PROXY PROFILE TO BE DENIED TO THIS CLIENT.');
                                        $tmp_is_authorized = false;

                                    }

                                }

                            }

                            if($tmp_is_authorized){

                                $tmp_SOAP_resource = true;

                                if(isset($tmp_return_soap_services_resource_access_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial])){

                                    foreach($tmp_requested_resources_ARRAY as $key2 => $resource_req){

                                        error_log(__LINE__ . ' env make false[' . $resource_req . ']');
                                        $tmp_SOAP_resource = false;

                                        foreach($tmp_return_soap_services_resource_access_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial] as $key1 => $SOAP_resource){

                                            error_log(__LINE__ . ' env make true if[' . $resource_req . ']==[' . $SOAP_resource . ']');

                                            if($SOAP_resource == $resource_req){

                                                error_log(__LINE__ . ' env - soap_services_auth_key GRANT RESOURCE ACCESS = TRUE for ' . $SOAP_resource);
                                                $tmp_SOAP_resource = true;

                                            }

                                        }

                                        //
                                        // ALL REQUESTED RESOURCES MUST BE LISTED AS AUTHORIZED FOR THIS AUTHORIZATION KEY.
                                        if(!$tmp_SOAP_resource){

                                            error_log(__LINE__ . ' SERVER env - ACCESS DENIED ON ACCOUNT OF RESOURCE REQUESTED NOT BEING FOUND WITHIN THE PROXY PROFILE CONFIGURATION FOR THIS CLIENT.');
                                            $tmp_is_authorized = false;

                                        }

                                    }

                                }else{

                                    error_log(__LINE__ . ' SERVER env - NEW ARRAY STRUCT...NOT SEEING.');

                                }

                            }

                            //
                            // CRNRSTN :: SOAP SERVICES LAYER METHOD AUTHORIZATION
                            if($tmp_is_authorized){

                                $tmp_SOAP_resource = true;

                                if(isset($tmp_return_soap_services_method_activate_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial])){

                                    if(sizeof($tmp_return_soap_services_method_activate_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial]) > 0){

                                        $tmp_req_methods_ARRAY = explode('|', $CRNRSTN_SOAP_SVC_METHOD_REQUESTED);

                                        foreach($tmp_req_methods_ARRAY as $key2 => $method_req){
                                            error_log(__LINE__ . ' env make false [' . $method_req . ']');

                                            $tmp_SOAP_resource = false;

                                            foreach($tmp_return_soap_services_method_activate_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial] as $key1 => $SOAP_resource){
                                                error_log(__LINE__ . ' env make true if[' . $method_req . ']==[' . $SOAP_resource . ']');

                                                if($SOAP_resource == $method_req){

                                                    //error_log(__LINE__ . ' env - soap_services_auth_key GRANT RESOURCE ACCESS = TRUE for ' . $SOAP_resource);
                                                    $tmp_SOAP_resource = true;

                                                }

                                            }

                                            //
                                            // ALL REQUESTED RESOURCES MUST BE LISTED AS AUTHORIZED FOR THIS AUTHORIZATION KEY.
                                            if(!$tmp_SOAP_resource){

                                                error_log(__LINE__ . ' SERVER env - ACCESS DENIED ON ACCOUNT OF A REQUESTED METHOD NOT BEING FOUND WITHIN THE PROXY PROFILE CONFIGURATION FOR THIS CLIENT.');
                                                $tmp_is_authorized = false;

                                            }

                                        }

                                    }

                                }else{

                                    error_log(__LINE__ . ' SERVER env - NEW ARRAY STRUCT...NOT SEEING.');

                                }

                            }

                            //
                            // CRNRSTN :: SOAP SERVICES LAYER METHOD AUTHORIZATION
                            if($tmp_is_authorized){

                                $tmp_SOAP_resource = true;

                                if(isset($tmp_return_soap_services_method_deactivate_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial])){

                                    if(sizeof($tmp_return_soap_services_method_deactivate_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial]) > 0){

                                        $tmp_req_methods_ARRAY = explode('|', $CRNRSTN_SOAP_SVC_METHOD_REQUESTED);

                                        foreach($tmp_req_methods_ARRAY as $key2 => $method_req){

                                            $tmp_SOAP_resource = false;

                                            foreach($tmp_return_soap_services_method_deactivate_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial] as $key1 => $SOAP_resource){

                                                if($SOAP_resource == $method_req){

                                                    $tmp_SOAP_resource = true;

                                                }

                                            }

                                            //
                                            // ALL REQUESTED RESOURCES MUST BE LISTED AS AUTHORIZED FOR THIS AUTHORIZATION KEY.
                                            if(!$tmp_SOAP_resource){

                                                error_log(__LINE__ . ' SERVER env - ACCESS DENIED ON ACCOUNT OF A REQUESTED METHOD NOT BEING FOUND WITHIN THE PROXY PROFILE CONFIGURATION FOR THIS CLIENT.');
                                                $tmp_is_authorized = false;

                                            }

                                        }

                                    }

                                }else{

                                    error_log(__LINE__ . ' SERVER env - NEW ARRAY STRUCT...NOT SEEING.');

                                }

                            }

                        }

                    }

                }

                if($tmp_is_authorized){

                    $tmp_return_soap_services_IP_denyaccess_ARRAY = $SOAP_oClient->return_soap_services_IP_denyaccess_ARRAY();

                    //
                    // CHECK IP ACCESS - DENY
                    if(isset($tmp_return_soap_services_IP_denyaccess_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial])){

                        foreach($tmp_return_soap_services_IP_denyaccess_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial] as $key => $ip){

                            error_log(__LINE__ . ' SERVER env checking denyIPAccess() on ' . $ip);
                            if(self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->denyIPAccess($ip)){

                                error_log(__LINE__ . ' SERVER env - BY IP...YOU ARE TO BE DENIED...' . self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->clientIpAddress());
                                $tmp_is_authorized = false;

                            }

                        }

                    }

                }

                if($tmp_is_authorized){

                    $tmp_return_soap_services_IP_access_ARRAY = $SOAP_oClient->return_soap_services_IP_access_ARRAY();

                    //
                    // CHECK IP ACCESS - EXCLUSIVE ACCESS
                    if(isset($tmp_return_soap_services_IP_access_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial])){

                        foreach($tmp_return_soap_services_IP_access_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial] as $key => $ip){

                            //error_log(__LINE__ . ' SERVER env checking exclusiveAccess() on ' . $ip);
                            if(self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->exclusiveAccess($ip)){

                                //error_log(__LINE__ . ' SERVER env - BY IP...YOU ARE TO BE GRANTED ACCESS...' . self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->clientIpAddress());

                            }else{

                                error_log(__LINE__ . ' SERVER env - BY IP...YOU ARE TO BE DENIED...' . self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->clientIpAddress());
                                $tmp_is_authorized = false;

                            }

                        }

                    }

                }

            }else{

                //error_log(__LINE__ . ' SERVER env - $SOAP_oClient is NOT ACTIVE.');

            }

        }

        if($tmp_is_authorized && isset($mandatory_match_fulfilled_flag)){

            if(!$mandatory_match_fulfilled_flag){

                error_log(__LINE__ . ' SERVER env - THIS IS NOT AN OPEN PROXY. ACCESS DENIED ON ACCOUNT OF AT LEAST ONE AUTH KEY BEING CONFIGURED AT PROXY, BUT NO SUBSEQUENT MANDATORY MATCH WAS FULFILLED BY THE CLIENT.');
                $tmp_is_authorized = false;

            }

        }

        return $tmp_is_authorized;

    }

    public function return_soap_encryption_config_param($param_key){

        switch($param_key){
            case 'SOAP_ENCRYPT_CIPHER':

                return $this->encryptCipher;

            break;
            case 'SOAP_ENCRYPT_SECRET_KEY':

                return $this->encryptSecretKey;

            break;
            case 'SOAP_ENCRYPT_HMAC_ALG':

                return $this->hmac_alg;

            break;
            case 'SOAP_ENCRYPT_OPTIONS':

                return $this->encryptOptions;

            break;
            default:

                return false;

            break;

        }

    }

    public function init_soap_encryption_config($env_key, $encryptCipher, $encryptSecretKey, $hmac_alg, $encryptOptions){

        $encryptSecretKey = $this->oCRNRSTN->hash($encryptSecretKey, 'md5');

        if($this->ISACTIVE){

            //error_log(__LINE__ . ' env $env_key [' . $env_key . '] ACTIVE.');

            $this->encryptCipher = $encryptCipher;
            $this->encryptSecretKey = $encryptSecretKey;
            $this->hmac_alg = $hmac_alg;
            $this->encryptOptions = $encryptOptions;

            self::$oCRNRSTN_ENV->update_SOAP_services_access_manager($this);

        }else{

            //error_log(__LINE__ . ' env $env_key [' . $env_key . '] NOT ACTIVE.');

        }

    }

    public function generate_SOAPAuthKey($env_key, $SOAP_AuthKey = CRNRSTN_RESOURCE_ALL){

        if($this->ISACTIVE){

            $SOAP_oAuth = new crnrstn_soap_services_authorization_manager($env_key, $SOAP_AuthKey, self::$oCRNRSTN_ENV);

            $this->SOAP_oAuth_ARRAY[$SOAP_oAuth->serial] = $SOAP_oAuth;

            self::$oCRNRSTN_ENV->update_SOAP_services_access_manager($this);

            return $SOAP_oAuth;

        }else{

            $SOAP_oAuth_NULL = new crnrstn_soap_services_authorization_manager('AUTH::NULL', $SOAP_AuthKey, self::$oCRNRSTN_ENV);

            return $SOAP_oAuth_NULL;

        }

    }

    public function generate_SOAPAuthKeyInGroup($env_key, $SOAP_AuthKey = CRNRSTN_RESOURCE_ALL, $SOAP_oAuth = NULL){

        if($this->ISACTIVE){

            if(isset($SOAP_oAuth)){

                $tmp_SOAP_oAuth = new crnrstn_soap_services_authorization_manager($env_key, $SOAP_AuthKey, self::$oCRNRSTN_ENV);

                $tmp_SOAP_oAuth->sync_to_services_authorization_group_key($SOAP_oAuth->services_authorization_group_key);

                $this->SOAP_oAuth_ARRAY[$tmp_SOAP_oAuth->serial] = $tmp_SOAP_oAuth;
                //error_log(__LINE__ . ' SERVER env - gkey[' . $SOAP_oAuth->services_authorization_group_key . '][' . $tmp_SOAP_oAuth->serial . '] $SOAP_AuthKey=' . $SOAP_AuthKey);

                self::$oCRNRSTN_ENV->update_SOAP_services_access_manager($this);

                return $tmp_SOAP_oAuth;

            }else{

                $SOAP_oAuth = new crnrstn_soap_services_authorization_manager($env_key, $SOAP_AuthKey, self::$oCRNRSTN_ENV);

                $SOAP_oAuth->init_services_authorization_group_key();

                $this->SOAP_oAuth_ARRAY[$SOAP_oAuth->serial] = $SOAP_oAuth;
                //error_log(__LINE__ . ' SERVER env - origin gkey[' . $SOAP_oAuth->services_authorization_group_key . '][' . $SOAP_oAuth->serial . '] $SOAP_AuthKey=' . $SOAP_AuthKey);

                self::$oCRNRSTN_ENV->update_SOAP_services_access_manager($this);

                return $SOAP_oAuth;

            }

        }

    }

    public function addClient($env_key, $username, $password, $CRNRSTN_NUSOAP_SVC_debugMode = 0){

        if($this->ISACTIVE) {
            
            $SOAP_oClient = new crnrstn_soap_services_client_manager($env_key, $username, $password, $CRNRSTN_NUSOAP_SVC_debugMode, self::$oCRNRSTN_ENV);

            $this->SOAP_oClient_ARRAY[$SOAP_oClient->serial] = $SOAP_oClient;

            self::$oCRNRSTN_ENV->update_SOAP_services_access_manager($this);

            return $SOAP_oClient;

        }else{

            $SOAP_oClient_NULL = new crnrstn_soap_services_client_manager('AUTH::NULL', $username, $password, $CRNRSTN_NUSOAP_SVC_debugMode, self::$oCRNRSTN_ENV);

            return $SOAP_oClient_NULL;

        }

    }

    public function addClientToGroup($env_key, $username, $password, $SOAP_oClient = NULL, $CRNRSTN_NUSOAP_SVC_debugMode = false){

        if($this->ISACTIVE){

            if(isset($SOAP_oClient)){

                $tmp_SOAP_oClient = new crnrstn_soap_services_client_manager($env_key, $username, $password, $CRNRSTN_NUSOAP_SVC_debugMode, self::$oCRNRSTN_ENV);

                $tmp_SOAP_oClient->sync_to_services_client_group($SOAP_oClient->services_client_group_key);

                $this->SOAP_oClient_ARRAY[$tmp_SOAP_oClient->serial] = $tmp_SOAP_oClient;

                self::$oCRNRSTN_ENV->update_SOAP_services_access_manager($this);

                return $tmp_SOAP_oClient;

            }else{

                $SOAP_oClient = new crnrstn_soap_services_client_manager($env_key, $username, $password, $CRNRSTN_NUSOAP_SVC_debugMode, self::$oCRNRSTN_ENV);

                $SOAP_oClient->init_services_client_group();

                $this->SOAP_oClient_ARRAY[$SOAP_oClient->serial] = $SOAP_oClient;

                self::$oCRNRSTN_ENV->update_SOAP_services_access_manager($this);

                return $SOAP_oClient;

            }

        }
        
    }

    public function __destruct() {

    }

}