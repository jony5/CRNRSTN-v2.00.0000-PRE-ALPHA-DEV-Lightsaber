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
#		Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
#		documentation files (the "Software"), to deal in the Software without restriction, including without limitation
#       the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software,
#       and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
#
#		The above copyright notice and this permission notice shall be included in all copies or substantial portions
#		of the Software.
#
#		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
#       TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
#       THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF
#       CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
#       DEALINGS IN THE SOFTWARE.
#
# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: crnrstn_user
#  VERSION :: 2.00.0000
#  DATE :: September 11, 2012 1720hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: We put a hood on CRNRSTN ::,...complete with seats and a steering wheel...for the user.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_user{

    protected $oLogger;
    protected $oCRNRSTN_ENV;
    protected $oCRNRSTN_AUTH;
    protected $oCRNRSTN_ACCNT;
    protected $oCRNRSTN_VSC;
    protected $oCRNRSTN_TRM;
    private static $oDB_CRNRSTN;
    private static $oRedirectCntrlr;
    private static $oMySQLi_ARRAY = array();
    private static $oMySQLi_hash_ARRAY = array();
    private static $oSqlSilo;
    private static $oPaginator;
    private static $oCommRichMediaProvider;
    protected $oSoapClient;
    protected $oCRNRSTN_UX;
    private static $oCRNRSTN_CSS_VALIDATOR;

    public $config_serial;
    public $account_serial;
    private static $resourceKey;

    private static $oLog_ProfileManager;

    public $cache_ttl_default = 80;
    public $useCURL_default = true;
    protected $secret_key_override_ARRAY = array();
    protected $cipher_override_ARRAY = array();
    protected $hmac_algorithm_override_ARRAY = array();
    protected $options_bitwise_override_ARRAY = array();
    protected $WSDL_cache_ttl_ARRAY = array();
    protected $nusoap_useCURL_ARRAY = array();

    private static $form_handle_ARRAY = array();
    private static $form_input_general_ARRAY = array();
    private static $form_input_hidden_ARRAY = array();
    private static $form_input_transaction_copy_ARRAY = array();
    private static $formIntegrationPacket_ARRAY = array();
    private static $formIntegrationPacketReceived_ARRAY = array();
    private static $http_param_handle_ARRAY = array();
    private static $formIntegrationIsset_ARRAY = array();
    private static $formIntegrationErr_ARRAY = array();
    private static $formIntegrationIcon_ARRAY = array();
    private static $adHocVariable_ARRAY = array();

    public $query_ttl;
    public $oLog_output_ARRAY = array();
    public $ini_set_ARRAY = array();
    public $starttime;
    public $CRNRSTN_debugMode;
    public $PHPMAILER_debugMode;
    public $log_silo_profile;
    public $env_cleartext_name;
    public $tmp_wcr_config_envKey;
    public $system_resource_constants;
    public $system_output_channel_constants;
    public $sys_notices_creative_mode;
    public $crnrstn_resources_http_path;

    protected $oMessenger_ARRAY = array();
    private static $bitwise_serialization_cnt = 0;
    protected $is_soap_data_tunnel_endpoint = false;
    public $destruct_output = '';
    public $ui_module_state_response_output = '';
    public $soap_data_tunnel_output = '';
    public $response_header_attribute_ARRAY = array();

    private static $lang_content_ARRAY = array();
    public $version_crnrstn;
    public $version_apache;
    public $version_apache_sysimg;
    public $version_php;
    public $version_mysqli;
    public $version_soap;

    public $country_iso_code = 'en';

    /*

    TYPE HINTS ::
    Class/interface name	The value must be an instanceof the given class or interface.
    self	                The value must be an instanceof the same class as the one in which the type declaration is used. Can only be used in classes.
    parent	                The value must be an instanceof the parent of the class in which the type declaration is used. Can only be used in classes.
    array	                The value must be an array.
    callable	            The value must be a valid callable. Cannot be used as a class property type declaration.
    bool	                The value must be a boolean value.
    float	                The value must be a floating point number.
    int	                    The value must be an integer.
    string	                The value must be a string.
    iterable	            The value must be either an array or an instanceof Traversable.	    PHP 7.1.0
    object	                The value must be an object.	                                    PHP 7.2.0
    mixed	                The value can be any value.	                                        PHP 8.0.0

    */

    public function __construct($oCRNRSTN_ENV){

        //
        // STORE CRNRSTN :: ENVIRONMENTALS
        $this->oCRNRSTN_ENV = $oCRNRSTN_ENV;

        $this->config_serial = $this->oCRNRSTN_ENV->config_serial;
        self::$resourceKey = $this->oCRNRSTN_ENV->return_resource_key();
        $this->oLog_output_ARRAY = $oCRNRSTN_ENV->oLog_output_ARRAY;
        $this->response_header_attribute_ARRAY = $oCRNRSTN_ENV->response_header_attribute_ARRAY;
        $this->destruct_output = $oCRNRSTN_ENV->destruct_output;
        $this->starttime = $oCRNRSTN_ENV->starttime;
        $this->CRNRSTN_debugMode = $oCRNRSTN_ENV->CRNRSTN_debugMode;
        $this->PHPMAILER_debugMode = $oCRNRSTN_ENV->PHPMAILER_debugMode;
        $this->version_crnrstn = $oCRNRSTN_ENV->version_crnrstn;
        $this->version_apache = $oCRNRSTN_ENV->version_apache;
        $this->version_apache_sysimg = $oCRNRSTN_ENV->version_apache_sysimg;
        $this->version_php = $oCRNRSTN_ENV->version_php;

        $this->log_silo_profile = $oCRNRSTN_ENV->log_silo_profile;
        $this->tmp_wcr_config_envKey = $this->env_cleartext_name = $oCRNRSTN_ENV->env_cleartext_name;
        $this->system_resource_constants = $oCRNRSTN_ENV->system_resource_constants;
        $this->system_output_channel_constants = $oCRNRSTN_ENV->system_output_channel_constants;
        $this->sys_notices_creative_mode = $oCRNRSTN_ENV->sys_notices_creative_mode;
        $this->crnrstn_resources_http_path = $oCRNRSTN_ENV->crnrstn_resources_http_path;
        self::$oLog_ProfileManager = $oCRNRSTN_ENV->return_oLog_ProfileManager();
        self::$oLog_ProfileManager->sync_to_environment(NULL, $oCRNRSTN_ENV, $this);

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging($this->CRNRSTN_debugMode, __CLASS__, $this->log_silo_profile, $this);

        //
        // INITIALIZE CRNRSTN :: CHANNEL
        $this->init_channel();

        //
        // INITIALIZE CRNRSTN :: ERROR HANDLING
        $this->initializeErrorHandling();

        //
        // CLEAR ENV oLOG OUTPUT ARRAY TO FREE MEMORY
        array_splice($oCRNRSTN_ENV->oLog_output_ARRAY, 0);

        $this->oCRNRSTN_ENV->oCRNRSTN_LANG_MGR->initialize_oCRNRSTN_USR($this);
        $this->oCRNRSTN_ENV->oHTTP_MGR->initialize_oCRNRSTN_USR($this);
        $this->oCRNRSTN_ENV->oMYSQLI_CONN_MGR->initialize_oCRNRSTN_USR($this);
        $this->oCRNRSTN_ENV->oCOOKIE_MGR->initialize_oCRNRSTN_USR($this);
        $this->oCRNRSTN_ENV->oSESSION_MGR->initialize_oCRNRSTN_USR($this);

        //
        // INSTANTIATE CRNRSTN :: SYSTEM EMAIL CONTENT HELPER CLASS
        self::$oCommRichMediaProvider = new crnrstn_image_v_html_content_manager($this);

        //
        // INSTANTIATE QUERY SILO
        self::$oSqlSilo = new crnrstn_database_sql_silo($this);

        //
        // INSTANTIATE DATABASE CONNECTION/QUERY/RESPONSE HANDLING INTEGRATIONS CRNRSTN
        self::$oDB_CRNRSTN = new crnrstn_database_crnrstn($this);

        //
        // INSTANTIATE REDIRECT CONTROLLER
        self::$oRedirectCntrlr = new crnrstn_redirect_controller($this);

        //
        // INSTANTIATE PAGINATOR
        self::$oPaginator = new crnrstn_results_paginator($this);

        self::$lang_content_ARRAY = $this->oCRNRSTN_ENV->return_lang_content_ARRAY();

        //
        // INSTANTIATE UX MANAGER
        $this->oCRNRSTN_UX = new crnrstn_ux_manager($this);

    }



//        else{
//
//            //
//            // REMOVE crnrstn_l FROM LINK AND RETURN
//            if($this->isSSL()){
//
//                $tmp_uri = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//
//            }else{
//
//                $tmp_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//
//            }
//
//            $tmp_uri = $this->proper_replace('crnrstn_l=','crnrstn_x=',$tmp_uri);
//
//            header("Location: $tmp_uri");
//            exit();
//
//        }

        /* Sunday May 9, 2021 1000hrs

        REDIRECT ON INVALID GET REQUEST
         - 503 ERROR
         - REDIRECT TO SIGN IN FORM
        */

//        return true;
//
//    }

     public function reset_auth_account(){

        //
        // CHECK FOR EXISTING SESSION
        if($this->isset_session_param('CRNRSTN_AUTHORIZED_ACCOUNT_STATUS')){

            $tmp_status = $this->get_session_param('CRNRSTN_AUTHORIZED_ACCOUNT_STATUS');

            if($tmp_status == 'AUTH_ACTIVE'){

                $this->toggle_bit(CRNRSTN_AUTHORIZED_ACCOUNT, false);
                $this->set_session_param('CRNRSTN_AUTHORIZED_ACCOUNT_STATUS', 'LOGGED_OUT');

                if($this->isset_session_param('CRNRSTN_AUTHORIZED_ACCOUNT')){

                    $tmp_oAUTH_ACCNT = $this->get_session_param('CRNRSTN_AUTHORIZED_ACCOUNT');

                    if(!is_object($tmp_oAUTH_ACCNT)){

                        $this->oCRNRSTN_AUTH = new crnrstn_user_auth($this);

                    }else{

                        if($tmp_oAUTH_ACCNT->is_expired()){

                            $this->oCRNRSTN_AUTH = new crnrstn_user_auth($this);

                        }else{

                            $this->oCRNRSTN_AUTH = $tmp_oAUTH_ACCNT;
                            $this->oCRNRSTN_AUTH->is_logged_in(false);

                        }

                    }

                }

                //
                // SYNC SESSION WITH THE USER OBJECT
                $this->set_session_param('CRNRSTN_AUTHORIZED_ACCOUNT', $this->oCRNRSTN_AUTH);

            }else{

                error_log(__LINE__ . ' user init auth SOMETHING HERE.....');

            }

        }else{

            //
            // NO SESSION ACCOUNT STATE IS SET.
            $this->oCRNRSTN_AUTH = new crnrstn_user_auth($this);
            $this->toggle_bit(CRNRSTN_AUTHORIZED_ACCOUNT, false);

            //
            // SYNC SESSION WITH THE USER OBJECT
            $this->set_session_param('CRNRSTN_AUTHORIZED_ACCOUNT', $this->oCRNRSTN_AUTH);

        }

    }

    private function init_channel(){

        $channel_selected_ARRAY = $this->return_set_bits($this->system_output_channel_constants);
        $tmp_sel_cnt = count($channel_selected_ARRAY);

        //
        // MAINTAIN INTEGRITY OF DEVICE DETECTION SITUATION
        if( $tmp_sel_cnt == 0 || $tmp_sel_cnt > 1){

            //
            // SET (OR RESET) THIS DATA. THERE SHOULD ALWAYS AND ONLY BE ONE.
            $tmp_bit = $this->sync_device_detected();
            error_log(__LINE__ . ' user $tmp_bit=' . print_r($tmp_bit, true));
            $this->toggle_bit($tmp_bit, true);

        }

    }

    private function aggregate_parse_header_array($header_array, $overwrite_existing = true){

        foreach($header_array as $key0 => $header_elem){

            $tmp_attribute_value = '';
            $tmp_array = explode(':', $header_elem);

            foreach($tmp_array as $key1 => $str){

                if($key1 == 0){

                    $tmp_attribute_name = $str;

                }else{

                    if($tmp_attribute_value != ''){

                        $tmp_attribute_value .= ':' . $str;

                    }else{

                        $tmp_attribute_value .= $str;

                    }

                }

            }

            //
            // BRING HEADER SITUATION INTO CRNRSTN ::
            if(isset($tmp_array[0])){

                $this->add_header_attribute($tmp_attribute_name, $tmp_attribute_value, $overwrite_existing);

            }

        }

    }

    private function apply_headers(){

        foreach($this->response_header_attribute_ARRAY['header'] as $key => $headers_attribute){

            if($this->response_header_attribute_ARRAY['overwrite_existing'][$key] == 1){

                header($headers_attribute, true);

            }else{

                header($headers_attribute, false);

            }

        }

    }

    private function add_header_attribute($name, $value, $overwrite_existing = false){

        $this->response_header_attribute_ARRAY['header'][] = $name . ': ' . $value;

        if($overwrite_existing){

            $this->response_header_attribute_ARRAY['overwrite_existing'][] = 1;

        }else{

            $this->response_header_attribute_ARRAY['overwrite_existing'][] = 0;

        }

        $this->response_header_attribute_ARRAY['log'] .= $name . ', ';

    }

    private function return_signature_headers(){

        $tmp_date = date('D, M j Y G:i:s T', strtotime('now'));
        $tmp_date_expire = date('D, M j Y G:i:s T', strtotime('- 42 seconds'));
        $tmp_date_lastmod = date('D, M j Y G:i:s T', strtotime('- 420 seconds'));

        $tmp_array = array();
        $tmp_array[] = 'Content-Language: '.$this->country_iso_code;
        $tmp_array[] = 'Content-Type: text/html; charset=UTF-8';
        $tmp_array[] = 'Date: ' . $tmp_date;
        $tmp_array[] = 'Expires: ' . $tmp_date_expire;
        $tmp_array[] = 'Last-Modified: ' . $tmp_date_lastmod;
        $tmp_array[] = 'X-Powered-By: CRNRSTN :: v' . $this->version_crnrstn;

        return $tmp_array;

    }

    public function proper_response_return($response = NULL, $header_options_array = NULL, $crnrstn_response_profile_key = NULL){

        $tmp_curr_headers_ARRAY = headers_list();
        $tmp_crnrstn_signature_headers_ARRAY = $this->return_signature_headers();

        //
        // ENSURE ALL SIGNATURE HEADERS ARE IN PLACE AND CONTINUE
        $this->aggregate_parse_header_array($tmp_curr_headers_ARRAY);
        $this->aggregate_parse_header_array($tmp_crnrstn_signature_headers_ARRAY);

        //
        // RESPONSE HEADER CONSTRUCTION
        if(isset($header_options_array)){

            /*
            TAKE CURRENT HEADERS...
                - FORCE INJECT SIGNATURE HEADERS
                    - FORCE INJECT ANY PROVISIONAL HEADERS

            */

            //
            // USE PROVISIONAL HEADERS (APPLY THEM AT THE END FOR OVERWRITE PROTECTION)
            $this->aggregate_parse_header_array($header_options_array);

        }

        if(isset($crnrstn_response_profile_key)){

            switch($crnrstn_response_profile_key){
                case 'RESPONSE_STICKY':

                    $tmp_array = array();
                    $tmp_array[] = 'Cache-Control: max-age=0';
                    $tmp_array[] = 'X-Frame-Options: SAMEORIGIN';
                    $this->aggregate_parse_header_array($tmp_array);

                    $this->apply_headers();
                    echo $response;
                    exit;

                break;
                case 'REDIRECT_SANS_POST':
                    // PERMANENT = 301
                    // TEMPORARY = 307
                    // header("Location: /foo.php", true, 307); // THE BOOL == "ALLOW DUPLICATE HEADER ENTRIES"...WHICH MAY BE FASTER.

                    $this->apply_headers();
                    header("Location: $response", true, 307);
                    exit;

                break;
                case 'POST_REDIRECT':
                    // PERMANENT = 301
                    // TEMPORARY = 307
                    // header("Location: /foo.php", true, 307); // THE BOOL == "ALLOW DUPLICATE HEADER ENTRIES"...WHICH MAY BE FASTER.

                    $tmp_array = array();
                    $tmp_array[] = 'Cache-Control: max-age=0';
                    $tmp_array[] = 'X-Frame-Options: SAMEORIGIN';
                    $this->aggregate_parse_header_array($tmp_array);

                    $this->apply_headers();
                    header("Location: $response", true, 303);
                    exit;

                break;
                case 'RESPONSE_SANS_POST':
                default:
                    //
                    // BASIC PAGE RESPONSE RETURN

                    $this->apply_headers();
                    return $response;

                break;

            }

        }else{

            $this->apply_headers();
            return $response;

        }

        #####
        // SOURCE :: https://www.php.net/manual/en/function.header.php#78470
        // AUTHOR :: Dylan at WeDefy dot com :: https://www.php.net/manual/en/function.header.php#78470
        // The HTTP status code changes the way browsers and robots handle redirects, so if you are using
        // header(Location:) it's a good idea to set the status code at the same time.  Browsers typically
        // re-request a 307 page every time, cache a 302 page for the session, and cache a 301 page for
        // longer, or even indefinitely.  Search engines typically transfer "page rank" to the new location
        // for 301 redirects, but not for 302, 303 or 307. If the status code is not specified,
        // header('Location:') defaults to 302.
        //
        //        // 307 Temporary Redirect
        //        header("Location: /foo.php", true, 307); // THE BOOL == "ALLOW DUPLICATE HEADER ENTRIES"...WHICH MAY BE FASTER.
        #####

        #####
        // SOURCE :: https://www.php.net/manual/en/function.header.php
        // AUTHOR :: nospam at nospam dot com :: https://www.php.net/manual/en/function.header.php#119014
        //        // Response codes behaviors when using
        //        header('Location: /target.php', true, $code) to forward user to another page:
        //
        //        $code = 301;
        //        // Use when the old page has been "permanently moved and any future requests should be
        //           sent to the target page instead. PageRank may be transferred."
        //
        //        $code = 302; (default)
        //        // "Temporary redirect so page is only cached if indicated by a Cache-Control or
        //           Expires header field."
        //
        //        $code = 303;
        //        // "This method exists primarily to allow the output of a POST-activated script to
        //           redirect the user agent to a selected resource. The new URI is not a substitute
        //           reference for the originally requested resource and is not cached."
        //
        //        $code = 307;
        //        // Beware that when used after a form is submitted using POST, it would carry over the
        //           posted values to the next page, such if target.php contains a form processing script,
        //           it will process the submitted info again!
        //
        //        // In other words, use 301 if permanent, 302 if temporary, and 303 if a results page
        //           from a submitted form.
        //        // Maybe use 307 if a form processing script has moved.
        #####

        #####
        //        /* Redirect to a different page in the current directory that was requested */
        //        $host  = $_SERVER['HTTP_HOST'];
        //        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        //        $extra = 'mypage.php';
        //        header("Location: http://$host$uri/$extra");
        //        exit;
        #####

        #####
        //        // We'll be outputting a PDF
        //        header('Content-Type: application/pdf');
        //
        //        // It will be called downloaded.pdf
        //        header('Content-Disposition: attachment; filename="downloaded.pdf"');
        //
        //        // The PDF source is in original.pdf
        //        readfile('original.pdf');
        #####

    }

    public function account_get_resource($data_type){

        if($this->oCRNRSTN_AUTH->is_set()){

            error_log(__LINE__ . ' user account_get_resource isset=true and requesting $data_type=[' . $data_type . ']');

            return $this->oCRNRSTN_AUTH->account_get_resource($data_type);

        }else{
            error_log(__LINE__ . ' user account_get_resource isset=false and requesting $data_type=[' . $data_type . ']');

            switch($data_type){
                case 'max_seconds_inactive':

                    return $this->oCRNRSTN_ENV->return_max_seconds_inactive();

                break;
                case 'max_login_attempts':

                    return $this->oCRNRSTN_ENV->return_max_login_attempts();

                break;

            }

        }

        return false;

    }

    public function account_max_secs_inactive($secs_override = NULL){

        if(isset($this->oCRNRSTN_AUTH)){

            if($this->oCRNRSTN_AUTH->is_set()){

                return $this->account_max_secs_inactive($secs_override);

            }else{

                return $this->oCRNRSTN_ENV->return_max_seconds_inactive();

            }

        }else{

            return $this->oCRNRSTN_ENV->return_max_seconds_inactive();

        }

    }

    public function account_max_login_attempts($count_override = NULL){

        if(isset($this->oCRNRSTN_AUTH)){

            if($this->oCRNRSTN_AUTH->is_set()){

                return $this->account_get_resource('max_login_attempts');

            }else{

                return $this->oCRNRSTN_ENV->return_max_login_attempts();

            }

        }else{

            return $this->oCRNRSTN_ENV->return_max_login_attempts();

        }

    }

    public function account_remaining_login_attempts($count_override = NULL){

        if(isset($this->oCRNRSTN_AUTH)){

            if($this->oCRNRSTN_AUTH->is_set()){

                return $this->oCRNRSTN_AUTH->account_remaining_login_attempts($count_override);

            }else{

                return $this->oCRNRSTN_ENV->return_max_login_attempts();

            }

        }else{

            return $this->oCRNRSTN_ENV->return_max_login_attempts();

        }

    }


//    public function return_max_seconds_inactive(){
//
//        return $this->oCRNRSTN_ENV->return_max_seconds_inactive();
//
//    }

//    private function return_max_login_attempts($meta_type = 'counts'){
//
//        return $this->oCRNRSTN_ENV->return_max_login_attempts();
//
//    }

