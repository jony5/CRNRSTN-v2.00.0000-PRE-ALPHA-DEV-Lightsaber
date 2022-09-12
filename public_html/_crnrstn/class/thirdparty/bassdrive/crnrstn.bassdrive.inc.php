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
# # C # U # S # T # O # M # # # : : # # ##
#
#  CLASS :: crnrstn_bassdrive_stream_manager
#  VERSION :: 1.00.0000
#  DATE :: November 10, 2021 @ 2217 hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: You were the best, J5. Thank you for everything. Happy birthday to you, ole buddy. - From J5
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_bassdrive_stream_manager {

    private static $oLogger;
    public $oCRNRSTN_USR;

    protected $oRELAY_MANAGER;

    private static $current_relay_ojson;
    private static $timestamp_ms_current_relay_ojson;

    private static $data_shard_max_bassdrive_streams_cnt = 1;

    public function __construct($oCRNRSTN_USR){

        $this->oCRNRSTN_USR = $oCRNRSTN_USR;
        self::$oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN_USR);

    }

    public function refresh_bassdrive_history(){

        try {

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
            // PROCESS ALL QUERY TO CONNECTION(S)
            $this->oCRNRSTN_USR->process_query(true);

            $tmp_LOG_BASSDRIVE_count = $this->oCRNRSTN_USR->return_record_count('LOG_BASSDRIVE');
            $tmp_BASSDRIVE_STREAM_COLORS_count = $this->oCRNRSTN_USR->return_record_count('BASSDRIVE_STREAM_COLORS');
            $tmp_BASSDRIVE_STREAM_SOCIAL_CONFIG_count = $this->oCRNRSTN_USR->return_record_count('BASSDRIVE_STREAM_SOCIAL_CONFIG');

            for($i = 0; $i<$tmp_LOG_BASSDRIVE_count; $i++){
                //
                // 4500
                $tmp_BASSDRIVE_LOG_ID = trim($this->oCRNRSTN_USR->return_database_value('LOG_BASSDRIVE', 'BASSDRIVE_LOG_ID', $i));
                $tmp_title = trim($this->oCRNRSTN_USR->return_database_value('LOG_BASSDRIVE', 'PROGRAM_TITLE', $i));

                error_log(__LINE__ . ' user $tmp_title=[' . $tmp_title . '] $tmp_BASSDRIVE_LOG_ID=[' . $tmp_BASSDRIVE_LOG_ID . ']');
                $tmp_json = $this->oCRNRSTN_USR->return_database_value('LOG_BASSDRIVE', 'STREAM_RELAY_JSON', $i);

                if(!isset($this->oRELAY_MANAGER)){

                    $this->oRELAY_MANAGER = new crnrstn_bassdrive_stream_relay_manager($this->oCRNRSTN_USR, $tmp_json);

                }

                //
                // DETERMINE SHOW PROFILE KEY (BASSDRIVE_STREAM.STREAM_KEY) FROM TITLE
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

        } catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
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

        try {

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
                                 * */
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
                                     * */
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

        } catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
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
                                     * */
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

        try {

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

        } catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
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

    public function __destruct() {

    }

}

#
# # C # U # S # T # O # M # # # : : # # ##
#
#  CLASS :: crnrstn_bassdrive_stream_output_controller
#  VERSION :: 1.00.0000
#  DATE :: November 11, 2021 @ 1653 hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: You're still the best, J5! - From J5
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_bassdrive_stream_output_controller{

    private static $oLogger;
    public $oCRNRSTN_USR;

    protected $stream_key;

    protected $flagged_as_live_ARRAY = array();
    protected $flagged_as_replay_ARRAY = array();

    protected $flagged_built_social_ARRAY = array();
    protected $flagged_built_colors_ARRAY = array();
    protected $flagged_built_stats_ARRAY = array();
    protected $flagged_built_title_ARRAY = array();

    private static $is_live_pattern = 'LIVE';
    private static $is_replay_pattern = 'REPLAY';

    private static $bassdrive_month_ARRAY = array();
    private static $bassdrive_day_ARRAY = array();

    public function __construct($oCRNRSTN_USR){

        $this->oCRNRSTN_USR = $oCRNRSTN_USR;
        self::$oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN_USR);

    }

    private function return_MONTH_ARRAY(){

        if(count(self::$bassdrive_month_ARRAY) > 5){

            return self::$bassdrive_month_ARRAY;

        }else{

            self::$bassdrive_month_ARRAY[] = 'Jan';
            self::$bassdrive_month_ARRAY[] = 'Feb';
            self::$bassdrive_month_ARRAY[] = 'Mar';
            self::$bassdrive_month_ARRAY[] = 'Apr';
            self::$bassdrive_month_ARRAY[] = 'May';
            self::$bassdrive_month_ARRAY[] = 'Jun';
            self::$bassdrive_month_ARRAY[] = 'Jul';
            self::$bassdrive_month_ARRAY[] = 'Aug';
            self::$bassdrive_month_ARRAY[] = 'Sept';
            self::$bassdrive_month_ARRAY[] = 'Oct';
            self::$bassdrive_month_ARRAY[] = 'Nov';
            self::$bassdrive_month_ARRAY[] = 'Dec';

        }

        return self::$bassdrive_month_ARRAY;

    }

    private function return_DAY_ARRAY(){

        if(count(self::$bassdrive_day_ARRAY) > 5){

            return self::$bassdrive_day_ARRAY;

        }else{

            for($i = 31; $i > 0; $i--){

                self::$bassdrive_day_ARRAY[] = $i;

            }

        }

        return self::$bassdrive_day_ARRAY;

    }

    public function stream_title_has_date_pattern($title){

        $bassdrive_month = $this->return_MONTH_ARRAY();
        $bassdrive_day = $this->return_DAY_ARRAY();

        $tmp_MONTH_cnt = count($bassdrive_month);
        $tmp_DAY_cnt = count($bassdrive_day);

        for($i=0; $i<$tmp_MONTH_cnt; $i++){

            for($ii=0; $ii<$tmp_DAY_cnt; $ii++){

                $tmp_date_pos = strpos($title, $bassdrive_month[$i].' '.$bassdrive_day[$ii]);
                if($tmp_date_pos !== false){

                    return true;

                }

            }

        }

    }

    public function throw_flag_as_replay($STREAM_KEY = null){

        if(!isset($STREAM_KEY)){

            $this->flagged_as_replay_ARRAY[self::$is_replay_pattern.$this->stream_key] = 1;

        }else{

            $this->flagged_as_replay_ARRAY[self::$is_replay_pattern.$STREAM_KEY] = 1;

        }

    }

    public function throw_flag_as_live($STREAM_KEY = null){

        if(!isset($STREAM_KEY)){

            $this->flagged_as_live_ARRAY[self::$is_live_pattern.$this->stream_key] = 1;

        }else{

            $this->flagged_as_live_ARRAY[self::$is_live_pattern.$STREAM_KEY] = 1;

        }

    }

    public function flagged_as_replay($STREAM_KEY = null){

        if(!isset($STREAM_KEY)){

            if(isset($this->flagged_as_replay_ARRAY[self::$is_replay_pattern.$this->stream_key])){

                return true;

            }else{

                return false;

            }

        }else{

            if(isset($this->flagged_as_replay_ARRAY[self::$is_replay_pattern.$STREAM_KEY])){

                return true;

            }else{

                return false;

            }

        }

    }

    public function flagged_as_live($STREAM_KEY = null){

        if(!isset($STREAM_KEY)){

            if(isset($this->flagged_as_live_ARRAY[self::$is_live_pattern.$this->stream_key])){

                return true;

            }else{

                return false;

            }

        }else{

            if(isset($this->flagged_as_live_ARRAY[self::$is_live_pattern.$STREAM_KEY])){

                return true;

            }else{

                return false;


            }
        }

    }

    public function authorize_stream_output($STREAM_KEY, $title){

        $this->stream_key = $STREAM_KEY;

        if($this->flagged_as_live() && $this->flagged_as_replay()){

            error_log(__LINE__ . ' '. __METHOD__ .' user AUTH PATH TRACE');
            return false;

        }else{

            $has_date = 0;
            if($this->stream_title_has_date_pattern($title)){

                $has_date = 1;

            }

            if($this->flagged_as_live()){

                //
                // DO WE HAVE DATE (REPLAY) INDICATOR
                if($has_date == 0){
                    error_log(__LINE__ . ' '. __METHOD__ .' user AUTH PATH TRACE');

                    return false;

                }

            }

            if($this->flagged_as_replay()){

                if($has_date == 1){
                    error_log(__LINE__ . ' '. __METHOD__ .' user AUTH PATH TRACE');

                    return false;

                }

            }

        }

        return true;

    }

    public function generate_stream_meta_colors($oQueryProfileMgr){

        //
        // WHAT WE NEED FOR HISTORY BUILD
        // COLORS META ::
        //    public function                     retrieve_data_by_id($oQueryProfileMgr, $result_set_key, $lookup_fieldname, $piped_primary_id_fields = NULL, $piped_lookup_id_data = NULL){

        $this->oCRNRSTN_USR->init_lookup_by_id($oQueryProfileMgr, 'BASSDRIVE_STREAM');
        $tmp_record_lookup_serial_ARRAY = $this->oCRNRSTN_USR->add_lookup_field_data($oQueryProfileMgr,'BASSDRIVE_STREAM', 'STREAM_KEY', $this->stream_key);
        //error_log('218 search - lookup serial array size='.sizeof($tmp_record_lookup_serial_ARRAY));
        //$tmp_record_lookup_serial_ARRAY = self::$oCRNRSTN_USR->add_lookup_field_data($oQueryProfileMgr, 'PAGE_DATA', 'PAGE_SERIAL', $tmp_page_serial);
        //error_log('220 search - lookup serial array size='.sizeof($tmp_record_lookup_serial_ARRAY));

        //$tmp_page_path = $oCRNRSTN_USR->retrieve_data_by_id($oQueryProfileMgr, 'PAGE_DATA','CONTENT_PATH','CONTENT_ID', $tmp_content_id);
        //$tmp_page_path = $oCRNRSTN_USR->retrieve_data_by_id($oQueryProfileMgr, 'PAGE_DATA','CONTENT_PATH','CONTENT_ID|PAGE_SERIAL', $tmp_content_id.'|'.$tmp_page_serial);
        //$tmp_page_path = self::$oCRNRSTN_USR->retrieve_data_by_id($oQueryProfileMgr, 'PAGE_DATA', 'CONTENT_PATH');


        $colors_name_key = $this->oCRNRSTN_USR->retrieve_data_by_id($oQueryProfileMgr,'BASSDRIVE_STREAM', 'STREAM_KEY', 'COLORS_NAME_KEY');
        error_log(__LINE__ . ' '. __METHOD__ .' user AUTH PATH TRACE');


        echo '<br><br><br>' . $this->stream_key. '<---->' . $colors_name_key;
        die();

        $this->flagged_built_colors_ARRAY[$this->stream_key] = '<div class="colors_img_wrapper"><img src="' . $this->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP') . $this->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/' . $national_colors_img_file . '" width="64" height="32" alt="LONDON, UK" title="National flag for LONDON, UK"></div>
        <div class="cb"></div>
        <div class="colors_city_state">LONDON, UK</div>';

    }

    public function generate_stream_meta_social($oQueryProfileMgr){

        // SOCIAL META (LOCALIZED JSON) ::

        /*

        <div>
            <div class="colors_show_title_wrapper">The just on  track show with Ashatack<br><span class="player-host"><span style="color:#F00; font-weight: bold;">Live</span></span>
                <div class="cb"></div>
                <div id="bassdrive_social_wrapper" class="bassdrive_social_wrapper">
                    <div class="bassdrive_social_link stream_soundcloud" onclick="launch_newwindow('https://soundcloud.com/ashatack'); return false;" style="background-image:url(http://jony5.com/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=42020173.1635649010.0)"></div><div class="hidden">Click <a href="https://soundcloud.com/ashatack" target="_blank">here</a> for the The just on  track show with Ashatack<br><span class="player-host">Live</span> SoundCloud playlist.</div>


                    <div class="bassdrive_social_link stream_twitter" onclick="launch_newwindow('https://twitter.com/Ashatack68'); return false;" style="background-image:url(http://jony5.com/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=42020173.1635649010.0)"></div><div class="hidden">Click <a href="https://twitter.com/Ashatack68" target="_blank">here</a> for the The just on  track show with Ashatack<br><span class="player-host">Live</span> Twitter feed.</div>

                    <div class="bassdrive_social_link stream_www" onclick="launch_newwindow('https://www.twitch.tv/ashatack68'); return false;" style="background-image:url(http://jony5.com/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=42020173.1635649010.0)"></div><div class="hidden">Click <a href="https://www.twitch.tv/ashatack68" target="_blank">here</a> for the website of The just on  track show with Ashatack<br><span class="player-host">Live</span>.</div>
                    <div class="bassdrive_social_link stream_paypal" onclick="launch_newwindow('https://www.paypal.com/donate?hosted_button_id=GWNVTUTPEAA8C'); return false;" style="background-image:url(http://jony5.com/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=42020173.1635649010.0)"></div><div class="hidden">Click <a href="https://www.paypal.com/donate?hosted_button_id=GWNVTUTPEAA8C" target="_blank">here</a> to make a donation to Bassdrive.</div>
                    <div class="bassdrive_social_link stream_json" onclick="launch_newwindow('http://jony5.com/_proxy/bassdrive_colors/?stream=y0NXmHUd7pz5pqgZahU2KAvFXWCXxPOsUKlD6rI5t3dP0WiuJzakPQXZBn2OkuTf'); return false;" style="background-image:url(http://jony5.com/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=42020173.1635649010.0)"></div>
                    <div class="cb"></div>
                </div>
            </div>
            <div class="colors_wrapper">
                <div class="colors_img_wrapper"><img src="http://jony5.com/common/imgs/bassdrive_component_creative/flag_united_kingdom.gif" width="64" height="32" alt="LONDON, UK" title="National flag for LONDON, UK"></div>
                <div class="cb"></div>
                <div class="colors_city_state">LONDON, UK</div>
                <div class="cb"></div>
                <div class="colors_show_date_generated"><span style="font-weight: bold;">Generated on:&nbsp;&nbsp;</span>Thursday, Nov. 11 at 17:42:05 EST</div>
            </div>
        </div>
        <div class="colors_hr_wrapper"><div class="colors_hr"></div></div>
         * */
    }

    public function generate_stream_meta_title($oQueryProfileMgr){

        // TITLE FORMATTING

        /*

        <div>
            <div class="colors_show_title_wrapper">The just on  track show with Ashatack<br><span class="player-host"><span style="color:#F00; font-weight: bold;">Live</span></span>
                <div class="cb"></div>
                <div id="bassdrive_social_wrapper" class="bassdrive_social_wrapper">
                    <div class="bassdrive_social_link stream_soundcloud" onclick="launch_newwindow('https://soundcloud.com/ashatack'); return false;" style="background-image:url(http://jony5.com/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=42020173.1635649010.0)"></div><div class="hidden">Click <a href="https://soundcloud.com/ashatack" target="_blank">here</a> for the The just on  track show with Ashatack<br><span class="player-host">Live</span> SoundCloud playlist.</div>


                    <div class="bassdrive_social_link stream_twitter" onclick="launch_newwindow('https://twitter.com/Ashatack68'); return false;" style="background-image:url(http://jony5.com/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=42020173.1635649010.0)"></div><div class="hidden">Click <a href="https://twitter.com/Ashatack68" target="_blank">here</a> for the The just on  track show with Ashatack<br><span class="player-host">Live</span> Twitter feed.</div>

                    <div class="bassdrive_social_link stream_www" onclick="launch_newwindow('https://www.twitch.tv/ashatack68'); return false;" style="background-image:url(http://jony5.com/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=42020173.1635649010.0)"></div><div class="hidden">Click <a href="https://www.twitch.tv/ashatack68" target="_blank">here</a> for the website of The just on  track show with Ashatack<br><span class="player-host">Live</span>.</div>
                    <div class="bassdrive_social_link stream_paypal" onclick="launch_newwindow('https://www.paypal.com/donate?hosted_button_id=GWNVTUTPEAA8C'); return false;" style="background-image:url(http://jony5.com/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=42020173.1635649010.0)"></div><div class="hidden">Click <a href="https://www.paypal.com/donate?hosted_button_id=GWNVTUTPEAA8C" target="_blank">here</a> to make a donation to Bassdrive.</div>
                    <div class="bassdrive_social_link stream_json" onclick="launch_newwindow('http://jony5.com/_proxy/bassdrive_colors/?stream=y0NXmHUd7pz5pqgZahU2KAvFXWCXxPOsUKlD6rI5t3dP0WiuJzakPQXZBn2OkuTf'); return false;" style="background-image:url(http://jony5.com/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=42020173.1635649010.0)"></div>
                    <div class="cb"></div>
                </div>
            </div>
            <div class="colors_wrapper">
                <div class="colors_img_wrapper"><img src="http://jony5.com/common/imgs/bassdrive_component_creative/flag_united_kingdom.gif" width="64" height="32" alt="LONDON, UK" title="National flag for LONDON, UK"></div>
                <div class="cb"></div>
                <div class="colors_city_state">LONDON, UK</div>
                <div class="cb"></div>
                <div class="colors_show_date_generated"><span style="font-weight: bold;">Generated on:&nbsp;&nbsp;</span>Thursday, Nov. 11 at 17:42:05 EST</div>
            </div>
        </div>
        <div class="colors_hr_wrapper"><div class="colors_hr"></div></div>
         * */

    }

    public function generate_stream_meta_stats($oQueryProfileMgr){

        // STATS META

    }

    public function return_history_html(){

        //
        // HTML FOR HISTORY HTML INJECTION

        $tmp_html_out = '<div>
            <div class="colors_show_title_wrapper">The just on  track show with Ashatack<br><span class="player-host"><span style="color:#F00; font-weight: bold;">Live</span></span>
                <div class="cb"></div>
                <div id="bassdrive_social_wrapper" class="bassdrive_social_wrapper">
                    <div class="bassdrive_social_link stream_soundcloud" onclick="launch_newwindow(\'https://soundcloud.com/ashatack\'); return false;" style="background-image:url(http://jony5.com/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=42020173.1635649010.0)"></div><div class="hidden">Click <a href="https://soundcloud.com/ashatack" target="_blank">here</a> for the The just on  track show with Ashatack<br><span class="player-host">Live</span> SoundCloud playlist.</div>
                   
                    <div class="bassdrive_social_link stream_twitter" onclick="launch_newwindow(\'https://twitter.com/Ashatack68\'); return false;" style="background-image:url(http://jony5.com/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=42020173.1635649010.0)"></div><div class="hidden">Click <a href="https://twitter.com/Ashatack68" target="_blank">here</a> for the The just on  track show with Ashatack<br><span class="player-host">Live</span> Twitter feed.</div>
                    
                    <div class="bassdrive_social_link stream_www" onclick="launch_newwindow(\'https://www.twitch.tv/ashatack68\'); return false;" style="background-image:url(http://jony5.com/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=42020173.1635649010.0)"></div><div class="hidden">Click <a href="https://www.twitch.tv/ashatack68" target="_blank">here</a> for the website of The just on  track show with Ashatack<br><span class="player-host">Live</span>.</div>
                    <div class="bassdrive_social_link stream_paypal" onclick="launch_newwindow(\'https://www.paypal.com/donate?hosted_button_id=GWNVTUTPEAA8C\'); return false;" style="background-image:url(http://jony5.com/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=42020173.1635649010.0)"></div><div class="hidden">Click <a href="https://www.paypal.com/donate?hosted_button_id=GWNVTUTPEAA8C" target="_blank">here</a> to make a donation to Bassdrive.</div>
                    <div class="bassdrive_social_link stream_json" onclick="launch_newwindow(\'http://jony5.com/_proxy/bassdrive_colors/?stream=y0NXmHUd7pz5pqgZahU2KAvFXWCXxPOsUKlD6rI5t3dP0WiuJzakPQXZBn2OkuTf\'); return false;" style="background-image:url(http://jony5.com/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=42020173.1635649010.0)"></div>
                    <div class="cb"></div>
                </div>
            </div>
            <div class="colors_wrapper">
                <div class="colors_img_wrapper"><img src="http://jony5.com/common/imgs/bassdrive_component_creative/flag_united_kingdom.gif" width="64" height="32" alt="LONDON, UK" title="National flag for LONDON, UK"></div>
                <div class="cb"></div>
                <div class="colors_city_state">LONDON, UK</div>
                <div class="cb"></div>
                <div class="colors_show_date_generated"><span style="font-weight: bold;">Generated on:&nbsp;&nbsp;</span>Thursday, Nov. 11 at 17:42:05 EST</div>
            </div>
        </div>
        <div class="colors_hr_wrapper"><div class="colors_hr"></div></div>
        ';

        return $tmp_html_out;

    }

    /*
    if($this->oSTREAM_OUTPUT_CONTROLLER->){

        }

//        if(!isset($this->stream_history_log['IS_LIVE' . $tmp_STREAM_KEY]) || !isset($this->stream_history_log['REPLAY'.$tmp_STREAM_KEY])){
//
//            //
//            // IS THIS LIVE?
//            if($this->stream_is_LIVE($title)){
//
//                $tmp_stream_live_type = 'IS_LIVE';
//
//            }else{
//
//                $tmp_stream_live_type = 'REPLAY';
//
//            }
//
//
//
//            $this->stream_history_log[$tmp_stream_live_type.$tmp_STREAM_KEY] = 1;
//
//        }

        return $this->oSTREAM_OUTPUT_CONTROLLER->;
     * */


    public function __destruct() {

    }
}

