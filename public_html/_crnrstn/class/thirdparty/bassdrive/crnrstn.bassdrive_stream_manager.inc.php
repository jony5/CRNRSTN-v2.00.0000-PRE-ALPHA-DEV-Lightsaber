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
#  CLASS :: crnrstn_bassdrive_stream_manager
#  VERSION :: 1.00.0000
#  DATE :: November 10, 2021 @ 2217 hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: You were the best, J5. Thank you for
#                 everything. Happy birthday to you,
#                 ole buddy. - From J5
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_bassdrive_stream_manager {

    public $oCRNRSTN_USR;
    protected $oRELAY_MANAGER;

    private static $current_relay_ojson;
    private static $timestamp_ms_current_relay_ojson;

    private static $data_shard_max_bassdrive_streams_cnt = 1;

    public function __construct($oCRNRSTN_USR){

        $this->oCRNRSTN_USR = $oCRNRSTN_USR;

    }

    public function refresh_bassdrive_history(){

        try{

            $tmp_html_output = '';

            //$tmp_orelay = $this->oRELAY_MANAGER->return_relay_for_logging();
            //error_log(__LINE__ . ' user we have valid json. write to db.[' . $tmp_orelay->return_stream_title().']');

            $oCRNRSTN_MySQLi = $this->oCRNRSTN_USR->return_crnrstn_mysqli();
            $mysqli = $oCRNRSTN_MySQLi->return_conn_object();
            $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();
            $tmp_log_state_sync_SQL = '';
            $tmp_query_count = 0;
            $tmp_query_batch_size = 2;

            $this->oCRNRSTN_USR->load_query_profile('BASSDRIVE_DATA', '!jesus_is_my_dear_lord!', 'LOG_BASSDRIVE_PROCESSED');
            $this->oCRNRSTN_USR->load_query_profile('BASSDRIVE_DATA', '!jesus_is_my_dear_lord!', 'LOG_BASSDRIVE');
            $this->oCRNRSTN_USR->load_query_profile('BASSDRIVE_DATA', '!jesus_is_my_dear_lord!', 'BASSDRIVE_STREAM');
            $this->oCRNRSTN_USR->load_query_profile('BASSDRIVE_DATA', '!jesus_is_my_dear_lord!', 'BASSDRIVE_STREAM_COLORS');
            $this->oCRNRSTN_USR->load_query_profile('BASSDRIVE_DATA', '!jesus_is_my_dear_lord!', 'BASSDRIVE_STREAM_KEY_PATTERN_LOOKUP');
            $this->oCRNRSTN_USR->load_query_profile('BASSDRIVE_DATA', '!jesus_is_my_dear_lord!', 'BASSDRIVE_STREAM_SOCIAL_CONFIG');

            $this->oCRNRSTN_USR->add_database_query('LOG_BASSDRIVE_PROCESSED');
            $this->oCRNRSTN_USR->add_database_query('LOG_BASSDRIVE');
            $this->oCRNRSTN_USR->add_database_query('BASSDRIVE_STREAM');
            $this->oCRNRSTN_USR->add_database_query('BASSDRIVE_STREAM_COLORS');
            $this->oCRNRSTN_USR->add_database_query('BASSDRIVE_STREAM_KEY_PATTERN_LOOKUP');
            $this->oCRNRSTN_USR->add_database_query('BASSDRIVE_STREAM_SOCIAL_CONFIG');

            //
            // PROCESS ALL QUERY TO CONNECTION(S).
            $this->oCRNRSTN_USR->process_query(true);

            $tmp_LOG_BASSDRIVE_count = $this->oCRNRSTN_USR->return_record_count('LOG_BASSDRIVE');
            $tmp_BASSDRIVE_STREAM_COLORS_count = $this->oCRNRSTN_USR->return_record_count('BASSDRIVE_STREAM_COLORS');
            $tmp_BASSDRIVE_STREAM_SOCIAL_CONFIG_count = $this->oCRNRSTN_USR->return_record_count('BASSDRIVE_STREAM_SOCIAL_CONFIG');

            for($i = 0; $i<$tmp_LOG_BASSDRIVE_count; $i++){

                //
                // 4500.
                $tmp_BASSDRIVE_LOG_ID = trim($this->oCRNRSTN_USR->return_database_value('LOG_BASSDRIVE', 'BASSDRIVE_LOG_ID', $i));
                $tmp_title = trim($this->oCRNRSTN_USR->return_database_value('LOG_BASSDRIVE', 'PROGRAM_TITLE', $i));

                error_log(__LINE__ . ' user $tmp_title=[' . $tmp_title . '] $tmp_BASSDRIVE_LOG_ID=[' . $tmp_BASSDRIVE_LOG_ID . ']');
                $tmp_json = $this->oCRNRSTN_USR->return_database_value('LOG_BASSDRIVE', 'STREAM_RELAY_JSON', $i);

                if(!isset($this->oRELAY_MANAGER)){

                    $this->oRELAY_MANAGER = new crnrstn_bassdrive_stream_relay_manager($this->oCRNRSTN_USR, $tmp_json);

                }

                //
                // DETERMINE SHOW PROFILE KEY (BASSDRIVE_STREAM.STREAM_KEY) FROM TITLE.
                if((strlen($tmp_title) < 3) || (strlen($tmp_json) < 42)){

                    if(strlen($tmp_json) < 42){

                        $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();

                        //
                        // SKIP THIS RECORD OR UPDATE TO ISACTIVE=4
                        $tmp_log_state_sync_SQL .= 'UPDATE `crnrstn_global_bassdrive_log`
                        SET
                        `ISACTIVE` = 4,
                        `PROCESSING_STATE` = "NULL OR MALFORMED JSON RESPONSE",
                        `STATUS_MESSAGE` = "Processing of JSON canceled and Bassdrive log deactivated.",
                        `DATEMODIFIED` = "' . $ts . '"
                        WHERE `crnrstn_global_bassdrive_log`.`BASSDRIVE_LOG_ID` = "' . $tmp_BASSDRIVE_LOG_ID . '" LIMIT 1;
                        ';

                    }else{

                        //
                        // ATTEMPT TO EXTRACT TITLE FROM JSON
                        error_log('[149 '. __METHOD__ .' hello!]');
                        if($this->oRELAY_MANAGER->is_valid_bassdrive_json($tmp_json)){

                            $tmp_orelay = $this->oRELAY_MANAGER->return_relay_for_logging();

                            $tmp_title = trim($tmp_orelay->return_stream_title());

                            if(strlen($tmp_title) < 3){

                                $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();

                                $tmp_query_count++;
                                $tmp_log_state_sync_SQL .= 'UPDATE `crnrstn_global_bassdrive_log`
                                SET
                                `ISACTIVE` = 4,
                                `PROCESSING_STATE` = "UNRECOGNIZED BASSDRIVE JSON RESPONSE",
                                `STATUS_MESSAGE` =  "' . $this->oRELAY_MANAGER->return_relay_ojson_err() . ' Processing of JSON canceled and Bassdrive log deactivated.",
                                `DATEMODIFIED` = "' . $ts . '"
                                WHERE `BASSDRIVE_LOG_ID` = "' . $tmp_BASSDRIVE_LOG_ID . '" LIMIT 1;
                                ';

                            }

                        }else{

                            $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();

                            $tmp_query_count++;
                            $tmp_log_state_sync_SQL .= 'UPDATE `crnrstn_global_bassdrive_log`
                            SET
                            `ISACTIVE` = 4,
                            `PROCESSING_STATE` = "INVALID BASSDRIVE JSON RESPONSE",
                            `STATUS_MESSAGE` = "' . $this->oRELAY_MANAGER->return_relay_ojson_err() . ' Processing of JSON canceled and Bassdrive log deactivated.",
                            `DATEMODIFIED` = "' . $ts . '"
                            WHERE `BASSDRIVE_LOG_ID` = "' . $tmp_BASSDRIVE_LOG_ID . '" LIMIT 1;
                            ';

                        }

                    }

                }

//                if(strlen($tmp_title) > 3){
//
//                    //
//                    // RETURN RELAY HISTORY OUTPUT
//                    $tmp_html_output .= $this->oRELAY_MANAGER->return_relay_history_html($tmp_title, $tmp_BASSDRIVE_LOG_ID);
//
//                    $tmp_LOG_PROCESSED_ID = $this->oCRNRSTN_USR->generate_new_key(64);
//
//                    $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();
//
//                    $tmp_query_count++;
//                    $tmp_log_state_sync_SQL .= 'INSERT INTO `crnrstn_global_bassdrive_log_processed`
//                    (`LOG_PROCESSED_ID`,
//                    `BASSDRIVE_LOG_ID`,
//                    `BASSDRIVE_LOG_ID_CRC32`,
//                    `DATEMODIFIED`)
//                    VALUES
//                    ("' . $tmp_LOG_PROCESSED_ID . '",
//                    "' . $tmp_BASSDRIVE_LOG_ID . '",
//                    "' . $this->oCRNRSTN_USR->crcINT($tmp_BASSDRIVE_LOG_ID) . '",
//                    "' . $ts . '");
//                    ';
//
//                }
//
//                if($tmp_query_count > $tmp_query_batch_size){
//
//                    $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('BATCH_UPDATE', '!jesus_my_dear_lord!', '', __LINE__, __METHOD__);
//                    $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_log_state_sync_SQL);
//
//                    //
//                    // PROCESS ALL QUERY
//                    $this->oCRNRSTN_USR->process_query(true);
//
//                    $tmp_query_count = 0;
//                    $tmp_log_state_sync_SQL = '';
//
//                }

            }

            //
            // CLEAR UP ANY REMAINING QUERY
            if(strlen($tmp_log_state_sync_SQL) > 0){

                $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('BATCH_UPDATE', '!jesus_my_dear_lord!', '', __LINE__, __METHOD__);
                $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_log_state_sync_SQL);

                //
                // PROCESS ALL QUERY
                $this->oCRNRSTN_USR->process_query(true);

            }

            return '[' . $this->oCRNRSTN_USR->return_micro_time() . '] LOG_BASSDRIVE[' . $tmp_LOG_BASSDRIVE_count . '] BASSDRIVE_STREAM_COLORS[' . $tmp_BASSDRIVE_STREAM_COLORS_count . '] BASSDRIVE_STREAM_SOCIAL_CONFIG[' . $tmp_BASSDRIVE_STREAM_SOCIAL_CONFIG_count . ']<br><br>' . $tmp_html_output;

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    private function return_relay_stream_key($PROGRAM_TITLE){

        $oCRNRSTN_MySQLi = $this->oCRNRSTN_USR->return_crnrstn_mysqli();
        $mysqli = $oCRNRSTN_MySQLi->return_conn_object();

        $tmp_pattern_count = $this->oCRNRSTN_USR->return_record_count('BASSDRIVE_STREAM_KEY_PATTERN_LOOKUP');
        for($i = 0; $i < $tmp_pattern_count; $i++){

            $tmp_STREAM_KEY = $this->oCRNRSTN_USR->return_database_value('BASSDRIVE_STREAM_KEY_PATTERN_LOOKUP', 'STREAM_KEY', $i);
            $tmp_STRING_PATTERN = $this->oCRNRSTN_USR->return_database_value('BASSDRIVE_STREAM_KEY_PATTERN_LOOKUP', 'STRING_PATTERN', $i);

            $pos = stripos($PROGRAM_TITLE, $tmp_STRING_PATTERN);
            if($pos !== false){

                //
                // CONFIRM STREAM KEY MATCH IS IN META LOOKUP TABLE.
                // IF NOT, ADD NEW STREAM KEY TO LOOKUP TABLE
                $tmp_query = 'SELECT `crnrstn_stream_relay_meta_lookup`.`STREAM_KEY`
                FROM `crnrstn_stream_relay_meta_lookup`
                WHERE `crnrstn_stream_relay_meta_lookup`.`STREAM_KEY` = "' . $mysqli->real_escape_string($tmp_STREAM_KEY) . '"
                AND `crnrstn_stream_relay_meta_lookup`.`STREAM_KEY_CRC32` = "' . $this->oCRNRSTN_USR->crcINT($tmp_STREAM_KEY) . '"
                AND (`crnrstn_stream_relay_meta_lookup`.`ISACTIVE` = 1 OR `crnrstn_stream_relay_meta_lookup`.`ISACTIVE` = 8 ) LIMIT 1;';
                $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!!!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                //
                // PROCESS ALL QUERY TO CONNECTION(S)
                $this->oCRNRSTN_USR->process_query();

                $tmp_META_STREAM_KEY_RESULT_count = $this->oCRNRSTN_USR->return_record_count($tmp_result_set_key);

                if(($tmp_META_STREAM_KEY_RESULT_count < 1)){

                    //
                    // INSERT NEW STREAM RELAY WITH REPORTING LOOKUP AT THIS SHARD ADDRESS
                    $tmp_META_LOOKUP_ID = $this->oCRNRSTN_USR->generate_new_key(64);
                    $tmp_META_LOOKUP_ID = $this->oCRNRSTN_USR->return_valid_primary_key($tmp_META_LOOKUP_ID, 'char', 64, 'crnrstn_stream_relay_meta_lookup', 'META_LOOKUP_ID');

                    //
                    // OLD SCHOOL GRACEFUL DEGRADE FOR IF SOME KIND OF RUNTIME DATABASE ERROR SPOILS THE NEW SERIAL
                    // GENERATION BUT MAYBE THIS COULD STILL WORK.
                    $tmp_META_LOOKUP_ID = $this->oCRNRSTN_USR->valid_primary_key_check($tmp_META_LOOKUP_ID, 'char', 64);

                    if(!$this->oCRNRSTN_USR->table_field_value_exists($tmp_STREAM_KEY, 'crnrstn_stream_relay_meta_lookup', 'STREAM_KEY' , 'STREAM_KEY_CRC32')){

                        $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();
                        $tmp_query = 'INSERT INTO `crnrstn_stream_relay_meta_lookup`
                        (`META_LOOKUP_ID`,
                        `STREAM_KEY`,
                        `STREAM_KEY_CRC32`,
                        `DATEMODIFIED`)
                        VALUES
                        ("' . $tmp_META_LOOKUP_ID . '",
                        "' . $mysqli->real_escape_string($tmp_STREAM_KEY) . '",
                        "' . $this->oCRNRSTN_USR->crcINT($tmp_STREAM_KEY) . '",
                        "' . $ts . '");';
                        $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                        $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                        //
                        // PROCESS ALL QUERY TO CONNECTION(S)
                        $this->oCRNRSTN_USR->process_query();

                    }

                }

                return $tmp_STREAM_KEY;

            }

        }

        return '';

    }

    private function return_MONTH_ARRAY(){

        $tmp_array = array();

        $tmp_array[] = 'Jan';
        $tmp_array[] = 'Feb';
        $tmp_array[] = 'Mar';
        $tmp_array[] = 'Apr';
        $tmp_array[] = 'May';
        $tmp_array[] = 'Jun';
        $tmp_array[] = 'Jul';
        $tmp_array[] = 'Aug';
        $tmp_array[] = 'Sept';
        $tmp_array[] = 'Oct';
        $tmp_array[] = 'Nov';
        $tmp_array[] = 'Dec';

        return $tmp_array;

    }

    private function return_DAY_ARRAY(){

        $tmp_array = array();

        for($i = 31; $i > 0; $i--){

            $tmp_array[] = $i;

        }

        return $tmp_array;

    }

    public function program_is_replay_status($tmp_PROGRAM_TITLE){

        $bassdrive_month = $this->return_MONTH_ARRAY();
        $bassdrive_day = $this->return_DAY_ARRAY();
        $tmp_MONTH_cnt = sizeof($bassdrive_month);
        $tmp_DAY_cnt = sizeof($bassdrive_day);

        //
        // IS REPLAY HTML INDICATOR
        for($i = 0; $i < $tmp_MONTH_cnt; $i++){

            for($ii = 0; $ii < $tmp_DAY_cnt; $ii++){

                $tmp_date_pos = stripos($tmp_PROGRAM_TITLE, $bassdrive_month[$i].' ' . $bassdrive_day[$ii]);
                if($tmp_date_pos !== false){

                    // TRUE
                    return 1;

                }

            }

        }

        // FALSE
        return 0;

    }

    public function relay_sync_bassdrive_log(){

        try{

            $oCRNRSTN_MySQLi = $this->oCRNRSTN_USR->return_crnrstn_mysqli();
            $mysqli = $oCRNRSTN_MySQLi->return_conn_object();

            $this->oCRNRSTN_USR->load_query_profile('BASSDRIVE_DATA', '!jesus_is_my_dear_lord!', 'LOG_BASSDRIVE');
            $this->oCRNRSTN_USR->load_query_profile('BASSDRIVE_DATA', '!jesus_is_my_dear_lord!', 'BASSDRIVE_STREAM_KEY_PATTERN_LOOKUP');

            $this->oCRNRSTN_USR->add_database_query('LOG_BASSDRIVE');
            $this->oCRNRSTN_USR->add_database_query('BASSDRIVE_STREAM_KEY_PATTERN_LOOKUP');

            //
            // PROCESS ALL QUERY TO CONNECTION(S)
            $this->oCRNRSTN_USR->process_query();

            $tmp_LOG_BASSDRIVE_count = $this->oCRNRSTN_USR->return_record_count('LOG_BASSDRIVE');
            $tmp_TABLE_STRING_PATTERN = '';

            //
            // FOR EACH BASSDRIVE LOG ENTRY RETURNED
            // 4500 WAS THE OLD PULL AMOUNT EVERY JSON LOG DRIVEN HTML HISTORY UPDATE...6600-ISH BEFORE THAT LIMIT WAS IMPOSED.
            for($i = 0; $i < $tmp_LOG_BASSDRIVE_count; $i++) {

                $tmp_BASSDRIVE_LOG_ID = trim($this->oCRNRSTN_USR->return_database_value('LOG_BASSDRIVE', 'BASSDRIVE_LOG_ID', $i));
                $tmp_PROGRAM_TITLE = trim($this->oCRNRSTN_USR->return_database_value('LOG_BASSDRIVE', 'PROGRAM_TITLE', $i));
                $tmp_STREAM_RELAY_JSON = $this->oCRNRSTN_USR->return_database_value('LOG_BASSDRIVE', 'STREAM_RELAY_JSON', $i);
                $tmp_DATEMODIFIED = trim($this->oCRNRSTN_USR->return_database_value('LOG_BASSDRIVE', 'DATEMODIFIED', $i));
                $tmp_IS_REPLAY = $this->program_is_replay_status($tmp_PROGRAM_TITLE);

                //
                // IDENTIFY RELAY STREAM STREAM_KEY (SHOW KEY) BEFORE JSON CONSUMPTION
                $tmp_STREAM_KEY = $this->return_relay_stream_key($tmp_PROGRAM_TITLE);

                //
                // IF STREAM KEY UNDETERMINED, THROW EXCEPTION AND SPOIL THIS RECORD.
                if(strlen($tmp_STREAM_KEY) < 3){

                    //
                    // INSERT AND/OR RETRIEVE STREAM REPORTING TABLE NAME STRING
                    $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();
                    $tmp_query = 'UPDATE `crnrstn_global_bassdrive_log`
                    SET
                    `PROCESSING_STATE` = "STREAM KEY UNKNOWN",
                    `STATUS_MESSAGE` = "Unable to determine stream key with program title string pattern matching against the database.",
                    `DATEMODIFIED` = "' . $ts . '"
                    WHERE `crnrstn_global_bassdrive_log`.`BASSDRIVE_LOG_ID` = "' . $tmp_BASSDRIVE_LOG_ID. '"
                    AND `crnrstn_global_bassdrive_log`.`BASSDRIVE_LOG_ID_CRC32` = "' . $this->oCRNRSTN_USR->crcINT($tmp_BASSDRIVE_LOG_ID) . '"
                    AND `crnrstn_global_bassdrive_log`.`ISACTIVE` = 1 LIMIT 1;';
                    $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                    $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                    //
                    // PROCESS ALL QUERY TO CONNECTION(S)
                    $this->oCRNRSTN_USR->process_query(true);

                    //throw new Exception('Unable to determine Bassdrive stream key from JSON log data for ' . $tmp_PROGRAM_TITLE . '. Where crnrstn_global_bassdrive_log.BASSDRIVE_LOG_ID=[' . $tmp_BASSDRIVE_LOG_ID . '].');

                }

                if($i == 0){

                    //
                    // SET ISACTIVE TO 1
                    $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();
                    $tmp_query = 'UPDATE `crnrstn_stream_relay_meta_lookup`
                    SET
                    `ISACTIVE` = 1,
                    `DATEMODIFIED` = "' . $ts . '"
                     WHERE `ISACTIVE` = 8 LIMIT 1;';
                    $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                    $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                    //
                    // PROCESS ALL QUERY TO CONNECTION(S)
                    $this->oCRNRSTN_USR->process_query();

                    $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();
                    $tmp_query = 'UPDATE `crnrstn_stream_relay_meta_lookup`
                    SET
                    `ISACTIVE` = 8,
                    `DATEMODIFIED` = "' . $ts . '"
                    WHERE `STREAM_KEY` = "' . $tmp_STREAM_KEY . '"
                    AND `STREAM_KEY_CRC32` = "' . $this->oCRNRSTN_USR->crcINT($tmp_STREAM_KEY) . '" LIMIT 1;';
                    $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                    $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                    $tmp_json = json_decode($tmp_STREAM_RELAY_JSON, true);
                    $raw_json_relays = $tmp_json['relays'];
                    $raw_json_stats = $tmp_json['stats'];

                    $tmp_stats_loop_cnt = sizeof($raw_json_stats);
                    $tmp_relays_loop_cnt = sizeof($raw_json_relays);

                    //
                    // DATA CONTAINMENT STRUCTURES.
                    $tmp_bandwidth_ARRAY = array();
                    $tmp_bitrateFormat_ARRAY = array();
                    $tmp_bitrate_ARRAY = array();
                    $tmp_connections_ARRAY = array();
                    $tmp_capacity_ARRAY = array();
                    $tmp_bandwidthFormat_ARRAY = array();

                    //
                    // STATS EXTRACTION.
                    for($iiii = 0; $iiii < $tmp_stats_loop_cnt; $iiii++){

                        $tmp_name = $this->json_data_safe_extract($raw_json_stats, 'name', 'string', $iiii);    //$raw_json_stats[$iiii]['name'];
                        $tmp_name = strtolower($tmp_name);

                        switch($tmp_name){
                            case 'total':
                                /*
                                "stats" : [
                                    {
                                    "bandwidth" : 32.63,
                                    "connections" : 261,
                                    "name" : "Total",
                                    "capacity" : 20510,
                                    "bandwidthFormat" : "megabit"
                                    },

                                */

                                $tmp_bandwidth_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'bandwidth', 'double', $iiii);
                                $tmp_connections_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'connections', 'int', $iiii);
                                $tmp_capacity_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'capacity', 'int', $iiii);
                                $tmp_bandwidthFormat_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'bandwidthFormat', 'string', $iiii);

                            break;
                            case 'totalunique':
                                /*
                                "stats" : [
                                    {
                                        "bandwidth" : 21.75,
                                        "connections" : 174,
                                        "name" : "TotalUnique",
                                        "capacity" : 20510,
                                        "bandwidthFormat" : "megabit"
                                    },

                                */

                                $tmp_bandwidth_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'bandwidth', 'double', $iiii);
                                $tmp_connections_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'connections', 'int', $iiii);
                                $tmp_capacity_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'capacity', 'int', $iiii);
                                $tmp_bandwidthFormat_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'bandwidthFormat', 'string', $iiii);

                            break;
                            case 'premium':
                            case 'midgrade':
                            case 'aacplus':
                            case 'random':

                                /*
                                "stats" : [
                                    {
                                        "bandwidth" : 32.63,
                                        "connections" : 261,
                                        "name" : "Total",
                                        "capacity" : 20510,
                                        "bandwidthFormat" : "megabit"
                                    },
                                    {
                                        "bandwidth" : 21.75,
                                        "connections" : 174,
                                        "name" : "TotalUnique",
                                        "capacity" : 20510,
                                        "bandwidthFormat" : "megabit"
                                    },
                                    {
                                        "bandwidth" : 32.63,
                                        "bitrateFormat" : "kilobit",
                                        "bitrate" : 128,
                                        "connections" : 261,
                                        "name" : "Premium",
                                        "capacity" : 20510,
                                        "bandwidthFormat" : "megabit"
                                    },
                                    {
                                        "bandwidth" : 0,
                                        "bitrateFormat" : "kilobit",
                                        "bitrate" : 56,
                                        "connections" : 0,
                                        "name" : "Midgrade",
                                        "capacity" : 0,
                                        "bandwidthFormat" : "megabit"
                                    },
                                    {
                                        "bandwidth" : 0,
                                        "bitrateFormat" : "kilobit",
                                        "bitrate" : 32,
                                        "connections" : 0,
                                        "name" : "AACplus",
                                        "capacity" : 0,
                                        "bandwidthFormat" : "megabit"
                                    },
                                    {
                                        "bandwidth" : 0,
                                        "bitrateFormat" : "kilobit",
                                        "bitrate" : 128,
                                        "connections" : null,
                                        "name" : "Random",
                                        "capacity" : null,
                                        "bandwidthFormat" : "megabit"
                                    }
                                ],

                                */
                                $tmp_bandwidth_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'bandwidth', 'double', $iiii);
                                $tmp_bitrateFormat_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'bitrateFormat', 'string', $iiii);
                                $tmp_bitrate_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'bitrate', 'int', $iiii);
                                $tmp_connections_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'connections', 'int', $iiii);
                                $tmp_capacity_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'capacity', 'int', $iiii);
                                $tmp_bandwidthFormat_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'bandwidthFormat', 'string', $iiii);

                            break;

                        }

                    }

                    //$tmp_relay_is_synced = false;
                    for($iii = 0; $iii < $tmp_relays_loop_cnt; $iii++){

                        /*
                        "relays" : [
                            {
                                "bitrate" : "128",
                                "status" : "1",
                                "name" : "bassdrive.radioca.st:8702",
                                "listenerCount" : "76",
                                "listenerCountPercentage" : "0.76",
                                "audioFormat" : "mp3",
                                "streamURL" : "http:\/\/bassdrive.radioca.st:8702",
                                "streamURLios" : "http:\/\/bassdrive.radioca.st:8702",
                                "title" : "The jus on track show with Ashatack - Live"
                            },
                            {
                                "bitrate" : "128",
                                "status" : "1",
                                "name" : "chi.bassdrive.co:80",
                                "listenerCount" : "162",
                                "listenerCountPercentage" : "1.62",
                                "audioFormat" : "mp3",
                                "streamURL" : "http:\/\/chi.bassdrive.co:80",
                                "streamURLios" : "http:\/\/chi.bassdrive.co:80",
                                "title" : "The jus on track show with Ashatack - Live"
                            },
                            {
                                "bitrate" : "128",
                                "status" : 0,
                                "name" : "ice.bassdrive.net:80\/stream",
                                "listenerCount" : "0",
                                "listenerCountPercentage" : 0,
                                "audioFormat" : "mp3",
                                "streamURL" : "http:\/\/ice.bassdrive.net:80\/stream",
                                "streamURLios" : "http:\/\/ice.bassdrive.net:80\/stream",
                                "title" : ""
                            },
                            {
                                "bitrate" : "32",
                                "status" : 0,
                                "name" : "ice.bassdrive.net:80\/stream32",
                                "listenerCount" : "0",
                                "listenerCountPercentage" : 0,
                                "audioFormat" : "aac+",
                                "streamURL" : "http:\/\/ice.bassdrive.net:80\/stream32",
                                "streamURLios" : "http:\/\/ice.bassdrive.net:80\/stream32",
                                "title" : ""
                            },
                            {
                                "bitrate" : "56",
                                "status" : 0,
                                "name" : "ice.bassdrive.net:80\/stream56",
                                "listenerCount" : "0",
                                "listenerCountPercentage" : 0,
                                "audioFormat" : "mp3",
                                "streamURL" : "http:\/\/ice.bassdrive.net:80\/stream56",
                                "streamURLios" : "http:\/\/ice.bassdrive.net:80\/stream56",
                                "title" : ""
                            },
                            {
                                "bitrate" : "128",
                                "status" : "1",
                                "name" : "stream.bassdrive.uk:8200",
                                "listenerCount" : "23",
                                "listenerCountPercentage" : "4.49",
                                "audioFormat" : "mp3",
                                "streamURL" : "http:\/\/stream.bassdrive.uk:8200",
                                "streamURLios" : "http:\/\/stream.bassdrive.uk:8200",
                                "title" : "The jus on track show with Ashatack - Live"
                            }
                        ],

                        */

                        $tmp_bitrate = $this->json_data_safe_extract($raw_json_relays, 'bitrate', 'int', $iii);
                        $tmp_status = $this->json_data_safe_extract($raw_json_relays, 'status', 'int', $iii);

                        if($tmp_status == 1 || $tmp_status == '1'){

                            $tmp_name = $this->json_data_safe_extract($raw_json_relays, 'name', 'string', $iii);
                            $tmp_listenerCount = $this->json_data_safe_extract($raw_json_relays, 'listenerCount', 'int', $iii);
                            $tmp_listenerCountPercentage = $this->json_data_safe_extract($raw_json_relays, 'listenerCountPercentage', 'double', $iii);
                            $tmp_audioFormat = $this->json_data_safe_extract($raw_json_relays, 'audioFormat', 'string', $iii);
                            $tmp_streamURL = $this->json_data_safe_extract($raw_json_relays, 'streamURL', 'string', $iii);
                            $tmp_streamURLios = $this->json_data_safe_extract($raw_json_relays, 'streamURLios', 'string', $iii);
                            $tmp_title = $this->json_data_safe_extract($raw_json_relays, 'title', 'string', $iii);

                            if($this->oCRNRSTN_USR->table_field_value_exists($tmp_streamURL, 'crnrstn_stream_relay', 'STREAM_URL' , 'STREAM_URL_CRC32')){

                                //
                                // UPDATE ACTIVE STREAM METRICS
                                $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();
                                $tmp_query = 'UPDATE `crnrstn_stream_relay`
                                SET
                                `BASSDRIVE_LOG_ID` = "' . $mysqli->real_escape_string($tmp_BASSDRIVE_LOG_ID) . '",
                                `LISTENER_COUNT` = "' . $mysqli->real_escape_string($tmp_listenerCount) . '",
                                `LISTENER_COUNT_PERCENTAGE` = "' . $mysqli->real_escape_string($tmp_listenerCountPercentage) . '",
                                `AUDIO_FORMAT` = "' . $mysqli->real_escape_string($tmp_audioFormat) . '",
                                `TITLE` = "' . $mysqli->real_escape_string($tmp_title) . '",
                                `TITLE_CHECKSUM_MD5` = UNHEX(\'' . $this->oCRNRSTN_USR->hash($tmp_title, 'md5') . '\'),
                                `STREAM_KEY` = "' . $mysqli->real_escape_string($tmp_STREAM_KEY) . '",
                                `STREAM_KEY_MD5` = UNHEX(\'' . $this->oCRNRSTN_USR->hash($tmp_STREAM_KEY, 'md5') . '\'),
                                `IS_REPLAY` = ' . $tmp_IS_REPLAY . ',
                                `STATS_TOTAL_CONNECTIONS` = "' . $mysqli->real_escape_string($tmp_connections_ARRAY['total']) . '",
                                `STATS_TOTAL_CAPACITY` = "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['total']) . '",
                                `STATS_TOTAL_BANDWIDTH` = "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['total']) . '",
                                `STATS_TOTAL_BANDWIDTH_FORMAT` = "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['total']) . '",
                                `STATS_TOTAL_UNIQUE_CONNECTIONS` = "' . $mysqli->real_escape_string($tmp_connections_ARRAY['totalunique']) . '",
                                `STATS_TOTAL_UNIQUE_CAPACITY` = "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['totalunique']) . '",
                                `STATS_TOTAL_UNIQUE_BANDWIDTH` = "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['totalunique']) . '",
                                `STATS_TOTAL_UNIQUE_BANDWIDTH_FORMAT` = "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['totalunique']) . '",
                                `STATS_PREMIUM_BITRATE` = "' . $mysqli->real_escape_string($tmp_bitrate_ARRAY['premium']) . '",
                                `STATS_PREMIUM_BITRATE_FORMAT` = "' . $mysqli->real_escape_string($tmp_bitrateFormat_ARRAY['premium']) . '",
                                `STATS_PREMIUM_CONNECTIONS` = "' . $mysqli->real_escape_string($tmp_connections_ARRAY['premium']) . '",
                                `STATS_PREMIUM_CAPACITY` = "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['premium']) . '",
                                `STATS_PREMIUM_BANDWIDTH` = "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['premium']) . '",
                                `STATS_PREMIUM_BANDWIDTH_FORMAT` = "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['premium']) . '",
                                `STATS_MIDGRADE_BITRATE` = "' . $mysqli->real_escape_string($tmp_bitrate_ARRAY['midgrade']) . '",
                                `STATS_MIDGRADE_BITRATE_FORMAT` = "' . $mysqli->real_escape_string($tmp_bitrateFormat_ARRAY['midgrade']) . '",
                                `STATS_MIDGRADE_CONNECTIONS` = "' . $mysqli->real_escape_string($tmp_connections_ARRAY['midgrade']) . '",
                                `STATS_MIDGRADE_CAPACITY` = "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['midgrade']) . '",
                                `STATS_MIDGRADE_BANDWIDTH` = "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['midgrade']) . '",
                                `STATS_MIDGRADE_BANDWIDTH_FORMAT` = "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['midgrade']) . '",
                                `STATS_AAC_PLUS_BITRATE` = "' . $mysqli->real_escape_string($tmp_bitrate_ARRAY['aacplus']) . '",
                                `STATS_AAC_PLUS_BITRATE_FORMAT` = "' . $mysqli->real_escape_string($tmp_bitrateFormat_ARRAY['aacplus']) . '",
                                `STATS_AAC_PLUS_CONNECTIONS` = "' . $mysqli->real_escape_string($tmp_connections_ARRAY['aacplus']) . '",
                                `STATS_AAC_PLUS_CAPACITY` = "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['aacplus']) . '",
                                `STATS_AAC_PLUS_BANDWIDTH` = "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['aacplus']) . '",
                                `STATS_AAC_PLUS_BANDWIDTH_FORMAT` = "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['aacplus']) . '",
                                `STATS_RANDOM_BITRATE` = "' . $mysqli->real_escape_string($tmp_bitrate_ARRAY['random']) . '",
                                `STATS_RANDOM_BITRATE_FORMAT` = "' . $mysqli->real_escape_string($tmp_bitrateFormat_ARRAY['random']) . '",
                                `STATS_RANDOM_CONNECTIONS` = "' . $mysqli->real_escape_string($tmp_connections_ARRAY['random']) . '",
                                `STATS_RANDOM_CAPACITY` = "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['random']) . '",
                                `STATS_RANDOM_BANDWIDTH` = "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['random']) . '",
                                `STATS_RANDOM_BANDWIDTH_FORMAT` = "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['random']) . '",
                                `DATEMODIFIED` = "' . $ts . '"
                                WHERE `RELAY_TYPE` = "BASSDRIVE"
                                AND `STREAM_URL` = "' . $mysqli->real_escape_string($tmp_streamURL) . '"
                                AND `STREAM_URL_CRC32` = "' . $this->oCRNRSTN_USR->crcINT($tmp_streamURL) . '"LIMIT 1;';
                                $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', 'jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                                $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                            }

                        }

                    }

                    //
                    // PROCESS ALL QUERY TO CONNECTION(S)
                    $this->oCRNRSTN_USR->process_query();

                }

                //
                // INSERT AND/OR RETRIEVE STREAM REPORTING TABLE NAME STRING
                $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();
                $tmp_query = 'SELECT `crnrstn_stream_relay_meta_lookup`.`META_LOOKUP_ID`,
                    `crnrstn_stream_relay_meta_lookup`.`STREAM_KEY`,
                    `crnrstn_stream_relay_meta_lookup`.`STREAM_KEY_CRC32`,
                    `crnrstn_stream_relay_meta_lookup`.`ISACTIVE`,
                    `crnrstn_stream_relay_meta_lookup`.`RELAY_REPORTING_SHARD_ID`,
                    `crnrstn_stream_relay_meta_lookup`.`LOCALE_ID`,
                    `crnrstn_stream_relay_meta_lookup`.`ABOUT_ID`,
                    `crnrstn_stream_relay_meta_lookup`.`COLORS_ID`,
                    `crnrstn_stream_relay_meta_lookup`.`STREAM_COLORS_KEY`,
                    `crnrstn_stream_relay_meta_lookup`.`DATEMODIFIED`,
                    `crnrstn_stream_relay_meta_lookup`.`DATECREATED`
                FROM `crnrstn_stream_relay_meta_lookup`
                WHERE `crnrstn_stream_relay_meta_lookup`.`STREAM_KEY` = "' . $mysqli->real_escape_string($tmp_STREAM_KEY) . '"
                AND `crnrstn_stream_relay_meta_lookup`.`STREAM_KEY_CRC32` = "' . $this->oCRNRSTN_USR->crcINT($tmp_STREAM_KEY) . '"
                AND (`crnrstn_stream_relay_meta_lookup`.`ISACTIVE` = 1 OR `crnrstn_stream_relay_meta_lookup`.`ISACTIVE` = 8) LIMIT 1;';
                $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                //
                // PROCESS ALL QUERY TO CONNECTION(S)
                $this->oCRNRSTN_USR->process_query();

                $tmp_STREAM_KEY_META_LOOKUP_count = $this->oCRNRSTN_USR->return_record_count($tmp_result_set_key);

                if($tmp_STREAM_KEY_META_LOOKUP_count > 0){

                    //
                    // WE HAVE META DATA. DO WE HAVE SHARD ID? RUN AN UPDATE.
                    $tmp_META_LOOKUP_ID = $this->oCRNRSTN_USR->return_database_value($tmp_result_set_key, 'META_LOOKUP_ID');
                    $tmp_STREAM_KEY = $this->oCRNRSTN_USR->return_database_value($tmp_result_set_key, 'STREAM_KEY');
                    $tmp_RELAY_REPORTING_SHARD_ID = $this->oCRNRSTN_USR->return_database_value($tmp_result_set_key, 'RELAY_REPORTING_SHARD_ID');

                    if(strlen($tmp_RELAY_REPORTING_SHARD_ID) < 64){

                        $tmp_query = 'SELECT `crnrstn_stream_relay_meta_lookup`.`RELAY_REPORTING_SHARD_ID`,
                        COUNT(*) AS SHARD_USE_COUNT
                        FROM `crnrstn_stream_relay_meta_lookup`
                        WHERE (`crnrstn_stream_relay_meta_lookup`.`ISACTIVE` = 1 OR `crnrstn_stream_relay_meta_lookup`.`ISACTIVE` = 8)
                        GROUP BY `crnrstn_stream_relay_meta_lookup`.`RELAY_REPORTING_SHARD_ID`
                        ORDER BY SHARD_USE_COUNT ASC LIMIT 1;';
                        $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!!!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                        $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                        //
                        // PROCESS ALL QUERY TO CONNECTION(S)
                        $this->oCRNRSTN_USR->process_query();

                        $tmp_RELAY_REPORTING_SHARD_ID = trim($this->oCRNRSTN_USR->return_database_value($tmp_result_set_key, 'RELAY_REPORTING_SHARD_ID'));
                        $tmp_STREAM_KEY_COUNT = trim($this->oCRNRSTN_USR->return_database_value($tmp_result_set_key, 'SHARD_USE_COUNT'));

                        if(($tmp_STREAM_KEY_COUNT < self::$data_shard_max_bassdrive_streams_cnt) && (strlen($tmp_RELAY_REPORTING_SHARD_ID)  >  30)){

                            //
                            // ADD THE CURRENT STREAM TO THIS REPORTING SHARD
                            $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();
                            $tmp_query = 'UPDATE `crnrstn_stream_relay_meta_lookup`
                            SET
                            `RELAY_REPORTING_SHARD_ID` = "' . $tmp_RELAY_REPORTING_SHARD_ID . '",
                            `DATEMODIFIED` = "' . $ts . '"
                            WHERE `crnrstn_stream_relay_meta_lookup`.`META_LOOKUP_ID` = "' . $tmp_META_LOOKUP_ID . '"
                            AND `crnrstn_stream_relay_meta_lookup`.`STREAM_KEY` = "' . $mysqli->real_escape_string($tmp_STREAM_KEY) . '"
                            AND `crnrstn_stream_relay_meta_lookup`.`STREAM_KEY_CRC32` = "' . $this->oCRNRSTN_USR->crcINT($tmp_STREAM_KEY) . '"
                            AND (`crnrstn_stream_relay_meta_lookup`.`ISACTIVE` = 1 OR `crnrstn_stream_relay_meta_lookup`.`ISACTIVE` = 8) LIMIT 1;';
                            $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                            $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                            //
                            // PROCESS ALL QUERY TO CONNECTION(S)
                            $this->oCRNRSTN_USR->process_query();

                        }else{

                            //
                            // WE DON'T HAVE A SHARD WITH CAPACITY TO HOLD THIS STREAM REPORTING DATA.
                            // ADD THE NECESSARY TABLES
                            // INSERT NEW STREAM RELAY WITH REPORTING LOOKUP AT THIS SHARD ADDRESS
                            $tmp_RELAY_REPORTING_SHARD_ID = $this->oCRNRSTN_USR->generate_new_key(64);
                            $tmp_RELAY_REPORTING_SHARD_ID = $this->oCRNRSTN_USR->return_valid_primary_key($tmp_RELAY_REPORTING_SHARD_ID, 'char', 64, 'crnrstn_stream_relay_reporting_shards', 'RELAY_REPORTING_SHARD_ID');

                            $tmp_TABLE_STRING_PATTERN = $this->oCRNRSTN_USR->generate_new_key(10, '01');
                            $tmp_TABLE_STRING_PATTERN = $this->oCRNRSTN_USR->return_valid_primary_key($tmp_TABLE_STRING_PATTERN, 'char', 10, 'crnrstn_stream_relay_reporting_shards', 'TABLE_STRING_PATTERN', 'TABLE_STRING_PATTERN_CRC32', '01');

                            //
                            // OLD SCHOOL GRACEFUL DEGRADE FOR IF SOME KIND OF RUNTIME DATABASE ERROR SPOILS THE NEW SERIAL
                            // GENERATION BUT MAYBE THIS COULD STILL WORK.
                            $tmp_RELAY_REPORTING_SHARD_ID = $this->oCRNRSTN_USR->valid_primary_key_check($tmp_RELAY_REPORTING_SHARD_ID, 'char', 64);
                            $tmp_TABLE_STRING_PATTERN = $this->oCRNRSTN_USR->valid_primary_key_check($tmp_TABLE_STRING_PATTERN, 'char', 10, '01');

                            $tmp_query_DROP = 'DROP TABLE IF EXISTS `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`;';
                            $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                            $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query_DROP);

                            $tmp_query = 'CREATE TABLE `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '` (
                                `REPORTING_LOG_ID` char(100) NOT NULL,
                                `REPORTING_LOG_ID_CRC32` int(11) UNSIGNED NOT NULL,
                                `STREAM_KEY` varchar(255) NOT NULL,
                                `STREAM_KEY_CRC32` int(11) UNSIGNED NOT NULL,
                                `IS_REPLAY` tinyint(2) UNSIGNED NOT NULL DEFAULT \'0\',
                                `RELAY_TIMESTAMP` datetime NOT NULL,
                                `BASSDRIVE_LOG_ID` char(100) NOT NULL,
                                `BASSDRIVE_LOG_ID_CRC32` int(11) UNSIGNED NOT NULL,
                                `ISACTIVE` tinyint(2) UNSIGNED NOT NULL DEFAULT \'1\',
                                `STREAM_URL` varchar(500) NOT NULL,
                                `STREAM_URL_IOS` varchar(500) DEFAULT NULL,
                                `BITRATE` int(11) UNSIGNED NOT NULL,
                                `AUDIO_FORMAT` varchar(25) NOT NULL,
                                `LISTENER_COUNT` int(11) UNSIGNED NOT NULL,
                                `LISTENER_COUNT_PERCENTAGE` double NOT NULL,
                                `TITLE` varchar(500) NOT NULL,
                                `STATS_TOTAL_CONNECTIONS` int(11) UNSIGNED NOT NULL,
                                `STATS_TOTAL_CAPACITY` int(11) UNSIGNED NOT NULL,
                                `STATS_TOTAL_BANDWIDTH` double NOT NULL,
                                `STATS_TOTAL_BANDWIDTH_FORMAT` varchar(25) NOT NULL,
                                `STATS_TOTAL_UNIQUE_CONNECTIONS` int(11) UNSIGNED NOT NULL,
                                `STATS_TOTAL_UNIQUE_CAPACITY` int(11) UNSIGNED NOT NULL,
                                `STATS_TOTAL_UNIQUE_BANDWIDTH` double NOT NULL,
                                `STATS_TOTAL_UNIQUE_BANDWIDTH_FORMAT` varchar(25) NOT NULL,
                                `STATS_PREMIUM_BITRATE` int(11) UNSIGNED DEFAULT NULL,
                                `STATS_PREMIUM_BITRATE_FORMAT` varchar(25) DEFAULT NULL,
                                `STATS_PREMIUM_CONNECTIONS` int(11) UNSIGNED DEFAULT NULL,
                                `STATS_PREMIUM_CAPACITY` int(11) UNSIGNED DEFAULT NULL,
                                `STATS_PREMIUM_BANDWIDTH` double DEFAULT NULL,
                                `STATS_PREMIUM_BANDWIDTH_FORMAT` varchar(25) DEFAULT NULL,
                                `STATS_MIDGRADE_BITRATE` int(11) UNSIGNED DEFAULT NULL,
                                `STATS_MIDGRADE_BITRATE_FORMAT` varchar(25) DEFAULT NULL,
                                `STATS_MIDGRADE_CONNECTIONS` int(11) UNSIGNED DEFAULT NULL,
                                `STATS_MIDGRADE_CAPACITY` int(11) UNSIGNED DEFAULT NULL,
                                `STATS_MIDGRADE_BANDWIDTH` double DEFAULT NULL,
                                `STATS_MIDGRADE_BANDWIDTH_FORMAT` varchar(25) DEFAULT NULL,
                                `STATS_AAC_PLUS_BITRATE` int(11) UNSIGNED DEFAULT NULL,
                                `STATS_AAC_PLUS_BITRATE_FORMAT` varchar(25) DEFAULT NULL,
                                `STATS_AAC_PLUS_CONNECTIONS` int(11) UNSIGNED DEFAULT NULL,
                                `STATS_AAC_PLUS_CAPACITY` int(11) UNSIGNED DEFAULT NULL,
                                `STATS_AAC_PLUS_BANDWIDTH` double DEFAULT NULL,
                                `STATS_AAC_PLUS_BANDWIDTH_FORMAT` varchar(25) DEFAULT NULL,
                                `STATS_RANDOM_BITRATE` int(11) UNSIGNED DEFAULT NULL,
                                `STATS_RANDOM_BITRATE_FORMAT` varchar(25) DEFAULT NULL,
                                `STATS_RANDOM_CONNECTIONS` int(11) UNSIGNED DEFAULT NULL,
                                `STATS_RANDOM_CAPACITY` int(11) UNSIGNED DEFAULT NULL,
                                `STATS_RANDOM_BANDWIDTH` double DEFAULT NULL,
                                `STATS_RANDOM_BANDWIDTH_FORMAT` varchar(25) DEFAULT NULL,
                                `DATEMODIFIED` datetime NOT NULL,
                                `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
                            ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT=\'Stream relay connections reporting shard.\';';
                            $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_RELAY_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                            $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                            $tmp_query = 'DROP TABLE IF EXISTS `crnrstn_stream_social_click_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`;';
                            $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!!jesus_is_my_dear_lord!123', '', __LINE__, __METHOD__);
                            $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                            $tmp_query = 'CREATE TABLE `crnrstn_stream_social_click_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '` (
                              `REPORTING_LOG_ID` char(100) NOT NULL,
                              `STREAM_KEY` varchar(255) NOT NULL,
                              `STREAM_KEY_CRC32` int(11) UNSIGNED NOT NULL,
                              `IS_REPLAY` tinyint(2) UNSIGNED NOT NULL DEFAULT \'0\',
                              `SOCIAL_MEDIA_KEY` varchar(100) NOT NULL,
                              `SOCIAL_MEDIA_KEY_CRC32` int(11) UNSIGNED NOT NULL,
                              `CLICKTHROUGH_URL` varchar(500) NOT NULL,
                              `CLICKTHROUGH_IP` int(11) UNSIGNED NOT NULL,
                              `CLICKTHROUGH_SERVER_ADDR` int(11) UNSIGNED NOT NULL,
                              `CLICKTHROUGH_PHPSESSION_ID` char(26) NOT NULL,
                              `CLICKTHROUGH_HTTP_REFERER` varchar(500) NOT NULL,
                              `CLICKTHROUGH_HTTP_USER_AGENT` varchar(500) NOT NULL,
                              `CLICKTHROUGH_DEVICE_TYPE` varchar(7) NOT NULL COMMENT \'[MOBILE, TABLET, DESKTOP]\',
                              `CLICKTHROUGH_LANG_PREFS` varchar(50) NOT NULL,
                              `DATEMODIFIED` datetime NOT NULL,
                              `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
                            ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT=\'Stream relay social link clickthrough data shard.\';';
                            $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_CLICK_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                            $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                            $tmp_query = 'ALTER TABLE `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`
                            ADD PRIMARY KEY (`REPORTING_LOG_ID`);';
                            $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                            $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                            $tmp_query = 'ALTER TABLE `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '` ADD INDEX( `STREAM_KEY`, `STREAM_KEY_CRC32`, `IS_REPLAY`, `RELAY_TIMESTAMP`);';
                            $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                            $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                            $tmp_query = 'ALTER TABLE `crnrstn_stream_social_click_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`
                            ADD PRIMARY KEY (`REPORTING_LOG_ID`);';
                            $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                            $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                            $tmp_query = 'ALTER TABLE `crnrstn_stream_social_click_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '` ADD INDEX( `STREAM_KEY`, `STREAM_KEY_CRC32`, `IS_REPLAY`);';
                            $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                            $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                            $tmp_query = 'ALTER TABLE `crnrstn_stream_social_click_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '` ADD INDEX( `STREAM_KEY`, `STREAM_KEY_CRC32`, `IS_REPLAY`, `SOCIAL_MEDIA_KEY`, `SOCIAL_MEDIA_KEY_CRC32`);';
                            $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                            $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                            //
                            // PROCESS ALL QUERY TO CONNECTION(S)
                            $this->oCRNRSTN_USR->process_query();

                            //
                            // SOURCE :: https://stackoverflow.com/questions/8829102/check-if-mysql-table-exists-without-using-select-from-syntax
                            // COMMENT :: https://stackoverflow.com/a/8829109
                            // AUTHOR :: Sergio Tulentsev :: https://stackoverflow.com/users/125816/sergio-tulentsev
                            // QUICK CHECK TO CONFIRM TABLE CREATION BEFORE INSERT
                            if($this->table_exists('crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN)){

                                $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();
                                $tmp_query = 'UPDATE `crnrstn_stream_relay_meta_lookup`
                                SET
                                `RELAY_REPORTING_SHARD_ID` = "' . $tmp_RELAY_REPORTING_SHARD_ID . '",
                                `DATEMODIFIED` = "' . $ts . '"
                                WHERE `crnrstn_stream_relay_meta_lookup`.`META_LOOKUP_ID` = "' . $tmp_META_LOOKUP_ID . '"
                                AND `crnrstn_stream_relay_meta_lookup`.`STREAM_KEY` = "' . $mysqli->real_escape_string($tmp_STREAM_KEY) . '"
                                AND `crnrstn_stream_relay_meta_lookup`.`STREAM_KEY_CRC32` = "' . $this->oCRNRSTN_USR->crcINT($tmp_STREAM_KEY) . '"
                                AND (`crnrstn_stream_relay_meta_lookup`.`ISACTIVE` = 1 OR `crnrstn_stream_relay_meta_lookup`.`ISACTIVE` = 8) LIMIT 1;';
                                $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                                $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                                $tmp_query = 'INSERT INTO `crnrstn_stream_relay_reporting_shards`
                                (`RELAY_REPORTING_SHARD_ID`,
                                `RELAY_REPORTING_SHARD_ID_CRC32`,
                                `TABLE_STRING_PATTERN`,
                                `TABLE_STRING_PATTERN_CRC32`,
                                `MAXIMUM_STREAM_COUNT`,
                                `DATEMODIFIED`)
                                VALUES
                                ("' . $tmp_RELAY_REPORTING_SHARD_ID . '",
                                "' . $this->oCRNRSTN_USR->crcINT($tmp_RELAY_REPORTING_SHARD_ID) . '",
                                "' . $tmp_TABLE_STRING_PATTERN . '",
                                "' . $this->oCRNRSTN_USR->crcINT($tmp_TABLE_STRING_PATTERN) . '",
                                "' . self::$data_shard_max_bassdrive_streams_cnt . '",
                                "' . $ts . '");';
                                $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                                $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                                //
                                // PROCESS ALL QUERY TO CONNECTION(S)
                                $this->oCRNRSTN_USR->process_query();

                            }else{

                                error_log(__LINE__ . ' THERE WAS AN ERROR :: CREATE TABLE crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN);

                            }

                        }

                    }

                    //
                    // GET TABLE PATTERN FROM $tmp_RELAY_REPORTING_SHARD_ID
                    $tmp_query = 'SELECT `crnrstn_stream_relay_reporting_shards`.`TABLE_STRING_PATTERN`
                    FROM `crnrstn_stream_relay_reporting_shards`
                    WHERE `crnrstn_stream_relay_reporting_shards`.`RELAY_REPORTING_SHARD_ID` = "' . $tmp_RELAY_REPORTING_SHARD_ID . '"
                    AND `crnrstn_stream_relay_reporting_shards`.`RELAY_REPORTING_SHARD_ID_CRC32` = "' . $this->oCRNRSTN_USR->crcINT($tmp_RELAY_REPORTING_SHARD_ID) . '"
                    AND `crnrstn_stream_relay_reporting_shards`.`ISACTIVE` = 1 LIMIT 1;';
                    $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', 'jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                    $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                    //
                    // PROCESS ALL QUERY TO CONNECTION(S)
                    $this->oCRNRSTN_USR->process_query();

                    $tmp_TABLE_STRING_PATTERN = trim($this->oCRNRSTN_USR->return_database_value($tmp_result_set_key, 'TABLE_STRING_PATTERN'));

                    if(strlen($tmp_TABLE_STRING_PATTERN) > 5){

                        //
                        // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
                        $tmp_json = json_decode($tmp_STREAM_RELAY_JSON, true);
                        $raw_json_relays = $tmp_json['relays'];
                        $raw_json_stats = $tmp_json['stats'];

                        $tmp_stats_loop_cnt = sizeof($raw_json_stats);
                        $tmp_relays_loop_cnt = sizeof($raw_json_relays);

                        //
                        // DATA CONTAINMENT STRUCTURES
                        $tmp_bandwidth_ARRAY = array();
                        $tmp_bitrateFormat_ARRAY = array();
                        $tmp_bitrate_ARRAY = array();
                        $tmp_connections_ARRAY = array();
                        $tmp_capacity_ARRAY = array();
                        $tmp_bandwidthFormat_ARRAY = array();

                        //
                        // STATS EXTRACTION
                        for($iiii = 0; $iiii < $tmp_stats_loop_cnt; $iiii++){

                            $tmp_name = $this->json_data_safe_extract($raw_json_stats, 'name', 'string', $iiii);    //$raw_json_stats[$iiii]['name'];
                            $tmp_name = strtolower($tmp_name);

                            switch($tmp_name){
                                case 'total':
                                    /*
                                    "stats" : [
                                        {
                                            "bandwidth" : 32.63,
                                            "connections" : 261,
                                            "name" : "Total",
                                            "capacity" : 20510,
                                            "bandwidthFormat" : "megabit"
                                        },

                                    */

                                    $tmp_bandwidth_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'bandwidth', 'double', $iiii);
                                    $tmp_connections_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'connections', 'int', $iiii);
                                    $tmp_capacity_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'capacity', 'int', $iiii);
                                    $tmp_bandwidthFormat_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'bandwidthFormat', 'string', $iiii);

                                break;
                                case 'totalunique':
                                    /*
                                    "stats" : [
                                        {
                                            "bandwidth" : 21.75,
                                            "connections" : 174,
                                            "name" : "TotalUnique",
                                            "capacity" : 20510,
                                            "bandwidthFormat" : "megabit"
                                        },

                                    */

                                    $tmp_bandwidth_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'bandwidth', 'double', $iiii);
                                    $tmp_connections_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'connections', 'int', $iiii);
                                    $tmp_capacity_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'capacity', 'int', $iiii);
                                    $tmp_bandwidthFormat_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'bandwidthFormat', 'string', $iiii);

                                break;
                                case 'premium':
                                case 'midgrade':
                                case 'aacplus':
                                case 'random':

                                    /*
                                    "stats" : [
                                        {
                                            "bandwidth" : 32.63,
                                            "connections" : 261,
                                            "name" : "Total",
                                            "capacity" : 20510,
                                            "bandwidthFormat" : "megabit"
                                        },
                                        {
                                            "bandwidth" : 21.75,
                                            "connections" : 174,
                                            "name" : "TotalUnique",
                                            "capacity" : 20510,
                                            "bandwidthFormat" : "megabit"
                                        },
                                        {
                                            "bandwidth" : 32.63,
                                            "bitrateFormat" : "kilobit",
                                            "bitrate" : 128,
                                            "connections" : 261,
                                            "name" : "Premium",
                                            "capacity" : 20510,
                                            "bandwidthFormat" : "megabit"
                                        },
                                        {
                                            "bandwidth" : 0,
                                            "bitrateFormat" : "kilobit",
                                            "bitrate" : 56,
                                            "connections" : 0,
                                            "name" : "Midgrade",
                                            "capacity" : 0,
                                            "bandwidthFormat" : "megabit"
                                        },
                                        {
                                            "bandwidth" : 0,
                                            "bitrateFormat" : "kilobit",
                                            "bitrate" : 32,
                                            "connections" : 0,
                                            "name" : "AACplus",
                                            "capacity" : 0,
                                            "bandwidthFormat" : "megabit"
                                        },
                                        {
                                            "bandwidth" : 0,
                                            "bitrateFormat" : "kilobit",
                                            "bitrate" : 128,
                                            "connections" : null,
                                            "name" : "Random",
                                            "capacity" : null,
                                            "bandwidthFormat" : "megabit"
                                        }
                                    ],

                                    */
                                    $tmp_bandwidth_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'bandwidth', 'double', $iiii);
                                    $tmp_bitrateFormat_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'bitrateFormat', 'string', $iiii);
                                    $tmp_bitrate_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'bitrate', 'int', $iiii);
                                    $tmp_connections_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'connections', 'int', $iiii);
                                    $tmp_capacity_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'capacity', 'int', $iiii);
                                    $tmp_bandwidthFormat_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'bandwidthFormat', 'string', $iiii);

                                break;

                            }

                        }

                        //$tmp_relay_is_synced = false;
                        for($iii = 0; $iii < $tmp_relays_loop_cnt; $iii++){

                            /*
                            "relays" : [
                                {
                                    "bitrate" : "128",
                                    "status" : "1",
                                    "name" : "bassdrive.radioca.st:8702",
                                    "listenerCount" : "76",
                                    "listenerCountPercentage" : "0.76",
                                    "audioFormat" : "mp3",
                                    "streamURL" : "http:\/\/bassdrive.radioca.st:8702",
                                    "streamURLios" : "http:\/\/bassdrive.radioca.st:8702",
                                    "title" : "The jus on track show with Ashatack - Live"
                                },
                                {
                                    "bitrate" : "128",
                                    "status" : "1",
                                    "name" : "chi.bassdrive.co:80",
                                    "listenerCount" : "162",
                                    "listenerCountPercentage" : "1.62",
                                    "audioFormat" : "mp3",
                                    "streamURL" : "http:\/\/chi.bassdrive.co:80",
                                    "streamURLios" : "http:\/\/chi.bassdrive.co:80",
                                    "title" : "The jus on track show with Ashatack - Live"
                                },
                                {
                                    "bitrate" : "128",
                                    "status" : 0,
                                    "name" : "ice.bassdrive.net:80\/stream",
                                    "listenerCount" : "0",
                                    "listenerCountPercentage" : 0,
                                    "audioFormat" : "mp3",
                                    "streamURL" : "http:\/\/ice.bassdrive.net:80\/stream",
                                    "streamURLios" : "http:\/\/ice.bassdrive.net:80\/stream",
                                    "title" : ""
                                },
                                {
                                    "bitrate" : "32",
                                    "status" : 0,
                                    "name" : "ice.bassdrive.net:80\/stream32",
                                    "listenerCount" : "0",
                                    "listenerCountPercentage" : 0,
                                    "audioFormat" : "aac+",
                                    "streamURL" : "http:\/\/ice.bassdrive.net:80\/stream32",
                                    "streamURLios" : "http:\/\/ice.bassdrive.net:80\/stream32",
                                    "title" : ""
                                },
                                {
                                    "bitrate" : "56",
                                    "status" : 0,
                                    "name" : "ice.bassdrive.net:80\/stream56",
                                    "listenerCount" : "0",
                                    "listenerCountPercentage" : 0,
                                    "audioFormat" : "mp3",
                                    "streamURL" : "http:\/\/ice.bassdrive.net:80\/stream56",
                                    "streamURLios" : "http:\/\/ice.bassdrive.net:80\/stream56",
                                    "title" : ""
                                },
                                {
                                    "bitrate" : "128",
                                    "status" : "1",
                                    "name" : "stream.bassdrive.uk:8200",
                                    "listenerCount" : "23",
                                    "listenerCountPercentage" : "4.49",
                                    "audioFormat" : "mp3",
                                    "streamURL" : "http:\/\/stream.bassdrive.uk:8200",
                                    "streamURLios" : "http:\/\/stream.bassdrive.uk:8200",
                                    "title" : "The jus on track show with Ashatack - Live"
                                }
                            ],

                            */

                            $tmp_bitrate = $this->json_data_safe_extract($raw_json_relays, 'bitrate', 'int', $iii);
                            $tmp_status = $this->json_data_safe_extract($raw_json_relays, 'status', 'int', $iii);

                            if($tmp_status == 1 || $tmp_status == '1'){

                                $tmp_name = $this->json_data_safe_extract($raw_json_relays, 'name', 'string', $iii);
                                $tmp_listenerCount = $this->json_data_safe_extract($raw_json_relays, 'listenerCount', 'int', $iii);
                                $tmp_listenerCountPercentage = $this->json_data_safe_extract($raw_json_relays, 'listenerCountPercentage', 'double', $iii);
                                $tmp_audioFormat = $this->json_data_safe_extract($raw_json_relays, 'audioFormat', 'string', $iii);
                                $tmp_streamURL = $this->json_data_safe_extract($raw_json_relays, 'streamURL', 'string', $iii);
                                $tmp_streamURLios = $this->json_data_safe_extract($raw_json_relays, 'streamURLios', 'string', $iii);
                                $tmp_title = $this->json_data_safe_extract($raw_json_relays, 'title', 'string', $iii);

                                if(!$this->oCRNRSTN_USR->table_field_value_exists($tmp_streamURL, 'crnrstn_stream_relay', 'STREAM_URL' , 'STREAM_URL_CRC32')){

                                    $tmp_RELAY_ID = $this->oCRNRSTN_USR->generate_new_key(64);
                                    $tmp_RELAY_ID = $this->oCRNRSTN_USR->return_valid_primary_key($tmp_RELAY_ID, 'char', 64, 'crnrstn_stream_relay', 'RELAY_ID');

                                    //
                                    // OLD SCHOOL GRACEFUL DEGRADE FOR IF SOME KIND OF RUNTIME DATABASE ERROR SPOILS THE NEW SERIAL
                                    // GENERATION BUT MAYBE THIS COULD STILL WORK.
                                    $tmp_RELAY_ID = $this->oCRNRSTN_USR->valid_primary_key_check($tmp_RELAY_ID, 'char', 64);

                                    //
                                    // INSERT NEW RELAY PROFILE DATA
                                    $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();
                                    $tmp_query = 'INSERT INTO `crnrstn_stream_relay`
                                    (`RELAY_ID`,
                                    `STREAM_URL`,
                                    `STREAM_URL_CRC32`,
                                    `STREAM_URL_IOS`,
                                    `BITRATE`,
                                    `STATUS`,
                                    `NAME`,
                                    `LISTENER_COUNT`,
                                    `LISTENER_COUNT_PERCENTAGE`,
                                    `AUDIO_FORMAT`,
                                    `TITLE`,
                                    `TITLE_CHECKSUM_MD5`,
                                    `STREAM_KEY`,
                                    `STREAM_KEY_MD5`,
                                    `IS_REPLAY`,
                                    `STATS_TOTAL_CONNECTIONS`,
                                    `STATS_TOTAL_CAPACITY`,
                                    `STATS_TOTAL_BANDWIDTH`,
                                    `STATS_TOTAL_BANDWIDTH_FORMAT`,
                                    `STATS_TOTAL_UNIQUE_CONNECTIONS`,
                                    `STATS_TOTAL_UNIQUE_CAPACITY`,
                                    `STATS_TOTAL_UNIQUE_BANDWIDTH`,
                                    `STATS_TOTAL_UNIQUE_BANDWIDTH_FORMAT`,
                                    `STATS_PREMIUM_BITRATE`,
                                    `STATS_PREMIUM_BITRATE_FORMAT`,
                                    `STATS_PREMIUM_CONNECTIONS`,
                                    `STATS_PREMIUM_CAPACITY`,
                                    `STATS_PREMIUM_BANDWIDTH`,
                                    `STATS_PREMIUM_BANDWIDTH_FORMAT`,
                                    `STATS_MIDGRADE_BITRATE`,
                                    `STATS_MIDGRADE_BITRATE_FORMAT`,
                                    `STATS_MIDGRADE_CONNECTIONS`,
                                    `STATS_MIDGRADE_CAPACITY`,
                                    `STATS_MIDGRADE_BANDWIDTH`,
                                    `STATS_MIDGRADE_BANDWIDTH_FORMAT`,
                                    `STATS_AAC_PLUS_BITRATE`,
                                    `STATS_AAC_PLUS_BITRATE_FORMAT`,
                                    `STATS_AAC_PLUS_CONNECTIONS`,
                                    `STATS_AAC_PLUS_CAPACITY`,
                                    `STATS_AAC_PLUS_BANDWIDTH`,
                                    `STATS_AAC_PLUS_BANDWIDTH_FORMAT`,
                                    `STATS_RANDOM_BITRATE`,
                                    `STATS_RANDOM_BITRATE_FORMAT`,
                                    `STATS_RANDOM_CONNECTIONS`,
                                    `STATS_RANDOM_CAPACITY`,
                                    `STATS_RANDOM_BANDWIDTH`,
                                    `STATS_RANDOM_BANDWIDTH_FORMAT`,
                                    `DATEMODIFIED`)
                                    VALUES
                                    ("' . $tmp_RELAY_ID . '",
                                    "' . $mysqli->real_escape_string($tmp_streamURL) . '",
                                    "' . $this->oCRNRSTN_USR->crcINT($tmp_streamURL) . '",
                                    "' . $mysqli->real_escape_string($tmp_streamURLios) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrate) . '",
                                    "' . $mysqli->real_escape_string($tmp_status) . '",
                                    "' . $mysqli->real_escape_string($tmp_name) . '",
                                    "' . $mysqli->real_escape_string($tmp_listenerCount) . '",
                                    "' . $mysqli->real_escape_string($tmp_listenerCountPercentage) . '",
                                    "' . $mysqli->real_escape_string($tmp_audioFormat) . '",
                                    "' . $mysqli->real_escape_string($tmp_title) . '",
                                    UNHEX(\'' . $this->oCRNRSTN_USR->hash($tmp_title, 'md5') . '\'),
                                    "' . $mysqli->real_escape_string($tmp_STREAM_KEY) . '",
                                    UNHEX(\'' . $this->oCRNRSTN_USR->hash($tmp_STREAM_KEY, 'md5') . '\'),
                                    ' . $tmp_IS_REPLAY . ',
                                    "' . $mysqli->real_escape_string($tmp_connections_ARRAY['total']) . '",
                                    "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['total']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['total']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['total']) . '",
                                    "' . $mysqli->real_escape_string($tmp_connections_ARRAY['totalunique']) . '",
                                    "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['totalunique']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['totalunique']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['totalunique']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrate_ARRAY['premium']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrateFormat_ARRAY['premium']) . '",
                                    "' . $mysqli->real_escape_string($tmp_connections_ARRAY['premium']) . '",
                                    "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['premium']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['premium']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['premium']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrate_ARRAY['midgrade']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrateFormat_ARRAY['midgrade']) . '",
                                    "' . $mysqli->real_escape_string($tmp_connections_ARRAY['midgrade']) . '",
                                    "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['midgrade']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['midgrade']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['midgrade']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrate_ARRAY['aacplus']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrateFormat_ARRAY['aacplus']) . '",
                                    "' . $mysqli->real_escape_string($tmp_connections_ARRAY['aacplus']) . '",
                                    "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['aacplus']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['aacplus']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['aacplus']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrate_ARRAY['random']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrateFormat_ARRAY['random']) . '",
                                    "' . $mysqli->real_escape_string($tmp_connections_ARRAY['random']) . '",
                                    "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['random']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['random']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['random']) . '",
                                    "' . $ts . '");';
                                    $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', 'jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                                    $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                                }

                                //
                                // GET TABLE PATTERN FROM $tmp_RELAY_REPORTING_SHARD_ID
                                $tmp_query = 'SELECT `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`REPORTING_LOG_ID`
                                FROM `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`
                                WHERE `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STREAM_KEY` = "' . $mysqli->real_escape_string($tmp_STREAM_KEY) . '"
                                AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STREAM_KEY_CRC32` = "' . $this->oCRNRSTN_USR->crcINT($tmp_STREAM_KEY) . '"
                                AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`BASSDRIVE_LOG_ID` = "' . $mysqli->real_escape_string($tmp_BASSDRIVE_LOG_ID) . '"
                                AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`BASSDRIVE_LOG_ID_CRC32` = "' . $this->oCRNRSTN_USR->crcINT($tmp_BASSDRIVE_LOG_ID) . '"
                                AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`ISACTIVE` = 1
                                AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STREAM_URL` = "' . $tmp_streamURL . '" LIMIT 1;';
                                $tmp_result_set_key_REPORTING_LOG_ID = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', 'jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                                $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key_REPORTING_LOG_ID, $tmp_query);

                                //
                                // PROCESS ALL QUERY TO CONNECTION(S)
                                $this->oCRNRSTN_USR->process_query();

                                $tmp_LOG_REPORTING_count = $this->oCRNRSTN_USR->return_record_count($tmp_result_set_key_REPORTING_LOG_ID);

                                if($tmp_LOG_REPORTING_count < 3){

                                    $tmp_REPORTING_LOG_ID = $this->oCRNRSTN_USR->generate_new_key(100);
                                    $tmp_REPORTING_LOG_ID = $this->oCRNRSTN_USR->return_valid_primary_key($tmp_REPORTING_LOG_ID, 'char', 100, 'crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN , 'REPORTING_LOG_ID', 'REPORTING_LOG_ID_CRC32');

                                    //
                                    // OLD SCHOOL GRACEFUL DEGRADE FOR IF SOME KIND OF RUNTIME DATABASE ERROR SPOILS THE NEW SERIAL
                                    // GENERATION BUT MAYBE THIS COULD STILL WORK.
                                    $tmp_REPORTING_LOG_ID = $this->oCRNRSTN_USR->valid_primary_key_check($tmp_REPORTING_LOG_ID, 'char', 100);

                                    //
                                    // PREFORM INSERT
                                    $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();
                                    $tmp_query = 'INSERT INTO `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`
                                    (`REPORTING_LOG_ID`,
                                    `REPORTING_LOG_ID_CRC32`,
                                    `STREAM_KEY`,
                                    `STREAM_KEY_CRC32`,
                                    `IS_REPLAY`,
                                    `RELAY_TIMESTAMP`,
                                    `BASSDRIVE_LOG_ID`,
                                    `BASSDRIVE_LOG_ID_CRC32`,
                                    `STREAM_URL`,
                                    `STREAM_URL_IOS`,
                                    `BITRATE`,
                                    `AUDIO_FORMAT`,
                                    `LISTENER_COUNT`,
                                    `LISTENER_COUNT_PERCENTAGE`,
                                    `TITLE`,
                                    `STATS_TOTAL_CONNECTIONS`,
                                    `STATS_TOTAL_CAPACITY`,
                                    `STATS_TOTAL_BANDWIDTH`,
                                    `STATS_TOTAL_BANDWIDTH_FORMAT`,
                                    `STATS_TOTAL_UNIQUE_CONNECTIONS`,
                                    `STATS_TOTAL_UNIQUE_CAPACITY`,
                                    `STATS_TOTAL_UNIQUE_BANDWIDTH`,
                                    `STATS_TOTAL_UNIQUE_BANDWIDTH_FORMAT`,
                                    `STATS_PREMIUM_BITRATE`,
                                    `STATS_PREMIUM_BITRATE_FORMAT`,
                                    `STATS_PREMIUM_CONNECTIONS`,
                                    `STATS_PREMIUM_CAPACITY`,
                                    `STATS_PREMIUM_BANDWIDTH`,
                                    `STATS_PREMIUM_BANDWIDTH_FORMAT`,
                                    `STATS_MIDGRADE_BITRATE`,
                                    `STATS_MIDGRADE_BITRATE_FORMAT`,
                                    `STATS_MIDGRADE_CONNECTIONS`,
                                    `STATS_MIDGRADE_CAPACITY`,
                                    `STATS_MIDGRADE_BANDWIDTH`,
                                    `STATS_MIDGRADE_BANDWIDTH_FORMAT`,
                                    `STATS_AAC_PLUS_BITRATE`,
                                    `STATS_AAC_PLUS_BITRATE_FORMAT`,
                                    `STATS_AAC_PLUS_CONNECTIONS`,
                                    `STATS_AAC_PLUS_CAPACITY`,
                                    `STATS_AAC_PLUS_BANDWIDTH`,
                                    `STATS_AAC_PLUS_BANDWIDTH_FORMAT`,
                                    `STATS_RANDOM_BITRATE`,
                                    `STATS_RANDOM_BITRATE_FORMAT`,
                                    `STATS_RANDOM_CONNECTIONS`,
                                    `STATS_RANDOM_CAPACITY`,
                                    `STATS_RANDOM_BANDWIDTH`,
                                    `STATS_RANDOM_BANDWIDTH_FORMAT`,
                                    `DATEMODIFIED`)
                                    VALUES
                                    ("' . $tmp_REPORTING_LOG_ID . '",
                                    "' . $this->oCRNRSTN_USR->crcINT($tmp_REPORTING_LOG_ID) . '",
                                    "' . $mysqli->real_escape_string($tmp_STREAM_KEY) . '",
                                    "' . $this->oCRNRSTN_USR->crcINT($tmp_STREAM_KEY) . '",
                                    ' . $tmp_IS_REPLAY . ',
                                    "' . $tmp_DATEMODIFIED . '",
                                    "' . $tmp_BASSDRIVE_LOG_ID . '",
                                    "' . $this->oCRNRSTN_USR->crcINT($tmp_BASSDRIVE_LOG_ID) . '",
                                    "' . $mysqli->real_escape_string($tmp_streamURL) . '",
                                    "' . $mysqli->real_escape_string($tmp_streamURLios) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrate) . '",
                                    "' . $mysqli->real_escape_string($tmp_audioFormat) . '",
                                    "' . $mysqli->real_escape_string($tmp_listenerCount) . '",
                                    "' . $mysqli->real_escape_string($tmp_listenerCountPercentage) . '",
                                    "' . $mysqli->real_escape_string($tmp_title) . '",
                                    "' . $mysqli->real_escape_string($tmp_connections_ARRAY['total']) . '",
                                    "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['total']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['total']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['total']) . '",
                                    "' . $mysqli->real_escape_string($tmp_connections_ARRAY['totalunique']) . '",
                                    "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['totalunique']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['totalunique']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['totalunique']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrate_ARRAY['premium']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrateFormat_ARRAY['premium']) . '",
                                    "' . $mysqli->real_escape_string($tmp_connections_ARRAY['premium']) . '",
                                    "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['premium']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['premium']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['premium']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrate_ARRAY['midgrade']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrateFormat_ARRAY['midgrade']) . '",
                                    "' . $mysqli->real_escape_string($tmp_connections_ARRAY['midgrade']) . '",
                                    "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['midgrade']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['midgrade']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['midgrade']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrate_ARRAY['aacplus']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrateFormat_ARRAY['aacplus']) . '",
                                    "' . $mysqli->real_escape_string($tmp_connections_ARRAY['aacplus']) . '",
                                    "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['aacplus']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['aacplus']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['aacplus']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrate_ARRAY['random']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrateFormat_ARRAY['random']) . '",
                                    "' . $mysqli->real_escape_string($tmp_connections_ARRAY['random']) . '",
                                    "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['random']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['random']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['random']) . '",
                                    "' . $ts . '");';
                                    $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', 'jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                                    $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                                }else{

                                    $tmp_REPORTING_LOG_ID = $this->oCRNRSTN_USR->return_database_value($tmp_result_set_key_REPORTING_LOG_ID, 'REPORTING_LOG_ID');

                                    //
                                    // PERFORM UPDATE
                                    $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();
                                    $tmp_query = 'UPDATE `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`
                                    SET
                                    `IS_REPLAY` = ' . $tmp_IS_REPLAY . ',
                                    `STREAM_URL_IOS` = "' . $mysqli->real_escape_string($tmp_streamURLios) . '",
                                    `BITRATE` = "' . $mysqli->real_escape_string($tmp_bitrate) . '",
                                    `AUDIO_FORMAT` = "' . $mysqli->real_escape_string($tmp_audioFormat) . '",
                                    `LISTENER_COUNT` = "' . $mysqli->real_escape_string($tmp_listenerCount) . '",
                                    `LISTENER_COUNT_PERCENTAGE` = "' . $mysqli->real_escape_string($tmp_listenerCountPercentage) . '",
                                    `TITLE` = "' . $mysqli->real_escape_string($tmp_title) . '",
                                    `STATS_TOTAL_CONNECTIONS` = "' . $mysqli->real_escape_string($tmp_connections_ARRAY['total']) . '",
                                    `STATS_TOTAL_CAPACITY` = "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['total']) . '",
                                    `STATS_TOTAL_BANDWIDTH` = "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['total']) . '",
                                    `STATS_TOTAL_BANDWIDTH_FORMAT` = "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['total']) . '",
                                    `STATS_TOTAL_UNIQUE_CONNECTIONS` = "' . $mysqli->real_escape_string($tmp_connections_ARRAY['totalunique']) . '",
                                    `STATS_TOTAL_UNIQUE_CAPACITY` = "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['totalunique']) . '",
                                    `STATS_TOTAL_UNIQUE_BANDWIDTH` = "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['totalunique']) . '",
                                    `STATS_TOTAL_UNIQUE_BANDWIDTH_FORMAT` = "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['totalunique']) . '",
                                    `STATS_PREMIUM_BITRATE` = "' . $mysqli->real_escape_string($tmp_bitrate_ARRAY['premium']) . '",
                                    `STATS_PREMIUM_BITRATE_FORMAT` = "' . $mysqli->real_escape_string($tmp_bitrateFormat_ARRAY['premium']) . '",
                                    `STATS_PREMIUM_CONNECTIONS` = "' . $mysqli->real_escape_string($tmp_connections_ARRAY['premium']) . '",
                                    `STATS_PREMIUM_CAPACITY` = "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['premium']) . '",
                                    `STATS_PREMIUM_BANDWIDTH` = "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['premium']) . '",
                                    `STATS_PREMIUM_BANDWIDTH_FORMAT` = "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['premium']) . '",
                                    `STATS_MIDGRADE_BITRATE` = "' . $mysqli->real_escape_string($tmp_bitrate_ARRAY['midgrade']) . '",
                                    `STATS_MIDGRADE_BITRATE_FORMAT` = "' . $mysqli->real_escape_string($tmp_bitrateFormat_ARRAY['midgrade']) . '",
                                    `STATS_MIDGRADE_CONNECTIONS` = "' . $mysqli->real_escape_string($tmp_connections_ARRAY['midgrade']) . '",
                                    `STATS_MIDGRADE_CAPACITY` = "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['midgrade']) . '",
                                    `STATS_MIDGRADE_BANDWIDTH` = "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['midgrade']) . '",
                                    `STATS_MIDGRADE_BANDWIDTH_FORMAT` = "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['midgrade']) . '",
                                    `STATS_AAC_PLUS_BITRATE` = "' . $mysqli->real_escape_string($tmp_bitrate_ARRAY['aacplus']) . '",
                                    `STATS_AAC_PLUS_BITRATE_FORMAT` = "' . $mysqli->real_escape_string($tmp_bitrateFormat_ARRAY['aacplus']) . '",
                                    `STATS_AAC_PLUS_CONNECTIONS` = "' . $mysqli->real_escape_string($tmp_connections_ARRAY['aacplus']) . '",
                                    `STATS_AAC_PLUS_CAPACITY` = "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['aacplus']) . '",
                                    `STATS_AAC_PLUS_BANDWIDTH` = "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['aacplus']) . '",
                                    `STATS_AAC_PLUS_BANDWIDTH_FORMAT` = "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['aacplus']) . '",
                                    `STATS_RANDOM_BITRATE` = "' . $mysqli->real_escape_string($tmp_bitrate_ARRAY['random']) . '",
                                    `STATS_RANDOM_BITRATE_FORMAT` = "' . $mysqli->real_escape_string($tmp_bitrateFormat_ARRAY['random']) . '",
                                    `STATS_RANDOM_CONNECTIONS` = "' . $mysqli->real_escape_string($tmp_connections_ARRAY['random']) . '",
                                    `STATS_RANDOM_CAPACITY` = "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['random']) . '",
                                    `STATS_RANDOM_BANDWIDTH` = "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['random']) . '",
                                    `STATS_RANDOM_BANDWIDTH_FORMAT` = "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['random']) . '",
                                    `DATEMODIFIED` = "' . $ts . '"
                                    WHERE `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`REPORTING_LOG_ID` = "' . $tmp_REPORTING_LOG_ID . '"
                                    AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`REPORTING_LOG_ID_CRC32` = "' . $this->oCRNRSTN_USR->crcINT($tmp_REPORTING_LOG_ID) . '"
                                    AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STREAM_KEY` = "' . $mysqli->real_escape_string($tmp_STREAM_KEY) . '"
                                    AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STREAM_KEY_CRC32` = "' . $this->oCRNRSTN_USR->crcINT($tmp_STREAM_KEY) . '"
                                    AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`BASSDRIVE_LOG_ID` = "' . $mysqli->real_escape_string($tmp_BASSDRIVE_LOG_ID) . '"
                                    AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`BASSDRIVE_LOG_ID_CRC32` = "' . $this->oCRNRSTN_USR->crcINT($tmp_BASSDRIVE_LOG_ID) . '"
                                    AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`ISACTIVE` = 1
                                    AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STREAM_URL` = "' . $tmp_streamURL . '" LIMIT 1;';
                                    $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', 'jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                                    $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                                }

                                //
                                // PROCESS ALL QUERY TO CONNECTION(S)
                                $this->oCRNRSTN_USR->process_query();

                                $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();
                                $tmp_query = 'UPDATE `crnrstn_global_bassdrive_log`
                                SET
                                `ISACTIVE` = 5,
                                `PROCESSING_STATE` = "LOGGED",
                                `STATUS_MESSAGE` = "Logging complete. [rtime ' . $this->oCRNRSTN_USR->wall_time() . ']",
                                `DATEMODIFIED` = "' . $ts . '"
                                WHERE `BASSDRIVE_LOG_ID` = "' . $mysqli->real_escape_string($tmp_BASSDRIVE_LOG_ID) . '"
                                AND `BASSDRIVE_LOG_ID_CRC32` = "' . $this->oCRNRSTN_USR->crcINT($tmp_BASSDRIVE_LOG_ID) . '" LIMIT 1;';
                                $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                                $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                                //
                                // PROCESS ALL QUERY TO CONNECTION(S)
                                $this->oCRNRSTN_USR->process_query();

                                //error_log(__LINE__ . ' user *END* index[' . $i . ' of ' . $tmp_LOG_BASSDRIVE_count . '] $tmp_BASSDRIVE_LOG_ID=' . $tmp_BASSDRIVE_LOG_ID);

                            }

                        }

                    }

                }

            }

            return '<br>[lnum ' . __LINE__ . '] ' . __METHOD__ . ' [' . $tmp_TABLE_STRING_PATTERN . ']->tmp_title=' . $tmp_PROGRAM_TITLE . '<br><br>';

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function reporting_sync_bassdrive_log(){

        $oCRNRSTN_MySQLi = $this->oCRNRSTN_USR->return_crnrstn_mysqli();
        $mysqli = $oCRNRSTN_MySQLi->return_conn_object();

        $tmp_query = 'SELECT `crnrstn_global_bassdrive_log`.`BASSDRIVE_LOG_ID`,
                        `crnrstn_global_bassdrive_log`.`PROGRAM_TITLE`,
                        `crnrstn_global_bassdrive_log`.`STREAM_RELAY_JSON`,
                        `crnrstn_global_bassdrive_log`.`DATEMODIFIED`
                        FROM `crnrstn_global_bassdrive_log`
                        WHERE `crnrstn_global_bassdrive_log`.`ISACTIVE` = 1
                        AND `crnrstn_global_bassdrive_log`.`PROCESSING_STATE` = "NEW"
                        OR `crnrstn_global_bassdrive_log`.`PROCESSING_STATE` = "RELOAD"
                        ORDER BY DATEMODIFIED DESC LIMIT 5;';
        $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!jesus_is_my_dear_lord!', 'BASSDRIVE_LOG_REPORTING_SYNC', __LINE__, __METHOD__);
        $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

        $this->oCRNRSTN_USR->load_query_profile('BASSDRIVE_DATA', '!jesus_is_my_dear_lord!', 'BASSDRIVE_STREAM_KEY_PATTERN_LOOKUP');
        $this->oCRNRSTN_USR->add_database_query('BASSDRIVE_STREAM_KEY_PATTERN_LOOKUP');

        //
        // PROCESS ALL QUERY TO CONNECTION(S)
        $this->oCRNRSTN_USR->process_query();

        $tmp_BASSDRIVE_LOG_REPORTING_SYNC_count = $this->oCRNRSTN_USR->return_record_count('BASSDRIVE_LOG_REPORTING_SYNC');

        if($tmp_BASSDRIVE_LOG_REPORTING_SYNC_count > 0){

            for($i = 0; $i < $tmp_BASSDRIVE_LOG_REPORTING_SYNC_count; $i++) {

                $tmp_BASSDRIVE_LOG_ID = trim($this->oCRNRSTN_USR->return_database_value('BASSDRIVE_LOG_REPORTING_SYNC', 'BASSDRIVE_LOG_ID', $i));
                $tmp_PROGRAM_TITLE = trim($this->oCRNRSTN_USR->return_database_value('BASSDRIVE_LOG_REPORTING_SYNC', 'PROGRAM_TITLE', $i));
                $tmp_STREAM_RELAY_JSON = $this->oCRNRSTN_USR->return_database_value('BASSDRIVE_LOG_REPORTING_SYNC', 'STREAM_RELAY_JSON', $i);
                $tmp_DATEMODIFIED = trim($this->oCRNRSTN_USR->return_database_value('BASSDRIVE_LOG_REPORTING_SYNC', 'DATEMODIFIED', $i));

                $tmp_IS_REPLAY = $this->program_is_replay_status($tmp_PROGRAM_TITLE);

                //
                // IDENTIFY RELAY STREAM STREAM_KEY (SHOW KEY) BEFORE JSON CONSUMPTION
                $tmp_STREAM_KEY = $this->return_relay_stream_key($tmp_PROGRAM_TITLE);

                //
                // IF STREAM KEY UNDETERMINED, THROW EXCEPTION AND SPOIL THIS RECORD.
                if (strlen($tmp_STREAM_KEY) < 3) {

                    //
                    // INSERT AND/OR RETRIEVE STREAM REPORTING TABLE NAME STRING
                    $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();
                    $tmp_query = 'UPDATE `crnrstn_global_bassdrive_log`
                    SET
                    `PROCESSING_STATE` = "STREAM KEY UNKNOWN",
                    `STATUS_MESSAGE` = "Unable to determine stream key with program title string pattern matching against the database.",
                    `DATEMODIFIED` = "' . $ts . '"
                    WHERE `crnrstn_global_bassdrive_log`.`BASSDRIVE_LOG_ID` = "' . $tmp_BASSDRIVE_LOG_ID . '"
                    AND `crnrstn_global_bassdrive_log`.`BASSDRIVE_LOG_ID_CRC32` = "' . $this->oCRNRSTN_USR->crcINT($tmp_BASSDRIVE_LOG_ID) . '"
                    AND `crnrstn_global_bassdrive_log`.`ISACTIVE` = 1 LIMIT 1;';
                    $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                    $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                    //
                    // PROCESS ALL QUERY TO CONNECTION(S)
                    $this->oCRNRSTN_USR->process_query(true);

                    //throw new Exception('Unable to determine Bassdrive stream key from JSON log data for ' . $tmp_PROGRAM_TITLE . '. Where crnrstn_global_bassdrive_log.BASSDRIVE_LOG_ID=[' . $tmp_BASSDRIVE_LOG_ID . '].');

                }

                //
                // INSERT AND/OR RETRIEVE STREAM REPORTING TABLE NAME STRING
                $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();
                $tmp_query = 'SELECT `crnrstn_stream_relay_meta_lookup`.`META_LOOKUP_ID`,
                    `crnrstn_stream_relay_meta_lookup`.`STREAM_KEY`,
                    `crnrstn_stream_relay_meta_lookup`.`STREAM_KEY_CRC32`,
                    `crnrstn_stream_relay_meta_lookup`.`ISACTIVE`,
                    `crnrstn_stream_relay_meta_lookup`.`RELAY_REPORTING_SHARD_ID`,
                    `crnrstn_stream_relay_meta_lookup`.`LOCALE_ID`,
                    `crnrstn_stream_relay_meta_lookup`.`ABOUT_ID`,
                    `crnrstn_stream_relay_meta_lookup`.`COLORS_ID`,
                    `crnrstn_stream_relay_meta_lookup`.`STREAM_COLORS_KEY`,
                    `crnrstn_stream_relay_meta_lookup`.`DATEMODIFIED`,
                    `crnrstn_stream_relay_meta_lookup`.`DATECREATED`
                FROM `crnrstn_stream_relay_meta_lookup`
                WHERE `crnrstn_stream_relay_meta_lookup`.`STREAM_KEY` = "' . $mysqli->real_escape_string($tmp_STREAM_KEY) . '"
                AND `crnrstn_stream_relay_meta_lookup`.`STREAM_KEY_CRC32` = "' . $this->oCRNRSTN_USR->crcINT($tmp_STREAM_KEY) . '"
                AND (`crnrstn_stream_relay_meta_lookup`.`ISACTIVE` = 1 OR `crnrstn_stream_relay_meta_lookup`.`ISACTIVE` = 8) LIMIT 1;';
                $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                //
                // PROCESS ALL QUERY TO CONNECTION(S)
                $this->oCRNRSTN_USR->process_query();

                $tmp_STREAM_KEY_META_LOOKUP_count = $this->oCRNRSTN_USR->return_record_count($tmp_result_set_key);

                if($tmp_STREAM_KEY_META_LOOKUP_count > 0){

                    //
                    // WE HAVE META DATA. DO WE HAVE SHARD ID? RUN AN UPDATE.
                    $tmp_META_LOOKUP_ID = $this->oCRNRSTN_USR->return_database_value($tmp_result_set_key, 'META_LOOKUP_ID');
                    $tmp_STREAM_KEY = $this->oCRNRSTN_USR->return_database_value($tmp_result_set_key, 'STREAM_KEY');
                    $tmp_RELAY_REPORTING_SHARD_ID = $this->oCRNRSTN_USR->return_database_value($tmp_result_set_key, 'RELAY_REPORTING_SHARD_ID');

                    if(strlen($tmp_RELAY_REPORTING_SHARD_ID) < 64){

                        $tmp_query = 'SELECT `crnrstn_stream_relay_meta_lookup`.`RELAY_REPORTING_SHARD_ID`,
                        COUNT(*) AS SHARD_USE_COUNT
                        FROM `crnrstn_stream_relay_meta_lookup`
                        WHERE (`crnrstn_stream_relay_meta_lookup`.`ISACTIVE` = 1 OR `crnrstn_stream_relay_meta_lookup`.`ISACTIVE` = 8)
                        GROUP BY `crnrstn_stream_relay_meta_lookup`.`RELAY_REPORTING_SHARD_ID`
                        ORDER BY SHARD_USE_COUNT ASC LIMIT 1;';
                        $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!!!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                        $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                        //
                        // PROCESS ALL QUERY TO CONNECTION(S)
                        $this->oCRNRSTN_USR->process_query();

                        $tmp_RELAY_REPORTING_SHARD_ID = trim($this->oCRNRSTN_USR->return_database_value($tmp_result_set_key, 'RELAY_REPORTING_SHARD_ID'));
                        $tmp_STREAM_KEY_COUNT = trim($this->oCRNRSTN_USR->return_database_value($tmp_result_set_key, 'SHARD_USE_COUNT'));

                        if(($tmp_STREAM_KEY_COUNT < self::$data_shard_max_bassdrive_streams_cnt) && (strlen($tmp_RELAY_REPORTING_SHARD_ID)  >  30)){

                            //
                            // ADD THE CURRENT STREAM TO THIS REPORTING SHARD
                            $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();
                            $tmp_query = 'UPDATE `crnrstn_stream_relay_meta_lookup`
                            SET
                            `RELAY_REPORTING_SHARD_ID` = "' . $tmp_RELAY_REPORTING_SHARD_ID . '",
                            `DATEMODIFIED` = "' . $ts . '"
                            WHERE `crnrstn_stream_relay_meta_lookup`.`META_LOOKUP_ID` = "' . $tmp_META_LOOKUP_ID . '"
                            AND `crnrstn_stream_relay_meta_lookup`.`STREAM_KEY` = "' . $mysqli->real_escape_string($tmp_STREAM_KEY) . '"
                            AND `crnrstn_stream_relay_meta_lookup`.`STREAM_KEY_CRC32` = "' . $this->oCRNRSTN_USR->crcINT($tmp_STREAM_KEY) . '"
                            AND (`crnrstn_stream_relay_meta_lookup`.`ISACTIVE` = 1 OR `crnrstn_stream_relay_meta_lookup`.`ISACTIVE` = 8) LIMIT 1;';
                            $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                            $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                            //
                            // PROCESS ALL QUERY TO CONNECTION(S)
                            $this->oCRNRSTN_USR->process_query();

                        }else{

                            //
                            // WE DON'T HAVE A SHARD WITH CAPACITY TO HOLD THIS STREAM REPORTING DATA.
                            // ADD THE NECESSARY TABLES
                            // INSERT NEW STREAM RELAY WITH REPORTING LOOKUP AT THIS SHARD ADDRESS
                            $tmp_RELAY_REPORTING_SHARD_ID = $this->oCRNRSTN_USR->generate_new_key(64);
                            $tmp_RELAY_REPORTING_SHARD_ID = $this->oCRNRSTN_USR->return_valid_primary_key($tmp_RELAY_REPORTING_SHARD_ID, 'char', 64, 'crnrstn_stream_relay_reporting_shards', 'RELAY_REPORTING_SHARD_ID');

                            $tmp_TABLE_STRING_PATTERN = $this->oCRNRSTN_USR->generate_new_key(10, '01');
                            $tmp_TABLE_STRING_PATTERN = $this->oCRNRSTN_USR->return_valid_primary_key($tmp_TABLE_STRING_PATTERN, 'char', 10, 'crnrstn_stream_relay_reporting_shards', 'TABLE_STRING_PATTERN', 'TABLE_STRING_PATTERN_CRC32', '01');

                            //
                            // OLD SCHOOL GRACEFUL DEGRADE FOR IF SOME KIND OF RUNTIME DATABASE ERROR SPOILS THE NEW SERIAL
                            // GENERATION BUT MAYBE THIS COULD STILL WORK.
                            $tmp_RELAY_REPORTING_SHARD_ID = $this->oCRNRSTN_USR->valid_primary_key_check($tmp_RELAY_REPORTING_SHARD_ID, 'char', 64);
                            $tmp_TABLE_STRING_PATTERN = $this->oCRNRSTN_USR->valid_primary_key_check($tmp_TABLE_STRING_PATTERN, 'char', 10, '01');

                            $tmp_query_DROP = 'DROP TABLE IF EXISTS `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`;';
                            $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                            $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query_DROP);

                            $tmp_query = 'CREATE TABLE `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '` (
                                `REPORTING_LOG_ID` char(100) NOT NULL,
                                `REPORTING_LOG_ID_CRC32` int(11) UNSIGNED NOT NULL,
                                `STREAM_KEY` varchar(255) NOT NULL,
                                `STREAM_KEY_CRC32` int(11) UNSIGNED NOT NULL,
                                `IS_REPLAY` tinyint(2) UNSIGNED NOT NULL DEFAULT \'0\',
                                `RELAY_TIMESTAMP` datetime NOT NULL,
                                `BASSDRIVE_LOG_ID` char(100) NOT NULL,
                                `BASSDRIVE_LOG_ID_CRC32` int(11) UNSIGNED NOT NULL,
                                `ISACTIVE` tinyint(2) UNSIGNED NOT NULL DEFAULT \'1\',
                                `STREAM_URL` varchar(500) NOT NULL,
                                `STREAM_URL_IOS` varchar(500) DEFAULT NULL,
                                `BITRATE` int(11) UNSIGNED NOT NULL,
                                `AUDIO_FORMAT` varchar(25) NOT NULL,
                                `LISTENER_COUNT` int(11) UNSIGNED NOT NULL,
                                `LISTENER_COUNT_PERCENTAGE` double NOT NULL,
                                `TITLE` varchar(500) NOT NULL,
                                `STATS_TOTAL_CONNECTIONS` int(11) UNSIGNED NOT NULL,
                                `STATS_TOTAL_CAPACITY` int(11) UNSIGNED NOT NULL,
                                `STATS_TOTAL_BANDWIDTH` double NOT NULL,
                                `STATS_TOTAL_BANDWIDTH_FORMAT` varchar(25) NOT NULL,
                                `STATS_TOTAL_UNIQUE_CONNECTIONS` int(11) UNSIGNED NOT NULL,
                                `STATS_TOTAL_UNIQUE_CAPACITY` int(11) UNSIGNED NOT NULL,
                                `STATS_TOTAL_UNIQUE_BANDWIDTH` double NOT NULL,
                                `STATS_TOTAL_UNIQUE_BANDWIDTH_FORMAT` varchar(25) NOT NULL,
                                `STATS_PREMIUM_BITRATE` int(11) UNSIGNED DEFAULT NULL,
                                `STATS_PREMIUM_BITRATE_FORMAT` varchar(25) DEFAULT NULL,
                                `STATS_PREMIUM_CONNECTIONS` int(11) UNSIGNED DEFAULT NULL,
                                `STATS_PREMIUM_CAPACITY` int(11) UNSIGNED DEFAULT NULL,
                                `STATS_PREMIUM_BANDWIDTH` double DEFAULT NULL,
                                `STATS_PREMIUM_BANDWIDTH_FORMAT` varchar(25) DEFAULT NULL,
                                `STATS_MIDGRADE_BITRATE` int(11) UNSIGNED DEFAULT NULL,
                                `STATS_MIDGRADE_BITRATE_FORMAT` varchar(25) DEFAULT NULL,
                                `STATS_MIDGRADE_CONNECTIONS` int(11) UNSIGNED DEFAULT NULL,
                                `STATS_MIDGRADE_CAPACITY` int(11) UNSIGNED DEFAULT NULL,
                                `STATS_MIDGRADE_BANDWIDTH` double DEFAULT NULL,
                                `STATS_MIDGRADE_BANDWIDTH_FORMAT` varchar(25) DEFAULT NULL,
                                `STATS_AAC_PLUS_BITRATE` int(11) UNSIGNED DEFAULT NULL,
                                `STATS_AAC_PLUS_BITRATE_FORMAT` varchar(25) DEFAULT NULL,
                                `STATS_AAC_PLUS_CONNECTIONS` int(11) UNSIGNED DEFAULT NULL,
                                `STATS_AAC_PLUS_CAPACITY` int(11) UNSIGNED DEFAULT NULL,
                                `STATS_AAC_PLUS_BANDWIDTH` double DEFAULT NULL,
                                `STATS_AAC_PLUS_BANDWIDTH_FORMAT` varchar(25) DEFAULT NULL,
                                `STATS_RANDOM_BITRATE` int(11) UNSIGNED DEFAULT NULL,
                                `STATS_RANDOM_BITRATE_FORMAT` varchar(25) DEFAULT NULL,
                                `STATS_RANDOM_CONNECTIONS` int(11) UNSIGNED DEFAULT NULL,
                                `STATS_RANDOM_CAPACITY` int(11) UNSIGNED DEFAULT NULL,
                                `STATS_RANDOM_BANDWIDTH` double DEFAULT NULL,
                                `STATS_RANDOM_BANDWIDTH_FORMAT` varchar(25) DEFAULT NULL,
                                `DATEMODIFIED` datetime NOT NULL,
                                `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
                            ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT=\'Stream relay connections reporting shard.\';';
                            $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_RELAY_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                            $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                            $tmp_query = 'DROP TABLE IF EXISTS `crnrstn_stream_social_click_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`;';
                            $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!!jesus_is_my_dear_lord!123', '', __LINE__, __METHOD__);
                            $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                            $tmp_query = 'CREATE TABLE `crnrstn_stream_social_click_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '` (
                              `REPORTING_LOG_ID` char(100) NOT NULL,
                              `STREAM_KEY` varchar(255) NOT NULL,
                              `STREAM_KEY_CRC32` int(11) UNSIGNED NOT NULL,
                              `IS_REPLAY` tinyint(2) UNSIGNED NOT NULL DEFAULT \'0\',
                              `SOCIAL_MEDIA_KEY` varchar(100) NOT NULL,
                              `SOCIAL_MEDIA_KEY_CRC32` int(11) UNSIGNED NOT NULL,
                              `CLICKTHROUGH_URL` varchar(500) NOT NULL,
                              `CLICKTHROUGH_IP` int(11) UNSIGNED NOT NULL,
                              `CLICKTHROUGH_SERVER_ADDR` int(11) UNSIGNED NOT NULL,
                              `CLICKTHROUGH_PHPSESSION_ID` char(26) NOT NULL,
                              `CLICKTHROUGH_HTTP_REFERER` varchar(500) NOT NULL,
                              `CLICKTHROUGH_HTTP_USER_AGENT` varchar(500) NOT NULL,
                              `CLICKTHROUGH_DEVICE_TYPE` varchar(7) NOT NULL COMMENT \'[MOBILE, TABLET, DESKTOP]\',
                              `CLICKTHROUGH_LANG_PREFS` varchar(50) NOT NULL,
                              `DATEMODIFIED` datetime NOT NULL,
                              `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
                            ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT=\'Stream relay social link clickthrough data shard.\';';
                            $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_CLICK_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                            $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                            $tmp_query = 'ALTER TABLE `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`
                            ADD PRIMARY KEY (`REPORTING_LOG_ID`);';
                            $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                            $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                            $tmp_query = 'ALTER TABLE `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '` ADD INDEX( `STREAM_KEY`, `STREAM_KEY_CRC32`, `IS_REPLAY`, `RELAY_TIMESTAMP`);';
                            $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                            $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                            $tmp_query = 'ALTER TABLE `crnrstn_stream_social_click_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`
                            ADD PRIMARY KEY (`REPORTING_LOG_ID`);';
                            $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                            $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                            $tmp_query = 'ALTER TABLE `crnrstn_stream_social_click_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '` ADD INDEX( `STREAM_KEY`, `STREAM_KEY_CRC32`, `IS_REPLAY`);';
                            $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                            $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                            $tmp_query = 'ALTER TABLE `crnrstn_stream_social_click_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '` ADD INDEX( `STREAM_KEY`, `STREAM_KEY_CRC32`, `IS_REPLAY`, `SOCIAL_MEDIA_KEY`, `SOCIAL_MEDIA_KEY_CRC32`);';
                            $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                            $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                            //
                            // PROCESS ALL QUERY TO CONNECTION(S)
                            $this->oCRNRSTN_USR->process_query();

                            //
                            // SOURCE :: https://stackoverflow.com/questions/8829102/check-if-mysql-table-exists-without-using-select-from-syntax
                            // COMMENT :: https://stackoverflow.com/a/8829109
                            // AUTHOR :: Sergio Tulentsev :: https://stackoverflow.com/users/125816/sergio-tulentsev
                            // QUICK CHECK TO CONFIRM TABLE CREATION BEFORE INSERT
                            if($this->table_exists('crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN)){

                                $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();
                                $tmp_query = 'UPDATE `crnrstn_stream_relay_meta_lookup`
                                SET
                                `RELAY_REPORTING_SHARD_ID` = "' . $tmp_RELAY_REPORTING_SHARD_ID . '",
                                `DATEMODIFIED` = "' . $ts . '"
                                WHERE `crnrstn_stream_relay_meta_lookup`.`META_LOOKUP_ID` = "' . $tmp_META_LOOKUP_ID . '"
                                AND `crnrstn_stream_relay_meta_lookup`.`STREAM_KEY` = "' . $mysqli->real_escape_string($tmp_STREAM_KEY) . '"
                                AND `crnrstn_stream_relay_meta_lookup`.`STREAM_KEY_CRC32` = "' . $this->oCRNRSTN_USR->crcINT($tmp_STREAM_KEY) . '"
                                AND (`crnrstn_stream_relay_meta_lookup`.`ISACTIVE` = 1 OR `crnrstn_stream_relay_meta_lookup`.`ISACTIVE` = 8) LIMIT 1;';
                                $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                                $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                                $tmp_query = 'INSERT INTO `crnrstn_stream_relay_reporting_shards`
                                (`RELAY_REPORTING_SHARD_ID`,
                                `RELAY_REPORTING_SHARD_ID_CRC32`,
                                `TABLE_STRING_PATTERN`,
                                `TABLE_STRING_PATTERN_CRC32`,
                                `MAXIMUM_STREAM_COUNT`,
                                `DATEMODIFIED`)
                                VALUES
                                ("' . $tmp_RELAY_REPORTING_SHARD_ID . '",
                                "' . $this->oCRNRSTN_USR->crcINT($tmp_RELAY_REPORTING_SHARD_ID) . '",
                                "' . $tmp_TABLE_STRING_PATTERN . '",
                                "' . $this->oCRNRSTN_USR->crcINT($tmp_TABLE_STRING_PATTERN) . '",
                                "' . self::$data_shard_max_bassdrive_streams_cnt . '",
                                "' . $ts . '");';
                                $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                                $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                                //
                                // PROCESS ALL QUERY TO CONNECTION(S)
                                $this->oCRNRSTN_USR->process_query();

                            }else{

                                error_log(__LINE__ . ' THERE WAS AN ERROR :: CREATE TABLE crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN);

                            }

                        }

                    }

                    //
                    // GET TABLE PATTERN FROM $tmp_RELAY_REPORTING_SHARD_ID
                    $tmp_query = 'SELECT `crnrstn_stream_relay_reporting_shards`.`TABLE_STRING_PATTERN`
                    FROM `crnrstn_stream_relay_reporting_shards`
                    WHERE `crnrstn_stream_relay_reporting_shards`.`RELAY_REPORTING_SHARD_ID` = "' . $tmp_RELAY_REPORTING_SHARD_ID . '"
                    AND `crnrstn_stream_relay_reporting_shards`.`RELAY_REPORTING_SHARD_ID_CRC32` = "' . $this->oCRNRSTN_USR->crcINT($tmp_RELAY_REPORTING_SHARD_ID) . '"
                    AND `crnrstn_stream_relay_reporting_shards`.`ISACTIVE` = 1 LIMIT 1;';
                    $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', 'jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                    $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                    //
                    // PROCESS ALL QUERY TO CONNECTION(S)
                    $this->oCRNRSTN_USR->process_query();

                    $tmp_TABLE_STRING_PATTERN = trim($this->oCRNRSTN_USR->return_database_value($tmp_result_set_key, 'TABLE_STRING_PATTERN'));

                    if(strlen($tmp_TABLE_STRING_PATTERN) > 5){

                        //
                        // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
                        $tmp_json = json_decode($tmp_STREAM_RELAY_JSON, true);
                        $raw_json_relays = $tmp_json['relays'];
                        $raw_json_stats = $tmp_json['stats'];

                        $tmp_stats_loop_cnt = sizeof($raw_json_stats);
                        $tmp_relays_loop_cnt = sizeof($raw_json_relays);

                        //
                        // DATA CONTAINMENT STRUCTURES
                        $tmp_bandwidth_ARRAY = array();
                        $tmp_bitrateFormat_ARRAY = array();
                        $tmp_bitrate_ARRAY = array();
                        $tmp_connections_ARRAY = array();
                        $tmp_capacity_ARRAY = array();
                        $tmp_bandwidthFormat_ARRAY = array();

                        //
                        // STATS EXTRACTION
                        for($iiii = 0; $iiii < $tmp_stats_loop_cnt; $iiii++){

                            $tmp_name = $this->json_data_safe_extract($raw_json_stats, 'name', 'string', $iiii);    //$raw_json_stats[$iiii]['name'];
                            $tmp_name = strtolower($tmp_name);

                            switch($tmp_name){
                                case 'total':
                                    /*
                                     "stats" : [
                                      {
                                         "bandwidth" : 32.63,
                                         "connections" : 261,
                                         "name" : "Total",
                                         "capacity" : 20510,
                                         "bandwidthFormat" : "megabit"
                                      },
                                     * */

                                    $tmp_bandwidth_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'bandwidth', 'double', $iiii);
                                    $tmp_connections_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'connections', 'int', $iiii);
                                    $tmp_capacity_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'capacity', 'int', $iiii);
                                    $tmp_bandwidthFormat_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'bandwidthFormat', 'string', $iiii);

                                break;
                                case 'totalunique':
                                    /*
                                    "stats" : [
                                     {
                                        "bandwidth" : 21.75,
                                        "connections" : 174,
                                        "name" : "TotalUnique",
                                        "capacity" : 20510,
                                        "bandwidthFormat" : "megabit"
                                     },
                                    * */

                                    $tmp_bandwidth_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'bandwidth', 'double', $iiii);
                                    $tmp_connections_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'connections', 'int', $iiii);
                                    $tmp_capacity_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'capacity', 'int', $iiii);
                                    $tmp_bandwidthFormat_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'bandwidthFormat', 'string', $iiii);

                                break;
                                case 'premium':
                                case 'midgrade':
                                case 'aacplus':
                                case 'random':

                                    /*
                                    "stats" : [
                                        {
                                            "bandwidth" : 32.63,
                                            "connections" : 261,
                                            "name" : "Total",
                                            "capacity" : 20510,
                                            "bandwidthFormat" : "megabit"
                                        },
                                        {
                                            "bandwidth" : 21.75,
                                            "connections" : 174,
                                            "name" : "TotalUnique",
                                            "capacity" : 20510,
                                            "bandwidthFormat" : "megabit"
                                        },
                                        {
                                            "bandwidth" : 32.63,
                                            "bitrateFormat" : "kilobit",
                                            "bitrate" : 128,
                                            "connections" : 261,
                                            "name" : "Premium",
                                            "capacity" : 20510,
                                            "bandwidthFormat" : "megabit"
                                        },
                                        {
                                            "bandwidth" : 0,
                                            "bitrateFormat" : "kilobit",
                                            "bitrate" : 56,
                                            "connections" : 0,
                                            "name" : "Midgrade",
                                            "capacity" : 0,
                                            "bandwidthFormat" : "megabit"
                                        },
                                        {
                                            "bandwidth" : 0,
                                            "bitrateFormat" : "kilobit",
                                            "bitrate" : 32,
                                            "connections" : 0,
                                            "name" : "AACplus",
                                            "capacity" : 0,
                                            "bandwidthFormat" : "megabit"
                                        },
                                        {
                                            "bandwidth" : 0,
                                            "bitrateFormat" : "kilobit",
                                            "bitrate" : 128,
                                            "connections" : null,
                                            "name" : "Random",
                                            "capacity" : null,
                                            "bandwidthFormat" : "megabit"
                                        }
                                    ],

                                    */
                                    $tmp_bandwidth_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'bandwidth', 'double', $iiii);
                                    $tmp_bitrateFormat_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'bitrateFormat', 'string', $iiii);
                                    $tmp_bitrate_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'bitrate', 'int', $iiii);
                                    $tmp_connections_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'connections', 'int', $iiii);
                                    $tmp_capacity_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'capacity', 'int', $iiii);
                                    $tmp_bandwidthFormat_ARRAY[$tmp_name] = $this->json_data_safe_extract($raw_json_stats, 'bandwidthFormat', 'string', $iiii);

                                break;

                            }

                        }

                        //$tmp_relay_is_synced = false;
                        for($iii = 0; $iii < $tmp_relays_loop_cnt; $iii++){

                            /*
                            "relays" : [
                                {
                                    "bitrate" : "128",
                                    "status" : "1",
                                    "name" : "bassdrive.radioca.st:8702",
                                    "listenerCount" : "76",
                                    "listenerCountPercentage" : "0.76",
                                    "audioFormat" : "mp3",
                                    "streamURL" : "http:\/\/bassdrive.radioca.st:8702",
                                    "streamURLios" : "http:\/\/bassdrive.radioca.st:8702",
                                    "title" : "The jus on track show with Ashatack - Live"
                                },
                                {
                                    "bitrate" : "128",
                                    "status" : "1",
                                    "name" : "chi.bassdrive.co:80",
                                    "listenerCount" : "162",
                                    "listenerCountPercentage" : "1.62",
                                    "audioFormat" : "mp3",
                                    "streamURL" : "http:\/\/chi.bassdrive.co:80",
                                    "streamURLios" : "http:\/\/chi.bassdrive.co:80",
                                    "title" : "The jus on track show with Ashatack - Live"
                                },
                                {
                                    "bitrate" : "128",
                                    "status" : 0,
                                    "name" : "ice.bassdrive.net:80\/stream",
                                    "listenerCount" : "0",
                                    "listenerCountPercentage" : 0,
                                    "audioFormat" : "mp3",
                                    "streamURL" : "http:\/\/ice.bassdrive.net:80\/stream",
                                    "streamURLios" : "http:\/\/ice.bassdrive.net:80\/stream",
                                    "title" : ""
                                },
                                {
                                    "bitrate" : "32",
                                    "status" : 0,
                                    "name" : "ice.bassdrive.net:80\/stream32",
                                    "listenerCount" : "0",
                                    "listenerCountPercentage" : 0,
                                    "audioFormat" : "aac+",
                                    "streamURL" : "http:\/\/ice.bassdrive.net:80\/stream32",
                                    "streamURLios" : "http:\/\/ice.bassdrive.net:80\/stream32",
                                    "title" : ""
                                },
                                {
                                    "bitrate" : "56",
                                    "status" : 0,
                                    "name" : "ice.bassdrive.net:80\/stream56",
                                    "listenerCount" : "0",
                                    "listenerCountPercentage" : 0,
                                    "audioFormat" : "mp3",
                                    "streamURL" : "http:\/\/ice.bassdrive.net:80\/stream56",
                                    "streamURLios" : "http:\/\/ice.bassdrive.net:80\/stream56",
                                    "title" : ""
                                },
                                {
                                    "bitrate" : "128",
                                    "status" : "1",
                                    "name" : "stream.bassdrive.uk:8200",
                                    "listenerCount" : "23",
                                    "listenerCountPercentage" : "4.49",
                                    "audioFormat" : "mp3",
                                    "streamURL" : "http:\/\/stream.bassdrive.uk:8200",
                                    "streamURLios" : "http:\/\/stream.bassdrive.uk:8200",
                                    "title" : "The jus on track show with Ashatack - Live"
                                }
                            ],

                            */

                            $tmp_bitrate = $this->json_data_safe_extract($raw_json_relays, 'bitrate', 'int', $iii);
                            $tmp_status = $this->json_data_safe_extract($raw_json_relays, 'status', 'int', $iii);

                            if($tmp_status == 1 || $tmp_status == '1'){

                                $tmp_name = $this->json_data_safe_extract($raw_json_relays, 'name', 'string', $iii);
                                $tmp_listenerCount = $this->json_data_safe_extract($raw_json_relays, 'listenerCount', 'int', $iii);
                                $tmp_listenerCountPercentage = $this->json_data_safe_extract($raw_json_relays, 'listenerCountPercentage', 'double', $iii);
                                $tmp_audioFormat = $this->json_data_safe_extract($raw_json_relays, 'audioFormat', 'string', $iii);
                                $tmp_streamURL = $this->json_data_safe_extract($raw_json_relays, 'streamURL', 'string', $iii);
                                $tmp_streamURLios = $this->json_data_safe_extract($raw_json_relays, 'streamURLios', 'string', $iii);
                                $tmp_title = $this->json_data_safe_extract($raw_json_relays, 'title', 'string', $iii);

                                if(!$this->oCRNRSTN_USR->table_field_value_exists($tmp_streamURL, 'crnrstn_stream_relay', 'STREAM_URL' , 'STREAM_URL_CRC32')){

                                    $tmp_RELAY_ID = $this->oCRNRSTN_USR->generate_new_key(64);
                                    $tmp_RELAY_ID = $this->oCRNRSTN_USR->return_valid_primary_key($tmp_RELAY_ID, 'char', 64, 'crnrstn_stream_relay', 'RELAY_ID');

                                    //
                                    // OLD SCHOOL GRACEFUL DEGRADE FOR IF SOME KIND OF RUNTIME DATABASE ERROR SPOILS THE NEW SERIAL
                                    // GENERATION BUT MAYBE THIS COULD STILL WORK.
                                    $tmp_RELAY_ID = $this->oCRNRSTN_USR->valid_primary_key_check($tmp_RELAY_ID, 'char', 64);

                                    //
                                    // INSERT NEW RELAY PROFILE DATA
                                    $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();
                                    $tmp_query = 'INSERT INTO `crnrstn_stream_relay`
                                    (`RELAY_ID`,
                                    `STREAM_URL`,
                                    `STREAM_URL_CRC32`,
                                    `STREAM_URL_IOS`,
                                    `BITRATE`,
                                    `STATUS`,
                                    `NAME`,
                                    `LISTENER_COUNT`,
                                    `LISTENER_COUNT_PERCENTAGE`,
                                    `AUDIO_FORMAT`,
                                    `TITLE`,
                                    `TITLE_CHECKSUM_MD5`,
                                    `STREAM_KEY`,
                                    `STREAM_KEY_MD5`,
                                    `IS_REPLAY`,
                                    `STATS_TOTAL_CONNECTIONS`,
                                    `STATS_TOTAL_CAPACITY`,
                                    `STATS_TOTAL_BANDWIDTH`,
                                    `STATS_TOTAL_BANDWIDTH_FORMAT`,
                                    `STATS_TOTAL_UNIQUE_CONNECTIONS`,
                                    `STATS_TOTAL_UNIQUE_CAPACITY`,
                                    `STATS_TOTAL_UNIQUE_BANDWIDTH`,
                                    `STATS_TOTAL_UNIQUE_BANDWIDTH_FORMAT`,
                                    `STATS_PREMIUM_BITRATE`,
                                    `STATS_PREMIUM_BITRATE_FORMAT`,
                                    `STATS_PREMIUM_CONNECTIONS`,
                                    `STATS_PREMIUM_CAPACITY`,
                                    `STATS_PREMIUM_BANDWIDTH`,
                                    `STATS_PREMIUM_BANDWIDTH_FORMAT`,
                                    `STATS_MIDGRADE_BITRATE`,
                                    `STATS_MIDGRADE_BITRATE_FORMAT`,
                                    `STATS_MIDGRADE_CONNECTIONS`,
                                    `STATS_MIDGRADE_CAPACITY`,
                                    `STATS_MIDGRADE_BANDWIDTH`,
                                    `STATS_MIDGRADE_BANDWIDTH_FORMAT`,
                                    `STATS_AAC_PLUS_BITRATE`,
                                    `STATS_AAC_PLUS_BITRATE_FORMAT`,
                                    `STATS_AAC_PLUS_CONNECTIONS`,
                                    `STATS_AAC_PLUS_CAPACITY`,
                                    `STATS_AAC_PLUS_BANDWIDTH`,
                                    `STATS_AAC_PLUS_BANDWIDTH_FORMAT`,
                                    `STATS_RANDOM_BITRATE`,
                                    `STATS_RANDOM_BITRATE_FORMAT`,
                                    `STATS_RANDOM_CONNECTIONS`,
                                    `STATS_RANDOM_CAPACITY`,
                                    `STATS_RANDOM_BANDWIDTH`,
                                    `STATS_RANDOM_BANDWIDTH_FORMAT`,
                                    `DATEMODIFIED`)
                                    VALUES
                                    ("' . $tmp_RELAY_ID . '",
                                    "' . $mysqli->real_escape_string($tmp_streamURL) . '",
                                    "' . $this->oCRNRSTN_USR->crcINT($tmp_streamURL) . '",
                                    "' . $mysqli->real_escape_string($tmp_streamURLios) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrate) . '",
                                    "' . $mysqli->real_escape_string($tmp_status) . '",
                                    "' . $mysqli->real_escape_string($tmp_name) . '",
                                    "' . $mysqli->real_escape_string($tmp_listenerCount) . '",
                                    "' . $mysqli->real_escape_string($tmp_listenerCountPercentage) . '",
                                    "' . $mysqli->real_escape_string($tmp_audioFormat) . '",
                                    "' . $mysqli->real_escape_string($tmp_title) . '",
                                    UNHEX(\'' . $this->oCRNRSTN_USR->hash($tmp_title, 'md5') . '\'),
                                    "' . $mysqli->real_escape_string($tmp_STREAM_KEY) . '",
                                    UNHEX(\'' . $this->oCRNRSTN_USR->hash($tmp_STREAM_KEY, 'md5') . '\'),
                                    ' . $tmp_IS_REPLAY . ',
                                    "' . $mysqli->real_escape_string($tmp_connections_ARRAY['total']) . '",
                                    "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['total']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['total']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['total']) . '",
                                    "' . $mysqli->real_escape_string($tmp_connections_ARRAY['totalunique']) . '",
                                    "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['totalunique']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['totalunique']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['totalunique']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrate_ARRAY['premium']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrateFormat_ARRAY['premium']) . '",
                                    "' . $mysqli->real_escape_string($tmp_connections_ARRAY['premium']) . '",
                                    "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['premium']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['premium']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['premium']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrate_ARRAY['midgrade']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrateFormat_ARRAY['midgrade']) . '",
                                    "' . $mysqli->real_escape_string($tmp_connections_ARRAY['midgrade']) . '",
                                    "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['midgrade']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['midgrade']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['midgrade']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrate_ARRAY['aacplus']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrateFormat_ARRAY['aacplus']) . '",
                                    "' . $mysqli->real_escape_string($tmp_connections_ARRAY['aacplus']) . '",
                                    "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['aacplus']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['aacplus']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['aacplus']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrate_ARRAY['random']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrateFormat_ARRAY['random']) . '",
                                    "' . $mysqli->real_escape_string($tmp_connections_ARRAY['random']) . '",
                                    "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['random']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['random']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['random']) . '",
                                    "' . $ts . '");';
                                    $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', 'jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                                    $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                                }

                                //
                                // GET TABLE PATTERN FROM $tmp_RELAY_REPORTING_SHARD_ID
                                $tmp_query = 'SELECT `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`REPORTING_LOG_ID`
                                FROM `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`
                                WHERE `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STREAM_KEY` = "' . $mysqli->real_escape_string($tmp_STREAM_KEY) . '"
                                AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STREAM_KEY_CRC32` = "' . $this->oCRNRSTN_USR->crcINT($tmp_STREAM_KEY) . '"
                                AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`BASSDRIVE_LOG_ID` = "' . $mysqli->real_escape_string($tmp_BASSDRIVE_LOG_ID) . '"
                                AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`BASSDRIVE_LOG_ID_CRC32` = "' . $this->oCRNRSTN_USR->crcINT($tmp_BASSDRIVE_LOG_ID) . '"
                                AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`ISACTIVE` = 1
                                AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STREAM_URL` = "' . $tmp_streamURL . '" LIMIT 1;';
                                $tmp_result_set_key_REPORTING_LOG_ID = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', 'jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                                $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key_REPORTING_LOG_ID, $tmp_query);

                                //
                                // PROCESS ALL QUERY TO CONNECTION(S)
                                $this->oCRNRSTN_USR->process_query();

                                $tmp_LOG_REPORTING_count = $this->oCRNRSTN_USR->return_record_count($tmp_result_set_key_REPORTING_LOG_ID);

                                if($tmp_LOG_REPORTING_count < 3){

                                    $tmp_REPORTING_LOG_ID = $this->oCRNRSTN_USR->generate_new_key(100);
                                    $tmp_REPORTING_LOG_ID = $this->oCRNRSTN_USR->return_valid_primary_key($tmp_REPORTING_LOG_ID, 'char', 100, 'crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN , 'REPORTING_LOG_ID', 'REPORTING_LOG_ID_CRC32');

                                    //
                                    // OLD SCHOOL GRACEFUL DEGRADE FOR IF SOME KIND OF RUNTIME DATABASE ERROR SPOILS THE NEW SERIAL
                                    // GENERATION BUT MAYBE THIS COULD STILL WORK.
                                    $tmp_REPORTING_LOG_ID = $this->oCRNRSTN_USR->valid_primary_key_check($tmp_REPORTING_LOG_ID, 'char', 100);

                                    //
                                    // PREFORM INSERT
                                    $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();
                                    $tmp_query = 'INSERT INTO `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`
                                    (`REPORTING_LOG_ID`,
                                    `REPORTING_LOG_ID_CRC32`,
                                    `STREAM_KEY`,
                                    `STREAM_KEY_CRC32`,
                                    `IS_REPLAY`,
                                    `RELAY_TIMESTAMP`,
                                    `BASSDRIVE_LOG_ID`,
                                    `BASSDRIVE_LOG_ID_CRC32`,
                                    `STREAM_URL`,
                                    `STREAM_URL_IOS`,
                                    `BITRATE`,
                                    `AUDIO_FORMAT`,
                                    `LISTENER_COUNT`,
                                    `LISTENER_COUNT_PERCENTAGE`,
                                    `TITLE`,
                                    `STATS_TOTAL_CONNECTIONS`,
                                    `STATS_TOTAL_CAPACITY`,
                                    `STATS_TOTAL_BANDWIDTH`,
                                    `STATS_TOTAL_BANDWIDTH_FORMAT`,
                                    `STATS_TOTAL_UNIQUE_CONNECTIONS`,
                                    `STATS_TOTAL_UNIQUE_CAPACITY`,
                                    `STATS_TOTAL_UNIQUE_BANDWIDTH`,
                                    `STATS_TOTAL_UNIQUE_BANDWIDTH_FORMAT`,
                                    `STATS_PREMIUM_BITRATE`,
                                    `STATS_PREMIUM_BITRATE_FORMAT`,
                                    `STATS_PREMIUM_CONNECTIONS`,
                                    `STATS_PREMIUM_CAPACITY`,
                                    `STATS_PREMIUM_BANDWIDTH`,
                                    `STATS_PREMIUM_BANDWIDTH_FORMAT`,
                                    `STATS_MIDGRADE_BITRATE`,
                                    `STATS_MIDGRADE_BITRATE_FORMAT`,
                                    `STATS_MIDGRADE_CONNECTIONS`,
                                    `STATS_MIDGRADE_CAPACITY`,
                                    `STATS_MIDGRADE_BANDWIDTH`,
                                    `STATS_MIDGRADE_BANDWIDTH_FORMAT`,
                                    `STATS_AAC_PLUS_BITRATE`,
                                    `STATS_AAC_PLUS_BITRATE_FORMAT`,
                                    `STATS_AAC_PLUS_CONNECTIONS`,
                                    `STATS_AAC_PLUS_CAPACITY`,
                                    `STATS_AAC_PLUS_BANDWIDTH`,
                                    `STATS_AAC_PLUS_BANDWIDTH_FORMAT`,
                                    `STATS_RANDOM_BITRATE`,
                                    `STATS_RANDOM_BITRATE_FORMAT`,
                                    `STATS_RANDOM_CONNECTIONS`,
                                    `STATS_RANDOM_CAPACITY`,
                                    `STATS_RANDOM_BANDWIDTH`,
                                    `STATS_RANDOM_BANDWIDTH_FORMAT`,
                                    `DATEMODIFIED`)
                                    VALUES
                                    ("' . $tmp_REPORTING_LOG_ID . '",
                                    "' . $this->oCRNRSTN_USR->crcINT($tmp_REPORTING_LOG_ID) . '",
                                    "' . $mysqli->real_escape_string($tmp_STREAM_KEY) . '",
                                    "' . $this->oCRNRSTN_USR->crcINT($tmp_STREAM_KEY) . '",
                                    ' . $tmp_IS_REPLAY . ',
                                    "' . $tmp_DATEMODIFIED . '",
                                    "' . $tmp_BASSDRIVE_LOG_ID . '",
                                    "' . $this->oCRNRSTN_USR->crcINT($tmp_BASSDRIVE_LOG_ID) . '",
                                    "' . $mysqli->real_escape_string($tmp_streamURL) . '",
                                    "' . $mysqli->real_escape_string($tmp_streamURLios) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrate) . '",
                                    "' . $mysqli->real_escape_string($tmp_audioFormat) . '",
                                    "' . $mysqli->real_escape_string($tmp_listenerCount) . '",
                                    "' . $mysqli->real_escape_string($tmp_listenerCountPercentage) . '",
                                    "' . $mysqli->real_escape_string($tmp_title) . '",
                                    "' . $mysqli->real_escape_string($tmp_connections_ARRAY['total']) . '",
                                    "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['total']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['total']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['total']) . '",
                                    "' . $mysqli->real_escape_string($tmp_connections_ARRAY['totalunique']) . '",
                                    "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['totalunique']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['totalunique']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['totalunique']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrate_ARRAY['premium']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrateFormat_ARRAY['premium']) . '",
                                    "' . $mysqli->real_escape_string($tmp_connections_ARRAY['premium']) . '",
                                    "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['premium']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['premium']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['premium']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrate_ARRAY['midgrade']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrateFormat_ARRAY['midgrade']) . '",
                                    "' . $mysqli->real_escape_string($tmp_connections_ARRAY['midgrade']) . '",
                                    "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['midgrade']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['midgrade']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['midgrade']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrate_ARRAY['aacplus']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrateFormat_ARRAY['aacplus']) . '",
                                    "' . $mysqli->real_escape_string($tmp_connections_ARRAY['aacplus']) . '",
                                    "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['aacplus']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['aacplus']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['aacplus']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrate_ARRAY['random']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bitrateFormat_ARRAY['random']) . '",
                                    "' . $mysqli->real_escape_string($tmp_connections_ARRAY['random']) . '",
                                    "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['random']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['random']) . '",
                                    "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['random']) . '",
                                    "' . $ts . '");';
                                    $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', 'jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                                    $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                                }else{

                                    $tmp_REPORTING_LOG_ID = $this->oCRNRSTN_USR->return_database_value($tmp_result_set_key_REPORTING_LOG_ID, 'REPORTING_LOG_ID');

                                    //
                                    // PERFORM UPDATE
                                    $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();
                                    $tmp_query = 'UPDATE `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`
                                    SET
                                    `IS_REPLAY` = ' . $tmp_IS_REPLAY . ',
                                    `STREAM_URL_IOS` = "' . $mysqli->real_escape_string($tmp_streamURLios) . '",
                                    `BITRATE` = "' . $mysqli->real_escape_string($tmp_bitrate) . '",
                                    `AUDIO_FORMAT` = "' . $mysqli->real_escape_string($tmp_audioFormat) . '",
                                    `LISTENER_COUNT` = "' . $mysqli->real_escape_string($tmp_listenerCount) . '",
                                    `LISTENER_COUNT_PERCENTAGE` = "' . $mysqli->real_escape_string($tmp_listenerCountPercentage) . '",
                                    `TITLE` = "' . $mysqli->real_escape_string($tmp_title) . '",
                                    `STATS_TOTAL_CONNECTIONS` = "' . $mysqli->real_escape_string($tmp_connections_ARRAY['total']) . '",
                                    `STATS_TOTAL_CAPACITY` = "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['total']) . '",
                                    `STATS_TOTAL_BANDWIDTH` = "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['total']) . '",
                                    `STATS_TOTAL_BANDWIDTH_FORMAT` = "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['total']) . '",
                                    `STATS_TOTAL_UNIQUE_CONNECTIONS` = "' . $mysqli->real_escape_string($tmp_connections_ARRAY['totalunique']) . '",
                                    `STATS_TOTAL_UNIQUE_CAPACITY` = "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['totalunique']) . '",
                                    `STATS_TOTAL_UNIQUE_BANDWIDTH` = "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['totalunique']) . '",
                                    `STATS_TOTAL_UNIQUE_BANDWIDTH_FORMAT` = "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['totalunique']) . '",
                                    `STATS_PREMIUM_BITRATE` = "' . $mysqli->real_escape_string($tmp_bitrate_ARRAY['premium']) . '",
                                    `STATS_PREMIUM_BITRATE_FORMAT` = "' . $mysqli->real_escape_string($tmp_bitrateFormat_ARRAY['premium']) . '",
                                    `STATS_PREMIUM_CONNECTIONS` = "' . $mysqli->real_escape_string($tmp_connections_ARRAY['premium']) . '",
                                    `STATS_PREMIUM_CAPACITY` = "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['premium']) . '",
                                    `STATS_PREMIUM_BANDWIDTH` = "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['premium']) . '",
                                    `STATS_PREMIUM_BANDWIDTH_FORMAT` = "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['premium']) . '",
                                    `STATS_MIDGRADE_BITRATE` = "' . $mysqli->real_escape_string($tmp_bitrate_ARRAY['midgrade']) . '",
                                    `STATS_MIDGRADE_BITRATE_FORMAT` = "' . $mysqli->real_escape_string($tmp_bitrateFormat_ARRAY['midgrade']) . '",
                                    `STATS_MIDGRADE_CONNECTIONS` = "' . $mysqli->real_escape_string($tmp_connections_ARRAY['midgrade']) . '",
                                    `STATS_MIDGRADE_CAPACITY` = "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['midgrade']) . '",
                                    `STATS_MIDGRADE_BANDWIDTH` = "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['midgrade']) . '",
                                    `STATS_MIDGRADE_BANDWIDTH_FORMAT` = "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['midgrade']) . '",
                                    `STATS_AAC_PLUS_BITRATE` = "' . $mysqli->real_escape_string($tmp_bitrate_ARRAY['aacplus']) . '",
                                    `STATS_AAC_PLUS_BITRATE_FORMAT` = "' . $mysqli->real_escape_string($tmp_bitrateFormat_ARRAY['aacplus']) . '",
                                    `STATS_AAC_PLUS_CONNECTIONS` = "' . $mysqli->real_escape_string($tmp_connections_ARRAY['aacplus']) . '",
                                    `STATS_AAC_PLUS_CAPACITY` = "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['aacplus']) . '",
                                    `STATS_AAC_PLUS_BANDWIDTH` = "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['aacplus']) . '",
                                    `STATS_AAC_PLUS_BANDWIDTH_FORMAT` = "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['aacplus']) . '",
                                    `STATS_RANDOM_BITRATE` = "' . $mysqli->real_escape_string($tmp_bitrate_ARRAY['random']) . '",
                                    `STATS_RANDOM_BITRATE_FORMAT` = "' . $mysqli->real_escape_string($tmp_bitrateFormat_ARRAY['random']) . '",
                                    `STATS_RANDOM_CONNECTIONS` = "' . $mysqli->real_escape_string($tmp_connections_ARRAY['random']) . '",
                                    `STATS_RANDOM_CAPACITY` = "' . $mysqli->real_escape_string($tmp_capacity_ARRAY['random']) . '",
                                    `STATS_RANDOM_BANDWIDTH` = "' . $mysqli->real_escape_string($tmp_bandwidth_ARRAY['random']) . '",
                                    `STATS_RANDOM_BANDWIDTH_FORMAT` = "' . $mysqli->real_escape_string($tmp_bandwidthFormat_ARRAY['random']) . '",
                                    `DATEMODIFIED` = "' . $ts . '"
                                    WHERE `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`REPORTING_LOG_ID` = "' . $tmp_REPORTING_LOG_ID . '"
                                    AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`REPORTING_LOG_ID_CRC32` = "' . $this->oCRNRSTN_USR->crcINT($tmp_REPORTING_LOG_ID) . '"
                                    AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STREAM_KEY` = "' . $mysqli->real_escape_string($tmp_STREAM_KEY) . '"
                                    AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STREAM_KEY_CRC32` = "' . $this->oCRNRSTN_USR->crcINT($tmp_STREAM_KEY) . '"
                                    AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`BASSDRIVE_LOG_ID` = "' . $mysqli->real_escape_string($tmp_BASSDRIVE_LOG_ID) . '"
                                    AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`BASSDRIVE_LOG_ID_CRC32` = "' . $this->oCRNRSTN_USR->crcINT($tmp_BASSDRIVE_LOG_ID) . '"
                                    AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`ISACTIVE` = 1
                                    AND `crnrstn_stream_relay_reporting_log_' . $tmp_TABLE_STRING_PATTERN . '`.`STREAM_URL` = "' . $tmp_streamURL . '" LIMIT 1;';
                                    $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', 'jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                                    $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                                }

                                //
                                // PROCESS ALL QUERY TO CONNECTION(S)
                                $this->oCRNRSTN_USR->process_query();

                                $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();
                                $tmp_query = 'UPDATE `crnrstn_global_bassdrive_log`
                                SET
                                `ISACTIVE` = 5,
                                `PROCESSING_STATE` = "LOGGED",
                                `STATUS_MESSAGE` = "Logging complete. [rtime ' . $this->oCRNRSTN_USR->wall_time() . ']",
                                `DATEMODIFIED` = "' . $ts . '"
                                WHERE `BASSDRIVE_LOG_ID` = "' . $mysqli->real_escape_string($tmp_BASSDRIVE_LOG_ID) . '"
                                AND `BASSDRIVE_LOG_ID_CRC32` = "' . $this->oCRNRSTN_USR->crcINT($tmp_BASSDRIVE_LOG_ID) . '" LIMIT 1;';
                                $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                                $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                                //
                                // PROCESS ALL QUERY TO CONNECTION(S)
                                $this->oCRNRSTN_USR->process_query();

                                //error_log(__LINE__ . ' user *END* index[' . $i . ' of ' . $tmp_LOG_BASSDRIVE_count . '] $tmp_BASSDRIVE_LOG_ID=' . $tmp_BASSDRIVE_LOG_ID);

                            }

                        }

                    }

                }

            }

            return 'success[' . $tmp_BASSDRIVE_LOG_REPORTING_SYNC_count . '] [rtime ' . $this->oCRNRSTN_USR->wall_time() . ']';

        }else{

            return 'log record set empty';

        }

    }

    private function json_data_safe_extract($json_data_ARRAY, $json_node, $data_type = 'string', $index = 0){

        //$raw_json_stats[$i]['name'];
        $data_type = strtolower($data_type);

        if(isset($json_data_ARRAY[$index][$json_node])){

            $clean_output = $json_data_ARRAY[$index][$json_node];

        }

        if(!isset($clean_output)){

            $clean_output = '';

        }

        switch($data_type){
            case 'int':
            case 'integer':

                if($clean_output == '' || $clean_output == NULL || $clean_output == 'null'){

                    return 0;

                }else{

                    return (int) $clean_output;

                }

            break;
            case 'double':
            case 'float':

                if($clean_output == '' || $clean_output == NULL || $clean_output == 'null'){

                    return 0.00;

                }else{

                    return (double) $clean_output;

                }

            break;
            default:

                //
                // STRING
                if($clean_output == '' || $clean_output == NULL || $clean_output == 'null'){

                    return '';

                }else{

                    return $clean_output;

                }

            break;

        }

    }

    public function log_bassdrive_nowplaying(){

        try{

            self::$current_relay_ojson = $this->oCRNRSTN_USR->get_url_content($this->oCRNRSTN_USR->get_resource('BASSDRIVE_RELAY_STATE'));
            self::$timestamp_ms_current_relay_ojson = self::$oLogger->returnMicroTime();

            //error_log('[2603 '. __METHOD__ .' '.print_r(self::$current_relay_ojson, true).']');
            if(!isset($this->oRELAY_MANAGER)){

                $this->oRELAY_MANAGER = new crnrstn_bassdrive_stream_relay_manager($this->oCRNRSTN_USR, self::$current_relay_ojson);

            }

            //error_log('[2609 '. __METHOD__ .' hello!] BASSDRIVE_RELAY_STATE=[' . $this->oCRNRSTN_USR->get_resource('BASSDRIVE_RELAY_STATE').']');
            if($this->oRELAY_MANAGER->is_valid_bassdrive_json()){

                $tmp_orelay = $this->oRELAY_MANAGER->return_relay_for_logging();
                //error_log(__LINE__ . ' user we have valid json. write to db.[' . $tmp_orelay->return_stream_title() . ']');

                $oCRNRSTN_MySQLi = $this->oCRNRSTN_USR->return_crnrstn_mysqli();
                $mysqli = $oCRNRSTN_MySQLi->return_conn_object();

                //
                // OLD SCHOOL GRACEFUL DEGRADE FOR IF SOME KIND OF RUNTIME DATABASE ERROR SPOILS THE
                // NEW SERIAL GENERATION BUT MAYBE THIS COULD STILL WORK.
                $tmp_BASSDRIVE_LOG_ID = $this->oCRNRSTN_USR->return_valid_primary_key($tmp_orelay->return_serial(), 'char', 100, 'crnrstn_global_bassdrive_log', 'BASSDRIVE_LOG_ID' , 'BASSDRIVE_LOG_ID_CRC32' );
                $tmp_BASSDRIVE_LOG_ID = $this->oCRNRSTN_USR->valid_primary_key_check($tmp_BASSDRIVE_LOG_ID, 'char', 100);

                $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();
                $tmp_query = 'INSERT INTO `crnrstn_global_bassdrive_log`
                (`BASSDRIVE_LOG_ID`,
                 `BASSDRIVE_LOG_ID_CRC32`,
                `PROGRAM_TITLE`,
                `STREAM_RELAY_JSON`,
                `DATEMODIFIED`,
                `DATECREATED`)
                VALUES
                (
                "' . $tmp_BASSDRIVE_LOG_ID . '",
                "' . $this->oCRNRSTN_USR->crcINT($tmp_BASSDRIVE_LOG_ID) . '",
                "' . $mysqli->real_escape_string($tmp_orelay->return_stream_title()) . '",
                "' . $mysqli->real_escape_string(self::$current_relay_ojson) . '",
                "' . $ts.'",
                "' . $ts.'");';

                //
                // add_database_query() WILL SERIALIZE THE QUERY TO THE CONNECTION PROVIDED. CRNRSTN :: SUPPORTS n+1 MYSQLI DATABASE CONNECTIONS.
                $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('LOG_BASSDRIVE', '!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
                $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

                //
                // PROCESS ALL QUERY TO CONNECTION(S)
                $this->oCRNRSTN_USR->process_query();

            }else{

                throw new Exception('CRNRSTN :: ' . $this->oCRNRSTN_USR->version_crnrstn . ' :: Invalid Bassdrive Relay JSON from URL=[' . $this->oCRNRSTN_USR->get_resource('BASSDRIVE_RELAY_STATE') . '] ERROR on ' . __METHOD__ . ' from ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . '). Where err=' . $this->oRELAY_MANAGER->return_relay_ojson_err());

            }

            return self::$timestamp_ms_current_relay_ojson;

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function table_exists($table_name){

        $oCRNRSTN_MySQLi = $this->oCRNRSTN_USR->return_crnrstn_mysqli();
        $mysqli = $oCRNRSTN_MySQLi->return_conn_object();
        $ts = $this->oCRNRSTN_USR->return_query_date_time_stamp();

        $tmp_query = 'SELECT COUNT(*) AS COUNT
        FROM information_schema.tables
        WHERE table_schema = "' . $this->oCRNRSTN_USR->wp_db_name() . '"
        AND table_name = "' . $mysqli->real_escape_string($table_name) . '"
        LIMIT 1;';

        $tmp_result_set_key = $this->oCRNRSTN_USR->load_query_profile('CRNRSTN_SYSTEM_SUPPORT_REQUEST', '!!jesus_is_my_dear_lord!', '', __LINE__, __METHOD__);
        $this->oCRNRSTN_USR->add_database_query($tmp_result_set_key, $tmp_query);

        //
        // PROCESS ALL QUERY TO CONNECTION(S)
        $this->oCRNRSTN_USR->process_query();

        $tmp_COUNT = $this->oCRNRSTN_USR->return_database_value($tmp_result_set_key, 'COUNT');

        $tmp_COUNT = ((int) $tmp_COUNT + 0) * 1;

        if($tmp_COUNT < 1){

            return false;

        }else{

            if($tmp_COUNT > 0){

                return true;

            }else{

                return false;

            }

        }

    }

    public function __destruct(){


    }

}