//    public function return_login_attempts($meta_type = 'count'){
//
//        switch($meta_type){
//            case 'max':
//
//                return $this->return_max_login_attempts();
//
//            break;
//            case 'remaining':
//
//                if(isset($this->oCRNRSTN_AUTH)) {
//
//                    return $this->oCRNRSTN_AUTH->return_login_attempts_remaining();
//
//                }else{
//
//                    return $this->return_max_login_attempts();
//
//                }
//
//            break;
//            default:
//
//                if(isset($this->oCRNRSTN_AUTH)){
//
//                    return $this->oCRNRSTN_AUTH->return_login_attempts();
//
//                }
//
//            break;
//
//        }
//
//        return 0;
//
//    }

    /*
    // ** MySQL settings - You can get this info from your web host ** //
    /** The name of the database for WordPress
    define( 'DB_NAME', $oCRNRSTN_USR->wp_DB_NAME());
    */
    public function wp_db_name(){

        return $this->oCRNRSTN_ENV->wp_db_name();

    }

    /*
    * MySQL database username * /
    define( 'DB_USER', $oCRNRSTN_USR->wp_DB_USER());
    */
    public function wp_db_user(){

        return $this->oCRNRSTN_ENV->wp_db_user();

    }

    /*
    /** MySQL database password * /
    define( 'DB_PASSWORD', $oCRNRSTN_USR->wp_DB_PASSWORD());
    */
    public function wp_db_password(){

        return $this->oCRNRSTN_ENV->wp_db_password();

    }

    /*
    /** MySQL hostname * /
    define( 'DB_HOST', $oCRNRSTN_USR->wp_DB_HOST());
    */
    public function wp_db_host(){

        return $this->oCRNRSTN_ENV->wp_db_host();

    }

    /*
    /** Database Charset to use in creating database tables. * /
    define( 'DB_CHARSET', $oCRNRSTN_USR->wp_DB_CHARSET());
    */
    public function wp_db_charset(){

        return $this->oCRNRSTN_ENV->wp_db_charset();

    }

    /*
    /** The Database Collate type. Don't change this if in doubt. * /
    define( 'DB_COLLATE', $oCRNRSTN_USR->wp_DB_COLLATE());
    */
    public function wp_db_collate(){

        return $this->oCRNRSTN_ENV->wp_db_collate();

    }

    /*
    define( 'AUTH_KEY', $oCRNRSTN_USR->wp_AUTH_KEY());
    */
    public function wp_auth_key(){

        return $this->oCRNRSTN_ENV->wp_auth_key();

    }

    /*
    define( 'SECURE_AUTH_KEY', $oCRNRSTN_USR->wp_SECURE_AUTH_KEY());
    */
    public function wp_secure_auth_key(){

        return $this->oCRNRSTN_ENV->wp_secure_auth_key();

    }

    /*
    define( 'LOGGED_IN_KEY', $oCRNRSTN_USR->wp_LOGGED_IN_KEY());
    */
    public function wp_logged_in_key(){

        return $this->oCRNRSTN_ENV->wp_logged_in_key();

    }

    /*
    define( 'NONCE_KEY', $oCRNRSTN_USR->wp_NONCE_KEY());
    */
    public function wp_nonce_key(){

        return $this->oCRNRSTN_ENV->wp_nonce_key();

    }

    /*
    define( 'AUTH_SALT', $oCRNRSTN_USR->wp_AUTH_SALT());
    */
    public function wp_auth_salt(){

        return $this->oCRNRSTN_ENV->wp_auth_salt();

    }

    /*
    define( 'SECURE_AUTH_SALT', $oCRNRSTN_USR->wp_SECURE_AUTH_SALT());
    */
    public function wp_secure_auth_salt(){


        return $this->oCRNRSTN_ENV->wp_secure_auth_salt();

    }

    /*
    define( 'LOGGED_IN_SALT', $oCRNRSTN_USR->wp_LOGGED_IN_SALT());
    */
    public function wp_logged_in_salt(){

        return $this->oCRNRSTN_ENV->wp_logged_in_salt();

    }

    /*
    define( 'NONCE_SALT', $oCRNRSTN_USR->wp_NONCE_SALT());
    */
    public function wp_nonce_salt(){

        return $this->oCRNRSTN_ENV->wp_nonce_salt();

    }

    /*
    $table_prefix = $oCRNRSTN_USR->wp_TABLE_PREFIX();
    */
    public function wp_table_prefix(){

        return $this->oCRNRSTN_ENV->wp_table_prefix();

    }

    public function wp_debug(){

        if($this->oCRNRSTN_ENV->is_bit_set(CRNRSTN_WORDPRESS_DEBUG)){

            return true;

        }else{

            if($this->oCRNRSTN_ENV->wp_debug()){

                return true;

            }else{

                return false;

            }

        }

    }

    public function return_admin_ARRAY(){

        return $this->oCRNRSTN_ENV->return_admin_ARRAY();

    }

    public function update_admin_ARRAY($tmp_array){

        return $this->oCRNRSTN_ENV->update_admin_ARRAY($tmp_array);

    }

    public function __SOAP_service_listen(){

        if(!$this->isset_HTTPSuper('GET')){
            error_log(__LINE__.' '.__METHOD__.' WE HAVE NO _GET....');
            //if($oCRNRSTN_USR->exclusiveAccess('184.173.96.66, 50.87.249.11, 172.16.110.130, 172.16.*')){

            //$server->service(file_get_contents('php://input'));

            //}else{

            //    $oCRNRSTN_USR->return_server_resp_status(403);

            //}

            //$this->print_r(file_get_contents('php://input'));


        }else{

            error_log(__LINE__.' '.__METHOD__.' WE HAVE _GET....');

//            if($this->http){
//
//
//            }

            $this->print_r(file_get_contents('php://input'),'SOAP LISTENER TEST',NULL, __LINE__,__METHOD__,__FILE__);
            //$server->service(file_get_contents('php://input'));

        }

        //$this->print_r("die();");
        error_log(__LINE__.' '.__METHOD__.' WE HAVE die()....');

        //die();

    }

    public function return_serialized_bit_nom($bit_family){

        //
        // $bit_family = CLIENT_REQUESTED_PERMISSIONS, SERVER_AUTH_CONN_PERMISSIONS, SERVER_AUTH_CLIENT_PERMISSIONS
        return $this->oCRNRSTN_ENV->return_serialized_bit_nom($bit_family);

    }

    public function is_soap_data_tunnel_endpoint($set_value = NULL){

        if(isset($set_value)){

            $this->is_soap_data_tunnel_endpoint = $set_value;
            $this->oCRNRSTN_ENV->is_soap_data_tunnel_endpoint($set_value);

            return true;

        }else{

            return $this->is_soap_data_tunnel_endpoint;

        }

    }

    public function return_active_log_silo_keys($output_type = 'string'){

        $output_type = trim(strtolower($output_type));

        $active_log_silo_flag_ARRAY = $this->oLogger->return_active_log_silo_keys();

        switch($output_type){
            case 'print_r':

                $this->print_r($active_log_silo_flag_ARRAY, '', NULL, __LINE__, __METHOD__, __FILE__);

            break;
            case 'array':

                return $active_log_silo_flag_ARRAY;

            break;
            default:

                $tmp_str = '';

                foreach($active_log_silo_flag_ARRAY as $siloKey => $flagset){

                    $tmp_str .= $siloKey.', ';

                }

                $tmp_str = rtrim($tmp_str,', ');

                return $tmp_str;

            break;

        }

    }

    public function return_SOAP_SVC_debugMode(){

        return $this->oCRNRSTN_ENV->return_SOAP_SVC_debugMode();

    }

    public function return_resource_key(){

        return self::$resourceKey;

    }

    public function client_request_listen(){

        //
        // CRNRSTN :: SOAP DATA TUNNEL
        $this->soap_data_tunnel_output = $this->SOAP_client_request_listener();

        //
        // IF SESSION HAS BEEN INITIALIZED WITH oUSER_AUTH OBJECT, SYNC WITH SESSION AT THIS TIME.
        $this->crnrstn_session_load();

        //
        // CRNRSTN :: CONSOLE DASHBOARD PORTAL ENTRY POINT
        $tmp_html = $this->user_request_listener();
        if(is_string($tmp_html) && strlen($tmp_html) > 0){

            return $tmp_html;

        }

        //
        // BASE64 IMAGE HELPER where, crnrstn_to_base64=imgs/png/j5_wolf_pup_lil_5_pts.png
        if($tmp_html = $this->base64_asset_path_listener()){

            return $tmp_html;

        }

//        //
//        // STICKY LINK CHECK
//        if($tmp_html = $this->sticky_uri_listener()){
//
//            $this->proper_response_return($tmp_html, NULL, 'RESPONSE_STICKY');
//
//        }

        //
        // SOAP SERVER INITIALIZATION PING - CRNRSTN :: SOAP SERVICES LAYER
        //if($result = $this->initProxyCommListener()){
        //if($SOAP_response = $this->SOAP_service_listen()){
        //    echo $SOAP_response;
        //    die();
        //
        //}

        return NULL;

    }

    // SOURCE :: https://www.php.net/manual/en/function.parse-url.php
    // AUTHOR :: ivijan dot stefan at gmail dot com :: https://www.php.net/manual/en/function.parse-url.php#114704
    public function return_youtube_embed($url, $width = 560, $height = 315, $fullscreen = true){

        parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
        $youtube= '<iframe allowtransparency="true" scrolling="no" width="'.$width.'" height="'.$height.'" src="//www.youtube.com/embed/'.$my_array_of_vars['v'].'" frameborder="0"'.($fullscreen?' allowfullscreen':NULL).'></iframe>';

        return $youtube;

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

        //error_log(__LINE__. ' user $tmp_url_parse_array=' . print_r($tmp_url_parse_array, true));

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

                        $tmp_return_str .= $param_concatenator . $this->url_param_append($key00.'='.$value00, $tunnel_encrypt);

                        if($tunnel_encrypt){

                            $tmp_encrypted_params_pipe .= $key00 . '|';

                        }

                        if($param_concatenator == '?'){

                            $param_concatenator = '&';

                        }

                    }

                }else{

                    $tmp_flag_param_ARRAY[$key00] = 1;

                    $tmp_return_str .= $param_concatenator . $this->url_param_append($key00.'='.$value00, $tunnel_encrypt);

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

            $tmp_return_str .= $param_concatenator . 'crnrstn_encrypt_tunnel='.urlencode($this->param_tunnel_encrypt($tmp_encrypted_params_pipe));

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

                    $tmp_str .= urlencode($this->param_tunnel_encrypt($tmp_array[1]));

                }else{

                    $tmp_str .= $tmp_array[1];

                }

            }else{

                $tmp_str .= $this->param_tunnel_encrypt('');

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

    public function sync_back_link_state(){

        $this->oCRNRSTN_UX->sync_back_link_state();

    }

    private function return_param_name($param_str){

        $tmp_array = explode('=', $param_str);

        return $tmp_array[0];

    }

    public function return_back_link(){

        return $this->oCRNRSTN_UX->return_back_link();

    }

    public function SOAP_client_request_listener($output_type = 'print_r'){

        $output_type = strtolower($output_type);

        //
        // IF SOAP CLIENT IS INITIALIZED
        if($this->SOAP_isset_soap_client()){

            $tmp_oNUSOAP_BASE = new nusoap_base();

            $this->version_soap = $tmp_oNUSOAP_BASE->title;             //'NuSOAP';
            $this->version_soap .= $tmp_oNUSOAP_BASE->version;          //' v0.9.5';
            $this->version_soap .= $tmp_oNUSOAP_BASE->revision;         //' $Revision: 1.123 $';

            $tmp_revision_soap = $this->proper_replace('Revision:','', $tmp_oNUSOAP_BASE->revision);
            $tmp_revision_soap .= $this->proper_replace('$','', $tmp_revision_soap);
            $tmp_revision_soap .= trim($tmp_revision_soap);

            $tmp_user_agent = 'User-Agent: '.$tmp_oNUSOAP_BASE->title.'/'.$tmp_oNUSOAP_BASE->version.' ('.$tmp_revision_soap.') CRNRSTN :: v'.$this->version_crnrstn;

            //
            // TEXTAREA OUTPUT IN FORM WITH SUBMIT BUTTON
            $tmp_crnrstn_soap_data_tunnel_output = $this->SOAP_return_client_request();
            $tmp_content_length = strlen($tmp_crnrstn_soap_data_tunnel_output);
            $tmp_content_length = 'Content-Length: '.$tmp_content_length;

            $tmp_config_wsdl = $this->get_resource('WSDL_URI', 'CRNRSTN::INTEGRATIONS');

            if(!(strlen($tmp_config_wsdl) > 0)){

                //
                // SOMETHING FOR NOW
                $tmp_config_wsdl = 'http://jony5.com/_crnrstn/soa/?wsdl';

            }

            switch($output_type){
                case 'form_integrations':
                    // <?xml version="1.0" encoding="iso-8859-1"

                    $tmp_crnrstn_soap_data_tunnel_output = 'HELLO WORLD!';
                    $tmp_html = '<!DOCTYPE html>';
//                    $tmp_html = '<!DOCTYPE html>
//<html lang="en">
//<head>
//    <style>
//        body                        { text-align: center; margin:0px auto;}
//        p                           { padding:10px 0 0 20px; font-size: 18px;}
//	    .debug_output				{ font-size:10px; height:400px;overflow:scroll;border-bottom:2px solid #333;padding:10px 0 0 20px;}
//    </style>
//</head>
//<body>
//<div style="height:20px; width:100%; clear:both; display: block; overflow: hidden;"></div>
//<form action="'.$tmp_config_wsdl.'" method="post">
//<div style="padding-bottom: 20px;"><textarea name="crnrstn_soap_data_tunnel" cols="30" rows="50"></textarea></div>
//<button type="submit" style="width:150px; height:30px; text-align: center; font-weight: bold;">SUBMIT</button>
//</form><br><br>
//'.$tmp_crnrstn_soap_data_tunnel_output.'
//<pre class="debug_output">'.$this->return_CRNRSTN_ASCII_ART(0).'</pre>
//
//<br>
//
//
//</body>
//</html>';


                break;
                case 'alpha_testing':

                    $this->init_form_handling('crnrstn_soap_data_tunnel_frm');
                    $this->init_input_listener('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_data', true);

                    $this->init_input_listener('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_soap_action', true);
                    $this->init_input_listener('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_layer_wsdl', true);
                    $this->init_input_listener('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_content_length', true);

                    $this->init_input_listener('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_layer_user_agent', true);
                    $this->init_input_listener('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_layer_host', true);

                    $this->init_input_listener('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_stime', true);
                    $this->init_input_listener('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_rtime', true);
                    $this->init_input_listener('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_ttl_wethrbug', true);
                    $this->init_input_listener('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_ttl_bassdrive_stats', true);
                    $this->init_input_listener('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_ttl_bassdrive_show', true);
                    $this->init_input_listener('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_ttl_truth_timer', true);
                    $this->init_input_listener('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_ttl_banner_rotate_desktop', true);
                    $this->init_input_listener('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_ttl_banner_rotate_tablet', true);
                    $this->init_input_listener('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_ttl_banner_rotate_mobile', true);
                    $this->init_input_listener('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_transport_protocol_version', true);
                    $this->init_input_listener('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_srvc_encoding', true);

                    $this->addHiddenFormInputParamListener('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_data_tunnel_data', 'crnrstn_soap_data_tunnel_data', true, $tmp_crnrstn_soap_data_tunnel_output);
                    $this->addHiddenFormInputParamListener('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_data_tunnel_soap_action', 'crnrstn_soap_data_tunnel_soap_action', true, 'urn:returnCRNRSTN_UI_GLOBAL_SYNCwsdl#returnCRNRSTN_UI_GLOBAL_SYNC');
                    $this->addHiddenFormInputParamListener('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_data_tunnel_content_type', 'crnrstn_soap_data_tunnel_content_type', true, 'text/xml; charset='.$tmp_oNUSOAP_BASE->soap_defencoding);
                    $this->addHiddenFormInputParamListener('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_data_tunnel_content_length', 'crnrstn_soap_data_tunnel_content_length', true, $tmp_content_length);
                    $this->addHiddenFormInputParamListener('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_data_tunnel_user_agent', 'crnrstn_soap_data_tunnel_user_agent', true, $tmp_user_agent);
                    $this->addHiddenFormInputParamListener('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_data_tunnel_host', 'crnrstn_soap_data_tunnel_host', true, $_SERVER['SERVER_ADDR']);
                    $this->addHiddenFormInputParamListener('crnrstn_soap_data_tunnel_frm', 'crnrstn_soap_data_tunnel_host', 'crnrstn_soap_data_tunnel_encoding', true, $tmp_oNUSOAP_BASE->soap_defencoding);



                    $tmp_html = '<form action="'.$this->crnrstn_resources_http_path.'soa/tunnel/" method="post" id="crnrstn_sdt_frm" name="crnrstn_sdt_frm" enctype="multipart/form-data" >
<div style="padding-bottom: 20px;"><textarea id="crnrstn_soap_srvc_data" name="crnrstn_soap_srvc_data" cols="130" rows="5">'.$tmp_crnrstn_soap_data_tunnel_output.'</textarea></div>
<button type="submit" style="width:150px; height:30px; text-align: center; font-weight: bold;">SUBMIT</button>
<input type="hidden" name="crnrstn_soap_srvc_soap_action" value="urn:returnCRNRSTN_UI_GLOBAL_SYNCwsdl#returnCRNRSTN_UI_GLOBAL_SYNC">
<input type="hidden" name="crnrstn_soap_srvc_layer_wsdl" value="'.$tmp_config_wsdl.'">
<input type="hidden" name="crnrstn_soap_srvc_content_length" value="'.$tmp_content_length.'">
<input type="hidden" name="crnrstn_soap_srvc_layer_user_agent" value="'.$tmp_user_agent.'">
<input type="hidden" name="crnrstn_soap_srvc_layer_host" value="'.$_SERVER['SERVER_ADDR'].'">

<input type="hidden" name="crnrstn_soap_srvc_stime" value="'.$this->starttime.'">
<input type="hidden" name="crnrstn_soap_srvc_rtime" value="'.$this->wall_time().'">

<input type="hidden" name="crnrstn_soap_srvc_ttl_wethrbug" value="110">
<input type="hidden" name="crnrstn_soap_srvc_ttl_bassdrive_stats" value="20">
<input type="hidden" name="crnrstn_soap_srvc_ttl_bassdrive_show" value="45">
<input type="hidden" name="crnrstn_soap_srvc_ttl_truth_timer" value="30">
<input type="hidden" name="crnrstn_soap_srvc_ttl_banner_rotate_desktop" value="15">
<input type="hidden" name="crnrstn_soap_srvc_ttl_banner_rotate_tablet" value="7">
<input type="hidden" name="crnrstn_soap_srvc_ttl_banner_rotate_mobile" value="7">
<input type="hidden" name="crnrstn_soap_srvc_device_type" value="">
<input type="hidden" name="crnrstn_soap_srvc_transport_protocol_version" value="'.$this->version_soap.'">
<input type="hidden" name="crnrstn_soap_srvc_encoding" value="'.$tmp_oNUSOAP_BASE->soap_defencoding.'">
<input type="hidden" name="crnrstn_soap_srvc_response_format" value="soap-SOAP, soap;q=0.9, xml;0.7, json;0.1, csv;0, carrier_pigeon;-0.9">


'.$this->ui_content_module_out(CRNRSTN_UI_FORM_INTEGRATION_PACKET, 'crnrstn_soap_data_tunnel_frm').'
</form>
<pre class="debug_output">'.$this->return_CRNRSTN_ASCII_ART(0).'</pre>
';

                break;

                // case 'json':
                // case 'xml':
                default:

                    //
                    // print_r
                    $tmp_crnrstn_soap_data_tunnel_output = $this->print_r_str($this->SOAP_return_client_request());

                break;

            }

//            $tmp_html = '<!DOCTYPE html>
//<html lang="en">
//<head>
//    <style>
//        body                        { text-align: center; margin:0px auto;}
//        p                           { padding:10px 0 0 20px; font-size: 18px;}
//	    .debug_output				{ font-size:10px; height:400px;overflow:scroll;border-bottom:2px solid #333;padding:10px 0 0 20px;}
//    </style>
//</head>
//<body>
//<div style="height:20px; width:100%; clear:both; display: block; overflow: hidden;"></div>
//<form action="'.$tmp_config_wsdl.'" method="post">
//<div style="padding-bottom: 20px;"><textarea name="crnrstn_soap_data_tunnel" cols="30" rows="50"></textarea></div>
//<button type="submit" style="width:150px; height:30px; text-align: center; font-weight: bold;">SUBMIT</button>
//</form><br><br>
//'.$tmp_crnrstn_soap_data_tunnel_output.'
//<pre class="debug_output">'.$this->return_CRNRSTN_ASCII_ART(0).'</pre>
//
//<br>
//
//
//</body>
//</html>';

            return $tmp_html;

        }

        return '';

    }

    private function base64_asset_path_listener(){

        if($this->isset_HTTP_Param('crnrstn_to_base64', 'GET')){

            $tmp_filename = $this->extractData_HTTP('crnrstn_to_base64');

            $tmp_pos_png = strpos($tmp_filename, '.png');
            if($tmp_pos_png !== false){

                //
                // WE HAVE .PNG

            }else{

                $tmp_filename = $tmp_filename . '.png';

            }

            $tmp_file_path = $this->get_resource('DOCUMENT_ROOT') . $this->get_resource('DOCUMENT_ROOT_DIR') . '/_crnrstn/ui/imgs/png/' . $tmp_filename;

            if(is_file($tmp_file_path)){

                $tmp_encoding = $this->base64_encode_image($tmp_file_path, 'png');

                $tmp_html =  '<div style="height:20px; width:100%; clear:both; display: block; overflow: hidden;"></div>('.$this->crcINT($tmp_filename).' / '.$this->crcINT($tmp_filename).') <div style="height:15px; width:100%; clear:both; display: block; overflow: hidden;"></div><img src="' . $tmp_encoding . '" /><div style="height:20px; width:100%; clear:both; display: block; overflow: hidden;"></div><textarea cols="30" rows="50">' . $tmp_encoding . '</textarea>';

                $tmp_html = '<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body                        { text-align: center; margin:0px auto;}
        p                           { padding:10px 0 0 20px; font-size: 18px;}
	    .debug_output				{ font-size:10px; height:400px;overflow:scroll;border-bottom:2px solid #333;padding:10px 0 0 20px;}
    </style>
</head>
<body>
<div style="height:20px; width:100%; clear:both; display: block; overflow: hidden;"></div>
<form action="#" method="get">
<div style="padding-bottom: 20px;"><input name="crnrstn_to_base64" placeholder="Enter PNG name" value=""></div>
<button type="submit" style="width:150px; height:30px; text-align: center; font-weight: bold;">SUBMIT</button>
</form><br><br>
'.$tmp_html.'
<pre class="debug_output">'.$this->return_CRNRSTN_ASCII_ART(0).'</pre> 

<br>


</body>
</html>';

                return $tmp_html;

            }else{

                header("Location: http://css.validate.jony5.com/");
                exit();

            }

        }else{

            return false;

        }

    }

    private function user_request_listener(){

        //
        // ENABLE THIS PAGE TO RECEIVE HTTP POST/GET DATA
        if($this->initialize_crnrstn_svc_http(true, false)) {

            if($this->isset_crnrstn_svc_http()){

                //
                // LOGIN SUCCESS PATHWAY
                $tmp_form_handle = $this->extractData_HTTP('CRNRSTN_FORM_HANDLE', 'POST', true);
                switch($tmp_form_handle){
                    case 'signin':

                        error_log(__LINE__.' user :: LOGIN SUCCESS PATHWAY ['.$tmp_form_handle.']');

                        die();

                    break;
                    case 'crnrstn_validate_css':
                        error_log(__LINE__.' user :: CSS VALIDATOR PATHWAY ['.$tmp_form_handle.']');

                        //
                        // VALIDATE CSS
                        $raw_html_data = $this->extractData_HTTP('ugc_html', 'POST');

                        $tmp_validation_results_ARRAY = $this->validate_css($raw_html_data);

                        $tmp_validation_results = $tmp_validation_results_ARRAY['HTML_OUT'];

                        $tmp_key = $this->generate_new_key(50);

                        $this->set_session_param('CRNRSTN_CSS_VALIDATION_RESP', $tmp_validation_results);

                        $tmp_score_numeric_raw = $tmp_validation_results_ARRAY['SCORE_NUMERIC_RAW'];
                        $tmp_packet_size = $tmp_validation_results_ARRAY['PACKET_BYTES_SIZE'];
                        $tmp_run_time = $tmp_validation_results_ARRAY['WALLTIME'];
                        $tmp_run_time = $tmp_run_time . 'secs';

                        if ($this->isSSL()) {

                            $tmp_post_uri = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

                        } else {

                            $tmp_post_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

                        }

                        $pos_quest = strpos($tmp_post_uri, '?');
                        if ($pos_quest !== false) {

                            $tmp_post_uri = $tmp_post_uri . '&crnrstn_l=' . $this->param_tunnel_encrypt('css_validator') . '&crnrstn_css_rtime=' . urlencode($tmp_run_time) . '&bytes=' . urlencode($tmp_packet_size) . '&score=' . urlencode($tmp_score_numeric_raw);

                        } else {

                            $tmp_post_uri = $tmp_post_uri . '?crnrstn_l=' . $this->param_tunnel_encrypt('css_validator') . '&crnrstn_css_rtime=' . urlencode($tmp_run_time) . '&bytes=' . urlencode($tmp_packet_size) . '&score=' . urlencode($tmp_score_numeric_raw);

                        }

                        //
                        // SUPPORT BACK LINK FOR MIT LICENSE PAGE
                        $this->sync_back_link_state();

                        error_log(__LINE__ . ' user POST CSS $tmp_post_uri = ' . $tmp_post_uri);

                        //
                        // I WOULD LIKE TO SEE GOOGLE ANALYTICS DATA WITH CSS SCORES AND PERFORMANCE OF THE SYSTEM.
                        header("Location: " . $tmp_post_uri);
                        exit();

                    break;

                }

                //}else{
//
//                    error_log(__LINE__ . __METHOD__ . ' user $user_auth_check is true');
//
//                    //
//                    // SUPPORT BACK LINK FOR MIT LICENSE PAGE
//                    $this->sync_back_link_state();
//
//                    echo $this->ui_module_out('css_validator');
//                    exit();
//
//                }


            }else{

                //
                // LOGIN ERROR PATHWAY
                error_log(__LINE__.' user :: LOGIN ERROR PATHWAY');

                //
                // FORM INPUT ERROR HANDLING. CAN MANUALLY HANDLE REDIRECTS HERE IF DESIRED.
                $tmp_err_array = $this->returnErr_dataValidationCheck('POST');
                $test = '';

                foreach($tmp_err_array as $key => $chunkArray0) {
                    foreach ($chunkArray0 as $key0 => $val) {

                        $test .= $val . '<br>';

                    }
                }

                echo __LINE__ . ' ' . __METHOD__ . ' <br>' . $test;
                die();

                //
                // FORM INPUT ERROR HANDLING. CAN MANUALLY HANDLE REDIRECTS HERE IF DESIRED.
                $tmp_err_array = $this->returnErr_dataValidationCheck('GET');
                //$test = '';

                foreach($tmp_err_array as $key=>$val){

                    $test .= $val.'<br>';

                }

                $test .= '<br>'.session_id().'<br>';

                error_log(__LINE__.' user error='.$test);

            }

        }else{

            error_log(__LINE__.' user :: HTTP VAR PROCESSING :: NON-FORM-INTEGRATION PATHWAY');
            return $this->oCRNRSTN_VSC->return_client_response();

//
//                if ($this->oCRNRSTN_ENV->oHTTP_MGR->issetParam($_GET, 'crnrstn_l')) {
//
//                    if ($this->oCRNRSTN_ENV->oHTTP_MGR->issetParam($_GET, 'crnrstn_css_rtime')) {
//
//                        $tmp_output_html = $this->get_session_param('CRNRSTN_CSS_VALIDATION_RESP');
//
//                        if(strlen($tmp_output_html) > 1){
//
//                            echo $tmp_output_html;
//                            exit();
//
//                        }else{
//
//                            //
//                            // IF SESSION RETURNS NOTHING, JUST RELOAD THE FORM.
//                            echo $this->ui_module_out('css_validator');
//                            exit();
//
//                        }
//
//                    }
//
//                }
//
//            }
//
//            if($this->isset_HTTP_Param('crnrstn_l', 'GET')){
//
//                $tmp_req = $this->extractData_HTTP('crnrstn_l', true);
//                $tmp_mit = $this->extractData_HTTP('crnrstn_mit');
//                //$tmp_crnrstn_kivotos = $this->extractData_HTTP('crnrstn_kivotos');
//                $tmp_crnrstn_css_rtime = $this->extractData_HTTP('crnrstn_css_rtime');
//
//                if((strlen($tmp_mit) > 0) || (strlen($tmp_crnrstn_css_rtime) > 0)){
//
//                    if($tmp_mit != ''){
//
//                        return $this->ui_module_out('MIT_license');
//
//                    }else{
//                        error_log(__LINE__ . ' user DIE() crnrstn_css_rtime is set. get_session_param() result.....]');
//
//                        die();
//                        //
//                        // OUTPUT CSS VALIDATOR RESULTS PAGE FROM SESSION
//                        $tmp_validation_results = $this->get_session_param('CRNRSTN_CSS_VALIDATION_RESP');
//                        error_log(__LINE__ . ' crnrstn_css_rtime is set. get_session_param() results[' . strlen($tmp_validation_results).']');
//
//                        if(strlen($tmp_validation_results) > 1){
//
//                            $this->set_session_param('CRNRSTN_CSS_VALIDATION_RESP','0');
//
//                            //
//                            // RETURN CSS VALIDATION SCORE RESULTS PAGE
//                            header( 'Content-type: text/html; charset=utf-8' );
//                            echo $tmp_validation_results;
//
//                        }else{
//
//                            //
//                            // DATA ENTRY FORM PAGE. OR MAYBE THIS WILL BECOME SIGN IN FORM PAGE.
//                            echo $this->ui_module_out('css_validator');
//
//                        }
//
//                    }
//
//                }else{
//
//                    switch($tmp_req){
//                        case 'dashboard':
//
//                            return $this->ui_module_out($tmp_req);
//
//                        break;
//                        case 'signin':
//
//                            return $this->ui_module_out($tmp_req);
//
//                        break;
//                        case 'signin_m':
//
//                            return $this->ui_module_out($tmp_req);
//
//                        break;
//                        case 'css_validator':
//
//                            if($this->isset_HTTP_Param('crnrstn_r', 'GET')){
//
//                                $this->proper_response_return($this->sticky_uri_listener(), NULL, 'RESPONSE_STICKY');
//
//                            }else{
//
//                                if(strlen($tmp_crnrstn_css_rtime) > 0){
//
//                                    $tmp_validation_results = $this->get_session_param('CRNRSTN_CSS_VALIDATION_RESP');
//                                    error_log(__LINE__ . ' crnrstn_css_rtime is set. get_session_param results[' . strlen($tmp_validation_results).']');
//
//                                    if(strlen($tmp_validation_results) > 1){
//
//                                        $this->set_session_param('CRNRSTN_CSS_VALIDATION_RESP','0');
//
//                                        //
//                                        // VALIDATION SCORE RESULTS PAGE
//                                        header( 'Content-type: text/html; charset=utf-8' );
//                                        echo $tmp_validation_results;
//
//                                    }else{
//
//                                        //
//                                        // DATA ENTRY FORM PAGE
//                                        echo $this->ui_module_out('css_validator');
//
//                                    }
//
//                                }else{
//
//                                    error_log(__LINE__ . ' crnrstn_css_rtime is NOT set.');
//
//                                    if($this->isset_HTTP_Param('crnrstn_css_valptrn', 'GET')){
//
//                                        //
//                                        // VALIDATOR ALGORITHM LOGICAL PROFILE PRESENTATION PAGE
//                                        echo $this->ui_module_out('css_validator_profile');
//
//                                    }else{
//
//                                        error_log(__LINE__ . ' crnrstn_css_valptrn is NOT set.');
//
//                                        //
//                                        // DATA ENTRY FORM PAGE
//                                        echo $this->ui_module_out('css_validator');
//
//                                    }
//
//                                }
//
//                            }
//
//                        break;
//                        default:
//
//                            return false;
//
//                        break;
//
//                    }
//
//                }
//
//            }

        }

        return false;

    }

    public function crnrstn_session_load(){

        if($this->isset_session_param('CRNRSTN_AUTHORIZED_ACCOUNT')) {

            $this->oCRNRSTN_AUTH = $this->get_session_param('CRNRSTN_AUTHORIZED_ACCOUNT');

        }else{

            if(isset($this->oCRNRSTN_AUTH)){

                $this->oCRNRSTN_AUTH = new crnrstn_user_auth($this);

            }
        }
    }

    public function sync_device_detected(){

        error_log(__LINE__ . ' user run sync_device_detected()');
        //return $this->oCRNRSTN_ENV->oHTTP_MGR->sync_device_detected($this);
        return $this->oCRNRSTN_ENV->sync_device_detected($this);

    }

    public function ui_module_alerts_sync(){
//
//        self::$formIntegrationIsset_ARRAY[$transport_protocol] = false;
//        self::$formIntegrationErr_ARRAY[$transport_protocol][] = 'A ' . $transport_protocol . ' parameter [' . $packet_received_array['INPUT_NAME'] . '] has failed server-side validation [' . $packet_received_array['INPUT_VALIDATION'] . '].';
//
//        //
//        // SUCCESS_CHECK, ERR_X, NOTICE_TRI_ALERT
//        self::$formIntegrationIcon_ARRAY[$transport_protocol][] = 'ERR_X';
//


        $tmp_variables_order = $this->ini_get('variables_order');
        $tmp_vo_ARRAY = str_split($tmp_variables_order);
        $tmp_out = '';

        foreach($tmp_vo_ARRAY as $key => $value) {

            switch ($value) {
                case 'G':

                    if(isset(self::$formIntegrationIsset_ARRAY['GET'])){

                        if(isset(self::$formIntegrationErr_ARRAY['GET'])){

                            $tmp_cnt = count(self::$formIntegrationErr_ARRAY['GET']);

                            for($i = 0; $i  < $tmp_cnt; $i++) {

                                $this->ui_module_state_response_output .= $i . ' [' . self::$formIntegrationIcon_ARRAY['GET'][$i] . '] [' . self::$formIntegrationErr_ARRAY['GET'][$i] . ']<br>';

                            }

                        }

                    }

                break;
                case 'P':

                    if(isset(self::$formIntegrationIsset_ARRAY['POST'])){

                        if(isset(self::$formIntegrationErr_ARRAY['POST'])){

                            $tmp_cnt = count(self::$formIntegrationErr_ARRAY['POST']);

                            for($i = 0; $i  < $tmp_cnt; $i++) {

                                $this->ui_module_state_response_output .= $i . ' [' . self::$formIntegrationIcon_ARRAY['POST'][$i] . '] [' . self::$formIntegrationErr_ARRAY['POST'][$i] . ']<br>';

                            }

                        }

                    }

                break;
            }

        }

    }

    public function ui_module_alerts_out(){

        return $this->ui_module_state_response_output;

    }

    public function ui_module_out($module){

        switch($module){
            case 'signin':

                $this->oCRNRSTN_UX->sync_back_link_state();

                $tmp_oCRNRSTN_UI_HTML_MGR = new crnrstn_ui_html_manager($this);

                return $tmp_oCRNRSTN_UI_HTML_MGR->out_ui_html_doc_signin();

            break;
            case 'signin_m':

                $this->oCRNRSTN_UX->sync_back_link_state();

                $tmp_oCRNRSTN_UI_HTML_MGR = new crnrstn_ui_html_manager($this);

                return $tmp_oCRNRSTN_UI_HTML_MGR->out_ui_html_doc_signin_m();

            break;
            case 'MIT_license':

                $this->oCRNRSTN_UX->sync_back_link_state();

                $tmp_oCRNRSTN_UI_HTML_MGR = new crnrstn_ui_html_manager($this);

                return $tmp_oCRNRSTN_UI_HTML_MGR->out_ui_html_doc_mit_license();

            break;
            case 'css_validator':

                $this->oCRNRSTN_UX->sync_back_link_state();

                $tmp_oCRNRSTN_UI_HTML_MGR = new crnrstn_ui_html_manager($this);

                return $tmp_oCRNRSTN_UI_HTML_MGR->out_ui_html_doc_css_validator();

            break;
            case 'css_validator_profile':

                $this->oCRNRSTN_UX->sync_back_link_state();

                $tmp_oCRNRSTN_UI_HTML_MGR = new crnrstn_ui_html_manager($this);

                return $tmp_oCRNRSTN_UI_HTML_MGR->out_ui_html_doc_css_validator_profile();

            break;
            case 'dashboard':

                $this->oCRNRSTN_UX->sync_back_link_state();

                $tmp_oCRNRSTN_UI_HTML_MGR = new crnrstn_ui_html_manager($this);

                if($this->is_account_valid()){

                    return $tmp_oCRNRSTN_UI_HTML_MGR->out_ui_html_doc_dashboard();

                }else{

                    return $tmp_oCRNRSTN_UI_HTML_MGR->out_ui_html_doc_signin();

                }

            break;
            case 'config_wordpress':

                $this->oCRNRSTN_UX->sync_back_link_state();

                $tmp_oCRNRSTN_UI_HTML_MGR = new crnrstn_ui_html_manager($this);

                error_log(__LINE__ . ' user switch(config_wordpress)  get class['.get_class($this->oCRNRSTN_AUTH).']');
                if($this->is_account_valid()){
                    error_log(__LINE__ . ' user switch(config_wordpress) is_valid return true');

                    return $tmp_oCRNRSTN_UI_HTML_MGR->out_ui_html_doc_config_wordpress();

                }else{
                    error_log(__LINE__ . ' user switch(config_wordpress) is_valid return false');

                    return $tmp_oCRNRSTN_UI_HTML_MGR->out_ui_html_doc_signin();

                }

            break;
            default:

                return '<html><head><title>DEFAULT switch() case '.__METHOD__.'</title></head><body>ui_module_out('.$module.') is ready to be setup, good sir.</body></html>';

            break;

        }

    }
    
    public function is_account_valid(){

        if($this->isset_session_param('CRNRSTN_AUTHORIZED_ACCOUNT')){

            error_log(__LINE__ . ' user session set CRNRSTN_AUTHORIZED_ACCOUNT.');
            $this->oCRNRSTN_AUTH = $this->get_session_param('CRNRSTN_AUTHORIZED_ACCOUNT');

            $tmp_account = $this->oCRNRSTN_AUTH->return_account();
            //error_log(__LINE__ . ' user oCRNRSTN_AUTH=[' . get_class($this->oCRNRSTN_AUTH) . '] $tmp_account=[' . get_class($tmp_account) .']');

           //$tmp_account_profile = $tmp_account->return_account();

            //error_log(__LINE__ . ' $tmp_account_profile=[' . get_class($tmp_account) .']['.$tmp_account->account_get_resource('session_ip_address').']');

        }else{

            error_log(__LINE__ . ' user session NOT!! set CRNRSTN_AUTHORIZED_ACCOUNT.');

        }

        if(is_object($this->oCRNRSTN_AUTH)){
            error_log(__LINE__ . ' user oCRNRSTN_AUTH to OBJECT.');

            return $this->oCRNRSTN_AUTH->is_account_valid();
            
        }else{
            error_log(__LINE__ . ' user NOT!! oCRNRSTN_AUTH to OBJECT.');

            return false;
            
        }
        
    }

    public function sticky_uri_listener(){

        //
        // CHECK FOR INITIALIZATION OF STICKY LINK VAR
        if($this->isset_HTTP_Param('crnrstn_r', 'GET')){

            // $tmp_uri = html_entity_decode($this->extractData_HTTP('crnrstn_r'));
            $tmp_uri = $this->param_tunnel_decrypt($this->extractData_HTTP('crnrstn_r'), true);

            $tmp_redirect_html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="refresh" content="0; url='.$tmp_uri.'" />
    <style>
        p               { padding:10px 0 0 20px; font-size: 18px;}
    </style>
</head>
<body>
<p><a href="'.$tmp_uri.'" target="_self" style="color:#0066CC;">Click here</a>, if you are not redirected immediately.</p>
<!-- 

      ___           ___           ___           ___           ___                         ___              
     /\__\         /\  \         /\  \         /\  \         /\__\                       /\  \             
    /:/  /        /::\  \        \:\  \       /::\  \       /:/ _/_         ___          \:\  \            
   /:/  /        /:/\:\__\        \:\  \     /:/\:\__\     /:/ /\  \       /\__\          \:\  \      ::::::  ::::::           
  /:/  /  ___   /:/ /:/  /    _____\:\  \   /:/ /:/  /    /:/ /::\  \     /:/  /      _____\:\  \     ::::::  ::::::          
 /:/__/  /\__\ /:/_/:/__/___ /::::::::\__\ /:/_/:/__/___ /:/_/:/\:\__\   /:/__/      /::::::::\__\         
 \:\  \ /:/  / \:\/:::::/  / \:\~~\~~\/__/ \:\/:::::/  / \:\/:/ /:/  /  /::\  \      \:\~~\~~\/__/         
  \:\  /:/  /   \::/~~/~~~~   \:\  \        \::/~~/~~~~   \::/ /:/  /  /:/\:\  \      \:\  \          ::::::  ::::::         
   \:\/:/  /     \:\~~\        \:\  \        \:\~~\        \/_/:/  /   \/__\:\  \      \:\  \         ::::::  ::::::          
    \::/  /       \:\__\        \:\__\        \:\__\         /:/  /         \:\__\      \:\__\             
     \/__/         \/__/         \/__/         \/__/         \/__/           \/__/       \/__/      
	 



-->
</body>
</html>';

            return $tmp_redirect_html;

        }else{

            return false;

        }

    }

    public function return_sticky_link($url, $meta_params_ARRAY =  NULL){

        $tmp_array = array();
        $tmp_flag_array = array();

        $tmp_array[] = 'crnrstn_l=crnrstn';
        $tmp_array[] = 'crnrstn_r=' . $url;
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

    public function return_oLog_ProfileManager(){

        return self::$oLog_ProfileManager;

    }

    public function output_str_append($str){

        $this->destruct_output = $str;

    }

    private function initializeErrorHandling(){

        $tmp_envKey = $this->oCRNRSTN_ENV->getEnvKey();
        $this->error_log('Error handling at this server envKey='.$tmp_envKey, __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);

        if(isset($this->oCRNRSTN_ENV->crnrstn_as_error_handler_ARRAY[$this->crcINT($this->config_serial)][$tmp_envKey])){

            if($this->oCRNRSTN_ENV->crnrstn_as_error_handler_ARRAY[$this->crcINT($this->config_serial)][$tmp_envKey]){

                $this->error_log('Resetting error handling at this server to the PHP defaults.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);
                restore_error_handler();

                if (isset($this->oCRNRSTN_ENV->crnrstn_as_error_handler_constants_ARRAY[$this->crcINT($this->config_serial)][$tmp_envKey])) {

                    $this->error_log('Initializing CRNRSTN :: to handle errors at this server per a custom error level constants reporting profile represented as an aggregate by the integer value, ' . $this->oCRNRSTN_ENV->crnrstn_as_error_handler_constants_ARRAY[$this->crcINT($this->config_serial)][$tmp_envKey] . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);
                    $this->set_CRNRSTN_asErrorHandler($tmp_envKey);

                } else {

                    $this->error_log('Initializing CRNRSTN :: to handle errors at this server per the default PHP error level constants reporting profile. For PHP 5.3 or later, the default is E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);
                    $this->set_CRNRSTN_asErrorHandler($tmp_envKey);

                }

            } else {

                $this->error_log('Resetting error handling at this server to the PHP defaults. For PHP 5.3 or later, the default is E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);
                restore_error_handler();

            }
        }
    }

    private function set_CRNRSTN_asErrorHandler($envKey_crc){

        if(isset($this->oCRNRSTN_ENV->crnrstn_as_error_handler_constants_ARRAY[$this->crcINT($this->config_serial)][$envKey_crc])){

            //
            // SOURCE :: https://stackoverflow.com/questions/1241728/can-i-try-catch-a-warning
            // AUTHOR :: https://stackoverflow.com/users/117260/philippe-gerber
            // SET TO THE USER DEFINED ERROR HANDLER
            $old_error_handler = set_error_handler(function($errno, $errstr, $errfile, $errline, $errcontext) {

                try{

                    // error was suppressed with the @-operator
                    if(0 === error_reporting()){

                        return false;

                    }

                    $errstr = $_SESSION['CRNRSTN_' . $this->crcINT($this->config_serial)]['CRNRSTN_EXCEPTION_PREFIX'].$errstr;
                    $_SESSION['CRNRSTN_' . $this->crcINT($this->config_serial)]['CRNRSTN_EXCEPTION_PREFIX'] = '';
                    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);

                } catch (Exception $e) {

                    //
                    // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
                    $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

                    return false;

                }

            }, (int) $this->oCRNRSTN_ENV->crnrstn_as_error_handler_constants_ARRAY[$this->crcINT($this->config_serial)][$envKey_crc]);

        }else{

            $old_error_handler = set_error_handler(function($errno, $errstr, $errfile, $errline, $errcontext) {

                try{

                    // error was suppressed with the @-operator
                    if (0 === error_reporting()) {
                        return false;
                    }

                    $errstr = $_SESSION['CRNRSTN_'.$this->crcINT($this->config_serial)]['CRNRSTN_EXCEPTION_PREFIX'].$errstr;
                    $_SESSION['CRNRSTN_'.$this->crcINT($this->config_serial)]['CRNRSTN_EXCEPTION_PREFIX'] = '';
                    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);

                } catch (Exception $e) {

                    //
                    // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
                    $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

                    return false;

                }

            });

        }

        return true;

    }

    /*
    public function proxyEmailFire($WCR_key_email_packet, $endpoint_uri=NULL, $oKingsHighway=NULL){

        if(!isset($endpoint_uri)){

            $endpoint_uri = $this->get_resource('CRNRSTN_PROXY_WSDL_ENDPOINT');

            if($endpoint_uri==''){

                $endpoint_uri = $this->get_resource('CRNRSTN_PROXY_WSDL_ENDPOINT', $WCR_key_email_packet);

            }

        }

        //
        // SOAP
        $tmp_SOAP_request = $this->return_oKingsHighwaySOAP();

        $soapClient = new crnrstn_soap_client_manager($this,'WSDL_URI','WSDL_CACHE_TTL','NUSOAP_USECURL');

        $response = $soapClient->sendRequest_SOAP('takeTheKingsHighway', $tmp_SOAP_request);

        $tmp_key_raw = urldecode($response['CRNRSTN_SOAP_SVC_AUTH_KEY']);
        $this->error_log('TOTAL_EMAILS_RECEIVED='.$response['TOTAL_EMAILS_RECEIVED'], __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $this->error_log('CRNRSTN_SOAP_SVC_AUTH_KEY='.$tmp_key_raw, __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);
        $this->error_log('param_tunnel_decrypt/true-CRNRSTN_SOAP_SVC_AUTH_KEY='.$this->param_tunnel_decrypt($tmp_key_raw, true), __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $this->error_log('377 - returnResult='.$soapClient->returnResult(), __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $tmp_serial = $this->generate_new_key(10);
        $packet_delimiter = '[CRNRSTN200_'.$tmp_serial.']';

        $tmp_email_packet_datum = $this->return_emailProxyIntegrationPacket($WCR_key_email_packet, $packet_delimiter);

        if(isset($oKingsHighway)){

            $tmp_cipher_override = $oKingsHighway->return_cipher();
            $tmp_secret_key_override = $oKingsHighway->return_secret_key();
            $tmp_hmac_algorithm_override = $oKingsHighway->return_hmac_algorithm();
            $tmp_options_bitwise_override = $oKingsHighway->return_options_bitwise();

        }else{

            $tmp_cipher_override = NULL;
            $tmp_secret_key_override = NULL;
            $tmp_hmac_algorithm_override = NULL;
            $tmp_options_bitwise_override = NULL;

        }

        //
        // ENCRYPT DATA PACKET
        if($this->is_tunnel_encrypt_configured($tmp_cipher_override, $tmp_secret_key_override, $tmp_hmac_algorithm_override, $tmp_options_bitwise_override)){

            $is_encrypted = 'true';
            $tmp_email_packet_datum = $this->param_tunnel_encrypt($tmp_email_packet_datum, $tmp_cipher_override, $tmp_secret_key_override, $tmp_hmac_algorithm_override, $tmp_options_bitwise_override);
            $packet_delimiter = $this->param_tunnel_encrypt($packet_delimiter, $tmp_cipher_override, $tmp_secret_key_override, $tmp_hmac_algorithm_override, $tmp_options_bitwise_override);

        }else{

            $is_encrypted = 'false';

        }

        //
        // BUILD CURL POST EXPERIENCE
        $proxy_packet_datum = array("CRNRSTN_COMM_PROXY_PACKET" => 'v2.0.0',
        "CRNRSTN_PACKET_ENCRYPTED" => $is_encrypted,
            "CRNRSTN_PACKET_DELIMITER" => $packet_delimiter,
            "CRNRSTN_PACKET_DATUM" => $tmp_email_packet_datum);

        //$tmp_curl_response = $this->curl_post($endpoint_uri, $proxy_packet_datum);

        $this->error_log('The CRNRSTN :: Electrum process notification SOAP has been sent.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

    }


    private function return_oKingsHighwaySOAP(){

        $this->soapRequest_ARRAY = array('oKingsHighwayNotification' =>
            array(
                'CRNRSTN_PACKET_ENCRYPTED' => 'TRUE',
                'CRNRSTN_SOAP_SVC_AUTH_KEY' => $this->param_tunnel_encrypt($this->get_resource('CRNRSTN_SOAP_SVC_AUTH_KEY'))
            ));

        return $this->soapRequest_ARRAY;

    }
  */

    public function ini_set($ini_setting, $ini_value){

        $this->ini_set_ARRAY[$ini_setting] = $ini_value;

        return ini_set($ini_setting, $ini_value);

    }

    public function ini_get($ini_setting){

        $tmp_val = ini_get($ini_setting);

        $this->ini_set_ARRAY[$ini_setting] = $tmp_val;

        return $tmp_val;

    }

    public function client_send_CRNRSTN_SOAP_REQUEST($SOAP_method, $SOAP_request, $SOAP_endpoint = NULL){

        if(!isset($SOAP_endpoint)){

            $SOAP_endpoint = $this->get_resource('WSDL_URI', 'CRNRSTN::INTEGRATIONS');

        }

        if(isset($this->WSDL_cache_ttl_ARRAY[$this->crcINT($SOAP_endpoint)])){

            $WSDL_cache_ttl = $this->WSDL_cache_ttl_ARRAY[$this->crcINT($SOAP_endpoint)];

        }else{

            $WSDL_cache_ttl = $this->get_resource('WSDL_CACHE_TTL', 'CRNRSTN::INTEGRATIONS');

        }

        if(isset($this->nusoap_useCURL_ARRAY[$this->crcINT($SOAP_endpoint)])){

            $nusoap_useCURL = $this->nusoap_useCURL_ARRAY[$this->crcINT($SOAP_endpoint)];

        }else{

            $nusoap_useCURL = $this->get_resource('NUSOAP_USECURL', 'CRNRSTN::INTEGRATIONS');

        }

        $this->print_r('['.$SOAP_endpoint.']['.$WSDL_cache_ttl.']['.$nusoap_useCURL.']', 'SEND CLIENT REQUEST', NULL,  __LINE__, __METHOD__, __FILE__);

        //
        // INSTANTIATE SOAP CLIENT
        $this->oSoapClient = new crnrstn_soap_client_manager($this, $SOAP_endpoint, $WSDL_cache_ttl, $nusoap_useCURL);
        $this->print_r('['.gettype($this->oSoapClient).']['.get_class($this->oSoapClient).'] ['.$SOAP_method.']['.print_r($SOAP_request, true).']', 'SEND CLIENT REQUEST', NULL,  __LINE__, __METHOD__, __FILE__);
        //$this->print_r('['.$SOAP_method.']['.print_r($SOAP_request, true).']', 'SEND CLIENT REQUEST', NULL,  __LINE__, __METHOD__, __FILE__);

        return $this->oSoapClient->sendRequest_SOAP($SOAP_method, $SOAP_request);

    }

    public function return_oEmailArraySOAP_struct($email_pipe_delim, $name_pipe_delim=NULL, $cipher_override=NULL, $secret_key_override=NULL, $hmac_algorithm_override=NULL, $options_bitwise_override=NULL){

        $tmp_email_ARRAY = array();

        if(!isset($name_pipe_delim)){

            $pos_pipe = strpos($email_pipe_delim, '|');

            if($pos_pipe === false){

                //
                // SINGLE NAME-EMAIL
                $email_pipe_delim = trim($email_pipe_delim);
                $pos_space = strpos($email_pipe_delim, ' ');

                if($pos_space === false){

                    array_push($tmp_email_ARRAY, array(
                        'EMAIL_PROXY_SERIAL' => $this->param_tunnel_encrypt(md5($email_pipe_delim), $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                        'EMAILADDRESS' => $this->param_tunnel_encrypt($email_pipe_delim, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override)
                    ));

                }else{

                    $tmp_email = '';
                    $tmp_firstname = '';
                    $tmp_lastname = '';

                    $tmp_name_email_ARRAY = explode(' ', $email_pipe_delim);
                    $tmp_content_cnt = sizeof($tmp_name_email_ARRAY);
                    for($i=0; $i<$tmp_content_cnt; $i++){

                        $pos_at = strpos($tmp_name_email_ARRAY[$i], '@');
                        $pos_dot = strpos($tmp_name_email_ARRAY[$i], '.');

                        if($pos_at !== false && $pos_dot !== false && $tmp_email==''){

                            //
                            // TAKE EMAIL ADDRESS
                            $tmp_email = $tmp_name_email_ARRAY[$i];

                        }else{

                            //
                            // TAKE NAME ELEMENT
                            if($tmp_firstname==''){

                                $tmp_firstname .= $tmp_name_email_ARRAY[$i];

                            }else{

                                $tmp_lastname .= $tmp_name_email_ARRAY[$i].' ';

                            }

                        }

                    }

                    $tmp_lastname = rtrim($tmp_lastname, ' ');
                    array_push($tmp_email_ARRAY, array(
                        'EMAIL_PROXY_SERIAL' => $this->param_tunnel_encrypt(md5($tmp_email), $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                        'EMAILADDRESS' => $this->param_tunnel_encrypt($tmp_email, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                        'FIRSTNAME' => $this->param_tunnel_encrypt($tmp_firstname, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                        'LASTNAME' => $this->param_tunnel_encrypt($tmp_lastname, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override)
                    ));

                }

            }else{

                //
                // MULTIPLE NAME-EMAIL
                $tmp_name_email_ARRAY = explode('|', $email_pipe_delim);

                $tmp_email_cnt = sizeof($tmp_name_email_ARRAY);
                for($i=0; $i<$tmp_email_cnt; $i++){

                    $pos_space = strpos($tmp_name_email_ARRAY[$i], ' ');

                    if($pos_space === false){

                        array_push($tmp_email_ARRAY, array(
                            'EMAIL_PROXY_SERIAL' => $this->param_tunnel_encrypt(md5($tmp_name_email_ARRAY[$i]), $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                            'EMAILADDRESS' => $this->param_tunnel_encrypt($tmp_name_email_ARRAY[$i], $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override)
                        ));

                    }else{

                        $tmp_email = '';
                        $tmp_firstname = '';
                        $tmp_lastname = '';

                        $tmp_name_check_ARRAY = explode(' ', $tmp_name_email_ARRAY[$i]);
                        $tmp_content_cnt = sizeof($tmp_name_check_ARRAY);
                        for($ii=0; $ii<$tmp_content_cnt; $ii++){

                            $pos_at = strpos($tmp_name_check_ARRAY[$ii], '@');
                            $pos_dot = strpos($tmp_name_check_ARRAY[$ii], '.');

                            if($pos_at !== false && $pos_dot !== false && $tmp_email==''){

                                //
                                // TAKE EMAIL ADDRESS
                                $tmp_email = $tmp_name_check_ARRAY[$ii];

                            }else{

                                //
                                // TAKE NAME ELEMENT
                                if($tmp_firstname == ''){

                                    $tmp_firstname .= $tmp_name_check_ARRAY[$ii];

                                }else{

                                    $tmp_lastname .= $tmp_name_check_ARRAY[$ii].' ';

                                }

                            }

                        }

                        $tmp_lastname = rtrim($tmp_lastname, ' ');
                        array_push($tmp_email_ARRAY, array(
                            'EMAIL_PROXY_SERIAL' => $this->param_tunnel_encrypt(md5($tmp_email), $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                            'EMAILADDRESS' => $this->param_tunnel_encrypt($tmp_email, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                            'FIRSTNAME' => $this->param_tunnel_encrypt($tmp_firstname, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                            'LASTNAME' => $this->param_tunnel_encrypt($tmp_lastname, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override)
                        ));

                    }

                }

            }

        }else{

            $tmp_email = '';
            $tmp_firstname = '';
            $tmp_lastname = '';

            //
            // PROCESS NAMES AS SEPARATE pipe DELIM
            // $email_pipe_delim, $name_pipe_delim
            $pos_pipe = strpos($email_pipe_delim, '|');
            if($pos_pipe !== false){

                //
                // MULTIPLE EMAIL
                $tmp_email_breakout_ARRAY = explode('|', $email_pipe_delim);
                $tmp_name_breakout_ARRAY = explode('|', $name_pipe_delim);

                $tmp_email_breakout_cnt = sizeof($tmp_email_breakout_ARRAY);
                $tmp_name_breakout_cnt = sizeof($tmp_name_breakout_ARRAY);

                if($tmp_email_breakout_cnt == $tmp_name_breakout_cnt){

                    for($i=0; $i<$tmp_email_breakout_cnt; $i++){

                        $tmp_email = trim($tmp_email_breakout_ARRAY[$i]);
                        $tmp_name = trim($tmp_name_breakout_ARRAY[$i]);

                        $tmp_space = strpos($tmp_name, ' ');
                        if($tmp_space!==false){
                            $tmp_name_bo_ARRAY = explode(' ', $tmp_name);
                            $tmp_name_bo_cnt = sizeof($tmp_name_bo_ARRAY);
                            for($ii=0; $ii<$tmp_name_bo_cnt; $ii++){

                                //
                                // TAKE NAME ELEMENT
                                if($tmp_firstname == ''){

                                    $tmp_firstname .= $tmp_name_bo_ARRAY[$ii];

                                }else{

                                    $tmp_lastname .= $tmp_name_bo_ARRAY[$ii].' ';

                                }

                            }

                        }else{

                            $tmp_firstname = $tmp_name;

                        }

                        $tmp_lastname = rtrim($tmp_lastname, ' ');
                        array_push($tmp_email_ARRAY, array(
                            'EMAIL_PROXY_SERIAL' => $this->param_tunnel_encrypt(md5($tmp_email), $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                            'EMAILADDRESS' => $this->param_tunnel_encrypt($tmp_email, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                            'FIRSTNAME' => $this->param_tunnel_encrypt($tmp_firstname, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                            'LASTNAME' => $this->param_tunnel_encrypt($tmp_lastname, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override)
                        ));
                    }

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('CRNRSTN :: has received a mismatch between the number of email addresses provided and the number of names...'.$tmp_email_breakout_cnt.' to '.$tmp_name_breakout_cnt.', respectively.');

                }

            }else{

                //
                // SINGLE EMAIL
                $pos_space = strpos($name_pipe_delim, ' ');
                if($pos_space !== false){

                    $tmp_name_sep_ARRAY = explode(' ', $name_pipe_delim);
                    $tmp_name_element_cnt = sizeof($tmp_name_sep_ARRAY);

                    for($i=0; $i<$tmp_name_element_cnt; $i++){

                        //
                        // TAKE NAME ELEMENT
                        if($tmp_firstname == ''){

                            $tmp_firstname .= $tmp_name_sep_ARRAY[$i];

                        }else{

                            $tmp_lastname .= $tmp_name_sep_ARRAY[$i].' ';

                        }

                    }

                }else{

                    //
                    // ONLY "FIRST" NAME
                    $tmp_firstname = $name_pipe_delim;

                }

                $tmp_lastname = rtrim($tmp_lastname, ' ');
                array_push($tmp_email_ARRAY, array(
                    'EMAIL_PROXY_SERIAL' => $this->param_tunnel_encrypt(md5($email_pipe_delim), $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                    'EMAILADDRESS' => $this->param_tunnel_encrypt($email_pipe_delim, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                    'FIRSTNAME' => $this->param_tunnel_encrypt($tmp_firstname, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                    'LASTNAME' => $this->param_tunnel_encrypt($tmp_lastname, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override)
                ));

            }

        }

        return $tmp_email_ARRAY;

    }

    /*
    private function return_emailProxyIntegrationPacket($WCR_key_email_packet, $packet_delimiter){

        $tmp_str = '';
        switch($WCR_key_email_packet){
            case 'THE_KINGS_HIGHWAY_oGABRIEL_NOTIFICATION':

                $tmp_str .= $this->concatIntegrationPacketDatum($WCR_key_email_packet, $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('CRNRSTN_SOAP_SVC_AUTH_KEY', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('RECIPIENT_EMAIL_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('RECIPIENT_NAME_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('FROM_EMAIL', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('FROM_NAME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('REPLY_TO_EMAIL_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('REPLY_TO_NAME_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('CC_EMAIL_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('CC_NAME_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('BCC_EMAIL_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('BCC_NAME_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('MESSAGE_SUBJECT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('MESSAGE_BODY_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('MESSAGE_BODY_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('WORDWRAP', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('PRIORITY', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('IS_HTML', $WCR_key_email_packet), $packet_delimiter);

            break;
            case 'ELECTRUM_NOTIFICATION_DETAIL':
                $tmp_str .= $this->concatIntegrationPacketDatum($WCR_key_email_packet, $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('RECIPIENT_EMAIL_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('RECIPIENT_NAME_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('FROM_EMAIL', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('FROM_NAME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('REPLY_TO_EMAIL', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('REPLY_TO_NAME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('MESSAGE_SUBJECT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('MESSAGE_BODY_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('MESSAGE_BODY_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_MESSAGE_TITLE_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_MESSAGE_TITLE_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_LOG_INTEGER_CONSTANT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_MESSAGE_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_MESSAGE_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_REMOTE_ADDR', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_SERVER_NAME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_SYSTEM_TIME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_PROCESS_RUN_TIME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_ACTIVITY_TRACE_TITLE', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_ACTIVITY_TRACE_CONTENT_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_ACTIVITY_TRACE_CONTENT_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('CRNRSTN_SOAP_SVC_AUTH_KEY'), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_START_TIME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_END_TIME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_PRETTY_RUN_TIME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_TOTAL_COUNT_FILES_TRANSFERRED', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_TOTAL_COUNT_FILES_SKIPPED', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_TOTAL_FILESIZE_FILES_TRANSFERRED', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_TOTAL_ERRORS_FILES_TRANSFERRED', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_TOTAL_COUNT_ENDPOINT_CONNECTION_ERROR', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_PERCENTAGE_FILES_SUCCESSFUL_TRANSFERRED', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_DATA_SOURCE_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_DATA_DESTINATION_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_DATA_HANDLING_PROFILE_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_DATA_SOURCE_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_DATA_DESTINATION_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_DATA_HANDLING_PROFILE_TEXT', $WCR_key_email_packet), $packet_delimiter);

            break;
            default:

                $tmp_str .= $this->concatIntegrationPacketDatum($WCR_key_email_packet, $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('CRNRSTN_SOAP_SVC_AUTH_KEY', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('RECIPIENT_EMAIL_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('RECIPIENT_NAME_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('FROM_EMAIL', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('FROM_NAME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('REPLY_TO_EMAIL_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('REPLY_TO_NAME_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('CC_EMAIL_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('CC_NAME_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('BCC_EMAIL_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('BCC_NAME_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('MESSAGE_SUBJECT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('MESSAGE_BODY_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('MESSAGE_BODY_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('WORDWRAP', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('PRIORITY', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('IS_HTML', $WCR_key_email_packet), $packet_delimiter);

                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('REPLY_TO_EMAIL', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('REPLY_TO_NAME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_MESSAGE_TITLE_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_MESSAGE_TITLE_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_LOG_INTEGER_CONSTANT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_MESSAGE_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_MESSAGE_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_REMOTE_ADDR', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_SERVER_NAME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_SYSTEM_TIME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_PROCESS_RUN_TIME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_ACTIVITY_TRACE_TITLE', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_ACTIVITY_TRACE_CONTENT_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_ACTIVITY_TRACE_CONTENT_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('CRNRSTN_CRNRSTN_SOAP_SVC_AUTH_KEY'), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_START_TIME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_END_TIME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_PRETTY_RUN_TIME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_TOTAL_COUNT_FILES_TRANSFERRED', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_TOTAL_COUNT_FILES_SKIPPED', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_TOTAL_FILESIZE_FILES_TRANSFERRED', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_TOTAL_ERRORS_FILES_TRANSFERRED', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_TOTAL_COUNT_ENDPOINT_CONNECTION_ERROR', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_PERCENTAGE_FILES_SUCCESSFUL_TRANSFERRED', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_DATA_SOURCE_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_DATA_DESTINATION_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_DATA_HANDLING_PROFILE_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_DATA_SOURCE_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_DATA_DESTINATION_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_DATA_HANDLING_PROFILE_TEXT', $WCR_key_email_packet), $packet_delimiter);

            break;

        }

        //$tmp_str = rtrim($tmp_str, $packet_delimiter);
        return $tmp_str;
    }

    */

    public function return_secret_key_override($SOAP_endpoint){

        if(isset($this->secret_key_override_ARRAY[$this->crcINT($SOAP_endpoint)])){

            return $this->secret_key_override_ARRAY[$this->crcINT($SOAP_endpoint)];

        }else{

            return NULL;

        }

    }

    public function return_cipher_override($SOAP_endpoint){

        if(isset($this->cipher_override_ARRAY[$this->crcINT($SOAP_endpoint)])){

            return $this->cipher_override_ARRAY[$this->crcINT($SOAP_endpoint)];

        }else{

            return NULL;

        }

    }

    public function return_hmac_algorithm_override($SOAP_endpoint){

        if(isset($this->hmac_algorithm_override_ARRAY[$this->crcINT($SOAP_endpoint)])){

            return $this->hmac_algorithm_override_ARRAY[$this->crcINT($SOAP_endpoint)];

        }else{

            return NULL;

        }

    }

    public function return_options_bitwise_override($SOAP_endpoint){

        if(isset($this->options_bitwise_override_ARRAY[$this->crcINT($SOAP_endpoint)])){

            return $this->options_bitwise_override_ARRAY[$this->crcINT($SOAP_endpoint)];

        }else{

            return NULL;

        }

    }

    public function initSOAP_WSDL_connectionProfile($SOAP_endpoint, $WSDL_cache_ttl, $nusoap_useCURL){

        $this->WSDL_cache_ttl_ARRAY[$this->crcINT($SOAP_endpoint)] = $WSDL_cache_ttl;
        $this->nusoap_useCURL_ARRAY[$this->crcINT($SOAP_endpoint)] = $nusoap_useCURL;

    }

    public function initSOAP_tunnelEncryptProfile($SOAP_endpoint, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override){

        $this->secret_key_override_ARRAY[$this->crcINT($SOAP_endpoint)] = $secret_key_override;
        $this->cipher_override_ARRAY[$this->crcINT($SOAP_endpoint)] = $cipher_override;
        $this->hmac_algorithm_override_ARRAY[$this->crcINT($SOAP_endpoint)] = $hmac_algorithm_override;
        $this->options_bitwise_override_ARRAY[$this->crcINT($SOAP_endpoint)] = $options_bitwise_override;

    }

    public function SOAP_isset_soap_client(){

        if(isset($this->oSoapClient)){

            return $this->oSoapClient->isset_soap_client();

        }else{

            return false;

        }

    }

    public function SOAP_return_client_request(){

        try{

            if(isset($this->oSoapClient)){

                return $this->oSoapClient->returnClientRequest();

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No SOAP request has been sent, leaving the oSoapClient object uninstantiated and, therefore, unable to return a client request.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    public function SOAP_return_client_response(){

        try{

            if(isset($this->oSoapClient)){

                return $this->oSoapClient->returnClientResponse();

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No SOAP request has been sent, leaving the oSoapClient object uninstantiated and, therefore, unable to return a client response.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    public function SOAP_return_result(){

        try{

            if(isset($this->oSoapClient)){

                return $this->oSoapClient->returnResult();

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No SOAP request has been sent, leaving the oSoapClient object uninstantiated and, therefore, unable to return a result from a SOAP server.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    public function SOAP_return_client_get_debug(){

        try{

            if(isset($this->oSoapClient)){

                return $this->oSoapClient->returnClientGetDebug();

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No SOAP request has been sent, leaving the oSoapClient object uninstantiated and, therefore, unable to return any SOAP client debug information.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    public function SOAP_return_error(){

        try{

            if(isset($this->oSoapClient)){

                return $this->oSoapClient->returnError();

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No SOAP request has been sent, leaving the oSoapClient object uninstantiated and, therefore, unable to return any SOAP request error information.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    public function isAuthorized_SOAP_request($CRNRSTN_SOAP_SVC_AUTH_KEY, $USERNAME, $PASSWORD, $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES, $CRNRSTN_SOAP_SVC_METHOD_REQUESTED, $CRNRSTN_SOAP_ACTION_TYPE){

        return $this->oCRNRSTN_ENV->isAuthorized_SOAP_request($CRNRSTN_SOAP_SVC_AUTH_KEY, $USERNAME, $PASSWORD, $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES, $CRNRSTN_SOAP_SVC_METHOD_REQUESTED, $CRNRSTN_SOAP_ACTION_TYPE);

    }

    public function electrum_initNotifications($CRNRSTN_oELECTRUM, $email_pipe_delim, $notificationProfile='EMAIL', $SOAP_endpoint=NULL, $email_protocol='SMTP'){

        $CRNRSTN_oELECTRUM->initNotifications($email_pipe_delim, $notificationProfile, $SOAP_endpoint, $email_protocol);

        return $CRNRSTN_oELECTRUM;

    }

    public function return_config_serial(){

        return $this->config_serial;

    }

    public function define_wildcard_resource($key){

        $oWildCardResource = new crnrstn_wildcard_resource($key, $this);

        return $oWildCardResource;

    }

    public function save_wildcard_resource($oWildCardResource){

        $this->oCRNRSTN_ENV->augmentWCR_array($oWildCardResource);

    }

    public function ui_content_module_out($integer_constant, $crnrstn_form_handle = NULL){

        switch($integer_constant){
            case CRNRSTN_UI_FORM_INTEGRATION_PACKET:

                $this->addHiddenFormInputParamListener($crnrstn_form_handle, 'CRNRSTN_FORM_HANDLE', 'CRNRSTN_FORM_HANDLE', true, $crnrstn_form_handle);

                return $this->injectInputSerialization($crnrstn_form_handle);

            break;
            default:

                return $this->oCRNRSTN_ENV->ui_content_module_out($integer_constant);

            break;

        }

    }

    public function initElectrum_FileCopy($FtpToFtp_tmp_dirPath, $directoryDateName_versioning_pattern=NULL){

        $this->error_log('Initialize new Electrum operation.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $oELECTRUM = new crnrstn_wind_cloud_fire($this, $FtpToFtp_tmp_dirPath, $directoryDateName_versioning_pattern);

        return $oELECTRUM;

    }

    public function electrum_copyFilesToFolder($CRNRSTN_oELECTRUM, $custom_folder_name){

        $CRNRSTN_oELECTRUM->copyFilesToFolder($custom_folder_name);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_moveContentWithinSourceDir($CRNRSTN_oELECTRUM, $excludeContainingDir=true){

        $CRNRSTN_oELECTRUM->moveContentInSourceDirOnly($excludeContainingDir);

        return $CRNRSTN_oELECTRUM;
    }

    public function electrum_doNotPassDiskUsagePercent($CRNRSTN_oELECTRUM, $maxStorageUse){

        $this->error_log('Maximum storage usage at ANY destination LOCAL (FTP is not monitored) directory for this CRNRSTN :: Electrum process is being set to '.$maxStorageUse.'%.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->localStorageUse_doNotPassUsagePercent($maxStorageUse);

        return $CRNRSTN_oELECTRUM;
    }


    public function electrum_deleteSourceData_OnSuccess($CRNRSTN_oELECTRUM, $WCR_key_Or_DirPath, $require_ALL_destination_success=true){

        $this->error_log('On SUCCESS, remove all "processed-to-destination" files at the SOURCE endpoint, '.$WCR_key_Or_DirPath, __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->deleteSourceData_OnSuccess($WCR_key_Or_DirPath, $require_ALL_destination_success);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addSourceFTP_WCR($CRNRSTN_oELECTRUM, $WildCardResource_key){

        $this->error_log('Add new WCR['.$WildCardResource_key.'] source['.$this->get_resource('FTP_SERVER', $WildCardResource_key).'] to this electrum.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->addSource_FTP_WCR($WildCardResource_key);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addDestinationFTP_WCR($CRNRSTN_oELECTRUM, $WildCardResource_key){

        $this->error_log('Add new WCR['.$WildCardResource_key.'] destination['.$this->get_resource('FTP_SERVER', $WildCardResource_key).'] to this electrum.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->addDestination_FTP_WCR($WildCardResource_key);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addFlattenedDestinationFTP_WCR($CRNRSTN_oELECTRUM, $WildCardResource_key){

        $this->error_log('Add new WCR['.$WildCardResource_key.'] FLATTEN ALL FILES TO SAME Directory DESTINATION ['.$this->get_resource('FTP_SERVER', $WildCardResource_key).'] to this electrum.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->addFlattenedDestinationFTP_WCR($WildCardResource_key);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addSourceLOCAL($CRNRSTN_oELECTRUM, $dirPath){

        $this->error_log('Add new Directory source['.$dirPath.'] to this electrum.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->addSourceLOCAL($dirPath);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addSourceLOCAL_WCR($CRNRSTN_oELECTRUM, $WildCardResource_key){

        $this->error_log('Add new WCR['.$WildCardResource_key.'] source['.$this->get_resource('LOCAL_DIR_PATH', $WildCardResource_key).'] to this electrum.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->addSourceLOCAL_WCR($WildCardResource_key);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addDestinationLOCAL_WCR($CRNRSTN_oELECTRUM, $WildCardResource_key){

        $tmp_path = $this->get_resource('LOCAL_DIR_PATH', $WildCardResource_key);
        //$tmp_mode = $this->get_resource('LOCAL_MKDIR_MODE', $WildCardResource_key);
        $this->error_log('Add new DIR ['.$WildCardResource_key.'] destination['.$tmp_path.'] to this electrum.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->addDestinationLOCAL_WCR($WildCardResource_key);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addFlattenedDestinationLOCAL_WCR($CRNRSTN_oELECTRUM, $WildCardResource_key){

        $tmp_path = $this->get_resource('LOCAL_DIR_PATH', $WildCardResource_key);
        //$tmp_mode = $this->get_resource('LOCAL_MKDIR_MODE', $WildCardResource_key);
        $this->error_log('Add new FLATTEN ALL FILES TO SAME Directory ['.$WildCardResource_key.'] destination['.$tmp_path.'] to this electrum.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->addFlattenedDestinationLOCAL_WCR($WildCardResource_key);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addDestinationLOCAL($CRNRSTN_oELECTRUM, $dirPath, $mkdir_permissons_mode=777){

        $this->error_log('Add new Directory destination['.$dirPath.'] to this electrum.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->addDestinationLOCAL($dirPath, $mkdir_permissons_mode);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addFlattenedDestinationLOCAL($CRNRSTN_oELECTRUM, $dirPath, $mkdir_permissons_mode=777){

        $this->error_log('Add new FLATTEN ALL FILES TO SAME Directory destination['.$dirPath.'] to this electrum.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->addFlattenedDestinationLOCAL($dirPath, $mkdir_permissons_mode);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_DIR($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH=NULL){

        $this->error_log('Add new DIR Exclusion of "'.$pattern.'" to this electrum.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->exclude_DIR($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_FILE($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH=NULL){

        $this->error_log('Add new FILE Exclusion of "'.$pattern.'" to this electrum.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->exclude_FILE($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_fileSizeGreaterThan($CRNRSTN_oELECTRUM, $bytes, $WCRkey_or_DIRPATH=NULL){

        $this->error_log('Add new FILE Exclusion where FILE SIZE > '.$bytes.' bytes to this electrum.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->exclude_fileSizeGreaterThan($bytes, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_fileSizeLessThan($CRNRSTN_oELECTRUM, $bytes, $WCRkey_or_DIRPATH=NULL){

        $this->error_log('Add new FILE Exclusion where FILE SIZE < '.$bytes.' bytes to this electrum.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->exclude_fileSizeLessThan($bytes, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_accessedOlderThan($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH=NULL){

        $this->error_log('Add new exclusion of ACCESSED OLDER THAN "'.$pattern.'" to this electrum.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->exclude_accessedOlderThan($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_accessedNewerThan($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH=NULL){

        $this->error_log('Add new exclusion of ACCESSED NEWER THAN "'.$pattern.'" to this electrum.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->exclude_accessedNewerThan($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_modifiedOlderThan($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH=NULL){

        $this->error_log('Add new exclusion of MODIFIED OLDER THAN "'.$pattern.'" to this electrum.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->exclude_modifiedOlderThan($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_modifiedNewerThan($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH=NULL){

        $this->error_log('Add new exclusion of MODIFIED NEWER THAN "'.$pattern.'" to this electrum.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->exclude_modifiedNewerThan($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_assetUserID($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH=NULL){

        $this->error_log('Add new exclusion of FILE OWNER USER ID "'.$pattern.'" to this electrum.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->exclude_assetUserID($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_assetGroupID($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH=NULL){

        $this->error_log('Add new exclusion of FILE OWNER GROUP ID "'.$pattern.'" to this electrum.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->exclude_assetGroupID($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_EXECUTE($CRNRSTN_oELECTRUM){

        $this->error_log('Begin execution of CRNRSTN :: Electrum operation.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $tmp_execution_serial = $this->generate_new_key(100);

        $CRNRSTN_oELECTRUM->execute($tmp_execution_serial);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_closeConnections($CRNRSTN_oELECTRUM){

        $this->error_log('Close all connections associated with this electrum operation.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->terminate_all_ftp();

        return $CRNRSTN_oELECTRUM;

    }

    public function isCurrentEnvironment($envKey){

        $tmp_envKey_crc = $this->crcINT($envKey);
        $tmp_envKey = $this->oCRNRSTN_ENV->getEnvKey();
        if($tmp_envKey_crc == $tmp_envKey){

            return true;

        }else{

            return false;

        }

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function initialize_oGabriel($messenger_serial, $mail_protocol='SMTP', $username=NULL, $password=NULL, $port=NULL){

        //
        // BRING IN THE MESSENGER
        // Luke 1:19, 26; Daniel 8:16; 9:21-22
        $CRNRSTN_oGabriel = new crnrstn_messenger_from_north($messenger_serial, $mail_protocol, $username, $password, $port, $this);

        $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial] = $CRNRSTN_oGabriel;

        return $CRNRSTN_oGabriel;

    }

    public function initProxySend($CRNRSTN_oGabriel, $proxy_endpoint_uri, $proxy_auth_key){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->initProxySend($proxy_endpoint_uri, $proxy_auth_key);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function proxyEncrypt_setCipherOverride($CRNRSTN_oGabriel, $cipher){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->proxyEncrypt_setCipherOverride($cipher);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function proxyEncrypt_setSecretKeyOverride($CRNRSTN_oGabriel, $proxy_secret_key){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->proxyEncrypt_setSecretKeyOverride($proxy_secret_key);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function proxyEncrypt_setAlgorithmOverride($CRNRSTN_oGabriel, $proxy_encrypt_hmac_algorithm){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->proxyEncrypt_setAlgorithmOverride($proxy_encrypt_hmac_algorithm);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addHostServers($CRNRSTN_oGabriel, $mail_host_servers){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addHostServers($mail_host_servers);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addReplyTo($CRNRSTN_oGabriel, $reply_to_email, $reply_to_recipient_name = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addReplyTo($reply_to_email, $reply_to_recipient_name);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addFrom($CRNRSTN_oGabriel, $sender_email, $sender_name = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addFrom($sender_email, $sender_name);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function wordWrap($CRNRSTN_oGabriel, $max_char_column_cnt=72){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->wordWrap($max_char_column_cnt);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function isHTML($CRNRSTN_oGabriel, $bool_isHTML){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->isHTML($bool_isHTML);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function setPriority($CRNRSTN_oGabriel, $priority = 'NORMAL'){
        // 1 = HIGH, 3 = NORMAL, 5 = LOW, null (default)
        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->setPriority($priority);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addSubject($CRNRSTN_oGabriel, $subject_line = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addSubject($subject_line);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addMsgBody_HTMLversion($CRNRSTN_oGabriel, $html_message = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addMsgBody_HTMLversion($html_message);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addMsgBody_TEXTversion($CRNRSTN_oGabriel, $text_message = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addMsgBody_TEXTversion($text_message);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;
    }

    public function suppressEmailDuplicates($CRNRSTN_oGabriel, $bool_suppress_dups=true){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->suppressEmailDuplicates($bool_suppress_dups);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function optOutDoNotSendEmail($CRNRSTN_oGabriel, $optout_emails){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->optOutDoNotSendEmail($optout_emails);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addAddress($CRNRSTN_oGabriel, $recipient_email, $recipient_name = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $email_experience_tracker = $oGabriel->addAddress($recipient_email, $recipient_name);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

        return $email_experience_tracker;

    }

    public function addCC($CRNRSTN_oGabriel, $recipient_email, $recipient_name = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addCC($recipient_email, $recipient_name);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addBCC($CRNRSTN_oGabriel, $recipient_email, $recipient_name = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addBCC($recipient_email, $recipient_name);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addDynamicContent_SUBJECT($CRNRSTN_oGabriel, $email_experience_tracker, $content_place_holder, $dynamic_content){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addDynamicContent_SUBJECT($email_experience_tracker, $content_place_holder, $dynamic_content);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addDynamicContent_HTML($CRNRSTN_oGabriel, $email_experience_tracker, $content_place_holder, $dynamic_content){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addDynamicContent_HTML($email_experience_tracker, $content_place_holder, $dynamic_content);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addDynamicContent_TEXT($CRNRSTN_oGabriel, $email_experience_tracker, $content_place_holder, $dynamic_content){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addDynamicContent_TEXT($email_experience_tracker, $content_place_holder, $dynamic_content);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addDynamicContent_MULTIPART($CRNRSTN_oGabriel, $email_experience_tracker, $content_place_holder, $dynamic_content){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addDynamicContent_MULTIPART($email_experience_tracker, $content_place_holder, $dynamic_content);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function oGabriel_ProxySend($CRNRSTN_oGabriel=NULL){

        $tmp_flag_messenger_send_ARRAY = array();
        if(!isset($CRNRSTN_oGabriel)){

            //
            // FIRE EVERYTHING!
            foreach($this->oMessenger_ARRAY as $serial => $oGabriel){
                if(!isset($tmp_flag_messenger_send_ARRAY[$oGabriel->messenger_serial])){

                    $tmp_flag_messenger_send_ARRAY[$oGabriel->messenger_serial] = 1;

                    $oGabriel->proxySend();

                    $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

                    $this->error_log('Finished Triggering oGabriel_ProxySend('.$oGabriel->messenger_serial.').', __LINE__, __METHOD__, __FILE__,CRNRSTN_GABRIEL);

                }
            }

        }else{

            $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

            $oGabriel->proxySend();

            $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

            $this->error_log('Finished Trigger oGabriel_ProxySend('.$oGabriel->messenger_serial.').', __LINE__, __METHOD__, __FILE__,CRNRSTN_GABRIEL);

        }

    }

    public function oGabriel_Send($CRNRSTN_oGabriel=NULL){

        $tmp_flag_messenger_send_ARRAY = array();
        if(!isset($CRNRSTN_oGabriel)){

            //
            // FIRE EVERYTHING!
            foreach($this->oMessenger_ARRAY as $serial => $oGabriel){
                if(!isset($tmp_flag_messenger_send_ARRAY[$oGabriel->messenger_serial])){

                    $tmp_flag_messenger_send_ARRAY[$oGabriel->messenger_serial] = 1;

                    $send_result_array[] = $oGabriel->send();

                    $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

                    $this->error_log('Finished Triggering oGabriel->send('.$oGabriel->messenger_serial.').', __LINE__, __METHOD__, __FILE__,CRNRSTN_GABRIEL);

                }
            }

        }else{

            $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

            $send_result_array[] = $oGabriel->send();

            $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

            $this->error_log('Finished Trigger oGabriel->send('.$oGabriel->messenger_serial.').', __LINE__, __METHOD__, __FILE__,CRNRSTN_GABRIEL);


        }

        return $send_result_array;

    }

    public function oGabriel_SendReport($CRNRSTN_oGabriel){

        $this->error_log('Trigger oGabriel_SendReport().', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

        // where $emailSendReport_ARRAY = array['0'=>['email@email.com'=>'success'], '1'=>['test@test.com'=>'duplicate_suppressed'], test2@test.com'=>'error']
        /*
                foreach($emailSendReport_ARRAY as $index=>$emailReport){
                    foreach($emailReport as $email=>$sendStatus){

                        'UPDATE table where 'EMAIL'= $email SET...;'

                    }
                }
         * */

        return true;

    }

    public function addAddressBulk($CRNRSTN_oGabriel, $recipient_email, $recipient_name = '', $email_experience_tracker = NULL){

        if(!isset($email_experience_tracker)){

            $email_experience_tracker = $this->generate_new_key(70);

        }

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addAddressBulk($email_experience_tracker, $recipient_email, $recipient_name);

        //
        // DEFAULT ISHTML TO FALSE...JUST LIKE SINGLE EMAIL
        $oGabriel->isHTMLBulk($email_experience_tracker, false);

        //
        // DEFAULT WORDWRAP...JUST LIKE SINGLE EMAIL
        $oGabriel->wordWrapBulk($email_experience_tracker, 72);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

        return $email_experience_tracker;

    }

    public function isHTMLBulk($CRNRSTN_oGabriel, $email_experience_tracker, $bool_isHTML){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->isHTMLBulk($email_experience_tracker, $bool_isHTML);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function setPriorityBulk($CRNRSTN_oGabriel, $email_experience_tracker, $priority = 'NORMAL'){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->setPriorityBulk($email_experience_tracker, $priority);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addFromBulk($CRNRSTN_oGabriel, $email_experience_tracker, $sender_email, $sender_name = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addFromBulk($email_experience_tracker, $sender_email, $sender_name);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function wordWrapBulk($CRNRSTN_oGabriel, $email_experience_tracker, $max_char_column_cnt=72){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->wordWrapBulk($email_experience_tracker, $max_char_column_cnt);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addReplyToBulk($CRNRSTN_oGabriel, $email_experience_tracker, $reply_to_email, $reply_to_name = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addReplyToBulk($email_experience_tracker, $reply_to_email, $reply_to_name);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addCCBulk($CRNRSTN_oGabriel, $email_experience_tracker, $cc_email, $cc_name = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addCCBulk($email_experience_tracker, $cc_email, $cc_name);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addBCCBulk($CRNRSTN_oGabriel, $email_experience_tracker, $bcc_email, $bcc_name = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addBCCBulk($email_experience_tracker, $bcc_email, $bcc_name);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addSubjectBulk($CRNRSTN_oGabriel, $email_experience_tracker, $subject_line = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addSubjectBulk($email_experience_tracker, $subject_line);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addHTMLver_Bulk($CRNRSTN_oGabriel, $email_experience_tracker, $html_message = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addHTMLver_Bulk($email_experience_tracker, $html_message);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addTEXTver_Bulk($CRNRSTN_oGabriel, $email_experience_tracker, $text_message = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addTEXTver_Bulk($email_experience_tracker, $text_message);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    //
    // BATCH MANAGEMENT TO LIMIT RESOURCE CONSUMPTION - where here, it is 25 email messages per batch
    public function batchReadyToSend($CRNRSTN_oGabriel, $max_batch_count = 0){

        // USE LIKE THIS
        //if($oCRNRSTN_USR->batchReadyToSend($CRNRSTN_oGabriel, 25)){

        //}
        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        return $oGabriel->batchReadyToSend($max_batch_count);

    }

    public function sendStatusReportEmail($CRNRSTN_oGabriel, $recipient_email, $recipient_name){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->sendStatusReportEmail($recipient_email, $recipient_name);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function return_oCRNRSTN_ENV(){

        return $this->oCRNRSTN_ENV;

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function get_resource($resourceKey, $wildCardResourceKey=NULL){

        return $this->oCRNRSTN_ENV->getEnvParam($resourceKey, $wildCardResourceKey);

    }

    public function return_SOAP_svc_oClient_meta($param_key, $CRNRSTN_SOAP_SVC_USERNAME, $CRNRSTN_SOAP_SVC_PASSWORD){

        return $this->oCRNRSTN_ENV->return_SOAP_svc_oClient_meta($param_key, $CRNRSTN_SOAP_SVC_USERNAME, $CRNRSTN_SOAP_SVC_PASSWORD);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function return_SOAP_svc_config_param($param_key){

        return $this->oCRNRSTN_ENV->return_SOAP_svc_config_param($param_key);

    }

    public function client_agent_is($key, $userAgent = null, $httpHeaders = null){

        return $this->oCRNRSTN_ENV->client_agent_is($key, $userAgent, $httpHeaders);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function is_client_mobile($tablet_is_mobile = false){

        return $this->oCRNRSTN_ENV->oHTTP_MGR->is_client_mobile($tablet_is_mobile);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function is_client_tablet($mobile_is_tablet = false){

        return $this->oCRNRSTN_ENV->oHTTP_MGR->is_client_tablet($mobile_is_tablet);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function is_client_mobile_custom($target_device = NULL){

        return $this->oCRNRSTN_ENV->oHTTP_MGR->is_client_mobile_custom($target_device);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function set_client_mobile(){

        return $this->oCRNRSTN_ENV->oHTTP_MGR->set_client_tablet();

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function set_client_tablet(){

        return $this->oCRNRSTN_ENV->oHTTP_MGR->set_client_tablet();

    }

    public function set_client_desktop(){

        return $this->oCRNRSTN_ENV->oHTTP_MGR->set_client_desktop();

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function set_client_mobile_custom($target_device = NULL){

        return $this->oCRNRSTN_ENV->oHTTP_MGR->set_client_mobile_custom($target_device);

    }

    //
    // REVERT MOBILE STATE...WITH RESPECT TO SESSION CONFIG...FOR IT TO BE
    // DRIVEN BY ANY EXISTING PAGE LOAD DETECTION ONCE AGAIN.
    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function resetDeviceDetect(){

        //
        // STANDARD DETECTION RESET
        $this->oCRNRSTN_ENV->oSESSION_MGR->set_session_param('isMobile', false);
        $this->oCRNRSTN_ENV->oSESSION_MGR->set_session_param('isTablet', false);

        //
        // CUSTOM DETECTION RESET
        $this->oCRNRSTN_ENV->oSESSION_MGR->set_session_param('CUSTOM_DEVICE', '');

        return true;

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function init_form_handling($crnrstn_form_handle, $transport_protocol = 'POST', $tunnel_encrypt_hidden_input_data = NULL){

        try {

            if (!isset($crnrstn_form_handle) || !isset($transport_protocol)) {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('CRNRSTN_USR->init_form_handling() configuration error :: unable to detect form_handle or transport_protocol.');

            } else {

                $http_transport_protocol = strtoupper($transport_protocol);
                $http_transport_protocol = $this->string_sanitize($http_transport_protocol, 'http_protocol_simple');

                if ($http_transport_protocol != 'GET' && $http_transport_protocol != 'POST') {

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('CRNRSTN_USR->init_form_handling() configuration error :: unable to detect transport_protocol[POST/GET] from the provided value of ' . $transport_protocol . '.');

                } else {

                    if (isset(self::$form_handle_ARRAY[$crnrstn_form_handle])) {

                        if ($http_transport_protocol != self::$form_handle_ARRAY[$crnrstn_form_handle]) {


                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('CRNRSTN_USR->init_form_handling() configuration error :: duplicate CRNRSTN :: form handle detected upon receiving the provided value of ' . $crnrstn_form_handle . '.');

                        } else {

                            self::$form_handle_ARRAY[$crnrstn_form_handle] = $http_transport_protocol;

                        }

                    } else {

                        self::$form_handle_ARRAY[$crnrstn_form_handle] = $http_transport_protocol;

                    }

                }

                if(isset($tunnel_encrypt_hidden_input_data)){

                    error_log(__LINE__.' user enter  init_form_handling()...die();');
                    die();
                    self::$form_handle_ARRAY[$crnrstn_form_handle]['tunnel_encrypt'] = $tunnel_encrypt_hidden_input_data;

                }

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return NULL;

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function init_input_listener($crnrstn_form_handle = NULL, $html_dom_form_input_name = NULL, $is_required = false){

        try {

            if (!isset($crnrstn_form_handle) || !isset($html_dom_form_input_name)) {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('CRNRSTN_USR->init_input_listener() configuration error :: unable to detect form_handle from [' . $crnrstn_form_handle . '] or html_dom_form_input_name from [' . $html_dom_form_input_name . '].');

            } else {

                if (isset(self::$form_input_general_ARRAY[$crnrstn_form_handle][$html_dom_form_input_name])) {

                    if ($is_required == self::$form_input_general_ARRAY[$crnrstn_form_handle][$html_dom_form_input_name]) {

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('CRNRSTN_USR->init_input_listener() configuration error :: duplicate and conflicting CRNRSTN :: form input detected upon receiving the provided value of ' . $html_dom_form_input_name . '.');

                    } else {

                        //
                        // TECHNICALLY, DOES NOT NEED TO RUN. WILL JUST OVERWRITE WITH THE SAME.
                        self::$form_input_general_ARRAY[$crnrstn_form_handle][$html_dom_form_input_name] = $is_required;

                    }

                } else {

                    self::$form_input_general_ARRAY[$crnrstn_form_handle][$html_dom_form_input_name] = $is_required;

                    if ($is_required) {

                        $tmp_validatation = 'is_required';

                    } else {

                        $tmp_validatation = NULL;
                    }

                    $this->compileFormIntegrationPacket($crnrstn_form_handle, $html_dom_form_input_name, false, $tmp_validatation);
                }

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return NULL;

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function addHiddenFormInputParamListener($crnrstn_form_handle = NULL, $html_dom_form_input_name = NULL, $html_dom_form_input_id = NULL, $is_required = false, $default_val = NULL){

        if ($is_required) {

            $tmp_required = 'true';

        } else {

            $tmp_required = 'false';

        }

        if(!isset($html_dom_form_input_id)){

            $html_dom_form_input_id = 'crnrstn_input_' . $this->generate_new_key(10);

        }

        try {

            if (!isset($crnrstn_form_handle) || !isset($html_dom_form_input_name)) {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to detect form_handle from [' . $crnrstn_form_handle . '] or html_dom_form_input_name from [' . $html_dom_form_input_name . '].');

            } else {

                if (isset(self::$form_input_hidden_ARRAY[$crnrstn_form_handle][$html_dom_form_input_name][$html_dom_form_input_id])) {

                    //
                    // FORM FIELD HAS BEEN DEFINED ALREADY. IF NOT A PERFECT MATCH...THROW DUPLICATE ERROR.
                    if (isset(self::$form_input_hidden_ARRAY[$crnrstn_form_handle][$html_dom_form_input_name][$html_dom_form_input_id][$tmp_required])) {

                        if (self::$form_input_hidden_ARRAY[$crnrstn_form_handle][$html_dom_form_input_name][$html_dom_form_input_id][$tmp_required] != $default_val) {

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Duplicate and conflicting CRNRSTN :: form input detected upon receiving the provided value of ' . $html_dom_form_input_name . '.');

                        } else {

                            self::$form_input_hidden_ARRAY[$crnrstn_form_handle][$html_dom_form_input_name][$html_dom_form_input_id][$tmp_required] = $default_val;

                        }

                    } else {

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Duplicate and conflicting CRNRSTN :: form input detected upon receiving the provided value of ' . $html_dom_form_input_name . '.');

                    }

                } else {

                    self::$form_input_hidden_ARRAY[$crnrstn_form_handle][$html_dom_form_input_name][$html_dom_form_input_id][$tmp_required] = $default_val;

                }

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return NULL;

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    // addValidationRedirect('crnrstn_signin_flagship', '*', '*', $err_uri, $success_uri);
    public function addValidationRedirect($crnrstn_form_handle = NULL, $html_dom_form_input_name_pipe_delim = NULL, $validation_key_pipe_delim = NULL, $on_error_redirect_uri = NULL, $on_success_redirect_uri = NULL){




        return NULL;

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function formPrepopulateInputValue($crnrstn_form_handle, $html_dom_form_input_name, $force_default = false, $default_value = NULL){

        return NULL;

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function init_validation_message($crnrstn_form_handle, $html_dom_form_input_name, $message_key, $err_msg = NULL, $success_msg = NULL, $info_msg = NULL){

        self::$form_input_transaction_copy_ARRAY[$crnrstn_form_handle][$html_dom_form_input_name][$message_key]['SUCCESS'][] = $success_msg;
        self::$form_input_transaction_copy_ARRAY[$crnrstn_form_handle][$html_dom_form_input_name][$message_key]['ERROR'][] = $err_msg;
        self::$form_input_transaction_copy_ARRAY[$crnrstn_form_handle][$html_dom_form_input_name][$message_key]['INFO'][] = $info_msg;

        return true;

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    private function injectInputSerialization($crnrstn_form_handle = NULL){

        $tunnel_encrypt_hidden_input_data = true;

        if(isset(self::$form_handle_ARRAY[$crnrstn_form_handle]['tunnel_encrypt'])){

            $tunnel_encrypt_hidden_input_data = self::$form_handle_ARRAY[$crnrstn_form_handle]['tunnel_encrypt'];

        }

        $tmp_input_name_ARRAY = array();
        $tmp_input_id_ARRAY = array();
        $tmp_input_isrequired_ARRAY = array();
        $tmp_input_value_ARRAY = array();
        $tmp_input_success_copy_ARRAY = array();
        $tmp_input_err_copy_ARRAY = array();
        $tmp_input_info_copy_ARRAY = array();

        try {

            if (!is_bool($tunnel_encrypt_hidden_input_data)) {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('CRNRSTN :: Serialization configuration error :: encrypt_hidden_input_data is a required BOOLEAN parameter.');

            }

            if (!isset($crnrstn_form_handle)) {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('CRNRSTN :: Serialization configuration error :: form handle is a required parameter.');

            } else {

                foreach (self::$form_input_hidden_ARRAY as $zeroKey => $zeroArray_val) {

                    if ($zeroKey == $crnrstn_form_handle) {

                        foreach ($zeroArray_val as $inputName_key => $oneArray_val) {

                            //
                            // STORE INPUT NAME
                            $tmp_input_name_ARRAY[] = $inputName_key;

                            foreach ($oneArray_val as $inputID_key => $twoArray_val) {
                                //
                                // STORE INPUT ID
                                $tmp_input_id_ARRAY[] = $inputID_key;

                                foreach ($twoArray_val as $inputRequired => $val) {
                                    //
                                    // STORE INPUT REQUIRED_STATE & DEFAULT VALUE
                                    $tmp_input_isrequired_ARRAY[] = $inputRequired;
                                    $tmp_input_value_ARRAY[] = $val;

                                    //
                                    // POPULATE SUCCESS/ERR STATUS NOTIFICATION META
                                    if(isset(self::$form_input_transaction_copy_ARRAY[$zeroKey][$inputName_key])){

                                        foreach(self::$form_input_transaction_copy_ARRAY[$zeroKey][$inputName_key] as $message_key => $copy_type_array){

                                            foreach($copy_type_array as $copy_type => $copy_str_ARRAY) {

                                                foreach ($copy_str_ARRAY as $key => $copy_str) {

                                                    error_log(__LINE__ . ' user $copy_str=' . $copy_str);
                                                    switch ($copy_type) {
                                                        case 'SUCCESS':

                                                            $tmp_input_success_copy_ARRAY[] = $copy_str;

                                                        break;
                                                        case 'ERROR':

                                                            $tmp_input_err_copy_ARRAY[] = $copy_str;

                                                        break;
                                                        case 'INFO':

                                                            $tmp_input_info_copy_ARRAY[] = $copy_str;

                                                        break;

                                                    }

                                                }

                                            }

                                        }

                                    }

                                    if ($inputRequired == 'true' && $val == '') {

                                        //
                                        // HOOOSTON...VE HAF PROBLEM!
                                        throw new Exception('CRNRSTN :: Serialization configuration error :: A default value is required for the hidden input ' . $inputName_key . ' on the form with handle ' . $zeroKey . '.');

                                    }
                                }
                            }
                        }
                    }
                }





                /*
                self::$form_input_transaction_copy_ARRAY
                self::$form_input_transaction_copy_ARRAY[$crnrstn_form_handle][$html_dom_form_input_name][$message_key]['SUCCESS'][] = $success_msg;
                self::$form_input_transaction_copy_ARRAY[$crnrstn_form_handle][$html_dom_form_input_name][$message_key]['ERROR'][] = $err_msg;
                self::$form_input_transaction_copy_ARRAY[$crnrstn_form_handle][$html_dom_form_input_name][$message_key]['INFO'][] = $info_msg;

                */

                //
                // BUILD OUTPUT HTML
                $tmp_html_out = '';
                $tmp_loop_size = sizeof($tmp_input_name_ARRAY);

                if ($tunnel_encrypt_hidden_input_data) {

                    //
                    // NEED TO VERIFY TUNNEL ENCRYPTION SETTINGS OR DO NOT ENCRYPT PARAMS.
                    $tmp_tunnelEncryptionState = $this->is_tunnel_encrypt_configured();

                    if (!$tmp_tunnelEncryptionState) {

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('CRNRSTN :: Serialization configuration error :: It has been requested that hidden input fields be tunnel encrypted, however the current configuration of CRNRSTN Suite :: v2.0.0 has failed to successfully execute encrypt/decrypt. Please reconfigure and try again, or pass a second parameter...FALSE...to injectInputSerialization().');

                    }

                    //
                    // APPROVED TO ENCRYPT CRNRSTN FORM INTEGRATION PACKET
                    self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['packet_encryption_status'] = 'true';

                    //
                    // READY TO BUILD OUTPUT AND SEND VIA CRNRSTN :: TUNNEL ENCRYPTION
                    for ($i = 0; $i < $tmp_loop_size; $i++) {

                        if ($tmp_input_id_ARRAY[$i] != '{crnrstn2.0.0_nullEmpty}') {

                            $tmp_html_out .= '<input type="hidden" id="' . $tmp_input_id_ARRAY[$i] . '" name="' . $tmp_input_name_ARRAY[$i] . '" value="' . $this->param_tunnel_encrypt($tmp_input_value_ARRAY[$i]) . '">';

                        } else {

                            $tmp_html_out .= '<input type="hidden" name="' . $tmp_input_name_ARRAY[$i] . '" value="' . $this->param_tunnel_encrypt($tmp_input_value_ARRAY[$i]) . '">';

                        }

                        if ($tmp_input_isrequired_ARRAY[$i]) {

                            $tmp_validatation = 'is_required';

                        } else {

                            $tmp_validatation = NULL;

                        }

                        $this->compileFormIntegrationPacket($crnrstn_form_handle, $tmp_input_name_ARRAY[$i], true, $tmp_validatation);

                    }

                } else {

                    //
                    // NOT APPROVED TO ENCRYPT CRNRSTN FORM INTEGRATION PACKET
                    self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['packet_encryption_status'] = 'false';

                    for ($i = 0; $i < $tmp_loop_size; $i++) {

                        //
                        // NO TUNNEL ENCRYPTION IS DESIRED FOR HIDDEN INPUT DATA
                        if ($tmp_input_id_ARRAY[$i] != '{crnrstn2.0.0_nullEmpty}') {

                            $tmp_html_out .= '<input type="hidden" id="' . $tmp_input_id_ARRAY[$i] . '" name="' . $tmp_input_name_ARRAY[$i] . '" value="' . $tmp_input_value_ARRAY[$i] . '">';

                        } else {

                            $tmp_html_out .= '<input type="hidden" name="' . $tmp_input_name_ARRAY[$i] . '" value="' . $tmp_input_value_ARRAY[$i] . '">';

                        }

                        if($tmp_input_isrequired_ARRAY[$i]) {

                            $tmp_validatation = 'is_required';

                        }else{

                            $tmp_validatation = NULL;

                        }

                        $this->compileFormIntegrationPacket($crnrstn_form_handle, $tmp_input_name_ARRAY[$i], false, $tmp_validatation);

                    }

                }

            }

        } catch (Exception $e) {

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        $tmp_html_out .= $this->returnFormIntegrationPacket($crnrstn_form_handle);

        return $tmp_html_out;

    }

    public function get_lang_copy($message_key){

        return $this->oCRNRSTN_ENV->get_lang_copy($message_key);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function returnConnection_MySQLi($host = NULL, $db = NULL, $un = NULL, $port = NULL, $pwd = NULL){

        if (!isset($host)) {

            $tmp_host_hashable = md5('{empty}');

        } else {

            $tmp_host_hashable = md5($host);

        }

        if (!isset($db)) {

            $tmp_db_hashable = md5('{empty}');

        } else {

            $tmp_db_hashable = md5($db);

        }

        if (!isset($un)) {

            $tmp_un_hashable = md5('{empty}');

        } else {

            $tmp_un_hashable = md5($un);

        }

        if (!isset($port)) {

            $tmp_port_hashable = md5('{empty}');

        } else {

            $tmp_port_hashable = md5($port);

        }

        if (!isset($pwd)) {

            $tmp_pwd_hashable = md5('{empty}');

        } else {

            $tmp_pwd_hashable = md5($pwd);

        }

        $tmp_mysqli_serial = $this->crcINT($tmp_host_hashable . $tmp_db_hashable . $tmp_un_hashable . $tmp_port_hashable . $tmp_pwd_hashable);

        if (isset(self::$oMySQLi_ARRAY[$tmp_mysqli_serial])) {

            if (is_resource(self::$oMySQLi_ARRAY[$tmp_mysqli_serial])) {

                if (self::$oMySQLi_ARRAY[$tmp_mysqli_serial]->ping()) {

                    //error_log("4106 crnrstn_usr - Please RECYCLE...our connection is OK!");

                } else {

                    //error_log("4110 crnrstn_usr - mysqli existed at one time, but as ping()==FALSE...I must open a new connection now!");

                    //
                    // OPEN CONNECTION
                    self::$oMySQLi_ARRAY[$tmp_mysqli_serial] = $this->oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection($host, $db, $un, $port, $pwd);

                }

            } else {

                //error_log("4120 crnrstn_usr - I will open a new connection now! ...mysqli existed at one time, but has been closed.");

                //
                // OPEN CONNECTION
                self::$oMySQLi_ARRAY[$tmp_mysqli_serial] = $this->oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection($host, $db, $un, $port, $pwd);
                self::$oMySQLi_hash_ARRAY[] = $tmp_mysqli_serial;

            }

        } else {

            //error_log("4131 crnrstn_usr - I will open a new connection now! ...mysqli not set");

            //
            // OPEN CONNECTION
            self::$oMySQLi_ARRAY[$tmp_mysqli_serial] = $this->oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection($host, $db, $un, $port, $pwd);
            self::$oMySQLi_hash_ARRAY[] = $tmp_mysqli_serial;

        }

        //
        // RETURN CRNRSTN MYSQLI CONNECTION OBJECT
        $oCRNRSTN_MySQLi = new crnrstn_db_conn_handle($this);
        $oCRNRSTN_MySQLi->load_connection_serial($tmp_mysqli_serial);
        $oCRNRSTN_MySQLi->load_connection_obj(self::$oMySQLi_ARRAY[$tmp_mysqli_serial]);

        $this->version_mysqli = $oCRNRSTN_MySQLi->version_mysqli;
        $this->oCRNRSTN_ENV->version_mysqli = $this->version_mysqli;

        return $oCRNRSTN_MySQLi;

    }

    public function pushFakeyDBConn($fakey_mysqli_serial, $mysqli){

        self::$oMySQLi_ARRAY[$fakey_mysqli_serial] = $mysqli;
        self::$oMySQLi_hash_ARRAY[] = $fakey_mysqli_serial;

        return $mysqli;

    }

    public function return_oCRNRSTN_MySQLi_Fakey($fakey_mysqli_serial){

        $oCRNRSTN_MySQLi = new crnrstn_db_conn_handle($this);
        $oCRNRSTN_MySQLi->load_connection_serial($fakey_mysqli_serial);

        return $oCRNRSTN_MySQLi;

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function closeConnection_MySQLi($mysqli){

        //error_log("4122 user - I will manually close connection now!");
        $this->oCRNRSTN_ENV->oMYSQLI_CONN_MGR->closeConnection($mysqli);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function get_http_resource($getpost_input_name, $transport_protocol = NULL){

        if (!isset($transport_protocol)) {

            $tmp_variables_order = $this->ini_get('variables_order');
            $tmp_vo_ARRAY = str_split($tmp_variables_order);

            foreach($tmp_vo_ARRAY as $key => $value) {

                switch ($value) {
                    case 'G':

                        if (isset(self::$http_param_handle_ARRAY['GET'][$getpost_input_name])) {

                            return self::$http_param_handle_ARRAY['GET'][$getpost_input_name];

                        }

                    break;
                    case 'P':

                        if (isset(self::$http_param_handle_ARRAY['POST'][$getpost_input_name])) {

                            return self::$http_param_handle_ARRAY['POST'][$getpost_input_name];

                        }

                    break;

                }

            }

        } else {

            $http_protocol = strtoupper($transport_protocol);
            $http_protocol = $this->string_sanitize($http_protocol, 'http_protocol_simple');

            switch ($http_protocol) {
                case 'POST':
                case 'GET':

                    if (isset(self::$http_param_handle_ARRAY[$http_protocol][$getpost_input_name])) {

                        return self::$http_param_handle_ARRAY[$http_protocol][$getpost_input_name];

                    }

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    $this->error_log('Unable to determine HTTP protocol from provided value of [' . $transport_protocol . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                break;

            }

        }

        return NULL;

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function param_tunnel_encrypt($data = NULL, $cipher_override = NULL, $secret_key_override = NULL, $hmac_algorithm_override=NULL, $options_bitwise_override=NULL){

        return $this->oCRNRSTN_ENV->param_tunnel_encrypt($data, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);

    }

    public function return_param_tunnel_encrypt_settings($data = NULL, $cipher_override = NULL, $secret_key_override = NULL, $hmac_algorithm_override=NULL, $options_bitwise_override=NULL){

        return $this->oCRNRSTN_ENV->return_param_tunnel_encrypt_settings($data, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);

    }

    public function openssl_get_cipher_methods(){

        return $this->oCRNRSTN_ENV->openssl_get_cipher_methods();

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function param_tunnel_decrypt($data = NULL, $uri_passthrough = false, $cipher_override = NULL, $secret_key_override = NULL, $hmac_algorithm_override=NULL, $options_bitwise_override=NULL){

        return $this->oCRNRSTN_ENV->param_tunnel_decrypt($data, $uri_passthrough, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);

    }

    public function return_param_tunnel_decrypt_settings($data = NULL, $uri_passthrough = false, $cipher_override = NULL, $secret_key_override = NULL, $hmac_algorithm_override=NULL, $options_bitwise_override=NULL){

        return $this->oCRNRSTN_ENV->return_param_tunnel_decrypt_settings($data, $uri_passthrough, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function is_tunnel_encrypt_configured($cipher_override=NULL, $secret_key_override=NULL, $hmac_algorithm_override=NULL, $options_bitwise_override=NULL){

        $tmp_test_str = 'The quick brown fox jumped over the lazy dog.';
        $tmp_encryptedVal = $this->param_tunnel_encrypt($tmp_test_str, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);
        //error_log('5936 user - Fire Decrypt TEST...['.$tmp_test_str.']==['.$tmp_encryptedVal.']');
        $tmp_decryptedVal = $this->param_tunnel_decrypt($tmp_encryptedVal, true, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);
        //error_log('5938 user - Fire Decrypt TEST...['.$tmp_test_str.']==['.$tmp_decryptedVal.']');

        if ($tmp_test_str == $tmp_decryptedVal) {

            return true;

        } else {

            return false;

        }

    }

    private function compileFormIntegrationPacket($crnrstn_form_handle, $html_dom_form_input_name, $encryption_status = TRUE, $server_side_validation = NULL){

        //
        // DATA PROFILE FOR SUCCESSFUL CRNRSTN FORM CAPTURE INTEGRATION
        # COMPILE TIMESTAMP (SERVER) 1 - 1
        # FORM HANDLE 1 - 1              $crnrstn_form_handle
        # FORM TRANSPORT PROTOCOL 1 - 1  self::$form_handle_ARRAY[$crnrstn_form_handle]
        # ALL INPUT NAME 1 - n
        # INPUT ENCRYPTION STATUS FOR HIDDEN FIELDS 1 - n
        # SERVER-SIDE VALIDATION STRING FOR DATA TREATMENT 1 - n

        // self::$formIntegrationPacket_ARRAY['timestamp']
        // self::$formIntegrationPacket_ARRAY['crnrstn_form_handle'] = $crnrstn_form_handle;
        // self::$formIntegrationPacket_ARRAY['transport_protocol'] = self::$form_handle_ARRAY[$crnrstn_form_handle]
        // self::$formIntegrationPacket_ARRAY['input_name'][n] =
        // self::$formIntegrationPacket_ARRAY['input_encrypt'][n] =
        // self::$formIntegrationPacket_ARRAY['input_validation'][n] =

        if (!isset(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['timestamp'])) {

            self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['timestamp'] = $this->oLogger->returnMicroTime();

        }

        if (!isset(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['crnrstn_form_handle'])) {

            self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['crnrstn_form_handle'] = $crnrstn_form_handle;

        }

        if (!isset(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['transport_protocol'])) {

            self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['transport_protocol'] = self::$form_handle_ARRAY[$crnrstn_form_handle];

        }

        if (!isset(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['integration_packet_encrypt'])) {

            self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['integration_packet_encrypt'] = 'true';

        }

        self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['input_name'][] = $html_dom_form_input_name;

        if ($encryption_status) {

            $encryption_status = 'true';

        } else {

            $encryption_status = 'false';

        }

        self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['input_encrypt'][] = $encryption_status;

        if (!isset($server_side_validation)) {

            $server_side_validation = 'false';

        }

        self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['input_validation'][] = $server_side_validation;

    }

    private function returnFormIntegrationPacket($crnrstn_form_handle){

        $tmp_html_out = '';
        $tmp_html_out .= $this->concatIntegrationPacketDatum(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['timestamp']);
        $tmp_html_out .= $this->concatIntegrationPacketDatum(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['crnrstn_form_handle']);
        $tmp_html_out .= $this->concatIntegrationPacketDatum(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['transport_protocol']);

        $tmp_input_cnt = sizeof(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['input_name']);
        for ($i = 0; $i < $tmp_input_cnt; $i++) {

            $tmp_html_out .= $this->concatIntegrationPacketDatum($i, ":");
            $tmp_html_out .= $this->concatIntegrationPacketDatum(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['input_name'][$i], ":");
            $tmp_html_out .= $this->concatIntegrationPacketDatum(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['input_encrypt'][$i], ":");
            $tmp_html_out .= $this->concatIntegrationPacketDatum(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['input_validation'][$i], ":");

            $tmp_html_out = rtrim($tmp_html_out, ':');

            //self::$formIntegrationPacket_ARRAY['input_name']
            //self::$formIntegrationPacket_ARRAY['input_encrypt']
            //self::$formIntegrationPacket_ARRAY['input_validation']

            $tmp_html_out = $this->concatIntegrationPacketDatum($tmp_html_out);

            # <input type="hidden" name="CRNRSTN_INTEGRATION_PACKET" value="">
            /*

            value="TIMESTAMP[CRNRSTN::2.0.0]FORM_HANDLE[CRNRSTN::2.0.0]TRANSPORT_PROTOCOL[CRNRSTN::2.0.0]
            0:input_name:input_encrypt:input_validation[CRNRSTN::2.0.0]
            1:input_name:input_encrypt:input_validation[CRNRSTN::2.0.0]
            2:input_name:input_encrypt:input_validation[CRNRSTN::2.0.0]
            3:input_name:input_encrypt:input_validation[CRNRSTN::2.0.0]
            n:input_name:input_encrypt:input_validation[CRNRSTN::2.0.0]"

             * */

        }

        $tmp_encrypted_flag = false;
        $tmp_html_out = rtrim($tmp_html_out, '[CRNRSTN::2.0.0]');
        if (self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['packet_encryption_status'] == 'true') {

            $tmp_array_outer = array();
            $tmp_html_out = $this->param_tunnel_encrypt($tmp_html_out);
            $tmp_array = $this->return_param_tunnel_encrypt_settings($tmp_html_out);

            if(!$this->isset_session_param('ENCRYPT_PARAMS')){
                $tmp_array_outer[] = $tmp_array;
                $this->set_session_param('ENCRYPT_PARAMS', $tmp_array_outer);

            }else{

                $tmp_array_outer_sess = $this->get_session_param('ENCRYPT_PARAMS');
                $tmp_array_outer_sess[] = $tmp_array;
                $this->set_session_param('ENCRYPT_PARAMS', $tmp_array_outer_sess);

            }

            if ($tmp_html_out != "") {

                $tmp_encrypted_flag = true;

            }

        }

        $tmp_html_out = '<input type="hidden" name="CRNRSTN_INTEGRATION_PACKET" value="' . $tmp_html_out . '">';

        if ($tmp_encrypted_flag) {
            $tmp_html_out .= '<input type="hidden" name="CRNRSTN_INTEGRATION_PACKET_ENCRYPTED" value="true">';

        }

        return $tmp_html_out;

    }


    public function initialize_crnrstn_svc_http($user_auth_check = false, $uri_passthrough = false, $cipher_override = NULL, $secret_key_override = NULL, $hmac_algorithm_override = NULL, $options_bitwise_override = NULL){

        $tmp_has_getpost_data = false;

        //
        // ESTABLISH SEQUENCE TO CHECK FOR CRNRSTN_INTEGRATION_PACKET
        $tmp_variables_order = $this->ini_get('variables_order');
        $tmp_vo_ARRAY = str_split($tmp_variables_order);

        /*
        Sets the order of the EGPCS (Environment, Get, Post, Cookie, and Server) variable
        parsing. For example, if variables_order is set to "SP" then PHP will create the superglobals
        $_SERVER and $_POST, but not create $_ENV, $_GET, and $_COOKIE. Setting to "" means no
        superglobals will be set.

        */

        foreach($tmp_vo_ARRAY as $key => $value){

            switch($value){
                case 'G':

                    //
                    // DO WE HAVE GET DATA?
                    if ($this->oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_GET)) {
                        error_log(__LINE__ . ' user CHECKING FOR PRESENCE OF $_GET...CRNRSTN_INTEGRATION_PACKET');

                        //
                        // CHECK FOR PRESENCE OF FORM INTEGRATION PACKET DATA
                        if ($this->oCRNRSTN_ENV->oHTTP_MGR->issetParam($_GET, 'CRNRSTN_INTEGRATION_PACKET')) {
                            //error_log('4418 user - process CRNRSTN_INTEGRATION_PACKET @ _GET');
                            $tmp_has_getpost_data = true;

                            $tmp_isEncrypted = '';
                            if ($this->oCRNRSTN_ENV->oHTTP_MGR->issetParam($_GET, 'CRNRSTN_INTEGRATION_PACKET_ENCRYPTED')) {

                                $tmp_isEncrypted = strtolower($this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'CRNRSTN_INTEGRATION_PACKET_ENCRYPTED'));

                            }

                            if ($tmp_isEncrypted == 'true') {

                                //error_log('4429 user - decrypt CRNRSTN_INTEGRATION_PACKET @ _GET');
                                $this->consumeFormIntegrationPacket($this->param_tunnel_decrypt($this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'CRNRSTN_INTEGRATION_PACKET'), false, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override), 'GET');

                            } else {

                                //error_log('4434 user - decrypt CRNRSTN_INTEGRATION_PACKET @ _GET');
                                $this->consumeFormIntegrationPacket($this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'CRNRSTN_INTEGRATION_PACKET'), 'GET');

                            }

                        }

                    }

                break;
                case 'P':

                    if ($this->oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_POST)) {
                        error_log(__LINE__ . ' user CHECKING FOR PRESENCE OF $_POST...CRNRSTN_INTEGRATION_PACKET');

                        //
                        // CHECK FOR PRESENCE OF FORM INTEGRATION PACKET DATA
                        if ($this->oCRNRSTN_ENV->oHTTP_MGR->issetParam($_POST, 'CRNRSTN_INTEGRATION_PACKET')) {

                            $tmp_has_getpost_data = true;

                            $tmp_isEncrypted = '';
                            if ($this->oCRNRSTN_ENV->oHTTP_MGR->issetParam($_POST, 'CRNRSTN_INTEGRATION_PACKET_ENCRYPTED')) {

                                $tmp_isEncrypted = strtolower($this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, 'CRNRSTN_INTEGRATION_PACKET_ENCRYPTED'));

                            }

                            if ($tmp_isEncrypted == 'true') {

                                //error_log(__LINE__ . ' user auth  $tmp_isEncrypted is true. Decrypting CRNRSTN_INTEGRATION_PACKET=['.$this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, 'CRNRSTN_INTEGRATION_PACKET').']');
                                $uri_passthrough = true;
                                $tmp_output = $this->param_tunnel_decrypt($this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, 'CRNRSTN_INTEGRATION_PACKET'), $uri_passthrough, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);
                                //error_log(__LINE__ . ' user auth  $tmp_isEncrypted is true. DONE Decrypting CRNRSTN_INTEGRATION_PACKET to ['.$tmp_output.']');

                                error_log(__LINE__ . ' user CONSUME $_POST...CRNRSTN_INTEGRATION_PACKET AFTER DECRYPT.');
                                $this->consumeFormIntegrationPacket($tmp_output, 'POST');

                            } else {

                                error_log(__LINE__ . ' user CONSUME $_POST...CRNRSTN_INTEGRATION_PACKET...AND NO DECRYPT.');
                                $this->consumeFormIntegrationPacket($this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, 'CRNRSTN_INTEGRATION_PACKET'), 'POST');

                            }

                        }

                    }

                break;

            }

        }

//
//        if(isset($tmp_form_handle)) {
//
//            switch ($tmp_form_handle) {
//                case 'crnrstn_signin_flagship':
//                case 'crnrstn_signin_wireframe':
//
//
//                break;
//                case 'crnrstn_validate_css':
//
//                    if ($this->isset_crnrstn_svc_http('POST')) {
//                        error_log(__LINE__ . ' user POST CSS isset_crnrstn_svc_http = TRUE');
//
//                        //
//                        // VALIDATE CSS
//                        $raw_html_data = $this->extractData_HTTP('ugc_html', 'POST');
//
//                        $tmp_validation_results_ARRAY = $this->validate_css($raw_html_data);
//
//                        $tmp_validation_results = $tmp_validation_results_ARRAY['HTML_OUT'];
//
//                        error_log(__LINE__ . ' user POST CSS $tmp_validation_results cnt = ' . strlen($tmp_validation_results));
//
//                        $tmp_key = $this->generate_new_key(50);
//
//                        $this->set_session_param('DISPLAY_AUTH_KEY', $tmp_key);
//                        $this->set_session_param('CRNRSTN_CSS_VALIDATION_RESP', $tmp_validation_results);
//
//                        $tmp_score_numeric_raw = $tmp_validation_results_ARRAY['SCORE_NUMERIC_RAW'];
//                        $tmp_packet_size = $tmp_validation_results_ARRAY['PACKET_BYTES_SIZE'];
//                        $tmp_run_time = $tmp_validation_results_ARRAY['WALLTIME'];
//                        $tmp_run_time = $tmp_run_time . 'secs';
//
//                        error_log(__LINE__ . ' user $tmp_score_numeric_raw=['.$tmp_score_numeric_raw.'] $tmp_packet_size=['.$tmp_packet_size.'] $tmp_run_time=['.$tmp_run_time.'] ');
//
//                        if ($this->isSSL()) {
//
//                            $tmp_post_uri = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//
//                        } else {
//
//                            $tmp_post_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//
//                        }
//
//                        $pos_quest = strpos($tmp_post_uri, '?');
//                        if ($pos_quest !== false) {
//
//                            $tmp_post_uri = $tmp_post_uri . '&crnrstn_l=css_validator&crnrstn_css_rtime=' . urlencode($tmp_run_time) . '&bytes=' . urlencode($tmp_packet_size) . '&score=' . urlencode($tmp_score_numeric_raw);
//
//                        } else {
//
//                            $tmp_post_uri = $tmp_post_uri . '?crnrstn_l=css_validator&crnrstn_css_rtime=' . urlencode($tmp_run_time) . '&bytes=' . urlencode($tmp_packet_size) . '&score=' . urlencode($tmp_score_numeric_raw);
//
//                        }
//
//                        //
//                        // SUPPORT BACK LINK FOR MIT LICENSE PAGE
//                        $this->sync_back_link_state();
//
//                        error_log(__LINE__ . ' user POST CSS $tmp_post_uri = ' . $tmp_post_uri);
//
//                        //
//                        // I WOULD LIKE TO SEE GOOGLE ANALYTICS DATA WITH CSS SCORES AND PERFORMANCE OF THE SYSTEM.
//                        header("Location: " . $tmp_post_uri);
//                        exit();
//
//                    } else {
//                        error_log(__LINE__ . __METHOD__ . ' user $user_auth_check is true');
//
//                        //
//                        // SUPPORT BACK LINK FOR MIT LICENSE PAGE
//                        $this->sync_back_link_state();
//
//                        echo $this->ui_module_out('css_validator');
//                        exit();
//
//                    }
//
//                break;
//
//            }
//        }

        //
        // BOOLEAN INDICATION OF A REQUEST FROM THE GATE KEEPER FOR THE SPACE BETWEEN
        // https://www.youtube.com/watch?v=YvzWRzTh7jg
        // TITLE :: The Space Between
        if($user_auth_check){

            $this->oCRNRSTN_VSC = new crnrstn_view_state_controller($this);

            //
            // IS THERE A FORM POST FROM CRNRSTN :: TO PROCESS?
            if ($this->oCRNRSTN_ENV->oHTTP_MGR->issetParam($_POST, 'CRNRSTN_INTEGRATION_PACKET')) {

                $tmp_has_getpost_data = true;

                $tmp_form_handle = $this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, 'CRNRSTN_FORM_HANDLE', true);

                error_log(__LINE__ . ' user $tmp_form_handle=' . $tmp_form_handle);
                $this->oCRNRSTN_VSC->return_client_response($tmp_form_handle);
//
//
//                switch($tmp_form_handle){
//                    case 'crnrstn_signin_flagship':
//                    case 'crnrstn_signin_wireframe':
//
//                        if(!isset($this->oCRNRSTN_AUTH)){
//
//                            $this->oCRNRSTN_AUTH = new crnrstn_user_auth($this);
//
//                        }
//
//                        $this->oCRNRSTN_AUTH->initialize_user_login_attempt();
//
//                        if($tmp_oCRNRSTN_AUTH = $this->oCRNRSTN_AUTH->process_authorization()){
//
//                            echo $this->ui_module_out('dashboard');
//                            exit();
//
//                        }else{
//
//                            echo $this->ui_module_out('signin');
//                            exit();
//
//                        }
//
//                        break;
//                    case 'crnrstn_validate_css':
////                        error_log(__LINE__ . ' user POST CSS PROCESS = TRUE');
////
////                        if ($this->isset_crnrstn_svc_http('POST')) {
////                            error_log(__LINE__ . ' user POST CSS isset_crnrstn_svc_http = TRUE');
////
////                            //
////                            // VALIDATE CSS
////                            $raw_html_data = $this->extractData_HTTP('ugc_html', 'POST');
////
////                            $tmp_validation_results = $this->validate_css($raw_html_data);
////                            error_log(__LINE__ . ' user POST CSS $tmp_validation_results cnt = '.strlen($tmp_validation_results));
////
////                            $tmp_key = $this->generate_new_key(50);
////
////                            $this->set_session_param('DISPLAY_AUTH_KEY', $tmp_key);
////                            $this->set_session_param('CRNRSTN_CSS_VALIDATION_RESP', $tmp_validation_results);
////
////                            $tmp_score_numeric_raw = $this->get_session_param('SCORE_NUMERIC_RAW');
////                            $tmp_packet_size = $this->get_session_param('PACKET_BYTES_SIZE');
////                            $tmp_run_time = $this->get_session_param('WALLTIME');
////                            $tmp_run_time = $tmp_run_time.'secs';
////
////                            if($this->isSSL()){
////
////                                $tmp_post_uri = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
////
////                            }else{
////
////                                $tmp_post_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
////
////                            }
////
////                            $pos_quest = strpos($tmp_post_uri,'?');
////                            if($pos_quest !== false){
////
////                                $tmp_post_uri = $tmp_post_uri . '&crnrstn_l=css_validator&crnrstn_css_rtime=' . urlencode($tmp_run_time) . '&bytes='.urlencode($tmp_packet_size) . '&score='.urlencode($tmp_score_numeric_raw);
////
////                            }else{
////
////                                $tmp_post_uri = $tmp_post_uri . '?crnrstn_l=css_validator&crnrstn_css_rtime=' . urlencode($tmp_run_time) . '&bytes='.urlencode($tmp_packet_size) . '&score='.urlencode($tmp_score_numeric_raw);
////
////                            }
////
////                            //
////                            // SUPPORT BACK LINK FOR MIT LICENSE PAGE
////                            $this->sync_back_link_state();
////
////                            error_log(__LINE__ . ' user POST CSS $tmp_post_uri = ' . $tmp_post_uri);
////
////                            //
////                            // I WOULD LIKE TO SEE GOOGLE ANALYTICS DATA WITH CSS SCORES AND PERFORMANCE OF THE SYSTEM.
////                            header("Location: ".$tmp_post_uri);
////                            exit();
////
////                        }else{
////                            error_log(__LINE__ . __METHOD__ . ' user $user_auth_check is true');
////
////                            //
////                            // SUPPORT BACK LINK FOR MIT LICENSE PAGE
////                            $this->sync_back_link_state();
////
////                            echo $this->ui_module_out('css_validator');
////                            exit();
////
////                        }
//
//                        break;
//                    default:
//
//                        return false;
//
//                        break;
//
//                }

            }else{

                //error_log(__LINE__ . ' user invoking oCRNRSTN_VSC->return_client_response() next....for $_GET...');

                //exit();
//
//                //
//                // WE CHECK GET (FROM THE GATE KEEPER FOR THE SPACE BETWEEN)
//                if ($this->oCRNRSTN_ENV->oHTTP_MGR->issetParam($_GET, 'crnrstn_l')) {
//
//                    if ($this->oCRNRSTN_ENV->oHTTP_MGR->issetParam($_GET, 'crnrstn_css_rtime')) {
//
//                        $tmp_output_html = $this->get_session_param('CRNRSTN_CSS_VALIDATION_RESP');
//
//                        if(strlen($tmp_output_html) > 1){
//
//                            echo $tmp_output_html;
//                            exit();
//
//                        }else{
//
//                            //
//                            // IF SESSION RETURNS NOTHING, JUST RELOAD THE FORM.
//                            //error_log(__LINE__ . ' user  SESSION RETURNS NOTHING, JUST RELOAD THE FORM.');
//                            echo $this->ui_module_out('css_validator');
//                            exit();
//
//                        }
//
//                    }
//
//                }

            }

        }

        return $tmp_has_getpost_data;

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function isset_crnrstn_svc_http(){

        $tmp_is_valid = false;

        $tmp_variables_order = $this->ini_get('variables_order');
        $tmp_vo_ARRAY = str_split($tmp_variables_order);

        foreach($tmp_vo_ARRAY as $key => $value) {

            switch ($value) {
                case 'G':

                    if (isset(self::$formIntegrationIsset_ARRAY['GET'])) {

                        $tmp_is_valid = true;

                        if(!self::$formIntegrationIsset_ARRAY['GET']){

                            return self::$formIntegrationIsset_ARRAY['GET'];

                        }

                    }

                break;
                case 'P':

                    if (isset(self::$formIntegrationIsset_ARRAY['POST'])) {

                        $tmp_is_valid = true;

                        if(!self::$formIntegrationIsset_ARRAY['POST']){

                            return self::$formIntegrationIsset_ARRAY['POST'];

                        }

                    }

                break;

            }

            return $tmp_is_valid;

        }

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function returnErr_dataValidationCheck($transport_protocol = 'POST'){

        $tmp_array = array();

        $tmp_is_valid = false;

        $tmp_variables_order = $this->ini_get('variables_order');
        $tmp_vo_ARRAY = str_split($tmp_variables_order);

        foreach($tmp_vo_ARRAY as $key => $value) {

            switch ($value) {
                case 'G':

                    if (isset(self::$formIntegrationErr_ARRAY['GET'])) {

                        $tmp_array[] = self::$formIntegrationErr_ARRAY['GET'];
                        $tmp_array[] = self::$formIntegrationIcon_ARRAY['GET'];

                    }

                break;
                case 'P':

                    if (isset(self::$formIntegrationErr_ARRAY['POST'])) {

                        $tmp_array[] = self::$formIntegrationErr_ARRAY['POST'];
                        $tmp_array[] = self::$formIntegrationIcon_ARRAY['POST'];

                    }

                break;

            }

            return $tmp_array;

        }

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function addDatabaseQuery($oQueryProfileMgr, $result_set_key, $query_override = NULL){

        try {

            $oCRNRSTN_MySQLi = $oQueryProfileMgr->return_MySQLi($result_set_key);
            $result_handle = $oQueryProfileMgr->return_resultHandle($result_set_key);
            $batch_key = $oQueryProfileMgr->return_batchKey($result_set_key);

            if (is_object($oCRNRSTN_MySQLi)) {

                $connection_serial = $oCRNRSTN_MySQLi->returnConnSerial();

                if (isset($query_override)) {

                    //
                    // LOAD QUERY - OVERRIDE
                    // DATABASE QUERY/CONNECTION CRNRSTN CONTACT POINT
                    return self::$oDB_CRNRSTN->load_databaseQuery($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $query_override);

                } else {

                    //
                    // PROCESS QUERY VIA CENTRALIZED DATABASE RESOURCES
                    $query = self::$oSqlSilo->returnDatabaseQuery($this, $oCRNRSTN_MySQLi, $result_set_key);

                    if (strlen($query) > 0) {

                        //
                        // DATABASE QUERY/CONNECTION CRNRSTN CONTACT POINT
                        return self::$oDB_CRNRSTN->load_databaseQuery($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $query);

                    } else {

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('No query was able to be loaded from the provided handle and keys [' . $result_handle . '|' . $batch_key . '|' . $result_set_key . '].');

                    }

                }

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key . '].');

            }

        } catch (Exception $e) {

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function processQuery($application_acceleration = true, $oCRNRSTN_MySQLi = NULL, $batch_key = NULL, $result_set_key = NULL, $result_handle = NULL, $query_override = NULL){

        if (is_bool($application_acceleration)) {

            $tmp_request_serial = $this->generate_new_key(50);

            //
            // TRACK ON THIS AND KEY OFF OF IT TO ACTIVATE APPLICATION ACCELERATION
            // THROUGH REUSE OF RESULT SET ARRAY DATA vs FORCE REFRESH OF THE SAME.
            self::$oDB_CRNRSTN->receive_processQueryParam('sql_accelerate_FLAG', $application_acceleration, $tmp_request_serial);

            if (isset($oCRNRSTN_MySQLi)) {

                self::$oDB_CRNRSTN->receive_processQueryParam('oCRNRSTN_MySQLi', $oCRNRSTN_MySQLi, $tmp_request_serial);

            }

            if (isset($batch_key)) {

                self::$oDB_CRNRSTN->receive_processQueryParam('batch_key', $batch_key, $tmp_request_serial);

            }

            if (isset($result_set_key)) {

                self::$oDB_CRNRSTN->receive_processQueryParam('result_set_key', $result_set_key, $tmp_request_serial);

            }

            if (isset($result_handle)) {

                self::$oDB_CRNRSTN->receive_processQueryParam('result_handle', $result_handle, $tmp_request_serial);

            }

            if (isset($query_override)) {

                self::$oDB_CRNRSTN->receive_processQueryParam('query_override', $query_override, $tmp_request_serial);

            }

            //
            // PROCESS
            return self::$oDB_CRNRSTN->processQuery($tmp_request_serial);

        } else {

            //
            // HOOOSTON...VE HAF PROBLEM!
            $this->error_log('CRNRSTN :: ERROR :: No Database query processed. Please indicate (BOOLEAN) desire for application acceleration...as CRNRSTN :: prepares to touch database with SQL.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_DATABASE');

        }

        return false;

    }

    private function consumeFormIntegrationPacket($str, $transport_protocol){

        try {

            //
            // CHECK INTEGRITY OF DATA
            if (strlen($str) < 1) {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Received ' . $transport_protocol . ' data is NULL or decryption of data has failed.');

            }

            //
            // PARSE OUT ALL INPUT PARAMETERS.
            /*
            value="TIMESTAMP[CRNRSTN::2.0.0]FORM_HANDLE[CRNRSTN::2.0.0]TRANSPORT_PROTOCOL[CRNRSTN::2.0.0]
            0:input_name:input_encrypt:input_validation[CRNRSTN::2.0.0]
            1:input_name:input_encrypt:input_validation[CRNRSTN::2.0.0]
            2:input_name:input_encrypt:input_validation[CRNRSTN::2.0.0]
            3:input_name:input_encrypt:input_validation[CRNRSTN::2.0.0]
            n:input_name:input_encrypt:input_validation[CRNRSTN::2.0.0]"

            self::$http_param_handle["FORM_TIMESTAMP"]
            self::$http_param_handle["TRANSACTION_TIMESTAMP"]
            self::$http_param_handle["FORM_HANDLE"]
            self::$http_param_handle["TRANSPORT_PROTOCOL"]
            */

            $tmp_packet_explode_ARRAY = explode("[CRNRSTN::2.0.0]", $str);

            $input_element_cnt = sizeof($tmp_packet_explode_ARRAY);

            //
            // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED.
            for ($i = 0; $i < $input_element_cnt; $i++) {
                //error_log(__LINE__ . ' user consumeFormIntegrationPacket ['.$i.']['.$tmp_packet_explode_ARRAY[$i].']');
                switch ($i) {
                    case 0:
                        //
                        // FORM_TIMESTAMP
                        //error_log(__LINE__ . ' user FORM_TIMESTAMP ['.$i.']['.$tmp_packet_explode_ARRAY[$i].']');

                        self::$formIntegrationPacketReceived_ARRAY[$transport_protocol]['FORM_TIMESTAMP'] = $tmp_packet_explode_ARRAY[$i];
                        self::$formIntegrationPacketReceived_ARRAY[$transport_protocol]['SUBMIT_TIMESTAMP'] = $this->oLogger->returnMicroTime();

                    break;
                    case 1:
                        //
                        // FORM_HANDLE
                        //error_log(__LINE__ . ' user FORM_HANDLE ['.$i.']['.$tmp_packet_explode_ARRAY[$i].']');
                        self::$formIntegrationPacketReceived_ARRAY[$transport_protocol]['FORM_HANDLE'] = $tmp_packet_explode_ARRAY[$i];

                    break;
                    case 2:
                        //
                        // TRANSPORT_PROTOCOL
                        //error_log(__LINE__ . ' user TRANSPORT_PROTOCOL ['.$i.']['.$tmp_packet_explode_ARRAY[$i].']');
                        //error_log(__LINE__ . ' user ACTIVE_TRANSPORT_PROTOCOL [---]['.$transport_protocol.']');
                        self::$formIntegrationPacketReceived_ARRAY[$transport_protocol]['TRANSPORT_PROTOCOL'] = $tmp_packet_explode_ARRAY[$i];
                        self::$formIntegrationPacketReceived_ARRAY[$transport_protocol]['ACTIVE_TRANSPORT_PROTOCOL'] = $transport_protocol;

                    break;
                    default:

                        //error_log(__LINE__. ' user default data to [form] process...[' . print_r($tmp_packet_explode_ARRAY[$i], true) . ']');

                        //
                        // EXTRACT INPUT DATA VIA EXPLODE
                        $tmp_input_meta_explode_ARRAY = explode(":", $tmp_packet_explode_ARRAY[$i]);
                        $tmp_input_meta_cnt = sizeof($tmp_input_meta_explode_ARRAY);

                        for ($ii = 0; $ii < $tmp_input_meta_cnt; $ii++) {

                            if ($ii == 0) {

                                $tmp_queue_position = $tmp_input_meta_explode_ARRAY[$ii];

                            }

                            //error_log(__LINE__. ' user default META $tmp_queue_position=['.$tmp_queue_position.'] to form process...[' . print_r($tmp_packet_explode_ARRAY[$ii], true) . ']');

                            switch ($ii) {
                                case 0:
                                    //
                                    // INPUT_POSITION
                                    //error_log(__LINE__ . ' user INPUT_POSITION ['.$ii.']['.$tmp_input_meta_explode_ARRAY[$ii].']');
                                    self::$formIntegrationPacketReceived_ARRAY[$transport_protocol]['INPUT_META'][$tmp_queue_position]['INPUT_POSITION'] = $tmp_input_meta_explode_ARRAY[$ii];

                                break;
                                case 1:
                                    //
                                    // INPUT_NAME
                                    //error_log(__LINE__ . ' user INPUT_NAME ['.$ii.']['.$tmp_input_meta_explode_ARRAY[$ii].']');
                                    //error_log('4656 user - processing ['.$transport_protocol.']input param :: '.$tmp_input_meta_explode_ARRAY[$ii]);
                                    self::$formIntegrationPacketReceived_ARRAY[$transport_protocol]['INPUT_META'][$tmp_queue_position]['INPUT_NAME'] = $tmp_input_meta_explode_ARRAY[$ii];

                                break;
                                case 2:
                                    //
                                    // INPUT_ENCRYPT
                                    //error_log(__LINE__ . ' user INPUT_ENCRYPT ['.$ii.']['.$tmp_input_meta_explode_ARRAY[$ii].']');
                                    self::$formIntegrationPacketReceived_ARRAY[$transport_protocol]['INPUT_META'][$tmp_queue_position]['INPUT_ENCRYPT'] = $tmp_input_meta_explode_ARRAY[$ii];

                                break;
                                case 3:
                                    //
                                    // INPUT_VALIDATION
                                    //error_log(__LINE__ . ' user INPUT_VALIDATION ['.$ii.']['.$tmp_input_meta_explode_ARRAY[$ii].']');
                                    self::$formIntegrationPacketReceived_ARRAY[$transport_protocol]['INPUT_META'][$tmp_queue_position]['INPUT_VALIDATION'] = $tmp_input_meta_explode_ARRAY[$ii];

                                break;

                            }

                        }

                    break;

                }

            }

            //
            // META EXTRACTION FROM CRNRSTN INTEGRATION PACKET COMPLETE.
            // EXTRACT INPUT PARAMS FROM HTTP POST/GET NOW.
            // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED.
            $tmp_input_cnt = sizeof(self::$formIntegrationPacketReceived_ARRAY[$transport_protocol]['INPUT_META']);

            if (!isset(self::$formIntegrationIsset_ARRAY[$transport_protocol]) && ($tmp_input_cnt > 0)) {

                self::$formIntegrationIsset_ARRAY[$transport_protocol] = true;

            }

            if(!isset($this->oCRNRSTN_TRM)){

                $this->oCRNRSTN_TRM = new crnrstn_ui_transaction_response_manager($this);

            }

            for ($i = 0; $i < $tmp_input_cnt; $i++) {
                //error_log(__LINE__ . ' user INPUT_VALIDATION [' . $i . '][' . print_r(self::$formIntegrationPacketReceived_ARRAY[$transport_protocol]['INPUT_META'][$i], true) . '][' . $transport_protocol . ']');
                $this->buildHTTP_ParamHandle(self::$formIntegrationPacketReceived_ARRAY[$transport_protocol]['INPUT_META'][$i], $transport_protocol);

            }

        } catch (Exception $e) {

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;
        }

        return NULL;

    }

    private function buildHTTP_ParamHandle($packet_received_array, $transport_protocol){

        try {

            //error_log(__LINE__ . ' user $packet_received_array=[' . print_r($packet_received_array, true) . ']');

            switch ($transport_protocol) {
                case 'POST':

                    //
                    // VALIDATE DATA PER CRNRSTN :: FORM INTEGRATION REQUIREMENTS.
                    if (isset($packet_received_array['INPUT_VALIDATION'])) {

                        //error_log(__LINE__ . ' user $packet_received_array=[' . print_r($packet_received_array['INPUT_VALIDATION'], true) . ']');
                        switch ($packet_received_array['INPUT_VALIDATION']) {
                            case 'is_FILE':
                                //
                                // TODO :: SERVER-SIDE INPUT VALIDATION
                            case 'is_DOCUMENT':
                            case 'is_COMPRESSED':
                            case 'is_ZIP':
                            case 'is_TAR':
                            case 'is_AUDIO':
                            case 'is_MP3':
                            case 'is_WAVE':
                            case 'is_MIDI':
                            case 'is_VIDEO':
                            case 'is_MP4':
                            case 'is_MOV':
                            case 'is_FLV':
                            case 'is_MKV':
                            case 'is_IMAGE':
                            case 'is_JPEG':
                            case 'is_GIF':
                            case 'is_PNG':
                            case 'is_TIFF':
                            case 'is_PDF':

                            break;
                            case 'is_integer':
                                //
                                // TODO :: is_integer SERVER-SIDE INPUT VALIDATION
                            break;
                            case 'is_string':
                                //
                                // TODO :: is_string SERVER-SIDE INPUT VALIDATION
                            break;
                            case 'is_email':
                                //
                                // TODO :: is_email SERVER-SIDE INPUT VALIDATION
                            break;
                            case 'is_required':

                                //error_log(__LINE__ . ' user INPUT_ENCRYPT $packet_received_array=[' . print_r($packet_received_array['INPUT_ENCRYPT'], true) . ']');

                                if ($packet_received_array['INPUT_ENCRYPT'] == 'true') {
                                    //error_log(__LINE__ . ' user run DECRYPT ON '.$packet_received_array['INPUT_NAME'].' data=[' . $this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME']) . ']');

                                    //
                                    // THIS WANTS TRUE ON URI PASSTHROUGH. CAN DO CHECK FOR '%' FOR URLDECODE DETECT, IF WE FIND OURSELVES BACK HERE AGAIN.
                                    self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = $this->oCRNRSTN_ENV->param_tunnel_decrypt($this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME']), true);

                                    //error_log(__LINE__ . ' user DECRYPT OF INPUT_NAME=[' . print_r(self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']], true) . ']');

                                } else {

                                    //error_log(__LINE__ . ' user NO INPUT_ENCRYPT $packet_received_array['.$this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME']).']]');

                                    self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = $this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME']);

                                }

                                //error_log('4445 - '.$packet_received_array['INPUT_NAME'].'='.self::$http_param_handle_ARRAY[$packet_received_array['INPUT_NAME']]);

                                if (self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] == '') {

                                    //error_log(__LINE__ . ' user HOOOSTON...VE HAF PROBLEM! $packet_received_array=[A ' . $transport_protocol . ' parameter [' . $packet_received_array['INPUT_NAME'] . '] has failed server-side validation [' . $packet_received_array['INPUT_VALIDATION'] . ']');

                                    self::$formIntegrationIsset_ARRAY[$transport_protocol] = false;
                                    self::$formIntegrationErr_ARRAY[$transport_protocol][] = 'A ' . $transport_protocol . ' parameter [' . $packet_received_array['INPUT_NAME'] . '] has failed server-side validation [' . $packet_received_array['INPUT_VALIDATION'] . '].';

                                    //
                                    // SUCCESS_CHECK, ERR_X, NOTICE_TRI_ALERT
                                    self::$formIntegrationIcon_ARRAY[$transport_protocol][] = 'ERR_X';

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    //throw new Exception('A ' . $transport_protocol . ' parameter [' . $packet_received_array['INPUT_NAME'] . '] has failed server-side validation [' . $packet_received_array['INPUT_VALIDATION'] . '].');
                                    $this->error_log('A ' . $transport_protocol . ' parameter [' . $packet_received_array['INPUT_NAME'] . '] has failed server-side validation [' . $packet_received_array['INPUT_VALIDATION'] . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);

                                }

                            break;
                            case 'false':
                                //
                                // NOTHING TO DO. JUST KIDDING...
                                // error_log('4790 user - I think that I have nothing to do.');
                                if ($packet_received_array['INPUT_ENCRYPT'] == 'true') {

                                    self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = $this->oCRNRSTN_ENV->param_tunnel_decrypt($this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME']));

                                } else {

                                    self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = $this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME']);

                                }

                            break;
                            default:

                                //
                                // HOOOSTON...VE HAF PROBLEM!
                                //throw new Exception('The requested server-side input validation [' . $packet_received_array['INPUT_VALIDATION'] . '] is not available.');
                                $this->error_log('The requested server-side input validation [' . $packet_received_array['INPUT_VALIDATION'] . '] is not available.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);

                            break;

                        }

                    } else {

                        //
                        // NO SERVER-SIDE VALIDATION. PROCESS.
                        if ($packet_received_array['INPUT_ENCRYPT'] == 'true') {

                            //error_log(__LINE__ . ' user receiving ENCRYPTED POST DATA');
                            //error_log(__LINE__ . ' user receive POST DATA :: '.$this->oCRNRSTN_ENV->param_tunnel_decrypt($this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME'])));
                            self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = $this->oCRNRSTN_ENV->param_tunnel_decrypt($this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME']));

                        } else {

                            //error_log(__LINE__ . ' user receiving CLEAR TEXT POST DATA');
                            //error_log(__LINE__ . ' user receive POST DATA :: ' . $this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME']));

                            self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = $this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME']);

                        }

                        // error_log('4483 - '.$packet_received_array['INPUT_NAME'].'='.self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']]);

                    }

                break;
                default:
                    //
                    // $_GET PROTOCOL RECEIVED

                    //
                    // VALIDATE DATA PER CRNRSTN :: FORM INTEGRATION REQUIREMENTS
                    if ($packet_received_array['INPUT_VALIDATION'] != '') {

                        switch ($packet_received_array['INPUT_VALIDATION']) {
                            case 'is_FILE':
                            case 'is_DOCUMENT':
                            case 'is_COMPRESSED':
                            case 'is_ZIP':
                            case 'is_TAR':

                            case 'is_AUDIO':
                            case 'is_MP3':
                            case 'is_WAVE':
                            case 'is_MIDI':

                            case 'is_VIDEO':
                            case 'is_MP4':
                            case 'is_MOV':
                            case 'is_FLV':
                            case 'is_MKV':

                            case 'is_IMAGE':
                            case 'is_JPEG':
                            case 'is_GIF':
                            case 'is_PNG':
                            case 'is_TIFF':
                            case 'is_PDF':

                            break;
                            case 'is_integer':
                                //
                                // TODO :: is_integer SERVER-SIDE INPUT VALIDATION

                            break;
                            case 'is_string':
                                //
                                // TODO :: is_string SERVER-SIDE INPUT VALIDATION

                            break;
                            case 'is_email':
                                //
                                // TODO :: is_email SERVER-SIDE INPUT VALIDATION

                            break;
                            case 'is_required':

                                if ($packet_received_array['INPUT_ENCRYPT'] == 'true') {

                                    self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = $this->oCRNRSTN_ENV->param_tunnel_decrypt($this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, $packet_received_array['INPUT_NAME'], true));

                                } else {

                                    self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = $this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, $packet_received_array['INPUT_NAME']);

                                }

                                if (self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] == '') {

                                    self::$formIntegrationIsset_ARRAY[$transport_protocol] = false;
                                    self::$formIntegrationErr_ARRAY[$transport_protocol][] = 'A ' . $transport_protocol . ' parameter [' . $packet_received_array['INPUT_NAME'] . '] has failed server-side validation [' . $packet_received_array['INPUT_VALIDATION'] . '].';

                                    //
                                    // SUCCESS_CHECK, ERR_X, NOTICE_TRI_ALERT
                                    self::$formIntegrationIcon_ARRAY[$transport_protocol][] = 'ERR_X';

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    //throw new Exception('A ' . $transport_protocol . ' parameter [' . $packet_received_array['INPUT_NAME'] . '] has failed server-side validation [' . $packet_received_array['INPUT_VALIDATION'] . '].');
                                    $this->error_log('A ' . $transport_protocol . ' parameter [' . $packet_received_array['INPUT_NAME'] . '] has failed server-side validation [' . $packet_received_array['INPUT_VALIDATION'] . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);

                                }

                                // error_log('4514 - '.$packet_received_array['INPUT_NAME'].'='.self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']]);

                            break;
                            case 'false':
                                //
                                // NOTHING TO DO. JUST KIDDING...
                                // error_log('4790 user - I think that I have nothing to do.');
                                if ($packet_received_array['INPUT_ENCRYPT'] == 'true') {

                                    self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = $this->oCRNRSTN_ENV->param_tunnel_decrypt($this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, $packet_received_array['INPUT_NAME']), true);

                                } else {

                                    self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = $this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, $packet_received_array['INPUT_NAME']);

                                }

                            break;
                            default:

                                //
                                // HOOOSTON...VE HAF PROBLEM!
                                //throw new Exception('The requested server-side input validation [' . $packet_received_array['INPUT_VALIDATION'] . '] is not available.');
                                $this->error_log('The requested server-side input validation [' . $packet_received_array['INPUT_VALIDATION'] . '] is not available.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);

                            break;

                        }

                    } else {

                        //
                        // NO SERVER-SIDE VALIDATION. PROCESS.
                        if ($packet_received_array['INPUT_ENCRYPT'] == 'true') {

                            self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = $this->oCRNRSTN_ENV->param_tunnel_decrypt($this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, $packet_received_array['INPUT_NAME']));

                        } else {

                            self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = $this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, $packet_received_array['INPUT_NAME']);

                        }

                        //error_log('4913 user - '.$packet_received_array['INPUT_NAME'].'='.self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']]);

                    }

                    break;

            }

        } catch (Exception $e) {

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return NULL;

    }

    private function concatIntegrationPacketDatum($str, $delim = NULL){

        if (!isset($delim)) {

            return $str . '[CRNRSTN::2.0.0]';

        } else {

            return $str . $delim;

        }
    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function addCookie($name, $value = NULL, $expire = NULL, $path = NULL, $domain = NULL, $secure = NULL, $httponly = NULL){

        return $this->oCRNRSTN_ENV->oCOOKIE_MGR->addCookie($name, $value, $expire, $path, $domain, $secure, $httponly);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function addRawCookie($name, $value = NULL, $expire = NULL, $path = NULL, $domain = NULL, $secure = NULL, $httponly = NULL){

        return $this->oCRNRSTN_ENV->oCOOKIE_MGR->addRawCookie($name, $value, $expire, $path, $domain, $secure, $httponly);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function getCookie($name){

        return $this->oCRNRSTN_ENV->oCOOKIE_MGR->getCookie($name);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function deleteCookie($name, $path = NULL){

        return $this->oCRNRSTN_ENV->oCOOKIE_MGR->deleteCookie($name, $path);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function deleteAllCookies($path = NULL){

        return $this->oCRNRSTN_ENV->oCOOKIE_MGR->deleteAllCookies($path);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function returnHeaders($returnType = NULL){

        return $this->oCRNRSTN_ENV->oHTTP_MGR->getHeaders($returnType);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function isset_HTTP_Param($param, $transport_protocol = 'POST'){

        $http_protocol = strtoupper($transport_protocol);
        $http_protocol = $this->string_sanitize($http_protocol, 'http_protocol_simple');

        try {

            switch ($http_protocol) {
                case 'POST':

                    if ($this->oCRNRSTN_ENV->oHTTP_MGR->issetParam($_POST, $param)) {
                        if (strlen($_POST[$param]) > 0) {

                            return true;

                        } else {

                            return false;

                        }

                    } else {

                        return false;

                    }

                default:

                    //
                    // $_GET
                    if ($this->oCRNRSTN_ENV->oHTTP_MGR->issetParam($_GET, $param)) {
                        if (strlen($_GET[$param]) > 0) {

                            return true;

                        } else {

                            return false;

                        }

                    } else {

                        return false;

                    }
            }

        } catch (Exception $e) {

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }
    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function extractData_HTTP($param, $transport_protocol = 'GET', $tunnel_encrypted = false){

        $http_protocol = strtoupper($transport_protocol);
        $http_protocol = $this->string_sanitize($http_protocol, 'http_protocol_simple');

        try {

            switch ($http_protocol) {
                case 'POST':
                    if ($this->oCRNRSTN_ENV->oHTTP_MGR->issetParam($_POST, $param)) {

                        return $this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, $param, $tunnel_encrypted);

                    } else {

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('The desired HTTP _' . $http_protocol . ' parameter, ' . $param . ', is not available.');

                    }

                break;
                default:

                    //
                    // $_GET
                    if ($this->oCRNRSTN_ENV->oHTTP_MGR->issetParam($_GET, $param)) {

                        return $this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, $param, $tunnel_encrypted);

                    } else {

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        //throw new Exception('The desired HTTP _'.$http_protocol.' parameter, '.$param.', is not available.');
                        //$this->error_log('The desired HTTP _' . $http_protocol . ' parameter, ' . $param . ', is not available.', __LINE__, __METHOD__, __FILE__,CRNRSTN_SETTINGS_CRNRSTN);

                        return false;

                    }

                break;
            }

        } catch (Exception $e) {

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function isset_SERVER_param($param){

        return $this->oCRNRSTN_ENV->isset_ServerArrayVar($param);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function wall_time(){

        return $this->oCRNRSTN_ENV->wall_time();

    }

    public function get_micro_time(){

        return $this->oLogger->returnMicroTime();

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function return_queryDateTimeStamp(){

        //$ts = date("Y-m-d H:i:s", time());

        return date("Y-m-d H:i:s", time());

    }

    public function return_prettyElapsedTime($secs, $mode='ELAPSED_VERBOSE'){

        switch($mode){
            case 'ELAPSED':

                $this->elapsed_from_current($secs);

                break;
            case 'ELAPSED_VERBOSE':

                $tmp_output = $this->elapsed_verbose_from_current($secs);

                break;

        }

        return $tmp_output;

    }

    public function return_pretty_delta_time($delta_secs, $microsecs=0, $mode='ELAPSED_VERBOSE'){

        $microsecs = '0.'.$microsecs;
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
        //error_log("(146) Y->".self::$lang_content_ARRAY['Y']);      // shows 1...not y...

        foreach($bit as $k => $v){
            if($v > 0){
                //
                // PUT IN CURFEW FOR TIME GRANULARITY
                if($k==self::$lang_content_ARRAY['Y'] || $k==self::$lang_content_ARRAY['W'] || ($k==self::$lang_content_ARRAY['D'] && $v>1)){

                    //
                    // RETURN DEFAULT DATE FORMAT
                    if(isset($format_override)){

                        return date($format_override, $secs);

                    }else{

                        return date("m.d.Y @ H:i:s", $secs);
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

    private function elapsed($delta_secs, $microsecs=0){

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
        //error_log("(146) Y->".self::$lang_content_ARRAY['Y']);      // shows 1...not y...

        foreach($bit as $k => $v){
            if($v > 0){
                //
                // PUT IN CURFEW FOR TIME GRANULARITY
                if($k==self::$lang_content_ARRAY['Y'] || $k==self::$lang_content_ARRAY['W'] || ($k==self::$lang_content_ARRAY['D'] && $v>1)){

                    //
                    // RETURN DEFAULT DATE FORMAT
                    if(isset($format_override)){

                        return date($format_override, $delta_secs);

                    }else{

                        return date("m.d.Y @ H:i:s", $delta_secs);
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
    private function elapsed_verbose($delta_secs, $microsecs=0){

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
            '0'     => ' '.self::$lang_content_ARRAY['YEAR'],
            '1'     => ' '.self::$lang_content_ARRAY['WEEK'],
            '2'     => ' '.self::$lang_content_ARRAY['DAY'],
            '3'     => ' '.self::$lang_content_ARRAY['HOUR'],
            '4'     => ' '.self::$lang_content_ARRAY['MINUTE'],
            '5'     => ' '.self::$lang_content_ARRAY['SECOND']
        );

        $bit_plural = array(
            '0'     => ' '.self::$lang_content_ARRAY['YEARS'],
            '1'     => ' '.self::$lang_content_ARRAY['WEEKS'],
            '2'     => ' '.self::$lang_content_ARRAY['DAYS'],
            '3'     => ' '.self::$lang_content_ARRAY['HOURS'],
            '4'     => ' '.self::$lang_content_ARRAY['MINUTES'],
            '5'     => ' '.self::$lang_content_ARRAY['SECONDS']
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

//        foreach($bit_singular as $k => $v){
//            if($v > 1)$ret[] = $v . $k . 's';           // APPENDING AN S FOR PLURAL IS PRIMARILY ENGLISH. WE CAN'T RELY ON THIS APPEND OUR PURPOSES.
//            if($v == 1)$ret[] = $v . $k;
//        }

        if(isset($ret)){

            array_splice($ret, count($ret)-1, 0, self::$lang_content_ARRAY['AND']);

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
        $delta_secs = $ts-$secs;

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
            '0'     => ' '.self::$lang_content_ARRAY['YEAR'],
            '1'     => ' '.self::$lang_content_ARRAY['WEEK'],
            '2'     => ' '.self::$lang_content_ARRAY['DAY'],
            '3'     => ' '.self::$lang_content_ARRAY['HOUR'],
            '4'     => ' '.self::$lang_content_ARRAY['MINUTE'],
            '5'     => ' '.self::$lang_content_ARRAY['SECOND']
        );

        $bit_plural = array(
            '0'     => ' '.self::$lang_content_ARRAY['YEARS'],
            '1'     => ' '.self::$lang_content_ARRAY['WEEKS'],
            '2'     => ' '.self::$lang_content_ARRAY['DAYS'],
            '3'     => ' '.self::$lang_content_ARRAY['HOURS'],
            '4'     => ' '.self::$lang_content_ARRAY['MINUTES'],
            '5'     => ' '.self::$lang_content_ARRAY['SECONDS']
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

//        foreach($bit_singular as $k => $v){
//            if($v > 1)$ret[] = $v . $k . 's';           // APPENDING AN S FOR PLURAL IS PRIMARILY ENGLISH. WE CAN'T RELY ON THIS APPEND OUR PURPOSES.
//            if($v == 1)$ret[] = $v . $k;
//        }

        array_splice($ret, count($ret)-1, 0, self::$lang_content_ARRAY['AND']);
        $ret[] = self::$lang_content_ARRAY['AGO'];

        return join(' ', $ret);

    }

    public function isDateOlderThan($duration_seconds, $start_time_seconds=NULL, $qualification_pattern=NULL){

        if(!isset($qualification_pattern)){

            //
            // PROVIDED DATE ($seconds) OLDER THAN NOW?
            //if(strtotime("now") > (double) $seconds){
            if(isset($start_time_seconds)){



            }else{

                if(strtotime("now") > (double) $duration_seconds){

                    return true;

                }else{

                    return false;

                }

            }


        }else{

            //
            // DO WE HAVE PROPER DATE...OR A TIME PERIOD REPRESENTATION
            $pos_day = stripos($qualification_pattern, 'day');
            $pos_week = stripos($qualification_pattern, 'week');
            $pos_month = stripos($qualification_pattern, 'month');
            $pos_year = stripos($qualification_pattern, 'year');
            $pos_sec = stripos($qualification_pattern, 'sec');
            $pos_min = stripos($qualification_pattern, 'min');
            $pos_hour = stripos($qualification_pattern, 'hour');

            if($pos_year === false && $pos_month === false && $pos_week === false && $pos_day === false && $pos_hour === false && $pos_min === false && $pos_sec === false){

                //
                // PROVIDED DATE ($seconds) OLDER THAN DATE PATTERN?
                if(strtotime($qualification_pattern) > $duration_seconds){

                    return true;

                }else{

                    return false;

                }

            }else{

                //
                // IF TIME PERIOD...IS THERE ANY INDICATION OF FORE(+) OR AFT(-)?
                $pos_yesterday = stripos($qualification_pattern, 'yesterday');
                $pos_tomorrow = stripos($qualification_pattern, 'tomorrow');
                $pos_next = stripos($qualification_pattern, 'next');
                $pos_last = stripos($qualification_pattern, 'last');
                $pos_plus = stripos($qualification_pattern, '+');
                $pos_minus = stripos($qualification_pattern, '-');

                if ($pos_yesterday === false && $pos_tomorrow === false && $pos_next === false && $pos_last === false && $pos_plus === false && $pos_minus === false) {

                    //
                    // PREFIX A MINUS TO PATTERN, AND THEN CHECK IF PROVIDED DATE ($seconds) OLDER
                    // THAN MODIFIED DATE PATTERN?
                    $qualification_pattern = '- '.$qualification_pattern;
                    if(strtotime($qualification_pattern) > $duration_seconds){

                        return true;

                    }else{

                        return false;

                    }

                }else{

                    //
                    // PROVIDED DATE ($seconds) OLDER THAN DATE PATTERN?
                    if(strtotime($qualification_pattern) > $duration_seconds){

                        return true;

                    }else{

                        return false;

                    }
                }
            }
        }
    }

    public function isDateNewerThan($duration_seconds, $qualification_pattern=NULL){

        if(!isset($qualification_pattern)){

            //
            // PROVIDED DATE ($seconds) NEWER THAN NOW?
            if(strtotime('now') < $duration_seconds){

                return true;

            }else{

                return false;

            }

        }else{

            //
            // DO WE HAVE PROPER DATE...OR A TIME PERIOD REPRESENTATION
            $pos_day = stripos($qualification_pattern, 'day');
            $pos_week = stripos($qualification_pattern, 'week');
            $pos_month = stripos($qualification_pattern, 'month');
            $pos_year = stripos($qualification_pattern, 'year');
            $pos_sec = stripos($qualification_pattern, 'sec');
            $pos_min = stripos($qualification_pattern, 'min');
            $pos_hour = stripos($qualification_pattern, 'hour');

            if($pos_year === false && $pos_month === false && $pos_week === false && $pos_day === false && $pos_hour === false && $pos_min === false && $pos_sec === false){

                //
                // PROVIDED DATE ($seconds) NEWER THAN DATE PATTERN?
                if(strtotime($qualification_pattern) < $duration_seconds){

                    return true;

                }else{

                    return false;

                }

            }else{

                //
                // IF TIME PERIOD...IS THERE ANY INDICATION OF FORE(+) OR AFT(-)?
                $pos_yesterday = stripos($qualification_pattern, 'yesterday');
                $pos_tomorrow = stripos($qualification_pattern, 'tomorrow');
                $pos_next = stripos($qualification_pattern, 'next');
                $pos_last = stripos($qualification_pattern, 'last');
                $pos_plus = stripos($qualification_pattern, '+');
                $pos_minus = stripos($qualification_pattern, '-');

                if ($pos_yesterday === false && $pos_tomorrow === false && $pos_next === false && $pos_last === false && $pos_plus === false && $pos_minus === false) {

                    //
                    // PREFIX A MINUS TO PATTERN, AND THEN CHECK IF PROVIDED DATE ($seconds) NEWER
                    // THAN MODIFIED DATE PATTERN?
                    $qualification_pattern = '- '.$qualification_pattern;
                    if(strtotime($qualification_pattern) < $duration_seconds){

                        return true;

                    }else{

                        return false;

                    }

                }else{

                    //
                    // PROVIDED DATE ($seconds) NEWER THAN DATE PATTERN?
                    if(strtotime($qualification_pattern) < $duration_seconds){

                        return true;

                    }else{

                        return false;

                    }
                }
            }
        }
    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function elapsed_delta_time_for($watchKey, $decimal = 8){

        return $this->oCRNRSTN_ENV->monitoringDeltaTimeFor($watchKey, $decimal);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function get_SERVER_param($param = NULL){

        try {

            if (!isset($param)) {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('A value has not been provided to indicate which _SERVER parameter should be retrieved.');

            } else {

                return $this->oCRNRSTN_ENV->getServerArrayVar($param, $this);

            }

        } catch (Exception $e) {

            # ['COMM_EXCEPTION', 'COMM_NOTICE']
            /*
            [DEFAULT, GOOGLE_ANALYTICS,
            SCREEN|SCREEN_HTML, SCREEN_TEXT,
            SCREEN_HTML_HIDDEN, SOAP_ENDPOINT,
            EMAIL, SPLUNK, MISC_THIRD_PARTY_ENDPOINT]
            */

            # {CUSTOM ON LOCATION CALL STRING}
            # {ERROR_OBJECT..e.g. $e}
            # {oCRNRSTN_USR}
            # INCIDENT LOCATION META (LINE, METHOD, FILE, NAMESPACE)
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }
    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function get_session_param($name){

        return $this->oCRNRSTN_ENV->oSESSION_MGR->get_session_param($name);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function set_session_param($name, $value = ''){

        return $this->oCRNRSTN_ENV->oSESSION_MGR->set_session_param($name, $value);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function isset_session_param($name){

        try {

            if (isset($name)) {

                return $this->oCRNRSTN_ENV->oSESSION_MGR->isset_session_param($name);

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No variable name has been provided for the session parameter that is to be checked to determine if it is currently set with a value.');

            }

        } catch (Exception $e) {

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }
    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function isset_HTTPSuper($transport_protocol = 'POST'){

        $http_protocol = strtoupper($transport_protocol);
        $http_protocol = $this->string_sanitize($http_protocol, 'http_protocol_simple');

        return $this->oCRNRSTN_ENV->issetHTTP($http_protocol);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function returnRecordCount($oQueryProfileMgr, $result_set_key){

        try {

            $oCRNRSTN_MySQLi = $oQueryProfileMgr->return_MySQLi($result_set_key);

            if (is_object($oCRNRSTN_MySQLi)) {

                $result_handle = $oQueryProfileMgr->return_resultHandle($result_set_key);
                $batch_key = $oQueryProfileMgr->return_batchKey($result_set_key);

                if (!is_object($oCRNRSTN_MySQLi) || !isset($result_handle) || !isset($batch_key) || !isset($result_set_key)) {

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Missing input parameter(s) for this method.');

                } else {

                    return self::$oDB_CRNRSTN->returnRecordCount($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key);

                }

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key . '].');

            }

        } catch (Exception $e) {

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function loadPreviousRecordLookup($oQueryProfileMgr, $result_set_key, $lookupSerial){

        try {

            $oCRNRSTN_MySQLi = $oQueryProfileMgr->return_MySQLi($result_set_key);

            if (is_object($oCRNRSTN_MySQLi)) {

                $result_handle = $oQueryProfileMgr->return_resultHandle($result_set_key);
                $batch_key = $oQueryProfileMgr->return_batchKey($result_set_key);

                self::$oDB_CRNRSTN->loadPreviousRecordLookup($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $lookupSerial);

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key . '].');

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function initLookupByID($oQueryProfileMgr, $result_set_key){

        try {

            $oCRNRSTN_MySQLi = $oQueryProfileMgr->return_MySQLi($result_set_key);

            if (is_object($oCRNRSTN_MySQLi)) {

                $result_handle = $oQueryProfileMgr->return_resultHandle($result_set_key);
                $batch_key = $oQueryProfileMgr->return_batchKey($result_set_key);

                self::$oDB_CRNRSTN->initLookupByID($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key);

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key . '].');

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);
            //$this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__, CRNRSTN_LOG_EMAIL, 'j5@jony5.com');

            return false;

        }


    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function addLookupFieldData($oQueryProfileMgr, $result_set_key, $field_name, $field_value){

        try {

            $oCRNRSTN_MySQLi = $oQueryProfileMgr->return_MySQLi($result_set_key);

            if (is_object($oCRNRSTN_MySQLi)) {

                $result_handle = $oQueryProfileMgr->return_resultHandle($result_set_key);
                $batch_key = $oQueryProfileMgr->return_batchKey($result_set_key);

                return self::$oDB_CRNRSTN->addLookupFieldData($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $field_name, $field_value);

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key . '].');

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function retrieveDataByID($oQueryProfileMgr, $result_set_key, $lookup_fieldname, $piped_primary_id_fields = NULL, $piped_lookup_id_data = NULL){

        try {

            $oCRNRSTN_MySQLi = $oQueryProfileMgr->return_MySQLi($result_set_key);

            if (is_object($oCRNRSTN_MySQLi)) {

                $result_handle = $oQueryProfileMgr->return_resultHandle($result_set_key);
                $batch_key = $oQueryProfileMgr->return_batchKey($result_set_key);

                self::$oDB_CRNRSTN->keyDataByID($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $piped_primary_id_fields);

                return self::$oDB_CRNRSTN->retrieveDataByID($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $lookup_fieldname, $piped_lookup_id_data);

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key . '].');

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function pingValueExistence($oQueryProfileMgr, $result_set_key, $fieldname, $value){

        try {

            $oCRNRSTN_MySQLi = $oQueryProfileMgr->return_MySQLi($result_set_key);

            if (is_object($oCRNRSTN_MySQLi)) {

                $result_handle = $oQueryProfileMgr->return_resultHandle($result_set_key);
                $batch_key = $oQueryProfileMgr->return_batchKey($result_set_key);

                return self::$oDB_CRNRSTN->pingValueExistence($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $fieldname, $value);

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key . '].');

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }
    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function pingResultSetExistence($oQueryProfileMgr, $result_set_key){

        try {

            $oCRNRSTN_MySQLi = $oQueryProfileMgr->return_MySQLi($result_set_key);

            if (is_object($oCRNRSTN_MySQLi)) {

                $result_handle = $oQueryProfileMgr->return_resultHandle($result_set_key);
                $batch_key = $oQueryProfileMgr->return_batchKey($result_set_key);

                return self::$oDB_CRNRSTN->pingProfileExistence($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key);

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key . '].');

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function resultSetMerge($oQueryProfileMgr, $result_set_key, $target_result_set_key, $merge_fields_piped, $merge_fields_distinct_val = true, $sequence_fields_piped = null, $sequence_fields_datatype_piped = null){

        try {

            $oCRNRSTN_MySQLi = $oQueryProfileMgr->return_MySQLi($result_set_key);

            if (is_object($oCRNRSTN_MySQLi)) {

                $result_handle = $oQueryProfileMgr->return_resultHandle($result_set_key);
                $batch_key = $oQueryProfileMgr->return_batchKey($result_set_key);

                if (isset($result_handle) && isset($batch_key) && isset($result_set_key) && isset($target_result_set_key) && isset($merge_fields_piped)) {

                    return self::$oDB_CRNRSTN->resultSetMerge($oQueryProfileMgr, $result_handle, $batch_key, $result_set_key, $target_result_set_key, $merge_fields_piped, $merge_fields_distinct_val, $sequence_fields_piped, $sequence_fields_datatype_piped);

                } else {

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unable to return the requested MySQL data due to missing param(s)...result handle[' . $result_handle . '], batch key[' . $batch_key . '], result_set_key[' . $result_set_key . '], target_result_set_key[' . $target_result_set_key . '] and/or the desired merge field(s)[' . $merge_fields_piped . '].');

                }

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key . '].');

            }

        } catch (Exception $e) {

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function returnDatabaseValue($oQueryProfileMgr, $result_set_key, $fieldname, $pos = 0){

        try {

            $oCRNRSTN_MySQLi = $oQueryProfileMgr->return_MySQLi($result_set_key);

            if (is_object($oCRNRSTN_MySQLi)) {

                $result_handle = $oQueryProfileMgr->return_resultHandle($result_set_key);
                $batch_key = $oQueryProfileMgr->return_batchKey($result_set_key);
                if (isset($result_handle) && isset($batch_key) && isset($result_set_key) && isset($fieldname)) {

                    return self::$oDB_CRNRSTN->returnDatabaseValue($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $fieldname, $pos);

                } else {

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unable to return the requested MySQL data due to missing param(s)...result handle[' . $result_handle . '], batch key[' . $batch_key . '], result_set_key[' . $result_set_key . '] and/or the desired database field name[' . $fieldname . '].');

                }

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key . '].');

            }

        } catch (Exception $e) {

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function create_AdHocVar($key, $var = NULL){

        self::$adHocVariable_ARRAY[$key] = $var;

        return NULL;
    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function get_AdHocVar($key){

        if (isset(self::$adHocVariable_ARRAY[$key])) {

            return self::$adHocVariable_ARRAY[$key];

        } else {

            return NULL;
        }
    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function specifyPaginationVariableName($variable_name, $pagination_serial = NULL){

        self::$oPaginator->specify_pagination_variable_name($variable_name, $pagination_serial);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function getPaginationVariableName($pagination_serial = NULL){

        return self::$oPaginator->get_pagination_variable_name($pagination_serial);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function addPaginationPassthroughInputVal($input_name, $input_value, $pagination_serial){

        self::$oPaginator->add_pagination_passthrough_input_val($input_name, $input_value, $pagination_serial);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function returnCurrentPaginationPos($pagination_serial = NULL){

        $tmp_var_name = $this->getPaginationVariableName($pagination_serial);
        $tmp_pos = $this->get_http_resource($tmp_var_name);

        if ($tmp_pos == '') {

            $tmp_pos = 1;

        }

        return $tmp_pos;

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function returnPaginationSerial(){

        return self::$oPaginator->return_pagination_serial();

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function returnPaginationStateHTML($pagination_serial = NULL){

        return self::$oPaginator->return_pagination_state_HTML($pagination_serial);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function increment_results_count_total($result_count = 1, $pagination_serial = NULL){

        //error_log('5531 user - increment_results_count_total ['.$result_count.']');
        self::$oPaginator->increment_results_count_total($result_count, $pagination_serial);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function set_maximum_display_result_count($maximum_display_count, $pagination_serial = NULL){

        self::$oPaginator->set_maximum_display_result_count($maximum_display_count, $pagination_serial);

    }

    //
    // METHOD SOURCE :: Stack Overflow ::  https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
    // Contributor :: https://stackoverflow.com/users/1698153/scott
    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function generate_new_key($len = 32, $char_selection = NULL){

        $token = "";

        if(isset($char_selection)){

            $codeAlphabet = $char_selection;

            $max = strlen($codeAlphabet); // edited

            if (function_exists('random_int')) {

                for ($i = 0; $i < $len; $i++) {

                    $token .= $codeAlphabet[random_int(0, $max - 1)];

                }

            } else {

                for ($i = 0; $i < $len; $i++) {

                    $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max - 1)];

                }

            }

        }else{

            $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
            $codeAlphabet .= "0123456789";

            $max = strlen($codeAlphabet); // edited

            if (function_exists('random_int')) {

                for ($i = 0; $i < $len; $i++) {

                    $token .= $codeAlphabet[random_int(0, $max - 1)];

                }

            } else {

                for ($i = 0; $i < $len; $i++) {

                    $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max - 1)];

                }

            }

        }

        return $token;

    }

    //
    // METHOD SOURCE :: Stack Overflow :: https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
    // Contributor :: https://stackoverflow.com/users/4895359/yumoji
    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    private function crypto_rand_secure($min, $max){
        $range = $max - $min;
        if ($range < 1) return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int)($log / 8) + 1; // length in bytes
        $bits = (int)$log + 1; // length in bits
        $filter = (int)(1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);
        return $min + $rnd;
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

    //
    // SOURCE :: https://www.php.net/manual/en/function.highlight-string.php
    // AUTHOR :: stanislav dot eckert at vizson dot de :: https://www.php.net/manual/en/function.highlight-string.php#118550
    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function highlightText($text, $theme_style = CRNRSTN_PHPNIGHT)   // [EDIT] CRNRSTN :: v2.0.0 FOR PHPNIGHT :: J5
    {

        if ($theme_style == CRNRSTN_UI_PHP) {

            ini_set('highlight.comment', '#008000');
            ini_set('highlight.default', '#000');
            ini_set('highlight.html', '#808080');
            ini_set('highlight.keyword', '#00B; font-weight: bold');
            ini_set('highlight.string', '#D00');

        } else if ($theme_style == CRNRSTN_UI_HTML) {

            ini_set('highlight.comment', 'green');
            ini_set('highlight.default', '#C00');
            ini_set('highlight.html', '#000');
            ini_set('highlight.keyword', 'black; font-weight: bold');
            ini_set('highlight.string', '#00F');

        } else if ($theme_style == CRNRSTN_UI_PHPNIGHT)                        // [EDIT] CRNRSTN :: v2.0.0 :: J5
        {
            ini_set('highlight.comment', '#FC0');
            ini_set('highlight.default', '#DEDECB');
            ini_set('highlight.html', '#808080');
            ini_set('highlight.keyword', '#8FE28F; font-weight: normal');
            ini_set('highlight.string', '#F66');

        }
        // ...

        $text = trim($text);
        $text = highlight_string("<?php " . $text, true);  // highlight_string() requires opening PHP tag or otherwise it will not colorize the text
        $text = trim($text);
        $text = preg_replace("|^\\<code\\>\\<span style\\=\"color\\: #[a-fA-F0-9]{0,6}\"\\>|", "", $text, 1);  // remove prefix
        $text = preg_replace("|\\</code\\>\$|", "", $text, 1);  // remove suffix 1
        $text = trim($text);  // remove line breaks
        $text = preg_replace("|\\</span\\>\$|", "", $text, 1);  // remove suffix 2
        $text = trim($text);  // remove line breaks
        $text = preg_replace("|^(\\<span style\\=\"color\\: #[a-fA-F0-9]{0,6}\"\\>)(&lt;\\?php&nbsp;)(.*?)(\\</span\\>)|", "\$1\$3\$4", $text);  // remove custom added "<?php "

        return $text;
    }

    //
    // METHOD DERIVED FROM CODE WRITTEN BY stanislav dot eckert at vizson dot de ON PHP.NET
    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function highlightCode($filepath, $theme_style = CRNRSTN_PHPNIGHT){
        
        if ($theme_style == CRNRSTN_UI_PHP) {
            ini_set('highlight.comment', '#008000');
            ini_set('highlight.default', '#000000');
            ini_set('highlight.html', '#808080');
            ini_set('highlight.keyword', '#0000BB; font-weight: bold');
            ini_set('highlight.string', '#DD0000');
        } else if ($theme_style == CRNRSTN_UI_HTML) {
            ini_set('highlight.comment', 'green');
            ini_set('highlight.default', '#CC0000');
            ini_set('highlight.html', '#000000');
            ini_set('highlight.keyword', 'black; font-weight: bold');
            ini_set('highlight.string', '#0000FF');
        } else if ($theme_style == CRNRSTN_UI_PHPNIGHT)                        // [EDIT] CRNRSTN v2.0.0 :: J5
        {
            ini_set('highlight.comment', '#FFCC00');
            ini_set('highlight.default', '#DEDECB');
            ini_set('highlight.html', '#808080');
            ini_set('highlight.keyword', '#8FE28F; font-weight: normal');
            ini_set('highlight.string', '#FF6666');
        }
        // ...

        $text = highlight_file($filepath, true);
        $text = trim($text);
        $text = preg_replace("|^\\<code\\>\\<span style\\=\"color\\: #[a-fA-F0-9]{0,6}\"\\>|", "", $text, 1);  // remove prefix
        $text = preg_replace("|\\</code\\>\$|", "", $text, 1);  // remove suffix 1
        $text = trim($text);  // remove line breaks
        $text = preg_replace("|\\</span\\>\$|", "", $text, 1);  // remove suffix 2
        $text = trim($text);  // remove line breaks
        $text = preg_replace("|^(\\<span style\\=\"color\\: #[a-fA-F0-9]{0,6}\"\\>)(&lt;\\?php&nbsp;)(.*?)(\\</span\\>)|", "\$1\$3\$4", $text);  // remove custom added "<?php "

        return $text;
    }

    public function currentEnvironment(){

        return $this->env_cleartext_name;

    }

    public function current_location(){

        return $this->oCRNRSTN_ENV->current_location();

    }

    public function return_endpointProfile(){

        return $this->oCRNRSTN_ENV->return_endpointProfile();

    }

    public function return_loggingProfile(){

        return $this->oCRNRSTN_ENV->return_loggingProfile();

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     * [EMAIL, FILE, SCREEN_TEXT, SCREEN|SCREEN_HTML, SCREEN_HTML_HIDDEN, DEFAULT]
     * LIVE WIRE
     */
    public function get_error_log_trace($output_profile, $log_silo_profile = CRNRSTN_LOG_ALL, $line_num = NULL, $method = NULL, $file = NULL, $output_profile_override_meta = NULL){

        try{

            if($this->CRNRSTN_debugMode<2){

                //
                // HOOOSTON...VE HAF PROBLEM!
                //throw new Exception('Unable to retrieve log trace data due to CRNRSTN being in configuration of CRNRSTN_debugMode="'.$this->CRNRSTN_debugMode.'"...which setting does not authorize resource allocation enabling aggregation of error log data in server memory.');

            }else{

                if(!isset($method)){

                    $method = __METHOD__;

                }

                if(!isset($line_num)){

                    $line_num = __LINE__;

                }

                if(!isset($output_profile)){

                    $output_profile = $this->return_loggingProfile();

                }else{

                    $output_profile = trim(strtoupper($output_profile));
                    switch($output_profile){
                        case CRNRSTN_LOG_EMAIL:
                        case CRNRSTN_LOG_EMAIL_PROXY:
                        case CRNRSTN_LOG_FILE:
                        case CRNRSTN_LOG_SCREEN_TEXT:
                        case CRNRSTN_LOG_SCREEN:
                        case CRNRSTN_LOG_SCREEN_HTML:
                        case CRNRSTN_LOG_SCREEN_HTML_HIDDEN:
                        case CRNRSTN_LOG_DEFAULT:
                        break;
                        default:

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('The provided logging output profile, "'.$output_profile.'", is not supported by CRNRSTN ::. Please choose between the following options :: [CRNRSTN_LOG_EMAIL, CRNRSTN_LOG_EMAIL_PROXY, CRNRSTN_LOG_FILE, CRNRSTN_LOG_SCREEN_TEXT, CRNRSTN_LOG_SCREEN, CRNRSTN_LOG_SCREEN_HTML, CRNRSTN_LOG_SCREEN_HTML_HIDDEN, CRNRSTN_LOG_DEFAULT,..etc.]');

                        break;

                    }

                }

                $this->oLogger->get_error_log_trace($output_profile, $output_profile_override_meta, $log_silo_profile, $line_num, $method, $file, $this);

            }

        } catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return NULL;

    }

    public function return_logPriorityPretty($logPriority, $format='TEXT'){

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

            $tmp_priority = '<span style="font-family:Arial, Helvetica, sans-serif; font-size:15px; text-align:left; color:#F90000; font-weight: bold;">'.$tmp_priority_const.'</span>&nbsp;<span style="font-family:Arial, Helvetica, sans-serif; font-size:15px; text-align:left; color:#000; font-weight: bold;">'.$tmp_priority_msg.'</span>';

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

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function return_client_ip(){

        return $this->oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->clientIpAddress();

    }

    public function exclusiveAccess($ip='*.*'){

        return $this->oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->exclusiveAccess($ip);

    }

    public function denyIPAccess($ip='*.*'){

        return $this->oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->denyIPAccess($ip);

    }

    public function string_sanitize($str, $type){

        return $this->oCRNRSTN_ENV->string_sanitize($str, $type);

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

    public function number_format_keep_precision($number, $dec_places=0, $dec_point = '.', $thou_separate = ','){

        if($dec_places>0){

            return number_format($number , $dec_places , $dec_point, $thou_separate);

        }else{

            //
            // SOURCE :: https://www.php.net/manual/en/function.number-format.php
            // AUTHOR :: stm555 at hotmail dot com :: https://www.php.net/manual/en/function.number-format.php#52311
            $broken_number = explode($dec_point,$number);
            if(isset($broken_number[1])){

                return number_format($broken_number[0] , 0 , $dec_point, $thou_separate).$dec_point.$broken_number[1];

            }else{

                return number_format($broken_number[0] , 0 , $dec_point, $thou_separate);

            }

        }

    }

    //
    // SOURCE :: https://stackoverflow.com/questions/2510434/format-bytes-to-kilobytes-megabytes-gigabytes
    // AUTHOR :: https://stackoverflow.com/users/227532/leo
    public function formatBytes($bytes, $precision = 2, $SI_output=false) {

        //
        // CRNRSTN v2.0.0 :: MODS
        // SEE :: https://en.wikipedia.org/wiki/Binary_prefix
        // SEE ALSO :: ISO/IEC 80000 family of standards (November 1, 2009)
        // https://en.wikipedia.org/wiki/ISO/IEC_80000#Information_science_and_technology
        // SEE COMMENT BY DEVATOR [https://stackoverflow.com/users/659731/devator] JUST
        // BENEATH THE METHOD [formatBytes()] AUTHOR'S RESPONSE AT SOURCE LINK. THIS IS MY
        // IMPETUS TO INCLUDE THE ABOVE LINKS TO ADDITIONAL MATERIAL FROM WIKIPEDIA.
        if($SI_output){

            // SI :: metric prefix
            $units = array('bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
            $units_power = 1000;

        }else{

            // IEC :: ISO 80000 or IEC 80000
            $units = array('bytes', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB');
            $units_power = 1024;

        }

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log($units_power));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow($units_power, $pow);

        $tmp_number = round($bytes, $precision);
        $tmp_number = $this->number_format_keep_precision($tmp_number);

        return  $tmp_number. ' ' . $units[$pow];

    }

    public function return_creative($creative_element_key, $image_output_mode = NULL){

        return self::$oCommRichMediaProvider->return_creative($creative_element_key, $image_output_mode);

    }

    public function shortenColorHex($color_hex){

        $tmp_hex_array = str_split($color_hex);

        if($tmp_hex_array[1]==$tmp_hex_array[2] && $tmp_hex_array[3]==$tmp_hex_array[4] && $tmp_hex_array[5]==$tmp_hex_array[6]){

            $color_hex = '#'.$tmp_hex_array[1].$tmp_hex_array[3].$tmp_hex_array[5];

        }

        return $color_hex;

    }

    private function return_image_to_html_str($width, $height, $table_row_HTML){

        $str = '';
        $str .= '
<table cellpadding="0" cellspacing="0" border="0" width="'.$width.'" style="width:'.$width.'px; height:'.$height.'px;">';
        $str .= $table_row_HTML;
        $str .= '</table>
';

        return $str;

    }

    private function return_styled_row_HTML($table_col_HTML){

        $str = '<tr>';
        $str .= $table_col_HTML;
        $str .= '</tr>';

        return $str;

    }

    private function return_styled_column_HTML($color_hex){

        //$str = '<td style="width:1px; height:1px; overflow: hidden; padding: 0; margin: 0; background-color: '.$color_hex.';"><div style="width: 1px; height: 1px; overflow: hidden;">&nbsp;</div></td>';

        $str = '<td style="background-color:'.$color_hex.';"><div style="width:1px;height:1px;overflow:hidden;">&nbsp;</div></td>';

        return $str;

    }

    private function return_pixelHex($x, $y, $oImageMagi){

        $pixel = $oImageMagi->getImagePixelColor($x, $y);

        $tmp_color_str = $pixel->getColorAsString();
        $tmp_color_str = $this->proper_replace('%','', $tmp_color_str);
        $tmp_color_str = $this->proper_replace('srgb','', $tmp_color_str);
        $tmp_color_str = $this->proper_replace('(','', $tmp_color_str);
        $tmp_color_str = $this->proper_replace(')','', $tmp_color_str);

        $tmp_color_explode = explode(',', $tmp_color_str);

        //
        // SOURCE :: https://stackoverflow.com/questions/32962624/convert-rgb-to-hex-color-values-in-php
        // AUTHOR :: https://stackoverflow.com/users/3942918/user3942918
        $color_hex = sprintf('#%02x%02x%02x', $tmp_color_explode[0], $tmp_color_explode[1], $tmp_color_explode[2]);

        $color_hex = strtoupper($color_hex);

        $color_hex = $this->shortenColorHex($color_hex);

        return $color_hex;

    }

    public function return_image_as_table_HTML($filePath){

        $tmp_image_to_html_str = '';

        if(is_file($filePath)){

            $oImageMagi = new Imagick($filePath);

            $height = $oImageMagi->getImageHeight();
            $width = $oImageMagi->getImageWidth();
            $x = 0;

            $table_row_HTML = '';
            for($y=0; $y<=$height; $y++){

                $table_col_HTML = '';
                for($x=0; $x<=$width; $x++){

                    $tmp_pixel_color_hex = $this->return_pixelHex($x, $y, $oImageMagi);

                    $table_col_HTML .= $this->return_styled_column_HTML($tmp_pixel_color_hex);

                }

                $table_row_HTML .= $this->return_styled_row_HTML($table_col_HTML);

            }

            $tmp_image_to_html_str = $this->return_image_to_html_str($width, $height, $table_row_HTML);

            $this->error_log('IMAGE['.$filePath.']_HTML='.$tmp_image_to_html_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);


        }else{

            $tmp_image_to_html_str = 'Path to file ['.$filePath.'] is not recognized as a file.';

        }

        return $tmp_image_to_html_str;

    }

    public function isMatchedStrPattern($str, $condition_pattern, $case_insensitive=false){

        if($case_insensitive){

            $tmp_str = strtolower($str);
            $tmp_pattern = strtolower($condition_pattern);

            if (fnmatch($tmp_pattern, $tmp_str)) {

                return true;

            }else{

                return false;

            }

        }else{

            if (fnmatch($condition_pattern, $str)) {

                return true;

            }else{

                return false;

            }

        }

    }

    public function proper_replace($pattern, $replacement, $original_str){

        $pattern_array[0] = $pattern;
        $replacement_array[0] = $replacement;

        $original_str = str_replace($pattern_array, $replacement_array, $original_str);

        return $original_str;

    }

    public function chunkPageData($tmp_page_content, $max_len){

        return $this->oCRNRSTN_ENV->chunkPageData($tmp_page_content, $max_len);

    }

    /**
     * Send a POST requst using cURL
     * @param string $url to request
     * @param array $post values to send
     * @param array $options for cURL
     * @return string
     * SOURCE :: https://www.php.net/manual/en/function.curl-exec.php
     * AUTHOR :: David from Code2Design.com :: https://www.php.net/manual/en/function.curl-exec.php#98628
     */
    public function curl_post($url, array $post = NULL, array $options = array()){

        try{

            $defaults = array(
                CURLOPT_POST => 1,
                CURLOPT_HEADER => 0,
                CURLOPT_URL => $url,
                CURLOPT_FRESH_CONNECT => 1,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FORBID_REUSE => 1,
                CURLOPT_TIMEOUT => 25,
                CURLOPT_CONNECTTIMEOUT => 25,
                CURLOPT_POSTFIELDS => http_build_query($post)
            );

            /*
            If you are doing a POST, and the content length is 1,025 or greater, then curl exploits
            a feature of http 1.1: 100 (Continue) Status.

            See http://www.w3.org/Protocols/rfc2616/rfc2616-sec8.html#sec8.2.3

            * it adds a header, "Expect: 100-continue".
            * it then sends the request head, waits for a 100 response code, then sends the content

            Not all web servers support this though.  Various errors are returned depending on the
            server.  If this happens to you, suppress the "Expect" header with this command:

            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
            */

            $ch = curl_init();
            curl_setopt_array($ch, ($options + $defaults));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
            if(!$result = curl_exec($ch)) {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('CRNRSTN :: CURL [POST] ERROR experienced :: '.curl_error($ch));

            }

            curl_close($ch);

            return $result;

        } catch (Exception $e) {

            curl_close($ch);

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    /**
     * Send a GET requst using cURL
     * @param string $url to request
     * @param array $get values to send
     * @param array $options for cURL
     * @return string
     * SOURCE :: https://www.php.net/manual/en/function.curl-exec.php
     * AUTHOR :: David from Code2Design.com :: https://www.php.net/manual/en/function.curl-exec.php#98628
     */
    public function curl_get($url, array $get = NULL, array $options = array()){

        try{

            $defaults = array(
                CURLOPT_URL => $url. (strpos($url, '?') === FALSE ? '?' : ''). http_build_query($get),
                CURLOPT_HEADER => 0,
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_TIMEOUT => 4
            );

            $ch = curl_init();
            curl_setopt_array($ch, ($options + $defaults));
            if(!$result = curl_exec($ch)){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('CRNRSTN :: CURL [GET] ERROR experienced :: '.curl_error($ch));

            }

            curl_close($ch);

            return $result;

        } catch (Exception $e) {

            curl_close($ch);

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.password-hash.php
    public function benchmark_bestPasswordHashCost(){

        /**
         * This code will benchmark your server to determine how high of a cost you can
         * afford. You want to set the highest cost that you can without slowing down
         * you server too much. 8-10 is a good baseline, and more is good if your servers
         * are fast enough. The code below aims for ≤ 50 milliseconds stretching time,
         * which is a good baseline for systems handling interactive logins.
         */
        $timeTarget = 0.05; // 50 milliseconds

        $cost = 8;
        do {
            $cost++;
            $start = microtime(true);
            password_hash("test", PASSWORD_BCRYPT, ["cost" => $cost]);
            $end = microtime(true);
        } while (($end - $start) < $timeTarget);

        $this->error_log('Load Test Complete for Password Hash Option Strength :: Appropriate Cost = '.$cost, __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

    }

    public function return_server_resp_status($status_code){

        $tmp_burn = $this->return_CRNRSTN_ASCII_ART();

        return $this->oCRNRSTN_ENV->return_server_resp_status($status_code, $tmp_burn);

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
         */

        $options = [
            'cost' => 9,
        ];

        return password_hash($user_submitted_password, PASSWORD_BCRYPT, $options);

    }

    public function return_set_bits($integer_constants_array){

        return $this->oCRNRSTN_ENV->return_set_bits($integer_constants_array);

    }

    public function return_set_serialized_bits($const_nom, $integer_constants_array){

        return $this->oCRNRSTN_ENV->return_set_serialized_bits($const_nom, $integer_constants_array);

    }

    public function print_r_str($expression, $title=NULL, $theme_style = NULL, $line_num = NULL, $method = NULL, $file = NULL){

        if(!isset($style_theme)){

            //
            // SET DEFAULT CONSTANT
            $style_theme = CRNRSTN_UI_PHPNIGHT;

            $tmp_theme_ARRAY = $this->oCRNRSTN_ENV->return_set_bits($this->oCRNRSTN_ENV->system_style_profile_constants);

            if(count($tmp_theme_ARRAY) > 0){

                $style_theme = $tmp_theme_ARRAY[0];     // WE TAKE THE FIRST

            }

        }

        $tmp_meta = '['.$this->get_micro_time().' '.date('T').'] [rtime '. $this->wall_time().' secs]';

        if(!isset($method) || $method==''){

            if(isset($file)){

                $tmp_meta .= ' [file '.$file.']';

            }

        }else{

            $tmp_meta .= ' [methd '.$method.']';

        }

        if(isset($line_num)){

            $tmp_meta .= ' [lnum '.$line_num.']';

        }

        $tmp_print_r = print_r($expression, true);

        $tmp_print_r = $this->proper_replace('\r\n', '\n', $tmp_print_r);
        $lines = preg_split('#\r?\n#', trim($tmp_print_r));
        $tmp_line_cnt = sizeof($lines);

        $lineHTML = implode('<br />', range(1, $tmp_line_cnt+0));
        $tmp_linecnt_html_out = '<div style="line-height:20px; position:absolute; padding-right:5px; font-size:14px; font-family: Verdana, Arial, Helvetica, sans-serif; color:#00FF00; border-right:1px solid #333333; background-color:#161616; padding-top:25px; padding-bottom:25px; padding-left:4px;">'.$lineHTML.'</div>';

        if(isset($title) && $title != ''){

            $tmp_title = '<div style="display:block; clear:both; height:4px; line-height:1px; overflow:hidden; width:100%; font-size:1px;"></div><div style="float:left; padding:5px 0 0 30px; text-align:left; font-family: Courier New, Courier, monospace; font-size:11px;">';
            $tmp_title .= $title;
            $tmp_title .= '</div><div style="display:block; clear:both; height:0px; line-height:1px; overflow:hidden; width:100%; font-size:1px;"></div>';

        }else{

            $tmp_title = '<div style="display:block; clear:both; height:4px; line-height:1px; overflow:hidden; width:100%; font-size:1px;"></div><div style="float:left; padding:5px 0 0 30px; text-align:left; font-family: Courier New, Courier, monospace; font-size:11px;">';
            $tmp_title .= 'Begin print_r() output by C<span style="color:#F00;">R</span>NRSTN ::';
            $tmp_title .= '</div><div style="display:block; clear:both; height:0px; line-height:1px; overflow:hidden; width:100%; font-size:1px;"></div>';

        }

        $tmp_hash = $this->generate_new_key(10);

        switch($theme_style){
            case CRNRSTN_UI_PHP:

                $tmp_out = '
                <div id="crnrstn_print_r_output_'.$tmp_hash.'" class="crnrstn_print_r_output"  style="width:100%;">
                '.$tmp_title.'
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#CCC; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                '.$tmp_linecnt_html_out.'
                <div style="background-color:#CCC; color:#DEDECB; width:3000px; padding:10px; margin-top:0; margin-left:10px; padding-left:35px; line-height:20px;">
                <code>';

                break;
            case CRNRSTN_UI_HTML:

                $tmp_out = '
                <div id="crnrstn_print_r_output_'.$tmp_hash.'" class="crnrstn_print_r_output"  style="width:100%;">
                '.$tmp_title.'
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#FFF; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                '.$tmp_linecnt_html_out.'
                <div style="background-color:#FFF; color:#DEDECB; width:3000px; padding:10px; margin-top:0; margin-left:10px; padding-left:35px; line-height:20px;">
                <code>';

                break;
            case CRNRSTN_UI_PHPNIGHT:

                $tmp_out = '
                <div id="crnrstn_print_r_output_'.$tmp_hash.'" class="crnrstn_print_r_output"  style="width:100%;">
                '.$tmp_title.'
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#000; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                '.$tmp_linecnt_html_out.'
                <div style="background-color:#000; color:#DEDECB; width:3000px; padding:10px; margin-top:0; margin-left:10px; padding-left:35px; line-height:20px;">
                <code>';

                break;
            default:

                $tmp_out = '
                <div id="crnrstn_print_r_output_'.$tmp_hash.'" class="crnrstn_print_r_output"  style="width:100%;">
                '.$tmp_title.'
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#E6E6E6; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                '.$tmp_linecnt_html_out.'
                <div style="background-color:#E6E6E6; color:#DEDECB; width:3000px; padding:10px; margin-top:0; margin-left:10px; padding-left:35px; line-height:20px;">
                <code>';

                break;

        }

        $tmp_str_out = '<div style="background-color: #FFF; padding: 10px 20px 10px 20px;">';
        $tmp_str_out .= $tmp_out;

        $output = $this->highlightText($tmp_print_r, $theme_style);
        $output = $this->proper_replace('<br />', '
', $output);

        if($output == '<span style="color: #DEDECB"></span>' || $output == '<span style="color: #000000"></span>' || $output == '<span style="color: #CC0000"></span>'){

            $output = '<span style="color: #DEDECB">&nbsp;</span>';

        }

        if($tmp_str_out == '<span style="color: #000"></span>'){

            $tmp_str_out = '<span style="color: #000">&nbsp;</span>';

        }

        $tmp_str_out .= '<pre>';
        $tmp_str_out .=  print_r($output, true);
        $tmp_str_out .= '</pre>';

        $component_crnrstn_title = $this->oCRNRSTN_ENV->return_component_branding_creative();

        $tmp_str_out .= '</code></div></div>
        <div style="width:100%;">
            <div style="display:block; clear:both; height:4px; line-height:1px; overflow:hidden; width:100%; font-size:1px;"></div>

            '.$component_crnrstn_title.'

            <div style="float:right; max-width:88%; max-width:82%; padding:4px 0 5px 0; text-align:right; font-family: Courier New, Courier, monospace; font-size:11px;">'.$tmp_meta.'</div>
                
            <div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px;"></div>
        </div>
        </div></div></div>';

        $tmp_str_out .= '<div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px;"></div>
';

        return $tmp_str_out;

    }

    public function print_r($expression,  $title=NULL, $style_theme = NULL, $line_num = NULL, $method = NULL, $file = NULL){

        if(!isset($style_theme)){

            //
            // SET DEFAULT CONSTANT
            $style_theme = CRNRSTN_UI_PHPNIGHT;

            $tmp_theme_ARRAY = $this->oCRNRSTN_ENV->return_set_bits($this->oCRNRSTN_ENV->system_style_profile_constants);

            if(count($tmp_theme_ARRAY) > 0){

                $style_theme = $tmp_theme_ARRAY[0];     // WE TAKE THE FIRST

            }

        }

        $tmp_meta = '['.$this->get_micro_time().' '.date('T').'] [rtime '. $this->wall_time().' secs]';

        if(!isset($method) || $method==''){

            if(isset($file)){

                $tmp_meta .= ' [file '.$file.']';

            }

        }else{

            $tmp_meta .= ' [methd '.$method.']';

        }

        if(isset($line_num)){

            $tmp_meta .= ' [lnum '.$line_num.']';

        }

        $tmp_print_r = print_r($expression, true);

        $tmp_print_r = $this->proper_replace('\r\n', '\n', $tmp_print_r);
        $lines = preg_split('#\r?\n#', trim($tmp_print_r));
        $tmp_line_cnt = sizeof($lines);

        $lineHTML = implode('<br />', range(1, $tmp_line_cnt+0));
        $tmp_linecnt_html_out = '<div style="line-height:20px; position:absolute; padding-right:5px; font-size:14px; font-family: Verdana, Arial, Helvetica, sans-serif; color:#00FF00; border-right:1px solid #333333; background-color:#161616; padding-top:25px; padding-bottom:25px; padding-left:4px;">'.$lineHTML.'</div>';

        if(isset($title)){

            $tmp_title = '<div style="display:block; clear:both; height:4px; line-height:1px; overflow:hidden; width:100%; font-size:1px;"></div><div style="float:left; padding:5px 0 0 30px; text-align:left; font-family: Courier New, Courier, monospace; font-size:11px;">';
            $tmp_title .= $title;
            $tmp_title .= '</div><div style="display:block; clear:both; height:0px; line-height:1px; overflow:hidden; width:100%; font-size:1px;"></div>';

        }else{

            $tmp_title = '<div style="display:block; clear:both; height:4px; line-height:1px; overflow:hidden; width:100%; font-size:1px;"></div><div style="float:left; padding:5px 0 0 30px; text-align:left; font-family: Courier New, Courier, monospace; font-size:11px;">';
            $tmp_title .= 'Begin print_r() output by C<span style="color:#F00;">R</span>NRSTN ::';
            $tmp_title .= '</div><div style="display:block; clear:both; height:0px; line-height:1px; overflow:hidden; width:100%; font-size:1px;"></div>';

        }

        $tmp_hash = $this->generate_new_key(10);

        switch($style_theme){
            case CRNRSTN_UI_PHP:

                $tmp_out = '
                <div id="crnrstn_print_r_output_'.$tmp_hash.'" class="crnrstn_print_r_output"  style="width:100%;">
                '.$tmp_title.'
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#CCC; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                '.$tmp_linecnt_html_out.'
                <div style="background-color:#CCC; color:#DEDECB; width:3000px; padding:10px; margin-top:0; margin-left:10px; padding-left:35px; line-height:20px;">
                <code>';

                break;
            case CRNRSTN_UI_HTML:

                $tmp_out = '
                <div id="crnrstn_print_r_output_'.$tmp_hash.'" class="crnrstn_print_r_output"  style="width:100%;">
                '.$tmp_title.'
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#FFF; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                '.$tmp_linecnt_html_out.'
                <div style="background-color:#FFF; color:#DEDECB; width:3000px; padding:10px; margin-top:0; margin-left:10px; padding-left:35px; line-height:20px;">
                <code>';

                break;
            case CRNRSTN_UI_PHPNIGHT:

                $tmp_out = '
                <div id="crnrstn_print_r_output_'.$tmp_hash.'" class="crnrstn_print_r_output"  style="width:100%;">
                '.$tmp_title.'
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#000; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                '.$tmp_linecnt_html_out.'
                <div style="background-color:#000; color:#DEDECB; width:3000px; padding:10px; margin-top:0; margin-left:10px; padding-left:35px; line-height:20px;">
                <code>';

                break;
            default:

                $tmp_out = '
                <div id="crnrstn_print_r_output_'.$tmp_hash.'" class="crnrstn_print_r_output"  style="width:100%;">
                '.$tmp_title.'
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#E6E6E6; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                '.$tmp_linecnt_html_out.'
                <div style="background-color:#E6E6E6; color:#DEDECB; width:3000px; padding:10px; margin-top:0; margin-left:10px; padding-left:35px; line-height:20px;">
                <code>';

                break;

        }

        echo '<div style="background-color: #FFF; padding: 10px 20px 10px 20px;">';
        echo $tmp_out;

        $output = $this->highlightText($tmp_print_r, $style_theme);
        $output = $this->proper_replace('<br />', '
', $output);

        if($output == '<span style="color: #DEDECB"></span>' || $output == '<span style="color: #000000"></span>' || $output == '<span style="color: #CC0000"></span>'){

            $output = '<span style="color: #DEDECB">&nbsp;</span>';

        }

        if($output == '<span style="color: #000"></span>'){

            $output = '<span style="color: #000">&nbsp;</span>';

        }

        echo '<pre>';
        print_r($output);
        echo '</pre>';

        $component_crnrstn_title = $this->oCRNRSTN_ENV->return_component_branding_creative();

        echo '</code></div></div>
        <div style="width:100%;">
            <div style="display:block; clear:both; height:4px; line-height:1px; overflow:hidden; width:100%; font-size:1px;"></div>

            '.$component_crnrstn_title.'

            <div style="float:right; max-width:88%; max-width:82%; padding:4px 0 5px 0; text-align:right; font-family: Courier New, Courier, monospace; font-size:11px;">'.$tmp_meta.'</div>
                
            <div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px;"></div>
        </div>
        </div></div></div>';

        echo '<div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px;"></div>';

    }

    public function return_branding_creative($strip_formatting = false, $output_mode = CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED){

        return $this->oCRNRSTN_ENV->return_component_branding_creative($strip_formatting, $output_mode);

    }

    public function crcINT($value){

        $value = crc32($value);
        // return hash("crc32b", $value);
        return sprintf("%u", $value);

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.base64-encode.php
    // AUTHOR :: luke at lukeoliff.com :: https://www.php.net/manual/en/function.base64-encode.php#105200
    public function base64_encode_image ($filename, $filetype) {

        if (is_file($filename) || (is_string($filename) && (strlen($filename) > 0))) {

            $imgbinary = fread(fopen($filename, "r"), $this->find_filesize($filename));

            return 'data:image/' . $filetype . ';base64,' . base64_encode($imgbinary);

        }else{

            if(!is_file($filename)){

                error_log(__LINE__.'base64_encode_image() NOT IS_FILE!!');

            }

            if(!is_string($filename) && (strlen($filename) > 0)){

                error_log(__LINE__.'base64_encode_image() NOT IS_STRING!!');

            }

        }

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.filesize.php
    // AUTHOR :: C0nw0nk :: https://www.php.net/manual/en/function.filesize.php#119435
    private function find_filesize($file){

        if(substr(PHP_OS, 0, 3) == "WIN"){

            exec('for %I in ("'.$file.'") do @echo %~zI', $output);
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

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     * [EMAIL, FILE, SCREEN_TEXT, SCREEN|SCREEN_HTML, SCREEN_HTML_HIDDEN, DEFAULT]
     * LIVE WIRE
     */
    public function error_log($str, $line_num = NULL, $method = NULL, $file = NULL, $log_silo_key=NULL){

        $tmp_oLog = $this->oLogger->error_log($str, $line_num, $method, $file, $log_silo_key, $this);

        if(is_object($tmp_oLog)){

            $this->oLog_output_ARRAY[] = $tmp_oLog;

        }

        return true;

    }

    public function return_PHPExceptionTracePretty($exception_obj_trace_str, $format = 'ERROR_LOG'){

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
    public function return_bit_constant($const_nom){

        return $this->oCRNRSTN_ENV->return_bit_constant($const_nom);

    }

    public function serialized_bit_stringin($const_nom, $int_string){

        $this->oCRNRSTN_ENV->serialized_bit_stringin($const_nom, $int_string);

        return true;

    }

    public function serialized_bit_stringout($const_nom){

        return $this->oCRNRSTN_ENV->serialized_bit_stringout($const_nom);

    }

    public function serialized_is_bit_set($const_nom, $integer_const){

        return $this->oCRNRSTN_ENV->serialized_is_bit_set($const_nom, $integer_const);

    }

    public function toggle_serialized_bit($const_nom, $integer_const){

        //
        // WILL ALSO (AND FOREVER) RETURN FALSE IF THE BIT REPRESENTED BY THE INTEGER CONSTANT IS NOT INITIALIZED.
        return $this->oCRNRSTN_ENV->toggle_serialized_bit($const_nom, $integer_const);

    }

    public function toggle_bit($integer_const, $target_state = NULL){

        //
        // WILL ALSO (AND FOREVER) RETURN FALSE IF THE BIT REPRESENTED BY THE INTEGER CONSTANT IS NOT INITIALIZED.
        return $this->oCRNRSTN_ENV->toggle_bit($integer_const, $target_state);

    }

    public function is_bit_set($const){

        return $this->oCRNRSTN_ENV->is_bit_set($const);

    }

    public function bit_stringin($int_string){

        return $this->oCRNRSTN_ENV->bit_stringin($int_string);

    }

    public function bit_stringout(){

        return $this->oCRNRSTN_ENV->bit_stringout();

    }

    //define('CRNRSTN_UI_PHP', (int) $this->initialize_constant('CRNRSTN_UI_PHP'));
    public function initialize_serialized_bit($const_nom, $integer_const, $default_state = true){

        return $this->oCRNRSTN_ENV->initialize_serialized_bit($const_nom, $integer_const, $default_state);

    }

    public function initialize_bit($integer_constant, $default_state = true){

        $tmp_bitwise_object_array_index_serial = 'CRNRSTN_USER_GENERIC_BITS';

        if(!@constant($integer_constant)){

            //
            // DEFINE LOCAL CONSTANT
            define($integer_constant, self::$bitwise_serialization_cnt);

            self::$bitwise_serialization_cnt = self::$bitwise_serialization_cnt + 1;

            //error_log(__LINE__.' user $integer_constant='.print_r($integer_constant).' bitwise_serialization_cnt='.self::$bitwise_serialization_cnt);
            $tmp_val = $this->oCRNRSTN_ENV->initialize_serialized_bit($tmp_bitwise_object_array_index_serial, self::$bitwise_serialization_cnt, $default_state);

            return $tmp_val;

        }else{

            //error_log(__LINE__.' user previously defined integer_constant = '.$integer_constant);

            if(!is_int($integer_constant)){

                $integer_constant = constant($integer_constant);

            }

            return $this->oCRNRSTN_ENV->initialize_serialized_bit($tmp_bitwise_object_array_index_serial, $integer_constant, $default_state);

        }

    }

    public function define_env_resource($key, $value){

        $this->oCRNRSTN_ENV->oSESSION_MGR->set_session_param($key, $value);

    }

    public function catchException($exception_obj, $syslog_constant = LOG_DEBUG, $method = NULL, $namespace = NULL, $output_profile = NULL, $output_profile_override_meta = NULL, $wcr_override_pipe = NULL){

        $tmp_err_trace_str = $this->return_PHPExceptionTracePretty($exception_obj->getTraceAsString());

        if(strlen($tmp_err_trace_str)>0){

            $this->error_log('PHP native exception output log trace received ::'.$tmp_err_trace_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

        }

        //
        // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
        $tmp_return = $this->oLogger->catchException($exception_obj, $syslog_constant, $method, $namespace, $output_profile, $output_profile_override_meta, $wcr_override_pipe, $this);

        if(is_array($tmp_return)){

            return $tmp_return;

        }

    }

    public function proper_version($system = 'CRNRSTN'){

        error_log(__LINE__.' user $system='.$system);

        $system = trim(strtoupper($system));

        switch($system){
            case 'APACHE':

                return 'Apache v' . $this->version_apache;

            break;
            case 'MYSQLI':

                return 'MySQLi v' . $this->version_crnrstn;

            break;
            case 'PHP':

                return 'php v' . $this->version_php;

            break;
            case 'SOAP':

                return 'SOAP v' . $this->version_soap;

            break;
            default:

                return 'CRNRSTN :: v' . $this->version_crnrstn;

            break;

        }

    }

    # #
    # SOURCE
    # http://patorjk.com/software/taag/#p=display&f=Doh&t=CRNRSTN%20%3A%3A
    public function return_CRNRSTN_ASCII_ART($index=NULL){

        $tmp_crnrstnART[0] = '      ___           <span style="color:#F00;">___</span>           ___           ___           ___                         ___              
     /\__\         <span style="color:#F00;">/\  \</span>         /\  \         /\  \         /\__\                       /\  \             
    /:/  /        <span style="color:#F00;">/::\  \</span>        \:\  \       /::\  \       /:/ _/_         ___          \:\  \            
   /:/  /        <span style="color:#F00;">/:/\:\__\</span>        \:\  \     /:/\:\__\     /:/ /\  \       /\__\          \:\  \      ::::::  ::::::           
  /:/  /  ___   <span style="color:#F00;">/:/ /:/  /</span>    _____\:\  \   /:/ /:/  /    /:/ /::\  \     /:/  /      _____\:\  \     ::::::  ::::::          
 /:/__/  /\__\ <span style="color:#F00;">/:/_/:/__/</span>___ /::::::::\__\ /:/_/:/__/___ /:/_/:/\:\__\   /:/__/      /::::::::\__\         
 \:\  \ /:/  / <span style="color:#F00;">\:\/:::::/  / </span>\:\~~\~~\/__/ \:\/:::::/  / \:\/:/ /:/  /  /::\  \      \:\~~\~~\/__/         
  \:\  /:/  /   <span style="color:#F00;">\::/~~/~~~~</span>   \:\  \        \::/~~/~~~~   \::/ /:/  /  /:/\:\  \      \:\  \          ::::::  ::::::         
   \:\/:/  /     <span style="color:#F00;">\:\~~\</span>        \:\  \        \:\~~\        \/_/:/  /   \/__\:\  \      \:\  \         ::::::  ::::::          
    \::/  /       <span style="color:#F00;">\:\__\</span>        \:\__\        \:\__\         /:/  /         \:\__\      \:\__\             
     \/__/         <span style="color:#F00;">\/__/</span>         \/__/         \/__/         \/__/           \/__/       \/__/      
	 

';

        $tmp_crnrstnART[4] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">___</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">/\&nbsp;&nbsp;\</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">/::\&nbsp;&nbsp;\</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/::\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/:/&nbsp;_/_&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">/:/\:\__\</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/:/\:\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/:/&nbsp;/\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;___&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">/:/&nbsp;/:/&nbsp;&nbsp;/</span>&nbsp;&nbsp;&nbsp;&nbsp;_____\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;/:/&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;/:/&nbsp;/::\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_____\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;/:/__/&nbsp;&nbsp;/\__\&nbsp;<span&nbsp;style="color:#F00;">/:/_/:/__/</span>___&nbsp;/::::::::\__\&nbsp;/:/_/:/__/___&nbsp;/:/_/:/\:\__\&nbsp;&nbsp;&nbsp;/:/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/::::::::\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;\:\&nbsp;&nbsp;\&nbsp;/:/&nbsp;&nbsp;/&nbsp;<span&nbsp;style="color:#F00;">\:\/:::::/&nbsp;&nbsp;/&nbsp;</span>\:\~~\~~\/__/&nbsp;\:\/:::::/&nbsp;&nbsp;/&nbsp;\:\/:/&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;/::\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\~~\~~\/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;\:\&nbsp;&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">\::/~~/~~~~</span>&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\::/~~/~~~~&nbsp;&nbsp;&nbsp;\::/&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;/:/\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;\:\/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">\:\~~\</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\~~\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\/_/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;\/__\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;\::/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">\:\__\</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">\/__/</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
	&nbsp;<br>
<br>
';

        $tmp_crnrstnART[1] = '        CCCCCCCCCCCCC<span style="color:#F00;">RRRRRRRRRRRRRRRRR</span>   NNNNNNNN        NNNNNNNNRRRRRRRRRRRRRRRRR      SSSSSSSSSSSSSSS TTTTTTTTTTTTTTTTTTTTTTTNNNNNNNN        NNNNNNNN
     CCC::::::::::::C<span style="color:#F00;">R::::::::::::::::R</span>  N:::::::N       N::::::NR::::::::::::::::R   SS:::::::::::::::ST:::::::::::::::::::::TN:::::::N       N::::::N
   CC:::::::::::::::C<span style="color:#F00;">R::::::RRRRRR:::::R</span> N::::::::N      N::::::NR::::::RRRRRR:::::R S:::::SSSSSS::::::ST:::::::::::::::::::::TN::::::::N      N::::::N
  C:::::CCCCCCCC::::C<span style="color:#F00;">RR:::::R     R:::::R</span>N:::::::::N     N::::::NRR:::::R     R:::::RS:::::S     SSSSSSST:::::TT:::::::TT:::::TN:::::::::N     N::::::N
 C:::::C       CCCCCC  <span style="color:#F00;">R::::R     R:::::R</span>N::::::::::N    N::::::N  R::::R     R:::::RS:::::S            TTTTTT  T:::::T  TTTTTTN::::::::::N    N::::::N
C:::::C                <span style="color:#F00;">R::::R     R:::::R</span>N:::::::::::N   N::::::N  R::::R     R:::::RS:::::S                    T:::::T        N:::::::::::N   N::::::N      ::::::  ::::::
C:::::C                <span style="color:#F00;">R::::RRRRRR:::::R</span> N:::::::N::::N  N::::::N  R::::RRRRRR:::::R  S::::SSSS                 T:::::T        N:::::::N::::N  N::::::N      ::::::  ::::::
C:::::C                <span style="color:#F00;">R:::::::::::::RR</span>  N::::::N N::::N N::::::N  R:::::::::::::RR    SS::::::SSSSS            T:::::T        N::::::N N::::N N::::::N      ::::::  ::::::
C:::::C                <span style="color:#F00;">R::::RRRRRR:::::R</span> N::::::N  N::::N:::::::N  R::::RRRRRR:::::R     SSS::::::::SS          T:::::T        N::::::N  N::::N:::::::N
C:::::C                <span style="color:#F00;">R::::R</span>     <span style="color:#F00;">R:::::R</span>N::::::N   N:::::::::::N  R::::R     R:::::R       SSSSSS::::S         T:::::T        N::::::N   N:::::::::::N
C:::::C                <span style="color:#F00;">R::::R</span>     <span style="color:#F00;">R:::::R</span>N::::::N    N::::::::::N  R::::R     R:::::R            S:::::S        T:::::T        N::::::N    N::::::::::N
 C:::::C       CCCCCC  <span style="color:#F00;">R::::R</span>     <span style="color:#F00;">R:::::R</span>N::::::N     N:::::::::N  R::::R     R:::::R            S:::::S        T:::::T        N::::::N     N:::::::::N      ::::::  ::::::
  C:::::CCCCCCCC::::C<span style="color:#F00;">RR:::::R</span>     <span style="color:#F00;">R:::::R</span>N::::::N      N::::::::NRR:::::R     R:::::RSSSSSSS     S:::::S      TT:::::::TT      N::::::N      N::::::::N      ::::::  ::::::
   CC:::::::::::::::C<span style="color:#F00;">R::::::R</span>     <span style="color:#F00;">R:::::R</span>N::::::N       N:::::::NR::::::R     R:::::RS::::::SSSSSS:::::S      T:::::::::T      N::::::N       N:::::::N      ::::::  ::::::
     CCC::::::::::::C<span style="color:#F00;">R::::::R</span>     <span style="color:#F00;">R:::::R</span>N::::::N        N::::::NR::::::R     R:::::RS:::::::::::::::SS       T:::::::::T      N::::::N        N::::::N
        CCCCCCCCCCCCC<span style="color:#F00;">RRRRRRRR</span>     <span style="color:#F00;">RRRRRRR</span>NNNNNNNN         NNNNNNNRRRRRRRR     RRRRRRR SSSSSSSSSSSSSSS         TTTTTTTTTTT      NNNNNNNN         NNNNNNN
                                                                                                                                                       

';

        $tmp_crnrstnART[5] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CCCCCCCCCCCCC<span&nbsp;style="color:#F00;">RRRRRRRRRRRRRRRRR</span>&nbsp;&nbsp;&nbsp;NNNNNNNN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NNNNNNNNRRRRRRRRRRRRRRRRR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SSSSSSSSSSSSSSS&nbsp;TTTTTTTTTTTTTTTTTTTTTTTNNNNNNNN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NNNNNNNN<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CCC::::::::::::C<span&nbsp;style="color:#F00;">R::::::::::::::::R</span>&nbsp;&nbsp;N:::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::NR::::::::::::::::R&nbsp;&nbsp;&nbsp;SS:::::::::::::::ST:::::::::::::::::::::TN:::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N<br>
&nbsp;&nbsp;&nbsp;CC:::::::::::::::C<span&nbsp;style="color:#F00;">R::::::RRRRRR:::::R</span>&nbsp;N::::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::NR::::::RRRRRR:::::R&nbsp;S:::::SSSSSS::::::ST:::::::::::::::::::::TN::::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N<br>
&nbsp;&nbsp;C:::::CCCCCCCC::::C<span&nbsp;style="color:#F00;">RR:::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::R</span>N:::::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::NRR:::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::RS:::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SSSSSSST:::::TT:::::::TT:::::TN:::::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N<br>
&nbsp;C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CCCCCC&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::R</span>N::::::::::N&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;R::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::RS:::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TTTTTT&nbsp;&nbsp;T:::::T&nbsp;&nbsp;TTTTTTN::::::::::N&nbsp;&nbsp;&nbsp;&nbsp;N::::::N<br>
C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::R</span>N:::::::::::N&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;R::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::RS:::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N:::::::::::N&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::<br>
C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R::::RRRRRR:::::R</span>&nbsp;N:::::::N::::N&nbsp;&nbsp;N::::::N&nbsp;&nbsp;R::::RRRRRR:::::R&nbsp;&nbsp;S::::SSSS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N:::::::N::::N&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::<br>
C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R:::::::::::::RR</span>&nbsp;&nbsp;N::::::N&nbsp;N::::N&nbsp;N::::::N&nbsp;&nbsp;R:::::::::::::RR&nbsp;&nbsp;&nbsp;&nbsp;SS::::::SSSSS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;N::::N&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::<br>
C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R::::RRRRRR:::::R</span>&nbsp;N::::::N&nbsp;&nbsp;N::::N:::::::N&nbsp;&nbsp;R::::RRRRRR:::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SSS::::::::SS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;N::::N:::::::N<br>
C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R::::R</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R:::::R</span>N::::::N&nbsp;&nbsp;&nbsp;N:::::::::::N&nbsp;&nbsp;R::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SSSSSS::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;N:::::::::::N<br>
C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R::::R</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R:::::R</span>N::::::N&nbsp;&nbsp;&nbsp;&nbsp;N::::::::::N&nbsp;&nbsp;R::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;S:::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;N::::::::::N<br>
&nbsp;C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CCCCCC&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R::::R</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R:::::R</span>N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N:::::::::N&nbsp;&nbsp;R::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;S:::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N:::::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::<br>
&nbsp;&nbsp;C:::::CCCCCCCC::::C<span&nbsp;style="color:#F00;">RR:::::R</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R:::::R</span>N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::::NRR:::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::RSSSSSSS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;S:::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TT:::::::TT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::<br>
&nbsp;&nbsp;&nbsp;CC:::::::::::::::C<span&nbsp;style="color:#F00;">R::::::R</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R:::::R</span>N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N:::::::NR::::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::RS::::::SSSSSS:::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N:::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CCC::::::::::::C<span&nbsp;style="color:#F00;">R::::::R</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R:::::R</span>N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::NR::::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::RS:::::::::::::::SS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CCCCCCCCCCCCC<span&nbsp;style="color:#F00;">RRRRRRRR</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">RRRRRRR</span>NNNNNNNN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NNNNNNNRRRRRRRR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RRRRRRR&nbsp;SSSSSSSSSSSSSSS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TTTTTTTTTTT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NNNNNNNN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NNNNNNN<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
<br>
';

        $tmp_crnrstnART[2]= '

 ######  <span style="color:#F00;">########</span>  ##    ## ########   ######  ######## ##    ##     ##   ##  
##    ## <span style="color:#F00;">##     ##</span> ###   ## ##     ## ##    ##    ##    ###   ##    #### #### 
##       <span style="color:#F00;">##     ##</span> ####  ## ##     ## ##          ##    ####  ##     ##   ##  
##       <span style="color:#F00;">########</span>  ## ## ## ########   ######     ##    ## ## ##              
##       <span style="color:#F00;">##   ##</span>   ##  #### ##   ##         ##    ##    ##  ####     ##   ##  
##    ## <span style="color:#F00;">##    ##</span>  ##   ### ##    ##  ##    ##    ##    ##   ###    #### #### 
 ######  <span style="color:#F00;">##     ##</span> ##    ## ##     ##  ######     ##    ##    ##     ##   ##  


';

        $tmp_crnrstnART[6] = '<br>
<br>
&nbsp;######&nbsp;&nbsp;<span&nbsp;style="color:#F00;">########</span>&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;########&nbsp;&nbsp;&nbsp;######&nbsp;&nbsp;########&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;<br>
##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;<span&nbsp;style="color:#F00;">##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##</span>&nbsp;###&nbsp;&nbsp;&nbsp;##&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;###&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;####&nbsp;####&nbsp;<br>
##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##</span>&nbsp;####&nbsp;&nbsp;##&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;####&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;<br>
##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">########</span>&nbsp;&nbsp;##&nbsp;##&nbsp;##&nbsp;########&nbsp;&nbsp;&nbsp;######&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;##&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">##&nbsp;&nbsp;&nbsp;##</span>&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;####&nbsp;##&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;####&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;<br>
##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;<span&nbsp;style="color:#F00;">##&nbsp;&nbsp;&nbsp;&nbsp;##</span>&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;###&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;###&nbsp;&nbsp;&nbsp;&nbsp;####&nbsp;####&nbsp;<br>
&nbsp;######&nbsp;&nbsp;<span&nbsp;style="color:#F00;">##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##</span>&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;######&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;<br>
<br>
<br>
';

        $tmp_crnrstnART[3] = '

                                                                                         
   _|_|_|  <span style="color:#F00;">_|_|_|</span>    _|      _|  _|_|_|      _|_|_|  _|_|_|_|_|  _|      _|              
 _|        <span style="color:#F00;">_|    _|</span>  _|_|    _|  _|    _|  _|            _|      _|_|    _|      _|  _|  
 _|        <span style="color:#F00;">_|_|_|</span>    _|  _|  _|  _|_|_|      _|_|        _|      _|  _|  _|              
 _|        <span style="color:#F00;">_|    _|</span>  _|    _|_|  _|    _|        _|      _|      _|    _|_|              
   _|_|_|  <span style="color:#F00;">_|    _|</span>  _|      _|  _|    _|  _|_|_|        _|      _|      _|      _|  _|  
                                                                                         
                                                                                         

';

        $tmp_crnrstnART[7] = '<br>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;_|_|_|&nbsp;&nbsp;<span&nbsp;style="color:#F00;">_|_|_|</span>&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|_|_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|_|_|&nbsp;&nbsp;_|_|_|_|_|&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">_|&nbsp;&nbsp;&nbsp;&nbsp;_|</span>&nbsp;&nbsp;_|_|&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|_|&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;<br>
&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">_|_|_|</span>&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;_|_|_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">_|&nbsp;&nbsp;&nbsp;&nbsp;_|</span>&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;_|_|&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;_|_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;_|_|_|&nbsp;&nbsp;<span&nbsp;style="color:#F00;">_|&nbsp;&nbsp;&nbsp;&nbsp;_|</span>&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|_|_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
<br>
';

        if(!isset($index)){

            return $tmp_crnrstnART[rand ( 0 , 3)];

        }else{

            return $tmp_crnrstnART[$index];

        }

    }

    //
    // SOURCE :: https://aloneonahill.com/blog/if-php-were-british/
    // AUTHOR :: https://aloneonahill.com/blog/about-dave/
    public function hello_world($type, $is_bastard = true){

        //
        // SESSION IS SET
        try{

            if($is_bastard){

                $str = 'Hello World.';  // bastard dialect

            }else{

                $str = 'Good morrow, fellow subjects of the Crown.';

            }

            error_log(__LINE__.' '.get_class().' exception! '.$str);
            throw new Exception('CRNRSTN '.$this->version_crnrstn.' :: '.$str.' This is an exception handling test from '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].').');

            return $this->oCRNRSTN_ENV->hello_world($is_bastard);

        } catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    private function output_agg_destruct_str(){

        if($this->destruct_output != ''){

            //
            // SET DEFAULT CONSTANT
            $style_theme = CRNRSTN_UI_PHPNIGHT;

            $tmp_theme_ARRAY = $this->oCRNRSTN_ENV->return_set_bits($this->oCRNRSTN_ENV->system_style_profile_constants);

            if(count($tmp_theme_ARRAY) > 0){

                $style_theme = $tmp_theme_ARRAY[0];     // WE TAKE THE FIRST

            }

            $this->oLog_output_ARRAY[] = $this->error_log('Process __destruct initiated output of error log trace data.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);

            //$this->print_r($this->destruct_output, 'C<span style="color:#F00;">R</span>NRSTN Debug Mode 2 :: Error Log Trace Debug Output ::', $style_theme, __LINE__, __METHOD__, __FILE__);
            print_r('<div style="height:20px; width:100%; clear:both; display: block; overflow: hidden;">&nbsp;</div>');
            print_r($this->destruct_output);

        }

    }

    public function resource_filecache_version($file_path){

        $file_cache_version_str = filesize($file_path) . '.' . filemtime($file_path).'.0';

        return $file_cache_version_str;

    }

    public function tidy_boolean($val, $format = 'bool'){

        $format = strtolower($format);

        error_log(__LINE__ . ' user tidy_boolean[' . print_r($val, true) . ']');

        switch($format){
            case 'string':

                if(is_bool($val) === true){

                    if($val){

                        return 'true';

                    }else{

                        return 'false';

                    }

                }else{

                    if(!isset($val)){

                        return false;

                    }else{

                        $val = $this->oCRNRSTN_ENV->boolean_conversion($val);

                        if($val){

                            return 'true';

                        }else{

                            return 'false';

                        }

                    }

                }

            break;
            case 'integer':
            case 'int':

                if(is_bool($val) === true){

                    if($val){

                        return (int) 1;

                    }else{

                        return (int) 0;

                    }


                }else{

                    if(!isset($val)){

                        return false;

                    }else{

                        $val = $this->oCRNRSTN_ENV->boolean_conversion($val);

                        if($val){

                            return (int) 1;

                        }else{

                            return (int) 0;

                        }

                    }

                }

            break;
            default:
                // bool
                if(is_bool($val) === true){

                    return $val;

                }else{

                    if(!isset($val)){

                        return false;

                    }else{

                        return $this->oCRNRSTN_ENV->boolean_conversion($val);

                    }

                }
            break;

        }

    }

    public function validate_css($raw_html_data){

        try{

            if(!isset(self::$oCRNRSTN_CSS_VALIDATOR)){

                self::$oCRNRSTN_CSS_VALIDATOR = new crnrstn_communications_css_standard($this, $raw_html_data);

            }

            return self::$oCRNRSTN_CSS_VALIDATOR->return_validation_results();

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

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

        if($parts === false) {

            throw new \InvalidArgumentException('Malformed URL: ' . $url);

        }

        foreach($parts as $name => $value) {

            $parts[$name] = urldecode($value);

        }

        return $parts;

    }

    public function mkdir_r($dir_path, $mkdir_mode = NULL){

        return $this->oCRNRSTN_ENV->mkdir_r($dir_path, $mkdir_mode);

    }

    public function __destruct(){

        $this->output_agg_destruct_str();

        $this->oLog_output_ARRAY[] = $this->error_log('goodbye crnrstn :: usr __destruct called.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);

    }

}

# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: crnrstn_user_auth
#  VERSION :: 1.00.0000
#  DATE :: Saturday, May 8, 2021 1518hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: User permissions management object.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_user_auth{

    protected $oLogger;
    protected $oCRNRSTN_USR;
    protected $oUSER_ACCOUNT;

    protected $serial;
    protected $login_attempt_cnt = 0;
    //protected $max_seconds_inactive = 900;
    protected $last_modified_date;
    protected $is_authorized = false;
    protected $is_expired = false;
    protected $log_sys_notice_ARRAY = array();

    public function __construct($oCRNRSTN_USR) {

        $this->oCRNRSTN_USR = $oCRNRSTN_USR;
        $this->serial = $this->oCRNRSTN_USR->generate_new_key(10);

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging($this->oCRNRSTN_USR->CRNRSTN_debugMode, __CLASS__, $this->oCRNRSTN_USR->log_silo_profile, $this->oCRNRSTN_USR);

        //$this->max_seconds_inactive = $this->oCRNRSTN_USR->account_max_secs_inactive();

    }

    public function refresh_modified_date(){

        $this->last_modified_date = $this->oCRNRSTN_USR->get_micro_time();

    }

    public function last_modified_date(){

        return $this->last_modified_date;

    }

    public function receive_authorized_account($oUSER_ACCOUNT){

        error_log(__LINE__ . ' user receive_authorized_account class=[' . get_class($oUSER_ACCOUNT) . ']');
        $this->oUSER_ACCOUNT = $oUSER_ACCOUNT;

    }

    public function return_account(){

        return $this->oUSER_ACCOUNT;

    }

    public function account_get_resource($resource){

        if(isset($this->oUSER_ACCOUNT)){

            return $this->oUSER_ACCOUNT->account_get_resource($resource);

        }else{

            //error_log(__LINE__ . ' user ERROR? $resource=['.$resource.'] = 10. class=['.get_class($this->oUSER_ACCOUNT).']');

            return 10;

        }

    }

    public function is_set(){

        if(isset($this->oUSER_ACCOUNT)){

            return true;

        }else{

            return false;

        }

    }

//    public function return_login_attempts($meta_type = 'count'){
//
//        switch($meta_type){
//            case 'max':
//
//                return $this->oCRNRSTN_USR->return_login_attempts('max');
//
//            break;
//            case 'remaining':
//
//                return $this->return_login_attempts_remaining();
//
//            break;
//            default:
//
//                return $this->login_attempt_cnt;
//
//            break;
//
//        }
//
//    }

    private function is_logged_in($state_override = NULL){

        if(isset($this->oUSER_ACCOUNT)){

            if(isset($state_override)){

                $this->oUSER_ACCOUNT->is_logged_in($state_override);

            }

            error_log(__LINE__ . ' user is_logged_in [' . print_r($this->oUSER_ACCOUNT->is_logged_in(), true) . ']');
            return $this->oUSER_ACCOUNT->is_logged_in();

        }else{

            return false;

        }

    }

    private function is_expired(){

        if(isset($this->oUSER_ACCOUNT)){

            if(isset($state_override)){

                $this->oUSER_ACCOUNT->is_logged_in($state_override);

            }

            error_log(__LINE__ . ' user is_logged_in [' . print_r($this->oUSER_ACCOUNT->is_logged_in(), true) . ']');

            return $this->oUSER_ACCOUNT->is_logged_in();

        }else{

            return false;

        }

    }

    public function increment_login_attempt(){

        $this->login_attempt_cnt++;

    }

//    public function return_max_secs_inactive(){
//
//        return $this->max_seconds_inactive;
//
//    }

    public function initialize_user_login_attempt(){

        /*

        // Sunday May 9, 2021 2326hrs
        // TRACK SESSION LOGIN ATTEMPTS.
        // STATS TO INCLUDE ::
            ~ TOTAL LOGIN ATTEMPT COUNT
            ~ DELTA TIME
                * FIRST ATTEMPT TIME
                * LAST ATTEMPT TIME

       */

    }

    public function sync_session_signin($oCRNRSN_ADMIN){

        $this->oCRNRSTN_USR->set_session_param('CRNRSTN_AUTHORIZED_ACCOUNT_STATUS', 'AUTH_ACTIVE');
        $this->oCRNRSTN_USR->set_session_param('CRNRSTN_AUTHORIZED_ACCOUNT', $oCRNRSN_ADMIN);

        return true;

    }

    public function sync_session_signout($oCRNRSN_ADMIN){

        $this->oCRNRSTN_USR->set_session_param('CRNRSTN_AUTHORIZED_ACCOUNT_STATUS', 'LOGGED_OUT');
        return $this->oCRNRSTN_USR->set_session_param('CRNRSTN_AUTHORIZED_ACCOUNT', 0);

    }

//    public function return_login_attempts_remaining(){
//
//        $tmp_max_login = $this->oCRNRSTN_USR->return_login_attempts('max');
//
//        return $tmp_max_login - $this->login_attempt_cnt;
//
//    }

    public function init_auth_session(){

        $this->oCRNRSTN_USR->set_session_param('CRNRSTN_AUTHORIZED_ACCOUNT', $this);

    }

    private function maintain_valid_session(){

        //
        /*
        Monday May 10, 2021 1740hrs
        CRITERIA FOR MAINTENANCE OF SESSION VALIDITY ::

        ~ INACTIVITY TIMEOUT
        ~ IP ADDRESS CHANGE
        ~ FIRE LOG OUT METHOD

        // READY TO TEST CODE ON Monday May 10, 2021 1841hrs
        */
        error_log(__LINE__ . ' user checking user_auth->monitor_ip_address');

        if($this->monitor_ip_address()){
            error_log(__LINE__ . ' user checking oUSER_ACCOUNT->is_logged_in');

            if($this->oUSER_ACCOUNT->is_logged_in()){
                error_log(__LINE__ . ' user checking user_auth->monitor_inactivity');

                if($this->monitor_inactivity()){
                    error_log(__LINE__ . ' user return true');

                    $this->refresh_modified_date();

                    return true;

                }

            }

        }
        error_log(__LINE__ . ' user return false');

        return false;

    }

    private function monitor_inactivity(){

        if($this->oCRNRSTN_USR->account_get_resource('max_seconds_inactive') < $this->oCRNRSTN_USR->elapsed_from_current(strtotime($this->last_modified_date))){

            return false;

        }else{

            return true;

        }

    }

    private function monitor_ip_address(){

        $tmp_sess_ip = $this->oCRNRSTN_USR->account_get_resource('session_ip_address');
        $tmp_curr_ip = $this->oCRNRSTN_USR->return_client_ip();

        error_log(__LINE__ . ' user class['.get_class().'] monitor_ip_address ['.$tmp_sess_ip.'] == ['.$tmp_curr_ip.']');

        if($tmp_sess_ip != $tmp_curr_ip){

            return false;

        }else{

            return true;

        }

    }

    public function process_authorization(){

        //
        // PROVIDE USER INPUT PARAMS
        // crnrstn_auth_e
        // crnrstn_auth_pwd
        /**

        $raw_html_data = $this->extractData_HTTP('ugc_html', 'POST');
        $tmp_crnrstn_css_rtime = $this->extractData_HTTP('css_rtime');
        if($this->isset_HTTP_Param('crnrstn_r', 'GET')){

         * return_admin_ARRAY

         */

        $tmp_email = $this->oCRNRSTN_USR->get_http_resource('crnrstn_auth_e');
        $tmp_pwd_hash = md5($this->oCRNRSTN_USR->get_http_resource('crnrstn_auth_pwd'));
        $tmp_crnrstn_country_iso_code = $this->oCRNRSTN_USR->get_http_resource('crnrstn_country_iso_code');
        $tmp_crnrstn_php_sessionid = $this->oCRNRSTN_USR->get_http_resource('crnrstn_php_sessionid');

        //
        // PROVIDE STORED ADMIN AUTH PARAMS
        $tmp_oAdmin_ARRAY = $this->oCRNRSTN_USR->return_admin_ARRAY();
        $tmp_array = array();
        $tmp_return_oADMIN = false;

        foreach($tmp_oAdmin_ARRAY as $serial => $oCRNRSTN_ADMIN){

            if($oCRNRSTN_ADMIN->is_valid($tmp_email, $tmp_pwd_hash)){

                $this->oCRNRSTN_USR->account_serial = $oCRNRSTN_ADMIN->account_get_resource('serial');

                $oCRNRSTN_ADMIN->is_logged_in(true);

                $this->receive_authorized_account($oCRNRSTN_ADMIN);

                $this->init_auth_session();

                return true;

            }

        }

        $this->init_auth_session();

        return false;

    }

    public function is_account_valid(){

        error_log(__LINE__ . ' user crnrstn_user_auth is_account_valid run maintain_valid_session');

        if(!$this->maintain_valid_session()){
            error_log(__LINE__ . ' user crnrstn_user_auth maintain_valid_session return false');

            //
            // ENSURE LOG OUT USER
            $this->log_account_notification($this->oCRNRSTN_USR->get_lang_copy('CRNRSTN_SESSION_INACTIVE_EXPIRE'));
            error_log(__LINE__ . ' user crnrstn_user_auth log_account_notification [' . $this->log_sys_notice_ARRAY[0] . ']');

            $this->is_logged_in(false);

            return false;

        }else{

            error_log(__LINE__ . ' user crnrstn_user_auth maintain_valid_session return true');

            return true;

        }

    }

    public function log_account_notification($str){

        $this->log_sys_notice_ARRAY[] = $str;

    }

    public function account_max_inactive($secs_override = NULL){

        return $this->oUSER_ACCOUNT->account_get_resource('max_seconds_inactive');

    }

    public function account_max_login_attempts($count_override = NULL){

        return $this->oUSER_ACCOUNT->account_get_resource('max_login_attempts');

    }

    public function account_remaining_login_attempts($count_override = NULL){

        if(isset($this->oUSER_ACCOUNT)){

            $tmp_max_cnt = (int) $this->oUSER_ACCOUNT->account_get_resource('max_login_attempts');
            $tmp_cnt_remain = $tmp_max_cnt - $this->login_attempt_cnt;

            return $tmp_cnt_remain;

        }else{

            return $this->account_remaining_login_attempts();

        }

    }

//    public function account_remaining_login_attempts($count_override = NULL){
//
//        return $this->oCRNRSTN_AUTH->account_max_login_attempts($count_override);
//
//    }

    public function __destruct(){

    }

}