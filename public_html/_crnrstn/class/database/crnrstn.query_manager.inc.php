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
#  CLASS :: crnrstn_query_manager
#  VERSION :: 1.00.0000
#  DATE :: Mon July 13, 2020 @ 0518hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: Get down and dirty putting it all together to send to database
#                 and process returned results.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_query_manager {

    public $oCRNRSTN_USR;
    protected $oLogger;
    protected $oQuery_ARRAY = array();
    protected $select_query_total_position = array();
    protected $oRequest_ARRAY = array();

    public $crnrstn_query_manager_serial;

    private static $validQuerySerial_log = array();
    private static $validQuery = array();
    private static $requestSerialByKey = array();

    private static $PQP_sql_accelerate_FLAG = array();
    private static $PQP_oCRNRSTN_MySQLi = array();
    private static $PQP_batch_key = array();
    private static $PQP_result_set_key = array();
    private static $PQP_result_handle = array();
    private static $PQP_query_override = array();
    private static $PQP_key = array();

    public function __construct($oCRNRSTN_USR){

        try{

            if(isset($oCRNRSTN_USR)){

                $this->oCRNRSTN_USR = $oCRNRSTN_USR;

                //
                // SERIALIZE OBJECT - LEN32
                $this->crnrstn_query_manager_serial = $this->oCRNRSTN_USR->generate_new_key();

                //
                // INSTANTIATE LOGGER
                $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN_USR);

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('oCRNRSTN_USR is a required parameter for crnrstn_query_manager :: __construct().');

            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function load_previous_record_lookup($oDB_wiring, $oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $lookup_serial){

        try{

            if(is_object($oCRNRSTN_MySQLi)){

                $connection_serial = $oCRNRSTN_MySQLi->returnConnSerial();

                //if(sizeof(self::$requestSerialByKey[$connection_serial][$result_handle][$batch_key][$result_set_key]) == 1){
                if($this->pingProfileExistence($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key)){

                    $request_serial = self::$requestSerialByKey[$connection_serial][$result_handle][$batch_key][$result_set_key][0];

                    $query_serial = $oDB_wiring->returnQuerySerialByKey($request_serial, $connection_serial, $batch_key, $result_set_key);

                    $oQuery = $this->oQuery_ARRAY[$this->select_query_total_position[$query_serial]][$query_serial];

                    $oQuery->load_previous_record_lookup($result_set_key, $lookup_serial);

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key.'].');

                }

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to access any database connection associated with the result set key [' . $result_set_key.'].');

            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return NULL;

    }

    public function init_lookup_by_id($oDB_wiring, $oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key){

        try{

            if(is_object($oCRNRSTN_MySQLi)){

                $connection_serial = $oCRNRSTN_MySQLi->returnConnSerial();

                //if(sizeof(self::$requestSerialByKey[$connection_serial][$result_handle][$batch_key][$result_set_key]) == 1){
                if($this->pingProfileExistence($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key)){

                    $request_serial = self::$requestSerialByKey[$connection_serial][$result_handle][$batch_key][$result_set_key][0];

                    $query_serial = $oDB_wiring->returnQuerySerialByKey($request_serial, $connection_serial, $batch_key, $result_set_key);

                    $oQuery = $this->oQuery_ARRAY[$this->select_query_total_position[$query_serial]][$query_serial];

                    $oQuery->init_lookup_by_id($result_set_key);

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key.'].');

                }

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to access any database connection associated with the result set key [' . $result_set_key.'].');

            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return NULL;

    }

    public function add_lookup_field_data($oDB_wiring, $oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $field_name, $field_value){

        try{

            if(is_object($oCRNRSTN_MySQLi)){

                $connection_serial = $oCRNRSTN_MySQLi->returnConnSerial();

                //if(sizeof(self::$requestSerialByKey[$connection_serial][$result_handle][$batch_key][$result_set_key]) == 1){
                if($this->pingProfileExistence($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key)){

                    $request_serial = self::$requestSerialByKey[$connection_serial][$result_handle][$batch_key][$result_set_key][0];

                    $query_serial = $oDB_wiring->returnQuerySerialByKey($request_serial, $connection_serial, $batch_key, $result_set_key);

                    $oQuery = $this->oQuery_ARRAY[$this->select_query_total_position[$query_serial]][$query_serial];

                    return $oQuery->add_lookup_field_data($result_set_key, $field_name, $field_value);

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key.'].');

                }

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to access any database connection associated with the result set key [' . $result_set_key.'].');

            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }
    }

    public function keyDataByID($oDB_wiring, $oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $piped_primary_id_fields){

        try{

            if(is_object($oCRNRSTN_MySQLi)){

                $connection_serial = $oCRNRSTN_MySQLi->returnConnSerial();

                //if(sizeof(self::$requestSerialByKey[$connection_serial][$result_handle][$batch_key][$result_set_key]) == 1){
                if($this->pingProfileExistence($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key)){

                    $request_serial = self::$requestSerialByKey[$connection_serial][$result_handle][$batch_key][$result_set_key][0];

                    $query_serial = $oDB_wiring->returnQuerySerialByKey($request_serial, $connection_serial, $batch_key, $result_set_key);

                    $oQuery = $this->oQuery_ARRAY[$this->select_query_total_position[$query_serial]][$query_serial];

                    return $oQuery->keyDataByID($result_set_key, $piped_primary_id_fields);

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key.'].');

                }

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to access any database connection associated with the result set key [' . $result_set_key.'].');

            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }
    }

    public function retrieve_data_by_id($oDB_wiring, $oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $piped_lookup_fieldname, $piped_lookup_id_data){

        try{

            if(is_object($oCRNRSTN_MySQLi)){

                $connection_serial = $oCRNRSTN_MySQLi->returnConnSerial();

                //if(sizeof(self::$requestSerialByKey[$connection_serial][$result_handle][$batch_key][$result_set_key]) == 1){
                if($this->pingProfileExistence($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key)){

                    $request_serial = self::$requestSerialByKey[$connection_serial][$result_handle][$batch_key][$result_set_key][0];

                    $query_serial = $oDB_wiring->returnQuerySerialByKey($request_serial, $connection_serial, $batch_key, $result_set_key);

                    $oQuery = $this->oQuery_ARRAY[$this->select_query_total_position[$query_serial]][$query_serial];

                    return $oQuery->retrieve_data_by_id($result_set_key, $piped_lookup_fieldname, $piped_lookup_id_data);

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Duplicate query sent to system. Unable to check on existence of value in ' . $result_handle . '/' . $result_set_key . ' data.');

                }

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to access any database connection associated with the result set key [' . $result_set_key.'].');

            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function resultSetMerge($oDB_wiring, $oQueryProfileMgr, $result_handle, $batch_key, $result_set_key, $target_result_set_key, $merge_fields_piped, $merge_fields_distinct_val, $sequence_fields_piped, $sequence_fields_datatype_piped){

        try{

            $oCRNRSTN_MySQLi = $oQueryProfileMgr->return_MySQLi($result_set_key);

            if(is_object($oCRNRSTN_MySQLi)){

                $connection_serial = $oCRNRSTN_MySQLi->returnConnSerial();
                //error_log('321 mgr - pingProfileExistence() [' . $connection_serial . '][' . $result_handle.'][' . $batch_key.'][' . $result_set_key.']');

                //if(sizeof(self::$requestSerialByKey[$connection_serial][$result_handle][$batch_key][$result_set_key]) == 1){
                if($this->pingProfileExistence($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key)){

                    $request_serial = self::$requestSerialByKey[$connection_serial][$result_handle][$batch_key][$result_set_key][0];

                    $query_serial = $oDB_wiring->returnQuerySerialByKey($request_serial, $connection_serial, $batch_key, $result_set_key);

                    //
                    // RETRIEVE oQuery TO MERGE
                    $oQuery = $this->oQuery_ARRAY[$this->select_query_total_position[$query_serial]][$query_serial];

                    //
                    // DETERMINE STATUS OF EXISTENCE OF AGGREGATE FAKEY QUERY AT $target_result_set_key
                    $fakey_result_handle = 'CRNRSTN_FAKEY_RESULT_HANDLE';
                    $fakey_batch_key = 'CRNRSTN_FAKEY_BATCH_KEY';
                    $fakey_mysqli_serial = $this->oCRNRSTN_USR->crcINT('CRNRSTN_FAKEY_CONN_SERIAL');

                    $fakey_oCRNRSTN_MySQLi = $this->oCRNRSTN_USR->return_oCRNRSTN_MySQLi_Fakey($fakey_mysqli_serial);

                    if(!($this->pingProfileExistence($fakey_oCRNRSTN_MySQLi, $fakey_result_handle, $fakey_batch_key, $target_result_set_key))){

                        //
                        // CREATE FAKEY QUERY TO HOLD ALL RESULT SETS TO BE MERGED
                        $fakey_query = "SELECT `FAKEY_KICK_FLIP`.`CRNRSTN_200TMP` FROM `FAKEY_KICK_FLIP` LIMIT 0;";

                        //
                        // RETURN FAKEY CRNRSTN MYSQLI CONNECTION OBJECT
                        $fakey_oCRNRSTN_MySQLi = new crnrstn_database_conn_handle($this->oCRNRSTN_USR);
                        $fakey_oCRNRSTN_MySQLi->load_connection_serial($fakey_mysqli_serial);

                        //
                        // USING A LEGIT MYSQLI DB CONN OBJECT WITH FAKEY SERIAL
                        $mysqli = $oCRNRSTN_MySQLi->return_conn_object();

                        $tmp_fakey_mysqli = $this->oCRNRSTN_USR->pushFakeyDBConn($fakey_mysqli_serial, $mysqli);
                        $fakey_oCRNRSTN_MySQLi->load_connection_obj($tmp_fakey_mysqli);

                        $fakey_oQuery = $this->load_fakey_databaseQuery($oDB_wiring, $fakey_oCRNRSTN_MySQLi, $fakey_result_handle, $fakey_batch_key, $target_result_set_key, $fakey_query);

                        //
                        // MUST FAKEY SEND UPON INITIALIZATION TO BE ABLE TO GRIP/RETRIEVE THE FAKEY
                        // oQUERY OBJECT HOLDING n+1 RESULT SET AGGREGATION
                        $tmp_request_serial = $this->oCRNRSTN_USR->crcINT('CRNRSTN_FAKEY_REQUEST_SERIAL');

                        $oQueryProfileMgr->loadQueryProfile($fakey_oCRNRSTN_MySQLi, $fakey_result_handle, $fakey_batch_key, $target_result_set_key);

                        $this->sendQuery_Fakey($tmp_request_serial, $fakey_oQuery, $oDB_wiring, $fakey_oCRNRSTN_MySQLi, $fakey_result_handle, $fakey_batch_key, $target_result_set_key);

                    }

                    //
                    // RETRIEVE FAKEY QUERY
                    $fakey_request_serial = self::$requestSerialByKey[$fakey_mysqli_serial][$fakey_result_handle][$fakey_batch_key][$target_result_set_key][0];

                    $fakey_query_serial = $oDB_wiring->returnQuerySerialByKey($fakey_request_serial, $fakey_mysqli_serial, $fakey_batch_key, $target_result_set_key);

                    //
                    // RETRIEVE FAKEY oQuery TO RECEIVE ALL MERGE
                    $oQuery_fakey = $this->oQuery_ARRAY[$this->select_query_total_position[$fakey_query_serial]][$fakey_query_serial];

                    //
                    // PROCEED TO MERGE CURRENT oQUERY RESULT SET INTO FAKEY oQUERY
                    $oQuery_fakey->resultSetMerge($oQuery, $target_result_set_key, $merge_fields_piped, $merge_fields_distinct_val, $sequence_fields_piped, $sequence_fields_datatype_piped);

                    //return $oQuery->return_db_value($result_set_key, $fieldname, $pos);

                    #$target_result_set_key

                    return NULL;

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Duplicate query sent to system. Unable to check on existence of value in ' . $result_handle.'/' . $result_set_key.' data.');

                }

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to access any database connection associated with the result set key [' . $result_set_key.'].');

            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function return_db_value($oDB_wiring, $oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $fieldname, $pos){

        try{

            if(is_object($oCRNRSTN_MySQLi)){

                $connection_serial = $oCRNRSTN_MySQLi->returnConnSerial();

                //if(sizeof(self::$requestSerialByKey[$connection_serial][$result_handle][$batch_key][$result_set_key]) == 1){
                if($this->pingProfileExistence($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key)){
                    $request_serial = self::$requestSerialByKey[$connection_serial][$result_handle][$batch_key][$result_set_key][0];

                    $query_serial = $oDB_wiring->returnQuerySerialByKey($request_serial, $connection_serial, $batch_key, $result_set_key);

                    $oQuery = $this->oQuery_ARRAY[$this->select_query_total_position[$query_serial]][$query_serial];

                    return $oQuery->return_db_value($result_set_key, $fieldname, $pos);

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Duplicate query sent to system. Unable to check on existence of value in ' . $result_handle.'/' . $result_set_key.' data.');

                }

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to access any database connection associated with the result set key [' . $result_set_key.'].');

            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function ping_value_existence($oDB_wiring, $oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $fieldname, $value){

        try{

            if(is_object($oCRNRSTN_MySQLi)){

                $connection_serial = $oCRNRSTN_MySQLi->returnConnSerial();

                //if(sizeof(self::$requestSerialByKey[$connection_serial][$result_handle][$batch_key][$result_set_key]) == 1){
                if($this->pingProfileExistence($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key)){

                    $request_serial = self::$requestSerialByKey[$connection_serial][$result_handle][$batch_key][$result_set_key][0];

                    //error_log('136 mgr - 1[' . $connection_serial . '] 2[' . $result_handle.'] 3[' . $batch_key.'] 4[' . $result_set_key.'] 5[' . $request_serial . ']');
                    $query_serial = $oDB_wiring->returnQuerySerialByKey($request_serial, $connection_serial, $batch_key, $result_set_key);

                    //error_log('139 mgr - [' . $this->select_query_total_position[$query_serial].'][' . $query_serial . ']');
                    $oQuery = $this->oQuery_ARRAY[$this->select_query_total_position[$query_serial]][$query_serial];

                    return $oQuery->ping_value_existence($result_set_key, $fieldname, $value);

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Duplicate query sent to system. Unable to check on existence of value in ' . $result_handle.'/' . $result_set_key.' data.');

                }

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to access any database connection associated with the result set key [' . $result_set_key.'].');

            }


        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function pingProfileExistence($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key){

        try{

            if(is_object($oCRNRSTN_MySQLi)){

                $connection_serial = $oCRNRSTN_MySQLi->returnConnSerial();

                //
                // A BASIC CHECK FOR FAKEY INITIALIZATION
                if(isset(self::$requestSerialByKey[$connection_serial])){

                    if(sizeof(self::$requestSerialByKey[$connection_serial][$result_handle][$batch_key][$result_set_key]) == 1){

                        return true;

                    }else{

                        return false;
                    }

                }else{

                    return false;

                }

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to access any database connection associated with the result set key [' . $result_set_key.'].');

            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function receive_process_query_param($key, $val, $request_serial){

        //
        // RECEIVE ANY RESTRICTIONS TO THE PROCESSING OF ALL (100%) QUERY AVAILABLE FOR
        // DIRECT SUBSET ACQUISITION.

        self::$PQP_key[$request_serial][] = $key;

        try{

            switch($key){
                case 'sql_accelerate_FLAG':
                    self::$PQP_sql_accelerate_FLAG[$request_serial][] = $val;
                break;
                case 'oCRNRSTN_MySQLi':
                    self::$PQP_oCRNRSTN_MySQLi[$request_serial][] = $val;
                break;
                case 'batch_key':
                    self::$PQP_batch_key[$request_serial][] = $val;
                break;
                case 'result_set_key':
                    self::$PQP_result_set_key[$request_serial][] = $val;
                break;
                case 'result_handle':
                    self::$PQP_result_handle[$request_serial][] = $val;
                break;
                case 'query_override':
                    self::$PQP_query_override[$request_serial][] = $val;
                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unknown key provided as parameter reference to oCRNRSTN_USR->process_query() meta-data crnrstn_query_manager :: receive_process_query_param().');

                break;

            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function return_record_count($oDB_wiring, $oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key){

        try{

            if(is_object($oCRNRSTN_MySQLi)){

                $connection_serial = $oCRNRSTN_MySQLi->returnConnSerial();

                //if(sizeof(self::$requestSerialByKey[$connection_serial][$result_handle][$batch_key][$result_set_key])==1){
                if($this->pingProfileExistence($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key)){

                    $request_serial = self::$requestSerialByKey[$connection_serial][$result_handle][$batch_key][$result_set_key][0];

                    //error_log('136 mgr - 1[' . $connection_serial . '] 2[' . $result_handle.'] 3[' . $batch_key.'] 4[' . $result_set_key.'] 5[' . $request_serial . ']');
                    $query_serial = $oDB_wiring->returnQuerySerialByKey($request_serial, $connection_serial, $batch_key, $result_set_key);

                    //error_log('139 mgr - [' . $this->select_query_total_position[$query_serial].'][' . $query_serial . ']');
                    $oQuery = $this->oQuery_ARRAY[$this->select_query_total_position[$query_serial]][$query_serial];

                    return $oQuery->return_record_count();

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Duplicate query sent to system. Unable to report on record count for ' . $result_handle.'/' . $result_set_key.' data.');

                }

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to access any database connection associated with the result set key [' . $result_set_key.'].');

            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function sendQuery_Fakey($request_serial, $oQuery, $oDB_wiring, $fakey_oCRNRSTN_MySQLi, $fakey_result_handle, $fakey_batch_key, $target_result_set_key){

        $oUserRequest = new crnrstn_database_request($this->oCRNRSTN_USR);

        try{

            if(isset($request_serial)){

                //foreach(self::$validQuery[$request_serial] as $key=>$oQuery){

                    $oUserRequest->spoolQuery($oQuery, $request_serial, $oDB_wiring);

                    $fakey_connection_serial = $fakey_oCRNRSTN_MySQLi->returnConnSerial();

                    self::$requestSerialByKey[$fakey_connection_serial][$fakey_result_handle][$fakey_batch_key][$target_result_set_key][] = $request_serial;

                //}

                //
                // THIS IS A QUERY FAKEY...DON'T SEEENND IIIIT!
                //$tmp_req_status = $oUserRequest->sendIt($request_serial, $oDB_wiring, $this);

                $this->oRequest_ARRAY[$request_serial] = $oUserRequest;

                //return $tmp_req_status;
                return true;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Missing or NULL request_serial parameter for '. __FUNCTION__ .'.');

            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function sendQuery($request_serial, $oDB_wiring){

        $oUserRequest = new crnrstn_database_request($this->oCRNRSTN_USR);

        try{

            if(isset($request_serial)){

                foreach(self::$validQuery[$request_serial] as $key=>$oQuery){

                    $oUserRequest->spoolQuery($oQuery, $request_serial, $oDB_wiring);

                    $connection_serial = $oQuery->return_attribute('connection_serial');
                    $result_handle = $oQuery->return_attribute('result_handle');
                    $batch_key = $oQuery->return_attribute('batch_key');
                    $result_set_key = $oQuery->return_attribute('result_set_key');

                    $this->oCRNRSTN_USR->error_log('Spooling query for delivery :: Batch Key=' . $batch_key . ' Result Set Key=' . $result_set_key, __LINE__, __METHOD__, __FILE__, CRNRSTN_DATABASE_QUERY);

                    self::$requestSerialByKey[$connection_serial][$result_handle][$batch_key][$result_set_key][] = $request_serial;

                }

                $tmp_req_status = $oUserRequest->sendIt($request_serial, $oDB_wiring, $this);

                $this->oRequest_ARRAY[$request_serial] = $oUserRequest;

                return $tmp_req_status;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Missing or NULL request_serial parameter for '. __FUNCTION__ .'.');

            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function queueValidQuery($request_serial, $oDB_wiring){

        $tmp_validQuery = false;
        $tmp_PQP_key_cnt = sizeof(self::$PQP_key[$request_serial]);

        foreach($this->oQuery_ARRAY as $key=>$chunkArray0){

            foreach($chunkArray0 as $query_serial=>$oQuery){

                if(!in_array($query_serial, self::$validQuerySerial_log)){

                    switch ($oQuery->query_life_stage){
                        case 'READY':
                            /*
                            self::$PQP_sql_accelerate_FLAG[$request_serial]

                            self::$PQP_oCRNRSTN_MySQLi[$request_serial]
                            self::$PQP_batch_key[$request_serial]
                            self::$PQP_result_set_key[$request_serial]
                            self::$PQP_result_handle[$request_serial]
                            self::$PQP_query_override[$request_serial]

                            self::$PQP_key[$request_serial]
                             * */
                            // TODO :: SEND QUERY SUBSET TO DATABASE
                            //error_log('469 query mgr - A TODO IS HERE...SEND QUERY SUBSET TO DATABASE...');
                            if($tmp_PQP_key_cnt>1){

                                //
                                // WE HAVE MORE SPECIFIC SUBSET TO CONSIDER WITHIN ALL AVAILABLE

                            }else{

                                //
                                // OK TO PROCESS AVAILABLE QUERY.
                                self::$validQuery[$request_serial][] = $oQuery;
                                self::$validQuerySerial_log[] = $oQuery->crnrstn_db_query_serial;
                                $tmp_validQuery = true;

                                $oDB_wiring->activateQuery($request_serial, $oQuery);

                            }

                            break;

                    }

                }

            }

        }

        return $tmp_validQuery;

    }

    public function load_database_query($oDB_wiring, $oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $query){

        try{

            if(is_object($oCRNRSTN_MySQLi)){

                $oQuery = new crnrstn_database_query($this->oCRNRSTN_USR);

                //
                // INGEST CONNECTION DATA
                $oQuery->load_mysqli_connection($oCRNRSTN_MySQLi);

                //
                // INGEST KEY DATA
                $oQuery->load_query_key($result_handle, $batch_key, $result_set_key);

                //
                // INGEST QUERY DATA
                $oQuery->load_query($query);

                //
                // PREP QUERY FOR DATABASE REQUEST
                $oQuery->initialize();

                $oQuery = $oDB_wiring->connectQuery($oQuery);

                $tmp_array = array();
                $query_serial = $oQuery->crnrstn_db_query_serial;
                $tmp_array[$query_serial] = $oQuery;

                $this->oQuery_ARRAY[] = $tmp_array;

                $tmp_position = sizeof($this->oQuery_ARRAY);
                $tmp_position -= 1;

                $this->select_query_total_position[$query_serial] = $tmp_position;

                return true;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to access any database connection associated with the result set key [' . $result_set_key.'].');

            }


        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }
    }

    public function load_fakey_databaseQuery($oDB_wiring, $oCRNRSTN_MySQLi, $result_handle, $batch_key, $target_result_set_key, $query){

        try{

            if(is_object($oCRNRSTN_MySQLi)){

                $oQuery = new crnrstn_database_query($this->oCRNRSTN_USR);

                //
                // INGEST FAKEY CONNECTION DATA
                $oQuery->load_mysqli_connection($oCRNRSTN_MySQLi);

                //
                // INGEST KEY DATA
                $oQuery->load_query_key($result_handle, $batch_key, $target_result_set_key);

                //
                // INGEST QUERY DATA
                $oQuery->load_query($query);

                //
                // PREP QUERY FOR DATABASE REQUEST
                $oQuery->initialize();

                $oQuery = $oDB_wiring->connectQuery($oQuery);

                $tmp_array = array();
                $query_serial = $oQuery->crnrstn_db_query_serial;
                $tmp_array[$query_serial] = $oQuery;

                $this->oQuery_ARRAY[] = $tmp_array;

                $tmp_position = sizeof($this->oQuery_ARRAY);
                $tmp_position -= 1;

                $this->select_query_total_position[$query_serial] = $tmp_position;

                //return true;
                return $oQuery;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to access any database connection associated with the result set key [' . $target_result_set_key.'].');

            }


        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function returnQuery($query_serial){

        try{

            if(isset($this->oQuery_ARRAY[$this->select_query_total_position[$query_serial]][$query_serial])){

                return $this->oQuery_ARRAY[$this->select_query_total_position[$query_serial]][$query_serial];

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to locate a query object associated with the query serial, "' . $query_serial . '".');

            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function __destruct(){

    }

}