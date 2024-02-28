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
#         AUTHOR :: Jonathan 'J5' Harris, CEO, CTO, Lead Full Stack Developer, jharris@eVifweb.com, J00000101@gmail.com.
#            URI :: http://crnrstn.evifweb.com/
#       OVERVIEW :: CRNRSTN :: An Open Source PHP Class Library that stands on top of a robust web services oriented
#                   architecture to both facilitate, augment, and enhance (with stability) the operations of a code base
#                   for a web application across multiple hosting environments.
#
#                   CRNRSTN :: is powered by eVifweb; CRNRSTN :: is powered by eCRM Strategy and Execution,
#                   Web Design & Development, and Only The Best Coffee.
#
#                   Copyright (c) 2012-2024 :: eVifweb development :: All Rights Reserved.
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
#                   Stand on top of the CRNRSTN :: SOAP Services Layer to, for example, organize and strengthen the
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

    public $oCRNRSTN;
    private static $config_serial;

    private static $oCRNRSTN_DDO;
    private static $oCRNRSTN_LINK_MGR;
    private static $oCRNRSTN_METHOD_MGR;
    private static $system_data_profile_constants_ARRAY = array();
    private static $system_profile_data_key_map_ARRAY = array();

    public $total_bytes_stored = 0;

    public function __construct($oCRNRSTN, $config_filepath, $CRNRSTN_config_salt, $file_mod_config_reset, $hash_algorithm = 'sha256'){

        $this->oCRNRSTN = $oCRNRSTN;

        //
        // CRNRSTN :: AUTOMATION OF SYSTEM CONFIGURATION SERIALIZATION.
        // Friday, December 8, 2023 @ 1147 hrs.
        self::$config_serial = $this->config_init_config_serialization($config_filepath, $CRNRSTN_config_salt, $file_mod_config_reset, $hash_algorithm);

        $this->oCRNRSTN->init_rrs_map_object($this->oCRNRSTN);

        $this->init_data_profile_constants();

        //
        // INSTANTIATE THE CRNRSTN :: METHOD DEFINITION,
        // META, AND BEHAVIOR MANAGER CLASS OBJECT.
        self::$oCRNRSTN_METHOD_MGR = new crnrstn_method_manager($this->oCRNRSTN);

        //
        // INSTANTIATE THE CRNRSTN :: LINK MANAGER CLASS OBJECT.
        //
        // Monday, November 13, 2023 @ 1816 hrs. and 20 secs.
        self::$oCRNRSTN_LINK_MGR = new crnrstn_link_manager($this->oCRNRSTN);
        self::$oCRNRSTN_DDO = new crnrstn_decoupled_data_object($this->oCRNRSTN, $this->oCRNRSTN->salt(100, '01'),'CRNRSTN_SYSTEM_SERIALIZED_DDO');

    }

    public function set_crnrstn($name, $value = NULL, $index_0 = NULL, $index_1 = NULL, $index_2 = NULL, $index_3 = NULL){

        switch($name){
            case 'system_channel_ARRAY':

                //
                // INITIALIZE CRNRSTN :: SYSTEM CHANNEL META ARRAY.
                self::$oCRNRSTN_DDO->set_crnrstn($name, $value);

            break;
            default:

                error_log(__LINE__ . ' ' . __METHOD__ . ' UNKNOWN SWITCH CASE RECEIVED [' . $name . '].');

            break;
        }

    }

    public function config_serial(){

        return self::$config_serial;

    }

    private function config_init_config_serialization($config_filepath, $CRNRSTN_config_salt, $file_mod_config_reset, $hash_algorithm){

        //
        // ROUTE CRNRSTN :: CONFIGURATION INITIALIZATION
        // THROUGH THE CRNRSTN :: SESSION MANAGER
        // CLASS OBJECT FOR OUR FIRST USE OF $_SESSION[]
        // BY CRNRSTN ::
        //
        // THIS METHOD WILL RETURN THE CONFIG_SERIAL AS
        // FINAL OUTPUT AND TAKING INTO CONSIDERATION
        // ALSO, $CRNRSTN_config_salt, THE OPTIONAL
        // SERIALIZATION SALT FOR THIS CONFIGURATION
        // OF CRNRSTN ::
        //
        // SEE, _crnrstn.config.inc.php.
        //
        // Saturday, December 9, 2023 @ 0252 hrs.
        return $this->oCRNRSTN->config_init_config_serialization($config_filepath, $CRNRSTN_config_salt, $file_mod_config_reset, $hash_algorithm);

    }

    public function set_channel_config($channel_constant, $attribute_name, $data){

        //
        // STANDARDIZE CHANNEL REFERENCE INPUT FOR
        // STRING CONCATENATION.
        //$tmp_channel_name = $this->oCRNRSTN->set_channel_config($channel_constant, 'NAME');

        error_log(__LINE__ . ' config mgr CHANNEL CONFIG HOOK UP ready. die();');
        error_log(__LINE__  . ' config mgr ' . __METHOD__ . ' die(); channel_constant[' . $channel_constant . ']. $attribute_name[' . strval($attribute_name) . ']. data[' . $data . '.');
        return self::$oCRNRSTN_DDO->set_channel_config($channel_constant, $attribute_name, $data);

    }

    public function authorized_channel_ids($channel_data, $output_format = CRNRSTN_INTEGER){

        return self::$oCRNRSTN_DDO->authorized_channel_ids($channel_data, $output_format);

    }

    public function get_channel_config($channel, $index_0, $index_1, $index_2, $index_3){

        return self::$oCRNRSTN_DDO->get_channel_config($channel, $index_0, $index_1, $index_2, $index_3);

    }

    public function isset_channel_config($channel_constant, $attribute_name, $return_type = CRNRSTN_BOOLEAN){
        // Thursday, November 23, 2023 @ 0031 hrs.

        error_log(__LINE__  . ' config mgr ' . __METHOD__ . ' die(); channel_constant[' . $channel_constant . ']. $attribute_name[' . strval($attribute_name) . ']. $return_type[' . $this->oCRNRSTN->data_type_filter($return_type, CRNRSTN_STRING) . '].');
        return false; //self::$oCRNRSTN_DDO->set_channel_config($channel_constant, $attribute_name, $return_type);

    }

    //
    // RETURNS STRING OR ARRAY DATA WITH DESIRED REPORTS.
    public function channel_report($channel_constant, $channel_report_queue, $return_data_type, $php_logo_height, $to_plaid, $is_HTML, $report_delimiter_TEXT, $report_delimiter_HTML){
        // WHERE, $channel_report_queue = array(CRNRSTN_CHANNEL_SOAP, CRNRSTN_CHANNEL_GET, CRNRSTN_CHANNEL_COOKIE);
        // WHERE, $channel_report_queue = CRNRSTN_CHANNEL_SOAP;

        return self::$oCRNRSTN_DDO->channel_report($channel_constant, $channel_report_queue, $return_data_type, $php_logo_height, $to_plaid, $is_HTML, $report_delimiter_TEXT, $report_delimiter_HTML);

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

    public function get_ddo_resource_pointer($ddo_memory_pointer, $data_key, $data_type_family, $index){

        return self::$oCRNRSTN_DDO->get_ddo_resource_pointer($ddo_memory_pointer, $data_key, $data_type_family, $index);

    }

    public function build_ddo_resource_pointer($data_key, $ddo_memory_pointer, $index, $channel, $ttl){

        return self::$oCRNRSTN_DDO->build_ddo_resource_pointer($data_key, $ddo_memory_pointer, $index, $channel, $ttl);

    }

    public function initialize_ddo_resource_pointer($ddo_memory_pointer, $data_key, $channel, $index, $ttl){

        self::$oCRNRSTN_DDO->initialize_ddo_resource_pointer($ddo_memory_pointer, $data_key, $channel, $index, $ttl);

    }

    public function consume_rrs_map($oCRNRSTN_RRS_MAP){

        $this->oCRNRSTN_RRS_MAP = $oCRNRSTN_RRS_MAP;

    }

    public function system_profile_return_count($profile_key){

        return count(self::$system_profile_data_key_map_ARRAY[$profile_key]);

    }

    public function system_profile_map_data_key($profile_key, $data_key){

        self::$system_profile_data_key_map_ARRAY[$profile_key][] = $data_key;

        return true;

    }

    public function system_profile_return_data_key($profile_key, $index = 0){

        return self::$system_profile_data_key_map_ARRAY[$profile_key][$index];

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

                    //
                    // RETURN THE INTEGER DATA TYPE REPRESENTATION
                    // OF THE PROVIDED AUTHORIZATION PROFILE.
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

            return self::$oCRNRSTN_DDO->preach('crnrstn_data_packet', $output_channel_constant[0], CRNRSTN_CHANNEL_FORM);

        }

        //
        // I SUSPECT THAT THIS WILL NO LONGER RUN DUE TO NEWER SERIALIZATION REQUIREMENTS
        return self::$oCRNRSTN_DDO->preach('crnrstn_data_packet', $output_channel_constant,CRNRSTN_CHANNEL_FORM);

    }

    public function retrieve_data_value($data_key, $data_type_family = 'CRNRSTN::RESOURCE', $index = NULL, $env_key = NULL, $data_authorization_profile = CRNRSTN_AUTHORIZE_RUNTIME){

        try{

            if(!isset($env_key)){

                $env_key = CRNRSTN_RESOURCE_ALL;

            }

            if(!isset($index)){

                $index = 0;

            }

            $tmp_data_value_alpha = self::$oCRNRSTN_DDO->preach('data_value', $data_key, $data_type_family, $data_authorization_profile, $index);

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

    public function php_ini_option_profile($name, $option_data = NULL, $iso_lang_code = 'en'){

        //
        // TODO :: KEEPING THIS AROUND FOR FUTURE UNIT TESTING DEVELOPEMENT.
        if(!isset($name)){

            $tmp_index = 0;
            $tmp_ini_all_ARRAY = ini_get_all();

            //
            // TODO :: LOADING THIS 360+ WILL CRASH THE PROCESS.
            foreach($tmp_ini_all_ARRAY as $index_ini => $tmp_ini_name){

                error_log(__LINE__ . ' crnrstn BUILDING PHP INI PROFILE $name[' . print_r($name, true) . '].');

                $tmp_ARRAY = $this->php_ini_option_profile($tmp_ini_name, NULL, $iso_lang_code);

                $tmp_php_ini_option_ARRAY[$tmp_index] = $tmp_ARRAY;
                $tmp_index++;
                error_log(__LINE__ . ' crnrstn ' . $this->oCRNRSTN->format_bytes($tmp_ARRAY, 3) . ' OF [' . strval($tmp_ini_name) . '] PHP INI PROFILE DATA LOADED INTO MEMORY. TOTAL INI LOADED=' . $tmp_index . '.');
                //DID WE MEMORY FULL CRASH YET?

            }

        }else{

            if(!isset($option_data)){

                $option_data = $this->oCRNRSTN->ini_get($name);
                $tmp_current_data_type_ARRAY = $this->oCRNRSTN->gettype($option_data, CRNRSTN_ARRAY);

            }else{

                if(isset($option_data['global_value'])){

                    $tmp_current_data_type_ARRAY = $this->oCRNRSTN->gettype($option_data['global_value'], CRNRSTN_ARRAY);

                }else{

                    if(isset($option_data['local_value'])){

                        $tmp_current_data_type_ARRAY = $this->oCRNRSTN->gettype($option_data['local_value'], CRNRSTN_ARRAY);

                    }else{

                        $tmp_current_data_type_ARRAY = $this->oCRNRSTN->gettype($option_data, CRNRSTN_ARRAY);

                    }

                }

            }

            $tmp_name_lower = trim(strtolower($name));

            switch($tmp_name_lower){
                case 'allow_url_fopen':
                    // TODO :: SEEKING PERFECTION? THERE ARE ARRAY STRUCTURE CHANGES THAT SHOULD
                    //         BE APPLIED TO ALL THE OTHER DATA. SEE, array('OPTION_CAUTION'...,
                    //         array('IS_DEACTIVATED'..., AND array('DEACTIVATED_PHP_VERSION'...
                    //
                    //         SUPPORT PHP.INI UGC INPUT VALIDATION WHERE:
                    //          - 'DATA_TYPE' => CRNRSTN_STRING & CRNRSTN_INTEGER
                    //          - 'DATA_TYPE' => CRNRSTN_BOOLEAN & CRNRSTN_INTEGER
                    //          - 'DATA_TYPE' => CRNRSTN_MIXED
                    //
                    // Thursday, November 16, 2023 @ 0121 hrs.
                    //allow_url_fopen                           "1"                                                 PHP_INI_SYSTEM

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/filesystem.configuration.php#ini.allow-url-fopen',
                        'https://www.php.net/manual/en/filesystem.configuration.php',
                        'https://www.php.net/manual/en/function.fopen',
                        'https://www.php.net/manual/en/features.remote-files.php',
                        'https://www.php.net/manual/en/ref.zlib.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"1"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),   // array('CRNRSTN_INTEGER' => CRNRSTN_BOOLEAN, 'CRNRSTN_STRING' => 'CRNRSTN_BOOLEAN', 'PHP_NATIVE' => 'boolean')
                            array('CHANGE_MODE'                 => 'PHP_INI_SYSTEM'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_CAUTION'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('IS_DEACTIVATED'              => '0'),                            // 1 = DEACTIVATED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEACTIVATED_PHP_VERSION'     => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'This option enables the URL-aware ' . $this->oCRNRSTN->return_crnrstn_text_link('fopen', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.fopen') . ' wrappers that enable accessing URL object like files. Default wrappers are provided for the access of ' . $this->oCRNRSTN->return_crnrstn_text_link('remote files', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/features.remote-files.php') . ' using the ftp or http protocol, some extensions like ' . $this->oCRNRSTN->return_crnrstn_text_link('zlib', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/ref.zlib.php') . ' may register additional wrappers.',
                                        'TEXT' => 'This option enables the URL-aware fopen wrappers that enable accessing URL object like files. Default wrappers are provided for the access of remote files using the ftp or http protocol, some extensions like zlib may register additional wrappers.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'allow_url_include':
                    //allow_url_include                         "0"                                                 PHP_INI_SYSTEM              Deprecated as of PHP 7.4.0.

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/filesystem.configuration.php#ini.allow-url-include',
                        'https://www.php.net/manual/en/filesystem.configuration.php',
                        'https://www.php.net/manual/en/function.include.php',
                        'https://www.php.net/manual/en/function.include-once.php',
                        'https://www.php.net/manual/en/function.require.php',
                        'https://www.php.net/manual/en/function.require-once.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_SYSTEM'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'This setting requires allow_url_fopen to be on.',
                                            'TEXT' => 'This setting requires allow_url_fopen to be on.'
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '1'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => '7.4.0'),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'Deprecated as of PHP 7.4.0.',
                                            'TEXT' => 'Deprecated as of PHP 7.4.0.'
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'This option allows the use of URL-aware fopen wrappers with the following functions: ' . $this->oCRNRSTN->return_crnrstn_text_link('include', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.include.php') . ', ' . $this->oCRNRSTN->return_crnrstn_text_link('include_once', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.include-once.php') . ', ' . $this->oCRNRSTN->return_crnrstn_text_link('require', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.require.php') . ', ' . $this->oCRNRSTN->return_crnrstn_text_link('require_once', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.require-once.php') . '.',
                                        'TEXT' => 'This option allows the use of URL-aware fopen wrappers with the following functions: include, include_once, require, require_once.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'arg_separator.input':
                    //arg_separator.input                       "&"                                                 PHP_INI_PERDIR

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ini.core.php#ini.arg-separator.input',
                        'https://www.php.net/manual/en/ini.core.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"&"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_PERDIR'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'Every character in this directive is considered as separator!',
                                            'TEXT' => 'Every character in this directive is considered as separator!'
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'List of separator(s) used by PHP to parse input URLs into variables.',
                                        'TEXT' => 'List of separator(s) used by PHP to parse input URLs into variables.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'arg_separator.output':
                    //arg_separator.output                      "&"                                                 PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ini.core.php#ini.arg-separator.output',
                        'https://www.php.net/manual/en/ini.core.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"&"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'The separator used in PHP generated URLs to separate arguments.',
                                        'TEXT' => 'The separator used in PHP generated URLs to separate arguments.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'assert.active':
                    //assert.active                             "1"                                                 PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/info.configuration.php#ini.assert.active',
                        'https://www.php.net/manual/en/info.configuration.php',
                        'https://www.php.net/manual/en/function.assert.php',
                        'https://www.php.net/manual/en/ini.core.php#ini.zend.assertions',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"1"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'This feature has been DEPRECATED as of PHP 8.3.0. Relying on this feature is highly discouraged.',
                                            'TEXT' => 'This feature has been DEPRECATED as of PHP 8.3.0. Relying on this feature is highly discouraged.'
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '1'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => '8.3.0'),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'This feature has been DEPRECATED as of PHP 8.3.0.',
                                            'TEXT' => 'This feature has been DEPRECATED as of PHP 8.3.0.'
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Enable ' . $this->oCRNRSTN->return_crnrstn_text_link('assert', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.assert.php') . ' evaluation. ' . $this->oCRNRSTN->return_crnrstn_text_link('zend.assertions', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/ini.core.php#ini.zend.assertions') . ' should be used instead to control the behaviour of ' . $this->oCRNRSTN->return_crnrstn_text_link('assert', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.assert.php') . '.',
                                        'TEXT' => 'Enable assert() evaluation. zend.assertions should be used instead to control the behaviour of assert().'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'assert.bail':
                    //assert.bail                               "0"                                                 PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/info.configuration.php#ini.assert.bail',
                        'https://www.php.net/manual/en/info.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'This feature has been DEPRECATED as of PHP 8.3.0. Relying on this feature is highly discouraged.',
                                            'TEXT' => 'This feature has been DEPRECATED as of PHP 8.3.0. Relying on this feature is highly discouraged.'
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '1'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => '8.3.0'),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'This feature has been DEPRECATED as of PHP 8.3.0.',
                                            'TEXT' => 'This feature has been DEPRECATED as of PHP 8.3.0.'
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Terminate script execution on failed assertions.',
                                        'TEXT' => 'Terminate script execution on failed assertions.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'assert.callback':
                    //assert.callback                           NULL                                                PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/info.configuration.php#ini.assert.callback',
                        'https://www.php.net/manual/en/info.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => 'NULL'),                         // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_NULL),                   // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'This feature has been DEPRECATED as of PHP 8.3.0. Relying on this feature is highly discouraged.',
                                            'TEXT' => 'This feature has been DEPRECATED as of PHP 8.3.0. Relying on this feature is highly discouraged.'
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '1'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => '8.3.0'),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'This feature has been DEPRECATED as of PHP 8.3.0.',
                                            'TEXT' => 'This feature has been DEPRECATED as of PHP 8.3.0.'
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'User function to call on failed assertions.',
                                        'TEXT' => 'User function to call on failed assertions.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'assert.exception':
                    //assert.exception                          "0"                                                 PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/info.configuration.php#ini.assert.exception',
                        'https://www.php.net/manual/en/info.configuration.php',
                        'https://www.php.net/manual/en/class.assertionerror.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'This feature has been DEPRECATED as of PHP 8.3.0. Relying on this feature is highly discouraged.',
                                            'TEXT' => 'This feature has been DEPRECATED as of PHP 8.3.0. Relying on this feature is highly discouraged.'
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '1'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => '8.3.0'),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'This feature has been DEPRECATED as of PHP 8.3.0.',
                                            'TEXT' => 'This feature has been DEPRECATED as of PHP 8.3.0.'
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Issue an ' . $this->oCRNRSTN->return_crnrstn_text_link('AssertionError', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/class.assertionerror.php') . ' exception for the failed assertion.',
                                        'TEXT' => 'Issue an AssertionError exception for the failed assertion.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'assert.quiet_eval':
                    //assert.quiet_eval                         "0"                                                 PHP_INI_ALL                 Removed as of PHP 8.0.0

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/info.configuration.php#ini.assert.quiet-eval',
                        'https://www.php.net/manual/en/info.configuration.php',
                        'https://www.php.net/manual/en/function.error-reporting.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'This feature was REMOVED as of PHP 8.0.0.',
                                            'TEXT' => 'This feature was REMOVED as of PHP 8.0.0.'
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '1'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => '8.0.0'),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'Removed as of PHP 8.0.0.',
                                            'TEXT' => 'Removed as of PHP 8.0.0.'
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Use the current setting of ' . $this->oCRNRSTN->return_crnrstn_text_link('error_reporting', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.error-reporting.php') . ' during assertion expression evaluation. If enabled, no errors are shown (implicit error_reporting(0)) while evaluation. If disabled, errors are shown according to the settings of ' . $this->oCRNRSTN->return_crnrstn_text_link('error_reporting', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.error-reporting.php') . '.',
                                        'TEXT' => 'Use the current setting of error_reporting() during assertion expression evaluation. If enabled, no errors are shown (implicit error_reporting(0)) while evaluation. If disabled, errors are shown according to the settings of error_reporting().'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'assert.warning':
                    //assert.warning                            "1"                                                 PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/info.configuration.php#ini.assert.warning',
                        'https://www.php.net/manual/en/info.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"1"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'This feature has been DEPRECATED as of PHP 8.3.0. Relying on this feature is highly discouraged.',
                                            'TEXT' => 'This feature has been DEPRECATED as of PHP 8.3.0. Relying on this feature is highly discouraged.'
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '1'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => '8.3.0'),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'This feature has been DEPRECATED as of PHP 8.3.0.',
                                            'TEXT' => 'This feature has been DEPRECATED as of PHP 8.3.0.'
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Issue a PHP warning for each failed assertion.',
                                        'TEXT' => 'Issue a PHP warning for each failed assertion.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'auto_append_file':
                    //auto_append_file                          NULL                                                PHP_INI_PERDIR

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ini.core.php#ini.auto-append-file',
                        'https://www.php.net/manual/en/ini.core.php',
                        'https://www.php.net/manual/en/function.exit.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => 'NULL'),                         // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_PERDIR'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'If the script is terminated with ' . $this->oCRNRSTN->return_crnrstn_text_link('exit', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.exit.php') . ', auto-append will not occur.',
                                            'TEXT' => 'If the script is terminated with exit(), auto-append will not occur.'
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Specifies the name of a file that is automatically parsed after the main file. The file is included as if it was called with the ' . $this->oCRNRSTN->return_crnrstn_text_link('require', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.require.php') . ' function, so ' . $this->oCRNRSTN->return_crnrstn_text_link('include_path', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/ini.core.php#ini.include-path') . ' is used.

The special value none disables auto-appending.',
                                        'TEXT' => 'Specifies the name of a file that is automatically parsed after the main file. The file is included as if it was called with the require function, so include_path is used.

The special value none disables auto-appending.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'auto_detect_line_endings':
                    //auto_detect_line_endings                  "0"                                                 PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/filesystem.configuration.php#ini.auto-detect-line-endings',
                        'https://www.php.net/manual/en/filesystem.configuration.php',
                        'https://www.php.net/manual/en/function.fgets.php',
                        'https://www.php.net/manual/en/function.file.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'When turned on, PHP will examine the data read by ' . $this->oCRNRSTN->return_crnrstn_text_link('fgets', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.fgets.php') . ' and ' . $this->oCRNRSTN->return_crnrstn_text_link('file', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.file.php') . ' to see if it is using Unix, MS-Dos or Macintosh line-ending conventions.

This enables PHP to interoperate with Macintosh systems, but defaults to Off, as there is a very small performance penalty when detecting the EOL conventions for the first line, and also because people using carriage-returns as item separators under Unix systems would experience non-backwards-compatible behaviour.',
                                        'TEXT' => 'When turned on, PHP will examine the data read by fgets() and file() to see if it is using Unix, MS-Dos or Macintosh line-ending conventions.

This enables PHP to interoperate with Macintosh systems, but defaults to Off, as there is a very small performance penalty when detecting the EOL conventions for the first line, and also because people using carriage-returns as item separators under Unix systems would experience non-backwards-compatible behaviour.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'auto_globals_jit':
                    //Thursday, November 9, 2023 @ 0425 hrs.
                    //auto_globals_jit                          "1"                                                 PHP_INI_PERDIR

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ini.core.php#ini.auto-globals-jit',
                        'https://www.php.net/manual/en/ini.core.php',
                        'https://www.php.net/manual/en/language.variables.variable.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"1"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_PERDIR'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'Usage of SERVER, REQUEST, and ENV variables is checked during the compile time so using them through e.g. ' . $this->oCRNRSTN->return_crnrstn_text_link('variable variables', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/language.variables.variable.php') . ' will not cause their initialization.',
                                            'TEXT' => 'Usage of SERVER, REQUEST, and ENV variables is checked during the compile time so using them through e.g. variable variables will not cause their initialization.'
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'When enabled, the SERVER, REQUEST, and ENV variables are created when they\'re first used (Just In Time) instead of when the script starts. If these variables are not used within a script, having this directive on will result in a performance gain.',
                                        'TEXT' => 'When enabled, the SERVER, REQUEST, and ENV variables are created when they\'re first used (Just In Time) instead of when the script starts. If these variables are not used within a script, having this directive on will result in a performance gain.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'auto_prepend_file':
                    //Thursday, November 9, 2023 @ 0427 hrs.
                    //auto_prepend_file                         NULL                                                PHP_INI_PERDIR

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ini.core.php#ini.auto-prepend-file',
                        'https://www.php.net/manual/en/ini.core.php',
                        'https://www.php.net/manual/en/function.require.php',
                        'https://www.php.net/manual/en/ini.core.php#ini.include-path',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => 'NULL'),                         // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_PERDIR'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Specifies the name of a file that is automatically parsed before the main file. The file is included as if it was called with the ' . $this->oCRNRSTN->return_crnrstn_text_link('require', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.require.php') . ' function, so ' . $this->oCRNRSTN->return_crnrstn_text_link('include_path', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/ini.core.php#ini.include-path') . ' is used.

The special value none disables auto-prepending.',
                                        'TEXT' => 'Specifies the name of a file that is automatically parsed before the main file. The file is included as if it was called with the require function, so include_path is used.

The special value none disables auto-prepending.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'bcmath.scale':
                    //Thursday, November 9, 2023 @ 0437 hrs.
                    //bcmath.scale                              "0"                                                 PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/bc.configuration.php#ini.bcmath.scale',
                        'https://www.php.net/manual/en/bc.configuration.php',
                        'https://www.php.net/manual/en/function.bcscale.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php',
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_INTEGER),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Number of decimal digits for all bcmath functions. See also ' . $this->oCRNRSTN->return_crnrstn_text_link('bcscale', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.bcscale.php') . '.',
                                        'TEXT' => 'Number of decimal digits for all bcmath functions. See also bcscale().'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'browscap':
                    //Thursday, November 9, 2023 @ 0453 hrs.
                    //browscap                                  NULL                                                PHP_INI_SYSTEM

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/misc.configuration.php#ini.browscap',
                        'https://www.php.net/manual/en/misc.configuration.php',
                        'https://www.php.net/manual/en/function.get-browser.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => 'NULL'),                         // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_SYSTEM'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Name (e.g.: browscap.ini) and location of browser capabilities file. See also ' . $this->oCRNRSTN->return_crnrstn_text_link('get_browser', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.get-browser.php') . '.',
                                        'TEXT' => 'Name (e.g.: browscap.ini) and location of browser capabilities file. See also get_browser().'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'cgi.check_shebang_line':
                    //Thursday, November 9, 2023 @ 0515 hrs. 55 secs.
                    //cgi.check_shebang_line                    "1"                                                 PHP_INI_SYSTEM

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ini.core.php#ini.cgi.check-shebang-line',
                        'https://www.php.net/manual/en/ini.core.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"1"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_SYSTEM'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Controls whether CGI PHP checks for line starting with #! (shebang) at the top of the running script. This line might be needed if the script support running both as stand-alone script and via PHP CGI. PHP in CGI mode skips this line and ignores its content if this directive is turned on.',
                                        'TEXT' => 'Controls whether CGI PHP checks for line starting with #! (shebang) at the top of the running script. This line might be needed if the script support running both as stand-alone script and via PHP CGI. PHP in CGI mode skips this line and ignores its content if this directive is turned on.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'cgi.discard_path':
                    //Thursday, November 9, 2023 @ 0536 hrs.
                    //cgi.discard_path                          "0"                                                 PHP_INI_SYSTEM

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ini.core.php#ini.cgi.discard-path',
                        'https://www.php.net/manual/en/ini.core.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_SYSTEM'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'If this is enabled, the PHP CGI binary can safely be placed outside of the web tree and people will not be able to circumvent .htaccess security.',
                                        'TEXT' => 'If this is enabled, the PHP CGI binary can safely be placed outside of the web tree and people will not be able to circumvent .htaccess security.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'cgi.fix_pathinfo':
                    //Thursday, November 9, 2023 @ 0536 hrs.
                    //cgi.fix_pathinfo                          "1"                                                 PHP_INI_SYSTEM

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ini.core.php#ini.cgi.fix-pathinfo',
                        'https://www.php.net/manual/en/ini.core.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"1"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_SYSTEM'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Provides real PATH_INFO/ PATH_TRANSLATED support for CGI. PHP\'s previous behaviour was to set PATH_TRANSLATED to SCRIPT_FILENAME, and to not grok what PATH_INFO is. For more information on PATH_INFO, see the CGI specs. Setting this to 1 will cause PHP CGI to fix its paths to conform to the spec. A setting of zero causes PHP to behave as before. It is turned on by default. You should fix your scripts to use SCRIPT_FILENAME rather than PATH_TRANSLATED.',
                                        'TEXT' => 'Provides real PATH_INFO/ PATH_TRANSLATED support for CGI. PHP\'s previous behaviour was to set PATH_TRANSLATED to SCRIPT_FILENAME, and to not grok what PATH_INFO is. For more information on PATH_INFO, see the CGI specs. Setting this to 1 will cause PHP CGI to fix its paths to conform to the spec. A setting of zero causes PHP to behave as before. It is turned on by default. You should fix your scripts to use SCRIPT_FILENAME rather than PATH_TRANSLATED.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'cgi.force_redirect':
                    //Thursday, November 9, 2023 @ 0542 hrs.
                    //cgi.force_redirect                        "1"                                                 PHP_INI_SYSTEM

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ini.core.php#ini.cgi.force-redirect',
                        'https://www.php.net/manual/en/ini.core.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"1"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_SYSTEM'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'Windows Users: When using IIS this option must be turned off. For OmniHTTPD or Xitami the same applies.',
                                            'TEXT' => 'Windows Users: When using IIS this option must be turned off. For OmniHTTPD or Xitami the same applies.'
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'cgi.force_redirect is necessary to provide security running PHP as a CGI under most web servers. Left undefined, PHP turns this on by default. You can turn it off at your own risk.',
                                        'TEXT' => 'cgi.force_redirect is necessary to provide security running PHP as a CGI under most web servers. Left undefined, PHP turns this on by default. You can turn it off at your own risk.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'cgi.nph':
                    //Thursday, November 9, 2023 @ 0550 hrs.
                    //cgi.nph                                   "0"                                                 PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ini.core.php#ini.cgi.nph',
                        'https://www.php.net/manual/en/ini.core.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'If cgi.nph is enabled it will force cgi to always sent Status: 200 with every request.',
                                        'TEXT' => 'If cgi.nph is enabled it will force cgi to always sent Status: 200 with every request.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'cgi.redirect_status_env':
                    //Thursday, November 9, 2023 @ 0559 hrs. 59 secs.
                    //cgi.redirect_status_env                   NULL                                                PHP_INI_SYSTEM

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ini.core.php#ini.cgi.redirect-status-env',
                        'https://www.php.net/manual/en/ini.core.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => 'NULL'),                         // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_SYSTEM'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'Setting this variable may cause security issues, know what you are doing first.',
                                            'TEXT' => 'Setting this variable may cause security issues, know what you are doing first.'
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'If cgi.force_redirect is turned on, and you are not running under Apache or Netscape (iPlanet) web servers, you may need to set an environment variable name that PHP will look for to know it is OK to continue execution.',
                                        'TEXT' => 'If cgi.force_redirect is turned on, and you are not running under Apache or Netscape (iPlanet) web servers, you may need to set an environment variable name that PHP will look for to know it is OK to continue execution.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'cgi.rfc2616_headers':
                    //Thursday, November 9, 2023 @ 0715 hrs.
                    //cgi.rfc2616_headers                       "0"                                                 PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ini.core.php#ini.cgi.rfc2616-headers',
                        'https://www.php.net/manual/en/ini.core.php',
                        'http://www.faqs.org/rfcs/rfc3875',
                        'http://www.faqs.org/rfcs/rfc2616',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_INTEGER),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Tells PHP what type of headers to use when sending HTTP response code. If it\'s set to 0, PHP sends a ' . $this->oCRNRSTN->return_crnrstn_text_link('»&nbsp;RFC 3875', 'INTERNET_FAQS_ARCHIVE_LOGO', 'http://www.faqs.org/rfcs/rfc3875') . ' &quot;Status:&quot; header that is supported by Apache and other web servers. When this option is set to 1, PHP will send ' . $this->oCRNRSTN->return_crnrstn_text_link('»&nbsp;RFC 2616', 'INTERNET_FAQS_ARCHIVE_LOGO', 'http://www.faqs.org/rfcs/rfc2616') . ' compliant headers.

