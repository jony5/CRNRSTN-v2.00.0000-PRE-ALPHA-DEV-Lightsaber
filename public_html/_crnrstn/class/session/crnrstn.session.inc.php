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
#       Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
#       documentation files (the "Software"), to deal in the Software without restriction, including without limitation
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
#  CLASS :: crnrstn_session_manager
#  VERSION :: 1.00.0001
#  DATE :: September 11, 2012 @ 1720hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: Session management on top of the CRNRSTN :: Session Encryption Layer.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_session_manager {

    protected $oLogger;
    public $oCRNRSTN;
    public $oCRNRSTN_USR;
    public $oCRNRSTN_ENV;

    private static $resource_oDDO_ARRAY = array();

    //
    // CONFIG SERIAL AND ENV RESOURCE KEY
	public $config_serial_hash;
    public $env_key_crc;

    public $oCRNRSTN_MySQLi;
    public $mysqli;

    public $oCRNRSTN_SESSION_DDO;

    private static $cacheSessionParam_ARRAY = array();

	private static $encryptableDataTypes = array();
	
	public function __construct($oCRNRSTN){

	    $this->oCRNRSTN = $oCRNRSTN;

        //
        // INSTANTIATE LOGGER - WILL BE OVERWRITTEN WITH oCRNRSTN_USR RECEPTION...BUT, LOGGER COULD BE USED BEFORE THEN
        // IF EXCEPTION THROWN DURING CONFIGURATION
        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN);

        //
        // INITIALIZE ARRAY OF ENCRYPTABLE DATATYPES
        self::$encryptableDataTypes = array('string' => 'string', 'integer' => 'integer', 'double' => 'double', 'float' => 'float', 'int' => 'int');

        //
        // INITIALIZE CONFIG SERIAL FOR SESSION SERIALIZATION
        $this->env_key = $this->oCRNRSTN->get_server_env();
        $this->env_key_crc =  $this->oCRNRSTN->get_server_env('hash');
        $this->config_serial_hash = $this->oCRNRSTN->get_server_config_serial('hash');

		//
		// Function Source ::
		// http://php.net/manual/en/function.hash-equals.php#115635
		// To transparently support decryption dependency with hash_equals on older versions of PHP:
		if(!function_exists('hash_equals')) {

            function hash_equals($str1, $str2) {

                if(strlen($str1) != strlen($str2)) {

                    return false;

                } else {

                    $res = $str1 ^ $str2;
                    $ret = 0;

                    for($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);
                    return !$ret;

                }

            }

        }

    }
