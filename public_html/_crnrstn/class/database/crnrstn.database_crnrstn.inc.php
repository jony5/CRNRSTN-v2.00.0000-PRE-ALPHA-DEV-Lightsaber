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
#  CLASS :: crnrstn_database_crnrstn
#  VERSION :: 1.00.0000
#  DATE :: July 13, 2020 @ 0448hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: The CRNRSTN :: for database support within CRNRSTN ::.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_database_crnrstn {

    public $oCRNRSTN_USR;
    protected $oLogger;
    private static $oCRNRSTN_ENV;
    private static $oQueryManager;
    private static $oDB_wiring;

    public $crnrstn_db_crnrstn_serial;

    public function __construct($oCRNRSTN_USR = NULL) {

        try{

            if(isset($oCRNRSTN_USR)){

                $this->oCRNRSTN_USR = $oCRNRSTN_USR;

                //
                // SERIALIZE OBJECT - LEN32
                $this->crnrstn_db_crnrstn_serial = $this->oCRNRSTN_USR->generate_new_key();

                //
                // HOLD ENVIRONMENTALS
                self::$oCRNRSTN_ENV = $this->oCRNRSTN_USR->return_oCRNRSTN_ENV();

                //
                // INSTANTIATE LOGGER
                $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN_USR);

                //
                // INSTANTIATE DB WIRING
                self::$oDB_wiring = new crnrstn_database_wiring($this->oCRNRSTN_USR);

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('ERR :: oCRNRSTN_USR is a required parameter for '. __CLASS__ .' :: '. __FUNCTION__ .'.');

            }

            //
            // INSTANTIATE QUERY MANAGER
            self::$oQueryManager = new crnrstn_query_manager($this->oCRNRSTN_USR);

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function return_database_value($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $fieldname, $pos){

        return self::$oQueryManager->return_db_value(self::$oDB_wiring, $oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $fieldname, $pos);

    }


    public function resultSetMerge($oQueryProfileMgr, $result_handle, $batch_key, $result_set_key, $target_result_set_key, $merge_fields_piped, $merge_fields_distinct_val, $sequence_fields_piped, $sequence_fields_datatype_piped){

        return self::$oQueryManager->resultSetMerge(self::$oDB_wiring, $oQueryProfileMgr, $result_handle, $batch_key, $result_set_key, $target_result_set_key, $merge_fields_piped, $merge_fields_distinct_val, $sequence_fields_piped, $sequence_fields_datatype_piped);

    }

    public function ping_value_existence($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $fieldname, $value){

        return self::$oQueryManager->ping_value_existence(self::$oDB_wiring, $oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $fieldname, $value);

    }

    public function pingProfileExistence($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key){

        return self::$oQueryManager->pingProfileExistence($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key);

    }

    public function return_record_count($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key){

        return self::$oQueryManager->return_record_count(self::$oDB_wiring, $oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key);

    }

    public function load_previous_record_lookup($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $lookup_serial){

        self::$oQueryManager->load_previous_record_lookup(self::$oDB_wiring, $oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $lookup_serial);

    }

    public function init_lookup_by_id($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key){

        self::$oQueryManager->init_lookup_by_id(self::$oDB_wiring, $oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key);

    }

    public function add_lookup_field_data($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $field_name, $field_value){

        return self::$oQueryManager->add_lookup_field_data(self::$oDB_wiring, $oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $field_name, $field_value);

    }

    public function keyDataByID($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $piped_primary_id_fields){

        self::$oQueryManager->keyDataByID(self::$oDB_wiring, $oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $piped_primary_id_fields);

    }

    public function retrieve_data_by_id($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $piped_lookup_fieldname, $piped_lookup_id_data){

        return self::$oQueryManager->retrieve_data_by_id(self::$oDB_wiring, $oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $piped_lookup_fieldname, $piped_lookup_id_data);

    }

    public function process_query($request_serial){

        //
        // DO WE HAVE ANY SUBSET TO CONSIDER?
        if(self::$oQueryManager->queueValidQuery($request_serial, self::$oDB_wiring)){

            //
            // SEND TO DATABASE
            return self::$oQueryManager->sendQuery($request_serial, self::$oDB_wiring);

        }

        return true;

    }

    public function load_database_query($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $query){

        //
        // LOAD QUERY OBJECT INTO QUERY MANAGER
        return self::$oQueryManager->load_database_query(self::$oDB_wiring, $oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $query);

    }

    public function receive_process_query_param($key, $val, $request_serial){

        //
        // RECEIVE ANY RESTRICTIONS TO THE PROCESSING OF ALL (100%) QUERY AVAILABLE FOR
        // DIRECT SUBSET ACQUISITION.

        try{

            switch($key){
                case 'sql_accelerate_FLAG':
                case 'oCRNRSTN_MySQLi':
                case 'batch_key':
                case 'result_set_key':
                case 'result_handle':
                case 'query_override':

                    self::$oQueryManager->receive_process_query_param($key, $val, $request_serial);

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unknown key provided as parameter reference to oCRNRSTN_USR->process_query() meta-data '. __CLASS__ .' :: '. __FUNCTION__ .'.');

                break;
            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function __destruct() {

    }

}