If this option is enabled, and you are running PHP in a CGI environment (e.g. PHP-FPM) you should not use standard RFC 2616 style HTTP status response headers, you should instead use their RFC 3875 equivalent e.g. instead of header(&quot;HTTP/1.0 404 Not found&quot;); you should use header(&quot;Status: 404 Not Found&quot;);

Leave it set to 0 unless you know what you\'re doing.',
                                        'TEXT' => 'Tells PHP what type of headers to use when sending HTTP response code. If it\'s set to 0, PHP sends a » RFC 3875 "Status:" header that is supported by Apache and other web servers. When this option is set to 1, PHP will send » RFC 2616 compliant headers.

If this option is enabled, and you are running PHP in a CGI environment (e.g. PHP-FPM) you should not use standard RFC 2616 style HTTP status response headers, you should instead use their RFC 3875 equivalent e.g. instead of header("HTTP/1.0 404 Not found"); you should use header("Status: 404 Not Found");

Leave it set to 0 unless you know what you\'re doing.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'child_terminate':
                    //Thursday, November 9, 2023 @ 0717 hrs.
                    //child_terminate                           "0"                                                 PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/apache.configuration.php#ini.child-terminate',
                        'https://www.php.net/manual/en/apache.configuration.php',
                        'https://www.php.net/manual/en/function.apache-child-terminate.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Specify whether PHP scripts may request child process termination on end of request, see also ' . $this->oCRNRSTN->return_crnrstn_text_link('apache_child_terminate', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.apache-child-terminate.php') . '.',
                                        'TEXT' => 'Specify whether PHP scripts may request child process termination on end of request, see also apache_child_terminate().'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'cli.pager':
                    //Thursday, November 9, 2023 @ 0721 hrs.
                    //cli.pager                                 ""                                                  PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/readline.configuration.php#ini.cli.pager',
                        'https://www.php.net/manual/en/readline.configuration.php',
                        'https://www.php.net/manual/en/features.commandline.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '""'),                           // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'External tool to display output from ' . $this->oCRNRSTN->return_crnrstn_text_link('command line', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/features.commandline.php') . '.',
                                        'TEXT' => 'External tool to display output from command line.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'cli.prompt':
                    //cli.prompt                                "\\b \\> "                                          PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/readline.configuration.php#ini.cli.prompt',
                        'https://www.php.net/manual/en/readline.configuration.php',
                        'https://www.php.net/manual/en/features.commandline.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"\\b \\> "'),                   // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => $this->oCRNRSTN->return_crnrstn_text_link('Command line', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/features.commandline.php') . ' prompt.',
                                        'TEXT' => 'Command line prompt.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'cli_server.color':
                    //Thursday, November 9, 2023 0730 hrs.
                    //cli_server.color                          "0"                                                 PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/features.commandline.ini.php#ini.cli-server.color',
                        'https://www.php.net/manual/en/features.commandline.ini.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Enable the built-in development web server to use ANSI color coding in terminal output.',
                                        'TEXT' => 'Enable the built-in development web server to use ANSI color coding in terminal output.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'com.allow_dcom':
                    //Thursday, November 9, 2023 @ 0745 hrs.
                    //com.allow_dcom                            "0"                                                 PHP_INI_SYSTEM

                    error_log(__LINE__ . ' crnrstn PHP INI[' . $name . '] HAS UNCONFIRMED META "0" DATA TYPE. AM I CRNRSTN_BOOLEAN[' . print_r($tmp_current_data_type_ARRAY, true) . ']?');

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/com.configuration.php#ini.com.allow-dcom',
                        'https://www.php.net/manual/en/com.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_SYSTEM'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'When this is turned on, PHP will be allowed to operate as a D-COM (Distributed COM) client and will allow the PHP script to instantiate COM objects on a remote server.',
                                        'TEXT' => 'When this is turned on, PHP will be allowed to operate as a D-COM (Distributed COM) client and will allow the PHP script to instantiate COM objects on a remote server.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'com.autoregister_typelib':
                    //Thursday, November 9, 2023 0805 hrs.
                    //com.autoregister_typelib                  "0"                                                 PHP_INI_ALL

                    error_log(__LINE__ . ' crnrstn PHP INI[' . $name . '] HAS UNCONFIRMED META "0" DATA TYPE. AM I CRNRSTN_BOOLEAN[' . print_r($tmp_current_data_type_ARRAY, true) . ']?');

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/com.configuration.php#ini.com.autoregister-typelib',
                        'https://www.php.net/manual/en/com.configuration.php',
                        'https://www.php.net/manual/en/class.com.php',
                        'https://www.php.net/manual/en/com.configuration.php#ini.com.autoregister-casesensitive',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'When this is turned on, PHP will attempt to register constants from the typelibrary of ' . $this->oCRNRSTN->return_crnrstn_text_link('COM', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/class.com.php') . ' objects that it instantiates, if those objects implement the interfaces required to obtain that information. The case sensitivity of the constants it registers is controlled by the ' . $this->oCRNRSTN->return_crnrstn_text_link('com.autoregister_casesensitive', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/com.configuration.php#ini.com.autoregister-typelib') . ' php.ini directive.',
                                        'TEXT' => 'When this is turned on, PHP will attempt to register constants from the typelibrary of COM objects that it instantiates, if those objects implement the interfaces required to obtain that information. The case sensitivity of the constants it registers is controlled by the com.autoregister_casesensitive php.ini directive.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'com.autoregister_verbose':
                    //Thursday, November 9, 2023 0811 hrs.
                    //com.autoregister_verbose                  "0"                                                 PHP_INI_ALL

                    error_log(__LINE__ . ' crnrstn PHP INI[' . $name . '] HAS UNCONFIRMED META "0" DATA TYPE. AM I CRNRSTN_BOOLEAN[' . print_r($tmp_current_data_type_ARRAY, true) . ']?');

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/com.configuration.php#ini.com.autoregister-verbose',
                        'https://www.php.net/manual/en/com.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'When this is turned on, any problems with loading a typelibrary during object instantiation will be reported using the PHP error mechanism. The default is off, which does not emit any indication if there was an error finding or loading the type library.',
                                        'TEXT' => 'When this is turned on, any problems with loading a typelibrary during object instantiation will be reported using the PHP error mechanism. The default is off, which does not emit any indication if there was an error finding or loading the type library.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'com.autoregister_casesensitive':
                    //Thursday, November 9, 2023 0851 hrs.
                    //com.autoregister_casesensitive            "1"                                                 PHP_INI_ALL

                    error_log(__LINE__ . ' crnrstn PHP INI[' . $name . '] HAS UNCONFIRMED META "0" DATA TYPE. AM I CRNRSTN_BOOLEAN[' . print_r($tmp_current_data_type_ARRAY, true) . ']?');

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/com.configuration.php#ini.com.autoregister-casesensitive',
                        'https://www.php.net/manual/en/com.configuration.php',
                        'https://www.php.net/manual/en/class.com.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"1"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'When this is turned on (the default), constants found in auto-loaded type libraries when instatiating ' . $this->oCRNRSTN->return_crnrstn_text_link('COM', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/class.com.php') . ' objects will be registered case sensitively. See ' . $this->oCRNRSTN->return_crnrstn_text_link('com_load_typelib', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.error-reporting.php') . ' for more details.',
                                        'TEXT' => 'When this is turned on (the default), constants found in auto-loaded type libraries when instatiating COM objects will be registered case sensitively. See com_load_typelib() for more details.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'com.code_page':
                    //Thursday, November 9, 2023 0851 hrs.
                    //com.code_page                             ""                                                  PHP_INI_ALL

                    error_log(__LINE__ . ' crnrstn PHP INI[' . $name . '] HAS UNCONFIRMED META "0" DATA TYPE. AM I CRNRSTN_STRING[' . print_r($tmp_current_data_type_ARRAY, true) . ']?');

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/com.configuration.php#ini.com.code-page',
                        'https://www.php.net/manual/en/com.configuration.php',
                        'https://www.php.net/manual/en/class.com.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '""'),                           // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'It controls the default character set code-page to use when passing strings to and from COM objects. If set to an empty string, PHP will assume that you want <strong>CP_ACP</strong>, which is the default system ANSI code page.

If the text in your scripts is encoded using a different encoding/character set by default, setting this directive will save you from having to pass the code page as a parameter to the com class constructor. Please note that by using this directive (as with any PHP configuration directive), your PHP script becomes less portable; you should use the ' . $this->oCRNRSTN->return_crnrstn_text_link('COM', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/com.configuration.php#ini.com.code-page') . ' constructor parameter whenever possible.',
                                        'TEXT' => 'It controls the default character set code-page to use when passing strings to and from COM objects. If set to an empty string, PHP will assume that you want CP_ACP, which is the default system ANSI code page.