//
//    public function return_session_oDDO_profile($output_channel){
//
//	    $tmp_output_str = '';
//
//        $tmp_output_str = $this->oCRNRSTN_SESSION_DDO->preach($output_channel);
//
//        return $tmp_output_str;
//
//    }

    public function init_session(){

        //
	    // CRNRSTN :: SESSION INITIALIZATION :: CURRENTLY PSSDTL ONLY


        //
        // HAS CRNRSTN_SESSION_DATA SQL PROFILE BEEN PROCESSED?
        if($this->oCRNRSTN_USR->isset_query_result_set_key('CRNRSTN_SESSION_DATA')){

            $tmp_session_count = $this->oCRNRSTN_USR->return_record_count('CRNRSTN_SESSION_DATA');

            if($tmp_session_count > 0){

                //
                // SESSION DATA FOR THREAD TO USE/ACCESS
                error_log(__LINE__ . ' session COUNT OF SESSION MATCH=' . $tmp_session_count . '. NEED TO UPDATE CRNRSTN :: SESSION TABLE WITH FRESH ACTIVITY TIMESTAMPS.');


            }else{

                //
                // NEED TO CLEAN (OR PSSDTL) INITIALIZE A NEW CRNRSTN :: SESSION
                error_log(__LINE__ . ' session COUNT OF SESSION MATCH=' . $tmp_session_count . '. NEED TO RECORD NEW SESSION.');

                //
                // DO WE START WITH PSSDTL / SSDTL DRIVEN SESSION DATA PROFILE
                if(!$this->init_session_from_pssdtl()){

                    //
                    // JUST INITIALIZE ME A CLEAN SESSION, OK?
                    $this->init_session_sans_pssdtl();

                }

            }

        }else{

            //
            // FIRE CRNRSTN :: SESSION SUPPORTING QUERY
            $this->load_session_sql();

            $tmp_session_count = $this->oCRNRSTN_USR->return_record_count('CRNRSTN_SESSION_DATA');

            if($tmp_session_count > 0){

                //
                // SESSION DATA FOR THREAD TO USE/ACCESS
                error_log(__LINE__ . ' session COUNT OF SESSION MATCH=' . $tmp_session_count . '. NEED TO UPDATE CRNRSTN :: SESSION TABLE WITH FRESH ACTIVITY TIMESTAMPS.');

            }else{

                //
                // NEED TO CLEAN (OR PSSDTL) INITIALIZE A NEW CRNRSTN :: SESSION
                error_log(__LINE__ . ' session COUNT OF SESSION MATCH=' . $tmp_session_count . '. NEED TO RECORD NEW SESSION.');

                //
                // DO WE START WITH PSSDTL / SSDTL DRIVEN SESSION DATA PROFILE
                if(!$this->init_session_from_pssdtl()){

                    //
                    // JUST INITIALIZE ME A CLEAN SESSION, OK?
                    $this->init_session_sans_pssdtl();

                }

            }

        }

        $this->CRNRSTN_MySQLi = $this->oCRNRSTN_USR->return_crnrstn_mysqli();
        $this->mysqli = $this->oCRNRSTN_MySQLi->return_conn_object();

        //
        // DO WE NEED TO INSERT A NEW SESSION INTO THE MYSQL DATABASE?
        if($tmp_session_count > 0){

            //
            // JUST NEED TO PERFORM BASIC SESSION MAINTENANCE UPDATE
            $this->touch_session();

        }else{

            //
            // CREATE NEW SESSION IN SESSION TABLE
            $this->create_session();

        }

    }

    private function create_session(){

        $tmp_ip = $this->return_session_meta('crnrstn_soap_srvc_server_ip_HOST');
        if(strlen($tmp_ip) < 8){

            $this->consume_session_meta('crnrstn_soap_srvc_server_ip_HOST', $_SERVER['SERVER_ADDR']);

        }

        $tmp_ip = $this->return_session_meta('crnrstn_soap_srvc_server_ip_EDGE');
        if(strlen($tmp_ip) < 8){

            $this->consume_session_meta('crnrstn_soap_srvc_server_ip_EDGE', $_SERVER['SERVER_ADDR']);

        }

        $this->consume_session_meta('crnrstn_session_serial_id', $this->oCRNRSTN_USR->generate_new_key(128, -1));
        $this->consume_session_meta('crnrstn_session_serial', $this->oCRNRSTN_USR->generate_new_key(128, '01'));

        $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();
        $tmp_query = 'INSERT INTO `crnrstn_session`
        (`SERIAL_ID`,
        `SERIAL_ID_CRC32`,
        `SESSION_ID`,
        `SESSION_ID_CRC32`,
        `SERIAL`,
        `SERIAL_CRC32`,
        `CLIENT_ID`,
        `CLIENT_ID_CRC32`,
        `SERVER_IP`,
        `EDGE_SERVER_IP`,
        `CLIENT_IP`,
        `DEVICE_TYPE_CONSTANT`,
        `DEVICE_TYPE`,
        `HTTP_USER_AGENT`,
        `ACCEPT_LANGUAGE`,
        `HTTP_REFERER`,
        `SSDTL_PACKET`,
        `ACTIVITY_TIMESTAMP`,
        `DATEMODIFIED`,
        `DATECREATED`)
        VALUES
        ("' . $this->mysqli->real_escape_string($this->return_session_meta('crnrstn_session_serial_id')) . '",
        "' . $this->oCRNRSTN_USR->crcINT($this->return_session_meta('crnrstn_session_serial_id')) . '",
        "' . $this->mysqli->real_escape_string($this->return_session_meta('SESSION_ID')) . '",
        "' . $this->oCRNRSTN_USR->crcINT($this->return_session_meta('SESSION_ID')) . '",
        "' . $this->mysqli->real_escape_string($this->return_session_meta('crnrstn_session_serial')) . '",
        "' . $this->oCRNRSTN_USR->crcINT($this->return_session_meta('crnrstn_session_serial')) . '",
        "' . $this->mysqli->real_escape_string($this->return_session_meta('crnrstn_client_id')) . '",
        "' . $this->oCRNRSTN_USR->crcINT($this->return_session_meta('crnrstn_client_id')) . '",
        INET_ATON("' . $this->return_session_meta('crnrstn_soap_srvc_server_ip_HOST') . '"),
        INET_ATON("' . $this->return_session_meta('crnrstn_soap_srvc_server_ip_EDGE') . '"),
        INET_ATON("' . $this->mysqli->real_escape_string($this->return_session_meta('crnrstn_soap_service_client_ip')) . '"),
        "' . $this->mysqli->real_escape_string($this->oCRNRSTN_USR->device_type_bit) . '",
        "' . $this->mysqli->real_escape_string($this->oCRNRSTN_USR->device_type) . '",
        "' . $this->mysqli->real_escape_string($this->return_session_meta('crnrstn_soap_srvc_user_agent')) . '",
        "' . $this->mysqli->real_escape_string($this->oCRNRSTN_USR->return_client_header_value('Accept-Language')) . '",
        "' . $this->mysqli->real_escape_string($_SERVER['HTTP_REFERER']) . '",
        "' . $this->mysqli->real_escape_string($this->oCRNRSTN_SESSION_DDO->preach('value', 'crnrstn_session')) . '",
        "' . $ts . '",
        "' . $this->mysqli->real_escape_string($this->return_session_meta('SESSION_ID_DATEMODIFIED')) . '",
        "' . $this->mysqli->real_escape_string($this->return_session_meta('SESSION_ID_DATECREATED')) . '");';
        $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SESSION', '!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
        $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

        error_log(__LINE__ . ' session ' . __METHOD__ . ' inserting PSSDTLP (len=' . strlen($this->oCRNRSTN_SESSION_DDO->preach('value', 'crnrstn_session')) . ')');

        //
        // PROCESS ALL QUERY TO CONNECTION(S)
        $this->oCRNRSTN_USR->process_query();

    }

    private function touch_session(){

	    error_log(__LINE__ . ' session TOUCH SESSION MYSQL TABLE FOR LAST ACTIVITY UPDATE.');

    }

    private function consume_session_meta($parameter_name, $parameter_value){

        $this->oCRNRSTN_SESSION_DDO->add($parameter_value, $parameter_name);

    }

    private function return_session_meta($parameter_name){

	    return $this->oCRNRSTN_SESSION_DDO->preach('value',  $parameter_name,true);

    }

    private function init_session_sans_pssdtl(){

        $this->consume_session_meta('CRNRSTN_SESSION_ID', session_id());
        $this->consume_session_meta('CRNRSTN_SESSION_ID_DATECREATED', $this->oCRNRSTN_USR->return_query_date_time_stamp());
        $this->consume_session_meta('CRNSTN_SESSION_ID_DATEMODIFIED', $this->oCRNRSTN_USR->return_query_date_time_stamp());
        $this->consume_session_meta('crnrstn_client_id', $this->oCRNRSTN_USR->generate_new_key(128, '01'));
        $this->consume_session_meta('crnrstn_client_auth_key', $this->oCRNRSTN_USR->generate_new_key(64));
        $this->consume_session_meta('crnrstn_soap_srvc_stime', $this->oCRNRSTN_USR->starttime);
        $this->consume_session_meta('crnrstn_soap_service_client_ip', $this->oCRNRSTN_USR->return_client_ip());
        $this->consume_session_meta('crnrstn_soap_srvc_user_agent', $_SERVER['HTTP_USER_AGENT']);
        $this->consume_session_meta('jony5_lifestyle_banner_checksum', '8/16/2021 0345 :: Miss you, J5...my boy!');

    }

    private function init_session_from_pssdtl(){

        if($this->oCRNRSTN_USR->receive_form_integration_packet()) {

            if ($this->oCRNRSTN_USR->isvalid_data_validation_check()) {

                $tmp_crnrstn_session = $this->oCRNRSTN_USR->return_form_submitted_value('crnrstn_session');

                // This function (json_decode) only works with UTF-8 encoded strings.
                $tmp_crnrstn_session_ojson = json_decode($tmp_crnrstn_session, TRUE, 6);

                //echo 'Last error: ', json_last_error_msg(), PHP_EOL, PHP_EOL;
                //error_log(__LINE__ . ' session $tmp_crnrstn_session=[' . print_r($tmp_crnrstn_session, true) . ']');
                error_log(__LINE__ . ' session init_session_from_pssdtl() json_last_error_msg=[' . json_last_error_msg() . ']');
                //die();

                $tmp_client_id_HOST = $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['CLIENT_ID'];
                $tmp_client_id_EDGE = $this->oCRNRSTN_USR->return_form_submitted_value('crnrstn_client_id');

                if(strlen($tmp_client_id_HOST) < 128){

                    if(strlen($tmp_client_id_EDGE) < 128){

                        $tmp_client_id = $this->oCRNRSTN_USR->generate_new_key(128, '01');

                    }else{

                        $tmp_client_id = $tmp_client_id_EDGE;

                    }

                }else{

                    $tmp_client_id = $tmp_client_id_HOST;

                }

                $this->consume_session_meta('crnrstn_client_id', $tmp_client_id);
                $this->consume_session_meta('crnrstn_client_auth_key', $this->oCRNRSTN_USR->return_form_submitted_value('crnrstn_client_auth_key'));
                $this->consume_session_meta('crnrstn_soap_srvc_rtime', $this->oCRNRSTN_USR->return_form_submitted_value('crnrstn_soap_srvc_rtime'));
                $this->consume_session_meta('crnrstn_soap_srvc_stime', $this->oCRNRSTN_USR->return_form_submitted_value('crnrstn_soap_srvc_stime'));

                $tmp_crnrstn_soap_service_client_ip = $this->oCRNRSTN_USR->return_form_submitted_value('crnrstn_soap_service_client_ip');
                $tmp_pssdtl_CLIENT_IP = $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['CLIENT_IP'];

                if(strlen($tmp_pssdtl_CLIENT_IP) > 0){

                    $this->consume_session_meta('crnrstn_soap_service_client_ip', $tmp_pssdtl_CLIENT_IP);

                }else{

                    if(strlen($tmp_crnrstn_soap_service_client_ip) > 0){

                        $this->consume_session_meta('crnrstn_soap_service_client_ip', $tmp_crnrstn_soap_service_client_ip);

                    }else{

                        $this->consume_session_meta('crnrstn_soap_service_client_ip', $this->oCRNRSTN_USR->return_client_ip());

                    }

                }

                $this->consume_session_meta('crnrstn_soap_srvc_user_agent', $this->oCRNRSTN_USR->return_form_submitted_value('crnrstn_soap_srvc_user_agent'));
                $this->consume_session_meta('crnrstn_soap_srvc_ttl', $this->oCRNRSTN_USR->return_form_submitted_value('crnrstn_soap_srvc_ttl'));
                $this->consume_session_meta('crnrstn_soap_srvc_form_serial', $this->oCRNRSTN_USR->return_form_submitted_value('crnrstn_soap_srvc_form_serial'));
                $this->consume_session_meta('crnrstn_request_serialization_key', $this->oCRNRSTN_USR->return_form_submitted_value('crnrstn_request_serialization_key'));
                $this->consume_session_meta('crnrstn_request_serialization_hash', $this->oCRNRSTN_USR->return_form_submitted_value('crnrstn_request_serialization_hash'));

                // = = = = = = = =
                // = = = = = = = =
                // HOST SERVER / DOMAIN CONTROLLER      EDGE SERVER / USER CONTACT POINT
                //
                // $tmp_client_id_HOST                  $tmp_client_id_EDGE

                $tmp_crnrstn_php_sessionid_HOST = $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['SESSION_ID'];
                $tmp_crnrstn_php_sessionid_EDGE = $this->oCRNRSTN_USR->return_form_submitted_value('crnrstn_php_sessionid');

                if(strlen($tmp_crnrstn_php_sessionid_HOST) == 26){

                    $this->consume_session_meta('crnrstn_php_sessionid_HOST', $tmp_crnrstn_php_sessionid_HOST);

                }else{

                    $this->consume_session_meta('crnrstn_php_sessionid_HOST', session_id());

                }

                if(strlen($tmp_crnrstn_php_sessionid_EDGE) == 26){

                    $this->consume_session_meta('crnrstn_php_sessionid_EDGE', $tmp_crnrstn_php_sessionid_EDGE);

                }

                $tmp_crnrstn_server_ip_EDGE = $this->oCRNRSTN_USR->return_form_submitted_value('crnrstn_soap_srvc_server_ip');
                $tmp_crnrstn_server_ip_HOST = $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['SERVER_IP'];

                if(strlen($tmp_crnrstn_server_ip_EDGE) < 8){

                    $this->consume_session_meta('crnrstn_soap_srvc_server_ip_EDGE', $_SERVER['SERVER_ADDR']);

                }else{

                    $this->consume_session_meta('crnrstn_soap_srvc_server_ip_EDGE', $tmp_crnrstn_server_ip_EDGE);

                }

                if(strlen($tmp_crnrstn_server_ip_HOST) < 8){

                    //$this->consume_session_meta('crnrstn_soap_srvc_server_ip_HOST', $_SERVER['SERVER_ADDR']);

                }else{

                    $this->consume_session_meta('crnrstn_soap_srvc_server_ip_HOST', $tmp_crnrstn_server_ip_HOST);

                }

                $tmp_pssdtl_SESSION_ID_DATEMODIFIED = $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['SESSION_ID_DATEMODIFIED'];
                $tmp_pssdtl_SESSION_ID_DATECREATED = $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['SESSION_ID_DATECREATED'];
                $this->consume_session_meta('crnrstn_soap_srvc_timestamp_HOST', $tmp_pssdtl_SESSION_ID_DATECREATED);

                $tmp_crnrstn_soap_srvc_timestamp = $this->oCRNRSTN_USR->return_form_submitted_value('crnrstn_soap_srvc_timestamp');
                $this->consume_session_meta('crnrstn_soap_srvc_timestamp_EDGE', $tmp_crnrstn_soap_srvc_timestamp);

                $tmp_len = count($tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['STATUS_REPORT']);

                for($i = 0; $i < $tmp_len; $i++){

                    $this->consume_session_meta('STATUS_TARGET_ELEMENT', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['STATUS_REPORT'][$i]['STATUS_TARGET_ELEMENT']);
                    $this->consume_session_meta('STATUS', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['STATUS_REPORT'][$i]['STATUS']);
                    $this->consume_session_meta('STATUS_CODE', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['STATUS_REPORT'][$i]['STATUS_CODE']);
                    $this->consume_session_meta('STATUS_MESSAGE', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['STATUS_REPORT'][$i]['STATUS_MESSAGE']);
                    $this->consume_session_meta('ERROR_CODE', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['STATUS_REPORT'][$i]['ERROR_CODE']);
                    $this->consume_session_meta('ERROR_MESSAGE', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['STATUS_REPORT'][$i]['ERROR_MESSAGE']);

                }

                $this->consume_session_meta('SESSION_ID', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['SESSION_ID']);
                $this->consume_session_meta('SESSION_ID_DATEMODIFIED', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['SESSION_ID_DATEMODIFIED']);
                $this->consume_session_meta('SESSION_ID_DATECREATED', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['SESSION_ID_DATECREATED']);

                $this->consume_session_meta('CHECKSUM_PROFILE_ID', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['CHECKSUM_PROFILE_ID']);
                $this->consume_session_meta('PROGRAM_KEY', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['PROGRAM_KEY']);
                $this->consume_session_meta('DEVICE_TYPE_CHANNEL', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['DEVICE_TYPE_CHANNEL']);
                $this->consume_session_meta('CONTENT_CHECKSUM_TTL', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['CONTENT_CHECKSUM_TTL']);

                $this->consume_session_meta('TITLE_CHECKSUM', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['TITLE_CHECKSUM']);
                $this->consume_session_meta('TITLE_CONTENT', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['TITLE_CONTENT']);
                $this->consume_session_meta('TITLE_CONTENT_LOCK', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['TITLE_CONTENT_LOCK']);
                $this->consume_session_meta('TITLE_CONTENT_LOCK_TTL', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['TITLE_CONTENT_LOCK_TTL']);
                $this->consume_session_meta('TITLE_CONTENT_LOCK_ISACTIVE', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['TITLE_CONTENT_LOCK_ISACTIVE']);
                $this->consume_session_meta('SOCIAL_CHECKSUM', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['SOCIAL_CHECKSUM']);
                $this->consume_session_meta('SOCIAL_CONTENT', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['SOCIAL_CONTENT']);
                $this->consume_session_meta('SOCIAL_CONTENT_LOCK', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['SOCIAL_CONTENT_LOCK']);
                $this->consume_session_meta('SOCIAL_CONTENT_LOCK_TTL', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['SOCIAL_CONTENT_LOCK_TTL']);
                $this->consume_session_meta('SOCIAL_CONTENT_LOCK_ISACTIVE', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['SOCIAL_CONTENT_LOCK_ISACTIVE']);
                $this->consume_session_meta('COLORS_CHECKSUM', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['COLORS_CHECKSUM']);
                $this->consume_session_meta('COLORS_CONTENT', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['COLORS_CONTENT']);
                $this->consume_session_meta('COLORS_CONTENT_LOCK', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['COLORS_CONTENT_LOCK']);
                $this->consume_session_meta('COLORS_CONTENT_LOCK_TTL', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['COLORS_CONTENT_LOCK_TTL']);
                $this->consume_session_meta('COLORS_CONTENT_LOCK_ISACTIVE', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['COLORS_CONTENT_LOCK_ISACTIVE']);
                $this->consume_session_meta('STATS_CHECKSUM', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['STATS_CHECKSUM']);
                $this->consume_session_meta('STATS_CONTENT', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['STATS_CONTENT']);
                $this->consume_session_meta('STATS_CONTENT_LOCK', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['STATS_CONTENT_LOCK']);
                $this->consume_session_meta('STATS_CONTENT_LOCK_TTL', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['STATS_CONTENT_LOCK_TTL']);
                $this->consume_session_meta('STATS_CONTENT_LOCK_ISACTIVE', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['STATS_CONTENT_LOCK_ISACTIVE']);
                $this->consume_session_meta('RELAY_CHECKSUM', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['RELAY_CHECKSUM']);
                $this->consume_session_meta('RELAY_CONTENT', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['RELAY_CONTENT']);
                $this->consume_session_meta('RELAY_CONTENT_LOCK', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['RELAY_CONTENT_LOCK']);
                $this->consume_session_meta('RELAY_CONTENT_LOCK_TTL', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['RELAY_CONTENT_LOCK_TTL']);
                $this->consume_session_meta('RELAY_CONTENT_LOCK_ISACTIVE', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['RELAY_CONTENT_LOCK_ISACTIVE']);
                $this->consume_session_meta('REPORTING_CHECKSUM', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['REPORTING_CHECKSUM']);
                $this->consume_session_meta('REPORTING_CONTENT', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['REPORTING_CONTENT']);
                $this->consume_session_meta('REPORTING_CONTENT_LOCK', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['REPORTING_CONTENT_LOCK']);
                $this->consume_session_meta('REPORTING_CONTENT_LOCK_TTL', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['REPORTING_CONTENT_LOCK_TTL']);
                $this->consume_session_meta('REPORTING_CONTENT_LOCK_ISACTIVE', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['REPORTING_CONTENT_LOCK_ISACTIVE']);
                $this->consume_session_meta('WILDCARD_CHECKSUM', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['WILDCARD_CHECKSUM']);
                $this->consume_session_meta('WILDCARD_CONTENT', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['WILDCARD_CONTENT']);
                $this->consume_session_meta('WILDCARD_CONTENT_LOCK', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['WILDCARD_CONTENT_LOCK']);
                $this->consume_session_meta('WILDCARD_CONTENT_LOCK_TTL', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['WILDCARD_CONTENT_LOCK_TTL']);
                $this->consume_session_meta('WILDCARD_CONTENT_LOCK_ISACTIVE', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['WILDCARD_CONTENT_LOCK_ISACTIVE']);
                $this->consume_session_meta('CRNRSTN_CACHE_CHECKSUM_TTL_DATA_DATEMODIFIED', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['DATEMODIFIED']);
                $this->consume_session_meta('CRNRSTN_CACHE_CHECKSUM_TTL_DATA_DATECREATED', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['UI_SYNC_CONTROLLER_THREADS'][0]['DATECREATED']);
                $this->consume_session_meta('jony5_lifestyle_banner_checksum', '8/16/2021 0345 :: Miss you, J5...my boy!');

                $tmp_len_params_index = count($tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['ENVIRONMENTAL_CONFIGURATION'][0]['crnrstn_system_configuration_parameter_index']);
                $tmp_len_params = count($tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['ENVIRONMENTAL_CONFIGURATION'][0]['crnrstn_system_configuration_parameter']);

                error_log(__LINE__ . ' session ' . __METHOD__ . ' Begin session_oDDO consumption of PSSDTLP ' . $tmp_len_params_index . '/' . $tmp_len_params . ' param values from client.');

                for($i = 0; $i < $tmp_len_params_index; $i++){

                    /*
                     {
                        "CHECKSUM" : ' . $this->oCRNRSTN_USR->crcINT($tmp_attribute_key . md5($this->attribute_value_ARRAY[$tmp_attribute_key][$tmp_iterator]) . $this->attribute_type_ARRAY[$tmp_attribute_key][$tmp_iterator]) . '",
                        "KEY" : "' . $this->oCRNRSTN_USR->return_json_value($tmp_attribute_key) . '",
                        "LENGTH" : "' . strlen($this->attribute_value_ARRAY[$tmp_attribute_key][$tmp_iterator]) . '",
                        "TYPE" : "' . $this->attribute_type_ARRAY[$tmp_attribute_key][$tmp_iterator] . '",
                        "VALUE" : ' . $this->oCRNRSTN_USR->return_json_value($this->attribute_value_ARRAY[$tmp_attribute_key][$tmp_iterator]) . '
                    }
                    */

                    $this->consume_session_meta($tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['ENVIRONMENTAL_CONFIGURATION'][0]['crnrstn_system_configuration_parameter_index'][$i] . '_CHECKSUM', $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['ENVIRONMENTAL_CONFIGURATION'][0]['crnrstn_system_configuration_parameter'][$i][0]['CHECKSUM']);
                    $this->consume_session_meta($tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['ENVIRONMENTAL_CONFIGURATION'][0]['crnrstn_system_configuration_parameter_index'][$i], $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['ENVIRONMENTAL_CONFIGURATION'][0]['crnrstn_system_configuration_parameter'][$i][0]['VALUE']);
                    error_log(__LINE__ . ' session PSSDTLA processed checksum[' . $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['ENVIRONMENTAL_CONFIGURATION'][0]['crnrstn_system_configuration_parameter'][$i][0]['CHECKSUM'] . '] [' . $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['ENVIRONMENTAL_CONFIGURATION'][0]['crnrstn_system_configuration_parameter_index'][$i] . '==' . $tmp_crnrstn_session_ojson['oCRNRSTN_SESSION'][0]['ENVIRONMENTAL_CONFIGURATION'][0]['crnrstn_system_configuration_parameter'][$i][0]['VALUE'] . ']. ' . $i . ' of ' . $tmp_len_params_index . '.');

                }
                /*
                 *
                $this->oCRNRSTN_USR->form_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_request_serialization_key', true);
                $this->oCRNRSTN_USR->form_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_request_serialization_hash', true);

                $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_session', true, $this->oCRNRSTN_USR->return_crnrstn_data_packet('jony5.com'), 'crnrstn_session');
                $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_srvc_form_serial', true, $this->oCRNRSTN_USR->generate_new_key(64), 'crnrstn_soap_srvc_form_serial');
                $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_srvc_timestamp', true, $this->oCRNRSTN_USR->return_micro_time(), 'crnrstn_soap_srvc_timestamp');
                $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_srvc_ttl', true, $this->oCRNRSTN_USR->return_ssdtl_packet_ttl(), 'crnrstn_soap_srvc_ttl');
                $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_srvc_user_agent', true, $_SERVER['HTTP_USER_AGENT'], 'crnrstn_soap_srvc_user_agent');
                $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_srvc_server_ip', true, $_SERVER['SERVER_ADDR'], 'crnrstn_soap_srvc_server_ip');
                $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_service_client_ip', true, $this->oCRNRSTN_USR->return_client_ip(), 'crnrstn_soap_service_client_ip');
                $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_srvc_stime', true, $this->starttime, 'crnrstn_soap_srvc_stime');
                $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_srvc_rtime', true, $this->wall_time(), 'crnrstn_soap_srvc_rtime');
                //$this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_srvc_protocol_version', true, $this->oCRNRSTN_USR->proper_version('SOAP'), 'crnrstn_soap_srvc_protocol_version');
                $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_php_sessionid', true, session_id());
                //$this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_soap_srvc_encoding', true, $tmp_oNUSOAP_BASE->soap_defencoding, 'crnrstn_soap_srvc_protocol_version');
                $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_client_auth_key', true, $this->oCRNRSTN_USR->generate_new_key(50), 'crnrstn_client_auth_key');
                $this->oCRNRSTN_USR->form_hidden_input_add('crnrstn_soap_data_tunnel_form', 'crnrstn_client_id', true, $this->oCRNRSTN_USR->generate_new_key(128, '01'), 'crnrstn_client_id');
                 *
                 "oCRNRSTN_SESSION" : [{
                    "SESSION_ID" : "' . $tmp_SESSION_ID . '",
                    "CLIENT_ID" : "' . $tmp_CLIENT_ID . '",
                    "CLIENT_IP" : "' . $tmp_CLIENT_IP . '",
                    "SERVER_IP" : ' . $tmp_SERVER_IP . ',
                    "EDGE_SERVER_IP" : ' . $this->oCRNRSTN_USR->return_json_value($_SERVER['SERVER_ADDR']) . ',
                    "SESSION_ID_DATEMODIFIED" : ' . $tmp_CRNRSTN_SESSION_DATA_DATEMODIFIED . ',
                    "SESSION_ID_DATECREATED" : ' . $tmp_CRNRSTN_SESSION_DATA_DATECREATED . ',
                    "STATUS_REPORT" : [{
                        "STATUS_TARGET_ELEMENT" : "' . $this->oCRNRSTN_USR->return_json_value($tmp_STATUS_TARGET_ELEMENT) . '",
                        "STATUS" : "' . $this->oCRNRSTN_USR->return_json_value($tmp_STATUS) . '",
                        "STATUS_CODE" : "' . $this->oCRNRSTN_USR->return_json_value($tmp_STATUS_CODE) . '",
                        "STATUS_MESSAGE" : ' . $this->oCRNRSTN_USR->return_json_value($tmp_STATUS_MESSAGE) . ',
                        "ERROR_CODE" : "' . $this->oCRNRSTN_USR->return_json_value($tmp_ERROR_CODE) . '",
                        "ERROR_MESSAGE" : "' . $this->oCRNRSTN_USR->return_json_value($tmp_ERROR_MESSAGE) . '"
                        },{
                        "STATUS_TARGET_ELEMENT" : "' . $this->oCRNRSTN_USR->return_json_value($tmp_STATUS_TARGET_ELEMENT) . '",
                        "STATUS" : "' . $this->oCRNRSTN_USR->return_json_value($tmp_STATUS) . '",
                        "STATUS_CODE" : "1234567890",
                        "STATUS_MESSAGE" : ' . $this->oCRNRSTN_USR->return_json_value($tmp_STATUS_MESSAGE) . ',
                        "ERROR_CODE" : "' . $this->oCRNRSTN_USR->return_json_value($tmp_ERROR_CODE) . '",
                        "ERROR_MESSAGE" : "' . $this->oCRNRSTN_USR->return_json_value($tmp_ERROR_MESSAGE) . '"
                        },{
                        "STATUS_TARGET_ELEMENT" : "' . $this->oCRNRSTN_USR->return_json_value($tmp_STATUS_TARGET_ELEMENT) . '",
                        "STATUS" : "' . $this->oCRNRSTN_USR->return_json_value($tmp_STATUS) . '",
                        "STATUS_CODE" : "0987654321",
                        "STATUS_MESSAGE" : ' . $this->oCRNRSTN_USR->return_json_value($tmp_STATUS_MESSAGE) . ',
                        "ERROR_CODE" : "' . $this->oCRNRSTN_USR->return_json_value($tmp_ERROR_CODE) . '",
                        "ERROR_MESSAGE" : "' . $this->oCRNRSTN_USR->return_json_value($tmp_ERROR_MESSAGE) . '"
                        }],
                    "UI_SYNC_CONTROLLER_THREADS" : [{
                        ' . $CHECKSUM_PROFILE_ID . '
                        ' . $PROGRAM_KEY . '
                        ' . $DEVICE_TYPE_CHANNEL . '
                        ' . $CONTENT_CHECKSUM_TTL . '
                        ' . $TITLE_CHECKSUM . '
                        ' . $TITLE_CONTENT . '
                        ' . $TITLE_CONTENT_LOCK . '
                        ' . $TITLE_CONTENT_LOCK_TTL . '
                        ' . $TITLE_CONTENT_LOCK_ISACTIVE . '
                        ' . $SOCIAL_CHECKSUM . '
                        ' . $SOCIAL_CONTENT . '
                        ' . $SOCIAL_CONTENT_LOCK . '
                        ' . $SOCIAL_CONTENT_LOCK_TTL . '
                        ' . $SOCIAL_CONTENT_LOCK_ISACTIVE . '
                        ' . $COLORS_CHECKSUM . '
                        ' . $COLORS_CONTENT . '
                        ' . $COLORS_CONTENT_LOCK . '
                        ' . $COLORS_CONTENT_LOCK_TTL . '
                        ' . $COLORS_CONTENT_LOCK_ISACTIVE . '
                        ' . $STATS_CHECKSUM . '
                        ' . $STATS_CONTENT . '
                        ' . $STATS_CONTENT_LOCK . '
                        ' . $STATS_CONTENT_LOCK_TTL . '
                        ' . $STATS_CONTENT_LOCK_ISACTIVE . '
                        ' . $RELAY_CHECKSUM . '
                        ' . $RELAY_CONTENT . '
                        ' . $RELAY_CONTENT_LOCK . '
                        ' . $RELAY_CONTENT_LOCK_TTL . '
                        ' . $RELAY_CONTENT_LOCK_ISACTIVE . '
                        ' . $REPORTING_CHECKSUM . '
                        ' . $REPORTING_CONTENT . '
                        ' . $REPORTING_CONTENT_LOCK . '
                        ' . $REPORTING_CONTENT_LOCK_TTL . '
                        ' . $REPORTING_CONTENT_LOCK_ISACTIVE . '
                        ' . $WILDCARD_CHECKSUM . '
                        ' . $WILDCARD_CONTENT . '
                        ' . $WILDCARD_CONTENT_LOCK . '
                        ' . $WILDCARD_CONTENT_LOCK_TTL . '
                        ' . $WILDCARD_CONTENT_LOCK_ISACTIVE . '
                        ' . $DATEMODIFIED . '
                        ' . $DATECREATED . '
                         "jony5_lifestyle_banner_checksum" : "8/16/2021 0345 :: Miss you, J5...my boy!"
                        }],
                    "crnrstn_system_configuration_parameter_index" : [],
                    "crnrstn_system_configuration_parameter" : [
                        {
                            "CHECKSUM" : ' . $this->oCRNRSTN_USR->crcINT($tmp_attribute_key . md5($this->attribute_value_ARRAY[$tmp_attribute_key][$tmp_iterator]) . $this->attribute_type_ARRAY[$tmp_attribute_key][$tmp_iterator]) . '",
                            "KEY" : "' . $this->oCRNRSTN_USR->return_json_value($tmp_attribute_key) . '",
                            "LENGTH" : "' . strlen($this->attribute_value_ARRAY[$tmp_attribute_key][$tmp_iterator]) . '",
                            "TYPE" : "' . $this->attribute_type_ARRAY[$tmp_attribute_key][$tmp_iterator] . '",
                            "VALUE" : ' . $this->oCRNRSTN_USR->return_json_value($this->attribute_value_ARRAY[$tmp_attribute_key][$tmp_iterator]) . '
                        },
                        {
                            "CHECKSUM" : ' . $this->oCRNRSTN_USR->crcINT($tmp_attribute_key . md5($this->attribute_value_ARRAY[$tmp_attribute_key][$tmp_iterator]) . $this->attribute_type_ARRAY[$tmp_attribute_key][$tmp_iterator]) . '",
                            "KEY" : "' . $this->oCRNRSTN_USR->return_json_value($tmp_attribute_key) . '",
                            "LENGTH" : "' . strlen($this->attribute_value_ARRAY[$tmp_attribute_key][$tmp_iterator]) . '",
                            "TYPE" : "' . $this->attribute_type_ARRAY[$tmp_attribute_key][$tmp_iterator] . '",
                            "VALUE" : ' . $this->oCRNRSTN_USR->return_json_value($this->attribute_value_ARRAY[$tmp_attribute_key][$tmp_iterator]) . '
                        },
                        {
                            "CHECKSUM" : ' . $this->oCRNRSTN_USR->crcINT($tmp_attribute_key . md5($this->attribute_value_ARRAY[$tmp_attribute_key][$tmp_iterator]) . $this->attribute_type_ARRAY[$tmp_attribute_key][$tmp_iterator]) . '",
                            "KEY" : "' . $this->oCRNRSTN_USR->return_json_value($tmp_attribute_key) . '",
                            "LENGTH" : "' . strlen($this->attribute_value_ARRAY[$tmp_attribute_key][$tmp_iterator]) . '",
                            "TYPE" : "' . $this->attribute_type_ARRAY[$tmp_attribute_key][$tmp_iterator] . '",
                            "VALUE" : ' . $this->oCRNRSTN_USR->return_json_value($this->attribute_value_ARRAY[$tmp_attribute_key][$tmp_iterator]) . '
                        },
                        {
                            "CHECKSUM" : ' . $this->oCRNRSTN_USR->crcINT($tmp_attribute_key . md5($this->attribute_value_ARRAY[$tmp_attribute_key][$tmp_iterator]) . $this->attribute_type_ARRAY[$tmp_attribute_key][$tmp_iterator]) . '",
                            "KEY" : "' . $this->oCRNRSTN_USR->return_json_value($tmp_attribute_key) . '",
                            "LENGTH" : "' . strlen($this->attribute_value_ARRAY[$tmp_attribute_key][$tmp_iterator]) . '",
                            "TYPE" : "' . $this->attribute_type_ARRAY[$tmp_attribute_key][$tmp_iterator] . '",
                            "VALUE" : ' . $this->oCRNRSTN_USR->return_json_value($this->attribute_value_ARRAY[$tmp_attribute_key][$tmp_iterator]) . '
                        }
                ]
                 * */

                return true;

            }

        }else{

            return false;

        }

        return false;

    }

    private function load_session_sql(){

        $tmp_query = 'SELECT `crnrstn_jony5_content_version_checksums`.`CHECKSUM_PROFILE_ID`,
                `crnrstn_jony5_content_version_checksums`.`PROGRAM_KEY`,
                `crnrstn_jony5_content_version_checksums`.`DEVICE_TYPE_CHANNEL`,
                `crnrstn_jony5_content_version_checksums`.`CONTENT_CHECKSUM_TTL`,
                `crnrstn_jony5_content_version_checksums`.`TITLE_CHECKSUM`,
                `crnrstn_jony5_content_version_checksums`.`TITLE_CONTENT`,
                `crnrstn_jony5_content_version_checksums`.`TITLE_CONTENT_LOCK`,
                `crnrstn_jony5_content_version_checksums`.`TITLE_CONTENT_LOCK_TTL`,
                `crnrstn_jony5_content_version_checksums`.`TITLE_CONTENT_LOCK_ISACTIVE`,
                `crnrstn_jony5_content_version_checksums`.`SOCIAL_CHECKSUM`,
                `crnrstn_jony5_content_version_checksums`.`SOCIAL_CONTENT`,
                `crnrstn_jony5_content_version_checksums`.`SOCIAL_CONTENT_LOCK`,
                `crnrstn_jony5_content_version_checksums`.`SOCIAL_CONTENT_LOCK_TTL`,
                `crnrstn_jony5_content_version_checksums`.`SOCIAL_CONTENT_LOCK_ISACTIVE`,
                `crnrstn_jony5_content_version_checksums`.`COLORS_CHECKSUM`,
                `crnrstn_jony5_content_version_checksums`.`COLORS_CONTENT`,
                `crnrstn_jony5_content_version_checksums`.`COLORS_CONTENT_LOCK`,
                `crnrstn_jony5_content_version_checksums`.`COLORS_CONTENT_LOCK_TTL`,
                `crnrstn_jony5_content_version_checksums`.`COLORS_CONTENT_LOCK_ISACTIVE`,
                `crnrstn_jony5_content_version_checksums`.`STATS_CHECKSUM`,
                `crnrstn_jony5_content_version_checksums`.`STATS_CONTENT`,
                `crnrstn_jony5_content_version_checksums`.`STATS_CONTENT_LOCK`,
                `crnrstn_jony5_content_version_checksums`.`STATS_CONTENT_LOCK_TTL`,
                `crnrstn_jony5_content_version_checksums`.`STATS_CONTENT_LOCK_ISACTIVE`,
                `crnrstn_jony5_content_version_checksums`.`RELAY_CHECKSUM`,
                `crnrstn_jony5_content_version_checksums`.`RELAY_CONTENT`,
                `crnrstn_jony5_content_version_checksums`.`RELAY_CONTENT_LOCK`,
                `crnrstn_jony5_content_version_checksums`.`RELAY_CONTENT_LOCK_TTL`,
                `crnrstn_jony5_content_version_checksums`.`RELAY_CONTENT_LOCK_ISACTIVE`,
                `crnrstn_jony5_content_version_checksums`.`REPORTING_CHECKSUM`,
                `crnrstn_jony5_content_version_checksums`.`REPORTING_CONTENT`,
                `crnrstn_jony5_content_version_checksums`.`REPORTING_CONTENT_LOCK`,
                `crnrstn_jony5_content_version_checksums`.`REPORTING_CONTENT_LOCK_TTL`,
                `crnrstn_jony5_content_version_checksums`.`REPORTING_CONTENT_LOCK_ISACTIVE`,
                `crnrstn_jony5_content_version_checksums`.`WILDCARD_CHECKSUM`,
                `crnrstn_jony5_content_version_checksums`.`WILDCARD_CONTENT`,
                `crnrstn_jony5_content_version_checksums`.`WILDCARD_CONTENT_LOCK`,
                `crnrstn_jony5_content_version_checksums`.`WILDCARD_CONTENT_LOCK_TTL`,
                `crnrstn_jony5_content_version_checksums`.`WILDCARD_CONTENT_LOCK_ISACTIVE`,
                `crnrstn_jony5_content_version_checksums`.`DATEMODIFIED`,
                `crnrstn_jony5_content_version_checksums`.`DATECREATED`
            FROM `crnrstn_jony5_content_version_checksums`
            WHERE `crnrstn_jony5_content_version_checksums`.`PROGRAM_KEY` = "BASSDRIVE" 
            AND (`crnrstn_jony5_content_version_checksums`.`DEVICE_TYPE_CHANNEL` = "DESKTOP" 
            OR `crnrstn_jony5_content_version_checksums`.`DEVICE_TYPE_CHANNEL` = "' . $this->oCRNRSTN_USR->device_type . '") LIMIT 1;';
        $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SESSION', '!jesus_is_my_dear_lord!', 'CRNRSTN_CACHE_CHECKSUM_TTL_DATA', __LINE__, __METHOD__);
        $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

        //
        // RUN CRNRSTN_SESSION_DATA SQL. THEN CHECK COUNTS...
        $tmp_query = 'SELECT `crnrstn_session`.`SERIAL_ID`,    
            `crnrstn_session`.`SESSION_ID`,            
            `crnrstn_session`.`SERIAL`,
            `crnrstn_session`.`CLIENT_ID`,
            `crnrstn_session`.`SERVER_IP`,
            `crnrstn_session`.`EDGE_SERVER_IP`,
            `crnrstn_session`.`CLIENT_IP`,
            `crnrstn_session`.`DEVICE_TYPE_CONSTANT`,
            `crnrstn_session`.`DEVICE_TYPE`,
            `crnrstn_session`.`HTTP_USER_AGENT`,
            `crnrstn_session`.`ACCEPT_LANGUAGE`,
            `crnrstn_session`.`HTTP_REFERER`,
            `crnrstn_session`.`SSDTL_PACKET`,
            `crnrstn_session`.`DATEMODIFIED`,
            `crnrstn_session`.`DATECREATED`
        FROM `crnrstn_session` 
        WHERE `crnrstn_session`.`SESSION_ID` = "' . session_id() . '"
        AND `crnrstn_session`.`SESSION_ID_CRC32` = ' . $this->oCRNRSTN_USR->crcINT(session_id()) . ' 
        AND `crnrstn_session`.`ISACTIVE` = 1 LIMIT 1;';
        $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SESSION', '!jesus_is_my_dear_lord!', 'CRNRSTN_SESSION_DATA', __LINE__, __METHOD__);
        $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

        //
        // PROCESS ALL QUERY TO CONNECTION(S)
        $this->oCRNRSTN_USR->process_query();

    }

