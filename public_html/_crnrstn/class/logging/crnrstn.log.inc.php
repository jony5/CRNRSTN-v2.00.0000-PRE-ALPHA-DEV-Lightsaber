<?php
/*
// J5
// Code is Poetry */
#
#  CRNRSTN ::
#  VERSION :: 2.00.0000 PRE-ALPHA-DEV
#  DATE (for v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
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
# # C # R # N # R # S # T # N # : : # # ##
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

    protected $oLog_output_manager;
    private static $oCRNRSTN_n;
	public $emailDataElements = array();
	public $msg_delivery_status;

	protected $oLog_ProfileManager;
	protected $CRNRSTN_debug_mode = 0;
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

    // DO WE EVER TAKE THE DEFAULT HERE? COULD THAT EVER HAPPEN WITHIN THE CURRENT ARCHITECTURE? Wednesday, August 17, 2022 @ 0408 hrs
	public function __construct($parent_class, $oCRNRSTN = NULL) {

	    $log_silo_profile = CRNRSTN_SETTINGS_CRNRSTN;

	    if(isset($oCRNRSTN)){

            $log_silo_profile = $oCRNRSTN->log_silo_profile;

        }

	    // CAN BE *oCRNRSTN, oCRNRSTN_ENV, or oCRNRSTN_USR
        //error_log(__LINE__ . ' ' . __CLASS__ . '->' . __METHOD__ . ':: logging $parent_class=[' . $parent_class . '] $oCRNRSTN=>'. get_class($oCRNRSTN));
	    self::$oCRNRSTN_n = $oCRNRSTN;

        $this->tmp_starttime = self::$oCRNRSTN_n->starttime;
        $this->parent_class = $parent_class;
        $this->tmp_starttime_ARRAY = explode('.',$this->tmp_starttime);
        $this->tmp_precise_timestamp = date('Y-m-d H:i:s', $this->tmp_starttime_ARRAY[0]);
        $this->tmp_precise_timestamp .= '.' . $this->tmp_starttime_ARRAY[1];

        //error_log(__LINE__ . ' log [' . print_r($this->tmp_starttime_ARRAY, true) . '].');

        $this->oLog_ProfileManager = self::$oCRNRSTN_n->return_oLog_ProfileManager();

        // LET'S SEE IF WE GET NULL TROUBLES (BARNEY TOWN).
        $this->CRNRSTN_debug_mode = (int) self::$oCRNRSTN_n->CRNRSTN_debug_mode();

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

	private function load_log_output_mgr($oCRNRSTN_n){

        $this->oLog_output_manager = new crnrstn_log_output_manager($oCRNRSTN_n);

    }

	public function catch_exception($exception_obj, $syslog_constant, $exception_method, $namespace, $profile_override_pipe, $endpoint_override_pipe, $wcr_override_pipe, $oCRNRSTN_n){

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
        124 - getFile=/var/www/html/crnrstn_v2/_crnrstn/class/environmentals/crnrstn.env.inc.php
        125 - getLine=403
        126 - getTraceAsString=#0 /var/www/html/crnrstn_v2/_crnrstn/class/user/crnrstn.user.inc.php(6063): crnrstn_environment->getServerArrayVar('CLOWN_TOWN', Object(crnrstn_user))\n#1 /var/www/html/crnrstn_v2/common/inc/footer/footer.inc.php(591): crnrstn_user->get_SERVER_param('CLOWN_TOWN')\n#2 /var/www/html/crnrstn_v2/index.php(132): include_once('/var/www/html/c...')\n#3 {main}

        */

	    $tmp_class_name = get_class($oCRNRSTN_n);

	    switch($tmp_class_name){
            case 'crnrstn':

                //
                // CRNRSTN :: DEEP EMBRYONIC STATE
                //$oCRNRSTN = $oCRNRSTN_n;

                //$init_profile_pack_ARRAY['sys_logging_profile_ARRAY'] = $array[crc32($this->config_serial)][CRNRSTN_LOG_ALL][];
                //$init_profile_pack_ARRAY['sys_logging_meta_ARRAY'] = $array[crc32($this->config_serial)][CRNRSTN_LOG_ALL][];
                //$init_profile_pack_ARRAY['sys_logging_wcr_ARRAY'] = $array[crc32($this->config_serial)][CRNRSTN_LOG_ALL][]

                $init_profile_pack_ARRAY = $oCRNRSTN_n->return_sys_logging_init_profile_pack();

                $this->oLog_ProfileManager = new crnrstn_logging_oprofile_manager($init_profile_pack_ARRAY, $oCRNRSTN_n);

                //error_log(__LINE__ .' log '.get_class().'::  init_profile_pack_ARRAY size='.print_r($init_profile_pack_ARRAY, true));
                //die();

                $this->oLog_ProfileManager->sync_to_environment($oCRNRSTN_n);

                // DO WE NEED TO CALL THIS AFTER CONSTRUCTOR RECEIVES SAME ARRAY?
                $this->oLog_ProfileManager->consume_init_profile_pack($init_profile_pack_ARRAY);

            break;
            case 'crnrstn_user':

                $oCRNRSTN_ENV = $oCRNRSTN_n->return_oCRNRSTN_ENV();

                //
                // ALWAYS GET FRESH LOGGING PROFILE. CAN CHANGE BEFORE METHOD CALL...RIGHT?
                $init_profile_pack_ARRAY = array();
                $init_profile_pack_ARRAY['sys_logging_profile_ARRAY'] = $oCRNRSTN_ENV->return_sys_logging_profile();
                $init_profile_pack_ARRAY['sys_logging_meta_ARRAY'] = $oCRNRSTN_ENV->return_sys_logging_meta();

                if(isset($oCRNRSTN_n->oWildCardResource_ARRAY[$oCRNRSTN_n->crcINT($oCRNRSTN_n->config_serial_crc)])){

                    $init_profile_pack_ARRAY['sys_logging_wcr_ARRAY'] = $oCRNRSTN_ENV->oWildCardResource_ARRAY[$oCRNRSTN_ENV->crcINT($oCRNRSTN_ENV->config_serial)][CRNRSTN_LOG_ALL];

                }

                $this->oLog_ProfileManager = $oCRNRSTN_n->return_oLog_ProfileManager();

                $this->oLog_ProfileManager->consume_init_profile_pack($init_profile_pack_ARRAY);

            break; // DO NOT BREAK.
            case 'crnrstn_environment':

                //
                // ALWAYS GET FRESH LOGGING PROFILE. CAN CHANGE BEFORE METHOD CALL...RIGHT?
                $init_profile_pack_ARRAY = array();
                $init_profile_pack_ARRAY['sys_logging_profile_ARRAY'] = $oCRNRSTN_n->return_sys_logging_profile();
                $init_profile_pack_ARRAY['sys_logging_meta_ARRAY'] = $oCRNRSTN_n->return_sys_logging_meta();
                //$init_profile_pack_ARRAY['sys_logging_wcr_ARRAY'] = $oCRNRSTN_n->oWildCardResource_ARRAY[$oCRNRSTN_n->crcINT($oCRNRSTN_n->config_serial_crc)][CRNRSTN_LOG_ALL];

                if(isset($oCRNRSTN_n->oWildCardResource_ARRAY[$oCRNRSTN_n->crcINT($oCRNRSTN_n->config_serial_crc)])){

                    $init_profile_pack_ARRAY['sys_logging_wcr_ARRAY'] = $oCRNRSTN_n->oWildCardResource_ARRAY[$oCRNRSTN_n->crcINT($oCRNRSTN_n->config_serial_crc)][CRNRSTN_LOG_ALL];

                }

                $this->oLog_ProfileManager = $oCRNRSTN_n->return_oLog_ProfileManager();

//              error_log(__LINE__ .' log '.get_class().'::  pack + sys_logging_wcr_ARRAY='.print_r($init_profile_pack_ARRAY, true));
//              die();

                $this->oLog_ProfileManager->consume_init_profile_pack($init_profile_pack_ARRAY);

            break;

                //
                // MATURE DEVELOPMENT
            default :


            break;

        }

        $tmp_exception_msg = $exception_obj->getMessage();
        $tmp_exception_linenum = $exception_obj->getLine();
        $tmp_exception_runtime = $oCRNRSTN_n->wall_time();
        $tmp_exception_systemtime = $oCRNRSTN_n->return_micro_time();

        $exception_method_trim = trim($exception_method);
        //error_log(__LINE__ .' my class in logger catch_exception is '.get_class($oCRNRSTN_n).' $exception_method_trim=' . $exception_method_trim.' $tmp_exception_msg=' . $tmp_exception_msg);

        if(isset($exception_method_trim)){

            if($exception_method_trim==''){

                $tmp_source_method = '';
                $tmp_exception_method = $exception_obj->getFile();
                $method = 'file';

            }else{

                $tmp_source_method = $exception_method_trim;
                $tmp_exception_method = $exception_method_trim.'()';
                $method = 'methd';

            }

        }else{

            $tmp_source_method = '';
            $tmp_exception_method = $exception_obj->getFile();
            $method = 'file';

        }

        $oCRNRSTN_n->error_log('[rtime ' . $tmp_exception_runtime.' secs] [' . $method . ' ' . $tmp_exception_method . '] [lnum ' . $tmp_exception_linenum.'] ' . $tmp_exception_msg, __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

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
                        'DATE_CREATED_SOAP_RESPONSE' => self::$oCRNRSTN_n->return_micro_time(),
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
                        'DATE_CREATED_SOAP_RESPONSE' => self::$oCRNRSTN_n->return_micro_time(),
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

        $this->oLog_ProfileManager->notification_go($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $tmp_exception_method, $tmp_exception_runtime, $tmp_exception_systemtime, $exception_obj);

        return NULL;

    }

    public function error_log($str, $line_num, $method, $file, $log_silo_key, $oCRNRSTN_n){

        // $oCRNRSTN_n CAN BE $oCRNRSTN_USR, $oCRNRSTN_ENV, or $oCRNRSTN
        //error_log(__LINE__ . ' log ' . __METHOD__ . ' $this->CRNRSTN_debug_mode=['  . $this->CRNRSTN_debug_mode . ']');
        switch($this->CRNRSTN_debug_mode){
            case 1:

                //if(($oCRNRSTN_n->oCRNRSTN_BITFLIP_MGR->oCRNRSTN_BITWISE->read($log_silo_key) || $oCRNRSTN_n->oCRNRSTN_BITFLIP_MGR->oCRNRSTN_BITWISE->read(CRNRSTN_LOG_ALL) && !$oCRNRSTN_n->oCRNRSTN_BITFLIP_MGR->oCRNRSTN_BITWISE->read(CRNRSTN_LOG_NONE))){
                if(($oCRNRSTN_n->is_bit_set($log_silo_key) || $oCRNRSTN_n->is_bit_set(CRNRSTN_LOG_ALL) && !$oCRNRSTN_n->is_bit_set(CRNRSTN_LOG_NONE))){

                    if($method != 'crnrstn_logging::catch_exception'){

                        $tmp_str = "[rtime " . $oCRNRSTN_n->wall_time() . ' secs]';

                        if(!isset($method) || $method==''){

                            if(isset($file)){

                                $tmp_str .= ' [file ' . $file.']';

                            }

                        }else{

                            $tmp_str .= ' [methd ' . $method . ']';

                        }

                        if(isset($line_num)){

                            $tmp_str .= ' [lnum ' . $line_num.']';

                        }

                        $tmp_str .= ' ' . $str;

                    }else{

                        $tmp_str = $str;

                    }

                    error_log($tmp_str);

                }

            break;
            case 2:

                //
                // LOG AGGREGATION WITHIN CRNRSTN + SILO SUPPORT
                if(($oCRNRSTN_n->is_bit_set($log_silo_key) || $oCRNRSTN_n->is_bit_set(CRNRSTN_LOG_ALL) && !$oCRNRSTN_n->is_bit_set(CRNRSTN_LOG_NONE))){

                    $this->active_log_silo_flag_ARRAY[$log_silo_key] = 1;
                    $tmp_oLog = new crnrstn_log($oCRNRSTN_n, $this->getmicrotime(), $log_silo_key);

                    if (is_object($oCRNRSTN_n)) {

                        $this->starttime = $oCRNRSTN_n->starttime;

                        $tmp_oLog->set_runTime($oCRNRSTN_n->wall_time());

                    }

                    $tmp_oLog->set_runFile($file);

                    $tmp_oLog->set_classMethod($method);

                    $tmp_oLog->set_lineNumber($line_num);

                    $tmp_str = $str . '';

                    $tmp_oLog->set_logMsg($tmp_str);

                    return $tmp_oLog;

                }

            break;
            default:
                // 0

            break;

        }

        return NULL;

    }

    /*
    public function DELETED__captureNotice($logSource, $logPriority, $msg, $oLog_output_ARRAY=NULL){
		$tmp_priority = "UNKNOWN";
		$tmp_configserial = "";
		$tmp_key = "";

		//
		//error_log('839 - CRNRSTN_CONFIG_SERIAL_CRC=' . $_SESSION['CRNRSTN_CONFIG_SERIAL_CRC']);
		if(isset($_SESSION['CRNRSTN_CONFIG_SERIAL_CRC'])){
			$tmp_key = $_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL_CRC'])]['CRNRSTN_ENV_KEY_CRC'];
			$tmp_configserial = $_SESSION['CRNRSTN_CONFIG_SERIAL_CRC'];

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

            for($i=0; $i<$tmp_oLog_cnt; $i++){

                $tmp_oLog = $oLog_possible_output_ARRAY[$i];

                if(is_object($tmp_oLog)){

                    $tmp_oLog_silo_key = $tmp_oLog->get_siloKeyProfile();

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

	private function prepare_oLogOut($channel, $log_silo_keys_pipe, $line_num, $method, $file, $logSource, $oLog_output_ARRAY, $oCRNRSTN_USR){

        $tmp_request_source = $this->return_requestSourceStr($line_num, $method, $file, $logSource);

        if(isset($oLog_output_ARRAY)){

            $tmp_auth_oLog_ARRAY = $oLog_output_ARRAY;

        }else{

            error_log(__LINE__ . ' '. __METHOD__ . ' log.inc.php die() go to integer constant arch.');
            die();

            $tmp_silo_negation_ARRAY = array();
            $tmp_silo_ARRAY = explode('|', $log_silo_keys_pipe);
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
                for($i=0; $i<$tmp_log_cnt; $i++) {

                    $tmp_oLog = $tmp_auth_oLog_ARRAY[$i];

                    if(is_object($tmp_oLog)){

                        //
                        // WE HAVE A VALID LOG FOR WHICH TO PREPARE OUTPUT
                        //$tmp_silo_key = $tmp_oLog->get_siloKeyProfile();
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

                $tmp_log_to_errorlog_array = array();
                $tmp_log_to_errorlog_array['text'] = 'BEGIN LOG OUTPUT OF ACTIVITY FROM [' . $channel . '] REQUESTING SOURCE :: ' . $tmp_request_source.'
';

                $tmp_log_cnt = sizeof($tmp_auth_oLog_ARRAY);

                for($i=0; $i<$tmp_log_cnt; $i++) {

                    $tmp_oLog = $tmp_auth_oLog_ARRAY[$i];

                    if(is_object($tmp_oLog)){
                        //
                        // WE HAVE A VALID LOG FOR WHICH TO PREPARE OUTPUT
                        //$tmp_silo_key = $tmp_oLog->get_siloKeyProfile();
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
                for($i=0; $i<$tmp_log_cnt; $i++) {

                    $tmp_oLog = $tmp_auth_oLog_ARRAY[$i];

                    if(is_object($tmp_oLog)){
                        //
                        // WE HAVE A VALID LOG FOR WHICH TO PREPARE OUTPUT
                        //$tmp_silo_key = $tmp_oLog->get_siloKeyProfile();
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

                for($i=0; $i<$tmp_log_cnt; $i++) {

                    $tmp_oLog = $tmp_auth_oLog_ARRAY[$i];

                    if(is_object($tmp_oLog)){

                        //
                        // WE HAVE A VALID LOG FOR WHICH TO PREPARE OUTPUT
                        //$tmp_silo_key = $tmp_oLog->get_siloKeyProfile();
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

                                $tmp_classMethodFile_ARRAY['html'] = ' [methd ' . $tmp_classMethod_raw.']';

                            }else{

                                if(isset($tmp_runFile_raw)){
                                    if($tmp_runFile_raw != ''){

                                        $tmp_classMethodFile_ARRAY['html'] = ' [file ' . $tmp_runFile_raw.']';

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

                                    $tmp_classMethodFile_ARRAY['html'] = ' [file ' . $tmp_runFile_raw.']';

                                }else{

                                    $tmp_classMethodFile_ARRAY['html'] = '';

                                }

                            }else{

                                $tmp_classMethodFile_ARRAY['html'] = '';

                            }

                        }

                        if(isset($tmp_lineNumber_raw)){

                            if($tmp_lineNumber_raw != ''){

                                $tmp_lineNumber_ARRAY['html'] = ' [lnum ' . $tmp_lineNumber_raw.']';

                            }else{

                                $tmp_lineNumber_ARRAY['html'] = '';

                            }

                        }else{

                            $tmp_lineNumber_ARRAY['html'] = '';

                        }

                        if(isset($tmp_logMsg_raw)){

                            $tmp_logMsg_ARRAY['html'] = ' ' . $tmp_logMsg_raw.'<br>';

                        }else{

                            $tmp_logMsg_ARRAY['html'] = '<br>';

                        }

                        $tmp_log_to_screen_array['html'] .= '<div style="font-family: Arial,Helvetica,sans-serif; font-size: 11px; padding-left:10px; line-height: 17px;">'.
                            $tmp_transactionTime_ARRAY['html'].
                            $tmp_runTime_ARRAY['html'].
                            $tmp_classMethodFile_ARRAY['html'].
                            $tmp_lineNumber_ARRAY['html'].
                            $tmp_logMsg_ARRAY['html'].'</div>';

                    }
                }

                $tmp_log_to_screen_array['html'] .= '<div style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bold; padding:0 0 5px 5px; line-height: 15px;">END LOG OUTPUT OF ACTIVITY FROM [' . $channel . '] REQUESTING SOURCE :: ' . $tmp_request_source.'</div>';
                return $tmp_log_to_screen_array;

            break;
            case CRNRSTN_LOG_SCREEN_HTML_HIDDEN:

                $tmp_log_to_html_hidden_array = array();
                $tmp_log_to_html_hidden_array['text'] = '';
                $tmp_log_to_html_hidden_array['text'] .= 'BEGIN LOG OUTPUT OF ACTIVITY FROM [' . $channel . '] REQUESTING SOURCE :: ' . $tmp_request_source.'
';

                $tmp_log_cnt = sizeof($tmp_auth_oLog_ARRAY);
                for($i=0; $i<$tmp_log_cnt; $i++) {

                    $tmp_oLog = $tmp_auth_oLog_ARRAY[$i];

                    if(is_object($tmp_oLog)){
                        //
                        // WE HAVE A VALID LOG FOR WHICH TO PREPARE OUTPUT
                        //$tmp_silo_key = $tmp_oLog->get_siloKeyProfile();
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

                        $tmp_log_to_html_hidden_array['text'] .= $tmp_transactionTime_ARRAY['text'].
                            $tmp_runTime_ARRAY['text'].
                            $tmp_classMethodFile_ARRAY['text'].
                            $tmp_lineNumber_ARRAY['text'].
                            $tmp_logMsg_ARRAY['text'];

                    }
                }

                $tmp_log_to_html_hidden_array['text'] .= 'END LOG OUTPUT OF ACTIVITY FROM [' . $channel . '] REQUESTING SOURCE :: ' . $tmp_request_source.'
';

                 return $tmp_log_to_html_hidden_array;

            break;
            default:

                //
                // DEFAULT
                $tmp_log_cnt = sizeof($tmp_auth_oLog_ARRAY);
                if($tmp_log_cnt<1){

                    return NULL;

                }

                $tmp_log_to_errorlog_array = array();
                $tmp_log_to_errorlog_array['text'] = '';
                $tmp_log_to_errorlog_array['text'] .= 'BEGIN LOG OUTPUT OF ACTIVITY FROM [' . $channel . '] REQUESTING SOURCE :: ' . $tmp_request_source.'
';

                $tmp_log_cnt = sizeof($tmp_auth_oLog_ARRAY);
                for($i=0; $i<$tmp_log_cnt; $i++) {

                    $tmp_oLog = $tmp_auth_oLog_ARRAY[$i];

                    if(is_object($tmp_oLog)){
                        //
                        // WE HAVE A VALID LOG FOR WHICH TO PREPARE OUTPUT
                        //$tmp_silo_key = $tmp_oLog->get_siloKeyProfile();
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

                        $tmp_log_to_errorlog_array['text'] .= $tmp_transactionTime_ARRAY['text'].
                            $tmp_runTime_ARRAY['text'].
                            $tmp_classMethodFile_ARRAY['text'].
                            $tmp_lineNumber_ARRAY['text'].
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
                    # $tmp_output_log_ARRAY['text']
                    //$output_profile_override_meta;
                    $oCRNRSTN_USR->error_log('error_LogTrace() action to take on profile[' . $output_profile . ']', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_NONE);

                    if(isset($output_profile_override_meta)){

                        $tmp_minimum_bytes_required = strlen($tmp_output_log_ARRAY['text']);
                        if(!self::$oCRNRSTN_n->grant_permissions_fwrite($output_profile_override_meta, $tmp_minimum_bytes_required)){

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            self::$oCRNRSTN_n->error_log('WARNING. Disk space exceeds ' . self::$oCRNRSTN_n->get_performance_metric('maximum_disk_use') . '% minimum allocation of free space. File write [' . $output_profile_override_meta . '] stopped. CRNRSTN :: is configured to stop file writes when allocation of free space on disk exceeds specified limits.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                            self::$oCRNRSTN_n->print_r('WARNING. Disk space exceeds ' . self::$oCRNRSTN_n->get_performance_metric('maximum_disk_use') . '% minimum allocation of free space. File write [' . $output_profile_override_meta . '] stopped. CRNRSTN :: is configured to stop file writes when allocation of free space on disk exceeds specified limits.', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

                            throw new Exception('WARNING. Disk space exceeds ' . self::$oCRNRSTN_n->get_performance_metric('maximum_disk_use') . '% minimum allocation of free space. File write [' . $output_profile_override_meta . '] stopped. CRNRSTN :: is configured to stop file writes when allocation of free space on disk exceeds specified limits.');

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


                            //$tmp_key = $_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL_CRC'])]['CRNRSTN_ENV_KEY_CRC'];
                            //$tmp_configserial = $_SESSION['CRNRSTN_CONFIG_SERIAL_CRC'];

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

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
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

                    $tmp_key = $_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL_CRC'])]['CRNRSTN_ENV_KEY_CRC'];
                    $tmp_configserial = $_SESSION['CRNRSTN_CONFIG_SERIAL_CRC'];

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

		$this->emailDataElements['subject'] = 'CRNRSTN Suite :: logging notification captured on ' . $_SERVER['SERVER_NAME'];
		$this->emailDataElements['text'] = 'This is a triggered logging notification from the CRNRSTN Suite ::.

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

		$this->emailDataElements['headers']  = "From: System Notice < crnrstn_noreply@".$_SERVER['SERVER_NAME']." >\n";
		$this->emailDataElements['headers'] .= "X-Sender: System Notice < crnrstn_noreply@".$_SERVER['SERVER_NAME']." >\n";
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
	private function getmicrotime() {

		if (function_exists('gettimeofday')) {

			$tod = gettimeofday();
			$sec = $tod['sec'];
			$usec = $tod['usec'];

		} else {

			$sec = time();
			$usec = 0;

		}

		return strftime('%Y-%m-%d %H:%M:%S', $sec) . '.' . sprintf('%06d', $usec);

	}

    private function wall_time(){

	    if(isset($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_CRC']]['CRNRSTN_START_TIME'])){

            $this->starttime = $_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_CRC']]['CRNRSTN_START_TIME'];

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

	public function __destruct() {

	}
}

# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: crnrstn_log_output_manager
#  VERSION :: 1.00.0000
#  DATE :: Mon September 9, 2020 @ 2340hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION ::
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_log_output_manager {

    protected $oLogger;
    private static $oCRNRSTN_n;

    public $maximum_email_log_trace = 23;   // REGULATE MAXIMUM LOG TRACE OUTPUT TO EMAIL & ERROR_LOG

    public function __construct($oCRNRSTN_n) {

        if(get_class($oCRNRSTN_n) != 'crnrstn_logging'){

            self::$oCRNRSTN_n = $oCRNRSTN_n;

            //
            // INSTANTIATE LOGGER
            $this->oLogger = new crnrstn_logging(__CLASS__, self::$oCRNRSTN_n);

        }

    }

    public function return_log_trace_output_str($output_profile = 'ERROR_LOG', $line_wrap = NULL){

        if(get_class(self::$oCRNRSTN_n) == 'crnrstn'){

            //
            // RETURN LOG TRACE STRING
            switch($output_profile) {
                case 'EMAIL_HTML':

                    return $this->return_log_str_EMAIL_HTML();

                    break;
                case 'EMAIL_TEXT':

                    return $this->return_log_str_EMAIL_TEXT();

                    break;
                case 'FILE':

                    return $this->return_log_str_FILE($line_wrap);

                    break;
                case 'SCREEN_TEXT':

                    return $this->return_log_str_SCREEN_TEXT();

                    break;
                case 'SCREEN':
                case 'SCREEN_HTML':

                    return $this->return_log_str_SCREEN_HTML();

                    break;
                case 'SCREEN_HTML_HIDDEN':

                    return $this->return_log_str_SCREEN_HTML(false);

                    break;
                default:

                    //
                    // ERROR_LOG
                    return $this->return_log_str_ERROR_LOG();

                    break;
            }

        }

        return '';

    }

    private function return_HTML_EMAIL_chunk_ARRAY($str, $chunkSize){

        $tmp_str_array = array();
        $tmp_str_array[1] = '';

        $oChunkRestrictData = self::$oCRNRSTN_n->chunkPageData($str, $chunkSize);
        $tmp_str_out_array = $oChunkRestrictData->return_linesArray();

        $tmp_out_str_1 = '';

        //
        // RETURN ARRAY[0] = CHUNK SIZE AND ARRAY[1] = EVERYTHING ELSE
        $tmp_chunk_cnt = sizeof($tmp_str_out_array);
        for($i=0; $i<$tmp_chunk_cnt; $i++){

            if($i == 0){

                $tmp_out_str_0 = $tmp_str_out_array[$i];

            }else{

                $tmp_out_str_1 .= $tmp_str_out_array[$i];

            }

        }

        $oChunkRestrictData = self::$oCRNRSTN_n->chunkPageData('...'.trim($tmp_out_str_1), 91);
        $tmp_out_str_1 = $oChunkRestrictData->return_linesString($output_format = 'HTML', $new_line_prefix = '...');
        $tmp_out_str_1 = ltrim($tmp_out_str_1,'<br>');

        $tmp_str_array[0] = $tmp_out_str_0;
        $tmp_str_array[1] = $tmp_out_str_1;

        return $tmp_str_array;

    }

    private function return_log_str_EMAIL_HTML(){

        $tmp_log_str_ARRAY = array();

        //
        // BUILD LOG TRACE STRING FOR HTML EMAIL
        $tmp_msg = '';
        foreach(self::$oCRNRSTN_n->oLog_output_ARRAY as $key => $oLog){

            if(is_object($oLog)){

                //
                // GET LOG DATA - FIXED LENGTH
                $tmp_transactionTime = $oLog->get_transactionTime();

                $tmp_runTime = $oLog->get_runTime();
                $tmp_runTime = '[rtime ' . $tmp_runTime . ' secs]';

                //
                // GET LOG DATA - VARIABLE LENGTH (CHUNK TO EMAIL MAX CHAR WIDTH)
                $tmp_chunkstr_raw = '';
                $tmp_classMethod_raw = trim($oLog->get_classMethod());

                if($tmp_classMethod_raw == ''){

                    $tmp_runFile_raw = $oLog->get_runFile();

                    if($tmp_runFile_raw != ''){

                        $tmp_chunkstr_raw .= '[file ' . $tmp_runFile_raw . ']';

                    }

                }else{

                    if($tmp_classMethod_raw != '') {

                        $tmp_chunkstr_raw .= '[methd ' . $tmp_classMethod_raw . ']';

                    }

                }

                $tmp_lineNumber_raw = $oLog->get_lineNumber();

                if($tmp_lineNumber_raw != '') {

                    $tmp_chunkstr_raw .= ' [lnum ' . $tmp_lineNumber_raw . '] ';

                }

                $tmp_logMsg_raw = $oLog->get_logMsg();
                $tmp_chunkstr_raw .= $tmp_logMsg_raw;

                //
                //  PREP CHUNK AND MAIN
                $tmp_HTML_chunk_output_ARRAY = $this->return_HTML_EMAIL_chunk_ARRAY($tmp_chunkstr_raw, 53);

                //
                // ADD OBJECT DATA TO OUTPUT STR
                $tmp_log_str_ARRAY[] = '<tr>
                                <td align="left" style="text-align: left;"><div style="font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:20px; border-top: 2px solid #FFF;"><span style="color: #000; font-weight: bold;">' . $tmp_transactionTime . '</span></div></td>
                                <td align="left" style="text-align: left;"><div style="font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:18px; border-bottom: 0px solid #FFF;"><span style="color: #F90000; line-height: 20px;">' . $tmp_runTime . '</span></div></td>
                                <td align="left" style="text-align: left;"><div style="text-align: left; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:18px; border-bottom: 0px solid #FFF;"><span style="line-height: 20px;">' . $tmp_HTML_chunk_output_ARRAY[0] . '</span></div></td>
                            </tr>
                            <tr>
                                <td colspan="3" align="left" style="text-align: left;"><div style="text-align:left; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:16px; border-bottom: 6px solid #FFF;"><span style="line-height: 20px;">' . $tmp_HTML_chunk_output_ARRAY[1] . '</span></div></td>
                            </tr>';

            }

        }

        if(count($tmp_log_str_ARRAY)<1) {

            if (isset(self::$oCRNRSTN_n->log_silo_profile)) {

                $tmp_condition = ' but, the restriction of log recording to the silo profile, (int) ' . self::$oCRNRSTN_n->log_silo_profile . ', seems to have reduced C<span style="color:#F90000;">R</span>NRSTN :: trace output activity to NULL';

            } else {

                $tmp_condition = ' but, there appears to be no C<span style="color:#F90000;">R</span>NRSTN :: trace output log data activity';

            }

            if (self::$oCRNRSTN_n->CRNRSTN_debug_mode() < 2) {

                $tmp_msg = '** The C<span style="color:#F90000;">R</span>NRSTN :: configuration file debug mode of "' . self::$oCRNRSTN_n->CRNRSTN_debug_mode() . '" prevents aggregation of log trace data. **';

            } else {

                $tmp_msg = '** The C<span style="color:#F90000;">R</span>NRSTN :: configuration file debug mode of "' . self::$oCRNRSTN_n->CRNRSTN_debug_mode() . '" allows aggregation of log trace data' . $tmp_condition . '. **';

            }

            $tmp_msg = '<div style="font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:23px;">' . $tmp_msg . '</div>';

            //
            // RETURN LOG TRACE STRING FOR HTML EMAIL
            return $tmp_msg;

        }else{

            $tmp_log_cnt = count($tmp_log_str_ARRAY);
            $tmp_buffer_delta = $tmp_log_cnt - $this->maximum_email_log_trace;

            if($tmp_buffer_delta<0){

                //
                // OUTPUT ALL.
                foreach($tmp_log_str_ARRAY as $key => $html_str_section){

                    $tmp_msg .= $html_str_section;

                }

            }else{

                //
                // ONLY OUTPUT TRAILING
                foreach($tmp_log_str_ARRAY as $key => $html_str_section){

                    if($key > $tmp_buffer_delta){

                        $tmp_msg .= $html_str_section;

                    }

                }

            }

            //
            // RETURN LOG TRACE STRING FOR HTML EMAIL
            return $tmp_msg;

        }

    }

    private function return_log_str_EMAIL_TEXT(){

        $tmp_log_str_ARRAY = array();

        //
        // BUILD LOG TRACE STRING FOR TEXT EMAIL
        $tmp_msg = '';
        foreach(self::$oCRNRSTN_n->oLog_output_ARRAY as $key => $oLog){

            if(is_object($oLog)) {

                //
                // GET LOG DATA - FIXED LENGTH
                $tmp_msg .=  $oLog->get_transactionTime();

                $tmp_runTime = $oLog->get_runTime();
                $tmp_msg .= ' [rtime ' . $tmp_runTime . ' secs]';

                //
                // GET LOG DATA - VARIABLE LENGTH
                $tmp_classMethod_raw = trim($oLog->get_classMethod());

                if($tmp_classMethod_raw == ''){

                    $tmp_runFile_raw = $oLog->get_runFile();
                    if($tmp_runFile_raw != ''){

                        $tmp_msg .= ' [file ' . $tmp_runFile_raw . ']';

                    }

                }else{

                    if($tmp_classMethod_raw!='') {

                        $tmp_msg .= ' [methd ' . $tmp_classMethod_raw . ']';

                    }

                }

                $tmp_lineNumber_raw = $oLog->get_lineNumber();
                if($tmp_lineNumber_raw!='') {

                    $tmp_msg .= ' [lnum ' . $tmp_lineNumber_raw . '] ';

                }

                $tmp_logMsg_raw = $oLog->get_logMsg();
                $tmp_log_str_ARRAY[] = $tmp_logMsg_raw . '

';
            }
        }

        if(count($tmp_log_str_ARRAY)<1) {

            if (isset(self::$oCRNRSTN_n->log_silo_profile)) {

                $tmp_condition = ' but, the restriction of log recording to the silo profile, (int) ' . self::$oCRNRSTN_n->log_silo_profile . ', seems to have reduced CRNRSTN :: trace output activity to NULL';

            } else {

                $tmp_condition = ' but, there appears to be no CRNRSTN :: trace output log data activity';

            }

            if (self::$oCRNRSTN_n->CRNRSTN_debug_mode() < 2) {

                $tmp_msg = '** The CRNRSTN :: configuration file debug mode of "' . self::$oCRNRSTN_n->CRNRSTN_debug_mode() . '" prevents aggregation of log trace data. **';

            } else {

                $tmp_msg = '** The CRNRSTN :: configuration file debug mode of "' . self::$oCRNRSTN_n->CRNRSTN_debug_mode() . '" allows aggregation of log trace data' . $tmp_condition . '. **';

            }

            //
            // RETURN LOG TRACE STRING FOR TEXT EMAIL
            return $tmp_msg;

        }

        $tmp_log_cnt = count($tmp_log_str_ARRAY);
        $tmp_buffer_delta = $tmp_log_cnt - $this->maximum_email_log_trace;

        if($tmp_buffer_delta<0){

            //
            // OUTPUT ALL.
            foreach($tmp_log_str_ARRAY as $key => $html_str_section){

                $tmp_msg .= $html_str_section;

            }

        }else{

            //
            // ONLY OUTPUT TRAILING
            foreach($tmp_log_str_ARRAY as $key => $html_str_section){

                if($key > $tmp_buffer_delta){

                    $tmp_msg .= $html_str_section;

                }

            }

        }

        //
        // RETURN LOG TRACE STRING FOR HTML EMAIL
        return $tmp_msg;

    }

    private function return_log_str_SCREEN_HTML($visible=true){

        if(!$visible){

            //
            // RETURN LOG TRACE STRING FOR BASIC SCREEN TEXT OUTPUT
            $output_channel = 'SCREEN_HTML_HIDDEN';
            $tmp_msg = '';
            $tmp_log_out = '';
            $line_break_char = '
';

            foreach(self::$oCRNRSTN_n->oLog_output_ARRAY as $key=>$oLog){

                if(is_object($oLog)){

                    $tmp_log_out .= $oLog->toTextConversion($line_break_char, 'TEXT', 79);

                }
            }

            if(strlen($tmp_log_out)>0){

                $tmp_msg = 'BEGIN LOG OUTPUT OF AGGREGATED ACTIVITY FROM SOURCE REQUESTING [' . $output_channel . '] :: EXCEPTION THROWN' . $line_break_char;
                $tmp_msg .= $tmp_log_out;
                $tmp_msg .= 'END LOG OUTPUT OF AGGREGATED ACTIVITY FROM SOURCE REQUESTING [' . $output_channel . '] :: EXCEPTION THROWN' . $line_break_char;

            }

            if(strlen($tmp_msg)<5) {

                if (isset(self::$oCRNRSTN_n->log_silo_profile)) {

                    $tmp_condition = ' but, the restriction of log recording to the silo profile, (int) ' . self::$oCRNRSTN_n->log_silo_profile . ', seems to have reduced C<span style="color:#F90000;">R</span>NRSTN :: trace output activity to NULL';

                } else {

                    $tmp_condition = ' but, there appears to be no C<span style="color:#F90000;">R</span>NRSTN :: trace output log data activity';

                }

                if (self::$oCRNRSTN_n->CRNRSTN_debug_mode() < 2) {

                    $tmp_msg = '** The CRNRSTN :: configuration file debug mode of "' . self::$oCRNRSTN_n->CRNRSTN_debug_mode() . '" prevents aggregation of log trace data. **
';

                } else {

                    $tmp_msg = '** The CRNRSTN :: configuration file debug mode of "' . self::$oCRNRSTN_n->CRNRSTN_debug_mode() . '" allows aggregation of log trace data' . $tmp_condition . '. **
';

                }

            }

            //
            // RETURN LOG TRACE STRING FOR SCREEN HTML HIDDEN
            return $tmp_msg;

        }else{

            //
            // RETURN LOG TRACE STRING FOR BASIC SCREEN HTML OUTPUT
            $output_channel = 'SCREEN or SCREEN_HTML';
            $tmp_msg = '';
            $tmp_log_out = '';
            $line_break_char = '<br>';

            foreach(self::$oCRNRSTN_n->oLog_output_ARRAY as $key=>$oLog){

                if(is_object($oLog)){

                    $tmp_log_out .= $oLog->toTextConversion($line_break_char, 'HTML', 110);

                }
            }

            if(strlen($tmp_log_out)>0){

                $tmp_msg = '<strong>BEGIN LOG OUTPUT OF AGGREGATED ACTIVITY FROM SOURCE REQUESTING [' . $output_channel . '] :: EXCEPTION THROWN</strong>';
                $tmp_msg .= '<div style="font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:23px; padding:10px;">' . $tmp_log_out . '</div>';
                $tmp_msg .= '<strong>END LOG OUTPUT OF AGGREGATED ACTIVITY FROM SOURCE REQUESTING [' . $output_channel . '] :: EXCEPTION THROWN</strong>' . $line_break_char;

            }

            if(strlen($tmp_msg)<5) {

                if (isset(self::$oCRNRSTN_n->log_silo_profile)) {

                    $tmp_condition = ' but, the restriction of log recording to the silo profile, (int) ' . self::$oCRNRSTN_n->log_silo_profile . ', seems to have reduced C<span style="color:#F90000;">R</span>NRSTN :: trace output activity to NULL';

                } else {

                    $tmp_condition = ' but, there appears to be no C<span style="color:#F90000;">R</span>NRSTN :: trace output log data activity';

                }

                if (self::$oCRNRSTN_n->CRNRSTN_debug_mode() < 2) {

                    $tmp_msg = '** The C<span style="color:#F90000;">R</span>NRSTN :: configuration file debug mode of "' . self::$oCRNRSTN_n->CRNRSTN_debug_mode() . '" prevents aggregation of log trace data. **
';

                } else {

                    $tmp_msg = '** The C<span style="color:#F90000;">R</span>NRSTN :: configuration file debug mode of "' . self::$oCRNRSTN_n->CRNRSTN_debug_mode() . '" allows aggregation of log trace data' . $tmp_condition . '. **
';
                }

            }

            //
            // RETURN LOG TRACE STRING FOR SCREEN or SCREEN_HTML
            return '<div style="font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:23px; padding:10px;">' . $tmp_msg . '</div>';

        }

    }

    private function return_log_str_SCREEN_TEXT(){

        //
        // RETURN LOG TRACE STRING FOR BASIC SCREEN TEXT OUTPUT
        $output_channel = 'SCREEN_TEXT';
        $tmp_msg = '';
        $tmp_log_out = '';
        $line_break_char = '
';

        foreach(self::$oCRNRSTN_n->oLog_output_ARRAY as $key=>$oLog){

            if(is_object($oLog)){

                $tmp_log_out .= $oLog->toTextConversion($line_break_char, 'SCREEN_TEXT', 74);

            }

        }

        $tmp_log_out = ltrim($tmp_log_out,'
');

        if(strlen($tmp_log_out)>0){

            //$tmp_msg = 'BEGIN LOG OUTPUT OF AGGREGATED ACTIVITY FROM SOURCE REQUESTING [' . $output_channel . '] :: EXCEPTION THROWN' . $line_break_char;
            $tmp_msg = $tmp_log_out;
            //$tmp_msg .= 'END LOG OUTPUT OF AGGREGATED ACTIVITY FROM SOURCE REQUESTING [' . $output_channel . '] :: EXCEPTION THROWN' . $line_break_char;

        }

        if(strlen($tmp_msg)<5) {

            if (isset(self::$oCRNRSTN_n->log_silo_profile)) {

                $tmp_condition = ' but, the restriction of log recording to the silo profile, (int) ' . self::$oCRNRSTN_n->log_silo_profile . ', seems to have reduced C<span style="color:#F90000;">R</span>NRSTN :: trace output activity to NULL';

            } else {

                $tmp_condition = ' but, there appears to be no C<span style="color:#F90000;">R</span>NRSTN :: trace output log data activity';

            }

            if (self::$oCRNRSTN_n->CRNRSTN_debug_mode() < 2) {

                $tmp_msg = '** The CRNRSTN :: configuration file debug mode of "' . self::$oCRNRSTN_n->CRNRSTN_debug_mode() . '" prevents aggregation of log trace data. **
';

            } else {

                $tmp_msg = '** The CRNRSTN :: configuration file debug mode of "' . self::$oCRNRSTN_n->CRNRSTN_debug_mode() . '" allows aggregation of log trace data' . $tmp_condition . '. **
';

            }

        }

        return $tmp_msg;

    }

    private function return_log_str_ERROR_LOG(){

        $tmp_log_str_ARRAY = array();

        //
        // RETURN LOG TRACE STRING FOR PHP ERROR_LOG PARAMETER
        $tmp_msg = '';
        foreach(self::$oCRNRSTN_n->oLog_output_ARRAY as $key=>$oLog){

            if(is_object($oLog)){

                $tmp_log_str_ARRAY[] = $oLog->toTextConversion(NULL, 'ERROR_LOG', 0, false);

            }

        }

        if(count($tmp_log_str_ARRAY)<1) {

            if (isset(self::$oCRNRSTN_n->log_silo_profile)) {

                $tmp_condition = ' but, the restriction of log recording to the silo profile, (int) ' . self::$oCRNRSTN_n->log_silo_profile . ', seems to have reduced CRNRSTN :: trace output activity to NULL';

            } else {

                $tmp_condition = ' but, there appears to be no CRNRSTN :: trace output log data activity';

            }

            if (self::$oCRNRSTN_n->CRNRSTN_debug_mode() < 2) {

                $tmp_msg = '** The CRNRSTN :: configuration file debug mode of "' . self::$oCRNRSTN_n->CRNRSTN_debug_mode() . '" prevents aggregation of log trace data. **';

            } else {

                $tmp_msg = '** The CRNRSTN :: configuration file debug mode of "' . self::$oCRNRSTN_n->CRNRSTN_debug_mode() . '" allows aggregation of log trace data' . $tmp_condition . '. **';

            }

            //
            // RETURN LOG TRACE STRING FOR PHP NATIVE ERROR_LOG
            return $tmp_msg;

        }else{

            $tmp_log_cnt = count($tmp_log_str_ARRAY);
            $tmp_buffer_delta = $tmp_log_cnt - $this->maximum_email_log_trace;

            if($tmp_buffer_delta<0){

                //
                // OUTPUT ALL.
                foreach($tmp_log_str_ARRAY as $key => $html_str_section){

                    $tmp_msg .= $html_str_section;

                }

            }else{

                //
                // ONLY OUTPUT TRAILING
                foreach($tmp_log_str_ARRAY as $key => $html_str_section){

                    if($key > $tmp_buffer_delta){

                        $tmp_msg .= $html_str_section;

                    }

                }

            }

            //
            // RETURN LOG TRACE STRING FOR HTML EMAIL
            return $tmp_msg;

        }

    }

    private function return_log_str_FILE($line_wrap){

        //
        // RETURN LOG TRACE STRING FOR CUSTOM FILE OUTPUT
        $tmp_msg = '';
        $line_break_char = '
';

        foreach(self::$oCRNRSTN_n->oLog_output_ARRAY as $key => $oLog){

            if(is_object($oLog)){

                $tmp_msg .= $oLog->toTextConversion($line_break_char, 'TEXT', $line_wrap);

            }

        }

        $tmp_condition='';
        $tmp_msg = trim($tmp_msg);
        if(strlen($tmp_msg)<5) {

            if (isset(self::$oCRNRSTN_n->log_silo_profile)) {

//
//                if ($pipe_pos !== false) {
//
//                    $tmp_silo_str = '';
//                    $tmp_silo_array = explode('|', self::$oCRNRSTN_n->log_silo_profile);
//                    $tmp_cnt = sizeof($tmp_silo_array);
//                    for ($i = 0; $i < $tmp_cnt; $i++) {
//                        $tmp_silo_str .= $tmp_silo_array[$i] . ' and ';
//                    }
//
//                    //
//                    // STRIP TRAILING AND
//                    $tmp_silo_str = rtrim($tmp_silo_str, ' and ');
//
//                    $tmp_condition = ' but, the restriction of log recording to the silos of ' . $tmp_silo_str . ' seems to have reduced C<span style="color:#F90000;">R</span>NRSTN :: trace output activity to NULL';
//
//                } else {

                    $tmp_condition = ' but, the restriction of log recording to the silo profile, (int) ' . self::$oCRNRSTN_n->log_silo_profile . ', seems to have reduced C<span style="color:#F90000;">R</span>NRSTN :: trace output activity to NULL';

                //}

            } else {

                $tmp_condition = ' but, there appears to be no C<span style="color:#F90000;">R</span>NRSTN :: trace output log data activity';

            }

            if (self::$oCRNRSTN_n->CRNRSTN_debug_mode() < 2) {

                $tmp_msg = '** The CRNRSTN :: configuration file debug mode of "' . self::$oCRNRSTN_n->CRNRSTN_debug_mode() . '" prevents aggregation of log trace data. **';

            } else {

                $tmp_msg = '** The CRNRSTN :: configuration file debug mode of "' . self::$oCRNRSTN_n->CRNRSTN_debug_mode() . '" allows aggregation of log trace data' . $tmp_condition . '. **';

            }

        }

        //
        // RETURN LOG TRACE STRING FOR FILE
        return $tmp_msg;

    }

    public function proper_replace($pattern, $replacement, $original_str){

        $pattern_array[0] = $pattern;
        $replacement_array[0] = $replacement;

        $original_str = str_replace($pattern_array, $replacement_array, $original_str);

        return $original_str;

    }

    public function __destruct() {

    }

}

# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: crnrstn_log
#  VERSION :: 1.00.0000
#  DATE :: Mon August 31, 2020 @ 0246hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION ::
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_log {

    private static $oCRNRSTN_n;
    protected $watch_key;
    protected $transaction_time;
    protected $silo_key_profile;
    protected $run_time;
    protected $run_file;
    protected $class_method;
    protected $line_number;
    protected $message;
    protected $is_devoted_to_destruction = false;
    protected $log_toTextStr_processed_ARRAY = array();

    public function __construct($oCRNRSTN_USR, $transactionTime, $log_silo_key_profile = CRNRSTN_LOG_ALL) {

        # $oCRNRSTN_n can be $oCRNRSTN or $oCRNRSTN_ENV or $oCRNRSTN_USR
        self::$oCRNRSTN_n = $oCRNRSTN_USR;
        $this->transaction_time = $transactionTime;
        $this->silo_key_profile = $log_silo_key_profile;
        $tmp_serial = self::$oCRNRSTN_n->generate_new_key(26);
        $this->watch_key = $this->transaction_time.$tmp_serial;
        self::$oCRNRSTN_n->elapsed_delta_time_for($this->watch_key);

    }

    public function expireLogData($oCRNRSTN_USR, $ttl){

        if($ttl<0){

            $this->__destruct();

        }else{

            //
            // COMPARE OBJECT WATCH SERIALIZATION TO TTL AND DESTROY IF BEYOND TTL
            if($oCRNRSTN_USR->elapsed_delta_time_for($this->watch_key) > (double) $ttl){

                $this->is_devoted_to_destruction = true;
                $this->__destruct();

            }

        }

    }

    public function get_siloKeyProfile(){

        return $this->silo_key_profile;

    }

    //public function toTextConversion($addBreakChar=NULL, $line_wrap=145, $isVisTransactionTime=true){
    public function toTextConversion($break_char = NULL, $output_type = 'ERROR_LOG', $line_wrap = 125, $isVisTransactionTime = true){

        if(isset($this->log_toTextStr_processed_ARRAY[$output_type])){

            return $this->log_toTextStr_processed_ARRAY[$output_type];

        }else{

            $tmp_out_processed = '';

            if(isset($break_char)){

                $tmp_linebreak = $break_char;

            }else{

                $tmp_linebreak = '';

            }

            //
            // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED...
            if($isVisTransactionTime){

                $tmp_transactionTime = $this->get_transactionTime();

            }else{

                $tmp_transactionTime = '';

            }

            $tmp_runTime = $this->get_runTime();
            $tmp_runFile_raw = $this->get_runFile();
            $tmp_classMethod_raw = $this->get_classMethod();
            $tmp_lineNumber_raw = $this->get_lineNumber();
            $tmp_logMsg_raw =  $this->get_logMsg();

            //
            // OUTPUT STRING ASSEMBLY
            $tmp_runTime = ' [rtime ' . $tmp_runTime . ']';

            if(isset($tmp_classMethod_raw)){

                if($tmp_classMethod_raw != ''){

                    $tmp_classMethodFile = ' [methd ' . $tmp_classMethod_raw . ']';

                }else{

                    if(isset($tmp_runFile_raw)){

                        if($tmp_runFile_raw != ''){

                            $tmp_classMethodFile = ' [file ' . $tmp_runFile_raw . ']';

                        }else{

                            $tmp_classMethodFile = '';

                        }

                    }else{

                        $tmp_classMethodFile = '';

                    }
                }

            }else{

                if(isset($tmp_runFile_raw)){

                    if($tmp_runFile_raw != ''){

                        $tmp_classMethodFile = ' [file ' . $tmp_runFile_raw . ']';

                    }else{

                        $tmp_classMethodFile = '';

                    }

                }else{

                    $tmp_classMethodFile = '';

                }

            }

            if(isset($tmp_lineNumber_raw)){

                if($tmp_lineNumber_raw != ''){

                    $tmp_lineNumber = ' [lnum ' . $tmp_lineNumber_raw . ']';

                }else{

                    $tmp_lineNumber = '';

                }

            }else{

                $tmp_lineNumber = '';

            }

            if(isset($tmp_logMsg_raw)){

                $tmp_logMsg = ' ' . $tmp_logMsg_raw;

            }

            $tmp_out_raw = $tmp_transactionTime.
                $tmp_runTime.
                $tmp_classMethodFile.
                $tmp_lineNumber.
                $tmp_logMsg;

            if(strlen($tmp_out_raw)>$line_wrap && $line_wrap > 0){

                //
                // RETURN LOG TRACE STRING FOR SCREEN TEXT
                if($tmp_linebreak != ''){

                    $tmp_out_raw = rtrim($tmp_out_raw, $tmp_linebreak);

                }

                $oChunkRestrictData = self::$oCRNRSTN_n->chunkPageData($tmp_out_raw, $line_wrap);

                switch($output_type){
                    case 'HTML':

                        $tmp_out_processed .= $oChunkRestrictData->return_linesString($output_type, '...');

                    break;
                    case 'TEXT':

                        //
                        // IDENTICAL TO SCREEN_TEXT
                        $output_type = 'SCREEN_TEXT';
                        $tmp_out_processed .= $oChunkRestrictData->return_linesString($output_type, '   ');

                    break;
                    case 'SCREEN_TEXT':

                        //
                        // CURRENTLY USED FOR TEXT VERSION OF MULTI-PART EMAIL AND SCREEN_TEXT OUTPUT
                        $tmp_out_processed .= $oChunkRestrictData->return_linesString($output_type, '   ');

                    break;
                    default:

                        //
                        // ERROR_LOG
                        $tmp_out_processed .= $tmp_out_raw;

                    break;

                }

            }else{

                $tmp_out_processed = $tmp_out_raw.$tmp_linebreak;

            }

            $this->log_toTextStr_processed_ARRAY[$output_type] = $tmp_out_processed;

        }

        return $tmp_out_processed;

    }

    public function get_transactionTime(){

        return $this->transaction_time;

    }

    public function set_runTime($str){

        $this->run_time = $str;

    }

    public function get_runTime(){

        if(isset($this->run_time)){

            return $this->run_time;

        }else{

            return NULL;

        }

    }

    public function set_runFile($str=NULL){

        if(isset($str)){

            $this->run_file = $str;

        }

    }

    public function get_runFile(){

        if(isset($this->run_file)){

            return $this->run_file;

        }else{

            return NULL;

        }

    }

    public function set_classMethod($str=NULL){

        if(isset($str)){

            $this->class_method = $str;

        }
    }

    public function get_classMethod(){

        if(isset($this->class_method)){

            return $this->class_method;

        }else{

            return NULL;

        }

    }

    public function set_lineNumber($str=NULL){

        if(isset($str)){

            $this->line_number = $str;

        }

    }

    public function get_lineNumber(){

        if(isset($this->line_number)){

            return $this->line_number;

        }else{

            return NULL;

        }

    }

    public function set_logMsg($str=''){

        $this->message = $str;

    }

    public function get_logMsg(){

        if(isset($this->message)){

            return $this->message;

        }else{

            return NULL;

        }

    }

    public function __destruct() {

    }

}