If the text in your scripts is encoded using a different encoding/character set by default, setting this directive will save you from having to pass the code page as a parameter to the com class constructor. Please note that by using this directive (as with any PHP configuration directive), your PHP script becomes less portable; you should use the COM constructor parameter whenever possible.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'com.dotnet_version':
                    //Thursday, November 9, 2023 0852 hrs.
                    //com.dotnet_version                        ""                                                  PHP_INI_SYSTEM              As of PHP 8.0.0

                    error_log(__LINE__ . ' crnrstn PHP INI[' . $name . '] HAS UNCONFIRMED META "0" DATA TYPE. AM I CRNRSTN_STRING[' . print_r($tmp_current_data_type_ARRAY, true) . ']?');

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/com.configuration.php#ini.com.dotnet-version',
                        'https://www.php.net/manual/en/com.configuration.php',
                        'https://www.php.net/manual/en/class.dotnet.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '""'),                           // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_SYSTEM'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => '8.0.0'),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'As of PHP 8.0.0.',
                                            'TEXT' => 'As of PHP 8.0.0.'
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'The version of the .NET framework to use for ' . $this->oCRNRSTN->return_crnrstn_text_link('dotnet', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/class.dotnet.php') . ' objects. The value of the setting is the first three parts of the framework\'s version number, separated by dots, and prefixed with v, e.g. v4.0.30319.',
                                        'TEXT' => 'The version of the .NET framework to use for dotnet objects. The value of the setting is the first three parts of the framework\'s version number, separated by dots, and prefixed with v, e.g. v4.0.30319.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'com.typelib_file':
                    //Thursday, November 9, 2023 0906 hrs.
                    //com.typelib_file                          ""                                                  PHP_INI_SYSTEM

                    error_log(__LINE__ . ' crnrstn PHP INI[' . $name . '] HAS UNCONFIRMED META "0" DATA TYPE. AM I CRNRSTN_STRING[' . print_r($tmp_current_data_type_ARRAY, true) . ']?');

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/com.configuration.php#ini.com.typelib-file',
                        'https://www.php.net/manual/en/com.configuration.php',
                        'https://www.php.net/manual/en/function.com-load-typelib.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '""'),                           // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'When set, this should hold the path to a file that contains a list of typelibraries that should be loaded on startup. Each line of the file will be treated as the type library name and loaded as though you had called ' . $this->oCRNRSTN->return_crnrstn_text_link('com_load_typelib', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.com-load-typelib.php') . '. The constants will be registered persistently, so that the library only needs to be loaded once. If a type library name ends with the string #cis or #case_insensitive, then the constants from that library will be registered case insensitively.',
                                        'TEXT' => 'When set, this should hold the path to a file that contains a list of typelibraries that should be loaded on startup. Each line of the file will be treated as the type library name and loaded as though you had called com_load_typelib(). The constants will be registered persistently, so that the library only needs to be loaded once. If a type library name ends with the string #cis or #case_insensitive, then the constants from that library will be registered case insensitively.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'curl.cainfo':
                    //Thursday, November 9, 2023 0907 hrs.
                    //curl.cainfo                               NULL                                                PHP_INI_SYSTEM

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/curl.configuration.php#ini.curl.cainfo',
                        'https://www.php.net/manual/en/curl.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => 'NULL'),                         // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_SYSTEM'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'A default value for the CURLOPT_CAINFO option. This is required to be an absolute path.',
                                        'TEXT' => 'A default value for the CURLOPT_CAINFO option. This is required to be an absolute path.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'date.default_latitude':
                    //Thursday, November 9, 2023 0913 hrs.
                    //date.default_latitude                     "31.7667"                                           PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/datetime.configuration.php#ini.date.default-latitude',
                        'https://www.php.net/manual/en/datetime.configuration.php',
                        'https://www.php.net/manual/en/datetime.configuration.php#ini.date.default-longitude',
                        'https://www.php.net/manual/en/datetime.configuration.php#ini.date.sunrise-zenith',
                        'https://www.php.net/manual/en/datetime.configuration.php#ini.date.sunset-zenith',
                        'https://www.php.net/manual/en/function.date-sunrise.php',
                        'https://www.php.net/manual/en/function.date-sunset.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"31.7667"'),                    // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_FLOAT),                  // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'The first four configuration options [' . $this->oCRNRSTN->return_crnrstn_text_link('date.default_latitude', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/datetime.configuration.php#ini.date.default-latitude') . ', ' . $this->oCRNRSTN->return_crnrstn_text_link('date.default_longitude', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/datetime.configuration.php#ini.date.default-longitude') . ', ' . $this->oCRNRSTN->return_crnrstn_text_link('date.sunrise_zenith', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/datetime.configuration.php#ini.date.sunrise-zenith') . ', ' . $this->oCRNRSTN->return_crnrstn_text_link('date.sunset_zenith', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/datetime.configuration.php#ini.date.sunset-zenith') . '] are currently only used by ' . $this->oCRNRSTN->return_crnrstn_text_link('date_sunrise', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.date-sunrise.php') . ' and ' . $this->oCRNRSTN->return_crnrstn_text_link('date_sunset', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.date-sunset.php') . '.',
                                            'TEXT' => 'The first four configuration options [date.default_latitude, date.default_longitude, date.sunrise_zenith, date.sunset_zenith] are currently only used by date_sunrise() and date_sunset().'
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'The default latitude ranging from 0 at the equator, to +90 northward, and -90 southward.',
                                        'TEXT' => 'The default latitude ranging from 0 at the equator, to +90 northward, and -90 southward.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'date.default_longitude':
                    //Thursday, November 9, 2023 @ 0918 hrs.
                    //date.default_longitude                    "35.2333"                                           PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/datetime.configuration.php#ini.date.default-longitude',
                        'https://www.php.net/manual/en/datetime.configuration.php',
                        'https://www.php.net/manual/en/datetime.configuration.php#ini.date.default-latitude',
                        'https://www.php.net/manual/en/datetime.configuration.php#ini.date.sunrise-zenith',
                        'https://www.php.net/manual/en/datetime.configuration.php#ini.date.sunset-zenith',
                        'https://www.php.net/manual/en/function.date-sunrise.php',
                        'https://www.php.net/manual/en/function.date-sunset.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"35.2333"'),                    // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_FLOAT),                  // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'The first four configuration options [' . $this->oCRNRSTN->return_crnrstn_text_link('date.default_latitude', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/datetime.configuration.php#ini.date.default-latitude') . ', ' . $this->oCRNRSTN->return_crnrstn_text_link('date.default_longitude', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/datetime.configuration.php#ini.date.default-longitude') . ', ' . $this->oCRNRSTN->return_crnrstn_text_link('date.sunrise_zenith', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/datetime.configuration.php#ini.date.sunrise-zenith') . ', ' . $this->oCRNRSTN->return_crnrstn_text_link('date.sunset_zenith', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/datetime.configuration.php#ini.date.sunset-zenith') . '] are currently only used by ' . $this->oCRNRSTN->return_crnrstn_text_link('date_sunrise', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.date-sunrise.php') . ' and ' . $this->oCRNRSTN->return_crnrstn_text_link('date_sunset', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.date-sunset.php') . '.',
                                            'TEXT' => 'The first four configuration options [date.default_latitude, date.default_longitude, date.sunrise_zenith, date.sunset_zenith] are currently only used by date_sunrise() and date_sunset().'
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'The default longitude ranging from 0 at the prime meridian to +180 eastward and −180 westward.',
                                        'TEXT' => 'The default longitude ranging from 0 at the prime meridian to +180 eastward and −180 westward.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'date.sunrise_zenith':
                    //Thursday, November 9, 2023 @ 0934 hrs.
                    //date.sunrise_zenith                       "90.833333"                                         PHP_INI_ALL                 Prior to PHP 8.0.0, the default was "90.583333"

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/datetime.configuration.php#ini.date.sunrise-zenith',
                        'https://www.php.net/manual/en/datetime.configuration.php',
                        'https://www.php.net/manual/en/datetime.configuration.php#ini.date.default-latitude',
                        'https://www.php.net/manual/en/datetime.configuration.php#ini.date.default-longitude',
                        'https://www.php.net/manual/en/datetime.configuration.php#ini.date.sunset-zenith',
                        'https://www.php.net/manual/en/function.date-sunrise.php',
                        'https://www.php.net/manual/en/function.date-sunset.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_FLOAT),                  // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'The first four configuration options [' . $this->oCRNRSTN->return_crnrstn_text_link('date.default_latitude', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/datetime.configuration.php#ini.date.default-latitude') . ', ' . $this->oCRNRSTN->return_crnrstn_text_link('date.default_longitude', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/datetime.configuration.php#ini.date.default-longitude') . ', ' . $this->oCRNRSTN->return_crnrstn_text_link('date.sunrise_zenith', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/datetime.configuration.php#ini.date.sunrise-zenith') . ', ' . $this->oCRNRSTN->return_crnrstn_text_link('date.sunset_zenith', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/datetime.configuration.php#ini.date.sunset-zenith') . '] are currently only used by ' . $this->oCRNRSTN->return_crnrstn_text_link('date_sunrise', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.date-sunrise.php') . ' and ' . $this->oCRNRSTN->return_crnrstn_text_link('date_sunset', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.date-sunset.php') . '.',
                                            'TEXT' => 'The first four configuration options [date.default_latitude, date.default_longitude, date.sunrise_zenith, date.sunset_zenith] are currently only used by date_sunrise() and date_sunset().'
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'HTML' => 'Prior to PHP 8.0.0, the default was &quot;90.583333&quot;',
                                    'TEXT' => 'Prior to PHP 8.0.0, the default was "90.583333"'
                                ))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'The default sunrise zenith.

The default value is 90°50\'. The additional 50\' is due to two components: the Sun\'s radius, which is 16\', and the atmospheric refraction, which is 34\'.',
                                        'TEXT' => 'The default sunrise zenith.

The default value is 90°50\'. The additional 50\' is due to two components: the Sun\'s radius, which is 16\', and the atmospheric refraction, which is 34\'.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'date.sunset_zenith':
                    //Thursday, November 9, 2023 @ 0935 hrs.
                    //date.sunset_zenith                        "90.833333"                                         PHP_INI_ALL                 Prior to PHP 8.0.0, the default was "90.583333"

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/datetime.configuration.php#ini.date.sunset-zenith',
                        'https://www.php.net/manual/en/datetime.configuration.php',
                        'https://www.php.net/manual/en/datetime.configuration.php#ini.date.default-latitude',
                        'https://www.php.net/manual/en/datetime.configuration.php#ini.date.default-longitude',
                        'https://www.php.net/manual/en/datetime.configuration.php#ini.date.sunrise-zenith',
                        'https://www.php.net/manual/en/function.date-sunrise.php',
                        'https://www.php.net/manual/en/function.date-sunset.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"90.833333"'),                  // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_FLOAT),                  // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'The first four configuration options [' . $this->oCRNRSTN->return_crnrstn_text_link('date.default_latitude', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/datetime.configuration.php#ini.date.default-latitude') . ', ' . $this->oCRNRSTN->return_crnrstn_text_link('date.default_longitude', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/datetime.configuration.php#ini.date.default-longitude') . ', ' . $this->oCRNRSTN->return_crnrstn_text_link('date.sunrise_zenith', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/datetime.configuration.php#ini.date.sunrise-zenith') . ', ' . $this->oCRNRSTN->return_crnrstn_text_link('date.sunset_zenith', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/datetime.configuration.php#ini.date.sunset-zenith') . '] are currently only used by ' . $this->oCRNRSTN->return_crnrstn_text_link('date_sunrise', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.date-sunrise.php') . ' and ' . $this->oCRNRSTN->return_crnrstn_text_link('date_sunset', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.date-sunset.php') . '.',
                                            'TEXT' => 'The first four configuration options [date.default_latitude, date.default_longitude, date.sunrise_zenith, date.sunset_zenith] are currently only used by date_sunrise() and date_sunset().'
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'Prior to PHP 8.0.0, the default was &quot;90.583333.&quot;',
                                            'TEXT' => 'Prior to PHP 8.0.0, the default was "90.583333."'
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'The default sunset zenith.',
                                        'TEXT' => 'The default sunset zenith.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'date.timezone':
                    //Thursday, November 9, 2023 @ 0940 hrs.
                    //date.timezone                             "UTC"                                               PHP_INI_ALL                 From PHP 8.2, a warning is emitted when setting this to an invalid value or an empty string.

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/datetime.configuration.php#ini.date.timezone',
                        'https://www.php.net/manual/en/datetime.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"UTC"'),                        // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'From PHP 8.2, a warning is emitted when setting this to an invalid value or an empty string.',
                                            'TEXT' => 'From PHP 8.2, a warning is emitted when setting this to an invalid value or an empty string.'
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'From PHP 8.2, a warning is emitted when setting this to an invalid value or an empty string.',
                                            'TEXT' => 'From PHP 8.2, a warning is emitted when setting this to an invalid value or an empty string.'
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'The default timezone used by all date/time functions. The precedence order for which timezone is used if none is explicitly mentioned is described in the ' . $this->oCRNRSTN->return_crnrstn_text_link('date_default_timezone_get', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.date-default-timezone-get.php') . ' page. See ' . $this->oCRNRSTN->return_crnrstn_text_link('List of Supported Timezones', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/timezones.php') . ' for a list of supported timezones.',
                                        'TEXT' => 'The default timezone used by all date/time functions. The precedence order for which timezone is used if none is explicitly mentioned is described in the date_default_timezone_get() page. See List of Supported Timezones for a list of supported timezones.'
                                    ))),

                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'dba.default_handler':
                    //Thursday, November 9, 2023 @ 0949 hrs.
                    //dba.default_handler                       DBA_DEFAULT                                         PHP_INI_ALL

                    error_log(__LINE__ . ' crnrstn PHP INI[' . $name . '] HAS UNCONFIRMED META "0" DATA TYPE. AM I CRNRSTN_BOOLEAN[' . print_r($tmp_current_data_type_ARRAY, true) . ']?');

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/dba.configuration.php#ini.dba.default_handler',
                        'https://www.php.net/manual/en/dba.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => 'DBA_DEFAULT'),                  // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'The name of the default handler.',
                                        'TEXT' => 'The name of the default handler.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'default_charset':
                    //Thursday, November 9, 2023 @ 1010 hrs.
                    //default_charset                           "UTF-8"                                             PHP_INI_ALL                 Default to "UTF-8".

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ini.core.php#ini.default-charset',
                        'https://www.php.net/manual/en/ini.core.php',
                        'https://www.php.net/manual/en/function.htmlentities.php',
                        'https://www.php.net/manual/en/function.html-entity-decode.php',
                        'https://www.php.net/manual/en/function.htmlspecialchars.php',
                        'https://www.php.net/manual/en/book.iconv.php',
                        'https://www.php.net/manual/en/iconv.configuration.php#ini.iconv.input-encoding',
                        'https://www.php.net/manual/en/iconv.configuration.php#ini.iconv.output-encoding',
                        'https://www.php.net/manual/en/iconv.configuration.php#ini.iconv.internal-encoding',
                        'https://www.php.net/manual/en/book.mbstring.php',
                        'https://www.php.net/manual/en/mbstring.configuration.php#ini.mbstring.http-input',
                        'https://www.php.net/manual/en/mbstring.configuration.php#ini.mbstring.http-output',
                        'https://www.php.net/manual/en/mbstring.configuration.php#ini.mbstring.internal-encoding',
                        'https://www.php.net/manual/en/function.header.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"UTF-8"'),                      // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'Default to &quot;UTF-8&quot;.',
                                            'TEXT' => 'Default to "UTF-8".'
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'Default to &quot;UTF-8&quot;.',
                                            'TEXT' => 'Default to "UTF-8".'
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => '&quot;UTF-8&quot; is the default value and its value is used as the default character encoding for ' . $this->oCRNRSTN->return_crnrstn_text_link('htmlentities', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.htmlentities.php') . ', ' . $this->oCRNRSTN->return_crnrstn_text_link('html_entity_decode', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.html-entity-decode.php') . ' and ' . $this->oCRNRSTN->return_crnrstn_text_link('htmlspecialchars', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.htmlspecialchars.php') . ' if the encoding parameter is omitted. The value of default_charset will also be used to set the default character set for ' . $this->oCRNRSTN->return_crnrstn_text_link('iconv', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/book.iconv.php') . ' functions if the ' . $this->oCRNRSTN->return_crnrstn_text_link('iconv.input_encoding', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/iconv.configuration.php#ini.iconv.input-encoding') . ', ' . $this->oCRNRSTN->return_crnrstn_text_link('iconv.output_encoding', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/iconv.configuration.php#ini.iconv.output-encoding') . ' and ' . $this->oCRNRSTN->return_crnrstn_text_link('iconv.internal_encoding', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/iconv.configuration.php#ini.iconv.internal-encoding') . ' configuration options are unset, and for ' . $this->oCRNRSTN->return_crnrstn_text_link('mbstring', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/book.mbstring.php') . ' functions if the ' . $this->oCRNRSTN->return_crnrstn_text_link('mbstring.http_input', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/mbstring.configuration.php#ini.mbstring.http-input') . ' ' . $this->oCRNRSTN->return_crnrstn_text_link('mbstring.http_output', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/mbstring.configuration.php#ini.mbstring.http-output') . ' ' . $this->oCRNRSTN->return_crnrstn_text_link('mbstring.internal_encoding', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/mbstring.configuration.php#ini.mbstring.internal-encoding') . ' configuration option is unset.

All versions of PHP will use this value as the charset within the default Content-Type header sent by PHP if the header isn\'t overridden by a call to ' . $this->oCRNRSTN->return_crnrstn_text_link('header', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.header.php') . '.

Setting default_charset to an empty value is not recommended.',
                                        'TEXT' => '"UTF-8" is the default value and its value is used as the default character encoding for htmlentities(), html_entity_decode() and htmlspecialchars() if the encoding parameter is omitted. The value of default_charset will also be used to set the default character set for iconv functions if the iconv.input_encoding, iconv.output_encoding and iconv.internal_encoding configuration options are unset, and for mbstring functions if the mbstring.http_input mbstring.http_output mbstring.internal_encoding configuration option is unset.

All versions of PHP will use this value as the charset within the default Content-Type header sent by PHP if the header isn\'t overridden by a call to header().

Setting default_charset to an empty value is not recommended.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'input_encoding':
                    //Thursday, November 9, 2023 @ 1015 hrs.
                    //input_encoding                            ""                                                  PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ini.core.php#ini.input-encoding',
                        'https://www.php.net/manual/en/ini.core.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php',
                        'https://www.php.net/manual/en/ini.core.php#ini.input-encoding',
                        'https://www.php.net/manual/en/ini.core.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '""'),                           // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'This setting is used for multibyte modules such as mbstring and iconv. Default is empty.',
                                        'TEXT' => 'This setting is used for multibyte modules such as mbstring and iconv. Default is empty.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'output_encoding':
                    //Thursday, November 9, 2023 @ 1017 hrs.
                    //output_encoding                           ""                                                  PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ini.core.php#ini.output-encoding',
                        'https://www.php.net/manual/en/ini.core.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '""'),                           // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'This setting is used for multibyte modules such as mbstring and iconv. Default is empty.',
                                        'TEXT' => 'This setting is used for multibyte modules such as mbstring and iconv. Default is empty.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'internal_encoding':
                    //Thursday, November 9, 2023 @ 1021 hrs.
                    //internal_encoding                         ""                                                  PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ini.core.php#ini.internal-encoding',
                        'https://www.php.net/manual/en/ini.core.php',
                        'https://www.php.net/manual/en/ini.core.php#ini.default-charset',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '""'),                           // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'This setting is used for multibyte modules such as mbstring and iconv. Default is empty. If empty, ' . $this->oCRNRSTN->return_crnrstn_text_link('default_charset', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/ini.core.php#ini.default-charset') . ' is used.',
                                        'TEXT' => 'This setting is used for multibyte modules such as mbstring and iconv. Default is empty. If empty, default_charset is used.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'default_mimetype':
                    //Thursday, November 9, 2023 @ 1027 hrs.
                    //default_mimetype                          "text/html"                                         PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ini.core.php#ini.default-mimetype',
                        'https://www.php.net/manual/en/ini.core.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"text/html"'),                  // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'By default, PHP will output a media type using the Content-Type header. To disable this, simply set it to be empty.

PHP\'s built-in default media type is set to text/html.',
                                        'TEXT' => 'By default, PHP will output a media type using the Content-Type header. To disable this, simply set it to be empty.

PHP\'s built-in default media type is set to text/html.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'default_socket_timeout':
                    //Thursday, November 9, 2023 @ 1031 hrs.
                    //default_socket_timeout                    "60"                                                PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/filesystem.configuration.php#ini.default-socket-timeout',
                        'https://www.php.net/manual/en/filesystem.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"60"'),                         // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_INTEGER),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Default timeout (in seconds) for socket based streams. Specifying a negative value means an infinite timeout.',
                                        'TEXT' => 'Default timeout (in seconds) for socket based streams. Specifying a negative value means an infinite timeout.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'disable_classes':
                    //Thursday, November 9, 2023 @ 1042 hrs.
                    //disable_classes                           ""                                                  php.ini only

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ini.core.php#ini.disable-classes',
                        'https://www.php.net/manual/en/ini.core.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '""'),                           // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'This directive allows you to disable certain classes. It takes on a comma-delimited list of class names. This directive must be set in php.ini For example, you cannot set this in httpd.conf.',
                                        'TEXT' => 'This directive allows you to disable certain classes. It takes on a comma-delimited list of class names. This directive must be set in php.ini For example, you cannot set this in httpd.conf.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'disable_functions':
                    //Thursday, November 9, 2023 @ 1042 hrs.
                    //disable_functions                         ""                                                  php.ini only

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ini.core.php#ini.disable-classes',
                        'https://www.php.net/manual/en/ini.core.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '""'),                           // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'This directive allows you to disable certain functions. It takes on a comma-delimited list of function names.

