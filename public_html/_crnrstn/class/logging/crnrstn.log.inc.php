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
#  CLASS :: crnrstn_log
#  VERSION :: 1.00.0000
#  DATE :: Monday, August 31, 2020 @ 0246hrs.
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION ::
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_log {

    public $oCRNRSTN;

    private static $serial;
    private static $watch_key;
    private static $transaction_time;
    private static $silo_profile_ARRAY = array();
    private static $run_time;
    private static $run_file;
    private static $class_method;
    private static $line_number;
    private static $message;
    private static $is_devoted_to_destruction = false;
    private static $log_toTextStr_processed_ARRAY = array();

    public function __construct($oCRNRSTN, $transaction_time, $log_silo_profile = NULL){

        $this->oCRNRSTN = $oCRNRSTN;

        self::$transaction_time = $transaction_time;
        self::$serial = $this->oCRNRSTN->generate_new_key(64, NULL, true);
        self::$watch_key = self::$transaction_time . '::' . self::$serial;

        if(!isset($log_silo_profile)){

            self::$silo_profile_ARRAY = array(CRNRSTN_LOG_ALL => CRNRSTN_LOG_ALL);

        }else{

            $tmp_type = $this->oCRNRSTN->gettype($log_silo_profile, CRNRSTN_INTEGER);
            switch($tmp_type){
                case CRNRSTN_INT:
                case CRNRSTN_INTEGER:

                    self::$silo_profile_ARRAY = array($log_silo_profile => 1);

                break;
                case CRNRSTN_STRING:

                    self::$silo_profile_ARRAY = array($log_silo_profile => 1);

                break;
                default:

                    self::$silo_profile_ARRAY = array(strval($log_silo_profile) => 1);

                break;

            }

        }

        $this->oCRNRSTN->elapsed_delta_time(self::$watch_key);

    }

    public function serial(){

        return self::$serial;

    }

    public function expireLogData($oCRNRSTN, $ttl){

        if($ttl < 0){

            $this->__destruct();

        }else{

            //
            // COMPARE OBJECT WATCH SERIALIZATION TO TTL AND DESTROY IF BEYOND TTL
            if($oCRNRSTN->elapsed_delta_time(self::$watch_key) > (double) $ttl){

                self::$is_devoted_to_destruction = true;
                $this->__destruct();

            }

        }

    }

    public function return_silo_profile_array(){

        return self::$silo_profile_ARRAY;

    }

    //public function toTextConversion($addBreakChar=NULL, $line_wrap=145, $isVisTransactionTime=true){
    public function toTextConversion($break_char = NULL, $output_type = 'ERROR_LOG', $line_wrap = 125, $isVisTransactionTime = true){

        if(isset(self::$log_toTextStr_processed_ARRAY[$output_type])){

            return self::$log_toTextStr_processed_ARRAY[$output_type];

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

                $oChunkRestrictData = $this->oCRNRSTN->chunkPageData($tmp_out_raw, $line_wrap);

                //
                // CRNRSTN_LOG_EMAIL, CRNRSTN_LOG_EMAIL_PROXY, CRNRSTN_LOG_FILE, CRNRSTN_LOG_FILE_PROXY,
                // CRNRSTN_LOG_FILE_FTP, CRNRSTN_LOG_FILE_FTP_PROXY, CRNRSTN_LOG_SCREEN_TEXT, CRNRSTN_LOG_SCREEN,
                // CRNRSTN_LOG_SCREEN_HTML, CRNRSTN_LOG_SCREEN_HTML_HIDDEN, CRNRSTN_LOG_DEFAULT,
                // CRNRSTN_LOG_DEFAULT_PROXY, CRNRSTN_LOG_ELECTRUM, CRNRSTN_LOG_ELECTRUM_PROXY, CRNRSTN_LOG_DATABASE,
                // CRNRSTN_LOG_DATABASE_PROXY, CRNRSTN_LOG_SSDTLA, CRNRSTN_LOG_SSDTLA_PROXY, CRNRSTN_LOG_PSSDTLA,
                // CRNRSTN_LOG_PSSDTLA_PROXY, CRNRSTN_LOG_SOAP
                //
                // Wednesday, December 6, 2023 @ 0201 hrs.
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

            self::$log_toTextStr_processed_ARRAY[$output_type] = $tmp_out_processed;

        }

        return $tmp_out_processed;

    }

    public function get_transactionTime(){

        return self::$transaction_time;

    }

    public function set_runTime($str){

        self::$run_time = $str;

    }

    public function get_runTime(){

        if(isset(self::$run_time)){

            return self::$run_time;

        }else{

            return NULL;

        }

    }

    public function set_runFile($str=NULL){

        if(isset($str)){

            self::$run_file = $str;

        }

    }

    public function get_runFile(){

        if(isset(self::$run_file)){

            return self::$run_file;

        }else{

            return NULL;

        }

    }

    public function set_classMethod($str = NULL){

        if(isset($str)){

            self::$class_method = $str;

        }

    }

    public function get_classMethod(){

        if(isset(self::$class_method)){

            return self::$class_method;

        }else{

            return NULL;

        }

    }

    public function set_lineNumber($str = NULL){

        if(isset($str)){

            self::$line_number = $str;

        }

    }

    public function get_lineNumber(){

        if(isset(self::$line_number)){

            return self::$line_number;

        }else{

            return NULL;

        }

    }

    public function set_logMsg($str = ''){

        self::$message = $str;

    }

    public function get_logMsg(){

        if(isset(self::$message)){

            return self::$message;

        }else{

            return NULL;

        }

    }

    public function __destruct(){

    }

}