#
# # C # U # S # T # O # M # # # : : # # ##
#
#  CLASS :: crnrstn_bassdrive_stream_relay_manager
#  VERSION :: 1.00.0000
#  DATE :: November 10, 2021 @ 2158 hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: In memory of my best and longest (15+ years) drinking buddy, J5,...who would have turned 16 today.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_bassdrive_stream_relay_manager {

    private static $oLogger;
    public $oCRNRSTN_USR;
    protected $oSTREAM_OUTPUT_CONTROLLER;

    protected $stream_oRELAY_ARRAY = array();
    protected $stream_oRELAY_ISACTIVE_ARRAY = array();

    private static $stream_relay_ojson_isvalid = false;
    private static $stream_relay_ojson_isvalid_err = '';
    private static $stream_relay_ojson_serial;
    private static $stream_relay_nowplaying_title;

    private static $stream_totals_bandwidth;
    private static $stream_totals_connections;
    private static $stream_totals_capacity;
    private static $stream_totals_bandwidthFormat;

    public function __construct($oCRNRSTN_USR, $oJSON = NULL){

        $this->oCRNRSTN_USR = $oCRNRSTN_USR;
        self::$oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN_USR);

        if(isset($oJSON)){

            //
            // INITIALIZE CURRENT JSON STREAM RELAY OBJECTS
            /*
             JSON OBJECT FROM PRODUCTION [11.11.2021 0039 hrs] ::
            {
               "relays" : [
                  {
                     "bitrate" : "128",
                     "status" : "1",
                     "name" : "bassdrive.radioca.st:8702",
                     "listenerCount" : "54",
                     "listenerCountPercentage" : "0.54",
                     "audioFormat" : "mp3",
                     "streamURL" : "http:\/\/bassdrive.radioca.st:8702",
                     "streamURLios" : "http:\/\/bassdrive.radioca.st:8702",
                     "title" : "Kos.Mos Music Presents Phuture - hosted by Freestylers"
                  },
                  {
                     "bitrate" : "128",
                     "status" : "1",
                     "name" : "chi.bassdrive.co:80",
                     "listenerCount" : "109",
                     "listenerCountPercentage" : "1.09",
                     "audioFormat" : "mp3",
                     "streamURL" : "http:\/\/chi.bassdrive.co:80",
                     "streamURLios" : "http:\/\/chi.bassdrive.co:80",
                     "title" : "Kos.Mos Music Presents Phuture - hosted by Freestylers"
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
                     "listenerCount" : "14",
                     "listenerCountPercentage" : "2.73",
                     "audioFormat" : "mp3",
                     "streamURL" : "http:\/\/stream.bassdrive.uk:8200",
                     "streamURLios" : "http:\/\/stream.bassdrive.uk:8200",
                     "title" : "Kos.Mos Music Presents Phuture - hosted by Freestylers"
                  }
               ],
               "stats" : [
                  {
                     "bandwidth" : 22.13,
                     "connections" : 177,
                     "name" : "Total",
                     "capacity" : 20510,
                     "bandwidthFormat" : "megabit"
                  },
                  {
                     "bandwidth" : 15.38,
                     "connections" : 123,
                     "name" : "TotalUnique",
                     "capacity" : 20510,
                     "bandwidthFormat" : "megabit"
                  },
                  {
                     "bandwidth" : 22.13,
                     "bitrateFormat" : "kilobit",
                     "bitrate" : 128,
                     "connections" : 177,
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
               "nowplaying" : [
                  {
                     "name" : "Kos.Mos Music Presents Phuture - hosted by Freestylers",
                     "label" : "Artist"
                  },
                  {
                     "name" : "Kos.Mos Music Presents Phuture - hosted by Freestylers",
                     "label" : "Title"
                  }
               ]
            }

             * */

            error_log('3313 relay mgr _construct to call load_stream_relays.');
            $this->load_stream_relays($oJSON);

        }

    }

    public function return_relay_history_html($title, $oQueryProfileMgr, $BASSDRIVE_LOG_ID = NULL){

        /*
          LOG_BASSDRIVE_PROCESSED
          LOG_BASSDRIVE
          BASSDRIVE_STREAM
          BASSDRIVE_STREAM_COLORS
          BASSDRIVE_STREAM_KEY_PATTERN_LOOKUP
          BASSDRIVE_STREAM_SOCIAL_CONFIG

        `bassdrive_stream_lookup`.`STREAM_LOOKUP_ID`,
        `bassdrive_stream_lookup`.`STREAM_KEY`,
        `bassdrive_stream_lookup`.`PATTERN_TYPE`,
        `bassdrive_stream_lookup`.`PATTERN_LENGTH`,
        `bassdrive_stream_lookup`.`STREAM_STRING_PATTERN`,
        `bassdrive_stream_lookup`.`DATEMODIFIED`,
        `bassdrive_stream_lookup`.`DATECREATED`

       */

        $this->oSTREAM_OUTPUT_CONTROLLER = new crnrstn_bassdrive_stream_output_controller($this->oCRNRSTN_USR);

        if(!$this->oCRNRSTN_USR->ping_value_existence( 'LOG_BASSDRIVE_PROCESSED', 'BASSDRIVE_LOG_ID', $BASSDRIVE_LOG_ID)){

            $tmp_STREAM_KEY = '';
            $tmp_BASSDRIVE_STREAM_KEY_PATTERN_LOOKUP_count = $this->oCRNRSTN_USR->return_record_count('BASSDRIVE_STREAM_KEY_PATTERN_LOOKUP');
            $tmp_BASSDRIVE_STREAM_SOCIAL_CONFIG_count = $this->oCRNRSTN_USR->return_record_count('BASSDRIVE_STREAM_SOCIAL_CONFIG');

            //
            // STREAM_LOOKUP PARSE TO FIND STREAM_KEY
            for($i = 0; $i < $tmp_BASSDRIVE_STREAM_KEY_PATTERN_LOOKUP_count; $i++){

                $tmp_STREAM_STRING_PATTERN = $this->oCRNRSTN_USR->return_database_value('BASSDRIVE_STREAM_KEY_PATTERN_LOOKUP', 'STRING_PATTERN', $i);

                error_log(__LINE__ . ' user pattern ' . $i . ' ' . $title . '[' . $tmp_STREAM_STRING_PATTERN . ']');

                $pos = stripos($title, $tmp_STREAM_STRING_PATTERN);
                if($pos !== false){
                    error_log(__LINE__ . ' user pattern ' . $i . ' [' . $tmp_STREAM_STRING_PATTERN . '][' . $title . ']');

                    $tmp_STREAM_KEY = $this->oCRNRSTN_USR->return_database_value('BASSDRIVE_STREAM_KEY_PATTERN_LOOKUP', 'STREAM_KEY', $i);

                    //
                    // CAN AUGMENT STRENGTH IN LAYERS OF CHECKS HERE USING
                    // HOST_NAME=[91080847] && SHOW_TITLE=[632554686] FOR TYPE OF STRING_PATTERN

                    $i = $tmp_BASSDRIVE_STREAM_KEY_PATTERN_LOOKUP_count + 1;

                }

            }

            error_log(__LINE__ . ' user die() ' . $i . ' $tmp_STREAM_KEY=['.$tmp_STREAM_KEY.'] $tmp_STREAM_STRING_PATTERN=[' . $tmp_STREAM_STRING_PATTERN . ']  $title=[' . $title . ']');

            die();

            if($this->oSTREAM_OUTPUT_CONTROLLER->authorize_stream_output($tmp_STREAM_KEY, $title)){

                //
                // WHAT WE NEED FOR HISTORY BUILD
                // COLORS META ::
                $this->oSTREAM_OUTPUT_CONTROLLER->generate_stream_meta_colors();

                // SOCIAL META (LOCALIZED JSON) ::
                $this->oSTREAM_OUTPUT_CONTROLLER->generate_stream_meta_social();

                // TITLE FORMATTING
                $this->oSTREAM_OUTPUT_CONTROLLER->generate_stream_meta_title();

                // STATS META
                $this->oSTREAM_OUTPUT_CONTROLLER->generate_stream_meta_stats();

            }

        }

        return $this->oSTREAM_OUTPUT_CONTROLLER->return_history_html();
        //return  '<br>---<br>$title['.$title.'] BASSDRIVE_STREAM_COLOR['.$tmp_BASSDRIVE_STREAM_COLORS_count.'] BASSDRIVE_STREAM_SOCIAL_CONFIG['.$tmp_BASSDRIVE_STREAM_SOCIAL_CONFIG_count.']<br>---<br>';

    }

    public function return_relay_for_logging(){

        foreach($this->stream_oRELAY_ARRAY as $index => $tmp_orelay){

            if($this->stream_oRELAY_ISACTIVE_ARRAY[$tmp_orelay->return_serial()] == 1 || $this->stream_oRELAY_ISACTIVE_ARRAY[$tmp_orelay->return_serial()] == '1') {

                return $tmp_orelay;

            }

        }

    }

    public function is_valid_bassdrive_json($oJSON = NULL){

        if(!isset($oJSON)){

            return self::$stream_relay_ojson_isvalid;

        }else{

            return $this->load_stream_relays($oJSON);

        }

    }

    public function return_relay_ojson_err(){

        return self::$stream_relay_ojson_isvalid_err;

    }

    private function load_stream_relays($oJSON){

        $oJSON = json_decode($oJSON, TRUE);
        self::$stream_relay_ojson_serial = $this->oCRNRSTN_USR->hash(print_r($oJSON, true), 'md5');

        $raw_json_nowplaying = $oJSON['nowplaying'];
        $tmp_cnt_nowplaying = count($raw_json_nowplaying);
        $raw_json_relays = $oJSON['relays'];
        $tmp_cnt_relays = count($raw_json_relays);
        $raw_json_stats = $oJSON['stats'];
        $tmp_cnt_stats = count($raw_json_stats);

        if(is_array($raw_json_relays)){

            if($tmp_cnt_relays < 1){
                self::$stream_relay_ojson_isvalid = false;
                self::$stream_relay_ojson_isvalid_err = 'Count of Bassdrive relays in PHP json_decoded Bassdrive JSON is less than 1.';
                return false;

            }

        }else{

            self::$stream_relay_ojson_isvalid = false;
            self::$stream_relay_ojson_isvalid_err = 'Unable to find {"relays":} in PHP json_decoded Bassdrive JSON.';
            return false;

        }

        //error_log(__LINE__ . ' user $raw_nowplaying['.$raw_nowplaying.'] has $raw_relays count =' . count($raw_relays));

        //
        // IF WE HAVE NOW PLAYING META, STORE IT NOW AND PASS IT INTO RELAY OBJECT CONSTRUCTOR CALLS.
        if($tmp_cnt_nowplaying > 0){

            for($i = 0; $i < $tmp_cnt_nowplaying; $i++) {

                /*
                "name" : "Ben XO - XPOSURE Records Show w\/ guest host Schematic",
                "label" : "Artist"
                 * */

                $tmp_nowplaying_name = $raw_json_nowplaying[$i]['name'];
                //$tmp_label = $oJSON['nowplaying'][$i]['label'];

                if (strlen($tmp_nowplaying_name) > 5) {

                    self::$stream_relay_nowplaying_title = $tmp_nowplaying_name;
                    $i = $tmp_cnt_nowplaying + 1;
                }

            }

        }else{

            self::$stream_relay_nowplaying_title = '';

        }

        //
        // IF WE HAVE RELAY META, FIRE RELAY OBJECT CONSTRUCTOR CALLS.
        if($tmp_cnt_relays > 0){

            for($i = 0; $i < $tmp_cnt_relays; $i++) {

                $tmp_relay_serial = $this->oCRNRSTN_USR->generate_new_key(100);

                $tmp_orelay = new crnrstn_bassdrive_stream_relay($tmp_relay_serial, self::$stream_relay_ojson_serial, self::$stream_relay_nowplaying_title);

                $tmp_orelay->load_meta($raw_json_relays[$i]);

                $this->stream_oRELAY_ISACTIVE_ARRAY[$tmp_orelay->return_serial()] = $tmp_orelay->return_isactive();
                $this->stream_oRELAY_ARRAY[] = $tmp_orelay;

            }

        }

        //
        // TOTALS STATS
        for($i = 0; $i < $tmp_cnt_stats; $i++){

            $tmp_name = $raw_json_stats[$i]['name'];

            switch($tmp_name){
                case 'Total':

                    /*
                    {
                     "bandwidth" : 22.13,
                     "connections" : 177,
                     "name" : "Total",
                     "capacity" : 20510,
                     "bandwidthFormat" : "megabit"
                    }

                     * */

                    self::$stream_totals_bandwidth = $oJSON['stats'][$i]['bandwidth'];
                    self::$stream_totals_connections = $oJSON['stats'][$i]['connections'];
                    self::$stream_totals_capacity = $oJSON['stats'][$i]['capacity'];
                    self::$stream_totals_bandwidthFormat = $oJSON['stats'][$i]['bandwidthFormat'];

                    $i = $tmp_cnt_stats + 1;

                    break;

            }
        }

        if(count($this->stream_oRELAY_ARRAY)>0){

            self::$stream_relay_ojson_isvalid = true;
            return true;

        }else{

            self::$stream_relay_ojson_isvalid = false;
            return false;

        }

    }

    public function __destruct() {

    }

}

#
# # C # U # S # T # O # M # # # : : # # ##
#
#  CLASS :: crnrstn_bassdrive_stream_relay
#  VERSION :: 1.00.0000
#  DATE :: November 10, 2021 @ 2202 hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: In memory of my boy, J5,...who would have turned 16 today if he had not kicked the bucket back in August.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_bassdrive_stream_relay {

    protected $relay_serial;
    protected $stream_relay_ojson_serial;
    protected $stream_relay_nowplaying_title;

    protected $relay_meta_ARRAY = array();
    protected $stream_relay_isactive = 0;

    public function __construct($relay_serial, $ojson_serial, $nowplaying_title){

        $this->stream_relay_ojson_serial = $ojson_serial;
        $this->stream_relay_nowplaying_title = $nowplaying_title;

        $this->relay_serial = $relay_serial;

    }

    public function return_stream_title(){

        $tmp_nowplaying_len = strlen($this->stream_relay_nowplaying_title);
        $tmp_title_len = strlen($this->relay_meta_ARRAY['title']);
        if($tmp_nowplaying_len > 5 && $tmp_nowplaying_len >= $tmp_title_len){

            return $this->stream_relay_nowplaying_title;

        }else{

            return $this->relay_meta_ARRAY['title'];

        }

    }

    public function return_serial(){

        return $this->relay_serial;

    }

    public function return_isactive(){

        return $this->stream_relay_isactive;

    }

    public function load_meta($json_relay_node){

        /*
        {
             "bitrate" : "128",
             "status" : "1",
             "name" : "stream.bassdrive.uk:8200",
             "listenerCount" : "14",
             "listenerCountPercentage" : "2.73",
             "audioFormat" : "mp3",
             "streamURL" : "http:\/\/stream.bassdrive.uk:8200",
             "streamURLios" : "http:\/\/stream.bassdrive.uk:8200",
             "title" : "Kos.Mos Music Presents Phuture - hosted by Freestylers"
        }
         * */

        //
        // RELAY IS ACTIVE
        if(isset($json_relay_node['status'])){

            if($json_relay_node['status'] == 1 || $json_relay_node['status'] == '1'){

                $this->stream_relay_isactive = 1;

            }

        }

        $this->store_local_meta('bitrate', $json_relay_node);
        $this->store_local_meta('status', $json_relay_node);
        $this->store_local_meta('name', $json_relay_node);
        $this->store_local_meta('listenerCount', $json_relay_node);
        $this->store_local_meta('listenerCountPercentage', $json_relay_node);
        $this->store_local_meta('audioFormat', $json_relay_node);
        $this->store_local_meta('streamURL', $json_relay_node);
        $this->store_local_meta('streamURLios', $json_relay_node);
        $this->store_local_meta('title', $json_relay_node);


    }

    private function store_local_meta($meta_type, $json_node){

        if(isset($json_node[$meta_type])){

            $this->relay_meta_ARRAY[$meta_type] = $json_node[$meta_type];

        }

    }

    public function __destruct() {

    }

}