Only ' . $this->oCRNRSTN->return_crnrstn_text_link('internal functions', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/functions.internal.php') . ' can be disabled using this directive. ' . $this->oCRNRSTN->return_crnrstn_text_link('User-defined functions', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/functions.user-defined.php') . ' are unaffected.

This directive must be set in php.ini For example, you cannot set this in httpd.conf.',
                                        'TEXT' => 'This directive allows you to disable certain functions. It takes on a comma-delimited list of function names.

Only internal functions can be disabled using this directive. User-defined functions are unaffected.

This directive must be set in php.ini For example, you cannot set this in httpd.conf.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'display_errors':
                    //Thursday, November 9, 2023 @ 1141 hrs.
                    //display_errors                            "1"                                                 PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/errorfunc.configuration.php#ini.display-errors',
                        'https://www.php.net/manual/en/errorfunc.configuration.php',
                        'https://www.php.net/manual/en/function.ini-set.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"1"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'This is a feature to support your development and should never be used on production systems (e.g. systems connected to the internet).',
                                            'TEXT' => 'This is a feature to support your development and should never be used on production systems (e.g. systems connected to the internet).'
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'Although display_errors may be set at runtime (with ' . $this->oCRNRSTN->return_crnrstn_text_link('ini_set', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.ini-set.php') . '), it won\'t have any effect if the script has fatal errors. This is because the desired runtime action does not get executed.',
                                            'TEXT' => 'Although display_errors may be set at runtime (with ini_set()), it won\'t have any effect if the script has fatal errors. This is because the desired runtime action does not get executed.'
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'This determines whether errors should be printed to the screen as part of the output or if they should be hidden from the user.

Value &quot;stderr&quot; sends the errors to stderr instead of stdout.',
                                        'TEXT' => 'This determines whether errors should be printed to the screen as part of the output or if they should be hidden from the user.

Value "stderr" sends the errors to stderr instead of stdout.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'display_startup_errors':
                    //Thursday, November 9, 2023 @ 1148 hrs.
                    //display_startup_errors                    "1"                                                 PHP_INI_ALL                 Prior to PHP 8.0.0, the default value was "0".

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/errorfunc.configuration.php#ini.display-errors',
                        'https://www.php.net/manual/en/errorfunc.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"1"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'Prior to PHP 8.0.0, the default value was &quot;0&quot;.',
                                            'TEXT' => 'Prior to PHP 8.0.0, the default value was "0".'
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Even when display_errors is on, errors that occur during PHP\'s startup sequence are not displayed. It\'s strongly recommended to keep display_startup_errors off, except for debugging.',
                                        'TEXT' => 'Even when display_errors is on, errors that occur during PHP\'s startup sequence are not displayed. It\'s strongly recommended to keep display_startup_errors off, except for debugging.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'docref_ext':
                    //Friday, November 10, 2023 @ 0200 hrs.
                    //docref_ext                                ""                                                  PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/errorfunc.configuration.php#ini.display-errors',
                        'https://www.php.net/manual/en/errorfunc.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '""'),                           // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'The value of docref_ext must begin with a dot &quot;.&quot;.',
                                            'TEXT' => 'The value of docref_ext must begin with a dot ".".'
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'See ' . $this->oCRNRSTN->return_crnrstn_text_link('docref_root', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/errorfunc.configuration.php#ini.docref-root') . '.',
                                        'TEXT' => 'See docref_root.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'docref_root':
                    //Friday, November 10, 2023 @ 1027 hrs.
                    //docref_root                               ""                                                  PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/errorfunc.configuration.php#ini.docref-root',
                        'https://www.php.net/manual/en/errorfunc.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '""'),                           // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'This is a feature to support your development since it makes it easy to lookup a function description. However it should never be used on production systems (e.g. systems connected to the internet).',
                                            'TEXT' => 'This is a feature to support your development since it makes it easy to lookup a function description. However it should never be used on production systems (e.g. systems connected to the internet).'
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'The new error format contains a reference to a page describing the error or function causing the error. In case of manual pages you can download the manual in your language and set this ini directive to the URL of your local copy. If your local copy of the manual can be reached by "/manual/" you can simply use docref_root=/manual/. Additional you have to set docref_ext to match the fileextensions of your copy docref_ext=.html. It is possible to use external references. For example you can use docref_root=http://manual/en/ or docref_root="http://landonize.it/?how=url&theme=classic&filter=Landon &url=http%3A%2F%2Fwww.php.net%2F"

Most of the time you want the docref_root value to end with a slash &quot;/&quot;. But see the second example above which does not have nor need it.',
                                        'TEXT' => 'The new error format contains a reference to a page describing the error or function causing the error. In case of manual pages you can download the manual in your language and set this ini directive to the URL of your local copy. If your local copy of the manual can be reached by "/manual/" you can simply use docref_root=/manual/. Additional you have to set docref_ext to match the fileextensions of your copy docref_ext=.html. It is possible to use external references. For example you can use docref_root=http://manual/en/ or docref_root="http://landonize.it/?how=url&theme=classic&filter=Landon &url=http%3A%2F%2Fwww.php.net%2F"

Most of the time you want the docref_root value to end with a slash "/". But see the second example above which does not have nor need it.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'doc_root':
                    //Friday, November 10, 2023 @ 1041 hrs.
                    //doc_root                                  NULL                                                PHP_INI_SYSTEM

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/errorfunc.configuration.php#ini.docref-root',
                        'https://www.php.net/manual/en/errorfunc.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => 'NULL'),                         // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'PHP\'s &quot;root directory&quot; on the server. Only used if non-empty. If PHP was not compiled with FORCE_REDIRECT, you should set doc_root if you are running PHP as a CGI under any web server (other than IIS). The alternative is to use the ' . $this->oCRNRSTN->return_crnrstn_text_link('cgi.force_redirect', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/ini.core.php#ini.cgi.force-redirect') . ' configuration below.',
                                        'TEXT' => 'PHP\'s "root directory" on the server. Only used if non-empty. If PHP was not compiled with FORCE_REDIRECT, you should set doc_root if you are running PHP as a CGI under any web server (other than IIS). The alternative is to use the cgi.force_redirect configuration below.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'enable_dl':
                    //Friday, November 10, 2023 @ 1106 hrs.
                    //enable_dl                                 "1"                                                 PHP_INI_SYSTEM              This deprecated feature will certainly be removed in the future.

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/info.configuration.php#ini.enable-dl',
                        'https://www.php.net/manual/en/info.configuration.php',
                        'https://www.php.net/manual/en/function.dl.php',
                        'https://www.php.net/manual/en/ini.core.php#ini.open-basedir',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"1"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_SYSTEM'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '1'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'This deprecated feature will certainly be removed in the future.',
                                            'TEXT' => 'This deprecated feature will certainly be removed in the future.'
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'This directive allows to turn dynamic loading of PHP extensions with ' . $this->oCRNRSTN->return_crnrstn_text_link('dl', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.dl.php') . ' on and off.

The main reason for turning dynamic loading off is security. With dynamic loading, it\'s possible to ignore all ' . $this->oCRNRSTN->return_crnrstn_text_link('open_basedir', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/ini.core.php#ini.open-basedir') . ' restrictions. The default is to allow dynamic loading.',
                                        'TEXT' => 'This directive allows to turn dynamic loading of PHP extensions with dl() on and off.

The main reason for turning dynamic loading off is security. With dynamic loading, it\'s possible to ignore all open_basedir restrictions. The default is to allow dynamic loading.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'enable_post_data_reading':
                    //Friday, November 10, 2023 @ 1135 hrs.
                    //enable_post_data_reading                  On                                                  PHP_INI_PERDIR

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ini.core.php#ini.enable-post-data-reading',
                        'https://www.php.net/manual/en/ini.core.php',
                        'https://www.php.net/manual/en/reserved.variables.post.php',
                        'https://www.php.net/manual/en/reserved.variables.files.php',
                        'https://www.php.net/manual/en/wrappers.php.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => 'On'),                           // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_PERDIR'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Disabling this option causes ' . $this->oCRNRSTN->return_crnrstn_text_link('$_POST', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/reserved.variables.post.php') . ' and ' . $this->oCRNRSTN->return_crnrstn_text_link('$_FILES', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/reserved.variables.files.php') . ' not to be populated. The only way to read postdata will then be through the ' . $this->oCRNRSTN->return_crnrstn_text_link('php://input', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/wrappers.php.php') . ' stream wrapper. This can be useful to proxy requests or to process the POST data in a memory efficient fashion.',
                                        'TEXT' => 'Disabling this option causes $_POST and $_FILES not to be populated. The only way to read postdata will then be through the php://input stream wrapper. This can be useful to proxy requests or to process the POST data in a memory efficient fashion.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'engine':
                    //Friday, November 10, 2023 @ 1145 hrs.
                    //engine                                    "1"                                                 PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/apache.configuration.php#ini.engine',
                        'https://www.php.net/manual/en/apache.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.php#configuration.changes.apache',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"1"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Turns PHP parsing on or off. This directive is really only useful in the Apache module version of PHP. It is used by sites that would like to turn PHP parsing on and off on a per-directory or per-virtual server basis. By putting engine off in the appropriate places in the httpd.conf file, PHP can be enabled or disabled.',
                                        'TEXT' => 'Turns PHP parsing on or off. This directive is really only useful in the Apache module version of PHP. It is used by sites that would like to turn PHP parsing on and off on a per-directory or per-virtual server basis. By putting engine off in the appropriate places in the httpd.conf file, PHP can be enabled or disabled.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'error_append_string':
                    //Friday, November 10, 2023 @ 1400 hrs.
                    //error_append_string                       NULL                                                PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/errorfunc.configuration.php#ini.error-append-string',
                        'https://www.php.net/manual/en/errorfunc.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => 'NULL'),                         // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'String to output after an error message. Only used when the error message is displayed on screen. The main purpose is to be able to append additional HTML markup to the error message.',
                                            'TEXT' => 'String to output after an error message. Only used when the error message is displayed on screen. The main purpose is to be able to append additional HTML markup to the error message.'
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => '',
                                        'TEXT' => ''
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'error_log':
                    //Friday, November 10, 2023 @ 1400 hrs.
                    //error_log                                 NULL                                                PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/errorfunc.configuration.php#ini.error-log',
                        'https://www.php.net/manual/en/errorfunc.configuration.php',
                        'https://www.php.net/manual/en/function.syslog.php',
                        'https://www.php.net/manual/en/function.error-log.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => 'NULL'),                         // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Name of the file where script errors should be logged. The file should be writable by the web server\'s user. If the special value syslog is used, the errors are sent to the system logger instead. On Unix, this means syslog(3) and on Windows it means the event log. See also: ' . $this->oCRNRSTN->return_crnrstn_text_link('syslog', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.syslog.php') . '. If this directive is not set, errors are sent to the SAPI error logger. For example, it is an error log in Apache or stderr in CLI. See also ' . $this->oCRNRSTN->return_crnrstn_text_link('error_log', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.error-log.php') . '.',
                                        'TEXT' => 'Name of the file where script errors should be logged. The file should be writable by the web server\'s user. If the special value syslog is used, the errors are sent to the system logger instead. On Unix, this means syslog(3) and on Windows it means the event log. See also: syslog(). If this directive is not set, errors are sent to the SAPI error logger. For example, it is an error log in Apache or stderr in CLI. See also error_log().'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'error_log_mode':
                    //Friday, November 10, 2023 @ 1401 hrs.
                    //error_log_mode                            0o644                                               PHP_INI_ALL                 Available as of PHP 8.2.0

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/errorfunc.configuration.php#ini.error-log-mode',
                        'https://www.php.net/manual/en/errorfunc.configuration.php',
                        'https://www.php.net/manual/en/errorfunc.configuration.php#ini.error-log',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '0o644'),                        // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_INTEGER),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => '8.2.0'),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'Available as of PHP 8.2.0.',
                                            'TEXT' => 'Available as of PHP 8.2.0.'
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'File mode for the file described set in ' . $this->oCRNRSTN->return_crnrstn_text_link('error_log', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/errorfunc.configuration.php#ini.error-log') . '.',
                                        'TEXT' => 'File mode for the file described set in error_log.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'error_prepend_string':
                    //Friday, November 10, 2023 @ 1401 hrs.
                    //error_prepend_string                      NULL                                                PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/errorfunc.configuration.php#ini.error-prepend-string',
                        'https://www.php.net/manual/en/errorfunc.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => 'NULL'),                         // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'String to output before an error message. Only used when the error message is displayed on screen. The main purpose is to be able to prepend additional HTML markup to the error message.',
                                        'TEXT' => 'String to output before an error message. Only used when the error message is displayed on screen. The main purpose is to be able to prepend additional HTML markup to the error message.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'error_reporting':
                    //Friday, November 10, 2023 @ 1402 hrs.
                    //error_reporting                           NULL                                                PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/errorfunc.configuration.php#ini.error-reporting',
                        'https://www.php.net/manual/en/errorfunc.configuration.php',
                        'https://www.php.net/manual/en/errorfunc.constants.php',
                        'https://www.php.net/manual/en/function.error-reporting.php',
                        'https://www.php.net/manual/en/errorfunc.configuration.php#ini.display-errors',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => 'NULL'),                         // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_INTEGER),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'PHP Constants outside of PHP
Using PHP Constants outside of PHP, like in httpd.conf, will have no useful meaning so in such cases the int values are required. And since error levels will be added over time, the maximum value (for E_ALL) will likely change. So in place of E_ALL consider using a larger value to cover all bit fields from now and well into the future, a numeric value like 2147483647 (includes all errors, not just E_ALL).',
                                            'TEXT' => 'PHP Constants outside of PHP
Using PHP Constants outside of PHP, like in httpd.conf, will have no useful meaning so in such cases the int values are required. And since error levels will be added over time, the maximum value (for E_ALL) will likely change. So in place of E_ALL consider using a larger value to cover all bit fields from now and well into the future, a numeric value like 2147483647 (includes all errors, not just E_ALL).'
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Set the error reporting level. The parameter is either an integer representing a bit field, or named constants. The error_reporting levels and constants are described in ' . $this->oCRNRSTN->return_crnrstn_text_link('Predefined Constants', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/errorfunc.constants.php') . ', and in php.ini. To set at runtime, use the ' . $this->oCRNRSTN->return_crnrstn_text_link('error_reporting', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.error-reporting.php') . ' function. See also the ' . $this->oCRNRSTN->return_crnrstn_text_link('display_errors', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/errorfunc.configuration.php#ini.display-errors') . ' directive.

The default value is E_ALL.

Prior to PHP 8.0.0, the default value was: E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED. This means diagnostics of level E_NOTICE, E_STRICT and E_DEPRECATED were not shown.',
                                        'TEXT' => 'Set the error reporting level. The parameter is either an integer representing a bit field, or named constants. The error_reporting levels and constants are described in Predefined Constants, and in php.ini. To set at runtime, use the error_reporting() function. See also the display_errors directive.

The default value is E_ALL.

Prior to PHP 8.0.0, the default value was: E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED. This means diagnostics of level E_NOTICE, E_STRICT and E_DEPRECATED were not shown.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'exif.encode_unicode':
                    //Friday, November 10, 2023 @ 1403 hrs.
                    //exif.encode_unicode                       "ISO-8859-15"                                       PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/exif.configuration.php#ini.exif.encode-unicode',
                        'https://www.php.net/manual/en/exif.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"ISO-8859-15"'),                // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'exif.encode_unicode defines the characterset UNICODE user comments are handled. This defaults to ISO-8859-15 which should work for most non Asian countries. The setting can be empty or must be an encoding supported by mbstring. If it is empty the current internal encoding of mbstring is used.',
                                        'TEXT' => 'exif.encode_unicode defines the characterset UNICODE user comments are handled. This defaults to ISO-8859-15 which should work for most non Asian countries. The setting can be empty or must be an encoding supported by mbstring. If it is empty the current internal encoding of mbstring is used.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'exif.decode_unicode_motorola':
                    //Friday, November 10, 2023 @ 1403 hrs.
                    //exif.decode_unicode_motorola              "UCS-2BE"                                           PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/exif.configuration.php#ini.exif.decode-unicode-motorola',
                        'https://www.php.net/manual/en/exif.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"UCS-2BE"'),                    // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'exif.decode_unicode_motorola defines the image internal characterset for Unicode encoded user comments if image is in motorola byte order (big-endian). This setting cannot be empty but you can specify a list of encodings supported by mbstring. The default is UCS-2BE.',
                                        'TEXT' => 'exif.decode_unicode_motorola defines the image internal characterset for Unicode encoded user comments if image is in motorola byte order (big-endian). This setting cannot be empty but you can specify a list of encodings supported by mbstring. The default is UCS-2BE.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'exif.decode_unicode_intel':
                    //Friday, November 10, 2023 @ 1404 hrs.
                    //exif.decode_unicode_intel                 "UCS-2LE"                                           PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/exif.configuration.php#ini.exif.decode-unicode-intel',
                        'https://www.php.net/manual/en/exif.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"UCS-2LE"'),                    // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'exif.decode_unicode_intel defines the image internal characterset for Unicode encoded user comments if image is in intel byte order (little-endian). This setting cannot be empty but you can specify a list of encodings supported by mbstring. The default is UCS-2LE.',
                                        'TEXT' => 'exif.decode_unicode_intel defines the image internal characterset for Unicode encoded user comments if image is in intel byte order (little-endian). This setting cannot be empty but you can specify a list of encodings supported by mbstring. The default is UCS-2LE.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'exif.encode_jis':
                    //Friday, November 10, 2023 @ 1404 hrs.
                    //exif.encode_jis                           ""                                                  PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/exif.configuration.php#ini.exif.encode-jis',
                        'https://www.php.net/manual/en/exif.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '""'),                           // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'exif.encode_jis defines the characterset JIS user comments are handled. This defaults to an empty value which forces the functions to use the current internal encoding of mbstring.',
                                        'TEXT' => 'exif.encode_jis defines the characterset JIS user comments are handled. This defaults to an empty value which forces the functions to use the current internal encoding of mbstring.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'exif.decode_jis_motorola':
                    //Friday, November 10, 2023 @ 1405 hrs.
                    //exif.decode_jis_motorola                  "JIS"                                               PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/exif.configuration.php#ini.exif.decode-jis-motorola',
                        'https://www.php.net/manual/en/exif.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"JIS"'),                        // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'exif.decode_jis_motorola defines the image internal characterset for JIS encoded user comments if image is in motorola byte order (big-endian). This setting cannot be empty but you can specify a list of encodings supported by mbstring. The default is JIS.',
                                        'TEXT' => 'exif.decode_jis_motorola defines the image internal characterset for JIS encoded user comments if image is in motorola byte order (big-endian). This setting cannot be empty but you can specify a list of encodings supported by mbstring. The default is JIS.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'exif.decode_jis_intel':
                    //Friday, November 10, 2023 @ 1406 hrs.
                    //exif.decode_jis_intel                     "JIS"                                               PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/exif.configuration.php#ini.exif.decode-jis-intel',
                        'https://www.php.net/manual/en/exif.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"JIS"'),                        // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'exif.decode_jis_intel defines the image internal characterset for JIS encoded user comments if image is in intel byte order (little-endian). This setting cannot be empty but you can specify a list of encodings supported by mbstring. The default is JIS.',
                                        'TEXT' => 'exif.decode_jis_intel defines the image internal characterset for JIS encoded user comments if image is in intel byte order (little-endian). This setting cannot be empty but you can specify a list of encodings supported by mbstring. The default is JIS.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'exit_on_timeout':
                    //Friday, November 10, 2023 @ 1406 hrs.
                    //exit_on_timeout                           ""                                                  PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ini.core.php#ini.exit-on-timeout',
                        'https://www.php.net/manual/en/ini.core.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '""'),                           // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'This is an Apache1 mod_php-only directive that forces an Apache child to exit if a PHP execution timeout occurred. Such a timeout causes an internal longjmp() call in Apache1 which can leave some extensions in an inconsistent state. By terminating the process any outstanding locks or memory will be cleaned up.',
                                        'TEXT' => 'This is an Apache1 mod_php-only directive that forces an Apache child to exit if a PHP execution timeout occurred. Such a timeout causes an internal longjmp() call in Apache1 which can leave some extensions in an inconsistent state. By terminating the process any outstanding locks or memory will be cleaned up.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'expect.timeout':
                    //Friday, November 10, 2023 @ 1407 hrs.
                    //expect.timeout                            "10"                                                PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/expect.configuration.php#ini.expect.timeout',
                        'https://www.php.net/manual/en/expect.configuration.php',
                        'https://www.php.net/manual/en/function.expect-expectl.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"10"'),                         // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_INTEGER),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'A value of &quot;0&quot; causes the ' . $this->oCRNRSTN->return_crnrstn_text_link('expect_expectl', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.expect-expectl.php') . ' function to return immediately.',
                                            'TEXT' => 'A value of "0" causes the expect_expectl() function to return immediately.'
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'The timeout period for waiting for the data, when using the ' . $this->oCRNRSTN->return_crnrstn_text_link('expect_expectl', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.expect-expectl.php') . ' function.

A value of &quot;-1&quot; disables a timeout from occurring.',
                                        'TEXT' => 'The timeout period for waiting for the data, when using the expect_expectl() function.

A value of "-1" disables a timeout from occurring.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'expect.loguser':
                    //Friday, November 10, 2023 @ 1407 hrs.
                    //expect.loguser                            "1"                                                 PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/expect.configuration.php#ini.expect.loguser',
                        'https://www.php.net/manual/en/expect.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"1"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Whether expect should send any output from the spawned process to stdout. Since interactive programs typically echo their input, this usually suffices to show both sides of the conversation.',
                                        'TEXT' => 'Whether expect should send any output from the spawned process to stdout. Since interactive programs typically echo their input, this usually suffices to show both sides of the conversation.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'expect.logfile':
                    //Friday, November 10, 2023 @ 1409 hrs.
                    //expect.logfile                            ""                                                  PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/expect.configuration.php#ini.expect.logfile',
                        'https://www.php.net/manual/en/expect.configuration.php',
                        'https://www.php.net/manual/en/expect.configuration.php#ini.expect.loguser',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '""'),                           // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'If this configuration is not empty, the output is written regardless of the value of ' . $this->oCRNRSTN->return_crnrstn_text_link('expect.loguser', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/expect.configuration.php#ini.expect.loguser') . '.',
                                            'TEXT' => 'If this configuration is not empty, the output is written regardless of the value of expect.loguser.'
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Name of the file, where the output from the spawned process will be written. If this file doesn\'t exist, it will be created.',
                                        'TEXT' => 'Name of the file, where the output from the spawned process will be written. If this file doesn\'t exist, it will be created.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'expect.match_max':
                    //Friday, November 10, 2023 @ 1851 hrs.
                    //expect.match_max                          ""                                                  PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/expect.configuration.php#ini.expect.match-max',
                        'https://www.php.net/manual/en/expect.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '""'),                           // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_INTEGER),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Changes default size (2000 bytes) of the buffer used to match asterisks in patterns.',
                                        'TEXT' => 'Changes default size (2000 bytes) of the buffer used to match asterisks in patterns.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'expose_php':
                    //expose_php                                "1"                                                 php.ini only

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ini.core.php#ini.expose-php',
                        'https://www.php.net/manual/en/ini.core.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"1"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'php.ini only'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Exposes to the world that PHP is installed on the server, which includes the PHP version within the HTTP header (e.g., X-Powered-By: PHP/5.3.7).',
                                        'TEXT' => 'Exposes to the world that PHP is installed on the server, which includes the PHP version within the HTTP header (e.g., X-Powered-By: PHP/5.3.7).'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'extension':
                    //Friday, November 10, 2023 @ 1831 hrs.
                    //extension                                 NULL                                                php.ini only

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ini.core.php#ini.extension',
                        'https://www.php.net/manual/en/ini.core.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => 'NULL'),                         // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'php.ini only'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Which dynamically loadable extensions to load when PHP starts up.',
                                        'TEXT' => 'Which dynamically loadable extensions to load when PHP starts up.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'extension_dir':
                    //Friday, November 10, 2023 @ 1842 hrs.
                    //extension_dir                             "/path/to/php"                                      PHP_INI_SYSTEM

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ini.core.php#ini.extension-dir',
                        'https://www.php.net/manual/en/ini.core.php',
                        'https://www.php.net/manual/en/info.configuration.php#ini.enable-dl',
                        'https://www.php.net/manual/en/function.dl.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"/path/to/php"'),               // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_SYSTEM'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'In what directory PHP should look for dynamically loadable extensions. It is recommended to specify an absolute path. See also: ' . $this->oCRNRSTN->return_crnrstn_text_link('enable_dl', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/info.configuration.php#ini.enable-dl') . ', and ' . $this->oCRNRSTN->return_crnrstn_text_link('dl', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.dl.php') . '.',
                                        'TEXT' => 'In what directory PHP should look for dynamically loadable extensions. It is recommended to specify an absolute path. See also: enable_dl, and dl().'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'fastcgi.impersonate':
                    //Friday, November 10, 2023 @ 1845 hrs.
                    //fastcgi.impersonate                       "0"                                                 PHP_INI_SYSTEM

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ini.core.php#ini.fastcgi.impersonate',
                        'https://www.php.net/manual/en/ini.core.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_SYSTEM'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'FastCGI under IIS (on WINNT based OS) supports the ability to impersonate security tokens of the calling client. This allows IIS to define the security context that the request runs under. mod_fastcgi under Apache does not currently support this feature (03/17/2002) Set to 1 if running under IIS. Default is zero.',
                                        'TEXT' => 'FastCGI under IIS (on WINNT based OS) supports the ability to impersonate security tokens of the calling client. This allows IIS to define the security context that the request runs under. mod_fastcgi under Apache does not currently support this feature (03/17/2002) Set to 1 if running under IIS. Default is zero.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'fastcgi.logging':
                    //Friday, November 10, 2023 @ 1849 hrs.
                    //fastcgi.logging                           "1"                                                 PHP_INI_SYSTEM

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ini.core.php#ini.fastcgi.logging',
                        'https://www.php.net/manual/en/ini.core.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"1"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_SYSTEM'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Turns on SAPI logging when using FastCGI. Default is to enable logging.',
                                        'TEXT' => 'Turns on SAPI logging when using FastCGI. Default is to enable logging.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'file_uploads':
                    //Friday. November 10, 2023 @ 1911 hrs.
                    //file_uploads                              "1"                                                 PHP_INI_SYSTEM

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ini.core.php#ini.file-uploads',
                        'https://www.php.net/manual/en/ini.core.php',
                        'https://www.php.net/manual/en/features.file-upload.php',
                        'https://www.php.net/manual/en/ini.core.php#ini.upload-max-filesize',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"1"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_SYSTEM'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Whether or not to allow HTTP ' . $this->oCRNRSTN->return_crnrstn_text_link('file uploads', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/features.file-upload.php') . '. See also the ' . $this->oCRNRSTN->return_crnrstn_text_link('upload_max_filesize', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/ini.core.php#ini.upload-max-filesize') . ', ' . $this->oCRNRSTN->return_crnrstn_text_link('upload_tmp_dir', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/ini.core.php#ini.upload-tmp-dir') . ', and ' . $this->oCRNRSTN->return_crnrstn_text_link('post_max_size', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/ini.core.php#ini.post-max-size') . ' directives.',
                                        'TEXT' => 'Whether or not to allow HTTP file uploads. See also the upload_max_filesize, upload_tmp_dir, and post_max_size directives.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'filter.default':
                    //Friday, November 10, 2023 @ 1944 hrs.
                    //filter.default                            "unsafe_raw"                                        PHP_INI_PERDIR              Deprecated as of PHP 8.1.0.

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/filter.configuration.php#ini.filter.default',
                        'https://www.php.net/manual/en/filter.configuration.php',
                        'https://www.php.net/manual/en/reserved.variables.get.php',
                        'https://www.php.net/manual/en/reserved.variables.post.php',
                        'https://www.php.net/manual/en/reserved.variables.cookies.php',
                        'https://www.php.net/manual/en/reserved.variables.request.php',
                        'https://www.php.net/manual/en/reserved.variables.server.php',
                        'https://www.php.net/manual/en/function.filter-input.php',
                        'https://www.php.net/manual/en/filter.filters.php',
                        'https://www.php.net/manual/en/function.htmlspecialchars.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"unsafe_raw"'),                 // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_PERDIR'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'Be careful about the default flags for the default filters. You should explicitly set them to the value you want. For example, to configure the default filter to behave exactly like ' . $this->oCRNRSTN->return_crnrstn_text_link('htmlspecialchars', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.htmlspecialchars.php') . ' you need to set them default flags to 0 as shown below.',
                                            'TEXT' => 'Be careful about the default flags for the default filters. You should explicitly set them to the value you want. For example, to configure the default filter to behave exactly like htmlspecialchars() you need to set them default flags to 0 as shown below.'
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '1'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => '8.1.0'),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'Deprecated as of PHP 8.1.0.',
                                            'TEXT' => 'Deprecated as of PHP 8.1.0.'
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Filter all ' . $this->oCRNRSTN->return_crnrstn_text_link('$_GET', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/reserved.variables.get.php') . ', ' . $this->oCRNRSTN->return_crnrstn_text_link('$_POST', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/reserved.variables.post.php') . ', ' . $this->oCRNRSTN->return_crnrstn_text_link('$_COOKIE', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/reserved.variables.cookies.php') . ', ' . $this->oCRNRSTN->return_crnrstn_text_link('$_REQUEST', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/reserved.variables.request.php') . ' and ' . $this->oCRNRSTN->return_crnrstn_text_link('$_SERVER', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/reserved.variables.server.php') . ' data by this filter. Original data can be accessed through ' . $this->oCRNRSTN->return_crnrstn_text_link('filter_input', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.filter-input.php') . '.

Accepts the name of the filter you like to use by default. See the existing ' . $this->oCRNRSTN->return_crnrstn_text_link('filter list', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/filter.filters.php') . ' for the list of the filter names.',
                                        'TEXT' => 'Filter all $_GET, $_POST, $_COOKIE, $_REQUEST and $_SERVER data by this filter. Original data can be accessed through filter_input().

