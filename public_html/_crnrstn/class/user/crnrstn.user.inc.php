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
#  CLASS :: crnrstn_user
#  VERSION :: 2.00.0000
#  DATE :: September 11, 2012 1720hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: We put a hood on CRNRSTN ::,...complete with seats and a steering wheel...for
#  the user (which said user ended up being crnrstn::, and now $oCRNRSTN has the seats, steering
#  wheel, and gas pedal).
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_user{

    protected $oLogger;
    protected $oNUSOAP_BASE;
    public $oCRNRSTN;
    public $oCRNRSTN_ENV;
    public $oCRNRSTN_DATABASE;
    public $oCRNRSTN_ASSET_MGR;
    protected $oCRNRSTN_TRM;
    protected $oCRNRSTN_BASSDRIVE;
    protected $oCRNRSTN_AUTH;
    protected $oCRNRSTN_ACCNT;
    protected $oCRNRSTN_VSC;
    protected $oCRNRSTN_QPM;
    private static $oRedirectCntrlr;
    public $oMySQLi_ARRAY = array();
    private static $oMySQLi_hash_ARRAY = array();
    private static $oSqlSilo;
    private static $oPaginator;
    protected $oSoapClient;
    protected $oCRNRSTN_UX;
    private static $oCRNRSTN_CSS_VALIDATOR;

    public $config_serial_hash;
    public $account_serial;

    private static $oLog_ProfileManager;

    public $cache_ttl_default = 80;
    public $useCURL_default = true;
    protected $ssdtl_packet_ttl = -1;
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
    public $ini_set_ARRAY = array();
    public $starttime;

    public $log_silo_profile;
    public $env_key;
    public $env_key_hash;
    public $system_resource_constants;
    public $system_output_channel_constants;
    public $device_type = '';
    public $device_type_bit = 0;

    protected $oMessenger_ARRAY = array();
    private static $bitwise_serialization_cnt = 0;
    protected $is_soap_data_tunnel_endpoint = false;
    public $destruct_output = '';
    public $ui_module_state_response_output = '';
    public $soap_data_tunnel_output = '';
    protected $new_serial_log_ARRAY = array();
    protected $wcr_wp_profile_version_key = 'CRNRSTN::WP::INTEGRATIONS';

    private static $lang_content_ARRAY = array();

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

    public function __construct($oCRNRSTN, $oCRNRSTN_ENV){

        //
        // STORE CRNRSTN :: ENVIRONMENTALS
        $this->oCRNRSTN = $oCRNRSTN;
        $this->oCRNRSTN_ENV = $oCRNRSTN_ENV;

        $this->starttime = $oCRNRSTN->starttime;
        $this->env_key = $oCRNRSTN->get_server_env();
        $this->env_key_hash = $oCRNRSTN->get_server_env('hash');

        $this->config_serial_hash = $this->oCRNRSTN_ENV->config_serial_hash;

        $this->destruct_output = $oCRNRSTN_ENV->destruct_output;

        $this->log_silo_profile = $oCRNRSTN_ENV->log_silo_profile;
        $this->system_resource_constants = $oCRNRSTN_ENV->system_resource_constants;
        $this->system_output_channel_constants = $oCRNRSTN_ENV->system_output_channel_constants;
        self::$oLog_ProfileManager = $oCRNRSTN_ENV->return_oLog_ProfileManager();
        self::$oLog_ProfileManager->sync_to_environment(NULL, $oCRNRSTN_ENV, $this);

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(__CLASS__, $this);

//        //
//        // INITIALIZE CRNRSTN :: CHANNEL
//        // WE MOVED THIS TO HTTP_MGR
//        $this->init_channel();
//
//        //
//        // INITIALIZE CRNRSTN :: ERROR HANDLING
//        // WE MOVED THIS TO CRNRSTN ::.
//        $this->initializeErrorHandling();

        //
        // INSTANTIATE CRNRSTN :: SYSTEM EMAIL CONTENT HELPER CLASS
        $this->oCRNRSTN_ASSET_MGR = $oCRNRSTN->oCRNRSTN_ASSET_MGR;

        //
        // INSTANTIATE QUERY SILO
        self::$oSqlSilo = new crnrstn_database_sql_silo($this);

        //
        // INSTANTIATE DATABASE CONNECTION/QUERY/RESPONSE HANDLING INTEGRATIONS CRNRSTN ::
        $this->oCRNRSTN_DATABASE = new crnrstn_database_crnrstn($this);

        //
        // INSTANTIATE QUERY PROFILE MANAGER
        $this->oCRNRSTN_QPM = new crnrstn_query_profile_manager($this);

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

    public function return_openssl_digest_method(){

        return $this->oCRNRSTN_ENV->return_openssl_digest_method();

    }

    private function session_load_complete(){

        //if(!$this->isset_query_result_set_key('CRNRSTN_CACHE_CHECKSUM_TTL_DATA')) {
//
//            $tmp_query = 'SELECT `crnrstn_jony5_content_version_checksums`.`CHECKSUM_PROFILE_ID`,
//                `crnrstn_jony5_content_version_checksums`.`PROGRAM_KEY`,
//                `crnrstn_jony5_content_version_checksums`.`DEVICE_TYPE_CHANNEL`,
//                `crnrstn_jony5_content_version_checksums`.`CONTENT_CHECKSUM_TTL`,
//                `crnrstn_jony5_content_version_checksums`.`TITLE_CHECKSUM`,
//                `crnrstn_jony5_content_version_checksums`.`TITLE_CONTENT`,
//                `crnrstn_jony5_content_version_checksums`.`TITLE_CONTENT_LOCK`,
//                `crnrstn_jony5_content_version_checksums`.`TITLE_CONTENT_LOCK_TTL`,
//                `crnrstn_jony5_content_version_checksums`.`TITLE_CONTENT_LOCK_ISACTIVE`,
//                `crnrstn_jony5_content_version_checksums`.`SOCIAL_CHECKSUM`,
//                `crnrstn_jony5_content_version_checksums`.`SOCIAL_CONTENT`,
//                `crnrstn_jony5_content_version_checksums`.`SOCIAL_CONTENT_LOCK`,
//                `crnrstn_jony5_content_version_checksums`.`SOCIAL_CONTENT_LOCK_TTL`,
//                `crnrstn_jony5_content_version_checksums`.`SOCIAL_CONTENT_LOCK_ISACTIVE`,
//                `crnrstn_jony5_content_version_checksums`.`COLORS_CHECKSUM`,
//                `crnrstn_jony5_content_version_checksums`.`COLORS_CONTENT`,
//                `crnrstn_jony5_content_version_checksums`.`COLORS_CONTENT_LOCK`,
//                `crnrstn_jony5_content_version_checksums`.`COLORS_CONTENT_LOCK_TTL`,
//                `crnrstn_jony5_content_version_checksums`.`COLORS_CONTENT_LOCK_ISACTIVE`,
//                `crnrstn_jony5_content_version_checksums`.`STATS_CHECKSUM`,
//                `crnrstn_jony5_content_version_checksums`.`STATS_CONTENT`,
//                `crnrstn_jony5_content_version_checksums`.`STATS_CONTENT_LOCK`,
//                `crnrstn_jony5_content_version_checksums`.`STATS_CONTENT_LOCK_TTL`,
//                `crnrstn_jony5_content_version_checksums`.`STATS_CONTENT_LOCK_ISACTIVE`,
//                `crnrstn_jony5_content_version_checksums`.`RELAY_CHECKSUM`,
//                `crnrstn_jony5_content_version_checksums`.`RELAY_CONTENT`,
//                `crnrstn_jony5_content_version_checksums`.`RELAY_CONTENT_LOCK`,
//                `crnrstn_jony5_content_version_checksums`.`RELAY_CONTENT_LOCK_TTL`,
//                `crnrstn_jony5_content_version_checksums`.`RELAY_CONTENT_LOCK_ISACTIVE`,
//                `crnrstn_jony5_content_version_checksums`.`REPORTING_CHECKSUM`,
//                `crnrstn_jony5_content_version_checksums`.`REPORTING_CONTENT`,
//                `crnrstn_jony5_content_version_checksums`.`REPORTING_CONTENT_LOCK`,
//                `crnrstn_jony5_content_version_checksums`.`REPORTING_CONTENT_LOCK_TTL`,
//                `crnrstn_jony5_content_version_checksums`.`REPORTING_CONTENT_LOCK_ISACTIVE`,
//                `crnrstn_jony5_content_version_checksums`.`WILDCARD_CHECKSUM`,
//                `crnrstn_jony5_content_version_checksums`.`WILDCARD_CONTENT`,
//                `crnrstn_jony5_content_version_checksums`.`WILDCARD_CONTENT_LOCK`,
//                `crnrstn_jony5_content_version_checksums`.`WILDCARD_CONTENT_LOCK_TTL`,
//                `crnrstn_jony5_content_version_checksums`.`WILDCARD_CONTENT_LOCK_ISACTIVE`,
//                `crnrstn_jony5_content_version_checksums`.`DATEMODIFIED`,
//                `crnrstn_jony5_content_version_checksums`.`DATECREATED`
//            FROM `crnrstn_jony5_content_version_checksums`
//            WHERE `crnrstn_jony5_content_version_checksums`.`PROGRAM_KEY` = "BASSDRIVE"
//            AND (`crnrstn_jony5_content_version_checksums`.`DEVICE_TYPE_CHANNEL` = "DESKTOP"
//            OR `crnrstn_jony5_content_version_checksums`.`DEVICE_TYPE_CHANNEL` = "' . $this->device_type . '") LIMIT 1;';
//            $tmp_result_set_key = $this->load_query_profile('CRNRSTN_SESSION', '!jesus_is_my_dear_lord!', 'CRNRSTN_CACHE_CHECKSUM_TTL_DATA', __LINE__, __METHOD__);
//            $this->add_database_query($tmp_result_set_key, $tmp_query);

     //   }
//
//        $tmp_query = 'SELECT `crnrstn_session`.`SESSION_ID`,
//            `crnrstn_session`.`SERIAL_ID`,
//            `crnrstn_session`.`SERIAL`,
//            `crnrstn_session`.`CLIENT_ID`,
//            `crnrstn_session`.`SERVER_IP`,
//            `crnrstn_session`.`CLIENT_IP`,
//            `crnrstn_session`.`DEVICE_TYPE_CONSTANT`,
//            `crnrstn_session`.`DEVICE_TYPE`,
//            `crnrstn_session`.`HTTP_USER_AGENT`,
//            `crnrstn_session`.`ACCEPT_LANGUAGE`,
//            `crnrstn_session`.`HTTP_REFERER`,
//            `crnrstn_session`.`DATEMODIFIED`,
//            `crnrstn_session`.`DATECREATED`
//        FROM `crnrstn_session`
//        WHERE `crnrstn_session`.`SESSION_ID` = "' . session_id() . '"
//        AND `crnrstn_session`.`SESSION_ID_CRC32` = ' . $this->crcINT(session_id()) . '
//        AND `crnrstn_session`.`ISACTIVE` = 1 LIMIT 1;';
//        $tmp_result_set_key = $this->load_query_profile('CRNRSTN_SESSION', '!jesus_is_my_dear_lord!', 'CRNRSTN_SESSION_DATA', __LINE__, __METHOD__);
//        $this->add_database_query($tmp_result_set_key, $tmp_query);

        //
        // PROCESS ALL QUERY TO CONNECTION(S)
        $this->process_query();

    }

    public function reset_auth_account(){

        /*
        Sunday May 9, 2021 1000hrs
        REDIRECT ON INVALID GET REQUEST
         - 503 ERROR
         - REDIRECT TO SIGN IN FORM
        */

        //
        // CHECK FOR EXISTING SESSION
        if($this->isset_data_key('CRNRSTN_AUTHORIZED_ACCOUNT_STATUS')){

            $tmp_status = $this->get_session_param('CRNRSTN_AUTHORIZED_ACCOUNT_STATUS');

            if($tmp_status == 'AUTH_ACTIVE'){

                $this->toggle_bit(CRNRSTN_AUTHORIZED_ACCOUNT, false);
                $this->set_session_param('CRNRSTN_AUTHORIZED_ACCOUNT_STATUS', 'LOGGED_OUT');

                if($this->isset_data_key('CRNRSTN_AUTHORIZED_ACCOUNT')){

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

    public function return_wcr_wp_key($profile_key_override = NULL){

         if(isset($profile_key_override)){

             $this->wcr_wp_profile_version_key = $profile_key_override;

         }

         return $this->wcr_wp_profile_version_key;

    }

    public function return_admin_ARRAY(){

        return $this->oCRNRSTN_ENV->return_admin_ARRAY();

    }

    public function update_admin_ARRAY($tmp_array){

        return $this->oCRNRSTN_ENV->update_admin_ARRAY($tmp_array);

    }

    public function __SOAP_service_listen(){

        if(!$this->isset_http_superglobal('GET')){

            error_log(__LINE__ . ' ' . __METHOD__ . ' WE HAVE NO _GET....');
            //if($oCRNRSTN_USR->exclusiveAccess('184.173.96.66, 50.87.249.11, 172.16.110.130, 172.16.*')){

            //$server->service(file_get_contents('php://input'));

            //}else{

            //    $oCRNRSTN_USR->return_server_response_code(403);

            //}

            //$this->print_r(file_get_contents('php://input'));


        }else{

            error_log(__LINE__ . ' ' . __METHOD__ . ' WE HAVE _GET....');

//            if($this->http){
//
//
//            }

            $this->print_r(file_get_contents('php://input'),'SOAP LISTENER TEST',NULL, __LINE__,__METHOD__,__FILE__);
            //$server->service(file_get_contents('php://input'));

        }

        //$this->print_r("die();");
        //error_log(__LINE__ . ' ' . __METHOD__ . ' WE HAVE die()....');

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

                    $tmp_str .= $siloKey . ', ';

                }

                $tmp_str = rtrim($tmp_str,', ');

                return $tmp_str;

            break;

        }

    }

    public function return_SOAP_SVC_debugMode(){

        return $this->oCRNRSTN_ENV->return_SOAP_SVC_debugMode();

    }

//
//    private function compile_form_integration_packet($crnrstn_form_handle, $field_input_name, $encryption_status = TRUE, $server_side_validation = NULL){
//
//        //
//        // DATA PROFILE FOR SUCCESSFUL CRNRSTN FORM CAPTURE INTEGRATION
//        # COMPILE TIMESTAMP (SERVER) 1 - 1
//        # FORM HANDLE 1 - 1              $crnrstn_form_handle
//        # FORM TUNNEL PROTOCOL 1 - 1  self::$form_handle_ARRAY[$crnrstn_form_handle]
//        # ALL INPUT NAME 1 - n
//        # INPUT ENCRYPTION STATUS FOR HIDDEN FIELDS 1 - n
//        # SERVER-SIDE VALIDATION STRING FOR DATA TREATMENT 1 - n
//
//        // self::$formIntegrationPacket_ARRAY['timestamp']
//        // self::$formIntegrationPacket_ARRAY['crnrstn_form_handle'] = $crnrstn_form_handle;
//        // self::$formIntegrationPacket_ARRAY['transport_protocol'] = self::$form_handle_ARRAY[$crnrstn_form_handle]
//        // self::$formIntegrationPacket_ARRAY['input_name'][n] =
//        // self::$formIntegrationPacket_ARRAY['input_encrypt'][n] =
//        // self::$formIntegrationPacket_ARRAY['input_validation'][n] =
//
//        if (!isset(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['timestamp'])) {
//
//            self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['timestamp'] = $this->oLogger->returnMicroTime();
//
//        }
//
//        if (!isset(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['crnrstn_form_handle'])) {
//
//            self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['crnrstn_form_handle'] = $crnrstn_form_handle;
//
//        }
//
//        if (!isset(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['transport_protocol'])) {
//
//            self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['transport_protocol'] = self::$form_handle_ARRAY[$crnrstn_form_handle];
//
//        }
//
//        if (!isset(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['integration_packet_encrypt'])) {
//
//            self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['integration_packet_encrypt'] = 'true';
//
//        }
//
//        self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['input_name'][] = $field_input_name;
//
//        if ($encryption_status) {
//
//            $encryption_status = 'true';
//
//        } else {
//
//            $encryption_status = 'false';
//
//        }
//
//        self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['input_encrypt'][] = $encryption_status;
//
//        if (!isset($server_side_validation)) {
//
//            $server_side_validation = 'false';
//
//        }
//
//        self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['input_validation'][] = $server_side_validation;
//
//    }
//
//    private function return_form_integration_packet($crnrstn_form_handle){
//
//        $tmp_html_out = '';
//        $tmp_html_out .= $this->concatIntegrationPacketDatum(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['timestamp']);
//        $tmp_html_out .= $this->concatIntegrationPacketDatum(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['crnrstn_form_handle']);
//        $tmp_html_out .= $this->concatIntegrationPacketDatum(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['transport_protocol']);
//
//        $tmp_input_cnt = sizeof(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['input_name']);
//        for ($i = 0; $i < $tmp_input_cnt; $i++) {
//
//            $tmp_html_out .= $this->concatIntegrationPacketDatum($i, ":");
//            $tmp_html_out .= $this->concatIntegrationPacketDatum(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['input_name'][$i], ":");
//            $tmp_html_out .= $this->concatIntegrationPacketDatum(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['input_encrypt'][$i], ":");
//            $tmp_html_out .= $this->concatIntegrationPacketDatum(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['input_validation'][$i], ":");
//
//            $tmp_html_out = rtrim($tmp_html_out, ':');
//
//            //self::$formIntegrationPacket_ARRAY['input_name']
//            //self::$formIntegrationPacket_ARRAY['input_encrypt']
//            //self::$formIntegrationPacket_ARRAY['input_validation']
//
//            $tmp_html_out = $this->concatIntegrationPacketDatum($tmp_html_out);
//
//            # <input type="hidden" name="crnrstn_pssdtl_packet" value="">
//            /*
//
//            value="TIMESTAMP[CRNRSTN::2.0.0]FORM_HANDLE[CRNRSTN::2.0.0]TUNNEL_PROTOCOL[CRNRSTN::2.0.0]
//            0:input_name:input_encrypt:input_validation[CRNRSTN::2.0.0]
//            1:input_name:input_encrypt:input_validation[CRNRSTN::2.0.0]
//            2:input_name:input_encrypt:input_validation[CRNRSTN::2.0.0]
//            3:input_name:input_encrypt:input_validation[CRNRSTN::2.0.0]
//            n:input_name:input_encrypt:input_validation[CRNRSTN::2.0.0]"
//
//             * */
//
//        }
//
//        $tmp_encrypted_flag = false;
//        $tmp_html_out = rtrim($tmp_html_out, '[CRNRSTN::2.0.0]');
//        if (self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['packet_encryption_status'] == 'true') {
//
//            $tmp_html_out = $this->oCRNRSTN_ENV->data_encrypt($tmp_html_out);
//
//            if ($tmp_html_out != "") {
//
//                $tmp_encrypted_flag = true;
//
//            }
//
//        }
//
//        $tmp_html_out = '<input type="hidden" name="crnrstn_pssdtl_packet" value="' . $tmp_html_out . '">';
//
//        if ($tmp_encrypted_flag) {
//            $tmp_html_out .= '<input type="hidden" name="crnrstn_pssdtl_packet_ENCRYPTED" value="true">';
//
//        }
//
//        return $tmp_html_out;
//
//    }
//
//    /**
//     * Retrieves an environmental lorem of the ipsum.. If it doesn't exist, no exception/error is caused.
//     * Simply Dolor Amet is returned.
//     *
//     * Note ::
//     *
//     * @param string $resource_key The resource key.
//     * @return string|null|mixed The Lorem of the Ipsum.
//     * @access   private
//     */
//    public function return_err_data_validation_check($transport_protocol = 'POST'){
//
//        $tmp_null_array = array();
//
//        $http_protocol = strtoupper($transport_protocol);
//        $http_protocol = $this->str_sanitize($http_protocol, 'http_protocol_simple');
//
//        if (isset(self::$formIntegrationErr_ARRAY[$http_protocol])) {
//
//            if (sizeof(self::$formIntegrationErr_ARRAY[$http_protocol]) > 0) {
//
//                return self::$formIntegrationErr_ARRAY[$http_protocol];
//
//            } else {
//
//                return $tmp_null_array;
//
//            }
//
//        } else {
//
//            return $tmp_null_array;
//
//        }
//
//    }

    // SOURCE :: https://www.php.net/manual/en/function.parse-url.php
    // AUTHOR :: ivijan dot stefan at gmail dot com :: https://www.php.net/manual/en/function.parse-url.php#114704
    public function return_youtube_embed($url, $width = 560, $height = 315, $fullscreen = true){

        parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
        $youtube= '<iframe allowtransparency="true" scrolling="no" width="' . $width . '" height="' . $height . '" src="//www.youtube.com/embed/' . $my_array_of_vars['v'] . '" frameborder="0"' . ($fullscreen?' allowfullscreen':NULL) . '></iframe>';

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

            $tmp_return_str .= $param_concatenator . 'crnrstn_encrypt_tunnel=' . urlencode($this->oCRNRSTN_ENV->data_encrypt($tmp_encrypted_params_pipe));

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

                    $tmp_str .= urlencode($this->oCRNRSTN_ENV->data_encrypt($tmp_array[1]));

                }else{

                    $tmp_str .= $tmp_array[1];

                }

            }else{

                $tmp_str .= $this->oCRNRSTN_ENV->data_encrypt('');

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

    public function pretty_elapsed_time(){

        $tmp_runtime = $this->wall_time();
        $tmp_microsecs_explode = explode(".", $tmp_runtime);

        return $this->return_pretty_delta_time($tmp_runtime, $tmp_microsecs_explode[1], 'ELAPSED_VERBOSE');

    }

//    public function return_crnrstn_language_manager($header_language_attribute = null){
//
//        return $this->oCRNRSTN_ENV->return_crnrstn_language_manager($this, $header_language_attribute);
//
//    }

    public function init_session(){

        //$this->oCRNRSTN_ENV->init_session($this);
        //$this->oCRNRSTN_ENV->oSESSION_MGR->init_session();

        error_log(__LINE__ . ' user ' . __METHOD__ . '() WHY AM I RUNNING? die();');
        die();
    }

    private function system_setting_jpg_image_quality(){

        //
        // 0 = worst / smaller file, 100 = better / bigger file
        return $this->oCRNRSTN_ENV->system_setting_jpg_image_quality;

    }

    private function system_filename_convert_jpg_to_png($file_path){

        $tmp_is_jpg = false;

        //$this->oCRNRSTN_ASSET_MGR = new

        //
        // NEED TO RETURN PNG FILE PATH FROM THIS INPUT STRING (WHICH SHOULD BE TO A JPG IMAGE FILE)
        if(stripos($file_path, '.jpeg') !== false || stripos($file_path, '.jpg') !== false){

            //
            // WE HAVE .JPEG
            $tmp_is_jpg = true;

            //
            // ONLY WORKING WITH SYSTEM JPG FILES
            if(is_file($file_path)){

                //
                // STRING PARSE NINJA BACKFLIP INTO PNG FILE PATH FROM JPG/JPEG
                $tmp_cleaned_ext_file_path = $this->oCRNRSTN->strrtrim($file_path, '.jpg');

                if(strlen($tmp_cleaned_ext_file_path) == strlen($file_path)){

                    $tmp_cleaned_ext_file_path = $this->oCRNRSTN->strrtrim($tmp_cleaned_ext_file_path, '.jpeg');

                }

                $tmp_cleaned_file_path_png = $tmp_cleaned_ext_file_path . '.png';

                //
                // VERIFY PNG FILE IS A FILE.
                if(is_file($tmp_cleaned_file_path_png)){

                    return $tmp_cleaned_file_path_png;

                }

            }

        }

        return '';

    }

    // Fri, July 29, 2022 1207hrs
    // TAKE UP ARMS AND FIGHT, SON!
    // public function base64_asset_path_listener(){
//    public function ___system_link_reset_jpeg_from_png($crnrstn_png = 'I AM NOT A FILE'){
//
//        $tmp_is_png = false;
//        $tmp_is_jpg = false;
//        $crnrstn_jpg = $tmp_png_filepath = $this->oCRNRSTN_ENV->data_decrypt($crnrstn_png, CRNRSTN_ENCRYPT_TUNNEL, 'GET');
//
//        //crnrstn_resource_filecache_version
//        $tmp_filename = $this->return_form_submitted_value('crnrstn_image_to_process_name');
//
//        if(strlen($tmp_filename) > 2){
//
//            if(stripos($tmp_filename, '.png') !== false || $tmp_png_filepath != ''){
//
//                //
//                // WE HAVE .PNG
//                $tmp_is_png = true;
//                $crnrstn_png = $tmp_filename;
//
//                if($tmp_png_filepath != ''){
//
//                    $crnrstn_png = $tmp_png_filepath;
//
//                }
//
//                $_SESSION['CRNRSTN_' . $this->config_serial_hash]['CRNRSTN_EXCEPTION_PREFIX'] = 'system_link_reset_jpeg_from_png() attempting to create image file ' . $crnrstn_jpg . ' from source: ' . $crnrstn_png . '. ';
//
//
//                error_log(__LINE__ . ' user ' . __METHOD__ . ':: attempting to create image file ' . $crnrstn_jpg . ' from source: ' . $crnrstn_png . '. die();');
//                die();
//
//
//                //
//                // SOURCE :: https://stackoverflow.com/questions/1201798/use-php-to-convert-png-to-jpg-with-compression
//                // AUTHOR :: Daniel De LeónDaniel De León :: https://stackoverflow.com/users/980442/daniel-de-le%c3%b3n
////                $image = imagecreatefrompng($crnrstn_png);
////                $bg = imagecreatetruecolor(imagesx($image), imagesy($image));
////                imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
////                imagealphablending($bg, TRUE);
////                imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
////                imagedestroy($image);
////                $quality = $this->system_setting_jpg_image_quality(); // 0 = worst / smaller file, 100 = better / bigger file
////                imagejpeg($bg, $crnrstn_jpg . ".jpg", $quality);
////                imagedestroy($bg);
//
//            }
//
//            if($tmp_is_jpg){
//
//
//            }
//
//        }
//
//        $tmp_file_path = $this->get_resource('DOCUMENT_ROOT') . $this->get_resource('DOCUMENT_ROOT_DIR') . '/_crnrstn/ui/imgs/jpg/' . $tmp_filename;
//
//    }

    public function return_form_submitted_value($getpost_input_name, $transport_protocol = NULL){

        return $this->oCRNRSTN_ENV->return_form_submitted_value($getpost_input_name, $transport_protocol);

    }

    private function system_link_reset_base64_from_png($base64_encode = 'I AM NOT BASE64', $filepath = NULL, $filetype = NULL){

        $file_extension_jpg = $file_extension_png = $tmp_filetype = $filetype;

        $tmp_crnrstn_png = $this->oCRNRSTN_ENV->data_decrypt($filepath);
        $tmp_filename_POST = $this->return_form_submitted_value('crnrstn_image_to_process_name');
        $this->error_log('CRNRSTN :: system_link_reset_base64_from_png() WE HAVE A FILE OR SOMETHING ACTUALLY MADE IT THROUGH CRNRSTN :: OPENSSL DECRYPTION.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('CRNRSTN :: system_link_reset_base64_from_png[Input Type:' . $filetype . '. base64_len(' . strlen($base64_encode) . ')' . $tmp_crnrstn_png . ']', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        if(!isset($tmp_filetype)){

            $file_extension_jpg = $file_extension_png = pathinfo($tmp_crnrstn_png, PATHINFO_EXTENSION);
            //$tmp_filetype = '.png;base64,';

        }
        //die();

        //if($this->isset_http_param($this->oCRNRSTN_ENV->data_decrypt($this->get_resource('CRNRSTN_SYSTEM_DATA_GET'), CRNRSTN_ENCRYPT_TUNNEL, 'GET'))){

        //$tmp_filename = $this->oCRNRSTN_ENV->data_decrypt($tmp_filename);

        if($base64_encode == 'I AM NOT BASE64'){

            $tmp_filetype = strtolower($tmp_filetype);
            //if($tmp_filetype == '.png;base64,'){

            //
            // WE NEED TO ATTEMPT TO EXTRACT BASE64 FROM THE (ASSUMED) PARENT PNG FILE, IF THE STRING RECEIVED
            // CAN EVEN BE TRACED TO AN EXISTING PNG FILE.
            // 1/PNG-2/JPG-3/BASE64
            $tmp_is_png = false;
            $tmp_is_jpg = false;
            $crnrstn_jpg = $tmp_crnrstn_png;

            //crnrstn_resource_filecache_version

            //
            // DO WE WANT TO USE UGC POST VALUE AS A CHECK HERE? THIS METHOD IS PRIVATE.
            if(stripos($tmp_crnrstn_png, '.png') !== false || $tmp_filename_POST != ''){

                //
                // WE HAVE .PNG (OR UGC TO CHECK AT THE LEAST)
                $filetype = '';
                $tmp_is_png = true;
                $crnrstn_png = $tmp_crnrstn_png;

                if($tmp_filename_POST != ''){

                    $crnrstn_png = $tmp_filename_POST;

                    //
                    // SO THAT I CAN BE LAZY AND TRUNCATE FILE EXTENSION DURING MY UGC TESTING
                    if(stripos($crnrstn_png, '.png') === false){

                        $crnrstn_png = $crnrstn_png . '.png';

                    }

                    if(!is_file($crnrstn_png)){

                        $crnrstn_png = $this->get_resource('DOCUMENT_ROOT') . $this->get_resource('DOCUMENT_ROOT_DIR') . '/_crnrstn/ui/imgs/png/' . $crnrstn_png;

                    }

                }

                if(is_file($crnrstn_png)){

                    //
                    // BASE64 THIS PNG
                    error_log(__LINE__ . ' user ' . __METHOD__ . ':: attempting to open image file ' . $crnrstn_png . ', ' . $this->find_filesize($crnrstn_png) . ' bytes. ');
                    $_SESSION['CRNRSTN_' . $this->config_serial_hash]['CRNRSTN_EXCEPTION_PREFIX'] = 'system_link_reset_jpeg_from_png() attempting to open image file ' . $crnrstn_png . ', ' . $this->find_filesize($crnrstn_png) . ' bytes. ';
                    $img_binary = fread(fopen($crnrstn_png, 'r'), $this->find_filesize($crnrstn_png));
                    $mime_content_type_png = mime_content_type($img_binary);
                    $md5_png = md5_file($img_binary);
                    $sha1_png = sha1_file($img_binary);
                    $base64_encode_png = 'data:image/' . $filetype . ';base64,' . base64_encode($img_binary);

                    //
                    // STRING PARSE NINJA BACKFLIP INTO PNG FILE PATH FROM JPG/JPEG
                    // SOURCE :: https://stackoverflow.com/questions/3967515/how-to-convert-an-image-to-base64-encoding
                    // AUTHOR :: Ronny Sherer :: https://stackoverflow.com/users/380561/ronny-sherer
                    //$type = pathinfo($crnrstn_jpg, PATHINFO_EXTENSION);
                    //$data = file_get_contents($crnrstn_jpg);
                    //$base64_jpg = 'data:image/' . $type . ';base64,' . base64_encode($data);

                }

            }

            //
            // I DON'T EXPECT THIS TO RUN. BUT IF ADMIN/APPLICATION HANDLES JPG OUTSIDE
            // CRNRSTN :: ARCHITECTURE'S TARGET SCOPE (HOW I USE THE TOOL), WE CAN HANDLE IT.
            if(((stripos($crnrstn_jpg, '.jpeg') !== false || stripos($crnrstn_jpg, '.jpg') !== false) && !$tmp_is_png) || ($tmp_filename_POST != '' && !$tmp_is_png)){

                if($tmp_filename_POST != ''){

                    $crnrstn_jpg = $tmp_filename_POST;

                    //
                    // SO THAT I CAN BE LAZY AND TRUNCATE FILE EXTENSION DURING MY UGC TESTING
                    if(stripos($crnrstn_jpg, '.jpg') === false && stripos($crnrstn_jpg, '.jpeg') === false){

                        $crnrstn_jpg = $crnrstn_jpg . '.jpg';

                    }

                    if(!is_file($crnrstn_jpg)){

                        $crnrstn_jpg = $this->get_resource('DOCUMENT_ROOT') . $this->get_resource('DOCUMENT_ROOT_DIR') . '/_crnrstn/ui/imgs/jpg/' . $crnrstn_jpg;

                    }

                }

                //
                // VERIFY JPG FILE IS A FILE.
                if(is_file($crnrstn_jpg)){

                    //
                    // WE HAVE A JPG
                    $tmp_is_jpg = true;

                    //
                    // STRING PARSE NINJA BACKFLIP INTO PNG FILE PATH FROM JPG/JPEG
                    // SOURCE :: https://stackoverflow.com/questions/3967515/how-to-convert-an-image-to-base64-encoding
                    // AUTHOR :: Ronny Sherer :: https://stackoverflow.com/users/380561/ronny-sherer
                    $file_extension_jpg = pathinfo($crnrstn_jpg, PATHINFO_EXTENSION);
                    $img_binary = fread(fopen($crnrstn_jpg, 'r'), $this->find_filesize($crnrstn_jpg));
                    $mime_content_type_jpg = mime_content_type($img_binary);
                    $md5_jpg = md5_file($img_binary);
                    $sha1_jpg = sha1_file($img_binary);
                    $base64_encode_jpg = 'data:image/' . $file_extension_jpg . ';base64,' . base64_encode($img_binary);


                    //
                    // BASE64 THIS JPG IF CURRENT BASE64 IS DIFFERENT.
                    @include($this->get_resource('DOCUMENT_ROOT') . $this->get_resource('DOCUMENT_ROOT_DIR') . '/_crnrstn/ui/imgs/png/' . $tmp_filename);

                    //$this->assetParams['FILE_MD5'] = md5_file($_FILES["assetfile"]["tmp_name"]);  // 32
                    //$this->assetParams['FILE_SHA1'] = sha1_file($_FILES["assetfile"]["tmp_name"]);  // 40
                }


            }

            $tmp_file_path = $this->get_resource('DOCUMENT_ROOT') . $this->get_resource('DOCUMENT_ROOT_DIR') . '/_crnrstn/ui/imgs/jpg/' . $tmp_filename;


            //}

            $tmp_pos_png = stripos($tmp_filename_POST, $tmp_filetype);
            if ($tmp_pos_png === false) {

                //
                // THIS IS JUST SO I CAN BE LAZY WITH UGC AND CAN EXCLUDE FILE
                // EXTENSION ON .PNG base64 CHECKS (NOW base64 UPDATES).
                $tmp_filename_POST = $tmp_filename_POST . $tmp_filetype;

            }

        }

        //
        // CONFIRM BASE64 ENCODING WITH PROVIDED FILE

        $tmp_file_path = $this->get_resource('DOCUMENT_ROOT') . $this->get_resource('DOCUMENT_ROOT_DIR') . '/_crnrstn/ui/imgs/base64/' . $tmp_filename_POST;

        if(is_file($tmp_file_path)){

            $tmp_str = '';

            //
            // $tmp_str = 'data:image/png;base64,iVBORw0KGgoAAA...geWQ====';
            @include_once($this->get_resource('DOCUMENT_ROOT') . $this->get_resource('DOCUMENT_ROOT_DIR') . '/_crnrstn/ui/imgs/base64/' . $tmp_filename);

            //
            // WRITE THE FILE HERE IF DIFFERENT
            if($base64_encode !== $tmp_str){

                $this->error_log('CRNRSTN :: THERE IS A base64 CONTENT MISMATCH FOR php FILE [' . $tmp_file_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
                $this->error_log('CRNRSTN :: WE NEED TO RE-WRITE/WRITE base64 php FILE [' . $tmp_file_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                $tmp_file_input_str = '';

                //
                // BASE64 FILE HEADER :: July 30, 2022 @ 1908 hrs
                $tmp_file_input_str .= '/*
<?php
/* 
// J5
// Code is Poetry *
CRNRSTN :: v' . $this->version_crnrstn() . '

FILE_NAME: ' . $tmp_file_path . '
DATE GENERATED: ' . $this->return_micro_time() . '
SERVER IP: ' . $_SERVER['SERVER_ADDR'] . '
CLIENT IP: ' . $this->return_client_ip() . ' (' . $_SERVER['REMOTE_ADDR']. ')
PHPSESSION: ' . session_id(). '

' . $this->return_CRNRSTN_ASCII_ART(0) . '

';

                //
                // WE HAVE $base64_encode_png AND $base64_encode_jpg TO CHECK AGAINST THE BASE64 $TMP_STR[] SITUATION
                // THAT YOU SAID YOU'D TAKE CARE OF, REAL QUICK.
                if($tmp_is_png){

                    $tmp_file_input_str .= '
ORIGINAL FILE ::
FILE EXTENSION: ' . $file_extension_png . '
FILE MIME TYPE: ' . $mime_content_type_png . '
FILE PATH: ' . $tmp_file_path . '
FILE MD5: ' . $md5_png . '
FILE SHA1: ' . $sha1_png . '
FILE BASE64: ' . $base64_encode_png . '
PROFILE ACCESS: ANONYMOUS
ACCESS TYPE: SYSTEM LEVEL ACCESS
';

                    }

                //
                // WE HAVE $base64_encode_png AND $base64_encode_jpg TO CHECK AGAINST THE BASE64 $TMP_STR[] SITUATION
                // THAT YOU SAID YOU'D TAKE CARE OF, REAL QUICK.
                if($tmp_is_jpg){

                    $tmp_file_input_str .= '
ORIGINAL FILE ::
FILE EXTENSION: ' . $file_extension_jpg . '
FILE MIME TYPE: ' . $mime_content_type_jpg . '
FILE PATH: ' . $tmp_file_path . '
FILE MD5: ' . $md5_jpg. '
FILE SHA1: ' . $sha1_jpg . '
FILE BASE64: ' . $base64_encode_jpg . '
PROFILE ACCESS: ANONYMOUS
ACCESS TYPE: SYSTEM LEVEL ACCESS
';

                }
                /*
                //
                // July 31, 2022 @ 0259 hrs :: EVIFWEB IP INTEGRATIONS FOR (PNG/JPG)BASE64 .PHP FILE MANAGEMENT
                $tmp_client_dir = substr(self::$oUser->retrieve_Form_Data("CLIENT_ID"), 0, -25);
                $tmp_assetSerial = self::$oUser->generateNewKey(50);

                $tmp_name = explode(\'.\', $_FILES[\'assetfile\'][\'name\']);

                $this->assetParams[\'FILE_EXT\'] = strtolower(array_pop($tmp_name));
                $this->assetParams[\'FILE_MIME_TYPE\'] = mime_content_type($_FILES["assetfile"]["tmp_name"]);
                $this->assetParams[\'FILE_MD5\'] = md5_file($_FILES["assetfile"]["tmp_name"]);  // 32
                $this->assetParams[\'FILE_SHA1\'] = sha1_file($_FILES["assetfile"]["tmp_name"]);  // 40
                error_log("assetmgr (954) sha1[".$this->assetParams[\'FILE_SHA1\']."] len[".strlen($this->assetParams[\'FILE_SHA1\'])."]");

                */

                $tmp_file_input_str .= '*/
';

                //
                // CHECK DISK CAPACITY BEFORE ANY WRITE (LIKE 20%...SO..MAYBE AT MOST 80%, DUDE. FOR SURE...NOT 100)
                error_log(__LINE__ . ' user fwrite(w).' . __METHOD__ . '::[' . print_r($tmp_file_input_str, true).']. die();');
                die();

                //
                // VALIDATE FILE PATH ON FILE OPEN FOR APPEND
                if($fp = fopen($tmp_file_path, 'w')){

                    //fwrite($fp, $tmp_file_input_str);
                    //fclose($fp);

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    //throw new Exception('Un.');
                    $this->error_log('[SYSTEM_BASE64] UNABLE TO WRITE FILE [' . $tmp_file_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                }

            }

        }

    }

    private function ______user_request_listener(){

        //
        // ENABLE THIS PAGE TO RECEIVE HTTP POST/GET DATA
        if($this->oCRNRSTN->http_data_services_initialize()) {

            if($this->isset_crnrstn_services_http()){

                //
                // LOGIN SUCCESS PATHWAY
                $tmp_form_handle = $this->extract_data_HTTP('crnrstn_pssdtl_packet', 'POST', true);
                switch($tmp_form_handle){
                    case 'signin':

                        error_log(__LINE__ . ' user die() :: LOGIN SUCCESS PATHWAY [' . $tmp_form_handle . ']');

                        die();

                    break;
                    case 'crnrstn_validate_css':

                        error_log(__LINE__ . ' user :: CSS VALIDATOR PATHWAY [' . $tmp_form_handle . ']');

                        //
                        // VALIDATE CSS
                        $raw_html_data = $this->extract_data_HTTP('ugc_html', 'POST');

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

                            $tmp_post_uri = $tmp_post_uri . '&crnrstn_l=' . $this->oCRNRSTN->data_encrypt('css_validator') . '&crnrstn_css_rtime=' . urlencode($tmp_run_time) . '&bytes=' . urlencode($tmp_packet_size) . '&score=' . urlencode($tmp_score_numeric_raw);

                        } else {

                            $tmp_post_uri = $tmp_post_uri . '?crnrstn_l=' . $this->oCRNRSTN->data_encrypt('css_validator') . '&crnrstn_css_rtime=' . urlencode($tmp_run_time) . '&bytes=' . urlencode($tmp_packet_size) . '&score=' . urlencode($tmp_score_numeric_raw);

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
                error_log(__LINE__ . ' user :: LOGIN ERROR PATHWAY');

                //
                // FORM INPUT ERROR HANDLING. CAN MANUALLY HANDLE REDIRECTS HERE IF DESIRED.
                $tmp_err_array = $this->return_err_data_validation_check('POST');
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
                $tmp_err_array = $this->return_err_data_validation_check('GET');
                //$test = '';

                foreach($tmp_err_array as $key => $val){

                    $test .= $val . '<br>';

                }

                $test .= '<br>' . session_id() . '<br>';

                error_log(__LINE__ . ' user error=' . $test);

            }

        }else{

            error_log(__LINE__ . ' user :: HTTP VAR PROCESSING :: NON-FORM-INTEGRATION PATHWAY');
            return $this->oCRNRSTN_VSC->return_client_response();

//
//                if($this->oCRNRSTN_ENV->oHTTP_MGR->issetParam($_GET, 'crnrstn_l')){
//
//                    if($this->oCRNRSTN_ENV->oHTTP_MGR->issetParam($_GET, 'crnrstn_css_rtime')){
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
//            if($this->isset_http_param('crnrstn_l', 'GET')){
//
//                $tmp_req = $this->extract_data_HTTP('crnrstn_l', true);
//                $tmp_mit = $this->extract_data_HTTP('crnrstn_mit');
//                //$tmp_crnrstn_kivotos = $this->extract_data_HTTP('crnrstn_kivotos');
//                $tmp_crnrstn_css_rtime = $this->extract_data_HTTP('crnrstn_css_rtime');
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
//                        error_log(__LINE__ . ' crnrstn_css_rtime is set. get_session_param() results[' . strlen($tmp_validation_results) . ']');
//
//                        if(strlen($tmp_validation_results) > 1){
//
//                            $this->set_session_param('CRNRSTN_CSS_VALIDATION_RESP','0');
//
//                            //
//                            // RETURN CSS VALIDATION SCORE RESULTS PAGE
//                            header('Content-type: text/html; charset=utf-8');
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
//                            if($this->isset_http_param('crnrstn_r', 'GET')){
//
//                                $this->proper_response_return($this->sticky_uri_listener(), NULL, 'RESPONSE_STICKY');
//
//                            }else{
//
//                                if(strlen($tmp_crnrstn_css_rtime) > 0){
//
//                                    $tmp_validation_results = $this->get_session_param('CRNRSTN_CSS_VALIDATION_RESP');
//                                    error_log(__LINE__ . ' crnrstn_css_rtime is set. get_session_param results[' . strlen($tmp_validation_results) . ']');
//
//                                    if(strlen($tmp_validation_results) > 1){
//
//                                        $this->set_session_param('CRNRSTN_CSS_VALIDATION_RESP','0');
//
//                                        //
//                                        // VALIDATION SCORE RESULTS PAGE
//                                        header('Content-type: text/html; charset=utf-8');
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
//                                    if($this->isset_http_param('crnrstn_css_valptrn', 'GET')){
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

        if($this->isset_data_key('CRNRSTN_AUTHORIZED_ACCOUNT')) {

            error_log(__LINE__ . ' user ' . __METHOD__ . ':: running some untested lab shit, I see...die();');
            die();
            $this->oCRNRSTN_AUTH = $this->get_session_param('CRNRSTN_AUTHORIZED_ACCOUNT');

        }else{

            if(isset($this->oCRNRSTN_AUTH)){

                error_log(__LINE__ . ' user ' . __METHOD__ . ':: running some untested lab shit, I see...die();');
                die();

                $this->oCRNRSTN_AUTH = new crnrstn_user_auth($this);

            }

        }

    }

    public function sync_device_detected(){

        return $this->oCRNRSTN_ENV->sync_device_detected();

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

                            for($i = 0; $i < $tmp_cnt; $i++) {

                                $this->ui_module_state_response_output .= $i . ' [' . self::$formIntegrationIcon_ARRAY['GET'][$i] . '] [' . self::$formIntegrationErr_ARRAY['GET'][$i] . ']<br>';

                            }

                        }

                    }

                break;
                case 'P':

                    if(isset(self::$formIntegrationIsset_ARRAY['POST'])){

                        if(isset(self::$formIntegrationErr_ARRAY['POST'])){

                            $tmp_cnt = count(self::$formIntegrationErr_ARRAY['POST']);

                            for($i = 0; $i < $tmp_cnt; $i++) {

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

        $module = strtolower($module);

        switch($module){
            case 'documentation':

                //$this->oCRNRSTN_UX->sync_back_link_state();
                return $this->oCRNRSTN->oCRNRSTN_UI_HTML_MGR->out_ui_html_doc_documentation();

            break;
            case 'bassdrive_inject':

                return $this->oCRNRSTN->oCRNRSTN_UI_HTML_MGR->out_ui_html_inject_bassdrive();

            break;
            case 'bassdrive_popup':

                return $this->oCRNRSTN->oCRNRSTN_UI_HTML_MGR->out_ui_html_doc_bassdrive_popup();

            break;
            case 'signin':

                $this->oCRNRSTN_UX->sync_back_link_state();

                return $this->oCRNRSTN->oCRNRSTN_UI_HTML_MGR->out_ui_html_doc_signin();

            break;
            case 'signin_m':

                $this->oCRNRSTN_UX->sync_back_link_state();

                return $this->oCRNRSTN->oCRNRSTN_UI_HTML_MGR->out_ui_html_doc_signin_m();

            break;
            case 'mit_license':

                //$this->oCRNRSTN_UX->sync_back_link_state();

                return $this->oCRNRSTN->oCRNRSTN_UI_HTML_MGR->out_ui_html_doc_mit_license();

            break;
            case 'css_validator':

                $this->oCRNRSTN_UX->sync_back_link_state();

                return $this->oCRNRSTN->oCRNRSTN_UI_HTML_MGR->out_ui_html_doc_css_validator();

            break;
            case 'css_validator_profile':

                $this->oCRNRSTN_UX->sync_back_link_state();

                return $this->oCRNRSTN->oCRNRSTN_UI_HTML_MGR->out_ui_html_doc_css_validator_profile();

            break;
            case 'dashboard':

                $this->oCRNRSTN_UX->sync_back_link_state();

                if($this->is_account_valid()){

                    return $this->oCRNRSTN->oCRNRSTN_UI_HTML_MGR->out_ui_html_doc_dashboard();

                }else{

                    return $this->oCRNRSTN->oCRNRSTN_UI_HTML_MGR->out_ui_html_doc_signin();

                }

            break;
            case 'config_wordpress':

                $this->oCRNRSTN_UX->sync_back_link_state();

                error_log(__LINE__ . ' user switch(config_wordpress) get class[' . get_class($this->oCRNRSTN_AUTH) . ']');
                if($this->is_account_valid()){

                    error_log(__LINE__ . ' user switch(config_wordpress) is_valid return true');
                    return $this->oCRNRSTN->oCRNRSTN_UI_HTML_MGR->out_ui_html_doc_config_wordpress();

                }else{

                    error_log(__LINE__ . ' user switch(config_wordpress) is_valid return false');
                    return $this->oCRNRSTN->oCRNRSTN_UI_HTML_MGR->out_ui_html_doc_signin();

                }

            break;
            default:

                return '<html><head><title>DEFAULT switch() case ' . __METHOD__ . '</title></head><body>ui_module_out(' . $module . ') is ready to be setup, good sir.</body></html>';

            break;

        }

    }
    
    public function is_account_valid(){

        if($this->isset_data_key('CRNRSTN_AUTHORIZED_ACCOUNT')){

            error_log(__LINE__ . ' user session set CRNRSTN_AUTHORIZED_ACCOUNT.');
            $this->oCRNRSTN_AUTH = $this->get_session_param('CRNRSTN_AUTHORIZED_ACCOUNT');

            $tmp_account = $this->oCRNRSTN_AUTH->return_account();
            //error_log(__LINE__ . ' user oCRNRSTN_AUTH=[' . get_class($this->oCRNRSTN_AUTH) . '] $tmp_account=[' . get_class($tmp_account) .']');

           //$tmp_account_profile = $tmp_account->return_account();

            //error_log(__LINE__ . ' $tmp_account_profile=[' . get_class($tmp_account) . '][' . $tmp_account->account_get_resource('session_ip_address') . ']');

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

    public function return_oLog_ProfileManager(){

        return self::$oLog_ProfileManager;

    }

    public function output_str_append($str){

        $this->destruct_output = $str;

    }

    public function set_crnrstn_as_err_handler($crnrstn_is_active = true, $error_types_profile = NULL){

        try{

            if(isset($this->oCRNRSTN_ENV->env_key)){

                $this->oCRNRSTN->input_data_value($crnrstn_is_active, 'CRNRSTN_as_err_handler_is_active', NULL, 0, CRNRSTN_AUTHORIZE_RUNTIME_ONLY, NULL);
                $this->oCRNRSTN->input_data_value($error_types_profile, 'CRNRSTN_as_err_handler_profile', NULL, 0, CRNRSTN_AUTHORIZE_RUNTIME_ONLY, NULL);

                if($crnrstn_is_active){

                    $this->error_log('Resetting error handling at this server to the PHP defaults.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);
                    restore_error_handler();

                    if(isset($error_types_profile)) {

                        $this->error_log('Initializing CRNRSTN :: to handle errors at this server per a custom error level constants reporting profile represented as an aggregate by the integer value, ' . $error_types_profile . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);
                        $this->apply_CRNRSTN_asErrorHandler($error_types_profile);

                    }else{

                        $this->error_log('Initializing CRNRSTN :: to handle errors at this server per the default PHP error level constants reporting profile. For PHP 5.3 or later, the default is E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);
                        $this->apply_CRNRSTN_asErrorHandler($error_types_profile);

                    }

                } else {

                    $this->error_log('Resetting error handling at this server to the PHP defaults. For PHP 5.3 or later, the default is E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);
                    restore_error_handler();

                }


                return true;

            }

            //
            // WE DON'T HAVE THE ENVIRONMENT, BUT DETECTION WOULD HAVE ALREADY BEEN COMPLETED.
            //throw new Exception('Unable to process encryption profile for environment [' . self::$server_env_key_hash_ARRAY[$this->config_serial_hash] . '].');
            $this->error_log('Bypassed initialization of CRNRSTN :: as error handler for environment [' . $this->oCRNRSTN_ENV->env_key . '/' . $this->hash($this->oCRNRSTN_ENV->env_key) . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN NOTHING
            return false;

        }

        return false;

    }

    private function apply_CRNRSTN_asErrorHandler($error_types_profile = NULL){

        if(isset($error_types_profile)){

            //
            // SOURCE :: https://stackoverflow.com/questions/1241728/can-i-try-catch-a-warning
            // AUTHOR :: https://stackoverflow.com/users/117260/philippe-gerber
            // SET TO THE USER DEFINED ERROR HANDLER
            $old_error_handler = set_error_handler(function($errno, $errstr, $errfile, $errline, $errcontext) {

                try{

                    // error was suppressed with the @-operator
                    if (0 === error_reporting()) {
                        return false;
                    }

                    $errstr = $_SESSION['CRNRSTN_' . $this->config_serial_hash]['CRNRSTN_EXCEPTION_PREFIX'] . $errstr;
                    $_SESSION['CRNRSTN_' . $this->config_serial_hash]['CRNRSTN_EXCEPTION_PREFIX'] = '';

                    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);

                } catch (Exception $e) {

                    //
                    // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
                    $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

                    return false;

                }

            }, (int) $error_types_profile);

        }else{

            $old_error_handler = set_error_handler(function($errno, $errstr, $errfile, $errline, $errcontext){

                try{

                    // error was suppressed with the @-operator
                    if(0 === error_reporting()){

                        return false;

                    }

                    $errstr = $_SESSION['CRNRSTN_' . $this->config_serial_hash]['CRNRSTN_EXCEPTION_PREFIX'] . $errstr;
                    $_SESSION['CRNRSTN_' . $this->config_serial_hash]['CRNRSTN_EXCEPTION_PREFIX'] = '';

                    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);

                } catch (Exception $e) {

                    //
                    // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
                    $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

                    return false;

                }

            });

        }

        return true;

    }

    /*
    public function proxyEmailFire($WCR_key_email_packet, $endpoint_uri = NULL, $oKingsHighway = NULL){

        if(!isset($endpoint_uri)){

            $endpoint_uri = $this->get_resource('CRNRSTN_PROXY_WSDL_ENDPOINT');

            if($endpoint_uri == ''){

                $endpoint_uri = $this->get_resource('CRNRSTN_PROXY_WSDL_ENDPOINT', $WCR_key_email_packet);

            }

        }

        //
        // SOAP
        $tmp_SOAP_request = $this->return_oKingsHighwaySOAP();

        $soapClient = new crnrstn_soap_client_manager($this,'WSDL_URI','WSDL_CACHE_TTL','NUSOAP_USECURL');

        $response = $soapClient->sendRequest_SOAP('takeTheKingsHighway', $tmp_SOAP_request);

        $tmp_key_raw = urldecode($response['CRNRSTN_SOAP_SVC_AUTH_KEY']);
        $this->error_log('TOTAL_EMAILS_RECEIVED=' . $response['TOTAL_EMAILS_RECEIVED'], __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $this->error_log('CRNRSTN_SOAP_SVC_AUTH_KEY=' . $tmp_key_raw, __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);
        $this->error_log('data_decrypt/true-CRNRSTN_SOAP_SVC_AUTH_KEY=' . $this->oCRNRSTN_ENV->data_decrypt($tmp_key_raw, CRNRSTN_ENCRYPT_TUNNEL, true), __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $this->error_log('377 - returnResult=' . $soapClient->returnResult(), __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $tmp_serial = $this->generate_new_key(10);
        $packet_delimiter = '[CRNRSTN200_' . $tmp_serial . ']';

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
            $tmp_email_packet_datum = $this->oCRNRSTN->data_encrypt($tmp_email_packet_datum, CRNRSTN_ENCRYPT_TUNNEL, $tmp_cipher_override, $tmp_secret_key_override, $tmp_hmac_algorithm_override, $tmp_options_bitwise_override);
            $packet_delimiter = $this->oCRNRSTN->data_encrypt($packet_delimiter, CRNRSTN_ENCRYPT_TUNNEL, $tmp_cipher_override, $tmp_secret_key_override, $tmp_hmac_algorithm_override, $tmp_options_bitwise_override);

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
                'CRNRSTN_SOAP_SVC_AUTH_KEY' => $this->oCRNRSTN->data_encrypt($this->get_resource('CRNRSTN_SOAP_SVC_AUTH_KEY'), CRNRSTN_ENCRYPT_SOAP)
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

        if(isset($this->WSDL_cache_ttl_ARRAY[$this->hash($SOAP_endpoint)])){

            $WSDL_cache_ttl = $this->WSDL_cache_ttl_ARRAY[$this->hash($SOAP_endpoint)];

        }else{

            $WSDL_cache_ttl = $this->get_resource('WSDL_CACHE_TTL', 'CRNRSTN::INTEGRATIONS');

        }

        if(isset($this->nusoap_useCURL_ARRAY[$this->hash($SOAP_endpoint)])){

            $nusoap_useCURL = $this->nusoap_useCURL_ARRAY[$this->hash($SOAP_endpoint)];

        }else{

            $nusoap_useCURL = $this->get_resource('NUSOAP_USECURL', 'CRNRSTN::INTEGRATIONS');

        }

        $this->print_r('[' . $SOAP_endpoint . '][' . $WSDL_cache_ttl . '][' . $nusoap_useCURL . ']', 'SEND CLIENT REQUEST', NULL, __LINE__, __METHOD__, __FILE__);

        //
        // INSTANTIATE SOAP CLIENT
        $this->oSoapClient = new crnrstn_soap_client_manager($this, $SOAP_endpoint, $WSDL_cache_ttl, $nusoap_useCURL);
        $this->print_r('[' . gettype($this->oSoapClient) . '][' . get_class($this->oSoapClient) . '] [' . $SOAP_method . '][' . print_r($SOAP_request, true) . ']', 'SEND CLIENT REQUEST', NULL, __LINE__, __METHOD__, __FILE__);
        //$this->print_r('[' . $SOAP_method . '][' . print_r($SOAP_request, true) . ']', 'SEND CLIENT REQUEST', NULL, __LINE__, __METHOD__, __FILE__);

        return $this->oSoapClient->sendRequest_SOAP($SOAP_method, $SOAP_request);

    }

    public function return_oEmailArraySOAP_struct($email_pipe_delim, $name_pipe_delim = NULL, $cipher_override = NULL, $secret_key_override = NULL, $hmac_algorithm_override = NULL, $options_bitwise_override = NULL){

        $tmp_email_ARRAY = array();

        if(!isset($name_pipe_delim)){

            $pos_pipe = strpos($email_pipe_delim, '|');

            if($pos_pipe === false){

                //
                // SINGLE NAME-EMAIL
                $email_pipe_delim = trim($email_pipe_delim);
                $pos_space = strpos($email_pipe_delim, ' ');

                if($pos_space === false){

                    $tmp_email_pipe_delim_hash = $this->hash($email_pipe_delim);

                    array_push($tmp_email_ARRAY, array(
                        'EMAIL_PROXY_SERIAL' => $this->oCRNRSTN_ENV->data_encrypt($tmp_email_pipe_delim_hash, CRNRSTN_ENCRYPT_SOAP, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                        'EMAILADDRESS' => $this->oCRNRSTN_ENV->data_encrypt($email_pipe_delim, CRNRSTN_ENCRYPT_SOAP, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override)
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

                    $tmp_email_hash = $this->hash($tmp_email);

                    $tmp_lastname = rtrim($tmp_lastname, ' ');
                    array_push($tmp_email_ARRAY, array(
                        'EMAIL_PROXY_SERIAL' => $this->oCRNRSTN_ENV->data_encrypt($tmp_email_hash, CRNRSTN_ENCRYPT_SOAP, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                        'EMAILADDRESS' => $this->oCRNRSTN_ENV->data_encrypt($tmp_email, CRNRSTN_ENCRYPT_SOAP, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                        'FIRSTNAME' => $this->oCRNRSTN_ENV->data_encrypt($tmp_firstname, CRNRSTN_ENCRYPT_SOAP, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                        'LASTNAME' => $this->oCRNRSTN_ENV->data_encrypt($tmp_lastname, CRNRSTN_ENCRYPT_SOAP, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override)
                    ));

                }

            }else{

                //
                // MULTIPLE NAME-EMAIL
                $tmp_name_email_ARRAY = explode('|', $email_pipe_delim);

                $tmp_email_cnt = sizeof($tmp_name_email_ARRAY);
                for($i = 0; $i < $tmp_email_cnt; $i++){

                    $pos_space = strpos($tmp_name_email_ARRAY[$i], ' ');

                    if($pos_space === false){

                        $tmp_name_email_hash = $this->hash($tmp_name_email_ARRAY[$i]);

                        array_push($tmp_email_ARRAY, array(
                            'EMAIL_PROXY_SERIAL' => $this->oCRNRSTN_ENV->data_encrypt($tmp_name_email_hash, CRNRSTN_ENCRYPT_SOAP, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                            'EMAILADDRESS' => $this->oCRNRSTN_ENV->data_encrypt($tmp_name_email_ARRAY[$i], CRNRSTN_ENCRYPT_SOAP, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override)
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

                            if($pos_at !== false && $pos_dot !== false && $tmp_email == ''){

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

                        $tmp_email_hash = $this->hash($tmp_email);

                        $tmp_lastname = rtrim($tmp_lastname, ' ');
                        array_push($tmp_email_ARRAY, array(
                            'EMAIL_PROXY_SERIAL' => $this->oCRNRSTN_ENV->data_encrypt($tmp_email_hash, CRNRSTN_ENCRYPT_SOAP, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                            'EMAILADDRESS' => $this->oCRNRSTN_ENV->data_encrypt($tmp_email, CRNRSTN_ENCRYPT_SOAP, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                            'FIRSTNAME' => $this->oCRNRSTN_ENV->data_encrypt($tmp_firstname, CRNRSTN_ENCRYPT_SOAP, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                            'LASTNAME' => $this->oCRNRSTN_ENV->data_encrypt($tmp_lastname, CRNRSTN_ENCRYPT_SOAP, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override)
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

                    for($i = 0; $i < $tmp_email_breakout_cnt; $i++){

                        $tmp_email = trim($tmp_email_breakout_ARRAY[$i]);
                        $tmp_name = trim($tmp_name_breakout_ARRAY[$i]);

                        $tmp_space = strpos($tmp_name, ' ');
                        if($tmp_space!==false){
                            $tmp_name_bo_ARRAY = explode(' ', $tmp_name);
                            $tmp_name_bo_cnt = sizeof($tmp_name_bo_ARRAY);
                            for($ii = 0; $ii < $tmp_name_bo_cnt; $ii++){

                                //
                                // TAKE NAME ELEMENT
                                if($tmp_firstname == ''){

                                    $tmp_firstname .= $tmp_name_bo_ARRAY[$ii];

                                }else{

                                    $tmp_lastname .= $tmp_name_bo_ARRAY[$ii] . ' ';

                                }

                            }

                        }else{

                            $tmp_firstname = $tmp_name;

                        }

                        $tmp_email_hash = $this->hash($tmp_email);

                        $tmp_lastname = rtrim($tmp_lastname, ' ');
                        array_push($tmp_email_ARRAY, array(
                            'EMAIL_PROXY_SERIAL' => $this->oCRNRSTN_ENV->data_encrypt($tmp_email_hash, CRNRSTN_ENCRYPT_SOAP, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                            'EMAILADDRESS' => $this->oCRNRSTN_ENV->data_encrypt($tmp_email, CRNRSTN_ENCRYPT_SOAP, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                            'FIRSTNAME' => $this->oCRNRSTN_ENV->data_encrypt($tmp_firstname, CRNRSTN_ENCRYPT_SOAP, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                            'LASTNAME' => $this->oCRNRSTN_ENV->data_encrypt($tmp_lastname, CRNRSTN_ENCRYPT_SOAP, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override)
                        ));
                    }

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('CRNRSTN :: has received a mismatch between the number of email addresses provided and the number of names...' . $tmp_email_breakout_cnt . ' to ' . $tmp_name_breakout_cnt . ', respectively.');

                }

            }else{

                //
                // SINGLE EMAIL
                $pos_space = strpos($name_pipe_delim, ' ');
                if($pos_space !== false){

                    $tmp_name_sep_ARRAY = explode(' ', $name_pipe_delim);
                    $tmp_name_element_cnt = sizeof($tmp_name_sep_ARRAY);

                    for($i = 0; $i < $tmp_name_element_cnt; $i++){

                        //
                        // TAKE NAME ELEMENT
                        if($tmp_firstname == ''){

                            $tmp_firstname .= $tmp_name_sep_ARRAY[$i];

                        }else{

                            $tmp_lastname .= $tmp_name_sep_ARRAY[$i] . ' ';

                        }

                    }

                }else{

                    //
                    // ONLY "FIRST" NAME
                    $tmp_firstname = $name_pipe_delim;

                }

                $tmp_email_pipe_delim_hash = $this->hash($email_pipe_delim);

                $tmp_lastname = rtrim($tmp_lastname, ' ');
                array_push($tmp_email_ARRAY, array(
                    'EMAIL_PROXY_SERIAL' => $this->oCRNRSTN_ENV->data_encrypt($tmp_email_pipe_delim_hash, CRNRSTN_ENCRYPT_SOAP, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                    'EMAILADDRESS' => $this->oCRNRSTN_ENV->data_encrypt($email_pipe_delim, CRNRSTN_ENCRYPT_SOAP, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                    'FIRSTNAME' => $this->oCRNRSTN_ENV->data_encrypt($tmp_firstname, CRNRSTN_ENCRYPT_SOAP, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                    'LASTNAME' => $this->oCRNRSTN_ENV->data_encrypt($tmp_lastname, CRNRSTN_ENCRYPT_SOAP, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override)
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

        if(isset($this->secret_key_override_ARRAY[$this->hash($SOAP_endpoint)])){

            return $this->secret_key_override_ARRAY[$this->hash($SOAP_endpoint)];

        }else{

            return NULL;

        }

    }

    public function return_cipher_override($SOAP_endpoint){

        if(isset($this->cipher_override_ARRAY[$this->hash($SOAP_endpoint)])){

            return $this->cipher_override_ARRAY[$this->hash($SOAP_endpoint)];

        }else{

            return NULL;

        }

    }

    public function return_hmac_algorithm_override($SOAP_endpoint){

        if(isset($this->hmac_algorithm_override_ARRAY[$this->hash($SOAP_endpoint)])){

            return $this->hmac_algorithm_override_ARRAY[$this->hash($SOAP_endpoint)];

        }else{

            return NULL;

        }

    }

    public function return_options_bitwise_override($SOAP_endpoint){

        if(isset($this->options_bitwise_override_ARRAY[$this->hash($SOAP_endpoint)])){

            return $this->options_bitwise_override_ARRAY[$this->hash($SOAP_endpoint)];

        }else{

            return NULL;

        }

    }

    public function initSOAP_WSDL_connectionProfile($SOAP_endpoint, $WSDL_cache_ttl, $nusoap_useCURL){

        $this->WSDL_cache_ttl_ARRAY[$this->hash($SOAP_endpoint)] = $WSDL_cache_ttl;
        $this->nusoap_useCURL_ARRAY[$this->hash($SOAP_endpoint)] = $nusoap_useCURL;

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
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

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
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

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
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

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
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

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
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

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

    public function get_server_config_serial($output_format = 'hash'){

        if($output_format === 'hash'){

            return $this->config_serial_hash;

        }

        return $this->oCRNRSTN->get_server_config_serial($output_format);

    }

    public function define_wildcard_resource($key){

        $oWildCardResource = new crnrstn_wildcard_resource($key, $this);

        return $oWildCardResource;

    }

    public function save_wildcard_resource($oWildCardResource){

        $this->oCRNRSTN_ENV->augmentWCR_array($oWildCardResource);

    }

    public function ui_content_module_out($channel_constant, $crnrstn_form_handle = NULL){

        switch($channel_constant){
            case CRNRSTN_UI_FORM_INTEGRATION_PACKET:
            case CRNRSTN_OUTPUT_SSDTLA:
            case CRNRSTN_OUTPUT_FORM_INTEGRATIONS:

                $this->form_input_add($crnrstn_form_handle, 'crnrstn_session_salt', NULL, NULL, CRNRSTN_INPUT_REQUIRED);
                $this->form_input_add($crnrstn_form_handle, 'crnrstn_pssdtlp_clear_text_bytes', NULL, NULL, CRNRSTN_INPUT_REQUIRED);
                $this->form_input_add($crnrstn_form_handle, 'crnrstn_pssdtlp_encrypted_bytes', NULL, NULL, CRNRSTN_INPUT_REQUIRED);
                $this->form_input_add($crnrstn_form_handle, 'crnrstn_pssdtlp_hash', NULL, NULL, CRNRSTN_INPUT_REQUIRED);
                $this->form_input_add($crnrstn_form_handle, 'crnrstn_pssdtl_packet', NULL, NULL, CRNRSTN_INPUT_REQUIRED);
                $this->form_input_add($crnrstn_form_handle, 'crnrstn_pssdtlp_index');
                $this->form_input_add($crnrstn_form_handle, 'crnrstn_request_serialization_key');
                $this->form_input_add($crnrstn_form_handle, 'crnrstn_request_serialization_hash');
                $this->form_input_add($crnrstn_form_handle, 'crnrstn_interact_ui_link_text_click');
                $this->form_input_add($crnrstn_form_handle, 'crnrstn_interact_ui_loadbar_progress');

                return $this->return_serialized_input_fields_html($channel_constant, $crnrstn_form_handle);

            break;
            default:

                return $this->oCRNRSTN_ENV->ui_content_module_out($channel_constant, $crnrstn_form_handle);

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

        // SEE: public_html/_crnrstn/class/crnrstn/crnrstn.performance_regulator.inc.php

        $this->error_log('Maximum storage usage at ANY destination LOCAL (FTP is not monitored) directory for this CRNRSTN :: Electrum process is being set to ' . $maxStorageUse . '%.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->localStorageUse_doNotPassUsagePercent($maxStorageUse);

        return $CRNRSTN_oELECTRUM;
    }


    public function electrum_deleteSourceData_OnSuccess($CRNRSTN_oELECTRUM, $WCR_key_Or_DirPath, $require_ALL_destination_success=true){

        $this->error_log('On SUCCESS, remove all "processed-to-destination" files at the SOURCE endpoint, ' . $WCR_key_Or_DirPath, __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->deleteSourceData_OnSuccess($WCR_key_Or_DirPath, $require_ALL_destination_success);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addSourceFTP_WCR($CRNRSTN_oELECTRUM, $WildCardResource_key){

        $this->error_log('Add new WCR[' . $WildCardResource_key . '] source[' . $this->get_resource('FTP_SERVER', $WildCardResource_key) . '] to this electrum.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->addSource_FTP_WCR($WildCardResource_key);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addDestinationFTP_WCR($CRNRSTN_oELECTRUM, $WildCardResource_key){

        $this->error_log('Add new WCR[' . $WildCardResource_key . '] destination[' . $this->get_resource('FTP_SERVER', $WildCardResource_key) . '] to this electrum.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->addDestination_FTP_WCR($WildCardResource_key);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addFlattenedDestinationFTP_WCR($CRNRSTN_oELECTRUM, $WildCardResource_key){

        $this->error_log('Add new WCR[' . $WildCardResource_key . '] FLATTEN ALL FILES TO SAME Directory DESTINATION [' . $this->get_resource('FTP_SERVER', $WildCardResource_key) . '] to this electrum.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->addFlattenedDestinationFTP_WCR($WildCardResource_key);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addSourceLOCAL($CRNRSTN_oELECTRUM, $dirPath){

        $this->error_log('Add new Directory source[' . $dirPath . '] to this electrum.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->addSourceLOCAL($dirPath);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addSourceLOCAL_WCR($CRNRSTN_oELECTRUM, $WildCardResource_key){

        $this->error_log('Add new WCR[' . $WildCardResource_key . '] source[' . $this->get_resource('LOCAL_DIR_PATH', $WildCardResource_key) . '] to this electrum.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->addSourceLOCAL_WCR($WildCardResource_key);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addDestinationLOCAL_WCR($CRNRSTN_oELECTRUM, $WildCardResource_key){

        $tmp_path = $this->get_resource('LOCAL_DIR_PATH', $WildCardResource_key);
        //$tmp_mode = $this->get_resource('LOCAL_MKDIR_MODE', $WildCardResource_key);
        $this->error_log('Add new DIR [' . $WildCardResource_key . '] destination[' . $tmp_path . '] to this electrum.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->addDestinationLOCAL_WCR($WildCardResource_key);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addFlattenedDestinationLOCAL_WCR($CRNRSTN_oELECTRUM, $WildCardResource_key){

        $tmp_path = $this->get_resource('LOCAL_DIR_PATH', $WildCardResource_key);
        //$tmp_mode = $this->get_resource('LOCAL_MKDIR_MODE', $WildCardResource_key);
        $this->error_log('Add new FLATTEN ALL FILES TO SAME Directory [' . $WildCardResource_key . '] destination[' . $tmp_path . '] to this electrum.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->addFlattenedDestinationLOCAL_WCR($WildCardResource_key);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addDestinationLOCAL($CRNRSTN_oELECTRUM, $dirPath, $mkdir_permissons_mode = 777){

        $this->error_log('Add new Directory destination[' . $dirPath . '] to this electrum.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->addDestinationLOCAL($dirPath, $mkdir_permissons_mode);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addFlattenedDestinationLOCAL($CRNRSTN_oELECTRUM, $dirPath, $mkdir_permissons_mode = 777){

        $this->error_log('Add new FLATTEN ALL FILES TO SAME Directory destination[' . $dirPath . '] to this electrum.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->addFlattenedDestinationLOCAL($dirPath, $mkdir_permissons_mode);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_DIR($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH = NULL){

        $this->error_log('Add new DIR Exclusion of "' . $pattern . '" to this electrum.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->exclude_DIR($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_FILE($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH = NULL){

        $this->error_log('Add new FILE Exclusion of "' . $pattern . '" to this electrum.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->exclude_FILE($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_fileSizeGreaterThan($CRNRSTN_oELECTRUM, $bytes, $WCRkey_or_DIRPATH = NULL){

        $this->error_log('Add new FILE Exclusion where FILE SIZE > ' . $bytes . ' bytes to this electrum.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->exclude_fileSizeGreaterThan($bytes, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_fileSizeLessThan($CRNRSTN_oELECTRUM, $bytes, $WCRkey_or_DIRPATH = NULL){

        $this->error_log('Add new FILE Exclusion where FILE SIZE < ' . $bytes . ' bytes to this electrum.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->exclude_fileSizeLessThan($bytes, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_accessedOlderThan($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH = NULL){

        $this->error_log('Add new exclusion of ACCESSED OLDER THAN "' . $pattern . '" to this electrum.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->exclude_accessedOlderThan($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_accessedNewerThan($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH = NULL){

        $this->error_log('Add new exclusion of ACCESSED NEWER THAN "' . $pattern . '" to this electrum.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->exclude_accessedNewerThan($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_modifiedOlderThan($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH = NULL){

        $this->error_log('Add new exclusion of MODIFIED OLDER THAN "' . $pattern . '" to this electrum.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->exclude_modifiedOlderThan($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_modifiedNewerThan($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH = NULL){

        $this->error_log('Add new exclusion of MODIFIED NEWER THAN "' . $pattern . '" to this electrum.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->exclude_modifiedNewerThan($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_assetUserID($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH = NULL){

        $this->error_log('Add new exclusion of FILE OWNER USER ID "' . $pattern . '" to this electrum.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->exclude_assetUserID($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_assetGroupID($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH = NULL){

        $this->error_log('Add new exclusion of FILE OWNER GROUP ID "' . $pattern . '" to this electrum.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

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

    public function is_current_environment($env_key){

        //
        // METHOD HAS BEEN MODIFIED BUT IS UNTESTED :: Friday, August 5, 2022 2013 hrs
        $tmp_env_key_hash = $this->hash($env_key);

        if($tmp_env_key_hash == $this->oCRNRSTN_ENV->env_key_hash){

            return true;

        }else{

            return false;

        }

    }
    
    public function initialize_oGabriel($messenger_serial, $mail_protocol = 'SMTP', $username = NULL, $password = NULL, $port = NULL){

        //
        // BRING IN THE MESSENGER
        // Luke 1:19, 26; Daniel 8:16; 9:21-22
        $oCRNRSTN_GABRIEL = new crnrstn_messenger_from_north($messenger_serial, $mail_protocol, $username, $password, $port, $this);

        $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial] = $oCRNRSTN_GABRIEL;

        return $oCRNRSTN_GABRIEL;

    }

    public function initProxySend($oCRNRSTN_GABRIEL, $proxy_endpoint_uri, $proxy_auth_key){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->initProxySend($proxy_endpoint_uri, $proxy_auth_key);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function proxyEncrypt_setCipherOverride($oCRNRSTN_GABRIEL, $cipher){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->proxyEncrypt_setCipherOverride($cipher);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function proxyEncrypt_setSecretKeyOverride($oCRNRSTN_GABRIEL, $proxy_secret_key){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->proxyEncrypt_setSecretKeyOverride($proxy_secret_key);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function proxyEncrypt_setAlgorithmOverride($oCRNRSTN_GABRIEL, $proxy_encrypt_hmac_algorithm){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->proxyEncrypt_setAlgorithmOverride($proxy_encrypt_hmac_algorithm);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addHostServers($oCRNRSTN_GABRIEL, $mail_host_servers){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->addHostServers($mail_host_servers);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addReplyTo($oCRNRSTN_GABRIEL, $reply_to_email, $reply_to_recipient_name = ''){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->addReplyTo($reply_to_email, $reply_to_recipient_name);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addFrom($oCRNRSTN_GABRIEL, $sender_email, $sender_name = ''){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->addFrom($sender_email, $sender_name);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function wordWrap($oCRNRSTN_GABRIEL, $max_char_column_cnt = 72){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->wordWrap($max_char_column_cnt);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function isHTML($oCRNRSTN_GABRIEL, $bool_isHTML){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->isHTML($bool_isHTML);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function setPriority($oCRNRSTN_GABRIEL, $priority = 'NORMAL'){

        // 1 = HIGH, 3 = NORMAL, 5 = LOW, null (default)
        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->setPriority($priority);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addSubject($oCRNRSTN_GABRIEL, $subject_line = ''){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->addSubject($subject_line);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addMsgBody_HTMLversion($oCRNRSTN_GABRIEL, $html_message = ''){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->addMsgBody_HTMLversion($html_message);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addMsgBody_TEXTversion($oCRNRSTN_GABRIEL, $text_message = ''){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->addMsgBody_TEXTversion($text_message);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;
    }

    public function suppressEmailDuplicates($oCRNRSTN_GABRIEL, $bool_suppress_dups = true){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->suppressEmailDuplicates($bool_suppress_dups);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function optOutDoNotSendEmail($oCRNRSTN_GABRIEL, $optout_emails){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->optOutDoNotSendEmail($optout_emails);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addAddress($oCRNRSTN_GABRIEL, $recipient_email, $recipient_name = ''){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $email_experience_tracker = $oGabriel->addAddress($recipient_email, $recipient_name);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

        return $email_experience_tracker;

    }

    public function addCC($oCRNRSTN_GABRIEL, $recipient_email, $recipient_name = ''){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->addCC($recipient_email, $recipient_name);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addBCC($oCRNRSTN_GABRIEL, $recipient_email, $recipient_name = ''){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->addBCC($recipient_email, $recipient_name);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addDynamicContent_SUBJECT($oCRNRSTN_GABRIEL, $email_experience_tracker, $content_place_holder, $dynamic_content){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->addDynamicContent_SUBJECT($email_experience_tracker, $content_place_holder, $dynamic_content);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addDynamicContent_HTML($oCRNRSTN_GABRIEL, $email_experience_tracker, $content_place_holder, $dynamic_content){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->addDynamicContent_HTML($email_experience_tracker, $content_place_holder, $dynamic_content);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addDynamicContent_TEXT($oCRNRSTN_GABRIEL, $email_experience_tracker, $content_place_holder, $dynamic_content){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->addDynamicContent_TEXT($email_experience_tracker, $content_place_holder, $dynamic_content);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addDynamicContent_MULTIPART($oCRNRSTN_GABRIEL, $email_experience_tracker, $content_place_holder, $dynamic_content){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->addDynamicContent_MULTIPART($email_experience_tracker, $content_place_holder, $dynamic_content);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function oGabriel_ProxySend($oCRNRSTN_GABRIEL = NULL){

        $tmp_flag_messenger_send_ARRAY = array();

        if(!isset($oCRNRSTN_GABRIEL)){

            //
            // FIRE EVERYTHING!
            foreach($this->oMessenger_ARRAY as $serial => $oGabriel){

                if(!isset($tmp_flag_messenger_send_ARRAY[$oGabriel->messenger_serial])){

                    $tmp_flag_messenger_send_ARRAY[$oGabriel->messenger_serial] = 1;

                    $oGabriel->proxySend();

                    $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

                    $this->error_log('Finished Triggering oGabriel_ProxySend(' . $oGabriel->messenger_serial . ').', __LINE__, __METHOD__, __FILE__,CRNRSTN_GABRIEL);

                }

            }

        }else{

            $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

            $oGabriel->proxySend();

            $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

            $this->error_log('Finished Trigger oGabriel_ProxySend(' . $oGabriel->messenger_serial .').', __LINE__, __METHOD__, __FILE__,CRNRSTN_GABRIEL);

        }

    }

    public function oGabriel_Send($oCRNRSTN_GABRIEL=NULL){

        $tmp_flag_messenger_send_ARRAY = array();
        if(!isset($oCRNRSTN_GABRIEL)){

            //
            // FIRE EVERYTHING!
            foreach($this->oMessenger_ARRAY as $serial => $oGabriel){

                if(!isset($tmp_flag_messenger_send_ARRAY[$oGabriel->messenger_serial])){

                    $tmp_flag_messenger_send_ARRAY[$oGabriel->messenger_serial] = 1;

                    $send_result_array[] = $oGabriel->send();

                    $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

                    $this->error_log('Finished Triggering oGabriel->send(' . $oGabriel->messenger_serial . ').', __LINE__, __METHOD__, __FILE__,CRNRSTN_GABRIEL);

                }

            }

        }else{

            $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

            $send_result_array[] = $oGabriel->send();

            $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

            $this->error_log('Finished Trigger oGabriel->send(' . $oGabriel->messenger_serial . ').', __LINE__, __METHOD__, __FILE__,CRNRSTN_GABRIEL);

        }

        return $send_result_array;

    }

    public function oGabriel_SendReport($oCRNRSTN_GABRIEL){

        $this->error_log('Trigger oGabriel_SendReport().', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

        // where $emailSendReport_ARRAY = array['0'=>['email@email.com'=>'success'], '1'=>['test@test.com'=>'duplicate_suppressed'], test2@test.com'=>'error']
        /*
                foreach($emailSendReport_ARRAY as $index=>$emailReport){
                    foreach($emailReport as $email=>$sendStatus){

                        'UPDATE table where 'EMAIL'= $email SET...;'

                    }
                }
        */

        return true;

    }

    public function addAddressBulk($oCRNRSTN_GABRIEL, $recipient_email, $recipient_name = '', $email_experience_tracker = NULL){

        if(!isset($email_experience_tracker)){

            $email_experience_tracker = $this->generate_new_key(70);

        }

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

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

    public function isHTMLBulk($oCRNRSTN_GABRIEL, $email_experience_tracker, $bool_isHTML){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->isHTMLBulk($email_experience_tracker, $bool_isHTML);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function setPriorityBulk($oCRNRSTN_GABRIEL, $email_experience_tracker, $priority = 'NORMAL'){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->setPriorityBulk($email_experience_tracker, $priority);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addFromBulk($oCRNRSTN_GABRIEL, $email_experience_tracker, $sender_email, $sender_name = ''){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->addFromBulk($email_experience_tracker, $sender_email, $sender_name);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function wordWrapBulk($oCRNRSTN_GABRIEL, $email_experience_tracker, $max_char_column_cnt = 72){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->wordWrapBulk($email_experience_tracker, $max_char_column_cnt);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addReplyToBulk($oCRNRSTN_GABRIEL, $email_experience_tracker, $reply_to_email, $reply_to_name = ''){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->addReplyToBulk($email_experience_tracker, $reply_to_email, $reply_to_name);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addCCBulk($oCRNRSTN_GABRIEL, $email_experience_tracker, $cc_email, $cc_name = ''){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->addCCBulk($email_experience_tracker, $cc_email, $cc_name);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addBCCBulk($oCRNRSTN_GABRIEL, $email_experience_tracker, $bcc_email, $bcc_name = ''){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->addBCCBulk($email_experience_tracker, $bcc_email, $bcc_name);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addSubjectBulk($oCRNRSTN_GABRIEL, $email_experience_tracker, $subject_line = ''){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->addSubjectBulk($email_experience_tracker, $subject_line);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addHTMLver_Bulk($oCRNRSTN_GABRIEL, $email_experience_tracker, $html_message = ''){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->addHTMLver_Bulk($email_experience_tracker, $html_message);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addTEXTver_Bulk($oCRNRSTN_GABRIEL, $email_experience_tracker, $text_message = ''){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->addTEXTver_Bulk($email_experience_tracker, $text_message);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    //
    // BATCH MANAGEMENT TO LIMIT RESOURCE CONSUMPTION - where here, it is 25 email messages per batch
    public function batchReadyToSend($oCRNRSTN_GABRIEL, $max_batch_count = 0){

        // USE LIKE THIS
        //if($oCRNRSTN_USR->batchReadyToSend($oCRNRSTN_GABRIEL, 25)){

        //}
        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        return $oGabriel->batchReadyToSend($max_batch_count);

    }

    public function sendStatusReportEmail($oCRNRSTN_GABRIEL, $recipient_email, $recipient_name){

        $oGabriel = $this->oMessenger_ARRAY[$oCRNRSTN_GABRIEL->messenger_serial];

        $oGabriel->sendStatusReportEmail($recipient_email, $recipient_name);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function return_oCRNRSTN_ENV(){

        return $this->oCRNRSTN_ENV;

    }

    public function return_oNUSOAP_BASE(){

        return $this->oNUSOAP_BASE;

    }

    public function return_ssdtl_packet_ttl(){

        return $this->ssdtl_packet_ttl;

    }
    
    public function get_resource_count($data_key, $data_type_family = NULL, $env_key = NULL){

        if(!isset($env_key)){

            $env_key = $this->oCRNRSTN_ENV->env_key;

        }

        return $this->oCRNRSTN_ENV->get_resource_count($data_key, $data_type_family, $env_key);

    }

    public function get_resource($data_key, $index = NULL, $data_type_family = NULL, $soap_transport = false){

        if(is_string($index)){

            error_log(__LINE__ . ' STRING PROVIDED, BUT INTEGER IS REQUIRED. Or user get_resource(\'' . $data_key . '\') needs the "$index = 0" parameter added. thx! die();');
            die();

        }

        // public function retrieve_data_value($data_key, $index = NULL, $data_type_family = 'CRNRSTN::RESOURCE', $env_key = NULL, $soap_transport = false){
        return $this->oCRNRSTN_ENV->retrieve_data_value($data_key, $index, $data_type_family, $this->oCRNRSTN_ENV->env_key, $soap_transport);

    }

    public function add_system_resource($data_key, $data_value, $data_type_family = 'CRNRSTN::RESOURCE', $data_auth_profile = CRNRSTN_AUTHORIZE_RUNTIME_ONLY, $data_index = NULL, $env_key = NULL){
        
        $this->oCRNRSTN->add_system_resource($data_key, $data_value, $data_type_family, $data_auth_profile, $data_index, $env_key);
        
    }

    public function return_SOAP_svc_oClient_meta($param_key, $CRNRSTN_SOAP_SVC_USERNAME, $CRNRSTN_SOAP_SVC_PASSWORD){

        return $this->oCRNRSTN_ENV->return_SOAP_svc_oClient_meta($param_key, $CRNRSTN_SOAP_SVC_USERNAME, $CRNRSTN_SOAP_SVC_PASSWORD);

    }
    
    public function return_SOAP_svc_config_param($param_key){

        return $this->oCRNRSTN_ENV->return_SOAP_svc_config_param($param_key);

    }

    public function client_agent_is($key, $userAgent = null, $httpHeaders = null){

        return $this->oCRNRSTN_ENV->client_agent_is($key, $userAgent, $httpHeaders);

    }
    
    public function is_mobile($tablet_is_mobile = false){

        error_log(__LINE__ . ' user ' . __METHOD__ . ':: has fired.');

        return $this->oCRNRSTN_ENV->oHTTP_MGR->is_mobile($tablet_is_mobile);

    }

    public function is_tablet($mobile_is_tablet = false){

        error_log(__LINE__ . ' user ' . __METHOD__ . ':: has fired.');

        return $this->oCRNRSTN_ENV->oHTTP_MGR->is_tablet($mobile_is_tablet);

    }
    
    public function set_mobile(){

        return $this->oCRNRSTN_ENV->oHTTP_MGR->set_tablet();

    }

    public function set_tablet(){

        return $this->oCRNRSTN_ENV->oHTTP_MGR->set_tablet();

    }

    public function set_desktop(){

        return $this->oCRNRSTN_ENV->oHTTP_MGR->set_desktop();

    }
    
    public function set_mobile_custom($target_device = NULL){

        return $this->oCRNRSTN_ENV->oHTTP_MGR->set_mobile_custom($target_device);

    }

    public function return_client_header_value($header_attribute, $index = 0){

        return $this->oCRNRSTN_ENV->return_client_header_value($header_attribute, $index);

    }

    private function form_serialize_new($crnrstn_form_handle){

        try {

            $tmp_stripe_key_ARRAY = $this->oCRNRSTN->return_stripe_key_ARRAY('$crnrstn_form_handle');
            $tmp_param_err_str_ARRAY = $this->oCRNRSTN->return_regression_stripe_ARRAY('MISSING_STRING_DATA', $tmp_stripe_key_ARRAY, $crnrstn_form_handle);

            $tmp_param_missing_str = $tmp_param_err_str_ARRAY['string'];
            $tmp_param_missing_ARRAY = $tmp_param_err_str_ARRAY['index_array'];

            if(count($tmp_param_missing_ARRAY) > 0){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('CRNRSTN :: Form handling configuration error ::. ' . $tmp_param_missing_str);

            }else{

                // HOW TO GET SUBMITTED FORM FIELD DATA
                //$this->oCRNRSTN->get_resource_submitted('input_field_name', 'POST');
                // PREVIOUS METHOD:
                //$this->oCRNRSTN->return_form_submitted_value('input_field_name', 'POST');
                $tmp_form_handle_hash = $this->hash($crnrstn_form_handle);
                $tmp_data_type_family = 'CRNRSTN_SYSTEM_RESOURCE::FORM_HANDLE::' . $tmp_form_handle_hash;
                if(!$this->oCRNRSTN->isset_data_key($crnrstn_form_handle, $tmp_data_type_family)){

                    // add_system_resource($data_key, $data_value, $data_type_family = 'CRNRSTN::RESOURCE', $data_auth_profile = CRNRSTN_AUTHORIZE_RUNTIME_ONLY){
                    $tmp_serialized_data_key = $this->oCRNRSTN->add_system_resource('crnrstn_pssdtl_packet', $crnrstn_form_handle, $tmp_data_type_family, CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
                    $this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY[$tmp_form_handle_hash][$tmp_data_type_family . 'crnrstn_pssdtl_packet'][] = $tmp_serialized_data_key;

                }

            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return NULL;

    }
    
    public function form_input_add($crnrstn_form_handle = NULL, $field_input_name = NULL, $field_input_id = NULL, $default_value = NULL, $validation_constant_profile = CRNRSTN_INPUT_OPTIONAL, $table_field_name = NULL){

        /*
        Saturday, September 3, 2022 @ 0726 hrs
        CRNRSTN ::
        CRNRSTN_INPUT_OPTIONAL
        CRNRSTN_INPUT_REQUIRED
        CRNRSTN_INPUT_PASSWORD
        CRNRSTN_INPUT_IS_FILE_IMAGE_JPEG
        CRNRSTN_INPUT_IS_FILE_IMAGE_PNG
        CRNRSTN_INPUT_IS_FILE_IMAGE_GIF
        CRNRSTN_INPUT_IS_FILE_IMAGE
        CRNRSTN_INPUT_IS_FILE_DOCUMENT
        CRNRSTN_INPUT_IS_FILE_ZIP
        CRNRSTN_INPUT_IS_EMAIL
        CRNRSTN_INPUT_CHAR_RESTRICTIONS
        CRNRSTN_INPUT_CHAR_LIMITS

        CRNRSTN_INPUT_PASSWORD (OUTPUT NOTE TO USER WITH THESE RULES)
            - CHAR COUNT RULES (MINIMUM LENGTH)
            - REQUIRED CHAR TYPES
            - ILLEGAL CHARS

        CRNRSTN_INPUT_CHAR_RESTRICTIONS (OUTPUT NOTE TO USER WITH THESE RULES)
            - PERMISSIBLE CHARS
            - ILLEGAL CHARS

        CRNRSTN_INPUT_CHAR_LIMIT (OUTPUT NOTE TO USER WITH THESE RULES)
            - NUMBER OF CHARS UPPER LIMIT.
            - NUMBER OFF CHARS LOWER LIMIT

        */

        $tmp_form_handle_hash = $this->hash($crnrstn_form_handle);
        $tmp_data_type_family = 'CRNRSTN_SYSTEM_RESOURCE::FORM_HANDLE::' . $tmp_form_handle_hash;
        if(!$this->oCRNRSTN->isset_data_key($crnrstn_form_handle, $tmp_data_type_family)){

            $this->form_serialize_new($crnrstn_form_handle);

        }

        try {

            $tmp_stripe_key_ARRAY = $this->oCRNRSTN->return_stripe_key_ARRAY('$crnrstn_form_handle', '$field_input_name');
            $tmp_param_err_str_ARRAY = $this->oCRNRSTN->return_regression_stripe_ARRAY('MISSING_STRING_DATA', $tmp_stripe_key_ARRAY, $field_input_name);

            $tmp_param_missing_str = $tmp_param_err_str_ARRAY['string'];
            $tmp_param_missing_ARRAY = $tmp_param_err_str_ARRAY['index_array'];

            if(count($tmp_param_missing_ARRAY) > 0){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('CRNRSTN :: Form handling configuration error ::. ' . $tmp_param_missing_str);

            }else{

                $tmp_form_handle_hash = $this->hash($crnrstn_form_handle);
                $tmp_field_input_name_hash = $this->hash($field_input_name);

                $tmp_dtf_FORM_HANDLE = 'CRNRSTN_SYSTEM_RESOURCE::FORM_HANDLE::' . $tmp_form_handle_hash . '::' . $tmp_field_input_name_hash;
                //if(!$this->oCRNRSTN->isset_data_key('FORM_INPUT_NAME', $tmp_dtf_FORM_HANDLE)){

                $tmp_data_key = 'CRNRSTN_FIELD_INPUT_NAME';
                $tmp_data_type_family = $tmp_dtf_FORM_HANDLE  . '::' . $tmp_data_key;
                $tmp_serialized_data_key = $this->oCRNRSTN->add_system_resource($tmp_data_key, $field_input_name, $tmp_data_type_family, CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
                $this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY[$tmp_form_handle_hash][$tmp_data_type_family] = $tmp_serialized_data_key;

//                $tmp_str = '$field_input_name=[' . $field_input_name . '].
//$tmp_data_key=[' . $tmp_data_key . '].
//$tmp_data_type_family=[' . $tmp_data_type_family . '].';
//                $this->oCRNRSTN->print_r($tmp_str, NULL, NULL, __LINE__, __METHOD__, __FILE__);

                if(isset($field_input_id)){

                    $tmp_data_key = 'CRNRSTN_FIELD_INPUT_ID';
                    $tmp_data_type_family = $tmp_dtf_FORM_HANDLE  . '::' . $tmp_data_key;
                    $tmp_serialized_data_key = $this->oCRNRSTN->add_system_resource($tmp_data_key, $field_input_id, $tmp_data_type_family, CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
                    $this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY[$tmp_form_handle_hash][$tmp_data_type_family] = $tmp_serialized_data_key;

//                    $tmp_str = '$field_input_id=[' . $field_input_id . '].
//$tmp_data_key=[' . $tmp_data_key . '].
//$tmp_data_type_family=[' . $tmp_data_type_family . '].';
//                    $this->oCRNRSTN->print_r($tmp_str, NULL, NULL, __LINE__, __METHOD__, __FILE__);

                }

                if(isset($default_value)){

                    $tmp_data_key = 'DEFAULT_VALUE';
                    $tmp_data_type_family = $tmp_dtf_FORM_HANDLE  . '::' . $tmp_data_key;
                    $tmp_serialized_data_key = $this->oCRNRSTN->add_system_resource($tmp_data_key, $default_value, $tmp_data_type_family, CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
                    $this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY[$tmp_form_handle_hash][$tmp_data_type_family] = $tmp_serialized_data_key;

//                    $tmp_str = '$default_value=[' . $default_value . '].
//$tmp_data_key=[' . $tmp_data_key . '].
//$tmp_data_type_family=[' . $tmp_data_type_family . '].';
//                    $this->oCRNRSTN->print_r($tmp_str, NULL, NULL, __LINE__, __METHOD__, __FILE__);

                }

                if(isset($table_field_name)){

                    $tmp_data_key = 'TABLE_FIELD_NAME';
                    $tmp_data_type_family = $tmp_dtf_FORM_HANDLE  . '::' . $tmp_data_key;
                    $tmp_serialized_data_key =  $this->oCRNRSTN->add_system_resource($tmp_data_key, $table_field_name, $tmp_data_type_family, CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
                    $this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY[$tmp_form_handle_hash][$tmp_data_type_family] = $tmp_serialized_data_key;

//                    $tmp_str = '$table_field_name=[' . $table_field_name . '].
//$tmp_data_key=[' . $tmp_data_key . '].
//$tmp_data_type_family=[' . $tmp_data_type_family . '].';
//                    $this->oCRNRSTN->print_r($tmp_str, NULL, NULL, __LINE__, __METHOD__, __FILE__);

                }

                if(isset($validation_constant_profile)){

                    $tmp_data_key = 'VALIDATION_CONSTANTS_PROFILE';
                    $tmp_data_type_family = $tmp_dtf_FORM_HANDLE  . '::' . $tmp_data_key;
                    $tmp_serialized_data_key = $this->oCRNRSTN->add_system_resource($tmp_data_key, $validation_constant_profile, $tmp_data_type_family, CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
                    $this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY[$tmp_form_handle_hash][$tmp_data_type_family] = $tmp_serialized_data_key;

//                    $tmp_str = '$validation_constant_profile=[' . $validation_constant_profile . '].
//$tmp_data_key=[' . $tmp_data_key . '].
//$tmp_data_type_family=[' . $tmp_data_type_family . '].';
//                    $this->oCRNRSTN->print_r($tmp_str, NULL, NULL, __LINE__, __METHOD__, __FILE__);

                }

                //}

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return NULL;

    }

    public function form_response_add($crnrstn_form_handle, $field_input_name, $success_response_data, $success_response_type, $error_response_data, $error_response_type){

        /*
        WHERE $success_response_type=
        WHERE $error_response_type=
        CRNRSTN_HTTP_REDIRECT
        CRNRSTN_HTTPS_REDIRECT
        CRNRSTN_HTTP_DATA_RETURN     // UGC RESPONSE HEADER DATA???
        CRNRSTN_HTTPS_DATA_RETURN    // UGC RESPONSE HEADER DATA???
        CRNRSTN_JSON_RETURN
        CRNRSTN_XML_RETURN
        CRNRSTN_SOAP_RETURN
        CRNRSTN_HTML_TEXT_RETURN
        CRNRSTN_DOCUMENT_FILE_RETURN
        CRNRSTN_SERVER_RESPONSE_CODE

        'CRNRSTN_HTTP_REDIRECT', 'CRNRSTN_HTTPS_REDIRECT', 'CRNRSTN_HTTP_DATA_RETURN',
        'CRNRSTN_HTTPS_DATA_RETURN', 'CRNRSTN_JSON_RETURN', 'CRNRSTN_XML_RETURN', 'CRNRSTN_SOAP_RETURN',
        'CRNRSTN_HTML_TEXT_RETURN', 'CRNRSTN_DOCUMENT_FILE_RETURN', 'CRNRSTN_SERVER_RESPONSE_CODE'

        */
        $tmp_form_handle_hash = $this->hash($crnrstn_form_handle);
        $tmp_data_type_family = 'CRNRSTN_SYSTEM_RESOURCE::FORM_HANDLE::' . $tmp_form_handle_hash;
        if(!$this->oCRNRSTN->isset_data_key($crnrstn_form_handle, $tmp_data_type_family)){

            $this->form_serialize_new($crnrstn_form_handle);

        }

        $tmp_form_handle_hash = $this->hash($crnrstn_form_handle);

        if(isset($field_input_name)){

            $tmp_data_key = 'SUCCESS_RESPONSE';
            $tmp_dtf_FORM_RESPONSE = 'CRNRSTN_SYSTEM_RESOURCE::FORM_INPUT_RESPONSE::' . $tmp_form_handle_hash . '::' . $field_input_name;

            if(!isset($this->oCRNRSTN->crnrstn_data_packet_spoiler_ARRAY[$tmp_form_handle_hash][$tmp_dtf_FORM_RESPONSE.$tmp_data_key]) && isset($success_response_data)){

                //
                // UNLESS WE WANT MULTIPLE SUCCESS REDIRECTS TO BE ASSOCIATED
                // WITH EACH INPUT...SPOIL isset_data_key().
                $this->oCRNRSTN->crnrstn_data_packet_spoiler_ARRAY[$tmp_form_handle_hash][$tmp_dtf_FORM_RESPONSE.$tmp_data_key] = 1;

                $tmp_data_key = 'SUCCESS_RESPONSE';
                $tmp_data_type_family = $tmp_dtf_FORM_RESPONSE . '::' . $tmp_data_key;
                $tmp_serialized_data_key = $this->oCRNRSTN->add_system_resource($tmp_data_key, $success_response_data, $tmp_data_type_family, CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
                $this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY[$tmp_form_handle_hash][$tmp_data_type_family] = $tmp_serialized_data_key;

                $tmp_data_key = 'SUCCESS_RESPONSE_TYPE';
                $tmp_data_type_family = $tmp_dtf_FORM_RESPONSE . '::' . $tmp_data_key;
                $tmp_serialized_data_key = $this->oCRNRSTN->add_system_resource($tmp_data_key, $success_response_type, $tmp_data_type_family, CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
                $this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY[$tmp_form_handle_hash][$tmp_data_type_family] = $tmp_serialized_data_key;

//                $tmp_str = '$success_response_data=[' . $success_response_data . '].
//$success_response_type=[' . $success_response_type . '].
//$tmp_data_key=[' . $tmp_data_key . '].
//$tmp_data_type_family=[' . $tmp_data_type_family . '].';
//                $this->oCRNRSTN->print_r($tmp_str, NULL, NULL, __LINE__, __METHOD__, __FILE__);

            }

            $tmp_data_key = 'ERROR_RESPONSE';
            if(!isset($this->oCRNRSTN->crnrstn_data_packet_spoiler_ARRAY[$tmp_form_handle_hash][$tmp_dtf_FORM_RESPONSE.$tmp_data_key]) && isset($error_response_data)){

                //
                // UNLESS WE WANT MULTIPLE ERROR RESPONSE/REDIRECT TO BE ASSOCIATED
                // WITH EACH INPUT...SPOIL.
                $this->oCRNRSTN->crnrstn_data_packet_spoiler_ARRAY[$tmp_form_handle_hash][$tmp_dtf_FORM_RESPONSE.$tmp_data_key] = 1;

                $tmp_data_key = 'ERROR_RESPONSE';
                $tmp_data_type_family = $tmp_dtf_FORM_RESPONSE . '::' . $tmp_data_key;
                $tmp_serialized_data_key = $this->oCRNRSTN->add_system_resource($tmp_data_key, $error_response_data, $tmp_data_type_family, CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
                $this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY[$tmp_form_handle_hash][$tmp_data_type_family] = $tmp_serialized_data_key;

                $tmp_data_key = 'ERROR_RESPONSE_TYPE';
                $tmp_data_type_family = $tmp_dtf_FORM_RESPONSE . '::' . $tmp_data_key;
                $tmp_serialized_data_key = $this->oCRNRSTN->add_system_resource($tmp_data_key, $error_response_type, $tmp_data_type_family, CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
                $this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY[$tmp_form_handle_hash][$tmp_data_type_family] = $tmp_serialized_data_key;

//                $tmp_str = '$error_response_data=[' . $error_response_data . '].
//$error_response_type=[' . $error_response_type . '].
//$tmp_data_key=[' . $tmp_data_key . '].
//$tmp_data_type_family=[' . $tmp_data_type_family . '].';
//                $this->oCRNRSTN->print_r($tmp_str, NULL, NULL, __LINE__, __METHOD__, __FILE__);

            }

        }

        $tmp_data_key = 'SUCCESS_RESPONSE';
        $tmp_data_type_family = $tmp_dtf_FORM_RESPONSE = 'CRNRSTN_SYSTEM_RESOURCE::FORM_RESPONSE::' . $tmp_form_handle_hash;

        if(!isset($this->oCRNRSTN->crnrstn_data_packet_spoiler_ARRAY[$tmp_form_handle_hash][$tmp_data_type_family.$tmp_data_key])){

            //
            // UNLESS WE WANT *ALL* SUCCESS RESPONSE TO BE ASSOCIATED
            // WITH THIS FORM...AS WELL AS THEIR RESPECTIVE INPUTS...SPOIL.
            $this->oCRNRSTN->crnrstn_data_packet_spoiler_ARRAY[$tmp_form_handle_hash][$tmp_data_type_family.$tmp_data_key] = 1;

            $tmp_data_key = 'SUCCESS_RESPONSE';
            $tmp_data_type_family = $tmp_dtf_FORM_RESPONSE . '::' . $tmp_data_key;
            $tmp_serialized_data_key = $this->oCRNRSTN->add_system_resource($tmp_data_key, $success_response_data, $tmp_data_type_family, CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
            $this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY[$tmp_form_handle_hash][$tmp_data_type_family] = $tmp_serialized_data_key;

            $tmp_data_key = 'SUCCESS_RESPONSE_TYPE';
            $tmp_data_type_family = $tmp_dtf_FORM_RESPONSE . '::' . $tmp_data_key;
            $tmp_serialized_data_key = $this->oCRNRSTN->add_system_resource($tmp_data_key, $success_response_type, $tmp_data_type_family, CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
            $this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY[$tmp_form_handle_hash][$tmp_data_type_family] = $tmp_serialized_data_key;

//            $tmp_str = '$success_response_data=[' . $success_response_data . '].
//$success_response_type=[' . $success_response_type . '].
//$tmp_data_key=[' . $tmp_data_key . '].
//$tmp_data_type_family=[' . $tmp_data_type_family . '].';
//            $this->oCRNRSTN->print_r($tmp_str, NULL, NULL, __LINE__, __METHOD__, __FILE__);

        }

        $tmp_data_key = 'ERROR_RESPONSE';
        $tmp_data_type_family = $tmp_dtf_FORM_RESPONSE = 'CRNRSTN_SYSTEM_RESOURCE::FORM_RESPONSE::' . $tmp_form_handle_hash;

        if(!isset($this->oCRNRSTN->crnrstn_data_packet_spoiler_ARRAY[$tmp_form_handle_hash][$tmp_data_type_family.$tmp_data_key]) && isset($error_response_data)) {

            //
            // UNLESS WE WANT *ALL* ERROR REDIRECTS TO BE ASSOCIATED
            // WITH FORM...AS WELL AS THEIR RESPECTIVE INPUTS...SPOIL.
            $this->oCRNRSTN->crnrstn_data_packet_spoiler_ARRAY[$tmp_form_handle_hash][$tmp_data_type_family.$tmp_data_key] = 1;

            $tmp_data_type_family = $tmp_dtf_FORM_RESPONSE . '::' . $tmp_data_key;
            $tmp_serialized_data_key = $this->oCRNRSTN->add_system_resource($tmp_data_key, $error_response_data, $tmp_data_type_family, CRNRSTN_AUTHORIZE_RUNTIME_ONLY,'');
            $this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY[$tmp_form_handle_hash][$tmp_data_type_family] = $tmp_serialized_data_key;

            $tmp_data_key = 'ERROR_RESPONSE_TYPE';
            $tmp_data_type_family = $tmp_dtf_FORM_RESPONSE . '::' . $tmp_data_key;
            $tmp_serialized_data_key = $this->oCRNRSTN->add_system_resource($tmp_data_key, $error_response_type, $tmp_data_type_family, CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
            $this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY[$tmp_form_handle_hash][$tmp_data_type_family] = $tmp_serialized_data_key;

//            $tmp_str = '$error_response_data=[' . $error_response_data . '].
//$error_response_type=[' . $error_response_type . '].
//$tmp_data_key=[' . $tmp_data_key . '].
//$tmp_data_type_family=[' . $tmp_data_type_family . '].';
//            $this->oCRNRSTN->print_r($tmp_str, NULL, NULL, __LINE__, __METHOD__, __FILE__);

        }

        return true;

    }

    public function form_hidden_input_add($crnrstn_form_handle = NULL, $field_input_name = NULL, $field_input_id = NULL, $default_value = NULL, $validation_constant_profile = CRNRSTN_INPUT_OPTIONAL, $table_field_name = NULL, $encrypt_data = true){

        try {

            $tmp_form_handle_hash = $this->hash($crnrstn_form_handle);
            $tmp_data_type_family = 'CRNRSTN_SYSTEM_RESOURCE::FORM_HANDLE::' . $tmp_form_handle_hash;
            if(!$this->oCRNRSTN->isset_data_key($crnrstn_form_handle, $tmp_data_type_family)){

                $this->form_serialize_new($crnrstn_form_handle);

            }

            $tmp_stripe_key_ARRAY = $this->oCRNRSTN->return_stripe_key_ARRAY('$crnrstn_form_handle', '$field_input_name');
            $tmp_param_err_str_ARRAY = $this->oCRNRSTN->return_regression_stripe_ARRAY('MISSING_STRING_DATA', $tmp_stripe_key_ARRAY, $field_input_name);

            $tmp_param_missing_str = $tmp_param_err_str_ARRAY['string'];
            $tmp_param_missing_ARRAY = $tmp_param_err_str_ARRAY['index_array'];

            if(count($tmp_param_missing_ARRAY) > 0){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('CRNRSTN :: Form handling configuration error ::. ' . $tmp_param_missing_str);

            }

            if(!isset($field_input_name)){

                $field_input_name = 'crnrstn_input_' . $this->generate_new_key(26);

            }

            $tmp_form_handle_hash = $this->hash($crnrstn_form_handle);
            $tmp_html_form_input_name_hash = $this->hash($field_input_name);

            $tmp_data_key = 'CRNRSTN_FIELD_HIDDEN_INPUT_NAME';
            $tmp_dtf_FORM_HANDLE = 'CRNRSTN_SYSTEM_RESOURCE::FORM_HANDLE::' . $tmp_form_handle_hash . '::' . $tmp_html_form_input_name_hash;

            if(!isset($this->oCRNRSTN->crnrstn_data_packet_spoiler_ARRAY[$tmp_form_handle_hash][$tmp_dtf_FORM_HANDLE.$tmp_data_key])){

                //
                // SPOIL
                $this->oCRNRSTN->crnrstn_data_packet_spoiler_ARRAY[$tmp_form_handle_hash][$tmp_dtf_FORM_HANDLE.$tmp_data_key] = 1;

                if(isset($field_input_name)){

                    $tmp_data_key = 'CRNRSTN_FIELD_HIDDEN_INPUT_NAME';
                    $tmp_data_type_family = $tmp_dtf_FORM_HANDLE . '::' . $tmp_data_key;
                    $tmp_serialized_data_key = $this->oCRNRSTN->add_system_resource($tmp_data_key, $field_input_name, $tmp_data_type_family, CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
                    $this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY[$tmp_form_handle_hash][$tmp_data_type_family] = $tmp_serialized_data_key;

//                    $tmp_str = '$field_input_name=[' . $field_input_name . '].
//$tmp_data_key=[' . $tmp_data_key . '].
//$tmp_data_type_family=[' . $tmp_data_type_family . '].';
//                    $this->oCRNRSTN->spool_destruct_output($this->oCRNRSTN->print_r_str($tmp_str, NULL, NULL, __LINE__, __METHOD__, __FILE__));

                }

                if(isset($field_input_id)){

                    $tmp_data_key = 'CRNRSTN_FIELD_HIDDEN_INPUT_ID';
                    $tmp_data_type_family = $tmp_dtf_FORM_HANDLE . '::' . $tmp_data_key;
                    $tmp_serialized_data_key = $this->oCRNRSTN->add_system_resource($tmp_data_key, $field_input_name, $tmp_data_type_family, CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
                    $this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY[$tmp_form_handle_hash][$tmp_data_type_family] = $tmp_serialized_data_key;

//                    $tmp_str = '$field_input_name=[' . $field_input_name . '].
//$tmp_data_key=[' . $tmp_data_key . '].
//$tmp_data_type_family=[' . $tmp_data_type_family . '].';
//                    $this->oCRNRSTN->spool_destruct_output($this->oCRNRSTN->print_r_str($tmp_str, NULL, NULL, __LINE__, __METHOD__, __FILE__));

                }

                if(isset($default_value)){

                    $tmp_data_key = 'DEFAULT_VALUE';
                    $tmp_data_type_family = $tmp_dtf_FORM_HANDLE . '::' . $tmp_data_key;
                    $tmp_serialized_data_key = $this->oCRNRSTN->add_system_resource($tmp_data_key, $default_value, $tmp_data_type_family, CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
                    $this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY[$tmp_form_handle_hash][$tmp_data_type_family] = $tmp_serialized_data_key;

//                    $tmp_str = '$default_value=[' . $default_value . '].
//$tmp_data_key=[' . $tmp_data_key . '].
//$tmp_data_type_family=[' . $tmp_data_type_family . '].';
//                    $this->oCRNRSTN->spool_destruct_output($this->oCRNRSTN->print_r_str($tmp_str, NULL, NULL, __LINE__, __METHOD__, __FILE__));

                }

                if(isset($table_field_name)){

                    $tmp_data_key = 'TABLE_FIELD_NAME';
                    $tmp_data_type_family = $tmp_dtf_FORM_HANDLE . '::' . $tmp_data_key;
                    $tmp_serialized_data_key = $this->oCRNRSTN->add_system_resource($tmp_data_key, $table_field_name, $tmp_data_type_family, CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
                    $this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY[$tmp_form_handle_hash][$tmp_data_type_family] = $tmp_serialized_data_key;

//                    $tmp_str = '$default_value=[' . $default_value . '].
//$tmp_data_key=[' . $tmp_data_key . '].
//$tmp_data_type_family=[' . $tmp_data_type_family . '].';
//                    $this->oCRNRSTN->spool_destruct_output($this->oCRNRSTN->print_r_str($tmp_str, NULL, NULL, __LINE__, __METHOD__, __FILE__));

                }

                if(isset($validation_constant_profile)){

                    $tmp_data_key = 'VALIDATION_CONSTANT_PROFILE';
                    $tmp_data_type_family = $tmp_dtf_FORM_HANDLE . '::' . $tmp_data_key;
                    $tmp_serialized_data_key = $this->oCRNRSTN->add_system_resource($tmp_data_key, $validation_constant_profile, $tmp_data_type_family, CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
                    $this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY[$tmp_form_handle_hash][$tmp_data_type_family] = $tmp_serialized_data_key;

//                    $tmp_str = '$validation_constant_profile=[' . $validation_constant_profile . '].
//$tmp_data_key=[' . $tmp_data_key . '].
//$tmp_data_type_family=[' . $tmp_data_type_family . '].';
//                    $this->oCRNRSTN->spool_destruct_output($this->oCRNRSTN->print_r_str($tmp_str, NULL, NULL, __LINE__, __METHOD__, __FILE__));

                }

                $tmp_data_key = 'IS_ENCRYPTED';
                $tmp_data_type_family = $tmp_dtf_FORM_HANDLE . '::' . $tmp_data_key;
                $tmp_serialized_data_key = $this->oCRNRSTN->add_system_resource($tmp_data_key, $encrypt_data, $tmp_data_type_family, CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
                $this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY[$tmp_form_handle_hash][$tmp_data_type_family] = $tmp_serialized_data_key;

//                $tmp_str = '$encrypt_data=[' . $encrypt_data . '].
//$tmp_data_key=[' . $tmp_data_key . '].
//$tmp_data_type_family=[' . $tmp_data_type_family . '].';
//                $this->oCRNRSTN->spool_destruct_output($this->oCRNRSTN->print_r_str($tmp_str, NULL, NULL, __LINE__, __METHOD__, __FILE__));

            }

        }catch (Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return NULL;

    }

    public function form_input_feedback_copy_add($crnrstn_form_handle, $validation_constant_profile, $field_input_name, $field_input_id = NULL, $err_msg = NULL, $success_msg = NULL, $info_msg = NULL){

//        $tmp_str = '$crnrstn_form_handle=[' . $crnrstn_form_handle . '].
//$validation_constant_profile=[' . $validation_constant_profile . '].
//$field_input_name=[' . $field_input_name . '].
//$field_input_id=[' . $field_input_id . '].
//$err_msg=[' . $err_msg . '].
//$success_msg=[' . $success_msg . '].
//$info_msg=[' . $info_msg . '].';
//        $this->oCRNRSTN->print_r($tmp_str, NULL, NULL, __LINE__, __METHOD__, __FILE__);

        try {

            $tmp_form_handle_hash = $this->hash($crnrstn_form_handle);
            $tmp_data_type_family = 'CRNRSTN_SYSTEM_RESOURCE::FORM_HANDLE::' . $tmp_form_handle_hash;
            if(!$this->oCRNRSTN->isset_data_key($crnrstn_form_handle, $tmp_data_type_family)){

                $this->form_serialize_new($crnrstn_form_handle);

            }

            $tmp_stripe_key_ARRAY = $this->oCRNRSTN->return_stripe_key_ARRAY('$crnrstn_form_handle', '$field_input_name');
            $tmp_param_err_str_ARRAY = $this->oCRNRSTN->return_regression_stripe_ARRAY('MISSING_STRING_DATA', $tmp_stripe_key_ARRAY, $field_input_name);

            $tmp_param_missing_str = $tmp_param_err_str_ARRAY['string'];
            $tmp_param_missing_ARRAY = $tmp_param_err_str_ARRAY['index_array'];

            if(count($tmp_param_missing_ARRAY) > 0){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('CRNRSTN :: Form handling configuration error ::. ' . $tmp_param_missing_str);

            }

            $tmp_form_handle_hash = $this->hash($crnrstn_form_handle);

            $tmp_data_key = 'CRNRSTN_FIELD_INPUT_NAME';
            $tmp_dtf_FORM_INPUT_VALIDATION = 'CRNRSTN_SYSTEM_RESOURCE::FORM_INPUT_VALIDATION::' . $tmp_form_handle_hash . '::' . $tmp_data_key;

            if(!isset($this->oCRNRSTN->crnrstn_data_packet_spoiler_ARRAY[$tmp_form_handle_hash][$tmp_dtf_FORM_INPUT_VALIDATION])){

                //
                // SPOIL
                $this->oCRNRSTN->crnrstn_data_packet_spoiler_ARRAY[$tmp_form_handle_hash][$tmp_dtf_FORM_INPUT_VALIDATION] = 1;

                $tmp_data_key = 'VALIDATION_PROFILE';
                $tmp_data_type_family = $tmp_dtf_FORM_INPUT_VALIDATION . '::' . $tmp_data_key;
                $tmp_serialized_data_key = $this->oCRNRSTN->add_system_resource($tmp_data_key, $validation_constant_profile, $tmp_data_type_family, CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
                $this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY[$tmp_form_handle_hash][$tmp_data_type_family] = $tmp_serialized_data_key;

//                $tmp_str = '$success_msg=[' . $success_msg . '].
//$tmp_data_key=[' . $tmp_data_key . '].
//$tmp_data_type_family=[' . $tmp_data_type_family . '].';
//                $this->oCRNRSTN->print_r($tmp_str, NULL, NULL, __LINE__, __METHOD__, __FILE__);

                if(isset($field_input_name)){

                    $tmp_data_key = 'CRNRSTN_FIELD_INPUT_NAME';
                    $tmp_data_type_family = $tmp_dtf_FORM_INPUT_VALIDATION . '::' . $tmp_data_key;
                    $tmp_serialized_data_key = $this->oCRNRSTN->add_system_resource($tmp_data_key, $field_input_name, $tmp_data_type_family, CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
                    $this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY[$tmp_form_handle_hash][$tmp_data_type_family] = $tmp_serialized_data_key;

//                    $tmp_str = '$field_input_name=[' . $field_input_name . '].
//$tmp_data_key=[' . $tmp_data_key . '].
//$tmp_data_type_family=[' . $tmp_data_type_family . '].';
//                    $this->oCRNRSTN->print_r($tmp_str, NULL, NULL, __LINE__, __METHOD__, __FILE__);

                }

                if(isset($field_input_id)){

                    $tmp_data_key = 'CRNRSTN_FIELD_INPUT_ID';
                    $tmp_data_type_family = $tmp_dtf_FORM_INPUT_VALIDATION . '::' . $tmp_data_key;
                    $tmp_serialized_data_key = $this->oCRNRSTN->add_system_resource($tmp_data_key, $field_input_id, $tmp_data_type_family, CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
                    $this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY[$tmp_form_handle_hash][$tmp_data_type_family] = $tmp_serialized_data_key;

//                    $tmp_str = '$field_input_id=[' . $field_input_id . '].
//$tmp_data_key=[' . $tmp_data_key . '].
//$tmp_data_type_family=[' . $tmp_data_type_family . '].';
//                    $this->oCRNRSTN->print_r($tmp_str, NULL, NULL, __LINE__, __METHOD__, __FILE__);

                }

                if(isset($err_msg)){

                    if(strlen($err_msg) > 0){

                        $tmp_data_key = 'ERR_MESSAGE';
                        $tmp_data_type_family = $tmp_dtf_FORM_INPUT_VALIDATION . '::' . $tmp_data_key;
                        $tmp_serialized_data_key = $this->oCRNRSTN->add_system_resource($tmp_data_key, $err_msg, $tmp_data_type_family, CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
                        $this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY[$tmp_form_handle_hash][$tmp_data_type_family] = $tmp_serialized_data_key;

//                        $tmp_str = '$err_msg=[' . $err_msg . '].
//$tmp_data_key=[' . $tmp_data_key . '].
//$tmp_data_type_family=[' . $tmp_data_type_family . '].';
//                    $this->oCRNRSTN->print_r($tmp_str, NULL, NULL, __LINE__, __METHOD__, __FILE__);
//                        $this->oCRNRSTN->spool_destruct_output($this->oCRNRSTN->print_r_str($tmp_str, NULL, NULL, __LINE__, __METHOD__, __FILE__));

                    }

                }

                if(isset($success_msg)){

                    if(strlen($success_msg) > 0){

                        $tmp_data_key = 'SUCCESS_MESSAGE';
                        $tmp_data_type_family = $tmp_dtf_FORM_INPUT_VALIDATION . '::' . $tmp_data_key;
                        $tmp_serialized_data_key = $this->oCRNRSTN->add_system_resource($tmp_data_key, $success_msg, $tmp_data_type_family, CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
                        $this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY[$tmp_form_handle_hash][$tmp_data_type_family] = $tmp_serialized_data_key;

//                        $tmp_str = '$success_msg=[' . $success_msg . '].
//$tmp_data_key=[' . $tmp_data_key . '].
//$tmp_data_type_family=[' . $tmp_data_type_family . '].';
//                        $this->oCRNRSTN->print_r($tmp_str, NULL, NULL, __LINE__, __METHOD__, __FILE__);

                    }

                }

                if(isset($info_msg)){

                    $tmp_data_key = 'INFO_MESSAGE';
                    $tmp_data_type_family = $tmp_dtf_FORM_INPUT_VALIDATION . '::' . $tmp_data_key;
                    $tmp_serialized_data_key = $this->oCRNRSTN->add_system_resource($tmp_data_key, $info_msg, $tmp_data_type_family, CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
                    $this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY[$tmp_form_handle_hash][$tmp_data_type_family] = $tmp_serialized_data_key;

//                    $tmp_str = '$info_msg=[' . $info_msg . '].
//$tmp_data_key=[' . $tmp_data_key . '].
//$tmp_data_type_family=[' . $tmp_data_type_family . '].';
//                    $this->oCRNRSTN->print_r($tmp_str, NULL, NULL, __LINE__, __METHOD__, __FILE__);

                }

            }

            return true;

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    private function return_serialized_input_fields_html($channel_constant, $crnrstn_form_handle){

        $tmp_form_handle_hash = $this->oCRNRSTN->hash($crnrstn_form_handle);

        $tmp_pssdtlp_data = $this->oCRNRSTN->crnrstn_data_packet_return($channel_constant, $tmp_form_handle_hash);
        $tmp_pssdtlp_data_encrypted = $this->oCRNRSTN->data_encrypt($tmp_pssdtlp_data);

        //
        // PERFORM INDEX (FORM_INPUT_NAME) AGGREGATION LAST
        $tmp_html_out  = '        <input type="hidden" name="crnrstn_session_salt" value="' . $this->oCRNRSTN->session_salt(). '">
';
        $tmp_html_out  .= '        <input type="hidden" name="crnrstn_pssdtlp_clear_text_bytes" value="' . strlen($tmp_pssdtlp_data) . '">
';
        $tmp_html_out  .= '        <input type="hidden" name="crnrstn_pssdtlp_encrypted_bytes" value="' . strlen($tmp_pssdtlp_data_encrypted) . '">
';
        $tmp_html_out  .= '        <input type="hidden" name="crnrstn_pssdtlp_hash" value="' . $this->oCRNRSTN->hash($tmp_pssdtlp_data) . '">
';
        $tmp_html_out  .= '        <input type="hidden" name="crnrstn_pssdtl_packet" value="' . $tmp_pssdtlp_data_encrypted . '">';
        $tmp_html_out .= $this->oCRNRSTN->crnrstn_data_packet_hidden_input_return($channel_constant, $tmp_form_handle_hash) . '
';
        $tmp_pssdtlp_index_str = $this->oCRNRSTN->form_integrations_data_index($tmp_form_handle_hash, 'string');

        if($channel_constant === CRNRSTN_OUTPUT_SSDTLA){

            $tmp_html_out  .= '        <input type="hidden" name="crnrstn_pssdtlp_index" value="' . $tmp_pssdtlp_index_str . '">
';
        }

        //$this->oCRNRSTN->print_r($tmp_html_out, NULL, NULL, __LINE__, __METHOD__, __FILE__);

        //error_log(__LINE__  . ' user ' . __METHOD__ . ' [' . print_r($tmp_html_out, true) . '].');

        return $tmp_html_out;

    }

//    public function get_lang_copy($data_key){
//
//        return $this->oCRNRSTN_ENV->get_lang_copy($data_key);
//
//    }
    
    public function return_crnrstn_mysqli($host = NULL, $db = NULL, $un = NULL, $port = NULL, $pwd = NULL){

        if (!isset($host)) {

            $tmp_host_hashable = $this->hash('{empty}');

        }else{

            $tmp_host_hashable = $this->hash($host);

        }

        if(!isset($db)){

            $tmp_db_hashable = $this->hash('{empty}');

        }else{

            $tmp_db_hashable = $this->hash($db);

        }

        if(!isset($un)){

            $tmp_un_hashable = $this->hash('{empty}');

        }else{

            $tmp_un_hashable = $this->hash($un);

        }

        if(!isset($port)){

            $tmp_port_hashable = $this->hash('{empty}');

        }else{

            $tmp_port_hashable = $this->hash($port);

        }

        if(!isset($pwd)){

            $tmp_pwd_hashable = $this->hash('{empty}');

        }else{

//
//            $tmp_form_handle_hash = hash($this->oCRNRSTN->system_hash_algo(), $crnrstn_form_handle);
//            $tmp_field_input_name_hash = hash($this->oCRNRSTN->system_hash_algo(), $field_input_name);

            $tmp_pwd_hashable = $this->hash($pwd);

        }

        $tmp_mysqli_serial = $this->hash($tmp_host_hashable . $tmp_db_hashable . $tmp_un_hashable . $tmp_port_hashable . $tmp_pwd_hashable);

        if(isset($this->oMySQLi_ARRAY[$tmp_mysqli_serial])){

            if($this->oMySQLi_ARRAY[$tmp_mysqli_serial]->ping()){

                //
                // THERE IS ALREADY AN OPEN DATABASE CONNECTION
                $this->oMySQLi_ARRAY[$tmp_mysqli_serial] = $this->oCRNRSTN->oMYSQLI_CONN_MGR->returnConnection($host, $db, $un, $port, $pwd);
                self::$oMySQLi_hash_ARRAY[] = $tmp_mysqli_serial;

            }

        }else{

            //error_log(__LINE__ . ' user I need to open a new connection [' . $tmp_mysqli_serial . '] now! ...mysqli not set.');
            $this->error_log('Opening a new MYSQLi database connection.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

            //
            // OPEN A DATABASE CONNECTION
            $this->oMySQLi_ARRAY[$tmp_mysqli_serial] = $this->oCRNRSTN->oMYSQLI_CONN_MGR->returnConnection($host, $db, $un, $port, $pwd);
            self::$oMySQLi_hash_ARRAY[] = $tmp_mysqli_serial;

        }

        //
        // RETURN CRNRSTN :: MYSQLI CONNECTION OBJECT
        $oCRNRSTN_MySQLi = new crnrstn_database_connection_handle($this);
        $oCRNRSTN_MySQLi->load_connection_serial($tmp_mysqli_serial);
        $oCRNRSTN_MySQLi->load_connection_obj($this->oMySQLi_ARRAY[$tmp_mysqli_serial]);

        $tmp_version_mysqli = $oCRNRSTN_MySQLi->version_mysqli;
        $this->oCRNRSTN->input_data_value($tmp_version_mysqli, 'version_mysqli', NULL, 0, CRNRSTN_AUTHORIZE_RUNTIME_ONLY, NULL);

        return $oCRNRSTN_MySQLi;

    }

    public function pushFakeyDBConn($fakey_mysqli_serial, $mysqli){

        $this->oMySQLi_ARRAY[$fakey_mysqli_serial] = $mysqli;
        self::$oMySQLi_hash_ARRAY[] = $fakey_mysqli_serial;

        return $mysqli;

    }

    public function return_oCRNRSTN_MySQLi_Fakey($fakey_mysqli_serial){

        $oCRNRSTN_MySQLi = new crnrstn_database_connection_handle($this);
        $oCRNRSTN_MySQLi->load_connection_serial($fakey_mysqli_serial);

        return $oCRNRSTN_MySQLi;

    }

    public function closeConnection_MySQLi($mysqli){

        //error_log("4122 user - I will manually close connection now!");
        $this->oCRNRSTN->oMYSQLI_CONN_MGR->closeConnection($mysqli);

    }

    public function openssl_get_cipher_methods(){

        return $this->oCRNRSTN_ENV->openssl_get_cipher_methods();

    }

    public function return_encrypt_settings($data = NULL, $encryption_channel = CRNRSTN_ENCRYPT_TUNNEL, $cipher_override = NULL, $secret_key_override = NULL, $hmac_algorithm_override = NULL, $options_bitwise_override = NULL){

        return $this->oCRNRSTN_ENV->return_encrypt_settings($data, $encryption_channel, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);

    }

    public function return_decrypt_settings($data = NULL, $encryption_channel = CRNRSTN_ENCRYPT_TUNNEL, $uri_passthrough = false, $cipher_override = NULL, $secret_key_override = NULL, $hmac_algorithm_override = NULL, $options_bitwise_override = NULL){

        return $this->oCRNRSTN_ENV->return_decrypt_settings($data, $encryption_channel, $uri_passthrough, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);

    }

    public function isset_encryption($encryption_channel){

        return $this->oCRNRSTN->oCRNRSTN_BITFLIP_MGR->is_bit_set($encryption_channel);

    }

    public function data_encrypt($data = NULL, $encryption_channel = CRNRSTN_ENCRYPT_TUNNEL, $cipher_override = NULL, $secret_key_override = NULL, $hmac_algorithm_override = NULL, $options_bitwise_override = NULL){

        return $this->oCRNRSTN_ENV->data_encrypt($data, $encryption_channel, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);

    }

    public function data_decrypt($data = NULL, $encryption_channel = CRNRSTN_ENCRYPT_TUNNEL, $uri_passthrough = false, $cipher_override = NULL, $secret_key_override = NULL, $hmac_algorithm_override = NULL, $options_bitwise_override = NULL){

        return $this->oCRNRSTN_ENV->data_decrypt($data, $encryption_channel, $uri_passthrough, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);

    }

    // REPLACED BY public function isset_encryption($encryption_channel)
    // OLD METHOD NAME: $this->is_tunnel_encrypt_configured()
    public function is_encryption_configured($encryption_channel, $cipher_override = NULL, $secret_key_override = NULL, $hmac_algorithm_override = NULL, $options_bitwise_override = NULL){

        $tmp_test_str = 'The quick brown fox jumped over the lazy dog.';
        $tmp_encryptedVal = $this->oCRNRSTN_ENV->data_encrypt($tmp_test_str, $encryption_channel, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);
        //error_log('5936 user - Fire Decrypt TEST...[' . $tmp_test_str.']==[' . $tmp_encryptedVal.']');
        $tmp_decryptedVal = $this->oCRNRSTN_ENV->data_decrypt($tmp_encryptedVal, $encryption_channel, true, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);
        //error_log('5938 user - Fire Decrypt TEST...[' . $tmp_test_str.']==[' . $tmp_decryptedVal.']');

        if ($tmp_test_str == $tmp_decryptedVal) {

            return true;

        } else {

            return false;

        }

    }

    public function param_database_encrypt($data = NULL, $cipher_override = NULL, $secret_key_override = NULL, $hmac_algorithm_override = NULL, $options_bitwise_override = NULL){

        return $this->oCRNRSTN_DATABASE->param_database_encrypt($data, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);

    }

    public function param_database_decrypt($data = NULL, $uri_passthrough = false, $cipher_override = NULL, $secret_key_override = NULL, $hmac_algorithm_override = NULL, $options_bitwise_override = NULL){

        return $this->oCRNRSTN_DATABASE->param_database_decrypt($data, $uri_passthrough, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);

    }

    private function compile_form_integration_packet($crnrstn_form_handle, $field_input_name, $encryption_status = TRUE, $server_side_validation = NULL){

        //
        // DATA PROFILE FOR SUCCESSFUL CRNRSTN FORM CAPTURE INTEGRATION
        # COMPILE TIMESTAMP (SERVER) 1 - 1
        # FORM HANDLE 1 - 1              $crnrstn_form_handle
        # FORM TUNNEL PROTOCOL 1 - 1  self::$form_handle_ARRAY[$crnrstn_form_handle]
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

        self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['input_name'][] = $field_input_name;

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

    private function return_form_integration_packet($crnrstn_form_handle){

        $tmp_html_out = '';
        $tmp_html_out .= $this->concatIntegrationPacketDatum(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['timestamp']);
        $tmp_html_out .= $this->concatIntegrationPacketDatum(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['crnrstn_form_handle']);
        $tmp_html_out .= $this->concatIntegrationPacketDatum(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['transport_protocol']);

        $tmp_input_cnt = sizeof(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['input_name']);
        for ($i = 0; $i < $tmp_input_cnt; $i++) {

            $tmp_html_out .= $this->concatIntegrationPacketDatum($i, ':');
            $tmp_html_out .= $this->concatIntegrationPacketDatum(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['input_name'][$i], ':');
            $tmp_html_out .= $this->concatIntegrationPacketDatum(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['input_encrypt'][$i], ':');
            $tmp_html_out .= $this->concatIntegrationPacketDatum(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['input_validation'][$i], ':');

            $tmp_html_out = rtrim($tmp_html_out, ':');

            //self::$formIntegrationPacket_ARRAY['input_name']
            //self::$formIntegrationPacket_ARRAY['input_encrypt']
            //self::$formIntegrationPacket_ARRAY['input_validation']

            $tmp_html_out = $this->concatIntegrationPacketDatum($tmp_html_out);

            # <input type="hidden" name="crnrstn_pssdtl_packet" value="">
            /*

            value="TIMESTAMP[CRNRSTN::2.0.0]FORM_HANDLE[CRNRSTN::2.0.0]TUNNEL_PROTOCOL[CRNRSTN::2.0.0]
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
            $tmp_html_out = $this->oCRNRSTN_ENV->data_encrypt($tmp_html_out);
            $tmp_array = $this->return_encrypt_settings($tmp_html_out, CRNRSTN_ENCRYPT_TUNNEL);

            //if(!$this->isset_session_param('ENCRYPT_PARAMS')){
            if(!$this->isset_data_key('ENCRYPT_PARAMS')){

                $tmp_array_outer[] = $tmp_array;

                $this->oCRNRSTN->add_system_resource($tmp_array_outer, 'ENCRYPT_PARAMS', 0, 'CRNRSTN_SYSTEM_RESOURCE::FORM_INTEGRATIONS', CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
                //$this->input_data_value($tmp_array_outer, 'ENCRYPT_PARAMS', NULL, 0, NULL, $this->env_key);
                //$this->set_session_param('ENCRYPT_PARAMS', $tmp_array_outer);

            } else{

                $tmp_array_outer_sess = $this->get_resource('ENCRYPT_PARAMS');
                //$tmp_array_outer_sess = $this->get_session_param('ENCRYPT_PARAMS');

                $tmp_array_outer_sess[] = $tmp_array;

                $this->oCRNRSTN->add_system_resource($tmp_array_outer_sess, 'ENCRYPT_PARAMS', 0, 'CRNRSTN_SYSTEM_RESOURCE::FORM_INTEGRATIONS', CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
                //$this->input_data_value($tmp_array_outer_sess, 'ENCRYPT_PARAMS', NULL, 0, NULL, $this->env_key);
                //$this->set_session_param('ENCRYPT_PARAMS', $tmp_array_outer_sess);

            }

            if ($tmp_html_out != "") {

                $tmp_encrypted_flag = true;

            }

        }

        $tmp_html_out = '<input type="hidden" name="crnrstn_pssdtl_packet" value="' . $tmp_html_out . '">';

        if ($tmp_encrypted_flag) {

            $tmp_html_out .= '<input type="hidden" name="crnrstn_pssdtl_packet_ENCRYPTED" value="true">';

        }

        return $tmp_html_out;

    }
    
    public function add_database_query($result_set_key, $query_override = NULL){

        try {

            $oCRNRSTN_MySQLi = $this->oCRNRSTN_QPM->return_MySQLi($result_set_key);
            $result_handle = $this->oCRNRSTN_QPM->return_resultHandle($result_set_key);
            $batch_key = $this->oCRNRSTN_QPM->return_batchKey($result_set_key);

            if (is_object($oCRNRSTN_MySQLi)) {

                if (!isset($query_override)) {

                    $tmp_query = self::$oSqlSilo->returnDatabaseQuery($this, $oCRNRSTN_MySQLi, $result_set_key);

                    if(strlen($tmp_query)<1){

                        $tmp_query = 'No query was able to be loaded.';

                    }

                }else {

                    $tmp_query = $query_override;

                }

                $this->error_log('Adding database query to CRNRSTN :: Batch Key=' . $batch_key . ' Result Set Key=' . $result_set_key, __LINE__, __METHOD__, __FILE__, CRNRSTN_DATABASE_QUERY);

                if (isset($query_override)) {

                    //
                    // LOAD QUERY - OVERRIDE
                    // DATABASE QUERY/CONNECTION CRNRSTN CONTACT POINT
                    return $this->oCRNRSTN_DATABASE->load_database_query($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $query_override);

                } else {

                    //
                    // PROCESS QUERY VIA CENTRALIZED DATABASE RESOURCES
                    $query = self::$oSqlSilo->returnDatabaseQuery($this, $oCRNRSTN_MySQLi, $result_set_key);

                    if (strlen($query) > 0) {

                        //
                        // DATABASE QUERY/CONNECTION CRNRSTN CONTACT POINT
                        return $this->oCRNRSTN_DATABASE->load_database_query($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $query);

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

            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }
    
    public function process_query($application_acceleration = true, $oCRNRSTN_MySQLi = NULL, $batch_key = NULL, $result_set_key = NULL, $result_handle = NULL, $query_override = NULL){

        if (is_bool($application_acceleration)) {

            $tmp_request_serial = $this->generate_new_key(50);

            //
            // TRACK ON THIS AND KEY OFF OF IT TO ACTIVATE APPLICATION ACCELERATION
            // THROUGH REUSE OF RESULT SET ARRAY DATA vs FORCE REFRESH OF THE SAME.
            $this->oCRNRSTN_DATABASE->receive_process_query_param('sql_accelerate_FLAG', $application_acceleration, $tmp_request_serial);

            if (isset($oCRNRSTN_MySQLi)) {

                $this->oCRNRSTN_DATABASE->receive_process_query_param('oCRNRSTN_MySQLi', $oCRNRSTN_MySQLi, $tmp_request_serial);

            }

            if (isset($batch_key)) {

                $this->oCRNRSTN_DATABASE->receive_process_query_param('batch_key', $batch_key, $tmp_request_serial);

            }

            if (isset($result_set_key)) {

                $this->oCRNRSTN_DATABASE->receive_process_query_param('result_set_key', $result_set_key, $tmp_request_serial);

            }

            if (isset($result_handle)) {

                $this->oCRNRSTN_DATABASE->receive_process_query_param('result_handle', $result_handle, $tmp_request_serial);

            }

            if (isset($query_override)) {

                $this->oCRNRSTN_DATABASE->receive_process_query_param('query_override', $query_override, $tmp_request_serial);

            }

            //
            // PROCESS
            return $this->oCRNRSTN_DATABASE->process_query($tmp_request_serial);

        } else {

            //
            // HOOOSTON...VE HAF PROBLEM!
            $this->error_log('CRNRSTN :: ERROR :: No Database query processed. Please indicate (BOOLEAN) desire for application acceleration...as CRNRSTN :: prepares to touch database with SQL.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_DATABASE');

        }

        return false;

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

                                    //error_log(__LINE__ . ' user run DECRYPT ON ' . $packet_received_array['INPUT_NAME'] . ' data=[' . $this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME']) . ']');

                                    //
                                    // THIS WANTS TRUE ON URI PASSTHROUGH. CAN DO CHECK FOR '%' FOR URLDECODE DETECT, IF WE FIND OURSELVES BACK HERE AGAIN.
                                    self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = $this->oCRNRSTN_ENV->data_decrypt($this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME']), CRNRSTN_ENCRYPT_TUNNEL, true);

                                    //error_log(__LINE__ . ' user DECRYPT OF INPUT_NAME=[' . print_r(self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']], true) . ']');

                                } else {

                                    //error_log(__LINE__ . ' user NO INPUT_ENCRYPT $packet_received_array[' . $this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME']) . ']]');

                                    self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = $this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME']);

                                }

                                //error_log('4445 - ' . $packet_received_array['INPUT_NAME'] . '=' . self::$http_param_handle_ARRAY[$packet_received_array['INPUT_NAME']]);

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

                                    self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = $this->oCRNRSTN_ENV->data_decrypt($this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME']));

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
                            //error_log(__LINE__ . ' user receive POST DATA :: ' . $this->oCRNRSTN_ENV->data_decrypt($this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME'])));
                            self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = $this->oCRNRSTN_ENV->data_decrypt($this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME']));

                        } else {

                            //error_log(__LINE__ . ' user receiving CLEAR TEXT POST DATA');
                            //error_log(__LINE__ . ' user receive POST DATA :: ' . $this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME']));

                            self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = $this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME']);

                        }

                        // error_log('4483 - ' . $packet_received_array['INPUT_NAME'] . '=' . self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']]);

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

                                    self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = $this->oCRNRSTN_ENV->data_decrypt($this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, $packet_received_array['INPUT_NAME'], true));

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

                                // error_log('4514 - ' . $packet_received_array['INPUT_NAME'].'='.self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']]);

                            break;
                            case 'false':
                                //
                                // NOTHING TO DO. JUST KIDDING...
                                // error_log('4790 user - I think that I have nothing to do.');
                                if ($packet_received_array['INPUT_ENCRYPT'] == 'true') {

                                    self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = $this->oCRNRSTN_ENV->data_decrypt($this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, $packet_received_array['INPUT_NAME']), CRNRSTN_ENCRYPT_TUNNEL, true);

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

                            self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = $this->oCRNRSTN_ENV->data_decrypt($this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, $packet_received_array['INPUT_NAME']));

                        } else {

                            self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = $this->oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, $packet_received_array['INPUT_NAME']);

                        }

                        //error_log('4913 user - ' . $packet_received_array['INPUT_NAME'] . '=' . self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']]);

                    }

                    break;

            }

        } catch (Exception $e) {

            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

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
    
    public function addCookie($name, $value = NULL, $expire = NULL, $path = NULL, $domain = NULL, $secure = NULL, $httponly = NULL){

        return $this->oCRNRSTN_ENV->oCOOKIE_MGR->addCookie($name, $value, $expire, $path, $domain, $secure, $httponly);

    }

    public function addRawCookie($name, $value = NULL, $expire = NULL, $path = NULL, $domain = NULL, $secure = NULL, $httponly = NULL){

        return $this->oCRNRSTN_ENV->oCOOKIE_MGR->addRawCookie($name, $value, $expire, $path, $domain, $secure, $httponly);

    }

    public function getCookie($name){

        return $this->oCRNRSTN_ENV->oCOOKIE_MGR->getCookie($name);

    }
    
    public function deleteCookie($name, $path = NULL){

        return $this->oCRNRSTN_ENV->oCOOKIE_MGR->deleteCookie($name, $path);

    }

    public function deleteAllCookies($path = NULL){

        return $this->oCRNRSTN_ENV->oCOOKIE_MGR->deleteAllCookies($path);

    }
    
    public function returnHeaders($returnType = NULL){

        return $this->oCRNRSTN_ENV->oHTTP_MGR->getHeaders($returnType);

    }

    public function isset_http_param($param, $transport_protocol = 'POST'){

        //
        // WE WILL STILL TAKE $_POST, $_GET, etc...ONLY NEED THIS FOR HTTP AT THE MOMENT.
        // IF SENDING STRING, ONLY THINGS LIKE 'POST', '$_POST', OR 'GET'...etc...WILL WORK. NOT 'FILE'. NOT 'SESSION'...
        if(is_array($transport_protocol)){

            return $this->oCRNRSTN_ENV->issetHTTP($transport_protocol);

        }

        $http_protocol = strtoupper($transport_protocol);
        $http_protocol = $this->str_sanitize($http_protocol, 'http_protocol_simple');

        try {

            switch ($http_protocol) {
                case 'POST':

                    if($this->oCRNRSTN_ENV->oHTTP_MGR->issetParam($_POST, $param)){

                            return true;

                    }else{

                        return false;

                    }

                default:

                    //
                    // $_GET
                    if($this->oCRNRSTN_ENV->oHTTP_MGR->issetParam($_GET, $param)){

                            return true;

                    }else{

                        return false;

                    }

                break;

            }

        } catch (Exception $e) {

            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function extract_data_HTTP($param, $transport_protocol = 'GET', $tunnel_encrypted = false){

        //
        // WE WILL STILL TAKE $_POST, $_GET, etc...ONLY NEED THIS FOR HTTP AT THE MOMENT.
        // IF SENDING STRING, ONLY THINGS LIKE 'POST', '$_POST', OR 'GET'...etc...WILL WORK. NOT 'FILE'. NOT 'SESSION'...
        if(is_array($transport_protocol)){

            return $this->oCRNRSTN_ENV->oHTTP_MGR->extractData($transport_protocol, $param, $tunnel_encrypted);

        }

        $http_protocol = strtoupper($transport_protocol);
        $http_protocol = $this->str_sanitize($http_protocol, 'http_protocol_simple');

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
                        //throw new Exception('The desired HTTP _' . $http_protocol . ' parameter, ' . $param . ', is not available.');
                        //$this->error_log('The desired HTTP _' . $http_protocol . ' parameter, ' . $param . ', is not available.', __LINE__, __METHOD__, __FILE__,CRNRSTN_SETTINGS_CRNRSTN);

                        return false;

                    }

                break;
            }

        } catch (Exception $e) {

            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function isset_SERVER_param($param){

        return $this->oCRNRSTN_ENV->isset_ServerArrayVar($param);

    }

    public function wall_time(){

        return $this->oCRNRSTN_ENV->wall_time();

    }

    public function return_micro_time(){

        return $this->oLogger->returnMicroTime();

    }

    public function return_query_date_time_stamp(){

        //$ts = date("Y-m-d H:i:s", time());

        return $this->oCRNRSTN->return_query_date_time_stamp();

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

    public function monitoring_delta_time_for($watchKey, $decimal = 8){

        return $this->oCRNRSTN_ENV->monitoringDeltaTimeFor($watchKey, $decimal);

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
                //error_log("finite (194) test ->" . $bit_plural[$k]);

            }else{

                if($v == 1){

                    $ret[] = $v . $bit_singular[$k];
                    //error_log("finite (200) test ->" . $bit_singular[$k]);

                }

            }

        }

//        foreach($bit_singular as $k => $v){
//            if($v > 1)$ret[] = $v . $k . 's';           // APPENDING AN S FOR PLURAL IS PRIMARILY ENGLISH. WE CAN'T RELY ON THIS APPEND FOR OUR PURPOSES.
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
                //error_log("finite (194) test ->" . $bit_plural[$k]);

            }else{

                if($v == 1){

                    $ret[] = $v . $bit_singular[$k];
                    //error_log("finite (200) test ->" . $bit_singular[$k]);

                }

            }

        }

//        foreach($bit_singular as $k => $v){
//            if($v > 1)$ret[] = $v . $k . 's';           // APPENDING AN S FOR PLURAL IS PRIMARILY ENGLISH. WE CAN'T RELY ON THIS APPEND FOR OUR PURPOSES.
//            if($v == 1)$ret[] = $v . $k;
//        }

        array_splice($ret, count($ret)-1, 0, self::$lang_content_ARRAY['AND']);
        $ret[] = self::$lang_content_ARRAY['AGO'];

        return join(' ', $ret);

    }

    public function isDateOlderThan($duration_seconds, $start_time_seconds = NULL, $qualification_pattern = NULL){

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
                    $qualification_pattern = '- ' . $qualification_pattern;
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

    public function isDateNewerThan($duration_seconds, $qualification_pattern = NULL){

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
                    $qualification_pattern = '- ' . $qualification_pattern;
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

    public function elapsed_delta_time_for($watchKey, $decimal = 8){

        return $this->oCRNRSTN_ENV->monitoringDeltaTimeFor($watchKey, $decimal);

    }

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
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }
    }
    
    public function get_session_param($data_key){

        error_log(__LINE__ . ' APPLICATION ARCHITECTURE ERROR!!! ' . __METHOD__ . '(\'' . $data_key . '\'):: IS DEPRICATED.');
        die();

        return $this->oCRNRSTN_ENV->oSESSION_MGR->get_session_param($name);

    }

    public function set_session_param($name, $value = ''){

        return $this->oCRNRSTN_ENV->oSESSION_MGR->set_session_param($name, $value);

    }
    
    public function isset_data_key($data_key){

        try {

            if(isset($data_key)) {

                return $this->oCRNRSTN_ENV->oCRNRSTN->isset_data_key($data_key);

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No variable name has been provided for the session parameter that is to be checked to determine if it is currently set with a value.');

            }

        } catch (Exception $e) {

            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function define_env_resource($key, $value){

        $this->oCRNRSTN_ENV->oSESSION_MGR->set_session_param($key, $value);

    }
    
    public function isset_http_superglobal($transport_protocol = 'POST'){

        //
        // WE WILL STILL TAKE $_POST, $_GET, etc...ONLY NEED THIS FOR HTTP AT THE MOMENT.
        // IF SENDING STRING, ONLY THINGS LIKE 'POST', '$_POST', OR 'GET'...etc...WILL WORK. NOT 'FILE'. NOT 'SESSION'...
        if(is_array($transport_protocol)){

            return $this->oCRNRSTN_ENV->issetHTTP($transport_protocol);

        }

        $http_protocol = strtoupper($transport_protocol);
        $http_protocol = $this->str_sanitize($http_protocol, 'http_protocol_simple');

        return $this->oCRNRSTN_ENV->issetHTTP($http_protocol);

    }

    public function load_query_profile($result_handle, $batch_key, $result_set_key = NULL, $lnum = NULL, $method = NULL){

        if(!isset($result_set_key) || $result_set_key == '' ){

            if(isset($method)){

                $tmp_method = '[method ' . $method . '] ';

            }else{

                $tmp_method = '';

            }

            if(isset($lnum)){

                $tmp_lnum = '[lnum ' . $lnum . '] ';

            }else{

                $tmp_lnum = '';

            }

            $result_set_key = $tmp_lnum . $tmp_method . $this->generate_new_key(25);
            $tmp_output = $result_set_key;

        }

        $this->oCRNRSTN_QPM->loadQueryProfile($result_handle, $batch_key, $result_set_key);

        if(isset($tmp_output)){

            return $tmp_output;

        }

        return $result_set_key;

    }

    public function return_record_count($result_set_key){

        try {

            $oCRNRSTN_MySQLi = $this->oCRNRSTN_QPM->return_MySQLi($result_set_key);

            if(is_object($oCRNRSTN_MySQLi)){

                $result_handle = $this->oCRNRSTN_QPM->return_resultHandle($result_set_key);
                $batch_key = $this->oCRNRSTN_QPM->return_batchKey($result_set_key);

                if (!is_object($oCRNRSTN_MySQLi) || !isset($result_handle) || !isset($batch_key) || !isset($result_set_key)) {

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Missing input parameter(s) for this method.');

                } else {

                    return $this->oCRNRSTN_DATABASE->return_record_count($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key);

                }

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key . '].');

            }

        } catch (Exception $e) {

            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function isset_query_result_set_key($result_set_key){

        return false;

        return $this->oCRNRSTN_QPM->isset_query_result_set_key($result_set_key);

    }

    public function load_previous_record_lookup($result_set_key, $lookupSerial){

        try {

            $oCRNRSTN_MySQLi = $this->oCRNRSTN_QPM->return_MySQLi($result_set_key);

            if (is_object($oCRNRSTN_MySQLi)) {

                $result_handle = $this->oCRNRSTN_QPM->return_resultHandle($result_set_key);
                $batch_key = $this->oCRNRSTN_QPM->return_batchKey($result_set_key);

                $this->oCRNRSTN_DATABASE->load_previous_record_lookup($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $lookupSerial);

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key . '].');

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }
    
    public function init_lookup_by_id($result_set_key){

        try {

            $oCRNRSTN_MySQLi = $this->oCRNRSTN_QPM->return_MySQLi($result_set_key);

            if (is_object($oCRNRSTN_MySQLi)) {

                $result_handle = $this->oCRNRSTN_QPM->return_resultHandle($result_set_key);
                $batch_key = $this->oCRNRSTN_QPM->return_batchKey($result_set_key);

                $this->oCRNRSTN_DATABASE->init_lookup_by_id($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key);

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key . '].');

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);
            //$this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__, CRNRSTN_LOG_EMAIL, 'j5@jony5.com');

            return false;

        }

    }
    
    public function add_lookup_field_data($result_set_key, $field_name, $field_value){

        try {

            $oCRNRSTN_MySQLi = $this->oCRNRSTN_QPM->return_MySQLi($result_set_key);

            if (is_object($oCRNRSTN_MySQLi)) {

                $result_handle = $this->oCRNRSTN_QPM->return_resultHandle($result_set_key);
                $batch_key = $this->oCRNRSTN_QPM->return_batchKey($result_set_key);

                return $this->oCRNRSTN_DATABASE->add_lookup_field_data($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $field_name, $field_value);

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key . '].');

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function retrieve_data_by_id($result_set_key, $lookup_fieldname, $piped_primary_id_fields = NULL, $piped_lookup_id_data = NULL){

        try {

            $oCRNRSTN_MySQLi = $this->oCRNRSTN_QPM->return_MySQLi($result_set_key);

            if (is_object($oCRNRSTN_MySQLi)) {

                $result_handle = $this->oCRNRSTN_QPM->return_resultHandle($result_set_key);
                $batch_key = $this->oCRNRSTN_QPM->return_batchKey($result_set_key);

                $this->oCRNRSTN_DATABASE->keyDataByID($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $piped_primary_id_fields);

                return $this->oCRNRSTN_DATABASE->retrieve_data_by_id($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $lookup_fieldname, $piped_lookup_id_data);

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key . '].');

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function ping_value_existence($result_set_key, $fieldname, $value){

        try {

            $oCRNRSTN_MySQLi = $this->oCRNRSTN_QPM->return_MySQLi($result_set_key);

            if (is_object($oCRNRSTN_MySQLi)) {

                $result_handle = $this->oCRNRSTN_QPM->return_resultHandle($result_set_key);
                $batch_key = $this->oCRNRSTN_QPM->return_batchKey($result_set_key);

                return $this->oCRNRSTN_DATABASE->ping_value_existence($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $fieldname, $value);

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key . '].');

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }
    
    public function ping_result_set_existence($result_set_key){

        try {

            $oCRNRSTN_MySQLi = $this->oCRNRSTN_QPM->return_MySQLi($result_set_key);

            if (is_object($oCRNRSTN_MySQLi)) {

                $result_handle = $this->oCRNRSTN_QPM->return_resultHandle($result_set_key);
                $batch_key = $this->oCRNRSTN_QPM->return_batchKey($result_set_key);

                return $this->oCRNRSTN_DATABASE->pingProfileExistence($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key);

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key . '].');

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }
    
    public function resultSetMerge($result_set_key, $target_result_set_key, $merge_fields_piped, $merge_fields_distinct_val = true, $sequence_fields_piped = null, $sequence_fields_datatype_piped = null){

        try {

            $oCRNRSTN_MySQLi = $this->oCRNRSTN_QPM->return_MySQLi($result_set_key);

            if (is_object($oCRNRSTN_MySQLi)) {

                $result_handle = $this->oCRNRSTN_QPM->return_resultHandle($result_set_key);
                $batch_key = $this->oCRNRSTN_QPM->return_batchKey($result_set_key);

                if (isset($result_handle) && isset($batch_key) && isset($result_set_key) && isset($target_result_set_key) && isset($merge_fields_piped)) {

                    return $this->oCRNRSTN_DATABASE->resultSetMerge($this->oCRNRSTN_QPM, $result_handle, $batch_key, $result_set_key, $target_result_set_key, $merge_fields_piped, $merge_fields_distinct_val, $sequence_fields_piped, $sequence_fields_datatype_piped);

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

            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function return_clean_json_string($val){

        return $this->oCRNRSTN->return_clean_json_string($val);

    }

    public function return_database_value($result_set_key, $fieldname, $pos = 0, $json_out = false){

        try {

            $oCRNRSTN_MySQLi = $this->oCRNRSTN_QPM->return_MySQLi($result_set_key);

            if (is_object($oCRNRSTN_MySQLi)) {

                $result_handle = $this->oCRNRSTN_QPM->return_resultHandle($result_set_key);
                $batch_key = $this->oCRNRSTN_QPM->return_batchKey($result_set_key);

                if (isset($result_handle) && isset($batch_key) && isset($result_set_key) && isset($fieldname)) {

                    if($json_out){

                        $db_resp_out = $this->oCRNRSTN_DATABASE->return_database_value($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $fieldname, $pos);

                        //
                        // SOURCE :: https://www.php.net/manual/en/json.constants.php
                        // AUTHOR :: majid4466 at gmail dot com :: https://www.php.net/manual/en/json.constants.php#119565
                        $db_resp_out = $this->return_clean_json_string($db_resp_out);

                        return $db_resp_out;

                    }else{

                        return $this->oCRNRSTN_DATABASE->return_database_value($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $fieldname, $pos);

                    }

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

            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }
    
    public function create_AdHocVar($key, $var = NULL){

        //
        // TODO :: CONSIDER USING oDDO HERE...FOR '' SUPPORT.
        self::$adHocVariable_ARRAY[$key] = $var;

        return NULL;

    }

    public function get_AdHocVar($key){

        if (isset(self::$adHocVariable_ARRAY[$key])) {

            return self::$adHocVariable_ARRAY[$key];

        } else {

            return NULL;

        }

    }
    
    public function specifyPaginationVariableName($variable_name, $pagination_serial = NULL){

        self::$oPaginator->specify_pagination_variable_name($variable_name, $pagination_serial);

    }

    public function getPaginationVariableName($pagination_serial = NULL){

        return self::$oPaginator->get_pagination_variable_name($pagination_serial);

    }

    public function addPaginationPassthroughInputVal($input_name, $input_value, $pagination_serial){

        self::$oPaginator->add_pagination_passthrough_input_val($input_name, $input_value, $pagination_serial);

    }

    public function returnCurrentPaginationPos($pagination_serial = NULL){

        $tmp_var_name = $this->getPaginationVariableName($pagination_serial);
        $tmp_pos = $this->get_http_resource($tmp_var_name);

        if ($tmp_pos == '') {

            $tmp_pos = 1;

        }

        return $tmp_pos;

    }
    
    public function returnPaginationSerial(){

        return self::$oPaginator->return_pagination_serial();

    }
    
    public function returnPaginationStateHTML($pagination_serial = NULL){

        return self::$oPaginator->return_pagination_state_HTML($pagination_serial);

    }

    public function increment_results_count_total($result_count = 1, $pagination_serial = NULL){

        //error_log('5531 user - increment_results_count_total [' . $result_count . ']');
        self::$oPaginator->increment_results_count_total($result_count, $pagination_serial);

    }

    public function set_maximum_display_result_count($maximum_display_count, $pagination_serial = NULL){

        self::$oPaginator->set_maximum_display_result_count($maximum_display_count, $pagination_serial);

    }

    //
    // SOURCE :: https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
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

        return $this->oCRNRSTN->salt($len, $char_selection);

    }

    //
    // METHOD SOURCE :: Stack Overflow :: https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
    // Contributor :: https://stackoverflow.com/users/4895359/yumoji
    private function crypto_rand_secure($min, $max){

        $range = $max - $min;

        if($range < 1) return $min; // not so random...

        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1

        do{

            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits

        }while($rnd > $range);

        return $min + $rnd;

    }

    //
    // SOURCE :: https://stackoverflow.com/questions/5100189/use-php-to-check-if-page-was-accessed-with-ssl
    // AUTHOR :: https://stackoverflow.com/users/887067/saeven
    public function isSSL(){

        if(!empty( $_SERVER['HTTPS'] ) && ($_SERVER['HTTPS'] != 'off'))
            return true;

        if(!empty( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
            return true;

        return false;

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.highlight-string.php
    // AUTHOR :: stanislav dot eckert at vizson dot de :: https://www.php.net/manual/en/function.highlight-string.php#118550
    public function highlight_text($text, $theme_style = CRNRSTN_UI_PHPNIGHT){

        return $this->oCRNRSTN->highlight_text($text, $theme_style);

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

    public function get_error_log_trace($output_profile, $log_silo_profile = CRNRSTN_LOG_ALL, $line_num = NULL, $method = NULL, $file = NULL, $output_profile_override_meta = NULL){

        try{

            if($this->CRNRSTN_debug_mode() < 2){

                //
                // HOOOSTON...VE HAF PROBLEM!
                //throw new Exception('Unable to retrieve log trace data due to CRNRSTN being in configuration of CRNRSTN_debug_mode="' . $this->CRNRSTN_debug_mode().'"...which setting does not authorize resource allocation enabling aggregation of error log data in server memory.');

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
                            throw new Exception('The provided logging output profile, "' . $output_profile . '", is not supported by CRNRSTN ::. Please choose between the following options :: [CRNRSTN_LOG_EMAIL, CRNRSTN_LOG_EMAIL_PROXY, CRNRSTN_LOG_FILE, CRNRSTN_LOG_SCREEN_TEXT, CRNRSTN_LOG_SCREEN, CRNRSTN_LOG_SCREEN_HTML, CRNRSTN_LOG_SCREEN_HTML_HIDDEN, CRNRSTN_LOG_DEFAULT,..etc.]');

                        break;

                    }

                }

                $this->oLogger->get_error_log_trace($output_profile, $output_profile_override_meta, $log_silo_profile, $line_num, $method, $file, $this);

            }

        } catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return NULL;

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

    public function return_client_ip(){

        return $this->oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->clientIpAddress();

    }

    public function exclusiveAccess($ip='*.*'){

        return $this->oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->exclusiveAccess($ip);

    }

    public function denyIPAccess($ip='*.*'){

        return $this->oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->denyIPAccess($ip);

    }

    public function str_sanitize($str, $type){

        return $this->oCRNRSTN->str_sanitize($str, $type);

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
    // SOURCE :: https://www.php.net/manual/en/function.readfile.php
    // AUTHOR :: flobee at gmail dot com :: https://www.php.net/manual/en/function.readfile.php#52598
    public function readfile_chunked($filename, $retbytes = true) {

        $chunksize = 1 * (1024 * 1024); // how many bytes per chunk
        $buffer = '';
        $cnt = 0;

        // $handle = fopen($filename, 'rb');
        $handle = fopen($filename, 'rb');

        if($handle === false){

            return false;

        }

        while(!feof($handle)){

            $buffer = fread($handle, $chunksize);
            echo $buffer;

            if ($retbytes) {

                $cnt += strlen($buffer);

            }

        }

        $status = fclose($handle);

        if ($retbytes && $status) {

            return $cnt; // return num. bytes delivered like readfile() does.

        }

        return $status;

    }

    public function number_format_keep_precision($number, $dec_places = 0, $dec_point = '.', $thou_separate = ','){

        if($dec_places > 0){

            return number_format($number , $dec_places , $dec_point, $thou_separate);

        }else{

            //
            // SOURCE :: https://www.php.net/manual/en/function.number-format.php
            // AUTHOR :: stm555 at hotmail dot com :: https://www.php.net/manual/en/function.number-format.php#52311
            $broken_number = explode($dec_point, $number);
            if(isset($broken_number[1])){

                return number_format($broken_number[0] , 0 , $dec_point, $thou_separate) . $dec_point . $broken_number[1];

            }else{

                return number_format($broken_number[0] , 0 , $dec_point, $thou_separate);

            }

        }

    }

    //
    // SOURCE :: https://stackoverflow.com/questions/2510434/format-bytes-to-kilobytes-megabytes-gigabytes
    // AUTHOR :: https://stackoverflow.com/users/227532/leo
    public function format_bytes($bytes, $precision = 2, $SI_output = false) {

        //
        // CRNRSTN v2.0.0 :: MODS
        // SEE :: https://en.wikipedia.org/wiki/Binary_prefix
        // SEE ALSO :: ISO/IEC 80000 family of standards (November 1, 2009)
        // https://en.wikipedia.org/wiki/ISO/IEC_80000#Information_science_and_technology
        // SEE COMMENT BY DEVATOR [https://stackoverflow.com/users/659731/devator] JUST
        // BENEATH THE METHOD [format_bytes()] AUTHOR'S RESPONSE AT SOURCE LINK. THIS IS MY
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

        return $tmp_number . ' ' . $units[$pow];

    }

    public function return_creative($media_element_key, $image_output_mode = NULL){

        return $this->oCRNRSTN_ASSET_MGR->return_creative($media_element_key, $image_output_mode);

    }

    public function return_sticky_media_link($media_element_key, $url = NULL, $target = '_blank', $email_channel = false){

        // TESTING NOTE:
        // IS IT POSSIBLE FOR Z-INDEX TO CAUSE TROUBLE (...AS THE DEEPEST DOM ELEM IS ABSOLUTE POSITIONED)?
        /*
        SOUNDCLOUD
        FACEBOOK
        INSTAGRAM
        TWITTER
        WWW
        JSON
        APPLE_ANDROID
        FEEDBURNER
        SLASHDOT_ICON
        XHAMSTER_ICON
        MOZILLA_ICON
        MIXCLOUD
        DISCOGS
        BEATPORT
        BANDCAMP
        SPOTIFY
        ROLLDABEATS
        STACKOVERFLOW
        KINK
        PHP
        REDDIT
        YOUTUBE
        PAYPAL
        HISTORY
        ARCHIVES
        BASSDRIVE
        GITHUB_ICON
        XNXX
        LINKEDIN
        GOOGLE_MAPS_ANNIVERSARY
        FLICKR
        WIKIPEDIA
        BLOGSPOT
        PINTEREST
        SERVER_FAULT
        GOOGLE_DRIVE
        BLUEHOST_ICON
        AMAZON
        PORNHUB
        EBAY
        MOZILLA_WORDMARK
        PATREON
        TWITCH
        MICROSOFT
        INTERNET_ARCHIVE
        W3C
        XHAMSTER_WORDMARK
        ETSY
        APPLE_MUSIC
        XVIDEOS
        SLASHDOT_WORDMARK
        VIMEO_BLUE_ICON
        IDEONE
        GOOGLE_MAPS_SQUARE
        BLUEHOST_WORDMARK
        PANDORA
        LAST_FM
        VIMEO_BLUE_WORDMARK
        VIMEO_DARKFOREST_WORDMARK
        APPLE_LOGO_WHT_BLK_CIRCLE

        */

        $curr_creative_element_key = trim(strtoupper($media_element_key));

        try{

            //
            // DETERMINE ICON SIZE PREFERENCE (SMALL, MEDIUM, LARGE)
            $tmp_social_element_meta_ARRAY = explode('_', $curr_creative_element_key);
            $tmp_nom_section_cnt = count($tmp_social_element_meta_ARRAY);
            $tmp_nom_section_cnt--;

            if($tmp_nom_section_cnt < 1){

                throw new Exception('The social media key [' . $media_element_key . '] does not specify size (e.g. \'FACEBOOK_MEDIUM\').');

            }

            //error_log(__LINE__ . ' user $tmp_social_element_meta_ARRAY[$tmp_nom_section_cnt][' . $tmp_social_element_meta_ARRAY[$tmp_nom_section_cnt] . ']. [' . print_r($tmp_social_element_meta_ARRAY, true) . '].');

            //
            // INITIALIZATION OF SOCIAL MEDIA IMAGE SPRITE DIMENSIONS
            switch($tmp_social_element_meta_ARRAY[$tmp_nom_section_cnt]){
                case 'SMALL':

                    $tmp_social_media_endpoint = '';
                    for($i = 0; $i < $tmp_nom_section_cnt; $i++){

                        $tmp_social_media_endpoint .= $tmp_social_element_meta_ARRAY[$i] . '_';

                    }

                    $tmp_social_media_endpoint = $this->oCRNRSTN->strrtrim($tmp_social_media_endpoint, '_');
                    $tmp_icon_family_size = $tmp_social_element_meta_ARRAY[$tmp_nom_section_cnt];

                    $tmp_social_media_data_key = $tmp_social_media_endpoint;
                    $tmp_social_media_sprite = 'SOCIAL_SPRITE';

                    //
                    // LOCKED IN AT 319x414 WITH SOUNDCLOUD(25x25)
                    $tmp_sprite_width = 319;
                    $tmp_sprite_height = 414;

                break;
                case 'MEDIUM':

                    $tmp_social_media_endpoint = '';
                    for($i = 0; $i < $tmp_nom_section_cnt; $i++){

                        $tmp_social_media_endpoint .= $tmp_social_element_meta_ARRAY[$i] . '_';

                    }

                    $tmp_social_media_data_key = $tmp_social_media_endpoint;

                    $tmp_social_media_endpoint = $this->oCRNRSTN->strrtrim($tmp_social_media_endpoint, '_');
                    $tmp_icon_family_size = $tmp_social_element_meta_ARRAY[$tmp_nom_section_cnt];

                    //
                    // APPLY HQ IMAGE SELECTION FOR ACCESS TO 230x230 DIMENSIONS.
                    $tmp_social_media_data_key .= 'HQ';
                    $tmp_social_media_sprite = 'SOCIAL_SPRITE_HQ';

                    //
                    // LOCKED IN AT 648x864 WITH SOUNDCLOUD(50x50)
                    // LOCKED IN AT 639x851 WITH SOUNDCLOUD(50x50)
                    $tmp_sprite_width = 639;
                    $tmp_sprite_height = 851;

                break;
                case 'LARGE':

                    $tmp_social_media_endpoint = '';
                    for($i = 0; $i < $tmp_nom_section_cnt; $i++){

                        $tmp_social_media_endpoint .= $tmp_social_element_meta_ARRAY[$i] . '_';

                    }

                    $tmp_social_media_data_key = $tmp_social_media_endpoint;

                    $tmp_social_media_endpoint = $this->oCRNRSTN->strrtrim($tmp_social_media_endpoint, '_');
                    $tmp_icon_family_size = $tmp_social_element_meta_ARRAY[$tmp_nom_section_cnt];

                    //
                    // APPLY HQ IMAGE SELECTION FOR ACCESS TO 230x230 DIMENSIONS.
                    $tmp_social_media_data_key .= 'HQ';
                    $tmp_social_media_sprite = 'SOCIAL_SPRITE_HQ';

                    //
                    // LOCKED IN AT 959x1279 WITH SOUNDCLOUD(75x75)
                    $tmp_sprite_width = 959;
                    $tmp_sprite_height = 1279;

                    //error_log(__LINE__ . ' user $tmp_social_media_endpoint[' . $tmp_social_media_endpoint . ']. $tmp_icon_family_size[' . $tmp_icon_family_size . '].');

                break;
                default:

                    throw new Exception('The social media key [' . $media_element_key . '] does not specify a size of SMALL, MEDIUM OR LARGE correctly (e.g. \'FACEBOOK_MEDIUM\').');

                break;

            }

            switch($tmp_social_media_endpoint){
                case 'AMAZON':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -3;
                            $tmp_social_img_top = -117;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -8;
                            $tmp_social_img_top = -224;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -12;
                            $tmp_social_img_top = -336;

                        break;

                    }

                    $tmp_social_img_alt = 'Amazon';
                    $tmp_social_img_title = 'Link to Amazon related resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'APPLE_LOGO_BLK':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 20;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -205;
                            $tmp_social_img_top = -230;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 41;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -415;
                            $tmp_social_img_top = -448;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 61;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -623;
                            $tmp_social_img_top = -674;

                        break;

                    }

                    $tmp_social_img_alt = 'Apple';
                    $tmp_social_img_title = 'Link to Apple related resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'APPLE_LOGO_BLK_WHT_CIRCLE':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -178;
                            $tmp_social_img_top = -231;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -359;
                            $tmp_social_img_top = -449;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -539;
                            $tmp_social_img_top = -675;

                        break;

                    }

                    $tmp_social_img_alt = 'Apple';
                    $tmp_social_img_title = 'Link to Apple related resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'APPLE_LOGO_GREY':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 21;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -251;
                            $tmp_social_img_top = -230;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 42;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -508;
                            $tmp_social_img_top = -448;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 63;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -762;
                            $tmp_social_img_top = -674;

                        break;

                    }

                    $tmp_social_img_alt = 'Apple';
                    $tmp_social_img_title = 'Link to Apple related resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'APPLE_LOGO_GREY_BLK_CIRCLE':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -275;
                            $tmp_social_img_top = -230;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -556;
                            $tmp_social_img_top = -448;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -834;
                            $tmp_social_img_top = -674;

                        break;

                    }

                    $tmp_social_img_alt = 'Apple';
                    $tmp_social_img_title = 'Link to Apple related resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'APPLE_LOGO_GREY_WHT_CIRCLE':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = 0;
                            $tmp_social_img_top = -259;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = 0;
                            $tmp_social_img_top = -507;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = 0;
                            $tmp_social_img_top = -762;

                        break;

                    }

                    $tmp_social_img_alt = 'Apple';
                    $tmp_social_img_title = 'Link to Apple related resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'APPLE_LOGO_WHT':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 20;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -228;
                            $tmp_social_img_top = -230;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 41;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -461;
                            $tmp_social_img_top = -448;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 61;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -693;
                            $tmp_social_img_top = -674;

                        break;

                    }

                    $tmp_social_img_alt = 'Apple';
                    $tmp_social_img_title = 'Link to Apple related resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'APPLE_LOGO_WHT_BLK_CIRCLE':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -28;
                            $tmp_social_img_top = -173;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -56;
                            $tmp_social_img_top = -340;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -84;
                            $tmp_social_img_top = -511;

                        break;

                    }

                    $tmp_social_img_alt = 'Apple';
                    $tmp_social_img_title = 'Link to Apple related resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'APPLE_MUSIC':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -168;
                            $tmp_social_img_top = 0;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -343;
                            $tmp_social_img_top = 0;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -514;
                            $tmp_social_img_top = 0;

                        break;

                    }

                    $tmp_social_img_alt = 'Apple Music';
                    $tmp_social_img_title = 'Link to Apple Music related resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'ARCHIVES':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 39;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -102;
                            $tmp_social_img_top = -60;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 78;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -209;
                            $tmp_social_img_top = -111;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 116;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -314;
                            $tmp_social_img_top = -166;

                        break;

                    }

                    $tmp_social_img_alt = 'Archives';
                    $tmp_social_img_title = 'Link to Archives.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'BANDCAMP':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -81;
                            $tmp_social_img_top = -27;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -167;
                            $tmp_social_img_top = -55;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -251;
                            $tmp_social_img_top = -83;

                        break;

                    }

                    $tmp_social_img_alt = 'Bandcamp';
                    $tmp_social_img_title = 'Link to Bandcamp music page.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'BASSDRIVE':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 30;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -144;
                            $tmp_social_img_top = -59;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 61;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -292;
                            $tmp_social_img_top = -112;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 91;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -439;
                            $tmp_social_img_top = -167;

                        break;

                    }

                    $tmp_social_img_alt = 'Bassdrive';
                    $tmp_social_img_title = 'Link to Bassdrive resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'BEATPORT':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -53;
                            $tmp_social_img_top = -27;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -111;
                            $tmp_social_img_top = -56;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -167;
                            $tmp_social_img_top = -83;

                        break;

                    }

                    $tmp_social_img_alt = 'Beatport';
                    $tmp_social_img_title = 'Link to Beatport featured tracks.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'BLOGSPOT':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -159;
                            $tmp_social_img_top = -88;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -316;
                            $tmp_social_img_top = -169;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -475;
                            $tmp_social_img_top = -254;

                        break;

                    }

                    $tmp_social_img_alt = 'Blogspot';
                    $tmp_social_img_title = 'Link to Blogspot related resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'BLUEHOST_ICON':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -293;
                            $tmp_social_img_top = -88;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -572;
                            $tmp_social_img_top = -169;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -858;
                            $tmp_social_img_top = -254;

                        break;

                    }

                    $tmp_social_img_alt = 'Bluehost';
                    $tmp_social_img_title = 'Link to Bluehost hosted resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'BLUEHOST_WORDMARK':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 152;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = 0;
                            $tmp_social_img_top = -203;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 302;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = 0;
                            $tmp_social_img_top = -396;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 453;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = 0;
                            $tmp_social_img_top = -595;

                        break;

                    }

                    $tmp_social_img_alt = 'Bluehost';
                    $tmp_social_img_title = 'Link to Bluehost hosted resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'DISCOGS':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -26;
                            $tmp_social_img_top = -27;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -56;
                            $tmp_social_img_top = -55;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -84;
                            $tmp_social_img_top = -83;

                        break;

                    }

                    $tmp_social_img_alt = 'Discogs';
                    $tmp_social_img_title = 'Link to Discogs music selection.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'DRIBBLE':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 102;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -28;
                            $tmp_social_img_top = -259;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 204;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -55;
                            $tmp_social_img_top = -507;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 306;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -83;
                            $tmp_social_img_top = -762;

                        break;

                    }

                    $tmp_social_img_alt = 'Dribble';
                    $tmp_social_img_title = 'Link to Dribble music selection.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'EBAY':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 63;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -127;
                            $tmp_social_img_top = -118;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 125;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -250;
                            $tmp_social_img_top = -224;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 187;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -374;
                            $tmp_social_img_top = -337;

                        break;

                    }

                    $tmp_social_img_alt = 'eBay';
                    $tmp_social_img_title = 'Link to eBay related resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'ETSY':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = 0;
                            $tmp_social_img_top = -173;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = 0;
                            $tmp_social_img_top = -340;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = 0;
                            $tmp_social_img_top = -511;

                        break;

                    }

                    $tmp_social_img_alt = 'Etsy';
                    $tmp_social_img_title = 'Link to Etsy resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'FACEBOOK':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -26;
                            $tmp_social_img_top = 0;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -55;
                            $tmp_social_img_top = 0;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -82;
                            $tmp_social_img_top = 0;

                        break;

                    }

                    $tmp_social_img_alt = 'Facebook';
                    $tmp_social_img_title = 'Link to Facebook related resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'FEEDBURNER':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -195;
                            $tmp_social_img_top = 0;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -401;
                            $tmp_social_img_top = 0;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -603;
                            $tmp_social_img_top = 0;

                        break;

                    }

                    $tmp_social_img_alt = 'Feedburner';
                    $tmp_social_img_title = 'Link to Feedburner feed proxy.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'FLICKR':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 54;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -60;
                            $tmp_social_img_top = -88;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 108;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -122;
                            $tmp_social_img_top = -166;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 161;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -182;
                            $tmp_social_img_top = -250;

                        break;

                    }

                    $tmp_social_img_alt = 'Flickr';
                    $tmp_social_img_title = 'Link to Flickr related resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'GITHUB':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -180;
                            $tmp_social_img_top = -58;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -362;
                            $tmp_social_img_top = -111;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -543;
                            $tmp_social_img_top = -167;

                        break;

                    }

                    $tmp_social_img_alt = 'Github';
                    $tmp_social_img_title = 'Link to Github resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'GOOGLE_DRIVE':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 28;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -261;
                            $tmp_social_img_top = -88;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 56;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -510;
                            $tmp_social_img_top = -169;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 84;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -765;
                            $tmp_social_img_top = -254;

                        break;

                    }

                    $tmp_social_img_alt = 'Google Drive';
                    $tmp_social_img_title = 'Link to Google Drive resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'GOOGLE_MAPS':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -31;
                            $tmp_social_img_top = -90;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -61;
                            $tmp_social_img_top = -166;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -91;
                            $tmp_social_img_top = -249;

                        break;

                    }

                    $tmp_social_img_alt = 'Google Maps 15th Anniversary';
                    $tmp_social_img_title = 'Link to Google Maps resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'GOOGLE_MAPS_SQUARE':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -293;
                            $tmp_social_img_top = -175;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -585;
                            $tmp_social_img_top = -337;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -878;
                            $tmp_social_img_top = -507;

                        break;

                    }

                    $tmp_social_img_alt = 'Google Maps';
                    $tmp_social_img_title = 'Link to Google Maps resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'HISTORY':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 36;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -65;
                            $tmp_social_img_top = -60;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 72;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -132;
                            $tmp_social_img_top = -111;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 108;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -198;
                            $tmp_social_img_top = -166;

                        break;

                    }

                    $tmp_social_img_alt = 'History';
                    $tmp_social_img_title = 'Link to history.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'IDEONE':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -265;
                            $tmp_social_img_top = -176;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -530;
                            $tmp_social_img_top = -338;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -795;
                            $tmp_social_img_top = -508;

                        break;

                    }

                    $tmp_social_img_alt = 'IDE ONE';
                    $tmp_social_img_title = 'Link to IDE ONE resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'INSTAGRAM':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -52;
                            $tmp_social_img_top = 0;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -111;
                            $tmp_social_img_top = 0;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -165;
                            $tmp_social_img_top = 0;

                        break;

                    }

                    $tmp_social_img_alt = 'Instagram';
                    $tmp_social_img_title = 'Link to Instagram feed.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'INTERNET_ARCHIVE':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 26;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -96;
                            $tmp_social_img_top = -147;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 52;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -189;
                            $tmp_social_img_top = -277;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 77;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -284;
                            $tmp_social_img_top = -417;

                        break;

                    }

                    $tmp_social_img_alt = 'INTERNET ARCHIVE';
                    $tmp_social_img_title = 'Link to INTERNET ARCHIVE resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'JSON':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -138;
                            $tmp_social_img_top = 0;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -285;
                            $tmp_social_img_top = 0;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 74;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -428;
                            $tmp_social_img_top = 0;

                        break;

                    }

                    $tmp_social_img_alt = 'JSON';
                    $tmp_social_img_title = 'Link to JSON object.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'KINK':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -194;
                            $tmp_social_img_top = -30;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -394;
                            $tmp_social_img_top = -56;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -592;
                            $tmp_social_img_top = -85;

                        break;

                    }

                    $tmp_social_img_alt = 'Kink.com';
                    $tmp_social_img_title = 'Link to Kink.com related resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'LAST_FM':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 99;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -183;
                            $tmp_social_img_top = -203;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 198;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -375;
                            $tmp_social_img_top = -393;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 297;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -564;
                            $tmp_social_img_top = -591;

                        break;

                    }

                    $tmp_social_img_alt = 'Last.fm';
                    $tmp_social_img_title = 'Link to Last.fm resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'LINKEDIN':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -2;
                            $tmp_social_img_top = -89;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = 0;
                            $tmp_social_img_top = -168;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = 0;
                            $tmp_social_img_top = -253;

                        break;

                    }

                    $tmp_social_img_alt = 'LinkedIn';
                    $tmp_social_img_title = 'Link to LinkedIn related resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'MICROSOFT':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -66;
                            $tmp_social_img_top = -147;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -134;
                            $tmp_social_img_top = -277;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -201;
                            $tmp_social_img_top = -418;

                        break;

                    }

                    $tmp_social_img_alt = 'Microsoft';
                    $tmp_social_img_title = 'Link to Microsoft related resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'MIXCLOUD':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = 0;
                            $tmp_social_img_top = -27;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = 0;
                            $tmp_social_img_top = -56;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = 0;
                            $tmp_social_img_top = -84;

                        break;

                    }

                    $tmp_social_img_alt = 'Mixcloud';
                    $tmp_social_img_title = 'Link to Mixcloud community.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'MOZILLA_ICON':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -281;
                            $tmp_social_img_top = -1;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -572;
                            $tmp_social_img_top = 0;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -859;
                            $tmp_social_img_top = 0;

                        break;

                    }

                    $tmp_social_img_alt = 'Mozilla';
                    $tmp_social_img_title = 'Link to Mozilla resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'MOZILLA_WORDMARK':

                    /*
                     case 'SMALL':

                            $tmp_social_img_width = 63;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -127;
                            $tmp_social_img_top = -118;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 125;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -250;
                            $tmp_social_img_top = -224;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 187;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -374;
                            $tmp_social_img_top = -337;

                    */
                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 114;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -192;
                            $tmp_social_img_top = -118;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 227;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -380;
                            $tmp_social_img_top = -224;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 341;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -570;
                            $tmp_social_img_top = -337;

                        break;

                    }

                    $tmp_social_img_alt = 'Mozilla';
                    $tmp_social_img_title = 'Link to Mozilla resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'PANDORA':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -154;
                            $tmp_social_img_top = -203;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -311;
                            $tmp_social_img_top = -393;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -466;
                            $tmp_social_img_top = -591;

                        break;

                    }

                    $tmp_social_img_alt = 'Pandora';
                    $tmp_social_img_title = 'Link to Pandora resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'PATREON':
                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 26;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = 0;
                            $tmp_social_img_top = -146;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 52;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = 0;
                            $tmp_social_img_top = -279;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 78;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -1;
                            $tmp_social_img_top = -420;

                        break;

                    }

                    $tmp_social_img_alt = 'Paetron';
                    $tmp_social_img_title = 'Link to Paetron related resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'PAYPAL':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -38;
                            $tmp_social_img_top = -59;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -77;
                            $tmp_social_img_top = -111;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -115;
                            $tmp_social_img_top = -166;

                        break;

                    }

                    $tmp_social_img_alt = 'Paypal';
                    $tmp_social_img_title = 'Link to Paypal related resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'PHP':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 47;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -223;
                            $tmp_social_img_top = -30;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 95;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -456;
                            $tmp_social_img_top = -56;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 143;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -686;
                            $tmp_social_img_top = -84;

                        break;

                    }

                    $tmp_social_img_alt = 'PHP.net';
                    $tmp_social_img_title = 'Link to PHP related resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'PINTEREST':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -188;
                            $tmp_social_img_top = -88;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -372;
                            $tmp_social_img_top = -169;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -558;
                            $tmp_social_img_top = -254;

                        break;

                    }

                    $tmp_social_img_alt = 'Pinterest';
                    $tmp_social_img_title = 'Link to Pinterest related resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'PORNHUB':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 87;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -37;
                            $tmp_social_img_top = -118;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 176;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -69;
                            $tmp_social_img_top = -222;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 265;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -104;
                            $tmp_social_img_top = -333;

                        break;

                    }

                    $tmp_social_img_alt = 'Pornhub';
                    $tmp_social_img_title = 'Link to Pornhub related resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'REDDIT':

                    /*
                    case 'SMALL':

                            $tmp_social_img_width = 47;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -223;
                            $tmp_social_img_top = -30;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 95;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -456;
                            $tmp_social_img_top = -56;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 143;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -686;
                            $tmp_social_img_top = -84;

                    */
                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -274;
                            $tmp_social_img_top = -29;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -559;
                            $tmp_social_img_top = -57;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -838;
                            $tmp_social_img_top = -86;

                        break;

                    }

                    $tmp_social_img_alt = 'Reddit';
                    $tmp_social_img_title = 'Link to Reddit resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'ROLLDABEATS':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -137;
                            $tmp_social_img_top = -30;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -279;
                            $tmp_social_img_top = -56;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -418;
                            $tmp_social_img_top = -83;

                        break;

                    }

                    $tmp_social_img_alt = 'RollDaBeats';
                    $tmp_social_img_title = 'Link to RollDaBeats catalog.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'SERVER_FAULT':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 38;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -218;
                            $tmp_social_img_top = -88;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 76;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -428;
                            $tmp_social_img_top = -169;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 114;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -643;
                            $tmp_social_img_top = -254;

                        break;

                    }

                    $tmp_social_img_alt = 'ServerFault';
                    $tmp_social_img_title = 'Link to ServerFault related resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'SLASHDOT_ICON':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -223;
                            $tmp_social_img_top = 0;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -457;
                            $tmp_social_img_top = -1;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -686;
                            $tmp_social_img_top = -1;

                        break;

                    }

                    $tmp_social_img_alt = 'Slashdot';
                    $tmp_social_img_title = 'Link to Slashdot related resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'SLASHDOT_WORDMARK':

                    /*
                     case 'SMALL':

                            $tmp_social_img_width = 99;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -57;
                            $tmp_social_img_top = -175;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 197;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -111;
                            $tmp_social_img_top = -337;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 295;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -167;
                            $tmp_social_img_top = -507;

                    */

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 79;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -156;
                            $tmp_social_img_top = -175;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 156;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -311;
                            $tmp_social_img_top = -337;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 235;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -468;
                            $tmp_social_img_top = -507;

                        break;

                    }

                    $tmp_social_img_alt = 'Slashdot';
                    $tmp_social_img_title = 'Link to Slashdot resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'SOUNDCLOUD':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = 0;
                            $tmp_social_img_top = 0;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = 0;
                            $tmp_social_img_top = 0;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = 0;
                            $tmp_social_img_top = -1;

                        break;

                    }

                    $tmp_social_img_alt = 'SoundCloud';
                    $tmp_social_img_title = 'Link to SoundCloud tracks.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'SPOTIFY':

                    /*
                    case 'SMALL':
                    $tmp_social_img_left = -81;
                    $tmp_social_img_top = -27;

                    break;
                    case 'MEDIUM':
                    $tmp_social_img_left = -169;
                    $tmp_social_img_top = -56;

                    break;
                    default:
                    // 'LARGE':
                    $tmp_social_img_left = -251;
                    $tmp_social_img_top = -83;

                    */

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -110;
                            $tmp_social_img_top = -31;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -223;
                            $tmp_social_img_top = -55;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -334;
                            $tmp_social_img_top = -83;

                        break;

                    }

                    $tmp_social_img_alt = 'Spotify';
                    $tmp_social_img_title = 'Link to Spotify community.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'STACKOVERFLOW':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -166;
                            $tmp_social_img_top = -28;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -336;
                            $tmp_social_img_top = -56;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 74;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -505;
                            $tmp_social_img_top = -85;

                        break;

                    }

                    $tmp_social_img_alt = 'Stackoverflow';
                    $tmp_social_img_title = 'Link to Stackoverflow related resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'TWITCH':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -32;
                            $tmp_social_img_top = -146;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -71;
                            $tmp_social_img_top = -277;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -106;
                            $tmp_social_img_top = -420;

                        break;

                    }

                    $tmp_social_img_alt = 'Twitch';
                    $tmp_social_img_title = 'Link to Twitch related resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'TWITTER':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -80;
                            $tmp_social_img_top = 0;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -166;
                            $tmp_social_img_top = 0;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -249;
                            $tmp_social_img_top = 0;

                        break;

                    }

                    $tmp_social_img_alt = 'Twitter';
                    $tmp_social_img_title = 'Link to Twitter feed.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'VIMEO_BLUE_ICON':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -237;
                            $tmp_social_img_top = -175;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 50;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -472;
                            $tmp_social_img_top = -337;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 75;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -710;
                            $tmp_social_img_top = -507;

                        break;

                    }

                    $tmp_social_img_alt = 'Vimeo';
                    $tmp_social_img_title = 'Link to Vimeo resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'VIMEO_BLUE_WORDMARK':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 87;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = 0;
                            $tmp_social_img_top = -231;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 177;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = 0;
                            $tmp_social_img_top = -451;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 265;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = 0;
                            $tmp_social_img_top = -678;

                        break;

                    }

                    $tmp_social_img_alt = 'Vimeo';
                    $tmp_social_img_title = 'Link to Vimeo resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'VIMEO_DARKFOREST_WORDMARK':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 87;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -89;
                            $tmp_social_img_top = -231;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 177;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -179;
                            $tmp_social_img_top = -451;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 265;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -269;
                            $tmp_social_img_top = -678;

                        break;

                    }

                    $tmp_social_img_alt = 'Vimeo';
                    $tmp_social_img_title = 'Link to Vimeo resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'W3C':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 52;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -126;
                            $tmp_social_img_top = -147;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 105;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -246;
                            $tmp_social_img_top = -281;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 157;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -369;
                            $tmp_social_img_top = -422;

                        break;

                    }

                    $tmp_social_img_alt = 'W3C';
                    $tmp_social_img_title = 'Link to W3C resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'WIKIPEDIA':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 38;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -117;
                            $tmp_social_img_top = -89;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 77;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -234;
                            $tmp_social_img_top = -169;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 116;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -351;
                            $tmp_social_img_top = -254;

                        break;

                    }

                    $tmp_social_img_alt = 'Wikipedia';
                    $tmp_social_img_title = 'Link to Wikipedia related resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'WWW':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 25;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -108;
                            $tmp_social_img_top = 0;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 52;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -227;
                            $tmp_social_img_top = 0;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 77;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -339;
                            $tmp_social_img_top = 0;

                        break;

                    }

                    $tmp_social_img_alt = 'Website';
                    $tmp_social_img_title = 'Link to website.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'XHAMSTER_ICON':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 27;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -251;
                            $tmp_social_img_top = 0;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 54;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -513;
                            $tmp_social_img_top = 0;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 81;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -769;
                            $tmp_social_img_top = 0;

                        break;

                    }

                    $tmp_social_img_alt = 'XHAMSTER';
                    $tmp_social_img_title = 'Link to XHAMSTER related resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'XHAMSTER_WORDMARK':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 121;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -189;
                            $tmp_social_img_top = -146;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 242;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -357;
                            $tmp_social_img_top = -279;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 363;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -536;
                            $tmp_social_img_top = -420;

                        break;

                    }

                    $tmp_social_img_alt = 'XHAMSTER';
                    $tmp_social_img_title = 'Link to XHAMSTER resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'XNXX':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 112;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -210;
                            $tmp_social_img_top = -60;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 224;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -418;
                            $tmp_social_img_top = -113;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 336;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -627;
                            $tmp_social_img_top = -167;

                        break;

                    }

                    $tmp_social_img_alt = 'XNXX.com';
                    $tmp_social_img_title = 'Link to XNXX resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'XVIDEOS':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 99;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = -57;
                            $tmp_social_img_top = -175;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 197;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = -111;
                            $tmp_social_img_top = -337;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 295;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = -167;
                            $tmp_social_img_top = -507;

                        break;

                    }

                    $tmp_social_img_alt = 'XVIDEOS';
                    $tmp_social_img_title = 'Link to XVIDEOS resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                case 'YOUTUBE':

                    switch($tmp_icon_family_size){
                        case 'SMALL':

                            $tmp_social_img_width = 35;
                            $tmp_social_img_height = 25;
                            $tmp_social_img_left = 0;
                            $tmp_social_img_top = -58;

                        break;
                        case 'MEDIUM':

                            $tmp_social_img_width = 71;
                            $tmp_social_img_height = 50;
                            $tmp_social_img_left = 0;
                            $tmp_social_img_top = -112;

                        break;
                        default:
                            // 'LARGE':

                            $tmp_social_img_width = 106;
                            $tmp_social_img_height = 75;
                            $tmp_social_img_left = 0;
                            $tmp_social_img_top = -168;

                        break;

                    }

                    $tmp_social_img_alt = 'YouTube';
                    $tmp_social_img_title = 'Link to YouTube resource.';
                    $tmp_sticky_link_meta = strtolower($tmp_social_img_alt) . '_social_media_lnk';

                break;
                default:

                    return '';

                break;

            }

            //
            // BASIC URL HAS DATA CHECK
            $valid_url = true;

            if(!isset($url)){

                $valid_url = false;

            }else{

                if(strlen($url) < 1){

                    $valid_url = false;

                }

            }

            if(isset($tmp_sticky_link_meta)){

                if($email_channel){

                    //return $this->oCRNRSTN->return_system_image('CRNRSTN_LOGO', '', 250, NULL, NULL, NULL, NULL, CRNRSTN_UI_IMG_HTML_WRAPPED);

                    if($valid_url){

                        return $this->oCRNRSTN->return_system_image('SOCIAL_' . $tmp_social_media_data_key, $tmp_social_img_width, $tmp_social_img_height, $this->oCRNRSTN->return_sticky_link($url, $tmp_sticky_link_meta), $tmp_social_img_alt, $tmp_social_img_title, $target, CRNRSTN_UI_IMG_HTML_WRAPPED);
                        //return '<a href="' . $this->oCRNRSTN->return_sticky_link($url, $tmp_sticky_link_meta) . '" target="' . $target . '"><img src="' . $this->oCRNRSTN_ASSET_MGR->return_creative('SOCIAL_' . $tmp_social_media_data_key, CRNRSTN_UI_IMG_BASE64) . '" width="' . $tmp_social_img_width . '" height="' . $tmp_social_img_height . '" alt="' . $tmp_social_img_alt . '" title="' . $tmp_social_img_title .'" border="0" style="border: 0;"></a>';

                    }

                    return $this->oCRNRSTN->return_system_image('SOCIAL_' . $tmp_social_media_data_key, $tmp_social_img_width, $tmp_social_img_height, '#', $tmp_social_img_alt, $tmp_social_img_title, '_self', CRNRSTN_UI_IMG_HTML_WRAPPED);
                    //return '<a href="#" target="_self"><img src="' . $this->oCRNRSTN_ASSET_MGR->return_creative('SOCIAL_' . $tmp_social_media_data_key, CRNRSTN_UI_IMG_BASE64) . '" width="' . $tmp_social_img_width . '" height="' . $tmp_social_img_height . '" alt="' . $tmp_social_img_alt . '" title="' . $tmp_social_img_title .'" border="0" style="border: 0;"></a>';

                }

//                //
//                // CONSIDER SUPPORTING MEDIA IMAGE INTEGRATIONS INTO EMAIL WITH A CHECK HERE.
//                if($this->oCRNRSTN->tmp_restrict_this_image_sprite_media_constant($tmp_social_media_endpoint)){
//
//                    //    public function return_system_image($media_element_key, $width = NULL, $height = NULL, $hyperlink = NULL, $alt = NULL, $title = NULL, $target = NULL, $image_output_mode = NULL){
//                    //return $this->oCRNRSTN->return_system_image('SOCIAL_' . $tmp_social_media_data_key, $tmp_social_img_width, $tmp_social_img_height, $this->oCRNRSTN->return_sticky_link($url, $tmp_sticky_link_meta), $tmp_social_img_alt, $tmp_social_img_title, $target, CRNRSTN_UI_IMG_HTML_WRAPPED);
//                    //return $this->oCRNRSTN->return_system_image('CRNRSTN_LOGO', '', 250, NULL, NULL, NULL, NULL, CRNRSTN_UI_IMG_HTML_WRAPPED);
//
//                    if($valid_url){
//
//                        $tmp_note = '<!-- CRNRSTN :: v' . $this->version_crnrstn() . ' :: Graceful degradation to $email_channel=true until ' . $tmp_social_media_endpoint . ' image sprite coordinates can be approved. -->';
//
//                        return $tmp_note . $this->oCRNRSTN->return_system_image('SOCIAL_' . $tmp_social_media_data_key, $tmp_social_img_width, $tmp_social_img_height, $this->oCRNRSTN->return_sticky_link($url, $tmp_sticky_link_meta), $tmp_social_img_alt, $tmp_social_img_title, $target, CRNRSTN_UI_IMG_HTML_WRAPPED);
//                        //return $tmp_note . '<a href="' . $this->oCRNRSTN->return_sticky_link($url, $tmp_sticky_link_meta) . '" target="' . $target . '"><img src="' . $this->oCRNRSTN_ASSET_MGR->return_creative('SOCIAL_' . $tmp_social_media_data_key, CRNRSTN_UI_IMG_BASE64) . '" width="' . $tmp_social_img_width . '" height="' . $tmp_social_img_height . '" alt="' . $tmp_social_img_alt . '" title="' . $tmp_social_img_title .'" border="0" style="border: 0;"></a>';
//
//                    }
//
//                    $tmp_note = '<!-- CRNRSTN :: v' . $this->version_crnrstn() . ' :: Graceful degradation to $email_channel=true until ' . $tmp_social_media_endpoint . ' image sprite coordinates can be approved. -->';
//                    return $tmp_note . $this->oCRNRSTN->return_system_image('SOCIAL_' . $tmp_social_media_data_key, $tmp_social_img_width, $tmp_social_img_height, '#', $tmp_social_img_alt, $tmp_social_img_title, '_self', CRNRSTN_UI_IMG_HTML_WRAPPED);
//                    //return $tmp_note . '<a href="#" target="_self"><img src="' . $this->oCRNRSTN_ASSET_MGR->return_creative('SOCIAL_' . $tmp_social_media_data_key, CRNRSTN_UI_IMG_BASE64) . '" width="' . $tmp_social_img_width . '" height="' . $tmp_social_img_height . '" alt="' . $tmp_social_img_alt . '" title="' . $tmp_social_img_title .'" border="0" style="border: 0;"></a>';
//
//                }

                if($valid_url){

//  BREAKS WITH # AS URL
//                    $tmp_social_html = '<div style="display: inline-block; width:' . $tmp_social_img_width . 'px; height:' . $tmp_social_img_height . 'px; cursor:pointer; overflow: hidden;" onclick="window.open(\'' . $this->oCRNRSTN->return_sticky_link($url, $tmp_sticky_link_meta) . '\', \'' . $target . '\'); return false;">
//                                    <div style="position: relative;"><div style="position: absolute; left:' . $tmp_social_img_left . 'px; top: ' . $tmp_social_img_top . 'px;">
//                                        <img src="' . $this->oCRNRSTN_ASSET_MGR->return_creative($tmp_social_media_sprite, CRNRSTN_UI_IMG_BASE64) . '" width="' . $tmp_sprite_width . '" height="' . $tmp_sprite_height . '" alt="' . $tmp_social_img_alt . '" title="' . $tmp_social_img_title .'">
//                                    </div></div></div>';

                    $tmp_social_serial = $this->oCRNRSTN->generate_new_key(50);

                    $tmp_script = '<script>
function crnrstn_sticky_' . $tmp_social_serial . '(ux_action, url, target, elem){

        switch(ux_action){
            case \'onmouseover\':

            break;
            case \'onmouseout\':

            break;
            case \'onmousedown\':

            break;
            case \'onmouseup\':

            break;
            case \'onclick\':

                if(url !== \'#\'){

                    window.open(url, target);

                }

                break;

            }

            return false;

        }

</script>';

                    $tmp_social_html = '<div id="crnrstn_media_sticky_link_'. $tmp_social_serial .'" style="display: inline-block; width:' . $tmp_social_img_width . 'px; height:' . $tmp_social_img_height . 'px; cursor:pointer; overflow: hidden;" onclick="crnrstn_sticky_' . $tmp_social_serial . '(\'onclick\', \''. $this->oCRNRSTN->return_sticky_link($url, $tmp_sticky_link_meta) .'\', \'' . $target . '\', this);">
                                    <div style="position: relative;"><div style="position: absolute; left:' . $tmp_social_img_left . 'px; top: ' . $tmp_social_img_top . 'px;">
                                        ' . $this->oCRNRSTN->return_system_image($tmp_social_media_sprite, $tmp_sprite_width, $tmp_sprite_height, '', $tmp_social_img_alt, $tmp_social_img_title, $target, CRNRSTN_UI_IMG_HTML_WRAPPED) . '
                                    </div></div></div>' . $tmp_script;

                    return $tmp_social_html;

                }

                //
                // INVALID URL MEDIA IMAGE STICKY LINK
//                $tmp_social_html = '<div style="display: inline-block; width:' . $tmp_social_img_width . 'px; height:' . $tmp_social_img_height . 'px; overflow: hidden;">
//                                    <div style="position: relative;"><div style="position: absolute; left:' . $tmp_social_img_left . 'px; top: ' . $tmp_social_img_top . 'px;">
//                                        <img src="' . $this->oCRNRSTN_ASSET_MGR->return_creative($tmp_social_media_sprite, CRNRSTN_UI_IMG_BASE64) . '" width="' . $tmp_sprite_width . '" height="' . $tmp_sprite_height . '" alt="' . $tmp_social_img_alt . '" title="' . $tmp_social_img_title .'">
//                                    </div></div></div>';

                $tmp_social_html = '<div style="display: inline-block; width:' . $tmp_social_img_width . 'px; height:' . $tmp_social_img_height . 'px; overflow: hidden;">
                                    <div style="position: relative;"><div style="position: absolute; left:' . $tmp_social_img_left . 'px; top: ' . $tmp_social_img_top . 'px;">
                                        ' . $this->oCRNRSTN->return_system_image($tmp_social_media_sprite, $tmp_sprite_width, $tmp_sprite_height, '', $tmp_social_img_alt, $tmp_social_img_title, '_self', CRNRSTN_UI_IMG_HTML_WRAPPED) . '
                                    </div></div></div>';
                return $tmp_social_html;

            }

            return '';

        }catch (Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

        /*
        THE ORIGINAL (PRE-LIGHTSABER) 18 MEDIA ICONS.
        social_archives.png
        social_bandcamp.png
        social_bassdrive.png
        social_beatport.png
        social_discogs.png
        social_facebook.png
        social_history.png
        social_instagram.png
        social_json.png
        social_linkedin.png
        social_mixcloud.png
        social_paypal.png
        social_rolldabeats.png
        social_soundcloud.png
        social_spotify.png
        sprite.png
        social_twitter.png
        social_www.png
        social_youtube.png

        */
        return '';

    }

    public function shortenColorHex($color_hex){

        $tmp_hex_array = str_split($color_hex);

        if($tmp_hex_array[1] == $tmp_hex_array[2] && $tmp_hex_array[3] == $tmp_hex_array[4] && $tmp_hex_array[5] == $tmp_hex_array[6]){

            $color_hex = '#' . $tmp_hex_array[1] . $tmp_hex_array[3] . $tmp_hex_array[5];

        }

        return $color_hex;

    }

    private function return_image_to_html_str($width, $height, $table_row_HTML){

        $str = '';
        $str .= '
<table cellpadding="0" cellspacing="0" border="0" width="' . $width . '" style="width:' . $width . 'px; height:' . $height . 'px;">';
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

        //$str = '<td style="width:1px; height:1px; overflow: hidden; padding: 0; margin: 0; background-color: ' . $color_hex . ';"><div style="width: 1px; height: 1px; overflow: hidden;">&nbsp;</div></td>';

        $str = '<td style="background-color:' . $color_hex . ';"><div style="width:1px;height:1px;overflow:hidden;">&nbsp;</div></td>';

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
            for($y = 0; $y <= $height; $y++){

                $table_col_HTML = '';
                for($x = 0; $x <= $width; $x++){

                    $tmp_pixel_color_hex = $this->return_pixelHex($x, $y, $oImageMagi);

                    $table_col_HTML .= $this->return_styled_column_HTML($tmp_pixel_color_hex);

                }

                $table_row_HTML .= $this->return_styled_row_HTML($table_col_HTML);

            }

            $tmp_image_to_html_str = $this->return_image_to_html_str($width, $height, $table_row_HTML);

            $this->error_log('IMAGE[' . $filePath . ']_HTML=' . $tmp_image_to_html_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);

        }else{

            $tmp_image_to_html_str = 'Path to file [' . $filePath . '] is not recognized as a file.';

        }

        return $tmp_image_to_html_str;

    }

    public function isMatchedStrPattern($str, $condition_pattern, $case_insensitive = false){

        if($case_insensitive){

            $tmp_str = strtolower($str);
            $tmp_pattern = strtolower($condition_pattern);

            if(fnmatch($tmp_pattern, $tmp_str)){

                return true;

            }else{

                return false;

            }

        }else{

            if(fnmatch($condition_pattern, $str)){

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

            Not all web servers support this though. Various errors are returned depending on the
            server. If this happens to you, suppress the "Expect" header with this command:

            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
            */

            $ch = curl_init();
            curl_setopt_array($ch, ($options + $defaults));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
            if(!$result = curl_exec($ch)) {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('CRNRSTN :: CURL [POST] ERROR experienced :: ' . curl_error($ch));

            }

            curl_close($ch);

            return $result;

        }catch (Exception $e){

            curl_close($ch);

            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    /*
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
                CURLOPT_URL => $url . (strpos($url, '?') === FALSE ? '?' : '') . http_build_query($get),
                CURLOPT_HEADER => 0,
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_TIMEOUT => 4
            );

            $ch = curl_init();
            curl_setopt_array($ch, ($options + $defaults));
            if(!$result = curl_exec($ch)){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('CRNRSTN :: CURL [GET] ERROR experienced :: ' . curl_error($ch));

            }

            curl_close($ch);

            return $result;

        } catch (Exception $e) {

            curl_close($ch);

            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

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
        do{

            $cost++;
            $start = microtime(true);
            password_hash("test", PASSWORD_BCRYPT, ["cost" => $cost]);
            $end = microtime(true);

        }while(($end - $start) < $timeTarget);

        $this->error_log('Load Test Complete for Password Hash Option Strength :: Appropriate Cost = ' . $cost, __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

    }

    public function return_server_response_code($status_code){

        $tmp_burn = $this->return_CRNRSTN_ASCII_ART();

        return $this->oCRNRSTN_ENV->return_server_response_code($status_code, $tmp_burn);

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

    public function return_set_bits($integer_constants_ARRAY){

        return $this->oCRNRSTN_ENV->return_set_bits($integer_constants_ARRAY);

    }

    public function return_set_serialized_bits($const_nom, $integer_constants_ARRAY){

        return $this->oCRNRSTN_ENV->return_set_serialized_bits($const_nom, $integer_constants_ARRAY);

    }

    public function print_r_str($expression, $title = NULL, $theme_style = NULL, $line_num = NULL, $method = NULL, $file = NULL){

        return $this->oCRNRSTN->print_r_str($expression, $title, $theme_style, $line_num, $method, $file);

    }

    public function print_r($expression, $title = NULL, $theme_style = NULL, $line_num = NULL, $method = NULL, $file = NULL){

        return $this->oCRNRSTN->print_r($expression, $title, $theme_style, $line_num, $method, $file);

    }

    public function return_branding_creative($strip_formatting = false, $output_mode = CRNRSTN_UI_IMG_HTML_WRAPPED){

        return $this->oCRNRSTN_ENV->return_component_branding_creative($strip_formatting, $output_mode);

    }

    public function hash($data, $algorithm = NULL){

        return $this->oCRNRSTN->hash($data, $algorithm);

    }

//    //
//    // SOURCE :: https://www.php.net/manual/en/function.base64-encode.php
//    // AUTHOR :: luke at lukeoliff.com :: https://www.php.net/manual/en/function.base64-encode.php#105200
//    public function encode_image($crnrstn_file_to_encode, $filetype = NULL) {
//
//        //
//        // WHERE $crnrstn_file_to_encode = 'sprite.png' OR EVEN JUST
//        // WHERE $crnrstn_file_to_encode = 'sprite'
//
//        //$filename
//        $tmp_crnrstn_file_to_encode = $this->oCRNRSTN_ENV->data_decrypt($crnrstn_file_to_encode);
//        $this->error_log('CRNRSTN :: encode_image() crnrstn_file_to_encode/decrypt=[' . strlen($crnrstn_file_to_encode) . ']/[' . $tmp_crnrstn_file_to_encode . '] tmp_filetype=[' . $filetype . ']', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
//
//        //error_log(__LINE__ . ' user encode_image() crnrstn_file_to_base64=[' . strlen($crnrstn_file_to_base64) . '] tmp_filetype=[' . $tmp_filetype . ']');
//        //die();
//        if(!isset($filetype)){
//
//            $filetype = pathinfo($tmp_crnrstn_file_to_encode, PATHINFO_EXTENSION);
//
//        }
//
//        if(is_file($tmp_crnrstn_file_to_encode) || (is_string($tmp_crnrstn_file_to_encode) && (strlen($tmp_crnrstn_file_to_encode) > 0))){
//
//            $this->error_log('CRNRSTN :: encode_image(\'' . $tmp_crnrstn_file_to_encode . '\', \'' . $filetype . '\') WE HAVE A FILE (OR SOMETHING ACTUALLY MADE IT THROUGH CRNRSTN :: OPENSSL DECRYPTION).', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
//
//            if(strtolower($filetype) == '.png') {
//
//                //error_log(__LINE__ . ' user encode_image() WE HAVE A FILE.');
//                //die();
//
//                $_SESSION['CRNRSTN_' . $this->hash($this->config_serial)]['CRNRSTN_EXCEPTION_PREFIX'] = 'encode_image() attempting to open ' . $tmp_crnrstn_file_to_encode . '. ';
//                $img_binary = fread(fopen($tmp_crnrstn_file_to_encode, 'r'), $this->find_filesize($tmp_crnrstn_file_to_encode));
//
//                $tmp_base64 = 'data:image/' . $filetype . ';base64,' . base64_encode($img_binary);
//
//                $this->system_link_reset_base64_from_png($tmp_base64, $this->oCRNRSTN_ENV->data_encrypt($tmp_crnrstn_file_to_encode), $filetype);
//
//                return $tmp_base64;
//
//            }
//
//            if(strtolower($filetype) == '.jpg' || strtolower($filetype) == '.jpeg') {
//
//                $this->error_log('CRNRSTN :: encode_image(' . $tmp_crnrstn_file_to_encode . ') WE HAVE A FILE.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
//                //error_log(__LINE__ . ' user encode_image() WE HAVE A FILE.');
//                //die();
//                $tmp_path_to_png = $this->system_filename_convert_jpg_to_png($tmp_crnrstn_file_to_encode);
//                $this->system_link_reset_jpeg_from_png($this->oCRNRSTN_ENV->data_encrypt($tmp_path_to_png));
//
//                $img_binary = fread(fopen($tmp_crnrstn_file_to_encode, 'r'), $this->find_filesize($tmp_path_to_png));
//
//                $tmp_base64 = 'data:image/' . $filetype . ';base64,' . base64_encode($img_binary);
//
//                return $tmp_base64;
//
//            }
//
//        }else{
//
//            if(!is_file($tmp_crnrstn_file_to_encode)){
//
//                $this->error_log('CRNRSTN :: encode_image(' . $filetype . ') NOT IS_FILE(' . strlen($tmp_crnrstn_file_to_encode) . ')!!', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
//                //error_log(__LINE__ . ' user base64_encode_image() NOT IS_FILE!!');
//
//            }else{
//
//                $this->error_log('CRNRSTN :: encode_image(' . $filetype . ') YES, IS_FILE(' . strlen($tmp_crnrstn_file_to_encode) . ')!!', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
//                //error_log(__LINE__ . ' user base64_encode_image() YES, IS_FILE!!');
//
//            }
//
//            if(!is_string($tmp_crnrstn_file_to_encode)){
//
//                $this->error_log('CRNRSTN :: encode_image(' . $filetype . ') NOT IS_STRING(' . strlen($tmp_crnrstn_file_to_encode) . ')!!', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
//                //error_log(__LINE__ . ' user base64_encode_image() NOT IS_STRING!!');
//
//            }else{
//
//                $this->error_log('CRNRSTN :: encode_image(' . $filetype . ') YES, IS_STRING(' . strlen($tmp_crnrstn_file_to_encode) . ')!!', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
//                //error_log(__LINE__ . ' user base64_encode_image() YES, IS_STRING!!');
//
//            }
//
//        }
//
//    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.filesize.php
    // AUTHOR :: C0nw0nk :: https://www.php.net/manual/en/function.filesize.php#119435
    private function find_filesize($file){

        return $this->oCRNRSTN_ENV->find_filesize($file);

    }

    public function error_log($str, $line_num = NULL, $method = NULL, $file = NULL, $log_silo_key = NULL){

        //
        // Thursday, August 18, 2022 @ 0224 hrs
        return $this->oCRNRSTN->error_log($str, $line_num, $method, $file, $log_silo_key);

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

            //error_log(__LINE__ . ' user $integer_constant=' . print_r($integer_constant) . ' bitwise_serialization_cnt=' . self::$bitwise_serialization_cnt);
            $tmp_val = $this->oCRNRSTN_ENV->initialize_serialized_bit($tmp_bitwise_object_array_index_serial, self::$bitwise_serialization_cnt, $default_state);

            return $tmp_val;

        }else{

            //error_log(__LINE__ . ' user previously defined integer_constant = ' . $integer_constant);

            if(!is_int($integer_constant)){

                $integer_constant = constant($integer_constant);

            }

            return $this->oCRNRSTN_ENV->initialize_serialized_bit($tmp_bitwise_object_array_index_serial, $integer_constant, $default_state);

        }

    }

    public function define_resource_env_tmp($key, $value){

        $this->oCRNRSTN_ENV->oSESSION_MGR->set_session_tmp_param($key, $value);

    }

    public function catch_exception($exception_obj, $syslog_constant = LOG_DEBUG, $method = NULL, $namespace = NULL, $output_profile = NULL, $output_profile_override_meta = NULL, $wcr_override_pipe = NULL){

        $tmp_err_trace_str = $this->return_PHP_exception_trace_pretty($exception_obj->getTraceAsString());

        if(strlen($tmp_err_trace_str)>0){

            $this->error_log('PHP native exception output log trace received ::' . $tmp_err_trace_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

        }

        //
        // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
        $tmp_return = $this->oLogger->catch_exception($exception_obj, $syslog_constant, $method, $namespace, $output_profile, $output_profile_override_meta, $wcr_override_pipe, $this);

        if(is_array($tmp_return)){

            return $tmp_return;

        }

    }

    public function CRNRSTN_debug_mode(){

        return $this->oCRNRSTN_ENV->CRNRSTN_debug_mode();

    }

    public function PHPMAILER_debug_mode(){

        return $this->oCRNRSTN_ENV->PHPMAILER_debug_mode();

    }

    public function WORDPRESS_debug_mode(){

        return $this->oCRNRSTN_ENV->WORDPRESS_debug_mode();

    }

    public function crnrstn_http_endpoint(){

        return $this->oCRNRSTN->get_resource('crnrstn_http_endpoint', 0, 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES');

    }

    public function version_crnrstn(){

        return $this->oCRNRSTN_ENV->version_crnrstn();

    }

    public function version_apache(){

        return $this->oCRNRSTN_ENV->version_apache();

    }

    public function version_apache_sysimg(){

        return $this->oCRNRSTN_ENV->version_apache_sysimg();

    }

    public function version_php(){

        return $this->oCRNRSTN_ENV->version_php();

    }

    public function version_soap(){

        return $this->oCRNRSTN_ENV->version_soap();

    }

    public function version_mysqli(){

        return $this->oCRNRSTN_ENV->version_mysqli();

    }

    public function version_openssl(){

        return $this->oCRNRSTN_ENV->version_openssl();

    }

    public function version_linux(){

        return $this->oCRNRSTN_ENV->version_linux();

    }

    public function input_data_value($data_value, $data_key, $data_type_family = 'CRNRSTN::RESOURCE', $index = NULL, $data_auth_profile = CRNRSTN_AUTHORIZE_RUNTIME_ONLY, $env_key = NULL){

        if(!isset($env_key)){

            $env_key = $this->oCRNRSTN_ENV->env_key;

        }

        $this->oCRNRSTN->add_system_resource($data_key, $data_value, $index, $data_type_family, $data_auth_profile, $env_key);

    }

    public function input_data_value_simple($data_value, $data_key){

        $this->oCRNRSTN->input_data_value_simple($data_value, $data_key);

    }

    public function return_prefixed_ddo_key($resource_key, $env_key, $data_type_family = 'CRNRSTN::RESOURCE'){

        $tmp_dataset_prefix_str = $this->return_dataset_nomination_prefix('string', $this->config_serial_hash, $env_key, $data_type_family);

        return $tmp_dataset_prefix_str . $resource_key;

    }

    private function return_dataset_nomination_prefix($output_format = NULL, $var0 = NULL, $var1 = NULL, $var2 = NULL, $var3 = NULL, $var4 = NULL, $var5 = NULL, $var6 = NULL, $var7 = NULL, $var8 = NULL, $var9 = NULL, $var10 = NULL, $var11 = NULL){

        $tmp_var_index_pos = 0;
        $tmp_total_index = 0;

        if(!isset($output_format)){

            $output_format = 'array';

        }

        $tmp_str_out = '';
        $tmp_array_str_unit_ARRAY = array();
        $tmp_array_out_ARRAY = array();

        if(isset($var0)){

            $tmp_total_index++;
            $tmp_str_out .= $var0 . '::';
            $tmp_array_str_unit_ARRAY[] = $var0;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->oCRNRSTN->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var1)){

            $tmp_total_index++;
            $tmp_str_out .= $var1 . '::';
            $tmp_array_str_unit_ARRAY[] = $var1;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->oCRNRSTN->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var2)){

            $tmp_total_index++;
            $tmp_str_out .= $var2 . '::';
            $tmp_array_str_unit_ARRAY[] = $var2;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->oCRNRSTN->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var3)){

            $tmp_total_index++;
            $tmp_str_out .= $var3 . '::';
            $tmp_array_str_unit_ARRAY[] = $var3;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->oCRNRSTN->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var4)){

            $tmp_total_index++;
            $tmp_str_out .= $var4 . '::';
            $tmp_array_str_unit_ARRAY[] = $var4;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->oCRNRSTN->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var5)){

            $tmp_total_index++;
            $tmp_str_out .= $var5 . '::';
            $tmp_array_str_unit_ARRAY[] = $var5;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->oCRNRSTN->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var6)){

            $tmp_total_index++;
            $tmp_str_out .= $var6 . '::';
            $tmp_array_str_unit_ARRAY[] = $var6;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->oCRNRSTN->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var7)){

            $tmp_total_index++;
            $tmp_str_out .= $var7 . '::';
            $tmp_array_str_unit_ARRAY[] = $var7;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->oCRNRSTN->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var8)){

            $tmp_total_index++;
            $tmp_str_out .= $var8 . '::';
            $tmp_array_str_unit_ARRAY[] = $var8;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->oCRNRSTN->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var9)){

            $tmp_total_index++;
            $tmp_str_out .= $var9 . '::';
            $tmp_array_str_unit_ARRAY[] = $var9;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->oCRNRSTN->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var10)){

            $tmp_total_index++;
            $tmp_str_out .= $var10 . '::';
            $tmp_array_str_unit_ARRAY[] = $var10;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->oCRNRSTN->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var11)){

            $tmp_str_out .= $var11 . '::';
            $tmp_array_str_unit_ARRAY[] = $var11;

        }

        $tmp_array_out_ARRAY['string'] = $this->hash($tmp_str_out);
        $tmp_array_out_ARRAY['index_array'] = $tmp_array_str_unit_ARRAY;

        if($output_format == 'array') {

            return $tmp_array_out_ARRAY;

        }

        //
        // $output_format = 'string'
        return $tmp_array_out_ARRAY['string'];

    }

    public function proper_version($system = 'CRNRSTN'){

        $system = trim(strtoupper($system));

        switch($system){
            case 'LINUX':

                return $this->version_linux();

            break;
            case 'APACHE':

                return 'Apache v' . $this->version_apache();

            break;
            case 'MYSQLI':

                return 'MySQLi v' . $this->version_mysqli();

            break;
            case 'PHP':

                return 'php v' . $this->version_php();

            break;
            case 'SOAP':

                if(strlen($this->version_soap()) < 1){

                    $this->oNUSOAP_BASE = new nusoap_base();

                    $tmp_version_soap = $this->oNUSOAP_BASE->title;               //'NuSOAP';
                    $tmp_version_soap .= ' v' . $this->oNUSOAP_BASE->version;     //' v0.9.5';
                    //$tmp_version_soap .= ' ' . $this->oNUSOAP_BASE->revision;   //' $Revision: 1.123 $';

                    //$tmp_revision_soap = $this->proper_replace('Revision:','', $this->oNUSOAP_BASE->revision);
                    //$tmp_revision_soap .= $this->proper_replace('$','', $tmp_revision_soap);
                    //$tmp_revision_soap .= trim($tmp_revision_soap);
                    //$this->version_soap .= ' ' . $tmp_revision_soap;
                    $this->oCRNRSTN->input_data_value($tmp_version_soap, 'version_soap', NULL, 0, CRNRSTN_AUTHORIZE_RUNTIME_ONLY, NULL);
                    $this->oCRNRSTN->input_data_value($this->oNUSOAP_BASE->soap_defencoding, 'soap_defencoding', NULL, 0, CRNRSTN_AUTHORIZE_RUNTIME_ONLY, NULL);

                    //$this->consume_ddo_system_param($tmp_version_soap, 'version_soap');
                    //self::$oCRNRSTN_CONFIG_MGR->input_data_value($tmp_version_soap, 'version_soap');

                    return $tmp_version_soap;

                }

                return $this->version_soap();

            break;
            case 'OPENSSL':

                return 'OpenSSL v' . $this->version_openssl();

            break;
            case 'CRNRSTN':

                return 'CRNRSTN :: v' . $this->version_crnrstn();

            break;
            default:

                return 'UNKNOWN[' . $system . '] :: v[x].[y].[z]';

            break;

        }

    }

    public function return_CRNRSTN_ASCII_ART($index = NULL){

        return $this->oCRNRSTN->return_CRNRSTN_ASCII_ART($index);

    }

    public function return_jony5_content($component){

        switch($component){
            case 'banner_lifestyle_alpha':

                $tmp_file_name_ARRAY = array();

                $tmp_output_images_data = '';
                $tmp_LIFESTYLE_IMAGES_DATA_cnt = $this->return_record_count('LIFESTYLE_IMAGES_DATA');

                $tmp_LIFESTYLE_IMAGES_DATA_cnt--;
                $tmp_index_flag_ARRAY = array();
                $tmp_max_img_return = 25;
                $tmp_max_collision_aversions = 10;
                for ($i = 0; $i < $tmp_max_img_return; $i++) {

                    $image_index = rand(0, $tmp_LIFESTYLE_IMAGES_DATA_cnt);

                    if(isset($tmp_index_flag_ARRAY[$image_index])){

                        for($ii = 0; $ii < $tmp_max_collision_aversions; $ii++){

                            //
                            // A WEAK AVERSION ATTEMPT FOR AVOIDING COLLISION-INSTIGATED
                            // RESULT SET CANNIBALISM
                            $image_index = rand(0, $tmp_LIFESTYLE_IMAGES_DATA_cnt);

                            if(!isset($tmp_index_flag_ARRAY[$image_index])){

                                $tmp_index_flag_ARRAY[$image_index] = 1;
                                $ii = $tmp_max_collision_aversions + 1;
                                //$i = $tmp_max_img_return + 1;

                            }

                        }

                    }else{

                        $tmp_index_flag_ARRAY[$image_index] = 1;

                    }

                    $tmp_IMAGE_FILENAME = $this->return_database_value('LIFESTYLE_IMAGES_DATA', 'IMAGE_FILENAME_DESKTOP', $image_index);
                    //$tmp_IMAGE_MD5_DESKTOP = $this->oCRNRSTN_USR->return_database_value('LIFESTYLE_IMAGES_DATA', 'IMAGE_MD5_DESKTOP', $image_index);
                    //$tmp_IMAGE_SHA1_DESKTOP = $this->oCRNRSTN_USR->return_database_value('LIFESTYLE_IMAGES_DATA', 'IMAGE_SHA1_DESKTOP', $image_index);
                    //$tmp_IMAGE_FILESIZE_DESKTOP_BYTES = $this->oCRNRSTN_USR->return_database_value('LIFESTYLE_IMAGES_DATA', 'IMAGE_FILESIZE_DESKTOP', $image_index);

                    //$tmp_IMAGE_FILESIZE_DESKTOP = $this->oCRNRSTN_USR->format_bytes($tmp_IMAGE_FILESIZE_DESKTOP_BYTES, 4);

                    $tmp_file_name_ARRAY[] = $tmp_IMAGE_FILENAME;

                }

                switch($this->device_type){
                    case 'MOBILE':

                        //$tmp_dir_path = $this->get_resource('BANNER_IMAGES_HTTP_DIR_MOBILE');

                    case 'TABLET':

                        //$tmp_dir_path = $this->get_resource('BANNER_IMAGES_HTTP_DIR_TABLET');

                    default:
                        // DESKTOP

                        $tmp_dir_path = $this->get_resource('BANNER_IMAGES_HTTP_DIR_DESKTOP');

                    break;

                }

                $hidden_image_array_html = '';
                foreach($tmp_file_name_ARRAY as $index => $file_name){

                    if(!isset($tmp_image_alpha_injection)){

                        $tmp_image_alpha_injection = '<img src="' . $this->get_resource('ROOT_PATH_CLIENT_HTTP') . $this->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . $tmp_dir_path . $tmp_file_name_ARRAY[0] . '" width="1180" height="250" alt="Jonathan \'J5\' Harris">';
                        $hidden_image_array_html .= '<div class="hidden jony5_lifestyle_image">' . $file_name . '</div>';

                    }else{

                        $hidden_image_array_html .= '<div class="hidden jony5_lifestyle_image">' . $file_name . '</div>';

                    }

                }

                return $tmp_image_alpha_injection . $hidden_image_array_html;

            break;

        }

    }

    public function return_bassdrive_element($element_type){

        $tmp_resp_output = '';

        if($this->get_resource('BASSDRIVE_INTEGRATE')){

            $tmp_resp_output = $this->oCRNRSTN_TRM->return_bassdrive_element($element_type);

        }

        return $tmp_resp_output;

    }

    public function reporting_sync_bassdrive_log(){

        $tmp_resp_output = '';

        if($this->get_resource('BASSDRIVE_INTEGRATE')) {

            if (!isset($this->oCRNRSTN_BASSDRIVE)) {

                $this->oCRNRSTN_BASSDRIVE = new crnrstn_bassdrive_stream_manager($this);

            }

            $tmp_resp_output = $this->oCRNRSTN_BASSDRIVE->reporting_sync_bassdrive_log();

        }

        return $tmp_resp_output;

    }

    public function relay_sync_bassdrive_log(){

        $tmp_resp_output = '';

        if($this->get_resource('BASSDRIVE_INTEGRATE')) {

            if (!isset($this->oCRNRSTN_BASSDRIVE)) {

                $this->oCRNRSTN_BASSDRIVE = new crnrstn_bassdrive_stream_manager($this);

            }

            $tmp_resp_output = $this->oCRNRSTN_BASSDRIVE->relay_sync_bassdrive_log();

            $tmp_resp_output = '<div style="padding:20px;">oCRNRSTN_USR->refresh_bassdrive_history() --PENDING[' . $tmp_resp_output . ']-- </div>';

        }

        return $tmp_resp_output;

    }

    public function log_bassdrive_nowplaying(){

        $tmp_resp_output = '';

        if($this->get_resource('BASSDRIVE_INTEGRATE')) {

            $this->oCRNRSTN_BASSDRIVE = new crnrstn_bassdrive_stream_manager($this);

            $tmp_resp_output = $this->oCRNRSTN_BASSDRIVE->log_bassdrive_nowplaying();

            $tmp_resp_output = '<div style="padding:20px;">oCRNRSTN_USR->log_bassdrive_nowplaying() --HELLO WORLD[' . $tmp_resp_output . ']-- </div>';

        }

        return $tmp_resp_output;

    }

    public function refresh_bassdrive_history(){

        $tmp_resp_output = '';

        if($this->get_resource('BASSDRIVE_INTEGRATE')) {

            if (!isset($this->oCRNRSTN_BASSDRIVE)) {

                $this->oCRNRSTN_BASSDRIVE = new crnrstn_bassdrive_stream_manager($this);

            }

            $tmp_resp_output = $this->oCRNRSTN_BASSDRIVE->refresh_bassdrive_history();

            return '<div style="padding:20px;">oCRNRSTN_USR->refresh_bassdrive_history() --PENDING[' . $tmp_resp_output . ']-- </div>';

        }

        return $tmp_resp_output;

    }

    public function valid_primary_key_check($original_serial, $key_field_type, $key_length, $key_string_chars = NULL){

        $key_field_type = trim(strtolower($key_field_type));
        $key_length = ((int) $key_length * 1) + 0;

        switch($key_field_type){
            case 'char':
            case 'varchar':
            case 'text':

                $tmp_original_serial_len = strlen($original_serial);

                if($tmp_original_serial_len != $key_length){

                    return $this->generate_new_key($key_length, $key_string_chars);

                }

            break;

        }

        return $original_serial;

    }

    public function return_valid_primary_key($original_serial, $key_field_type, $key_length, $table_name, $field_name, $checksum_field_name = NULL, $key_string_chars = NULL){

        try{

            $tmp_out_serial = $original_serial;
            $key_field_type = trim(strtolower($key_field_type));
            $key_length = ((int) $key_length * 1) + 0;

            //
            // STRING LENGTH BUFFER/TRIM ORIGINAL SERIAL...AN INTEGRITY CHECK FOR STRING DATA TYPE SERIALS
            // I NEED THIS TO CLEAN UP AN AUTO INCREMENT INT(11) FIELD FROM AN OLD ARCHITECTURE AND TO
            // BRING SERIAL IN LINE WITH THE NEW FIELD LENGTH
            switch($key_field_type){
                case 'char':
                case 'varchar':
                case 'text':

                    $tmp_original_serial_len = strlen($original_serial);

                    if($tmp_original_serial_len != $key_length){

                        //error_log(__LINE__ . ' crnrstn_usr ORIGINAL ' . $table_name . '.' . $field_name . ' SERIAL LENGTH[' . $tmp_original_serial_len.'] ERROR ON LENGTH! REQUIRED LENGTH, ' . $key_length . '.');
                        $tmp_out_serial = $this->return_clean_primary_key($original_serial, $key_length, $key_string_chars);

                    }

                break;

            }

            $tmp_check_expired = false;
            $tmp_search_cnt = 0;
            $tmp_max_attempt_sql_key_search = 10;      // THIS SHOULD BE CONFIGURABLE.
            while($tmp_check_expired === false){

                //
                // RETURN STRING IF UNIQUE
                if($this->primary_key_is_unique($tmp_out_serial, $table_name, $field_name, $checksum_field_name)){

                    $this->new_serial_log_ARRAY[] = $tmp_out_serial;
                    $tmp_check_expired = true;

                    return $tmp_out_serial;

                }

                $tmp_search_cnt++;

                if($tmp_search_cnt > $tmp_max_attempt_sql_key_search){

                    $tmp_check_expired = true;

                }

            }

            throw new Exception('CRNRSTN :: After ' . $tmp_search_cnt.' serial refresh attempts, still unable to confirm uniqueness of key[' . $tmp_out_serial . '] for ' . $table_name . $field_name . '[' . $checksum_field_name . '].');

        } catch (Exception $e) {

            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function table_field_value_exists($value, $table_name, $field_name , $field_name_crc32 = NULL){

        $oCRNRSTN_MySQLi = $this->return_crnrstn_mysqli();
        $mysqli = $oCRNRSTN_MySQLi->return_conn_object();

        //
        // CONFIRM WHETHER A MATCH IS IN TABLE.
        if(isset($field_name_crc32)){

            $tmp_query = 'SELECT `' . $table_name . '`.`' . $field_name . '`
            FROM `' . $table_name . '` 
            WHERE `' . $table_name . '`.`' . $field_name . '` = "' . $mysqli->real_escape_string($value) . '" 
            AND `' . $table_name . '`.`' . $field_name_crc32 . '` = "' . $this->hash($value, 'crc32') . '" LIMIT 1;';

        }else{

            $tmp_query = 'SELECT `' . $table_name . '`.`' . $field_name . '`
            FROM `' . $table_name . '` 
            WHERE `' . $table_name . '`.`' . $field_name . '` = "' . $mysqli->real_escape_string($value) . '" LIMIT 1;';

        }

        $tmp_sql_serial = $this->generate_new_key(25);
        $this->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!jesus_is_my_dear_lord!', 'VALUE_EXISTENCE_CHECK_' . $tmp_sql_serial);
        $this->add_database_query('VALUE_EXISTENCE_CHECK_' . $tmp_sql_serial, $tmp_query);

        //
        // PROCESS ALL QUERY TO CONNECTION(S)
        $this->process_query();

        $tmp_count = $this->return_record_count('VALUE_EXISTENCE_CHECK_' . $tmp_sql_serial);

        if($tmp_count > 0){

            return true;

        }else{

            return false;

        }

    }

    private function primary_key_is_unique($tmp_out_serial, $table_name, $field_name, $checksum_field_name){

        //
        // NOTE: ANY FIELDS COMING INTO THIS PLACE SHOULD DEFINITELY BE MYSQL TABLE INDEXED BY THE TIME OF
        // RTM TO PRODUCTION
        //
        // CHECK TABLE FOR EXISTENCE OF THIS NEW SERIAL. FOR VICTORY, WE NEED GUARANTEE OF SERIAL UNIQUENESS + FEEDBACK
        // LOOP TO RECOVERY.

        //
        // QUERY FOR CONFIRMATION OF UNIQUENESS
        if(isset($checksum_field_name)){

            $tmp_query = 'SELECT COUNT(*) AS `DUP_COUNT`
            FROM `' . $table_name . '`
            WHERE `' . $table_name . '`.`' . $field_name . '`= "' . $tmp_out_serial . '"
            AND `' . $table_name . '`.`' . $checksum_field_name . '`= "' . $this->hash($tmp_out_serial, 'crc32') . '";';

        }else{

            $tmp_query = 'SELECT COUNT(*) AS `DUP_COUNT`
            FROM `' . $table_name . '`
            WHERE `' . $table_name . '`.`' . $field_name . '`="' . $tmp_out_serial . '";';

        }

        //
        //add_database_query() WILL SERIALIZE THE QUERY TO THE CONNECTION PROVIDED. CRNRSTN :: SUPPORTS n+1 MYSQLI DATABASE CONNECTIONS.
        $tmp_query_serial = $this->generate_new_key(25);
        $this->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!jesus_is_my_dear_lord!', 'SERIAL_UNIQUENESS_CHECK_' . $tmp_query_serial);
        $this->add_database_query('SERIAL_UNIQUENESS_CHECK_' . $tmp_query_serial, $tmp_query);

        //
        // PROCESS ALL QUERY TO CONNECTION(S)
        $this->process_query(true);

        $tmp_duplicate_serial_count = $this->return_database_value('SERIAL_UNIQUENESS_CHECK_' . $tmp_query_serial, 'DUP_COUNT');

        $tmp_duplicate_serial_count = (int) $tmp_duplicate_serial_count * 1;

        if($tmp_duplicate_serial_count > 0){

            return false;

        }else{

            if($tmp_duplicate_serial_count == 0){

                return true;

            }else{

                return false;

            }

        }

    }

    private function return_clean_primary_key($original_serial, $key_length, $key_string_chars){

        $tmp_string_out = '';
        $tmp_original_serial_len = strlen($original_serial);
        if($tmp_original_serial_len < $key_length){

            $tmp_padding_str_len = $key_length - $tmp_original_serial_len;
            $tmp_padding_str = $this->generate_new_key($tmp_padding_str_len, $key_string_chars);

            $tmp_string_out = $original_serial.$tmp_padding_str;

        }else{

            //
            // NEED TO TRIM STRING TO APPROPRIATE LENGTH OF $key_length
            $tmp_original_str_ARRAY = str_split($original_serial);

            for($i = 0; $i < $key_length; $i++){

                $tmp_string_out .= $tmp_original_str_ARRAY[$i];

            }

        }

        $tmp_serial_generation_expired = false;
        $tmp_max_attempt_serial_gen = 50;      // THIS SHOULD BE CONFIGURABLE.
        while($tmp_serial_generation_expired === false){

            $tmp_max_attempt_serial_gen--;

            if(in_array($tmp_string_out, $this->new_serial_log_ARRAY)){

                //
                // GENERATE NEW SERIAL
                $tmp_string_out = $this->generate_new_key($tmp_padding_str_len, $key_string_chars);

            }else{

                $tmp_serial_generation_expired = true;

            }

            if($tmp_max_attempt_serial_gen < 0){

                $tmp_serial_generation_expired = true;

            }

        }

        return $tmp_string_out;

    }

    public function get_url_content($url){

        // https://www.php.net/manual/en/function.curl-init.php
        $opts = array(
            'http' => array (
                'method'=>"POST",
                'header'=>
                    "Accept-language: en\r\n".
                    "Content-type: application/x-www-form-urlencoded\r\n",
                'content'=>http_build_query(array('foo'=>'bar'))
            )
        );

        $context = stream_context_create($opts);

        $fp = fopen($url, 'r', false, $context);

        $contents = '';
        while (!feof($fp)){
            // https://stackoverflow.com/questions/3308388/fopen-returns-resource-id-4
            // https://www.php.net/manual/en/function.fread.php
            $contents .= fread($fp, 8192);

        }

        fclose($fp);

        return $contents;

    }

    //
    // CURL URI...SUCH AS BASSDRIVE NOW PLAYING INFO
    public function ___get_url_content($url){

        if($this->isSSL()){

            $source_url = 'https://' . $_SERVER['SERVER_NAME'];

        }else{

            $source_url = 'http://' . $_SERVER['SERVER_NAME'];

        }

        try{

            $header=array(
                'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36',
                'X-Requested-With: XMLHttpRequest',
                'Host: www.bassdrive.com',
                'Accept: text/html, */*; q=0.01',
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Accept-Language: en-US,en;q=0.9,zh-CN;q=0.8,zh;q=0.7',
                'Accept-Encoding: gzip,deflate',
                'Referer: ' . $source_url,
                'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7',
                'Keep-Alive: 115',
                'Connection: keep-alive',
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            //curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            //curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_ENCODING, "");
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 100);
            curl_setopt($ch, CURLOPT_TIMEOUT, 100);
            curl_setopt($ch,CURLOPT_HTTPHEADER,$header);

            if( ! $data = curl_exec($ch)){

                throw new Exception('CRNRSTN :: ' . $this->version_crnrstn().' :: CURLOPT_URL=[' . $url.'] ERROR on '. __METHOD__ .' from ' . $_SERVER['SERVER_NAME'].' (' . $_SERVER['SERVER_ADDR'].'). Where curl_error='.curl_error($ch));

            }

            error_log('10552 user uri=[' . $url.'] data=[' . print_r($data, true). ']');

            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            return ($httpcode>=200 && $httpcode<300) ? $data : false;

        } catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function __get_url_content($url){

        //$debugMode = 0;
        //$oLogger = new crnrstn_logging($debugMode);

        $header=array(
            'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36',
            'X-Requested-With: XMLHttpRequest',
            'Host: www.bassdrive.com',
            'Accept: text/html, */*; q=0.01',
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Language: en-US,en;q=0.9,zh-CN;q=0.8,zh;q=0.7',
            'Accept-Encoding: gzip,deflate',
            'Referer: ' . $this->get_resource('ROOT_PATH_CLIENT_HTTP').$this->get_resource('ROOT_PATH_CLIENT_HTTP_DIR'),
            'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7',
            'Keep-Alive: 115',
            'Connection: keep-alive',
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        //curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        //curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 100);
        curl_setopt($ch, CURLOPT_TIMEOUT, 100);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);

        if( ! $data = curl_exec($ch)){
            //$oLogger->captureNotice('[ERROR] CRON Fired CURL :: /_cron/bassdrive_sync/', LOG_CRIT, curl_error($ch));
        }

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return ($httpcode>=200 && $httpcode<300) ? $data : false;

    }

    //
    // SOURCE :: https://aloneonahill.com/blog/if-php-were-british/
    // AUTHOR :: https://aloneonahill.com/blog/about-dave/
    public function hello_world($is_bastard = true){

        //
        // SESSION IS SET
        try{

            if($is_bastard){

                $str = 'Hello World.';  // bastard dialect

            }else{

                $str = 'Good morrow, fellow subjects of the Crown.';

            }

            error_log(__LINE__ . ' ' . get_class() . ' exception! ' . $str);
            throw new Exception('CRNRSTN ' . $this->version_crnrstn().' :: ' . $str . ' This is an exception handling test from ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ').');

            return $this->oCRNRSTN_ENV->hello_world($is_bastard);

        } catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function resource_filecache_version($file_path){

        $file_cache_version_str = filesize($file_path) . '.' . filemtime($file_path).'.0';

        return $file_cache_version_str;

    }

    public function tidy_boolean($val, $format = 'bool'){

        $format = strtolower($format);

        //error_log(__LINE__ . ' user tidy_boolean[' . print_r($val, true) . ']');

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
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

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

        if($parts === false){

            throw new \InvalidArgumentException('Malformed URL: ' . $url);

        }

        foreach($parts as $name => $value){

            $parts[$name] = urldecode($value);

        }

        return $parts;

    }

    public function mkdir_r($dir_path, $mkdir_mode = NULL){

        return $this->oCRNRSTN_ENV->mkdir_r($dir_path, $mkdir_mode);

    }

    public function validate_DIR_endpoint($dir_path, $endpoint_type = 'DESTINATION', $mkdir_mode = 775){

        return $this->oCRNRSTN->validate_DIR_endpoint($dir_path, $endpoint_type, $mkdir_mode);

    }

//    private function output_agg_destruct_str(){
//
//        if($this->destruct_output != ''){
//
//            //
//            // SET DEFAULT CONSTANT
//            $style_theme = CRNRSTN_UI_PHPNIGHT;
//
//            $tmp_theme_ARRAY = $this->oCRNRSTN_ENV->return_set_bits($this->oCRNRSTN_ENV->system_theme_style_constants_ARRAY);
//
//            if(count($tmp_theme_ARRAY) > 0){
//
//                $style_theme = $tmp_theme_ARRAY[0];     // WE TAKE THE FIRST
//
//            }
//
//            $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('Process ' . __CLASS__ . '::__destruct initiated output of error log trace data.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);
//
//            //$this->print_r($this->destruct_output, 'C<span style="color:#F00;">R</span>NRSTN Debug Mode 2 :: Error Log Trace Debug Output ::', $style_theme, __LINE__, __METHOD__, __FILE__);
//            print_r('<div style="height:20px; width:100%; clear:both; display: block; overflow: hidden;">&nbsp;</div>');
//            print_r($this->destruct_output);
//
//        }
//
//    }

    public function __destruct(){

//        $this->output_agg_destruct_str();

        $this->oCRNRSTN->oLog_output_ARRAY[] = $this->error_log('goodbye crnrstn :: ' . __CLASS__ . '::' . __METHOD__ . ' called. [rtime ' . $this->wall_time() . ' secs]', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);

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
    public $oCRNRSTN_USR;
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
        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN_USR);

        //$this->max_seconds_inactive = $this->oCRNRSTN_USR->account_max_secs_inactive();

    }

    public function refresh_modified_date(){

        $this->last_modified_date = $this->oCRNRSTN_USR->return_micro_time();

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

            //error_log(__LINE__ . ' user ERROR? $resource=[' . $resource . '] = 10. class=['.get_class($this->oUSER_ACCOUNT).']');

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

                    error_log(__LINE__ . ' user maintain_valid_session return true');

                    $this->refresh_modified_date();

                    return true;

                }

            }

        }

        error_log(__LINE__ . ' user maintain_valid_session return false');

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

        error_log(__LINE__ . ' user class[' . get_class() . '] monitor_ip_address [' . $tmp_sess_ip . '] == [' . $tmp_curr_ip . ']');

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

        $raw_html_data = $this->extract_data_HTTP('ugc_html', 'POST');
        $tmp_crnrstn_css_rtime = $this->extract_data_HTTP('css_rtime');
        if($this->isset_http_param('crnrstn_r', 'GET')){

         * return_admin_ARRAY

         */

        $tmp_email = $this->oCRNRSTN_USR->get_http_resource('crnrstn_auth_e');

        $tmp_pwd_hash = $this->hash($this->oCRNRSTN_USR->get_http_resource('crnrstn_auth_pwd'));

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
            $this->log_account_notification($this->oCRNRSTN->multi_lang_content_return('CRNRSTN_SESSION_INACTIVE_EXPIRE'));
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