#
# # C # U # S # T # O # M # # # : : # # ##
#
#  CLASS :: bassdrive_integration_data
#  VERSION :: 1.00.0000
#  DATE :: October 2, 2021 @ 1234hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION ::
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class bassdrive_integration_data {

    public $oUser;
    public $oUserEnvironment;
    public $dataBaseIntegration;

    public $bassdrive_stream_ojson;
    public $broadcast_nation;
    public $broadcast_locale;
    public $stream_info;
    public $bassdrive_stats;
    public $bassdrive_stats_conn;
    public $bassdrive_stats_throughput;
    public $bassdrive_stats_throughput_unit;
    public $bassdrive_stats_max_conn;

    public $stream_meta_ARRAY = array();
    public $stream_pattern_ARRAY = array();
    public $stream_key;
    public $stream_title;
    public $stream_has_social;
    public $stream_has_social_config_ARRAY = array();
    public $stream_social;
    public $social_sprite_serial;

    private static $social_lnk_cnt = 0;


    public function __construct($oUser, $oUserEnvironment, $dataBaseIntegration){

        $this->oUser = $oUser;
        $this->oUserEnvironment = $oUserEnvironment;
        $this->dataBaseIntegration = $dataBaseIntegration;

        $this->social_sprite_serial = filesize($this->oUser->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$this->oUser->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR').'/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png').'.'.filemtime($this->oUser->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$this->oUser->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR').'/common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png').'.0';

    }

    public function reset_cache_ttl(){

        return $this->dataBaseIntegration->expire_ttl_bassdriveData($this, $this->oUserEnvironment, 'expire_ttl_bassdriveData');

    }

    public function load_data($broadcast_nation, $stream_info, $stream_social, $bassdrive_stats, $bassdrive_stats_conn, $bassdrive_stats_throughput, $bassdrive_stats_throughput_unit, $bassdrive_stats_max_conn){

        if($this->oUser->oCRNRSTN_USR->get_resource('BASSDRIVE_INTEGRATE')){

            $this->broadcast_nation = $broadcast_nation;
            $this->stream_info = $stream_info;
            $this->stream_social = $stream_social;
            $this->bassdrive_stats = $bassdrive_stats;
            $this->bassdrive_stats_conn = $bassdrive_stats_conn;
            $this->bassdrive_stats_throughput = $bassdrive_stats_throughput;
            $this->bassdrive_stats_throughput_unit = $bassdrive_stats_throughput_unit;
            $this->bassdrive_stats_max_conn = $bassdrive_stats_max_conn;

        }

    }

    private function return_json_extracted_stream_data($json_obj){

        $tmp_stream_ARRAY = array();
        $this->bassdrive_stream_ojson = $json_obj;

        if($this->oUser->oCRNRSTN_USR->get_resource('BASSDRIVE_INTEGRATE') || strlen($this->bassdrive_stream_ojson)>10){

            $tmp_nowplaying_name = '';
            $tmp_title = '';
            $tmp_host = '';
            $json = json_decode($this->bassdrive_stream_ojson, TRUE);
            $raw_nowplaying = $json['nowplaying'];

            $raw_stats = $json['stats'];

            $tmp_stat_loop_cnt = sizeof($raw_stats);
            $tmp_nowplaying_loop_cnt = sizeof($raw_nowplaying);

            for($i = 0; $i < $tmp_stat_loop_cnt; $i++){

                $tmp_name = $json['stats'][$i]['name'];

                switch($tmp_name){
                    case 'Total':

                        /*
                         "bandwidth" : 0,
                         "bitrateFormat" : "kilobit",
                         "bitrate" : 128,
                         "connections" : null,
                         "name" : "Random",
                         "capacity" : null,
                         "bandwidthFormat" : "megabit"
                         * */

                        $tmp_bandwidth = $json['stats'][$i]['bandwidth'];
                        //$tmp_bitrateFormat = $json['stats'][$i]['bitrateFormat'];
                        //$tmp_bitrate = $json['stats'][$i]['bitrate'];
                        $tmp_connections = $json['stats'][$i]['connections'];
                        $tmp_capacity = $json['stats'][$i]['capacity'];
                        $tmp_bandwidthFormat = $json['stats'][$i]['bandwidthFormat'];

                        break;

                }
            }

            for($i = 0; $i < $tmp_nowplaying_loop_cnt; $i++){

                $tmp_name = $json['nowplaying'][$i]['name'];

                /*
                "name" : "Ben XO - XPOSURE Records Show w\/ guest host Schematic",
                "label" : "Artist"
                 * */

                $tmp_raw_nowplaying_name = $json['nowplaying'][$i]['name'];
                $tmp_label = $json['nowplaying'][$i]['label'];

                if(strlen($tmp_raw_nowplaying_name) > 5){

                    $tmp_nowplaying_name = $tmp_raw_nowplaying_name;

                    //The River City Rinse-Out *LIVE* w\/ iLL Omen
                    //Promo ZO - LIVE - FBTweet @promozo - IG @zopromo
                    //$bassdrive_nowplaying_title_ARRAY = explode('-', $tmp_raw_nowplaying_name);
                    $bassdrive_nowplaying_title_ARRAY = explode(' - ', $tmp_raw_nowplaying_name);
                    $tmp_dash_cnt = sizeof($bassdrive_nowplaying_title_ARRAY);

                    if($tmp_dash_cnt < 2){

                        $bassdrive_nowplaying_title_ARRAY = explode('hosted', $tmp_raw_nowplaying_name);

                        if($this->json_decoded_node_is_empty($bassdrive_nowplaying_title_ARRAY, 1)){

                            $tmp_title = $bassdrive_nowplaying_title_ARRAY[0];
                            $tmp_host = '';

                            $tmp_title = trim($tmp_title);

                        }else{

                            $tmp_title = $bassdrive_nowplaying_title_ARRAY[0];
                            $tmp_host = 'hosted'.$bassdrive_nowplaying_title_ARRAY[1];

                            $tmp_title = trim($tmp_title);
                            $tmp_host = trim($tmp_host);

                        }

                    }else{

                        if($tmp_dash_cnt > 2){

                            $tmp_title = trim($bassdrive_nowplaying_title_ARRAY[0]);
                            $tmp_title .= ' '.trim($bassdrive_nowplaying_title_ARRAY[1]);

                            $tmp_host = $bassdrive_nowplaying_title_ARRAY[2];

                            if(isset($bassdrive_nowplaying_title_ARRAY[3])){
                                $tmp_host = $tmp_host . ' ' . $bassdrive_nowplaying_title_ARRAY[3];
                            }

                            if(isset($bassdrive_nowplaying_title_ARRAY[4])){
                                $tmp_host = $tmp_host . ' ' . $bassdrive_nowplaying_title_ARRAY[4];
                            }

                            $tmp_title = trim($tmp_title);
                            $tmp_host = trim($tmp_host);

                        }else{

                            $tmp_title = $bassdrive_nowplaying_title_ARRAY[0];
                            $tmp_host = $bassdrive_nowplaying_title_ARRAY[1];

                            $tmp_title = trim($tmp_title);
                            $tmp_host = trim($tmp_host);

                        }

                    }

                }else{

                    //
                    // I GUESS DO NOTHING...NO DATA HERE. PERHAPS THERE IS ANOTHER NODE IN THE JSON.

                }

            }

            if($tmp_host!=""){

                $tmp_stream_info_out = $tmp_title.'<br><span class="player-host">'.$tmp_host.'</span>';

            }else{

                $tmp_stream_info_out = $tmp_title;

            }

            $tmp_stream_info_out = $this->cleanBassdriveOut($tmp_stream_info_out);
            $tmp_stream_info_out_ARRAY = $this->applyProgramTitleFormatting($tmp_stream_info_out);
            $tmp_stream_info_out = $tmp_stream_info_out_ARRAY['stream_info'];

            $tmp_stream_ARRAY['is_live'] = $tmp_stream_info_out_ARRAY['is_live'];

            if($tmp_stream_info_out_ARRAY['is_live'] == 'FALSE'){

                $pos_title = strpos($tmp_stream_info_out,'<br><span class="player-host">');
                if($pos_title !== false){

                    $tmp_stream_info_out = $this->ptrn_replace('<br><span class="player-host">', '<div class="cb_2"></div><span class="player-host">', $tmp_stream_info_out);

                }

            }

            $tmp_stream_ARRAY['title_formatted'] = html_entity_decode($tmp_stream_info_out);

            return $tmp_stream_ARRAY;

        }else{

            return '';

        }

    }

    public function refresh_expired_data($relay_endpoint, $broadcast_nation, $stream_info, $stream_social, $bassdrive_stats_conn, $bassdrive_stats_throughput, $bassdrive_stats_throughput_unit, $bassdrive_stats_max_conn){

        $tmp_relay_ojson = $this->getUrlContent($relay_endpoint);

        $this->bassdrive_stream_ojson = $tmp_relay_ojson;

        if($this->oUser->oCRNRSTN_USR->get_resource('BASSDRIVE_INTEGRATE') || strlen($this->bassdrive_stream_ojson)>10){

            $tmp_nowplaying_name = '';
            $tmp_title = '';
            $tmp_host = '';
            $json = json_decode($tmp_relay_ojson, TRUE);
            $raw_nowplaying = $json['nowplaying'];

            $raw_stats = $json['stats'];

            $tmp_stat_loop_cnt = sizeof($raw_stats);
            $tmp_nowplaying_loop_cnt = sizeof($raw_nowplaying);

            for($i = 0; $i < $tmp_stat_loop_cnt; $i++){

                $tmp_name = $json['stats'][$i]['name'];

                switch($tmp_name){
                    case 'Total':

                        /*
                         "bandwidth" : 0,
                         "bitrateFormat" : "kilobit",
                         "bitrate" : 128,
                         "connections" : null,
                         "name" : "Random",
                         "capacity" : null,
                         "bandwidthFormat" : "megabit"
                         * */

                        $tmp_bandwidth = $json['stats'][$i]['bandwidth'];
                        //$tmp_bitrateFormat = $json['stats'][$i]['bitrateFormat'];
                        //$tmp_bitrate = $json['stats'][$i]['bitrate'];
                        $tmp_connections = $json['stats'][$i]['connections'];
                        $tmp_capacity = $json['stats'][$i]['capacity'];
                        $tmp_bandwidthFormat = $json['stats'][$i]['bandwidthFormat'];

                        break;

                }

            }

            for($i = 0; $i < $tmp_nowplaying_loop_cnt; $i++){

                $tmp_name = $json['nowplaying'][$i]['name'];

                /*
                "name" : "Ben XO - XPOSURE Records Show w\/ guest host Schematic",
                "label" : "Artist"
                 * */

                $tmp_raw_nowplaying_name = $json['nowplaying'][$i]['name'];
                $tmp_label = $json['nowplaying'][$i]['label'];

                if(strlen($tmp_raw_nowplaying_name) > 5){

                    $tmp_nowplaying_name = $tmp_raw_nowplaying_name;

                    //The River City Rinse-Out *LIVE* w\/ iLL Omen
                    //Promo ZO - LIVE - FBTweet @promozo - IG @zopromo
                    //$bassdrive_nowplaying_title_ARRAY = explode('-', $tmp_raw_nowplaying_name);
                    $bassdrive_nowplaying_title_ARRAY = explode(' - ', $tmp_raw_nowplaying_name);
                    $tmp_dash_cnt = sizeof($bassdrive_nowplaying_title_ARRAY);

                    if($tmp_dash_cnt < 2){

                        $bassdrive_nowplaying_title_ARRAY = explode('hosted', $tmp_raw_nowplaying_name);

                        if($this->json_decoded_node_is_empty($bassdrive_nowplaying_title_ARRAY, 1)){

                            $tmp_title = $bassdrive_nowplaying_title_ARRAY[0];
                            $tmp_host = '';

                            $tmp_title = trim($tmp_title);

                        }else{

                            $tmp_title = $bassdrive_nowplaying_title_ARRAY[0];
                            $tmp_host = 'hosted'.$bassdrive_nowplaying_title_ARRAY[1];

                            $tmp_title = trim($tmp_title);
                            $tmp_host = trim($tmp_host);

                        }

                    }else{

                        if($tmp_dash_cnt > 2){

                            $tmp_title = trim($bassdrive_nowplaying_title_ARRAY[0]);
                            $tmp_title .= ' '.trim($bassdrive_nowplaying_title_ARRAY[1]);

                            $tmp_host = $bassdrive_nowplaying_title_ARRAY[2];

                            if(isset($bassdrive_nowplaying_title_ARRAY[3])){
                                $tmp_host = $tmp_host . ' ' . $bassdrive_nowplaying_title_ARRAY[3];
                            }

                            if(isset($bassdrive_nowplaying_title_ARRAY[4])){
                                $tmp_host = $tmp_host . ' ' . $bassdrive_nowplaying_title_ARRAY[4];
                            }

                            $tmp_title = trim($tmp_title);
                            $tmp_host = trim($tmp_host);

                        }else{

                            $tmp_title = $bassdrive_nowplaying_title_ARRAY[0];
                            $tmp_host = $bassdrive_nowplaying_title_ARRAY[1];

                            $tmp_title = trim($tmp_title);
                            $tmp_host = trim($tmp_host);

                        }

                    }

                }else{

                    //
                    // I GUESS DO NOTHING...NO DATA HERE. PERHAPS THERE IS ANOTHER NODE IN THE JSON.

                }

            }

            if($tmp_host!=""){

                $tmp_stream_info_out = $tmp_title.'<br><span class="player-host">'.$tmp_host.'</span>';

            }else{

                $tmp_stream_info_out = $tmp_title;

            }

            $tmp_stream_info_out = $this->cleanBassdriveOut($tmp_stream_info_out);
            $tmp_stream_info_out_ARRAY = $this->applyProgramTitleFormatting($tmp_stream_info_out);
            $tmp_stream_info_out = $tmp_stream_info_out_ARRAY['stream_info'];

            $tmp_db_resp_array = $this->return_stream_social_association_ARRAY($tmp_stream_info_out);

            $tmp_stream_broadcast_nation = $tmp_stream_info_out_ARRAY['broadcast_nation'];

            if(isset($tmp_db_resp_array['stream_colors_html'])){

                $tmp_stream_broadcast_nation = str_replace('<div id="nation_colors_wrapper" class="nation_colors_wrapper"></div>', $tmp_db_resp_array['stream_colors_html'], $tmp_stream_broadcast_nation);

            }

            if(!isset($tmp_db_resp_array['stream_locale'])){

                $tmp_db_resp_array['stream_locale'] = '';

            }

            $tmp_stream_locale = $tmp_db_resp_array['stream_locale'];
            //error_log(__LINE__ . ' user $tmp_stream_locale='.$tmp_stream_locale);

            if($tmp_stream_info_out_ARRAY['is_live'] == 'FALSE'){

                $pos_title = strpos($tmp_stream_info_out,'<br><span class="player-host">');
                if($pos_title !== false){

                    $tmp_stream_info_out = $this->ptrn_replace('<br><span class="player-host">', '<div class="cb_2"></div><span class="player-host">', $tmp_stream_info_out);

                }

            }

            $tmp_stream_info_out = html_entity_decode($tmp_stream_info_out);

            $this->bassdrive_stats_conn = $tmp_connections;
            $this->bassdrive_stats_max_conn = $tmp_capacity;
            $this->bassdrive_stats_throughput = $tmp_bandwidth;
            $this->bassdrive_stats_throughput_unit = $tmp_bandwidthFormat;

            //error_log(__LINE__ . ' $tmp_stream_info_out='.$tmp_stream_info_out);

            $tmp_bassdrive_stats_out = '<div style="height:15px; overflow:hidden;">
                <div class="bassdrive_stats_copy_elem" style="padding-left: 0px;">*</div>
                <div class="bassdrive_stats_copy_elem" id="crnrstn_curr_total_connections" style="padding-left:2px;">'.number_format($tmp_connections).'</div>
                <div class="bassdrive_stats_copy_elem">connections (</div>
                <div id="crnrstn_curr_total_capacity" class="bassdrive_stats_copy_elem" style="padding-left:0px;">'.number_format($tmp_capacity).'</div>
                <div id="curr_total_capacity" class="bassdrive_stats_copy_elem">max conn.) are</div>
            </div>
            <div style="height:15px; overflow:hidden; clear:both;">
                <div class="bassdrive_stats_copy_elem" style="padding-left: 7px;">pulling</div>
                <div class="bassdrive_stats_copy_elem" id="crnrstn_curr_total_bandwidth">'.$tmp_bandwidth.'</div>
                <div class="bassdrive_stats_copy_elem" id="crnrstn_curr_total_bandwidth_format" style="padding-left:2px;">'.$this->shortFormat($tmp_bandwidthFormat).'</div>
                <div class="bassdrive_stats_copy_elem" style="padding-left:0px;">/s of </div>
                <div id="crnrstn_bassdrive_situation" class="bassdrive_stats_copy_elem">'.$this->oUser->returnBassdriveSituation().'</div> 
                <div class="bassdrive_stats_copy_elem">from Bassdrive.</div>
            </div>';

            $this->stream_info = $tmp_stream_info_out;
            $this->bassdrive_stats = $tmp_bassdrive_stats_out;
            $this->broadcast_nation = $tmp_stream_broadcast_nation;
            $this->broadcast_locale = $tmp_stream_locale;

            $this->stream_social = '
                <div class="cb"></div>
                <div id="bassdrive_social_wrapper" class="bassdrive_social_wrapper">
                    ' . $this->return_social_HTML('stream_soundcloud', $tmp_db_resp_array) . $this->return_social_HTML('stream_soundcloud2', $tmp_db_resp_array) .$this->return_social_HTML('stream_soundcloud3', $tmp_db_resp_array) .'
                    ' . $this->return_social_HTML('stream_facebook', $tmp_db_resp_array) . $this->return_social_HTML('stream_facebook2', $tmp_db_resp_array) . $this->return_social_HTML('stream_facebook3', $tmp_db_resp_array) . '
                    ' . $this->return_social_HTML('stream_instagram', $tmp_db_resp_array) . $this->return_social_HTML('stream_instagram2', $tmp_db_resp_array) . $this->return_social_HTML('stream_instagram3', $tmp_db_resp_array) . '
                    ' . $this->return_social_HTML('stream_twitter', $tmp_db_resp_array) . $this->return_social_HTML('stream_twitter2', $tmp_db_resp_array) . $this->return_social_HTML('stream_twitter3', $tmp_db_resp_array) . '
                    ' . $this->return_social_HTML('stream_mixcloud', $tmp_db_resp_array) . $this->return_social_HTML('stream_mixcloud2', $tmp_db_resp_array) . $this->return_social_HTML('stream_mixcloud3', $tmp_db_resp_array) . '
                    ' . $this->return_social_HTML('stream_discogs', $tmp_db_resp_array) . $this->return_social_HTML('stream_discogs2', $tmp_db_resp_array) . $this->return_social_HTML('stream_discogs3', $tmp_db_resp_array) . '
                    ' . $this->return_social_HTML('stream_beatport', $tmp_db_resp_array) . $this->return_social_HTML('stream_beatport2', $tmp_db_resp_array) . $this->return_social_HTML('stream_beatport3', $tmp_db_resp_array) . '
                    ' . $this->return_social_HTML('stream_bandcamp', $tmp_db_resp_array) . $this->return_social_HTML('stream_bandcamp2', $tmp_db_resp_array) . $this->return_social_HTML('stream_bandcamp3', $tmp_db_resp_array) . '
                    ' . $this->return_social_HTML('stream_spotify', $tmp_db_resp_array) . $this->return_social_HTML('stream_spotify2', $tmp_db_resp_array) . $this->return_social_HTML('stream_spotify3', $tmp_db_resp_array) . '
                    ' . $this->return_social_HTML('stream_rolldabeats', $tmp_db_resp_array) . $this->return_social_HTML('stream_rolldabeats2', $tmp_db_resp_array) . $this->return_social_HTML('stream_rolldabeats3', $tmp_db_resp_array) . '
                    ' . $this->return_social_HTML('stream_youtube', $tmp_db_resp_array) . $this->return_social_HTML('stream_youtube2', $tmp_db_resp_array) . $this->return_social_HTML('stream_youtube3', $tmp_db_resp_array) . '
                    ' . $this->return_social_HTML('stream_www', $tmp_db_resp_array) . $this->return_social_HTML('stream_www2', $tmp_db_resp_array) . $this->return_social_HTML('stream_www3', $tmp_db_resp_array) . '
                    ' . $this->return_social_HTML('stream_profile', $tmp_db_resp_array) . '
                    ' . $this->return_social_HTML('stream_archives', $tmp_db_resp_array) . '
                    ' . $this->return_social_HTML('stream_paypal', $tmp_db_resp_array) . '
                    ' . $this->return_social_HTML('stream_json', $tmp_db_resp_array) . '
                    ' . $this->return_social_HTML('stream_history', $tmp_db_resp_array) . '
                    <div class="cb"></div>
                    <div id="bassdrive_history_popup_wrapper"><div id="bassdrive_history_close_wrapper"><div id="bassdrive_history_close" onclick="bassdrive_close_history();">X</div></div><div id="bassdrive_history_popup"></div></div>
                </div>
            ';

        }

    }

    private function json_decoded_node_is_empty($json_decoded_ARRAY, $index){

        if(isset($json_decoded_ARRAY[$index])){

            if($json_decoded_ARRAY[$index] == ''){

                return true;

            }else{

                return false;

            }

        }else{

            return true;

        }

    }

    //
    // CURL BASSDRIVE NOW PLAYING INFO
    private function getUrlContent($url){

        // https://www.php.net/manual/en/function.curl-init.php
        $opts = array(
            'http' => array (
                'method'=>"POST",
                'header'=>
                    "Accept-language: en\r\n".
                    "Content-type: application/x-www-form-urlencoded\r\n",
                'content'=>http_build_query(array('foo'=>'bar'))
            )
        );

        $context = stream_context_create($opts);

        $fp = fopen($url, 'r', false, $context);

        $contents = '';
        while (!feof($fp)){
            // https://stackoverflow.com/questions/3308388/fopen-returns-resource-id-4
            // https://www.php.net/manual/en/function.fread.php
            $contents .= fread($fp, 8192);

        }

        fclose($fp);

        return $contents;

        //$debugMode = 0;
        //$oLogger = new crnrstn_logging($debugMode);
//
//        $header=array(
//            'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36',
//            'X-Requested-With: XMLHttpRequest',
//            'Host: www.bassdrive.com',
//            'Accept: text/html, */*; q=0.01',
//            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
//            'Accept-Language: en-US,en;q=0.9,zh-CN;q=0.8,zh;q=0.7',
//            'Accept-Encoding: gzip,deflate',
//            'Referer: '.$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR'),
//            'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7',
//            'Keep-Alive: 115',
//            'Connection: keep-alive',
//        );
//
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);
//        //curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
//        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//        //curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 100);
//        curl_setopt($ch, CURLOPT_TIMEOUT, 100);
//        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
//
//        if( ! $data = curl_exec($ch)){
//            //$oLogger->captureNotice('[ERROR] CRON Fired CURL :: /_cron/bassdrive_sync/', LOG_CRIT, curl_error($ch));
//        }
//
//        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//        curl_close($ch);
//
//        return ($httpcode>=200 && $httpcode<300) ? $data : false;

    }

    private function shortFormat($data_format){
        $format = '';

        switch($data_format){
            case 'kilabit':

                $format = 'KB';

                break;
            case 'megabit':

                $format = 'MB';

                break;
            case 'gigabit':

                $format = 'GB';

                break;
            default:

                $format = '?B';

                break;

        }

        return $format;
    }

    private function cleanBassdriveOut($str){

        $patterns = array();
        $patterns[0] = "<br><span class=\"player-host\">0</span>";

        $replacements = array();
        $replacements[0] = '';

        #$str = preg_replace($patterns, $replacements, $str);
        $str = str_replace($patterns, $replacements, $str);

        return $str;

    }

    public function return_stream_social_association_ARRAY($str){

        $this->stream_title = $str;
        return $this->dataBaseIntegration->return_stream_social_association_ARRAY($this, $this->oUserEnvironment, 'return_stream_social_association_ARRAY');

    }

    private function return_social_HTML($channel, $stream_meta_ARRAY, $url = NULL){

        $channel = strtolower($channel);
        $social_channel = '';

        switch($channel) {
            case 'stream_soundcloud':
            case 'stream_soundcloud2':
            case 'stream_soundcloud3':

                $social_channel = ' for the ' . $this->stream_title . ' SoundCloud playlist';

            break;
            case 'stream_facebook':
            case 'stream_facebook2':
            case 'stream_facebook3':

                $social_channel = ' for the ' . $this->stream_title . ' Facebook page';

            break;
            case 'stream_instagram':
            case 'stream_instagram2':
            case 'stream_instagram3':

                $social_channel = ' for the ' . $this->stream_title . ' Instagram feed';

            break;
            case 'stream_twitter':
            case 'stream_twitter2':
            case 'stream_twitter3':

                $social_channel = ' for the ' . $this->stream_title . ' Twitter feed';

            break;
            case 'stream_mixcloud':
            case 'stream_mixcloud2':
            case 'stream_mixcloud3':

                $social_channel = ' for the ' . $this->stream_title . ' Mixcloud community';

            break;
            case 'stream_discogs':
            case 'stream_discogs2':
            case 'stream_discogs3':

                $social_channel = ' for the ' . $this->stream_title . ' Discogs music selection';

            break;
            case 'stream_beatport':
            case 'stream_beatport2':
            case 'stream_beatport3':

                $social_channel = ' for the ' . $this->stream_title . ' Beatport featured tracks';

            break;
            case 'stream_bandcamp':
            case 'stream_bandcamp2':
            case 'stream_bandcamp3':

                $social_channel = ' for the ' . $this->stream_title . ' Bandcamp music page';

            break;
            case 'stream_spotify':
            case 'stream_spotify2':
            case 'stream_spotify3':

                $social_channel = ' for the ' . $this->stream_title . ' Spotify community';

            break;
            case 'stream_rolldabeats':
            case 'stream_rolldabeats2':
            case 'stream_rolldabeats3':

                $social_channel = ' for the ' . $this->stream_title . ' RollDaBeats catalog';

            break;
            case 'stream_youtube':
            case 'stream_youtube2':
            case 'stream_youtube3':

                $social_channel = ' for the ' . $this->stream_title . ' YouTube channel';

            break;
            case 'stream_www':
            case 'stream_www2':
            case 'stream_www3':

                $social_channel = ' for the website of ' . $this->stream_title;

            break;
            case 'stream_profile':

                $social_channel = ' for the ' . $this->stream_title.  ' Bassdrive show profile';

            break;
            case 'stream_archives':

                $social_channel = ' for the archives of ' . $this->stream_title;

            break;
            case 'stream_paypal':

                $social_channel = ' to make a donation to Bassdrive';

            break;

        }

        switch($channel){
            case 'stream_soundcloud':
            case 'stream_facebook':
            case 'stream_instagram':
            case 'stream_twitter':
            case 'stream_mixcloud':
            case 'stream_discogs':
            case 'stream_beatport':
            case 'stream_bandcamp':
            case 'stream_spotify':
            case 'stream_rolldabeats':
            case 'stream_youtube':
            case 'stream_www':
            case 'stream_paypal':
            case 'stream_profile':
            case 'stream_archives':

                //error_log(__LINE__ . ' user ['.$channel . ']['.self::$social_lnk_cnt.']');

                if(isset($stream_meta_ARRAY[$channel])){

                    if(strlen($stream_meta_ARRAY[$channel]) > 5){

                        self::$social_lnk_cnt++;
                        $this->stream_has_social = true;

                        return '<div class="bassdrive_social_link_anchor ' . $channel . '" onclick="launch_newwindow(\'' . $stream_meta_ARRAY[$channel] . '\'); return false;"><div class="bassdrive_social_link_float ' . $channel . '"><img src="' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP') . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/social_integration_sprite_high_qual.png?v=420' . $this->social_sprite_serial .'" width="165" height="80" /></div></div><div class="hidden">Click <a href="' . $stream_meta_ARRAY[$channel] . '" target="_blank">here</a>' . $social_channel . '.</div>';

                        //return '<div class="bassdrive_social_link ' . $channel . '" onclick="launch_newwindow(\'' . $stream_meta_ARRAY[$channel] . '\'); return false;" style="background-image:url(' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=420' . $this->social_sprite_serial .')"></div><div class="hidden">Click <a href="' . $stream_meta_ARRAY[$channel] . '" target="_blank">here</a>' . $social_channel . '.</div>';

                    }else{

                        return '';

                    }

                }

            break;
            case 'stream_soundcloud2':
            case 'stream_facebook2':
            case 'stream_instagram2':
            case 'stream_twitter2':
            case 'stream_mixcloud2':
            case 'stream_discogs2':
            case 'stream_beatport2':
            case 'stream_bandcamp2':
            case 'stream_spotify2':
            case 'stream_rolldabeats2':
            case 'stream_youtube2':
            case 'stream_www2':

                if(isset($stream_meta_ARRAY[$channel])){

                    if(strlen($stream_meta_ARRAY[$channel]) > 5){
                        self::$social_lnk_cnt++;
                        $this->stream_has_social = true;

                        return '<div class="bassdrive_social_link_anchor ' . rtrim($channel,'2') . '" onclick="launch_newwindow(\'' . $stream_meta_ARRAY[$channel] . '\'); return false;"><div class="bassdrive_social_link_float ' . $channel . '"><img src="' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP') . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/social_integration_sprite_high_qual.png?v=420' . $this->social_sprite_serial .'" width="165" height="80" /></div></div><div class="hidden">Click <a href="' . $stream_meta_ARRAY[$channel] . '" target="_blank">here</a>' . $social_channel . '.</div>';

                        //return '<div class="bassdrive_social_link ' . rtrim($channel,'2') . '" onclick="launch_newwindow(\'' . $stream_meta_ARRAY[$channel] . '\'); return false;" style="background-image:url(' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=420' . $this->social_sprite_serial .')"></div><div class="hidden">Click <a href="' . $stream_meta_ARRAY[$channel] . '" target="_blank">here</a>' . $social_channel . '.</div>';

                    }else{

                        return '';

                    }

                }

            break;
            case 'stream_soundcloud3':
            case 'stream_facebook3':
            case 'stream_instagram3':
            case 'stream_twitter3':
            case 'stream_mixcloud3':
            case 'stream_discogs3':
            case 'stream_beatport3':
            case 'stream_bandcamp3':
            case 'stream_spotify3':
            case 'stream_rolldabeats3':
            case 'stream_youtube3':
            case 'stream_www3':

                if(isset($stream_meta_ARRAY[$channel])){

                    if(strlen($stream_meta_ARRAY[$channel]) > 5){
                        self::$social_lnk_cnt++;
                        $this->stream_has_social = true;

                        return '<div class="bassdrive_social_link_anchor ' . rtrim($channel,'3') . '" onclick="launch_newwindow(\'' . $stream_meta_ARRAY[$channel] . '\'); return false;"><div class="bassdrive_social_link_float ' . $channel . '"><img src="' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP') . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/social_integration_sprite_high_qual.png?v=420' . $this->social_sprite_serial .'" width="165" height="80" /></div></div><div class="hidden">Click <a href="' . $stream_meta_ARRAY[$channel] . '" target="_blank">here</a>' . $social_channel . '.</div>';

                        //return '<div class="bassdrive_social_link ' . rtrim($channel,'3') . '" onclick="launch_newwindow(\'' . $stream_meta_ARRAY[$channel] . '\'); return false;" style="background-image:url(' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=420' . $this->social_sprite_serial .')"></div><div class="hidden">Click <a href="' . $stream_meta_ARRAY[$channel] . '" target="_blank">here</a>' . $social_channel . '.</div>';

                    }else{

                        return '';

                    }

                }

            break;
            case 'stream_json':

                if($channel == 'stream_json' && self::$social_lnk_cnt == 8){

                    $tmp_line_wrap = '<div class="cb"></div>';

                }else{

                    $tmp_line_wrap = '';

                }

                //
                // JSON
                if($this->stream_has_social){

                    if(isset($stream_meta_ARRAY[$channel])){

                        if(isset($url)){

                            if(strlen($stream_meta_ARRAY[$channel]) > 5){

                                return $tmp_line_wrap . '<div class="bassdrive_social_link_anchor ' . $channel . '" onclick="launch_newwindow(\'' . $url . '\'); return false;"><div class="bassdrive_social_link_float ' . $channel . '"><img src="' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP') . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/social_integration_sprite_high_qual.png?v=420' . $this->social_sprite_serial .'" width="165" height="80" /></div></div>';

                                //return $tmp_line_wrap . '<div class="bassdrive_social_link ' . $channel . '" onclick="launch_newwindow(\'' . $url . '\'); return false;" style="background-image:url(' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=420' . $this->social_sprite_serial .')"></div>';

                            }else{

                                return '';

                            }

                        }else{

                            if(strlen($stream_meta_ARRAY[$channel]) > 5){

                                return $tmp_line_wrap . '<div class="bassdrive_social_link_anchor ' . $channel . '" onclick="launch_newwindow(\''.$stream_meta_ARRAY[$channel].'\'); return false;"><div class="bassdrive_social_link_float ' . $channel . '"><img src="' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP') . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/social_integration_sprite_high_qual.png?v=420' . $this->social_sprite_serial .'" width="165" height="80" /></div></div>';

                                //return $tmp_line_wrap . '<div class="bassdrive_social_link ' . $channel . '" onclick="launch_newwindow(\''.$stream_meta_ARRAY[$channel].'\'); return false;" style="background-image:url(' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=420' . $this->social_sprite_serial .')"></div>';

                            }else{

                                return '';

                            }

                        }

                    }

                }

            break;
            case 'stream_history':

                //
                // JSON
                if($this->stream_has_social){

                    if(isset($stream_meta_ARRAY[$channel])){

                        if(strlen($stream_meta_ARRAY[$channel]) > 5){

                            return '<div class="bassdrive_social_link_anchor ' . $channel . '" onclick="bassdrive_load_history(\''.$stream_meta_ARRAY[$channel].'\'); return false;"><div class="bassdrive_social_link_float ' . $channel . '"><img src="' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP') . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/social_integration_sprite_high_qual.png?v=420' . $this->social_sprite_serial .'" width="165" height="80" /></div></div>';

                            //return '<div class="bassdrive_social_link ' . $channel . '" onclick="bassdrive_load_history(\''.$stream_meta_ARRAY[$channel].'\'); return false;" style="background-image:url(' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/social_integration_sprite_sm.png?v=420' . $this->social_sprite_serial .')"></div>';

                        }else{

                            return '';

                        }

                    }

                }

            break;
            default:

                return '';

            break;

        }

        return '';

    }

    public function bassdrive_history_output(){

        return $this->dataBaseIntegration->bassdrive_history_output($this, $this->oUserEnvironment, 'bassdrive_history_output');

    }

    public function bassdrive_rebuild_stream_history_output(){

        error_log(__LINE__ . ' user die(); RE-ARCH THIS.');
        die();
        $tmp_html = '';
        $tmp_serial_tracker =  '';
        $tmp_has_json_ARRAY = array();
        $tmp_track_match_ARRAY = array();
        $tmp_query_ARRAY = array();

        $tmp_resp = $this->dataBaseIntegration->bassdrive_colors_algorithm_output($this, $this->oUserEnvironment, 'bassdrive_colors_algorithm_output');

        foreach ($tmp_resp as $rowcnt => $chunkARRAY0){

            $tmp_display_show = false;
            $this->stream_has_social = false;

            if(isset($chunkARRAY0[3])){

                if(strlen($chunkARRAY0[3]) > 10){

                    //
                    // WE HAVE JSON DATA
                    $tmp_stream_json_ARRAY = $this->return_json_extracted_stream_data($chunkARRAY0[3]);

                    if(strlen($chunkARRAY0[1])<5){

                        //
                        // WE NEED A SERIAL IN THE DB
                        $tmp_serial = $tmp_serial_tracker = $this->oUser->generateNewKey(64);

                        $tmp_query_ARRAY[] = 'UPDATE `crnrstn_global_bassdrive_log`
                            SET
                            `SERIAL` = "' . $tmp_serial . '"
                            WHERE `ID` = ' . $chunkARRAY0[0] . ' LIMIT 1;
                        ';

                        $tmp_has_json_ARRAY[$tmp_serial] = true;

                    }else{

                        $tmp_serial_tracker = $chunkARRAY0[1];
                        $tmp_has_json_ARRAY[$chunkARRAY0[1]] = true;

                    }

                }else{

                    //
                    // WE DON'T HAVE JSON DATA
                    if(strlen($chunkARRAY0[1])<5){

                        //
                        // WE NEED A SERIAL IN THE DB
                        $tmp_serial = $tmp_serial_tracker = $this->oUser->generateNewKey(64);

                        $tmp_query_ARRAY[] = 'UPDATE `crnrstn_global_bassdrive_log`
                            SET
                            `SERIAL` = "' . $tmp_serial . '"
                            WHERE `ID` = ' . $chunkARRAY0[0] . ' LIMIT 1;
                        ';

                        $tmp_has_json_ARRAY[$tmp_serial] = false;

                    }else{

                        $tmp_serial_tracker = $chunkARRAY0[1];
                        $tmp_has_json_ARRAY[$chunkARRAY0[1]] = false;

                    }

                }

                $tmp_stream_ARRAY = $this->return_stream_data_ARRAY($chunkARRAY0[2]);

                if(!isset($tmp_stream_ARRAY['stream_key'])){

                    if(!isset($tmp_track_match_ARRAY[md5($chunkARRAY0[2])])){

                        //
                        // AN UNMONITORED FOR BROADCAST ORIGIN STREAM
                        $tmp_track_match_ARRAY[md5($chunkARRAY0[2])] = 1;
                        $tmp_display_show = true;

                    }

                }else{

                    if(!isset($tmp_track_match_ARRAY[$tmp_stream_json_ARRAY['is_live'].$tmp_stream_ARRAY['stream_key']])){

                        $tmp_track_match_ARRAY[$tmp_stream_json_ARRAY['is_live'].$tmp_stream_ARRAY['stream_key']] = 1;
                        $tmp_display_show = true;

                    }

                }

                if($tmp_display_show){

                    $tmp_db_resp_array = $tmp_stream_ARRAY['DATABASE_TRANSFER'];

                    if($tmp_stream_ARRAY['stream_flag_file_img'] == 'flag_unknown.gif'){

                        $tmp_colors_html = '<div class="colors_img_wrapper"></div>
                                <div class="cb"></div>
                                <div class="colors_city_state"></div>
                                <div class="cb"></div>
                                <div class="colors_show_date_generated"><span style="font-weight: bold;">Generated on:&nbsp;&nbsp;</span>'.date('l, M. j \a\t G:i:s T', strtotime($chunkARRAY0[4])).'</div>';

                    }else{

                        //error_log(__LINE__ . ' user '.$tmp_stream_ARRAY['stream_flag_file_img']);
                        $tmp_colors_html = '<div class="colors_img_wrapper">' . $tmp_stream_ARRAY['stream_flag_file_img'] . '</div>
                                <div class="cb"></div>
                                <div class="colors_city_state">' . $tmp_stream_ARRAY['stream_city_state_prov_nation'] . '</div>
                                <div class="cb"></div>
                                <div class="colors_show_date_generated"><span style="font-weight: bold;">Generated on:&nbsp;&nbsp;</span>'.date('l, M. j \a\t G:i:s T', strtotime($chunkARRAY0[4])).'</div>';

                    }

                    self::$social_lnk_cnt = 0;

                    if($tmp_has_json_ARRAY[$tmp_serial_tracker]){

                        $tmp_html .= '
                        <div>
                            <div class="colors_show_title_wrapper">' . $tmp_stream_json_ARRAY['title_formatted'] . '
                                <div class="cb"></div>
                                <div id="bassdrive_social_wrapper" class="bassdrive_social_wrapper">
                                    ' . $this->return_social_HTML('stream_soundcloud', $tmp_db_resp_array) . $this->return_social_HTML('stream_soundcloud2', $tmp_db_resp_array) .$this->return_social_HTML('stream_soundcloud3', $tmp_db_resp_array) .'
                                    ' . $this->return_social_HTML('stream_facebook', $tmp_db_resp_array) . $this->return_social_HTML('stream_facebook2', $tmp_db_resp_array) . $this->return_social_HTML('stream_facebook3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_instagram', $tmp_db_resp_array) . $this->return_social_HTML('stream_instagram2', $tmp_db_resp_array) . $this->return_social_HTML('stream_instagram3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_twitter', $tmp_db_resp_array) . $this->return_social_HTML('stream_twitter2', $tmp_db_resp_array) . $this->return_social_HTML('stream_twitter3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_mixcloud', $tmp_db_resp_array) . $this->return_social_HTML('stream_mixcloud2', $tmp_db_resp_array) . $this->return_social_HTML('stream_mixcloud3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_discogs', $tmp_db_resp_array) . $this->return_social_HTML('stream_discogs2', $tmp_db_resp_array) . $this->return_social_HTML('stream_discogs3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_beatport', $tmp_db_resp_array) . $this->return_social_HTML('stream_beatport2', $tmp_db_resp_array) . $this->return_social_HTML('stream_beatport3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_bandcamp', $tmp_db_resp_array) . $this->return_social_HTML('stream_bandcamp2', $tmp_db_resp_array) . $this->return_social_HTML('stream_bandcamp3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_spotify', $tmp_db_resp_array) . $this->return_social_HTML('stream_spotify2', $tmp_db_resp_array) . $this->return_social_HTML('stream_spotify3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_rolldabeats', $tmp_db_resp_array) . $this->return_social_HTML('stream_rolldabeats2', $tmp_db_resp_array) . $this->return_social_HTML('stream_rolldabeats3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_youtube', $tmp_db_resp_array) . $this->return_social_HTML('stream_youtube2', $tmp_db_resp_array) . $this->return_social_HTML('stream_youtube3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_www', $tmp_db_resp_array) . $this->return_social_HTML('stream_www2', $tmp_db_resp_array) . $this->return_social_HTML('stream_www3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_profile', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_archives', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_paypal', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_json', $tmp_db_resp_array, $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . '_proxy/bassdrive_colors/?stream=' . $tmp_serial_tracker) . '
                                    <div class="cb"></div>
                                </div>
                            </div>
                            <div class="colors_wrapper">
                                ' . $tmp_colors_html . '
                            </div>
                        </div>
                        <div class="colors_hr_wrapper"><div class="colors_hr"></div></div>
                        ';

                    }else{

                        $tmp_html .= '
                        <div>
                            <div class="colors_show_title_wrapper">' . $chunkARRAY0[2] . '
                                <div class="cb"></div>
                                <div id="bassdrive_social_wrapper" class="bassdrive_social_wrapper">
                                ' . $this->return_social_HTML('stream_soundcloud', $tmp_db_resp_array) . $this->return_social_HTML('stream_soundcloud2', $tmp_db_resp_array) .$this->return_social_HTML('stream_soundcloud3', $tmp_db_resp_array) .'
                                ' . $this->return_social_HTML('stream_facebook', $tmp_db_resp_array) . $this->return_social_HTML('stream_facebook2', $tmp_db_resp_array) . $this->return_social_HTML('stream_facebook3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_instagram', $tmp_db_resp_array) . $this->return_social_HTML('stream_instagram2', $tmp_db_resp_array) . $this->return_social_HTML('stream_instagram3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_twitter', $tmp_db_resp_array) . $this->return_social_HTML('stream_twitter2', $tmp_db_resp_array) . $this->return_social_HTML('stream_twitter3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_mixcloud', $tmp_db_resp_array) . $this->return_social_HTML('stream_mixcloud2', $tmp_db_resp_array) . $this->return_social_HTML('stream_mixcloud3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_discogs', $tmp_db_resp_array) . $this->return_social_HTML('stream_discogs2', $tmp_db_resp_array) . $this->return_social_HTML('stream_discogs3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_beatport', $tmp_db_resp_array) . $this->return_social_HTML('stream_beatport2', $tmp_db_resp_array) . $this->return_social_HTML('stream_beatport3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_bandcamp', $tmp_db_resp_array) . $this->return_social_HTML('stream_bandcamp2', $tmp_db_resp_array) . $this->return_social_HTML('stream_bandcamp3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_spotify', $tmp_db_resp_array) . $this->return_social_HTML('stream_spotify2', $tmp_db_resp_array) . $this->return_social_HTML('stream_spotify3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_rolldabeats', $tmp_db_resp_array) . $this->return_social_HTML('stream_rolldabeats2', $tmp_db_resp_array) . $this->return_social_HTML('stream_rolldabeats3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_youtube', $tmp_db_resp_array) . $this->return_social_HTML('stream_youtube2', $tmp_db_resp_array) . $this->return_social_HTML('stream_youtube3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_www', $tmp_db_resp_array) . $this->return_social_HTML('stream_www2', $tmp_db_resp_array) . $this->return_social_HTML('stream_www3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_profile', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_archives', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_paypal', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_json', $tmp_db_resp_array) . '
                                    <div class="cb"></div>
                                </div>
                            </div>
                            <div class="colors_wrapper">
                                ' . $tmp_colors_html . '
                            </div>
                            
                        </div>
                        <div class="colors_hr_wrapper"><div class="colors_hr"></div></div>
                        ';

                    }

                }

            }

        }

        if(count($tmp_query_ARRAY)>0){

            $this->dataBaseIntegration->bassdrive_serialize_streams($this, $this->oUserEnvironment, $tmp_query_ARRAY);

        }

        return $tmp_html;

    }

    public function bassdrive_colors_algorithm_output(){

        /*
        self::$query = 'SELECT `crnrstn_global_bassdrive_log`.`BASSDRIVE_LOG_ID`,
            `crnrstn_global_bassdrive_log`.`SERIAL`,
            `crnrstn_global_bassdrive_log`.`PROGRAM_TITLE`,
            `crnrstn_global_bassdrive_log`.`STREAM_RELAY_JSON`,
            `crnrstn_global_bassdrive_log`.`DATEMODIFIED`
        FROM `crnrstn_global_bassdrive_log` ORDER BY `crnrstn_global_bassdrive_log`.`ID` DESC;
        ';
        */

        $tmp_html = '';
        $tmp_serial_tracker =  '';
        $tmp_has_json_ARRAY = array();
        $tmp_track_match_ARRAY = array();
        $tmp_query_ARRAY = array();

        $tmp_resp = $this->dataBaseIntegration->bassdrive_colors_algorithm_output($this, $this->oUserEnvironment, 'bassdrive_colors_algorithm_output');

        foreach ($tmp_resp as $rowcnt => $chunkARRAY0){

            $tmp_display_show = false;
            $this->stream_has_social = false;

            if(isset($chunkARRAY0[3])){

                if(strlen($chunkARRAY0[3]) > 10){

                    //
                    // WE HAVE JSON DATA
                    $tmp_stream_json_ARRAY = $this->return_json_extracted_stream_data($chunkARRAY0[3]);

                    if(strlen($chunkARRAY0[1])<5){

                        //
                        // WE NEED A SERIAL IN THE DB
                        $tmp_serial = $tmp_serial_tracker = $this->oUser->generateNewKey(64);

                        $tmp_query_ARRAY[] = 'UPDATE `crnrstn_global_bassdrive_log`
                            SET
                            `SERIAL` = "' . $tmp_serial . '"
                            WHERE `ID` = ' . $chunkARRAY0[0] . ' LIMIT 1;
                        ';

                        $tmp_has_json_ARRAY[$tmp_serial] = true;

                    }else{

                        $tmp_serial_tracker = $chunkARRAY0[1];
                        $tmp_has_json_ARRAY[$chunkARRAY0[1]] = true;

                    }

                }else{

                    //
                    // WE DON'T HAVE JSON DATA
                    if(strlen($chunkARRAY0[1])<5){

                        //
                        // WE NEED A SERIAL IN THE DB
                        $tmp_serial = $tmp_serial_tracker = $this->oUser->generateNewKey(64);

                        $tmp_query_ARRAY[] = 'UPDATE `crnrstn_global_bassdrive_log`
                            SET
                            `SERIAL` = "' . $tmp_serial . '"
                            WHERE `ID` = ' . $chunkARRAY0[0] . ' LIMIT 1;
                        ';

                        $tmp_has_json_ARRAY[$tmp_serial] = false;

                    }else{

                        $tmp_serial_tracker = $chunkARRAY0[1];
                        $tmp_has_json_ARRAY[$chunkARRAY0[1]] = false;

                    }

                }

                $tmp_stream_ARRAY = $this->return_stream_data_ARRAY($chunkARRAY0[2]);

                if(!isset($tmp_stream_ARRAY['stream_key'])){

                    if(!isset($tmp_track_match_ARRAY[md5($chunkARRAY0[2])])){

                        //
                        // AN UNMONITORED FOR BROADCAST ORIGIN STREAM
                        $tmp_track_match_ARRAY[md5($chunkARRAY0[2])] = 1;
                        $tmp_display_show = true;

                    }

                }else{

                    if(!isset($tmp_track_match_ARRAY[$tmp_stream_json_ARRAY['is_live'].$tmp_stream_ARRAY['stream_key']])){

                        $tmp_track_match_ARRAY[$tmp_stream_json_ARRAY['is_live'].$tmp_stream_ARRAY['stream_key']] = 1;
                        $tmp_display_show = true;

                    }

                }

                if($tmp_display_show){

                    $tmp_db_resp_array = $tmp_stream_ARRAY['DATABASE_TRANSFER'];

                    if($tmp_stream_ARRAY['stream_flag_file_img'] == 'flag_unknown.gif'){

                        $tmp_colors_html = '<div class="colors_img_wrapper"></div>
                                <div class="cb"></div>
                                <div class="colors_city_state"></div>';

                    }else{

                        //error_log(__LINE__ . ' user '.$tmp_stream_ARRAY['stream_flag_file_img']);
                        $tmp_colors_html = '<div class="colors_img_wrapper">' . $tmp_stream_ARRAY['stream_flag_file_img'] . '</div>
                                <div class="cb"></div>
                                <div class="colors_city_state">' . $tmp_stream_ARRAY['stream_city_state_prov_nation'] . '</div>';

                    }

                    self::$social_lnk_cnt = 0;

                    if($tmp_has_json_ARRAY[$tmp_serial_tracker]){

                        $tmp_html .= '
                        <div>
                            <div class="colors_show_title_wrapper">' . $tmp_stream_json_ARRAY['title_formatted'] . '
                                <div class="cb"></div>
                                <div id="bassdrive_social_wrapper" class="bassdrive_social_wrapper">
                                    ' . $this->return_social_HTML('stream_soundcloud', $tmp_db_resp_array) . $this->return_social_HTML('stream_soundcloud2', $tmp_db_resp_array) .$this->return_social_HTML('stream_soundcloud3', $tmp_db_resp_array) .'
                                    ' . $this->return_social_HTML('stream_facebook', $tmp_db_resp_array) . $this->return_social_HTML('stream_facebook2', $tmp_db_resp_array) . $this->return_social_HTML('stream_facebook3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_instagram', $tmp_db_resp_array) . $this->return_social_HTML('stream_instagram2', $tmp_db_resp_array) . $this->return_social_HTML('stream_instagram3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_twitter', $tmp_db_resp_array) . $this->return_social_HTML('stream_twitter2', $tmp_db_resp_array) . $this->return_social_HTML('stream_twitter3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_mixcloud', $tmp_db_resp_array) . $this->return_social_HTML('stream_mixcloud2', $tmp_db_resp_array) . $this->return_social_HTML('stream_mixcloud3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_discogs', $tmp_db_resp_array) . $this->return_social_HTML('stream_discogs2', $tmp_db_resp_array) . $this->return_social_HTML('stream_discogs3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_beatport', $tmp_db_resp_array) . $this->return_social_HTML('stream_beatport2', $tmp_db_resp_array) . $this->return_social_HTML('stream_beatport3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_bandcamp', $tmp_db_resp_array) . $this->return_social_HTML('stream_bandcamp2', $tmp_db_resp_array) . $this->return_social_HTML('stream_bandcamp3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_spotify', $tmp_db_resp_array) . $this->return_social_HTML('stream_spotify2', $tmp_db_resp_array) . $this->return_social_HTML('stream_spotify3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_rolldabeats', $tmp_db_resp_array) . $this->return_social_HTML('stream_rolldabeats2', $tmp_db_resp_array) . $this->return_social_HTML('stream_rolldabeats3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_youtube', $tmp_db_resp_array) . $this->return_social_HTML('stream_youtube2', $tmp_db_resp_array) . $this->return_social_HTML('stream_youtube3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_www', $tmp_db_resp_array) . $this->return_social_HTML('stream_www2', $tmp_db_resp_array) . $this->return_social_HTML('stream_www3', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_profile', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_archives', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_paypal', $tmp_db_resp_array) . '
                                    ' . $this->return_social_HTML('stream_json', $tmp_db_resp_array) . '
                                    <div class="cb"></div>
                                </div>
                            </div>
                            <div class="colors_wrapper">
                                ' . $tmp_colors_html . '
                            </div>
                            <div class="colors_stream_json"><a href="' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . '_proxy/bassdrive_colors/?stream=' . $tmp_serial_tracker . '" target="_blank"><img src="' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/icon_json.gif" width="51" height="50" alt="JSON" border="0"></a></div>
                        </div>
                        <div class="colors_hr_wrapper"><div class="colors_hr"></div></div>
                        ';

                    }else{

                        $tmp_html .= '
                        <div>
                            <div class="colors_show_title_wrapper">' . $chunkARRAY0[2] . '
                                <div class="cb"></div>
                                <div id="bassdrive_social_wrapper" class="bassdrive_social_wrapper">
                                ' . $this->return_social_HTML('stream_soundcloud', $tmp_db_resp_array) . $this->return_social_HTML('stream_soundcloud2', $tmp_db_resp_array) .$this->return_social_HTML('stream_soundcloud3', $tmp_db_resp_array) .'
                                ' . $this->return_social_HTML('stream_facebook', $tmp_db_resp_array) . $this->return_social_HTML('stream_facebook2', $tmp_db_resp_array) . $this->return_social_HTML('stream_facebook3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_instagram', $tmp_db_resp_array) . $this->return_social_HTML('stream_instagram2', $tmp_db_resp_array) . $this->return_social_HTML('stream_instagram3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_twitter', $tmp_db_resp_array) . $this->return_social_HTML('stream_twitter2', $tmp_db_resp_array) . $this->return_social_HTML('stream_twitter3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_mixcloud', $tmp_db_resp_array) . $this->return_social_HTML('stream_mixcloud2', $tmp_db_resp_array) . $this->return_social_HTML('stream_mixcloud3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_discogs', $tmp_db_resp_array) . $this->return_social_HTML('stream_discogs2', $tmp_db_resp_array) . $this->return_social_HTML('stream_discogs3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_beatport', $tmp_db_resp_array) . $this->return_social_HTML('stream_beatport2', $tmp_db_resp_array) . $this->return_social_HTML('stream_beatport3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_bandcamp', $tmp_db_resp_array) . $this->return_social_HTML('stream_bandcamp2', $tmp_db_resp_array) . $this->return_social_HTML('stream_bandcamp3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_spotify', $tmp_db_resp_array) . $this->return_social_HTML('stream_spotify2', $tmp_db_resp_array) . $this->return_social_HTML('stream_spotify3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_rolldabeats', $tmp_db_resp_array) . $this->return_social_HTML('stream_rolldabeats2', $tmp_db_resp_array) . $this->return_social_HTML('stream_rolldabeats3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_youtube', $tmp_db_resp_array) . $this->return_social_HTML('stream_youtube2', $tmp_db_resp_array) . $this->return_social_HTML('stream_youtube3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_www', $tmp_db_resp_array) . $this->return_social_HTML('stream_www2', $tmp_db_resp_array) . $this->return_social_HTML('stream_www3', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_profile', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_archives', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_paypal', $tmp_db_resp_array) . '
                                ' . $this->return_social_HTML('stream_json', $tmp_db_resp_array) . '
                                    <div class="cb"></div>
                                </div>
                            </div>
                            <div class="colors_wrapper">
                                ' . $tmp_colors_html . '
                            </div>
                            
                        </div>
                        <div class="colors_hr_wrapper"><div class="colors_hr"></div></div>
                        ';

                    }

                }

            }

        }

        if(count($tmp_query_ARRAY)>0){

            $this->dataBaseIntegration->bassdrive_serialize_streams($this, $this->oUserEnvironment, $tmp_query_ARRAY);

        }

        return $tmp_html;

    }

    private function return_stream_data_ARRAY($str){
        /*
        $tmp_stream_ARRAY['stream_flag_file_img'] = <img src="' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/' . $tmp_stream_ARRAY['stream_flag_file_img'] . '" width="' . $tmp_stream_ARRAY['flag_width'] . '" height="' . $tmp_stream_ARRAY['flag_height'] . '" alt="' . $tmp_stream_ARRAY['stream_city_state_prov_nation'] . '" title="National flag for ' . $tmp_stream_ARRAY['stream_city_state_prov_nation'] . '">
        $tmp_stream_ARRAY['stream_city_state_prov_nation'] = ATL, GA, USA
        $tmp_stream_ARRAY['live_or_replay'] = LIVE
        $tmp_stream_ARRAY['stream_key']
        */

        $tmp_stream_ARRAY = array();
        $tmp_stream_ARRAY['live_or_replay'] = 'LIVE';
        $tmp_stream_ARRAY['stream_flag_file_img'] = '&nbsp;';
        $tmp_stream_ARRAY['stream_city_state_prov_nation'] = '';

        $tmp_wrk_str = $str;
        $bassdrive_for_BOLD_RED = $this->return_LIVE_ARRAY();
        $bassdrive_find_HYPER_LNK = $this->return_HYPER_ARRAY();
        $bassdrive_replace_HYPER_LNK = $this->return_LINK_ARRAY();

        $bassdrive_month = $this->return_MONTH_ARRAY();
        $bassdrive_day = $this->return_DAY_ARRAY();
        $bassdrive_specialty = $this->return_specialty_ARRAY();
        $bassdrive_specialty_out = $this->return_specialty_output_ARRAY();
        $bassdrive_broadcast_nation = $this->return_broadcast_nation_association_ARRAY();

        $bassdrive_broadcast_social_ARRAY = $this->return_stream_social_association_ARRAY($str);

        $bassdrive_broadcast_flag = $this->return_nation_flag_ARRAY();
        //$bassdrive_broadcast_scroller_content = $this->return_broadcast_scroller_content_ARRAY();

        $tmp_LIVE_cnt = sizeof($bassdrive_for_BOLD_RED);
        $tmp_HYPER_cnt = sizeof($bassdrive_find_HYPER_LNK);
        $tmp_MONTH_cnt = sizeof($bassdrive_month);
        $tmp_DAY_cnt = sizeof($bassdrive_day);
        $tmp_SPECIAL_cnt = sizeof($bassdrive_specialty);
        $tmp_SPECIALOUT_cnt = sizeof($bassdrive_specialty_out);
        $tmp_bassdrive_broadcast_nation_cnt = sizeof($bassdrive_broadcast_nation);
        $has_flag = false;
        $tmp_broadcast_nation_flag = NULL;

        if(!isset($bassdrive_broadcast_social_ARRAY['stream_colors_filename'])){

            foreach($bassdrive_broadcast_nation as $show_str => $flag_img_filename){

                $pos = stripos($tmp_wrk_str, $show_str);
                if($pos !== false && $has_flag == false){

                    if(!isset($bassdrive_broadcast_social_ARRAY['stream_locale'])){

                        $bassdrive_broadcast_social_ARRAY = array();
                        //error_log(__LINE__ . ' user ['.print_r($bassdrive_broadcast_social_ARRAY['stream_locale'], true).']');
                        $bassdrive_broadcast_social_ARRAY['stream_locale'] = '';

                    }

                    $has_flag = true;
                    $tmp_broadcast_nation_flag = $flag_img_filename;
                    //$tmp_broadcast_scroller_content = $bassdrive_broadcast_scroller_content[$show_str];
                    $tmp_broadcast_scroller_content = $bassdrive_broadcast_social_ARRAY['stream_locale'];
                    $tmp_stream_ARRAY['stream_city_state_prov_nation'] = $tmp_broadcast_scroller_content;
                    $tmp_stream_ARRAY['stream_key'] = $show_str;

                }

            }

        }else{

            if(!isset($bassdrive_broadcast_social_ARRAY['stream_locale'])){

                $bassdrive_broadcast_social_ARRAY['stream_locale'] = '';

            }

            $has_flag = true;
            $tmp_broadcast_nation_flag = $bassdrive_broadcast_social_ARRAY['stream_colors_filename'];
            $tmp_broadcast_scroller_content = $bassdrive_broadcast_social_ARRAY['stream_locale'];
            $tmp_stream_ARRAY['stream_city_state_prov_nation'] = $tmp_broadcast_scroller_content;
            $tmp_stream_ARRAY['stream_key'] = $this->stream_key;

        }

        for($i=0;$i<$tmp_LIVE_cnt;$i++) {

            $tmp_LIVE_pattern = $bassdrive_for_BOLD_RED[$i];

            $pos = stripos($tmp_wrk_str, $tmp_LIVE_pattern);
            if($pos!==false){

                $tmp_LIVE_replace = '<span style="color:#F00; font-weight: bold;">' . $tmp_LIVE_pattern .'</span>';

                $tmp_wrk_str = $this->ptrn_replace($tmp_LIVE_pattern, $tmp_LIVE_replace, $tmp_wrk_str);

                $i = $tmp_LIVE_cnt+1;

            }

        }

        for($i=0;$i<$tmp_HYPER_cnt;$i++){

            $tmp_HYPER_pattern = $bassdrive_find_HYPER_LNK[$i];

            $pos = strpos($tmp_wrk_str, $tmp_HYPER_pattern);
            if($pos!==false){

                $tmp_wrk_str = $this->ptrn_replace($tmp_HYPER_pattern, $bassdrive_replace_HYPER_LNK[$i], $tmp_wrk_str);

                $i = 1000;
            }

        }

        $isLIVE = true;

        for($i=0; $i<$tmp_MONTH_cnt; $i++){

            for($ii=0; $ii<$tmp_DAY_cnt; $ii++){

                $tmp_date_pos = strpos($tmp_wrk_str, $bassdrive_month[$i].' '.$bassdrive_day[$ii]);
                if($tmp_date_pos !== false){

                    $tmp_wrk_str = $this->ptrn_replace($bassdrive_month[$i].' '.$bassdrive_day[$ii], '<span style="background-color: #CF0202; color:#FFF; font-size:11px; font-weight:normal; padding:1px 3px 1px 3px; border-radius: 15px;"><span style="color:#CF0202;">_</span> '.$bassdrive_month[$i].' '.$bassdrive_day[$ii].' :: REPLAY <span style="color:#CF0202;">_</span></span>', $tmp_wrk_str);
                    $i = $tmp_MONTH_cnt + 1;
                    $ii = $tmp_DAY_cnt + 1;
                    $isLIVE = false;
                    $tmp_stream_ARRAY['live_or_replay'] = 'REPLAY';

                }

            }

        }

        for($i=0; $i<$tmp_SPECIAL_cnt; $i++){

            $tmp_special_pos = strpos($tmp_wrk_str, $bassdrive_specialty[$i]);

            if($tmp_special_pos !== false){

                $tmp_wrk_str = $this->ptrn_replace($bassdrive_specialty[$i], $bassdrive_specialty_out[$i], $tmp_wrk_str);

                $i = $tmp_SPECIAL_cnt + 1;

            }

        }

        //error_log(__LINE__ . ' user '.$tmp_broadcast_nation_flag);
        if(isset($tmp_broadcast_nation_flag) && strlen($tmp_broadcast_nation_flag)>7){

            list($width, $height) = getimagesize($this->oUser->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$this->oUser->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR').'/common/imgs/bassdrive_component_creative/'.$tmp_broadcast_nation_flag);

            $tmp_stream_ARRAY['stream_flag_file_img'] = '<img src="' . $this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/' . $tmp_broadcast_nation_flag . '" width="' . $width . '" height="' . $height . '" alt="' . $tmp_stream_ARRAY['stream_city_state_prov_nation'] . '" title="National flag for ' . $tmp_stream_ARRAY['stream_city_state_prov_nation'] . '">';

        }

        $tmp_stream_ARRAY['DATABASE_TRANSFER'] = $bassdrive_broadcast_social_ARRAY;

        return $tmp_stream_ARRAY;

    }

    private function applyProgramTitleFormatting($str){

        $tmp_wrk_str = $str;
        $bassdrive_for_BOLD_RED = $this->return_LIVE_ARRAY();
        $bassdrive_find_HYPER_LNK = $this->return_HYPER_ARRAY();
        $bassdrive_replace_HYPER_LNK = $this->return_LINK_ARRAY();

        $bassdrive_month = $this->return_MONTH_ARRAY();
        $bassdrive_day = $this->return_DAY_ARRAY();
        $bassdrive_specialty = $this->return_specialty_ARRAY();
        $bassdrive_specialty_out = $this->return_specialty_output_ARRAY();
        $bassdrive_broadcast_nation = $this->return_broadcast_nation_association_ARRAY();
        $bassdrive_broadcast_flag = $this->return_nation_flag_ARRAY();
        //$bassdrive_broadcast_scroller_content = $this->return_broadcast_scroller_content_ARRAY();

        $tmp_db_resp_array = $this->return_stream_social_association_ARRAY($str);

        $tmp_LIVE_cnt = sizeof($bassdrive_for_BOLD_RED);
        $tmp_HYPER_cnt = sizeof($bassdrive_find_HYPER_LNK);
        $tmp_MONTH_cnt = sizeof($bassdrive_month);
        $tmp_DAY_cnt = sizeof($bassdrive_day);
        $tmp_SPECIAL_cnt = sizeof($bassdrive_specialty);
        $tmp_SPECIALOUT_cnt = sizeof($bassdrive_specialty_out);
        $tmp_bassdrive_broadcast_nation_cnt = sizeof($bassdrive_broadcast_nation);
        $has_flag = false;
        $tmp_broadcast_nation_flag = NULL;

        foreach($bassdrive_broadcast_nation as $show_str => $flag_img_filename){

            $pos = stripos($tmp_wrk_str, $show_str);
            if($pos !== false && $has_flag == false){

                if(!isset($tmp_db_resp_array['stream_locale'])){

                    $tmp_db_resp_array['stream_locale'] = '';

                }

                $has_flag = true;
                $tmp_broadcast_nation_flag = $flag_img_filename;
                //$tmp_broadcast_scroller_content = $bassdrive_broadcast_scroller_content[$show_str];
                $tmp_broadcast_nation_title = $bassdrive_broadcast_flag[$flag_img_filename];

            }

        }

        for($i=0;$i<$tmp_LIVE_cnt;$i++) {

            $tmp_LIVE_pattern = $bassdrive_for_BOLD_RED[$i];

            $pos = stripos($tmp_wrk_str, $tmp_LIVE_pattern);
            if($pos!==false){

                $tmp_LIVE_replace = '<span style="color:#F00; font-weight: bold;">' . $tmp_LIVE_pattern .'</span>';

                $tmp_wrk_str = $this->ptrn_replace($tmp_LIVE_pattern, $tmp_LIVE_replace, $tmp_wrk_str);

                $i = $tmp_LIVE_cnt+1;

            }

        }

        for($i=0;$i<$tmp_HYPER_cnt;$i++){

            $tmp_HYPER_pattern = $bassdrive_find_HYPER_LNK[$i];

            $pos = strpos($tmp_wrk_str, $tmp_HYPER_pattern);
            if($pos!==false){

                $tmp_wrk_str = $this->ptrn_replace($tmp_HYPER_pattern, $bassdrive_replace_HYPER_LNK[$i], $tmp_wrk_str);

                //$i = 1000;
            }

        }

        $isLIVE = true;

        for($i=0; $i<$tmp_MONTH_cnt; $i++){

            for($ii=0; $ii<$tmp_DAY_cnt; $ii++){

                //error_log(__LINE__ .' bass - ['.$bassdrive_month[$i].' '.$bassdrive_day[$ii].']['..']');

                $tmp_date_pos = strpos($tmp_wrk_str, $bassdrive_month[$i].' '.$bassdrive_day[$ii]);
                if($tmp_date_pos !== false){

                    $tmp_wrk_str = $this->ptrn_replace($bassdrive_month[$i].' '.$bassdrive_day[$ii], '<span style="background-color: #CF0202; color:#FFF; font-size:11px; font-weight:normal; padding:1px 3px 1px 3px; border-radius: 15px;"><span style="color:#CF0202;">_</span> '.$bassdrive_month[$i].' '.$bassdrive_day[$ii].' :: REPLAY <span style="color:#CF0202;">_</span></span>', $tmp_wrk_str);
                    $i = $tmp_MONTH_cnt + 1;
                    $ii = $tmp_DAY_cnt + 1;
                    $isLIVE = false;

                }

            }

        }

        for($i=0; $i<$tmp_SPECIAL_cnt; $i++){

            $tmp_special_pos = strpos($tmp_wrk_str, $bassdrive_specialty[$i]);

            if($tmp_special_pos !== false){

                $tmp_wrk_str = $this->ptrn_replace($bassdrive_specialty[$i], $bassdrive_specialty_out[$i], $tmp_wrk_str);

                $i = $tmp_SPECIAL_cnt + 1;

            }

        }

        $tmp_array = array();

        if(isset($tmp_broadcast_nation_flag) && ($tmp_broadcast_nation_flag != 'flag_unknown.gif')){

            if($isLIVE == true){

                $tmp_broadcast_scroller = ':: BROADCASTING WORLDWIDE ';
                $tmp_broadcast_is_live = 'TRUE';

            }else{

                $tmp_broadcast_scroller = ':: BROADCASTED WORLDWIDE ';
                $tmp_broadcast_is_live = 'FALSE';

            }

            list($width, $height) = getimagesize($this->oUser->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$this->oUser->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR').'/common/imgs/bassdrive_component_creative/'.$tmp_broadcast_nation_flag);

            //error_log(__LINE__ . ' user ['.$tmp_db_resp_array['stream_locale'].']');
            $tmp_array['broadcast_nation'] = '<div id="broadcast_nation_wrapper">
                                            <div id="nation_colors_wrapper" class="nation_colors_wrapper"></div>
                                            <div id="bassdrive_broadcast_scroller_wrapper">
                                                <div id="bassdrive_broadcast_scroller_dyn_wrapper"></div>
                                                <div class="cb"></div>
                                            </div>
                                            <div class="hidden">
                                                <div id="bassdrive_broadcast_nation_thumb_width">'.$width.'</div>
                                                <div id="broadcast_show_original_title">'.html_entity_decode($str).'</div>
                                                <div id="broadcast_locale">'.$tmp_db_resp_array['stream_locale'].'</div>
                                                <div id="broadcast_nation_img">' . $tmp_broadcast_nation_flag . '</div>
                                                <div id="broadcast_nation_title">' . $tmp_broadcast_nation_title . '</div>
                                                <div id="broadcast_is_LIVE">'.$tmp_broadcast_is_live.'</div>
                                                <div id="component_tech_integration_driver">SERVER</div>
                                            </div>
                                            </div>';

        }else{

            $tmp_array['broadcast_nation'] = '';

        }

        $tmp_array['stream_info'] = $tmp_wrk_str;
        if(isset($tmp_broadcast_is_live)){

            $tmp_array['is_live'] = $tmp_broadcast_is_live;

        }else{

            $tmp_array['is_live'] = '';

        }

        return $tmp_array;

    }

    private function return_nation_flag_ARRAY(){

        $tmp_array = array();

        $tmp_array['flag_spain.gif'] = 'Spain';
        $tmp_array['flag_australia.gif'] = 'Australia';
        $tmp_array['flag_austria.gif'] = 'Austria';
        $tmp_array['flag_canada.gif'] = 'Canada';
        $tmp_array['flag_czech_republic.gif'] = 'Czech Republic';
        $tmp_array['flag_germany.gif'] = 'Germany';
        $tmp_array['flag_brazil.gif'] = 'Brazil';
        $tmp_array['flag_hungary.gif'] = 'Hungary';
        $tmp_array['flag_netherlands.gif'] = 'Netherlands';
        $tmp_array['flag_poland.gif'] = 'Poland';
        $tmp_array['flag_romania.gif'] = 'Romania';
        $tmp_array['flag_russia.gif'] = 'Russia';
        $tmp_array['flag_thailand.gif'] = 'Thailand';
        $tmp_array['flag_united_kingdom.gif'] = 'United Kingdom';
        $tmp_array['flag_united_states_of_america.gif'] = 'United States of America';
        $tmp_array['flag_unknown.gif'] = 'unknown';

        return $tmp_array;

    }

    private function return_stream_string_pattern_key_ARRAY(){

        $tmp_array = array();

        $tmp_array['Fuzed Funk'] = 'Fuzed Funk';
        $tmp_array['Jason Magin'] = 'Fuzed Funk';
        $tmp_array['BRYAN GEE'] = 'BRYAN GEE';
        $tmp_array['BRYANGEE'] = 'BRYAN GEE';
        $tmp_array['Audiofields'] = 'Audiofields';
        $tmp_array['Simplification'] = 'Simplification';
        $tmp_array['Melinki'] = 'Melinki';
        $tmp_array['Disturbo'] = 'Disturbo';
        $tmp_array['Redex'] = 'Redex';
        $tmp_array['Blind Judge'] = 'Blind Judge';
        $tmp_array['Rodney Rolls'] = 'Rodney Rolls';
        $tmp_array['Mod Con'] = 'Mod Con';
        $tmp_array['DJ ANDY'] = 'DJ ANDY';
        $tmp_array['BASS GO BOOM'] = 'DJ ANDY';
        $tmp_array['Bumblebee'] = 'Bumblebee';
        $tmp_array['Insideman'] = 'Insideman';
        $tmp_array['On:Ward'] = 'On:Ward';
        $tmp_array['Onward Show'] = 'On:Ward';
        $tmp_array['Fokuz Recordings'] = 'Fokuz Recordings';
        $tmp_array['STAMINA Radio'] = 'STAMINA Radio';
        $tmp_array['Launch in Session'] = 'Launch in Session';
        $tmp_array['Balearic'] = 'Balearic';
        $tmp_array['Bankbeats'] = 'Bankbeats';
        $tmp_array['Sweetpea'] = 'Sweetpea';
        $tmp_array['AudioDevice'] = 'AudioDevice';
        $tmp_array['Prague Connection'] = 'Prague Connection';
        $tmp_array['Subfactory'] = 'Subfactory';
        $tmp_array['Vital Habits'] = 'Vital Habits';
        $tmp_array['TRANSLATION SOUND'] = 'TRANSLATION SOUND';
        $tmp_array['Wadjit'] = 'Wadjit';
        $tmp_array['PROMO ZO'] = 'PROMO ZO';
        $tmp_array['DrumObsession'] = 'DrumObsession';
        $tmp_array['Skeptics'] = 'Skeptics';
        $tmp_array['BERLIN BASS'] = 'BERLIN BASS';
        $tmp_array['SCIENTIFIC RADIO'] = 'SCIENTIFIC RADIO';
        $tmp_array['NIGHT GROOVES'] = 'NIGHT GROOVES';
        $tmp_array['XPOSURE'] = 'XPOSURE';
        $tmp_array['Ben XO'] = 'XPOSURE';
        $tmp_array['Sohl'] = 'Sohl';
        $tmp_array['River City'] = 'River City';
        $tmp_array['Ill Omen'] = 'Ill Omen';
        $tmp_array['Atmospheric Alignments'] = 'Atmospheric Alignments';
        $tmp_array['Skanka'] = 'Skanka';
        $tmp_array['Northern Groove'] = 'Northern Groove';
        $tmp_array['Soulsmith'] = 'Northern Groove';
        $tmp_array['GREENROOM'] = 'GREENROOM';
        $tmp_array['Random Movement'] = 'Random Movement';
        $tmp_array['Mike Random'] = 'Random Movement';
        $tmp_array['Strictly Science'] = 'Strictly Science';
        $tmp_array['Circuitry'] = 'Circuitry';
        $tmp_array['Method One'] = 'Method One';
        $tmp_array['Power Rinse'] = 'Power Rinse';
        $tmp_array['EvanTheScientist'] = 'Power Rinse';
        $tmp_array['Trainspotting'] = 'Trainspotting';
        $tmp_array['Amnesty'] = 'Trainspotting';
        $tmp_array['A Sides'] = 'A Sides';
        $tmp_array['Eastside Sessions'] = 'A Sides';
        $tmp_array['Invaderz'] = 'Invaderz';
        $tmp_array['Saphir'] = 'Saphir';
        $tmp_array['Jay Rome'] = 'Saphir';
        $tmp_array['Funked Up'] = 'Funked Up';
        $tmp_array['DFunk'] = 'DFunk';
        $tmp_array['Ashatack'] = 'Ashatack';
        $tmp_array['Ebb & Flow'] = 'Ebb & Flow';
        $tmp_array['Optx'] = 'Ebb & Flow';
        $tmp_array['Impressions'] = 'Impressions';
        $tmp_array['Indentation'] = 'Impressions';
        $tmp_array['Australian Atmospherics'] = 'Australian Atmospherics';
        $tmp_array['Operon'] = 'Australian Atmospherics';
        $tmp_array['Vibration Sessions'] = 'Vibration Sessions';
        $tmp_array['Deep Soul'] = 'Deep Soul';
        $tmp_array['Donovan'] = 'Deep Soul';
        $tmp_array['ECLIPS3'] = 'ECLIPS3';
        $tmp_array['LQD'] = 'ECLIPS3';
        $tmp_array['Represent Radio'] = 'Represent Radio';
        $tmp_array['Squake'] = 'Squake';
        $tmp_array['SixOneOh'] = 'SixOneOh';
        $tmp_array['Resistance Radio'] = 'Resistance Radio';
        $tmp_array['John Ohms'] = 'Resistance Radio';
        $tmp_array['Phuture'] = 'Phuture';
        $tmp_array['Overfiend'] = 'Overfiend';
        $tmp_array['Hangover'] = 'Hangover';
        $tmp_array['Lamebrane'] = 'Hangover';
        $tmp_array['Schematic'] = 'Schematic';
        $tmp_array['Crucial X'] = 'Crucial X';
        $tmp_array['Spacefunk'] = 'Crucial X';
        $tmp_array['Deceit FM'] = 'Deceit FM';
        $tmp_array['Buzzy'] = 'Deceit FM';
        $tmp_array['LJHigh'] = 'LJHigh';
        $tmp_array['High Definition'] = 'LJHigh';
        $tmp_array['Warm Ears'] = 'Warm Ears';
        $tmp_array['Lab Sessions'] = 'Lab Sessions';
        $tmp_array['Incisive Rhythm'] = 'Incisive Rhythm';
        $tmp_array['Awake247'] = 'Awake247';
        $tmp_array['Awake FM'] = 'Awake247';
        $tmp_array['AwakeFM'] = 'Awake247';

        $tmp_array['Subtext'] = 'Subtext';
        $tmp_array['Phlage'] = 'Phlage';
        $tmp_array['Lost Content'] = 'Lost Content';
        $tmp_array['Tehace'] = 'Tehace';
        $tmp_array['Pyxis'] = 'Pyxis';
        $tmp_array['Aras'] = 'Aras';
        $tmp_array['Slider'] = 'Slider';

        //$tmp_array = $this->dataBaseIntegration->return_stream_string_pattern($this, $this->oUserEnvironment, 'return_stream_string_pattern');

        return $tmp_array;

    }

    private function return_stream_social_meta_ARRAY($str){

        $tmp_stream_ARRAY = array();
        //$tmp_stream_ARRAY['stream_flag_file_img'] = '';
        //$tmp_stream_ARRAY['stream_city_state_prov_nation'] = '';

        // xxxxx[0] = 'flag_united_kingdom.gif'
        $bassdrive_broadcast_nation_img_file_ARRAY = $this->return_broadcast_nation_association_ARRAY();

        $bassdrive_broadcast_flag_nomination_ARRAY = $this->return_nation_flag_ARRAY();

        $tmp_db_resp_array = $this->return_stream_social_association_ARRAY($str);
        //$bassdrive_broadcast_city_state_prov_nation_ARRAY = $this->return_broadcast_scroller_content_ARRAY();

        //$tmp_bassdrive_broadcast_nation_cnt = sizeof($bassdrive_broadcast_nation_img_file_ARRAY);
        $has_flag = false;

        foreach($bassdrive_broadcast_nation_img_file_ARRAY as $show_str => $flag_img_filename){

            $pos = stripos($str, $show_str);
            if($pos !== false && $has_flag == false){

                if(!isset($tmp_db_resp_array['stream_locale'])){

                    $tmp_db_resp_array['stream_locale'] = '';

                }

                $has_flag = true;
                $tmp_stream_ARRAY['stream_flag_file_img'] = $flag_img_filename;
                $tmp_stream_ARRAY['stream_flag_nomination'] = $bassdrive_broadcast_flag_nomination_ARRAY[$flag_img_filename];
                $tmp_stream_ARRAY['stream_city_state_prov_nation'] = $tmp_db_resp_array['stream_locale'];
                $tmp_stream_ARRAY['stream_pattern_string'] = $show_str;

            }

        }

        if(isset($tmp_stream_ARRAY['stream_flag_file_img'])){

            list($width, $height) = getimagesize($this->oUser->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$this->oUser->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR').'/common/imgs/bassdrive_component_creative/'.$tmp_stream_ARRAY['stream_flag_file_img']);

            $tmp_stream_ARRAY['stream_flag_img_width'] = $width;
            $tmp_stream_ARRAY['stream_flag_img_height'] = $height;

        }

        return $tmp_stream_ARRAY;

    }

    public function refresh_pattern_string_length(){

        return $this->dataBaseIntegration->refresh_pattern_string_length($this, $this->oUserEnvironment, 'refresh_pattern_string_length');

    }

    public function process_stream_title($pattern, $json_serial){

        $tmp_resp = array();

        // WHERE $tmp_ptrn_ARRAY[STRING_PATTERN] = STRING_KEY
        // WHERE $tmp_len_ARRAY[STRING_PATTERN] = STRING_LENGTH
        // AND WHERE $tmp_stream_key_ARRAY['PATTERN'] = $tmp_ptrn_ARRAY;
        // AND WHERE $tmp_stream_key_ARRAY['LENGTH'] = $tmp_len_ARRAY;

        $tmp_stream_key_ARRAY = $this->return_stream_string_pattern_key_ARRAY();
        $tmp_meta_array = $this->return_stream_social_meta_ARRAY($pattern);

        $tmp_pattern_ARRAY = $tmp_stream_key_ARRAY['PATTERN'];
        $tmp_len_ARRAY = $tmp_stream_key_ARRAY['LENGTH'];



        $tmp_stream_key = $tmp_pattern_ARRAY[$tmp_meta_array['stream_pattern_string']];
        error_log(__LINE__ . ' user [$pattern='.$pattern.'][$tmp_stream_key='.$tmp_stream_key.']['. print_r($tmp_meta_array, true).']');

        $this->stream_key = $tmp_stream_key;

        if(isset($tmp_meta_array['stream_flag_file_img'])){

            $tmp_resp['COLORS_NAME_KEY'][$tmp_stream_key]['COLORS_IMG_FILENAME'] = $tmp_meta_array['stream_flag_file_img'];
            $tmp_resp['COLORS_NAME_KEY'][$tmp_stream_key]['COLORS_NOMINATION'] = $tmp_meta_array['stream_flag_nomination'];
            $tmp_resp['COLORS_NAME_KEY'][$tmp_stream_key]['COLORS_IMG_WIDTH'] = $tmp_meta_array['stream_flag_img_width'];
            $tmp_resp['COLORS_NAME_KEY'][$tmp_stream_key]['COLORS_IMG_HEIGHT'] = $tmp_meta_array['stream_flag_img_height'];
            $tmp_resp['STREAM_KEY'][$tmp_stream_key]['LOCALE_CITY_STATE_PROV_NATION'] = $tmp_meta_array['stream_city_state_prov_nation'];

        }

        $tmp_resp['STREAM_KEY'][$tmp_stream_key]['LOG_JSON_SERIAL'] = $json_serial;

        /*
        ########
        bassdrive_stream
        STREAM_ID                       char(64)
        ISACTIVE                        tinyint(2)
        *STREAM_KEY                      varchar(255)
        *COLORS_NAME_KEY                 varchar(100)
        */

        $this->stream_meta_ARRAY = $tmp_resp;
        $this->stream_pattern_ARRAY = $tmp_stream_key_ARRAY;

        $tmp_resp_BOOL = $this->dataBaseIntegration->bassdrive_stream_initialization($this, $this->oUserEnvironment, 'bassdrive_stream_initialization');

//        if($tmp_resp_BOOL){
//
//            error_log(__LINE__ .' user SUCCESS bassdrive_stream ADD.');
//
//        }else{
//
//            error_log(__LINE__ .' user NO bassdrive_stream ADD.');
//
//        }

        /*
         bassdrive_stream_lookup
         STREAM_LOOKUP_ID                char(64)
         ISACTIVE                        tinyint(2)
        *STREAM_KEY                      varchar(255)
        *STREAM_KEY_CRC32

        *STREAM_STRING_PATTERN           varchar(300)
        */
        $tmp_resp_BOOL = $this->dataBaseIntegration->bassdrive_stream_lookup_sync($this, $this->oUserEnvironment, 'bassdrive_stream_lookup_sync');

//        if($tmp_resp_BOOL){
//
//            error_log(__LINE__ .' user SUCCESS bassdrive_stream_lookup ADD.');
//
//        }else{
//
//            error_log(__LINE__ .' user NO bassdrive_stream_lookup ADD.');
//
//        }

        /*
        bassdrive_stream_colors
        COLORS_ID                       char(64)
        *COLORS_NAME_KEY                 varchar(100)
        COLORS_NAME_KEY_CRC32           int(11)
        ISACTIVE                        tinyint(2)
        *COLORS_IMG_FILENAME             varchar(100)
        *COLORS_IMG_WIDTH                int(11)
        *COLORS_IMG_HEIGHT               int(11)
         * */
        $tmp_resp_BOOL = $this->dataBaseIntegration->bassdrive_stream_colors_sync($this, $this->oUserEnvironment, 'bassdrive_stream_colors_sync');

//        if($tmp_resp_BOOL){
//
//            error_log(__LINE__ .' user SUCCESS bassdrive_stream_colors_sync ADD.');
//
//        }else{
//
//            error_log(__LINE__ .' user NO bassdrive_stream_colors_sync ADD.');
//
//        }

        /*
        ########
        bassdrive_stream_social_config
        SOCIAL_ID                       char(64)
        *LOG_JSON_SERIAL                 char(64)
        *STREAM_KEY                      varchar(255)
        STREAM_KEY_CRC32                varchar(255)
        ISACTIVE                        tinyint(2)
        *LOCALE_CITY_STATE_PROV_NATION   varchar(255)

        */

        $tmp_resp_BOOL = $this->dataBaseIntegration->bassdrive_stream_social_sync($this, $this->oUserEnvironment, 'bassdrive_stream_social_sync');

//        if($tmp_resp_BOOL){
//
//            error_log(__LINE__ .' user SUCCESS bassdrive_stream_social_sync ADD.');
//
//        }else{
//
//            error_log(__LINE__ .' user NO bassdrive_stream_social_sync ADD.');
//
//        }

        return true;

    }

    public function return_stream_pattern_ARRAY(){

        /*
            INPUT ::  $this->stream_pattern_ARRAY;
            $tmp_ptrn_array['Lab Sessions'] = 'Lab Sessions';
            $tmp_ptrn_array['Incisive Rhythm'] = 'Incisive Rhythm';
            $tmp_ptrn_array['Awake247'] = 'Awake247';
            $tmp_ptrn_array['Awake FM'] = 'Awake247';
            $tmp_ptrn_array['AwakeFM'] = 'Awake247';

            $tmp_len_array['Lab Sessions'] = 9;
            $tmp_len_array['Incisive Rhythm'] = 6;
            $tmp_len_array['Awake247'] = 6;
            $tmp_len_array['Awake FM'] = 6;
            $tmp_len_array['AwakeFM'] = 6;

            OUTPUT ::
            $tmp_output_array['PATTERN']=$tmp_ptrn_array
            $tmp_output_array['LENGTH']=$tmp_len_array


            WHERE ::
            $tmp_array[SEARCH_STRING_PATTERN] = STREAM_KEY;

         * */

        $stream_pattern_ARRAY = $this->stream_pattern_ARRAY['PATTERN'];
        $tmp_array = array();
        foreach($stream_pattern_ARRAY as $pattern => $key_value){

            $tmp_array[$pattern] = $key_value;

        }

        return $tmp_array;

    }


//
//    private function return_broadcast_scroller_content_ARRAY(){
//
//        $broadcast_scroller_content_ARRAY = array();
//
//        $broadcast_scroller_content_ARRAY['Fuzed Funk'] = 'WILMINGTON, DE, USA';
//        $broadcast_scroller_content_ARRAY['Jason Magin'] = 'WILMINGTON, DE, USA';
//        $broadcast_scroller_content_ARRAY['Jay Dubz'] = 'SHREWSBURY, UK';
//        $broadcast_scroller_content_ARRAY['BRYAN GEE'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['BRYANGEE'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['Audiofields'] = 'PROVIDENCE, RHODE ISLAND, USA';
//        $broadcast_scroller_content_ARRAY['Simplification'] = 'S&Atilde;O PAULO, BRAZIL';
//        $broadcast_scroller_content_ARRAY['Melinki'] = 'HASTINGS, UK';
//        $broadcast_scroller_content_ARRAY['Disturbo'] = 'VIENNA, AUSTRIA';
//        $broadcast_scroller_content_ARRAY['Redex'] = 'VIENNA, AUSTRIA';
//        $broadcast_scroller_content_ARRAY['Blind Judge'] = 'VIENNA, AUSTRIA';
//        $broadcast_scroller_content_ARRAY['Mod Con'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['Rodney Rolls'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['DJ ANDY'] = 'S&Atilde;O PAULO, BRAZIL';
//        $broadcast_scroller_content_ARRAY['BASS GO BOOM'] = 'S&Atilde;O PAULO, BRAZIL';
//        $broadcast_scroller_content_ARRAY['Bumblebee'] = 'BERLIN, GERMANY';
//        $broadcast_scroller_content_ARRAY['Insideman'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['On:Ward'] = 'SHREWSBURY, UK';
//        $broadcast_scroller_content_ARRAY['Onward Show'] = 'SHREWSBURY, UK';
//        $broadcast_scroller_content_ARRAY['Fokuz Recordings'] = 'ROTTERDAM, NETHERLANDS';
//        $broadcast_scroller_content_ARRAY['STAMINA Radio'] = 'SAN FRANCISCO, CA, USA';
//        $broadcast_scroller_content_ARRAY['Launch in Session'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['Balearic'] = 'IBIZA, SPAIN';
//        $broadcast_scroller_content_ARRAY['Bankbeats'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['Sweetpea'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['AudioDevice'] = 'VIENNA, AUSTRIA';
//        $broadcast_scroller_content_ARRAY['Prague Connection'] = 'RICANY, CZECH REPUBLIC';
//        $broadcast_scroller_content_ARRAY['Subfactory'] = 'JERSEY, UK';
//        $broadcast_scroller_content_ARRAY['Vital Habits'] = 'TIMISOARA, ROMANIA';
//        $broadcast_scroller_content_ARRAY['TRANSLATION SOUND'] = 'WASHINGTON, DC, USA';
//        $broadcast_scroller_content_ARRAY['Wadjit'] = 'EDMONTON, AB, CANADA';
//        $broadcast_scroller_content_ARRAY['PROMO ZO'] = 'KENT, UK';
//        $broadcast_scroller_content_ARRAY['DrumObsession'] = 'POZNAN, POLAND';
//        $broadcast_scroller_content_ARRAY['Skeptics'] = 'BIRMINGHAM, UK';
//        $broadcast_scroller_content_ARRAY['BERLIN BASS'] = 'BERLIN, GERMANY';
//        $broadcast_scroller_content_ARRAY['SCIENTIFIC RADIO'] = 'UTRECHT, NETHERLANDS';
//        $broadcast_scroller_content_ARRAY['NIGHT GROOVES'] = 'ST. PETERSBURG, RUSSIA';
//        $broadcast_scroller_content_ARRAY['XPOSURE'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['Ben XO'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['Sohl'] = 'WHITE PLAINS, NY, USA';
//        $broadcast_scroller_content_ARRAY['River City'] = 'RICHMOND, VA, USA';
//        $broadcast_scroller_content_ARRAY['Ill Omen'] = 'RICHMOND, VA, USA';
//        $broadcast_scroller_content_ARRAY['Atmospheric Alignments'] = 'TULSA, OK, USA';
//        $broadcast_scroller_content_ARRAY['Skanka'] = 'TULSA, OK, USA';
//        $broadcast_scroller_content_ARRAY['Northern Groove'] = 'OLD TRAFFORD, MANCHESTER, UK';
//        $broadcast_scroller_content_ARRAY['Soulsmith'] = 'OLD TRAFFORD, MANCHESTER, UK';
//        $broadcast_scroller_content_ARRAY['GREENROOM'] = 'CHICAGO, IL, USA';
//        $broadcast_scroller_content_ARRAY['Random Movement'] = 'ORLANDO, FL, USA';
//        $broadcast_scroller_content_ARRAY['Mike Random'] = 'ORLANDO, FL, USA';
//        $broadcast_scroller_content_ARRAY['Strictly Science'] = 'AUSTIN, TX, USA';
//        $broadcast_scroller_content_ARRAY['Circuitry'] = 'SAN FRANCISCO, CA, USA';
//        $broadcast_scroller_content_ARRAY['Method One'] = 'SAN FRANCISCO, CA, USA';
//        $broadcast_scroller_content_ARRAY['Power Rinse'] = 'TORONTO, CANADA';
//        $broadcast_scroller_content_ARRAY['EvanTheScientist'] = 'TORONTO, CANADA';
//        $broadcast_scroller_content_ARRAY['Trainspotting'] = 'BANGKOK, THAILAND';
//        $broadcast_scroller_content_ARRAY['Amnesty'] = 'BANGKOK, THAILAND';
//        $broadcast_scroller_content_ARRAY['A Sides'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['Eastside Sessions'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['Invaderz'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['Saphir'] = 'VIENNA, AUSTRIA';
//        $broadcast_scroller_content_ARRAY['Jay Rome'] = 'VIENNA, AUSTRIA';
//        $broadcast_scroller_content_ARRAY['Funked Up'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['DFunk'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['Ashatack'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['Ebb & Flow'] = 'AUSTIN, TX, USA';
//        $broadcast_scroller_content_ARRAY['Optx'] = 'AUSTIN, TX, USA';
//        $broadcast_scroller_content_ARRAY['Impressions'] = 'SAN DIEGO, CA, USA';
//        $broadcast_scroller_content_ARRAY['Indentation'] = 'SAN DIEGO, CA, USA';
//        $broadcast_scroller_content_ARRAY['Australian Atmospherics'] = 'BRISBANE, AUSTRALIA';
//        $broadcast_scroller_content_ARRAY['Operon'] = 'BRISBANE, AUSTRALIA';
//        $broadcast_scroller_content_ARRAY['Vibration Sessions'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['Deep Soul'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['Donovan'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['ECLIPS3'] = 'BUDAPEST, HUNGARY';
//        $broadcast_scroller_content_ARRAY['LQD'] = 'BUDAPEST, HUNGARY';
//        $broadcast_scroller_content_ARRAY['Represent Radio'] = 'NASHVILLE, TN, USA';
//        $broadcast_scroller_content_ARRAY['Squake'] = 'NASHVILLE, TN, USA';
//        $broadcast_scroller_content_ARRAY['SixOneOh'] = 'LEHIGH VALLEY, PA, USA';
//        $broadcast_scroller_content_ARRAY['Resistance Radio'] = 'EDMONTON, AB, CANADA';
//        $broadcast_scroller_content_ARRAY['John Ohms'] = 'EDMONTON, AB, CANADA';
//        $broadcast_scroller_content_ARRAY['Phuture'] = 'MOSCOW, RUSSIA';
//        $broadcast_scroller_content_ARRAY['Overfiend'] = 'NEW YORK, NY, USA';
//        $broadcast_scroller_content_ARRAY['Hangover'] = 'CHICAGO, IL, USA';
//        $broadcast_scroller_content_ARRAY['Lamebrane'] = 'CHICAGO, IL, USA';
//        $broadcast_scroller_content_ARRAY['Schematic'] = 'ALMONTE, ONTARIO, CANADA';
//        $broadcast_scroller_content_ARRAY['Crucial X'] = 'SACRAMENTO, CA, USA';
//        $broadcast_scroller_content_ARRAY['Spacefunk'] = 'SACRAMENTO, CA, USA';
//        $broadcast_scroller_content_ARRAY['Deceit FM'] = 'PERTH, AUSTRALIA';
//        $broadcast_scroller_content_ARRAY['Buzzy'] = 'PERTH, AUSTRALIA';
//        $broadcast_scroller_content_ARRAY['LJHigh'] = 'COVENTRY, UK';
//        $broadcast_scroller_content_ARRAY['High Definition'] = 'COVENTRY, UK';
//        $broadcast_scroller_content_ARRAY['Warm Ears'] = 'LONDON, UK';
//        $broadcast_scroller_content_ARRAY['Lab Sessions'] = 'ORLANDO, FL, USA';
//        $broadcast_scroller_content_ARRAY['Incisive Rhythm'] = 'DETROIT, MI, USA';
//        $broadcast_scroller_content_ARRAY['Awake247'] = 'ALBANY, NY, USA';
//        $broadcast_scroller_content_ARRAY['Awake FM'] = 'ALBANY, NY, USA';
//        $broadcast_scroller_content_ARRAY['AwakeFM'] = 'ALBANY, NY, USA';
//
//        $broadcast_scroller_content_ARRAY['Subtext'] = '';
//        $broadcast_scroller_content_ARRAY['Phlage'] = '';
//        $broadcast_scroller_content_ARRAY['Lost Content'] = '';
//        $broadcast_scroller_content_ARRAY['Tehace'] = '';
//        $broadcast_scroller_content_ARRAY['Pyxis'] = '';
//        $broadcast_scroller_content_ARRAY['Aras'] = '';
//        $broadcast_scroller_content_ARRAY['Slider'] = '';
//
//        return $broadcast_scroller_content_ARRAY;
//
//    }

    private function return_broadcast_nation_association_ARRAY(){

        $tmp_array = array();

        $tmp_array['Fuzed Funk'] = 'flag_united_states_of_america.gif';
        $tmp_array['Jason Magin'] = 'flag_united_states_of_america.gif';
        $tmp_array['Jay Dubz'] = 'flag_united_kingdom.gif';
        $tmp_array['BRYAN GEE'] = 'flag_united_kingdom.gif';
        $tmp_array['BRYANGEE'] = 'flag_united_kingdom.gif';
        $tmp_array['Audiofields'] = 'flag_united_states_of_america.gif';
        $tmp_array['Simplification'] = 'flag_brazil.gif';
        $tmp_array['Melinki'] = 'flag_united_kingdom.gif';
        $tmp_array['Disturbo'] = 'flag_austria.gif';
        $tmp_array['Redex'] = 'flag_austria.gif';
        $tmp_array['Blind Judge'] = 'flag_austria.gif';
        $tmp_array['Rodney Rolls'] = 'flag_united_kingdom.gif';
        $tmp_array['Mod Con'] = 'flag_united_kingdom.gif';
        $tmp_array['DJ ANDY'] = 'flag_brazil.gif';
        $tmp_array['BASS GO BOOM'] = 'flag_brazil.gif';
        $tmp_array['Bumblebee'] = 'flag_germany.gif';
        $tmp_array['Insideman'] = 'flag_united_kingdom.gif';
        $tmp_array['On:Ward'] = 'flag_united_kingdom.gif';
        $tmp_array['Onward Show'] = 'flag_united_kingdom.gif';
        $tmp_array['Fokuz Recordings'] = 'flag_netherlands.gif';
        $tmp_array['STAMINA Radio'] = 'flag_united_states_of_america.gif';
        $tmp_array['Launch in Session'] = 'flag_united_kingdom.gif';
        $tmp_array['Balearic'] = 'flag_spain.gif';
        $tmp_array['Bankbeats'] = 'flag_united_kingdom.gif';
        $tmp_array['Sweetpea'] = 'flag_united_kingdom.gif';
        $tmp_array['AudioDevice'] = 'flag_austria.gif';
        $tmp_array['Prague Connection'] = 'flag_czech_republic.gif';
        $tmp_array['Subfactory'] = 'flag_united_kingdom.gif';
        $tmp_array['Vital Habits'] = 'flag_romania.gif';
        $tmp_array['TRANSLATION SOUND'] = 'flag_united_states_of_america.gif';
        $tmp_array['Wadjit'] = 'flag_canada.gif';
        $tmp_array['PROMO ZO'] = 'flag_united_kingdom.gif';
        $tmp_array['DrumObsession'] = 'flag_poland.gif';
        $tmp_array['Skeptics'] = 'flag_united_kingdom.gif';
        $tmp_array['BERLIN BASS'] = 'flag_germany.gif';
        $tmp_array['SCIENTIFIC RADIO'] = 'flag_netherlands.gif';
        $tmp_array['NIGHT GROOVES'] = 'flag_russia.gif';
        $tmp_array['XPOSURE'] = 'flag_united_kingdom.gif';
        $tmp_array['Ben XO'] = 'flag_united_kingdom.gif';
        $tmp_array['Sohl'] = 'flag_united_states_of_america.gif';
        $tmp_array['River City'] = 'flag_united_states_of_america.gif';
        $tmp_array['Ill Omen'] = 'flag_united_states_of_america.gif';
        $tmp_array['Atmospheric Alignments'] = 'flag_united_states_of_america.gif';
        $tmp_array['Skanka'] = 'flag_united_states_of_america.gif';
        $tmp_array['Northern Groove'] = 'flag_united_kingdom.gif';
        $tmp_array['Soulsmith'] = 'flag_united_kingdom.gif';
        $tmp_array['GREENROOM'] = 'flag_united_states_of_america.gif';
        $tmp_array['Random Movement'] = 'flag_united_states_of_america.gif';
        $tmp_array['Mike Random'] = 'flag_united_states_of_america.gif';
        $tmp_array['Strictly Science'] = 'flag_united_states_of_america.gif';
        $tmp_array['Circuitry'] = 'flag_united_states_of_america.gif';
        $tmp_array['Method One'] = 'flag_united_states_of_america.gif';
        $tmp_array['Power Rinse'] = 'flag_canada.gif';
        $tmp_array['EvanTheScientist'] = 'flag_canada.gif';
        $tmp_array['Trainspotting'] = 'flag_thailand.gif';
        $tmp_array['Amnesty'] = 'flag_thailand.gif';
        $tmp_array['A Sides'] = 'flag_united_kingdom.gif';
        $tmp_array['Eastside Sessions'] = 'flag_united_kingdom.gif';
        $tmp_array['Invaderz'] = 'flag_united_kingdom.gif';
        $tmp_array['Saphir'] = 'flag_austria.gif';
        $tmp_array['Jay Rome'] = 'flag_austria.gif';
        $tmp_array['IAmDoomed'] = 'flag_austria.gif';
        $tmp_array['Funked Up'] = 'flag_united_kingdom.gif';
        $tmp_array['DFunk'] = 'flag_united_kingdom.gif';
        $tmp_array['Ashatack'] = 'flag_united_kingdom.gif';
        $tmp_array['Ebb & Flow'] = 'flag_united_states_of_america.gif';
        $tmp_array['Optx'] = 'flag_united_states_of_america.gif';
        $tmp_array['Impressions'] = 'flag_united_states_of_america.gif';
        $tmp_array['Indentation'] = 'flag_united_states_of_america.gif';
        $tmp_array['Australian Atmospherics'] = 'flag_australia.gif';
        $tmp_array['Operon'] = 'flag_australia.gif';
        $tmp_array['Vibration Sessions'] = 'flag_united_kingdom.gif';
        $tmp_array['Deep Soul'] = 'flag_united_kingdom.gif';
        $tmp_array['Donovan'] = 'flag_united_kingdom.gif';
        $tmp_array['ECLIPS3'] = 'flag_hungary.gif';
        $tmp_array['LQD'] = 'flag_hungary.gif';
        $tmp_array['Represent Radio'] = 'flag_united_states_of_america.gif';
        $tmp_array['Squake'] = 'flag_united_states_of_america.gif';
        $tmp_array['SixOneOh'] = 'flag_united_states_of_america.gif';
        $tmp_array['Resistance Radio'] = 'flag_canada.gif';
        $tmp_array['John Ohms'] = 'flag_canada.gif';
        $tmp_array['Phuture'] = 'flag_russia.gif';
        $tmp_array['Overfiend'] = 'flag_united_states_of_america.gif';
        $tmp_array['Hangover'] = 'flag_united_states_of_america.gif';
        $tmp_array['Lamebrane'] = 'flag_united_states_of_america.gif';
        $tmp_array['Schematic'] = 'flag_canada.gif';
        $tmp_array['Crucial X'] = 'flag_united_states_of_america.gif';
        $tmp_array['Spacefunk'] = 'flag_united_states_of_america.gif';
        $tmp_array['Deceit FM'] = 'flag_australia.gif';
        $tmp_array['Buzzy'] = 'flag_australia.gif';
        $tmp_array['LJHigh'] = 'flag_united_kingdom.gif';
        $tmp_array['High Definition'] = 'flag_united_kingdom.gif';
        $tmp_array['Warm Ears'] = 'flag_united_kingdom.gif';
        $tmp_array['Lab Sessions'] = 'flag_united_states_of_america.gif';
        $tmp_array['Incisive Rhythm'] = 'flag_united_states_of_america.gif';
        $tmp_array['Awake247'] = 'flag_united_states_of_america.gif';
        $tmp_array['Awake FM'] = 'flag_united_states_of_america.gif';
        $tmp_array['AwakeFM'] = 'flag_united_states_of_america.gif';

        $tmp_array['Subtext'] = 'flag_unknown.gif';
        $tmp_array['Phlage'] = 'flag_unknown.gif';
        $tmp_array['Lost Content'] = 'flag_unknown.gif';
        $tmp_array['Tehace'] = 'flag_unknown.gif';
        $tmp_array['Pyxis'] = 'flag_unknown.gif';
        $tmp_array['Aras'] = 'flag_unknown.gif';
        $tmp_array['Slider'] = 'flag_unknown.gif';

        return $tmp_array;

    }

    private function return_LIVE_ARRAY(){

        $tmp_array = array();

        $tmp_array[] = ' LIVE';
        $tmp_array[] = ' Live ';
        $tmp_array[] = ' live ';
        $tmp_array[] = 'LIVE!!!';
        $tmp_array[] = ' LIVE!';
        $tmp_array[] = 'LIVE!';
        $tmp_array[] = 'Live!!';
        $tmp_array[] = 'Live!';
        $tmp_array[] = '*LIVE*';
        $tmp_array[] = 'Live';

        return $tmp_array;

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

        for($i=31; $i>0; $i--){

            $tmp_array[] = $i;

        }

        return $tmp_array;

    }

    private function return_specialty_ARRAY(){

        $tmp_array = array();

        $tmp_array[] = 'Wadjit (Canada)';
        $tmp_array[] = 'Wadjit (CAN)';
        $tmp_array[] = 'Wadjit (CANADA)';
        $tmp_array[] = 'Wadjit (canada)';
        $tmp_array[] = 'Wadjit (can)';
        $tmp_array[] = 'THE GREENROOM';
        $tmp_array[] = 'Blu Saphir';

        return $tmp_array;

    }


    private function return_specialty_output_ARRAY(){

        $tmp_array = array();

        $tmp_array[] = 'Wadjit '.'<img src="'.$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/canada_thumb.gif" width="33" height="16" alt="Canada" title="Canada">';
        $tmp_array[] = 'Wadjit '.'<img src="'.$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/canada_thumb.gif" width="33" height="16" alt="Canada" title="Canada">';
        $tmp_array[] = 'Wadjit '.'<img src="'.$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/canada_thumb.gif" width="33" height="16" alt="Canada" title="Canada">';
        $tmp_array[] = 'Wadjit '.'<img src="'.$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/canada_thumb.gif" width="33" height="16" alt="Canada" title="Canada">';
        $tmp_array[] = 'Wadjit '.'<img src="'.$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oUser->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/canada_thumb.gif" width="33" height="16" alt="Canada" title="Canada">';
        $tmp_array[] = '<span style="color:#06730A; font-weight: bold; font-size: 110%;">THE GREENROOM</span>';
        $tmp_array[] = '<span style="color:#3133D5; font-weight: bold;">Blu Saphir</span>';

        return $tmp_array;

    }

    private function return_HYPER_ARRAY(){

        $tmp_array = array();

        $tmp_array[] = 'www.Facebook.com/NateReflect';
        $tmp_array[] = 'soundcloud.com/LQDAudio';
        $tmp_array[] = 'Facebook.com/JasonMagin';
        $tmp_array[] = 'facebook.com/impression23';
        $tmp_array[] = 'fb.com/schematicdnb';
        $tmp_array[] = 'www.djspim.com';
        $tmp_array[] = 'www.northerngroove.co.uk/';
        $tmp_array[] = 'https://xo.am/';
        $tmp_array[] = '@bdxposure';
        $tmp_array[] = 'fb.com/DrumObsession';
        $tmp_array[] = 'tweet@DrumObsessionPL';
        $tmp_array[] = 'insta/impression_ucr';
        $tmp_array[] = 'Insta@fuzedfunk';
        $tmp_array[] = '@warmearsmusic';
        $tmp_array[] = 'fb.com/thebryangee';
        $tmp_array[] = '@schematicdnb';
        $tmp_array[] = 'FB/impression2377';
        $tmp_array[] = 'facebook.com/louis.overfiend';
        $tmp_array[] = 'www.facebook.com/NateReflect';
        $tmp_array[] = 'www.soundcloud.com/amnesty';
        $tmp_array[] = 'Random_Movement';
        $tmp_array[] = 'RandomMovementMusic';
        $tmp_array[] = 'Facebook.com/DLO.DNB';
        $tmp_array[] = 'www.northerngroove.co.uk';
        $tmp_array[] = 'www.facebook.com/operondnb';
        $tmp_array[] = 'fb.com/louis.overfiend';
        $tmp_array[] = 'The Launch Pad with Dj Handy';
        $tmp_array[] = 'INDENTATION Episode';

        return $tmp_array;

    }

    public function return_LINK_ARRAY(){

        $tmp_array = array();

        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/NateReflect" target="_blank">www.Facebook.com/NateReflect</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://soundcloud.com/LQDAudio" target="_blank">soundcloud.com/LQDAudio</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/JasonMagin" target="_blank">Facebook.com/JasonMagin</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.Facebook.com/impression23" target="_blank">facebook.com/impression23</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/schematicdnb" target="_blank">fb.com/schematicdnb</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="http://www.djspim.com" target="_blank">www.djspim.com</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="http://www.northerngroove.co.uk/" target="_blank">www.northerngroove.co.uk/</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://xo.am/" target="_blank">https://xo.am/</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://twitter.com/bdxposure" target="_blank">@bdxposure</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/drumobsession" target="_blank">fb.com/DrumObsession</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://twitter.com/DrumObsessionPL" target="_blank">tweet@DrumObsessionPL</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.instagram.com/impression_ucr/" target="_blank">insta/impression_ucr</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.instagram.com/fuzedfunk/" target="_blank">Insta/fuzedfunk</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.instagram.com/warmearsmusic/" target="_blank">@warmearsmusic</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/thebryangee/" target="_blank">fb.com/thebryangee</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/schematicdnb/" target="_blank">@schematicdnb</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/Impression2377/" target="_blank">FB/impression2377</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/louis.overfiend/" target="_blank">facebook.com/louis.overfiend</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/NateReflect/" target="_blank">www.facebook.com/NateReflect</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://soundcloud.com/amnesty" target="_blank">www.soundcloud.com/amnesty</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://twitter.com/random_movement" target="_blank">Random_Movement</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.instagram.com/Randommovementmusic/" target="_blank">RandomMovementMusic</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/DLO.DNB" target="_blank">Facebook.com/DLO.DNB</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="http://www.northerngroove.co.uk/" target="_blank">www.northerngroove.co.uk</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/operondnb" target="_blank">www.facebook.com/operondnb</a>';
        $tmp_array[] = '<a style="color:#0066CC; font-weight: normal;" href="https://www.facebook.com/louis.overfiend" target="_blank">fb.com/louis.overfiend</a>';
        $tmp_array[] = 'The Launch Pad<br>with Dj Handy';
        $tmp_array[] = 'INDENTATION<br>Episode';

        return $tmp_array;

    }

    public function ptrn_replace($pattern_str, $replace_str, $str){

        $patterns = array();
        $replacements = array();

        $patterns[0] = $pattern_str;
        $replacements[0] = $replace_str;

        $str = str_replace($patterns, $replacements, $str);

        return $str;
    }

    public function get_resource($resource_key, $wildCardResourceKey = NULL){

        return $this->oUser->get_resource($resource_key, $wildCardResourceKey);

    }

    public function generateNewKey($len){

        return $this->oUser->generateNewKey($len);

    }

    public function __destruct(){

    }

}