Accepts the name of the filter you like to use by default. See the existing filter list for the list of the filter names.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'filter.default_flags':
                    //Friday, November 10, 2023 @ 1953 hrs.
                    //filter.default_flags                      NULL                                                PHP_INI_PERDIR

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/filter.configuration.php#ini.filter.default-flags',
                        'https://www.php.net/manual/en/filter.configuration.php',
                        'https://www.php.net/manual/en/filter.filters.flags.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => 'NULL'),                         // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_INTEGER),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_PERDIR'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Default flags to apply when the default filter is set. This is set to FILTER_FLAG_NO_ENCODE_QUOTES by default for backwards compatibility reasons. See the ' . $this->oCRNRSTN->return_crnrstn_text_link('flag list', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/filter.filters.flags.php') . ' for the list of all the flag names.',
                                        'TEXT' => 'Default flags to apply when the default filter is set. This is set to FILTER_FLAG_NO_ENCODE_QUOTES by default for backwards compatibility reasons. See the flag list for the list of all the flag names.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'from':
                    //Friday, November 10, 2023 @ 1958 hrs.
                    //from                                      ""                                                  PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/filesystem.configuration.php#ini.from',
                        'https://www.php.net/manual/en/filesystem.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '""'),                           // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'The email address to be used on unauthenticated FTP connections and as the value of From header for HTTP connections, when using the ftp and http wrappers, respectively.',
                                        'TEXT' => 'The email address to be used on unauthenticated FTP connections and as the value of From header for HTTP connections, when using the ftp and http wrappers, respectively.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'gd.jpeg_ignore_warning':
                    //Friday, November 10, 2023 @ 2007 hrs.
                    //gd.jpeg_ignore_warning                    "1"                                                 PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/image.configuration.php#ini.gd.jpeg-ignore-warning',
                        'https://www.php.net/manual/en/image.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"1"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'PHP 7.1.0 :: The default of gd.jpeg_ignore_warning has been changed from 0 to 1.',
                                            'TEXT' => 'PHP 7.1.0 :: The default of gd.jpeg_ignore_warning has been changed from 0 to 1.'
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Ignore warnings (but not errors) created by libjpeg(-turbo).',
                                        'TEXT' => 'Ignore warnings (but not errors) created by libjpeg(-turbo).'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'geoip.custom_directory':
                    //Friday, November 10, 2023 @ 2007 hrs.
                    //geoip.custom_directory                    ""                                                  PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/geoip.configuration.php#ini.geoip.custom-directory',
                        'https://www.php.net/manual/en/geoip.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '""'),                           // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Empty by default, but can be set to force a different database path than the one compiled in the library.',
                                        'TEXT' => 'Empty by default, but can be set to force a different database path than the one compiled in the library.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'hard_timeout':
                    //Friday, November 10, 2023 @ 2012 hrs.
                    //hard_timeout                              "2"                                                 PHP_INI_SYSTEM              Available since PHP 7.1.0.

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"2"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_INTEGER),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_SYSTEM'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => '7.1.0'),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'Available since PHP 7.1.0.',
                                            'TEXT' => 'Available since PHP 7.1.0.'
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Hard timeout.',
                                        'TEXT' => 'Hard timeout.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'highlight.comment':
                    //Friday, November 10, 2023 @ 2027 hrs.
                    //highlight.comment                         "#FF8000"                                           PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/misc.configuration.php#ini.syntax-highlighting',
                        'https://www.php.net/manual/en/misc.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"#FF8000"'),                    // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Colors for Syntax Highlighting mode. Anything that\'s acceptable in <font color="??????"> would work.',
                                        'TEXT' => 'Colors for Syntax Highlighting mode. Anything that\'s acceptable in <font color="??????"> would work.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'highlight.default':
                    //Friday, November 10, 2023 @ 2027 hrs.
                    //highlight.default                         "#0000BB"                                           PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/misc.configuration.php#ini.syntax-highlighting',
                        'https://www.php.net/manual/en/misc.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"#0000BB"'),                    // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Colors for Syntax Highlighting mode. Anything that\'s acceptable in <font color="??????"> would work.',
                                        'TEXT' => 'Colors for Syntax Highlighting mode. Anything that\'s acceptable in <font color="??????"> would work.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'highlight.html':
                    //Friday, November 10, 2023 @ 2026 hrs.
                    //highlight.html                            "#000000"                                           PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/misc.configuration.php#ini.syntax-highlighting',
                        'https://www.php.net/manual/en/misc.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"#000000"'),                    // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Colors for Syntax Highlighting mode. Anything that\'s acceptable in <font color="??????"> would work.',
                                        'TEXT' => 'Colors for Syntax Highlighting mode. Anything that\'s acceptable in <font color="??????"> would work.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'highlight.keyword':
                    //Friday, November 10, 2023 @ 2024 hrs.
                    //highlight.keyword                         "#007700"                                           PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/misc.configuration.php#ini.syntax-highlighting',
                        'https://www.php.net/manual/en/misc.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"#007700"'),                    // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Colors for Syntax Highlighting mode. Anything that\'s acceptable in <font color="??????"> would work.',
                                        'TEXT' => 'Colors for Syntax Highlighting mode. Anything that\'s acceptable in <font color="??????"> would work.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'highlight.string':
                    //Friday, November 10, 2023 @ 2025 hrs.
                    //highlight.string                          "#DD0000"                                           PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/misc.configuration.php#ini.syntax-highlighting',
                        'https://www.php.net/manual/en/misc.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"#DD0000"'),                    // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Colors for Syntax Highlighting mode. Anything that\'s acceptable in <font color="??????"> would work.',
                                        'TEXT' => 'Colors for Syntax Highlighting mode. Anything that\'s acceptable in <font color="??????"> would work.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'html_errors':
                    //Friday, November 10, 2023 @ 2035 hrs.
                    //html_errors                               "1"                                                 PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/errorfunc.configuration.php#ini.html-errors',
                        'https://www.php.net/manual/en/errorfunc.configuration.php',
                        'https://www.php.net/manual/en/errorfunc.configuration.php#ini.docref-root',
                        'https://www.php.net/manual/en/errorfunc.configuration.php#ini.docref-ext',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"1"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'If enabled, error messages will include HTML tags. The format for HTML errors produces clickable messages that direct the user to a page describing the error or function in causing the error. These references are affected by docref_root and docref_ext.

If disabled, error message will be solely plain text.',
                                        'TEXT' => 'If enabled, error messages will include HTML tags. The format for HTML errors produces clickable messages that direct the user to a page describing the error or function in causing the error. These references are affected by docref_root and docref_ext.

If disabled, error message will be solely plain text.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'ibase.allow_persistent':
                    //Friday, November 10, 2023 @ 2042 hrs.
                    //ibase.allow_persistent                    "1"                                                 PHP_INI_SYSTEM

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ibase.configuration.php#ini.ibase.allow-persistent',
                        'https://www.php.net/manual/en/ibase.configuration.php',
                        'https://www.php.net/manual/en/features.persistent-connections.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"1"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_SYSTEM'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Whether to allow ' . $this->oCRNRSTN->return_crnrstn_text_link('persistent connections', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/features.persistent-connections.php') . ' to Firebird/InterBase.',
                                        'TEXT' => 'Whether to allow persistent connections to Firebird/InterBase.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'ibase.max_persistent':
                    //Friday, November 10, 2023 @ 2051 hrs.
                    //ibase.max_persistent                      "-1"                                                PHP_INI_SYSTEM

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ibase.configuration.php#ini.ibase.max-persistent',
                        'https://www.php.net/manual/en/ibase.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"-1"'),                         // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_INTEGER),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_SYSTEM'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'The maximum number of persistent Firebird/InterBase connections per process. New connections created with ibase_pconnect() will be non-persistent if this number would be exceeded.',
                                        'TEXT' => 'The maximum number of persistent Firebird/InterBase connections per process. New connections created with ibase_pconnect() will be non-persistent if this number would be exceeded.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'ibase.max_links':
                    //Friday, November 10, 2023 @ 2052 hrs.
                    //ibase.max_links                           "-1"                                                PHP_INI_SYSTEM

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ibase.configuration.php#ini.ibase.max-links',
                        'https://www.php.net/manual/en/ibase.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"-1"'),                         // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_INTEGER),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_SYSTEM'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'The maximum number of Firebird/InterBase connections per process, including persistent connections.',
                                        'TEXT' => 'The maximum number of Firebird/InterBase connections per process, including persistent connections.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'ibase.default_db':
                    //Friday, November 10, 2023 @ 2056 hrs.
                    //ibase.default_db                          NULL                                                PHP_INI_SYSTEM

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ibase.configuration.php#ini.ibase.default-db',
                        'https://www.php.net/manual/en/ibase.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => 'NULL'),                         // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_SYSTEM'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'The default database to connect to when ibase_[p]connect() is called without specifying a database name. If this value is set and SQL safe mode is enabled, no other connections than to this database will be allowed.',
                                        'TEXT' => 'The default database to connect to when ibase_[p]connect() is called without specifying a database name. If this value is set and SQL safe mode is enabled, no other connections than to this database will be allowed.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'ibase.default_user':
                    //Friday, November 10, 2023 @ 2059 hrs.
                    //ibase.default_user                        NULL                                                PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ibase.configuration.php#ini.ibase.default-user',
                        'https://www.php.net/manual/en/ibase.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => 'NULL'),                         // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'The user name to use when connecting to a database if no user name is specified.',
                                        'TEXT' => 'The user name to use when connecting to a database if no user name is specified.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'ibase.default_password':
                    //Friday, November 10, 2023 @ 2104 hrs.
                    //ibase.default_password                    NULL                                                PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ibase.configuration.php#ini.ibase.default-password',
                        'https://www.php.net/manual/en/ibase.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => 'NULL'),                         // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'The password to use when connecting to a database if no password is specified.',
                                        'TEXT' => 'The password to use when connecting to a database if no password is specified.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'ibase.default_charset':
                    //Friday, November 10, 2023 @ 2104 hrs.
                    //ibase.default_charset                     NULL                                                PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ibase.configuration.php#ini.ibase.default-charset',
                        'https://www.php.net/manual/en/ibase.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => 'NULL'),                         // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'InterBase default charset.',
                                            'TEXT' => 'InterBase default charset.'
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'The character set to use when connecting to a database if no character set is specified.',
                                        'TEXT' => 'The character set to use when connecting to a database if no character set is specified.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'ibase.timestampformat':
                    //Friday, November 10, 2023 @ 2104 hrs.
                    //ibase.timestampformat                     "%Y-%m-%d %H:%M:%S"                                 PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ibase.configuration.php#ini.ibase.timestampformat',
                        'https://www.php.net/manual/en/ibase.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"%Y-%m-%d %H:%M:%S"'),          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'InterBase timestamp format.',
                                        'TEXT' => 'InterBase timestamp format.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'ibase.dateformat':
                    //Friday, November 10, 2023 @ 2112 hrs. 42 secs.
                    //ibase.dateformat                          "%Y-%m-%d"                                          PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ibase.configuration.php#ini.ibase.dateformat',
                        'https://www.php.net/manual/en/ibase.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"%Y-%m-%d"'),                   // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'InterBase date format.',
                                        'TEXT' => 'InterBase date format.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'ibase.timeformat':
                    //Friday, November 10, 2023 @ 2133 hrs.
                    //ibase.timeformat                          "%H:%M:%S"                                          PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ibase.configuration.php#ini.ibase.timeformat',
                        'https://www.php.net/manual/en/ibase.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"%H:%M:%S"'),                   // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'These directives are used to set the date and time formats that are used when returning dates and times from a result set, or when binding arguments to date and time parameters.',
                                        'TEXT' => 'These directives are used to set the date and time formats that are used when returning dates and times from a result set, or when binding arguments to date and time parameters.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'ibm_db2.binmode':
                    //Friday, November 10, 2023 @ 2138 hrs.
                    //ibm_db2.binmode                           "1"                                                 PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ibm-db2.configuration.php#ini.ibm-db2.binmode',
                        'https://www.php.net/manual/en/ibm-db2.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"1"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_INTEGER),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'This option controls the mode used for converting to and from binary data in the PHP application.

1 (DB2_BINARY)

2 (DB2_CONVERT)

3 (DB2_PASSTHRU)',
                                        'TEXT' => 'This option controls the mode used for converting to and from binary data in the PHP application.

1 (DB2_BINARY)

2 (DB2_CONVERT)

3 (DB2_PASSTHRU)'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'ibm_db2.i5_all_pconnect':
                    //Friday, November 10, 2023 @ 2157 hrs.
                    //ibm_db2.i5_all_pconnect                   "0"                                                 PHP_INI_SYSTEM              Available since ibm_db2 1.6.5.

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ibm-db2.configuration.php#ini.ibm-db2.i5-all-pconnect',
                        'https://www.php.net/manual/en/ibm-db2.configuration.php',
                        'https://www.php.net/manual/en/function.db2-connect.php',
                        'https://www.php.net/manual/en/function.db2-pconnect.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_INTEGER),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'This option overrides i5 ' . $this->oCRNRSTN->return_crnrstn_text_link('db2_connect', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.db2-connect.php') . ' full open and close in the PHP application. When ibm_db2.i5_all_pconnect = 1, all db2 connections become persistent (' . $this->oCRNRSTN->return_crnrstn_text_link('db2_pconnect', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.db2-pconnect.php') . '). On i5/OS, ' . $this->oCRNRSTN->return_crnrstn_text_link('db2_pconnect', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.db2-pconnect.php') . ' performs dramatically better with lower machine stress over ' . $this->oCRNRSTN->return_crnrstn_text_link('db2_connect', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.db2-connect.php') . '. This is a convenience override of ' . $this->oCRNRSTN->return_crnrstn_text_link('db2_connect', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.db2-connect.php') . ' to evoke ' . $this->oCRNRSTN->return_crnrstn_text_link('db2_pconnect', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.db2-pconnect.php') . ' without PHP source code changes.

0 ' . $this->oCRNRSTN->return_crnrstn_text_link('db2_connect', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.db2-connect.php') . ' default full open and close

