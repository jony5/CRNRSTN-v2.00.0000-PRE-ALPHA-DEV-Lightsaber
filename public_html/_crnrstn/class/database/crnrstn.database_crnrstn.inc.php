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
#  CLASS :: crnrstn_database_crnrstn
#  VERSION :: 1.00.0000
#  DATE :: July 13, 2020 @ 0448hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: I go with CRNRSTN :: for database support; I am the cornerstone
#                 for database within CRNRSTN ::
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_database_crnrstn {

    public $oCRNRSTN_USR;
    protected $oLogger;
    private static $oQueryManager;
    private static $oDB_wiring;

    public $crnrstn_db_crnrstn_serial;

    public function __construct($oCRNRSTN_USR){

        try{

            $this->oCRNRSTN_USR = $oCRNRSTN_USR;
            //$this->oCRNRSTN_USR->error_log('[' . __CLASS__ . '] READY TO WORK 4 U.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

//            if(isset($oCRNRSTN_USR)){
//
//                $this->oCRNRSTN_USR = $oCRNRSTN_USR;
//
//                //
//                // SERIALIZE OBJECT - LEN32
//                $this->crnrstn_db_crnrstn_serial = $this->oCRNRSTN_USR->generate_new_key();
//
//                //
//                // INSTANTIATE LOGGER
//                $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN_USR);
//
//                //
//                // INSTANTIATE DB WIRING
//                self::$oDB_wiring = new crnrstn_database_wiring($this->oCRNRSTN_USR);
//
//            }else{
//
//                //
//                // HOOOSTON...VE HAF PROBLEM!
//                throw new Exception('ERR :: oCRNRSTN_USR is a required parameter for '. __CLASS__ .' :: '. __FUNCTION__ .'.');
//
//            }
//
//            //
//            // INSTANTIATE QUERY MANAGER
//            self::$oQueryManager = new crnrstn_query_manager($this->oCRNRSTN_USR);

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function config_load_static_application_data($data_type){

        switch($data_type){
            case 'sql_interval_values':

                return array(array('MICROSECOND' => 'MICROSECONDS'),
                array('SECOND' => 'SECONDS'), array('MINUTE' => 'MINUTES'), array('HOUR' => 'HOURS'),
                array('DAY' => 'DAYS'), array('WEEK' => 'WEEKS'), array('MONTH' => 'MONTHS'),
                array('QUARTER' => 'QUARTERS'), array('YEAR' => 'YEARS'),
                array('SECOND_MICROSECOND' => 'SECONDS.MICROSECONDS'),
                array('MINUTE_MICROSECOND' => 'MINUTES:SECONDS.MICROSECONDS'), array('MINUTE_SECOND' => 'MINUTES:SECONDS'),
                array('HOUR_MICROSECOND' => 'HOURS:MINUTES:SECONDS.MICROSECONDS'),
                array('HOUR_SECOND' => 'HOURS:MINUTES:SECONDS'), array('HOUR_MINUTE' => 'HOURS:MINUTES'),
                array('DAY_MICROSECOND' => 'DAYS HOURS:MINUTES:SECONDS.MICROSECONDS'),
                array('DAY_SECOND' => 'DAYS HOURS:MINUTES:SECONDS'), array('DAY_MINUTE' => 'DAYS HOURS:MINUTES'),
                array('DAY_HOUR' => 'DAYS HOURS'), array('YEAR_MONTH' => 'YEARS-MONTHS'));

            break;
            case 'sql_interval_string_patterns':

                return array('SECONDS_MICROSECONDS' => 9,
                'SECONDS_MICROSECOND' => 9, 'SECOND_MICROSECONDS' => 9, 'SECOND_MICROSECOND' => 9,
                'MINUTES_MICROSECONDS' => 10, 'MINUTES_MICROSECOND' => 10, 'MINUTE_MICROSECONDS' => 10,
                'MINUTE_MICROSECOND' => 10, 'HOURS_MICROSECONDS' => 12, 'HOURS_MICROSECOND' => 12,
                'HOUR_MICROSECONDS' => 12, 'HOUR_MICROSECOND' => 12, 'DAYS_MICROSECONDS' => 15, 'DAYS_MICROSECOND' => 15,
                'DAY_MICROSECONDS' => 15, 'DAY_MICROSECOND' => 15, 'MINUTES_SECONDS' => 11, 'MINUTES_SECOND' => 11,
                'MINUTE_SECONDS' => 11, 'MINUTE_SECOND' => 11, 'MICROSECONDS' => 0, 'MICROSECOND' => 0,
                'HOURS_SECONDS' => 13, 'HOURS_SECOND' => 13, 'HOUR_SECONDS' => 13, 'HOUR_SECOND' => 13,
                'HOURS_MINUTES' => 14, 'HOUR_MINUTES' => 14, 'HOURS_MINUTE' => 14, 'HOUR_MINUTE' => 14,
                'DAYS_SECONDS' => 16, 'DAYS_SECOND' => 16, 'DAY_SECONDS' => 16, 'DAY_SECOND' => 16, 'DAYS_MINUTES' => 17,
                'DAYS_MINUTE' => 17, 'DAY_MINUTES' => 17, 'DAY_MINUTE' => 17, 'YEARS_MONTHS' => 19, 'YEARS_MONTH' => 19,
                'YEAR_MONTHS' => 19, 'YEAR_MONTH' => 19, 'DAYS_HOURS' => 18, 'DAYS_HOUR' => 18, 'DAY_HOURS' => 18,
                'DAY_HOUR' => 18, 'QUARTERS' => 7, 'QUARTER' => 7, 'SECONDS' => 1, 'SECOND' => 1, 'MINUTES' => 2,
                'MINUTE' => 2, 'MONTHS' => 6, 'MONTH' => 6, 'HOURS' => 3, 'HOUR' => 3, 'WEEKS' => 5, 'WEEK' => 5,
                'YEARS' => 8, 'YEAR' => 8, 'DAYS' => 4, 'MINS' => 2, 'SECS' => 1, 'QTR' => 7, 'MTH' => 6, 'DAY' => 4,
                'MIN' => 2, 'SEC' => 1, 'YR' => 8, 'WK' => 5, 'HR' => 3);

            break;
            default:

                error_log(__LINE__ . ' env Unknown SWITCH CASE received. ['. strval($data_type) . '].');

            break;

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

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function __destruct(){

    }

}