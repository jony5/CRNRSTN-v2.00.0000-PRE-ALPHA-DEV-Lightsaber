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
#  CLASS :: crnrstn_log_output_manager
#  VERSION :: 1.00.0000
#  DATE :: Monday, September 9, 2020 @ 2340hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION ::
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_log_output_manager {

    protected $oLogger;
    private static $oCRNRSTN_n;

    public $maximum_email_log_trace = 23;   // REGULATE MAXIMUM LOG TRACE OUTPUT TO EMAIL & ERROR_LOG

    public function __construct($oCRNRSTN_n){

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
            switch($output_profile){
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

                    if($tmp_classMethod_raw != ''){

                        $tmp_chunkstr_raw .= '[methd ' . $tmp_classMethod_raw . ']';

                    }

                }

                $tmp_lineNumber_raw = $oLog->get_lineNumber();

                if($tmp_lineNumber_raw != ''){

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

        if(count($tmp_log_str_ARRAY)<1){

            if(isset(self::$oCRNRSTN_n->log_silo_profile)){

                $tmp_condition = ' but, the restriction of log recording to the silo profile, (int) ' . self::$oCRNRSTN_n->log_silo_profile . ', seems to have reduced C<span style="color:#F90000;">R</span>NRSTN :: trace output activity to NULL';

            }else{

                $tmp_condition = ' but, there appears to be no C<span style="color:#F90000;">R</span>NRSTN :: trace output log data activity';

            }

            if(self::$oCRNRSTN_n->CRNRSTN_debug_mode() < 2){

                $tmp_msg = '** The C<span style="color:#F90000;">R</span>NRSTN :: configuration file debug mode of "' . self::$oCRNRSTN_n->CRNRSTN_debug_mode() . '" prevents aggregation of log trace data. **';

            }else{

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

            if(is_object($oLog)){

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

                    if($tmp_classMethod_raw!=''){

                        $tmp_msg .= ' [methd ' . $tmp_classMethod_raw . ']';

                    }

                }

                $tmp_lineNumber_raw = $oLog->get_lineNumber();
                if($tmp_lineNumber_raw!=''){

                    $tmp_msg .= ' [lnum ' . $tmp_lineNumber_raw . '] ';

                }

                $tmp_logMsg_raw = $oLog->get_logMsg();
                $tmp_log_str_ARRAY[] = $tmp_logMsg_raw . '

';
            }

        }

        if(count($tmp_log_str_ARRAY)<1){

            if(isset(self::$oCRNRSTN_n->log_silo_profile)){

                $tmp_condition = ' but, the restriction of log recording to the silo profile, (int) ' . self::$oCRNRSTN_n->log_silo_profile . ', seems to have reduced CRNRSTN :: trace output activity to NULL';

            }else{

                $tmp_condition = ' but, there appears to be no CRNRSTN :: trace output log data activity';

            }

            if(self::$oCRNRSTN_n->CRNRSTN_debug_mode() < 2){

                $tmp_msg = '** The CRNRSTN :: configuration file debug mode of "' . self::$oCRNRSTN_n->CRNRSTN_debug_mode() . '" prevents aggregation of log trace data. **';

            }else{

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

            if(strlen($tmp_msg)<5){

                if(isset(self::$oCRNRSTN_n->log_silo_profile)){

                    $tmp_condition = ' but, the restriction of log recording to the silo profile, (int) ' . self::$oCRNRSTN_n->log_silo_profile . ', seems to have reduced C<span style="color:#F90000;">R</span>NRSTN :: trace output activity to NULL';

                }else{

                    $tmp_condition = ' but, there appears to be no C<span style="color:#F90000;">R</span>NRSTN :: trace output log data activity';

                }

                if(self::$oCRNRSTN_n->CRNRSTN_debug_mode() < 2){

                    $tmp_msg = '** The CRNRSTN :: configuration file debug mode of "' . self::$oCRNRSTN_n->CRNRSTN_debug_mode() . '" prevents aggregation of log trace data. **
';

                }else{

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

            if(strlen($tmp_msg)<5){

                if(isset(self::$oCRNRSTN_n->log_silo_profile)){

                    $tmp_condition = ' but, the restriction of log recording to the silo profile, (int) ' . self::$oCRNRSTN_n->log_silo_profile . ', seems to have reduced C<span style="color:#F90000;">R</span>NRSTN :: trace output activity to NULL';

                }else{

                    $tmp_condition = ' but, there appears to be no C<span style="color:#F90000;">R</span>NRSTN :: trace output log data activity';

                }

                if(self::$oCRNRSTN_n->CRNRSTN_debug_mode() < 2){

                    $tmp_msg = '** The C<span style="color:#F90000;">R</span>NRSTN :: configuration file debug mode of "' . self::$oCRNRSTN_n->CRNRSTN_debug_mode() . '" prevents aggregation of log trace data. **
';

                }else{

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

        if(strlen($tmp_msg)<5){

            if(isset(self::$oCRNRSTN_n->log_silo_profile)){

                $tmp_condition = ' but, the restriction of log recording to the silo profile, (int) ' . self::$oCRNRSTN_n->log_silo_profile . ', seems to have reduced C<span style="color:#F90000;">R</span>NRSTN :: trace output activity to NULL';

            }else{

                $tmp_condition = ' but, there appears to be no C<span style="color:#F90000;">R</span>NRSTN :: trace output log data activity';

            }

            if(self::$oCRNRSTN_n->CRNRSTN_debug_mode() < 2){

                $tmp_msg = '** The CRNRSTN :: configuration file debug mode of "' . self::$oCRNRSTN_n->CRNRSTN_debug_mode() . '" prevents aggregation of log trace data. **
';

            }else{

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

        if(count($tmp_log_str_ARRAY)<1){

            if(isset(self::$oCRNRSTN_n->log_silo_profile)){

                $tmp_condition = ' but, the restriction of log recording to the silo profile, (int) ' . self::$oCRNRSTN_n->log_silo_profile . ', seems to have reduced CRNRSTN :: trace output activity to NULL';

            }else{

                $tmp_condition = ' but, there appears to be no CRNRSTN :: trace output log data activity';

            }

            if(self::$oCRNRSTN_n->CRNRSTN_debug_mode() < 2){

                $tmp_msg = '** The CRNRSTN :: configuration file debug mode of "' . self::$oCRNRSTN_n->CRNRSTN_debug_mode() . '" prevents aggregation of log trace data. **';

            }else{

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
        if(strlen($tmp_msg)<5){

            if(isset(self::$oCRNRSTN_n->log_silo_profile)){

//
//                if($pipe_pos !== false){
//
//                    $tmp_silo_str = '';
//                    $tmp_silo_array = explode('|', self::$oCRNRSTN_n->log_silo_profile);
//                    $tmp_cnt = sizeof($tmp_silo_array);
//                    for ($i = 0; $i < $tmp_cnt; $i++){
//                        $tmp_silo_str .= $tmp_silo_array[$i] . ' and ';
//                    }
//
//                    //
//                    // STRIP TRAILING AND
//                    $tmp_silo_str = rtrim($tmp_silo_str, ' and ');
//
//                    $tmp_condition = ' but, the restriction of log recording to the silos of ' . $tmp_silo_str . ' seems to have reduced C<span style="color:#F90000;">R</span>NRSTN :: trace output activity to NULL';
//
//                }else{

                $tmp_condition = ' but, the restriction of log recording to the silo profile, (int) ' . self::$oCRNRSTN_n->log_silo_profile . ', seems to have reduced C<span style="color:#F90000;">R</span>NRSTN :: trace output activity to NULL';

                //}

            }else{

                $tmp_condition = ' but, there appears to be no C<span style="color:#F90000;">R</span>NRSTN :: trace output log data activity';

            }

            if(self::$oCRNRSTN_n->CRNRSTN_debug_mode() < 2){

                $tmp_msg = '** The CRNRSTN :: configuration file debug mode of "' . self::$oCRNRSTN_n->CRNRSTN_debug_mode() . '" prevents aggregation of log trace data. **';

            }else{

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

    public function __destruct(){

    }

}