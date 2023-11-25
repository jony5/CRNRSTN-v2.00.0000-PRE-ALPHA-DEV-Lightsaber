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
#  DATE :: Monday, August 31, 2020 @ 0246hrs
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

    public function __construct($oCRNRSTN_USR, $transactionTime, $log_silo_key_profile = CRNRSTN_LOG_ALL){

        # $oCRNRSTN_n can be $oCRNRSTN or $oCRNRSTN_ENV or $oCRNRSTN_USR
        self::$oCRNRSTN_n = $oCRNRSTN_USR;
        $this->transaction_time = $transactionTime;
        $this->silo_key_profile = $log_silo_key_profile;
        $tmp_serial = self::$oCRNRSTN_n->generate_new_key(26);
        $this->watch_key = $this->transaction_time.$tmp_serial;
        self::$oCRNRSTN_n->elapsed_delta_time($this->watch_key);

    }

    public function expireLogData($oCRNRSTN_USR, $ttl){

        if($ttl<0){

            $this->__destruct();

        }else{

            //
            // COMPARE OBJECT WATCH SERIALIZATION TO TTL AND DESTROY IF BEYOND TTL
            if($oCRNRSTN_USR->elapsed_delta_time($this->watch_key) > (double) $ttl){

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

    public function __destruct(){

    }

}