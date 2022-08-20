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
#  CLASS :: crnrstn_database_wiring
#  VERSION :: 1.00.0000
#  DATE :: July 15, 2020 @ 1209hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: Really tie it all together.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_database_wiring{

    protected $oLogger;
    public $class_name;

    public $oCRNRSTN_USR;

    private static $RAIL_query_wiring_serial = array();
    private static $RAIL_crnrstn_db_query_serial = array();
    private static $RAIL_connection_serial = array();
    private static $RAIL_query_MD5 = array();
    private static $RAIL_activeQuery = array();

    private static $RAIL_result_handle = array();
    private static $RAIL_batch_key = array();
    private static $RAIL_result_set_key = array();

    private static $expectResultSetQuery = array();

    private static $positionInTotal = array();
    private static $positionInSelect = array();

    protected $query = array();
    private static $mysqli = array();
    private static $queryType = array();

    public $currentSelectQueryPos;

    private static $querySerialByKey = array();

    public function __construct($oCRNRSTN_USR){

        $this->class_name = get_class();

        try {

            if(isset($oCRNRSTN_USR)){

                $this->oCRNRSTN_USR = $oCRNRSTN_USR;

                //
                // INSTANTIATE LOGGER
                $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN_USR);

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('oCRNRSTN_USR is a required parameter for ' . $this->class_name.' :: '. __FUNCTION__ .'.');

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function hasSelectResults($request_serial, $connection_serial, $batch_key){

        if(!isset(self::$expectResultSetQuery[$request_serial][$connection_serial][$batch_key])){

            return false;

        }else{

            return true;

        }

    }

    public function returnQuerySerialByKey($request_serial, $connection_serial, $batch_key, $result_set_key){

        try{

            if(isset(self::$querySerialByKey[$request_serial][$connection_serial][$batch_key][$result_set_key])){

                return self::$querySerialByKey[$request_serial][$connection_serial][$batch_key][$result_set_key];

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to locate the initialized query serial by key, where connection serial=[' . $connection_serial . '] batch key=[' . $batch_key.'] and result set key=[' . $result_set_key.'].');

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function returnQuerySerial($request_serial, $connection_serial, $batch_key){

        try{

            if(isset(self::$expectResultSetQuery[$request_serial][$connection_serial][$batch_key][$this->currentSelectQueryPos])){

                return self::$expectResultSetQuery[$request_serial][$connection_serial][$batch_key][$this->currentSelectQueryPos];

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the initialized query serial, where the connection serial=[' . $connection_serial . '] and the batch key=[' . $batch_key.'].');

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function returnConn($request_serial, $connection_serial, $batch_key){

        try{

            if(isset(self::$mysqli[$request_serial][$connection_serial][$batch_key])){

                return self::$mysqli[$request_serial][$connection_serial][$batch_key];

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the mysqli connection, where the connection serial=[' . $connection_serial . '] and the batch key=[' . $batch_key.'].');

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function returnSQLSpooledConn($request_serial){

        try{

            if(isset($this->query[$request_serial])){

                $tmp_spooled_conn_ARRAY = array();
                $i = 0;

                //
                // FOR EACH CONNECTION
                foreach($this->query[$request_serial] as $connection_serial => $batchkeyArray){

                    //
                    // FOR EACH BATCH PER CONNECTION
                    foreach($batchkeyArray as $batch_key => $query){

                        $tmp_spooled_conn_ARRAY[$i]['query'] = $query;
                        $tmp_spooled_conn_ARRAY[$i]['batch_key'] = $batch_key;
                        $tmp_spooled_conn_ARRAY[$i]['connection_serial'] = $connection_serial;
                        $tmp_spooled_conn_ARRAY[$i]['type'] = self::$queryType[$request_serial][$connection_serial][$batch_key];

                        //
                        // FIX ADDED AND CONFIRMED ON 11.18.2021 @ 1848 hrs - J5
                        $i++;

                    }

                }

                return $tmp_spooled_conn_ARRAY;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No database connections have been spooled for the request serial, "' . $request_serial . '".');

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function spoolRequestedQuery($oQuery, $request_serial){

        $tmp_crnrstn_db_query_serial = $oQuery->crnrstn_db_query_serial;
        $tmp_connection_serial = $oQuery->return_attribute('connection_serial');
        //$tmp_select_query = $oQuery->return_attribute('select_query');
        $tmp_batch_key = $oQuery->return_attribute('batch_key');
        $tmp_result_set_key = $oQuery->return_attribute('result_set_key');
        //$tmp_query_wiring_serial = $oQuery->return_attribute('query_wiring_serial');

        //error_log('248 wire - [' . $request_serial . '][' . $tmp_connection_serial . '][' . $tmp_batch_key.'][' . $tmp_result_set_key.'][' . $tmp_crnrstn_db_query_serial . ']');
        self::$querySerialByKey[$request_serial][$tmp_connection_serial][$tmp_batch_key][$tmp_result_set_key] = $tmp_crnrstn_db_query_serial;

        if(!isset($this->query[$request_serial][$tmp_connection_serial][$tmp_batch_key])){
            //error_log('First batch query=>[' . $request_serial . '][' . $tmp_connection_serial . '][' . $tmp_batch_key.'][' . $tmp_select_query.']');
            $this->query[$request_serial][$tmp_connection_serial][$tmp_batch_key] = '';
            self::$queryType[$request_serial][$tmp_connection_serial][$tmp_batch_key] = 'single';
            self::$mysqli[$request_serial][$tmp_connection_serial][$tmp_batch_key] = $oQuery->return_attribute('mysqli');

        }else{

            //error_log('Multi batch query=>[' . $request_serial . '][' . $tmp_connection_serial . '][' . $tmp_batch_key.'][' . $tmp_select_query.']');
            self::$queryType[$request_serial][$tmp_connection_serial][$tmp_batch_key] = 'multi';

        }

        $this->query[$request_serial][$tmp_connection_serial][$tmp_batch_key] .= $oQuery->return_attribute('raw_query');

    }

    public function activateQuery($request_serial, $oQuery){

        $tmp_crnrstn_db_query_serial = $oQuery->crnrstn_db_query_serial;
        $tmp_connection_serial = $oQuery->return_attribute('connection_serial');
        $tmp_select_query = $oQuery->return_attribute('select_query');
        $tmp_batch_key = $oQuery->return_attribute('batch_key');

        //
        // TOTAL QUERY
        self::$RAIL_activeQuery[$request_serial][$tmp_connection_serial][$tmp_batch_key][] = $tmp_crnrstn_db_query_serial;

        //
        // SELECT QUERY
        if(strlen($tmp_select_query)>0){

            if(!isset(self::$expectResultSetQuery[$request_serial][$tmp_connection_serial][$tmp_batch_key])){

                $tmp_sel_query_cnt = 0;

            }else{

                $tmp_sel_query_cnt = sizeof(self::$expectResultSetQuery[$request_serial][$tmp_connection_serial][$tmp_batch_key]);

            }

            self::$expectResultSetQuery[$request_serial][$tmp_connection_serial][$tmp_batch_key][] = $tmp_crnrstn_db_query_serial;
            self::$positionInSelect[$request_serial][$tmp_connection_serial][$tmp_batch_key][] = $tmp_sel_query_cnt;

        }else{

           // error_log('182 wire - die(); YEPPERS! NEED TO INIT...');
        }

    }

    public function connectQuery($oQuery){

        $tmp_query_wiring_serial = $this->oCRNRSTN_USR->generate_new_key(70);

        //
        // STORE QUERY METADATA
        return $this->wireQueryUp($tmp_query_wiring_serial, $oQuery);

    }

    private function wireQueryUp($query_wiring_serial, $oQuery){

        $tmp_current_query_count = sizeof(self::$RAIL_query_wiring_serial);

        $oQuery->load_wire_serial($query_wiring_serial);

        //
        // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED.
        $tmp_crnrstn_db_query_serial = $oQuery->crnrstn_db_query_serial;
        $tmp_connection_serial = $oQuery->return_attribute('connection_serial');
        $tmp_query_MD5 = $oQuery->return_attribute('query_MD5');
        $tmp_result_handle = $oQuery->return_attribute('result_handle');
        $tmp_batch_key = $oQuery->return_attribute('batch_key');
        $tmp_result_set_key = $oQuery->return_attribute('result_set_key');

        self::$RAIL_query_wiring_serial[] = $query_wiring_serial;
        self::$RAIL_crnrstn_db_query_serial[] = $tmp_crnrstn_db_query_serial;
        self::$RAIL_connection_serial[] = $tmp_connection_serial;
        self::$RAIL_query_MD5[] = $tmp_query_MD5;

        self::$RAIL_result_handle[] = $tmp_result_handle;
        self::$RAIL_batch_key[] = $tmp_batch_key;
        self::$RAIL_result_set_key[] = $tmp_result_set_key;

        self::$positionInTotal[$tmp_connection_serial][$query_wiring_serial][] = $tmp_current_query_count;

        return $oQuery;

    }

    public function __destruct(){

    }
}