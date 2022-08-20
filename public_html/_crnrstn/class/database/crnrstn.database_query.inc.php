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
# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: crnrstn_database_query
#  VERSION :: 1.00.0000
#  DATE :: Monday July 13, 2020 @ 0525hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: A statement made in the language of structured query.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_database_query {

    protected $oLogger;
    public $oSqlSelect_tracker;
    public $oCRNRSTN_USR;
    private static $oCRNRSTN_ENV;

    public $crnrstn_db_query_serial;
    public $query_life_stage;
    public $query_ttl;

    protected $class_name;
    protected $query_wiring_serial;
    protected $connection_serial;
    protected $mysqli;
    protected $result_handle;
    protected $batch_key;
    protected $result_set_key;
    protected $raw_query;
    protected $select_query;
    protected $date_created;
    protected $date_modified;
    protected $creator_ip;
    protected $modifier_ip;
    protected $query_MD5;
    protected $query_SHA1;
    protected $php_sessionid;
    protected $http_accept_language;
    protected $http_accept_encoding;
    protected $https;
    protected $http_user_agent;
    protected $http_client_ip;
    protected $http_x_forwarded_for;
    protected $remote_addr;
    protected $server_port;
    protected $remote_port;
    protected $http_accept_charset;
    protected $request_method;

    protected $result_record_count = 0;
    protected $resultDataByRow = array();
    protected $resultDataByVal = array();

    protected $keyByID_ARRAY = array();
    protected $keyByIdLog = array();
    protected $dataByID_field_position = array();
    protected $dataByID_lookup_value = array();
    protected $flagLookupDataByID = array();
    protected $flagLookupDataSerial = array();
    protected $lookupSerialIndex = array();
    protected $loadedLookupSerialIndex = array();

    public function __construct($oCRNRSTN_USR) {

        $this->class_name = get_class();
        $this->query_life_stage = 'NEW';
        
        try{

            if(isset($oCRNRSTN_USR)){

                $this->oCRNRSTN_USR = $oCRNRSTN_USR;

                $this->oSqlSelect_tracker = new crnrstn_sqlselect_tracker($this->oCRNRSTN_USR);
                
                //
                // SERIALIZE OBJECT - LEN32
                $this->crnrstn_db_query_serial = $this->oCRNRSTN_USR->generate_new_key();
                $this->query_life_stage = 'NEW';                        # [NEW=NEW, READY=READY FOR SENDING, SENT=SENT TO DATABASE, WAITING=WAITING FOR RESULT, RECEIVED=DATABASE RESULT RECEIVED, ACCESSED=DATABASE RESULT ACCESSED, EXPIRED=DATABASE RESULT EXPIRED, CACHED=CACHED]
                $this->query_ttl = $this->oCRNRSTN_USR->query_ttl;      # [0 = UNLIMITED]

                self::$oCRNRSTN_ENV = $this->oCRNRSTN_USR->return_oCRNRSTN_ENV();

                //
                // INSTANTIATE LOGGER
                $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN_USR);

                $this->date_created = $this->date_modified = $this->oLogger->returnMicroTime();
                $this->creator_ip = $this->oCRNRSTN_USR->return_client_ip();
                $this->modifier_ip = $this->oCRNRSTN_USR->return_client_ip();
                $this->php_sessionid = session_id();
                $this->http_accept_language = self::$oCRNRSTN_ENV->safe_getServerArrayVar('HTTP_ACCEPT_LANGUAGE');
                $this->http_user_agent = self::$oCRNRSTN_ENV->safe_getServerArrayVar('HTTP_USER_AGENT');
                $this->http_accept_encoding = self::$oCRNRSTN_ENV->safe_getServerArrayVar('HTTP_ACCEPT_ENCODING');
                $this->https = self::$oCRNRSTN_ENV->safe_getServerArrayVar('HTTPS');
                $this->remote_addr = self::$oCRNRSTN_ENV->safe_getServerArrayVar('REMOTE_ADDR');
                $this->server_port = self::$oCRNRSTN_ENV->safe_getServerArrayVar('SERVER_PORT');
                $this->remote_port = self::$oCRNRSTN_ENV->safe_getServerArrayVar('REMOTE_PORT');
                $this->http_accept_charset = self::$oCRNRSTN_ENV->safe_getServerArrayVar('HTTP_ACCEPT_CHARSET');
                $this->request_method = self::$oCRNRSTN_ENV->safe_getServerArrayVar('REQUEST_METHOD');

                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {

                    $this->http_client_ip = $_SERVER['HTTP_CLIENT_IP'];

                }

                if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

                    $this->http_x_forwarded_for = $_SERVER['HTTP_X_FORWARDED_FOR'];

                }

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('oCRNRSTN_USR is a required parameter for crnrstn_database_query :: __construct().');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function load_previous_record_lookup($result_set_key, $lookup_serial){

        //error_log('135 query - lookup serial=>' . $lookup_serial);
        $this->loadedLookupSerialIndex[$result_set_key] = $lookup_serial;

    }

    public function init_lookup_by_id($result_set_key){

        $tmp_lookup_serial = $this->oCRNRSTN_USR->generate_new_key(50);
        $this->lookupSerialIndex[$result_set_key][] = $tmp_lookup_serial;
        $this->load_previous_record_lookup($result_set_key, $tmp_lookup_serial);

    }

    public function add_lookup_field_data($result_set_key, $field_name, $field_value){

        try{

            if(!isset($this->lookupSerialIndex[$result_set_key])){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('oCRNRSTN_USR->init_lookup_by_id() must be called for the result set "' . $result_set_key.'" prior to adding any lookup field data via oCRNRSTN_USR->add_lookup_field_data().');

            }else{

                //
                // GET LAST ELEMENT IN SERIALIZATION ARRAY
                $tmp_lookup_serial = end($this->lookupSerialIndex[$result_set_key]);

                if(!isset($this->flagLookupDataSerial[$tmp_lookup_serial][$result_set_key][$field_name])){

                    $this->lookupSerialIndex[$result_set_key][] = $tmp_lookup_serial;
                    $this->flagLookupDataSerial[$tmp_lookup_serial][$result_set_key][$field_name][$field_value] = 1;

                    $this->dataByID_field_position[$tmp_lookup_serial][$result_set_key][] = $field_name;
                    $this->dataByID_lookup_value[$tmp_lookup_serial][$result_set_key][] = $field_value;

                    $this->flagLookupDataByID[$tmp_lookup_serial][$result_set_key][$field_name] = $field_value;
                }

                // error_log('186 query - lookup array size='.sizeof($this->lookupSerialIndex[$result_set_key]));
                return $this->lookupSerialIndex[$result_set_key];

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    private function buildOutLookupPointerRef($result_set_key, $lookupID_field_position, $indexCount){

        try{

            //
            // BUILD DATA STRUCT TRAVERSING EACH ROW
            foreach($this->resultDataByRow as $rowcount=>$chunkArray0){

                foreach($chunkArray0 as $result_field_position=>$value){

                    switch($indexCount){
                        case 2:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];

                            //error_log('158 query - [' . $tmp_00.'][' . $tmp_01.'][' . $this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position).'][' . $value.']');
                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 3:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 4:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 5:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 6:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 7:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 8:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 9:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 10:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 11:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];
                            $tmp_10 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][10])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$tmp_10][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 12:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];
                            $tmp_10 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][10])];
                            $tmp_11 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][11])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$tmp_10][$tmp_11][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 13:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];
                            $tmp_10 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][10])];
                            $tmp_11 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][11])];
                            $tmp_12 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][12])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$tmp_10][$tmp_11][$tmp_12][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 14:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];
                            $tmp_10 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][10])];
                            $tmp_11 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][11])];
                            $tmp_12 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][12])];
                            $tmp_13 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][13])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$tmp_10][$tmp_11][$tmp_12][$tmp_13][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 15:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];
                            $tmp_10 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][10])];
                            $tmp_11 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][11])];
                            $tmp_12 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][12])];
                            $tmp_13 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][13])];
                            $tmp_14 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][14])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$tmp_10][$tmp_11][$tmp_12][$tmp_13][$tmp_14][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 16:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];
                            $tmp_10 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][10])];
                            $tmp_11 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][11])];
                            $tmp_12 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][12])];
                            $tmp_13 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][13])];
                            $tmp_14 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][14])];
                            $tmp_15 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][15])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$tmp_10][$tmp_11][$tmp_12][$tmp_13][$tmp_14][$tmp_15][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 17:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];
                            $tmp_10 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][10])];
                            $tmp_11 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][11])];
                            $tmp_12 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][12])];
                            $tmp_13 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][13])];
                            $tmp_14 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][14])];
                            $tmp_15 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][15])];
                            $tmp_16 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][16])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$tmp_10][$tmp_11][$tmp_12][$tmp_13][$tmp_14][$tmp_15][$tmp_16][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 18:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];
                            $tmp_10 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][10])];
                            $tmp_11 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][11])];
                            $tmp_12 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][12])];
                            $tmp_13 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][13])];
                            $tmp_14 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][14])];
                            $tmp_15 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][15])];
                            $tmp_16 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][16])];
                            $tmp_17 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][17])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$tmp_10][$tmp_11][$tmp_12][$tmp_13][$tmp_14][$tmp_15][$tmp_16][$tmp_17][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 19:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];
                            $tmp_10 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][10])];
                            $tmp_11 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][11])];
                            $tmp_12 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][12])];
                            $tmp_13 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][13])];
                            $tmp_14 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][14])];
                            $tmp_15 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][15])];
                            $tmp_16 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][16])];
                            $tmp_17 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][17])];
                            $tmp_18 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][18])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$tmp_10][$tmp_11][$tmp_12][$tmp_13][$tmp_14][$tmp_15][$tmp_16][$tmp_17][$tmp_18][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 20:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];
                            $tmp_10 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][10])];
                            $tmp_11 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][11])];
                            $tmp_12 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][12])];
                            $tmp_13 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][13])];
                            $tmp_14 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][14])];
                            $tmp_15 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][15])];
                            $tmp_16 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][16])];
                            $tmp_17 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][17])];
                            $tmp_18 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][18])];
                            $tmp_19 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][19])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$tmp_10][$tmp_11][$tmp_12][$tmp_13][$tmp_14][$tmp_15][$tmp_16][$tmp_17][$tmp_18][$tmp_19][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 21:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];
                            $tmp_10 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][10])];
                            $tmp_11 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][11])];
                            $tmp_12 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][12])];
                            $tmp_13 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][13])];
                            $tmp_14 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][14])];
                            $tmp_15 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][15])];
                            $tmp_16 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][16])];
                            $tmp_17 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][17])];
                            $tmp_18 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][18])];
                            $tmp_19 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][19])];
                            $tmp_20 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][20])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$tmp_10][$tmp_11][$tmp_12][$tmp_13][$tmp_14][$tmp_15][$tmp_16][$tmp_17][$tmp_18][$tmp_19][$tmp_20][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 22:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];
                            $tmp_10 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][10])];
                            $tmp_11 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][11])];
                            $tmp_12 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][12])];
                            $tmp_13 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][13])];
                            $tmp_14 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][14])];
                            $tmp_15 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][15])];
                            $tmp_16 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][16])];
                            $tmp_17 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][17])];
                            $tmp_18 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][18])];
                            $tmp_19 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][19])];
                            $tmp_20 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][20])];
                            $tmp_21 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][21])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$tmp_10][$tmp_11][$tmp_12][$tmp_13][$tmp_14][$tmp_15][$tmp_16][$tmp_17][$tmp_18][$tmp_19][$tmp_20][$tmp_21][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 23:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];
                            $tmp_10 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][10])];
                            $tmp_11 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][11])];
                            $tmp_12 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][12])];
                            $tmp_13 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][13])];
                            $tmp_14 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][14])];
                            $tmp_15 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][15])];
                            $tmp_16 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][16])];
                            $tmp_17 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][17])];
                            $tmp_18 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][18])];
                            $tmp_19 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][19])];
                            $tmp_20 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][20])];
                            $tmp_21 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][21])];
                            $tmp_22 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][22])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$tmp_10][$tmp_11][$tmp_12][$tmp_13][$tmp_14][$tmp_15][$tmp_16][$tmp_17][$tmp_18][$tmp_19][$tmp_20][$tmp_21][$tmp_22][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 24:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];
                            $tmp_10 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][10])];
                            $tmp_11 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][11])];
                            $tmp_12 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][12])];
                            $tmp_13 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][13])];
                            $tmp_14 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][14])];
                            $tmp_15 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][15])];
                            $tmp_16 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][16])];
                            $tmp_17 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][17])];
                            $tmp_18 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][18])];
                            $tmp_19 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][19])];
                            $tmp_20 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][20])];
                            $tmp_21 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][21])];
                            $tmp_22 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][22])];
                            $tmp_23 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][23])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$tmp_10][$tmp_11][$tmp_12][$tmp_13][$tmp_14][$tmp_15][$tmp_16][$tmp_17][$tmp_18][$tmp_19][$tmp_20][$tmp_21][$tmp_22][$tmp_23][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 25:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];
                            $tmp_10 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][10])];
                            $tmp_11 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][11])];
                            $tmp_12 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][12])];
                            $tmp_13 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][13])];
                            $tmp_14 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][14])];
                            $tmp_15 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][15])];
                            $tmp_16 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][16])];
                            $tmp_17 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][17])];
                            $tmp_18 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][18])];
                            $tmp_19 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][19])];
                            $tmp_20 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][20])];
                            $tmp_21 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][21])];
                            $tmp_22 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][22])];
                            $tmp_23 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][23])];
                            $tmp_24 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][24])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$tmp_10][$tmp_11][$tmp_12][$tmp_13][$tmp_14][$tmp_15][$tmp_16][$tmp_17][$tmp_18][$tmp_19][$tmp_20][$tmp_21][$tmp_22][$tmp_23][$tmp_24][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 26:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];
                            $tmp_10 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][10])];
                            $tmp_11 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][11])];
                            $tmp_12 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][12])];
                            $tmp_13 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][13])];
                            $tmp_14 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][14])];
                            $tmp_15 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][15])];
                            $tmp_16 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][16])];
                            $tmp_17 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][17])];
                            $tmp_18 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][18])];
                            $tmp_19 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][19])];
                            $tmp_20 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][20])];
                            $tmp_21 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][21])];
                            $tmp_22 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][22])];
                            $tmp_23 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][23])];
                            $tmp_24 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][24])];
                            $tmp_25 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][25])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$tmp_10][$tmp_11][$tmp_12][$tmp_13][$tmp_14][$tmp_15][$tmp_16][$tmp_17][$tmp_18][$tmp_19][$tmp_20][$tmp_21][$tmp_22][$tmp_23][$tmp_24][$tmp_25][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 27:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];
                            $tmp_10 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][10])];
                            $tmp_11 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][11])];
                            $tmp_12 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][12])];
                            $tmp_13 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][13])];
                            $tmp_14 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][14])];
                            $tmp_15 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][15])];
                            $tmp_16 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][16])];
                            $tmp_17 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][17])];
                            $tmp_18 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][18])];
                            $tmp_19 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][19])];
                            $tmp_20 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][20])];
                            $tmp_21 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][21])];
                            $tmp_22 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][22])];
                            $tmp_23 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][23])];
                            $tmp_24 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][24])];
                            $tmp_25 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][25])];
                            $tmp_26 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][26])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$tmp_10][$tmp_11][$tmp_12][$tmp_13][$tmp_14][$tmp_15][$tmp_16][$tmp_17][$tmp_18][$tmp_19][$tmp_20][$tmp_21][$tmp_22][$tmp_23][$tmp_24][$tmp_25][$tmp_26][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 28:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];
                            $tmp_10 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][10])];
                            $tmp_11 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][11])];
                            $tmp_12 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][12])];
                            $tmp_13 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][13])];
                            $tmp_14 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][14])];
                            $tmp_15 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][15])];
                            $tmp_16 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][16])];
                            $tmp_17 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][17])];
                            $tmp_18 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][18])];
                            $tmp_19 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][19])];
                            $tmp_20 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][20])];
                            $tmp_21 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][21])];
                            $tmp_22 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][22])];
                            $tmp_23 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][23])];
                            $tmp_24 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][24])];
                            $tmp_25 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][25])];
                            $tmp_26 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][26])];
                            $tmp_27 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][27])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$tmp_10][$tmp_11][$tmp_12][$tmp_13][$tmp_14][$tmp_15][$tmp_16][$tmp_17][$tmp_18][$tmp_19][$tmp_20][$tmp_21][$tmp_22][$tmp_23][$tmp_24][$tmp_25][$tmp_26][$tmp_27][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 29:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];
                            $tmp_10 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][10])];
                            $tmp_11 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][11])];
                            $tmp_12 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][12])];
                            $tmp_13 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][13])];
                            $tmp_14 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][14])];
                            $tmp_15 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][15])];
                            $tmp_16 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][16])];
                            $tmp_17 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][17])];
                            $tmp_18 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][18])];
                            $tmp_19 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][19])];
                            $tmp_20 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][20])];
                            $tmp_21 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][21])];
                            $tmp_22 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][22])];
                            $tmp_23 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][23])];
                            $tmp_24 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][24])];
                            $tmp_25 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][25])];
                            $tmp_26 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][26])];
                            $tmp_27 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][27])];
                            $tmp_28 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][28])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$tmp_10][$tmp_11][$tmp_12][$tmp_13][$tmp_14][$tmp_15][$tmp_16][$tmp_17][$tmp_18][$tmp_19][$tmp_20][$tmp_21][$tmp_22][$tmp_23][$tmp_24][$tmp_25][$tmp_26][$tmp_27][$tmp_28][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 30:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];
                            $tmp_10 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][10])];
                            $tmp_11 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][11])];
                            $tmp_12 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][12])];
                            $tmp_13 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][13])];
                            $tmp_14 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][14])];
                            $tmp_15 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][15])];
                            $tmp_16 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][16])];
                            $tmp_17 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][17])];
                            $tmp_18 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][18])];
                            $tmp_19 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][19])];
                            $tmp_20 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][20])];
                            $tmp_21 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][21])];
                            $tmp_22 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][22])];
                            $tmp_23 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][23])];
                            $tmp_24 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][24])];
                            $tmp_25 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][25])];
                            $tmp_26 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][26])];
                            $tmp_27 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][27])];
                            $tmp_28 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][28])];
                            $tmp_29 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][29])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$tmp_10][$tmp_11][$tmp_12][$tmp_13][$tmp_14][$tmp_15][$tmp_16][$tmp_17][$tmp_18][$tmp_19][$tmp_20][$tmp_21][$tmp_22][$tmp_23][$tmp_24][$tmp_25][$tmp_26][$tmp_27][$tmp_28][$tmp_29][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 31:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];
                            $tmp_10 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][10])];
                            $tmp_11 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][11])];
                            $tmp_12 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][12])];
                            $tmp_13 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][13])];
                            $tmp_14 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][14])];
                            $tmp_15 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][15])];
                            $tmp_16 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][16])];
                            $tmp_17 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][17])];
                            $tmp_18 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][18])];
                            $tmp_19 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][19])];
                            $tmp_20 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][20])];
                            $tmp_21 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][21])];
                            $tmp_22 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][22])];
                            $tmp_23 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][23])];
                            $tmp_24 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][24])];
                            $tmp_25 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][25])];
                            $tmp_26 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][26])];
                            $tmp_27 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][27])];
                            $tmp_28 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][28])];
                            $tmp_29 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][29])];
                            $tmp_30 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][30])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$tmp_10][$tmp_11][$tmp_12][$tmp_13][$tmp_14][$tmp_15][$tmp_16][$tmp_17][$tmp_18][$tmp_19][$tmp_20][$tmp_21][$tmp_22][$tmp_23][$tmp_24][$tmp_25][$tmp_26][$tmp_27][$tmp_28][$tmp_29][$tmp_30][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 32:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];
                            $tmp_10 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][10])];
                            $tmp_11 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][11])];
                            $tmp_12 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][12])];
                            $tmp_13 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][13])];
                            $tmp_14 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][14])];
                            $tmp_15 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][15])];
                            $tmp_16 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][16])];
                            $tmp_17 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][17])];
                            $tmp_18 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][18])];
                            $tmp_19 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][19])];
                            $tmp_20 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][20])];
                            $tmp_21 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][21])];
                            $tmp_22 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][22])];
                            $tmp_23 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][23])];
                            $tmp_24 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][24])];
                            $tmp_25 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][25])];
                            $tmp_26 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][26])];
                            $tmp_27 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][27])];
                            $tmp_28 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][28])];
                            $tmp_29 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][29])];
                            $tmp_30 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][30])];
                            $tmp_31 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][31])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$tmp_10][$tmp_11][$tmp_12][$tmp_13][$tmp_14][$tmp_15][$tmp_16][$tmp_17][$tmp_18][$tmp_19][$tmp_20][$tmp_21][$tmp_22][$tmp_23][$tmp_24][$tmp_25][$tmp_26][$tmp_27][$tmp_28][$tmp_29][$tmp_30][$tmp_31][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 33:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];
                            $tmp_10 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][10])];
                            $tmp_11 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][11])];
                            $tmp_12 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][12])];
                            $tmp_13 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][13])];
                            $tmp_14 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][14])];
                            $tmp_15 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][15])];
                            $tmp_16 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][16])];
                            $tmp_17 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][17])];
                            $tmp_18 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][18])];
                            $tmp_19 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][19])];
                            $tmp_20 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][20])];
                            $tmp_21 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][21])];
                            $tmp_22 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][22])];
                            $tmp_23 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][23])];
                            $tmp_24 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][24])];
                            $tmp_25 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][25])];
                            $tmp_26 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][26])];
                            $tmp_27 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][27])];
                            $tmp_28 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][28])];
                            $tmp_29 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][29])];
                            $tmp_30 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][30])];
                            $tmp_31 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][31])];
                            $tmp_32 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][32])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$tmp_10][$tmp_11][$tmp_12][$tmp_13][$tmp_14][$tmp_15][$tmp_16][$tmp_17][$tmp_18][$tmp_19][$tmp_20][$tmp_21][$tmp_22][$tmp_23][$tmp_24][$tmp_25][$tmp_26][$tmp_27][$tmp_28][$tmp_29][$tmp_30][$tmp_31][$tmp_32][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 34:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];
                            $tmp_10 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][10])];
                            $tmp_11 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][11])];
                            $tmp_12 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][12])];
                            $tmp_13 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][13])];
                            $tmp_14 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][14])];
                            $tmp_15 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][15])];
                            $tmp_16 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][16])];
                            $tmp_17 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][17])];
                            $tmp_18 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][18])];
                            $tmp_19 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][19])];
                            $tmp_20 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][20])];
                            $tmp_21 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][21])];
                            $tmp_22 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][22])];
                            $tmp_23 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][23])];
                            $tmp_24 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][24])];
                            $tmp_25 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][25])];
                            $tmp_26 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][26])];
                            $tmp_27 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][27])];
                            $tmp_28 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][28])];
                            $tmp_29 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][29])];
                            $tmp_30 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][30])];
                            $tmp_31 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][31])];
                            $tmp_32 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][32])];
                            $tmp_33 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][33])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$tmp_10][$tmp_11][$tmp_12][$tmp_13][$tmp_14][$tmp_15][$tmp_16][$tmp_17][$tmp_18][$tmp_19][$tmp_20][$tmp_21][$tmp_22][$tmp_23][$tmp_24][$tmp_25][$tmp_26][$tmp_27][$tmp_28][$tmp_29][$tmp_30][$tmp_31][$tmp_32][$tmp_33][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 35:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];
                            $tmp_10 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][10])];
                            $tmp_11 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][11])];
                            $tmp_12 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][12])];
                            $tmp_13 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][13])];
                            $tmp_14 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][14])];
                            $tmp_15 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][15])];
                            $tmp_16 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][16])];
                            $tmp_17 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][17])];
                            $tmp_18 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][18])];
                            $tmp_19 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][19])];
                            $tmp_20 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][20])];
                            $tmp_21 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][21])];
                            $tmp_22 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][22])];
                            $tmp_23 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][23])];
                            $tmp_24 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][24])];
                            $tmp_25 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][25])];
                            $tmp_26 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][26])];
                            $tmp_27 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][27])];
                            $tmp_28 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][28])];
                            $tmp_29 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][29])];
                            $tmp_30 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][30])];
                            $tmp_31 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][31])];
                            $tmp_32 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][32])];
                            $tmp_33 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][33])];
                            $tmp_34 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][34])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$tmp_10][$tmp_11][$tmp_12][$tmp_13][$tmp_14][$tmp_15][$tmp_16][$tmp_17][$tmp_18][$tmp_19][$tmp_20][$tmp_21][$tmp_22][$tmp_23][$tmp_24][$tmp_25][$tmp_26][$tmp_27][$tmp_28][$tmp_29][$tmp_30][$tmp_31][$tmp_32][$tmp_33][$tmp_34][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 36:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];
                            $tmp_10 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][10])];
                            $tmp_11 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][11])];
                            $tmp_12 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][12])];
                            $tmp_13 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][13])];
                            $tmp_14 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][14])];
                            $tmp_15 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][15])];
                            $tmp_16 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][16])];
                            $tmp_17 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][17])];
                            $tmp_18 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][18])];
                            $tmp_19 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][19])];
                            $tmp_20 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][20])];
                            $tmp_21 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][21])];
                            $tmp_22 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][22])];
                            $tmp_23 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][23])];
                            $tmp_24 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][24])];
                            $tmp_25 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][25])];
                            $tmp_26 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][26])];
                            $tmp_27 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][27])];
                            $tmp_28 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][28])];
                            $tmp_29 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][29])];
                            $tmp_30 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][30])];
                            $tmp_31 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][31])];
                            $tmp_32 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][32])];
                            $tmp_33 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][33])];
                            $tmp_34 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][34])];
                            $tmp_35 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][35])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$tmp_10][$tmp_11][$tmp_12][$tmp_13][$tmp_14][$tmp_15][$tmp_16][$tmp_17][$tmp_18][$tmp_19][$tmp_20][$tmp_21][$tmp_22][$tmp_23][$tmp_24][$tmp_25][$tmp_26][$tmp_27][$tmp_28][$tmp_29][$tmp_30][$tmp_31][$tmp_32][$tmp_33][$tmp_34][$tmp_35][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 37:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];
                            $tmp_10 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][10])];
                            $tmp_11 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][11])];
                            $tmp_12 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][12])];
                            $tmp_13 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][13])];
                            $tmp_14 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][14])];
                            $tmp_15 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][15])];
                            $tmp_16 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][16])];
                            $tmp_17 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][17])];
                            $tmp_18 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][18])];
                            $tmp_19 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][19])];
                            $tmp_20 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][20])];
                            $tmp_21 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][21])];
                            $tmp_22 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][22])];
                            $tmp_23 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][23])];
                            $tmp_24 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][24])];
                            $tmp_25 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][25])];
                            $tmp_26 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][26])];
                            $tmp_27 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][27])];
                            $tmp_28 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][28])];
                            $tmp_29 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][29])];
                            $tmp_30 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][30])];
                            $tmp_31 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][31])];
                            $tmp_32 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][32])];
                            $tmp_33 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][33])];
                            $tmp_34 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][34])];
                            $tmp_35 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][35])];
                            $tmp_36 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][36])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$tmp_10][$tmp_11][$tmp_12][$tmp_13][$tmp_14][$tmp_15][$tmp_16][$tmp_17][$tmp_18][$tmp_19][$tmp_20][$tmp_21][$tmp_22][$tmp_23][$tmp_24][$tmp_25][$tmp_26][$tmp_27][$tmp_28][$tmp_29][$tmp_30][$tmp_31][$tmp_32][$tmp_33][$tmp_34][$tmp_35][$tmp_36][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 38:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];
                            $tmp_10 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][10])];
                            $tmp_11 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][11])];
                            $tmp_12 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][12])];
                            $tmp_13 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][13])];
                            $tmp_14 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][14])];
                            $tmp_15 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][15])];
                            $tmp_16 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][16])];
                            $tmp_17 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][17])];
                            $tmp_18 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][18])];
                            $tmp_19 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][19])];
                            $tmp_20 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][20])];
                            $tmp_21 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][21])];
                            $tmp_22 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][22])];
                            $tmp_23 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][23])];
                            $tmp_24 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][24])];
                            $tmp_25 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][25])];
                            $tmp_26 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][26])];
                            $tmp_27 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][27])];
                            $tmp_28 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][28])];
                            $tmp_29 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][29])];
                            $tmp_30 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][30])];
                            $tmp_31 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][31])];
                            $tmp_32 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][32])];
                            $tmp_33 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][33])];
                            $tmp_34 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][34])];
                            $tmp_35 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][35])];
                            $tmp_36 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][36])];
                            $tmp_37 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][37])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$tmp_10][$tmp_11][$tmp_12][$tmp_13][$tmp_14][$tmp_15][$tmp_16][$tmp_17][$tmp_18][$tmp_19][$tmp_20][$tmp_21][$tmp_22][$tmp_23][$tmp_24][$tmp_25][$tmp_26][$tmp_27][$tmp_28][$tmp_29][$tmp_30][$tmp_31][$tmp_32][$tmp_33][$tmp_34][$tmp_35][$tmp_36][$tmp_37][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 39:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];
                            $tmp_10 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][10])];
                            $tmp_11 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][11])];
                            $tmp_12 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][12])];
                            $tmp_13 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][13])];
                            $tmp_14 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][14])];
                            $tmp_15 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][15])];
                            $tmp_16 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][16])];
                            $tmp_17 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][17])];
                            $tmp_18 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][18])];
                            $tmp_19 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][19])];
                            $tmp_20 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][20])];
                            $tmp_21 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][21])];
                            $tmp_22 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][22])];
                            $tmp_23 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][23])];
                            $tmp_24 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][24])];
                            $tmp_25 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][25])];
                            $tmp_26 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][26])];
                            $tmp_27 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][27])];
                            $tmp_28 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][28])];
                            $tmp_29 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][29])];
                            $tmp_30 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][30])];
                            $tmp_31 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][31])];
                            $tmp_32 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][32])];
                            $tmp_33 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][33])];
                            $tmp_34 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][34])];
                            $tmp_35 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][35])];
                            $tmp_36 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][36])];
                            $tmp_37 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][37])];
                            $tmp_38 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][38])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$tmp_10][$tmp_11][$tmp_12][$tmp_13][$tmp_14][$tmp_15][$tmp_16][$tmp_17][$tmp_18][$tmp_19][$tmp_20][$tmp_21][$tmp_22][$tmp_23][$tmp_24][$tmp_25][$tmp_26][$tmp_27][$tmp_28][$tmp_29][$tmp_30][$tmp_31][$tmp_32][$tmp_33][$tmp_34][$tmp_35][$tmp_36][$tmp_37][$tmp_38][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        case 40:

                            $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][0])];
                            $tmp_01 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][1])];
                            $tmp_02 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][2])];
                            $tmp_03 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][3])];
                            $tmp_04 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][4])];
                            $tmp_05 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][5])];
                            $tmp_06 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][6])];
                            $tmp_07 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][7])];
                            $tmp_08 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][8])];
                            $tmp_09 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][9])];
                            $tmp_10 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][10])];
                            $tmp_11 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][11])];
                            $tmp_12 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][12])];
                            $tmp_13 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][13])];
                            $tmp_14 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][14])];
                            $tmp_15 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][15])];
                            $tmp_16 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][16])];
                            $tmp_17 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][17])];
                            $tmp_18 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][18])];
                            $tmp_19 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][19])];
                            $tmp_20 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][20])];
                            $tmp_21 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][21])];
                            $tmp_22 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][22])];
                            $tmp_23 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][23])];
                            $tmp_24 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][24])];
                            $tmp_25 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][25])];
                            $tmp_26 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][26])];
                            $tmp_27 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][27])];
                            $tmp_28 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][28])];
                            $tmp_29 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][29])];
                            $tmp_30 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][30])];
                            $tmp_31 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][31])];
                            $tmp_32 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][32])];
                            $tmp_33 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][33])];
                            $tmp_34 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][34])];
                            $tmp_35 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][35])];
                            $tmp_36 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][36])];
                            $tmp_37 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][37])];
                            $tmp_38 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][38])];
                            $tmp_39 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $lookupID_field_position[$result_set_key][39])];

                            $this->keyByID_ARRAY[$tmp_00][$tmp_01][$tmp_02][$tmp_03][$tmp_04][$tmp_05][$tmp_06][$tmp_07][$tmp_08][$tmp_09][$tmp_10][$tmp_11][$tmp_12][$tmp_13][$tmp_14][$tmp_15][$tmp_16][$tmp_17][$tmp_18][$tmp_19][$tmp_20][$tmp_21][$tmp_22][$tmp_23][$tmp_24][$tmp_25][$tmp_26][$tmp_27][$tmp_28][$tmp_29][$tmp_30][$tmp_31][$tmp_32][$tmp_33][$tmp_34][$tmp_35][$tmp_36][$tmp_37][$tmp_38][$tmp_39][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                        break;
                        default:

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('retrieve_data_by_id is limited to 40 keys. ' . $indexCount.' keys have been provided.');

                        break;

                    }

                }

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function resultSetMerge($oQuery, $target_result_set_key, $merge_fields_piped, $merge_fields_distinct_val, $sequence_fields_piped, $sequence_fields_datatype_piped){

        try{

            //
            // HERE WITHIN THE FAKEY oQUERY...MERGE oQUERY PER PROVIDED SPECIFICATIONS
            $oQuery_result_set_cnt = $oQuery->return_record_count();
            $oQuery_fieldCnt = $oQuery->oSqlSelect_tracker->return_fieldCount();
            $oQuery_fakey_result_set_key = $this->return_attribute('result_set_key');
            $oQuery_result_set_key = $oQuery->return_attribute('result_set_key');

            if($target_result_set_key != $oQuery_fakey_result_set_key){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('The requested result set key, "' . $target_result_set_key.'", for the dataset which is currently being merged[' . $oQuery_result_set_key.'], does not match what has already been established, "' . $oQuery_fakey_result_set_key.'".');

            }

            //
            // REMOVE FAKEY PLACEHOLDER FIELD
            $tmp_fakey_field0 = $this->oSqlSelect_tracker->return_fieldNameByPosition(0, false);
            if($tmp_fakey_field0 == 'CRNRSTN_200TMP'){
                //error_log('1262 query - reset_fakeyFields...');
                $this->oSqlSelect_tracker->reset_fakeyFields();

                //loadQueryProfile($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key)

            }

            //
            // SYNC FAKEY WITH oQuery fields
            for($i=0; $i < $oQuery_fieldCnt; $i++){

                $tmp_oQuery_fieldname = $oQuery->oSqlSelect_tracker->return_fieldNameByPosition($i, false);

                $tmp_pos = $this->oSqlSelect_tracker->return_fieldPositionByName($oQuery_fakey_result_set_key, $tmp_oQuery_fieldname, false);
                //error_log('1274 query - [' . $oQuery_fakey_result_set_key.']field[' . $tmp_oQuery_fieldname.'] exists=[' . $tmp_pos.']');
                if($tmp_pos < 0){

                    $this->oSqlSelect_tracker->addFieldName($tmp_oQuery_fieldname);

                }

            }

            //
            // FOR EACH ROW IN $oQuery RESULT SET
            for($oQueryRowPos = 0; $oQueryRowPos < $oQuery_result_set_cnt; $oQueryRowPos++){

                $tmp_merge_row_authorization = true;

                if($this->return_record_count() > 0){

                    //
                    // IS THE MERGE FIELD VALUE CURRENTLY LOADED INTO FAKEY...AND FORCE DISTINCT *NOT* DESIRED OR...VICE-VERSA?
                    $mergefield_pipe_pos = strpos($merge_fields_piped, '|');

                    if ($mergefield_pipe_pos !== false) {

                        $oQuery_merge_fields_ARRAY = explode('|', $merge_fields_piped);
                        $piped_merge_fields_cnt = sizeof($oQuery_merge_fields_ARRAY);

                        for($ii = 0; $ii < $piped_merge_fields_cnt; $ii++) {

                            $oQuery_merge_fieldname = $oQuery_merge_fields_ARRAY[$ii];
                            $value = $oQuery->return_db_value($oQuery_result_set_key, $oQuery_merge_fieldname, $oQueryRowPos);

                            if($merge_fields_distinct_val){

                                //error_log('1307 query - PIPED [' . $oQuery_fakey_result_set_key.'][' . $oQuery_merge_fieldname.'][' . $value.']');
                                if($this->ping_value_existence($oQuery_fakey_result_set_key, $oQuery_merge_fieldname, $value)){

                                    //error_log('1318 fakey query - [PIPED] merge oQuery[FORCE DISTINCT=>' . $oQuery_result_set_key.'] merge field[' . $oQuery_merge_fieldname.'] value=' . $value);

                                    //
                                    // DISQUALIFY ROW FOR MERGE INTO FAKEY
                                    $tmp_merge_row_authorization = false;

                                }

                            }

                        }

                    }else{

                        $oQuery_merge_fieldname = $merge_fields_piped;
                        //$oQuery_result_set_key = $oQuery->return_attribute('result_set_key');
                        //$oQuery_fakey_result_set_key = $this->return_attribute('result_set_key');
                        $value = $oQuery->return_db_value($oQuery_result_set_key, $oQuery_merge_fieldname, $oQueryRowPos);

                        if($merge_fields_distinct_val){

                            //error_log('1331 query - [' . $oQuery_fakey_result_set_key.'][' . $oQuery_merge_fieldname.'][' . $value.']');

                            if($this->ping_value_existence($oQuery_fakey_result_set_key, $oQuery_merge_fieldname, $value)){

                                //error_log('1335 fakey query - [NO PIPES] DISQUALIFY ROW FOR MERGE INTO FAKEY oQuery[FORCE DISTINCT=>' . $oQuery_fakey_result_set_key.'] merge field[' . $oQuery_merge_fieldname.'] value=' . $value);

                                //
                                // DISQUALIFY ROW FOR MERGE INTO FAKEY
                                $tmp_merge_row_authorization = false;
                            }

                        }

                    }

                }

                //
                // ADD RESULT ROW TO FAKEY...FOR EACH FIELD IN THIS ROW
                if($tmp_merge_row_authorization){

                    $current_row_count = $this->return_record_count();

                    for($fieldPos=0; $fieldPos < $oQuery_fieldCnt; $fieldPos++){

                        $value = $oQuery->return_db_value($oQuery_result_set_key, $fieldPos, $oQueryRowPos);
                        $this->addDBResultData($current_row_count, $fieldPos, $value);

                    }

                    //
                    // TRACK RECORD COUNT MODIFICATION
                    $this->updateRecordCount();

                }

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function keyDataByID($result_set_key, $piped_primary_id_fields){

        try{

            if(!isset($piped_primary_id_fields)){

                $tmp_lookup_field_cnt = sizeof($this->dataByID_field_position[$this->loadedLookupSerialIndex[$result_set_key]][$result_set_key]);

                if($tmp_lookup_field_cnt<1){

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('No lookup ID fields have been configured through oCRNRSTN_USR->add_lookup_field_data() or passed into oCRNRSTN_USR->retrieve_data_by_id() as a PIPE delimited STRING.');

                }else{

                    for($i=0;$i<$tmp_lookup_field_cnt;$i++){

                        $pos = strpos($this->dataByID_field_position[$this->loadedLookupSerialIndex[$result_set_key]][$result_set_key][$i], $piped_primary_id_fields);

                        if($pos === false){

                            $piped_primary_id_fields .= $this->dataByID_field_position[$this->loadedLookupSerialIndex[$result_set_key]][$result_set_key][$i].'|';

                        }

                    }

                    $piped_primary_id_fields = rtrim($piped_primary_id_fields, '|');
                    //error_log('291 query - ' . $piped_primary_id_fields);
                    if(!in_array($piped_primary_id_fields, $this->keyByIdLog[$result_set_key])){

                        $this->keyByIdLog[$result_set_key][0] = $piped_primary_id_fields;

                        $pos = strpos($piped_primary_id_fields, '|');

                        if ($pos !== false) {

                            //
                            // PROCESS PIPE DELIM FOR MULTIPLE KEY BY ID FIELDS
                            $tmp_id_field_position = $this->dataByID_field_position[$this->loadedLookupSerialIndex[$result_set_key]];

                            $this->buildOutLookupPointerRef($result_set_key, $tmp_id_field_position, $tmp_lookup_field_cnt);

                            return NULL;

                        }else{

                            //
                            // ONE FIELD FOR KEY BY ID
                            $tmp_id_field_position[$result_set_key][0] = $piped_primary_id_fields;

                            //
                            // BUILD DATA STRUCT TRAVERSING EACH FIELD IN THE ROW
                            foreach($this->resultDataByRow as $rowcount=>$chunkArray0){
                                foreach($chunkArray0 as $result_field_position=>$value){

                                    $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $tmp_id_field_position[$result_set_key][0])];

                                    //error_log('329 query - load keyByID_ARRAY[' . $tmp_00.']'.'[' . $this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position).']');

                                    $this->keyByID_ARRAY[$tmp_00][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                                }

                            }

                            return NULL;

                        }

                    }else{

                        //error_log('299 query - SKIP WORK!');
                    }

                }

            }else{

                //
                // LOOK FOR PIPED
                if(!in_array($piped_primary_id_fields, $this->keyByIdLog[$result_set_key])){

                    $this->keyByIdLog[$result_set_key][0] = $piped_primary_id_fields;

                    $tmp_id_field_position = array();
                    $pos = strpos($piped_primary_id_fields, '|');

                    if ($pos !== false) {

                        //
                        // PROCESS PIPE DELIM FOR MULTIPLE KEY BY ID FIELDS
                        $tmp_pipe_id_ARRAY = explode('|', $piped_primary_id_fields);
                        $tmp_lookup_field_cnt = sizeof($tmp_pipe_id_ARRAY);
                        for($i = 0; $i < $tmp_lookup_field_cnt; $i++) {

                            $tmp_id_field_position[$result_set_key][] = $tmp_pipe_id_ARRAY[$i];

                        }

                        $this->buildOutLookupPointerRef($result_set_key, $tmp_id_field_position, $tmp_lookup_field_cnt);

                        return NULL;

                    }else{

                        //
                        // ONE FIELD FOR KEY BY ID
                        $tmp_id_field_position[$result_set_key][0] = $piped_primary_id_fields;

                        //
                        // BUILD DATA STRUCT TRAVERSING EACH FIELD IN THE ROW
                        foreach($this->resultDataByRow as $rowcount=>$chunkArray0){
                            foreach($chunkArray0 as $result_field_position=>$value){

                                $tmp_00 = $this->resultDataByRow[$rowcount][$this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $tmp_id_field_position[$result_set_key][0])];

                                //error_log('276 query - load keyByID_ARRAY[' . $tmp_00.']'.'[' . $this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position).']');

                                $this->keyByID_ARRAY[$tmp_00][$this->oSqlSelect_tracker->return_fieldNameByPosition($result_field_position)] = $value;

                            }

                        }

                        return NULL;

                    }

                }else{

                    // error_log('290 query - keyByID optimization check...GOOD!');
                }

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    private function returnDataByID($result_set_key, $lookup_fieldname, $lookup_id_data_ARRAY, $tmp_lookup_id_data_cnt){

        try{

            switch($tmp_lookup_id_data_cnt){
                case 2:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field [' . $lookup_fieldname.'] within the specified query result set key [' . $result_set_key.'].');

                    }

                break;
                case 3:

                if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_fieldname])){

                    return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_fieldname];

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unable to retrieve/locate the field [' . $lookup_fieldname.'] within the specified query result set key [' . $result_set_key.'].');

                }

                break;
                case 4:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field [' . $lookup_fieldname.'] within the specified query result set key [' . $result_set_key.'].');

                    }

                break;
                case 5:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field [' . $lookup_fieldname.'] within the specified query result set key [' . $result_set_key.'].');

                    }

                break;
                case 6:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field [' . $lookup_fieldname.'] within the specified query result set key [' . $result_set_key.'].');

                    }

                break;
                case 7:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field [' . $lookup_fieldname.'] within the specified query result set key [' . $result_set_key.'].');

                    }

                break;
                case 8:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field [' . $lookup_fieldname.'] within the specified query result set key [' . $result_set_key.'].');

                    }

                break;
                case 9:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field [' . $lookup_fieldname.'] within the specified query result set key [' . $result_set_key.'].');

                    }

                break;
                case 10:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field [' . $lookup_fieldname.'] within the specified query result set key [' . $result_set_key.'].');

                    }

                break;
                case 11:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field [' . $lookup_fieldname.'] within the specified query result set key [' . $result_set_key.'].');

                    }

                break;
                case 12:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field [' . $lookup_fieldname.'] within the specified query result set key [' . $result_set_key.'].');

                    }

                break;
                case 13:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field [' . $lookup_fieldname.'] within the specified query result set key [' . $result_set_key.'].');

                    }

                break;
                case 14:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field [' . $lookup_fieldname.'] within the specified query result set key [' . $result_set_key.'].');

                    }

                break;
                case 15:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field [' . $lookup_fieldname.'] within the specified query result set key [' . $result_set_key.'].');

                    }

                break;
                case 16:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field [' . $lookup_fieldname.'] within the specified query result set key [' . $result_set_key.'].');

                    }

                break;
                case 17:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field [' . $lookup_fieldname.'] within the specified query result set key [' . $result_set_key.'].');

                    }

                break;
                case 18:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field [' . $lookup_fieldname.'] within the specified query result set key [' . $result_set_key.'].');

                    }

                break;
                case 19:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field [' . $lookup_fieldname.'] within the specified query result set key [' . $result_set_key.'].');

                    }

                break;
                case 20:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field [' . $lookup_fieldname.'] within the specified query result set key [' . $result_set_key.'].');

                    }

                break;
                case 21:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field [' . $lookup_fieldname.'] within the specified query result set key [' . $result_set_key.'].');

                    }

                break;
                case 22:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field [' . $lookup_fieldname.'] within the specified query result set key [' . $result_set_key.'].');

                    }

                break;
                case 23:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field [' . $lookup_fieldname.'] within the specified query result set key [' . $result_set_key.'].');

                    }

                break;
                case 24:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field [' . $lookup_fieldname.'] within the specified query result set key [' . $result_set_key.'].');

                    }

                break;
                case 25:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field [' . $lookup_fieldname.'] within the specified query result set key [' . $result_set_key.'].');

                    }

                break;
                case 26:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_id_data_ARRAY[25]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_id_data_ARRAY[25]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field [' . $lookup_fieldname . '] within the specified query result set key [' . $result_set_key . '].');

                    }

                break;
                case 27:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_id_data_ARRAY[25]][$lookup_id_data_ARRAY[26]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_id_data_ARRAY[25]][$lookup_id_data_ARRAY[26]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field ['.$lookup_fieldname.'] within the specified query result set key ['.$result_set_key.'].');

                    }

                break;
                case 28:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_id_data_ARRAY[25]][$lookup_id_data_ARRAY[26]][$lookup_id_data_ARRAY[27]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_id_data_ARRAY[25]][$lookup_id_data_ARRAY[26]][$lookup_id_data_ARRAY[27]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field ['.$lookup_fieldname.'] within the specified query result set key ['.$result_set_key.'].');

                    }

                break;
                case 29:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_id_data_ARRAY[25]][$lookup_id_data_ARRAY[26]][$lookup_id_data_ARRAY[27]][$lookup_id_data_ARRAY[28]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_id_data_ARRAY[25]][$lookup_id_data_ARRAY[26]][$lookup_id_data_ARRAY[27]][$lookup_id_data_ARRAY[28]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field ['.$lookup_fieldname.'] within the specified query result set key ['.$result_set_key.'].');

                    }

                break;
                case 30:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_id_data_ARRAY[25]][$lookup_id_data_ARRAY[26]][$lookup_id_data_ARRAY[27]][$lookup_id_data_ARRAY[28]][$lookup_id_data_ARRAY[29]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_id_data_ARRAY[25]][$lookup_id_data_ARRAY[26]][$lookup_id_data_ARRAY[27]][$lookup_id_data_ARRAY[28]][$lookup_id_data_ARRAY[29]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field ['.$lookup_fieldname.'] within the specified query result set key ['.$result_set_key.'].');

                    }

                break;
                case 31:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_id_data_ARRAY[25]][$lookup_id_data_ARRAY[26]][$lookup_id_data_ARRAY[27]][$lookup_id_data_ARRAY[28]][$lookup_id_data_ARRAY[29]][$lookup_id_data_ARRAY[30]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_id_data_ARRAY[25]][$lookup_id_data_ARRAY[26]][$lookup_id_data_ARRAY[27]][$lookup_id_data_ARRAY[28]][$lookup_id_data_ARRAY[29]][$lookup_id_data_ARRAY[30]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field ['.$lookup_fieldname.'] within the specified query result set key ['.$result_set_key.'].');

                    }

                break;
                case 32:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_id_data_ARRAY[25]][$lookup_id_data_ARRAY[26]][$lookup_id_data_ARRAY[27]][$lookup_id_data_ARRAY[28]][$lookup_id_data_ARRAY[29]][$lookup_id_data_ARRAY[30]][$lookup_id_data_ARRAY[31]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_id_data_ARRAY[25]][$lookup_id_data_ARRAY[26]][$lookup_id_data_ARRAY[27]][$lookup_id_data_ARRAY[28]][$lookup_id_data_ARRAY[29]][$lookup_id_data_ARRAY[30]][$lookup_id_data_ARRAY[31]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field ['.$lookup_fieldname.'] within the specified query result set key ['.$result_set_key.'].');

                    }

                break;
                case 33:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_id_data_ARRAY[25]][$lookup_id_data_ARRAY[26]][$lookup_id_data_ARRAY[27]][$lookup_id_data_ARRAY[28]][$lookup_id_data_ARRAY[29]][$lookup_id_data_ARRAY[30]][$lookup_id_data_ARRAY[31]][$lookup_id_data_ARRAY[32]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_id_data_ARRAY[25]][$lookup_id_data_ARRAY[26]][$lookup_id_data_ARRAY[27]][$lookup_id_data_ARRAY[28]][$lookup_id_data_ARRAY[29]][$lookup_id_data_ARRAY[30]][$lookup_id_data_ARRAY[31]][$lookup_id_data_ARRAY[32]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field ['.$lookup_fieldname.'] within the specified query result set key ['.$result_set_key.'].');

                    }

                break;
                case 34:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_id_data_ARRAY[25]][$lookup_id_data_ARRAY[26]][$lookup_id_data_ARRAY[27]][$lookup_id_data_ARRAY[28]][$lookup_id_data_ARRAY[29]][$lookup_id_data_ARRAY[30]][$lookup_id_data_ARRAY[31]][$lookup_id_data_ARRAY[32]][$lookup_id_data_ARRAY[33]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_id_data_ARRAY[25]][$lookup_id_data_ARRAY[26]][$lookup_id_data_ARRAY[27]][$lookup_id_data_ARRAY[28]][$lookup_id_data_ARRAY[29]][$lookup_id_data_ARRAY[30]][$lookup_id_data_ARRAY[31]][$lookup_id_data_ARRAY[32]][$lookup_id_data_ARRAY[33]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field ['.$lookup_fieldname.'] within the specified query result set key ['.$result_set_key.'].');

                    }

                break;
                case 35:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_id_data_ARRAY[25]][$lookup_id_data_ARRAY[26]][$lookup_id_data_ARRAY[27]][$lookup_id_data_ARRAY[28]][$lookup_id_data_ARRAY[29]][$lookup_id_data_ARRAY[30]][$lookup_id_data_ARRAY[31]][$lookup_id_data_ARRAY[32]][$lookup_id_data_ARRAY[33]][$lookup_id_data_ARRAY[34]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_id_data_ARRAY[25]][$lookup_id_data_ARRAY[26]][$lookup_id_data_ARRAY[27]][$lookup_id_data_ARRAY[28]][$lookup_id_data_ARRAY[29]][$lookup_id_data_ARRAY[30]][$lookup_id_data_ARRAY[31]][$lookup_id_data_ARRAY[32]][$lookup_id_data_ARRAY[33]][$lookup_id_data_ARRAY[34]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field ['.$lookup_fieldname.'] within the specified query result set key ['.$result_set_key.'].');

                    }

                break;
                case 36:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_id_data_ARRAY[25]][$lookup_id_data_ARRAY[26]][$lookup_id_data_ARRAY[27]][$lookup_id_data_ARRAY[28]][$lookup_id_data_ARRAY[29]][$lookup_id_data_ARRAY[30]][$lookup_id_data_ARRAY[31]][$lookup_id_data_ARRAY[32]][$lookup_id_data_ARRAY[33]][$lookup_id_data_ARRAY[34]][$lookup_id_data_ARRAY[35]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_id_data_ARRAY[25]][$lookup_id_data_ARRAY[26]][$lookup_id_data_ARRAY[27]][$lookup_id_data_ARRAY[28]][$lookup_id_data_ARRAY[29]][$lookup_id_data_ARRAY[30]][$lookup_id_data_ARRAY[31]][$lookup_id_data_ARRAY[32]][$lookup_id_data_ARRAY[33]][$lookup_id_data_ARRAY[34]][$lookup_id_data_ARRAY[35]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field ['.$lookup_fieldname.'] within the specified query result set key ['.$result_set_key.'].');

                    }

                break;
                case 37:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_id_data_ARRAY[25]][$lookup_id_data_ARRAY[26]][$lookup_id_data_ARRAY[27]][$lookup_id_data_ARRAY[28]][$lookup_id_data_ARRAY[29]][$lookup_id_data_ARRAY[30]][$lookup_id_data_ARRAY[31]][$lookup_id_data_ARRAY[32]][$lookup_id_data_ARRAY[33]][$lookup_id_data_ARRAY[34]][$lookup_id_data_ARRAY[35]][$lookup_id_data_ARRAY[36]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_id_data_ARRAY[25]][$lookup_id_data_ARRAY[26]][$lookup_id_data_ARRAY[27]][$lookup_id_data_ARRAY[28]][$lookup_id_data_ARRAY[29]][$lookup_id_data_ARRAY[30]][$lookup_id_data_ARRAY[31]][$lookup_id_data_ARRAY[32]][$lookup_id_data_ARRAY[33]][$lookup_id_data_ARRAY[34]][$lookup_id_data_ARRAY[35]][$lookup_id_data_ARRAY[36]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field ['.$lookup_fieldname.'] within the specified query result set key ['.$result_set_key.'].');

                    }

                break;
                case 38:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_id_data_ARRAY[25]][$lookup_id_data_ARRAY[26]][$lookup_id_data_ARRAY[27]][$lookup_id_data_ARRAY[28]][$lookup_id_data_ARRAY[29]][$lookup_id_data_ARRAY[30]][$lookup_id_data_ARRAY[31]][$lookup_id_data_ARRAY[32]][$lookup_id_data_ARRAY[33]][$lookup_id_data_ARRAY[34]][$lookup_id_data_ARRAY[35]][$lookup_id_data_ARRAY[36]][$lookup_id_data_ARRAY[37]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_id_data_ARRAY[25]][$lookup_id_data_ARRAY[26]][$lookup_id_data_ARRAY[27]][$lookup_id_data_ARRAY[28]][$lookup_id_data_ARRAY[29]][$lookup_id_data_ARRAY[30]][$lookup_id_data_ARRAY[31]][$lookup_id_data_ARRAY[32]][$lookup_id_data_ARRAY[33]][$lookup_id_data_ARRAY[34]][$lookup_id_data_ARRAY[35]][$lookup_id_data_ARRAY[36]][$lookup_id_data_ARRAY[37]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field ['.$lookup_fieldname.'] within the specified query result set key ['.$result_set_key.'].');

                    }

                break;
                case 39:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_id_data_ARRAY[25]][$lookup_id_data_ARRAY[26]][$lookup_id_data_ARRAY[27]][$lookup_id_data_ARRAY[28]][$lookup_id_data_ARRAY[29]][$lookup_id_data_ARRAY[30]][$lookup_id_data_ARRAY[31]][$lookup_id_data_ARRAY[32]][$lookup_id_data_ARRAY[33]][$lookup_id_data_ARRAY[34]][$lookup_id_data_ARRAY[35]][$lookup_id_data_ARRAY[36]][$lookup_id_data_ARRAY[37]][$lookup_id_data_ARRAY[38]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_id_data_ARRAY[25]][$lookup_id_data_ARRAY[26]][$lookup_id_data_ARRAY[27]][$lookup_id_data_ARRAY[28]][$lookup_id_data_ARRAY[29]][$lookup_id_data_ARRAY[30]][$lookup_id_data_ARRAY[31]][$lookup_id_data_ARRAY[32]][$lookup_id_data_ARRAY[33]][$lookup_id_data_ARRAY[34]][$lookup_id_data_ARRAY[35]][$lookup_id_data_ARRAY[36]][$lookup_id_data_ARRAY[37]][$lookup_id_data_ARRAY[38]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field ['.$lookup_fieldname.'] within the specified query result set key ['.$result_set_key.'].');

                    }

                break;
                case 40:

                    if(isset($this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_id_data_ARRAY[25]][$lookup_id_data_ARRAY[26]][$lookup_id_data_ARRAY[27]][$lookup_id_data_ARRAY[28]][$lookup_id_data_ARRAY[29]][$lookup_id_data_ARRAY[30]][$lookup_id_data_ARRAY[31]][$lookup_id_data_ARRAY[32]][$lookup_id_data_ARRAY[33]][$lookup_id_data_ARRAY[34]][$lookup_id_data_ARRAY[35]][$lookup_id_data_ARRAY[36]][$lookup_id_data_ARRAY[37]][$lookup_id_data_ARRAY[38]][$lookup_id_data_ARRAY[39]][$lookup_fieldname])){

                        return $this->keyByID_ARRAY[$lookup_id_data_ARRAY[0]][$lookup_id_data_ARRAY[1]][$lookup_id_data_ARRAY[2]][$lookup_id_data_ARRAY[3]][$lookup_id_data_ARRAY[4]][$lookup_id_data_ARRAY[5]][$lookup_id_data_ARRAY[6]][$lookup_id_data_ARRAY[7]][$lookup_id_data_ARRAY[8]][$lookup_id_data_ARRAY[9]][$lookup_id_data_ARRAY[10]][$lookup_id_data_ARRAY[11]][$lookup_id_data_ARRAY[12]][$lookup_id_data_ARRAY[13]][$lookup_id_data_ARRAY[14]][$lookup_id_data_ARRAY[15]][$lookup_id_data_ARRAY[16]][$lookup_id_data_ARRAY[17]][$lookup_id_data_ARRAY[18]][$lookup_id_data_ARRAY[19]][$lookup_id_data_ARRAY[20]][$lookup_id_data_ARRAY[21]][$lookup_id_data_ARRAY[22]][$lookup_id_data_ARRAY[23]][$lookup_id_data_ARRAY[24]][$lookup_id_data_ARRAY[25]][$lookup_id_data_ARRAY[26]][$lookup_id_data_ARRAY[27]][$lookup_id_data_ARRAY[28]][$lookup_id_data_ARRAY[29]][$lookup_id_data_ARRAY[30]][$lookup_id_data_ARRAY[31]][$lookup_id_data_ARRAY[32]][$lookup_id_data_ARRAY[33]][$lookup_id_data_ARRAY[34]][$lookup_id_data_ARRAY[35]][$lookup_id_data_ARRAY[36]][$lookup_id_data_ARRAY[37]][$lookup_id_data_ARRAY[38]][$lookup_id_data_ARRAY[39]][$lookup_fieldname];

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to retrieve/locate the field ['.$lookup_fieldname.'] within the specified query result set key ['.$result_set_key.'].');

                    }

                break;
                default:
                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('returnDataByID() is limited to 10 keys. '.$tmp_lookup_id_data_cnt.' keys have been provided. Unable to retrieve/locate the field ['.$lookup_fieldname.'] within the specified query result set key ['.$result_set_key.'].');

                break;

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }
    }

    public function retrieve_data_by_id($result_set_key, $piped_lookup_fieldname, $piped_lookup_id_data){

        try {

            if(!isset($piped_lookup_id_data)){
                $tmp_lookup_id_data_cnt = sizeof($this->dataByID_lookup_value[$this->loadedLookupSerialIndex[$result_set_key]][$result_set_key]);

                if($tmp_lookup_id_data_cnt<1){

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('No lookup id data has been configured through oCRNRSTN_USR->add_lookup_field_data() or passed into oCRNRSTN_USR->retrieve_data_by_id() as a PIPE delimited STRING.');

                }else{

                    $tmp_lookup_id_data_ARRAY = $this->dataByID_lookup_value[$this->loadedLookupSerialIndex[$result_set_key]][$result_set_key];
                    $tmp_lookup_cnt = sizeof($tmp_lookup_id_data_ARRAY);
                    $piped_lookup_id_data = $this->dataByID_lookup_value[$this->loadedLookupSerialIndex[$result_set_key]][$result_set_key][0];

                    if($tmp_lookup_cnt==1){

                        if(isset($this->keyByID_ARRAY[$piped_lookup_id_data][$piped_lookup_fieldname])){

                            return $this->keyByID_ARRAY[$piped_lookup_id_data][$piped_lookup_fieldname];

                        }else{

                            $tmp_err_detail = 'provided lookup data';

                            if(is_bool($piped_lookup_id_data)){

                                if($piped_lookup_id_data){

                                    $tmp_err_detail = 'lookup data of BOOLEAN(TRUE) datatype';

                                }else{

                                    $tmp_err_detail = 'lookup data of BOOLEAN(FALSE) datatype';

                                }

                            }

                            if(is_string($piped_lookup_id_data)){

                                $tmp_err_detail = 'lookup data of STRING(LEN='.strlen($piped_lookup_id_data).') datatype';

                            }

                            if(is_int($piped_lookup_id_data) || is_integer($piped_lookup_id_data)){

                                $tmp_err_detail = 'lookup data of INTEGER datatype';

                            }

                            if(is_double($piped_lookup_id_data) || is_float($piped_lookup_id_data)){

                                $tmp_err_detail = 'lookup data of DOUBLE/FLOAT datatype';

                            }

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Keying off of custom provided '.$tmp_err_detail.' within the field ['.$this->keyByIdLog[$result_set_key][0].'], CRNRSTN :: is unable to retrieve data from the field "'.$piped_lookup_fieldname.'" within the specified query result set key ['.$result_set_key.'].');

                        }

                    }else{

                        //$lookup_id_data_ARRAY
                        // MULTIPLE LOOKUP ID
                        //error_log('616 going in - ['.$result_set_key.']['.$piped_lookup_fieldname.']['.sizeof($tmp_lookup_id_data_ARRAY).']['.$tmp_lookup_cnt.']');

                        return $this->returnDataByID($result_set_key, $piped_lookup_fieldname, $tmp_lookup_id_data_ARRAY, $tmp_lookup_id_data_cnt);

                    }

                }

            }else{

                $pos = strpos($piped_lookup_id_data, '|');
                if ($pos !== false) {

                    //
                    // PROCESS PIPE DELIM FOR MULTI KEY BY ID
                    //error_log('631 query - pipe(s)?->'.$piped_lookup_id_data);
                    $tmp_lookup_id_data_ARRAY = explode('|', $piped_lookup_id_data);
                    $tmp_lookup_id_data_cnt = sizeof($tmp_lookup_id_data_ARRAY);

                    //
                    // MULTIPLE LOOKUP ID
                    //error_log('637 query - '.$result_set_key.'['.$piped_lookup_fieldname.']['.sizeof($tmp_lookup_id_data_ARRAY).']');
                    //die();

                    return $this->returnDataByID($result_set_key, $piped_lookup_fieldname, $tmp_lookup_id_data_ARRAY, $tmp_lookup_id_data_cnt);

                }else{

                    if(isset($this->keyByID_ARRAY[$piped_lookup_id_data][$piped_lookup_fieldname])){
                        //error_log('644 query - ['.$piped_lookup_id_data.']['.$piped_lookup_fieldname.']');
                        return $this->keyByID_ARRAY[$piped_lookup_id_data][$piped_lookup_fieldname];

                    }else{

                        $tmp_err_detail = 'provided lookup data';

                        if(is_bool($piped_lookup_id_data)){

                            if($piped_lookup_id_data){

                                $tmp_err_detail = 'lookup data of BOOLEAN(TRUE) datatype';

                            }else{

                                $tmp_err_detail = 'lookup data of BOOLEAN(FALSE) datatype';

                            }

                        }

                        if(is_string($piped_lookup_id_data)){

                            $tmp_err_detail = 'lookup data of STRING(LEN='.strlen($piped_lookup_id_data).') datatype';

                        }

                        if(is_int($piped_lookup_id_data) || is_integer($piped_lookup_id_data)){

                            $tmp_err_detail = 'lookup data of INTEGER datatype';

                        }

                        if(is_double($piped_lookup_id_data) || is_float($piped_lookup_id_data)){

                            $tmp_err_detail = 'lookup data of DOUBLE/FLOAT datatype';

                        }

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Keying off of custom provided '.$tmp_err_detail.' within the field ['.$this->keyByIdLog[$result_set_key][0].'], CRNRSTN :: is unable to retrieve data from the field "'.$piped_lookup_fieldname.'" within the specified query result set key ['.$result_set_key.'].');

                    }

                }

            }

        }catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function return_db_value($result_set_key, $fieldName_or_fieldPosition, $pos){

        try{

            if(is_int($fieldName_or_fieldPosition) || is_integer($fieldName_or_fieldPosition)){

                $field_position = $fieldName_or_fieldPosition;

            }else{

                $field_position = $this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $fieldName_or_fieldPosition);

            }

            //error_log(__LINE__ . ' db query $result_set_key=' . $result_set_key . ' $pos=[' . $pos . ']  FIELD POSITION=' . $field_position.' | DATA=' . print_r($this->resultDataByRow, true));

            if(isset($this->resultDataByRow[$pos][$field_position])){

                return $this->resultDataByRow[$pos][$field_position];

            }else{

                $total_count = $this->return_record_count();
                $total_count--;

                if($total_count > 0){

                    return NULL;

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    //throw new Exception();
                    //$this->oCRNRSTN_USR->error_log('Unable to find any result in the requested queue position of ' . $pos . ', where the range of possibility is between 0 and ' . $total_count . ' via the targeted result set key of "' . $result_set_key . '".', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);

                    return NULL;

                }

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }
    }

    public function ping_value_existence($result_set_key, $fieldname, $value){

        try{

            $field_position = $this->oSqlSelect_tracker->return_fieldPositionByName($result_set_key, $fieldname);

            if(!isset($this->resultDataByVal[$field_position])){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('The result set, "'.$result_set_key.'", is empty...as it has not yet been populated with any result from the database (has oCRNRSTN_USR->process_query() been run?), but the "'.$fieldname.'" field is being checked for a value, therein.');

            }else{

                return array_key_exists($value, $this->resultDataByVal[$field_position]);

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function addDBResultData($rowcount, $field_position, $value){

        //
        // FOR LINEAR PROCESSING
        $this->resultDataByRow[$rowcount][$field_position] = $value;

        //
        // FOR VALUE LOOKUP
        $this->resultDataByVal[$field_position][$value] = $rowcount;

    }

    public function updateRecordCount(){

        $this->result_record_count = sizeof($this->resultDataByRow);
        //error_log('139 query - Returned Record Count = '.$this->result_record_count);

    }

    public function return_record_count(){

        return $this->result_record_count;

    }

    public function initialize(){

        //error_log('116 query - Break down ->'.$this->raw_query);
        $pos_select = stripos($this->raw_query, 'SELECT ');

        if($pos_select !== false){

            //
            // BREAK OUT FROM EXPRESSION SO THAT SQL CAN BE CHECKSUMMED
            $tmp_field_chop_array = preg_split('/ FROM /i', $this->raw_query);  // CASE INSENSITIVE

            $this->select_query = $this->oCRNRSTN_USR->string_sanitize($tmp_field_chop_array[0],'select_statement');

            //
            // EXPLODE BY COMMA TO BREAK OUT FIELDS
            $tmp_field_chop_array = explode(',', $this->select_query);

            //
            // PROCESS EACH FIELD FOR:
            # - EXPLODE BY . AND KEEP [1] FOR FIELD NAME  # clients.CLIENT_ID
            $tmp_loop_size = sizeof($tmp_field_chop_array);
            for($i=0; $i<$tmp_loop_size; $i++){

                //
                // DO WE HAVE AN "AS" FIELD RENAME. IF SO, HANDLE IT.
                $pos = stripos($tmp_field_chop_array[$i], ' AS ');
                if ($pos !== false) {

                    //
                    // SPLIT FIELD BY AS AND TAKE SECOND INDEX FOR FIELD NAME
                    $tmp_single_field_array = preg_split('/ AS /i', $tmp_field_chop_array[$i]);  // CASE INSENSITIVE

                    //
                    // TRIM SPACES
                    $tmp_single_field_array[1] = trim($tmp_single_field_array[1]);

                    $tmp_single_field_array[1] = $this->oCRNRSTN_USR->string_sanitize($tmp_single_field_array[1],'select_field_name');

                    $this->oSqlSelect_tracker->addFieldName($tmp_single_field_array[1]);

                }else{

                    $pos_dot = stripos($tmp_field_chop_array[$i], '.');
                    $pos_comma = stripos($tmp_field_chop_array[$i], ',');

                    if ($pos_dot !== false) {

                        $tmp_single_field_array = explode('.', $tmp_field_chop_array[$i]);

                    }else{

                        if ($pos_comma !== false) {

                            $tmp_single_field_array = explode(',', $tmp_field_chop_array[$i]);

                        }else{

                            $this->oCRNRSTN_USR->error_log('Unable to map query fields. Prefixing table name to the field names may resolve. Error occurred at ['.$tmp_field_chop_array[$i].']', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

                        }
                    }

                    //
                    // FOR EACH FIELD
                    # array[serial][select_CNT][field_position] = fieldname;
                    $tmp_single_field_array[1] = $this->oCRNRSTN_USR->string_sanitize($tmp_single_field_array[1],'select_field_name');

                    $this->oSqlSelect_tracker->addFieldName($tmp_single_field_array[1]);

                }
            }
        }
    }

    public function load_mysqli_connection($oCRNRSTN_MySQLi){

        $this->connection_serial = $oCRNRSTN_MySQLi->returnConnSerial();
        $this->mysqli = $oCRNRSTN_MySQLi->return_conn_object();

    }

    public function load_query_key($result_handle, $batch_key, $result_set_key){

        $this->result_handle = $result_handle;
        $this->batch_key = $batch_key;
        $this->result_set_key = $result_set_key;
        $this->keyByIdLog[$result_set_key][] = NULL;

    }

    public function load_query($query){

        //error_log(__LINE__ . ' db query $query->raw_query='.$query);
        $this->raw_query = $query;
        $this->query_MD5 = md5($query);
        //$this->query_SHA1 = sha1($query);
        $this->query_life_stage = 'READY';

    }

    public function load_wire_serial($serial){

        $this->query_wiring_serial = $serial;

    }

    public function return_attribute($key){

        try{

            switch($key){
                case 'query_wiring_serial':
                    return $this->query_wiring_serial;
                case 'connection_serial':
                    return $this->connection_serial;
                case 'select_query':
                    return $this->select_query;
                case 'mysqli':
                    return $this->mysqli;
                case 'result_handle':
                    return $this->result_handle;
                case 'batch_key':
                    return $this->batch_key;
                case 'result_set_key':
                    return $this->result_set_key;
                case 'raw_query':
                    return $this->raw_query;
                case 'date_created':
                    return $this->date_created;
                case 'date_modified':
                    return $this->date_modified;
                case 'creator_ip':
                    return $this->creator_ip;
                case 'modifier_ip':
                    return $this->modifier_ip;
                case 'query_MD5':
                    return $this->query_MD5;
                case 'query_SHA1':
                    return $this->query_SHA1;
                case 'php_sessionid':
                    return $this->php_sessionid;
                case 'http_accept_language':
                    return $this->http_accept_language;
                case 'http_accept_encoding':
                    return $this->http_accept_encoding;
                case 'https':
                    return $this->https;
                case 'http_user_agent':
                    return $this->http_user_agent;
                case 'http_client_ip':
                    return $this->http_client_ip;
                case 'http_x_forwarded_for':
                    return $this->http_x_forwarded_for;
                case 'remote_addr':
                    return $this->remote_addr;
                case 'server_port':
                    return $this->server_port;
                case 'remote_port':
                    return $this->remote_port;
                case 'http_accept_charset':
                    return $this->http_accept_charset;
                case 'request_method':
                    return $this->request_method;
                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('A null or invalid query attribute ['.$key.'] has been received.');

                break;

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function __destruct() {

    }

}

# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: crnrstn_sqlselect_tracker
#  VERSION :: 1.00.0000
#  DATE :: Tuesday July 14, 2020 @ 1400hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: Make it possible to associate an SQL field name with the query's result set data.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_sqlselect_tracker {

    protected $oLogger;
    public $oCRNRSTN_USR;

    protected $select_fieldName_ARRAY = array();
    protected $select_fieldPos_ARRAY = array();

    public function __construct($oCRNRSTN_USR) {

        try{

            if(isset($oCRNRSTN_USR)){
                $this->oCRNRSTN_USR = $oCRNRSTN_USR;

                $oCRNRSTN_ENV = $this->oCRNRSTN_USR->return_oCRNRSTN_ENV();

                //
                // INSTANTIATE LOGGER
                $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN_USR);

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('oCRNRSTN_USR is a required parameter for crnrstn_sqlselect_tracker :: __construct().');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function return_fieldPositionByName($result_set_key, $fieldname, $nullNotice = true){

        try{

            if(isset($this->select_fieldPos_ARRAY[$fieldname])) {

                return $this->select_fieldPos_ARRAY[$fieldname];

            }else{

                if($nullNotice){

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('No field name called "'.$fieldname.'" has been found in the provided query result set key ['.$result_set_key.'].');

                }else{

                    return -2;

                }
            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function return_fieldNameByPosition($pos, $nullNotice = true){

        if(isset($this->select_fieldName_ARRAY[$pos])) {

            return $this->select_fieldName_ARRAY[$pos];

        }else{

            if($nullNotice){

                $this->oCRNRSTN_USR->error_log('No field name is stored in position ['.$pos.'] out of a possible maximum total of ['.sizeof($this->select_fieldName_ARRAY).'].', __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

                return false;

            }

            return -1;

        }

    }

    public function return_fieldCount(){

        return sizeof($this->select_fieldPos_ARRAY);

    }

    public function reset_fakeyFields(){

        array_splice($this->select_fieldPos_ARRAY, 0);
        array_splice($this->select_fieldName_ARRAY, 0);

    }

    public function addFieldName($fieldname){

        //error_log('2676 query - add field name['.$fieldname.']');
        $this->select_fieldName_ARRAY[] = $fieldname;

        $tmp_position = sizeof($this->select_fieldName_ARRAY);
        $tmp_position--;
        $this->select_fieldPos_ARRAY[$fieldname] = $tmp_position;

    }

    public function __destruct() {

    }

}

# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: crnrstn_query_profile_manager
#  VERSION :: 1.00.0000
#  DATE :: Thursday July 16, 2020 @ 2158hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: Tell me everything that I want to know about query and CRNRSTN ::.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_query_profile_manager {

    protected $oLogger;
    public $oCRNRSTN_USR;

    protected $query_profile_serial_key = array();
    //protected $MySQLi = array();
    public $MySQLi = array();
    protected $result_handle = array();
    protected $batch_key = array();
    protected $result_set_key = array();

    public function __construct($oCRNRSTN_USR) {

        try{

            if(isset($oCRNRSTN_USR)){

                $this->oCRNRSTN_USR = $oCRNRSTN_USR;

                //
                // INSTANTIATE LOGGER
                $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN_USR);

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('oCRNRSTN_USR is a required parameter for '. __METHOD__ .'.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function loadQueryProfile($result_handle, $batch_key, $result_set_key){

        $oCRNRSTN_MySQLi = $this->oCRNRSTN_USR->return_crnrstn_mysqli();

        $tmp_query_profile_serial = $this->oCRNRSTN_USR->generate_new_key(50);
        $this->query_profile_serial_key[$tmp_query_profile_serial] = $result_set_key;

        $this->MySQLi[$tmp_query_profile_serial] = $oCRNRSTN_MySQLi;
        $this->result_handle[$tmp_query_profile_serial] = $result_handle;
        $this->batch_key[$tmp_query_profile_serial] = $batch_key;
        $this->result_set_key[$tmp_query_profile_serial] = $result_set_key;

    }

    public function returnQueryProfileSerial($result_set_key){

        try{

            # $this->query_profile_serial_key[$tmp_query_profile_serial] = $result_set_key;
            foreach($this->query_profile_serial_key as $tmp_query_profile_serial=>$loaded_result_set_key){

                //error_log('2763 query - ['.$result_set_key.']['.$loaded_result_set_key.']');
                if($result_set_key == $loaded_result_set_key){

                    return $tmp_query_profile_serial;

                }

            }

            //
            // HOOOSTON...VE HAF PROBLEM!
            throw new Exception('No query profile has been loaded via oQueryProfileMgr->loadQueryProfile() with the query result set key of "'.$result_set_key.'".');

        }catch( Exception $e ) {

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function return_MySQLi($result_set_key){

        try{

            $tmp_query_profile_serial = $this->returnQueryProfileSerial($result_set_key);

            if(isset($this->MySQLi[$tmp_query_profile_serial])){

                return $this->MySQLi[$tmp_query_profile_serial];

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No mysqli database connection associated with the query result set key of "'.$result_set_key.'" could be found.');

            }

        }catch( Exception $e ) {

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function isset_query_result_set_key($result_set_key){

        foreach($this->query_profile_serial_key as $tmp_query_profile_serial => $loaded_result_set_key){

            if($result_set_key == $loaded_result_set_key){

                //error_log(__LINE__ . ' query '.$result_set_key.' IS SET!');

                return true;

            }

        }

        //error_log(__LINE__ . ' query '.$result_set_key.' IS NOT SET! query_profile_serial_key='.print_r($this->query_profile_serial_key, true));
        return false;

    }

    public function return_resultHandle($result_set_key){

        try{

            $tmp_query_profile_serial = $this->returnQueryProfileSerial($result_set_key);

            if(isset($this->result_handle[$tmp_query_profile_serial])){

                return $this->result_handle[$tmp_query_profile_serial];

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No results handle associated with the query result set key of "'.$result_set_key.'" could be found.');

            }

        }catch( Exception $e ) {

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function return_batchKey($result_set_key){

        $tmp_query_profile_serial = $this->returnQueryProfileSerial($result_set_key);

        try{

            if(isset($this->batch_key[$tmp_query_profile_serial])){

                return $this->batch_key[$tmp_query_profile_serial];

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No batch key associated with the query result set key of "'.$result_set_key.'" could be found.');

            }

        }catch( Exception $e ) {

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }
    }

    public function __destruct() {

    }

}