1 ' . $this->oCRNRSTN->return_crnrstn_text_link('db2_connect', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.db2-connect.php') . ' override to ' . $this->oCRNRSTN->return_crnrstn_text_link('db2_pconnect', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.db2-pconnect.php') . ' for persistent connection only',
                                        'TEXT' => 'This option overrides i5 db2_connect() full open and close in the PHP application. When ibm_db2.i5_all_pconnect = 1, all db2 connections become persistent (db2_pconnect()). On i5/OS, db2_pconnect() performs dramatically better with lower machine stress over db2_connect(). This is a convenience override of db2_connect() to evoke db2_pconnect() without PHP source code changes.

0 db2_connect() default full open and close

1 db2_connect() override to db2_pconnect() for persistent connection only'

                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'ibm_db2.i5_allow_commit':
                    //Saturday, November 11, 2023 0306 hrs.
                    //ibm_db2.i5_allow_commit                   "0"                                                 PHP_INI_SYSTEM              Available since ibm_db2 1.4.9.

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ibm-db2.configuration.php#ini.ibm-db2.i5-allow-commit',
                        'https://www.php.net/manual/en/ibm-db2.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_INTEGER),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_SYSTEM'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'Available since ibm_db2 1.4.9.',
                                            'TEXT' => 'Available since ibm_db2 1.4.9.'
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'This option controls the isolation mode used for i5 schema collections in the PHP application (see i5_commit for override).

0 - commitment control is not used

1 - read uncommitted, dirty reads possible.

2 - read committed, dirty reads are not possible.

3 - repeatable read, dirty reads and non-repeatable reads are not possible

4 - serializeable, dirty reads, non-repeatable reads, and phantoms are not possible',
                                        'TEXT' => 'This option controls the isolation mode used for i5 schema collections in the PHP application (see i5_commit for override).

0 - commitment control is not used

1 - read uncommitted, dirty reads possible.

2 - read committed, dirty reads are not possible.

3 - repeatable read, dirty reads and non-repeatable reads are not possible

4 - serializeable, dirty reads, non-repeatable reads, and phantoms are not possible'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'ibm_db2.i5_dbcs_alloc':
                    //Saturday, November 11, 2023 0339 hrs.
                    //ibm_db2.i5_dbcs_alloc                     "0"                                                 PHP_INI_SYSTEM              Available since ibm_db2 1.5.0.

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ibm-db2.configuration.php#ini.ibm-db2.i5-dbcs-alloc',
                        'https://www.php.net/manual/en/ibm-db2.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_INTEGER),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_SYSTEM'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'Available since ibm_db2 1.5.0.',
                                            'TEXT' => 'Available since ibm_db2 1.5.0.'
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'This option controls the internal ibm_db2 allocation scheme for large DBCS column buffers.

0 no expanded allocations (see i5_dbcs_alloc for override)

1 use expanded allocations (see i5_dbcs_alloc for override)',
                                        'TEXT' => 'This option controls the internal ibm_db2 allocation scheme for large DBCS column buffers.

0 no expanded allocations (see i5_dbcs_alloc for override)

1 use expanded allocations (see i5_dbcs_alloc for override)'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'ibm_db2.instance_name':
                    //Saturday, November 11, 2023 0349 hrs.
                    //ibm_db2.instance_name                     NULL                                                PHP_INI_SYSTEM              Available since ibm_db2 1.0.2.

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ibm-db2.configuration.php#ini.ibm-db2.instance-name',
                        'https://www.php.net/manual/en/ibm-db2.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => 'NULL'),                         // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_SYSTEM'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'Available since ibm_db2 1.0.2.',
                                            'TEXT' => 'Available since ibm_db2 1.0.2.'
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'On Linux and UNIX operating systems, this option defines the name of the instance to use for cataloged database connections. If this option is set, its value overrides the DB2INSTANCE environment variable setting.

This option is ignored on Windows operating systems.',
                                        'TEXT' => 'On Linux and UNIX operating systems, this option defines the name of the instance to use for cataloged database connections. If this option is set, its value overrides the DB2INSTANCE environment variable setting.

This option is ignored on Windows operating systems.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'ibm_db2.i5_ignore_userid':
                    //Saturday, November 11, 2023 0358 hrs.
                    //ibm_db2.i5_ignore_userid                  "0"                                                 PHP_INI_SYSTEM              Available since ibm_db2 1.8.0.

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ibm-db2.configuration.php#ini.ibm-db2.i5-ignore-userid',
                        'https://www.php.net/manual/en/ibm-db2.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_INTEGER),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_SYSTEM'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'Available since ibm_db2 1.8.0.',
                                            'TEXT' => 'Available since ibm_db2 1.8.0.'
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'This option overrides i5 db2_(p)connect userid and password in the PHP application. When ibm_db2.i5_ignore_userid = 1, all db2 (p)connections become null userid and null password. Therefore Apache jobs connect with the current profile (NOBODY). Use of this override is only for simple DB2 based websites that never require profile switching and therefore can avoid all overhead of server mode additional QSQSRVR jobs. This is a convenience override of db2_(p)connect to set the userid and password values to null without PHP source code changes. This override can be used in combination with ibm_db2.i5_all_pconnect = 1.

0 db2_(p)connect with specified userid and password

1 db2_(p)connect override connect with null userid and null password',
                                        'TEXT' => 'This option overrides i5 db2_(p)connect userid and password in the PHP application. When ibm_db2.i5_ignore_userid = 1, all db2 (p)connections become null userid and null password. Therefore Apache jobs connect with the current profile (NOBODY). Use of this override is only for simple DB2 based websites that never require profile switching and therefore can avoid all overhead of server mode additional QSQSRVR jobs. This is a convenience override of db2_(p)connect to set the userid and password values to null without PHP source code changes. This override can be used in combination with ibm_db2.i5_all_pconnect = 1.

0 db2_(p)connect with specified userid and password

1 db2_(p)connect override connect with null userid and null password'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'iconv.input_encoding':
                    //Saturday, November 11, 2023 0427 hrs.
                    //iconv.input_encoding                      ""                                                  PHP_INI_ALL                 Deprecated in PHP 5.6.0.

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/iconv.configuration.php#ini.iconv.input-encoding',
                        'https://www.php.net/manual/en/iconv.configuration.php',
                        'https://www.php.net/manual/en/ini.core.php#ini.input-encoding',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '""'),                           // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'This feature has been DEPRECATED as of PHP 5.6.0. Relying on this feature is highly discouraged.',
                                            'TEXT' => 'This feature has been DEPRECATED as of PHP 5.6.0. Relying on this feature is highly discouraged.'
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '1'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => '5.6.0'),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'Deprecated in PHP 5.6.0.',
                                            'TEXT' => 'Deprecated in PHP 5.6.0.'
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'PHP 5.6 and later users should leave this empty and set ' . $this->oCRNRSTN->return_crnrstn_text_link('input_encoding', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/ini.core.php#ini.input-encoding') . ' instead.',
                                        'TEXT' => 'PHP 5.6 and later users should leave this empty and set input_encoding instead.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'iconv.output_encoding':
                    //Saturday, November 11, 2023 0456 hrs.
                    //iconv.output_encoding                     ""                                                  PHP_INI_ALL                 Deprecated in PHP 5.6.0.

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/iconv.configuration.php#ini.iconv.output-encoding',
                        'https://www.php.net/manual/en/iconv.configuration.php',
                        'https://www.php.net/manual/en/ini.core.php#ini.output-encoding',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '""'),                           // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'This feature has been DEPRECATED as of PHP 5.6.0. Relying on this feature is highly discouraged.',
                                            'TEXT' => 'This feature has been DEPRECATED as of PHP 5.6.0. Relying on this feature is highly discouraged.'
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '1'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => '5.6.0'),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'Deprecated in PHP 5.6.0.',
                                            'TEXT' => 'Deprecated in PHP 5.6.0.'
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'PHP 5.6 and later users should leave this empty and set ' . $this->oCRNRSTN->return_crnrstn_text_link('output_encoding', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/ini.core.php#ini.output-encoding') . ' instead.',
                                        'TEXT' => 'PHP 5.6 and later users should leave this empty and set output_encoding instead.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'iconv.internal_encoding':
                    //Saturday, November 11, 2023 0458 hrs.
                    //iconv.internal_encoding                   ""                                                  PHP_INI_ALL                 Deprecated in PHP 5.6.0.

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/iconv.configuration.php#ini.iconv.internal-encoding',
                        'https://www.php.net/manual/en/iconv.configuration.php',
                        'https://www.php.net/manual/en/ini.core.php#ini.default-charset',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '""'),                           // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'This feature has been DEPRECATED as of PHP 5.6.0. Relying on this feature is highly discouraged.',
                                            'TEXT' => 'This feature has been DEPRECATED as of PHP 5.6.0. Relying on this feature is highly discouraged.'
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '1'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => '5.6.0'),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => 'Deprecated in PHP 5.6.0.',
                                            'TEXT' => 'Deprecated in PHP 5.6.0.'
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'PHP 5.6 and later users should leave this empty and set ' . $this->oCRNRSTN->return_crnrstn_text_link('default_charset', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/ini.core.php#ini.default-charset') . ' instead.',
                                        'TEXT' => 'PHP 5.6 and later users should leave this empty and set default_charset instead.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'ignore_repeated_errors':
                    //Saturday, November 11, 2023 0827 hrs.
                    //ignore_repeated_errors                    "0"                                                 PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/errorfunc.configuration.php#ini.ignore-repeated-errors',
                        'https://www.php.net/manual/en/errorfunc.configuration.php',
                        'https://www.php.net/manual/en/errorfunc.configuration.php#ini.ignore-repeated-source',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Do not log repeated messages. Repeated errors must occur in the same file on the same line unless ' . $this->oCRNRSTN->return_crnrstn_text_link('ignore_repeated_source', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/errorfunc.configuration.php#ini.ignore-repeated-source') . ' is set true.',
                                        'TEXT' => 'Do not log repeated messages. Repeated errors must occur in the same file on the same line unless ignore_repeated_source is set true.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'ignore_repeated_source':
                    //Saturday, November 11, 2023 0828 hrs.
                    //ignore_repeated_source                    "0"                                                 PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/errorfunc.configuration.php#ini.ignore-repeated-source',
                        'https://www.php.net/manual/en/errorfunc.configuration.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Ignore source of message when ignoring repeated messages. When this setting is On you will not log errors with repeated messages from different files or sourcelines.',
                                        'TEXT' => 'Ignore source of message when ignoring repeated messages. When this setting is On you will not log errors with repeated messages from different files or sourcelines.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'ignore_user_abort':
                    //Saturday, November 11, 2023 0838 hrs.
                    //ignore_user_abort                         "0"                                                 PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/misc.configuration.php#ini.ignore-user-abort',
                        'https://www.php.net/manual/en/misc.configuration.php',
                        'https://www.php.net/manual/en/function.ignore-user-abort.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'false by default. If changed to true scripts will not be terminated after a client has aborted their connection.

See also ' . $this->oCRNRSTN->return_crnrstn_text_link('ignore_user_abort', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.ignore-user-abort.php') . '.',
                                        'TEXT' => 'false by default. If changed to true scripts will not be terminated after a client has aborted their connection.

See also ignore_user_abort().'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'implicit_flush':
                    //Saturday, November 11, 2023 0854 hrs.
                    //implicit_flush                            "0"                                                 PHP_INI_ALL

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/outcontrol.configuration.php#ini.implicit-flush',
                        'https://www.php.net/manual/en/outcontrol.configuration.php',
                        'https://www.php.net/manual/en/function.flush.php',
                        'https://www.php.net/manual/en/function.print.php',
                        'https://www.php.net/manual/en/function.echo.php',
                        'https://www.php.net/manual/en/function.ob-implicit-flush.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'false by default. Changing this to true tells PHP to tell the output layer to flush itself automatically after every output block. This is equivalent to calling the PHP function ' . $this->oCRNRSTN->return_crnrstn_text_link('flush', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.flush.php') . ' after each and every call to ' . $this->oCRNRSTN->return_crnrstn_text_link('print', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.print.php') . ' or ' . $this->oCRNRSTN->return_crnrstn_text_link('echo', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.echo.php') . ' and each and every HTML block.

When using PHP within an web environment, turning this option on has serious performance implications and is generally recommended for debugging purposes only. This value defaults to true when operating under the CLI SAPI.

See also ' . $this->oCRNRSTN->return_crnrstn_text_link('ob_implicit_flush', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.ob-implicit-flush.php') . '.',
                                        'TEXT' => 'false by default. Changing this to true tells PHP to tell the output layer to flush itself automatically after every output block. This is equivalent to calling the PHP function flush() after each and every call to print or echo and each and every HTML block.

When using PHP within an web environment, turning this option on has serious performance implications and is generally recommended for debugging purposes only. This value defaults to true when operating under the CLI SAPI.

See also ob_implicit_flush().'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'include_path':
                    //Saturday, November 11, 2023 xxxx hrs.
                    //include_path                              ".:/path/to/php/pear"                               PHP_INI_ALL
                    //' . $this->oCRNRSTN->return_crnrstn_text_link('0000000000_reporting', 'PHP_ELLIPSE', '000000000000000000000000000') . '

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(
                        'https://www.php.net/manual/en/ini.core.php#ini.include-path',
                        'https://www.php.net/manual/en/ini.core.php',
                        'https://www.php.net/manual/en/function.require.php',
                        'https://www.php.net/manual/en/function.include.php',
                        'https://www.php.net/manual/en/function.fopen.php',
                        'https://www.php.net/manual/en/function.file.php',
                        'https://www.php.net/manual/en/function.readfile.php',
                        'https://www.php.net/manual/en/function.file-get-contents.php',
                        'https://www.php.net/manual/en/function.set-include-path.php',
                        'https://www.php.net/manual/en/configuration.changes.modes.php'
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '".:/path/to/php/pear"'),        // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_STRING),                 // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => 'Specifies a list of directories where the ' . $this->oCRNRSTN->return_crnrstn_text_link('require', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.require.php') . ', ' . $this->oCRNRSTN->return_crnrstn_text_link('include', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.include.php') . ', ' . $this->oCRNRSTN->return_crnrstn_text_link('fopen', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.fopen.php') . ', ' . $this->oCRNRSTN->return_crnrstn_text_link('file', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.file.php') . ', ' . $this->oCRNRSTN->return_crnrstn_text_link('readfile', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.readfile.php') . ' and ' . $this->oCRNRSTN->return_crnrstn_text_link('file_get_contents', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.file-get-contents.php') . ' functions look for files. The format is like the system\'s PATH environment variable: a list of directories separated with a colon in Unix or semicolon in Windows.

PHP considers each entry in the include path separately when looking for files to include. It will check the first path, and if it doesn\'t find it, check the next path, until it either locates the included file or returns with an E_WARNING or an E_ERROR. You may modify or set your include path at runtime using ' . $this->oCRNRSTN->return_crnrstn_text_link('set_include_path', 'PHP_ELLIPSE', 'https://www.php.net/manual/en/function.set-include-path.php') . '.

Using a . in the include path allows for relative includes as it means the current directory. However, it is more efficient to explicitly use include \'./file\' than having PHP always check the current directory for every include.',
                                        'TEXT' => 'Specifies a list of directories where the require, include, fopen(), file(), readfile() and file_get_contents() functions look for files. The format is like the system\'s PATH environment variable: a list of directories separated with a colon in Unix or semicolon in Windows.

PHP considers each entry in the include path separately when looking for files to include. It will check the first path, and if it doesn\'t find it, check the next path, until it either locates the included file or returns with an E_WARNING or an E_ERROR. You may modify or set your include path at runtime using set_include_path().

