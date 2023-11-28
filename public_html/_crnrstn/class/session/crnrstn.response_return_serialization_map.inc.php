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
#  CLASS :: crnrstn_response_return_serialization_map
#  VERSION :: 1.00.0000
#  DATE :: Sunday, February 12, 2023 @ 1007 hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: Solution to add support for use case where CRNRSTN :: is managing
#                 the response return and handling multiple CRNRSTN :: mapped return
#                 types within a single mapped response. I.e. this supports a mapped
#                 system resource return [e.g. a social share deep link for a
#                 documentation resource] which mapped resource itself is HTML which
#                 also contains CRNRSTN :: mapped system images). This also creates
#                 a new layer of application architecture within CRNRSTN ::
#                 supporting a TTL-able server-side response cache buffer...where
#                 pointers to the responses of mapped resources are cached in the
#                 run time.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_response_return_serialization_map {

    protected $oLogger;
    public $oCRNRSTN;

    private static $channel_resource_id_ARRAY = array();
    private static $channel_ARRAY = array();
    private static $cache_ARRAY = array();
    private static $data_key_cache_rw_acceleration_ARRAY = array();
    public $ugc_ARRAY = array();

    //
    // BASE64 ENCODE SUPPORT PARAMETERS.
    private static $image_filesystem_meta_ARRAY = array();
    private static $image_output_mode = array();
    private static $request_salt;       // REFERENCED IN THE BASE64.PHP SYSTEM ASSET FILES.

    private static $request_current_fulfilled_ARRAY = array();
    private static $request_current_fulfilled_method_ARRAY = array();
    private static $request_page_fulfilled_ARRAY = array();
    private static $request_parent_fulfilled_method_ARRAY = array();
    private static $request_fulfillment_driver_ARRAY = array();

    private static $rrs_map_return_is_asset_ARRAY = array();
    private static $rrs_map_page_is_asset_ARRAY = array();

    private static $request_output_format_ARRAY = array();

    private static $request_family_ARRAY = array();
    private static $salt_ugc_ARRAY = array();
    private static $request_asset_meta_key_ARRAY = array();
    private static $request_asset_meta_path_ARRAY = array();

    private static $request_map_output_mode_ARRAY = array();
    private static $request_serialization_string_ARRAY = array();

    private static $channel_cache_id_ARRAY = array();
    private static $channel_ipaddress_id_ARRAY = array();

    private static $cache_id_ARRAY = array();
    private static $runtime_php_max_int_exceeded = false;  // NEEDS OVER 1 BILLION RESOURCES IN MEMORY TO TRIP THIS TO TRUE.
    private static $session_php_max_int_exceeded = false;  // NEEDS OVER 1 BILLION RESOURCES IN MEMORY TO TRIP THIS TO TRUE.

    private static $get_cache_id = -1;
    private static $post_cache_id = -1;
    private static $cookie_cache_id = -1;
    private static $session_cache_id = -1;
    private static $database_cache_id = -1;
    private static $ssdtla_cache_id = -1;
    private static $pssdtla_cache_id = -1;
    private static $runtime_cache_id = -1;
    private static $soap_cache_id = -1;
    private static $file_cache_id = -1;

    private static $cache_rrs_map_output_method_ARRAY = array();
    private static $cache_rrs_map_filepath_ARRAY = array();
    private static $cache_rrs_map_filename_ARRAY = array();
    private static $cache_rrs_map_file_extension_ARRAY = array();

    private static $cache_rrs_map_str_output_const_ARRAY = array();
    private static $cache_rrs_map_str_output_footer_html_output_ARRAY = array();
    private static $cache_rrs_map_str_output_is_dev_mode_ARRAY = array();

    private static $cache_rrs_map_str_output_const_alpha_ARRAY = array();
    private static $cache_rrs_map_str_output_const_beta_ARRAY = array();

    private static $cache_rrs_map_image_string_ARRAY = array();
    private static $return_status;

    private static $total_bytes_ARRAY = array();

    private static $get_cache_is_active = false;
    private static $post_cache_is_active = false;
    private static $cookie_cache_is_active = false;
    private static $session_cache_is_active = false;
    private static $database_cache_is_active = false;
    private static $ssdtla_cache_is_active = false;
    private static $pssdtla_cache_is_active = false;
    private static $runtime_cache_is_active = true;
    private static $soap_cache_is_active = false;
    private static $file_cache_is_active = false;

    private static $get_encryption_profile = false;
    private static $post_encryption_profile = false;
    private static $cookie_encryption_profile = false;
    private static $session_encryption_profile = false;
    private static $database_encryption_profile = false;
    private static $ssdtla_encryption_profile = false;
    private static $pssdtla_encryption_profile = false;
    private static $runtime_encryption_profile = false;
    private static $soap_encryption_profile = false;
    private static $file_encryption_profile = false;

    private static $get_max_map_cache_bytes;
    private static $post_max_map_cache_bytes;
    private static $cookie_max_map_cache_bytes;
    private static $session_max_map_cache_bytes;
    private static $database_max_map_cache_bytes;
    private static $ssdtla_max_map_cache_bytes;
    private static $pssdtla_max_map_cache_bytes;
    private static $runtime_max_map_cache_bytes = 1000;     // 1MB MAX TO START. WILL APPLY UP TO RUN OF CRNRSTN :: SETTINGS CONFIG.
    private static $soap_max_map_cache_bytes;
    private static $file_max_map_cache_bytes;

    private static $get_map_cache_ttl;
    private static $post_map_cache_ttl;
    private static $cookie_map_cache_ttl;
    private static $session_map_cache_ttl;
    private static $database_map_cache_ttl;
    private static $ssdtla_map_cache_ttl;
    private static $pssdtla_map_cache_ttl;
    private static $runtime_map_cache_ttl;
    private static $soap_map_cache_ttl;
    private static $file_map_cache_ttl;

    //
    //
    // $this->oCRNRSTN_RRS_MAP->rrs_map_set($tmp_channel_name . '_php_sessionid', session_id());
    private static $get_php_sessionid;
    private static $post_php_sessionid;
    private static $cookie_php_sessionid;
    private static $session_php_sessionid;
    private static $database_php_sessionid;
    private static $ssdtla_php_sessionid;
    private static $pssdtla_php_sessionid;
    private static $runtime_php_sessionid;
    private static $soap_php_sessionid;
    private static $file_php_sessionid;

    //
    //
    // $this->oCRNRSTN_RRS_MAP->rrs_map_set($tmp_channel_name . '_client_ip_address', $this->client_ip());
    private static $get_client_ip_address;
    private static $post_client_ip_address;
    private static $cookie_client_ip_address;
    private static $session_client_ip_address;
    private static $database_client_ip_address;
    private static $ssdtla_client_ip_address;
    private static $pssdtla_client_ip_address;
    private static $runtime_client_ip_address;
    private static $soap_client_ip_address;
    private static $file_client_ip_address;

    //
    //
    // $this->oCRNRSTN_RRS_MAP->rrs_map_set($tmp_channel_name . '_channel_config_ini_call_timestamp'
    private static $get_channel_config_ini_call_timestamp;
    private static $post_channel_config_ini_call_timestamp;
    private static $cookie_channel_config_ini_call_timestamp;
    private static $session_channel_config_ini_call_timestamp;
    private static $database_channel_config_ini_call_timestamp;
    private static $ssdtla_channel_config_ini_call_timestamp;
    private static $pssdtla_channel_config_ini_call_timestamp;
    private static $runtime_channel_config_ini_call_timestamp;
    private static $soap_channel_config_ini_call_timestamp;
    private static $file_channel_config_ini_call_timestamp;

    //
    //
    // $this->oCRNRSTN_RRS_MAP->rrs_map_set($tmp_channel_name . '_channel_is_opened_timestamp',
    private static $get_channel_is_opened_timestamp;
    private static $post_channel_is_opened_timestamp;
    private static $cookie_channel_is_opened_timestamp;
    private static $session_channel_is_opened_timestamp;
    private static $database_channel_is_opened_timestamp;
    private static $ssdtla_channel_is_opened_timestamp;
    private static $pssdtla_channel_is_opened_timestamp;
    private static $runtime_channel_is_opened_timestamp;
    private static $soap_channel_is_opened_timestamp;
    private static $file_channel_is_opened_timestamp;

    //
    //
    // $this->oCRNRSTN_RRS_MAP->rrs_map_set($tmp_channel_name . '_channel_is_closed_timestamp',
    private static $get_channel_is_closed_timestamp;
    private static $post_channel_is_closed_timestamp;
    private static $cookie_channel_is_closed_timestamp;
    private static $session_channel_is_closed_timestamp;
    private static $database_channel_is_closed_timestamp;
    private static $ssdtla_channel_is_closed_timestamp;
    private static $pssdtla_channel_is_closed_timestamp;
    private static $runtime_channel_is_closed_timestamp;
    private static $soap_channel_is_closed_timestamp;
    private static $file_channel_is_closed_timestamp;

    //
    //
    // $this->oCRNRSTN_RRS_MAP->rrs_map_set($tmp_channel_name . '_channel_ddo_tunnel_ddo_begin_data_receipt_timestamp
    private static $get_ddo_begin_data_receipt_timestamp;
    private static $post_ddo_begin_data_receipt_timestamp;
    private static $cookie_ddo_begin_data_receipt_timestamp;
    private static $session_ddo_begin_data_receipt_timestamp;
    private static $database_ddo_begin_data_receipt_timestamp;
    private static $ssdtla_ddo_begin_data_receipt_timestamp;
    private static $pssdtla_ddo_begin_data_receipt_timestamp;
    private static $runtime_ddo_begin_data_receipt_timestamp;
    private static $soap_ddo_begin_data_receipt_timestamp;
    private static $file_ddo_begin_data_receipt_timestamp;

    //
    //
    // $this->oCRNRSTN_RRS_MAP->rrs_map_set($tmp_channel_name . '_channel_ddo_tunnel_ddo_data_translation_complete_timestamp
    private static $get_ddo_data_complete_timestamp;
    private static $post_ddo_data_complete_timestamp;
    private static $cookie_ddo_data_complete_timestamp;
    private static $session_ddo_data_complete_timestamp;
    private static $database_ddo_data_complete_timestamp;
    private static $ssdtla_ddo_data_complete_timestamp;
    private static $pssdtla_ddo_data_complete_timestamp;
    private static $runtime_ddo_data_complete_timestamp;
    private static $soap_ddo_data_complete_timestamp;
    private static $file_ddo_data_complete_timestamp;

    //
    //
    // $this->oCRNRSTN_RRS_MAP->rrs_map_set($tmp_channel_name . '_channel_opened_count
    private static $get_channel_opened_count;
    private static $post_channel_opened_count;
    private static $cookie_channel_opened_count;
    private static $session_channel_opened_count;
    private static $database_channel_opened_count;
    private static $ssdtla_channel_opened_count;
    private static $pssdtla_channel_opened_count;
    private static $runtime_channel_opened_count;
    private static $soap_channel_opened_count;
    private static $file_channel_opened_count;

    //
    //
    // $this->oCRNRSTN_RRS_MAP->rrs_map_set($tmp_channel_name . '_last_packet_bytes_total
    private static $get_last_packet_bytes_total;
    private static $post_last_packet_bytes_total;
    private static $cookie_last_packet_bytes_total;
    private static $session_last_packet_bytes_total;
    private static $database_last_packet_bytes_total;
    private static $ssdtla_last_packet_bytes_total;
    private static $pssdtla_last_packet_bytes_total;
    private static $runtime_last_packet_bytes_total;
    private static $soap_last_packet_bytes_total;
    private static $file_last_packet_bytes_total;

    //
    //
    // $this->oCRNRSTN_RRS_MAP->rrs_map_set($tmp_channel_name . '_total_packet_bytes'
    private static $get_total_packet_bytes;
    private static $post_total_packet_bytes;
    private static $cookie_total_packet_bytes;
    private static $session_total_packet_bytes;
    private static $database_total_packet_bytes;
    private static $ssdtla_total_packet_bytes;
    private static $pssdtla_total_packet_bytes;
    private static $runtime_total_packet_bytes;
    private static $soap_total_packet_bytes;
    private static $file_total_packet_bytes;

    //
    //
    // $this->oCRNRSTN_RRS_MAP->rrs_map_set($tmp_channel_name . '_last_packet_bytes_received
    private static $get_last_packet_bytes_received;
    private static $post_last_packet_bytes_received;
    private static $cookie_last_packet_bytes_received;
    private static $session_last_packet_bytes_received;
    private static $database_last_packet_bytes_received;
    private static $ssdtla_last_packet_bytes_received;
    private static $pssdtla_last_packet_bytes_received;
    private static $runtime_last_packet_bytes_received;
    private static $soap_last_packet_bytes_received;
    private static $file_last_packet_bytes_received;

    //
    //
    // $this->oCRNRSTN_RRS_MAP->rrs_map_set($tmp_channel_name . '_total_bytes_received'
    private static $get_total_bytes_received;
    private static $post_total_bytes_received;
    private static $cookie_total_bytes_received;
    private static $session_total_bytes_received;
    private static $database_total_bytes_received;
    private static $ssdtla_total_bytes_received;
    private static $pssdtla_total_bytes_received;
    private static $runtime_total_bytes_received;
    private static $soap_total_bytes_received;
    private static $file_total_bytes_received;

    //
    //
    // $this->oCRNRSTN_RRS_MAP->rrs_map_set($tmp_channel_name . '_last_opened_timestamp'
    private static $get_last_opened_timestamp;
    private static $post_last_opened_timestamp;
    private static $cookie_last_opened_timestamp;
    private static $session_last_opened_timestamp;
    private static $database_last_opened_timestamp;
    private static $ssdtla_last_opened_timestamp;
    private static $pssdtla_last_opened_timestamp;
    private static $runtime_last_opened_timestamp;
    private static $soap_last_opened_timestamp;
    private static $file_last_opened_timestamp;

    //
    //
    // $this->oCRNRSTN_RRS_MAP->rrs_map_set($tmp_channel_name . '_last_closed_timestamp'
    private static $get_last_closed_timestamp;
    private static $post_last_closed_timestamp;
    private static $cookie_last_closed_timestamp;
    private static $session_last_closed_timestamp;
    private static $database_last_closed_timestamp;
    private static $ssdtla_last_closed_timestamp;
    private static $pssdtla_last_closed_timestamp;
    private static $runtime_last_closed_timestamp;
    private static $soap_last_closed_timestamp;
    private static $file_last_closed_timestamp;

    /*
    //
    // CHANNEL PERFOMANCE MONITOR TOUCH POINTS.
    //
    //
    // RRS MAP CHANNEL META TO INITIALIZE.
    //  - AFTER RECEIPT OF ANY TUNNELED DATA (PSSDTLA,
    //    SSDTLA), RECORD THE START TIME OF THE
    //    TRANSLATION OF THE DATA INTO THE
    //    CRNRSTN :: DDO. THIS DATA CAN BE AUTHORIZED
    //    TO BE STORED IN ANY OR ALL 10 CHANNELS ON A
    //    PARAMETER BY PARAMETER BASIS WITHIN
    //    THE PACKET.
    //  - CAPTURE THE COMPLETION TIME OF THE DATA
    //    TRANSLATION INTO THE CRNRSTN :: MULTI-CHANNEL
    //    DDO AFTER TUNNELING (PSSDTLA, SSDTLA)
    //    TO ENDPOINT.
    //  - CAPTURE THE TOTAL BYTE COUNT OF DATA MOVED
    //    INTO ANY CHANNEL.
    //
    //
    // SOFT DATA.
    TIME STAMP - GET THE TIMESAMP ASSOCIATED TO A CLIENT'S
                 INITIATION OF A REQUEST (MOUSE/KEYBOARD INPUT,
                 AJAX). WE NEED STRONG GAME IN THE AREA OF
                 TIME SYNCHRONIZATION MANAGEMENT BETWIXT THE
                 SERVER AND BROWSER. PLEASE REMEMBER THAT WE
                 HAVE AN ENCRYPTED (JSON) PACKET STORED IN
                 EVERY DOM <FORM> OBJECT.
                    ~ THE MOUSE CLICK TIMESTAMP AS RECORDED IN
                      THE JAVASCRIPT AT THE CLIENT AND TAKEN
                      STRAIGHT FROM DOM STATE.
                    ~ THE TTL EXPIRE + AJAX FIRE TIMESTAMP AS
                      RECORDED INTHE JAVASCRIPT AT THE CLIENT
                      AND TAKEN STRAIGHT FROM DOM STATE.
    TIME STAMP - GET THE TIMESAMP WHEN THE oCRNRSTN_JS DOM
                 OBJECT (THIS IS CRNRSTN :: AT THE BROWSER)
                 MANAGES A CLIENT-SIDE TTL EXPIRE + AJAX FIRE,
                 WE SHOULD GET THE TIMESTAMP HERE. THIS HAPPENS
                 VIA AJAX $_POST[] ON TOP OF THE CRNRSTN ::
                 SSDTLA AND CRNRSTN :: PSSDTLA
                 APPLICATION ARCHITECTURES.

    // HARD DATA.
    TIME STAMP - GET THE TIMESAMP WHEN THE SERVER RECEIVES A
                 REQUEST. PROCESS START.
    TIME STAMP - GET THE TIMESAMP WHEN ANY CHANNEL
                 INITILIZATION METHOD FIRES.
                 SEE, $oCRNRSTN->config_init_channel().
    TIME STAMP - GET THE TIMESAMP WHEN ANY CHANNEL RESOURCE
                 DEPENDENCY HAS A CRITICAL MOMENT. SO, FOR
                 EXAMPLE, THE DATABASE CHANNEL SHOULD REPORT
                 ON ITS OWN SYSTEM INITILIZATION TIMES AS WELL
                 AS THOSE OF MYSQL. THE CRNRSTN :: MULTI-
                 CHANNEL DATABASE CHANNEL SHOULD ALSO REPORT ON
                 THE RUNTIME FOR CERTAIN DATABASE CONFIGURATION
                 EVENTS SUCH AS ACCOUNT PROFILE INITILIZATION
                 AND WHEN A RESOURCE (SUCH AS A DATABASE
                 CONNECTION) IS LOADED INTO MEMORY TO THEN ENABLE
                 CRNRSTN :: TO LOOK FOR A VALID DATABASE CACHED
                 SSDTLA/PSSDTLA PACKET. THESE ARE CRNRSTN ::
                 MULTI-CHANNEL DDO INITIALIZATION CONSIDERATIONS
                 AT A HIGH-LEVEL. GOT BYTE RESTRICTIONS?
    TIME STAMP - [A MORE TRADITIONAL TOUCHPOINT] WHEN THE SERVER
                 SENDS AN IMAGE STRAIGHT TO BUFFER OUTPUT AS THE
                 RESULT OF A CLIENT INITIATED REQUEST. BUT
                 THINK ABOUT SOMETHING MORE LIKE A "MULTI-POINT
                 AND MULTI-VARIENT X.GIF SERVICES LAYER" FOR THE
                 MANAGEMENT AND MONITORING OF THE USER'S
                 ENGAGEMENT IF CRNRSTN :: WERE TO FREAK WITH THIS.
    TIME STAMP - [A CHEEKY SERVICES LAYER] WHEN THE SERVER BUILDS
                 ANY RESOURCE TO BE SENT TO THE CLIENT (E.G., ANY
                 SOCIAL PREVIEW FACEBOOK <HEAD> OG: META TAG)
                 OR SENDS ANY RESOURCE, E.G., IMAGE, CSS, JS, MAP,
                 AND XML DATA STRAIGHT TO BUFFER OUTPUT AS THE
                 RESULT OF A CLIENT INITIATED REQUEST. ALL OF
                 THESE AFOREMENTIONED RESOURCES ARE ENCAPSULATED
                 IN A REFERENCE, JUST PRIOR, TO MULTI-VARIATION.


    Wednesday, November 22, 2023 @ 1851 hrs.

    */

    private static $cache_rrs_map_raw_output_mode_ARRAY = array();
    private static $cache_rrs_map_output_mode_ARRAY = array();
    private static $cache_ipaddress_id_ARRAY = array();
    private static $cache_datecreated_ARRAY = array();
    private static $cache_createdby_client_ip_ARRAY = array();
    private static $cache_lastmodified_ARRAY = array();
    private static $cache_modifiedby_client_ip_ARRAY = array();

    private static $channel_state_ARRAY = array();
    private static $destruct_sync_inactive = false;
    private static $channel_active_ARRAY = array();
    private static $gone_to_plaid_ARRAY = array();

    private static $rrs_map_max_report_length = 0;

    public function __construct($oCRNRSTN){

        $this->oCRNRSTN = $oCRNRSTN;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN);

        /*
        CRNRSTN :: ORDER OF OPERATIONS (PREFERENCE) FOR SPECIFICATION OF
        AUTHORIZED DATA ARCHITECTURES (CHANNEL).

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
        // BYTES INITIALIZATION.
        self::$cache_ARRAY[$this->oCRNRSTN->request_id]['channel_bytes'][CRNRSTN_CHANNEL_RUNTIME] = self::$total_bytes_ARRAY[CRNRSTN_RESOURCE_ALL] = self::$total_bytes_ARRAY['CHANNEL'][CRNRSTN_CHANNEL_RUNTIME] = 0;

    }

    public function set_channel_config($channel_constant, $attribute_name, $data){

        //
        // STANDARDIZE CHANNEL REFERENCE INPUT FOR
        // STRING CONCATENATION.
        $tmp_channel_name = $this->oCRNRSTN->get_channel_config($channel_constant, 'NAME');
        error_log(__LINE__ . ' RRS MAP CHANNEL CONFIG HOOK UP ready. die();');
        error_log(__LINE__  . ' rrs map ' . __METHOD__ . ' die(); channel_constant[' . $channel_constant . ']. $attribute_name[' . strval($attribute_name) . ']. data[' . $data . '.');

        die();

        return ; //self::$oCRNRSTN_DDO->set_channel_config($channel_constant, $attribute_name, $data);

    }

    public function get_channel_config($channel_constant, $attribute_name){


        error_log(__LINE__  . ' rrs map ' . __METHOD__ . ' die(); channel_constant[' . $channel_constant . ']. $attribute_name[' . strval($attribute_name) . '].');

        die();

        return ; //self::$oCRNRSTN_DDO->set_channel_config($channel_constant, $attribute_name);

    }

    public function isset_channel_config($channel_constant, $attribute_name, $return_type = CRNRSTN_BOOLEAN){
        // Thursday, November 23, 2023 @ 0031 hrs.

        error_log(__LINE__  . ' rrs map ' . __METHOD__ . ' die(); channel_constant[' . $channel_constant . ']. $attribute_name[' . strval($attribute_name) . ']. $return_type[' . $this->oCRNRSTN->data_type_filter($return_type, CRNRSTN_STRING) . '].');

        die();

        return ; //self::$oCRNRSTN_DDO->set_channel_config($channel_constant, $attribute_name, $return_type);

    }

    public function config_init_rrs_map_max_report_length(){

        //
        // JUST NEED TO RUN THIS ONCE ON INITIALIZATION.
        self::$rrs_map_max_report_length = $this->oCRNRSTN->get_resource('max_length_plaid_performance_report', 0, 'CRNRSTN::RESOURCE::APPLICATION_ACCELERATION');

    }

    public function add_cache_channel($channel_constant){

        //
        // THIS DATA STRUCURE IS NOT USED.
        error_log(__LINE__  . ' rrs map add_cache_channel [' . $channel_constant . ']. THIS IS UNUSED DATA. DO WE HAVE A RECORD OF ACTIVE CHANNELS ELSEWHERE?');

        self::$channel_active_ARRAY[] = $channel_constant;

    }

    public function config_init_channel_map(){

        //
        // INITIALIZE GLOBAL AND MULTI-CHANNEL BYTE REPORTING.
        self::$total_bytes_ARRAY[CRNRSTN_RESOURCE_ALL] = 0;
        //error_log(__LINE__ . ' rrs map INITIALIZE GLOBAL AND MULTI-CHANNEL BYTE=[' . self::$total_bytes_ARRAY[CRNRSTN_RESOURCE_ALL] . '] REPORTING[' . CRNRSTN_RESOURCE_ALL . '].');

        $tmp_hold_ARRAY = array();
        $tmp_channel_ARRAY = str_split($this->oCRNRSTN->data_channel_init_sequence());

        //
        // BUILD ACTIVE CHANNEL ARRAY IN A SEQUENCE PARALLEL TO MASTER PROFILE.
        foreach($tmp_channel_ARRAY as $ch_channel => $ch_alpha){

            //$tmp_channel = $this->oCRNRSTN->get_channel_config($ch_alpha, 'NAME');
            $tmp_channel = $this->oCRNRSTN->get_channel_config($ch_alpha, 'AUTHORIZATION', 'PROFILE', 'PRIMARY', CRNRSTN_INTEGER);

            if($this->rrs_map_get($this->oCRNRSTN->get_channel_config($ch_alpha, 'NAME') . '_cache_is_active') == true){

                $tmp_hold_ARRAY[] = $tmp_channel;

            }

            error_log(__LINE__. ' rrs map INTEGER NOW? INIT CHANNEL[' . strval($ch_alpha) . '/' . print_r($tmp_channel, true) . '].');

            //
            // INITIALIZE GLOBAL AND MULTI-CHANNEL BYTE REPORTING.
            self::$total_bytes_ARRAY['CHANNEL'][$tmp_channel] = 0;
            //error_log(__LINE__ . ' rrs map INITIALIZE GLOBAL AND MULTI-CHANNEL BYTE=[' . self::$total_bytes_ARRAY['CHANNEL'][$tmp_channel] . ']. $channel[' . $tmp_channel . '].');

        }

        //
        // UPDATE ACTIVE CHANNELS ARRAY.
        self::$channel_ARRAY = $tmp_hold_ARRAY;

        return true;

    }

    public function return_cache_channels(){

        return self::$channel_ARRAY;

    }

    //$this->cache_input_control(
    // self::$cache_rrs_map_output_method_ARRAY,
    // $channel,
    // 'rrs_map_output_method',
    // self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$ugc_value]
    //);

    private function cache_input_control($cache_data, $channel = CRNRSTN_CHANNEL_RUNTIME, $attribute = NULL, $cache_id = NULL){

        error_log(__LINE__ . ' rrs map FIRING CACHE INPUT CONTROL. $channel[' . $channel . ']. $attribute[' . $attribute . '].');

        //
        // TODO :: SUPPORT $channel = 'session' HERE. ONLY RUNTIME DATA EXTRACT IS SUPPORTED BELOW.
        switch($channel){
            case CRNRSTN_CHANNEL_SESSION:
                //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

                switch($attribute) {
                    case 'rrs_map_output_method':

                        //$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['rrs_map_output_method'][$tmp_cache_id]
                        //error_log(__LINE__ . ' rrs map $attribute[' . $attribute . ']. RUNTIME CACHE[' . print_r($cache_data, true) . ']. $cache_id[' . $cache_id . '].');
                        //error_log(__LINE__ . ' rrs map [' . $this->get_salt_ugc() . ']. $attribute[' . $attribute . ']. SESSION CACHE[' . print_r($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'], true) . ']. $cache_id[' . $cache_id . '].');

                        if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'][$attribute][$cache_id])){

                            error_log(__LINE__ . ' rrs map $attribute[' . $attribute . ']. RETURN SESSION CACHE[' . print_r($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'][$attribute], true) . ']. $cache_id[' . $cache_id . '].');
                            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'][$attribute][$cache_id] = $attribute;
                            return $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'][$attribute][$cache_id];

                        }

                        if(isset($cache_data[$attribute][$cache_id])){

                            if(strlen($cache_data[$attribute][$cache_id]) > 0){

                                error_log(__LINE__ . ' rrs map $attribute[' . $attribute . ']. RETURN RUNTIME CACHE[' . print_r($cache_data[$attribute], true) . ']. $cache_id[' . $cache_id . '].');
                                return $cache_data[$attribute];

                            }

                        }

                    break;

                }

            break;
            default:
                // CRNRSTN_CHANNEL_RUNTIME.

                //
                // CACHE ATTRIBUTE META.
                switch($attribute){
                    case 'rrs_map_output_method':

                        //$this->cache_input_control(
                        // self::$cache_rrs_map_output_method_ARRAY,
                        // $channel,
                        // 'rrs_map_output_method',
                        // self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$ugc_value]
                        //);
                        //$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['rrs_map_output_method'][$tmp_cache_id]

                        if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'][$cache_id])){

                            error_log(__LINE__ . ' rrs map $attribute[' . $attribute . ']. SESSION CACHE[' . print_r($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'], true) . ']. $cache_id[' . $cache_id . '].');
                            error_log(__LINE__ . ' rrs map RETURN SESSION CACHE[' . print_r($cache_data, true) . ']. $cache_id[' . $cache_id . '].');

                            return $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'][$cache_id];

                        }

                        if(isset($cache_data[$this->oCRNRSTN->request_id][$cache_id])){

                            if(strlen($cache_data[$this->oCRNRSTN->request_id][$cache_id]) > 0){

                                error_log(__LINE__ . ' rrs map $attribute[' . $attribute . ']. RUNTIME CACHE[' . print_r($cache_data, true) . ']. $cache_id[' . $cache_id . '].');
                                return $cache_data[$this->oCRNRSTN->request_id][$cache_id];

                            }

                        }

                    break;
                    case 'meta_path':
                         //self::$request_asset_meta_path_ARRAY
                         //error_log(__LINE__ . ' rrs map RETURN STRING CACHE[' . print_r($cache_data, true) . ']. $cache_id[' . $cache_id . '].');

                        if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'][$cache_id])){

                            error_log(__LINE__ . ' rrs map RETURN SESSION CACHE $cache_id[' . $cache_id . ']. [' . $cache_data[$cache_id] . '].');
                            return $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'][$cache_id];

                        }

                        /*
                        [Wed Apr 05 13:43:18.809045 2023] [:error] [pid 47014] [client 172.16.225.1:56576] 321 rrs map RETURN STRING CACHE[
                            Array\n(\n
                                [34ZlrNKACegN0rTsWmO1XzcMsedLekx0rg0Xm1gEIJ7Bve1syz3UeMLngjLfG0jz] =>
                            Array\n        (\n
                                [7513] =>
                            Array\n                (\n
                                [1] => system/crnrstn/favicon.ico\n
                            )\n\n
                                [7207] =>
                            Array\n                (\n
                                [4] => /\n
                                [7] => \n
                                [8] => \n
                                [9] => \n                    [10] => \n                )\n\n
                                [7208] => Array\n                (\n                    [5] => \n                    [6] => \n                    [11] => \n                    [12] => \n                )\n\n        )\n\n)\n]. $cache_id[14].

                        */
                        if(isset($cache_data[$this->oCRNRSTN->request_id][$cache_id])){

                            error_log(__LINE__ . ' rrs map RETURN RUNTIME CACHE $cache_id[' . $cache_id . ']. [' . $cache_data[$this->oCRNRSTN->request_id][$cache_id] . '].');

                            if(strlen($cache_data[$this->oCRNRSTN->request_id][$cache_id]) > 0){

                                return $cache_data[$this->oCRNRSTN->request_id][$cache_id];

                            }

                        }

                    break;
                    case 'rrs_map_image_string':

                        if(isset($cache_data[$this->oCRNRSTN->request_id][self::$request_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][$cache_id]][$cache_id])){

                            //error_log(__LINE__ . ' rrs map RETURN STRING CACHE[' . print_r($cache_data, true) . ']. $cache_id[' . $cache_id . '].');

                            if(strlen($cache_data[$this->oCRNRSTN->request_id][self::$request_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][$cache_id]][$cache_id]) > 0){

                                return $cache_data[$this->oCRNRSTN->request_id][self::$request_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][$cache_id]][$cache_id];

                            }

                         }

                    break;
                    default:

                        switch($channel){
                            case CRNRSTN_CHANNEL_RUNTIME:
                                 /*
                                 [Tue Apr 04 22:35:29.297397 2023] [:error] [pid 37790] [client 172.16.225.1:58411] 529 rrs map
                                 $cache_resource_id[19]. $cache_id[5].

                                 self::$cache_rrs_map_filename_ARRAY[
                                     Array\n(\n
                                         [VRnADsbUrJj92fnkI8jf6PcciVTfaL752RjCBW8ejTnaZVzCFGWgM7dodFpcJzOa] =>
                                             Array\n        (\n
                                                 [4] => crnrstn.main_desktop.css\n
                                                 [5] => jquery-3.6.1.min.map\n
                                                 [6] => jquery-3.6.1.js\n
                                                 [7] => 1.13.2/jquery-ui.theme.css\n
                                                 [8] => 1.13.2/jquery-ui.structure.css\n
                                                 [9] => 1.13.2/jquery-ui.css\n
                                                 [10] => 1.13.2/jquery-ui.js\n
                                                 [11] => lightbox-2.11.3/css/lightbox.css\n
                                                 [12] => crnrstn.main.js\n        )\n\n)\n].

                                 */

                                 //
                                 // RESOURCE_ID IS JUST A SUGGESTION.
                                 if(isset($cache_data[$this->oCRNRSTN->request_id][$cache_id])){

                                     error_log(__LINE__ . ' rrs map RETURN STRING CACHE[' . print_r($cache_data, true) . ']. $cache_id[' . $cache_id . '].');

                                     if(isset($cache_data[$this->oCRNRSTN->request_id][$cache_id]['filepath_base64'])){

                                         if(strlen($cache_data[$this->oCRNRSTN->request_id][$cache_id]['filepath_base64']) > 0){

                                             //error_log(__LINE__ . ' rrs map RETURN STRING CACHE[' . print_r($cache_data[$this->oCRNRSTN->request_id][$cache_id], true) . ']. $cache_id[' . $cache_id . '].');

                                             return $cache_data[$this->oCRNRSTN->request_id][$cache_id]['filepath_base64'];

                                         }

                                     }

                                     if(strlen($cache_data[$this->oCRNRSTN->request_id][$cache_id]) > 0){

                                         //error_log(__LINE__ . ' rrs map RETURN STRING CACHE[' . print_r($cache_data[$this->oCRNRSTN->request_id][$cache_id], true) . ']. $cache_id[' . $cache_id . '].');

                                         return $cache_data[$this->oCRNRSTN->request_id][$cache_id];

                                     }

                                 }

                            break;
                            case CRNRSTN_CHANNEL_SESSION:
                                //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

                                if(isset($cache_data[$attribute][$cache_id])){

                                    return $cache_data[$attribute][$cache_id];

                                }

                            break;
                            default:

                                error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                            break;

                        }

                    break;

                }

            break;

        }

        //error_log(__LINE__ . ' rrs map RETURN NO ' . $channel . ' CACHE[' . print_r($attribute, true) . ']. $cache_id[' . $cache_id . ']. [' . print_r($cache_data, true) . '].');

        return NULL;

    }


//    private function ip_resource_id($request_ugc_val, $channel = CRNRSTN_CHANNEL_RUNTIME, $ip = NULL){
//
//        if(!isset($ip)){
//
//            $ip = $this->oCRNRSTN->client_ip();
//
//        }
//
//        switch($channel){
//            case CRNRSTN_CHANNEL_SESSION:
//
//                //$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['ipaddress_id'][$this->oCRNRSTN->client_ip()] = $this->ip_resource_id($ugc_value);
//
//            break;
//            case CRNRSTN_CHANNEL_RUNTIME:
//            default:
//
//                //
//                // DOES THIS IP RESOURCE EXIST IN RUNTIME?
//                if((isset(self::$cache_createdby_client_ip_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$request_ugc_val]])) || (isset(self::$cache_modifiedby_client_ip_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$request_ugc_val]]))){
//
//                    if(isset(self::$cache_ipaddress_id_ARRAY[$this->oCRNRSTN->request_id][$ip])){
//
//                        return self::$cache_ipaddress_id_ARRAY[$this->oCRNRSTN->request_id][$ip];
//
//                    }
//
//                }
//
//                //
//                // GENERATE NEW IP ADDRESS ID. THIS WILL SAVE SPACE IN MEMORY.
//                $tmp_cnt = 0;
//                if(isset(self::$cache_ipaddress_id_ARRAY[$this->oCRNRSTN->request_id])){
//
//                    $tmp_cnt = count(self::$cache_ipaddress_id_ARRAY[$this->oCRNRSTN->request_id]);
//
//                }
//
//                //
//                // NEW IP RESOURCE.
//                self::$cache_ipaddress_id_ARRAY[$this->oCRNRSTN->request_id][$ip] = $tmp_cnt;
//
//                return $tmp_cnt;
//
//            break;
//
//        }
//
//    }

//    private function merge_resource_to_cache($resource_id, $ugc_value, $reset_ttl, &$cache_merge_ARRAY, $channel = CRNRSTN_CHANNEL_RUNTIME){
//
//        switch($channel){
//            case CRNRSTN_CHANNEL_RUNTIME:
//
//                // THE OLD APPLICATION ACCELERATION CACHE MGMT SITUATION.
//                if(1 == 2){
//
//
//                    //
//                    // GET STARTING CACHE RESOURCE_ID FROM $cache_merge_ARRAY SIZE.
//                    $cache_resource_id = 0;
//                    if(isset($cache_merge_ARRAY[$this->oCRNRSTN->request_id]['resource_id'])){
//
//                        $cache_resource_id = count($cache_merge_ARRAY[$this->oCRNRSTN->request_id]['resource_id']);
//
//                    }
//
//                    //error_log(__LINE__ . ' rrs map $cache_resource_id[' . $cache_resource_id . ']. $resource_id[' . $resource_id . ']. $cache_merge_ARRAY[' . print_r($cache_merge_ARRAY, true) . '].');
//
//                    //
//                    // NOTE: RESOURCE_ID IS ONLY FOR RUNTIME REFERENCE.
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['resource_id'][$ugc_value] = $cache_resource_id; //self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$ugc_value];
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['ipaddress_id'][$this->oCRNRSTN->client_ip()] = $this->ip_resource_id($ugc_value);
//
//                    //error_log(__LINE__ . ' rrs map $ugc_value[' . $ugc_value . ']. $cache_resource_id[' . $cache_resource_id . ']. $resource_id[' . self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$ugc_value] . '].');
//                    //error_log(__LINE__ . ' rrs map $cache_rrs_map_filename_ARRAY[' . print_r(self::$cache_rrs_map_filename_ARRAY, true) . '].');
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['rrs_map_filename'][$cache_resource_id] = $this->cache_input_control(self::$cache_rrs_map_filename_ARRAY, $channel, 'rrs_map_filename', self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$ugc_value]);
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['rrs_map_file_extension'][$cache_resource_id] = $this->cache_input_control(self::$cache_rrs_map_file_extension_ARRAY, $channel, 'rrs_map_file_extension', self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$ugc_value]);
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['rrs_map_filepath'][$cache_resource_id] = $this->cache_input_control(self::$cache_rrs_map_filepath_ARRAY, $channel, 'rrs_map_filepath', self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$ugc_value]);
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['rrs_map_image_string'][self::$request_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$ugc_value]]][$cache_resource_id] = $this->cache_input_control(self::$cache_rrs_map_image_string_ARRAY, $channel, 'rrs_map_image_string', self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$ugc_value]);
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['meta_path'][$cache_resource_id] = $this->cache_input_control(self::$request_asset_meta_path_ARRAY, $channel, 'meta_path', self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$ugc_value]);
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['asset_family'][$cache_resource_id] = self::$request_family_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$ugc_value]];
//                    error_log(__LINE__ . ' rrs map self::$request_asset_meta_key_ARRAY[' . print_r(self::$request_asset_meta_key_ARRAY,true) . '].');
//
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['asset_meta_key'][$cache_resource_id] = self::$request_asset_meta_key_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$ugc_value]];
//                    //$cache_merge_ARRAY[$this->oCRNRSTN->request_id]['rrs_map_output_method'][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$ugc_value]] = $this->cache_input_control(self::$cache_rrs_map_output_method_ARRAY, $channel, 'rrs_map_output_method', self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$ugc_value]);
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['raw_output_mode'][$cache_resource_id] = self::$cache_rrs_map_raw_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$ugc_value]];
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['output_mode'][$cache_resource_id] = self::$request_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$ugc_value]];
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['resource_bytes'][$cache_resource_id] = $this->get_cache($ugc_value);
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['datecreated'][$cache_resource_id] = time();
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['createdby_client_ip'][$cache_resource_id] = $this->ip_resource_id($ugc_value);
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['lastmodified'][$cache_resource_id] = time();
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['modifiedby_client_ip'][$cache_resource_id] = $this->ip_resource_id($ugc_value);
//
//                    //self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]
//                    error_log(__LINE__ . ' rrs map RUNTIME EXTRACTED FOR MERGE INTO SESSION. $cache_merge_ARRAY[' . print_r($cache_merge_ARRAY, true) . '].');
//
//                }
//
//            break;
//            case CRNRSTN_CHANNEL_SESSION:
//
//                // THE OLD APPLICATION ACCELERATION CACHE MGMT SITUATION.
//                if(1 == 2){
//
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['resource_id'][$ugc_value] = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$ugc_value];
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['ipaddress_id'][$this->oCRNRSTN->client_ip()] = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['ipaddress_id'][$this->oCRNRSTN->client_ip()];
//
//                    //$cache_merge_ARRAY[$this->oCRNRSTN->request_id]['rrs_map_filename'][$cache_merge_ARRAY[$this->oCRNRSTN->request_id]['resource_id'][$ugc_value]] = $this->cache_input_control($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'], $channel, 'rrs_map_filename', $resource_id);
//                    error_log(__LINE__ . ' rrs map SESSION EXTRACT FOR MERGE INTO RUNTIME. $ugc_value[' . $ugc_value . ']. $resource_id[' . $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$ugc_value] . '].');
//
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['rrs_map_filename'][$cache_merge_ARRAY[$this->oCRNRSTN->request_id]['resource_id'][$ugc_value]] = $this->cache_input_control($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'], $channel, 'rrs_map_filename', $resource_id);
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['rrs_map_file_extension'][$cache_merge_ARRAY[$this->oCRNRSTN->request_id]['resource_id'][$ugc_value]] = $this->cache_input_control($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'], $channel, 'rrs_map_file_extension', $resource_id);
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['rrs_map_filepath'][$cache_merge_ARRAY[$this->oCRNRSTN->request_id]['resource_id'][$ugc_value]] = $this->cache_input_control($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'], $channel, 'rrs_map_filepath', $resource_id);
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['rrs_map_image_string'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['output_mode'][$resource_id]][$cache_merge_ARRAY[$this->oCRNRSTN->request_id]['resource_id'][$ugc_value]] = $this->cache_input_control($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'], $channel, 'rrs_map_image_string', $resource_id);
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['meta_path'][$cache_merge_ARRAY[$this->oCRNRSTN->request_id]['resource_id'][$ugc_value]] = $this->cache_input_control($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'], $channel, 'meta_path', $resource_id);
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['asset_family'][$cache_merge_ARRAY[$this->oCRNRSTN->request_id]['resource_id'][$ugc_value]] = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['asset_family'][$resource_id];
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['asset_meta_key'][$cache_merge_ARRAY[$this->oCRNRSTN->request_id]['resource_id'][$ugc_value]] = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['asset_meta_key'][$resource_id];
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['rrs_map_output_method'][$cache_merge_ARRAY[$this->oCRNRSTN->request_id]['resource_id'][$ugc_value]] = $this->cache_input_control($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'], $channel, 'rrs_map_output_method', $resource_id);
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['raw_output_mode'][$cache_merge_ARRAY[$this->oCRNRSTN->request_id]['resource_id'][$ugc_value]] = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['raw_output_mode'][$resource_id];
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['output_mode'][$cache_merge_ARRAY[$this->oCRNRSTN->request_id]['resource_id'][$ugc_value]] = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['output_mode'][$resource_id];
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['resource_bytes'][$cache_merge_ARRAY[$this->oCRNRSTN->request_id]['resource_id'][$ugc_value]] = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['resource_bytes'][$resource_id];
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['datecreated'][$cache_merge_ARRAY[$this->oCRNRSTN->request_id]['resource_id'][$ugc_value]] = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['datecreated'][$resource_id];
//                    $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['createdby_client_ip'][$cache_merge_ARRAY[$this->oCRNRSTN->request_id]['resource_id'][$ugc_value]] = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['createdby_client_ip'][$resource_id];
//
//                    if($reset_ttl){
//
//                        $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['lastmodified'][$cache_merge_ARRAY[$this->oCRNRSTN->request_id]['resource_id'][$ugc_value]] = time();
//                        $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['modifiedby_client_ip'][$cache_merge_ARRAY[$this->oCRNRSTN->request_id]['resource_id'][$ugc_value]] = $this->ip_resource_id($ugc_value, 'session');
//
//                    }else{
//
//                        $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['lastmodified'][$cache_merge_ARRAY[$this->oCRNRSTN->request_id]['resource_id'][$ugc_value]] = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['lastmodified'][$resource_id];
//                        $cache_merge_ARRAY[$this->oCRNRSTN->request_id]['modifiedby_client_ip'][$cache_merge_ARRAY[$this->oCRNRSTN->request_id]['resource_id'][$ugc_value]] = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['modifiedby_client_ip'][$resource_id];
//
//                    }
//
//                }
//
//            break;
//
//        }
//
//        return $cache_merge_ARRAY;
//
//    }

    public function return_cache_data($channel = CRNRSTN_CHANNEL_RUNTIME, $format = 'runtime_static'){

        try{

            $tmp_cache_profile_ARRAY = array();

            switch($channel){
                case CRNRSTN_CHANNEL_SESSION:
                    //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).
                    // CURRENTLY, WE ONLY "CHUNKY RETURN...or batch return" CACHE DATA FROM RUNTIME.
                    return $tmp_cache_profile_ARRAY;

                break;
                case CRNRSTN_CHANNEL_RUNTIME:

                    //
                    // THIS SHOULD ONLY RETURN NON-TTL EXPIRED MAP CACHE DATA.
                    if($format == 'merged'){

                        error_log(__LINE__ . ' rrs map READY TO PROCEED. die();');
                        die();

                        foreach(self::$channel_ARRAY as $index => $channel){

                            switch($channel){
                                case CRNRSTN_CHANNEL_SESSION:

                                    //
                                    // WE ARE PROCESSING RUNTIME SYNC TO SESSION. CHECK IF SESSION CHANNEL IS ACTIVE.
                                    if($this->rrs_map_get($this->oCRNRSTN->get_channel_config($channel, 'NAME') . '_cache_is_active') == true){

                                        if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'])){

                                            //
                                            // CYCLE THROUGH SESSION DATA AND BUILD NEW SESSION CACHE STARTING WITH EXISTING
                                            // SESSION DATA. EXCLUDE IF TTL EXPIRED OR REQUEST IS EXISTING IN RUNTIME ALREADY...THEN ADD
                                            // ANY NEW RETURNS CURRENTLY IN RUNTIME...UP TO THE MAX NUMBER OF BYTES FOR THE CHANNEL.
                                            foreach($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'] as $ugc_value => $resource_id){

                                                $tmp_lastmodified = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['lastmodified'][$resource_id];

                                                if(time() < ((int)$tmp_lastmodified + (int) $this->rrs_map_get($channel . '_map_cache_ttl'))){

                                                    $tmp_reset_ttl = false;
                                                    $tmp_valid_resource_id_ARRAY[] = $resource_id;
                                                    error_log(__LINE__ . ' rrs map $ugc_value[' . $ugc_value . '] IS VALID FOR SESSION.');

                                                    //
                                                    // IF RESOURCE IS NOT CURRENTLY BEING REQUESTED, UPDATE LASTMODIFIED TIMESTAMP.
                                                    error_log(__LINE__ . ' rrs map self::$request_map_output_mode_ARRAY[' . print_r(self::$request_map_output_mode_ARRAY, true) . '].');
                                                    error_log(__LINE__ . ' rrs map $ugc_value[' . $ugc_value . ']. self::$cache_id_ARRAY[' . print_r(self::$cache_id_ARRAY, true) . '].');

                                                    if(isset(self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$ugc_value])){

                                                        if(isset(self::$cache_rrs_map_output_method_ARRAY[$this->oCRNRSTN->request_id][$resource_id])){

                                                            $tmp_reset_ttl = true;

                                                        }

                                                    }

                                                    //error_log(__LINE__ . ' rrs map PUNTING FORWARD $ugc_value[' . $ugc_value . ']. $channel[' . $channel . '].');
                                                    error_log(__LINE__ . ' rrs map MERGE SESSION RESOURCE [' . $ugc_value . '] TO NEW STRUCTURE FOR [' . $channel . '] CACHE UPDATE.');

                                                    //
                                                    // MERGE EXISTING SESSION RESOURCE TO NEW STRUCTURE FOR SESSION CACHE UPDATE.
                                                    //$this->merge_resource_to_cache($resource_id, $ugc_value, $tmp_reset_ttl, $tmp_cache_profile_ARRAY, $channel);

                                                }

                                            }

                                            //
                                            // NEED TO PUNT TOTAL BYTES TO AFTER ALL CACHE PROCESSING IS COMPLETE.
                                            //$tmp_cache_profile_ARRAY[$this->oCRNRSTN->request_id]['channel_bytes'] = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['channel_bytes'];

                                            //error_log(__LINE__ . ' rrs map RRS_MAP_CACHE[' . print_r($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'][0], true) . '].');

                                        }

                                    }

                                break;
                                case CRNRSTN_CHANNEL_RUNTIME:

                                    //
                                    // WE ARE PROCESSING RUNTIME SYNC TO SESSION. CHECK IF SESSION CHANNEL IS ACTIVE.
                                    // WE'VE OPTED TO STEP AWAY FROM RUNTIME ACCELERATION TO GET A SMALLER
                                    // MEMORY FOOTPRINT.
                                    if($this->rrs_map_get($this->oCRNRSTN->get_channel_config($channel, 'NAME') . '_cache_is_active') == true){

                                        //
                                        // DO WE HAVE ANY RRS MAP CACHE DATA?
                                        //if(isset(self::$cache_rrs_map_output_method_ARRAY[$this->oCRNRSTN->request_id])){
                                        if(isset(self::$cache_id_ARRAY[$this->oCRNRSTN->request_id])){

                                            //
                                            // CYCLE THROUGH RUNTIME DATA AND BUILD NEW SESSION CACHE ADDING RUNTIME
                                            // DATA TO EXISTING SESSION DATA. EXCLUDE A RESOURCE IF THE REQUEST EXISTS
                                            // IN CACHE ALREADY, AND ADD ANY NEW RETURNS CURRENTLY IN RUNTIME...UP TO
                                            // THE MAX NUMBER OF BYTES FOR THE CHANNEL.
                                            foreach(self::$cache_id_ARRAY[$this->oCRNRSTN->request_id] as $ugc_value => $resource_id){

                                                $tmp_reset_ttl = false; // WE USE TIME() HERE.
                                                //$tmp_valid_resource_id_ARRAY[] = $resource_id;

                                                //
                                                // ONLY PROCESS IF NOT CURRENTLY IN RUNTIME AND NOT IN SESSION MEMORY.
                                                if(!isset($tmp_cache_profile_ARRAY['resource_id'][$ugc_value]) && !isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$ugc_value])){

                                                    //
                                                    // MERGE EXISTING RUNTIME RESOURCE TO NEW STRUCTURE FOR SESSION CACHE UPDATE.
                                                    error_log(__LINE__ . ' rrs map MERGE ' . $channel . ' RESOURCE [' . $ugc_value . '] TO NEW STRUCTURE FOR SESSION CACHE UPDATE.');
                                                    //error_log(__LINE__ . ' rrs map MERGE RUNTIME RESOURCE [' . $ugc_value . '] TO NEW STRUCTURE FOR SESSION CACHE UPDATE. RRS_MAP_CACHE[' . print_r($tmp_cache_profile_ARRAY, true) . '].');
                                                    //error_log(__LINE__ . ' rrs map PUNT $ugc_value[' . $ugc_value . ']. RESOURCE FORWARD $channel[' . $channel . '].');

                                                    //$tmp_cache_profile_ARRAY = $this->merge_resource_to_cache($resource_id, $ugc_value, $tmp_reset_ttl, $tmp_cache_profile_ARRAY, $channel);
                                                    $this->merge_resource_to_cache($resource_id, $ugc_value, $tmp_reset_ttl, $tmp_cache_profile_ARRAY, $channel);

                                                }

                                            }

                                            //error_log(__LINE__ . ' rrs map RRS_MAP_CACHE[' . print_r($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'][0], true) . '].');

                                        }

                                    }

                                break;
                                default:

                                    error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                                break;

                            }

                        }

                    }

                    //error_log(__LINE__ . ' rrs map $tmp_cache_profile_ARRAY[' . print_r($tmp_cache_profile_ARRAY, true) . '].');
                    return $tmp_cache_profile_ARRAY;

                break;
                default:

                    //error_log(__LINE__ . ' rss map Unknown channel [' . $channel . ']. Unable to return cache data.');
                    return $tmp_cache_profile_ARRAY;

                break;

            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN NOTHING
            return false;

        }

    }

    public function plaid($channel, $salt_ugc_override = NULL, $output_mode_override = NULL){

        //
        // TODO :: USE $salt_ugc_override AND $output_mode TO SUPPORT TAKING CRNRSTN_UI_STR TO PLAID VIA METHOD CALL.


        die();
        //
        // CRNRSTN :: PLAID.
        if($this->rrs_map_get($this->oCRNRSTN->get_channel_config($channel, 'NAME') . '_cache_is_active') == true){

            $tmp_session_salt = $this->oCRNRSTN->session_salt();
            $tmp_system_asset_family_ARRAY = array('system', 'social', 'favicon', 'js', 'css', 'integrations');

            //
            // SUPPORT FOR ASSET MAPPING RAW IMAGE RETURN,
            // RAW JS/CSS RETURN, MAYBE EVEN DEEP LINK
            // PROCESSING, REDIRECTS, STICKY LINKS, ...ETC.
            /*
            https://lightsaber.crnrstn.jony5.com/
                ?crnrstn_0010111011=     // $this->session_salt();
                &crnrstn_=
                &$this->session_salt();=
                &crnrstn_l=
                &crnrstn_m=
                &crnrstn_r=
                &crnrstn_sk=
                &crnrstn_bst=
                &crnrstn_sid=
                &crnrstn_smk=
                &crnrstn_css_valptrn=
                &crnrstn_encrypt_tunnel=
                &utm_source=
                &utm_medium=
                &utm_campaign=
                &utm_unptid=
                &utm_term=
                &fbclid=
                &gid=
                &pattern=
                &scope=
                &q=
                &w=
                &e=
                &r=
                &t=
                &y=
                &u=
                &i=
                &o=
                &p=
                &a=
                &s=
                &d=
                &f=
                &g=
                &h=
                &j=
                &k=
                &l=
                &z=
                &x=
                &v=
                &b=
                &n=
                &m=
                &geo=
                &hl=
                &language=
                &locale=
                &pmln=
                &domain=
                &content=
                &userId=
                &memberId=
                &c=
                &js=
                &noticeType=
                &text=
                &cdn=
                &pcookie=
                &gtm=
                &cid=
                &sourceid=
                &qs=
                &sc=
                &cvid=
                &FORM=
                &asbe=
                &filters=
                &sp=
                &lq=
                &aqs=
                &ie=
                &LinkId=
                &intent=
                &src=
                &ref_id=
                &ppid=
                &cnac=
                &rsta=
                &cust=
                &unptid=
                &calc=
                &unp_tpcid=
                &page=
                &pgrp=
                &mchn=
                &mail=
                &appVersion=
                &xt=
                &dest=
                &sourceId=
                &platform=
                &landing=
                &orientation=
                &pageType=
                &categoryName=
                &logged=
                &retargeted=
                &adblocked=
                &widgetName=
                &widgetElement=
                &isUserLogged=
                &isUserRetargeted=
                &segment=
                &exp=
                &xhStatsUid=
                &xhSessionToken=
                &xhSessionStartedAt=
                &remove_ads=
                &spot_owner=
                &spot_type=
                &spot_page_type=
                &spot_platform=
                &spot_orientation=
                &spot_is_logged=
                &spotPageType=
                &spotType=
                &locationCountry=
                &webp=
                &statsUID=
                &lenderref=
                &referralsource=
                &include=
                &qt=
                &C=
                &K=
                &M=
                &R=
                &T=
                &U=
                &H=
                &ref_=
                &$_ga=
                &aref=
                &medium=
                &mid=
                &bcode=
                &n_m=
                &lloc=
                &rms=
                &irms=
                &lipi=
                &midSig=
                &trkEmail=
                &trk=
                &_sig=
                &id=
                &target_user_id=
                &click_source=
                &token=
                &uid=
                &bypass=
                &url=
                &cn=
                &sig=
                &iid=
                &nid=
                &sa=
                &ai=
                &ae=
                &ase=
                &gclid=
                &cit=
                &num=
                &adurl=
                &client=
                &label=
                &_t=
                &_m=
                &_e=
                &ts=
                &endpoint=
                &flow=
                &term=
                &addItem=
                &jtype=
                &prodCode=
                &quantity=
                &path=
                &channel=
                &plan=
                &dpr=
                &fmt=
                &tlds=
                &allowPriorityTlds=
                &edsDomainsSearch=
                &domainNames=
                &family=
                &display=
                &_V_2=
                &_K11_=
                &_L54AD1F204_=
                &_K13_1=
                &_K14_=
                &ui=
                &ik=
                &view=
                &permmsgid=
                &ser=
                &jwtH=
                &jwtP=
                &jwtS=
                &__dU__=
                &__F__=
                &ch=
                &user_id=
                &od=
                &target=
                &upn=
                &clabid=
                &p1=
                &p2=
                &p3=
                &p4=
                &p5=
                &p6=
                &p7=
                &p8=
                &p9=
                &p10=
                &mh=

            */

            if(isset($_GET[$tmp_session_salt])){

                $tmp_salt_ugc = $_GET[$tmp_session_salt];

                //
                // LOOP THROUGH ASSET FAMILIES FOR SALT_UGC MATCH.
                foreach($tmp_system_asset_family_ARRAY as $fam_index => $asset_family){

                    //
                    // IS THIS A RECOGNIZED KEY WITHIN THE ASSET FAMILY?
                    if(isset($this->oCRNRSTN->asset_routing_data_key_lookup_ARRAY[$asset_family][$tmp_salt_ugc])){

                        //
                        // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                        // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                        $this->oCRNRSTN->initialize_bit(CRNRSTN_ASSET_MAPPING);
                        $this->oCRNRSTN->initialize_bit(CRNRSTN_CHANNEL_GET);

                        self::$gone_to_plaid_ARRAY[CRNRSTN_ASSET_MAPPING] = 1;

                        //
                        // INITIALIZE CHANNEL CACHE ID.
                        if(!isset(self::$channel_cache_id_ARRAY[$channel])){

                            self::$channel_cache_id_ARRAY[$channel] = 0;

                        }

                        $tmp_meta_data_key = $this->oCRNRSTN->asset_routing_data_key_lookup_ARRAY[$asset_family][$tmp_salt_ugc];

                        if(true !== $this->to_plaid($channel, $tmp_salt_ugc, $asset_family, $tmp_meta_data_key, $output_mode_override, __FUNCTION__)){

                            //
                            // FILE NOT FOUND.
                            // TODO :: CAN WE RETURN A "404-IMAGE" THAT WILL HONOR THE SITUATION. E.G.  BLUEHOST "SITE COMING SOON" IMAGE.
                            $this->oCRNRSTN->return_server_response_code(404, $this->oCRNRSTN->return_CRNRSTN_ASCII_ART());

                        }

                    }

                }

            }

        }

        error_log(__LINE__ . ' rrs map NEED REMAP UNTO TO_PLAID() FOR --> $_GET[' . $_GET[$tmp_session_salt] . ']. $salt_ugc_override[' . $salt_ugc_override . ']. NOW ON CRNRSTN :: PLAID.');
        //die();

        //
        // CRNRSTN :: MAPPED JAVASCRIPT AND CSS RESOURCES WILL PASS BY HERE.
        $tmp_str = '';

        //
        // IF ACTIVE, PROCESS SESSION ACCELERATION.
        // $UGC_OVERRIDE COMES FROM RUNTIME CRNRSTN_STRING IMAGE METHOD CALLS. SO THE URL CAN JUST BE RETURNED.
        if((self::$session_cache_is_active == true) || isset($salt_ugc_override)){

            $tmp_session_salt = $this->oCRNRSTN->session_salt();

            if(isset($_GET[$tmp_session_salt]) || isset($salt_ugc_override)){

                error_log(__LINE__ . ' rrs map NEED REMAP UNTO TO_PLAID() FOR --> $_GET[' . $_GET[$tmp_session_salt] . ']. $salt_ugc_override[' . $salt_ugc_override . ']. NOW ON CRNRSTN :: PLAID.');

                //die();
                $tmp_salt_ugc = $salt_ugc_override;

                if(isset($_GET[$tmp_session_salt]) && strlen($salt_ugc_override) < 1){

                    $tmp_salt_ugc = $_GET[$tmp_session_salt];

                }

//                //
//                // DOES RUNTIME HAVE THE...SAUCE?
//                if(isset($salt_ugc_override)){
//
//                    //error_log(__LINE__ . ' rrs map RETURN STRING LINK AND EXIT[' . print_r(self::$request_map_output_mode_ARRAY, true) . '].');
//
//                    if(isset(self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$salt_ugc_override])){
//
//                        if(isset(self::$cache_rrs_map_image_string_ARRAY[$this->oCRNRSTN->request_id][self::$request_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$salt_ugc_override]]][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$salt_ugc_override]])){
//
                            //self::$gone_to_plaid_ARRAY[CRNRSTN_ASSET_MAPPING] = true;
//                            $tmp_url = self::$cache_rrs_map_image_string_ARRAY[$this->oCRNRSTN->request_id][self::$request_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$salt_ugc_override]]][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$salt_ugc_override]];
//
//                            //error_log(__LINE__ . ' asset mgr Application Acceleration [runtime] FIRE. RRS Map resource return.');
//                            return $tmp_url;
//
//                        }
//
//                    }
//
//                }

                //
                // DOES SESSION HAVE THE...SAUCE?
                if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$tmp_salt_ugc])){

                    if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['output_mode'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$tmp_salt_ugc]])){

                        $tmp_asset_meta_key = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['asset_meta_key'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$tmp_salt_ugc]];
                        $tmp_request_ugc_value = $tmp_salt_ugc;
                        $tmp_request_family = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['asset_family'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$tmp_salt_ugc]];

                        if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['meta_path'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$tmp_salt_ugc]])){

                            $tmp_asset_meta_path = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['meta_path'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$tmp_salt_ugc]];

                        }else{

                            $tmp_asset_meta_path = '';

                        }

                        $tmp_output_mode = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['output_mode'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$tmp_salt_ugc]];

                        switch($tmp_output_mode){
                            case CRNRSTN_STRING:

                                if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['url'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$tmp_salt_ugc]])){

                                    //self::$gone_to_plaid_ARRAY[$channel] = true;
                                    $tmp_url = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['url'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['output_mode'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$tmp_salt_ugc]]][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$tmp_salt_ugc]];

                                    error_log(__LINE__ . ' asset mgr Application Acceleration [session] FIRE. RRS Map resource return.');

                                    return $tmp_url;

                                }

                            break;
                            case CRNRSTN_CSS:
                            case CRNRSTN_JS:

                                //self::$gone_to_plaid_ARRAY[$channel] = true;
                                error_log(__LINE__ . ' rrs map Application Acceleration [session] FIRE. $tmp_salt_ugc[' . $tmp_salt_ugc . '].');

                                $tmp_str = $this->oCRNRSTN->return_asset_data($tmp_request_ugc_value, $tmp_request_family, $tmp_asset_meta_key, $tmp_asset_meta_path, 'session');

                            break;
                            case CRNRSTN_IMG:
                            case CRNRSTN_FAVICON:

                                $tmp_rrs_map_filename = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['rrs_map_filename'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$tmp_salt_ugc]];
                                $tmp_rrs_map_filepath = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['rrs_map_filepath'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$tmp_salt_ugc]];
                                $tmp_rrs_map_file_extension = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['rrs_map_file_extension'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$tmp_salt_ugc]];

                                error_log(__LINE__ . ' rrs map Application Acceleration [session] FIRE. $tmp_salt_ugc[' . $tmp_salt_ugc . '/' . $tmp_asset_meta_key . '].');

                                //self::$gone_to_plaid_ARRAY[$channel] = true;

                                //
                                // EXTRACT (FROM SYSTEM SETTINGS) THE MAXIMUM NUMBER OF ASSETS TO REPORT UPON.
                                $tmp_max_asset = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');

                                if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP_CACHE_REPORT']['rrs_map_report'][$tmp_salt_ugc])){

                                    $tmp_cnt = count($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP_CACHE_REPORT']['rrs_map_report'][$tmp_salt_ugc]);

                                }

                                //
                                // IF WITHIN REPORTING LIMITS FOR MAX NUMBER OF ASSETS TO REPORT.
                                if($tmp_cnt < ((int) $tmp_max_asset - 1)){

                                    $mem_report_queue = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');
                                    $mem_reports_ARRAY = $this->oCRNRSTN->mem_report($mem_report_queue, 'HTML', 10, true);

                                    //
                                    // WRITE CRNRSTN :: PLAID REPORTING TO SESSION.
                                    $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP_CACHE_REPORT']['rrs_map_report'][$tmp_salt_ugc]['mem_report'][] = $mem_reports_ARRAY;

                                }

                                return $this->oCRNRSTN->return_file_byte_chunked_buffer_output($tmp_rrs_map_filepath, $tmp_rrs_map_filename, $tmp_rrs_map_file_extension, CRNRSTN_IMG, 'session');

                            break;
                            case CRNRSTN_HTML:
                            case CRNRSTN_HTML & CRNRSTN_PNG:
                            case CRNRSTN_HTML & CRNRSTN_ASSET_MODE_PNG:
                            case CRNRSTN_HTML & CRNRSTN_BASE64_PNG:
                            case CRNRSTN_HTML & CRNRSTN_ASSET_MODE_JPEG:
                            case CRNRSTN_HTML & CRNRSTN_JPEG:
                            case CRNRSTN_HTML & CRNRSTN_ASSET_MODE_BASE64:
                            case CRNRSTN_HTML & CRNRSTN_BASE64:
                            case CRNRSTN_HTML & CRNRSTN_BASE64_JPEG:
                            case CRNRSTN_HTML & CRNRSTN_ASSET_MODE_BASE64 & CRNRSTN_JPEG:

                                $tmp_rrs_map_filename = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['rrs_map_filename'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$tmp_salt_ugc]];
                                $tmp_rrs_map_filepath = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['rrs_map_filepath'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$tmp_salt_ugc]];
                                $tmp_rrs_map_file_extension = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['rrs_map_file_extension'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$tmp_salt_ugc]];

                                error_log(__LINE__ . ' rrs map Application Acceleration [session] FIRE. $tmp_salt_ugc[' . $tmp_salt_ugc . '/' . $tmp_asset_meta_key . '].');

                                //self::$gone_to_plaid_ARRAY[$channel] = true;

                                //
                                // EXTRACT (FROM SYSTEM SETTINGS) THE MAXIMUM NUMBER OF ASSETS TO REPORT UPON.
                                $tmp_max_asset = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');

                                if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP_CACHE_REPORT']['rrs_map_report'][$tmp_salt_ugc])){

                                    $tmp_cnt = count($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP_CACHE_REPORT']['rrs_map_report'][$tmp_salt_ugc]);

                                }

                                //
                                // IF WITHIN REPORTING LIMITS FOR MAX NUMBER OF ASSETS TO REPORT.
                                if($tmp_cnt < ((int) $tmp_max_asset - 1)){

                                    $mem_report_queue = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');
                                    $mem_reports_ARRAY = $this->oCRNRSTN->mem_report($mem_report_queue, 'HTML', 10, true);

                                    //
                                    // WRITE CRNRSTN :: PLAID REPORTING TO SESSION.
                                    $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP_CACHE_REPORT']['rrs_map_report'][$tmp_salt_ugc]['mem_report'][] = $mem_reports_ARRAY;

                                }

                                return $this->oCRNRSTN->return_file_byte_chunked_buffer_output($tmp_rrs_map_filepath, $tmp_rrs_map_filename, $tmp_rrs_map_file_extension, CRNRSTN_IMG, 'session');

                            break;
                            default:

                                error_log(__LINE__ . ' rrs map Application Acceleration [session] MISFIRE. $tmp_salt_ugc[' . $tmp_salt_ugc . '].');
                                error_log(__LINE__ . ' rrs map YA MISSED ONE. output_mode[' . $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['output_mode'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$tmp_salt_ugc]] . '] YEP. GOTTA DO THIS HERE.');

                                return $tmp_str;

                            break;

                        }

                    }

                    //
                    // EXTRACT (FROM SYSTEM SETTINGS) THE MAXIMUM NUMBER OF ASSETS TO REPORT UPON.
                    $tmp_cnt = 0;
                    $tmp_max_asset = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');

                    if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP_CACHE_REPORT']['rrs_map_report'][$tmp_salt_ugc])){

                        $tmp_cnt = count($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP_CACHE_REPORT']['rrs_map_report'][$tmp_salt_ugc]);

                    }

                    //
                    // IF WITHIN REPORTING LIMITS FOR MAX NUMBER OF ASSETS TO REPORT.
                    if($tmp_cnt < ((int) $tmp_max_asset - 1)){

                        $mem_report_queue = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');
                        $mem_reports_ARRAY = $this->oCRNRSTN->mem_report($mem_report_queue, 'HTML', 10, true);

                        //
                        // WRITE CRNRSTN :: PLAID REPORTING TO SESSION.
                        $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP_CACHE_REPORT']['rrs_map_report'][$tmp_salt_ugc]['mem_report'][] = $mem_reports_ARRAY;

                    }

                }

            }

        }

        return $tmp_str;

    }

    public function gone_to_plaid($data_key, $system, $channel){

        //
        // THIS WILL CRASH THE PSSDTLA.
//        //
//        // SET THIS ARRAY. THIS OVERRIDE ACTION IS METHOD CALL [return_creative()]
//        // DRIVEN. NOT HTTP $_GET[] DRIVEN.
//        if(isset($system_override)){
//
//            self::$gone_to_plaid_ARRAY[$system] = 1;
//
//            return true;
//
//        }

        //
        // CHECK
        if(isset(self::$gone_to_plaid_ARRAY[$system])){

            return true;

        }

        return false;

    }

    public function rrs_map_total_cache_bytes($channel = NULL){

        return $this->rrs_map_get('total_bytes', $channel);

    }

    public function rrs_map_get($name, $channel = NULL){

        //
        // GET CHANNEL AUTHORIZATION INTEGER CONSTANT.
        $channel_int = $this->oCRNRSTN->get_channel_config($channel, 'AUTHORIZATION', 'PROFILE', 'PRIMARY', CRNRSTN_INTEGER);

        switch($name){
            case 'total_channel_bytes':

                switch($channel_int){
                    case CRNRSTN_CHANNEL_GET:
                        //G :: HTTP $_GET REQUEST.
                    case CRNRSTN_CHANNEL_POST:
                        //P :: HTTP $_POST REQUEST.
                    case CRNRSTN_CHANNEL_COOKIE:
                        //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
                    case CRNRSTN_CHANNEL_SESSION:
                        //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).
                    case CRNRSTN_CHANNEL_DATABASE:
                        //D :: DATABASE (MySQLi CONNECTION).
                    case CRNRSTN_CHANNEL_SSDTLA:
                        //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).
                    case CRNRSTN_CHANNEL_PSSDTLA:
                        //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                    case CRNRSTN_CHANNEL_RUNTIME:
                        //R :: RUNTIME.
                    case CRNRSTN_CHANNEL_SOAP:
                        //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                    case CRNRSTN_CHANNEL_FILE:
                        //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).

                        return $this->get_config_cache('channel_bytes', NULL, 'DDO', NULL, $channel_int);

                    break;
                    default:

                        error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                    break;

                }

            break;
            case 'total_bytes':

                $tmp_ARRAY = array();

                if(isset($channel)){

                    $tmp_ARRAY[$channel] = $this->get_config_cache('channel_bytes', NULL, 'DDO', NULL, $channel_int);
                    error_log(__LINE__  . ' rrs map GET TOTAL BYTES[' . print_r($tmp_ARRAY, true) . '].');

                    return $tmp_ARRAY;

                }

                $tmp_channels_ARRAY = $this->oCRNRSTN->return_master_channels_ARRAY();

                foreach($tmp_channels_ARRAY as $channel_int => $ch_alpha){

                    switch($channel_int){
                        case CRNRSTN_CHANNEL_GET:
                            //G :: HTTP $_GET REQUEST.
                        case CRNRSTN_CHANNEL_POST:
                            //P :: HTTP $_POST REQUEST.
                        case CRNRSTN_CHANNEL_COOKIE:
                            //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
                        case CRNRSTN_CHANNEL_SESSION:
                            //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).
                        case CRNRSTN_CHANNEL_DATABASE:
                            //D :: DATABASE (MySQLi CONNECTION).
                        case CRNRSTN_CHANNEL_SSDTLA:
                            //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).
                        case CRNRSTN_CHANNEL_PSSDTLA:
                            //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                        case CRNRSTN_CHANNEL_RUNTIME:
                            //R :: RUNTIME.
                        case CRNRSTN_CHANNEL_SOAP:
                            //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                        case CRNRSTN_CHANNEL_FILE:
                            //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).

                            $tmp_ARRAY[$channel_int] = $this->get_config_cache('channel_bytes', NULL, 'DDO', NULL, $channel_int);

                        break;
                        default:

                            error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                        break;

                    }

                }

                //error_log(__LINE__ . ' rrs map RETURNING $tmp_ARRAY[' . print_r($tmp_ARRAY, true) . ']. $name[' . $name . '].');
                error_log(__LINE__  . ' rrs map RETURNING TOTAL BYTES[' . print_r($tmp_ARRAY, true) . '].');

                return $tmp_ARRAY;

            break;
            case 'map_cache_is_active':

                //
                // CRNRSTN :: APPLICATION ACCELERATION.
                // BOTH NEED TO BE TRUE TO GO CRNRSTN :: PLAID. [See _crnrstn/_config/_config.defaults/_crnrstn.system_settings.inc.php]
                if(self::$runtime_cache_is_active == true && self::$session_cache_is_active == true){

                    return true;

                }

                /*
                return self::$cookie_cache_is_active; [NEEDS JSON OBJECT CONVERSION + ENCRYPTION]
                return self::$ssdtla_cache_is_active; [NEEDS JSON OBJECT CONVERSION + ENCRYPTION]
                return self::$pssdtla_cache_is_active; [NEEDS JSON OBJECT CONVERSION + ENCRYPTION]
                return self::$database_cache_is_active; [NEEDS JSON OBJECT CONVERSION]

                */

                return false;

            break;
            case 'cache_master_channels':

                return $this->oCRNRSTN->return_master_channels_ARRAY();

            break;
            case 'cache_channels':

                return self::$channel_ARRAY;

            break;
            case 'get_cache_is_active':

                return self::$get_cache_is_active;

            break;
            case 'post_cache_is_active':

                return self::$post_cache_is_active;

            break;
            case 'cookie_cache_is_active':

                return self::$cookie_cache_is_active;

            break;
            case 'session_cache_is_active':

                return self::$session_cache_is_active;

            break;
            case 'database_cache_is_active':

                return self::$database_cache_is_active;

            break;
            case 'ssdtla_cache_is_active':

                return self::$ssdtla_cache_is_active;

            break;
            case 'pssdtla_cache_is_active':

                return self::$pssdtla_cache_is_active;

            break;
            case 'runtime_cache_is_active':

                return self::$runtime_cache_is_active;

            break;
            case 'soap_cache_is_active':

                return self::$soap_cache_is_active;

            break;
            case 'file_cache_is_active':

                return self::$file_cache_is_active;

            break;
            case 'get_max_map_cache_bytes':

                return self::$get_max_map_cache_bytes;

            break;
            case 'post_max_map_cache_bytes':

                return self::$post_max_map_cache_bytes;

            break;
            case 'cookie_max_map_cache_bytes':

                return self::$cookie_max_map_cache_bytes;

            break;
            case 'session_max_map_cache_bytes':

                return self::$session_max_map_cache_bytes;

            break;
            case 'database_max_map_cache_bytes':

                return self::$database_max_map_cache_bytes;

            break;
            case 'ssdtla_max_map_cache_bytes':

                return self::$ssdtla_max_map_cache_bytes;

            break;
            case 'pssdtla_max_map_cache_bytes':

                return self::$pssdtla_max_map_cache_bytes;

            break;
            case 'runtime_max_map_cache_bytes':

                return self::$runtime_max_map_cache_bytes;

            break;
            case 'soap_max_map_cache_bytes':

                return self::$soap_max_map_cache_bytes;

            break;
            case 'file_max_map_cache_bytes':

                return self::$file_max_map_cache_bytes;

            break;
            case 'get_map_cache_ttl':

                return self::$get_map_cache_ttl;

            break;
            case 'post_map_cache_ttl':

                return self::$post_map_cache_ttl;

            break;
            case 'cookie_map_cache_ttl':

                return self::$cookie_map_cache_ttl;

            break;
            case 'session_map_cache_ttl':

                return self::$session_map_cache_ttl;

            break;
            case 'database_map_cache_ttl':

                return self::$database_map_cache_ttl;

            break;
            case 'ssdtla_map_cache_ttl':

                return self::$ssdtla_map_cache_ttl;

            break;
            case 'pssdtla_map_cache_ttl':

                return self::$pssdtla_map_cache_ttl;

            break;
            case 'runtime_map_cache_ttl':

                return self::$runtime_map_cache_ttl;

            break;
            case 'soap_map_cache_ttl':

                return self::$soap_map_cache_ttl;

            break;
            case 'file_map_cache_ttl':

                return self::$file_map_cache_ttl;

            break;
            case 'get_encryption_profile':

                return self::$get_encryption_profile;

            break;
            case 'post_encryption_profile':

                return self::$post_encryption_profile;

            break;
            case 'cookie_encryption_profile':

                return self::$cookie_encryption_profile;

            break;
            case 'session_encryption_profile':

                return self::$session_encryption_profile;

            break;
            case 'database_encryption_profile':

                return self::$database_encryption_profile;

            break;
            case 'ssdtla_encryption_profile':

                return self::$ssdtla_encryption_profile;

            break;
            case 'pssdtla_encryption_profile':

                return self::$pssdtla_encryption_profile;

            break;
            case 'runtime_encryption_profile':

                return self::$runtime_encryption_profile;

            break;
            case 'soap_encryption_profile':

                return self::$soap_encryption_profile;

            break;
            case 'file_encryption_profile':

                return self::$file_encryption_profile;

            break;
            case 'get_php_sessionid':

                return self::$get_php_sessionid;

            break;
            case 'post_php_sessionid':

                return self::$post_php_sessionid;

            break;
            case 'cookie_php_sessionid':

                return self::$cookie_php_sessionid;

            break;
            case 'session_php_sessionid':

                return self::$session_php_sessionid;

            break;
            case 'database_php_sessionid':

                return self::$database_php_sessionid;

            break;
            case 'ssdtla_php_sessionid':

                return self::$ssdtla_php_sessionid;

            break;
            case 'pssdtla_php_sessionid':

                return self::$pssdtla_php_sessionid;

            break;
            case 'runtime_php_sessionid':

                return self::$runtime_php_sessionid;

            break;
            case 'soap_php_sessionid':

                return self::$soap_php_sessionid;

            break;
            case 'file_php_sessionid':

                return self::$file_php_sessionid;

            break;
            case 'get_client_ip_address':

                return self::$get_client_ip_address;

            break;
            case 'post_client_ip_address':

                return self::$post_client_ip_address;

            break;
            case 'cookie_client_ip_address':

                return self::$cookie_client_ip_address;

            break;
            case 'session_client_ip_address':

                return self::$session_client_ip_address;

            break;
            case 'database_client_ip_address':

                return self::$database_client_ip_address;

            break;
            case 'ssdtla_client_ip_address':

                return self::$ssdtla_client_ip_address;

            break;
            case 'pssdtla_client_ip_address':

                return self::$pssdtla_client_ip_address;

            break;
            case 'runtime_client_ip_address':

                return self::$runtime_client_ip_address;

            break;
            case 'soap_client_ip_address':

                return self::$soap_client_ip_address;

            break;
            case 'file_client_ip_address':

                return self::$file_client_ip_address;

            break;
            case 'get_channel_config_ini_call_timestamp':

                return self::$get_channel_config_ini_call_timestamp;

            break;
            case 'post_channel_config_ini_call_timestamp':

                return self::$post_channel_config_ini_call_timestamp;

            break;
            case 'cookie_channel_config_ini_call_timestamp':

                return self::$cookie_channel_config_ini_call_timestamp;

            break;
            case 'session_channel_config_ini_call_timestamp':

                return self::$session_channel_config_ini_call_timestamp;

            break;
            case 'database_channel_config_ini_call_timestamp':

                return self::$database_channel_config_ini_call_timestamp;

            break;
            case 'ssdtla_channel_config_ini_call_timestamp':

                return self::$ssdtla_channel_config_ini_call_timestamp;

            break;
            case 'pssdtla_channel_config_ini_call_timestamp':

                return self::$pssdtla_channel_config_ini_call_timestamp;

            break;
            case 'runtime_channel_config_ini_call_timestamp':

                return self::$runtime_channel_config_ini_call_timestamp;

            break;
            case 'soap_channel_config_ini_call_timestamp':

                return self::$soap_channel_config_ini_call_timestamp;

            break;
            case 'file_channel_config_ini_call_timestamp':

                return self::$file_channel_config_ini_call_timestamp;

            break;
            case 'get_channel_is_opened_timestamp':

                return self::$get_channel_is_opened_timestamp;

            break;
            case 'post_channel_is_opened_timestamp':

                return self::$post_channel_is_opened_timestamp;

            break;
            case 'cookie_channel_is_opened_timestamp':

                return self::$cookie_channel_is_opened_timestamp;

            break;
            case 'session_channel_is_opened_timestamp':

                return self::$session_channel_is_opened_timestamp;

            break;
            case 'database_channel_is_opened_timestamp':

                return self::$database_channel_is_opened_timestamp;

            break;
            case 'ssdtla_channel_is_opened_timestamp':

                return self::$ssdtla_channel_is_opened_timestamp;

            break;
            case 'pssdtla_channel_is_opened_timestamp':

                return self::$pssdtla_channel_is_opened_timestamp;

            break;
            case 'runtime_channel_is_opened_timestamp':

                return self::$runtime_channel_is_opened_timestamp;

            break;
            case 'soap_channel_is_opened_timestamp':

                return self::$soap_channel_is_opened_timestamp;

            break;
            case 'file_channel_is_opened_timestamp':

                return self::$file_channel_is_opened_timestamp;

            break;
            case 'get_channel_is_closed_timestamp':

                return self::$get_channel_is_closed_timestamp;

            break;
            case 'post_channel_is_closed_timestamp':

                return self::$post_channel_is_closed_timestamp;

            break;
            case 'cookie_channel_is_closed_timestamp':

                return self::$cookie_channel_is_closed_timestamp;

            break;
            case 'session_channel_is_closed_timestamp':

                return self::$session_channel_is_closed_timestamp;

            break;
            case 'database_channel_is_closed_timestamp':

                return self::$database_channel_is_closed_timestamp;

            break;
            case 'ssdtla_channel_is_closed_timestamp':

                return self::$ssdtla_channel_is_closed_timestamp;

            break;
            case 'pssdtla_channel_is_closed_timestamp':

                return self::$pssdtla_channel_is_closed_timestamp;

            break;
            case 'runtime_channel_is_closed_timestamp':

                return self::$runtime_channel_is_closed_timestamp;

            break;
            case 'soap_channel_is_closed_timestamp':

                return self::$soap_channel_is_closed_timestamp;

            break;
            case 'file_channel_is_closed_timestamp':

                return self::$file_channel_is_closed_timestamp;

            break;
            case 'get_ddo_begin_data_receipt_timestamp':

                return self::$get_ddo_begin_data_receipt_timestamp;

            break;
            case 'post_ddo_begin_data_receipt_timestamp':

                return self::$post_ddo_begin_data_receipt_timestamp;

            break;
            case 'cookie_ddo_begin_data_receipt_timestamp':

                return self::$cookie_ddo_begin_data_receipt_timestamp;

            break;
            case 'session_ddo_begin_data_receipt_timestamp':

                return self::$session_ddo_begin_data_receipt_timestamp;

            break;
            case 'database_ddo_begin_data_receipt_timestamp':

                return self::$database_ddo_begin_data_receipt_timestamp;

            break;
            case 'ssdtla_ddo_begin_data_receipt_timestamp':

                return self::$ssdtla_ddo_begin_data_receipt_timestamp;

            break;
            case 'pssdtla_ddo_begin_data_receipt_timestamp':

                return self::$pssdtla_ddo_begin_data_receipt_timestamp;

            break;
            case 'runtime_ddo_begin_data_receipt_timestamp':

                return self::$runtime_ddo_begin_data_receipt_timestamp;

            break;
            case 'soap_ddo_begin_data_receipt_timestamp':

                return self::$soap_ddo_begin_data_receipt_timestamp;

            break;
            case 'file_ddo_begin_data_receipt_timestamp':

                return self::$file_ddo_begin_data_receipt_timestamp;

            break;
            case 'get_ddo_data_complete_timestamp':

                return self::$get_ddo_data_complete_timestamp;

            break;
            case 'post_ddo_data_complete_timestamp':

                return self::$post_ddo_data_complete_timestamp;

            break;
            case 'cookie_ddo_data_complete_timestamp':

                return self::$cookie_ddo_data_complete_timestamp;

            break;
            case 'session_ddo_data_complete_timestamp':

                return self::$session_ddo_data_complete_timestamp;

            break;
            case 'database_ddo_data_complete_timestamp':

                return self::$database_ddo_data_complete_timestamp;

            break;
            case 'ssdtla_ddo_data_complete_timestamp':

                return self::$ssdtla_ddo_data_complete_timestamp;

            break;
            case 'pssdtla_ddo_data_complete_timestamp':

                return self::$pssdtla_ddo_data_complete_timestamp;

            break;
            case 'runtime_ddo_data_complete_timestamp':

                return self::$runtime_ddo_data_complete_timestamp;

            break;
            case 'soap_ddo_data_complete_timestamp':

                return self::$soap_ddo_data_complete_timestamp;

            break;
            case 'file_ddo_data_complete_timestamp':

                return self::$file_ddo_data_complete_timestamp;

            break;
            case 'get_channel_opened_count':

                return self::$get_channel_opened_count;

            break;
            case 'post_channel_opened_count':

                return self::$post_channel_opened_count;

            break;
            case 'cookie_channel_opened_count':

                return self::$cookie_channel_opened_count;

            break;
            case 'session_channel_opened_count':

                return self::$session_channel_opened_count;

            break;
            case 'database_channel_opened_count':

                return self::$database_channel_opened_count;

            break;
            case 'ssdtla_channel_opened_count':

                return self::$ssdtla_channel_opened_count;

            break;
            case 'pssdtla_channel_opened_count':

                return self::$pssdtla_channel_opened_count;

            break;
            case 'runtime_channel_opened_count':

                return self::$runtime_channel_opened_count;

            break;
            case 'soap_channel_opened_count':

                return self::$soap_channel_opened_count;

            break;
            case 'file_channel_opened_count':

                return self::$file_channel_opened_count;

            break;
            case 'get_last_packet_bytes_total':

                return self::$get_last_packet_bytes_total;

            break;
            case 'post_last_packet_bytes_total':

                return self::$post_last_packet_bytes_total;

            break;
            case 'cookie_last_packet_bytes_total':

                return self::$cookie_last_packet_bytes_total;

            break;
            case 'session_last_packet_bytes_total':

                return self::$session_last_packet_bytes_total;

            break;
            case 'database_last_packet_bytes_total':

                return self::$database_last_packet_bytes_total;

            break;
            case 'ssdtla_last_packet_bytes_total':

                return self::$ssdtla_last_packet_bytes_total;

            break;
            case 'pssdtla_last_packet_bytes_total':

                return self::$pssdtla_last_packet_bytes_total;

            break;
            case 'runtime_last_packet_bytes_total':

                return self::$runtime_last_packet_bytes_total;

            break;
            case 'soap_last_packet_bytes_total':

                return self::$soap_last_packet_bytes_total;

            break;
            case 'file_last_packet_bytes_total':

                return self::$file_last_packet_bytes_total;

            break;
            case 'get_total_packet_bytes':

                return self::$get_total_packet_bytes;

            break;
            case 'post_total_packet_bytes':

                return self::$post_total_packet_bytes;

            break;
            case 'cookie_total_packet_bytes':

                return self::$cookie_total_packet_bytes;

            break;
            case 'session_total_packet_bytes':

                return self::$session_total_packet_bytes;

            break;
            case 'database_total_packet_bytes':

                return self::$database_total_packet_bytes;

            break;
            case 'ssdtla_total_packet_bytes':

                return self::$ssdtla_total_packet_bytes;

            break;
            case 'pssdtla_total_packet_bytes':

                return self::$pssdtla_total_packet_bytes;

            break;
            case 'runtime_total_packet_bytes':

                return self::$runtime_total_packet_bytes;

            break;
            case 'soap_total_packet_bytes':

                return self::$soap_total_packet_bytes;

            break;
            case 'file_total_packet_bytes':

                return self::$file_total_packet_bytes;

            break;
            case 'get_last_packet_bytes_received':

                return self::$get_last_packet_bytes_received;

            break;
            case 'post_last_packet_bytes_received':

                return self::$post_last_packet_bytes_received;

            break;
            case 'cookie_last_packet_bytes_received':

                return self::$cookie_last_packet_bytes_received;

            break;
            case 'session_last_packet_bytes_received':

                return self::$session_last_packet_bytes_received;

            break;
            case 'database_last_packet_bytes_received':

                return self::$database_last_packet_bytes_received;

            break;
            case 'ssdtla_last_packet_bytes_received':

                return self::$ssdtla_last_packet_bytes_received;

            break;
            case 'pssdtla_last_packet_bytes_received':

                return self::$pssdtla_last_packet_bytes_received;

            break;
            case 'runtime_last_packet_bytes_received':

                return self::$runtime_last_packet_bytes_received;

            break;
            case 'soap_last_packet_bytes_received':

                return self::$soap_last_packet_bytes_received;

            break;
            case 'file_last_packet_bytes_received':

                return self::$file_last_packet_bytes_received;

            break;
            case 'get_total_bytes_received':

                return self::$get_total_bytes_received;

            break;
            case 'post_total_bytes_received':

                return self::$post_total_bytes_received;

            break;
            case 'cookie_total_bytes_received':

                return self::$cookie_total_bytes_received;

            break;
            case 'session_total_bytes_received':

                return self::$session_total_bytes_received;

            break;
            case 'database_total_bytes_received':

                return self::$database_total_bytes_received;

            break;
            case 'ssdtla_total_bytes_received':

                return self::$ssdtla_total_bytes_received;

            break;
            case 'pssdtla_total_bytes_received':

                return self::$pssdtla_total_bytes_received;

            break;
            case 'runtime_total_bytes_received':

                return self::$runtime_total_bytes_received;

            break;
            case 'soap_total_bytes_received':

                return self::$soap_total_bytes_received;

            break;
            case 'file_total_bytes_received':

                return self::$file_total_bytes_received;

            break;
            case 'get_last_opened_timestamp':

                return self::$get_last_opened_timestamp;

            break;
            case 'post_last_opened_timestamp':

                return self::$post_last_opened_timestamp;

            break;
            case 'cookie_last_opened_timestamp':

                return self::$cookie_last_opened_timestamp;

            break;
            case 'session_last_opened_timestamp':

                return self::$session_last_opened_timestamp;

            break;
            case 'database_last_opened_timestamp':

                return self::$database_last_opened_timestamp;

            break;
            case 'ssdtla_last_opened_timestamp':

                return self::$ssdtla_last_opened_timestamp;

            break;
            case 'pssdtla_last_opened_timestamp':

                return self::$pssdtla_last_opened_timestamp;

            break;
            case 'runtime_last_opened_timestamp':

                return self::$runtime_last_opened_timestamp;

            break;
            case 'soap_last_opened_timestamp':

                return self::$soap_last_opened_timestamp;

            break;
            case 'file_last_opened_timestamp':

                return self::$file_last_opened_timestamp;

            break;
            case 'get_last_closed_timestamp':

                return self::$get_last_closed_timestamp;

            break;
            case 'post_last_closed_timestamp':

                return self::$post_last_closed_timestamp;

            break;
            case 'cookie_last_closed_timestamp':

                return self::$cookie_last_closed_timestamp;

            break;
            case 'session_last_closed_timestamp':

                return self::$session_last_closed_timestamp;

            break;
            case 'database_last_closed_timestamp':

                return self::$database_last_closed_timestamp;

            break;
            case 'ssdtla_last_closed_timestamp':

                return self::$ssdtla_last_closed_timestamp;

            break;
            case 'pssdtla_last_closed_timestamp':

                return self::$pssdtla_last_closed_timestamp;

            break;
            case 'runtime_last_closed_timestamp':

                return self::$runtime_last_closed_timestamp;

            break;
            case 'soap_last_closed_timestamp':

                return self::$soap_last_closed_timestamp;

            break;
            case 'file_last_closed_timestamp':

                return self::$file_last_closed_timestamp;

            break;
            default:

                error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                return false;

            break;

        }

    }

    public function rrs_map_set($name, $value){

        switch($name){
            case 'get_cache_is_active':

                self::$get_cache_is_active = $value;

                error_log(__LINE__ . ' rrs map add cache CHANNEL $_GET[] via rrs_map_set(). BUT DO WE NEED THIS HERE?');
                $this->add_cache_channel(CRNRSTN_CHANNEL_GET);

                //
                // TAKE THIS OPPORTUNITY TO INITIALIZE CHANNEL BYTES TO ZERO (0).
                self::$cache_ARRAY[$this->oCRNRSTN->request_id]['channel_bytes'][CRNRSTN_CHANNEL_GET] = 0;

            break;
            case 'post_cache_is_active':

                self::$post_cache_is_active = $value;
                error_log(__LINE__ . ' rrs map add cache CHANNEL $_POST[] via rrs_map_set(). BUT DO WE NEED THIS HERE?');

                $this->add_cache_channel(CRNRSTN_CHANNEL_POST);

                //
                // TAKE THIS OPPORTUNITY TO INITIALIZE CHANNEL BYTES TO ZERO (0).
                self::$cache_ARRAY[$this->oCRNRSTN->request_id]['channel_bytes'][CRNRSTN_CHANNEL_POST] = 0;

            break;
            case 'cookie_cache_is_active':

                self::$cookie_cache_is_active = $value;
                $this->add_cache_channel(CRNRSTN_CHANNEL_COOKIE);

                //
                // TAKE THIS OPPORTUNITY TO INITIALIZE CHANNEL BYTES TO ZERO (0).
                self::$cache_ARRAY[$this->oCRNRSTN->request_id]['channel_bytes'][CRNRSTN_CHANNEL_COOKIE] = 0;

            break;
            case 'session_cache_is_active':

                self::$session_cache_is_active = $value;
                error_log(__LINE__ . ' rrs map add cache CHANNEL session via rrs_map_set(). BUT DO WE NEED THIS HERE?');

                $this->add_cache_channel(CRNRSTN_CHANNEL_SESSION);

                //
                // TAKE THIS OPPORTUNITY TO INITIALIZE CHANNEL BYTES TO ZERO (0).
                self::$cache_ARRAY[$this->oCRNRSTN->request_id]['channel_bytes'][CRNRSTN_CHANNEL_SESSION] = 0;

            break;
            case 'database_cache_is_active':

                self::$database_cache_is_active = $value;
                $this->add_cache_channel(CRNRSTN_CHANNEL_DATABASE);

                //
                // TAKE THIS OPPORTUNITY TO INITIALIZE CHANNEL BYTES TO ZERO (0).
                self::$cache_ARRAY[$this->oCRNRSTN->request_id]['channel_bytes'][CRNRSTN_CHANNEL_DATABASE] = 0;

            break;
            case 'ssdtla_cache_is_active':

                self::$ssdtla_cache_is_active = $value;
                $this->add_cache_channel(CRNRSTN_CHANNEL_SSDTLA);

                //
                // TAKE THIS OPPORTUNITY TO INITIALIZE CHANNEL BYTES TO ZERO (0).
                self::$cache_ARRAY[$this->oCRNRSTN->request_id]['channel_bytes'][CRNRSTN_CHANNEL_SSDTLA] = 0;

            break;
            case 'pssdtla_cache_is_active':

                self::$pssdtla_cache_is_active = $value;
                $this->add_cache_channel(CRNRSTN_CHANNEL_PSSDTLA);

                //
                // TAKE THIS OPPORTUNITY TO INITIALIZE CHANNEL BYTES TO ZERO (0).
                self::$cache_ARRAY[$this->oCRNRSTN->request_id]['channel_bytes'][CRNRSTN_CHANNEL_PSSDTLA] = 0;

            break;
            case 'runtime_cache_is_active':

                self::$runtime_cache_is_active = $value;
                $this->add_cache_channel(CRNRSTN_CHANNEL_RUNTIME);

                //
                // TAKE THIS OPPORTUNITY TO INITIALIZE CHANNEL BYTES TO ZERO (0).
                self::$cache_ARRAY[$this->oCRNRSTN->request_id]['channel_bytes'][CRNRSTN_CHANNEL_RUNTIME] = 0;

            break;
            case 'soap_cache_is_active':

                self::$soap_cache_is_active = $value;
                $this->add_cache_channel(CRNRSTN_CHANNEL_SOAP);

                //
                // TAKE THIS OPPORTUNITY TO INITIALIZE CHANNEL BYTES TO ZERO (0).
                self::$cache_ARRAY[$this->oCRNRSTN->request_id]['channel_bytes'][CRNRSTN_CHANNEL_SOAP] = 0;

            break;
            case 'file_cache_is_active':

                self::$file_cache_is_active = $value;
                $this->add_cache_channel(CRNRSTN_CHANNEL_FILE);

                //
                // TAKE THIS OPPORTUNITY TO INITIALIZE CHANNEL BYTES TO ZERO (0).
                self::$cache_ARRAY[$this->oCRNRSTN->request_id]['channel_bytes'][CRNRSTN_CHANNEL_FILE] = 0;

            break;
            case 'get_max_map_cache_bytes':

                self::$get_max_map_cache_bytes = $value;

            break;
            case 'post_max_map_cache_bytes':

                self::$post_max_map_cache_bytes = $value;

            break;
            case 'cookie_max_map_cache_bytes':

                self::$cookie_max_map_cache_bytes = $value;

            break;
            case 'session_max_map_cache_bytes':

                self::$session_max_map_cache_bytes = $value;

            break;
            case 'database_max_map_cache_bytes':

                self::$database_max_map_cache_bytes = $value;

            break;
            case 'ssdtla_max_map_cache_bytes':

                self::$ssdtla_max_map_cache_bytes = $value;

            break;
            case 'pssdtla_max_map_cache_bytes':

                self::$pssdtla_max_map_cache_bytes = $value;

            break;
            case 'runtime_max_map_cache_bytes':

                self::$runtime_max_map_cache_bytes = $value;

            break;
            case 'soap_max_map_cache_bytes':

                self::$soap_max_map_cache_bytes = $value;

            break;
            case 'file_max_map_cache_bytes':

                self::$file_max_map_cache_bytes = $value;

            break;
            case 'get_map_cache_ttl':

                self::$get_map_cache_ttl = $value;

            break;
            case 'post_map_cache_ttl':

                self::$post_map_cache_ttl = $value;

            break;
            case 'cookie_map_cache_ttl':

                self::$cookie_map_cache_ttl = $value;

            break;
            case 'session_map_cache_ttl':

                self::$session_map_cache_ttl = $value;

            break;
            case 'database_map_cache_ttl':

                self::$database_map_cache_ttl = $value;

            break;
            case 'ssdtla_map_cache_ttl':

                self::$ssdtla_map_cache_ttl = $value;

            break;
            case 'pssdtla_map_cache_ttl':

                self::$pssdtla_map_cache_ttl = $value;

            break;
            case 'runtime_map_cache_ttl':

                self::$runtime_map_cache_ttl = $value;

            break;
            case 'soap_map_cache_ttl':

                self::$soap_map_cache_ttl = $value;

            break;
            case 'file_map_cache_ttl':

                self::$file_map_cache_ttl = $value;

            break;
            case 'channel_bytes':

                $channel = $value;

                error_log(__LINE__ . ' rrs map BEGIN CHANNEL[' . print_r($channel, true) . '] BYTES INITIALIZATION. FIRST[?] DDO TRANSLATION OPPORTUNITY...?');
                die();

                switch($channel){
                    case CRNRSTN_CHANNEL_GET:
                        //G :: HTTP $_GET REQUEST.

                        $tmp_str = '';

                        //
                        // CRNRSTN :: DECOUPLED DATA OBJECT (DDO) DATA TRANSLATION.
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // G :: HTTP $_GET REQUEST.
                        //
                        // $_GET[] DATA.
                        foreach($_GET as $attribute => $get_data){

                            $tmp_str .= $get_data;
                            $this->oCRNRSTN->input_data_value($get_data, $attribute, 'CRNRSTN::RESOURCE::GET_CHANNEL_DATA', 0, CRNRSTN_CHANNEL_GET);

                        }

                        //error_log(__LINE__ . ' rrs map [' . $channel . '] CHANNEL DATA INITIALIZED $channel_bytes=0.');
                        self::$cache_ARRAY[$this->oCRNRSTN->request_id]['channel_bytes'][$channel] = $this->oCRNRSTN->return_cache_bytes_size($tmp_str);

                    break;
                    case CRNRSTN_CHANNEL_POST:
                        //P :: HTTP $_POST REQUEST.

                        $tmp_str = '';

                        //
                        // $_GET[] DATA.
                        foreach($_POST as $attribute => $post_data){

                            $tmp_str .= $post_data;
                            //
                            // TODO :: CONSIDER CONSUMING POST DATA HERE.
                            //$this->oCRNRSTN->input_data_value($post_data, $attribute, 'CRNRSTN::RESOURCE::GET_CHANNEL_DATA', 0, CRNRSTN_CHANNEL_POST);

                        }

                        //error_log(__LINE__ . ' rrs map [' . $channel . '] CHANNEL DATA INITIALIZED $channel_bytes=0.');
                        self::$cache_ARRAY[$this->oCRNRSTN->request_id]['channel_bytes'][$channel] = $this->oCRNRSTN->return_cache_bytes_size($tmp_str);

                    break;
                    case CRNRSTN_CHANNEL_SESSION:
                        //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

                        //error_log(__LINE__ . ' rrs map [' . $channel . '] CHANNEL DATA INITIALIZED $channel_bytes=0.');
                        $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['channel_bytes'][$channel] = 0;

                    break;
                    case CRNRSTN_CHANNEL_RUNTIME:
                        //R :: RUNTIME.
                    case CRNRSTN_CHANNEL_SOAP:
                        //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                    case CRNRSTN_CHANNEL_DATABASE:
                        //D :: DATABASE (MySQLi CONNECTION).
                    case CRNRSTN_CHANNEL_COOKIE:
                        //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
                    case CRNRSTN_CHANNEL_PSSDTLA:
                        //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                    case CRNRSTN_CHANNEL_SSDTLA:
                        //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).

                        //error_log(__LINE__ . ' rrs map [' . $channel . '] CHANNEL DATA INITIALIZED $channel_bytes=0.');
                        self::$cache_ARRAY[$this->oCRNRSTN->request_id]['channel_bytes'][$channel] = 0;

                    break;
                    default:

                        error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                    break;

                }

            break;
            case 'get_encryption_profile':

                self::$get_encryption_profile = $value;

            break;
            case 'post_encryption_profile':

                self::$post_encryption_profile = $value;

            break;
            case 'runtime_encryption_profile':

                self::$runtime_encryption_profile = $value;

            break;
            case 'cookie_encryption_profile':

                self::$cookie_encryption_profile = $value;

            break;
            case 'ssdtla_encryption_profile':

                self::$ssdtla_encryption_profile = $value;

            break;
            case 'pssdtla_encryption_profile':

                self::$pssdtla_encryption_profile = $value;

            break;
            case 'session_encryption_profile':

                self::$session_encryption_profile = $value;

            break;
            case 'database_encryption_profile':

                self::$database_encryption_profile = $value;

            break;
            case 'soap_encryption_profile':

                self::$soap_encryption_profile = $value;

            break;
            case 'get_php_sessionid':

                self::$get_php_sessionid = $value;

            break;
            case 'post_php_sessionid':

                self::$post_php_sessionid = $value;

            break;
            case 'cookie_php_sessionid':

                self::$cookie_php_sessionid = $value;

            break;
            case 'session_php_sessionid':

                self::$session_php_sessionid = $value;

            break;
            case 'database_php_sessionid':

                self::$database_php_sessionid = $value;

            break;
            case 'ssdtla_php_sessionid':

                self::$ssdtla_php_sessionid = $value;

            break;
            case 'pssdtla_php_sessionid':

                self::$pssdtla_php_sessionid = $value;

            break;
            case 'runtime_php_sessionid':

                self::$runtime_php_sessionid = $value;

            break;
            case 'soap_php_sessionid':

                self::$soap_php_sessionid = $value;

            break;
            case 'file_php_sessionid':

                self::$file_php_sessionid = $value;

            break;
            case 'get_client_ip_address':

                self::$get_client_ip_address = $value;

            break;
            case 'post_client_ip_address':

                self::$post_client_ip_address = $value;

            break;
            case 'cookie_client_ip_address':

                self::$cookie_client_ip_address = $value;

            break;
            case 'session_client_ip_address':

                self::$session_client_ip_address = $value;

            break;
            case 'database_client_ip_address':

                self::$database_client_ip_address = $value;

            break;
            case 'ssdtla_client_ip_address':

                self::$ssdtla_client_ip_address = $value;

            break;
            case 'pssdtla_client_ip_address':

                self::$pssdtla_client_ip_address = $value;

            break;
            case 'runtime_client_ip_address':

                self::$runtime_client_ip_address = $value;

            break;
            case 'soap_client_ip_address':

                self::$soap_client_ip_address = $value;

            break;
            case 'file_client_ip_address':

                self::$file_client_ip_address = $value;

            break;
            case 'get_channel_config_ini_call_timestamp':

                self::$get_channel_config_ini_call_timestamp = $value;

            break;
            case 'post_channel_config_ini_call_timestamp':

                self::$post_channel_config_ini_call_timestamp = $value;

            break;
            case 'cookie_channel_config_ini_call_timestamp':

                self::$cookie_channel_config_ini_call_timestamp = $value;

            break;
            case 'session_channel_config_ini_call_timestamp':

                self::$session_channel_config_ini_call_timestamp = $value;

            break;
            case 'database_channel_config_ini_call_timestamp':

                self::$database_channel_config_ini_call_timestamp = $value;

            break;
            case 'ssdtla_channel_config_ini_call_timestamp':

                self::$ssdtla_channel_config_ini_call_timestamp = $value;

            break;
            case 'pssdtla_channel_config_ini_call_timestamp':

                self::$pssdtla_channel_config_ini_call_timestamp = $value;

            break;
            case 'runtime_channel_config_ini_call_timestamp':

                self::$runtime_channel_config_ini_call_timestamp = $value;

            break;
            case 'soap_channel_config_ini_call_timestamp':

                self::$soap_channel_config_ini_call_timestamp = $value;

            break;
            case 'file_channel_config_ini_call_timestamp':

                self::$file_channel_config_ini_call_timestamp = $value;

            break;
            case 'get_channel_is_opened_timestamp':

                self::$get_channel_is_opened_timestamp = $value;

            break;
            case 'post_channel_is_opened_timestamp':

                self::$post_channel_is_opened_timestamp = $value;

            break;
            case 'cookie_channel_is_opened_timestamp':

                self::$cookie_channel_is_opened_timestamp = $value;

            break;
            case 'session_channel_is_opened_timestamp':

                self::$session_channel_is_opened_timestamp = $value;

            break;
            case 'database_channel_is_opened_timestamp':

                self::$database_channel_is_opened_timestamp = $value;

            break;
            case 'ssdtla_channel_is_opened_timestamp':

                self::$ssdtla_channel_is_opened_timestamp = $value;

            break;
            case 'pssdtla_channel_is_opened_timestamp':

                self::$pssdtla_channel_is_opened_timestamp = $value;

            break;
            case 'runtime_channel_is_opened_timestamp':

                self::$runtime_channel_is_opened_timestamp = $value;

            break;
            case 'soap_channel_is_opened_timestamp':

                self::$soap_channel_is_opened_timestamp = $value;

            break;
            case 'file_channel_is_opened_timestamp':

                self::$file_channel_is_opened_timestamp = $value;

            break;
            case 'get_channel_is_closed_timestamp':

                self::$get_channel_is_closed_timestamp = $value;

            break;
            case 'post_channel_is_closed_timestamp':

                self::$post_channel_is_closed_timestamp = $value;

            break;
            case 'cookie_channel_is_closed_timestamp':

                self::$cookie_channel_is_closed_timestamp = $value;

            break;
            case 'session_channel_is_closed_timestamp':

                self::$session_channel_is_closed_timestamp = $value;

            break;
            case 'database_channel_is_closed_timestamp':

                self::$database_channel_is_closed_timestamp = $value;

            break;
            case 'ssdtla_channel_is_closed_timestamp':

                self::$ssdtla_channel_is_closed_timestamp = $value;

            break;
            case 'pssdtla_channel_is_closed_timestamp':

                self::$pssdtla_channel_is_closed_timestamp = $value;

            break;
            case 'runtime_channel_is_closed_timestamp':

                self::$runtime_channel_is_closed_timestamp = $value;

            break;
            case 'soap_channel_is_closed_timestamp':

                self::$soap_channel_is_closed_timestamp = $value;

            break;
            case 'file_channel_is_closed_timestamp':

                self::$file_channel_is_closed_timestamp = $value;

            break;
            case 'get_ddo_begin_data_receipt_timestamp':

                self::$get_ddo_begin_data_receipt_timestamp = $value;

            break;
            case 'post_ddo_begin_data_receipt_timestamp':

                self::$post_ddo_begin_data_receipt_timestamp = $value;

            break;
            case 'cookie_ddo_begin_data_receipt_timestamp':

                self::$cookie_ddo_begin_data_receipt_timestamp = $value;

            break;
            case 'session_ddo_begin_data_receipt_timestamp':

                self::$session_ddo_begin_data_receipt_timestamp = $value;

            break;
            case 'database_ddo_begin_data_receipt_timestamp':

                self::$database_ddo_begin_data_receipt_timestamp = $value;

            break;
            case 'ssdtla_ddo_begin_data_receipt_timestamp':

                self::$ssdtla_ddo_begin_data_receipt_timestamp = $value;

            break;
            case 'pssdtla_ddo_begin_data_receipt_timestamp':

                self::$pssdtla_ddo_begin_data_receipt_timestamp = $value;

            break;
            case 'runtime_ddo_begin_data_receipt_timestamp':

                self::$runtime_ddo_begin_data_receipt_timestamp = $value;

            break;
            case 'soap_ddo_begin_data_receipt_timestamp':

                self::$soap_ddo_begin_data_receipt_timestamp = $value;

            break;
            case 'file_ddo_begin_data_receipt_timestamp':

                self::$file_ddo_begin_data_receipt_timestamp = $value;

            break;
            case 'get_ddo_data_complete_timestamp':

                self::$get_ddo_data_complete_timestamp = $value;

            break;
            case 'post_ddo_data_complete_timestamp':

                self::$post_ddo_data_complete_timestamp = $value;

            break;
            case 'cookie_ddo_data_complete_timestamp':

                self::$cookie_ddo_data_complete_timestamp = $value;

            break;
            case 'session_ddo_data_complete_timestamp':

                self::$session_ddo_data_complete_timestamp = $value;

            break;
            case 'database_ddo_data_complete_timestamp':

                self::$database_ddo_data_complete_timestamp = $value;

            break;
            case 'ssdtla_ddo_data_complete_timestamp':

                self::$ssdtla_ddo_data_complete_timestamp = $value;

            break;
            case 'pssdtla_ddo_data_complete_timestamp':

                self::$pssdtla_ddo_data_complete_timestamp = $value;

            break;
            case 'runtime_ddo_data_complete_timestamp':

                self::$runtime_ddo_data_complete_timestamp = $value;

            break;
            case 'soap_ddo_data_complete_timestamp':

                self::$soap_ddo_data_complete_timestamp = $value;

            break;
            case 'file_ddo_data_complete_timestamp':

                self::$file_ddo_data_complete_timestamp = $value;

            break;
            case 'get_channel_opened_count':

                self::$get_channel_opened_count = $value;

            break;
            case 'post_channel_opened_count':

                self::$post_channel_opened_count = $value;

            break;
            case 'cookie_channel_opened_count':

                self::$cookie_channel_opened_count = $value;

            break;
            case 'session_channel_opened_count':

                self::$session_channel_opened_count = $value;

            break;
            case 'database_channel_opened_count':

                self::$database_channel_opened_count = $value;

            break;
            case 'ssdtla_channel_opened_count':

                self::$ssdtla_channel_opened_count = $value;

            break;
            case 'pssdtla_channel_opened_count':

                self::$pssdtla_channel_opened_count = $value;

            break;
            case 'runtime_channel_opened_count':

                self::$runtime_channel_opened_count = $value;

            break;
            case 'soap_channel_opened_count':

                self::$soap_channel_opened_count = $value;

            break;
            case 'file_channel_opened_count':

                self::$file_channel_opened_count = $value;

            break;
            case 'get_last_packet_bytes_total':

                self::$get_last_packet_bytes_total = $value;

            break;
            case 'post_last_packet_bytes_total':

                self::$post_last_packet_bytes_total = $value;

            break;
            case 'cookie_last_packet_bytes_total':

                self::$cookie_last_packet_bytes_total = $value;

            break;
            case 'session_last_packet_bytes_total':

                self::$session_last_packet_bytes_total = $value;

            break;
            case 'database_last_packet_bytes_total':

                self::$database_last_packet_bytes_total = $value;

            break;
            case 'ssdtla_last_packet_bytes_total':

                self::$ssdtla_last_packet_bytes_total = $value;

            break;
            case 'pssdtla_last_packet_bytes_total':

                self::$pssdtla_last_packet_bytes_total = $value;

            break;
            case 'runtime_last_packet_bytes_total':

                self::$runtime_last_packet_bytes_total = $value;

            break;
            case 'soap_last_packet_bytes_total':

                self::$soap_last_packet_bytes_total = $value;

            break;
            case 'file_last_packet_bytes_total':

                self::$file_last_packet_bytes_total = $value;

            break;
            case 'get_total_packet_bytes':

                self::$get_total_packet_bytes = $value;

            break;
            case 'post_total_packet_bytes':

                self::$post_total_packet_bytes = $value;

            break;
            case 'cookie_total_packet_bytes':

                self::$cookie_total_packet_bytes = $value;

            break;
            case 'session_total_packet_bytes':

                self::$session_total_packet_bytes = $value;

            break;
            case 'database_total_packet_bytes':

                self::$database_total_packet_bytes = $value;

            break;
            case 'ssdtla_total_packet_bytes':

                self::$ssdtla_total_packet_bytes = $value;

            break;
            case 'pssdtla_total_packet_bytes':

                self::$pssdtla_total_packet_bytes = $value;

            break;
            case 'runtime_total_packet_bytes':

                self::$runtime_total_packet_bytes = $value;

            break;
            case 'soap_total_packet_bytes':

                self::$soap_total_packet_bytes = $value;

            break;
            case 'file_total_packet_bytes':

                self::$file_total_packet_bytes = $value;

            break;
            case 'get_last_packet_bytes_received':

                self::$get_last_packet_bytes_received = $value;

            break;
            case 'post_last_packet_bytes_received':

                self::$post_last_packet_bytes_received = $value;

            break;
            case 'cookie_last_packet_bytes_received':

                self::$cookie_last_packet_bytes_received = $value;

            break;
            case 'session_last_packet_bytes_received':

                self::$session_last_packet_bytes_received = $value;

            break;
            case 'database_last_packet_bytes_received':

                self::$database_last_packet_bytes_received = $value;

            break;
            case 'ssdtla_last_packet_bytes_received':

                self::$ssdtla_last_packet_bytes_received = $value;

            break;
            case 'pssdtla_last_packet_bytes_received':

                self::$pssdtla_last_packet_bytes_received = $value;

            break;
            case 'runtime_last_packet_bytes_received':

                self::$runtime_last_packet_bytes_received = $value;

            break;
            case 'soap_last_packet_bytes_received':

                self::$soap_last_packet_bytes_received = $value;

            break;
            case 'file_last_packet_bytes_received':

                self::$file_last_packet_bytes_received = $value;

            break;
            case 'get_total_bytes_received':

                self::$get_total_bytes_received = $value;

            break;
            case 'post_total_bytes_received':

                self::$post_total_bytes_received = $value;

            break;
            case 'cookie_total_bytes_received':

                self::$cookie_total_bytes_received = $value;

            break;
            case 'session_total_bytes_received':

                self::$session_total_bytes_received = $value;

            break;
            case 'database_total_bytes_received':

                self::$database_total_bytes_received = $value;

            break;
            case 'ssdtla_total_bytes_received':

                self::$ssdtla_total_bytes_received = $value;

            break;
            case 'pssdtla_total_bytes_received':

                self::$pssdtla_total_bytes_received = $value;

            break;
            case 'runtime_total_bytes_received':

                self::$runtime_total_bytes_received = $value;

            break;
            case 'soap_total_bytes_received':

                self::$soap_total_bytes_received = $value;

            break;
            case 'file_total_bytes_received':

                self::$file_total_bytes_received = $value;

            break;
            case 'get_last_opened_timestamp':

                self::$get_last_opened_timestamp = $value;

            break;
            case 'post_last_opened_timestamp':

                self::$post_last_opened_timestamp = $value;

            break;
            case 'cookie_last_opened_timestamp':

                self::$cookie_last_opened_timestamp = $value;

            break;
            case 'session_last_opened_timestamp':

                self::$session_last_opened_timestamp = $value;

            break;
            case 'database_last_opened_timestamp':

                self::$database_last_opened_timestamp = $value;

            break;
            case 'ssdtla_last_opened_timestamp':

                self::$ssdtla_last_opened_timestamp = $value;

            break;
            case 'pssdtla_last_opened_timestamp':

                self::$pssdtla_last_opened_timestamp = $value;

            break;
            case 'runtime_last_opened_timestamp':

                self::$runtime_last_opened_timestamp = $value;

            break;
            case 'soap_last_opened_timestamp':

                self::$soap_last_opened_timestamp = $value;

            break;
            case 'file_last_opened_timestamp':

                self::$file_last_opened_timestamp = $value;

            break;
            case 'get_last_closed_timestamp':

                self::$get_last_closed_timestamp = $value;

            break;
            case 'post_last_closed_timestamp':

                self::$post_last_closed_timestamp = $value;

            break;
            case 'cookie_last_closed_timestamp':

                self::$cookie_last_closed_timestamp = $value;

            break;
            case 'session_last_closed_timestamp':

                self::$session_last_closed_timestamp = $value;

            break;
            case 'database_last_closed_timestamp':

                self::$database_last_closed_timestamp = $value;

            break;
            case 'ssdtla_last_closed_timestamp':

                self::$ssdtla_last_closed_timestamp = $value;

            break;
            case 'pssdtla_last_closed_timestamp':

                self::$pssdtla_last_closed_timestamp = $value;

            break;
            case 'runtime_last_closed_timestamp':

                self::$runtime_last_closed_timestamp = $value;

            break;
            case 'soap_last_closed_timestamp':

                self::$soap_last_closed_timestamp = $value;

            break;
            case 'file_last_closed_timestamp':

                self::$file_last_closed_timestamp = $value;

            break;
            default:

                error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');
                return false;

            break;

        }

        return true;

    }

    private function is_map_auth($channel = CRNRSTN_CHANNEL_RUNTIME, $byte_count = 0, $data_key = NULL, $data_type_family = 'CRNRSTN::RESOURCE', $cache_storage = 'RRS_MAP', $index = 0){

        //
        // TODO :: DRIVE METRICS FOR CHANNEL AUTHORIZATION COULD EVEN INCLUDE...
        // - BOOLEAN ON/OFF
        // - MAXIMUM NUMBER OF ASSETS TO TRACK [RUNTIME, SESSION, DB, COOKIE,...]
        // - THROTTLING ME SIZE BY TRAFFIC RATE (NUMBER OF ACTIVE SESSIONS)
        // - THROTTLING MAX CACHE SIZE BY TIME OF DAY

        /*
        CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA
        OBJECT (DDO) SERVICES LAYER AUTHORIZATION
        PROFILES FOR DATA HANDLING.
        -----
        CRNRSTN_CHANNEL_ALL
        CRNRSTN_CHANNEL_PSSDTLA

        */

        switch($channel){
            case CRNRSTN_CHANNEL_GET:
                //G :: HTTP $_GET REQUEST.

                if(self::$get_cache_is_active == true){

                    return $this->return_map_bytes_authorization($channel, $byte_count, $data_key, $data_type_family, $cache_storage, $index);

                }

            break;
            case CRNRSTN_CHANNEL_POST:
                //P :: HTTP $_POST REQUEST.

                if(self::$post_cache_is_active == true){

                    return $this->return_map_bytes_authorization($channel, $byte_count, $data_key, $data_type_family, $cache_storage, $index);

                }

            break;
            case CRNRSTN_CHANNEL_COOKIE:
                //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::

                if(self::$cookie_cache_is_active == true){

                    return $this->return_map_bytes_authorization($channel, $byte_count, $data_key, $data_type_family, $cache_storage, $index);

                }

            break;
            case CRNRSTN_CHANNEL_SESSION:
                //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

                if(self::$session_cache_is_active == true){

                    return $this->return_map_bytes_authorization($channel, $byte_count, $data_key, $data_type_family, $cache_storage, $index);

                }

            break;
            case CRNRSTN_CHANNEL_DATABASE:
                //D :: DATABASE (MySQLi CONNECTION).

                if(self::$database_cache_is_active == true){

                    return $this->return_map_bytes_authorization($channel, $byte_count, $data_key, $data_type_family, $cache_storage, $index);

                }

            break;
            case CRNRSTN_CHANNEL_SSDTLA:
                //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).

                if(self::$ssdtla_cache_is_active == true){

                    return $this->return_map_bytes_authorization($channel, $byte_count, $data_key, $data_type_family, $cache_storage, $index);

                }

            break;
            case CRNRSTN_CHANNEL_PSSDTLA:
                //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).

                if(self::$pssdtla_cache_is_active == true){

                    return $this->return_map_bytes_authorization($channel, $byte_count, $data_key, $data_type_family, $cache_storage, $index);

                }

            break;
            case CRNRSTN_CHANNEL_RUNTIME:
                //R :: RUNTIME.

                if(self::$runtime_cache_is_active == true){

                    return $this->return_map_bytes_authorization($channel, $byte_count, $data_key, $data_type_family, $cache_storage, $index);

                }

            break;
            case CRNRSTN_CHANNEL_SOAP:
                //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).

                if(self::$soap_cache_is_active == true){

                    return $this->return_map_bytes_authorization($channel, $byte_count, $data_key, $data_type_family, $cache_storage, $index);

                }

            break;
            case CRNRSTN_CHANNEL_FILE:
                //F :: SERVER LOCAL FILE SYSTEM.

                if(self::$file_cache_is_active == true){

                    return $this->return_map_bytes_authorization($channel, $byte_count, $data_key, $data_type_family, $cache_storage, $index);

                }

            break;
            default:

                error_log(__LINE__ . ' rrs map Unknown $channel[' . $channel . ']. Cannot determine authorization for data storage in this channel.');

            break;

        }

        return false;

    }

    private function new_config_cache_bytes($data, $data_key, $data_type_family, $index, $data_authorization_profile, $channel_override = NULL){

        $tmp_channel_ARRAY = array();

        //
        // TODO :: ENSURE ACCURACY OF BYTE COUNT REPORTING...CUMULATIVE AND BY CHANNEL.
        $tmp_data_len = $this->oCRNRSTN->return_cache_bytes_size($data);  // 1 CHAR ~= 2 BYTES. 1ST PASS LOGIC.

        //
        // ESTABLISH THE CHANNEL CONTROL STRUCT.
        foreach(self::$channel_ARRAY as $ch_index => $channel){

            if(isset($channel_override)){

                if(($channel_override == $channel) && ($this->oCRNRSTN->channel_access_is_authorized($channel, $data_authorization_profile) == true)){

                    //
                    // THIS WILL ALSO ADJUST THE CHANNELS' REPORTING ON TOTAL BYTES STORED.
                    if($this->is_map_auth($channel, $tmp_data_len, $data_key, $data_type_family, 'DDO', $index) == true){

                        $tmp_channel_ARRAY[] = $channel;

                    }

                }

            }else{

                if($this->oCRNRSTN->channel_access_is_authorized($channel, $data_authorization_profile) == true){

                    //
                    // THIS WILL ALSO ADJUST THE CHANNELS' REPORTING ON TOTAL BYTES STORED.
                    //error_log(__LINE__ . ' rrs map $channel[' . $channel . ']. $tmp_data_len[' . $tmp_data_len . ']. $data_key[' . $data_key . ']. $data_type_family[' . $data_type_family . ']. $index[' . $index . ']. die();');

                    if($this->is_map_auth($channel, $tmp_data_len, $data_key, $data_type_family, 'DDO', $index) == true){

                        //error_log(__LINE__ . ' rrs map $channel[' . $channel . ']. $tmp_data_len[' . $tmp_data_len . ']. $data_key[' . $data_key . ']. $data_type_family[' . $data_type_family . ']. $index[' . $index . ']. die();');

                        //
                        // INCREMENT GLOBAL BYTES STORED COUNT.
                        $this->oCRNRSTN->byte_reporting('channel_bytes_processed[w]', $channel, __METHOD__, $tmp_data_len);
                        $tmp_channel_ARRAY[] = $channel;

                    }

                }

            }

        }

        //
        // INCREMENT GLOBAL BYTES PROCESSED COUNT.
        $this->oCRNRSTN->byte_reporting('total_bytes_processed[w]', $tmp_channel_ARRAY, __METHOD__, $tmp_data_len);

        return $tmp_channel_ARRAY;

    }

    private function new_cache_bytes($data, $salt_ugc_override, $data_type_family = 'integrations', $channel_override = NULL){

        $tmp_channel_ARRAY = array();

        //
        // TODO :: ENSURE ACCURACY OF BYTE COUNT REPORTING...CUMULATIVE AND BY CHANNEL.
        $tmp_data_len = $this->oCRNRSTN->return_cache_bytes_size($data);

        error_log(__LINE__ . ' rrs map CACHE(len=' . $tmp_data_len . ') [' . print_r(self::$channel_ARRAY, true) . '].');

        foreach(self::$channel_ARRAY as $index => $channel){

            //error_log(__LINE__ . ' rrs map ***** CACHE(len=' . $tmp_data_len . ')');

            if(isset($channel_override)){

                if(($channel_override == $channel)){

                    //error_log(__LINE__ . ' rrs map $channel[' . $channel . ']. CHECKING AUTH CACHE(len=' . $tmp_data_len . ')');

                    //
                    // STORAGE MAP CACHE DATA WRITE AUTHORIZATION CHECK.
                    // THIS WILL ALSO ADJUST THE CHANNELS' REPORTING ON TOTAL BYTES STORED.
                    if($this->is_map_auth($channel, $tmp_data_len, $salt_ugc_override, $data_type_family, 'RRS_MAP', 0) == true){

                        error_log(__LINE__ . ' rrs map CACHE(len=' . $tmp_data_len . ') AUTH GRANTED FOR [' . $channel . '].');
                        $tmp_channel_ARRAY[] = $channel;

                        $tmp_byte_cnt = $this->get_cache('resource_bytes', $channel, $salt_ugc_override);
                        $tmp_byte_cnt += $tmp_data_len;

                        switch($channel){
                            case CRNRSTN_CHANNEL_SESSION:
                                //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

                                //
                                // CACHE WRITES HERE MUST BE MANUAL (DIRECT TO ARRAY) TO AVOID LOOPS INDUCED BY THE
                                // OOP ARCHITECTURAL DATA MODEL.
                                // THE MEMORY MGMT ARCHITECTURE IS RIGHT ON TOP OF THE DATA AND
                                // FORCES DIRECT ACCESS IN ORDER TO AVOID THE INFINITE SPIRALLING
                                // OUT OF--.
                                //
                                // TOO CLOSE TO THE FIRE FOR OOP HERE, BOYS. SOME OF THE BEHAVIOR I'VE SEEN
                                // BREAKING THE ARCHITECTURE LIKE AN IDIOT WHILE IN DEVELOPMENT...IT IS
                                // CLOSE TO THINGS THAT HARDWARE CONTROLLERS DO IN PRACTICE OF
                                // MEMORY MANAGEMENT...IMHO.
                                // - Wednesday April 19, 2023 1418 hrs
                                error_log(__LINE__ . ' rrs map get_cache() cache_id['  . $this->get_cache('cache_id', $salt_ugc_override, CRNRSTN_CHANNEL_SESSION) . '].');
                                error_log(__LINE__ . ' rrs map $channel_resource_id_ARRAY['  . self::$channel_resource_id_ARRAY['cache_id'][$channel] . '].');
                                $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['resource_bytes'][$this->get_cache('cache_id', $salt_ugc_override, CRNRSTN_CHANNEL_SESSION)] = $tmp_byte_cnt;
                                //$this->cache_write('resource_bytes', $tmp_byte_cnt, 'session');    // TOO CLOSE TO THE FIRE FOR THIS.

                                //
                                // INCREMENT GLOBAL BYTES STORED COUNT.
                                $this->oCRNRSTN->byte_reporting('channel_bytes_processed[w]', $channel, __METHOD__, $tmp_data_len);

                            break;
                            case CRNRSTN_CHANNEL_SOAP:
                                //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                            case CRNRSTN_CHANNEL_GET:
                                //G :: HTTP $_GET REQUEST.
                            case CRNRSTN_CHANNEL_RUNTIME:
                                //R :: RUNTIME.

                                //
                                // CACHE WRITES HERE MUST BE MANUAL (DIRECT TO ARRAY) TO AVOID LOOPS INDUCED BY THE
                                // OOP ARCHITECTURAL DATA MODEL.
                                // THE MEMORY MGMT ARCHITECTURE IS RIGHT ON TOP OF THE DATA AND
                                // FORCES DIRECT ACCESS IN ORDER TO AVOID THE INFINITE SPIRALLING
                                // OUT OF--.
                                //
                                // TOO CLOSE TO THE FIRE FOR OOP HERE, BOYS. SOME OF THE BEHAVIOR I'VE SEEN
                                // BREAKING THE ARCHITECTURE LIKE AN IDIOT WHILE IN DEVELOPMENT...IT IS
                                // CLOSE TO THINGS THAT HARDWARE CONTROLLERS DO IN PRACTICE OF
                                // MEMORY MANAGEMENT...IMHO.
                                // - Wednesday April 19, 2023 1418 hrs
                                self::$cache_ARRAY[$this->oCRNRSTN->request_id]['resource_bytes'][$this->get_cache('cache_id', $salt_ugc_override, CRNRSTN_CHANNEL_RUNTIME)] = $tmp_byte_cnt;
                                //$this->cache_write('resource_bytes', $tmp_byte_cnt, 'runtime');    // TOO CLOSE TO THE FIRE FOR THIS.

                                //
                                // INCREMENT GLOBAL BYTES STORED COUNT.
                                $this->oCRNRSTN->byte_reporting('channel_bytes_processed[w]', $channel, __METHOD__, $tmp_data_len);

                            break;
                            case CRNRSTN_CHANNEL_DATABASE:
                                //D :: DATABASE (MySQLi CONNECTION).
                            case CRNRSTN_CHANNEL_POST:
                                //P :: HTTP $_POST REQUEST.
                            case CRNRSTN_CHANNEL_PSSDTLA:
                                //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                            case CRNRSTN_CHANNEL_SSDTLA:
                                //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).
                            case CRNRSTN_CHANNEL_COOKIE:
                                //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::

                                //
                                // INCREMENT GLOBAL BYTES STORED COUNT.
                                $this->oCRNRSTN->byte_reporting('channel_bytes_processed[w]', $channel, __METHOD__, $tmp_data_len);

                            break;
                            default:
                                //
                                // SILENCE IS GOLDEN.
                                error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                            break;

                        }

                    }

                }

            }else{

                //error_log(__LINE__ . ' rrs map CACHE(len=' . $tmp_data_len . ')');

                //
                // STORAGE MAP CACHE DATA WRITE AUTHORIZATION CHECK.
                // THIS WILL ALSO ADJUST THE CHANNELS' REPORTING ON TOTAL BYTES STORED.
                if($this->is_map_auth($channel, $tmp_data_len, $salt_ugc_override, $data_type_family, 'RRS_MAP', 0) == true){

                    error_log(__LINE__ . ' rrs map CACHE(len=' . $tmp_data_len . ') AUTH GRANTED FOR [' . $channel . '].');
                    $tmp_channel_ARRAY[] = $channel;

                    $tmp_byte_cnt = $this->get_cache('resource_bytes', $salt_ugc_override, $channel);
                    $tmp_byte_cnt += $tmp_data_len;

                    switch($channel){
                        case CRNRSTN_CHANNEL_SESSION:
                            //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

                            //
                            // CACHE WRITES HERE MUST BE MANUAL (DIRECT TO ARRAY) TO AVOID LOOPS INDUCED BY THE
                            // OOP ARCHITECTURAL DATA MODEL.
                            // THE MEMORY MGMT ARCHITECTURE IS RIGHT ON TOP OF THE DATA AND
                            // FORCES DIRECT ACCESS IN ORDER TO AVOID THE INFINITE SPIRALLING
                            // OUT OF--.
                            //
                            // TOO CLOSE TO THE FIRE FOR OOP HERE, BOYS. SOME OF THE BEHAVIOR I'VE SEEN
                            // BREAKING THE ARCHITECTURE LIKE AN IDIOT WHILE IN DEVELOPMENT...IT IS
                            // CLOSE TO THINGS THAT HARDWARE CONTROLLERS DO IN PRACTICE OF
                            // MEMORY MANAGEMENT...IMHO.
                            // - Wednesday April 19, 2023 1418 hrs
                            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['resource_bytes'][$this->get_cache('cache_id',$salt_ugc_override, CRNRSTN_CHANNEL_SESSION)] = $tmp_byte_cnt;

                            //
                            // INCREMENT GLOBAL BYTES STORED COUNT.
                            $this->oCRNRSTN->byte_reporting('channel_bytes_processed[w]', $channel, __METHOD__, $tmp_data_len);

                        break;
                        case CRNRSTN_CHANNEL_SOAP:
                            //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                        case CRNRSTN_CHANNEL_GET:
                            //G :: HTTP $_GET REQUEST.
                        case CRNRSTN_CHANNEL_RUNTIME:
                            //R :: RUNTIME.

                            //
                            // CACHE WRITES HERE MUST BE MANUAL (DIRECT TO ARRAY) TO AVOID LOOPS INDUCED BY THE
                            // OOP ARCHITECTURAL DATA MODEL.
                            // THE MEMORY MGMT ARCHITECTURE IS RIGHT ON TOP OF THE DATA AND
                            // FORCES DIRECT ACCESS IN ORDER TO AVOID THE INFINITE SPIRALLING
                            // OUT OF--.
                            //
                            // TOO CLOSE TO THE FIRE FOR OOP HERE, BOYS. SOME OF THE BEHAVIOR I'VE SEEN
                            // BREAKING THE ARCHITECTURE LIKE AN IDIOT WHILE IN DEVELOPMENT...IT IS
                            // CLOSE TO THINGS THAT HARDWARE CONTROLLERS DO IN PRACTICE OF
                            // MEMORY MANAGEMENT...IMHO.
                            // - Wednesday April 19, 2023 1418 hrs
                            self::$cache_ARRAY[$this->oCRNRSTN->request_id]['resource_bytes'][$this->get_cache('cache_id', $salt_ugc_override, CRNRSTN_CHANNEL_RUNTIME)] = $tmp_byte_cnt;
                            //$this->cache_write('resource_bytes', $tmp_byte_cnt, 'runtime');    // TOO CLOSE TO THE FIRE FOR THIS.

                            //
                            // INCREMENT GLOBAL BYTES STORED COUNT.
                            $this->oCRNRSTN->byte_reporting('channel_bytes_processed[w]', $channel, __METHOD__, $tmp_data_len);

                        break;
                        case CRNRSTN_CHANNEL_DATABASE:
                            //D :: DATABASE (MySQLi CONNECTION).
                        case CRNRSTN_CHANNEL_COOKIE:
                            //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
                        case CRNRSTN_CHANNEL_POST:
                            //P :: HTTP $_POST REQUEST.
                        case CRNRSTN_CHANNEL_PSSDTLA:
                            //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                        case CRNRSTN_CHANNEL_SSDTLA:
                            //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).

                            //
                            // INCREMENT GLOBAL BYTES STORED COUNT.
                            $this->oCRNRSTN->byte_reporting('channel_bytes_processed[w]', $channel, __METHOD__, $tmp_data_len);

                        break;
                        default:
                            // SILENCE IS GOLDEN.

                            error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                        break;

                    }

                }

            }

        }

        error_log(__LINE__ . ' rrs map $tmp_channel_ARRAY[' . print_r($tmp_channel_ARRAY, true) . ']. $tmp_data_len[' . strval($tmp_data_len) . ']. ');

        //
        // INCREMENT GLOBAL BYTES PROCESSED COUNT.
        $this->oCRNRSTN->byte_reporting('total_bytes_processed[w]', $tmp_channel_ARRAY, __METHOD__, $tmp_data_len);

        return $tmp_channel_ARRAY;

    }

    public function cache_rw_acceleration($ddo_memory_pointer, $data_type_family, $env_key){

        if(isset(self::$data_key_cache_rw_acceleration_ARRAY[$data_type_family][$ddo_memory_pointer])){

            return self::$data_key_cache_rw_acceleration_ARRAY[$data_type_family][$ddo_memory_pointer];

        }

        //
        // THIS METHOD IS COSTTLY.
        $tmp_dataset_prefix_str = $this->oCRNRSTN->return_dataset_nomination_prefix('string', $this->oCRNRSTN->config_serial_hash(), $env_key, $data_type_family);

        self::$data_key_cache_rw_acceleration_ARRAY[$data_type_family][$ddo_memory_pointer] = $tmp_dataset_prefix_str . '::' . $ddo_memory_pointer;

        return self::$data_key_cache_rw_acceleration_ARRAY[$data_type_family][$ddo_memory_pointer];

    }

    private function return_map_bytes_authorization($channel = CRNRSTN_CHANNEL_RUNTIME, $bytes_count = 0, $ddo_memory_pointer = NULL, $data_type_family = 'CRNRSTN::RESOURCE', $cache_storage = 'RRS_MAP', $index = 0){

        $tmp_channel_bytes = 0;
        $salt_ugc_override = $ddo_memory_pointer;

        //
        // INITIALIZE CHANNEL MAX BYTES.
        switch($channel){
            case CRNRSTN_CHANNEL_POST:
                //P :: HTTP $_POST REQUEST.

                $tmp_max_channel_bytes = self::$post_max_map_cache_bytes;

            break;
            case CRNRSTN_CHANNEL_GET:
                //G :: HTTP $_GET REQUEST.

                $tmp_max_channel_bytes = self::$get_max_map_cache_bytes;

            break;
            case CRNRSTN_CHANNEL_SOAP:
                //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).

                $tmp_max_channel_bytes = self::$soap_max_map_cache_bytes;

            break;
            case CRNRSTN_CHANNEL_DATABASE:
                //D :: DATABASE (MySQLi CONNECTION).

                $tmp_max_channel_bytes = self::$database_max_map_cache_bytes;

            break;
            case CRNRSTN_CHANNEL_COOKIE:
                //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::

                $tmp_max_channel_bytes = self::$cookie_max_map_cache_bytes;

            break;
            case CRNRSTN_CHANNEL_PSSDTLA:
                //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).

                $tmp_max_channel_bytes = self::$pssdtla_max_map_cache_bytes;

            break;
            case CRNRSTN_CHANNEL_SSDTLA:
                //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).

                $tmp_max_channel_bytes = self::$ssdtla_max_map_cache_bytes;

            break;
            case CRNRSTN_CHANNEL_SESSION:
                //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

                $tmp_max_channel_bytes = self::$session_max_map_cache_bytes;

            break;
            case CRNRSTN_CHANNEL_RUNTIME:
                //R :: RUNTIME.

                $tmp_max_channel_bytes = self::$runtime_max_map_cache_bytes;

            break;
            case CRNRSTN_CHANNEL_FILE:
                //R :: RUNTIME.

                $tmp_max_channel_bytes = self::$file_max_map_cache_bytes;

            break;
            default:

                error_log(__LINE__ . ' rrs map Unknown RRS MAP channel [' . $this->oCRNRSTN->get_channel_config($channel, 'NAME') . '], BRUV. Unable to affect (or to receive any effect of) byte storage authorization.');
                return false;

            break;

        }

        //
        // INITIALIZE CHANNEL CACHE BYTES.
        switch($channel){
            case CRNRSTN_CHANNEL_SESSION:
                //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

                if(!isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['channel_bytes'][$channel])){

                    $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['channel_bytes'][$channel] = 0;

                }

                $tmp_channel_bytes = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['channel_bytes'][$channel];

            break;
            case CRNRSTN_CHANNEL_GET:
                //G :: HTTP $_GET REQUEST.
            case CRNRSTN_CHANNEL_POST:
                //P :: HTTP $_POST REQUEST.
            case CRNRSTN_CHANNEL_SOAP:
                //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
            case CRNRSTN_CHANNEL_COOKIE:
                //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
            case CRNRSTN_CHANNEL_DATABASE:
                //D :: DATABASE (MySQLi CONNECTION).
            case CRNRSTN_CHANNEL_PSSDTLA:
                //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
            case CRNRSTN_CHANNEL_SSDTLA:
                //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).
            case CRNRSTN_CHANNEL_RUNTIME:
                //R :: RUNTIME.

                if(!isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['channel_bytes'][$channel])){

                    self::$cache_ARRAY[$this->oCRNRSTN->request_id]['channel_bytes'][$channel] = 0;

                }

                $tmp_channel_bytes = self::$cache_ARRAY[$this->oCRNRSTN->request_id]['channel_bytes'][$channel];

            break;
            default:

                error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

            break;

        }

        //
        // AUTHORIZE AND UPDATE CHANNEL BYTES.
        switch($cache_storage){
            case 'DDO':

                //
                // INITIALIZE INDEX.
                if(!isset($index)){

                    $index = 0;

                }else{

                    if((string) $index == ''){

                        $index = 0;

                    }

                }

                $tmp_resource_bytes = $this->get_config_cache('resource_bytes', $ddo_memory_pointer, $data_type_family, $index, $channel);

                //error_log(__LINE__ . ' rrs map $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $tmp_resource_bytes[' . print_r($tmp_resource_bytes, true) . ']. $bytes_count[' . print_r($bytes_count, true) . '].');
                $tmp_resource_bytes += (int) $bytes_count;
                $tmp_channel_bytes += (int) $tmp_resource_bytes;

                //$this->get_config_cache('channel_bytes', NULL, 'DDO', NULL, $channel);
                error_log(__LINE__ . ' rrs map CACHE_ID[' . $this->get_config_cache('cache_id', $ddo_memory_pointer, 'DDO' ,NULL, $channel) . ']. $tmp_max_channel_bytes[->' . $tmp_max_channel_bytes . '<-| (is > ' . $tmp_channel_bytes . ')]  > $tmp_channel_bytes[' . $tmp_channel_bytes . '].');
                if(($tmp_max_channel_bytes > $tmp_channel_bytes) || ($tmp_max_channel_bytes == -1)){

                    //
                    // UPDATE CUMULATIVE CACHE BYTES BY CHANNEL.
                    switch($channel){
                        case CRNRSTN_CHANNEL_SESSION:
                            //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

                            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['channel_bytes'][$channel] = $tmp_channel_bytes;

                            //
                            // UPDATE BYTES BY RESOURCE.
                            //error_log(__LINE__ . ' rrs map [' . self::$channel_resource_id_ARRAY['cache_id'][$channel] . ']==[' . $this->get_config_cache('cache_id', $ddo_memory_pointer, $data_type_family, NULL, $channel) . ']');
                            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()][$cache_storage]['resource_bytes'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]] = $tmp_resource_bytes;

                        break;
                        case CRNRSTN_CHANNEL_RUNTIME:
                            //R :: RUNTIME.
                        case CRNRSTN_CHANNEL_POST:
                            //P :: HTTP $_POST REQUEST.
                        case CRNRSTN_CHANNEL_GET:
                            //G :: HTTP $_GET REQUEST.
                        case CRNRSTN_CHANNEL_SOAP:
                            //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                        case CRNRSTN_CHANNEL_DATABASE:
                            //D :: DATABASE (MySQLi CONNECTION).
                        case CRNRSTN_CHANNEL_COOKIE:
                            //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
                        case CRNRSTN_CHANNEL_PSSDTLA:
                            //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                        case CRNRSTN_CHANNEL_SSDTLA:
                            //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).

                            self::$cache_ARRAY[$this->oCRNRSTN->request_id]['channel_bytes'][$channel] = $tmp_channel_bytes;

                            error_log(__LINE__ . ' rrs map $channel[' . $channel . ']. $tmp_resource_bytes[' . strval($tmp_resource_bytes) . ']. $tmp_channel_bytes[' . $tmp_channel_bytes . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $data_type_family[' . $data_type_family . '].');

                            $this->oCRNRSTN->destruct_output .= '<pre><code>[' . $this->oCRNRSTN->return_micro_time() . '] [lnum ' .  __LINE__ . '] rrs map $channel[' . $channel . ']. <br><br>$tmp_resource_bytes[' . strval($tmp_resource_bytes) . ']. $tmp_channel_bytes[' .
                            $tmp_channel_bytes . ']. <br>$ddo_memory_pointer[' . $ddo_memory_pointer . ']. <br>$data_type_family[' . $data_type_family . '].<br><br># # C # <span style="color:#F90000;">R</span> # N # R # S # T # N # : : # # # #</br>C<span style="color:#F90000;">R</span>NRSTN :: MULTI-CHANNEL TESTING.
                            <br><br>' . print_r(self::$cache_ARRAY, true) . '<br></code></pre>';

                            //
                            // UPDATE BYTES BY RESOURCE.
                            self::$cache_ARRAY[$this->oCRNRSTN->request_id]['resource_bytes'][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]] = $tmp_resource_bytes;

                        break;
                        default:

                            error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                        break;

                    }

                    return true;

                }

            break;
            case 'RRS_MAP':

                // PLZ NOTE THAT $salt_ugc_override == $ddo_memory_pointer AT LEAST UNTIL
                // CRNRSTN :: PLAID AND MULTI-CHANNEL ARCHITECTURES ARE AS ONE.
                $tmp_resource_bytes = $this->get_cache('resource_bytes', $salt_ugc_override);
                $tmp_resource_bytes += (int) $bytes_count;
                $tmp_channel_bytes += (int) $tmp_resource_bytes;

                if(($tmp_max_channel_bytes > $tmp_channel_bytes) || ($tmp_max_channel_bytes == -1)){

                    //
                    // UPDATE CUMULATIVE CACHE BYTES FOR CHANNEL.
                    switch($channel){
                        case CRNRSTN_CHANNEL_SESSION:
                            //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

                            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['channel_bytes'][$channel] = $tmp_channel_bytes;

                            //
                            // STORE BYTES BY RESOURCE.
                            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()][$cache_storage]['resource_bytes'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()][$cache_storage]['cache_id'][$ddo_memory_pointer]] = $tmp_resource_bytes;

                        break;
                        case CRNRSTN_CHANNEL_POST:
                            //P :: HTTP $_POST REQUEST.
                        case CRNRSTN_CHANNEL_GET:
                            //G :: HTTP $_GET REQUEST.
                        case CRNRSTN_CHANNEL_SOAP:
                            //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                        case CRNRSTN_CHANNEL_COOKIE:
                            //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
                        case CRNRSTN_CHANNEL_DATABASE:
                            //D :: DATABASE (MySQLi CONNECTION).
                        case CRNRSTN_CHANNEL_SSDTLA:
                            //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).
                        case CRNRSTN_CHANNEL_PSSDTLA:
                            //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                        case CRNRSTN_CHANNEL_RUNTIME:
                            //R :: RUNTIME.

                            self::$cache_ARRAY[$this->oCRNRSTN->request_id]['channel_bytes'][$channel] = $tmp_channel_bytes;

                            //
                            // STORE BYTES BY RESOURCE.
                            self::$cache_ARRAY[$this->oCRNRSTN->request_id]['resource_bytes'][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]] = $tmp_resource_bytes;

                        break;
                        default:

                            error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                        break;

                    }

                    return true;

                }

            break;
            case 'CHANNEL_PERFORMANCE_MONITORING_REPORTING':

                $tmp_channel_bytes += (int) $bytes_count;

                //error_log(__LINE__ . ' rrs map CACHE_ID[' . $this->get_config_cache('cache_id', $ddo_memory_pointer, NULL, $channel) . ']. $tmp_max_channel_bytes[->' . $tmp_max_channel_bytes . '<-| (is > ' . $tmp_channel_bytes . ')]  > $tmp_channel_bytes[' . $tmp_channel_bytes . '].');
                if(($tmp_max_channel_bytes > $tmp_channel_bytes) || ($tmp_max_channel_bytes == -1)){

                    //
                    // UPDATE CUMULATIVE CACHE BYTES BY CHANNEL.
                    switch($channel){
                        case CRNRSTN_CHANNEL_SESSION:
                            //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

                            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['channel_bytes'][$channel] = $tmp_channel_bytes;

                        break;
                        case CRNRSTN_CHANNEL_RUNTIME:
                            //R :: RUNTIME.
                        case CRNRSTN_CHANNEL_POST:
                            //P :: HTTP $_POST REQUEST.
                        case CRNRSTN_CHANNEL_GET:
                            //G :: HTTP $_GET REQUEST.
                        case CRNRSTN_CHANNEL_SOAP:
                            //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                        case CRNRSTN_CHANNEL_DATABASE:
                            //D :: DATABASE (MySQLi CONNECTION).
                        case CRNRSTN_CHANNEL_COOKIE:
                            //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
                        case CRNRSTN_CHANNEL_PSSDTLA:
                            //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                        case CRNRSTN_CHANNEL_SSDTLA:
                            //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).

                            self::$cache_ARRAY[$this->oCRNRSTN->request_id]['channel_bytes'][$channel] = $tmp_channel_bytes;

                        break;
                        default:

                            error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                        break;

                    }

                    return true;

                }

            break;

        }

        return false;

    }

    public function runtime_rrs_cache_is_active($output_method = 'request_fulfillment', $output_mode = -1, $param0 = NULL, $param1 = NULL, $param2 = NULL, $param3 = NULL, $param4 = NULL, $param5 = NULL, $param6 = NULL, $param7 = NULL, $param8 = NULL, $param9 = NULL){

        error_log(__LINE__ . ' rrs map IS RRS MAP CACHE IS ACTIVE. $output_method[' . $output_method . ']. $output_mode[' . $output_mode . ']. $param0[' . $param0 . '].');
        //die();

        switch($output_method){
            case 'request_fulfillment':

                if(self::$request_current_fulfilled_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]] == 1){

                    //error_log(__LINE__ . ' rrs map return cache is active for this asset.');
                    //error_log(__LINE__ . ' rrs map SUCCESSFUL CACHE MATCH ON [' . $output_method . ']. $this->oCRNRSTN->request_id[' . $this->oCRNRSTN->request_id . ']. serial str [' . $this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial] . '].');

                    return true;

                }

            break;
            case 'return_asset_data':

                if(isset($this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial])){

                    if(isset(self::$cache_rrs_map_output_method_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]])){

                        return true;

                    }

                }else{

                    error_log(__LINE__ . ' rrs map NO $cache_rrs_map_output_method_ARRAY DATA resource_id[' . self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]] . ']. $cache_rrs_map_output_method_ARRAY[' . print_r(self::$cache_rrs_map_output_method_ARRAY, true) . '].');

                }

            break;
            case 'return_file_http_string':

                return false;

                //
                // TODO :: REMOVE THIS SOON-T0-BE SUPERFLUOUS CHECK.
                //error_log(__LINE__ . ' rrs map $cache_rrs_map_output_method_ARRAY[' . print_r(self::$cache_rrs_map_output_method_ARRAY, true) . ']. $cache_rrs_map_output_method_ARRAY[' . print_r(self::$cache_rrs_map_output_method_ARRAY, true) . ']. $this->return_response_map_ugc_value()[' . $this->return_response_map_ugc_value() . '].');

                if($output_mode == '' || $output_mode == NULL){

                    $tmp_resource_meta_ARRAY = $this->oCRNRSTN->return_creative($this->get_salt_ugc(), CRNRSTN_FILE_MANAGEMENT);
                    //error_log(__LINE__ . ' rrs map EMPTY $output_mode[' . $output_mode . ']. $this->return_response_map_ugc_value()[' . $this->get_salt_ugc() . ']. $tmp_resource_meta_ARRAY[' . print_r($tmp_resource_meta_ARRAY, true) . '].');

                }

                if(isset(self::$cache_rrs_map_output_method_ARRAY[$output_mode][$this->get_salt_ugc()])){

                    //error_log(__LINE__ . ' rrs map return cache is active for this asset. TODO :: REMOVE THIS CHECK.');
                    //error_log(__LINE__ . ' rrs map SUCCESSFUL CACHE MATCH ON [' . $output_method . '].');

                    return true;

                }else{

                    //error_log(__LINE__. ' rrs map OUTPUT METHOD NOT SET. $cache_rrs_map_output_method_ARRAY[' . print_r(self::$cache_rrs_map_output_method_ARRAY, true) . ']. return_file_http_string $output_mode[' . print_r(self::$request_map_output_mode_ARRAY, true) . ']. $param0[' . $param0 . '] die();');

                }

            break;
            case 'return_image_html_wrapped':

                //
                // $output_method = 'return_image_html_wrapped'
                // $param0 = $filename
                // $param1 = $width
                // $param2 = $height
                // $param3 = $alt
                // $param4 = $title
                // $param5 = $link
                // $param6 = $target
                // $param7 = $asset_family
                // $param8 = $output_mode
                // $param9 = $asset_mapping_mode

                error_log(__LINE__ . ' rrs map FORCE FALSE CACHE INIT UNTIL GET RIGHT DATA STRUCTURE FOR THE JOB. $output_method[' . $output_method . '].');
                return false;

                //if(isset(self::$cache_rrs_map_output_method_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]][$tmp_response_serial])){
                if(isset(self::$cache_rrs_map_output_method_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]])){

                    error_log(__LINE__. ' rrs map SUCCESSFUL CACHE MATCH ON [' . $output_method . '].');
                    return true;

                }

            break;
            case 'return_js_css_string_output':
            case 'return_js_string_output':
            case 'return_css_string_output':
            case 'return_file_byte_chunked_buffer_output':

                //
                // $output_method = 'return_file_byte_chunked_buffer_output'
                // $param0 = $filepath
                // $param1 = $filename
                // $param2 = $file_extension
                //
                // initialize_response_map_cache('return_file_byte_chunked_buffer_output', $output_mode, $filepath, $filename, $file_extension)

                if(isset($this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial])){

                    //self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]
                    //self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]
                    if(isset(self::$cache_rrs_map_output_method_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]])){

                        error_log(__LINE__ . ' rrs map [' . $output_method . ']. IS ACTIVE FOR [' . self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]] . '].');
                        return true;

                    }

                }

            break;
            default:

                error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                $this->oCRNRSTN->error_log('Unknown output method [' . $output_method . '] provided. Unable to check the "is active" state of cache for the requested resource [' . $param0 . '] [' . $param1 . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

            break;

        }

        //error_log(__LINE__ . ' rrs map NO SUCCESS CACHE MATCH ON [' . $output_method . ']. $this->oCRNRSTN->request_id[' . $this->oCRNRSTN->request_id . ']. serial string[' . print_r($this->oCRNRSTN->request_serialization_string_ARRAY, true). '].');
        //error_log(__LINE__ . ' rrs map self::$cache_rrs_map_output_method_ARRAY[' . print_r(self::$cache_rrs_map_output_method_ARRAY, true) . ']. $cache_rrs_map_image_string_ARRAY[' . print_r(self::$cache_rrs_map_image_string_ARRAY, true) . '].');
        //error_log(__LINE__ . ' rrs map self::$request_current_fulfilled_ARRAY[' . print_r(self::$request_current_fulfilled_ARRAY, true) . '].');
        /*
        [Sun Feb 26 01:24:14.715896 2023] [:error] [pid 3684] [client 172.16.225.1:56794] 248 rrs map self::$cache_rrs_map_output_method_ARRAY[Array
        (
            [ryhW6ADGM18cMC5DRh8EyGgEJAaFJFxbgU1M6SQ86RUQrmlAY2wuYx1S65a06UM3] => Array
                (
                    [crnrstn_logo_lgheight="70" alt="CRNRSTN :: v2.00.0000 PRE-ALPHA-DEV (Lightsaber)" title="CRNRSTN :: v2.00.0000 PRE-ALPHA-DEV (Lightsaber)"{crnrstn_method_call}72137707] => return_image_html_wrapped
                )

        )
        ].

        $cache_rrs_map_image_string_ARRAY[Array
        (
            [ryhW6ADGM18cMC5DRh8EyGgEJAaFJFxbgU1M6SQ86RUQrmlAY2wuYx1S65a06UM3] => Array
                (
                    [crnrstn_logo_lgheight="70" alt="CRNRSTN :: v2.00.0000 PRE-ALPHA-DEV (Lightsaber)" title="CRNRSTN :: v2.00.0000 PRE-ALPHA-DEV (Lightsaber)"{crnrstn_method_call}72137707] => Array
                        (
                            [image_string] => <img src="http://172.16.225.139/lightsaber.crnrstn.evifweb.com/?crnrstn_0010111011=crnrstn_logo_lg&crnrstn_=420.0420.00.23525.1677391328.0" height="70" alt="CRNRSTN :: v2.00.0000 PRE-ALPHA-DEV (Lightsaber)" title="CRNRSTN :: v2.00.0000 PRE-ALPHA-DEV (Lightsaber)">
                        )

                )

        )].

        */

        return false;

    }

    //
    // THIS IS AS CLOSE TO ASSET RETURN AS IT IS POSSIBLE TO GET FOR CAPTURE AND CACHE OF RETURN PROFILE.
    public function ____initialize_response_map_cache($output_method, $output_mode = NULL, $param0 = NULL, $param1 = NULL, $param2 = NULL, $param3 = NULL, $param4 = NULL, $param5 = NULL, $param6 = NULL, $param7 = NULL, $param8 = NULL, $param9 = NULL, $param10 = NULL){

        error_log(__LINE__ . ' rrs map initialize cache $output_method[' . $output_method . ']. $output_mode[' . $output_mode . ']. $param0[' . $param0 . ']. $param1[' . $param1 . ']. $param2[' . $param2 . ']. $param3[' . $param3 . '].');
        die();
        $tmp_response_map_ugc_value = $this->get_salt_ugc();

        switch($output_method){
            case 'return_html_favicon_head_meta':

                //('return_html_favicon_head_meta',
                // CRNRSTN_FAVICON,  $output_mode
                // $tmp_meta_ARRAY,-----    $param0
                //$tmp_filepath;------         $param1
                // $tmp_url);------         $param2

                /*
                $param0['asset_data_key'] = $asset_data_key;
                $param0['asset_family'] = $tmp_asset_family;
                $param0['filename'] = $tmp_filename;
                $param1['raw_output_mode'] = $tmp_raw_output_mode;
                $param1['output_mode'] = $output_mode;

                private static $request_family_ARRAY = array();
                private static $salt_ugc_ARRAY = array();
                private static $request_asset_meta_key_ARRAY = array();
                private static $request_asset_meta_path_ARRAY = array();

                $param0['asset_data_key'] = $asset_data_key;
                $param0['asset_family'] = $tmp_asset_family;
                $param0['filename'] = $tmp_filename;
                $param0['width'] = $tmp_width;
                $param0['height'] = $tmp_height;
                $param0['alt'] = $tmp_alt;
                $param0['title'] = $tmp_title;
                $param0['hyperlink'] = $tmp_link;
                $param0['target'] = $tmp_target;
                $param0['raw_output_mode'] = $tmp_raw_output_mode;
                $param0['output_mode'] = $output_mode;
                'return_html_favicon_head_meta', CRNRSTN_FAVICON, $tmp_meta_ARRAY, $tmp_filepath, $tmp_url
                */

                //     initialize_request($request_ugc_val,     $asset_family,          $asset_meta_key,  $asset_meta_path, $asset_meta_ARRAY, $raw_output_mode = NULL, $output_mode = NULL){
                $this->initialize_request($param0['filename'], $param0['asset_family'], $param0['asset_data_key'], NULL, $param0, $param0['raw_output_mode'], $output_mode);
                self::$cache_rrs_map_file_extension_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]] = 'ico';
                self::$cache_rrs_map_filepath_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]] = $param1;
                self::$cache_rrs_map_image_string_ARRAY[$this->oCRNRSTN->request_id][CRNRSTN_FAVICON][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]] = $param2;
                self::$cache_rrs_map_filename_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]] = $param0['filename'];

//                self::$cache_rrs_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]] = $output_mode;
//                self::$cache_rrs_map_output_method_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]] = $output_method;
//                self::$cache_rrs_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]] = $output_mode;
//                self::$cache_rrs_map_raw_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]] = $param0['raw_output_mode'];

            break;
            case 'return_file_http_string':

                //
                // DO NOT CACHE THIS OUTPUT.
                switch($output_mode){
                    case CRNRSTN_HTML:
                    case CRNRSTN_HTML & CRNRSTN_BASE64:
                    case CRNRSTN_HTML & CRNRSTN_ASSET_MODE_BASE64:
                    case CRNRSTN_HTML & CRNRSTN_BASE64_JPEG:
                    case CRNRSTN_HTML & CRNRSTN_BASE64_PNG:
                    //case CRNRSTN_HTML & CRNRSTN_ASSET_MODE_BASE64 & CRNRSTN_JPEG:
                    //case CRNRSTN_HTML & CRNRSTN_ASSET_MODE_BASE64 & CRNRSTN_PNG:
                    case CRNRSTN_HTML & CRNRSTN_ASSET_MODE_JPEG:
                    case CRNRSTN_HTML & CRNRSTN_JPEG:
                    case CRNRSTN_HTML & CRNRSTN_ASSET_MODE_PNG:
                    case CRNRSTN_HTML & CRNRSTN_PNG:

                        //
                        // A MANUAL WRITE FOR INITIALIZATION SINCE HTML CACHE WAS REMOVED.
                        error_log(__LINE__ . ' rrs map A MANUAL WRITE FOR INITIALIZATION SINCE HTML CACHE WAS REMOVED. [return_image_html_wrapped].');
                        self::$cache_rrs_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]] = $output_mode;
                        self::$cache_rrs_map_output_method_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]] = 'return_image_html_wrapped';

                        return NULL;

                    break;

                }

                //
                // $output_method = 'return_image_html_wrapped'
                // $param0 = $url
                //error_log(__LINE__ . ' rrs map NEW CACHE $output_method[' . $output_method . ']. $url[' . $param0 . ']. die();');
                $tmp_auth_channel_ARRAY = $this->new_cache_bytes($output_method.$param0);

                //error_log(__LINE__ . ' rrs map NEW CACHE $tmp_auth_channel_ARRAY[' . print_r($tmp_auth_channel_ARRAY, true) . '].');

                foreach($tmp_auth_channel_ARRAY as $index => $channel){
                    //error_log(__LINE__ . ' rrs map NEW CACHE $channel[' . $channel . '].');

                    switch($channel){
                        case CRNRSTN_CHANNEL_POST:
                        case CRNRSTN_CHANNEL_GET:
                        case CRNRSTN_CHANNEL_SOAP:
                        case CRNRSTN_CHANNEL_SESSION:
                            //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).
                        case CRNRSTN_CHANNEL_COOKIE:
                        case CRNRSTN_CHANNEL_SSDTLA:
                        case CRNRSTN_CHANNEL_PSSDTLA:
                        case CRNRSTN_CHANNEL_DATABASE:

                            //error_log(__LINE__. ' rrs map NOW TIME TO STORE RRS MAP CACHE IN CHANNEL [' . $channel . ']. $output_mode[' . $output_mode . ']. die();');

                        break;
                        case CRNRSTN_CHANNEL_RUNTIME:

                            error_log(__LINE__ . ' rrs map FINISH UI_STR RETURN FOR RRS MAP. NEED FILEPATH NEXT...');

                            //rrs_map_filepath
                            self::$cache_rrs_map_output_method_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]] = $output_method;
                            self::$cache_rrs_map_image_string_ARRAY[$this->oCRNRSTN->request_id][self::$request_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]]][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]] = $param0;

                            self::$cache_rrs_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]] = self::$request_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]];
                            //self::$cache_rrs_map_raw_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]] = self::$cache_rrs_map_raw_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]];
                            error_log(__LINE__ . ' rrs map STORING RRS MAP CACHE IN CHANNEL [' . $channel . ']. $output_mode[' . self::$request_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]] . ']. $param0[' . $param0 . ']. die();');

                        break;
                        default:

                            error_log(__LINE__ . ' rrs map Unknown channel [' . $channel . '] provided. Unable to initialize rrs map cache.');

                        break;
                    }

                }

            break;
            case 'return_image_html_wrapped_image_base64':

                //
                // $output_method = 'return_image_html_wrapped_image_base64'
                // $param0 = $filepath_base64
                // CHANNEL
                // $param1 = $width
                // $param2 = $height
                // $param3 = $alt
                // $param4 = $title
                // $param5 = $link
                // $param6 = $target
                // $param7 = $asset_family
                // $param8 = $output_mode
                // $param9 = $asset_mapping_mode
                // *$param10 = $image_cache_string
                //
                // * where, $image_cache_string = '<img src="{CRNRSTN_SYS_BASE64}" ' . $tmp_width . $tmp_height . $tmp_alt . $tmp_title . '>';

                error_log(__LINE__ . ' rrs map BASE64 UGC METHOD INDEX IS [' . $tmp_response_map_ugc_value . ']. die();');

                //self::$cache_rrs_map_filepath_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]]['filepath_base64']
                //die();
                //$tmp_response_serial = $param0.$param1.$param2.$param3.$param4.$param5.$param6.$param7.$param8.$param9;

                $tmp_cache_data = $output_method.$param10;
                //$tmp_auth_channel_ARRAY = $this->new_cache_bytes($tmp_cache_data);

                foreach($tmp_auth_channel_ARRAY as $index => $channel){

                    switch($channel){
                        case CRNRSTN_CHANNEL_GET:
                        case CRNRSTN_CHANNEL_SOAP:
                        case CRNRSTN_CHANNEL_SESSION:
                            //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).
                        case CRNRSTN_CHANNEL_COOKIE:
                        case CRNRSTN_CHANNEL_SSDTLA:
                        case CRNRSTN_CHANNEL_DATABASE:

                            ////error_log(__LINE__. ' rrs map NOW TIME TO STORE RRS MAP CACHE IN CHANNEL [' . $channel . ']. die();');

                        break;
                        case CRNRSTN_CHANNEL_RUNTIME:

                            //$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial] = $tmp_response_serial;
                            error_log(__LINE__ . ' rrs map NEW CACHE $output_mode[' . $output_mode . ']. id[' . self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value] . ']. $output_method[' . $output_method . ']. $filepath_base64[' . $param0 . ']. $image_cache_string[' . $param10 . '].');
                            self::$cache_rrs_map_output_method_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]] = $output_method;
                            self::$cache_rrs_map_filepath_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]]['filepath_base64'] = $param0;
                            self::$cache_rrs_map_image_string_ARRAY[$this->oCRNRSTN->request_id][$output_mode][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]] = $param10;
                            //self::$cache_rrs_map_output_method_ARRAY[$output_mode][$tmp_response_map_ugc_value] = $output_method;

                            self::$cache_rrs_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]] = self::$request_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]];
                            //self::$cache_rrs_map_raw_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]] = self::$cache_rrs_map_raw_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]];

                        break;
                        default:

                            error_log(__LINE__ . ' rrs map Unknown $channel[' . $channel . '].');

                        break;

                    }

                }

            break;
            case 'return_image_html_wrapped':

                //
                // THIS HAS BEEN TURNED OFF. THIS DATA DOESN'T RETURN THE KIND OF DIVIDENDS WE'VE COME TO
                // EXPECT...MAYBE IF ASSET HTML REQUESTS VIA PROXY BECOME A THING...WE COULD WARRANT THIS WITHIN THAT
                // CONTEXT. FOR NOW, JUST BUILD THE IMAGE HTML STRING FROM SCRATCH. IT IS NOT TOO HARD.
                // - Saturday, April 8, 2023 0533 hrs
                //return NULL;

                //
                // $output_method = 'return_image_html_wrapped'
                // $param0 = $filename
                // $param1 = $width
                // $param2 = $height
                // $param3 = $alt
                // $param4 = $title
                // $param5 = $link
                // $param6 = $target
                // $param7 = $asset_family
                // $param8 = $output_mode
                // $param9 = $asset_mapping_mode
                // $param10 = $image_cache_string

                //$tmp_response_serial = $param0.$param1.$param2.$param3.$param4.$param5.$param6.$param7.$param8.$param9;
                //$tmp_auth_channel_ARRAY = $this->new_cache_bytes($output_method.$tmp_response_serial.$param10);
                foreach($tmp_auth_channel_ARRAY as $index => $channel){

                    switch($channel){
                        case CRNRSTN_CHANNEL_SESSION:
                        case CRNRSTN_CHANNEL_COOKIE:
                        case CRNRSTN_CHANNEL_PSSDTLA:
                        case CRNRSTN_CHANNEL_SSDTLA:
                        case CRNRSTN_CHANNEL_DATABASE:
                        case CRNRSTN_CHANNEL_GET:
                        case CRNRSTN_CHANNEL_POST:
                        case CRNRSTN_CHANNEL_SOAP:

                            ////error_log(__LINE__. ' rrs map NOW TIME TO STORE RRS MAP CACHE IN CHANNEL [' . $channel . ']. die();');
                            //die();

                        break;
                        default:
                            // runtime

                            //error_log(__LINE__ . ' rrs map NEW CACHE $output_method[' . $output_method . ']. $image_string[' . $param10 . ']. INDEX_OVERRIDE=tmp_response_serial[' . $tmp_response_serial . '].');

                            if($tmp_response_serial == $this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]){

                                error_log(__LINE__ . ' rrs map $tmp_response_serial REDUNDANT! DO NOT UPDATE!');

                            }else{

                                error_log(__LINE__ . ' rrs map NOT REDUNDANT. UPDATE IS NECESSARY! $tmp_response_serial[' . $tmp_response_serial . ']. [' . $this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial] . '].');

                            }

                            // NEED TO TRACK ON INDEX [$tmp_response_serial] SEPARATELY IF WE WANT TO LOAD RUNTIME OFF CACHE LIKE WE SAID WE DO.
                            $this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial] = $tmp_response_serial;
                            self::$cache_rrs_map_output_method_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]] = $output_method;
                            self::$cache_rrs_map_image_string_ARRAY[$this->oCRNRSTN->request_id][self::$request_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]]][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]] = $param10;

                            self::$cache_rrs_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]] = self::$request_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]];
                            //self::$cache_rrs_map_raw_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]] = self::$cache_rrs_map_raw_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]];

                        break;

                    }

                }

            break;
            case 'return_js_css_string_output':

                //
                // $output_method = 'return_js_css_string_output'
                // $param0 = $js_integer_constant
                // $param1 = $css_integer_constant
                // $param2 = $footer_html_output[boolean]
                // $param3 = $is_dev_mode[boolean]

                //$tmp_auth_channel_ARRAY = $this->new_cache_bytes($output_method.$param0.$param1.$param2.$param3);
                foreach($tmp_auth_channel_ARRAY as $index => $channel){

                    switch($channel){
                        case CRNRSTN_CHANNEL_SESSION:
                        case CRNRSTN_CHANNEL_COOKIE:
                        case CRNRSTN_CHANNEL_PSSDTLA:
                        case CRNRSTN_CHANNEL_SSDTLA:
                        case CRNRSTN_CHANNEL_DATABASE:
                        case CRNRSTN_CHANNEL_GET:
                        case CRNRSTN_CHANNEL_POST:
                        case CRNRSTN_CHANNEL_SOAP:

                            ////error_log(__LINE__ . ' rrs map NOW TIME TO STORE RRS MAP CACHE IN CHANNEL [' . $channel . ']. die();');
                            //die();

                        break;
                        default:
                            // runtime

                            //error_log(__LINE__ . ' rrs map NOW TIME TO STORE RRS MAP CACHE IN CHANNEL [' . $channel . ']. die();');

                            self::$cache_rrs_map_output_method_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]] = $output_method;
                            error_log(__LINE__ . ' rrs map NEW CACHE map output_method[' . $output_method . ']. $output_mode[' . $output_mode . ']. ARRAY[' . print_r(self::$cache_rrs_map_output_method_ARRAY, true) . ']. $js_integer_constant[' . $param0 . ']. $css_integer_constant[' . $param1 . ']. BOOL $footer_html_output[' . $param2 . ']. BOOL $is_dev_mode[' . $param3 . ']. $image_string[' . $param0 . '].');

                            self::$cache_rrs_map_str_output_const_alpha_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]] = $param0;
                            self::$cache_rrs_map_str_output_const_beta_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]] = $param1;

                            self::$cache_rrs_map_str_output_footer_html_output_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]] = $this->oCRNRSTN->tidy_boolean($param2);
                            self::$cache_rrs_map_str_output_is_dev_mode_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]] = $param3;

                        break;

                    }

                }

            break;
            case 'return_asset_data':

                //
                // $output_method = 'return_asset_data'
                // $param0 = $asset_meta_key
                // $param1 = $salt_ugc
                // $param2 = $request_family
                // $param3 = $asset_meta_path

                //$tmp_auth_channel_ARRAY = $this->new_cache_bytes($output_method.$param0.$param1.$param2.$param3);
                foreach($tmp_auth_channel_ARRAY as $index => $channel){

                    switch($channel){
                        case CRNRSTN_CHANNEL_SESSION:
                        case CRNRSTN_CHANNEL_COOKIE:
                        case CRNRSTN_CHANNEL_PSSDTLA:
                        case CRNRSTN_CHANNEL_SSDTLA:
                        case CRNRSTN_CHANNEL_DATABASE:
                        case CRNRSTN_CHANNEL_GET:
                        case CRNRSTN_CHANNEL_POST:
                        case CRNRSTN_CHANNEL_SOAP:

                            error_log(__LINE__ . ' rrs map NOW TIME TO STORE RRS MAP CACHE IN CHANNEL [' . $channel . '].');
                            // die();

                        break;
                        default:
                            // runtime

                            error_log(__LINE__ . ' rrs map INITIALIZE RRS MAP CACHE. CHANNEL [' . $channel . ']. output_method[' . $output_method . '].');
                            error_log(__LINE__ . ' rrs map NEW CACHE $asset_meta_key[' . $param3 . ']. $salt_ugc[' . $param0 . ']. $request_family[' . $param1 . ']. $asset_meta_path[' . $param2 . '].');
                            error_log(__LINE__ . ' rrs map NEW CACHE $param3[' . $param3 . ']. $param0[' . $param0 . ']. $param1[' . $param1 . ']. $param2[' . $param2 . '].');

                            /*
                            [Wed Apr 12 06:16:06.448171 2023] [:error] [pid 118564] [client 172.16.225.1:52420] 2399 rrs map NEW CACHE
                            $output_method[return_asset_data]. $asset_meta_key[jquery-3.6.1.js]. $salt_ugc[js]. $request_family[_lib/frameworks/jquery/3.6.1]. $asset_meta_path[].

                            */

                            error_log(__LINE__ . ' rrs map return RAW RESOURCE [' . self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]] . '].');
                            error_log(__LINE__ . ' rrs map $cache_rrs_map_filepath_ARRAY[.');
                            error_log(__LINE__ . ' rrs map $cache_rrs_map_filename_ARRAY.');
                            //$tmp=strlen($tmtp=array());
                            error_log(__LINE__ . ' rrs map ADD TO CACHE $output_method[' . $output_method . ']. $param0[' . $param0 . ']. $param1[' . $param1 . ']. $param2[' . $param2 . ']. $param3[' . $param3 . '].');
                            //die();
//
//                            if(isset($this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial])){
//
//                                self::$cache_rrs_map_output_method_ARRAY = $output_method;
//                                self::$cache_rrs_map_filepath_ARRAY = $param3;
//                                //self::$cache_rrs_map_str_output_footer_html_output_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]] = $this->oCRNRSTN->tidy_boolean($param1);
//                                //self::$cache_rrs_map_str_output_is_dev_mode_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]] = $this->oCRNRSTN->tidy_boolean($param2);
//
//                                self::$cache_rrs_map_output_mode_ARRAY = self::$request_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]];
//                                //self::$cache_rrs_map_raw_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]] = self::$cache_rrs_map_raw_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]];
//                                error_log(__LINE__ . ' rrs map SET $cache_rrs_map_output_method_ARRAY [' . $channel . ']. $output_method[' . $output_method . ']. $param3['.$param3.']. [].');
//
//                            }

                        break;

                    }

                }

            break;
            case 'return_css_string_output':
            case 'return_js_string_output':

                //
                // $output_method = 'return_file_string_output'
                // $param0 = $const
                // $param1 = $footer_html_output[boolean]
                // $param2 = $is_dev_mode[boolean]

                //$tmp_auth_channel_ARRAY = $this->new_cache_bytes($output_method.$param0.$param1.$param2);
                foreach($tmp_auth_channel_ARRAY as $index => $channel){

                    switch($channel){
                        case CRNRSTN_CHANNEL_SESSION:
                        case CRNRSTN_CHANNEL_COOKIE:
                        case CRNRSTN_CHANNEL_PSSDTLA:
                        case CRNRSTN_CHANNEL_SSDTLA:
                        case CRNRSTN_CHANNEL_DATABASE:
                        case CRNRSTN_CHANNEL_GET:
                        case CRNRSTN_CHANNEL_POST:
                        case CRNRSTN_CHANNEL_SOAP:

                            error_log(__LINE__ . ' rrs map NOW TIME TO STORE RRS MAP CACHE IN CHANNEL [' . $channel . ']. die();');
                            //die();

                        break;
                        default:
                            // runtime
                            // NEED TO TRACK ON INDEX [$tmp_response_serial] SEPARATELY IF WE WANT TO LOAD RUNTIME OFF CACHE LIKE WE SAID WE DO.

                            //error_log(__LINE__ . ' rrs map NOW TIME TO STORE RRS MAP CACHE IN CHANNEL [' . $channel . ']. die();');
                            error_log(__LINE__ . ' rrs map NEW CACHE $output_method[' . $output_method . ']. $const[' . $param0 . ']. BOOL $footer_html_output[' . $this->oCRNRSTN->tidy_boolean($param1) . ']. BOOL $is_dev_mode[' . $this->oCRNRSTN->tidy_boolean($param2) . '].');

                            self::$cache_rrs_map_output_method_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]] = $output_method;
                            self::$cache_rrs_map_str_output_const_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]] = $param0;
                            self::$cache_rrs_map_str_output_footer_html_output_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]] = $this->oCRNRSTN->tidy_boolean($param1);
                            self::$cache_rrs_map_str_output_is_dev_mode_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]] = $this->oCRNRSTN->tidy_boolean($param2);

                            self::$cache_rrs_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]] = self::$request_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]];
                            //self::$cache_rrs_map_raw_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]] = self::$cache_rrs_map_raw_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]];

                        break;

                    }

                }

            break;
            case 'return_file_byte_chunked_buffer_output':

                //
                // $output_method = 'return_file_byte_chunked_buffer_output'
                // $param0 = $filepath
                // $param1 = $filename
                // $param2 = $file_extension

                error_log(__LINE__ . ' rrs map DEPRECATED?');

                //$tmp_auth_channel_ARRAY = $this->new_cache_bytes($output_method.$param0.$param1.$param2);
                foreach($tmp_auth_channel_ARRAY as $index => $channel){

                    //die();
                    switch($channel){
                        case CRNRSTN_CHANNEL_SESSION:
                        case CRNRSTN_CHANNEL_COOKIE:
                        case CRNRSTN_CHANNEL_PSSDTLA:
                        case CRNRSTN_CHANNEL_SSDTLA:
                        case CRNRSTN_CHANNEL_DATABASE:
                        case CRNRSTN_CHANNEL_GET:
                        case CRNRSTN_CHANNEL_POST:
                        case CRNRSTN_CHANNEL_SOAP:

                            //error_log(__LINE__ . ' rrs map NOW TIME TO STORE RRS MAP CACHE IN CHANNEL [' . $channel . ']. die();');

                        break;
                        default:
                            // runtime

                            error_log(__LINE__ . ' rrs map NOW TIME TO STORE RRS MAP CACHE IN CHANNEL [' . $channel . '].');
                            error_log(__LINE__ . ' rrs map NEW CACHE $output_method[' . $output_method . ']. $output_mode[' . $output_mode . ']. $filepath[' . $param0 . ']. $file_extension[' . $param2 . '].');

                            self::$cache_rrs_map_output_method_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]] = $output_method;
                            self::$cache_rrs_map_filepath_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]] = $param0;

//                            if($param1 !== ''){
//
//                                if($this->oCRNRSTN->return_crnrstn_asset_family() == 'favicon'){
//
//                                    $param1 = $this->oCRNRSTN->return_response_map_ugc_value();
//
//                                }
//                                error_log(__LINE__ . ' rrs map filename[' . $param1 . '].');
//                                self::$cache_rrs_map_filename_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]] = $param1;
//
//                            }

                            self::$cache_rrs_map_file_extension_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]] = $param2;
                            //error_log(__LINE__ . ' rrs map NEW CACHE $output_method[' . $output_method . ']. $filepath[' . $param0 . ']. $filename[' . $param1 . ']. $file_extension[' . $param2 . ']. self::$cache_rrs_map_file_extension_ARRAY[' . print_r(self::$cache_rrs_map_file_extension_ARRAY, true).'].');

                            $tmp_output_mode = self::$request_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]];
                            self::$cache_rrs_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]] = $tmp_output_mode;
                            self::$cache_rrs_map_raw_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]] = self::$cache_rrs_map_raw_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_map_ugc_value]];

                        break;

                    }

                }

            break;
            default:

                //error_log(__LINE__ . ' rrs map Unknown output method [' . $output_method . '] provided. Unable to return requested resource [' . $param0 . '] [' . $param1 . '].');
                $this->oCRNRSTN->error_log('Unknown output method [' . $output_method . '] provided. Unable to return requested resource [' . $param0 . '] [' . $param1 . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

            break;

        }

        if(isset($this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial])){

            self::$request_current_fulfilled_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]] = 1;
            self::$request_current_fulfilled_method_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]] = $output_method;

            if(isset(self::$request_page_fulfilled_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]])){

                self::$request_page_fulfilled_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]] = 1;
                self::$request_parent_fulfilled_method_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]] = $output_method;

            }

            error_log(__LINE__ . ' rrs map INITIALIZATION FULFILLMENT?? [' . print_r(self::$request_current_fulfilled_ARRAY, true) . '].');

        }

    }

    public function rrs_map_is_asset_return(){

        if($this->oCRNRSTN->is_bit_set(CRNRSTN_CHANNEL_GET) == true){

            return true;

        }

        return false;

    }

    public function deactivate_destruct_rrs_map_sync(){

        error_log(__LINE__ . ' rrs map ********** deactivate_destruct_rrs_map_sync().');
        self::$destruct_sync_inactive = true;

    }

    public function rrs_map_execute($name){

        $tmp_output_method = '';
        $raw_output_mode = NULL;
        $output_mode = NULL;

        $tmp_salt_ugc = $_GET[$this->oCRNRSTN->session_salt()];
        $tmp_cache_id = NULL;

        switch($name){
            case 'runtime_cache_accelerated_return':

                error_log(__LINE__ . ' rrs map CHECK RUNTIME ACCELERATE FOR $tmp_cache_id[' . $tmp_cache_id . ']. $tmp_salt_ugc[' . $tmp_salt_ugc . '].');

                //
                // INITIALIZE RESOURCE ID.
                if(isset(self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_salt_ugc])){


                    $tmp_cache_id = self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_salt_ugc];
                    $tmp_fulfillment_driver = self::$request_fulfillment_driver_ARRAY[$this->oCRNRSTN->request_id][$tmp_salt_ugc] = CRNRSTN_CHANNEL_RUNTIME;
                    error_log(__LINE__ . ' rrs map PROCESS RUNTIME ACCELERATE FOR $tmp_cache_id[' . $tmp_cache_id . ']. $tmp_salt_ugc[' . $tmp_salt_ugc . '].');

                }

            break;
            case 'session_cache_accelerated_return':

                //
                // FIRST TO FIRE ON $_GET FOR APPLICATION ACCELERATION.
                // INITIALIZE CACHE ID.
                if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$tmp_salt_ugc])){

                    $tmp_cache_id = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$tmp_salt_ugc];

                    error_log(__LINE__ . ' rrs map ***** PROCESS SESSION ACCELERATE cache_id[' . $tmp_cache_id . ']. [' . $this->oCRNRSTN->wall_time() . ' seconds] FOR $tmp_salt_ugc[' . $tmp_salt_ugc . ']. SESSION[' . print_r($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'], true) . '].');

                    self::$destruct_sync_inactive = true;

                    self::$request_fulfillment_driver_ARRAY[$this->oCRNRSTN->request_id][$tmp_salt_ugc] = CRNRSTN_CHANNEL_SESSION;

                    if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['asset_family'][$tmp_cache_id])){

                        $tmp_response_map_asset_meta_key = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['asset_meta_key'][$tmp_cache_id];
                        $tmp_response_map_request_ugc_value = $tmp_salt_ugc;
                        $asset_family = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['asset_family'][$tmp_cache_id];
                        $tmp_response_map_asset_meta_path = '';
                        if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['meta_path'][$tmp_cache_id])){

                            $tmp_response_map_asset_meta_path = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['meta_path'][$tmp_cache_id];

                        }

                        error_log(__LINE__ . ' rrs map $tmp_response_map_request_ugc_value[' . $tmp_response_map_request_ugc_value . '].');


                        //$tmp_raw_output_mode = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['raw_output_mode'][$tmp_cache_id];

//                        //
//                        // CACHE TTL CHECK.
//                        $tmp_max_time = self::$session_map_cache_ttl + (int) $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['lastmodified'][$tmp_cache_id];
//                        $tmp_time = time();
//
//                        //if(($tmp_time < $tmp_max_time) && ($tmp_max_time > (int) $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['lastmodified'][$tmp_cache_id])){
//                        $tmp_delta = (int) $tmp_max_time - (int) $tmp_time;
//                        error_log(__LINE__ . ' rrs map TTL[' . $tmp_delta . ']. self::$session_map_cache_ttl[' . self::$session_map_cache_ttl . ']. lastmodified[' . $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['lastmodified'][$tmp_cache_id] . '] $tmp_max_time[' . $tmp_max_time . ']. EXPIRE CACHE FOR $tmp_salt_ugc[' . $tmp_salt_ugc . ']. $tmp_raw_output_mode[' . $tmp_raw_output_mode . '].');
//
//                        if((((int) $tmp_delta) * 1) > 0){
//
//                            error_log(__LINE__ . ' rrs map ********** DISABLE __DESTRUCT() RRS MAP CACHE SESSION SYNC.');
//                            self::$destruct_sync_inactive = true;
//                            //return '';
//
//                        }else{
//
//                            error_log(__LINE__ . ' rrs map ********** ???NO DISABLE __DESTRUCT() RRS MAP CACHE SESSION SYNC???');
//                            self::$destruct_sync_inactive = false;
//
//                        }

                        /*
                        SYSTEM/SCRIPT COMBINED CURRENT REPORT - Both system and script memory allocations. Real-time metrics.
                        $mem_report_queue[] = 0;
                        MEM USAGE: 2 MiB total. 410.625 KiB by CRNRSTN ::

                        COMPLETE CPU LOAD REPORT - Current System processor load and with averages taken over 1, 5, and 15 min.
                        $mem_report_queue[] = 1;
                        CPU LOAD: [0.1%, 0.1%, 0.1%] average in the last [1, 5, 15min] respectively.

                        SCRIPT DELTA FROM BOOT REPORT - The DELTA (from BOOT) of script memory allocation.
                        $mem_report_queue[] = 5:
                        CRNRSTN :: MEM USAGE (+/- FROM PHP BOOT): +1.67 MiB.

                        */

                        $tmp_cnt = 0;

                        //$this->config_add_resource(CRNRSTN_RESOURCE_ALL, '', $tmp_ARRAY, 'CRNRSTN::RESOURCE::REPORTING');
                        $tmp_max_asset = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');

                        if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP_CACHE_REPORT']['rrs_map_report'][$tmp_response_map_request_ugc_value])){

                            $tmp_cnt = count($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP_CACHE_REPORT']['rrs_map_report'][$tmp_response_map_request_ugc_value]);

                        }

                        //
                        // IF WITHIN REPORTING LIMITS FOR MAX NUMBER OF ASSETS TO REPORT.
                        if($tmp_cnt < ((int) $tmp_max_asset - 1)){

                            $mem_report_queue = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');
                            $mem_reports_ARRAY = $this->oCRNRSTN->mem_report($mem_report_queue, 'HTML', 10, true);

                            //
                            // WRITE CRNRSTN :: PLAID REPORTING TO SESSION.
                            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP_CACHE_REPORT']['rrs_map_report'][$tmp_response_map_request_ugc_value]['mem_report'][] = $mem_reports_ARRAY;

                        }

                        //
                        // RETURN IMAGE HERE IF SYSTEM OR SOCIAL.
                        if($asset_family == 'system' || $asset_family == 'social'){

                            error_log(__LINE__ . ' rrs map Application Acceleration [session] FIRE. RRS Map resource return. $asset_family[' . $asset_family . ']. $tmp_response_map_request_ugc_value[' . $tmp_response_map_request_ugc_value . ']. $tmp_response_map_asset_meta_key[' . $tmp_response_map_asset_meta_key . ']. $tmp_response_map_asset_meta_path[' . $tmp_response_map_asset_meta_path . '].');

                            switch($asset_family){
                                case 'system':

                                    $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_system_asset_map_dir_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
                                    $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_system_asset_map_http_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH'));
                                    $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');


                                break;
                                case 'social':

                                    $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_social_asset_map_dir_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
                                    $tmp_http = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_social_asset_map_http_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH'));
                                    $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');

                                break;

                            }

                            //
                            // PNG BY DEFAULT FOR SYSTEM IMAGES.
                            $tmp_file_extension = 'png';
                            if($this->oCRNRSTN->is_bit_set(CRNRSTN_ASSET_MODE_JPEG) == true){

                                $tmp_file_extension = 'jpg';

                            }

                            //
                            // EXTRACT SYSTEM RESOURCE CACHE META DATA.
                            $tmp_meta_ARRAY = $this->oCRNRSTN->asset_data_meta($tmp_response_map_asset_meta_key, $asset_family);

                            /*'
                             $tmp_ARRAY['asset_data_key'] = $asset_data_key;
                            $tmp_ARRAY['asset_family'] = $tmp_asset_family;
                            $tmp_meta_ARRAY['filename'] = $tmp_filename;
                            $tmp_ARRAY['raw_output_mode'] = $tmp_raw_output_mode;
                            // SET ABOVE. $tmp_ARRAY['output_mode_method_src'] =

                            */

                            $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');

                            $tmp_filepath = $tmp_path . DIRECTORY_SEPARATOR .  $tmp_file_extension . DIRECTORY_SEPARATOR . $asset_family . DIRECTORY_SEPARATOR . $tmp_salt_ugc . '.' . $tmp_file_extension;

                            //
                            // TAKE FILE EXTENSION TO CRNRSTN :: PLAID.
                            $tmp_filename_ARRAY = explode('.', $tmp_filepath);
                            $file_extension = array_pop($tmp_filename_ARRAY);

                            error_log(__LINE__ . ' rrs map $tmp_meta_ARRAY[' . $tmp_meta_ARRAY['raw_output_mode'] . ']. $tmp_filename[' . $tmp_meta_ARRAY['filename'] . ']. $tmp_filepath[' . $tmp_filepath . ']. $file_extension[' . $tmp_file_extension . '].');

                            error_log(__LINE__ . ' rrs map Application Acceleration [session] FIRE. RRS Map resource return. $asset_family[' . $asset_family . ']. $tmp_response_map_request_ugc_value[' . $tmp_response_map_request_ugc_value . ']. $tmp_response_map_asset_meta_key[' . $tmp_response_map_asset_meta_key . ']. $tmp_response_map_asset_meta_path[' . $tmp_response_map_asset_meta_path . '].');
                            if(is_file($tmp_filepath)){

                                return $this->oCRNRSTN->return_file_byte_chunked_buffer_output($tmp_filepath, $tmp_meta_ARRAY['filename'], $tmp_file_extension, $tmp_meta_ARRAY['raw_output_mode']);

                            }

                        }

                        return $this->oCRNRSTN->return_asset_data($tmp_response_map_request_ugc_value, $asset_family, $tmp_response_map_asset_meta_key, $tmp_response_map_asset_meta_path, 'session');

                    }

//                        //
//                        // CACHE TTL CHECK.
//                        $tmp_max_time = self::$session_map_cache_ttl + (int) $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['lastmodified'][$tmp_cache_id];
//                        $tmp_time = time();
//                        if(($tmp_time > $tmp_max_time) && ($tmp_max_time > (int) $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['lastmodified'][$tmp_cache_id])){
//
//                            //error_log(__LINE__ . ' rrs map TTL EXPIRE CACHE FOR $tmp_salt_ugc[' . $tmp_salt_ugc . ']. $tmp_raw_output_mode[' . $tmp_raw_output_mode . '].');
//                            //die();
//                            return '';
//
//                        }
//
//                        return $this->oCRNRSTN->return_asset_data($tmp_response_map_request_ugc_value, $asset_family, $tmp_response_map_asset_meta_key, $tmp_response_map_asset_meta_path, 'session');

                }

            break;
            case 'ssdtla_cache_accelerated_return':
            case 'cookie_cache_accelerated_return':
            case 'database_cache_accelerated_return':
            case 'soap_cache_accelerated_return':
            case 'get_cache_accelerated_return':
                // NOT YET IMPLEMENTED FOR $_GET ASSET RETURN ACCELERATION.
            break;
            default:

                error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

            break;

        }

        //
        // TAKE THIS OPPORTUNITY TO ACCELERATE THE RETURN OF RESOURCE.
        switch($name){
            case 'runtime_cache_accelerated_return':

                //
                // ARRAY ONLY POPULATED UPON INITIALIZATION OF OUTPUT CACHE.
                if(isset(self::$cache_rrs_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][$tmp_cache_id])){

                    $output_mode = self::$cache_rrs_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][$tmp_cache_id];
                    if(isset(self::$cache_rrs_map_raw_output_mode_ARRAY[$this->oCRNRSTN->request_id][$tmp_cache_id])){

                        $raw_output_mode = self::$cache_rrs_map_raw_output_mode_ARRAY[$this->oCRNRSTN->request_id][$tmp_cache_id];

                    }

                }else{

                    //
                    // USE RAW (RESOURCE DEFAULT) OUTPUT MODE AS PRIMARY MODE IF NONE PROVIDED.
                    if(isset(self::$cache_rrs_map_raw_output_mode_ARRAY[$this->oCRNRSTN->request_id][$tmp_cache_id])){

                        $output_mode = $raw_output_mode = self::$cache_rrs_map_raw_output_mode_ARRAY[$this->oCRNRSTN->request_id][$tmp_cache_id];

                    }

                }

                if(!isset($output_mode)){

                    //
                    // ABORT RESOURCE RETURN ACCELERATION ATTEMPT DUE TO INCOMPLETE RRS MAP PROFILE.
                    return '';

                }

                error_log(__LINE__ . ' rrs map RUNTIME ACCELERATION $tmp_cache_id[' . $tmp_cache_id . '].');

                switch($tmp_output_method){
                    case 'return_file_http_string':

                        //
                        // http://172.16.225.139/lightsaber.crnrstn.evifweb.com/?crnrstn_0010111011=crnrstn_logo_lg
                        // EXECUTE EARLIEST OUTPUT OF MAPPED CACHE RETURN HERE.
                        // RESOURCE CACHE INITIALIZATION CHECK.
                        //
                        // SETTING THIS ON MATCH OF SESSION MANAGED RESOURCE.
                        if(isset(self::$request_fulfillment_driver_ARRAY[$this->oCRNRSTN->request_id][$tmp_salt_ugc])){

                            switch(self::$request_fulfillment_driver_ARRAY[$this->oCRNRSTN->request_id][$tmp_salt_ugc]){
                                case CRNRSTN_CHANNEL_RUNTIME:

                                    if(isset(self::$cache_rrs_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_salt_ugc]])){
                                    //if(isset(self::$cache_rrs_map_output_method_ARRAY[$output_mode][$tmp_salt_ugc])){

                                        //
                                        // RESPONSE RETURN APPLICATION ACCELERATION.
                                        $url = self::$cache_rrs_map_image_string_ARRAY[$this->oCRNRSTN->request_id][$output_mode][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_salt_ugc]];
                                        $tmp_return = $this->oCRNRSTN->return_file_http_string($url);
                                        error_log(__LINE__ . ' rrs map Application Acceleration [runtime] FIRE. RRS Map resource return. $tmp_return[' . $tmp_return . '].');

                                        //
                                        // EXTRACT (FROM SYSTEM SETTINGS) THE MAXIMUM NUMBER OF ASSETS TO REPORT UPON.
                                        $tmp_max_asset = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');

                                        if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP_CACHE_REPORT']['rrs_map_report'][$tmp_salt_ugc])){

                                            $tmp_cnt = count($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP_CACHE_REPORT']['rrs_map_report'][$tmp_salt_ugc]);

                                        }

                                        //
                                        // IF WITHIN REPORTING LIMITS FOR MAX NUMBER OF ASSETS TO REPORT.
                                        if($tmp_cnt < ((int) $tmp_max_asset - 1)){

                                            $mem_report_queue = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');
                                            $mem_reports_ARRAY = $this->oCRNRSTN->mem_report($mem_report_queue, 'HTML', 10, true);

                                            //
                                            // WRITE CRNRSTN :: PLAID REPORTING TO SESSION.
                                            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP_CACHE_REPORT']['rrs_map_report'][$tmp_salt_ugc]['mem_report'][] = $mem_reports_ARRAY;

                                        }

                                        return $tmp_return;

                                    }

                                break;
                                default:
                                    // NOTHING TO DO.
                                    error_log(__LINE__ . ' rrs map MISSING SWITCH CASE [' . self::$request_fulfillment_driver_ARRAY[$this->oCRNRSTN->request_id][$tmp_salt_ugc] . '].');
                                break;

                            }

                        }

                        error_log(__LINE__ . ' rrs map HUH??? die();');
                        die();

                    break;
                    case 'return_image_html_wrapped_image_base64':

                        //
                        // $output_method = 'return_image_html_wrapped'
                        // $param0 = $image_html
                        // $param1 = $base64_filepath
                        // $param2 = $height
                        // $param3 = $alt
                        // $param4 = $title
                        // $param5 = $link
                        // $param6 = $target
                        // $param7 = $asset_family
                        // $param8 = $output_mode
                        // $param9 = $asset_mapping_mode
                        // $param10 = $image_string

                        // return $image_string;
                        // return $this->oCRNRSTN->return_image_html_wrapped($tmp_filename, $tmp_width, $tmp_height, $tmp_alt, $tmp_title, $tmp_link, $tmp_target, $tmp_asset_family, $tmp_output_mode, $asset_mapping_mode);

                        error_log(__LINE__ . ' rrs map [' . $tmp_output_method . '] CACHE ACCELERATION...TIME TO DO THIS. die();');
                        die();

                    break;
                    case 'return_image_html_wrapped':

                        //
                        // $output_method = 'return_image_html_wrapped'
                        // $param0 = $filename
                        // $param1 = $width
                        // $param2 = $height
                        // $param3 = $alt
                        // $param4 = $title
                        // $param5 = $link
                        // $param6 = $target
                        // $param7 = $asset_family
                        // $param8 = $output_mode
                        // $param9 = $asset_mapping_mode
                        // $param10 = $image_string
                        // return $this->oCRNRSTN->return_image_html_wrapped($tmp_filename, $tmp_width, $tmp_height, $tmp_alt, $tmp_title, $tmp_link, $tmp_target, $tmp_asset_family, $tmp_output_mode, $asset_mapping_mode, CRNRSTN_CHANNEL_SESSION);

                        error_log(__LINE__ . ' rrs map [' . $tmp_output_method . '] CACHE ACCELERATION...TIME TO DO THIS. die();');
                        die();

                    break;
                    case 'return_js_css_string_output':

                        //
                        // $output_method = 'return_js_css_string_output'
                        // $param0 = $js_integer_constant
                        // $param1 = $css_integer_constant
                        // $param2 = $footer_html_output[boolean]
                        // $param3 = $is_dev_mode[boolean]
                        // return $this->oCRNRSTN->return_js_css_string_output($js_integer_constant, $css_integer_constant, $footer_html_output, $is_dev_mode, CRNRSTN_CHANNEL_SESSION);

                        error_log(__LINE__ . ' rrs map [' . $tmp_output_method . '] CACHE ACCELERATION...TIME TO DO THIS. die();');
                        die();

                    break;
                    case 'return_css_string_output':
                        //
                        // $output_method = 'return_file_string_output'
                        // $param0 = $const
                        // $param1 = $footer_html_output[boolean]
                        // $param2 = $is_dev_mode[boolean]
                        // return $this->oCRNRSTN->return_css_string_output($const, $footer_html_output, $is_dev_mode, CRNRSTN_CHANNEL_SESSION);

                        error_log(__LINE__ . ' rrs map [' . $tmp_output_method . '] CACHE ACCELERATION...TIME TO DO THIS. die();');
                        die();

                    break;
                    case 'return_js_string_output':

                        //
                        // $output_method = 'return_file_string_output'
                        // $param0 = $const
                        // $param1 = $footer_html_output[boolean]
                        // $param2 = $is_dev_mode[boolean]
                        // return $this->oCRNRSTN->return_js_string_output($const, $footer_html_output, $is_dev_mode, CRNRSTN_CHANNEL_SESSION);

                        error_log(__LINE__ . ' rrs map [' . $tmp_output_method . '] CACHE ACCELERATION...TIME TO DO THIS. die();');
                        die();

                    break;
                    case 'return_asset_data':

                        //
                        // $output_method = 'return_asset_data'
                        // $param0 = $asset_meta_key
                        // $param1 = $salt_ugc
                        // $param2 = $request_family
                        // $param3 = $asset_meta_path

                        if(isset(self::$request_fulfillment_driver_ARRAY[$this->oCRNRSTN->request_id][$tmp_salt_ugc])){

                            switch(self::$request_fulfillment_driver_ARRAY[$this->oCRNRSTN->request_id][$tmp_salt_ugc]){
                                case CRNRSTN_CHANNEL_SESSION:
                                    error_log(__LINE__ . ' rrs map TODO :: HOOK UP THIS SESSION CASE STATEMENT.');
                                break;
                                case CRNRSTN_CHANNEL_RUNTIME:

                                    error_log(__LINE__ . ' rrs map TODO :: TESTING THIS RUNTIME CASE STATEMENT.');

                                    if(isset(self::$request_asset_meta_path_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_salt_ugc]])){

                                        $tmp_response_map_asset_meta_key = self::$request_asset_meta_key_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_salt_ugc]];
                                        $tmp_response_map_request_ugc_value = $tmp_salt_ugc;
                                        $asset_family = self::$request_family_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_salt_ugc]];
                                        $tmp_response_map_asset_meta_path = self::$request_asset_meta_path_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_salt_ugc]];
                                        $tmp_raw_output_mode = self::$cache_rrs_map_raw_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_salt_ugc]];

                                        //
                                        // CACHE TTL CHECK.
                                        $tmp_max_time = self::$session_map_cache_ttl + (int) self::$cache_lastmodified_ARRAY[self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_salt_ugc]];
                                        $tmp_time = time();
                                        if(($tmp_time > $tmp_max_time) && ($tmp_max_time > (int) self::$cache_lastmodified_ARRAY[self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$tmp_salt_ugc]])){

                                            error_log(__LINE__ . ' rrs map TTL EXPIRE CACHE FOR $tmp_salt_ugc[' . $tmp_salt_ugc . ']. $tmp_raw_output_mode[' . $tmp_raw_output_mode . ']. die();');
                                            die();
                                            return '';

                                        }

                                        error_log(__LINE__ . ' rrs map Application Acceleration [runtime] FIRE. RRS Map resource return. $asset_family[' . $asset_family . ']. $tmp_response_map_request_ugc_value[' . $tmp_response_map_request_ugc_value . ']. $tmp_response_map_asset_meta_key[' . $tmp_response_map_asset_meta_key . ']. $tmp_response_map_asset_meta_path[' . $tmp_response_map_asset_meta_path . '].');

                                        //
                                        // EXTRACT (FROM SYSTEM SETTINGS) THE MAXIMUM NUMBER OF ASSETS TO REPORT UPON.
                                        $tmp_max_asset = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');
                                        $tmp_cnt = 0;
                                        if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP_CACHE_REPORT']['rrs_map_report'][$tmp_salt_ugc])){

                                            $tmp_cnt = count($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP_CACHE_REPORT']['rrs_map_report'][$tmp_salt_ugc]);

                                        }

                                        //
                                        // IF WITHIN REPORTING LIMITS FOR MAX NUMBER OF ASSETS TO REPORT.
                                        if($tmp_cnt < ((int) $tmp_max_asset - 1)){

                                            $mem_report_queue = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');
                                            $mem_reports_ARRAY = $this->oCRNRSTN->mem_report($mem_report_queue, 'HTML', 10, true);

                                            //
                                            // WRITE CRNRSTN :: PLAID REPORTING TO SESSION.
                                            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP_CACHE_REPORT']['rrs_map_report'][$tmp_salt_ugc]['mem_report'][] = $mem_reports_ARRAY;

                                        }

                                        return $this->oCRNRSTN->return_asset_data($tmp_response_map_request_ugc_value, $asset_family, $tmp_response_map_asset_meta_key, $tmp_response_map_asset_meta_path, 'session');

                                    }

                                break;
                                default:
                                    // NOTHING TO DO.
                                    error_log(__LINE__ . ' rrs map SWITCH DEFAULT CASE[' .  self::$request_fulfillment_driver_ARRAY[$this->oCRNRSTN->request_id][$tmp_salt_ugc] . '].');

                                break;

                            }

                        }

//                        //
//                        // CACHE TTL CHECK.
//                        $tmp_max_time = self::$session_map_cache_ttl + (int) $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['lastmodified'][$tmp_cache_id];
//                        $tmp_time = time();
//                        if(($tmp_time > $tmp_max_time) && ($tmp_max_time > (int) $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['lastmodified'][$tmp_cache_id])){
//
//                            //error_log(__LINE__ . ' rrs map TTL EXPIRE CACHE FOR $tmp_salt_ugc[' . $tmp_salt_ugc . ']. $tmp_raw_output_mode[' . $tmp_raw_output_mode . '].');
//                            //die();
//                            return '';
//
//                        }
//
//                        return $this->oCRNRSTN->return_asset_data($tmp_response_map_request_ugc_value, $asset_family, $tmp_response_map_asset_meta_key, $tmp_response_map_asset_meta_path, 'session');

                    break;
                    case 'return_file_byte_chunked_buffer_output':

                        //
                        // $output_method = 'return_file_byte_chunked_buffer_output'
                        // $param0 = $filepath
                        // $param1 = $filename
                        // $param2 = $file_extension = NULL??


                        error_log(__LINE__  . ' rrs map JS/CSS OUTPUT.');
                        die();

                        if(isset(self::$request_fulfillment_driver_ARRAY[$this->oCRNRSTN->request_id][$tmp_salt_ugc])){

                            switch(self::$request_fulfillment_driver_ARRAY[$this->oCRNRSTN->request_id][$tmp_salt_ugc]){
                                case CRNRSTN_CHANNEL_SESSION:

                                    error_log(__LINE__ . ' rrs map SESSION DOES IT FOR [' . $tmp_salt_ugc . ']!');

                                break;
                                case CRNRSTN_CHANNEL_RUNTIME:

                                    error_log(__LINE__ . ' rrs map return RAW RESOURCE [' . self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]] . '].');
                                    error_log(__LINE__ . ' rrs map $cache_rrs_map_filepath_ARRAY[' . print_r(self::$cache_rrs_map_filepath_ARRAY, true) . '].');
                                    error_log(__LINE__ . ' rrs map $cache_rrs_map_filename_ARRAY[' . print_r(self::$cache_rrs_map_filename_ARRAY, true) . '].');
                                    if(isset(self::$cache_rrs_map_filepath_ARRAY[$this->oCRNRSTN->request_id][$tmp_cache_id])){

                                        $tmp_filepath = self::$cache_rrs_map_filepath_ARRAY[$this->oCRNRSTN->request_id][$tmp_cache_id];
                                        $tmp_filename = self::$cache_rrs_map_filename_ARRAY[$this->oCRNRSTN->request_id][$tmp_cache_id];
                                        $tmp_file_extension = self::$cache_rrs_map_file_extension_ARRAY[$this->oCRNRSTN->request_id][$tmp_cache_id];
                                        $tmp_raw_output_mode = self::$cache_rrs_map_raw_output_mode_ARRAY[$this->oCRNRSTN->request_id][$tmp_cache_id];

                                        //
                                        // CACHE TTL CHECK.
                                        $tmp_max_time = (int) self::$session_map_cache_ttl + (int) self::$cache_lastmodified_ARRAY[$this->oCRNRSTN->request_id][$tmp_cache_id];
                                        $tmp_time = time();
                                        if(($tmp_time > $tmp_max_time) && ($tmp_max_time > (int) self::$cache_lastmodified_ARRAY[$this->oCRNRSTN->request_id][$tmp_cache_id])){

                                            // error_log(__LINE__ . ' rrs map TTL EXPIRE CACHE FOR $tmp_salt_ugc[' . $tmp_salt_ugc . ']. $tmp_raw_output_mode[' . $tmp_raw_output_mode . '].');
                                            // die();
                                            return '';

                                        }

                                        error_log(__LINE__ . ' rrs map Application Acceleration [runtime] FIRE. RRS Map resource return. return_file_byte_chunked_buffer_output $filepath[' . $tmp_filepath . ']. $filename[' . $tmp_filename . ']. $file_extension[' . $tmp_file_extension . ']. $tmp_raw_output_mode[' . $tmp_raw_output_mode . '].');

                                        return $this->oCRNRSTN->return_file_byte_chunked_buffer_output($tmp_filepath, $tmp_filename, $tmp_file_extension, $tmp_raw_output_mode, 'session');

                                    }

                                break;
                                default:
                                    // NOTHING TO DO.

                                    error_log(__LINE__ . ' rrs map [' . self::$request_fulfillment_driver_ARRAY[$this->oCRNRSTN->request_id][$tmp_salt_ugc] . '].');

                                break;

                            }

                        }

                        error_log(__LINE__ . ' rrs map HUH??? die();');
                        die();

                    break;
                    default:

                        $this->oCRNRSTN->error_log('Unknown resource cache return method [' . $tmp_output_method . '] provided. Bypassing response return serialization (rrs) map cache acceleration.');
                        //error_log(__LINE__ . ' crnrstn Unknown resource cache return method [' . $tmp_output_method . '] provided. Bypassing response return serialization (rrs) map cache acceleration.');

                    break;

                }

            break;
            case 'session_cache_accelerated_return':

                switch($tmp_output_method){
                    case 'return_file_http_string':

                        if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['output_mode'][$tmp_cache_id])){

                            $output_mode = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['output_mode'][$tmp_cache_id];

                        }else{

                            //
                            // USE RAW (RESOURCE DEFAULT) OUTPUT MODE AS PRIMARY MODE IF NONE PROVIDED.
                            if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['output_mode'][$tmp_cache_id])){

                                $output_mode = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['output_mode'][$tmp_cache_id];

                            }

                        }

                        if(!isset($output_mode)){

                            //
                            // ABORT RESOURCE RETURN ACCELERATION ATTEMPT DUE TO INCOMPLETE RRS MAP PROFILE.
                            return '';

                        }

                        //
                        // http://172.16.225.139/lightsaber.crnrstn.evifweb.com/?crnrstn_0010111011=crnrstn_logo_lg
                        // EXECUTE EARLIEST OUTPUT OF MAPPED CACHE RETURN HERE.
                        // RESOURCE CACHE INITIALIZATION CHECK.
                        //
                        // SETTING THIS ON MATCH OF SESSION MANAGED RESOURCE.
                        if(isset(self::$request_fulfillment_driver_ARRAY[$this->oCRNRSTN->request_id][$tmp_salt_ugc])){

                            switch(self::$request_fulfillment_driver_ARRAY[$this->oCRNRSTN->request_id][$tmp_salt_ugc]){
                                case CRNRSTN_CHANNEL_SESSION:

                                    if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['url'][$tmp_salt_ugc])){

                                        //
                                        // RESPONSE RETURN APPLICATION ACCELERATION.
                                        $img_string = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['url'][$tmp_salt_ugc];
                                        $tmp_return = $this->oCRNRSTN->return_file_http_string($img_string);
                                        error_log(__LINE__ . ' rrs map Application Acceleration [session] FIRE. RRS Map resource return. $tmp_return[' . $tmp_return . '].');

                                        //
                                        // EXTRACT (FROM SYSTEM SETTINGS) THE MAXIMUM NUMBER OF ASSETS TO REPORT UPON.
                                        $tmp_max_asset = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');
                                        $tmp_cnt = 0;
                                        if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP_CACHE_REPORT']['rrs_map_report'][$tmp_salt_ugc])){

                                            $tmp_cnt = count($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP_CACHE_REPORT']['rrs_map_report'][$tmp_salt_ugc]);

                                        }

                                        //
                                        // IF WITHIN REPORTING LIMITS FOR MAX NUMBER OF ASSETS TO REPORT.
                                        if($tmp_cnt < ((int) $tmp_max_asset - 1)){

                                            $mem_report_queue = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');
                                            $mem_reports_ARRAY = $this->oCRNRSTN->mem_report($mem_report_queue, 'HTML', 10, true);

                                            //
                                            // WRITE CRNRSTN :: PLAID REPORTING TO SESSION.
                                            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP_CACHE_REPORT']['rrs_map_report'][$tmp_salt_ugc]['mem_report'][] = $mem_reports_ARRAY;

                                        }

                                        return $tmp_return;

                                    }

                                break;
                                default:
                                    // NOTHING TO DO.
                                    error_log(__LINE__ . ' rrs map DEFAULT [' . self::$request_fulfillment_driver_ARRAY[$this->oCRNRSTN->request_id][$tmp_salt_ugc] . '] NOTHING TO DO? die();');

                                break;
                            }

                        }

                        error_log(__LINE__ . ' rrs map HUH??? die();');
                        die();

                    break;
                    case 'return_image_html_wrapped_image_base64':

                        //
                        // $output_method = 'return_image_html_wrapped'
                        // $param0 = $image_html
                        // $param1 = $base64_filepath
                        // $param2 = $height
                        // $param3 = $alt
                        // $param4 = $title
                        // $param5 = $link
                        // $param6 = $target
                        // $param7 = $asset_family
                        // $param8 = $output_mode
                        // $param9 = $asset_mapping_mode
                        // $param10 = $image_string

                        // return $image_string;
                        // return $this->oCRNRSTN->return_image_html_wrapped($tmp_filename, $tmp_width, $tmp_height, $tmp_alt, $tmp_title, $tmp_link, $tmp_target, $tmp_asset_family, $tmp_output_mode, $asset_mapping_mode);

                        error_log(__LINE__ . ' rrs map [' . $tmp_output_method . '] CACHE ACCELERATION...TIME TO DO THIS. die();');
                        die();

                    break;
                    case 'return_image_html_wrapped':

                        //
                        // $output_method = 'return_image_html_wrapped'
                        // $param0 = $filename
                        // $param1 = $width
                        // $param2 = $height
                        // $param3 = $alt
                        // $param4 = $title
                        // $param5 = $link
                        // $param6 = $target
                        // $param7 = $asset_family
                        // $param8 = $output_mode
                        // $param9 = $asset_mapping_mode
                        // $param10 = $image_string
                        // return $this->oCRNRSTN->return_image_html_wrapped($tmp_filename, $tmp_width, $tmp_height, $tmp_alt, $tmp_title, $tmp_link, $tmp_target, $tmp_asset_family, $tmp_output_mode, $asset_mapping_mode, CRNRSTN_CHANNEL_SESSION);

                        error_log(__LINE__ . ' rrs map [' . $tmp_output_method . '] CACHE ACCELERATION...TIME TO DO THIS. die();');
                        die();

                    break;
                    case 'return_js_css_string_output':

                        //
                        // $output_method = 'return_js_css_string_output'
                        // $param0 = $js_integer_constant
                        // $param1 = $css_integer_constant
                        // $param2 = $footer_html_output[boolean]
                        // $param3 = $is_dev_mode[boolean]
                        // return $this->oCRNRSTN->return_js_css_string_output($js_integer_constant, $css_integer_constant, $footer_html_output, $is_dev_mode, CRNRSTN_CHANNEL_SESSION);

                        error_log(__LINE__ . ' rrs map [' . $tmp_output_method . '] CACHE ACCELERATION...TIME TO DO THIS. die();');
                        die();

                    break;
                    case 'return_css_string_output':
                        //
                        // $output_method = 'return_file_string_output'
                        // $param0 = $const
                        // $param1 = $footer_html_output[boolean]
                        // $param2 = $is_dev_mode[boolean]
                        // return $this->oCRNRSTN->return_css_string_output($const, $footer_html_output, $is_dev_mode, CRNRSTN_CHANNEL_SESSION);

                        error_log(__LINE__ . ' rrs map [' . $tmp_output_method . '] CACHE ACCELERATION...TIME TO DO THIS. die();');
                        die();

                    break;
                    case 'return_js_string_output':

                        //
                        // $output_method = 'return_file_string_output'
                        // $param0 = $const
                        // $param1 = $footer_html_output[boolean]
                        // $param2 = $is_dev_mode[boolean]
                        // return $this->oCRNRSTN->return_js_string_output($const, $footer_html_output, $is_dev_mode, CRNRSTN_CHANNEL_SESSION);

                        error_log(__LINE__ . ' rrs map [' . $tmp_output_method . '] CACHE ACCELERATION...TIME TO DO THIS. die();');
                        die();

                    break;
                    case 'return_asset_data':

                        //
                        // $output_method = 'return_asset_data'
                        // $param0 = $asset_meta_key
                        // $param1 = $salt_ugc
                        // $param2 = $request_family
                        // $param3 = $asset_meta_path

                        error_log(__LINE__ . ' rrs map TODO :: HOOK UP THIS SESSION CASE STATEMENT. WHAT\'CHA DOIN\' HERE? 1/3');

                        if(isset(self::$request_fulfillment_driver_ARRAY[$this->oCRNRSTN->request_id][$tmp_salt_ugc])){

                            error_log(__LINE__ . ' rrs map TODO :: HOOK UP THIS SESSION CASE STATEMENT. WHAT\'CHA DOIN\' HERE? 2/3');

                            switch(self::$request_fulfillment_driver_ARRAY[$this->oCRNRSTN->request_id][$tmp_salt_ugc]){
                                case CRNRSTN_CHANNEL_SESSION:

                                    error_log(__LINE__ . ' rrs map TODO :: HOOK UP THIS SESSION CASE STATEMENT. WHAT\'CHA DOIN\' HERE? 3/3');
                                    if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['meta_path'][$tmp_cache_id])){

                                        $tmp_response_map_asset_meta_key = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['asset_meta_key'][$tmp_cache_id];
                                        $tmp_response_map_request_ugc_value = $tmp_salt_ugc;
                                        $asset_family = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['asset_family'][$tmp_cache_id];
                                        $tmp_response_map_asset_meta_path = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['meta_path'][$tmp_cache_id];
                                        $tmp_raw_output_mode = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['raw_output_mode'][$tmp_cache_id];

                                        //
                                        // CACHE TTL CHECK.
                                        $tmp_max_time = self::$session_map_cache_ttl + (int) $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['lastmodified'][$tmp_cache_id];
                                        $tmp_time = time();
                                        if(($tmp_time > $tmp_max_time) && ($tmp_max_time > (int) $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['lastmodified'][$tmp_cache_id])){

                                            //error_log(__LINE__ . ' rrs map TTL EXPIRE CACHE FOR $tmp_salt_ugc[' . $tmp_salt_ugc . ']. $tmp_raw_output_mode[' . $tmp_raw_output_mode . '].');
                                            //die();
                                            return '';

                                        }

                                        error_log(__LINE__ . ' rrs map Application Acceleration FIRE. RRS Map resource return. $asset_family[' . $asset_family . ']. $tmp_response_map_request_ugc_value[' . $tmp_response_map_request_ugc_value . ']. $tmp_response_map_asset_meta_key[' . $tmp_response_map_asset_meta_key . ']. $tmp_response_map_asset_meta_path[' . $tmp_response_map_asset_meta_path . '].');

                                        //
                                        // EXTRACT (FROM SYSTEM SETTINGS) THE MAXIMUM NUMBER OF ASSETS TO REPORT UPON.
                                        $tmp_max_asset = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');
                                        $tmp_cnt = 0;
                                        if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP_CACHE_REPORT']['rrs_map_report'][$tmp_salt_ugc])){

                                            $tmp_cnt = count($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP_CACHE_REPORT']['rrs_map_report'][$tmp_salt_ugc]);

                                        }

                                        //
                                        // IF WITHIN REPORTING LIMITS FOR MAX NUMBER OF ASSETS TO REPORT.
                                        if($tmp_cnt < ((int) $tmp_max_asset - 1)){

                                            $mem_report_queue = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');
                                            $mem_reports_ARRAY = $this->oCRNRSTN->mem_report($mem_report_queue, 'HTML', 10, true);

                                            //
                                            // WRITE CRNRSTN :: PLAID REPORTING TO SESSION.
                                            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP_CACHE_REPORT']['rrs_map_report'][$tmp_salt_ugc]['mem_report'][] = $mem_reports_ARRAY;

                                        }

                                        return $this->oCRNRSTN->return_asset_data($tmp_response_map_request_ugc_value, $asset_family, $tmp_response_map_asset_meta_key, $tmp_response_map_asset_meta_path, 'session');

                                    }

                                    return '';

                                break;
                                default:
                                    // NOTHING TO DO.
                                break;
                            }

                        }

                        error_log(__LINE__ . ' rrs map HUH??? die();');
                        die();

                    break;
                    case 'return_file_byte_chunked_buffer_output':

                        error_log(__LINE__ . ' rrs map HUH??? die();');
                        die();

                        //
                        // $output_method = 'return_file_byte_chunked_buffer_output'
                        // $param0 = $filepath
                        // $param1 = $filename
                        // $param2 = $file_extension = NULL??

                        if(isset(self::$request_fulfillment_driver_ARRAY[$this->oCRNRSTN->request_id][$tmp_salt_ugc])){

                            switch(self::$request_fulfillment_driver_ARRAY[$this->oCRNRSTN->request_id][$tmp_salt_ugc]){
                                case CRNRSTN_CHANNEL_SESSION:

                                    $tmp_filepath = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['rrs_map_filepath'][$tmp_cache_id];
                                    $tmp_filename = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['rrs_map_filename'][$tmp_cache_id];
                                    $tmp_file_extension = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['rrs_map_file_extension'][$tmp_cache_id];
                                    $tmp_raw_output_mode = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['raw_output_mode'][$tmp_cache_id];

                                    //
                                    // CACHE TTL CHECK.
                                    $tmp_max_time = self::$session_map_cache_ttl + (int) $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['lastmodified'][$tmp_cache_id];
                                    $tmp_time = time();
                                    if(($tmp_time > $tmp_max_time) && ($tmp_max_time > (int) $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['lastmodified'][$tmp_cache_id])){

                                        //error_log(__LINE__ . ' rrs map TTL EXPIRE CACHE FOR $tmp_salt_ugc[' . $tmp_salt_ugc . ']. $tmp_raw_output_mode[' . $tmp_raw_output_mode . '].');
                                        //die();
                                        return '';

                                    }

                                    error_log(__LINE__ . ' rrs map Application Acceleration [session] FIRE. RRS Map resource return. return_file_byte_chunked_buffer_output $filepath[' . $tmp_filepath . ']. $filename[' . $tmp_filename . ']. $file_extension[' . $tmp_file_extension . ']. $tmp_raw_output_mode[' . $tmp_raw_output_mode . '].');


                                    //$tmp_ugc = $this->oCRNRSTN->oCRNRSTN_RRS_MAP->get_cache('filename', 'session');

                                    //
                                    // EXTRACT (FROM SYSTEM SETTINGS) THE MAXIMUM NUMBER OF ASSETS TO REPORT UPON.
                                    $tmp_max_asset = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');
                                    $tmp_cnt = 0;
                                    if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP_CACHE_REPORT']['rrs_map_report'][$tmp_ugc])){

                                        $tmp_cnt = count($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP_CACHE_REPORT']['rrs_map_report'][$tmp_ugc]);

                                    }

                                    //
                                    // IF WITHIN REPORTING LIMITS FOR MAX NUMBER OF ASSETS TO REPORT.
                                    if($tmp_cnt < ((int) $tmp_max_asset - 1)){

                                        $mem_report_queue = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');
                                        $mem_reports_ARRAY = $this->oCRNRSTN->mem_report($mem_report_queue, 'HTML', 10, true);

                                        //
                                        // WRITE CRNRSTN :: PLAID REPORTING TO SESSION.
                                        $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP_CACHE_REPORT']['rrs_map_report'][$tmp_ugc]['mem_report'][] = $mem_reports_ARRAY;

                                    }

                                    return $this->oCRNRSTN->return_file_byte_chunked_buffer_output($tmp_filepath, $tmp_filename, $tmp_file_extension, $tmp_raw_output_mode, 'session');

                                break;
                                default:
                                    // NOTHING TO DO.
                                break;

                            }

                        }

                        error_log(__LINE__ . ' rrs map HUH??? die();');
                        die();

                    break;
                    default:

                        $this->oCRNRSTN->error_log('Unknown resource cache return method [' . $tmp_output_method . '] provided. Bypassing response return serialization (rrs) map cache acceleration.');
                        //error_log(__LINE__ . ' crnrstn Unknown resource cache return method [' . $tmp_output_method . '] provided. Bypassing response return serialization (rrs) map cache acceleration.');

                    break;

                }

            break;
            default:

                error_log(__LINE__ . ' RRS MAP ACCELERATION NOT YET IMPLEMENTED FOR [' . $name . '].');
                return '';

            break;

        }

    }

    public function return_response_map_asset_meta_path($salt_ugc_val = NULL, $channel = CRNRSTN_CHANNEL_RUNTIME){

        switch($channel){
            case CRNRSTN_CHANNEL_SESSION:

                error_log(__LINE__ . ' rrs map $channel[' . $channel . '] asset_meta_path_ARRAY[' . print_r($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['meta_path'], true) . '].');

                if(!isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['meta_path'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$salt_ugc_val]])){

                    return '';

                }

                return self::$request_asset_meta_path_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]];

            break;
            case CRNRSTN_CHANNEL_RUNTIME:
            default:

                error_log(__LINE__ . ' rrs map $channel asset_meta_path_ARRAY[' . print_r(self::$request_asset_meta_path_ARRAY, true) . '].');

                if(isset($this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial])){

                    if(isset(self::$request_asset_meta_path_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]])){

                        return self::$request_asset_meta_path_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]];

                    }

                }

            break;

        }

        return '';

    }

    public function return_response_map_asset_meta_key(){

        if(isset($this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial])){

            if(!isset(self::$request_asset_meta_key_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]])){

                return '';

            }

            return self::$request_asset_meta_key_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]];

        }

        return '';

    }

    public function return_response_map_ugc_value($data_override = NULL, $raw_output_mode = NULL, $output_mode = NULL){
        // $data_override = [filename] ...or even a map key.

        $tmp_init_map = false;

        if(isset($this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial])){

            if(!isset(self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]])){

                error_log(__LINE__ . ' rrs map MUST INITIALIZE RRS MAP.');
                $tmp_init_map = true;

            }else{

                return self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]];

            }

        }else{

            if(!$this->oCRNRSTN->is_bit_set(CRNRSTN_CHANNEL_GET) == true){

                $tmp_str = $this->oCRNRSTN->rrs_map_listener($data_override, NULL, $raw_output_mode, $output_mode);
                error_log(__LINE__ . ' rrs map METHOD DRIVEN INITIALIZATION. RRS MAP LISTENER RESPONSE[' . $tmp_str . ']. $data_override[' . $data_override . ']. $raw_output_mode[' . $raw_output_mode . ']. $output_mode[' . $output_mode . '].');

                //return '';

            }else{

                $tmp_init_map = true;

            }

        }

        if(!($tmp_init_map == true)){

            if(isset($data_override)){

                switch($data_override){
                    case CRNRSTN_JS:
                    case CRNRSTN_CSS:
                        //
                        // SILENCE IS GOLDEN.

                    break;
                    default:

                        if(strlen($data_override) > 0){

                            if($data_override !== self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]){

                                error_log(__LINE__ . ' rrs map MUST INITIALIZE OLD[' . self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]] . '] RRS MAP WITH [' . $data_override . '].');
                                $tmp_init_map = true;

                            }

                        }

                    break;

                }

            }

        }

        if($tmp_init_map == true){

            if(isset($data_override)){

                //self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial] = $data_override;

                //
                // FIRE RRS MAP LISTENER INITIALIZATION WITH OVERRIDE DATA.
                //$this->oCRNRSTN->initialize_request($data_override);

                //$data_override = NULL, $raw_output_mode = NULL, $output_mode
                error_log(__LINE__ . ' rrs map CALLING rrs_map_listener() $data_override[' . $data_override . ']. $raw_output_mode[' . $raw_output_mode . ']. $output_mode[' . $output_mode . '].');

                //
                // CRNRSTN :: RESPONSE RETURN SERIALIZATION MAP.
                //    public function rrs_map_listener($salt_ugc_override = NULL, $serial_profile_ARRAY = NULL, $raw_output_mode = NULL, $output_mode = NULL){
                return $this->oCRNRSTN->rrs_map_listener($data_override, NULL, $raw_output_mode, $output_mode);

                //
                // RETURN INITIALIZED VALUE.
                //return $this->oCRNRSTN->return_response_map_ugc_value();

            }

            error_log(__LINE__ . ' rrs map NOTHING $data_override[' . $data_override . ']. $raw_output_mode[' . $raw_output_mode . ']. $output_mode[' . $output_mode . '].');

            return '';

        }

        //return self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial];

    }

    public function return_crnrstn_asset_family($channel = CRNRSTN_CHANNEL_RUNTIME){

        //
        // TODO :: PUT CRNRSTN :: PLAID ($_GET) ONTO GET CHANNEL.
        // THIS HONORS PSSDTLA (XHR + XML) RESOURCES INCLUDING PAGES & DOCUMENTATION.
        switch($channel){
            case CRNRSTN_CHANNEL_SESSION:

                $tmp_cache_id = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$this->get_salt_ugc()];
                if(!isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['asset_family'][$tmp_cache_id])){

                    return '';

                }

                return $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['asset_family'][$tmp_cache_id];

            break;
            case CRNRSTN_CHANNEL_RUNTIME:
            default:

                if(isset($this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial])){

                    if(!isset(self::$request_family_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]])){

                        return '';

                    }

                    return self::$request_family_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]];

                }

            break;

        }

        return '';

    }

    public function isset_cache($attribute, $channel = CRNRSTN_CHANNEL_RUNTIME, $salt_ugc = NULL){

        //
        // HEADER ATTRIBUTE CACHE DATA STRUCTURE DIFFER FROM THE STRUCTURE OF THE PAYLOAD.
        if($attribute == 'cache_id' || $attribute == 'ipaddress_id'){

            if(isset($salt_ugc)){

                if(isset($channel)){

                    switch($channel){
                        case CRNRSTN_CHANNEL_SESSION:

                            // $attribute == 'cache_id'
                            // CHECK SESSION.
                            if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'][$attribute][$salt_ugc])){

                                return true;

                            }

                        break;
                        case CRNRSTN_CHANNEL_RUNTIME:

                            //
                            // CHECK RUNTIME.
                            if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][$salt_ugc])){

                                return true;

                            }

                        break;
                        default:

                            error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                        break;

                    }

                }else{

                    //
                    // CHECK RUNTIME AND SESSION.
                    if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][$salt_ugc]) || (isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'][$attribute][$salt_ugc]))){

                        return true;

                    }

                }

            }

            return false;

        }

        if(isset($channel)){

            switch($channel){
                case CRNRSTN_CHANNEL_SESSION:

                    //
                    // CHECK SESSION.
                    if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'][$attribute][$this->oCRNRSTN->get_cache('cache_id', $salt_ugc, $channel)])){

                        return true;

                    }

                break;
                case CRNRSTN_CHANNEL_RUNTIME:

                    //
                    // CHECK RUNTIME.
                    if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][$this->oCRNRSTN->get_cache('cache_id', $salt_ugc, $channel)])){

                        return true;

                    }

                break;
                default:

                    error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                break;

            }

        }else{

            //
            // CHECK RUNTIME AND SESSION.
            if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][$this->oCRNRSTN->get_cache('cache_id', $salt_ugc, 'runtime')]) || (isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'][$attribute][$this->oCRNRSTN->get_cache('cache_id', $salt_ugc, 'session')]))){

                return true;

            }

        }

        return false;

    }

    public function get_salt_ugc($salt_ugc_override = NULL){

        if(isset($salt_ugc_override)){

            if(strlen($salt_ugc_override) > 0){

                return $salt_ugc_override;

            }

        }

        if(isset($this->ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial])){

            return $this->ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial];

        }

        //$tmp_cache_id = self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][];
        $tmp_cache_id = $this->get_cache('cache_id');

        if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['filename'][$tmp_cache_id])){

            return self::$cache_ARRAY[$this->oCRNRSTN->request_id]['filename'][$tmp_cache_id];

        }

        return '';

    }

    private function ipaddress_id($method, $channel = CRNRSTN_CHANNEL_RUNTIME, $ip = NULL){

        try{

            $DATA_ARCHITECTURE = 'RRS_MAP';

            if($method == 'init_config_cache_index_mem_header'){

                $DATA_ARCHITECTURE = 'DDO';

            }

            if(!isset($ip)){

                $ip = $this->oCRNRSTN->client_ip();

            }

            switch($channel){
                case CRNRSTN_CHANNEL_SESSION:
                    //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

                    $tmp_cache_id_init = false;
                    $tmp_ipaddress_id_init = false;
                    $tmp_session_cache_id_success = false;
                    $tmp_session_ipaddress_id_success = false;
                    $tmp_resource_id_active_ARRAY = -1;

                    //
                    // IPADDRESS_ID :: IP ADDRESS KEY WITHIN MEMORY.
                    if(!isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()][$DATA_ARCHITECTURE]['ipaddress_id'][$ip])){

                        $tmp_resource_id_active_ARRAY = array();
                        $tmp_resource_id_active_ARRAY[-1] = 1;

                        if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()][$DATA_ARCHITECTURE]['ipaddress_id'])){

                            foreach($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()][$DATA_ARCHITECTURE]['ipaddress_id'] as $ip => $res_id){

                                //
                                // FLAG CURRENT "GAPPY TOOTH SMILE" RESOURCE IDS.
                                $tmp_resource_id_active_ARRAY[$res_id] = 1;

                            }

                        }

                        //
                        // FIND FIRST AVAILABLE MEMORY LOCATION FOR IP ADDRESS, AND USE IT.
                        // PLZ READ AS, "FIND FIRST GAP IN TEETH."
                        for($i = 0; $i < PHP_INT_MAX; $i++){

                            if(!isset($tmp_resource_id_active_ARRAY[$i])){

                                // $_SESSIN['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()][$DATA_ARCHITECTURE]['ipaddress_id'][$ip] = $i;
                                return $i;

                                break;

                            }

                        }

                    }

                    //
                    // RETURN IPADDRESS_ID FOR EXISTING RESOURCE.
                    return $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()][$DATA_ARCHITECTURE]['ipaddress_id'][$ip];

                break;
                case CRNRSTN_CHANNEL_RUNTIME:
                    //R :: RUNTIME.
                case CRNRSTN_CHANNEL_POST:
                    //P :: HTTP $_POST REQUEST.
                case CRNRSTN_CHANNEL_GET:
                    //G :: HTTP $_GET REQUEST.
                case CRNRSTN_CHANNEL_SOAP:
                    //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                case CRNRSTN_CHANNEL_DATABASE:
                    //D :: DATABASE (MySQLi CONNECTION).
                case CRNRSTN_CHANNEL_COOKIE:
                    //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
                case CRNRSTN_CHANNEL_PSSDTLA:
                    //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                case CRNRSTN_CHANNEL_SSDTLA:
                    //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).

                    //
                    // IPADDRESS_ID INITIALIZATION CHECK :: PRIMARY RESOURCE KEY WITHIN MEMORY.
                    // IF IT EXISTS, RETURN IPADDRESS_ID.
                    if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['ipaddress_id'][$ip])){

                        return self::$cache_ARRAY[$this->oCRNRSTN->request_id]['ipaddress_id'][$ip];

                    }

                    //
                    // INITIALIZE RESOURCE TYPE AND CHANNEL FOR RESOURCE ID.
                    if(!isset(self::$channel_resource_id_ARRAY['ipaddress_id'][$channel])){

                        self::$channel_resource_id_ARRAY['ipaddress_id'][$channel] = -1;

                    }

                    if(self::$runtime_php_max_int_exceeded == false){

                        //
                        // THIS IS A NEW IP.
                        self::$channel_resource_id_ARRAY['ipaddress_id'][$channel]++;

                    }

                    //
                    // IF MAX INTEGER SIZE UPPER BOUND IS EXCEEDED IN COUNT
                    // OF IP ADDRESSES...(OVER 1 BILLION IP ADDRESSES) AND
                    // WE STILL NEED MORE.
                    // I THINK WE NEED A DATA STRUCTURE CHANGE HERE IF THIS
                    // IS TO ACTUALLY WORK WITH +1 BILLION ITEMS...DUE TO
                    // INTERNAL COUNTERS ALSO EXCEEDING MAXIMUMS...IMHO.
                    if((self::$channel_resource_id_ARRAY['ipaddress_id'][$channel] >= (PHP_INT_MAX - 1)) || (self::$runtime_php_max_int_exceeded == true)){

                        self::$runtime_php_max_int_exceeded = true;
                        $tmp_resource_id_active_ARRAY = $this->oCRNRSTN->get_resource('runtime_ipaddress_id_ARRAY', 0, 'CRNRSTN::RESOURCE::MULTI-CHANNEL');

                        if(!is_array($tmp_resource_id_active_ARRAY)){

                            $tmp_resource_id_active_ARRAY = array();
                            $tmp_resource_id_active_ARRAY[-1] = 1;

                        }

                        //
                        // GENERATE NEW IP ADDRESS ID.
                        self::$channel_resource_id_ARRAY['ipaddress_id'][$channel] = $this->oCRNRSTN->generate_new_key(64);

                        //
                        // ONE TO THREE QUICK COLLISION CHECKS.
                        if(isset($tmp_resource_id_active_ARRAY[self::$channel_resource_id_ARRAY['ipaddress_id'][$channel]])){

                            //
                            // GENERATE NEW IP ADDRESS ID.
                            self::$channel_resource_id_ARRAY['ipaddress_id'][$channel] = $this->oCRNRSTN->generate_new_key(64);
                            if(isset($tmp_resource_id_active_ARRAY[self::$channel_resource_id_ARRAY['ipaddress_id'][$channel]])){

                                //
                                // GENERATE NEW IP ADDRESS ID. LAST ATTEMPT TO AVOID COLLISION.
                                self::$channel_resource_id_ARRAY['ipaddress_id'][$channel] = $this->oCRNRSTN->generate_new_key(64);
                                if(isset($tmp_resource_id_active_ARRAY[self::$channel_resource_id_ARRAY['ipaddress_id'][$channel]])){

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    throw new Exception('Unable to store new data in RUNTIME due to too many ipaddress_id collisions.');

                                }

                            }

                        }

                        //
                        // THIS IS ONLY FOR +1 BILLION ITEMS IN MEMORY (> PHP_INT_MAX). MOVE ALONG.
                        $tmp_resource_id_active_ARRAY[self::$channel_resource_id_ARRAY['ipaddress_id'][$channel]] = 1;
                        $this->oCRNRSTN->input_data_value($tmp_resource_id_active_ARRAY, 'runtime_ipaddress_id_ARRAY', 'CRNRSTN::RESOURCE::MULTI-CHANNEL');

                    }

                    //
                    // SHOULD BE GOOD ENOUGH TO DO THE JOB.
                    return self::$channel_resource_id_ARRAY['ipaddress_id'][$channel];

                break;
                default:

                    error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                break;

            }

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

    private function cache_id($method, $channel = CRNRSTN_CHANNEL_RUNTIME, $ddo_memory_pointer = NULL){

        $DATA_ARCHITECTURE = 'RRS_MAP';

        if($method == 'init_config_cache_index_mem_header'){

            $DATA_ARCHITECTURE = 'DDO';

        }

        switch($channel){
            case CRNRSTN_CHANNEL_SESSION:
                //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

                if(!isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()][$DATA_ARCHITECTURE]['cache_id'][$ddo_memory_pointer])){

                    //
                    // CACHE_ID :: PRIMARY RESOURCE KEY WITHIN MEMORY.
                    $tmp_cache_id_init = false;
                    $tmp_session_cache_id_success = false;
                    $tmp_resource_id_active_ARRAY = -1;

                    //
                    // INITIALIZE CHANNEL CACHE ID.
                    if(isset(self::$channel_cache_id_ARRAY[$channel])){

                        $tmp_resource_id_active_ARRAY = self::$channel_cache_id_ARRAY[$channel];

                    }

                    //
                    // JUMP START MY HEART. WHERE "MY HEART" IS A CLEAN & ZERO'D SESSION CHANNEL
                    // CACHE_ID STRUCT.
                    // Mötley Crüe - Kickstart My Heart (Official Music Video)
                    // https://www.youtube.com/watch?v=CmXWkMlKFkI
                    if(!is_array($tmp_resource_id_active_ARRAY)){

                        $tmp_resource_id_active_ARRAY = array();

                        //
                        // INITIALIZE SESSION CACHE_ID MEMORY LOCATION UTILIZATION (OR 'USAGE')
                        // SUPPORT STRUCT.
                        $tmp_resource_id_active_ARRAY[-1] = 1;
                        self::$channel_cache_id_ARRAY[$channel] = $tmp_resource_id_active_ARRAY;
                        $tmp_cache_id_init = true;
                        //error_log(__LINE__ . ' rrs map NEED A NEW SESSION CACHE_ID $ddo_memory_pointer[' . $ddo_memory_pointer . ']=[' . self::$session_cache_id . '].');

                    }

                    //
                    // BUILD FLAGS OF USED CACHE ID.
                    if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'])){

                        foreach($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'] as $res_data_key => $res_id){

                            $tmp_resource_id_active_ARRAY[$res_id] = 1;

                        }

                    }

                    //
                    // FIND FIRST AVAILABLE MEMORY LOCATION FOR CACHE ID, AND USE IT.
                    if(!isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['PHP_INT_MAX_EXCEEDED_CACHE_ID'])){

                        for($i = 0; $i < PHP_INT_MAX; $i++){

                            if(!isset($tmp_resource_id_active_ARRAY[$i]) || ($tmp_cache_id_init == true)){

                                self::$channel_resource_id_ARRAY['cache_id'][$channel] = $i;
                                $tmp_session_cache_id_success = true;
                                //error_log(__LINE__ . ' rrs map A NEW SESSION CACHE_ID $ddo_memory_pointer[' . $ddo_memory_pointer . ']=[' . self::$session_cache_id . '].');

                                //
                                // INITIALIZE SESSION RESOURCE_BYTES :: CACHE DATA SIZE IN BYTES.
                                // THIS WILL ALLOW FOR AGGREGATION OF resource_bytes.
                                if(!isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['resource_bytes'][self::$channel_resource_id_ARRAY['cache_id'][$channel]])){

                                    $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['resource_bytes'][self::$channel_resource_id_ARRAY['cache_id'][$channel]] = 0;

                                    break;

                                }

                            }

                        }

                        //
                        // IF MAX INTEGER SIZE UPPER BOUND IS EXCEEDED IN COUNT
                        // OF CACHE_ID...(OVER 1 BILLION RESOURCES IN MEMORY) AND
                        // WE STILL NEED MORE UNIQUE ID RESOURCE HANDLES.
                        if($tmp_session_cache_id_success == false){

                            //
                            // SPOIL FUTURE FIRES OF THE INTEGER DISCOVERY LOOP (ABOVE).
                            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['PHP_INT_MAX_EXCEEDED_CACHE_ID'] = 1;

                            //
                            // GENERATE NEW CACHE_ID.
                            self::$channel_resource_id_ARRAY['cache_id'][$channel] = $this->oCRNRSTN->generate_new_key(64);

                            //
                            // ONE TO THREE QUICK COLLISION CHECKS.
                            if(isset($tmp_resource_id_active_ARRAY[self::$channel_resource_id_ARRAY['cache_id'][$channel]])){

                                //
                                // GENERATE NEW CACHE_ID.
                                self::$channel_resource_id_ARRAY['cache_id'][$channel] = $this->oCRNRSTN->generate_new_key(64);
                                if(isset($tmp_resource_id_active_ARRAY[self::$channel_resource_id_ARRAY['cache_id'][$channel]])){

                                    //
                                    // GENERATE NEW CACHE_ID.
                                    self::$channel_resource_id_ARRAY['cache_id'][$channel] = $this->oCRNRSTN->generate_new_key(64);
                                    if(isset($tmp_resource_id_active_ARRAY[self::$channel_resource_id_ARRAY['cache_id'][$channel]])){

                                        //
                                        // HOOOSTON...VE HAF PROBLEM!
                                        throw new Exception('Unable to store new data in SESSION due to too many cache_id collisions.');

                                    }

                                }

                            }

                            //
                            // INITIALIZE SESSION RESOURCE_BYTES :: CACHE DATA SIZE IN BYTES.
                            if(!isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['resource_bytes'][self::$channel_resource_id_ARRAY['cache_id'][$channel]])){

                                $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['resource_bytes'][self::$channel_resource_id_ARRAY['cache_id'][$channel]] = 0;

                            }

                        }

                    }

                }

                //
                // SHOULD BE GOOD ENOUGH TO DO THE JOB.
                return self::$channel_resource_id_ARRAY['cache_id'][$channel];

            break;
            case CRNRSTN_CHANNEL_RUNTIME:
                //R :: RUNTIME.

                //
                // IF IT EXISTS, RETURN CACHE_ID.
                if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer])){

                    return self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer];

                }

                //
                // DO WE NEED CHANNEL CACHE_ID INITIALIZATION?
                if(!isset(self::$channel_resource_id_ARRAY['cache_id'][$channel])){

                    //
                    // CACHE_ID INITIALIZATION CHECK :: PRIMARY RESOURCE KEY WITHIN MEMORY.
                    // GO AHEAD AND INITIALIZE IPADDRESS_ID HERE, AS WELL.
                    if(!isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer])){

                        self::$channel_resource_id_ARRAY['cache_id'][$channel] = -1;

                    }

                }

                if(self::$runtime_php_max_int_exceeded == false){

                    //
                    // SPOOL NEXT RESOURCE CACHE_ID IN PREPARATION FOR NEXT RESOURCE. SESSION MUST WAIT AND
                    // DO THIS JUST IN TIME...BECAUSE OF GAPPY SMILE. [I.E. SESSION RESOURCE CACHE_IDs
                    // WILL NOT BE A SMOOTH 1,2,3,4,5,6,7,8,9...INSTEAD....1,9,4,6,2,8,3...]
                    self::$channel_resource_id_ARRAY['cache_id'][$channel]++;

                }

                //
                // IF MAX INTEGER SIZE UPPER BOUND IS EXCEEDED IN COUNT
                // OF CACHE_ID...(OVER 1 BILLION IP ADDRESSES) AND
                // WE STILL NEED MORE.
                if(self::$channel_resource_id_ARRAY['cache_id'][$channel] >= (PHP_INT_MAX - 1) || self::$runtime_php_max_int_exceeded == true){

                    self::$runtime_php_max_int_exceeded = true;

                    $tmp_resource_id_active_ARRAY = $this->oCRNRSTN->get_resource('runtime_cache_id_ARRAY', 'CRNRSTN::RESOURCE::MULTI-CHANNEL');

                    if(!is_array($tmp_resource_id_active_ARRAY)){

                        $tmp_resource_id_active_ARRAY = array();

                    }

                    //
                    // GENERATE NEW CACHE ID.
                    self::$channel_resource_id_ARRAY['cache_id'][$channel] = $this->oCRNRSTN->generate_new_key(64);

                    //
                    // ONE TO THREE QUICK COLLISION CHECKS.
                    if(isset($tmp_resource_id_active_ARRAY[self::$channel_resource_id_ARRAY['cache_id'][$channel]])){

                        //
                        // GENERATE NEW CACHE ID.
                        self::$channel_resource_id_ARRAY['cache_id'][$channel] = $this->oCRNRSTN->generate_new_key(64);
                        if(isset($tmp_resource_id_active_ARRAY[self::$channel_resource_id_ARRAY['cache_id'][$channel]])){

                            //
                            // GENERATE NEW CACHE ID. LAST ATTEMPT TO AVOID COLLISION.
                            self::$channel_resource_id_ARRAY['cache_id'][$channel] = $this->oCRNRSTN->generate_new_key(64);
                            if(isset($tmp_resource_id_active_ARRAY[self::$channel_resource_id_ARRAY['cache_id'][$channel]])){

                                //
                                // HOOOSTON...VE HAF PROBLEM!
                                throw new Exception('Unable to store new data in RUNTIME due to too many cache_id collisions.');

                            }

                        }

                    }

                }

                //
                // SHOULD BE GOOD ENOUGH TO DO THE JOB.
                return self::$channel_resource_id_ARRAY['cache_id'][$channel];

            break;
            case CRNRSTN_CHANNEL_POST:
                //P :: HTTP $_POST REQUEST.
            case CRNRSTN_CHANNEL_GET:
                //G :: HTTP $_GET REQUEST.
            case CRNRSTN_CHANNEL_SOAP:
                //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
            case CRNRSTN_CHANNEL_DATABASE:
                //D :: DATABASE (MySQLi CONNECTION).
            case CRNRSTN_CHANNEL_COOKIE:
                //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
            case CRNRSTN_CHANNEL_PSSDTLA:
                //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
            case CRNRSTN_CHANNEL_SSDTLA:
                //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).
                // AWAITING IMPLEMENTATION.

            break;
            default:

                error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

            break;

        }

        return false;

    }

    public function init_config_cache_index_mem_header($ddo_memory_pointer, $index, $data_authorization_profile, $ttl){

        try{

            //error_log(__LINE__ . ' rrs map $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . ']. $data_authorization_profile[' . $data_authorization_profile . ']. $ttl[' . $ttl . '].');

            //
            // RETURN COUNT OF ITEMS AT DATA_KEY MEMORY LOCATION.
            $tmp_force_channel_active = false;
            $tmp_item_count_ARRAY = array();
            $tmp_ip = $this->oCRNRSTN->client_ip();

            //
            // PRE-INITIALIZATION HOOK FOR $_SERVER[] META DATA STORAGE BEFORE RRS MAP
            // CHANNEL INITIALIZATION. JUST SET IT TO RUNTIME.
            if(count(self::$channel_ARRAY) < 1){

                //
                // THIS IS THE ONLY REASON START TIME IS MAKING IT
                // INTO CRNRSTN :: DATA STORAGE.
                $tmp_force_channel_active = true;
                self::$channel_ARRAY[] = CRNRSTN_CHANNEL_RUNTIME;

            }

            //
            // LOOP THROUGH ARRAY OF ACTIVE CHANNELS.
            foreach(self::$channel_ARRAY as $ch_index => $channel){

                //error_log(__LINE__ . ' rrs map CHECKING PERMISSIONS ON CHANNEL[' . $channel . ']. $data_authorization_profile[' . $data_authorization_profile . '].');

                //
                // CHECK INPUT DATA PERMISSIONS PROFILE.
                if(($this->oCRNRSTN->channel_access_is_authorized($channel, $data_authorization_profile) == true) || ($tmp_force_channel_active == true)){

                    //error_log(__LINE__ . ' rrs map PERMISSION GRANTED TO STORE DATA IN CHANNEL[' . $channel . '].');
                    /*
                    CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA
                    OBJECT (DDO) SERVICES LAYER AUTHORIZATION
                    PROFILES FOR DATA HANDLING.
                    -----
                    CRNRSTN_CHANNEL_ALL
                    CRNRSTN_CHANNEL_GET
                    CRNRSTN_CHANNEL_POST
                    CRNRSTN_CHANNEL_COOKIE
                    CRNRSTN_CHANNEL_SESSION
                    CRNRSTN_CHANNEL_DATABASE
                    CRNRSTN_CHANNEL_SSDTLA
                    CRNRSTN_CHANNEL_PSSDTLA
                    CRNRSTN_CHANNEL_RUNTIME
                    CRNRSTN_CHANNEL_SOAP

                    */
                    switch($channel){
                        case CRNRSTN_CHANNEL_GET:
                            //G :: HTTP $_GET REQUEST.

                            //
                            // CHANNEL RESOURCE CACHE INDEX INITIALIZATION.
                            if($this->rrs_map_get($this->oCRNRSTN->get_channel_config($channel, 'NAME') . '_cache_is_active') == true){

                                error_log(__LINE__ . ' rrs map STATE IS_ACTIVE=TRUE FOR CHANNEL[' . $channel . '].');
                                error_log(__LINE__ . ' rrs map PENDING *** CACHE DATA STRUCTURE INITIALIZATION $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . ']. $data_authorization_profile[' . $data_authorization_profile . ']. $ttl[' . $ttl . ']. $channel[' . $channel . '].');
                                //die();

                            }

                        break;
                        case CRNRSTN_CHANNEL_COOKIE:
                            //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
                        case CRNRSTN_CHANNEL_PSSDTLA:
                            //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                        case CRNRSTN_CHANNEL_SSDTLA:
                            //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).
                        case CRNRSTN_CHANNEL_POST:
                            //P :: HTTP $_POST REQUEST.
                        case CRNRSTN_CHANNEL_SOAP:
                            //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).

                            //
                            // CHANNEL RESOURCE CACHE INDEX INITIALIZATION.
                            if($this->rrs_map_get($this->oCRNRSTN->get_channel_config($channel, 'NAME') . '_cache_is_active') == true) {

                                error_log(__LINE__ . ' rrs map STATE IS_ACTIVE=TRUE FOR CHANNEL[' . $channel . '].');
                                error_log(__LINE__ . ' rrs map PENDING $channel[' . $channel . '] CACHE DATA STRUCTURE INITIALIZATION $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . ']. $data_authorization_profile[' . $data_authorization_profile . ']. $ttl[' . $ttl . '].');
                                //die();

                            }

                        break;
                        case CRNRSTN_CHANNEL_RUNTIME:
                            //R :: RUNTIME.

                            //
                            // CHANNEL RESOURCE CACHE INDEX INITIALIZATION.
                            if($this->rrs_map_get($this->oCRNRSTN->get_channel_config($channel, 'NAME') . '_cache_is_active') == true){

                                //
                                // ONLY RUNTIME ASSIGNS THIS...AT LEAST FOR NOW.
                                // THIS SHOULD HAPPEN ONE TIME FOR METHOD DRIVEN RESOURCE REQUESTS...RIGHT?
                                // WAIT TO FINISH PLAID BEFORE DELETING THIS...Tuesday, May 23 2023 @ 0517 hrs.
                                //$this->ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial] = $ddo_memory_pointer;

                                //
                                // CACHE_ID :: PRIMARY RESOURCE KEY WITHIN MEMORY.
                                if(!isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer])){

                                    //
                                    // HERE IS WHERE CRNRSTN :: WRITES THE MEMORY ADDRESS TO THE INDEX HEADER
                                    // OF MEMORY IN PHP. THIS ADDRESS IS THE LOCATION OR POSTAL MAILING ADDRESS TO THE
                                    // LOCATION WHERE ALL OF THE DATA THAT IS ABOUT TO BE WRITTEN TO MEMORY (SESSION,
                                    // COOKIE, SOAP, GET, POST, RUNTIME...) WILL BE STORED (PLZ READ LITERALLY AS "THIS
                                    // IS HOW THE DATA WILL BE REFERENCED INTERNALLY"...SO THIS IS PRETTY MUCH GOING TO
                                    // BE MY "CRAYOLA CRAYON YEAH-WE-ALL-GOT-OUT-OF-THE-MATRIX" APPLICATION OF THE
                                    // CONCEPT OF A LITERAL REAL LIFE MAILBOX THAT IS UNTO A MAILING ADDRESS...WHERE, SAID
                                    // MAILING ADDRESS IS LOCATED ON A HARD DISK...IN THE MATRIX).
                                    self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer] = $this->cache_id(__FUNCTION__, $channel, $ddo_memory_pointer);
                                    //error_log(__LINE__ . ' rrs map NEW RUNTIME CACHE_ID $ddo_memory_pointer[' . $ddo_memory_pointer . ']=[' . self::$runtime_cache_id . '].');

                                    if(!isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['resource_bytes'][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]])){

                                        //
                                        // INITIALIZE RUNTIME RESOURCE_BYTES :: CACHE DATA SIZE IN BYTES.
                                        self::$cache_ARRAY[$this->oCRNRSTN->request_id]['resource_bytes'][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]] = 0;

                                    }

                                    $tmp_delay_write_datecreated = time();
                                    $tmp_delay_write_lastmodified = time();

                                }else{

                                    //
                                    // THIS RESOURCE EXISTS ALREADY.
                                    // DO NOT UPDATE DATECREATED.
                                    // UPDATE LAST MODIFIED.
                                    $tmp_delay_write_datecreated = NULL;
                                    $tmp_delay_write_lastmodified = time();

                                }

                                //
                                // IPADDRESS_ID :: IP ADDRESS KEY WITHIN MEMORY.
                                if(!isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['ipaddress_id'][$tmp_ip])){

                                    //
                                    // A NEW RESOURCE ID FOR A NEW IP.
                                    self::$cache_ARRAY[$this->oCRNRSTN->request_id]['ipaddress_id'][$tmp_ip] = $this->ipaddress_id(__FUNCTION__, $channel, $tmp_ip);

                                }

                                //
                                // JUST DO THIS HERE...INSTEAD OF MAKING n (n) METHOD CALLS LATER.
                                self::$cache_ARRAY[$this->oCRNRSTN->request_id]['ttl'][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]][] = $this->oCRNRSTN->finalize_ttl_secs($ttl);

                                if(isset($tmp_delay_write_datecreated)){

                                    //
                                    // ONLY CREATE DATECREATED ON FIRST CACHE_ID INSERT.
                                    // NO UPDATES TO DATECREATED.
                                    self::$cache_ARRAY[$this->oCRNRSTN->request_id]['datecreated'][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]] = $tmp_delay_write_datecreated;
                                    self::$cache_ARRAY[$this->oCRNRSTN->request_id]['createdby_client_ip'][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]] = self::$cache_ARRAY[$this->oCRNRSTN->request_id]['ipaddress_id'][$tmp_ip];

                                }

                                self::$cache_ARRAY[$this->oCRNRSTN->request_id]['lastmodified'][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]][] = $tmp_delay_write_lastmodified;
                                self::$cache_ARRAY[$this->oCRNRSTN->request_id]['modifiedby_client_ip'][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]][] = self::$cache_ARRAY[$this->oCRNRSTN->request_id]['ipaddress_id'][$tmp_ip];
                                self::$cache_ARRAY[$this->oCRNRSTN->request_id]['asset_family'][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]] = 'DDO';

                                $tmp_resource_count = count(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['lastmodified'][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]]);
                                self::$cache_ARRAY[$this->oCRNRSTN->request_id]['channel_resource_counts'][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]] = $tmp_resource_count;

                            }

                        break;
                        case CRNRSTN_CHANNEL_SESSION:
                            //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

                            //
                            // CHANNEL RESOURCE CACHE INDEX INITIALIZATION.
                            if($this->rrs_map_get($this->oCRNRSTN->get_channel_config($channel, 'NAME') . '_cache_is_active') == true && ($this->oCRNRSTN->channel_access_is_authorized($channel, $data_authorization_profile) == true)){

                                //
                                // CACHE_ID :: PRIMARY RESOURCE KEY WITHIN MEMORY.
                                if(!isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer])){

                                    $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer] = $this->cache_id(__FUNCTION__, $channel, $ddo_memory_pointer);

                                }

                                //
                                // IPADDRESS_ID :: IP ADDRESS KEY WITHIN MEMORY.
                                if(!isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['ipaddress_id'][$tmp_ip])){

                                    $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['ipaddress_id'][$tmp_ip] = $this->ipaddress_id(__FUNCTION__, $channel, $tmp_ip);

                                }

                                //
                                // INITIALIZE SESSION RESOURCE_BYTES :: CACHE DATA SIZE IN BYTES.
                                $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['resource_bytes'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]] = 0;

                                //
                                // JUST DO THIS HERE...INSTEAD OF MAKING SIX (6) METHOD CALLS LATER.
                                $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['ttl'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]][] = $this->oCRNRSTN->finalize_ttl_secs($ttl);

                                if(isset($tmp_delay_write_datecreated)){

                                    $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['datecreated'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]] = $tmp_delay_write_datecreated;

                                    $tmp_ipaddress_id = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['ipaddress_id'][$tmp_ip];
                                    $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['createdby_client_ip'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]] = $tmp_ipaddress_id;

                                }

                                if(!isset($tmp_delay_write_lastmodified)){

                                    $tmp_delay_write_lastmodified = time();

                                }

                                $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['lastmodified'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]][] = $tmp_delay_write_lastmodified;

                                $tmp_ipaddress_id = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['ipaddress_id'][$tmp_ip];
                                $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['modifiedby_client_ip'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]][] = $tmp_ipaddress_id;

                                $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['asset_family'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]] = 'DDO';

                                $tmp_lastmodified = count($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['lastmodified'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]]);
                                $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['channel_resource_counts'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]] = $tmp_lastmodified;

                            }

                        break;
                        case CRNRSTN_CHANNEL_DATABASE:
                            //D :: DATABASE (MySQLi CONNECTION).

                            //
                            // CHANNEL RESOURCE CACHE INDEX INITIALIZATION.
                            if($this->rrs_map_get($this->oCRNRSTN->get_channel_config($channel, 'NAME') . '_cache_is_active') == true){

                                error_log(__LINE__ . ' rrs map STATE IS_ACTIVE=TRUE FOR CHANNEL[' . $channel . '].');
                                error_log(__LINE__ . ' rrs map PENDING *** CACHE DATA STRUCTURE INITIALIZATION $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . ']. $data_authorization_profile[' . $data_authorization_profile . ']. $ttl[' . $ttl . ']. $channel[' . $channel . '].');
                                die();

                            }

                        break;
                        default:

                            error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                        break;

                    }

                }

            }

            return $tmp_item_count_ARRAY;

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function initialize_cache($crnrstn_asset_family, $salt_ugc, $data_key, $output_mode = NULL, $filepath = NULL, $file_extension = NULL){

        //
        // TODO :: NEED TO HANDLE ALL ACTIVE CHANNELS HERE INSIDE A FOREACH(), AND TIE THIS TO GLOBAL DATA AUTH PROFILE.
        // PROBABLY, THIS IS WHY TURNING ON UNFINISHED CHANNELS PRODUCES 503...I DUNNO.
        $tmp_ip = $this->oCRNRSTN->client_ip();

        //
        // TODO :: WOULD BE COOL TO ONLY NEED THIS DANG 9 CASE SWITCH IN ONE PLACE. THIS WOULD INVOLVE MORE ABSTRACT
        // METHOD CALLS WHERE THERE IS DYNAMIC ASSEMBLY OF METHODS USING SPECIAL PARAMS FOR EACH CHANNEL.
        foreach(self::$channel_ARRAY as $ch_index => $channel){

            if(!isset(self::$channel_resource_id_ARRAY['cache_id'][$channel])){

                //$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]

                //
                // TODO :: DO WE PUT THIS BEHIND CRNRSTN :: PLAID $_GET[] CHANNEL INITIALIZATION?
                self::$channel_resource_id_ARRAY['cache_id'][$channel] = 0;

            }

            switch($channel){
                case CRNRSTN_CHANNEL_SESSION:
                    //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

                    //
                    // CHANNEL RESOURCE CACHE INDEX INITIALIZATION.
                    // KEEP METHOD CALL DRIVEN REQUESTS IN MIND.
                    if($this->rrs_map_get($this->oCRNRSTN->get_channel_config($channel, 'NAME') . '_cache_is_active') == true){

                        //
                        // CACHE_ID :: PRIMARY RESOURCE KEY WITHIN MEMORY.
                        if(!isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$salt_ugc])){

                            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$salt_ugc] = $this->cache_id(__FUNCTION__, $channel, $salt_ugc);

                        }

                        //
                        // IPADDRESS_ID :: IP ADDRESS KEY WITHIN MEMORY.
                        if(!isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['ipaddress_id'][$tmp_ip])){

                            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['ipaddress_id'][$tmp_ip] = $this->ipaddress_id(__FUNCTION__, $channel, $tmp_ip);

                        }

                        //
                        // INITIALIZE SESSION RESOURCE_BYTES :: CACHE DATA SIZE IN BYTES.
                        $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['resource_bytes'][self::$channel_resource_id_ARRAY['cache_id'][$channel]] = 0;

                    }

                break;
                case CRNRSTN_CHANNEL_RUNTIME:
                    //R :: RUNTIME.
                case CRNRSTN_CHANNEL_POST:
                    //P :: HTTP $_POST REQUEST.
                case CRNRSTN_CHANNEL_GET:
                    //G :: HTTP $_GET REQUEST.
                case CRNRSTN_CHANNEL_SOAP:
                    //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                case CRNRSTN_CHANNEL_DATABASE:
                    //D :: DATABASE (MySQLi CONNECTION).
                case CRNRSTN_CHANNEL_COOKIE:
                    //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
                case CRNRSTN_CHANNEL_PSSDTLA:
                    //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                case CRNRSTN_CHANNEL_SSDTLA:
                    //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).

                    //
                    // CHANNEL RESOURCE CACHE INDEX INITIALIZATION.
                    // KEEP METHOD CALL DRIVEN REQUESTS IN MIND.
                    if($this->rrs_map_get($this->oCRNRSTN->get_channel_config($channel, 'NAME') . '_cache_is_active') == true){

                        //
                        // TODO :: MOVE THIS ARRAY TO $_GET[] CHANNEL. ONLY "RUNTIME" ASSIGNS THIS...AT LEAST FOR NOW.
                        // TODO :: LOOK AT HOW WE USE THIS! JUST SOME RANDOM GET UGC_KEY VALUE STUFF.
                        // TODO :: CRUSH THIS.
                        $this->ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial] = $salt_ugc;

                        //
                        // CACHE_ID :: PRIMARY RESOURCE KEY WITHIN MEMORY.
                        if(!isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$salt_ugc])){

                            //error_log(__LINE__ . ' rrs map NEW RRS_MAP CACHE_ID $salt_ugc[' . $salt_ugc . ']. self::$runtime_cache_id[' . self::$runtime_cache_id . '].');
                            self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$salt_ugc] = $this->cache_id(__FUNCTION__, 'runtime', $salt_ugc);

                        }

                        //
                        // IPADDRESS_ID :: IP ADDRESS KEY WITHIN MEMORY.
                        if(!isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['ipaddress_id'][$tmp_ip])){

                            self::$cache_ARRAY[$this->oCRNRSTN->request_id]['ipaddress_id'][$tmp_ip] = $this->ipaddress_id(__FUNCTION__, 'runtime', $tmp_ip);

                        }

                        //
                        // INITIALIZE RUNTIME RESOURCE_BYTES :: CACHE DATA SIZE IN BYTES.
                        self::$cache_ARRAY[$this->oCRNRSTN->request_id]['resource_bytes'][self::$channel_resource_id_ARRAY['cache_id'][$channel]] = 0;

                    }

                break;
                default:

                    error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                break;

            }

        }

        //
        // JUST HANDLE IT. THESE ARE MULTI-CHANNEL WRITE.
        $this->cache_write('filename', $salt_ugc, $crnrstn_asset_family, NULL, $salt_ugc);
        $this->cache_write('asset_family', $crnrstn_asset_family, $crnrstn_asset_family, NULL, $salt_ugc);
        $this->cache_write('asset_meta_key', $data_key, $crnrstn_asset_family, NULL, $salt_ugc);

        if(isset($output_mode)){

            //
            // CRNRSTN :: JS/CSS FRAMEWORK INTEGRATIONS.
            $this->cache_write('output_mode', $output_mode, $crnrstn_asset_family, NULL, $salt_ugc);

        }

        if(isset($filepath)){

            //
            // CRNRSTN :: JS/CSS FRAMEWORK INTEGRATIONS.
            $this->cache_write('filepath', $filepath, $crnrstn_asset_family, NULL, $salt_ugc);

        }

        if(isset($file_extension)){

            //
            // CRNRSTN :: JS/CSS FRAMEWORK INTEGRATIONS.
            $this->cache_write('file_ext', $file_extension, $crnrstn_asset_family, NULL, $salt_ugc);

        }

        $this->cache_write('datecreated', time(), $crnrstn_asset_family, NULL, $salt_ugc);
        $this->cache_write('createdby_client_ip', $tmp_ip, $crnrstn_asset_family, NULL, $salt_ugc);
        $this->cache_write('lastmodified', time(), $crnrstn_asset_family, NULL, $salt_ugc);
        $this->cache_write('modifiedby_client_ip', $tmp_ip, $crnrstn_asset_family, NULL, $salt_ugc);

    }

    public function get_config_cache_count($ddo_memory_pointer, $data_authorization_profile){

//        error_log(__LINE__ . ' rrs map $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $channel[' . $channel . '].');
//
//        error_log(__LINE__ . ' rrs map $cache_ARRAY[' . print_r(self::$cache_ARRAY[$this->oCRNRSTN->request_id], true) . '].');
//        error_log(__LINE__ . ' rrs map $cache_ARRAY[' . print_r($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO'], true) . '].');
//
//        $this->oCRNRSTN->destruct_output = __LINE__ . ' rrs map $cache_ARRAY[' . print_r(self::$cache_ARRAY[$this->oCRNRSTN->request_id], true) . '].';
//        die();

        switch($data_authorization_profile){
            case CRNRSTN_CHANNEL_SESSION:
                //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

                if(!isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer])){

                    return 0;

                }

                $tmp_cache_id = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer];

                if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_value'][$ddo_memory_pointer])){

                    return count($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_value'][$ddo_memory_pointer]);

                }

            break;
            case CRNRSTN_CHANNEL_RUNTIME:
                //R :: RUNTIME.

                if(!isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer])){

                    return 0;

                }

                $tmp_cache_id = self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer];

                if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['lastmodified'][$tmp_cache_id])){

                    return count(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['lastmodified'][$tmp_cache_id]);

                }

            break;
            case CRNRSTN_CHANNEL_POST:
                //P :: HTTP $_POST REQUEST.
            case CRNRSTN_CHANNEL_GET:
                //G :: HTTP $_GET REQUEST.
            case CRNRSTN_CHANNEL_SOAP:
                //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
            case CRNRSTN_CHANNEL_DATABASE:
                //D :: DATABASE (MySQLi CONNECTION).
            case CRNRSTN_CHANNEL_COOKIE:
                //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
            case CRNRSTN_CHANNEL_PSSDTLA:
                //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
            case CRNRSTN_CHANNEL_SSDTLA:
                //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).
            break;
            default:

                error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

            break;

        }

//        error_log(__LINE__ . ' rrs map $channel[' . $channel . ']. count[' . count(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['data_value'][$ddo_memory_pointer]) . '].');
//        die();

        return count(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['data_value'][$ddo_memory_pointer]);

    }

    public function isset_config_cache($data_attribute, $ddo_memory_pointer, $channel, $index){

        if(!isset($index)){

            $index = 0;

        }

        if(isset($channel)){

            //
            // CHECK THE PROVIDED CHANNEL.
            switch($channel){
                case CRNRSTN_CHANNEL_SESSION:
                    //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

                    //error_log(__LINE__ . ' rrs map isset_config_cache $data_attribute[' . $data_attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $channel[' .  $channel . '].');
                    //if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer])){
//                    error_log(__LINE__ . ' rrs map isset_config_cache [' . $channel . '] $ddo_memory_pointer[' . $ddo_memory_pointer . '].');
//                    error_log(__LINE__ . ' rrs map isset_config_cache [' . $channel . '] $data_attribute[' . print_r($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()], true) . ']. die();');
//
//                    die();

                    if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer])){

                        if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['lastmodified'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]][$index])){

                            return true;

                        }

                    }

                break;
                case CRNRSTN_CHANNEL_RUNTIME:
                    //R :: RUNTIME.
                case CRNRSTN_CHANNEL_POST:
                    //P :: HTTP $_POST REQUEST.
                case CRNRSTN_CHANNEL_GET:
                    //G :: HTTP $_GET REQUEST.
                case CRNRSTN_CHANNEL_SOAP:
                    //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                case CRNRSTN_CHANNEL_DATABASE:
                    //D :: DATABASE (MySQLi CONNECTION).
                case CRNRSTN_CHANNEL_COOKIE:
                    //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
                case CRNRSTN_CHANNEL_PSSDTLA:
                    //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                case CRNRSTN_CHANNEL_SSDTLA:
                    //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).

                    //
                    // JUST USE RUNTIME FOR NOW.
                    //if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer])){
                    if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer])){

                        //error_log(__LINE__.  ' rrs map ISSET? $data_attribute[' . $data_attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $channel[' .  $channel . '].');

                        if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['lastmodified'][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]][$index])){
                            //error_log(__LINE__ . ' rrs map RETURN TRUE $data_attribute[' . $data_attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $channel[' . $channel . ']. cache[' . print_r(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'], true) . '].');
                            //error_log(__LINE__.  ' rrs map ISSET? $data_attribute[' . $data_attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $channel[' .  $channel . '].');

                            return true;

                        }

                    }

                break;
                default:

                    error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                break;

            }

            return false;

        }

        //
        // LOOP THROUGH ACTIVE CHANNELS IN SEQUENCE FOR MATCH.
        foreach(self::$channel_ARRAY as $ch_index => $channel){

            //error_log(__LINE__.  ' rrs map ISSET? $data_attribute[' . $data_attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $channel[' .  $channel . '].');

            switch($channel){
                case CRNRSTN_CHANNEL_SESSION:
                    //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).
                    //if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer])){

                    if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer])){

                        if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['lastmodified'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]][$index])){

                            return true;

                        }

                    }

                break;
                case CRNRSTN_CHANNEL_RUNTIME:
                    //R :: RUNTIME.
                case CRNRSTN_CHANNEL_POST:
                    //P :: HTTP $_POST REQUEST.
                case CRNRSTN_CHANNEL_GET:
                    //G :: HTTP $_GET REQUEST.
                case CRNRSTN_CHANNEL_SOAP:
                    //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                case CRNRSTN_CHANNEL_DATABASE:
                    //D :: DATABASE (MySQLi CONNECTION).
                case CRNRSTN_CHANNEL_COOKIE:
                    //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
                case CRNRSTN_CHANNEL_PSSDTLA:
                    //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                case CRNRSTN_CHANNEL_SSDTLA:
                    //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).

                    //
                    // JUST USE RUNTIME FOR NOW.
                    //if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer])){
                    if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer])){

                        if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['lastmodified'][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]][$index])){

                            //error_log(__LINE__ . ' rrs map RETURN TRUE $data_attribute[' . $data_attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $channel[' . $channel . ']. cache[' . print_r(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'], true) . '].');
                            return true;

                        }

                    }

                break;
                default:

                    error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                break;

            }

        }

        return  false;

    }

    //
    // THE OUTPUT METHOD FOR ALL CRNRSTN :: CONFIGURATION DATA.
    // See, _crnrstn.config.inc.php.
    public function get_config_cache($attribute, $ddo_memory_pointer, $data_type_family, $index, $channel){

        //
        // THIS WILL ARRIVE AT THE INTERNAL DATA KEY FOR DIRECT MEMORY ACCESS...PLZ READ THIS
        // AS "POINTER LOOKUP" FOR ALL CRNRSTN :: CONFIG DATA.
        // APPLICATION ACCELERATION HAS BEEN BAKED INTO THIS R/W ARCHITECTURE.
        // R/W HAS NOT BEEN FULLY TESTED YET. WE ARE STILL SETTING UP THE MULTI-CHANNEL.
        // Thursday, May 25, 2023 @ 0439 hrs.
        //$ddo_memory_pointer = $this->oCRNRSTN->hash_ddo_memory_pointer($data_key, $data_type_family);

        /*
        CRNRSTN :: ORDER OF OPERATIONS (PREFERENCE) FOR SPECIFICATION OF
        AUTHORIZED DATA ARCHITECTURES (CHANNEL). DSJPCR.

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

        switch($attribute){
            case '_____isset':

                switch($channel){
                    case CRNRSTN_CHANNEL_SESSION:
                        //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

                        if(isset($index)){

                            if(strlen((string) $index) > 0){

                                if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer])){

                                    if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['lastmodified'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]][$index])){

                                        return true;

                                    }

                                }

                            }else{

                                if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer])){

                                    if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['lastmodified'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]][0])){

                                        return true;

                                    }

                                }

                            }

                        }else{

                            if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer])){

                                if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['lastmodified'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]][0])){

                                    return true;

                                }

                            }

                        }

                    break;
                    case CRNRSTN_CHANNEL_RUNTIME:
                        //R :: RUNTIME.
                    case CRNRSTN_CHANNEL_POST:
                        //P :: HTTP $_POST REQUEST.
                    case CRNRSTN_CHANNEL_GET:
                        //G :: HTTP $_GET REQUEST.
                    case CRNRSTN_CHANNEL_SOAP:
                        //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                    case CRNRSTN_CHANNEL_DATABASE:
                        //D :: DATABASE (MySQLi CONNECTION).
                    case CRNRSTN_CHANNEL_COOKIE:
                        //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
                    case CRNRSTN_CHANNEL_PSSDTLA:
                        //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                    case CRNRSTN_CHANNEL_SSDTLA:
                        //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).

                        if(isset($index)){

                            if(strlen((string) $index) > 0){

                                if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer])){

                                    if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['lastmodified'][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]][$index])){

                                        return true;

                                    }

                                }

                            }else{

                                if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer])){

                                    if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['lastmodified'][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]][0])){

                                        return true;

                                    }

                                }

                            }

                        }else{

                            if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer])){

                                if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['lastmodified'][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]][0])){

                                    return true;

                                }

                            }

                        }

                    break;
                    default:

                        error_log(__LINE__ . ' rrs map DEFAULT CHANNEL HIT. ...WHY? $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                    break;

                }

                return false;

            break;
            case 'ipaddress_id':
                // [READY FOR TESTING]

                switch($channel){
                    case CRNRSTN_CHANNEL_SESSION:
                        //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).
                        $tmp_ip = $this->oCRNRSTN->client_ip();

                        if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO'][$attribute][$tmp_ip])){

                            return $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO'][$attribute][$tmp_ip];

                        }

                    break;
                    case CRNRSTN_CHANNEL_RUNTIME:
                        //R :: RUNTIME.
                    case CRNRSTN_CHANNEL_POST:
                        //P :: HTTP $_POST REQUEST.
                    case CRNRSTN_CHANNEL_GET:
                        //G :: HTTP $_GET REQUEST.
                    case CRNRSTN_CHANNEL_SOAP:
                        //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                    case CRNRSTN_CHANNEL_DATABASE:
                        //D :: DATABASE (MySQLi CONNECTION).
                    case CRNRSTN_CHANNEL_COOKIE:
                        //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
                    case CRNRSTN_CHANNEL_PSSDTLA:
                        //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                    case CRNRSTN_CHANNEL_SSDTLA:
                        //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).

                        $tmp_ip = $this->oCRNRSTN->client_ip();

                        if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][$tmp_ip])){

                            return self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][$tmp_ip];

                        }

                    break;
                    default:

                        error_log(__LINE__ . ' rrs map DEFAULT CHANNEL HIT. ...WHY? $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                    break;

                }

            break;
            case 'channel_bytes':

                //
                // UPDATE CUMULATIVE CACHE BYTES BY CHANNEL.
                switch($channel){
                    case CRNRSTN_CHANNEL_SESSION:
                        //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

                        if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['channel_bytes'][$channel])){

                            return $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['channel_bytes'][$channel];

                        }

                    break;
                    case CRNRSTN_CHANNEL_RUNTIME:
                        //R :: RUNTIME.
                    case CRNRSTN_CHANNEL_POST:
                        //P :: HTTP $_POST REQUEST.
                    case CRNRSTN_CHANNEL_GET:
                        //G :: HTTP $_GET REQUEST.
                    case CRNRSTN_CHANNEL_SOAP:
                        //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                    case CRNRSTN_CHANNEL_DATABASE:
                        //D :: DATABASE (MySQLi CONNECTION).
                    case CRNRSTN_CHANNEL_COOKIE:
                        //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
                    case CRNRSTN_CHANNEL_PSSDTLA:
                        //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                    case CRNRSTN_CHANNEL_SSDTLA:
                        //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).

                        if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['channel_bytes'][$channel])){

                            return self::$cache_ARRAY[$this->oCRNRSTN->request_id]['channel_bytes'][$channel];

                        }

                    break;
                    default:

                        error_log(__LINE__ . ' rrs map UNKNOWN SWITCH CASE VALUE RECEIVED: ' . print_r($channel, true));

                    break;

                }

                return 0;

            break;
            case 'lastmodified':
            case 'modifiedby_client_ip':
            case 'ttl':
            case 'ttl_profile':
            case 'data_authorization_profile':
            case 'data_type':
            case 'data_flag':
            case 'data_value':
                // [READY FOR TESTING]

//                error_log(__LINE__ . ' rrs map READ DATA [' . $channel . '] $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $data_type_family[' . $data_type_family . ']. $index[' . $index . '].');
//                $this->oCRNRSTN->destruct_output .= __LINE__ . ' rrs map RUNTIME:
//'. print_r(self::$cache_ARRAY[$this->oCRNRSTN->request_id], true);

                //
                // UPDATE CUMULATIVE CACHE BYTES BY CHANNEL.
                switch($channel){
                    case CRNRSTN_CHANNEL_SESSION:
                        //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

//                        if(strpos($ddo_memory_pointer,'data_channel_init_sequence') !== false && $attribute == 'data_value'){
//
//                            error_log(__LINE__ . ' rrs map READ DATA [' . $channel . '] $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $data_type_family[' . $data_type_family . ']. $index[' . $index . '].');
//
//                            $this->oCRNRSTN->destruct_output = 'SESSION:
//' . print_r($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO'], true);
//                            $this->oCRNRSTN->destruct_output .= 'RUNTIME:
//
//'. print_r(self::$cache_ARRAY[$this->oCRNRSTN->request_id], true);
//
//                        }

                        if(isset($index)){

                            if(strlen((string) $index) > 0){

                                if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer])){

                                    if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO'][$attribute][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]][$index])){

                                        //
                                        // EXTRACT DATA TYPE.
                                        //$tmp_type = self::$cache_ARRAY[$this->oCRNRSTN->request_id]['data_type'][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]][0];
                                        $tmp_type = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_type'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]][$index];

                                        //
                                        // CRNRSTN :: DECOUPLED DATA OBJECT (DDO) DATA INPUT SERIALIZATION LAYER.
                                        if($tmp_result = $this->oCRNRSTN->is_resource_serialization_active($tmp_type, $channel)){

                                            return unserialize($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO'][$attribute][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]][$index]);

                                        }

                                        return $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO'][$attribute][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]][$index];

                                    }

                                }

                            }else{

                                if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer])){

                                    if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO'][$attribute][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]][0])){

                                        //
                                        // EXTRACT DATA TYPE.
                                        $tmp_type = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_type'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]][0];

                                        //
                                        // CRNRSTN :: DECOUPLED DATA OBJECT (DDO) DATA INPUT SERIALIZATION LAYER.
                                        if($tmp_result = $this->oCRNRSTN->is_resource_serialization_active($tmp_type, $channel)){

                                            return unserialize($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO'][$attribute][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]][0]);

                                        }

                                        return $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO'][$attribute][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]][0];

                                    }

                                }

                            }

                        }else{

                            error_log(__LINE__ . ' rrs map READ DATA [' . $channel . '] $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $data_type_family[' . $data_type_family . ']. $index[' . $index . '].');

                            if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer])){

                                if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO'][$attribute][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]][0])){

                                    //
                                    // EXTRACT DATA TYPE.
                                    $tmp_type = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['data_type'][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]][0];

                                    //
                                    // CRNRSTN :: DECOUPLED DATA OBJECT (DDO) DATA INPUT SERIALIZATION LAYER.
                                    if($tmp_result = $this->oCRNRSTN->is_resource_serialization_active($tmp_type, $channel)){

                                        return unserialize($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO'][$attribute][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]][0]);


                                    }

                                    return $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO'][$attribute][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]][0];

                                }

                            }

                        }

                    break;
                    case CRNRSTN_CHANNEL_RUNTIME:
                        //R :: RUNTIME.
                    case CRNRSTN_CHANNEL_POST:
                        //P :: HTTP $_POST REQUEST.
                    case CRNRSTN_CHANNEL_GET:
                        //G :: HTTP $_GET REQUEST.
                    case CRNRSTN_CHANNEL_SOAP:
                        //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                    case CRNRSTN_CHANNEL_DATABASE:
                        //D :: DATABASE (MySQLi CONNECTION).
                    case CRNRSTN_CHANNEL_COOKIE:
                        //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
                    case CRNRSTN_CHANNEL_PSSDTLA:
                        //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                    case CRNRSTN_CHANNEL_SSDTLA:
                        //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).

                        if(isset($index)){

                            if(strlen((string) $index) > 0){

                                if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer])){

                                    if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]][$index])){

                                        //
                                        // EXTRACT DATA TYPE.
                                        $tmp_type = self::$cache_ARRAY[$this->oCRNRSTN->request_id]['data_type'][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]][$index];

                                        //
                                        // CRNRSTN :: DECOUPLED DATA OBJECT (DDO) DATA INPUT SERIALIZATION LAYER.
                                        if($tmp_result = $this->oCRNRSTN->is_resource_serialization_active($tmp_type, $channel)){

                                            return unserialize(self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]][$index]);

                                        }

                                        return self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]][$index];

                                    }

                                }

                            }else{

                                if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer])){

                                    if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]][0])){

                                        //
                                        // EXTRACT DATA TYPE.
                                        $tmp_type = self::$cache_ARRAY[$this->oCRNRSTN->request_id]['data_type'][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]][0];

                                        //
                                        // CRNRSTN :: DECOUPLED DATA OBJECT (DDO) DATA INPUT SERIALIZATION LAYER.
                                        if($tmp_result = $this->oCRNRSTN->is_resource_serialization_active($tmp_type, $channel)){

                                            return unserialize(self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]][0]);

                                        }

                                        return self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]][0];

                                    }

                                }

                            }

                        }else{

                            if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer])){

                                if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]][0])){

                                    //
                                    // EXTRACT DATA TYPE.
                                    $tmp_type = self::$cache_ARRAY[$this->oCRNRSTN->request_id]['data_type'][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]][0];

                                    //
                                    // CRNRSTN :: DECOUPLED DATA OBJECT (DDO) DATA INPUT SERIALIZATION LAYER.
                                    if($tmp_result = $this->oCRNRSTN->is_resource_serialization_active($tmp_type, $channel)){

                                        return unserialize(self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]][0]);

                                    }

                                    return self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]][0];

                                }

                            }

                        }

                    break;
                    default:

                        error_log(__LINE__ . ' rrs map DEFAULT CHANNEL HIT. ...WHY? $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                    break;

                }

            break;
            case 'datecreated':
            case 'createdby_client_ip':
            case 'asset_family':
                // [READY FOR TESTING]

                switch($channel){
                    case CRNRSTN_CHANNEL_SESSION:
                        //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

                        if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()][$attribute][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]])){

                            return $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()][$attribute][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]];

                        }

                        return '';

                    break;
                    case CRNRSTN_CHANNEL_RUNTIME:
                        //R :: RUNTIME.
                    case CRNRSTN_CHANNEL_POST:
                        //P :: HTTP $_POST REQUEST.
                    case CRNRSTN_CHANNEL_GET:
                        //G :: HTTP $_GET REQUEST.
                    case CRNRSTN_CHANNEL_SOAP:
                        //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                    case CRNRSTN_CHANNEL_DATABASE:
                        //D :: DATABASE (MySQLi CONNECTION).
                    case CRNRSTN_CHANNEL_COOKIE:
                        //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
                    case CRNRSTN_CHANNEL_PSSDTLA:
                        //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                    case CRNRSTN_CHANNEL_SSDTLA:
                        //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).

                        if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]])){

                            return self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]];

                        }

                        return '';

                    break;
                    default:

                        error_log(__LINE__ . ' rrs map DEFAULT CHANNEL HIT. ...WHY? $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                    break;

                }

            break;
            case 'resource_bytes':
            case 'channel_resource_counts':
                // [READY FOR TESTING]

                //
                // UPDATE CUMULATIVE CACHE BYTES BY CHANNEL.
                switch($channel){
                    case CRNRSTN_CHANNEL_SESSION:
                        //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

                        if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer])){

                            if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()][$attribute][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]][$index])){

                                return $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()][$attribute][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer]][$index];

                            }

                        }

                        return 0;

                    break;
                    case CRNRSTN_CHANNEL_RUNTIME:
                        //R :: RUNTIME.
                    case CRNRSTN_CHANNEL_POST:
                        //P :: HTTP $_POST REQUEST.
                    case CRNRSTN_CHANNEL_GET:
                        //G :: HTTP $_GET REQUEST.
                    case CRNRSTN_CHANNEL_SOAP:
                        //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                    case CRNRSTN_CHANNEL_DATABASE:
                        //D :: DATABASE (MySQLi CONNECTION).
                    case CRNRSTN_CHANNEL_COOKIE:
                        //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
                    case CRNRSTN_CHANNEL_PSSDTLA:
                        //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                    case CRNRSTN_CHANNEL_SSDTLA:
                        //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).

                        if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer])){

                            if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]][$index])){

                                return self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer]][$index];

                            }

                        }

                        return 0;

                    break;
                    default:

                        error_log(__LINE__ . ' rrs map DEFAULT CHANNEL HIT. ...WHY? $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                    break;

                }

            break;

        }

        return '';

    }

    public function get_cache($attribute, $ugc_key = NULL, $channel = CRNRSTN_CHANNEL_RUNTIME, $data = NULL){

        if(!isset($ugc_key)){

            //error_log(__LINE__ . ' rrs map cache['. print_r(self::$cache_ARRAY[$this->oCRNRSTN->request_id], true) .'] $attribute[' . $attribute . ']. $channel[' . $channel . ']. $ugc_key[' . $ugc_key . ']. $data[' . $data . '].');
            //$ugc_key = $_GET[$this->oCRNRSTN->session_salt()];
            if(isset($this->ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial])){

                $ugc_key = $this->ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial];

            }

        }else{

            if(strlen($ugc_key) < 1){

                //$ugc_key = $_GET[$this->oCRNRSTN->session_salt()];
                $ugc_key = $this->ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial];

            }

        }

        /*
        self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$salt_ugc] = self::$runtime_cache_id;
        self::$cache_ARRAY[$this->oCRNRSTN->request_id]['ipaddress_id'][$this->oCRNRSTN->client_ip()] = $tmp_cnt;
        self::$cache_ARRAY[$this->oCRNRSTN->request_id]['resource_bytes'][self::$runtime_cache_id] = 0;

        self::$session_cache_id = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$salt_ugc] = $i;
        $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$ugc_key];
        $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['ipaddress_id'][$this->oCRNRSTN->client_ip()] = $i;

        case 'cache_id'
        case 'ipaddress_id'
        case 'resource_bytes'
        case 'filename'
        case 'asset_family'
        case 'asset_meta_key'
        case 'output_mode'
        case 'raw_output_mode'
        case 'meta_path'
        case 'url'
        case 'filepath'
        case 'file_ext'
        case 'datecreated'
        case 'createdby_client_ip'
        case 'lastmodified'
        case 'modifiedby_client_ip'

        */

        switch($attribute){
            case 'cache_id':

                switch($channel){
                    case CRNRSTN_CHANNEL_SESSION:
                        //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

                        if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'][$attribute][$ugc_key])){

                            return $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'][$attribute][$ugc_key];

                        }

                    break;
                    case CRNRSTN_CHANNEL_RUNTIME:
                        //R :: RUNTIME.
                    case CRNRSTN_CHANNEL_POST:
                        //P :: HTTP $_POST REQUEST.
                    case CRNRSTN_CHANNEL_GET:
                        //G :: HTTP $_GET REQUEST.
                    case CRNRSTN_CHANNEL_SOAP:
                        //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                    case CRNRSTN_CHANNEL_DATABASE:
                        //D :: DATABASE (MySQLi CONNECTION).
                    case CRNRSTN_CHANNEL_COOKIE:
                        //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
                    case CRNRSTN_CHANNEL_PSSDTLA:
                        //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                    case CRNRSTN_CHANNEL_SSDTLA:
                        //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).

                        if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][$ugc_key])){

                            return self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][$ugc_key];

                        }

                    break;
                    default:

                        error_log(__LINE__ . ' rrs map DEFAULT CHANNEL HIT. ...WHY? $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ugc_key[' . $ugc_key . '].');

                    break;

                }

            break;
            case 'ipaddress_id':

                $tmp_ip = $this->oCRNRSTN->client_ip();

                switch($channel){
                    case CRNRSTN_CHANNEL_SESSION:
                        //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

                        if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'][$attribute][$tmp_ip])){

                            return $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'][$attribute][$tmp_ip];

                        }

                    break;
                    case CRNRSTN_CHANNEL_RUNTIME:
                        //R :: RUNTIME.
                    case CRNRSTN_CHANNEL_POST:
                        //P :: HTTP $_POST REQUEST.
                    case CRNRSTN_CHANNEL_GET:
                        //G :: HTTP $_GET REQUEST.
                    case CRNRSTN_CHANNEL_SOAP:
                        //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                    case CRNRSTN_CHANNEL_DATABASE:
                        //D :: DATABASE (MySQLi CONNECTION).
                    case CRNRSTN_CHANNEL_COOKIE:
                        //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
                    case CRNRSTN_CHANNEL_PSSDTLA:
                        //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                    case CRNRSTN_CHANNEL_SSDTLA:
                        //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).

                        if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][$tmp_ip])){

                            return self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][$tmp_ip];

                        }

                    break;
                    default:

                        error_log(__LINE__ . ' rrs map DEFAULT CHANNEL HIT. ...WHY? $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ugc_key[' . $ugc_key . '].');

                    break;

                }

            break;
            case 'resource_bytes':
            case 'filename':
            case 'asset_family':
            case 'asset_meta_key':
            case 'output_mode':
            case 'raw_output_mode':
            case 'meta_path':
            case 'url':
            case 'filepath':
            case 'file_ext':
            case 'datecreated':
            case 'createdby_client_ip':
            case 'lastmodified':
            case 'modifiedby_client_ip':

                switch($channel){
                    case CRNRSTN_CHANNEL_SESSION:
                        //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

                        if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$ugc_key])){

                            if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'][$attribute][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$ugc_key]])){

                                return $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'][$attribute][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$ugc_key]];

                            }

                        }

                    break;
                    case CRNRSTN_CHANNEL_RUNTIME:
                        //R :: RUNTIME.
                    case CRNRSTN_CHANNEL_POST:
                        //P :: HTTP $_POST REQUEST.
                    case CRNRSTN_CHANNEL_GET:
                        //G :: HTTP $_GET REQUEST.
                    case CRNRSTN_CHANNEL_SOAP:
                        //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                    case CRNRSTN_CHANNEL_DATABASE:
                        //D :: DATABASE (MySQLi CONNECTION).
                    case CRNRSTN_CHANNEL_COOKIE:
                        //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
                    case CRNRSTN_CHANNEL_PSSDTLA:
                        //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                    case CRNRSTN_CHANNEL_SSDTLA:
                        //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).

                        if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ugc_key])){

                            if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ugc_key]])){

                                return self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ugc_key]];

                            }

                        }

                        return '';

                    break;
                    default:

                        error_log(__LINE__ . ' rrs map DEFAULT CHANNEL HIT. ...WHY? $channel[' . $channel . ']. $attribute[' . $attribute . '].');

                    break;

                }

            break;

        }

        //error_log(__LINE__ . ' rrs map GET [' . $channel . '] VALUE FROM $attribute[' . $attribute . ']. $ugc_key[' . $ugc_key . ']. data[' . $data . ']. $channel[' . $channel . '].');

        return '';

    }

    public function check_rrs_map_cache_id_integrity($lnum, $method){

        //error_log(' **checking cache_id integrity** @ ' . $lnum . ' ' . $method . ' rrs map.');

        foreach(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'] as $tmp_key => $tmp_id){

            if(strlen($tmp_key) < 1){

                error_log($lnum . ' ' . $method . ' rrs map MISSING RUNTIME CACHE_ID. [' . print_r(self::$cache_ARRAY, true) . '].');
                die();

            }

        }

        if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'])){

            foreach($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'] as $tmp_key => $tmp_id){

                if(strlen($tmp_key) < 1){

                    error_log($lnum . ' ' . $method . ' rrs map MISSING SESSION CACHE_ID. [' . print_r(self::$cache_ARRAY, true) . '].');
                    die();

                }

            }

        }

    }

    public function channel_auth_data_reporting_sync($data, $data_key, $data_type_family, $channel, $data_authorization_profile, $cache_storage){

        if($this->oCRNRSTN->channel_access_is_authorized($channel, $data_authorization_profile) == true){

            //
            // CALCULATE DATA SIZE.
            $tmp_data_len = $this->oCRNRSTN->return_cache_bytes_size($data);  // 1 CHAR ~= 2 BYTES. 1ST PASS LOGIC.

            // , $salt_ugc_override, $data_type_family, 'RRS_MAP', 0
            // THIS WILL ALSO ADJUST THE CHANNELS' REPORTING ON TOTAL BYTES STORED.
            if($this->is_map_auth($channel, $tmp_data_len, $data_key, $data_type_family, $cache_storage) !== true){

                $data = '';

            }

        }

        //
        // RETURN CHANNEL AUTHORIZED AND CHANNEL REPORTED DATA.
        // THIS WILL BE AN EMPTY STRING, IF THE DATA IS NOT AUTHORIZED.
        // Monday, May 22, 2023 @ 0350 hrs
        // -5
        return $data;

    }

    public function config_cache_data_write($attribute, $data, $ddo_memory_pointer, $data_type_family, $index, $data_authorization_profile, $channel_override = NULL){

        try{

            //error_log(__LINE__ . ' rrs map CONFIG CACHE WRITE $attribute[' . $attribute . ']. $data[' . print_r($data, true) . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . ']. $channel[' . $channel_override . '].');

            //
            // WRITE CONFIG DATA TO CACHE.
            switch($attribute){
                case 'ttl_profile':
                case 'data_authorization_profile':
                case 'data_type':
                case 'data_flag':
                case 'data_value':

                    $tmp_data_serialized = NULL;
                    $tmp_data_is_serialized = false;
                    $tmp_auth_channel_ARRAY = array();

                    //
                    // CRNRSTN_STRING, CRNRSTN_INT, CRNRSTN_INTEGER, CRNRSTN_BOOL,
                    // CRNRSTN_BOOLEAN, CRNRSTN_FLOAT, CRNRSTN_DOUBLE, CRNRSTN_ARRAY,
                    // CRNRSTN_OBJECT, CRNRSTN_RESOURCE, CRNRSTN_NULL,
                    // CRNRSTN_RESOURCE_CLOSED, CRNRSTN_UNKNOWN_TYPE
                    $tmp_data_type = $this->oCRNRSTN->gettype($data, CRNRSTN_INTEGER);

                    //
                    // CHANNEL INITIALIZATION.
                    if(!isset($channel_override)){

                        // isset_config_cache()  // 'lastmodified'
                        //error_log(__LINE__ . ' rrs map [PREPUSH] cache_id['. print_r(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['lastmodified'], true) . '].');

                        //error_log(__LINE__ . ' rrs map [PREPUSH] cache_id['. print_r(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'], true) . '].');
                        //error_log(__LINE__ . ' rrs map [PREPUSH] data_value['. print_r(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['data_value'], true) . '].');

                        //
                        // ALL ACTIVE CHANNELS WITH BYTE CAPACITY RETURNED.
                        // TODO :: WE SHOULD BE ABLE TO BATCH SOME...IF NOT ALL OF THE NEW_BYTE AUTHORIZATION CALLS.
                        $tmp_auth_channel_ARRAY = $this->new_config_cache_bytes($data, $ddo_memory_pointer, $data_type_family, $index, $data_authorization_profile);
                        //error_log(__LINE__ . ' rrs map $data_type_family[' . $data_type_family . ']. $data[' . print_r($data, true) . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $tmp_auth_channel_ARRAY[' . print_r($tmp_auth_channel_ARRAY, true) . '].');

                    }else{

                        if(strlen($channel_override) > 0){

                            //error_log(__LINE__ . ' rrs CALC BYTE PERMISSIONS. $attribute[' . $attribute . ']. $data[' . $data . ']. $channel[' . $channel . ']. $data_str_cum[' . $data_str_cum . ']. cache_ARRAY['. print_r(self::$cache_ARRAY, true) . '].');

                            $tmp_auth_channel_ARRAY = $this->new_config_cache_bytes($data, $ddo_memory_pointer, $data_type_family, $index, $data_authorization_profile, $channel_override);
                            //error_log(__LINE__ . ' rrs map $channel_override[' . $channel_override . ']. $data[' . print_r($data, true) . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $tmp_auth_channel_ARRAY[' . print_r($tmp_auth_channel_ARRAY, true) . '].');

                        }

                    }

                    //error_log(__LINE__ . ' rrs map $data_str_cum[' . print_r($data, true) . ']. $tmp_auth_channel_ARRAY[' . print_r($tmp_auth_channel_ARRAY, true) . '].');

                    //
                    // INITIALIZE CACHE DATA IN ALL ACTIVE CHANNELS.
                    // THIS IS WHERE CRNRSTN :: STORES THE BODY OF THE DATA IN MEMORY.
                    // THE PROPRIETARY INTERNAL STORAGE APPARATI OF CRNRSTN :: USES
                    // BOTH TRADITIONAL STORAGE & DATA TRANSFER MECHANISMS (E.G. GET,
                    // POST, COOKIE, AND DATABASE) BUT STORES THE DATA ACCORDING TO
                    // PROPRIETARY (AND OPTIONALLY ENCRYPTED) LOGICAL CONSTRUCTS.
                    //
                    // TODO :: CRNRSTN :: WILL HAVE A HANDS-OFF SERVICES LAYER DEDICATED
                    // UNTO THE MANAGEMENT AND TTL ROTATION OF CRNRSTN :: OPENSSL
                    // ENCRYPTION PROFILES.
                    //
                    // TODO :: CRNRSTN :: NEEDS A DATA/CHANNEL LOOKUP ARRAY
                    // Sunday, October 8, 2023 @ 0653 hrs.
                    foreach($tmp_auth_channel_ARRAY as $chnl_index => $channel){

                        //
                        // BUILD RESOURCE POINTER FOR FASTER "WHAT CHANNEL HAS THE DATA" LOOKUPS.
                        $this->oCRNRSTN->build_ddo_resource_pointer($ddo_memory_pointer, $channel);

//
//                        self::$ddo_resource_key_pointer_ARRAY['KEY']['crnrstn_system_directory'] = 1;
//                        -----
//                        $tmp_ddo_memory_pointer = $this->oCRNRSTN->hash_ddo_memory_pointer($data_key, $data_type_family);
//                        self::$ddo_resource_memory_pointer_ARRAY['HASH'][$tmp_ddo_memory_pointer][] = 'runtime';
//                        self::$ddo_resource_memory_pointer_ARRAY['HASH'][$tmp_ddo_memory_pointer][] = 'session';

                        //
                        // Sunday, October 8, 2023 @ 0654 hrs.
                        // CRNRSTN :: DECOUPLED DATA OBJECT (DDO) DATA INPUT SERIALIZATION LAYER.
                        if(($tmp_result = $this->oCRNRSTN->is_resource_serialization_active($tmp_data_type, $channel) && !($tmp_data_is_serialized !== false))){

                            //
                            // THIS ONLY FIRES ONCE...IF IT HAS TO FIRE AT ALL.
                            $tmp_data_serialized = serialize($data);
                            $tmp_data_is_serialized = true;

                        }

                        //if(($this->oCRNRSTN->channel_access_is_authorized($channel, $data_authorization_profile) == true)){  // REDUNDANT?

                            switch($channel){
                                case CRNRSTN_CHANNEL_SESSION:
                                    //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

                                    //$tmp_cache_id = self::$channel_resource_id_ARRAY['cache_id'][$channel];
                                    //$tmp_cache_id = $this->get_config_cache('cache_id', $ddo_memory_pointer, $data_type_family, NULL, $channel);
                                    $tmp_cache_id = $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO']['cache_id'][$ddo_memory_pointer];
                                    //error_log(__LINE__  . ' rrs map CACHE WRITE $tmp_cache_id[' . $tmp_cache_id . ']. $attribute[' . $attribute . ']. $data[' . print_r($data, true) . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . ']. $channel[' . $channel . '].');

                                    if(isset($index)){

                                        if(strlen((string) $index) > 0){

                                            if($tmp_data_is_serialized == true){

                                                $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO'][$attribute][$tmp_cache_id][$index] = $tmp_data_serialized;

                                            }else{

                                                $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO'][$attribute][$tmp_cache_id][$index] = $data;

                                            }

                                        }else{

                                            if($tmp_data_is_serialized == true){

                                                $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO'][$attribute][$tmp_cache_id][] = $tmp_data_serialized;

                                            }else{

                                                $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO'][$attribute][$tmp_cache_id][] = $data;

                                            }

                                        }

                                    }else{

                                        if($tmp_data_is_serialized == true){

                                            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO'][$attribute][$tmp_cache_id][] = $tmp_data_serialized;

                                        }else{

                                            $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['DDO'][$attribute][$tmp_cache_id][] = $data;

                                        }

                                    }

                                break;
                                case CRNRSTN_CHANNEL_RUNTIME:
                                    //R :: RUNTIME.
                                case CRNRSTN_CHANNEL_POST:
                                    //P :: HTTP $_POST REQUEST.
                                case CRNRSTN_CHANNEL_GET:
                                    //G :: HTTP $_GET REQUEST.
                                case CRNRSTN_CHANNEL_SOAP:
                                    //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                                case CRNRSTN_CHANNEL_DATABASE:
                                    //D :: DATABASE (MySQLi CONNECTION).
                                case CRNRSTN_CHANNEL_COOKIE:
                                    //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
                                case CRNRSTN_CHANNEL_PSSDTLA:
                                    //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                                case CRNRSTN_CHANNEL_SSDTLA:
                                    //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).

                                    //$tmp_cache_id = self::$channel_resource_id_ARRAY['cache_id'][$channel];
                                    //$tmp_cache_id = $this->get_config_cache('cache_id', $ddo_memory_pointer, $data_type_family, NULL, $channel);
                                    $tmp_cache_id = self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$ddo_memory_pointer];
                                    //error_log(__LINE__  . ' rrs map CACHE WRITE $tmp_cache_id[' . $tmp_cache_id . ']. $attribute[' . $attribute . ']. $data[' . print_r($data, true) . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . ']. $channel[' . $channel . '].');
//                                    error_log(__LINE__ . ' rrs map $data_str_cum[' . $data . '].');
//
//                                    $this->oCRNRSTN->destruct_output = __LINE__ . ' rrs map
//SESSION:
//' . print_r($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()], true) . '
///////////////////
///////////////////
//RUNTIME:
//' . print_r(self::$cache_ARRAY, true);

                                    if(isset($index)){

                                        if(strlen((string) $index) > 0){

                                            if($tmp_data_is_serialized == true){

                                                self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][$tmp_cache_id][$index] = $tmp_data_serialized;

                                            }else{

                                                self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][$tmp_cache_id][$index] = $data;

                                            }

                                        }else{

                                            if($tmp_data_is_serialized == true){

                                                self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][$tmp_cache_id][] = $tmp_data_serialized;

                                            }else{

                                                self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][$tmp_cache_id][] = $data;

                                            }

                                        }

                                    }else{

                                        if($tmp_data_is_serialized == true){

                                            self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][$tmp_cache_id][] = $tmp_data_serialized;

                                        }else{

                                            self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][$tmp_cache_id][] = $data;

                                        }

                                    }

                                break;
                                default:

                                    error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                                break;

                            }

                        //}

                    }

                break;
                default:

                    error_log(__LINE__ . ' rrs map UNHANDLED[CASE] DATA STORAGE FRAMEWORK ATTRIBUTE $attribute[' . $attribute . ']. $data[' . print_r($data, true) . '].');

                break;

            }

            return true;

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function cache_write($attribute, $data, $data_type_family, $channel_override = NULL, $salt_ugc_override = NULL){

        try{

            //error_log(__LINE__  . ' rrs map CACHE WRITE $data_type_family[' . $data_type_family . ']. $attribute[' . $attribute . ']. $data[' . $data . ']. $channel_override[' . $channel_override . ']. $salt_ugc_override[' . $salt_ugc_override . '].');
            //die();
            //[Mon May 29 01:31:22.827556 2023] [:error] [pid 61168] [client 172.16.225.1:53476] 5998 rrs map CACHE WRITE
            // $data_type_family[system].
            // $attribute[output_mode].
            // $data[7186].
            // $channel[redhat_logo].
            // $salt_ugc_override[].

            $tmp_ugc = NULL;
            if($attribute == 'filename'){

                // FILE NAME IS UGC WITH $_GET[]
                $tmp_ugc = $data;

            }

            if(isset($salt_ugc_override)){

                $tmp_ugc = $this->get_salt_ugc($salt_ugc_override);

            }

            //
            // WRITE DATA TO CACHE.
            switch($attribute){
                case 'resource_bytes':
                case 'filename':
                case 'asset_family':
                case 'asset_meta_key':
                case 'output_mode':
                case 'filepath':
                case 'file_ext':
                case 'raw_output_mode':
                case 'url':
                case 'meta_path':
                case 'datecreated':

                    //error_log(__LINE__ . ' rrs map WRITING [' . $attribute . '] FOR [' . $tmp_ugc . ']. $data[' . $data . ']. cache_ARRAY['. print_r(self::$cache_ARRAY, true) . '].');

                    // [Sat Apr 22 14:52:17.272704 2023] [:error] [pid 48777] [client 172.16.225.1:64470] 4016 rrs map
                    // WRITING [filename] FOR [crnrstn_logo_lg]. $data[crnrstn_logo_lg]. cache_ARRAY[Array\n(\n)\n].
                    $data_str_cum = $data; // THIS SHOULD BE ALL DATA TO GO TO SESSION, RUNTIME...;

                    //
                    // CHANNEL INITIALIZATION.
                    if(!isset($channel)){

                        //error_log(__LINE__ . ' rrs map $data_str_cum[' . $data_str_cum . ']. cache_ARRAY['. print_r(self::$cache_ARRAY, true) . '].');

                        //
                        // ALL ACTIVE CHANNELS WITH BYTE CAPACITY RETURNED.
                        // TODO :: WE SHOULD BE ABLE TO BATCH SOME...IF NOT ALL OF THE NEW_BYTE AUTHORIZATION CALLS.
                        $tmp_auth_channel_ARRAY = $this->new_cache_bytes($data_str_cum, $tmp_ugc, $data_type_family, $channel_override);
                        //error_log(__LINE__ . ' rrs map $data_str_cum[' . $data_str_cum . ']. $tmp_auth_channel_ARRAY[' . print_r($tmp_auth_channel_ARRAY, true) . ']. cache_ARRAY['. print_r(self::$cache_ARRAY, true) . '].');

                        //die();

                    }else{

                        $tmp_auth_channel_ARRAY = array();

                        if(strlen($channel) > 0){
                            //$attribute, $data, $channel = NULL, $salt_ugc_override
                            //$attribute[resource_bytes]. $data[0]. $channel[runtime]
                            //error_log(__LINE__ . ' rrs CALC BYTE PERMISSIONS. $attribute[' . $attribute . ']. $data[' . $data . ']. $channel[' . $channel . ']. $data_str_cum[' . $data_str_cum . ']. cache_ARRAY['. print_r(self::$cache_ARRAY, true) . '].');
                            //[Wed Apr 19 13:51:30.952362 2023] [:error] [pid 12549] [client 172.16.225.1:61853] 4645 rrs CALC BYTE PERMISSIONS. $attribute[resource_bytes]. $data[9]. $channel[runtime]. $data_str_cum[9]. cache_ARRAY[Array\n(\n    [4oUYolySUV1D6sPCIsuMsZxvx59VBYXbpOQkf4oetZCnCIXblpNiGgRxJQCoW3l2] => Array\n        (\n            [cache_id] => Array\n                (\n                    [sprite_hq] => 0\n                )\n\n            [ipaddress_id] => Array\n                (\n                    [172.16.225.1] => 0\n                )\n\n        )\n\n)\n].

                            //die();
                            $tmp_auth_channel_ARRAY = $this->new_cache_bytes($data_str_cum, $tmp_ugc, $data_type_family, $channel_override);
                            //error_log(__LINE__ . ' rrs map $tmp_cache_id[' . $data . ']. cache_ARRAY['. print_r(self::$cache_ARRAY, true) . '].');

                        }

                    }

                    //
                    // INITIALIZE CACHE DATA IN ALL ACTIVE CHANNELS.
                    foreach($tmp_auth_channel_ARRAY as $chnl_index => $channel){

                        switch($channel){
                            case CRNRSTN_CHANNEL_SESSION:
                                //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

                                $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'][$attribute][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$tmp_ugc]] = $data;

                            break;
                            case CRNRSTN_CHANNEL_RUNTIME:
                                //R :: RUNTIME.
                            case CRNRSTN_CHANNEL_POST:
                                //P :: HTTP $_POST REQUEST.
                            case CRNRSTN_CHANNEL_GET:
                                //G :: HTTP $_GET REQUEST.
                            case CRNRSTN_CHANNEL_SOAP:
                                //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                            case CRNRSTN_CHANNEL_DATABASE:
                                //D :: DATABASE (MySQLi CONNECTION).
                            case CRNRSTN_CHANNEL_COOKIE:
                                //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
                            case CRNRSTN_CHANNEL_PSSDTLA:
                                //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                            case CRNRSTN_CHANNEL_SSDTLA:
                                //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).

                                self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$tmp_ugc]] = $data;

                            break;
                            default:

                                error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                            break;

                        }

                    }

                break;
                case 'createdby_client_ip':
                case 'modifiedby_client_ip':

                    //error_log(__LINE__ . ' rrs map WRITING [' . $attribute . '] FOR [' . $tmp_ugc . ']. $data[' . $data . ']. cache_ARRAY['. print_r(self::$cache_ARRAY, true) . '].');

                    $data_str_cum = $data; // THIS SHOULD BE ALL DATA TO GO TO SESSION, RUNTIME...;

                    //
                    // CHANNEL INITIALIZATION.
                    if(!isset($channel)){

                        //error_log(__LINE__ . ' rrs map $data_str_cum[' . $data_str_cum . ']. cache_ARRAY['. print_r(self::$cache_ARRAY, true) . '].');

                        //
                        // ALL ACTIVE CHANNELS WITH BYTE CAPACITY RETURNED.
                        // TODO :: WE SHOULD BE ABLE TO BATCH SOME...IF NOT ALL OF THE NEW_BYTE AUTHORIZATION CALLS.
                        $tmp_auth_channel_ARRAY = $this->new_cache_bytes($data_str_cum, $tmp_ugc);
                        //error_log(__LINE__ . ' rrs map $data_str_cum[' . $data_str_cum . ']. $tmp_auth_channel_ARRAY[' . print_r($tmp_auth_channel_ARRAY, true) . ']. cache_ARRAY['. print_r(self::$cache_ARRAY, true) . '].');

                    }else{

                        $tmp_auth_channel_ARRAY = array();

                        if(strlen($channel) > 0){

                            $tmp_auth_channel_ARRAY = $this->new_cache_bytes($data_str_cum, $channel, $tmp_ugc);
                            //error_log(__LINE__ . ' rrs map $tmp_cache_id[' . $data . ']. cache_ARRAY['. print_r(self::$cache_ARRAY, true) . '].');

                        }

                    }

                    //
                    // MULTI-CHANNEL WRITE OF CRNRSTN :: PLAID DATA TO ALL ACTIVE CHANNELS.
                    foreach($tmp_auth_channel_ARRAY as $chnl_index => $channel){

                        switch($channel){
                            case CRNRSTN_CHANNEL_SESSION:
                                //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

                                $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'][$attribute][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$tmp_ugc]] = $this->get_cache('ipaddress_id', $tmp_ugc,'session');

                            break;
                            case CRNRSTN_CHANNEL_RUNTIME:
                                //R :: RUNTIME.
                            case CRNRSTN_CHANNEL_POST:
                                //P :: HTTP $_POST REQUEST.
                            case CRNRSTN_CHANNEL_GET:
                                //G :: HTTP $_GET REQUEST.
                            case CRNRSTN_CHANNEL_SOAP:
                                //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                            case CRNRSTN_CHANNEL_DATABASE:
                                //D :: DATABASE (MySQLi CONNECTION).
                            case CRNRSTN_CHANNEL_COOKIE:
                                //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
                            case CRNRSTN_CHANNEL_PSSDTLA:
                                //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                            case CRNRSTN_CHANNEL_SSDTLA:
                                //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).

                                if(isset(self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$tmp_ugc])){

                                    self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$tmp_ugc]] = $this->get_cache('ipaddress_id', $tmp_ugc);

                                }

                            break;
                            default:

                                error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                            break;

                        }

                    }

                break;
                case 'lastmodified':

                    //error_log(__LINE__ . ' rrs map WRITING [' . $attribute . '] FOR [' . $tmp_ugc . ']. $data[' . $data . ']. cache_ARRAY['. print_r(self::$cache_ARRAY, true) . '].');

                    $data_str_cum = $data; // THIS SHOULD BE ALL DATA TO GO TO SESSION, RUNTIME...;

                    //
                    // CHANNEL INITIALIZATION.
                    if(!isset($channel)){

                        //
                        // ALL ACTIVE CHANNELS WITH BYTE CAPACITY RETURNED.
                        // TODO :: WE SHOULD BE ABLE TO BATCH SOME...IF NOT ALL OF THE NEW_BYTE AUTHORIZATION CALLS.
                        $tmp_auth_channel_ARRAY = $this->new_cache_bytes($data_str_cum, $tmp_ugc, $data_type_family, $channel_override);

                    }else{

                        $tmp_auth_channel_ARRAY = array();

                        if(strlen($channel) > 0){

                            $tmp_auth_channel_ARRAY = $this->new_cache_bytes($data_str_cum, $tmp_ugc, $data_type_family, $channel_override);

                        }

                    }

                    //
                    // INITIALIZE CACHE DATA IN ALL ACTIVE CHANNELS.
                    foreach($tmp_auth_channel_ARRAY as $chnl_index => $channel){

                        switch($channel){
                            case CRNRSTN_CHANNEL_SESSION:
                                //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

                                $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'][$attribute][$_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP']['cache_id'][$tmp_ugc]][] = $data;

                            break;
                            case CRNRSTN_CHANNEL_RUNTIME:
                                //R :: RUNTIME.
                            case CRNRSTN_CHANNEL_POST:
                                //P :: HTTP $_POST REQUEST.
                            case CRNRSTN_CHANNEL_GET:
                                //G :: HTTP $_GET REQUEST.
                            case CRNRSTN_CHANNEL_SOAP:
                                //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                            case CRNRSTN_CHANNEL_DATABASE:
                                //D :: DATABASE (MySQLi CONNECTION).
                            case CRNRSTN_CHANNEL_COOKIE:
                                //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
                            case CRNRSTN_CHANNEL_PSSDTLA:
                                //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                            case CRNRSTN_CHANNEL_SSDTLA:
                                //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).

                                self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute][self::$cache_ARRAY[$this->oCRNRSTN->request_id]['cache_id'][$tmp_ugc]][] = $data;

                            break;
                            default:

                                error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                            break;

                        }

                    }

                break;
                case 'total_bytes':

                    //error_log(__LINE__ . ' rrs map WRITING [' . $attribute . '] FOR [' . $tmp_ugc . ']. $data[' . $data . ']. cache_ARRAY['. print_r(self::$cache_ARRAY, true) . '].');

                    $data_str_cum = $data; // THIS SHOULD BE ALL DATA TO GO TO SESSION, RUNTIME...;

                    //
                    // CHANNEL INITIALIZATION.
                    if(!isset($channel)){

                        //error_log(__LINE__ . ' rrs map $data_str_cum[' . $data_str_cum . ']. cache_ARRAY['. print_r(self::$cache_ARRAY, true) . '].');

                        //
                        // ALL ACTIVE CHANNELS WITH BYTE CAPACITY RETURNED.
                        // TODO :: WE SHOULD BE ABLE TO BATCH SOME...IF NOT ALL OF THE NEW_BYTE AUTHORIZATION CALLS.
                        $tmp_auth_channel_ARRAY = $this->new_cache_bytes($data_str_cum, $tmp_ugc);
                        //error_log(__LINE__ . ' rrs map $data_str_cum[' . $data_str_cum . ']. $tmp_auth_channel_ARRAY[' . print_r($tmp_auth_channel_ARRAY, true) . ']. cache_ARRAY['. print_r(self::$cache_ARRAY, true) . '].');

                    }else{

                        $tmp_auth_channel_ARRAY = array();

                        if(strlen($channel) > 0){
                            //$attribute, $data, $channel = NULL, $salt_ugc_override
                            //$attribute[resource_bytes]. $data[0]. $channel[runtime]
                            //error_log(__LINE__ . ' rrs CALC BYTE PERMISSIONS. $attribute[' . $attribute . ']. $data[' . $data . ']. $channel[' . $channel . ']. $data_str_cum[' . $data_str_cum . ']. cache_ARRAY['. print_r(self::$cache_ARRAY, true) . '].');
                            //[Wed Apr 19 13:51:30.952362 2023] [:error] [pid 12549] [client 172.16.225.1:61853] 4645 rrs CALC BYTE PERMISSIONS. $attribute[resource_bytes]. $data[9]. $channel[runtime]. $data_str_cum[9]. cache_ARRAY[Array\n(\n    [4oUYolySUV1D6sPCIsuMsZxvx59VBYXbpOQkf4oetZCnCIXblpNiGgRxJQCoW3l2] => Array\n        (\n            [cache_id] => Array\n                (\n                    [sprite_hq] => 0\n                )\n\n            [ipaddress_id] => Array\n                (\n                    [172.16.225.1] => 0\n                )\n\n        )\n\n)\n].

                            //die();
                            $tmp_auth_channel_ARRAY = $this->new_cache_bytes($data_str_cum, $tmp_ugc, $channel);
                            //error_log(__LINE__ . ' rrs map $tmp_cache_id[' . $data . ']. cache_ARRAY['. print_r(self::$cache_ARRAY, true) . '].');

                        }

                    }

                    //
                    // INITIALIZE CACHE DATA IN ALL ACTIVE CHANNELS.
                    foreach($tmp_auth_channel_ARRAY as $chnl_index => $channel){

                        switch($channel){
                            case CRNRSTN_CHANNEL_POST:
                                //P :: HTTP $_POST REQUEST.
                            case CRNRSTN_CHANNEL_GET:
                                //G :: HTTP $_GET REQUEST.
                            case CRNRSTN_CHANNEL_SOAP:
                                //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                            case CRNRSTN_CHANNEL_DATABASE:
                                //D :: DATABASE (MySQLi CONNECTION).
                            case CRNRSTN_CHANNEL_COOKIE:
                                //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
                            case CRNRSTN_CHANNEL_PSSDTLA:
                                //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                            case CRNRSTN_CHANNEL_SSDTLA:
                                //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).

                            break;
                            case CRNRSTN_CHANNEL_RUNTIME:
                                //R :: RUNTIME.
                                self::$cache_ARRAY[$this->oCRNRSTN->request_id][$attribute] = $data;

                            break;
                            case CRNRSTN_CHANNEL_SESSION:
                                //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).

                                $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'][$attribute] = $data;

                            break;
                            default:

                                error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                            break;

                        }

                    }

                break;

                //
                // PERFORMANCE REPORTING
                case '__report_datecreated':
                case '___report_runtime':
                case '___report_filename':

                break;
                default:

                    error_log(__LINE__ . ' rrs map DEFAULT [UNHANDLED CASE] $attribute[' . $attribute . ']. $data[' . $data . ']. die().');

                    //
                    // NOTE: RESOURCE_ID IS ONLY FOR RUNTIME REFERENCE.

                    //error_log(__LINE__ . ' rrs map $ugc_value[' . $ugc_value . ']. $cache_resource_id[' . $cache_resource_id . ']. $resource_id[' . self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$ugc_value] . '].');
                    //error_log(__LINE__ . ' rrs map $cache_rrs_map_filename_ARRAY[' . print_r(self::$cache_rrs_map_filename_ARRAY, true) . '].');
                    error_log(__LINE__ . ' rrs map self::$request_asset_meta_key_ARRAY[' . print_r(self::$request_asset_meta_key_ARRAY,true) . '].');

                    //$cache_merge_ARRAY[$this->oCRNRSTN->request_id]['rrs_map_output_method'][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$ugc_value]] = $this->cache_input_control(self::$cache_rrs_map_output_method_ARRAY, $channel, 'rrs_map_output_method', self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$ugc_value]);

                break;

            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        /*
        - CSS 3RD PARTY
        ===========
        [cache_id]       { jquery-ui-1.13.2/jquery-ui.theme.css }
        [ipaddress_id]
        [rrs_map_filename]
        [rrs_map_file_extension]
        [rrs_map_filepath]
        [asset_meta_path]
        [request_family]
        [asset_meta_key]
        [raw_output_mode]
        [output_mode]
        [resource_bytes]
        ===========
        [cache_id]       { 960_24_col.css }
        [ipaddress_id]
        [rrs_map_filename]
        [rrs_map_file_extension]
        [rrs_map_filepath]
        [asset_meta_path]
        [request_family]
        [asset_meta_key]
        [raw_output_mode]
        [output_mode]
        [resource_bytes]
        ===========

        - JS 3RD PARTY
        ===========
        [cache_id]       { accordion.js }
        [ipaddress_id]
        [rrs_map_filename]
        [rrs_map_file_extension]
        [rrs_map_filepath
        [asset_meta_path]
        [request_family]
        [asset_meta_key]
        [raw_output_mode]
        [output_mode]
        [resource_bytes]
        ===========

        - CSS CRNRSTN ::
        ===========
        [cache_id]       { crnrstn.main_desktop.css }
        [ipaddress_id]
        [rrs_map_filename]
        [rrs_map_file_extension]
        [rrs_map_filepath]
        [asset_meta_path]
        [request_family]
        [asset_meta_key]
        [raw_output_mode]
        [output_mode]
        [resource_bytes]
        ===========

        - JS CRNRSTN ::
        ===========
        [cache_id]       { crnrstn.main.js }
        [ipaddress_id]
        [rrs_map_filename]
        ****[file_extension]
        ****[filepath]
        ****[image_string]
        ****[asset_meta_path]
        [request_family]
        [asset_meta_key]
        ****[raw_output_mode]
        ****[output_mode]
        [resource_bytes]
        ===========

        - SYSTEM IMAGE
        ===========
        [cache_id]       { j5_wolf_pup_stand_look_up }
        [ipaddress_id]
        [filename]
        [file_extension]
        [filepath]
        [request_family]
        [asset_meta_key]
        [raw_output_mode]
        [output_mode]
        [resource_bytes]
        --
        [cache_id] => Array\n                (\n                    [j5_wolf_pup_sit_look_right_longshadow] => 0\n                )\n\n
        [ipaddress_id] => Array\n                (\n                    [172.16.225.1] => 0\n                )\n\n
        [resource_bytes] => Array\n                (\n                    [0] => 1335\n                )\n\n
        [filename] => Array\n                (\n                    [0] => j5_wolf_pup_sit_look_right_longshadow\n                )\n\n
        [request_family] => Array\n                (\n                    [0] => system\n                )\n\n
        [asset_meta_key] => Array\n                (\n                    [0] => J5_WOLF_PUP_SIT_LOOK_RIGHT_LONGSHADOW\n                )\n\n
        [datecreated] => Array\n                (\n                    [0] => 1681956112\n                )\n\n
        [createdby_client_ip] => Array\n                (\n                    [0] => 172.16.225.1\n                )\n\n
        [lastmodified] => Array\n                (\n                    [0] => 1681956112\n                )\n\n
        [modifiedby_client_ip] => Array\n                (\n                    [0] => 172.16.225.1\n                )\n\n
        [raw_output_mode] => Array\n                (\n                    [0] => 7217\n                )\n\n
        [filepath] => Array\n                (\n                    [0] => /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/ui/imgs/png/system/j5_wolf_pup_sit_look_right_longshadow.png\n                )\n\n
        [file_extension] => Array\n                (\n                    [0] => png\n                )\n\n        )\n\n)\n].

        ===========
        [cache_id]       { j5_wolf_pup_sit_look_right_longshadow }
        [ipaddress_id]
        [rrs_map_filename]
        [rrs_map_file_extension]
        [rrs_map_url]                       *MISSING
        [rrs_map_filepath]
        [request_family]
        [asset_meta_key]
        [raw_output_mode]       7217
        [output_mode]           7217
        [resource_bytes]
        //////////
        j5_wolf_pup_sit_look_right_longshadow
        return_creative('J5_WOLF_PUP_SIT_LOOK_RIGHT_LONGSHADOW', CRNRSTN_HTML)

        [cache_id]
        [ipaddress_id]
        [rrs_map_filename]
        [rrs_map_file_extension]
        [rrs_map_url]                       *MISSING
        [rrs_map_filepath]                  *MISSING
        [rrs_map_image_string]              *DELETE
        [asset_meta_path]                   *DELETE
        [request_family]
        [asset_meta_key]
        [raw_output_mode]   7217
        [output_mode]       7213     <-- NEEDS TO BE IGNORED OR...
        [resource_bytes]

        //////////
        ===========
        [cache_id]       { crnrstn_logo_social_preview_github_00 }
        [ipaddress_id]
        [rrs_map_filename]
        [rrs_map_file_extension]
        [rrs_map_filepath]
        [request_family]
        [asset_meta_key]
        [raw_output_mode]
        [output_mode]
        [resource_bytes]
        ===========
        //////////
        crnrstn_logo_social_preview_github_00
        return_creative('SOCIAL_META_PREVIEW', CRNRSTN_HTML);
        --
        [cache_id]
        [ipaddress_id]
        [rrs_map_filename]
        [rrs_map_file_extension]
        [rrs_map_filepath]                  *MISSING
        [rrs_map_image_string]              *DELETE
        [asset_meta_path]                   *DELETE
        [request_family]
        [asset_meta_key]
        [raw_output_mode]   7217
        [output_mode]       7213    <-- NEEDS TO BE IGNORED OR...
        [resource_bytes]
        //////////

        - SOCIAL IMAGE
        ===========
        [cache_id]       { sprite_hq }
        [ipaddress_id]
        [filename]
        ---[rrs_map_file_extension]
        ---[rrs_map_filepath]
        [request_family]
        [asset_meta_key]
        [raw_output_mode]
        ---[output_mode]
        [resource_bytes]

        [Wed Apr 19 17:08:56.751558 2023] [:error] [pid 12546] [client 172.16.225.1:65400] 5894 rrs map CACHE INIT
        [cache_id] =>               [sprite_hq] => 0\n                )\n\n
        [ipaddress_id] =>           [172.16.225.1] => 0\n                )\n\n
        [resource_bytes] =>         [0] => 8\n                )\n\n
        [filename] =>               [0] => sprite_hq\n                )\n\n
        [request_family] =>         [0] => social\n                )\n\n
        [asset_meta_key] =>      [0] => SOCIAL_SPRITE_HQ\n                )\n\n
        [datecreated] =>            [0] => 1681938536\n                )\n\n
        [createdby_client_ip] => Array\n                (\n                    [0] => 172.16.225.1\n                )\n\n            [lastmodified] => Array\n                (\n                    [0] => 1681938536\n                )\n\n            [modifiedby_client_ip] => Array\n                (\n                    [0] => 172.16.225.1\n                )\n\n
        [raw_output_mode] =>        [0] => 7217\n                )\n\n        )\n\n)\n].



        ===========

        - FAVICON
        ===========
        [cache_id]       { crnrstn/favicon }
        [ipaddress_id]
        [filename]
        [file_ext]
        [filepath]
        [request_family]
        [asset_meta_key]
        [raw_output_mode]
        [output_mode]
        [resource_bytes]
        ===========

        [Mon Apr 17 02:17:04.342213 2023] [:error] [pid 21669] [client 172.16.225.1:59405] 601 rrs map
        RUNTIME EXTRACTED FOR MERGE INTO SESSION.
        #WINNING_ARRAY[
            Array\n(\n
                [GJi56e0reAnFLkSacbywXMQVqkgeTMpDjTv1s345xg07rUQvhoSHd04GNP8I7RXN] =>
                    Array\n        (\n
                        [cache_id] => Array\n                (\n [crnrstn.main_desktop.css] => 0\n   )\n\n
                        [ipaddress_id] => Array\n               (\n [172.16.225.1] => 0\n               )\n\n
                        [rrs_map_filename] => Array\n           (\n [0] => crnrstn.main_desktop.css\n   )\n\n
                        [rrs_map_file_extension] => Array\n     (\n [0] => css\n                        )\n\n
                        [rrs_map_filepath] =>   Array\n         (\n [0] => /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/ui/css/crnrstn.main_desktop.css\n    )\n\n
                        [asset_meta_path] =>  Array\n           (\n [0] => /\n                          )\n\n
                        [request_family] =>  Array\n            (\n [0] => css\n                        )\n\n
                        [asset_meta_key] =>    Array\n       (\n [0] => 7207\n                       )\n\n
                        [raw_output_mode] => Array\n            (\n [0] => 7207\n                       )\n\n
                        [output_mode] => Array\n                (\n [0] => 7207\n                       )\n\n
                        [resource_bytes] => Array\n             (\n [0] => 67\n                         )\n\n
                        [datecreated] => Array\n                (\n [0] => 1681712224\n                 )\n\n
                        [createdby_client_ip] => Array\n        (\n [0] => 0\n                          )\n\n
                        [lastmodified] => Array\n               (\n [0] => 1681712224\n                 )\n\n
                        [modifiedby_client_ip] => Array\n       (\n [0] => 0\n                          )\n\n)\n\n)\n].

        */

    }

    public function rrs_map_data_cache_return($name, $output_mode = NULL, $filename = NULL, $asset_family = NULL, $response_serial = NULL){

        //
        // RETURN SESSION RRS MAP APPLICATION ACCELERATION CACHE.
        if($name == 'session_cache' && self::$session_cache_is_active == true && isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'])){

            return $_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()]['RRS_MAP'];

        }

        error_log(__LINE__ . ' rrs map RETURN CACHE NOW. $name[' . $name . ']. $output_mode[' . $output_mode . ']. $filename[' . $filename . ']. $asset_family[' . $asset_family . ']. $response_serial[' . $response_serial . '].');

//        //
//        // CHECK FOR BASE64. TURNED OFF FOR A SEC...
//        if(isset(self::$cache_rrs_map_filepath_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]]['filepath_base64'])){
//
//            //
//            // BUILD AND RETURN BASE64 HTML STRING FROM CACHE.
//            $tmp_image_html_str = self::$cache_rrs_map_image_string_ARRAY[$this->oCRNRSTN->request_id][$output_mode][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]];        //$this->return_response_map_ugc_value()
//            //$tmp_filepath = self::$cache_rrs_map_filepath_ARRAY[$this->oCRNRSTN->request_id][$response_serial]['filepath_base64'];
//            $tmp_filepath = self::$cache_rrs_map_filepath_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]]['filepath_base64'];
//
//            //
//            // LOAD BASE64 FILE.
//            include($tmp_filepath);
//
//        }
//
//        //
//        // CONFIRM BASE64 INCLUDE.
//        if(isset($system_file_serial)){
//
//            $tmp_base64_str = self::$image_filesystem_meta_ARRAY[self::$image_output_mode][self::$request_salt][$system_file_serial]['base64'];
//
//            error_log(__LINE__ . ' rrs map base64 returning $tmp_image_html_str[' . $tmp_image_html_str . ']. $tmp_str[' . $tmp_base64_str . ']. die();');
//
//            die();
//
//        }

        //
        // ATTRIBUTE FOCUSED DATA RETURN.
        $tmp_output = '';

        switch($name){
            case 'return_image_html_wrapped_image_base64':

                error_log(__LINE__ . ' rrs map self::$cache_rrs_map_filepath_ARRAY[' . print_r(self::$cache_rrs_map_filepath_ARRAY, true) . '].');
                die();

                //
                // $output_method = 'return_image_html_wrapped_image_base64'
                // $param0 = $filepath_base64
                // $param1 = $width
                // $param2 = $height
                // $param3 = $alt
                // $param4 = $title
                // $param5 = $link
                // $param6 = $target
                // $param7 = $asset_family
                // $param8 = $output_mode
                // $param9 = $asset_mapping_mode
                // *$param10 = $image_cache_string
                //
                // * where, $image_cache_string = '<img src="{CRNRSTN_SYS_BASE64}" ' . $tmp_width . $tmp_height . $tmp_alt . $tmp_title . '>';

                //self::$cache_rrs_map_output_method_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_serial] = $output_method;
                //self::$cache_rrs_map_filepath_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_serial]['filepath_base64'] = $param0;
                //self::$cache_rrs_map_image_string_ARRAY[$this->oCRNRSTN->request_id][$tmp_response_serial]['image_string'] = $param10;

            break;
            case 'filepath':

                $tmp_output = self::$cache_rrs_map_filepath_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]];

            break;
            case 'filename':

                $tmp_output = self::$cache_rrs_map_filename_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]];

            break;
            case 'file_ext':

                if(isset(self::$cache_rrs_map_file_extension_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]])){

                    $tmp_output = self::$cache_rrs_map_file_extension_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]];

                }

            break;
            default:

                if(isset($filename)){

                    $this->oCRNRSTN->error_log('Unable to locate RRS Map cache for file [' . $filename . ']. ', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);

                }else{

                    $this->oCRNRSTN->error_log('Unknown parameter name [' . $name . '] provided. Unable to return data value.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);
                    error_log(__LINE__ . ' rrs map ' . __METHOD__ . ' Unknown parameter name [' . $name . '] provided. Unable to return data value.');
                }

            break;

        }

        return $tmp_output;

    }

    private function return_plaid_cache_ARRAY($ugc_key, $channel){

        //
        // BUILD RESOURCE CACHE DATA ARRAY.
        $tmp_ARRAY = array();

        foreach(self::$channel_ARRAY as $index => $channel){
            /*
            CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA
            OBJECT (DDO) SERVICES LAYER AUTHORIZATION
            PROFILES FOR DATA HANDLING.
            -----
            CRNRSTN_CHANNEL_ALL
            CRNRSTN_CHANNEL_GET
            CRNRSTN_CHANNEL_POST
            CRNRSTN_CHANNEL_COOKIE
            CRNRSTN_CHANNEL_SESSION
            CRNRSTN_CHANNEL_DATABASE
            CRNRSTN_CHANNEL_SSDTLA
            CRNRSTN_CHANNEL_PSSDTLA
            CRNRSTN_CHANNEL_RUNTIME
            CRNRSTN_CHANNEL_SOAP
            CRNRSTN_CHANNEL_FILE

            */

            switch($channel){
                case CRNRSTN_CHANNEL_SESSION:
                    //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).
                case CRNRSTN_CHANNEL_RUNTIME:
                    //R :: RUNTIME.

                    $tmp_ARRAY['filename'] = $this->get_cache('filename', $ugc_key, $channel);

                    if(strlen($tmp_ARRAY['filename']) > 0){

                        //
                        // OK TO EXTRACT REMAINING DATA FROM CHANNEL.
                        $tmp_ARRAY['asset_family'] = $this->get_cache('asset_family', $ugc_key, $channel);
                        $tmp_ARRAY['asset_meta_key'] = $this->get_cache('asset_meta_key', $ugc_key, $channel);
                        $tmp_ARRAY['output_mode'] = $this->get_cache('output_mode', $ugc_key, $channel);
                        $tmp_ARRAY['filepath'] = $this->get_cache('filepath', $ugc_key, $channel);
                        $tmp_ARRAY['file_ext'] = $this->get_cache('file_ext', $ugc_key, $channel);
                        $tmp_ARRAY['resource_bytes'] = $this->get_cache('resource_bytes', $ugc_key, $channel);
                        $tmp_ARRAY['datecreated'] = $this->get_cache('datecreated', $ugc_key, $channel);
                        $tmp_ARRAY['createdby_client_ip'] = $this->get_cache('createdby_client_ip', $ugc_key, $channel);
                        $tmp_ARRAY['lastmodified'] = $this->get_cache('lastmodified', $ugc_key, $channel);
                        $tmp_ARRAY['modifiedby_client_ip'] = $this->get_cache('modifiedby_client_ip', $ugc_key, $channel);
                        $tmp_ARRAY['source_channel'] = $channel;

                    }

                break;
                case CRNRSTN_CHANNEL_DATABASE:
                    //D :: DATABASE (MySQLi CONNECTION).

                    // STRAIGHT-LINE TO GLOBAL EXECUTION TIME.
                    // 1) IF YOU BUILD A CACHE TABLE,
                    // 2) ALL THE PLAID LINKS WILL JUST WORK.
                    // 3) A NEW METHOD. TAKE ANY FOLDER PATH AND PUSH *ALL* [PDF,XLS,XLSX,ZIP,TIF,GIF,PNG,JPG,ETC...]
                    //    ASSETS TO THIS TABLE FOR CRNRSTN :: PLAID MAPPING 0-100 REAL QUICK.

                break;
                case CRNRSTN_CHANNEL_POST:
                    //P :: HTTP $_POST REQUEST.
                case CRNRSTN_CHANNEL_GET:
                    //G :: HTTP $_GET REQUEST.
                case CRNRSTN_CHANNEL_SOAP:
                    //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                case CRNRSTN_CHANNEL_COOKIE:
                    //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
                case CRNRSTN_CHANNEL_PSSDTLA:
                    //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                case CRNRSTN_CHANNEL_SSDTLA:
                    //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).
                case CRNRSTN_CHANNEL_FILE:
                    //F :: SERVER LOCAL FILE SYSTEM.
                break;
                default:

                    error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                break;

            }

        }

        return $tmp_ARRAY;

    }

    public function meta_default_override(&$cache_meta_ARRAY, $override_index, $default_index){

        $cache_meta_ARRAY[$default_index] = '';

        if(isset($this->oCRNRSTN->cache_meta_ARRAY[$override_index])){

            if(strlen($this->oCRNRSTN->cache_meta_ARRAY[$override_index]) > 0){

                $cache_meta_ARRAY[$default_index] = $this->oCRNRSTN->cache_meta_ARRAY[$override_index];

            }
//            else{
//
//                if(isset($this->oCRNRSTN->cache_meta_ARRAY[$default_index])){
//
//                    if(strlen($this->oCRNRSTN->cache_meta_ARRAY[$default_index]) > 0){
//
//                        $cache_meta_ARRAY[$default_index] = $this->oCRNRSTN->cache_meta_ARRAY[$default_index];
//
//                    }
//
//                }
//
//            }

        }else{

            if(isset($this->oCRNRSTN->cache_meta_ARRAY[$default_index])){

                if(strlen($this->oCRNRSTN->cache_meta_ARRAY[$default_index]) > 0){

                    $cache_meta_ARRAY[$default_index] = $this->oCRNRSTN->cache_meta_ARRAY[$default_index];

                }

            }

        }

    }

//    public function spooled_response_output(){
//
//        switch(self::$request_family_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]]){
//            case 'module_key':
//
//                error_log(__LINE__ . ' rrs map is preventing asset return to allow support for deep link.');
//
//                //
//                // TRUE ALLOWS THE PAGE TO CONTINUE TO LOAD SO THAT HTML INJECTABLE MODULE CONTENT CAN BE ASSEMBLED IN THE FOOTER.
//                return true;
//
//            break;
//            default:
//
//                error_log(__LINE__ . ' rrs map is allowing for processing of asset return.');
//                return false;
//
//            break;
//
//        }
//
//    }

    public function base64_output_mode_conversion(&$output_mode_override){

        switch($output_mode_override){
            case CRNRSTN_UI_SOAP_DATA_TUNNEL:

                //
                // CONFIGURATION ERROR DURING SOAP TUNNEL.
                //error_log(__LINE__ . ' rrs map $output_mode_override[' . $output_mode_override . '].');

            break;
            case CRNRSTN_STRING:
            case CRNRSTN_PNG:
            case CRNRSTN_ASSET_MODE_PNG:

                $output_mode_override = CRNRSTN_BASE64_PNG;
                //error_log(__LINE__ . ' rrs map NEW BASE64 MODE $output_mode_override[' . $output_mode_override . '].');

            break;
            case CRNRSTN_GIF:

                $output_mode_override = CRNRSTN_BASE64_GIF;

            break;
            case CRNRSTN_JPEG:
            case CRNRSTN_ASSET_MODE_JPEG:

                $output_mode_override = CRNRSTN_BASE64_JPEG;

            break;
            case CRNRSTN_HTML:
            case CRNRSTN_HTML & CRNRSTN_PNG:

                $output_mode_override = CRNRSTN_HTML & CRNRSTN_BASE64_PNG;
                //error_log(__LINE__ . ' rrs map NEW BASE64 MODE $output_mode_override[' . $output_mode_override . '].');

            break;
            case CRNRSTN_HTML & CRNRSTN_JPEG:

                $output_mode_override = CRNRSTN_HTML & CRNRSTN_BASE64_JPEG;

            break;
            case CRNRSTN_HTML & CRNRSTN_GIF:

                $output_mode_override = CRNRSTN_HTML & CRNRSTN_BASE64_GIF;

            break;
            default:

                error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

            break;

        }

    }

    private function filename_remove_directory_prefix(&$filename, $dir_family){

        /*
        //
        // REMOVE REDUNDANT DIRECTORY MENTION FROM FILE NAME/UGC.
        WHERE,
        $salt_ugc/$filename         = system/filename.png
        $dir_family$dir_family      = system

        */

        //
        // LEFT TRIM THE DIRECTORY NAME FROM THE FILENAME.
        $filename = ltrim($filename, $dir_family);

        //
        // REMOVE ANY LEADING DIRECTORY SEPARATORS.
        $filename = ltrim($filename, DIRECTORY_SEPARATOR);

    }

    public function to_plaid($channel, $salt_ugc, $crnrstn_asset_family, $asset_meta_key = NULL, $output_mode_override = NULL, $source = '$_GET[]'){

        //error_log(__LINE__ . ' rrs map $channel[' . $channel . ']. $salt_ugc[' . $salt_ugc . ']. $crnrstn_asset_family[' . $crnrstn_asset_family . ']. $asset_meta_key[' . $asset_meta_key . ']. $output_mode_override[' . $output_mode_override . ']. $source[' . $source . '].');

        /*
        Saturday April 22, 2023 @ 0619 hrs
        DEFINITIONS OF INTEGER CONSTANTS AND DEFINITIONS OF
        RECOGNIZED COMBINATIONS OF THE SAME.

        CONFIGURATION:
        case 'CRNRSTN_IMG'                      : 7211;             RETURNS A GZIPPED (OPTIONALLY) PNG OR JPG FILE (*CONFIGURATION DRIVEN).
        case 'CRNRSTN_PNG'                      : 7812;             RETURNS A GZIPPED (OPTIONALLY) PNG FILE.
        case 'CRNRSTN_JPEG'                     : 7813;             RETURNS A GZIPPED (OPTIONALLY) JPG FILE.
        case 'CRNRSTN_BASE64_PNG'               : 7214;             RETURNS data:image/jpg;base64 STRING DATA.
        case 'CRNRSTN_BASE64_JPEG'              : 7215;             RETURNS data:image/jpg;base64 STRING DATA.
        case 'CRNRSTN_STRING'                   : 7216;             RETURNS PNG OR JPG (CONFIGURATION DRIVEN) IMAGE URL STRING DATA.
        case 'CRNRSTN_HTML'                     : 7217;             RETURNS PNG, JPG, OR BASE64 (CONFIGURATION DRIVEN) HTML WRAPPED <IMG> DATA.
        case 'CRNRSTN_ASSET_MODE_BASE64'        : 7510;             RETURNS data:image/png;base64 OR data:image/jpg;base64 (CONFIGURATION DRIVEN) STRING DATA.
        case 'CRNRSTN_ASSET_MODE_PNG'           : 7511;             RETURNS A GZIPPED (OPTIONALLY) RESPONSE WITH image/png CONTENT TYPE DATA.
        case 'CRNRSTN_ASSET_MODE_JPEG'          : 7512;             RETURNS A GZIPPED (OPTIONALLY) RESPONSE WITH image/jpg CONTENT TYPE DATA.
        case 'CRNRSTN_UI_SOAP_DATA_TUNNEL'      : 7210;             CRNRSTN :: SOAP SERVICES DATA TUNNEL LAYER - DATA TRANSLATION SUPPORT.
                    {barney}_{smaug}

        7184    CRNRSTN_HTML & CRNRSTN_ASSET_MODE_BASE64    RETURNS HTML <IMG> WRAPPED data:image/png;base64 OR data:image/jpg;base64 (CONFIGURATION DRIVEN) STRING DATA.
        7200    CRNRSTN_HTML & CRNRSTN_BASE64_PNG		    RETURNS HTML <IMG> WRAPPED data:image/png;base64 STRING DATA.
        7201    CRNRSTN_HTML & CRNRSTN_BASE64_JPEG		    RETURNS HTML <IMG> WRAPPED data:image/jpg;base64 STRING DATA.
        7168    CRNRSTN_HTML & CRNRSTN_PNG                  RETURNS HTML <IMG> WRAPPED PNG URL STRING DATA.
        7169    CRNRSTN_HTML & CRNRSTN_JPEG                 RETURNS HTML <IMG> WRAPPED JPEG URL STRING DATA.

        * CONFIGURATION DRIVEN:
          See $oCRNRSTN->config_init_system_resp_return_profile() in _crnrstn.config.inc.php.
          The default image compression format/mode (PNG, JPG, or BASE64) can be changed in
          the configuration file of CRNRSTN ::

        NOTE:
            AFFECTED CRNRSTN :: METHODS INCLUDE THE FOLLOWING:
            - public function return_branding_creative($strip_formatting = false, $output_mode = CRNRSTN_HTML)
            - public function return_system_image($system_asset_constant, $width = NULL, $height = NULL, $hyperlink = NULL, $alt = NULL, $title = NULL, $target = NULL, $output_mode = CRNRSTN_STRING, $url_params_ARRAY = NULL)
            - public function return_asset($media_element_key, $output_mode = NULL, $creative_mode = NULL)
            - public function return_creative($media_element_key, $output_mode = NULL, $creative_mode = NULL)
            - public function return_asset($media_element_key, $output_mode = NULL, $creative_mode = NULL)

        echo '[' . print_r(CRNRSTN_UI_SOAP_DATA_TUNNEL, true) . '] crnrstn <IMG> CRNRSTN_UI_SOAP_DATA_TUNNEL.<br>';
        echo '[' . print_r(CRNRSTN_IMG, true) . '] crnrstn <IMG> CRNRSTN_IMG.<br>';
        echo '[' . print_r(CRNRSTN_PNG, true) . '] crnrstn <IMG> CRNRSTN_PNG.<br>';
        echo '[' . print_r(CRNRSTN_JPEG, true) . '] crnrstn <IMG> CRNRSTN_JPEG.<br>';
        echo '[' . print_r(CRNRSTN_BASE64_PNG, true) . '] crnrstn <IMG> CRNRSTN_BASE64_PNG.<br>';
        echo '[' . print_r(CRNRSTN_BASE64_JPEG, true) . '] crnrstn <IMG> CRNRSTN_BASE64_JPEG.<br>';
        echo '[' . print_r(CRNRSTN_STRING, true) . '] crnrstn <IMG> CRNRSTN_STRING.<br>';
        echo '[' . print_r(CRNRSTN_HTML, true) . '] crnrstn <IMG> CRNRSTN_HTML.<br>';
        echo '[' . print_r(CRNRSTN_ASSET_MODE_BASE64, true) . '] crnrstn <IMG> CRNRSTN_ASSET_MODE_BASE64.<br>';
        echo '[' . print_r(CRNRSTN_ASSET_MODE_PNG, true) . '] crnrstn <IMG> CRNRSTN_ASSET_MODE_PNG.<br>';
        echo '[' . print_r(CRNRSTN_ASSET_MODE_JPEG, true) . '] crnrstn <IMG> CRNRSTN_ASSET_MODE_JPEG.<br>';
        echo '[' . print_r(CRNRSTN_HTML & CRNRSTN_ASSET_MODE_BASE64, true) . '] crnrstn <IMG> CRNRSTN_HTML & CRNRSTN_ASSET_MODE_BASE64.<br>';
        echo '[' . print_r(CRNRSTN_HTML & CRNRSTN_BASE64_PNG, true) . '] crnrstn <IMG> CRNRSTN_HTML & CRNRSTN_BASE64_PNG.<br>';
        echo '[' . print_r(CRNRSTN_HTML & CRNRSTN_BASE64_JPEG, true) . '] crnrstn <IMG> CRNRSTN_HTML & CRNRSTN_BASE64_JPEG.<br>';
        echo '[' . print_r(CRNRSTN_HTML & CRNRSTN_PNG, true) . '] crnrstn <IMG> CRNRSTN_HTML & CRNRSTN_PNG.<br>';
        echo '[' . print_r(CRNRSTN_HTML & CRNRSTN_JPEG, true) . '] crnrstn <IMG> CRNRSTN_HTML & CRNRSTN_JPEG.';

        */

        try{

            //
            // DO WE REQUIRE BASE64 CONVERSION FOR STATIC INTERSTITIAL SUPPORT?
            if($this->oCRNRSTN->is_system_terminate_enabled() == true){

                //error_log(__LINE__ . ' rrs map PRE-OUTPUT-MODE-CONVERSION $salt_ugc[' . $salt_ugc . ']. $output_mode_override[' . $output_mode_override . '].');
                $this->base64_output_mode_conversion($output_mode_override);
                //error_log(__LINE__ . ' rrs map POST-BASE64-CONVERSION [' . $output_mode_override . '].');

                //die();

            }

            $tmp_filepath = '';
            $tmp_cache_meta_ARRAY = array();
            //error_log(__LINE__ . ' rrs map[' . print_r($this->oCRNRSTN->cache_meta_ARRAY, true) . '].');

            //
            // SOMETIMES, WE USE THE DIRECTORY + THE FILE NAME TO ELIMINATE A DUPLICATE RRS MAP URI.
            // THIS ENABLES FOR A 1-TO-1 KEY-TO-RESOURCE RELATIONSHIP. HERE WE CHECK FOR DIRECTORY_SEPARATOR IN THE
            // FILENAME...AND MAKE ADJUSTMENTS TO ELIMINATE OCCURRENCES OF DUPLICATE DIRECTORY IN THE DIR_PATH.
            //
            // A DUAL KEY URI WOULD ELIMINATE THE NEED FOR THIS QUICK CHECK...BUT THE $_GET URL TO SAID RESOURCE WOULD
            // BE LONGER,...UGH.
            $pos_slash = strrpos($salt_ugc, DIRECTORY_SEPARATOR);
            if($pos_slash !== false){

                //
                // REMOVE REDUNDANT DIRECTORY MENTION FROM FILE NAME/UGC.
                $this->filename_remove_directory_prefix($salt_ugc, $crnrstn_asset_family);

            }

            //
            // PNG BY DEFAULT FOR SYSTEM IMAGES.
            // IS THE BIT FOR FLIPPED FOR INDICATION OF JPEG FORMAT?
            $tmp_file_extension = $tmp_image_folder = 'png';
            if($this->oCRNRSTN->is_bit_set(CRNRSTN_ASSET_MODE_JPEG) == true){

                $tmp_file_extension = $tmp_image_folder = 'jpg';

            }

            //
            // FOR POSSIBLE FILE EXTENSION OVERRIDE CHECK FOR JS/CSS/FAVICON FAMILY.
            switch($crnrstn_asset_family){
                case 'integrations':

                    $tmp_path = $this->oCRNRSTN->get_resource('crnrstn_integrations_asset_map_dir_path', 0, 'CRNRSTN::RESOURCE::ASSET_INTEGRATIONS');

                    //
                    // EXTRACT SYSTEM RESOURCE CACHE META DATA.
                    $tmp_asset_meta_ARRAY = $this->oCRNRSTN->asset_data_meta($asset_meta_key, $crnrstn_asset_family, NULL, NULL, NULL, NULL, NULL, NULL, $tmp_path);
                    //error_log(__LINE__ . ' asset mgr $tmp_asset_meta_ARRAY[' . print_r($tmp_asset_meta_ARRAY, true) . ']. $asset_meta_key[' . $asset_meta_key . '].');

                    /*
                    //
                    // FRAMEWORK INTEGRATIONS.
                    case 'LIGHTBOX_2.03.3_PREV':

                        $tmp_filename = 'framework/lightbox-2.03.3/prev';
                        $tmp_filename_ = 'prevlabel';
                        $tmp_file_extension = 'gif';
                        $tmp_filepath = $path . DIRECTORY_SEPARATOR . 'js/_lib/frameworks/lightbox.js/2.03.3/css/images';
                        $tmp_filepath .= DIRECTORY_SEPARATOR . 'prevlabel.gif';
                        $tmp_width = 50;
                        $tmp_height = 45;
                        $tmp_alt = 'prev';
                        $tmp_title = 'prev';
                        $tmp_link = '';
                        $tmp_target = '';
                        $tmp_asset_family = 'integrations';
                        $tmp_raw_output_mode = CRNRSTN_IMG;

                    break;
                    -----
                    $tmp_asset_meta_ARRAY['asset_data_key'] = $asset_data_key;
                    $tmp_asset_meta_ARRAY['asset_family'] = $tmp_asset_family;
                    $tmp_asset_meta_ARRAY['filename'] = $tmp_filename;
                    $tmp_asset_meta_ARRAY['filename_'] = $tmp_filename_;
                    $tmp_asset_meta_ARRAY['file_ext'] = $tmp_file_extension;
                    $tmp_asset_meta_ARRAY['filepath'] = $tmp_filepath;
                    $tmp_asset_meta_ARRAY['width'] = $tmp_width;
                    $tmp_asset_meta_ARRAY['height'] = $tmp_height;
                    $tmp_asset_meta_ARRAY['alt'] = $tmp_alt;
                    $tmp_asset_meta_ARRAY['title'] = $tmp_title;
                    $tmp_asset_meta_ARRAY['hyperlink'] = $tmp_link;
                    $tmp_asset_meta_ARRAY['target'] = $tmp_target;
                    $tmp_asset_meta_ARRAY['raw_output_mode'] = $tmp_raw_output_mode;

                    */
                    if(isset($tmp_asset_meta_ARRAY['filepath'])){

                        if(is_file($tmp_asset_meta_ARRAY['filepath'])){

                            $tmp_filename = $salt_ugc;

                            //error_log(__LINE__ . ' asset mgr $filepath[' . $tmp_asset_meta_ARRAY['filepath'] . ']. $filename[' . $tmp_asset_meta_ARRAY['filename_'] . ']. $file_extension[' . $tmp_asset_meta_ARRAY['file_ext'] . ']. $output_mode[' . $tmp_asset_meta_ARRAY['raw_output_mode'] . ']. $channel[' . $channel . '].');

                            $tmp_header_options_ARRAY = array();

                            $tmp_header_options_ARRAY[] = $this->oCRNRSTN->get_resource('header_response_option_cache_control', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');
                            $tmp_header_options_ARRAY[] = $this->oCRNRSTN->get_resource('header_response_option_x_frame_options', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

                            $tmp_filename_clean = $this->oCRNRSTN->process_for_filename($tmp_asset_meta_ARRAY['filename_']);

                            $tmp_curr_headers_ARRAY = headers_list();
                            $tmp_crnrstn_signature_headers_ARRAY = $this->oCRNRSTN->header_signature_options_return();

                            //
                            // SOURCE :: https://stackoverflow.com/questions/9728269/content-length-and-other-http-headers
                            // COMMENT :: https://stackoverflow.com/a/9728576
                            // AUTHOR :: Neysor :: https://stackoverflow.com/users/1219121/neysor
                            $tmp_filesize = filesize($tmp_asset_meta_ARRAY['filepath']);
                            $tmp_header_options_ARRAY[] = 'Content-Type: ' . mime_content_type($tmp_asset_meta_ARRAY['filepath']);
                            $tmp_header_options_ARRAY[] = 'Content-length: ' . $tmp_filesize;
                            if(isset($tmp_asset_meta_ARRAY['file_ext'])){

                                $tmp_header_options_ARRAY[] = 'Content-Disposition: inline; filename="' . $tmp_filename_clean . '.' . $tmp_asset_meta_ARRAY['file_ext'] . '"';

                            }

                            $tmp_date_lastmod = filemtime($tmp_asset_meta_ARRAY['filepath']);
                            $tmp_date_lastmod = date('D, j M Y G:i:s T', $tmp_date_lastmod);
                            $tmp_header_options_ARRAY[] = 'Last-Modified: ' . $tmp_date_lastmod;

                            //
                            // ENSURE ALL SIGNATURE HEADERS ARE IN PLACE AND CONTINUE.
                            $this->oCRNRSTN->header_options_add($tmp_curr_headers_ARRAY);
                            $this->oCRNRSTN->header_options_add($tmp_crnrstn_signature_headers_ARRAY);
                            $this->oCRNRSTN->header_options_add($tmp_header_options_ARRAY);

                            $this->oCRNRSTN->header_options_apply();

                            //
                            // TODO :: PHP RETURNS BYTES READ. DO WE TRACK FOR PLAID REPORTING?
                            // $bytes_read =
                            $this->oCRNRSTN->readfile_chunked($tmp_asset_meta_ARRAY['filepath']);

                            //
                            // CRNRSTN :: ASSET MAPPING PERFORMANCE REPORT.
                            //$mem_report_ARRAY = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');
                            $mem_report_ARRAY = array(0, 1, 5);

                            $is_HTML = false;
                            $tmp_txt_break = ' ';
                            $tmp_mem_str = $this->oCRNRSTN->mem_report($mem_report_ARRAY, 'TEXT', NULL, false, $is_HTML, $tmp_txt_break, '<br>');
                            //error_log(__LINE__ . ' rrs map TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str);
                            $this->oCRNRSTN->error_log('TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                            if(ob_get_level() > 0){ob_flush();}
                            flush();
                            exit();

                        }

                    }

                break;
                case 'js':

                    //
                    // TAKE FILE EXTENSION TO CRNRSTN :: PLAID.
                    //$tmp_filename_ARRAY = explode('.', $salt_ugc);
                    //$tmp_file_extension = array_pop($tmp_filename_ARRAY);

                    // lightbox.js css is stored on javascript path
                    // THIS Content-Type DATA IS AVAILABLE HERE ($resource_ARRAY['meta_type']), BUT GETTING THIS
                    // VALUE FOR ONE FILE RESOURCE REQUIRES LOADING ALL THE DATA FOR ALL FILES IN THAT FRAMEWORK.
                    // THE CURRENT ARCHITECTURE: "LOAD EVERYTHING...OR, GET BY PERFECTLY FINE WITH ALMOST NOTHING."
                    //...WE TAKE THE FAST (strpos) WAY RATHER THAN PERFORM THE INTERNAL META LOOKUPS.
                    $pos_css = strpos($salt_ugc,'.css');
                    $pos_map = strpos($salt_ugc,'.map');
                    if($pos_css !== false){

                        $tmp_header_options_ARRAY[] = 'Content-Type: text/css';

                    }else{

                        if($pos_map !== false){

                            //
                            // SOURCE :: https://stackoverflow.com/questions/16384089/jquery-2-0-0-min-map-uncaught-syntaxerror-unexpected-token/
                            // COMMENT :: https://stackoverflow.com/a/38021461
                            // AUTHOR :: bylerj :: https://stackoverflow.com/users/2510246/bylerj
                            $tmp_header_options_ARRAY[] = 'Content-Type: text/json';

                        }else{

                            $tmp_header_options_ARRAY[] = 'Content-Type: text/javascript';

                        }

                    }

                    /*'
                    self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_http_endpoint, 'crnrstn_http_endpoint', 'CRNRSTN::RESOURCE::HTTP_IMAGES', 0, CRNRSTN_CHANNEL_SESSION, $env_key);
                    self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_path_dir, 'crnrstn_path_directory', 'CRNRSTN::RESOURCE::HTTP_IMAGES', 0, NULL, $env_key);
                    self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_system_directory, 'crnrstn_system_directory', 'CRNRSTN::RESOURCE::HTTP_IMAGES', 0, NULL, $env_key);
                    self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_path_integrations, 'crnrstn_integrations_asset_map_dir_path', 'CRNRSTN::RESOURCE::ASSET_INTEGRATIONS', 0, NULL, $env_key);

                    */

                    $tmp_crnrstn_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');
                    $tmp_crnrstn_path_directory = $this->oCRNRSTN->get_resource('crnrstn_path_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');
                    $tmp_crnrstn_js_asset_map_dir_root = $this->oCRNRSTN->get_resource('crnrstn_js_asset_map_dir_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
                    //error_log(__LINE__ . ' rrs map $tmp_crnrstn_path_directory[' . $tmp_crnrstn_path_directory . ']. $tmp_dir_path[' . $tmp_dir_path . ']. $channel[' . $channel . ']. $salt_ugc[' . $salt_ugc . '] $crnrstn_asset_family[' . $crnrstn_asset_family . ']. $asset_meta_key[' . $asset_meta_key . ']. $output_mode_override[' . $output_mode_override . ']. $source[' . $source . '].');

                    switch($asset_meta_key){
                        case $this->oCRNRSTN->session_salt():

                            //
                            // SESSION SALT MEANS NO EXTERNAL FILE. RETURN DATA FROM INTERNAL CACHE SOURCE.
                            switch($salt_ugc){
                                case 'crnrstn.backbone_1_4_1.min.js':
                                case 'crnrstn.lightbox-2.03.3.js':

                                    $tmp_str = $this->oCRNRSTN->oCRNRSTN_ASSET_MGR->return_dynamic_js_string_output();

                                break;

                            }

                            $tmp_dir_path = '';

                        break;
                        default:

                            if(strlen($asset_meta_key) > 0){

                                $tmp_filepath = $tmp_crnrstn_path_directory . DIRECTORY_SEPARATOR . $tmp_crnrstn_system_directory . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR . $crnrstn_asset_family . DIRECTORY_SEPARATOR . $asset_meta_key  . DIRECTORY_SEPARATOR . $salt_ugc;

                            }

                        break;

                    }

                    //error_log(__LINE__ . ' rrs map $tmp_filepath[' . $tmp_filepath . ']. $channel[' . $channel . ']. $salt_ugc[' . $salt_ugc . '] $crnrstn_asset_family[' . $crnrstn_asset_family . ']. $asset_meta_key[' . $asset_meta_key . ']. $output_mode_override[' . $output_mode_override . ']. $source[' . $source . '].');

                    /*
                    [Sun May 21 12:17:23.139461 2023] [:error] [pid 12149] [client 172.16.225.1:56218] 6385 rrs map
                    $tmp_dir_path[/_lib/frameworks/jquery/3.6.1].
                    $channel[session]. $salt_ugc[jquery-3.6.1.min.map]
                    $crnrstn_asset_family[js].
                    $asset_meta_key[_lib/frameworks/jquery/3.6.1].
                    $output_mode_override[].
                    $source[plaid].

                    self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_http_endpoint, 'crnrstn_http_endpoint', 'CRNRSTN::RESOURCE::HTTP_IMAGES', 0, CRNRSTN_CHANNEL_SESSION, $env_key);
                    self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_path_dir, 'crnrstn_path_directory', 'CRNRSTN::RESOURCE::HTTP_IMAGES', 0, NULL, $env_key);
                    self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_system_directory, 'crnrstn_system_directory', 'CRNRSTN::RESOURCE::HTTP_IMAGES', 0, NULL, $env_key);
                    self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_path_integrations, 'crnrstn_integrations_asset_map_dir_path', 'CRNRSTN::RESOURCE::ASSET_INTEGRATIONS', 0, NULL, $env_key);

                    self::$oCRNRSTN_CONFIG_MGR->input_data_value($dir_path, 'crnrstn_js_asset_map_dir_root', 'CRNRSTN::RESOURCE::ASSET_PATH');
                    self::$oCRNRSTN_CONFIG_MGR->input_data_value($http_path, 'crnrstn_js_asset_map_http_root', 'CRNRSTN::RESOURCE::ASSET_PATH');

                    $tmp_crnrstn_css_asset_map_dir_root = $this->oCRNRSTN->get_resource('crnrstn_css_asset_map_dir_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');


                    [Sun May 21 12:27:42.347364 2023] [:error] [pid 12888] [client 172.16.225.1:58723]
                    PHP Warning:  filemtime(): stat failed for

                    /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/js/_lib/frameworks/jquery/3.6.1/jquery-3.6.1.min.map
                                                                /_crnrstn/ui/js/_lib/frameworks/jquery/3.6.1/jquery-3.6.1.min.map

                     in /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/class/session/crnrstn.response_return_serialization_map.inc.php on line 6402

                    */
                    //die();

                    $tmp_date_lastmod = filemtime($tmp_filepath);
                    $tmp_date_lastmod = date('D, j M Y G:i:s T', $tmp_date_lastmod);
                    $tmp_header_options_ARRAY[] = 'Last-Modified: ' . $tmp_date_lastmod;

                    $tmp_curr_headers_ARRAY = headers_list();
                    $tmp_crnrstn_signature_headers_ARRAY = $this->oCRNRSTN->header_signature_options_return();

                    //
                    // EXTRACT FILE CONTENTS. [JS, CSS, MAP]
                    if(!isset($tmp_str)){

                        $tmp_str = file_get_contents($tmp_filepath);
                        $tmp_filesize = filesize($tmp_filepath);

                    }

                    //
                    // NULL FILE SIZE CHECK.
                    if(!isset($tmp_filesize)){

                        $tmp_filesize = strlen($tmp_str);

                    }

                    //
                    // EMPTY STRING FILE SIZE CHECK.
                    if($tmp_filesize == ''){

                        $tmp_filesize = strlen($tmp_str);

                    }

                    $tmp_header_options_ARRAY[] = 'Content-length: ' . $tmp_filesize;

                    //
                    // ENSURE ALL SIGNATURE HEADERS ARE IN PLACE AND CONTINUE
                    $this->oCRNRSTN->header_options_add($tmp_curr_headers_ARRAY);
                    $this->oCRNRSTN->header_options_add($tmp_crnrstn_signature_headers_ARRAY);
                    $this->oCRNRSTN->header_options_add($tmp_header_options_ARRAY);

                    $this->oCRNRSTN->header_options_apply();

                    //
                    // CRNRSTN :: ASSET MAPPING PERFORMANCE REPORT.
                    //$mem_report_ARRAY = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');
                    $mem_report_ARRAY = array(0, 1, 5);

                    $is_HTML = false;
                    $tmp_txt_break = ' ';
                    $tmp_mem_str = $this->oCRNRSTN->mem_report($mem_report_ARRAY, 'TEXT', NULL, false, $is_HTML, $tmp_txt_break, '<br>');
                    //error_log(__LINE__ . ' rrs map TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str);
                    $this->oCRNRSTN->error_log('TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                    echo $tmp_str;

                    if(ob_get_level() > 0){ob_flush();}
                    flush();
                    exit();

                break;
                case 'css':

                    //
                    // TAKE FILE EXTENSION TO CRNRSTN :: PLAID.
                    //$tmp_filename_ARRAY = explode('.', $salt_ugc);
                    //$tmp_file_extension = array_pop($tmp_filename_ARRAY);

                    $tmp_header_options_ARRAY[] = 'Content-Type: text/css';
                    $tmp_dir_path = $this->oCRNRSTN->get_resource('crnrstn_css_asset_map_dir_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
                    $tmp_crnrstn_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');
                    $tmp_crnrstn_path_directory = $this->oCRNRSTN->get_resource('crnrstn_path_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');

                    $tmp_date_lastmod = filemtime($tmp_dir_path);
                    $tmp_date_lastmod = date('D, j M Y G:i:s T', $tmp_date_lastmod);
                    $tmp_header_options_ARRAY[] = 'Last-Modified: ' . $tmp_date_lastmod;

                    //error_log(__LINE__ . 'Last-Modified: ' . $tmp_date_lastmod);
                    //error_log(__LINE__ . ' Last-Modified: <day-name>, <day> <month> <year> <hour>:<minute>:<second> GMT');
                    switch($asset_meta_key){
                        case $this->oCRNRSTN->session_salt():

                            //
                            // SESSION SALT MEANS NO EXTERNAL FILE. RETURN DATA FROM INTERNAL CACHE SOURCE.
                            switch($salt_ugc){
                                case 'crnrstn.jquery-mobile-external-png-1.4.5.css':
                                case 'crnrstn.jquery-mobile-external-png-1.4.5.min.css':
                                case 'crnrstn.jquery-mobile-icons-1.4.5.css':
                                case 'crnrstn.jquery-mobile-icons-1.4.5.min.css':
                                case 'crnrstn.jquery-mobile-inline-png-1.4.5.css':
                                case 'crnrstn.jquery-mobile-inline-png-1.4.5.min.css':
                                case 'crnrstn.jquery-mobile-inline-svg-1.4.5.css':
                                case 'crnrstn.jquery-mobile-inline-svg-1.4.5.min.css':
                                case 'crnrstn.jquery-mobile-theme-1.4.5.css':
                                case 'crnrstn.jquery-mobile-theme-1.4.5.min.css':
                                case 'crnrstn.jquery-mobile-1.4.5.css':
                                case 'crnrstn.jquery-mobile-1.4.5.min.css':
                                case 'crnrstn.lightbox.css':
                                case 'crnrstn.lightbox.min.css':
                                case 'crnrstn.lightbox-2.03.3.css':

                                    $tmp_str = $this->oCRNRSTN->oCRNRSTN_ASSET_MGR->return_dynamic_css_string_output($salt_ugc);

                                break;
                                default:

                                    error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                                break;

                            }

                            $tmp_dir_path = '';

                        break;
                        default:

                            if(strlen($asset_meta_key) > 0){

                                $tmp_filepath = $tmp_crnrstn_path_directory . DIRECTORY_SEPARATOR . $tmp_crnrstn_system_directory . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR . $crnrstn_asset_family . DIRECTORY_SEPARATOR . $asset_meta_key  . DIRECTORY_SEPARATOR . $salt_ugc;

                            }

                        break;

                    }

                    $tmp_curr_headers_ARRAY = headers_list();
                    $tmp_crnrstn_signature_headers_ARRAY = $this->oCRNRSTN->header_signature_options_return();

                    //
                    // EXTRACT FILE CONTENTS. [JS, CSS, MAP]
                    if(!isset($tmp_str)){

                        $tmp_str = file_get_contents($tmp_filepath);
                        $tmp_filesize = filesize($tmp_filepath);

                    }

                    //
                    // NULL FILE SIZE CHECK.
                    if(!isset($tmp_filesize)){

                        $tmp_filesize = strlen($tmp_str);

                    }

                    //
                    // EMPTY STRING FILE SIZE CHECK.
                    if($tmp_filesize == ''){

                        $tmp_filesize = strlen($tmp_str);

                    }

                    $tmp_header_options_ARRAY[] = 'Content-length: ' . $tmp_filesize;

                    //
                    // ENSURE ALL SIGNATURE HEADERS ARE IN PLACE AND CONTINUE
                    $this->oCRNRSTN->header_options_add($tmp_curr_headers_ARRAY);
                    $this->oCRNRSTN->header_options_add($tmp_crnrstn_signature_headers_ARRAY);
                    $this->oCRNRSTN->header_options_add($tmp_header_options_ARRAY);

                    $this->oCRNRSTN->header_options_apply();

                    //
                    // CRNRSTN :: ASSET MAPPING PERFORMANCE REPORT.
                    //$mem_report_ARRAY = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');
                    $mem_report_ARRAY = array(0, 1, 5);

                    $is_HTML = false;
                    $tmp_txt_break = ' ';
                    $tmp_mem_str = $this->oCRNRSTN->mem_report($mem_report_ARRAY, 'TEXT', NULL, false, $is_HTML, $tmp_txt_break, '<br>');
                    //error_log(__LINE__ . ' rrs map TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str);
                    $this->oCRNRSTN->error_log('TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                    echo $tmp_str;

                    if(ob_get_level() > 0){ob_flush();}
                    flush();
                    exit();

                break;
                case 'favicon':

                    $tmp_file_extension = 'ico';

                break;

            }

            //
            // EXTRACT SYSTEM RESOURCE CACHE META DATA.
            $tmp_asset_meta_ARRAY = $this->oCRNRSTN->asset_data_meta($asset_meta_key, $crnrstn_asset_family);

            if(!isset($output_mode_override)){

                $output_mode_override = $tmp_asset_meta_ARRAY['raw_output_mode'];

            }

            switch($crnrstn_asset_family){
                case 'favicon':

                    //
                    // THIS IS FAVICON.
                    $tmp_file_extension = 'ico';

                    //
                    // CRNRSTN :: CONFIGURATION DATA.
                    // See _crnrstn.config.inc.php. By default, $crnrstn_dir_path = ''.
                    $tmp_crnrstn_path_directory = $this->oCRNRSTN->get_resource('crnrstn_path_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');

                    //
                    // CRNRSTN :: SYSTEM DIRECTORY.
                    // See method call config_init_http(), in _crnrstn.config.inc.php where $crnrstn_system_directory = '_crnrstn'.
                    $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');

                    //////////
                    // HARD URL :: URL BUILD PROFILE.
                    // BUILD FILE PATH.
                    $tmp_filepath = $tmp_crnrstn_path_directory . DIRECTORY_SEPARATOR . $tmp_system_directory . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR . $crnrstn_asset_family . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . $salt_ugc . '.' . $tmp_file_extension;
                    //error_log(__LINE__ . ' rrs map FAVICON IMG $output_mode_override[' . $output_mode_override . ']. [' . $salt_ugc . ']. filepath [' . $tmp_filepath . '].');

                    //error_log(__LINE__ . ' rrs map GOING TO PLAID. $tmp_filepath[' . $tmp_filepath . ']. $tmp_file_extension[' . $tmp_file_extension . ']. $channel[' . $channel . ']. $salt_ugc[' . $salt_ugc . ']. $crnrstn_asset_family[' . $crnrstn_asset_family . ']. $output_mode_override[' . $output_mode_override . ']. $source[' . $source . '].');
                    $this->initialize_cache($crnrstn_asset_family, $salt_ugc, $asset_meta_key, $output_mode_override, $tmp_filepath, $tmp_file_extension);

                    if($this->oCRNRSTN->is_system_terminate_enabled()){

                        //
                        // LOAD DEFAULT FAVICON FOR SYSTEM TERMINATION USE CASE.
                        $tmp_filepath = CRNRSTN_ROOT . DIRECTORY_SEPARATOR . '_crnrstn' . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR . 'favicon' . DIRECTORY_SEPARATOR . $crnrstn_asset_family . DIRECTORY_SEPARATOR . $salt_ugc . '.ico';

                    }

                    //
                    // VALIDATE FILE. RETURN <META> STRING.
                    if(!is_file($tmp_filepath)){

                        //
                        // FAIL GRACEFULLY.
                        //error_log(__LINE__ . ' rrs map Invalid path provided. Unable to return <META> HTML for FAVICON resource [' . $salt_ugc . ']. filepath [' . $tmp_filepath . '].');
                        return '';

                    }

                    if($output_mode_override == CRNRSTN_IMG){

                        //
                        // RETURN IMAGE
                        //error_log(__LINE__ . ' rrs map HELLO FAVICON IMG [' . $salt_ugc . ']. filepath [' . $tmp_filepath . '].');

                        //die();
                        $tmp_header_options_ARRAY = array();

                        $tmp_header_options_ARRAY[] = $this->oCRNRSTN->get_resource('header_response_option_cache_control', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');
                        $tmp_header_options_ARRAY[] = $this->oCRNRSTN->get_resource('header_response_option_x_frame_options', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

                        $tmp_filename_clean = 'favicon';

                        $tmp_curr_headers_ARRAY = headers_list();
                        $tmp_crnrstn_signature_headers_ARRAY = $this->oCRNRSTN->header_signature_options_return();

                        //
                        // SOURCE :: https://stackoverflow.com/questions/9728269/content-length-and-other-http-headers
                        // COMMENT :: https://stackoverflow.com/a/9728576
                        // AUTHOR :: Neysor :: https://stackoverflow.com/users/1219121/neysor
                        $tmp_filesize = filesize($tmp_filepath);
                        $tmp_header_options_ARRAY[] = 'Content-Type: ' . mime_content_type($tmp_filepath);
                        $tmp_header_options_ARRAY[] = 'Content-length: ' . $tmp_filesize;
                        if(isset($tmp_file_extension)){

                            $tmp_header_options_ARRAY[] = 'Content-Disposition: inline; filename="' . $tmp_filename_clean . '.' . $tmp_file_extension . '"';

                        }

                        $tmp_date_lastmod = filemtime($tmp_filepath);
                        $tmp_date_lastmod = date('D, j M Y G:i:s T', $tmp_date_lastmod);
                        $tmp_header_options_ARRAY[] = 'Last-Modified: ' . $tmp_date_lastmod;

                        //
                        // ENSURE ALL SIGNATURE HEADERS ARE IN PLACE AND CONTINUE
                        $this->oCRNRSTN->header_options_add($tmp_curr_headers_ARRAY);
                        $this->oCRNRSTN->header_options_add($tmp_crnrstn_signature_headers_ARRAY);
                        $this->oCRNRSTN->header_options_add($tmp_header_options_ARRAY);

                        $this->oCRNRSTN->header_options_apply();

                        //
                        // TODO :: PHP RETURNS BYTES READ. DO WE TRACK FOR PLAID REPORTING?
                        // $bytes_read =
                        $this->oCRNRSTN->readfile_chunked($tmp_filepath);

                        //
                        // CRNRSTN :: ASSET MAPPING PERFORMANCE REPORT.
                        //$mem_report_ARRAY = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');
                        $mem_report_ARRAY = array(0, 1, 5);

                        $is_HTML = false;
                        $tmp_txt_break = ' ';
                        $tmp_mem_str = $this->oCRNRSTN->mem_report($mem_report_ARRAY, 'TEXT', NULL, false, $is_HTML, $tmp_txt_break, '<br>');
                        //error_log(__LINE__ . ' rrs map TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str);
                        $this->oCRNRSTN->error_log('TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                        if(ob_get_level() > 0){ob_flush();}
                        flush();
                        exit();

                    }

                    //
                    // GET CACHE VERSION ID. THIS METHOD IS COSTLY. USE SPARINGLY BECAUSE IT
                    // IS WHERE, $tmp_cache_version = $file_cache_version_str = '420.00.' . filesize($file_path) . '.' . filemtime($file_path).'.0';
                    $tmp_cache_version = $this->oCRNRSTN->resource_filecache_version($tmp_filepath);

                    //
                    // CONSTRUCT HTTP LINK FOR RESOURCE.
                    // See config_init_asset_map_favicon() in _crnrstn.config.inc.php. Where, $http_path = ''.
                    $tmp_http_root = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_' . $crnrstn_asset_family . '_asset_map_http_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH'));

                    //
                    // CRNRSTN :: CONFIGURATION FILE INITIALIZED
                    // See, config_init_asset_map_favicon_img() in _crnrstn.config.inc.php.
                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_FAVICON_ASSET_MAPPING) == true){

                        //////////
                        // ASSET MAPPING :: URL BUILD PROFILE.
                        // https://lightsaber.crnrstn.evifweb.com/?crnrstn_0010111011=jquery-3.6.1.min.map&crnrstn_=420.00.138173.1680672426.0
                        $tmp_http_path = $tmp_http_root . '?' . $this->oCRNRSTN->session_salt() . '=' . $salt_ugc . '&crnrstn_=' . $tmp_cache_version;

                        return '<link rel="shortcut icon" type="image/x-icon" href="' . $tmp_http_path . '"/>';

                    }

                    //////////
                    // HARD URL :: URL BUILD PROFILE.
                    $tmp_http_path = $tmp_http_root . $tmp_system_directory . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR . $crnrstn_asset_family . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . $salt_ugc . '.' . $tmp_file_extension . '?crnrstn_=' . $tmp_cache_version;

                    //
                    // CRNRSTN :: ASSET MAPPING PERFORMANCE REPORT.
                    //$mem_report_ARRAY = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');
                    $mem_report_ARRAY = array(0, 1, 5);

                    $is_HTML = false;
                    $tmp_txt_break = ' ';
                    $tmp_mem_str = $this->oCRNRSTN->mem_report($mem_report_ARRAY, 'TEXT', NULL, false, $is_HTML, $tmp_txt_break, '<br>');
                    //error_log(__LINE__ . ' rrs map TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str);
                    $this->oCRNRSTN->error_log('TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                    return '<link rel="shortcut icon" type="image/x-icon" href="' . $tmp_http_path . '"/>';

                break;
                case 'social':
                case 'system':

                    switch($output_mode_override){
                        case CRNRSTN_UI_SOAP_DATA_TUNNEL:
                            //case 'CRNRSTN_UI_SOAP_DATA_TUNNEL'  : 7210;             CRNRSTN :: SOAP SERVICES DATA TUNNEL LAYER - DATA TRANSLATION SUPPORT.
                            //            {barney}_{smaug}
                            // PROXY SUPPORT FOR USING TMP TOKENS FOR <IMG> IN SOAP TUNNELED EMAIL COMMUNICATIONS.
                            // ALSO THE 65,535 CHAR LIMIT...
                            // SO SORRY! CRNRSTN_LOG_EMAIL_PROXY WILL BE "DOWN" (IT LOOKS LIKE) UNTIL IT CAN BE
                            // MOVED INTO LIGHTSABER.

                        break;
                        case CRNRSTN_ASSET_MODE_BASE64:
                            // case 'CRNRSTN_ASSET_MODE_BASE64'        : 7510;             RETURNS data:image/png;base64 OR data:image/jpg;base64 (CONFIGURATION DRIVEN) STRING DATA.

                            //
                            // BUILD BASE64 FILE PATH.
                            //                                                  _crnrstn/                            ui/                         imgs/                           base64/                            system/                                         apache_feather_logo.php
                            $tmp_filepath = CRNRSTN_ROOT . DIRECTORY_SEPARATOR . '_crnrstn' . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR . 'base64' . DIRECTORY_SEPARATOR . $this->get_cache('asset_family', $salt_ugc) . DIRECTORY_SEPARATOR . $salt_ugc . '.php';

                            if(is_file($tmp_filepath)){

                                error_log(__LINE__ . ' rrs map GOING TO PLAID. $tmp_filepath[' . $tmp_filepath . ']. $tmp_file_extension[' . $tmp_file_extension . ']. $channel[' . $channel . ']. $salt_ugc[' . $salt_ugc . ']. $crnrstn_asset_family[' . $crnrstn_asset_family . ']. $output_mode_override[' . $output_mode_override . ']. $source[' . $source . '].');
                                $this->initialize_cache($crnrstn_asset_family, $salt_ugc, $asset_meta_key, $output_mode_override, $tmp_filepath, $tmp_file_extension);

                                //$this->cache_write('filepath', $tmp_filepath, NULL, $salt_ugc);

                                //
                                // INITIALIZE THE BASE64-ENCODE-VERSION-TOGGLE TO TRIP THE LOADING OF
                                // THE PNG VERSION OF THE SYSTEM ASSET INTO MEMORY WHEN THE BASE64.PHP
                                // FILE LOADS.
                                self::$image_output_mode = CRNRSTN_BASE64_PNG;

                                //
                                // LOAD THE BASE64 META DATA FILE.
                                include($tmp_filepath);

                                //
                                // IF THE BASE64 FILE HAS SUCCESSFULLY LOADED, THIS VALUE, $system_file_serial,
                                // (AND ALL OTHERS BELOW) WILL BE SET.
                                if(isset($system_file_serial)){

                                    //
                                    // BASE64 DATA AND SOME META.
                                    //$tmp_datecreated = self::$image_filesystem_meta_ARRAY[self::$image_output_mode][self::$request_salt][$system_file_serial]['datecreated_base64_PNG'];
                                    //$tmp_lastmodified = self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_PNG][self::$request_salt][$system_file_serial]['lastmodified_base64_PNG'];
                                    $tmp_base64 = self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_PNG][self::$request_salt][$system_file_serial ]['base64'];

                                    //
                                    // RETURN THE BASE64 ENCODED PNG STRING DATA.
                                    //
                                    // CRNRSTN :: ASSET MAPPING PERFORMANCE REPORT.
                                    //$mem_report_ARRAY = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');
                                    $mem_report_ARRAY = array(0, 1, 5);

                                    $is_HTML = false;
                                    $tmp_txt_break = ' ';
                                    $tmp_mem_str = $this->oCRNRSTN->mem_report($mem_report_ARRAY, 'TEXT', NULL, false, $is_HTML, $tmp_txt_break, '<br>');
                                    //error_log(__LINE__ . ' rrs map TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str);
                                    $this->oCRNRSTN->error_log('TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                                    return $tmp_base64;

                                }

                            }

                            error_log(__LINE__ . ' rrs map GOING TO PLAID???? $tmp_filepath[' . $tmp_filepath . ']. $tmp_file_extension[' . $tmp_file_extension . ']. $channel[' . $channel . ']. $salt_ugc[' . $salt_ugc . ']. $crnrstn_asset_family[' . $crnrstn_asset_family . ']. $output_mode_override[' . $output_mode_override . ']. $source[' . $source . '].');

                        break;
                        case CRNRSTN_BASE64_PNG:
                        case CRNRSTN_BASE64_JPEG:
                            // CRNRSTN_BASE64_PNG		    RETURNS data:image/png;base64 STRING DATA.

                            //
                            // BUILD BASE64 FILE PATH.
                            //                                                  _crnrstn/                            ui/                         imgs/                           base64/                            system/                                         apache_feather_logo.php
                            $tmp_filepath = CRNRSTN_ROOT . DIRECTORY_SEPARATOR . '_crnrstn' . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR . 'base64' . DIRECTORY_SEPARATOR . $crnrstn_asset_family . DIRECTORY_SEPARATOR . $salt_ugc . '.php';
                            // /_crnrstn/ui/imgs/base64/system/linux_penguin_sm.php
                            // /var/www/html/lightsaber.crnrstn.evifweb.com/

                            //error_log(__LINE__ . ' rrs map PATH[' . print_r($tmp_filepath, true) . '].');

                            if(is_file($tmp_filepath)){

                                //error_log(__LINE__ . ' rrs map GOING TO PLAID. $tmp_filepath[' . $tmp_filepath . ']. $tmp_file_extension[' . $tmp_file_extension . ']. $channel[' . $channel . ']. $salt_ugc[' . $salt_ugc . ']. $crnrstn_asset_family[' . $crnrstn_asset_family . ']. $output_mode_override[' . $output_mode_override . ']. $source[' . $source . '].');
                                $this->initialize_cache($crnrstn_asset_family, $salt_ugc, $asset_meta_key, $output_mode_override, $tmp_filepath, $tmp_file_extension);

                                //$this->cache_write('filepath', $tmp_filepath, NULL, $salt_ugc);

                                //if(($output_mode_override !== (CRNRSTN_HTML & CRNRSTN_ASSET_MODE_BASE64)) && ($output_mode_override !== (CRNRSTN_HTML & CRNRSTN_BASE64_PNG))){
                                if(($output_mode_override !== (CRNRSTN_HTML & CRNRSTN_ASSET_MODE_BASE64)) && ($output_mode_override !== (CRNRSTN_HTML & CRNRSTN_BASE64_PNG))){

                                    //
                                    // INITIALIZE THE BASE64-ENCODE-VERSION-TOGGLE TO TRIP THE LOADING OF
                                    // THE PNG VERSION OF THE SYSTEM ASSET INTO MEMORY WHEN THE BASE64.PHP
                                    // FILE LOADS.
                                    self::$image_output_mode = CRNRSTN_BASE64_JPEG;
                                    //error_log(__LINE__ . ' rrs map $tmp_filepath[' . $tmp_filepath . ']. RETURNS HTML <IMG> WRAPPED data:image/png;base64 OR data:image/jpg;base64 (CONFIGURATION DRIVEN) STRING DA...');

                                }else{

                                    //if($output_mode_override == (CRNRSTN_HTML & CRNRSTN_BASE64_JPEG)){
                                    if($output_mode_override == CRNRSTN_HTML & CRNRSTN_BASE64_JPEG){

                                        self::$image_output_mode = CRNRSTN_BASE64_JPEG;
                                        //error_log(__LINE__ . ' rrs map $tmp_filepath[' . $tmp_filepath . ']. RETURNS HTML <IMG> WRAPPED data:image/png;base64 OR data:image/jpg;base64 (CONFIGURATION DRIVEN) STRING DA...');

                                    }else{

                                        if($output_mode_override == CRNRSTN_BASE64_PNG){

                                            self::$image_output_mode = CRNRSTN_BASE64_PNG;
                                            //error_log(__LINE__ . ' rrs map $tmp_filepath[' . $tmp_filepath . ']. RETURNS HTML <IMG> WRAPPED data:image/png;base64 OR data:image/jpg;base64 (CONFIGURATION DRIVEN) STRING DA...');

                                        }else{

                                            //
                                            // CRNRSTN :: CONFIGURATION FILE INITIALIZED.
                                            // See, config_init_asset_map_favicon_img() in _crnrstn.config.inc.php.
                                            if($this->oCRNRSTN->is_bit_set(CRNRSTN_ASSET_MODE_JPEG) == true || ($output_mode_override == CRNRSTN_BASE64_JPEG)){

                                                self::$image_output_mode = CRNRSTN_BASE64_JPEG;
                                                //error_log(__LINE__ . ' rrs map $tmp_filepath[' . $tmp_filepath . ']. RETURNS HTML <IMG> WRAPPED data:image/png;base64 OR data:image/jpg;base64 (CONFIGURATION DRIVEN) STRING DA...');

                                            }else{

                                                self::$image_output_mode = CRNRSTN_BASE64_PNG;
                                                //error_log(__LINE__ . ' rrs map $tmp_filepath[' . $tmp_filepath . ']. RETURNS HTML <IMG> WRAPPED data:image/png;base64 OR data:image/jpg;base64 (CONFIGURATION DRIVEN) STRING DA...');

                                            }

                                        }

                                    }

                                }

                                //
                                // LOAD THE BASE64 META DATA FILE.
                                include($tmp_filepath);

                                //
                                // IF THE BASE64 FILE HAS SUCCESSFULLY LOADED, THIS VALUE, $system_file_serial,
                                // (AND ALL OTHERS BELOW) WILL BE SET.
                                if(isset($system_file_serial)){

                                    //
                                    // BASE64 DATA AND SOME META.
                                    //$tmp_datecreated = self::$image_filesystem_meta_ARRAY[self::$image_output_mode][self::$request_salt][$system_file_serial]['datecreated_base64_PNG'];
                                    //$tmp_lastmodified = self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_PNG][self::$request_salt][$system_file_serial]['lastmodified_base64_PNG'];
                                    $tmp_base64 = self::$image_filesystem_meta_ARRAY[self::$image_output_mode][self::$request_salt][$system_file_serial ]['base64'];

                                    //
                                    // CRNRSTN :: ASSET MAPPING PERFORMANCE REPORT.
                                    //$mem_report_ARRAY = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');
                                    $mem_report_ARRAY = array(0, 1, 5);

                                    $is_HTML = false;
                                    $tmp_txt_break = ' ';
                                    $tmp_mem_str = $this->oCRNRSTN->mem_report($mem_report_ARRAY, 'TEXT', NULL, false, $is_HTML, $tmp_txt_break, '<br>');
                                    //error_log(__LINE__ . ' rrs map TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str);
                                    $this->oCRNRSTN->error_log('TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                                    //
                                    // RETURN THE HTML WRAPPED BASE64 ENCODED IMG STRING DATA.
                                    return $tmp_base64;

                                }

                            }

                        break;
                        case CRNRSTN_HTML & CRNRSTN_BASE64_JPEG:
                        case CRNRSTN_HTML & CRNRSTN_ASSET_MODE_BASE64:
                        case CRNRSTN_HTML & CRNRSTN_BASE64_PNG:
                            // 7184    CRNRSTN_HTML & CRNRSTN_ASSET_MODE_BASE64     RETURNS HTML <IMG> WRAPPED data:image/png;base64 OR data:image/jpg;base64 (CONFIGURATION DRIVEN) STRING DATA.
                            // 7200    CRNRSTN_HTML & CRNRSTN_BASE64_PNG		    RETURNS HTML <IMG> WRAPPED data:image/png;base64 STRING DATA.
                            // 7201    CRNRSTN_HTML & CRNRSTN_BASE64_JPEG		    RETURNS HTML <IMG> WRAPPED data:image/jpg;base64 STRING DATA.

                            //error_log(__LINE__ . ' rrs map $output_mode_override[' . print_r($output_mode_override, true) . '] [' . print_r(CRNRSTN_HTML & CRNRSTN_ASSET_MODE_BASE64, true) . ']. ['. print_r(CRNRSTN_HTML & CRNRSTN_BASE64_PNG, true) .']. [' . print_r(CRNRSTN_HTML & CRNRSTN_BASE64_JPEG, true) . ']. return_int_const_profile['. $this->oCRNRSTN->return_int_const_profile($output_mode_override, CRNRSTN_STRING).'].');
                            //error_log(__LINE__ . ' rrs map $tmp_crnrstn_path_directory[' . $tmp_crnrstn_path_directory . ']. $crnrstn_asset_family[' . $crnrstn_asset_family . ']. $salt_ugc[' . $salt_ugc . ']. $asset_meta_key[' . $asset_meta_key . ']. $output_mode_override[' . $output_mode_override . ']. die();');
                            //error_log(__LINE__ . ' rrs map $output_mode_override[' . print_r(self::$cache_ARRAY, true) . '].');

                            /*
                            [Thu May 25 16:48:32.579596 2023] [:error] [pid 37114] [client 172.16.225.1:64329] 7425 rrs map
                            $output_mode_override[Array\n(\n
                                [E3kvOJplBWxgNW17QDyhPNX2fpxXvYtIVzIGId132McXIkGXAOLNXmr5YyvSr9BZ] => Array\n        (\n
                                    [channel_bytes] => Array\n                (\n
                                        [runtime] => 918\n                )\n\n
                                            [cache_id] => Array\n                (\n
                                                [5a3353d637308108055156a1b7065de14de22fce83cc0120c8c55746fc7897d4::starttime] => 0\n
                                                [linux_penguin_sm] => 1\n                )\n\n
                                            [resource_bytes] => Array\n                (\n
                                                [0] => Array\n                        (\n
                                                    [0] => 0\n                        )\n\n
                                                    [2] => 0\n
                                                    [1] => 292\n                )\n\n
                                            [ipaddress_id] => Array\n                (\n
                                                [172.16.225.1] => 0\n                )\n\n
                                            [ttl] => Array\n                (\n
                                                [0] => Array\n                        (\n
                                                    [0] => 1685047772\n                        )\n\n                )\n\n
                                            [datecreated] => Array\n                (\n
                                                [0] => 1685047712\n
                                                [1] => 1685047712\n                )\n\n
                                            [createdby_client_ip] => Array\n                (\n
                                                [0] => 0\n
                                                [1] => 0\n                )\n\n
                                            [lastmodified] => Array\n                (\n
                                                [0] => Array\n                        (\n
                                                    [0] => 1685047712\n                        )\n\n
                                                    [1] => 1685047712\n                )\n\n
                                            [modifiedby_client_ip] => Array\n                (\n
                                                [0] => Array\n                        (\n
                                                    [0] => 0\n                        )\n\n                )\n\n
                                            [asset_family] => Array\n                (\n
                                                [0] => DDO\n
                                                [1] => system\n                )\n\n
                                            [channel_resource_counts] => Array\n                (\n
                                                [0] => 1\n                )\n\n
                                            [filename] => Array\n                (\n
                                                [1] => linux_penguin_sm\n                )\n\n
                                            [asset_meta_key] => Array\n                (\n
                                                [1] => LINUX_PENGUIN_SMALL\n                )\n\n        )\n\n)\n].



                            */
                            //
                            // BUILD BASE64 FILE PATH.
                            //                                                  _crnrstn/                            ui/                         imgs/                           base64/                            system/                                         apache_feather_logo.php
                            $tmp_filepath = CRNRSTN_ROOT . DIRECTORY_SEPARATOR . '_crnrstn' . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR . 'base64' . DIRECTORY_SEPARATOR . $crnrstn_asset_family . DIRECTORY_SEPARATOR . $salt_ugc . '.php';
                            // /_crnrstn/ui/imgs/base64/system/linux_penguin_sm.php
                            // /var/www/html/lightsaber.crnrstn.evifweb.com/

                            //error_log(__LINE__ . ' rrs map PATH[' . print_r($tmp_filepath, true) . '].');

                            if(is_file($tmp_filepath)){

                                error_log(__LINE__ . ' rrs map GOING TO PLAID. $tmp_filepath[' . $tmp_filepath . ']. $tmp_file_extension[' . $tmp_file_extension . ']. $channel[' . $channel . ']. $salt_ugc[' . $salt_ugc . ']. $crnrstn_asset_family[' . $crnrstn_asset_family . ']. $output_mode_override[' . $output_mode_override . ']. $source[' . $source . '].');
                                $this->initialize_cache($crnrstn_asset_family, $salt_ugc, $asset_meta_key, $output_mode_override, $tmp_filepath, $tmp_file_extension);

                                //$this->cache_write('filepath', $tmp_filepath, NULL, $salt_ugc);

                                //if(($output_mode_override !== (CRNRSTN_HTML & CRNRSTN_ASSET_MODE_BASE64)) && ($output_mode_override !== (CRNRSTN_HTML & CRNRSTN_BASE64_PNG))){
                                if(($output_mode_override !== (CRNRSTN_HTML & CRNRSTN_ASSET_MODE_BASE64)) && ($output_mode_override !== (CRNRSTN_HTML & CRNRSTN_BASE64_PNG))){

                                        //
                                        // INITIALIZE THE BASE64-ENCODE-VERSION-TOGGLE TO TRIP THE LOADING OF
                                        // THE PNG VERSION OF THE SYSTEM ASSET INTO MEMORY WHEN THE BASE64.PHP
                                        // FILE LOADS.
                                        self::$image_output_mode = CRNRSTN_BASE64_JPEG;
                                        //error_log(__LINE__ . ' rrs map $tmp_filepath[' . $tmp_filepath . ']. RETURNS HTML <IMG> WRAPPED data:image/png;base64 OR data:image/jpg;base64 (CONFIGURATION DRIVEN) STRING.');

                                }else{

                                    //if($output_mode_override == (CRNRSTN_HTML & CRNRSTN_BASE64_JPEG)){
                                    if($output_mode_override == CRNRSTN_HTML & CRNRSTN_BASE64_JPEG){

                                        self::$image_output_mode = CRNRSTN_BASE64_JPEG;
                                        //error_log(__LINE__ . ' rrs map $tmp_filepath[' . $tmp_filepath . ']. RETURNS HTML <IMG> WRAPPED data:image/png;base64 OR data:image/jpg;base64 (CONFIGURATION DRIVEN) STRING.');

                                    }else{

                                        if($output_mode_override == CRNRSTN_HTML & CRNRSTN_BASE64_PNG){

                                            self::$image_output_mode = CRNRSTN_BASE64_PNG;
                                            //error_log(__LINE__ . ' rrs map $tmp_filepath[' . $tmp_filepath . ']. RETURNS HTML <IMG> WRAPPED data:image/png;base64 OR data:image/jpg;base64 (CONFIGURATION DRIVEN) STRING.');

                                        }else{

                                            //
                                            // CRNRSTN :: CONFIGURATION FILE INITIALIZED.
                                            // See, config_init_asset_map_favicon_img() in _crnrstn.config.inc.php.
                                            if($this->oCRNRSTN->is_bit_set(CRNRSTN_ASSET_MODE_JPEG) == true){

                                                self::$image_output_mode = CRNRSTN_BASE64_JPEG;
                                                //error_log(__LINE__ . ' rrs map $tmp_filepath[' . $tmp_filepath . ']. RETURNS HTML <IMG> WRAPPED data:image/png;base64 OR data:image/jpg;base64 (CONFIGURATION DRIVEN) STRING.');

                                            }else{

                                                self::$image_output_mode = CRNRSTN_BASE64_PNG;
                                                //error_log(__LINE__ . ' rrs map $tmp_filepath[' . $tmp_filepath . ']. RETURNS HTML <IMG> WRAPPED data:image/png;base64 OR data:image/jpg;base64 (CONFIGURATION DRIVEN) STRING.');

                                            }

                                        }

                                    }

                                }

                                //
                                // LOAD THE BASE64 META DATA FILE.
                                include($tmp_filepath);

                                //
                                // IF THE BASE64 FILE HAS SUCCESSFULLY LOADED, THIS VALUE, $system_file_serial,
                                // (AND ALL OTHERS BELOW) WILL BE SET.
                                if(isset($system_file_serial)){

                                    switch($source){
                                        //case 'return_creative':
                                        case 'return_system_image':
                                            // META DATA HAS BEEN ACQUIRED BY CRNRSTN ::
                                        break;
                                        default:

                                            //
                                            // EXTRACT SYSTEM RESOURCE CACHE META DATA.
                                            $this->oCRNRSTN->cache_meta_ARRAY = $this->oCRNRSTN->asset_data_meta($asset_meta_key, $crnrstn_asset_family);

                                        break;

                                    }

                                    //
                                    // BASE64 DATA AND SOME META.
                                    //$tmp_datecreated = self::$image_filesystem_meta_ARRAY[self::$image_output_mode][self::$request_salt][$system_file_serial]['datecreated_base64_PNG'];
                                    //$tmp_lastmodified = self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_PNG][self::$request_salt][$system_file_serial]['lastmodified_base64_PNG'];
                                    $tmp_base64 = self::$image_filesystem_meta_ARRAY[self::$image_output_mode][self::$request_salt][$system_file_serial ]['base64'];

                                    error_log(__LINE__ . ' rrs map cache_meta_ARRAY[' . print_r($this->oCRNRSTN->cache_meta_ARRAY, true) . '].');

                                    //
                                    // PROCESS USER INPUT PARAMETERS.
                                    if(isset($this->oCRNRSTN->cache_meta_ARRAY['width'])){

                                        if(strlen($this->oCRNRSTN->cache_meta_ARRAY['width']) > 0){

                                            $tmp_cache_meta_ARRAY['width'] = $this->oCRNRSTN->cache_meta_ARRAY['width'];

                                        }

                                    }

                                    if(isset($this->oCRNRSTN->cache_meta_ARRAY['height'])){

                                        if(strlen($this->oCRNRSTN->cache_meta_ARRAY['height']) > 0){

                                            $tmp_cache_meta_ARRAY['height'] = $this->oCRNRSTN->cache_meta_ARRAY['height'];

                                        }

                                    }

                                    if(isset($this->oCRNRSTN->cache_meta_ARRAY['alt'])){

                                        if(strlen($this->oCRNRSTN->cache_meta_ARRAY['alt']) > 0){

                                            $tmp_cache_meta_ARRAY['alt'] = $this->oCRNRSTN->cache_meta_ARRAY['alt'];

                                        }

                                    }

                                    if(isset($this->oCRNRSTN->cache_meta_ARRAY['title'])){

                                        if(strlen($this->oCRNRSTN->cache_meta_ARRAY['title']) > 0){

                                            $tmp_cache_meta_ARRAY['title'] = $this->oCRNRSTN->cache_meta_ARRAY['title'];

                                        }

                                    }

                                    if(isset($this->oCRNRSTN->cache_meta_ARRAY['hyperlink'])){

                                        if(strlen($this->oCRNRSTN->cache_meta_ARRAY['hyperlink']) > 0){

                                            $tmp_cache_meta_ARRAY['hyperlink'] = $this->oCRNRSTN->cache_meta_ARRAY['hyperlink'];

                                        }

                                    }

                                    $tmp_cache_meta_ARRAY['target'] = '_self';      // NOTE: IF LEN<1, THE HARD-CODED INTERNAL DEFAULT IS _SELF.
                                    if(isset($this->oCRNRSTN->cache_meta_ARRAY['target'])){

                                        if(strlen($this->oCRNRSTN->cache_meta_ARRAY['target']) > 0){

                                            $tmp_cache_meta_ARRAY['target'] = $this->oCRNRSTN->cache_meta_ARRAY['target'];

                                        }

                                    }

                                    //error_log(__LINE__ . ' rrs map $tmp_cache_meta_ARRAY[' . print_r($tmp_cache_meta_ARRAY, true) . '].');

                                    $url_params_ARRAY = NULL;
                                    if(isset($this->cache_meta_ARRAY['url_params_ARRAY'])){

                                        $url_params_ARRAY = $this->oCRNRSTN->cache_meta_ARRAY['url_params_ARRAY'];

                                    }

                                    //error_log(__LINE__ . ' rrs map ASSEMBLE $salt_ugc[' . $salt_ugc . '] IMAGE HTML OUTPUT. $tmp_cache_meta_ARRAY[' . print_r($tmp_cache_meta_ARRAY, true) . '].');

                                    //
                                    // <IMG> HTML INJECTION DOM ATTRIBUTE STRING PREPARATION.
                                    // IF width='25', THEN $width="width='25'"; IF width='', THEN $width='';
                                    $width = '';
                                    if(isset($tmp_cache_meta_ARRAY['width'])){

                                        $width = $tmp_cache_meta_ARRAY['width'];

                                    }

                                    $height = '';
                                    if(isset($tmp_cache_meta_ARRAY['height'])){

                                        $height = $tmp_cache_meta_ARRAY['height'];

                                    }

                                    $alt = '';
                                    if(isset($tmp_cache_meta_ARRAY['alt'])){

                                        $alt = $tmp_cache_meta_ARRAY['alt'];

                                    }

                                    $title = '';
                                    if(isset($tmp_cache_meta_ARRAY['title'])){

                                        $title = $tmp_cache_meta_ARRAY['title'];

                                    }
//
//                                    //
//                                    // ASSEMBLE HTML OUTPUT.
//                                    // LINKS WILL ONLY BE STICKY IF ENCRYPTION HAS BEEN CONFIGURED.
//                                    if(isset($tmp_cache_meta_ARRAY['hyperlink'])){
//
//                                        if(strlen($tmp_cache_meta_ARRAY['hyperlink']) > 0){
//
//
//                                            //
//                                            // <A> BUILD OUT. GET A FULL <A> WRAPPED HTML.
//                                            $tmp_str_out = $this->oCRNRSTN->oCRNRSTN_ASSET_MGR->return_linked_ui_element($tmp_http_path, $tmp_cache_meta_ARRAY['hyperlink'], $tmp_cache_meta_ARRAY['target'], $width, $height, $alt , $title, $url_params_ARRAY);
//
//                                            //
//                                            // CRNRSTN :: ASSET MAPPING PERFORMANCE REPORT.
//                                            //$mem_report_ARRAY = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');
//                                            $mem_report_ARRAY = array(0, 1, 5);
//
//                                            $is_HTML = false;
//                                            $tmp_txt_break = ' ';
//                                            $tmp_mem_str = $this->oCRNRSTN->mem_report($mem_report_ARRAY, 'TEXT', NULL, false, $is_HTML, $tmp_txt_break, '<br>');
//                                            error_log(__LINE__ . ' rrs map TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str);
//
//                                            return $tmp_str_out;
//
//                                        }
//
//                                    }
//
//                                    $tmp_str_out = '<img src="' . $tmp_http_path . '" ' . $width . ' ' . $height . ' ' . $alt . ' ' . $title . '>';

                                    //
                                    // ASSEMBLE HTML OUTPUT.
                                    // LINKS WILL ONLY BE STICKY IF ENCRYPTION HAS BEEN CONFIGURED.
                                    if(isset($tmp_cache_meta_ARRAY['hyperlink'])){

                                        if(strlen($tmp_cache_meta_ARRAY['hyperlink']) > 0){

                                            //
                                            // <A> BUILD OUT. GET A FULL <A> WRAPPED HTML.
                                            $tmp_str_out = $this->oCRNRSTN->oCRNRSTN_ASSET_MGR->return_img_html($tmp_base64, $width, $height, $alt , $title, $tmp_cache_meta_ARRAY['hyperlink'], $tmp_cache_meta_ARRAY['target'], $url_params_ARRAY);
                                            //error_log(__LINE__ . ' rrs map $tmp_str_out[' . $tmp_str_out . '].');

                                            //
                                            // CRNRSTN :: ASSET MAPPING PERFORMANCE REPORT.
                                            //$mem_report_ARRAY = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');
                                            $mem_report_ARRAY = array(0, 1, 5);

                                            $is_HTML = false;
                                            $tmp_txt_break = ' ';
                                            $tmp_mem_str = $this->oCRNRSTN->mem_report($mem_report_ARRAY, 'TEXT', NULL, false, $is_HTML, $tmp_txt_break, '<br>');
                                            //error_log(__LINE__ . ' rrs map TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT $width[' . $width . ']. $height[' . $height . ']. [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str);
                                            $this->oCRNRSTN->error_log('TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT $width[' . $width . ']. $height[' . $height . ']. [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                                            return $tmp_str_out;

                                        }

                                    }

                                    $tmp_str_out = $this->oCRNRSTN->oCRNRSTN_ASSET_MGR->return_img_html($tmp_base64, $width, $height, $alt , $title, NULL, NULL, $url_params_ARRAY);
                                    //$tmp_str_out = '<img src="' . $tmp_base64 . '" ' . $width . ' ' . $height . ' ' . $alt . ' ' . $title . '>';

                                    //
                                    // CRNRSTN :: ASSET MAPPING PERFORMANCE REPORT.
                                    //$mem_report_ARRAY = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');
                                    $mem_report_ARRAY = array(0, 1, 5);

                                    $is_HTML = false;
                                    $tmp_txt_break = ' ';
                                    $tmp_mem_str = $this->oCRNRSTN->mem_report($mem_report_ARRAY, 'TEXT', NULL, false, $is_HTML, $tmp_txt_break, '<br>');
                                    //error_log(__LINE__ . ' rrs map TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT $width[' . $width . ']. $height[' . $height . ']. INT['. print_r((CRNRSTN_HTML & CRNRSTN_BASE64_PNG), true) . ']. [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str);
                                    $this->oCRNRSTN->error_log('TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT $width[' . $width . ']. $height[' . $height . ']. INT['. print_r((CRNRSTN_HTML & CRNRSTN_BASE64_PNG), true) . ']. [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                                    //
                                    // RETURN THE HTML WRAPPED BASE64 ENCODED IMG STRING DATA.
                                    return $tmp_str_out;

                                }

                            }

                        break;
                        case CRNRSTN_HTML & CRNRSTN_PNG:
                        case CRNRSTN_HTML & CRNRSTN_JPEG:
                        case CRNRSTN_HTML:
                            // SOLID case     'CRNRSTN_HTML'             : 7217;          RETURNS PNG, JPG, OR BASE64 (CONFIGURATION DRIVEN) HTML WRAPPED <IMG> DATA.
                            // SOLID 7168     CRNRSTN_HTML & CRNRSTN_PNG                   RETURNS HTML <IMG> WRAPPED PNG URL STRING DATA.
                            // SOLID 7169     CRNRSTN_HTML & CRNRSTN_JPEG                  RETURNS HTML <IMG> WRAPPED JPEG URL STRING DATA.

                            //
                            // CRNRSTN :: CONFIGURATION DATA.
                            // See _crnrstn.config.inc.php. By default, $crnrstn_dir_path = ''.
                            $tmp_crnrstn_path_directory = $this->oCRNRSTN->get_resource('crnrstn_path_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');

                            //error_log(__LINE__ . ' rrs map $tmp_crnrstn_path_directory[' . $tmp_crnrstn_path_directory . ']. $crnrstn_asset_family[' . $crnrstn_asset_family . ']. $salt_ugc[' . $salt_ugc . ']. $asset_meta_key[' . $asset_meta_key . ']. $output_mode_override[' . $output_mode_override . ']. die();');
                            //die();

                            //
                            // CRNRSTN :: SYSTEM DIRECTORY.
                            // See method call config_init_http(), in _crnrstn.config.inc.php where $crnrstn_system_directory = '_crnrstn'.
                            $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');

                            //$tmp_crnrstn_http_endpoint = $this->oCRNRSTN->get_resource('crnrstn_http_endpoint', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');
                            //$tmp_crnrstn_integrations_asset_map_dir_path = $this->oCRNRSTN->get_resource('crnrstn_integrations_asset_map_dir_path', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');

                            //
                            // BUILD FILE PATH.
                            $tmp_filepath = $tmp_crnrstn_path_directory . DIRECTORY_SEPARATOR . $tmp_system_directory . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR . $tmp_file_extension . DIRECTORY_SEPARATOR . $crnrstn_asset_family . DIRECTORY_SEPARATOR . $salt_ugc . '.' . $tmp_file_extension;

                            //
                            // VALIDATE FILE.
                            if(!is_file($tmp_filepath)){

                                //error_log(__LINE__ . ' rrs map $tmp_crnrstn_path_directory[' . $tmp_crnrstn_path_directory . ']. $tmp_cache_version[' . $tmp_filepath . ']. [' . $this->oCRNRSTN->return_int_const_profile($output_mode_override, CRNRSTN_STRING) . '].');

                                // TODO :: MAKE THIS TO BE COMPATIBLE WITH ALL OUTPUT TYPES.
                                // CRNRSTN :: CONFIGURATION DATA.
                                // See // REDIRECTS AND 404 IMG URLS, in _crnrstn/_config/_config.defaults/_crnrstn.system_settings.inc.php
                                // RETURN DEFAULT 404 IMAGE CONTENT.
                                return $this->oCRNRSTN->get_resource('crnrstn_system_404_image_url_replace', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');

                            }

                            //
                            // GET CACHE VERSION ID. THIS METHOD IS COSTLY. USE SPARINGLY BECAUSE IT
                            // IS WHERE, $tmp_cache_version = $file_cache_version_str = '420.00.' . filesize($file_path) . '.' . filemtime($file_path).'.0';
                            $tmp_cache_version = $this->oCRNRSTN->resource_filecache_version($tmp_filepath);

                            //
                            // CONSTRUCT HTTP LINK FOR RESOURCE.
                            $tmp_http_root = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_' . $crnrstn_asset_family . '_asset_map_http_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH'));

                            //
                            // BUILD RESOURCE CACHE DATA ARRAY.
                            $TMP_PLAID_CACHE = $this->return_plaid_cache_ARRAY($salt_ugc, $channel);

                            if($output_mode_override == (CRNRSTN_HTML & CRNRSTN_JPEG)){

                                $tmp_file_extension = $tmp_image_folder = 'jpg';

                            }else{

                                if(($this->oCRNRSTN->is_bit_set(CRNRSTN_ASSET_MODE_JPEG) == true) && !($output_mode_override == (CRNRSTN_HTML & CRNRSTN_PNG))){

                                    $tmp_file_extension = $tmp_image_folder = 'jpg';

                                }else{

                                    $tmp_file_extension = $tmp_image_folder = 'png';

                                }

                            }

                            //
                            // BUILD FILE PATH.
                            //                                                                      _crnrstn/                                  ui/                          imgs/                           png                 /system/apache_feather_logo.php
                            $tmp_filepath = $tmp_crnrstn_path_directory . DIRECTORY_SEPARATOR . $tmp_system_directory . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR . $tmp_image_folder . DIRECTORY_SEPARATOR . $crnrstn_asset_family . DIRECTORY_SEPARATOR . $salt_ugc . '.' . $tmp_file_extension;
                            if(is_file($tmp_filepath)){

                                //error_log(__LINE__ . ' rrs map GOING TO PLAID. $tmp_filepath[' . $tmp_filepath . ']. $tmp_file_extension[' . $tmp_file_extension . ']. $channel[' . $channel . ']. $salt_ugc[' . $salt_ugc . ']. $crnrstn_asset_family[' . $crnrstn_asset_family . ']. $output_mode_override[' . $output_mode_override . ']. $source[' . $source . '].');
                                $this->initialize_cache($crnrstn_asset_family, $salt_ugc, $asset_meta_key, $output_mode_override, $tmp_filepath, $tmp_file_extension);

                                //$this->cache_write('filepath', $tmp_filepath, NULL, $salt_ugc);

                                switch($source){
                                    //case 'return_creative':
                                    case 'return_system_image':
                                        // META DATA HAS BEEN ACQUIRED BY CRNRSTN ::
                                    break;
                                    default:

                                        //
                                        // EXTRACT SYSTEM RESOURCE CACHE META DATA.
                                        $this->oCRNRSTN->cache_meta_ARRAY = $this->oCRNRSTN->asset_data_meta($asset_meta_key, $crnrstn_asset_family);

                                    break;

                                }

                                $tmp_cache_meta_ARRAY['target'] = '_blank';

                                //
                                // PROCESS USER INPUT PARAMETERS.
                                $this->meta_default_override($tmp_cache_meta_ARRAY, 'width', 'width');
                                $this->meta_default_override($tmp_cache_meta_ARRAY, 'height', 'height');
                                $this->meta_default_override($tmp_cache_meta_ARRAY, 'alt', 'alt');
                                $this->meta_default_override($tmp_cache_meta_ARRAY, 'title', 'title');
                                $this->meta_default_override($tmp_cache_meta_ARRAY, 'hyperlink', 'hyperlink');
                                $this->meta_default_override($tmp_cache_meta_ARRAY, 'target', 'target');

                                $url_params_ARRAY = NULL;
                                if(isset($this->cache_meta_ARRAY['url_params_ARRAY'])){

                                    $url_params_ARRAY = $this->oCRNRSTN->cache_meta_ARRAY['url_params_ARRAY'];

                                }

                                //
                                // <IMG> HTML INJECTION DOM ATTRIBUTE STRING PREPARATION.
                                // IF width='25', THEN $width="width='25'"; IF width='', THEN $width='';
                                $width = $this->oCRNRSTN->oCRNRSTN_ASSET_MGR->html_img_dom_return($tmp_cache_meta_ARRAY['width'], 'WIDTH');
                                $height = $this->oCRNRSTN->oCRNRSTN_ASSET_MGR->html_img_dom_return($tmp_cache_meta_ARRAY['height'], 'HEIGHT');
                                $alt = $this->oCRNRSTN->oCRNRSTN_ASSET_MGR->html_img_dom_return($tmp_cache_meta_ARRAY['alt'], 'ALT');
                                $title = $this->oCRNRSTN->oCRNRSTN_ASSET_MGR->html_img_dom_return($tmp_cache_meta_ARRAY['title'], 'TITLE');

                                //
                                // CRNRSTN :: CONFIGURATION FILE INITIALIZED.
                                // See, config_init_asset_map_social_img() in _crnrstn.config.inc.php.
                                if($this->oCRNRSTN->is_bit_set(CRNRSTN_SOCIAL_IMG_ASSET_MAPPING) == true){

                                    //////////
                                    // ASSET MAPPING :: URL BUILD PROFILE.
                                    // https://lightsaber.crnrstn.evifweb.com/?crnrstn_0010111011=jquery-3.6.1.min.map&crnrstn_=420.00.138173.1680672426.0
                                    $tmp_http_path = $tmp_http_root . '?' . $this->oCRNRSTN->session_salt() . '=' . $salt_ugc . '&crnrstn_=' . $tmp_cache_version;

                                    //error_log(__LINE__ . ' rrs map http_path[' . $tmp_http_path . '].');
                                    //die();

                                }else{

                                    //////////
                                    // HARD URL :: URL BUILD PROFILE.
                                    //                  _crnrstn/                                           ui/imgs/                                                    png                                         /system/                                    element_page_load_indicator.png
                                    $tmp_http_path = $tmp_http_root . $tmp_system_directory . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR . $tmp_file_extension . DIRECTORY_SEPARATOR . $TMP_PLAID_CACHE['asset_family'] . DIRECTORY_SEPARATOR . $salt_ugc . '.' . $tmp_file_extension . '?crnrstn_=' . $tmp_cache_version;

                                    //error_log(__LINE__ . ' rrs map http_path[' . $tmp_http_path . '].');
                                    //die();

                                }

                                //
                                // PROCESS USER INPUT PARAMETERS.
                                if(isset($this->oCRNRSTN->cache_meta_ARRAY['width'])){

                                    if(strlen($this->oCRNRSTN->cache_meta_ARRAY['width']) > 0){

                                        $tmp_cache_meta_ARRAY['width'] = $this->oCRNRSTN->cache_meta_ARRAY['width'];
                                        //error_log(__LINE__ . ' rrs map $tmp_cache_meta_ARRAY[' . print_r($tmp_cache_meta_ARRAY, true) . '].');

                                    }

                                }

                                if(isset($this->oCRNRSTN->cache_meta_ARRAY['height'])){

                                    if(strlen($this->oCRNRSTN->cache_meta_ARRAY['height']) > 0){

                                        $tmp_cache_meta_ARRAY['height'] = $this->oCRNRSTN->cache_meta_ARRAY['height'];
                                        //error_log(__LINE__ . ' rrs map $tmp_cache_meta_ARRAY[' . print_r($tmp_cache_meta_ARRAY, true) . '].');

                                    }

                                }

                                if(isset($this->oCRNRSTN->cache_meta_ARRAY['alt'])){

                                    if(strlen($this->oCRNRSTN->cache_meta_ARRAY['alt']) > 0){

                                        $tmp_cache_meta_ARRAY['alt'] = $this->oCRNRSTN->cache_meta_ARRAY['alt'];
                                        //error_log(__LINE__ . ' rrs map $tmp_cache_meta_ARRAY[' . print_r($tmp_cache_meta_ARRAY, true) . '].');

                                    }

                                }

                                if(isset($this->oCRNRSTN->cache_meta_ARRAY['title'])){

                                    if(strlen($this->oCRNRSTN->cache_meta_ARRAY['title']) > 0){

                                        $tmp_cache_meta_ARRAY['title'] = $this->oCRNRSTN->cache_meta_ARRAY['title'];
                                        //error_log(__LINE__ . ' rrs map $tmp_cache_meta_ARRAY[' . print_r($tmp_cache_meta_ARRAY, true) . '].');

                                    }

                                }

                                if(isset($this->oCRNRSTN->cache_meta_ARRAY['hyperlink'])){

                                    if(strlen($this->oCRNRSTN->cache_meta_ARRAY['hyperlink']) > 0){

                                        $tmp_cache_meta_ARRAY['hyperlink'] = $this->oCRNRSTN->cache_meta_ARRAY['hyperlink'];
                                        //error_log(__LINE__ . ' rrs map $tmp_cache_meta_ARRAY[' . print_r($tmp_cache_meta_ARRAY, true) . '].');

                                    }

                                }

                                $tmp_cache_meta_ARRAY['target'] = '_self';      // NOTE: IF LEN<1, THE HARD-CODED INTERNAL DEFAULT IS _SELF.
                                if(isset($this->oCRNRSTN->cache_meta_ARRAY['target'])){

                                    if(strlen($this->oCRNRSTN->cache_meta_ARRAY['target']) > 0){

                                        $tmp_cache_meta_ARRAY['target'] = $this->oCRNRSTN->cache_meta_ARRAY['target'];
                                        //error_log(__LINE__ . ' rrs map $tmp_cache_meta_ARRAY[' . print_r($tmp_cache_meta_ARRAY, true) . '].');

                                    }

                                }

                                $url_params_ARRAY = NULL;
                                if(isset($this->cache_meta_ARRAY['url_params_ARRAY'])){

                                    $url_params_ARRAY = $this->oCRNRSTN->cache_meta_ARRAY['url_params_ARRAY'];

                                }

                                //
                                // <IMG> HTML INJECTION DOM ATTRIBUTE STRING PREPARATION.
                                // IF width='25', THEN $width="width='25'"; IF width='', THEN $width='';
                                $width = '';
                                if(isset($tmp_cache_meta_ARRAY['width'])){

                                    //$width = $this->oCRNRSTN->oCRNRSTN_ASSET_MGR->html_img_dom_return($tmp_cache_meta_ARRAY['width'], 'WIDTH');
                                    $width = $tmp_cache_meta_ARRAY['width'];


                                }

                                $height = '';
                                if(isset($tmp_cache_meta_ARRAY['height'])){

                                    //$height = $this->oCRNRSTN->oCRNRSTN_ASSET_MGR->html_img_dom_return($tmp_cache_meta_ARRAY['height'], 'HEIGHT');
                                    $height = $tmp_cache_meta_ARRAY['height'];

                                }

                                $alt = '';
                                if(isset($tmp_cache_meta_ARRAY['alt'])){

                                    //$alt = $this->oCRNRSTN->oCRNRSTN_ASSET_MGR->html_img_dom_return($tmp_cache_meta_ARRAY['alt'], 'ALT');
                                    $alt = $tmp_cache_meta_ARRAY['alt'];

                                }

                                $title = '';
                                if(isset($tmp_cache_meta_ARRAY['title'])){

                                    //$title = $this->oCRNRSTN->oCRNRSTN_ASSET_MGR->html_img_dom_return($tmp_cache_meta_ARRAY['title'], 'TITLE');
                                    $title = $tmp_cache_meta_ARRAY['title'];

                                }

                                //
                                // ASSEMBLE HTML OUTPUT.
                                // LINKS WILL ONLY BE STICKY IF ENCRYPTION HAS BEEN CONFIGURED.
                                if(isset($tmp_cache_meta_ARRAY['hyperlink'])){

                                    if(strlen($tmp_cache_meta_ARRAY['hyperlink']) > 0){


                                        //
                                        // <A> BUILD OUT. GET A FULL <A> WRAPPED HTML.
                                        $tmp_str_out = $this->oCRNRSTN->oCRNRSTN_ASSET_MGR->return_img_html($tmp_http_path, $width, $height, $alt , $title, $tmp_cache_meta_ARRAY['hyperlink'], $tmp_cache_meta_ARRAY['target'], $url_params_ARRAY);

                                        //
                                        // CRNRSTN :: ASSET MAPPING PERFORMANCE REPORT.
                                        //$mem_report_ARRAY = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');
                                        $mem_report_ARRAY = array(0, 1, 5);

                                        $is_HTML = false;
                                        $tmp_txt_break = ' ';
                                        $tmp_mem_str = $this->oCRNRSTN->mem_report($mem_report_ARRAY, 'TEXT', NULL, false, $is_HTML, $tmp_txt_break, '<br>');
                                        //error_log(__LINE__ . ' rrs map TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str);
                                        $this->oCRNRSTN->error_log('TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                                        return $tmp_str_out;

                                    }

                                }

                                $tmp_str_out = $this->oCRNRSTN->oCRNRSTN_ASSET_MGR->return_img_html($tmp_http_path, $width, $height, $alt , $title, NULL, NULL, $url_params_ARRAY);

                                //
                                // CRNRSTN :: ASSET MAPPING PERFORMANCE REPORT.
                                //$mem_report_ARRAY = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');
                                $mem_report_ARRAY = array(0, 1, 5);

                                $is_HTML = false;
                                $tmp_txt_break = ' ';
                                $tmp_mem_str = $this->oCRNRSTN->mem_report($mem_report_ARRAY, 'TEXT', NULL, false, $is_HTML, $tmp_txt_break, '<br>');
                                //error_log(__LINE__ . ' rrs map TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str);
                                $this->oCRNRSTN->error_log('TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                                //
                                // RETURN THE HTML WRAPPED BASE64 ENCODED JPEG STRING DATA.
                                return $tmp_str_out;

                            }

                        break;
//
//                        case CRNRSTN_BASE64_JPEG:
//                            // SOLID case 'CRNRSTN_BASE64_PNG'               : 7214;             RETURNS data:image/jpg;base64 STRING DATA.
//                            // SOLID case 'CRNRSTN_BASE64_JPEG'              : 7215;             RETURNS data:image/jpg;base64 STRING DATA.
//
//                            //
//                            // CRNRSTN :: CONFIGURATION DATA.
//                            // See _crnrstn.config.inc.php. By default, $crnrstn_dir_path = ''.
//                            $tmp_crnrstn_path_directory = $this->oCRNRSTN->get_resource('crnrstn_path_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');
//
//                            //
//                            // CRNRSTN :: SYSTEM DIRECTORY.
//                            // See method call config_init_http(), in _crnrstn.config.inc.php where $crnrstn_system_directory = '_crnrstn'.
//                            $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');
//
//                            //
//                            // BUILD FILE PATH.
//                            //                                                                      _crnrstn/                                  ui/                          imgs/                           base64/system/apache_feather_logo.php
//                            $tmp_filepath = $tmp_crnrstn_path_directory . DIRECTORY_SEPARATOR . $tmp_system_directory . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR . 'base64' . DIRECTORY_SEPARATOR . $crnrstn_asset_family . DIRECTORY_SEPARATOR . $salt_ugc . '.php';
//
//                            if(is_file($tmp_filepath)){
//
//                                //error_log(__LINE__ . ' rrs map GOING TO PLAID. $tmp_filepath[' . $tmp_filepath . ']. $tmp_file_extension[' . $tmp_file_extension . ']. $channel[' . $channel . ']. $salt_ugc[' . $salt_ugc . ']. $crnrstn_asset_family[' . $crnrstn_asset_family . ']. $output_mode_override[' . $output_mode_override . ']. $source[' . $source . '].');
//                                $this->initialize_cache($crnrstn_asset_family, $salt_ugc, $asset_meta_key, $output_mode_override, $tmp_filepath, $tmp_file_extension);
//
//                                //$this->cache_write('filepath', $tmp_filepath, NULL, $salt_ugc);
//
//                                if($output_mode_override == CRNRSTN_BASE64_JPEG){
//
//                                    self::$image_output_mode = CRNRSTN_BASE64_JPEG;
//
//                                }else{
//
//                                    self::$image_output_mode = CRNRSTN_BASE64_PNG;
//
//                                }
//
//                                //
//                                // LOAD THE BASE64 META DATA FILE.
//                                include($tmp_filepath);
//
//                                //
//                                // IF THE BASE64 FILE HAS SUCCESSFULLY LOADED, THIS VALUE, $system_file_serial,
//                                // (AND ALL OTHERS BELOW) WILL BE SET.
//                                if(isset($system_file_serial)){
//
//                                    //
//                                    // BASE64 DATA AND SOME META.
//                                    //$tmp_datecreated = self::$image_filesystem_meta_ARRAY[self::$image_output_mode][self::$request_salt][$system_file_serial]['datecreated_base64_PNG'];
//                                    //$tmp_lastmodified = self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_PNG][self::$request_salt][$system_file_serial]['lastmodified_base64_PNG'];
//                                    $tmp_base64 = self::$image_filesystem_meta_ARRAY[self::$image_output_mode][self::$request_salt][$system_file_serial ]['base64'];
//
//                                    //
//                                    // CRNRSTN :: ASSET MAPPING PERFORMANCE REPORT.
//                                    //$mem_report_ARRAY = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');
//                                    $mem_report_ARRAY = array(0, 1, 5);
//
//                                    $is_HTML = false;
//                                    $tmp_txt_break = ' ';
//                                    $tmp_mem_str = $this->oCRNRSTN->mem_report($mem_report_ARRAY, 'TEXT', NULL, false, $is_HTML, $tmp_txt_break, '<br>');
//                                    error_log(__LINE__ . ' rrs map TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str);
//                                    $this->oCRNRSTN->error_log('TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
//
//                                    //
//                                    // RETURN BASE64 ENCODED FILE DATA.
//                                    return $tmp_base64;
//
//                                }
//
//                            }
//
//                        break;

                        case CRNRSTN_IMG:
                        case CRNRSTN_PNG:
                        case CRNRSTN_ASSET_MODE_PNG:
                        case CRNRSTN_JPEG:
                        case CRNRSTN_ASSET_MODE_JPEG:
                            // SOLID case 'CRNRSTN_IMG'                      : 7211;             RETURNS A GZIPPED (OPTIONALLY) PNG OR JPG FILE (*CONFIGURATION DRIVEN).
                            // SOLID case 'CRNRSTN_PNG'                      : 7812;             RETURNS A GZIPPED (OPTIONALLY) PNG FILE.
                            // SOLID case 'CRNRSTN_JPEG'                     : 7813;             RETURNS A GZIPPED (OPTIONALLY) JPG FILE.
                            // SOLID case 'CRNRSTN_ASSET_MODE_PNG'           : 7511;             RETURNS A GZIPPED (OPTIONALLY) PNG FILE.
                            // SOLID case 'CRNRSTN_ASSET_MODE_JPEG'          : 7512;             RETURNS A GZIPPED (OPTIONALLY) JPG FILE.

                            if($output_mode_override == CRNRSTN_PNG){

                                $tmp_file_extension = $tmp_image_folder = 'png';

                            }else{

                                if($output_mode_override == CRNRSTN_JPEG || $output_mode_override == CRNRSTN_ASSET_MODE_JPEG || (($output_mode_override == CRNRSTN_IMG) && (!$this->oCRNRSTN->is_bit_set(CRNRSTN_ASSET_MODE_PNG) == true))){

                                    $tmp_file_extension = $tmp_image_folder = 'jpg';

                                }else{

                                    $tmp_file_extension = $tmp_image_folder = 'png';

                                }

                            }

                            //
                            // CRNRSTN :: CONFIGURATION DATA.
                            // See _crnrstn.config.inc.php. By default, $crnrstn_dir_path = ''.
                            $tmp_crnrstn_path_directory = $this->oCRNRSTN->get_resource('crnrstn_path_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');

                            //
                            // CRNRSTN :: SYSTEM DIRECTORY.
                            // See method call config_init_http(), in _crnrstn.config.inc.php where $crnrstn_system_directory = '_crnrstn'.
                            $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');

                            //
                            // BUILD FILE PATH.
                            //                                                                      _crnrstn                                   /ui/                         imgs/                               png/                                    system/                                  crnrstn_logo_lg.png
                            $tmp_filepath = $tmp_crnrstn_path_directory . DIRECTORY_SEPARATOR . $tmp_system_directory . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR . $tmp_image_folder . DIRECTORY_SEPARATOR . $crnrstn_asset_family . DIRECTORY_SEPARATOR . $salt_ugc . '.' . $tmp_file_extension;
                            if(is_file($tmp_filepath)){

                                //error_log(__LINE__ . ' rrs map GOING TO PLAID. $tmp_filepath[' . $tmp_filepath . ']. $tmp_file_extension[' . $tmp_file_extension . ']. $channel[' . $channel . ']. $salt_ugc[' . $salt_ugc . ']. $crnrstn_asset_family[' . $crnrstn_asset_family . ']. $output_mode_override[' . $output_mode_override . ']. $source[' . $source . '].');
                                $this->initialize_cache($crnrstn_asset_family, $salt_ugc, $asset_meta_key, $output_mode_override, $tmp_filepath, $tmp_file_extension);

                                //
                                // EXTRACT SYSTEM RESOURCE CACHE META DATA.
                                $tmp_cache_meta_ARRAY = $this->oCRNRSTN->asset_data_meta($asset_meta_key, $crnrstn_asset_family);

                                $tmp_header_options_ARRAY = array();

                                $tmp_header_options_ARRAY[] = $this->oCRNRSTN->get_resource('header_response_option_cache_control', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');
                                $tmp_header_options_ARRAY[] = $this->oCRNRSTN->get_resource('header_response_option_x_frame_options', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

                                $tmp_filename_clean = $this->oCRNRSTN->oCRNRSTN_ASSET_MGR->process_for_filename($tmp_cache_meta_ARRAY['filename']);

                                $tmp_curr_headers_ARRAY = headers_list();
                                $tmp_crnrstn_signature_headers_ARRAY = $this->oCRNRSTN->header_signature_options_return();

                                //
                                // SOURCE :: https://stackoverflow.com/questions/9728269/content-length-and-other-http-headers
                                // COMMENT :: https://stackoverflow.com/a/9728576
                                // AUTHOR :: Neysor :: https://stackoverflow.com/users/1219121/neysor
                                $tmp_filesize = filesize($tmp_filepath);
                                $tmp_header_options_ARRAY[] = 'Content-Type: ' . mime_content_type($tmp_filepath);
                                $tmp_header_options_ARRAY[] = 'Content-length: ' . $tmp_filesize;
                                if(isset($tmp_file_extension)){

                                    $tmp_header_options_ARRAY[] = 'Content-Disposition: inline; filename="' . $tmp_filename_clean . '.' . $tmp_file_extension . '"';

                                }

                                $tmp_date_lastmod = filemtime($tmp_filepath);
                                $tmp_date_lastmod = date('D, j M Y G:i:s T', $tmp_date_lastmod);
                                $tmp_header_options_ARRAY[] = 'Last-Modified: ' . $tmp_date_lastmod;

                                //
                                // ENSURE ALL SIGNATURE HEADERS ARE IN PLACE AND CONTINUE
                                $this->oCRNRSTN->header_options_add($tmp_curr_headers_ARRAY);
                                $this->oCRNRSTN->header_options_add($tmp_crnrstn_signature_headers_ARRAY);
                                $this->oCRNRSTN->header_options_add($tmp_header_options_ARRAY);

                                $this->oCRNRSTN->header_options_apply();

                                error_log(__LINE__ . ' rrs map [' . $tmp_filename_clean . '.' . $tmp_file_extension . '][' . mime_content_type($tmp_filepath) . ']. $tmp_date_lastmod[' . $tmp_date_lastmod . ']. [' . $tmp_filepath . '].');

                                //
                                // TODO :: PHP RETURNS BYTES READ. DO WE TRACK FOR PLAID REPORTING?
                                // $bytes_read =
                                $this->oCRNRSTN->oCRNRSTN_ASSET_MGR->readfile_chunked($tmp_filepath);

                                //
                                // CRNRSTN :: ASSET MAPPING PERFORMANCE REPORT.
                                //$mem_report_ARRAY = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');
                                $mem_report_ARRAY = array(0, 1, 5);

                                $is_HTML = false;
                                $tmp_txt_break = ' ';
                                $tmp_mem_str = $this->oCRNRSTN->mem_report($mem_report_ARRAY, 'TEXT', NULL, false, $is_HTML, $tmp_txt_break, '<br>');
                                //error_log(__LINE__ . ' rrs map TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str);
                                $this->oCRNRSTN->error_log('TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                                if(ob_get_level() > 0){ob_flush();}
                                flush();
                                exit();

                            }

                        break;
                        case CRNRSTN_STRING:
                            // case 'CRNRSTN_STRING'                  : 7216;             RETURNS PNG OR JPG (CONFIGURATION DRIVEN) IMAGE URL STRING DATA.
                            //
                            // CRNRSTN_STRING. NAKED URL RETURN.
                            // THE CRNRSTN_STRING OUTPUT_MODE SUPPORTS ASSET URL REQUESTS. E.G. TWITTER/FB SOCIAL
                            // MEDIA PREVIEW URLS, FAVICON META, ETC. THIS IS NAKED LINK RETURN.

                            // TODO :: REVIEW THIS IN LIGHT OF EXPANDED FILE SYSTEM SUPPORT OF RELEVANT FILE TYPES.
                            // SEE BASE64, FAVICON, PNG, JPG, GIF, BMP, SVG, TIF, AND PIC.
                            if($output_mode_override == CRNRSTN_PNG){

                                $tmp_file_extension = $tmp_image_folder = 'png';

                            }else{

                                if($output_mode_override == CRNRSTN_JPEG || $output_mode_override == CRNRSTN_ASSET_MODE_JPEG || (($output_mode_override == CRNRSTN_IMG) && (!$this->oCRNRSTN->is_bit_set(CRNRSTN_ASSET_MODE_PNG) == true))){

                                    $tmp_file_extension = $tmp_image_folder = 'jpg';

                                }else{

                                    $tmp_file_extension = $tmp_image_folder = 'png';

                                }

                            }

                            //
                            // CRNRSTN :: CONFIGURATION DATA.
                            // See _crnrstn.config.inc.php. By default, $crnrstn_dir_path = ''.
                            $tmp_crnrstn_path_directory = $this->oCRNRSTN->get_resource('crnrstn_path_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');

                            //
                            // CRNRSTN :: SYSTEM DIRECTORY.
                            // See method call config_init_http(), in _crnrstn.config.inc.php where $crnrstn_system_directory = '_crnrstn'.
                            $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');

                            //
                            // BUILD FILE PATH.
                            //$tmp_filepath = $tmp_crnrstn_path_directory . DIRECTORY_SEPARATOR . $tmp_system_directory . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR . $tmp_image_folder . DIRECTORY_SEPARATOR . $crnrstn_asset_family . DIRECTORY_SEPARATOR . $salt_ugc . '.' . $tmp_file_extension;
                            $tmp_filepath = $tmp_crnrstn_path_directory . DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR . $tmp_image_folder . DIRECTORY_SEPARATOR . $crnrstn_asset_family . DIRECTORY_SEPARATOR . $salt_ugc . '.' . $tmp_file_extension;
                            //$tmp_filepath = $tmp_crnrstn_path_directory . DIRECTORY_SEPARATOR . $tmp_system_directory . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR . $tmp_image_folder . DIRECTORY_SEPARATOR . $salt_ugc . '.' . $tmp_file_extension;

                            $tmp_cache_version = $this->oCRNRSTN->resource_filecache_version($tmp_filepath);
                            //error_log(__LINE__ . ' rrs map $salt_ugc[' . $salt_ugc . ']. $tmp_crnrstn_path_directory[' . $tmp_crnrstn_path_directory . ']. $tmp_cache_version[' . $tmp_cache_version . ']. [' . $this->oCRNRSTN->return_int_const_profile($output_mode_override, CRNRSTN_STRING) . '].');

                            //error_log(__LINE__ . ' rrs map GOING TO PLAID. $tmp_filepath[' . $tmp_filepath . ']. $tmp_file_extension[' . $tmp_file_extension . ']. $channel[' . $channel . ']. $salt_ugc[' . $salt_ugc . ']. $crnrstn_asset_family[' . $crnrstn_asset_family . ']. $output_mode_override[' . $output_mode_override . ']. $source[' . $source . '].');
                            $this->initialize_cache($crnrstn_asset_family, $salt_ugc, $asset_meta_key, $output_mode_override, $tmp_filepath, $tmp_file_extension);

                            //
                            // CONSTRUCT HTTP LINK FOR RESOURCE.
                            // See config_init_asset_map_favicon() in _crnrstn.config.inc.php. Where, $http_path = ''.
                            $tmp_http_root = $this->oCRNRSTN->crnrstn_http_endpoint($this->oCRNRSTN->get_resource('crnrstn_' . $crnrstn_asset_family . '_asset_map_http_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH'));

                            //
                            // CRNRSTN :: CONFIGURATION FILE INITIALIZED.
                            // See, config_init_asset_map_system_img() in _crnrstn.config.inc.php.
                            if($this->oCRNRSTN->is_bit_set(CRNRSTN_SYSTEM_IMG_ASSET_MAPPING) == true){

                                //////////
                                // ASSET MAPPING :: URL BUILD PROFILE.
                                // https://lightsaber.crnrstn.evifweb.com/?crnrstn_0010111011=jquery-3.6.1.min.map&crnrstn_=420.00.138173.1680672426.0
                                $tmp_http_path = $tmp_http_root . '?' . $this->oCRNRSTN->session_salt() . '=' . $salt_ugc . '&crnrstn_=' . $tmp_cache_version;

                                //
                                // CRNRSTN :: ASSET MAPPING PERFORMANCE REPORT.
                                //$mem_report_ARRAY = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');
                                $mem_report_ARRAY = array(0, 1, 5);

                                $is_HTML = false;
                                $tmp_txt_break = ' ';
                                $tmp_mem_str = $this->oCRNRSTN->mem_report($mem_report_ARRAY, 'TEXT', NULL, false, $is_HTML, $tmp_txt_break, '<br>');
                                //error_log(__LINE__ . ' rrs map TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str);
                                $this->oCRNRSTN->error_log('TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                                return $tmp_http_path;

                            }

                            //error_log(__LINE__ . ' rrs map $tmp_cache_version[' . $tmp_cache_version . ']. [' . $this->oCRNRSTN->return_int_const_profile($output_mode_override, CRNRSTN_STRING) . '].');
                            //die();
                            //$tmp_crnrstn_path_directory = $this->oCRNRSTN->get_resource('crnrstn_path_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');

                            //
                            // CRNRSTN :: SYSTEM DIRECTORY.
                            // See method call config_init_http(), in _crnrstn.config.inc.php where $crnrstn_system_directory = '_crnrstn'.
                            $tmp_system_directory = $this->oCRNRSTN->get_resource('crnrstn_system_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');

                            //
                            // BUILD FILE PATH.
                            //                                                                      _crnrstn                                   /ui/                         imgs/                               png/                                    system/                                  crnrstn_logo_lg.png
                            //$tmp_filepath = $tmp_crnrstn_path_directory . DIRECTORY_SEPARATOR . $tmp_system_directory . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR . $tmp_image_folder . DIRECTORY_SEPARATOR . $crnrstn_asset_family . DIRECTORY_SEPARATOR . $salt_ugc . '.' . $tmp_file_extension;

                            //////////
                            // HARD URL :: URL BUILD PROFILE.
                            //                  _crnrstn/                                           ui/imgs/                                                    png                                         /system/                                    element_page_load_indicator.png
                            $tmp_http_path = $tmp_http_root . $tmp_system_directory . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR . $tmp_file_extension . DIRECTORY_SEPARATOR . $crnrstn_asset_family . DIRECTORY_SEPARATOR . $salt_ugc . '.' . $tmp_file_extension . '?crnrstn_=' . $tmp_cache_version;
                            //$tmp_http_path = $tmp_http_root . $tmp_system_directory . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR . $tmp_file_extension . DIRECTORY_SEPARATOR . $salt_ugc . '.' . $tmp_file_extension . '?crnrstn_=' . $tmp_cache_version;

                            //
                            // CRNRSTN :: ASSET MAPPING PERFORMANCE REPORT.
                            //$mem_report_ARRAY = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');
                            $mem_report_ARRAY = array(0, 1, 5);

                            $is_HTML = false;
                            $tmp_txt_break = ' ';
                            $tmp_mem_str = $this->oCRNRSTN->mem_report($mem_report_ARRAY, 'TEXT', NULL, false, $is_HTML, $tmp_txt_break, '<br>');
                            //error_log(__LINE__ . ' rrs map TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str);
                            $this->oCRNRSTN->error_log('TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                            return $tmp_http_path;

                        break;
                        //case CRNRSTN_BASE64_GIF:  // PENDING BASE64 RE-ARCH FOR IMPLEMENTATION.
                        case CRNRSTN_BASE64:

                            $tmp_filepath = CRNRSTN_ROOT . DIRECTORY_SEPARATOR . '_crnrstn' . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR . 'imgs' . DIRECTORY_SEPARATOR . 'base64' . DIRECTORY_SEPARATOR . $this->get_cache('asset_family', $salt_ugc) . DIRECTORY_SEPARATOR . $salt_ugc . '.php';

                            if(is_file($tmp_filepath)){

                                if(($output_mode_override !== (CRNRSTN_BASE64_GIF)) && ($output_mode_override !== (CRNRSTN_BASE64_PNG))){

                                    //
                                    // INITIALIZE THE BASE64-ENCODE-VERSION-TOGGLE TO TRIP THE LOADING OF
                                    // THE PNG VERSION OF THE SYSTEM ASSET INTO MEMORY WHEN THE BASE64.PHP
                                    // FILE LOADS.
                                    self::$image_output_mode = CRNRSTN_BASE64_JPEG;
                                    //error_log(__LINE__ . ' rrs map $tmp_filepath[' . $tmp_filepath . ']. RETURNS HTML <IMG> WRAPPED data:image/png;base64 OR data:image/jpg;base64 (CONFIGURATION DRIVEN) STRING DA...');

                                }else{

                                    //if($output_mode_override == (CRNRSTN_HTML & CRNRSTN_BASE64_JPEG)){
                                    if($output_mode_override == CRNRSTN_BASE64_JPEG){

                                        self::$image_output_mode = CRNRSTN_BASE64_JPEG;
                                        //error_log(__LINE__ . ' rrs map $tmp_filepath[' . $tmp_filepath . ']. RETURNS HTML <IMG> WRAPPED data:image/png;base64 OR data:image/jpg;base64 (CONFIGURATION DRIVEN) STRING DA...');

                                    }else{

                                        if($output_mode_override == CRNRSTN_BASE64_PNG){

                                            self::$image_output_mode = CRNRSTN_BASE64_PNG;
                                            //error_log(__LINE__ . ' rrs map $tmp_filepath[' . $tmp_filepath . ']. RETURNS HTML <IMG> WRAPPED data:image/png;base64 OR data:image/jpg;base64 (CONFIGURATION DRIVEN) STRING DA...');

                                        }else{

                                            //
                                            // CRNRSTN :: CONFIGURATION FILE INITIALIZED.
                                            // See, config_init_asset_map_favicon_img() in _crnrstn.config.inc.php.
                                            if($this->oCRNRSTN->is_bit_set(CRNRSTN_ASSET_MODE_JPEG) == true){

                                                self::$image_output_mode = CRNRSTN_BASE64_JPEG;
                                                //error_log(__LINE__ . ' rrs map $tmp_filepath[' . $tmp_filepath . ']. RETURNS HTML <IMG> WRAPPED data:image/png;base64 OR data:image/jpg;base64 (CONFIGURATION DRIVEN) STRING DA...');

                                            }else{

                                                self::$image_output_mode = CRNRSTN_BASE64_PNG;
                                                //error_log(__LINE__ . ' rrs map $tmp_filepath[' . $tmp_filepath . ']. RETURNS HTML <IMG> WRAPPED data:image/png;base64 OR data:image/jpg;base64 (CONFIGURATION DRIVEN) STRING DA...');

                                            }

                                        }

                                    }

                                }

                                //
                                // LOAD THE BASE64 META DATA FILE.
                                include($tmp_filepath);

                                //
                                // IF THE BASE64 FILE HAS SUCCESSFULLY LOADED, THIS VALUE, $system_file_serial,
                                // (AND ALL OTHERS BELOW) WILL BE SET.
                                if(isset($system_file_serial)){

                                    //
                                    // BASE64 DATA AND SOME META.
                                    //$tmp_datecreated = self::$image_filesystem_meta_ARRAY[self::$image_output_mode][self::$request_salt][$system_file_serial]['datecreated_base64_PNG'];
                                    //$tmp_lastmodified = self::$image_filesystem_meta_ARRAY[CRNRSTN_BASE64_PNG][self::$request_salt][$system_file_serial]['lastmodified_base64_PNG'];
                                    $tmp_base64 = self::$image_filesystem_meta_ARRAY[self::$image_output_mode][self::$request_salt][$system_file_serial ]['base64'];

                                    //
                                    // CRNRSTN :: ASSET MAPPING PERFORMANCE REPORT.
                                    //$mem_report_ARRAY = $this->oCRNRSTN->get_resource('mem_rpt_plaid_performance', 0, 'CRNRSTN::RESOURCE::REPORTING');
                                    $mem_report_ARRAY = array(0, 1, 5);

                                    $is_HTML = false;
                                    $tmp_txt_break = ' ';
                                    $tmp_mem_str = $this->oCRNRSTN->mem_report($mem_report_ARRAY, 'TEXT', NULL, false, $is_HTML, $tmp_txt_break, '<br>');
                                    //error_log(__LINE__ . ' rrs map TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str);
                                    $this->oCRNRSTN->error_log('TODO :: CRNRSTN :: PLAID PERFORMANCE REPORT [' . $salt_ugc . ']. $source[' . $source . ']. ' . $tmp_mem_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                                    //
                                    // RETURN THE BASE64 STRING DATA.
                                    return $tmp_base64;

                                }

                            }

                        break;
                        default:

                            //
                            // TODO :: CONSIDER SUPPORTING ANY OUTPUT_MODE THAT TOUCHES THIS DEFAULT.
                            error_log(__LINE__ . ' rrs map CRNRSTN :: PLAID Unmapped resource OUTPUT_MODE [' . $this->oCRNRSTN->return_int_const_profile($output_mode_override, CRNRSTN_STRING) . '].');
                            die();

                        break;

                    }

                break;
                default:

                    //error_log(__LINE__ . ' rrs map CRNRSTN :: PLAID Unmapped asset_family[' . $TMP_PLAID_CACHE['asset_family'] .'] received. Not returning the requested resource [' . $salt_ugc . ']. UNMAPPED RESOURCE OUTPUT_MODE [' . $this->oCRNRSTN->return_int_const_profile($output_mode_override, CRNRSTN_STRING) . '].');
                    //die();

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    //throw new Exception('Unknown resource family [' . $TMP_PLAID_CACHE['asset_family'] . '] provided.');

                break;

            }

            $this->oCRNRSTN->return_server_response_code(404, $this->oCRNRSTN->return_CRNRSTN_ASCII_ART());
            exit();

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

        //
        // RAW IMAGE OUTPUT AND BUFFER FLUSH ABOVE.
        return false;

    }

    public function initialize_request($request_ugc_val, $asset_family, $asset_meta_key, $asset_meta_path, $asset_meta_ARRAY, $raw_output_mode = NULL, $output_mode = NULL){

        if(isset($output_mode)){

            //
            // TAKE THIS TO CRNRSTN :: PLAID. WRITE TO APPLICATION ACCELERATION CACHE FOR ALL ACTIVE CHANNELS.
            $this->cache_write('output_mode', $output_mode, $asset_family, NULL, $request_ugc_val);

        }

        //
        // NOW THAT WE HAVE ALL ROADS TO CONVERGE. SOME PREPARATION FOR WHAT FOLLOWS.
        switch($asset_family){
            case 'css':
            case 'js':

                self::$rrs_map_return_is_asset_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial][$request_ugc_val] = 1;

                $tmp_filename_ARRAY = explode('.', $request_ugc_val);
                $file_extension = array_pop($tmp_filename_ARRAY);
                $this->cache_write('file_ext', $file_extension, $asset_family, NULL, $request_ugc_val);

            break;
            case 'favicon':
            case 'social':
            case 'system':
            case 'integrations':

                self::$rrs_map_return_is_asset_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial][$request_ugc_val] = 1;

            break;
            case 'meta':        // SOCIAL PREVIEW TAGS + SEO
            case 'module_key':  // DOCUMENTATION
            default:

                //
                // AS FAR AS ASSET RETURN IS CONCERNED...THESE ARE NOT YOUR AVERAGE BEAR.
                self::$rrs_map_return_is_asset_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial][$request_ugc_val] = 0;

            break;

        }

        error_log(__LINE__ . ' rrs map $request_ugc_val[' . $request_ugc_val . ']. $output_mode[' . $output_mode . ']. $raw_output_mode[' . $raw_output_mode . ']. cache[' . print_r(self::$cache_ARRAY, true) . ']. die();');
        /*
        [Thu Apr 20 04:43:24.289856 2023] [:error] [pid 12549] [client 172.16.225.1:55457] 5260 rrs map
        $request_ugc_val[crnrstn.main.js]. $output_mode[7208].
        $raw_output_mode[7208]. cache[
        Array\n(\n    [gf86mam1fS7XYWIiFEqxFpF1q8n346XhIy8rVrCe6RcZS4ECvVr7pXJd6CpNDXJG] =>
        Array\n        (\n
            [cache_id] =>
                Array\n                (\n
                    [crnrstn.main.js] => 0\n                )\n\n
            [ipaddress_id] =>
                Array\n                (\n
                    [172.16.225.1] => 0\n                )\n\n
            [resource_bytes] =>
                Array\n                (\n                    [0] => 375\n                )\n\n
            [filename] =>
                Array\n                (\n                    [0] => crnrstn.main.js\n                )\n\n
            [request_family] =>
                Array\n                (\n                    [0] => js\n                )\n\n
            [asset_meta_key] =>
                Array\n                (\n                    [0] => /\n                )\n\n
            [datecreated] =>
                Array\n                (\n                    [0] => 1681980204\n                )\n\n
            [createdby_client_ip] =>
                Array\n                (\n                    [0] => 0\n                )\n\n
            [lastmodified] =>
                Array\n                (\n                    [0] => 1681980204\n                )\n\n
            [modifiedby_client_ip] =>
                Array\n                (\n                    [0] => 0\n                )\n\n
            [output_mode] =>
                Array\n                (\n                    [0] => 7208\n                )\n\n
            [raw_output_mode] =>
                Array\n                (\n                    [0] => 7208\n                )\n\n
            [meta_path] =>
                Array\n                (\n                    [0] => /\n                )\n\n

        )\n\n)\n]. die();

        */

        //
        // INITIALIZE MAP CACHE RESOURCE IDS.
        if(!isset(self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$request_ugc_val])){

            self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$request_ugc_val] = self::$channel_resource_id_ARRAY['cache_id']['runtime'];
            self::$channel_resource_id_ARRAY['cache_id']['runtime']++;

            if(!isset($this->oCRNRSTN->request_serial)){

                //
                // INITIALIZE A REQUEST SERIAL FOR TRACKING THE STATE OF THE MAP FOR RESOURCE RETURN.
                $this->oCRNRSTN->request_serial = $this->oCRNRSTN->generate_new_key();

            }

            //error_log(__LINE__ . ' rrs map *** NEW REQUEST SERIAL *** [' . $this->oCRNRSTN->request_serial . ']. {MOVED LOGIC FROM init_request_family()}. $cache_id_ARRAY[' . print_r(self::$cache_id_ARRAY,true) . '].');

            //
            // EXPOSE THIS NEW SERIAL TO THE CRNRSTN :: PLAID ARCHITECTURE.
            $this->ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial] = $request_ugc_val;
            //error_log(__LINE__ . ' rrs map $request_ugc_val[' . $request_ugc_val . ']. $asset_family[' . $asset_family . ']. $asset_meta_key[' . $asset_meta_key . ']. $asset_meta_path[' . $asset_meta_path . ']. $request_asset_meta_key_ARRAY[' . print_r(self::$request_asset_meta_key_ARRAY, true) . ']. $raw_output_mode[' . $raw_output_mode . ']. $output_mode[' . $output_mode . ']. die();');

            //
            // THIS FORK ALLOWS $_GET AND METHOD_DRIVEN MAPPED RESOURCES TO BE MULTI-FORMAT SERIALIZED.
            // IS THIS THE BEST? ....NO!!!
            // WE COULD EASILY REDUCE TO JUST $this->oCRNRSTN->request_serial. AS WE CARE LESS ABOUT METHOD DRIVEN REQUESTS NOW. DO THIS!!
            $this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial] = $this->oCRNRSTN->request_serial;

            self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]] = $request_ugc_val;
            self::$request_family_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$request_ugc_val]] = $asset_family;

            $tmp_ARRAY = array();
            $tmp_ARRAY['filename'] = $request_ugc_val;
            $tmp_ARRAY['asset_family'] = $asset_family;
            $tmp_ARRAY['raw_output_mode'] = $raw_output_mode;

        }else{

            error_log(__LINE__ . ' rrs map $request_ugc_val[' . $request_ugc_val . ']. $asset_family[' . $asset_family . ']. $asset_meta_key[' . $asset_meta_key . ']. $asset_meta_path[' . $asset_meta_path . ']. $request_asset_meta_key_ARRAY[' . print_r(self::$request_asset_meta_key_ARRAY, true) . ']. $raw_output_mode[' . $raw_output_mode . ']. $output_mode[' . $output_mode . ']. die();');

            $this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial] = $this->oCRNRSTN->request_serial;
            self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]] = $request_ugc_val;
            self::$request_asset_meta_key_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$request_ugc_val]] = $asset_meta_key;
            self::$request_family_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$request_ugc_val]] = $asset_family;
            //self::$request_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$request_ugc_val]] = $output_mode;

        }

        //error_log(__LINE__ . ' rrs map $request_ugc_val[' . $request_ugc_val . ']. $asset_family[' . $asset_family . ']. $asset_meta_key[' . $asset_meta_key . ']. $asset_meta_path[' . $asset_meta_path . ']. $request_asset_meta_key_ARRAY[' . print_r(self::$request_asset_meta_key_ARRAY, true) . ']. $raw_output_mode[' . $raw_output_mode . ']. $output_mode[' . $output_mode . ']. die();');

        /*
        [Thu Apr 13 02:42:50.991900 2023] [:error] [pid 123413] [client 172.16.225.1:53488] 679 rrs map
        RUNTIME EXTRACTED FOR MERGE INTO SESSION.
        $cache_merge_ARRAY[
            Array\n(\n
                [9eVCF1EtD9UjAjCyUwOnSxRbQdrKl6KZwLAV5JIxQnYPUnJYw9AIbEEH0TYczbc5] =>
                    Array\n        (\n
                        [cache_id] =>
                            Array\n                (\n
                                [crnrstn.main.js] => 0\n                )\n\n
                        [ipaddress_id] =>
                            Array\n                (\n
                                [172.16.225.1] => 0\n                )\n\n
                        [rrs_map_filename] =>
                            Array\n                (\n
                                [0] => crnrstn.main.js\n                )\n\n
                        [rrs_map_file_extension] =>
                            Array\n                (\n
                                [0] => js\n                )\n\n
                        [rrs_map_filepath] =>
                            Array\n                (\n
                                [0] => /var/www/html/lightsaber.crnrstn.evifweb.com/_crnrstn/ui/js/crnrstn.main.js\n                )\n\n
                        [asset_meta_path] =>
                            Array\n                (\n
                                [0] => \n                )\n\n
                        [request_family] =>
                            Array\n                (\n
                                [0] => js\n                )\n\n
                        [asset_meta_key] =>
                            Array\n                (\n
                                [0] => 7208\n                )\n\n
                        [raw_output_mode] => Array\n                (\n                    [0] => 7208\n                )\n\n
                        [output_mode] => Array\n                (\n                    [0] => 7208\n                )\n\n
                        [resource_bytes] => Array\n                (\n                    [0] => 57\n                )\n\n
                        [datecreated] => Array\n                (\n                    [0] => 1681368170\n                )\n\n
                        [createdby_client_ip] => Array\n                (\n                    [0] => 0\n                )\n\n
                        [lastmodified] => Array\n                (\n                    [0] => 1681368170\n                )\n\n
                        [modifiedby_client_ip] => Array\n                (\n                    [0] => 0\n                )\n\n        )\n\n)\n].


        */

        //error_log(__LINE__ . ' rrs map NEW {UGC/FAM}. NOW CALLING init_request_family() $request_ugc_val[' . $request_ugc_val . ']. $asset_family[' . $asset_family . ']. $asset_meta_ARRAY[' . print_r($asset_meta_ARRAY, true) . ']. $raw_output_mode[' . $raw_output_mode . ']. $output_mode[' . $output_mode . '].');

        if($this->init_request_family($request_ugc_val, $asset_family, $asset_meta_ARRAY, $raw_output_mode, $output_mode) == true){

            //error_log(__LINE__ . ' rrs map $asset_meta_key[' . $asset_meta_key . ']. $request_ugc_val[' . $request_ugc_val . ']. $asset_meta_path[' . $asset_meta_path . '].');

            $this->init_request_asset_meta_key($asset_meta_key, $request_ugc_val);
            $this->init_request_asset_meta_path($asset_meta_path, $request_ugc_val);

            if($this->is_get_return_ready() == true){

                //
                // RESPONSE RETURN APPLICATION ACCELERATION.
                error_log(__LINE__ . ' rrs map initialize_request() CALLING response_return() APPLICATION ACCELERATION.');
                return $this->response_return();

            }

        }

        error_log(__LINE__ . ' rrs map DONE WITH {UGC/FAM}. $request_ugc_val[' . $request_ugc_val . ']. $asset_family[' . $asset_family . ']. $raw_output_mode[' . $raw_output_mode . ']. $output_mode[' . $output_mode . '].');

        return '';

    }

    private function response_return(){

        /*
        //
        // FOR SAKE OF SIMPLICITY, PERFORM THE ACTUAL RAW ASSET RETURN HERE IN THE RRS MAP DETECTION ALGORITHM.
        CONDITIONS FOR ASSET RETURN ::
        METHOD KEY IS SET.

        self::$request_map_source_id_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial][$request_ugc_val]

        private static $request_map_output_mode_ARRAY = array();
        private static $cache_rrs_map_raw_output_mode_ARRAY = array();

        */

        if(isset(self::$request_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]])){

            //if(self::$request_map_source_id_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id]] == 'GET'){

                error_log(__LINE__ . ' rrs map RETURN $request_asset_meta_key_ARRAY[' . print_r(self::$request_asset_meta_key_ARRAY, true) . '].');

                /*
                [Thu Mar 09 08:05:03.196412 2023] [:error] [pid 1376] [client 172.16.225.1:54735] 535 rrs map
                $rrs_map_return_is_asset_ARRAY[
                    Array\n(\n
                        [8rdmHA80k1y1ten9pGW2ahSnZQbgRbwD3HB7bblGRhqb5lCrgVDPIXxF1QPg0tzS] =>
                            Array\n        (\n
                                [MTFLi0AbCd9QsiJNg8V75dlBRl] =>
                                    Array\n                (\n
                                        [crnrstn_logo_lg] => 1\n                )\n\n        )\n\n)\n].


                */
                switch(self::$request_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]]){
                    case CRNRSTN_JS:
                    case CRNRSTN_CSS:

                        $asset_family = $this->oCRNRSTN->return_crnrstn_asset_family();
                        $tmp_response_map_request_ugc_value = $this->get_salt_ugc();
                        $tmp_response_map_asset_meta_key = $this->oCRNRSTN->return_response_map_asset_meta_key();
                        $tmp_response_map_asset_meta_path = $this->oCRNRSTN->return_response_map_asset_meta_path(self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]);
                        error_log(__LINE__ . ' rrs map CRNRSTN_JS & CRNRSTN_CSS FIRE return_asset_data(). request_family[' . $asset_family . ']. ugc_value[' . $tmp_response_map_request_ugc_value . ']. method_key[' . $tmp_response_map_asset_meta_key . ']. meta_path[' . $tmp_response_map_asset_meta_path . '].');

                        die();
                        $this->oCRNRSTN->return_asset_data($tmp_response_map_request_ugc_value, $asset_family, $tmp_response_map_asset_meta_key, $tmp_response_map_asset_meta_path);

                    break;
                    default:

                        error_log(__LINE__ . ' rrs map $request_asset_meta_key_ARRAY[' . self::$request_asset_meta_key_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]] . '].');
                        return $this->oCRNRSTN->return_creative(self::$request_asset_meta_key_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]]);

                    break;

                }

            //}

        }

        return '';

    }

    public function byte_reporting($report_profile, $channel, $source, $data_len = NULL){

        switch($report_profile){
            case 'total_bytes_processed[r]':

                //
                // READ TOTAL BYTES PROCESSED BY CRNRSTN ::
                return self::$total_bytes_ARRAY[CRNRSTN_RESOURCE_ALL];

            break;
            case 'channel_bytes_processed[r]':

                if(isset($channel)){

                    if(is_array($channel)){

                        //error_log(__LINE__ . ' rrs map [' .  . '].');

                        $tmp_ARRAY = array();
                        foreach($channel as $ch_index => $ch_channel){

                            //
                            // COMPILE REPORTING DATA IN ALIGNMENT WITH THE PROVIDED MULTI-CHANNEL CHANNEL ARRAY.
                            // MOST USUALLY THO, IT WILL BE 100% OF THE CHANNELS...I CAN ONLY IMAGINE.
                            // Wednesday, May 31, 2023 0617 hrs.
                            $tmp_ARRAY[$ch_channel] = self::$total_bytes_ARRAY['CHANNEL'][$ch_channel];

                        }

                        //
                        // READ CRNRSTN :: MULTI-CHANNEL CHANNEL ARRAY WITH CHANNEL DATA STORAGE REPORTING BYTE TOTALS.
                        return $tmp_ARRAY;

                    }

                    //
                    // A CHECK JUST IN CASE A STRING CHANNEL INDICATOR IS PROVIDED.
                    if(is_string($channel)){

                        switch($channel){
                            case 'session':
                                //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).
                            case 'runtime':
                                //R :: RUNTIME.
                            case 'post':
                                //P :: HTTP $_POST REQUEST.
                            case 'get':
                                //G :: HTTP $_GET REQUEST.
                            case 'soap':
                                //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                            case 'database':
                                //D :: DATABASE (MySQLi CONNECTION).
                            case 'cookie':
                                //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
                            case 'pssdtla':
                                //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                            case 'ssdtla':
                                //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).

                                //
                                // READ BYTE TOTALS FOR THE PROVIDED CRNRSTN :: MULTI-CHANNEL CHANNEL.
                                return (int) self::$total_bytes_ARRAY['CHANNEL'][$channel];

                            break;
                            default:

                               error_log(__LINE__ . ' rrs map ERROR BYTE REQUEST RECEIVED UNKNOWN CHANNEL [' . $channel . '].');

                            break;

                        }

                    }

                }

                //
                // READ CRNRSTN :: MULTI-CHANNEL ARRAY WITH CHANNEL DATA STORAGE REPORTING BYTE TOTALS.
                return self::$total_bytes_ARRAY['CHANNEL'];

            break;
            case 'total_bytes_processed[w]':

                //
                // WRITE TOTAL BYTES PROCESSED BY CRNRSTN ::
                self::$total_bytes_ARRAY[CRNRSTN_RESOURCE_ALL] = (int) $data_len;

            break;
            case 'channel_bytes_processed[w]':

                if(is_array($channel)){

                    foreach($channel as $ch_index => $ch_channel){

                        //
                        // GET CURRENT CHANNEL TOTAL BYTES.
                        $tmp_curr_total_bytes = self::$total_bytes_ARRAY['CHANNEL'][$ch_channel];

                        //
                        // SUM UNTO A FRESH TOTAL TAKING INTO ACCOUNT...THE NEW BYTES.
                        $tmp_curr_total_bytes += (int) $data_len;

                        //
                        // WRITE TOTAL BYTES FOR CRNRSTN :: MULTI-CHANNEL CHANNEL.
                        self::$total_bytes_ARRAY['CHANNEL'][$ch_channel] = (int) $tmp_curr_total_bytes;

                    }

                }

                if(is_string($channel)){

                    switch($channel){
                        case 'session':
                            //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).
                        case 'runtime':
                            //R :: RUNTIME.
                        case 'post':
                            //P :: HTTP $_POST REQUEST.
                        case 'get':
                            //G :: HTTP $_GET REQUEST.
                        case 'soap':
                            //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                        case 'database':
                            //D :: DATABASE (MySQLi CONNECTION).
                        case 'cookie':
                            //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
                        case 'pssdtla':
                            //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                        case 'ssdtla':
                            //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).

                            //
                            // WRITE TOTAL BYTES FOR CRNRSTN :: MULTI-CHANNEL CHANNEL.
                            self::$total_bytes_ARRAY['CHANNEL'][$channel] = (int) $data_len;

                        break;
                        default:

                            error_log(__LINE__ . ' rrs map ERROR BYTE REQUEST RECEIVED UNKNOWN CHANNEL [' . $channel . '].');

                        break;

                    }

                }

            break;
            default:

                error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

            break;

        }

        return true;

    }

    private function is_get_return_ready(){

        if(isset(self::$rrs_map_page_is_asset_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]])){

            if(self::$rrs_map_page_is_asset_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]] == 1){

                return true;

            }

        }

        return false;

    }

    public function ______cache_rrs_map_meta($attribute, $ugc_value = NULL){

        $tmp_str = '';

        //
        // NOTE THAT FILENAME AND UGC ARE MAPPED TO THE SAME CACHE LOCATION.
        // CURRENTLY, FAVICON MAPPING PRODUCES THE ONLY TOGGLE...WHERE WE SHOULD NOT USE FILENAME...BUT THE $_GET UGC.
        if($this->return_crnrstn_asset_family() == 'favicon'){

            $ugc_value = $this->get_salt_ugc();
            error_log(__LINE__ . ' rrs map GET FAVICON FILENAME FROM UGC [' . $this->get_salt_ugc(). '].');

        }

        switch($attribute){
            case 'rrs_map_ugc':

                $tmp_str = $this->return_response_map_ugc_value();

            break;
            case 'rrs_map_filename':

                $tmp_str = self::$cache_rrs_map_filename_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$ugc_value]];

            break;
            case 'rrs_map_filepath':

                //
                // NOTE THAT FILENAME AND UGC ARE MAPPED TO THE SAME CACHE LOCATION.
                $tmp_str = self::$cache_rrs_map_filepath_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$ugc_value]];

            break;
            case 'rrs_map_file_extension':

                //
                // NOTE THAT FILENAME AND UGC ARE MAPPED TO THE SAME CACHE LOCATION.
                $tmp_str = self::$cache_rrs_map_file_extension_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$ugc_value]];

            break;
            default:

                error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

            break;

        }

        return $tmp_str;

    }

    public function ______ini_cache_rrs_map_meta($attribute, $ugc_value, $value){

        //
        // NOTE THAT FILENAME AND UGC ARE MAPPED TO THE SAME CACHE LOCATION.
        // CURRENTLY, FAVICON MAPPING PRODUCES THE ONLY TOGGLE...WHERE WE SHOULD NOT USE FILENAME...BUT THE $_GET UGC.
        if($this->return_crnrstn_asset_family() == 'favicon'){

            $ugc_value = self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]];

        }

        switch($attribute){
            case 'rrs_map_filename':

                self::$cache_rrs_map_filename_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$ugc_value]] = $value;

            break;
            case 'rrs_map_filepath':

                //
                // NOTE THAT FILENAME AND UGC ARE MAPPED TO THE SAME CACHE LOCATION.
                self::$cache_rrs_map_filepath_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$ugc_value]] = $value;

            break;
            case 'rrs_map_file_extension':

                //
                // NOTE THAT FILENAME AND UGC ARE MAPPED TO THE SAME CACHE LOCATION.
                self::$cache_rrs_map_file_extension_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$ugc_value]] = $value;

            break;
            default:

                error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

            break;

        }

    }

    private function ___init_request_family($request_ugc_val, $asset_family, $serial_override, $raw_output_mode, $output_mode){

        //error_log(__LINE__ . ' rrs map die();');
        //die();
        /*
        CACHE HEADER (CACHE DATA STRUCTURE SUPPORTS MULTI-CHANNEL DRIVEN RUNTIME INITIALIZATION)
        - DATECREATED                       self::$cache_datecreated_ARRAY[$this->oCRNRSTN->request_id][$channel]
        - CREATEDBY_SESSIONID               self::$cache_createdby_sessionid_ARRAY[$this->oCRNRSTN->request_id][$channel]
        - CREATEDBY_CLIENT_IP               self::$cache_createdby_client_ip_ARRAY[$this->oCRNRSTN->request_id][$channel]
        - DATEMODIFIED                      self::$cache_lastmodified_ARRAY[$this->oCRNRSTN->request_id][$channel]
        - MODIFIEDBY_SESSIONID              self::$cache_modifiedby_sessionid_ARRAY[$this->oCRNRSTN->request_id][$channel]
        - MODIFIEDBY_CLIENT_IP              self::$cache_modifiedby_client_ip_ARRAY[$this->oCRNRSTN->request_id][$channel]
        - CACHE SIZE (BYTES)                self::$cache_ARRAY[$this->oCRNRSTN->request_id]['channel_bytes'][$channel][$channel]

        */

        $tmp_time = time();
        $tmp_ip = $this->oCRNRSTN->client_ip();

        //
        // THIS METHOD RETURNS VALID CHANNELS TO RECEIVE CACHE DATA AND TIES INTO CRNRSTN :: MEMORY MANAGEMENT.
        $tmp_auth_channel_ARRAY = $this->new_cache_bytes($tmp_ip.$tmp_time);

        //error_log(__LINE__ . ' rrs map NEW CACHE $tmp_auth_channel_ARRAY[' . print_r($tmp_auth_channel_ARRAY, true) . '].');

        //
        // FOR EACH ACTIVE AND MAX BYTES VALID CHANNEL.
        foreach($tmp_auth_channel_ARRAY as $index => $channel){

            //error_log(__LINE__ . ' rrs map ADD DATA CACHE $channel[' . $channel . '].');

            switch($channel){
                case CRNRSTN_CHANNEL_SESSION:
                    //H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).
                case CRNRSTN_CHANNEL_GET:
                    //G :: HTTP $_GET REQUEST.
                case CRNRSTN_CHANNEL_POST:
                    //P :: HTTP $_POST REQUEST.
                case CRNRSTN_CHANNEL_SOAP:
                    //O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
                case CRNRSTN_CHANNEL_DATABASE:
                    //D :: DATABASE (MySQLi CONNECTION).
                case CRNRSTN_CHANNEL_COOKIE:
                    //C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR EVEN A BROWSER COOKIE...EQUALLY AS RELIABLE TO CRNRSTN ::
                case CRNRSTN_CHANNEL_PSSDTLA:
                    //J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
                case CRNRSTN_CHANNEL_SSDTLA:
                    //S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).
                case CRNRSTN_CHANNEL_FILE:
                    //F ::
                    //error_log(__LINE__. ' rrs map AUTHORIZED TO STORE RRS MAP CACHE DATA IN CHANNEL [' . $channel . ']. $output_mode[' . $output_mode . '].');

                break;
                case CRNRSTN_CHANNEL_RUNTIME:

                    //error_log(__LINE__. ' rrs map AUTHORIZED TO STORE RRS MAP CACHE DATA IN CHANNEL [' . $channel . ']. $output_mode[' . $output_mode . '].');
//
//                    if(!isset(self::$cache_datecreated_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$request_ugc_val]])){
//
//                        self::$cache_datecreated_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$request_ugc_val]] = time();
//                        self::$cache_createdby_client_ip_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$request_ugc_val]] = $tmp_ip;
//
//                    }
//
//                    self::$cache_lastmodified_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$request_ugc_val]] = time();
//                    self::$cache_modifiedby_client_ip_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$request_ugc_val]] = $tmp_ip;
//                    self::$cache_rrs_map_raw_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$request_ugc_val]] = $raw_output_mode;
//                    self::$request_current_fulfilled_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial] = 0;
//
//                    self::$request_map_output_mode_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$request_ugc_val]] = $output_mode;
//                    //self::$cache_rrs_map_filename_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$request_ugc_val]] = $request_ugc_val;

                    //error_log(__LINE__ . ' rrs map MUST BE THE SAME!!! [' . self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]] . ']<-->[' . $request_ugc_val . '].');

                break;
                default:

                    error_log(__LINE__ . ' rrs map AN UNUSED DEFAULT (SWITCH) HAS BEEN HIT. $channel[' . $channel . ']. $attribute[' . $attribute . ']. $ddo_memory_pointer[' . $ddo_memory_pointer . ']. $index[' . $index . '].');

                break;

            }

        }

        //
        // TODO :: GET RID OF THE USE OF $rrs_map_page_is_asset_ARRAY FOR RETURN MGMT.
        if(!isset(self::$rrs_map_page_is_asset_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial][$request_ugc_val])){

            $tmp_source = 0;

            //
            // CHECK IF THE PARENT (OR PAGE) REQUEST IS A URL DRIVEN REQUEST FOR THE RESOURCE
            // RETURN OF AN ASSET OR MODULE. WILL THIS DUAL PARAMETER CHECK BE SUFFICIENT, ULTIMATELY?
            switch($output_mode){
                case CRNRSTN_JS:
                case CRNRSTN_CSS:

                    $tmp_source = 1;

                break;
                default:

                    //
                    // RRS MAP INITIALIZATION BY METHOD CALL (I.E. NOT $_GET) IS SENDING EMPTY DATA HERE. IGNORE IT.
                    if(($raw_output_mode == $output_mode) && ($raw_output_mode != '')){

                        error_log(__LINE__ . ' rrs map $raw_output_mode[' . $raw_output_mode . ']. $output_mode[' . $output_mode . '].');
                        $tmp_source = 1;

                    }

                break;

            }

            self::$request_page_fulfilled_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial] = 0;
            //self::$request_family_ARRAY[$this->oCRNRSTN->request_id] = $asset_family;
            //self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id] = $request_ugc_val;

            switch($asset_family){
                case 'favicon':
                case 'social':
                case 'system':
                case 'css':
                case 'js':
                case 'integrations':

                    //
                    // where $tmp_source = 0 or 1
                    self::$rrs_map_page_is_asset_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial][$request_ugc_val] = $tmp_source;
                    //error_log(__LINE__ . ' rrs map *** $this->oCRNRSTN->request_serial[' . $this->oCRNRSTN->request_serial . ']. $rrs_map_page_is_asset_ARRAY[' . $request_ugc_val . ']=[' . $tmp_source . '], where 0 or 1 FOR RAW ASSET RETURN.');
                    //die();

                break;
                case 'meta':        // SOCIAL PREVIEW TAGS + SEO
                case 'module_key':  // DOCUMENTATION
                default:

                    //
                    // AS FAR AS ASSET RETURN IS CONCERNED...THESE ARE NOT YOUR AVERAGE BEAR.
                    self::$rrs_map_page_is_asset_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial][$request_ugc_val] = 0;
                    //error_log(__LINE__ . ' rrs map *** INVESTIGATE [' . $this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial] . ']. [' . self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id] . '].');
                    //die();

                break;

            }

        }

        return true;

    }

    private function init_request_asset_meta_key($asset_meta_key, $request_ugc_val){

        //
        // DO WE INITIALIZE MAP FOR METHOD DRIVEN ASSET REQUEST?
        //error_log(__LINE__ . ' rrs map $asset_meta_key[' . $asset_meta_key . ']. $request_ugc_val[' . $request_ugc_val . ']. self::$cache_id_ARRAY[' . print_r(self::$cache_id_ARRAY,true) . '].');

        //self::$request_asset_meta_key_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][self::$salt_ugc_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]]]]
        if(!isset(self::$request_asset_meta_key_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$request_ugc_val]])){

            //error_log(__LINE__ . ' rrs map $asset_meta_key[' . $asset_meta_key . '].');
            //self::$request_asset_meta_key_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial]] = $asset_meta_key;
            self::$request_asset_meta_key_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$request_ugc_val]] = $asset_meta_key;

            //error_log(__LINE__ . ' rrs map INITIALIZE return_response_map_asset_meta_key[' . $this->return_response_map_asset_meta_key() . ']. $request_asset_meta_key_ARRAY[' . print_r(self::$request_asset_meta_key_ARRAY, true) . ']. $request_ugc_val[' . $request_ugc_val . '].');

        }

    }

    private function init_request_asset_meta_path($asset_meta_path, $request_ugc_val){

        if(isset($asset_meta_path)){

            if($asset_meta_path != ''){

                //error_log(__LINE__ . ' rrs map $asset_meta_path[' . $asset_meta_path . ']. $request_ugc_val[' . $request_ugc_val . ']. $request_asset_meta_path_ARRAY[' . print_r(self::$request_asset_meta_path_ARRAY, true) . '].');

                //
                // DO WE INITIALIZE MAP FOR METHOD DRIVEN ASSET REQUEST?
                if(!isset(self::$request_asset_meta_path_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$request_ugc_val]])){

                    //error_log(__LINE__ . ' rrs map $request_map_output_mode_ARRAY[' . print_r(self::$request_map_output_mode_ARRAY,true) . ']. $asset_meta_path[' . $asset_meta_path . ']. $request_ugc_val[' . $request_ugc_val . ']. $serial[' . $this->oCRNRSTN->request_serialization_string_ARRAY[$this->oCRNRSTN->request_id][$this->oCRNRSTN->request_serial] . '].');
                    self::$request_asset_meta_path_ARRAY[$this->oCRNRSTN->request_id][self::$cache_id_ARRAY[$this->oCRNRSTN->request_id][$request_ugc_val]] = $asset_meta_path;
                    //error_log(__LINE__ . ' rrs map $asset_meta_path[' . $asset_meta_path . ']. $request_ugc_val[' . $request_ugc_val . ']. $request_asset_meta_path_ARRAY[' . print_r(self::$request_asset_meta_path_ARRAY, true) . '].');

                }

            }

        }

        return NULL;

    }

    public function __destruct(){

        if($this->rrs_map_get('runtime_cache_is_active') == true){

            //$this->oCRNRSTN->destruct_output .= print_r(self::$cache_ARRAY, true);

            //error_log(__LINE__ . ' rrs map __destruct() runtime cache[' . print_r(self::$cache_ARRAY, true) . '].');
            //error_log(__LINE__ . ' rrs map __destruct() RUNTIME cache[' . print_r(self::$cache_ARRAY, true) . '].');
            //error_log(__LINE__ . ' rrs map __destruct() SESSION cache[' . print_r($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()], true) . '].');

//            echo '<html><body style="background-color: #131314;"><div style="padding: 20px 0 40px 10px;"><code style="font-family: Courier New, Courier, monospace; font-size: 10px; color: #1FA61F;"><pre>[' . $this->oCRNRSTN->return_micro_time() . '][rtime ' . $this->oCRNRSTN->wall_time() . ']
//RUNTIME:
//' . print_r(self::$cache_ARRAY, true);
//            echo '<br><br>';
//            echo '[' . $this->oCRNRSTN->return_micro_time() . '][rtime ' . $this->oCRNRSTN->wall_time() . ']
//SESSION:
//' . print_r($_SESSION, true);
//
//            echo '</pre></code></div></body></html>';

            //
            // CRNRSTN :: APPLICATION ACCELERATION.
            // RESPONSE RETURN SERIALIZATION MAP (RRS MAP) CACHE/MEMORY SYNCHRONIZATION.
            //$this->oCRNRSTN->sync_rrs_map_cache();

            //
            // DEACTIVATE THE RUNTIME RRS MAP DESTRUCT FIRED SYNC.
            //$this->deactivate_destruct_rrs_map_sync();
            //error_log(__LINE__ . ' rrs map DEACTIVATE THE RUNTIME RRS MAP DESTRUCT FIRED SYNC.');


            $this->oCRNRSTN->destruct_output = '[' . $this->oCRNRSTN->wall_time() . ']
[methd ' . trim(__METHOD__) . '()][lnum ' . __LINE__ . ']
[req_id ' . $this->oCRNRSTN->request_id . ']';

            if(isset($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()])){

                $this->oCRNRSTN->destruct_output .= '$_SESSION:
[' . print_r($_SESSION['CRNRSTN_' . $this->oCRNRSTN->config_serial_hash()], true) . '].';

                $this->oCRNRSTN->destruct_output .= '[' . __METHOD__ . '][lnum ' . __LINE__ . ']
/////////////////

/////////////////
';

            }

            $this->oCRNRSTN->destruct_output .= 'RUNTIME:
[' . print_r(self::$cache_ARRAY, true) . '].';


        }

    }

}