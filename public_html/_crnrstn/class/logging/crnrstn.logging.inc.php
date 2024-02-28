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
#  Header notes from the original 188 line log.inc.php which defined the class crnrstn_AdvancedLogger
#  and was archived within a snapshot of the CRNRSTN :: project on 9/11/2012.
#  - J5
#
#   "THIS SHIT NEEDS TO BE COMPLETELY GUTTED AND STANDARDIZED."
#
#   syslog()
#   SYSLOG priority is a combination of the facility and the level. Possible values
#   are (in descending order):
#   Constant		Description
#   LOG_EMERG		system is unusable.
#   LOG_ALERT		action must be taken immediately
#   LOG_CRIT		critical conditions
#   LOG_ERR		error conditions
#   LOG_WARNING	warning conditions
#   LOG_NOTICE	normal, but significant, condition
#   LOG_INFO		informational message
#   LOG_DEBUG		debug-level message
#
#   $errortype = array (
#		E_ERROR              => 'Error',
#		E_WARNING            => 'Warning',
#		E_PARSE              => 'Parsing Error',
#		E_NOTICE             => 'Notice',
#		E_CORE_ERROR         => 'Core Error',
#		E_CORE_WARNING       => 'Core Warning',
#		E_COMPILE_ERROR      => 'Compile Error',
#		E_COMPILE_WARNING    => 'Compile Warning',
#		E_USER_ERROR         => 'User Error',
#		E_USER_WARNING       => 'User Warning',
#		E_USER_NOTICE        => 'User Notice',
#		E_STRICT             => 'Runtime Notice',
#		E_RECOVERABLE_ERROR  => 'Catchable Fatal Error'
#	);
#
#	INTEGRATIONS WITH SPLUNK.
#	    - NEED SUPPORT FOR AUTOMATIC AUTHENTICATION AND MANUAL AUTHENTICATION
#	    - NEED TO ADD SPLUNK CONFIG VARIABLE SECTION TO PRIMARY CONFIG FILE? OR TO log.inc.php
#	    - NEED SUPPORT FOR SPLUNK STORM RESTFUL API
#	    - INVESTIGATE BATCH PROCESSING OF LOG EVENTS. "Send multiple events over a single call"
#	    - INVESTIGATE SUPPORT FOR GET AND POST VARIABLES ("The POST Content-Length must be less than 100 MB")
#	    - INVESTIGATE ADDING SUPPORT FOR LOCAL LOG FILES AND/OR TCP.
#
#	INCLUDE SUPPORT FOR ERROR HANDLING/BUBBLING
#	    Response status
#		Status Code 	Description
#		200 			Data accepted.
#       400 			Request error. See response body for details.
#       403.1 			Not authorized to write to the project.
#       404 			Project does not exist.
#
#	POINTS OF CONSIDERATION ::
#	    - LOGGING TO DEFAULT SYSTEM LOG FILE (SUPPORT WINDOWS AND UNIX)
#	    - LOGGING TO CUSTOM LOG FILE(S)
#	    - LOGGING TO REMOTE SERVICE(S) VIA HTTP/HTTPS + AUTHENTICATION (OPTIONAL) + KEY (OPTIONAL)
#	    - LOGGING TO EMAIL(S) **NOT RECOMMENDED FOR PRODUCTION ENVIRONMENTS**
#	    - LOGGING TO SCREEN **NOT RECOMMENDED FOR PRODUCTION ENVIRONMENTS**
#	    - BATCHING OF LOG REQUESTS
#	    - TO WHAT EXTENT DO YOU NEED TO DECOUPLE 'WHERE YOU WANT THE LOG INFO TO GO' FROM THE PROCESS OF EVOKING EACH LOGGING OPERATION
#
#   LOG REQUEST ATTRIBUTES
#       - PRIORITY
#       - ERR_NO CONSTANT(S)
#       - SYSTEM ERROR DESCRIPTION
#       - SYSTEM ERROR NUMBER
#       - CUSTOM USER ERROR DESCRIPTION
#       - CUSTOM USER ERROR ID/NO/NAME
#       - AUTHENTICATION PARAMS
#       - ENDPOINT PARAMS
#
#	EXAMPLE CURL REQUESTS ::
#
#	    curl -u $ACCESS_TOKEN:x \
#	    "https://api.splunkstorm.com/1/inputs/http?index=<ProjectID>&sourcetype=<type>" \
#	    -d "<Request body>"
#
#	    curl -k -u $ACCESS_TOKEN:x \
#	    "https://api.splunkstorm.com/1/inputs/http?index=f75b3a9abc&sourcetype=syslog&host=my.example.com" \
#	    --data-urlencode "Sun Apr 11 15:35:15 UTC 2011 action=download_packages status=OK pkg_dl=751 elapsed=37.543"
#
# # C # R # N # R # S # T # N # : : # # # #
#
#  CLASS :: crnrstn_logging
#  VERSION :: 2.00.0000
#  DATE :: September 11, 2012 @ 1520hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: System Logging and Exception Notifications. I log things.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_logging {

    public $oCRNRSTN;
    private static $config_serial;

    protected $oLog_output_manager;
    public $emailDataElements = array();
    public $msg_delivery_status;

    private static $mem_salt;
    protected $oLog_ProfileManager;
    private static $CRNRSTN_debug_mode = 0;
    protected $starttime;
    protected $parent_class;
    public $log_output = '';

    protected $log_silo_profile;
    protected $active_silo_ARRAY = array();
    protected $silent_silo_ARRAY = array();
    protected $active_log_silo_flag_ARRAY = array();

    protected $tmp_starttime;
    protected $tmp_starttime_ARRAY;
    protected $tmp_precise_timestamp;

    private static $system_error_message_serialization_ARRAY = array();
    private static $system_error_message_channel_map_ARRAY = array();
    private static $system_error_message_queue_ARRAY = array();

    private static $output_profile_ARRAY = array();

    public function __construct($parent_class, $oCRNRSTN){

        $log_silo_profile = CRNRSTN_SETTINGS_CRNRSTN;
        $this->oCRNRSTN = $oCRNRSTN;

        //
        // A WORKING BUT UNTESTED DATA STRUCTURE
        // THAT DEMONSTRATES SUPPORT FOR INTEGER
        // CONSTANT AND BITWISE COMBINATION
        // DRIVEN CRNRSTN :: LOGGING PROFILES.
        //
        // Wednesday, December 6, 2023 @ 0613 hrs.
        self::$output_profile_ARRAY['OUTPUT_PROFILE'][CRNRSTN_INTEGER] = array(CRNRSTN_LOG_SOAP => CRNRSTN_LOG_SOAP,
        CRNRSTN_LOG_EMAIL => CRNRSTN_LOG_EMAIL, CRNRSTN_LOG_EMAIL_PROXY => CRNRSTN_LOG_EMAIL_PROXY,
        CRNRSTN_LOG_FILE => CRNRSTN_LOG_FILE, CRNRSTN_CHANNEL_FILE => CRNRSTN_CHANNEL_FILE,
        CRNRSTN_LOG_FILE_FTP => CRNRSTN_LOG_FILE_FTP, CRNRSTN_LOG_SCREEN_TEXT => CRNRSTN_LOG_SCREEN_TEXT,
        CRNRSTN_LOG_SCREEN => CRNRSTN_LOG_SCREEN, CRNRSTN_LOG_SCREEN_HTML => CRNRSTN_LOG_SCREEN_HTML,
        CRNRSTN_LOG_SCREEN_HTML_HIDDEN => CRNRSTN_LOG_SCREEN_HTML_HIDDEN, CRNRSTN_LOG_DEFAULT => CRNRSTN_LOG_DEFAULT,
        CRNRSTN_LOG_ELECTRUM => CRNRSTN_LOG_ELECTRUM, CRNRSTN_LOG_DATABASE => CRNRSTN_LOG_DATABASE,
        CRNRSTN_LOG_SSDTLA => CRNRSTN_LOG_SSDTLA, CRNRSTN_LOG_PSSDTLA => CRNRSTN_LOG_PSSDTLA,
        CRNRSTN_LOG_EMAIL & CRNRSTN_LOG_DEFAULT => CRNRSTN_LOG_EMAIL & CRNRSTN_LOG_DEFAULT,
        CRNRSTN_LOG_EMAIL_PROXY & CRNRSTN_LOG_DEFAULT => CRNRSTN_LOG_EMAIL_PROXY & CRNRSTN_LOG_DEFAULT,
        CRNRSTN_LOG_FILE & CRNRSTN_LOG_DEFAULT => CRNRSTN_LOG_FILE & CRNRSTN_LOG_DEFAULT,
        CRNRSTN_CHANNEL_FILE & CRNRSTN_LOG_DEFAULT => CRNRSTN_CHANNEL_FILE & CRNRSTN_LOG_DEFAULT,
        CRNRSTN_LOG_FILE_FTP & CRNRSTN_LOG_DEFAULT => CRNRSTN_LOG_FILE_FTP & CRNRSTN_LOG_DEFAULT,
        CRNRSTN_LOG_SCREEN_TEXT & CRNRSTN_LOG_DEFAULT => CRNRSTN_LOG_SCREEN_TEXT & CRNRSTN_LOG_DEFAULT,
        CRNRSTN_LOG_SCREEN & CRNRSTN_LOG_DEFAULT => CRNRSTN_LOG_SCREEN & CRNRSTN_LOG_DEFAULT,
        CRNRSTN_LOG_SCREEN_HTML & CRNRSTN_LOG_DEFAULT => CRNRSTN_LOG_SCREEN_HTML & CRNRSTN_LOG_DEFAULT,
        CRNRSTN_LOG_SCREEN_HTML_HIDDEN & CRNRSTN_LOG_DEFAULT => CRNRSTN_LOG_SCREEN_HTML_HIDDEN & CRNRSTN_LOG_DEFAULT,
        CRNRSTN_LOG_ELECTRUM & CRNRSTN_LOG_DEFAULT => CRNRSTN_LOG_ELECTRUM & CRNRSTN_LOG_DEFAULT,
        CRNRSTN_LOG_DATABASE & CRNRSTN_LOG_DEFAULT => CRNRSTN_LOG_DATABASE & CRNRSTN_LOG_DEFAULT,
        CRNRSTN_LOG_SSDTLA & CRNRSTN_LOG_DEFAULT => CRNRSTN_LOG_SSDTLA & CRNRSTN_LOG_DEFAULT,
        CRNRSTN_LOG_PSSDTLA & CRNRSTN_LOG_DEFAULT => CRNRSTN_LOG_PSSDTLA & CRNRSTN_LOG_DEFAULT,
        CRNRSTN_LOG_SOAP & CRNRSTN_LOG_DEFAULT => CRNRSTN_LOG_SOAP & CRNRSTN_LOG_DEFAULT,
        CRNRSTN_LOG_EMAIL & CRNRSTN_LOG_DATABASE => CRNRSTN_LOG_EMAIL & CRNRSTN_LOG_DATABASE,
        CRNRSTN_LOG_EMAIL_PROXY & CRNRSTN_LOG_DATABASE => CRNRSTN_LOG_EMAIL_PROXY & CRNRSTN_LOG_DATABASE,
        CRNRSTN_LOG_FILE & CRNRSTN_LOG_DATABASE => CRNRSTN_LOG_FILE & CRNRSTN_LOG_DATABASE,
        CRNRSTN_CHANNEL_FILE & CRNRSTN_LOG_DATABASE => CRNRSTN_CHANNEL_FILE & CRNRSTN_LOG_DATABASE,
        CRNRSTN_LOG_FILE_FTP & CRNRSTN_LOG_DATABASE => CRNRSTN_LOG_FILE_FTP & CRNRSTN_LOG_DATABASE,
        CRNRSTN_LOG_SCREEN_TEXT & CRNRSTN_LOG_DATABASE => CRNRSTN_LOG_SCREEN_TEXT & CRNRSTN_LOG_DATABASE,
        CRNRSTN_LOG_SCREEN & CRNRSTN_LOG_DATABASE => CRNRSTN_LOG_SCREEN & CRNRSTN_LOG_DATABASE,
        CRNRSTN_LOG_SCREEN_HTML & CRNRSTN_LOG_DATABASE => CRNRSTN_LOG_SCREEN_HTML & CRNRSTN_LOG_DATABASE,
        CRNRSTN_LOG_SCREEN_HTML_HIDDEN & CRNRSTN_LOG_DATABASE => CRNRSTN_LOG_SCREEN_HTML_HIDDEN & CRNRSTN_LOG_DATABASE,
        CRNRSTN_LOG_ELECTRUM & CRNRSTN_LOG_DATABASE => CRNRSTN_LOG_ELECTRUM & CRNRSTN_LOG_DATABASE,
        CRNRSTN_LOG_DATABASE & CRNRSTN_LOG_DATABASE => CRNRSTN_LOG_DATABASE & CRNRSTN_LOG_DATABASE,
        CRNRSTN_LOG_SSDTLA & CRNRSTN_LOG_DATABASE => CRNRSTN_LOG_SSDTLA & CRNRSTN_LOG_DATABASE,
        CRNRSTN_LOG_PSSDTLA & CRNRSTN_LOG_DATABASE => CRNRSTN_LOG_PSSDTLA & CRNRSTN_LOG_DATABASE,
        CRNRSTN_LOG_SOAP & CRNRSTN_LOG_DATABASE => CRNRSTN_LOG_SOAP & CRNRSTN_LOG_DATABASE);

        self::$output_profile_ARRAY['OUTPUT_PROFILE'][CRNRSTN_STRING] = array(
        'CRNRSTN_LOG_EMAIL' => CRNRSTN_LOG_EMAIL, 'CRNRSTN_LOG_EMAIL_PROXY' => CRNRSTN_LOG_EMAIL_PROXY,
        'CRNRSTN_LOG_FILE' => CRNRSTN_LOG_FILE, 'CRNRSTN_CHANNEL_FILE' => CRNRSTN_CHANNEL_FILE,
        'CRNRSTN_LOG_FILE_FTP' => CRNRSTN_LOG_FILE_FTP, 'CRNRSTN_LOG_SCREEN_TEXT' => CRNRSTN_LOG_SCREEN_TEXT,
        'CRNRSTN_LOG_SCREEN' => CRNRSTN_LOG_SCREEN, 'CRNRSTN_LOG_SCREEN_HTML' => CRNRSTN_LOG_SCREEN_HTML,
        'CRNRSTN_LOG_SCREEN_HTML_HIDDEN' => CRNRSTN_LOG_SCREEN_HTML_HIDDEN,
        'CRNRSTN_LOG_DEFAULT' => CRNRSTN_LOG_DEFAULT, 'CRNRSTN_LOG_ELECTRUM' => CRNRSTN_LOG_ELECTRUM,
        'CRNRSTN_LOG_DATABASE' => CRNRSTN_LOG_DATABASE, 'CRNRSTN_LOG_SSDTLA' => CRNRSTN_LOG_SSDTLA,
        'CRNRSTN_LOG_PSSDTLA' => CRNRSTN_LOG_PSSDTLA, 'CRNRSTN_LOG_SOAP' => CRNRSTN_LOG_SOAP,
        'CRNRSTN_LOG_EMAIL & CRNRSTN_LOG_DEFAULT' => CRNRSTN_LOG_EMAIL & CRNRSTN_LOG_DEFAULT,
        'CRNRSTN_LOG_EMAIL_PROXY & CRNRSTN_LOG_DEFAULT' => CRNRSTN_LOG_EMAIL_PROXY & CRNRSTN_LOG_DEFAULT,
        'CRNRSTN_LOG_FILE & CRNRSTN_LOG_DEFAULT' => CRNRSTN_LOG_FILE & CRNRSTN_LOG_DEFAULT,
        'CRNRSTN_CHANNEL_FILE & CRNRSTN_LOG_DEFAULT' => CRNRSTN_CHANNEL_FILE & CRNRSTN_LOG_DEFAULT,
        'CRNRSTN_LOG_FILE_FTP & CRNRSTN_LOG_DEFAULT' => CRNRSTN_LOG_FILE_FTP & CRNRSTN_LOG_DEFAULT,
        'CRNRSTN_LOG_SCREEN_TEXT & CRNRSTN_LOG_DEFAULT' => CRNRSTN_LOG_SCREEN_TEXT & CRNRSTN_LOG_DEFAULT,
        'CRNRSTN_LOG_SCREEN & CRNRSTN_LOG_DEFAULT' => CRNRSTN_LOG_SCREEN & CRNRSTN_LOG_DEFAULT,
        'CRNRSTN_LOG_SCREEN_HTML & CRNRSTN_LOG_DEFAULT' => CRNRSTN_LOG_SCREEN_HTML & CRNRSTN_LOG_DEFAULT,
        'CRNRSTN_LOG_SCREEN_HTML_HIDDEN & CRNRSTN_LOG_DEFAULT' => CRNRSTN_LOG_SCREEN_HTML_HIDDEN & CRNRSTN_LOG_DEFAULT,
        'CRNRSTN_LOG_ELECTRUM & CRNRSTN_LOG_DEFAULT' => CRNRSTN_LOG_ELECTRUM & CRNRSTN_LOG_DEFAULT,
        'CRNRSTN_LOG_DATABASE & CRNRSTN_LOG_DEFAULT' => CRNRSTN_LOG_DATABASE & CRNRSTN_LOG_DEFAULT,
        'CRNRSTN_LOG_SSDTLA & CRNRSTN_LOG_DEFAULT' => CRNRSTN_LOG_SSDTLA & CRNRSTN_LOG_DEFAULT,
        'CRNRSTN_LOG_PSSDTLA & CRNRSTN_LOG_DEFAULT' => CRNRSTN_LOG_PSSDTLA & CRNRSTN_LOG_DEFAULT,
        'CRNRSTN_LOG_SOAP & CRNRSTN_LOG_DEFAULT' => CRNRSTN_LOG_SOAP & CRNRSTN_LOG_DEFAULT,
        'CRNRSTN_LOG_EMAIL & CRNRSTN_LOG_DATABASE' => CRNRSTN_LOG_EMAIL & CRNRSTN_LOG_DATABASE,
        'CRNRSTN_LOG_EMAIL_PROXY & CRNRSTN_LOG_DATABASE' => CRNRSTN_LOG_EMAIL_PROXY & CRNRSTN_LOG_DATABASE,
        'CRNRSTN_LOG_FILE & CRNRSTN_LOG_DATABASE' => CRNRSTN_LOG_FILE & CRNRSTN_LOG_DATABASE,
        'CRNRSTN_CHANNEL_FILE & CRNRSTN_LOG_DATABASE' => CRNRSTN_CHANNEL_FILE & CRNRSTN_LOG_DATABASE,
        'CRNRSTN_LOG_FILE_FTP & CRNRSTN_LOG_DATABASE' => CRNRSTN_LOG_FILE_FTP & CRNRSTN_LOG_DATABASE,
        'CRNRSTN_LOG_SCREEN_TEXT & CRNRSTN_LOG_DATABASE' => CRNRSTN_LOG_SCREEN_TEXT & CRNRSTN_LOG_DATABASE,
        'CRNRSTN_LOG_SCREEN & CRNRSTN_LOG_DATABASE' => CRNRSTN_LOG_SCREEN & CRNRSTN_LOG_DATABASE,
        'CRNRSTN_LOG_SCREEN_HTML & CRNRSTN_LOG_DATABASE' => CRNRSTN_LOG_SCREEN_HTML & CRNRSTN_LOG_DATABASE,
        'CRNRSTN_LOG_SCREEN_HTML_HIDDEN & CRNRSTN_LOG_DATABASE' => CRNRSTN_LOG_SCREEN_HTML_HIDDEN & CRNRSTN_LOG_DATABASE,
        'CRNRSTN_LOG_ELECTRUM & CRNRSTN_LOG_DATABASE' => CRNRSTN_LOG_ELECTRUM & CRNRSTN_LOG_DATABASE,
        'CRNRSTN_LOG_DATABASE & CRNRSTN_LOG_DATABASE' => CRNRSTN_LOG_DATABASE & CRNRSTN_LOG_DATABASE,
        'CRNRSTN_LOG_SSDTLA & CRNRSTN_LOG_DATABASE' => CRNRSTN_LOG_SSDTLA & CRNRSTN_LOG_DATABASE,
        'CRNRSTN_LOG_PSSDTLA & CRNRSTN_LOG_DATABASE' => CRNRSTN_LOG_PSSDTLA & CRNRSTN_LOG_DATABASE,
        'CRNRSTN_LOG_SOAP & CRNRSTN_LOG_DATABASE' => CRNRSTN_LOG_SOAP & CRNRSTN_LOG_DATABASE);

        self::$mem_salt = $this->oCRNRSTN->salt(32, '01');

//        if(isset($oCRNRSTN)){
//
//            //$log_silo_profile = $oCRNRSTN->log_silo_profile;
//            $log_silo_profile = $oCRNRSTN->get_crnrstn('log_silo_profile');
//
//        }

        error_log(__LINE__ . ' ' . __METHOD__ . ':: object owner[' . $parent_class . '] log object mem_salt[' . self::$mem_salt . '].');

        $this->tmp_starttime = $this->oCRNRSTN->starttime;
        $this->parent_class = $parent_class;
        $this->tmp_starttime_ARRAY = explode('.', $this->tmp_starttime);
        $this->tmp_precise_timestamp = date('Y-m-d H:i:s', $this->tmp_starttime_ARRAY[0]);

        if(isset($this->tmp_starttime_ARRAY[1])){

            $this->tmp_precise_timestamp .= '.' . $this->tmp_starttime_ARRAY[1];

        }

        //error_log(__LINE__ . ' log [' . print_r($this->tmp_starttime_ARRAY, true) . '].');

        $this->oLog_ProfileManager = $this->oCRNRSTN->return_oLog_ProfileManager();

        $this->log_silo_profile = $log_silo_profile;

        /*
        $tmp_log_silo_array = explode('|', $this->log_silo_profile);

        $tmp_log_silo_cnt = sizeof($tmp_log_silo_array);

        for($i=0;$i<$tmp_log_silo_cnt;$i++){

            if($tmp_log_silo_array[$i] == '*' || $tmp_log_silo_array[$i]==''){

                //
                // TRACE ALL LOG DATA
                $tmp_silo_checksum = crc32('*');
                $this->active_silo_ARRAY[$tmp_silo_checksum] = 1;

            }else{

                //
                // CHECK FOR POSITIVE OR NEGATIVE INCLUSION INDICATED BY PRESENCE OF ~ CHARACTER
                $pos_exclusionChar = strpos($tmp_log_silo_array[$i],'~');

                if($pos_exclusionChar!==false){

                    //
                    // REMOVE TILDE CHAR
                    $tmp_excusion_silo = $this->proper_replace('~', '', $tmp_log_silo_array[$i]);
                    $tmp_excusion_silo_checksum = crc32(trim($tmp_excusion_silo));
                    $this->silent_silo_ARRAY[$tmp_excusion_silo_checksum] = 1;

                }else{

                    $tmp_silo_checksum = crc32(trim($tmp_log_silo_array[$i]));
                    $this->active_silo_ARRAY[$tmp_silo_checksum] = 1;
                    //error_log('130 - active silo=' . $tmp_log_silo_array[$i].'[' . $tmp_silo_checksum.']');
                }

            }

        }

        */

    }

    public function set_crnrstn_logging($name, $value = NULL, $index_0 = NULL, $index_1 = NULL, $index_2 = NULL, $index_3 = NULL){

        switch($name){
            case 'config_serial':

                self::$config_serial = $value;

            break;
            default:

                error_log(__LINE__ . ' ' . __METHOD__ . ' Unknown SWITCH CASE received [' . $name . '].');
                $this->error_log('Unknown SWITCH CASE received [' . $name . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

            break;

        }

    }

    public function is_valid_output_profile($output_profile_constant){

        if(!is_numeric($output_profile_constant)){

            if(isset(self::$output_profile_ARRAY['OUTPUT_PROFILE'][CRNRSTN_STRING][$output_profile_constant])){

                return true;

            }

        }else{

            if(isset(self::$output_profile_ARRAY['OUTPUT_PROFILE'][CRNRSTN_INTEGER][$output_profile_constant])){

                return true;

            }

        }

        return false;

    }

    public function system_message_channel_constant($message_serial, $index = NULL){

        die();

        //
        // WHAT CHANNEL IS THE SYSTEM MESSAGE BEING STORED IN?
        //$tmp_channel_int = $this->system_message_channel_constant($message_serial);
        self::$system_error_message_serialization_ARRAY['CRNRSTN_ERROR_PREFIX_' . self::$config_serial][$message_serial][$tmp_err_message_memory_serial] = '';
        self::$system_error_message_channel_map_ARRAY['CRNRSTN_ERROR_PREFIX_' . self::$config_serial][$message_serial][$tmp_err_message_memory_serial] = '';

        return CRNRSTN_CHANNEL_SESSION;

    }

    public function err_message_queue_retrieve($message_override, $message_serial, $index){


        if(isset($message_override)){

            return $message_override;

        }

        if(!isset($message_serial)){

            $message_serial = 'SYSTEM_ID';

        }

        //
        // WHAT CHANNEL IS THE SYSTEM MESSAGE BEING STORED IN?
        $tmp_channel_int = $this->system_message_channel_constant($message_serial, $index);

        $tmp_err_message_memory_serial =  $this->oCRNRSTN->system_message_memory_serial();

        switch($tmp_channel_int){
            case CRNRSTN_CHANNEL_SESSION:

                $_SESSION['CRNRSTN_ERROR_PREFIX_' . self::$config_serial]['CRNRSTN_EXCEPTION_PREFIX'][$message_serial] = $message_override;

                return count($_SESSION['CRNRSTN_ERROR_PREFIX_' . self::$config_serial]['CRNRSTN_EXCEPTION_PREFIX']);

            break;
            case CRNRSTN_CHANNEL_RUNTIME:
            default:
                //case CRNRSTN_CHANNEL_GET:
                //case CRNRSTN_CHANNEL_POST:
                //case CRNRSTN_CHANNEL_COOKIE:
                //case CRNRSTN_CHANNEL_DATABASE:    // <-- IT WILL BE SOOO NICE WHEN THIS ONE IS DONE. IT SHOULD BE THE DEFAULT...imho.
                //case CRNRSTN_CHANNEL_SSDTLA:      // <-- IT WILL BE SOOO NICE WHEN THIS ONE IS DONE. WE GET CLIENT (BROWSER) STORAGE OF GLOBALLY ACCESSIBLE AND SERIALIZED BY KEY ERROR MESSAGES.
                //case CRNRSTN_CHANNEL_PSSDTLA:     // <-- IT WILL BE SOOO NICE WHEN THIS ONE IS DONE. WE GET CLIENT (BROWSER) STORAGE OF GLOBALLY ACCESSIBLE AND SERIALIZED BY KEY ERROR MESSAGES.
                //case CRNRSTN_CHANNEL_SOAP:
                //case CRNRSTN_CHANNEL_FILE:
                //case CRNRSTN_CHANNEL_FORM:        // <-- IT WILL BE SOOO NICE WHEN <FORM INTEGRATIONS> IS DONE.   // Tuesday, December 5, 2023 @ 0646 hrs.

                self::$system_error_message_queue_ARRAY['CRNRSTN_ERROR_PREFIX_' . self::$config_serial]['CRNRSTN_EXCEPTION_PREFIX'][$message_serial][] = $tmp_err_message_memory_serial;

                self::$system_error_message_serialization_ARRAY['CRNRSTN_ERROR_PREFIX_' . self::$config_serial][$message_serial][$tmp_err_message_memory_serial] = '';
                self::$system_error_message_channel_map_ARRAY['CRNRSTN_ERROR_PREFIX_' . self::$config_serial][$message_serial][$tmp_err_message_memory_serial] = '';

                return count(self::$system_error_message_serialization_ARRAY['CRNRSTN_ERROR_PREFIX_' . self::$config_serial]);

            break;


        }

        if(!isset($_SESSION['CRNRSTN_ERROR_PREFIX_' . self::$config_serial]['CRNRSTN_EXCEPTION_PREFIX'])){

            if(isset($message_override)){

                return $message_override;

            }

        }else{

            //
            // THERE CAN POTENTIALLY BE MORE THAN ONE KIND OF ERROR MESSAGE.
            if(isset($_SESSION['CRNRSTN_ERROR_PREFIX_' . self::$config_serial]['CRNRSTN_EXCEPTION_PREFIX'][$message_serial])){

                return $_SESSION['CRNRSTN_ERROR_PREFIX_' . self::$config_serial]['CRNRSTN_EXCEPTION_PREFIX'][$message_serial];

            }

            return $_SESSION['CRNRSTN_ERROR_PREFIX_' . self::$config_serial]['CRNRSTN_EXCEPTION_PREFIX']['CRNRSTN_ERR_DEFAULT'];

        }

        //
        // IS_EXCEPTION IS SUPPORT FOR CUSTOM EXCEPTION
        // HANDLING MESSAGES AND BEHAVIOR...INCLUDING
        // RETURNING A PREFIX FOR NATIVE PHP ERROR
        // MESSAGING SUPPORT (E.G., MKDIR(), FOPEN(),...).
        if($is_exception == true){

            return 'There was an error, but the CRNRSTN :: error message queue is empty. We know, however, that ';

        }

        return '';

    }

    public function err_message_queue_push($message_serial, $message, $data_authorization_profile){

        if(!isset($message_serial)){

            $message_serial = 'SYSTEM_ID';

        }

        /*
        private static $system_error_message_serialization_ARRAY = array();
        private static $system_error_message_channel_map_ARRAY = array();

        private static $system_error_message_queue_ARRAY = array();
        $_SESSION['CRNRSTN_ERROR_PREFIX_' . self::$config_serial]['CRNRSTN_EXCEPTION_PREFIX']['CRNRSTN_ERR_DEFAULT'] = $message;

        */

        $tmp_log_silo_profile_ARRAY = $this->oCRNRSTN->get_crnrstn('log_silo_profile');
        $tmp_oLog = new crnrstn_log($this->oCRNRSTN, $this->oCRNRSTN->get_micro_time(), $tmp_log_silo_profile_ARRAY);

//        if(is_object($oCRNRSTN)){
//
//            $this->starttime = $oCRNRSTN->starttime;
//
//            $tmp_oLog->set_runTime($oCRNRSTN->wall_time());
//
//        }
//
//        $tmp_oLog->set_runFile($file);
//
//        $tmp_oLog->set_classMethod($method);
//
//        $tmp_oLog->set_lineNumber($line_num);
//
//        $tmp_str = $str . '';
//
//        $tmp_oLog->set_logMsg($tmp_str);
//
//        return $tmp_oLog;

        //
        // GENERATE SYSTEM MESSAGE SERIALIZATION SALT FOR INTERNAL
        // STORAGE AND RETRIEVAL OF THE MESSAGE.
        $tmp_err_message_memory_serial = $tmp_oLog->serial();

        $tmp_channel_int = $this->oCRNRSTN->get_channel_config($data_authorization_profile, 'SOURCEID', CRNRSTN_INTEGER);
        switch($tmp_channel_int){
            case CRNRSTN_CHANNEL_SESSION:

                $_SESSION['CRNRSTN_ERROR_PREFIX_' . self::$config_serial]['CRNRSTN_EXCEPTION_PREFIX'][$message_serial][] = $message;

                return count($_SESSION['CRNRSTN_ERROR_PREFIX_' . self::$config_serial]['CRNRSTN_EXCEPTION_PREFIX'][$message_serial]);

            break;
            case CRNRSTN_CHANNEL_RUNTIME:
            default:
                //case CRNRSTN_CHANNEL_GET:
                //case CRNRSTN_CHANNEL_POST:
                //case CRNRSTN_CHANNEL_COOKIE:
                //case CRNRSTN_CHANNEL_DATABASE:    // <-- IT WILL BE SOOO NICE WHEN THIS ONE IS DONE. IT SHOULD BE THE DEFAULT...imho.
                //case CRNRSTN_CHANNEL_SSDTLA:      // <-- IT WILL BE SOOO NICE WHEN THIS ONE IS DONE. WE GET CLIENT (BROWSER) STORAGE OF GLOBALLY ACCESSIBLE AND SERIALIZED BY KEY ERROR MESSAGES.
                //case CRNRSTN_CHANNEL_PSSDTLA:     // <-- IT WILL BE SOOO NICE WHEN THIS ONE IS DONE. WE GET CLIENT (BROWSER) STORAGE OF GLOBALLY ACCESSIBLE AND SERIALIZED BY KEY ERROR MESSAGES.
                //case CRNRSTN_CHANNEL_SOAP:
                //case CRNRSTN_CHANNEL_FILE:
                //case CRNRSTN_CHANNEL_FORM:        // <-- IT WILL BE SOOO NICE WHEN <FORM INTEGRATIONS> IS DONE.   // Tuesday, December 5, 2023 @ 0646 hrs.

                self::$system_error_message_queue_ARRAY['CRNRSTN_ERROR_PREFIX_' . self::$config_serial]['CRNRSTN_EXCEPTION_PREFIX'][$message_serial][] = $tmp_err_message_memory_serial;

                self::$system_error_message_serialization_ARRAY['CRNRSTN_ERROR_PREFIX_' . self::$config_serial][$message_serial][$tmp_err_message_memory_serial] = '';
                self::$system_error_message_channel_map_ARRAY['CRNRSTN_ERROR_PREFIX_' . self::$config_serial][$message_serial][$tmp_err_message_memory_serial] = '';

                return count(self::$system_error_message_serialization_ARRAY['CRNRSTN_ERROR_PREFIX_' . self::$config_serial][$message_serial]);

            break;

        }

    }

    public function err_message_queue_clear($message_serial, $index = NULL){

        if(!isset($message_serial)){

            $message_serial = 'SYSTEM_ID';

        }

        array_splice(self::$system_error_message_queue_ARRAY['CRNRSTN_ERROR_PREFIX_' . self::$config_serial]['CRNRSTN_EXCEPTION_PREFIX'][$message_serial], 0);

        return count(self::$system_error_message_queue_ARRAY['CRNRSTN_ERROR_PREFIX_' . self::$config_serial]['CRNRSTN_EXCEPTION_PREFIX'][$message_serial]);

    }

    public function get_err_message_count($message_serial){

        if(!isset($message_serial)){

            $message_serial = 'SYSTEM_ID';

        }

        return count(self::$system_error_message_queue_ARRAY['CRNRSTN_ERROR_PREFIX_' . self::$config_serial]['CRNRSTN_EXCEPTION_PREFIX'][$message_serial]);

    }

    private function logging_config($logging_output_profile, $index_0, $index_1, $index_2, $index_3){

        if(isset($index_0) && isset($index_1) && isset($index_2) && isset($index_3)){

            if(isset($logging_output_profile[$index_0][$index_1][$index_2][$index_3])){

                return $logging_output_profile[$index_0][$index_1][$index_2][$index_3];

            }

        }

        if(isset($index_0) && isset($index_1) && isset($index_2)){

            if(isset($logging_output_profile[$index_0][$index_1][$index_2])){

                return $logging_output_profile[$index_0][$index_1][$index_2];

            }

        }

        if(isset($index_0) && isset($index_1)){

            if(isset($logging_output_profile[$index_0][$index_1])){

                return $logging_output_profile[$index_0][$index_1];

            }

        }

        if(isset($index_0)){

            if(isset($logging_output_profile[$index_0])){

                return $logging_output_profile[$index_0];

            }

        }

        //
        // RETURN THE ENTIRE LOGGING PROFILE ARRAY, I GUESS.
        //
        // Sunday, December 3, 2023 0747 hrs.
        return $logging_output_profile;

    }

    public function get_system_logging_config($logging_output_profile, $index_0, $index_1, $index_2, $index_3){

        //
        // CRNRSTN_LOG_SCREEN
        // CRNRSTN_LOG_SCREEN_HTML
        // CRNRSTN_LOG_SCREEN_TEXT
        // CRNRSTN_LOG_SCREEN_HTML_HIDDEN
        // CRNRSTN_LOG_EMAIL
        // CRNRSTN_LOG_EMAIL_PROXY
        // CRNRSTN_LOG_FILE
        // CRNRSTN_CHANNEL_FILE
        // CRNRSTN_LOG_FILE_FTP
        // CRNRSTN_LOG_DEFAULT
        // CRNRSTN_LOG_ELECTRUM
        // CRNRSTN_CHANNEL_DATABASE
        // CRNRSTN_CHANNEL_SSDTLA
        // CRNRSTN_CHANNEL_PSSDTLA
        // CRNRSTN_CHANNEL_RUNTIME
        // CRNRSTN_CHANNEL_SOAP
        //
        //    self::$system_log_output_profile_constants_ARRAY = array(
        //    CRNRSTN_LOG_EMAIL => 'CRNRSTN_LOG_EMAIL',
        //    CRNRSTN_LOG_EMAIL_PROXY => 'CRNRSTN_LOG_EMAIL_PROXY',
        //    CRNRSTN_LOG_FILE => 'CRNRSTN_LOG_FILE',
        //    CRNRSTN_CHANNEL_FILE => 'CRNRSTN_CHANNEL_FILE',
        //    CRNRSTN_LOG_FILE_FTP => 'CRNRSTN_LOG_FILE_FTP',
        //    CRNRSTN_LOG_SCREEN_TEXT => 'CRNRSTN_LOG_SCREEN_TEXT',
        //    CRNRSTN_LOG_SCREEN => 'CRNRSTN_LOG_SCREEN',
        //    CRNRSTN_LOG_SCREEN_HTML => 'CRNRSTN_LOG_SCREEN_HTML',
        //    CRNRSTN_LOG_SCREEN_HTML_HIDDEN => 'CRNRSTN_LOG_SCREEN_HTML_HIDDEN',
        //    CRNRSTN_LOG_DEFAULT => 'CRNRSTN_LOG_DEFAULT',
        //    CRNRSTN_LOG_ELECTRUM => 'CRNRSTN_LOG_ELECTRUM',
        //    CRNRSTN_CHANNEL_DATABASE => 'CRNRSTN_CHANNEL_DATABASE',
        //    CRNRSTN_CHANNEL_SSDTLA => 'CRNRSTN_CHANNEL_SSDTLA',
        //    CRNRSTN_CHANNEL_PSSDTLA => 'CRNRSTN_CHANNEL_PSSDTLA',
        //    CRNRSTN_CHANNEL_SOAP => 'CRNRSTN_CHANNEL_SOAP');

        try{

            if(is_array($logging_output_profile)){

                return $this->logging_config($logging_output_profile, $index_0, $index_1, $index_2, $index_3);

            }

            //
            // GET CHANNEL META DATA.
            switch($logging_output_profile){
                case CRNRSTN_LOG_EMAIL:
                case 'CRNRSTN_LOG_EMAIL':
                case 'crnrstn_log_email':

                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_LOG_EMAIL;
                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_LOG_EMAIL';
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['NAME'] = array(
                                                    'HTML' => 'C<span style="color:#F00;">R</span>NRSTN :: EMAIL LOGGING',
                                                    'TEXT' => 'CRNRSTN :: EMAIL LOGGING'
                                                );
                    $tmp_channel_ARRAY['DESCRIPTION'] = array(
                                                            'HTML' => 'RETURN C<span style="color:#F00;">R</span>NRSTN :: EMAIL LOGGING OUTPUT.',
                                                            'TEXT' => 'RETURN CRNRSTN :: EMAIL LOGGING OUTPUT.'
                                                        );
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_ALL => CRNRSTN_AUTHORIZE_ALL);
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_ALL' => CRNRSTN_AUTHORIZE_ALL);

                break;
                case CRNRSTN_LOG_EMAIL_PROXY:
                case 'CRNRSTN_LOG_EMAIL_PROXY':
                case 'crnrstn_log_email_proxy':

                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_LOG_EMAIL_PROXY;
                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_LOG_EMAIL_PROXY';
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['NAME'] = array(
                                                    'HTML' => 'C<span style="color:#F00;">R</span>NRSTN :: EMAIL (PROXY) LOGGING',
                                                    'TEXT' => 'CRNRSTN :: EMAIL (PROXY) LOGGING'
                                                );
                    $tmp_channel_ARRAY['DESCRIPTION'] = array(
                                                            'HTML' => 'RETURN C<span style="color:#F00;">R</span>NRSTN :: EMAIL LOGGING OUTPUT BY PROXY ON TOP OF A NuSOAP v' . $this->oCRNRSTN->version_soap() . ' POWERED SOAP SERVICES LAYER THAT WAS DEVELOPED BY e<span style="color:#F00;">V</span>ifweb UNDER THE LATEST VERSION OF THE MIT LICENSE.',
                                                            'TEXT' => 'RETURN CRNRSTN :: EMAIL LOGGING OUTPUT BY PROXY ON TOP OF A NuSOAP v' . $this->oCRNRSTN->version_soap() . ' POWERED SOAP SERVICES LAYER THAT WAS DEVELOPED BY eVifweb UNDER THE LATEST VERSION OF THE MIT LICENSE.'
                                                        );
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_ALL => CRNRSTN_AUTHORIZE_ALL);
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_ALL' => CRNRSTN_AUTHORIZE_ALL);

                break;
                case CRNRSTN_LOG_FILE:
                case 'CRNRSTN_LOG_FILE':
                case 'crnrstn_log_file':
                case CRNRSTN_CHANNEL_FILE:
                case 'CRNRSTN_CHANNEL_FILE':
                case 'crnrstn_channel_file':

                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_LOG_FILE;
                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_LOG_FILE';
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['NAME'] = array(
                                                    'HTML' => 'C<span style="color:#F00;">R</span>NRSTN :: FILE LOGGING',
                                                    'TEXT' => 'CRNRSTN :: FILE LOGGING'
                                                );
                    $tmp_channel_ARRAY['DESCRIPTION'] = array(
                                                            'HTML' => 'RETURN C<span style="color:#F00;">R</span>NRSTN :: FILE LOGGING OUTPUT.',
                                                            'TEXT' => 'RETURN CRNRSTN :: FILE LOGGING OUTPUT.'
                                                        );
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_ALL => CRNRSTN_AUTHORIZE_ALL);
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_ALL' => CRNRSTN_AUTHORIZE_ALL);

                break;
                case CRNRSTN_LOG_FILE_PROXY:
                case 'CRNRSTN_LOG_FILE_PROXY':
                case 'crnrstn_log_file_proxy':

                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_LOG_FILE_PROXY;
                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_LOG_FILE_PROXY';
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['NAME'] = array(
                                                    'HTML' => 'C<span style="color:#F00;">R</span>NRSTN :: FILE (PROXY) LOGGING.',
                                                    'TEXT' => 'CRNRSTN :: FILE (PROXY) LOGGING.'
                                                );
                    $tmp_channel_ARRAY['DESCRIPTION'] = array(
                                                            'HTML' => 'RETURN C<span style="color:#F00;">R</span>NRSTN :: FILE LOGGING OUTPUT BY PROXY ON TOP OF A NuSOAP v' . $this->oCRNRSTN->version_soap() . ' POWERED SOAP SERVICES LAYER THAT WAS DEVELOPED BY e<span style="color:#F00;">V</span>ifweb UNDER THE LATEST VERSION OF THE MIT LICENSE.',
                                                            'TEXT' => 'RETURN CRNRSTN :: FILE LOGGING OUTPUT BY PROXY ON TOP OF A NuSOAP v' . $this->oCRNRSTN->version_soap() . ' POWERED SOAP SERVICES LAYER THAT WAS DEVELOPED BY eVifweb UNDER THE LATEST VERSION OF THE MIT LICENSE.'
                                                        );
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_ALL => CRNRSTN_AUTHORIZE_ALL);
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_ALL' => CRNRSTN_AUTHORIZE_ALL);

                break;
                case CRNRSTN_LOG_FILE_FTP:
                case 'CRNRSTN_LOG_FILE_FTP':
                case 'crnrstn_log_file_ftp':

                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_LOG_FILE_FTP;
                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_LOG_FILE_FTP';
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['NAME'] = array(
                                                    'HTML' => 'C<span style="color:#F00;">R</span>NRSTN :: FTP/SFTP LOGGING',
                                                    'TEXT' => 'CRNRSTN :: FTP/SFTP LOGGING'
                                                );
                    $tmp_channel_ARRAY['DESCRIPTION'] = array(
                                                            'HTML' => 'SEND LOGGING OUTPUT TO A C<span style="color:#F00;">R</span>NRSTN :: FTP/SFTP LOGGING ENDPOINT.',
                                                            'TEXT' => 'SEND LOGGING OUTPUT TO A CRNRSTN :: FTP/SFTP LOGGING ENDPOINT.'
                                                        );
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_ALL => CRNRSTN_AUTHORIZE_ALL);
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_ALL' => CRNRSTN_AUTHORIZE_ALL);

                break;
                case CRNRSTN_LOG_FILE_FTP_PROXY:
                case 'CRNRSTN_LOG_FILE_FTP_PROXY':
                case 'crnrstn_log_file_ftp_proxy':

                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_LOG_FILE_FTP_PROXY;
                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_LOG_FILE_FTP_PROXY';
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['NAME'] = array(
                                                    'HTML' => 'C<span style="color:#F00;">R</span>NRSTN :: FTP/SFTP (PROXY) LOGGING',
                                                    'TEXT' => 'CRNRSTN :: FTP/SFTP (PROXY) LOGGING'
                                                );
                    $tmp_channel_ARRAY['DESCRIPTION'] = array(
                                                            'HTML' => 'SEND LOGGING OUTPUT TO A C<span style="color:#F00;">R</span>NRSTN :: FTP/SFTP LOGGING ENDPOINT BY PROXY ON TOP OF A NuSOAP v' . $this->oCRNRSTN->version_soap() . ' POWERED SOAP SERVICES LAYER THAT WAS DEVELOPED BY e<span style="color:#F00;">V</span>ifweb UNDER THE LATEST VERSION OF THE MIT LICENSE.',
                                                            'TEXT' => 'SEND LOGGING OUTPUT TO A CRNRSTN :: FTP/SFTP LOGGING ENDPOINT BY PROXY ON TOP OF A NuSOAP v' . $this->oCRNRSTN->version_soap() . ' POWERED SOAP SERVICES LAYER THAT WAS DEVELOPED BY eVifweb UNDER THE LATEST VERSION OF THE MIT LICENSE.'
                                                        );
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_ALL => CRNRSTN_AUTHORIZE_ALL);
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_ALL' => CRNRSTN_AUTHORIZE_ALL);

                break;
                case CRNRSTN_LOG_SCREEN_TEXT:
                case 'CRNRSTN_LOG_SCREEN_TEXT':
                case 'crnrstn_log_screen_text':

                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_LOG_SCREEN_TEXT;
                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_LOG_SCREEN_TEXT';
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['NAME'] = array(
                        'HTML' => 'C<span style="color:#F00;">R</span>NRSTN :: SCREEN TEXT LOGGING',
                        'TEXT' => 'CRNRSTN :: SCREEN TEXT LOGGING'
                    );
                    $tmp_channel_ARRAY['DESCRIPTION'] = array(
                        'HTML' => 'RETURN C<span style="color:#F00;">R</span>NRSTN :: SCREEN TEXT LOGGING OUTPUT.',
                        'TEXT' => 'RETURN CRNRSTN :: SCREEN TEXT LOGGING OUTPUT.'
                    );
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_ALL => CRNRSTN_AUTHORIZE_ALL);
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_ALL' => CRNRSTN_AUTHORIZE_ALL);

                break;
                case CRNRSTN_LOG_SCREEN:
                case 'CRNRSTN_LOG_SCREEN':
                case 'crnrstn_log_screen':

                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_LOG_SCREEN;
                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_LOG_SCREEN';
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['NAME'] = array(
                                                    'HTML' => 'C<span style="color:#F00;">R</span>NRSTN :: SCREEN OUTPUT LOGGING',
                                                    'TEXT' => 'CRNRSTN :: SCREEN OUTPUT LOGGING'
                                                );
                    $tmp_channel_ARRAY['DESCRIPTION'] = array(
                                                            'HTML' => 'RETURN C<span style="color:#F00;">R</span>NRSTN :: SCREEN LOGGING OUTPUT.',
                                                            'TEXT' => 'RETURN CRNRSTN :: SCREEN LOGGING OUTPUT.'
                                                        );
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_ALL => CRNRSTN_AUTHORIZE_ALL);
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_ALL' => CRNRSTN_AUTHORIZE_ALL);

                break;
                case CRNRSTN_LOG_SCREEN_HTML:
                case 'CRNRSTN_LOG_SCREEN_HTML':
                case 'crnrstn_log_screen_html':

                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_LOG_SCREEN_HTML;
                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_LOG_SCREEN_HTML';
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['NAME'] = array(
                                                    'HTML' => 'C<span style="color:#F00;">R</span>NRSTN :: SCREEN &lt;HTML&gt; LOGGING',
                                                    'TEXT' => 'CRNRSTN :: SCREEN <HTML> LOGGING'
                                                );
                    $tmp_channel_ARRAY['DESCRIPTION'] = array(
                                                            'HTML' => 'RETURN C<span style="color:#F00;">R</span>NRSTN :: SCREEN &lt;HTML&gt; LOGGING OUTPUT.',
                                                            'TEXT' => 'RETURN CRNRSTN :: SCREEN <HTML> LOGGING OUTPUT.'
                                                        );
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_ALL => CRNRSTN_AUTHORIZE_ALL);
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_ALL' => CRNRSTN_AUTHORIZE_ALL);

                break;
                case CRNRSTN_LOG_SCREEN_HTML_HIDDEN:
                case 'CRNRSTN_LOG_SCREEN_HTML_HIDDEN':
                case 'crnrstn_log_screen_html_hidden':

                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_LOG_SCREEN_HTML_HIDDEN;
                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_LOG_SCREEN_HTML_HIDDEN';
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['NAME'] = array(
                                                    'HTML' => 'C<span style="color:#F00;">R</span>NRSTN :: SCREEN &lt;!-- [HIDDEN HTML] --&gt; LOGGING',
                                                    'TEXT' => 'CRNRSTN :: SCREEN <!-- [HIDDEN HTML] --> LOGGING'
                                                );
                    $tmp_channel_ARRAY['DESCRIPTION'] = array(
                                                            'HTML' => 'RETURN C<span style="color:#F00;">R</span>NRSTN :: SCREEN &lt;!-- [HIDDEN HTML] --&gt; LOGGING OUTPUT.',
                                                            'TEXT' => 'RETURN CRNRSTN :: SCREEN <!-- [HIDDEN HTML] --> LOGGING OUTPUT.'
                                                        );
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_ALL => CRNRSTN_AUTHORIZE_ALL);
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_ALL' => CRNRSTN_AUTHORIZE_ALL);

                break;
                case CRNRSTN_LOG_DEFAULT:
                case 'CRNRSTN_LOG_DEFAULT':
                case 'crnrstn_log_default':

                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_LOG_DEFAULT;
                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_LOG_DEFAULT';
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['NAME'] = array(
                                                    'HTML' => 'C<span style="color:#F00;">R</span>NRSTN :: NATIVE PHP ERROR_LOG()',
                                                    'TEXT' => 'CRNRSTN :: NATIVE PHP ERROR_LOG()'
                                                );
                    $tmp_channel_ARRAY['DESCRIPTION'] = array(
                                                            'HTML' => 'RETURN C<span style="color:#F00;">R</span>NRSTN :: NATIVE PHP ERROR_LOG() LOGGING OUTPUT FORMATTED FOR READABILITY AND SLIGHTLY ENRICHED BY e<span style="color:#F00;">V</span>ifweb UNDER THE LATEST VERSION OF THE MIT LICENSE.',
                                                            'TEXT' => 'RETURN CRNRSTN :: NATIVE PHP ERROR_LOG() LOGGING OUTPUT FORMATTED FOR READABILITY AND SLIGHTLY ENRICHED BY eVifweb UNDER THE LATEST VERSION OF THE MIT LICENSE.'
                                                        );
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_ALL => CRNRSTN_AUTHORIZE_ALL);
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_ALL' => CRNRSTN_AUTHORIZE_ALL);

                break;
                case CRNRSTN_LOG_DEFAULT_PROXY:
                case 'CRNRSTN_LOG_DEFAULT_PROXY':
                case 'crnrstn_log_default_proxy':

                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_LOG_DEFAULT_PROXY;
                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_LOG_DEFAULT_PROXY';
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['NAME'] = array(
                                                    'HTML' => 'C<span style="color:#F00;">R</span>NRSTN :: NATIVE PHP ERROR_LOG (PROXY)',
                                                    'TEXT' => 'CRNRSTN :: NATIVE PHP ERROR_LOG (PROXY)'
                                                );
                    $tmp_channel_ARRAY['DESCRIPTION'] = array(
                                                            'HTML' => 'RETURN C<span style="color:#F00;">R</span>NRSTN :: NATIVE PHP ERROR_LOG() LOGGING THAT IS FORMATTED FOR READABILITY AND SLIGHTLY ENRICHED BY e<span style="color:#F00;">V</span>ifweb. THIS OUTPUT IS DELIVERED BY PROXY ON TOP OF A NuSOAP v' . $this->oCRNRSTN->version_soap() . ' POWERED SOAP SERVICES LAYER THAT WAS DEVELOPED BY e<span style="color:#F00;">V</span>ifweb UNDER THE LATEST VERSION OF THE MIT LICENSE.',
                                                            'TEXT' => 'RETURN CRNRSTN :: NATIVE PHP ERROR_LOG() LOGGING THAT IS FORMATTED FOR READABILITY AND SLIGHTLY ENRICHED BY eVifweb. THIS OUTPUT IS DELIVERED BY PROXY ON TOP OF A NuSOAP v' . $this->oCRNRSTN->version_soap() . ' POWERED SOAP SERVICES LAYER THAT WAS DEVELOPED BY eVifweb UNDER THE LATEST VERSION OF THE MIT LICENSE.'
                                                        );
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_ALL => CRNRSTN_AUTHORIZE_ALL);
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_ALL' => CRNRSTN_AUTHORIZE_ALL);

                break;
                case CRNRSTN_LOG_ELECTRUM:
                case 'CRNRSTN_LOG_ELECTRUM':
                case 'crnrstn_log_electrum':

                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_LOG_ELECTRUM;
                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_LOG_ELECTRUM';
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['NAME'] = array(
                                                    'HTML' => 'C<span style="color:#F00;">R</span>NRSTN :: ELECTRUM LOGGING',
                                                    'TEXT' => 'CRNRSTN :: ELECTRUM LOGGING'
                                                );
                    $tmp_channel_ARRAY['DESCRIPTION'] = array(
                                                            'HTML' => 'PRODUCE C<span style="color:#F00;">R</span>NRSTN :: ELECTRUM LOGGING OUTPUT. THIS OUTPUT IS DELIVERED BY PROXY ON TOP OF A NuSOAP v' . $this->oCRNRSTN->version_soap() . ' POWERED SOAP SERVICES LAYER THAT WAS DEVELOPED BY e<span style="color:#F00;">V</span>ifweb UNDER THE LATEST VERSION OF THE MIT LICENSE.',
                                                            'TEXT' => 'PRODUCE CRNRSTN :: ELECTRUM LOGGING OUTPUT. THIS OUTPUT IS DELIVERED BY PROXY ON TOP OF A NuSOAP v' . $this->oCRNRSTN->version_soap() . ' POWERED SOAP SERVICES LAYER THAT WAS DEVELOPED BY eVifweb UNDER THE LATEST VERSION OF THE MIT LICENSE.'
                                                        );
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_ALL => CRNRSTN_AUTHORIZE_ALL);
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_ALL' => CRNRSTN_AUTHORIZE_ALL);

                break;
                case CRNRSTN_LOG_ELECTRUM_PROXY:
                case 'CRNRSTN_LOG_ELECTRUM_PROXY':
                case 'crnrstn_log_electrum_proxy':

                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_LOG_ELECTRUM_PROXY;
                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_LOG_ELECTRUM_PROXY';
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['NAME'] = array(
                                                    'HTML' => 'C<span style="color:#F00;">R</span>NRSTN :: ELECTRUM LOGGING (PROXY)',
                                                    'TEXT' => 'CRNRSTN :: ELECTRUM LOGGING (PROXY)'
                                                );
                    $tmp_channel_ARRAY['DESCRIPTION'] = array(
                                                            'HTML' => 'PRODUCE C<span style="color:#F00;">R</span>NRSTN :: ELECTRUM LOGGING OUTPUT BY PROXY ON TOP OF A NuSOAP v' . $this->oCRNRSTN->version_soap() . ' POWERED SOAP SERVICES LAYER THAT WAS DEVELOPED BY e<span style="color:#F00;">V</span>ifweb UNDER THE LATEST VERSION OF THE MIT LICENSE.',
                                                            'TEXT' => 'PRODUCE CRNRSTN :: ELECTRUM LOGGING OUTPUT BY PROXY ON TOP OF A NuSOAP v' . $this->oCRNRSTN->version_soap() . ' POWERED SOAP SERVICES LAYER THAT WAS DEVELOPED BY eVifweb UNDER THE LATEST VERSION OF THE MIT LICENSE.'
                                                        );
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_ALL => CRNRSTN_AUTHORIZE_ALL);
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_ALL' => CRNRSTN_AUTHORIZE_ALL);

                break;
                case CRNRSTN_LOG_DATABASE:
                case 'CRNRSTN_LOG_DATABASE':
                case 'crnrstn_log_database':
                case CRNRSTN_CHANNEL_DATABASE:
                case 'CRNRSTN_CHANNEL_DATABASE':
                case 'crnrstn_channel_database':

                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_CHANNEL_DATABASE;
                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_CHANNEL_DATABASE';
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['NAME'] = array(
                                                    'HTML' => 'C<span style="color:#F00;">R</span>NRSTN :: DATABASE LOGGING',
                                                    'TEXT' => 'CRNRSTN :: DATABASE LOGGING'
                                                );
                    $tmp_channel_ARRAY['DESCRIPTION'] = array(
                                                            'HTML' => 'RETURN C<span style="color:#F00;">R</span>NRSTN :: DATABASE LOGGING OUTPUT.',
                                                            'TEXT' => 'RETURN CRNRSTN :: DATABASE LOGGING OUTPUT.'
                                                        );
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_ALL => CRNRSTN_AUTHORIZE_ALL);
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_ALL' => CRNRSTN_AUTHORIZE_ALL);

                break;
                case CRNRSTN_LOG_DATABASE_PROXY:
                case 'CRNRSTN_LOG_DATABASE_PROXY':
                case 'crnrstn_log_database_proxy':

                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_LOG_DATABASE_PROXY;
                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_LOG_DATABASE_PROXY';
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['NAME'] = array(
                                                    'HTML' => 'C<span style="color:#F00;">R</span>NRSTN :: DATABASE LOGGING (PROXY)',
                                                    'TEXT' => 'CRNRSTN :: DATABASE LOGGING (PROXY)'
                                                );
                    $tmp_channel_ARRAY['DESCRIPTION'] = array(
                                                'HTML' => 'RETURN C<span style="color:#F00;">R</span>NRSTN :: DATABASE LOGGING OUTPUT BY PROXY ON TOP OF A NuSOAP v' . $this->oCRNRSTN->version_soap() . ' POWERED SOAP SERVICES LAYER THAT WAS DEVELOPED BY e<span style="color:#F00;">V</span>ifweb UNDER THE LATEST VERSION OF THE MIT LICENSE.',
                                                'TEXT' => 'RETURN CRNRSTN :: DATABASE LOGGING OUTPUT BY PROXY ON TOP OF A NuSOAP v' . $this->oCRNRSTN->version_soap() . ' POWERED SOAP SERVICES LAYER THAT WAS DEVELOPED BY eVifweb UNDER THE LATEST VERSION OF THE MIT LICENSE.'
                                            );
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_ALL => CRNRSTN_AUTHORIZE_ALL);
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_ALL' => CRNRSTN_AUTHORIZE_ALL);

                break;
                case CRNRSTN_CHANNEL_SSDTLA:
                case 'CRNRSTN_CHANNEL_SSDTLA':
                case 'crnrstn_channel_ssdtla':
                case CRNRSTN_LOG_SSDTLA:
                case 'CRNRSTN_LOG_SSDTLA':
                case 'crnrstn_log_ssdtla':

                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_LOG_SSDTLA;
                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_LOG_SSDTLA';
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['NAME'] = array(
                                                    'HTML' => 'C<span style="color:#F00;">R</span>NRSTN :: SSDTLA LOGGING',
                                                    'TEXT' => 'CRNRSTN :: SSDTLA LOGGING'
                                                );
                    $tmp_channel_ARRAY['DESCRIPTION'] = array(
                                                            'HTML' => 'RETURN LOGGING OUTPUT ON TOP OF THE C<span style="color:#F00;">R</span>NRSTN :: 
SOAP SERVICES DATA TUNNEL LAYER (SSDTL). PLEASE NOTE THAT THE ENCRYPTED SSDTLA DATA 
PACKET THAT IS STORED IN THE BROWSER DOM VIA &lt;FORM&gt; HIDDEN INPUT IS 
ACTUALLY JUST A C<span style="color:#F00;">R</span>NRSTN :: PSEUDO-SOAP SERVICES DATA TUNNEL LAYER ARCHITECTURE (PSSDTLA) 
DATA PACKET (I.E. AN OpenSSL v' . $this->oCRNRSTN->version_openssl() . ' ENCRYPTED JSON OBJECT).
 
THE PRIMARY AND SIGNIFICANT DIFFERENCE BETWEEN THE C<span style="color:#F00;">R</span>NRSTN :: SSDTLA DATA PACKET AND THE SLIGHTLY SIMPLER C<span style="color:#F00;">R</span>NRSTN :: PSSDTLA PACKET (AN ENCRYPTED 
JSON OBJECT) IS THAT THE C<span style="color:#F00;">R</span>NRSTN :: SSDTLA TAKES THE ENCRYPTED JSON OBJECT AND THEN ENCAPSULATES OR WRAPS IT WITHIN A NuSOAP v' . $this->oCRNRSTN->version_soap() . ' 
POWERED SOAP OBJECT BEFORE STORING IT AS STATIC DATA AT THE BROWSER IN THE BUILD OF THE PAGE HTML OR THROUGH oC<span style="color:#F00;">R</span>NRSTN_JS WHEN A NEW SOAP 
REQUEST (A FRESH SSDTLA PACKET) IS RETURNED BY THE C<span style="color:#F00;">R</span>NRSTN :: SSDTLA ITSELF TO THE BROWSER IN AN &lt;XML&gt; DOCUMENT RESPONSE TO AN 
AJAX DRIVEN XHR REQUEST. 

BEHOLD BOTH THE BEAUTY, POWER, AND SIMPLICITY OF SOAP; THE C<span style="color:#F00;">R</span>NRSTN :: SSDTLA, 
DEVELOPED BY e<span style="color:#F00;">V</span>ifweb, HAS EVERY BROWSER TALKING TO THE SERVER LIKE IT IS A SERVER 
FOR REQUEST AUTHENTICATION AT THE SOAP SERVICES SERVER ENDPOINT AND REQUEST SERIALIZATION FOR UI/UX PROCESS 
SYNCHRONIZATION AND MEMORY (CACHE) MANAGEMENT AT THE SOAP CLIENT SERVER...THE BROWSER.

THE STRATEGIC VALUE OF THE C<span style="color:#F00;">R</span>NRSTN :: SOAP SERVICES DATA TUNNEL LAYER WILL HAVE 
ARRIVED, AT LEAST IN PART, WHEN THE BROWSER\'S SSDTLA SOAP PACKET CAN BE PROXIED TO AN ACTIVE SESSION AT ANY ORIGIN OR DOMAIN CONTROLLING 
SERVER IN SUPPORT OF THE SESSION AUTHENTICATION SERVICES LAYER BEHIND A C<span style="color:#F00;">R</span>NRSTN :: MESSENGER SESSION AT ANY EDGE SERVER.

C<span style="color:#F00;">R</span>NRSTN :: MESSENGER COULD EASILY BECOME THE DEFINITIVE AND MIT LICENSED FUNCTIONAL 
AND SPIRITUAL REPLACEMENT FOR WHAT WAS ONCE YAHOO INSTANT MESSENGER.

THE C<span style="color:#F00;">R</span>NRSTN :: SSDTLA IS A HARDENED DATA HANDLING 
ARCHITECTURE THAT IS PROTECTED BY OpenSSL v' . $this->oCRNRSTN->version_openssl() . ' ENCRYPTION TECHNOLOGY AND 
DEVELOPED BY eVifweb UNDER THE LATEST VERSION OF THE MIT LICENSE.',
                                                            'TEXT' => 'RETURN LOGGING OUTPUT ON TOP OF THE CRNRSTN :: 
SOAP SERVICES DATA TUNNEL LAYER (SSDTL). PLEASE NOTE THAT THE ENCRYPTED SSDTLA DATA 
PACKET THAT IS STORED IN THE BROWSER DOM VIA &lt;FORM&gt; HIDDEN INPUT IS 
ACTUALLY JUST A CRNRSTN :: PSEUDO-SOAP SERVICES DATA TUNNEL LAYER ARCHITECTURE (PSSDTLA) 
DATA PACKET (I.E. AN OpenSSL v' . $this->oCRNRSTN->version_openssl() . ' ENCRYPTED JSON OBJECT).
 
THE PRIMARY AND SIGNIFICANT DIFFERENCE BETWEEN THE CRNRSTN :: SSDTLA DATA PACKET AND THE SLIGHTLY SIMPLER CRNRSTN :: PSSDTLA PACKET (AN ENCRYPTED 
JSON OBJECT) IS THAT THE SSDTLA TAKES THE ENCRYPTED JSON OBJECT AND THEN ENCAPSULATES OR WRAPS IT WITHIN A NuSOAP v' . $this->oCRNRSTN->version_soap() . ' 
POWERED SOAP OBJECT BEFORE STORING IT AS STATIC DATA AT THE BROWSER IN THE BUILD OF THE PAGE HTML OR THROUGH oCRNRSTN_JS WHEN A NEW SOAP 
REQUEST (A FRESH SSDTLA PACKET) IS RETURNED BY THE SSDTLA ITSELF TO THE BROWSER IN AN &lt;XML&gt; DOCUMENT RESPONSE TO AN 
AJAX DRIVEN XHR REQUEST. 

BEHOLD BOTH THE BEAUTY, POWER, AND SIMPLICITY OF SOAP; THE CRNRSTN :: SSDTLA, 
DEVELOPED BY eVifweb, HAS EVERY BROWSER TALKING TO THE SERVER LIKE IT IS A SERVER 
FOR REQUEST AUTHENTICATION AT THE SOAP SERVICES SERVER ENDPOINT AND REQUEST SERIALIZATION FOR UI/UX PROCESS 
SYNCHRONIZATION AND MEMORY (CACHE) MANAGEMENT AT THE SOAP CLIENT SERVER...THE BROWSER.

THE STRATEGIC VALUE OF THE CRNRSTN :: SOAP SERVICES DATA TUNNEL LAYER WILL HAVE 
ARRIVED, AT LEAST IN PART, WHEN THE BROWSER\'S SSDTLA SOAP PACKET CAN BE PROXIED TO AN ACTIVE SESSION AT ANY ORIGIN OR DOMAIN CONTROLLING 
SERVER IN SUPPORT OF THE SESSION AUTHENTICATION SERVICES LAYER BEHIND A CRNRSTN :: MESSENGER SESSION AT ANY EDGE SERVER.

CRNRSTN :: MESSENGER COULD EASILY BECOME THE DEFINITIVE AND MIT LICENSED FUNCTIONAL 
AND SPIRITUAL REPLACEMENT FOR WHAT WAS ONCE YAHOO INSTANT MESSENGER.

THE CRNRSTN :: SSDTLA IS A HARDENED DATA HANDLING 
ARCHITECTURE THAT IS PROTECTED BY OpenSSL v' . $this->oCRNRSTN->version_openssl() . ' ENCRYPTION TECHNOLOGY AND 
DEVELOPED BY eVifweb UNDER THE LATEST VERSION OF THE MIT LICENSE.'
                                                );
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_ALL => CRNRSTN_AUTHORIZE_ALL);
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_ALL' => CRNRSTN_AUTHORIZE_ALL);

                break;
                case CRNRSTN_LOG_SSDTLA_PROXY:
                case 'CRNRSTN_LOG_SSDTLA_PROXY':
                case 'crnrstn_log_ssdtla_proxy':

                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_LOG_SSDTLA_PROXY;
                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_LOG_SSDTLA_PROXY';
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['NAME'] = array(
                                                    'HTML' => 'C<span style="color:#F00;">R</span>NRSTN :: SSDTLA LOGGING (PROXY)',
                                                    'TEXT' => 'CRNRSTN :: SSDTLA LOGGING (PROXY)'
                                                );
                    $tmp_channel_ARRAY['DESCRIPTION'] = array(
                                                            'HTML' => 'RETURN LOGGING OUTPUT ON TOP OF THE C<span style="color:#F00;">R</span>NRSTN :: SOAP SERVICES 
DATA TUNNEL LAYER (SSDTL) LOGGING OUTPUT BY PROXY ON TOP OF A NuSOAP v' . $this->oCRNRSTN->version_soap() . ' POWERED 
SOAP SERVICES LAYER THAT WAS DEVELOPED BY e<span style="color:#F00;">V</span>ifweb UNDER THE LATEST VERSION OF THE 
MIT LICENSE. PLEASE NOTE THAT THE ENCRYPTED SSDTLA DATA PACKET THAT IS STORED IN THE BROWSER DOM VIA &lt;FORM&gt; HIDDEN INPUT IS 
ACTUALLY JUST A C<span style="color:#F00;">R</span>NRSTN :: PSEUDO-SOAP SERVICES DATA TUNNEL LAYER ARCHITECTURE (PSSDTLA) 
DATA PACKET (I.E. AN OpenSSL v' . $this->oCRNRSTN->version_openssl() . ' ENCRYPTED JSON OBJECT).
 
THE PRIMARY AND SIGNIFICANT DIFFERENCE BETWEEN THE C<span style="color:#F00;">R</span>NRSTN :: SSDTLA DATA PACKET AND THE SLIGHTLY SIMPLER C<span style="color:#F00;">R</span>NRSTN :: PSSDTLA PACKET (AN ENCRYPTED 
JSON OBJECT) IS THAT THE C<span style="color:#F00;">R</span>NRSTN :: SSDTLA TAKES THE ENCRYPTED JSON OBJECT AND THEN ENCAPSULATES OR WRAPS IT WITHIN A NuSOAP v' . $this->oCRNRSTN->version_soap() . ' 
POWERED SOAP OBJECT BEFORE STORING IT AS STATIC DATA AT THE BROWSER IN THE BUILD OF THE PAGE HTML OR THROUGH oC<span style="color:#F00;">R</span>NRSTN_JS WHEN A NEW SOAP 
REQUEST (A FRESH SSDTLA PACKET) IS RETURNED BY THE C<span style="color:#F00;">R</span>NRSTN :: SSDTLA ITSELF TO THE BROWSER IN AN &lt;XML&gt; DOCUMENT RESPONSE TO AN 
AJAX DRIVEN XHR REQUEST. 

BEHOLD BOTH THE BEAUTY, POWER, AND SIMPLICITY OF SOAP; THE C<span style="color:#F00;">R</span>NRSTN :: SSDTLA, 
DEVELOPED BY e<span style="color:#F00;">V</span>ifweb, HAS EVERY BROWSER TALKING TO THE SERVER LIKE IT IS A SERVER 
FOR REQUEST AUTHENTICATION AT THE SOAP SERVICES SERVER ENDPOINT AND REQUEST SERIALIZATION FOR UI/UX PROCESS 
SYNCHRONIZATION AND MEMORY (CACHE) MANAGEMENT AT THE SOAP CLIENT SERVER...THE BROWSER.

THE STRATEGIC VALUE OF THE C<span style="color:#F00;">R</span>NRSTN :: SOAP SERVICES DATA TUNNEL LAYER WILL HAVE 
ARRIVED, AT LEAST IN PART, WHEN THE BROWSER\'S SSDTLA SOAP PACKET CAN BE PROXIED TO AN ACTIVE SESSION AT ANY ORIGIN OR DOMAIN CONTROLLING 
SERVER IN SUPPORT OF THE SESSION AUTHENTICATION SERVICES LAYER BEHIND A C<span style="color:#F00;">R</span>NRSTN :: MESSENGER SESSION AT ANY EDGE SERVER.

C<span style="color:#F00;">R</span>NRSTN :: MESSENGER COULD EASILY BECOME THE DEFINITIVE AND MIT LICENSED FUNCTIONAL 
AND SPIRITUAL REPLACEMENT FOR WHAT WAS ONCE YAHOO INSTANT MESSENGER.

THE C<span style="color:#F00;">R</span>NRSTN :: SSDTLA IS A HARDENED DATA HANDLING 
ARCHITECTURE THAT IS PROTECTED BY OpenSSL v' . $this->oCRNRSTN->version_openssl() . ' ENCRYPTION TECHNOLOGY AND 
DEVELOPED BY eVifweb UNDER THE LATEST VERSION OF THE MIT LICENSE.',
                                                            'TEXT' => 'RETURN LOGGING OUTPUT ON TOP OF THE CRNRSTN :: SOAP SERVICES 
DATA TUNNEL LAYER (SSDTL) LOGGING OUTPUT BY PROXY ON TOP OF A NuSOAP v' . $this->oCRNRSTN->version_soap() . ' POWERED SOAP 
SERVICES LAYER THAT WAS DEVELOPED BY eVifweb UNDER THE LATEST VERSION OF THE MIT LICENSE.

PLEASE NOTE THAT THE ENCRYPTED SSDTLA DATA PACKET THAT IS STORED IN THE BROWSER DOM VIA &lt;FORM&gt; HIDDEN INPUT IS 
ACTUALLY JUST A CRNRSTN :: PSEUDO-SOAP SERVICES DATA TUNNEL LAYER ARCHITECTURE (PSSDTLA) 
DATA PACKET (I.E. AN OpenSSL v' . $this->oCRNRSTN->version_openssl() . ' ENCRYPTED JSON OBJECT).
 
THE PRIMARY AND SIGNIFICANT DIFFERENCE BETWEEN THE CRNRSTN :: SSDTLA DATA PACKET AND THE SLIGHTLY SIMPLER CRNRSTN :: PSSDTLA PACKET (AN ENCRYPTED 
JSON OBJECT) IS THAT THE SSDTLA TAKES THE ENCRYPTED JSON OBJECT AND THEN ENCAPSULATES OR WRAPS IT WITHIN A NuSOAP v' . $this->oCRNRSTN->version_soap() . ' 
POWERED SOAP OBJECT BEFORE STORING IT AS STATIC DATA AT THE BROWSER IN THE BUILD OF THE PAGE HTML OR THROUGH oCRNRSTN_JS WHEN A NEW SOAP 
REQUEST (A FRESH SSDTLA PACKET) IS RETURNED BY THE SSDTLA ITSELF TO THE BROWSER IN AN &lt;XML&gt; DOCUMENT RESPONSE TO AN 
AJAX DRIVEN XHR REQUEST. 

BEHOLD BOTH THE BEAUTY, POWER, AND SIMPLICITY OF SOAP; THE CRNRSTN :: SSDTLA, 
DEVELOPED BY eVifweb, HAS EVERY BROWSER TALKING TO THE SERVER LIKE IT IS A SERVER 
FOR REQUEST AUTHENTICATION AT THE SOAP SERVICES SERVER ENDPOINT AND REQUEST SERIALIZATION FOR UI/UX PROCESS 
SYNCHRONIZATION AND MEMORY (CACHE) MANAGEMENT AT THE SOAP CLIENT SERVER...THE BROWSER.

THE STRATEGIC VALUE OF THE CRNRSTN :: SOAP SERVICES DATA TUNNEL LAYER WILL HAVE 
ARRIVED, AT LEAST IN PART, WHEN THE BROWSER\'S SSDTLA SOAP PACKET CAN BE PROXIED TO AN ACTIVE SESSION AT ANY ORIGIN OR DOMAIN CONTROLLING 
SERVER IN SUPPORT OF THE SESSION AUTHENTICATION SERVICES LAYER BEHIND A CRNRSTN :: MESSENGER SESSION AT ANY EDGE SERVER.

CRNRSTN :: MESSENGER COULD EASILY BECOME THE DEFINITIVE AND MIT LICENSED FUNCTIONAL 
AND SPIRITUAL REPLACEMENT FOR WHAT WAS ONCE YAHOO INSTANT MESSENGER.

THE CRNRSTN :: SSDTLA IS A HARDENED DATA HANDLING 
ARCHITECTURE THAT IS PROTECTED BY OpenSSL v' . $this->oCRNRSTN->version_openssl() . ' ENCRYPTION TECHNOLOGY AND 
DEVELOPED BY eVifweb UNDER THE LATEST VERSION OF THE MIT LICENSE.'
                                                        );
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_ALL => CRNRSTN_AUTHORIZE_ALL);
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_ALL' => CRNRSTN_AUTHORIZE_ALL);

                break;
                case CRNRSTN_CHANNEL_PSSDTLA:
                case 'CRNRSTN_CHANNEL_PSSDTLA':
                case 'crnrstn_channel_pssdtla':
                case CRNRSTN_LOG_PSSDTLA:
                case 'CRNRSTN_LOG_PSSDTLA':
                case 'crnrstn_log_pssdtla':

                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_CHANNEL_PSSDTLA;
                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_CHANNEL_PSSDTLA';
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['NAME'] = array(
                                                    'HTML' => 'C<span style="color:#F00;">R</span>NRSTN :: PSSDTLA LOGGING',
                                                    'TEXT' => 'CRNRSTN :: PSSDTLA LOGGING'
                                                );
                    $tmp_channel_ARRAY['DESCRIPTION'] = array(
                                                            'HTML' => 'RETURN LOGGING OUTPUT ON TOP OF THE C<span style="color:#F00;">R</span>NRSTN :: PSEUDO-SOAP SERVICES DATA TUNNEL LAYER (PSSDTL). THE C<span style="color:#F00;">R</span>NRSTN :: PSSDTLA IS A HARDENED DATA HANDLING ARCHITECTURE THAT IS PROTECTED BY OpenSSL v' . $this->oCRNRSTN->version_openssl() . ' ENCRYPTION (OF A JSON OBJECT) TECHNOLOGY AND DEVELOPED BY e<span style="color:#F00;">V</span>ifweb UNDER THE LATEST VERSION OF THE MIT LICENSE.',
                                                            'TEXT' => 'RETURN LOGGING OUTPUT ON TOP OF THE CRNRSTN :: PSEUDO-SOAP SERVICES DATA TUNNEL LAYER (PSSDTL). THE CRNRSTN :: PSSDTLA IS A HARDENED DATA HANDLING ARCHITECTURE THAT IS PROTECTED BY OpenSSL v' . $this->oCRNRSTN->version_openssl() . ' ENCRYPTION (OF A JSON OBJECT) TECHNOLOGY AND DEVELOPED BY eVifweb UNDER THE LATEST VERSION OF THE MIT LICENSE.'
                                                        );
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_ALL => CRNRSTN_AUTHORIZE_ALL);
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_ALL' => CRNRSTN_AUTHORIZE_ALL);

                break;
                case CRNRSTN_LOG_PSSDTLA_PROXY:
                case 'CRNRSTN_LOG_PSSDTLA_PROXY':
                case 'crnrstn_log_pssdtla_proxy':

                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_LOG_PSSDTLA_PROXY;
                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_LOG_PSSDTLA_PROXY';
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['NAME'] = array(
                                                    'HTML' => 'C<span style="color:#F00;">R</span>NRSTN :: PSSDTLA LOGGING (PROXY)',
                                                    'TEXT' => 'CRNRSTN :: PSSDTLA LOGGING (PROXY)'
                                                );
                    $tmp_channel_ARRAY['DESCRIPTION'] = array(
                                                            'HTML' => 'RETURN LOGGING OUTPUT THROUGH THE C<span style="color:#F00;">R</span>NRSTN :: PSEUDO-SOAP SERVICES DATA TUNNEL LAYER (PSSDTL) LOGGING OUTPUT BY PROXY ON TOP OF A NuSOAP v' . $this->oCRNRSTN->version_soap() . ' POWERED SOAP SERVICES LAYER DEVELOPED BY e<span style="color:#F00;">V</span>ifweb UNDER THE LATEST VERSION OF THE MIT LICENSE.',
                                                            'TEXT' => 'RETURN LOGGING OUTPUT THROUGH THE CRNRSTN :: PSEUDO-SOAP SERVICES DATA TUNNEL LAYER (PSSDTL) LOGGING OUTPUT BY PROXY ON TOP OF A NuSOAP v' . $this->oCRNRSTN->version_soap() . ' POWERED SOAP SERVICES LAYER DEVELOPED BY eVifweb UNDER THE LATEST VERSION OF THE MIT LICENSE.'
                                                        );
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = -1;
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = '-1';
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_ALL => CRNRSTN_AUTHORIZE_ALL);
                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_ALL' => CRNRSTN_AUTHORIZE_ALL);

                break;
                default:

                    //
                    // THIS IS CRNRSTN :: CONFIGURATION UGC SETTINGS INPUT DATA
                    // THAT WILL STILL REQUIRE INPUT VALIDATION.
                    $tmp_output_profile = $this->oCRNRSTN->get_resource('system_logging_output_profile', 0, 'CRNRSTN::RESOURCE::LOGGING');

                    if(!is_numeric($tmp_output_profile)){

                        $tmp_int = $this->oCRNRSTN->get_system_logging_config($tmp_output_profile, CRNRSTN_INTEGER);

                        if(!($this->oCRNRSTN->isset_crnrstn('system_log_output_profile_constants_ARRAY', $tmp_int) == true)){

                            //
                            // THIS IS A STATIC HARD CODE OF,
                            // self::$system_default_logging_output_profile = CRNRSTN_LOG_DEFAULT,
                            // IN THE CRNRSTN :: __CONSTRUCTOR().
                            //
                            // Sunday, December 3, 2023 @ 0501 hrs.
                            $tmp_int = $this->oCRNRSTN->get_crnrstn('system_default_logging_output_profile');

                            //
                            // JUST IN CASE, A STRING VALUE IS EVER PROVIDED
                            // TO THE CRNRSTN :: __CONSTRUCTOR().
                            if(!is_numeric($tmp_int)){

                                $tmp_int = $this->oCRNRSTN->get_system_logging_config($tmp_int, CRNRSTN_INTEGER);

                                if(!($this->oCRNRSTN->isset_crnrstn('system_log_output_profile_constants_ARRAY', $tmp_int) == true)){

                                    //
                                    // Sunday, December 3, 2023 @ 0504 hrs.
                                    $tmp_int = CRNRSTN_LOG_DEFAULT;

                                }

                            }

                        }

                    }

                    $tmp_err_str = 'CRNRSTN :: could not apply the CRNRSTN :: SOAP SERVICES LOGGING SERVICES LAYER log initialization profile, (' .
                        $this->oCRNRSTN->gettype($logging_output_profile) . ') ' . strval($logging_output_profile) . ', which was the value that was provided as method input to this environment. The will be manually set to ' . $this->oCRNRSTN->get_system_logging_config($tmp_int, CRNRSTN_STRING).'[' . $tmp_int . ']. ' .
                        $this->oCRNRSTN->data_report($logging_output_profile, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                    $this->oCRNRSTN->error_log($tmp_err_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                    return $this->get_system_logging_config($tmp_int, $index_0, $index_1, $index_2, $index_3);

                break;

            }

            return $this->get_system_logging_config($tmp_channel_ARRAY, $index_0, $index_1, $index_2, $index_3);

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN EMPTY STRING.
            return '';

        }

    }

    public function return_active_log_silo_keys(){

        return $this->active_log_silo_flag_ARRAY;

    }

    public function sync_olog_profile_manager($oLog_ProfileManager){

        $this->oLog_ProfileManager = $oLog_ProfileManager;

    }

    private function proper_replace($pattern, $replacement, $original_str){

        $pattern_array[0] = $pattern;
        $replacement_array[0] = $replacement;

        $original_str = str_replace($pattern_array, $replacement_array, $original_str);

        return $original_str;

    }

    public function catch_exception($exception_obj, $syslog_constant, $exception_method, $namespace, $profile_override_pipe, $endpoint_override_pipe, $wcr_override_pipe){

        /*
        # syslog()
        # SYSLOG priority is a combination of the facility and the level. Possible values
        # are (in descending order):
        # Constant		Description
        # LOG_EMERG		system is unusable.
        # LOG_ALERT		action must be taken immediately
        # LOG_CRIT		critical conditions
        # LOG_ERR		error conditions
        # LOG_WARNING	warning conditions
        # LOG_NOTICE	normal, but significant, condition
        # LOG_INFO		informational message
        # LOG_DEBUG		debug-level message

        Exception $e
        final public getMessage ( void ) : string
        final public getPrevious ( void ) : Throwable
        final public getCode ( void ) : mixed
        final public getFile ( void ) : string
        final public getLine ( void ) : int
        final public getTrace ( void ) : array
        final public getTraceAsString ( void ) : string
        public __toString ( void ) : string
        final private __clone ( void ) : void

        $this->error_log('121 - getMessage=' . $exception_obj->getMessage());
        $this->error_log('122 - getPrevious=' . $exception_obj->getPrevious());
        $this->error_log('123 - getCode=' . $exception_obj->getCode());
        $this->error_log('124 - getFile=' . $exception_obj->getFile());
        $this->error_log('125 - getLine=' . $exception_obj->getLine());
        $this->error_log('126 - getTraceAsString=' . $exception_obj->getTraceAsString());

        121 - getMessage=The requested _SERVER super global parameter [CLOWN_TOWN] cannot be found.
        122 - getPrevious=
        123 - getCode=0
        124 - getFile=/var/www/html/crnrstn_v2/_crnrstn/class/environment/crnrstn.environment.inc.php
        125 - getLine=403
        126 - getTraceAsString=#0 /var/www/html/crnrstn_v2/_crnrstn/class/user/crnrstn.user.inc.php(6063): crnrstn_environment->getServerArrayVar('CLOWN_TOWN', Object(crnrstn_user))\n#1 /var/www/html/crnrstn_v2/common/inc/footer/footer.inc.php(591): crnrstn_user->get_SERVER_param('CLOWN_TOWN')\n#2 /var/www/html/crnrstn_v2/index.php(132): include_once('/var/www/html/c..')\n#3 {main}

        */

        //
        // CRNRSTN :: DEEP EMBRYONIC STATE.
        //$oCRNRSTN = $oCRNRSTN;

        //$init_profile_pack_ARRAY['sys_logging_profile_ARRAY'] = $array[crc32($this->config_serial)][CRNRSTN_LOG_ALL][];
        //$init_profile_pack_ARRAY['sys_logging_meta_ARRAY'] = $array[crc32($this->config_serial)][CRNRSTN_LOG_ALL][];
        //$init_profile_pack_ARRAY['sys_logging_wcr_ARRAY'] = $array[crc32($this->config_serial)][CRNRSTN_LOG_ALL][]

        $init_profile_pack_ARRAY = $this->oCRNRSTN->return_sys_logging_init_profile_pack();

        $this->oLog_ProfileManager = new crnrstn_logging_oprofile_manager($init_profile_pack_ARRAY, $this->oCRNRSTN);

        //error_log(__LINE__ .' log '.get_class().'::  init_profile_pack_ARRAY size='.print_r($init_profile_pack_ARRAY, true));
        //die();

        $this->oLog_ProfileManager->sync_to_environment($this->oCRNRSTN);

        //
        // DO WE NEED TO CALL THIS AFTER CONSTRUCTOR RECEIVES SAME ARRAY?
        $this->oLog_ProfileManager->consume_init_profile_pack($init_profile_pack_ARRAY);

        $tmp_exception_msg = $exception_obj->getMessage();
        $tmp_exception_linenum = $exception_obj->getLine();
        $tmp_exception_runtime = $this->oCRNRSTN->wall_time();
        $tmp_exception_systemtime = $this->oCRNRSTN->return_micro_time();

        $exception_method_trim = trim($exception_method);

        if(isset($exception_method_trim)){

            if($exception_method_trim == ''){

                $tmp_source_method = '';
                $tmp_exception_method = $exception_obj->getFile();
                $method = 'file';

            }else{

                $tmp_source_method = $exception_method_trim;
                $tmp_exception_method = $exception_method_trim . '()';
                $method = 'methd';

            }

        }else{

            $tmp_source_method = '';
            $tmp_exception_method = $exception_obj->getFile();
            $method = 'file';

        }

        $this->oCRNRSTN->error_log('[rtime ' . $tmp_exception_runtime . ' secs] [' . $method . ' ' . $tmp_exception_method . '] [lnum ' . $tmp_exception_linenum . '] ' . $tmp_exception_msg, __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

        $tmp_exception_output_str = $tmp_exception_systemtime . ' [rtime ' . $tmp_exception_runtime.' secs] [' . $method . ' ' . $tmp_exception_method . '] [lnum ' . $tmp_exception_linenum . '] ' . $tmp_exception_msg;

        switch($tmp_source_method){
            case 'crnrstn_soa_endpoint_request_manager::takeTheKingsHighway':

                $tmp_pos_SOAP_req = strpos($tmp_exception_msg,'a SOAP request '); //a SOAP request

                if($tmp_pos_SOAP_req !== false){

                    $tmp_array = array(
                        'CRNRSTN_PACKET_IS_ENCRYPTED'       => 'FALSE',
                        'CRNRSTN_SOAP_SVC_USERNAME'         => $_SESSION['CRNRSTN_SOAP_SVC_USERNAME'],
                        'SOAP_SERVICES_AUTH_STATUS'         => 'ACCESS DENIED',
                        'STATUS_CODE'                       => '406',
                        'STATUS_MESSAGE'                    => 'The CRNRSTN :: SOAP Services Layer understood the client request, but is unwilling to accept it due to the following reason. ' . $tmp_exception_output_str,
                        'ISERROR_CODE'                      => '406',
                        'ISERROR_MESSAGE'                   => '406 Not Acceptable.',
                        'DATE_RECEIVED_SOAP_REQUEST'        => $this->tmp_precise_timestamp,
                        'SERVER_NAME_SOAP_SERVER'           => $_SERVER['SERVER_NAME'],
                        'SERVER_ADDRESS_SOAP_SERVER'        => $_SERVER['SERVER_ADDR'],
                        'SOAP_OPERATION_RUNTIME_SECONDS'    => $tmp_exception_runtime,
                        'DATE_CREATED_SOAP_RESPONSE'        => $this->oCRNRSTN->return_micro_time(),
                        'SERVER_NAME_SOAP_CLIENT'           => $_SERVER['SERVER_NAME'],
                        'SERVER_ADDRESS_SOAP_CLIENT'        => $_SERVER['SERVER_ADDR']

                    );

                }else{

                    $tmp_array = array(
                        'CRNRSTN_PACKET_IS_ENCRYPTED'       => 'FALSE',
                        'CRNRSTN_SOAP_SVC_USERNAME'         => $_SESSION['CRNRSTN_SOAP_SVC_USERNAME'],
                        'SOAP_SERVICES_AUTH_STATUS'         => 'ACCESS DENIED',
                        'STATUS_CODE'                       => '406',
                        'STATUS_MESSAGE'                    => 'The CRNRSTN :: SOAP Services Layer understood the client request, but is unwilling to accept it due to the following reason. ' . $tmp_exception_output_str,
                        'ISERROR_CODE'                      => '406',
                        'ISERROR_MESSAGE'                   => '406 Not Acceptable.',
                        'DATE_RECEIVED_SOAP_REQUEST'        => $this->tmp_precise_timestamp,
                        'SERVER_NAME_SOAP_SERVER'           => $_SERVER['SERVER_NAME'],
                        'SERVER_ADDRESS_SOAP_SERVER'        => $_SERVER['SERVER_ADDR'],
                        'SOAP_OPERATION_RUNTIME_SECONDS'    => $tmp_exception_runtime,
                        'DATE_CREATED_SOAP_RESPONSE'        => $this->oCRNRSTN->return_micro_time(),
                        'SERVER_NAME_SOAP_CLIENT'           => $_SERVER['SERVER_NAME'],
                        'SERVER_ADDRESS_SOAP_CLIENT'        => $_SERVER['SERVER_ADDR']

                    );

                }

                return $tmp_array;

            break;
            default:

                //$tmp_exception_method = $exception_method . '()';
                //$method = 'methd';

            break;

        }

        $this->oLog_ProfileManager->notification_go($tmp_exception_output_str, $syslog_constant, $tmp_exception_method, $tmp_exception_runtime, $tmp_exception_systemtime, $exception_obj);

        return NULL;

    }

    public function __________catch_exception($exception_obj, $syslog_constant, $exception_method, $namespace, $profile_override_pipe, $endpoint_override_pipe, $wcr_override_pipe){

        /*
        # syslog()
        # SYSLOG priority is a combination of the facility and the level. Possible values
        # are (in descending order):
        # Constant		Description
        # LOG_EMERG		system is unusable.
        # LOG_ALERT		action must be taken immediately
        # LOG_CRIT		critical conditions
        # LOG_ERR		error conditions
        # LOG_WARNING	warning conditions
        # LOG_NOTICE	normal, but significant, condition
        # LOG_INFO		informational message
        # LOG_DEBUG		debug-level message

        Exception $e
        final public getMessage ( void ) : string
        final public getPrevious ( void ) : Throwable
        final public getCode ( void ) : mixed
        final public getFile ( void ) : string
        final public getLine ( void ) : int
        final public getTrace ( void ) : array
        final public getTraceAsString ( void ) : string
        public __toString ( void ) : string
        final private __clone ( void ) : void

        $this->error_log('121 - getMessage=' . $exception_obj->getMessage());
        $this->error_log('122 - getPrevious=' . $exception_obj->getPrevious());
        $this->error_log('123 - getCode=' . $exception_obj->getCode());
        $this->error_log('124 - getFile=' . $exception_obj->getFile());
        $this->error_log('125 - getLine=' . $exception_obj->getLine());
        $this->error_log('126 - getTraceAsString=' . $exception_obj->getTraceAsString());

        121 - getMessage=The requested _SERVER super global parameter [CLOWN_TOWN] cannot be found.
        122 - getPrevious=
        123 - getCode=0
        124 - getFile=/var/www/html/crnrstn_v2/_crnrstn/class/environment/crnrstn.environment.inc.php
        125 - getLine=403
        126 - getTraceAsString=#0 /var/www/html/crnrstn_v2/_crnrstn/class/user/crnrstn.user.inc.php(6063): crnrstn_environment->getServerArrayVar('CLOWN_TOWN', Object(crnrstn_user))\n#1 /var/www/html/crnrstn_v2/common/inc/footer/footer.inc.php(591): crnrstn_user->get_SERVER_param('CLOWN_TOWN')\n#2 /var/www/html/crnrstn_v2/index.php(132): include_once('/var/www/html/c..')\n#3 {main}

        */

        $tmp_class_name = get_class($oCRNRSTN);

        switch($tmp_class_name){
            case 'crnrstn':

                //
                // CRNRSTN :: DEEP EMBRYONIC STATE
                //$oCRNRSTN = $oCRNRSTN;

                //$init_profile_pack_ARRAY['sys_logging_profile_ARRAY'] = $array[crc32($this->config_serial)][CRNRSTN_LOG_ALL][];
                //$init_profile_pack_ARRAY['sys_logging_meta_ARRAY'] = $array[crc32($this->config_serial)][CRNRSTN_LOG_ALL][];
                //$init_profile_pack_ARRAY['sys_logging_wcr_ARRAY'] = $array[crc32($this->config_serial)][CRNRSTN_LOG_ALL][]

                $init_profile_pack_ARRAY = $oCRNRSTN->return_sys_logging_init_profile_pack();

                $this->oLog_ProfileManager = new crnrstn_logging_oprofile_manager($init_profile_pack_ARRAY, $this->oCRNRSTN);

                //error_log(__LINE__ .' log '.get_class().'::  init_profile_pack_ARRAY size='.print_r($init_profile_pack_ARRAY, true));
                //die();

                $this->oLog_ProfileManager->sync_to_environment($oCRNRSTN);

                // DO WE NEED TO CALL THIS AFTER CONSTRUCTOR RECEIVES SAME ARRAY?
                $this->oLog_ProfileManager->consume_init_profile_pack($init_profile_pack_ARRAY);

            break;
            case 'crnrstn_user':

//                $oCRNRSTN_ENV = $oCRNRSTN->return_oCRNRSTN_ENV();
//
//                //
//                // ALWAYS GET FRESH LOGGING PROFILE. CAN CHANGE BEFORE METHOD CALL...RIGHT?
//                $init_profile_pack_ARRAY = array();
//                $init_profile_pack_ARRAY['sys_logging_profile_ARRAY'] = $oCRNRSTN_ENV->return_sys_logging_profile();
//                $init_profile_pack_ARRAY['sys_logging_meta_ARRAY'] = $oCRNRSTN_ENV->return_sys_logging_meta();
//
//                if(isset($oCRNRSTN->oCRNRSTN_WCR_ARRAY[$oCRNRSTN->hash($oCRNRSTN->get_crnrstn('config_serial'))])){
//
//                    $init_profile_pack_ARRAY['sys_logging_wcr_ARRAY'] = $oCRNRSTN_ENV->oCRNRSTN_WCR_ARRAY[$oCRNRSTN_ENV->hash($oCRNRSTN->get_crnrstn('config_serial'))][CRNRSTN_LOG_ALL];
//
//                }
//
//                $this->oLog_ProfileManager = $oCRNRSTN->return_oLog_ProfileManager();
//
//                $this->oLog_ProfileManager->consume_init_profile_pack($init_profile_pack_ARRAY);

            break; // DO NOT BREAK.
            case 'crnrstn_environment':

//                //
//                // ALWAYS GET FRESH LOGGING PROFILE. CAN CHANGE BEFORE METHOD CALL...RIGHT?
//                $init_profile_pack_ARRAY = array();
//                $init_profile_pack_ARRAY['sys_logging_profile_ARRAY'] = $oCRNRSTN->return_sys_logging_profile();
//                $init_profile_pack_ARRAY['sys_logging_meta_ARRAY'] = $oCRNRSTN->return_sys_logging_meta();
//                //$init_profile_pack_ARRAY['sys_logging_wcr_ARRAY'] = $oCRNRSTN->oCRNRSTN_WCR_ARRAY[$oCRNRSTN->crcINT($oCRNRSTN->config_serial_crc)][CRNRSTN_LOG_ALL];
//
//                if(isset($oCRNRSTN->oCRNRSTN_WCR_ARRAY[$oCRNRSTN->hash($oCRNRSTN->get_crnrstn('config_serial'))])){
//
//                    $init_profile_pack_ARRAY['sys_logging_wcr_ARRAY'] = $oCRNRSTN->oCRNRSTN_WCR_ARRAY[$oCRNRSTN->hash($oCRNRSTN->get_crnrstn('config_serial'))][CRNRSTN_LOG_ALL];
//
//                }
//
//                $this->oLog_ProfileManager = $oCRNRSTN->return_oLog_ProfileManager();
//
////              error_log(__LINE__ .' log '.get_class().'::  pack + sys_logging_wcr_ARRAY='.print_r($init_profile_pack_ARRAY, true));
////              die();
//
//                $this->oLog_ProfileManager->consume_init_profile_pack($init_profile_pack_ARRAY);

                break;

            //
            // MATURE DEVELOPMENT
            default :


                break;

        }

        $tmp_exception_msg = $exception_obj->getMessage();
        $tmp_exception_linenum = $exception_obj->getLine();
        $tmp_exception_runtime = $oCRNRSTN->wall_time();
        $tmp_exception_systemtime = $oCRNRSTN->return_micro_time();

        $exception_method_trim = trim($exception_method);
        //error_log(__LINE__ .' my class in logger catch_exception is '.get_class($oCRNRSTN).' $exception_method_trim=' . $exception_method_trim.' $tmp_exception_msg=' . $tmp_exception_msg);

        if(isset($exception_method_trim)){

            if($exception_method_trim == ''){

                $tmp_source_method = '';
                $tmp_exception_method = $exception_obj->getFile();
                $method = 'file';

            }else{

                $tmp_source_method = $exception_method_trim;
                $tmp_exception_method = $exception_method_trim . '()';
                $method = 'methd';

            }

        }else{

            $tmp_source_method = '';
            $tmp_exception_method = $exception_obj->getFile();
            $method = 'file';

        }

        $oCRNRSTN->error_log('[rtime ' . $tmp_exception_runtime.' secs] [' . $method . ' ' . $tmp_exception_method . '] [lnum ' . $tmp_exception_linenum.'] ' . $tmp_exception_msg, __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

        $tmp_exception_output_str = $tmp_exception_systemtime.' [rtime ' . $tmp_exception_runtime.' secs] [' . $method . ' ' . $tmp_exception_method . '] [lnum ' . $tmp_exception_linenum.'] ' . $tmp_exception_msg;

        switch($tmp_source_method){
            case 'crnrstn_soa_endpoint_request_manager::takeTheKingsHighway':

                /*
                $http_status_codes = array(100 => 'Continue', 101 => 'Switching Protocols', 102 => 'Processing',
                200 => 'OK', 201 => 'Created', 202 => 'Accepted', 203 => 'Non-Authoritative Information',
                204 => 'No Content', 205 => 'Reset Content', 206 => 'Partial Content', 207 => 'Multi-Status',
                300 => 'Multiple Choices', 301 => 'Moved Permanently', 302 => 'Found', 303 => 'See Other',
                304 => 'Not Modified', 305 => 'Use Proxy', 306 => '(Unused)', 307 => 'Temporary Redirect',
                308 => 'Permanent Redirect', 400 => 'Bad Request', 401 => 'Unauthorized', 402 => 'Payment Required',
                403 => 'Forbidden', 404 => 'Not Found', 405 => 'Method Not Allowed', 406 => 'Not Acceptable',
                407 => 'Proxy Authentication Required', 408 => 'Request Timeout', 409 => 'Conflict', 410 => 'Gone',
                411 => 'Length Required', 412 => 'Precondition Failed', 413 => 'Request Entity Too Large',
                414 => 'Request-URI Too Long', 415 => 'Unsupported Media Type', 416 => 'Requested Range Not Satisfiable',
                417 => 'Expectation Failed', 418 => 'I\'m a teapot', 419 => 'Authentication Timeout',
                420 => 'Enhance Your Calm', 422 => 'Unprocessable Entity', 423 => 'Locked', 424 => 'Failed Dependency',
                424 => 'Method Failure', 425 => 'Unordered Collection', 426 => 'Upgrade Required', 428 => 'Precondition Required',
                429 => 'Too Many Requests', 431 => 'Request Header Fields Too Large', 444 => 'No Response', 449 => 'Retry With',
                450 => 'Blocked by Windows Parental Controls', 451 => 'Unavailable For Legal Reasons',
                494 => 'Request Header Too Large', 495 => 'Cert Error', 496 => 'No Cert', 497 => 'HTTP to HTTPS',
                499 => 'Client Closed Request', 500 => 'Internal Server Error', 501 => 'Not Implemented', 502 => 'Bad Gateway',
                503 => 'Service Unavailable', 504 => 'Gateway Timeout', 505 => 'HTTP Version Not Supported',
                506 => 'Variant Also Negotiates', 507 => 'Insufficient Storage', 508 => 'Loop Detected',
                509 => 'Bandwidth Limit Exceeded', 510 => 'Not Extended', 511 => 'Network Authentication Required',
                598 => 'Network read timeout error', 599 => 'Network connect timeout error');
                */

                $tmp_pos_SOAP_req = strpos($tmp_exception_msg,'a SOAP request '); //a SOAP request

                if($tmp_pos_SOAP_req !== false){

                    $tmp_array = array(
                        'CRNRSTN_PACKET_IS_ENCRYPTED' => 'FALSE',
                        'CRNRSTN_SOAP_SVC_USERNAME' => $_SESSION['CRNRSTN_SOAP_SVC_USERNAME'],
                        'SOAP_SERVICES_AUTH_STATUS' => 'ACCESS DENIED',
                        'STATUS_CODE' => '406',
                        'STATUS_MESSAGE' => 'The CRNRSTN :: SOAP Services Layer understood the client request, but is unwilling to accept it due to the following reason. ' . $tmp_exception_output_str,
                        'ISERROR_CODE' => '406',
                        'ISERROR_MESSAGE' => '406 Not Acceptable.',
                        'DATE_RECEIVED_SOAP_REQUEST' => $this->tmp_precise_timestamp,
                        'SERVER_NAME_SOAP_SERVER' => $_SERVER['SERVER_NAME'],
                        'SERVER_ADDRESS_SOAP_SERVER' => $_SERVER['SERVER_ADDR'],
                        'SOAP_OPERATION_RUNTIME_SECONDS' => $tmp_exception_runtime,
                        'DATE_CREATED_SOAP_RESPONSE' => $this->oCRNRSTN->return_micro_time(),
                        'SERVER_NAME_SOAP_CLIENT' => $_SERVER['SERVER_NAME'],
                        'SERVER_ADDRESS_SOAP_CLIENT' => $_SERVER['SERVER_ADDR']
                    );

                }else{

                    $tmp_array = array(
                        'CRNRSTN_PACKET_IS_ENCRYPTED' => 'FALSE',
                        'CRNRSTN_SOAP_SVC_USERNAME' => $_SESSION['CRNRSTN_SOAP_SVC_USERNAME'],
                        'SOAP_SERVICES_AUTH_STATUS' => 'ACCESS DENIED',
                        'STATUS_CODE' => '406',
                        'STATUS_MESSAGE' => 'The CRNRSTN :: SOAP Services Layer understood the client request, but is unwilling to accept it due to the following reason. ' . $tmp_exception_output_str,
                        'ISERROR_CODE' => '406',
                        'ISERROR_MESSAGE' => '406 Not Acceptable.',
                        'DATE_RECEIVED_SOAP_REQUEST' => $this->tmp_precise_timestamp,
                        'SERVER_NAME_SOAP_SERVER' => $_SERVER['SERVER_NAME'],
                        'SERVER_ADDRESS_SOAP_SERVER' => $_SERVER['SERVER_ADDR'],
                        'SOAP_OPERATION_RUNTIME_SECONDS' => $tmp_exception_runtime,
                        'DATE_CREATED_SOAP_RESPONSE' => $this->oCRNRSTN->return_micro_time(),
                        'SERVER_NAME_SOAP_CLIENT' => $_SERVER['SERVER_NAME'],
                        'SERVER_ADDRESS_SOAP_CLIENT' => $_SERVER['SERVER_ADDR']
                    );


                }

                return $tmp_array;

            break;
            default:

                //$tmp_exception_method = $exception_method . '()';
                //$method = 'methd';

            break;

        }

        $this->oLog_ProfileManager->notification_go($tmp_exception_output_str, $syslog_constant, $tmp_exception_method, $tmp_exception_runtime, $tmp_exception_systemtime, $exception_obj);

        return NULL;

    }

    public function error_log($str, $line_num, $method, $file, $log_silo_profile){

        //error_log(__LINE__ . ' log ' . __METHOD__ . ' $this->CRNRSTN_debug_mode=['  . $this->CRNRSTN_debug_mode . ']');
        switch($this->oCRNRSTN->get_crnrstn('CRNRSTN_debug_mode')){
            case CRNRSTN_DEBUG_NATIVE_ERR_LOG:

                if($this->log_silo_resource_authorized($log_silo_profile) !== false){
                //if(($this->oCRNRSTN->oCRNRSTN_BITFLIP_MGR->oCRNRSTN_BITWISE->read($log_silo_profile) || $this->oCRNRSTN->oCRNRSTN_BITFLIP_MGR->oCRNRSTN_BITWISE->read(CRNRSTN_LOG_ALL) && !$this->oCRNRSTN->oCRNRSTN_BITFLIP_MGR->oCRNRSTN_BITWISE->read(CRNRSTN_LOG_NONE))){
                //if((($this->oCRNRSTN->is_bit_set($log_silo_profile) == true) || ($this->oCRNRSTN->is_bit_set(CRNRSTN_LOG_ALL) == true) && !($this->oCRNRSTN->is_bit_set(CRNRSTN_LOG_NONE) == true))){

                    if($method != 'crnrstn_logging::catch_exception'){

                        $tmp_str = "[rtime " . $this->oCRNRSTN->wall_time() . ' secs]';

                        if(!isset($method) || $method==''){

                            if(isset($file)){

                                $tmp_str .= ' [file ' . $file . ']';

                            }

                        }else{

                            $tmp_str .= ' [methd ' . $method . ']';

                        }

                        if(isset($line_num)){

                            $tmp_str .= ' [lnum ' . $line_num . ']';

                        }

                        $tmp_str .= ' ' . $str;

                    }else{

                        $tmp_str = $str;

                    }

                    error_log($tmp_str);

                }

            break;
            case CRNRSTN_DEBUG_AGGREGATION_ON:

                //
                // LOG AGGREGATION WITHIN CRNRSTN + SILO SUPPORT.
                if($this->log_silo_resource_authorized($log_silo_profile) !== false){
                //if((($this->oCRNRSTN->is_bit_set($log_silo_profile) == true) || ($this->oCRNRSTN->is_bit_set(CRNRSTN_LOG_ALL) == true) && !($this->oCRNRSTN->is_bit_set(CRNRSTN_LOG_NONE) == true))){

                    $this->active_log_silo_flag_ARRAY[$log_silo_profile] = 1;
                    $tmp_oLog = new crnrstn_log($this->oCRNRSTN, $this->oCRNRSTN->get_micro_time(), $log_silo_profile);

                    $this->starttime = $this->oCRNRSTN->starttime;

                    $tmp_oLog->set_runTime($this->oCRNRSTN->wall_time());

                    $tmp_oLog->set_runFile($file);

                    $tmp_oLog->set_classMethod($method);

                    $tmp_oLog->set_lineNumber($line_num);

                    $tmp_str = $str . '';

                    $tmp_oLog->set_logMsg($tmp_str);

                    return $tmp_oLog;

                }

            break;
            case CRNRSTN_DEBUG_OFF:
            default:
                //SILENCE IS GOLDEN.
                //$CRNRSTN_debug_mode     [0] CRNRSTN_DEBUG_OFF

            break;

        }

        return NULL;

    }

    private function log_silo_resource_authorized($log_silo_profile){

        $tmp_profile_is_authorized = false;
        $tmp_is_log_none = false;
        $tmp_is_log_all = false;

        if($this->oCRNRSTN->isset_crnrstn('CRNRSTN_log_silo_profile') == true){

            $tmp_log_silo_ARRAY = $this->oCRNRSTN->get_crnrstn('CRNRSTN_log_silo_profile');

            foreach($tmp_log_silo_ARRAY as $silo_index => $tmp_silo_profile){

                switch($tmp_silo_profile){
                    case 'CRNRSTN_LOG_NONE':
                    case CRNRSTN_LOG_NONE:

                        $tmp_is_log_none = true;

                        //
                        // CRNRSTN_LOG_NONE CONFIGURATION SHUTS
                        // DOWN ALL CRNRSTN :: LOGGING OUTPUT.
                        //
                        // Wednesday, December 6, 2023 @ 0834 hrs.
                        break 1;

                    break;
                    case 'CRNRSTN_LOG_ALL':
                    case CRNRSTN_LOG_ALL:

                        $tmp_is_log_all = true;

                    break;

                }

                if($log_silo_profile == $tmp_silo_profile){

                    $tmp_profile_is_authorized = true;

                }

            }

        }

        if($tmp_is_log_none == false){

            if($tmp_profile_is_authorized == true || $tmp_is_log_all == true){

                return true;

            }

        }

        return $tmp_profile_is_authorized;

    }

    /*
    public function DELETED__captureNotice($logSource, $logPriority, $msg, $oLog_output_ARRAY=NULL){
		$tmp_priority = "UNKNOWN";
		$tmp_configserial = "";
		$tmp_key = "";

		//
		//error_log('839 - CRNRSTN_CONFIG_SERIALIZATION_HASH=' . $_SESSION['CRNRSTN_CONFIG_SERIALIZATION_HASH']);
		if(isset($_SESSION['CRNRSTN_CONFIG_SERIALIZATION_HASH'])){
			$tmp_key = $_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIALIZATION_HASH'])]['CRNRSTN_ENV_KEY_CRC'];
			$tmp_configserial = $_SESSION['CRNRSTN_CONFIG_SERIALIZATION_HASH'];

			switch($logPriority){
				case 0:
					$tmp_priority = "LOG_EMERG :: system is unusable.";
				break;
				case 1:
					$tmp_priority = "LOG_ALERT :: action must be taken immediately";
				break;
				case 2:
					$tmp_priority = "LOG_CRIT :: critical conditions encountered";
				break;
				case 3:
					$tmp_priority = "LOG_ERR :: error conditions encountered";
				break;
				case 4:
					$tmp_priority = "LOG_WARNING :: warning conditions encountered";
				break;
				case 5:
					$tmp_priority = "LOG_NOTICE :: normal, but significant, condition encountered";
				break;
				case 6:
					$tmp_priority = "LOG_INFO :: informational message";
				break;
				case 7:
					$tmp_priority = "LOG_DEBUG :: debug-level message";
				break;
				default:
					$tmp_priority = "UNKNOWN";
				break;
			}
		}

		if(isset($_SESSION["CRNRSTN_".crc32($tmp_configserial)]["CRNRSTN_".$tmp_key]["_CRNRSTN_LOG_PROFILE"])){
			switch($_SESSION["CRNRSTN_".crc32($tmp_configserial)]["CRNRSTN_".$tmp_key]["_CRNRSTN_LOG_PROFILE"]){
				case 'EMAIL':
					$tmp_email_ARRAY = explode(",", $_SESSION["CRNRSTN_".crc32($tmp_configserial)]["CRNRSTN_".$tmp_key]["_CRNRSTN_LOG_ENDPOINT"]);
					$this->emailDataElements['logSource'] = $logSource;
					$this->emailDataElements['logPriority'] = $tmp_priority;
					$this->emailDataElements['msg'] = $msg;

					foreach($tmp_email_ARRAY as $value){
						$this->emailDataElements['addAddressEmail'] = trim($value);

						if($this->buildSimpleMessage($oLog_output_ARRAY, $_SESSION["CRNRSTN_".crc32($tmp_configserial)]["CRNRSTN_".$tmp_key]["_CRNRSTN_LOG_PROFILE"], $logSource)){
							$this->msg_delivery_status = $this->sendSimpleMessage();
						}

						switch($this->msg_delivery_status){
							case 'success':

								//
								// GOOD JOB

							break;
							default:

								//
								// ERROR SENDING EMAIL. LOG TO DEFAULT SYS.
								error_log('Email send to ' . $this->emailDataElements['addAddressEmail'].' :: FAIL. Email output dump-> Src: ' . $this->emailDataElements['logSource'].'|| Priority: ' . $this->emailDataElements['logPriority'].'|| Msg: ' . $this->emailDataElements['msg']);

                        break;

						}

						unset($this->msg_delivery_status);

					}

				break;
                case 'SCREEN':
				case 'SCREEN_HTML':
					print "<br><div style=\"font-family: Arial,Helvetica,sans-serif; font-size: 11px; font-weight: bold;\">".$this->getmicrotime()." secs<br>";
					print $logSource;
					print "<br>";
					print $tmp_priority;
					print "<br>";
					print $msg;
                    $tmp_log_output_ARRAY = $this->compile_log_output($oLog_output_ARRAY, 'SCREEN_HTML', $logSource);
                    print "</div>";
				break;
                case 'SCREEN_HTML_HIDDEN':
                    print "<!--
                    [".$this->getmicrotime()." secs]
";
                    print $logSource;
                    print "
";
                    print $tmp_priority;
                    print "
";
                    print $msg;
                    $tmp_log_output_ARRAY = $this->compile_log_output($oLog_output_ARRAY, 'SCREEN_HTML_HIDDEN',$logSource);

                break;
                case 'SCREEN_TEXT':
                    print '[' . $this->getmicrotime()." secs]
";
                    print $logSource;
                    print "
";
                    print $tmp_priority;
                    print "
";
                    print $msg;
                    $tmp_log_output_ARRAY = $this->compile_log_output($oLog_output_ARRAY, 'SCREEN_TEXT', $logSource);

                break;
                case 'FILE':
                    if(isset($oLog_output_ARRAY)){

                        $tmp_log_output_ARRAY = $this->compile_log_output($oLog_output_ARRAY, 'FILE', $logSource);

                    }

					$tmp_file_path = $_SESSION["CRNRSTN_".crc32($tmp_configserial)]["CRNRSTN_".$tmp_key]["_CRNRSTN_LOG_ENDPOINT"];

					//
					// YOU CAN CUSTOMIZE THE FORMAT OF THIS LOGGING OUTPUT
					$logDataToWrite = $this->getmicrotime().' [rtime ' . $this->wall_time().']'.' [methd ' . $logSource.'] [priority ' . $tmp_priority.'] ' . $msg.'
';

					$fp = fopen($tmp_file_path, 'a');
					fwrite($fp, $logDataToWrite);
					fclose($fp);

                break;
				default:

                    $tmp_log_output_ARRAY = $this->compile_log_output($oLog_output_ARRAY, 'DEFAULT', $logSource);
                    error_log('[rtime ' . $this->wall_time().']'.' [owner ' . $this->objectOwner_key.']'.' [methd ' . $logSource.'] [priority ' . $tmp_priority.'] ' . $msg);

                break;
			}

		}else{

			//
			// PROBABLY CRNRSTN INITIALIZATION ERROR. JUST LOG.
            $tmp_log_output_ARRAY = $this->compile_log_output($oLog_output_ARRAY, 'DEFAULT', $logSource);
            error_log('[rtime ' . $this->wall_time().'] [owner ' . $this->objectOwner_key.']'.' [methd ' . $logSource.'] [priority ' . $tmp_priority.'] ' . $msg);

		}

		return true;

	}
*/

    private function return_requestSourceStr($line_num, $method, $file, $logSource){

        $str = '';

        if(isset($logSource) && $logSource!=''){

            $str .= $logSource;

        }else{

            # class::method at line ###
            # line ### within /filepath/

            if(isset($method) && $method!=''){

                $str .= '[methd ' . $method . ']';

                if(isset($line_num) && $line_num!=''){

                    $str .= ' at [lnum ' . $line_num.']';

                }else{

                    if(isset($file) && $file!=''){

                        $str .= ' within the [file ' . $file.']';

                    }

                }

            }else{

                if(isset($file) && $file!=''){

                    if(isset($line_num) && $line_num!=''){

                        $str .= '[lnum ' . $line_num.'] within the [file ' . $file.']';

                    }else{

                        $str .= 'The [file ' . $file.']';

                    }

                }else{

                    if(isset($line_num) && $line_num!=''){

                        $str .= '[lnum ' . $line_num.'] of an unknown script on server ' . $_SERVER['SERVER_NAME'].' (' . $_SERVER['SERVER_ADDR'].')';

                    }else{

                        $str .= '[lnum xxx] An unknown script source on server ' . $_SERVER['SERVER_NAME'].' (' . $_SERVER['SERVER_ADDR'].').';

                    }

                }

            }

        }

        return $str;

    }

    private function return_auth_oLog($full_out, $silo_auth_ARRAY, $silo_negation_ARRAY, $oCRNRSTN_USR){

        $oLog_possible_output_ARRAY = $oCRNRSTN_USR->oLog_output_ARRAY;
        $tmp_silo_neg_cnt = sizeof($silo_negation_ARRAY);

        if(($full_out || $silo_auth_ARRAY==NULL) && $tmp_silo_neg_cnt == 0){

            $tmp_oLog_authorized_ARRAY = $oLog_possible_output_ARRAY;

        }else{

            $tmp_oLog_authorized_ARRAY = array();
            $tmp_oLog_cnt = sizeof($oLog_possible_output_ARRAY);

            for($i = 0; $i < $tmp_oLog_cnt; $i++){

                $tmp_oLog = $oLog_possible_output_ARRAY[$i];

                if(is_object($tmp_oLog)){

                    $tmp_oLog_silo_key = $tmp_oLog->return_silo_profile_array();

                    error_log(__LINE__ . ' logging $tmp_oLog_silo_key[' . print_r($tmp_oLog_silo_key, true) . '].');

                    if((isset($tmp_silo_auth_ARRAY[$tmp_oLog_silo_key]) || $full_out) && !isset($silo_negation_ARRAY[$tmp_oLog_silo_key])){

                        $ttl = -1;
                        $tmp_oLog->expireLogData($oCRNRSTN_USR, $ttl);
                        $tmp_oLog_authorized_ARRAY[] = $tmp_oLog;

                    }

                }

            }

        }

        return $tmp_oLog_authorized_ARRAY;

    }

    private function prepare_oLogOut($channel, $log_silo_profiles_pipe, $line_num, $method, $file, $logSource, $oLog_output_ARRAY, $oCRNRSTN_USR){

        $tmp_request_source = $this->return_requestSourceStr($line_num, $method, $file, $logSource);

        if(isset($oLog_output_ARRAY)){

            $tmp_auth_oLog_ARRAY = $oLog_output_ARRAY;

        }else{

            error_log(__LINE__ . ' '. __METHOD__ . ' log.inc.php die() go to integer constant arch.');
            die();

            $tmp_silo_negation_ARRAY = array();
            $tmp_silo_ARRAY = explode('|', $log_silo_profiles_pipe);
            $tmp_authorized_silo_cnt = sizeof($tmp_silo_ARRAY);

            if(in_array('*', $tmp_silo_ARRAY) || ($tmp_authorized_silo_cnt == 1 && $tmp_silo_ARRAY[0] == '') || $tmp_authorized_silo_cnt == 0){

                //
                // OUTPUT ALL oLog
                $tmp_full_out = true;
                $tmp_silo_auth_ARRAY = NULL;

            }else{

                $tmp_full_out = false;

                //
                // LOOK TO OUTPUT SUBSET OF SILO DATA
                for($i=0; $i<$tmp_authorized_silo_cnt; $i++){

                    //
                    // CHECK FOR NOT
                    $pos_silo_tilde = strpos($tmp_silo_ARRAY[$i], '~');

                    if($pos_silo_tilde !== false){

                        //
                        // HONOR THE NEGATION
                        // STRIP ~ AND TRIM
                        $tmp_clean_silo_negation = $this->proper_replace('~', '', $tmp_silo_ARRAY[$i]);
                        $tmp_clean_silo_negation = trim($tmp_clean_silo_negation);
                        $tmp_silo_negation_ARRAY[$tmp_clean_silo_negation] = 1;

                    }else{

                        //
                        // HONOR THE EXCLUSIVE INCLUSION
                        $tmp_silo_auth_ARRAY[$tmp_silo_ARRAY[$i]] = 1;

                    }

                }

            }

            $tmp_auth_oLog_ARRAY = $this->return_auth_oLog($tmp_full_out, $tmp_silo_auth_ARRAY, $tmp_silo_negation_ARRAY, $oCRNRSTN_USR);

        }

        switch($channel){
            case CRNRSTN_LOG_EMAIL:
            case CRNRSTN_LOG_EMAIL_PROXY:

                $tmp_log_to_email_array = array();
                $tmp_log_to_email_array['text'] = '';
                $tmp_log_to_email_array['text'] .= 'BEGIN LOG OUTPUT OF ACTIVITY FROM REQUESTING SOURCE :: ' . $tmp_request_source.'
';
                $tmp_log_to_email_array['html'] = '';
                $tmp_log_to_email_array['html'] .= 'BEGIN LOG OUTPUT OF ACTIVITY FROM REQUESTING SOURCE :: ' . $tmp_request_source.'<br>';

                $tmp_log_cnt = sizeof($tmp_auth_oLog_ARRAY);
                for($i=0; $i<$tmp_log_cnt; $i++){

                    $tmp_oLog = $tmp_auth_oLog_ARRAY[$i];

                    if(is_object($tmp_oLog)){

                        //
                        // WE HAVE A VALID LOG FOR WHICH TO PREPARE OUTPUT
                        //$tmp_silo_key = $tmp_oLog->return_silo_profile_array();
                        $tmp_transactionTime = $tmp_oLog->get_transactionTime();
                        $tmp_runTime = $tmp_oLog->get_runTime();

                        $tmp_runFile_raw = $tmp_oLog->get_runFile();
                        $tmp_classMethod_raw = $tmp_oLog->get_classMethod();
                        $tmp_lineNumber_raw = $tmp_oLog->get_lineNumber();
                        $tmp_logMsg_raw = $tmp_oLog->get_logMsg();

                        $tmp_transactionTime_ARRAY = array();
                        $tmp_runTime_ARRAY = array();
                        $tmp_classMethodFile_ARRAY = array();
                        $tmp_lineNumber_ARRAY = array();
                        $tmp_logMsg_ARRAY = array();

                        $tmp_transactionTime_ARRAY['text'] = $tmp_transactionTime;
                        $tmp_transactionTime_ARRAY['html'] = $tmp_transactionTime;

                        $tmp_runTime_ARRAY['text'] = ' [rtime ' . $tmp_runTime.']';
                        $tmp_runTime_ARRAY['html'] = ' [rtime ' . $tmp_runTime.']';

                        if(isset($tmp_classMethod_raw)){
                            if($tmp_classMethod_raw != ''){

                                $tmp_classMethodFile_ARRAY['text'] = ' [methd ' . $tmp_classMethod_raw.']';
                                $tmp_classMethodFile_ARRAY['html'] = ' [methd ' . $tmp_classMethod_raw.']';

                            }else{

                                if(isset($tmp_runFile_raw)){
                                    if($tmp_runFile_raw != ''){

                                        $tmp_classMethodFile_ARRAY['text'] = ' [file ' . $tmp_runFile_raw.']';
                                        $tmp_classMethodFile_ARRAY['html'] = ' [file ' . $tmp_runFile_raw.']';

                                    }else{

                                        $tmp_classMethodFile_ARRAY['text'] = '';
                                        $tmp_classMethodFile_ARRAY['html'] = '';

                                    }

                                }else{

                                    $tmp_classMethodFile_ARRAY['text'] = '';
                                    $tmp_classMethodFile_ARRAY['html'] = '';

                                }

                            }

                        }else{

                            if(isset($tmp_runFile_raw)){
                                if($tmp_runFile_raw != ''){

                                    $tmp_classMethodFile_ARRAY['text'] = ' [file ' . $tmp_runFile_raw.']';
                                    $tmp_classMethodFile_ARRAY['html'] = ' [file ' . $tmp_runFile_raw.']';

                                }else{

                                    $tmp_classMethodFile_ARRAY['text'] = '';
                                    $tmp_classMethodFile_ARRAY['html'] = '';

                                }

                            }else{

                                $tmp_classMethodFile_ARRAY['text'] = '';
                                $tmp_classMethodFile_ARRAY['html'] = '';

                            }

                        }

                        if(isset($tmp_lineNumber_raw)){

                            if($tmp_lineNumber_raw != ''){

                                $tmp_lineNumber_ARRAY['text'] = ' [lnum ' . $tmp_lineNumber_raw.']';
                                $tmp_lineNumber_ARRAY['html'] = ' [lnum ' . $tmp_lineNumber_raw.']';

                            }else{

                                $tmp_lineNumber_ARRAY['text'] = '';
                                $tmp_lineNumber_ARRAY['html'] = '';

                            }

                        }else{

                            $tmp_lineNumber_ARRAY['text'] = '';
                            $tmp_lineNumber_ARRAY['html'] = '';

                        }

                        if(isset($tmp_logMsg_raw)){

                            $tmp_logMsg_ARRAY['text'] = ' ' . $tmp_logMsg_raw.'
';
                            $tmp_logMsg_ARRAY['html'] = ' ' . $tmp_logMsg_raw.'<br>';

                        }else{

                            $tmp_logMsg_ARRAY['text'] = '
';
                            $tmp_logMsg_ARRAY['html'] = '<br>';

                        }

                        $tmp_log_to_email_array['text'] .= $tmp_transactionTime_ARRAY['text'].
                            $tmp_runTime_ARRAY['text'].
                            $tmp_classMethodFile_ARRAY['text'].
                            $tmp_lineNumber_ARRAY['text'].
                            $tmp_logMsg_ARRAY['text'];

                        $tmp_log_to_email_array['html'] .= '<span style="font-family: Arial,Helvetica,sans-serif; font-size: 11px; padding-left:10px;">'.
                            $tmp_transactionTime_ARRAY['html'].
                            $tmp_runTime_ARRAY['html'].
                            $tmp_classMethodFile_ARRAY['html'].
                            $tmp_lineNumber_ARRAY['html'].
                            $tmp_logMsg_ARRAY['html'].'</span>';

                    }
                }

                $tmp_log_to_email_array['text'] .= 'END LOG OUTPUT OF ACTIVITY FROM [' . $channel . '] REQUESTING SOURCE :: ' . $tmp_request_source.'
';
                $tmp_log_to_email_array['html'] .= 'END LOG OUTPUT OF ACTIVITY FROM [' . $channel . '] REQUESTING SOURCE :: ' . $tmp_request_source.'<br>';

                return $tmp_log_to_email_array;

            break;
            case CRNRSTN_LOG_FILE:
            case CRNRSTN_CHANNEL_FILE:

                $tmp_log_to_errorlog_array = array();
                $tmp_log_to_errorlog_array['text'] = 'BEGIN LOG OUTPUT OF ACTIVITY FROM [' . $channel . '] REQUESTING SOURCE :: ' . $tmp_request_source.'
';

                $tmp_log_cnt = sizeof($tmp_auth_oLog_ARRAY);

                for($i=0; $i<$tmp_log_cnt; $i++){

                    $tmp_oLog = $tmp_auth_oLog_ARRAY[$i];

                    if(is_object($tmp_oLog)){

                        //
                        // WE HAVE A VALID LOG FOR WHICH TO PREPARE OUTPUT
                        //$tmp_silo_key = $tmp_oLog->return_silo_profile_array();
                        $tmp_transactionTime = $tmp_oLog->get_transactionTime();
                        $tmp_runTime = $tmp_oLog->get_runTime();

                        $tmp_runFile_raw = $tmp_oLog->get_runFile();
                        $tmp_classMethod_raw = $tmp_oLog->get_classMethod();
                        $tmp_lineNumber_raw = $tmp_oLog->get_lineNumber();
                        $tmp_logMsg_raw = $tmp_oLog->get_logMsg();

                        $tmp_transactionTime_ARRAY = array();
                        $tmp_runTime_ARRAY = array();
                        $tmp_classMethodFile_ARRAY = array();
                        $tmp_lineNumber_ARRAY = array();
                        $tmp_logMsg_ARRAY = array();

                        $tmp_transactionTime_ARRAY['text'] = $tmp_transactionTime;

                        $tmp_runTime_ARRAY['text'] = ' [rtime ' . $tmp_runTime.']';

                        if(isset($tmp_classMethod_raw)){

                            if($tmp_classMethod_raw != ''){

                                $tmp_classMethodFile_ARRAY['text'] = ' [methd ' . $tmp_classMethod_raw.']';

                            }else{

                                if(isset($tmp_runFile_raw)){

                                    if($tmp_runFile_raw != ''){

                                        $tmp_classMethodFile_ARRAY['text'] = ' [file ' . $tmp_runFile_raw.']';

                                    }else{

                                        $tmp_classMethodFile_ARRAY['text'] = '';

                                    }

                                }else{

                                    $tmp_classMethodFile_ARRAY['text'] = '';

                                }

                            }

                        }else{

                            if(isset($tmp_runFile_raw)){

                                if($tmp_runFile_raw != ''){

                                    $tmp_classMethodFile_ARRAY['text'] = ' [file ' . $tmp_runFile_raw.']';

                                }else{

                                    $tmp_classMethodFile_ARRAY['text'] = '';

                                }

                            }else{

                                $tmp_classMethodFile_ARRAY['text'] = '';

                            }

                        }

                        if(isset($tmp_lineNumber_raw)){

                            if($tmp_lineNumber_raw != ''){

                                $tmp_lineNumber_ARRAY['text'] = ' [lnum ' . $tmp_lineNumber_raw.']';

                            }else{

                                $tmp_lineNumber_ARRAY['text'] = '';

                            }

                        }else{

                            $tmp_lineNumber_ARRAY['text'] = '';

                        }

                        if(isset($tmp_logMsg_raw)){

                            $tmp_logMsg_ARRAY['text'] = ' ' . $tmp_logMsg_raw.'
';

                        }else{

                            $tmp_logMsg_ARRAY['text'] = '
';

                        }

                        $tmp_log_to_errorlog_array['text'] .= $tmp_transactionTime_ARRAY['text'].
                            $tmp_runTime_ARRAY['text'].
                            $tmp_classMethodFile_ARRAY['text'].
                            $tmp_lineNumber_ARRAY['text'].
                            $tmp_logMsg_ARRAY['text'];

                    }

                }

                $tmp_log_to_errorlog_array['text'] .= 'END LOG OUTPUT OF ACTIVITY FROM [' . $channel . '] REQUESTING SOURCE :: ' . $tmp_request_source.'
';

                return $tmp_log_to_errorlog_array;

            break;
            case CRNRSTN_LOG_SCREEN_TEXT:

                $tmp_log_to_errorlog_array = array();
                $tmp_log_to_errorlog_array['text'] = '';
                $tmp_log_to_errorlog_array['text'] .= 'BEGIN LOG OUTPUT OF ACTIVITY FROM [' . $channel . '] REQUESTING SOURCE :: ' . $tmp_request_source.'
';

                $tmp_log_cnt = sizeof($tmp_auth_oLog_ARRAY);
                for($i=0; $i<$tmp_log_cnt; $i++){

                    $tmp_oLog = $tmp_auth_oLog_ARRAY[$i];

                    if(is_object($tmp_oLog)){
                        //
                        // WE HAVE A VALID LOG FOR WHICH TO PREPARE OUTPUT
                        //$tmp_silo_key = $tmp_oLog->return_silo_profile_array();
                        $tmp_transactionTime = $tmp_oLog->get_transactionTime();
                        $tmp_runTime = $tmp_oLog->get_runTime();

                        $tmp_runFile_raw = $tmp_oLog->get_runFile();
                        $tmp_classMethod_raw = $tmp_oLog->get_classMethod();
                        $tmp_lineNumber_raw = $tmp_oLog->get_lineNumber();
                        $tmp_logMsg_raw = $tmp_oLog->get_logMsg();

                        $tmp_transactionTime_ARRAY = array();
                        $tmp_runTime_ARRAY = array();
                        $tmp_classMethodFile_ARRAY = array();
                        $tmp_lineNumber_ARRAY = array();
                        $tmp_logMsg_ARRAY = array();

                        $tmp_transactionTime_ARRAY['text'] = $tmp_transactionTime;

                        $tmp_runTime_ARRAY['text'] = ' [rtime ' . $tmp_runTime.']';

                        if(isset($tmp_classMethod_raw)){

                            if($tmp_classMethod_raw != ''){

                                $tmp_classMethodFile_ARRAY['text'] = ' [methd ' . $tmp_classMethod_raw.']';

                            }else{

                                if(isset($tmp_runFile_raw)){
                                    if($tmp_runFile_raw != ''){

                                        $tmp_classMethodFile_ARRAY['text'] = ' [file ' . $tmp_runFile_raw.']';

                                    }else{

                                        $tmp_classMethodFile_ARRAY['text'] = '';

                                    }

                                }else{

                                    $tmp_classMethodFile_ARRAY['text'] = '';

                                }
                            }

                        }else{

                            if(isset($tmp_runFile_raw)){

                                if($tmp_runFile_raw != ''){

                                    $tmp_classMethodFile_ARRAY['text'] = ' [file ' . $tmp_runFile_raw.']';

                                }else{

                                    $tmp_classMethodFile_ARRAY['text'] = '';

                                }

                            }else{

                                $tmp_classMethodFile_ARRAY['text'] = '';

                            }

                        }

                        if(isset($tmp_lineNumber_raw)){

                            if($tmp_lineNumber_raw != ''){

                                $tmp_lineNumber_ARRAY['text'] = ' [lnum ' . $tmp_lineNumber_raw.']';

                            }else{

                                $tmp_lineNumber_ARRAY['text'] = '';

                            }

                        }else{

                            $tmp_lineNumber_ARRAY['text'] = '';

                        }

                        if(isset($tmp_logMsg_raw)){

                            $tmp_logMsg_ARRAY['text'] = ' ' . $tmp_logMsg_raw.'
';

                        }else{

                            $tmp_logMsg_ARRAY['text'] = '
';

                        }

                        $tmp_log_to_errorlog_array['text'] .= $tmp_transactionTime_ARRAY['text'].
                            $tmp_runTime_ARRAY['text'].
                            $tmp_classMethodFile_ARRAY['text'].
                            $tmp_lineNumber_ARRAY['text'].
                            $tmp_logMsg_ARRAY['text'];

                    }
                }

                $tmp_log_to_errorlog_array['text'] .= 'END LOG OUTPUT OF ACTIVITY FROM [' . $channel . '] REQUESTING SOURCE :: ' . $tmp_request_source.'
';

                return $tmp_log_to_errorlog_array;

            break;
            case CRNRSTN_LOG_SCREEN:
            case CRNRSTN_LOG_SCREEN_HTML:

                $tmp_log_to_screen_array = array();
                $tmp_log_to_screen_array['html'] = '';
                $tmp_log_to_screen_array['html'] .= '<div style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bold; padding:10px 0 0 5px; line-height: 15px;">BEGIN LOG OUTPUT OF ACTIVITY FROM REQUESTING SOURCE :: ' . $tmp_request_source.'</div>';
                $tmp_log_cnt = sizeof($tmp_auth_oLog_ARRAY);

                for($i=0; $i<$tmp_log_cnt; $i++){

                    $tmp_oLog = $tmp_auth_oLog_ARRAY[$i];

                    if(is_object($tmp_oLog)){

                        //
                        // WE HAVE A VALID LOG FOR WHICH TO PREPARE OUTPUT
                        //$tmp_silo_key = $tmp_oLog->return_silo_profile_array();
                        $tmp_transactionTime = $tmp_oLog->get_transactionTime();
                        $tmp_runTime = $tmp_oLog->get_runTime();

                        $tmp_runFile_raw = $tmp_oLog->get_runFile();
                        $tmp_classMethod_raw = $tmp_oLog->get_classMethod();
                        $tmp_lineNumber_raw = $tmp_oLog->get_lineNumber();
                        $tmp_logMsg_raw = $tmp_oLog->get_logMsg();

                        $tmp_transactionTime_ARRAY = array();
                        $tmp_runTime_ARRAY = array();
                        $tmp_classMethodFile_ARRAY = array();
                        $tmp_lineNumber_ARRAY = array();
                        $tmp_logMsg_ARRAY = array();

                        $tmp_transactionTime_ARRAY['html'] = $tmp_transactionTime;

                        $tmp_runTime_ARRAY['html'] = ' [rtime ' . $tmp_runTime.']';

                        if(isset($tmp_classMethod_raw)){

                            if($tmp_classMethod_raw != ''){

                                $tmp_classMethodFile_ARRAY['html'] = ' [methd ' . $tmp_classMethod_raw . ']';

                            }else{

                                if(isset($tmp_runFile_raw)){

                                    if($tmp_runFile_raw != ''){

                                        $tmp_classMethodFile_ARRAY['html'] = ' [file ' . $tmp_runFile_raw . ']';

                                    }else{

                                        $tmp_classMethodFile_ARRAY['html'] = '';

                                    }

                                }else{

                                    $tmp_classMethodFile_ARRAY['html'] = '';

                                }

                            }

                        }else{

                            if(isset($tmp_runFile_raw)){

                                if($tmp_runFile_raw != ''){

                                    $tmp_classMethodFile_ARRAY['html'] = ' [file ' . $tmp_runFile_raw . ']';

                                }else{

                                    $tmp_classMethodFile_ARRAY['html'] = '';

                                }

                            }else{

                                $tmp_classMethodFile_ARRAY['html'] = '';

                            }

                        }

                        if(isset($tmp_lineNumber_raw)){

                            if($tmp_lineNumber_raw != ''){

                                $tmp_lineNumber_ARRAY['html'] = ' [lnum ' . $tmp_lineNumber_raw . ']';

                            }else{

                                $tmp_lineNumber_ARRAY['html'] = '';

                            }

                        }else{

                            $tmp_lineNumber_ARRAY['html'] = '';

                        }

                        if(isset($tmp_logMsg_raw)){

                            $tmp_logMsg_ARRAY['html'] = ' ' . $tmp_logMsg_raw . '<br>';

                        }else{

                            $tmp_logMsg_ARRAY['html'] = '<br>';

                        }

                        $tmp_log_to_screen_array['html'] .= '<div style="font-family: Arial,Helvetica,sans-serif; font-size: 11px; padding-left:10px; line-height: 17px;">' .
                            $tmp_transactionTime_ARRAY['html'] .
                            $tmp_runTime_ARRAY['html'] .
                            $tmp_classMethodFile_ARRAY['html'] .
                            $tmp_lineNumber_ARRAY['html'] .
                            $tmp_logMsg_ARRAY['html'] . '</div>';

                    }
                }

                $tmp_log_to_screen_array['html'] .= '<div style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bold; padding:0 0 5px 5px; line-height: 15px;">END LOG OUTPUT OF ACTIVITY FROM [' . $channel . '] REQUESTING SOURCE :: ' . $tmp_request_source . '</div>';
                return $tmp_log_to_screen_array;

            break;
            case CRNRSTN_LOG_SCREEN_HTML_HIDDEN:

                $tmp_log_to_html_hidden_array = array();
                $tmp_log_to_html_hidden_array['text'] = '';
                $tmp_log_to_html_hidden_array['text'] .= 'BEGIN LOG OUTPUT OF ACTIVITY FROM [' . $channel . '] REQUESTING SOURCE :: ' . $tmp_request_source . '
';

                $tmp_log_cnt = sizeof($tmp_auth_oLog_ARRAY);
                for($i = 0; $i < $tmp_log_cnt; $i++){

                    $tmp_oLog = $tmp_auth_oLog_ARRAY[$i];

                    if(is_object($tmp_oLog)){

                        //
                        // WE HAVE A VALID LOG FOR WHICH TO PREPARE OUTPUT
                        //$tmp_silo_key = $tmp_oLog->return_silo_profile_array();
                        $tmp_transactionTime = $tmp_oLog->get_transactionTime();
                        $tmp_runTime = $tmp_oLog->get_runTime();

                        $tmp_runFile_raw = $tmp_oLog->get_runFile();
                        $tmp_classMethod_raw = $tmp_oLog->get_classMethod();
                        $tmp_lineNumber_raw = $tmp_oLog->get_lineNumber();
                        $tmp_logMsg_raw = $tmp_oLog->get_logMsg();

                        $tmp_transactionTime_ARRAY = array();
                        $tmp_runTime_ARRAY = array();
                        $tmp_classMethodFile_ARRAY = array();
                        $tmp_lineNumber_ARRAY = array();
                        $tmp_logMsg_ARRAY = array();

                        $tmp_transactionTime_ARRAY['text'] = $tmp_transactionTime;

                        $tmp_runTime_ARRAY['text'] = ' [rtime ' . $tmp_runTime . ']';

                        if(isset($tmp_classMethod_raw)){
                            if($tmp_classMethod_raw != ''){

                                $tmp_classMethodFile_ARRAY['text'] = ' [methd ' . $tmp_classMethod_raw . ']';

                            }else{

                                if(isset($tmp_runFile_raw)){

                                    if($tmp_runFile_raw != ''){

                                        $tmp_classMethodFile_ARRAY['text'] = ' [file ' . $tmp_runFile_raw . ']';

                                    }else{

                                        $tmp_classMethodFile_ARRAY['text'] = '';

                                    }

                                }else{

                                    $tmp_classMethodFile_ARRAY['text'] = '';

                                }

                            }

                        }else{

                            if(isset($tmp_runFile_raw)){
                                if($tmp_runFile_raw != ''){

                                    $tmp_classMethodFile_ARRAY['text'] = ' [file ' . $tmp_runFile_raw . ']';

                                }else{

                                    $tmp_classMethodFile_ARRAY['text'] = '';

                                }

                            }else{

                                $tmp_classMethodFile_ARRAY['text'] = '';

                            }

                        }

                        if(isset($tmp_lineNumber_raw)){

                            if($tmp_lineNumber_raw != ''){

                                $tmp_lineNumber_ARRAY['text'] = ' [lnum ' . $tmp_lineNumber_raw . ']';

                            }else{

                                $tmp_lineNumber_ARRAY['text'] = '';

                            }
                        }else{

                            $tmp_lineNumber_ARRAY['text'] = '';

                        }

                        if(isset($tmp_logMsg_raw)){

                            $tmp_logMsg_ARRAY['text'] = ' ' . $tmp_logMsg_raw . '
';

                        }else{

                            $tmp_logMsg_ARRAY['text'] = '
';

                        }

                        $tmp_log_to_html_hidden_array['text'] .= $tmp_transactionTime_ARRAY['text'] .
                            $tmp_runTime_ARRAY['text'] .
                            $tmp_classMethodFile_ARRAY['text'] .
                            $tmp_lineNumber_ARRAY['text'] .
                            $tmp_logMsg_ARRAY['text'];

                    }

                }

                $tmp_log_to_html_hidden_array['text'] .= 'END LOG OUTPUT OF ACTIVITY FROM [' . $channel . '] REQUESTING SOURCE :: ' . $tmp_request_source . '
';

                return $tmp_log_to_html_hidden_array;

            break;
            //case CRNRSTN_CHANNEL_GET:
            //case CRNRSTN_CHANNEL_POST:
            //case CRNRSTN_CHANNEL_COOKIE:
            //case CRNRSTN_CHANNEL_SESSION:
            case CRNRSTN_CHANNEL_DATABASE:
            case CRNRSTN_CHANNEL_SSDTLA:
            case CRNRSTN_CHANNEL_PSSDTLA:
            case CRNRSTN_CHANNEL_RUNTIME:
            case CRNRSTN_CHANNEL_SOAP:
            //case CRNRSTN_CHANNEL_ALL:
            //case CRNRSTN_CHANNEL_FORM:
            default:

                //
                // DEFAULT
                $tmp_log_cnt = sizeof($tmp_auth_oLog_ARRAY);
                if($tmp_log_cnt < 1){

                    return NULL;

                }

                $tmp_log_to_errorlog_array = array();
                $tmp_log_to_errorlog_array['text'] = '';
                $tmp_log_to_errorlog_array['text'] .= 'BEGIN LOG OUTPUT OF ACTIVITY FROM [' . $channel . '] REQUESTING SOURCE :: ' . $tmp_request_source . '
';

                $tmp_log_cnt = sizeof($tmp_auth_oLog_ARRAY);
                for($i = 0; $i < $tmp_log_cnt; $i++){

                    $tmp_oLog = $tmp_auth_oLog_ARRAY[$i];

                    if(is_object($tmp_oLog)){
                        //
                        // WE HAVE A VALID LOG FOR WHICH TO PREPARE OUTPUT
                        //$tmp_silo_key = $tmp_oLog->return_silo_profile_array();
                        $tmp_transactionTime = $tmp_oLog->get_transactionTime();
                        $tmp_runTime = $tmp_oLog->get_runTime();

                        $tmp_runFile_raw = $tmp_oLog->get_runFile();
                        $tmp_classMethod_raw = $tmp_oLog->get_classMethod();
                        $tmp_lineNumber_raw = $tmp_oLog->get_lineNumber();
                        $tmp_logMsg_raw = $tmp_oLog->get_logMsg();

                        $tmp_transactionTime_ARRAY = array();
                        $tmp_runTime_ARRAY = array();
                        $tmp_classMethodFile_ARRAY = array();
                        $tmp_lineNumber_ARRAY = array();
                        $tmp_logMsg_ARRAY = array();

                        $tmp_transactionTime_ARRAY['text'] = $tmp_transactionTime;

                        $tmp_runTime_ARRAY['text'] = ' [rtime ' . $tmp_runTime . ']';

                        if(isset($tmp_classMethod_raw)){

                            if($tmp_classMethod_raw != ''){

                                $tmp_classMethodFile_ARRAY['text'] = ' [methd ' . $tmp_classMethod_raw . ']';

                            }else{

                                if(isset($tmp_runFile_raw)){

                                    if($tmp_runFile_raw != ''){

                                        $tmp_classMethodFile_ARRAY['text'] = ' [file ' . $tmp_runFile_raw . ']';

                                    }else{

                                        $tmp_classMethodFile_ARRAY['text'] = '';

                                    }

                                }else{

                                    $tmp_classMethodFile_ARRAY['text'] = '';

                                }

                            }

                        }else{

                            if(isset($tmp_runFile_raw)){

                                if($tmp_runFile_raw != ''){

                                    $tmp_classMethodFile_ARRAY['text'] = ' [file ' . $tmp_runFile_raw . ']';

                                }else{

                                    $tmp_classMethodFile_ARRAY['text'] = '';

                                }

                            }else{

                                $tmp_classMethodFile_ARRAY['text'] = '';

                            }

                        }

                        if(isset($tmp_lineNumber_raw)){

                            if($tmp_lineNumber_raw != ''){

                                $tmp_lineNumber_ARRAY['text'] = ' [lnum ' . $tmp_lineNumber_raw . ']';

                            }else{

                                $tmp_lineNumber_ARRAY['text'] = '';

                            }

                        }else{

                            $tmp_lineNumber_ARRAY['text'] = '';

                        }

                        if(isset($tmp_logMsg_raw)){

                            $tmp_logMsg_ARRAY['text'] = ' ' . $tmp_logMsg_raw . '
';

                        }else{

                            $tmp_logMsg_ARRAY['text'] = '
';

                        }

                        $tmp_log_to_errorlog_array['text'] .= $tmp_transactionTime_ARRAY['text'] .
                            $tmp_runTime_ARRAY['text'] .
                            $tmp_classMethodFile_ARRAY['text'] .
                            $tmp_lineNumber_ARRAY['text'] .
                            $tmp_logMsg_ARRAY['text'];

                    }

                }

                $tmp_log_to_errorlog_array['text'] .= 'END LOG OUTPUT OF ACTIVITY FROM REQUESTING SOURCE :: ' . $tmp_request_source . '
';
                return $tmp_log_to_errorlog_array;

            break;

        }

    }

    public function get_error_log_trace($output_profile, $output_profile_override_meta, $log_silo_profile, $line_num, $method, $file, $oCRNRSTN_USR){

        # IF CRNRSTN :: CONSTRUCT HAS SILO LIMITS...POSSIBLE THIS METHOD COULD REQUEST NON-EXISTENT
        # SILO LOG DATA..JUST SEND THIS REALIZATION AS PART OF THE OUTPUT TO CHANNEL
        # [EMAIL, FILE, SCREEN_TEXT, SCREEN|SCREEN_HTML, SCREEN_HTML_HIDDEN, DEFAULT]
        try{

            $oCRNRSTN_USR->error_log('error_LogTrace() action to take on profile[' . $output_profile . ']', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_NONE);

            $tmp_output_log_ARRAY = $this->prepare_oLogOut($output_profile, $log_silo_profile, $line_num, $method, $file, NULL, NULL, $oCRNRSTN_USR);

            switch($output_profile){
                case CRNRSTN_LOG_EMAIL:
                    # $tmp_output_log_ARRAY['text']
                    # $tmp_output_log_ARRAY['html']
                    $oCRNRSTN_USR->error_log('error_LogTrace() action to take on profile[' . $output_profile . ']', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_NONE);

                break;
                case CRNRSTN_LOG_EMAIL_PROXY:
                    # $tmp_output_log_ARRAY['text']
                    # $tmp_output_log_ARRAY['html']
                    $oCRNRSTN_USR->error_log('error_LogTrace() action to take on profile[' . $output_profile . ']', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_NONE);

                break;
                case CRNRSTN_LOG_FILE:
                case CRNRSTN_CHANNEL_FILE:

                    # $tmp_output_log_ARRAY['text']
                    //$output_profile_override_meta;
                    $oCRNRSTN_USR->error_log('error_LogTrace() action to take on profile[' . $output_profile . ']', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_NONE);

                    if(isset($output_profile_override_meta)){

                        $tmp_minimum_bytes_required = strlen($tmp_output_log_ARRAY['text']);
                        if(!$this->oCRNRSTN->grant_permissions_fwrite($output_profile_override_meta, $tmp_minimum_bytes_required)){

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            $this->oCRNRSTN->error_log('WARNING. Disk space exceeds ' . $this->oCRNRSTN->get_disk_performance_metric('maximum_disk_use') . '% minimum allocation of free space. File write [' . $output_profile_override_meta . '] stopped. CRNRSTN :: is configured to stop file writes when allocation of free space on disk exceeds specified limits.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                            $this->oCRNRSTN->print_r('WARNING. Disk space exceeds ' . $this->oCRNRSTN->get_disk_performance_metric('maximum_disk_use') . '% minimum allocation of free space. File write [' . $output_profile_override_meta . '] stopped. CRNRSTN :: is configured to stop file writes when allocation of free space on disk exceeds specified limits.', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

                            throw new Exception('WARNING. Disk space exceeds ' . $this->oCRNRSTN->get_disk_performance_metric('maximum_disk_use') . '% minimum allocation of free space. File write [' . $output_profile_override_meta . '] stopped. CRNRSTN :: is configured to stop file writes when allocation of free space on disk exceeds specified limits.');

                        }

                        //
                        // VALIDATE FILE PATH ON FILE OPEN FOR APPEND
                        if($fp = fopen($output_profile_override_meta, 'a')){

                            fwrite($fp, $tmp_output_log_ARRAY['text']);
                            fclose($fp);

                        }else{

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Unable to locate the provided path or open/create file for writing only (i.e. append) at filepath="' . $output_profile_override_meta . '".');

                        }

                    }else{

                        if(1 == 2){


                            //$tmp_key = $_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIALIZATION_HASH'])]['CRNRSTN_ENV_KEY_CRC'];
                            //$tmp_configserial = $_SESSION['CRNRSTN_CONFIG_SERIALIZATION_HASH'];

                            $tmp_log_profile = $oCRNRSTN_USR->return_loggingProfile();
                            $tmp_endpoint_profile = $oCRNRSTN_USR->return_endpointProfile(); //$_SESSION["CRNRSTN_".crc32($tmp_configserial)]["CRNRSTN_".$tmp_key]["_CRNRSTN_LOG_ENDPOINT"];

                            $tmp_log_profile_ARRAY = explode('|', $tmp_log_profile);
                            $tmp_endpoint_profile_ARRAY = explode('|', $tmp_endpoint_profile);

                            $tmp_cnt_log_profile_pipe = sizeof($tmp_log_profile_ARRAY);
                            $tmp_cnt_endpoint_pipe = sizeof($tmp_endpoint_profile_ARRAY);

                            if($tmp_cnt_log_profile_pipe == $tmp_cnt_endpoint_pipe){

                                for($i=0; $i<$tmp_cnt_log_profile_pipe; $i++){
                                    //error_log('1979 - [' . $tmp_log_profile_ARRAY[$i].'][' . $tmp_endpoint_profile_ARRAY[$i].']');
                                    if(trim(strtoupper($tmp_log_profile_ARRAY[$i])) == 'FILE'){

                                        //
                                        // VALIDATE FILE PATH ON FILE OPEN FOR APPEND
//                                        if($fp = fopen($tmp_endpoint_profile_ARRAY[$i], 'a')){
//
//                                            fwrite($fp, $tmp_output_log_ARRAY['text']);
//                                            fclose($fp);
//
//                                        }else{
//
//                                            //
//                                            // HOOOSTON...VE HAF PROBLEM!
//                                            throw new Exception('Unable to locate the provided path or open/create file for writing (i.e. append) at filepath="' . $tmp_cnt_endpoint_pipe[$i] . '".');
//
//                                        }

                                    }

                                }

                            }else{

                                //
                                // HOOOSTON...VE HAF PROBLEM!
                                throw new Exception('Count mismatch experienced (while processing [' . $output_profile . '] log output) between number of log profiles[' . $tmp_cnt_log_profile_pipe . '] and count of matching endpoints[' . $tmp_cnt_endpoint_pipe . '].');

                            }

                        }

                    }

                break;
                case CRNRSTN_LOG_SCREEN_TEXT:
                    # $tmp_output_log_ARRAY['text']
                    $oCRNRSTN_USR->error_log('error_LogTrace() action to take on profile[' . $output_profile . ']', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_NONE);

                    print_r($tmp_output_log_ARRAY['text']);

                break;
                case CRNRSTN_LOG_SCREEN:
                case CRNRSTN_LOG_SCREEN_HTML:
                    # $tmp_output_log_ARRAY['html']
                    $oCRNRSTN_USR->error_log('error_LogTrace() action to take on profile[' . $output_profile . ']', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_NONE);
                    error_log(__LINE__ .' log - why is this still running? ...knock it off, mate.');
                    //echo htmlspecialchars(print_r($tmp_output_log_ARRAY['html']));
                    print_r($tmp_output_log_ARRAY['html']);

                break;
                case CRNRSTN_LOG_SCREEN_HTML_HIDDEN:
                    # $tmp_output_log_ARRAY['text']
                    $oCRNRSTN_USR->error_log('error_LogTrace() action to take on profile[' . $output_profile . ']', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_NONE);

                    print_r('
<!--
' . $tmp_output_log_ARRAY['text'] . '

-->
');
                break;
                //case CRNRSTN_CHANNEL_GET:
                //case CRNRSTN_CHANNEL_POST:
                //case CRNRSTN_CHANNEL_COOKIE:
                //case CRNRSTN_CHANNEL_SESSION:
                case CRNRSTN_CHANNEL_DATABASE:
                case CRNRSTN_CHANNEL_SSDTLA:
                case CRNRSTN_CHANNEL_PSSDTLA:
                case CRNRSTN_CHANNEL_RUNTIME:
                case CRNRSTN_CHANNEL_SOAP:
                //case CRNRSTN_CHANNEL_ALL:
                //case CRNRSTN_CHANNEL_FORM:
                default:
                    //
                    // DEFAULT
                    # $tmp_output_log_ARRAY['text']
                    $oCRNRSTN_USR->error_log('error_LogTrace() action to take on DEFAULT=profile[' . $output_profile . ']', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_NONE);

                    if(isset($tmp_output_log_ARRAY['text']) && $tmp_output_log_ARRAY['text']!=''){

                        error_log($tmp_output_log_ARRAY['text']);

                    }

                break;
            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;
        }

        return NULL;

    }
    /*
        private function compile_log_output($oLog_output_ARRAY, $output_profile, $logSource){

            error_log($output_profile);
            die();
            $tmp_output_log_ARRAY = $this->prepare_oLogOut($output_profile, NULL, NULL, NULL, NULL, $logSource, $oLog_output_ARRAY, NULL);

            switch($output_profile){
                case 'EMAIL':
                    # $tmp_output_log_ARRAY['text']
                    # $tmp_output_log_ARRAY['html']

                    return $tmp_output_log_ARRAY;

                break;
                case 'FILE':
                    # $tmp_output_log_ARRAY['text']

                    if(isset($output_profile_override_meta)){

                        //
                        // VALIDATE FILE PATH ON FILE OPEN FOR APPEND
                        if($fp = fopen($output_profile_override_meta, 'a')){

                            fwrite($fp, $tmp_output_log_ARRAY['text']);
                            fclose($fp);

                        }else{

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Unable to locate the provided path or open/create file for writing only (i.e. append) at filepath="' . $output_profile_override_meta . '".');

                        }

                    }else{

                        $tmp_key = $_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIALIZATION_HASH'])]['CRNRSTN_ENV_KEY_CRC'];
                        $tmp_configserial = $_SESSION['CRNRSTN_CONFIG_SERIALIZATION_HASH'];

                        $tmp_file_path = $_SESSION["CRNRSTN_".crc32($tmp_configserial)]["CRNRSTN_".$tmp_key]["_CRNRSTN_LOG_ENDPOINT"];

                        //
                        // VALIDATE FILE PATH ON FILE OPEN FOR APPEND
                        if($fp = fopen($tmp_file_path, 'a')){

                            fwrite($fp, $tmp_output_log_ARRAY['text']);
                            fclose($fp);

                        }else{

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Unable to locate the provided path or open/create file for writing (i.e. append) at filepath="' . $tmp_file_path . '".');

                        }
                    }

                break;
                case 'SCREEN_TEXT':

                    # $tmp_output_log_ARRAY['text']
                    print_r($tmp_output_log_ARRAY['text']);

                break;
                case 'SCREEN':
                case 'SCREEN_HTML':
                    error_log('2224 log - Why is this still running?');
                    # $tmp_output_log_ARRAY['html']
                    echo htmlspecialchars(print_r($tmp_output_log_ARRAY['html']));

                break;
                case 'SCREEN_HTML_HIDDEN':
                    # $tmp_output_log_ARRAY['text']
                    echo htmlspecialchars(print_r('<!--
    ' . $tmp_output_log_ARRAY['text'] . '
    -->'));
                break;
                default:

                    //
                    // DEFAULT
                    # $tmp_output_log_ARRAY['text']
                    if(isset($tmp_output_log_ARRAY['text']) && $tmp_output_log_ARRAY['text']!=''){

                        error_log($tmp_output_log_ARRAY['text']);

                    }

                break;

                }

            return NULL;

        }

        private function buildSimpleMessage($oLog_output_ARRAY, $output_profile, $logSource){

            if($this->log_output == ''){

                $this->log_output = '** The CRNRSTN configuration file debug mode of "' . $this->CRNRSTN_debug_mode . '" prevents aggregation of log trace data. **';

            }

            $tmp_log_output_ARRAY = $this->compile_log_output($oLog_output_ARRAY, $output_profile, $logSource);

            $this->emailDataElements['subject'] = 'CRNRSTN :: logging notification captured on ' . $_SERVER['SERVER_NAME'];
            $this->emailDataElements['text'] = 'This is a triggered logging notification from CRNRSTN ::

    Information about this notice:
    - - - - - - - - - - - - - - - - - - - -
    Source: ' . $this->emailDataElements['logSource'].'
    Priority: ' . $this->emailDataElements['logPriority'].'
    Message:
    ' . $this->emailDataElements['msg'].'

    - - - - - - - - - - - - - - - - - - - - START LOG TRACE
    ' . $tmp_log_output_ARRAY['text'].'
    - - - - - - - - - - - - - - - - - - - - END LOG TRACE

    Sending IP Address: ' . $_SERVER['REMOTE_ADDR'].' (' . $_SERVER['SERVER_NAME'].')
    System Timestamp: ' . $this->getmicrotime().'
    Runtime: ' . $this->wall_time().' seconds

    Please note that this information has
    not been saved anywhere. You may want
    to keep this email for your records.

    This email was sent to ' . $this->emailDataElements['addAddressEmail'].'.
    If you wish to unsubscribe from future
    system notifications, please contact the
    website administrator.

    ';

            $this->emailDataElements['headers']  = "From: System Notice < crnrstn_noreply@".$_SERVER['SERVER_NAME'].">\n";
            $this->emailDataElements['headers'] .= "X-Sender: System Notice < crnrstn_noreply@".$_SERVER['SERVER_NAME'].">\n";
            $this->emailDataElements['headers'] .= 'X-Mailer: PHP/' . phpversion();
            $this->emailDataElements['headers'] .= "X-Priority: 1\n"; // Urgent message!
            $this->emailDataElements['headers'] .= "Return-Path: crnrstn_noreply@".$_SERVER['SERVER_NAME']."\n";
            $this->emailDataElements['headers'] .= "Reply-To: crnrstn_noreply@".$_SERVER['SERVER_NAME']."\n";// Return path for errors
            $this->emailDataElements['headers'] .= "MIME-Version: 1.0\r\n";
            $this->emailDataElements['headers'] .= "Content-Type: text/plain; charset=UTF-8\n";

            return true;

        }

        private function sendSimpleMessage(){

            if(mail($this->emailDataElements['addAddressEmail'], $this->emailDataElements['subject'], $this->emailDataElements['text'], $this->emailDataElements['headers'])){

                return "success";

            }else{

                return "mailsend error";

            }

        }
    */
    public function returnMicroTime(){

        return $this->getmicrotime();

    }

    //
    // METHOD TAKEN FROM NUSOAP.PHP - http://sourceforge.net/projects/nusoap/
    /**
     * returns the time in ODBC canonical form with microseconds
     *
     * @return string The time in ODBC canonical form with microseconds
     * @access public
     */
    private function getmicrotime(){

        if(function_exists('gettimeofday')){

            $tod = gettimeofday();
            $sec = $tod['sec'];
            $usec = $tod['usec'];

        }else{

            $sec = time();
            $usec = 0;

        }

        return strftime('%Y-%m-%d %H:%M:%S', $sec) . '.' . sprintf('%06d', $usec);

    }

    private function wall_time(){

        if(isset($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIALIZATION_HASH']]['CRNRSTN_START_TIME'])){

            $this->starttime = $_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIALIZATION_HASH']]['CRNRSTN_START_TIME'];

        }

        $timediff = $this->microtime_float() - $this->starttime;

        //return substr($timediff,0,-8);
        return $timediff;

    }

    //
    // SOURCE :: http://www.php.net/manual/en/function.microtime.php
    private function microtime_float(){

        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);

    }

    public function __destruct(){

    }

}