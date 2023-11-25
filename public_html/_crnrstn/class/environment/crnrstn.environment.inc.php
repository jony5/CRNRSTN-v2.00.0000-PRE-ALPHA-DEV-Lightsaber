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
# # C # R # N # R # S # T # N # : : # # # #
#
#  CLASS :: crnrstn_environment
#  VERSION :: 2.00.0000
#  DATE :: September 11, 2012 @ 1720hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: Used to be the first one to know who you are,...thx for
#                 this,...crnrstn. 8/20/2022 @ 0410 hrs
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

    public $env_key;
    public $env_key_hash;
    protected $system_hash_algo;
    public $total_bytes_encrypted = 0;

    public $oCRNRSTN;
    public $oCRNRSTN_USR;
    protected $oCRNRSTN_DEV_INPUT_CONTROLLER;
    public $oCOOKIE_MGR;
    private static $oHTTP_MGR;
    private static $oFINITE_EXPRESS;
    public $oCRNRSTN_ASSET_MGR;

    private static $sess_env_param_ARRAY = array();
    private static $m_starttime = array();
    public $encryptableDataTypes = array();
    private static $hmac_algorithm_profile_ARRAY = array();
    private static $openssl_cipher_profile_ARRAY = array();
    private static $openssl_digest_profile_ARRAY = array();
    private static $system_resource_constants_ARRAY = array();
    public $system_theme_style_constants_ARRAY = array();
    private static $system_creative_element_keys_ARRAY = array();
    private static $weighted_elements_keys_ARRAY = array();
    public $soap_permissions_file_path_ARRAY = array();
    public $response_header_attribute_ARRAY = array();

    private static $requestProtocol;

    public $log_silo_profile;
    public $starttime;
    //public $oCRNRSTN_oWCR_ARRAY = array();
    //public $wildCardResource_filePath = array();
    public $ini_set_ARRAY = array();
    protected $is_soap_data_tunnel_endpoint = false;
    public $destruct_output;
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

    public function __construct($oCRNRSTN, $instanceType = NULL, $WORDPRESS_debug_mode = NULL){

        $this->oCRNRSTN = $oCRNRSTN;

        //
        // THIS IS A ROBUST ENV DETECTION AND SCRIPT TERMINATION TRIGGER METHOD THAT
        // ALSO RETURNS THE ENVIRONMENT KEY. WE ONLY NEED TO CALL THIS ONCE...AND
        // HOPEFULLY UNTO SUCCESS.
        $this->env_key = $this->oCRNRSTN->return_env_key();
        $this->env_key_hash = $this->oCRNRSTN->return_env_key(true);

        $this->system_hash_algo = $this->oCRNRSTN->system_hash_algo();

        $this->starttime = $this->oCRNRSTN->starttime;
        $this->operating_system = $this->oCRNRSTN->operating_system;
        $this->process_id = $this->oCRNRSTN->process_id;

        //
        // INITIALIZE ENCRYPTION PROFILE.
        $this->init_encrypt_profile($this->oCRNRSTN);

        self::$system_resource_constants_ARRAY = $this->oCRNRSTN->system_resource_constants_ARRAY();
        $this->system_theme_style_constants_ARRAY = $this->oCRNRSTN->system_theme_style_constants_ARRAY;

        self::$system_creative_element_keys_ARRAY = $this->oCRNRSTN->system_creative_element_keys_ARRAY;
        self::$weighted_elements_keys_ARRAY = $this->oCRNRSTN->weighted_elements_keys_ARRAY;

        self::$lang_content_ARRAY = $this->oCRNRSTN->return_lang_content_ARRAY();

        $this->ini_set_ARRAY = $this->oCRNRSTN->ini_set_ARRAY;
        $this->response_header_attribute_ARRAY = $this->oCRNRSTN->response_header_attribute_ARRAY;

        //
        // ROLL OVER SOAP PERMISSIONS.
        $this->soap_permissions_file_path_ARRAY = $this->oCRNRSTN->soap_permissions_file_path_ARRAY;

        //
        // ROLL OVER DEBUG/ERROR_LOG TRACE FROM CRNRSTN OBJECT AND THEN CONTINUE TO APPEND.
        self::$m_starttime = $this->oCRNRSTN->return_m_start_time();

        $this->log_silo_profile = $this->oCRNRSTN->log_silo_profile;

        self::$oLog_ProfileManager = $this->oCRNRSTN->return_oLog_ProfileManager();
        self::$oLog_ProfileManager->sync_to_environment($this->oCRNRSTN, $this);

        $this->config_serial_hash = $this->oCRNRSTN->get_server_config_serial('hash');
        self::$config_serial = $this->oCRNRSTN->get_server_config_serial('raw');
        $this->oCRNRSTN_ASSET_MGR = $this->oCRNRSTN->oCRNRSTN_ASSET_MGR;

        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN);

        //
        // TODO :: OBJECT INSTANTIATION REFACTORING TO SUPPORT PERSISTENCE OF STATE
        // COOKIE MANAGER SHOULD INSTANTIATE LOOKING FOR COOKIE::SSDTLA INTEGRATIONS FROM BROWSER...
        // SESSION MANAGER SHOULD INSTANTIATE LOOKING FOR...FROM SESSION....ETC. Thursday, August 18, 2022 @ 0247 hrs
        $this->oCOOKIE_MGR = new crnrstn_cookie_manager($this->oCRNRSTN);

        self::$oHTTP_MGR = new crnrstn_http_manager($this->oCRNRSTN, $this);

        self::$oFINITE_EXPRESS = new crnrstn_finite_expression();

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

                    $this->oCRNRSTN->system_terminate('config_detection_error_help');

                    //error_log(__LINE__ . ' env ' . __METHOD__ . ' going out on 503.');
                    //$this->return_server_response_code(503, $this->return_CRNRSTN_ASCII_ART());
                    exit();

                }else{

                    // TODO :: DO NOT RUN THIS AGAIN. FIGURE SOMETHING ELSE OUT.
                    // FLASH WILD CARD RESOURCES OBJECT ARRAY TO ENVIRONMENTAL CLASS OBJECT
                    //$this->initializeWildCardResource($this->oCRNRSTN);

                    //
                    // WE HAVE SELECTED ENVIRONMENT KEY. INITIALIZE. CONFIG KEY AND ENV KEY.
                    // FLASH CONFIG KEY AND ENV KEY TO SESSION.
                    $this->initRuntimeConfig();

                    //
                    // INITIALIZE ERROR REPORTING FOR THIS ENVIRONMENT.
                    $this->initializeErrorReporting($this->oCRNRSTN);

                    //
                    // INITIALIZE ENVIRONMENTAL LOGGING BEHAVIOR.
                    $this->initEnvLoggingProfile($this->oCRNRSTN);

                    //
                    // INITIALIZE IP ADDRESS RESTRICTIONS from grantExclusiveAccess()
                    if(isset($this->oCRNRSTN->grant_accessIP_ARRAY[$this->config_serial_hash][$this->env_key_hash])){

                        $this->initExclusiveAccess($this->oCRNRSTN);

                    }

                    //
                    // INITIALIZE IP ADDRESS RESTRICTIONS from denyAccess()
                    if(isset($this->oCRNRSTN->deny_accessIP_ARRAY[$this->config_serial_hash][$this->env_key_hash])){

                        $this->initDenyAccess($this->oCRNRSTN);

                    }

                    //
                    // INITIALIZE ADMINISTRATOR ACCESS.
                    if(isset($this->oCRNRSTN->add_admin_creds_ARRAY[$this->config_serial_hash][$this->env_key_hash])){

                        $this->initAdminAccess($this->oCRNRSTN);

                    }

                    //
                    // BEFORE ALLOCATING ADDITIONAL MEMORY RESOURCES, PROCESS IP AUTHENTICATION
                    if(isset($this->oCRNRSTN->grant_accessIP_ARRAY[$this->config_serial_hash][$this->env_key_hash]) || isset($this->oCRNRSTN->deny_accessIP_ARRAY[$this->config_serial_hash][$this->env_key_hash])){
                        //error_log(__LINE__ . ' env env_key=[' . $this->env_key . ']. die();');

                        $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('We have IP restrictions to process and apply for CRNRSTN :: config_serial_hash [' . $this->config_serial_hash . '] and environment key [' . $this->env_key_hash . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
                        //error_log(__LINE__ . ' env env_key=[' . $this->env_key . ']. die();');

                        if(!($this->oCRNRSTN->authorize_ip_access()) == true){
                        //if(!($this->oCRNRSTN->oCRNRSTN_IPSECURITY_MGR->authorizeEnvAccess($this, $this->env_key_hash) == true)){
                            error_log(__LINE__ . ' env authorizeEnvAccess() DENIED ON env_key=[' . $this->env_key . ']. die();');

                            die();
                            //
                            // WE COULD PERHAPS USE A MORE GRACEFUL WAY TO TRANSITION TO ERR...BUT THIS WORKS
                            // THE METHOD return_server_response_code() CONTAINS SOME CUSTOM HTML FOR OUTPUT IF YOU WANT TO TWEAK ITS DESIGN
                            // PERHAPS SOME FUTURE RELEASE OF CRNRSTN CAN--
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
                    //$this->init_wp_config($this->oCRNRSTN);

                    // TODO :: THIS IS CHANGING
                    // INITIALIZE ANALYTICS CONFIGURATION PROFILE(S) FOR THIS ENVIRONMENT
                    //$this->init_analytics_config($this->oCRNRSTN);

                    // TODO :: THIS IS CHANGING
                    // INITIALIZE ENGAGEMENT TRACKING CONFIGURATION PROFILE(S) FOR THIS ENVIRONMENT
                    //$this->init_engagement_config($this->oCRNRSTN);

                    //
                    // INSTANTIATE USER CLASS OBJECT
                    $this->oCRNRSTN_USR = $this->return_ENV_oCRNRSTN_USR($WORDPRESS_debug_mode);

                    //
                    // INITIALIZE INTERACT UI PROFILE
                    $this->init_ui_interact_profile();

                    //$this->oCRNRSTN->system_output_footer_html(CRNRSTN_SOAP_DATA_TUNNEL, true);

                    /*
                    DATA HANDLING ARCHITECTURES
                    -----
                    G :: HTTP $_GET REQUEST.
                    P :: HTTP $_POST REQUEST.
                    H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).
                    S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).
                    J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                    C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR BROWSER COOKIE...
                    D :: DATABASE (MySQLi CONNECTION).
                    R :: RUNTIME.
                    O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                    F :: SERVER LOCAL FILE SYSTEM.

                    GPHSJCDROF

                    */

//                    //
//                    // INITIALIZE CRNRSTN :: SOAP SERVICES DATA TUNNEL LAYER PACKET - DSJPC
//                    // NOTE: DATABASE DATA STORAGE FORMAT WILL SHADOW/SUPPORT USE OF (S) AND (P)
//                    // ON A SESSION TO SESSION BASIS.
//                    $this->init_ssdtla_session_data_packet();

                }

            }catch(Exception $e){

                //
                // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
                $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

                return false;

            }

        }else{

            //
            // THIS IS A SIMPLE CONFIG CHECK.
            $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log(__METHOD__ . ' performing simple config check prior to loading of define_env_resource() in the CRNRSTN :: config file . ', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        }

    }

    public function config_load_static_application_data($data_type){

        switch($data_type){
            case 'get_channel_system_parameters_ARRAY':

                return self::$oHTTP_MGR->config_load_static_application_data($data_type);

            break;
            case 'timezone_syntax_ARRAY':

                return self::$oFINITE_EXPRESS->config_load_static_application_data($data_type);

            break;
            default:

                error_log(__LINE__ . ' env Unknown SWITCH CASE received. ['. strval($data_type) . '].');

            break;

        }

    }

    public function set_openssl_digest_profile($openssl_digest_profile = NULL, $data_key = 'openssl_digest', $data_type_family = 'CRNRSTN::RESOURCE'){

        if(!isset($openssl_digest_profile)){

            self::$openssl_digest_profile_ARRAY[$data_type_family][$data_key] = $this->oCRNRSTN->get_resource('openssl_digest', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

        }else{

            self::$openssl_digest_profile_ARRAY[$data_type_family][$data_key] = $openssl_digest_profile;

        }

    }

    public function set_openssl_cipher_profile($openssl_cipher_profile = NULL, $data_key = 'openssl_cipher', $data_type_family = 'CRNRSTN::RESOURCE'){

        if(!isset($openssl_cipher_profile)){

            self::$openssl_cipher_profile_ARRAY[$data_type_family][$data_key] = $this->oCRNRSTN->get_resource('openssl_cipher', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

        }else{

            self::$openssl_cipher_profile_ARRAY[$data_type_family][$data_key] = $openssl_cipher_profile;

        }

    }

    public function set_hmac_algorithm_profile($hmac_algorithm_profile = NULL, $data_key = 'hmac_hash_algorithm', $data_type_family = 'CRNRSTN::RESOURCE'){

        if(!isset($hmac_algorithm_profile)){

            self::$hmac_algorithm_profile_ARRAY[$data_type_family][$data_key] = $this->oCRNRSTN->get_resource('hmac_hash_algorithm', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

        }else{

            self::$hmac_algorithm_profile_ARRAY[$data_type_family][$data_key] = $hmac_algorithm_profile;

        }

    }

    public function isset_openssl_digest_profile($data_key, $data_type_family){

        if(isset(self::$openssl_digest_profile_ARRAY[$data_type_family][$data_key])){

            return true;

        }

        return false;

    }

    public function isset_openssl_cipher_profile($data_key, $data_type_family){

        if(isset(self::$openssl_cipher_profile_ARRAY[$data_type_family][$data_key])){

            return true;

        }

        return false;

    }

    public function isset_hmac_algorithm_profile($data_key, $data_type_family){

        if(isset(self::$hmac_algorithm_profile_ARRAY[$data_type_family][$data_key])){

            return true;

        }

        return false;

    }

    public function get_openssl_digest_profile($data_key, $data_type_family, $graceful_degrade = false){

        if(isset(self::$openssl_digest_profile_ARRAY[$data_type_family][$data_key])){

            return self::$openssl_digest_profile_ARRAY[$data_type_family][$data_key];

        }

        if($graceful_degrade == true){

            return $this->oCRNRSTN->get_resource('openssl_digest', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

        }

        return NULL;

    }

    public function get_openssl_cipher_profile($data_key, $data_type_family, $graceful_degrade = false){

        if(isset(self::$openssl_cipher_profile_ARRAY[$data_type_family][$data_key])){

            return self::$openssl_cipher_profile_ARRAY[$data_type_family][$data_key];

        }

        if($graceful_degrade == true){

            return $this->oCRNRSTN->get_resource('openssl_cipher', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

        }

        return NULL;

    }

    public function get_hmac_algorithm_profile($data_key, $data_type_family, $graceful_degrade = false){

        if(isset(self::$hmac_algorithm_profile_ARRAY[$data_type_family][$data_key])){

            return self::$hmac_algorithm_profile_ARRAY[$data_type_family][$data_key];

        }

        if($graceful_degrade == true){

            return $this->oCRNRSTN->get_resource('hmac_hash_algorithm', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

        }

        return NULL;

    }

    //
    // SOURCE :: https://aloneonahill.com/blog/if-php-were-british/
    // AUTHOR :: https://aloneonahill.com/blog/about-dave/
    public function hello_world($type, $is_bastard = true){

        try{

            if($is_bastard == true){

                $str = 'Hello World.'; // bastard dialect

            }else{

                $str = 'Good morrow, fellow subjects of the Crown.';

            }

            error_log(__LINE__ . ' ' . get_class() . ' exception! ' . $str);
            throw new Exception('CRNRSTN :: v' . $this->version_crnrstn() . ' :: ' . $str . ' This is an exception handling test from ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ').');

            if($this->oCRNRSTN->is_bit_set(CRNRSTN_SCREEN_TEXT) == true){

                $str .= '<br><br>' . $this->oCRNRSTN->bit_stringout();

            }

            if(file_exists('/proc/' . $this->process_id)){

                //$this->print_r(self::$process_id_perf_stat_ARRAY[0], "PID Testing :: [".$this->operating_system."][running]PID ".$this->process_id, CRNRSTN_HTML, __LINE__, __METHOD__, __FILE__);

            }else{

                //$this->print_r(self::$process_id_perf_stat_ARRAY[0], "PID Testing :: [dead]PID ".$this->process_id, CRNRSTN_HTML, __LINE__, __METHOD__, __FILE__);

            }

            return $str;

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
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

    public function system_resource_constants_ARRAY(){

        return $this->oCRNRSTN->system_resource_constants_ARRAY();

    }

    public function initialize_http_get_params(){

        $this->oHTTP_MGR->initialize_http_get_params();

    }

    private function init_encrypt_profile($oCRNRSTN){

        //
        // INITIALIZE ARRAY OF ENCRYPTABLE DATATYPES
        $this->encryptableDataTypes = $oCRNRSTN->return_encryptable_data_types();

    }

    public function consume_form_integration_packet(){

        return $this->oHTTP_MGR->consume_form_integration_packet();

    }

    public function client_request_listen($listener_profile){

        switch($listener_profile){
            case CRNRSTN_ASSET_MAPPING:

                //
                // END OF CRNRSTN :: ENVIRONMENTAL CONFIG OPERATION
                $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('You have reached the end of the CRNRSTN :: environmental detection and configuration process.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
                $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('CRNRSTN :: is now listening for requests.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                error_log(__LINE__ . ' env calling oHTTP_MGR->client_request_listen(' . $listener_profile . ').');
                return $this->oHTTP_MGR->client_request_listen($listener_profile);

            break;
            case 'RRS_MAP':

                return $this->oHTTP_MGR->client_request_listen($listener_profile);

            break;
            case 'SSDTLA':
            case 'PSSDTLA':
            default:

                //
                // END OF CRNRSTN :: ENVIRONMENTAL CONFIG OPERATION
                $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('You have reached the end of the CRNRSTN :: environmental detection and configuration process.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
                $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('CRNRSTN :: is now listening for requests.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                //error_log(__LINE__ . ' env calling oHTTP_MGR->client_request_listen.');
                return $this->oHTTP_MGR->client_request_listen($listener_profile);

            break;

        }

        return '';

    }

    public function isset_crnrstn_services_http(){

        return $this->oHTTP_MGR->isset_crnrstn_services_http();

    }

//    public function sync_device_detected(){
//
//        return $this->oHTTP_MGR->sync_device_detected();
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

    public function ui_content_module_out($integer_constant, $output_format = 'HTML'){

        switch($integer_constant){
            case CRNRSTN_UI_INTERACT:

                $tmp_array = $this->return_output_CRNRSTN_UI_MESSENGER();
                $tmp_output = '';

                //
                // LOAD OUTPUT
                foreach($tmp_array as $key => $resource_content){

                    $tmp_output .= $resource_content;

                }

                return $tmp_output;

            break;
            case CRNRSTN_SOAP_DATA_TUNNEL:

                $tmp_array = $this->return_output_CRNRSTN_SOAP_DATA_TUNNEL();
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
            case CRNRSTN_CLIENT_SSDTLA_DEBUG:

                $tmp_array = $this->return_output_CRNRSTN_CLIENT_SSDTLA_DEBUG();
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
            case CRNRSTN_RESOURCE_FOOTER:

                $tmp_array = $this->return_output_CRNRSTN_UI_SYSTEM_FOOTER();
                $tmp_output = '';

                //
                // LOAD OUTPUT
                foreach($tmp_array as $key => $resource_content){

                    $tmp_output .= $resource_content;

                }

                return $tmp_output;

            break;
            case CRNRSTN_RESOURCE_DEEP_LINK:

                $tmp_array = $this->return_output_CRNRSTN_RESOURCE_DEEP_LINK();
                $tmp_output = '';

                //
                // LOAD OUTPUT
                foreach($tmp_array as $key => $resource_content){

                    $tmp_output .= $resource_content;

                }

                return $tmp_output;

            break;
            case CRNRSTN_RESPONSE_REPORT:

                //error_log(__LINE__ . ' env return_output_CRNRSTN_UI_SYSTEM_REPORT_RESPONSE_RETURN ['. $output_format . '].');
                //
                // CHANGED TO $is_HTML = true FOR TESTING BEFORE UPDATES.   // Thursday, November 23, 2023 @ 1236 hrs.
                $tmp_array = $this->return_output_CRNRSTN_UI_SYSTEM_REPORT_RESPONSE_RETURN(true);
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

    private function return_output_CRNRSTN_SOAP_DATA_TUNNEL(){

        //
        // Thursday, November 23, 2023 @ 1212 hrs.
        //
        // TODO :: RE-ARCHITECT ALL RELEVANT USE-CASES. // Thursday, November 23, 2023 @ 1126 hrs.
        // THE POSSIBILITIES:
        //      $tmp_js_css_compress_mode = 'PROD'
        //      $tmp_js_css_compress_mode = 'DEV'
        //
        // SEE, $oCRNRSTN->tidy_boolean(CRNRSTN_JS_CSS_PROD_MIN, CRNRSTN_JS_CSS_PROD_MIN, CRNRSTN_JS_CSS_PROD_MIN);
        //
        $tmp_js_css_compress_mode = $this->oCRNRSTN->tidy_boolean(CRNRSTN_JS_CSS_PROD_MIN, CRNRSTN_JS_CSS_PROD_MIN, CRNRSTN_JS_CSS_PROD_MIN);
        switch($tmp_js_css_compress_mode){
            case 'DEV':
                //

                error_log(__LINE__ . ' asset mgr READY TO PROD/[' . $tmp_js_css_compress_mode . '<--] JS AND CSS USING TIDY_BOOLEAN().');

            break;
            default:
                //case 'PROD':

                error_log(__LINE__ . ' asset mgr READY TO [--->' . $tmp_js_css_compress_mode . ']/DEV JS AND CSS USING TIDY_BOOLEAN().');

            break;

        }

        //
        // TODO :: RE-ARCHITECT ALL RELEVANT USE-CASES. // Thursday, November 23, 2023 @ 1126 hrs.
        // THE POSSIBILITIES:
        //      $tmp_asset_mapping_mode = 'ON'
        //      $tmp_asset_mapping_mode = 'OFF'
        //
        // SEE, $oCRNRSTN->tidy_boolean(CRNRSTN_CSS_ASSET_MAPPING, CRNRSTN_CSS_ASSET_MAPPING, CRNRSTN_CSS_ASSET_MAPPING);
        //
        $tmp_asset_mapping_mode = $this->oCRNRSTN->tidy_boolean(CRNRSTN_CSS_ASSET_MAPPING, CRNRSTN_CSS_ASSET_MAPPING, CRNRSTN_CSS_ASSET_MAPPING);
        switch($tmp_asset_mapping_mode){
            case 'OFF':
                //

                error_log(__LINE__ . ' asset mgr READY TO ON/[' . $tmp_asset_mapping_mode . '<--] JS AND CSS USING TIDY_BOOLEAN().');

            break;
            default:
                //case 'ON':

                error_log(__LINE__ . ' asset mgr READY TO [--->' . $tmp_asset_mapping_mode . ']/DEV JS AND CSS USING TIDY_BOOLEAN().');

            break;

        }


        //public function add($data_value, $data_key = NULL, $data_type_family = 'CRNRSTN::RESOURCE', $index = NULL, $data_authorization_profile = CRNRSTN_AUTHORIZE_RUNTIME, $ttl = 60){

        $this->oCRNRSTN_USR->form_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_xhr_root', 'crnrstn_xhr_root');

        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_interact_ui_sysdate', 'crnrstn_interact_ui_sysdate');
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_interact_ui_link_text_click', 'crnrstn_interact_ui_link_text_click');
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_request_source', 'crnrstn_request_source');
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_resource_initialize', 'crnrstn_resource_initialize');
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_interact_ui_loadbar_progress', 'crnrstn_interact_ui_loadbar_progress');
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_interact_ui_active_nav_links', 'crnrstn_interact_ui_active_nav_links');
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_pssdtl_packet', 'crnrstn_pssdtl_packet', $this->oCRNRSTN->return_crnrstn_data_packet(CRNRSTN_CHANNEL_PSSDTLA), CRNRSTN_INPUT_REQUIRED);
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_ssdtla_form_serial', 'crnrstn_ssdtla_form_serial', $this->oCRNRSTN->salt(), CRNRSTN_INPUT_REQUIRED);
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_ssdtla_timestamp', 'crnrstn_ssdtla_timestamp', $this->oCRNRSTN_USR->return_micro_time());
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_ssdtl_packet_ttl', 'crnrstn_ssdtl_packet_ttl', $this->oCRNRSTN_USR->return_ssdtl_packet_ttl(), CRNRSTN_INPUT_REQUIRED);
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_client_user_agent', 'crnrstn_client_user_agent', $_SERVER['HTTP_USER_AGENT'], CRNRSTN_INPUT_REQUIRED);
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_service_server_ip', 'crnrstn_soap_service_server_ip', $_SERVER['SERVER_ADDR'], CRNRSTN_INPUT_REQUIRED);
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_service_client_ip', 'crnrstn_soap_service_client_ip', $this->oCRNRSTN->client_ip(), CRNRSTN_INPUT_REQUIRED);
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_service_stime', 'crnrstn_soap_service_stime', $this->starttime);
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_service_rtime', 'crnrstn_soap_service_rtime', $this->wall_time());
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_service_framework_version','crnrstn_soap_service_framework_version', $this->oCRNRSTN_USR->proper_version('SOAP'));
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_service_encoding', 'crnrstn_soap_service_encoding', $this->oCRNRSTN->soap_defencoding());
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_session_client_auth_key', 'crnrstn_session_client_auth_key', $this->oCRNRSTN->session_client_auth_key, CRNRSTN_INPUT_REQUIRED);
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_session_client_id', 'crnrstn_session_client_id', $this->oCRNRSTN->session_client_id, CRNRSTN_INPUT_REQUIRED);
        $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_php_sessionid', 'crnrstn_php_sessionid', session_id(), CRNRSTN_INPUT_REQUIRED);

        $tmp_show_comments = $this->tidy_boolean(CRNRSTN_HTML_COMMENTS_SILENT_GOLD, CRNRSTN_BOOLEAN, CRNRSTN_ICY_BITMASK, 'crnrstn_html_comments_mode');
        // $tmp_show_comments = true;
        // if($this->oCRNRSTN->is_serialized_bit_set('crnrstn_html_comments_mode', CRNRSTN_HTML_COMMENTS_SILENT_GOLD) !== true){
        //     $tmp_show_comments = false;
        // }

        if($tmp_show_comments == true){

            $tmp_str_array[] = '
' . $this->oCRNRSTN->html_version_burn('INTERACT UI SOAP-SERVICES DATA TUNNEL LAYER MODULE') . '
';

        }

        error_log(__LINE__ . ' env INTERACT UI SOAP-SERVICES DATA TUNNEL LAYER MODULE.');

        $tmp_resource_initialize = '';
        $tmp_request_family = $this->oCRNRSTN->return_crnrstn_asset_family();
        if($tmp_request_family == 'module_key' || $tmp_request_family == 'meta'){

            $tmp_resource_initialize = $this->oCRNRSTN->return_response_map_asset_meta_key();
            //error_log(__LINE__ . ' env $tmp_resource_initialize[' . $tmp_resource_initialize . '].');

        }

        $tmp_http_get_data_params = $this->oCRNRSTN->return_http_data_services_meta('get');

        if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

            $tmp_str = '<div id="crnrstn_soap_data_tunnel_form_shell" class="crnrstn_hidden"><form action="#" method="post" id="crnrstn_soap_data_tunnel_frm" name="crnrstn_soap_data_tunnel_frm" enctype="multipart/form-data"><textarea id="crnrstn_soap_srvc_data" name="crnrstn_soap_srvc_data" cols="130" rows="5">CRNRSTN :: SOAP-SERVICES DATA TUNNEL LAYER PACKET (SSDTLP)</textarea><button type="submit">SUBMIT</button><input type="hidden" id="crnrstn_xhr_root" name="crnrstn_xhr_root" value="' . $this->oCRNRSTN->crnrstn_http_endpoint() . '"><input type="hidden" id="crnrstn_interact_ui_module_programme" name="crnrstn_interact_ui_module_programme" value="' . $this->oCRNRSTN->oCRNRSTN_TRM->return_interact_ui_module_programme() . '"><input type="hidden" id="crnrstn_page_load_ttl" name="crnrstn_page_load_ttl" value="' . $this->oCRNRSTN->get_resource('page_load_ttl', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS') . '"><input type="hidden" id="crnrstn_inactivity_refresh_ttl" name="crnrstn_inactivity_refresh_ttl" value="' . $this->oCRNRSTN->get_resource('inactivity_refresh_ttl', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS') . '"><input type="hidden" id="crnrstn_ssdtla_module_sync_ttl" name="crnrstn_ssdtla_module_sync_ttl" value="' . $this->oCRNRSTN->get_resource('ssdtla_module_sync_ttl', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS') . '"><input type="hidden" id="crnrstn_share_module_inactivity_close_ttl" name="crnrstn_share_module_inactivity_close_ttl" value="' . $this->oCRNRSTN->get_resource('share_module_inactivity_close_ttl', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS') . '"><input type="hidden" id="crnrstn_debug_logging_output_channel" name="crnrstn_debug_logging_output_channel" value="' . $this->oCRNRSTN->get_resource('debug_logging_output_channel', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS') . '"><input type="hidden" id="crnrstn_client_debug_mode" name="crnrstn_client_debug_mode" value="' . $this->oCRNRSTN->get_resource('client_debug_mode', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS') . '"><input type="hidden" id="crnrstn_interact_ui_ttl" name="crnrstn_interact_ui_ttl" value="' . $this->return_interact_ui_ttl('interact_ui_ttl') . '"><input type="hidden" id="crnrstn_interact_ui_month_abbrev" name="crnrstn_interact_ui_month_abbrev" value="' . $this->return_interact_ui_ttl('interact_ui_month_abbrev') . '"><input type="hidden" id="crnrstn_interact_ui_month" name="crnrstn_interact_ui_month" value="' . $this->return_interact_ui_ttl('interact_ui_month') . '"><input type="hidden" id="crnrstn_interact_ui_day_abbrev" name="crnrstn_interact_ui_day_abbrev" value="' . $this->return_interact_ui_ttl('interact_ui_day_abbrev') . '"><input type="hidden" id="crnrstn_interact_ui_day" name="crnrstn_interact_ui_day" value="' . $this->return_interact_ui_ttl('interact_ui_day') . '"><input type="hidden" id="crnrstn_request_source" name="crnrstn_request_source" value=""><input type="hidden" id="crnrstn_resource_initialize" name="crnrstn_resource_initialize" value="' . $tmp_resource_initialize . '"><input type="hidden" id="crnrstn_interact_data_tunnel_get_params" name="crnrstn_interact_data_tunnel_get_params" value="' . $tmp_http_get_data_params . '"><input type="hidden" id="crnrstn_soap_service_client_ip" name="crnrstn_soap_service_client_ip" value="' . $this->oCRNRSTN->data_encrypt($this->oCRNRSTN->client_ip()) . '">' . $this->oCRNRSTN->oCRNRSTN_TRM->return_interact_ui_module_programme('hidden_hash_input_array');
            $tmp_str .= $this->oCRNRSTN_USR->ui_content_module_out(CRNRSTN_CHANNEL_SSDTLA, 'crnrstn_soap_data_tunnel_form') . '</form><div id="crnrstn_interact_ui_loadbar_IMAGE_CACHE">' . $this->oCRNRSTN->return_creative('UI_PAGELOAD_INDICATOR', CRNRSTN_HTML) . '</div><div id="crnrstn_interact_ui_mit_license_src" class="crnrstn_hidden"></div><div id="crnrstn_interact_ui_theme_profile" class="crnrstn_hidden"></div></div>';
            $this->oCRNRSTN->channel_auth_data_reporting_sync($tmp_str, 'PSSDTLA_ARCHITECTURE', 'DDO', 'pssdtla', CRNRSTN_AUTHORIZE_PSSDTLA);
            $tmp_str_array[] = $tmp_str;

        }else{

            $tmp_str = '<div id="crnrstn_soap_data_tunnel_form_shell" class="crnrstn_hidden">
    <form action="#" method="post" id="crnrstn_soap_data_tunnel_frm" name="crnrstn_soap_data_tunnel_frm" enctype="multipart/form-data">
        <textarea id="crnrstn_soap_srvc_data" name="crnrstn_soap_srvc_data" cols="130" rows="5">CRNRSTN :: SOAP-SERVICES DATA TUNNEL LAYER PACKET (SSDTLP)</textarea>
        <button type="submit">SUBMIT</button>
        <input type="hidden" id="crnrstn_xhr_root" name="crnrstn_xhr_root" value="' . $this->oCRNRSTN->crnrstn_http_endpoint() . '">
        <input type="hidden" id="crnrstn_interact_ui_sysdate" name="crnrstn_interact_ui_sysdate" value="' . date('F j, Y H:i:s') . '">
        <input type="hidden" id="crnrstn_interact_ui_module_programme" name="crnrstn_interact_ui_module_programme" value="' . $this->oCRNRSTN->oCRNRSTN_TRM->return_interact_ui_module_programme() . '">
        <input type="hidden" id="crnrstn_page_load_ttl" name="crnrstn_page_load_ttl" value="' . $this->oCRNRSTN->get_resource('page_load_ttl', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS') . '">
        <input type="hidden" id="crnrstn_inactivity_refresh_ttl" name="crnrstn_inactivity_refresh_ttl" value="' . $this->oCRNRSTN->get_resource('inactivity_refresh_ttl', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS') . '">
        <input type="hidden" id="crnrstn_ssdtla_module_sync_ttl" name="crnrstn_ssdtla_module_sync_ttl" value="' . $this->oCRNRSTN->get_resource('ssdtla_module_sync_ttl', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS') . '">
        <input type="hidden" id="crnrstn_share_module_inactivity_close_ttl" name="crnrstn_share_module_inactivity_close_ttl" value="' . $this->oCRNRSTN->get_resource('share_module_inactivity_close_ttl', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS') . '">
        <input type="hidden" id="crnrstn_debug_logging_output_channel" name="crnrstn_debug_logging_output_channel" value="' . $this->oCRNRSTN->get_resource('debug_logging_output_channel', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS') . '">
        <input type="hidden" id="crnrstn_client_debug_mode" name="crnrstn_client_debug_mode" value="' . $this->oCRNRSTN->get_resource('client_debug_mode', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS') . '">
        <input type="hidden" id="crnrstn_interact_ui_ttl" name="crnrstn_interact_ui_ttl" value="' . $this->return_interact_ui_ttl('interact_ui_ttl') . '">
        <input type="hidden" id="crnrstn_interact_ui_month_abbrev" name="crnrstn_interact_ui_month_abbrev" value="' . $this->return_interact_ui_ttl('interact_ui_month_abbrev') . '">
        <input type="hidden" id="crnrstn_interact_ui_month" name="crnrstn_interact_ui_month" value="' . $this->return_interact_ui_ttl('interact_ui_month') . '">
        <input type="hidden" id="crnrstn_interact_ui_day_abbrev" name="crnrstn_interact_ui_day_abbrev" value="' . $this->return_interact_ui_ttl('interact_ui_day_abbrev') . '">
        <input type="hidden" id="crnrstn_interact_ui_day" name="crnrstn_interact_ui_day" value="' . $this->return_interact_ui_ttl('interact_ui_day') . '">
        <input type="hidden" id="crnrstn_request_source" name="crnrstn_request_source" value="">
        <input type="hidden" id="crnrstn_resource_initialize" name="crnrstn_resource_initialize" value="' . $tmp_resource_initialize . '">
        <input type="hidden" id="crnrstn_interact_data_tunnel_get_params" name="crnrstn_interact_data_tunnel_get_params" value="' . $tmp_http_get_data_params . '">
        <input type="hidden" id="crnrstn_soap_service_client_ip" name="crnrstn_soap_service_client_ip" value="' . $this->oCRNRSTN->data_encrypt($this->oCRNRSTN->client_ip()) . '">
' . $this->oCRNRSTN->oCRNRSTN_TRM->return_interact_ui_module_programme('hidden_hash_input_array');

            $tmp_str .= $this->oCRNRSTN_USR->ui_content_module_out(CRNRSTN_CHANNEL_SSDTLA, 'crnrstn_soap_data_tunnel_form') . '</form>
    <div id="crnrstn_interact_ui_loadbar_IMAGE_CACHE">' . $this->oCRNRSTN->return_creative('UI_PAGELOAD_INDICATOR', CRNRSTN_HTML) . '</div>
    <div id="crnrstn_interact_ui_mit_license_src" class="crnrstn_hidden"></div>
    <div id="crnrstn_interact_ui_theme_profile" class="crnrstn_hidden"></div>
</div>
';

            //
            // TODO :: MULTI-CHANNEL TESTING AND DEVELOPMENT; FIX CHANNEL REPORTING...,AS SYNC CRASHES THE PSSDTLA!
            //$this->oCRNRSTN->channel_auth_data_reporting_sync($tmp_str, 'PSSDTLA_ARCHITECTURE', 'DDO', 'pssdtla', CRNRSTN_AUTHORIZE_PSSDTLA);
            $tmp_str_array[] = $tmp_str;

        }

        if($tmp_show_comments == true){

            $tmp_str_array[] = $this->oCRNRSTN->html_version_burn('INTERACT UI SOAP-SERVICES DATA TUNNEL LAYER MODULE', 'END') . '
';
        }

        return $tmp_str_array;

    }

    public function return_interact_ui_ttl($array_index){

        $tmp_str = '';
        $tmp_ARRAY = $this->oCRNRSTN->get_resource($array_index, 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

        foreach($tmp_ARRAY as $index => $ttl_element){

            $tmp_str .= $ttl_element . '|';

        }

        $tmp_str = $this->oCRNRSTN->strrtrim($tmp_str, '|');

        return $tmp_str;

    }

    private function return_output_CRNRSTN_UI_TAG_ANALYTICS(){

        //
        // Thursday, November 23, 2023 @ 1214 hrs.
        //
        // TODO :: RE-ARCHITECT ALL RELEVANT USE-CASES. // Thursday, November 23, 2023 @ 1126 hrs.
        // THE POSSIBILITIES:
        //      $tmp_js_css_compress_mode = 'PROD'
        //      $tmp_js_css_compress_mode = 'DEV'
        //
        // SEE, $oCRNRSTN->tidy_boolean(CRNRSTN_JS_CSS_PROD_MIN, CRNRSTN_JS_CSS_PROD_MIN, CRNRSTN_JS_CSS_PROD_MIN);
        //
        $tmp_js_css_compress_mode = $this->oCRNRSTN->tidy_boolean(CRNRSTN_JS_CSS_PROD_MIN, CRNRSTN_JS_CSS_PROD_MIN, CRNRSTN_JS_CSS_PROD_MIN);
        switch($tmp_js_css_compress_mode){
            case 'DEV':
                //

                error_log(__LINE__ . ' asset mgr READY TO PROD/[' . $tmp_js_css_compress_mode . '<--] JS AND CSS USING TIDY_BOOLEAN().');

            break;
            default:
                //case 'PROD':

                error_log(__LINE__ . ' asset mgr READY TO [--->' . $tmp_js_css_compress_mode . ']/DEV JS AND CSS USING TIDY_BOOLEAN().');

            break;

        }

        //
        // TODO :: RE-ARCHITECT ALL RELEVANT USE-CASES. // Thursday, November 23, 2023 @ 1126 hrs.
        // THE POSSIBILITIES:
        //      $tmp_asset_mapping_mode = 'ON'
        //      $tmp_asset_mapping_mode = 'OFF'
        //
        // SEE, $oCRNRSTN->tidy_boolean(CRNRSTN_CSS_ASSET_MAPPING, CRNRSTN_CSS_ASSET_MAPPING, CRNRSTN_CSS_ASSET_MAPPING);
        //
        $tmp_asset_mapping_mode = $this->oCRNRSTN->tidy_boolean(CRNRSTN_CSS_ASSET_MAPPING, CRNRSTN_CSS_ASSET_MAPPING, CRNRSTN_CSS_ASSET_MAPPING);
        switch($tmp_asset_mapping_mode){
            case 'OFF':
                //

                error_log(__LINE__ . ' asset mgr READY TO ON/[' . $tmp_asset_mapping_mode . '<--] JS AND CSS USING TIDY_BOOLEAN().');

            break;
            default:
                //case 'ON':

                error_log(__LINE__ . ' asset mgr READY TO [--->' . $tmp_asset_mapping_mode . ']/DEV JS AND CSS USING TIDY_BOOLEAN().');

            break;

        }

        $tmp_str_array = array();

        $tmp_show_comments = $this->tidy_boolean(CRNRSTN_HTML_COMMENTS_SILENT_GOLD, CRNRSTN_BOOLEAN, CRNRSTN_ICY_BITMASK, 'crnrstn_html_comments_mode');
        // $tmp_show_comments = true;
        // if($this->oCRNRSTN->is_serialized_bit_set('crnrstn_html_comments_mode', CRNRSTN_HTML_COMMENTS_SILENT_GOLD) !== true){
        //     $tmp_show_comments = false;
        // }

        if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

            if($tmp_show_comments == true){

                $tmp_str_array[] = $this->oCRNRSTN->html_version_burn('INTERACT UI ANALYTICS SEO MODULE');

            }

            $tmp_str_array[] = $this->oCRNRSTN->return_module_content_seo_analytics();

            if($tmp_show_comments == true){

                $tmp_str_array[] = $this->oCRNRSTN->html_version_burn('INTERACT UI ANALYTICS SEO MODULE', 'END');

            }

        }else{

            if($tmp_show_comments == true){

                $tmp_str_array[] = '
' . $this->oCRNRSTN->html_version_burn('INTERACT UI ANALYTICS SEO MODULE') . '
';

            }

            $tmp_str_array[] = $this->oCRNRSTN->return_module_content_seo_analytics();

            if($tmp_show_comments == true){

                $tmp_str_array[] = $this->oCRNRSTN->html_version_burn('INTERACT UI ANALYTICS SEO MODULE', 'END') . '
';

            }

        }

        return $tmp_str_array;

    }

    private function return_output_CRNRSTN_UI_TAG_ENGAGEMENT(){

        //
        // Thursday, November 23, 2023 @ 1215 hrs.
        //
        // TODO :: RE-ARCHITECT ALL RELEVANT USE-CASES. // Thursday, November 23, 2023 @ 1126 hrs.
        // THE POSSIBILITIES:
        //      $tmp_js_css_compress_mode = 'PROD'
        //      $tmp_js_css_compress_mode = 'DEV'
        //
        // SEE, $oCRNRSTN->tidy_boolean(CRNRSTN_JS_CSS_PROD_MIN, CRNRSTN_JS_CSS_PROD_MIN, CRNRSTN_JS_CSS_PROD_MIN);
        //
        $tmp_js_css_compress_mode = $this->oCRNRSTN->tidy_boolean(CRNRSTN_JS_CSS_PROD_MIN, CRNRSTN_JS_CSS_PROD_MIN, CRNRSTN_JS_CSS_PROD_MIN);
        switch($tmp_js_css_compress_mode){
            case 'DEV':
                //

                error_log(__LINE__ . ' asset mgr READY TO PROD/[' . $tmp_js_css_compress_mode . '<--] JS AND CSS USING TIDY_BOOLEAN().');

            break;
            default:
                //case 'PROD':

                error_log(__LINE__ . ' asset mgr READY TO [--->' . $tmp_js_css_compress_mode . ']/DEV JS AND CSS USING TIDY_BOOLEAN().');

            break;

        }

        //
        // TODO :: RE-ARCHITECT ALL RELEVANT USE-CASES. // Thursday, November 23, 2023 @ 1126 hrs.
        // THE POSSIBILITIES:
        //      $tmp_asset_mapping_mode = 'ON'
        //      $tmp_asset_mapping_mode = 'OFF'
        //
        // SEE, $oCRNRSTN->tidy_boolean(CRNRSTN_CSS_ASSET_MAPPING, CRNRSTN_CSS_ASSET_MAPPING, CRNRSTN_CSS_ASSET_MAPPING);
        //
        $tmp_asset_mapping_mode = $this->oCRNRSTN->tidy_boolean(CRNRSTN_CSS_ASSET_MAPPING, CRNRSTN_CSS_ASSET_MAPPING, CRNRSTN_CSS_ASSET_MAPPING);
        switch($tmp_asset_mapping_mode){
            case 'OFF':
                //

                error_log(__LINE__ . ' asset mgr READY TO ON/[' . $tmp_asset_mapping_mode . '<--] JS AND CSS USING TIDY_BOOLEAN().');

            break;
            default:
                //case 'ON':

                error_log(__LINE__ . ' asset mgr READY TO [--->' . $tmp_asset_mapping_mode . ']/DEV JS AND CSS USING TIDY_BOOLEAN().');

            break;

        }

        $tmp_show_comments = $this->tidy_boolean(CRNRSTN_HTML_COMMENTS_SILENT_GOLD, CRNRSTN_BOOLEAN, CRNRSTN_ICY_BITMASK, 'crnrstn_html_comments_mode');
        // $tmp_show_comments = true;
        // if($this->oCRNRSTN->is_serialized_bit_set('crnrstn_html_comments_mode', CRNRSTN_HTML_COMMENTS_SILENT_GOLD) !== true){
        //     $tmp_show_comments = false;
        // }

        if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

            if($tmp_show_comments == true){

                $tmp_str_array[] = $this->oCRNRSTN->html_version_burn('INTERACT UI ENGAGEMENT MODULE');

            }

            $tmp_str_array[] = $this->oCRNRSTN->return_module_content_seo_engagement();

            if($tmp_show_comments == true){

                $tmp_str_array[] = $this->oCRNRSTN->html_version_burn('INTERACT UI ENGAGEMENT MODULE', 'END');

            }

        }else{

            if($tmp_show_comments == true){

                $tmp_str_array[] = '
' . $this->oCRNRSTN->html_version_burn('INTERACT UI ENGAGEMENT MODULE') . '
';

            }

            $tmp_str_array[] = $this->oCRNRSTN->return_module_content_seo_engagement();

            if($tmp_show_comments == true){

                $tmp_str_array[] = $this->oCRNRSTN->html_version_burn('INTERACT UI ENGAGEMENT MODULE', 'END') . '
';

            }

        }

        return $tmp_str_array;

    }

    private function return_output_CRNRSTN_RESOURCE_DEEP_LINK(){

        /*
        January 14, 2023 @ 0509 hrs

        NOTES:
        What about MIT license deep link?
        What about deep link for an article, a blog post, a landing page, etc.; the King's highway for page return.
        What about static page return that does not use CRNRSTN_JS to load the content after DOM Ready? Any use?

        */

        $tmp_str = '';
        $tmp_node_cnt = 0;
        $tmp_ARRAY = array();
        error_log(__LINE__  . ' env LET THIS BREAK. RE-WORKING...$_GET[]...WELL, ...SOON.');
        $tmp_crnrstn_request_ugc_val = $this->oCRNRSTN->oCRNRSTN_RRS_MAP->get_salt_ugc();

        $tmp_show_comments = $this->tidy_boolean(CRNRSTN_HTML_COMMENTS_SILENT_GOLD, CRNRSTN_BOOLEAN, CRNRSTN_ICY_BITMASK, 'crnrstn_html_comments_mode');
        // $tmp_show_comments = true;
        // if($this->oCRNRSTN->is_serialized_bit_set('crnrstn_html_comments_mode', CRNRSTN_HTML_COMMENTS_SILENT_GOLD) !== true){
        //     $tmp_show_comments = false;
        // }

        if(strlen($tmp_crnrstn_request_ugc_val) > 0){

            error_log(__LINE__ . ' env return_output_CRNRSTN_RESOURCE_DEEP_LINK RESPONSE RETURN ['. $tmp_crnrstn_request_ugc_val . '].');

            //
            // DOCUMENT
            $tmp_document_str = $this->oCRNRSTN->oINTERACT_UI_HTML_MGR->out_ui_module_html_system_documentation_page($tmp_crnrstn_request_ugc_val);
            $tmp_ARRAY[] = '<div id="crnrstn_deep_link_src_node_' . $tmp_node_cnt . '">' . $tmp_document_str . '</div>';
            $tmp_node_cnt++;

            //
            // NAVIGATION
            $tmp_nav_str = $this->oCRNRSTN->oINTERACT_UI_HTML_MGR->out_ui_module_html_system_documentation_nav();
            $tmp_hash_str = $this->oCRNRSTN->oDATA_TUNNEL_SERVICES_MGR->retrieve_interact_ui_module_hash('crnrstn_interact_ui_documentation_side_nav_src');

            error_log(__LINE__ . ' env DEEP LINK HTML PAGE LOAD INJECT $tmp_hash_str[' . $tmp_hash_str . ']. $tmp_nav_str[' . $tmp_nav_str . '].');
            $tmp_ARRAY[] = '<div id="crnrstn_deep_link_hash_node_' . $tmp_node_cnt . '">' . $tmp_hash_str . '</div>';
            $tmp_ARRAY[] = '<div id="crnrstn_deep_link_src_node_' . $tmp_node_cnt . '">' . $tmp_nav_str . '</div>';
            $tmp_node_cnt++;

            //
            // SYSTEM FOOTER
            $tmp_footer_str = $this->oCRNRSTN->oINTERACT_UI_HTML_MGR->out_ui_module_html_system_footer_content_container();
            $tmp_ARRAY[] = '<div id="crnrstn_deep_link_src_node_' . $tmp_node_cnt . '">' . $tmp_footer_str . '</div>';
            $tmp_node_cnt++;

        }

        if($tmp_show_comments == true){

            $tmp_str_array[] = $this->oCRNRSTN->html_version_burn('INTERACT UI DEEP LINK MODULE');

        }

        $tmp_str_array[] = '<div id="crnrstn_interact_ui_deep_link_src" class="crnrstn_hidden">
<div id="crnrstn_deep_link_src_node_count">' . $tmp_node_cnt . '</div>';

        foreach($tmp_ARRAY as $index => $str_src){

            $tmp_str_array[] = $str_src;

        }

        $tmp_str_array[] = '</div>';

        if($tmp_show_comments == true){

            $tmp_str_array[] = $this->oCRNRSTN->html_version_burn('INTERACT UI DEEP LINK MODULE', 'END');

        }

        return $tmp_str_array;

    }

    private function return_output_CRNRSTN_UI_SYSTEM_FOOTER(){

        $tmp_show_comments = $this->tidy_boolean(CRNRSTN_HTML_COMMENTS_SILENT_GOLD, CRNRSTN_BOOLEAN, CRNRSTN_ICY_BITMASK, 'crnrstn_html_comments_mode');
        // $tmp_show_comments = true;
        // if($this->oCRNRSTN->is_serialized_bit_set('crnrstn_html_comments_mode', CRNRSTN_HTML_COMMENTS_SILENT_GOLD) !== true){
        //     $tmp_show_comments = false;
        // }

        if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

            if($tmp_show_comments == true){

                $tmp_str_array[] = $this->oCRNRSTN->html_version_burn('INTERACT UI SYSTEM FOOTER MODULE');

            }

            $tmp_str_array[] = '<div id="crnrstn_interact_ui_system_footer_src" class="crnrstn_hidden"></div><div id="crnrstn_ui_system_footer_shell" class="crnrstn_ui_system_footer_shell"></div>';

            if($tmp_show_comments == true){

                $tmp_str_array[] = $this->oCRNRSTN->html_version_burn('INTERACT UI SYSTEM FOOTER MODULE', 'END');

            }

        }else{

            if($tmp_show_comments == true){

                $tmp_str_array[] = '
' . $this->oCRNRSTN->html_version_burn('INTERACT UI SYSTEM FOOTER MODULE') . '
';

            }

            $tmp_str_array[] = '        <div id="crnrstn_interact_ui_system_footer_src" class="crnrstn_hidden"></div>
        <div id="crnrstn_ui_system_footer_shell" class="crnrstn_ui_system_footer_shell"></div>
        ';

            if($tmp_show_comments == true){

                $tmp_str_array[] = $this->oCRNRSTN->html_version_burn('INTERACT UI SYSTEM FOOTER MODULE', 'END') . '
';

            }

        }

        return $tmp_str_array;

    }

    private function return_output_CRNRSTN_UI_SYSTEM_REPORT_RESPONSE_RETURN($is_HTML = true){

        $tmp_str_array = array();
        $tmp_show_comments = true;
        $tmp_comment_begin = '';
        $tmp_comment_end = '';

        $tmp_show_comments = $this->tidy_boolean(CRNRSTN_HTML_COMMENTS_SILENT_GOLD, CRNRSTN_BOOLEAN, CRNRSTN_ICY_BITMASK, 'crnrstn_html_comments_mode');
        // if($this->oCRNRSTN->is_serialized_bit_set('crnrstn_html_comments_mode', CRNRSTN_HTML_COMMENTS_SILENT_GOLD) !== true){
        //     $tmp_show_comments = false;
        // }

        //
        // TODO :: READY FOR IMPLEMENTATION:
        //
        // THE POSSIBILITIES:
        //      $tmp_content_type = 'HTML'
        //      $tmp_content_type = 'TEXT'
        //
        // SEE, $oCRNRSTN->tidy_boolean($is_HTML, CRNRSTN_STRING, CRNRSTN_IS_HTML);
        $tmp_content_type = $this->oCRNRSTN->tidy_boolean($is_HTML, CRNRSTN_STRING, CRNRSTN_IS_HTML);
        switch($tmp_content_type){
            case 'TEXT':

                error_log(__LINE__ . 'env READY CONTENT/[' . $tmp_content_type . '<--] USING TIDY_BOOLEAN().');

            break;
            default:
                //case 'HTML':

                error_log(__LINE__ . ' env READY [--->' . $tmp_content_type . '] CONTENT USING TIDY_BOOLEAN().');

            break;

        }

        //
        // CRNRSTN :: MEMORY USAGE PERFORMANCE REPORTING.
        $is_HTML = false;
        if($is_HTML == 'HTML'){

            $is_HTML = true;

        }

        $mem_report_queue = $this->oCRNRSTN->get_resource('mem_rpt_system_page_return_statistics_module', 0, 'CRNRSTN::RESOURCE::REPORTING');
        $tmp_txt_break = '
';
        $tmp_mem_str = $this->oCRNRSTN->mem_report($mem_report_queue, 'TEXT', 10, false, $is_HTML, $tmp_txt_break, '<br>');

        //
        // GENERATE SOCIAL MEDIA CONTENT PERFORMANCE REPORT.
        $tmp_social_meta_integrations_ARRAY = $this->return_output_CRNRSTN_SOCIAL_MEDIA_META_REPORT();

        switch($output_format){
            case 'HTML':

                $tmp_min_version = false;
                if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

                    $tmp_min_version = true;

                }

                if($tmp_show_comments == true){

                    $tmp_comment_begin = $this->oCRNRSTN->html_version_burn('INTERACT UI SYSTEM REPORT OUTPUT :: RESPONSE RETURN RESOURCES CONSUMPTION');

                    $tmp_str_array[] = '
' . $tmp_comment_begin . '
';

                }

                $tmp_hashed_html = '';
                $tmp_hashed_html_out = '';
                $tmp_SSL_ENABLED = 'FALSE';
                if($this->oCRNRSTN->is_SSL == true){

                    $tmp_SSL_ENABLED = 'TRUE';

                }

                /*
                $tmp_ARRAY[$i]['locale_identifier>'] = $oCRNRSTN_LANG_MGR->return_lang_pref_data('locale_identifier', $i);
                $tmp_ARRAY[$i]['region_variant>'] = $oCRNRSTN_LANG_MGR->return_lang_pref_data('region_variant', $i);
                $tmp_ARRAY[$i]['factor_weighting>'] = $oCRNRSTN_LANG_MGR->return_lang_pref_data('factor_weighting', $i);
                $tmp_ARRAY[$i]['iso_language_nomination>'] = $oCRNRSTN_LANG_MGR->return_lang_pref_data('iso_language_nomination', $i);
                $tmp_ARRAY[$i]['native_nomination>'] = $oCRNRSTN_LANG_MGR->return_lang_pref_data('native_nomination', $i);
                $tmp_ARRAY[$i]['iso_639-1_2002>'] = $oCRNRSTN_LANG_MGR->return_lang_pref_data('iso_639-1_2002', $i);
                $tmp_ARRAY[$i]['iso_639-2_1998>'] = $oCRNRSTN_LANG_MGR->return_lang_pref_data('iso_639-2_1998', $i);
                $tmp_ARRAY[$i]['iso_639-3_2007>'] = $oCRNRSTN_LANG_MGR->return_lang_pref_data('iso_639-3_2007', $i);
                $tmp_ARRAY[$i]['locale_identifier>'] = $oCRNRSTN_LANG_MGR->return_lang_pref_data('locale_identifier', $i);

                <language>
                    <language_preference>
                        <request_id timestamp="2022-11-11 14:21:01.974633">xzPlvuvDL2</request_id>
                        <request_referer>http://172.16.225.139/lightsaber.crnrstn.evifweb.com/</request_referer>
                        <locale_identifier>en</locale_identifier>
                        <region_variant>US</region_variant>
                        <factor_weighting>0.9</factor_weighting>
                        <iso_language_nomination>English</iso_language_nomination>
                        <native_nomination><![CDATA[English]]></native_nomination>
                        <iso_639-1_2002>en</iso_639-1_2002>
                        <iso_639-2_1998>eng</iso_639-2_1998>
                        <iso_639-3_2007>eng</iso_639-3_2007>
                    </language_preference>
                    <language_preference>
                        <request_id timestamp="2022-11-11 14:21:01.974841">0McMrF9QOg</request_id>
                        <request_referer>http://172.16.225.139/lightsaber.crnrstn.evifweb.com/</request_referer>
                        <locale_identifier>zh</locale_identifier>
                        <region_variant>CN</region_variant>
                        <factor_weighting>0.8</factor_weighting>
                        <iso_language_nomination>Chinese</iso_language_nomination>
                        <native_nomination><![CDATA[中文 (Zhōngwén), 汉语, 漢語]]></native_nomination>
                        <iso_639-1_2002>zh</iso_639-1_2002>
                        <iso_639-2_1998>zho</iso_639-2_1998>
                        <iso_639-3_2007>zho</iso_639-3_2007>
                    </language_preference>
                    <language_preference>
                        <request_id timestamp="2022-11-11 14:21:01.974927">3oU3N6Eyiy</request_id>
                        <request_referer>http://172.16.225.139/lightsaber.crnrstn.evifweb.com/</request_referer>
                        <locale_identifier>zh</locale_identifier>
                        <region_variant></region_variant>
                        <factor_weighting>0.7</factor_weighting>
                        <iso_language_nomination>Chinese</iso_language_nomination>
                        <native_nomination><![CDATA[中文 (Zhōngwén), 汉语, 漢語]]></native_nomination>
                        <iso_639-1_2002>zh</iso_639-1_2002>
                        <iso_639-2_1998>zho</iso_639-2_1998>
                        <iso_639-3_2007>zho</iso_639-3_2007>
                    </language_preference>
                </language>

                */

                //
                // SOCIAL MEDIA CONTENT PERFORMANCE REPORT.
                $tmp_social_meta_integrations = $tmp_social_meta_integrations_ARRAY[$output_format];

                $tmp_lang_ARRAY = $this->oCRNRSTN->return_language_iso_profile();
                $tmp_lang_cnt = count($tmp_lang_ARRAY);

                $tmp_lang_report = '';
                if($tmp_lang_cnt > 0){

                    $tmp_lang_report = 'Accept-Language: ';

                    //
                    // BUILD LANGUAGE REPORT
                    for($ii = 0; $ii < $tmp_lang_cnt; $ii++){

                        $tmp_lang_report .= $tmp_lang_ARRAY[$ii]['native_nomination'] . '[' . $tmp_lang_ARRAY[$ii]['locale_identifier'] . '], ';

                    }

                    $tmp_lang_report = $this->oCRNRSTN->strrtrim($tmp_lang_report, ', ');
                    $tmp_lang_report .= '.';

                }

                //
                // BYTES HASH REPORT
                $tmp_total_bytes = 0;
                foreach($this->oCRNRSTN->total_bytes_hashed_ARRAY as $algo => $bytes){

                    $tmp_star_char = '&nbsp;';
                    $tmp_total_bytes += $bytes;

                    if($algo == $this->oCRNRSTN->system_hash_algo()){

                        $tmp_star_char = '*';

                    }

                    if($tmp_min_version == true){

                        $tmp_hashed_html .= '<div class="crnrstn_documentation_page_stats_hash_shell">';
                        $tmp_hashed_html .= '<div class="crnrstn_documentation_page_stats_hash_algo">' . $tmp_star_char . $algo . ':</div><div class="crnrstn_documentation_page_stats_hash_algo_bytes">'. $this->oCRNRSTN->format_bytes($bytes) . '</div>';
                        $tmp_hashed_html .= '</div><div class="crnrstn_cb"></div>';

                    }else{

                        $tmp_hashed_html .= '<div class="crnrstn_documentation_page_stats_hash_shell">';
                        $tmp_hashed_html .= '   <div class="crnrstn_documentation_page_stats_hash_algo">' . $tmp_star_char . $algo . ':</div>
                                                                    <div class="crnrstn_documentation_page_stats_hash_algo_bytes">'. $this->oCRNRSTN->format_bytes($bytes) . '</div>';
                        $tmp_hashed_html .= '</div><div class="crnrstn_cb"></div>';

                    }

                }

                $tmp_hashed_html_out .= '<div class="crnrstn_documentation_page_stats_hash_shell">';
                $tmp_hashed_html_out .= '<div class="crnrstn_documentation_page_stats_hash_total">Bytes <sup class="crnrstn_documentation_page_stats_sup">&dagger;</sup>hashed: ' . $this->oCRNRSTN->format_bytes($tmp_total_bytes, 5) . '</div>';
                $tmp_hashed_html_out .= '</div>';
                $tmp_hashed_html_out .= $tmp_hashed_html;

                $tmp_referer = '';
                if($tmp_min_version == true){

                    if(isset($_SERVER['HTTP_REFERER'])){

                        $tmp_referer = 'Referer: ' . $_SERVER['HTTP_REFERER'] . '<br>';

                    }

                }else{

                    if(isset($_SERVER['HTTP_REFERER'])){

                        $tmp_referer = 'Referer: ' . $_SERVER['HTTP_REFERER'] . '<br>
';

                    }

                }

                //
                // FOR READABILITY, WE ARE NOW BYPASSING THE MIN/PROD VERSION (EVERYTHING ON ONE LINE) OF THE REPORT.
                // IF (OR BEFORE) TURNING THIS BACK ON...BE SURE TO SYNC ALL CONTENT WITH THE DEV VERSION. THX!

                $tmp_min_version = false;
                if($tmp_min_version == true){

                    $tmp_report = '<p style="margin-bottom:0;">Response returned in {CRNRSTN_DYNAMIC_CONTENT_MODULE::DOCUMENT_RESPONSE_TIME}.<br><br>CLIENT ::<br>Returned page size (in text data): {CRNRSTN_DYNAMIC_CONTENT_MODULE::DOCUMENT_PAGE_SIZE}.<br>' . $tmp_referer . 'Device type: ' . $this->oCRNRSTN->device_type() . '<br>Accept-Language: ' . $this->oCRNRSTN->return_client_header_value('Accept-Language') . '<br>' . $tmp_lang_report . '<br><br>SOCIAL MEDIA INTEGRATIONS ::<br>' . $tmp_social_meta_integrations . '<br><br>SERVER ::<br>SERVER ::<br>Bytes <sup class="crnrstn_documentation_page_stats_sup">&dagger;</sup>stored: ' . $this->oCRNRSTN->format_bytes($this->oCRNRSTN->return_total_bytes_stored(), 5) . '</p>' . $tmp_hashed_html_out . '<p style="margin-top:0;">Bytes <sup class="crnrstn_documentation_page_stats_sup">&dagger;</sup>encrypted: ' . $this->oCRNRSTN->format_bytes($this->oCRNRSTN->total_bytes_encrypted, 5) . '<br>Bytes <sup class="crnrstn_documentation_page_stats_sup">&dagger;</sup>decrypted: ' . $this->oCRNRSTN->format_bytes($this->oCRNRSTN->total_bytes_decrypted, 5) . '<br>Server name: ' . $_SERVER['SERVER_NAME'] . '<br>Server address: ' . $_SERVER['SERVER_ADDR'] . '<br>SSL enabled: ' . $tmp_SSL_ENABLED . '<br>Request time: ' . $this->oCRNRSTN->start_time() . '</p><div class="crnrstn_cb_20"></div><div class="crnrstn_documentation_page_stats_dagger_key_shell"><div class="crnrstn_documentation_page_stats_dagger_key_dag">&dagger;</div><div class="crnrstn_documentation_page_stats_dagger_key_description"><p>A statistic reflecting server resource consumption and performance requirements related to returning the content for this request.</p></div><div class="crnrstn_cb"></div></div><div class="crnrstn_cb_10"></div><div class="crnrstn_documentation_page_stats_dagger_key_shell"><div class="crnrstn_documentation_page_stats_dagger_key_dag">*</div><div class="crnrstn_documentation_page_stats_dagger_key_description"><p>System default hashing algorithm.</p></div><div class="crnrstn_cb"></div></div><div class="crnrstn_cb_40"></div><p>[' . $this->oCRNRSTN->return_micro_time() . '] [rtime ' . $this->oCRNRSTN->wall_time() . ' secs]</p>';
                    $tmp_str_array[] = $tmp_report;

                    if($tmp_show_comments == true){

                        $tmp_str_array[] = $this->oCRNRSTN->html_version_burn('INTERACT UI SYSTEM REPORT', 'END');

                    }

                }else{

                    $tmp_report = '<p style="margin-bottom:0;">Response returned in {CRNRSTN_DYNAMIC_CONTENT_MODULE::DOCUMENT_RESPONSE_TIME}.<br><br>

CLIENT ::<br>
Returned page size (in text data): {CRNRSTN_DYNAMIC_CONTENT_MODULE::DOCUMENT_PAGE_SIZE}.<br>
' . $tmp_referer . 'Device type: ' . $this->oCRNRSTN->device_type() . '<br>
Accept-Language: ' . $this->oCRNRSTN->return_client_header_value('Accept-Language') . '<br>
' . $tmp_lang_report . '<br><br>

SOCIAL MEDIA INTEGRATIONS ::<br>
' . $tmp_social_meta_integrations . '<br><br>

SERVER ::<br>
Bytes <sup class="crnrstn_documentation_page_stats_sup">&dagger;</sup>stored: ' . $this->oCRNRSTN->format_bytes($this->oCRNRSTN->return_total_bytes_stored(), 5) . '
</p>
' . $tmp_hashed_html_out . '
<p style="margin-top:0;">
Bytes <sup class="crnrstn_documentation_page_stats_sup">&dagger;</sup>encrypted: ' . $this->oCRNRSTN->format_bytes($this->oCRNRSTN->total_bytes_encrypted, 5) . '<br>
Bytes <sup class="crnrstn_documentation_page_stats_sup">&dagger;</sup>decrypted: ' . $this->oCRNRSTN->format_bytes($this->oCRNRSTN->total_bytes_decrypted, 5) . '<br>
Server name: ' . $_SERVER['SERVER_NAME'] . '<br>
Server address: ' . $_SERVER['SERVER_ADDR'] . '<br>
SSL enabled: ' . $tmp_SSL_ENABLED . '<br>
Request time: ' . $this->oCRNRSTN->start_time() . '</p>

<div class="crnrstn_cb_20"></div>
<div class="crnrstn_documentation_page_stats_dagger_key_shell">
    <div class="crnrstn_documentation_page_stats_dagger_key_dag">&dagger;</div>
    <div class="crnrstn_documentation_page_stats_dagger_key_description"><p>A statistic reflecting server resource consumption and performance requirements related to returning the content for this request.</p></div>
    <div class="crnrstn_cb"></div>

</div>
<div class="crnrstn_cb_10"></div>
<div class="crnrstn_documentation_page_stats_dagger_key_shell">
    <div class="crnrstn_documentation_page_stats_dagger_key_dag">*</div>
    <div class="crnrstn_documentation_page_stats_dagger_key_description"><p>System default hashing algorithm.</p></div>
    <div class="crnrstn_cb"></div>

</div>
<div class="crnrstn_cb_10"></div>
<p>
' . $tmp_mem_str . '
</p>
<div class="crnrstn_cb_20"></div>
<p>[' . $this->oCRNRSTN->return_micro_time() . '] [rtime ' . $this->oCRNRSTN->wall_time() . ' secs]</p>
';
                    $tmp_str_array[] = $tmp_report;

                    if($tmp_show_comments == true){

                        $tmp_str_array[] = $this->oCRNRSTN->html_version_burn('INTERACT UI SYSTEM REPORT', 'END') . '
';

                    }

                }

            break;
            case 'TEXT':
            default:

                if($tmp_show_comments == true){

                    $tmp_comment_begin = $this->oCRNRSTN->html_version_burn('INTERACT UI SYSTEM REPORT', 'BEGIN', 'TEXT');
                    $tmp_comment_end = $this->oCRNRSTN->html_version_burn('INTERACT UI SYSTEM REPORT', 'END', 'TEXT');

                }

                $tmp_str_array[] = '
' . $tmp_comment_begin  . '
= = = = = = = = = =
RESPONSE RETURN RESOURCES CONSUMPTION
';

                $tmp_hashed_html = '';
                $tmp_hashed_html_out = '';
                $tmp_SSL_ENABLED = 'FALSE';
                if($this->oCRNRSTN->is_SSL == true){

                    $tmp_SSL_ENABLED = 'TRUE';

                }

                //
                // SOCIAL MEDIA CONTENT PERFORMANCE REPORT.
                $tmp_social_meta_integrations = $tmp_social_meta_integrations_ARRAY[$output_format];

                $tmp_lang_ARRAY = $this->oCRNRSTN->return_language_iso_profile();
                $tmp_lang_cnt = count($tmp_lang_ARRAY);

                $tmp_lang_report = '';
                if($tmp_lang_cnt > 0){

                    $tmp_lang_report = 'Accept-Language: ';

                    //
                    // BUILD LANGUAGE REPORT
                    for($ii = 0; $ii < $tmp_lang_cnt; $ii++){

                        $tmp_lang_report .= $tmp_lang_ARRAY[$ii]['native_nomination'] . '[' . $tmp_lang_ARRAY[$ii]['locale_identifier'] . '], ';

                    }

                    $tmp_lang_report = $this->oCRNRSTN->strrtrim($tmp_lang_report, ', ');
                    $tmp_lang_report .= '.';


                }

                //
                // BYTES HASH REPORT
                $tmp_total_bytes = 0;
                foreach($this->oCRNRSTN->total_bytes_hashed_ARRAY as $algo => $bytes){

                    $tmp_star_char = '  ';
                    $tmp_br_char = '
';
                    $tmp_total_bytes += $bytes;

                    if($algo == $this->oCRNRSTN->system_hash_algo()){

                        $tmp_star_char = '**';

                    }

                    $tmp_hashed_html .= '';
                    $tmp_hashed_html .= ' ' . $tmp_star_char . $algo . ': ' . $this->oCRNRSTN->format_bytes($bytes);
                    $tmp_hashed_html .= '
';

                }

                $tmp_hashed_html = $this->oCRNRSTN->strrtrim($tmp_hashed_html, $tmp_br_char);

                $tmp_hashed_html_out .= '';
                $tmp_hashed_html_out .= 'Bytes *hashed: ' . $this->oCRNRSTN->format_bytes($tmp_total_bytes, 5);
                $tmp_hashed_html_out .= '
';

                // REQUIRES OUTPUT BUFFERING AT THE START...WHICH FOR THIS ONE REPORT...IS NOT WORTH...JUST.
                //$tmp_output = ob_get_contents();
                //$tmp_output_size = strlen($tmp_output);

                $tmp_hashed_html_out  .= $tmp_hashed_html;

                $tmp_referer = '';
                if(isset($_SERVER['HTTP_REFERER'])){

                    $tmp_referer = 'Referer: ' . $_SERVER['HTTP_REFERER'] .'
';

                }

                $tmp_report = 'Response returned in ' . $this->oCRNRSTN->wall_time() . ' seconds.

CLIENT ::
' . $tmp_referer . 'Device type: ' . $this->oCRNRSTN->device_type() . '
Accept-Language: ' . $this->oCRNRSTN->return_client_header_value('Accept-Language') . '
' . $tmp_lang_report . '

SOCIAL MEDIA INTEGRATIONS ::
' . $tmp_social_meta_integrations . '

SERVER ::
' . $tmp_mem_str . '
Bytes *stored: ' . $this->oCRNRSTN->format_bytes($this->oCRNRSTN->return_total_bytes_stored(), 5) . '
' . $tmp_hashed_html_out . '
Bytes *encrypted: ' . $this->oCRNRSTN->format_bytes($this->oCRNRSTN->total_bytes_encrypted, 5) . '
Bytes *decrypted: ' . $this->oCRNRSTN->format_bytes($this->oCRNRSTN->total_bytes_decrypted, 5) . '
Server name: ' . $_SERVER['SERVER_NAME'] . '
Server address: ' . $_SERVER['SERVER_ADDR'] . '
SSL enabled: ' . $tmp_SSL_ENABLED . '
Request time: ' . $this->oCRNRSTN->start_time() . '

* A statistic reflecting server resource consumption and performance
requirements related to returning the content for this request.

** System default hashing algorithm.

[' . $this->oCRNRSTN->return_micro_time() . '] [rtime ' . $this->oCRNRSTN->wall_time() . ' secs]

';
                $tmp_str_array[] = $tmp_report;
                $tmp_str_array[] = '= = = = = = = = = =
' . $tmp_comment_end  . '
';

            break;

        }

        return $tmp_str_array;

    }

    private function return_output_CRNRSTN_SOCIAL_MEDIA_META_REPORT(){

        $tmp_str_out_ARRAY = array();
        $tmp_str_out_HTML = '';
        $tmp_str_out_TEXT = '';

        $this->oCRNRSTN->error_log('SOCIAL MEDIA META PERFORMANCE REPORTING READY FOR 1ST PASS LOGIC REVIEW.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        $tmp_data_type_family = 'CRNRSTN::RESOURCE::GENERAL_SETTINGS::META';
        $tmp_meta_cnt = $this->oCRNRSTN->get_resource_count('HTML_HEAD_CRNRSTN_META', $tmp_data_type_family);
        for($i = 0; $i < $tmp_meta_cnt; $i++){

            $tmp_data = $this->oCRNRSTN->get_resource('HTML_HEAD_CRNRSTN_META', $i, $tmp_data_type_family);
            if(is_array($tmp_data)){

                $tmp_cnt = sizeof($tmp_data);
                for ($ii = 0; $ii < $tmp_cnt; $ii++){

                    $tmp_str_out_HTML .= htmlentities($tmp_data[$ii]) . '<br>
        ';
                    $tmp_str_out_TEXT .= $tmp_data[$ii] . '
        ';

                }

            }else{

                $tmp_str_out_HTML .= htmlentities($tmp_data) . '<br>
        ';

                $tmp_str_out_TEXT .= $tmp_data . '
        ';

            }

        }

        //
        // REMOVE TRAILING LINE BREAK APPENDS.
        $tmp_str_out_HTML = $this->oCRNRSTN->strrtrim($tmp_str_out_HTML, '<br>
        ');

        $tmp_str_out_TEXT = $this->oCRNRSTN->strrtrim($tmp_str_out_TEXT, '
        ');

        if(!isset($tmp_str_out_ARRAY['HTML'])){

            $tmp_str_out_ARRAY['HTML'] = $tmp_str_out_HTML;

        }else{

            $tmp_str_out_ARRAY['HTML'] .= $tmp_str_out_HTML;

        }

        if(!isset($tmp_str_out_ARRAY['TEXT'])){

            $tmp_str_out_ARRAY['TEXT'] = $tmp_str_out_HTML;

        }else{

            $tmp_str_out_ARRAY['TEXT'] .= $tmp_str_out_TEXT;

        }

        return $tmp_str_out_ARRAY;

    }

    private function return_output_CRNRSTN_UI_DOCUMENTATION(){

        $tmp_str_array = array();

        $tmp_show_comments = $this->tidy_boolean(CRNRSTN_HTML_COMMENTS_SILENT_GOLD, CRNRSTN_BOOLEAN, CRNRSTN_ICY_BITMASK, 'crnrstn_html_comments_mode');
        // $tmp_show_comments = true;
        // if($this->oCRNRSTN->is_serialized_bit_set('crnrstn_html_comments_mode', CRNRSTN_HTML_COMMENTS_SILENT_GOLD) !== true){
        //     $tmp_show_comments = false;
        // }

        if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

            if($tmp_show_comments == true){

                $tmp_str_array[] = $this->oCRNRSTN->html_version_burn('INTERACT UI DOCUMENTATION MODULE');

            }

            $tmp_str_array[] = '<div id="crnrstn_interact_ui_documentation_side_nav_src" class="crnrstn_hidden"></div><div id="crnrstn_interact_ui_documentation_content_src" class="crnrstn_hidden"></div><div id="crnrstn_interact_ui_search_src" class="crnrstn_hidden"></div>';

            if($tmp_show_comments == true){

                $tmp_str_array[] = $this->oCRNRSTN->html_version_burn('INTERACT UI DOCUMENTATION MODULE', 'END');

            }


        }else{

            if($tmp_show_comments == true){

                $tmp_str_array[] = '
' . $this->oCRNRSTN->html_version_burn('INTERACT UI DOCUMENTATION MODULE') . '
';

            }

            $tmp_str_array[] = '        <div id="crnrstn_interact_ui_documentation_side_nav_src" class="crnrstn_hidden"></div>
        <div id="crnrstn_interact_ui_documentation_content_src" class="crnrstn_hidden"></div>
        <div id="crnrstn_interact_ui_search_src" class="crnrstn_hidden"></div>
        ';

            if($tmp_show_comments == true){

                $tmp_str_array[] = $this->oCRNRSTN->html_version_burn('INTERACT UI DOCUMENTATION MODULE', 'END') . '
';

            }

        }

        return $tmp_str_array;

    }

    private function return_output_CRNRSTN_UI_MESSENGER(){

        $tmp_show_comments = $this->tidy_boolean(CRNRSTN_HTML_COMMENTS_SILENT_GOLD, CRNRSTN_BOOLEAN, CRNRSTN_ICY_BITMASK, 'crnrstn_html_comments_mode');
        // $tmp_show_comments = true;
        // if($this->oCRNRSTN->is_serialized_bit_set('crnrstn_html_comments_mode', CRNRSTN_HTML_COMMENTS_SILENT_GOLD) !== true){
        //     $tmp_show_comments = false;
        // }

        if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

            if($tmp_show_comments == true){

                $tmp_str_array[] = $this->oCRNRSTN->html_version_burn('INTERACT UI MESSENGER MODULE');

            }

            $tmp_str_array[] = '<div id="crnrstn_interact_ui_messenger_src" class="crnrstn_hidden"></div>';

            if($tmp_show_comments == true){

                $tmp_str_array[] = $this->oCRNRSTN->html_version_burn('INTERACT UI MESSENGER MODULE', 'END');

            }

        }else{

            if($tmp_show_comments == true){

                $tmp_str_array[] = '
' . $this->oCRNRSTN->html_version_burn('INTERACT UI MESSENGER MODULE') . '
';

            }

            $tmp_str_array[] = '        <div id="crnrstn_interact_ui_messenger_src" class="crnrstn_hidden"></div>
        ';

            if($tmp_show_comments == true){

                $tmp_str_array[] = $this->oCRNRSTN->html_version_burn('INTERACT UI MESSENGER MODULE', 'END') . '
';

            }

        }

        return $tmp_str_array;

    }

    private function return_output_CRNRSTN_UI_SEARCH(){

        $tmp_show_comments = $this->tidy_boolean(CRNRSTN_HTML_COMMENTS_SILENT_GOLD, CRNRSTN_BOOLEAN, CRNRSTN_ICY_BITMASK, 'crnrstn_html_comments_mode');
        // $tmp_show_comments = true;
        // if($this->oCRNRSTN->is_serialized_bit_set('crnrstn_html_comments_mode', CRNRSTN_HTML_COMMENTS_SILENT_GOLD) !== true){
        //     $tmp_show_comments = false;
        // }

        if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

            if($tmp_show_comments == true){

                $tmp_str_array[] = $this->oCRNRSTN->html_version_burn('INTERACT UI SEARCH MODULE');

            }

            $tmp_str_array[] = '<div id="crnrstn_interact_ui_messenger_src" class="crnrstn_hidden"></div>';

            if($tmp_show_comments == true){

                $tmp_str_array[] = $this->oCRNRSTN->html_version_burn('INTERACT UI SEARCH MODULE', 'END');

            }

        }else{

            if($tmp_show_comments == true){

                $tmp_str_array[] = '
' . $this->oCRNRSTN->html_version_burn('INTERACT UI SEARCH MODULE') . '
';

            }

            $tmp_str_array[] = '        <div id="crnrstn_interact_ui_messenger_src" class="crnrstn_hidden"></div>
        ';

            if($tmp_show_comments == true){

                $tmp_str_array[] = $this->oCRNRSTN->html_version_burn('INTERACT UI SEARCH MODULE', 'END') . '
';

            }

        }

        return $tmp_str_array;

    }

    private function return_output_CRNRSTN_CLIENT_SSDTLA_DEBUG(){

        $tmp_show_comments = $this->tidy_boolean(CRNRSTN_HTML_COMMENTS_SILENT_GOLD, CRNRSTN_BOOLEAN, CRNRSTN_ICY_BITMASK, 'crnrstn_html_comments_mode');
        // $tmp_show_comments = true;
        // if($this->oCRNRSTN->is_serialized_bit_set('crnrstn_html_comments_mode', CRNRSTN_HTML_COMMENTS_SILENT_GOLD) !== true){
        //     $tmp_show_comments = false;
        // }

        if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

            if($tmp_show_comments == true){

                $tmp_str_array[] = $this->oCRNRSTN->html_version_burn('INTERACT UI SSDTLA DEBUG');

            }

            $tmp_str_array[] = '<div id="crnrstn_client_ssdtla_debug_active"></div>';

            if($tmp_show_comments == true){

                $tmp_str_array[] = $this->oCRNRSTN->html_version_burn('INTERACT UI SSDTLA DEBUG', 'END');

            }

        }else{

            if($tmp_show_comments == true){

                $tmp_str_array[] = '
' . $this->oCRNRSTN->html_version_burn('INTERACT UI SSDTLA DEBUG') . '
';

            }

            $tmp_str_array[] = '<div id="crnrstn_client_ssdtla_debug_active"></div>';

            if($tmp_show_comments == true){

                $tmp_str_array[] = $this->oCRNRSTN->html_version_burn('INTERACT UI SSDTLA DEBUG', 'END') . '
';

            }

        }

        return $tmp_str_array;

    }

    public function return_sys_logging_profile(){

        return self::$sys_logging_profile_ARRAY;

    }

    public function return_sys_logging_meta(){

        return self::$sys_logging_meta_ARRAY;

    }

    private function _______return_file_path_user_class(){

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
        switch($WORDPRESS_debug_mode){
            case CRNRSTN_WORDPRESS_DEBUG:

                //$this->oCRNRSTN->retrieve_data_value($data_key, $data_type_family, $index);
                $this->oCRNRSTN->input_data_value($this->env_key, 'WORDPRESS_debug_mode', $WORDPRESS_debug_mode, '');

                $this->oCRNRSTN->toggle_bit(CRNRSTN_WORDPRESS_DEBUG);

            break;

        }

        if(!isset($this->oCRNRSTN_USR)){

            //$tmp_user_class_file_path = $this->return_file_path_user_class();
            //require($tmp_user_class_file_path);

            $this->oCRNRSTN_USR = new crnrstn_user($this->oCRNRSTN, $this);

        }

        if(!isset($this->oCRNRSTN->oCRNRSTN_TRM)){

            // THIS IS BOUND TO THIRD PARTY SERVICE ON CONSTRUCTION. BREAK DEPENDENCY BEFORE NEXT USE.
            // INSTANTIATE TUNNEL RESPONSE MANAGER
            //$this->oCRNRSTN->oCRNRSTN_TRM = new crnrstn_ui_tunnel_response_manager($this->oCRNRSTN);

        }

        return $this->oCRNRSTN_USR;

    }

    public function return_oCRNRSTN_USR(){

        return $this->oCRNRSTN_USR;

    }

    public function ssdtla_enabled(){

        return $this->oHTTP_MGR->ssdtla_enabled();

    }

    public function add_ssdtla_resource($data_key, $data_value, $data_type_family, $data_authorization_profile, $index, $ttl){

        switch($data_authorization_profile){
            case CRNRSTN_AUTHORIZE_SESSION:

                //
                // BASIC SESSION STORAGE
                $this->oCRNRSTN->oSESSION_MGR->add_ssdtla_resource($data_key, $data_value, $data_type_family, $data_authorization_profile, $index, $ttl);

            break;
            case CRNRSTN_AUTHORIZE_ALL:
            case CRNRSTN_AUTHORIZE_SESSION & CRNRSTN_AUTHORIZE_RUNTIME:

                //
                // BASIC SESSION STORAGE
                $this->oCRNRSTN->oSESSION_MGR->add_ssdtla_resource($data_key, $data_value, $data_type_family, $data_authorization_profile, $index, $ttl);

                //
                // BASIC RUNTIME STORAGE.
                $this->oCRNRSTN->add_resource($data_key, $data_value, $data_type_family, $data_authorization_profile, $index, $this->oCRNRSTN->return_env_key(), $ttl);

            break;
            default:

                // CRNRSTN_AUTHORIZE_RUNTIME
                //
                // BASIC RUNTIME STORAGE.
                $this->oCRNRSTN->add_resource($data_key, $data_value, $data_type_family, $data_authorization_profile, $index, $this->oCRNRSTN->return_env_key(), $ttl);

            break;

        }

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

    public function get_server_config_serial($output_format = 'raw'){

        return $this->oCRNRSTN->get_server_config_serial($output_format);

    }

    public function safe_getServerArrayVar($param, $oCRNRSTN_USR = NULL){

        if($this->isset_ServerArrayVar($param) == true){

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

        try{

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
                // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
                $oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            }else{

                //
                // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
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

                    $oCRNRSTN_oWCR_ARRAY = array();

                    //$this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('We have a file to include and process for the initialization of WordPress profiles authorized to connect to CRNRSTN :: [' . $this->soap_permissions_file_path_ARRAY[$this->config_serial_hash][$oCRNRSTN->hash(CRNRSTN_RESOURCE_ALL)][$key] . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                    include_once($wp_config_file_path);

                    $this->oCRNRSTN_WCR_ARRAY[$this->config_serial_hash][CRNRSTN_LOG_ALL][] = $oCRNRSTN_oWCR_ARRAY;

                }else{

                    error_log(__LINE__ . ' env NOT A WP CONFIG FILE [' . $wp_config_file_path . ']');

                }

            }

        }else{

            if(!!$oCRNRSTN->wp_config_file_path_ARRAY[$this->config_serial_hash][$this->env_key_hash]){

                foreach($oCRNRSTN->wp_config_file_path_ARRAY[$this->config_serial_hash][$this->env_key_hash] as $key => $wp_config_file_path){

                    if(is_file($wp_config_file_path)){

                        $oCRNRSTN_oWCR_ARRAY = array();

                        //
                        // EXTRACT PROFILE FROM FILE
                        $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('We have a file to include and process for the initialization of WordPress profiles authorized to connect to CRNRSTN :: [' . $this->soap_permissions_file_path_ARRAY[$this->config_serial_hash][$this->env_key_hash][$key] . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                        include_once($wp_config_file_path);

                        $this->oCRNRSTN_WCR_ARRAY[$this->config_serial_hash][CRNRSTN_LOG_ALL][] = $oCRNRSTN_oWCR_ARRAY;

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

                    $oCRNRSTN_oWCR_ARRAY = array();

                    //
                    // EXTRACT PROFILE FROM FILE
                    $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('We have a file to include and process for the initialization of analytics SEO profiles from the CRNRSTN :: configuration file [' . $oCRNRSTN->analytics_config_file_path_ARRAY[$this->config_serial_hash][$oCRNRSTN->hash(CRNRSTN_RESOURCE_ALL)][$key] . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                    include_once($analytics_config_file_path);

                    $this->oCRNRSTN_WCR_ARRAY[$this->config_serial_hash][CRNRSTN_LOG_ALL][] = $oCRNRSTN_oWCR_ARRAY;

                }else{

                    error_log(__LINE__ . ' env NOT AN ANALYTICS SEO CONFIG FILE [' . $analytics_config_file_path . ']');

                }

            }

        }else{

            if(!!$oCRNRSTN->analytics_config_file_path_ARRAY[$this->config_serial_hash][$this->env_key_hash]){

                foreach($oCRNRSTN->analytics_config_file_path_ARRAY[$this->config_serial_hash][$this->env_key_hash] as $key => $analytics_config_file_path){

                    if(is_file($analytics_config_file_path)){

                        $oCRNRSTN_oWCR_ARRAY = array();

                        //
                        // EXTRACT PROFILE FROM FILE
                        $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('We have a file to include and process for the initialization of analytics SEO profiles from the CRNRSTN :: configuration file [' . $oCRNRSTN->analytics_config_file_path_ARRAY[$this->config_serial_hash][$this->env_key_hash][$key] . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                        include_once($analytics_config_file_path);

                        $this->oCRNRSTN_WCR_ARRAY[$this->config_serial_hash][CRNRSTN_LOG_ALL][] = $oCRNRSTN_oWCR_ARRAY;

                    }else{

                        error_log(__LINE__ . ' env NOT AN ANALYTICS SEO CONFIG FILE [' . $analytics_config_file_path . ']');

                    }

                }

            }else{

                error_log(__LINE__ . ' env NO ANALYTICS SEO CONFIGURED.');

            }

        }

    }

    public function return_form_submitted_value($getpost_input_name, $transport_protocol = NULL){

        return $this->oHTTP_MGR->return_form_submitted_value($getpost_input_name, $transport_protocol);

    }

    public function return_crnrstn_data_packet($packet_type = CRNRSTN_CHANNEL_RUNTIME){

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

        //if($this->oCRNRSTN_USR->isset_query_result_set_key('CRNRSTN_SESSION_DATA')){
        if(1 == 1){

            error_log(__LINE__ . ' ui trans CRNRSTN_SESSION_DATA ' . __METHOD__ . ' die();');
            die();
            $tmp_session_count = $this->oCRNRSTN_USR->return_record_count('CRNRSTN_SESSION_DATA');

            if($tmp_session_count > 0){

                // crnrstn_sessions TABLE DATA
                $tmp_client_ip = $this->oCRNRSTN_USR->client_ip();
                $tmp_session_id = session_id();
                $tmp_SESSION_ID = $this->oCRNRSTN_USR->return_database_value('CRNRSTN_SESSION_DATA', 'SESSION_ID', 0, true);
                $tmp_SERVER_IP = $this->oCRNRSTN_USR->return_database_value('CRNRSTN_SESSION_DATA', 'SERVER_IP', 0, true);
                $tmp_CLIENT_ID = $this->oCRNRSTN_USR->return_database_value('CRNRSTN_SESSION_DATA', 'CLIENT_ID', 0, true);
                $tmp_CLIENT_IP = $this->oCRNRSTN_USR->return_database_value('CRNRSTN_SESSION_DATA', 'CLIENT_IP', 0, true);
                $tmp_CRNRSTN_SESSION_DATA_DATEMODIFIED = $this->oCRNRSTN_USR->return_database_value('CRNRSTN_SESSION_DATA', 'DATEMODIFIED', 0, true);
                $tmp_CRNRSTN_SESSION_DATA_DATECREATED = $this->oCRNRSTN_USR->return_database_value('CRNRSTN_SESSION_DATA', 'DATECREATED', 0, true);

            }else{

                error_log(__LINE__ . ' ui trans CRNRSTN_SESSION_DATA HAS NO SESSION DATA.');

                $tmp_client_id = $this->return_form_submitted_value('crnrstn_client_id');
                $ts_json = $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN->return_query_date_time_stamp());

                // crnrstn_sessions TABLE DATA
                $tmp_client_ip = $this->oCRNRSTN_USR->client_ip();
                $tmp_session_id = session_id();
                $tmp_SESSION_ID = $tmp_session_id;
                $tmp_SERVER_IP = $this->oCRNRSTN->return_clean_json_string($_SERVER['SERVER_ADDR']);
                $tmp_CLIENT_ID = $this->oCRNRSTN->return_clean_json_string($tmp_client_id);
                $tmp_CLIENT_IP = $this->oCRNRSTN->client_ip();
                $tmp_CRNRSTN_SESSION_DATA_DATEMODIFIED = $ts_json;
                $tmp_CRNRSTN_SESSION_DATA_DATECREATED = $ts_json;

            }

        }else{

            error_log(__LINE__ . ' ui trans CRNRSTN_SESSION_DATA isset_query_result_set IS NOT SET!');

            $tmp_client_id = $this->return_form_submitted_value('crnrstn_client_id');
            $ts_json = $this->oCRNRSTN->return_clean_json_string($this->oCRNRSTN->return_query_date_time_stamp());

            // crnrstn_sessions TABLE DATA
            $tmp_client_ip = $this->oCRNRSTN_USR->client_ip();
            $tmp_session_id = session_id();
            $tmp_SESSION_ID = $tmp_session_id;
            $tmp_SERVER_IP = $this->oCRNRSTN->return_clean_json_string($_SERVER['SERVER_ADDR']);
            $tmp_CLIENT_ID = $this->oCRNRSTN->return_clean_json_string($tmp_client_id);
            $tmp_CLIENT_IP = $this->oCRNRSTN_USR->client_ip();
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

        $tmp_CRNRSTN_ENVIRONMENTAL_RESOURCE_CONFIGURATION = $this->oCRNRSTN->oSESSION_MGR->return_session_oDDO_profile('pssdtl');

        $tmp_json_data = '';

        switch($packet_type){
            case 'crnrstn_session_json':

                //$tmp_crnrstn_session = $this->return_form_submitted_value('crnrstn_session');
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

        $this->oCRNRSTN->oSESSION_MGR->init_session();

        /*
        DATA HANDLING ARCHITECTURES
        -----
        G :: HTTP $_GET REQUEST.
        P :: HTTP $_POST REQUEST.
        H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).
        S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).
        J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
        C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR BROWSER COOKIE...
        D :: DATABASE (MySQLi CONNECTION).
        R :: RUNTIME.
        O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
        F :: SERVER LOCAL FILE SYSTEM.

        GPHSJCDROF

        */

        //
        // INITIALIZE CRNRSTN :: SOAP SERVICES DATA TUNNEL LAYER PACKET - GPHSJCDRO
        // NOTE: DATABASE DATA STORAGE FORMAT WILL SHADOW USE OF S01 AND P02
        // ON A SESSION TO SESSION BASIS.
        $tmp_pssdtl_session_packet = $this->return_crnrstn_data_packet(CRNRSTN_CHANNEL_PSSDTLA);

        error_log(__LINE__ . ' env ' . __METHOD__ . ' $tmp_pssdtl_session_packet::[' . $tmp_pssdtl_session_packet . '] die();');

        die();

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
        TODO :: SEE LINE 2196 USER :: return_interact_ui_profile() :: RETURN XML WITH CUSTOM NAV IDS FROM oENV

        oENV LINE 1219 :: return_output_CRNRSTN_UI_MESSENGER() OUTPUT BELOW FOR NOTES ON WHAT TO INITIALIZE...:
        <div id="crnrstn_interact_ui_primary_nav_menu" class="crnrstn_interact_ui_primary_navgroup_lnk_border">

            <div id="crnrstn_interact_ui_primary_nav_img_shell_menu_inactive" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MENU_INACTIVE', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MENU') . '"></div>
            <div id="crnrstn_interact_ui_primary_nav_img_shell_menu_hvr" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MENU_HOVER', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MENU') . '"></div>
            <div id="crnrstn_interact_ui_primary_nav_img_shell_menu_click" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MENU_CLICK', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MENU') . '"></div>
            <div id="crnrstn_interact_ui_primary_nav_img_shell_menu" class="crnrstn_interact_ui_primary_nav_img_shell crnrstn_interact_ui_active"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MENU', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MENU') . '"></div>
            <div id="crnrstn_interact_ui_primary_nav_img_shell_menu_glass_case" class="crnrstn_interact_ui_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseout\', this);" onmousedown="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmousedown\', this);" onmouseup="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseup\', this);"><img src="' . $this->oCRNRSTN->return_creative('TRANSPARENT_1X1', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MENU') . '"></div>

        </div>

        <div id="crnrstn_interact_ui_primary_nav_close_x" class="crnrstn_interact_ui_primary_navgroup_lnk_border">

            <div id="crnrstn_interact_ui_primary_nav_img_shell_close_x_inactive" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_CLOSE_X_INACTIVE', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->multi_lang_content_return('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div>
            <div id="crnrstn_interact_ui_primary_nav_img_shell_close_x_hvr" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_CLOSE_X_HOVER', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->multi_lang_content_return('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div>
            <div id="crnrstn_interact_ui_primary_nav_img_shell_close_x_click" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_CLOSE_X_CLICK', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->multi_lang_content_return('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div>
            <div id="crnrstn_interact_ui_primary_nav_img_shell_close_x" class="crnrstn_interact_ui_primary_nav_img_shell crnrstn_interact_ui_active"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_CLOSE_X', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->multi_lang_content_return('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div>
            <div id="crnrstn_interact_ui_primary_nav_img_shell_close_x_glass_case" class="crnrstn_interact_ui_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseout\', this);" onmousedown="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmousedown\', this);" onmouseup="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseup\', this);"><img src="' . $this->oCRNRSTN->return_creative('TRANSPARENT_1X1', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div>

        </div>

        <div id="crnrstn_interact_ui_primary_nav_fs_expand" class="crnrstn_interact_ui_primary_navgroup_lnk_border">

            <div id="crnrstn_interact_ui_primary_nav_img_shell_fs_expand_inactive" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_INACTIVE', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div>
            <div id="crnrstn_interact_ui_primary_nav_img_shell_fs_expand_hvr" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_HOVER', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div>
            <div id="crnrstn_interact_ui_primary_nav_img_shell_fs_expand_click" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_CLICK', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div>
            <div id="crnrstn_interact_ui_primary_nav_img_shell_fs_expand" class="crnrstn_interact_ui_primary_nav_img_shell crnrstn_interact_ui_active"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div>
            <div id="crnrstn_interact_ui_primary_nav_img_shell_fs_expand_glass_case" class="crnrstn_interact_ui_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseout\', this);" onmousedown="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmousedown\', this);" onmouseup="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseup\', this);"><img src="' . $this->oCRNRSTN->return_creative('TRANSPARENT_1X1', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div>

        </div>

        <div id="crnrstn_interact_ui_primary_nav_minimize" class="crnrstn_interact_ui_primary_navgroup_lnk_border">

            <div id="crnrstn_interact_ui_primary_nav_img_shell_minimize_inactive" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE_INACTIVE', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MINIMIZE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MINIMIZE') . '"></div>
            <div id="crnrstn_interact_ui_primary_nav_img_shell_minimize_hvr" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE_HOVER', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MINIMIZE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MINIMIZE') . '"></div>
            <div id="crnrstn_interact_ui_primary_nav_img_shell_minimize_click" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE_CLICK', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MINIMIZE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MINIMIZE') . '"></div>
            <div id="crnrstn_interact_ui_primary_nav_img_shell_minimize" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MINIMIZE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MINIMIZE') . '"></div>
            <div id="crnrstn_interact_ui_primary_nav_img_shell_minimize_fivedev_sm" class="crnrstn_interact_ui_primary_nav_img_shell crnrstn_interact_ui_active"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV_SMALL', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FIVEDEV') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FIVEDEV') . '"></div>
            <div id="crnrstn_interact_ui_primary_nav_img_shell_minimize_glass_case" class="crnrstn_interact_ui_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseout\', this);" onmousedown="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmousedown\', this);" onmouseup="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseup\', this);"><img src="' . $this->oCRNRSTN->return_creative('TRANSPARENT_1X1', CRNRSTN_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FIVEDEV') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FIVEDEV') . '"></div>

        </div>


        */

    }

    private function init_engagement_config($oCRNRSTN){

        if(!!$oCRNRSTN->engagement_config_file_path_ARRAY[$this->config_serial_hash][$oCRNRSTN->hash(CRNRSTN_RESOURCE_ALL)]){

            foreach($oCRNRSTN->engagement_config_file_path_ARRAY[$this->config_serial_hash][$oCRNRSTN->hash(CRNRSTN_RESOURCE_ALL)] as $key => $engagement_config_file_path){

                if(is_file($engagement_config_file_path)){

                    $oCRNRSTN_oWCR_ARRAY = array();

                    //
                    // EXTRACT ACCESS-BY-IP AUTHORIZATION PROFILE FROM FILE
                    $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('We have a file to include and process for the initialization of engagement tag profiles from the CRNRSTN :: configuration file [' . $oCRNRSTN->engagement_config_file_path_ARRAY[$this->config_serial_hash][$oCRNRSTN->hash(CRNRSTN_RESOURCE_ALL)][$key] . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                    include_once($engagement_config_file_path);

                    $this->oCRNRSTN_WCR_ARRAY[$this->config_serial_hash][CRNRSTN_LOG_ALL][] = $oCRNRSTN_oWCR_ARRAY;

                }else{

                    error_log(__LINE__ . ' env NOT AN ENGAGEMENT TRACKING CONFIG FILE [' . $engagement_config_file_path . ']');

                }

            }

        }else{

            if(!!$oCRNRSTN->engagement_config_file_path_ARRAY[$this->config_serial_hash][$this->env_key_hash]){

                foreach($oCRNRSTN->engagement_config_file_path_ARRAY[$this->config_serial_hash][$this->env_key_hash] as $key => $engagement_config_file_path){

                    if(is_file($engagement_config_file_path)){

                        $oCRNRSTN_oWCR_ARRAY = array();

                        //
                        // EXTRACT ACCESS-BY-IP AUTHORIZATION PROFILE FROM FILE
                        $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('We have a file to include and process for the initialization of engagement tag profiles from the CRNRSTN :: configuration file [' . $oCRNRSTN->engagement_config_file_path_ARRAY[$this->config_serial_hash][$this->env_key_hash][$key] . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                        include_once($engagement_config_file_path);

                        $this->oCRNRSTN_WCR_ARRAY[$this->config_serial_hash][CRNRSTN_LOG_ALL][] = $oCRNRSTN_oWCR_ARRAY;

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

        foreach($this->oSOAP_services_oAuth_manager as $serial => $SOAP_oAuth){

            if($SOAP_oAuth->services_authorization_group_key == $services_authorization_group_key){

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

        foreach($this->oSOAP_services_oClient_manager as $serial => $SOAP_oClient){

            if($SOAP_oClient->services_client_group_key == $services_client_group_key){

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

        foreach($this->oSOAP_services_oClient_manager as $serial => $SOAP_oClient){

            if($SOAP_oClient->services_client_group_key == $services_client_group_key){

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

        foreach($this->oSOAP_services_oClient_manager as $serial => $SOAP_oClient){

            if($SOAP_oClient->services_client_group_key == $services_client_group_key){

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

        foreach($this->oSOAP_services_oAuth_manager as $serial => $SOAP_oAuth){

            if($SOAP_oAuth->services_authorization_group_key == $services_authorization_group_key){

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

        foreach($this->oSOAP_services_oClient_manager as $serial => $SOAP_oClient){

            if($SOAP_oClient->services_client_group_key == $services_client_group_key){

                if($SOAP_oClient->serial != $origin_oClient_serial){

                    $SOAP_oClient->sync_IP_denyAccess($ip);
                }

            }

            $tmp_array[$serial] = $SOAP_oClient;

        }

        $this->oSOAP_services_oClient_manager = $tmp_array;

    }

    public function update_SOAP_services_oAuth_IP_exclusiveAccess($origin_oAuth_serial, $services_authorization_group_key, $ip){

        $tmp_array = array();

        foreach($this->oSOAP_services_oAuth_manager as $serial => $SOAP_oAuth){

            if($SOAP_oAuth->services_authorization_group_key == $services_authorization_group_key){

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

        foreach($this->oSOAP_services_oClient_manager as $serial => $SOAP_oClient){

            if($SOAP_oClient->services_client_group_key == $services_client_group_key){

                if($serial != $origin_oClient_serial){

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
            if($oSOAP_svc_mgr->isAuthorized_oAuth($CRNRSTN_SOAP_SVC_AUTH_KEY, $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES) == true){

                $AUTHORIZATION_GRANTED_oAUTH = true;

            }

            error_log(__LINE__ . ' env - RUN isAuthorized_oClient()...');
            if($oSOAP_svc_mgr->isAuthorized_oClient($USERNAME, $PASSWORD, $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES, $CRNRSTN_SOAP_SVC_METHOD_REQUESTED, $CRNRSTN_SOAP_ACTION_TYPE) == true){

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
            foreach(self::$system_resource_constants_ARRAY as $key => $integer_constant){

                //
                // LET'S TRY THIS. OTHERWISE WE HAVE TO READ() AND THEN TOGGLE() IF TRUE.
                $this->oCRNRSTN->initialize_bit($integer_constant, false);

            }

            //
            // RETRIEVE LOGGING PROFILE DATA FROM CRNRSTN ::
            self::$sys_logging_profile_ARRAY = $oCRNRSTN->return_logging_profile($this->env_key_hash);
            self::$sys_logging_meta_ARRAY = $oCRNRSTN->return_logging_meta($this->env_key_hash);

            //
            // SESSION DRIVEN RRS MAP ASSET RETURNS (E.G. IMAGE FROM A LINK) HAPPEN BEFORE LOGGING CONFIGURATION. THE
            // ENV CLASS OBJECT INSTANTIATION (USED FOR BUILDING RESPONSE HEADER) EXPOSES THIS MISSING CONFIG DATA.
            // WE MAY NOT HAVE AN ARRAY.
            // Thursday, March 23, 2023 @ 2328 hrs
            if(is_array(self::$sys_logging_profile_ARRAY)){

                //
                // FLIP BITWISE DATA FOR LOGGING PROFILE
                foreach(self::$sys_logging_profile_ARRAY as $key => $int_const_profile){

                //     //
                //     // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                //     // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                //     // # # C # R # N # R # S # T # N # : : # # # #
                //     // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                //     $this->oCRNRSTN->initialize_bit($int_const_profile, true);
                    $this->oCRNRSTN->error_log('CRNRSTN :: LOGGING PROFILE [' . strval($int_const_profile) . '] INIT BY-PASS FIRED - CRNRSTN ICY_BITMASK LOG PROFILE INITIALIZATION. ' . __METHOD__ . ' called. [rtime ' . $this->wall_time() . ' secs]', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                }



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

        if(isset($oCRNRSTN->env_err_reporting_profile_ARRAY[$this->config_serial_hash][$this->env_key_hash])){
        //if($oCRNRSTN->isset_resource('data_value', 'err_reporting_profile', 'CRNRSTN::RESOURCE::CONFIGURATION') == true){

            $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('Initialize server error_reporting() to [' . $oCRNRSTN->env_err_reporting_profile_ARRAY[$this->config_serial_hash][$this->env_key_hash] . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
            error_reporting((int) $oCRNRSTN->env_err_reporting_profile_ARRAY[$this->config_serial_hash][$this->env_key_hash]);

            //$tmp_int = $oCRNRSTN->get_resource('err_reporting_profile', 0, 'CRNRSTN::RESOURCE::CONFIGURATION');
            //$this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('Initialize server error_reporting() to [' . $tmp_int . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
            //error_reporting((int) $tmp_int);

        }

    }

    private function initExclusiveAccess($oCRNRSTN){

        //
        // PROCESS IP ADDRESS ACCESS AND RESTRICTION FOR SELECTED ENVIRONMENT
        if(is_file($oCRNRSTN->grant_accessIP_ARRAY[$this->config_serial_hash][$this->env_key_hash])){

            //
            // EXTRACT ACCESS-BY-IP AUTHORIZATION PROFILE FROM FILE.
            $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('We have a file to include and process for exclusive access IP restrictions at [' . $oCRNRSTN->grant_accessIP_ARRAY[$this->config_serial_hash][$this->env_key_hash] . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
            include_once($oCRNRSTN->grant_accessIP_ARRAY[$this->config_serial_hash][$this->env_key_hash]);

        }else{

            //
            // DO WE HAVE ANY IP DATA TO PROCESS?
            if($oCRNRSTN->grant_accessIP_ARRAY[$this->config_serial_hash][$this->env_key_hash] != ''){

                $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('Process grant exclusive access IP[' . $oCRNRSTN->grant_accessIP_ARRAY[$this->config_serial_hash][$this->env_key_hash] . '] for this connection.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
                $this->oCRNRSTN->oCRNRSTN_IPSECURITY_MGR->grantAccessWKey($this->env_key_hash, $oCRNRSTN->grant_accessIP_ARRAY[$this->config_serial_hash][$this->env_key_hash]);

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
                $this->oCRNRSTN->oCRNRSTN_IPSECURITY_MGR->denyAccessWKey($this->env_key_hash, $oCRNRSTN->deny_accessIP_ARRAY[$this->config_serial_hash][$this->env_key_hash]);

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

        return $this->oCRNRSTN->is_bit_set($encryption_channel);

    }

    private function return_data_encrypted($data, $encryption_channel, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override){

        try{

            $this->total_bytes_encrypted += strlen($data);

            switch($encryption_channel){
                case CRNRSTN_ENCRYPT_TUNNEL:

                    $data_type_family = 'CRNRSTN::RESOURCE::TUNNEL_ENCRYPTION';

                break;
                case CRNRSTN_ENCRYPT_DATABASE:

                    $data_type_family = 'CRNRSTN::RESOURCE::DATABASE_ENCRYPTION';

                break;
                case CRNRSTN_ENCRYPT_SESSION:

                    $data_type_family = 'CRNRSTN::RESOURCE::SESSION_ENCRYPTION';

                break;
                case CRNRSTN_ENCRYPT_COOKIE:

                    $data_type_family = 'CRNRSTN::RESOURCE::COOKIE_ENCRYPTION';

                break;
                case CRNRSTN_ENCRYPT_SOAP:

                    $data_type_family = 'CRNRSTN::RESOURCE::SOAP_ENCRYPTION';

                break;
                case CRNRSTN_ENCRYPT_OERSL:

                    $data_type_family = 'CRNRSTN::RESOURCE::OERSL_ENCRYPTION';

                break;
                default:
                    //
                    // CRNRSTN_ENCRYPT_TUNNEL

                    //
                    // RETRIEVE DATA
                    // self::$oCRNRSTN_CONFIG_MGR->input_data_value($encrypt_cipher, 'encrypt_cipher','CRNRSTN::RESOURCE::TUNNEL_ENCRYPTION',NULL,CRNRSTN_AUTHORIZE_RUNTIME, $env_key);
                    $data_type_family = 'CRNRSTN::RESOURCE::TUNNEL_ENCRYPTION';
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
                    $secret_key = openssl_digest($secret_key, self::$openssl_digest_profile_ARRAY[$data_type_family]['openssl_digest'], true);

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
                    $secret_key = openssl_digest($secret_key, self::$openssl_digest_profile_ARRAY[$data_type_family]['openssl_digest'], true);

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

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return NULL;

        }

    }

    private function return_data_decrypted($data, $encryption_channel, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override){

        try{

            switch($encryption_channel){
                case CRNRSTN_ENCRYPT_TUNNEL:

                    $data_type_family = 'CRNRSTN::RESOURCE::TUNNEL_ENCRYPTION';

                break;
                case CRNRSTN_ENCRYPT_DATABASE:

                    $data_type_family = 'CRNRSTN::RESOURCE::DATABASE_ENCRYPTION';

                break;
                case CRNRSTN_ENCRYPT_SESSION:

                    $data_type_family = 'CRNRSTN::RESOURCE::SESSION_ENCRYPTION';

                break;
                case CRNRSTN_ENCRYPT_COOKIE:

                    $data_type_family = 'CRNRSTN::RESOURCE::COOKIE_ENCRYPTION';

                break;
                case CRNRSTN_ENCRYPT_SOAP:

                    $data_type_family = 'CRNRSTN::RESOURCE::SOAP_ENCRYPTION';

                break;
                case CRNRSTN_ENCRYPT_OERSL:

                    $data_type_family = 'CRNRSTN::RESOURCE::OERSL_ENCRYPTION';

                break;
                default:
                    //
                    // CRNRSTN_ENCRYPT_TUNNEL

                    //
                    // RETRIEVE DATA
                    // self::$oCRNRSTN_CONFIG_MGR->input_data_value($encrypt_cipher, 'encrypt_cipher','CRNRSTN::RESOURCE::TUNNEL_ENCRYPTION',NULL,CRNRSTN_AUTHORIZE_RUNTIME, $env_key);
                    $data_type_family = 'CRNRSTN::RESOURCE::TUNNEL_ENCRYPTION';
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
                    $secret_key = openssl_digest($secret_key, self::$openssl_digest_profile_ARRAY[$data_type_family]['openssl_digest'], true);

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
                    $secret_key = openssl_digest($secret_key, self::$openssl_digest_profile_ARRAY[$data_type_family]['openssl_digest'], true);

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

//                die();

                //
                // NO ENCRYPTION. RETURN VAL
                return $data;

            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return NULL;

        }

        return NULL;

    }

    public function data_encrypt($data = NULL, $encryption_channel = CRNRSTN_ENCRYPT_TUNNEL, $cipher_override = NULL, $secret_key_override = NULL, $hmac_algorithm_override = NULL, $options_bitwise_override = NULL){

        /*
        case CRNRSTN_ENCRYPT_OERSL:
        case CRNRSTN_ENCRYPT_GET:
        case CRNRSTN_ENCRYPT_POST:
        case CRNRSTN_ENCRYPT_DATABASE:
        case CRNRSTN_ENCRYPT_SESSION:
        case CRNRSTN_ENCRYPT_COOKIE:
        case CRNRSTN_ENCRYPT_SOAP:
        case CRNRSTN_ENCRYPT_TUNNEL:

        case 'encrypt_cipher':
        case 'encrypt_secret_key':
        case 'encrypt_options':
        case 'hmac_alg':
        case 'data_profile_ARRAY':
            // $tmp_data_profile_ARRAY['data_type_family'] = 'CRNRSTN::RESOURCE::TUNNEL_ENCRYPTION';
            // $tmp_data_profile_ARRAY['data_type_title'] = 'CRNRSTN :: TUNNEL';
            // $tmp_data_profile_ARRAY['data_type_encryption_channel'] = CRNRSTN_ENCRYPT_TUNNEL;

        $data_type_family = $this->return_encryption_data_type_family(CRNRSTN_ENCRYPT_DATABASE);

        //
        // CRNRSTN :: DECOUPLED DATA OBJECT (DDO) SERVICES LAYER.
        // # # C # R # N # R # S # T # N # : : # # # #
        // CRNRSTN :: UGC DATA INPUT [HASH ACCELERATION]
        $tmp_ = $this->add_resource($tmp_key, $tmp_hash_val, 'CRNRSTN::RESOURCE::HASH_ACCELERATION', CRNRSTN_AUTHORIZE_SESSION, 0);
        $tmp_ = $this->get_resource('err_reporting_profile', 0, 'CRNRSTN::RESOURCE::CONFIGURATION');
        $tmp_ = $this->get_resource_count('err_reporting_profile', 'CRNRSTN::RESOURCE::CONFIGURATION');
        if($this->isset_resource('data_value', 'err_reporting_profile', 'CRNRSTN::RESOURCE::CONFIGURATION') == true){}

        */

        try{

            if(isset($data)){

                //
                // DATA TYPE MUST BE ENCRYPTABLE...AND SAFE FOR URI
                //if(in_array(gettype($data), $this->encryptableDataTypes)){
                if(isset($this->encryptableDataTypes[gettype($data)])){

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

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
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

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return NULL;

        }

    }

    public function return_encrypt_settings($val, $encryption_channel = CRNRSTN_ENCRYPT_TUNNEL, $cipher_override = NULL, $secret_key_override = NULL, $hmac_algorithm_override = NULL, $options_bitwise_override = NULL){

        $tmp_settings_array = array();
        $tmp_settings_array['raw data length'] = strlen($val);

        switch($encryption_channel){
            case CRNRSTN_ENCRYPT_TUNNEL:

                $data_type_family = 'CRNRSTN::RESOURCE::TUNNEL_ENCRYPTION';

            break;
            case CRNRSTN_ENCRYPT_DATABASE:

                $data_type_family = 'CRNRSTN::RESOURCE::DATABASE_ENCRYPTION';

            break;
            case CRNRSTN_ENCRYPT_SESSION:

                $data_type_family = 'CRNRSTN::RESOURCE::SESSION_ENCRYPTION';

            break;
            case CRNRSTN_ENCRYPT_COOKIE:

                $data_type_family = 'CRNRSTN::RESOURCE::COOKIE_ENCRYPTION';

            break;
            case CRNRSTN_ENCRYPT_SOAP:

                $data_type_family = 'CRNRSTN::RESOURCE::SOAP_ENCRYPTION';

                break;
            case CRNRSTN_ENCRYPT_OERSL:

                $data_type_family = 'CRNRSTN::RESOURCE::OERSL_ENCRYPTION';

            break;
            default:
                //
                // CRNRSTN_ENCRYPT_TUNNEL

                //
                // RETRIEVE DATA
                // self::$oCRNRSTN_CONFIG_MGR->input_data_value($encrypt_cipher, 'encrypt_cipher','CRNRSTN::RESOURCE::TUNNEL_ENCRYPTION',NULL,CRNRSTN_AUTHORIZE_RUNTIME, $env_key);
                $data_type_family = 'CRNRSTN::RESOURCE::TUNNEL_ENCRYPTION';
                $this->error_log('Unknown encryption channel constant provided to ' . __METHOD__ .'. Tunnel encryption profile has been applied.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

            break;

        }

        $tmp_encrypt_cipher = $this->oCRNRSTN->get_resource('encrypt_cipher', 0, $data_type_family);

        if(isset($cipher_override) || $tmp_encrypt_cipher != ''){

            //
            // RETRIEVE DATA FROM THE CRNRSTN :: DECOUPLED DATA OBJECT (DDO).
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
                $secret_key = openssl_digest($secret_key, self::$openssl_digest_profile_ARRAY[$data_type_family]['openssl_digest'], true);

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

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
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

                $data_type_family = 'CRNRSTN::RESOURCE::TUNNEL_ENCRYPTION';

            break;
            case CRNRSTN_ENCRYPT_DATABASE:

                $data_type_family = 'CRNRSTN::RESOURCE::DATABASE_ENCRYPTION';

            break;
            case CRNRSTN_ENCRYPT_SESSION:

                $data_type_family = 'CRNRSTN::RESOURCE::SESSION_ENCRYPTION';

            break;
            case CRNRSTN_ENCRYPT_COOKIE:

                $data_type_family = 'CRNRSTN::RESOURCE::COOKIE_ENCRYPTION';

            break;
            case CRNRSTN_ENCRYPT_SOAP:

                $data_type_family = 'CRNRSTN::RESOURCE::SOAP_ENCRYPTION';

            break;
            case CRNRSTN_ENCRYPT_OERSL:

                $data_type_family = 'CRNRSTN::RESOURCE::OERSL_ENCRYPTION';

            break;
            default:
                //
                // CRNRSTN_ENCRYPT_TUNNEL

                //
                // RETRIEVE DATA
                // self::$oCRNRSTN_CONFIG_MGR->input_data_value($encrypt_cipher, 'encrypt_cipher','CRNRSTN::RESOURCE::TUNNEL_ENCRYPTION',NULL,CRNRSTN_AUTHORIZE_RUNTIME, $env_key);
                $data_type_family = 'CRNRSTN::RESOURCE::TUNNEL_ENCRYPTION';
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
                $secret_key = openssl_digest($secret_key, self::$openssl_digest_profile_ARRAY[$data_type_family]['openssl_digest'], true);

            }

            $encrypt_profile_array['digest'] = self::$openssl_digest_profile_ARRAY[$data_type_family]['openssl_digest'];
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

            if(hash_equals($hmac, $calcmac))//PHP 5.6+ timing attack safe comparison
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

    public function proper_response_return($response, $header_options_array, $crnrstn_response_profile_key){

        return $this->oHTTP_MGR->proper_response_return($response, $header_options_array, $crnrstn_response_profile_key);

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

        $oCRNRSTN_oWCR_ARRAY = array();

        try{

            if(is_file($this->wildCardResource_filePath)){

                //
                // INITIALIZE WILDCARD RESOURCES
                $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('Storing initialized Wild Card Resources at [' . $this->wildCardResource_filePath . '] in memory for this environment [' . $this->env_key_hash . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                include_once($this->wildCardResource_filePath);

                $this->oCRNRSTN_WCR_ARRAY[$this->config_serial_hash][CRNRSTN_LOG_ALL][] = $oCRNRSTN_oWCR_ARRAY;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('CRNRSTN :: wildcard resource file cannot be loaded, because it [' . $this->wildCardResource_filePath . '] is not a file.');

            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return NULL;

    }

    public function return_server_response_code($response_code, $crnrstn_html_burn = NULL){

        $tmp_curr_headers_ARRAY = headers_list();
        $tmp_crnrstn_signature_headers_ARRAY = $this->header_signature_options_return();

        //
        // ENSURE ALL SIGNATURE HEADERS ARE IN PLACE AND CONTINUE
        $this->oHTTP_MGR->header_options_add($tmp_crnrstn_signature_headers_ARRAY);

        //
        // ADD PRE-EXISTING HEADER OPTIONS AFTER DEFAULT FOR OVERWRITE
        $this->oHTTP_MGR->header_options_add($tmp_curr_headers_ARRAY);

        $this->oHTTP_MGR->header_options_apply();

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
            header($_SERVER['SERVER_PROTOCOL'] . ' ' . $response_code . ' ' . $http_status_codes[$response_code]);
            exit();

        }

        header($_SERVER['SERVER_PROTOCOL'] . ' ' . $response_code . ' ' . $http_status_codes[$response_code]);

        $str = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    ' . $this->oCRNRSTN->return_creative('CRNRSTN_FAVICON', CRNRSTN_FAVICON) . '
    <title>' . $response_code . ' ' . $http_status_codes[$response_code] . '</title>
</head>
<body style="background-color: #FFF; width:100%; text-align: left; margin:0px auto;">
<div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px; border-bottom: 2px solid #F90000;"></div>
<div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px; border-bottom: 1px solid #DB1717;"></div>

<div style=\'width:96%; margin:0 0 0 0; padding:6px 2% 0 2%; color:#FFF; font-family:"trebuchet MS", Verdana, sans-serif;background-color:#BEBEBE; height:30px; line-height: 28px;\'><h1 style="font-size: 30px; overflow: hidden; height:23px; padding-top:7px; margin-top: 0;">Server Error</h1></div>
<div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px; border-top: 2px solid #FFF;"></div>

<div style="height:5px; ' . $this->oCRNRSTN->return_creative('BG_ELEMENT_RESPONSE_CODE', CRNRSTN_BASE64) . ' background-repeat: repeat-x;">
    <div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px;"></div>
</div>

<div style="padding:100px 0 300px 100px; float:left; font-family:arial; font-weight:bold; font-size:11px;">' . $response_code . ' ' . $http_status_codes[$response_code] . '</div>
<!--
<div style="position:absolute; padding:200px 0 0 10px; float:left;"><pre>

' . $crnrstn_html_burn . '

</pre></div>
-->
<div style="padding:16px 2% 0 0; float:right; width:260px;">
    <div style="float:right; ">
        ' . $this->return_component_branding_creative(true, CRNRSTN_HTML & CRNRSTN_ASSET_MODE_BASE64) . '
    </div>
</div>

<div style="float:right; padding:420px 0 0 0; margin:0; width:100%;">
    <div style="position: absolute; width:100%; text-align: right; /*background-color: #FFF;*/ padding-top: 20px;">
        ' . $this->oCRNRSTN->return_creative('J5_WOLF_PUP_RAND') . '
    </div>
</div>

<div style="height:0; width:100%; clear:both; display: block; overflow: hidden;"></div>

</body>
</html>';

        echo $str;

        exit();

    }

    public function get_resource_count($data_key, $data_type_family, $env_key){

        return $this->oCRNRSTN->get_resource_count($data_key, $data_type_family, $env_key);

    }

    public function retrieve_data_value($data_key, $data_type_family = 'CRNRSTN::RESOURCE', $index = NULL, $env_key = NULL, $soap_transport = false){

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

                if(isset($this->oCRNRSTN_WCR_ARRAY[$this->config_serial_hash][CRNRSTN_LOG_ALL])){

                    $tmp_oWCR_ARRAY = $this->oCRNRSTN_WCR_ARRAY[$this->config_serial_hash][CRNRSTN_LOG_ALL];

                    foreach($tmp_oWCR_ARRAY as $key => $oWCR){

                        if(isset($oWCR[$wildCardKey])){

                            //error_log(__LINE__ . ' env WE HAVE A SET WCR KEY IN OBJ_ARRAY $wildCardKey=' . $wildCardKey);
                            $oWCR = $oWCR[$wildCardKey];

                            $tmp_oDDO = $oWCR->get_attribute($wildCardKey, $paramName, $soap_transport);

                            //
                            //'CRNRSTN_STRING','CRNRSTN_INT', 'CRNRSTN_INTEGER', 'CRNRSTN_BOOL',
                            //'CRNRSTN_BOOLEAN','CRNRSTN_FLOAT', 'CRNRSTN_DOUBLE', 'CRNRSTN_ARRAY',
                            //'CRNRSTN_OBJECT', 'CRNRSTN_RESOURCE',
                            //'CRNRSTN_RESOURCE_CLOSED', 'CRNRSTN_UNKNOWN_TYPE', 'CRNRSTN_NULL',
                            //
                            //$tmp_data_type_ARRAY = $this->gettype($url, CRNRSTN_ARRAY);
                            //switch($tmp_data_type_ARRAY[CRNRSTN_INTEGER]){}
                            //
                            //if(($tmp_data_type_ARRAY[CRNRSTN_INTEGER] == CRNRSTN_BOOLEAN) || ($tmp_data_type_ARRAY[CRNRSTN_INTEGER] == CRNRSTN_BOOL)){
                            // strings 'true' or 'false'
                            //if(is_bool($data_value) === true){
                            //
                            error_log(__LINE__ . ' ddo CHECK THAT THIS IS INTEGER PROCESSING OF CRNRSTN :: DDO DATA. TYPE[' . strval($tmp_oDDO->preach('type', $paramName)) . ']. die();');
                            die();

                            switch($tmp_oDDO->preach('type', $paramName)){
                                case CRNRSTN_INT:

                                    return (int) $tmp_oDDO->preach('data_value', $paramName);

                                break;
                                case CRNRSTN_INTEGER:

                                    return (integer) $tmp_oDDO->preach('data_value', $paramName);

                                break;
                                case CRNRSTN_BOOL:

                                    if($soap_transport == true){

                                        return $tmp_oDDO->preach('data_value', $paramName);

                                    }else{

                                        return $this->boolean_conversion($tmp_oDDO->preach('data_value', $paramName));

                                    }

                                break;
                                case CRNRSTN_BOOLEAN:

                                    if($soap_transport == true){

                                        return $tmp_oDDO->preach('data_value', $paramName);

                                    }else{

                                        return $this->boolean_conversion($tmp_oDDO->preach('data_value', $paramName));

                                    }

                                break;
                                case CRNRSTN_FLOAT:

                                    return (float) $tmp_oDDO->preach('data_value', $paramName);

                                break;
                                case CRNRSTN_DOUBLE:

                                    return (double) $tmp_oDDO->preach('data_value', $paramName);

                                break;
                                case CRNRSTN_RESOURCE:

                                    //
                                    // TODO :: IS THIS THE BEST OUTPUT? NO CAST...?
                                    // Wednesday, November 15, 2023 @ 0628 hrs.
                                    return $tmp_oDDO->preach('data_value', $paramName);

                                break;
                                case CRNRSTN_RESOURCE_CLOSED:

                                    //
                                    // TODO :: IS THIS THE BEST OUTPUT? NO CAST...?
                                    // Wednesday, November 15, 2023 @ 0629 hrs.
                                    return $tmp_oDDO->preach('data_value', $paramName);

                                break;
                                case CRNRSTN_STRING:

                                    return (string) $tmp_oDDO->preach('data_value', $paramName);

                                break;
                                case CRNRSTN_ARRAY:

                                    return (array) $tmp_oDDO->preach('data_value', $paramName);

                                break;
                                case CRNRSTN_OBJECT:

                                    return (object) $tmp_oDDO->preach('data_value', $paramName);

                                break;
                                case CRNRSTN_NULL:

                                    return NULL;

                                break;
                                default:

                                    return $tmp_oDDO->preach('data_value', $paramName);

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
//                        if($tmp_oWCR->isset_WCR($wildCardKey, $paramName)){
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
//                                    return (int) $tmp_oDDO->preach('data_value', $paramName);
//
//                                break;
//                                case 'integer':
//
//                                    return (integer) $tmp_oDDO->preach('data_value', $paramName);
//
//                                break;
//                                case 'bool':
//
//                                    if($soap_transport){
//
//                                        return $tmp_oDDO->preach('data_value', $paramName);
//
//                                    }else{
//
//                                        return $this->boolean_conversion($tmp_oDDO->preach('data_value', $paramName));
//
//                                    }
//
//                                break;
//                                case 'boolean':
//
//                                    if($soap_transport){
//
//                                        return $tmp_oDDO->preach('data_value', $paramName);
//
//                                    }else{
//
//                                        return $this->boolean_conversion($tmp_oDDO->preach('data_value', $paramName));
//
//                                    }
//
//                                break;
//                                case 'float':
//
//                                    return (float) $tmp_oDDO->preach('data_value', $paramName);
//
//                                break;
//                                case 'double':
//
//                                    return (double) $tmp_oDDO->preach('data_value', $paramName);
//
//                                break;
//                                case 'real':
//
//                                    return (float) $tmp_oDDO->preach('data_value', $paramName);
//
//                                break;
//                                case 'string':
//
//                                    return (string) $tmp_oDDO->preach('data_value', $paramName);
//
//                                break;
//                                case 'array':
//
//                                    return (array) $tmp_oDDO->preach('data_value', $paramName);
//
//                                break;
//                                case 'object':
//
//                                    return (object) $tmp_oDDO->preach('data_value', $paramName);
//
//                                break;
//                                case 'NULL':
//
//                                    return NULL;
//
//                                break;
//                                default:
//
//                                    return $tmp_oDDO->preach('data_value', $paramName);
//
//                                break;
//
//                            }
//
//                        }else{
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

                    self::$sess_env_param_ARRAY[$paramName] = $this->oCRNRSTN->oSESSION_MGR->get_session_param($paramName, $soap_transport);

                }

                return self::$sess_env_param_ARRAY[$paramName];

            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function openssl_get_md_methods($exclude_weak = true, $exclude_ecb = true){

        $digests             = openssl_get_md_methods();
        $digests_and_aliases = openssl_get_md_methods(true);
        $digest_aliases      = array_diff($digests_and_aliases, $digests);

        if($exclude_ecb === true){

            //
            // ECB MODE SHOULD BE AVOIDED
            $digests = array_filter($digests, function($n){ return stripos($n, 'ecb') === FALSE; });

        }

        if($exclude_weak === true){

            //
            // AT LEAST AS EARLY AS AUG 2016, OPENSSL DECLARED THE FOLLOWING WEAK: RC2, RC4, DES, 3DES, MD5 based
            $digests = array_filter($digests, function($c){ return stripos($c, 'des') === FALSE; });
            $digests = array_filter($digests, function($c){ return stripos($c, 'rc2') === FALSE; });
            $digests = array_filter($digests, function($c){ return stripos($c, 'rc4') === FALSE; });
            $digests = array_filter($digests, function($c){ return stripos($c, 'md5') === FALSE; });
            $digest_aliases = array_filter($digest_aliases, function($c){ return stripos($c, 'des') === FALSE; });
            $digest_aliases = array_filter($digest_aliases, function($c){ return stripos($c, 'rc2') === FALSE; });

        }

        $merged_ciphers = array_merge($digests, $digest_aliases);

        return $merged_ciphers;

    }

    /**
    * @see http://php.net/manual/en/function.openssl-encrypt.php
    * @see https://www.php.net/manual/en/function.openssl-get-cipher-methods.php
    */
    public function openssl_get_cipher_methods($exclude_weak = true, $exclude_ecb = true){

        $ciphers             = openssl_get_cipher_methods();
        $ciphers_and_aliases = openssl_get_cipher_methods(true);
        $cipher_aliases      = array_diff($ciphers_and_aliases, $ciphers);

        if($exclude_ecb === true){

            //
            // ECB MODE SHOULD BE AVOIDED
            $ciphers = array_filter($ciphers, function($n){ return stripos($n, 'ecb') === FALSE; });

        }

        if($exclude_weak === true){

            //
            // AT LEAST AS EARLY AS AUG 2016, OPENSSL DECLARED THE FOLLOWING WEAK: RC2, RC4, DES, 3DES, MD5 based
            $ciphers = array_filter($ciphers, function($c){ return stripos($c, 'des') === FALSE; });
            $ciphers = array_filter($ciphers, function($c){ return stripos($c, 'rc2') === FALSE; });
            $ciphers = array_filter($ciphers, function($c){ return stripos($c, 'rc4') === FALSE; });
            $ciphers = array_filter($ciphers, function($c){ return stripos($c, 'md5') === FALSE; });
            $cipher_aliases = array_filter($cipher_aliases, function($c){ return stripos($c, 'des') === FALSE; });
            $cipher_aliases = array_filter($cipher_aliases, function($c){ return stripos($c, 'rc2') === FALSE; });

        }

        $merged_ciphers = array_merge($ciphers, $cipher_aliases);

        return $merged_ciphers;

    }

    public function return_micro_time(){

        return $this->oLogger->returnMicroTime();

    }

    public function wall_time(){

        $timediff = $this->microtime_float() - $this->starttime;

        return substr($timediff,0,-8);

    }

    public function elapsed_delta_time($watch_key, $decimal = 8){

        return $this->oCRNRSTN->elapsed_delta_time($watch_key, $decimal);

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

                    if(!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'){

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
    // SOURCE :: https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
    // COMMENT :: https://stackoverflow.com/a/13733588
    // AUTHOR :: Scott :: https://stackoverflow.com/users/1698153/scott
    public function generate_new_key($len = 32, $char_selection = NULL){

        //
        // SEND -1 AS $char_selection FOR USE OF *ALL* CHARACTERS IN RANDOM KEY
        // GENERATION...ALL EXCEPT THE SEQUENCE \e ESCAPE KEY (ESC or 0x1B (27) in
        // ASCII) AND NOT SPLITTING HAIRS CHOOSING BETWEEN SEQUENCE \n LINEFEED (LF or
        // 0x0A (10) in ASCII) AND THE SEQUENCE \r CARRIAGE RETURN (CR or 0x0D
        // (13) in ASCII)...AND ALSO SCREW BOTH \f FORM FEED (FF or 0x0C (12)
        // in ASCII) AND \v VERTICAL TAB (VT or 0x0B (11) in ASCII) SEQUENCES.
        //
        // ALSO, CHECK OUT $char_selection=-2, AND $char_selection=-3.
        // $char_selection=-3 IS THE NICEST(NO: QUOTES, COMMAS,...ETC.)...WITH
        // THE MOST DISTINCT NUMBER OF CHARACTERS FOR A SERIAL, IMHO.
        //
        // https://www.php.net/manual/en/language.types.string.php#language.types.string.syntax.double

        return $this->oCRNRSTN->generate_new_key($len, $char_selection);

    }

    //
    // SOURCE :: Stack Overflow :: https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
    // COMMENT :: https://stackoverflow.com/a/13733588
    // AUTHOR :: https://stackoverflow.com/users/4895359/yumoji
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

            if($this->oCRNRSTN->is_serialized_bit_set($const_nom, $int_constant) == true){

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
        //$this->oCRNRSTN->set($integer_constant, true);

        $tmp_array = array();

        foreach($constants_int_ARRAY as $key => $int_constant){

            if($this->oCRNRSTN->is_bit_set($int_constant) == true){

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

        if($strip_formatting == true){

            if(self::$weighted_elements_keys_ARRAY[$tmp_int] == 'CRNRSTN ::'){

                $creative = '<div style="padding:4px 0 5px 5px; text-align:left; font-family: Courier New, Courier, monospace; font-size:11px;">C<span style="color:#F00;">R</span>NRSTN :: v' . $this->version_crnrstn() . '</div>';

            }else{

                error_log(__LINE__ . ' env ' . __METHOD__ . ' [img=' . self::$weighted_elements_keys_ARRAY[$tmp_int] . '][$output_mode=' . $output_mode . '].');
                //$creative = '<span style="font-family: Courier New, Courier, monospace; font-size:11px;">' . $this->oCRNRSTN->return_creative(self::$weighted_elements_keys_ARRAY[$tmp_int], $output_mode) . '</span>';
                $creative = $this->oCRNRSTN->return_creative(self::$weighted_elements_keys_ARRAY[$tmp_int], $output_mode);

            }

        }else{

            if(self::$weighted_elements_keys_ARRAY[$tmp_int] == 'CRNRSTN ::'){

                $creative = '<div style="float:left; padding:4px 0 5px 5px; text-align:left; font-family: Courier New, Courier, monospace; font-size:11px;">C<span style="color:#F00;">R</span>NRSTN :: v' . $this->version_crnrstn() . '</div>';

            }else{

                //error_log(__LINE__ . ' env ' . __METHOD__ . ' [img=' . self::$weighted_elements_keys_ARRAY[$tmp_int] . '][$output_mode=' . $output_mode . '].');
                $creative = '<div style="float:left; padding:4px 0 5px 5px; text-align:left; font-family: Courier New, Courier, monospace; font-size:11px;">' . $this->oCRNRSTN->return_creative(self::$weighted_elements_keys_ARRAY[$tmp_int], $output_mode) . '</div>';

            }

        }

        //die();
        return $creative;

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.base64-encode.php
    // AUTHOR :: luke at lukeoliff.com :: https://www.php.net/manual/en/function.base64-encode.php#105200
    public function base64_encode_image ($filename, $filetype){

        if(is_file($filename) || (is_string($filename) && $filename != '')){

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

    private function return_file_system_integrations_serial($http_path, $file_path, $data_authorization_profile, $ttl, $FILEPATH, $output_mode, $width, $height, $hyperlink, $alt, $title, $target){

        $tmp_serial = '';
        $tmp_integrations_meta_ARRAY = array();

        //
        // CRNRSTN :: INTEGRATIONS.
        // THE ORIGINAL ASSETS WILL NOT BE MOVED.
        // IN EFFECT, WE WILL SHARD POINTERS TO THE BASE64 SUPPORT SILO FOR EACH RESOURCE.
        // - BY RESOURCE FUNCTION: FAVICON, CSS, JS,...ETC.
        // - BY FILE TYPE: GIF, PNG, JPEG.
        // - CACHE META AND FILE SYSTEM DETAILS FOR THE RESOURCE.
        //
        // THIS IS A HIGH-LEVEL FIRST PASS AT INTEGER DRIVEN SYSTEM INTEGRATIONS
        // CONFIGURATION. INTERANALLY, THERE WILL NEED TO BE KINDNESS...IN THE
        // FORM OF MORE DELICATE MIMETYPE DETECTION AND A SHIFT OR "RE-ROUTING"
        // AT WRITE.
        switch($output_mode){
            case CRNRSTN_UI_SOAP_DATA_TUNNEL:

                $tmp_integrations_seed = 'soap';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . '/integrations';

            break;
            case CRNRSTN_FAVICON:

                $tmp_integrations_seed = 'favicon';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' .  DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . '/integrations';

                /*
                //
                // CRNRSTN_ASSET_MAPPING
                $oCRNRSTN->config_init_asset_map_favicon(CRNRSTN_RESOURCE_ALL, true, CRNRSTN_ROOT . '/_crnrstn/ui' .  DIRECTORY_SEPARATOR . 'imgs/favicon/system');
                $oCRNRSTN->config_init_asset_map_css(CRNRSTN_RESOURCE_ALL, true, CRNRSTN_ROOT . '/_crnrstn/ui' .  DIRECTORY_SEPARATOR . 'css');
                $oCRNRSTN->config_init_asset_map_js(CRNRSTN_RESOURCE_ALL, true, CRNRSTN_ROOT . '/_crnrstn/ui' .  DIRECTORY_SEPARATOR . 'js');
                $oCRNRSTN->config_init_asset_map_system_img(CRNRSTN_RESOURCE_ALL, true, CRNRSTN_ROOT . '/_crnrstn/ui' .  DIRECTORY_SEPARATOR . 'imgs');
                $oCRNRSTN->config_init_asset_map_social_img(CRNRSTN_RESOURCE_ALL, true, CRNRSTN_ROOT . '/_crnrstn/ui' .  DIRECTORY_SEPARATOR . 'imgs');
                $oCRNRSTN->config_init_asset_map_meta_img(CRNRSTN_RESOURCE_ALL, true, CRNRSTN_ROOT . '/_crnrstn/ui' .  DIRECTORY_SEPARATOR . 'imgs');

                $oCRNRSTN->config_init_http('BLUEHOST_JONY5', 'https://lightsaber.crnrstn.jony5.com/', CRNRSTN_ROOT, '_crnrstn');
                $oCRNRSTN->config_init_http('BLUEHOST_EVIFWEB', 'https://lightsaber.crnrstn.evifweb.com/', CRNRSTN_ROOT, '_crnrstn');
                $oCRNRSTN->config_init_http('LOCALHOST_PC_XP', 'http://172.16.225.128/jony5/', CRNRSTN_ROOT, '_crnrstn');
                $oCRNRSTN->config_init_http('LOCALHOST_CHAD_MACBOOKPRO', 'http://172.16.225.139/evifweb.com/', CRNRSTN_ROOT, '_crnrstn');

                //
                // TODO :: FOLLOW THIS ARRAY AND REPLACE IT EVERYWHERE WITH THE $oCRNRSTN_CONFIG_MGR
                self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_http_endpoint, 'crnrstn_http_endpoint', 'CRNRSTN::RESOURCE::HTTP_IMAGES', 0, CRNRSTN_AUTHORIZE_SESSION, $env_key);
                self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_path_dir, 'crnrstn_path_directory', 'CRNRSTN::RESOURCE::HTTP_IMAGES', 0, NULL, $env_key);
                self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_system_directory, 'crnrstn_system_directory', 'CRNRSTN::RESOURCE::HTTP_IMAGES', 0, NULL, $env_key);
                self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_path_integrations, 'crnrstn_integrations_asset_map_dir_path', 'CRNRSTN::RESOURCE::ASSET_INTEGRATIONS', 0, NULL, $env_key);

                self::$oCRNRSTN_CONFIG_MGR->input_data_value($dir_path, 'crnrstn_favicon_asset_map_dir_root', 'CRNRSTN::RESOURCE::ASSET_PATH');
                self::$oCRNRSTN_CONFIG_MGR->input_data_value($http_path, 'crnrstn_favicon_asset_map_http_root', 'CRNRSTN::RESOURCE::ASSET_PATH');

                SOURCE :: https://www.file-extensions.org

                CRNRSTN_PSD
                CRNRSTN_AI
                CRNRSTN_AFDESIGN
                CRNRSTN_AFPHOTO
                CRNRSTN_CDR
                CRNRSTN_CPT



                */

                $tmp_crnrstn_favicon_asset_map_dir_root = $this->oCRNRSTN->get_resource('crnrstn_favicon_asset_map_dir_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
                $tmp_crnrstn_favicon_asset_map_http_root = $this->oCRNRSTN->get_resource('crnrstn_favicon_asset_map_http_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
                error_log(__LINE__ . ' env $tmp_crnrstn_favicon_asset_map_dir_root[' . $tmp_crnrstn_favicon_asset_map_dir_root . ']. $tmp_crnrstn_favicon_asset_map_http_root[' . $tmp_crnrstn_favicon_asset_map_http_root . '].');
                /*
                [Mon Jun 05 15:27:41.531274 2023] [:error] [pid 8211] [client 172.16.225.1:62930] 5648 env
                $tmp_crnrstn_favicon_asset_map_dir_root=/var/www/html/evifweb.com/_crnrstn/ui' .  DIRECTORY_SEPARATOR . 'imgs/favicon
                $tmp_crnrstn_favicon_asset_map_http_root[].

                */

                $tmp_crnrstn_path_directory = $this->oCRNRSTN->get_resource('crnrstn_path_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');
                $tmp_crnrstn_http_endpoint = $this->oCRNRSTN->get_resource('crnrstn_http_endpoint', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');
                $tmp_crnrstn_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');
                $tmp_crnrstn_integrations_asset_map_dir_path = $this->oCRNRSTN->get_resource('crnrstn_integrations_asset_map_dir_path', 0, 'CRNRSTN::RESOURCE::ASSET_INTEGRATIONS');

                error_log(__LINE__ . ' env map_dir_path[' . $tmp_crnrstn_integrations_asset_map_dir_path . ']. crnrstn_http_endpoint[' . $tmp_crnrstn_http_endpoint . ']. crnrstn_path_directory[' . $tmp_crnrstn_path_directory . ']. crnrstn_system_directory[' . $tmp_crnrstn_system_directory . ']. OUTPUT_MODE[' . $this->oCRNRSTN->return_int_const_profile($output_mode, CRNRSTN_STRING) . '].');
                /*
                [Mon Jun 05 15:12:31.661349 2023] [:error] [pid 8213] [client 172.16.225.1:62796]
                5647 env

                crnrstn_integrations_asset_map_dir_path     = /var/www/html/evifweb.com/_crnrstn/ui
                -----
                $crnrstn_http_endpoint                      = http://172.16.225.139/evifweb.com/
                $crnrstn_path_directory                     = /var/www/html/evifweb.com
                $crnrstn_system_directory                   = _crnrstn
                -----
                $crnrstn_favicon_asset_map_dir_root         = /var/www/html/evifweb.com/_crnrstn/ui' .  DIRECTORY_SEPARATOR . 'imgs/favicon
                $crnrstn_favicon_asset_map_http_root        =

                OUTPUT_MODE[CRNRSTN_FAVICON].

                SYS_CONFIG_HEAD_FILE

                $crnrstn_favicon_asset_map_dir_root . DIRECTORY_SEPARATOR . 'integrations' . DIRECTORY_SEPARATOR . '_' . $SALT;

                HEAD/INDEX ::
                /var/www/html/evifweb.com/_crnrstn/ui' .  DIRECTORY_SEPARATOR . 'imgs/favicon/integrations/_crnrstn_tmp_plaid_cache_{SALT}

                ASSET/BODY ::

                /var/www/html/evifweb.com/_crnrstn/ui' .  DIRECTORY_SEPARATOR . 'imgs/favicon/integrations/crnrstn_tmp_plaid_cache_{SALT}

                */

                $tmp_sys_config_head_file_path = $tmp_crnrstn_favicon_asset_map_dir_root . DIRECTORY_SEPARATOR . 'integrations' . DIRECTORY_SEPARATOR . $tmp_crnrstn_system_directory . '_' . $this->env_key_hash;

                //
                // GENERATE A CRNRSTN :: INTEGRATIONS CONFIGURATION FILE FOR THE ENVIRONMENT.
                $this->oCRNRSTN->oCRNRSTN_ASSET_MGR->crnrstn_integrations_synchronize($tmp_sys_config_head_file_path, $http_path, $file_path, $data_authorization_profile, $ttl, $FILEPATH, $output_mode, $width, $height, $hyperlink, $alt, $title, $target);
                //$this->oCRNRSTN->generate_420_timestamp_echo_output(4, __LINE__, __METHOD__);

            break;
            case CRNRSTN_CSS:

                $tmp_integrations_seed = 'css';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;
            case CRNRSTN_JS:

                $tmp_integrations_seed = 'js';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;
            case CRNRSTN_HTML & CRNRSTN_BASE64_GIF:
            case CRNRSTN_HTML & CRNRSTN_GIF:
            case CRNRSTN_GIF:
            case CRNRSTN_BASE64_GIF:

                $tmp_integrations_seed = 'gif';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' .  DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;
            case CRNRSTN_HTML & CRNRSTN_BASE64_JPEG:
            case CRNRSTN_HTML & CRNRSTN_JPEG:
            case CRNRSTN_ASSET_MODE_JPEG:
            case CRNRSTN_JPEG:
            case CRNRSTN_BASE64_JPEG:

                $tmp_integrations_seed = 'jpg';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' .  DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;
            case CRNRSTN_HTML & CRNRSTN_BASE64:
            case CRNRSTN_HTML & CRNRSTN_BASE64_PNG:
            case CRNRSTN_HTML & CRNRSTN_PNG:
            case CRNRSTN_HTML:
            case CRNRSTN_STRING:
            case CRNRSTN_IMG:
            case CRNRSTN_BASE64:
            case CRNRSTN_ASSET_MODE_BASE64:
            case CRNRSTN_PNG:
            case CRNRSTN_BASE64_PNG:
            case CRNRSTN_ASSET_MODE_PNG:

                $tmp_integrations_seed = 'png';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' .  DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;
            case CRNRSTN_HTML:
            case CRNRSTN_HTM:
            case CRNRSTN_PHP:
            case CRNRSTN_SQL:
            case CRNRSTN_XML:
            case CRNRSTN_TXT:
            case CRNRSTN_RTF:
            case CRNRSTN_CSV:

                $tmp_integrations_seed = 'ascii';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;
            case CRNRSTN_TIF:

                $tmp_integrations_seed = 'tif';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' .  DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;
            case CRNRSTN_BMP:

                $tmp_integrations_seed = 'bmp';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' .  DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;
            case CRNRSTN_SVG:

                $tmp_integrations_seed = 'svg';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' .  DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;
            case CRNRSTN_PIC:

                $tmp_integrations_seed = 'pic';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' .  DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;
            case CRNRSTN_ZIP:

                $tmp_integrations_seed = 'zip';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' .  DIRECTORY_SEPARATOR . 'compressed' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;
            case CRNRSTN_BAT:

                $tmp_integrations_seed = 'bat';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;
            case CRNRSTN_EXE:

                $tmp_integrations_seed = 'exe';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;
            case CRNRSTN_TAR:

                $tmp_integrations_seed = 'tar';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' .  DIRECTORY_SEPARATOR . 'compressed' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;
            case CRNRSTN_PSD:

                $tmp_integrations_seed = 'psd';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' .  DIRECTORY_SEPARATOR . 'creative' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;
            case CRNRSTN_AI:

                $tmp_integrations_seed = 'ai';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' .  DIRECTORY_SEPARATOR . 'creative' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;
            case CRNRSTN_AFDESIGN:

                $tmp_integrations_seed = 'afdesign';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' .  DIRECTORY_SEPARATOR . 'creative' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;
            case CRNRSTN_AFPHOTO:

                $tmp_integrations_seed = 'afphoto';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' .  DIRECTORY_SEPARATOR . 'creative' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;
            case CRNRSTN_CDR:

                $tmp_integrations_seed = 'cdr';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' .  DIRECTORY_SEPARATOR . 'creative' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;
            case CRNRSTN_CPT:

                $tmp_integrations_seed = 'cpt';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' .  DIRECTORY_SEPARATOR . 'creative' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;
            case CRNRSTN_PDF:

                $tmp_integrations_seed = 'pdf';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' .  DIRECTORY_SEPARATOR . 'docs' .  DIRECTORY_SEPARATOR . 'integrations' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;
            case CRNRSTN_XLS:

                $tmp_integrations_seed = 'xls';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' .  DIRECTORY_SEPARATOR . 'docs' .  DIRECTORY_SEPARATOR . 'integrations' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;
            case CRNRSTN_XLSX:

                $tmp_integrations_seed = 'xlsx';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' .  DIRECTORY_SEPARATOR . 'docs' .  DIRECTORY_SEPARATOR . 'integrations' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;
            case CRNRSTN_DOC:

                $tmp_integrations_seed = 'doc';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' .  DIRECTORY_SEPARATOR . 'docs' .  DIRECTORY_SEPARATOR . 'integrations' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;
            case CRNRSTN_DOCX:

                $tmp_integrations_seed = 'docx';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' .  DIRECTORY_SEPARATOR . 'docs' .  DIRECTORY_SEPARATOR . 'integrations' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;
            case CRNRSTN_PPT:

                $tmp_integrations_seed = 'ppt';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' .  DIRECTORY_SEPARATOR . 'docs' .  DIRECTORY_SEPARATOR . 'integrations' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;
            case CRNRSTN_PPSX:

                $tmp_integrations_seed = 'ppsx';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' .  DIRECTORY_SEPARATOR . 'docs' .  DIRECTORY_SEPARATOR . 'integrations' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;
            case CRNRSTN_PAGES:

                $tmp_integrations_seed = 'pages';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' .  DIRECTORY_SEPARATOR . 'docs' .  DIRECTORY_SEPARATOR . 'integrations' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;
            case CRNRSTN_KEY:

                $tmp_integrations_seed = 'key';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' .  DIRECTORY_SEPARATOR . 'docs' .  DIRECTORY_SEPARATOR . 'integrations' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;
            case CRNRSTN_MPEG:
            case CRNRSTN_QT:
            case CRNRSTN_AVI:
            case CRNRSTN_MP4:

                $tmp_integrations_seed = 'video';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;
            case CRNRSTN_XSLT:
            case CRNRSTN_MP2:
            case CRNRSTN_MP3:
            case CRNRSTN_RA:
            case CRNRSTN_WAV:
            case CRNRSTN_MIDI:
            case CRNRSTN_MID:
            case CRNRSTN_RAM:

                $tmp_integrations_seed = 'audio';
                $tmp_integrations_meta_ARRAY['integrations_family'] = $tmp_integrations_seed;
                $tmp_integrations_meta_ARRAY['integrations_path'] = 'ui' . DIRECTORY_SEPARATOR . $tmp_integrations_seed . DIRECTORY_SEPARATOR . 'integrations';

            break;

        }

        return $tmp_serial;

    }

//    private function return_system_integrations_algo_filepath_ARRAY($file_path, $index, $output_mode){
//
//      WHERE, $tmp_asset_algo_gen_path_ARRAY = $this->return_system_integrations_algo_filepath_ARRAY($file_path, $i, $output_mode);
//
//        $tmp_file_path_final = '';
//        $tmp_http_path = $this->oCRNRSTN->get_resource('http_path', $index, $data_type_family);
//        $tmp_dir_path = $this->oCRNRSTN->get_resource('dir_path', $index, $data_type_family);
//        $tmp_data_authorization_profile = $this->oCRNRSTN->get_resource('data_authorization_profile', $index, $data_type_family);
//        $tmp_ttl = $this->oCRNRSTN->get_resource('ttl', $index, $data_type_family);
//
//    }

    public function system_output_file_html($file_path, $output_mode, $width, $height, $hyperlink, $alt, $title, $target){

        $tmp_html_out = '';
        $tmp_is_unit_test = false;
        $removed_segment_count = 0;

        $tmp_is_valid_resource = false;

        /*
        $oCRNRSTN->system_output_file_html('/favicon.ico',CRNRSTN_FAVICON);
        $oCRNRSTN->system_output_file_html('/css/main.css', CRNRSTN_CSS);
        $oCRNRSTN->system_output_file_html('/js/main.js', CRNRSTN_JS);
        $oCRNRSTN->system_output_file_html('/imgs/reflection_of_5.png', CRNRSTN_HTML, '75', '', '5', '5', '/', '_self');

        $this->oCRNRSTN->input_data_value('http_path', $http_path, $data_type_family, NULL, $data_authorization_profile, $env_key, $ttl);
        $this->oCRNRSTN->input_data_value('dir_path', $dir_path, $data_type_family, NULL, $data_authorization_profile, $env_key, $ttl);
        $this->oCRNRSTN->input_data_value('data_authorization_profile', $data_authorization_profile, $data_type_family, NULL, $data_authorization_profile, $env_key, $ttl);
        $this->oCRNRSTN->input_data_value('ttl', $ttl, $data_type_family, NULL, $data_authorization_profile, $env_key, $ttl);

        */

        $data_type_family = 'CRNRSTN::RESOURCE::LOCAL_FILE_SYSTEM';
        $tmp_res_cnt = $this->oCRNRSTN->get_resource_count('dir_path', $data_type_family);

        for($i = 0; $i < $tmp_res_cnt; $i++){

            $tmp_file_path_final = $tmp_file_path_chopped = $tmp_http_path_chopped = '';
            $tmp_http_path = $this->oCRNRSTN->get_resource('http_path', $i, $data_type_family);
            $tmp_dir_path = $this->oCRNRSTN->get_resource('dir_path', $i, $data_type_family);
            $tmp_data_authorization_profile = $this->oCRNRSTN->get_resource('data_authorization_profile', $i, $data_type_family);
            $tmp_ttl = $this->oCRNRSTN->get_resource('ttl', $i, $data_type_family);

            //error_log(__LINE__ . ' env FILE OUT [' . $file_path . ']. OUTPUT_MODE[' . $this->oCRNRSTN->return_int_const_profile($output_mode, CRNRSTN_INTEGER) . '].');

            //error_log(__LINE__ . ' env $tmp_dir_path[' . $tmp_dir_path  . '].');
            $tmp_dir_path_sanitized = $this->oCRNRSTN->str_sanitize($tmp_dir_path, 'integrations_dir_path' );
            //error_log(__LINE__ . ' env $tmp_dir_path_sanitized[' . print_r($tmp_dir_path_sanitized, true) . '].');

            //error_log(__LINE__ . ' env $tmp_http_path[' . $tmp_http_path  . '].');
            $tmp_http_path_from_chop_shop = $tmp_http_path_sanitized = $this->oCRNRSTN->str_sanitize($tmp_http_path, 'integrations_http_path');
            $tmp_http_path_reversed_for_chop_ARRAY = array_reverse(str_split($tmp_http_path_sanitized));

            //error_log(__LINE__ . ' env $tmp_file_path_sanitized[' . print_r($tmp_http_path_sanitized, true) . '].');

            //error_log(__LINE__ . ' env $file_path[' . $file_path  . '].');
            $tmp_file_path_meta_ARRAY = $this->oCRNRSTN->str_sanitize($file_path, 'integrations_file_path_append' );
            //error_log(__LINE__ . ' env $tmp_file_path_sanitized[' . print_r($tmp_file_path_meta_ARRAY, true) . '].');

            foreach($tmp_file_path_meta_ARRAY['dir_nom_segment_str_len'] as $nom_index => $nom_len){

                if($nom_len == 2){

                    $removed_segment_count++;
                    //error_log(__LINE__ . ' env $file_path[' . $file_path  . ']. $removed_segment_count[' . $removed_segment_count .'].');

                }

            }

            if($removed_segment_count > 0){

                $tmp_chop_assemble = '';

                $tmp_http_path_reversed_ARRAY = array_reverse(str_split($tmp_http_path_sanitized));
                $tmp_cnt = count($tmp_http_path_reversed_ARRAY);
                for($ii = 0; $ii < $tmp_cnt; $ii++){

                    if($tmp_http_path_reversed_ARRAY[$ii] == DIRECTORY_SEPARATOR){

                        $removed_segment_count--;

                    }

                    if($removed_segment_count > -1){

                        array_shift($tmp_http_path_reversed_for_chop_ARRAY);

                    }

                }

                //
                // REVERSE...THE REVERSED ARRAY.
                $tmp_http_path_reversed_for_chop_ARRAY = array_reverse($tmp_http_path_reversed_for_chop_ARRAY);

                $tmp_http_path_from_chop_shop = implode($tmp_http_path_reversed_for_chop_ARRAY);

            }

            //
            // TRIM LEADING SLASH IF NO DIRECTORY DELETE.
            if($tmp_file_path_meta_ARRAY['no_segment_zero_dot'] == 1){

                //
                // TRIM ANY LEADING DIRECTORY_SEPARATOR.
                $file_path = $this->oCRNRSTN->str_sanitize($file_path, 'leading_slash');

            }

            $tmp_asset_algo_gen_path_ARRAY = array();
            if($tmp_file_path_meta_ARRAY['slash_segment_cnt'] > 0  && ($tmp_file_path_meta_ARRAY['no_segment_zero_dot'] == 0)){

                //
                // WE HAVE '../' TYPE OF INPUT.
                // PROCESS THE $tmp_dir_path_sanitized ACCORDINGLY.
                $tmp_dir_path_segment_ARRAY = explode(DIRECTORY_SEPARATOR, $tmp_dir_path_sanitized);
                $tmp_dir_path_segment_cnt = count($tmp_dir_path_segment_ARRAY);
                $tmp_dir_path_max_segment_cnt = $tmp_dir_path_segment_cnt - (int) $tmp_file_path_meta_ARRAY['slash_segment_cnt'];
                for($i = 0; $i < $tmp_dir_path_max_segment_cnt; $i++){

                    $tmp_file_path_chopped .= $tmp_dir_path_segment_ARRAY[$i] . DIRECTORY_SEPARATOR;

                    if($i == ($tmp_dir_path_max_segment_cnt - 1)){

                        $tmp_file_path_final = $tmp_file_path_chopped;

                        $tmp_small_section = '';
                        foreach($tmp_file_path_meta_ARRAY['segment_str'] as $seg_index => $seg_str){

                            $tmp_small_section .= $tmp_file_path_meta_ARRAY['segment_str'][$seg_index] . DIRECTORY_SEPARATOR;

                        }

                        //
                        // REMOVE TRAILING DIRECTORY_SEPARATOR.
                        $tmp_small_section = $this->oCRNRSTN->strrtrim($tmp_small_section, DIRECTORY_SEPARATOR);

                        $tmp_asset_algo_gen_path_ARRAY[] = $tmp_file_path_final . $tmp_small_section;
                        //error_log(__LINE__ . ' env $i[' . $i . ']. $tmp_dir_path_segment_cnt[' . $tmp_dir_path_segment_cnt . ']. slash_segment_cnt[' . $tmp_file_path_meta_ARRAY['slash_segment_cnt'] . ']. $tmp_file_path_final[' . $tmp_file_path_final . ']. $tmp_small_section[' . $tmp_small_section . '].');        // $removed_segment_count$removed_segment_count =

                        break;

                    }

                }

                try{

                    $tmp_is_valid_resource = false;

                    //
                    // DO WE HAVE A VALID FILE PATH?
                    foreach($tmp_asset_algo_gen_path_ARRAY as $fp_index => $tmp_filepath){

                        if(is_file($tmp_filepath)){

                            $tmp_is_valid_resource = true;

                            break;

                        }

                    }

                    if($tmp_is_valid_resource == false){

                        //
                        // FAIL QUIETLY.
                        $this->error_log('Unable to locate the file resource associated with the provided file path of [' . $file_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
                        error_log(__LINE__ . ' crnrstn Unable to locate the file resource associated with the provided file path of [' . $file_path . '].');

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        //throw new Exception('Unable to locate resource associated with the provided file path of [' . $file_path . '].');

                    }

                }catch (Exception $e){

                    //
                    // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
                    $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

                    return false;

                }

            }

            //
            // BUILD THE FILE PATH BY NOW, OR FOREVER HOLD YOUR PEACE.
            if($tmp_is_valid_resource !== true){

                //
                // LOCATE AND SERIALIZE PROFILE OF FILE SYSTEM SOURCE.
                $tmp_filepath = $tmp_dir_path . $file_path;
                if(is_file($tmp_filepath)){

                    $tmp_is_valid_resource = true;
                    $removed_segment_count = 0;

                }

            }

            switch($output_mode){
                case CRNRSTN_FAVICON:

                    if($tmp_is_valid_resource == true){

                        //
                        // CRNRSTN :: INTEGRATIONS INITIALIZATION CHECK AND RESPONSE RETURN SERIALIZATION (RRS) MAP SUPPORT.
                        $tmp_CONFIG_INTEGRATIONS_SALT = $this->return_file_system_integrations_serial($tmp_http_path_from_chop_shop, $tmp_file_path_final, $tmp_data_authorization_profile, $tmp_ttl, $tmp_filepath, $output_mode, $width, $height, $hyperlink, $alt, $title, $target);

                        //
                        // TODO :: THE $tmp_CONFIG_INTEGRATIONS_SALT IS USED TO NOW LOAD THE ACTUAL RESOURCE FILE.
                        return $this->oCRNRSTN->return_html_favicon_head_meta($tmp_filepath, $tmp_http_path_from_chop_shop, $tmp_file_path_final);

                    }

                break;
                case CRNRSTN_CSS:

                    if($tmp_is_valid_resource == true){

                        error_log(__LINE__ . ' env WE HAVE A VALID FILE PATH. PROCEED. [' . $tmp_filepath . '].');

                        return $tmp_filepath;

                    }

                break;
                case CRNRSTN_JS:

                    if($tmp_is_valid_resource == true){

                        error_log(__LINE__ . ' env WE HAVE A VALID FILE PATH. PROCEED. [' . $tmp_filepath . '].');

                        return $tmp_filepath;

                    }

                break;
                case CRNRSTN_HTML & CRNRSTN_GIF:
                case CRNRSTN_HTML & CRNRSTN_JPEG:
                case CRNRSTN_HTML & CRNRSTN_PNG:
                case CRNRSTN_HTML:

                    if($tmp_is_valid_resource == true){

                        error_log(__LINE__ . ' env WE HAVE A VALID FILE PATH. PROCEED. [' . $tmp_filepath . '].');

                        return $tmp_filepath;

                    }

                break;
                case CRNRSTN_HTML & CRNRSTN_BASE64:
                case CRNRSTN_HTML & CRNRSTN_BASE64_PNG:
                case CRNRSTN_HTML & CRNRSTN_BASE64_JPEG:
                case CRNRSTN_HTML & CRNRSTN_BASE64_GIF:

                    if($tmp_is_valid_resource == true){

                        error_log(__LINE__ . ' env WE HAVE A VALID FILE PATH. PROCEED. [' . $tmp_filepath . '].');

                        return $tmp_filepath;

                    }

                break;
                case CRNRSTN_STRING:
                case CRNRSTN_PNG:
                case CRNRSTN_ASSET_MODE_PNG:

                    if($tmp_is_valid_resource == true){

                        error_log(__LINE__ . ' env WE HAVE A VALID FILE PATH. PROCEED. [' . $tmp_filepath . '].');

                        return $tmp_filepath;

                    }

                break;
                case CRNRSTN_GIF:

                    if($tmp_is_valid_resource == true){

                        error_log(__LINE__ . ' env WE HAVE A VALID FILE PATH. PROCEED. [' . $tmp_filepath . '].');

                        return $tmp_filepath;

                    }

                break;
                case CRNRSTN_JPEG:
                case CRNRSTN_ASSET_MODE_JPEG:

                    if($tmp_is_valid_resource == true){

                        error_log(__LINE__ . ' env WE HAVE A VALID FILE PATH. PROCEED. [' . $tmp_filepath . '].');

                        return $tmp_filepath;

                    }

                break;
                case CRNRSTN_BASE64_PNG:
                case CRNRSTN_BASE64_JPEG:
                case CRNRSTN_BASE64_GIF:
                case CRNRSTN_BASE64:

                    if($tmp_is_valid_resource == true){

                        error_log(__LINE__ . ' env WE HAVE A VALID FILE PATH. PROCEED. [' . $tmp_filepath . '].');

                        return $tmp_filepath;

                    }

                break;
                default:

                    if($tmp_is_valid_resource == true){

                        //
                        // http://172.16.225.139/evifweb.com/?crnrstn_unittest=true&crnrstn_extenstion=ZIP
                        $tmp_file_type_meta_ARRAY = $this->oCRNRSTN->oCRNRSTN_CS_CONTROLLER->return_file_profile($tmp_filepath, $tmp_is_unit_test);

                        $tmp_str_out = $this->oCRNRSTN->oINTERACT_UI_HTML_MGR->out_ui_html_module_system_icon($tmp_filepath, $tmp_file_type_meta_ARRAY, $output_mode, $width, $height, $hyperlink, $alt, $title, $target);

                        return $tmp_str_out;

                    }

                    /*
                    JUST FOR REFERENCE ::
                        CRNRSTN_HTML
                        CRNRSTN_HTM
                        CRNRSTN_XML
                        CRNRSTN_TXT
                        CRNRSTN_RTF
                        CRNRSTN_CSV
                        CRNRSTN_TIF
                        CRNRSTN_BMP
                        CRNRSTN_SVG
                        CRNRSTN_PIC
                        CRNRSTN_SQL
                        CRNRSTN_ZIP
                        CRNRSTN_TAR
                        CRNRSTN_PDF
                        CRNRSTN_XLS
                        CRNRSTN_XLSX
                        CRNRSTN_DOCX
                        CRNRSTN_PPT
                        CRNRSTN_PPSX
                        CRNRSTN_KEY
                        CRNRSTN_XSLT
                        CRNRSTN_MP2
                        CRNRSTN_MP3
                        CRNRSTN_MP4
                        CRNRSTN_XSLT
                        CRNRSTN_RA
                        CRNRSTN_WAV
                        CRNRSTN_MIDI
                        CRNRSTN_MID
                        CRNRSTN_RAM
                        CRNRSTN_MPEG
                        CRNRSTN_QT
                        CRNRSTN_AVI
                        ...

                    */

                break;

            }

        }

        return $tmp_html_out;

    }

    public function download_file_system($file_path, $output_mode, $width = NULL, $height = NULL, $hyperlink = NULL, $alt = NULL, $title = NULL, $target = NULL){

        $tmp_html_out = '';

        $data_type_family = 'CRNRSTN::RESOURCE::LOCAL_FILE_SYSTEM';
        $tmp_res_cnt = $this->oCRNRSTN->get_resource_count('dir_path', $data_type_family);
        for($i = 0; $i < $tmp_res_cnt; $i++){

            $tmp_http_path = $this->oCRNRSTN->get_resource('http_path', $i, $data_type_family);
            $tmp_dir_path = $this->oCRNRSTN->get_resource('dir_path', $i, $data_type_family);
            $tmp_data_authorization_profile = $this->oCRNRSTN->get_resource('data_authorization_profile', $i, $data_type_family);
            $tmp_ttl = $this->oCRNRSTN->get_resource('ttl', $i, $data_type_family);

            error_log(__LINE__ . ' env FILE DOWNLOAD HTML OUT [' . $file_path . ']. OUTPUT_MODE[' . $this->oCRNRSTN->return_int_const_profile($output_mode, CRNRSTN_INTEGER) . '].');
            //
            // LOCATE AND SERIALIZE PROFILE OF FILE SYSTEM SOURCE.
            $tmp_filepath = $tmp_dir_path . $file_path;
            if(is_file($tmp_dir_path)){

                error_log(__LINE__ . ' env DEFINITELY, IS A FILE! [' . $tmp_filepath . '].');

            }else{

                error_log(__LINE__ . ' env NOT A FILE, BRUV. [' . $tmp_filepath . '].');

            }

        }

        return $tmp_html_out;

    }

    public function details_file_system($file_path, $output_mode, $width = NULL, $height = NULL, $hyperlink = NULL, $alt = NULL, $title = NULL, $target = NULL){

        $tmp_html_out = '';
        $data_type_family = 'CRNRSTN::RESOURCE::LOCAL_FILE_SYSTEM';
        $tmp_res_cnt = $this->oCRNRSTN->get_resource_count('dir_path', $data_type_family);
        for($i = 0; $i < $tmp_res_cnt; $i++){

            $tmp_http_path = $this->oCRNRSTN->get_resource('http_path', $i, $data_type_family);
            $tmp_dir_path = $this->oCRNRSTN->get_resource('dir_path', $i, $data_type_family);
            $tmp_data_authorization_profile = $this->oCRNRSTN->get_resource('data_authorization_profile', $i, $data_type_family);
            $tmp_ttl = $this->oCRNRSTN->get_resource('ttl', $i, $data_type_family);

            error_log(__LINE__ . ' env FILE DETAILS HTML OUT[' . $file_path . ']. OUTPUT_MODE[' . $this->oCRNRSTN->return_int_const_profile($output_mode, CRNRSTN_INTEGER) . '].');

            //
            // LOCATE AND SERIALIZE PROFILE OF FILE SYSTEM SOURCE.
            $tmp_filepath = $tmp_dir_path . $file_path;
            if(is_file($tmp_dir_path)){

                error_log(__LINE__ . ' env DEFINITELY, IS A FILE! [' . $tmp_filepath . '].');

            }else{

                error_log(__LINE__ . ' env NOT A FILE, BRUV. [' . $tmp_filepath . '].');

            }

        }

        return $tmp_html_out;

    }

    public function config_integrate_file_system($env_key, $http_path, $dir_path, $data_authorization_profile, $ttl, $host, $excluded_file_ext_ARRAY){

        //
        // Sunday, June 4, 2023 @ 1726 hrs.
        // CRNRSTN :: LOCAL FILE SYSTEM INTEGRATIONS.
        switch($host){
            case 'localhost':

                $data_type_family = 'CRNRSTN::RESOURCE::LOCAL_FILE_SYSTEM';

                //error_log(__LINE__ . ' env $http_path[' . $http_path . ']. $dir_path[' . $dir_path . '].');
                $this->oCRNRSTN->input_data_value($http_path, 'http_path', $data_type_family, NULL, $data_authorization_profile, $env_key, $ttl);
                $this->oCRNRSTN->input_data_value($dir_path, 'dir_path', $data_type_family, NULL, $data_authorization_profile, $env_key, $ttl);
                $this->oCRNRSTN->input_data_value($data_authorization_profile, 'data_authorization_profile', $data_type_family, NULL, $data_authorization_profile, $env_key, $ttl);
                $this->oCRNRSTN->input_data_value($ttl, 'ttl', $data_type_family, NULL, $data_authorization_profile, $env_key, $ttl);
                $this->oCRNRSTN->input_data_value($excluded_file_ext_ARRAY, 'excluded_file_ext_ARRAY', $data_type_family, NULL, $data_authorization_profile, $env_key, $ttl);

            break;
            case 'ftp':
                // PENDING IMPLEMENTATION.
            break;

        }

    }

    public function system_base64_synchronize($data_key = NULL){

        return $this->oCRNRSTN_ASSET_MGR->system_base64_synchronize($data_key);

    }

    public function system_base64_integrate($dir_filepath, $img_batch_size){

//        $tmp_current_batch = $tmp_batch_size = $img_batch_size;
//        $tmp_filtered_filename_ARRAY = array();
//        $tmp_processed_filename_ARRAY = array();

//        $tmp_request_salt = $this->oCRNRSTN->salt(26);

        //$this->oCRNRSTN->print_r($dir_filepath, 'system_base64_integrate processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
        if(is_dir($dir_filepath)){

            //
            // SOURCE - LOCAL_DIR
            if(is_readable($dir_filepath)){

                $this->oCRNRSTN->print_r('THIS IS A READABLE DIRECTORY: ' . $dir_filepath, 'is_readable().', NULL, __LINE__, __METHOD__, __FILE__);

                //
                // SCAN DIR FOR IMAGE FILE CONTENT

                /*
                lnum 94 :: crnrstn_asset_validator::__construct($type, $ext, $mime)
                switch($type){
                case 'CREATIVE':
                $this->add_auth_mime_type('jpg','image/jpeg');
                $this->add_auth_mime_type('jpeg','image/jpeg');
                $this->add_auth_mime_type('jpg2','image/jpeg');
                $this->add_auth_mime_type('gif','image/gif');
                $this->add_auth_mime_type('bmp','image/bmp');
                $this->add_auth_mime_type('bmp','image/x-windows-bmp');
                $this->add_auth_mime_type('jpe','image/jpeg');
                $this->add_auth_mime_type('tif','image/tiff');
                $this->add_auth_mime_type('tif','image/x-tiff');
                $this->add_auth_mime_type('ico','image/x-icon');
                $this->add_auth_mime_type('svg','image/svg+xml');
                $this->add_auth_mime_type('pic','image/pict');
                $this->add_auth_mime_type('pict','image/pict');
                $this->add_auth_mime_type('png','image/png');

                */

                $this->oCRNRSTN->print_r('Scanning Images: ' . $dir_filepath, 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                $this->oCRNRSTN->error_log('CRNRSTN :: BASE64 services scanning system images: ' . $dir_filepath, __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
                $tmp_scraped_filename_ARRAY = $this->oCRNRSTN->better_scandir($dir_filepath);

//                $tmp = array_pop($tmp_scraped_filename_ARRAY);
//                $tmp = array_pop($tmp_scraped_filename_ARRAY);

                //oCRNRSTN_ASSET_MGR
                // CUSTOM IMAGES
                $tmp_img_cnt = sizeof($tmp_scraped_filename_ARRAY);
                for($i = 0; $i < $tmp_img_cnt; $i++){

                    $this->oCRNRSTN->print_r('FILE[' . $i . ' of ' . $tmp_img_cnt . ']: ' . $tmp_scraped_filename_ARRAY[$i], 'oCRNRSTN_ASSET_MGR::is_approved_mime_type().', NULL, __LINE__, __METHOD__, __FILE__);

//                    if($this->oCRNRSTN->oCRNRSTN_PERFORMANCE_REGULATOR->is_approved_mime_type(CRNRSTN_RESOURCE_IMAGE, $dir_filepath, $tmp_scraped_filename_ARRAY[$i])){
//
//                        $this->oCRNRSTN->print_r('APPROVED FILE: ' . $tmp_scraped_filename_ARRAY[$i], 'oCRNRSTN_PERFORMANCE_REGULATOR::is_approved_mime_type().', NULL, __LINE__, __METHOD__, __FILE__);
//
//                        die();
//
//                    }else{
//
//                        $this->oCRNRSTN->print_r('UNAUTHORIZED FILE TYPE: ' . $tmp_scraped_filename_ARRAY[$i], 'oCRNRSTN_PERFORMANCE_REGULATOR::is_approved_mime_type().', NULL, __LINE__, __METHOD__, __FILE__);
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
                $this->oCRNRSTN->print_r('NOT READABLE DIRECTORY: ' . $dir_filepath, 'is_readable().', NULL, __LINE__, __METHOD__, __FILE__);

            }

        }else{

            //
            // HOOOSTON...VE HAF PROBLEM!
            //$this->oCRNRSTN->error_log('CRNRSTN :: has experienced errors attempting to find the source directory, ' . $dir_path . ', within the local file system.');
            $this->oCRNRSTN->print_r('NOT A DIRECTORY: ' . $dir_filepath, 'is_dir(). ', NULL, __LINE__, __METHOD__, __FILE__);

            if(is_file($dir_filepath) && strlen($dir_filepath) > 0){

                $this->oCRNRSTN->print_r('THIS IS A FILE: ' . $dir_filepath, 'is_file(). ', NULL, __LINE__, __METHOD__, __FILE__);

            }else{

                $this->oCRNRSTN->print_r('NOT A FILE: ' . $dir_filepath, 'is_file(). ', NULL, __LINE__, __METHOD__, __FILE__);

            }

        }

        die();

        //$this->oCRNRSTN->print_r('Images count: [' . count($tmp_filtered_filename_ARRAY) . '].', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

        $tmp_oMEDIA_CONVERTOR = new crnrstn_system_asset_manager($this->oCRNRSTN);

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
                    $tmp_oMEDIA_CONVERTOR = new crnrstn_system_asset_manager($this->oCRNRSTN);

                }

                if($tmp_oMEDIA_CONVERTOR->system_base64_synchronize($tmp_filename) == true){

                    //$this->oCRNRSTN->print_r('Processed image: [' . $tmp_filename . '].', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                    $tmp_processed_filename_ARRAY[] = $tmp_filename;
                    $tmp_flagged_filename_ARRAY[$img_name] = 1;

                }

            }

        }

        //$this->oCRNRSTN->print_r('Processed Images [skipped=' . $tmp_skipped . '] [err=' . $tmp_err_cnt . '][' . print_r($tmp_processed_filename_ARRAY, true) . '].', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

        return true;





        return $this->oCRNRSTN_ASSET_MGR->system_base64_integrate($dir_path, $img_batch_size);

    }

    public function system_base64_synchronize_batch($img_batch_size = 5){

        $tmp_current_batch = $tmp_batch_size = $img_batch_size;
        $tmp_filtered_filename_ARRAY = array();
        $tmp_processed_filename_ARRAY = array();

        $tmp_path_directory = $this->oCRNRSTN->get_resource('crnrstn_path_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');
        $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');

        $tmp_png_path_ARRAY = array();
        $tmp_jpeg_path_ARRAY = array();
        $tmp_png_path_ARRAY[] = $tmp_path_directory . DIRECTORY_SEPARATOR . $tmp_system_directory . DIRECTORY_SEPARATOR . 'ui' .  DIRECTORY_SEPARATOR . 'imgs/png/system/';
        $tmp_png_path_ARRAY[] = $tmp_path_directory . DIRECTORY_SEPARATOR . $tmp_system_directory . DIRECTORY_SEPARATOR . 'ui' .  DIRECTORY_SEPARATOR . 'imgs/png/social/';
        $tmp_jpeg_path_ARRAY[] = $tmp_path_directory . DIRECTORY_SEPARATOR . $tmp_system_directory . DIRECTORY_SEPARATOR . 'ui' .  DIRECTORY_SEPARATOR . 'imgs/jpg/system/';
        $tmp_jpeg_path_ARRAY[] = $tmp_path_directory . DIRECTORY_SEPARATOR . $tmp_system_directory . DIRECTORY_SEPARATOR . 'ui' .  DIRECTORY_SEPARATOR . 'imgs/jpg/social/';

        for($ii = 0; $ii < 2; $ii++){

            $tmp_dir_path_PNG = $tmp_png_path_ARRAY[$ii];
            $tmp_dir_path_JPEG = $tmp_jpeg_path_ARRAY[$ii];

            //$this->oCRNRSTN->print_r('Scanning Images: ' . $tmp_dir_path_PNG, 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
            $this->oCRNRSTN->error_log('CRNRSTN :: BASE64 services scanning system images: ' . $tmp_dir_path_PNG, __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
            $tmp_scraped_filename_PNG_ARRAY = $this->oCRNRSTN->better_scandir($tmp_dir_path_PNG);

            //$this->oCRNRSTN->print_r('Scanning Images: ' . $tmp_dir_path_JPEG, 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
            $this->oCRNRSTN->error_log('CRNRSTN :: BASE64 services scanning system images: ' . $tmp_dir_path_JPEG, __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);
            $tmp_scraped_filename_JPEG_ARRAY = $this->oCRNRSTN->better_scandir($tmp_dir_path_JPEG);

//        $tmp = array_pop($tmp_scraped_filename_PNG_ARRAY);
//        $tmp = array_pop($tmp_scraped_filename_PNG_ARRAY);
//        $tmp = array_pop($tmp_scraped_filename_JPEG_ARRAY);
//        $tmp = array_pop($tmp_scraped_filename_JPEG_ARRAY);

            // PNG
            $tmp_img_cnt = sizeof($tmp_scraped_filename_PNG_ARRAY);
            for ($i = 0; $i < $tmp_img_cnt; $i++){

                $tmp_pos_png = strpos($tmp_scraped_filename_PNG_ARRAY[$i], '.png');
                $tmp_pos_ds_store = strpos($tmp_scraped_filename_PNG_ARRAY[$i], 'DS_Store');

                if(($tmp_pos_png !== false) && ($tmp_pos_ds_store == false)){

                    $tmp_filtered_filename_ARRAY[] = $tmp_scraped_filename_PNG_ARRAY[$i];

                }else{

                    $tmp_skipped_filename_ARRAY[] = $tmp_scraped_filename_PNG_ARRAY[$i];

                }

            }

            // JPEG
            $tmp_img_cnt = sizeof($tmp_scraped_filename_JPEG_ARRAY);
            for ($i = 0; $i < $tmp_img_cnt; $i++){

                $tmp_pos_jpg = strpos($tmp_scraped_filename_JPEG_ARRAY[$i], '.jpg');
                $tmp_pos_jpeg = strpos($tmp_scraped_filename_JPEG_ARRAY[$i], '.jpeg');
                $tmp_pos_jpg2 = strpos($tmp_scraped_filename_JPEG_ARRAY[$i], '.jpg2');
                $tmp_pos_ds_store = strpos($tmp_scraped_filename_JPEG_ARRAY[$i], 'DS_Store');

                if((($tmp_pos_jpg !== false) || ($tmp_pos_jpeg !== false) || ($tmp_pos_jpg2 !== false)) && ($tmp_pos_ds_store == false)){

                    $tmp_filtered_filename_ARRAY[] = $tmp_scraped_filename_JPEG_ARRAY[$i];

                }else{

                    $tmp_skipped_filename_ARRAY[] = $tmp_scraped_filename_JPEG_ARRAY[$i];

                }

            }

        }

        //$this->oCRNRSTN->print_r('Images count: [' . count($tmp_filtered_filename_ARRAY) . '].', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

        $tmp_oMEDIA_CONVERTOR = new crnrstn_system_asset_manager($this->oCRNRSTN);

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
                    $tmp_oMEDIA_CONVERTOR = new crnrstn_system_asset_manager($this->oCRNRSTN);

                }

                //$this->oCRNRSTN->error_log('$tmp_filename[' . $tmp_filename . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                if($tmp_oMEDIA_CONVERTOR->system_base64_synchronize($tmp_filename) == true){

                    //$this->oCRNRSTN->error_log('SUCCESS. $tmp_filename[' . $tmp_filename . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

                    //$this->oCRNRSTN->print_r('Processed image: [' . $tmp_filename . '].', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);
                    $tmp_processed_filename_ARRAY[] = $tmp_filename;
                    $tmp_flagged_filename_ARRAY[$img_name] = 1;

                }

            }

        }

        $this->oCRNRSTN->print_r('Processed Images [' . print_r($tmp_processed_filename_ARRAY, true) . '].', 'Image Processing.', NULL, __LINE__, __METHOD__, __FILE__);

        return true;

    }

    public function catch_exception($exception_obj, $syslog_constant = LOG_DEBUG, $method = NULL, $namespace = NULL, $output_profile = NULL, $output_profile_override_meta = NULL, $wcr_override_pipe = NULL){

        $tmp_err_trace_str = $this->return_PHP_exception_trace_pretty($exception_obj->getTraceAsString());

        if(strlen($tmp_err_trace_str) > 0){

            $this->error_log('PHP native exception output log trace received ::' . $tmp_err_trace_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        }

        //
        // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
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

    public function return_log_priority_pretty($logPriority, $format = 'TEXT'){

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

        if(!isset($variable)) return null;
        return filter_var($variable, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

    }

    public function __str_sanitize($str, $type){

        $patterns = array();
        $replacements = array();

        $type = strtolower($type);

        try{

            switch ($type){
                case 'max_disk_storage_utilization':

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

                        if(!($last_dot_flag === true)){

                            if($tmp_post_at_str_rev_ARRAY[$i] == '.'){

                                $last_dot_flag = true;

                            }

                            $tmp_new_post_at_ARRAY[] = $tmp_post_at_str_rev_ARRAY[$i];

                            if($last_dot_flag === true){

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
                case 'max_disk_storage_utilization':

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

                        if(!($last_dot_flag === true)){

                            if($tmp_post_at_str_rev_ARRAY[$i] == '.'){

                                $last_dot_flag = true;

                            }

                            $tmp_new_post_at_ARRAY[] = $tmp_post_at_str_rev_ARRAY[$i];

                            if($last_dot_flag === true){

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


        }catch(Exception $e){

            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function ___str_sanitize($str, $type){

        $patterns = array();
        $replacements = array();

        $type = strtolower($type);

        try{

            switch ($type){

                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unable to determine string sanitization algorithm [' . $type . '] for the content[' . $str . '].');

                break;
            }

            $str = str_replace($patterns, $replacements, $str);

            return $str;


        }catch(Exception $e){

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
    public function str_split_unicode($str, $length = 1){

        $tmp = preg_split('~~u', $str, -1, PREG_SPLIT_NO_EMPTY);

        if($length > 1){

            $chunks = array_chunk($tmp, $length);

            foreach($chunks as $i => $chunk){

                $chunks[$i] = join('', (array) $chunk);

            }

            $tmp = $chunks;

        }

        return $tmp;

    }

//    public function return_sticky_link($url, $meta_params_ARRAY = NULL){
//
//        $tmp_array = array();
//        $tmp_flag_array = array();
//
//        $tmp_array[] = 'crnrstn_l=crnrstn';
//        $tmp_array[] = 'crnrstn_r=' . $this->data_encrypt($url);
//        $tmp_flag_array['crnrstn_l'] = 1;
//        $tmp_flag_array['crnrstn_r'] = 1;
//
//        if(isset($meta_params_ARRAY)){
//
//            if(is_array($meta_params_ARRAY)){
//
//                foreach($meta_params_ARRAY as $key => $value){
//
//                    if(!isset($tmp_flag_array[$key])){
//
//                        $tmp_flag_array[$key] = 1;
//
//                        $tmp_array[] = $value;
//
//                    }
//
//                }
//
//            }else{
//
//                if(is_string($meta_params_ARRAY)){
//
//                    if(!isset($tmp_flag_array['crnrstn_m'])){
//
//                        $tmp_flag_array['crnrstn_m'] = 1;
//
//                        $tmp_array[] = 'crnrstn_m=' . urlencode($meta_params_ARRAY);
//
//                    }
//
//                }
//
//            }
//
//        }
//
//        return $this->append_url_param($tmp_array);
//
//    }

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

        if($this->oCRNRSTN->is_ssl() == true){

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

                if($tunnel_encrypt == true){

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

                    if($tunnel_encrypt == true){

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

                    foreach($no_encrypt_param_ARRAY as $key01 => $value01){

                        if($key01 == $key00){

                            $tmp_spoiled = true;

                        }

                    }

                    if(!($tmp_spoiled == true)){

                        $tmp_flag_param_ARRAY[$key00] = 1;

                        $tmp_return_str .= $param_concatenator . $this->url_param_append($key00 . '=' . $value00, $tunnel_encrypt);

                        if($tunnel_encrypt == true){

                            $tmp_encrypted_params_pipe .= $key00 . '|';

                        }

                        if($param_concatenator == '?'){

                            $param_concatenator = '&';

                        }

                    }

                }else{

                    $tmp_flag_param_ARRAY[$key00] = 1;

                    $tmp_return_str .= $param_concatenator . $this->url_param_append($key00 . '=' . $value00, $tunnel_encrypt);

                    if($tunnel_encrypt == true){

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

        if($tunnel_encrypt == true){

            $tmp_return_str .= $param_concatenator . 'crnrstn_encrypt_tunnel=' . urlencode($this->data_encrypt($tmp_encrypted_params_pipe));

        }

        return $tmp_return_str;

    }

    private function url_param_append($param_str, $tunnel_encrypt){

        if($tunnel_encrypt == true){

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

    public function header_signature_options_return(){

        return $this->oHTTP_MGR->header_signature_options_return();

    }

    public function header_options_add($header_array, $overwrite_existing){

        $this->oHTTP_MGR->header_options_add($header_array, $overwrite_existing);

    }

    public function header_options_apply(){

        $this->oHTTP_MGR->header_options_apply();

    }

    public function get_headers($return_type){

        return $this->oHTTP_MGR->get_headers($return_type);

    }

    public function get_user_agent(){

        return $this->oHTTP_MGR->get_user_agent();

    }

    public function get_mobile_devices(){

        return $this->oHTTP_MGR->get_mobile_devices();

    }

    public function get_tablet_devices(){

        return $this->oHTTP_MGR->get_tablet_devices();

    }

    public function get_browsers(){

        return $this->oHTTP_MGR->get_browsers();

    }

    public function get_mobile_os(){

        return $this->oHTTP_MGR->get_mobile_os();

    }

    public function add_cookie($name, $value, $expires_or_options, $path, $domain, $secure, $httponly){

        return $this->oCOOKIE_MGR->addCookie($name, $value, $expires_or_options, $path, $domain, $secure, $httponly);

    }

    public function add_raw_cookie($name, $value, $expires_or_options, $path, $domain, $secure, $httponly){

        return $this->oCOOKIE_MGR->addRawCookie($name, $value, $expires_or_options, $path, $domain, $secure, $httponly);

    }

    public function delete_all_cookies($path){

        return $this->oCOOKIE_MGR->deleteAllCookies($path);

    }

    public function delete_cookie($name, $path){

        return $this->oCOOKIE_MGR->deleteCookie($name, $path);

    }

    public function get_cookie($name){

        return $this->oCOOKIE_MGR->getCookie($name);

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

    public function __destruct(){

        $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('goodbye crnrstn :: ' . __CLASS__ . '::' . __METHOD__ . ' called. [rtime ' . $this->wall_time() . ' secs][bytes_encrypted ' . $this->oCRNRSTN->format_bytes($this->total_bytes_encrypted, 5) . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);

    }

}