<?php
/*
// J5
// Code is Poetry */
#
#  CRNRSTN ::
#  VERSION :: 2.00.0000 PRE-ALPHA-DEV
#  DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
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
#  CLASS :: crnrstn_logging_oprofile
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: Monday, October 26, 2020 @ 2101hrs
#  DESCRIPTION ::
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_logging_oprofile {

    protected $oLogger;
    protected $oSoapClient;
    protected $oSoapDataTransportLayer;
    private static $oCRNRSTN_n;
    protected $oLog_output_manager;

    public $logging_profile;
    public $isValid = false;

    protected $resource_key;
    protected $config_serial_hash;

    protected $profile_endpoint_criteria_ARRAY = array();
    protected $profile_endpoint_data_ARRAY = array();
    protected $profile_endpoint_set_flag_ARRAY = array();
    protected $wcr_profiles_cnt = 0;

    protected $mail_protocol_flag_ARRAY = array();
    protected $tmp_mail_protocol_options_ARRAY = array('SENDMAIL', 'MAIL', 'QMAIL', 'SMTP');
    protected $tmp_mail_protocol_options_cnt = 4;

    public function __construct($logging_profile, $config_serial_hash, $profile_endpoint_criteria_ARRAY, $oCRNRSTN){

        /**
        TODO :: EXPIRE WCR DRIVEN CONTENT WITH ANY MODIFICATION OF THE SAME TO FORCE REFRESH
         *       BEFORE FINAL OUTPUT.
         */

        self::$oCRNRSTN_n = $oCRNRSTN;

        $this->oLogger = new crnrstn_logging(__CLASS__, self::$oCRNRSTN_n);

        $this->profile_endpoint_criteria_ARRAY = $profile_endpoint_criteria_ARRAY;
        $this->logging_profile = $logging_profile;
        //$this->resource_key = $resource_key;
        $this->config_serial_hash = $config_serial_hash;

        //$this->active_by_default($logging_profile);

    }

    public function return_profile_endpoint_data(){

        return $this->profile_endpoint_data_ARRAY;

    }

    //
    // SOURCE :: https://www.youtube.com/watch?v=u4-PGjwdARg
    // TITLE :: Arcade Fire - No Cars Go (BEST version ever - Pinkpop 2014)
    private function no_cars_go_EMAIL_PROXY($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj){

        $data_type_family = 'CRNRSTN::RESOURCE::EMAIL_COMM';
        $tmp_data_tunnel_session_serial = $oCRNRSTN_n->generate_new_key();
        $this->oSoapDataTransportLayer = new crnrstn_decoupled_data_object($oCRNRSTN_n, $tmp_data_tunnel_session_serial, 'SOAP_DTL_SERIAL');

        $tmp_ISHTML = true;
        $tmp_exception_msg = $exception_obj->getMessage();
        $tmp_exception_linenum = $exception_obj->getLine();

        $this->load_log_output_mgr($oCRNRSTN_n);

        //
        // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
        foreach($this->profile_endpoint_data_ARRAY as $config_version => $chunkArray0){

            foreach($chunkArray0 as $data_attribute => $chunkArray1){

                //error_log(__LINE__ . ' env - ' . $data_attribute . ' with value size=[' . sizeof($chunkArray1) . ']');

                foreach($chunkArray1 as $content_count => $attribute_content){

                    if(isset($this->profile_endpoint_set_flag_ARRAY[$config_version][$data_attribute][$content_count])){

                        //error_log(__LINE__ . ' env - [' . sizeof($chunkArray1) . '] [' . $config_version . '] [' . $data_attribute . '] [' . $content_count . '] [' . $attribute_content . ']');

                        switch($data_attribute){
                            case 'EMAIL_PROTOCOL':

                                //error_log(__LINE__ . ' env - adding to SSDTL...email protocol=' . $attribute_content);
                                $this->oSoapDataTransportLayer->add(trim(strtoupper($attribute_content)), $data_attribute, $data_type_family);

                            break;
                            case 'SMTP_AUTH':

                                $this->oSoapDataTransportLayer->add((bool) $oCRNRSTN_n->tidy_boolean($attribute_content), $data_attribute, $data_type_family);

                            break;
                            case 'SMTP_KEEPALIVE':

                                //error_log(__LINE__ . ' env - adding to SSDTL...email SMTP_KEEPALIVE=' . $attribute_content);
                                $this->oSoapDataTransportLayer->add((bool) $oCRNRSTN_n->tidy_boolean($attribute_content), $data_attribute, $data_type_family);

                            break;
                            case 'SMTP_AUTOTLS':

                                $this->oSoapDataTransportLayer->add((bool) $oCRNRSTN_n->tidy_boolean($attribute_content), $data_attribute, $data_type_family);

                            break;
                            case 'SMTP_TIMEOUT':

                                $this->oSoapDataTransportLayer->add((int) $attribute_content, $data_attribute, $data_type_family);

                            break;
                            case 'DIBYA_SAHOO_SSL_CERT_BYPASS':

                                $this->oSoapDataTransportLayer->add((bool) $oCRNRSTN_n->tidy_boolean($attribute_content), $data_attribute, $data_type_family);

                            break;
                            case 'USE_SENDMAIL_OPTIONS':

                                $this->oSoapDataTransportLayer->add((bool) $oCRNRSTN_n->tidy_boolean($attribute_content), $data_attribute, $data_type_family);

                            break;
                            case 'WORDWRAP':

                                $this->oSoapDataTransportLayer->add((int) $attribute_content, $data_attribute, $data_type_family);

                            break;
                            case 'ISHTML':

                                $tmp_ISHTML = (bool) $oCRNRSTN_n->tidy_boolean($attribute_content);

                                $this->oSoapDataTransportLayer->add((bool) $tmp_ISHTML, $data_attribute, $data_type_family);

                            break;
                            case 'PRIORITY':

                                $tmp_PRIORITY = $attribute_content;

                                $priority = trim(strtoupper($tmp_PRIORITY));

                                switch($priority){
                                    case '1':
                                    case 1:
                                    case 'HIGH':

                                        $tmp_PRIORITY = 1;

                                    break;
                                    case '3':
                                    case 3:
                                    case 'NORMAL':

                                        $tmp_PRIORITY = 3;

                                    break;
                                    case '5':
                                    case 5:
                                    case 'LOW':

                                        $tmp_PRIORITY = 5;

                                    break;
                                    default:

                                        $tmp_PRIORITY = 3;

                                        //
                                        // HOOOSTON...VE HAF PROBLEM!
                                        $oCRNRSTN_n->error_log('The provided priority level of "' . $tmp_PRIORITY . '" is invalid; NORMAL priority has been applied. Options include, "HIGH" or 1, "NORMAL" or 3 and "LOW" or 5.', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                    break;

                                }

                                $this->oSoapDataTransportLayer->add($tmp_PRIORITY, $data_attribute, $data_type_family);

                            break;
                            case 'DUP_SUPPRESS':

                                $this->oSoapDataTransportLayer->add((bool) $oCRNRSTN_n->tidy_boolean($attribute_content), $data_attribute, $data_type_family);

                            break;
                            case 'ALLOW_EMPTY':

                                //error_log(__LINE__ . ' env - adding to SSDTL...email ALLOW_EMPTY=' . $attribute_content);
                                $this->oSoapDataTransportLayer->add((bool) $oCRNRSTN_n->tidy_boolean($attribute_content), $data_attribute, $data_type_family);

                            break;
                            case 'TRY_OTHER_EMAIL_METHODS_ON_ERR':

                                //error_log(__LINE__ . ' env - adding to SSDTL...TRY_OTHER_EMAIL_METHODS_ON_ERR=' . $oCRNRSTN_n->tidy_boolean($attribute_content));
                                $this->oSoapDataTransportLayer->add((bool) $oCRNRSTN_n->tidy_boolean($attribute_content), $data_attribute, $data_type_family);

                            break;
                            default:

                                //error_log(__LINE__ . ' env - oSoapDataTransportLayer add(' . $data_attribute . ')=(' . $attribute_content . ')');
                                $this->oSoapDataTransportLayer->add($attribute_content, $data_attribute, $data_type_family);

                            break;

                        }

                    }

                }

            }

        }

        //
        // GET N COUNT OF RECIPIENT EMAIL ADDRESSES?
        $tmp_recipient_email_cnt = $this->oSoapDataTransportLayer->count('RECIPIENT_EMAIL');

        //error_log(__LINE__ .' env - recipient email cnt = '.$tmp_recipient_email_cnt);

        //for($i=0; $i<$tmp_recipient_email_cnt; $i++){
        // $tmp_email = $this->oSoapDataTransportLayer->preach('data_value', 'RECIPIENT_EMAIL', false, $i);
        // $tmp_name = $this->oSoapDataTransportLayer->preach('data_value', 'RECIPIENT_NAME', false, $i);
        // error_log(__LINE__ .' env - ['.$tmp_name . '] ['.self::$oCRNRSTN_n->str_sanitize($tmp_email, 'email_private').']');
        //}

        //
        // CONSTANTS
        $tmp_php_trace_TEXT = $oCRNRSTN_n->return_PHP_exception_trace_pretty($exception_obj->getTraceAsString(), 'TEXT');
        $tmp_log_constant_TEXT = $oCRNRSTN_n->return_log_priority_pretty($syslog_constant);
        $tmp_crnrstn_trace_TEXT = $this->oLog_output_manager->return_log_trace_output_str('EMAIL_TEXT');

        if($tmp_ISHTML == true){

            $tmp_php_trace_HTML = $oCRNRSTN_n->return_PHP_exception_trace_pretty($exception_obj->getTraceAsString(), 'HTML');
            $tmp_log_constant_HTML = $oCRNRSTN_n->return_log_priority_pretty($syslog_constant, 'HTML');
            $tmp_crnrstn_trace_HTML = $this->oLog_output_manager->return_log_trace_output_str('EMAIL_HTML');

        }

        switch(get_class($oCRNRSTN_n)){
            case 'crnrstn_user':
            case 'crnrstn_environment':
            case 'crnrstn':

                //
                // LOOP THROUGH N COUNT TO BUILD N CUSTOM EMAIL (SUBJECT, HTML, TEXT). AND STORE CONTENT WITHIN SOAP DTL.
                for ($i = 0; $i < $tmp_recipient_email_cnt; $i++){

                    $oCRNRSTN_GABRIEL = new crnrstn_messenger_from_north($i, 'mail', NULL, NULL, NULL, $oCRNRSTN_n);
                    $tmp_email = $this->oSoapDataTransportLayer->preach('data_value', 'RECIPIENT_EMAIL', false, $i);

                    //error_log(__LINE__ . ' env - building [' . $i . '] of [' . $tmp_recipient_email_cnt . '] message for ' . self::$oCRNRSTN_n->str_sanitize($tmp_email, 'email_private'));

                    //
                    // PREPARE TEXT VERSION
                    $tmp_TEXT_Body = $oCRNRSTN_GABRIEL->return_CRNRSTN_SysMsgTEXTBody('EXCEPTION_NOTIFICATION::SOAP_TUNNEL');
                    $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{SYSTEM_LOG_INTEGER_CONSTANT}', $tmp_log_constant_TEXT, $tmp_TEXT_Body);
                    $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{MESSAGE}', $tmp_exception_msg, $tmp_TEXT_Body);
                    $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{LINE_NUM}', $tmp_exception_linenum, $tmp_TEXT_Body);
                    $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{METHOD}', $exception_method, $tmp_TEXT_Body);
                    $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{PHP_TRACE}', $tmp_php_trace_TEXT, $tmp_TEXT_Body);
                    $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{SYSTEM_TIME}', $exception_systemtime, $tmp_TEXT_Body);
                    $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{PROCESS_RUN_TIME}', $exception_runtime, $tmp_TEXT_Body);
                    $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{EMAIL}', $tmp_email, $tmp_TEXT_Body);
                    $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{LOG_TRACE}', $tmp_crnrstn_trace_TEXT, $tmp_TEXT_Body);

                    $tmp_MESSAGE_SUBJECT = 'Exception Notification from ' . $_SERVER['SERVER_NAME'] . ' via CRNRSTN ::';
                    $this->oSoapDataTransportLayer->add($tmp_MESSAGE_SUBJECT, 'MESSAGE_SUBJECT', $data_type_family);
                    $tmp_TEXT_Body = trim($tmp_TEXT_Body);
                    $this->oSoapDataTransportLayer->add($tmp_TEXT_Body, 'MESSAGE_BODY_TEXT', $data_type_family);

                    if($tmp_ISHTML){

                        //
                        // PREPARE HTML VERSION
                        $tmp_HTML_Body = $oCRNRSTN_GABRIEL->return_CRNRSTN_SysMsgHTMLBody('EXCEPTION_NOTIFICATION::SOAP_TUNNEL');
                        $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{SYSTEM_LOG_INTEGER_CONSTANT}', $tmp_log_constant_HTML, $tmp_HTML_Body);
                        $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{MESSAGE}', $tmp_exception_msg, $tmp_HTML_Body);
                        $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{LINE_NUM}', $tmp_exception_linenum, $tmp_HTML_Body);
                        $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{METHOD}', $exception_method, $tmp_HTML_Body);
                        $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{PHP_TRACE}', $tmp_php_trace_HTML, $tmp_HTML_Body);
                        $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{SYSTEM_TIME}', $exception_systemtime, $tmp_HTML_Body);
                        $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{PROCESS_RUN_TIME}', $exception_runtime, $tmp_HTML_Body);
                        $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{EMAIL}', $tmp_email, $tmp_HTML_Body);
                        $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{LOG_TRACE}', $tmp_crnrstn_trace_HTML, $tmp_HTML_Body);

                        $tmp_HTML_Body = trim($tmp_HTML_Body);
                        $this->oSoapDataTransportLayer->add($tmp_HTML_Body, 'MESSAGE_BODY_HTML', $data_type_family);

                    }

                }

                //
                // DONE. BUILD SOAP REQUEST AND SEND TO PROXY.
                $SOAP_endpoint = $this->oSoapDataTransportLayer->preach('data_value', 'WSDL_URI');

                $SOAP_request = $this->oSoapDataTransportLayer->generate_SOAP_request_object('tunnelEncryptCalibrationRequest', NULL);

                //self::$oCRNRSTN_n->print_r($SOAP_request, 'CLIENT REQUEST :: oTunnelEncryptionCalibrationRequest', NULL, __LINE__, __METHOD__, __FILE__);

                //
                // SUBMIT SERVICES REQUEST [LIMIT OF 65535 bytes]
                $tmp_response = $this->client_send_CRNRSTN_SOAP_REQUEST('tunnelEncryptCalibrationRequest', $SOAP_request[0], $SOAP_endpoint);

                self::$oCRNRSTN_n->print_r($tmp_response, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest', NULL, __LINE__, __METHOD__, __FILE__);

                if($tmp_response['CRNRSTN_PACKET_IS_ENCRYPTED'] != 'TRUE'){

                    //
                    // UNABLE TO CONTINUE. ENCRYPTION IS REQUIRED. HANDLE AS ERROR.
                    error_log(__LINE__ . ' env ' . __METHOD__ . ' - SOAP err CRNRSTN_PACKET_IS_ENCRYPTED != TRUE');
                    die();

                }else{

                    $tmp_SOAP_ENCRYPT_CIPHER = $this->oSoapDataTransportLayer->preach('data_value', 'SOAP_ENCRYPT_CIPHER');
                    $tmp_SOAP_ENCRYPT_SECRET_KEY = $this->oSoapDataTransportLayer->soap_encrypt_secret_key;
                    $tmp_SOAP_ENCRYPT_HMAC_ALG = $this->oSoapDataTransportLayer->preach('data_value', 'SOAP_ENCRYPT_HMAC_ALG');
                    $tmp_SOAP_ENCRYPT_OPTIONS = $this->oSoapDataTransportLayer->preach('data_value', 'SOAP_ENCRYPT_OPTIONS');

                    $tmp_SOAP_SERVICES_AUTH_STATUS = self::$oCRNRSTN_n->data_decrypt($tmp_response['SOAP_SERVICES_AUTH_STATUS'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_SOAP_ENCRYPT_CIPHER_resp = self::$oCRNRSTN_n->data_decrypt($tmp_response['SOAP_ENCRYPT_CIPHER'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_SOAP_ENCRYPT_HMAC_ALG_resp = self::$oCRNRSTN_n->data_decrypt($tmp_response['SOAP_ENCRYPT_HMAC_ALG'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_SOAP_ENCRYPT_OPTIONS_resp = self::$oCRNRSTN_n->data_decrypt($tmp_response['SOAP_ENCRYPT_OPTIONS'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_STATUS_CODE = self::$oCRNRSTN_n->data_decrypt($tmp_response['STATUS_CODE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_STATUS_MESSAGE = self::$oCRNRSTN_n->data_decrypt($tmp_response['STATUS_MESSAGE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_ISERROR_CODE = self::$oCRNRSTN_n->data_decrypt($tmp_response['ISERROR_CODE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_ISERROR_MESSAGE = self::$oCRNRSTN_n->data_decrypt($tmp_response['ISERROR_MESSAGE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_DATE_RECEIVED_SOAP_REQUEST = self::$oCRNRSTN_n->data_decrypt($tmp_response['DATE_RECEIVED_SOAP_REQUEST'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_SERVER_NAME_SOAP_SERVER = self::$oCRNRSTN_n->data_decrypt($tmp_response['SERVER_NAME_SOAP_SERVER'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_SERVER_ADDRESS_SOAP_SERVER = self::$oCRNRSTN_n->data_decrypt($tmp_response['SERVER_ADDRESS_SOAP_SERVER'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_DATE_CREATED_SOAP_RESPONSE = self::$oCRNRSTN_n->data_decrypt($tmp_response['DATE_CREATED_SOAP_RESPONSE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                    /*

                    NEED TO UPDATE PARAMETER ORDER TO THE NEW BEFORE RUNNING THIS
                    self::$oCRNRSTN_n->print_r($tmp_SOAP_SERVICES_AUTH_STATUS, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: SOAP_SERVICES_AUTH_STATUS');
                    self::$oCRNRSTN_n->print_r($tmp_SOAP_ENCRYPT_CIPHER_resp, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: SOAP_ENCRYPT_CIPHER');
                    self::$oCRNRSTN_n->print_r($tmp_SOAP_ENCRYPT_HMAC_ALG_resp, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: SOAP_ENCRYPT_HMAC_ALG');
                    self::$oCRNRSTN_n->print_r($tmp_SOAP_ENCRYPT_OPTIONS_resp, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: SOAP_ENCRYPT_OPTIONS');
                    self::$oCRNRSTN_n->print_r($tmp_STATUS_CODE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: STATUS_CODE');
                    self::$oCRNRSTN_n->print_r($tmp_STATUS_MESSAGE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: STATUS_MESSAGE');
                    self::$oCRNRSTN_n->print_r($tmp_ISERROR_CODE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: ISERROR_CODE');
                    self::$oCRNRSTN_n->print_r($tmp_ISERROR_MESSAGE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: ISERROR_MESSAGE');
                    self::$oCRNRSTN_n->print_r($tmp_DATE_RECEIVED_SOAP_REQUEST, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: DATE_RECEIVED_SOAP_REQUEST');
                    self::$oCRNRSTN_n->print_r($tmp_SERVER_NAME_SOAP_SERVER, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: SERVER_NAME_SOAP_SERVER');
                    self::$oCRNRSTN_n->print_r($tmp_SERVER_ADDRESS_SOAP_SERVER, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: SERVER_ADDRESS_SOAP_SERVER');
                    self::$oCRNRSTN_n->print_r($tmp_DATE_CREATED_SOAP_RESPONSE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: DATE_CREATED_SOAP_RESPONSE');
                    */

                    if($tmp_SOAP_SERVICES_AUTH_STATUS == 'AUTHORIZATION GRANTED'){

                        $SOAP_request = $this->oSoapDataTransportLayer->generate_SOAP_request_object('mayItakeTheKingsHighway', $tmp_response);

                        /*
                        'CRNRSTN_PACKET_IS_ENCRYPTED' => array( 'name' => 'CRNRSTN_PACKET_IS_ENCRYPTED', 'type' => 'xsd:string' ),
                        'CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES' => array( 'name' => 'CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES', 'type' => 'xsd:string' ),
                        'CRNRSTN_SOAP_SVC_METHOD_REQUESTED' => array( 'name' => 'CRNRSTN_SOAP_SVC_METHOD_REQUESTED', 'type' => 'xsd:string' ),
                        'CRNRSTN_SOAP_ACTION_TYPE' => array( 'name' => 'CRNRSTN_SOAP_ACTION_TYPE', 'type' => 'xsd:string' ),
                        'CRNRSTN_SOAP_SVC_AUTH_KEY' => array( 'name' => 'CRNRSTN_SOAP_SVC_AUTH_KEY', 'type' => 'xsd:string' ),
                        'USERNAME' => array( 'name' => 'USERNAME', 'type' => 'xsd:string' ),
                        'PASSWORD' => array( 'name' => 'PASSWORD', 'type' => 'xsd:string' ),
                        'CRNRSTN_NOTIFICATION_TYPE' => array( 'name' => 'CRNRSTN_NOTIFICATION_TYPE', 'type' => 'xsd:string' ),
                        'SOAP_ENCRYPT_CIPHER' => array( 'name' => 'SOAP_ENCRYPT_CIPHER', 'type' => 'xsd:string' ),
                        'SOAP_ENCRYPT_SECRET_KEY' => array( 'name' => 'SOAP_ENCRYPT_SECRET_KEY', 'type' => 'xsd:string' ),
                        'SOAP_ENCRYPT_HMAC_ALG' => array( 'name' => 'SOAP_ENCRYPT_HMAC_ALG', 'type' => 'xsd:string' ),
                        'SOAP_ENCRYPT_OPTIONS' => array( 'name' => 'SOAP_ENCRYPT_OPTIONS', 'type' => 'xsd:string' )
                         * */

                        self::$oCRNRSTN_n->print_r($SOAP_endpoint, '', NULL, __LINE__, __METHOD__, __FILE__);

                        //
                        // SUBMIT SERVICES REQUEST [LIMIT OF 65535 bytes]
                        $tmp_response = $this->client_send_CRNRSTN_SOAP_REQUEST('mayItakeTheKingsHighway', $SOAP_request[0], $SOAP_endpoint);

                        //self::$oCRNRSTN_n->print_r($SOAP_request, 'CLIENT REQUEST :: mayItakeTheKingsHighway', NULL, __LINE__, __METHOD__, __FILE__);
                        //self::$oCRNRSTN_n->print_r($this->returnClientRequest(), 'CLIENT REQUEST :: oKingsHighwayAuthRequest', NULL, __LINE__, __METHOD__, __FILE__);
                        self::$oCRNRSTN_n->print_r($tmp_response, 'SERVER RESPONSE :: mayItakeTheKingsHighway', NULL, __LINE__, __METHOD__, __FILE__);

                        $tmp_CRNRSTN_PACKET_IS_ENCRYPTED = $tmp_response['CRNRSTN_PACKET_IS_ENCRYPTED'];
                        if($tmp_CRNRSTN_PACKET_IS_ENCRYPTED != 'TRUE'){

                            //
                            // ENCRYPTION REQUIRED - DO NOT CONTINUE.

                        }else{

                            $tmp_SOAP_ENCRYPT_CIPHER = $this->oSoapDataTransportLayer->preach('data_value', 'SOAP_ENCRYPT_CIPHER');
                            $tmp_SOAP_ENCRYPT_SECRET_KEY_resp = $this->oSoapDataTransportLayer->soap_encrypt_secret_key;
                            $tmp_SOAP_ENCRYPT_HMAC_ALG = $this->oSoapDataTransportLayer->preach('data_value', 'SOAP_ENCRYPT_HMAC_ALG');
                            $tmp_SOAP_ENCRYPT_OPTIONS = $this->oSoapDataTransportLayer->preach('data_value', 'SOAP_ENCRYPT_OPTIONS');

                            $tmp_SOAP_ENCRYPT_SECRET_KEY = $this->oSoapDataTransportLayer->preach('data_value', 'CRNRSTN_SOAP_SVC_ENCRYPTION_KEY');

                            //mayItakeTheKingsHighway decrypt with [AES-192-OFB][for_a_stranger-this-Is-the_soap-encrypti0n-key][sha256][1]

                            //
                            // DECRYPT SOAP OBJECT
                            //$tmp_CRNRSTN_SOAP_SVC_AUTH_KEY = self::$oCRNRSTN_n->data_decrypt($tmp_response['CRNRSTN_SOAP_SVC_AUTH_KEY'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_CRNRSTN_SOAP_SVC_USERNAME = self::$oCRNRSTN_n->data_decrypt($tmp_response['CRNRSTN_SOAP_SVC_USERNAME'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            self::$oCRNRSTN_n->print_r('SOAP_SERVICES_AUTH_STATUS = ' . $tmp_response['SOAP_SERVICES_AUTH_STATUS'] . ' [' . $tmp_SOAP_ENCRYPT_CIPHER_resp . '] [' . $tmp_SOAP_ENCRYPT_SECRET_KEY_resp . '][' . $this->oSoapDataTransportLayer->soap_encrypt_secret_key . ']', 'SERVER RESPONSE DECRYPT :: mayItakeTheKingsHighway', NULL, __LINE__, __METHOD__, __FILE__);
                            //error_log(__LINE__ .' env data_decrypt(1/2) ['.$tmp_SOAP_ENCRYPT_CIPHER_resp.']['.$tmp_SOAP_ENCRYPT_SECRET_KEY_resp.']['.$tmp_SOAP_ENCRYPT_HMAC_ALG_resp.']['.$tmp_SOAP_ENCRYPT_OPTIONS_resp.']');
                            $tmp_SOAP_SERVICES_AUTH_STATUS = self::$oCRNRSTN_n->data_decrypt($tmp_response['SOAP_SERVICES_AUTH_STATUS'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            //error_log(__LINE__ .' env data_decrypt(2/2) ['.$tmp_SOAP_ENCRYPT_CIPHER_resp.']['.$tmp_SOAP_ENCRYPT_SECRET_KEY_resp.']['.$tmp_SOAP_ENCRYPT_HMAC_ALG_resp.']['.$tmp_SOAP_ENCRYPT_OPTIONS_resp.']');

                            self::$oCRNRSTN_n->print_r('SOAP_SERVICES_AUTH_STATUS = '.$tmp_SOAP_SERVICES_AUTH_STATUS, 'SERVER RESPONSE DECRYPT :: mayItakeTheKingsHighway', NULL, __LINE__, __METHOD__, __FILE__);
                            //$tmp_SOAP_ENCRYPT_CIPHER_resp = self::$oCRNRSTN_n->data_decrypt($tmp_response['SOAP_ENCRYPT_CIPHER'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_SOAP_ENCRYPT_SECRET_KEY_resp = self::$oCRNRSTN_n->data_decrypt($tmp_response['SOAP_ENCRYPT_SECRET_KEY'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_SOAP_ENCRYPT_HMAC_ALG_resp = self::$oCRNRSTN_n->data_decrypt($tmp_response['SOAP_ENCRYPT_HMAC_ALG'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_SOAP_ENCRYPT_OPTIONS_resp = self::$oCRNRSTN_n->data_decrypt($tmp_response['SOAP_ENCRYPT_OPTIONS'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                            //$tmp_STATUS_CODE = self::$oCRNRSTN_n->data_decrypt($tmp_response['STATUS_CODE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_STATUS_MESSAGE = self::$oCRNRSTN_n->data_decrypt($tmp_response['STATUS_MESSAGE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_ISERROR_CODE = self::$oCRNRSTN_n->data_decrypt($tmp_response['ISERROR_CODE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_ISERROR_MESSAGE = self::$oCRNRSTN_n->data_decrypt($tmp_response['ISERROR_MESSAGE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_DATE_RECEIVED_SOAP_REQUEST = self::$oCRNRSTN_n->data_decrypt($tmp_response['DATE_RECEIVED_SOAP_REQUEST'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_SERVER_NAME_SOAP_SERVER = self::$oCRNRSTN_n->data_decrypt($tmp_response['SERVER_NAME_SOAP_SERVER'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_SERVER_ADDRESS_SOAP_SERVER = self::$oCRNRSTN_n->data_decrypt($tmp_response['SERVER_ADDRESS_SOAP_SERVER'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_DATE_CREATED_SOAP_RESPONSE = self::$oCRNRSTN_n->data_decrypt($tmp_response['DATE_CREATED_SOAP_RESPONSE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_SERVER_NAME_SOAP_CLIENT = self::$oCRNRSTN_n->data_decrypt($tmp_response['SERVER_NAME_SOAP_CLIENT'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_SERVER_ADDRESS_SOAP_CLIENT = self::$oCRNRSTN_n->data_decrypt($tmp_response['SERVER_ADDRESS_SOAP_CLIENT'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                            /*
                             DO NOT RUN UNTIL BRINGING INPUT PARAM ORDER INTO TO NEW SEQUENCE
                            self::$oCRNRSTN_n->print_r($tmp_CRNRSTN_SOAP_SVC_AUTH_KEY, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: CRNRSTN_SOAP_SVC_AUTH_KEY');
                            self::$oCRNRSTN_n->print_r($tmp_CRNRSTN_SOAP_SVC_USERNAME, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: CRNRSTN_SOAP_SVC_USERNAME');
                            self::$oCRNRSTN_n->print_r($tmp_SOAP_SERVICES_AUTH_STATUS, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SOAP_SERVICES_AUTH_STATUS');
                            self::$oCRNRSTN_n->print_r($tmp_SOAP_ENCRYPT_CIPHER_resp, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SOAP_ENCRYPT_CIPHER');
                            self::$oCRNRSTN_n->print_r($tmp_SOAP_ENCRYPT_SECRET_KEY_resp, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SOAP_ENCRYPT_SECRET_KEY');
                            self::$oCRNRSTN_n->print_r($tmp_SOAP_ENCRYPT_HMAC_ALG_resp, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SOAP_ENCRYPT_HMAC_ALG');
                            self::$oCRNRSTN_n->print_r($tmp_SOAP_ENCRYPT_OPTIONS_resp, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SOAP_ENCRYPT_OPTIONS');
                            self::$oCRNRSTN_n->print_r($tmp_STATUS_CODE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: STATUS_CODE');
                            self::$oCRNRSTN_n->print_r($tmp_STATUS_MESSAGE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: STATUS_MESSAGE');
                            self::$oCRNRSTN_n->print_r($tmp_ISERROR_CODE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: ISERROR_CODE');
                            self::$oCRNRSTN_n->print_r($tmp_ISERROR_MESSAGE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: ISERROR_MESSAGE');
                            self::$oCRNRSTN_n->print_r($tmp_DATE_RECEIVED_SOAP_REQUEST, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: DATE_RECEIVED_SOAP_REQUEST');
                            self::$oCRNRSTN_n->print_r($tmp_SERVER_NAME_SOAP_SERVER, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SERVER_NAME_SOAP_SERVER');
                            self::$oCRNRSTN_n->print_r($tmp_SERVER_ADDRESS_SOAP_SERVER, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SERVER_ADDRESS_SOAP_SERVER');
                            self::$oCRNRSTN_n->print_r($tmp_DATE_CREATED_SOAP_RESPONSE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: DATE_CREATED_SOAP_RESPONSE');
                            self::$oCRNRSTN_n->print_r($tmp_SERVER_NAME_SOAP_CLIENT, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SERVER_NAME_SOAP_CLIENT');
                            self::$oCRNRSTN_n->print_r($tmp_SERVER_ADDRESS_SOAP_CLIENT, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SERVER_ADDRESS_SOAP_CLIENT');
                            */

                            self::$oCRNRSTN_n->print_r($tmp_SOAP_SERVICES_AUTH_STATUS, 'SERVER RESPONSE :: mayItakeTheKingsHighway', NULL, __LINE__, __METHOD__, __FILE__);
                            if($tmp_SOAP_SERVICES_AUTH_STATUS == 'AUTHORIZATION GRANTED'){

                                //
                                // BUILD PAYLOAD SOAP REQUEST :: takeTheKingsHighway
                                $this->oSoapDataTransportLayer->soap_encrypt_cipher = $tmp_SOAP_ENCRYPT_CIPHER_resp;
                                $this->oSoapDataTransportLayer->soap_encrypt_hmac_alg = $tmp_SOAP_ENCRYPT_HMAC_ALG_resp;
                                $this->oSoapDataTransportLayer->soap_encrypt_options = $tmp_SOAP_ENCRYPT_OPTIONS_resp;

                                $SOAP_request = $this->oSoapDataTransportLayer->generate_SOAP_request_object('takeTheKingsHighway', $tmp_response);

                                //self::$oCRNRSTN_n->print_r($SOAP_request, 'CLIENT REQUEST :: takeTheKingsHighway', NULL, __LINE__, __METHOD__, __FILE__);

                                error_log(__LINE__ . ' env - READY TO takeTheKingsHighway TO SERVER.');

                                //
                                // SUBMIT SERVICES REQUEST [LIMIT OF 65535 bytes]
                                $tmp_request_cnt = sizeof($SOAP_request);
                                //error_log(__LINE__ . ' env - READY TO SEND count=' . $tmp_request_cnt . ' TO SERVER.');

                                for($ii = 0; $ii < $tmp_request_cnt; $ii++){

                                    $tmp_cur = 1 + $ii;
                                    $tmp_response = $this->client_send_CRNRSTN_SOAP_REQUEST('takeTheKingsHighway', $SOAP_request[$ii], $SOAP_endpoint);
                                    self::$oCRNRSTN_n->print_r($tmp_response, 'CLIENT - SERVER RESPONSE :: takeTheKingsHighway ' . $tmp_cur . ' of ' . $tmp_request_cnt, NULL, __LINE__, __METHOD__, __FILE__);

                                }

                                // error_log(__LINE__ . ' env - WE JUST TOOK takeTheKingsHighway ' . $ii . ' times!');

                            }

                        }

                    }else{

                        error_log(__LINE__ . ' env - authorization NOT granted...');
                        $tmp_STATUS_CODE = self::$oCRNRSTN_n->data_decrypt($tmp_response['STATUS_CODE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                        $tmp_STATUS_MESSAGE = self::$oCRNRSTN_n->data_decrypt($tmp_response['STATUS_MESSAGE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                        $tmp_ISERROR_CODE = self::$oCRNRSTN_n->data_decrypt($tmp_response['ISERROR_CODE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                        $tmp_ISERROR_MESSAGE = self::$oCRNRSTN_n->data_decrypt($tmp_response['ISERROR_MESSAGE'], CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                        self::$oCRNRSTN_n->error_log('CRNRSTN :: SOAP Services proxy error. Error Code: ' . $tmp_ISERROR_CODE . ' :: Error Message: ' . $tmp_ISERROR_MESSAGE . ' :: Status Code: ' . $tmp_STATUS_CODE . ' :: Status Message: ' . $tmp_STATUS_MESSAGE, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_SOAP_SERVICES');

                    }

                    return true;

                }

                break;

        }

        return true;

    }

    public function returnClientRequest(){

        return $this->oSoapClient->returnClientRequest();

    }

    //
    // SOURCE :: https://www.youtube.com/watch?v=83KR_UBWdPI
    // TITLE :: Arcade Fire - No Cars Go
    private function no_cars_go_EMAIL($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj){

        $tmp_exception_msg = $exception_obj->getMessage();
        $tmp_exception_linenum = $exception_obj->getLine();

        error_log(__LINE__ . ' env no_cars_go_EMAIL() [' . $exception_method . '][' . $syslog_constant . ']' . $tmp_exception_output_str . ' ' . $tmp_exception_msg . ' ' . $tmp_exception_linenum);

        $this->load_log_output_mgr($oCRNRSTN_n);

        $tmp_sent_suppression = array();
        $config_data_ARRAY = array();

        //
        // PHPMAILER DEFAULT VALUES
        $tmp_DUP_SUPPRESS = true;  // CRNRSTN DEFAULT
        $tmp_ALLOW_EMPTY = false;
        $tmp_SMTP_KEEPALIVE = false;
        $tmp_isHTML = true;
        $tmp_SMTP_TIMEOUT = 300;
        $tmp_PRIORITY = 3;
        $tmp_WORDWRAP = 52;
        $tmp_EMAIL_PROTOCOL = 'mail';
        $tmp_TRY_OTHER_EMAIL_METHODS_ON_ERR = true;
        $tmp_SMTP_AUTH = false;
        $tmp_SMTP_SERVER = 'localhost';
        $tmp_SMTP_PORT_OUTGOING = 25;
        $tmp_SMTP_USERNAME = '';
        $tmp_SMTP_PASSWORD = '';
        $tmp_CHARSET = 'iso-8859-1';
        $tmp_MESSAGE_ENCODING = '8bit';
        $tmp_SMTP_SECURE = '';
        $tmp_SMTP_AUTOTLS = true;
        //$tmp_FROM_EMAIL = 'root@localhost';
        $tmp_FROM_EMAIL = 'no_reply@'.$_SERVER['SERVER_NAME'];
        $tmp_FROM_NAME = 'CRNRSTN System Mailer';
        $tmp_RECIPIENT_EMAIL = array();
        $tmp_RECIPIENT_NAME = array();
        $tmp_REPLYTO_EMAIL = array();
        $tmp_REPLYTO_NAME = array();
        $tmp_CC_EMAIL = array();
        $tmp_CC_NAME = array();
        $tmp_BCC_EMAIL = array();
        $tmp_BCC_NAME = array();
        $tmp_SENDMAIL_PATH = '/usr/sbin/sendmail';
        $tmp_USE_SENDMAIL_OPTIONS = true;
        $tmp_DIBYA_SAHOO_SSL_CERT_BYPASS = true;

        //$tmp_size = sizeof($this->profile_endpoint_data_ARRAY);

        //error_log(__LINE__ . ' env profile_endpoint_data_ARRAY=' . print_r($this->profile_endpoint_data_ARRAY, true));

        //
        // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
        foreach($this->profile_endpoint_data_ARRAY as $config_version => $chunkArray0){

            //error_log(__LINE__ . ' env - should be (more than one) ' . $tmp_size . '...config_version=' . $config_version);

            foreach($chunkArray0 as $data_attribute => $chunkArray1){

                foreach($chunkArray1 as $content_count => $oDDO){

                    //error_log(__LINE__ . ' env - die() [' . $config_version . '] [' . $data_attribute . '] [' . $content_count . '] [' . get_class($oDDO) . ']');
                    //public function preach($data_attribute = 'value', $data_key = NULL, $soap_transport=false, $index = 0){
                    switch($data_attribute){
                        case 'RECIPIENT_EMAIL':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach RECIPIENT_EMAIL cnt=' . $oDDO->count($data_attribute));

                                $tmp_RECIPIENT_EMAIL[] = $oDDO->preach('data_value', $data_attribute);

                            }else{

                                $tmp_RECIPIENT_EMAIL[] = $oDDO;

                            }

                        break;
                        case 'RECIPIENT_NAME':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach $tmp_RECIPIENT_NAME cnt=' . $oDDO->count($data_attribute));

                                $tmp_RECIPIENT_NAME[] = $oDDO->preach('data_value', $data_attribute);

                            }else{

                                $tmp_RECIPIENT_NAME[] = $oDDO;

                            }

                        break;
                        case 'FROM_EMAIL':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach FROM_EMAIL cnt=' . $oDDO->count($data_attribute));

                                $tmp_FROM_EMAIL = $oDDO->preach('data_value', $data_attribute);

                            }else{

                                $tmp_FROM_EMAIL = $oDDO;

                            }

                        break;
                        case 'FROM_NAME':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach FROM_NAME cnt=' . $oDDO->count($data_attribute));
                                $tmp_FROM_NAME = $oDDO->preach('data_value', $data_attribute);

                            }else{

                                $tmp_FROM_NAME = $oDDO;

                            }

                        break;
                        case 'REPLYTO_EMAIL':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach REPLYTO_EMAIL cnt=' . $oDDO->count($data_attribute));

                                $tmp_REPLYTO_EMAIL[] = $oDDO->preach('data_value', $data_attribute);

                            }else{

                                $tmp_REPLYTO_EMAIL[] = $oDDO;

                            }

                        break;
                        case 'REPLYTO_NAME':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach REPLYTO_NAME cnt=' . $oDDO->count($data_attribute));

                                $tmp_REPLYTO_NAME[] = $oDDO->preach('data_value', $data_attribute);

                            }else{

                                $tmp_REPLYTO_NAME[] = $oDDO;

                            }

                        break;
                        case 'CC_EMAIL':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach CC_EMAIL cnt=' . $oDDO->count($data_attribute));

                                $tmp_CC_EMAIL[] = $oDDO->preach('data_value', $data_attribute);

                            }else{

                                $tmp_CC_EMAIL[] = $oDDO;

                            }

                        break;
                        case 'CC_NAME':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach CC_NAME cnt=' . $oDDO->count($data_attribute));

                                $tmp_CC_NAME[] = $oDDO->preach('data_value', $data_attribute);

                            }else{

                                $tmp_CC_NAME[] = $oDDO;

                            }

                        break;
                        case 'BCC_EMAIL':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach BCC_EMAIL cnt=' . $oDDO->count($data_attribute));

                                $tmp_BCC_EMAIL[] = $oDDO->preach('data_value', $data_attribute);

                            }else{

                                $tmp_BCC_EMAIL[] = $oDDO;

                            }

                        break;
                        case 'BCC_NAME':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach BCC_NAME cnt=' . $oDDO->count($data_attribute));

                                $tmp_BCC_NAME[] = $oDDO->preach('data_value', $data_attribute);

                            }else{

                                $tmp_BCC_NAME[] = $oDDO;

                            }

                        break;
                        case 'SMTP_KEEPALIVE':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach [' . $oDDO->count($data_attribute) . '] SMTP_KEEPALIVE=' . $oDDO->preach('type', $data_attribute));

                                $tmp_SMTP_KEEPALIVE = (bool) $oCRNRSTN_n->tidy_boolean($oDDO->preach('data_value', $data_attribute));

                            }else{

                                $tmp_SMTP_KEEPALIVE = (bool) $oCRNRSTN_n->tidy_boolean($oDDO);

                            }

                        break;
                        case 'DUP_SUPPRESS':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach [' . $oDDO->count($data_attribute) . '] DUP_SUPPRESS=' . $oDDO->preach('type', $data_attribute));

                                $tmp_DUP_SUPPRESS = (bool) $oCRNRSTN_n->tidy_boolean($oDDO->preach('data_value', $data_attribute));

                            }else{

                                $tmp_DUP_SUPPRESS = (bool) $oCRNRSTN_n->tidy_boolean($oDDO);

                            }

                        break;
                        case 'ALLOW_EMPTY':

                            if(is_object($oDDO)){

                                $tmp_ALLOW_EMPTY = (bool) $oCRNRSTN_n->tidy_boolean($oDDO->preach('data_value', $data_attribute));

                            }else{

                                $tmp_ALLOW_EMPTY = (bool) $oCRNRSTN_n->tidy_boolean($oDDO);

                            }

                        break;
                        case 'ISHTML':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach [' . $oDDO->count($data_attribute) . '] ISHTML=' . $oDDO->preach('type', $data_attribute));

                                $tmp_isHTML = (bool) $oCRNRSTN_n->tidy_boolean($oDDO->preach('data_value', $data_attribute));

                            }else{

                                $tmp_isHTML = (bool) $oCRNRSTN_n->tidy_boolean($oDDO);

                            }

                        break;
                        case 'SMTP_TIMEOUT':

                            if(is_object($oDDO)){

                                $tmp_SMTP_TIMEOUT = (int) $oDDO->preach('data_value', $data_attribute);

                            }else{

                                $tmp_SMTP_TIMEOUT = (int) $oDDO;

                            }

                        break;
                        case 'PRIORITY':

                            if(is_object($oDDO)){

                                if($oDDO->preach('type', $data_attribute) == 'string'){

                                    $tmp_PRIORITY = (string) $oDDO->preach('data_value', $data_attribute);

                                }else{

                                    $tmp_PRIORITY = (int) $oDDO->preach('data_value', $data_attribute);

                                }

                            }else{

                                $tmp_PRIORITY = $oDDO;

                            }

                            $priority = trim(strtoupper($tmp_PRIORITY));

                            switch($priority){
                                case '1':
                                case 1:
                                case 'HIGH':

                                    $tmp_PRIORITY = 1;

                                break;
                                case '3':
                                case 3:
                                case 'NORMAL':

                                    $tmp_PRIORITY = 3;

                                break;
                                case '5':
                                case 5:
                                case 'LOW':

                                    $tmp_PRIORITY = 5;

                                break;
                                default:

                                    $tmp_PRIORITY = 3;

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    $oCRNRSTN_n->error_log('The provided priority level of "' . $priority . '" is invalid; NORMAL priority has been applied. Options include, "HIGH" or 1, "NORMAL" or 3 and "LOW" or 5.', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                break;

                            }

                        break;
                        case 'WORDWRAP':

                            if(is_object($oDDO)){

                                $tmp_WORDWRAP = (int) $oDDO->preach('data_value', $data_attribute);

                            }else{

                                $tmp_WORDWRAP = (int) $oDDO;

                            }

                        break;
                        case 'EMAIL_PROTOCOL':

                            if(is_object($oDDO)){

                                $tmp_EMAIL_PROTOCOL = trim(strtoupper($oDDO->preach('data_value', $data_attribute)));

                            }else{

                                $tmp_EMAIL_PROTOCOL = trim(strtoupper($oDDO));

                            }

                        break;
                        case 'CHARSET':

                            if(is_object($oDDO)){

                                $tmp_CHARSET = $oDDO->preach('data_value', $data_attribute);

                            }else{

                                $tmp_CHARSET = $oDDO;

                            }

                        break;
                        case 'MESSAGE_ENCODING':

                            if(is_object($oDDO)){

                                $tmp_MESSAGE_ENCODING = $oDDO->preach('data_value', $data_attribute);

                            }else{

                                $tmp_MESSAGE_ENCODING = $oDDO;

                            }

                        break;
                        case 'SMTP_SECURE':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach [' . $oDDO->count($data_attribute) . '] SMTP_AUTH=' . $oDDO->preach('type', $data_attribute));

                                $tmp_SMTP_SECURE = strtolower(trim($oDDO->preach('data_value', $data_attribute)));

                            }else{

                                $tmp_SMTP_SECURE = $oDDO;

                            }

                        break;
                        case 'SMTP_AUTOTLS':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach [' . $oDDO->count($data_attribute) . '] SMTP_AUTOTLS=' . $oDDO->preach('type', $data_attribute));

                                $tmp_SMTP_AUTOTLS = (bool) $oCRNRSTN_n->tidy_boolean($oDDO->preach('data_value', $data_attribute));

                            }else{

                                $tmp_SMTP_AUTOTLS = (bool) $oCRNRSTN_n->tidy_boolean($oDDO);

                            }

                        break;
                        case 'SMTP_AUTH':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach [' . $oDDO->count($data_attribute) . '] SMTP_AUTH=' . $oDDO->preach('type', $data_attribute));

                                $tmp_SMTP_AUTH = (bool) $oCRNRSTN_n->tidy_boolean($oDDO->preach('data_value', $data_attribute));

                            }else{

                                $tmp_SMTP_AUTH = (bool) $oCRNRSTN_n->tidy_boolean($oDDO);

                            }

                        break;
                        case 'SMTP_SERVER':

                            if(is_object($oDDO)){

                                $tmp_SMTP_SERVER = $oDDO->preach('data_value', $data_attribute);

                            }else{

                                $tmp_SMTP_SERVER = $oDDO;

                            }

                        break;
                        case 'SMTP_PORT_OUTGOING':

                            if(is_object($oDDO)){

                                $tmp_SMTP_PORT_OUTGOING = $oDDO->preach('data_value', $data_attribute);

                            }else{

                                $tmp_SMTP_PORT_OUTGOING = $oDDO;

                            }

                        break;
                        case 'SMTP_USERNAME':

                            if(is_object($oDDO)){

                                $tmp_SMTP_USERNAME = $oDDO->preach('data_value', $data_attribute);

                            }else{

                                $tmp_SMTP_USERNAME = $oDDO;

                            }

                        break;
                        case 'SMTP_PASSWORD':

                            if(is_object($oDDO)){

                                $tmp_SMTP_PASSWORD = $oDDO->preach('data_value', $data_attribute);

                            }else{

                                $tmp_SMTP_PASSWORD = $oDDO;

                            }

                        break;
                        case 'SENDMAIL_PATH':

                            if(is_object($oDDO)){

                                $tmp_SENDMAIL_PATH = $oDDO->preach('data_value', $data_attribute);

                            }else{

                                $tmp_SENDMAIL_PATH = $oDDO;

                            }

                        break;
                        case 'USE_SENDMAIL_OPTIONS':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach [' . $oDDO->count($data_attribute) . '] USE_SENDMAIL_OPTIONS=' . $oDDO->preach('type', $data_attribute));

                                $tmp_USE_SENDMAIL_OPTIONS = (bool) $oCRNRSTN_n->tidy_boolean($oDDO->preach('data_value', $data_attribute));

                            }else{

                                $tmp_USE_SENDMAIL_OPTIONS = (bool) $oCRNRSTN_n->tidy_boolean($oDDO);

                            }

                        break;
                        case 'DIBYA_SAHOO_SSL_CERT_BYPASS':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach DIBYA_SAHOO_SSL_CERT_BYPASS [' . $oDDO->count($data_attribute) . ']  DIBYA_SAHOO_SSL_CERT_BYPASS=' . $oDDO->preach('type', $data_attribute));

                                $tmp_DIBYA_SAHOO_SSL_CERT_BYPASS = (bool) $oCRNRSTN_n->tidy_boolean($oDDO->preach('data_value', $data_attribute));

                            }else{

                                $tmp_DIBYA_SAHOO_SSL_CERT_BYPASS = (bool) $oCRNRSTN_n->tidy_boolean($oDDO);

                            }

                        break;
                        case 'TRY_OTHER_EMAIL_METHODS_ON_ERR':

                            if(is_object($oDDO)){

                                $tmp_TRY_OTHER_EMAIL_METHODS_ON_ERR = (bool) $oCRNRSTN_n->tidy_boolean($oDDO->preach('data_value', $data_attribute));

                            }else{

                                $tmp_TRY_OTHER_EMAIL_METHODS_ON_ERR = (bool) $oCRNRSTN_n->tidy_boolean($oDDO);

                            }

                        break;

                    }

                }

            }

        }

        //$tmp_config_version_cnt = sizeof($config_data_ARRAY);
        error_log(__LINE__ . ' env class to send email = ' . get_class($oCRNRSTN_n));
        //error_log(__LINE__ . ' $tmp_config_version_cnt=' . $tmp_config_version_cnt);
        //for($config_vs=0; $config_vs < $tmp_config_version_cnt; $config_vs++){

        $tmp_oGabriel_serial = $oCRNRSTN_n->generate_new_key(50);

        switch(get_class($oCRNRSTN_n)){
            case 'crnrstn_user':
            case 'crnrstn_environment':
            case 'crnrstn':

                $tmp_recipient_cnt = count($tmp_RECIPIENT_EMAIL);

                for($i = 0; $i < $tmp_recipient_cnt; $i++){

                    error_log(__LINE__ . ' processing recipient email=' . $tmp_RECIPIENT_EMAIL[$i]);

                    if(!(($tmp_DUP_SUPPRESS == true) && isset($tmp_sent_suppression[strtolower($tmp_RECIPIENT_EMAIL[$i])]))){

                        if($tmp_DUP_SUPPRESS == true){

                            $tmp_sent_suppression[strtolower($tmp_RECIPIENT_EMAIL[$i])] = 1;

                        }

                        $oCRNRSTN_GABRIEL = new crnrstn_messenger_from_north($tmp_oGabriel_serial, $tmp_EMAIL_PROTOCOL, $tmp_SMTP_USERNAME, $tmp_SMTP_PASSWORD, $tmp_SMTP_PORT_OUTGOING, $oCRNRSTN_n);

                        $crnrstn_phpmailer = new \PHPMailer\crnrstn_PHPMailer\crnrstn_PHPMailer($oCRNRSTN_n);
                        $crnrstn_phpmailer->Mailer = strtolower($tmp_EMAIL_PROTOCOL);  // "mail", "qmail", "sendmail", or "smtp".

                        $crnrstn_phpmailer->Priority = $tmp_PRIORITY;
                        $crnrstn_phpmailer->CharSet = $tmp_CHARSET;
                        $crnrstn_phpmailer->Encoding = $tmp_MESSAGE_ENCODING;
                        $crnrstn_phpmailer->Sendmail = $tmp_SENDMAIL_PATH;
                        $crnrstn_phpmailer->UseSendmailOptions = $tmp_USE_SENDMAIL_OPTIONS;

                        if($tmp_isHTML == true){

                            $crnrstn_phpmailer->isHTML();

                        }

                        $crnrstn_phpmailer->WordWrap = $tmp_WORDWRAP;
                        $crnrstn_phpmailer->AllowEmpty = $tmp_ALLOW_EMPTY;

                        $crnrstn_phpmailer->setFrom($tmp_FROM_EMAIL, $tmp_FROM_NAME);

                        //error_log(__LINE__ . ' env - Adding setFrom:' . $tmp_FROM_NAME . ' ' . $tmp_FROM_EMAIL);
                        //$crnrstn_phpmailer->From = $config_data_ARRAY[$config_vs]['FROM_EMAIL'][0];
                        //$crnrstn_phpmailer->FromName = $config_data_ARRAY[$config_vs]['FROM_NAME'][0];

                        $tmp_e_cnt = sizeof($tmp_REPLYTO_EMAIL);
                        if($tmp_e_cnt > 0){

                            for($e_pos=0; $e_pos<$tmp_e_cnt; $e_pos++){

                                $crnrstn_phpmailer->addReplyTo($tmp_REPLYTO_EMAIL[$e_pos], $tmp_REPLYTO_NAME[$e_pos]);
                                //error_log(__LINE__ . ' env - Adding ReplyTo:' . $tmp_REPLYTO_NAME[$e_pos] . ' ' . $tmp_REPLYTO_EMAIL[$e_pos]);

                            }

                        }

                        $tmp_e_cnt = sizeof($tmp_CC_EMAIL);
                        if($tmp_e_cnt > 0){

                            for($e_pos=0; $e_pos<$tmp_e_cnt; $e_pos++){

                                $crnrstn_phpmailer->addCC($tmp_CC_EMAIL[$e_pos], $tmp_CC_NAME[$e_pos]);
                                //error_log(__LINE__ . ' env - Adding CC:' . $tmp_CC_NAME[$e_pos] . ' ' . $tmp_CC_EMAIL[$e_pos]);

                            }

                        }

                        $tmp_e_cnt = sizeof($tmp_BCC_EMAIL);
                        if($tmp_e_cnt > 0){

                            for($e_pos=0; $e_pos<$tmp_e_cnt; $e_pos++){

                                $crnrstn_phpmailer->addBCC($tmp_BCC_EMAIL[$e_pos], $tmp_BCC_NAME[$e_pos]);
                                error_log(__LINE__ . ' env - Adding BCC:' . $tmp_BCC_NAME[$e_pos] . ' ' . $tmp_BCC_EMAIL[$e_pos]);

                            }

                        }

                        switch($tmp_EMAIL_PROTOCOL){
                            case 'SMTP':

                                $crnrstn_phpmailer->Timeout = $tmp_SMTP_TIMEOUT;
                                $crnrstn_phpmailer->SMTPKeepAlive = $tmp_SMTP_KEEPALIVE;
                                $crnrstn_phpmailer->SMTPSecure = $tmp_SMTP_SECURE;
                                $crnrstn_phpmailer->SMTPAutoTLS = $tmp_SMTP_AUTOTLS;

                                if($tmp_SMTP_AUTH == true){

                                    $crnrstn_phpmailer->SMTPAuth = true;
                                    $crnrstn_phpmailer->Username = $tmp_SMTP_USERNAME;
                                    $crnrstn_phpmailer->Password = $tmp_SMTP_PASSWORD;
                                    $crnrstn_phpmailer->Host = $tmp_SMTP_SERVER;
                                    $crnrstn_phpmailer->Port = $tmp_SMTP_PORT_OUTGOING;

                                }

                                if($tmp_DIBYA_SAHOO_SSL_CERT_BYPASS == true){

                                    //
                                    // WORK AROUND FOR PHPMAILER SSL CERT VERIFICATION *ERRORS INTRODUCED
                                    // THROUGH THE STRICTER SSL BEHAVIOR THAT CAME WITH THE RELEASE OF PHP 5.6
                                    // SOURCE :: https://pepipost.com/tutorials/phpmailer-smtp-error-could-not-connect-to-smtp-host/
                                    // AUTHOR :: https://pepipost.com/tutorials/author/dibya-sahoo/
                                    // DETAIL :: https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting#certificate-verification-failure
                                    // * You may not see this error; In implicit encryption mode (SMTPS) it may be
                                    // hidden because there isn't a way for the channel to show messages - SMTP+STARTTLS
                                    // is generally easier to debug because of this.
                                    $crnrstn_phpmailer->SMTPOptions = array(
                                        'ssl' => array(
                                            'verify_peer' => false,
                                            'verify_peer_name' => false,
                                            'allow_self_signed' => true
                                        )
                                    );

                                    error_log(__LINE__ . ' env - DIBYA_SAHOO_SSL_CERT_BYPASS HAS BEEN APPLIED.');

                                }else{

                                    error_log(__LINE__ . ' env - DIBYA_SAHOO_SSL_CERT_BYPASS HAS BEEN BYPASSED.');

                                }

                            break;
                            case 'SENDMAIL':

                                $crnrstn_phpmailer->isSendmail();

                            break;
                            case 'QMAIL':

                                $crnrstn_phpmailer->isQmail();

                            break;
                            case 'MAIL':

                                $crnrstn_phpmailer->isMail();

                            break;

                        }

                        //
                        // CONSTANTS
                        $tmp_php_trace_TEXT = $oCRNRSTN_n->return_PHP_exception_trace_pretty($exception_obj->getTraceAsString(), 'TEXT');
                        $tmp_log_constant_TEXT = $oCRNRSTN_n->return_log_priority_pretty($syslog_constant);
                        $tmp_crnrstn_trace_TEXT = $this->oLog_output_manager->return_log_trace_output_str('EMAIL_TEXT');
                        $crnrstn_phpmailer->Subject = 'Exception Notification from ' . $_SERVER['SERVER_NAME'] . ' via CRNRSTN ::';

                        if($tmp_isHTML == true){

                            $tmp_php_trace_HTML = $oCRNRSTN_n->return_PHP_exception_trace_pretty($exception_obj->getTraceAsString(), 'HTML');
                            $tmp_log_constant_HTML = $oCRNRSTN_n->return_log_priority_pretty($syslog_constant, 'HTML');
                            $tmp_crnrstn_trace_HTML = $this->oLog_output_manager->return_log_trace_output_str('EMAIL_HTML');

                        }

                        if(isset($tmp_RECIPIENT_NAME[$i])){

                            $tmp_name = $tmp_RECIPIENT_NAME[$i];

                        }else{

                            $tmp_name = '';

                        }

                        error_log(__LINE__ . ' env - Adding Recipient:' . $tmp_name . ' ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private'));
                        $crnrstn_phpmailer->AddAddress($tmp_RECIPIENT_EMAIL[$i], $tmp_name);

                        //
                        // PREPARE TEXT VERSION
                        $tmp_TEXT_Body = $oCRNRSTN_GABRIEL->return_CRNRSTN_SysMsgTEXTBody('EXCEPTION_NOTIFICATION');
                        $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{SYSTEM_LOG_INTEGER_CONSTANT}', $tmp_log_constant_TEXT, $tmp_TEXT_Body);
                        $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{MESSAGE}', $tmp_exception_msg, $tmp_TEXT_Body);
                        $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{LINE_NUM}', $tmp_exception_linenum, $tmp_TEXT_Body);
                        $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{METHOD}', $exception_method, $tmp_TEXT_Body);
                        $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{PHP_TRACE}', $tmp_php_trace_TEXT, $tmp_TEXT_Body);
                        $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{SYSTEM_TIME}', $exception_systemtime, $tmp_TEXT_Body);
                        $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{PROCESS_RUN_TIME}', $exception_runtime, $tmp_TEXT_Body);
                        $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{EMAIL}', $tmp_RECIPIENT_EMAIL[$i], $tmp_TEXT_Body);
                        $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{LOG_TRACE}', $tmp_crnrstn_trace_TEXT, $tmp_TEXT_Body);

                        $crnrstn_phpmailer->AltBody = $tmp_TEXT_Body;

                        if($tmp_isHTML){

                            //
                            // PREPARE HTML VERSION
                            $tmp_HTML_Body = $oCRNRSTN_GABRIEL->return_CRNRSTN_SysMsgHTMLBody('EXCEPTION_NOTIFICATION');
                            $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{SYSTEM_LOG_INTEGER_CONSTANT}', $tmp_log_constant_HTML, $tmp_HTML_Body);
                            $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{MESSAGE}', $tmp_exception_msg, $tmp_HTML_Body);
                            $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{LINE_NUM}', $tmp_exception_linenum, $tmp_HTML_Body);
                            $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{METHOD}', $exception_method, $tmp_HTML_Body);
                            $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{PHP_TRACE}', $tmp_php_trace_HTML, $tmp_HTML_Body);
                            $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{SYSTEM_TIME}', $exception_systemtime, $tmp_HTML_Body);
                            $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{PROCESS_RUN_TIME}', $exception_runtime, $tmp_HTML_Body);
                            $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{EMAIL}', $tmp_RECIPIENT_EMAIL[$i], $tmp_HTML_Body);
                            $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{LOG_TRACE}', $tmp_crnrstn_trace_HTML, $tmp_HTML_Body);

                            $crnrstn_phpmailer->Body = $tmp_HTML_Body;

                        }

                        error_log(__LINE__ . ' env - crnrstn_phpmailer->send()');

                        $crnrstn_phpmailer->Mailer = strtolower($tmp_EMAIL_PROTOCOL);  // "mail", "qmail", "sendmail", or "smtp".

                        if(!($crnrstn_phpmailer->Send() == true)){

                            if($tmp_TRY_OTHER_EMAIL_METHODS_ON_ERR == true){

                                $oCRNRSTN_n->error_log('An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Graceful degradation to secondary email send protocol is commencing due to: ' . $crnrstn_phpmailer->ErrorInfo, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                                error_log(__LINE__ . ' - An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Graceful degradation to secondary email send protocol is commencing due to: ' . $crnrstn_phpmailer->ErrorInfo);

                                $crnrstn_phpmailer = $this->next_mail_protocol_option($crnrstn_phpmailer);
                                if(!($crnrstn_phpmailer->Send() == true)){

                                    $oCRNRSTN_n->error_log('An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Graceful degradation to tertiary email send protocol is commencing due to: ' . $crnrstn_phpmailer->ErrorInfo, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                                    error_log(__LINE__ . ' - An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Graceful degradation to tertiary email send protocol is commencing due to: ' . $crnrstn_phpmailer->ErrorInfo);

                                    $crnrstn_phpmailer = $this->next_mail_protocol_option($crnrstn_phpmailer);
                                    if(!($crnrstn_phpmailer->Send() == true)){

                                        $oCRNRSTN_n->error_log('An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Graceful degradation to quatiary email send protocol is commencing due to: ' . $crnrstn_phpmailer->ErrorInfo, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                                        error_log(__LINE__ . ' - An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Graceful degradation to quatiary email send protocol is commencing due to: ' . $crnrstn_phpmailer->ErrorInfo);

                                        $crnrstn_phpmailer = $this->next_mail_protocol_option($crnrstn_phpmailer);
                                        if(!($crnrstn_phpmailer->Send() == true)){

                                            $oCRNRSTN_n->error_log('An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Graceful degradation to pentiary email send protocol is commencing due to: ' . $crnrstn_phpmailer->ErrorInfo, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                                            error_log(__LINE__ . ' - An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Graceful degradation to pentiary email send protocol is commencing due to: ' . $crnrstn_phpmailer->ErrorInfo);

                                            $crnrstn_phpmailer = $this->next_mail_protocol_option($crnrstn_phpmailer);
                                            if(!($crnrstn_phpmailer->Send() == true)){

                                                //
                                                // ...on my usage of the term "hexapolynomial"...as being of the
                                                // same ilk as usages (contained also herein) of secondary,
                                                // tertiary, etc...I feel pretty good standing in the shadow
                                                // of the following...
                                                //
                                                // - J5, November 9, 2020 0845hrs
                                                //
                                                // SOURCE :: https://ieeexplore.ieee.org/abstract/document/9195628
                                                // AUTHOR :: https://ieeexplore.ieee.org/author/37086360445
                                                // This paper discusses twice continuously differentiable and three times
                                                // continuously differentiable approximations with polynomial and
                                                // non-polynomial splines. To construct the approximation, a polynomial and
                                                // non-polynomial local basis of the second level and the sixth order
                                                // approximation is constructed. We call the approximation a second level
                                                // approximation because it uses the first and the second derivatives of the
                                                // function. The non-polynomial approximation has the properties of
                                                // polynomial and trigonometric functions. Here we have also constructed a
                                                // non-polynomial interpolating spline which has the first, the second and
                                                // the third continuous derivative. This approximation uses the values of
                                                // the function at the nodes, the values of the first derivative of the
                                                // function at the nodes and the values of the second derivative of the
                                                // function at the ends of the interval [a, b]. The theorems of the
                                                // approximations are given. Numerical examples are given.
                                                //
                                                // - I. G. Burova,
                                                // St. Petersburg State University,
                                                // Dept. of Computational Mathematics

                                                $oCRNRSTN_n->error_log('An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Attempting final graceful degradation...hexapolynomial in nature...albeit CRNRSTN :: has, at this point, already measured and found to be wanting the fifth (5th) and final email send use case of the four (4) official and available protocols for things of this nature per /crnrstn_PHPMailer/. TLDR; ...an empty string will now be sent as the mailer protocol, and the results for which what one would hope...could only be the best. ' . $crnrstn_phpmailer->ErrorInfo, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                                                error_log(__LINE__ . 'An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Attempting final graceful degradation...hexapolynomial in nature...albeit CRNRSTN :: has, at this point, already measured and found to be wanting the fifth (5th) and final email send use case of the four (4) official and available protocols for things of this nature per /crnrstn_PHPMailer/. TLDR; ...an empty string will now be sent as the mailer protocol, and the results for which what one would hope...could only be the best. ' . $crnrstn_phpmailer->ErrorInfo);

                                                $crnrstn_phpmailer = $this->next_mail_protocol_option($crnrstn_phpmailer);
                                                if(!$crnrstn_phpmailer->Send()){

                                                    $oCRNRSTN_n->error_log('An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . '. Abandoning email delivery efforts due to: ' . $crnrstn_phpmailer->ErrorInfo, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                                                    error_log(__LINE__ . ' - An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . '. Abandoning email delivery efforts due to: ' . $crnrstn_phpmailer->ErrorInfo);

                                                }

                                            }

                                        }

                                    }else{

                                        error_log(__LINE__ . ' - A SUCCESS was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '.');

                                    }

                                }else{

                                    error_log(__LINE__ . ' - A SUCCESS was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '.');

                                }

                            }else{

                                $oCRNRSTN_n->error_log('An error was experienced while attempting to send an email to '.$oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Abandoning email delivery efforts due to: ' . $crnrstn_phpmailer->ErrorInfo, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                                error_log(__LINE__ . ' - An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Abandoning email delivery efforts due to: ' . $crnrstn_phpmailer->ErrorInfo);

                            }

                        }else{

                            error_log(__LINE__ . ' - A SUCCESS was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '.');

                        }

                        array_splice($this->mail_protocol_flag_ARRAY, 0);

                        //
                        // CLEAR SEND DATA (ALSO ANY MESSAGE ATTACHMENTS CLEARED)
                        $crnrstn_phpmailer->ClearAddresses();

                    }

                }

                if(isset($tmp_SMTP_KEEPALIVE)){

                    if($tmp_SMTP_KEEPALIVE == true){

                        $crnrstn_phpmailer->smtpClose();

                    }

                }

                break;
        }

        //}

        return true;

    }

    private function no_cars_go_FILE($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj){

        $this->load_log_output_mgr($oCRNRSTN_n);

        $tmp_LOCAL_DIR_FILEPATH = array();
        $tmp_LOCAL_MKDIR_MODE = array();

        //
        // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
        foreach($this->profile_endpoint_data_ARRAY as $config_version => $chunkArray0){

            //error_log(__LINE__ . ' env - should be (more than one) ' . $tmp_size . '...config_version=' . $config_version);

            foreach($chunkArray0 as $data_attribute => $chunkArray1){

                foreach($chunkArray1 as $content_count => $oDDO){

                    switch($data_attribute){
                        case 'LOCAL_DIR_PATH':
                        case 'LOCAL_DIR_FILEPATH':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach LOCAL_DIR_FILEPATH cnt=' . $oDDO->count($data_attribute));

                                $tmp_LOCAL_DIR_FILEPATH[] = $oDDO->preach('data_value', $data_attribute);

                            }else{

                                $tmp_LOCAL_DIR_FILEPATH[] = $oDDO;

                            }

                        break;
                        case 'LOCAL_MKDIR_MODE':

                            if(is_object($oDDO)){

                                //error_log(__LINE__ . ' env die() preach LOCAL_DIR_FILEPATH cnt=' . $oDDO->count($data_attribute));

                                $tmp_LOCAL_MKDIR_MODE[] = $oDDO->preach('data_value', $data_attribute);

                            }else{

                                $tmp_LOCAL_MKDIR_MODE[] = $oDDO;

                            }

                        break;

                    }

                    //error_log(__LINE__ . ' env - [' . $config_version . '] [' . $data_attribute . '] [' . $content_count . '] [' . $oDDO . ']');

                }

            }

        }

        switch(get_class($oCRNRSTN_n)){
            case 'crnrstn_user':
            case 'crnrstn_environment':
            case 'crnrstn':

                //
                // CONSTANTS
                $tmp_php_trace_TEXT = $oCRNRSTN_n->return_PHP_exception_trace_pretty($exception_obj->getTraceAsString(), 'TEXT');
                $tmp_log_constant_TEXT = $oCRNRSTN_n->return_log_priority_pretty($syslog_constant);
                $tmp_crnrstn_trace_TEXT = $this->oLog_output_manager->return_log_trace_output_str('FILE', 0);

                //$tmp_config_version_cnt = sizeof($config_data_ARRAY);
                //error_log(__LINE__ . ' env class to log to file is ' . get_class($oCRNRSTN_n) . ' and the logging object profile integer type is ' . $this->logging_profile);

                $tmp_log_output = $tmp_crnrstn_trace_TEXT . '
' . $tmp_php_trace_TEXT . '
';

                //
                // CHECK FILE SPECIFIC ARRAY AND PUSH TO ALL.
                foreach($tmp_LOCAL_DIR_FILEPATH as $key => $log_filepath){

                    if(isset($tmp_LOCAL_MKDIR_MODE[$key])){

                        $this->output_to_local_file($oCRNRSTN_n, $tmp_log_output, $log_filepath, $tmp_LOCAL_MKDIR_MODE[$key]);

                    }else{

                        $this->output_to_local_file($oCRNRSTN_n, $tmp_log_output, $log_filepath);

                    }

                }

                break;

        }

        return true;

    }

    private function no_cars_go_LOG_FILE_FTP($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj){

        $this->load_log_output_mgr($oCRNRSTN_n);

        $tmp_val_tunnel_ARRAY = array();

        //
        // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
        foreach($this->profile_endpoint_data_ARRAY as $config_version => $chunkArray0){

            //error_log(__LINE__ . ' env - should be (more than one) ' . $tmp_size . '...config_version=' . $config_version);

            foreach($chunkArray0 as $data_attribute => $chunkArray1){

                foreach($chunkArray1 as $content_count => $oDDO){

                    switch($data_attribute){
                        case 'FTP_SERVER':

                            $tmp_FTP_SERVER = $oDDO->preach('data_value', $data_attribute);

                        break;
                        case 'FTP_USERNAME':

                            $tmp_FTP_USERNAME = $oDDO->preach('data_value', $data_attribute);

                        break;
                        case 'FTP_PASSWORD':

                            $tmp_FTP_PASSWORD = $oDDO->preach('data_value', $data_attribute);

                        break;
                        case 'FTP_PORT':

                            $tmp_FTP_PORT = $oDDO->preach('data_value', $data_attribute);

                        break;
                        case 'FTP_TIMEOUT':

                            $tmp_FTP_IS_SSL = $oDDO->preach('data_value', $data_attribute);

                        break;
                        case 'FTP_IS_SSL':

                            $tmp_FTP_IS_SSL = $oDDO->preach('data_value', $data_attribute);

                        break;
                        case 'FTP_USE_PASV':

                            $tmp_FTP_USE_PASV = $oDDO->preach('data_value', $data_attribute);

                        break;
                        case 'FTP_USE_PASV_ADDR':

                            $tmp_FTP_USE_PASV_ADDR = $oDDO->preach('data_value', $data_attribute);

                        break;
                        case 'FTP_DISABLE_AUTOSEEK':

                            $tmp_FTP_DISABLE_AUTOSEEK = $oDDO->preach('data_value', $data_attribute);

                        break;
                        case 'FTP_DIR_PATH':

                            $tmp_FTP_DIR_PATH = $oDDO->preach('data_value', $data_attribute);

                        break;
                        case 'FTP_MKDIR_MODE':

                            $tmp_FTP_MKDIR_MODE = $oDDO->preach('data_value', $data_attribute);

                        break;

                    }

                }

            }

        }

        //
        // READY TO CREATE FILE AND SEND VIA CRNRSTN :: ELECTRUM
        switch(get_class($oCRNRSTN_n)){
            case 'crnrstn_user':
            case 'crnrstn_environment':
            case 'crnrstn':

                //
                // CONSTANTS
                $tmp_php_trace_TEXT = $oCRNRSTN_n->return_PHP_exception_trace_pretty($exception_obj->getTraceAsString(), 'TEXT');
                $tmp_log_constant_TEXT = $oCRNRSTN_n->return_log_priority_pretty($syslog_constant);
                $tmp_crnrstn_trace_TEXT = $this->oLog_output_manager->return_log_trace_output_str('FILE', 0);

                //$tmp_config_version_cnt = sizeof($config_data_ARRAY);
                error_log(__LINE__ . ' env class to log to FTP_FILE is ' . get_class($oCRNRSTN_n) . ' and the logging object profile integer type is ' . $this->logging_profile);

                $tmp_log_output = $tmp_crnrstn_trace_TEXT . '
' . $tmp_php_trace_TEXT . '
';

                //
                // CHECK FILE SPECIFIC ARRAY AND PUSH TO ALL.
                foreach($tmp_val_tunnel_ARRAY as $config_ver => $attribute_array){

                    $this->output_to_file_ftp($oCRNRSTN_n, $tmp_log_output, $attribute_array);

                }

                break;

        }

        return true;

    }

    private function no_cars_go_SCREEN_HTML($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj){

        $this->load_log_output_mgr($oCRNRSTN_n);

        //
        // CONSTANTS
        $tmp_php_trace_TEXT = $oCRNRSTN_n->return_PHP_exception_trace_pretty($exception_obj->getTraceAsString(), 'TEXT');
        $tmp_log_constant_TEXT = $oCRNRSTN_n->return_log_priority_pretty($syslog_constant);
        $tmp_crnrstn_trace_TEXT = $this->oLog_output_manager->return_log_trace_output_str('FILE', 0);

        $tmp_log_output = $tmp_crnrstn_trace_TEXT . '
' . $tmp_php_trace_TEXT . '
';
        error_log(__LINE__ . ' env no_cars_go_SCREEN_HTML() [' . get_class($oCRNRSTN_n) . '] self class=' . get_class(self::$oCRNRSTN_n));
//die();
        $oCRNRSTN_n->destruct_output .= $oCRNRSTN_n->print_r_str($tmp_log_output, $tmp_log_constant_TEXT, NULL, __LINE__, __METHOD__, __FILE__);
        self::$oCRNRSTN_n = $oCRNRSTN_n;

        return true;

    }

    private function no_cars_go_SCREEN_TEXT($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj){

        $this->load_log_output_mgr($oCRNRSTN_n);

        //
        // CONSTANTS
        $tmp_php_trace_TEXT = $oCRNRSTN_n->return_PHP_exception_trace_pretty($exception_obj->getTraceAsString(), 'TEXT');
        $tmp_log_constant_TEXT = $oCRNRSTN_n->return_log_priority_pretty($syslog_constant);
        $tmp_crnrstn_trace_TEXT = $this->oLog_output_manager->return_log_trace_output_str('SCREEN_TEXT', 74);

        $tmp_log_output = $tmp_crnrstn_trace_TEXT . '
' . $tmp_php_trace_TEXT . '
';

        $oCRNRSTN_n->destruct_output .= $tmp_log_output;

        return true;

    }

    private function no_cars_go_SCREEN_HTML_HIDDEN($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj){

        $this->load_log_output_mgr($oCRNRSTN_n);

        switch(get_class($oCRNRSTN_n)){
            case 'crnrstn_user':
            case 'crnrstn_environment':
            case 'crnrstn':

                //
                // CONSTANTS
                $tmp_php_trace_TEXT = $oCRNRSTN_n->return_PHP_exception_trace_pretty($exception_obj->getTraceAsString(), 'TEXT');
                $tmp_log_constant_TEXT = $oCRNRSTN_n->return_log_priority_pretty($syslog_constant);
                $tmp_crnrstn_trace_TEXT = $this->oLog_output_manager->return_log_trace_output_str('FILE', 0);

                $tmp_log_output = $tmp_crnrstn_trace_TEXT . '
' . $tmp_php_trace_TEXT . '
';

                $tmp_hidden_html = '<!--
' . htmlentities($tmp_log_output) . '
-->
';

                $oCRNRSTN_n->destruct_output .= $tmp_hidden_html;

                break;

        }

        return true;

    }

    private function no_cars_go_DEFAULT($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj){

        $this->load_log_output_mgr($oCRNRSTN_n);

        switch(get_class($oCRNRSTN_n)){
            case 'crnrstn_user':
            case 'crnrstn_environment':
            case 'crnrstn':

                //
                // CONSTANTS
                $tmp_php_trace_TEXT = $oCRNRSTN_n->return_PHP_exception_trace_pretty($exception_obj->getTraceAsString(), 'TEXT');
                $tmp_log_constant_TEXT = $oCRNRSTN_n->return_log_priority_pretty($syslog_constant);
                $tmp_crnrstn_trace_TEXT = $this->oLog_output_manager->return_log_trace_output_str('ERROR_LOG', 0);

                error_log($tmp_crnrstn_trace_TEXT);
                error_log($tmp_php_trace_TEXT);

                break;

        }

        return true;

    }

    private function output_to_file_ftp($oCRNRSTN_n, $tmp_log_output, $attribute_array){

        //error_log(__LINE__ . ' env output_to_file_ftp [' . $tmp_log_output . ']]');

//        $tmp_FTP_SERVER = array();
//        $tmp_FTP_USERNAME = array();
//        $tmp_FTP_PASSWORD = array();
//        $tmp_FTP_PORT = array();
//        $tmp_FTP_TIMEOUT = array();
//        $tmp_FTP_IS_SSL = array();
//        $tmp_FTP_USE_PASV = array();
//        $tmp_FTP_USE_PASV_ADDR = array();
//        $tmp_FTP_DISABLE_AUTOSEEK = array();
//        $tmp_FTP_DIR_PATH = array();
//        $tmp_FTP_MKDIR_MODE = array();

        foreach($this->profile_endpoint_criteria_ARRAY[CRNRSTN_LOG_FILE_FTP] as $key => $value){

            //error_log(__LINE__ . ' env profile_endpoint_criteria_ARRAY [' . print_r($key,true) . '] [' . print_r($value,true) . ']');

            if(isset($attribute_array[$key])){

                if(is_object($attribute_array[$key][0])){

                    error_log(__LINE__ . ' env output_to_file_ftp [' . $key . '][OBJECT]');

                }else{

                    error_log(__LINE__ . ' env output_to_file_ftp [' . $key . '][' . print_r($attribute_array[$key][0], true) . ']');

                }

            }else{

                error_log(__LINE__ . ' env output_to_file_ftp NO SET=[' . $key . '][' . print_r($attribute_array[$key], true) . ']');

            }

        }

        // self::$crnrstn_tmp_dir

        switch(get_class($oCRNRSTN_n)){
            case 'crnrstn':

                if($tmp_crnrstn_tmp_dir == $oCRNRSTN_n->return_tmp()){

                    error_log(__LINE__ . ' env Ready to write to /tmp ....the error log file for FTP delivery (See wind_cloud_fire line 3088 area).');

                    $file_source_path = $this->output_to_local_file($oCRNRSTN_n, $tmp_log_output, $tmp_crnrstn_tmp_dir);

                    error_log(__LINE__ . ' env Completed write of file [' . $file_source_path . '][' . $oCRNRSTN_n->format_bytes(filesize($file_source_path)) . ']');

                }else{

                    error_log(__LINE__ . ' env Unable to write /tmp error log file for FTP delivery due to missing embryonic /tmp dir.');

                }

            break;
            default:

                error_log(__LINE__ . ' env DEFAULT!!!');

            break;

        }

        $ftp_stream_target = NULL;

//        if(self::$oCRNRSTN_n->file_local_send_by_ftp($ftp_stream_target, $file_source_path, $oEndpoint_serial_SOURCE, $oEndpoint_serial_DESTINATION, $oElectrum_STATS)){
//
//            //if($this->fileMove_DIR_DF($dest_ftp_stream, $dest_FTP_ROOT_DIR_PATH, $this->DESTINATION_FILE_PATH, $SOURCE_filePath)){
//
//            $this->is_transferred = true;
//
//            //self::$oCRNRSTN_USR->error_log('oWheel TMP file write TO FTP SUCCESS. REMOVE TMP FILE.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');
//
//        }else{
//
//            $error = error_get_last();
//            self::$oCRNRSTN_n->error_log('oWheel fileMove_DF() ERROR :: '.$error['message'], __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');
//
//        }

        unlink($file_source_path);

    }

    private function output_to_local_file($oCRNRSTN_n, $str, $file_path, $mkdir_permissons_mode = 775){

        if(is_dir($file_path)){

            if($this->validate_DIR_endpoint('DESTINATION', $file_path, $mkdir_permissons_mode) == true){

                //
                // WE HAVE A DIRECTORY PATH...NO FILE NAME PROVIDED; CREATE ONE.
                $tmp_filename = 'crnrstn_errlog_' . $_SERVER['SERVER_NAME'];

                $file_path = rtrim($file_path,DIRECTORY_SEPARATOR);

                $file_path = $file_path.DIRECTORY_SEPARATOR.$tmp_filename . '.txt';

            }else{

                //
                // CRNRSTN :: CANNOT WRITE LOG FILE DUE TO END POINT NOT VALID
                self::$oCRNRSTN_n->error_log('Unable to write data to local directory file, ' . $file_path . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY_FILE);

                return false;

            }

        }else{

            //
            // WE HAVE PROPER FILE PATH.
            $tmp_sniffed_dir = dirname($file_path);

            if(!($this->validate_DIR_endpoint('DESTINATION', $tmp_sniffed_dir, $mkdir_permissons_mode) == true)){

                self::$oCRNRSTN_n->error_log('Unable to write data to local directory file, ' . $file_path . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY_FILE);

                return false;

            }

        }

        //
        // VALIDATE FILE PATH ON FILE OPEN FOR APPEND
        if($fp = fopen($file_path, 'a')){

            fwrite($fp, $str);
            fclose($fp);

            return $file_path;

        }else{

            //
            // MODIFY DIRECTORY PERMISSIONS
            self::$oCRNRSTN_n->error_log('CRNRSTN :: Unable to locate the provided path and/or open/create file for write only (i.e. append) at filepath="' . $file_path . '".', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY_FILE);

            return false;

        }

    }

    private function validate_DIR_endpoint($flow_type, $dir_path, $permissions_chmod = 775){

        switch($flow_type){
            case 'SOURCE':

                if(is_dir($dir_path)){

                    //
                    // SOURCE - LOCAL_DIR
                    if(is_readable($dir_path)){

                        return true;

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        self::$oCRNRSTN_n->error_log('CRNRSTN :: has experienced permissions related errors attempting to read from the source directory, ' . $dir_path . '.');

                    }

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    self::$oCRNRSTN_n->error_log('CRNRSTN :: has experienced errors attempting to find the source directory, ' . $dir_path . ', within the local file system.');

                }

            break;
            default:

                //
                // DESTINATION - LOCAL_DIR
                if(is_dir($dir_path)){

                    if(is_writable($dir_path)){

                        //error_log(__LINE__ . ' ' . __METHOD__ . ' env THE DIRECTORY IS WRITABLE!');

                        return true;

                    }else{

                        error_log(__LINE__ . ' ' . __METHOD__ . ' env THE DIRECTORY IS **NOT** WRITABLE!');

                        //
                        // ATTEMPT TO CHANGE PERMISSIONS AND CHECK AGAIN
                        // BEFORE COMPLETELY GIVING UP
                        $tmp_current_perms = substr(decoct( fileperms($dir_path) ), 2);
                        $tmp_config_serial_hash = self::$oCRNRSTN_n->config_serial_hash;

                        self::$oCRNRSTN_n->err_message_queue_push(NULL, 'CRNRSTN :: has experienced permissions related error as the destination directory, ' . $dir_path . ' (' . $tmp_current_perms . '), is NOT writable to ' . $permissions_chmod . ', and furthermore ');
                        if(chmod($dir_path, $permissions_chmod)){

                            self::$oCRNRSTN_n->err_message_queue_clear();
                            return true;

                        }else{

                            $tmp_current_perms = substr(decoct( fileperms($dir_path) ), 2);

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            self::$oCRNRSTN_n->error_log('CRNRSTN :: has experienced permissions related error as the destination directory, ' . $dir_path . ', is NOT writable with current permissions as ' . $tmp_current_perms . '.');

                        }

                    }

                }else{

                    //
                    // ATTEMPT TO MAKE DIRECTORY
                    // BEFORE COMPLETELY GIVING UP
                    if(!self::$oCRNRSTN_n->mkdir_r($dir_path, $permissions_chmod)){

                        $permissions_chmod = octdec( str_pad($permissions_chmod,4,'0',STR_PAD_LEFT) );

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        self::$oCRNRSTN_n->error_log('CRNRSTN :: has experienced error as the destination directory, ' . $dir_path . ', does NOT exist, and it could NOT be created as ' . $permissions_chmod . '.');

                    }else{

                        return true;

                    }

                }

            break;

        }

        return false;

    }

    //
    // SOURCE :: https://www.youtube.com/watch?v=83KR_UBWdPI
    // TITLE :: Arcade Fire - No Cars Go
    public function no_cars_tification_go($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj){

        switch($this->logging_profile){
            case CRNRSTN_LOG_SCREEN:
            case CRNRSTN_LOG_SCREEN_HTML:

                return $this->no_cars_go_SCREEN_HTML($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj);

            break;
            case CRNRSTN_LOG_SCREEN_TEXT:

                return $this->no_cars_go_SCREEN_TEXT($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj);

            break;
            case CRNRSTN_LOG_SCREEN_HTML_HIDDEN:

                return $this->no_cars_go_SCREEN_HTML_HIDDEN($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj);

            break;
            case CRNRSTN_LOG_EMAIL:

                //
                // DEFAULT CRNRSTN CONFIGURATION - RECOMMENDATION FOR CONFIG PRIORITY ::
                // EMAIL_PRIMARY = [n] USER SELECTION
                // EMAIL_SECONDARY = SENDMAIL (NO AUTHENTICATION) WITH CRNRSTN WCR CONFIGURATION
                // EMAIL_TERTIARY = MAIL (NO AUTHENTICATION) WITH CRNRSTN WCR CONFIGURATION
                // *EMAIL_QUATIARY = QMAIL (NO AUTHENTICATION) WITH CRNRSTN WCR CONFIGURATION
                // *EMAIL_PENTIARY = UNAUTHENTICATED SMTP WITH CRNRSTN WCR CONFIGURATION
                // *EMAIL_HEXAPOLYNOMIALLY = NULL MODE FIRE
                // * UNTESTED

                return $this->no_cars_go_EMAIL($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj);

            break;
            case CRNRSTN_LOG_EMAIL_PROXY:

                /*
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CRNRSTN_SOAP_SVC_AUTH_KEY'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CRNRSTN_PROXY_CONNECTION_ID'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOA_NAMESPACE'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['WSDL_URI'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['WSDL_CACHE_TTL'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['NUSOAP_USECURL'] = 1;

                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_SECRET_KEY'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_CIPHER'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_OPTIONS'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_HMAC_ALG'] = 1;

                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['EMAIL_PROTOCOL'] = 1;
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
                 * */
                //error_log(__LINE__ . ' env - would run no_cars_go_EMAIL_PROXY() now for :: ' . $tmp_exception_output_str);
                //$tmp_resp = $this->no_cars_go_EMAIL_PROXY($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj);
                //error_log(__LINE__ . ' env - no_cars_go_EMAIL_PROXY return=[' . $tmp_resp . ']');
                //die();

                return $this->no_cars_go_EMAIL_PROXY($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj);

            break;
            case CRNRSTN_LOG_FILE:

                return $this->no_cars_go_FILE($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj);

            break;
            case CRNRSTN_LOG_FILE_FTP:

                return $this->no_cars_go_LOG_FILE_FTP($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj);

            break;
            case CRNRSTN_LOG_DEFAULT:
            default:

                //error_log(__LINE__ . ' env ABOUT TO TRY TO no_cars_go_DEFAULT()...');

                //
                // NATIVE PHP ERROR LOGGING
                return $this->no_cars_go_DEFAULT($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj);

            break;

        }

        return false;

    }

    public function client_send_CRNRSTN_SOAP_REQUEST($SOAP_method, $SOAP_request, $SOAP_endpoint=NULL){

        if(!isset($SOAP_endpoint)){

            $SOAP_endpoint = $this->oSoapDataTransportLayer->preach('data_value', 'WSDL_URI');

        }

        $WSDL_cache_ttl = $this->oSoapDataTransportLayer->preach('data_value', 'WSDL_CACHE_TTL');
        $nusoap_useCURL = $this->oSoapDataTransportLayer->preach('data_value', 'NUSOAP_USECURL');

        //
        // INSTANTIATE SOAP CLIENT
        $this->oSoapClient = new crnrstn_soap_client_manager(self::$oCRNRSTN_n, $SOAP_endpoint, $WSDL_cache_ttl, $nusoap_useCURL);

        //return $this->oSoapClient->sendRequest_SOAP($SOAP_method, $SOAP_request);
        self::$oCRNRSTN_n->print_r($SOAP_request, 'SEND CLIENT REQUEST :: ' . $SOAP_method, NULL, __LINE__, __METHOD__, __FILE__);
        $tmp_resp = $this->oSoapClient->sendRequest_SOAP($SOAP_method, $SOAP_request);
        self::$oCRNRSTN_n->print_r($tmp_resp, 'OUTPUT SERVER RESPONSE :: ' . $SOAP_method, NULL, __LINE__, __METHOD__, __FILE__);

        $tmp_title = 'Description: ' . $SOAP_method . ' returnError output.';
        $tmp_err = $this->oSoapClient->returnError();
        $tmp_arr = array();
        $tmp_arr[] = $tmp_title;
        $tmp_arr[] = $tmp_err;

        self::$oCRNRSTN_n->print_r($tmp_arr, 'SERVER RESPONSE :: ' . $SOAP_method . ' oSoapClient->returnError', NULL, __LINE__, __METHOD__, __FILE__);
        //self::$oCRNRSTN_n->print_r($this->oSoapClient->returnClientResponse(), 'SERVER RESPONSE :: ' . $SOAP_method . ' oSoapClient->returnClientResponse', NULL, __LINE__, __METHOD__, __FILE__);
        //self::$oCRNRSTN_n->print_r($this->oSoapClient->returnClientGetDebug(), 'SERVER RESPONSE :: ' . $SOAP_method . ' oSoapClient->returnClientGetDebug', NULL, __LINE__, __METHOD__, __FILE__);

        return $tmp_resp;
        //die();
    }

    private function next_mail_protocol_option($crnrstn_phpmailer){

        for($i = 0; $i < $this->tmp_mail_protocol_options_cnt; $i++){

            if(!isset($this->mail_protocol_flag_ARRAY[$this->tmp_mail_protocol_options_ARRAY[$i]])){

                $this->mail_protocol_flag_ARRAY[$this->tmp_mail_protocol_options_ARRAY[$i]] = 1;

                switch($this->tmp_mail_protocol_options_ARRAY[$i]){
                    case 'SMTP':

                        $crnrstn_phpmailer->SMTPAuth = false;
                        $crnrstn_phpmailer->Mailer = strtolower($this->tmp_mail_protocol_options_ARRAY[$i]);

                    break;
                    default:

                        $crnrstn_phpmailer->Mailer = strtolower($this->tmp_mail_protocol_options_ARRAY[$i]);

                    break;

                }

                return $crnrstn_phpmailer;

            }

        }

        $crnrstn_phpmailer->SMTPAuth = false;
        $crnrstn_phpmailer->Mailer = '';

        return $crnrstn_phpmailer;

    }

    public function receive_profile_EMAIL_WCR($oWCR, $WCR_key){

        $this->isValid = true;

        //
        // I AM EMAIL PROFILE. RECEIVE EMAIL WCR DATA.
        $this->wcr_profiles_cnt++;

        //error_log(__LINE__ . ' profile_endpoint_criteria_ARRAY=' . print_r($this->profile_endpoint_criteria_ARRAY, true));

        //
        // *ALL* POSSIBLE EMAIL WCR KEYS
        foreach($this->profile_endpoint_criteria_ARRAY[CRNRSTN_LOG_EMAIL] as $param_key => $value){

            //error_log(__LINE__ . ' env - Checking for existence of ' . $param_key . ' data within config init oWCR, ' . $WCR_key);

            if($oWCR->isset_WCR($WCR_key, $param_key) == true){

                //error_log(__LINE__ . ' env - Found existence of ' . $param_key . ' data within config init oWCR, ' . $WCR_key);
                $tmp_wcr_data = $oWCR->get_attribute($WCR_key, $param_key);

                if(is_object($tmp_wcr_data)){

                    switch($param_key){
                        case 'RECIPIENTS_NAME_PIPED':
                        case 'REPLYTO_NAME_PIPED':
                        case 'CC_NAME_PIPED':
                        case 'BCC_NAME_PIPED':
                        break;
                        case 'RECIPIENTS_EMAIL_PIPED':

                            $tmp_name_array = array();
                            $tmp_name_data = $oWCR->get_attribute($WCR_key, 'RECIPIENTS_NAME_PIPED');

                            //preach('isset', key). ..
                            //preach('type')
                            //preach('value')

                            if($tmp_name_data->preach('isset', $param_key) == true){

                                $tmp_name_array = explode('|', $tmp_name_data->preach('data_value', $param_key));

                            }

                            $this->receive_profile_EMAIL($tmp_wcr_data, $param_key, $tmp_name_array);

                        break;
                        case 'REPLYTO_EMAIL_PIPED':

                            $tmp_name_array = array();
                            $tmp_name_data = $oWCR->get_attribute($WCR_key, 'REPLYTO_NAME_PIPED');

                            if($tmp_name_data->preach('isset', $param_key) == true){

                                $tmp_name_array = explode('|', $tmp_name_data->preach('data_value', $param_key));

                            }

                            $this->receive_profile_EMAIL($tmp_wcr_data, $param_key, $tmp_name_array);

                        break;
                        case 'CC_EMAIL_PIPED':

                            $tmp_name_array = array();
                            $tmp_name_data = $oWCR->get_attribute($WCR_key, 'CC_NAME_PIPED');

                            if($tmp_name_data->preach('isset', $param_key) == true){

                                $tmp_name_array = explode('|', $tmp_name_data->preach('data_value', $param_key));

                            }

                            $this->receive_profile_EMAIL($tmp_wcr_data, $param_key, $tmp_name_array);

                        break;
                        case 'BCC_EMAIL_PIPED':

                            $tmp_name_array = array();
                            $tmp_name_data = $oWCR->get_attribute($WCR_key, 'BCC_NAME_PIPED');

                            if($tmp_name_data->preach('isset', $param_key) == true){

                                $tmp_name_array = explode('|', $tmp_name_data->preach('isset', $param_key));

                            }

                            $this->receive_profile_EMAIL($tmp_wcr_data, $param_key, $tmp_name_array);

                        break;
                        default:

                            //error_log(__LINE__ . ' env - profile_endpoint_data_ARRAY storing[' . $this->wcr_profiles_cnt . '][' . $param_key . '][' . get_class($tmp_wcr_data) . ']');
                            $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt][strtoupper($param_key)][] = $tmp_wcr_data;
                            $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt][strtoupper($param_key)][] = 1;

                        break;

                    }

                }

            }

        }

    }

    public function receive_profile_EMAIL($oDDO, $param_key, $name_array = NULL){

        $this->isValid = true;

        //
        // I AM EMAIL PROFILE. RECEIVE EMAIL DATA.
        #$oWCR->add_attribute('RECIPIENTS_EMAIL_PIPED', 'Jonathan J5 Harris c00000101@gmail.com|jharris@eVifweb.com');
        #$oWCR->add_attribute('RECIPIENTS_NAME_PIPED', '|Jonathan J5 Harris');
        //error_log(__LINE__ . ' - I AM EMAIL PROFILE. RECEIVE EMAIL DATA. ' . $oDDO);
        if(is_object($oDDO)){

            $tmp_email_name_ARRAY = $this->reformat_pipe_data(CRNRSTN_LOG_EMAIL, $oDDO->preach('data_value', $param_key));

        }else{

            $tmp_email_name_ARRAY = $this->reformat_pipe_data(CRNRSTN_LOG_EMAIL, $oDDO);

        }

        #$tmp_email_name_ARRAY['email'][]
        #$tmp_email_name_ARRAY['name'][]

        //return $tmp_email_name_ARRAY;
        $tmp_e_cnt = sizeof($tmp_email_name_ARRAY['email']);
        for($i = 0; $i < $tmp_e_cnt; $i++){

            switch($param_key){
                case 'RECIPIENTS_EMAIL_PIPED':

                    //error_log(__LINE__ . ' env - storing RECIPIENT_EMAIL [' . $this->wcr_profiles_cnt . '][' . $param_key . '][' . self::$oCRNRSTN_n->str_sanitize($tmp_email_name_ARRAY['email'][$i], 'email_private') . ']');
                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['RECIPIENT_EMAIL'][] = $tmp_email_name_ARRAY['email'][$i];
                    $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['RECIPIENT_EMAIL'][] = 1;

                    if(isset($name_array[$i])){

                        if($name_array[$i] != ''){

                            //error_log(__LINE__ . ' env - [' . $param_key.'] name[' . $i . ']' . $name_array[$i]);
                            $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['RECIPIENT_NAME'][] = $name_array[$i];
                            $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['RECIPIENT_NAME'][] = 1;

                        }else{

                            if(isset($tmp_email_name_ARRAY['name'][$i])){

                                if($tmp_email_name_ARRAY['name'][$i] !=''){

                                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['RECIPIENT_NAME'][] = $tmp_email_name_ARRAY['name'][$i];

                                }else{

                                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['RECIPIENT_NAME'][] = '';

                                }

                                $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['RECIPIENT_NAME'][] = 1;

                            }

                        }

                    }else{

                        if(isset($tmp_email_name_ARRAY['name'][$i])){

                            if($tmp_email_name_ARRAY['name'][$i] != ''){

                                $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['RECIPIENT_NAME'][] = $tmp_email_name_ARRAY['name'][$i];

                            }else{

                                $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['RECIPIENT_NAME'][] = '';

                            }

                            $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['RECIPIENT_NAME'][] = 1;

                        }

                    }

                break;
                case 'REPLYTO_EMAIL_PIPED':

                    //error_log(__LINE__ . ' env - storing REPLYTO_EMAIL_PIPED [' . $this->wcr_profiles_cnt . '][' . $param_key . '][' . self::$oCRNRSTN_n->str_sanitize($tmp_email_name_ARRAY['email'][$i], 'email_private') . ']');
                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['REPLYTO_EMAIL'][] = $tmp_email_name_ARRAY['email'][$i];
                    $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['REPLYTO_EMAIL'][] = 1;

                    if(isset($name_array)){

                        if(isset($name_array[$i])){

                            $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['REPLYTO_NAME'][] = $name_array[$i];
                            $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['REPLYTO_NAME'][] = 1;

                        }else{

                            if(isset($tmp_email_name_ARRAY['name'][$i])){

                                if($tmp_email_name_ARRAY['name'][$i] != ''){

                                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['REPLYTO_NAME'][] = $tmp_email_name_ARRAY['name'][$i];
                                    $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['REPLYTO_NAME'][] = 1;

                                }else{

                                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['REPLYTO_NAME'][] = '';
                                    $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['REPLYTO_NAME'][] = 1;

                                }

                            }

                        }

                    }

                break;
                case 'CC_EMAIL_PIPED':

                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['CC_EMAIL'][] = $tmp_email_name_ARRAY['email'][$i];
                    $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['CC_EMAIL'][] = 1;

                    if(isset($name_array)){

                        if(isset($name_array[$i])){

                            //error_log(__LINE__ . ' env - CC_EMAIL_PIPED name data[' . $i . '] saved=' . $name_array[$i]);
                            $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['CC_NAME'][] = $name_array[$i];
                            $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['CC_NAME'][] = 1;

                        }else{

                            if(isset($tmp_email_name_ARRAY['name'][$i])){

                                if($tmp_email_name_ARRAY['name'][$i] != ''){

                                    //error_log(__LINE__ . ' env - CC_EMAIL_PIPED WCR name data[' . $i . '] saved=' . $tmp_email_name_ARRAY['name'][$i]);
                                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['CC_NAME'][] = $tmp_email_name_ARRAY['name'][$i];

                                }else{

                                    //error_log(__LINE__ . ' env - CC_EMAIL_PIPED WCR name data[' . $i . '] saved=[\'\']');
                                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['CC_NAME'][] = '';

                                }

                                $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['CC_NAME'][] = 1;

                            }

                        }

                    }

                break;
                case 'BCC_EMAIL_PIPED':

                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['BCC_EMAIL'][] = $tmp_email_name_ARRAY['email'][$i];
                    $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['BCC_EMAIL'][] = 1;

                    if(isset($name_array)){

                        if(isset($name_array[$i])){

                            $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['BCC_NAME'][] = $name_array[$i];
                            $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['BCC_NAME'][] = 1;

                        }else{

                            if(isset($tmp_email_name_ARRAY['name'][$i])){

                                if($tmp_email_name_ARRAY['name'][$i] != ''){

                                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['BCC_NAME'][] = $tmp_email_name_ARRAY['name'][$i];

                                }else{

                                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['BCC_NAME'][] = '';

                                }

                                $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['BCC_NAME'][] = 1;

                            }

                        }

                    }

                break;

            }

        }

    }

    public function receive_profile_RESOURCE_OPENSOURCE_WCR($oWCR, $WCR_key){

        $this->isValid = true;

        //
        // I AM FTP PROFILE. RECEIVE FTP WCR DATA.
        //error_log('3343 - I AM FTP PROFILE. RECEIVE FTP WCR DATA. '.$WCR_key);
        $this->wcr_profiles_cnt++;

        //
        // *ALL* POSSIBLE FTP WCR KEYS
        foreach($this->profile_endpoint_criteria_ARRAY[CRNRSTN_RESOURCE_OPENSOURCE] as $param_key => $value){

            if($oWCR->isset_WCR($WCR_key, $param_key) == true){

                //
                // WCR DATA CAN BE DDO_OBJECT, INT, DOUBLE, STRING
                $tmp_wcr_data = $oWCR->get_attribute($WCR_key, $param_key);
                self::$oCRNRSTN_n->error_log('We have received CRNRSTN_RESOURCE_OPENSOURCE DATA ' . $param_key . '=[' . print_r($tmp_wcr_data, true) . '] from wcr=' . $WCR_key . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_RESOURCE_OPENSOURCE);

                //error_log(__LINE__ . ' ' . __METHOD__ . ' env STORING OBJECT [' . $param_key . ']=' . print_r($tmp_wcr_data, true));
                $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt][strtoupper($param_key)][] = $tmp_wcr_data;
                $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt][strtoupper($param_key)][] = 1;

            }

        }

    }

    public function receive_profile_EMAIL_PROXY_WCR($oWCR, $WCR_key){

        $this->isValid = true;

        //
        // I AM EMAIL_PROXY PROFILE. RECEIVE EMAIL_PROXY WCR DATA.
        //error_log(__LINE__ . ' env - I AM EMAIL_PROXY[WCR] PROFILE. RECEIVE EMAIL WCR DATA. ' . $WCR_key);
        $this->wcr_profiles_cnt++;

        //
        // *ALL* POSSIBLE EMAIL_PROXY WCR KEYS
        foreach($this->profile_endpoint_criteria_ARRAY[CRNRSTN_LOG_EMAIL_PROXY] as $param_key => $value){

            // $this->profile_endpoint_criteria_ARRAY[CRNRSTN_LOG_EMAIL_PROXY]['ISHTML'] = 1;
            if($oWCR->isset_WCR($WCR_key, $param_key) == true){

                $tmp_wcr_data = $oWCR->get_attribute($WCR_key, $param_key, true);

                switch($param_key){
                    case 'RECIPIENTS_NAME_PIPED':
                    case 'REPLYTO_NAME_PIPED':
                    case 'CC_NAME_PIPED':
                    case 'BCC_NAME_PIPED':
                    break;
                    case 'RECIPIENTS_EMAIL_PIPED':

                        $tmp_name_array = array();
                        $tmp_name_data = $oWCR->get_attribute($WCR_key, 'RECIPIENTS_NAME_PIPED');

                        if($tmp_name_data->preach('isset', $param_key) == true){

                            $tmp_name_array = explode('|', $tmp_name_data->preach('data_value', $param_key));

                        }

                        //$tmp_email_array = $this->receive_profile_EMAIL($tmp_wcr_data, $param_key);
                        $this->receive_profile_EMAIL($tmp_wcr_data, $param_key, $tmp_name_array);

                    break;
                    case 'REPLYTO_EMAIL_PIPED':

                        $tmp_name_array = array();
                        $tmp_name_data = $oWCR->get_attribute($WCR_key, 'REPLYTO_NAME_PIPED');

                        if($tmp_name_data->preach('isset', $param_key) == true){

                            $tmp_name_array = explode('|', $tmp_name_data->preach('data_value', $param_key));

                        }

                        //$tmp_email_array = $this->receive_profile_EMAIL($tmp_wcr_data, $param_key);
                        $this->receive_profile_EMAIL($tmp_wcr_data, $param_key, $tmp_name_array);

                    break;
                    case 'CC_EMAIL_PIPED':

                        $tmp_name_array = array();
                        $tmp_name_data = $oWCR->get_attribute($WCR_key, 'CC_NAME_PIPED');

                        if($tmp_name_data->preach('isset', $param_key) == true){

                            $tmp_name_array = explode('|', $tmp_name_data->preach('data_value', $param_key));

                        }

                        $this->receive_profile_EMAIL($tmp_wcr_data, $param_key, $tmp_name_array);

                    break;
                    case 'BCC_EMAIL_PIPED':

                        $tmp_name_array = array();$tmp_name_data = $oWCR->get_attribute($WCR_key, 'BCC_NAME_PIPED');

                        if($tmp_name_data->preach('isset', $param_key) == true){

                            $tmp_name_array = explode('|', $tmp_name_data->preach('data_value', $param_key));

                        }

                        $this->receive_profile_EMAIL($tmp_wcr_data, $param_key, $tmp_name_array);

                    break;
                    default:

                        //error_log(__LINE__ . ' env - [' . $this->wcr_profiles_cnt . '][' . strtoupper($param_key) . '][' . $tmp_wcr_data . ']');
                        $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt][strtoupper($param_key)][] = $tmp_wcr_data;
                        $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt][strtoupper($param_key)][] = 1;

                    break;

                }

            }

        }

    }

    public function receive_profile_FTP_WCR($oWCR, $WCR_key){

        $this->isValid = true;

        //
        // I AM FTP PROFILE. RECEIVE FTP WCR DATA.
        //error_log('3343 - I AM FTP PROFILE. RECEIVE FTP WCR DATA. '.$WCR_key);
        $this->wcr_profiles_cnt++;

        //
        // *ALL* POSSIBLE FTP WCR KEYS
        foreach($this->profile_endpoint_criteria_ARRAY[CRNRSTN_LOG_FILE_FTP] as $param_key => $value){

            if($oWCR->isset_WCR($WCR_key, $param_key) == true){

                //
                // WCR DATA CAN BE DDO_OBJECT, INT, DOUBLE, STRING
                $tmp_wcr_data = $oWCR->get_attribute($WCR_key, $param_key);

                //error_log(__LINE__ . ' ' . __METHOD__ . ' env STORING OBJECT [' . $param_key . ']=' . print_r($tmp_wcr_data, true));
                $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt][strtoupper($param_key)][] = $tmp_wcr_data;
                $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt][strtoupper($param_key)][] = 1;

            }

        }

    }

    public function receive_profile_FILE_WCR($oWCR, $WCR_key){

        $this->isValid = true;

        //
        // I AM FILE PROFILE. RECEIVE FILE WCR DATA.
        //error_log(__LINE__ . ' env - I AM FILE[WCR] PROFILE. RECEIVE FILE WCR DATA. ' . $WCR_key);
        $this->wcr_profiles_cnt++;

        //
        // *ALL* POSSIBLE FILE WCR KEYS
        foreach($this->profile_endpoint_criteria_ARRAY[CRNRSTN_LOG_FILE] as $param_key => $value){

            $tmp_wcr_data = $oWCR->get_attribute($WCR_key, $param_key);

            if(is_object($tmp_wcr_data)){

                //error_log(__LINE__ . ' env - Data from WCR[' . $WCR_key . '] @ [' . $param_key . ']=[' . $tmp_wcr_data . ']');
                $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt][strtoupper($param_key)][] = $tmp_wcr_data;
                $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt][strtoupper($param_key)][] = 1;

            }

        }

    }

    public function receive_profile_FILE($data){

        $this->isValid = true;

        //
        // I AM FILE PROFILE. RECEIVE FILE DATA.
        //error_log(__LINE__ . ' env - I AM FILE PROFILE. RECEIVE FILE DATA. ' . $data);
        $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['LOCAL_DIR_PATH'][] = $data;
        $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['LOCAL_DIR_PATH'][] = 1;

    }

    public function return_profile(){

        return $this->logging_profile;

    }

    private function active_by_default($logging_profile){

        switch($logging_profile){
            case CRNRSTN_LOG_DEFAULT:
            case CRNRSTN_LOG_SCREEN_TEXT:
            case CRNRSTN_LOG_SCREEN:
            case CRNRSTN_LOG_SCREEN_HTML:
            case CRNRSTN_LOG_SCREEN_HTML_HIDDEN:

                //$this->isValid = true;

            break;

        }

    }

    private function reformat_pipe_data($profile_key, $data){

        $tmp_array = array();

        switch($profile_key){
            case CRNRSTN_LOG_EMAIL:
            case CRNRSTN_LOG_EMAIL_PROXY:

                $tmp_pipe_to_array = explode('|', $data);

                if(count($tmp_pipe_to_array) < 2){

                    $tmp_pipe_to_array = explode(',', $data);

                }

                foreach($tmp_pipe_to_array as $key => $email_data){

                    $email_data = trim($email_data);

                    //
                    // @ SYMBOL ?. IF NO...SKIP...MAYBE LOG.
                    $pos_at = strpos($email_data, '@');
                    if($pos_at !== false){

                        //error_log(__LINE__ . ' env - WE HAVE EMAIL IN ' . $email_data);

                        //
                        // WE HAVE EMAIL. CHECK FOR SPACES AS INDICATION OF PRESENCE OF NAME DATA
                        $pos_space = strpos($email_data, ' ');
                        if($pos_space === false){

                            //
                            // NO NAME DATA? CHECK FOR COMMA.
                            $pos_comma = strpos($email_data, ',');
                            if($pos_comma === false){

                                //
                                // YEP. JUST EMAIL.
                                $tmp_array['email'][] = $email_data;
                                $tmp_array['name'][] = '';

                            }else{

                                $tmp_name = '';

                                //
                                // EXPLODE ON COMMA AND PROCESS FOR SINGLE EMAIL AND NAME COMBO.
                                $tmp_comma_to_array = explode(',', $email_data);
                                foreach($tmp_comma_to_array as $commaKey => $comma_delim_data){

                                    $pos_at = strpos($comma_delim_data, '@');
                                    if($pos_at !== false){

                                        //
                                        // PROCESS EMAIL.
                                        $tmp_email = $comma_delim_data;

                                    }else{

                                        //
                                        // PROCESS NAME.
                                        if($comma_delim_data != ''){

                                            $tmp_name .= $comma_delim_data.' ';

                                        }

                                    }

                                }

                                $tmp_name = rtrim($tmp_name, ' ');

                                $tmp_array['email'][] = $tmp_email;
                                $tmp_array['name'][] = $tmp_name;

                            }

                        }else{

                            $tmp_name = '';
                            //error_log(__LINE__ . ' env - WE HAVE NAME DATA IN ' . $email_data);

                            //
                            // CHECK FOR NAME AND EMAIL DUE TO SPACE.
                            $tmp_space_to_array = explode(' ', $email_data);
                            foreach($tmp_space_to_array as $spaceKey => $space_delim_data){

                                $pos_at = strpos($space_delim_data, '@');
                                if($pos_at !== false){

                                    //
                                    // PROCESS EMAIL.
                                    $tmp_email = $space_delim_data;

                                }else{

                                    //
                                    // PROCESS NAME.
                                    if($space_delim_data != ''){

                                        $tmp_name .= $space_delim_data . ' ';
                                        //error_log(__LINE__ . ' env - BUILDING NAME=>' . $tmp_name);

                                    }

                                }

                            }

                            $tmp_name = rtrim($tmp_name, ' ');

                            $tmp_array['email'][] = $tmp_email;
                            $tmp_array['name'][] = $tmp_name;
                            //error_log(__LINE__ . ' env - ADDING NAME to tmp_array[\'name\']=>' . $tmp_name);

                        }

                    }else{

                        //
                        // NO EMAIL DATA IN THIS DATA!
                        if(is_object(self::$oCRNRSTN_n)){

                            self::$oCRNRSTN_n->error_log('The provided ' . $profile_key . ' data "' . $data . '" does not contain an email address, and it will be ignored.', __LINE__, __METHOD__, __FILE__,CRNRSTN_SETTINGS_CRNRSTN);

                        }

                    }

                }

            break;

        }

        //
        // $tmp_array['email'][]
        // $tmp_array['name'][]
        //error_log(__LINE__ . ' env - returning tmp_array[\'email\'] & [\'name\']');

        return $tmp_array;

    }

    public function load_CRNRSTN_ENV($oCRNRSTN_ENV){

        self::$oCRNRSTN_n = $oCRNRSTN_ENV;

    }

    private function load_log_output_mgr($oCRNRSTN_n){

        $this->oLog_output_manager = new crnrstn_log_output_manager($oCRNRSTN_n);

    }

    public function __destruct(){


    }

}