Using a . in the include path allows for relative includes as it means the current directory. However, it is more efficient to explicitly use include \'./file\' than having PHP always check the current directory for every include.'
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'XXXXXXXXXX':
                    //Saturday, November 11, 2023 xxxx hrs.
                    //intl.default_locale                                                                           PHP_INI_ALL
                    //' . $this->oCRNRSTN->return_crnrstn_text_link('0000000000_reporting', 'PHP_ELLIPSE', '000000000000000000000000000') . '
                    //'CRNRSTN_INT', 'CRNRSTN_INTEGER', 'CRNRSTN_BOOL', 'CRNRSTN_BOOLEAN', 'CRNRSTN_FLOAT',
                    //'CRNRSTN_DOUBLE', 'CRNRSTN_RESOURCE', 'CRNRSTN_STRING', 'CRNRSTN_ARRAY', 'CRNRSTN_OBJECT'

                    error_log(__LINE__ . ' crnrstn PHP INI[' . $name . '] HAS UNCONFIRMED META "0" DATA TYPE. AM I CRNRSTN_BOOLEAN[' . print_r($tmp_current_data_type_ARRAY, true) . ']?');

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(''
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => '',
                                        'TEXT' => ''
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'XXXXXXXXXXX':
                    //Saturday, November 11, 2023 xxxx hrs.
                    //intl.error_level                          0                                                   PHP_INI_ALL
                    //' . $this->oCRNRSTN->return_crnrstn_text_link('0000000000_reporting', 'PHP_ELLIPSE', '000000000000000000000000000') . '
                    //'CRNRSTN_INT', 'CRNRSTN_INTEGER', 'CRNRSTN_BOOL', 'CRNRSTN_BOOLEAN', 'CRNRSTN_FLOAT',
                    //'CRNRSTN_DOUBLE', 'CRNRSTN_RESOURCE', 'CRNRSTN_STRING', 'CRNRSTN_ARRAY', 'CRNRSTN_OBJECT'

                    error_log(__LINE__ . ' crnrstn PHP INI[' . $name . '] HAS UNCONFIRMED META "0" DATA TYPE. AM I CRNRSTN_BOOLEAN[' . print_r($tmp_current_data_type_ARRAY, true) . ']?');

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(''
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => '',
                                        'TEXT' => ''
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'XXXXXXXXXXXX':
                    //Saturday, November 11, 2023 xxxx hrs.
                    //intl.use_exceptions                       0                                                   PHP_INI_ALL                 Available since PECL 3.0.0a1
                    //' . $this->oCRNRSTN->return_crnrstn_text_link('0000000000_reporting', 'PHP_ELLIPSE', '000000000000000000000000000') . '
                    //'CRNRSTN_INT', 'CRNRSTN_INTEGER', 'CRNRSTN_BOOL', 'CRNRSTN_BOOLEAN', 'CRNRSTN_FLOAT',
                    //'CRNRSTN_DOUBLE', 'CRNRSTN_RESOURCE', 'CRNRSTN_STRING', 'CRNRSTN_ARRAY', 'CRNRSTN_OBJECT'

                    error_log(__LINE__ . ' crnrstn PHP INI[' . $name . '] HAS UNCONFIRMED META "0" DATA TYPE. AM I CRNRSTN_BOOLEAN[' . print_r($tmp_current_data_type_ARRAY, true) . ']?');

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(''
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => '',
                                        'TEXT' => ''
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'XXXXXXXXXXXXX':
                    //Saturday, November 11, 2023 xxxx hrs.
                    //last_modified                             "0"                                                 PHP_INI_ALL
                    //' . $this->oCRNRSTN->return_crnrstn_text_link('0000000000_reporting', 'PHP_ELLIPSE', '000000000000000000000000000') . '
                    //'CRNRSTN_INT', 'CRNRSTN_INTEGER', 'CRNRSTN_BOOL', 'CRNRSTN_BOOLEAN', 'CRNRSTN_FLOAT',
                    //'CRNRSTN_DOUBLE', 'CRNRSTN_RESOURCE', 'CRNRSTN_STRING', 'CRNRSTN_ARRAY', 'CRNRSTN_OBJECT'

                    error_log(__LINE__ . ' crnrstn PHP INI[' . $name . '] HAS UNCONFIRMED META "0" DATA TYPE. AM I CRNRSTN_BOOLEAN[' . print_r($tmp_current_data_type_ARRAY, true) . ']?');

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(''
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => '',
                                        'TEXT' => ''
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'XXXXXXXXXXXXXXXX':
                    //Saturday, November 11, 2023 xxxx hrs.
                    //ldap.max_links                            "-1"                                                PHP_INI_SYSTEM
                    //' . $this->oCRNRSTN->return_crnrstn_text_link('0000000000_reporting', 'PHP_ELLIPSE', '000000000000000000000000000') . '
                    //'CRNRSTN_INT', 'CRNRSTN_INTEGER', 'CRNRSTN_BOOL', 'CRNRSTN_BOOLEAN', 'CRNRSTN_FLOAT',
                    //'CRNRSTN_DOUBLE', 'CRNRSTN_RESOURCE', 'CRNRSTN_STRING', 'CRNRSTN_ARRAY', 'CRNRSTN_OBJECT'

                    error_log(__LINE__ . ' crnrstn PHP INI[' . $name . '] HAS UNCONFIRMED META "0" DATA TYPE. AM I CRNRSTN_BOOLEAN[' . print_r($tmp_current_data_type_ARRAY, true) . ']?');

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(''
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => '',
                                        'TEXT' => ''
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'XXXXXXXXXXXXXXXXXXXXXX':
                    //Saturday, November 11, 2023 xxxx hrs.
                    //log_errors                                "0"                                                 PHP_INI_ALL
                    //' . $this->oCRNRSTN->return_crnrstn_text_link('0000000000_reporting', 'PHP_ELLIPSE', '000000000000000000000000000') . '
                    //'CRNRSTN_INT', 'CRNRSTN_INTEGER', 'CRNRSTN_BOOL', 'CRNRSTN_BOOLEAN', 'CRNRSTN_FLOAT',
                    //'CRNRSTN_DOUBLE', 'CRNRSTN_RESOURCE', 'CRNRSTN_STRING', 'CRNRSTN_ARRAY', 'CRNRSTN_OBJECT'

                    error_log(__LINE__ . ' crnrstn PHP INI[' . $name . '] HAS UNCONFIRMED META "0" DATA TYPE. AM I CRNRSTN_BOOLEAN[' . print_r($tmp_current_data_type_ARRAY, true) . ']?');

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(''
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => '',
                                        'TEXT' => ''
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'XXXXXXXXX0':
                    //Saturday, November 11, 2023 xxxx hrs.
                    //log_errors_max_len                        "1024"                                              PHP_INI_ALL
                    //' . $this->oCRNRSTN->return_crnrstn_text_link('0000000000_reporting', 'PHP_ELLIPSE', '000000000000000000000000000') . '
                    //'CRNRSTN_INT', 'CRNRSTN_INTEGER', 'CRNRSTN_BOOL', 'CRNRSTN_BOOLEAN', 'CRNRSTN_FLOAT',
                    //'CRNRSTN_DOUBLE', 'CRNRSTN_RESOURCE', 'CRNRSTN_STRING', 'CRNRSTN_ARRAY', 'CRNRSTN_OBJECT'

                    error_log(__LINE__ . ' crnrstn PHP INI[' . $name . '] HAS UNCONFIRMED META "0" DATA TYPE. AM I CRNRSTN_BOOLEAN[' . print_r($tmp_current_data_type_ARRAY, true) . ']?');

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(''
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => '',
                                        'TEXT' => ''
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'XXXXXXXXX9':
                    //Saturday, November 11, 2023 xxxx hrs.
                    //mail.add_x_header                         "0"                                                 PHP_INI_PERDIR
                    //' . $this->oCRNRSTN->return_crnrstn_text_link('0000000000_reporting', 'PHP_ELLIPSE', '000000000000000000000000000') . '
                    //'CRNRSTN_INT', 'CRNRSTN_INTEGER', 'CRNRSTN_BOOL', 'CRNRSTN_BOOLEAN', 'CRNRSTN_FLOAT',
                    //'CRNRSTN_DOUBLE', 'CRNRSTN_RESOURCE', 'CRNRSTN_STRING', 'CRNRSTN_ARRAY', 'CRNRSTN_OBJECT'

                    error_log(__LINE__ . ' crnrstn PHP INI[' . $name . '] HAS UNCONFIRMED META "0" DATA TYPE. AM I CRNRSTN_BOOLEAN[' . print_r($tmp_current_data_type_ARRAY, true) . ']?');

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(''
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => '',
                                        'TEXT' => ''
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'XXXXXXXXX8':
                    //Saturday, November 11, 2023 xxxx hrs.
                    //mail.force_extra_parameters               NULL                                                php.ini only
                    //' . $this->oCRNRSTN->return_crnrstn_text_link('0000000000_reporting', 'PHP_ELLIPSE', '000000000000000000000000000') . '
                    //'CRNRSTN_INT', 'CRNRSTN_INTEGER', 'CRNRSTN_BOOL', 'CRNRSTN_BOOLEAN', 'CRNRSTN_FLOAT',
                    //'CRNRSTN_DOUBLE', 'CRNRSTN_RESOURCE', 'CRNRSTN_STRING', 'CRNRSTN_ARRAY', 'CRNRSTN_OBJECT'

                    error_log(__LINE__ . ' crnrstn PHP INI[' . $name . '] HAS UNCONFIRMED META "0" DATA TYPE. AM I CRNRSTN_BOOLEAN[' . print_r($tmp_current_data_type_ARRAY, true) . ']?');

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(''
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => '',
                                        'TEXT' => ''
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'XXXXXXXXX7':
                    //Saturday, November 11, 2023 xxxx hrs.
                    //mail.log                                  ""                                                  PHP_INI_PERDIR
                    //' . $this->oCRNRSTN->return_crnrstn_text_link('0000000000_reporting', 'PHP_ELLIPSE', '000000000000000000000000000') . '
                    //'CRNRSTN_INT', 'CRNRSTN_INTEGER', 'CRNRSTN_BOOL', 'CRNRSTN_BOOLEAN', 'CRNRSTN_FLOAT',
                    //'CRNRSTN_DOUBLE', 'CRNRSTN_RESOURCE', 'CRNRSTN_STRING', 'CRNRSTN_ARRAY', 'CRNRSTN_OBJECT'

                    error_log(__LINE__ . ' crnrstn PHP INI[' . $name . '] HAS UNCONFIRMED META "0" DATA TYPE. AM I CRNRSTN_BOOLEAN[' . print_r($tmp_current_data_type_ARRAY, true) . ']?');

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(''
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => '',
                                        'TEXT' => ''
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'XXXXXXXXX6':
                    //Saturday, November 11, 2023 xxxx hrs.
                    //max_execution_time                        "30"                                                PHP_INI_ALL
                    //' . $this->oCRNRSTN->return_crnrstn_text_link('0000000000_reporting', 'PHP_ELLIPSE', '000000000000000000000000000') . '
                    //'CRNRSTN_INT', 'CRNRSTN_INTEGER', 'CRNRSTN_BOOL', 'CRNRSTN_BOOLEAN', 'CRNRSTN_FLOAT',
                    //'CRNRSTN_DOUBLE', 'CRNRSTN_RESOURCE', 'CRNRSTN_STRING', 'CRNRSTN_ARRAY', 'CRNRSTN_OBJECT'

                    error_log(__LINE__ . ' crnrstn PHP INI[' . $name . '] HAS UNCONFIRMED META "0" DATA TYPE. AM I CRNRSTN_BOOLEAN[' . print_r($tmp_current_data_type_ARRAY, true) . ']?');

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(''
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => '',
                                        'TEXT' => ''
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'XXXXXXXXX5':
                    //Saturday, November 11, 2023 xxxx hrs.
                    //max_input_nesting_level                   "64"                                                PHP_INI_PERDIR
                    //' . $this->oCRNRSTN->return_crnrstn_text_link('0000000000_reporting', 'PHP_ELLIPSE', '000000000000000000000000000') . '
                    //'CRNRSTN_INT', 'CRNRSTN_INTEGER', 'CRNRSTN_BOOL', 'CRNRSTN_BOOLEAN', 'CRNRSTN_FLOAT',
                    //'CRNRSTN_DOUBLE', 'CRNRSTN_RESOURCE', 'CRNRSTN_STRING', 'CRNRSTN_ARRAY', 'CRNRSTN_OBJECT'

                    error_log(__LINE__ . ' crnrstn PHP INI[' . $name . '] HAS UNCONFIRMED META "0" DATA TYPE. AM I CRNRSTN_BOOLEAN[' . print_r($tmp_current_data_type_ARRAY, true) . ']?');

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(''
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => '',
                                        'TEXT' => ''
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'XXXXXXXXX4':
                    //Saturday, November 11, 2023 xxxx hrs.
                    //max_input_vars                            1000                                                PHP_INI_PERDIR
                    //' . $this->oCRNRSTN->return_crnrstn_text_link('0000000000_reporting', 'PHP_ELLIPSE', '000000000000000000000000000') . '
                    //'CRNRSTN_INT', 'CRNRSTN_INTEGER', 'CRNRSTN_BOOL', 'CRNRSTN_BOOLEAN', 'CRNRSTN_FLOAT',
                    //'CRNRSTN_DOUBLE', 'CRNRSTN_RESOURCE', 'CRNRSTN_STRING', 'CRNRSTN_ARRAY', 'CRNRSTN_OBJECT'

                    error_log(__LINE__ . ' crnrstn PHP INI[' . $name . '] HAS UNCONFIRMED META "0" DATA TYPE. AM I CRNRSTN_BOOLEAN[' . print_r($tmp_current_data_type_ARRAY, true) . ']?');

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(''
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => '',
                                        'TEXT' => ''
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'XXXXXXXXX3':
                    //Saturday, November 11, 2023 xxxx hrs.
                    //max_input_time                            "-1"                                                PHP_INI_PERDIR
                    //' . $this->oCRNRSTN->return_crnrstn_text_link('0000000000_reporting', 'PHP_ELLIPSE', '000000000000000000000000000') . '
                    //'CRNRSTN_INT', 'CRNRSTN_INTEGER', 'CRNRSTN_BOOL', 'CRNRSTN_BOOLEAN', 'CRNRSTN_FLOAT',
                    //'CRNRSTN_DOUBLE', 'CRNRSTN_RESOURCE', 'CRNRSTN_STRING', 'CRNRSTN_ARRAY', 'CRNRSTN_OBJECT'

                    error_log(__LINE__ . ' crnrstn PHP INI[' . $name . '] HAS UNCONFIRMED META "0" DATA TYPE. AM I CRNRSTN_BOOLEAN[' . print_r($tmp_current_data_type_ARRAY, true) . ']?');

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(''
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => '',
                                        'TEXT' => ''
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'XXXXXXXXX2':
                    //Saturday, November 11, 2023 xxxx hrs.
                    //mbstring.language                         "neutral"                                           PHP_INI_ALL
                    //' . $this->oCRNRSTN->return_crnrstn_text_link('0000000000_reporting', 'PHP_ELLIPSE', '000000000000000000000000000') . '
                    //'CRNRSTN_INT', 'CRNRSTN_INTEGER', 'CRNRSTN_BOOL', 'CRNRSTN_BOOLEAN', 'CRNRSTN_FLOAT',
                    //'CRNRSTN_DOUBLE', 'CRNRSTN_RESOURCE', 'CRNRSTN_STRING', 'CRNRSTN_ARRAY', 'CRNRSTN_OBJECT'

                    error_log(__LINE__ . ' crnrstn PHP INI[' . $name . '] HAS UNCONFIRMED META "0" DATA TYPE. AM I CRNRSTN_BOOLEAN[' . print_r($tmp_current_data_type_ARRAY, true) . ']?');

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(''
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => '',
                                        'TEXT' => ''
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'XXXXXXXXX1':
                    //Saturday, November 11, 2023 xxxx hrs.
                    //mbstring.detect_order                 NULL                                                PHP_INI_ALL
                    //' . $this->oCRNRSTN->return_crnrstn_text_link('0000000000_reporting', 'PHP_ELLIPSE', '000000000000000000000000000') . '
                    //'CRNRSTN_INT', 'CRNRSTN_INTEGER', 'CRNRSTN_BOOL', 'CRNRSTN_BOOLEAN', 'CRNRSTN_FLOAT',
                    //'CRNRSTN_DOUBLE', 'CRNRSTN_RESOURCE', 'CRNRSTN_STRING', 'CRNRSTN_ARRAY', 'CRNRSTN_OBJECT'

                    error_log(__LINE__ . ' crnrstn PHP INI[' . $name . '] HAS UNCONFIRMED META "0" DATA TYPE. AM I CRNRSTN_BOOLEAN[' . print_r($tmp_current_data_type_ARRAY, true) . ']?');

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(''
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => '',
                                        'TEXT' => ''
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'XXXXXXXXX00':
                    //Saturday, November 11, 2023 xxxx hrs.
                    //mbstring.http_input                       "pass"                                              PHP_INI_ALL                 Deprecated
                    //' . $this->oCRNRSTN->return_crnrstn_text_link('0000000000_reporting', 'PHP_ELLIPSE', '000000000000000000000000000') . '
                    //'CRNRSTN_INT', 'CRNRSTN_INTEGER', 'CRNRSTN_BOOL', 'CRNRSTN_BOOLEAN', 'CRNRSTN_FLOAT',
                    //'CRNRSTN_DOUBLE', 'CRNRSTN_RESOURCE', 'CRNRSTN_STRING', 'CRNRSTN_ARRAY', 'CRNRSTN_OBJECT'

                    error_log(__LINE__ . ' crnrstn PHP INI[' . $name . '] HAS UNCONFIRMED META "0" DATA TYPE. AM I CRNRSTN_BOOLEAN[' . print_r($tmp_current_data_type_ARRAY, true) . ']?');

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(''
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => '',
                                        'TEXT' => ''
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'XXXXXXXXX99':
                    //
                    //mbstring.http_output                  "pass"                                              PHP_INI_ALL                 Deprecated
                    //' . $this->oCRNRSTN->return_crnrstn_text_link('0000000000_reporting', 'PHP_ELLIPSE', '000000000000000000000000000') . '
                    //'CRNRSTN_INT', 'CRNRSTN_INTEGER', 'CRNRSTN_BOOL', 'CRNRSTN_BOOLEAN', 'CRNRSTN_FLOAT',
                    //'CRNRSTN_DOUBLE', 'CRNRSTN_RESOURCE', 'CRNRSTN_STRING', 'CRNRSTN_ARRAY', 'CRNRSTN_OBJECT'

                    error_log(__LINE__ . ' crnrstn PHP INI[' . $name . '] HAS UNCONFIRMED META "0" DATA TYPE. AM I CRNRSTN_BOOLEAN[' . print_r($tmp_current_data_type_ARRAY, true) . ']?');

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(''
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => '',
                                        'TEXT' => ''
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'XXXXXXXXX88':
                    //
                    //mbstring.internal_encoding                NULL                                                PHP_INI_ALL                 Deprecated
                    //' . $this->oCRNRSTN->return_crnrstn_text_link('0000000000_reporting', 'PHP_ELLIPSE', '000000000000000000000000000') . '
                    //'CRNRSTN_INT', 'CRNRSTN_INTEGER', 'CRNRSTN_BOOL', 'CRNRSTN_BOOLEAN', 'CRNRSTN_FLOAT',
                    //'CRNRSTN_DOUBLE', 'CRNRSTN_RESOURCE', 'CRNRSTN_STRING', 'CRNRSTN_ARRAY', 'CRNRSTN_OBJECT'

                    error_log(__LINE__ . ' crnrstn PHP INI[' . $name . '] HAS UNCONFIRMED META "0" DATA TYPE. AM I CRNRSTN_BOOLEAN[' . print_r($tmp_current_data_type_ARRAY, true) . ']?');

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(''
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => '',
                                        'TEXT' => ''
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'XXXXXXXXX77':
                    //
                    //mbstring.substitute_character         NULL                                                PHP_INI_ALL
                    //' . $this->oCRNRSTN->return_crnrstn_text_link('0000000000_reporting', 'PHP_ELLIPSE', '000000000000000000000000000') . '
                    //'CRNRSTN_INT', 'CRNRSTN_INTEGER', 'CRNRSTN_BOOL', 'CRNRSTN_BOOLEAN', 'CRNRSTN_FLOAT',
                    //'CRNRSTN_DOUBLE', 'CRNRSTN_RESOURCE', 'CRNRSTN_STRING', 'CRNRSTN_ARRAY', 'CRNRSTN_OBJECT'

                    error_log(__LINE__ . ' crnrstn PHP INI[' . $name . '] HAS UNCONFIRMED META "0" DATA TYPE. AM I CRNRSTN_BOOLEAN[' . print_r($tmp_current_data_type_ARRAY, true) . ']?');

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(''
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => '',
                                        'TEXT' => ''
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'XXXXXXXXX66':
                    //
                    //mbstring.func_overload                    "0"                                                 PHP_INI_SYSTEM              Deprecated as of PHP 7.2.0; removed as of PHP 8.0.0.
                    //' . $this->oCRNRSTN->return_crnrstn_text_link('0000000000_reporting', 'PHP_ELLIPSE', '000000000000000000000000000') . '
                    //'CRNRSTN_INT', 'CRNRSTN_INTEGER', 'CRNRSTN_BOOL', 'CRNRSTN_BOOLEAN', 'CRNRSTN_FLOAT',
                    //'CRNRSTN_DOUBLE', 'CRNRSTN_RESOURCE', 'CRNRSTN_STRING', 'CRNRSTN_ARRAY', 'CRNRSTN_OBJECT'

                    error_log(__LINE__ . ' crnrstn PHP INI[' . $name . '] HAS UNCONFIRMED META "0" DATA TYPE. AM I CRNRSTN_BOOLEAN[' . print_r($tmp_current_data_type_ARRAY, true) . ']?');

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(''
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => '',
                                        'TEXT' => ''
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;
                case 'XXXXXXXXX55':
                    //XXXXXXXXX                                 "0"                                                 PHP_INI_ALL
                    //' . $this->oCRNRSTN->return_crnrstn_text_link('0000000000_reporting', 'PHP_ELLIPSE', '000000000000000000000000000') . '
                    //'CRNRSTN_INT', 'CRNRSTN_INTEGER', 'CRNRSTN_BOOL', 'CRNRSTN_BOOLEAN', 'CRNRSTN_FLOAT',
                    //'CRNRSTN_DOUBLE', 'CRNRSTN_RESOURCE', 'CRNRSTN_STRING', 'CRNRSTN_ARRAY', 'CRNRSTN_OBJECT'

                    error_log(__LINE__ . ' crnrstn PHP INI[' . $name . '] HAS UNCONFIRMED META "0" DATA TYPE. AM I CRNRSTN_BOOLEAN[' . print_r($tmp_current_data_type_ARRAY, true) . ']?');

                    //
                    // RELATED RESOURCES URLS.
                    $tmp_url_ARRAY = array(''
                    );

                    $tmp_php_ini_option_ARRAY =
                        array(
                            array($tmp_name_lower               => $tmp_name_lower),
                            array('DEFAULT_VALUE'               => '"0"'),                          // PER PHP.NET.
                            array('DEFAULT_VALUE_DATA_TYPE'     => CRNRSTN_BOOLEAN),                // PER PHP.NET.
                            array('CURRENT_VALUE'               => $option_data),
                            array('CURRENT_VALUE_DATA_TYPE'     => $tmp_current_data_type_ARRAY),
                            array('CHANGE_MODE'                 => 'PHP_INI_ALL'),
                            array('NAME'                        => $tmp_name_lower),
                            array('OPTION_NOTE'                 => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_WARNING'              => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('OPTION_TIP'                  => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('IS_DEPRECATED'               => '0'),                            // 1 = DEPRECATED.
                            array('IS_REMOVED'                  => '0'),                            // 1 = REMOVED.
                            array('REMOVED_PHP_VERSION'         => ''),
                            array('DEPRECATED_PHP_VERSION'      => ''),
                            array('SUPPORTED_PHP_VERSION'       => ''),
                            array('PHP_VERSION_NOTE'            => array(
                                array(
                                    'en' =>
                                        array(
                                            'HTML' => '',
                                            'TEXT' => ''
                                        )))),
                            array('DESCRIPTION_PHP_NET'         => array(
                                'en' =>
                                    array(
                                        'HTML' => '',
                                        'TEXT' => ''
                                    ))),
                            array('RELATED_RESOURCES'           => $tmp_url_ARRAY)
                        );

                break;

                /*
                List of php.ini sections »« php.ini directives
                PHP Manual Appendices php.ini directives

                List of php.ini directives ¶
                This list includes the php.ini directives you can set to configure your PHP setup.

                The "Changeable" column shows the modes determining when and where a directive may be set. See the Changeable mode values section for their definitions.

                Configuration options
                Name                                    Default                                             Changeable                  Changelog
                -----

                mbstring.encoding_translation           "0"                                                 PHP_INI_PERDIR
                mbstring.http_output_conv_mimetypes     "^(text/|application/xhtml\+xml)"                   PHP_INI_ALL
                mbstring.strict_detection               "0"                                                 PHP_INI_ALL
                mbstring.regex_retry_limit              "1000000"                                           PHP_INI_ALL                 Available as of PHP 7.4.0.
                mbstring.regex_stack_limit              "100000"                                            PHP_INI_ALL                 Available as of PHP 7.3.5.
                mcrypt.algorithms_dir                   null                                                PHP_INI_ALL
                mcrypt.modes_dir                        null                                                PHP_INI_ALL
                memcache.allow_failover                 "1"                                                 PHP_INI_ALL                 Available since memcache 2.0.2.
                memcache.max_failover_attempts          "20"                                                PHP_INI_ALL                 Available since memcache 2.1.0.
                memcache.chunk_size                     "8192"                                              PHP_INI_ALL                 Available since memcache 2.0.2.
                memcache.default_port                   "11211"                                             PHP_INI_ALL                 Available since memcache 2.0.2.
                memcache.hash_strategy                  "standard"                                          PHP_INI_ALL                 Available since memcache 2.2.0.
                memcache.hash_function                  "crc32"                                             PHP_INI_ALL                 Available since memcache 2.2.0.
                memcache.protocol                       ascii   >                                           PHP_INI_ALL                 Supported since memcache 3.0.0
                memcache.redundancy                     1   >                                               PHP_INI_ALL                 Supported since memcache 3.0.0
                memcache.session_redundancy             2   >                                               PHP_INI_ALL                 Supported since memcache 3.0.0
                memcache.compress_threshold             20000   >                                           PHP_INI_ALL                 Supported since memcache 3.0.3
                memcache.lock_timeout                   15  >                                               PHP_INI_ALL                 Supported since memcache 3.0.4
                memory_limit                            "128M"                                              PHP_INI_ALL
                mysql.allow_local_infile                "1"                                                 PHP_INI_SYSTEM
                mysql.allow_persistent                  "1"                                                 PHP_INI_SYSTEM
                mysql.max_persistent                    "-1"                                                PHP_INI_SYSTEM
                mysql.max_links                         "-1"                                                PHP_INI_SYSTEM
                mysql.trace_mode                        "0"                                                 PHP_INI_ALL
                mysql.default_port                      NULL                                                PHP_INI_ALL
                mysql.default_socket                    NULL                                                PHP_INI_ALL
                mysql.default_host                      NULL                                                PHP_INI_ALL
                mysql.default_user                      NULL                                                PHP_INI_ALL
                mysql.default_password                  NULL                                                PHP_INI_ALL
                mysql.connect_timeout                   "60"                                                PHP_INI_ALL
                mysqli.allow_local_infile               "0"                                                 PHP_INI_SYSTEM              Before PHP 7.2.16 and 7.3.3 the default was "1".
                mysqli.local_infile_directory                                                               PHP_INI_SYSTEM              Available as of PHP 8.1.0.
                mysqli.allow_persistent                 "1"                                                 PHP_INI_SYSTEM
                mysqli.max_persistent                   "-1"                                                PHP_INI_SYSTEM
                mysqli.max_links                        "-1"                                                PHP_INI_SYSTEM
                mysqli.default_port                     "3306"                                              PHP_INI_ALL
                mysqli.default_socket                   NULL                                                PHP_INI_ALL
                mysqli.default_host                     NULL                                                PHP_INI_ALL
                mysqli.default_user                     NULL                                                PHP_INI_ALL
                mysqli.default_pw                       NULL                                                PHP_INI_ALL
                mysqli.reconnect                        "0"                                                 PHP_INI_SYSTEM              Removed as of PHP 8.2.0
                mysqli.rollback_on_cached_plink         "0"                                                 PHP_INI_SYSTEM
                mysqlnd.collect_statistics              "1"                                                 PHP_INI_SYSTEM
                mysqlnd.collect_memory_statistics       "0"                                                 PHP_INI_SYSTEM
                mysqlnd.debug                           ""                                                  PHP_INI_SYSTEM
                mysqlnd.log_mask                        0                                                   PHP_INI_ALL
                mysqlnd.mempool_default_size            16000                                               PHP_INI_ALL
                mysqlnd.net_read_timeout                "86400"                                             PHP_INI_ALL                 Before PHP 7.2.0 the default value was "31536000" and the changeability was PHP_INI_SYSTEM
                mysqlnd.net_cmd_buffer_size             "4096"                                              PHP_INI_SYSTEM
                mysqlnd.net_read_buffer_size            "32768"                                             PHP_INI_SYSTEM
                mysqlnd.sha256_server_public_key        ""                                                  PHP_INI_PERDIR
                mysqlnd.trace_alloc                     ""                                                  PHP_INI_SYSTEM
                mysqlnd.fetch_data_copy                 0                                                   PHP_INI_ALL                 Removed as of PHP 8.1.0
                oci8.connection_class                   ""                                                  PHP_INI_ALL
                oci8.default_prefetch                   "100"                                               PHP_INI_SYSTEM
                oci8.events                             Off                                                 PHP_INI_SYSTEM
                oci8.max_persistent                     "-1"                                                PHP_INI_SYSTEM
                oci8.old_oci_close_semantics            Off                                                 PHP_INI_SYSTEM              Deprecated as of PHP 8.1.0.
                oci8.persistent_timeout                 "-1"                                                PHP_INI_SYSTEM
                oci8.ping_interval                      "60"                                                PHP_INI_SYSTEM
                oci8.prefetch_lob_size                  "0"                                                 PHP_INI_SYSTEM              Available since PECL OCI8 3.2.
                oci8.privileged_connect                 Off                                                 PHP_INI_SYSTEM
                oci8.statement_cache_size               "20"                                                PHP_INI_SYSTEM
                odbc.default_db *                       NULL                                                PHP_INI_ALL
                odbc.default_user *                     NULL                                                PHP_INI_ALL
                odbc.default_pw *                       NULL                                                PHP_INI_ALL
                odbc.allow_persistent                   "1"                                                 PHP_INI_SYSTEM
                odbc.check_persistent                   "1"                                                 PHP_INI_SYSTEM
                odbc.max_persistent                     "-1"                                                PHP_INI_SYSTEM
                odbc.max_links                          "-1"                                                PHP_INI_SYSTEM
                odbc.defaultlrl                         "4096"                                              PHP_INI_ALL
                odbc.defaultbinmode                     "1"                                                 PHP_INI_ALL
                odbc.default_cursortype                 "3"                                                 PHP_INI_ALL
                opcache.enable                          "1"                                                 PHP_INI_ALL
                opcache.enable_cli                      "0"                                                 PHP_INI_SYSTEM              Between PHP 7.1.2 and 7.1.6 inclusive, the default was "1"
                opcache.memory_consumption              "128"                                               PHP_INI_SYSTEM
                opcache.interned_strings_buffer         "8"                                                 PHP_INI_SYSTEM
                opcache.max_accelerated_files           "10000"                                             PHP_INI_SYSTEM
                opcache.max_wasted_percentage           "5"                                                 PHP_INI_SYSTEM
                opcache.use_cwd                         "1"                                                 PHP_INI_SYSTEM
                opcache.validate_timestamps             "1"                                                 PHP_INI_ALL
                opcache.revalidate_freq                 "2"                                                 PHP_INI_ALL
                opcache.revalidate_path                 "0"                                                 PHP_INI_ALL
                opcache.save_comments                   "1"                                                 PHP_INI_SYSTEM
                opcache.fast_shutdown                   "0"                                                 PHP_INI_SYSTEM              Removed in PHP 7.2.0
                opcache.enable_file_override            "0"                                                 PHP_INI_SYSTEM
                opcache.optimization_level              "0x7FFEBFFF"                                        PHP_INI_SYSTEM              Changed from 0x7FFFBFFF in PHP 7.3.0
                opcache.inherited_hack                  "1"                                                 PHP_INI_SYSTEM              Removed in PHP 7.3.0
                opcache.dups_fix                        "0"                                                 PHP_INI_ALL
                opcache.blacklist_filename              ""                                                  PHP_INI_SYSTEM
                opcache.max_file_size                   "0"                                                 PHP_INI_SYSTEM
                opcache.consistency_checks              "0"                                                 PHP_INI_ALL
                opcache.force_restart_timeout           "180"                                               PHP_INI_SYSTEM
                opcache.error_log                       ""                                                  PHP_INI_SYSTEM
                opcache.log_verbosity_level             "1"                                                 PHP_INI_SYSTEM
                opcache.record_warnings                 "0"                                                 PHP_INI_SYSTEM              Available as of PHP 8.0.0
                opcache.preferred_memory_model          ""                                                  PHP_INI_SYSTEM
                opcache.protect_memory                  "0"                                                 PHP_INI_SYSTEM
                opcache.mmap_base                       null                                                PHP_INI_SYSTEM
                opcache.restrict_api                    ""                                                  PHP_INI_SYSTEM
                opcache.file_update_protection          "2"                                                 PHP_INI_ALL
                opcache.huge_code_pages                 "0"                                                 PHP_INI_SYSTEM
                opcache.lockfile_path                   "/tmp"                                              PHP_INI_SYSTEM
                opcache.opt_debug_level                 "0"                                                 PHP_INI_SYSTEM              Available as of PHP 7.1.0
                opcache.file_cache                      NULL                                                PHP_INI_SYSTEM
                opcache.file_cache_only                 "0"                                                 PHP_INI_SYSTEM
                opcache.file_cache_consistency_checks   "1"                                                 PHP_INI_SYSTEM
                opcache.file_cache_fallback             "1"                                                 PHP_INI_SYSTEM              Windows only.
                opcache.validate_permission             "0"                                                 PHP_INI_SYSTEM              Available as of PHP 7.0.14
                opcache.validate_root                   "0"                                                 PHP_INI_SYSTEM              Available as of PHP 7.0.14
                opcache.preload                         ""                                                  PHP_INI_SYSTEM              Available as of PHP 7.4.0
                opcache.preload_user                    ""                                                  PHP_INI_SYSTEM              Available as of PHP 7.4.0
                opcache.cache_id                        ""                                                  PHP_INI_SYSTEM              Windows only. Available as of PHP 7.4.0
                opcache.jit                             "tracing"                                           PHP_INI_ALL                 Available as of PHP 8.0.0
                opcache.jit_buffer_size                 "0"                                                 PHP_INI_SYSTEM              Available as of PHP 8.0.0
                opcache.jit_debug                       "0"                                                 PHP_INI_ALL                 Available as of PHP 8.0.0
                opcache.jit_bisect_limit                "0"                                                 PHP_INI_ALL                 Available as of PHP 8.0.0
                opcache.jit_prof_threshold              "0.005"                                             PHP_INI_ALL                 Available as of PHP 8.0.0
                opcache.jit_max_root_traces             "1024"                                              PHP_INI_SYSTEM              Available as of PHP 8.0.0
                opcache.jit_max_side_traces             "128"                                               PHP_INI_SYSTEM              Available as of PHP 8.0.0
                opcache.jit_max_exit_counters           "8192"                                              PHP_INI_SYSTEM              Available as of PHP 8.0.0
                opcache.jit_hot_loop                    "64"                                                PHP_INI_SYSTEM              Available as of PHP 8.0.0
                opcache.jit_hot_func                    "127"                                               PHP_INI_SYSTEM              Available as of PHP 8.0.0
                opcache.jit_hot_return                  "8"                                                 PHP_INI_SYSTEM              Available as of PHP 8.0.0
                opcache.jit_hot_side_exit               "8"                                                 PHP_INI_SYSTEM              Available as of PHP 8.0.0
                opcache.jit_blacklist_root_trace        "16"                                                PHP_INI_ALL                 Available as of PHP 8.0.0
                opcache.jit_blacklist_side_trace        "8"                                                 PHP_INI_ALL                 Available as of PHP 8.0.0
                opcache.jit_max_loop_unrolls            "8"                                                 PHP_INI_ALL                 Available as of PHP 8.0.0
                opcache.jit_max_recursive_calls         "2"                                                 PHP_INI_ALL                 Available as of PHP 8.0.0
                opcache.jit_max_recursive_returns       "2"                                                 PHP_INI_ALL                 Available as of PHP 8.0.0
                opcache.jit_max_polymorphic_calls       "2"                                                 PHP_INI_ALL                 Available as of PHP 8.0.0
                open_basedir                            NULL                                                PHP_INI_ALL
                output_buffering                        "0"                                                 PHP_INI_PERDIR
                output_handler                          NULL                                                PHP_INI_PERDIR
                pcre.backtrack_limit                    "1000000"                                           PHP_INI_ALL
                pcre.recursion_limit                    "100000"                                            PHP_INI_ALL
                pcre.jit                                "1"                                                 PHP_INI_ALL
                pdo.dsn.*                                                                                   php.ini only
                pdo_odbc.connection_pooling             "strict"                                            PHP_INI_ALL
                pdo_odbc.db2_instance_name              NULL                                                PHP_INI_SYSTEM              This deprecated feature will certainly be removed in the future.
                pgsql.allow_persistent                  "1"                                                 PHP_INI_SYSTEM
                pgsql.max_persistent                    "-1"                                                PHP_INI_SYSTEM
                pgsql.max_links                         "-1"                                                PHP_INI_SYSTEM
                pgsql.auto_reset_persistent             "0"                                                 PHP_INI_SYSTEM
                pgsql.ignore_notice                     "0"                                                 PHP_INI_ALL
                pgsql.log_notice                        "0"                                                 PHP_INI_ALL
                phar.readonly                           "1"                                                 PHP_INI_ALL
                phar.require_hash                       "1"                                                 PHP_INI_ALL
                phar.cache_list                         ""                                                  PHP_INI_SYSTEM
                post_max_size                           "8M"                                                PHP_INI_PERDIR
                precision                               "14"                                                PHP_INI_ALL
                realpath_cache_size                     "16K"                                               PHP_INI_SYSTEM
                realpath_cache_ttl                      "120"                                               PHP_INI_SYSTEM
                register_argc_argv                      "1"                                                 PHP_INI_PERDIR
                report_memleaks                         "1"                                                 PHP_INI_ALL
                report_zend_debug                       "1"                                                 PHP_INI_ALL
                request_order                           ""                                                  PHP_INI_PERDIR
                runkit.superglobal                      ""                                                  PHP_INI_PERDIR
                runkit.internal_override                "0"                                                 PHP_INI_SYSTEM
                sendmail_from                           NULL                                                PHP_INI_ALL
                sendmail_path                           "/usr/sbin/sendmail -t -i"                          PHP_INI_SYSTEM
                serialize_precision                     "-1"                                                PHP_INI_ALL                 Prior to PHP 7.1.0, the default value was 17.
                session.save_path                       ""                                                  PHP_INI_ALL
                session.name                            "PHPSESSID"                                         PHP_INI_ALL
                session.save_handler                    "files"                                             PHP_INI_ALL
                session.auto_start                      "0"                                                 PHP_INI_PERDIR
                session.gc_probability                  "1"                                                 PHP_INI_ALL
                session.gc_divisor                      "100"                                               PHP_INI_ALL
                session.gc_maxlifetime                  "1440"                                              PHP_INI_ALL
                session.serialize_handler               "php"                                               PHP_INI_ALL
                session.cookie_lifetime                 "0"                                                 PHP_INI_ALL
                session.cookie_path                     "/"                                                 PHP_INI_ALL
                session.cookie_domain                   ""                                                  PHP_INI_ALL
                session.cookie_secure                   "0"                                                 PHP_INI_ALL                 Prior to PHP 7.2.0, the default was "".
                session.cookie_httponly                 "0"                                                 PHP_INI_ALL                 Prior to PHP 7.2.0, the default was "".
                session.cookie_samesite                 ""                                                  PHP_INI_ALL                 Available as of PHP 7.3.0.
                session.use_strict_mode                 "0"                                                 PHP_INI_ALL
                session.use_cookies                     "1"                                                 PHP_INI_ALL
                session.use_only_cookies                "1"                                                 PHP_INI_ALL
                session.referer_check                   ""                                                  PHP_INI_ALL
                session.cache_limiter                   "nocache"                                           PHP_INI_ALL
                session.cache_expire                    "180"                                               PHP_INI_ALL
                session.use_trans_sid                   "0"                                                 PHP_INI_ALL
                session.trans_sid_tags                  "a=href,area=href,frame=src,form="                  PHP_INI_ALL                 Available as of PHP 7.1.0.
                session.trans_sid_hosts                 $_SERVER['HTTP_HOST']                               PHP_INI_ALL                 Available as of PHP 7.1.0.
                session.sid_length                      "32"                                                PHP_INI_ALL                 Available as of PHP 7.1.0.
                session.sid_bits_per_character          "4"                                                 PHP_INI_ALL                 Available as of PHP 7.1.0.
                session.upload_progress.enabled         "1"                                                 PHP_INI_PERDIR
                session.upload_progress.cleanup         "1"                                                 PHP_INI_PERDIR
                session.upload_progress.prefix          "upload_progress_"                                  PHP_INI_PERDIR
                session.upload_progress.name            "PHP_SESSION_UPLOAD_PROGRESS"                       PHP_INI_PERDIR
                session.upload_progress.freq            "1%"                                                PHP_INI_PERDIR
                session.upload_progress.min_freq        "1"                                                 PHP_INI_PERDIR
                session.lazy_write                      "1"                                                 PHP_INI_ALL
                session.hash_function                   "0"                                                 PHP_INI_ALL                 Removed as of PHP 7.1.0.
                session.hash_bits_per_character         "4"                                                 PHP_INI_ALL                 Removed as of PHP 7.1.0.
                session.entropy_file                    ""                                                  PHP_INI_ALL                 Removed as of PHP 7.1.0.
                session.entropy_length                  "0"                                                 PHP_INI_ALL                 Removed as of PHP 7.1.0
                short_open_tag                          "1"                                                 PHP_INI_PERDIR
                SMTP                                    "localhost"                                         PHP_INI_ALL
                smtp_port                               "25"                                                PHP_INI_ALL
                soap.wsdl_cache_enabled                 1                                                   PHP_INI_ALL
                soap.wsdl_cache_dir                     /tmp                                                PHP_INI_ALL
                soap.wsdl_cache_ttl                     86400                                               PHP_INI_ALL
                soap.wsdl_cache                         1                                                   PHP_INI_ALL
                soap.wsdl_cache_limit                   5                                                   PHP_INI_ALL
                sql.safe_mode                           "0"                                                 PHP_INI_SYSTEM
                sqlite3.extension_dir                   ""                                                  PHP_INI_SYSTEM
                sqlite3.defensive                       1                                                   PHP_INI_USER                Available as of PHP 7.2.17 and 7.3.4 for libsqlite ≥ 3.26.0. Prior to PHP 8.2.0 this setting was changeable only as PHP_INI_SYSTEM.
                syslog.facility                         "LOG_USER"                                          PHP_INI_SYSTEM              Available as of PHP 7.3.0.
                syslog.filter                           "no-ctrl"                                           PHP_INI_ALL                 Available as of PHP 7.3.0.
                syslog.ident                            "php"                                               PHP_INI_SYSTEM              Available as of PHP 7.3.0.
                sys_temp_dir                            ""                                                  PHP_INI_SYSTEM
                sysvshm.init_mem                        10000                                               PHP_INI_SYSTEM
                tidy.default_config                     ""                                                  PHP_INI_SYSTEM
                tidy.clean_output                       "0"                                                 PHP_INI_USER
                track_errors                            "0"                                                 PHP_INI_ALL                 Deprecated as of PHP 7.2.0, removed as of PHP 8.0.0
                unserialize_callback_func               null                                                PHP_INI_ALL
                unserialize_max_depth                   "4096"                                              PHP_INI_ALL                 Available as of PHP 7.4.0.
                uploadprogress.file.filename_template   "/tmp/upt_%s.txt"                                   PHP_INI_ALL
                upload_max_filesize                     "2M"                                                PHP_INI_PERDIR
                max_file_uploads                        20                                                  PHP_INI_SYSTEM
                upload_tmp_dir                          NULL                                                PHP_INI_SYSTEM
                url_rewriter.tags                       "a=href,area=href,frame=src,form=,fieldset="        PHP_INI_ALL
                user_agent                              NULL                                                PHP_INI_ALL
                user_dir                                NULL                                                PHP_INI_SYSTEM
                user_ini.cache_ttl                      "300"                                               PHP_INI_SYSTEM
                user_ini.filename                       ".user.ini"                                         PHP_INI_SYSTEM
                uopz.disable                            "0"                                                 PHP_INI_SYSTEM              Available as of uopz 5.0.2
                uopz.exit                               "0"                                                 PHP_INI_SYSTEM              Available as of uopz 6.0.1
                uopz.overloads                          "1"                                                 PHP_INI_SYSTEM              Available as of uopz 2.0.2. Removed as of uopz 5.0.0.
                variables_order                         "EGPCS"                                             PHP_INI_PERDIR
                windows.show_crt_warning                "0"                                                 PHP_INI_ALL
                xbithack                                "0"                                                 PHP_INI_ALL
                xmlrpc_errors                           "0"                                                 PHP_INI_SYSTEM
                xmlrpc_error_number                     "0"                                                 PHP_INI_ALL
                yaz.keepalive                           "120"                                               PHP_INI_ALL
                yaz.log_mask                            NULL                                                PHP_INI_ALL                 Available since yaz 1.0.3.
                zend.assertions                         "1"                                                 PHP_INI_ALL
                zend.detect_unicode                     "1"                                                 PHP_INI_ALL
                zend.enable_gc                          "1"                                                 PHP_INI_ALL
                zend.multibyte                          "0"                                                 PHP_INI_PERDIR
                zend.script_encoding                    NULL                                                PHP_INI_ALL
                zend.signal_check                       "0"                                                 PHP_INI_SYSTEM
                zend_extension                          NULL                                                php.ini only
                zlib.output_compression                 "0"                                                 PHP_INI_ALL
                zlib.output_compression_level           "-1"                                                PHP_INI_ALL
                zlib.output_handler                     ""                                                  PHP_INI_ALL

                ＋add a note
                User Contributed Notes
                There are no user contributed notes for this page.
                php.ini directives
                List of php.ini directives
                List of php.ini sections
                Description of core php.ini directives
                Copyright © 2001-2023 The PHP Group My PHP.net Contact Other PHP.net sites Privacy policy

                */

            }

        }

        //
        // TODO :: THIS SHOULD BE A DATABASE DRIVEN COMPONENT.
        // # # C # R # N # R # S # T # N # : : # # # #
        // APPEND PHP INI LANGUAGE PROFILE PACK.
        if($iso_lang_code != 'en'){

            $tmp_php_ini_option_ARRAY['LANGUAGE_PACK'][$iso_lang_code] = $this->oCRNRSTN->php_ini_option_profile_lang_pack($name, $option_data, $iso_lang_code);

        }

        //
        // CHECK SERVER SETTINGS BEFORE FAIL.
        //$tmp_ini_ARRAY = ini_get_all();

        //
        // RETURN NULL, IF THE ITEM IS NOT FOUND.
        if(!isset($tmp_php_ini_option_ARRAY)){

            //
            // CHECK THE SERVER SETTINGS DIRECTLY FOR INPUT VALIDATION.
            /*
            $oCRNRSTN->server_system_attribute_is_valid() CHECKS AN INPUT
            ATTRIBUTE NAME FOR VALID SYSTEM MATCH AGAINST THE FOLLOWING
            SERVER COLLECTIONS:
                'ini_restore'
                'ini_set'
                'ini_get'
                'ini_get_all'
                'get_declared_classes'
                'get_extension_funcs'
                'get_defined_functions'
                'get_defined_constants'
                'get_defined_vars'
                'extension_loaded'
                'get_loaded_extensions'
                'openssl_get_md_methods'
                'openssl_get_cipher_methods'
                'hash_algos'

            */
            if($tmp_result = $this->oCRNRSTN->server_system_attribute_is_valid('ini_get_all', $name)){

                return true;

            }

            return false;

        }

        error_log(__LINE__ . ' crnrstn PHP INI META RETURN TEST. [' . print_r($tmp_php_ini_option_ARRAY, true) . '].');

        return $tmp_php_ini_option_ARRAY;

    }

    public function __destruct(){

    }

}