//    public function initialize_oCRNRSTN_USR($oCRNRSTN_USR){
//
//        $this->oCRNRSTN_USR = $oCRNRSTN_USR;
//
//        //
//        // INSTANTIATE LOGGER
//        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN_USR);
//
//        //
//        // INITIALIZE CONFIG SERIAL FOR SESSION SERIALIZATION
//        $this->config_serial_hash = $this->oCRNRSTN_USR->config_serial_hash;
//
//    }

	public function set_session_param($session_param_key, $val = NULL, $iterator = 0){

        $tmp_data_type = gettype($val);
        $session_param_key_crc = $this->oCRNRSTN->hash($session_param_key);

        //if(in_array($tmp_data_type, self::$encryptableDataTypes)){
        if(isset(self::$encryptableDataTypes[$tmp_data_type])){

            $tmp_val_encrypted = $this->sessionParamEncrypt($val);
            $tmp_prefixed_ddo_key = $this->oCRNRSTN_USR->return_prefixed_ddo_key($session_param_key, $this->oCRNRSTN_USR->env_key);
            $this->oCRNRSTN_SESSION_DDO->add($tmp_val_encrypted, $tmp_prefixed_ddo_key, $iterator);
            //$this->oCRNRSTN_SESSION_DDO->add(1, 'CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH'] . 'CRNRSTN_' . $this->env_key_crc . 'CRNRSTN_ENCRYPT_' . $session_param_key_crc);

		}else{

            //
            // OBJECT CHECK
            if($tmp_data_type == 'object'){

                $tmp_val_serialized = $this->sessionParamEncrypt(serialize($val));

                $tmp_prefixed_ddo_key = $this->oCRNRSTN_USR->return_prefixed_ddo_key($session_param_key, $this->oCRNRSTN_USR->env_key);
                $this->oCRNRSTN_SESSION_DDO->add($tmp_val_serialized, $tmp_prefixed_ddo_key, $iterator);
                //$this->oCRNRSTN_SESSION_DDO->add(1, 'CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH'] . 'CRNRSTN_' . $this->env_key_crc . 'CRNRSTN_ENCRYPT_' . $session_param_key_crc);

            }else{

                $tmp_prefixed_ddo_key = $this->oCRNRSTN_USR->return_prefixed_ddo_key($session_param_key, $this->oCRNRSTN_USR->env_key);
                $this->oCRNRSTN_SESSION_DDO->add($val, $tmp_prefixed_ddo_key, $iterator);
                //$this->oCRNRSTN_SESSION_DDO->add(0, 'CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH'] . 'CRNRSTN_' . $this->env_key_crc . 'CRNRSTN_ENCRYPT_' . $session_param_key_crc);

            }

        }

		return true;

	}

	public function get_session_param($data_key, $soap_transport = false, $index = 0, $data_type_family = NULL){

        return $this->oCRNRSTN_ENV->retrieve_data_value($data_key, $index, $data_type_family, $this->oCRNRSTN_ENV->env_key, $soap_transport);

	}
	
	public function isset_session_param($session_param_key){

        $tmp_prefixed_data_key = $this->oCRNRSTN_USR->return_prefixed_ddo_key($session_param_key, CRNRSTN_RESOURCE_ALL);

        error_log(__LINE__ . ' session $tmp_prefixed_data_key=[' . $tmp_prefixed_data_key . ']. die();');
        die();
        return $this->oCRNRSTN_SESSION_DDO->preach('isset', $tmp_prefixed_data_key);

		//
		// RETURN THE VALUE ASSIGNED TO A PARTICULAR SESSION PARAMETER
		if(isset($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_' . $this->crcINT($session_param_key)])){
			
			//
			// IF SESSION ENCRYPTION IS ENABLED, WE HAVE TO DECRYPT BEFORE WE CAN CHECK IF EMPTY
			if($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_ENCRYPT_' . $this->crcINT($session_param_key)]>0){

				if(isset(self::$cacheSessionParam_ARRAY[$session_param_key])){

					if(self::$cacheSessionParam_ARRAY[$session_param_key]!=""){

						return true;

					}else{

						return false;

					}

				}else{

                    if($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_DTYPE_' . $this->crcINT($session_param_key)] == 'object'){

                        self::$cacheSessionParam_ARRAY[$session_param_key] = unserialize($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_' . $this->crcINT($session_param_key)]);

                        if(is_object(self::$cacheSessionParam_ARRAY[$session_param_key])){

                            return true;

                        }else{

                            return false;

                        }

                    }else{

                        self::$cacheSessionParam_ARRAY[$session_param_key] = trim($this->sessionParamDecrypt($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_' . $this->crcINT($session_param_key)]));

                        if(self::$cacheSessionParam_ARRAY[$session_param_key]!=""){

                            return true;

                        }else{

                            return false;

                        }

                    }

				}
			
			}else{
				
				//
				// NO ENCRYPTION APPLIED TO PARAM. CHECK IF EMPTY.
				if($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_' . $this->crcINT($session_param_key)]!=""){

				    return true;

				}else{

					return false;

				}

			}

		}else{

			return false;

		}

	}

    public function ___set_session_tmp_param($session_param_key, $val = NULL, $iterator = 0){

        $tmp_data_type = gettype($val);
        $session_param_key = $this->crcINT($session_param_key);

        //if(in_array($tmp_data_type, self::$encryptableDataTypes)){
        if(isset(self::$encryptableDataTypes[$tmp_data_type])){

            $tmp_val_encrypted = $this->sessionParamEncrypt($val);
            $this->oCRNRSTN_USR->oCRNRSTN_ENV->oSESSION_MGR->oCRNRSTN_SESSION_DDO->add($tmp_val_encrypted, 'CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH'] . 'CRNRSTN_' . $this->env_key_crc . 'CRNRSTN_' . $session_param_key, 0, false);
            $this->oCRNRSTN_USR->oCRNRSTN_ENV->oSESSION_MGR->oCRNRSTN_SESSION_DDO->add(1, 'CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH'] . 'CRNRSTN_' . $this->env_key_crc . 'CRNRSTN_ENCRYPT_' . $session_param_key, 0, false);

//            //
//            // FOR NOW, ARE WE JUST GOING TO ALLOW SESSION STORAGE TO RUN IN PARALLEL?
//            // WE WILL NEED IT UNTIL EITHER PSSDTLP (JSON INTEGRATION) IS COMPLETE WITH
//            // FEEDBACK LOOP OR DATABASE...THE SAME.
//
//            // 'CRNRSTN_' . $this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']) . 'CRNRSTN_' . $this->env_key_crc .
//            //
//            // CLEAR POTENTIAL CACHE TO FORCE REFRESH
//            unset(self::$cacheSessionParam_ARRAY[$session_param_key]);
//            $_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_' . $session_param_key] = $tmp_val_encrypted;
//            $_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_ENCRYPT_' . $session_param_key] = 1;
//            $_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_DTYPE_' . $session_param_key] = $tmp_data_type;

        }else{

            //
            // OBJECT CHECK
            if($tmp_data_type == 'object'){

                $tmp_val_serialized = $this->sessionParamEncrypt(serialize($val));
                $this->oCRNRSTN_USR->oCRNRSTN_ENV->oSESSION_MGR->oCRNRSTN_SESSION_DDO->add($tmp_val_serialized, 'CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH'] . 'CRNRSTN_' . $this->env_key_crc . 'CRNRSTN_' . $session_param_key, 0, false);
                $this->oCRNRSTN_USR->oCRNRSTN_ENV->oSESSION_MGR->oCRNRSTN_SESSION_DDO->add(1, 'CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH'] . 'CRNRSTN_' . $this->env_key_crc . 'CRNRSTN_ENCRYPT_' . $session_param_key,  0, false);

//                //
//                // FOR NOW, ARE WE JUST GOING TO ALLOW SESSION STORAGE TO RUN IN PARALLEL?
//                // WE WILL NEED IT UNTIL EITHER PSSDTLP (JSON INTEGRATION) IS COMPLETE WITH
//                // FEEDBACK LOOP OR DATABASE...THE SAME.
//
//                //
//                // CLEAR POTENTIAL CACHE TO FORCE REFRESH
//                unset(self::$cacheSessionParam_ARRAY[$session_param_key]);
//                //error_log(__LINE__ . ' object serialize this $session_param_key=' . $session_param_key);
//                $_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_' . $session_param_key] = $tmp_val_serialized;
//                $_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_ENCRYPT_' . $session_param_key] = 1;
//                $_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_DTYPE_' . $session_param_key] = $tmp_data_type;

            }else{

                error_log(__LINE__ . ' session '  . __METHOD__ . ':: ' . $tmp_data_type . ' env_key_crc=[' . $this->env_key_crc . '] ' . print_r($val, true) . '. die();');
                //die();

                $this->oCRNRSTN_USR->oCRNRSTN_ENV->oSESSION_MGR->oCRNRSTN_SESSION_DDO->add($val, 'CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH'] . 'CRNRSTN_' . $this->env_key_crc . 'CRNRSTN_' . $session_param_key, 0, false);
                $this->oCRNRSTN_USR->oCRNRSTN_ENV->oSESSION_MGR->oCRNRSTN_SESSION_DDO->add(0, 'CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH'] . 'CRNRSTN_' . $this->env_key_crc . 'CRNRSTN_ENCRYPT_' . $session_param_key, 0, false);

//                //
//                // FOR NOW, ARE WE JUST GOING TO ALLOW SESSION STORAGE TO RUN IN PARALLEL?
//                // WE WILL NEED IT UNTIL EITHER PSSDTLP (JSON INTEGRATION) IS COMPLETE WITH
//                // FEEDBACK LOOP OR DATABASE...THE SAME.
//
//                //
//                //
//                // NOT ENCRYPTABLE
//                unset(self::$cacheSessionParam_ARRAY[$session_param_key]);
//                $_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_' . $session_param_key] = $val;
//                $_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_ENCRYPT_' . $session_param_key] = 0;
//                $_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_DTYPE_' . $session_param_key] = $tmp_data_type;

            }

        }

        return true;

    }

    public function get_session_tmp_param($session_param_key, $soap_transport = false, $iterator = 0){

        //
        // IF SESSION DDO IS PROPER, JUST USE THIS AND RETURN.
        if($this->oCRNRSTN_USR->oCRNRSTN_ENV->oSESSION_MGR->oCRNRSTN_SESSION_DDO->preach('isset', $session_param_key, $soap_transport, $iterator, false)){

            if($this->oCRNRSTN_USR->oCRNRSTN_ENV->oSESSION_MGR->oCRNRSTN_SESSION_DDO->preach('value', 'CRNRSTN_ENCRYPT_' . $session_param_key, $soap_transport, $iterator, false) > 0){

                switch($this->oCRNRSTN_USR->oCRNRSTN_ENV->oSESSION_MGR->oCRNRSTN_SESSION_DDO->preach('value', 'CRNRSTN_DTYPE_' . $session_param_key, $soap_transport, $iterator, false)){
                    case 'string':

                        if(isset(self::$cacheSessionParam_ARRAY[$session_param_key])){

                            return self::$cacheSessionParam_ARRAY[$session_param_key];

                        }else{

                            //self::$cacheSessionParam_ARRAY[$session_param_key] = trim($this->sessionParamDecrypt($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_' . $session_param_key]));
                            self::$cacheSessionParam_ARRAY[$session_param_key] = $this->sessionParamDecrypt($this->oCRNRSTN_SESSION_DDO->preach('value', 'CRNRSTN_' . $session_param_key, $soap_transport, $iterator, false));
                            return self::$cacheSessionParam_ARRAY[$session_param_key];

                        }

                    break;
                    case 'integer':

                        if(isset(self::$cacheSessionParam_ARRAY[$session_param_key])){

                            return (integer) self::$cacheSessionParam_ARRAY[$session_param_key];

                        }else{

                            //self::$cacheSessionParam_ARRAY[$session_param_key] = trim($this->sessionParamDecrypt($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_' . $session_param_key]));
                            self::$cacheSessionParam_ARRAY[$session_param_key] = $this->sessionParamDecrypt($this->oCRNRSTN_SESSION_DDO->preach('value', 'CRNRSTN_' . $session_param_key, $soap_transport, $iterator, false));

                            return (integer) self::$cacheSessionParam_ARRAY[$session_param_key];

                        }

                    break;
                    case 'int':

                        if(isset(self::$cacheSessionParam_ARRAY[$session_param_key])){

                            return (int) self::$cacheSessionParam_ARRAY[$session_param_key];

                        }else{

                            //self::$cacheSessionParam_ARRAY[$session_param_key] = trim($this->sessionParamDecrypt($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_' . $session_param_key]));
                            self::$cacheSessionParam_ARRAY[$session_param_key] = $this->sessionParamDecrypt($this->oCRNRSTN_SESSION_DDO->preach('value', 'CRNRSTN_' . $session_param_key, $soap_transport, $iterator, false));

                            return (int) self::$cacheSessionParam_ARRAY[$session_param_key];

                        }

                    break;
                    case 'double':

                        if(isset(self::$cacheSessionParam_ARRAY[$session_param_key])){

                            return (double) self::$cacheSessionParam_ARRAY[$session_param_key];

                        }else{

                            //self::$cacheSessionParam_ARRAY[$session_param_key] = trim($this->sessionParamDecrypt($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_' . $session_param_key]));
                            self::$cacheSessionParam_ARRAY[$session_param_key] = $this->sessionParamDecrypt($this->oCRNRSTN_SESSION_DDO->preach('value', 'CRNRSTN_' . $session_param_key, $soap_transport, $iterator, false));

                            return (double) self::$cacheSessionParam_ARRAY[$session_param_key];

                        }

                    break;
                    case 'float':

                        if(isset(self::$cacheSessionParam_ARRAY[$session_param_key])){

                            return (float) self::$cacheSessionParam_ARRAY[$session_param_key];

                        }else{

                            //self::$cacheSessionParam_ARRAY[$session_param_key] = trim($this->sessionParamDecrypt($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_' . $session_param_key]));
                            self::$cacheSessionParam_ARRAY[$session_param_key] = $this->sessionParamDecrypt($this->oCRNRSTN_SESSION_DDO->preach('value', 'CRNRSTN_' . $session_param_key, $soap_transport, $iterator, false));

                            return (float) self::$cacheSessionParam_ARRAY[$session_param_key];

                        }

                    break;
                    case 'boolean':

                        if(isset(self::$cacheSessionParam_ARRAY[$session_param_key])){

                            return (boolean) self::$cacheSessionParam_ARRAY[$session_param_key];

                        }else{

                            //self::$cacheSessionParam_ARRAY[$session_param_key] = trim($this->sessionParamDecrypt($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_' . $session_param_key]));
                            self::$cacheSessionParam_ARRAY[$session_param_key] = $this->sessionParamDecrypt($this->oCRNRSTN_SESSION_DDO->preach('value', 'CRNRSTN_' . $session_param_key, $soap_transport, $iterator, false));

                            return (boolean) self::$cacheSessionParam_ARRAY[$session_param_key];

                        }

                    break;
                    case 'object':

                        if(isset(self::$cacheSessionParam_ARRAY[$session_param_key])){

                            return (object) self::$cacheSessionParam_ARRAY[$session_param_key];

                        }else{

                            //self::$cacheSessionParam_ARRAY[$session_param_key] = unserialize($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_' . $session_param_key]);
                            self::$cacheSessionParam_ARRAY[$session_param_key] = unserialize($this->sessionParamDecrypt($this->oCRNRSTN_SESSION_DDO->preach('value', 'CRNRSTN_' . $session_param_key, $soap_transport, 0, false)));

                            return (object) self::$cacheSessionParam_ARRAY[$session_param_key];

                        }

                    break;

                }

            }else{

                //
                // NO ENCRYPTION APPLIED TO PARAM. RETURN SESSION VALUE.
                //return $_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_' . $session_param_key];
                return $this->oCRNRSTN_USR->oCRNRSTN_ENV->oSESSION_MGR->oCRNRSTN_SESSION_DDO->preach('value', 'CRNRSTN_' . $session_param_key, $soap_transport, $iterator, false);

            }

            return $this->oCRNRSTN_USR->oCRNRSTN_ENV->oSESSION_MGR->oCRNRSTN_SESSION_DDO->preach('value', $session_param_key, $soap_transport, $iterator, false);

        }

        error_log(__LINE__ . ' session ' . __METHOD__ . ' :: Well, apparently we still need $_SESSION to get a parameter (' . $session_param_key . ')! CRNRSTN_ENV_KEY_CRC=' . $this->oCRNRSTN_USR->oCRNRSTN_ENV->oSESSION_MGR->oCRNRSTN_SESSION_DDO->preach('value', 'CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH'] . 'CRNRSTN_ENV_KEY_CRC', $soap_transport) . ' returning false;');
        //die();
        return false;

        //
        // RETURN THE VALUE ASSIGNED TO A PARTICULAR SESSION PARAMETER AND ENSURE THAT THE APPROPRIATE TYPE IS CAST
        if(isset($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_' . $session_param_key])){

            if($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_ENCRYPT_' . $session_param_key] > 0){

                switch($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_DTYPE_' . $session_param_key]){
                    case 'string':

                        if(isset(self::$cacheSessionParam_ARRAY[$session_param_key])){

                            return self::$cacheSessionParam_ARRAY[$session_param_key];

                        }else{

                            self::$cacheSessionParam_ARRAY[$session_param_key] = trim($this->sessionParamDecrypt($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_' . $session_param_key]));

                            return self::$cacheSessionParam_ARRAY[$session_param_key];

                        }

                        break;
                    case 'integer':

                        if(isset(self::$cacheSessionParam_ARRAY[$session_param_key])){

                            return (integer) self::$cacheSessionParam_ARRAY[$session_param_key];

                        }else{

                            self::$cacheSessionParam_ARRAY[$session_param_key] = trim($this->sessionParamDecrypt($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_' . $session_param_key]));

                            return (integer) self::$cacheSessionParam_ARRAY[$session_param_key];

                        }

                        break;
                    case 'int':

                        if(isset(self::$cacheSessionParam_ARRAY[$session_param_key])){

                            return (int) self::$cacheSessionParam_ARRAY[$session_param_key];

                        }else{

                            self::$cacheSessionParam_ARRAY[$session_param_key] = trim($this->sessionParamDecrypt($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_' . $session_param_key]));

                            return (int) self::$cacheSessionParam_ARRAY[$session_param_key];

                        }

                        break;
                    case 'double':

                        if(isset(self::$cacheSessionParam_ARRAY[$session_param_key])){

                            return (double) self::$cacheSessionParam_ARRAY[$session_param_key];

                        }else{

                            self::$cacheSessionParam_ARRAY[$session_param_key] = trim($this->sessionParamDecrypt($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_' . $session_param_key]));

                            return (double) self::$cacheSessionParam_ARRAY[$session_param_key];

                        }

                        break;
                    case 'float':

                        if(isset(self::$cacheSessionParam_ARRAY[$session_param_key])){

                            return (float) self::$cacheSessionParam_ARRAY[$session_param_key];

                        }else{

                            self::$cacheSessionParam_ARRAY[$session_param_key] = trim($this->sessionParamDecrypt($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_' . $session_param_key]));

                            return (float) self::$cacheSessionParam_ARRAY[$session_param_key];

                        }

                        break;
                    case 'boolean':

                        if(isset(self::$cacheSessionParam_ARRAY[$session_param_key])){

                            return (boolean) self::$cacheSessionParam_ARRAY[$session_param_key];

                        }else{

                            self::$cacheSessionParam_ARRAY[$session_param_key] = trim($this->sessionParamDecrypt($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_' . $session_param_key]));

                            return (boolean) self::$cacheSessionParam_ARRAY[$session_param_key];

                        }

                        break;
                    case 'object':

                        if(isset(self::$cacheSessionParam_ARRAY[$session_param_key])){

                            return (object) self::$cacheSessionParam_ARRAY[$session_param_key];

                        }else{

                            self::$cacheSessionParam_ARRAY[$session_param_key] = unserialize($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_' . $session_param_key]);

                            return (object) self::$cacheSessionParam_ARRAY[$session_param_key];

                        }

                        break;

                }

            }else{

                //
                // NO ENCRYPTION APPLIED TO PARAM. RETURN SESSION VALUE.
                return $_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_' . $session_param_key];

            }

        }else{

            return false;

        }

        return false;

    }

    public function isset_session_tmp_param($session_param_key, $iterator = 0){

        return $this->oCRNRSTN_USR->oCRNRSTN_ENV->oSESSION_MGR->oCRNRSTN_SESSION_DDO->preach('isset', $session_param_key, false, $iterator);

        //
        // RETURN THE VALUE ASSIGNED TO A PARTICULAR SESSION PARAMETER
        if(isset($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_' . $this->crcINT($session_param_key)])){

            //
            // IF SESSION ENCRYPTION IS ENABLED, WE HAVE TO DECRYPT BEFORE WE CAN CHECK IF EMPTY
            if($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_ENCRYPT_' . $this->crcINT($session_param_key)]>0){

                if(isset(self::$cacheSessionParam_ARRAY[$session_param_key])){

                    if(self::$cacheSessionParam_ARRAY[$session_param_key]!=""){

                        return true;

                    }else{

                        return false;

                    }

                }else{

                    if($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_DTYPE_' . $this->crcINT($session_param_key)] == 'object'){

                        self::$cacheSessionParam_ARRAY[$session_param_key] = unserialize($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_' . $this->crcINT($session_param_key)]);

                        if(is_object(self::$cacheSessionParam_ARRAY[$session_param_key])){

                            return true;

                        }else{

                            return false;

                        }

                    }else{

                        self::$cacheSessionParam_ARRAY[$session_param_key] = trim($this->sessionParamDecrypt($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_' . $this->crcINT($session_param_key)]));

                        if(self::$cacheSessionParam_ARRAY[$session_param_key]!=""){

                            return true;

                        }else{

                            return false;

                        }

                    }

                }

            }else{

                //
                // NO ENCRYPTION APPLIED TO PARAM. CHECK IF EMPTY.
                if($_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH']]['CRNRSTN_' . $this->env_key_crc]['CRNRSTN_' . $this->crcINT($session_param_key)]!=""){

                    return true;

                }else{

                    return false;

                }

            }

        }else{

            return false;

        }

    }

    public function getSessionKey(){

        if($this->oCRNRSTN_SESSION_DDO->preach('isset', 'CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH'] . 'CRNRSTN_ENV_KEY_CRC')){

            return $this->oCRNRSTN_SESSION_DDO->preach('value', 'CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_HASH'] . 'CRNRSTN_ENV_KEY_CRC');

        }

        error_log(__LINE__ . ' session '. __METHOD__ . ':: We apparently still need session on this one. ');

        return $_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_CRC']]['CRNRSTN_ENV_KEY_CRC'];
		
	}
	
	public function setSessionIp($key, $ip){

	    $this->oCRNRSTN_SESSION_DDO->add($ip,'CRNRSTN_' . $this->config_serial_hash . $this->crcINT($key));

		$_SESSION['CRNRSTN_' . $this->config_serial_hash . $this->crcINT($key)] = $ip;

	}
	
	public function getSessionIp(){

	    error_log(__LINE__ . ' session ' . __METHOD__ . ' SESSION IP IS [' . $this->oCRNRSTN_USR->get_resource('CRNRSTN_SESSION_IP') . ']. die();');
	    die();

        return $this->oCRNRSTN_USR->get_resource('CRNRSTN_SESSION_IP');

	}

	private function sessionParamEncrypt($val){

		try{

		    $tmp_class_name = get_class($this->oCRNRSTN_USR);

//		    if($tmp_class_name != 'crnrstn_user'){
//
//		        error_log(__LINE__ . ' session ' . __METHOD__ . ' WE HAVE UNEXPECTED CLASS [' . $tmp_class_name . '] CALLING SESSION ENCRYPT.');
//		        die();
//
//            }

			if($this->oCRNRSTN_SESSION_DDO->preach('isset', $this->oCRNRSTN_USR->return_prefixed_ddo_key('encrypt_cipher', CRNRSTN_RESOURCE_ALL, 'CRNRSTN_SYSTEM_CHANNEL::SESSION_ENCRYPTION'), true)){

			    //
                // EXTRACT DATA FROM SESSION DDO
                $tmp_encrypt_cipher = $this->oCRNRSTN_SESSION_DDO->preach('value', $this->oCRNRSTN_USR->return_prefixed_ddo_key('encrypt_cipher', CRNRSTN_RESOURCE_ALL, 'CRNRSTN_SYSTEM_CHANNEL::SESSION_ENCRYPTION'), true);
                $tmp_encrypt_secret_key = $this->oCRNRSTN_SESSION_DDO->preach('value', $this->oCRNRSTN_USR->return_prefixed_ddo_key('encrypt_secret_key', CRNRSTN_RESOURCE_ALL, 'CRNRSTN_SYSTEM_CHANNEL::SESSION_ENCRYPTION'), true);
                $tmp_encrypt_options = $this->oCRNRSTN_SESSION_DDO->preach('value', $this->oCRNRSTN_USR->return_prefixed_ddo_key('encrypt_options', CRNRSTN_RESOURCE_ALL, 'CRNRSTN_SYSTEM_CHANNEL::SESSION_ENCRYPTION'), true);
                $tmp_hmac_alg = $this->oCRNRSTN_SESSION_DDO->preach('value', $this->oCRNRSTN_USR->return_prefixed_ddo_key('hmac_alg', CRNRSTN_RESOURCE_ALL, 'CRNRSTN_SYSTEM_CHANNEL::SESSION_ENCRYPTION'), true);

                #
				# Source: http://php.net/manual/en/function.openssl-encrypt.php
				#
				$ivlen = openssl_cipher_iv_length($cipher = $tmp_encrypt_cipher);
				$iv = openssl_random_pseudo_bytes($ivlen);
				$ciphertext_raw = openssl_encrypt($val, $tmp_encrypt_cipher, $tmp_encrypt_secret_key, $options = $tmp_encrypt_options, $iv);
				$hmac = hash_hmac($tmp_hmac_alg, $ciphertext_raw, $tmp_encrypt_secret_key, $as_binary = true);
				$ciphertext = base64_encode( $iv . $hmac . $ciphertext_raw );
				
				return $ciphertext;

			}else{
				
				return $val;

			}

		}catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

			return false;

		}

	}
	 
	private function sessionParamDecrypt($val){

		try{

            if($this->oCRNRSTN_SESSION_DDO->preach('isset', $this->oCRNRSTN_USR->return_prefixed_ddo_key('encrypt_cipher', CRNRSTN_RESOURCE_ALL, 'CRNRSTN_SYSTEM_CHANNEL::SESSION_ENCRYPTION'), true)){

                //
                // EXTRACT DATA FROM SESSION DDO
                $tmp_encrypt_cipher = $this->oCRNRSTN_SESSION_DDO->preach('value', $this->oCRNRSTN_USR->return_prefixed_ddo_key('encrypt_cipher', CRNRSTN_RESOURCE_ALL, 'CRNRSTN_SYSTEM_CHANNEL::SESSION_ENCRYPTION'), true);
                $tmp_encrypt_secret_key = $this->oCRNRSTN_SESSION_DDO->preach('value', $this->oCRNRSTN_USR->return_prefixed_ddo_key('encrypt_secret_key', CRNRSTN_RESOURCE_ALL, 'CRNRSTN_SYSTEM_CHANNEL::SESSION_ENCRYPTION'), true);
                $tmp_encrypt_options = $this->oCRNRSTN_SESSION_DDO->preach('value', $this->oCRNRSTN_USR->return_prefixed_ddo_key('encrypt_options', CRNRSTN_RESOURCE_ALL, 'CRNRSTN_SYSTEM_CHANNEL::SESSION_ENCRYPTION'), true);
                $tmp_hmac_alg = $this->oCRNRSTN_SESSION_DDO->preach('value', $this->oCRNRSTN_USR->return_prefixed_ddo_key('hmac_alg', CRNRSTN_RESOURCE_ALL, 'CRNRSTN_SYSTEM_CHANNEL::SESSION_ENCRYPTION'), true);

                #
				# Source: http://php.net/manual/en/function.openssl-encrypt.php
				#
				$c = base64_decode($val);
				$ivlen = openssl_cipher_iv_length($cipher = $tmp_encrypt_cipher);
				$iv = substr($c, 0, $ivlen);
				$hmac = substr($c, $ivlen, $sha2len=32);
				$ciphertext_raw = substr($c, $ivlen+$sha2len);
				$original_plaintext = openssl_decrypt($ciphertext_raw, $tmp_encrypt_cipher, $tmp_encrypt_secret_key, $options = $tmp_encrypt_options, $iv);
				$calcmac = hash_hmac($tmp_hmac_alg, $ciphertext_raw, $tmp_encrypt_secret_key, $as_binary = true);
				
				if (hash_equals($hmac, $calcmac))//PHP 5.6+ timing attack safe comparison
				{
					return $original_plaintext;

				}else{
					
					//
					// HOOOSTON...VE HAF PROBLEM!
					throw new Exception('CRNRSTN :: Session Param Decrypt Notice :: Oops. Something went wrong. Hash_equals comparison failed during data decryption.');

				}
			
			}else{
				
				//
				// NO ENCRYPTION. RETURN VAL
                //error_log('316 session - NO ENCRYPTION. RETURN VAL.');
				return $val;

			}
			
		}catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

			return false;

		}

	}

//    public function crcINT($value){
//
//        $value = crc32($value);
//        return sprintf("%u", $value);
//
//    }

	public function __destruct() {

    }

}