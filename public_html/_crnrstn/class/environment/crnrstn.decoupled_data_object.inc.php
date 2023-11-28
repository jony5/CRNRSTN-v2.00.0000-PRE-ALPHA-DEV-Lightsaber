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
#  CLASS :: crnrstn_decoupled_data_object
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: Monday November 3, 2020 @ 2035hrs
#  DESCRIPTION :: Enhance data portability and meta integrity by storing variable data through
#                 actuation of robust layers of objectification.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_decoupled_data_object {

    protected $oLogger;
    public $oCRNRSTN;
    public $oCRNRSTN_USR;

    private static $env_key;
    private static $env_key_hash;

    private static $data_channel_init_sequence = 'GPHSJCDRO';
    private static $system_channel_alpha_ARRAY = array();
    private static $system_channel_ARRAY = array();

    private static $channel_init_burn_ARRAY = array();
    private static $ddo_resource_memory_pointer_ARRAY = array();

    public $data_output_channel_ARRAY = array();
    public $ttl_profile_ARRAY = array();
    public $data_authorization_profile_ARRAY = array();
    public $data_value_ARRAY = array();
    public $data_type_ARRAY = array();
    public $data_flag_ARRAY = array();
    protected $data_type_lock;
    protected $data_type;

    private static $cache_php_logo_html;
    private static $cache_crnrstn_logo_html;
    private static $cache_apache_logo_html;
    private static $cache_mysql_logo_html;
    private static $channel_reporting_meta_ARRAY = array();

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

    private static $rrs_map_attribute_ARRAY = array();

    public function __construct($oCRNRSTN_n, $data_value = NULL, $data_key = NULL, $data_authorization_profile = CRNRSTN_AUTHORIZE_RUNTIME, $data_type_lock = false){

        $this->oCRNRSTN = $oCRNRSTN_n;

        if(get_class($oCRNRSTN_n) == 'crnrstn_user'){

            //
            // TODO :: REFACTER oCRNRSTN_USR OUT. THIS TOUCHES LOGGING CLASS CONSTRUCT() FROM DAYS OF OLDE. WILL NOT BE EASY. GO TO LOGGING.
            error_log(__LINE__ . ' env ' . __METHOD__ . ' TODO :: REFACTOR oCRNRSTN_USR OUT. THIS TOUCHES LOGGING CLASS CONSTRUCT() FROM DAYS OF OLDE. WILL NOT BE EASY. GO TO LOGGING. $oCRNRSTN_n=[' . get_class($oCRNRSTN_n) . ']');

            $this->oCRNRSTN_USR = $oCRNRSTN_n;
            $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN_USR);

        }else{

            //error_log(__LINE__ . ' env ' . __METHOD__ . ' $oCRNRSTN_n=[' . get_class($oCRNRSTN_n) . ']');
            $this->oCRNRSTN = $oCRNRSTN_n;

            $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN);

        }

        //
        // INITIALIZE CRNRSTN :: RESPONSE RETURN
        // SERIALIZATION (RRS) MAP OBJECT
        // ATTRIBUTE ARRAY.
        //
        // THE CRNRSTN :: MULTI-CHANNEL DECOUPLED
        // DATA OBJECT (DDO) PROPERTY OR CHANNEL
        // ATTRIBUTE MUST BE FOUND IN THIS ARRAY
        // IN ORDER FOR THE RRS MAP READ, WRITE,
        // ISSET METHODS TO WORK AS EXPECTED.
        //
        // PLEASE SEE,
        //  $oCRNRSTN->get_channel_config(),
        //  $oCRNRSTN->set_channel_config(),
        //  and $oCRNRSTN->isset_channel_config().
        //
        // Thursday, November 23 2023 @ 0632 hrs.
        self::$rrs_map_attribute_ARRAY = array(
            'total_channel_bytes' => 1,
            'total_bytes' => 1,
            'map_cache_is_active' => 1,
            'cache_master_channels' => 1,
            'cache_channels' => 1,
            'get_cache_is_active' => CRNRSTN_CHANNEL_GET,
            'post_cache_is_active' => CRNRSTN_CHANNEL_POST,
            'cookie_cache_is_active' => CRNRSTN_CHANNEL_COOKIE,
            'session_cache_is_active' => CRNRSTN_CHANNEL_SESSION,
            'database_cache_is_active' => CRNRSTN_CHANNEL_DATABASE,
            'ssdtla_cache_is_active' => CRNRSTN_CHANNEL_SSDTLA,
            'pssdtla_cache_is_active' => CRNRSTN_CHANNEL_PSSDTLA,
            'runtime_cache_is_active' => CRNRSTN_CHANNEL_RUNTIME,
            'soap_cache_is_active' => CRNRSTN_CHANNEL_SOAP,
            'file_cache_is_active' => CRNRSTN_CHANNEL_FILE,
            'get_max_map_cache_bytes' => CRNRSTN_CHANNEL_GET,
            'post_max_map_cache_bytes' => CRNRSTN_CHANNEL_POST,
            'cookie_max_map_cache_bytes' => CRNRSTN_CHANNEL_COOKIE,
            'session_max_map_cache_bytes' => CRNRSTN_CHANNEL_SESSION,
            'database_max_map_cache_bytes' => CRNRSTN_CHANNEL_DATABASE,
            'ssdtla_max_map_cache_bytes' => CRNRSTN_CHANNEL_SSDTLA,
            'pssdtla_max_map_cache_bytes' => CRNRSTN_CHANNEL_PSSDTLA,
            'runtime_max_map_cache_bytes' => CRNRSTN_CHANNEL_RUNTIME,
            'soap_max_map_cache_bytes' => CRNRSTN_CHANNEL_SOAP,
            'file_max_map_cache_bytes' => CRNRSTN_CHANNEL_FILE,
            'get_map_cache_ttl' => CRNRSTN_CHANNEL_GET,
            'post_map_cache_ttl' => CRNRSTN_CHANNEL_POST,
            'cookie_map_cache_ttl' => CRNRSTN_CHANNEL_COOKIE,
            'session_map_cache_ttl' => CRNRSTN_CHANNEL_SESSION,
            'database_map_cache_ttl' => CRNRSTN_CHANNEL_DATABASE,
            'ssdtla_map_cache_ttl' => CRNRSTN_CHANNEL_SSDTLA,
            'pssdtla_map_cache_ttl' => CRNRSTN_CHANNEL_PSSDTLA,
            'runtime_map_cache_ttl' => CRNRSTN_CHANNEL_RUNTIME,
            'soap_map_cache_ttl' => CRNRSTN_CHANNEL_SOAP,
            'file_map_cache_ttl' => CRNRSTN_CHANNEL_FILE,
            'get_encryption_profile' => CRNRSTN_CHANNEL_GET,
            'post_encryption_profile' => CRNRSTN_CHANNEL_POST,
            'cookie_encryption_profile' => CRNRSTN_CHANNEL_COOKIE,
            'session_encryption_profile' => CRNRSTN_CHANNEL_SESSION,
            'database_encryption_profile' => CRNRSTN_CHANNEL_DATABASE,
            'ssdtla_encryption_profile' => CRNRSTN_CHANNEL_SSDTLA,
            'pssdtla_encryption_profile' => CRNRSTN_CHANNEL_PSSDTLA,
            'runtime_encryption_profile' => CRNRSTN_CHANNEL_RUNTIME,
            'soap_encryption_profile' => CRNRSTN_CHANNEL_SOAP,
            'file_encryption_profile' => CRNRSTN_CHANNEL_FILE,
            'get_php_sessionid' => CRNRSTN_CHANNEL_GET,
            'post_php_sessionid' => CRNRSTN_CHANNEL_POST,
            'cookie_php_sessionid' => CRNRSTN_CHANNEL_COOKIE,
            'session_php_sessionid' => CRNRSTN_CHANNEL_SESSION,
            'database_php_sessionid' => CRNRSTN_CHANNEL_DATABASE,
            'ssdtla_php_sessionid' => CRNRSTN_CHANNEL_SSDTLA,
            'pssdtla_php_sessionid' => CRNRSTN_CHANNEL_PSSDTLA,
            'runtime_php_sessionid' => CRNRSTN_CHANNEL_RUNTIME,
            'soap_php_sessionid' => CRNRSTN_CHANNEL_SOAP,
            'file_php_sessionid' => CRNRSTN_CHANNEL_FILE,
            'get_client_ip_address' => CRNRSTN_CHANNEL_GET,
            'post_client_ip_address' => CRNRSTN_CHANNEL_POST,
            'cookie_client_ip_address' => CRNRSTN_CHANNEL_COOKIE,
            'session_client_ip_address' => CRNRSTN_CHANNEL_SESSION,
            'database_client_ip_address' => CRNRSTN_CHANNEL_DATABASE,
            'ssdtla_client_ip_address' => CRNRSTN_CHANNEL_SSDTLA,
            'pssdtla_client_ip_address' => CRNRSTN_CHANNEL_PSSDTLA,
            'runtime_client_ip_address' => CRNRSTN_CHANNEL_RUNTIME,
            'soap_client_ip_address' => CRNRSTN_CHANNEL_SOAP,
            'file_client_ip_address' => CRNRSTN_CHANNEL_FILE,
            'get_channel_config_ini_call_timestamp' => CRNRSTN_CHANNEL_GET,
            'post_channel_config_ini_call_timestamp' => CRNRSTN_CHANNEL_POST,
            'cookie_channel_config_ini_call_timestamp' => CRNRSTN_CHANNEL_COOKIE,
            'session_channel_config_ini_call_timestamp' => CRNRSTN_CHANNEL_SESSION,
            'database_channel_config_ini_call_timestamp' => CRNRSTN_CHANNEL_DATABASE,
            'ssdtla_channel_config_ini_call_timestamp' => CRNRSTN_CHANNEL_SSDTLA,
            'pssdtla_channel_config_ini_call_timestamp' => CRNRSTN_CHANNEL_PSSDTLA,
            'runtime_channel_config_ini_call_timestamp' => CRNRSTN_CHANNEL_RUNTIME,
            'soap_channel_config_ini_call_timestamp' => CRNRSTN_CHANNEL_SOAP,
            'file_channel_config_ini_call_timestamp' => CRNRSTN_CHANNEL_FILE,
            'get_channel_is_opened_timestamp' => CRNRSTN_CHANNEL_GET,
            'post_channel_is_opened_timestamp' => CRNRSTN_CHANNEL_POST,
            'cookie_channel_is_opened_timestamp' => CRNRSTN_CHANNEL_COOKIE,
            'session_channel_is_opened_timestamp' => CRNRSTN_CHANNEL_SESSION,
            'database_channel_is_opened_timestamp' => CRNRSTN_CHANNEL_DATABASE,
            'ssdtla_channel_is_opened_timestamp' => CRNRSTN_CHANNEL_SSDTLA,
            'pssdtla_channel_is_opened_timestamp' => CRNRSTN_CHANNEL_PSSDTLA,
            'runtime_channel_is_opened_timestamp' => CRNRSTN_CHANNEL_RUNTIME,
            'soap_channel_is_opened_timestamp' => CRNRSTN_CHANNEL_SOAP,
            'file_channel_is_opened_timestamp' => CRNRSTN_CHANNEL_FILE,
            'get_channel_is_closed_timestamp' => CRNRSTN_CHANNEL_GET,
            'post_channel_is_closed_timestamp' => CRNRSTN_CHANNEL_POST,
            'cookie_channel_is_closed_timestamp' => CRNRSTN_CHANNEL_COOKIE,
            'session_channel_is_closed_timestamp' => CRNRSTN_CHANNEL_SESSION,
            'database_channel_is_closed_timestamp' => CRNRSTN_CHANNEL_DATABASE,
            'ssdtla_channel_is_closed_timestamp' => CRNRSTN_CHANNEL_SSDTLA,
            'pssdtla_channel_is_closed_timestamp' => CRNRSTN_CHANNEL_PSSDTLA,
            'runtime_channel_is_closed_timestamp' => CRNRSTN_CHANNEL_RUNTIME,
            'soap_channel_is_closed_timestamp' => CRNRSTN_CHANNEL_SOAP,
            'file_channel_is_closed_timestamp' => CRNRSTN_CHANNEL_FILE,
            'get_ddo_begin_data_receipt_timestamp' => CRNRSTN_CHANNEL_GET,
            'post_ddo_begin_data_receipt_timestamp' => CRNRSTN_CHANNEL_POST,
            'cookie_ddo_begin_data_receipt_timestamp' => CRNRSTN_CHANNEL_COOKIE,
            'session_ddo_begin_data_receipt_timestamp' => CRNRSTN_CHANNEL_SESSION,
            'database_ddo_begin_data_receipt_timestamp' => CRNRSTN_CHANNEL_DATABASE,
            'ssdtla_ddo_begin_data_receipt_timestamp' => CRNRSTN_CHANNEL_SSDTLA,
            'pssdtla_ddo_begin_data_receipt_timestamp' => CRNRSTN_CHANNEL_PSSDTLA,
            'runtime_ddo_begin_data_receipt_timestamp' => CRNRSTN_CHANNEL_RUNTIME,
            'soap_ddo_begin_data_receipt_timestamp' => CRNRSTN_CHANNEL_SOAP,
            'file_ddo_begin_data_receipt_timestamp' => CRNRSTN_CHANNEL_FILE,
            'get_ddo_data_complete_timestamp' => CRNRSTN_CHANNEL_GET,
            'post_ddo_data_complete_timestamp' => CRNRSTN_CHANNEL_POST,
            'cookie_ddo_data_complete_timestamp' => CRNRSTN_CHANNEL_COOKIE,
            'session_ddo_data_complete_timestamp' => CRNRSTN_CHANNEL_SESSION,
            'database_ddo_data_complete_timestamp' => CRNRSTN_CHANNEL_DATABASE,
            'ssdtla_ddo_data_complete_timestamp' => CRNRSTN_CHANNEL_SSDTLA,
            'pssdtla_ddo_data_complete_timestamp' => CRNRSTN_CHANNEL_PSSDTLA,
            'runtime_ddo_data_complete_timestamp' => CRNRSTN_CHANNEL_RUNTIME,
            'soap_ddo_data_complete_timestamp' => CRNRSTN_CHANNEL_SOAP,
            'file_ddo_data_complete_timestamp' => CRNRSTN_CHANNEL_FILE,
            'get_channel_opened_count' => CRNRSTN_CHANNEL_GET,
            'post_channel_opened_count' => CRNRSTN_CHANNEL_POST,
            'cookie_channel_opened_count' => CRNRSTN_CHANNEL_COOKIE,
            'session_channel_opened_count' => CRNRSTN_CHANNEL_SESSION,
            'database_channel_opened_count' => CRNRSTN_CHANNEL_DATABASE,
            'ssdtla_channel_opened_count' => CRNRSTN_CHANNEL_SSDTLA,
            'pssdtla_channel_opened_count' => CRNRSTN_CHANNEL_PSSDTLA,
            'runtime_channel_opened_count' => CRNRSTN_CHANNEL_RUNTIME,
            'soap_channel_opened_count' => CRNRSTN_CHANNEL_SOAP,
            'file_channel_opened_count' => CRNRSTN_CHANNEL_FILE,
            'get_last_packet_bytes_total' => CRNRSTN_CHANNEL_GET,
            'post_last_packet_bytes_total' => CRNRSTN_CHANNEL_POST,
            'cookie_last_packet_bytes_total' => CRNRSTN_CHANNEL_COOKIE,
            'session_last_packet_bytes_total' => CRNRSTN_CHANNEL_SESSION,
            'database_last_packet_bytes_total' => CRNRSTN_CHANNEL_DATABASE,
            'ssdtla_last_packet_bytes_total' => CRNRSTN_CHANNEL_SSDTLA,
            'pssdtla_last_packet_bytes_total' => CRNRSTN_CHANNEL_PSSDTLA,
            'runtime_last_packet_bytes_total' => CRNRSTN_CHANNEL_RUNTIME,
            'soap_last_packet_bytes_total' => CRNRSTN_CHANNEL_SOAP,
            'file_last_packet_bytes_total' => CRNRSTN_CHANNEL_FILE,
            'get_total_packet_bytes' => CRNRSTN_CHANNEL_GET,
            'post_total_packet_bytes' => CRNRSTN_CHANNEL_POST,
            'cookie_total_packet_bytes' => CRNRSTN_CHANNEL_COOKIE,
            'session_total_packet_bytes' => CRNRSTN_CHANNEL_SESSION,
            'database_total_packet_bytes' => CRNRSTN_CHANNEL_DATABASE,
            'ssdtla_total_packet_bytes' => CRNRSTN_CHANNEL_SSDTLA,
            'pssdtla_total_packet_bytes' => CRNRSTN_CHANNEL_PSSDTLA,
            'runtime_total_packet_bytes' => CRNRSTN_CHANNEL_RUNTIME,
            'soap_total_packet_bytes' => CRNRSTN_CHANNEL_SOAP,
            'file_total_packet_bytes' => CRNRSTN_CHANNEL_FILE,
            'get_last_packet_bytes_received' => CRNRSTN_CHANNEL_GET,
            'post_last_packet_bytes_received' => CRNRSTN_CHANNEL_POST,
            'cookie_last_packet_bytes_received' => CRNRSTN_CHANNEL_COOKIE,
            'session_last_packet_bytes_received' => CRNRSTN_CHANNEL_SESSION,
            'database_last_packet_bytes_received' => CRNRSTN_CHANNEL_DATABASE,
            'ssdtla_last_packet_bytes_received' => CRNRSTN_CHANNEL_SSDTLA,
            'pssdtla_last_packet_bytes_received' => CRNRSTN_CHANNEL_PSSDTLA,
            'runtime_last_packet_bytes_received' => CRNRSTN_CHANNEL_RUNTIME,
            'soap_last_packet_bytes_received' => CRNRSTN_CHANNEL_SOAP,
            'file_last_packet_bytes_received' => CRNRSTN_CHANNEL_FILE,
            'get_total_bytes_received' => CRNRSTN_CHANNEL_GET,
            'post_total_bytes_received' => CRNRSTN_CHANNEL_POST,
            'cookie_total_bytes_received' => CRNRSTN_CHANNEL_COOKIE,
            'session_total_bytes_received' => CRNRSTN_CHANNEL_SESSION,
            'database_total_bytes_received' => CRNRSTN_CHANNEL_DATABASE,
            'ssdtla_total_bytes_received' => CRNRSTN_CHANNEL_SSDTLA,
            'pssdtla_total_bytes_received' => CRNRSTN_CHANNEL_PSSDTLA,
            'runtime_total_bytes_received' => CRNRSTN_CHANNEL_RUNTIME,
            'soap_total_bytes_received' => CRNRSTN_CHANNEL_SOAP,
            'file_total_bytes_received' => CRNRSTN_CHANNEL_FILE,
            'get_last_opened_timestamp' => CRNRSTN_CHANNEL_GET,
            'post_last_opened_timestamp' => CRNRSTN_CHANNEL_POST,
            'cookie_last_opened_timestamp' => CRNRSTN_CHANNEL_COOKIE,
            'session_last_opened_timestamp' => CRNRSTN_CHANNEL_SESSION,
            'database_last_opened_timestamp' => CRNRSTN_CHANNEL_DATABASE,
            'ssdtla_last_opened_timestamp' => CRNRSTN_CHANNEL_SSDTLA,
            'pssdtla_last_opened_timestamp' => CRNRSTN_CHANNEL_PSSDTLA,
            'runtime_last_opened_timestamp' => CRNRSTN_CHANNEL_RUNTIME,
            'soap_last_opened_timestamp' => CRNRSTN_CHANNEL_SOAP,
            'file_last_opened_timestamp' => CRNRSTN_CHANNEL_FILE,
            'get_last_closed_timestamp' => CRNRSTN_CHANNEL_GET,
            'post_last_closed_timestamp' => CRNRSTN_CHANNEL_POST,
            'cookie_last_closed_timestamp' => CRNRSTN_CHANNEL_COOKIE,
            'session_last_closed_timestamp' => CRNRSTN_CHANNEL_SESSION,
            'database_last_closed_timestamp' => CRNRSTN_CHANNEL_DATABASE,
            'ssdtla_last_closed_timestamp' => CRNRSTN_CHANNEL_SSDTLA,
            'pssdtla_last_closed_timestamp' => CRNRSTN_CHANNEL_PSSDTLA,
            'runtime_last_closed_timestamp' => CRNRSTN_CHANNEL_RUNTIME,
            'soap_last_closed_timestamp' => CRNRSTN_CHANNEL_SOAP,
            'file_last_closed_timestamp' => CRNRSTN_CHANNEL_FILE);

        $this->data_type_lock = $data_type_lock;

        if(!($this->data_type_lock !== false)){

            //
            //'CRNRSTN_STRING','CRNRSTN_INT', 'CRNRSTN_INTEGER', 'CRNRSTN_BOOL',
            //'CRNRSTN_BOOLEAN','CRNRSTN_FLOAT', 'CRNRSTN_DOUBLE', 'CRNRSTN_ARRAY',
            //'CRNRSTN_OBJECT', 'CRNRSTN_RESOURCE', 'CRNRSTN_NULL',
            //'CRNRSTN_RESOURCE_CLOSED', 'CRNRSTN_UNKNOWN_TYPE',
            //
            // Wednesday, November 15, 2023 @ 0507 hrs.
            $tmp_data_type_ARRAY = $this->oCRNRSTN->gettype($data_value, CRNRSTN_ARRAY);
            //switch($tmp_data_type_ARRAY[CRNRSTN_INTEGER]){}

            $this->data_type = $tmp_data_type_ARRAY[CRNRSTN_INTEGER];

        }

        if(!isset($data_key)){

            $data_key = '';

        }

        //
        // PREVIOUSLY...THS WAS SOMEHING LIKE: if(is_bool($data_value)...
        if(($tmp_data_type_ARRAY[CRNRSTN_INTEGER] == CRNRSTN_BOOLEAN) || ($tmp_data_type_ARRAY[CRNRSTN_INTEGER] == CRNRSTN_BOOL)){

            $this->data_type_ARRAY[$data_key][] = CRNRSTN_BOOL;                                 // PREVIOUSLY 'bool'.
            $this->data_flag_ARRAY[$data_key][] = 1;

        }else{

            $this->data_type_ARRAY[$data_key][] = $tmp_data_type_ARRAY[CRNRSTN_INTEGER];      // PREVIOUSLY $this->gettype($data_value);
            $this->data_flag_ARRAY[$data_key][] = 1;

        }

        /*
        // Friday, November 17, 2023 @ 0515 hrs.
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
        */

        //
        //'CRNRSTN_STRING','CRNRSTN_INT', 'CRNRSTN_INTEGER', 'CRNRSTN_BOOL',
        //'CRNRSTN_BOOLEAN','CRNRSTN_FLOAT', 'CRNRSTN_DOUBLE', 'CRNRSTN_ARRAY',
        //'CRNRSTN_OBJECT', 'CRNRSTN_RESOURCE', 'CRNRSTN_NULL',
        //'CRNRSTN_RESOURCE_CLOSED', 'CRNRSTN_UNKNOWN_TYPE',
        //
        switch($this->data_type_ARRAY[$data_key][0]){
            // PREVIOUSLY switch($this->data_type_ARRAY[$data_key]){
            case CRNRSTN_INT:

                $this->data_authorization_profile_ARRAY[$data_key][] = $data_authorization_profile;
                $this->data_value_ARRAY[$data_key][] = (int) $data_value;

            break;
            case CRNRSTN_INTEGER:

                $this->data_authorization_profile_ARRAY[$data_key][] = $data_authorization_profile;
                $this->data_value_ARRAY[$data_key][] = (integer) $data_value;

            break;
            case CRNRSTN_BOOL:
            case CRNRSTN_BOOLEAN:

                //
                // HANDLE STRING INPUT (E.G. 'true', 'false', '1') MARKED AS BOOLEAN DATA TYPE.
                if(is_bool($data_value) === true){

                    if($data_value == true){

                        //error_log(__LINE__ .' env ddo - BOOL['.$data_key.']['.$data_value . ']true');
                        $this->data_authorization_profile_ARRAY[$data_key][] = $data_authorization_profile;
                        $this->data_value_ARRAY[$data_key][] = 1;

                    }else{

                        //error_log(__LINE__ .' env ddo - BOOL['.$data_key.']['.$data_value . ']false');
                        $this->data_authorization_profile_ARRAY[$data_key][] = $data_authorization_profile;
                        $this->data_value_ARRAY[$data_key][] = 0;

                    }

                }else{

                    // I THINK THIS BOOLVAL CHECK IS JUST FOR SAFETY.
                    if(boolval($data_value)){

                        //error_log(__LINE__ .' env ddo - BOOL['.$data_key.']['.$data_value . ']true');
                        $this->data_authorization_profile_ARRAY[$data_key][] = $data_authorization_profile;
                        $this->data_value_ARRAY[$data_key][] = 1;

                    }else{

                        //error_log(__LINE__ .' env ddo - BOOL['.$data_key.']['.$data_value . ']false');
                        $this->data_authorization_profile_ARRAY[$data_key][] = $data_authorization_profile;
                        $this->data_value_ARRAY[$data_key][] = 0;

                    }

                }

            break;
            case CRNRSTN_DOUBLE:

                $this->data_authorization_profile_ARRAY[$data_key][] = $data_authorization_profile;
                $this->data_value_ARRAY[$data_key][] = (double) $data_value;

            break;
            case CRNRSTN_FLOAT:

                $this->data_authorization_profile_ARRAY[$data_key][] = $data_authorization_profile;
                $this->data_value_ARRAY[$data_key][] = (float) $data_value;

            break;
            case CRNRSTN_STRING:

                $this->data_authorization_profile_ARRAY[$data_key][] = $data_authorization_profile;
                $this->data_value_ARRAY[$data_key][] = (string) $data_value;

            break;
            case CRNRSTN_ARRAY:

                $this->data_authorization_profile_ARRAY[$data_key][] = $data_authorization_profile;
                $this->data_value_ARRAY[$data_key][] = (array) $data_value;

            break;
            case CRNRSTN_OBJECT:

                $this->data_authorization_profile_ARRAY[$data_key][] = $data_authorization_profile;
                $this->data_value_ARRAY[$data_key][] = (object) $data_value;

            break;
            case CRNRSTN_RESOURCE:

                $this->data_authorization_profile_ARRAY[$data_key][] = $data_authorization_profile;
                $this->data_value_ARRAY[$data_key][] = $data_value;

            break;
            case CRNRSTN_RESOURCE_CLOSED:

                $this->data_authorization_profile_ARRAY[$data_key][] = $data_authorization_profile;
                $this->data_value_ARRAY[$data_key][] = $data_value;

            break;
            case CRNRSTN_NULL:

                $this->data_authorization_profile_ARRAY[$data_key][] = $data_authorization_profile;
                $this->data_value_ARRAY[$data_key][] = NULL;

            break;
            case CRNRSTN_UNKNOWN_TYPE:

                $this->data_authorization_profile_ARRAY[$data_key][] = $data_authorization_profile;
                $this->data_value_ARRAY[$data_key][] = $data_value;

            break;
            default:

                $this->data_authorization_profile_ARRAY[$data_key][] = $data_authorization_profile;
                $this->data_value_ARRAY[$data_key][] = $data_value;

            break;

        }

    }

    public function is_rrs_mapped($name){

        if(isset(self::$rrs_map_attribute_ARRAY[$name])){

            return self::$rrs_map_attribute_ARRAY[$name];

        }

        return NULL;

    }

    public function initialize_multi_channel_environment_key(){

        //
        // INITIALIZE ENVIRONMENT TO ENABLE
        // MULTI-CHANNEL AUTHENTICATION.
        self::$env_key = $this->oCRNRSTN->return_env_key();
        self::$env_key_hash = $this->oCRNRSTN->return_env_key(true);

    }

    public function config_channel_data_translate(){

        error_log(__LINE__ . ' crnrstn BEGIN FIRST[?] CRNRSTN :: DDO DATA TRANSLATION? die();');

        //
        // RRS MAP CHANNEL META TO INITIALIZE.
        //  - CAPTURE THE START TIME OF THE CHANNEL DATA
        //    TRANSLATION INTO THE CRNRSTN :: DDO AFTER
        //    TUNNELING (PSSDTLA, SSDTLA) TO ENDPOINT.
        //  - CAPTURE THE COMPLETION TIME OF THE DATA
        //    TRANSLATION INTO THE CRNRSTN :: DDO AFTER
        //    TUNNELING (PSSDTLA, SSDTLA) TO ENDPOINT.
        //  - CAPTURE BYTE COUNT OF DATA MOVED INTO CHANNEL.
        //
        // FOR CHANNEL PROFILE MANAGEMENT, PLEASE SEE,
        // $oCRNRSTN->set_channel_config($channel_constant, $attribute_name, $data);
        // $oCRNRSTN->get_channel_config($channel_constant, $attribute_name);
        // $oCRNRSTN->isset_channel_config($channel_constant, $attribute_name);
        die();

        //
        // WHERE, $data_channel_init_sequence = 'GPHSJCDROF';
        // SEE, _crnrstn/_config/_config.defaults/_crnrstn.system_settings.inc.php.
        // THIS DATA IS REFERENCED ALOT, SO WE SAVE IT PUBLIC, PROTECTED, OR PRIVATE STATIC.
        $tmp_data_channel_init_sequence = $this->oCRNRSTN->get_resource('data_channel_init_sequence', 0, 'CRNRSTN::RESOURCE::MULTI_CHANNEL');

        //error_log(__LINE__ . ' crnrstn CRNRSTN :: MULTI-CHANNEL GOLD STANDARD[' . $tmp_data_channel_init_sequence . '] FOR DATA ACCESS PRIORITIZATION.');
        error_log(__LINE__ . ' crnrstn BEGIN CRNRSTN :: MULTI-CHANNEL INITIALIZATION.');
        $this->oCRNRSTN->destruct_output .= '<pre><code>[lnum ' .  __LINE__ . '] [class ' . __CLASS__ . '] C<span style="color:#F90000;">R</span>NRSTN :: MULTI-CHANNEL GOLD STANDARD :: [' . $tmp_data_channel_init_sequence . '] DATA ACCESS PRIORITIZATION.</code></pre>';

        //
        // THE DATA IS VALIDATED ON INPUT. THIS CHECK IS FOR PROTECTION FROM OTHER SOURCES OF ERR.
        if(is_string($tmp_data_channel_init_sequence) && (strlen($tmp_data_channel_init_sequence) > 0)){

            self::$data_channel_init_sequence = $tmp_data_channel_init_sequence;

        }else{

            $tmp_err_msg = 'Unable to load a valid data channel initialization sequence from the CRNRSTN :: DDO. No changes have been made to the sequence, "' . self::$data_channel_init_sequence . '".';

            //
            // HOOOSTON...VE HAF PROBLEM!
            $this->oCRNRSTN->error_log($tmp_err_msg, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        }

        error_log(__LINE__ . ' crnrstn BEGIN CRNRSTN :: MULTI-CHANNEL INITIALIZATION. ' . $tmp_err_msg);
        die();

        //
        // INITIALIZE CHANNEL BYTES TO ZED.
        $tmp_channel_ARRAY = str_split(self::$data_channel_init_sequence);
        foreach($tmp_channel_ARRAY as $ch_index => $ch_alpha){

            //
            // TODO :: RUN THIS AS HIGH AS POSSIBLE.
            //$tmp_channel_profile_ARRAY[$ch_alpha] = $this->get_channel_config($ch_alpha);
            self::$system_channel_ARRAY[$ch_alpha] = $this->get_channel_config($ch_alpha, NULL, NULL, NULL, NULL, true);
            self::$system_channel_alpha_ARRAY[self::$system_channel_ARRAY[$ch_alpha]['NAME']] = $ch_alpha;

            error_log(__LINE__ . ' crnrstn alpha_ARRAY[' . print_r(self::$system_channel_alpha_ARRAY, true) . '].');
            die();

            $this->oCRNRSTN->destruct_output .= '<pre><code>[' . $this->oCRNRSTN->return_micro_time()  . '] [lnum ' .  __LINE__ . '] [rtime ' . $this->oCRNRSTN->wall_time() . '] crnrstn LOADED ' . $this->oCRNRSTN->format_bytes(strlen(serialize(self::$system_channel_ARRAY[$ch_alpha])), 3) . ' OF DATA FOR CRNRSTN :: MULTI-CHANNEL [' . $ch_alpha . '] PROFILE.</code></pre>';

            $this->oCRNRSTN->oCRNRSTN_RRS_MAP->rrs_map_set('channel_bytes', self::$system_channel_ARRAY[$ch_alpha]['NAME']);
            // $this->oCRNRSTN->set_channel_config($channel_constant, $attribute_name, $data);
            // $this->oCRNRSTN->get_channel_config($channel_constant, $attribute_name);
            // $this->oCRNRSTN->isset_channel_config($channel_constant, $attribute_name);

        }

        error_log(__LINE__ . ' crnrstn system_channel_ARRAY[' . print_r(self::$system_channel_ARRAY, true) . '].');

        $tmp_cnt = count($tmp_channel_ARRAY);
        for($i = 0; $i < $tmp_cnt; $i++){

            //$tmp_channel = $this->get_channel_config($tmp_channel_ARRAY[$i], 'NAME');
            if(!isset(self::$channel_init_burn_ARRAY[$tmp_channel_ARRAY[$i]])){

                self::$channel_init_burn_ARRAY[$tmp_channel_ARRAY[$i]] = 1;

                /*
                //
                // IF THE MULTI-CHANNEL GET CHANNEL ($_GET[]) IS
                // ACTIVE, LOOP THROUGH $_GET[] HTTP/HTTPS DATA,
                // AND PASS ALL MATCHES THROUGH CRNRSTN ::
                // DECOUPLED DATA OBJECT (DDO) DATA TRANSLATION.
                //
                // Saturday, November 4, 2023 @ 0902 hrs.
                if(isset(self::$get_channel_system_parameters_ARRAY[$get_param])){

                }
                */

                //
                // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA
                // OBJECT (DDO) SERVICES LAYER.
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: SYSTEM DATA INPUT [MULTI-CHANNEL]
                //
                // Saturday, November 4, 2023 @ 0930 hrs.
                switch(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]['NAME']){
                    case CRNRSTN_CHANNEL_GET:

                        //
                        // CRNRSTN :: GET INITIALIZATION WITH SUPPORT FOR
                        // TRANSLATION OF SYSTEM PARAMETERS INTO THE
                        // CRNRSTN :: DECOUPLED DATA OBJECT (DDO)
                        // SERVICES LAYER.
                        //
                        // $_GET[] DATA PARAMETERS REFERENCED BY
                        // get_channel_system_parameter_exclusions_ARRAY
                        // WILL BE BYPASSED INTERNALLY.
                        // SEE, _crnrstn/_config/_config.defaults/_crnrstn.system_settings.inc.php
                        //
                        // Saturday, November 4, 2023 @ 1620 hrs.
                        //$this->initialize_http_get_params();

                        //error_log(__LINE__ . ' crnrstn OK TO TRANSLATE SYSTEM DATA FROM [' . $tmp_channel . '] CHANNEL TO CRNRSTN :: DDO');
                        //die();

                        //
                        // THE CRNRSTN :: PSEUDO-SOAP SERVICES DATA
                        // TUNNEL LAYER (PSSDTL) PACKET WILL
                        // AUTOMATICALLY BE DETECTED AND PROCESSED IF
                        // (1) THE DATA IS AVAILABLE IN $_GET[],
                        // (2) THE CRNRSTN :: MULTI-CHANNEL GET DATA
                        // CHANNEL IS ACTIVE PER $oCRNRSTN->config_init_channel()
                        // SETTINGS IN CRNRSTN :: CONFIGURATION. (SEE, _crnrstn.config.inc.php),
                        // AND (3) MAX BYTE CONFIGURATION SETTINGS (SEE, _crnrstn/_config/_config.defaults/_crnrstn.system_settings.inc.php)
                        // AND SYSTEM OVERRIDES (SEE, _crnrstn/_config/_config.defaults/_crnrstn.system_overrides.inc.php)
                        // ARE NEVER VIOLATED WHEN DATA IS PROCESSED
                        // INTO RUNTIME (THIS WOULD BE ATYPICAL).
                        //
                        // CRNRSTN :: WILL NOT BEGIN DDO DATA
                        // TRANSLATION, AND HIT A MAX_BYTE LIMIT
                        // BEFORE THE LAST ITEM FROM THE SHOPPING CART
                        // OR MAILING LIST RECORD CAN BE PROCESSED INTO
                        // THE RUNTIME DDO. AGAIN, THIS KIND OF DATA
                        // CORRUPTION IN MEMORY WOULD BE ATYPICAL.
                        // PROTECTIONS ARE IN PLACE IN ORDER TO PREVENT
                        // THIS KIND OF THING FROM HAPPENING IN
                        // CRNRSTN :: DDO MEMORY.
                        //
                        // ON TOP OF PROVIDING VALID ITEM COUNTS, BYTE
                        // REPORTING, AND TIMESTAMPS TO THE CLIENT
                        // FACING CRNRSTN :: PERFORMANCE REPORTING
                        // SERVICES LAYER, WHICH SAID REQUIREMENTS
                        // ...BY THEMSELVES...DEMAND NO MODEST DEGREE
                        // OF SCRUTINY AND CONSIDERATION, CRNRSTN ::
                        // HAS BEEN DESIGNED SPECIFICALLY TO DESKTOP,
                        // TABLET, AND MOBILE THESE KINDS OF PURPOSES.
                        //
                        // Saturday, November 4, 2023 @ 2127 hrs.
                        //
                        // THE COMPLETE AND PERFECT MANAGEMENT OF DATA
                        // AND FILES TO PRODUCE A QUALITY BUSINESS TOOL
                        // ON TOP OF THE MIT LICENSE.
                        //
                        // PLEASE SEE, http://crnrstn.evifweb.com/licensing/.
                        //
                        // SUPPORTED CHANNEL AUTHORIZATION PROFILE CONSTANTS ::
                        //  - CRNRSTN_AUTHORIZE_ALL
                        //  - CRNRSTN_AUTHORIZE_GET
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_RUNTIME
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_RUNTIME & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP
                        //
                        // CHANNEL AUTHORIZATION PROFILE METHODS ::
                        //  - DEVELOPER SUPPORT:
                        //      ~ $oCRNRSTN->add_resource($data_key, $data_value, $data_type_family, CRNRSTN_AUTHORIZE_GET, $index, $ttl);
                        //        * NOTE: ALL HTTP/HTTPS SYSTEM GENERATED LINKS WILL
                        //                RECEIVE PSSDTL PACKET DATA (UP TO MAX_BYTES
                        //                SPECIFIED FOR CRNRSTN_CHANNEL_GET IN $oCRNRSTN->config_init_channel().
                        //                SEE, _crnrstn.config.inc.php.) WHEN DATA IS
                        //                AUTHORIZED FOR THE CRNRSTN :: MULTI-CHANNEL GET
                        //                DATA CHANNEL FOR DEEPEST AND RICHEST SERVER
                        //                $_GET[] INTEGRATIONS.
                        //        * NOTE: IF $ttl = NULL, THE CHANNEL TTL SETTINGS, AS
                        //                PER $oCRNRSTN->config_init_channel() SETTINGS
                        //                IN THE CRNRSTN :: CONFIGURATION FILE (SEE, _crnrstn.config.inc.php),
                        //                WILL EXPIRE THE DATA FROM CACHE. SOME OF THE
                        //                DATA WILL BE EXPIRED BY LAMP STACK MEMORY
                        //                CLEAN UP PROCESSES THAT WILL RUN AT THE
                        //                END WHEN THE CLASS OBJECT DESTRUCTOR
                        //                FIRES...some of the data.
                        //
                        //      ~ $oCRNRSTN->get_resource($data_key, $index, $data_type_family, CRNRSTN_AUTHORIZE_GET);
                        //          NOTE: LETTING $data_authorization_channel = NULL,
                        //                SHOULD BE DESIREABLE (NOT TOO SLOW). I THINK
                        //                THERE MAY BE INTERNAL POINTER STUFF WITHIN THE
                        //                CRNRSTN :: RESPONSE RETURN SERIALIZATION MAPPING
                        //                OBJECT TO MAKE IT FASTER SO THAT NULL CAN BE OK.
                        //      ~ $oCRNRSTN->get_resource_count($data_key, $data_type_family, CRNRSTN_AUTHORIZE_GET);
                        //      ~ if($oCRNRSTN->isset_resource('data_value', $data_key, $data_type_family, $channel, $index) == true){}
                        //          WHERE, $channel = CRNRSTN_CHANNEL_GET OR PLEASE SEE, $oCRNRSTN->get_channel_config($channel, 'NAME') OUTPUT.
                        //
                        //  - CRNRSTN :: CONFIGURATION.
                        //      ~ $oCRNRSTN->config_add_resource($env_key, $data_key, $data_value, $data_type_family, CRNRSTN_AUTHORIZE_GET, $index, $ttl)
                        //        * WHERE $index = NULL WILL SUPPORT:
                        //              + STORING n+1 ITEMS AT THE SPECIFIED DATA_KEY AND
                        //                DATA TYPE FAMILY (DUAL INDEX POINTER). SIMPLY CALL
                        //                THE SAME METHOD AGAIN, BUT CHANGE $data_value TO
                        //                THE NEXT VALUE THAT IS TO BE STORED.
                        //                      - NOTE: CRNRSTN :: GABRIEL (A MESSENGER FROM
                        //                        THE FURTHEST REACHES OF THE NORTH) CAN
                        //                        RECEIVE A RAW ARRAY DIRECTLY INTO AN EARLY
                        //                        EXECUTION OF THIS ARCHITECTURE. E.G.
                        //                        ARRAY(EMAIL001, EMAIL002, EMAIL003, ...).
                        //                      - NOTE: CRNRSTN :: GABRIEL (A MESSENGER FROM
                        //                        THE FURTHEST REACHES OF THE NORTH) SUPPORTS
                        //                        ACCELERATION OF DATA ACCESSED THROUGH USE
                        //                        OF add_resource DDO MEMORY POINTER
                        //                        OUTPUT (ALBEIT AN EARLIER VERSION OF THIS
                        //                        ARCHITECTURE). EXPECT THIS KIND OF
                        //                        FUNCTIONALITY TO MAKE IT INTO
                        //                        CRNRSTN :: LIGHTSABER.
                        //              + ACCESS OF n+1 ITEMS USING THE SPECIFIED DATA_KEY AND
                        //                DATA TYPE FAMILY (DUAL INDEX POINTER)...AND DON'T
                        //                FORGET USE OF $INDEX + 1 FOR STRUCTURE TRAVERSAL.
                        //              + STORING UP TO THE CHANNEL CONFIGURED MAX_BYTES BYTES.
                        //
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (DDO) SERVICES LAYER.
                        // CHANNEL TRANSLATION CONTROL.
                        //
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // ONLY ACTIVE CHANNELS SHOULD HAVE ACCESS TO THE DDO TRANSLATION
                        // SERVICES LAYER.
                        //
                        // PLEASE SEE, $oCRNRSTN->config_init_channel()
                        // IN CRNRSTN :: CONFIGURATION. [_crnrstn.config.inc.php]
                        if(($this->oCRNRSTN->oCRNRSTN_RRS_MAP->rrs_map_get(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]['NAME'] . '_cache_is_active')) == true){

                            //
                            // TRANSLATE DATA FROM THIS CRNRSTN :: MULTI-
                            // CHANNEL CHANNEL INTO THE CRNRSTN ::
                            // DECOUPLED DATA OBJECT (DDO) SERVICES LAYER.
                            $this->ddo_translate(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]);

//                            //
//                            // CAN WE GO TO CRNRSTN :: PLAID?
//                            if(!($this->gone_to_plaid($_GET[$this->session_salt()], CRNRSTN_ASSET_MAPPING, self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]['NAME']) == true)){
//
//                                //
//                                // CRNRSTN :: PLAID APPLICATION ACCELERATION.
//                                $this->plaid(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]['NAME']);
//
//                            }

                        }

                    break;
                    case CRNRSTN_CHANNEL_POST:

                        //
                        // THE CRNRSTN :: PSEUDO-SOAP SERVICES DATA
                        // TUNNEL LAYER (PSSDTL) PACKET WILL
                        // AUTOMATICALLY BE DETECTED AND PROCESSED IF
                        // (1) THE DATA IS AVAILABLE IN $_POST[],
                        // (2) THE CRNRSTN :: MULTI-CHANNEL POST DATA
                        // CHANNEL IS ACTIVE PER $oCRNRSTN->config_init_channel()
                        // SETTINGS IN CRNRSTN :: CONFIGURATION. (SEE, _crnrstn.config.inc.php),
                        // AND (3) MAX BYTE CONFIGURATION SETTINGS (SEE, _crnrstn/_config/_config.defaults/_crnrstn.system_settings.inc.php)
                        // AND SYSTEM OVERRIDES (SEE, _crnrstn/_config/_config.defaults/_crnrstn.system_overrides.inc.php)
                        // ARE NEVER VIOLATED WHEN DATA IS PROCESSED
                        // INTO RUNTIME (THIS WOULD BE ATYPICAL).
                        //
                        // CRNRSTN :: WILL NOT BEGIN DDO DATA
                        // TRANSLATION, AND HIT A MAX_BYTE LIMIT
                        // BEFORE THE LAST ITEM FROM THE SHOPPING CART
                        // OR MAILING LIST RECORD CAN BE PROCESSED INTO
                        // THE RUNTIME DDO. AGAIN, THIS KIND OF DATA
                        // CORRUPTION IN MEMORY WOULD BE ATYPICAL.
                        // PROTECTIONS ARE IN PLACE IN ORDER TO PREVENT
                        // THIS KIND OF THING FROM HAPPENING IN
                        // CRNRSTN :: DDO MEMORY.
                        //
                        // ON TOP OF PROVIDING VALID ITEM COUNTS, BYTE
                        // REPORTING, AND TIMESTAMPS TO THE CLIENT
                        // FACING CRNRSTN :: PERFORMANCE REPORTING
                        // SERVICES LAYER, WHICH SAID REQUIREMENTS
                        // ...BY THEMSELVES...DEMAND NO MODEST DEGREE
                        // OF SCRUTINY AND CONSIDERATION, CRNRSTN ::
                        // HAS BEEN DESIGNED SPECIFICALLY TO DESKTOP,
                        // TABLET, AND MOBILE THESE KINDS OF PURPOSES.
                        //
                        // Saturday, November 4, 2023 @ 2127 hrs.
                        //
                        // THE COMPLETE AND PERFECT MANAGEMENT OF DATA
                        // AND FILES TO PRODUCE A QUALITY BUSINESS TOOL
                        // ON TOP OF THE MIT LICENSE.
                        //
                        // PLEASE SEE, http://crnrstn.evifweb.com/licensing/.
                        //
                        // SUPPORTED CHANNEL AUTHORIZATION PROFILE CONSTANTS ::
                        //  - CRNRSTN_AUTHORIZE_ALL
                        //  - CRNRSTN_AUTHORIZE_POST
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_RUNTIME
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE
                        //
                        // CHANNEL AUTHORIZATION PROFILE METHODS ::
                        //  - DEVELOPER SUPPORT:
                        //      ~ $oCRNRSTN->add_resource($data_key, $data_value, $data_type_family, CRNRSTN_AUTHORIZE_POST, $index, $ttl);
                        //        * NOTE: ALL CRNRSTN :: GENERATED <FORMS> WILL
                        //                RECEIVE PSSDTL PACKET DATA (UP TO MAX_BYTES
                        //                SPECIFIED FOR CRNRSTN_CHANNEL_POST IN $oCRNRSTN->config_init_channel().
                        //                SEE, _crnrstn.config.inc.php.) WHEN DATA IS
                        //                AUTHORIZED FOR THE CRNRSTN :: MULTI-CHANNEL POST
                        //                DATA CHANNEL FOR DEEPEST AND RICHEST SERVER
                        //                $_POST[] INTEGRATIONS.
                        //        * NOTE: IF $ttl = NULL, THE CHANNEL TTL SETTINGS, AS
                        //                PER $oCRNRSTN->config_init_channel() SETTINGS
                        //                IN THE CRNRSTN :: CONFIGURATION FILE (SEE, _crnrstn.config.inc.php),
                        //                WILL EXPIRE THE DATA FROM CACHE. SOME OF THE
                        //                DATA WILL BE EXPIRED BY LAMP STACK MEMORY
                        //                CLEAN UP PROCESSES THAT WILL RUN AT THE
                        //                END WHEN THE CLASS OBJECT DESTRUCTOR
                        //                FIRES...some of the data.
                        //
                        //      ~ $oCRNRSTN->get_resource($data_key, $index, $data_type_family, CRNRSTN_AUTHORIZE_POST);
                        //          NOTE: LETTING $data_authorization_channel = NULL,
                        //                SHOULD BE DESIREABLE (NOT TOO SLOW). I THINK
                        //                THERE MAY BE INTERNAL POINTER STUFF WITHIN THE
                        //                CRNRSTN :: RESPONSE RETURN SERIALIZATION MAPPING
                        //                OBJECT TO MAKE IT FASTER SO THAT NULL CAN BE OK.
                        //      ~ $oCRNRSTN->get_resource_count($data_key, $data_type_family, CRNRSTN_AUTHORIZE_POST);
                        //      ~ if($oCRNRSTN->isset_resource('data_value', $data_key, $data_type_family, $channel, $index) == true){}
                        //          WHERE, $channel = CRNRSTN_CHANNEL_POST OR PLEASE SEE, $oCRNRSTN->get_channel_config($channel, 'NAME') OUTPUT.
                        //
                        //  - CRNRSTN :: CONFIGURATION.
                        //      ~ $oCRNRSTN->config_add_resource($env_key, $data_key, $data_value, $data_type_family, CRNRSTN_AUTHORIZE_POST, $index, $ttl)
                        //        * WHERE $index = NULL WILL SUPPORT:
                        //              + STORING n+1 ITEMS AT THE SPECIFIED DATA_KEY AND
                        //                DATA TYPE FAMILY (DUAL INDEX POINTER). SIMPLY CALL
                        //                THE SAME METHOD AGAIN, BUT CHANGE $data_value TO
                        //                THE NEXT VALUE THAT IS TO BE STORED.
                        //                      - NOTE: CRNRSTN :: GABRIEL (A MESSENGER FROM
                        //                        THE FURTHEST REACHES OF THE NORTH) CAN
                        //                        RECEIVE A RAW ARRAY DIRECTLY INTO AN EARLY
                        //                        EXECUTION OF THIS ARCHITECTURE. E.G.
                        //                        ARRAY(EMAIL001, EMAIL002, EMAIL003, ...).
                        //                      - NOTE: CRNRSTN :: GABRIEL (A MESSENGER FROM
                        //                        THE FURTHEST REACHES OF THE NORTH) SUPPORTS
                        //                        ACCELERATION OF DATA ACCESSED THROUGH USE
                        //                        OF add_resource DDO MEMORY POINTER
                        //                        OUTPUT (ALBEIT AN EARLIER VERSION OF THIS
                        //                        ARCHITECTURE). EXPECT THIS KIND OF
                        //                        FUNCTIONALITY TO MAKE IT INTO
                        //                        CRNRSTN :: LIGHTSABER.
                        //              + ACCESS OF n+1 ITEMS USING THE SPECIFIED DATA_KEY AND
                        //                DATA TYPE FAMILY (DUAL INDEX POINTER)...AND DON'T
                        //                FORGET USE OF $INDEX + 1 FOR STRUCTURE TRAVERSAL.
                        //              + STORING UP TO THE CHANNEL CONFIGURED MAX_BYTES BYTES.
                        //
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (DDO) SERVICES LAYER.
                        // CHANNEL TRANSLATION CONTROL.
                        //
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // ONLY ACTIVE CHANNELS SHOULD HAVE ACCESS TO THE DDO TRANSLATION
                        // SERVICES LAYER.
                        //
                        // PLEASE SEE, $oCRNRSTN->config_init_channel()
                        // IN CRNRSTN :: CONFIGURATION. [_crnrstn.config.inc.php]
                        if(($this->oCRNRSTN->oCRNRSTN_RRS_MAP->rrs_map_get(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]['NAME'] . '_cache_is_active')) == true){

                            //
                            // TRANSLATE DATA FROM THIS CRNRSTN :: MULTI-
                            // CHANNEL CHANNEL INTO THE CRNRSTN ::
                            // DECOUPLED DATA OBJECT (DDO) SERVICES LAYER.
                            $this->oCRNRSTN->ddo_translate(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]);

//                            //
//                            // CAN WE GO TO CRNRSTN :: PLAID?
//                            if(!($this->gone_to_plaid($_POST[$this->session_salt()], CRNRSTN_ASSET_MAPPING, self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]) == true)){
//
//                                //
//                                // CRNRSTN :: PLAID APPLICATION ACCELERATION.
//                                $this->plaid(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]);
//
//                            }

                        }

                    break;
                    case CRNRSTN_CHANNEL_COOKIE:

                        //
                        // THE CRNRSTN :: PSEUDO-SOAP SERVICES DATA
                        // TUNNEL LAYER (PSSDTL) PACKET WILL
                        // AUTOMATICALLY BE DETECTED AND PROCESSED IF
                        // (1) THE DATA IS AVAILABLE IN $_COOKIE[],
                        // (2) THE CRNRSTN :: MULTI-CHANNEL COOKIE DATA
                        // CHANNEL IS ACTIVE PER $oCRNRSTN->config_init_channel()
                        // SETTINGS IN CRNRSTN :: CONFIGURATION. (SEE, _crnrstn.config.inc.php),
                        // AND (3) MAX BYTE CONFIGURATION SETTINGS (SEE, _crnrstn/_config/_config.defaults/_crnrstn.system_settings.inc.php)
                        // AND SYSTEM OVERRIDES (SEE, _crnrstn/_config/_config.defaults/_crnrstn.system_overrides.inc.php)
                        // ARE NEVER VIOLATED WHEN DATA IS PROCESSED
                        // INTO RUNTIME (THIS WOULD BE ATYPICAL).
                        //
                        // CRNRSTN :: WILL NOT BEGIN DDO DATA
                        // TRANSLATION, AND HIT A MAX_BYTE LIMIT
                        // BEFORE THE LAST ITEM FROM THE SHOPPING CART
                        // OR MAILING LIST RECORD CAN BE PROCESSED INTO
                        // THE RUNTIME DDO. AGAIN, THIS KIND OF DATA
                        // CORRUPTION IN MEMORY WOULD BE ATYPICAL.
                        // PROTECTIONS ARE IN PLACE IN ORDER TO PREVENT
                        // THIS KIND OF THING FROM HAPPENING IN
                        // CRNRSTN :: DDO MEMORY.
                        //
                        // ON TOP OF PROVIDING VALID ITEM COUNTS, BYTE
                        // REPORTING, AND TIMESTAMPS TO THE CLIENT
                        // FACING CRNRSTN :: PERFORMANCE REPORTING
                        // SERVICES LAYER, WHICH SAID REQUIREMENTS
                        // ...BY THEMSELVES...DEMAND NO MODEST DEGREE
                        // OF SCRUTINY AND CONSIDERATION, CRNRSTN ::
                        // HAS BEEN DESIGNED SPECIFICALLY TO DESKTOP,
                        // TABLET, AND MOBILE THESE KINDS OF PURPOSES.
                        //
                        // Saturday, November 4, 2023 @ 2127 hrs.
                        //
                        // THE COMPLETE AND PERFECT MANAGEMENT OF DATA
                        // AND FILES TO PRODUCE A QUALITY BUSINESS TOOL
                        // ON TOP OF THE MIT LICENSE.
                        //
                        // PLEASE SEE, http://crnrstn.evifweb.com/licensing/.
                        //
                        // SUPPORTED CHANNEL AUTHORIZATION PROFILE CONSTANTS ::
                        //  - CRNRSTN_AUTHORIZE_ALL
                        //  - CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_RUNTIME
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP
                        //
                        // CHANNEL AUTHORIZATION PROFILE METHODS ::
                        //  - DEVELOPER SUPPORT:
                        //      ~ $oCRNRSTN->add_resource($data_key, $data_value, $data_type_family, CRNRSTN_AUTHORIZE_COOKIE, $index, $ttl);
                        //        * NOTE: IF THE CLIENT (BROWSER) OPTS IN TO RECEIVE
                        //                COOKIES FROM THE WEBSITE THROUGH CRNRSTN ::
                        //                INTERACT UI COOKIE PREFERENCES [CRNRSTN_UI_COOKIE_PREFERENCE, CRNRSTN_UI_COOKIE_YESNO, CRNRSTN_UI_COOKIE_NOTICE],
                        //                THE BROWSER WILL BE SENT A CRNRSTN :: COOKIE.
                        //
                        //                IF A DEVELOPER TOUCHES THE CRNRSTN :: COOKIE
                        //                SERVICES LAYER, I.E. RUN SOMETHING LIKE $oCRNRSTN->add_raw_cookie(),
                        //                $oCRNRSTN->add_cookie(), $oCRNRSTN->delete_raw_cookie(),
                        //                OR $oCRNRSTN->delete_cookie(), THE CLIENT
                        //                (BROWSER) WILL RECEIVE AN OPT IN PROMPT FROM
                        //                CRNRSTN :: INTERACT UI COOKIE PREFERENCES [CRNRSTN_UI_COOKIE_PREFERENCE, CRNRSTN_UI_COOKIE_YESNO, CRNRSTN_UI_COOKIE_NOTICE],
                        //                AND IF THE CLIENT (BROWSER) OPTS IN TO RECEIVE
                        //                COOKIES FROM THE WEBSITE THROUGH SAID CRNRSTN ::
                        //                INTERACT UI COOKIE PREFERENCES, THE BROWSER WILL
                        //                BE SENT A CRNRSTN :: COOKIE.
                        //
                        //                FURTHERMORE, IT MUST BE STATED THAT ALL CRNRSTN ::
                        //                GENERATED BROWSER COOKIES WILL RECEIVE PSSDTL
                        //                PACKET DATA (UP TO MAX_BYTES SPECIFIED FOR CRNRSTN_CHANNEL_COOKIE
                        //                IN $oCRNRSTN->config_init_channel(). SEE, _crnrstn.config.inc.php.)
                        //                WHEN DATA IS AUTHORIZED FOR THE CRNRSTN :: MULTI-
                        //                CHANNEL COOKIE DATA CHANNEL FOR DEEPEST AND
                        //                RICHEST SERVER $_COOKIE[] INTEGRATIONS.
                        //
                        //                POWER THE SERVER + DATABASE CONFIGURATION (FOR A
                        //                BROWSER'S SESSION) 100% ON TOP OF A CRNRSTN :: OERSL
                        //                ENCRYPTED PSSDTLA PACKET TO BE DELIVERED BY CARRIER
                        //                PIGEON...I MEAN...TO BE DELIVERED BY BROWSER COOKIE.
                        //
                        //                WHAT CAN WE PUT INTO THIS PAYLOAD FOR THE BROWSER?
                        //
                        //                THE CRNRSTN :: PSSDTLA PACKET CAN INCLUDE: PATHS TO
                        //                SERVER CONFIG FILES, SEO ANALYTICS JS <SCRIPT>, HTML
                        //                <HEAD> <META> INJECTIONS, PRODUCTION DB_HOST,
                        //                PRODUCTION DB_USER, PRODUCTION DB_PSWD, PRODUCTION
                        //                DB_NAME, AND EVEN PRODUCTION DB_PORT TOO.
                        //
                        //                IT IS OpenSSL SECURE, THO--...I MEAN..., TOO! - 5
                        //                Monday, November 6, 2023 @ 1552 hrs.
                        //
                        //        * NOTE: IF $ttl = NULL, THE CHANNEL TTL SETTINGS, AS
                        //                PER $oCRNRSTN->config_init_channel() SETTINGS
                        //                IN THE CRNRSTN :: CONFIGURATION FILE (SEE, _crnrstn.config.inc.php),
                        //                WILL EXPIRE THE DATA FROM CACHE. SOME OF THE
                        //                DATA WILL BE EXPIRED BY LAMP STACK MEMORY
                        //                CLEAN UP PROCESSES THAT WILL RUN AT THE
                        //                END WHEN THE CLASS OBJECT DESTRUCTOR
                        //                FIRES...some of the data.
                        //
                        //      ~ $oCRNRSTN->get_resource($data_key, $index, $data_type_family, CRNRSTN_AUTHORIZE_COOKIE);
                        //          NOTE: LETTING $data_authorization_channel = NULL,
                        //                SHOULD BE DESIREABLE (NOT TOO SLOW). I THINK
                        //                THERE MAY BE INTERNAL POINTER STUFF WITHIN THE
                        //                CRNRSTN :: RESPONSE RETURN SERIALIZATION MAPPING
                        //                OBJECT TO MAKE IT FASTER SO THAT NULL CAN BE OK.
                        //      ~ $oCRNRSTN->get_resource_count($data_key, $data_type_family, CRNRSTN_AUTHORIZE_COOKIE);
                        //      ~ if($oCRNRSTN->isset_resource('data_value', $data_key, $data_type_family, $channel, $index) == true){}
                        //          WHERE, $channel = CRNRSTN_CHANNEL_COOKIE OR PLEASE SEE, $oCRNRSTN->get_channel_config($channel, 'NAME') OUTPUT.
                        //
                        //  - CRNRSTN :: CONFIGURATION.
                        //      ~ $oCRNRSTN->config_add_resource($env_key, $data_key, $data_value, $data_type_family, CRNRSTN_AUTHORIZE_COOKIE, $index, $ttl)
                        //        * WHERE $index = NULL WILL SUPPORT:
                        //              + STORING n+1 ITEMS AT THE SPECIFIED DATA_KEY AND
                        //                DATA TYPE FAMILY (DUAL INDEX POINTER). SIMPLY CALL
                        //                THE SAME METHOD AGAIN, BUT CHANGE $data_value TO
                        //                THE NEXT VALUE THAT IS TO BE STORED.
                        //                      - NOTE: CRNRSTN :: GABRIEL (A MESSENGER FROM
                        //                        THE FURTHEST REACHES OF THE NORTH) CAN
                        //                        RECEIVE A RAW ARRAY DIRECTLY INTO AN EARLY
                        //                        EXECUTION OF THIS ARCHITECTURE. E.G.
                        //                        ARRAY(EMAIL001, EMAIL002, EMAIL003, ...).
                        //                      - NOTE: CRNRSTN :: GABRIEL (A MESSENGER FROM
                        //                        THE FURTHEST REACHES OF THE NORTH) SUPPORTS
                        //                        ACCELERATION OF DATA ACCESSED THROUGH USE
                        //                        OF add_resource DDO MEMORY POINTER
                        //                        OUTPUT (ALBEIT AN EARLIER VERSION OF THIS
                        //                        ARCHITECTURE). EXPECT THIS KIND OF
                        //                        FUNCTIONALITY TO MAKE IT INTO
                        //                        CRNRSTN :: LIGHTSABER.
                        //              + ACCESS OF n+1 ITEMS USING THE SPECIFIED DATA_KEY AND
                        //                DATA TYPE FAMILY (DUAL INDEX POINTER)...AND DON'T
                        //                FORGET USE OF $INDEX + 1 FOR STRUCTURE TRAVERSAL.
                        //              + STORING UP TO THE CHANNEL CONFIGURED MAX_BYTES BYTES.
                        //
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (DDO) SERVICES LAYER.
                        // CHANNEL TRANSLATION CONTROL.
                        //
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // ONLY ACTIVE CHANNELS SHOULD HAVE ACCESS TO THE DDO TRANSLATION
                        // SERVICES LAYER.
                        //
                        // PLEASE SEE, $oCRNRSTN->config_init_channel()
                        // IN CRNRSTN :: CONFIGURATION. [_crnrstn.config.inc.php]
                        if(($this->oCRNRSTN->oCRNRSTN_RRS_MAP->rrs_map_get(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]['NAME'] . '_cache_is_active')) == true){

                            //
                            // TRANSLATE DATA FROM THIS CRNRSTN :: MULTI-
                            // CHANNEL CHANNEL INTO THE CRNRSTN ::
                            // DECOUPLED DATA OBJECT (DDO) SERVICES LAYER.
                            $this->oCRNRSTN->ddo_translate(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]);

//                            //
//                            // CAN WE GO TO CRNRSTN :: PLAID?
//                            if(!($this->gone_to_plaid($_GET[$this->session_salt()], CRNRSTN_ASSET_MAPPING, self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]) == true)){
//
//                                //
//                                // CRNRSTN :: PLAID APPLICATION ACCELERATION.
//                                $this->plaid(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]);
//
//                            }

                        }

                    break;
                    case CRNRSTN_CHANNEL_SESSION:

                        //
                        // THE CRNRSTN :: PSEUDO-SOAP SERVICES DATA
                        // TUNNEL LAYER (PSSDTL) PACKET WILL
                        // AUTOMATICALLY BE DETECTED AND PROCESSED IF
                        // (1) THE DATA IS AVAILABLE IN $_SESSION[],
                        // (2) THE CRNRSTN :: MULTI-CHANNEL SESSION DATA
                        // CHANNEL IS ACTIVE PER $oCRNRSTN->config_init_channel()
                        // SETTINGS IN CRNRSTN :: CONFIGURATION. (SEE, _crnrstn.config.inc.php),
                        // AND (3) MAX BYTE CONFIGURATION SETTINGS (SEE, _crnrstn/_config/_config.defaults/_crnrstn.system_settings.inc.php)
                        // AND SYSTEM OVERRIDES (SEE, _crnrstn/_config/_config.defaults/_crnrstn.system_overrides.inc.php)
                        // ARE NEVER VIOLATED WHEN DATA IS PROCESSED
                        // INTO RUNTIME (THIS WOULD BE ATYPICAL).
                        //
                        // CRNRSTN :: WILL NOT BEGIN DDO DATA
                        // TRANSLATION, AND HIT A MAX_BYTE LIMIT
                        // BEFORE THE LAST ITEM FROM THE SHOPPING CART
                        // OR MAILING LIST RECORD CAN BE PROCESSED INTO
                        // THE RUNTIME DDO. AGAIN, THIS KIND OF DATA
                        // CORRUPTION IN MEMORY WOULD BE ATYPICAL.
                        // PROTECTIONS ARE IN PLACE IN ORDER TO PREVENT
                        // THIS KIND OF THING FROM HAPPENING IN
                        // CRNRSTN :: DDO MEMORY.
                        //
                        // ON TOP OF PROVIDING VALID ITEM COUNTS, BYTE
                        // REPORTING, AND TIMESTAMPS TO THE CLIENT
                        // FACING CRNRSTN :: PERFORMANCE REPORTING
                        // SERVICES LAYER, WHICH SAID REQUIREMENTS
                        // ...BY THEMSELVES...DEMAND NO MODEST DEGREE
                        // OF SCRUTINY AND CONSIDERATION, CRNRSTN ::
                        // HAS BEEN DESIGNED SPECIFICALLY TO DESKTOP,
                        // TABLET, AND MOBILE THESE KINDS OF PURPOSES.
                        //
                        // Saturday, November 5, 2023 @ 0459 hrs.
                        //
                        // THE COMPLETE AND PERFECT MANAGEMENT OF DATA
                        // AND FILES TO PRODUCE A QUALITY BUSINESS TOOL
                        // ON TOP OF THE MIT LICENSE.
                        //
                        // PLEASE SEE, http://crnrstn.evifweb.com/licensing/.
                        //
                        // SUPPORTED CHANNEL AUTHORIZATION PROFILE CONSTANTS ::
                        //  - CRNRSTN_AUTHORIZE_ALL
                        //  - CRNRSTN_AUTHORIZE_SESSION
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_RUNTIME
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE
                        //
                        // CHANNEL AUTHORIZATION PROFILE METHODS ::
                        //  - DEVELOPER SUPPORT:
                        //      ~ $oCRNRSTN->add_resource($data_key, $data_value, $data_type_family, CRNRSTN_AUTHORIZE_SESSION, $index, $ttl);
                        //        * NOTE: ALL HTTP/HTTPS SYSTEM GENERATED LINKS WILL
                        //                RECEIVE PSSDTL PACKET DATA (UP TO MAX_BYTES
                        //                SPECIFIED FOR CRNRSTN_CHANNEL_SESSION IN $oCRNRSTN->config_init_channel().
                        //                SEE, _crnrstn.config.inc.php.) WHEN DATA IS
                        //                AUTHORIZED FOR THE CRNRSTN :: MULTI-CHANNEL SESSION
                        //                DATA CHANNEL FOR DEEPEST AND RICHEST SERVER
                        //                $_SESSION INTEGRATIONS.
                        //        * NOTE: IF $ttl = NULL, THE CHANNEL TTL SETTINGS, AS
                        //                PER $oCRNRSTN->config_init_channel() SETTINGS
                        //                IN THE CRNRSTN :: CONFIGURATION FILE (SEE, _crnrstn.config.inc.php),
                        //                WILL EXPIRE THE DATA FROM CACHE. SOME OF THE
                        //                DATA WILL BE EXPIRED BY LAMP STACK MEMORY
                        //                CLEAN UP PROCESSES THAT WILL RUN AT THE
                        //                END WHEN THE CLASS OBJECT DESTRUCTOR
                        //                FIRES...some of the data.
                        //
                        //      ~ $oCRNRSTN->get_resource($data_key, $index, $data_type_family, CRNRSTN_AUTHORIZE_SESSION);
                        //          NOTE: LETTING $data_authorization_channel = NULL,
                        //                SHOULD BE DESIREABLE (NOT TOO SLOW). I THINK
                        //                THERE MAY BE INTERNAL POINTER STUFF WITHIN THE
                        //                CRNRSTN :: RESPONSE RETURN SERIALIZATION MAPPING
                        //                OBJECT TO MAKE IT FASTER SO THAT NULL CAN BE OK.
                        //      ~ $oCRNRSTN->get_resource_count($data_key, $data_type_family, CRNRSTN_AUTHORIZE_SESSION);
                        //      ~ if($oCRNRSTN->isset_resource('data_value', $data_key, $data_type_family, $channel, $index) == true){}
                        //          WHERE, $channel = CRNRSTN_CHANNEL_SESSION OR PLEASE SEE, $oCRNRSTN->get_channel_config($channel, 'NAME') OUTPUT.
                        //
                        //  - CRNRSTN :: CONFIGURATION.
                        //      ~ $oCRNRSTN->config_add_resource($env_key, $data_key, $data_value, $data_type_family, CRNRSTN_AUTHORIZE_SESSION, $index, $ttl)
                        //        * WHERE $index = NULL WILL SUPPORT:
                        //              + STORING n+1 ITEMS AT THE SPECIFIED DATA_KEY AND
                        //                DATA TYPE FAMILY (DUAL INDEX POINTER). SIMPLY CALL
                        //                THE SAME METHOD AGAIN, BUT CHANGE $data_value TO
                        //                THE NEXT VALUE THAT IS TO BE STORED.
                        //                      - NOTE: CRNRSTN :: GABRIEL (A MESSENGER FROM
                        //                        THE FURTHEST REACHES OF THE NORTH) CAN
                        //                        RECEIVE A RAW ARRAY DIRECTLY INTO AN EARLY
                        //                        EXECUTION OF THIS ARCHITECTURE. E.G.
                        //                        ARRAY(EMAIL001, EMAIL002, EMAIL003, ...).
                        //                      - NOTE: CRNRSTN :: GABRIEL (A MESSENGER FROM
                        //                        THE FURTHEST REACHES OF THE NORTH) SUPPORTS
                        //                        ACCELERATION OF DATA ACCESSED THROUGH USE
                        //                        OF add_resource DDO MEMORY POINTER
                        //                        OUTPUT (ALBEIT AN EARLIER VERSION OF THIS
                        //                        ARCHITECTURE). EXPECT THIS KIND OF
                        //                        FUNCTIONALITY TO MAKE IT INTO
                        //                        CRNRSTN :: LIGHTSABER.
                        //              + ACCESS OF n+1 ITEMS USING THE SPECIFIED DATA_KEY AND
                        //                DATA TYPE FAMILY (DUAL INDEX POINTER)...AND DON'T
                        //                FORGET USE OF $INDEX + 1 FOR STRUCTURE TRAVERSAL.
                        //              + STORING UP TO THE CHANNEL CONFIGURED MAX_BYTES BYTES.
                        //
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (DDO) SERVICES LAYER.
                        // CHANNEL TRANSLATION CONTROL.
                        //
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // ONLY ACTIVE CHANNELS SHOULD HAVE ACCESS TO THE DDO TRANSLATION
                        // SERVICES LAYER.
                        //
                        // PLEASE SEE, $oCRNRSTN->config_init_channel()
                        // IN CRNRSTN :: CONFIGURATION. [_crnrstn.config.inc.php]
                        if(($this->oCRNRSTN->oCRNRSTN_RRS_MAP->rrs_map_get(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]['NAME'] . '_cache_is_active')) == true){

                            //
                            // TRANSLATE DATA FROM THIS CRNRSTN :: MULTI-
                            // CHANNEL CHANNEL INTO THE CRNRSTN ::
                            // DECOUPLED DATA OBJECT (DDO) SERVICES LAYER.
                            $this->oCRNRSTN->ddo_translate(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]);

//                            //
//                            // CAN WE GO TO CRNRSTN :: PLAID?
//                            if(!($this->gone_to_plaid($_GET[$this->session_salt()], CRNRSTN_ASSET_MAPPING, self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]) == true)){
//
//                                //
//                                // CRNRSTN :: PLAID APPLICATION ACCELERATION.
//                                $this->plaid(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]);
//
//                            }

                        }

                    break;
                    case CRNRSTN_CHANNEL_DATABASE:

                        //
                        // THE CRNRSTN :: PSEUDO-SOAP SERVICES DATA
                        // TUNNEL LAYER (PSSDTL) PACKET WILL
                        // AUTOMATICALLY BE DETECTED AND PROCESSED IF
                        // (1) THE DATA IS AVAILABLE IN THE DATABASE,
                        // (2) THE CRNRSTN :: MULTI-CHANNEL DATABASE
                        // DATA CHANNEL IS ACTIVE PER $oCRNRSTN->config_init_channel()
                        // SETTINGS IN CRNRSTN :: CONFIGURATION. (SEE, _crnrstn.config.inc.php),
                        // AND (3) MAX BYTE CONFIGURATION SETTINGS (SEE, _crnrstn/_config/_config.defaults/_crnrstn.system_settings.inc.php)
                        // AND SYSTEM OVERRIDES (SEE, _crnrstn/_config/_config.defaults/_crnrstn.system_overrides.inc.php)
                        // ARE NEVER VIOLATED WHEN DATA IS PROCESSED
                        // INTO RUNTIME (THIS WOULD BE ATYPICAL).
                        //
                        // CRNRSTN :: WILL NOT BEGIN DDO DATA
                        // TRANSLATION, AND HIT A MAX_BYTE LIMIT
                        // BEFORE THE LAST ITEM FROM THE SHOPPING CART
                        // OR MAILING LIST RECORD CAN BE PROCESSED INTO
                        // THE RUNTIME DDO. AGAIN, THIS KIND OF DATA
                        // CORRUPTION IN MEMORY WOULD BE ATYPICAL.
                        // PROTECTIONS ARE IN PLACE IN ORDER TO PREVENT
                        // THIS KIND OF THING FROM HAPPENING IN
                        // CRNRSTN :: DDO MEMORY.
                        //
                        // ON TOP OF PROVIDING VALID ITEM COUNTS, BYTE
                        // REPORTING, AND TIMESTAMPS TO THE CLIENT
                        // FACING CRNRSTN :: PERFORMANCE REPORTING
                        // SERVICES LAYER, WHICH SAID REQUIREMENTS
                        // ...BY THEMSELVES...DEMAND NO MODEST DEGREE
                        // OF SCRUTINY AND CONSIDERATION, CRNRSTN ::
                        // HAS BEEN DESIGNED SPECIFICALLY TO DESKTOP,
                        // TABLET, AND MOBILE THESE KINDS OF PURPOSES.
                        //
                        // Saturday, November 4, 2023 @ 2127 hrs.
                        //
                        // THE COMPLETE AND PERFECT MANAGEMENT OF DATA
                        // AND FILES TO PRODUCE A QUALITY BUSINESS TOOL
                        // ON TOP OF THE MIT LICENSE.
                        //
                        // PLEASE SEE, http://crnrstn.evifweb.com/licensing/.
                        //
                        // SUPPORTED CHANNEL AUTHORIZATION PROFILE CONSTANTS ::
                        //  - CRNRSTN_AUTHORIZE_ALL
                        //  - CRNRSTN_AUTHORIZE_DATABASE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_RUNTIME
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE
                        //
                        // CHANNEL AUTHORIZATION PROFILE METHODS ::
                        //  - DEVELOPER SUPPORT:
                        //      ~ $oCRNRSTN->add_resource($data_key, $data_value, $data_type_family, CRNRSTN_AUTHORIZE_DATABASE, $index, $ttl);
                        //        * NOTE: ALL HTTP/HTTPS SYSTEM GENERATED LINKS WILL
                        //                RECEIVE PSSDTL PACKET DATA (UP TO MAX_BYTES
                        //                SPECIFIED FOR CRNRSTN_CHANNEL_DATABASE IN $oCRNRSTN->config_init_channel().
                        //                SEE, _crnrstn.config.inc.php.) WHEN DATA IS
                        //                AUTHORIZED FOR THE CRNRSTN :: MULTI-CHANNEL
                        //                DATABASE DATA CHANNEL FOR DEEPEST AND RICHEST
                        //                SERVER DATABASE INTEGRATIONS.
                        //        * NOTE: IF $ttl = NULL, THE CHANNEL TTL SETTINGS, AS
                        //                PER $oCRNRSTN->config_init_channel() SETTINGS
                        //                IN THE CRNRSTN :: CONFIGURATION FILE (SEE, _crnrstn.config.inc.php),
                        //                WILL EXPIRE THE DATA FROM CACHE. SOME OF THE
                        //                DATA WILL BE EXPIRED BY LAMP STACK MEMORY
                        //                CLEAN UP PROCESSES THAT WILL RUN AT THE
                        //                END WHEN THE CLASS OBJECT DESTRUCTOR
                        //                FIRES...some of the data.
                        //
                        //      ~ $oCRNRSTN->get_resource($data_key, $index, $data_type_family, CRNRSTN_AUTHORIZE_DATABASE);
                        //          NOTE: LETTING $data_authorization_channel = NULL,
                        //                SHOULD BE DESIREABLE (NOT TOO SLOW). I THINK
                        //                THERE MAY BE INTERNAL POINTER STUFF WITHIN THE
                        //                CRNRSTN :: RESPONSE RETURN SERIALIZATION MAPPING
                        //                OBJECT TO MAKE IT FASTER SO THAT NULL CAN BE OK.
                        //      ~ $oCRNRSTN->get_resource_count($data_key, $data_type_family, CRNRSTN_AUTHORIZE_DATABASE);
                        //      ~ if($oCRNRSTN->isset_resource('data_value', $data_key, $data_type_family, $channel, $index) == true){}
                        //          WHERE, $channel = CRNRSTN_CHANNEL_DATABASE OR PLEASE SEE, $oCRNRSTN->get_channel_config($channel, 'NAME') OUTPUT.
                        //
                        //  - CRNRSTN :: CONFIGURATION.
                        //      ~ $oCRNRSTN->config_add_resource($env_key, $data_key, $data_value, $data_type_family, CRNRSTN_AUTHORIZE_DATABASE, $index, $ttl)
                        //        * WHERE $index = NULL WILL SUPPORT:
                        //              + STORING n+1 ITEMS AT THE SPECIFIED DATA_KEY AND
                        //                DATA TYPE FAMILY (DUAL INDEX POINTER). SIMPLY CALL
                        //                THE SAME METHOD AGAIN, BUT CHANGE $data_value TO
                        //                THE NEXT VALUE THAT IS TO BE STORED.
                        //                      - NOTE: CRNRSTN :: GABRIEL (A MESSENGER FROM
                        //                        THE FURTHEST REACHES OF THE NORTH) CAN
                        //                        RECEIVE A RAW ARRAY DIRECTLY INTO AN EARLY
                        //                        EXECUTION OF THIS ARCHITECTURE. E.G.
                        //                        ARRAY(EMAIL001, EMAIL002, EMAIL003, ...).
                        //                      - NOTE: CRNRSTN :: GABRIEL (A MESSENGER FROM
                        //                        THE FURTHEST REACHES OF THE NORTH) SUPPORTS
                        //                        ACCELERATION OF DATA ACCESSED THROUGH USE
                        //                        OF add_resource DDO MEMORY POINTER
                        //                        OUTPUT (ALBEIT AN EARLIER VERSION OF THIS
                        //                        ARCHITECTURE). EXPECT THIS KIND OF
                        //                        FUNCTIONALITY TO MAKE IT INTO
                        //                        CRNRSTN :: LIGHTSABER.
                        //              + ACCESS OF n+1 ITEMS USING THE SPECIFIED DATA_KEY AND
                        //                DATA TYPE FAMILY (DUAL INDEX POINTER)...AND DON'T
                        //                FORGET USE OF $INDEX + 1 FOR STRUCTURE TRAVERSAL.
                        //              + STORING UP TO THE CHANNEL CONFIGURED MAX_BYTES BYTES.
                        //
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (DDO) SERVICES LAYER.
                        // CHANNEL TRANSLATION CONTROL.
                        //
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // ONLY ACTIVE CHANNELS SHOULD HAVE ACCESS TO THE DDO TRANSLATION
                        // SERVICES LAYER.
                        //
                        // PLEASE SEE, $oCRNRSTN->config_init_channel()
                        // IN CRNRSTN :: CONFIGURATION. [_crnrstn.config.inc.php]
                        if(($this->oCRNRSTN->oCRNRSTN_RRS_MAP->rrs_map_get(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]['NAME'] . '_cache_is_active')) == true){

                            //
                            // TRANSLATE DATA FROM THIS CRNRSTN :: MULTI-
                            // CHANNEL CHANNEL INTO THE CRNRSTN ::
                            // DECOUPLED DATA OBJECT (DDO) SERVICES LAYER.
                            $this->oCRNRSTN->ddo_translate(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]);

//                            //
//                            // CAN WE GO TO CRNRSTN :: PLAID?
//                            if(!($this->gone_to_plaid($_GET[$this->session_salt()], CRNRSTN_ASSET_MAPPING, self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]) == true)){
//
//                                //
//                                // CRNRSTN :: PLAID APPLICATION ACCELERATION.
//                                $this->plaid(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]);
//
//                            }

                        }

                    break;
                    case CRNRSTN_CHANNEL_SSDTLA:

                        //
                        // THE CRNRSTN :: PSEUDO-SOAP SERVICES DATA
                        // TUNNEL LAYER (PSSDTL) PACKET WILL
                        // AUTOMATICALLY BE DETECTED AND PROCESSED IF
                        // (1) THE DATA IS AVAILABLE FROM THE BROWSER,
                        // (2) THE CRNRSTN :: MULTI-CHANNEL SSDTLA DATA
                        // CHANNEL IS ACTIVE PER $oCRNRSTN->config_init_channel()
                        // SETTINGS IN CRNRSTN :: CONFIGURATION. (SEE, _crnrstn.config.inc.php),
                        // AND (3) MAX BYTE CONFIGURATION SETTINGS (SEE, _crnrstn/_config/_config.defaults/_crnrstn.system_settings.inc.php)
                        // AND SYSTEM OVERRIDES (SEE, _crnrstn/_config/_config.defaults/_crnrstn.system_overrides.inc.php)
                        // ARE NEVER VIOLATED WHEN DATA IS PROCESSED
                        // INTO RUNTIME (THIS WOULD BE ATYPICAL).
                        //
                        // CRNRSTN :: WILL NOT BEGIN DDO DATA
                        // TRANSLATION, AND HIT A MAX_BYTE LIMIT
                        // BEFORE THE LAST ITEM FROM THE SHOPPING CART
                        // OR MAILING LIST RECORD CAN BE PROCESSED INTO
                        // THE RUNTIME DDO. AGAIN, THIS KIND OF DATA
                        // CORRUPTION IN MEMORY WOULD BE ATYPICAL.
                        // PROTECTIONS ARE IN PLACE IN ORDER TO PREVENT
                        // THIS KIND OF THING FROM HAPPENING IN
                        // CRNRSTN :: DDO MEMORY.
                        //
                        // ON TOP OF PROVIDING VALID ITEM COUNTS, BYTE
                        // REPORTING, AND TIMESTAMPS TO THE CLIENT
                        // FACING CRNRSTN :: PERFORMANCE REPORTING
                        // SERVICES LAYER, WHICH SAID REQUIREMENTS
                        // ...BY THEMSELVES...DEMAND NO MODEST DEGREE
                        // OF SCRUTINY AND CONSIDERATION, CRNRSTN ::
                        // HAS BEEN DESIGNED SPECIFICALLY TO DESKTOP,
                        // TABLET, AND MOBILE THESE KINDS OF PURPOSES.
                        //
                        // Saturday, November 5, 2023 @ 0506 hrs.
                        //
                        // THE COMPLETE AND PERFECT MANAGEMENT OF DATA
                        // AND FILES TO PRODUCE A QUALITY BUSINESS TOOL
                        // ON TOP OF THE MIT LICENSE.
                        //
                        // PLEASE SEE, http://crnrstn.evifweb.com/licensing/.
                        //
                        // SUPPORTED CHANNEL AUTHORIZATION PROFILE CONSTANTS ::
                        //  - CRNRSTN_AUTHORIZE_ALL
                        //  - CRNRSTN_AUTHORIZE_SSDTLA
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_RUNTIME
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE
                        //
                        // CHANNEL AUTHORIZATION PROFILE METHODS ::
                        //  - DEVELOPER SUPPORT:
                        //      ~ $oCRNRSTN->add_resource($data_key, $data_value, $data_type_family, CRNRSTN_AUTHORIZE_SSDTLA, $index, $ttl);
                        //        * NOTE: ALL HTTP/HTTPS SYSTEM GENERATED LINKS WILL
                        //                RECEIVE PSSDTL PACKET DATA (UP TO MAX_BYTES
                        //                SPECIFIED FOR CRNRSTN_CHANNEL_SSDTLA IN $oCRNRSTN->config_init_channel().
                        //                SEE, _crnrstn.config.inc.php.) WHEN DATA IS
                        //                AUTHORIZED FOR THE CRNRSTN :: MULTI-CHANNEL
                        //                SSDTLA DATA CHANNEL FOR DEEPEST AND RICHEST
                        //                SERVER-BROWSER INTEGRATIONS.
                        //        * NOTE: IF $ttl = NULL, THE CHANNEL TTL SETTINGS, AS
                        //                PER $oCRNRSTN->config_init_channel() SETTINGS
                        //                IN THE CRNRSTN :: CONFIGURATION FILE (SEE, _crnrstn.config.inc.php),
                        //                WILL EXPIRE THE DATA FROM CACHE. SOME OF THE
                        //                DATA WILL BE EXPIRED BY LAMP STACK MEMORY
                        //                CLEAN UP PROCESSES THAT WILL RUN AT THE
                        //                END WHEN THE CLASS OBJECT DESTRUCTOR
                        //                FIRES...some of the data.
                        //
                        //      ~ $oCRNRSTN->get_resource($data_key, $index, $data_type_family, CRNRSTN_AUTHORIZE_SSDTLA);
                        //          NOTE: LETTING $data_authorization_channel = NULL,
                        //                SHOULD BE DESIREABLE (NOT TOO SLOW). I THINK
                        //                THERE MAY BE INTERNAL POINTER STUFF WITHIN THE
                        //                CRNRSTN :: RESPONSE RETURN SERIALIZATION MAPPING
                        //                OBJECT TO MAKE IT FASTER SO THAT NULL CAN BE OK.
                        //      ~ $oCRNRSTN->get_resource_count($data_key, $data_type_family, CRNRSTN_AUTHORIZE_SSDTLA);
                        //      ~ if($oCRNRSTN->isset_resource('data_value', $data_key, $data_type_family, $channel, $index) == true){}
                        //          WHERE, $channel = CRNRSTN_CHANNEL_SSDTLA OR PLEASE SEE, $oCRNRSTN->get_channel_config($channel, 'NAME') OUTPUT.
                        //
                        //  - CRNRSTN :: CONFIGURATION.
                        //      ~ $oCRNRSTN->config_add_resource($env_key, $data_key, $data_value, $data_type_family, CRNRSTN_AUTHORIZE_SSDTLA, $index, $ttl)
                        //        * WHERE $index = NULL WILL SUPPORT:
                        //              + STORING n+1 ITEMS AT THE SPECIFIED DATA_KEY AND
                        //                DATA TYPE FAMILY (DUAL INDEX POINTER). SIMPLY CALL
                        //                THE SAME METHOD AGAIN, BUT CHANGE $data_value TO
                        //                THE NEXT VALUE THAT IS TO BE STORED.
                        //                      - NOTE: CRNRSTN :: GABRIEL (A MESSENGER FROM
                        //                        THE FURTHEST REACHES OF THE NORTH) CAN
                        //                        RECEIVE A RAW ARRAY DIRECTLY INTO AN EARLY
                        //                        EXECUTION OF THIS ARCHITECTURE. E.G.
                        //                        ARRAY(EMAIL001, EMAIL002, EMAIL003, ...).
                        //                      - NOTE: CRNRSTN :: GABRIEL (A MESSENGER FROM
                        //                        THE FURTHEST REACHES OF THE NORTH) SUPPORTS
                        //                        ACCELERATION OF DATA ACCESSED THROUGH USE
                        //                        OF add_resource DDO MEMORY POINTER
                        //                        OUTPUT (ALBEIT AN EARLIER VERSION OF THIS
                        //                        ARCHITECTURE). EXPECT THIS KIND OF
                        //                        FUNCTIONALITY TO MAKE IT INTO
                        //                        CRNRSTN :: LIGHTSABER.
                        //              + ACCESS OF n+1 ITEMS USING THE SPECIFIED DATA_KEY AND
                        //                DATA TYPE FAMILY (DUAL INDEX POINTER)...AND DON'T
                        //                FORGET USE OF $INDEX + 1 FOR STRUCTURE TRAVERSAL.
                        //              + STORING UP TO THE CHANNEL CONFIGURED MAX_BYTES BYTES.
                        //
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (DDO) SERVICES LAYER.
                        // CHANNEL TRANSLATION CONTROL.
                        //
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // ONLY ACTIVE CHANNELS SHOULD HAVE ACCESS TO THE DDO TRANSLATION
                        // SERVICES LAYER.
                        //
                        // PLEASE SEE, $oCRNRSTN->config_init_channel()
                        // IN CRNRSTN :: CONFIGURATION. [_crnrstn.config.inc.php]
                        if(($this->oCRNRSTN->oCRNRSTN_RRS_MAP->rrs_map_get(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]['NAME'] . '_cache_is_active')) == true){

                            //
                            // TRANSLATE DATA FROM THIS CRNRSTN :: MULTI-
                            // CHANNEL CHANNEL INTO THE CRNRSTN ::
                            // DECOUPLED DATA OBJECT (DDO) SERVICES LAYER.
                            $this->oCRNRSTN->ddo_translate(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]);

//                            //
//                            // CAN WE GO TO CRNRSTN :: PLAID?
//                            if(!($this->gone_to_plaid($_GET[$this->session_salt()], CRNRSTN_ASSET_MAPPING, self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]) == true)){
//
//                                //
//                                // CRNRSTN :: PLAID APPLICATION ACCELERATION.
//                                $this->plaid(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]);
//
//                            }

                        }

                    break;
                    case CRNRSTN_CHANNEL_PSSDTLA:

                        //
                        // THE CRNRSTN :: PSEUDO-SOAP SERVICES DATA
                        // TUNNEL LAYER (PSSDTL) PACKET WILL
                        // AUTOMATICALLY BE DETECTED AND PROCESSED IF
                        // (1) THE DATA IS AVAILABLE FROM THE BROWSER,
                        // (2) THE CRNRSTN :: MULTI-CHANNEL PSSDTLA DATA
                        // CHANNEL IS ACTIVE PER $oCRNRSTN->config_init_channel()
                        // SETTINGS IN CRNRSTN :: CONFIGURATION. (SEE, _crnrstn.config.inc.php),
                        // AND (3) MAX BYTE CONFIGURATION SETTINGS (SEE, _crnrstn/_config/_config.defaults/_crnrstn.system_settings.inc.php)
                        // AND SYSTEM OVERRIDES (SEE, _crnrstn/_config/_config.defaults/_crnrstn.system_overrides.inc.php)
                        // ARE NEVER VIOLATED WHEN DATA IS PROCESSED
                        // INTO RUNTIME (THIS WOULD BE ATYPICAL).
                        //
                        // CRNRSTN :: WILL NOT BEGIN DDO DATA
                        // TRANSLATION, AND HIT A MAX_BYTE LIMIT
                        // BEFORE THE LAST ITEM FROM THE SHOPPING CART
                        // OR MAILING LIST RECORD CAN BE PROCESSED INTO
                        // THE RUNTIME DDO. AGAIN, THIS KIND OF DATA
                        // CORRUPTION IN MEMORY WOULD BE ATYPICAL.
                        // PROTECTIONS ARE IN PLACE IN ORDER TO PREVENT
                        // THIS KIND OF THING FROM HAPPENING IN
                        // CRNRSTN :: DDO MEMORY.
                        //
                        // ON TOP OF PROVIDING VALID ITEM COUNTS, BYTE
                        // REPORTING, AND TIMESTAMPS TO THE CLIENT
                        // FACING CRNRSTN :: PERFORMANCE REPORTING
                        // SERVICES LAYER, WHICH SAID REQUIREMENTS
                        // ...BY THEMSELVES...DEMAND NO MODEST DEGREE
                        // OF SCRUTINY AND CONSIDERATION, CRNRSTN ::
                        // HAS BEEN DESIGNED SPECIFICALLY TO DESKTOP,
                        // TABLET, AND MOBILE THESE KINDS OF PURPOSES.
                        //
                        // Saturday, November 4, 2023 @ 2127 hrs.
                        //
                        // THE COMPLETE AND PERFECT MANAGEMENT OF DATA
                        // AND FILES TO PRODUCE A QUALITY BUSINESS TOOL
                        // ON TOP OF THE MIT LICENSE.
                        //
                        // PLEASE SEE, http://crnrstn.evifweb.com/licensing/.
                        //
                        // SUPPORTED CHANNEL AUTHORIZATION PROFILE CONSTANTS ::
                        //  - CRNRSTN_AUTHORIZE_ALL
                        //  - CRNRSTN_AUTHORIZE_PSSDTLA
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_RUNTIME
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE
                        //
                        // CHANNEL AUTHORIZATION PROFILE METHODS ::
                        //  - DEVELOPER SUPPORT:
                        //      ~ $oCRNRSTN->add_resource($data_key, $data_value, $data_type_family, CRNRSTN_AUTHORIZE_PSSDTLA, $index, $ttl);
                        //        * NOTE: ALL HTTP/HTTPS SYSTEM GENERATED LINKS WILL
                        //                RECEIVE PSSDTL PACKET DATA (UP TO MAX_BYTES
                        //                SPECIFIED FOR CRNRSTN_CHANNEL_PSSDTLA IN $oCRNRSTN->config_init_channel().
                        //                SEE, _crnrstn.config.inc.php.) WHEN DATA IS
                        //                AUTHORIZED FOR THE CRNRSTN :: MULTI-CHANNEL
                        //                PSSDTLA DATA CHANNEL FOR DEEPEST AND RICHEST
                        //                SERVER-BROWSER INTEGRATIONS.
                        //        * NOTE: IF $ttl = NULL, THE CHANNEL TTL SETTINGS, AS
                        //                PER $oCRNRSTN->config_init_channel() SETTINGS
                        //                IN THE CRNRSTN :: CONFIGURATION FILE (SEE, _crnrstn.config.inc.php),
                        //                WILL EXPIRE THE DATA FROM CACHE. SOME OF THE
                        //                DATA WILL BE EXPIRED BY LAMP STACK MEMORY
                        //                CLEAN UP PROCESSES THAT WILL RUN AT THE
                        //                END WHEN THE CLASS OBJECT DESTRUCTOR
                        //                FIRES...some of the data.
                        //
                        //      ~ $oCRNRSTN->get_resource($data_key, $index, $data_type_family, CRNRSTN_AUTHORIZE_PSSDTLA);
                        //          NOTE: LETTING $data_authorization_channel = NULL,
                        //                SHOULD BE DESIREABLE (NOT TOO SLOW). I THINK
                        //                THERE MAY BE INTERNAL POINTER STUFF WITHIN THE
                        //                CRNRSTN :: RESPONSE RETURN SERIALIZATION MAPPING
                        //                OBJECT TO MAKE IT FASTER SO THAT NULL CAN BE OK.
                        //      ~ $oCRNRSTN->get_resource_count($data_key, $data_type_family, CRNRSTN_AUTHORIZE_PSSDTLA);
                        //      ~ if($oCRNRSTN->isset_resource('data_value', $data_key, $data_type_family, $channel, $index) == true){}
                        //          WHERE, $channel = CRNRSTN_CHANNEL_PSSDTLA OR PLEASE SEE, $oCRNRSTN->get_channel_config($channel, 'NAME') OUTPUT.
                        //
                        //  - CRNRSTN :: CONFIGURATION.
                        //      ~ $oCRNRSTN->config_add_resource($env_key, $data_key, $data_value, $data_type_family, CRNRSTN_AUTHORIZE_PSSDTLA, $index, $ttl)
                        //        * WHERE $index = NULL WILL SUPPORT:
                        //              + STORING n+1 ITEMS AT THE SPECIFIED DATA_KEY AND
                        //                DATA TYPE FAMILY (DUAL INDEX POINTER). SIMPLY CALL
                        //                THE SAME METHOD AGAIN, BUT CHANGE $data_value TO
                        //                THE NEXT VALUE THAT IS TO BE STORED.
                        //                      - NOTE: CRNRSTN :: GABRIEL (A MESSENGER FROM
                        //                        THE FURTHEST REACHES OF THE NORTH) CAN
                        //                        RECEIVE A RAW ARRAY DIRECTLY INTO AN EARLY
                        //                        EXECUTION OF THIS ARCHITECTURE. E.G.
                        //                        ARRAY(EMAIL001, EMAIL002, EMAIL003, ...).
                        //                      - NOTE: CRNRSTN :: GABRIEL (A MESSENGER FROM
                        //                        THE FURTHEST REACHES OF THE NORTH) SUPPORTS
                        //                        ACCELERATION OF DATA ACCESSED THROUGH USE
                        //                        OF add_resource DDO MEMORY POINTER
                        //                        OUTPUT (ALBEIT AN EARLIER VERSION OF THIS
                        //                        ARCHITECTURE). EXPECT THIS KIND OF
                        //                        FUNCTIONALITY TO MAKE IT INTO
                        //                        CRNRSTN :: LIGHTSABER.
                        //              + ACCESS OF n+1 ITEMS USING THE SPECIFIED DATA_KEY AND
                        //                DATA TYPE FAMILY (DUAL INDEX POINTER)...AND DON'T
                        //                FORGET USE OF $INDEX + 1 FOR STRUCTURE TRAVERSAL.
                        //              + STORING UP TO THE CHANNEL CONFIGURED MAX_BYTES BYTES.
                        //
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (DDO) SERVICES LAYER.
                        // CHANNEL TRANSLATION CONTROL.
                        //
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // ONLY ACTIVE CHANNELS SHOULD HAVE ACCESS TO THE DDO TRANSLATION
                        // SERVICES LAYER.
                        //
                        // PLEASE SEE, $oCRNRSTN->config_init_channel()
                        // IN CRNRSTN :: CONFIGURATION. [_crnrstn.config.inc.php]
                        if(($this->oCRNRSTN->oCRNRSTN_RRS_MAP->rrs_map_get(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]['NAME'] . '_cache_is_active')) == true){

                            //
                            // TRANSLATE DATA FROM THIS CRNRSTN :: MULTI-
                            // CHANNEL CHANNEL INTO THE CRNRSTN ::
                            // DECOUPLED DATA OBJECT (DDO) SERVICES LAYER.
                            $this->oCRNRSTN->ddo_translate(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]);

//                            //
//                            // CAN WE GO TO CRNRSTN :: PLAID?
//                            if(!($this->gone_to_plaid($_GET[$this->session_salt()], CRNRSTN_ASSET_MAPPING, self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]) == true)){
//
//                                //
//                                // CRNRSTN :: PLAID APPLICATION ACCELERATION.
//                                $this->plaid(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]);
//
//                            }

                        }

                    break;
                    case CRNRSTN_CHANNEL_RUNTIME:

                        //
                        // THE CRNRSTN :: PSEUDO-SOAP SERVICES DATA
                        // TUNNEL LAYER (PSSDTL) PACKET WILL
                        // AUTOMATICALLY BE DETECTED AND PROCESSED IF
                        // (1) THE DATA IS AVAILABLE,
                        // (2) THE CRNRSTN :: MULTI-CHANNEL RUNTIME DATA
                        // CHANNEL IS ACTIVE PER $oCRNRSTN->config_init_channel()
                        // SETTINGS IN CRNRSTN :: CONFIGURATION. (SEE, _crnrstn.config.inc.php),
                        // AND (3) MAX BYTE CONFIGURATION SETTINGS (SEE, _crnrstn/_config/_config.defaults/_crnrstn.system_settings.inc.php)
                        // AND SYSTEM OVERRIDES (SEE, _crnrstn/_config/_config.defaults/_crnrstn.system_overrides.inc.php)
                        // ARE NEVER VIOLATED WHEN DATA IS PROCESSED
                        // INTO RUNTIME (THIS WOULD BE ATYPICAL).
                        //
                        // CRNRSTN :: WILL NOT BEGIN DDO DATA
                        // TRANSLATION, AND HIT A MAX_BYTE LIMIT
                        // BEFORE THE LAST ITEM FROM THE SHOPPING CART
                        // OR MAILING LIST RECORD CAN BE PROCESSED INTO
                        // THE RUNTIME DDO. AGAIN, THIS KIND OF DATA
                        // CORRUPTION IN MEMORY WOULD BE ATYPICAL.
                        // PROTECTIONS ARE IN PLACE IN ORDER TO PREVENT
                        // THIS KIND OF THING FROM HAPPENING IN
                        // CRNRSTN :: DDO MEMORY.
                        //
                        // ON TOP OF PROVIDING VALID ITEM COUNTS, BYTE
                        // REPORTING, AND TIMESTAMPS TO THE CLIENT
                        // FACING CRNRSTN :: PERFORMANCE REPORTING
                        // SERVICES LAYER, WHICH SAID REQUIREMENTS
                        // ...BY THEMSELVES...DEMAND NO MODEST DEGREE
                        // OF SCRUTINY AND CONSIDERATION, CRNRSTN ::
                        // HAS BEEN DESIGNED SPECIFICALLY TO DESKTOP,
                        // TABLET, AND MOBILE THESE KINDS OF PURPOSES.
                        //
                        // Saturday, November 4, 2023 @ 2127 hrs.
                        //
                        // THE COMPLETE AND PERFECT MANAGEMENT OF DATA
                        // AND FILES TO PRODUCE A QUALITY BUSINESS TOOL
                        // ON TOP OF THE MIT LICENSE.
                        //
                        // PLEASE SEE, http://crnrstn.evifweb.com/licensing/.
                        //
                        // SUPPORTED CHANNEL AUTHORIZATION PROFILE CONSTANTS ::
                        //
                        //  - CRNRSTN_AUTHORIZE_ALL
                        //  - CRNRSTN_AUTHORIZE_DATABASE
                        //  - CRNRSTN_AUTHORIZE_SSDTLA
                        //  - CRNRSTN_AUTHORIZE_PSSDTLA
                        //  - CRNRSTN_AUTHORIZE_SESSION
                        //  - CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_SOAP
                        //  - CRNRSTN_AUTHORIZE_GET
                        //  - CRNRSTN_AUTHORIZE_POST
                        //  - CRNRSTN_AUTHORIZE_RUNTIME
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE
                        //
                        // CHANNEL AUTHORIZATION PROFILE METHODS ::
                        //  - DEVELOPER SUPPORT:
                        //      ~ $oCRNRSTN->add_resource($data_key, $data_value, $data_type_family, CRNRSTN_AUTHORIZE_RUNTIME, $index, $ttl);
                        //        * NOTE: ALL HTTP/HTTPS SYSTEM GENERATED LINKS WILL
                        //                RECEIVE PSSDTL PACKET DATA (UP TO MAX_BYTES
                        //                SPECIFIED FOR CRNRSTN_AUTHORIZE_RUNTIME IN $oCRNRSTN->config_init_channel().
                        //                SEE, _crnrstn.config.inc.php.) WHEN DATA IS
                        //                AUTHORIZED FOR THE CRNRSTN :: MULTI-CHANNEL
                        //                RUNTIME DATA CHANNEL FOR DEEPEST AND RICHEST
                        //                SERVER APPLICATION INTEGRATIONS.
                        //        * NOTE: IF $ttl = NULL, THE CHANNEL TTL SETTINGS, AS
                        //                PER $oCRNRSTN->config_init_channel() SETTINGS
                        //                IN THE CRNRSTN :: CONFIGURATION FILE (SEE, _crnrstn.config.inc.php),
                        //                WILL EXPIRE THE DATA FROM CACHE. SOME OF THE
                        //                DATA WILL BE EXPIRED BY LAMP STACK MEMORY
                        //                CLEAN UP PROCESSES THAT WILL RUN AT THE
                        //                END WHEN THE CLASS OBJECT DESTRUCTOR
                        //                FIRES...some of the data.
                        //
                        //      ~ $oCRNRSTN->get_resource($data_key, $index, $data_type_family, CRNRSTN_AUTHORIZE_RUNTIME);
                        //          NOTE: LETTING $data_authorization_channel = NULL,
                        //                SHOULD BE DESIREABLE (NOT TOO SLOW). I THINK
                        //                THERE MAY BE INTERNAL POINTER STUFF WITHIN THE
                        //                CRNRSTN :: RESPONSE RETURN SERIALIZATION MAPPING
                        //                OBJECT TO MAKE IT FASTER SO THAT NULL CAN BE OK.
                        //      ~ $oCRNRSTN->get_resource_count($data_key, $data_type_family, CRNRSTN_AUTHORIZE_RUNTIME);
                        //      ~ if($oCRNRSTN->isset_resource('data_value', $data_key, $data_type_family, $channel, $index) == true){}
                        //          WHERE, $channel = CRNRSTN_AUTHORIZE_RUNTIME OR PLEASE SEE, $oCRNRSTN->get_channel_config($channel, 'NAME') OUTPUT.
                        //
                        //  - CRNRSTN :: CONFIGURATION.
                        //      ~ $oCRNRSTN->config_add_resource($env_key, $data_key, $data_value, $data_type_family, CRNRSTN_AUTHORIZE_RUNTIME, $index, $ttl)
                        //        * WHERE $index = NULL WILL SUPPORT:
                        //              + STORING n+1 ITEMS AT THE SPECIFIED DATA_KEY AND
                        //                DATA TYPE FAMILY (DUAL INDEX POINTER). SIMPLY CALL
                        //                THE SAME METHOD AGAIN, BUT CHANGE $data_value TO
                        //                THE NEXT VALUE THAT IS TO BE STORED.
                        //                      - NOTE: CRNRSTN :: GABRIEL (A MESSENGER FROM
                        //                        THE FURTHEST REACHES OF THE NORTH) CAN
                        //                        RECEIVE A RAW ARRAY DIRECTLY INTO AN EARLY
                        //                        EXECUTION OF THIS ARCHITECTURE. E.G.
                        //                        ARRAY(EMAIL001, EMAIL002, EMAIL003, ...).
                        //                      - NOTE: CRNRSTN :: GABRIEL (A MESSENGER FROM
                        //                        THE FURTHEST REACHES OF THE NORTH) SUPPORTS
                        //                        ACCELERATION OF DATA ACCESSED THROUGH USE
                        //                        OF add_resource DDO MEMORY POINTER
                        //                        OUTPUT (ALBEIT AN EARLIER VERSION OF THIS
                        //                        ARCHITECTURE). EXPECT THIS KIND OF
                        //                        FUNCTIONALITY TO MAKE IT INTO
                        //                        CRNRSTN :: LIGHTSABER.
                        //              + ACCESS OF n+1 ITEMS USING THE SPECIFIED DATA_KEY AND
                        //                DATA TYPE FAMILY (DUAL INDEX POINTER)...AND DON'T
                        //                FORGET USE OF $INDEX + 1 FOR STRUCTURE TRAVERSAL.
                        //              + STORING UP TO THE CHANNEL CONFIGURED MAX_BYTES BYTES.
                        //
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (DDO) SERVICES LAYER.
                        // CHANNEL TRANSLATION CONTROL.
                        //
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // ONLY ACTIVE CHANNELS SHOULD HAVE ACCESS TO THE DDO TRANSLATION
                        // SERVICES LAYER.
                        //
                        // PLEASE SEE, $oCRNRSTN->config_init_channel()
                        // IN CRNRSTN :: CONFIGURATION. [_crnrstn.config.inc.php]
                        if(($this->oCRNRSTN->oCRNRSTN_RRS_MAP->rrs_map_get(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]['NAME'] . '_cache_is_active')) == true){

                            //
                            // TRANSLATE DATA FROM THIS CRNRSTN :: MULTI-
                            // CHANNEL CHANNEL INTO THE CRNRSTN ::
                            // DECOUPLED DATA OBJECT (DDO) SERVICES LAYER.
                            $this->oCRNRSTN->ddo_translate(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]);

//                            //
//                            // CAN WE GO TO CRNRSTN :: PLAID?
//                            if(!($this->gone_to_plaid($_GET[$this->session_salt()], CRNRSTN_ASSET_MAPPING, self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]) == true)){
//
//                                //
//                                // CRNRSTN :: PLAID APPLICATION ACCELERATION.
//                                $this->plaid(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]);
//
//                            }

                        }

                    break;
                    case CRNRSTN_CHANNEL_SOAP:

                        //
                        // THE CRNRSTN :: PSEUDO-SOAP SERVICES DATA
                        // TUNNEL LAYER (PSSDTL) PACKET WILL
                        // AUTOMATICALLY BE DETECTED AND PROCESSED IF
                        // (1) THE DATA IS AVAILABLE,
                        // (2) THE CRNRSTN :: MULTI-CHANNEL SOAP DATA
                        // CHANNEL IS ACTIVE PER $oCRNRSTN->config_init_channel()
                        // SETTINGS IN CRNRSTN :: CONFIGURATION. (SEE, _crnrstn.config.inc.php),
                        // AND (3) MAX BYTE CONFIGURATION SETTINGS (SEE, _crnrstn/_config/_config.defaults/_crnrstn.system_settings.inc.php)
                        // AND SYSTEM OVERRIDES (SEE, _crnrstn/_config/_config.defaults/_crnrstn.system_overrides.inc.php)
                        // ARE NEVER VIOLATED WHEN DATA IS PROCESSED
                        // INTO RUNTIME (THIS WOULD BE ATYPICAL).
                        //
                        // CRNRSTN :: WILL NOT BEGIN DDO DATA
                        // TRANSLATION, AND HIT A MAX_BYTE LIMIT
                        // BEFORE THE LAST ITEM FROM THE SHOPPING CART
                        // OR MAILING LIST RECORD CAN BE PROCESSED INTO
                        // THE RUNTIME DDO. AGAIN, THIS KIND OF DATA
                        // CORRUPTION IN MEMORY WOULD BE ATYPICAL.
                        // PROTECTIONS ARE IN PLACE IN ORDER TO PREVENT
                        // THIS KIND OF THING FROM HAPPENING IN
                        // CRNRSTN :: DDO MEMORY.
                        //
                        // ON TOP OF PROVIDING VALID ITEM COUNTS, BYTE
                        // REPORTING, AND TIMESTAMPS TO THE CLIENT
                        // FACING CRNRSTN :: PERFORMANCE REPORTING
                        // SERVICES LAYER, WHICH SAID REQUIREMENTS
                        // ...BY THEMSELVES...DEMAND NO MODEST DEGREE
                        // OF SCRUTINY AND CONSIDERATION, CRNRSTN ::
                        // HAS BEEN DESIGNED SPECIFICALLY TO DESKTOP,
                        // TABLET, AND MOBILE THESE KINDS OF PURPOSES.
                        //
                        // Saturday, November 4, 2023 @ 2127 hrs.
                        //
                        // THE COMPLETE AND PERFECT MANAGEMENT OF DATA
                        // AND FILES TO PRODUCE A QUALITY BUSINESS TOOL
                        // ON TOP OF THE MIT LICENSE.
                        //
                        // PLEASE SEE, http://crnrstn.evifweb.com/licensing/.
                        //
                        // SUPPORTED CHANNEL AUTHORIZATION PROFILE CONSTANTS ::
                        //  - CRNRSTN_AUTHORIZE_ALL
                        //  - CRNRSTN_AUTHORIZE_SOAP
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_RUNTIME
                        //
                        // CHANNEL AUTHORIZATION PROFILE METHODS ::
                        //  - DEVELOPER SUPPORT:
                        //      ~ $oCRNRSTN->add_resource($data_key, $data_value, $data_type_family, CRNRSTN_AUTHORIZE_SOAP, $index, $ttl);
                        //        * NOTE: [EXPERIMENTAL] ALL SOAP REQESTS WILL
                        //                RECEIVE PSSDTL PACKET DATA (UP TO MAX_BYTES
                        //                SPECIFIED FOR CRNRSTN_CHANNEL_SOAP IN $oCRNRSTN->config_init_channel().
                        //                SEE, _crnrstn.config.inc.php.) WHEN DATA IS
                        //                AUTHORIZED FOR THE CRNRSTN :: MULTI-CHANNEL
                        //                SOAP DATA CHANNEL FOR DEEPEST AND RICHEST
                        //                SERVER TO SERVER INTEGRATIONS.
                        //        * NOTE: IF $ttl = NULL, THE CHANNEL TTL SETTINGS, AS
                        //                PER $oCRNRSTN->config_init_channel() SETTINGS
                        //                IN THE CRNRSTN :: CONFIGURATION FILE (SEE, _crnrstn.config.inc.php),
                        //                WILL EXPIRE THE DATA FROM CACHE. SOME OF THE
                        //                DATA WILL BE EXPIRED BY LAMP STACK MEMORY
                        //                CLEAN UP PROCESSES THAT WILL RUN AT THE
                        //                END WHEN THE CLASS OBJECT DESTRUCTOR
                        //                FIRES...some of the data.
                        //
                        //      ~ $oCRNRSTN->get_resource($data_key, $index, $data_type_family, CRNRSTN_AUTHORIZE_SOAP);
                        //          NOTE: LETTING $data_authorization_channel = NULL,
                        //                SHOULD BE DESIREABLE (NOT TOO SLOW). I THINK
                        //                THERE MAY BE INTERNAL POINTER STUFF WITHIN THE
                        //                CRNRSTN :: RESPONSE RETURN SERIALIZATION MAPPING
                        //                OBJECT TO MAKE IT FASTER SO THAT NULL CAN BE OK.
                        //      ~ $oCRNRSTN->get_resource_count($data_key, $data_type_family, CRNRSTN_AUTHORIZE_SOAP);
                        //      ~ if($oCRNRSTN->isset_resource('data_value', $data_key, $data_type_family, $channel, $index) == true){}
                        //          WHERE, $channel = CRNRSTN_CHANNEL_SOAP OR PLEASE SEE, $oCRNRSTN->get_channel_config($channel, 'NAME') OUTPUT.
                        //
                        //  - CRNRSTN :: CONFIGURATION.
                        //      ~ $oCRNRSTN->config_add_resource($env_key, $data_key, $data_value, $data_type_family, CRNRSTN_AUTHORIZE_SOAP, $index, $ttl)
                        //        * WHERE $index = NULL WILL SUPPORT:
                        //              + STORING n+1 ITEMS AT THE SPECIFIED DATA_KEY AND
                        //                DATA TYPE FAMILY (DUAL INDEX POINTER). SIMPLY CALL
                        //                THE SAME METHOD AGAIN, BUT CHANGE $data_value TO
                        //                THE NEXT VALUE THAT IS TO BE STORED.
                        //                      - NOTE: CRNRSTN :: GABRIEL (A MESSENGER FROM
                        //                        THE FURTHEST REACHES OF THE NORTH) CAN
                        //                        RECEIVE A RAW ARRAY DIRECTLY INTO AN EARLY
                        //                        EXECUTION OF THIS ARCHITECTURE. E.G.
                        //                        ARRAY(EMAIL001, EMAIL002, EMAIL003, ...).
                        //                      - NOTE: CRNRSTN :: GABRIEL (A MESSENGER FROM
                        //                        THE FURTHEST REACHES OF THE NORTH) SUPPORTS
                        //                        ACCELERATION OF DATA ACCESSED THROUGH USE
                        //                        OF add_resource DDO MEMORY POINTER
                        //                        OUTPUT (ALBEIT AN EARLIER VERSION OF THIS
                        //                        ARCHITECTURE). EXPECT THIS KIND OF
                        //                        FUNCTIONALITY TO MAKE IT INTO
                        //                        CRNRSTN :: LIGHTSABER.
                        //              + ACCESS OF n+1 ITEMS USING THE SPECIFIED DATA_KEY AND
                        //                DATA TYPE FAMILY (DUAL INDEX POINTER)...AND DON'T
                        //                FORGET USE OF $INDEX + 1 FOR STRUCTURE TRAVERSAL.
                        //              + STORING UP TO THE CHANNEL CONFIGURED MAX_BYTES BYTES.
                        //
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (DDO) SERVICES LAYER.
                        // CHANNEL TRANSLATION CONTROL.
                        //
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // ONLY ACTIVE CHANNELS SHOULD HAVE ACCESS TO THE DDO TRANSLATION
                        // SERVICES LAYER.
                        //
                        // PLEASE SEE, $oCRNRSTN->config_init_channel()
                        // IN CRNRSTN :: CONFIGURATION. [_crnrstn.config.inc.php]
                        if(($this->oCRNRSTN->oCRNRSTN_RRS_MAP->rrs_map_get(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]['NAME'] . '_cache_is_active')) == true){

                            //
                            // TRANSLATE DATA FROM THIS CRNRSTN :: MULTI-
                            // CHANNEL CHANNEL INTO THE CRNRSTN ::
                            // DECOUPLED DATA OBJECT (DDO) SERVICES LAYER.
                            $this->oCRNRSTN->ddo_translate(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]);

//                            //
//                            // CAN WE GO TO CRNRSTN :: PLAID?
//                            if(!($this->gone_to_plaid($_GET[$this->session_salt()], CRNRSTN_ASSET_MAPPING, self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]) == true)){
//
//                                //
//                                // CRNRSTN :: PLAID APPLICATION ACCELERATION.
//                                $this->plaid(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]);
//
//                            }

                        }

                    break;
                    case CRNRSTN_CHANNEL_FILE:

                        //
                        // THE CRNRSTN :: PSEUDO-SOAP SERVICES DATA
                        // TUNNEL LAYER (PSSDTL) PACKET WILL
                        // AUTOMATICALLY BE DETECTED AND PROCESSED IF
                        // (1) THE DATA IS AVAILABLE,
                        // (2) THE CRNRSTN :: MULTI-CHANNEL FILE DATA
                        // CHANNEL IS ACTIVE PER $oCRNRSTN->config_init_channel()
                        // SETTINGS IN CRNRSTN :: CONFIGURATION. (SEE, _crnrstn.config.inc.php),
                        // AND (3) MAX BYTE CONFIGURATION SETTINGS (SEE, _crnrstn/_config/_config.defaults/_crnrstn.system_settings.inc.php)
                        // AND SYSTEM OVERRIDES (SEE, _crnrstn/_config/_config.defaults/_crnrstn.system_overrides.inc.php)
                        // ARE NEVER VIOLATED WHEN DATA IS PROCESSED
                        // INTO RUNTIME (THIS WOULD BE ATYPICAL).
                        //
                        // CRNRSTN :: WILL NOT BEGIN DDO DATA
                        // TRANSLATION, AND HIT A MAX_BYTE LIMIT
                        // BEFORE THE LAST ITEM FROM THE SHOPPING CART
                        // OR MAILING LIST RECORD CAN BE PROCESSED INTO
                        // THE RUNTIME DDO. AGAIN, THIS KIND OF DATA
                        // CORRUPTION IN MEMORY WOULD BE ATYPICAL.
                        // PROTECTIONS ARE IN PLACE IN ORDER TO PREVENT
                        // THIS KIND OF THING FROM HAPPENING IN
                        // CRNRSTN :: DDO MEMORY.
                        //
                        // ON TOP OF PROVIDING VALID ITEM COUNTS, BYTE
                        // REPORTING, AND TIMESTAMPS TO THE CLIENT
                        // FACING CRNRSTN :: PERFORMANCE REPORTING
                        // SERVICES LAYER, WHICH SAID REQUIREMENTS
                        // ...BY THEMSELVES...DEMAND NO MODEST DEGREE
                        // OF SCRUTINY AND CONSIDERATION, CRNRSTN ::
                        // HAS BEEN DESIGNED SPECIFICALLY TO DESKTOP,
                        // TABLET, AND MOBILE THESE KINDS OF PURPOSES.
                        //
                        // Thursday, November 23, 2023 @ 0826 hrs.
                        //
                        // THE COMPLETE AND PERFECT MANAGEMENT OF DATA
                        // AND FILES TO PRODUCE A QUALITY BUSINESS TOOL
                        // ON TOP OF THE MIT LICENSE.
                        //
                        // PLEASE SEE, http://crnrstn.evifweb.com/licensing/.
                        //
                        // SUPPORTED CHANNEL AUTHORIZATION PROFILE CONSTANTS ::
                        //  - CRNRSTN_AUTHORIZE_ALL
                        //  - CRNRSTN_AUTHORIZE_FILE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE
                        //  - CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_RUNTIME
                        //
                        // CHANNEL AUTHORIZATION PROFILE METHODS ::
                        //  - DEVELOPER SUPPORT:
                        //      ~ $oCRNRSTN->add_resource($data_key, $data_value, $data_type_family, CRNRSTN_AUTHORIZE_FILE, $index, $ttl);
                        //        * NOTE: CRNRSTN :: FILE CHANNEL METHODS AND
                        //                FUNCTIONALITY ARE CURRENTLY TBD.
                        //
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (DDO) SERVICES LAYER.
                        // CHANNEL TRANSLATION CONTROL.
                        //
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // ONLY ACTIVE CHANNELS SHOULD HAVE ACCESS TO THE DDO TRANSLATION
                        // SERVICES LAYER.
                        //
                        // PLEASE SEE, $oCRNRSTN->config_init_channel()
                        // IN CRNRSTN :: CONFIGURATION. [_crnrstn.config.inc.php]
                        if(($this->oCRNRSTN->get_channel_config(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]['NAME'] . '_cache_is_active')) == true){

                            //
                            // TRANSLATE DATA FROM THIS CRNRSTN :: MULTI-
                            // CHANNEL CHANNEL INTO THE CRNRSTN ::
                            // DECOUPLED DATA OBJECT (DDO) SERVICES LAYER.
                            $this->oCRNRSTN->ddo_translate(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]);

//                            //
//                            // CAN WE GO TO CRNRSTN :: PLAID?
//                            if(!($this->gone_to_plaid($_GET[$this->session_salt()], CRNRSTN_ASSET_MAPPING, self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]) == true)){
//
//                                //
//                                // CRNRSTN :: PLAID APPLICATION ACCELERATION.
//                                $this->plaid(self::$system_channel_ARRAY[$tmp_channel_ARRAY[$i]]);
//
//                            }

                        }

                    break;

                }

            }

        }

    }

    public function channel_access_is_authorized($channel, $data_authorization_profile){

        /*
        $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_CHANNEL_SOAP;
        $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_CHANNEL_SOAP';
        $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = CRNRSTN_ENCRYPT_SOAP;
        $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = 'CRNRSTN_ENCRYPT_SOAP';
        $tmp_channel_ARRAY['CHAR'] = 'O';
        $tmp_channel_ARRAY['NAME'] = 'soap';
        $tmp_channel_ARRAY['DESCRIPTION'] = 'O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1)';
        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_SOAP => CRNRSTN_AUTHORIZE_SOAP);
        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_SOAP' => CRNRSTN_AUTHORIZE_SOAP);
        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array();
        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array();

        {main}() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/unittest/mime-type/index.php:0
        [Tue Nov 07 12:06:18.574396 2023] [:error] [pid 122921] [client 172.16.225.1:52429] PHP   2. include_once() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/unittest/mime-type/index.php:34
        [Tue Nov 07 12:06:18.574401 2023] [:error] [pid 122921] [client 172.16.225.1:52429] PHP   3. crnrstn->__construct() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn.config.inc.php:184
        [Tue Nov 07 12:06:18.574406 2023] [:error] [pid 122921] [client 172.16.225.1:52429] PHP   4. crnrstn->config_ugc_input_clean_data() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/crnrstn/crnrstn.inc.php:702
        [Tue Nov 07 12:06:18.574411 2023] [:error] [pid 122921] [client 172.16.225.1:52429] PHP   5. crnrstn->input_data_value() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/crnrstn/crnrstn.inc.php:11780
        [Tue Nov 07 12:06:18.574415 2023] [:error] [pid 122921] [client 172.16.225.1:52429] PHP   6. crnrstn_configuration_manager->input_data_value() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/crnrstn/crnrstn.inc.php:18728
        [Tue Nov 07 12:06:18.574419 2023] [:error] [pid 122921] [client 172.16.225.1:52429] PHP   7. crnrstn_decoupled_data_object->add() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/crnrstn/crnrstn.configuration_manager.inc.php:208
        [Tue Nov 07 12:06:18.574424 2023] [:error] [pid 122921] [client 172.16.225.1:52429] PHP   8. crnrstn->init_config_cache_index_mem_header() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/environment/crnrstn.decoupled_data_object.inc.php:4178
        [Tue Nov 07 12:06:18.574429 2023] [:error] [pid 122921] [client 172.16.225.1:52429] PHP   9. crnrstn_response_return_serialization_map->init_config_cache_index_mem_header() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/crnrstn/crnrstn.inc.php:2343
        [Tue Nov 07 12:06:18.574433 2023] [:error] [pid 122921] [client 172.16.225.1:52429] PHP  10. crnrstn->channel_access_is_authorized() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/session/crnrstn.response_return_serialization_map.inc.php:5080
        [Tue Nov 07 12:06:18.574438 2023] [:error] [pid 122921] [client 172.16.225.1:52429] PHP  11. crnrstn_configuration_manager->channel_access_is_authorized() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/crnrstn/crnrstn.inc.php:30845
        [Tue Nov 07 12:06:18.574442 2023] [:error] [pid 122921] [client 172.16.225.1:52429] PHP  12. crnrstn_decoupled_data_object->channel_access_is_authorized() /va

        */

        try{

            error_log(__LINE__ . ' ddo ATTEMPTING CHANNEL AUTHORIZATION [' . strval($channel) . '] authorization profile, ' . strval($data_authorization_profile) . '. alpha_ARRAY[' . print_r(self::$system_channel_alpha_ARRAY, true) . ']. channel_ARRAY[' . print_r(self::$system_channel_ARRAY, true) . '].');

//             $this->destruct_output .= '<pre><code>[lnum ' .  __LINE__ . '] ATTEMPTING CHANNEL AUTHORIZATION [' . strval($channel) . ']. self::$system_channel_alpha_ARRAY[' . print_r($self::$system_channel_alpha_ARRAY, true) . '.'  .
// '<br><br># # C # <span style="color:#F90000;">R</span> # N # R # S # T # N # : : # # # #</br>C<span style="color:#F90000;">R</span>NRSTN :: MULTI-CHANNEL TESTING [' .  self::$system_channel_alpha_ARRAY . '].<br>' . print_r(self::$system_channel_ARRAY, true) . '</code></pre>';

            //die();
            if(is_numeric($data_authorization_profile)){

                $tmp_int = (int) $data_authorization_profile;

                if(isset(self::$system_channel_alpha_ARRAY[$channel])){

                    if(isset(self::$system_channel_ARRAY[self::$system_channel_alpha_ARRAY[$channel]]['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER][$tmp_int])){

                        //$this->error_log('Channel access granted for channel[' . strval($channel) . '] with channel authorization profile, ' . strval($tmp_int) . '. ' . $this->data_report($channel, 'CRNRSTN :: MULTI-CHANNEL SYSTEM DATA VALIDATION REPORT') . ' ' . $this->data_report($data_authorization_profile, 'CRNRSTN :: MULTI-CHANNEL SYSTEM DATA VALIDATION REPORT'), __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
                        //$this->error_log('CRNRSTN :: WE NEED TO RE-WRITE/WRITE base64 php FILE [' . $tmp_file_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                        // error_log(__LINE__ . ' crnrstn SUCCESS Channel access GRANTED. channel[' . strval($channel) . ']. CHANNEL_AUTHORIZATION=' . strval($data_authorization_profile) . ' die();');
                        // die();

                        return true;

                    }

                }else{

                    //
                    // IF THE ENVIRONMENT IS NOT DETECTED, LET THE
                    // RUNTIME CHANNEL BE AUTHORIZED TO RECEIVE
                    // INPUT DATA BY DEFAULT.
                    //
                    //
                    //error_log(__LINE__ . ' ddo $env_key_hash[' . strval(self::$env_key_hash) . ']. key[' . (self::$env_key) . '].');
                    //die();

                    if(!isset(self::$env_key_hash)){

                        /*
                        CRNRSTN_AUTHORIZE_ALL
                        CRNRSTN_AUTHORIZE_GET
                        CRNRSTN_AUTHORIZE_POST
                        CRNRSTN_AUTHORIZE_COOKIE
                        CRNRSTN_AUTHORIZE_SESSION
                        CRNRSTN_AUTHORIZE_DATABASE
                        CRNRSTN_AUTHORIZE_SSDTLA
                        CRNRSTN_AUTHORIZE_PSSDTLA
                        CRNRSTN_AUTHORIZE_RUNTIME
                        CRNRSTN_AUTHORIZE_SOAP

                         $this->destruct_output .= '<pre><code>[' . $this->return_micro_time()  . '] [lnum ' .  __LINE__ . '] [rtime ' . $this->wall_time() . '] [class ' . __CLASS__  . '] SUCCESS Channel access GRANTED. channel[' . strval($channel) . ']. CHANNEL_AUTHORIZATION=' . $this->return_int_const_profile($data_authorization_profile, CRNRSTN_STRING) . '[' . $this->return_int_const_profile($data_authorization_profile, CRNRSTN_INTEGER) . ']. <br>' . $this->data_report($channel, 'C<span style="color:#F90000;">R</span>NRSTN :: MULTI-CHANNEL SYSTEM DATA VALIDATION REPORT') . ' <br>' . $this->data_report($data_authorization_profile, 'C<span style="color:#F90000;">R</span>NRSTN :: MULTI-CHANNEL SYSTEM DATA VALIDATION REPORT')  .
                            '<br><br># # C # <span style="color:#F90000;">R</span> # N # R # S # T # N # : : # # # #</br>C<span style="color:#F90000;">R</span>NRSTN :: MULTI-CHANNEL TESTING.</code></pre>';

                        */

                        switch($tmp_int){
                            case CRNRSTN_AUTHORIZE_ALL:
                            case CRNRSTN_AUTHORIZE_RUNTIME:
                            case CRNRSTN_AUTHORIZE_SOAP:

                                /*
                                //
                                // Monday, November 6, 2023 @ 2324 hrs.
                                $this->destruct_output .= '<pre><code>[lnum ' .  __LINE__ . '] [class ' . __CLASS__  . '] SUCCESS Channel access GRANTED. channel[' . strval($channel) . ']. CHANNEL_AUTHORIZATION=' . strval($data_authorization_profile) .
                                '<br><br># # C # <span style="color:#F90000;">R</span> # N # R # S # T # N # : : # # # #</br>C<span style="color:#F90000;">R</span>NRSTN :: MULTI-CHANNEL TESTING.</code></pre>';
                                error_log(__LINE__ . ' crnrstn SUCCESS Channel access GRANTED. channel[' . strval($channel) . ']. CHANNEL_AUTHORIZATION=' . strval($data_authorization_profile));

                                */

                                error_log(__LINE__ . ' crnrstn SUCCESS Channel access GRANTED. channel[' . strval($channel) . ']. CHANNEL_AUTHORIZATION=' . strval($data_authorization_profile) . ' die();');
                                // die();

                                return true;

                            break;

                        }

                    }

                }

            }

            //
            // PRE MULTI-CHANNEL INITIALIZATION DATA WRITE CHECK.
            // CRNRSTN :: MULTI-CHANNEL DATA AUTHORIZATION CHECK FOR
            // SUPPORT OF CRNRSTN :: INITIALIZATION.
            $tmp_auth_int_ARRAY = $this->oCRNRSTN->get_channel_config($channel, 'AUTHORIZATION', 'PROFILE', 'AUTHORIZED', CRNRSTN_INTEGER, true);
            if(isset($tmp_auth_int_ARRAY[$data_authorization_profile])){

                // error_log(__LINE__ . ' crnrstn SUCCESS Channel access GRANTED for channel[' . strval($channel) . '] with channel authorization profile, ' . strval($data_authorization_profile) . '.');
                // $this->oCRNRSTN->destruct_output .= '<pre><code>[' . $this->oCRNRSTN->return_micro_time()  . '] [lnum ' .  __LINE__ . '] [rtime ' . $this->oCRNRSTN->wall_time() . '] [class ' . __CLASS__  . '] SUCCESS Channel access GRANTED for channel[' . strval($channel) . '] with channel authorization profile, ' . $this->oCRNRSTN->return_int_const_profile($data_authorization_profile, CRNRSTN_STRING) . '[' . $this->oCRNRSTN->return_int_const_profile($data_authorization_profile, CRNRSTN_INTEGER) . ']. <br>' . $this->oCRNRSTN->data_report($channel, 'C<span style="color:#F90000;">R</span>NRSTN :: MULTI-CHANNEL SYSTEM DATA VALIDATION REPORT') . ' <br>' . $this->oCRNRSTN->data_report($data_authorization_profile, 'C<span style="color:#F90000;">R</span>NRSTN :: MULTI-CHANNEL SYSTEM DATA VALIDATION REPORT')  .
                // '<br><br># # C # <span style="color:#F90000;">R</span> # N # R # S # T # N # : : # # # #</br>C<span style="color:#F90000;">R</span>NRSTN :: MULTI-CHANNEL TESTING.</code></pre><br>' . print_r(self::$system_channel_ARRAY[self::$system_channel_alpha_ARRAY[$channel]]['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER], true) . '</code></pre>';

                // die();
                return true;

            }

            // error_log(__LINE__ . ' crnrstn ERROR Channel access DENIED for channel[' . strval($channel) . '] with channel authorization profile, ' . strval($data_authorization_profile) . '. ' . $this->oCRNRSTN->data_report($channel, 'CRNRSTN :: MULTI-CHANNEL SYSTEM DATA VALIDATION REPORT') . ' ' . $this->oCRNRSTN->data_report($data_authorization_profile, 'CRNRSTN :: MULTI-CHANNEL SYSTEM DATA VALIDATION REPORT'));
            // error_log(__LINE__ . ' crnrstn CHANNEL ARRAY [' . print_r(self::$system_channel_ARRAY, true) . '].');
            // error_log(__LINE__ . ' crnrstn CHANNEL ALPHA ARRAY [' . print_r(self::$system_channel_ARRAY, true) . '].');

            // $this->oCRNRSTN->destruct_output .= '<pre><code>[' . $this->oCRNRSTN->return_micro_time()  . '] [lnum ' .  __LINE__ . '] [rtime ' . $this->oCRNRSTN->wall_time() . '] [class ' . __CLASS__  . '] ERROR. channel[' . strval($channel) . '] DENIED. CHANNEL_AUTHORIZATION=' . $this->oCRNRSTN->return_int_const_profile($data_authorization_profile, CRNRSTN_STRING) . '[' . $this->oCRNRSTN->return_int_const_profile($data_authorization_profile, CRNRSTN_INTEGER) . ']. <br>' . $this->oCRNRSTN->data_report($channel, 'C<span style="color:#F90000;">R</span>NRSTN :: MULTI-CHANNEL SYSTEM DATA VALIDATION REPORT') . ' <br>' . $this->oCRNRSTN->data_report($data_authorization_profile, 'C<span style="color:#F90000;">R</span>NRSTN :: MULTI-CHANNEL SYSTEM DATA VALIDATION REPORT')  .
            //     '<br><br># # C # <span style="color:#F90000;">R</span> # N # R # S # T # N # : : # # # #</br>C<span style="color:#F90000;">R</span>NRSTN :: MULTI-CHANNEL TESTING.</code></pre><br>' . print_r(self::$system_channel_ARRAY[self::$system_channel_alpha_ARRAY[$channel]]['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER], true) . '</code></pre>';

            // die();

            return false;

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE.
            return false;

        }

    }

    public function get_ddo_resource_channel_array($ddo_memory_pointer){

        //
        // DDO MEMORY POINTER DRIVEN CHANNEL EXTRACTION.
        if(isset(self::$ddo_resource_memory_pointer_ARRAY['HASH'][$ddo_memory_pointer])){

            return self::$ddo_resource_memory_pointer_ARRAY['HASH'][$ddo_memory_pointer];

        }

        //
        // EXTRACTION BY DATA KEY (KEY DERIVED FROM DDO MEMORY POINTER).
        $tmp_data_key = $this->oCRNRSTN->str_sanitize($ddo_memory_pointer, 'data_key_extract');

        if(isset(self::$ddo_resource_memory_pointer_ARRAY['KEY'][$tmp_data_key])){

            return self::$ddo_resource_memory_pointer_ARRAY['KEY'][$tmp_data_key];

        }

        return NULL;

    }

    public function build_ddo_resource_pointer($ddo_memory_pointer, $channel){

        //
        // EXTRACT DATA KEY FROM DDO MEMORY POINTER.
        $tmp_data_key = $this->oCRNRSTN->str_sanitize($ddo_memory_pointer, 'data_key_extract');

        //error_log(__LINE__ . ' ddo [' . print_r(self::$ddo_resource_memory_pointer_ARRAY, true) . ']. $ddo_memory_pointer[' . strval($ddo_memory_pointer) . ']. $channel[' . strval($channel) . '].');
        //error_log(__LINE__ . ' ddo BUILDING $tmp_data_key[' . $tmp_data_key . ']. $ddo_memory_pointer[' . strval($ddo_memory_pointer) . ']. $channel[' . strval($channel) . '].');
        /*
        [Tue Oct 31 05:39:49.694742 2023] [:error] [pid 75818] [client 172.16.225.1:59679] 300 ddo
        $ddo_memory_pointer[eebb1d786f3fb62af6725dacc2e4927bdbc43241647ce47271f7099e1fe9579c::custom_mobi_name].
        $channel[runtime].
        $data_key[eebb1d786f3fb62af6725dacc2e4927bdbc43241647ce47271f7099e1fe9579c::custom_mobi_name].

        */

        //
        // HASH POINTER FOR CHANNEL STORAGE.
        //if(!isset(self::$ddo_resource_memory_pointer_ARRAY['HASH'][$ddo_memory_pointer])){

            //
            // ARCHITECTURE TO FIX PHP Warning: Cannot use a scalar value as an array.
            self::$ddo_resource_memory_pointer_ARRAY['HASH'][$ddo_memory_pointer] = array($channel);
            //self::$ddo_resource_memory_pointer_ARRAY['HASH'][$ddo_memory_pointer][] = $channel;

        //}

        //
        // HASH POINTER FOR CHANNEL STORAGE.
        //if(!isset(self::$ddo_resource_memory_pointer_ARRAY['KEY'][$tmp_data_key])){

            //
            // ARCHITECTURE TO FIX PHP Warning: Cannot use a scalar value as an array.
            self::$ddo_resource_memory_pointer_ARRAY['KEY'][$tmp_data_key][] = array($channel);
            //self::$ddo_resource_memory_pointer_ARRAY['KEY'][$tmp_data_key][] = $channel;

        //}

        return true;

    }

    public function isset_ddo_resource_pointer($ddo_memory_pointer, $data_type_family, $data_auth_channel){

        //
        // EXTRACT DATA KEY FROM DDO MEMORY POINTER.
        $tmp_data_key = $this->oCRNRSTN->str_sanitize($ddo_memory_pointer, 'data_key_extract');

//        //
//        // RETURN NULL IF NOT SET.
//        // RETURN DDO MEMORY POINTER IF FOUND.
//        // RETURN ARRAY OF CHANNELS IF SET.
//        if(!isset($data_auth_channel)){
//
//            //
//            // LOAD THE DEFAULT DATA AUTHORIZATION PROFILE FROM THE CRNRSTN :: CONFIGURATION FILE.
//            $data_auth_channel = $this->oCRNRSTN->get_resource('data_authorization_profile', 0, 'CRNRSTN::RESOURCE::CONFIGURATION');
//
//        }

        if(isset(self::$ddo_resource_memory_pointer_ARRAY['KEY'][$tmp_data_key])){

            $tmp_count = count(self::$ddo_resource_memory_pointer_ARRAY['KEY'][$tmp_data_key]);

            //
            // FAST...IF THIS USE-CASE IS SATISFIED. I DUNNO IF IT WILL BE.
            if($tmp_count == 1){

                error_log(__LINE__ . ' env I AM FAST.');

                //
                // RETURN THE ONE AND ONLY DDO MEMORY POINTER.
                return self::$ddo_resource_memory_pointer_ARRAY['KEY'][$tmp_data_key][0];

            }

        }

        //
        // FROM USING DATA KEY ALONE, WE FAILED TO FIND OUT.
        // NOW...HASH OUT THE DDO MEMORY POINTER, AND CHECK AGAIN.
        //
        // "IT'S DOWN THERE SOMEWHERE; LET ME TAKE ANOTHER LOOK."
        //
        // The Big Lebowski (1998) - Where's the Money, Lebowski? Scene | Movieclips
        // https://www.youtube.com/watch?v=NlJGfFqYEms
        //
        // Sunday, October 15, 2023 @ 0438 hrs.
        //$tmp_ddo_memory_pointer = $this->oCRNRSTN->hash_ddo_memory_pointer($ddo_memory_pointer, $data_type_family);
        self::$ddo_resource_memory_pointer_ARRAY['KEY'][$tmp_data_key][] = $ddo_memory_pointer;

        if(!isset(self::$ddo_resource_memory_pointer_ARRAY['HASH'][$ddo_memory_pointer])){

            self::$ddo_resource_memory_pointer_ARRAY['HASH'][$ddo_memory_pointer] = 1;

            $this->build_ddo_resource_pointer($ddo_memory_pointer, $this->get_channel_config($data_auth_channel, 'NAME', NULL, NULL, NULL, true));

        }

        return $ddo_memory_pointer;

    }

    private function channel_meta($channel_constant_ARRAY, $index_0 = NULL, $index_1 = NULL, $index_2 = NULL, $index_3 = NULL, $initialize = false){

        try{

            if(isset($channel_constant_ARRAY)){

                $tmp_data_type_int_const = $this->oCRNRSTN->gettype($channel_constant_ARRAY, CRNRSTN_INTEGER);

            }else{

                $tmp_data_type_int_const = CRNRSTN_INTEGER;

            }

            switch($tmp_data_type_int_const){
                case CRNRSTN_STRING:
                case CRNRSTN_INT:
                case CRNRSTN_INTEGER:

                    error_log(__LINE__ . ' ddo channel_meta() $channel_constant_ARRAY[' . $channel_constant_ARRAY . '] FAST CHANNEL META REQUEST FULFILLMENT :: SWITCH SUCCESS.');

                    if((!isset($channel_constant_ARRAY)) || isset(self::$system_channel_ARRAY[$this->oCRNRSTN->get_channel_config($channel_constant_ARRAY, 'CHAR', NULL, NULL, NULL, true)])){

                        error_log(__LINE__ . ' ddo FAST CHANNEL META REQUEST FULFILLMENT :: MEMORY READ. die();');


                        //die();

                        //
                        // 4 INDICES.
                        // RETURN DATA BY ARRAY INDEX.
                        if(isset($index_0) && isset($index_1) && isset($index_2) && isset($index_3)){

                            //
                            // E.G.
                            // $channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER]
                            // $channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING]
                            // $channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER]
                            // $channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING]
                            if(isset(self::$system_channel_ARRAY[$index_0][$index_1][$index_2][$index_3])){

                                return self::$system_channel_ARRAY[$index_0][$index_1][$index_2][$index_3];

                            }else{

                                $tmp_stripe_key_ARRAY = $this->oCRNRSTN->return_stripe_key_ARRAY('$index_0', '$index_1', '$index_2', '$index_3');
                                $tmp_param_err_str_ARRAY = $this->oCRNRSTN->return_regression_stripe_ARRAY('HAS_DATA_NOT_APPLIED', $tmp_stripe_key_ARRAY, $index_0, $index_1, $index_2, $index_3);

                                $tmp_param_missing_str = $tmp_param_err_str_ARRAY['string'];
                                //$tmp_param_missing_ARRAY = $tmp_param_err_str_ARRAY['index_array'];

                                //
                                // HOOOSTON...VE HAF PROBLEM!
                                throw new Exception('Unknown ' . strtoupper(strval(self::$system_channel_ARRAY['NAME'])) . ' channel system meta requested. ' . $tmp_param_missing_str);

                            }

                        }

                        //
                        // 3 INDICES.
                        // RETURN DATA BY ARRAY INDEX.
                        if(isset($index_0) && isset($index_1) && isset($index_2)){

                            //
                            // E.G.
                            // $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = CRNRSTN_ENCRYPT_SOAP;
                            // $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = 'CRNRSTN_ENCRYPT_SOAP';
                            if(isset(self::$system_channel_ARRAY[$index_0][$index_1][$index_2])){

                                return self::$system_channel_ARRAY[$index_0][$index_1][$index_2];

                            }else{

                                $tmp_stripe_key_ARRAY = $this->oCRNRSTN->return_stripe_key_ARRAY('$index_0', '$index_1', '$index_2');
                                $tmp_param_err_str_ARRAY = $this->oCRNRSTN->return_regression_stripe_ARRAY('HAS_DATA_NOT_APPLIED', $tmp_stripe_key_ARRAY, $index_0, $index_1, $index_2);

                                $tmp_param_missing_str = $tmp_param_err_str_ARRAY['string'];
                                //$tmp_param_missing_ARRAY = $tmp_param_err_str_ARRAY['index_array'];

                                //
                                // HOOOSTON...VE HAF PROBLEM!
                                throw new Exception('Unknown ' . strtoupper(strval(self::$system_channel_ARRAY['NAME'])) . ' channel system meta requested. ' . $tmp_param_missing_str);

                            }

                        }

                        //
                        // 2 INDICES.
                        // RETURN DATA BY ARRAY INDEX.
                        if(isset($index_0) && isset($index_1)){

                            //
                            // E.G.
                            // $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_CHANNEL_SOAP;
                            // $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_CHANNEL_SOAP';
                            if(isset(self::$system_channel_ARRAY[$index_0][$index_1])){

                                return self::$system_channel_ARRAY[$index_0][$index_1];

                            }else{

                                $tmp_stripe_key_ARRAY = $this->oCRNRSTN->return_stripe_key_ARRAY('$index_0', '$index_1');
                                $tmp_param_err_str_ARRAY = $this->oCRNRSTN->return_regression_stripe_ARRAY('HAS_DATA_NOT_APPLIED', $tmp_stripe_key_ARRAY, $index_0, $index_1);

                                $tmp_param_missing_str = $tmp_param_err_str_ARRAY['string'];
                                //$tmp_param_missing_ARRAY = $tmp_param_err_str_ARRAY['index_array'];

                                //
                                // HOOOSTON...VE HAF PROBLEM!
                                throw new Exception('Unknown ' . strtoupper(strval(self::$system_channel_ARRAY['NAME'])) . ' channel system meta requested. ' . $tmp_param_missing_str);

                            }

                        }

                        //
                        // 1 INDICES.
                        // RETURN DATA BY ARRAY INDEX.
                        if(isset($index_0)){

                            //
                            // E.G.
                            // $tmp_channel_ARRAY['CHAR'] = 'O';
                            // $tmp_channel_ARRAY['NAME'] = 'soap';
                            // $tmp_channel_ARRAY['DESCRIPTION'] = 'O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1)';
                            if(isset(self::$system_channel_ARRAY[$index_0])){

                                return self::$system_channel_ARRAY[$index_0];

                            }else{

                                $tmp_stripe_key_ARRAY = $this->oCRNRSTN->return_stripe_key_ARRAY('$index_0');
                                $tmp_param_err_str_ARRAY = $this->oCRNRSTN->return_regression_stripe_ARRAY('HAS_DATA_NOT_APPLIED', $tmp_stripe_key_ARRAY, $index_0);

                                $tmp_param_missing_str = $tmp_param_err_str_ARRAY['string'];
                                //$tmp_param_missing_ARRAY = $tmp_param_err_str_ARRAY['index_array'];

                                //
                                // HOOOSTON...VE HAF PROBLEM!
                                throw new Exception('Unknown ' . strtoupper(strval(self::$system_channel_ARRAY['NAME'])) . ' channel system meta requested. ' . $tmp_param_missing_str);

                            }

                        }

                        error_log(__LINE__ . ' ddo DID YOU WANT THE WHOLE THING? ...MISS AN OPPORUNITY HERE, BRUV?');

                        return self::$system_channel_ARRAY;

                    }else{

                        error_log(__LINE__ . ' ddo SLOW....INITIALIZE CHANNEL [' . strval($channel) . '] META REQUEST FULFILLMENT :: MEMORY BUILD.');

                        $tmp_channel_ARRAY = $this->oCRNRSTN->get_channel_config($channel_constant_ARRAY, NULL, NULL, NULL, NULL, true);

                        //
                        // 4 INDICES.
                        // RETURN DATA BY ARRAY INDEX.
                        if(isset($index_0) && isset($index_1) && isset($index_2) && isset($index_3)){

                            //
                            // E.G.
                            // $channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER]
                            // $channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING]
                            // $channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER]
                            // $channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING]
                            if(isset($tmp_channel_ARRAY[$index_0][$index_1][$index_2][$index_3])){

                                return $tmp_channel_ARRAY[$index_0][$index_1][$index_2][$index_3];

                            }else{

                                $tmp_stripe_key_ARRAY = $this->oCRNRSTN->return_stripe_key_ARRAY('$index_0', '$index_1', '$index_2', '$index_3');
                                $tmp_param_err_str_ARRAY = $this->oCRNRSTN->return_regression_stripe_ARRAY('HAS_DATA_NOT_APPLIED', $tmp_stripe_key_ARRAY, $index_0, $index_1, $index_2, $index_3);

                                $tmp_param_missing_str = $tmp_param_err_str_ARRAY['string'];
                                //$tmp_param_missing_ARRAY = $tmp_param_err_str_ARRAY['index_array'];

                                //
                                // HOOOSTON...VE HAF PROBLEM!
                                throw new Exception('Unknown ' . strtoupper(strval($channel_constant_ARRAY)) . ' channel system meta requested. ' . $tmp_param_missing_str);

                            }

                        }

                        //
                        // 3 INDICES.
                        // RETURN DATA BY ARRAY INDEX.
                        if(isset($index_0) && isset($index_1) && isset($index_2)){

                            //
                            // E.G.
                            // $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = CRNRSTN_ENCRYPT_SOAP;
                            // $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = 'CRNRSTN_ENCRYPT_SOAP';
                            if(isset($tmp_channel_ARRAY[$index_0][$index_1][$index_2])){

                                return $tmp_channel_ARRAY[$index_0][$index_1][$index_2];

                            }else{

                                $tmp_stripe_key_ARRAY = $this->oCRNRSTN->return_stripe_key_ARRAY('$index_0', '$index_1', '$index_2');
                                $tmp_param_err_str_ARRAY = $this->oCRNRSTN->return_regression_stripe_ARRAY('HAS_DATA_NOT_APPLIED', $tmp_stripe_key_ARRAY, $index_0, $index_1, $index_2);

                                $tmp_param_missing_str = $tmp_param_err_str_ARRAY['string'];
                                //$tmp_param_missing_ARRAY = $tmp_param_err_str_ARRAY['index_array'];

                                //
                                // HOOOSTON...VE HAF PROBLEM!
                                throw new Exception('Unknown ' . strtoupper(strval($channel_constant_ARRAY)) . ' channel system meta requested. ' . $tmp_param_missing_str);

                            }

                        }

                        //
                        // 2 INDICES.
                        // RETURN DATA BY ARRAY INDEX.
                        if(isset($index_0) && isset($index_1)){

                            //
                            // E.G.
                            // $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_CHANNEL_SOAP;
                            // $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_CHANNEL_SOAP';
                            if(isset($tmp_channel_ARRAY[$index_0][$index_1])){

                                return $tmp_channel_ARRAY[$index_0][$index_1];

                            }else{

                                $tmp_stripe_key_ARRAY = $this->oCRNRSTN->return_stripe_key_ARRAY('$index_0', '$index_1');
                                $tmp_param_err_str_ARRAY = $this->oCRNRSTN->return_regression_stripe_ARRAY('HAS_DATA_NOT_APPLIED', $tmp_stripe_key_ARRAY, $index_0, $index_1);

                                $tmp_param_missing_str = $tmp_param_err_str_ARRAY['string'];
                                //$tmp_param_missing_ARRAY = $tmp_param_err_str_ARRAY['index_array'];

                                //
                                // HOOOSTON...VE HAF PROBLEM!
                                throw new Exception('Unknown ' . strtoupper(strval($channel_constant_ARRAY)) . ' channel system meta requested. ' . $tmp_param_missing_str);

                            }

                        }

                        //
                        // 1 INDICES.
                        // RETURN DATA BY ARRAY INDEX.
                        if(isset($index_0)){

                            //
                            // E.G.
                            // $tmp_channel_ARRAY['CHAR'] = 'O';
                            // $tmp_channel_ARRAY['NAME'] = 'soap';
                            // $tmp_channel_ARRAY['DESCRIPTION'] = 'O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1)';
                            if(isset($tmp_channel_ARRAY[$index_0])){

                                return $tmp_channel_ARRAY[$index_0];

                            }else{

                                $tmp_stripe_key_ARRAY = $this->oCRNRSTN->return_stripe_key_ARRAY('$index_0');
                                $tmp_param_err_str_ARRAY = $this->oCRNRSTN->return_regression_stripe_ARRAY('HAS_DATA_NOT_APPLIED', $tmp_stripe_key_ARRAY, $index_0);

                                $tmp_param_missing_str = $tmp_param_err_str_ARRAY['string'];
                                //$tmp_param_missing_ARRAY = $tmp_param_err_str_ARRAY['index_array'];

                                //
                                // HOOOSTON...VE HAF PROBLEM!
                                throw new Exception('Unknown ' . strtoupper(strval($channel_constant_ARRAY)) . ' channel system meta requested. ' . $tmp_param_missing_str);

                            }

                        }

                        error_log(__LINE__ . ' ddo DID YOU WANT THE WHOLE THING? ...MISS AN OPPORUNITY HERE, BRUV?');

                        return $tmp_channel_ARRAY;

                    }

                break;
                case CRNRSTN_ARRAY:

                    error_log(__LINE__ . ' ddo RUNTIME CHECKING ' . $this->oCRNRSTN->format_bytes(strlen(serialize($channel_constant_ARRAY)), 4) . ' OF [' . strval($channel_constant_ARRAY['NAME']) . '] CHANNEL META NOW. ['.print_r(self::$system_channel_alpha_ARRAY, true).'].');
                    die();

                    //
                    // A CHECK FOR CHANNEL INTIALIZATION; RUNS BY FORCE OR CHOICE.
                    //
                    if($initialize !== false || !isset(self::$system_channel_alpha_ARRAY[$channel_constant_ARRAY['SOURCEID'][CRNRSTN_INTEGER]])){

                        error_log(__LINE__ . ' ddo RUNTIME WRITING ' . $this->oCRNRSTN->format_bytes(strlen(serialize($channel_constant_ARRAY)), 4) . ' OF [' . strval($channel_constant_ARRAY['NAME']) . '] CHANNEL META NOW.');

                        //
                        // INITIALIZE CRNRSTN :: MULTI-CHANNEL META IN RUNTIME.
                        self::$system_channel_ARRAY[$this->oCRNRSTN->get_channel_config($channel, 'CHAR', NULL, NULL, NULL, true)] = $channel_constant_ARRAY;

                        //
                        // 4 INDICES.
                        // RETURN DATA BY ARRAY INDEX.
                        if(isset($index_0) && isset($index_1) && isset($index_2) && isset($index_3)){

                            //
                            // E.G.
                            // $channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER]
                            // $channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING]
                            // $channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER]
                            // $channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING]
                            if(isset($channel_constant_ARRAY[$index_0][$index_1][$index_2][$index_3])){

                                return $channel_constant_ARRAY[$index_0][$index_1][$index_2][$index_3];

                            }else{

                                $tmp_stripe_key_ARRAY = $this->oCRNRSTN->return_stripe_key_ARRAY('$index_0', '$index_1', '$index_2', '$index_3');
                                $tmp_param_err_str_ARRAY = $this->oCRNRSTN->return_regression_stripe_ARRAY('HAS_DATA_NOT_APPLIED', $tmp_stripe_key_ARRAY, $index_0, $index_1, $index_2, $index_3);

                                $tmp_param_missing_str = $tmp_param_err_str_ARRAY['string'];
                                //$tmp_param_missing_ARRAY = $tmp_param_err_str_ARRAY['index_array'];

                                //
                                // HOOOSTON...VE HAF PROBLEM!
                                throw new Exception('Unknown ' . strtoupper(strval($channel_constant_ARRAY)) . ' channel system meta requested. ' . $tmp_param_missing_str);

                            }

                        }

                        //
                        // 3 INDICES.
                        // RETURN DATA BY ARRAY INDEX.
                        if(isset($index_0) && isset($index_1) && isset($index_2)){

                            //
                            // E.G.
                            // $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = CRNRSTN_ENCRYPT_SOAP;
                            // $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = 'CRNRSTN_ENCRYPT_SOAP';
                            if(isset($channel_constant_ARRAY[$index_0][$index_1][$index_2])){

                                return $channel_constant_ARRAY[$index_0][$index_1][$index_2];

                            }else{

                                $tmp_stripe_key_ARRAY = $this->oCRNRSTN->return_stripe_key_ARRAY('$index_0', '$index_1', '$index_2');
                                $tmp_param_err_str_ARRAY = $this->oCRNRSTN->return_regression_stripe_ARRAY('HAS_DATA_NOT_APPLIED', $tmp_stripe_key_ARRAY, $index_0, $index_1, $index_2);

                                $tmp_param_missing_str = $tmp_param_err_str_ARRAY['string'];
                                //$tmp_param_missing_ARRAY = $tmp_param_err_str_ARRAY['index_array'];

                                //
                                // HOOOSTON...VE HAF PROBLEM!
                                throw new Exception('Unknown ' . strtoupper(strval($channel_constant_ARRAY)) . ' channel system meta requested. ' . $tmp_param_missing_str);

                            }

                        }

                        //
                        // 2 INDICES.
                        // RETURN DATA BY ARRAY INDEX.
                        if(isset($index_0) && isset($index_1)){

                            //
                            // E.G.
                            // $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_CHANNEL_SOAP;
                            // $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_CHANNEL_SOAP';
                            if(isset($channel_constant_ARRAY[$index_0][$index_1])){

                                return $channel_constant_ARRAY[$index_0][$index_1];

                            }else{

                                $tmp_stripe_key_ARRAY = $this->oCRNRSTN->return_stripe_key_ARRAY('$index_0', '$index_1');
                                $tmp_param_err_str_ARRAY = $this->oCRNRSTN->return_regression_stripe_ARRAY('HAS_DATA_NOT_APPLIED', $tmp_stripe_key_ARRAY, $index_0, $index_1);

                                $tmp_param_missing_str = $tmp_param_err_str_ARRAY['string'];
                                //$tmp_param_missing_ARRAY = $tmp_param_err_str_ARRAY['index_array'];

                                //
                                // HOOOSTON...VE HAF PROBLEM!
                                throw new Exception('Unknown ' . strtoupper(strval($channel_constant_ARRAY)) . ' channel system meta requested. ' . $tmp_param_missing_str);

                            }

                        }

                        //
                        // 1 INDICES.
                        // RETURN DATA BY ARRAY INDEX.
                        if(isset($index_0)){

                            //
                            // E.G.
                            // $tmp_channel_ARRAY['CHAR'] = 'O';
                            // $tmp_channel_ARRAY['NAME'] = 'soap';
                            // $tmp_channel_ARRAY['DESCRIPTION'] = 'O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1)';
                            if(isset($channel_constant_ARRAY[$index_0])){

                                return $channel_constant_ARRAY[$index_0];

                            }else{

                                $tmp_stripe_key_ARRAY = $this->oCRNRSTN->return_stripe_key_ARRAY('$index_0');
                                $tmp_param_err_str_ARRAY = $this->oCRNRSTN->return_regression_stripe_ARRAY('HAS_DATA_NOT_APPLIED', $tmp_stripe_key_ARRAY, $index_0);

                                $tmp_param_missing_str = $tmp_param_err_str_ARRAY['string'];
                                //$tmp_param_missing_ARRAY = $tmp_param_err_str_ARRAY['index_array'];

                                //
                                // HOOOSTON...VE HAF PROBLEM!
                                throw new Exception('Unknown ' . strtoupper(strval($channel_constant_ARRAY)) . ' channel system meta requested. ' . $tmp_param_missing_str);

                            }

                        }

                        error_log(__LINE__ . ' ddo DID YOU WANT THE WHOLE THING? ...MISS AN OPPORUNITY HERE, BRUV?');

                        return $channel_constant_ARRAY;

                    }else{

                        error_log(__LINE__ . ' ddo FAST RETURNING CRNRSTN :: MULTI-CHANNEL [' . strval(self::$system_channel_ARRAY['NAME']) . '] META DATA FROM RUNTIME. alpha[' . print_r(self::$system_channel_alpha_ARRAY, true) . '].');

                        //
                        // 4 INDICES.
                        // RETURN DATA BY ARRAY INDEX.
                        if(isset($index_0) && isset($index_1) && isset($index_2) && isset($index_3)){

                            if(isset(self::$system_channel_ARRAY[self::$system_channel_alpha_ARRAY[$channel_constant_ARRAY]][$index_0][$index_1][$index_2][$index_3])){

                                return self::$system_channel_ARRAY[self::$system_channel_alpha_ARRAY[$channel_constant_ARRAY]][$index_0][$index_1][$index_2][$index_3];

                            }else{

                                $tmp_stripe_key_ARRAY = $this->oCRNRSTN->return_stripe_key_ARRAY('$index_0', '$index_1', '$index_2', '$index_3');
                                $tmp_param_err_str_ARRAY = $this->oCRNRSTN->return_regression_stripe_ARRAY('HAS_DATA_NOT_APPLIED', $tmp_stripe_key_ARRAY, $index_0, $index_1, $index_2, $index_3);

                                $tmp_param_missing_str = $tmp_param_err_str_ARRAY['string'];
                                //$tmp_param_missing_ARRAY = $tmp_param_err_str_ARRAY['index_array'];

                                //
                                // HOOOSTON...VE HAF PROBLEM!
                                throw new Exception('Unknown ' . strtoupper(strval($channel_constant_ARRAY)) . ' channel system meta requested. ' . $tmp_param_missing_str);

                            }

                        }

                        //
                        // 3 INDICES.
                        // RETURN DATA BY ARRAY INDEX.
                        if(isset($index_0) && isset($index_1) && isset($index_2)){

                            if(isset(self::$system_channel_ARRAY[self::$system_channel_alpha_ARRAY[$channel_constant_ARRAY]][$index_0][$index_1][$index_2])){

                                return self::$system_channel_ARRAY[self::$system_channel_alpha_ARRAY[$channel_constant_ARRAY]][$index_0][$index_1][$index_2];

                            }else{

                                $tmp_stripe_key_ARRAY = $this->oCRNRSTN->return_stripe_key_ARRAY('$index_0', '$index_1', '$index_2');
                                $tmp_param_err_str_ARRAY = $this->oCRNRSTN->return_regression_stripe_ARRAY('HAS_DATA_NOT_APPLIED', $tmp_stripe_key_ARRAY, $index_0, $index_1, $index_2);

                                $tmp_param_missing_str = $tmp_param_err_str_ARRAY['string'];
                                //$tmp_param_missing_ARRAY = $tmp_param_err_str_ARRAY['index_array'];

                                //
                                // HOOOSTON...VE HAF PROBLEM!
                                throw new Exception('Unknown ' . strtoupper(strval($channel_constant_ARRAY)) . ' channel system meta requested. ' . $tmp_param_missing_str);

                            }

                        }

                        //
                        // 2 INDICES.
                        // RETURN DATA BY ARRAY INDEX.
                        if(isset($index_0) && isset($index_1)){

                            if(isset(self::$system_channel_ARRAY[self::$system_channel_alpha_ARRAY[$channel_constant_ARRAY]][$index_0][$index_1])){

                                return self::$system_channel_ARRAY[self::$system_channel_alpha_ARRAY[$channel_constant_ARRAY]][$index_0][$index_1];

                            }else{

                                $tmp_stripe_key_ARRAY = $this->oCRNRSTN->return_stripe_key_ARRAY('$index_0', '$index_1');
                                $tmp_param_err_str_ARRAY = $this->oCRNRSTN->return_regression_stripe_ARRAY('HAS_DATA_NOT_APPLIED', $tmp_stripe_key_ARRAY, $index_0, $index_1);

                                $tmp_param_missing_str = $tmp_param_err_str_ARRAY['string'];
                                //$tmp_param_missing_ARRAY = $tmp_param_err_str_ARRAY['index_array'];

                                //
                                // HOOOSTON...VE HAF PROBLEM!
                                throw new Exception('Unknown ' . strtoupper(strval($channel_constant_ARRAY)) . ' channel system meta requested. ' . $tmp_param_missing_str);

                            }

                        }

                        //
                        // 1 INDICES.
                        // RETURN DATA BY ARRAY INDEX.
                        if(isset($index_0)){

                            if(isset(self::$system_channel_ARRAY[self::$system_channel_alpha_ARRAY[$channel_constant_ARRAY]][$index_0])){

                                return self::$system_channel_ARRAY[self::$system_channel_alpha_ARRAY[$channel_constant_ARRAY]][$index_0];

                            }else{

                                $tmp_stripe_key_ARRAY = $this->oCRNRSTN->return_stripe_key_ARRAY('$index_0');
                                $tmp_param_err_str_ARRAY = $this->oCRNRSTN->return_regression_stripe_ARRAY('HAS_DATA_NOT_APPLIED', $tmp_stripe_key_ARRAY, $index_0);

                                $tmp_param_missing_str = $tmp_param_err_str_ARRAY['string'];
                                //$tmp_param_missing_ARRAY = $tmp_param_err_str_ARRAY['index_array'];

                                //
                                // HOOOSTON...VE HAF PROBLEM!
                                throw new Exception('Unknown ' . strtoupper(strval($channel_constant_ARRAY)) . ' channel system meta requested. ' . $tmp_param_missing_str);

                            }

                        }

                        error_log(__LINE__ . ' ddo DID YOU WANT THE WHOLE THING? ...MISS AN OPPORUNITY HERE, BRUV?');

                        return self::$system_channel_ARRAY[self::$system_channel_alpha_ARRAY[$channel_constant_ARRAY]];

                    }

                break;

            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN EMPTY STRING.
            return '';

        }

    }

    public function get_channel_config($channel, $index_0 = NULL, $index_1 = NULL, $index_2 = NULL, $index_3 = NULL, $initialize = false){


        if($tmp_result = $this->is_rrs_mapped($index_0)){

            error_log(__LINE__ . ' ddo RRS MAP INTERNAL ATTRIBUTE MATCH get_channel_config() :: RRS MAP ATTRIBUTE[' . $index_0 . ']. $channel[' . $channel . '].');
            error_log(__LINE__ . ' ddo $index_0[' . $index_0 . ']. $index_1[' . $index_1 . ']. $index_2[' . $index_2 . ']. $index_3[' . $index_3 . ']. $initialize[' . $initialize . '].');

            return self::$oCRNRSTN_RRS_MAP->rrs_map_get($index_0, $channel);

        }

        //$tmp = strlen(array());
        // die();
        // RENAMED THIS METHOD AND PRESSED BACK INTO SERVICE ON Tuesday, October 10, 2023 @ 0651 hrs.
        // LAST MODIFIED: Wednesday, October 18, 2023 @ 0110 hrs.
        //
        // ORIGINAL METHOD NAME AND INTRO NOTES:
        //      public function follows_channel_init_sequence($channel){
        //
        //      /*
        //      CRNRSTN :: ORDER OF OPERATIONS (PREFERENCE) FOR SPECIFICATION OF
        //      AUTHORIZED DATA ARCHITECTURES (CHANNEL).
        //
        //      DATA HANDLING ARCHITECTURES
        //      -----
        //      G :: HTTP $_GET REQUEST.
        //      P :: HTTP $_POST REQUEST.
        //      H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).
        //      S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).
        //      J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
        //      C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR BROWSER COOKIE...
        //      D :: DATABASE (MySQLi CONNECTION).
        //      R :: RUNTIME.
        //      O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
        //      F :: SERVER LOCAL FILE SYSTEM.
        //
        //      GPHSJCDROF
        //
        //      */

        try{

            // //
            // // IF RUNTIME IS SET, JUST RETURN.
            // if(isset(self::$system_channel_ARRAY[$this->get_channel_config($channel, 'CHAR', NULL, NULL, NULL, true)])){

            //     error_log(__LINE__ . ' ddo BLAZING FAST CHANNEL[' . strval($channel) . '] META FULFILLMENT.');
            //     return $this->channel_meta($channel, $index_0, $index_1, $index_2, $index_3, $initialize);

            // }

            if($initialize !== false){

                error_log(__LINE__ . ' ddo initialize = TRUE;');
                $tmp_channel_ARRAY = array();

                //
                // GET CHANNEL META DATA.
                switch($channel){
                    case CRNRSTN_CHANNEL_GET:
                    case 'CRNRSTN_CHANNEL_GET':
                    case CRNRSTN_AUTHORIZE_GET:
                    case 'CRNRSTN_AUTHORIZE_GET':
                    case CRNRSTN_ENCRYPT_GET:
                    case 'CRNRSTN_ENCRYPT_GET':
                    case 'G':
                    case 'GET':
                    case 'g':
                    case 'get':
                    case 'Get':
                        //G :: HTTP $_GET REQUEST.

                        //
                        // INITIALIZATION RETURN FOR ACCELERATION
                        // OF MULI-CHANNEL RESOURCE MANAGEMENT.
                        //
                        // JUST THE CHAR RETURN.

                        error_log(__LINE__. ' ddo [' . $channel . '].');
                        $tmp_channel_ARRAY['CHAR'] = 'G';
                        if(($index_0 == 'CHAR') && !($initialize !== false)){

                            error_log(__LINE__ . ' ddo initialize = TRUE;');

                            return $tmp_channel_ARRAY['CHAR'];

                        }

                        $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_CHANNEL_GET;
                        $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_CHANNEL_GET';
                        $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = CRNRSTN_ENCRYPT_GET;
                        $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = 'CRNRSTN_ENCRYPT_GET';
                        $tmp_channel_ARRAY['NAME'] = 'get';
                        $tmp_channel_ARRAY['DESCRIPTION'] = 'G :: HTTP $_GET REQUEST';
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = CRNRSTN_AUTHORIZE_GET;
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = 'CRNRSTN_AUTHORIZE_GET';
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_ALL => CRNRSTN_AUTHORIZE_ALL,
                            CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_POST & CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_POST & CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_COOKIE & CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_COOKIE & CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_SESSION & CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_SESSION & CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE);
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_ALL' => CRNRSTN_AUTHORIZE_ALL,
                            'CRNRSTN_AUTHORIZE_POST & CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_POST & CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_COOKIE & CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_COOKIE & CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_SESSION & CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_SESSION & CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_RUNTIME' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_RUNTIME,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP);


                        error_log(__LINE__ . ' ddo $_GET LOADED 100%.');
                        //die();

                        /*
                        ALL OF THE OPTIONS THUS.
                        -----
                        CRNRSTN_AUTHORIZE_ALL
                        CRNRSTN_AUTHORIZE_GET
                        CRNRSTN_AUTHORIZE_POST
                        CRNRSTN_AUTHORIZE_COOKIE
                        CRNRSTN_AUTHORIZE_SESSION
                        CRNRSTN_AUTHORIZE_DATABASE
                        CRNRSTN_AUTHORIZE_SSDTLA
                        CRNRSTN_AUTHORIZE_PSSDTLA
                        CRNRSTN_AUTHORIZE_RUNTIME
                        CRNRSTN_AUTHORIZE_SOAP
                        -----
                        CRNRSTN_AUTHORIZE_POST & CRNRSTN_AUTHORIZE_GET
                        CRNRSTN_AUTHORIZE_COOKIE & CRNRSTN_AUTHORIZE_GET
                        CRNRSTN_AUTHORIZE_SESSION & CRNRSTN_AUTHORIZE_GET
                        CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_GET
                        CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_GET
                        CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_GET
                        CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_GET
                        CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_GET
                        CRNRSTN_AUTHORIZE_COOKIE & CRNRSTN_AUTHORIZE_POST
                        CRNRSTN_AUTHORIZE_SESSION & CRNRSTN_AUTHORIZE_POST
                        CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_POST
                        CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_POST
                        CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_POST
                        CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_POST
                        CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_POST
                        CRNRSTN_AUTHORIZE_SESSION & CRNRSTN_AUTHORIZE_COOKIE
                        CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_COOKIE
                        CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_COOKIE
                        CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_COOKIE
                        CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_COOKIE
                        CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_COOKIE
                        CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_SESSION
                        CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_SESSION
                        CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_SESSION
                        CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_SESSION
                        CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_SESSION
                        CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_DATABASE
                        CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_DATABASE
                        CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_DATABASE
                        CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_DATABASE
                        CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_SSDTLA
                        CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_SSDTLA
                        CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_SSDTLA
                        CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_PSSDTLA
                        CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_PSSDTLA
                        CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_RUNTIME

                        CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST
                        CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE
                        CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION
                        CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE
                        CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE
                        CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION
                        CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA
                        CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE
                        CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA
                        CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE
                        CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP
                        CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE

                        */

                    break;

                    case CRNRSTN_CHANNEL_POST:
                    case 'CRNRSTN_CHANNEL_POST':
                    case CRNRSTN_AUTHORIZE_POST:
                    case 'CRNRSTN_AUTHORIZE_POST':
                    case CRNRSTN_ENCRYPT_POST:
                    case 'CRNRSTN_ENCRYPT_POST':
                    case 'P':
                    case 'POST':
                    case 'p':
                    case 'post':
                    case 'Post':
                        //P :: HTTP $_POST REQUEST.

                        //
                        // INITIALIZATION RETURN FOR ACCELERATION
                        // OF MULI-CHANNEL RESOURCE MANAGEMENT.
                        $tmp_channel_ARRAY['CHAR'] = 'P';
                        if(($index_0 == 'CHAR') && !($initialize !== false)){

                            return $tmp_channel_ARRAY['CHAR'];

                        }

                        $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_CHANNEL_POST;
                        $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_CHANNEL_POST';
                        $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = CRNRSTN_ENCRYPT_POST;
                        $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = 'CRNRSTN_ENCRYPT_POST';
                        $tmp_channel_ARRAY['NAME'] = 'post';
                        $tmp_channel_ARRAY['DESCRIPTION'] = 'P :: HTTP $_POST REQUEST';
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = CRNRSTN_AUTHORIZE_POST;
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = 'CRNRSTN_AUTHORIZE_POST';
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_ALL => CRNRSTN_AUTHORIZE_ALL,
                            CRNRSTN_AUTHORIZE_POST => CRNRSTN_AUTHORIZE_POST,
                            CRNRSTN_AUTHORIZE_COOKIE & CRNRSTN_AUTHORIZE_POST => CRNRSTN_AUTHORIZE_COOKIE & CRNRSTN_AUTHORIZE_POST,
                            CRNRSTN_AUTHORIZE_SESSION & CRNRSTN_AUTHORIZE_POST => CRNRSTN_AUTHORIZE_SESSION & CRNRSTN_AUTHORIZE_POST,
                            CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_POST => CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_POST,
                            CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_POST => CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_POST,
                            CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_POST => CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_POST,
                            CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_POST => CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_POST,
                            CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_POST => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_POST,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE);
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_ALL' => CRNRSTN_AUTHORIZE_ALL,
                            'CRNRSTN_AUTHORIZE_POST' => CRNRSTN_AUTHORIZE_POST,
                            'CRNRSTN_AUTHORIZE_COOKIE & CRNRSTN_AUTHORIZE_POST' => CRNRSTN_AUTHORIZE_COOKIE & CRNRSTN_AUTHORIZE_POST,
                            'CRNRSTN_AUTHORIZE_SESSION & CRNRSTN_AUTHORIZE_POST' => CRNRSTN_AUTHORIZE_SESSION & CRNRSTN_AUTHORIZE_POST,
                            'CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_POST' => CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_POST,
                            'CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_POST' => CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_POST,
                            'CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_POST' => CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_POST,
                            'CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_POST' => CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_POST,
                            'CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_POST' => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_POST,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION' & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE' & ~CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE);

                    break;

                    case CRNRSTN_CHANNEL_COOKIE:
                    case 'CRNRSTN_CHANNEL_COOKIE':
                    case CRNRSTN_AUTHORIZE_COOKIE:
                    case 'CRNRSTN_AUTHORIZE_COOKIE':
                    case CRNRSTN_ENCRYPT_COOKIE:
                    case 'CRNRSTN_ENCRYPT_COOKIE':
                    case 'C':
                    case 'COOKIE':
                    case 'c':
                    case 'cookie':
                    case 'Cookie':
                        //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE (I.E. IF IT WORKS, IT WORKS) TO CRNRSTN ::

                        //
                        // INITIALIZATION RETURN FOR ACCELERATION
                        // OF MULI-CHANNEL RESOURCE MANAGEMENT.
                        $tmp_channel_ARRAY['CHAR'] = 'C';
                        if(($index_0 == 'CHAR') && !($initialize !== false)){

                            return $tmp_channel_ARRAY['CHAR'];

                        }

                        $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_CHANNEL_COOKIE;
                        $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_CHANNEL_COOKIE';
                        $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = CRNRSTN_ENCRYPT_COOKIE;
                        $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = 'CRNRSTN_ENCRYPT_COOKIE';
                        $tmp_channel_ARRAY['NAME'] = 'cookie';
                        $tmp_channel_ARRAY['DESCRIPTION'] = 'C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::';
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = CRNRSTN_AUTHORIZE_COOKIE;
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = 'CRNRSTN_AUTHORIZE_COOKIE';
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_ALL => CRNRSTN_AUTHORIZE_ALL,
                            CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_COOKIE & CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_COOKIE & CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_COOKIE & CRNRSTN_AUTHORIZE_POST => CRNRSTN_AUTHORIZE_COOKIE & CRNRSTN_AUTHORIZE_POST,
                            CRNRSTN_AUTHORIZE_SESSION & CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_SESSION & CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_RUNTIME => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_RUNTIME,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP);
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_ALL' => CRNRSTN_AUTHORIZE_ALL,
                            'CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_COOKIE & CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_COOKIE & CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_COOKIE & CRNRSTN_AUTHORIZE_POST' => CRNRSTN_AUTHORIZE_COOKIE & CRNRSTN_AUTHORIZE_POST,
                            'CRNRSTN_AUTHORIZE_SESSION & CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_SESSION & CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_RUNTIME' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_RUNTIME,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP);

                    break;

                    case CRNRSTN_CHANNEL_SESSION:
                    case 'CRNRSTN_CHANNEL_SESSION':
                    case CRNRSTN_AUTHORIZE_SESSION:
                    case 'CRNRSTN_AUTHORIZE_SESSION':
                    case CRNRSTN_ENCRYPT_SESSION:
                    case 'CRNRSTN_ENCRYPT_SESSION':
                    case 'H':
                    case 'SESSION':
                    case 'h':
                    case 'session':
                    case 'Session':
                        //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

                        //
                        // INITIALIZATION RETURN FOR ACCELERATION
                        // OF MULI-CHANNEL RESOURCE MANAGEMENT.
                        $tmp_channel_ARRAY['CHAR'] = 'H';
                        if(($index_0 == 'CHAR') && !($initialize !== false)){

                            return $tmp_channel_ARRAY['CHAR'];

                        }

                        $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_CHANNEL_SESSION;
                        $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_CHANNEL_SESSION';
                        $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = CRNRSTN_ENCRYPT_SESSION;
                        $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = 'CRNRSTN_ENCRYPT_SESSION';
                        $tmp_channel_ARRAY['NAME'] = 'session';
                        $tmp_channel_ARRAY['DESCRIPTION'] = 'H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY)';
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = CRNRSTN_AUTHORIZE_SESSION;
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = 'CRNRSTN_AUTHORIZE_SESSION';
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_ALL => CRNRSTN_AUTHORIZE_ALL,
                            CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_SESSION,
                            CRNRSTN_AUTHORIZE_SESSION & CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_SESSION & CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_SESSION & CRNRSTN_AUTHORIZE_POST => CRNRSTN_AUTHORIZE_SESSION & CRNRSTN_AUTHORIZE_POST,
                            CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_SESSION,
                            CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_SESSION,
                            CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_SESSION,
                            CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_SESSION,
                            CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_SESSION,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE);
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_ALL' => CRNRSTN_AUTHORIZE_ALL,
                            'CRNRSTN_AUTHORIZE_SESSION' => CRNRSTN_AUTHORIZE_SESSION,
                            'CRNRSTN_AUTHORIZE_SESSION & CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_SESSION & CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_SESSION & CRNRSTN_AUTHORIZE_POST' => CRNRSTN_AUTHORIZE_SESSION & CRNRSTN_AUTHORIZE_POST,
                            'CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_SESSION' => CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_SESSION,
                            'CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_SESSION' => CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_SESSION,
                            'CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_SESSION' => CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_SESSION,
                            'CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_SESSION' => CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_SESSION,
                            'CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_SESSION' => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_SESSION,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE);

                    break;

                    case CRNRSTN_CHANNEL_DATABASE:
                    case 'CRNRSTN_CHANNEL_DATABASE':
                    case CRNRSTN_AUTHORIZE_DATABASE:
                    case 'CRNRSTN_AUTHORIZE_DATABASE':
                    case CRNRSTN_ENCRYPT_DATABASE:
                    case 'CRNRSTN_ENCRYPT_DATABASE':
                    case 'D':
                    case 'DATABASE':
                    case 'd':
                    case 'database':
                    case 'Database':
                        //D :: DATABASE (MySQLi CONNECTION).

                        //
                        // INITIALIZATION RETURN FOR ACCELERATION
                        // OF MULI-CHANNEL RESOURCE MANAGEMENT.
                        $tmp_channel_ARRAY['CHAR'] = 'D';
                        if(($index_0 == 'CHAR') && !($initialize !== false)){

                            return $tmp_channel_ARRAY['CHAR'];

                        }

                        $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_CHANNEL_DATABASE;
                        $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_CHANNEL_DATABASE';
                        $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = CRNRSTN_ENCRYPT_DATABASE;
                        $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = 'CRNRSTN_ENCRYPT_DATABASE';
                        $tmp_channel_ARRAY['NAME'] = 'database';
                        $tmp_channel_ARRAY['DESCRIPTION'] = 'D :: DATABASE (MySQLi CONNECTION)';
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = CRNRSTN_AUTHORIZE_DATABASE;
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = 'CRNRSTN_AUTHORIZE_DATABASE';
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_ALL => CRNRSTN_AUTHORIZE_ALL,
                            CRNRSTN_AUTHORIZE_DATABASE => CRNRSTN_AUTHORIZE_DATABASE,
                            CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_POST => CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_POST,
                            CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_SESSION,
                            CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_DATABASE => CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_DATABASE,
                            CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_DATABASE => CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_DATABASE,
                            CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_DATABASE => CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_DATABASE,
                            CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_DATABASE => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_DATABASE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE);
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_ALL' => CRNRSTN_AUTHORIZE_ALL,
                            'CRNRSTN_AUTHORIZE_DATABASE' => CRNRSTN_AUTHORIZE_DATABASE,
                            'CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_POST' => CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_POST,
                            'CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_SESSION' => CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_SESSION,
                            'CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_DATABASE' => CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_DATABASE,
                            'CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_DATABASE' => CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_DATABASE,
                            'CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_DATABASE' => CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_DATABASE,
                            'CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_DATABASE' => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_DATABASE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE);

                    break;

                    case CRNRSTN_CHANNEL_SSDTLA:
                    case 'CRNRSTN_CHANNEL_SSDTLA':
                    case CRNRSTN_AUTHORIZE_SSDTLA:
                    case 'CRNRSTN_AUTHORIZE_SSDTLA':
                    case 'S':
                    case 'SSDTLA':
                    case 's':
                    case 'ssdtla':
                        //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).

                        //
                        // INITIALIZATION RETURN FOR ACCELERATION
                        // OF MULI-CHANNEL RESOURCE MANAGEMENT.
                        $tmp_channel_ARRAY['CHAR'] = 'S';
                        if(($index_0 == 'CHAR') && !($initialize !== false)){

                            return $tmp_channel_ARRAY['CHAR'];

                        }

                        $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_CHANNEL_SSDTLA;
                        $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_CHANNEL_SSDTLA';
                        $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = CRNRSTN_ENCRYPT_TUNNEL;
                        $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = 'CRNRSTN_ENCRYPT_TUNNEL';
                        $tmp_channel_ARRAY['NAME'] = 'ssdtla';
                        $tmp_channel_ARRAY['DESCRIPTION'] = 'S :: CRNRSTN :: SOAP SERVICES DATA TUNNEL LAYER ARCHITECTURE (SSDTLA)';
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = CRNRSTN_AUTHORIZE_SSDTLA;
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = 'CRNRSTN_AUTHORIZE_SSDTLA';
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_ALL => CRNRSTN_AUTHORIZE_ALL,
                            CRNRSTN_AUTHORIZE_SSDTLA => CRNRSTN_AUTHORIZE_SSDTLA,
                            CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_POST => CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_POST,
                            CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_SESSION,
                            CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_DATABASE => CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_DATABASE,
                            CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_SSDTLA => CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_SSDTLA,
                            CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_SSDTLA => CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_SSDTLA,
                            CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_SSDTLA => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_SSDTLA,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE);
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_ALL' => CRNRSTN_AUTHORIZE_ALL,
                            'CRNRSTN_AUTHORIZE_SSDTLA' => CRNRSTN_AUTHORIZE_SSDTLA,
                            'CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_POST' => CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_POST,
                            'CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_SESSION' => CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_SESSION,
                            'CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_DATABASE' => CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_DATABASE,
                            'CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_SSDTLA' => CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_SSDTLA,
                            'CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_SSDTLA' => CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_SSDTLA,
                            'CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_SSDTLA' => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_SSDTLA,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET '=> CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE);

                    break;

                    case CRNRSTN_CHANNEL_PSSDTLA:
                    case 'CRNRSTN_CHANNEL_PSSDTLA':
                    case CRNRSTN_AUTHORIZE_PSSDTLA:
                    case 'CRNRSTN_AUTHORIZE_PSSDTLA':
                    case 'J':
                    case 'PSSDTLA':
                    case 'j':
                    case 'pssdtla':
                        //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).

                        //
                        // INITIALIZATION RETURN FOR ACCELERATION
                        // OF MULI-CHANNEL RESOURCE MANAGEMENT.
                        $tmp_channel_ARRAY['CHAR'] = 'J';
                        if(($index_0 == 'CHAR') && !($initialize !== false)){

                            return $tmp_channel_ARRAY['CHAR'];

                        }

                        $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_CHANNEL_PSSDTLA;
                        $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_CHANNEL_PSSDTLA';
                        $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = CRNRSTN_ENCRYPT_TUNNEL;
                        $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = 'CRNRSTN_ENCRYPT_TUNNEL';
                        $tmp_channel_ARRAY['NAME'] = 'pssdtla';
                        $tmp_channel_ARRAY['DESCRIPTION'] = 'J :: CRNRSTN :: PSEUDO-SOAP SERVICES DATA TUNNEL LAYER ARCHITECTURE (PSSDTLA)';
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = CRNRSTN_AUTHORIZE_PSSDTLA;
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = 'CRNRSTN_AUTHORIZE_PSSDTLA';
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_ALL => CRNRSTN_AUTHORIZE_ALL,
                            CRNRSTN_AUTHORIZE_PSSDTLA => CRNRSTN_AUTHORIZE_PSSDTLA,
                            CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_POST => CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_POST,
                            CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_SESSION,
                            CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_DATABASE => CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_DATABASE,
                            CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_SSDTLA => CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_SSDTLA,
                            CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_PSSDTLA => CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_PSSDTLA,
                            CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_PSSDTLA => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_PSSDTLA,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE);
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_ALL' => CRNRSTN_AUTHORIZE_ALL,
                            'CRNRSTN_AUTHORIZE_PSSDTLA' => CRNRSTN_AUTHORIZE_PSSDTLA,
                            'CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_POST' => CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_POST,
                            'CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_SESSION' => CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_SESSION,
                            'CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_DATABASE' => CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_DATABASE,
                            'CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_SSDTLA' => CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_SSDTLA,
                            'CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_PSSDTLA' => CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_PSSDTLA,
                            'CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_PSSDTLA' => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_PSSDTLA,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST' & ~CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE);

                    break;

                    case CRNRSTN_CHANNEL_RUNTIME:
                    case 'CRNRSTN_CHANNEL_RUNTIME':
                    case CRNRSTN_AUTHORIZE_RUNTIME:
                    case 'CRNRSTN_AUTHORIZE_RUNTIME':
                    case 'R':
                    case 'RUNTIME':
                    case 'r':
                    case 'runtime':
                    case 'Runtime':
                        //R :: RUNTIME.

                        //
                        // INITIALIZATION RETURN FOR ACCELERATION
                        // OF MULI-CHANNEL RESOURCE MANAGEMENT.
                        $tmp_channel_ARRAY['CHAR'] = 'R';
                        if(($index_0 == 'CHAR') && !($initialize !== false)){

                            return $tmp_channel_ARRAY['CHAR'];

                        }

                        $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_CHANNEL_RUNTIME;
                        $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_CHANNEL_RUNTIME';
                        $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = CRNRSTN_ENCRYPT_TUNNEL;
                        $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = 'CRNRSTN_ENCRYPT_TUNNEL';
                        $tmp_channel_ARRAY['NAME'] = 'runtime';
                        $tmp_channel_ARRAY['DESCRIPTION'] = 'R :: RUNTIME';
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = CRNRSTN_AUTHORIZE_RUNTIME;
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = 'CRNRSTN_AUTHORIZE_RUNTIME';
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_ALL => CRNRSTN_AUTHORIZE_ALL,
                            CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_POST => CRNRSTN_AUTHORIZE_POST,
                            CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_SESSION,
                            CRNRSTN_AUTHORIZE_DATABASE => CRNRSTN_AUTHORIZE_DATABASE,
                            CRNRSTN_AUTHORIZE_SSDTLA => CRNRSTN_AUTHORIZE_SSDTLA,
                            CRNRSTN_AUTHORIZE_PSSDTLA => CRNRSTN_AUTHORIZE_PSSDTLA,
                            CRNRSTN_AUTHORIZE_RUNTIME => CRNRSTN_AUTHORIZE_RUNTIME,
                            CRNRSTN_AUTHORIZE_SOAP => CRNRSTN_AUTHORIZE_SOAP,
                            CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_POST => CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_POST,
                            CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_SESSION,
                            CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_DATABASE => CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_DATABASE,
                            CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_SSDTLA => CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_SSDTLA,
                            CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_PSSDTLA => CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_PSSDTLA,
                            CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_RUNTIME => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_RUNTIME,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE);
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_ALL' => CRNRSTN_AUTHORIZE_ALL,
                            'CRNRSTN_AUTHORIZE_DATABASE' => CRNRSTN_AUTHORIZE_DATABASE,
                            'CRNRSTN_AUTHORIZE_SSDTLA' => CRNRSTN_AUTHORIZE_SSDTLA,
                            'CRNRSTN_AUTHORIZE_PSSDTLA' => CRNRSTN_AUTHORIZE_PSSDTLA,
                            'CRNRSTN_AUTHORIZE_SESSION' => CRNRSTN_AUTHORIZE_SESSION,
                            'CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_SOAP' => CRNRSTN_AUTHORIZE_SOAP,
                            'CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_POST' => CRNRSTN_AUTHORIZE_POST,
                            'CRNRSTN_AUTHORIZE_RUNTIME' => CRNRSTN_AUTHORIZE_RUNTIME,
                            'CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_POST' => CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_POST,
                            'CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_SESSION' => CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_SESSION,
                            'CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_DATABASE' => CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_DATABASE,
                            'CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_SSDTLA' => CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_SSDTLA,
                            'CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_PSSDTLA' => CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_PSSDTLA,
                            'CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_RUNTIME' => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_RUNTIME,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SOAP & ~CRNRSTN_AUTHORIZE_COOKIE);

                    break;

                    case CRNRSTN_CHANNEL_SOAP:
                    case 'CRNRSTN_CHANNEL_SOAP':
                    case CRNRSTN_AUTHORIZE_SOAP:
                    case 'CRNRSTN_AUTHORIZE_SOAP':
                    case CRNRSTN_ENCRYPT_SOAP:
                    case 'CRNRSTN_ENCRYPT_SOAP':
                    case 'O':
                    case 'SOAP':
                    case 'o':
                    case 'soap':
                    case 'Soap':
                        //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).

                        //
                        // INITIALIZATION RETURN FOR ACCELERATION
                        // OF MULI-CHANNEL RESOURCE MANAGEMENT.
                        $tmp_channel_ARRAY['CHAR'] = 'O';
                        if(($index_0 == 'CHAR') && !($initialize !== false)){

                            return $tmp_channel_ARRAY['CHAR'];

                        }

                        $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_CHANNEL_SOAP;
                        $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_CHANNEL_SOAP';
                        $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = CRNRSTN_ENCRYPT_SOAP;
                        $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = 'CRNRSTN_ENCRYPT_SOAP';
                        $tmp_channel_ARRAY['NAME'] = 'soap';
                        $tmp_channel_ARRAY['DESCRIPTION'] = 'O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1)';
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = CRNRSTN_AUTHORIZE_SOAP;
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = 'CRNRSTN_AUTHORIZE_SOAP';
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_ALL => CRNRSTN_AUTHORIZE_ALL,
                            CRNRSTN_AUTHORIZE_SOAP => CRNRSTN_AUTHORIZE_SOAP,
                            CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_POST => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_POST,
                            CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_SESSION,
                            CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_DATABASE => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_DATABASE,
                            CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_SSDTLA => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_SSDTLA,
                            CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_PSSDTLA => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_PSSDTLA,
                            CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_RUNTIME => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_RUNTIME,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_RUNTIME => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_RUNTIME);
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_ALL' => CRNRSTN_AUTHORIZE_ALL,
                            'CRNRSTN_AUTHORIZE_SOAP' => CRNRSTN_AUTHORIZE_SOAP,
                            'CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_POST' => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_POST,
                            'CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_SESSION' => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_SESSION,
                            'CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_DATABASE' => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_DATABASE,
                            'CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_SSDTLA' => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_SSDTLA,
                            'CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_PSSDTLA' => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_PSSDTLA,
                            'CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_RUNTIME' => CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_RUNTIME,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION' & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE' & ~CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA' & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_RUNTIME' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_RUNTIME);

                    break;

                    case CRNRSTN_CHANNEL_FILE:
                    case 'CRNRSTN_CHANNEL_FILE':
                    case CRNRSTN_AUTHORIZE_FILE:
                    case 'CRNRSTN_AUTHORIZE_FILE':
                    case CRNRSTN_ENCRYPT_FILE:
                    case 'CRNRSTN_ENCRYPT_FILE':
                    case 'F':
                    case 'FILE':
                    case 'f':
                    case 'file':
                    case 'File':
                        //F :: SERVER LOCAL FILE SYSTEM.

                        //
                        // INITIALIZATION RETURN FOR ACCELERATION
                        // OF MULI-CHANNEL RESOURCE MANAGEMENT.
                        $tmp_channel_ARRAY['CHAR'] = 'O';
                        if(($index_0 == 'CHAR') && !($initialize !== false)){

                            return $tmp_channel_ARRAY['CHAR'];

                        }

                        $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_CHANNEL_FILE;
                        $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_CHANNEL_FILE';
                        $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = CRNRSTN_ENCRYPT_FILE;
                        $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = 'CRNRSTN_ENCRYPT_FILE';
                        $tmp_channel_ARRAY['NAME'] = 'file';
                        $tmp_channel_ARRAY['DESCRIPTION'] = 'F :: SERVER LOCAL FILE SYSTEM.';
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = CRNRSTN_AUTHORIZE_FILE;
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = 'CRNRSTN_AUTHORIZE_FILE';
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_ALL => CRNRSTN_AUTHORIZE_ALL,
                            CRNRSTN_AUTHORIZE_FILE => CRNRSTN_AUTHORIZE_FILE,
                            CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_POST => CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_POST,
                            CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_SESSION,
                            CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_DATABASE => CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_DATABASE,
                            CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_SSDTLA => CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_SSDTLA,
                            CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_PSSDTLA => CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_PSSDTLA,
                            CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_RUNTIME => CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_RUNTIME,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE,
                            CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_RUNTIME => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_RUNTIME);
                        $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_ALL' => CRNRSTN_AUTHORIZE_ALL,
                            'CRNRSTN_AUTHORIZE_FILE' => CRNRSTN_AUTHORIZE_FILE,
                            'CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_POST' => CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_POST,
                            'CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_SESSION' => CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_SESSION,
                            'CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_DATABASE' => CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_DATABASE,
                            'CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_SSDTLA' => CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_SSDTLA,
                            'CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_PSSDTLA' => CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_PSSDTLA,
                            'CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_RUNTIME' => CRNRSTN_AUTHORIZE_FILE & CRNRSTN_AUTHORIZE_RUNTIME,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_POST & ~CRNRSTN_AUTHORIZE_GET,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION' & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SESSION & ~CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE' & ~CRNRSTN_AUTHORIZE_SESSION => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_DATABASE & ~CRNRSTN_AUTHORIZE_SESSION,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA' & ~CRNRSTN_AUTHORIZE_COOKIE => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_SSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_PSSDTLA & ~CRNRSTN_AUTHORIZE_COOKIE,
                            'CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_RUNTIME' => CRNRSTN_AUTHORIZE_ALL & ~CRNRSTN_AUTHORIZE_RUNTIME);

                    break;

                }

                if(isset($tmp_channel_ARRAY['CHAR'])){

                    error_log(__LINE__ . ' ddo CHANNEL CHAR [' . $tmp_channel_ARRAY['CHAR'] . '].');
                    self::$system_channel_ARRAY[$tmp_channel_ARRAY['CHAR']] = $tmp_channel_ARRAY;

                }else{

                    error_log(__LINE__ . ' ddo CHANNEL ARRAY NOT SET. THIS SHOULD NOT COME FROM SYSTEM INPUT.');

                }

                die();

                // if(isset($tmp_channel_ARRAY['CHAR'])){

                //     $channel = $tmp_channel_ARRAY;
                //     error_log(__LINE__ . ' ddo CHANNEL ARRAY SET[' . print_r($tmp_channel_ARRAY, true) . '].');

                //     //return $this->channel_meta($tmp_channel_ARRAY, $index_0, $index_1, $index_2, $index_3, $initialize);

                // }else{

                    //error_log(__LINE__ . ' ddo CHANNEL ARRAY NOT SET.');
                    //error_log(__LINE__ . ' ddo [' . print_r($channel, true) . ']. 0[' . $index_0 . ']. 1[' . $index_1 . ']. 2[' . $index_2 . ']. 3[' . $index_3 . ']. [' . $initialize . '].');

                //}

            }else{

                //error_log(__LINE__ . ' ddo CHANNEL. BUELLER?... BUELLER?[' . print_r(self::$system_channel_ARRAY, true) . '].');
                error_log(__LINE__ . ' ddo CHANNEL. BUELLER?... BUELLER?');
                //$this->oCRNRSTN->destruct_output = __LINE__ . ' ddo CHANNEL. BUELLER?... BUELLER?...[<br><br>...<br>BUELLER?...<br>' . print_r(self::$system_channel_ARRAY, true) . '].';

                //[Wed Nov 22 08:24:53.397613 2023] [:error] [pid 128145] [client 172.16.225.1:52386] 509 csc new link html. $module_key[define]. $system_asset_constant[PHP_ELLIPSE]. $url_override[https://www.php.net/manual/en/function.define.php]. $resource_constant[8599].

                //return $this->channel_meta(NULL, $index_0, $index_1, $index_2, $index_3);

            }

            /*
            [Wed Nov 22 07:54:20.385294 2023] [:error] [pid 128146] [client 172.16.225.1:51790] PHP Warning:  strlen() expects parameter 1 to be string, array given in /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/environment/crnrstn.decoupled_data_object.inc.php on line 3511
            [Wed Nov 22 07:54:20.385309 2023] [:error] [pid 128146] [client 172.16.225.1:51790] PHP Stack trace:
            [Wed Nov 22 07:54:20.385463 2023] [:error] [pid 128146] [client 172.16.225.1:51790] PHP   1. {main}() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/unittest/mime-type/index.php:0
            [Wed Nov 22 07:54:20.385470 2023] [:error] [pid 128146] [client 172.16.225.1:51790] PHP   2. include_once() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/unittest/mime-type/index.php:34
            [Wed Nov 22 07:54:20.385475 2023] [:error] [pid 128146] [client 172.16.225.1:51790] PHP   3. crnrstn->config_detect_environment() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn.config.inc.php:270
            [Wed Nov 22 07:54:20.385480 2023] [:error] [pid 128146] [client 172.16.225.1:51790] PHP   4. crnrstn->config_load_static_application_data() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/crnrstn/crnrstn.inc.php:19190
            [Wed Nov 22 07:54:20.385485 2023] [:error] [pid 128146] [client 172.16.225.1:51790] PHP   5. crnrstn->return_crnrstn_text_link() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/crnrstn/crnrstn.inc.php:965
            [Wed Nov 22 07:54:20.385489 2023] [:error] [pid 128146] [client 172.16.225.1:51790] PHP   6. crnrstn_content_source_controller->return_crnrstn_text_link() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/crnrstn/crnrstn.inc.php:15124
            [Wed Nov 22 07:54:20.385494 2023] [:error] [pid 128146] [client 172.16.225.1:51790] PHP   7. crnrstn->return_system_image() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/ui/crnrstn.content_source_controller.inc.php:547
            [Wed Nov 22 07:54:20.385498 2023] [:error] [pid 128146] [client 172.16.225.1:51790] PHP   8. crnrstn->asset_data_meta() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/crnrstn/crnrstn.inc.php:38571
            [Wed Nov 22 07:54:20.385516 2023] [:error] [pid 128146] [client 172.16.225.1:51790] PHP   9. crnrstn_system_asset_manager->asset_data_meta() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/crnrstn/crnrstn.inc.php:38941
            [Wed Nov 22 07:54:20.385521 2023] [:error] [pid 128146] [client 172.16.225.1:51790] PHP  10. crnrstn_system_asset_manager->asset_data_meta_system() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/assets/crnrstn.system_asset_manager.inc.php:12991
            [Wed Nov 22 07:54:20.385525 2023] [:error] [pid 128146] [client 172.16.225.1:51790] PHP  11. crnrstn->version_php() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/assets/crnrstn.system_asset_manager.inc.php:8491
            [Wed Nov 22 07:54:20.385530 2023] [:error] [pid 128146] [client 172.16.225.1:51790] PHP  12. crnrstn->get_resource() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/crnrstn/crnrstn.inc.php:14780
            [Wed Nov 22 07:54:20.385534 2023] [:error] [pid 128146] [client 172.16.225.1:51790] PHP  13. crnrstn_configuration_manager->retrieve_data_value() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/crnrstn/crnrstn.inc.php:20656
            [Wed Nov 22 07:54:20.385538 2023] [:error] [pid 128146] [client 172.16.225.1:51790] PHP  14. crnrstn_decoupled_data_object->preach() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/crnrstn/crnrstn.configuration_manager.inc.php:300
            [Wed Nov 22 07:54:20.385542 2023] [:error] [pid 128146] [client 172.16.225.1:51790] PHP  15. crnrstn->isset_ddo_resource_pointer() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/environment/crnrstn.decoupled_data_object.inc.php:4862
            [Wed Nov 22 07:54:20.385546 2023] [:error] [pid 128146] [client 172.16.225.1:51790] PHP  16. crnrstn_configuration_manager->isset_ddo_resource_pointer() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/crnrstn/crnrstn.inc.php:20690
            [Wed Nov 22 07:54:20.385551 2023] [:error] [pid 128146] [client 172.16.225.1:51790] PHP  17. crnrstn_decoupled_data_object->isset_ddo_resource_pointer() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/crnrstn/crnrstn.configuration_manager.inc.php:138
            [Wed Nov 22 07:54:20.385555 2023] [:error] [pid 128146] [client 172.16.225.1:51790] PHP  18. crnrstn_decoupled_data_object->get_channel_config() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/environment/crnrstn.decoupled_data_object.inc.php:2054
            [Wed Nov 22 07:54:20.385562 2023] [:error] [pid 128146] [client 172.16.225.1:51790] PHP  19. crnrstn_decoupled_data_object->channel_meta() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/environment/crnrstn.decoupled_data_object.inc.php:3500
            [Wed Nov 22 07:54:20.385566 2023] [:error] [pid 128146] [client 172.16.225.1:51790] PHP  20. crnrstn_response_return_serialization_map->__destruct() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/session/crnrstn.response_return_serialization_map.inc.php:0
            [Wed Nov 22 07:54:20.385590 2023] [:error] [pid 128146] [client 172.16.225.1:51790] PHP  21. crnrstn_response_return_serialization_map->rrs_map_get() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/session/crnrstn.response_return_serialization_map.inc.php:10507
            [Wed Nov 22 07:54:20.385594 2023] [:error] [pid 128146] [client 172.16.225.1:51790] PHP  22. crnrstn->get_channel_config() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/session/crnrstn.response_return_serialization_map.inc.php:1381
            [Wed Nov 22 07:54:20.385599 2023] [:error] [pid 128146] [client 172.16.225.1:51790] PHP  23. crnrstn_configuration_manager->get_channel_config() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/crnrstn/crnrstn.inc.php:21228
            [Wed Nov 22 07:54:20.385603 2023] [:error] [pid 128146] [client 172.16.225.1:51790] PHP  24. crnrstn_decoupled_data_object->get_channel_config() /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/crnrstn/crnrstn.configuration_manager.inc.php:102
            [Wed Nov 22 07:54:20.385640 2023] [:error] [pid 128146] [client 172.16.225.1:51790] 3512 ddo channel[]. die();

            */

            //$_tmp = strlen(array('0'));
            error_log(__LINE__ . ' ddo channel[' . print_r($channel, true) . '].');
            //die();

            //
            // RENAMED THIS METHOD AND PRESSED BACK INTO SERVICE ON Tuesday, October 10, 2023 @ 0651 hrs.
            //
            // UNUSED PORTION OF ORIGINAL METHOD (BELOW):
            //
            //      THIS METHOD IS USELESS AS ALL CHANNELS MUST BE IN QUEUE FIRST...THEN PLAID CAN...EVEN...FIRE.
            //      TODO :: KEEPING THIS FOR THE LOGIC UNTIL FINISHED WITH PLAID IMPLEMENTATION.
            //      Saturday, May 20, 2023 @ 0741 hrs
            //
            //      CRNRSTN :: PLAID AUTO-LOAD IS THE INNATE AND GOD-GIVEN ABILITY FOR CRNRSTN ::
            //      TO "GO TO PLAID" AT THE POINT OF CHANNEL INITIALIZATION RATHER THAN HAVING TO
            //      WAIT AND BATCH THE CHANNEL INITIALIZATION REQUESTS BECAUSE THE SEQUENCE OF
            //      ACTUAL METHOD CALLS TO INITIALIZE THE CHANNELS IS OUT OF SEQUENCE WITH WHAT
            //      CRNRSTN :: HAS BEEN TOLD IS THE DESIRED CONFIGURATION SEQUENCE IN CRNRSTN :: SETTINGS.
            //      SEE, _crnrstn.system_settings.inc.php.
            //
            //      if(!isset(self::$channel_init_burn_ARRAY[$tmp_channel_alpha]) && !(self::$channel_auto_load_broken == true)){
            //
            //        //
            //        // WE ONLY WANT TO PROCESS THE CHANNEL IF IT IS NEXT IN QUEUE.
            //        // IF THIS IS NEXT IN SEQUENCE TO BE INITIALIZED.
            //        $tmp_channel_ARRAY = str_split(self::$data_channel_init_sequence);
            //        foreach($tmp_channel_ARRAY as $ch_index => $ch_alpha){
            //
            //            if($ch_alpha == $tmp_channel_alpha && !(self::$channel_auto_load_broken == true)){
            //
            //                error_log(__LINE__ . ' crnrstn CRNRSTN :: PLAID AUTO-LOAD WOULD LIKE TO HAVE CHANNEL[' . $tmp_channel_alpha . '] NOW.');
            //                self::$channel_init_burn_ARRAY[$ch_alpha] = 1;
            //                return true;
            //
            //            }else{
            //
            //                //
            //                // IS THIS CHANNEL BURNED? BREAK CRNRSTN :: PLAID AUTO-LOAD ON
            //                // THE FIRST UNBURNED CHANNEL THAT DOES NOT GET INITIALIZED ABOVE.
            //                // THIS WILL SPOOL ANY REMAINING UNINITIALIZED CHANNELS FOR AN
            //                // INITIALIZATION CLEANUP PROCESS TO HANDLE IN BATCH PROCESS STYLE.
            //                if(!isset(self::$channel_init_burn_ARRAY[$ch_alpha])){
            //
            //                    error_log(__LINE__ . ' crnrstn CRNRSTN :: PLAID AUTO-LOAD HAS FAILURE ON CHANNEL[' . $tmp_channel_alpha . '].');
            //                    self::$channel_auto_load_broken = true;
            //
            //                }
            //
            //            }
            //
            //        }
            //
            //      }
            //
            //  error_log(__LINE__ . ' crnrstn CRNRSTN :: PLAID AUTO-LOAD HAS FAILED ON CHANNEL[' . $tmp_channel_alpha . '].');
            //

            return '';

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN NOTHING.
            return '';

        }

    }

    public function return_total_bytes_stored($data_format = 'TEXT', $channel = NULL){

        $tmp_total_bytes = 0;
        $tmp_total_bytes_ARRAY = $this->oCRNRSTN->rrs_map_get('total_bytes', $channel);

        //error_log(__LINE__  . '  env $channel[' . $channel . ']. $tmp_total_bytes_ARRAY[' . print_r($tmp_total_bytes_ARRAY, true) . '].');

        foreach($tmp_total_bytes_ARRAY as $channel => $bytes){

            $tmp_total_bytes += (int) $bytes;

        }

        return $tmp_total_bytes;

    }

    //
    // RETURNS ARRAY OF DESIRED REPORTS (STRING DATA).
    // E.G. "Memory Usage: TOTAL_SYS[2 MiB]. SCRIPT_SYS[410.5625 KiB]. XDEBUG[410.625 KiB]."
    public function channel_report($channel, $channel_report_queue, $output_data_type, $php_logo_height, $to_plaid, $is_HTML, $report_delimiter_TEXT, $report_delimiter_HTML){
        // where, $channel_report_queue = array('soap', 'G', 'CRNRSTN_CHANNEL_COOKIE');
        // where, $channel_report_queue = 'soap';

        $tmp_channel_char_ARRAY = array();
        $tmp_channel_report_ARRAY = array();

        if(!isset($php_logo_height)){

            $php_logo_height = 20;

        }

        //
        // BUILD CHANNNEL CHAR ARRAY, E.G. array('G', 'P',
        // 'H'), TO DRIVE REPORTING.
        if(!is_array($channel)){

            $tmp_channel_char_ARRAY[] = $this->oCRNRSTN->get_channel_config($channel, 'CHAR');

        }else{

            foreach($channel as $ch_input_index => $channel_data){

                $tmp_channel_char_ARRAY[] = $this->oCRNRSTN->get_channel_config($channel, 'CHAR');

            }

        }

        if(!is_array($channel_report_queue)){

            $tmp_channel_report_ARRAY[] = $channel_report_queue;

        }else{

            $tmp_channel_report_ARRAY = $channel_report_queue;

        }

        return $this->channel_report_compile($tmp_channel_char_ARRAY, $tmp_channel_report_ARRAY, $output_data_type, $php_logo_height, $to_plaid, $is_HTML, $report_delimiter_TEXT, $report_delimiter_HTML);

    }

    private function channel_report_content_build($content_key, $channel_char, $attrib_0, $attrib_1, $php_logo_height, $to_plaid, $is_HTML, $report_delimiter_TEXT, $report_delimiter_HTML, $current_bytes = 0){

        //
        // HTML OR TEXT?
        $tmp_content_type = $this->tidy_boolean($is_HTML, CRNRSTN_STRING, CRNRSTN_IS_HTML);

        /*
        # METHOD INPUT FIELD-DATA MAPPING BY CONTENT KEY:
        # Tuesday, November 21, 2023 @ 1326 hrs.
        #
        # KEY                                   INPUT PARAMETERS                DATA
        # -----------------------------------------------------------------------------------------
        # CHANNEL_REPORT_TABLE_OF_CONTENTS      KEY
                                                $channel_char,
                                                $attrib_0                       $channel_report_ARRAY
                                                NULL,
                                                $php_logo_height,
                                                $to_plaid,
                                                $is_HTML,
                                                $report_delimiter_TEXT,
                                                $report_delimiter_HTML);

        # CHANNEL_REPORT_BODY                   KEY
                                                $channel_char,
                                                $attrib_0                       $channel_report_ARRAY
                                                NULL,
                                                $php_logo_height,
                                                $to_plaid,
                                                $is_HTML,
                                                $report_delimiter_TEXT,
                                                $report_delimiter_HTML);

        # CHANNEL_REPORT_FOOTER                 KEY
                                                $channel_char,
                                                NULL,
                                                NULL,
                                                $php_logo_height,
                                                $to_plaid,
                                                $is_HTML,
                                                $report_delimiter_TEXT,
                                                $report_delimiter_HTML);

        # CHANNEL_REPORT_HEADER                 KEY
                                                $channel_char,
                                                $attrib_0                       $tmp_channel_report_header_start_time,
                                                $attrib_1                       $tmp_channel_report_header_start_run_time,
                                                $php_logo_height,
                                                $to_plaid,
                                                $is_HTML,
                                                $report_delimiter_TEXT,
                                                $report_delimiter_HTML,
                                                $current_bytes);


        self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_int'] = $this->oCRNRSTN->get_channel_config($channel_char, 'SOURCEID', CRNRSTN_INTEGER);
        self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_str'] = $this->oCRNRSTN->get_channel_config($channel_char, 'SOURCEID', CRNRSTN_STRING);
        self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_name'] = $this->oCRNRSTN->get_channel_config($channel_char, 'NAME');
        self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_description'] =$this->oCRNRSTN->get_channel_config($channel_char, 'DESCRIPTION');
        self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_encryption_int'] =$this->oCRNRSTN->get_channel_config($channel_char, 'ENCRYPTION', 'PROFILE', CRNRSTN_INTEGER);
        self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_encryption_str'] =$this->oCRNRSTN->get_channel_config($channel_char, 'ENCRYPTION', 'PROFILE', CRNRSTN_STRING);
        self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_authorization_int'] =$this->oCRNRSTN->get_channel_config($channel_char, 'AUTHORIZATION', 'PROFILE', 'PRIMARY',CRNRSTN_INTEGER);
        self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_authorization_str'] =$this->oCRNRSTN->get_channel_config($channel_char, 'AUTHORIZATION', 'PROFILE', 'PRIMARY',CRNRSTN_STRING);
        self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['total_bytes_stored'] = $this->oCRNRSTN->channel_bytes_stored($channel_char);
        self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['max_bytes'] = self::$oCRNRSTN_RRS_MAP->rrs_map_get(self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_name'] . '_max_map_cache_bytes', self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_authorization_int']);
        self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['ttl'] = self::$oCRNRSTN_RRS_MAP->rrs_map_get(self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_name'] . '_map_cache_ttl', self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_authorization_int']);
        self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_is_active'] = $this->oCRNRSTN->tidy_boolean(self::$oCRNRSTN_RRS_MAP->rrs_map_get(self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_name'] . '_cache_is_active', self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_encryption_int']), CRNRSTN_ICY_BITMASK);
        self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_is_active_str'] = $this->oCRNRSTN->tidy_boolean(self::$oCRNRSTN_RRS_MAP->rrs_map_get(self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_name'] . '_cache_is_active', self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_encryption_int']), CRNRSTN_STRING);
        self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['oersl_enabled'] = $this->tidy_boolean(self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_encryption_int'], CRNRSTN_ICY_BITMASK, CRNRSTN_ICY_BITMASK);

        //self::$channel_reporting_meta_ARRAY['CHANNEL_DATA']

        */

        switch($content_key){
            case 'CHANNEL_REPORT_HEADER':

                // $tmp_channel_name = $this->oCRNRSTN->get_channel_config($channel, 'NAME');
                // $tmp_channel_int = $this->oCRNRSTN->get_channel_config($channel, 'SOURCEID', CRNRSTN_INTEGER);
                // $tmp_channel_str = $this->oCRNRSTN->get_channel_config($channel, 'SOURCEID', CRNRSTN_STRING);
                // $tmp_channel_authorization_int = $this->oCRNRSTN->get_channel_config($channel, 'AUTHORIZATION', 'PROFILE', 'PRIMARY', CRNRSTN_INTEGER);

                //
                // THE POSSIBILITIES:
                //      $tmp_content_type = 'HTML'
                //      $tmp_content_type = 'TEXT'
                //
                // SEE, $oCRNRSTN->tidy_boolean($is_HTML, CRNRSTN_STRING, CRNRSTN_IS_HTML);
                switch($tmp_content_type){
                    case 'TEXT':
                        //TEXT OUTPUT FORMAT.

                        $tmp_str = '#
# [' . $attrib_0 . '] [rtime ' . $attrib_1 . ']
#
# CRNRSTN :: v' . $this->version_crnrstn() . '
#
# (c) 2012-' . date('Y') . ' Jonathan \'J5\' Harris :: eVifweb development.
# All rights reserved.
#
# LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
# # C # R # N # R # S # T # N # : : # # # #
#
# REPORTING SERVER ::
# '.$_SERVER['SERVER_ADDR'].' (' . $_SERVER['SERVER_NAME']  . ')
# CRNRSTN :: SERVER ENVIRONMENT KEY: ' . self::$env_key . '
# CRNRSTN :: SERVER HASH: ' . self::$env_key_hash . '
# # C # R # N # R # S # T # N # : : # # # #
#
# CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (DDO)
# SERVICES LAYER PERFORMANCE REPORT
#
#
# REPORT DETAILS ::
#   CHANNEL NAME: ' . strtoupper($this->oCRNRSTN->get_channel_config($channel_char, 'NAME')) . '
#   DESCRIPTION: ' . $this->oCRNRSTN->get_channel_config($channel_char, 'DESCRIPTION') . '
#   SYSTEM INTEGER: ' . $tmp_channel_str . ' [' . self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_int'] . ']
#   MEMORY LIMIT: ' . self::$oCRNRSTN_RRS_MAP->rrs_map_get($tmp_channel_name . '_max_map_cache_bytes', $tmp_channel_authorization_int) . '
#   MEMORY USAGE: ' . $this->oCRNRSTN->channel_bytes_stored($tmp_channel) . '
#
# REPORT STATISTICS ::
#   TOTAL REPORT BYTES: ';

                        //
                        // CALCULATE REPORT CONTENT TOTAL BYTES.
                        $tmp_time_str_bytes = strlen('#   RUNTIME: ' . $this->oCRNRSTN->wall_time() . ' seconds.');
                        $tmp_header_char_len = strlen($tmp_str);
                        $tmp_total_report_size = (int) $tmp_header_char_len + (int) $current_bytes + (int) $tmp_time_str_bytes;
                        $tmp_total_report_bytes = $this->format_bytes($tmp_total_report_size, 4);

                        $tmp_str .= $tmp_total_report_bytes . '.
#   REPORT RUNTIME: ';

                    break;
                    default:
                        //case 'HTML':
                        //HTML OUTPUT FORMAT.

                        $tmp_str = '# [' . $attrib_0 . '] [rtime ' . $attrib_1 . ']
#
# C<span style="color:#F00;">R</span>NRSTN :: v' . $this->version_crnrstn() . '
#
# &copy; 2012-' . date('Y') . ' Jonathan \'J5\' Harris :: e<span style="color:#F00;">V</span>ifweb development.
# All rights reserved.
#
# LICENSE :: MIT | <a href="http://crnrstn.evifweb.com/licensing/" target="_blank">http://crnrstn.evifweb.com/licensing/</a>
#
# # C # R # N # R # S # T # N # : : # # # #
#&nbsp;' . self::$cache_apache_logo_html . '&nbsp;&nbsp;' . self::$cache_mysql_logo_html . '&nbsp;&nbsp;' . self::$cache_php_logo_html . '
#
# REPORTING SERVER ::
# ' . $_SERVER['SERVER_ADDR'] . ' (' . $_SERVER['SERVER_NAME']  . ')
# C<span style="color:#F00;">R</span>NRSTN :: SERVER ENVIRONMENT KEY: ' . self::$env_key . '
# C<span style="color:#F00;">R</span>NRSTN :: SERVER HASH: ' . self::$env_key_hash . '
#
# # C # R # N # R # S # T # N # : : # # # #
#&nbsp;' . self::$cache_crnrstn_logo_html . '
#
# C<span style="color:#F00;">R</span>NRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (DDO)
# SERVICES LAYER PERFORMANCE REPORT
#
#
# REPORT DETAILS ::
#   CHANNEL NAME: ' . strtoupper($this->oCRNRSTN->get_channel_config($channel_char, 'NAME')) . '
#   DESCRIPTION: ' . $this->oCRNRSTN->get_channel_config($channel_char, 'DESCRIPTION') . '
#   SYSTEM INTEGER: ' . $tmp_channel_str . ' [' . self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_int'] . ']
#   MEMORY LIMIT: ' . self::$oCRNRSTN_RRS_MAP->rrs_map_get($tmp_channel_name . '_max_map_cache_bytes', $tmp_channel_authorization_int) . '
#   MEMORY USAGE: ' . $this->oCRNRSTN->channel_bytes_stored($tmp_channel) . '
#
# REPORT STATISTICS ::
#   TOTAL REPORT BYTES: ';

                        //
                        // CALCULATE REPORT CONTENT TOTAL BYTES.
                        $tmp_time_str_bytes = strlen('#   RUNTIME: ' . $this->oCRNRSTN->wall_time() . ' seconds.');
                        $tmp_header_char_len = strlen($tmp_str);
                        $tmp_total_report_size = (int) $tmp_header_char_len + (int) $current_bytes + (int) $tmp_time_str_bytes;
                        $tmp_total_report_bytes = $this->format_bytes($tmp_total_report_size, 4);

                        $tmp_str .= $tmp_total_report_bytes . '.
#   REPORT RUNTIME: ';

                    break;

                }

            break;
            case 'CHANNEL_REPORT_TABLE_OF_CONTENTS':

                //
                // THE POSSIBILITIES:
                //      $tmp_content_type = 'HTML'
                //      $tmp_content_type = 'TEXT'
                //
                // SEE, $oCRNRSTN->tidy_boolean($is_HTML, CRNRSTN_STRING, CRNRSTN_IS_HTML);
                switch($tmp_content_type){
                    case 'TEXT':
                        //TEXT OUTPUT FORMAT.

                        $tmp_str = '
# TABLE OF CONTENTS ::';

                    break;
                    default:
                        //case 'HTML':
                        //HTML OUTPUT FORMAT.

                        $tmp_str = '
# TABLE OF CONTENTS ::';

                    break;

                }

                //
                // COMPILE TABLE OF CONTENTS.
                foreach($attrib_0 as $rpt_index => $rpt_int){

                    //
                    // CRNRSTN :: MULTI-CHANNEL REPORT TYPE
                    // PROFILE BY REPORT ID.
                    switch($rpt_int){
                        case 0:
                            //0   CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (DDO) SERVICES LAYER CHANNEL REPORT.
                            //
                            // THE POSSIBILITIES:
                            //      $tmp_content_type = 'HTML'
                            //      $tmp_content_type = 'TEXT'
                            //
                            // SEE, $oCRNRSTN->tidy_boolean($is_HTML, CRNRSTN_STRING, CRNRSTN_IS_HTML);
                            switch($tmp_content_type){
                                case 'TEXT':
                                    //TEXT OUTPUT FORMAT.
                                    self::$channel_reporting_meta_ARRAY[$rpt_index]['TITLE'] = '
#
#   REPORT #' . $rpt_index . ' - CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (DDO) SERVICES LAYER CHANNEL REPORT.';

                                    $tmp_str .= self::$channel_reporting_meta_ARRAY[$rpt_index]['TITLE'];

                                break;
                                default:
                                    //case 'HTML':
                                    //HTML OUTPUT FORMAT.

                                    self::$channel_reporting_meta_ARRAY[$rpt_index]['TITLE'] = '
#
#   REPORT #' . $rpt_index . ' - C<span style="color:#F00;">R</span>NRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (DDO) SERVICES LAYER CHANNEL REPORT.';

                                    $tmp_str .= self::$channel_reporting_meta_ARRAY[$rpt_index]['TITLE'];

                                break;

                            }

                        break;
                        case 1:
                            //1   CRNRSTN :: CHANNEL ENCRYPTION (OpenSSL v1.1.1) PROFILE.
                            //
                            // THE POSSIBILITIES:
                            //      $tmp_content_type = 'HTML'
                            //      $tmp_content_type = 'TEXT'
                            //
                            // SEE, $oCRNRSTN->tidy_boolean($is_HTML, CRNRSTN_STRING, CRNRSTN_IS_HTML);
                            switch($tmp_content_type){
                                case 'TEXT':
                                    //TEXT OUTPUT FORMAT.

                                    self::$channel_reporting_meta_ARRAY[$rpt_index]['TITLE'] = '
#
#   REPORT #' . $rpt_index . ' - CRNRSTN :: CHANNEL ENCRYPTION (OpenSSL v' . $this->oCRNRSTN->version_openssl() . ') PROFILE.';

                                    $tmp_str .= self::$channel_reporting_meta_ARRAY[$rpt_index]['TITLE'];

                                break;
                                default:
                                    //case 'HTML':
                                    //HTML OUTPUT FORMAT.

                                    self::$channel_reporting_meta_ARRAY[$rpt_index]['TITLE'] = '
#
#   REPORT #' . $rpt_index . ' - C<span style="color:#F00;">R</span>NRSTN :: CHANNEL ENCRYPTION (OpenSSL v' . $this->oCRNRSTN->version_openssl() . ') PROFILE.';

                                    $tmp_str .= self::$channel_reporting_meta_ARRAY[$rpt_index]['TITLE'];

                                break;

                            }

                        break;
                        case 2:
                            //2   CRNRSTN :: ' . strtoupper(strval($tmp_channel_name)) . '[' . $tmp_channel_char . '] CHANNEL PERFORMANCE REPORT.
                            //
                            // THE POSSIBILITIES:
                            //      $tmp_content_type = 'HTML'
                            //      $tmp_content_type = 'TEXT'
                            //
                            // SEE, $oCRNRSTN->tidy_boolean($is_HTML, CRNRSTN_STRING, CRNRSTN_IS_HTML);
                            switch($tmp_content_type){
                                case 'TEXT':
                                    //TEXT OUTPUT FORMAT.

                                    self::$channel_reporting_meta_ARRAY['TITLE'][$rpt_index] = '
#
#   REPORT #' . $rpt_index . ' - CRNRSTN :: ' . strtoupper($this->oCRNRSTN->get_channel_config($channel_char, 'NAME')) . '[' . $channel_char . '] CHANNEL PERFORMANCE REPORT.';

                                    $tmp_str .= self::$channel_reporting_meta_ARRAY['TITLE'][$rpt_index];

                                break;
                                default:
                                    //case 'HTML':
                                    //HTML OUTPUT FORMAT.

                                    self::$channel_reporting_meta_ARRAY['TITLE'][$rpt_index] = '
#
#   REPORT #' . $rpt_index . ' - C<span style="color:#F00;">R</span>NRSTN :: ' . strtoupper($this->oCRNRSTN->get_channel_config($channel_char, 'NAME')) . '[' . $channel_char . '] CHANNEL PERFORMANCE REPORT.';

                                    $tmp_str .= self::$channel_reporting_meta_ARRAY['TITLE'][$rpt_index];

                                break;

                            }

                        break;
                        case 3:
                            //3   CRNRSTN :: ENCRYPTION (OpenSSL v1.1.1) ROTATION SERVICES LAYER (OERSL) INITIALIZATION.
                            //
                            // THE POSSIBILITIES:
                            //      $tmp_content_type = 'HTML'
                            //      $tmp_content_type = 'TEXT'
                            //
                            // SEE, $oCRNRSTN->tidy_boolean($is_HTML, CRNRSTN_STRING, CRNRSTN_IS_HTML);
                            switch($tmp_content_type){
                                case 'TEXT':
                                    //TEXT OUTPUT FORMAT.

                                    self::$channel_reporting_meta_ARRAY['TITLE'][$rpt_index] = '
#
#   REPORT #' . $rpt_index . ' - CRNRSTN :: ENCRYPTION (OpenSSL v' . $this->oCRNRSTN->version_openssl() . ') ROTATION SERVICES LAYER (OERSL) INITIALIZATION.';

                                    $tmp_str .= self::$channel_reporting_meta_ARRAY['TITLE'][$rpt_index];

                                break;
                                default:
                                    //case 'HTML':
                                    //HTML OUTPUT FORMAT.

                                    self::$channel_reporting_meta_ARRAY['TITLE'][$rpt_index] = '
#
#   REPORT #' . $rpt_index . ' - C<span style="color:#F00;">R</span>NRSTN :: ENCRYPTION (OpenSSL v' . $this->oCRNRSTN->version_openssl() . ') ROTATION SERVICES LAYER (OERSL) INITIALIZATION.';

                                    $tmp_str .= self::$channel_reporting_meta_ARRAY['TITLE'][$rpt_index];

                                break;

                            }

                        break;
                        case 4:
                            //4   CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                            //
                            // THE POSSIBILITIES:
                            //      $tmp_content_type = 'HTML'
                            //      $tmp_content_type = 'TEXT'
                            //
                            // SEE, $oCRNRSTN->tidy_boolean($is_HTML, CRNRSTN_STRING, CRNRSTN_IS_HTML);
                            switch($tmp_content_type){
                                case 'TEXT':
                                    //TEXT OUTPUT FORMAT.

                                    self::$channel_reporting_meta_ARRAY['TITLE'][$rpt_index] = '
#
#   REPORT #' . $rpt_index . ' - CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.';

                                    $tmp_str .= self::$channel_reporting_meta_ARRAY['TITLE'][$rpt_index];

                                break;
                                default:
                                    //case 'HTML':
                                    //HTML OUTPUT FORMAT.

                                    self::$channel_reporting_meta_ARRAY['TITLE'][$rpt_index] = '
#
#   REPORT #' . $rpt_index . ' - C<span style="color:#F00;">R</span>NRSTN :: ICY_DIGITALITCC-BITMASK INTEGER STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.';

                                    $tmp_str .= self::$channel_reporting_meta_ARRAY['TITLE'][$rpt_index];

                                break;

                            }

                        break;
                        case 5:
                            //5   CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (DDO) PROFILE CONFIGURATION.
                            //
                            // THE POSSIBILITIES:
                            //      $tmp_content_type = 'HTML'
                            //      $tmp_content_type = 'TEXT'
                            //
                            // SEE, $oCRNRSTN->tidy_boolean($is_HTML, CRNRSTN_STRING, CRNRSTN_IS_HTML);
                            switch($tmp_content_type){
                                case 'TEXT':
                                    //TEXT OUTPUT FORMAT.

                                    self::$channel_reporting_meta_ARRAY['TITLE'][$rpt_index] = '
#
#   REPORT #' . $rpt_index . ' - CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (DDO) PROFILE CONFIGURATION.';

                                    $tmp_str .= self::$channel_reporting_meta_ARRAY['TITLE'][$rpt_index];

                                break;
                                default:
                                    //case 'HTML':
                                    //HTML OUTPUT FORMAT.

                                    self::$channel_reporting_meta_ARRAY['TITLE'][$rpt_index] = '
#
#   REPORT #' . $rpt_index . ' - C<span style="color:#F00;">R</span>NRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (DDO) PROFILE CONFIGURATION.';

                                    $tmp_str .= self::$channel_reporting_meta_ARRAY['TITLE'][$rpt_index];

                                break;

                            }

                        break;

                    }

                }

            break;
            case 'CHANNEL_REPORT_BODY':

                //
                // CRNRSTN :: MULTI-CHANNEL (DDO) ASCII ART
                // OUTPUT BURN OF CHANNEL DESIGNATION.
                $tmp_str = $this->oCRNRSTN->return_ascii_art('DDO_MULTI_CHANNEL', $channel_char, $is_HTML);

                //
                // COMPILE BODY CONTENT OF REPORT.
                foreach($attrib_0 as $rpt_index => $rpt_int){

                    //
                    // BUILD REPORT SUB-HEADER CONTENT SECTION DIVIDER.
                    //
                    // THE POSSIBILITIES:
                    //      $tmp_content_type = 'HTML'
                    //      $tmp_content_type = 'TEXT'
                    //
                    // SEE, $oCRNRSTN->tidy_boolean($is_HTML, CRNRSTN_STRING, CRNRSTN_IS_HTML);
                    switch($tmp_content_type){
                        case 'TEXT':
                            //TEXT OUTPUT FORMAT.

                            $tmp_str .= '#
#
# REPORT :: ' . self::$channel_reporting_meta_ARRAY['TITLE'][$rpt_index] . '
#
# # C # R # N # R # S # T # N # : : # # # #
#
';

                        break;
                        default:
                            //case 'HTML':
                            //HTML OUTPUT FORMAT.

                            $tmp_str = '#
#
# REPORT :: ' . self::$channel_reporting_meta_ARRAY['TITLE'][$rpt_index] . '
#
# # C # R # N # R # S # T # N # : : # # # #
#&nbsp;' . self::$cache_crnrstn_logo_html . '
#
';

                        break;

                    }

                    //
                    // CRNRSTN :: MULTI-CHANNEL REPORT TYPE
                    // PROFILE BY REPORT ID.
                    switch($rpt_int){
                        case 0:
                            //0   CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (DDO) CHANNEL REPORT.
                            //
                            // THE POSSIBILITIES:
                            //      $tmp_content_type = 'HTML'
                            //      $tmp_content_type = 'TEXT'
                            //
                            // SEE, $oCRNRSTN->tidy_boolean($is_HTML, CRNRSTN_STRING, CRNRSTN_IS_HTML);
                            switch($tmp_content_type){
                                case 'TEXT':
                                    //TEXT OUTPUT FORMAT.

                                    $tmp_str .= '
# CHANNEL STATE: ' . $tmp_channel_is_active . '
# ENCRYPTION (OpenSSL v'. $tmp_version_openssl . ') STATE: ' . $tmp_oersl_enabled . '
# CHANNEL NAME: ' . $tmp_channel_name . '
# DESCRIPTION: ' . $tmp_channel_description . '
# CHANNEL PROFILE STRING[INT]: ' . $tmp_channel_str . '[' . strval(self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_int'])  .  ']
# OpenSSL v' . $tmp_openssl_version . ' ENCRYPTION PROFILE STRING[INT]: ' . $tmp_channel_authorization_str . '[' . strval($tmp_channel_authorization_int)  .  ']';

                                break;
                                default:
                                    //case 'HTML':
                                    //HTML OUTPUT FORMAT.

                                    $tmp_str .= '
# CHANNEL STATE: ' . $tmp_channel_is_active . '
# ENCRYPTION (OpenSSL v'. $tmp_version_openssl . ') STATE: ' . $tmp_oersl_enabled . '
# CHANNEL NAME: ' . $tmp_channel_name . '
# DESCRIPTION: ' . $tmp_channel_description . '
# CHANNEL PROFILE STRING[INT]: ' . $tmp_channel_str . '[' . strval(self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_int'])  .  ']
# OpenSSL v' . $tmp_openssl_version . ' ENCRYPTION PROFILE STRING[INT]: ' . $tmp_channel_authorization_str . '[' . strval($tmp_channel_authorization_int)  .  ']';

                                break;

                            }

                        break;
                        case 1:
                            //1   CRNRSTN :: CHANNEL ENCRYPTION (OpenSSL v1.1.1) PROFILE.
                            //
                            // THE POSSIBILITIES:
                            //      $tmp_content_type = 'HTML'
                            //      $tmp_content_type = 'TEXT'
                            //
                            // SEE, $oCRNRSTN->tidy_boolean($is_HTML, CRNRSTN_STRING, CRNRSTN_IS_HTML);
                            switch($tmp_content_type){
                                case 'TEXT':
                                    //TEXT OUTPUT FORMAT.

                                    $tmp_str .= '
# STRING[INT]: ' . $tmp_channel_encryption_str . '[' . strval($tmp_channel_encryption_int)  .  ']
';

                                break;
                                default:
                                    //case 'HTML':
                                    //HTML OUTPUT FORMAT.

                                    $tmp_str .= '
# STRING[INT]: ' . $tmp_channel_encryption_str . '[' . strval($tmp_channel_encryption_int)  .  ']';

                                break;

                            }

                        break;
                        case 2:
                            //2   CRNRSTN :: ' . strtoupper(strval($tmp_channel_name)) . '[' . $tmp_channel_char . '] CHANNEL PERFORMANCE REPORT.
                            //
                            // THE POSSIBILITIES:
                            //      $tmp_content_type = 'HTML'
                            //      $tmp_content_type = 'TEXT'
                            //
                            // SEE, $oCRNRSTN->tidy_boolean($is_HTML, CRNRSTN_STRING, CRNRSTN_IS_HTML);
                            switch($tmp_content_type){
                                case 'TEXT':
                                    //TEXT OUTPUT FORMAT.

                                    $tmp_str .= '
# CACHE TTL: ' . $tmp_ttl . '
# MAXIMUM BYTES: ' . $tmp_max_bytes . '
# CURRENT BYTES: ' . $this->channel_bytes_stored(self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_int']);

                                break;
                                default:
                                    //case 'HTML':
                                    //HTML OUTPUT FORMAT.

                                    $tmp_str .= '
# CACHE TTL: ' . $tmp_ttl . '
# MAXIMUM BYTES: ' . $tmp_max_bytes . '
# CURRENT BYTES: ' . $this->channel_bytes_stored(self::$channel_reporting_meta_ARRAY[$channel_char]['CHANNEL_DATA']['channel_int']);

                                break;

                            }

                        break;
                        case 3:
                            //3   CRNRSTN :: ENCRYPTION (OpenSSL v1.1.1) ROTATION SERVICES LAYER (OERSL) INITIALIZATION.
                            //
                            // THE POSSIBILITIES:
                            //      $tmp_content_type = 'HTML'
                            //      $tmp_content_type = 'TEXT'
                            //
                            // SEE, $oCRNRSTN->tidy_boolean($is_HTML, CRNRSTN_STRING, CRNRSTN_IS_HTML);
                            switch($tmp_content_type){
                                case 'TEXT':
                                    //TEXT OUTPUT FORMAT.

                                    $tmp_str .= '
# CRNRSTN :: OERSL IS ACTIVE: ' . $tmp_is_active;

                                break;
                                default:
                                    //case 'HTML':
                                    //HTML OUTPUT FORMAT.

                                    $tmp_str .= '
# CRNRSTN :: OERSL IS ACTIVE: ' . $tmp_is_active;

                                break;

                            }

                        break;
                        case 4:
                            //4   CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                            //
                            // THE POSSIBILITIES:
                            //      $tmp_content_type = 'HTML'
                            //      $tmp_content_type = 'TEXT'
                            //
                            // SEE, $oCRNRSTN->tidy_boolean($is_HTML, CRNRSTN_STRING, CRNRSTN_IS_HTML);
                            switch($tmp_content_type){
                                case 'TEXT':
                                    //TEXT OUTPUT FORMAT.

                                    $tmp_str .= '
# ENCRYPTION IS ENABLED: ' . $this->oCRNRSTN->tidy_boolean($tmp_channel_encryption_int, CRNRSTN_SOAP_DATA_TUNNEL, CRNRSTN_ICY_BITMASK) . '
#     BIT STATE: ' . $this->oCRNRSTN->tidy_boolean($tmp_channel_encryption_int, CRNRSTN_ICY_BITMASK, CRNRSTN_ICY_BITMASK) . '
# BOOLEAN STATE: ' . $this->oCRNRSTN->tidy_boolean($tmp_channel_encryption_int, CRNRSTN_INTEGER, CRNRSTN_ICY_BITMASK);

                                break;
                                default:
                                    //case 'HTML':
                                    //HTML OUTPUT FORMAT.

                                    $tmp_str .= '
# ENCRYPTION IS ENABLED: ' . $this->oCRNRSTN->tidy_boolean($tmp_channel_encryption_int, CRNRSTN_SOAP_DATA_TUNNEL, CRNRSTN_ICY_BITMASK) . '
#     BIT STATE: ' . $this->oCRNRSTN->tidy_boolean($tmp_channel_encryption_int, CRNRSTN_ICY_BITMASK, CRNRSTN_ICY_BITMASK) . '
# BOOLEAN STATE: ' . $this->oCRNRSTN->tidy_boolean($tmp_channel_encryption_int, CRNRSTN_INTEGER, CRNRSTN_ICY_BITMASK);

                                break;

                            }

                        break;
                        case 5:
                            //5   CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (DDO) PROFILE CONFIGURATION.
                            //
                            // THE POSSIBILITIES:
                            //      $tmp_content_type = 'HTML'
                            //      $tmp_content_type = 'TEXT'
                            //
                            // SEE, $oCRNRSTN->tidy_boolean($is_HTML, CRNRSTN_STRING, CRNRSTN_IS_HTML);
                            switch($tmp_content_type){
                                case 'TEXT':
                                    //TEXT OUTPUT FORMAT.

                                    $tmp_str .= '
# public function config_init_channel(
#       $env_key = ' . self::$env_key . ',
#       $channel = ' . $tmp_channel_str . ',
#       $max_bytes = ' . $tmp_max_bytes . ',
#       $ttl = ' . $tmp_ttl . ',
#       $is_active = ' . $tmp_is_active . ',
#       $oersl_enabled = ' . $this->oCRNRSTN->tidy_boolean($this->is_bit_set($tmp_channel_encryption_int), CRNRSTN_STRING) . '
#
# )
#
# SEE, _crnrstn.config.inc.php.';

                                break;
                                default:
                                    //case 'HTML':
                                    //HTML OUTPUT FORMAT.

                                    $tmp_str .= '
# public function config_init_channel(
#       $env_key = ' . self::$env_key . ',
#       $channel = ' . $tmp_channel_str . ',
#       $max_bytes = ' . $tmp_max_bytes . ',
#       $ttl = ' . $tmp_ttl . ',
#       $is_active = ' . $tmp_is_active . ',
#       $oersl_enabled = ' . $this->oCRNRSTN->tidy_boolean($this->is_bit_set($tmp_channel_encryption_int), CRNRSTN_STRING) . '
#
# )
#
# SEE, _crnrstn.config.inc.php.';

                                break;

                            }

                        break;

                    }

                }

            break;
            case 'CHANNEL_REPORT_FOOTER':

                    //
                    // BUILD REPORT FOOTER CONTENT SECTION.
                    //
                    // THE POSSIBILITIES:
                    //      $tmp_content_type = 'HTML'
                    //      $tmp_content_type = 'TEXT'
                    //
                    // SEE, $oCRNRSTN->tidy_boolean($is_HTML, CRNRSTN_STRING, CRNRSTN_IS_HTML);
                    switch($tmp_content_type){
                        case 'TEXT':
                            //TEXT OUTPUT FORMAT.

                            $tmp_str = '# # # C # R # N # R # S # T # N # : : # # # #
#
# [' . $this->oCRNRSTN->return_micro_time() . '] [rtime ' . $this->oCRNRSTN->wall_time() . ']
#
# (c) 2012-' . date('Y') . ' Jonathan \'J5\' Harris :: eVifweb development.
# All rights reserved.
#
# LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/';

                        break;
                        default:
                            //case 'HTML':
                            //HTML OUTPUT FORMAT.

                            $tmp_str = '# # # C # R # N # R # S # T # N # : : # # # #
##&nbsp;' . self::$cache_crnrstn_logo_html . '
#
# [' . $this->oCRNRSTN->return_micro_time() . '] [rtime ' . $this->oCRNRSTN->wall_time() . ']
#
# &copy; 2012-' . date('Y') . ' Jonathan \'J5\' Harris :: e<span style="color:#F00;">V</span>ifweb development.
# All rights reserved.
#
# LICENSE :: MIT | <a href="http://crnrstn.evifweb.com/licensing/" target="_blank">http://crnrstn.evifweb.com/licensing/</a>';

                        break;

                    }

            break;

        }

        //
        // RETURN REPORT DATA.
        return $tmp_str;

    }

    private function channel_report_compile($channel_constant_ARRAY, $channel_report_ARRAY, $return_data_type, $php_logo_height, $to_plaid, $is_HTML, $report_delimiter_TEXT, $report_delimiter_HTML){

        $tmp_data_out_ARRAY = array();
        $tmp_content_type = $this->oCRNRSTN->tidy_boolean($is_HTML, CRNRSTN_STRING, CRNRSTN_IS_HTML);

        //
        // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA
        // OBJECT (DOO) SERVICES LAYER SERVER
        // PERFORMANCE REPORT PROFILE.
        $tmp_mem_report_ARRAY = $this->get_resource('mem_rpt_multi_channel_report_footer', 0, 'CRNRSTN::RESOURCE::REPORTING');

        $tmp_openssl_version = $this->oCRNRSTN->version_openssl();

        //
        // CAPTURE SERVER PERFORMANCE SNAPSHOTS.
        // NOTE: memory_performance() stores RAW report data () for DELTA comparisons. This has a 'history' report mode.
        // NOTE: memory_performance() supports custom DELTA performance reports using a previous lookup_key as the historical snapshot "delta_key."
        $tmp_mem_start_ARRAY = $this->memory_performance('CRNRSTN_MEMORY_REPORT', 'start');
        $tmp_mem_delta_zero_output_ARRAY = $this->memory_performance('CRNRSTN_MEMORY_REPORT', 'delta');
        $tmp_mem_delta_construct_output_ARRAY = $this->memory_performance('CRNRSTN_MEMORY_REPORT', 'delta', 'CRNRSTN_CONSTRUCTOR');
        $tmp_mem_curr_output_ARRAY = $this->memory_performance('CRNRSTN_MEMORY_REPORT');
        $tmp_cnt = count($channel_report_ARRAY);

        //
        // THE POSSIBILITIES:
        //      $tmp_content_type = 'HTML'
        //      $tmp_content_type = 'TEXT'
        //
        // SEE, $oCRNRSTN->tidy_boolean($is_HTML, CRNRSTN_STRING, CRNRSTN_IS_HTML);
        switch($tmp_content_type){
            case 'TEXT':
                //TEXT OUTPUT FORMAT.

                self::$cache_php_logo_html = '';
                self::$cache_crnrstn_logo_html = '';
                self::$cache_apache_logo_html = '';
                self::$cache_mysql_logo_html = '';

            break;
            default:
                //case 'HTML':
                //HTML OUTPUT FORMAT.

                /*
                CRNRSTN_LOGO
                CRNRSTN_R_MD
                R_STONE_PILLAR
                APACHE_FEATHER
                APACHE_POWER_VERSION <-- ALL IMAGE ROTATION IS BROKEN.

                */

                self::$cache_php_logo_html = $this->return_system_image('PHP_ELLIPSE', '', $php_logo_height, NULL, NULL, NULL, NULL, CRNRSTN_HTML);
                self::$cache_crnrstn_logo_html = $this->return_system_image('CRNRSTN_LOGO', '', $php_logo_height, NULL, NULL, NULL, NULL, CRNRSTN_HTML);
                self::$cache_apache_logo_html = $this->return_system_image('APACHE_POWER', '', $php_logo_height, NULL, NULL, NULL, NULL, CRNRSTN_HTML);
                self::$cache_mysql_logo_html = $this->return_system_image('MYSQL_DOLPHIN', '', $php_logo_height, NULL, NULL, NULL, NULL, CRNRSTN_HTML);

            break;

        }

        foreach($channel_constant_ARRAY as $index_channel => $channel_char){

            $tmp_report_part_header_str = $tmp_report_part_body_str = $tmp_report_part_footer_str = '';
            $tmp_channel_report_header_start_time = $this->oCRNRSTN->return_micro_time();
            $tmp_channel_report_header_start_run_time = $this->oCRNRSTN->wall_time();
            $tmp_space = '';
            $tmp_channel_meta_ARRAY = array();

            //
            // CHANNEL META INITIALIZATION.
            $tmp_channel_meta_ARRAY['channel_int'] = $this->oCRNRSTN->get_channel_config($channel_char, 'SOURCEID', CRNRSTN_INTEGER);
            $tmp_channel_meta_ARRAY['channel_str'] = $this->oCRNRSTN->get_channel_config($channel_char, 'SOURCEID', CRNRSTN_STRING);
            $tmp_channel_meta_ARRAY['channel_name'] = $this->oCRNRSTN->get_channel_config($channel_char, 'NAME');
            $tmp_channel_meta_ARRAY['channel_description'] =$this->oCRNRSTN->get_channel_config($channel_char, 'DESCRIPTION');
            $tmp_channel_meta_ARRAY['channel_encryption_int'] =$this->oCRNRSTN->get_channel_config($channel_char, 'ENCRYPTION', 'PROFILE', CRNRSTN_INTEGER);
            $tmp_channel_meta_ARRAY['channel_encryption_str'] =$this->oCRNRSTN->get_channel_config($channel_char, 'ENCRYPTION', 'PROFILE', CRNRSTN_STRING);
            $tmp_channel_meta_ARRAY['channel_authorization_int'] =$this->oCRNRSTN->get_channel_config($channel_char, 'AUTHORIZATION', 'PROFILE', 'PRIMARY',CRNRSTN_INTEGER);
            $tmp_channel_meta_ARRAY['channel_authorization_str'] =$this->oCRNRSTN->get_channel_config($channel_char, 'AUTHORIZATION', 'PROFILE', 'PRIMARY',CRNRSTN_STRING);
            $tmp_channel_meta_ARRAY['total_bytes_stored'] = $this->oCRNRSTN->channel_bytes_stored($channel_char);
            $tmp_channel_meta_ARRAY['max_bytes'] = self::$oCRNRSTN_RRS_MAP->rrs_map_get($tmp_channel_meta_ARRAY['channel_name'] . '_max_map_cache_bytes', $tmp_channel_meta_ARRAY['channel_authorization_int']);
            $tmp_channel_meta_ARRAY['ttl'] = self::$oCRNRSTN_RRS_MAP->rrs_map_get($tmp_channel_meta_ARRAY['channel_name'] . '_map_cache_ttl', $tmp_channel_meta_ARRAY['channel_authorization_int']);
            $tmp_channel_meta_ARRAY['channel_is_active'] = $this->oCRNRSTN->tidy_boolean(self::$oCRNRSTN_RRS_MAP->rrs_map_get($tmp_channel_meta_ARRAY['channel_name'] . '_cache_is_active', $tmp_channel_meta_ARRAY['channel_encryption_int']), CRNRSTN_ICY_BITMASK);
            $tmp_channel_meta_ARRAY['channel_is_active_str'] = $this->oCRNRSTN->tidy_boolean(self::$oCRNRSTN_RRS_MAP->rrs_map_get($tmp_channel_meta_ARRAY['channel_name'] . '_cache_is_active', $tmp_channel_meta_ARRAY['channel_encryption_int']), CRNRSTN_STRING);

            /*
            A MATRIX OF ALL OF THE *CURRENT OUTPUT
            POSSIBILITIES FOR BOOLEAN-ISH-TYPE
            CRNRSTN :: SYSTEM DATA ARCHITECTURES
            AND NATIVE PHP RUNTIME MEMORY DATA
            STRUCTURES/TYPES OF SIMILAR ILK.
            -----
            CRNRSTN_STRING              ['true', 'false']
            CRNRSTN_SOAP_DATA_TUNNEL    ['TRUE', 'FALSE']
            CRNRSTN_INTEGER             [0, 1]
            CRNRSTN_BOOLEAN             [(bool) true, (bool) false]
            CRNRSTN_ICY_BITMASK         ['ON', 'OFF']
            CRNRSTN_IS_HTML             ['HTML', 'TEXT']    // Wednesday, November 22, 2023 @ 0117 hrs.

            E.G. WHEN $return_data_type = CRNRSTN_ICY_BITMASK, 'ON' OR
                 'OFF' WILL BE RETURNED:

                THEREFORE,

                    $oCRNRSTN->tidy_boolean(1, CRNRSTN_ICY_BITMASK);

                RETURNS:

                    (string) ON

                TO ACQUIRE THE "IS ACTIVE" STATE FOR THE OpenSSL v1.1.1
                ENCRYPTION ROTATION SERVICES LAYER ON ANY INITIALIZED
                CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (DDO)
                CHANNEL, THE SAME MEHTHOD CAN BE USED.

                FOR EXAMPLE, CHECK TO SEE IF ENCRYPTION IS ACTIVATED AND
                RUNNING ON THE GET CHANNEL USING:

                    $oCRNRSTN->tidy_boolean(CRNRSTN_ENCRYPT_GET, CRNRSTN_ICY_BITMASK, CRNRSTN_ICY_BITMASK);

                IF CRNRSTN :: DATA TUNNEL SERVICES ARE RUNNING ON HTTP/
                HTTPS $_GET[]...I.E., IF THE GET CHANNEL IS ACTIVE, THEN
                THE ABOVE METHOD CALL WILL RETURN:

                    (string) ON

                IF WE CAN DO THIS WITH CRNRSTN_ENCRYPT_COOKIE, THEN WE MAY
                HAVE SOMETHING.


            * Tuesday, November 21, 2023 @ 0847 hrs.

            */
            $tmp_channel_meta_ARRAY['oersl_enabled'] = $this->tidy_boolean($tmp_channel_meta_ARRAY['channel_encryption_int'], CRNRSTN_ICY_BITMASK, CRNRSTN_ICY_BITMASK);

            self::$channel_reporting_meta_ARRAY['CHANNEL_DATA'][$channel_char] = $tmp_channel_meta_ARRAY;

            //
            // REPORT TABLE OF CONTENTS.
            // GENERATE CHANNEL REPORT HEADER TABLE OF CONTENTS.
            $tmp_report_part_table_of_contents_str .= $this->channel_report_content_build('CHANNEL_REPORT_TABLE_OF_CONTENTS', $channel_char, $channel_report_ARRAY, NULL, $php_logo_height, $to_plaid, $is_HTML, $report_delimiter_TEXT, $report_delimiter_HTML);

            //
            // REPORT BODY.
            // GENERATE CHANNEL REPORT BODY.
            foreach($channel_report_ARRAY as $index_report => $report_int){

                $tmp_report_part_body_str .= $this->channel_report_content_build('CHANNEL_REPORT_BODY', $channel_char, $channel_report_ARRAY, NULL, $php_logo_height, $to_plaid, $is_HTML, $report_delimiter_TEXT, $report_delimiter_HTML);

            }

            //
            // REPORT FOOTER.
            // GENERATE CHANNEL REPORT FOOTER.
            $tmp_report_part_footer_str .= $this->channel_report_content_build('CHANNEL_REPORT_FOOTER', $channel_char, NULL,  NULL,  $php_logo_height, $to_plaid, $is_HTML, $report_delimiter_TEXT, $report_delimiter_HTML);
                                                                                    //($content_key, $channel_char, $attrib_0, $attrib_1, $php_logo_height, $to_plaid, $is_HTML, $report_delimiter_TEXT, $report_delimiter_HTML, $current_bytes = 0)
            //
            // REPORT HEADER.
            // GENERATE CHANNEL REPORT HEADER.
            $tmp_report_part_header_str .= $this->channel_report_content_build('CHANNEL_REPORT_HEADER', $channel_char, $tmp_channel_report_header_start_time, $tmp_channel_report_header_start_run_time, $php_logo_height, $to_plaid, $is_HTML, $report_delimiter_TEXT, $report_delimiter_HTML, strlen($tmp_report_part_table_of_contents_str . $tmp_report_part_body_str . $tmp_report_part_footer_str));

            //
            // ASSEMBLE REPORT FOR OUTPUT.
            $tmp_data_out_ARRAY[] = $tmp_report_part_header_str . $this->oCRNRSTN->wall_time() . ' seconds.
#   CLIENT IP ADDRESS: ' . $this->oCRNRSTN->client_ip() . '
' . $tmp_report_part_body_str . $tmp_report_part_footer_str;

        }

//         //
//         // IT IS OK...IF YOU WANT TO DELETE THE COMMENT BELOW...I MEAN...IF NOTES HAVE BEEN TAKEN.
//         // WE HAVE NOT RUN CRNRSTN :: MULTI-CHANNEL REPORTING YET...NOT ONE (1) TIME.
//         //
//         // Wednesday, November 22, 2023 @ 0121 hrs.
//
//////////////
//         // BUILD REPORT.
//         foreach($channel_report_ARRAY as $index => $report_id){
//
//             /*
//             CRNRSTN :: DATA HANDLING ARCHITECTURES
//             -----
//             G :: HTTP $_GET REQUEST.
//             P :: HTTP $_POST REQUEST.
//             H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).
//             S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).
//             J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
//             C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR BROWSER COOKIE...
//             D :: DATABASE (MySQLi CONNECTION).
//             R :: RUNTIME.
//             O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
//             F :: SERVER LOCAL FILE SYSTEM.
//
//             CRNRSTN :: ORDER OF OPERATIONS (PREFERENCE) FOR SPECIFICATION OF
//             AUTHORIZED PROPRIETARY DATA ARCHITECTURES OR CHANNELS.
//             -----
//             GPHSJCDROF
//
//             CRNRSTN :: MULTI-CHANNEL REPORT TYPE PROFILE BY REPORT ID
//             -----
//             0   CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (DDO) CHANNEL REPORT
//
//             1   CRNRSTN :: CHANNEL ENCRYPTION (OpenSSL v1.1.1) PROFILE
//
//             2   CRNRSTN :: ' . strtoupper(strval($tmp_channel_name)) . '[' . $tmp_channel_char . '] CHANNEL PERFORMANCE REPORT
//
//             3   CRNRSTN :: ENCRYPTION (OpenSSL v1.1.1) ROTATION SERVICES LAYER (OERSL) INITIALIZATION
//
//             4   CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER STATE (BIT FLIP) MANAGEMENT SERVICES LAYER
//
//             5   CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (DDO) PROFILE CONFIGURATION
//
//             */
//
//             switch($report_id){
//                 case 'G':
//                     //G :: HTTP $_GET REQUEST.
//                     //Monday, November 20, 2023 @ 007 hrs. and 42 secs.
//
//                 break;
//                 case 'P':
//                     //
//                 break;
//                 case 'H':
//                     //
//                 break;
//                 case 'S':
//                     //
//                 break;
//                 case 'J':
//                     //
//                 break;
//                 case 'C':
//                     //
//                 break;
//                 case 'D':
//                     //
//                 break;
//                 case 'R':
//                     //
//                 break;
//                 case 'O':
//                     //
//                 break;
//                 case 'F':
//                     //
//                 break;
//
//             }
//
//         }


        //
        // BUILD STRING DATA OUTPUT OF RUNTIME
        // SERVER PERFORMANCE FOR STRING
        // CONCATENATION TO THE FOOTER OF THIS
        // CRNRSTN :: MULTI-CHANNEL DECOUPLED
        // DATA OBJECT (DDO) CONFIGURATION
        // AND PERFORMANCE REPORTING OUTPUT.
        //
        // Sunday, November 19, 2023 2357 hrs.
        $tmp_data_out_ARRAY[] = '

' . $this->oCRNRSTN->mem_report($tmp_mem_report_ARRAY, $output_format, $php_logo_height, $to_plaid, $is_HTML, $report_delimiter_TEXT, $report_delimiter_HTML);

        //
        // CHANNEL REPORT :: HTML OUTPUT FORMAT [REPORT FOOTER].
        $tmp_data_out_ARRAY[] = '


[' . $this->oCRNRSTN->return_micro_time() . '] [rtime ' . $this->wall_time() . ']';

        switch($this->oCRNRSTN->data_type_filter($return_data_type)){
            case CRNRSTN_STRING:

                $tmp_str = '';
                foreach($tmp_data_out_ARRAY as $index_str => $report_str){

                    //
                    // THE POSSIBILITIES:
                    //      $tmp_content_type = 'HTML'
                    //      $tmp_content_type = 'TEXT'
                    //
                    // SEE, $oCRNRSTN->tidy_boolean($is_HTML, CRNRSTN_STRING, CRNRSTN_IS_HTML);
                    switch($tmp_content_type){
                        case 'TEXT':
                            //TEXT OUTPUT FORMAT.

                            $tmp_str .= $report_str . $report_delimiter_TEXT;

                        break;
                        default:
                            //case 'HTML':
                            //HTML OUTPUT FORMAT.

                            $tmp_str .= $report_str . $report_delimiter_HTML;

                        break;

                    }

                }

                return $tmp_str;

            break;
            default:
                //case CRNRSTN_ARRAY:

                return $tmp_data_out_ARRAY;

            break;

        }

    }

    public function _________count($data_key, $env_key){
    //public function count($data_key, $env_key){

        $this->oCRNRSTN->env_key($env_key);

        if(strlen($env_key) > 0){

            $tmp_channel_ARRAY = $this->oCRNRSTN->return_cache_channels(true);

            foreach($tmp_channel_ARRAY as $channel_index => $channel){

                //
                // IF THE CACHE_ID IS SET IN THE CHANNEL, RETURN FIRST RESOURCE MATCH
                // IN PROPER SEQUENCE OF CHANNEL.
                if($this->oCRNRSTN->isset_resource('data_value', $data_key, $channel, 0) == true){

                    error_log(__LINE__ . ' env DDO GET COUNT $data_key[' . $data_key . ']. $channel[' .  $channel . ']. die();');
                    die();

                    switch($channel){
                        case CRNRSTN_CHANNEL_RUNTIME:
                        case CRNRSTN_CHANNEL_SESSION:

                            $tmp_count = $this->oCRNRSTN->get_config_cache_count($data_key, NULL, $channel);

                            error_log(__LINE__ . ' env  $tmp_count[' . $tmp_count . ']. $data_key[' . $data_key . ']. $channel[' .  $channel . ']. die();');
                            die();
                            error_log(__LINE__ . ' env DDO GET CNT[' . $tmp_count . ']. $data_key[' . $data_key . '].');

                            return $tmp_count;

                        break;
                        case CRNRSTN_CHANNEL_DATABASE:
                        case CRNRSTN_CHANNEL_SSDTLA:
                        case CRNRSTN_CHANNEL_PSSDTLA:
                        case CRNRSTN_CHANNEL_COOKIE:
                        case CRNRSTN_CHANNEL_GET:
                        case CRNRSTN_CHANNEL_POST:
                        case CRNRSTN_CHANNEL_SOAP:
                            // IMPLEMENTATION PENDING.
                        break;

                    }

                }

            }

        }

        return 0;

    }

    public function report($ddo_attribute = 'total_count'){

        return count($this->data_flag_ARRAY);

    }

    private function concat_packet_data_index($data_key, $data_key_hashed){

        //
        // KEY FORMAT IJJIOJCCECCEEICMEIM0CEC0MEWCEK0::DATA
        if(is_array($data_key_hashed)){

            $tmp_key_chunk_ARRAY = explode('::', $data_key_hashed[0]);
            $tmp_value = $this->preach('data_value', $data_key_hashed[0]);

        }else{

            $tmp_key_chunk_ARRAY = explode('::', $data_key_hashed);
            $tmp_value = $this->preach('data_value', $data_key_hashed);

        }

        $tmp_cnt = count($tmp_key_chunk_ARRAY);
        $tmp_cnt--;

        //
        // TODO :: NEED TO SERIALIZE INDEX ARRAY BY THE FORM HANDLE...OR SOMETHING...
        // THIS WILL BE A PAGE WIDE INDEX FOR ALL FORMS, OTHERWISE.
        //error_log(__LINE__ . ' env ddo $tmp_cnt=[' . $tmp_cnt . '] $tmp_key_chunk_ARRAY=[' . print_r($tmp_key_chunk_ARRAY[$tmp_cnt], true) . '].');
        if(($tmp_key_chunk_ARRAY[$tmp_cnt] == 'CRNRSTN_FIELD_INPUT_NAME') || ($tmp_key_chunk_ARRAY[$tmp_cnt] == 'CRNRSTN_FIELD_HIDDEN_INPUT_NAME')){

            //error_log(__LINE__ . ' env ddo $tmp_value=[' . $tmp_value . '].');
            $this->oCRNRSTN->form_integrations_data_index_ARRAY[$data_key][] = $tmp_value;

        }

    }

    public function return_data_output_channel($crnrstn_form_handle){

        return $this->data_output_channel_ARRAY[$crnrstn_form_handle];

    }

    public function set_data_output_channel($channel_constant, $crnrstn_form_handle){

        $this->data_output_channel_ARRAY[$crnrstn_form_handle] = $channel_constant;

    }

    public function preach($data_attribute = 'data_value', $data_key = NULL, $data_type_family = 'CRNRSTN::RESOURCE', $data_authorization_profile = CRNRSTN_AUTHORIZE_RUNTIME, $index = 0){

        //error_log(__LINE__ . ' env ddo->' . __METHOD__ . ':: $index=' . $index . ' $data_attribute=' . $data_attribute  . '. $data_key=' . $data_key . '.');
        //error_log(__LINE__ . ' env ddo->' . __METHOD__ . ':: $this->data_value_ARRAY=' . print_r($this->data_value_ARRAY, true) . '.');
        //error_log(__LINE__ . ' env ddo $data_attribute=[' . $data_attribute . ']. $data_key=[' . $data_key . ']. $soap_transport=[' . $soap_transport . ']. $index=[' . $index . '].');

        //error_log(__LINE__ . ' env $data_attribute[' . $data_attribute . ']. $data_key[' . $data_key . ']. $index[' . $index . '].');
        //error_log(__LINE__ . ' env LOOKING TO PREACH $data_attribute[' . $data_attribute . ']. $data_key[' . $data_key . ']. $data_authorization_profile[' . $data_authorization_profile . '].');

        //
        // GET ACTIVE CACHE CHANNELS IN ORDER OF OPERATIONS DEFINED IN CRNRSTN :: SETTINGS CONFIG.
        $tmp_channel_ARRAY = $this->oCRNRSTN->return_cache_channels(true);

//        $tmp_pos = strpos($data_key, 'data_channel_init_sequence');
//        if($tmp_pos !== false){
//
//            error_log(__LINE__ . ' env $data_key[' . $data_key . ']. $data_type_family[' . $data_type_family . ']. $index[' . $index . ']. $tmp_channel_ARRAY[' . print_r($tmp_channel_ARRAY, true) . '].');
//
//            $tmp_array = array();
//            $tmp_array[] = '12345';
//            $tmp = strlen($tmp_array);
//
//            die();
//
//        }

        /*
        Sunday, October 15, 2023 0248 hrs.
        WE NEED A LOOKUP ARRAY THAT CONNECTS CHANNEL AND DATA.

        self::$ddo_resource_memory_pointer_ARRAY['crnrstn_system_directory'] = 1;
        -----
        $tmp_ddo_memory_pointer = $this->oCRNRSTN->hash_ddo_memory_pointer($data_key, $data_type_family);
        self::$ddo_resource_memory_pointer_ARRAY[$tmp_ddo_memory_pointer][] = 'runtime';
        self::$ddo_resource_memory_pointer_ARRAY[$tmp_ddo_memory_pointer][] = 'session';

        */

//        if($data_key == '451cbfd5141c77a347bb9265ef0257c9451b7f77f68346a37c3acb0c00fb282a::custom_mobi_name'){
//
//            $tmp_ARRAY = strlen(array('hello'));
//
//        }

        if($tmp_ddo_memory_pointer = $this->oCRNRSTN->isset_ddo_resource_pointer($data_key, $data_type_family, $data_authorization_profile)){

            if($tmp_resource_channel_ARRAY = $this->oCRNRSTN->get_ddo_resource_channel_array($tmp_ddo_memory_pointer)){

                foreach($tmp_resource_channel_ARRAY as $channel_index => $channel){

                    if($this->isset_resource($data_attribute, $data_key, $channel, $index) == true){

                        $tmp_ddo_output = $this->oCRNRSTN->get_config_cache($data_attribute, $data_key, $data_type_family, $index, $channel);

                        return $tmp_ddo_output;

                    }

                }

            }

        }

        //if(!isset($channel)){

        //error_log(__LINE__ . ' env DO WE GET THIS FAR? $data_attribute[' . $data_attribute . ']. $data_key[' . $data_key . ']. $data_authorization_profile[' . $this->oCRNRSTN->return_constant_profile_ARRAY($data_authorization_profile, CRNRSTN_STRING) . ']. $tmp_channel_ARRAY[' . print_r($tmp_channel_ARRAY, true) . '].');
        //die();

        return NULL;
        //}

        /////////////
        /////////////
        // EVERYTHING PAST HERE HAS BEEN INTERNALIZED WITHIN THE RRS MAP MULTI-CHANNEL SITUATION.

        //
        // SHOULD WE SWITCH ON CHANNEL AUTHORIZATION...NOT CHANNEL NAME? Sunday, October 15, 2023 @ 0301 hrs.
        // E.G.  case CRNRSTN_AUTHORIZE_RUNTIME:, case CRNRSTN_AUTHORIZE_SESSION, ETC.:
        switch($data_authorization_profile){
            case CRNRSTN_AUTHORIZE_SESSION:
            case 'session':

                if(is_array($data_key)){

                    //if(isset($this->data_authorization_profile_ARRAY[$data_key[0]][$index])){
                    if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_authorization_profile'][$data_key[0]][$index])){

                        if(!($this->oCRNRSTN->isset_auth_profile($data_authorization_profile, $this->data_authorization_profile_ARRAY[$data_key[0]][$index]) == true)){

                            return $this->oCRNRSTN->session_salt();

                        }

                    }

                }else{

                    if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_authorization_profile'][$data_key][$index])){

                        if(!($this->oCRNRSTN->isset_auth_profile($data_authorization_profile, $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_authorization_profile'][$data_key][$index]) == true)){

                            return $this->oCRNRSTN->session_salt();

                        }

                    }

                }

                if(!isset($data_key)){

                    $data_key = '';

                }

                switch($data_attribute){
                    case 'crnrstn_data_packet_hidden_input_html':

                        foreach($this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY as $packet_index => $packet_data_key){

                            if(is_array($packet_data_key)){

                                foreach($packet_data_key as $tmp_fip_index => $packet_data_key_str){

                                    $tmp_data_ARRAY = $this->preach('pssdtl_packet_data_array', $packet_data_key_str, $data_authorization_profile);
                                    if($tmp_data_ARRAY != $this->oCRNRSTN->session_salt()){

                                        //error_log(__LINE__ . ' ddo env ' . __METHOD__ . ' $tmp_data=[' . print_r($tmp_data_ARRAY, true) . '].  $tmp_data=[' . print_r($data_attribute, true) . '].  $tmp_data=[' . print_r($data_authorization_profile, true) . '].');
                                        $this->oCRNRSTN->oDATA_TUNNEL_SERVICES_MGR->receive_packet_data($tmp_data_ARRAY, $data_attribute, $data_authorization_profile);

                                    }

                                }

                            }else{

                                //
                                // I SUSPECT THAT THIS WILL NO LONGER RUN DUE TO NEWER SERIALIZATION REQUIREMENTS
                                $tmp_data_ARRAY = $this->preach('pssdtl_packet_data_array', $packet_data_key, $data_authorization_profile);

                                if($tmp_data_ARRAY != $this->oCRNRSTN->session_salt()){

                                    $this->oCRNRSTN->oDATA_TUNNEL_SERVICES_MGR->receive_packet_data($tmp_data_ARRAY, $data_attribute, $data_authorization_profile);

                                }

                            }

                        }

                        // WHERE $data_key == $crnrstn_form_handle
                        return $this->oCRNRSTN->oDATA_TUNNEL_SERVICES_MGR->return_hidden_input_html($data_key, $this->return_data_output_channel($data_key));

                    break;
                    case 'crnrstn_data_packet':

                        $tmp_crnrstn_data_packet_out = '{
"crnrstn_data_packet" : [ {
';
                        $tmp_data_packet_parameter_out = '"crnrstn_data_packet_ddo_elements" : [';

                        $tmp_str = '';

                        foreach($this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY as $packet_index => $packet_data_key){

                            //
                            // POSSIBLY ALWAYS ARRAY, NOW.
                            if(is_array($packet_data_key)){

                                foreach($packet_data_key as $tmp_fip_index => $packet_data_key_str){

                                    $tmp_data =  $this->preach('pssdtl_packet', $packet_data_key_str, $data_authorization_profile);
                                    if($tmp_data != $this->oCRNRSTN->session_salt()){

                                        $tmp_str .= $tmp_data;
                                        $this->concat_packet_data_index($data_key, $packet_data_key_str);

                                    }

                                }

                            }else{

                                error_log(__LINE__ . ' ddo env ' . __METHOD__ . ' crnrstn_data_packet_data_key_index IS A STRING.');
                                $tmp_data = $this->preach('pssdtl_packet', $packet_data_key, $data_authorization_profile);

                                if($tmp_data != $this->oCRNRSTN->session_salt()){

                                    $tmp_str .= $tmp_data;
                                    $this->concat_packet_data_index($data_key, $packet_data_key);

                                }

                            }

                        }

                        $tmp_str = $this->oCRNRSTN->strrtrim($tmp_str, ',');

                        $tmp_close = '
]';

                        $tmp_close .= '
}]}';

                        return $tmp_crnrstn_data_packet_out . $tmp_data_packet_parameter_out . $tmp_str . $tmp_close;

                    break;
                    case 'pssdtl_packet_data_array':

                        $tmp_serialization_salt = $this->oCRNRSTN->salt();

                        $tmp_ARRAY = array();
                        $tmp_val = '';
                        $tmp_resource_bytes = 0;

                        //
                        // MAY ALWAYS BE ARRAY
                        if(is_array($data_key)){

                            /*
                            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['ttl_profile'][$data_key][$index] = $ttl;
                            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['ttl'][$data_key][$index] = $tmp_ttl;
                            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_authorization_profile'][$data_key][$index] = $data_authorization_profile;
                            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_type'][$data_key][$index] = $data_type;
                            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_flag'][$data_key][$index] = 1;
                            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_value'][$data_key][$index] = (int) $data_value;

                            */

                            // WE DO NOT PASS DATA VALUE (OR SENSITIVE META ABOUT VALUE) TO CLIENT...IF ANYTHING
                            // SAVE MAYBE THE ENCRYPTED PSSDTLP. AND, I IMAGINE THE SAME KIND OF RULES WOULD
                            // APPLY TO THE SSDTLA.
                            //if(isset($this->data_value_ARRAY[$data_key[0]][$index])){
                            if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_value'][$data_key[0]][$index])){

                                $tmp_resource_bytes = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['resource_bytes'][$data_key[0]][$index];

                            }

                            $tmp_ARRAY['SALT'] = $tmp_serialization_salt;
                            $tmp_ARRAY['HASH'] = $this->oCRNRSTN->hash($data_key[0] . $this->oCRNRSTN->hash($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_authorization_profile'][$data_key[0]][$index], 'md5') . $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_type'][$data_key[0]][$index], 'md5');
                            $tmp_ARRAY['BYTES'] = $tmp_resource_bytes;
                            $tmp_ARRAY['KEY'] = $this->oCRNRSTN->return_clean_json_string($data_key[0]);
                            $tmp_ARRAY['TYPE'] = $this->data_type_ARRAY[$data_key[0]][$index];
                            $tmp_ARRAY['VALUE'] = $this->oCRNRSTN->return_clean_json_string($tmp_val);
                            $tmp_ARRAY['TTL'] = $this->oCRNRSTN->return_clean_json_string($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['ttl_profile'][$data_key[0]][$index]);
                            $tmp_ARRAY['AUTH_PROFILE'] = $this->oCRNRSTN->return_clean_json_string($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_authorization_profile'][$data_key[0]][$index]);

                        }else{

                            // WE DO NOT PASS DATA VALUE (OR SENSITIVE META ABOUT VALUE) TO CLIENT...IF ANYTHING SAVE PSSDTLP.
                            // AND I IMAGINE THE SAME KIND OF RULES WOULD APPLY TO SSDTLP
                            $tmp_resource_bytes = 0;
                            if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['resource_bytes'][$data_key][$index])){

                                $tmp_resource_bytes = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['resource_bytes'][$data_key][$index];

                            }

                            if(!isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_value'][$data_key][$index])){

                                // TODO :: GET THESE ISSET CHECKS OUT OF HERE. WE ARE MISSING A USE CASE.
                                //error_log(__LINE__ . ' ddo env data_value_ARRAY not set.');
                                $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_value'][$data_key][$index] = '';
                                $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['ttl_profile'][$data_key][$index] = 60;
                                //$this->data_authorization_profile_ARRAY[$data_key][$index] = CRNRSTN_CHANNEL_FORM_INTEGRATIONS;
                                $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_authorization_profile'][$data_key][$index] = CRNRSTN_CHANNEL_SSDTLA;

                            }

                            //
                            // CHECK RUNTIME FOR DATA TYPE.
                            if(!isset($this->data_type_ARRAY[$data_key][$index])){

                                //error_log(__LINE__ . ' ddo env data_type_ARRAY not set.');
                                $this->data_type_ARRAY[$data_key][$index] = 'CRNRSTN_STRING';         // PREVIOUSLY 'string';

                            }

                            $tmp_ARRAY['SALT'] = $tmp_serialization_salt;
                            $tmp_ARRAY['HASH'] = $this->oCRNRSTN->hash($data_key . $this->oCRNRSTN->hash($this->data_value_ARRAY[$data_key][$index], 'md5') . $this->data_type_ARRAY[$data_key][$index], 'md5');
                            $tmp_ARRAY['BYTES'] = $tmp_resource_bytes;
                            $tmp_ARRAY['KEY'] = $this->oCRNRSTN->return_clean_json_string($data_key);
                            $tmp_ARRAY['TYPE'] = $this->data_type_ARRAY[$data_key][$index];
                            $tmp_ARRAY['VALUE'] = $this->oCRNRSTN->return_clean_json_string($tmp_val);
                            $tmp_ARRAY['TTL'] = $this->oCRNRSTN->return_clean_json_string($this->ttl_profile_ARRAY[$data_key][$index]);
                            $tmp_ARRAY['AUTH_PROFILE'] = $this->oCRNRSTN->return_clean_json_string($this->data_authorization_profile_ARRAY[$data_key][$index]);

                        }

                        return $tmp_ARRAY;

                    break;
                    case 'pssdtl_packet':

                        $tmp_str_out = '';
                        $tmp_val = '';
                        $tmp_resource_bytes = 0;

//                $tmp_count = 0;
//                $tmp_meta_str_out = '';
//                $tmp_str_out = '';
//                $line_wrap = $tmp_line_wrap_cnt = 3;
//
//                $tmp_meta_str_out .= '"crnrstn_system_configuration_parameter_index" : [
//                        ';
//                $tmp_str_out .= '"crnrstn_system_configuration_parameter" : [
//                        ';

                        //
                        // Friday, August 5, 2022 2241 hrs
                        // IF WE'RE TALKING SSDTLP, THEN WE NEED TO FUCK WITH SOAP
                        // OBJECTS NOW (YEAH, FUCK JSON!)...WHICH I AM NOT...AT THE MOMENT.
                        //
                        // Sunday, September 11, 2022 0230 hrs.
                        // WE WILL WRAP THE PSSDTL WITH THE SSDTL. SO SOAP-WRAPPED PSSDTLP IS #WINNING.
                        // A CRNRSTN :: DATA PACKET IS AN ENCRYPTED JSON OBJECT WRAPPED IN A SOAP OBJECT. FUCK YEAH! JSON!
                        // CRNRSTN :: DATA PACKET IS A THING NOW.
                        //
                        // Monday, May 1, 2023 @ 0510 hrs
                        // TAKING THIS CRNRSTN :: DDO TECHNOLOGY TO MULTI-CHANNEL READ/WRITES (ALONG WITH
                        // PLAID) IN THIS...THESE..., THE LAST OF DAYS.

                        //error_log(__LINE__ . ' ddo packet $data_key=[' . print_r($data_key, true) . ']. $index=[' . $index . ']. ttl_profile_ARRAY=[' . print_r($this->ttl_profile_ARRAY[$data_key], true) . '].');
                        //error_log(__LINE__ . ' ddo packet TYPE=[' . $this->data_type_ARRAY[$data_key][$index] . '] BYTES=[' . $tmp_resource_bytes . '] TTL=[' . $this->oCRNRSTN->return_clean_json_string($this->ttl_profile_ARRAY[$data_key][$index]) . '] AUTH_PROFILE=[' . $this->oCRNRSTN->return_clean_json_string($this->data_authorization_profile_ARRAY[$data_key][$index]) . ']');

                        if(is_array($data_key)){

                            // WE DO NOT PASS DATA VALUE (OR SENSITIVE META ABOUT VALUE) TO CLIENT...IF ANYTHING SAVE PSSDTLP.
                            // AND I IMAGINE THE SAME KIND OF RULES WOULD APPLY TO SSDTLP
                            //if(isset($this->data_value_ARRAY[$data_key[0]][$index])){
                            $tmp_resource_bytes = 0;
                            if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['resource_bytes'][$data_key[0]][$index])){

                                $tmp_resource_bytes = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['resource_bytes'][$data_key[0]][$index];

                            }

                            $tmp_str_out .= '
{
    "SALT"
    "HASH" : "' . $this->oCRNRSTN->hash($data_key[0] . $this->oCRNRSTN->hash($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_value'][$data_key[0]][$index], 'md5') . $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_type'][$data_key[0]][$index], 'md5') . '",
    "BYTES" : ' . $tmp_resource_bytes . ',
    "KEY" : ' . $this->oCRNRSTN->return_clean_json_string($data_key[0]) . ',
    "TYPE" : "' . $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_type'][$data_key[0]][$index] . '",
    "VALUE" : ' . $this->oCRNRSTN->return_clean_json_string($tmp_val) . ',
    "TTL" : ' . $this->oCRNRSTN->return_clean_json_string($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['ttl'][$data_key[0]][$index]) . ',
    "AUTH_PROFILE" : ' . $this->oCRNRSTN->return_clean_json_string($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_authorization_profile'][$data_key[0]][$index]) . '
},';

                        }else{

                            // WE DO NOT PASS DATA VALUE (OR SENSITIVE META ABOUT VALUE) TO CLIENT...IF ANYTHING SAVE PSSDTLP.
                            // AND I IMAGINE THE SAME KIND OF RULES WOULD APPLY TO SSDTLP
                            $tmp_resource_bytes = 0;
                            if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['resource_bytes'][$data_key][$index])){

                                $tmp_resource_bytes = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['resource_bytes'][$data_key][$index];

                            }

                            //if(!isset($this->data_value_ARRAY[$data_key][$index])){
                            if(!isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_value'][$data_key][$index])){

                                // TODO :: GET THESE ISSET CHECKS OUT OF HERE. WE ARE MISSING A USE CASE.
                                //error_log(__LINE__ . ' ddo env data_value_ARRAY not set.');
                                //$this->data_value_ARRAY[$data_key][$index] = 60;
                                $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_value'][$data_key][$index] = '';

                                //$this->ttl_profile_ARRAY[$data_key][$index] = 60;
                                $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['ttl_profile'][$data_key][$index] = $this->oCRNRSTN->rrs_map_get($channel . '_map_cache_ttl');

                                //$this->data_authorization_profile_ARRAY[$data_key][$index] = CRNRSTN_CHANNEL_FORM_INTEGRATIONS;
                                //$this->data_authorization_profile_ARRAY[$data_key][$index] = CRNRSTN_CHANNEL_SSDTLA;
                                $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_authorization_profile'][$data_key][$index] = CRNRSTN_CHANNEL_SSDTLA;

                            }

                            if(!isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_type'][$data_key][$index])){

                                //error_log(__LINE__ . ' ddo env data_type_ARRAY not set.');
                                //$this->data_type_ARRAY[$data_key][$index] = 'string';     // <-- OLD RUNTIME ARCHITECTURE.

                                //
                                // DEFAULT TO CRNRSTN_STRING, IF DATA TYPE IS NOT SET IN SESSION. THIS WOULD BE ATYPICAL..IMHO.
                                $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_type'][$data_key][$index] = 'CRNRSTN_STRING';        // PREVIOUSLY 'string';

                            }

                            /*
                            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['ttl_profile'][$data_key][$index] = $ttl;
                            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['ttl'][$data_key][$index] = $tmp_ttl;
                            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_authorization_profile'][$data_key][$index] = $data_authorization_profile;
                            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_type'][$data_key][$index] = $data_type;
                            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_flag'][$data_key][$index] = 1;
                            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_value'][$data_key][$index] = (int) $data_value;

                            */

                            //error_log(__LINE__.  ' ddo env $data_key=[' . $data_key . ']. $tmp_resource_bytes=[' . $tmp_resource_bytes . ']. $index=[' . $index . '].');
                            $tmp_str_out .= '
{
    "HASH" : "' . $this->oCRNRSTN->hash($data_key . $this->oCRNRSTN->hash($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_value'][$data_key][$index], 'md5') . $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_type'][$data_key][$index], 'md5') . '",
    "BYTES" : ' . $tmp_resource_bytes . ',
    "KEY" : ' . $this->oCRNRSTN->return_clean_json_string($data_key) . ',
    "TYPE" : "' . $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_type'][$data_key][$index] . '",
    "VALUE" : ' . $this->oCRNRSTN->return_clean_json_string($tmp_val) . ',
    "TTL" : ' . $this->oCRNRSTN->return_clean_json_string($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['ttl'][$data_key][$index]) . ',
    "AUTH_PROFILE" : ' . $this->oCRNRSTN->return_clean_json_string($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_authorization_profile'][$data_key][$index]) . '
},';

                        }

                        //error_log(__LINE__ . ' ddo type=[' . $this->data_type_ARRAY[$data_key][$index] . '].');

                        return $tmp_str_out;

                    break;
                    case 'isset':

                        if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_flag'][$data_key][$index])){

                            //return $this->data_flag_ARRAY[$data_key][$index];
                            return $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_flag'][$data_key][$index];

                        }else{

                            return false;

                        }

                    break;
                    case 'ttl':

                        //return $this->data_authorization_profile_ARRAY[$data_key][$index];
                        return $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['ttl'][$data_key][$index];

                    break;
                    case 'auth_profile':

                        //return $this->data_authorization_profile_ARRAY[$data_key][$index];
                        return $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_authorization_profile'][$data_key][$index];

                    break;
                    case 'type':

                        //return $this->data_type_ARRAY[$data_key][$index];
                        return $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_type'][$data_key][$index];

                    break;
                    case 'data_value':

                        if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_value'][$data_key][$index])){

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
                            error_log(__LINE__ . ' ddo CHECK THAT THIS IS INTEGER PROCESSING OF SESSION CRNRSTN :: DDO DATA. TYPE[' . strval($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_value'][$data_key][$index]) . ']. die();');
                            die();

                            switch($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_type'][$data_key][$index]){
                                case CRNRSTN_INT:

                                    //return (int) $this->data_value_ARRAY[$data_key][$index];
                                    return (int) $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_value'][$data_key][$index];

                                break;
                                case CRNRSTN_INTEGER:

                                    //return (integer) $this->data_value_ARRAY[$data_key][$index];
                                    return (integer) $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_value'][$data_key][$index];

                                break;
                                case CRNRSTN_BOOL:

                                    if($data_authorization_profile == CRNRSTN_CHANNEL_SOAP){

                                        //return $this->data_value_ARRAY[$data_key][$index];
                                        return $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_value'][$data_key][$index];

                                    }else{

                                        return $this->oCRNRSTN->boolean_conversion($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_value'][$data_key][$index]);

                                    }

                                break;
                                case CRNRSTN_BOOLEAN:

                                    if($data_authorization_profile == CRNRSTN_CHANNEL_SOAP){

                                        //return $this->data_value_ARRAY[$data_key][$index];
                                        return $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_value'][$data_key][$index];

                                    }else{

                                        return $this->oCRNRSTN->boolean_conversion($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_value'][$data_key][$index]);

                                    }

                                break;
                                case CRNRSTN_FLOAT:

                                    //return (float) $this->data_value_ARRAY[$data_key][$index];
                                    return (float) $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_value'][$data_key][$index];

                                break;
                                case CRNRSTN_DOUBLE:

                                    //return (double) $this->data_value_ARRAY[$data_key][$index];
                                    return (double) $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_value'][$data_key][$index];

                                break;
                                case CRNRSTN_RESOURCE:

                                    //return (float) $this->data_value_ARRAY[$data_key][$index];
                                    return $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_value'][$data_key][$index];

                                break;
                                case CRNRSTN_RESOURCE_CLOSED:

                                    //return (float) $this->data_value_ARRAY[$data_key][$index];
                                    return $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_value'][$data_key][$index];

                                break;
                                case CRNRSTN_STRING:

                                    //return (string) $this->data_value_ARRAY[$data_key][$index];
                                    return (string) $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_value'][$data_key][$index];

                                break;
                                case CRNRSTN_ARRAY:

                                    //return (array) $this->data_value_ARRAY[$data_key][$index];
                                    return (array) $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_value'][$data_key][$index];

                                break;
                                case CRNRSTN_OBJECT:

                                    //return (object) $this->data_value_ARRAY[$data_key][$index];
                                    $tmp_obj_unserial = unserialize($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_value'][$data_key][$index]);
                                    return (object) $tmp_obj_unserial;

                                break;
                                case CRNRSTN_NULL:

                                    return NULL;

                                break;
                                default:
                                    //CRNRSTN_UNKNOWN_TYPE

                                    error_log(__LINE__ . ' ddo - RETURNING SESSION DATA FROM DEFAULT [' . $data_key . '].');

                                    //return $this->data_value_ARRAY[$data_key][$index];
                                    return $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_value'][$data_key][$index];

                                break;

                            }

                        }else{

                            //
                            // TODO :: SHOULD THIS RETURN SOMETHING TIED TO THE SESSION FOR PROPER
                            // TODO :: DETERMINATION OF "NO DATA TO RETURN"
                            // BOOLEAN FALSE WILL RETURN (string) 'false'
                            //error_log(__LINE__ .' env ddo - return false... NOT SET [' . $data_key . ']');
                            //return false;
                            return $this->oCRNRSTN->session_salt('NO_MATCH');

                        }

                    break;
                    default:

                        //error_log(__LINE__ .' env ddo - RETURN DEFAULT VALUE ['.$data_key.']');
                        //return $this->data_value_ARRAY[$data_key][$index];
                        return $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_value'][$data_key][$index];

                    break;

                }

            break;
            case CRNRSTN_AUTHORIZE_RUNTIME:
                //case  'runtime':

                if(is_array($data_key)){

                    if(isset($this->data_authorization_profile_ARRAY[$data_key[0]][$index])){

                        if(!($this->oCRNRSTN->isset_auth_profile($data_authorization_profile, $this->data_authorization_profile_ARRAY[$data_key[0]][$index]) == true)){

                            return $this->oCRNRSTN->session_salt();

                        }

                    }

                }else{

                    if(isset($this->data_authorization_profile_ARRAY[$data_key][$index])){

                        if(!($this->oCRNRSTN->isset_auth_profile($data_authorization_profile, $this->data_authorization_profile_ARRAY[$data_key][$index]) == true)){

                            return $this->oCRNRSTN->session_salt();

                        }

                    }

                }

                if(!isset($data_key)){

                    $data_key = '';

                }

                switch($data_attribute){
                    case 'crnrstn_data_packet_hidden_input_html':

                        foreach($this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY as $packet_index => $packet_data_key){

                            if(is_array($packet_data_key)){

                                foreach($packet_data_key as $tmp_fip_index => $packet_data_key_str){

                                    $tmp_data_ARRAY = $this->preach('pssdtl_packet_data_array', $packet_data_key_str, $data_authorization_profile);
                                    if($tmp_data_ARRAY != $this->oCRNRSTN->session_salt()){

                                        //error_log(__LINE__ . ' ddo env ' . __METHOD__ . ' $tmp_data=[' . print_r($tmp_data_ARRAY, true) . '].  $tmp_data=[' . print_r($data_attribute, true) . '].  $tmp_data=[' . print_r($data_authorization_profile, true) . '].');
                                        $this->oCRNRSTN->oDATA_TUNNEL_SERVICES_MGR->receive_packet_data($tmp_data_ARRAY, $data_attribute, $data_authorization_profile);

                                    }

                                }

                            }else{

                                //
                                // I SUSPECT THAT THIS WILL NO LONGER RUN DUE TO NEWER SERIALIZATION REQUIREMENTS
                                $tmp_data_ARRAY = $this->preach('pssdtl_packet_data_array', $packet_data_key, $data_authorization_profile);

                                if($tmp_data_ARRAY != $this->oCRNRSTN->session_salt()){

                                    $this->oCRNRSTN->oDATA_TUNNEL_SERVICES_MGR->receive_packet_data($tmp_data_ARRAY, $data_attribute, $data_authorization_profile);

                                }

                            }

                        }

                        // WHERE $data_key == $crnrstn_form_handle
                        return $this->oCRNRSTN->oDATA_TUNNEL_SERVICES_MGR->return_hidden_input_html($data_key, $this->return_data_output_channel($data_key));

                    break;
                    case 'crnrstn_data_packet':

                        $tmp_crnrstn_data_packet_out = '{
"crnrstn_data_packet" : [ {
';
                        $tmp_data_packet_parameter_out = '"crnrstn_data_packet_ddo_elements" : [';

                        $tmp_str = '';

                        foreach($this->oCRNRSTN->crnrstn_data_packet_data_key_index_ARRAY as $packet_index => $packet_data_key){

                            //
                            // POSSIBLY ALWAYS ARRAY, NOW.
                            if(is_array($packet_data_key)){

                                foreach($packet_data_key as $tmp_fip_index => $packet_data_key_str){

                                    $tmp_data =  $this->preach('pssdtl_packet', $packet_data_key_str, $data_authorization_profile);
                                    if($tmp_data != $this->oCRNRSTN->session_salt()){

                                        $tmp_str .= $tmp_data;
                                        $this->concat_packet_data_index($data_key, $packet_data_key_str);

                                    }

                                }

                            }else{

                                error_log(__LINE__ . ' ddo env ' . __METHOD__ . ' crnrstn_data_packet_data_key_index IS A STRING.');
                                $tmp_data = $this->preach('pssdtl_packet', $packet_data_key, $data_authorization_profile);

                                if($tmp_data != $this->oCRNRSTN->session_salt()){

                                    $tmp_str .= $tmp_data;
                                    $this->concat_packet_data_index($data_key, $packet_data_key);

                                }

                            }

                        }

                        $tmp_str = $this->oCRNRSTN->strrtrim($tmp_str, ',');

                        $tmp_close = '
]';

                        $tmp_close .= '
}]}';

                        return $tmp_crnrstn_data_packet_out . $tmp_data_packet_parameter_out . $tmp_str . $tmp_close;

                    break;
                    case 'pssdtl_packet_data_array':

                        $tmp_serialization_salt = $this->oCRNRSTN->salt();

                        $tmp_ARRAY = array();
                        $tmp_val = '';
                        $tmp_resource_bytes = 0;

                        //
                        // MAY ALWAYS BE ARRAY
                        if(is_array($data_key)){

                            // WE DO NOT PASS DATA VALUE (OR SENSITIVE META ABOUT VALUE) TO CLIENT...IF ANYTHING
                            // SAVE MAYBE THE ENCRYPTED PSSDTLP. AND, I IMAGINE THE SAME KIND OF RULES WOULD
                            // APPLY TO THE SSDTLA.
                            if(isset($this->data_value_ARRAY[$data_key[0]][$index])){

                                $tmp_val = $this->data_value_ARRAY[$data_key[0]][$index];
                                $tmp_resource_bytes = strlen($tmp_val);

                            }

                            $tmp_ARRAY['SALT'] = $tmp_serialization_salt;
                            $tmp_ARRAY['HASH'] = $this->oCRNRSTN->hash($data_key[0] . $this->oCRNRSTN->hash($this->data_value_ARRAY[$data_key[0]][$index], 'md5') . $this->data_type_ARRAY[$data_key[0]][$index], 'md5');
                            $tmp_ARRAY['BYTES'] = $tmp_resource_bytes;
                            $tmp_ARRAY['KEY'] = $this->oCRNRSTN->return_clean_json_string($data_key[0]);
                            $tmp_ARRAY['TYPE'] = $this->data_type_ARRAY[$data_key[0]][$index];
                            $tmp_ARRAY['VALUE'] = $this->oCRNRSTN->return_clean_json_string($tmp_val);
                            $tmp_ARRAY['TTL'] = $this->oCRNRSTN->return_clean_json_string($this->ttl_profile_ARRAY[$data_key[0]][$index]);
                            $tmp_ARRAY['AUTH_PROFILE'] = $this->oCRNRSTN->return_clean_json_string($this->data_authorization_profile_ARRAY[$data_key[0]][$index]);

                        }else{

                            // WE DO NOT PASS DATA VALUE (OR SENSITIVE META ABOUT VALUE) TO CLIENT...IF ANYTHING SAVE PSSDTLP.
                            // AND I IMAGINE THE SAME KIND OF RULES WOULD APPLY TO SSDTLP
                            if(isset($this->data_value_ARRAY[$data_key][$index])){

                                $tmp_val = $this->data_value_ARRAY[$data_key][$index];
                                $tmp_resource_bytes = strlen($tmp_val);

                            }

                            if(!isset($this->data_value_ARRAY[$data_key][$index])){

                                // TODO :: GET THESE ISSET CHECKS OUT OF HERE. WE ARE MISSING A USE CASE.
                                //error_log(__LINE__ . ' ddo env data_value_ARRAY not set.');
                                $this->data_value_ARRAY[$data_key][$index] = '';
                                $this->ttl_profile_ARRAY[$data_key][$index] = 60;
                                //$this->data_authorization_profile_ARRAY[$data_key][$index] = CRNRSTN_CHANNEL_FORM_INTEGRATIONS;
                                $this->data_authorization_profile_ARRAY[$data_key][$index] = CRNRSTN_CHANNEL_SSDTLA;

                            }

                            if(!isset($this->data_type_ARRAY[$data_key][$index])){

                                //error_log(__LINE__ . ' ddo env data_type_ARRAY not set.');
                                $this->data_type_ARRAY[$data_key][$index] = 'CRNRSTN_STRING';           // PREVIOUSLY 'string';

                            }

                            $tmp_ARRAY['SALT'] = $tmp_serialization_salt;
                            $tmp_ARRAY['HASH'] = $this->oCRNRSTN->hash($data_key . $this->oCRNRSTN->hash($this->data_value_ARRAY[$data_key][$index], 'md5') . $this->data_type_ARRAY[$data_key][$index], 'md5');
                            $tmp_ARRAY['BYTES'] = $tmp_resource_bytes;
                            $tmp_ARRAY['KEY'] = $this->oCRNRSTN->return_clean_json_string($data_key);
                            $tmp_ARRAY['TYPE'] = $this->data_type_ARRAY[$data_key][$index];
                            $tmp_ARRAY['VALUE'] = $this->oCRNRSTN->return_clean_json_string($tmp_val);
                            $tmp_ARRAY['TTL'] = $this->oCRNRSTN->return_clean_json_string($this->ttl_profile_ARRAY[$data_key][$index]);
                            $tmp_ARRAY['AUTH_PROFILE'] = $this->oCRNRSTN->return_clean_json_string($this->data_authorization_profile_ARRAY[$data_key][$index]);

                        }

                        return $tmp_ARRAY;

                    break;
                    case 'pssdtl_packet':

                        $tmp_str_out = '';
                        $tmp_val = '';
                        $tmp_resource_bytes = 0;

//                $tmp_count = 0;
//                $tmp_meta_str_out = '';
//                $tmp_str_out = '';
//                $line_wrap = $tmp_line_wrap_cnt = 3;
//
//                $tmp_meta_str_out .= '"crnrstn_system_configuration_parameter_index" : [
//                        ';
//                $tmp_str_out .= '"crnrstn_system_configuration_parameter" : [
//                        ';

                        //
                        // Friday, August 5, 2022 2241 hrs
                        // IF WE'RE TALKING SSDTLP, THEN WE NEED TO FUCK WITH SOAP
                        // OBJECTS NOW (YEAH, FUCK JSON!)...WHICH I AM NOT...AT THE MOMENT.
                        //
                        // Sunday, September 11, 2022 0230 hrs.
                        // WE WILL WRAP THE PSSDTL WITH THE SSDTL. SO SOAP-WRAPPED PSSDTLP IS #WINNING.
                        // A CRNRSTN :: DATA PACKET IS AN ENCRYPTED JSON OBJECT WRAPPED IN A SOAP OBJECT. FUCK YEAH! JSON!
                        // CRNRSTN :: DATA PACKET IS A THING NOW.

                        //error_log(__LINE__ . ' ddo packet $data_key=[' . print_r($data_key, true) . ']. $index=[' . $index . ']. ttl_profile_ARRAY=[' . print_r($this->ttl_profile_ARRAY[$data_key], true) . '].');
                        //error_log(__LINE__ . ' ddo packet TYPE=[' . $this->data_type_ARRAY[$data_key][$index] . '] BYTES=[' . $tmp_resource_bytes . '] TTL=[' . $this->oCRNRSTN->return_clean_json_string($this->ttl_profile_ARRAY[$data_key][$index]) . '] AUTH_PROFILE=[' . $this->oCRNRSTN->return_clean_json_string($this->data_authorization_profile_ARRAY[$data_key][$index]) . ']');

                        if(is_array($data_key)){

                            // WE DO NOT PASS DATA VALUE (OR SENSITIVE META ABOUT VALUE) TO CLIENT...IF ANYTHING SAVE PSSDTLP.
                            // AND I IMAGINE THE SAME KIND OF RULES WOULD APPLY TO SSDTLP
                            if(isset($this->data_value_ARRAY[$data_key[0]][$index])){

                                $tmp_val = $this->data_value_ARRAY[$data_key[0]][$index];
                                $tmp_resource_bytes = strlen($tmp_val);

                            }

                            $tmp_str_out .= '
{
    "SALT"
    "HASH" : "' . $this->oCRNRSTN->hash($data_key[0] . $this->oCRNRSTN->hash($this->data_value_ARRAY[$data_key[0]][$index], 'md5') . $this->data_type_ARRAY[$data_key[0]][$index], 'md5') . '",
    "BYTES" : ' . $tmp_resource_bytes . ',
    "KEY" : ' . $this->oCRNRSTN->return_clean_json_string($data_key[0]) . ',
    "TYPE" : "' . $this->data_type_ARRAY[$data_key[0]][$index] . '",
    "VALUE" : ' . $this->oCRNRSTN->return_clean_json_string($tmp_val) . ',
    "TTL" : ' . $this->oCRNRSTN->return_clean_json_string($this->ttl_profile_ARRAY[$data_key[0]][$index]) . ',
    "AUTH_PROFILE" : ' . $this->oCRNRSTN->return_clean_json_string($this->data_authorization_profile_ARRAY[$data_key[0]][$index]) . '
},';

                        }else{

                            // WE DO NOT PASS DATA VALUE (OR SENSITIVE META ABOUT VALUE) TO CLIENT...IF ANYTHING SAVE PSSDTLP.
                            // AND I IMAGINE THE SAME KIND OF RULES WOULD APPLY TO SSDTLP
                            if(isset($this->data_value_ARRAY[$data_key][$index])){

                                $tmp_val = $this->data_value_ARRAY[$data_key][$index];
                                $tmp_resource_bytes = strlen($tmp_val);

                            }

                            if(!isset($this->data_value_ARRAY[$data_key][$index])){

                                // TODO :: GET THESE ISSET CHECKS OUT OF HERE. WE ARE MISSING A USE CASE.
                                //error_log(__LINE__ . ' ddo env data_value_ARRAY not set.');
                                $this->data_value_ARRAY[$data_key][$index] = '';
                                $this->ttl_profile_ARRAY[$data_key][$index] = 60;
                                //$this->data_authorization_profile_ARRAY[$data_key][$index] = CRNRSTN_CHANNEL_FORM_INTEGRATIONS;
                                $this->data_authorization_profile_ARRAY[$data_key][$index] = CRNRSTN_CHANNEL_SSDTLA;

                            }

                            if(!isset($this->data_type_ARRAY[$data_key][$index])){

                                //error_log(__LINE__ . ' ddo env data_type_ARRAY not set.');
                                $this->data_type_ARRAY[$data_key][$index] = CRNRSTN_STRING;         // PREVIOUSLY 'string';

                            }

                            //error_log(__LINE__.  ' ddo env $data_key=[' . $data_key . ']. $tmp_resource_bytes=[' . $tmp_resource_bytes . ']. $index=[' . $index . '].');
                            $tmp_str_out .= '
{
    "HASH" : "' . $this->oCRNRSTN->hash($data_key . $this->oCRNRSTN->hash($this->data_value_ARRAY[$data_key][$index], 'md5') . $this->data_type_ARRAY[$data_key][$index], 'md5') . '",
    "BYTES" : ' . $tmp_resource_bytes . ',
    "KEY" : ' . $this->oCRNRSTN->return_clean_json_string($data_key) . ',
    "TYPE" : "' . $this->data_type_ARRAY[$data_key][$index] . '",
    "VALUE" : ' . $this->oCRNRSTN->return_clean_json_string($tmp_val) . ',
    "TTL" : ' . $this->oCRNRSTN->return_clean_json_string($this->ttl_profile_ARRAY[$data_key][$index]) . ',
    "AUTH_PROFILE" : ' . $this->oCRNRSTN->return_clean_json_string($this->data_authorization_profile_ARRAY[$data_key][$index]) . '
},';

                        }

                        //error_log(__LINE__ . ' ddo type=[' . $this->data_type_ARRAY[$data_key][$index] . '].');

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

                        return $this->data_authorization_profile_ARRAY[$data_key][$index];

                    break;
                    case 'type':

                        return $this->data_type_ARRAY[$data_key][$index];

                    break;
                    case 'data_value':

                        //if($data_key == '1832337717::2678415634::404079999::version_php'){
                        //if($data_key == '54ab03abbade5b942a9f6c3d946daf4e0ee761eba9e525ab12adb3959d626576::share_component_is_active'){
                        //if($data_key == '6780e3fb74e6d79e416ede7df352e02400fe55271e3959ba0996cb47b525cac8db'){

                        //$this->oCRNRSTN->print_r('$data_key=[' . $data_key . ']. $index=[' . $index . '].', NULL, NULL, __LINE__, __METHOD__, __FILE__);
                        //error_log(__LINE__ . ' env DDO::' . __METHOD__ . '() $data_key=[' . $data_key . ']. $index=[' . $index . '].');
                        //}

                        if(isset($this->data_value_ARRAY[$data_key][$index])){

                            //
                            //'CRNRSTN_STRING','CRNRSTN_INT', 'CRNRSTN_INTEGER', 'CRNRSTN_BOOL',
                            //'CRNRSTN_BOOLEAN','CRNRSTN_FLOAT', 'CRNRSTN_DOUBLE', 'CRNRSTN_ARRAY',
                            //'CRNRSTN_OBJECT', 'CRNRSTN_RESOURCE',
                            //'CRNRSTN_RESOURCE_CLOSED', 'CRNRSTN_UNKNOWN_TYPE', 'CRNRSTN_NULL',
                            //
                            //$tmp_data_type_ARRAY = $this->gettype($url, CRNRSTN_ARRAY);
                            //switch($tmp_data_type_ARRAY[CRNRSTN_INTEGER]){}
                            //
                            error_log(__LINE__ . ' ddo CHECK THAT THIS IS INTEGER OUTPUT PROCESSING OF CRNRSTN :: DDO DATA. TYPE[' . strval($this->data_value_ARRAY[$data_key][$index]) . ']. die();');
                            die();

                            switch($this->data_type_ARRAY[$data_key][$index]){
                                case CRNRSTN_INT:

                                    return (int) $this->data_value_ARRAY[$data_key][$index];

                                break;
                                case CRNRSTN_INTEGER:

                                    return (integer) $this->data_value_ARRAY[$data_key][$index];

                                break;
                                case CRNRSTN_BOOL:

                                    if($data_authorization_profile == CRNRSTN_CHANNEL_SOAP){

                                        return $this->data_value_ARRAY[$data_key][$index];

                                    }else{

                                        return $this->oCRNRSTN->boolean_conversion($this->data_value_ARRAY[$data_key][$index]);

                                    }

                                break;
                                case CRNRSTN_BOOLEAN:

                                    if($data_authorization_profile == CRNRSTN_CHANNEL_SOAP){

                                        return $this->data_value_ARRAY[$data_key][$index];

                                    }else{

                                        return $this->oCRNRSTN->boolean_conversion($this->data_value_ARRAY[$data_key][$index]);

                                    }

                                break;
                                case CRNRSTN_FLOAT:

                                    return (float) $this->data_value_ARRAY[$data_key][$index];

                                break;
                                case CRNRSTN_DOUBLE:

                                    return (double) $this->data_value_ARRAY[$data_key][$index];

                                break;
                                case CRNRSTN_RESOURCE:
                                    //case 'real':
                                    //return (float) $this->data_value_ARRAY[$data_key][$index];
                                    return $this->data_value_ARRAY[$data_key][$index];

                                break;
                                case CRNRSTN_RESOURCE_CLOSED:
                                    //case 'real':
                                    //return (float) $this->data_value_ARRAY[$data_key][$index];
                                    return $this->data_value_ARRAY[$data_key][$index];

                                break;
                                case CRNRSTN_STRING:

                                    return (string) $this->data_value_ARRAY[$data_key][$index];

                                break;
                                case CRNRSTN_ARRAY:

                                    return (array) $this->data_value_ARRAY[$data_key][$index];

                                break;
                                case CRNRSTN_OBJECT:

                                    return (object) $this->data_value_ARRAY[$data_key][$index];

                                break;
                                case CRNRSTN_NULL:

                                    return NULL;

                                break;
                                default:
                                    //CRNRSTN_UNKNOWN_TYPE

                                    //error_log(__LINE__ .' env ddo - RETURN DEFAULT ['.$data_key.']');
                                    return $this->data_value_ARRAY[$data_key][$index];

                                break;

                            }

                        }else{

                            //
                            // TODO :: SHOULD THIS RETURN SOMETHING TIED TO THE SESSION FOR PROPER
                            // TODO :: DETERMINATION OF "NO DATA TO RETURN"
                            // BOOLEAN FALSE WILL RETURN (string) 'false'
                            //error_log(__LINE__ .' env ddo - return false... NOT SET [' . $data_key . ']');
                            //return false;
                            return $this->oCRNRSTN->session_salt('NO_MATCH');

                        }

                    break;
                    default:

                        //error_log(__LINE__ .' env ddo - RETURN DEFAULT VALUE ['.$data_key.']');
                        return $this->data_value_ARRAY[$data_key][$index];

                    break;

                }

            break;

        }

        return false;

    }

    public function add($data_value, $data_key = NULL, $data_type_family = 'CRNRSTN::RESOURCE', $index = NULL, $data_authorization_profile = CRNRSTN_AUTHORIZE_RUNTIME, $ttl = 60, $spool_resource = false, $env_key = CRNRSTN_RESOURCE_ALL){

        if(isset($env_key)){

            if(strlen((string) $env_key) < 1){

                $env_key = CRNRSTN_RESOURCE_ALL;

            }

        }else{

            $env_key = CRNRSTN_RESOURCE_ALL;

        }

//        if($data_key == '54ab03abbade5b942a9f6c3d946daf4e0ee761eba9e525ab12adb3959d626576::share_component_is_active'){
//
//            $this->oCRNRSTN->print_r('$data_value=[' . $data_value . ']. $data_key=[' . $data_key . ']. $index=[' . $index . '].', NULL, NULL, __LINE__, __METHOD__, __FILE__);
//
//            $tmp_array = array();
//            $tmp_array[] = '12345';
//            $tmp = strlen($tmp_array);
//
//            die();
//
//        }

        //
        // HASH THE INPUT TO CREATE A CRNRSTN :: DDO ADDRESS FOR
        // (OR MULTI-DIMENSIONAL POINTER TO) THE CACHE STORAGE
        // LOCATION IN MEMORY.
        $tmp_ddo_memory_pointer = $this->oCRNRSTN->hash_ddo_memory_pointer($data_key, $data_type_family, $env_key);
        //error_log(__LINE__ . ' crnrstn $tmp_ddo_memory_pointer[' . print_r($tmp_ddo_memory_pointer, true) . ']. $index[' . $index . '].');

        //
        // INITIALIZE CACHE HEADER FOR RESOURCE.
        // BYTES WILL BE SET TO ZERO.
        $tmp_channel_res_counts_ARRAY = $this->oCRNRSTN->init_config_cache_index_mem_header($tmp_ddo_memory_pointer, $index, $data_authorization_profile, $ttl);
        //error_log(__LINE__ . ' env ddo HEADER WRITTEN $data_key[' . $data_key . ']. $tmp_ddo_memory_pointer[' . $tmp_ddo_memory_pointer . ']. $index[' . $index . ']. $data_authorization_profile[' . $data_authorization_profile . ']. $ttl[' . $ttl . ']. $tmp_channel_res_counts_ARRAY[' . print_r($tmp_channel_res_counts_ARRAY, true) . '].');

        //error_log(__LINE__ . ' env DDO NEED COUNTS FOR INDEX CONTROL FOR <META> LOOP OUT. [' . print_r($tmp_channel_res_counts_ARRAY, true) . '].');
        //error_log(__LINE__ . ' env  PROCEED TO WRITE data_value[' . print_r($data_value, true) . ']. $data_type_family[' . $data_type_family . ']. die();');

        if(!isset($tmp_ddo_memory_pointer)){

            $tmp_ddo_memory_pointer = '';

        }

        //
        // PROCESS DATA TYPE.
        if(!isset($this->data_type)){

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

            //$data_type = strtolower(gettype($data_value));
            $tmp_data_type_ARRAY = $this->oCRNRSTN->gettype($data_value, CRNRSTN_ARRAY);

        }else{

            $tmp_data_type_ARRAY = $this->data_type;

        }

        $this->oCRNRSTN->config_cache_data_write('data_authorization_profile', $data_authorization_profile, $tmp_ddo_memory_pointer, $data_type_family, $index, $data_authorization_profile);
        $this->oCRNRSTN->config_cache_data_write('data_type', $tmp_data_type_ARRAY[CRNRSTN_INTEGER], $tmp_ddo_memory_pointer, $data_type_family, $index, $data_authorization_profile);
        $this->oCRNRSTN->config_cache_data_write('data_flag', 1, $tmp_ddo_memory_pointer, $data_type_family, $index, $data_authorization_profile);
        $this->oCRNRSTN->config_cache_data_write('ttl_profile', $ttl, $tmp_ddo_memory_pointer, $data_type_family, $index, $data_authorization_profile);

        //error_log(__LINE__ . ' env CHECK WRITE OF $data_value[' . print_r($data_value, true) . ']. $tmp_ddo_memory_pointer[' . $tmp_ddo_memory_pointer . ']. $index_type[' . gettype($index) . ']. $data_type[' . gettype($data_value) . ']. $index[' . $index. ']<-- $index SHOULD BE NULL FOR WRITES...RIGHT?');
        //die();

        //
        // PROCESS DATA_VALUE
        switch($tmp_data_type_ARRAY[CRNRSTN_INTEGER]){
            case CRNRSTN_INT:

                $this->oCRNRSTN->config_cache_data_write('data_value', (int) $data_value, $tmp_ddo_memory_pointer, $data_type_family, $index, $data_authorization_profile);

            break;
            case CRNRSTN_INTEGER:

                $this->oCRNRSTN->config_cache_data_write('data_value', (integer) $data_value, $tmp_ddo_memory_pointer, $data_type_family, $index, $data_authorization_profile);

            break;
            case CRNRSTN_BOOL:
            case CRNRSTN_BOOLEAN:

                //error_log(__LINE__ . '  env DDO->ADD BOOL $data_value[' . print_r($data_value, true) . ']. $tmp_ddo_memory_pointer[' . $tmp_ddo_memory_pointer . '].');

                //
                // IS THIS A  BOOLEAN?
                if(is_bool($data_value) === true){

                    if($data_value == true){

                        $this->oCRNRSTN->config_cache_data_write('data_value', 1, $tmp_ddo_memory_pointer, $data_type_family, $index, $data_authorization_profile);

                    }else{

                        $this->oCRNRSTN->config_cache_data_write('data_value', 0, $tmp_ddo_memory_pointer, $data_type_family, $index, $data_authorization_profile);

                    }

                }else{

                    if(boolval($data_value)){

                        $this->oCRNRSTN->config_cache_data_write('data_value', 1, $tmp_ddo_memory_pointer, $data_type_family, $index, $data_authorization_profile);

                    }else{

                        $this->oCRNRSTN->config_cache_data_write('data_value', 0, $tmp_ddo_memory_pointer, $data_type_family, $index, $data_authorization_profile);

                    }

                }

            break;
            case CRNRSTN_DOUBLE:

                $this->oCRNRSTN->config_cache_data_write('data_value', (double) $data_value, $tmp_ddo_memory_pointer, $data_type_family, $index, $data_authorization_profile);

            break;
            case CRNRSTN_STRING:

                $this->oCRNRSTN->config_cache_data_write('data_value', (string) $data_value, $tmp_ddo_memory_pointer, $data_type_family, $index, $data_authorization_profile);

            break;
            case CRNRSTN_ARRAY:

                $this->oCRNRSTN->config_cache_data_write('data_value', (array) $data_value, $tmp_ddo_memory_pointer, $data_type_family, $index, $data_authorization_profile);

            break;
            case CRNRSTN_OBJECT:

                $this->oCRNRSTN->config_cache_data_write('data_value', $data_value, $tmp_ddo_memory_pointer, $data_type_family, $index, $data_authorization_profile);

            break;
            case CRNRSTN_RESOURCE:

                $this->oCRNRSTN->config_cache_data_write('data_value', $data_value, $tmp_ddo_memory_pointer, $data_type_family, $index, $data_authorization_profile);

            break;
            case CRNRSTN_RESOURCE_CLOSED:

                $this->oCRNRSTN->config_cache_data_write('data_value', $data_value, $tmp_ddo_memory_pointer, $data_type_family, $index, $data_authorization_profile);

            break;
            case CRNRSTN_NULL:

                $this->oCRNRSTN->config_cache_data_write('data_value', NULL, $tmp_ddo_memory_pointer, $data_type_family, $index, $data_authorization_profile);

            break;
            case CRNRSTN_UNKNOWN_TYPE:
            default:

                $this->oCRNRSTN->config_cache_data_write('data_value', $data_value, $tmp_ddo_memory_pointer, $data_type_family, $index, $data_authorization_profile);

            break;

        }

        /*
        [Wed May 17 04:05:11.437765 2023] [:error] [pid 16410] [client 172.16.225.1:52507]
        9064 env cache_storage_report[
        START_SESSION::Array\n(\n
            [CRNRSTN_CONFIG_SERIAL_HASH] => 7d6721f110ebfb51e1475b32b3487852b118aa66676e6d2b107b27660bb037c8\n)\n

        START_RUNTIME::Array\n(\n
            [zRUMLdoedhCmzsuQx2r18tFUSZLspTMiUbqeEdP50mWU8ZfcRuM1K2WQzL4neP6k] => Array\n        (\n
                [cache_id] => Array\n               (\n                    [9d031eca44394c370f3c33aba8852100d66b64289c57145a012cac4ccb7c7bac::starttime] => 0\n                )\n\n
                [ttl] => Array\n                    (\n                    [0] => 1684310771\n                  )\n\n
                [datecreated] => Array\n            (\n                    [0] => 1684310711\n                  )\n\n
                [lastmodified] => Array\n           (\n                    [0] => 1684310711\n                  )\n\n
                [ipaddress_id] => Array\n           (\n                    [172.16.225.1] => 0\n                )\n\n
                [resource_bytes] => Array\n         (\n                    [0] => 100\n                         )\n\n
                [asset_family] => Array\n           (\n                    [0] => DDO\n                         )\n\n
                [createdby_client_ip] => Array\n    (\n                    [0] => 0\n                           )\n\n
                [modifiedby_client_ip] => Array\n   (\n                    [0] => 0\n                           )\n\n
                [data_authorization_profile] => Array\n      (\n                    [0] => \n                            )\n\n
                [data_type] => Array\n              (\n                    [0] => double\n                      )\n\n
                [data_flag] => Array\n              (\n                    [0] => 1\n                           )\n\n
                [ttl_profile] => Array\n            (\n                    [0] => 60\n                          )\n\n
                [data_value] => Array\n             (\n                    [0] => 1684310711.357\n              )\n\n
            )\n\n)\n].

        [Fri May 19 07:58:00.328370 2023] [:error] [pid 9049] [client 172.16.225.1:51517] 9064 env
        cache_storage_report[
        START_SESSION::Array\n(\n
            [channel_bytes] => Array\n        (\n
                [session] => 3594\n        )\n\n
            [DDO] => Array\n        (\n
                [cache_id] => Array\n                (\n
                    [59fefbb95c547197dd822372a9ff8625063af9b35e34126e4397baade8606f3e::default_multi_channel_data_authorization_profile] => 0\n
                    [6bf40e7f1943cde6d6d143290590e416159d764feca0456b7fd867e5a9ff6312::crnrstn_http_endpoint] => 2\n                )\n\n
                [resource_bytes] => Array\n                (\n
                    [0] => 270\n
                    [1] => 0\n
                    [2] => 0\n                )\n\n
                [asset_family] => Array\n                (\n
                    [0] => Array\n                        (\n
                            [0] => DDO\n                        )\n\n                )\n\n
                [createdby_client_ip] => Array\n                (\n
                    [0] => 1\n                )\n\n
                [modifiedby_client_ip] => Array\n                (\n
                    [0] => 1\n                )\n\n
                [data_authorization_profile] => Array\n                (\n
                    [0] => Array\n                        (\n
                        [0] => 8083\n                        )\n\n                )\n\n
                [data_type] => Array\n                (\n
                    [0] => Array\n                        (\n
                        [0] => integer\n                        )\n\n                )\n\n
                [data_flag] => Array\n                (\n
                    [0] => Array\n                        (\n
                        [0] => 1\n                        )\n\n                )\n\n
                [ttl_profile] => Array\n                (\n
                    [0] => Array\n                        (\n
                        [0] => 60\n                        )\n\n                )\n\n
                [data_value] => Array\n                (\n
                    [0] => Array\n                        (\n
                        [0] => 8083\n                        )\n\n                )\n\n
                [ttl] => Array\n                (\n
                    [1] => 1684497409\n
                    [2] => 1684497443\n                )\n\n
                [datecreated] => Array\n                (\n
                    [1] => 1684497349\n
                    [2] => 1684497383\n                )\n\n
                [lastmodified] => Array\n                (\n
                    [1] => 1684497349\n
                    [2] => 1684497383\n                )\n\n
                [ipaddress_id] => Array\n                (\n
                    [172.16.225.1] => 1\n                )\n\n        )\n\n)\n

            START_RUNTIME::Array\n(\n    [jw6aYpJUSoAXOvJuDYzKUNdSUWsThODYhkBbBI7Q0G7mAxiR34yBpGWESVda4wE8] =>
            Array\n        (\n
                [cache_id] => Array\n                (\n
                    [5455188e7c94311801af49dea3a37c73c2c633a258092a9826e1e6ffb0754c84::starttime] => 0\n
                    [5455188e7c94311801af49dea3a37c73c2c633a258092a9826e1e6ffb0754c84::version_crnrstn] => 1\n
                    [5455188e7c94311801af49dea3a37c73c2c633a258092a9826e1e6ffb0754c84::CRNRSTN_debug_mode] => 2\n
                    [5455188e7c94311801af49dea3a37c73c2c633a258092a9826e1e6ffb0754c84::PHPMAILER_debug_mode] => 3\n
                    [5455188e7c94311801af49dea3a37c73c2c633a258092a9826e1e6ffb0754c84::version_apache_sysimg] => 4\n
                    [5455188e7c94311801af49dea3a37c73c2c633a258092a9826e1e6ffb0754c84::version_apache] => 5\n
                    [5455188e7c94311801af49dea3a37c73c2c633a258092a9826e1e6ffb0754c84::version_php] => 6\n
                    [5455188e7c94311801af49dea3a37c73c2c633a258092a9826e1e6ffb0754c84::version_openssl] => 7\n
                    [5455188e7c94311801af49dea3a37c73c2c633a258092a9826e1e6ffb0754c84::version_linux] => 8\n
                    [5455188e7c94311801af49dea3a37c73c2c633a258092a9826e1e6ffb0754c84::openssl_preferred_digest] => 9\n
                    [59fefbb95c547197dd822372a9ff8625063af9b35e34126e4397baade8606f3e::default_multi_channel_data_authorization_profile] => 10\n                )\n\n
                [resource_bytes] => Array\n                (\n
                    [0] => 108\n
                    [1] => 80\n
                    [2] => 54\n
                    [3] => 30\n
                    [4] => 0\n
                    [5] => 0\n
                    [6] => 0\n
                    [7] => 0\n
                    [8] => 0\n
                    [9] => 0\n
                    [10] => 90\n                )\n\n
                [ttl] => Array\n                (\n
                    [0] => 1684497540\n
                    [1] => 1684497540\n
                    [2] => 1684497540\n
                    [3] => 1684497540\n
                    [4] => 1684497540\n
                    [5] => 1684497540\n
                    [6] => 1684497540\n
                    [7] => 1684497540\n
                    [8] => 1684497540\n
                    [9] => 1684497540\n
                    [10] => 1684497540\n                )\n\n
                [datecreated] => Array\n                (\n
                    [0] => 1684497480\n
                    [1] => 1684497480\n
                    [2] => 1684497480\n
                    [3] => 1684497480\n
                    [4] => 1684497480\n
                    [5] => 1684497480\n
                    [6] => 1684497480\n
                    [7] => 1684497480\n
                    [8] => 1684497480\n
                    [9] => 1684497480\n
                    [10] => 1684497480\n                )\n\n
                [lastmodified] => Array\n                (\n
                    [0] => 1684497480\n
                    [1] => 1684497480\n
                    [2] => 1684497480\n
                    [3] => 1684497480\n
                    [4] => 1684497480\n
                    [5] => 1684497480\n
                    [6] => 1684497480\n
                    [7] => 1684497480\n
                    [8] => 1684497480\n
                    [9] => 1684497480\n
                    [10] => 1684497480\n                )\n\n
                [ipaddress_id] => Array\n                (\n
                    [172.16.225.1] => 0\n                )\n\n
                [channel_bytes] => Array\n                (\n
                    [runtime] => 1476\n                )\n\n
                [asset_family] => Array\n                (\n
                    [0] => Array\n                        (\n
                        [0] => DDO\n                        )\n\n
                    [1] => Array\n                        (\n
                        [0] => DDO\n                        )\n\n
                    [2] => Array\n                        (\n
                        [0] => DDO\n                        )\n\n
                    [3] => Array\n                        (\n
                        [0] => DDO\n                        )\n\n
                    [10] => Array\n                        (\n
                        [0] => DDO\n                        )\n\n                )\n\n
                [createdby_client_ip] => Array\n                (\n
                    [0] => 0\n
                    [1] => 0\n
                    [2] => 0\n
                    [3] => 0\n
                    [10] => 0\n                )\n\n
                [modifiedby_client_ip] => Array\n                (\n
                    [0] => 0\n
                    [1] => 0\n
                    [2] => 0\n
                    [10] => 0\n                )\n\n
                [data_authorization_profile] => Array\n                (\n
                    [0] => Array\n                        (\n
                        [0] => 8083\n                        )\n\n
                    [1] => Array\n                        (\n
                        [0] => 8083\n                        )\n\n
                    [10] => Array\n                        (\n
                        [0] => 8083\n                        )\n\n                )\n\n
                [data_type] => Array\n                (\n
                    [0] => Array\n                        (\n
                        [0] => double\

        */

        return $tmp_ddo_memory_pointer;

    }

    private function isset_resource($data_attribute, $ddo_memory_pointer, $channel, $index){

        return $this->oCRNRSTN->isset_resource($data_attribute, NULL, NULL, $channel, $index, $ddo_memory_pointer);
        //return $this->oCRNRSTN->oCRNRSTN_RRS_MAP->isset_config_cache($data_attribute, $ddo_memory_pointer, $channel, $index);

    }

    /**
     * Check "Booleanic" Conditions :) LOL...MORE LIKE "NERD"-eanic...imho...
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

            if(!isset($variable)) return null;
            return filter_var($variable, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        }else{

            if(!isset($this->attribute_value)) return null;
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

                    foreach(self::$system_resource_constants_ARRAY as $key => $integer_const){

                        //
                        // IF BIT IS SET, ADD TO SOAP OBJECT
                        if($this->oCRNRSTN_USR->is_serialized_bit_set('CRNRSTN_CLIENT_SOAP_PERMS_REQUESTED', $integer_const) == true){

                            error_log(__LINE__ . ' env ddo A SET GO TO SOAP $integer_const=' . $integer_const);

                        }

                    }

                }else{

                    foreach(self::$system_resource_constants_ARRAY as $key => $integer_const){

                        //
                        // IF BIT IS SET, ADD TO SOAP OBJECT
                        if($this->oCRNRSTN->is_serialized_bit_set('CRNRSTN_CLIENT_SOAP_PERMS_REQUESTED', $integer_const) == true){

                            error_log(__LINE__ . ' env ddo A SET GO TO SOAP $integer_const=' . $integer_const);

                        }

                    }

                }

            break;
            case 'tunnelEncryptCalibrationRequest':

                $tmp_SOAP_ENCRYPT_CIPHER = $this->preach('data_value', 'SOAP_ENCRYPT_CIPHER');
                $tmp_SOAP_ENCRYPT_HMAC_ALG = $this->preach('data_value', 'SOAP_ENCRYPT_HMAC_ALG');
                $tmp_SOAP_ENCRYPT_OPTIONS = $this->preach('data_value', 'SOAP_ENCRYPT_OPTIONS');

                if(isset($this->oCRNRSTN_USR)){

                    $this->soap_encrypt_secret_key = $this->oCRNRSTN_USR->generate_new_key(42);

                }else{

                    $this->soap_encrypt_secret_key = $this->oCRNRSTN->salt(42);

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

                $tmp_SOAP_ENCRYPT_CIPHER = $this->preach('data_value', 'SOAP_ENCRYPT_CIPHER');
                $tmp_SOAP_ENCRYPT_SECRET_KEY = $this->soap_encrypt_secret_key;
                $tmp_SOAP_ENCRYPT_HMAC_ALG = $this->preach('data_value', 'SOAP_ENCRYPT_HMAC_ALG');
                $tmp_SOAP_ENCRYPT_OPTIONS = $this->preach('data_value', 'SOAP_ENCRYPT_OPTIONS');

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
                // $this->oCRNRSTN->print_r($tmp_SOAP_SVC_REQUESTED_RESOURCES,'SOAP CRNRSTN_CLIENT_SOAP_PERMS_REQUESTED TEST', NULL, __LINE__,__METHOD__,__FILE__);

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
                            'CRNRSTN_SOAP_SVC_PASSWORD' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->create_pwd_hash_for_storage($this->oCRNRSTN->hash($this->preach('data_value', 'CRNRSTN_SOAP_SVC_PASSWORD'), 'md5')), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $this->soap_encrypt_secret_key, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp),
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
                            'CRNRSTN_SOAP_SVC_PASSWORD' => $this->oCRNRSTN->data_encrypt($this->oCRNRSTN->create_pwd_hash_for_storage($this->oCRNRSTN->hash($this->preach('data_value', 'CRNRSTN_SOAP_SVC_PASSWORD'), 'md5')), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $this->soap_encrypt_secret_key, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp),
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
                $tmp_SOAP_ENCRYPT_SECRET_KEY = $this->oCRNRSTN->hash($this->preach('data_value', 'CRNRSTN_SOAP_SVC_ENCRYPTION_KEY'), 'md5');
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

                $tmp_SOAP_ENCRYPT_SECRET_KEY_resp = $this->preach('data_value', 'SOAP_ENCRYPT_SECRET_KEY_CONNECTION');

                if($tmp_SOAP_ENCRYPT_SECRET_KEY_resp == ''){

                    //
                    // IF CLIENT HAS NO PERSONAL SECRET KEY...ATTEMPT TO FALL BACK ON ENVIRONMENT SECRET KEY.
                    $tmp_SOAP_ENCRYPT_CIPHER_resp = $this->soap_encrypt_cipher;
                    $tmp_SOAP_ENCRYPT_SECRET_KEY_resp = $this->oCRNRSTN->hash($this->preach('data_value', 'CRNRSTN_SOAP_SVC_ENCRYPTION_KEY'), 'md5');
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

                        $this->oCRNRSTN_USR->print_r($SOAP_request, 'CLIENT REQUEST ASSEMBLY TEST (' . $tmp_curr . ' of ' . $tmp_recipient_email_cnt . '[tmp_recipient_email_cnt]) - KING\'S HIGHWAY ::', NULL, __LINE__, __METHOD__, __FILE__);

                        if($this->preach('isset', 'CRNRSTN_SOAP_SVC_AUTH_KEY') == true){

                            error_log(__LINE__ . ' env ddo - encrypt CRNRSTN_SOAP_SVC_AUTH_KEY for oKingsHighwayNotification [' . $tmp_SOAP_ENCRYPT_CIPHER_resp . '][' . $tmp_SOAP_ENCRYPT_SECRET_KEY_resp . '][' . $tmp_SOAP_ENCRYPT_HMAC_ALG_resp . '][' . $tmp_SOAP_ENCRYPT_OPTIONS_resp . ']');
                            $SOAP_request['oKingsHighwayNotification']['CRNRSTN_SOAP_SVC_AUTH_KEY'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'CRNRSTN_SOAP_SVC_AUTH_KEY', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'CRNRSTN_SOAP_SVC_USERNAME') == true){

                            error_log(__LINE__ . ' env ddo - encrypt username for oKingsHighwayNotification [' . $tmp_SOAP_ENCRYPT_CIPHER . '][' . $tmp_SOAP_ENCRYPT_SECRET_KEY . '][' . $tmp_SOAP_ENCRYPT_HMAC_ALG . '][' . $tmp_SOAP_ENCRYPT_OPTIONS . ']');
                            $SOAP_request['oKingsHighwayNotification']['CRNRSTN_SOAP_SVC_USERNAME'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'CRNRSTN_SOAP_SVC_USERNAME', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                        }

                        if($this->preach('isset', 'CRNRSTN_SOAP_SVC_PASSWORD') == true){

                            $SOAP_request['oKingsHighwayNotification']['CRNRSTN_SOAP_SVC_PASSWORD'] = $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->create_pwd_hash_for_storage($this->oCRNRSTN->hash($this->preach('data_value', 'CRNRSTN_SOAP_SVC_PASSWORD', true), 'md5')), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                        }

                        if($this->preach('isset', 'EMAIL_PROTOCOL') == true){

                            error_log(__LINE__ . ' env ddo - EMAIL_PROTOCOL');

                            $SOAP_request['oKingsHighwayNotification']['EMAIL_PROTOCOL']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'EMAIL_PROTOCOL', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['EMAIL_PROTOCOL']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'EMAIL_PROTOCOL', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'EMAIL_PROTOCOL', true));
                            $SOAP_request['oKingsHighwayNotification']['EMAIL_PROTOCOL']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_AUTH') == true){

                            error_log(__LINE__ .' env ddo - SMTP_AUTH');

                            $SOAP_request['oKingsHighwayNotification']['SMTP_AUTH']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'SMTP_AUTH', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_AUTH']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'SMTP_AUTH', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'SMTP_AUTH', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_AUTH']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_SERVER') == true){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_SERVER']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'SMTP_SERVER', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_SERVER']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'SMTP_SERVER', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'SMTP_SERVER', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_SERVER']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_PORT_OUTGOING') == true){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_PORT_OUTGOING']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'SMTP_PORT_OUTGOING', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_PORT_OUTGOING']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'SMTP_PORT_OUTGOING', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'SMTP_PORT_OUTGOING', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_PORT_OUTGOING']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_USERNAME') == true){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_USERNAME']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'SMTP_USERNAME', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_USERNAME']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'SMTP_USERNAME', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'SMTP_USERNAME', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_USERNAME']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_PASSWORD') == true){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_PASSWORD']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'SMTP_PASSWORD', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_PASSWORD']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'SMTP_PASSWORD', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'SMTP_PASSWORD', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_PASSWORD']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_KEEPALIVE') == true){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_KEEPALIVE']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'SMTP_KEEPALIVE', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_KEEPALIVE']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'SMTP_KEEPALIVE', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'SMTP_KEEPALIVE', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_KEEPALIVE']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_SECURE') == true){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_SECURE']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'SMTP_SECURE', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_SECURE']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'SMTP_SECURE', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'SMTP_SECURE', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_SECURE']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_AUTOTLS') == true){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_AUTOTLS']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'SMTP_AUTOTLS', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_AUTOTLS']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'SMTP_AUTOTLS', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'SMTP_AUTOTLS', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_AUTOTLS']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_TIMEOUT') == true){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_TIMEOUT']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'SMTP_TIMEOUT', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_TIMEOUT']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'SMTP_TIMEOUT', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'SMTP_TIMEOUT', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_TIMEOUT']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'DIBYA_SAHOO_SSL_CERT_BYPASS') == true){

                            $SOAP_request['oKingsHighwayNotification']['DIBYA_SAHOO_SSL_CERT_BYPASS']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'DIBYA_SAHOO_SSL_CERT_BYPASS', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['DIBYA_SAHOO_SSL_CERT_BYPASS']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'DIBYA_SAHOO_SSL_CERT_BYPASS', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'DIBYA_SAHOO_SSL_CERT_BYPASS', true));
                            $SOAP_request['oKingsHighwayNotification']['DIBYA_SAHOO_SSL_CERT_BYPASS']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'DUP_SUPPRESS') == true){

                            $SOAP_request['oKingsHighwayNotification']['DUP_SUPPRESS']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'DUP_SUPPRESS', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['DUP_SUPPRESS']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'DUP_SUPPRESS', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'DUP_SUPPRESS', true));
                            $SOAP_request['oKingsHighwayNotification']['DUP_SUPPRESS']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'CHARSET') == true){

                            $SOAP_request['oKingsHighwayNotification']['CHARSET']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'CHARSET', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['CHARSET']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'CHARSET', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'CHARSET', true));
                            $SOAP_request['oKingsHighwayNotification']['CHARSET']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'MESSAGE_ENCODING') == true){

                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_ENCODING']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'MESSAGE_ENCODING', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_ENCODING']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'MESSAGE_ENCODING', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'MESSAGE_ENCODING', true));
                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_ENCODING']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'ALLOW_EMPTY') == true){

                            $SOAP_request['oKingsHighwayNotification']['ALLOW_EMPTY']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'ALLOW_EMPTY', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['ALLOW_EMPTY']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'ALLOW_EMPTY', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'ALLOW_EMPTY', true));
                            $SOAP_request['oKingsHighwayNotification']['ALLOW_EMPTY']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'TRY_OTHER_EMAIL_METHODS_ON_ERR') == true){

                            $SOAP_request['oKingsHighwayNotification']['TRY_OTHER_EMAIL_METHODS_ON_ERR']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'TRY_OTHER_EMAIL_METHODS_ON_ERR', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['TRY_OTHER_EMAIL_METHODS_ON_ERR']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'TRY_OTHER_EMAIL_METHODS_ON_ERR', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'TRY_OTHER_EMAIL_METHODS_ON_ERR', true));
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

                        if($this->preach('isset', 'CRNRSTN_SOAP_SVC_AUTH_KEY') == true){

                            error_log(__LINE__ . ' env ddo - encrypt CRNRSTN_SOAP_SVC_AUTH_KEY for oKingsHighwayNotification [' . $tmp_SOAP_ENCRYPT_CIPHER_resp . '][' . $tmp_SOAP_ENCRYPT_SECRET_KEY_resp . '][' . $tmp_SOAP_ENCRYPT_HMAC_ALG_resp . '][' . $tmp_SOAP_ENCRYPT_OPTIONS_resp . ']');
                            $SOAP_request['oKingsHighwayNotification']['CRNRSTN_SOAP_SVC_AUTH_KEY'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'CRNRSTN_SOAP_SVC_AUTH_KEY', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'CRNRSTN_SOAP_SVC_USERNAME') == true){

                            error_log(__LINE__ . ' env ddo - encrypt username for oKingsHighwayNotification [' . $tmp_SOAP_ENCRYPT_CIPHER . '][' . $tmp_SOAP_ENCRYPT_SECRET_KEY . '][' . $tmp_SOAP_ENCRYPT_HMAC_ALG . '][' . $tmp_SOAP_ENCRYPT_OPTIONS . ']');
                            $SOAP_request['oKingsHighwayNotification']['CRNRSTN_SOAP_SVC_USERNAME'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'CRNRSTN_SOAP_SVC_USERNAME', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                        }

                        if($this->preach('isset', 'CRNRSTN_SOAP_SVC_PASSWORD') == true){

                            $SOAP_request['oKingsHighwayNotification']['CRNRSTN_SOAP_SVC_PASSWORD'] = $this->oCRNRSTN->data_encrypt($this->oCRNRSTN->create_pwd_hash_for_storage($this->oCRNRSTN->hash($this->preach('data_value', 'CRNRSTN_SOAP_SVC_PASSWORD', true), 'md5')), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                        }

                        if($this->preach('isset', 'EMAIL_PROTOCOL') == true){

                            error_log(__LINE__ . ' env ddo - EMAIL_PROTOCOL');

                            $SOAP_request['oKingsHighwayNotification']['EMAIL_PROTOCOL']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'EMAIL_PROTOCOL', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['EMAIL_PROTOCOL']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'EMAIL_PROTOCOL', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'EMAIL_PROTOCOL', true));
                            $SOAP_request['oKingsHighwayNotification']['EMAIL_PROTOCOL']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_AUTH') == true){

                            error_log(__LINE__ . ' env ddo - SMTP_AUTH');

                            $SOAP_request['oKingsHighwayNotification']['SMTP_AUTH']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'SMTP_AUTH', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_AUTH']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'SMTP_AUTH', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'SMTP_AUTH', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_AUTH']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_SERVER') == true){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_SERVER']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'SMTP_SERVER', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_SERVER']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'SMTP_SERVER', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'SMTP_SERVER', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_SERVER']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_PORT_OUTGOING') == true){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_PORT_OUTGOING']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'SMTP_PORT_OUTGOING', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_PORT_OUTGOING']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'SMTP_PORT_OUTGOING', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'SMTP_PORT_OUTGOING', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_PORT_OUTGOING']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_USERNAME') == true){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_USERNAME']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'SMTP_USERNAME', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_USERNAME']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'SMTP_USERNAME', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'SMTP_USERNAME', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_USERNAME']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_PASSWORD') == true){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_PASSWORD']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'SMTP_PASSWORD', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_PASSWORD']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'SMTP_PASSWORD', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'SMTP_PASSWORD', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_PASSWORD']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_KEEPALIVE') == true){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_KEEPALIVE']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'SMTP_KEEPALIVE', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_KEEPALIVE']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'SMTP_KEEPALIVE', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'SMTP_KEEPALIVE', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_KEEPALIVE']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_SECURE') == true){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_SECURE']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'SMTP_SECURE', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_SECURE']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'SMTP_SECURE', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'SMTP_SECURE', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_SECURE']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_AUTOTLS') == true){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_AUTOTLS']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'SMTP_AUTOTLS', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_AUTOTLS']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'SMTP_AUTOTLS', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'SMTP_AUTOTLS', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_AUTOTLS']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'SMTP_TIMEOUT') == true){

                            $SOAP_request['oKingsHighwayNotification']['SMTP_TIMEOUT']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'SMTP_TIMEOUT', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['SMTP_TIMEOUT']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'SMTP_TIMEOUT', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'SMTP_TIMEOUT', true));
                            $SOAP_request['oKingsHighwayNotification']['SMTP_TIMEOUT']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'DIBYA_SAHOO_SSL_CERT_BYPASS') == true){

                            $SOAP_request['oKingsHighwayNotification']['DIBYA_SAHOO_SSL_CERT_BYPASS']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'DIBYA_SAHOO_SSL_CERT_BYPASS', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['DIBYA_SAHOO_SSL_CERT_BYPASS']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'DIBYA_SAHOO_SSL_CERT_BYPASS', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'DIBYA_SAHOO_SSL_CERT_BYPASS', true));
                            $SOAP_request['oKingsHighwayNotification']['DIBYA_SAHOO_SSL_CERT_BYPASS']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'DUP_SUPPRESS') == true){

                            $SOAP_request['oKingsHighwayNotification']['DUP_SUPPRESS']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'DUP_SUPPRESS', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['DUP_SUPPRESS']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'DUP_SUPPRESS', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'DUP_SUPPRESS', true));
                            $SOAP_request['oKingsHighwayNotification']['DUP_SUPPRESS']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'CHARSET') == true){

                            $SOAP_request['oKingsHighwayNotification']['CHARSET']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'CHARSET', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['CHARSET']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'CHARSET', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'CHARSET', true));
                            $SOAP_request['oKingsHighwayNotification']['CHARSET']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'MESSAGE_ENCODING') == true){

                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_ENCODING']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'MESSAGE_ENCODING', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_ENCODING']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'MESSAGE_ENCODING', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'MESSAGE_ENCODING', true));
                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_ENCODING']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'ALLOW_EMPTY') == true){

                            $SOAP_request['oKingsHighwayNotification']['ALLOW_EMPTY']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'ALLOW_EMPTY', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['ALLOW_EMPTY']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'ALLOW_EMPTY', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'ALLOW_EMPTY', true));
                            $SOAP_request['oKingsHighwayNotification']['ALLOW_EMPTY']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'TRY_OTHER_EMAIL_METHODS_ON_ERR') == true){

                            $SOAP_request['oKingsHighwayNotification']['TRY_OTHER_EMAIL_METHODS_ON_ERR']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'TRY_OTHER_EMAIL_METHODS_ON_ERR', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['TRY_OTHER_EMAIL_METHODS_ON_ERR']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'TRY_OTHER_EMAIL_METHODS_ON_ERR', true), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'TRY_OTHER_EMAIL_METHODS_ON_ERR', true));
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

                    */

                    if(isset($this->oCRNRSTN_USR)){

                        // 'oRECIPIENT' => array( 'name' => 'oRECIPIENT', 'type' => 'tns:oEmailArray'),
                        if($this->preach('isset', 'RECIPIENT_EMAIL', $i) == true){

                            $tmp_md5_email = $this->oCRNRSTN->hash($this->preach('data_value', 'RECIPIENT_EMAIL', true, $i), 'md5');
                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['EMAIL_PROXY_SERIAL']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($tmp_md5_email, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['EMAIL_PROXY_SERIAL']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt(strlen($tmp_md5_email), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['EMAIL_PROXY_SERIAL']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt('string', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['EMAIL']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'RECIPIENT_EMAIL', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['EMAIL']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt(strlen($this->preach('data_value', 'RECIPIENT_EMAIL', true, $i)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['EMAIL']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'RECIPIENT_EMAIL', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['NAME']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'RECIPIENT_NAME', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['NAME']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt(strlen($this->preach('data_value', 'RECIPIENT_NAME', true, $i)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['NAME']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'RECIPIENT_NAME', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        // 'oSENDER' => array( 'name' => 'oSENDER', 'type' => 'tns:oEmailArray'),
                        if($this->preach('isset', 'FROM_EMAIL') == true){

                            $tmp_cnt = $this->count('FROM_EMAIL');

                            for($ii = 0; $ii < $tmp_cnt; $ii++){

                                $tmp_md5_email = $this->oCRNRSTN->hash($this->preach('data_value', 'FROM_EMAIL', true, $ii), 'md5');
                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['EMAIL_PROXY_SERIAL']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($tmp_md5_email, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['EMAIL_PROXY_SERIAL']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt(strlen($tmp_md5_email), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['EMAIL_PROXY_SERIAL']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt('string', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['EMAIL']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'FROM_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['EMAIL']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt(strlen($this->preach('data_value', 'FROM_EMAIL', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['EMAIL']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'FROM_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['NAME']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'FROM_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['NAME']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt(strlen($this->preach('data_value', 'FROM_NAME', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['NAME']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'FROM_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            }

                        }

                        // 'oREPLYTO' => array('name' => 'oREPLYTO', 'type' => 'tns:oEmailArray'),
                        if($this->preach('isset', 'REPLYTO_EMAIL') == true){

                            $tmp_cnt = $this->count('REPLYTO_EMAIL');

                            for($ii = 0; $ii < $tmp_cnt; $ii++){

                                $tmp_md5_email = $this->oCRNRSTN->hash($this->preach('data_value', 'REPLYTO_EMAIL', true, $ii), 'md5');
                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['EMAIL_PROXY_SERIAL']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($tmp_md5_email, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['EMAIL_PROXY_SERIAL']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt(strlen($tmp_md5_email), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['EMAIL_PROXY_SERIAL']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt('string', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['EMAIL']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'REPLYTO_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['EMAIL']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt(strlen($this->preach('data_value', 'REPLYTO_EMAIL', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['EMAIL']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'REPLYTO_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['NAME']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'REPLYTO_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['NAME']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt(strlen($this->preach('data_value', 'REPLYTO_NAME', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['NAME']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'REPLYTO_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            }

                        }

                        // 'oCC' => array('name' => 'oCC', 'type' => 'tns:oEmailArray'),
                        if($this->preach('isset', 'CC_EMAIL') == true){

                            $tmp_cnt = $this->count('CC_EMAIL');

                            for($ii = 0; $ii < $tmp_cnt; $ii++){

                                $tmp_md5_email = $this->oCRNRSTN->hash($this->preach('data_value', 'CC_EMAIL', true, $ii), 'md5');
                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['EMAIL_PROXY_SERIAL']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($tmp_md5_email, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['EMAIL_PROXY_SERIAL']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt(strlen($tmp_md5_email), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['EMAIL_PROXY_SERIAL']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt('string', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['EMAIL']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'CC_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['EMAIL']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt(strlen($this->preach('data_value', 'CC_EMAIL', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['EMAIL']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'CC_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['NAME']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'CC_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['NAME']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt(strlen($this->preach('data_value', 'CC_NAME', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['NAME']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'CC_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            }

                        }

                        // 'oBCC' => array('name' => 'oBCC', 'type' => 'tns:oEmailArray' ),
                        if($this->preach('isset', 'BCC_EMAIL') == true){

                            $tmp_cnt = $this->count('BCC_EMAIL');

                            for($ii = 0; $ii < $tmp_cnt; $ii++){

                                $tmp_md5_email = $this->oCRNRSTN->hash($this->preach('data_value', 'BCC_EMAIL', true, $ii), 'md5');
                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['EMAIL_PROXY_SERIAL']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($tmp_md5_email, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['EMAIL_PROXY_SERIAL']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt(strlen($tmp_md5_email), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['EMAIL_PROXY_SERIAL']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt('string', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['EMAIL']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'BCC_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['EMAIL']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt(strlen($this->preach('data_value', 'BCC_EMAIL', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['EMAIL']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'BCC_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['NAME']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'BCC_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['NAME']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt(strlen($this->preach('data_value', 'BCC_NAME', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['NAME']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'BCC_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            }

                        }

                        if($this->preach('isset', 'MESSAGE_SUBJECT', $i) == true){

                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_SUBJECT']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'MESSAGE_SUBJECT', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_SUBJECT']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'MESSAGE_SUBJECT', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'MESSAGE_SUBJECT', true, $i));
                            //error_log(__LINE__ . ' env - MESSAGE_SUBJECT[' . $tmp_len . '] [' . $this->preach('data_value', 'MESSAGE_SUBJECT', true, $i) . ']');

                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_SUBJECT']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'MESSAGE_BODY_HTML', $i) == true){

                            //error_log($this->count('MESSAGE_BODY_HTML') . ' CLIENT BUILD REQUEST - MESSAGE_BODY_HTML string count ::');
                            //error_log(__LINE__ . ' CLIENT - HTML ENCRYPT LEN=' . strlen($this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'MESSAGE_BODY_HTML', true, $i), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp)));

                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_BODY_HTML']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'MESSAGE_BODY_HTML', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp); // $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'MESSAGE_BODY_HTML', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_BODY_HTML']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'MESSAGE_BODY_HTML', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'MESSAGE_BODY_HTML', true, $i));
                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_BODY_HTML']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'MESSAGE_BODY_TEXT', $i) == true){

                            //error_log($this->count('MESSAGE_BODY_TEXT') . ' CLIENT BUILD REQUEST - MESSAGE_BODY_TEXT string count[' . $i . ']=' . strlen($this->preach('data_value', 'MESSAGE_BODY_TEXT', true, $i)) . ' ::');

                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_BODY_TEXT']['CONTENT'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('data_value', 'MESSAGE_BODY_TEXT', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_BODY_TEXT']['TYPE'] = $this->oCRNRSTN_USR->data_encrypt($this->preach('type', 'MESSAGE_BODY_TEXT', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'MESSAGE_BODY_TEXT', true, $i));
                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_BODY_TEXT']['LENGTH'] = $this->oCRNRSTN_USR->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                    }else{

                        // 'oRECIPIENT' => array( 'name' => 'oRECIPIENT', 'type' => 'tns:oEmailArray' ),
                        if($this->preach('isset', 'RECIPIENT_EMAIL', $i) == true){

                            $tmp_md5_email = $this->oCRNRSTN->hash($this->preach('data_value', 'RECIPIENT_EMAIL', true, $i), 'md5');
                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['EMAIL_PROXY_SERIAL']['CONTENT'] = $this->oCRNRSTN->data_encrypt($tmp_md5_email, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['EMAIL_PROXY_SERIAL']['LENGTH'] = $this->oCRNRSTN->data_encrypt(strlen($tmp_md5_email), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['EMAIL_PROXY_SERIAL']['TYPE'] = $this->oCRNRSTN->data_encrypt('string', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['EMAIL']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'RECIPIENT_EMAIL', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['EMAIL']['LENGTH'] = $this->oCRNRSTN->data_encrypt(strlen($this->preach('data_value', 'RECIPIENT_EMAIL', true, $i)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['EMAIL']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'RECIPIENT_EMAIL', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['NAME']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'RECIPIENT_NAME', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['NAME']['LENGTH'] = $this->oCRNRSTN->data_encrypt(strlen($this->preach('data_value', 'RECIPIENT_NAME', true, $i)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['NAME']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'RECIPIENT_NAME', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        // 'oSENDER' => array( 'name' => 'oSENDER', 'type' => 'tns:oEmailArray' ),
                        if($this->preach('isset', 'FROM_EMAIL') == true){

                            $tmp_cnt = $this->count('FROM_EMAIL');

                            for($ii = 0; $ii < $tmp_cnt; $ii++){

                                $tmp_md5_email = $this->oCRNRSTN->hash($this->preach('data_value', 'FROM_EMAIL', true, $ii), 'md5');
                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['EMAIL_PROXY_SERIAL']['CONTENT'] = $this->oCRNRSTN->data_encrypt($tmp_md5_email, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['EMAIL_PROXY_SERIAL']['LENGTH'] = $this->oCRNRSTN->data_encrypt(strlen($tmp_md5_email), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['EMAIL_PROXY_SERIAL']['TYPE'] = $this->oCRNRSTN->data_encrypt('string', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['EMAIL']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'FROM_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['EMAIL']['LENGTH'] = $this->oCRNRSTN->data_encrypt(strlen($this->preach('data_value', 'FROM_EMAIL', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['EMAIL']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'FROM_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['NAME']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'FROM_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['NAME']['LENGTH'] = $this->oCRNRSTN->data_encrypt(strlen($this->preach('data_value', 'FROM_NAME', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['NAME']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'FROM_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            }

                        }

                        // 'oREPLYTO' => array('name' => 'oREPLYTO', 'type' => 'tns:oEmailArray' ),
                        if($this->preach('isset', 'REPLYTO_EMAIL') == true){

                            $tmp_cnt = $this->count('REPLYTO_EMAIL');

                            for($ii = 0; $ii < $tmp_cnt; $ii++){

                                $tmp_md5_email = $this->oCRNRSTN->hash($this->preach('data_value', 'REPLYTO_EMAIL', true, $ii), 'md5');
                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['EMAIL_PROXY_SERIAL']['CONTENT'] = $this->oCRNRSTN->data_encrypt($tmp_md5_email, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['EMAIL_PROXY_SERIAL']['LENGTH'] = $this->oCRNRSTN->data_encrypt(strlen($tmp_md5_email), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['EMAIL_PROXY_SERIAL']['TYPE'] = $this->oCRNRSTN->data_encrypt('string', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['EMAIL']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'REPLYTO_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['EMAIL']['LENGTH'] = $this->oCRNRSTN->data_encrypt(strlen($this->preach('data_value', 'REPLYTO_EMAIL', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['EMAIL']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'REPLYTO_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['NAME']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'REPLYTO_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['NAME']['LENGTH'] = $this->oCRNRSTN->data_encrypt(strlen($this->preach('data_value', 'REPLYTO_NAME', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['NAME']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'REPLYTO_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            }

                        }

                        // 'oCC' => array('name' => 'oCC', 'type' => 'tns:oEmailArray' ),
                        if($this->preach('isset', 'CC_EMAIL') == true){

                            $tmp_cnt = $this->count('CC_EMAIL');

                            for($ii = 0; $ii < $tmp_cnt; $ii++){

                                $tmp_md5_email = $this->oCRNRSTN->hash($this->preach('data_value', 'CC_EMAIL', true, $ii), 'md5');
                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['EMAIL_PROXY_SERIAL']['CONTENT'] = $this->oCRNRSTN->data_encrypt($tmp_md5_email, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['EMAIL_PROXY_SERIAL']['LENGTH'] = $this->oCRNRSTN->data_encrypt(strlen($tmp_md5_email), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['EMAIL_PROXY_SERIAL']['TYPE'] = $this->oCRNRSTN->data_encrypt('string', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['EMAIL']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'CC_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['EMAIL']['LENGTH'] = $this->oCRNRSTN->data_encrypt(strlen($this->preach('data_value', 'CC_EMAIL', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['EMAIL']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'CC_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['NAME']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'CC_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['NAME']['LENGTH'] = $this->oCRNRSTN->data_encrypt(strlen($this->preach('data_value', 'CC_NAME', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['NAME']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'CC_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            }

                        }

                        // 'oBCC' => array('name' => 'oBCC', 'type' => 'tns:oEmailArray' ),
                        if($this->preach('isset', 'BCC_EMAIL') == true){

                            $tmp_cnt = $this->count('BCC_EMAIL');

                            for($ii = 0; $ii < $tmp_cnt; $ii++){

                                $tmp_md5_email = $this->oCRNRSTN->hash($this->preach('data_value', 'BCC_EMAIL', true, $ii), 'md5');
                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['EMAIL_PROXY_SERIAL']['CONTENT'] = $this->oCRNRSTN->data_encrypt($tmp_md5_email, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['EMAIL_PROXY_SERIAL']['LENGTH'] = $this->oCRNRSTN->data_encrypt(strlen($tmp_md5_email), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['EMAIL_PROXY_SERIAL']['TYPE'] = $this->oCRNRSTN->data_encrypt('string', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['EMAIL']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'BCC_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['EMAIL']['LENGTH'] = $this->oCRNRSTN->data_encrypt(strlen($this->preach('data_value', 'BCC_EMAIL', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['EMAIL']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'BCC_EMAIL', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['NAME']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'BCC_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['NAME']['LENGTH'] = $this->oCRNRSTN->data_encrypt(strlen($this->preach('data_value', 'BCC_NAME', true, $ii)), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                                $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['NAME']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'BCC_NAME', true, $ii), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            }

                        }

                        if($this->preach('isset', 'MESSAGE_SUBJECT', $i) == true){

                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_SUBJECT']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'MESSAGE_SUBJECT', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_SUBJECT']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'MESSAGE_SUBJECT', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'MESSAGE_SUBJECT', true, $i));
                            //error_log(__LINE__ . ' env - MESSAGE_SUBJECT[' . $tmp_len . '] [' . $this->preach('data_value', 'MESSAGE_SUBJECT', true, $i) . ']');

                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_SUBJECT']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'MESSAGE_BODY_HTML', $i) == true){

                            //error_log($this->count('MESSAGE_BODY_HTML') . ' CLIENT BUILD REQUEST - MESSAGE_BODY_HTML string count ::');
                            //error_log(__LINE__ . ' CLIENT - HTML ENCRYPT LEN=' . strlen($this->oCRNRSTN->data_encrypt($this->preach('data_value', 'MESSAGE_BODY_HTML', true, $i), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp)));

                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_BODY_HTML']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'MESSAGE_BODY_HTML', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp); // $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'MESSAGE_BODY_HTML', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_BODY_HTML']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'MESSAGE_BODY_HTML', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'MESSAGE_BODY_HTML', true, $i));
                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_BODY_HTML']['LENGTH'] = $this->oCRNRSTN->data_encrypt($tmp_len, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                        if($this->preach('isset', 'MESSAGE_BODY_TEXT', $i) == true){

                            //error_log($this->count('MESSAGE_BODY_TEXT') . ' CLIENT BUILD REQUEST - MESSAGE_BODY_TEXT string count[' . $i . ']=' . strlen($this->preach('data_value', 'MESSAGE_BODY_TEXT', true, $i)) . ' ::');

                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_BODY_TEXT']['CONTENT'] = $this->oCRNRSTN->data_encrypt($this->preach('data_value', 'MESSAGE_BODY_TEXT', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['MESSAGE_BODY_TEXT']['TYPE'] = $this->oCRNRSTN->data_encrypt($this->preach('type', 'MESSAGE_BODY_TEXT', true, $i), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $tmp_len = strlen($this->preach('data_value', 'MESSAGE_BODY_TEXT', true, $i));
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

        $data_type_family = 'CRNRSTN::RESOURCE::SOAP_PARAM';
        error_log(__LINE__ . ' env [SOAP::SERVER] ddo injest_SOAP_request_param $data_type_family[' . $data_type_family . ']. $object_name[' . $object_name . ']. $type[' . $type . '].');

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
        error_log(__LINE__ . ' ddo CHECK THAT THIS IS STRING PROCESSING OF CRNRSTN :: DDO DATA. TYPE[' . strval($tmp_oDDO->preach('type', $paramName)) . ']. die();');
        die();

        switch($type){
            case CRNRSTN_INT:

                $content = (int) $content;

            break;
            case CRNRSTN_INTEGER:

                $content = (integer) $content;

            break;
            case CRNRSTN_BOOL:
            case CRNRSTN_BOOLEAN:

                // strings 'true' or 'false'
                if($content == 'true'){

                    error_log(__LINE__ . ' env SERVER ddo - BOOL[' . $object_name . '][' . $content . ']true');

                    $content = true;

                }else{

                    error_log(__LINE__ . ' env SERVER ddo - BOOL[' . $object_name . '][' . $content . ']false');

                    $content = false;

                }

            break;
            case CRNRSTN_DOUBLE:

                $content = (double) $content;

            break;
            case CRNRSTN_STRING:

                $content = (string) $content;

            break;
            case CRNRSTN_ARRAY:

                error_log(__LINE__ . ' env SERVER ddo - ARRAY[' . $object_name . '][' . $content . ']array');

                //$content = (array) $content;   // <-- WE DON'T USE THIS? Wednesday, November 15, 2023 @ 0759 hrs.
                $content = (string) $type;

            break;
            case CRNRSTN_OBJECT:

                error_log(__LINE__ . ' env SERVER ddo - OBJECT[' . $object_name . '][' . $content . ']object');

                //$content = (object) $content;
                $content = (string) $type;

            break;
            case CRNRSTN_RESOURCE:
            case CRNRSTN_RESOURCE_CLOSED:

                error_log(__LINE__ . ' env SERVER ddo - RESOURCE/RESOURCE (CLOSED)[' . $object_name . '][' . $content . ']object');

                //$content = $content;
                $content = (string) $type;

            break;
            case CRNRSTN_NULL:

                error_log(__LINE__ . ' env SERVER ddo - NULL[' . $object_name . '][' . $content . ']null');

                $content = NULL;

            break;
            case CRNRSTN_UNKNOWN_TYPE:
            default:

                error_log(__LINE__ . ' env SERVER ddo - SURE, I BELIEVE IN YOU.[' . $object_name . '][' . $content . ']');

                //
                // SURE, I BELIEVE IN YOU.
                //$content = $content;

            break;

        }

        //add($data_value, $data_key = NULL, $data_type_family = 'CRNRSTN::RESOURCE::SOAP_PARAM', $index = NULL, $data_authorization_profile = CRNRSTN_AUTHORIZE_RUNTIME, $ttl = 60)
        $this->add($content, $object_name, $data_type_family);

        return true;

    }

    public function __destruct(){


    }

}