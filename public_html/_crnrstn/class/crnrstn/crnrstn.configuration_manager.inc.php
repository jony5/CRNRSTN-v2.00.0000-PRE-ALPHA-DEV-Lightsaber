<?php
/**
* @package CRNRSTN

// J5
// Code is Poetry */
# # C # R # N # R # S # T # N # : : # # # #
#
#        CRNRSTN :: An open source PHP class library supporting enterprise application development that is framed within
#                   the context of mature/rigid RTM protocols.
#        VERSION :: 2.00.0000 PRE-ALPHA-DEV (Lightsaber)
#      TIMESTAMP :: Tuesday, November 28, 2023 @ 16:20:00.065620.
#  DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#         AUTHOR :: Jonathan 'J5' Harris, CEO, CTO, Lead Full Stack Developer.
#            URI :: http://crnrstn.evifweb.com/
#       OVERVIEW :: CRNRSTN :: An Open Source PHP Class Library that stands on top of a robust web services oriented
#                   architecture to both facilitate, augment, and enhance (with stability) the operations of a code base
#                   for a web application across multiple hosting environments.
#
#                   Copyright (C) 2012-2023 eVifweb development.
#    DESCRIPTION :: CRNRSTN :: is an open source PHP class library that will facilitate and spread (via SOAP services)
#                   operations of a web application across multiple servers or environments (e.g. localhost, stage,
#                   preprod, and production). With this tool, data and functionality possessing characteristics that
#                   inherently create distinctions between one environment and another can all be managed through one
#                   framework for an entire application. IP address restrictions, error logging profiles, and database
#                   authentication credentials are a few areas within an application's architecture where
#                   CRNRSTN :: was designed to excel.
#
#                   Once CRNRSTN :: has been configured to support all of a web application's running servers, one can
#                   seamlessly RTM the codebase of the web site without having to modify the configuration to account
#                   for any unique and environmentally specific parameters. Receive the benefit of a robust and polished
#                   framework that will bubble up logs from exception notifications to any output channel (email, hidden
#                   HTML comment, native default,...etc.) of one's own choosing.
#
#                   For example, stand on top of the CRNRSTN :: SOAP services layer to organize and strengthen the
#                   communications architecture of any web application. By supporting many-to-one proxy messaging
#                   relationships between slaves and a master "communications server", CRNRSTN :: can streamline and
#                   simplify the management of web application communications; one can configure everything from SMTP
#                   credentials to the character count for line wrapping in the text versions of multi-part HTML email.
#
#                   This is the "King's Highway" for sending email communications.
#        LICENSE :: MIT
#                   Permission is hereby granted, free of charge, to any person obtaining
#                   a copy of this software and associated documentation files (the
#                   "Software"), to deal in the Software without restriction, including
#                   without limitation the rights to use, copy, modify, merge, publish,
#                   distribute, sublicense, and/or sell copies of the Software, and to
#                   permit persons to whom the Software is furnished to do so, subject to
#                   the following conditions:
#
#                   The above copyright notice and this permission notice shall be
#                   included in all copies or substantial portions of the Software.
#
#                   THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
#                   EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
#                   MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
#                   IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
#                   CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
#                   TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
#                   SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
#
# # C # R # N # R # S # T # N # : : # # # #
#
#  CLASS :: crnrstn_configuration_manager
#  VERSION :: 1.00.0000
#  DATE :: August 13, 2022 @ 0118 hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: Manage all CRNRSTN :: input datum heavy lifting.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_configuration_manager {

    protected $oLogger;
    public $oCRNRSTN;

    private static $oCRNRSTN_DDO;
    private static $system_data_profile_constants_ARRAY = array();
    protected $system_profile_data_key_map_ARRAY = array();

    public $config_serial_hash;

    public $total_bytes_stored = 0;

    public function __construct($oCRNRSTN){

        $this->oCRNRSTN = $oCRNRSTN;

        $this->config_serial_hash = $oCRNRSTN->get_server_config_serial('hash');

        $this->init_data_profile_constants();

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN);

        self::$oCRNRSTN_DDO = new crnrstn_decoupled_data_object($this->oCRNRSTN, $this->oCRNRSTN->salt(100, '01'),'CRNRSTN_SYSTEM_SERIALIZED_DDO');

    }

    public function set_channel_config($channel_constant, $attribute_name, $data){

        //
        // STANDARDIZE CHANNEL REFERENCE INPUT FOR
        // STRING CONCATENATION.
        $tmp_channel_name = $this->oCRNRSTN->get_channel_config($channel_constant, 'NAME');
        error_log(__LINE__ . ' config mgr CHANNEL CONFIG HOOK UP ready. die();');
        error_log(__LINE__  . ' config mgr ' . __METHOD__ . ' die(); channel_constant[' . $channel_constant . ']. $attribute_name[' . strval($attribute_name) . ']. data[' . $data . '.');

        die();

        return ; //self::$oCRNRSTN_DDO->set_channel_config($channel_constant, $attribute_name, $data);

    }

    // public function get_channel_config($channel_constant, $attribute_name){


    //     error_log(__LINE__  . ' config mgr ' . __METHOD__ . ' die(); channel_constant[' . $channel_constant . ']. $attribute_name[' . strval($attribute_name) . '].');

    //     die();

    //     return ; //self::$oCRNRSTN_DDO->set_channel_config($channel_constant, $attribute_name);

    // }

    public function isset_channel_config($channel_constant, $attribute_name, $return_type = CRNRSTN_BOOLEAN){
        // Thursday, November 23, 2023 @ 0031 hrs.

        error_log(__LINE__  . ' config mgr ' . __METHOD__ . ' die(); channel_constant[' . $channel_constant . ']. $attribute_name[' . strval($attribute_name) . ']. $return_type[' . $this->oCRNRSTN->data_type_filter($return_type, CRNRSTN_STRING) . '].');

        die();

        return ; //self::$oCRNRSTN_DDO->set_channel_config($channel_constant, $attribute_name, $return_type);

    }

    public function rrs_map_get($name, $channel){

        return self::$oCRNRSTN_DDO->rrs_map_get($name, $channel);

    }

    //
    // RETURNS STRING OR ARRAY DATA WITH DESIRED REPORTS.
    public function channel_report($channel_constant, $channel_report_queue, $return_data_type, $php_logo_height, $to_plaid, $is_HTML, $report_delimiter_TEXT, $report_delimiter_HTML){
        // WHERE, $channel_report_queue = array(CRNRSTN_CHANNEL_SOAP, CRNRSTN_CHANNEL_GET, CRNRSTN_CHANNEL_COOKIE);
        // WHERE, $channel_report_queue = CRNRSTN_CHANNEL_SOAP;

        return self::$oCRNRSTN_DDO->channel_report($channel_constant, $channel_report_queue, $return_data_type, $php_logo_height, $to_plaid, $is_HTML, $report_delimiter_TEXT, $report_delimiter_HTML);

    }

    public function get_channel_config($channel, $index_0 = NULL, $index_1 = NULL, $index_2 = NULL, $index_3 = NULL, $initialize = false){

        return self::$oCRNRSTN_DDO->get_channel_config($channel, $index_0, $index_1, $index_2, $index_3, $initialize);

    }

    public function initialize_multi_channel_environment_key(){

        self::$oCRNRSTN_DDO->initialize_multi_channel_environment_key();

    }

    public function config_channel_data_translate(){

        self::$oCRNRSTN_DDO->config_channel_data_translate();

    }

    public function channel_access_is_authorized($channel, $data_authorization_profile){

        return self::$oCRNRSTN_DDO->channel_access_is_authorized($channel, $data_authorization_profile);

    }

    public function get_ddo_resource_channel_array($ddo_memory_pointer){

        return self::$oCRNRSTN_DDO->get_ddo_resource_channel_array($ddo_memory_pointer);

    }

    public function build_ddo_resource_pointer($ddo_memory_pointer, $channel){

        return self::$oCRNRSTN_DDO->build_ddo_resource_pointer($ddo_memory_pointer, $channel);

    }

    public function isset_ddo_resource_pointer($data_key, $data_type_family, $data_auth_channel){

        return self::$oCRNRSTN_DDO->isset_ddo_resource_pointer($data_key, $data_type_family, $data_auth_channel);

    }

    public function consume_rrs_map($oCRNRSTN_RRS_MAP){

        $this->oCRNRSTN_RRS_MAP = $oCRNRSTN_RRS_MAP;

    }

    public function system_profile_return_count($profile_key){

        return count($this->system_profile_data_key_map_ARRAY[$profile_key]);

    }

    public function system_profile_map_data_key($profile_key, $data_key){

        $this->system_profile_data_key_map_ARRAY[$profile_key][] = $data_key;

        return true;

    }

    public function system_profile_return_data_key($profile_key, $index = 0){

        return $this->system_profile_data_key_map_ARRAY[$profile_key][$index];

    }

    private function init_data_profile_constants(){

        self::$system_data_profile_constants_ARRAY = $this->oCRNRSTN->system_data_profile_constants_ARRAY();

    }

    public function get_resource_count($data_key, $data_type_family, $env_key){

        //
        // WHAT IS THIS?
        error_log(__LINE__ . ' config manager WHAT IS THIS? die()');
        die();
        return self::$oCRNRSTN_DDO->count($this->oCRNRSTN->hash_ddo_memory_pointer($data_key, $data_type_family, $env_key), $env_key);

    }

    public function input_data_value($data_val, $data_key, $data_type_family = 'CRNRSTN::RESOURCE', $index = NULL, $data_authorization_profile = NULL, $ttl = 60, $spool_resource = false, $env_key = NULL){

        try{

            if(!isset($data_type_family)){

                //
                // ENSURE A DEFAULT DATA TYPE FAMILY FOR THIS DATA STORAGE MOVEMENT.
                $data_type_family = 'DDO';

            }else{

                if(strlen($data_type_family) < 1){

                    $data_type_family = 'DDO';

                }

            }

            if(!isset($data_authorization_profile)){

                //
                // IF THE DATA AUTHORIZATION PROFILE IS NOT SET, LOAD THE DEFAULT FROM SETTINGS.
                $data_authorization_profile = $this->oCRNRSTN->get_resource('data_authorization_profile', 0, 'CRNRSTN::RESOURCE::CONFIGURATION');

                //
                // THIS SHOULD BE AN INTEGER ON ACCOUNT OF THE ROBUST
                // CRNRSTN :: CONFIGURATION UGC INPUT VALIDATION THAT IS
                // NOW IN PLACE.
                if(!is_int($data_authorization_profile)){

                    $data_authorization_profile = $this->oCRNRSTN->return_int_const_profile($data_authorization_profile, CRNRSTN_INTEGER);

                }

                //
                // WE NEED A DEFAULT CHANNEL TO BE AUTHORIZED TO RECEIVE
                // CONFIGURATION DATA UNTIL SETTINGS CAN FINISH LOADING.
                // THIS SHOULD BE RUNTIME.
                if(strlen((string) $data_authorization_profile) < 1 || ($data_authorization_profile == $this->oCRNRSTN->session_salt())){

                    //
                    // ESTABLISH DEFAULT DATA STORAGE CHANNEL AUTHORIZATION PROFILE.
                    $data_authorization_profile = CRNRSTN_AUTHORIZE_RUNTIME;

                }

            }

            return self::$oCRNRSTN_DDO->add($data_val, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE.
            return false;

        }

    }

    public function crnrstn_data_packet_hidden_input_return($channel_constant, $crnrstn_form_handle){

        //error_log(__LINE__ . ' crnrstn $channel_constant=[' . $channel_constant . ']. $crnrstn_form_handle=[' . $crnrstn_form_handle . '].');
        if(is_array($crnrstn_form_handle)){

            self::$oCRNRSTN_DDO->set_data_output_channel($channel_constant, $crnrstn_form_handle[0]);
            return self::$oCRNRSTN_DDO->preach('crnrstn_data_packet_hidden_input_html', $crnrstn_form_handle[0], $channel_constant);

        }

        //
        // I SUSPECT THAT THIS WILL NO LONGER RUN DUE TO NEWER SERIALIZATION REQUIREMENTS
        self::$oCRNRSTN_DDO->set_data_output_channel($channel_constant, $crnrstn_form_handle);

        return self::$oCRNRSTN_DDO->preach('crnrstn_data_packet_hidden_input_html', $crnrstn_form_handle, $channel_constant);

    }

    public function crnrstn_data_packet_return($output_channel_constant){

        //error_log(__LINE__ . ' ccm ' . __METHOD__ . ' $output_channel_constant=[' . print_r($output_channel_constant, true) . '].');
        //$this->oCRNRSTN->print_r(print_r($output_channel_constant, true), NULL, NULL, __LINE__, __METHOD__, __FILE__);

        if(is_array($output_channel_constant)){

            return self::$oCRNRSTN_DDO->preach('crnrstn_data_packet', $output_channel_constant[0], CRNRSTN_CHANNEL_FORM_INTEGRATIONS);

        }

        //
        // I SUSPECT THAT THIS WILL NO LONGER RUN DUE TO NEWER SERIALIZATION REQUIREMENTS
        return self::$oCRNRSTN_DDO->preach('crnrstn_data_packet', $output_channel_constant,CRNRSTN_CHANNEL_FORM_INTEGRATIONS);

    }

    public function retrieve_data_value($data_key, $data_type_family = 'CRNRSTN::RESOURCE', $index = NULL, $env_key = NULL, $data_authorization_profile = CRNRSTN_AUTHORIZE_RUNTIME){

        try{

            if(!isset($env_key)){

                $env_key = CRNRSTN_RESOURCE_ALL;

            }

            if(!isset($index)){

                $index = 0;

            }

            $tmp_data_key = $this->oCRNRSTN->hash_ddo_memory_pointer($data_key, $data_type_family, $env_key);

            //error_log(__LINE__ . ' crnrstn GET [' . $tmp_data_key . '].');
            $tmp_data_value_alpha = self::$oCRNRSTN_DDO->preach('data_value', $tmp_data_key, $data_type_family, $data_authorization_profile, $index);

//            //
//            // IMPLEMENTATION OF SERIALIZED "NO MATCH" RETURN TO DEFINITIVELY INDICATE WHETHER
//            // OR NOT WE SHOULD CHECK THE DATA_KEY AGAINST CRNRSTN_RESOURCE_ALL.
//            if($tmp_data_value_alpha == $this->oCRNRSTN->session_salt()){
//
//                //
//                // WE NOW HAVE TO CHECK CRNRSTN_RESOURCE_ALL WITH THIS DATA KEY.
//                $tmp_return_data_spec_b = self::$oCRNRSTN_DDO->preach('data_value', $this->oCRNRSTN->hash_ddo_memory_pointer($data_key, $data_type_family, CRNRSTN_RESOURCE_ALL), $data_authorization_profile, $index);
//
//                if($tmp_return_data_spec_b != $this->oCRNRSTN->session_salt()){
//
//                    return $tmp_return_data_spec_b;
//
//                }
//
//                //
//                // WE COULD NOT FIND THE REQUESTED DATA KEY IN THE SYSTEM.
//                // HOOOSTON...VE HAF PROBLEM!
//                //throw new Exception('The requested data key, ' . $data_key . ', could not be found.');
//
//                return NULL;
//
//            }

            //
            // STILL NEED THIS FOR NULL OR EMPTY STRING VALUES THAT NEED TO BE SENT BACK.
            return $tmp_data_value_alpha;

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN NULL
            return NULL;

        }

    }

    public function retrieve_data_count($data_key, $data_type_family, $env_key){

        //$tmp_cnt = $this->get_resource_count($data_key, $data_type_family, $env_key);
        return $this->oCRNRSTN->get_config_cache_count($data_key, $data_type_family);

    }

    public function ____isset_data_key($data_key, $data_type_family, $env_key){
        //SEE if($this->oCRNRSTN->isset_resource('data_value', 'override_interact_theme_sprite_icon_mouseover_effect_magnification_zoom_percent', 'CRNRSTN::RESOURCE::SPRITE_ICON') == true){
        return self::$oCRNRSTN_DDO->preach('isset', $this->oCRNRSTN->hash_ddo_memory_pointer($data_key, $data_type_family, $env_key));

    }

    public function output_regression_stripe_ARRAY($result_str, $result_array, $output_format = 'array'){

        $tmp_ARRAY = array();
        $tmp_ARRAY['string'] = $this->oCRNRSTN->hash($result_str);
        $tmp_ARRAY['index_array'] = $result_array;

        if($output_format != 'array'){

            return $tmp_ARRAY['string'];

        }

        return $tmp_ARRAY;

    }

    public function __destruct(){

    }

}