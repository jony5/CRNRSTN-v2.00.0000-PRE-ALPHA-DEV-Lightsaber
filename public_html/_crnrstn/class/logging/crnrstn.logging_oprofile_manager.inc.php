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
#  CLASS :: crnrstn_logging_oprofile_manager
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: Monday, October 26, 2020 @ 2054hrs
#  DESCRIPTION :: Object manager for CRNRSTN :: LOGGING WEB SERVICES LAYER.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_logging_oprofile_manager {

    public $oCRNRSTN;

    protected $env_key;
    protected $resource_key;
    private static $config_serial;

    protected $oLog_profiles_ARRAY = array();
    protected $log_profiles_ARRAY = array();
    protected $logging_profile_pack;

    protected $profile_endpoint_criteria_ARRAY = array();

    public function __construct($sys_logging_profile_pack, $oCRNRSTN){

        $this->oCRNRSTN = $oCRNRSTN;

        /*
        $sys_logging_profile_pack['sys_logging_profile_ARRAY'] = ARRAY[$this->oCRNRSTN->hash(self::$config_serial)][self::$resource_key];
        $sys_logging_profile_pack['sys_logging_meta_ARRAY'] = ARRAY[$this->oCRNRSTN->hash(self::$config_serial)][self::$resource_key];
        $sys_logging_profile_pack['sys_logging_wcr_ARRAY'] = ARRAY[$this->oCRNRSTN->hash(self::$config_serial)][CRNRSTN_LOG_ALL];
        */

        self::$config_serial = $this->oCRNRSTN->get_crnrstn('config_serial');

        // HOLD ON A SEC FOR THIS. Thursday, May 25, 2023 @ 1450 hrs.
        //$this->oCRNRSTN_WCR_ARRAY = $this->oCRNRSTN->return_wcr_ARRAY(); //oCRNRSTN_WCR_ARRAY;
        $this->oCRNRSTN_WCR_ARRAY  = array();

        $this->build_sys_wcr_profile_criteria();

        $this->load_system_profiles();

        $this->logging_profile_pack = $sys_logging_profile_pack;

        $this->spool_up_logging_profiles();

        // $this->oCRNRSTN->oLog_output_ARRAY[] = $this->oCRNRSTN->error_log('Instantiating logging output profile manager within this environment.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

    }

    public function return_wcr_ARRAY(){

        return $this->oCRNRSTN_WCR_ARRAY;

    }

    public function return_olog_profile($profile_key){

        foreach($this->oLog_profiles_ARRAY as $key => $oLog_profile){

            if($oLog_profile->isValid){

                error_log(__LINE__ . ' env VALID log profile [' . $profile_key . '][' . $key . '][' . $oLog_profile->logging_profile . ']');
                if($profile_key == $oLog_profile->logging_profile){

                    return $oLog_profile;

                }

            }else{

                error_log(__LINE__ . ' env !INVALID! log profile [' . $profile_key . '][' . $key . '][' . $oLog_profile->logging_profile . ']');

            }
        }

        return false;

    }

    //
    // SOURCE :: https://www.youtube.com/watch?v=83KR_UBWdPI
    // TITLE :: Arcade Fire - No Cars Go
    //
    // Saturday, December 2, 2023 @ 0620 hrs.
    public function notification_go($tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj){

        foreach($this->oLog_profiles_ARRAY as $key => $oLog_profile){

            if($this->oCRNRSTN->is_bit_set($oLog_profile->logging_profile) == true){

                //
                // SOURCE :: https://www.youtube.com/watch?v=83KR_UBWdPI
                // TITLE :: Arcade Fire - No Cars Go
                //
                // 2020[?] MORE ACCURATE SOURCE NEEDED FOR THIS PRE-LIGHTSABER COMMENT.
                if(!$oLog_profile->no_cars_tification_go($this->oCRNRSTN, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj)){

                    error_log('Error processing the following message through logging profile (int) ' . $oLog_profile->logging_profile . '. :: ' . $tmp_exception_output_str);

                    die();

                }

            }

        }

    }

    private function build_sys_wcr_profile_criteria(){

        $this->profile_endpoint_criteria_ARRAY = array();

        //
        // EMAIL.
        $log_profile_key = CRNRSTN_LOG_EMAIL;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['EMAIL_PROTOCOL'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['TRY_OTHER_EMAIL_METHODS_ON_ERR'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_AUTH'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_SERVER'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_PORT_OUTGOING'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_USERNAME'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_PASSWORD'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_TIMEOUT'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_KEEPALIVE'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_SECURE'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_AUTOTLS'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_AUTOTLS'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['DIBYA_SAHOO_SSL_CERT_BYPASS'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SENDMAIL_PATH'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['USE_SENDMAIL_OPTIONS'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['ALLOW_EMPTY'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FROM_NAME'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['REPLYTO_NAME_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CC_NAME_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['BCC_NAME_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['RECIPIENTS_NAME_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FROM_EMAIL'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['REPLYTO_EMAIL_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CC_EMAIL_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['BCC_EMAIL_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['RECIPIENTS_EMAIL_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SUBJECT_LINE'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['MESSAGE_BODY_HTML'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['MESSAGE_BODY_TEXT'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['WORDWRAP'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['ISHTML'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['PRIORITY'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CHARSET'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['MESSAGE_ENCODING'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['DUP_SUPPRESS'] = 1;

        //
        // EMAIL_PROXY.
        $log_profile_key = CRNRSTN_LOG_EMAIL_PROXY;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CRNRSTN_SOAP_SVC_AUTH_KEY'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CRNRSTN_SOAP_SVC_USERNAME'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CRNRSTN_SOAP_SVC_PASSWORD'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CRNRSTN_SOAP_SVC_ENCRYPTION_KEY'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_SECRET_KEY_CONNECTION'] = 1;

        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOA_NAMESPACE'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['WSDL_URI'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['WSDL_CACHE_TTL'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['NUSOAP_USECURL'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_CIPHER'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_OPTIONS'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_HMAC_ALG'] = 1;

        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['EMAIL_PROTOCOL'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['TRY_OTHER_EMAIL_METHODS_ON_ERR'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_AUTH'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_SERVER'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_PORT_OUTGOING'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_USERNAME'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_PASSWORD'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_TIMEOUT'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_KEEPALIVE'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_SECURE'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_AUTOTLS'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_AUTOTLS'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['DIBYA_SAHOO_SSL_CERT_BYPASS'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SENDMAIL_PATH'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['USE_SENDMAIL_OPTIONS'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['ALLOW_EMPTY'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FROM_NAME'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['REPLYTO_NAME_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CC_NAME_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['BCC_NAME_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['RECIPIENTS_NAME_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FROM_EMAIL'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['REPLYTO_EMAIL_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CC_EMAIL_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['BCC_EMAIL_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['RECIPIENTS_EMAIL_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SUBJECT_LINE'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['MESSAGE_BODY_HTML'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['MESSAGE_BODY_TEXT'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['WORDWRAP'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['ISHTML'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['PRIORITY'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CHARSET'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['MESSAGE_ENCODING'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['DUP_SUPPRESS'] = 1;

        //
        // FILE.
        $log_profile_key = CRNRSTN_LOG_FILE;
        //$this->profile_endpoint_criteria_ARRAY[$log_profile_key]['LOCAL_DIR_PATH'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['LOCAL_DIR_FILEPATH'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['LOCAL_MKDIR_MODE'] = 1;

        //
        // FTP.
        $log_profile_key = CRNRSTN_LOG_FILE_FTP;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_SERVER'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_USERNAME'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_PASSWORD'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_PORT'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_TIMEOUT'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_IS_SSL'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_USE_PASV'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_USE_PASV_ADDR'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_DISABLE_AUTOSEEK'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_DIR_PATH'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_MKDIR_MODE'] = 1;

        //
        // OPEN_SOURCE.
        $log_profile_key = CRNRSTN_RESOURCE_OPENSOURCE;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CRNRSTN_SOAP_SVC_AUTH_KEY'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CRNRSTN_SOAP_SVC_USERNAME'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CRNRSTN_SOAP_SVC_PASSWORD'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOA_NAMESPACE'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['WSDL_URI'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['WSDL_CACHE_TTL'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['NUSOAP_USECURL'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CRNRSTN_SOAP_SVC_ENCRYPTION_KEY'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_SECRET_KEY_CONNECTION'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_CIPHER'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_OPTIONS'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_HMAC_ALG'] = 1;

        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['ZIPCODE'] = 1;


        //
        // XXXXX
        //$log_profile_key = 'XXXXX';
        //$this->profile_endpoint_criteria_ARRAY[$log_profile_key]['PORT'] = 1;
        //$this->profile_endpoint_criteria_ARRAY[$log_profile_key]['USERNAME'] = 1;
        //$this->profile_endpoint_criteria_ARRAY[$log_profile_key]['PASSWORD'] = 1;

    }

    private function is_WCR_key($sys_logging_wcr_ARRAY, $str){

        //if(isset($this->oCRNRSTN_WCR_ARRAY)){
        // error_log('2448 env - is_WCR_key() TEST NEW !!ARRAY FORK AGAINST ARRAY sizeof>0, where sizeof='.sizeof($this->oCRNRSTN_WCR_ARRAY[$this->oCRNRSTN->hash(self::$config_serial)]));

        //
        // TODO :: CAN WE PUT THIS ARRAY TRICK EVERYWHERE IT IS APPROPRIATE? IS IT FASTER THAN -->{ if(count() > 0)...?
        // SOURCE :: https://www.php.net/manual/en/language.types.boolean.php
        // AUTHOR :: artktec at gmail dot com :: https://www.php.net/manual/en/language.types.boolean.php#78099
        // This can be a substitute for count($array) > 0 or !(empty($array)) to check to see if an array is empty or not (you would use: !!$array).
        if(!!$sys_logging_wcr_ARRAY){

            foreach($sys_logging_wcr_ARRAY as $key0 => $chunkArray0){

                foreach($chunkArray0 as $key => $oWCR){

                    if($str == $oWCR->return_resource_key()){

                        return $oWCR;

                    }

                }

            }

        }

        return false;

    }

    # EMAIL, E@E.COM, FALSE
    # EMAIL, WCR_KEY, TRUE
    private function oLog_profile_endpoint_update($profile, $value, $oWCR = NULL){

        foreach($this->oLog_profiles_ARRAY as $key => $oLog_profile){

            if($profile == $oLog_profile->return_profile()){

                //
                // WCR?
                if(is_object($oWCR)){

                    switch($profile){
                        case CRNRSTN_LOG_EMAIL:

                            error_log(__LINE__ . ' env - RUN receive_profile_EMAIL_WCR() ' . $oLog_profile->return_profile());

                            //
                            // ADD WCR DATA TO oLog_profile
                            $oLog_profile->receive_profile_EMAIL_WCR($oWCR, $value);
                            $oLog_profile->isValid = true;

                        break;
                        case CRNRSTN_LOG_EMAIL_PROXY:

                            error_log(__LINE__ . ' env - RUN receive_profile_EMAIL_PROXY_WCR() ' . $oLog_profile->return_profile());

                            $oLog_profile->receive_profile_EMAIL_PROXY_WCR($oWCR, $value);
                            $oLog_profile->isValid = true;

                        break;
                        case CRNRSTN_LOG_FILE_FTP:

                            error_log(__LINE__ . ' env - RUN receive_profile_FTP_WCR() ' . $oLog_profile->return_profile());

                            $oLog_profile->receive_profile_FTP_WCR($oWCR, $value);
                            $oLog_profile->isValid = true;

                        break;
                        case CRNRSTN_LOG_FILE:

                            //error_log(__LINE__ . ' env - RUN receive_profile_FILE_WCR() [' . $value . '] ' . $oLog_profile->return_profile());

                            $oLog_profile->receive_profile_FILE_WCR($oWCR, $value);
                            $oLog_profile->isValid = true;
                            //error_log(__LINE__ .' env - WE RAN receive_profile_FILE_WCR() ['.$value . ']');

                        break;
                        case CRNRSTN_RESOURCE_OPENSOURCE:

                            error_log(__LINE__ . ' env - RUN receive_profile_RESOURCE_OPENSOURCE_WCR() ' . $oLog_profile->return_profile());

                            $oLog_profile->receive_profile_RESOURCE_OPENSOURCE_WCR($oWCR, $value);
                            $oLog_profile->isValid = true;

                        break;

                    }

                }else{

                    //
                    // ADD RAW DATA TO oLog_profile
                    switch($profile){
                        case CRNRSTN_LOG_EMAIL:
                        case CRNRSTN_LOG_EMAIL_PROXY:

                            error_log(__LINE__ . ' env - RUN receive_profile_EMAIL() ' . $oLog_profile->return_profile());

                            //
                            // ADD DATA TO oLog_profile
                            $oLog_profile->receive_profile_EMAIL($value, 'RECIPIENTS_EMAIL_PIPED');
                            $oLog_profile->isValid = true;

                        break;
                        case CRNRSTN_LOG_FILE:

                            error_log(__LINE__ . ' env - RUN receive_profile_FILE() ' . $oLog_profile->return_profile());

                            $oLog_profile->receive_profile_FILE($value);
                            $oLog_profile->isValid = true;

                        break;

                    }

                }

            }

        }

        return true;

    }

    public function consume_init_profile_pack($init_profile_pack){

        /*
        init_profile_pack_ARRAY ::
        $init_profile_pack['sys_logging_profile_ARRAY'] = self::$system_logging_output_profile_ARRAY[$this->oCRNRSTN->hash(self::$config_serial)][CRNRSTN_LOG_ALL];
        $init_profile_pack['sys_logging_meta_ARRAY'] = self::$sys_logging_meta_ARRAY[$this->oCRNRSTN->hash(self::$config_serial)][CRNRSTN_LOG_ALL];
        $init_profile_pack['sys_logging_wcr_ARRAY'] = $this->oCRNRSTN_WCR_ARRAY[$this->oCRNRSTN->hash(self::$config_serial)][CRNRSTN_LOG_ALL];
        */

        if(isset($init_profile_pack['sys_logging_meta_ARRAY'])){

            foreach($init_profile_pack['sys_logging_meta_ARRAY'] as $key => $value){

                //error_log(__LINE__ . ' env - HOW MANY META DATA PROCESS? [' . $init_profile_pack['sys_logging_meta_ARRAY'][$key] . '] FOR DATA ' . $value);
                //error_log(__LINE__ . ' env - (int) ' . print_r($init_profile_pack['sys_logging_profile_ARRAY'][$key], true) . ' HANDLE META VALUE ' . print_r($value, true));

                switch($init_profile_pack['sys_logging_profile_ARRAY'][$key]){
                    case CRNRSTN_LOG_EMAIL:

                        $pos_at = strpos($value, '@');

                        //error_log(__LINE__ . ' env [' . get_class() . '] ping. wcr=' . print_r($this->oCRNRSTN_WCR_ARRAY, true));
                        if($pos_at !== false){

//                            if($this->is_WCR_key($value)){

//                                error_log(__LINE__ . ' env [' . get_class() . '] ping.');
//                                //
//                                // PROCESS FOR WCR
//                                $tmp_oWCR = $this->is_WCR_key($value);
//                                if(is_array($tmp_oWCR)){
//
//                                    foreach($tmp_oWCR as $wcr_key => $oWCR){
//
//                                        if($value == $oWCR->return_resource_key()){
//
//                                            //
//                                            // PROCESS FOR WCR
//                                            error_log(__LINE__ . ' env - PROCESS[' . $init_profile_pack['sys_logging_meta_ARRAY'][$key] . '] FOR WCR ' . $value);
//                                            $this->oLog_profile_endpoint_update($init_profile_pack['sys_logging_meta_ARRAY'][$key], $value, $oWCR);
//
//                                        }
//
//                                    }
//
//                                }
//
//                                error_log(__LINE__ . ' env [' . get_class() . '] ping.');
//
//                            }

                            //else{

                            //
                            // PROCESS FOR EMAIL ADDRESS
                            //error_log(__LINE__ . ' env - PROCESS['.$init_profile_pack['sys_logging_meta_ARRAY'][$key] . '] FOR EMAIL_ADDR ' . $value);
                            $this->oLog_profile_endpoint_update($init_profile_pack['sys_logging_profile_ARRAY'][$key], $value);

                            //}

                        }else{

                            $tmp_oWCR = $this->is_WCR_key($init_profile_pack['sys_logging_wcr_ARRAY'], $value);

                            if(is_object($tmp_oWCR)){

                                error_log(__LINE__ . ' env - PROCESS[' . $init_profile_pack['sys_logging_meta_ARRAY'][$key] . '] FOR WCR ' . $value);

                                $this->oLog_profile_endpoint_update($init_profile_pack['sys_logging_profile_ARRAY'][$key], $value, $tmp_oWCR);

                            }

                        }

                    break;
                    case CRNRSTN_LOG_EMAIL_PROXY:

                        $pos_at = strpos($value, '@');
                        if($pos_at !== false){

                            //
                            // PROCESS FOR EMAIL ADDRESS
                            //error_log(__LINE__ . ' env - PROCESS[' . $init_profile_pack['sys_logging_meta_ARRAY'][$key] . '] FOR EMAIL_ADDR ' . $value);
                            $this->oLog_profile_endpoint_update($init_profile_pack['sys_logging_profile_ARRAY'][$key], $value);

                        }else{

                            $tmp_oWCR = $this->is_WCR_key($init_profile_pack['sys_logging_wcr_ARRAY'], $value);

                            if(is_object($tmp_oWCR)){

                                error_log(__LINE__ . ' env - PROCESS[' . $init_profile_pack['sys_logging_meta_ARRAY'][$key] . '] FOR WCR ' . $value);

                                $this->oLog_profile_endpoint_update($init_profile_pack['sys_logging_profile_ARRAY'][$key], $value, $tmp_oWCR);

                            }

                        }

                    break;
                    case CRNRSTN_LOG_FILE:
                    case CRNRSTN_RESOURCE_OPENSOURCE:

                        $tmp_oWCR = $this->is_WCR_key($init_profile_pack['sys_logging_wcr_ARRAY'], $value);

                        if(is_object($tmp_oWCR)){

                            error_log(__LINE__ . ' env - PROCESS[' . $init_profile_pack['sys_logging_meta_ARRAY'][$key] . '] FOR WCR ' . $value);
                            $this->oLog_profile_endpoint_update($init_profile_pack['sys_logging_profile_ARRAY'][$key], $value, $tmp_oWCR);

                        }else{

                            error_log(__LINE__ . ' env - PROCESS[' . $init_profile_pack['sys_logging_meta_ARRAY'][$key] . '] FOR PATH ' . $value);
                            $this->oLog_profile_endpoint_update($init_profile_pack['sys_logging_profile_ARRAY'][$key], $value);

                        }

                    break;
//                    case CRNRSTN_RESOURCE_OPENSOURCE:
//
//                        $tmp_oWCR = $this->is_WCR_key($init_profile_pack['sys_logging_wcr_ARRAY'], $value);
//                        if(is_object($tmp_oWCR)){
//
//                            error_log(__LINE__ . ' env - PROCESS[' . $init_profile_pack['sys_logging_meta_ARRAY'][$key] . '] FOR WCR ' . $value);
//                            $this->oLog_profile_endpoint_update($init_profile_pack['sys_logging_profile_ARRAY'][$key], $value, $tmp_oWCR);
//
//                        }else{
//
//                            error_log(__LINE__ . ' env - PROCESS[' . $init_profile_pack['sys_logging_meta_ARRAY'][$key] . '] FOR PATH ' . $value);
//                            $this->oLog_profile_endpoint_update($init_profile_pack['sys_logging_profile_ARRAY'][$key], $value);
//
//                        }
//
//                  break;
                    case CRNRSTN_LOG_FILE_FTP:

                        $tmp_oWCR = $this->is_WCR_key($init_profile_pack['sys_logging_wcr_ARRAY'], $value);

                        if(is_object($tmp_oWCR)){

                            $tmp_wcr_key = $tmp_oWCR->return_resource_key();

                            $this->oLog_profile_endpoint_update($init_profile_pack['sys_logging_profile_ARRAY'][$key], $value, $tmp_oWCR);

                            //
                            // CHECK oWCR FOR ANY OTHER RELEVANT ENDPOINT DATA
                            // DETECT oWCR ENDPOINT [TYPE=EMAIL] FROM FIELD EMAIL_PROTOCOL IN WCR EMAIL TEMPLATE
                            if(($tmp_oWCR->isset_WCR($tmp_wcr_key, 'EMAIL_PROTOCOL') == true) && (CRNRSTN_LOG_EMAIL != $init_profile_pack['sys_logging_profile_ARRAY'][$key])){

                                //error_log(__LINE__ . ' env - PROCESS[WCR] update oLog_profile_endpoint_update() ...has EMAIL_PROTOCOL ' . $tmp_wcr_key);

                                //
                                // WCR FOR EMAIL OF TRACE
                                $this->oLog_profile_endpoint_update(CRNRSTN_LOG_EMAIL, $tmp_wcr_key, $tmp_oWCR);

                            }

                            //
                            // DETECT WCR ENDPOINT [TYPE=FTP] FROM FIELD FTP_SERVER IN WCR FTP TEMPLATE
                            if(($tmp_oWCR->isset_WCR($tmp_wcr_key, 'FTP_SERVER') == true) && (CRNRSTN_LOG_FILE_FTP != $init_profile_pack['sys_logging_profile_ARRAY'][$key])){

                                //
                                // WCR FOR FTP OF TRACE IN FILE
                                $this->oLog_profile_endpoint_update(CRNRSTN_LOG_FILE_FTP, $tmp_wcr_key, $tmp_oWCR);

                            }

                            //
                            // DETECT WCR ENDPOINT [TYPE=EMAIL_PROXY] FROM FIELD FTP_SERVER IN WCR EMAIL_PROXY TEMPLATE
                            if(($tmp_oWCR->isset_WCR($tmp_wcr_key, 'WSDL_URI') == true) && (CRNRSTN_LOG_EMAIL_PROXY != $init_profile_pack['sys_logging_profile_ARRAY'][$key])){

                                //
                                // WCR FOR EMAIL_PROXY OF TRACE IN FILE
                                $this->oLog_profile_endpoint_update(CRNRSTN_LOG_EMAIL_PROXY, $tmp_wcr_key, $tmp_oWCR);

                            }

                            //
                            // DETECT WCR ENDPOINT [TYPE=FILE] FROM FIELD LOCAL_DIR_PATH IN WCR FILE TEMPLATE
                            if((($tmp_oWCR->isset_WCR($tmp_wcr_key, 'LOCAL_DIR_FILEPATH') == true) || ($tmp_oWCR->isset_WCR($tmp_wcr_key, 'LOCAL_DIR_,KJIUPATH') == true)) && (CRNRSTN_LOG_FILE != $init_profile_pack['sys_logging_profile_ARRAY'][$key])){

                                //
                                // WCR FOR FILE WRITE OF TRACE IN FILE
                                $this->oLog_profile_endpoint_update(CRNRSTN_LOG_FILE, $tmp_wcr_key, $tmp_oWCR);

                            }

                        }

                    break;

                }

            }

        }else{

            //error_log(__LINE__ .' env - sys_logging_meta_ARRAY NOT set...');

        }

    }

    public function sync_to_environment($oCRNRSTN = NULL, $oCRNRSTN_ENV = NULL, $oCRNRSTN_USR = NULL){

        $tmp_array = array();

        if(!isset($oCRNRSTN_ENV)){

            foreach($this->oLog_profiles_ARRAY as $key => $oLog_profile){

                //
                // LOAD CRNRSTN :: OBJ INTO EACH LOGGING PROFILE OBJECT.
                $oLog_profile->load_CRNRSTN_ENV($oCRNRSTN);

                $tmp_array[] = $oLog_profile;

            }

            $this->oLog_profiles_ARRAY = $tmp_array;

        }else{

            foreach($this->oLog_profiles_ARRAY as $key => $oLog_profile){

                //
                // LOAD CRNRSTN_ENV OBJ INTO EACH LOGGING PROFILE OBJECT
                $oLog_profile->load_CRNRSTN_ENV($oCRNRSTN_ENV);

                $tmp_array[] = $oLog_profile;

            }

            $this->oLog_profiles_ARRAY = $tmp_array;

        }

    }

    private function spool_up_logging_profiles(){

        foreach($this->log_profiles_ARRAY as $key => $profile){

            $tmp_oLoggingProfile = new crnrstn_logging_oprofile($profile, self::$config_serial, $this->profile_endpoint_criteria_ARRAY, $this->oCRNRSTN);

            $this->oLog_profiles_ARRAY[] = $tmp_oLoggingProfile;

        }

    }

    /*
    private function objectify_profiles(){

        foreach($this->log_profiles_ARRAY as $key => $profile){

            $tmp_oLoggingProfile = new crnrstn_logging_oprofile($profile, self::$config_serial, $this->oCRNRSTN);

            switch($profile){
                case 'DEFAULT':

                break;
                case 'EMAIL':

                    $tmp_oLoggingProfile->consume_logging_profile_pack($profile);

                    //$tmp_oLoggingProfile->load_EMAIL_endpoint_data();

                break;
                case 'EMAIL_PROXY':

                    $tmp_oLoggingProfile->consume_logging_profile_pack($profile);

                    $tmp_oLoggingProfile->load_EMAIL_PROXY_endpoint_data();

                break;
                case 'FILE':

                    $tmp_oLoggingProfile->consume_logging_profile_pack($profile);

                    $tmp_oLoggingProfile->load_FILE_endpoint_data();

                break;
                case 'SCREEN_TEXT':

                    $tmp_oLoggingProfile->consume_logging_profile_pack($profile);

                    $tmp_oLoggingProfile->load_SCREEN_TEXT_endpoint_data();

                break;
                case 'SCREEN':
                case 'SCREEN_HTML':

                    $tmp_oLoggingProfile->consume_logging_profile_pack($profile);

                    $tmp_oLoggingProfile->load_SCREEN_HTML_endpoint_data();

                break;
                case 'SCREEN_HTML_HIDDEN':

                    $tmp_oLoggingProfile->consume_logging_profile_pack($profile);

                    $tmp_oLoggingProfile->load_SCREEN_HTML_HIDDEN_endpoint_data();

                break;
                case 'SPLUNK':

                    $tmp_oLoggingProfile->consume_logging_profile_pack($profile);

                    $tmp_oLoggingProfile->load_SPLUNK_endpoint_data();

                break;
                default:
                    //
                    // ALSO DEFAULT

                break;

            }

            $this->oLog_profiles_ARRAY[] = $tmp_oLoggingProfile;

        }

    }
    */

    private function load_system_profiles(){

        $this->log_profiles_ARRAY[] = CRNRSTN_LOG_ELECTRUM;  // n + 1 DESTINATIONS
        $this->log_profiles_ARRAY[] = CRNRSTN_LOG_EMAIL_PROXY;
        $this->log_profiles_ARRAY[] = CRNRSTN_LOG_EMAIL;
        $this->log_profiles_ARRAY[] = CRNRSTN_LOG_FILE_FTP;
        $this->log_profiles_ARRAY[] = CRNRSTN_LOG_FILE;
        $this->log_profiles_ARRAY[] = CRNRSTN_LOG_SCREEN_TEXT;
        $this->log_profiles_ARRAY[] = CRNRSTN_LOG_SCREEN;
        $this->log_profiles_ARRAY[] = CRNRSTN_LOG_SCREEN_HTML;
        $this->log_profiles_ARRAY[] = CRNRSTN_LOG_SCREEN_HTML_HIDDEN;
        $this->log_profiles_ARRAY[] = CRNRSTN_LOG_DEFAULT;
        $this->log_profiles_ARRAY[] = CRNRSTN_RESOURCE_OPENSOURCE;

    }

    public function __destruct(){

    }

}