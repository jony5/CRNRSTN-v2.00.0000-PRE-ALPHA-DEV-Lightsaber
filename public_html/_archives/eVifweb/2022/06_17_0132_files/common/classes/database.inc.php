<?php
/* 
// J5
// Code is Poetry */

/*
// CLASS :: database_result_mapper
// AUTHOR :: Jonathan 'J5' Harris <jharris@evifweb.com>
// VERSION :: 1.0.0
*/
class database_result_mapper {
    private static $oLogger;

    private static $query_resp_field_viaPos = array();
    private static $resp_fieldPosition_viaFieldName = array();
    private static $select_statement_pos_ARRAY = array();
    private static $result_profile_results_ARRAY = array();
    private static $sql_select_ARRAY = array();

    public function __construct() {
        //
        // INSTANTIATE LOGGER
        self::$oLogger = new crnrstn_logging();

    }

    public function return_field_array($serial, $profile){

        $serial_crc = crc32($serial);

        if(isset($profile)){
            $profile_crc = crc32($profile);

            return self::$query_resp_field_viaPos[$serial_crc][self::$select_statement_pos_ARRAY[$serial_crc][$profile_crc]];
        }else{

            //
            // FOR SITUATIONS WHERE WE ARE MERGING N+1 DATABASE RESPONSES AND THEY ALL HAVE SAME SQL...IT IS HANDY TO BE ABLE TO GET THAT DATA W/O NEEDING TO
            // KEEP TRACK OF WHERE WE ARE IN THE RESPONSE PROCESSING AND WHAT PROFILE THAT IS..EXACTLY...
            $tmp_array = self::$select_statement_pos_ARRAY[$serial_crc];
            foreach($tmp_array as $key=>$val){

                //
                // JUST RETURN THE FIRST SQL
                return self::$query_resp_field_viaPos[$serial_crc][$val];

            }
        }
    }

    public function return_field_name($serial, $profile, $position){
        $serial_crc = crc32($serial);
        $profile_crc = crc32($profile);

        return self::$query_resp_field_viaPos[$serial_crc][self::$select_statement_pos_ARRAY[$serial_crc][$profile_crc]][$position];

    }

//    public function return_field_position($serial, $profile, $fieldname){
//
//        $tmp_field_position = -1;
//
//        //
//        // RETURNS POSITION IN SELECT STATEMENT OF REQUESTED FIELD. -1 FOR NOT FOUND.
//        if(isset(self::$resp_fieldPosition_viaFieldName[crc32($serial)][self::$select_statement_pos_ARRAY[crc32($serial)][crc32($profile)]][crc32($fieldname)])){
//
//            $tmp_field_position = self::$resp_fieldPosition_viaFieldName[crc32($serial)][self::$select_statement_pos_ARRAY[crc32($serial)][crc32($profile)]][crc32($fieldname)];
//        }
//
//        return $tmp_field_position;
//    }

    public function return_value_pointer_array($serial,$profile,$fieldname,$pos){

        $serial = crc32($serial);
        $profile = crc32($profile);
        $fieldname = crc32($fieldname);

        $tmp_return_array = array();  // WHY ARE THESE NOT BEING SERIALIZED? DATA STORAGE IS NOT PERSISTENT. NO NEED TO REMEMBER.
        $tmp_return_array[0] = self::$result_profile_results_ARRAY[$serial][$profile][$pos];  //ROWCNT
        $tmp_return_array[1] = self::$resp_fieldPosition_viaFieldName[$serial][self::$select_statement_pos_ARRAY[$serial][$profile]][$fieldname];  // FIELD

        return $tmp_return_array;

    }

    public function retrieve_row_coordinates($serial, $profile, $pos){
        $serial_crc = crc32($serial);
        $profile_crc = crc32($profile);

        if(!isset(self::$result_profile_results_ARRAY[$serial_crc][$profile_crc][$pos])){

            error_log('database (77) ** result_profile_results_ARRAY UNDEFINED ** at position['.$pos.'] with serial['.$serial.'|'.$serial_crc.'] within the SELECT profile['.$profile.'|'.$profile_crc.'], and this has not been found. Response serial='.$serial);

            //
            // HOOOSTON...VE HAF PROBLEM!
            throw new Exception('retrieve_row_coordinates() is asking for coordinates for ROWCNT at position['.$pos.'] with serial['.$serial_crc.'] within the SELECT profile['.$profile.'], and this has not been found within the SQL['.self::$sql_select_ARRAY[$serial_crc][self::$select_statement_pos_ARRAY[$serial_crc][$profile_crc]].']. Response serial='.$serial);
        }

        return self::$result_profile_results_ARRAY[$serial_crc][$profile_crc][$pos];

    }

    #('1234567qwerty','USER','FIRSTNAME',0)
    # THERE ARE 2 KINDS OF ROW COUNT. GLOBAL RAW ARRAY. AND TABLE SPECIFIC RECORD RETURN COUNT. LET'S KEEP THEM STRAIGHT.
    #$oDB_RESP->return_data_element($db_resp_process_serial, 'KIVOTOS_00', 'CLIENT_ID', 0);
    // THE DB IS RETURNING 11 ELEMENTS. THIS ERR IS ON THE LAST ITEM. TRYING TO RETRIEVE COORD FOR #11....WHICH IF START FROM 0 IS ACTUALLY THE 12TH ITEM...WHICH IS UNDEFINED.
    public function retrieve_coordinates($serial, $profile, $field, $pos){

        $tmp_coord_array = array();

        $serial_crc = crc32($serial);
        $profile_crc = crc32($profile);
        $field_crc = crc32($field);

        if(!isset(self::$result_profile_results_ARRAY[$serial_crc][$profile_crc][$pos])){

            error_log('database (103) ** result_profile_results_ARRAY Field['.$field.'/'.$field_crc.'] UNDEFINED at position['.$pos.'] with serial['.$serial.'|'.$serial_crc.'] within the SELECT profile['.$profile.'|'.$profile_crc.'], and this has not been found. Response serial=');

            //
            // HOOOSTON...VE HAF PROBLEM!
            throw new Exception('You are asking for coordinates for ROWCNT at position['.$pos.'] with serial['.$serial_crc.'] within the SELECT profile['.$profile.'], and this has not been found within the SQL['.self::$sql_select_ARRAY[$serial_crc][self::$select_statement_pos_ARRAY[$serial_crc][$profile_crc]].']. Response serial='.$serial);
        }

        #error_log("database (84) serial[".$serial."|".$serial_crc."] profile[".$profile_crc."|".$profile."] pos[".$pos."] ");
        $tmp_coord_array[$serial_crc][0] = self::$result_profile_results_ARRAY[$serial_crc][$profile_crc][$pos];     // ROWCNT

        //
        // I WAS GETTING AN UNDEFINED ARRAY INDEX HERE. HAD TO UPDATE THE SQL HERE...(TO ADD `clients`.`LANGCODE`)..THAT CLEARED UP THE UNDEFINED.
        // THEN I ADDED THIS EXCEPTION TO ALERT ME TO THIS DIRECTLY SHOULD IT OCCUR AGAIN IN THE FUTURE.
        // WATCH....
        # [$resp_serial][SELECT_STATMENT][FIRSTNAME]
        if(!isset(self::$resp_fieldPosition_viaFieldName[$serial_crc][self::$select_statement_pos_ARRAY[$serial_crc][$profile_crc]][$field_crc])){

            //
            // HOOOSTON...VE HAF PROBLEM!
            throw new Exception('You are asking for coordinates for field['.$field.'] within the SELECT profile['.$profile.'], and this has not been found within the SQL['.self::$sql_select_ARRAY[$serial_crc][self::$select_statement_pos_ARRAY[$serial_crc][$profile_crc]].']. Response serial='.$serial);

        }else{

            $tmp_coord_array[$serial_crc][1] = self::$resp_fieldPosition_viaFieldName[$serial_crc][self::$select_statement_pos_ARRAY[$serial_crc][$profile_crc]][$field_crc];     // FIELD
        }

        return $tmp_coord_array;
    }

    public function mapQueryData($resp_serial, $sql_select_array){

        $tmp_select_tracker = array();

        //
        // MAP ALL QUERY DATA TO USABLE STRUCTURE FOR RESULT HANDLING
        self::$sql_select_ARRAY[$resp_serial] = $sql_select_array;
        $tmp_loop_size = sizeof(self::$sql_select_ARRAY[$resp_serial]);
        for($i=0;$i<$tmp_loop_size;$i++){

            //
            // BREAK OUT FROM EXPRESSION SO THAT SQL CAN BE CHECKSUMMED
            #$tmp_field_chop_array = explode('FROM', self::$sql_select_ARRAY[$resp_serial][$i]);
            $tmp_field_chop_array = preg_split("/ FROM /i", self::$sql_select_ARRAY[$resp_serial][$i]);  // CASE INSENSITIVE

            //
            // WE NEED TO OPTIMIZE FOR ACCELERATION OF RECURSIVE SITUATIONS
            // I CANNOT CHECKSUM THIS IN THE CURRENT CONDITION. WILL HAVE UNIQUE ID SO NEVER WILL THERE BE A CHECKSUM MATCH
            if(isset($tmp_select_tracker[crc32($tmp_field_chop_array[0])])){

                //
                // WE HAVE SEEN THIS SQL BEFORE. USE SAME RESULTS.
                self::$query_resp_field_viaPos[$resp_serial][$i] = self::$query_resp_field_viaPos[$resp_serial][$tmp_select_tracker[crc32($tmp_field_chop_array[0])]];
                self::$resp_fieldPosition_viaFieldName[$resp_serial][$i] = self::$resp_fieldPosition_viaFieldName[$resp_serial][$tmp_select_tracker[crc32($tmp_field_chop_array[0])]];

                #error_log("database (174) mapQueryData() optimization run...");
            }else{
                $tmp_select_tracker[crc32($tmp_field_chop_array[0])] = $i;

                self::$sql_select_ARRAY[$resp_serial][$i] = $this->sanitizeSelect($tmp_field_chop_array[0]);

                //
                // EXPLODE BY COMMA TO BREAK OUT FIELDS
                $tmp_field_chop_array = explode(',', self::$sql_select_ARRAY[$resp_serial][$i]);

                //
                // PROCESS EACH FIELD FOR:
                # - EXPLODE BY . AND KEEP [1] FOR FIELD NAME  # clients.CLIENT_ID
                $tmp_loop_size1 = sizeof($tmp_field_chop_array);
                for($ii=0;$ii<$tmp_loop_size1;$ii++){

                    //
                    // DO WE HAVE AN "AS" FIELD RENAME. IF SO, HANDLE IT.
                    $pos = stripos($tmp_field_chop_array[$ii], " AS ");
                    if ($pos !== false) {

                        //
                        // SPLIT FIELD BY AS AND TAKE SECOND INDEX FOR FIELD NAME
                        #$tmp_single_field_array = explode(' AS ', $tmp_field_chop_array[$ii]);
                        $tmp_single_field_array = preg_split("/ AS /i", $tmp_field_chop_array[$ii]);  // CASE INSENSITIVE

                        //
                        // TRIM SPACES
                        $tmp_single_field_array[1] = trim($tmp_single_field_array[1]);

                        //
                        // FOR EACH FIELD
                        # array[serial][select_CNT][field_position] = fieldname;
                        self::$query_resp_field_viaPos[$resp_serial][$i][$ii] = $tmp_single_field_array[1];                 // STORE FIELD NAME ACCESSED BY POSITION

                        # array[serial][select_CNT][field name] = field position;
                        # [$resp_serial][SELECT_STATMENT][FIRSTNAME] = 3
                        self::$resp_fieldPosition_viaFieldName[$resp_serial][$i][crc32($tmp_single_field_array[1])] = $ii;        // STORE POSITION. NEED ACCESS BY FIELD NAME.

                    }else{

                        $tmp_single_field_array = explode('.', $tmp_field_chop_array[$ii]);

                        # $i = SELECT statement
                        # $ii = FIELD POSITION
                        # $tmp_single_field_array[1] = FIELD NAME FOR ACCESS

                        //
                        // FOR EACH FIELD
                        # array[serial][select_CNT][field_position] = fieldname;
                        self::$query_resp_field_viaPos[$resp_serial][$i][$ii] = $tmp_single_field_array[1];                 // STORE FIELD NAME ACCESSED BY POSITION

                        # array[serial][select_CNT][field name] = field position;
                        # [$resp_serial][SELECT_STATMENT][FIRSTNAME] = 3
                        self::$resp_fieldPosition_viaFieldName[$resp_serial][$i][crc32($tmp_single_field_array[1])] = $ii;        // STORE POSITION. NEED ACCESS BY FIELD NAME.

                    }

                }

            }

        }
    }

    public function updateProfileResults($resp_serial, $tmp_profile, $count, $ROWCNT){
        # self::$resp_serial, $tmp_profile, self::$result_profile_count_ARRAY[self::$resp_serial][$tmp_profile], $ROWCNT

        self::$result_profile_results_ARRAY[$resp_serial][crc32($tmp_profile)][$count] = $ROWCNT;

    }

    public function updateSelectPos($serial, $profile, $pos){

        self::$select_statement_pos_ARRAY[crc32($serial)][crc32($profile)] = $pos;

    }

    private function sanitizeSelect($str){

        $patterns = array();
        $patterns[0] = "`";
        #$patterns[1] = ' ';

        $replacements = array();
        $replacements[0] = '';
        #$replacements[1] = '';

        $str = str_replace($patterns, $replacements, $str);
        return $str;
    }

    public function __destruct() {

    }

}

/*
// CLASS :: database_response_manager
// AUTHOR :: Jonathan 'J5' Harris <jharris@evifweb.com>
// VERSION :: 1.0.0
*/
class database_response_manager {

    private static $oLogger;
    private static $oSQLMapper;
    private static $oData;
    private static $oEnv;

    private static $resp_profiles_SQL_align;
    private static $resp_serial;
    private static $resp_serial_key_ARRAY = array();
    private static $resp_serial_raw = array();
    private static $resp_serial_ARRAY = array();
    private static $resp_profiles_ARRAY = array();
    private static $resp_profile_size_ARRAY = array();
    private static $resp_fieldcnt_ARRAY = array();
    private static $resp_profile_viaCnt_ARRAY = array();
    private static $master_raw_response_ARRAY = array();
    private static $result_record_profile_viaRowCnt_ARRAY = array();
    private static $result_aggregate_map_ARRAY = array();
    private static $result_profile_serial_handle_ARRAY = array();
    private static $total_aggregate_count = array();
    private static $total_aggregate_profile_count = array();
    private static $result_aggregate_map_serial_ARRAY = array();
    private static $result_aggregate_map_profile_ARRAY = array();

    private static $serial_by_sql_profile = array();

    private static $result_profile_count_ARRAY = array();

    private static $rekey_profile_response_ARRAY = array();

    private static $flag_results = array();

    private static $serial_pipe = array();
    private static $profilekey_pipe = array();

    public $errStatus;
    private static $queryType;

    private static $result;

    public function __construct($oEnv, $oDB) {
        try{
            //
            // INSTANTIATE LOGGER
            self::$oLogger = new crnrstn_logging();

            //
            // INSTANTIATE RESULT MAPPER. THIS CLASS IS ONLY USED INTERNALLY...HERE. I DON'T THINK THERE ARE ANY PUBLIC CALLS. WOULD IT EVEN MAKE SENSE?
            // YEP. NO PUBLIC CALLS TO SELECT MAPPER OBJECT. DON'T NEED TO DOCUMENT.
            self::$oSQLMapper = new database_result_mapper();

            if(isset($oEnv) && isset($oDB)){

                self::$oEnv = $oEnv;
                self::$oData = $oDB;
            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('ERR :: CRNRSTN_ENV and database_integration:: are required parameters for database_response_manager::__construct().');

            }

        }catch( Exception $e ) {
            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('database_response_manager->__construct()', LOG_EMERG, $e->getMessage());

        }

    }

    public function recursive_pipe_build($queryType, $PIPE_type, $value){

        $queryType_crc = crc32($queryType);

        switch($PIPE_type){
            case 'PROFILE':
                if(array_key_exists($queryType_crc, self::$profilekey_pipe)){
                    self::$profilekey_pipe[$queryType_crc] .= '|'.$value;
                }else {
                    self::$profilekey_pipe[$queryType_crc] = $value;
                }

            break;
            case 'SERIAL':
                if(array_key_exists($queryType_crc, self::$serial_pipe)){
                    self::$serial_pipe[$queryType_crc] .= '|'.$value;
                }else {
                    self::$serial_pipe[$queryType_crc] = $value;
                }

            break;

        }

    }

    public function return_serialkey_pipe_ARRAY($queryType){

        $queryType_crc = crc32($queryType);
        $tmp_output_ARRAY = array();

        # ARRAY() = {0=$serial_handle_pipe, 1=$target_key_pipe}
        $tmp_output_ARRAY[0] = self::$serial_pipe[$queryType_crc];
        $tmp_output_ARRAY[1] = self::$profilekey_pipe[$queryType_crc];

        return $tmp_output_ARRAY;
    }

    //
    // WE CAN USE EITHER SERIAL (PREFERRED) OR THE KEY TO GET THE SERIAL (OK, TOO...BUT WILL REQUIRE ANOTHER CALL TO GET THE SERIAL).
    public function return_serial_from_SQL($sql_handle){

        return self::$serial_by_sql_profile[$sql_handle];

    }

    public function response_key_merge($serial_handle_pipe, $target_key_pipe, $sequence_field_pipe, $compare_type, $new_cumm_key){

        $new_cumm_key_crc = crc32($new_cumm_key);

        //
        // THIS WILL BE AN EXPENSIVE METHOD. WE WILL DO OUR BEST.
        $tmp_serial_handle_ARRAY = explode("|", $serial_handle_pipe);
        $tmp_serial_key_ARRAY = explode("|", $target_key_pipe);
        $tmp_sequence_field_ARRAY = explode("|", $sequence_field_pipe);

        //
        // ALIGN FIELD PIPE TO KEY PIPE. IF ALL SEQUENCE FIELDS ARE SAME NAME...ONLY NEED TO PROVIDE ONE TIME...SANS PIPE.
        if(sizeof($tmp_sequence_field_ARRAY)!=sizeof($tmp_serial_key_ARRAY)){
            $tmp_loop_size = sizeof($tmp_serial_key_ARRAY);
            for($i=0;$i<$tmp_loop_size;$i++){
                $tmp_sequence_field_ARRAY[$i] = $tmp_sequence_field_ARRAY[0];
            }
        }

        $tmp_count_key = sizeof($tmp_serial_key_ARRAY);
        $tmp_count_handle = sizeof($tmp_serial_handle_ARRAY);
        $tmp_key_matched_ARRAY = array();
        $tmp_key_count_ARRAY = array();
        $result_key_position_ARRAY = array();
        $tmp_total_key_count = 0;

        //
        // WE NEED TO DETECT THE ASSOCIATION OF PIPE KEY TO HANDLE AND CAN MAKE NO ASSUMPTIONS
        for($ii=0;$ii<$tmp_count_key;$ii++) {
            //error_log("database (338) response_key_merge() checking key ".$tmp_serial_key_ARRAY[$ii]);
            for($i=0;$i<$tmp_count_handle;$i++){
                //error_log("database (340) response_key_merge() checking handle ".$tmp_serial_handle_ARRAY[$i]);
                if ($this->ping_profile_existence($this->return_serial($tmp_serial_handle_ARRAY[$i]), $tmp_serial_key_ARRAY[$ii])) {

                    //
                    // CONNECT THIS HANDLE AND PROFILE_KEY FOR PROCESSING
                    #$tmp_key_serial_handle_ARRAY[$tmp_serial_key_ARRAY[$ii]] = $tmp_serial_handle_ARRAY[$i];
                    self::$result_profile_serial_handle_ARRAY[$tmp_serial_key_ARRAY[$ii]] = $tmp_serial_handle_ARRAY[$i];
                    $tmp_key_matched_ARRAY[$tmp_serial_handle_ARRAY[$i]][$tmp_serial_key_ARRAY[$ii]] = true;

                    //
                    // CONNECT THIS HANDLE AND SERIAL
                    #$this->return_serial($tmp_key_serial_handle_ARRAY[$tmp_serial_key_ARRAY[$ii]]);
                    #self::$result_profile_serial_handle_ARRAY[$tmp_serial_key_ARRAY[$ii]] = $this->return_serial(self::$result_profile_serial_handle_ARRAY[$tmp_serial_key_ARRAY[$ii]]);

                    //
                    // CONNECT SEQUENCE FIELD TO KEY
                    #$tmp_sequence_field_ARRAY[$tmp_serial_key_ARRAY[$ii]] = $tmp_sequence_field_ARRAY[$i];
                    //error_log('database (356) found a serial handle for response key ['.$tmp_serial_key_ARRAY[$ii].']');

                    $result_key_position_ARRAY[$tmp_serial_handle_ARRAY[$i]][$tmp_serial_key_ARRAY[$ii]] = 0;

                }
            }

            if(!isset($tmp_key_matched_ARRAY[self::$result_profile_serial_handle_ARRAY[$tmp_serial_key_ARRAY[$ii]]][$tmp_serial_key_ARRAY[$ii]])) {
                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('response_key_merge() is unable to find a serial handle for response key ['.$tmp_serial_key_ARRAY[$ii].'].');
            }
        }

        //
        // NOW THAT WE HAVE SERIAL/KEY RELATIONS. WHAT ARE MY COUNTS FOR EACH KEY
        for($ii=0;$ii<$tmp_count_key;$ii++) {
            //
            // THIS ALSO NEEDS TO BE SERIALIZED PER SELECT PROFILES
            $tmp_key_count_ARRAY[self::$result_profile_serial_handle_ARRAY[$tmp_serial_key_ARRAY[$ii]]][$tmp_serial_key_ARRAY[$ii]] = $this->return_sizeof($this->return_serial(self::$result_profile_serial_handle_ARRAY[$tmp_serial_key_ARRAY[$ii]]), $tmp_serial_key_ARRAY[$ii]);

            //
            // FOR MASTER LOOP CONTROL EXCLUSION OF OUT-OF-BOUNDS PROFILES
            self::$total_aggregate_profile_count[$new_cumm_key_crc][$tmp_serial_key_ARRAY[$ii]] = $tmp_key_count_ARRAY[self::$result_profile_serial_handle_ARRAY[$tmp_serial_key_ARRAY[$ii]]][$tmp_serial_key_ARRAY[$ii]];

            //
            // KEEP TOTAL COUNT FOR MASTER LOOP CONTROL
            $tmp_total_key_count += $tmp_key_count_ARRAY[self::$result_profile_serial_handle_ARRAY[$tmp_serial_key_ARRAY[$ii]]][$tmp_serial_key_ARRAY[$ii]];

            error_log("database (471) key[".$tmp_serial_key_ARRAY[$ii]."] count=".$tmp_key_count_ARRAY[self::$result_profile_serial_handle_ARRAY[$tmp_serial_key_ARRAY[$ii]]][$tmp_serial_key_ARRAY[$ii]]);
        }

        //
        // NOW WE NEED TO LOOP THROUGH ALL THE DATA AND SEQUENCE IT BY $sequence_field SOMEHOW. PERHAPS THIS COULD BE DONE RECURSIVELY?
        // LET'S THINK ABOUT THE END GOAL TO MAKE SURE WE ARE ON TRACK. HOW DO I WANT TO ACCESS THIS NEW DATA STRUCTURE?
        // MAYBE LIKE THIS: $oDB_RESP->return_cumm_data_element($new_cumm_key, 'SAME_FIELD_NAME', INTEGER_OF_ROW_POSITION_IN_CUMM_ARRAY)
        // OK. SO RESULTS CAN HAVE DIFFERENT FIELD NAMES...NO FORCED CONSISTENCY. IF WE ACCESS VIA LOOP....NEED A WAY TO DETERMINE WHICH RESPONSE
        // TYPE WE ARE OUTPUTTING SO THAT WE CAN USE APPROPRIATE FIELD NAME TO PULL UP AND INSERT DATA....NOT TO MENTION FIELD NAME MAPPING BEWTEEN THE CUMM DATA
        // AND THE DISPARATE RESPONSE RESULT SETS
        self::$total_aggregate_count[$new_cumm_key_crc] = $tmp_total_key_count;

        for($i=0;$i<$tmp_total_key_count;$i++){

            # $oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_DATA'), 'KIVOTOS', 'NAME',5)
            # 'USER_DATA','ASSETS|STREAMS|KIVOTOS', 'DATECREATED', 'CUMM_ACTIVITY_DATA'
            # WHAT WE HAVE ::
            # 1 - $tmp_key_serial_handle_ARRAY - ARRAY['KIVOTOS'] = 'USER_DATA'   <- USE THIS TO GET SERIAL FOR RESULT
            # 2 - $result_key_position_ARRAY - ARRAY['KIVOTOS'] = 0                <- USE THIS IF YOU NEED TO TRACK QUEUE POSITION OF INDIVIDUAL PROFILES
            # 3 - $tmp_sequence_field_ARRAY - ARRAY['KIVOTOS'] = 'DATECREATED'     <- THE SEQUENCE CONTROLLER
            # 4 - $tmp_key_count_ARRAY - ARRAY['KIVOTOS'] = 37      <- TOTAL RESULTS PER PROFILE. MAY NOT NEED THIS DATA
            # 5 - $tmp_serial_key_ARRAY - ARRAY['KIVOTOS','STREAMS',...]
            //
            // FOR EACH DATA ELEMENT POSITION IN CUMMULATIVE DATA STRUCT
            // FIND ELEMENT AMONG ALL RESULT SETS TO BE QUEUED NEXT
            # COMPARE TARGET FIELD OF ALL RESULTS AND FIND HIGHEST

            $tmp_current_leader_val = NULL;
            $new_val = NULL;
            $tmp_sequence_data = array();
            for($ii=0; $ii<$tmp_count_key; $ii++){

                //
                // WE NEED TO PERFORM A BOUNDS CHECK BEFORE TESTING EACH SERIAL.
                if(self::$total_aggregate_profile_count[$new_cumm_key_crc][$tmp_serial_key_ARRAY[$ii]]>0){
                    //error_log("database (445) Process this one...".$tmp_serial_key_ARRAY[$ii]);

                    $tmp_serial = $this->return_serial(self::$result_profile_serial_handle_ARRAY[$tmp_serial_key_ARRAY[$ii]]);
                    $serial_crc = crc32($tmp_serial);

                    //
                    // I AM CONCERNED ABOUT THIS METHOD FAILING DUE TO OUT OF BOUNDS ON THE POSITION INCREMENTER. NEED A WAY TO EXCLUDE OUT-OF-BOUNDS INDEX
                    if($result_key_position_ARRAY[self::$result_profile_serial_handle_ARRAY[$tmp_serial_key_ARRAY[$ii]]][$tmp_serial_key_ARRAY[$ii]] < $tmp_key_count_ARRAY[self::$result_profile_serial_handle_ARRAY[$tmp_serial_key_ARRAY[$ii]]][$tmp_serial_key_ARRAY[$ii]]) {
                        $tmp_data_map = self::$oSQLMapper->retrieve_coordinates($tmp_serial, $tmp_serial_key_ARRAY[$ii], $tmp_sequence_field_ARRAY[$ii], $result_key_position_ARRAY[self::$result_profile_serial_handle_ARRAY[$tmp_serial_key_ARRAY[$ii]]][$tmp_serial_key_ARRAY[$ii]]);

                        $tmp_sequence_data[$ii] = self::$master_raw_response_ARRAY[$serial_crc][$tmp_data_map[$serial_crc][0]][$tmp_data_map[$serial_crc][1]];

                        switch ($compare_type) {
                            case 'DATETIME':
                                $new_val = strtotime($tmp_sequence_data[$ii]);

                                if (!isset($tmp_current_leader_val) || $tmp_current_leader_val < $new_val) {
                                    $tmp_serial_key = self::$result_profile_serial_handle_ARRAY[$tmp_serial_key_ARRAY[$ii]];
                                    $tmp_current_leader_profile = $tmp_serial_key_ARRAY[$ii];
                                    $tmp_current_leader_val = $new_val;
                                    #$tmp_highest_data_map = $tmp_data_map;

                                }

                                break;
                            case 'STRING':
                                $new_val = $tmp_sequence_data[$ii];

                                # Returns < 0 if str1 is less than str2; > 0 if str1 is greater than str2, and 0 if they are equal.
                                if (!isset($tmp_current_leader_val) || strcmp($tmp_current_leader_val, $new_val) < 0) {
                                    $tmp_serial_key = self::$result_profile_serial_handle_ARRAY[$tmp_serial_key_ARRAY[$ii]];
                                    $tmp_current_leader_profile = $tmp_serial_key_ARRAY[$ii];
                                    $tmp_current_leader_val = $new_val;
                                    #$tmp_highest_data_map = $tmp_data_map;

                                }

                                break;
                            case 'INT':
                                $new_val = $tmp_sequence_data[$ii];

                                if (!isset($tmp_current_leader_val) || $tmp_current_leader_val < $new_val) {
                                    $tmp_serial_key = self::$result_profile_serial_handle_ARRAY[$tmp_serial_key_ARRAY[$ii]];
                                    $tmp_current_leader_profile = $tmp_serial_key_ARRAY[$ii];
                                    $tmp_current_leader_val = $new_val;

                                }

                                break;

                        }
                    }
                }else{

                    //error_log("database (486) we skipped this guy...".$tmp_serial_key_ARRAY[$ii]);
                }
            }

            //
            // QUEUE THE MAP-POINTS TO THE RAW DATA OF THE HIGHEST AND INCREMENT IT'S POSITION TRACKER. THIS ONLY
            // SEES THE $sequence_field...NOT THE DATA ROW POSITION. WE NEED TO LOCK DOWN THE ROW. CAN WE STORE REF TO WHOLE ROW?
            // CONVERT PROFILE ROW TO ARRAY FOR RETURN

            //error_log("database (506) put me next...-->".$tmp_current_leader_profile);
            self::$result_aggregate_map_ARRAY[$new_cumm_key_crc][$i] = self::$oSQLMapper->retrieve_row_coordinates($this->return_serial(self::$result_profile_serial_handle_ARRAY[$tmp_current_leader_profile]), $tmp_current_leader_profile, $result_key_position_ARRAY[$tmp_serial_key][$tmp_current_leader_profile]);
            self::$result_aggregate_map_serial_ARRAY[$new_cumm_key_crc][$i] = $this->return_serial(self::$result_profile_serial_handle_ARRAY[$tmp_current_leader_profile]);
            self::$result_aggregate_map_profile_ARRAY[$new_cumm_key_crc][$i] = $tmp_current_leader_profile;

            self::$total_aggregate_profile_count[$new_cumm_key_crc][$tmp_current_leader_profile]--;

            $result_key_position_ARRAY[$tmp_serial_key][$tmp_current_leader_profile]++;

            //
            // WE NOW HAVE ALL DATA MAP POINTERS TO ALL DATA WHERE THE RETURN WILL BE SEQUENTIAL PER SEQUENCE FIELD. WE NEED THE METHOD THAT WILL RETURN THIS DATA

        }

    }

    public function return_aggregate_serial($profile, $pos){
        if(!isset(self::$result_aggregate_map_serial_ARRAY[crc32($profile)][$pos])){
            return self::$result_aggregate_map_serial_ARRAY[crc32($profile)][0];
        }else{

            return self::$result_aggregate_map_serial_ARRAY[crc32($profile)][$pos];
        }

    }

    public function return_aggregate_element($aggregate_key, $position){

        $aggregate_key_crc = crc32($aggregate_key);
        $tmp_data_row_map = self::$result_aggregate_map_ARRAY[$aggregate_key_crc][$position];          // RAW RESULT ROW MAP
        #$tmp_output_ARRAY[0] = self::$result_aggregate_map_profile_ARRAY[$aggregate_key_crc][$position];        // PROFILE
        #$tmp_output_ARRAY[1] = $tmp_data_row_map;
        $serial_crc = crc32(self::$result_aggregate_map_serial_ARRAY[$aggregate_key_crc][$position]);

        //
        // PROCESS RAW ROW INTO USABLE ARRAY STRUCT. WE DON'T HAVE SERIAL ($serial_crc) HERE.
        //$tmp_loop_size = sizeof(self::$master_raw_response_ARRAY[$serial_crc][$tmp_data_row_map]);

        //
        // SO WE HAVE ELEMENT WITH 18 FIELDS. I DO NOT WANT TO LOOP 18x PER ELEMENT DISPLAYED ON SCREEN TO BUILD A HANDLE
        // LET'S TRY TO USE THE RAW DATA + SQL MAPPER MAYBE.
        $tmp_output_ARRAY[0] = self::$result_aggregate_map_profile_ARRAY[$aggregate_key_crc][$position];   // PROFILE
        $tmp_output_ARRAY[1] = self::$master_raw_response_ARRAY[$serial_crc][$tmp_data_row_map];            // DATA
        $tmp_output_ARRAY[2] = self::$oSQLMapper->return_field_array(self::$result_aggregate_map_serial_ARRAY[$aggregate_key_crc][$position], self::$result_aggregate_map_profile_ARRAY[$aggregate_key_crc][$position]);

        //
        // GET FULL ROW OF DATA AND RETURN.
        # where return $tmp_aggregate_elem_ARRAY[0] = PROFILE...e.g. KIVOTOS
        # where return $tmp_aggregate_elem_ARRAY[1] = RAW DATA ARRAY
        # where return $tmp_aggregate_elem_ARRAY[2] = SQL FIELD ARRAY
        return $tmp_output_ARRAY;

    }

    public function process($mysqli,$queryType,$select_array,$query=NULL){

        //
        // THIS METHOD WILL BREAK DOWN THE SQL INPUT AND PREPARE THE WAY FOR DATABASE RESULT MAPPING.
        $this->mapSelects($select_array);

        //
        // FOR BACKWARDS COMPATIBILITY
        if(!isset($query)){

            $query="";
            //
            // BUILD QUERY FROM SELECT ARRAY
            foreach($select_array as $key=>$query_part){
                $query .= $query_part;

            }

        }

        if (sizeof($select_array) == 1) {
            //error_log("database (566) process() SINGLE query->".$query);

            //
            // EXECUTE QUERY
            // WE HAVE YET TO OOP THE HANDLING OF SINGLE QUERY RESPONSE. LET'S DO THAT.
            self::$result = self::$oEnv->oMYSQLI_CONN_MGR->processQuery($mysqli, $query);

            //
            // CONSUME MYSQLI RESULT, SINGLE QUERY. THEORETICALLY, THIS SHOULD WORK!
            $this->consume_mysqli_single_result(self::$result, $mysqli, $queryType);


        } else {
            //error_log("database (579) process() MULTI QUERY->".$query);
            //
            // EXECUTE MULTI-QUERY
            $mysqli = self::$oEnv->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, $query);

            //
            // CONSUME MYSQLI RESULT
            $this->consume_mysqli_result($mysqli, $queryType);

        }

    }

    //
    // HAVING TO PLUG A NUMBER IN HERE IS TROUBLESOME WHEN THERE MAY BE DYNAMIC USE OF DB_RESP OBJECT WHICH COULD DYNAMICALLY CHANGE THE NUMBER THAT NEEDS TO BE GIVEN HERE.
    // WE NEED A MORE ROBUST WAY TO PULL UP THE SERIAL FOR A DB_RESPONSE.
    // SHOULD BE MORE LIKE THIS...THIS MAY BE OK.
    public function return_serial($key=NULL){
        try{

            //
            // WHERE KEY IS SPECIFIED AT INITIALIZATION OF DB_RESP FOR NEW DATABASE RESPONSE
            if(isset($key)){

                //
                // THIS SHOULD BE DECENTLY FAST vs THE FOREACH() WE HAD PREVIOUSLY :: https://gist.github.com/ksimka/21a6ff74b41451c430e8
                $keypos = array_search($key, self::$resp_serial_key_ARRAY);

                if(!($keypos===false)){   // NOT SURE ABOUT THIS BUT WE WILL TRY IT OUT. NICE.
                    return self::$resp_serial_ARRAY[$keypos];
                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('You are attempting to return_serial() with key ['.$key.'] which has not been found within '.sizeof(self::$resp_serial_ARRAY).' results.');

                }

            }else{

                //
                // SIMPLY RETURN LAST SERIAL THAT WAS INITIALIZED
                return self::$resp_serial_raw[self::$resp_serial];

            }

        }catch( Exception $e ) {
            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('database_response_manager->return_serial()', LOG_EMERG, $e->getMessage());

        }

    }

    public function return_oENV(){

        return self::$oEnv;
    }

    public function return_oDB(){

        return self::$oData;
    }

    public function return_profiles($serial){
        //
        // OK. LET'S SEE IF WE RETAIN USER PROFILE DATA IN THIS VAR.
        return self::$resp_profiles_ARRAY[crc32($serial)];
    }

    public function retrieveDataByID($serial, $profile, $current_id, $fieldname){

        //
        // SUPPORT FOR MULTI-KEY-DIM-ING
        $pos = strpos($current_id, "|");
        if ($pos !== false) {

            $tmp_KEY_DATA_FIELDS_ARRAY = explode("|", $current_id);
            $tmp_count_key_fields = sizeof($tmp_KEY_DATA_FIELDS_ARRAY);

            //
            // WE HAVE UP TO 5 KEYS
            switch($tmp_count_key_fields){
                case 2:
                    if(isset(self::$rekey_profile_response_ARRAY[crc32($serial)][crc32($profile)][$tmp_KEY_DATA_FIELDS_ARRAY[0]][$tmp_KEY_DATA_FIELDS_ARRAY[1]][crc32($fieldname)])){
                        return self::$rekey_profile_response_ARRAY[crc32($serial)][crc32($profile)][$tmp_KEY_DATA_FIELDS_ARRAY[0]][$tmp_KEY_DATA_FIELDS_ARRAY[1]][crc32($fieldname)];
                    }else{
                        return NULL;
                    }

                break;
                case 3:
                    if(isset(self::$rekey_profile_response_ARRAY[crc32($serial)][crc32($profile)][$tmp_KEY_DATA_FIELDS_ARRAY[0]][$tmp_KEY_DATA_FIELDS_ARRAY[1]][$tmp_KEY_DATA_FIELDS_ARRAY[2]][crc32($fieldname)])){
                        return self::$rekey_profile_response_ARRAY[crc32($serial)][crc32($profile)][$tmp_KEY_DATA_FIELDS_ARRAY[0]][$tmp_KEY_DATA_FIELDS_ARRAY[1]][$tmp_KEY_DATA_FIELDS_ARRAY[2]][crc32($fieldname)];

                    }else{

                        return NULL;
                    }
                break;
                case 4:
                    if(isset(self::$rekey_profile_response_ARRAY[crc32($serial)][crc32($profile)][$tmp_KEY_DATA_FIELDS_ARRAY[0]][$tmp_KEY_DATA_FIELDS_ARRAY[1]][$tmp_KEY_DATA_FIELDS_ARRAY[2]][$tmp_KEY_DATA_FIELDS_ARRAY[3]][crc32($fieldname)])){
                        return self::$rekey_profile_response_ARRAY[crc32($serial)][crc32($profile)][$tmp_KEY_DATA_FIELDS_ARRAY[0]][$tmp_KEY_DATA_FIELDS_ARRAY[1]][$tmp_KEY_DATA_FIELDS_ARRAY[2]][$tmp_KEY_DATA_FIELDS_ARRAY[3]][crc32($fieldname)];

                    }else{

                        return NULL;
                    }
                break;
                case 5:
                    if(isset(self::$rekey_profile_response_ARRAY[crc32($serial)][crc32($profile)][$tmp_KEY_DATA_FIELDS_ARRAY[0]][$tmp_KEY_DATA_FIELDS_ARRAY[1]][$tmp_KEY_DATA_FIELDS_ARRAY[2]][$tmp_KEY_DATA_FIELDS_ARRAY[3]][$tmp_KEY_DATA_FIELDS_ARRAY[4]][crc32($fieldname)])){
                        return self::$rekey_profile_response_ARRAY[crc32($serial)][crc32($profile)][$tmp_KEY_DATA_FIELDS_ARRAY[0]][$tmp_KEY_DATA_FIELDS_ARRAY[1]][$tmp_KEY_DATA_FIELDS_ARRAY[2]][$tmp_KEY_DATA_FIELDS_ARRAY[3]][$tmp_KEY_DATA_FIELDS_ARRAY[4]][crc32($fieldname)];

                    }else{

                        return NULL;
                    }
                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('You are attempting to get '.$profile.' data by KEY ID, but the number of KEYs passed in ['.$tmp_count_key_fields.'] is not supported. 5 is the highest. Response serial='.$serial);

                break;
            }

        }else{
            return self::$rekey_profile_response_ARRAY[crc32($serial)][crc32($profile)][$current_id][crc32($fieldname)];
        }
    }

    public function return_field_names_ARRAY($serial, $profile=NULL){

        return self::$oSQLMapper->return_field_array($serial, $profile);
    }

    //
    // THIS METHOD NEEDS TO BE ABLE TO RECEIVE AND PROCESS A PIPE DELIM $profile STRING
    public function keyDataByID($serial, $profile, $id_field){

        $serial_crc = crc32($serial);

        $pos = strpos($profile, "|");
        if ($pos !== false) {

            //
            // PROCESS PIPE DELIM
            $tmp_PROFILE_ARRAY = explode("|", $profile);
            $tmp_count_PROFILE = sizeof($tmp_PROFILE_ARRAY);

            for ($iii = 0; $iii < $tmp_count_PROFILE; $iii++) {

                $profile_crc = crc32($tmp_PROFILE_ARRAY[$iii]);

                //
                // WE NEED TO PUT THIS DATA INTO ARRAY KEY'D BY ID
                if(!isset(self::$result_profile_count_ARRAY[$serial_crc][$profile_crc])){
                    $tmp_loop_size = 0;

                }else{
                    $tmp_loop_size = self::$result_profile_count_ARRAY[$serial_crc][$profile_crc];

                }

                $tmp_profile_field_cnt = (int)self::$resp_profile_size_ARRAY[$serial_crc][$profile_crc];
                $tmp_current_row_KEYS_ARRAY = array();

                $pos_profile_pipe = strpos($id_field, "|");
                if ($pos_profile_pipe !== false) {

                    $tmp_KEY_DATA_FIELDS_ARRAY = explode("|", $id_field);
                    $tmp_count_key_fields = sizeof($tmp_KEY_DATA_FIELDS_ARRAY);

                    //
                    // WE HAVE MULTI-DEM KEY-ING TO PERFORM
                    // FOR EACH ROW OF SELECT PROFILE DATA
                    for ($i = 0; $i < $tmp_loop_size; $i++) {

                        //
                        // RETRIEVE COORDINATES / VALUES FOR KEY DATA
                        for($ii=0;$ii<$tmp_count_key_fields;$ii++){

                            $tmp_data_map = self::$oSQLMapper->retrieve_coordinates($serial, $tmp_PROFILE_ARRAY[$iii], $tmp_KEY_DATA_FIELDS_ARRAY[$ii], $i);

                            //
                            // PRIMARY KEY TO BE USED AS INDEX FOR ALL DATA FIELDS.
                            $tmp_current_row_KEYS_ARRAY[$ii] = self::$master_raw_response_ARRAY[$serial_crc][$tmp_data_map[$serial_crc][0]][$tmp_data_map[$serial_crc][1]];

                        }

                        //
                        // FOR EACH FIELD IN THE ROW...
                        for ($ii = 0; $ii < $tmp_profile_field_cnt; $ii++) {

                            //
                            // CURRENT FIELD NAME
                            $tmp_current_field_name = self::$oSQLMapper->return_field_name($serial, $tmp_PROFILE_ARRAY[$iii], $ii);

                            //
                            // RETRIEVE COORDINATES FOR RAW DATA OF CURRENT FIELD
                            $tmp_data_map = self::$oSQLMapper->retrieve_coordinates($serial, $tmp_PROFILE_ARRAY[$iii], $tmp_current_field_name, $i);

                            //
                            // STORE DATA IN APPROPRIATELY KEYED ARRAY
                            switch($tmp_count_key_fields){
                                case 2:
                                    self::$rekey_profile_response_ARRAY[$serial_crc][$profile_crc][$tmp_current_row_KEYS_ARRAY[0]][$tmp_current_row_KEYS_ARRAY[1]][crc32($tmp_current_field_name)] = self::$master_raw_response_ARRAY[$serial_crc][$tmp_data_map[$serial_crc][0]][$tmp_data_map[$serial_crc][1]];
                                break;
                                case 3:
                                    self::$rekey_profile_response_ARRAY[$serial_crc][$profile_crc][$tmp_current_row_KEYS_ARRAY[0]][$tmp_current_row_KEYS_ARRAY[1]][$tmp_current_row_KEYS_ARRAY[2]][crc32($tmp_current_field_name)] = self::$master_raw_response_ARRAY[$serial_crc][$tmp_data_map[$serial_crc][0]][$tmp_data_map[$serial_crc][1]];
                                break;
                                case 4:
                                    self::$rekey_profile_response_ARRAY[$serial_crc][$profile_crc][$tmp_current_row_KEYS_ARRAY[0]][$tmp_current_row_KEYS_ARRAY[1]][$tmp_current_row_KEYS_ARRAY[2]][$tmp_current_row_KEYS_ARRAY[3]][crc32($tmp_current_field_name)] = self::$master_raw_response_ARRAY[$serial_crc][$tmp_data_map[$serial_crc][0]][$tmp_data_map[$serial_crc][1]];
                                break;
                                case 5:
                                    self::$rekey_profile_response_ARRAY[$serial_crc][$profile_crc][$tmp_current_row_KEYS_ARRAY[0]][$tmp_current_row_KEYS_ARRAY[1]][$tmp_current_row_KEYS_ARRAY[2]][$tmp_current_row_KEYS_ARRAY[3]][$tmp_current_row_KEYS_ARRAY[4]][crc32($tmp_current_field_name)] = self::$master_raw_response_ARRAY[$serial_crc][$tmp_data_map[$serial_crc][0]][$tmp_data_map[$serial_crc][1]];
                                break;
                                default:

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    throw new Exception('You are attempting to key '.$tmp_PROFILE_ARRAY[$iii].' data by ID, but the number of KEYs passed in ['.$tmp_count_key_fields.'] is not supported. 5 is the highest. Response serial='.$serial);

                                break;
                            }
                        }
                    }

                }else{

                    //
                    // FOR EACH ROW OF SELECT PROFILE DATA
                    for ($i = 0; $i < $tmp_loop_size; $i++) {
                        //
                        // GET PRIMARY ID LOCATION FOR ROW.
                        $tmp_data_map = self::$oSQLMapper->retrieve_coordinates($serial, $tmp_PROFILE_ARRAY[$iii], $id_field, $i);

                        //
                        // PRIMARY KEY TO BE USED AS INDEX FOR ALL DATA FIELDS.
                        $tmp_current_row_KEY = self::$master_raw_response_ARRAY[$serial_crc][$tmp_data_map[$serial_crc][0]][$tmp_data_map[$serial_crc][1]];

                        //
                        // LET'S RE-KEY THE DATA BY ID_FIELD. THIS WILL TAKE SOME CONSIDERATION.
                        // BASICALLY, THIS SHOULD ULTIMATELY HAPPEN

                        //
                        // FOR EACH FIELD IN THE ROW...
                        for ($ii = 0; $ii < $tmp_profile_field_cnt; $ii++) {

                            //
                            // CURRENT FIELD NAME
                            $tmp_current_field_name = self::$oSQLMapper->return_field_name($serial, $tmp_PROFILE_ARRAY[$iii], $ii);

                            //
                            // NEED THE ABILITY TO PULL UP FIELD NAME (FROM SELECT STATEMENT) BY POSITION
                            #self::$resp_fieldPosition_viaFieldName[crc32($serial)][self::$select_statement_pos_ARRAY[crc32($serial)][crc32($profile)]][crc32($tmp_current_field_name)];

                            $tmp_data_map = self::$oSQLMapper->retrieve_coordinates($serial, $tmp_PROFILE_ARRAY[$iii], $tmp_current_field_name, $i);
                            self::$rekey_profile_response_ARRAY[$serial_crc][crc32($profile)][$tmp_current_row_KEY][crc32($tmp_current_field_name)] = self::$master_raw_response_ARRAY[$serial_crc][$tmp_data_map[$serial_crc][0]][$tmp_data_map[$serial_crc][1]];
                        }
                    }
                }

            }

        }else{

            $profile_crc = crc32($profile);

            //
            // WE NEED TO PUT THIS DATA INTO ARRAY KEY'D BY ID
            if(!isset(self::$result_profile_count_ARRAY[$serial_crc][$profile_crc])){
                $tmp_loop_size = 0;

            }else{
                $tmp_loop_size = self::$result_profile_count_ARRAY[$serial_crc][$profile_crc];

            }
            $tmp_profile_field_cnt = (int)self::$resp_profile_size_ARRAY[$serial_crc][$profile_crc];
            $tmp_current_row_KEYS_ARRAY = array();

            $pos = strpos($id_field, "|");
            if ($pos !== false) {

                $tmp_KEY_DATA_FIELDS_ARRAY = explode("|", $id_field);
                $tmp_count_key_fields = sizeof($tmp_KEY_DATA_FIELDS_ARRAY);

                //
                // WE HAVE MULTI-DEM KEY-ING TO PERFORM
                // FOR EACH ROW OF SELECT PROFILE DATA
                for ($i = 0; $i < $tmp_loop_size; $i++) {

                    //
                    // RETRIEVE COORDINATES / VALUES FOR KEY DATA
                    for($ii=0;$ii<$tmp_count_key_fields;$ii++){

                        $tmp_data_map = self::$oSQLMapper->retrieve_coordinates($serial, $profile, $tmp_KEY_DATA_FIELDS_ARRAY[$ii], $i);

                        //
                        // PRIMARY KEY TO BE USED AS INDEX FOR ALL DATA FIELDS.
                        $tmp_current_row_KEYS_ARRAY[$ii] = self::$master_raw_response_ARRAY[$serial_crc][$tmp_data_map[$serial_crc][0]][$tmp_data_map[$serial_crc][1]];

                    }

                    //
                    // FOR EACH FIELD IN THE ROW...
                    for ($ii = 0; $ii < $tmp_profile_field_cnt; $ii++) {

                        //
                        // CURRENT FIELD NAME
                        $tmp_current_field_name = self::$oSQLMapper->return_field_name($serial, $profile, $ii);

                        //
                        // RETRIEVE COORDINATES FOR RAW DATA OF CURRENT FIELD
                        $tmp_data_map = self::$oSQLMapper->retrieve_coordinates($serial, $profile, $tmp_current_field_name, $i);

                        //
                        // STORE DATA IN APPROPRIATELY KEYED ARRAY
                        switch($tmp_count_key_fields){
                            case 2:
                                self::$rekey_profile_response_ARRAY[crc32($serial)][crc32($profile)][$tmp_current_row_KEYS_ARRAY[0]][$tmp_current_row_KEYS_ARRAY[1]][crc32($tmp_current_field_name)] = self::$master_raw_response_ARRAY[$serial_crc][$tmp_data_map[$serial_crc][0]][$tmp_data_map[$serial_crc][1]];
                                break;
                            case 3:
                                self::$rekey_profile_response_ARRAY[crc32($serial)][crc32($profile)][$tmp_current_row_KEYS_ARRAY[0]][$tmp_current_row_KEYS_ARRAY[1]][$tmp_current_row_KEYS_ARRAY[2]][crc32($tmp_current_field_name)] = self::$master_raw_response_ARRAY[$serial_crc][$tmp_data_map[$serial_crc][0]][$tmp_data_map[$serial_crc][1]];
                                break;
                            case 4:
                                self::$rekey_profile_response_ARRAY[crc32($serial)][crc32($profile)][$tmp_current_row_KEYS_ARRAY[0]][$tmp_current_row_KEYS_ARRAY[1]][$tmp_current_row_KEYS_ARRAY[2]][$tmp_current_row_KEYS_ARRAY[3]][crc32($tmp_current_field_name)] = self::$master_raw_response_ARRAY[$serial_crc][$tmp_data_map[$serial_crc][0]][$tmp_data_map[$serial_crc][1]];
                                break;
                            case 5:
                                self::$rekey_profile_response_ARRAY[crc32($serial)][crc32($profile)][$tmp_current_row_KEYS_ARRAY[0]][$tmp_current_row_KEYS_ARRAY[1]][$tmp_current_row_KEYS_ARRAY[2]][$tmp_current_row_KEYS_ARRAY[3]][$tmp_current_row_KEYS_ARRAY[4]][crc32($tmp_current_field_name)] = self::$master_raw_response_ARRAY[$serial_crc][$tmp_data_map[$serial_crc][0]][$tmp_data_map[$serial_crc][1]];
                                break;
                            default:

                                //
                                // HOOOSTON...VE HAF PROBLEM!
                                throw new Exception('You are attempting to key '.$profile.' data by ID, but the number of KEYs passed in ['.$tmp_count_key_fields.'] is not supported. 5 is the highest. Response serial='.$serial);

                                break;
                        }
                    }
                }

            }else{

                //
                // FOR EACH ROW OF SELECT PROFILE DATA
                for ($i = 0; $i < $tmp_loop_size; $i++) {
                    //
                    // GET PRIMARY ID LOCATION FOR ROW.
                    $tmp_data_map = self::$oSQLMapper->retrieve_coordinates($serial, $profile, $id_field, $i);

                    //
                    // PRIMARY KEY TO BE USED AS INDEX FOR ALL DATA FIELDS.
                    $tmp_current_row_KEY = self::$master_raw_response_ARRAY[$serial_crc][$tmp_data_map[$serial_crc][0]][$tmp_data_map[$serial_crc][1]];

                    //
                    // LET'S RE-KEY THE DATA BY ID_FIELD. THIS WILL TAKE SOME CONSIDERATION.
                    // BASICALLY, THIS SHOULD ULTIMATELY HAPPEN

                    //
                    // FOR EACH FIELD IN THE ROW...
                    for ($ii = 0; $ii < $tmp_profile_field_cnt; $ii++) {

                        //
                        // CURRENT FIELD NAME
                        $tmp_current_field_name = self::$oSQLMapper->return_field_name($serial, $profile, $ii);

                        //
                        // NEED THE ABILITY TO PULL UP FIELD NAME (FROM SELECT STATEMENT) BY POSITION
                        #self::$resp_fieldPosition_viaFieldName[crc32($serial)][self::$select_statement_pos_ARRAY[crc32($serial)][crc32($profile)]][crc32($tmp_current_field_name)];

                        $tmp_data_map = self::$oSQLMapper->retrieve_coordinates($serial, $profile, $tmp_current_field_name, $i);
                        self::$rekey_profile_response_ARRAY[$serial_crc][crc32($profile)][$tmp_current_row_KEY][crc32($tmp_current_field_name)] = self::$master_raw_response_ARRAY[$serial_crc][$tmp_data_map[$serial_crc][0]][$tmp_data_map[$serial_crc][1]];
                    }
                }
            }
        }


    }

    public function ping_profile_existence($serial, $profile){

        $serial_crc = crc32($serial);
        $profile_crc = crc32($profile);

        if(!isset(self::$result_profile_count_ARRAY[$serial_crc][$profile_crc])){

            return false;
        }else{

            return true;
        }

    }

    public function ping_value_existence($serial, $profile, $fieldname, $value){

        $serial_crc = crc32($serial);
        $profile_crc = crc32($profile);

        if(!isset(self::$result_profile_count_ARRAY[$serial_crc][$profile_crc])){

            return false;
        }

        //
        // WE WILL NEED TO LOOP HERE...UNFORTUNATELY...
        $tmp_loop_size = self::$result_profile_count_ARRAY[$serial_crc][$profile_crc];
        for($i=0;$i<$tmp_loop_size;$i++){

            // ROWCNT WE CAN GET FROM MAPPER. CAN WE GET FIELD POSITION FROM FIELD NAME...
            // CURRENTLY, DATA IS ONLY STORED HERE :: self::$master_raw_response_ARRAY[self::$resp_serial][$ROWCNT][$fieldPos] = $value;
            // RESULT MAPPER HAS THIS self::$result_profile_results_ARRAY[$resp_serial][crc32($tmp_profile)][$count] = ROWCNT TO ACCESS DATA VALUE IN RAW ARRAY.
            $tmp_pointer_array = self::$oSQLMapper->return_value_pointer_array($serial,$profile,$fieldname,$i);
            if(self::$master_raw_response_ARRAY[$serial_crc][$tmp_pointer_array[0]][$tmp_pointer_array[1]] = $value){

                return true;
            }

        }

        return false;

    }

    public function initialize_serial_map_for_deep_stream($profile, $serial){

        self::$result_aggregate_map_serial_ARRAY[crc32($profile)][0] = $serial;
    }

    public function initialize_count_for_deep_stream($profile, $size){

        self::$total_aggregate_count[crc32($profile)] = $size;
    }

    public function return_sizeof_aggregate($profile){

        if(!isset(self::$total_aggregate_count[crc32($profile)])){

            return false;

        }else {

            return self::$total_aggregate_count[crc32($profile)];
        }
    }

    public function return_sizeof($serial, $profile){
        if(is_array($profile)){
            $tmp_size_array = array();
            $tmp_loop_size = sizeof($profile);
            for($i=0;$i<$tmp_loop_size;$i++) {
                $tmp_size_array[$i] = self::$result_profile_count_ARRAY[crc32($serial)][crc32($profile[$i])];

            }

            return $tmp_size_array;

        }else{ // I DIDN'T SEE ASSETS COME UP...LETS TRY AGAIN.
            #error_log("database (441) serial[".crc32($serial)."] profile[".crc32($profile)."] result_profile_count_ARRAY[".self::$result_profile_count_ARRAY[crc32($serial)][crc32($profile)]."]");
            $tmp_serial = crc32($serial); // IT IS THE SERIAL THAT IS BEING CHECKSUMMED 2X. EXPECTING RAW.
            $tmp_profile = crc32($profile);

            // I THINK MY SERIAL IS COMING IN ALREADY CHECKSUMMED. SO I COULD BE DOUBLE CHECKSUMMING IT. LETS REMOVE THE SERIAL CHECKSUM. LET ME CHECK. OTHER SECTIONS
            // OF THE APP USE THIS METHOD TOO?, AND THEY WORK NOW.
            // WE HAVE SOME WORK TO DO HERE...YEP...PROB MAY BE JUST UP STREAM. I AM NOT EVEN USING THIS VALUE....  :(   LOL.

            if(isset(self::$result_profile_count_ARRAY[$tmp_serial][$tmp_profile])){

                return self::$result_profile_count_ARRAY[$tmp_serial][$tmp_profile];
            }else{

                $this->errStatus = self::$queryType."=error=EVIFWEB database_response_manager::return_sizeof() failed to locate data.";
                throw new Exception('eVifweb database_response_manager::return_sizeof() :: result_profile_count_ARRAY not set for serial['.$serial.'] profile['.$profile.']');

            }

        }

    }

    public function mapSelects($sql_select_array){

        //
        // MAPPING WILL BE PERFORMED BY MAPPER
        self::$oSQLMapper->mapQueryData(self::$resp_serial, $sql_select_array);

    }

    public function initialize($serial, $serial_key, $profiles, $fieldcnt, $SQLalign=false){

        self::$resp_serial_ARRAY[] = $serial;
        self::$resp_serial_key_ARRAY[] = $serial_key;
        self::$resp_serial = crc32($serial);
        self::$resp_serial_raw[self::$resp_serial] = $serial;
        self::$resp_profiles_ARRAY[self::$resp_serial] = explode("|", $profiles);  # I SEE. SIMPLE OVERRIDE. LET'S MAKE THIS SERIALIZABLE. I THINK WE CAN JUST DO THAT. LET'S CHECK. YEAH, NO PROB.
        self::$resp_fieldcnt_ARRAY = explode("|", $fieldcnt);

        #error_log("database (539) size of select array [".sizeof(self::$resp_profiles_ARRAY[self::$resp_serial])."]");

        //
        // I NEED AN OPTION TO DETERMINE SELECT PROFILE VIA ORDER OF SQL STATEMENTS/PROFILE_PIPE_STRING. TO GET AROUND SELECTS WITH THE SAME NUMBER OF RETURNED FIELDS.
        self::$resp_profiles_SQL_align = $SQLalign;

        //
        // ALSO STORE META IN NON-LOOP-INDUCING FORMAT
        $tmp_loop_size = sizeof(self::$resp_profiles_ARRAY[self::$resp_serial]);
        for($i=0;$i<$tmp_loop_size;$i++){

            //
            // BUILD AN SQL PROFILE ORIENTED HANDLE FOR DIRECT ACCESS TO SERIAL
            self::$serial_by_sql_profile[self::$resp_profiles_ARRAY[self::$resp_serial][$i]] = $serial;

            //
            // INITIALIZE RESULT COUNT TO ZERO. HOPEFULLY, BETTER...GEEZ..EVERYTHING IS SERIALIZED!!  :)
            self::$result_profile_count_ARRAY[self::$resp_serial][crc32(self::$resp_profiles_ARRAY[self::$resp_serial][$i])] = 0;

            //
            // STORE FOR DIRECT ACCESS
            self::$resp_profile_viaCnt_ARRAY[self::$resp_serial][self::$resp_fieldcnt_ARRAY[$i]] = self::$resp_profiles_ARRAY[self::$resp_serial][$i];

            //
            // STORE RECORD OF FIELD COUNT PER SELECT PROFILE TO POWER KEY-BY-ID FUNCTIONALITY
            self::$resp_profile_size_ARRAY[self::$resp_serial][crc32(self::$resp_profiles_ARRAY[self::$resp_serial][$i])] = self::$resp_fieldcnt_ARRAY[$i];
            self::$oSQLMapper->updateSelectPos($serial, self::$resp_profiles_ARRAY[self::$resp_serial][$i], $i);
        }

    }

    public function consume_mysqli_result($heavy_mysqli, $queryType){

        self::$queryType = $queryType;

        //
        // THAT IS WIERD....IF I DEBUG THIS...IT BREAKS...BUT IT WORKS FINE...LETS TRY AGAIN...
        // SO IF I BREAK HERE...IT THROWS EXCEPTION...LETS BREAK IT. I NEED TO SEE HOW THIS HANDLES SQL ERR.
        // SO THERE ARE EXCEPTIONS THAT WILL BE THROWN CLOSER TO THE SOURCE OF THE SQL ERROR HERE. OK TO CHECK, BUT I DON'T NEED TO FRET OVER CHECKING THIS PARTICULAR SECTION
        if($heavy_mysqli->error){

            //
            // HOOOSTON...VE HAF PROBLEM!
            $this->errStatus = $queryType."=error=".$heavy_mysqli->error;
            throw new Exception('eVifweb database_response_manager :: '.$queryType.' ERROR :: ['.$heavy_mysqli->error.']');

        }else{

            //
            // THIS IS WHERE THE MAGIC HAPPENS. NEED TO STORE DATA EXACTLY WHERE IT NEEDS TO BE FOR LATER ACCESS.
            // IF THERE IS ANY MISSING CONFIG DATA, GO BACK AND MODIFY THE INPUTS. WE'LL HIT THOSE WALLS WHEN WE GET TO THEM.

            # BASICALLY, I WOULD LIKE TO STORE DATA LIKE THIS
            $ROWCNT=0;
            $select_query_cnt = 0;
            do {
                if ($result = $heavy_mysqli->store_result()) {

                    while ($row = $result->fetch_row()) {
                        foreach($row as $fieldPos=>$value){

                            //
                            // THE GOAL IS TO HAVE THIS METHOD STORE THE DATA IN A NON-LOOP-INDUCING MANNER WHERE EACH ELEMENT CAN BE ACCESSED DIRECTLY.
                            $this->queueRawResponse($ROWCNT,$fieldPos,$value);

                        }

                        //
                        // FLAG FIELD COUNT TO IDENTIFY PROFILE TYPE OF CURRENT ROW BEFORE MOVING ON
                        #error_log("database (1040) consume_mysqli_result() flagRespFieldCount row[".$ROWCNT."] fieldPos[".$fieldPos."] select query[".$select_query_cnt."] serial[".self::$resp_serial."]");
                        $this->flagRespFieldCount($ROWCNT,$select_query_cnt);
                        $ROWCNT++;

                    }

                    $result->free();
                }

                if ($heavy_mysqli->more_results()) {
                    //
                    // END OF RECORD. MORE TO FOLLOW. LET'S SMOKE TEST THIS. I HOPE IT INCREMENTS PER EACH SELECT QUERY RESULTS COMPLETION. (APPARENTLY, IT DOES)
                    $select_query_cnt++;
                    //error_log("database (1053) process next result set ".$select_query_cnt);
                }

            } while ($heavy_mysqli->more_results() && $heavy_mysqli->next_result());

        }

        //error_log("database (1060) done processing multi-query. rows=".$ROWCNT);
    }

    public function consume_mysqli_single_result($result, $heavy_mysqli, $queryType){

        self::$queryType = $queryType;

        if($heavy_mysqli->error){
            self::$query_exception_result = $queryType."=error";
            throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.$heavy_mysqli->error.']');

        }else{

            $ROWCNT=0;
            $select_query_cnt=0;
            $tmp_flag_this_row = false;

            //
            // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
            #$ROWCNT=0; CONTINUE ROWCNT FROM PREVIOUS RESULT PROCESSING
            while ($row = $result->fetch_row()) {

                foreach($row as $fieldPos=>$value){
                    //
                    // STORE RESULT
                    $this->queueRawResponse($ROWCNT,$fieldPos,$value);
                    #error_log("database (561) row[".$ROWCNT."] field[".$fieldPos."] value[".$value."]");
                    $tmp_flag_this_row = true;

                }

                //
                // FLAG FIELD COUNT TO IDENTIFY PROFILE TYPE OF CURRENT ROW BEFORE MOVING ON
                if($tmp_flag_this_row) {
                    #error_log("database (653) consume_mysqli_single_result() flagRespFieldCount row[".$ROWCNT."] fieldPos[".$fieldPos."] select query[".$select_query_cnt."] serial[".self::$resp_serial."]");
                    $this->flagRespFieldCount($ROWCNT, $select_query_cnt);
                    $tmp_flag_this_row = false;

                }


                $ROWCNT++;
                #$select_query_cnt++;

            }

            $result->free();

        }

    }

    # serial USER FIRSTNAME 0
    // OOPS. I THINK THE EXPECTATION IS THAT THIS $POS INT BE A REPRESENTATION OF RECORD COUNT FOR THE SPECIFIC PROFILE DATA...NOT COUNT OF GLOBAL ELEMENT ARRAY.
    // WE NEED TO RECONCILE THIS...AND HOPEFULLY WITHOUT NEEDING TO DO ANY LOOPING THROUGH RESULTS.

    #$oDB_RESP->return_data_element($db_resp_process_serial, 'KIVOTOS_00', 'CLIENT_ID', 0);
    public function return_data_element($serial, $profile, $field, $pos=0){
        $serial_crc = crc32($serial);

        //
        // DATA IS STORED IN MASTER_RAW ARRAY[self::$resp_serial][$ROWCNT][$fieldPos].
        #error_log("database (680) serial[".$serial."], profile[".$profile."], field[".$field."], pos[".$pos."]");
        $tmp_data_map = self::$oSQLMapper->retrieve_coordinates($serial, $profile, $field, $pos);

        # $tmp_data_map[serial][0] = $ROWCNT
        # $tmp_data_map[serial][1] = $fieldPos

        #error_log("database (686) data map field[".$field."] pos[".$pos."] 0=[".$tmp_data_map[$serial_crc][0]."]   1=[".$tmp_data_map[$serial_crc][1]."]");

        //
        // SO HERE WE ARE LOADING RESULTS FROM GLOBAL RAW RESULTS ARRAY. LET'S USE THIS ROW COUNT TO ACCESS RESULT DATA.
        # self::$master_raw_response_ARRAY[self::$resp_serial][$ROWCNT][$fieldPos]
        #error_log("database (290) [".crc32($serial)."][".$profile."][".$field."][".$pos."]");
        return self::$master_raw_response_ARRAY[$serial_crc][$tmp_data_map[$serial_crc][0]][$tmp_data_map[$serial_crc][1]];

    }

    private function queueRawResponse($ROWCNT, $fieldPos, $value){

        //
        // GEEZ. IF I STORE THIS IN AN ARRAY HERE...DO I GET AROUND NEEDING TO LOOP THROUGH THE SET AGAIN?
        // WHEN I GET THE FIRST ELEMENT, I DO NOT KNOW WHAT IT IS..RESULT-WISE...ONLY AFTER A ROW IS COMPLETED (NEW ROW STARTED), CAN I SEE
        // WHAT DATA A ROW REALLY REPRESENTS...BASED UPON FIELD COUNT. WILL HAVE TO PROCESS ROW BY ROW.
        self::$master_raw_response_ARRAY[self::$resp_serial][$ROWCNT][$fieldPos] = $value;

    }

    //
    // THIS IS GLOBAL RECORD COUNT...NOT PROFILE SPECIFIC. THIS METHOD IS NOT FIRED WHEN NO RESULTS COME FROM THE DATABASE, BUT I STILL NEED TO ASK
    // THE QUESTION, AND THIS STILL NEEDS TO TELL ME ZERO...NOT UNDEFINED OR ERR.
    private function flagRespFieldCount($ROWCNT, $select_query_pos){

        //
        // TAKE FIELD COUNT TO DETERMINE DATA PROFILE. DO WE WANT TO RUN A QUICK TEST TO SEE IF DB RESULT ALIGNS TO ORDER OF MULTI-QUERY? OR DO WE
        // NOT WANT TO WORRY ABOUT THAT AND MAKE THIS THING "CASE-INSENSITIVE"?
        $tmp_row_size = sizeof(self::$master_raw_response_ARRAY[self::$resp_serial][$ROWCNT]);

        if(self::$resp_profiles_SQL_align){
            //
            // FROM WHAT I HAVE BEEN ABLE TO TELL, THIS IS WORKING. I HAVE SOME SELECTS RETURNING NO DATA SO NOT SHOWING UP. WE WILL RUN KIVOTOS IN TRUE MODE FOR MORE TESTING.
            #error_log("database (715) flagRespFieldCount tmp_row_size[".$tmp_row_size."] resp_serial[".self::$resp_serial."] select_query_pos[".$select_query_pos."] size[".sizeof(self::$resp_profiles_ARRAY[self::$resp_serial])."]");
            $tmp_profile = self::$resp_profiles_ARRAY[self::$resp_serial][$select_query_pos];
        }else {
            $tmp_profile = self::$resp_profile_viaCnt_ARRAY[self::$resp_serial][$tmp_row_size];
        }

        //error_log("database (721) do I change? tmp_profile->".$tmp_profile);
        // IT LOOKS LIKE MY SINGLE MYSQLI PROCESSOR IS RUNNING AN UNNECESSARY PROCESS AT THE END. LET'S CHECK.
        // STORE FOR MAPPING OF RESOURCE ACCESS
        // ROWCOUNT
        // PROFILE

        if($tmp_profile!=""){

            self::$result_record_profile_viaRowCnt_ARRAY[self::$resp_serial][$ROWCNT] = $tmp_profile;
            #error_log("database (730) store profile[".$tmp_profile."] in serial[".self::$resp_serial."] row[".$ROWCNT."]");

            //
            // WE NEED A RECORD OF ALL ROWS (AND THEIR RAW RECORD QUEUE POSITION) BY PROFILE TYPE
            // WE HAVE CONFIRMED THAT COUNT IS BEING INITIALIZED TO ZERO FOR COMM_STREAM, RIGHT?
            if(!isset(self::$result_profile_count_ARRAY[self::$resp_serial][crc32($tmp_profile)])){
                #error_log("database (666) set result_profile_count_ARRAY to serial[".self::$resp_serial."] profile[".crc32($tmp_profile)."/".$tmp_profile."] value 0");
                self::$result_profile_count_ARRAY[self::$resp_serial][crc32($tmp_profile)] = 0;

            }

            // TESTING SCOPE. I SHOULD BE ABLE TO ACCESS THIS GUY FROM THE OUTPUT FORMATTING METHOD.
            # [serial] [USER] [0] = $ROWCNT <- global raw array position
            #self::$result_profile_results_ARRAY[self::$resp_serial][$tmp_profile][self::$result_profile_count_ARRAY[self::$resp_serial][$tmp_profile]] = $ROWCNT;
            #error_log("database (673) result_profile_count_ARRAY serial[".self::$resp_serial."] profile[".$tmp_profile."/".crc32($tmp_profile)."] row[".$ROWCNT."] value[".self::$result_profile_count_ARRAY[self::$resp_serial][crc32($tmp_profile)]."]");

            self::$oSQLMapper->updateProfileResults(self::$resp_serial, $tmp_profile, self::$result_profile_count_ARRAY[self::$resp_serial][crc32($tmp_profile)], $ROWCNT);

            self::$result_profile_count_ARRAY[self::$resp_serial][crc32($tmp_profile)]++;

        }else{

            //
            // HOOOSTON...VE HAF PROBLEM!
            throw new Exception('Record returned at row ['.$ROWCNT.'] has a field count which is not represented by any provided profiles.');

        }
    }

    //
    // IF THIS IS GOING TO CRNRSTN...METHODS SUCH AS THIS NEED TO BE MADE MORE GENERIC.
    public function flag_isset_for_userClient($serial, $tmp_USERS_USERID, $tmp_CLIENT_CLIENTID=NULL){

        $serial_crc = crc32($serial);

        if(isset($tmp_CLIENT_CLIENTID)){
            if(isset(self::$flag_results[$serial_crc][$tmp_USERS_USERID][$tmp_CLIENT_CLIENTID])){

                return true;
            }else{

                return false;
            }

        }else{

            if(isset(self::$flag_results[$serial_crc][$tmp_USERS_USERID])){
                if(sizeof(self::$flag_results[$serial_crc][$tmp_USERS_USERID])>0){

                    return true;
                }else{

                    return false;
                }
            }else{
                return false;
            }
        }
    }

    public function data_prep_flagUserAssociations($serial, $profile){

        $serial_crc = crc32($serial);
        $profile_crc = crc32($profile);

        //
        // THIS METHOD WILL PERFORM DATA PROCESSING TO FLAG USER-CLIENT ASSOCIATIONS
        #$tmp_userClient[$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_client_assoc_USER_ID']]][$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_client_assoc_CLIENT_ID']]]=1;
        if(!isset(self::$result_profile_count_ARRAY[$serial_crc][$profile_crc])) {

            //
            // HOOOSTON...VE HAF PROBLEM!
            throw new Exception('SELECT profile['.$profile.'] has NULL count for response serial['.$serial.'] which may be indication of an SQL error.');

        }else{
            $tmp_loop_size = self::$result_profile_count_ARRAY[$serial_crc][$profile_crc];
            for($i=0;$i<$tmp_loop_size;$i++){
                //
                // FOR EACH USER-CLIENT ASSOCIATION
                $tmp_USER_ID_pointer_array = self::$oSQLMapper->return_value_pointer_array($serial,$profile,'USER_ID',$i);
                $tmp_CLIENT_ID_pointer_array = self::$oSQLMapper->return_value_pointer_array($serial,$profile,'CLIENT_ID',$i);

                $tmp_USER_ID = self::$master_raw_response_ARRAY[self::$resp_serial][$tmp_USER_ID_pointer_array[0]][$tmp_USER_ID_pointer_array[1]];
                $tmp_CLIENT_ID = self::$master_raw_response_ARRAY[self::$resp_serial][$tmp_CLIENT_ID_pointer_array[0]][$tmp_CLIENT_ID_pointer_array[1]];
                self::$flag_results[crc32($serial)][$tmp_USER_ID][$tmp_CLIENT_ID] = 1;

            }
        }

    }

    public function return_UserClientAssocCnt($serial, $tmp_USERS_USERID){

        return sizeof(self::$flag_results[crc32($serial)][$tmp_USERS_USERID]);

    }

    public function ping_user_client_assoc($serial, $userid, $clientid){

        if(isset(self::$flag_results[crc32($serial)][$userid][$clientid])){

            return true;

        }else{

            return false;
        }

    }

    public function __destruct() {

    }

}



/*
// CLASS :: database_integration
// AUTHOR :: Jonathan 'J5' Harris <jharris@evifweb.com>
// VERSION :: 1.0.0
*/
class database_integration {
	private static $oLogger;
	private static $oDB_RESP;

	private static $mysqli;
	private static $query;
	private static $query_elements;
	private static $result;
	private static $result_ARRAY = array();
	private static $result_MSGQUEUE_ARRAY = array();
	private static $result_UNSUB_ARRAY = array();
	private static $result_PWD_ARRAY = array();
	private static $queryDescript_ARRAY = array();
	private static $query_exception_result = false;
	public $recursive_target_id_omit_flag = array();
	
	public function __construct() {
		//
		// INSTANTIATE LOGGER
		self::$oLogger = new crnrstn_logging();
		//error_log("database (1460) __construct() called.");
		
	}

	public function return_sys_notice_SQL($key,$primary_id,$secondary_id=NULL){
	    try{

            $tmp_SQL_ARRAY = array();

            switch($key){
                case 'STREAM':
                    #$primary_id='stream_id', $secondary_id=i_feed_stream_id or NULL

                    $tmp_query = 'SELECT `comm_stream`.`STREAM_ID`,
                    `comm_stream`.`STREAM_TYPE`,
                    `comm_stream`.`CLIENT_ID`,
                    `comm_stream`.`USER_ID`,
                    `comm_stream`.`ISACTIVE`,
                    `comm_stream`.`KIVOTOS_ID`,
                    `comm_stream`.`ASSET_ID`,
                    `comm_stream`.`STREAM_CONTENT`,
                    `comm_stream`.`STREAM_FORMATTED`,
                    `comm_stream`.`FEEDER_STREAM_COUNT`,
                    `comm_stream`.`I_FEED_STREAM_ID`,
                    `comm_stream`.`ATTACHED_ASSET_ID`,
                    `comm_stream`.`ISMODIFIED`,
                    `comm_stream`.`DATEMODIFIED`,
                    `comm_stream`.`DATECREATED`,
                    `comm_stream_flow`.`FLOW_ID`,
                    `comm_stream_flow`.`CLIENT_ID` AS `CLIENT_ID_FLOW`,
                    `comm_stream_flow`.`STREAM_ID` AS `STREAM_ID_FLOW`,
                    `comm_stream_flow`.`FEEDER_STREAM_ID` FROM `comm_stream` LEFT OUTER JOIN `comm_stream_flow` ON `comm_stream`.`STREAM_ID` = `comm_stream_flow`.`FEEDER_STREAM_ID` WHERE 
                    (`comm_stream_flow`.`STREAM_ID`="' . self::$mysqli->real_escape_string($primary_id) . '" AND 
                    `comm_stream_flow`.`STREAM_ID_CRC32`="' . crc32($primary_id) . '") OR 
                    (`comm_stream_flow`.`FEEDER_STREAM_ID`="' . self::$mysqli->real_escape_string($primary_id) . '" AND 
                    `comm_stream_flow`.`FEEDER_STREAM_ID_CRC32`="' . crc32($primary_id) . '") AND
                    `comm_stream`.`ISACTIVE`="1" ORDER BY `comm_stream`.`DATECREATED` ASC
                    ;';


                    $tmp_SQL_ARRAY[0]['SQL'] = $tmp_query;
                    $tmp_SQL_ARRAY[0]['FIELDCNT'] = 19;

                    if(isset($secondary_id)){
                        $tmp_query = 'SELECT `comm_stream`.`STREAM_ID`,
                        `comm_stream`.`STREAM_TYPE`,
                        `comm_stream`.`CLIENT_ID`,
                        `comm_stream`.`USER_ID`,
                        `comm_stream`.`ISACTIVE`,
                        `comm_stream`.`KIVOTOS_ID`,
                        `comm_stream`.`ASSET_ID`,
                        `comm_stream`.`STREAM_CONTENT`,
                        `comm_stream`.`STREAM_FORMATTED`,
                        `comm_stream`.`FEEDER_STREAM_COUNT`,
                        `comm_stream`.`I_FEED_STREAM_ID`,
                        `comm_stream`.`ATTACHED_ASSET_ID`,
                        `comm_stream`.`ISMODIFIED`,
                        `comm_stream`.`DATEMODIFIED`,
                        `comm_stream`.`DATECREATED`,
                        `comm_stream_flow`.`FLOW_ID`,
                        `comm_stream_flow`.`CLIENT_ID` AS `CLIENT_ID_FLOW`,
                        `comm_stream_flow`.`STREAM_ID` AS `STREAM_ID_FLOW`,
                        `comm_stream_flow`.`FEEDER_STREAM_ID` FROM `comm_stream` LEFT OUTER JOIN `comm_stream_flow` ON `comm_stream`.`STREAM_ID` = `comm_stream_flow`.`FEEDER_STREAM_ID` WHERE 
                        (`comm_stream_flow`.`STREAM_ID`="' . self::$mysqli->real_escape_string($primary_id) . '" AND 
                        `comm_stream_flow`.`STREAM_ID_CRC32`="' . crc32($primary_id) . '") OR 
                        (`comm_stream_flow`.`FEEDER_STREAM_ID`="' . self::$mysqli->real_escape_string($primary_id) . '" AND 
                        `comm_stream_flow`.`FEEDER_STREAM_ID_CRC32`="' . crc32($primary_id) . '") AND
                        `comm_stream`.`ISACTIVE`="1" ORDER BY `comm_stream`.`DATECREATED` ASC
                        ;';




                        $tmp_SQL_ARRAY[1]['SQL'] = $tmp_query;
                        $tmp_SQL_ARRAY[1]['FIELDCNT'] = 19;

                    }



                break;
                case 'KIVOTOS':
                    #$primary_id='KIVOTOS_ID', $secondary_id=NULL
                    $tmp_query = '';

                break;
                case 'RECENT':
                    #$primary_id='ELEMENT TYPE', $secondary_id=ELEMENT_ID
                    $tmp_query = '';

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unable to determine return_sys_notice_SQL key ['.$key.'].');

                break;
            }

            return $tmp_SQL_ARRAY;



        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('database_integration->return_sys_notice_SQL()', LOG_EMERG, $e->getMessage());

            return false;
        }

    }

	public function construct_response_manager($oEnv){
        self::$oDB_RESP = new database_response_manager($oEnv, $this);
        //error_log("database (1466) construct_response_manager() called for a new oDB_RESP.");
    }

    public function convert_scroll_to_SQL($scroll_data){

	    /*
	     *  $tmp_scroll_array['QUERY_TYPE'] = $queryType;
            $tmp_scroll_array['STREAM_TYPE'] = self::$oUser->retrieve_Form_Data("STREAM_TYPE");
            $tmp_scroll_array['CLIENT_ID'] = self::$oUser->retrieve_Form_Data("CLIENT_ID");
            $tmp_scroll_array['USERID_MENTION'] = $mention_id;
            $tmp_scroll_array['USERID_SUBMITTER'] = self::$oEnv->oSESSION_MGR->getSessionParam('USERID');
            $tmp_scroll_array['KIVOTOS_ID'] = self::$oUser->retrieve_Form_Data("KIVOTOS_ID");
            $tmp_scroll_array['STREAM_ID'] = self::$oUser->retrieve_Form_Data("STREAM_ID");
            $tmp_scroll_array['I_FEED_STREAM_ID']
	     * */

        try{

            $tmp_query = '';
            $ts = date("Y-m-d H:i:s", time());

            $tmp_loop_size = sizeof($scroll_data);
            for($i=0; $i<$tmp_loop_size; $i++){

                switch($scroll_data[$i]['QUERY_TYPE']){
                    case 'create_stream':
                        /*
                        $tmp_scroll_array['QUERY_TYPE'] = $queryType;
                        $tmp_scroll_array['STREAM_TYPE'] = self::$oUser->retrieve_Form_Data("STREAM_TYPE");
                        $tmp_scroll_array['CLIENT_ID'] = self::$oUser->retrieve_Form_Data("CLIENT_ID");
                        $tmp_scroll_array['USERID_MENTION'] = $mention_id;
                        $tmp_scroll_array['USERID_SUBMITTER'] = self::$oEnv->oSESSION_MGR->getSessionParam('USERID');
                        $tmp_scroll_array['KIVOTOS_ID'] = self::$oUser->retrieve_Form_Data("KIVOTOS_ID");
                        $tmp_scroll_array['STREAM_ID'] = self::$oUser->retrieve_Form_Data("STREAM_ID");
                         */

                        switch($scroll_data[$i]['STREAM_TYPE']){
                            case 'KIVOTOS':
                                $tmp_query .= 'INSERT INTO `sys_notification`
                                    (`QUERY_TYPE`,
                                     `CLIENT_ID`,
                                    `USERID_SUBMITTER`,
                                    `USERID_MENTION`,
                                    `STREAM_ID`,
                                    `STREAM_TYPE`,
                                    `KIVOTOS_ID`,
                                    `DATEMODIFIED`)
                                    VALUES
                                    (
                                    "'.self::$mysqli->real_escape_string($scroll_data[$i]['QUERY_TYPE']).'",
                                    "'.self::$mysqli->real_escape_string($scroll_data[$i]['CLIENT_ID']).'",
                                    "'.self::$mysqli->real_escape_string($scroll_data[$i]['USERID_SUBMITTER']).'",
                                    "'.self::$mysqli->real_escape_string($scroll_data[$i]['USERID_MENTION']).'",
                                    "'.self::$mysqli->real_escape_string($scroll_data[$i]['STREAM_ID']).'",
                                    "'.self::$mysqli->real_escape_string($scroll_data[$i]['STREAM_TYPE']).'",
                                    "'.self::$mysqli->real_escape_string($scroll_data[$i]['KIVOTOS_ID']).'",
                                    "'.$ts.'");
                                    ';

                            break;
                            case 'ASSET':
                                $tmp_query .= 'INSERT INTO `sys_notification`
                                (`QUERY_TYPE`,
                                 `CLIENT_ID`,
                                `USERID_SUBMITTER`,
                                `USERID_MENTION`,
                                `STREAM_ID`,
                                `STREAM_TYPE`,
                                `ASSET_ID`,
                                `DATEMODIFIED`)
                                VALUES
                                ("'.self::$mysqli->real_escape_string($scroll_data[$i]['QUERY_TYPE']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['CLIENT_ID']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['USERID_SUBMITTER']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['USERID_MENTION']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['STREAM_ID']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['STREAM_TYPE']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['ASSET_ID']).'",
                                "'.$ts.'");
                                ';

                            break;
                            case 'USER':

                                /*
                                 * $tmp_scroll_array['QUERY_TYPE'] = $queryType;
                            $tmp_scroll_array['STREAM_TYPE'] = self::$oUser->retrieve_Form_Data("STREAM_TYPE");
                            $tmp_scroll_array['USERID_MENTION'] = $mention_id;
                            $tmp_scroll_array['USERID_SUBMITTER'] = self::$oEnv->oSESSION_MGR->getSessionParam('USERID');
                            $tmp_scroll_array['USERID_DASHBOARD'] = self::$oUser->retrieve_Form_Data("USERID_DASHBOARD");
                            $tmp_scroll_array['STREAM_ID'] = self::$oUser->retrieve_Form_Data("STREAM_ID");
                                 * */

                                $tmp_query .= 'INSERT INTO `sys_notification`
                                (`QUERY_TYPE`,
                                `USERID_SUBMITTER`,
                                `USERID_MENTION`,
                                `USERID_DASHBOARD`,
                                `STREAM_ID`,
                                `STREAM_TYPE`,
                                `DATEMODIFIED`)
                                VALUES
                                ("'.self::$mysqli->real_escape_string($scroll_data[$i]['QUERY_TYPE']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['USERID_SUBMITTER']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['USERID_MENTION']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['USERID_DASHBOARD']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['STREAM_ID']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['STREAM_TYPE']).'",
                                "'.$ts.'");
                                ';

                            break;
                            case 'CLIENT':
                                # MENTIONS - STREAM_TYPE = CLIENT
                                /*
                                 * STREAM_ID self::$oUser->retrieve_Form_Data("STREAM_ID")
                                 * CLIENT_ID (of client dashboard)
                                 * USERID_SUBMITTER
                                 * USERID_MENTION
                                 * */

                                $tmp_query .= 'INSERT INTO `sys_notification`
                                (`QUERY_TYPE`,
                                 `CLIENT_ID`,
                                `USERID_SUBMITTER`,
                                `USERID_MENTION`,
                                `CLIENT_ID_DASHBOARD`,
                                `STREAM_ID`,
                                `STREAM_TYPE`,
                                `DATEMODIFIED`)
                                VALUES
                                ("'.self::$mysqli->real_escape_string($scroll_data[$i]['QUERY_TYPE']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['CLIENT_ID_DASHBOARD']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['USERID_SUBMITTER']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['USERID_MENTION']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['CLIENT_ID_DASHBOARD']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['STREAM_ID']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['STREAM_TYPE']).'",
                                "'.$ts.'");
                                ';

                            break;
                        }


                    break;
                    case 'create_stream_reply':
                        /*
                        $tmp_scroll_array['QUERY_TYPE'] = $queryType;
                        $tmp_scroll_array['STREAM_TYPE'] = self::$oUser->retrieve_Form_Data("STREAM_TYPE");
                        $tmp_scroll_array['CLIENT_ID'] = self::$oUser->retrieve_Form_Data("CLIENT_ID");
                        $tmp_scroll_array['USERID_MENTION'] = $mention_id;
                        $tmp_scroll_array['USERID_SUBMITTER'] = self::$oEnv->oSESSION_MGR->getSessionParam('USERID');
                        $tmp_scroll_array['KIVOTOS_ID'] = self::$oUser->retrieve_Form_Data("KIVOTOS_ID");
                        $tmp_scroll_array['STREAM_ID'] = self::$oUser->retrieve_Form_Data("STREAM_ID");
                        $tmp_scroll_array['I_FEED_STREAM_ID']
                         * */

                        switch($scroll_data[$i]['STREAM_TYPE']){
                            case 'KIVOTOS':
                                $tmp_query .= 'INSERT INTO `sys_notification`
                                    (`QUERY_TYPE`,
                                     `CLIENT_ID`,
                                    `USERID_SUBMITTER`,
                                    `USERID_MENTION`,
                                    `STREAM_ID`,
                                    `STREAM_TYPE`,
                                    `I_FEED_STREAM_ID`,
                                    `KIVOTOS_ID`,
                                    `DATEMODIFIED`)
                                    VALUES
                                    ("'.self::$mysqli->real_escape_string($scroll_data[$i]['QUERY_TYPE']).'",
                                    "'.self::$mysqli->real_escape_string($scroll_data[$i]['CLIENT_ID']).'",
                                    "'.self::$mysqli->real_escape_string($scroll_data[$i]['USERID_SUBMITTER']).'",
                                    "'.self::$mysqli->real_escape_string($scroll_data[$i]['USERID_MENTION']).'",
                                    "'.self::$mysqli->real_escape_string($scroll_data[$i]['STREAM_ID']).'",
                                    "'.self::$mysqli->real_escape_string($scroll_data[$i]['STREAM_TYPE']).'",
                                    "'.self::$mysqli->real_escape_string($scroll_data[$i]['I_FEED_STREAM_ID']).'",
                                    "'.self::$mysqli->real_escape_string($scroll_data[$i]['KIVOTOS_ID']).'",
                                    "'.$ts.'");
                                    ';

                                break;
                            case 'ASSET':
                                $tmp_query .= 'INSERT INTO `sys_notification`
                                (`QUERY_TYPE`,
                                 `CLIENT_ID`,
                                `USERID_SUBMITTER`,
                                `USERID_MENTION`,
                                `STREAM_ID`,
                                `STREAM_TYPE`,  
                                `I_FEED_STREAM_ID`,
                                `ASSET_ID`,
                                `DATEMODIFIED`)
                                VALUES
                                ("'.self::$mysqli->real_escape_string($scroll_data[$i]['QUERY_TYPE']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['CLIENT_ID']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['USERID_SUBMITTER']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['USERID_MENTION']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['STREAM_ID']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['STREAM_TYPE']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['I_FEED_STREAM_ID']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['ASSET_ID']).'",
                                "'.$ts.'");
                                ';

                                break;
                            case 'USER':

                                /*
                                 * $tmp_scroll_array['QUERY_TYPE'] = $queryType;
                            $tmp_scroll_array['STREAM_TYPE'] = self::$oUser->retrieve_Form_Data("STREAM_TYPE");
                            $tmp_scroll_array['USERID_MENTION'] = $mention_id;
                            $tmp_scroll_array['USERID_SUBMITTER'] = self::$oEnv->oSESSION_MGR->getSessionParam('USERID');
                            $tmp_scroll_array['USERID_DASHBOARD'] = self::$oUser->retrieve_Form_Data("USERID_DASHBOARD");
                            $tmp_scroll_array['STREAM_ID'] = self::$oUser->retrieve_Form_Data("STREAM_ID");
                                 * */

                                $tmp_query .= 'INSERT INTO `sys_notification`
                                (`QUERY_TYPE`,
                                 `USERID_SUBMITTER`,
                                `USERID_MENTION`,
                                `USERID_DASHBOARD`,
                                `STREAM_ID`,
                                `STREAM_TYPE`,
                                `I_FEED_STREAM_ID`,
                                `DATEMODIFIED`)
                                VALUES
                                ("'.self::$mysqli->real_escape_string($scroll_data[$i]['QUERY_TYPE']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['USERID_SUBMITTER']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['USERID_MENTION']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['USERID_DASHBOARD']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['STREAM_ID']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['STREAM_TYPE']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['I_FEED_STREAM_ID']).'",
                                "'.$ts.'");
                                ';

                                break;
                            case 'CLIENT':
                                # MENTIONS - STREAM_TYPE = CLIENT
                                /*
                                 * STREAM_ID self::$oUser->retrieve_Form_Data("STREAM_ID")
                                 * CLIENT_ID (of client dashboard)
                                 * USERID_SUBMITTER
                                 * USERID_MENTION
                                 * */

                                $tmp_query .= 'INSERT INTO `sys_notification`
                                (`QUERY_TYPE`,
                                 `CLIENT_ID`,
                                `USERID_SUBMITTER`,
                                `USERID_MENTION`,
                                `CLIENT_ID_DASHBOARD`,
                                `STREAM_ID`,
                                `STREAM_TYPE`,
                                `I_FEED_STREAM_ID`,
                                `DATEMODIFIED`)
                                VALUES
                                ("'.self::$mysqli->real_escape_string($scroll_data[$i]['QUERY_TYPE']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['CLIENT_ID_DASHBOARD']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['USERID_SUBMITTER']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['USERID_MENTION']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['CLIENT_ID_DASHBOARD']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['STREAM_ID']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['STREAM_TYPE']).'",
                                "'.self::$mysqli->real_escape_string($scroll_data[$i]['I_FEED_STREAM_ID']).'",
                                "'.$ts.'");
                                ';

                                break;
                        }

                    break;
                    case 'create_child_kivotos':

                        /*
                         *
                        $tmp_scroll_array['QUERY_TYPE'] = $queryType;
                        $tmp_scroll_array['CLIENT_ID'] = self::$oUser->retrieve_Form_Data("CLIENT_ID");
                        $tmp_scroll_array['KIVOTOS_ID'] = self::$oUser->retrieve_Form_Data("KIVOTOS_ID");
                        $tmp_scroll_array['P_KIVOTOS_ID'] = self::$oUser->retrieve_Form_Data("P_KIVOTOS_ID");
                        $tmp_scroll_array['USERID_MENTION'] = $mention_id;
                        $tmp_scroll_array['USERID_SUBMITTER']
                         * */

                        $tmp_query .= 'INSERT INTO `sys_notification`
                        (`QUERY_TYPE`,
                         `CLIENT_ID`,
                        `USERID_SUBMITTER`,
                        `USERID_MENTION`,
                        `KIVOTOS_ID`,
                        `P_KIVOTOS_ID`,
                        `DATEMODIFIED`)
                        VALUES
                        ("'.self::$mysqli->real_escape_string($scroll_data[$i]['QUERY_TYPE']).'",
                        "'.self::$mysqli->real_escape_string($scroll_data[$i]['CLIENT_ID']).'",
                        "'.self::$mysqli->real_escape_string($scroll_data[$i]['USERID_SUBMITTER']).'",
                        "'.self::$mysqli->real_escape_string($scroll_data[$i]['USERID_MENTION']).'",
                        "'.self::$mysqli->real_escape_string($scroll_data[$i]['KIVOTOS_ID']).'",
                        "'.self::$mysqli->real_escape_string($scroll_data[$i]['P_KIVOTOS_ID']).'",
                        "'.$ts.'");
                        ';


                    break;
                    case 'create_kivotos':

                        $tmp_query .= 'INSERT INTO `sys_notification`
                        (`QUERY_TYPE`,
                         `CLIENT_ID`,
                        `USERID_SUBMITTER`,
                        `USERID_MENTION`,
                        `KIVOTOS_ID`,
                        `DATEMODIFIED`)
                        VALUES
                        ("'.self::$mysqli->real_escape_string($scroll_data[$i]['QUERY_TYPE']).'",
                        "'.self::$mysqli->real_escape_string($scroll_data[$i]['CLIENT_ID']).'",
                        "'.self::$mysqli->real_escape_string($scroll_data[$i]['USERID_SUBMITTER']).'",
                        "'.self::$mysqli->real_escape_string($scroll_data[$i]['USERID_MENTION']).'",
                        "'.self::$mysqli->real_escape_string($scroll_data[$i]['KIVOTOS_ID']).'",
                        "'.$ts.'");
                        ';

                    break;
                    case 'save_asset_update':
                    case 'save_asset_content':
                        /*
                        $tmp_scroll_array['QUERY_TYPE'] = $queryType;
                        $tmp_scroll_array['ASSET_TYPE'] = self::$oUser->retrieve_Form_Data("ASSET_TYPE");
                        $tmp_scroll_array['SPECIALTY_TYPE'] = self::$oUser->retrieve_Form_Data("SPECIALTY_TYPE");
                        $tmp_scroll_array['CLIENT_ID'] = self::$oUser->retrieve_Form_Data("CLIENT_ID");
                        $tmp_scroll_array['KIVOTOS_ID'] = self::$oUser->retrieve_Form_Data("KIVOTOS_ID");
                        $tmp_scroll_array['STREAM_ID'] = self::$oUser->retrieve_Form_Data("STREAM_ID");
                        $tmp_scroll_array['USERID_MENTION'] = $mention_id;
                        $tmp_scroll_array['USERID_SUBMITTER']
                        ASSET_ID
                         * */

                        $tmp_query .= 'INSERT INTO `sys_notification`
                        (`QUERY_TYPE`,
                        `USERID_SUBMITTER`,
                        `USERID_MENTION`,
                        `CLIENT_ID`,
                        `STREAM_ID`,
                        `STREAM_TYPE`,
                        `KIVOTOS_ID`,
                        `ASSET_ID`,
                        `ASSET_TYPE_KEY`,
                        `SPECIALTY_TYPE_KEY`,
                        `DATEMODIFIED`)
                        VALUES
                        (
                        "'.self::$mysqli->real_escape_string($scroll_data[$i]['QUERY_TYPE']).'",
                        "'.self::$mysqli->real_escape_string($scroll_data[$i]['USERID_SUBMITTER']).'",
                        "'.self::$mysqli->real_escape_string($scroll_data[$i]['USERID_MENTION']).'",
                        "'.self::$mysqli->real_escape_string($scroll_data[$i]['CLIENT_ID']).'",
                        "'.self::$mysqli->real_escape_string($scroll_data[$i]['STREAM_ID']).'",
                        "'.self::$mysqli->real_escape_string($scroll_data[$i]['SPECIALTY_TYPE']).'",
                        "'.self::$mysqli->real_escape_string($scroll_data[$i]['KIVOTOS_ID']).'",
                        "'.self::$mysqli->real_escape_string($scroll_data[$i]['ASSET_ID']).'",
                        "'.self::$mysqli->real_escape_string($scroll_data[$i]['ASSET_TYPE']).'",
                        "'.self::$mysqli->real_escape_string($scroll_data[$i]['SPECIALTY_TYPE']).'",
                        "'.$ts.'");
                        ';

                    break;

                }

            }

            return $tmp_query;


        }catch( Exception $e ) {
            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('database_integration->convert_scroll_to_SQL()', LOG_EMERG, $e->getMessage());

            return false;
        }

    }

    public function injest_scroll($oScroll, $oUserEnvironment){

	    try{

            //
            // WHAT HAPPENS HERE WILL BE DETERMINED BY HOW SQL IS STORED WITHIN oSCROLL
            self::$query = $oScroll->unroll_scroll('SQL');

            self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

            if(self::$mysqli->error){
                self::$query_exception_result = "injest_scroll() Error :: ".self::$mysqli->error;
                throw new Exception('eVifweb database_integration :: injest_scroll() ERROR :: ['.self::$mysqli->error.']');

            }else{

                return 'success';

            }


        }catch( Exception $e ) {
            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('database_integration->injest_scroll()', LOG_EMERG, $e->getMessage());

            return false;
        }

    }

    private function process_mentions($input_content, $oUser, $oUserEnvironment, $oDB_RESP, $oInputTransformer, $eid, $queryType){

        $oSTREAM_MGR = new stream_manager($oUserEnvironment, $oUser);

        // INTERNALIZE CONTENT DATA PROFILE
        //error_log("database (1520) process_mention_input() [".$eid."]");
        $oSTREAM_MGR->process_mention_input($input_content, $eid);
        //error_log("database (1522) process_mention_input() complete. Count=[".$oSTREAM_MGR->return_mention_count()."]");

        //
        // IS THERE ANYTHING ELSE (TAGS, SYMBOLS, EXPRESSIONS, @MENTIONS[DONE]) WHICH COULD BE CONTAINED IN A STREAM AND PROCESSED?
        # LINKS (SHOULD WE PROXY? I THINK SO)
        # FROM ASSET PREVIEW PAGE...STREAM INSERT OF ASSET LINK?..WELL, IF SOMEONE WAS @MENTIONED IN A STREAM
        # AND RECEIVED AN EMAIL NOTICE, THE ASSET LINK WOULD BE IN THE EMAIL

        //
        // THIS WILL SUPPORT MANUAL @MENTION ENTRY BY USER.
        $tmp_loop_size = $oSTREAM_MGR->return_mention_count();
        $db_resp_profile_field_cnt = '';
        $tmp_mention_query = "";
        if($tmp_loop_size>0) {
            for ($i = 0; $i < $tmp_loop_size; $i++) {

                $tmp_SELECT_ARRAY[$i] = '`comm_stream_mention`.`STREAM_MENTION`,
                                `comm_stream_mention`.`USER_ID`,
                                `comm_stream_mention`.`ISACTIVE`,
                                `comm_stream_mention`.`DATEMODIFIED`,
                                `comm_stream_mention`.`DATECREATED`';

                //
                // LET'S BUILD THE QUERY FOR EXTRACTING USER DATA BASED ON @MENTION.
                // THIS NEEDS TO BE FAST. SO WILL NEED TO SETUP/MANAGE USER LOOKUP TABLE FOR MENTION DATA.
                $tmp_mention_query .= 'SELECT ' . $tmp_SELECT_ARRAY[$i] . ' FROM `comm_stream_mention` WHERE 
                            `comm_stream_mention`.`STREAM_MENTION`="' . strtolower($oSTREAM_MGR->return_mention_data($i)) . '" AND 
                            `comm_stream_mention`.`STREAM_MENTION_CRC32`="' . crc32(strtolower($oSTREAM_MGR->return_mention_data($i))) . '" AND 
                            `comm_stream_mention`.`ISACTIVE`="1";';

                if ($db_resp_profile_field_cnt == "") {
                    $db_resp_target_profiles = 'COMM_STREAM_MENTION_' . $i;
                    $db_resp_profile_field_cnt = '5';
                } else {
                    $db_resp_target_profiles .= '|COMM_STREAM_MENTION_' . $i;
                    $db_resp_profile_field_cnt .= '|5';

                }

            }

            //
            // WE HAVE LOOKUP QUERY. WE SHOULD PROCESS OOP. THIS IS A SELECT WITH RESULT RETURN.
            $force_profile_select_align = true;
            $db_resp_process_serial = "yes_jesus_is_lord!";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
            $db_resp_serial_key = 'COMM_STREAM';

            $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt, $force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

            $oDB_RESP->process(self::$mysqli,$queryType,$tmp_SELECT_ARRAY,$tmp_mention_query);

            //
            // DB RESPONSE OBJ IS LOADED. NOW WE CAN BUILD THE SQL FOR MANAGING @MENTION NOTIFICATIONS
            // NOW WE NEED TO GET USER PROFILE @MENTION HANDLE INTO THE DATABASE. WILL UPDATE THE USER PROFILE PAGE TO PERFORM THIS DATA MANIPULATION
            $tmp_profile_array = explode("|", $db_resp_target_profiles);
            #$tmp_loop_size_ARRAY = $oDB_RESP->return_sizeof($db_resp_process_serial, $tmp_profile_array[$i]);
            #error_log("database (1199) running return_sizeof with tmp_profile_array->".$tmp_profile_array[0]);

            # WHERE $tmp_loop_size_ARRAY[x] = # results returned by profile_x
            // THIS COUNT REPRESENTS THE @MENTIONS ACTUALLY ENTERED INTO THE STREAM TEXTAREA AND COORELATES TO $oSTREAM_MGR->return_mention_data($i)

            $tmp_loop_1_size = sizeof($tmp_profile_array);
            for ($i = 0; $i < $tmp_loop_1_size; $i++) {
                $tmp_resp_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial(), $tmp_profile_array[$i]);
                $tmp_mention_check = true;

                if($tmp_resp_size>0) {

                    $tmp_loop_size = $oDB_RESP->return_sizeof($db_resp_process_serial, $tmp_profile_array[$i]);
                    for ($ii = 0; $ii < $tmp_loop_size; $ii++) {

                        if ($oSTREAM_MGR->mention_accounted($oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'USER_ID', $ii))) {
                            $tmp_mention_check = false;
                            #error_log("database (2235) mention_accounted for USER_ID[" . $oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'USER_ID', $ii) . "] STREAM_MENTION[" . $i . "]->" . $oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'STREAM_MENTION', $ii));
                            #error_log("database (2236) hyper link @mention[".$oSTREAM_MGR->return_mention_case($oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'STREAM_MENTION', $ii))."] to user_id[".$oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'USER_ID', $ii)."]");
                            $oInputTransformer->queueMentionForTransform($oSTREAM_MGR->return_mention_case($oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'STREAM_MENTION', $ii)),$oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'USER_ID', $ii));
                        }
                    }
                }

                //
                // IF WE HAVE AN @MENTION, BUT NO DATABASE MATCH...
                if($tmp_mention_check){

                    //
                    // WE HAVE AN @MENTION THAT WAS MANUALLY ENTERED (OR TYPO'D). TRY TO PROCESS MANUALLY...JUST THE SAME.
                    // THIS MENTION PROCESSING SHOULD HAPPEN BEFORE STREAM_CONTENT_STYLED IS PREPPED FOR DATABASE INSERTION
                    // LETS SEE IF THIS FIRES. WE WILL NOT HOOK ANYTHING UP HERE YET. BUT PLAN TO ALLOW FOR USER TO MANUALLY ENTER @MENTION FOR PROCESSING
                    // WE ARE READY TO HOOK UP BEST EFFORT MANUAL PROCESSING. THIS WILL MOST LIKELY CHECK MAYBE FIRST 5 CHARS OF @MENTION AGAINST ANY EID HIDDEN IN THE FORM...TO TRY TO GET USER_ID.
                    #error_log("database (1684) we have custom entered @mention to process STREAM_MENTION[".$oSTREAM_MGR->return_mention_data($i)."] STREAM_MENTION[".$i."]");
                    //error_log("database (1612) we need to try to hyperlink mention[".$oSTREAM_MGR->return_mention_data($i)."]");

                    $tmp_mention_array = $this->find_mention_userid($oUserEnvironment, $oSTREAM_MGR->return_mention_data($i));

                    if($tmp_mention_array[0][0]!=""){
                        //error_log("database (1617) queue custom mention ".$tmp_mention_array[0][1]);
                        $oInputTransformer->queueMentionForTransform($tmp_mention_array[0][1], $tmp_mention_array[0][0]);

                    }

                }

            }

        }

        //
        // APPLY FORMATTING TO STREAM CONTENT. THIS WOULD NEED TO HAPPEN ALSO FOR ANY DESCRIPTIONS SENT TO EXTRANET
        // $input_content = $tmp_content_format_ARRAY['STYLED_CONTENT'];  // GET LINKED CONTENT (PROXY AND INTERNAL)
        #$input_content = $oInputTransformer->transform_mentions($input_content);
        $oInputTransformer->transform_mentions_internal($input_content);

        #return $input_content;
        return $oInputTransformer;

    }

    private function find_mention_userid($oUserEnvironment, $mention){
	    $mention = strtolower($mention);

        $tmp_query = 'SELECT `users`.`USERID`,`users`.`STREAM_MENTION` FROM `users` WHERE LOWER(`STREAM_MENTION`) = "'.$mention.'" LIMIT 1;';

        self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, $tmp_query);

        //
        // CLEAR RESULT ARRAY
        array_splice(self::$result_ARRAY, 0);
        self::$result_ARRAY[0][0] = "";

        if(self::$mysqli->error){
            self::$query_exception_result = "error";
            throw new Exception('eVifweb database_integration :: find_mention_userid() ERROR :: ['.self::$mysqli->error.']');

        }else{

            //
            // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
            $ROWCNT=0;
            while ($row = self::$result->fetch_row()) {
                foreach($row as $fieldPos=>$value){
                    //
                    // STORE RESULT
                    //error_log("evifweb /database.inc.php (823) rowcnt[".$ROWCNT."] fieldPos[".$fieldPos."] value [".$value."]");
                    self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;

                }
                $ROWCNT++;
            }
            self::$result->free();

        }

        return self::$result_ARRAY;

    }

    private function recursive_process_allow($elem_id){

	    foreach($this->recursive_target_id_omit_flag as $key0=>$val0){

	        if(is_array($val0)){
                foreach($val0 as $key1=>$val1){

                    if(is_array($val1)){

                        error_log("database (1520) recursive_process_allow () method needs to be expanded. die()");
                        die();
                    }else{
                        if($val1==$elem_id){

                            return false;
                        }

                    }

                }

            }else{

	            if($val0==$elem_id){

	                return false;
                }
            }

        }

        //error_log("(1542) **** recursive_process_allow OK TO USE ID ".$elem_id);
        return true;

    }

    # recursive_extract('get_stream_deep_data', $tmp_stream_id_PIPE, $oStream_MGR, $oDB_RESP, 'DEEP_STREAM_DATA')
    private function recursive_extract($queryType, $tmp_target_id, $oStream_MGR, $oDB_RESP, $oUser, $pull_parent=true){

	    switch($queryType){
            case 'get_stream_deep_data':

                //
                // IMAGINE WE ARE PASSING THROUGH THIS FOR THE SECOND TIME...PARENTS...

                $tmp_recursive_profile_serial = $oUser->generateNewKey(5);
                $tmp_SELECT_ARRAY = array();
                $db_resp_target_profiles_ARRAY = array();

                if(!is_array($tmp_target_id)){
                    $tmp_target_id_ARRAY = explode("|", $tmp_target_id);

                }else{
                    $tmp_target_id_ARRAY = $tmp_target_id;

                }

                $this->recursive_target_id_omit_flag[] = $tmp_target_id_ARRAY;

                $tmp_loop_size = sizeof($tmp_target_id_ARRAY);
                if($tmp_loop_size>0) {
                    for ($i = 0; $i < $tmp_loop_size; $i++) {

                        $tmp_SELECT_ARRAY[$i] = 'SELECT `comm_stream`.`STREAM_ID`,
                        `comm_stream`.`STREAM_TYPE`,
                        `comm_stream`.`CLIENT_ID`,
                        `comm_stream`.`USER_ID`,
                        `comm_stream`.`ISACTIVE`,
                        `comm_stream`.`KIVOTOS_ID`,
                        `comm_stream`.`ASSET_ID`,
                        `comm_stream`.`STREAM_CONTENT`,
                        `comm_stream`.`STREAM_FORMATTED`,
                        `comm_stream`.`FEEDER_STREAM_COUNT`,
                        `comm_stream`.`I_FEED_STREAM_ID`,
                        `comm_stream`.`ATTACHED_ASSET_ID`,
                        `comm_stream`.`ISMODIFIED`,
                        `comm_stream`.`DATEMODIFIED`,
                        `comm_stream`.`DATECREATED`,
                        `comm_stream_flow`.`FLOW_ID`,
                        `comm_stream_flow`.`CLIENT_ID` AS `CLIENT_ID_FLOW`,
                        `comm_stream_flow`.`STREAM_ID` AS `STREAM_ID_FLOW`,
                        `comm_stream_flow`.`FEEDER_STREAM_ID` FROM `comm_stream` LEFT OUTER JOIN `comm_stream_flow` ON `comm_stream`.`STREAM_ID` = `comm_stream_flow`.`FEEDER_STREAM_ID` WHERE 
                        (`comm_stream_flow`.`STREAM_ID`="' . self::$mysqli->real_escape_string($tmp_target_id_ARRAY[$i]) . '" AND 
                        `comm_stream_flow`.`STREAM_ID_CRC32`="' . crc32($tmp_target_id_ARRAY[$i]) . '") OR 
                        (`comm_stream_flow`.`FEEDER_STREAM_ID`="' . self::$mysqli->real_escape_string($tmp_target_id_ARRAY[$i]) . '" AND 
                        `comm_stream_flow`.`FEEDER_STREAM_ID_CRC32`="' . crc32($tmp_target_id_ARRAY[$i]) . '") AND
                        `comm_stream`.`ISACTIVE`="1" ORDER BY `comm_stream`.`DATECREATED` ASC
                        ;';

                        if (!isset($db_resp_target_profiles)) {
                            $db_resp_target_profiles = 'COMM_STREAM_'.$tmp_recursive_profile_serial.'_' . $i;
                            $db_resp_profile_field_cnt = '19';
                            $db_resp_target_profiles_ARRAY[] = $db_resp_target_profiles;
                            $oDB_RESP->recursive_pipe_build($queryType, 'PROFILE', $db_resp_target_profiles);

                        } else {
                            $db_resp_target_profiles .= '|COMM_STREAM_'.$tmp_recursive_profile_serial.'_' . $i;
                            $db_resp_profile_field_cnt .= '|19';
                            $db_resp_target_profiles_ARRAY[] = 'COMM_STREAM_'.$tmp_recursive_profile_serial.'_' . $i;
                            $oDB_RESP->recursive_pipe_build($queryType, 'PROFILE', 'COMM_STREAM_'.$tmp_recursive_profile_serial.'_' . $i);

                        }

                    }

                    //
                    // I WOULD IMAGINE THAT EACH RECURSIVE HIT NEEDS TO ESTABLISH IT'S OWN UNIQUE SERIAL AND KEY FOR PROCESSING
                    $tmp_auto_serial = $oUser->generateNewKey(10);
                    $db_resp_process_serial = "jesus_christ_is_lord!!!" . $tmp_auto_serial;           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = 'STREAM_DATA_' . $tmp_auto_serial;
                    $oDB_RESP->recursive_pipe_build($queryType, 'SERIAL', $db_resp_serial_key);
                    $force_profile_select_align = true;
                    #error_log("database (910) initialize with serial[".$db_resp_process_serial."] profiles[".$db_resp_target_profiles."] fieldcnt[".$db_resp_profile_field_cnt."]");

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt, $force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // ALL OF THIS NEEDS TO BE BURIED DEEP IN SOME CLASS METHOD.
                    // SHOULD MAYBE BE LIKE...IT SHOULD WORK. LET'S ROLL IT OUT. MAYBE TEST REAL QUICK? AT LEAST TO SAY WE TRIED...  :)
                    $oDB_RESP->process(self::$mysqli, $queryType, $tmp_SELECT_ARRAY);

                    $tmp_result_size = array();
                    for ($i = 0; $i < $tmp_loop_size; $i++) {
                        $tmp_result_size[$i] = $oDB_RESP->return_sizeof($db_resp_process_serial, $db_resp_target_profiles_ARRAY[$i]);
                    }

                    //
                    // ORDER BY STREAM_ID SO THAT YOU CAN ACCESS I_FEED_xxx DATA
                    //$oDB_RESP->keyDataByID($db_resp_process_serial, $db_resp_target_profiles, 'STREAM_ID');
                    if ($pull_parent) {
                        $tmp_parent_order0_stream_id = array();

                        //
                        // NOW WE NEED TO CHECK FOR ANY PARENT STREAM AND PREPARE TO PULL THEIR DATA. IF NO PARENT STREAM...DRILL
                        // INTO ANY CHILDREN AND KEEP GOING UNTIL NO MORE CHILDREN RETURNED
                        //
                        // FOR EACH PRIMARY SELECT...
                        for ($i = 0; $i < $tmp_loop_size; $i++) {

                            //
                            // FOR THE NUMBER OF RESULTS RETURNED BY PRIMARY SELECT
                            for ($ii = 0; $ii < $tmp_result_size[$i]; $ii++) {

                                $tmp_id = $oDB_RESP->return_data_element($db_resp_process_serial, $db_resp_target_profiles_ARRAY[$i], 'I_FEED_STREAM_ID', $ii);

                                if ($tmp_id != "" && $this->recursive_process_allow($tmp_id)) {
                                    $tmp_parent_order0_stream_id[] = $tmp_id;
                                }
                            }

                            #$tmp_id = $oDB_RESP->retrieveDataByID($db_resp_process_serial, $db_resp_target_profiles_ARRAY[$i], $tmp_target_id_ARRAY[$i], 'I_FEED_STREAM_ID');
                            #error_log("database (1556) recursive check...Do I have a parent? [".$tmp_id."]");
                        }

                        //
                        // SO THIS IS FAILING IF THERE IS A PARENT....
                        if (sizeof($tmp_parent_order0_stream_id) > 0) {
                            $oDB_RESP = $this->recursive_extract('get_stream_deep_data', $tmp_parent_order0_stream_id, $oStream_MGR, $oDB_RESP, $oStream_MGR->return_oUser(), false);
                        }

                        //
                        // WE NOW HAVE ALL CHILD DATA FOR THE PARENT STREAM(S)

                    } else {

                        $tmp_feeder_id_ARRAY = array();

                        //
                        // FOR EACH PRIMARY SELECT...
                        for ($i = 0; $i < $tmp_loop_size; $i++) {

                            //
                            // FOR THE NUMBER OF RESULTS RETURNED BY PRIMARY SELECT
                            for ($ii = 0; $ii < $tmp_result_size[$i]; $ii++) {
                                $tmp_tgt_id = $oDB_RESP->return_data_element($db_resp_process_serial, $db_resp_target_profiles_ARRAY[$i], 'STREAM_ID', $ii);

                                //
                                // GET ID OF STREAM FOR WHICH TO CHECK FOR CHILDREN
                                if($this->recursive_process_allow($tmp_tgt_id)){
                                    if((int)$oDB_RESP->return_data_element($db_resp_process_serial, $db_resp_target_profiles_ARRAY[$i], 'FEEDER_STREAM_COUNT', $ii)>0){
                                        $tmp_feeder_id_ARRAY[] = $tmp_tgt_id;

                                    }

                                }

                            }
                        }

                        if(sizeof($tmp_feeder_id_ARRAY)>0){

                            $oDB_RESP = $this->recursive_extract('get_stream_deep_data', $tmp_feeder_id_ARRAY, $oStream_MGR, $oDB_RESP, $oStream_MGR->return_oUser(), false);

                        }

                    }
                }

                return $oDB_RESP;

            break;
            default:

            break;

        }
    }

    public function return_response_manager(){

	    return self::$oDB_RESP;
    }

	public function processRequest($queryType ,$oUser, $oUserEnvironment, $oDB_RESP=NULL){
	    //
        // WILL ALWAYS RETURN $oDB_RESP OBJECT. CHECK OBJECT FOR DATA OR ERROR.
        return $this->executeRequest($queryType, $oUser, $oUserEnvironment, $oDB_RESP);
    }
	
	public function processUserRequest($queryType ,$oUser, $oUserEnvironment, $oAssetMgr=NULL){
		return $this->executeQueryType($queryType, $oUser, $oUserEnvironment, $oAssetMgr);
	}

	public function processStreamRequest($queryType ,$oStream, $oUserEnvironment, $oDB_RESP){
        return $this->executeStreamRequest($queryType, $oStream, $oUserEnvironment, $oDB_RESP);
    }

    private function executeStreamRequest($queryType, $oStream_MGR, $oUserEnvironment, $oDB_RESP){
        try{
            //error_log('database.inc.php (213) evifweb queryType sent to user database_integrations class object :: '.$queryType.' from ['.$_SERVER['REMOTE_ADDR'].']');
            $ts = date("Y-m-d H:i:s", time());

            //
            // IF WE EVER NEED TO CONNECT TO MORE THAN 1 DATABASE IN A REQUEST....NEED TO WIRE IN MYSQLI CONN RESET BOOLEAN
            // FOR NOW, THE PERFORMANCE BOOST FROM MAINTAINING CONNECTION PERSIST IS WORTH IT. CAN ADD MULTI-DB SUPPORT LATER.
            // I WAS DOING SOME TESTING IN MY DOWNTIME TODAY AND ONE THING I CHECKED WAS THE NUMBER OF MYSQL DATABASE CONNECTIONS THAT WERE BEING CREATED
            // TO SUPPORT A "COMPLICATED" PAGE LOAD.

            // CHECK IT OUT. OUTPUT FROM PREVIOUS TEST...

            if(isset(self::$mysqli)){
                if (self::$mysqli->ping()) {
                    //error_log("database (955) mysqli->Our connection is ok!");  // HERE, WE RECYCLE SAME CONNECTION
                } else {
                    //error_log("database (957) mysqli->I will open a new connection now! ping()==FALSE");  // THIS OUTPUT HERE IS CONNECTION CREATION

                    //
                    // OPEN CONNECTION
                    self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->returnConnection();
                }
            }else{

                //error_log("database (963) mysqli->I will open a new connection now! ...mysqli not set"); // THIS OUTPUT HERE IS CONNECTION CREATION

                //
                // OPEN CONNECTION
                self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->returnConnection();
            }


            switch($queryType){
                case 'get_stream_deep_data':

                    $tmp_stream_id_PIPE = $oUserEnvironment->oHTTP_MGR->extractData($_GET, 'sid');

                    //
                    // USE THIS METHOD TO EXTRACT ALL CONNECTED STREAM DATA TAKING SYSTEM CONFIGURATION INTO CONSIDERATION. $tmp_stream_id_PIPE CAN BE ARRAY
                    $oDB_RESP = $this->recursive_extract('get_stream_deep_data', $tmp_stream_id_PIPE, $oStream_MGR, $oDB_RESP, $oStream_MGR->return_oUser());

                    $tmp_pipe_ARRAY = $oDB_RESP->return_serialkey_pipe_ARRAY('get_stream_deep_data');  #ARRAY() = {0=$serial_handle_pipe, 1=$target_key_pipe}

                    //
                    // I THINK WE SHOULD RUN A RESULT SET MERGE HERE
                    # ($serial_handle_pipe, $target_key_pipe, $sequence_field_pipe, $compare_type, $new_cumm_key)
                    $oDB_RESP->response_key_merge($tmp_pipe_ARRAY[0], $tmp_pipe_ARRAY[1], 'DATECREATED', 'DATETIME', 'DEEP_STREAM_DATA');

                    //
                    // ALL DONE, PROCESSED AND READY FOR USE. RETURN RESPONSE OBJECT.
                    //error_log("database (1629) returning oDB_RESP after parent processing...");
                    return $oDB_RESP;

                break;
                case 'get_stream_deep_data_OLD':
                    $db_resp_profile_field_cnt = NULL;
                    $db_resp_target_profiles = NULL;
                    $force_profile_select_align = true;

                    //
                    // QUERY CONSTRUCTION
                    $tmp_SELECT_ARRAY = array();
                    $tmp_stream_query = '';
                    $tmp_query_cnt = 0;

                    $tmp_stream_id = $oUserEnvironment->oHTTP_MGR->extractData($_GET, 'sid');

                    #$tmp_loop_size = sizeof($tmp_stream_lookup_id_ARRAY);
                    #for($i=0;$i<$tmp_loop_size;$i++){

                    $tmp_SELECT_ARRAY[0] = '`comm_stream`.`STREAM_ID`,
                    `comm_stream`.`STREAM_TYPE`,
                    `comm_stream`.`CLIENT_ID`,
                    `comm_stream`.`USER_ID`,
                    `comm_stream`.`ISACTIVE`,
                    `comm_stream`.`KIVOTOS_ID`,
                    `comm_stream`.`ASSET_ID`,
                    `comm_stream`.`STREAM_CONTENT`,
                    `comm_stream`.`STREAM_FORMATTED`,
                    `comm_stream`.`FEEDER_STREAM_COUNT`,
                    `comm_stream`.`I_FEED_STREAM_ID`,
                    `comm_stream`.`ATTACHED_ASSET_ID`,
                    `comm_stream`.`ISMODIFIED`,
                    `comm_stream`.`DATEMODIFIED`,
                    `comm_stream`.`DATECREATED`,
                    `comm_stream_flow`.`FLOW_ID`,
                    `comm_stream_flow`.`CLIENT_ID` AS `CLIENT_ID_FLOW`,
                    `comm_stream_flow`.`STREAM_ID` AS `STREAM_ID_FLOW`,
                    `comm_stream_flow`.`FEEDER_STREAM_ID`';

                   /*
                    $tmp_stream_query = 'SELECT ' . $tmp_SELECT_ARRAY[0] . ' FROM `comm_stream` LEFT OUTER JOIN `comm_stream_flow` ON `comm_stream`.`STREAM_ID` = `comm_stream_flow`.`FEEDER_STREAM_ID` WHERE
                    `comm_stream`.`STREAM_ID`="' .self::$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'sid')). '" AND
                    `comm_stream`.`STREAM_ID_CRC32`="' .crc32($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'sid')). '" AND
                    `comm_stream`.`ISACTIVE`="1" AND
                    `comm_stream`.`KIVOTOS_ID`="' . self::$mysqli->real_escape_string($tmp_stream_lookup_id_ARRAY[$i]) . '" AND
                    `comm_stream`.`KIVOTOS_ID_CRC32`="' . crc32($tmp_stream_lookup_id_ARRAY[$i]) . '" ORDER BY `comm_stream`.`DATECREATED` ASC
                    ;';
                    */

                    $tmp_stream_query = 'SELECT ' . $tmp_SELECT_ARRAY[0] . ' FROM `comm_stream` LEFT OUTER JOIN `comm_stream_flow` ON `comm_stream`.`STREAM_ID` = `comm_stream_flow`.`FEEDER_STREAM_ID` WHERE 
                    (`comm_stream_flow`.`STREAM_ID`="' .self::$mysqli->real_escape_string($tmp_stream_id). '" AND 
                    `comm_stream_flow`.`STREAM_ID_CRC32`="' .crc32($tmp_stream_id). '") OR 
                    (`comm_stream_flow`.`FEEDER_STREAM_ID`="' .self::$mysqli->real_escape_string($tmp_stream_id). '" AND 
                    `comm_stream_flow`.`FEEDER_STREAM_ID_CRC32`="' .crc32($tmp_stream_id). '") AND
                    `comm_stream`.`ISACTIVE`="1" ORDER BY `comm_stream`.`DATECREATED` ASC
                    ;';


                    $db_resp_target_profiles = 'COMM_STREAM';
                    $db_resp_profile_field_cnt = '19';

                    $db_resp_process_serial = "jesus_is_lord!!!";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = 'STREAM_DATA';
                    $lock_resp_profile = true;
                    #error_log("database (910) initialize with serial[".$db_resp_process_serial."] profiles[".$db_resp_target_profiles."] fieldcnt[".$db_resp_profile_field_cnt."]");

                    #error_log("database (1233) comm_stream query->".$tmp_stream_query);
                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt, $force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // ALL OF THIS NEEDS TO BE BURIED DEEP IN SOME CLASS METHOD.
                    // SHOULD MAYBE BE LIKE...IT SHOULD WORK. LET'S ROLL IT OUT. MAYBE TEST REAL QUICK? AT LEAST TO SAY WE TRIED...  :)
                    $oDB_RESP->process(self::$mysqli,$queryType,$tmp_SELECT_ARRAY,$tmp_stream_query);

                    //
                    // ORDER BY STREAM_ID SO THAT YOU CAN ACCESS I_FEED_xxx DATA
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'COMM_STREAM', 'STREAM_ID');

                    //
                    // IS THE TARGET STREAM A REPLY STREAM?
                    #$oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_DATA'), 'KIVOTOS', 'NAME',5)
                                              # ($serial, $profile, $current_id, $fieldname){
                    $tmp_parent_id = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'COMM_STREAM' , $tmp_stream_id, 'I_FEED_STREAM_ID');

                   if($tmp_parent_id!=""){

                       //
                       // ADD STREAM PARENT DATA TO oDB_RESP OBJECT AND THEN MERGE THE TWO DATA SETS TOGETHER FOR OUTPUT ON DEEP LINK PAGE
                       # error_log("database (1497) parent stream id [".$tmp_parent_id."]");
                       $db_resp_profile_field_cnt = NULL;
                       $db_resp_target_profiles = NULL;
                       $force_profile_select_align = true;

                       //
                       // QUERY CONSTRUCTION
                       $tmp_SELECT_ARRAY = array();
                       $tmp_stream_query = '';
                       $tmp_query_cnt = 0;

                       #$tmp_loop_size = sizeof($tmp_stream_lookup_id_ARRAY);
                       #for($i=0;$i<$tmp_loop_size;$i++){

                       $tmp_SELECT_ARRAY[0] = '`comm_stream`.`STREAM_ID`,
                    `comm_stream`.`STREAM_TYPE`,
                    `comm_stream`.`CLIENT_ID`,
                    `comm_stream`.`USER_ID`,
                    `comm_stream`.`ISACTIVE`,
                    `comm_stream`.`KIVOTOS_ID`,
                    `comm_stream`.`ASSET_ID`,
                    `comm_stream`.`STREAM_CONTENT`,
                    `comm_stream`.`STREAM_FORMATTED`,
                    `comm_stream`.`FEEDER_STREAM_COUNT`,
                    `comm_stream`.`I_FEED_STREAM_ID`,
                    `comm_stream`.`ATTACHED_ASSET_ID`,
                    `comm_stream`.`ISMODIFIED`,
                    `comm_stream`.`DATEMODIFIED`,
                    `comm_stream`.`DATECREATED`,
                    `comm_stream_flow`.`FLOW_ID`,
                    `comm_stream_flow`.`CLIENT_ID` AS `CLIENT_ID_FLOW`,
                    `comm_stream_flow`.`STREAM_ID` AS `STREAM_ID_FLOW`,
                    `comm_stream_flow`.`FEEDER_STREAM_ID`';

                       /*
                        $tmp_stream_query = 'SELECT ' . $tmp_SELECT_ARRAY[0] . ' FROM `comm_stream` LEFT OUTER JOIN `comm_stream_flow` ON `comm_stream`.`STREAM_ID` = `comm_stream_flow`.`FEEDER_STREAM_ID` WHERE
                        `comm_stream`.`STREAM_ID`="' .self::$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'sid')). '" AND
                        `comm_stream`.`STREAM_ID_CRC32`="' .crc32($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'sid')). '" AND
                        `comm_stream`.`ISACTIVE`="1" AND
                        `comm_stream`.`KIVOTOS_ID`="' . self::$mysqli->real_escape_string($tmp_stream_lookup_id_ARRAY[$i]) . '" AND
                        `comm_stream`.`KIVOTOS_ID_CRC32`="' . crc32($tmp_stream_lookup_id_ARRAY[$i]) . '" ORDER BY `comm_stream`.`DATECREATED` ASC
                        ;';
                        */

                       $tmp_stream_query = 'SELECT ' . $tmp_SELECT_ARRAY[0] . ' FROM `comm_stream` LEFT OUTER JOIN `comm_stream_flow` ON `comm_stream`.`STREAM_ID` = `comm_stream_flow`.`FEEDER_STREAM_ID` WHERE 
                        (`comm_stream_flow`.`STREAM_ID`="' .self::$mysqli->real_escape_string($tmp_parent_id). '" AND 
                        `comm_stream_flow`.`STREAM_ID_CRC32`="' .crc32($tmp_parent_id). '") OR 
                        (`comm_stream_flow`.`FEEDER_STREAM_ID`="' .self::$mysqli->real_escape_string($tmp_parent_id). '" AND 
                        `comm_stream_flow`.`FEEDER_STREAM_ID_CRC32`="' .crc32($tmp_parent_id). '") AND
                        `comm_stream`.`ISACTIVE`="1" ORDER BY `comm_stream`.`DATECREATED` ASC
                        ;';


                       $db_resp_target_profiles = 'COMM_PARENT_STREAM';
                       $db_resp_profile_field_cnt = '19';

                       $db_resp_process_serial = "Amen!!!";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                       $db_resp_serial_key = 'STREAM_PARENT_DATA';

                       $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt, $force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                       //
                       // ALL OF THIS NEEDS TO BE BURIED DEEP IN SOME CLASS METHOD.
                       // SHOULD MAYBE BE LIKE...IT SHOULD WORK. LET'S ROLL IT OUT. MAYBE TEST REAL QUICK? AT LEAST TO SAY WE TRIED...  :)
                       //error_log("database (1620) tmp_stream_query query->".$tmp_stream_query);
                       $oDB_RESP->process(self::$mysqli,$queryType,$tmp_SELECT_ARRAY,$tmp_stream_query);

                       //
                       // WE COULD SETUP A RECURSIVE SITUATION TO GO AS DEEP AS WE NEED TO GO FOR STREAM COMM. DESKTOP CAN
                       // DISPLAY 7 OR 8 LEVELS...I AM NOT GOING TO DO THIS 7 OR 8 TIMES...THIS WOULD BE THE SECOND TIME AFTER THE INITIAL STREAM REQUEST.

                       error_log("database (1647) Setup recursive, CRNRSTN configuration headed-up, db response aggregator to aggregate n+1 order deep stream data.");
                       die();




                       //
                       // NOW WE NEED TO COMBINE THESE RESULTS
                       # ($serial_handle_pipe, $target_key_pipe, $sequence_field_pipe, $compare_type, $new_cumm_key)
                       #$oDB_RESP->response_key_merge('STREAM_DATA|STREAM_PARENT_DATA','COMM_STREAM|COMM_PARENT_STREAM', 'DATECREATED|DATECREATED','DATETIME', 'DEEP_STREAM_DATA');
                       $oDB_RESP->response_key_merge('STREAM_PARENT_DATA','COMM_PARENT_STREAM', 'DATECREATED','DATETIME', 'DEEP_STREAM_DATA');

                       //
                       // ALL DONE, PROCESSED AND READY FOR USE. RETURN RESPONSE OBJECT.
                       //error_log("database (1629) returning oDB_RESP after parent processing...");
                       return $oDB_RESP;

                   }else{

                       //
                       // NOT RUNNING KEY MERGE...BUT STILL NEED THIS COUNTER? YES.
                       #$oDB_RESP->initialize_count_for_deep_stream('DEEP_STREAM_DATA', $oDB_RESP->return_sizeof($oDB_RESP->return_serial('STREAM_DATA'), 'COMM_STREAM'));

                       //
                       // ALSO NEED SERIAL MAP FOR EACH ENTRY...OR SYSTEM OVERRIDE
                       #$oDB_RESP->initialize_serial_map_for_deep_stream('DEEP_STREAM_DATA', $oDB_RESP->return_serial('STREAM_DATA'));

                       //$oDB_RESP->response_key_merge('STREAM_DATA','COMM_STREAM', 'DATECREATED','DATETIME', 'DEEP_STREAM_DATA');

                       //
                       // ALL DONE, PROCESSED AND READY FOR USE. RETURN RESPONSE OBJECT.
                       //error_log("database (1646) returning oDB_RESP...");
                       return $oDB_RESP;

                   }


                break;
                case 'get_stream_data':

                    $tmp_stream_lookup_id_ARRAY = $oStream_MGR->return_stream_lookup_array('ID');
                    $tmp_stream_lookup_profile_ARRAY = $oStream_MGR->return_stream_lookup_array('PROFILE');
                    $tmp_stream_dbresp_serial_ARRAY = $oStream_MGR->return_stream_lookup_array('SERIAL');
                    $db_resp_profile_field_cnt = NULL;
                    $db_resp_target_profiles = NULL;
                    $force_profile_select_align = true;

                    //
                    // QUERY CONSTRUCTION
                    $tmp_SELECT_ARRAY = array();
                    $tmp_stream_query = '';
                    $tmp_query_cnt = 0;

                    $tmp_loop_size = sizeof($tmp_stream_lookup_id_ARRAY);
                    for($i=0;$i<$tmp_loop_size;$i++){

                        $tmp_SELECT_ARRAY[$i] = '`comm_stream`.`STREAM_ID`,
                        `comm_stream`.`STREAM_TYPE`,
                        `comm_stream`.`CLIENT_ID`,
                        `comm_stream`.`USER_ID`,
                        `comm_stream`.`ISACTIVE`,
                        `comm_stream`.`KIVOTOS_ID`,
                        `comm_stream`.`ASSET_ID`,
                        `comm_stream`.`STREAM_CONTENT`,
                        `comm_stream`.`STREAM_FORMATTED`,
                        `comm_stream`.`FEEDER_STREAM_COUNT`,
                        `comm_stream`.`I_FEED_STREAM_ID`,
                        `comm_stream`.`ATTACHED_ASSET_ID`,
                        `comm_stream`.`ISMODIFIED`,
                        `comm_stream`.`DATEMODIFIED`,
                        `comm_stream`.`DATECREATED`,
                        `comm_stream_flow`.`FLOW_ID`,
                        `comm_stream_flow`.`CLIENT_ID` AS `CLIENT_ID_FLOW`,
                        `comm_stream_flow`.`STREAM_ID` AS `STREAM_ID_FLOW`,
                        `comm_stream_flow`.`FEEDER_STREAM_ID`';

                        switch($tmp_stream_lookup_profile_ARRAY[$i]){  #KIVOTOS,ASSET,USER,CLIENT,LANG
                            case 'KIVOTOS':

                                if($oUserEnvironment->oHTTP_MGR->issetHTTP($_POST)){
                                    if($oUserEnvironment->oHTTP_MGR->issetParam($_POST, 'toggle_asset_stream')){
                                        $tmp_asset_show = $oUserEnvironment->oHTTP_MGR->extractData($_POST, 'toggle_asset_stream');

                                        switch($tmp_asset_show){
                                            case '1':
                                                //
                                                // HIDE
                                                $tmp_stream_query .= 'SELECT ' . $tmp_SELECT_ARRAY[$i] . ' FROM `comm_stream` LEFT OUTER JOIN `comm_stream_flow` ON `comm_stream`.`STREAM_ID` = `comm_stream_flow`.`FEEDER_STREAM_ID` WHERE 
                                    `comm_stream`.`CLIENT_ID`="' .self::$mysqli->real_escape_string($oDB_RESP->return_data_element($tmp_stream_dbresp_serial_ARRAY[$i], 'CLIENTS', 'CLIENT_ID')). '" AND 
                                    `comm_stream`.`CLIENT_ID_CRC32`="' .crc32($oDB_RESP->return_data_element($tmp_stream_dbresp_serial_ARRAY[$i], 'CLIENTS', 'CLIENT_ID')). '" AND 
                                    `comm_stream`.`ISACTIVE`="1" AND
                                    `comm_stream`.`KIVOTOS_ID`="' . self::$mysqli->real_escape_string($tmp_stream_lookup_id_ARRAY[$i]) . '" AND 
                                    `comm_stream`.`KIVOTOS_ID_CRC32`="' . crc32($tmp_stream_lookup_id_ARRAY[$i]) . '" AND
                                    (`comm_stream`.`ASSET_ID`="" OR `comm_stream`.`ASSET_ID` IS NULL) ORDER BY `comm_stream`.`DATECREATED` ASC
                                    ;';

                                            break;
                                            default:
                                                //
                                                // SHOW

                                                $tmp_stream_query .= 'SELECT ' . $tmp_SELECT_ARRAY[$i] . ' FROM `comm_stream` LEFT OUTER JOIN `comm_stream_flow` ON `comm_stream`.`STREAM_ID` = `comm_stream_flow`.`FEEDER_STREAM_ID` WHERE 
                                    `comm_stream`.`CLIENT_ID`="' .self::$mysqli->real_escape_string($oDB_RESP->return_data_element($tmp_stream_dbresp_serial_ARRAY[$i], 'CLIENTS', 'CLIENT_ID')). '" AND 
                                    `comm_stream`.`CLIENT_ID_CRC32`="' .crc32($oDB_RESP->return_data_element($tmp_stream_dbresp_serial_ARRAY[$i], 'CLIENTS', 'CLIENT_ID')). '" AND 
                                    `comm_stream`.`ISACTIVE`="1" AND
                                    `comm_stream`.`KIVOTOS_ID`="' . self::$mysqli->real_escape_string($tmp_stream_lookup_id_ARRAY[$i]) . '" AND 
                                    `comm_stream`.`KIVOTOS_ID_CRC32`="' . crc32($tmp_stream_lookup_id_ARRAY[$i]) . '" ORDER BY `comm_stream`.`DATECREATED` ASC
                                    ;';
                                            break;

                                        }

                                    }

                                }else{

                                    $tmp_stream_query .= 'SELECT ' . $tmp_SELECT_ARRAY[$i] . ' FROM `comm_stream` LEFT OUTER JOIN `comm_stream_flow` ON `comm_stream`.`STREAM_ID` = `comm_stream_flow`.`FEEDER_STREAM_ID` WHERE 
                                    `comm_stream`.`CLIENT_ID`="' .self::$mysqli->real_escape_string($oDB_RESP->return_data_element($tmp_stream_dbresp_serial_ARRAY[$i], 'CLIENTS', 'CLIENT_ID')). '" AND 
                                    `comm_stream`.`CLIENT_ID_CRC32`="' .crc32($oDB_RESP->return_data_element($tmp_stream_dbresp_serial_ARRAY[$i], 'CLIENTS', 'CLIENT_ID')). '" AND 
                                    `comm_stream`.`ISACTIVE`="1" AND
                                    `comm_stream`.`KIVOTOS_ID`="' . self::$mysqli->real_escape_string($tmp_stream_lookup_id_ARRAY[$i]) . '" AND 
                                    `comm_stream`.`KIVOTOS_ID_CRC32`="' . crc32($tmp_stream_lookup_id_ARRAY[$i]) . '" ORDER BY `comm_stream`.`DATECREATED` ASC
                                    ;';
                                }
                                //
                                // THE WAY THIS IS HAPPENING...MAKES IT CHALLENGING TO EXTRACT THE DATA WHEN EVERY QUERY IS THE SAME. THIS WAS DESIGNED TO HANDLE
                                // MULTIPLE AND DIFFERENT SELECT QUERIES. WHEN ALL QUERIES ARE THE SAME...IT IS EASIER IF THEY WERE ALL TIED TOGETHER. THIS IS A
                                // NEEDED ENHANCEMENT. LET'S DO THIS NOW. SO THIS PARTICULAR IMPLEMENTATION OF STREAM SENDS A SINGLE QUERY TO DB. WE ARE OK WITH THAT.
                                // THIS DATA PATTERN, HOWEVER PRESENTS CHALLENGES WITH MULTI-QUERY. TIME FOR MORE EVALUATION.

                                if ($db_resp_profile_field_cnt == "") {
                                    $db_resp_target_profiles = 'COMM_STREAM_' . $i;
                                    $db_resp_profile_field_cnt = '19';
                                } else {
                                    $db_resp_target_profiles .= '|COMM_STREAM_' . $i;
                                    $db_resp_profile_field_cnt .= '|19';

                                }

                            break;
                            case 'ASSETS':
                            case 'ASSET':
                            $tmp_stream_query .= 'SELECT ' . $tmp_SELECT_ARRAY[$i] . ' FROM `comm_stream` LEFT OUTER JOIN `comm_stream_flow` ON `comm_stream`.`STREAM_ID` = `comm_stream_flow`.`FEEDER_STREAM_ID` WHERE 
                                `comm_stream`.`CLIENT_ID`="' .self::$mysqli->real_escape_string($oDB_RESP->return_data_element($tmp_stream_dbresp_serial_ARRAY[$i], 'CLIENTS', 'CLIENT_ID')). '" AND 
                                `comm_stream`.`CLIENT_ID_CRC32`="' .crc32($oDB_RESP->return_data_element($tmp_stream_dbresp_serial_ARRAY[$i], 'CLIENTS', 'CLIENT_ID')). '" AND 
                                `comm_stream`.`ISACTIVE`="1" AND
                                `comm_stream`.`ASSET_ID`="' . self::$mysqli->real_escape_string($tmp_stream_lookup_id_ARRAY[$i]) . '" AND 
                                `comm_stream`.`ASSET_ID_CRC32`="' . crc32($tmp_stream_lookup_id_ARRAY[$i]) . '" ORDER BY `comm_stream`.`DATECREATED` ASC
                                ;';

                            //
                            // THE WAY THIS IS HAPPENING...MAKES IT CHALLENGING TO EXTRACT THE DATA WHEN EVERY QUERY IS THE SAME. THIS WAS DESIGNED TO HANDLE
                            // MULTIPLE AND DIFFERENT SELECT QUERIES. WHEN ALL QUERIES ARE THE SAME...IT IS EASIER IF THEY WERE ALL TIED TOGETHER. THIS IS A
                            // NEEDED ENHANCEMENT. LET'S DO THIS NOW. SO THIS PARTICULAR IMPLEMENTATION OF STREAM SENDS A SINGLE QUERY TO DB. WE ARE OK WITH THAT.
                            // THIS DATA PATTERN, HOWEVER PRESENTS CHALLENGES WITH MULTI-QUERY. TIME FOR MORE EVALUATION.

                            if ($db_resp_profile_field_cnt == "") {
                                $db_resp_target_profiles = 'COMM_STREAM_' . $i;
                                $db_resp_profile_field_cnt = '19';
                            } else {
                                $db_resp_target_profiles .= '|COMM_STREAM_' . $i;
                                $db_resp_profile_field_cnt .= '|19';

                            }


                            break;
                            case 'USERS':
                            case 'USER':
                            break;
                            case 'CLIENTS':
                            case 'CLIENT':
                            break;
                            case 'LANG':
                            break;

                        }

                    }

                    $db_resp_process_serial = "jesus_is_lord!!!";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = 'STREAM_DATA';
                    $lock_resp_profile = true;
                    #error_log("database (910) initialize with serial[".$db_resp_process_serial."] profiles[".$db_resp_target_profiles."] fieldcnt[".$db_resp_profile_field_cnt."]");

                    //error_log("database (1233) comm_stream query->".$tmp_stream_query);
                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt, $force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // ALL OF THIS NEEDS TO BE BURIED DEEP IN SOME CLASS METHOD.
                    // SHOULD MAYBE BE LIKE...IT SHOULD WORK. LET'S ROLL IT OUT. MAYBE TEST REAL QUICK? AT LEAST TO SAY WE TRIED...  :)
                    $oDB_RESP->process(self::$mysqli,$queryType,$tmp_SELECT_ARRAY,$tmp_stream_query);

                    //
                    // ALL DONE, PROCESSED AND READY FOR USE. RETURN RESPONSE OBJECT.
                    return $oDB_RESP;

                break;
                default:
                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Key['.$queryType.'] provided for dbQuery() does not exist in the system.');
                break;

            }

        }catch( Exception $e ) {
            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('database_integration->dbQuery()', LOG_EMERG, $e->getMessage());

            //
            // CLOSE CONNECTION
            $oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection(self::$mysqli);

            return self::$query_exception_result;
        }

    }

	private function executeRequest($queryType, $oUser, $oUserEnvironment, $oDB_RESP){
	    try{
            //error_log('database.inc.php (213) evifweb queryType sent to user database_integrations class object :: '.$queryType.' from ['.$_SERVER['REMOTE_ADDR'].']');
            $ts = date("Y-m-d H:i:s", time());

            //
            // IF WE EVER NEED TO CONNECT TO MORE THAN 1 DATABASE IN A REQUEST....NEED TO WIRE IN MYSQLI CONN RESET BOOLEAN
            // FOR NOW, THE PERFORMANCE BOOST FROM MAINTAINING CONNECTION PERSIST IS WORTH IT. CAN ADD MULTI-DB SUPPORT LATER.
            if(isset(self::$mysqli)){
                if (self::$mysqli->ping()) {
                    //error_log("database (1093) mysqli->Our connection is ok!");
                } else {
                    //error_log("database (1095) mysqli->I will open a new connection now! ping()==FALSE");
                    //
                    // OPEN CONNECTION
                    self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->returnConnection();
                }
            }else{
                //error_log("database (1101) mysqli->I will open a new connection now! ...mysqli not set");
                //
                // OPEN CONNECTION
                self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->returnConnection();
            }

            if(!isset($oDB_RESP)){

                if(!isset(self::$oDB_RESP)) {
                    //error_log("database (1294) executeRequest() NOTICE :: We are instantiating a CLEAN oDB_RESP object for querytype[".$queryType."] Why not recycle?");

                    self::$oDB_RESP = new database_response_manager($oUserEnvironment, $this);
                    $oDB_RESP = self::$oDB_RESP;
                }else{
                    $oDB_RESP = self::$oDB_RESP;
                }
            }


            switch($queryType){
                case 'retrieve_primitive_scroll':
                    $force_profile_select_align = true;
                    $db_resp_process_serial = "jesus_is_my_dear_lord";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = 'SYS_NOTICE'; //$oUser->return_serial_handle();
                    $db_resp_target_profiles = 'SYS_NOTICE';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '19';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION :: GET ALL USERS. ALL USER-CLIENT RELATIONS. AND CLIENT DATA.
                    $tmp_SELECT_ARRAY = array();
                    $tmp_SELECT_ARRAY[0] = 'SELECT `sys_notification`.`NOTIFICATION_ID`,
                    `sys_notification`.`ISACTIVE`,
                    `sys_notification`.`QUERY_TYPE`,
                    `sys_notification`.`USERID_SUBMITTER`,
                    `sys_notification`.`USERID_MENTION`,
                    `sys_notification`.`USERID_DASHBOARD`,
                    `sys_notification`.`CLIENT_ID`,
                    `sys_notification`.`CLIENT_ID_MENTION`,
                    `sys_notification`.`CLIENT_ID_DASHBOARD`,
                    `sys_notification`.`STREAM_ID`,
                    `sys_notification`.`STREAM_TYPE`,
                    `sys_notification`.`I_FEED_STREAM_ID`,
                    `sys_notification`.`KIVOTOS_ID`,
                    `sys_notification`.`P_KIVOTOS_ID`,
                    `sys_notification`.`ASSET_ID`,
                    `sys_notification`.`ASSET_TYPE_KEY`,
                    `sys_notification`.`SPECIALTY_TYPE_KEY`,
                    `sys_notification`.`DATEMODIFIED`,
                    `sys_notification`.`DATECREATED`
                FROM `sys_notification` WHERE `sys_notification`.`ISACTIVE`="1";
                ';

                    // error_log("(1833) query->".self::$query);
                    $oDB_RESP->process(self::$mysqli,$queryType, $tmp_SELECT_ARRAY);

                    //
                    // ALL DONE, PROCESSED AND READY FOR USE. RETURN RESPONSE OBJECT.
                    return $oDB_RESP;

                break;
                case 'get_asset_upload_new_data':
                    $force_profile_select_align = true;
                    $db_resp_process_serial = "jesus_is_my_dear_lord";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();
                    $db_resp_target_profiles = 'ASSETS|CLIENTS|USERS_CLIENT_ASSOC|USERS';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '13|4|2|17';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION :: GET ALL USERS. ALL USER-CLIENT RELATIONS. AND CLIENT DATA.
                    $tmp_SELECT_ARRAY = array();
                    $tmp_SELECT_ARRAY[0] = '`assets`.`ASSET_ID`, `assets`.`CLIENT_ID`, `assets`.`KIVOTOS_ID`, `assets`.`USER_ID`, `assets`.`ISACTIVE`, `assets`.`ASSET_TYPE_KEY`, `assets`.`SPECIALTY_TYPE_KEY`, `assets`.`DLOAD_END_POINT`, `assets`.`PREVIEW_END_POINT`, `assets`.`FILE_NAME`, 
					`assets`.`FILE_EXT`, `assets`.`FILE_SIZE`, `assets`.`FILE_PATH`, `assets`.`FILE_MIME_TYPE`, `assets`.`IMAGE_WIDTH`, `assets`.`IMAGE_HEIGHT`, `assets`.`AUTHORIZED_IP`, 
					`assets`.`AUTHORIZED_USERS`, `assets`.`NAME`, `assets`.`DESCRIPTION_RAW` AS `DESCRIPTION`, `assets`.`PREVIOUS_VERSIONS`, `assets`.`LANGCODE`, `assets`.`CHANNEL`, `assets`.`DATEMODIFIED`, 
					`assets`.`DATECREATED`';
                    $tmp_SELECT_ARRAY[1] = '`clients`.`CLIENT_ID`, `clients`.`COMPANYNAME_BLOB`, `clients`.`LANGCODE`, `clients`.`DATECREATED`';
                    $tmp_SELECT_ARRAY[2] = '`users_client_assoc`.`CLIENT_ID`, `users_client_assoc`.`USER_ID`';
                    $tmp_SELECT_ARRAY[3] = '`users`.`USERID`,`users`.`EMAIL` ,`users`.`ISACTIVE`, `users`.`USER_PERMISSIONS_ID`, `users`.`FIRSTNAME_BLOB`, `users`.`LASTNAME_BLOB`,`users`.`STREAM_MENTION`, `users`.`JOBTITLE_BLOB`, `users`.`LANGCODE`,`users`.`LASTLOGIN`,`users`.`LASTLOGIN_IP`,`users`.`IMAGE_NAME`,`users`.`IMAGE_WIDTH`,`users`.`IMAGE_HEIGHT`,`users`.`ABOUT_BLOB`,`users`.`DATEMODIFIED`,`users`.`DATECREATED`';

                    self::$query = 'SELECT '.$tmp_SELECT_ARRAY[0].' FROM `assets` WHERE 
					`assets`.`ASSET_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ASSET_ID")).'" AND `assets`.`ASSET_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("ASSET_ID")).'" AND 
					`assets`.`CLIENT_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'" AND `assets`.`CLIENT_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'" AND 
					`assets`.`KIVOTOS_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" AND `assets`.`KIVOTOS_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" LIMIT 1;';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[1].' FROM `clients` WHERE
					`clients`.`CLIENT_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'" AND 
					`clients`.`CLIENT_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'" AND
					`clients`.`ISACTIVE`="1" LIMIT 1;';         // WE NEED ALL CLIENTS. WILL PULL BY ID AT POINT OF DATA INSERT.
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[2].' FROM `users_client_assoc` WHERE
					`users_client_assoc`.`USER_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("USERID")).'" AND
					`users_client_assoc`.`USER_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("USERID")).'" LIMIT 1;';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[3].' FROM `users` WHERE 
					`users`.`ISACTIVE`="1" OR `users`.`ISACTIVE`="4";';

                    // error_log("(1833) query->".self::$query);
                    $oDB_RESP->process(self::$mysqli,$queryType, $tmp_SELECT_ARRAY, self::$query);

                    $oDB_RESP->data_prep_flagUserAssociations($oDB_RESP->return_serial(), 'USERS_CLIENT_ASSOC');        // NULL SHOULD RETURN MOST RECENT SERIAL
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'CLIENTS', 'CLIENT_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'USERS_CLIENT_ASSOC', 'CLIENT_ID|USER_ID');

                    //
                    // ALL DONE, PROCESSED AND READY FOR USE. RETURN RESPONSE OBJECT.
                    return $oDB_RESP;

                break;
                case 'get_kivotos_details_simple_OOP':

                    $force_profile_select_align = true;
                    $db_resp_process_serial = "jesus_is_my_dear_lord";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();
                    $db_resp_target_profiles = 'KIVOTOS|CLIENTS|USERS_CLIENT_ASSOC|USERS';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '13|4|2|17';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION :: GET ALL USERS. ALL USER-CLIENT RELATIONS. AND CLIENT DATA.
                    $tmp_SELECT_ARRAY = array();
                    $tmp_SELECT_ARRAY[0] = '`kivotos`.`KIVOTOS_ID`,`kivotos`.`ISACTIVE` ,`kivotos`.`ISPRIVATE`, `kivotos`.`CLIENT_ID`, `kivotos`.`CREATOR_ID`,`kivotos`.`ASSIGNED_ID`, `kivotos`.`SEARCH_ID`, `kivotos`.`NAME`,`kivotos`.`DESCRIPTION`,`kivotos`.`DUE_DATE`,`kivotos`.`STATE`,`kivotos`.`DATEMODIFIED`,`kivotos`.`DATECREATED`';
                    $tmp_SELECT_ARRAY[1] = '`clients`.`CLIENT_ID`, `clients`.`COMPANYNAME_BLOB`, `clients`.`LANGCODE`, `clients`.`DATECREATED`';
                    $tmp_SELECT_ARRAY[2] = '`users_client_assoc`.`CLIENT_ID`, `users_client_assoc`.`USER_ID`';
                    $tmp_SELECT_ARRAY[3] = '`users`.`USERID`,`users`.`EMAIL` ,`users`.`ISACTIVE`, `users`.`USER_PERMISSIONS_ID`, `users`.`FIRSTNAME_BLOB`, `users`.`LASTNAME_BLOB`,`users`.`STREAM_MENTION`, `users`.`JOBTITLE_BLOB`, `users`.`LANGCODE`,`users`.`LASTLOGIN`,`users`.`LASTLOGIN_IP`,`users`.`IMAGE_NAME`,`users`.`IMAGE_WIDTH`,`users`.`IMAGE_HEIGHT`,`users`.`ABOUT_BLOB`,`users`.`DATEMODIFIED`,`users`.`DATECREATED`';

                    self::$query = 'SELECT '.$tmp_SELECT_ARRAY[0].' FROM `kivotos` WHERE `kivotos`.`KIVOTOS_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" AND `kivotos`.`KIVOTOS_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" LIMIT 1;';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[1].' FROM `clients`;';         // WE NEED ALL CLIENTS. WILL PULL BY ID AT POINT OF DATA INSERT.
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[2].' FROM `users_client_assoc` WHERE
					`users_client_assoc`.`USER_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("USERID")).'" AND
					`users_client_assoc`.`USER_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("USERID")).'" LIMIT 1;';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[3].' FROM `users` WHERE 
					`users`.`ISACTIVE`="1" OR `users`.`ISACTIVE`="4";';

                    //error_log("(1833) query->".self::$query);
                    $oDB_RESP->process(self::$mysqli,$queryType,$tmp_SELECT_ARRAY,self::$query);

                    $oDB_RESP->data_prep_flagUserAssociations($oDB_RESP->return_serial(), 'USERS_CLIENT_ASSOC');        // NULL SHOULD RETURN MOST RECENT SERIAL
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'CLIENTS', 'CLIENT_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'USERS_CLIENT_ASSOC', 'CLIENT_ID|USER_ID');

                    //
                    // ALL DONE, PROCESSED AND READY FOR USE. RETURN RESPONSE OBJECT.
                    return $oDB_RESP;

                break;
                case 'users_for_client':

                    $force_profile_select_align = true;
                    $db_resp_process_serial = "jesus_is_my_dear_lord";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();
                    $db_resp_target_profiles = 'USERS|USERS_CLIENT_ASSOC|CLIENTS';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '17|2|6';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION :: GET ALL USERS. ALL USER-CLIENT RELATIONS. AND CLIENT DATA.
                    $tmp_SELECT_ARRAY = array();
                    $tmp_SELECT_ARRAY[0] = '`users`.`USERID`,`users`.`EMAIL` ,`users`.`ISACTIVE`, `users`.`USER_PERMISSIONS_ID`, `users`.`FIRSTNAME_BLOB`, `users`.`LASTNAME_BLOB`,`users`.`STREAM_MENTION`, `users`.`JOBTITLE_BLOB`, `users`.`LANGCODE`,`users`.`LASTLOGIN`,`users`.`LASTLOGIN_IP`,`users`.`IMAGE_NAME`,`users`.`IMAGE_WIDTH`,`users`.`IMAGE_HEIGHT`,`users`.`ABOUT_BLOB`,`users`.`DATEMODIFIED`,`users`.`DATECREATED`';
                    $tmp_SELECT_ARRAY[1] = '`users_client_assoc`.`CLIENT_ID`, `users_client_assoc`.`USER_ID`';
                    $tmp_SELECT_ARRAY[2] = '`clients`.`CLIENT_ID`,`clients`.`ISACTIVE`, `clients`.`COMPANYNAME_BLOB`, `clients`.`LANGCODE`,`clients`.`DATEMODIFIED`, `clients`.`DATECREATED`';

                    self::$query = 'SELECT '.$tmp_SELECT_ARRAY[0].' FROM `users` WHERE 
					`users`.`ISACTIVE`="1" OR `users`.`ISACTIVE`="4";';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[1].' FROM `users_client_assoc` WHERE
					`users_client_assoc`.`USER_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("USERID")).'" AND
					`users_client_assoc`.`USER_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("USERID")).'";';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[2].' FROM `clients` WHERE
					`clients`.`CLIENT_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'" AND
					`clients`.`CLIENT_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'" LIMIT 1;';         // WE NEED ALL CLIENTS. WILL PULL BY ID AT POINT OF DATA INSERT.

                    //error_log("(1833) query->".self::$query);
                    $oDB_RESP->process(self::$mysqli,$queryType,$tmp_SELECT_ARRAY,self::$query);

                    //
                    // PREP DATA FOR USE
                    $oDB_RESP->data_prep_flagUserAssociations($oDB_RESP->return_serial(), 'USERS_CLIENT_ASSOC');        // NULL SHOULD RETURN MOST RECENT SERIAL
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'CLIENTS', 'CLIENT_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'USERS_CLIENT_ASSOC', 'CLIENT_ID|USER_ID');

                    //
                    // ALL DONE, PROCESSED AND READY FOR USE. RETURN RESPONSE OBJECT.
                    return $oDB_RESP;

                break;
                case 'get_user_stream_data':


                break;
                case 'get_deep_stream_support_data':
                    $force_profile_select_align = true;
                    $db_resp_process_serial = "jesus_is_my_dear_lord";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();
                    $db_resp_target_profiles = 'USERS|USERS_CLIENT_ASSOC|CLIENTS';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '16|2|4';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION
                    $tmp_SELECT_ARRAY = array();
                    $tmp_SELECT_ARRAY[0] = '`users`.`USERID`,`users`.`EMAIL` ,`users`.`ISACTIVE`, `users`.`USER_PERMISSIONS_ID`, `users`.`FIRSTNAME_BLOB`, `users`.`LASTNAME_BLOB`,`users`.`STREAM_MENTION`, `users`.`JOBTITLE_BLOB`, `users`.`LANGCODE`,`users`.`LASTLOGIN`,`users`.`LASTLOGIN_IP`,`users`.`IMAGE_NAME`,`users`.`IMAGE_WIDTH`,`users`.`IMAGE_HEIGHT`,`users`.`ABOUT_BLOB`,`users`.`DATEMODIFIED`,`users`.`DATECREATED`';
                    $tmp_SELECT_ARRAY[1] = '`users_client_assoc`.`CLIENT_ID`, `users_client_assoc`.`USER_ID`';
                    $tmp_SELECT_ARRAY[2] = '`clients`.`CLIENT_ID`, `clients`.`COMPANYNAME_BLOB`, `clients`.`LANGCODE`, `clients`.`DATECREATED`';

                    self::$query = 'SELECT '.$tmp_SELECT_ARRAY[0].' FROM `users` WHERE `users`.`ISACTIVE`="1" OR `users`.`ISACTIVE`="4";';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[1].' FROM `users_client_assoc`;';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[2].' FROM `clients` WHERE `clients`.`ISACTIVE`="1";'; // WE NEED ALL CLIENTS. WILL PULL BY ID AT POINT OF DATA INSERT.

                    //error_log("(1833) query->".self::$query);
                    $oDB_RESP->process(self::$mysqli,$queryType,$tmp_SELECT_ARRAY,self::$query);

                    //
                    // PREP DATA FOR USE
                    $oDB_RESP->data_prep_flagUserAssociations($oDB_RESP->return_serial(), 'USERS_CLIENT_ASSOC');        // NULL SHOULD RETURN MOST RECENT SERIAL
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'USERS', 'USERID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'CLIENTS', 'CLIENT_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'USERS_CLIENT_ASSOC', 'CLIENT_ID|USER_ID');

                    //
                    // ALL DONE, PROCESSED AND READY FOR USE. RETURN RESPONSE OBJECT.
                    return $oDB_RESP;

                break;
                case 'get_user_recent_data':

                    //
                    // USER DATA - REQUEST
                    $force_profile_select_align = true;
                    $db_resp_process_serial = "rock_of_my_salvation";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();
                    $db_resp_target_profiles = 'USERS|USERS_CLIENT_ASSOC|CLIENTS';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '26|3|4';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION
                    $tmp_SELECT_ARRAY = array();
                    $tmp_SELECT_ARRAY[0] = '`users`.`USERID`,    `users`.`EMAIL`,    `users`.`ISACTIVE`,    `users`.`USER_PERMISSIONS_ID`,    `users`.`FIRSTNAME`,    `users`.`FIRSTNAME_BLOB`,    `users`.`LASTNAME`,    `users`.`LASTNAME_BLOB`,    `users`.`STREAM_MENTION`,    `users`.`USER_MENTION_NOTIFICATION_ON`,    `users`.`COMPANYNAME`,    `users`.`COMPANYNAME_BLOB`,    `users`.`JOBTITLE`,    `users`.`JOBTITLE_BLOB`,    `users`.`PWDHASH`,    `users`.`LANGCODE`,    `users`.`LASTLOGIN`,    `users`.`LASTLOGIN_IP`,    `users`.`LOGIN_CNT`,    `users`.`IMAGE_NAME`,    `users`.`IMAGE_WIDTH`,    `users`.`IMAGE_HEIGHT`,    `users`.`ABOUT`,    `users`.`ABOUT_BLOB`,    `users`.`DATEMODIFIED`,    `users`.`DATECREATED`';
                    $tmp_SELECT_ARRAY[1] = '`users_client_assoc`.`CLIENT_ID`,    `users_client_assoc`.`USER_ID`,    `users_client_assoc`.`DATECREATED`';
                    $tmp_SELECT_ARRAY[2] = '`clients`.`CLIENT_ID`, `clients`.`COMPANYNAME_BLOB`, `clients`.`LANGCODE`, `clients`.`DATECREATED`';

                    self::$query = 'SELECT '.$tmp_SELECT_ARRAY[0].' FROM `users` WHERE `users`.`USERID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("USER_ID")).'" AND `users`.`USERID_CRC32`="'.crc32($oUser->retrieve_Form_Data("USER_ID")).'" LIMIT 1;';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[1].' FROM `users_client_assoc` WHERE `users_client_assoc`.`USER_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("USER_ID")).'" AND `users_client_assoc`.`USER_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("USER_ID")).'";';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[2].' FROM `clients` WHERE `clients`.`ISACTIVE`="1";';

                    $oDB_RESP->process(self::$mysqli,$queryType,$tmp_SELECT_ARRAY,self::$query);

                    $oDB_RESP->data_prep_flagUserAssociations($oDB_RESP->return_serial('USER_GENERAL'), 'USERS_CLIENT_ASSOC');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial('USER_GENERAL'), 'USERS_CLIENT_ASSOC', 'CLIENT_ID|USER_ID');

                    // $oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'USERS', 'USER_ID')

                    //
                    // USER RELATIONS DATA - REQUEST
                    $oUser->push_response_serial_handle('USER_DATA');

                    $force_profile_select_align = true;
                    $db_resp_process_serial = "praise_the_lord_jesus_christ";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();
                    $db_resp_target_profiles = 'ASSETS|STREAMS|KIVOTOS';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '25|19|14';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION
                    $tmp_SELECT_ARRAY = array();
                    $tmp_SELECT_ARRAY[0] = '`assets`.`ASSET_ID`, `assets`.`CLIENT_ID`, `assets`.`KIVOTOS_ID`, `assets`.`USER_ID`, `assets`.`ISACTIVE`, 
                    `assets`.`ASSET_TYPE_KEY`, `assets`.`DLOAD_END_POINT`, `assets`.`PREVIEW_END_POINT`, `assets`.`FILE_NAME`, `assets`.`FILE_EXT`, 
                    `assets`.`FILE_SIZE`, `assets`.`FILE_PATH`, `assets`.`FILE_MIME_TYPE`, `assets`.`IMAGE_WIDTH`, `assets`.`IMAGE_HEIGHT`, `assets`.`AUTHORIZED_IP`, 
                                `assets`.`AUTHORIZED_USERS`, `assets`.`NAME`, `assets`.`DESCRIPTION`, `assets`.`NEXT_VERSION`, `assets`.`PREVIOUS_VERSIONS`, 
                                `assets`.`LANGCODE`, `assets`.`CHANNEL`, `assets`.`DATEMODIFIED`, `assets`.`DATECREATED`';
                    $tmp_SELECT_ARRAY[1] = '`comm_stream`.`STREAM_ID`, `comm_stream`.`STREAM_TYPE`, `comm_stream`.`CLIENT_ID`, `comm_stream`.`USER_ID`, 
                    `comm_stream`.`ISACTIVE`, `comm_stream`.`KIVOTOS_ID`, `comm_stream`.`ASSET_ID`, `comm_stream`.`STREAM_CONTENT`, `comm_stream`.`STREAM_FORMATTED`, 
                    `comm_stream`.`FEEDER_STREAM_COUNT`, `comm_stream`.`I_FEED_STREAM_ID`, `comm_stream`.`ATTACHED_ASSET_ID`, `comm_stream`.`ISMODIFIED`, `comm_stream`.`DATEMODIFIED`, 
                    `comm_stream`.`DATECREATED`, `comm_stream_flow`.`FLOW_ID`, `comm_stream_flow`.`CLIENT_ID` AS `CLIENT_ID_FLOW`, 
                    `comm_stream_flow`.`STREAM_ID` AS `STREAM_ID_FLOW`, `comm_stream_flow`.`FEEDER_STREAM_ID`';
                    $tmp_SELECT_ARRAY[2] = '`kivotos`.`KIVOTOS_ID`,`kivotos`.`ISACTIVE` ,`kivotos`.`ISPRIVATE`, `kivotos`.`CLIENT_ID`,`kivotos`.`IS_CHILD`, 
                    `kivotos`.`CREATOR_ID`,`kivotos`.`ASSIGNED_ID`, `kivotos`.`SEARCH_ID`, `kivotos`.`NAME`,`kivotos`.`DESCRIPTION`,`kivotos`.`DUE_DATE`,
                    `kivotos`.`STATE`,`kivotos`.`DATEMODIFIED`,`kivotos`.`DATECREATED`';


                    self::$query = 'SELECT ' .$tmp_SELECT_ARRAY[0]. ' FROM `assets` WHERE
								                                `assets`.`USER_ID`="'.self::$mysqli->real_escape_string($oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'USERS', 'USERID')).'" AND `assets`.`USER_ID_CRC32`="'.crc32($oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'USERS', 'USERID')).'" AND 
								                                `assets`.`ISACTIVE`="1" ORDER BY `assets`.`DATECREATED` DESC;';


                    //
                    // I WANT TO LOOP THROUGH THE USER'S CLIENT RELATIONS AND BUILD OUT AN "OR STATEMENT" INJECTION WITH EACH CLIENT_ID
                    $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial('USER_GENERAL'), 'CLIENTS');

                    $tmp_clientid_OR_statement = array();

                    for($i=0;$i<$tmp_loop_size;$i++){
                        if($oDB_RESP->flag_isset_for_userClient($oDB_RESP->return_serial('USER_GENERAL'), $oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'USERS', 'USERID') , $oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'CLIENTS', 'CLIENT_ID', $i))){

                            #error_log("database (1389) pull data for client[".$oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'CLIENTS', 'CLIENT_ID', $i)."] into user homepage");
                            if(!isset($tmp_clientid_OR_statement)){

                                $tmp_clientid_OR_statement['comm_stream'] = ' (`comm_stream`.`CLIENT_ID`="'.self::$mysqli->real_escape_string($oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'CLIENTS', 'CLIENT_ID', $i)).'" AND `comm_stream`.`CLIENT_ID_CRC32`="'.crc32($oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'CLIENTS', 'CLIENT_ID', $i)).'") ';
                                $tmp_clientid_OR_statement['kivotos'] = ' (`kivotos`.`CLIENT_ID`="'.self::$mysqli->real_escape_string($oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'CLIENTS', 'CLIENT_ID', $i)).'" AND `kivotos`.`CLIENT_ID_CRC32`="'.crc32($oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'CLIENTS', 'CLIENT_ID', $i)).'") ';

                            }else{
                                $tmp_clientid_OR_statement['comm_stream'] .= ' OR (`comm_stream`.`CLIENT_ID`="'.self::$mysqli->real_escape_string($oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'CLIENTS', 'CLIENT_ID', $i)).'" AND `comm_stream`.`CLIENT_ID_CRC32`="'.crc32($oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'CLIENTS', 'CLIENT_ID', $i)).'") ';
                                $tmp_clientid_OR_statement['kivotos'] .= ' OR (`kivotos`.`CLIENT_ID`="'.self::$mysqli->real_escape_string($oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'CLIENTS', 'CLIENT_ID', $i)).'" AND `kivotos`.`CLIENT_ID_CRC32`="'.crc32($oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'CLIENTS', 'CLIENT_ID', $i)).'") ';

                            }
                        }

                    }

                    if(isset($tmp_clientid_OR_statement['comm_stream'])){
                        $tmp_clientid_OR_statement['comm_stream'] .= ' AND ';
                        $tmp_clientid_OR_statement['kivotos'] .= ' AND ';
                    }else{
                        $tmp_clientid_OR_statement['comm_stream'] = NULL;
                        $tmp_clientid_OR_statement['kivotos'] = NULL;

                    }

                    self::$query .= 'SELECT ' . $tmp_SELECT_ARRAY[1] . ' FROM `comm_stream` LEFT OUTER JOIN `comm_stream_flow` ON `comm_stream`.`STREAM_ID` = `comm_stream_flow`.`FEEDER_STREAM_ID` WHERE 
						                                '.$tmp_clientid_OR_statement['comm_stream'].'
						                                `comm_stream`.`ISACTIVE`="1" AND
						                                `comm_stream`.`USER_ID`="' . self::$mysqli->real_escape_string($oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'USERS', 'USERID')) . '" AND 
						                                `comm_stream`.`USER_ID_CRC32`="' . crc32($oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'USERS', 'USERID')) . '"
						                                 ORDER BY `comm_stream`.`DATECREATED` DESC;';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[2].' FROM `kivotos` WHERE '.$tmp_clientid_OR_statement['kivotos'].' `kivotos`.`CREATOR_ID`="'.self::$mysqli->real_escape_string($oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'USERS', 'USERID')).'" AND `kivotos`.`CREATOR_ID_CRC32`="'.crc32($oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'USERS', 'USERID')).'" ORDER BY `kivotos`.`DATECREATED` DESC;';

                    #error_log("database (1415) query->".self::$query);
                    $oDB_RESP->process(self::$mysqli,$queryType,$tmp_SELECT_ARRAY,self::$query);

                    //
                    // WE NEED SOME RESULTS FROM DIFFERENT TABLES TO BE COMBINED FOR HIGH LEVEL TIME-LINEAR DISPLAY
                    #response_merge(PIPE_DELIM_STR_OF_SERIAL_KEY_NAME_TO_COMBINE, DATE_FIELD_TO_ORDER_BY, NEW_COMBINED_KEY_SERIAL_NAME)
                    $oDB_RESP->response_key_merge('USER_DATA','ASSETS|STREAMS|KIVOTOS', 'DATECREATED|DATECREATED|DATECREATED','DATETIME', 'CUMM_ACTIVITY_DATA');

                    //
                    // ALL DONE, PROCESSED AND READY FOR USE. RETURN RESPONSE OBJECT.
                    return $oDB_RESP;

                break;
                case 'get_user_home_page_data':

                    //
                    // USER DATA - REQUEST
                    $force_profile_select_align = true;
                    $db_resp_process_serial = "rock_of_my_salvation";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();
                    $db_resp_target_profiles = 'USERS|USERS_CLIENT_ASSOC|CLIENTS';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '26|3|4';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    switch($oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")){
                        case 'm':
                            $tmp_max_recent_activity = $oUserEnvironment->getEnvParam('MOBILE_WEB_MAX_RECENT_ACTIVITY');
                        break;
                        case 'd':
                            $tmp_max_recent_activity = $oUserEnvironment->getEnvParam('DESKTOP_WEB_MAX_RECENT_ACTIVITY');
                        break;
                        default:
                            $tmp_max_recent_activity = $oUserEnvironment->getEnvParam('EMAIL_MAX_RECENT_ACTIVITY');
                        break;

                    }

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION
                    $tmp_SELECT_ARRAY = array();
                    $tmp_SELECT_ARRAY[0] = '`users`.`USERID`,    `users`.`EMAIL`,    `users`.`ISACTIVE`,    `users`.`USER_PERMISSIONS_ID`,    `users`.`FIRSTNAME`,    `users`.`FIRSTNAME_BLOB`,    `users`.`LASTNAME`,    `users`.`LASTNAME_BLOB`,    `users`.`STREAM_MENTION`,    `users`.`USER_MENTION_NOTIFICATION_ON`,    `users`.`COMPANYNAME`,    `users`.`COMPANYNAME_BLOB`,    `users`.`JOBTITLE`,    `users`.`JOBTITLE_BLOB`,    `users`.`PWDHASH`,    `users`.`LANGCODE`,    `users`.`LASTLOGIN`,    `users`.`LASTLOGIN_IP`,    `users`.`LOGIN_CNT`,    `users`.`IMAGE_NAME`,    `users`.`IMAGE_WIDTH`,    `users`.`IMAGE_HEIGHT`,    `users`.`ABOUT`,    `users`.`ABOUT_BLOB`,    `users`.`DATEMODIFIED`,    `users`.`DATECREATED`';
                    $tmp_SELECT_ARRAY[1] = '`users_client_assoc`.`CLIENT_ID`,    `users_client_assoc`.`USER_ID`,    `users_client_assoc`.`DATECREATED`';
                    $tmp_SELECT_ARRAY[2] = '`clients`.`CLIENT_ID`, `clients`.`COMPANYNAME_BLOB`, `clients`.`LANGCODE`, `clients`.`DATECREATED`';

                    self::$query = 'SELECT '.$tmp_SELECT_ARRAY[0].' FROM `users` WHERE `users`.`USERID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("USER_ID")).'" AND `users`.`USERID_CRC32`="'.crc32($oUser->retrieve_Form_Data("USER_ID")).'" LIMIT 1;';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[1].' FROM `users_client_assoc` WHERE `users_client_assoc`.`USER_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("USER_ID")).'" AND `users_client_assoc`.`USER_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("USER_ID")).'";';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[2].' FROM `clients` WHERE `clients`.`ISACTIVE`="1";';

                    $oDB_RESP->process(self::$mysqli,$queryType,$tmp_SELECT_ARRAY,self::$query);

                    $oDB_RESP->data_prep_flagUserAssociations($oDB_RESP->return_serial('USER_GENERAL'), 'USERS_CLIENT_ASSOC');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial('USER_GENERAL'), 'USERS_CLIENT_ASSOC', 'CLIENT_ID|USER_ID');

                    // $oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'USERS', 'USER_ID')

                    //
                    // USER RELATIONS DATA - REQUEST
                    $oUser->push_response_serial_handle('USER_DATA');

                    $force_profile_select_align = true;
                    $db_resp_process_serial = "praise_the_lord_jesus_christ";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();
                    $db_resp_target_profiles = 'ASSETS|STREAMS|KIVOTOS';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '25|19|14';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION
                    $tmp_SELECT_ARRAY = array();
                    $tmp_SELECT_ARRAY[0] = '`assets`.`ASSET_ID`, `assets`.`CLIENT_ID`, `assets`.`KIVOTOS_ID`, `assets`.`USER_ID`, `assets`.`ISACTIVE`, 
                    `assets`.`ASSET_TYPE_KEY`, `assets`.`DLOAD_END_POINT`, `assets`.`PREVIEW_END_POINT`, `assets`.`FILE_NAME`, `assets`.`FILE_EXT`, 
                    `assets`.`FILE_SIZE`, `assets`.`FILE_PATH`, `assets`.`FILE_MIME_TYPE`, `assets`.`IMAGE_WIDTH`, `assets`.`IMAGE_HEIGHT`, `assets`.`AUTHORIZED_IP`, 
                                `assets`.`AUTHORIZED_USERS`, `assets`.`NAME`, `assets`.`DESCRIPTION`, `assets`.`NEXT_VERSION`, `assets`.`PREVIOUS_VERSIONS`, 
                                `assets`.`LANGCODE`, `assets`.`CHANNEL`, `assets`.`DATEMODIFIED`, `assets`.`DATECREATED`';
                    $tmp_SELECT_ARRAY[1] = '`comm_stream`.`STREAM_ID`, `comm_stream`.`STREAM_TYPE`, `comm_stream`.`CLIENT_ID`, `comm_stream`.`USER_ID`, 
                    `comm_stream`.`ISACTIVE`, `comm_stream`.`KIVOTOS_ID`, `comm_stream`.`ASSET_ID`, `comm_stream`.`STREAM_CONTENT`, `comm_stream`.`STREAM_FORMATTED`, 
                    `comm_stream`.`FEEDER_STREAM_COUNT`, `comm_stream`.`I_FEED_STREAM_ID`, `comm_stream`.`ATTACHED_ASSET_ID`,`comm_stream`.`ISMODIFIED`, `comm_stream`.`DATEMODIFIED`, 
                    `comm_stream`.`DATECREATED`, `comm_stream_flow`.`FLOW_ID`, `comm_stream_flow`.`CLIENT_ID` AS `CLIENT_ID_FLOW`, 
                    `comm_stream_flow`.`STREAM_ID` AS `STREAM_ID_FLOW`, `comm_stream_flow`.`FEEDER_STREAM_ID`';
                    $tmp_SELECT_ARRAY[2] = '`kivotos`.`KIVOTOS_ID`,`kivotos`.`ISACTIVE` ,`kivotos`.`ISPRIVATE`, `kivotos`.`CLIENT_ID`,`kivotos`.`IS_CHILD`, 
                    `kivotos`.`CREATOR_ID`,`kivotos`.`ASSIGNED_ID`, `kivotos`.`SEARCH_ID`, `kivotos`.`NAME`,`kivotos`.`DESCRIPTION`,`kivotos`.`DUE_DATE`,
                    `kivotos`.`STATE`,`kivotos`.`DATEMODIFIED`,`kivotos`.`DATECREATED`';


                    self::$query = 'SELECT ' .$tmp_SELECT_ARRAY[0]. ' FROM `assets` WHERE
								                                `assets`.`USER_ID`="'.self::$mysqli->real_escape_string($oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'USERS', 'USERID')).'" AND `assets`.`USER_ID_CRC32`="'.crc32($oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'USERS', 'USERID')).'" AND 
								                                `assets`.`ISACTIVE`="1" ORDER BY `assets`.`DATECREATED` DESC LIMIT '.$tmp_max_recent_activity.';';


                    //
                    // I WANT TO LOOP THROUGH THE USER'S CLIENT RELATIONS AND BUILD OUT AN "OR STATEMENT" INJECTION WITH EACH CLIENT_ID
                    $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial('USER_GENERAL'), 'CLIENTS');

                    $tmp_clientid_OR_statement = array();

                    for($i=0;$i<$tmp_loop_size;$i++){
                        if($oDB_RESP->flag_isset_for_userClient($oDB_RESP->return_serial('USER_GENERAL'), $oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'USERS', 'USERID') , $oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'CLIENTS', 'CLIENT_ID', $i))){

                            #error_log("database (1389) pull data for client[".$oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'CLIENTS', 'CLIENT_ID', $i)."] into user homepage");
                            if(!isset($tmp_clientid_OR_statement)){

                                $tmp_clientid_OR_statement['comm_stream'] = ' (`comm_stream`.`CLIENT_ID`="'.self::$mysqli->real_escape_string($oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'CLIENTS', 'CLIENT_ID', $i)).'" AND `comm_stream`.`CLIENT_ID_CRC32`="'.crc32($oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'CLIENTS', 'CLIENT_ID', $i)).'") ';
                                $tmp_clientid_OR_statement['kivotos'] = ' (`kivotos`.`CLIENT_ID`="'.self::$mysqli->real_escape_string($oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'CLIENTS', 'CLIENT_ID', $i)).'" AND `kivotos`.`CLIENT_ID_CRC32`="'.crc32($oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'CLIENTS', 'CLIENT_ID', $i)).'") ';

                            }else{
                                $tmp_clientid_OR_statement['comm_stream'] .= ' OR (`comm_stream`.`CLIENT_ID`="'.self::$mysqli->real_escape_string($oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'CLIENTS', 'CLIENT_ID', $i)).'" AND `comm_stream`.`CLIENT_ID_CRC32`="'.crc32($oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'CLIENTS', 'CLIENT_ID', $i)).'") ';
                                $tmp_clientid_OR_statement['kivotos'] .= ' OR (`kivotos`.`CLIENT_ID`="'.self::$mysqli->real_escape_string($oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'CLIENTS', 'CLIENT_ID', $i)).'" AND `kivotos`.`CLIENT_ID_CRC32`="'.crc32($oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'CLIENTS', 'CLIENT_ID', $i)).'") ';

                            }
                        }

                    }

                    if(isset($tmp_clientid_OR_statement['comm_stream'])){
                        $tmp_clientid_OR_statement['comm_stream'] .= ' AND ';
                        $tmp_clientid_OR_statement['kivotos'] .= ' AND ';
                    }else{
                        $tmp_clientid_OR_statement['comm_stream'] = NULL;
                        $tmp_clientid_OR_statement['kivotos'] = NULL;

                    }

                    self::$query .= 'SELECT ' . $tmp_SELECT_ARRAY[1] . ' FROM `comm_stream` LEFT OUTER JOIN `comm_stream_flow` ON `comm_stream`.`STREAM_ID` = `comm_stream_flow`.`FEEDER_STREAM_ID` WHERE 
						                                '.$tmp_clientid_OR_statement['comm_stream'].'
						                                `comm_stream`.`ISACTIVE`="1" AND
						                                `comm_stream`.`USER_ID`="' . self::$mysqli->real_escape_string($oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'USERS', 'USERID')) . '" AND 
						                                `comm_stream`.`USER_ID_CRC32`="' . crc32($oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'USERS', 'USERID')) . '"
						                                 ORDER BY `comm_stream`.`DATECREATED` DESC LIMIT '.$tmp_max_recent_activity.';';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[2].' FROM `kivotos` WHERE '.$tmp_clientid_OR_statement['kivotos'].' `kivotos`.`CREATOR_ID`="'.self::$mysqli->real_escape_string($oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'USERS', 'USERID')).'" AND `kivotos`.`CREATOR_ID_CRC32`="'.crc32($oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_GENERAL'), 'USERS', 'USERID')).'" ORDER BY `kivotos`.`DATECREATED` DESC LIMIT '.$tmp_max_recent_activity.';';

                    //error_log("database (1415) query->".self::$query);
                    $oDB_RESP->process(self::$mysqli,$queryType,$tmp_SELECT_ARRAY,self::$query);

                    //
                    // WE NEED SOME RESULTS FROM DIFFERENT TABLES TO BE COMBINED FOR HIGH LEVEL TIME-LINEAR DISPLAY
                    #response_merge(PIPE_DELIM_STR_OF_SERIAL_KEY_NAME_TO_COMBINE, DATE_FIELD_TO_ORDER_BY, NEW_COMBINED_KEY_SERIAL_NAME)
                    $oDB_RESP->response_key_merge('USER_DATA','ASSETS|STREAMS|KIVOTOS', 'DATECREATED|DATECREATED|DATECREATED','DATETIME', 'CUMM_ACTIVITY_DATA');

                    //
                    // ALL DONE, PROCESSED AND READY FOR USE. RETURN RESPONSE OBJECT.
                    return $oDB_RESP;


                break;
                case 'get_proxy_data':
                    $force_profile_select_align = true;
                    $db_resp_process_serial = "jesus_christ_is_lord";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();
                    $db_resp_target_profiles = 'PROXY';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '4';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION
                    $tmp_SELECT_ARRAY = array();
                    $tmp_SELECT_ARRAY[0] = '`sys_uri_proxy`.`PROXY_ID`, `sys_uri_proxy`.`URI`, `sys_uri_proxy`.`USER_ID`, `sys_uri_proxy`.`CLIENT_ID`';

                    self::$query = 'SELECT '.$tmp_SELECT_ARRAY[0].' FROM `sys_uri_proxy` WHERE `sys_uri_proxy`.`PROXY_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("PROXY_ID")).'" AND `sys_uri_proxy`.`PROXY_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("PROXY_ID")).'" LIMIT 1;';

                    $oDB_RESP->process(self::$mysqli,$queryType,$tmp_SELECT_ARRAY,self::$query);

                    // $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'PROXY', 'USER_ID')
                    // LOG THE WORK OF RETURNING RESULT
                    $tmp_log_query = 'INSERT INTO `sys_uri_proxy_log`
                        (`PROXY_ID`,
                        `USER_ID`,
                        `CLIENT_ID`,
                        `CHANNEL`,
                        `IPADDRESS`,
                        `PHPSESSION`,
                        `HTTP_USER_AGENT`)
                        VALUES
                        (
                        "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("PROXY_ID")).'",
                        "'.self::$mysqli->real_escape_string($oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'PROXY', 'USER_ID')).'",
                        "'.self::$mysqli->real_escape_string($oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'PROXY', 'CLIENT_ID')).'",
                        "'.$oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE").'",
                        "'.$_SERVER['REMOTE_ADDR'].'",
                        "'.session_id().'",
                        "'.$_SERVER['HTTP_USER_AGENT'].'");
                        ';

                    //
                    // EXECUTE QUERY
                    self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, $tmp_log_query);

                    if(self::$mysqli->error){
                        self::$query_exception_result = "error";
                        throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }

                    //
                    // ALL DONE, PROCESSED AND READY FOR USE. RETURN RESPONSE OBJECT.
                    return $oDB_RESP;

                break;
                case 'pull_page_lang_elements':

                    //
                    // BUILD SELECT MULTI-QUERY BASED ON CONTENT IN PIPE ARRAY
                    $tmp_pipeArray = $oUser->retrieve_Form_Data("ELEMENT_PIPE_ARRAY");

                    $tmp_ELEMENT_KEY_ARRAY = explode("|", $tmp_pipeArray);

                    $tmp_loop_size = sizeof($tmp_ELEMENT_KEY_ARRAY);
                    $tmp_SELECT_ARRAY = array();
                    $tmp_sel_count = 0;
                    $tmp_sel_query = "";

                    for ($i = 0; $i < $tmp_loop_size; $i++) {

                        //
                        // LET'S BUILD THE QUERY FOR EXTRACTING USER DATA BASED ON @MENTION.
                        // THIS NEEDS TO BE FAST. SO WILL NEED TO SETUP/MANAGE USER LOOKUP TABLE FOR MENTION DATA.
                        $tmp_SELECT_ARRAY[$tmp_sel_count] = 'SELECT `sys_lang_elements`.`ELEMENT_REF_KEY`, `sys_lang_elements`.`COUNTRY_ISO_CODE`, `sys_lang_elements`.`ELEMENT_CONTENT_BLOB` AS `ELEMENT_CONTENT` FROM `sys_lang_elements` WHERE 
                        `sys_lang_elements`.`ELEMENT_REF_KEY`="'.self::$mysqli->real_escape_string($tmp_ELEMENT_KEY_ARRAY[$i]).'" AND
                        `sys_lang_elements`.`ELEMENT_REF_KEY_CRC32`="'.crc32($tmp_ELEMENT_KEY_ARRAY[$i]).'" AND
                        `sys_lang_elements`.`COUNTRY_ISO_CODE`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("COUNTRY_ISO_CODE")).'" AND 
                        `sys_lang_elements`.`ISO_CODE_CRC32`="'.crc32($oUser->retrieve_Form_Data("COUNTRY_ISO_CODE")).'" LIMIT 1;';

                        if (!isset($db_resp_profile_field_cnt)) {
                            #$db_resp_target_profiles = 'SYSLANG_' . $i;
                            $db_resp_target_profiles = $oUser->retrieve_Form_Data("COUNTRY_ISO_CODE")."_".$tmp_ELEMENT_KEY_ARRAY[$i];
                            $db_resp_profile_field_cnt = '3';
                        } else {
                            #$db_resp_target_profiles .= '|SYSLANG_' . $i;
                            $db_resp_target_profiles .= '|'.$oUser->retrieve_Form_Data("COUNTRY_ISO_CODE").'_'.$tmp_ELEMENT_KEY_ARRAY[$i];
                            $db_resp_profile_field_cnt .= '|3';

                        }

                        $tmp_sel_count++;

                    }

                    //
                    // WE HAVE LOOKUP QUERY. WE SHOULD PROCESS OOP. THIS IS A SELECT WITH RESULT RETURN.
                    $force_profile_select_align = true;
                    $db_resp_process_serial = "rock_of_my_salvation!";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();
                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt, $force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    $oDB_RESP->process(self::$mysqli,$queryType,$tmp_SELECT_ARRAY);

                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), $db_resp_target_profiles, 'COUNTRY_ISO_CODE|ELEMENT_REF_KEY');

                    self::$oDB_RESP = $oDB_RESP;

                    return $oDB_RESP;

                break;
                case 'pull_page_lang_elements_old':

                    //
                    // BUILD SELECT MULTI-QUERY BASED ON CONTENT IN PIPE ARRAY
                    $tmp_pipeArray = $oUser->retrieve_Form_Data("ELEMENT_PIPE_ARRAY");

                    $tmp_ELEMENT_KEY_ARRAY = explode("|", $tmp_pipeArray);

                    self::$query = "";
                    $tmp_loop_size = sizeof($tmp_ELEMENT_KEY_ARRAY);
                    for($i=0;$i<$tmp_loop_size;$i++){

                        //
                        // BUILD MULTI-QUERY
                        self::$query .= 'SELECT `sys_lang_elements`.`ELEMENT_REF_KEY`,`sys_lang_elements`.`ELEMENT_CONTENT_BLOB` FROM `sys_lang_elements` WHERE 
						`sys_lang_elements`.`ELEMENT_REF_KEY`="'.self::$mysqli->real_escape_string($tmp_ELEMENT_KEY_ARRAY[$i]).'" AND
						`sys_lang_elements`.`ELEMENT_REF_KEY_CRC32`="'.crc32($tmp_ELEMENT_KEY_ARRAY[$i]).'" AND
						`sys_lang_elements`.`COUNTRY_ISO_CODE`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("COUNTRY_ISO_CODE")).'" AND 
						`sys_lang_elements`.`ISO_CODE_CRC32`="'.crc32($oUser->retrieve_Form_Data("COUNTRY_ISO_CODE")).'" LIMIT 1;';

                    }

                    //error_log("database (336) query->".self::$query);
                    self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    //
                    // CLEAR RESULT ARRAY
                    array_splice(self::$result_ARRAY, 0);

                    $ROWCNT=0;
                    do {
                        if (self::$result = self::$mysqli->store_result()) {
                            while ($row = self::$result->fetch_row()) {
                                foreach($row as $fieldPos=>$value){
                                    //
                                    // STORE RESULT
                                    self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;

                                }
                                $ROWCNT++;
                            }
                            self::$result->free();
                        }

                        if (self::$mysqli->more_results()) {
                            //
                            // END OF RECORD. MORE TO FOLLOW.
                        }
                    } while (self::$mysqli->more_results() && self::$mysqli->next_result());








                    return self::$result_ARRAY;
                    // NOT GOING THROUGH oDB_RESP...SO I DON'T HAVE THIS DATABASE OUTPUT RIGHT HERE...HANG ON...CAN I DO BOTH? ....LOL...



                break;
                case 'load_asset_previous_versions':

                    $tmp_asset_array = $oUser->retrieve_Form_Data("ASSET_ID_ARRAY");
                    #error_log("database (127) size ASSET_ID_ARRAY->".sizeof($tmp_asset_array));
                    $tmp_loop_size = sizeof($tmp_asset_array);
                    $tmp_sel_count = 0;
                    $tmp_sel_query = "";
                    if($tmp_loop_size>0) {

                        $tmp_SELECT_ARRAY = array();

                        for ($i = 0; $i < $tmp_loop_size; $i++) {

                            if($tmp_asset_array[$i]!=""){

                                $tmp_SELECT_ARRAY[$tmp_sel_count] = '`assets`.`ASSET_ID`, `assets`.`CLIENT_ID`, `assets`.`KIVOTOS_ID`, `assets`.`USER_ID`, `assets`.`ISACTIVE`, `assets`.`ASSET_TYPE_KEY`, `assets`.`DLOAD_END_POINT`, `assets`.`PREVIEW_END_POINT`, `assets`.`FILE_NAME`, 
                                `assets`.`FILE_EXT`, `assets`.`FILE_SIZE`, `assets`.`FILE_PATH`, `assets`.`FILE_MIME_TYPE`, `assets`.`IMAGE_WIDTH`, `assets`.`IMAGE_HEIGHT`, `assets`.`AUTHORIZED_IP`, 
                                `assets`.`AUTHORIZED_USERS`, `assets`.`NAME`, `assets`.`DESCRIPTION`, `assets`.`NEXT_VERSION`, `assets`.`PREVIOUS_VERSIONS`, `assets`.`LANGCODE`, `assets`.`CHANNEL`, `assets`.`DATEMODIFIED`, 
                                `assets`.`DATECREATED`';

                                //
                                // LET'S BUILD THE QUERY FOR EXTRACTING USER DATA BASED ON @MENTION.
                                // THIS NEEDS TO BE FAST. SO WILL NEED TO SETUP/MANAGE USER LOOKUP TABLE FOR MENTION DATA.
                                $tmp_sel_query .= 'SELECT ' . $tmp_SELECT_ARRAY[$tmp_sel_count] . ' FROM `assets` WHERE
                                `assets`.`ASSET_ID`="'.self::$mysqli->real_escape_string($tmp_asset_array[$i]).'" AND `assets`.`ASSET_ID_CRC32`="'.crc32($tmp_asset_array[$i]).'" AND
                                `assets`.`CLIENT_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'" AND `assets`.`CLIENT_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'" AND
                                `assets`.`KIVOTOS_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" AND `assets`.`KIVOTOS_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" 
                                LIMIT 1;';

                                if (!isset($db_resp_profile_field_cnt)) {
                                    $db_resp_target_profiles = 'ASSETS_' . $i;
                                    $db_resp_profile_field_cnt = '25';
                                } else {
                                    $db_resp_target_profiles .= '|ASSETS_' . $i;
                                    $db_resp_profile_field_cnt .= '|25';

                                }

                                $tmp_sel_count++;

                            }

                        }

                        //
                        // WE HAVE LOOKUP QUERY. WE SHOULD PROCESS OOP. THIS IS A SELECT WITH RESULT RETURN.
                        $force_profile_select_align = true;
                        $db_resp_process_serial = "jesus_christ_is_lord!";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                        $db_resp_serial_key = $oUser->return_serial_handle();
                        #$db_resp_target_profiles = 'COMM_STREAM_MENTION';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                        #$db_resp_profile_field_cnt = '7';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                        $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt, $force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                        $oDB_RESP->process(self::$mysqli,$queryType,$tmp_SELECT_ARRAY,$tmp_sel_query);

                    }

                    //
                    // ALL DONE, PROCESSED AND READY FOR USE. RETURN RESPONSE OBJECT.
                    return $oDB_RESP;

                break;
                case 'get_asset_preview_data':

                    $force_profile_select_align = true;
                    $db_resp_process_serial = "jesus_christ_is_lord";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();
                    $db_resp_target_profiles = 'ASSETS|CLIENTS|USERS|USERS_CLIENT_ASSOC';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '27|4|25|3';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.
                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION
                    $tmp_SELECT_ARRAY = array();
                    $tmp_SELECT_ARRAY[0] = '`assets`.`ASSET_ID`, `assets`.`CLIENT_ID`, `assets`.`KIVOTOS_ID`, `assets`.`USER_ID`, `assets`.`ISACTIVE`, `assets`.`ASSET_TYPE_KEY`, `assets`.`DLOAD_END_POINT`, `assets`.`PREVIEW_END_POINT`, `assets`.`FILE_NAME`, `assets`.`FILE_EXT`, `assets`.`FILE_SIZE`, HEX(`assets`.`FILE_MD5`) AS `FILE_MD5`, HEX(`assets`.`FILE_SHA1`) AS `FILE_SHA1`, `assets`.`FILE_PATH`, `assets`.`FILE_MIME_TYPE`, `assets`.`IMAGE_WIDTH`, `assets`.`IMAGE_HEIGHT`, `assets`.`AUTHORIZED_IP`, `assets`.`AUTHORIZED_USERS`, `assets`.`NAME`, `assets`.`DESCRIPTION`, `assets`.`NEXT_VERSION`, `assets`.`PREVIOUS_VERSIONS`, `assets`.`LANGCODE`, `assets`.`CHANNEL`, `assets`.`DATEMODIFIED`, `assets`.`DATECREATED`';
                    $tmp_SELECT_ARRAY[1] = '`clients`.`CLIENT_ID`, `clients`.`COMPANYNAME_BLOB`, `clients`.`LANGCODE`, `clients`.`DATECREATED`';

                    self::$query = 'SELECT '.$tmp_SELECT_ARRAY[0].' FROM `assets` WHERE `assets`.`ASSET_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ASSET_ID")).'" AND `assets`.`ASSET_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("ASSET_ID")).'" AND `assets`.`CLIENT_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'" AND `assets`.`CLIENT_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'" AND `assets`.`KIVOTOS_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" AND `assets`.`KIVOTOS_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" LIMIT 1;';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[1].' FROM `clients` WHERE `clients`.`CLIENT_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'" AND `clients`.`CLIENT_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'" AND `clients`.`ISACTIVE`="1" LIMIT 1;';

                    //
                    // KIVOTOS ASSET PREVIEW WILL BE MISSING USERID.
                    if($oUser->retrieve_Form_Data("USER_ID")!=""){

                        $tmp_SELECT_ARRAY[2] = '`users`.`USERID`,`users`.`EMAIL`,`users`.`ISACTIVE`,`users`.`USER_PERMISSIONS_ID`,`users`.`FIRSTNAME`,`users`.`FIRSTNAME_BLOB`,`users`.`LASTNAME`,`users`.`LASTNAME_BLOB`,`users`.`STREAM_MENTION`,`users`.`USER_MENTION_NOTIFICATION_ON`,`users`.`COMPANYNAME`,`users`.`COMPANYNAME_BLOB`,`users`.`JOBTITLE`,`users`.`JOBTITLE_BLOB`,`users`.`LANGCODE`,`users`.`LASTLOGIN`,`users`.`LASTLOGIN_IP`,`users`.`LOGIN_CNT`,`users`.`IMAGE_NAME`,`users`.`IMAGE_WIDTH`,`users`.`IMAGE_HEIGHT`,`users`.`ABOUT`,`users`.`ABOUT_BLOB`,`users`.`DATEMODIFIED`,`users`.`DATECREATED`';
                        self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[2].' FROM `users` WHERE `users`.`USERID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("USER_ID")).'" AND `users`.`USERID_CRC32`="'.crc32($oUser->retrieve_Form_Data("USER_ID")).'" AND (`users`.`ISACTIVE`="1" OR `users`.`ISACTIVE`="4") LIMIT 1;';

                    }else{
                        $ID_ARRAY[0] = $oUser->retrieve_Form_Data("ASSET_ID");
                        $IDTYPE_ARRAY[0] = "ASSETS";

                        // AS I APPROACH OOP-ING THIS, I WOULD CONSIDER PASSING IN THE $oDB_RESP, THEN I COULD HAVE A METHOD FOR KICKING IT OUT. LET'S DO THAT.
                        // THIS WAY WE RECYCLE 1 DB_RESP METHOD...WELL...MORE LIKE WE WILL BE ABLE TO PERSIST ALL THE DATA HANDLED BY THE AUGMENTER AND CAN
                        // MAKE THAT DATA AVAILABLE TO THE REST OF THE PAGE ANYTIME WE WANT....OTHERWISE, ONLY THE AUGMENTER USES THE DATA AND NO ONE ELSE AFTER THAT.

                        $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                        $dataAugmenter = new dataAugmentation(self::$mysqli,$oUserEnvironment,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP, $tmp_data_aug_resp_serial_key);

                        $tmp_SELECT_ARRAY[2] = '`users`.`USERID`,`users`.`EMAIL`,`users`.`ISACTIVE`,`users`.`USER_PERMISSIONS_ID`,`users`.`FIRSTNAME`,`users`.`FIRSTNAME_BLOB`,`users`.`LASTNAME`,`users`.`LASTNAME_BLOB`,`users`.`STREAM_MENTION`,`users`.`USER_MENTION_NOTIFICATION_ON`,`users`.`COMPANYNAME`,`users`.`COMPANYNAME_BLOB`,`users`.`JOBTITLE`,`users`.`JOBTITLE_BLOB`,`users`.`LANGCODE`,`users`.`LASTLOGIN`,`users`.`LASTLOGIN_IP`,`users`.`LOGIN_CNT`,`users`.`IMAGE_NAME`,`users`.`IMAGE_WIDTH`,`users`.`IMAGE_HEIGHT`,`users`.`ABOUT`,`users`.`ABOUT_BLOB`,`users`.`DATEMODIFIED`,`users`.`DATECREATED`';
                        self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[2].' FROM `users` WHERE `users`.`USERID`="'.self::$mysqli->real_escape_string($dataAugmenter->getData('ASSETS',0,'USER_ID')).'" AND `users`.`USERID_CRC32`="'.crc32($dataAugmenter->getData('ASSETS',0,'USER_ID')).'" AND (`users`.`ISACTIVE`="1" OR `users`.`ISACTIVE`="4") LIMIT 1;';

                    }

                    $tmp_SELECT_ARRAY[3] = '`users_client_assoc`.`CLIENT_ID`,    `users_client_assoc`.`USER_ID`,    `users_client_assoc`.`DATECREATED`';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[3].' FROM `users_client_assoc` WHERE `users_client_assoc`.`USER_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("USER_ID")).'" AND `users_client_assoc`.`USER_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("USER_ID")).'";';

                    $oDB_RESP->process(self::$mysqli,$queryType,$tmp_SELECT_ARRAY,self::$query);

                    //$oDB_RESP->data_prep_flagUserAssociations($oDB_RESP->return_serial(), 'USERS_CLIENT_ASSOC');
                    //$oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'USERS_CLIENT_ASSOC', 'CLIENT_ID|USER_ID');

                    //
                    // PREP DATA FOR USE
                    $oDB_RESP->data_prep_flagUserAssociations($oDB_RESP->return_serial(), 'USERS_CLIENT_ASSOC');        // NULL SHOULD RETURN MOST RECENT SERIAL
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'USERS', 'USERID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'CLIENTS', 'CLIENT_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'USERS_CLIENT_ASSOC', 'CLIENT_ID|USER_ID');

                    //
                    // ALL DONE, PROCESSED AND READY FOR USE. RETURN RESPONSE OBJECT.
                    return $oDB_RESP;

                break;
                case 'get_kivotos_activity_log':

                    $force_profile_select_align = true;
                    $db_resp_process_serial = "jesus_is_lord";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();
                    $db_resp_target_profiles = 'LOG_SYS_USER|USERS|CLIENTS|KIVOTOS';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '9|16|4|14';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.
                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION
                    $tmp_SELECT_ARRAY = array();
                    $tmp_SELECT_ARRAY[0] = '`log_sys_user`.`ACTIVITY_ID`, `log_sys_user`.`DATECREATED`, `log_sys_user`.`CLIENT_ID`, `log_sys_user`.`KIVOTOS_ID`, `log_sys_user`.`USER_ID`, `log_sys_user`.`ASSET_ID`, `log_sys_user`.`ACTIVITY_DESCRIPTION`, `log_sys_user`.`IPADDRESS`, `log_sys_user`.`CHANNEL` ';
                    $tmp_SELECT_ARRAY[1] = '`users`.`USERID`, `users`.`EMAIL` ,`users`.`ISACTIVE`, `users`.`USER_PERMISSIONS_ID`, `users`.`FIRSTNAME_BLOB` AS `FIRSTNAME`, `users`.`LASTNAME_BLOB` AS `LASTNAME`, `users`.`JOBTITLE_BLOB`, `users`.`LANGCODE`,`users`.`LASTLOGIN`,`users`.`LASTLOGIN_IP`,`users`.`IMAGE_NAME`,`users`.`IMAGE_WIDTH`,`users`.`IMAGE_HEIGHT`,`users`.`ABOUT_BLOB`,`users`.`DATEMODIFIED`,`users`.`DATECREATED`';
                    $tmp_SELECT_ARRAY[2] = '`clients`.`CLIENT_ID`, `clients`.`COMPANYNAME_BLOB`, `clients`.`LANGCODE`, `clients`.`DATECREATED`';
                    $tmp_SELECT_ARRAY[3] = '`kivotos`.`KIVOTOS_ID`,`kivotos`.`ISACTIVE` ,`kivotos`.`ISPRIVATE`, `kivotos`.`CLIENT_ID`,`kivotos`.`IS_CHILD`, `kivotos`.`CREATOR_ID`,`kivotos`.`ASSIGNED_ID`, `kivotos`.`SEARCH_ID`, `kivotos`.`NAME`,`kivotos`.`DESCRIPTION`,`kivotos`.`DUE_DATE`,`kivotos`.`STATE`,`kivotos`.`DATEMODIFIED`,`kivotos`.`DATECREATED`';

                    self::$query = 'SELECT '.$tmp_SELECT_ARRAY[0].' FROM `log_sys_user` WHERE `KIVOTOS_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" AND `KIVOTOS_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" ORDER BY DATECREATED DESC;';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[1].' FROM `users` WHERE `users`.`ISACTIVE`="1" OR `users`.`ISACTIVE`="4";';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[2].'  FROM `clients`;';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[3].' FROM `kivotos` WHERE `kivotos`.`KIVOTOS_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" AND `kivotos`.`KIVOTOS_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" LIMIT 1;';

                    $oDB_RESP->process(self::$mysqli,$queryType,$tmp_SELECT_ARRAY,self::$query);

                    //
                    // ALL DONE, PROCESSED AND READY FOR USE. RETURN RESPONSE OBJECT.
                    return $oDB_RESP;

                break;
                case 'get_kivotos_stream_data':

                    //
                    // IT WOULD MAKE MY LIFE SO MUCH EASIER IF I NARROW CLIENTS DOWN TO THE SPECIFIC.
                    #$ID_ARRAY[0] = $oUser->retrieve_Form_Data("KIVOTOS_ID");
                    #$IDTYPE_ARRAY[0] = "KIVOTOS";

                    // THIS NEEDS TO GRACEFULLY DEGRADE. OTHERWISE 99% OF MY SITE WILL BE BROKE UNTIL I HAVE TIME TO UPDATE THIS EVERYWHERE...
                    #$tmp_data_aug_resp_serial_key = 'DATA_AUG_02';
                    #$dataAugmenter = new dataAugmentation(self::$mysqli,$oUserEnvironment,$ID_ARRAY,$IDTYPE_ARRAY, $oDB_RESP,$tmp_data_aug_resp_serial_key);
                    #$oDB_RESP = $dataAugmenter->return_oDB_RESP();

                    $force_profile_select_align = true;
                    $db_resp_process_serial = "jesus_is_lord";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();
                    $db_resp_target_profiles = 'KIVOTOS|USERS|USERS_CLIENT_ASSOC|CLIENTS';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '13|16|2|4';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION
                    $tmp_SELECT_ARRAY = array();
                    $tmp_SELECT_ARRAY[0] = '`kivotos`.`KIVOTOS_ID`,`kivotos`.`ISACTIVE` ,`kivotos`.`ISPRIVATE`, `kivotos`.`CLIENT_ID`,`kivotos`.`IS_CHILD`, `kivotos`.`CREATOR_ID`,`kivotos`.`ASSIGNED_ID`, `kivotos`.`SEARCH_ID`, `kivotos`.`NAME`,`kivotos`.`DESCRIPTION`,`kivotos`.`DUE_DATE`,`kivotos`.`STATE`,`kivotos`.`DATEMODIFIED`,`kivotos`.`DATECREATED`';
                    $tmp_SELECT_ARRAY[1] = '`users`.`USERID`,`users`.`EMAIL` ,`users`.`ISACTIVE`, `users`.`USER_PERMISSIONS_ID`, `users`.`FIRSTNAME_BLOB`, `users`.`LASTNAME_BLOB`,`users`.`STREAM_MENTION`, `users`.`JOBTITLE_BLOB`, `users`.`LANGCODE`,`users`.`LASTLOGIN`,`users`.`LASTLOGIN_IP`,`users`.`IMAGE_NAME`,`users`.`IMAGE_WIDTH`,`users`.`IMAGE_HEIGHT`,`users`.`ABOUT_BLOB`,`users`.`DATEMODIFIED`,`users`.`DATECREATED`';
                    $tmp_SELECT_ARRAY[2] = '`users_client_assoc`.`CLIENT_ID`, `users_client_assoc`.`USER_ID`';
                    $tmp_SELECT_ARRAY[3] = '`clients`.`CLIENT_ID`, `clients`.`COMPANYNAME_BLOB`, `clients`.`LANGCODE`, `clients`.`DATECREATED`';
                    #$tmp_SELECT_ARRAY[4] = '`kivotos_access`.`ACCESS_ID`, `kivotos_access`.`KIVOTOS_ID`, `kivotos_access`.`USER_ID`';
                    #$tmp_SELECT_ARRAY[5] = '`assets`.`ASSET_ID`, `assets`.`CLIENT_ID`, `assets`.`KIVOTOS_ID`, `assets`.`USER_ID`, `assets`.`ISACTIVE`, `assets`.`ASSET_TYPE_KEY`, `assets`.`NAME`, `assets`.`DESCRIPTION`, `assets`.`DATEMODIFIED`, `assets`.`DATECREATED`';
                    #$tmp_SELECT_ARRAY[6] = '`kivotos_relation`.`RELATION_ID`, `kivotos_relation`.`CLIENT_ID`, `kivotos_relation`.`P_KIVOTOS_ID`, `kivotos`.`NAME`,`kivotos`.`DESCRIPTION`, `kivotos_relation`.`C_KIVOTOS_ID`,`kivotos_relation`.`ISACTIVE`, `kivotos_relation`.`DATEMODIFIED`, `kivotos_relation`.`DATECREATED`';
                    #$tmp_SELECT_ARRAY[7] = '`kivotos_relation`.`RELATION_ID`, `kivotos_relation`.`CLIENT_ID`, `kivotos_relation`.`P_KIVOTOS_ID`, `kivotos_relation`.`C_KIVOTOS_ID`,`kivotos`.`NAME`,`kivotos`.`DESCRIPTION`, `kivotos_relation`.`ISACTIVE`, `kivotos_relation`.`DATEMODIFIED`, `kivotos_relation`.`DATECREATED`';

                    self::$query = 'SELECT '.$tmp_SELECT_ARRAY[0].' FROM `kivotos` WHERE `kivotos`.`KIVOTOS_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" AND `kivotos`.`KIVOTOS_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" LIMIT 1;';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[1].' FROM `users` WHERE `users`.`ISACTIVE`="1" OR `users`.`ISACTIVE`="4";';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[2].' FROM `users_client_assoc`;';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[3].' FROM `clients` WHERE `clients`.`ISACTIVE`="1";'; // WE NEED ALL CLIENTS. WILL PULL BY ID AT POINT OF DATA INSERT.
                    #self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[4].' FROM `kivotos_access` WHERE `kivotos_access`.`KIVOTOS_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" AND `kivotos_access`.`KIVOTOS_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'";';
                    #self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[5].' FROM `assets` WHERE `assets`.`KIVOTOS_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" AND `assets`.`KIVOTOS_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" AND `assets`.`ISACTIVE`="1" ORDER BY `assets`.`DATECREATED` DESC;';
                    #self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[6].' FROM `kivotos_relation` LEFT OUTER JOIN `kivotos` ON `kivotos_relation`.`P_KIVOTOS_ID` = `kivotos`.`KIVOTOS_ID` WHERE `kivotos_relation`.`CLIENT_ID`="'.$dataAugmenter->getData('KIVOTOS',0,'CLIENT_ID').'" AND `kivotos_relation`.`CLIENT_ID_CRC32`="'.crc32($dataAugmenter->getData('KIVOTOS',0,'CLIENT_ID')).'" AND `kivotos_relation`.`C_KIVOTOS_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" AND `kivotos_relation`.`C_KIVOTOS_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" LIMIT 1;';
                    #self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[7].' FROM `kivotos_relation` LEFT OUTER JOIN `kivotos` ON `kivotos_relation`.`C_KIVOTOS_ID` = `kivotos`.`KIVOTOS_ID` WHERE `kivotos_relation`.`CLIENT_ID`="'.$dataAugmenter->getData('KIVOTOS',0,'CLIENT_ID').'" AND `kivotos_relation`.`CLIENT_ID_CRC32`="'.crc32($dataAugmenter->getData('KIVOTOS',0,'CLIENT_ID')).'" AND `kivotos_relation`.`P_KIVOTOS_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" AND `kivotos_relation`.`P_KIVOTOS_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'";';

                    #error_log("database (1267) KIV ID #1 ->");
                    #error_log("database (1267) KIV ID #1 ->".$dataAugmenter->getData('KIVOTOS',1,'CREATOR_ID'));

                    $oDB_RESP->process(self::$mysqli,$queryType,$tmp_SELECT_ARRAY,self::$query);

                    //
                    // PREP DATA FOR USE
                    $oDB_RESP->data_prep_flagUserAssociations($oDB_RESP->return_serial(), 'USERS_CLIENT_ASSOC');        // NULL SHOULD RETURN MOST RECENT SERIAL
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'USERS', 'USERID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'CLIENTS', 'CLIENT_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'USERS_CLIENT_ASSOC', 'CLIENT_ID|USER_ID');

                    //
                    // ALL DONE, PROCESSED AND READY FOR USE. RETURN RESPONSE OBJECT.
                    return $oDB_RESP;

                break;
                case 'get_kivotos_details':

                    //
                    // IT WOULD MAKE MY LIFE SO MUCH EASIER IF I NARROW CLIENTS DOWN TO THE SPECIFIC.
                    $ID_ARRAY[0] = $oUser->retrieve_Form_Data("KIVOTOS_ID");
                    $IDTYPE_ARRAY[0] = "KIVOTOS";

                    $tmp_data_aug_resp_serial_key = 'DATA_AUG_00';
                    $dataAugmenter = new dataAugmentation(self::$mysqli,$oUserEnvironment,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);
                    $oDB_RESP = $dataAugmenter->return_oDB_RESP();

                    $force_profile_select_align = true;
                    $db_resp_process_serial = "jesus_is_lord";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();       // THIS SHOULD RETURN CLEAR TEXT.
                    $db_resp_target_profiles = 'KIVOTOS|USERS|USERS_CLIENT_ASSOC|CLIENTS|KIVOTOS_ACCESS|ASSETS|KIVOTOS_P_RELATION|KIVOTOS_C_RELATION';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '13|16|2|4|3|10|7|7';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.
                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION
                    $tmp_SELECT_ARRAY = array();
                    $tmp_SELECT_ARRAY[0] = '`kivotos`.`KIVOTOS_ID`,`kivotos`.`ISACTIVE` ,`kivotos`.`ISPRIVATE`, `kivotos`.`CLIENT_ID`,`kivotos`.`IS_CHILD`, `kivotos`.`CREATOR_ID`,`kivotos`.`ASSIGNED_ID`, `kivotos`.`SEARCH_ID`, `kivotos`.`NAME`,`kivotos`.`DESCRIPTION`,`kivotos`.`DUE_DATE`,`kivotos`.`STATE`,`kivotos`.`DATEMODIFIED`,`kivotos`.`DATECREATED`';
                    $tmp_SELECT_ARRAY[1] = '`users`.`USERID`,`users`.`EMAIL` ,`users`.`ISACTIVE`, `users`.`USER_PERMISSIONS_ID`, `users`.`FIRSTNAME_BLOB`, `users`.`LASTNAME_BLOB`, `users`.`JOBTITLE_BLOB`, `users`.`LANGCODE`,`users`.`LASTLOGIN`,`users`.`LASTLOGIN_IP`,`users`.`IMAGE_NAME`,`users`.`IMAGE_WIDTH`,`users`.`IMAGE_HEIGHT`,`users`.`ABOUT_BLOB`,`users`.`DATEMODIFIED`,`users`.`DATECREATED`';
                    $tmp_SELECT_ARRAY[2] = '`users_client_assoc`.`CLIENT_ID`, `users_client_assoc`.`USER_ID`';
                    $tmp_SELECT_ARRAY[3] = '`clients`.`CLIENT_ID`, `clients`.`COMPANYNAME_BLOB`, `clients`.`LANGCODE`, `clients`.`DATECREATED`';
                    $tmp_SELECT_ARRAY[4] = '`kivotos_access`.`ACCESS_ID`, `kivotos_access`.`KIVOTOS_ID`, `kivotos_access`.`USER_ID`';
                    $tmp_SELECT_ARRAY[5] = '`assets`.`ASSET_ID`, `assets`.`CLIENT_ID`, `assets`.`KIVOTOS_ID`, `assets`.`USER_ID`, `assets`.`ISACTIVE`, `assets`.`ASSET_TYPE_KEY`, `assets`.`NAME`, `assets`.`DESCRIPTION`, `assets`.`DATEMODIFIED`, `assets`.`DATECREATED`';
                    $tmp_SELECT_ARRAY[6] = '`kivotos_relation`.`RELATION_ID`, `kivotos_relation`.`CLIENT_ID`, `kivotos_relation`.`P_KIVOTOS_ID`, `kivotos`.`NAME` AS PARENT_NAME,`kivotos`.`DESCRIPTION` AS PARENT_DESCRIPTION, `kivotos_relation`.`C_KIVOTOS_ID`,`kivotos_relation`.`ISACTIVE`, `kivotos_relation`.`DATEMODIFIED`, `kivotos_relation`.`DATECREATED`';
                    $tmp_SELECT_ARRAY[7] = '`kivotos_relation`.`RELATION_ID`, `kivotos_relation`.`CLIENT_ID`, `kivotos_relation`.`P_KIVOTOS_ID`, `kivotos_relation`.`C_KIVOTOS_ID`,`kivotos`.`NAME`,`kivotos`.`DESCRIPTION`, `kivotos_relation`.`ISACTIVE`, `kivotos_relation`.`DATEMODIFIED`, `kivotos_relation`.`DATECREATED`';

                    //
                    // WELL, I HAVE 2 FIELDS WITH ID THAT NEED KIVOTOS NAME PULLED. SO ONE JOIN QUERY WON'T CUT IT.
                    // I WOULD NEED A PARENT QUERY AND A CHILD QUERY...THE ALTERNATIVE IS TO...WHAT...I WOULD STILL NEED TO PULL N+1 KIVOTOS NAMES FROM THE DB.
                    /*'SELECT `crnrstn_class`.`CLASSID`,`crnrstn_class`.`NAME`,`crnrstn_class`.`URI`,`crnrstn_class`.`LANGCODE`,`crnrstn_method`.`METHODID`,`crnrstn_method`.`NAME`,`crnrstn_method`.`URI`,`crnrstn_method`.`ISACTIVE` FROM `crnrstn_class`
                    LEFT OUTER JOIN `crnrstn_method` ON `crnrstn_class`.`CLASSID` = `crnrstn_method`.`CLASSID` WHERE `crnrstn_class`.`ISACTIVE`="1" ORDER BY `crnrstn_class`.`NAV_POSITION`,`crnrstn_method`.`NAV_POSITION`;';*/

                    self::$query = 'SELECT '.$tmp_SELECT_ARRAY[0].' FROM `kivotos` WHERE `kivotos`.`KIVOTOS_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" AND `kivotos`.`KIVOTOS_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" LIMIT 1;';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[1].' FROM `users` WHERE `users`.`ISACTIVE`="1" OR `users`.`ISACTIVE`="4";';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[2].' FROM `users_client_assoc`;';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[3].' FROM `clients` WHERE `clients`.`CLIENT_ID`="'.$dataAugmenter->getData('KIVOTOS',0,'CLIENT_ID').'" AND 
                    `clients`.`CLIENT_ID_CRC32`="'.crc32($dataAugmenter->getData('KIVOTOS',0,'CLIENT_ID')).'" LIMIT 1;';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[4].' FROM `kivotos_access` WHERE `kivotos_access`.`KIVOTOS_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" AND `kivotos_access`.`KIVOTOS_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'";';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[5].' FROM `assets` WHERE `assets`.`KIVOTOS_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" AND `assets`.`KIVOTOS_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" AND `assets`.`ISACTIVE`="1" ORDER BY `assets`.`DATECREATED` DESC;';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[6].' FROM `kivotos_relation` LEFT OUTER JOIN `kivotos` ON `kivotos_relation`.`P_KIVOTOS_ID` = `kivotos`.`KIVOTOS_ID` WHERE `kivotos_relation`.`CLIENT_ID`="'.$dataAugmenter->getData('KIVOTOS',0,'CLIENT_ID').'" AND `kivotos_relation`.`CLIENT_ID_CRC32`="'.crc32($dataAugmenter->getData('KIVOTOS',0,'CLIENT_ID')).'" AND `kivotos_relation`.`C_KIVOTOS_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" AND `kivotos_relation`.`C_KIVOTOS_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" LIMIT 1;';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[7].' FROM `kivotos_relation` LEFT OUTER JOIN `kivotos` ON `kivotos_relation`.`C_KIVOTOS_ID` = `kivotos`.`KIVOTOS_ID` WHERE `kivotos_relation`.`CLIENT_ID`="'.$dataAugmenter->getData('KIVOTOS',0,'CLIENT_ID').'" AND `kivotos_relation`.`CLIENT_ID_CRC32`="'.crc32($dataAugmenter->getData('KIVOTOS',0,'CLIENT_ID')).'" AND `kivotos_relation`.`P_KIVOTOS_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" AND `kivotos_relation`.`P_KIVOTOS_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'";';

                    $oDB_RESP->process(self::$mysqli,$queryType,$tmp_SELECT_ARRAY,self::$query);

                    //
                    // ALL DONE, PROCESSED AND READY FOR USE. RETURN RESPONSE OBJECT.
                    return $oDB_RESP;

                break;
                case 'get_child_create_data':

                    //
                    // INSTANTIATE DATABASE RESPONSE PROCESSOR. BEFORE WE GET TOO FAR/DEEP...STAY HIGH LEVEL, AND TRY TO TIE IT ALL TOGETHER.
                    // THIS IS WHERE WE BEGIN PREPARATIONS TO RECEIVE DATABASE DATA
                    $db_resp_process_serial = "SfAmStB1WsU4";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();
                    $db_resp_target_profiles = 'KIVOTOS|USERS|USERS_CLIENT_ASSOC|CLIENTS';      # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '13|17|2|6';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.
                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // BUILD SQL
                    // I DON'T MIND MANUALLY BUILDING ARRAY WITH SELECT SQL DATA. SHOULD I ALSO STORE QUERY PROFILE TYPE HERE?
                    $tmp_SELECT_ARRAY = array();
                    $tmp_SELECT_ARRAY[0] = '`kivotos`.`KIVOTOS_ID`,`kivotos`.`ISACTIVE` ,`kivotos`.`ISPRIVATE`, `kivotos`.`CLIENT_ID`, `kivotos`.`CREATOR_ID`,`kivotos`.`ASSIGNED_ID`, `kivotos`.`SEARCH_ID`, `kivotos`.`NAME`,`kivotos`.`DESCRIPTION`,`kivotos`.`DUE_DATE`,`kivotos`.`STATE`,`kivotos`.`DATEMODIFIED`,`kivotos`.`DATECREATED`';
                    $tmp_SELECT_ARRAY[1] = '`users`.`USERID`,`users`.`EMAIL` ,`users`.`ISACTIVE`, `users`.`USER_PERMISSIONS_ID`, `users`.`FIRSTNAME_BLOB`, `users`.`LASTNAME_BLOB`,`users`.`STREAM_MENTION`, `users`.`JOBTITLE_BLOB`, `users`.`LANGCODE`,`users`.`LASTLOGIN`,`users`.`LASTLOGIN_IP`,`users`.`IMAGE_NAME`,`users`.`IMAGE_WIDTH`,`users`.`IMAGE_HEIGHT`,`users`.`ABOUT_BLOB`,`users`.`DATEMODIFIED`,`users`.`DATECREATED`';
                    $tmp_SELECT_ARRAY[2] = '`users_client_assoc`.`CLIENT_ID`, `users_client_assoc`.`USER_ID`';
                    $tmp_SELECT_ARRAY[3] = '`clients`.`CLIENT_ID`, `clients`.`ISACTIVE`, `clients`.`COMPANYNAME_BLOB`, `clients`.`LANGCODE`,`clients`.`DATEMODIFIED`, `clients`.`DATECREATED`';

                    //
                    // COMBINATION OF THE FOLLOWING REQUESTS...
                    #$adminContent_ARRAY = $oUSER->getKivotosData_Simple();
                    self::$query = 'SELECT '.$tmp_SELECT_ARRAY[0].' FROM `kivotos` WHERE `kivotos`.`KIVOTOS_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" AND `kivotos`.`KIVOTOS_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" LIMIT 1;';

                    #$adminContent_ARRAY = $oUSER->getUsersForClient();
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[1].' FROM `users` WHERE `users`.`ISACTIVE`="1" OR `users`.`ISACTIVE`="4";';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[2].' FROM `users_client_assoc`;';
                    self::$query .= 'SELECT '.$tmp_SELECT_ARRAY[3].' FROM `clients` WHERE `clients`.`CLIENT_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'" AND 
                     `clients`.`CLIENT_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'" LIMIT 1;';

                    $oDB_RESP->process(self::$mysqli,$queryType,$tmp_SELECT_ARRAY,self::$query);

                    //
                    // THIS METHOD PERFORMS A CUSTOM META UPDATE
                    $oDB_RESP->data_prep_flagUserAssociations($db_resp_process_serial, 'USERS_CLIENT_ASSOC');

                    //
                    // ALL DONE, PROCESSED AND READY FOR USE. RETURN RESPONSE OBJECT.
                    return $oDB_RESP;

                break;

                default:
                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Key['.$queryType.'] provided for dbQuery() does not exist in the system.');
                break;

            }

        }catch( Exception $e ) {
	        //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('database_integration->dbQuery()', LOG_EMERG, $e->getMessage());

            //
            // CLOSE CONNECTION
            $oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection(self::$mysqli);

            return self::$query_exception_result;
        }

    }
	
	private function executeQueryType($queryType, $oUser, $oUserEnvironment, $oAssetMgr){
		try{
			error_log('database.inc.php (304) evifweb queryType sent to user database_integrations class object :: '.$queryType.' from ['.$_SERVER['REMOTE_ADDR'].']');
			#$ts = date("Y-m-d H:i:s", time()-60*60*4);
			$ts = date("Y-m-d H:i:s", time());
			
			//
			// IF WE EVER NEED TO CONNECT TO MORE THAN 1 DATABASE IN A REQUEST....NEED TO WIRE IN MYSQLI CONN RESET BOOLEAN
			// FOR NOW, THE PERFORMANCE BOOST FROM MAINTAINING CONNECTION PERSIST IS WORTH IT. CAN ADD MULTI-DB SUPPORT LATER.
            if(isset(self::$mysqli)){
                if (self::$mysqli->ping()) {
                    //error_log("database (1439) mysqli->Our connection is ok!");
                } else {
                    //error_log("database (1441) mysqli->I will open a new connection now! ping()==FALSE");
                    //
                    // OPEN CONNECTION
                    self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->returnConnection();
                }
            }else{
                //error_log("database (1447) mysqli->I will open a new connection now! ...mysqli not set");
                //
                // OPEN CONNECTION
                self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->returnConnection();
            }

			/*
			ASSET ISACTIVE[1=ACTIVE, 3=DELETED, 5=ARCHIVED, 7=OLDVERSION]
			ASSET UPLOAD UPDATE TO EXISTING FILE.
				- 1) IF NO FILE UPLOAD...JUST UPDATE COPY AND LOG.
				- 2) IF FILE UPLOAD,
					A. PROCESS NEW FILE AS ORIGINAL ASSET FOR KIVOTOS. PASSTHOUGH OLD ASSET_ID.
					B. UPDATE ISACTIVE OF PREVIOUS VERSION TO ISACTIVE=7
			*/

            if(!isset($oDB_RESP)){

                if(!isset(self::$oDB_RESP)) {
                    //error_log("database (1830) executeRequest() NOTICE :: We are instantiating a CLEAN oDB_RESP object for querytype[".$queryType."] Why not recycle?");
                    self::$oDB_RESP = new database_response_manager($oUserEnvironment, $this);
                    $oDB_RESP = self::$oDB_RESP;
                }else{
                    $oDB_RESP = self::$oDB_RESP;
                }
            }

			switch($queryType){
				case 'CHECKSUM_GEN':
				#`clients` (`CLIENT_ID`, `COMPANYNAME`, `COMPANYNAME_BLOB`,
					#self::$query = 'SELECT `sys_lang_elements`.`ELEMENT_ID`,`sys_lang_elements`.`ELEMENT_REF_KEY` FROM `sys_lang_elements` WHERE `sys_lang_elements`.`ELEMENT_REF_KEY_CRC32`="";';
					self::$query = 'SELECT `clients`.`CLIENT_ID` FROM `clients`;';
					#self::$query = 'SELECT `clients`.`USERID`,`users`.`FIRSTNAME`,`users`.`LASTNAME` FROM `users`;';
					
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
					
					//
					// CLEAR RESULT ARRAY
					array_splice(self::$result_ARRAY, 0);
					
					if(self::$mysqli->error){
						self::$query_exception_result = "error";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}else{
						
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						$ROWCNT=0;
						while ($row = self::$result->fetch_row()) {
							foreach($row as $fieldPos=>$value){
								//
								// STORE RESULT
								//error_log("evifweb /database.inc.php (823) rowcnt[".$ROWCNT."] fieldPos[".$fieldPos."] value [".$value."]");
								self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
								
							}
							$ROWCNT++;
						}
						self::$result->free();
						
					}
					
					self::$query = NULL;
					$tmp_loop_size02 = sizeof(self::$result_ARRAY);
					for($i=0;$i<$tmp_loop_size02;$i++){
						//self::$query .= 'UPDATE `sys_lang_elements` SET 
//							`ELEMENT_REF_KEY_CRC32`="'.crc32(self::$result_ARRAY[$i][1]).'"
//							WHERE `ELEMENT_ID`="'.self::$result_ARRAY[$i][0].'" LIMIT 1;';

							self::$query .= 'UPDATE `clients` SET 
							`CLIENT_ID_CRC32`="'.crc32(self::$result_ARRAY[$i][0]).'"
							WHERE `CLIENT_ID`="'.self::$result_ARRAY[$i][0].'" LIMIT 1;';
						
					}
					
					
					#error_log("database (120) query->".self::$query);
					#self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
				
				break;
                case 'create_stream_reply':

                    /*self::$http_param_handle["CLIENT_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'cid'));
                    self::$http_param_handle["STREAM_TYPE"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'stk'));
                    self::$http_param_handle["KIVOTOS_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'kid'));
                    self::$http_param_handle["STREAM_CONTENT"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'stream');
                    self::$http_param_handle["STREAM_MENTIONS_EID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'sme');
                    self::$http_param_handle["I_FEED_STREAM_ID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'osi');*/

                    $tmp_activityid = $oUser->generateNewKey(70);
                    $tmp_streamid = $oUser->generateNewKey(100);
                    $tmp_searchid = $oUser->generateNewKey(70);

                    $oInputTransformer = new transformer($oUserEnvironment, $this, $oUser);
                    $tmp_content_format_ARRAY = $oInputTransformer->returnTransformedInput('LINKS', $oUser->retrieve_Form_Data("STREAM_CONTENT"));  // 2 DIM ARRAY RETURN

                    $oSTREAM_MGR = new stream_manager($oUserEnvironment, $oUser);

                    // INTERNALIZE CONTENT DATA PROFILE
                    #error_log("database (2159) process_mention_input() [".$oUser->retrieve_Form_Data("STREAM_MENTIONS_EID")."]");
                    $oSTREAM_MGR->process_mention_input($oUser->retrieve_Form_Data("STREAM_CONTENT"),$oUser->retrieve_Form_Data("STREAM_MENTIONS_EID"));
                    #error_log("database (2161) process_mention_input() complete. Count=[".$oSTREAM_MGR->return_mention_count()."]");

                    //
                    // THIS WILL SUPPORT MANUAL @MENTION ENTRY BY USER.
                    $tmp_loop_size = $oSTREAM_MGR->return_mention_count();
                    $db_resp_profile_field_cnt = '';
                    $tmp_mention_query = "";
                    if($tmp_loop_size>0) {
                        for ($i = 0; $i < $tmp_loop_size; $i++) {

                            $tmp_SELECT_ARRAY[$i] = '`comm_stream_mention`.`STREAM_MENTION`,
                                `comm_stream_mention`.`USER_ID`,
                                `comm_stream_mention`.`ISACTIVE`,
                                `comm_stream_mention`.`DATEMODIFIED`,
                                `comm_stream_mention`.`DATECREATED`';

                            //
                            // LET'S BUILD THE QUERY FOR EXTRACTING USER DATA BASED ON @MENTION.
                            // THIS NEEDS TO BE FAST. SO WILL NEED TO SETUP/MANAGE USER LOOKUP TABLE FOR MENTION DATA.
                            $tmp_mention_query .= 'SELECT ' . $tmp_SELECT_ARRAY[$i] . ' FROM `comm_stream_mention` WHERE 
                            `comm_stream_mention`.`STREAM_MENTION`="' . strtolower($oSTREAM_MGR->return_mention_data($i)) . '" AND 
                            `comm_stream_mention`.`STREAM_MENTION_CRC32`="' . crc32(strtolower($oSTREAM_MGR->return_mention_data($i))) . '" AND 
                            `comm_stream_mention`.`ISACTIVE`="1";';

                            if ($db_resp_profile_field_cnt == "") {
                                $db_resp_target_profiles = 'COMM_STREAM_MENTION_' . $i;
                                $db_resp_profile_field_cnt = '5';
                            } else {
                                $db_resp_target_profiles .= '|COMM_STREAM_MENTION_' . $i;
                                $db_resp_profile_field_cnt .= '|5';

                            }

                        }

                        //
                        // WE HAVE LOOKUP QUERY. WE SHOULD PROCESS OOP. THIS IS A SELECT WITH RESULT RETURN.
                        $force_profile_select_align = true;
                        $db_resp_process_serial = "jesus_is_lord!";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                        $db_resp_serial_key = 'COMM_STREAM';

                        $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt, $force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                        $oDB_RESP->process(self::$mysqli,$queryType,$tmp_SELECT_ARRAY,$tmp_mention_query);

                        //
                        // DB RESPONSE OBJ IS LOADED. NOW WE CAN BUILD THE SQL FOR MANAGING @MENTION NOTIFICATIONS
                        // NOW WE NEED TO GET USER PROFILE @MENTION HANDLE INTO THE DATABASE. WILL UPDATE THE USER PROFILE PAGE TO PERFORM THIS DATA MANIPULATION
                        $tmp_profile_array = explode("|", $db_resp_target_profiles);
                        #$tmp_loop_size_ARRAY = $oDB_RESP->return_sizeof($db_resp_process_serial, $tmp_profile_array[$i]);
                        #error_log("database (1199) running return_sizeof with tmp_profile_array->".$tmp_profile_array[0]);

                        # WHERE $tmp_loop_size_ARRAY[x] = # results returned by profile_x
                        // THIS COUNT REPRESENTS THE @MENTIONS ACTUALLY ENTERED INTO THE STREAM TEXTAREA AND COORELATES TO $oSTREAM_MGR->return_mention_data($i)

                        $tmp_loop_1_size = sizeof($tmp_profile_array);
                        for ($i = 0; $i < $tmp_loop_1_size; $i++) {
                            $tmp_resp_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial(), $tmp_profile_array[$i]);
                            $tmp_mention_check = true;

                            if($tmp_resp_size>0) {

                                $tmp_loop_size = $oDB_RESP->return_sizeof($db_resp_process_serial, $tmp_profile_array[$i]);
                                for ($ii = 0; $ii < $tmp_loop_size; $ii++) {

                                    if ($oSTREAM_MGR->mention_accounted($oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'USER_ID', $ii))) {
                                        $tmp_mention_check = false;
                                        #error_log("database (2235) mention_accounted for USER_ID[" . $oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'USER_ID', $ii) . "] STREAM_MENTION[" . $i . "]->" . $oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'STREAM_MENTION', $ii));
                                        #error_log("database (2236) hyper link @mention[".$oSTREAM_MGR->return_mention_case($oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'STREAM_MENTION', $ii))."] to user_id[".$oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'USER_ID', $ii)."]");
                                        $oInputTransformer->queueMentionForTransform($oSTREAM_MGR->return_mention_case($oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'STREAM_MENTION', $ii)),$oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'USER_ID', $ii));
                                    }
                                }
                            }

                            //
                            // IF WE HAVE AN @MENTION, BUT NO DATABASE MATCH...
                            if($tmp_mention_check){

                                //
                                // WE HAVE AN @MENTION THAT WAS MANUALLY ENTERED (OR TYPO'D). TRY TO PROCESS MANUALLY...JUST THE SAME.
                                // THIS MENTION PROCESSING SHOULD HAPPEN BEFORE STREAM_CONTENT_STYLED IS PREPPED FOR DATABASE INSERTION
                                // LETS SEE IF THIS FIRES. WE WILL NOT HOOK ANYTHING UP HERE YET. BUT PLAN TO ALLOW FOR USER TO MANUALLY ENTER @MENTION FOR PROCESSING
                                // WE ARE READY TO HOOK UP BEST EFFORT MANUAL PROCESSING. THIS WILL MOST LIKELY CHECK MAYBE FIRST 5 CHARS OF @MENTION AGAINST ANY EID HIDDEN IN THE FORM...TO TRY TO GET USER_ID.
                                #error_log("database (1684) we have custom entered @mention to process STREAM_MENTION[".$oSTREAM_MGR->return_mention_data($i)."] STREAM_MENTION[".$i."]");
                                //error_log("database (3425) we need to try to hyperlink mention[".$oSTREAM_MGR->return_mention_data($i)."]");
                                $tmp_mention_array = $this->find_mention_userid($oUserEnvironment, $oSTREAM_MGR->return_mention_data($i));

                                if($tmp_mention_array[0][0]!=""){
                                    //error_log("database (3429) queue custom mention ".$tmp_mention_array[0][1]);
                                    $oInputTransformer->queueMentionForTransform($tmp_mention_array[0][1], $tmp_mention_array[0][0]);

                                }

                            }

                        }

                    }

                    //
                    // APPLY FORMATTING TO STREAM CONTENT. THIS WOULD NEED TO HAPPEN ALSO FOR ANY DESCRIPTIONS SENT TO EXTRANET
                    $tmp_formatted_content = $tmp_content_format_ARRAY['STYLED_CONTENT'];  // GET LINKED CONTENT (PROXY AND INTERNAL)
                    $tmp_formatted_content = $oInputTransformer->transform_mentions($tmp_formatted_content);

                    //
                    // I NEED TO REVAMP THIS REMOVING KIVOTOS CENTRALITIY. WE MAY NOT HAVE KIVOTOS DATA EVERYTIME...LIKE IF STREAM SUBMITTED FROM USER PROFILE PAGE...
                    // I'M READY FOR A BEER. GOING TO CALL THIS SESSION COMPLETE NOW THAT WE HAVE GOOD UI FLOW FOR STREAM REPLY PROCESSING. AJAX INJECTION WOULD BE
                    // THE SLICKEST THOUGH...   :)

                    switch($oUser->retrieve_Form_Data("STREAM_TYPE")){
                        case 'KIVOTOS':
                            $ID_ARRAY[0] = $oUser->retrieve_Form_Data("KIVOTOS_ID");
                            $IDTYPE_ARRAY[0] = "KIVOTOS";

                            $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                            $dataAugmenter = new dataAugmentation(self::$mysqli,$oUserEnvironment,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);
                            #$dataAugmenter = new dataAugmentation(self::$mysqli,$oUserEnvironment,$ID_ARRAY,$IDTYPE_ARRAY);

                            $tmp_activity_descript = "A reply stream has been created within the kivot&oacute;s (<span class='a_log_topic_name'>".$dataAugmenter->getData('KIVOTOS',0,'NAME')."</span>) with the content [".$tmp_formatted_content."].";

                            break;
                        case 'USER':
                        case 'CLIENT':
                        case 'ASSET':
                        case 'LANG':
                            error_log('database (1570) need definition here...die().');
                            die();
                            break;
                        default:
                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('We are running create_stream, but the provided stream type for this communication ['.$oUser->retrieve_Form_Data("STREAM_TYPE").'] is unknown.');

                            break;

                    }

                    /*self::$http_param_handle["CLIENT_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'cid'));
        self::$http_param_handle["STREAM_TYPE"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'st'));
        self::$http_param_handle["KIVOTOS_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'kid'));
        self::$http_param_handle["STREAM_CONTENT"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'stream');*/

                    //
                    // BUILD SQL INSERT INTO comm_stream
                    self::$query = $tmp_content_format_ARRAY['QUERY'];
                    self::$query .= 'INSERT INTO `comm_stream` (`STREAM_ID`, `STREAM_ID_CRC32`, `STREAM_TYPE`, `STREAM_TYPE_CRC32`, `CLIENT_ID`, `CLIENT_ID_CRC32`,`USER_ID`, `USER_ID_CRC32`, `KIVOTOS_ID`, `KIVOTOS_ID_CRC32`, `STREAM_CONTENT`, `STREAM_FORMATTED`, `I_FEED_STREAM_ID`, `DATEMODIFIED`)
                    VALUES
                    ("'.$tmp_streamid.'",
                    "'.crc32($tmp_streamid).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("STREAM_TYPE")).'",
                    "'.crc32($oUser->retrieve_Form_Data("STREAM_TYPE")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
                    "'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
                    "'.$this->return_CRC32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("STREAM_CONTENT")).'",
                    "'.self::$mysqli->real_escape_string($tmp_formatted_content).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("I_FEED_STREAM_ID")).'",
                    "'.$ts.'");';

                    //
                    // BUILD SQL INSERT INTO comm_stream_flow
                    self::$query .= 'INSERT INTO `comm_stream_flow` (`CLIENT_ID`, `CLIENT_ID_CRC32`, `STREAM_ID`, `STREAM_ID_CRC32`, `FEEDER_STREAM_ID`, `FEEDER_STREAM_ID_CRC32`)
                    VALUES
                    ("'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.$oUser->retrieve_Form_Data("I_FEED_STREAM_ID").'",
                    "'.crc32($oUser->retrieve_Form_Data("I_FEED_STREAM_ID")).'",
                    "'.$tmp_streamid.'",
                    "'.crc32($tmp_streamid).'");';

                    //
                    // BUILD SQL INSERT INTO comm_stream_search_kivotos
                    $tmp_search_content = $oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME').$oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME').$oUser->retrieve_Form_Data("STREAM_CONTENT");
                    self::$query .= 'INSERT INTO `comm_stream_search` (`SEARCH_ID`, `SEARCH_CONTENT`,`STREAM_TYPE`,`CLIENT_ID`, `CLIENT_ID_CRC32`,`USER_ID`, `USER_ID_CRC32`, `KIVOTOS_ID`, `KIVOTOS_ID_CRC32`, `CONTENT_LENGTH`, `DATEMODIFIED`)
                    VALUES
                    ("'.$tmp_searchid.'",
                    "'.self::$mysqli->real_escape_string(strtolower($oUser->searchCleanStr($tmp_search_content))).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("STREAM_TYPE")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
                    "'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
                    "'.$this->return_CRC32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
                    "'.strlen($oUser->searchCleanStr($tmp_search_content)).'",
                    "'.$ts.'");';


                    ###########
                    ###########
                    /*

                    //
                    // BUILD SQL @MENTION NOTIFICATION QUEUE. WILL NEED TO KEY USER AGAINST @NAMENAME.
                    // SHOULD STREAM @MENTIONS BE BUBBLED UP ON THE USER PROFILE PAGE? MAYBE A MENTIONS SECTION. THIS WOULD BE FIRST TIER NOTIFICATION.
                    // THIS WILL TAKE SOME TIME RIGHT HERE. LET ME PLAY AROUND WITH IDEAS...
                    $oSTREAM_MGR = new stream_manager($oUserEnvironment, $oUser);

                    // INTERNALIZE CONTENT DATA PROFILE
                    error_log("database (3538) process_mention_input() [".$oUser->retrieve_Form_Data("STREAM_MENTIONS_EID")."]");
                    $oSTREAM_MGR->process_mention_input($oUser->retrieve_Form_Data("STREAM_CONTENT"),$oUser->retrieve_Form_Data("STREAM_MENTIONS_EID"));
                    error_log("database (3540) process_mention_input() complete. Count=[".$oSTREAM_MGR->return_mention_count()."]");

                    //
                    // IS THERE ANYTHING ELSE (TAGS, SYMBOLS, EXPRESSIONS, @MENTIONS[DONE]) WHICH COULD BE CONTAINED IN A STREAM AND PROCESSED?
                    # LINKS (SHOULD WE PROXY? I THINK SO)
                    # FROM ASSET PREVIEW PAGE...STREAM INSERT OF ASSET LINK?..WELL, IF SOMEONE WAS @MENTIONED IN A STREAM
                    # AND RECEIVED AN EMAIL NOTICE, THE ASSET LINK WOULD BE IN THE EMAIL

                    //
                    // THIS WILL SUPPORT MANUAL @MENTION ENTRY BY USER.
                    $tmp_loop_size = $oSTREAM_MGR->return_mention_count();
                    $db_resp_profile_field_cnt = '';
                    $tmp_mention_query = "";
                    if($tmp_loop_size>0) {
                        for ($i = 0; $i < $tmp_loop_size; $i++) {

                            $tmp_SELECT_ARRAY[$i] = '`comm_stream_mention`.`STREAM_MENTION`,
                                `comm_stream_mention`.`USER_ID`,
                                `comm_stream_mention`.`ISACTIVE`,
                                `comm_stream_mention`.`DATEMODIFIED`,
                                `comm_stream_mention`.`DATECREATED`';

                            //
                            // LET'S BUILD THE QUERY FOR EXTRACTING USER DATA BASED ON @MENTION.
                            // THIS NEEDS TO BE FAST. SO WILL NEED TO SETUP/MANAGE USER LOOKUP TABLE FOR MENTION DATA.
                            $tmp_mention_query .= 'SELECT ' . $tmp_SELECT_ARRAY[$i] . ' FROM `comm_stream_mention` WHERE 
                            `comm_stream_mention`.`STREAM_MENTION`="' . strtolower($oSTREAM_MGR->return_mention_data($i)) . '" AND 
                            `comm_stream_mention`.`STREAM_MENTION_CRC32`="' . crc32(strtolower($oSTREAM_MGR->return_mention_data($i))) . '" AND 
                            `comm_stream_mention`.`ISACTIVE`="1";';

                            if ($db_resp_profile_field_cnt == "") {
                                $db_resp_target_profiles = 'COMM_STREAM_MENTION_' . $i;
                                $db_resp_profile_field_cnt = '5';
                            } else {
                                $db_resp_target_profiles .= '|COMM_STREAM_MENTION_' . $i;
                                $db_resp_profile_field_cnt .= '|5';

                            }

                        }

                        //
                        // WE HAVE LOOKUP QUERY. WE SHOULD PROCESS OOP. THIS IS A SELECT WITH RESULT RETURN.
                        $force_profile_select_align = true;
                        $db_resp_process_serial = "jesus_is_lord!";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                        $db_resp_serial_key = 'COMM_STREAM';

                        $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt, $force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                        $oDB_RESP->process(self::$mysqli,$queryType,$tmp_SELECT_ARRAY,$tmp_mention_query);

                        //
                        // DB RESPONSE OBJ IS LOADED. NOW WE CAN BUILD THE SQL FOR MANAGING @MENTION NOTIFICATIONS
                        // NOW WE NEED TO GET USER PROFILE @MENTION HANDLE INTO THE DATABASE. WILL UPDATE THE USER PROFILE PAGE TO PERFORM THIS DATA MANIPULATION
                        $tmp_profile_array = explode("|", $db_resp_target_profiles);
                        #$tmp_loop_size_ARRAY = $oDB_RESP->return_sizeof($db_resp_process_serial, $tmp_profile_array[$i]);
                        #error_log("database (1199) running return_sizeof with tmp_profile_array->".$tmp_profile_array[0]);

                        # WHERE $tmp_loop_size_ARRAY[x] = # results returned by profile_x
                        // THIS COUNT REPRESENTS THE @MENTIONS ACTUALLY ENTERED INTO THE STREAM TEXTAREA AND COORELATES TO $oSTREAM_MGR->return_mention_data($i)

                        $tmp_loop_1_size = sizeof($tmp_profile_array);
                        for ($i = 0; $i < $tmp_loop_1_size; $i++) {
                            $tmp_resp_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial(), $tmp_profile_array[$i]);
                            $tmp_mention_check = true;

                            if($tmp_resp_size>0) {

                                $tmp_loop_size = $oDB_RESP->return_sizeof($db_resp_process_serial, $tmp_profile_array[$i]);
                                for ($ii = 0; $ii < $tmp_loop_size; $ii++) {

                                    if ($oSTREAM_MGR->mention_accounted($oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'USER_ID', $ii))) {
                                        $tmp_mention_check = false;
                                        error_log("database (1683) mention_accounted for USER_ID[" . $oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'USER_ID', $ii) . "] STREAM_MENTION[" . $i . "]->" . $oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'STREAM_MENTION', $ii));

                                    } else {
                                        //
                                        //

                                    }

                                }
                            }

                            //
                            // IF WE HAVE AN @MENTION, BUT NO DATABASE MATCH...
                            if($tmp_mention_check){

                                //
                                // WE HAVE AN @MENTION THAT WAS MANUALLY ENTERED (OR TYPO'D). TRY TO PROCESS MANUALLY...JUST THE SAME.
                                // THIS MENTION PROCESSING SHOULD HAPPEN BEFORE STREAM_CONTENT_STYLED IS PREPPED FOR DATABASE INSERTION
                                // LETS SEE IF THIS FIRES. WE WILL NOT HOOK ANYTHING UP HERE YET. BUT PLAN TO ALLOW FOR USER TO MANUALLY ENTER @MENTION FOR PROCESSING
                                // WE ARE READY TO HOOK UP BEST EFFORT MANUAL PROCESSING. THIS WILL MOST LIKELY CHECK MAYBE FIRST 5 CHARS OF @MENTION AGAINST ANY EID HIDDEN IN THE FORM...TO TRY TO GET USER_ID.
                                error_log("database (1684) we have custom entered @mention to process STREAM_MENTION[".$oSTREAM_MGR->return_mention_data($i)."] STREAM_MENTION[".$i."]");

                            }

                        }

                    }

                    */

                    self::$query .= 'INSERT INTO `log_sys_user` (`ACTIVITY_ID`,`CLIENT_ID`,`CLIENT_ID_CRC32`,`KIVOTOS_ID`,`KIVOTOS_ID_CRC32`,`USER_ID`,`USER_ID_CRC32`,
																 `ACTIVITY_DESCRIPTION`,`PHPSESSION`,`IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`) VALUES (
					"'.$tmp_activityid.'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'",
					"'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
					"'.$oUser->retrieve_Form_Data("KIVOTOS_ID").'",
					"'.$this->return_CRC32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
					"'.$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID').'",
					"'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
					"'.session_id().'",
					"'.$_SERVER['REMOTE_ADDR'].'",
					"'.$_SERVER['HTTP_USER_AGENT'].'",
					"'.strtoupper($oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")).'");';

                    $tmp_search_str = $oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME').$oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME').$tmp_activity_descript;

                    self::$query .= 'INSERT INTO `log_sys_user_search` (`SEARCH_ID`,
                    `SEARCH_CONTENT`,
                    `CLIENT_ID`,
                    `CLIENT_ID_CRC32`,
                    `USER_ID`,
                    `USER_ID_CRC32`,
                    `KIVOTOS_ID`,
                    `KIVOTOS_ID_CRC32`,
                    `STREAM_ID`,
                    `STREAM_ID_CRC32`,
                    `CONTENT_LENGTH`,`ACTIVITY_DESCRIPTION`)
                    VALUES
                    ("'.$tmp_activityid.'",
                     "'.self::$mysqli->real_escape_string(strtolower($oUser->searchCleanStr($tmp_search_str))).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
                    "'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
                    "'.$this->return_CRC32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
                    "'.self::$mysqli->real_escape_string($tmp_streamid).'",
                    "'.crc32($tmp_streamid).'",
                    "'.strlen($oUser->searchCleanStr($tmp_search_str)).'","'.self::$mysqli->real_escape_string($tmp_activity_descript).'");';

                    //
                    // OK, WE ARE NOW HOT WITH INSERTS
                    //error_log("database (1880) STREAM REPLY QUERY->".self::$query);
                    self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    #error_log("database (1125) query->".self::$query);
                    if(self::$mysqli->error){
                        self::$query_exception_result = "create_stream_reply=error=".self::$mysqli->error;
                        throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else{

                        do{
                        } while (self::$mysqli->more_results() && self::$mysqli->next_result());

                        //
                        // INCREMENT FEEDER_STREAM_COUNT FOR $oUser->retrieve_Form_Data("I_FEED_STREAM_ID")
                        $force_profile_select_align = true;
                        $db_resp_process_serial = "HALLELUJAH Christ is victor!";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                        $db_resp_serial_key = 'STREAM_COUNT';
                        $db_resp_target_profiles = 'STREAM';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                        $db_resp_profile_field_cnt = '1';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.
                        $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                        //
                        // QUERY CONSTRUCTION
                        $tmp_SELECT_ARRAY = array();
                        $tmp_SELECT_ARRAY[0] = '`comm_stream`.`FEEDER_STREAM_COUNT`';

                        self::$query = 'SELECT '.$tmp_SELECT_ARRAY[0].' FROM `comm_stream` WHERE `comm_stream`.`STREAM_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("I_FEED_STREAM_ID")).'" AND `comm_stream`.`STREAM_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("I_FEED_STREAM_ID")).'" LIMIT 1;';

                        $oDB_RESP->process(self::$mysqli,$queryType,$tmp_SELECT_ARRAY,self::$query);

                        $tmp_count = $oDB_RESP->return_data_element($oDB_RESP->return_serial('STREAM_COUNT'), 'STREAM', 'FEEDER_STREAM_COUNT');
                        $tmp_count++;

                        //error_log("database (2667) new feeder stream count=[".$tmp_count."] for this stream");

                        self::$query = 'UPDATE `comm_stream`
                        SET
                        `FEEDER_STREAM_COUNT` = "'.self::$mysqli->real_escape_string($tmp_count).'",
                        `DATEMODIFIED` = "'.$ts.'"
                        WHERE `STREAM_ID` = "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("I_FEED_STREAM_ID")).'" AND `STREAM_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("I_FEED_STREAM_ID")).'" LIMIT 1;
                        ';

                        self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);

                        if(self::$mysqli->error){
                            self::$query_exception_result = "error";
                            throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                        }else {

                            do{
                            } while (self::$mysqli->more_results() && self::$mysqli->next_result());

                            //
                            // BRING IN THE MESSENGER
                            // Luke 1:19, 26; Daniel 8:16; 9:21-22
                            $oGabriel = new messenger_from_north($this, $oUser, $oUserEnvironment, $oDB_RESP);
                            $oGabriel->scroll_messages($queryType);
                            $oGabriel->deliver_scroll();

                            return "success";

                        }
                    }

                break;
                case 'create_stream':   // THIS IS CURRENTLY KIVOTOS SPECIFIC. WILL NEED TO CONSIDER MAKING MORE FLEXIBLE.
                    $tmp_activityid = $oUser->generateNewKey(70);
                    $tmp_streamid = $oUser->generateNewKey(100);
                    $tmp_searchid = $oUser->generateNewKey(70);

                    //
                    // I NEED TO REVAMP THIS REMOVING KIVOTOS CENTRALITIY. WE MAY NOT HAVE KIVOTOS DATA EVERYTIME...LIKE IF STREAM SUBMITTED FROM USER PROFILE PAGE...
                    // I'M READY FOR A BEER. GOING TO CALL THIS SESSION COMPLETE NOW THAT WE HAVE GOOD UI FLOW FOR STREAM REPLY PROCESSING. AJAX INJECTION WOULD BE
                    // THE SLICKEST THOUGH...   :)

                    /*self::$http_param_handle["CLIENT_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'cid'));
                    self::$http_param_handle["STREAM_TYPE"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'st'));
                    self::$http_param_handle["KIVOTOS_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'kid'));
                    self::$http_param_handle["STREAM_CONTENT"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'stream');*/

                    //
                    // THIS WOULD BE OUR FIRST CHANCE TO STYLE THE STREAM CONTENT. BUT WE STILL NEED TO PROCESS IT. MIGHT AS WELL HANDLE @MENTION AND HYPER LINK AT SAME TIME.
                    // CREATE SITUATION THAT CAN BE EVOKED AT RANDOM. E.G.
                    // CAN I CONSIDER A SCRIPTURAL THEME FOR CONTENT FORMATTING...THAT WOULD BE CHALLENGING PERHAPS...[sealing,transformation,inscribing,]

                    //
                    // SOMETHING LIKE THIS SHOULD HAPPEN HERE...THE THING IS...WE ARE MAKING DATABASE MOVES HERE. IF THERE
                    // IS AN ERROR LATER...WE HAVE HOMELESS DATA? ALL DATA SHOULD BE HANDLED TOGETHER IF POSSIBLE...
                    // I DON'T THINK THIS SHOULD BE SO BROAD. VERY SPECIFIC. LINKS, EXTERNAL LINKS (NEED TO BE
                    // PROXIED), AND @MENTION LINKING APPLIED TO PROVIDED CONTENT.
                    // WE WILL BUILD THE QUERY NEEDED TO EXECUTE THE HYPER-LINKING OF CONTENT HERE (THERE MAY
                    // BE DB INTERACTION TO BUILD OUT THE SQL)...THEN PASS IT IN THROUGH self::$http_param_handle
                    //
                    // WE MAY MOVE THIS. THE COMPONENT IS FOR CONTENT PREP FOR DATABASE INSERTION. CAN GO WITH DATABASE EVERYTIME.
                    $oInputTransformer = new transformer($oUserEnvironment, $this, $oUser);
                    $tmp_content_format_ARRAY = $oInputTransformer->returnTransformedInput('LINKS', $oUser->retrieve_Form_Data("STREAM_CONTENT"));  // 2 DIM ARRAY RETURN

                    // * WHERE RETURN array() = {'QUERY'=>'INSERT...', 'STYLED_CONTENT'=>'QWERTY1234567890'}
                    // * REMEMBER...HANDLE LINKS, EXTERNAL LINKS (NEED TO BE PROXIED), AND @MENTION LINKING TO PROFILES. DO WE WANT @CLIENT MENTIONS? WITH "GLOBAL" NOTIFICATIONS?
                    //error_log("database (2148) feature - @client mentions + client notifications");

                    //
                    // BUILD SQL @MENTION NOTIFICATION QUEUE. WILL NEED TO KEY USER AGAINST @NAMENAME.
                    // SHOULD STREAM @MENTIONS BE BUBBLED UP ON THE USER PROFILE PAGE? MAYBE A MENTIONS SECTION. THIS WOULD BE FIRST TIER NOTIFICATION.
                    // THIS WILL TAKE SOME TIME RIGHT HERE. LET ME PLAY AROUND WITH IDEAS...
                    // I COULD MOVE THIS UP TO THE TOP AND THEN WITHIN THE STREAM CLASS...PROCESS LINKS...BUT THIS FUNCTIONALITY
                    // NEEDS TO COVER KIVOTOS DESCRIPTIONS, ASSET DESCRIPTIONS, ETC. SO COUPLING THIS WITH stream_manager IS NOT BEST PATTERN.
                    $oSTREAM_MGR = new stream_manager($oUserEnvironment, $oUser);

                    // INTERNALIZE CONTENT DATA PROFILE
                    //error_log("database (3483) process_mention_input() [".$oUser->retrieve_Form_Data("STREAM_MENTIONS_EID")."]");
                    $oSTREAM_MGR->process_mention_input($oUser->retrieve_Form_Data("STREAM_CONTENT"),$oUser->retrieve_Form_Data("STREAM_MENTIONS_EID"));
                    //error_log("database (3485) process_mention_input() complete. Count=[".$oSTREAM_MGR->return_mention_count()."]");

                    //
                    // IS THERE ANYTHING ELSE (TAGS, SYMBOLS, EXPRESSIONS, @MENTIONS[DONE]) WHICH COULD BE CONTAINED IN A STREAM AND PROCESSED?
                    # LINKS (SHOULD WE PROXY? I THINK SO)
                    # FROM ASSET PREVIEW PAGE...STREAM INSERT OF ASSET LINK?..WELL, IF SOMEONE WAS @MENTIONED IN A STREAM
                    # AND RECEIVED AN EMAIL NOTICE, THE ASSET LINK WOULD BE IN THE EMAIL

                    //
                    // THIS WILL SUPPORT MANUAL @MENTION ENTRY BY USER.
                    $tmp_loop_size = $oSTREAM_MGR->return_mention_count();
                    $db_resp_profile_field_cnt = '';
                    $tmp_mention_query = "";
                    if($tmp_loop_size>0) {
                        for ($i = 0; $i < $tmp_loop_size; $i++) {

                            $tmp_SELECT_ARRAY[$i] = '`comm_stream_mention`.`STREAM_MENTION`,
                                `comm_stream_mention`.`USER_ID`,
                                `comm_stream_mention`.`ISACTIVE`,
                                `comm_stream_mention`.`DATEMODIFIED`,
                                `comm_stream_mention`.`DATECREATED`';

                            //
                            // LET'S BUILD THE QUERY FOR EXTRACTING USER DATA BASED ON @MENTION.
                            // THIS NEEDS TO BE FAST. SO WILL NEED TO SETUP/MANAGE USER LOOKUP TABLE FOR MENTION DATA.
                            $tmp_mention_query .= 'SELECT ' . $tmp_SELECT_ARRAY[$i] . ' FROM `comm_stream_mention` WHERE 
                            `comm_stream_mention`.`STREAM_MENTION`="' . strtolower($oSTREAM_MGR->return_mention_data($i)) . '" AND 
                            `comm_stream_mention`.`STREAM_MENTION_CRC32`="' . crc32(strtolower($oSTREAM_MGR->return_mention_data($i))) . '" AND 
                            `comm_stream_mention`.`ISACTIVE`="1";';

                            if ($db_resp_profile_field_cnt == "") {
                                $db_resp_target_profiles = 'COMM_STREAM_MENTION_' . $i;
                                $db_resp_profile_field_cnt = '5';
                            } else {
                                $db_resp_target_profiles .= '|COMM_STREAM_MENTION_' . $i;
                                $db_resp_profile_field_cnt .= '|5';

                            }

                        }

                        //
                        // WE HAVE LOOKUP QUERY. WE SHOULD PROCESS OOP. THIS IS A SELECT WITH RESULT RETURN.
                        $force_profile_select_align = true;
                        $db_resp_process_serial = "jesus_is_lord!";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                        $db_resp_serial_key = 'COMM_STREAM';

                        $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt, $force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                        $oDB_RESP->process(self::$mysqli,$queryType,$tmp_SELECT_ARRAY,$tmp_mention_query);

                        //
                        // DB RESPONSE OBJ IS LOADED. NOW WE CAN BUILD THE SQL FOR MANAGING @MENTION NOTIFICATIONS
                        // NOW WE NEED TO GET USER PROFILE @MENTION HANDLE INTO THE DATABASE. WILL UPDATE THE USER PROFILE PAGE TO PERFORM THIS DATA MANIPULATION
                        $tmp_profile_array = explode("|", $db_resp_target_profiles);
                        #$tmp_loop_size_ARRAY = $oDB_RESP->return_sizeof($db_resp_process_serial, $tmp_profile_array[$i]);
                        #error_log("database (1199) running return_sizeof with tmp_profile_array->".$tmp_profile_array[0]);

                        # WHERE $tmp_loop_size_ARRAY[x] = # results returned by profile_x
                        // THIS COUNT REPRESENTS THE @MENTIONS ACTUALLY ENTERED INTO THE STREAM TEXTAREA AND COORELATES TO $oSTREAM_MGR->return_mention_data($i)

                        $tmp_loop_1_size = sizeof($tmp_profile_array);
                        for ($i = 0; $i < $tmp_loop_1_size; $i++) {
                            $tmp_resp_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial(), $tmp_profile_array[$i]);
                            $tmp_mention_check = true;

                            if($tmp_resp_size>0) {

                                $tmp_loop_size = $oDB_RESP->return_sizeof($db_resp_process_serial, $tmp_profile_array[$i]);
                                for ($ii = 0; $ii < $tmp_loop_size; $ii++) {

                                    if ($oSTREAM_MGR->mention_accounted($oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'USER_ID', $ii))) {
                                        $tmp_mention_check = false;
                                        #error_log("database (2235) mention_accounted for USER_ID[" . $oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'USER_ID', $ii) . "] STREAM_MENTION[" . $i . "]->" . $oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'STREAM_MENTION', $ii));
                                        #error_log("database (2236) hyper link @mention[".$oSTREAM_MGR->return_mention_case($oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'STREAM_MENTION', $ii))."] to user_id[".$oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'USER_ID', $ii)."]");
                                        $oInputTransformer->queueMentionForTransform($oSTREAM_MGR->return_mention_case($oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'STREAM_MENTION', $ii)),$oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'USER_ID', $ii));
                                    }
                                }
                            }

                            //
                            // IF WE HAVE AN @MENTION, BUT NO DATABASE MATCH...
                            if($tmp_mention_check){

                                //
                                // WE HAVE AN @MENTION THAT WAS MANUALLY ENTERED (OR TYPO'D). TRY TO PROCESS MANUALLY...JUST THE SAME.
                                // THIS MENTION PROCESSING SHOULD HAPPEN BEFORE STREAM_CONTENT_STYLED IS PREPPED FOR DATABASE INSERTION
                                // LETS SEE IF THIS FIRES. WE WILL NOT HOOK ANYTHING UP HERE YET. BUT PLAN TO ALLOW FOR USER TO MANUALLY ENTER @MENTION FOR PROCESSING
                                // WE ARE READY TO HOOK UP BEST EFFORT MANUAL PROCESSING. THIS WILL MOST LIKELY CHECK MAYBE FIRST 5 CHARS OF @MENTION AGAINST ANY EID HIDDEN IN THE FORM...TO TRY TO GET USER_ID.
                                #error_log("database (1684) we have custom entered @mention to process STREAM_MENTION[".$oSTREAM_MGR->return_mention_data($i)."] STREAM_MENTION[".$i."]");
                                //error_log("database (3884) we need to try to hyperlink mention[".$oSTREAM_MGR->return_mention_data($i)."]");
                                $tmp_mention_array = $this->find_mention_userid($oUserEnvironment, $oSTREAM_MGR->return_mention_data($i));

                                if($tmp_mention_array[0][0]!=""){
                                    //error_log("database (3888) queue custom mention ".$tmp_mention_array[0][1]);
                                    $oInputTransformer->queueMentionForTransform($tmp_mention_array[0][1], $tmp_mention_array[0][0]);

                                }

                            }

                        }

                    }

                    //
                    // APPLY FORMATTING TO STREAM CONTENT. THIS WOULD NEED TO HAPPEN ALSO FOR ANY DESCRIPTIONS SENT TO EXTRANET
                    $tmp_formatted_content = $tmp_content_format_ARRAY['STYLED_CONTENT'];  // GET LINKED CONTENT (PROXY AND INTERNAL)
                    $tmp_formatted_content = $oInputTransformer->transform_mentions($tmp_formatted_content);

                    //
                    // DATA AUGMENTATION PER STREAM_TYPE
                    switch($oUser->retrieve_Form_Data("STREAM_TYPE")){
                        case 'KIVOTOS':
                            $ID_ARRAY[0] = $oUser->retrieve_Form_Data("KIVOTOS_ID");
                            $IDTYPE_ARRAY[0] = "KIVOTOS";

                            $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                            $dataAugmenter = new dataAugmentation(self::$mysqli,$oUserEnvironment,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);
                            #$dataAugmenter = new dataAugmentation(self::$mysqli,$oUserEnvironment,$ID_ARRAY,$IDTYPE_ARRAY);

                            $tmp_activity_descript = "A stream has been created within the kivot&oacute;s (<span class='a_log_topic_name'>".$dataAugmenter->getData('KIVOTOS',0,'NAME')."</span>) with the content [".$tmp_formatted_content."].";

                        break;
                        case 'ASSET':
                            $ID_ARRAY[0] = $oUser->retrieve_Form_Data("ASSET_ID");
                            $IDTYPE_ARRAY[0] = "ASSET";

                            $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                            $dataAugmenter = new dataAugmentation(self::$mysqli,$oUserEnvironment,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                            $tmp_activity_descript = "A stream has been created for the asset (<span class='a_log_topic_name'>".$dataAugmenter->getData('ASSET',0,'NAME')."</span>) with the content [".$tmp_formatted_content."].";

                        break;
                        case 'USER':
                        case 'CLIENT':
                        case 'LANG':
                            error_log('database (2251) need definition here...die().');
                            die();
                            break;
                        default:

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('We are running create_stream, but the provided stream type for this communication ['.$oUser->retrieve_Form_Data("STREAM_TYPE").'] is unknown.');

                            break;

                    }

                    //
                    // BUILD SQL INSERT INTO comm_stream
                    // STREAM_FORMATTED NEEDS TO BE STYLED BY NOW. WE NEED IT HERE.
                    self::$query = $tmp_content_format_ARRAY['QUERY'];
                    self::$query .= 'INSERT INTO `comm_stream` (`STREAM_ID`, `STREAM_ID_CRC32`, `STREAM_TYPE`, `STREAM_TYPE_CRC32`, `CLIENT_ID`, `CLIENT_ID_CRC32`,`USER_ID`, `USER_ID_CRC32`, `KIVOTOS_ID`, `KIVOTOS_ID_CRC32`, `ASSET_ID`, `ASSET_ID_CRC32`, `STREAM_CONTENT`, `STREAM_FORMATTED`, `DATEMODIFIED`)
                    VALUES
                    ("'.$tmp_streamid.'",
                    "'.crc32($tmp_streamid).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("STREAM_TYPE")).'",
                    "'.crc32($oUser->retrieve_Form_Data("STREAM_TYPE")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
                    "'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
                    "'.$this->return_CRC32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ASSET_ID")).'",
                    "'.$this->return_CRC32($oUser->retrieve_Form_Data("ASSET_ID")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("STREAM_CONTENT")).'",
                    "'.self::$mysqli->real_escape_string($tmp_formatted_content).'",
                    "'.$ts.'");';

                    //
                    // BUILD SQL INSERT INTO comm_stream_flow
                    self::$query .= 'INSERT INTO `comm_stream_flow` (`CLIENT_ID`, `CLIENT_ID_CRC32`, `STREAM_ID`, `STREAM_ID_CRC32`, `FEEDER_STREAM_ID`, `FEEDER_STREAM_ID_CRC32`)
                    VALUES
                    ("'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.$tmp_streamid.'",
                    "'.crc32($tmp_streamid).'",
                    "'.$tmp_streamid.'",
                    "'.crc32($tmp_streamid).'");';

                    //
                    // BUILD SQL INSERT INTO comm_stream_search_kivotos
                    $tmp_search_content = $oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME').$oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME').$oUser->retrieve_Form_Data("STREAM_CONTENT");
                    self::$query .= 'INSERT INTO `comm_stream_search` (`SEARCH_ID`, `SEARCH_CONTENT`,`STREAM_TYPE`,`CLIENT_ID`, `CLIENT_ID_CRC32`,`USER_ID`, `USER_ID_CRC32`, `KIVOTOS_ID`, `KIVOTOS_ID_CRC32`, `ASSET_ID`, `ASSET_ID_CRC32`, `CONTENT_LENGTH`, `DATEMODIFIED`)
                    VALUES
                    ("'.$tmp_searchid.'",
                    "'.self::$mysqli->real_escape_string(strtolower($oUser->searchCleanStr($tmp_search_content))).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("STREAM_TYPE")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
                    "'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
                    "'.$this->return_CRC32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ASSET_ID")).'",
                    "'.$this->return_CRC32($oUser->retrieve_Form_Data("ASSET_ID")).'",
                    "'.strlen($oUser->searchCleanStr($tmp_search_content)).'",
                    "'.$ts.'");';

                    self::$query .= 'INSERT INTO `log_sys_user` (`ACTIVITY_ID`,`CLIENT_ID`,`CLIENT_ID_CRC32`,`KIVOTOS_ID`,`KIVOTOS_ID_CRC32`, `ASSET_ID`, `ASSET_ID_CRC32`,`USER_ID`,`USER_ID_CRC32`,
																 `ACTIVITY_DESCRIPTION`,`PHPSESSION`,`IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`) VALUES (
					"'.$tmp_activityid.'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'",
					"'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
					"'.$oUser->retrieve_Form_Data("KIVOTOS_ID").'",
					"'.$this->return_CRC32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ASSET_ID")).'",
                    "'.$this->return_CRC32($oUser->retrieve_Form_Data("ASSET_ID")).'",
					"'.$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID').'",
					"'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
					"'.session_id().'",
					"'.$_SERVER['REMOTE_ADDR'].'",
					"'.$_SERVER['HTTP_USER_AGENT'].'",
					"'.strtoupper($oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")).'");';

                    $tmp_search_str = $oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME').$oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME').$tmp_activity_descript;

                    self::$query .= 'INSERT INTO `log_sys_user_search` (`SEARCH_ID`,
                    `SEARCH_CONTENT`,
                    `CLIENT_ID`,
                    `CLIENT_ID_CRC32`,
                    `USER_ID`,
                    `USER_ID_CRC32`,
                    `KIVOTOS_ID`,
                    `KIVOTOS_ID_CRC32`,
                    `ASSET_ID`, 
                    `ASSET_ID_CRC32`,
                    `STREAM_ID`,
                    `STREAM_ID_CRC32`,
                    `CONTENT_LENGTH`,`ACTIVITY_DESCRIPTION`)
                    VALUES
                    ("'.$tmp_activityid.'",
                     "'.self::$mysqli->real_escape_string(strtolower($oUser->searchCleanStr($tmp_search_str))).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
                    "'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
                    "'.$this->return_CRC32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ASSET_ID")).'",
                    "'.$this->return_CRC32($oUser->retrieve_Form_Data("ASSET_ID")).'",
                    "'.self::$mysqli->real_escape_string($tmp_streamid).'",
                    "'.crc32($tmp_streamid).'",
                    "'.strlen($oUser->searchCleanStr($tmp_search_str)).'","'.self::$mysqli->real_escape_string($tmp_activity_descript).'");';

                    //
                    // OK, WE ARE NOW HOT WITH INSERTS
                    self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    #error_log("database (1125) query->".self::$query);
                    if(self::$mysqli->error){
                        self::$query_exception_result = "create_stream=error=".self::$mysqli->error;
                        throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else{

                        do{
                        } while (self::$mysqli->more_results() && self::$mysqli->next_result());

                        $oUser->save_Form_Data('MENTION_ARRAY', $oInputTransformer->return_mention_id());
                        $oUser->save_Form_Data('STREAM_ID', $tmp_streamid);

                        //
                        // BRING IN THE MESSENGER
                        // Luke 1:19, 26; Daniel 8:16; 9:21-22
                        $oGabriel = new messenger_from_north($this, $oUser, $oUserEnvironment, $oDB_RESP);
                        $oGabriel->scroll_messages($queryType);
                        $oGabriel->deliver_scroll();

                        return "success";
                    }


                break;
                case 'create_child_kivotos':

                    $tmp_activityid = $oUser->generateNewKey(70);
                    $tmp_relationid = $oUser->generateNewKey(70);
                    $tmp_searchid = $oUser->generateNewKey(70);
                    $tmp_childkivotosid = $oUser->generateNewKey(70);

                    $ID_ARRAY[0] = $oUser->retrieve_Form_Data("PARENT_KIVOTOS_ID");
                    $IDTYPE_ARRAY[0] = "KIVOTOS";

                    $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                    $dataAugmenter = new dataAugmentation(self::$mysqli,$oUserEnvironment,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);
                    #$dataAugmenter = new dataAugmentation(self::$mysqli,$oUserEnvironment,$ID_ARRAY,$IDTYPE_ARRAY);

                    $tmp_activity_descript = "A child kivot&oacute;s (<span class='a_log_topic_name'>".$oUser->retrieve_Form_Data('NAME')."</span>) has been created within the parent kivot&oacute;s, <span class='a_log_asset_kivotos'>".$dataAugmenter->getData('KIVOTOS',0,'NAME')."</span>.";

                    //
                    // WE STILL NEED TO DECIDE IF CHILD KIVOTOS WILL SHOW UP IN MAIN DASHBOARD RETURN. MAYBE GIVE OPTION TO SHOW/HIDE... BUT WE DO WANT CHILDREN TO SHOW
                    // UP IN SEARCH RESULTS...SO LOOKS LIKE WE NEED TO FLAG CHILDREN IN THE DB.

                    //
                    // FORMAT LINKS AND MENTIONS IN DESCRIPTION
                    $oInputTransformer = new transformer($oUserEnvironment, $this, $oUser);
                    $tmp_content_format_ARRAY = $oInputTransformer->returnTransformedInput('LINKS', $oUser->retrieve_Form_Data("DESCRIPTION"));  // 2 DIM ARRAY RETURN

                    $tmp_formatted_content = $tmp_content_format_ARRAY['STYLED_CONTENT'];  // GET LINKED CONTENT (PROXY AND INTERNAL)

                    //
                    // PROCESS MENTIONS
                    $oInputTransformer = $this->process_mentions($tmp_formatted_content, $oUser, $oUserEnvironment, $oDB_RESP, $oInputTransformer, $oUser->retrieve_Form_Data("STREAM_MENTIONS_EID"), $queryType);

                    $tmp_formatted_content = $oInputTransformer->formatted_content;

                    self::$query = $tmp_content_format_ARRAY['QUERY'];
                    self::$query .= 'INSERT INTO `kivotos` (`KIVOTOS_ID`,`KIVOTOS_ID_CRC32`,`CLIENT_ID`,`CLIENT_ID_CRC32`,`IS_CHILD`,`CREATOR_ID`,`CREATOR_ID_CRC32`,`ASSIGNED_ID`,`ASSIGNED_ID_CRC32`,`SEARCH_ID`,`ISPRIVATE`,
														   `NAME`,`DESCRIPTION`,`DESCRIPTION_RAW`,`DATEMODIFIED`) VALUES (
					"'.$tmp_childkivotosid.'",
					"'.crc32($tmp_childkivotosid).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'",
					"'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
					"1",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
					"'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ASSIGN_USERID")).'",
					"'.crc32($oUser->retrieve_Form_Data("ASSIGN_USERID")).'",
					"'.$tmp_searchid.'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ISPRIVATE")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("NAME")).'",
					"'.self::$mysqli->real_escape_string($tmp_formatted_content).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("DESCRIPTION")).'",
					"'.$ts.'");';


                    /*["PARENT_KIVOTOS_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'pkid'));
        self::$http_param_handle["CLIENT_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'cid'));
        self::$http_param_handle["ISOCODE"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'ic'));
        self::$http_param_handle["ASSIGN_USERID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'user_assign'));

        self::$http_param_handle["ISPRIVATE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'isprivate');
        self::$http_param_handle["DESCRIPTION"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'description');
        self::$http_param_handle["NAME"]*/

                    //
                    // NOW WE NEED TO DESIGN THE DATA STRUCTS TO HOLD THIS DATA.
                    // LET ME SEE IF I CAN RENAME AN INDEX...WILL FO THAT LATER...
                    self::$query .= 'INSERT INTO `kivotos_relation`
                    (`RELATION_ID`,
                    `CLIENT_ID`,
                    `CLIENT_ID_CRC32`,
                    `P_KIVOTOS_ID`,
                    `P_KIVOTOS_ID_CRC32`,
                    `C_KIVOTOS_ID`,
                    `C_KIVOTOS_ID_CRC32`,
                    `DATEMODIFIED`)
                    VALUES
                    ("'.$tmp_relationid.'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("PARENT_KIVOTOS_ID")).'",
                    "'.crc32($oUser->retrieve_Form_Data("PARENT_KIVOTOS_ID")).'",
                    "'.$tmp_childkivotosid.'",
                    "'.crc32($tmp_childkivotosid).'",
                    "'.$ts.'");';

                    self::$query .= 'INSERT INTO `kivotos_search` (`SEARCH_ID`,`SEARCH_CONTENT`,`CLIENT_ID`,`CLIENT_ID_CRC32`,`CONTENT_LENGTH`,`KIVOTOS_ID`,`NAME`,`DESCRIPTION`,`DATEMODIFIED`) VALUES (
					"'.$tmp_searchid.'",
					"'.self::$mysqli->real_escape_string(strtolower($oUser->searchCleanStr($oUser->retrieve_Form_Data("NAME").$oUser->retrieve_Form_Data("DESCRIPTION")))).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'",
					"'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
					"'.strlen($oUser->searchCleanStr($oUser->retrieve_Form_Data("NAME").$oUser->retrieve_Form_Data("DESCRIPTION"))).'",
					"'.$tmp_childkivotosid.'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("NAME")).'",
					"'.self::$mysqli->real_escape_string($tmp_formatted_content).'",
					"'.$ts.'");';

                    self::$query .= 'INSERT INTO `log_sys_user` (`ACTIVITY_ID`,`CLIENT_ID`,`CLIENT_ID_CRC32`,`KIVOTOS_ID`,`KIVOTOS_ID_CRC32`,`USER_ID`,`USER_ID_CRC32`,
																 `ACTIVITY_DESCRIPTION`,`PHPSESSION`,`IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`) VALUES (
					"'.$tmp_activityid.'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'",
					"'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
					"'.$tmp_childkivotosid.'",
					"'.crc32($tmp_childkivotosid).'",
					"'.$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID').'",
					"'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
					"'.session_id().'",
					"'.$_SERVER['REMOTE_ADDR'].'",
					"'.$_SERVER['HTTP_USER_AGENT'].'",
					"'.strtoupper($oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")).'");';

                    $tmp_search_str = $oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME').$oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME').$tmp_activity_descript;
                    self::$query .= 'INSERT INTO `log_sys_user_search` (`SEARCH_ID`,
                    `SEARCH_CONTENT`,
                    `CLIENT_ID`,
                    `CLIENT_ID_CRC32`,
                    `USER_ID`,
                    `USER_ID_CRC32`,
                    `KIVOTOS_ID`,
                    `KIVOTOS_ID_CRC32`,
                    `CONTENT_LENGTH`,`ACTIVITY_DESCRIPTION`)
                    VALUES
                    ("'.$tmp_activityid.'",
                     "'.self::$mysqli->real_escape_string(strtolower($oUser->searchCleanStr($tmp_search_str))).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
                    "'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
                    "'.self::$mysqli->real_escape_string($tmp_childkivotosid).'",
                    "'.crc32($tmp_childkivotosid).'",
                    "'.strlen($oUser->searchCleanStr($tmp_search_str)).'","'.self::$mysqli->real_escape_string($tmp_activity_descript).'");';

                    self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        self::$query_exception_result = "create_child_kivotos=error=".self::$mysqli->error;
                        throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else{

                        do{
                        } while (self::$mysqli->more_results() && self::$mysqli->next_result());

                        //
                        // BRING IN THE MESSENGER
                        // Luke 1:19, 26; Daniel 8:16; 9:21-22
                        $oGabriel = new messenger_from_north($this, $oUser, $oUserEnvironment, $oDB_RESP);
                        $oGabriel->scroll_messages($queryType);
                        $oGabriel->deliver_scroll();

                        return "kid=".$tmp_childkivotosid;
                    }


                break;
				case 'get_asset_system_data':
					self::$query = 'SELECT `file_system_reporting`.`STORAGE_ID`,
					    `file_system_reporting`.`CLIENT_ID`,
					    `file_system_reporting`.`FILE_EXT`,
					    `file_system_reporting`.`DOWNLOAD_END_POINT`,
					    `file_system_reporting`.`CUM_FILE_SIZE`,
					    `file_system_reporting`.`DATEMODIFIED`,
					    `file_system_reporting`.`DATECREATED`
					FROM `file_system_reporting`;';

					self::$query .= 'SELECT `clients`.`CLIENT_ID`, `clients`.`COMPANYNAME_BLOB`, `clients`.`LANGCODE`, `clients`.`DATECREATED`  FROM `clients` WHERE
					`clients`.`ISACTIVE`="1";';

					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
					//
					// CLEAR RESULT ARRAY
					array_splice(self::$result_ARRAY, 0);
					
					$ROWCNT=0;
					do {
						if (self::$result = self::$mysqli->store_result()) {
							while ($row = self::$result->fetch_row()) {
								foreach($row as $fieldPos=>$value){
									//
									// STORE RESULT
									self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
									
								}
								$ROWCNT++;
							}
							self::$result->free();
						}
				
						if (self::$mysqli->more_results()) {
							//
							// END OF RECORD. MORE TO FOLLOW.
						}
					} while (self::$mysqli->more_results() && self::$mysqli->next_result());
			
					return self::$result_ARRAY;

				break;
				case 'sync_asset_storage_reporting':
					
					//
					// GET COPIES OF ARRAY DATA FOR SQL BUILD.
					$tmp_reportingCumData = $oAssetMgr->returnArrayStruct('reportingCumData');
					$tmp_assetLogData = $oAssetMgr->returnArrayStruct('assetLogData');
					$tmp_flagUpdated = $oAssetMgr->returnArrayStruct('flagUpdated');
					$tmp_reportingSysData = $oAssetMgr->returnArrayStruct('reportingSysData');
					$tmp_flagQuery = $oAssetMgr->returnArrayStruct('flagQuery');
					$tmp_reportingSysDataUpdateFlag = $oAssetMgr->returnArrayStruct('reportingSysDataUpdateFlag');

					self::$query = "";
					
					//
					// SYNC QUERY
					foreach($tmp_flagQuery as $data=>$set){
						
						$tmp_data = explode("|", $data);
						#['DOWNLOAD_END_POINT']['CLIENT_ID']['FILE_EXT']
						error_log("database (182) flagUpdated value->".$tmp_flagUpdated[$tmp_data[0]][$tmp_data[1]][$tmp_data[2]]);
						
						#if($tmp_reportingCumData[$tmp_data[0]][$tmp_data[1]][$tmp_data[2]]==1){
						if($tmp_reportingSysDataUpdateFlag[$tmp_data[0]][$tmp_data[1]][$tmp_data[2]]==1){
							
							//
							// WE NEED UPDATE STATEMENT
							error_log("database (142) update statement file size");
							self::$query .= 'UPDATE `file_system_reporting`
							SET
							`CUM_FILE_SIZE` = "'.self::$mysqli->real_escape_string($tmp_reportingCumData[$tmp_data[0]][$tmp_data[1]][$tmp_data[2]]).'",
							`DATEMODIFIED` = "'.$ts.'"
							WHERE `CLIENT_ID` = "'.self::$mysqli->real_escape_string($tmp_data[1]).'" AND 
							`FILE_EXT` = "'.self::$mysqli->real_escape_string($tmp_data[2]).'" AND 
							`DOWNLOAD_END_POINT` = "'.self::$mysqli->real_escape_string($tmp_data[0]).'" LIMIT 1;
							';


						}else{
							
							$tmp_storageid = $oUser->generateNewKey(50);
							
							//
							// WE NEED INSERT STATEMENT
							error_log("database (147) INSERT statement file size");
							self::$query .= 'INSERT INTO `file_system_reporting`(`STORAGE_ID`,`CLIENT_ID`,`FILE_EXT`,`DOWNLOAD_END_POINT`,`CUM_FILE_SIZE`,`DATEMODIFIED`) VALUES
							("'.$tmp_storageid.'",
							"'.$tmp_data[1].'",
							"'.$tmp_data[2].'",
							"'.$tmp_data[0].'",
							"'.$tmp_reportingCumData[$tmp_data[0]][$tmp_data[1]][$tmp_data[2]].'",
							"'.$ts.'");';
							
						}
						
					}
					
					error_log("database (223) query->".self::$query);
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
					if(self::$mysqli->error){
						self::$query_exception_result = "sync_asset_storage_reporting=error=".self::$mysqli->error;
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}else{


						array_splice(self::$result_ARRAY, 0);
					
						$ROWCNT=0;
						do {
							if (self::$result = self::$mysqli->store_result()) {
								while ($row = self::$result->fetch_row()) {
									foreach($row as $fieldPos=>$value){
										//
										// STORE RESULT
										#self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
										
									}
									$ROWCNT++;
								}
								self::$result->free();
							}
					
							if (self::$mysqli->more_results()) {
								//
								// END OF RECORD. MORE TO FOLLOW.
							}
						} while (self::$mysqli->more_results() && self::$mysqli->next_result());


						self::$query = '';
						
						//
						// UPDATE FILE SYSTEM ACTIVITY LOG FOR SUCCESS
						$tmp_loop_size = sizeof($tmp_assetLogData);
						for($i=0;$i<$tmp_loop_size;$i++){
							//
							// BUILD QUERY TO UPDATE LOGS WITH SYNC STATUS
							self::$query .= 'UPDATE `file_system_activity_log`
							SET
							`ISACTIVE` = "0",
							`DATEMODIFIED` = "'.$ts.'"
							WHERE `LOG_ID` = "'.$tmp_assetLogData[$i]['LOG_ID'].'" AND
							`ISACTIVE` = "1" LIMIT 1;
							';
							
						}
						
						error_log("database (246) update log query->".self::$query);
						self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
						if(self::$mysqli->error){
							self::$query_exception_result = "sync_asset_storage_reporting=error=".self::$mysqli->error;
							throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
						
						}else{

							return "success";
						}
						
					}
					
					
				break;
				case 'init_file_storage_report_sync':
					self::$query = 'SELECT `file_system_reporting`.`STORAGE_ID`,
						`file_system_reporting`.`CLIENT_ID`,
						`file_system_reporting`.`FILE_EXT`,
						`file_system_reporting`.`DOWNLOAD_END_POINT`,
						`file_system_reporting`.`CUM_FILE_SIZE`,
						`file_system_reporting`.`DATEMODIFIED`,
						`file_system_reporting`.`DATECREATED`
					FROM `file_system_reporting`;
					';
					
					self::$query .= 'SELECT `file_system_activity_log`.`LOG_ID`,
						`file_system_activity_log`.`ISACTIVE`,
						`file_system_activity_log`.`CLIENT_ID`,
						`file_system_activity_log`.`KIVOTOS_ID`,
						`file_system_activity_log`.`USER_ID`,
						`file_system_activity_log`.`ASSET_ID`,
						`file_system_activity_log`.`DOWNLOAD_END_POINT`,
						`file_system_activity_log`.`FILE_EXT`,
						`file_system_activity_log`.`FILE_SIZE`,
						`file_system_activity_log`.`DATEMODIFIED`,
						`file_system_activity_log`.`DATECREATED`
					FROM `file_system_activity_log` WHERE `file_system_activity_log`.`ISACTIVE`="1";';
					
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
					//
					// CLEAR RESULT ARRAY
					array_splice(self::$result_ARRAY, 0);
					
					$ROWCNT=0;
					do {
						if (self::$result = self::$mysqli->store_result()) {
							while ($row = self::$result->fetch_row()) {
								foreach($row as $fieldPos=>$value){
									//
									// STORE RESULT
									self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
									
								}
								$ROWCNT++;
							}
							self::$result->free();
						}
				
						if (self::$mysqli->more_results()) {
							//
							// END OF RECORD. MORE TO FOLLOW.
						}
					} while (self::$mysqli->more_results() && self::$mysqli->next_result());
			
					return self::$result_ARRAY;
					
				break;
				case 'save_asset_update':
					//
					// WE RECEIVED THIS REQUEST FROM ANOTHER SERVER

					/*
					'ASSET_ID' => $this->assetParams['ASSET_ID'], 
					'ASSET_TYPE' => self::$oUser->retrieve_Form_Data("ASSET_TYPE"),
					'KIVOTOS_ID' => self::$oUser->retrieve_Form_Data("KIVOTOS_ID"),
					'CLIENT_ID' => self::$oUser->retrieve_Form_Data("CLIENT_ID"),
					'USER_ID' => self::$oUser->retrieve_Form_Data("USER_ID"),
					'CHANNEL' => self::$oUser->retrieve_Form_Data("CHANNEL"),
					'DESCRIPTION' => self::$oUser->retrieve_Form_Data("DESCRIPTION"),
					'NAME' => self::$oUser->retrieve_Form_Data("NAME"),
					'REMOTE_ADDR' => self::$oUser->retrieve_Form_Data("REMOTE_ADDR"),
					'ASSET_DLOAD_ENDPOINT' => self::$oUser->retrieve_Form_Data("ASSET_DLOAD_ENDPOINT"),
					'ASSET_PREVIEW_ENDPOINT' => self::$oUser->retrieve_Form_Data("ASSET_PREVIEW_ENDPOINT"),
					'ASSET_UPLOAD_STATUS' => $this->assetParams['ASSET_UPLOAD_STATUS'],
					'FILE_NAME' => $this->assetParams['TARGET_FILE_NAME'],
					'FILE_EXT' => $this->assetParams['FILE_EXT'],
					'FILE_PATH' => $this->assetParams['TARGET_FILE_PATH'],
                    'FILE_PATH_LARGE' => $this->assetParams['TARGET_THUMB_LARGE_FILE'],
                    'FILE_PATH_MED' => $this->assetParams['TARGET_THUMB_MEDIUM_FILE'],
                    'FILE_PATH_SMALL' => $this->assetParams['TARGET_THUMB_SMALL_FILE'],
					'FILE_MIME_TYPE' => $this->assetParams['FILE_MIME_TYPE'],
					'FILE_SIZE' => $this->assetParams['FILE_SIZE'],
					'NAME' => self::$oUser->retrieve_Form_Data('NAME'),
					'DESCRIPTION' => self::$oUser->retrieve_Form_Data('DESCRIPTION'),
					'PREVIOUS_VERSIONS' => $tmp_pv,
					'FLAG_AS_REPLACED' => self::$oUser->retrieve_Form_Data('FLAG_AS_REPLACED'),
					'LANGCODE' => self::$oUser->retrieve_Form_Data('LANGCODE')
					*/
					
					$tmp_activityid = $oUser->generateNewKey(70);
					$ID_ARRAY[0] = $oUser->getReqParamByKey("KIVOTOS_ID");
					$IDTYPE_ARRAY[0] = "KIVOTOS";
					$ID_ARRAY[1] = $oUser->getReqParamByKey("USER_ID");
					$IDTYPE_ARRAY[1] = "USER";

                    $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                    $dataAugmenter = new dataAugmentation(self::$mysqli,$oUserEnvironment,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);
					#$dataAugmenter = new dataAugmentation(self::$mysqli,$oUserEnvironment,$ID_ARRAY,$IDTYPE_ARRAY);

					if($oUser->getReqParamByKey("FILE_PATH_LARGE")==""){
					    //
                        // WE HAVE NO THUMBS FOR THIS ASSET, STORE NULL...NOT ENCRYPTION OF NULL.
                        $tmp_FILE_PATH_LARGE = NULL;
                        $tmp_FILE_PATH_MED = NULL;
                        $tmp_FILE_PATH_SMALL = NULL;

                    }else{
                        $tmp_FILE_PATH_LARGE = $oUserEnvironment->paramTunnelEncrypt($oUser->getReqParamByKey("FILE_PATH_LARGE"));
                        $tmp_FILE_PATH_MED = $oUserEnvironment->paramTunnelEncrypt($oUser->getReqParamByKey("FILE_PATH_MED"));
                        $tmp_FILE_PATH_SMALL = $oUserEnvironment->paramTunnelEncrypt($oUser->getReqParamByKey("FILE_PATH_SMALL"));

                    }

                    $oInputTransformer = new transformer($oUserEnvironment, $this, $oUser);
                    $tmp_content_format_ARRAY = $oInputTransformer->returnTransformedInput('LINKS', $oUser->getReqParamByKey("DESCRIPTION"));  // 2 DIM ARRAY RETURN


                    switch($oUser->getReqParamByKey('ASSET_TYPE')){
						case 'BRIEF':
							$tmp_activity_descript = "The creative brief (<span class='a_log_topic_name'>".$oUser->getReqParamByKey('NAME')."</span>) has been updated with a new version in the e<span class='the_V'>V</span>ifweb client extranet for the kivot&oacute;s, <span class='a_log_asset_kivotos'>".$dataAugmenter->getData('KIVOTOS',0,'NAME')."</span>.";
						break;
                        case 'CREATIVE':
                            switch($oUser->getReqParamByKey("SPECIALTY_TYPE")){
                                case 'BANNER_CREATIVE':
                                    $tmp_specialty_type = 'banner ad';
                                    break;
                                case 'EMAIL_CREATIVE':
                                    $tmp_specialty_type = 'email';
                                    break;
                                case 'WEB_CREATIVE':
                                    $tmp_specialty_type = 'web page';
                                    break;
                                case 'MOBILE_CREATIVE':
                                    $tmp_specialty_type = 'mobile content';
                                    break;
                                case 'PRINT_CREATIVE':
                                    $tmp_specialty_type = 'print';
                                    break;
                                default:
                                    $tmp_specialty_type = '';
                                    break;
                            }

                            $tmp_activity_descript = "New ".$tmp_specialty_type." creative (<span class='a_log_topic_name'>".$oUser->getReqParamByKey('NAME')."</span>) has been uploaded to the e<span class='the_V'>V</span>ifweb client extranet for the kivot&oacute;s, <span class='a_log_asset_kivotos'>".$dataAugmenter->getData('KIVOTOS',0,'NAME')."</span>.";
                        break;
                        case 'REPORT':
                            $tmp_activity_descript = "A report or document (<span class='a_log_topic_name'>".$oUser->getReqParamByKey('NAME')."</span>) has been uploaded to the e<span class='the_V'>V</span>ifweb client extranet for the kivot&oacute;s, <span class='a_log_asset_kivotos'>".$dataAugmenter->getData('KIVOTOS',0,'NAME')."</span>.";
                        break;
                        case 'DELIVERABLE':
                            $tmp_activity_descript = "A deliverable (<span class='a_log_topic_name'>".$oUser->getReqParamByKey('NAME')."</span>) has been uploaded to the e<span class='the_V'>V</span>ifweb client extranet for the kivot&oacute;s, <span class='a_log_asset_kivotos'>".$dataAugmenter->getData('KIVOTOS',0,'NAME')."</span>.";
                        break;
						
					}

                    $tmp_formatted_content = $tmp_content_format_ARRAY['STYLED_CONTENT'];  // GET LINKED CONTENT (PROXY AND INTERNAL)

                    //
                    // PROCESS MENTIONS
                    $oInputTransformer = $this->process_mentions($tmp_formatted_content, $oUser, $oUserEnvironment, $oDB_RESP, $oInputTransformer, $oUser->getReqParamByKey("STREAM_MENTIONS_EID"), $queryType);

                    $tmp_formatted_content = $oInputTransformer->formatted_content;

                    self::$query = $tmp_content_format_ARRAY['QUERY'];
					self::$query .= 'INSERT INTO `assets`(`ASSET_ID`,`ASSET_ID_CRC32`,`CLIENT_ID`,`CLIENT_ID_CRC32`,`KIVOTOS_ID`,`KIVOTOS_ID_CRC32`,`USER_ID`,`USER_ID_CRC32`,`ASSIGNED_ID`,`ASSIGNED_ID_CRC32`,`ASSET_TYPE_KEY`,`DLOAD_END_POINT`,
					`PREVIEW_END_POINT`,`FILE_MD5`,`FILE_SHA1`,`FILE_NAME`,`FILE_EXT`,`FILE_SIZE`,`FILE_MIME_TYPE`,`FILE_PATH`,`FILE_PATH_LARGE`,`FILE_PATH_MED`,`FILE_PATH_SMALL`,`NAME`,`DESCRIPTION`,`DESCRIPTION_RAW`,`PREVIOUS_VERSIONS`,`LANGCODE`,`CHANNEL`,`DATEMODIFIED`) VALUES (
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('ASSET_ID')).'",
					"'.crc32($oUser->getReqParamByKey('ASSET_ID')).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('CLIENT_ID')).'",
					"'.crc32($oUser->getReqParamByKey('CLIENT_ID')).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('KIVOTOS_ID')).'",
					"'.crc32($oUser->getReqParamByKey('KIVOTOS_ID')).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('USER_ID')).'",
					"'.crc32($oUser->getReqParamByKey('USER_ID')).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('USER_ID')).'",
					"'.crc32($oUser->getReqParamByKey('USER_ID')).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("ASSET_TYPE")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("ASSET_DLOAD_ENDPOINT")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("ASSET_PREVIEW_ENDPOINT")).'",
					UNHEX("'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("FILE_MD5")).'"),
					UNHEX("'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("FILE_SHA1")).'"),
					"'.self::$mysqli->real_escape_string($oUserEnvironment->paramTunnelEncrypt($oUser->getReqParamByKey("FILE_NAME"))).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("FILE_EXT")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("FILE_SIZE")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("FILE_MIME_TYPE")).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->paramTunnelEncrypt($oUser->getReqParamByKey("FILE_PATH"))).'",
					"'.self::$mysqli->real_escape_string($tmp_FILE_PATH_LARGE).'",
					"'.self::$mysqli->real_escape_string($tmp_FILE_PATH_MED).'",
					"'.self::$mysqli->real_escape_string($tmp_FILE_PATH_SMALL).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("NAME")).'",
					"'.self::$mysqli->real_escape_string($tmp_formatted_content).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("DESCRIPTION")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("PREVIOUS_VERSIONS")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("LANGCODE")).'",
					"'.self::$mysqli->real_escape_string(strtoupper($oUser->getReqParamByKey("CHANNEL"))).'",
					"'.$ts.'");';
					
					self::$query .= 'INSERT INTO `file_system_activity_log`(`CLIENT_ID`,`KIVOTOS_ID`,`USER_ID`,`ASSET_ID`,`DOWNLOAD_END_POINT`,`FILE_EXT`,`FILE_SIZE`,`DATEMODIFIED`) VALUES (
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('CLIENT_ID')).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('KIVOTOS_ID')).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('USER_ID')).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('ASSET_ID')).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("ASSET_DLOAD_ENDPOINT")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("FILE_EXT")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("FILE_SIZE")).'",
					"'.$ts.'");';
					
					self::$query .= 'UPDATE `assets` SET `ISACTIVE`="4",`NEXT_VERSION`="'.$oUser->getReqParamByKey('ASSET_ID').'", `DATEMODIFIED`="'.$ts.'" WHERE 
					`ASSET_ID`="'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('FLAG_AS_REPLACED')).'" AND 
					`ASSET_ID_CRC32`="'.crc32($oUser->getReqParamByKey('FLAG_AS_REPLACED')).'" AND 
					`CLIENT_ID`="'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('CLIENT_ID')).'" AND 
					`CLIENT_ID_CRC32`="'.crc32($oUser->getReqParamByKey('CLIENT_ID')).'" AND 
					`KIVOTOS_ID`="'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('KIVOTOS_ID')).'" AND 
					`KIVOTOS_ID_CRC32`="'.crc32($oUser->getReqParamByKey('KIVOTOS_ID')).'" LIMIT 1;';
					
					self::$query .= 'INSERT INTO `log_sys_user` (`ACTIVITY_ID`,`CLIENT_ID`,`CLIENT_ID_CRC32`,`KIVOTOS_ID`,`KIVOTOS_ID_CRC32`,`USER_ID`,`USER_ID_CRC32`,`ASSET_ID`,`ASSET_ID_CRC32`,
																 `ACTIVITY_DESCRIPTION`,`PHPSESSION`,`IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`) VALUES (
					"'.$tmp_activityid.'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("CLIENT_ID")).'",
					"'.crc32($oUser->getReqParamByKey("CLIENT_ID")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("KIVOTOS_ID")).'",
					"'.crc32($oUser->getReqParamByKey("KIVOTOS_ID")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("USER_ID")).'",
					"'.crc32($oUser->getReqParamByKey("USER_ID")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('ASSET_ID')).'",
					"'.crc32($oUser->getReqParamByKey('ASSET_ID')).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
					"'.session_id().'",
					"'.$_SERVER['REMOTE_ADDR'].'",
					"'.$_SERVER['HTTP_USER_AGENT'].'",
					"'.self::$mysqli->real_escape_string(strtoupper($oUser->getReqParamByKey("CHANNEL"))).'");';
					
					$tmp_search_str = $dataAugmenter->getData('USER',0,'FIRSTNAME_BLOB').$dataAugmenter->getData('USER',0,'LASTNAME_BLOB').$tmp_activity_descript;
					
					self::$query .= 'INSERT INTO `log_sys_user_search` (`SEARCH_ID`,`SEARCH_CONTENT`,`CLIENT_ID`,`CLIENT_ID_CRC32`,`USER_ID`,`USER_ID_CRC32`,`KIVOTOS_ID`,`KIVOTOS_ID_CRC32`,`ASSET_ID`,`ASSET_ID_CRC32`,`CONTENT_LENGTH`,`ACTIVITY_DESCRIPTION`) VALUES
					("'.$tmp_activityid.'",
					"'.self::$mysqli->real_escape_string(strtolower($oUser->searchCleanStr($tmp_search_str))).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("CLIENT_ID")).'",
					"'.crc32($oUser->getReqParamByKey("CLIENT_ID")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("USER_ID")).'",
					"'.crc32($oUser->getReqParamByKey("USER_ID")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("KIVOTOS_ID")).'",
					"'.crc32($oUser->getReqParamByKey("KIVOTOS_ID")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('ASSET_ID')).'",
					"'.crc32($oUser->getReqParamByKey('ASSET_ID')).'",
					"'.strlen($oUser->searchCleanStr($tmp_search_str)).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'");';
					
					$tmp_assetSearch_str = $oUser->getReqParamByKey("NAME").$oUser->getReqParamByKey("DESCRIPTION").$oUser->getReqParamByKey("FILE_EXT");
					self::$query .= 'INSERT INTO `assets_search` (`SEARCH_ID`,`SEARCH_CONTENT`,`CLIENT_ID`,`CLIENT_ID_CRC32`,`KIVOTOS_ID`,`ASSET_ID`,`CONTENT_LENGTH`,`NAME`,`DESCRIPTION`,`DATEMODIFIED`) VALUES
					("'.$tmp_activityid.'",
					"'.self::$mysqli->real_escape_string(strtolower($oUser->searchCleanStr($tmp_assetSearch_str))).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("CLIENT_ID")).'",
					"'.crc32($oUser->getReqParamByKey("CLIENT_ID")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("KIVOTOS_ID")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('ASSET_ID')).'",
					"'.strlen($oUser->searchCleanStr($tmp_assetSearch_str)).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("NAME")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("DESCRIPTION")).'",
					"'.$ts.'");';
					
					#error_log("database (214) query->".self::$query);
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
					if(self::$mysqli->error){
						self::$query_exception_result = "save_asset_content=error=".self::$mysqli->error;
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}else{

                        do{
                        } while (self::$mysqli->more_results() && self::$mysqli->next_result());

                        //
                        // BRING IN THE MESSENGER
                        // Luke 1:19, 26; Daniel 8:16; 9:21-22
                        $oGabriel = new messenger_from_north($this, $oUser, $oUserEnvironment, $oDB_RESP);
                        $oGabriel->scroll_messages($queryType);
                        $oGabriel->deliver_scroll();

                        return "success";
					}
				
				break;

				case 'request_asset_access_authorization':
				
				/*'ASSET_ID' => array('name' => 'ASSET_ID', 'type' => 'xsd:string'),
		'KIVOTOS_ID' => array('name' => 'KIVOTOS_ID', 'type' => 'xsd:string'),
		'CLIENT_ID' => array('name' => 'CLIENT_ID', 'type' => 'xsd:string'),
		'USER_ID' => array('name' => 'USER_ID', 'type' => 'xsd:string'),
		'IPADDRESS' => array('name' => 'IPADDRESS', 'type' => 'xsd:string'),
		'SESSIONID' => array('name' => 'SESSIONID', 'type' => 'xsd:string')*/
				
					//
					// FROM REMOTE SERVER VIA SOAP
					// QUERY SESSION TABLE FOR QUALIFYING MATCHING SESSIONID
					self::$query = 'SELECT `sessions`.`SESSIONID`,`sessions`.`USERID` FROM `sessions` WHERE `sessions`.`SESSIONID`="'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('SESSIONID')).'" AND `sessions`.`SESSIONID_CRC32`="'.crc32($oUser->getReqParamByKey('SESSIONID')).'" AND `sessions`.`USERID`="'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('USER_ID')).'" AND  `sessions`.`USERID_CRC32`="'.crc32($oUser->getReqParamByKey('USER_ID')).'" AND `sessions`.`REMOTE_ADDR`="'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('IPADDRESS')).'" AND DATE_SUB(CURDATE(),'.$oUserEnvironment->getEnvParam('SESSION_EXPIRE').') <= `sessions`.`DATEMODIFIED` LIMIT 1;';
					
					//
					// PROCESS QUERY
					error_log("evifweb database (370) session query->".self::$query);
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
					//error_log("evifweb database (585) num_rows->".self::$result->num_rows);
					
					$ROWCNT=0;
					if(self::$mysqli->error){
						self::$query_exception_result = 'request_asset_access_authorization=mysql-error';
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}else{
						
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						while ($row = self::$result->fetch_row()) {
							foreach($row as $fieldPos=>$value){
								//
								// STORE RESULT
								#error_log("services /database.inc.php (296) rowcnt[".$ROWCNT."] fieldPos[".$fieldPos."] value [".$value."]");
								self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
								
							}
							$ROWCNT++;
						}
						self::$result->free();
						
						#error_log("evifweb database (1099) valid session rowcount->".$ROWCNT." on query->".self::$query);
						switch($ROWCNT){
							case 1:
								
								//
								// UPDATE SESSIONS WITH CURRENT ACTIVITY
								self::$query = 'UPDATE `sessions` SET `sessions`.`DATEMODIFIED`="'.$ts.'" WHERE `sessions`.`SESSIONID`="'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('SESSIONID')).'" AND 
								`sessions`.`SESSIONID_CRC32`="'.crc32($oUser->getReqParamByKey('SESSIONID')).'" AND
								`sessions`.`USERID`="'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('USER_ID')).'" AND 
								`sessions`.`USERID_CRC32`="'.crc32($oUser->getReqParamByKey('USER_ID')).'" LIMIT 1;';
								
								self::$query .= 'SELECT `assets`.`ASSET_ID`, `assets`.`CLIENT_ID`, `assets`.`KIVOTOS_ID`, `assets`.`USER_ID`, `assets`.`ISACTIVE`, `assets`.`ASSET_TYPE_KEY`, `assets`.`DLOAD_END_POINT`, `assets`.`FILE_NAME`, 
								`assets`.`FILE_EXT`, `assets`.`FILE_SIZE`, `assets`.`FILE_PATH`, `assets`.`FILE_MIME_TYPE`, `assets`.`IMAGE_WIDTH`, `assets`.`IMAGE_HEIGHT`, `assets`.`AUTHORIZED_IP`, 
								`assets`.`AUTHORIZED_USERS`, `assets`.`NAME`, `assets`.`DESCRIPTION`, `assets`.`PREVIOUS_VERSIONS`, `assets`.`LANGCODE`, `assets`.`CHANNEL`, `assets`.`DATEMODIFIED`, 
								`assets`.`DATECREATED` FROM `assets` WHERE 
								`assets`.`ASSET_ID`="'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("ASSET_ID")).'" AND `assets`.`ASSET_ID_CRC32`="'.crc32($oUser->getReqParamByKey("ASSET_ID")).'" AND 
								`assets`.`CLIENT_ID`="'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("CLIENT_ID")).'" AND `assets`.`CLIENT_ID_CRC32`="'.crc32($oUser->getReqParamByKey("CLIENT_ID")).'" AND 
								`assets`.`KIVOTOS_ID`="'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("KIVOTOS_ID")).'" AND `assets`.`KIVOTOS_ID_CRC32`="'.crc32($oUser->getReqParamByKey("KIVOTOS_ID")).'" LIMIT 1;';
								
								//
								// PROCESS QUERY
								//error_log("evifweb database (597) query->".self::$query);
								self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
								//
								// CLEAR RESULT ARRAY
								array_splice(self::$result_ARRAY, 0);
								
								$ROWCNT=0;
								do {
									if (self::$result = self::$mysqli->store_result()) {
										while ($row = self::$result->fetch_row()) {
											foreach($row as $fieldPos=>$value){
												//
												// STORE RESULT
												#error_log("database (197) request_asset_access_authorization->".$value);
												self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
												
											}
											$ROWCNT++;
										}
										self::$result->free();
									}
							
									if (self::$mysqli->more_results()) {
										//
										// END OF RECORD. MORE TO FOLLOW.
									}
								} while (self::$mysqli->more_results() && self::$mysqli->next_result());
						
								return self::$result_ARRAY;
								
							break;
							default:
								//
								// CLOSE CONNECTION
								//$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection(self::$mysqli);
								
								return "request_asset_access_authorization=denied->".self::$query;
							break;
						}						
						
					
					}
					
					
					
				break;
				case 'get_extranet_activity_log':
					self::$query = 'SELECT `ACTIVITY_ID`, `DATECREATED`, `CLIENT_ID`, `KIVOTOS_ID`, `USER_ID`, `ASSET_ID`, `ACTIVITY_DESCRIPTION`, `IPADDRESS`, `CHANNEL` 
					FROM `log_sys_user` ORDER BY DATECREATED DESC;';
					self::$query .= 'SELECT `users`.`USERID`, `users`.`EMAIL` ,`users`.`ISACTIVE`, `users`.`USER_PERMISSIONS_ID`, `users`.`FIRSTNAME_BLOB`, `users`.`LASTNAME_BLOB`, `users`.`JOBTITLE_BLOB`, `users`.`LANGCODE`,`users`.`LASTLOGIN`,`users`.`LASTLOGIN_IP`,`users`.`IMAGE_NAME`,`users`.`IMAGE_WIDTH`,`users`.`IMAGE_HEIGHT`,`users`.`ABOUT_BLOB`,`users`.`DATEMODIFIED`,`users`.`DATECREATED` FROM `users` WHERE `users`.`ISACTIVE`="1" OR `users`.`ISACTIVE`="4";';
					self::$query .= 'SELECT `clients`.`CLIENT_ID`, `clients`.`COMPANYNAME_BLOB`, `clients`.`LANGCODE`, `clients`.`DATECREATED`  FROM `clients`;';
					
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
					//
					// CLEAR RESULT ARRAY
					array_splice(self::$result_ARRAY, 0);
					
					$ROWCNT=0;
					do {
						if (self::$result = self::$mysqli->store_result()) {
							while ($row = self::$result->fetch_row()) {
								foreach($row as $fieldPos=>$value){
									//
									// STORE RESULT
									self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
									
								}
								$ROWCNT++;
							}
							self::$result->free();
						}
				
						if (self::$mysqli->more_results()) {
							//
							// END OF RECORD. MORE TO FOLLOW.
						}
					} while (self::$mysqli->more_results() && self::$mysqli->next_result());
			
					return self::$result_ARRAY;
				
				
				break;
				case 'log_asset_transmission':
					/*
					'ASSET_ID' => $this->assetParams['ASSET_ID'], 
					'ASSET_TYPE' => self::$oUser->retrieve_Form_Data("ASSET_TYPE"),
					'KIVOTOS_ID' => self::$oUser->retrieve_Form_Data("KIVOTOS_ID"),
					'CLIENT_ID' => self::$oUser->retrieve_Form_Data("CLIENT_ID"),
					'USER_ID' => self::$oUser->retrieve_Form_Data("USER_ID"),
					'CHANNEL' => self::$oUser->retrieve_Form_Data("CHANNEL"),
					SPECIALTY_TYPE
					'DESCRIPTION' => self::$oUser->retrieve_Form_Data("DESCRIPTION"),
					'NAME' => self::$oUser->retrieve_Form_Data("NAME"),
					'REMOTE_ADDR' => self::$oUser->retrieve_Form_Data("REMOTE_ADDR"),
					'ASSET_DLOAD_ENDPOINT' => self::$oUser->retrieve_Form_Data("ASSET_DLOAD_ENDPOINT"),
					'ASSET_PREVIEW_ENDPOINT' => self::$oUser->retrieve_Form_Data("ASSET_PREVIEW_ENDPOINT"),
					'ASSET_UPLOAD_STATUS' => $this->assetParams['ASSET_UPLOAD_STATUS'],
					'FILE_NAME' => $this->assetParams['TARGET_FILE_NAME'],
					'FILE_EXT' => $this->assetParams['FILE_EXT'],
					'FILE_PATH' => $this->assetParams['TARGET_FILE_PATH'],
					'FILE_MIME_TYPE' => $this->assetParams['FILE_MIME_TYPE'],
					'FILE_SIZE' => $this->assetParams['FILE_SIZE'],
					'NAME' => self::$oUser->retrieve_Form_Data('NAME'),
					'DESCRIPTION' => self::$oUser->retrieve_Form_Data('DESCRIPTION'),
					'PREVIOUS_VERSIONS' => $tmp_pv,
					'FLAG_AS_REPLACED' => self::$oUser->retrieve_Form_Data('FLAG_AS_REPLACED'),
					'LANGCODE' => self::$oUser->retrieve_Form_Data('LANGCODE')
					*/
					$tmp_SOAP_ARRAY = $oAssetMgr->return_SOAP_asset();

					self::$query = 'INSERT INTO `assets_transmission`
					(`ASSET_ID`,
					`ASSET_ID_CRC32`,
					`CLIENT_ID`,
					`CLIENT_ID_CRC32`,
					`KIVOTOS_ID`,
					`KIVOTOS_ID_CRC32`,
					`USER_ID`,
					`USER_ID_CRC32`,
					`ASSET_TYPE_KEY`,
					`SPECIALTY_TYPE_KEY`,
					`DLOAD_END_POINT`,
					`PREVIEW_END_POINT`,
					`SOAP_TRANSACTION_RESPONSE`,
					`ASSET_UPLOAD_STATUS`,
					`FILE_NAME`,
					`FILE_EXT`,
					`FILE_SIZE`,
					`FILE_PATH`,
					`FILE_MIME_TYPE`,
					`NAME`,
					`DESCRIPTION`,
					`PREVIOUS_VERSIONS`,
					`LANGCODE`,
					`CHANNEL`,
					`IPADDRESS`) 
					VALUES 
					("'.self::$mysqli->real_escape_string($tmp_SOAP_ARRAY['oUploadAssetInfo']['ASSET_ID']).'",
					"'.crc32($tmp_SOAP_ARRAY['oUploadAssetInfo']['ASSET_ID']).'",
					"'.self::$mysqli->real_escape_string($tmp_SOAP_ARRAY['oUploadAssetInfo']['CLIENT_ID']).'",
					"'.crc32($tmp_SOAP_ARRAY['oUploadAssetInfo']['CLIENT_ID']).'",
					"'.self::$mysqli->real_escape_string($tmp_SOAP_ARRAY['oUploadAssetInfo']['KIVOTOS_ID']).'",
					"'.crc32($tmp_SOAP_ARRAY['oUploadAssetInfo']['KIVOTOS_ID']).'",
					"'.self::$mysqli->real_escape_string($tmp_SOAP_ARRAY['oUploadAssetInfo']['USER_ID']).'",
					"'.crc32($tmp_SOAP_ARRAY['oUploadAssetInfo']['USER_ID']).'",
					"'.self::$mysqli->real_escape_string($tmp_SOAP_ARRAY['oUploadAssetInfo']['ASSET_TYPE']).'",
					"'.self::$mysqli->real_escape_string($tmp_SOAP_ARRAY['oUploadAssetInfo']['SPECIALTY_TYPE']).'",
					"'.self::$mysqli->real_escape_string($tmp_SOAP_ARRAY['oUploadAssetInfo']['ASSET_DLOAD_ENDPOINT']).'",
					"'.self::$mysqli->real_escape_string($tmp_SOAP_ARRAY['oUploadAssetInfo']['ASSET_PREVIEW_ENDPOINT']).'",
					"'.self::$mysqli->real_escape_string($oUser->soap_status).'",
					"'.self::$mysqli->real_escape_string($tmp_SOAP_ARRAY['oUploadAssetInfo']['ASSET_UPLOAD_STATUS']).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->paramTunnelEncrypt($tmp_SOAP_ARRAY['oUploadAssetInfo']['FILE_NAME'])).'",
					"'.self::$mysqli->real_escape_string($tmp_SOAP_ARRAY['oUploadAssetInfo']['FILE_EXT']).'",
					"'.self::$mysqli->real_escape_string($tmp_SOAP_ARRAY['oUploadAssetInfo']['FILE_SIZE']).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->paramTunnelEncrypt($tmp_SOAP_ARRAY['oUploadAssetInfo']['FILE_PATH'])).'",
					"'.self::$mysqli->real_escape_string($tmp_SOAP_ARRAY['oUploadAssetInfo']['FILE_MIME_TYPE']).'",
					"'.self::$mysqli->real_escape_string($tmp_SOAP_ARRAY['oUploadAssetInfo']['NAME']).'",
					"'.self::$mysqli->real_escape_string($tmp_SOAP_ARRAY['oUploadAssetInfo']['DESCRIPTION']).'",
					"'.self::$mysqli->real_escape_string($tmp_SOAP_ARRAY['oUploadAssetInfo']['PREVIOUS_VERSIONS']).'",
					"'.self::$mysqli->real_escape_string($tmp_SOAP_ARRAY['oUploadAssetInfo']['LANGCODE']).'",
					"'.self::$mysqli->real_escape_string(strtoupper($tmp_SOAP_ARRAY['oUploadAssetInfo']['CHANNEL'])).'",
					"'.self::$mysqli->real_escape_string($tmp_SOAP_ARRAY['oUploadAssetInfo']['REMOTE_ADDR']).'");';

					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
									
					if(self::$mysqli->error){
						self::$query_exception_result="log_asset_transmission=false";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}
	
					return 'success';
				break;
				case 'save_asset_content':

                    self::$query = '';

					//
					// WE RECEIVED THIS REQUEST FROM ANOTHER SERVER
					#$this->sysLangLoad("TEXT_STRENGTHEN_WEB|LIST_FTAF|TEXT_HOME_PAGE_COPY_SECT01", $oUserEnvironment, $oUser);
					/*'ASSET_ID' => $this->assetParams['ASSET_ID'],
					'ASSET_TYPE' => self::$oUser->retrieve_Form_Data("ASSET_TYPE"),
					'SPECIALTY_TYPE' = STREAM_TYPE_KEY FOR STREAM ASSETS
					'KIVOTOS_ID' => self::$oUser->retrieve_Form_Data("KIVOTOS_ID"),
					'CLIENT_ID' => self::$oUser->retrieve_Form_Data("CLIENT_ID"),
					'STREAM_ID'
					'I_FEED_STREAM_ID'
					'STREAM_CONTENT'
					'STREAM_MENTIONS_EID'
					'USER_ID' => self::$oUser->retrieve_Form_Data("USER_ID"),
					'CHANNEL' => self::$oUser->retrieve_Form_Data("CHANNEL"),
					'DESCRIPTION' => self::$oUser->retrieve_Form_Data("DESCRIPTION"),
					'NAME' => self::$oUser->retrieve_Form_Data("NAME"),
					'REMOTE_ADDR' => self::$oUser->retrieve_Form_Data("REMOTE_ADDR"),
					'ASSET_DLOAD_ENDPOINT' => self::$oUser->retrieve_Form_Data("ASSET_DLOAD_ENDPOINT"),
					'ASSET_PREVIEW_ENDPOINT' => self::$oUser->retrieve_Form_Data("ASSET_PREVIEW_ENDPOINT"),
					'ASSET_UPLOAD_STATUS' => $this->assetParams['ASSET_UPLOAD_STATUS'],
					'FILE_NAME' => $this->assetParams['TARGET_FILE_NAME'],
					'FILE_EXT' => $this->assetParams['FILE_EXT'],
					'FILE_PATH' => $this->assetParams['TARGET_FILE_PATH'],
                    'FILE_PATH_LARGE' => $this->assetParams['TARGET_THUMB_LARGE_FILE'],
                    'FILE_PATH_MED' => $this->assetParams['TARGET_THUMB_MEDIUM_FILE'],
                    'FILE_PATH_SMALL' => $this->assetParams['TARGET_THUMB_SMALL_FILE'],
					'FILE_MIME_TYPE' => $this->assetParams['FILE_MIME_TYPE'],
					'FILE_SIZE' => $this->assetParams['FILE_SIZE'],
					'NAME' => self::$oUser->retrieve_Form_Data('NAME'),
					'DESCRIPTION' => self::$oUser->retrieve_Form_Data('DESCRIPTION'),
					'PREVIOUS_VERSIONS' => $tmp_pv,
					'FLAG_AS_REPLACED' => self::$oUser->retrieve_Form_Data('FLAG_AS_REPLACED'),
					'LANGCODE' => self::$oUser->retrieve_Form_Data('LANGCODE')
					*/

					//
                    // THERE IS AN ASSUMPTION HERE THAT EVERYTHING PASSING THROUGH WILL HAVE KIVOTOS DATA. THIS IS NOT THE CASE.
					$tmp_activityid = $oUser->generateNewKey(70);
					$ID_ARRAY[0] = $oUser->getReqParamByKey("USER_ID");
					$IDTYPE_ARRAY[0] = "USER";

					if($oUser->getReqParamByKey("KIVOTOS_ID")!=""){
                        $ID_ARRAY[1] = $oUser->getReqParamByKey("KIVOTOS_ID");
                        $IDTYPE_ARRAY[1] = "KIVOTOS";
                    }

                    $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                    $dataAugmenter = new dataAugmentation(self::$mysqli,$oUserEnvironment,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);
					#$dataAugmenter = new dataAugmentation(self::$mysqli,$oUserEnvironment,$ID_ARRAY,$IDTYPE_ARRAY);

                    #error_log("database (2637) test data aug now for kivotos->".$oUser->getReqParamByKey("KIVOTOS_ID"));
                    #error_log("database (2638) test of data aug ->".$dataAugmenter->getData('KIVOTOS',0,'NAME'));

                    if($oUser->getReqParamByKey("FILE_PATH_LARGE")==""){
                        //
                        // WE HAVE NO THUMBS FOR THIS ASSET, STORE NULL...NOT ENCRYPTION OF NULL.
                        $tmp_FILE_PATH_LARGE = NULL;
                        $tmp_FILE_PATH_MED = NULL;
                        $tmp_FILE_PATH_SMALL = NULL;

                    }else{
                        $tmp_FILE_PATH_LARGE = $oUserEnvironment->paramTunnelEncrypt($oUser->getReqParamByKey("FILE_PATH_LARGE"));
                        $tmp_FILE_PATH_MED = $oUserEnvironment->paramTunnelEncrypt($oUser->getReqParamByKey("FILE_PATH_MED"));
                        $tmp_FILE_PATH_SMALL = $oUserEnvironment->paramTunnelEncrypt($oUser->getReqParamByKey("FILE_PATH_SMALL"));

                    }
					
					switch($oUser->getReqParamByKey('ASSET_TYPE')){
						case 'BRIEF':
							$tmp_activity_descript = "A creative brief (<span class='a_log_topic_name'>".$oUser->getReqParamByKey('NAME')."</span>) has been uploaded to the e<span class='the_V'>V</span>ifweb client extranet for the kivot&oacute;s, <span class='a_log_asset_kivotos'>".$dataAugmenter->getData('KIVOTOS',0,'NAME')."</span>.";
						break;
                        case 'CREATIVE':
                            switch($oUser->getReqParamByKey("SPECIALTY_TYPE")){
                                case 'BANNER_CREATIVE':
                                    $tmp_specialty_type = 'banner ad';
                                break;
                                case 'EMAIL_CREATIVE':
                                    $tmp_specialty_type = 'email';
                                break;
                                case 'WEB_CREATIVE':
                                    $tmp_specialty_type = 'web page';
                                break;
                                case 'MOBILE_CREATIVE':
                                    $tmp_specialty_type = 'mobile content';
                                break;
                                case 'PRINT_CREATIVE':
                                    $tmp_specialty_type = 'print';
                                break;
                                default:
                                    $tmp_specialty_type = '';
                                break;
                            }

                            $tmp_activity_descript = "New ".$tmp_specialty_type." creative (<span class='a_log_topic_name'>".$oUser->getReqParamByKey('NAME')."</span>) has been uploaded to the e<span class='the_V'>V</span>ifweb client extranet for the kivot&oacute;s, <span class='a_log_asset_kivotos'>".$dataAugmenter->getData('KIVOTOS',0,'NAME')."</span>.";
                        break;
                        case 'REPORT':
                            $tmp_activity_descript = "A report or document (<span class='a_log_topic_name'>".$oUser->getReqParamByKey('NAME')."</span>) has been uploaded to the e<span class='the_V'>V</span>ifweb client extranet for the kivot&oacute;s, <span class='a_log_asset_kivotos'>".$dataAugmenter->getData('KIVOTOS',0,'NAME')."</span>.";
                        break;
                        case 'DELIVERABLE':
                            $tmp_activity_descript = "A deliverable (<span class='a_log_topic_name'>".$oUser->getReqParamByKey('NAME')."</span>) has been uploaded to the e<span class='the_V'>V</span>ifweb client extranet for the kivot&oacute;s, <span class='a_log_asset_kivotos'>".$dataAugmenter->getData('KIVOTOS',0,'NAME')."</span>.";
                        break;
                        case 'STREAM':

                            //
                            // WE NEED TO ADD THE SQL TO STORE THE STREAM DATA. THIS IS THE NEW ASSET PATH. WELL, HERE WE GO.
                            // SO THERE ARE SOME ASSUMPTIONS THAT NEED TO BE TAKEN CARE OF. E.G. WE WILL NOT ALWAYS HAVE KIVOTOS_ID...BUT MY QUERIES HERE ALL LOOK FOR IT.
                            $tmp_streamid = $oUser->getReqParamByKey("STREAM_ID");
                            $tmp_i_feed_streamid = $oUser->getReqParamByKey("I_FEED_STREAM_ID");
                            if($tmp_streamid==""){
                                throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: [STREAM_ID came back from the web service NULL for STREAM asset type.]');
                            }

                            $tmp_searchid = $oUser->generateNewKey(70);

                            $oInputTransformer = new transformer($oUserEnvironment, $this, $oUser);
                            $tmp_content_format_ARRAY = $oInputTransformer->returnTransformedInput('LINKS', $oUser->getReqParamByKey("STREAM_CONTENT"));  // 2 DIM ARRAY RETURN

                            $oSTREAM_MGR = new stream_manager($oUserEnvironment, $oUser);

                            // INTERNALIZE CONTENT DATA PROFILE
                            #error_log("database (2159) process_mention_input() [".$oUser->retrieve_Form_Data("STREAM_MENTIONS_EID")."]");
                            $oSTREAM_MGR->process_mention_input($oUser->getReqParamByKey("STREAM_CONTENT"),$oUser->getReqParamByKey("STREAM_MENTIONS_EID"));
                            #error_log("database (2161) process_mention_input() complete. Count=[".$oSTREAM_MGR->return_mention_count()."]");

                            //
                            // THIS WILL SUPPORT MANUAL @MENTION ENTRY BY USER.
                            $tmp_loop_size = $oSTREAM_MGR->return_mention_count();
                            $db_resp_profile_field_cnt = '';
                            $tmp_mention_query = "";
                            if($tmp_loop_size>0) {
                                for ($i = 0; $i < $tmp_loop_size; $i++) {

                                    $tmp_SELECT_ARRAY[$i] = '`comm_stream_mention`.`STREAM_MENTION`,
                                `comm_stream_mention`.`USER_ID`,
                                `comm_stream_mention`.`ISACTIVE`,
                                `comm_stream_mention`.`DATEMODIFIED`,
                                `comm_stream_mention`.`DATECREATED`';

                                    //
                                    // LET'S BUILD THE QUERY FOR EXTRACTING USER DATA BASED ON @MENTION.
                                    // THIS NEEDS TO BE FAST. SO WILL NEED TO SETUP/MANAGE USER LOOKUP TABLE FOR MENTION DATA.
                                    $tmp_mention_query .= 'SELECT ' . $tmp_SELECT_ARRAY[$i] . ' FROM `comm_stream_mention` WHERE 
                                `comm_stream_mention`.`STREAM_MENTION`="' . strtolower($oSTREAM_MGR->return_mention_data($i)) . '" AND 
                                `comm_stream_mention`.`STREAM_MENTION_CRC32`="' . crc32(strtolower($oSTREAM_MGR->return_mention_data($i))) . '" AND 
                                `comm_stream_mention`.`ISACTIVE`="1";';

                                    if ($db_resp_profile_field_cnt == "") {
                                        $db_resp_target_profiles = 'COMM_STREAM_MENTION_' . $i;
                                        $db_resp_profile_field_cnt = '5';
                                    } else {
                                        $db_resp_target_profiles .= '|COMM_STREAM_MENTION_' . $i;
                                        $db_resp_profile_field_cnt .= '|5';

                                    }

                                }

                                //
                                // WE HAVE LOOKUP QUERY. WE SHOULD PROCESS OOP. THIS IS A SELECT WITH RESULT RETURN.
                                $force_profile_select_align = true;
                                $db_resp_process_serial = "jesus_is_lord!";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                                $db_resp_serial_key = 'COMM_STREAM';

                                $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt, $force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                                $oDB_RESP->process(self::$mysqli,$queryType,$tmp_SELECT_ARRAY,$tmp_mention_query);

                                //
                                // DB RESPONSE OBJ IS LOADED. NOW WE CAN BUILD THE SQL FOR MANAGING @MENTION NOTIFICATIONS
                                // NOW WE NEED TO GET USER PROFILE @MENTION HANDLE INTO THE DATABASE. WILL UPDATE THE USER PROFILE PAGE TO PERFORM THIS DATA MANIPULATION
                                $tmp_profile_array = explode("|", $db_resp_target_profiles);
                                #$tmp_loop_size_ARRAY = $oDB_RESP->return_sizeof($db_resp_process_serial, $tmp_profile_array[$i]);
                                #error_log("database (1199) running return_sizeof with tmp_profile_array->".$tmp_profile_array[0]);

                                # WHERE $tmp_loop_size_ARRAY[x] = # results returned by profile_x
                                // THIS COUNT REPRESENTS THE @MENTIONS ACTUALLY ENTERED INTO THE STREAM TEXTAREA AND COORELATES TO $oSTREAM_MGR->return_mention_data($i)

                                $tmp_loop_1_size = sizeof($tmp_profile_array);
                                for ($i = 0; $i < $tmp_loop_1_size; $i++) {
                                    $tmp_resp_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial(), $tmp_profile_array[$i]);
                                    $tmp_mention_check = true;

                                    if($tmp_resp_size>0) {

                                        $tmp_loop_size = $oDB_RESP->return_sizeof($db_resp_process_serial, $tmp_profile_array[$i]);
                                        for ($ii = 0; $ii < $tmp_loop_size; $ii++) {

                                            if ($oSTREAM_MGR->mention_accounted($oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'USER_ID', $ii))) {
                                                $tmp_mention_check = false;
                                                #error_log("database (2235) mention_accounted for USER_ID[" . $oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'USER_ID', $ii) . "] STREAM_MENTION[" . $i . "]->" . $oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'STREAM_MENTION', $ii));
                                                #error_log("database (2236) hyper link @mention[".$oSTREAM_MGR->return_mention_case($oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'STREAM_MENTION', $ii))."] to user_id[".$oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'USER_ID', $ii)."]");
                                                $oInputTransformer->queueMentionForTransform($oSTREAM_MGR->return_mention_case($oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'STREAM_MENTION', $ii)),$oDB_RESP->return_data_element($db_resp_process_serial, $tmp_profile_array[$i], 'USER_ID', $ii));
                                            }
                                        }
                                    }

                                    //
                                    // IF WE HAVE AN @MENTION, BUT NO DATABASE MATCH...
                                    if($tmp_mention_check){

                                        //
                                        // WE HAVE AN @MENTION THAT WAS MANUALLY ENTERED (OR TYPO'D). TRY TO PROCESS MANUALLY...JUST THE SAME.
                                        // THIS MENTION PROCESSING SHOULD HAPPEN BEFORE STREAM_CONTENT_STYLED IS PREPPED FOR DATABASE INSERTION
                                        // LETS SEE IF THIS FIRES. WE WILL NOT HOOK ANYTHING UP HERE YET. BUT PLAN TO ALLOW FOR USER TO MANUALLY ENTER @MENTION FOR PROCESSING
                                        // WE ARE READY TO HOOK UP BEST EFFORT MANUAL PROCESSING. THIS WILL MOST LIKELY CHECK MAYBE FIRST 5 CHARS OF @MENTION AGAINST ANY EID HIDDEN IN THE FORM...TO TRY TO GET USER_ID.
                                        #error_log("database (1684) we have custom entered @mention to process STREAM_MENTION[".$oSTREAM_MGR->return_mention_data($i)."] STREAM_MENTION[".$i."]");
                                        //error_log("database (5063) we need to try to hyperlink mention[".$oSTREAM_MGR->return_mention_data($i)."]");
                                        $tmp_mention_array = $this->find_mention_userid($oUserEnvironment, $oSTREAM_MGR->return_mention_data($i));

                                        if($tmp_mention_array[0][0]!=""){
                                            //error_log("database (5067) queue custom mention ".$tmp_mention_array[0][1]);
                                            $oInputTransformer->queueMentionForTransform($tmp_mention_array[0][1], $tmp_mention_array[0][0]);

                                        }
                                    }

                                }

                            }

                            //
                            // APPLY FORMATTING TO STREAM CONTENT. THIS WOULD NEED TO HAPPEN ALSO FOR ANY DESCRIPTIONS SENT TO EXTRANET
                            $tmp_formatted_content = $tmp_content_format_ARRAY['STYLED_CONTENT'];  // GET LINKED CONTENT (PROXY AND INTERNAL)
                            $tmp_formatted_content = $oInputTransformer->transform_mentions($tmp_formatted_content);

                            if($oUser->getReqParamByKey("KIVOTOS_ID")!=""){
                                $tmp_kivotos_crc = crc32($oUser->getReqParamByKey("KIVOTOS_ID"));
                            }else{
                                $tmp_kivotos_crc = 0;
                            }

                            //
                            // BUILD MENTIONS DATABASE TRANSACTION
                            $tmp_content_format_ARRAY = $oInputTransformer->build_mentions_SQL($tmp_formatted_content);

                            self::$query = $tmp_content_format_ARRAY['QUERY'];
                            self::$query .= 'INSERT INTO `comm_stream` (`STREAM_ID`, `STREAM_ID_CRC32`, `STREAM_TYPE`, `STREAM_TYPE_CRC32`, `CLIENT_ID`, `CLIENT_ID_CRC32`,`USER_ID`, `USER_ID_CRC32`, `KIVOTOS_ID`, `KIVOTOS_ID_CRC32`, `STREAM_CONTENT`, `STREAM_FORMATTED`, `I_FEED_STREAM_ID`, `ATTACHED_ASSET_ID`, `DATEMODIFIED`)
                            VALUES
                            ("'.$tmp_streamid.'",
                            "'.crc32($tmp_streamid).'",
                            "'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("SPECIALTY_TYPE")).'",
                            "'.crc32($oUser->getReqParamByKey("SPECIALTY_TYPE")).'",
                            "'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("CLIENT_ID")).'",
                            "'.crc32($oUser->getReqParamByKey("CLIENT_ID")).'",
                            "'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("USER_ID")).'",
                            "'.crc32($oUser->getReqParamByKey("USER_ID")).'",
                            "'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("KIVOTOS_ID")).'",
                            "'.$tmp_kivotos_crc.'",
                            "'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("STREAM_CONTENT")).'",
                            "'.self::$mysqli->real_escape_string($tmp_formatted_content).'",
                            "'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("I_FEED_STREAM_ID")).'",
                            "'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('ASSET_ID')).'",
                            "'.$ts.'");';

                            //
                            // BUILD SQL INSERT INTO comm_stream_flow
                            if($oUser->getReqParamByKey("I_FEED_STREAM_ID")!=""){
                                self::$query .= 'INSERT INTO `comm_stream_flow` (`CLIENT_ID`, `CLIENT_ID_CRC32`, `STREAM_ID`, `STREAM_ID_CRC32`, `FEEDER_STREAM_ID`, `FEEDER_STREAM_ID_CRC32`)
                                VALUES
                                ("'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("CLIENT_ID")).'",
                                "'.crc32($oUser->getReqParamByKey("CLIENT_ID")).'",
                                "'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("I_FEED_STREAM_ID")).'",
                                "'.crc32($oUser->getReqParamByKey("I_FEED_STREAM_ID")).'",
                                "'.$tmp_streamid.'",
                                "'.crc32($tmp_streamid).'");';

                            }else{
                                self::$query .= 'INSERT INTO `comm_stream_flow` (`CLIENT_ID`, `CLIENT_ID_CRC32`, `STREAM_ID`, `STREAM_ID_CRC32`, `FEEDER_STREAM_ID`, `FEEDER_STREAM_ID_CRC32`)
                                VALUES
                                ("'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("CLIENT_ID")).'",
                                "'.crc32($oUser->getReqParamByKey("CLIENT_ID")).'",
                                "'.$tmp_streamid.'",
                                "'.crc32($tmp_streamid).'",
                                "'.$tmp_streamid.'",
                                "'.crc32($tmp_streamid).'");';

                            }

                            //
                            // BUILD SQL INSERT INTO comm_stream_search [lets do 1 combined stream search table]
                            $tmp_search_content = $dataAugmenter->getData('USER',0,'FIRSTNAME_BLOB').$dataAugmenter->getData('USER',0,'LASTNAME_BLOB').$oUser->getReqParamByKey("STREAM_CONTENT").$oUser->getReqParamByKey("NAME");
                            self::$query .= 'INSERT INTO `comm_stream_search` (`SEARCH_ID`, `SEARCH_CONTENT`, `STREAM_TYPE`, `CLIENT_ID`, `CLIENT_ID_CRC32`,`USER_ID`, `USER_ID_CRC32`, `KIVOTOS_ID`, `KIVOTOS_ID_CRC32`,`ATTACHED_ASSET_ID`, `CONTENT_LENGTH`, `DATEMODIFIED`)
                            VALUES
                            ("'.$tmp_searchid.'",
                            "'.self::$mysqli->real_escape_string(strtolower($oUser->searchCleanStr($tmp_search_content))).'",
                            "'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("SPECIALTY_TYPE")).'",
                            "'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("CLIENT_ID")).'",
                            "'.crc32($oUser->getReqParamByKey("CLIENT_ID")).'",
                            "'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("USER_ID")).'",
                            "'.crc32($oUser->getReqParamByKey("USER_ID")).'",
                            "'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("KIVOTOS_ID")).'",
                            "'.$tmp_kivotos_crc.'",
                            "'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('ASSET_ID')).'",
                            "'.strlen($oUser->searchCleanStr($tmp_search_content)).'",
                            "'.$ts.'");';

                            switch($oUser->getReqParamByKey("SPECIALTY_TYPE")){
                                case 'KIVOTOS':
                                    #error_log("database (2886) use dataaug here...");
                                    if($oUser->getReqParamByKey("I_FEED_STREAM_ID")!=""){
                                        $tmp_activity_descript = "A reply stream communication has been received along with an attached file (<span class='a_log_topic_name'>".$oUser->getReqParamByKey('NAME')."</span>) within the kivot&oacute;s (<span class='a_log_topic_name'>".$dataAugmenter->getData('KIVOTOS',0,'NAME','DATA_AUG_01')."</span>) with the content [".$tmp_formatted_content."].";

                                    }else{
                                        $tmp_activity_descript = "A stream communication has been received along with an attached file (<span class='a_log_topic_name'>".$oUser->getReqParamByKey('NAME')."</span>), and this has been saved within the e<span class='the_V'>V</span>ifweb client extranet for the kivot&oacute;s, <span class='a_log_asset_kivotos'>".$dataAugmenter->getData('KIVOTOS',0,'NAME','DATA_AUG_01')." Stream content[".$oUser->getReqParamByKey('STREAM_CONTENT')."]</span>.";
                                    }

                                    #error_log("database (2888) use dataaug DONE...");
                                break;
                                case 'CLIENT':
                                case 'USER':
                                case 'ASSET':
                                default:
                                    error_log("database (2598) missing stream data SPECIALTY_TYPE. die().");
                                    die();
                                break;


                            }

                        break;
					}

					if($oUser->getReqParamByKey('STREAM_ID')==""){
                        $tmp_stream_id_crc = 0;  // CANNOT INSERT EMPTY STRING INTO INTEGER FIELD. BUMMER...WOULD PREFER NULL IN THE FIELD.
                    }else{
                        $tmp_stream_id_crc =  crc32($oUser->getReqParamByKey('STREAM_ID'));
                    }

                    if($oUser->getReqParamByKey('KIVOTOS_ID')==""){
                        $tmp_kivotos_id_crc = 0;  // CANNOT INSERT EMPTY STRING INTO INTEGER FIELD. BUMMER...WOULD PREFER NULL IN THE FIELD.
                    }else{
                        $tmp_kivotos_id_crc =  crc32($oUser->getReqParamByKey('KIVOTOS_ID'));
                    }

                    //
                    // FORMAT LINKS AND MENTIONS IN DESCRIPTION
                    if(!isset($oInputTransformer)){

                        $oInputTransformer = new transformer($oUserEnvironment, $this, $oUser);
                    }

                    $tmp_content_format_DESC_ARRAY = $oInputTransformer->returnTransformedInput('LINKS', $oUser->getReqParamByKey("DESCRIPTION"));  // 2 DIM ARRAY RETURN

                    $tmp_formatted_content = $tmp_content_format_DESC_ARRAY['STYLED_CONTENT'];  // GET LINKED CONTENT (PROXY AND INTERNAL)

                    //
                    // PROCESS MENTIONS
                    $oInputTransformer = $this->process_mentions($tmp_formatted_content, $oUser, $oUserEnvironment, $oDB_RESP, $oInputTransformer, $oUser->getReqParamByKey("STREAM_MENTIONS_EID"), $queryType);

                    $tmp_formatted_content = $oInputTransformer->formatted_content;

                    self::$query .= $tmp_content_format_DESC_ARRAY['QUERY'];
                    self::$query .= 'INSERT INTO `assets`(`ASSET_ID`,`ASSET_ID_CRC32`,`CLIENT_ID`,`CLIENT_ID_CRC32`,`KIVOTOS_ID`,`KIVOTOS_ID_CRC32`,`STREAM_ID`,`STREAM_ID_CRC32`,`USER_ID`,
                    `USER_ID_CRC32`,`ASSIGNED_ID`,`ASSIGNED_ID_CRC32`,`ASSET_TYPE_KEY`,`SPECIALTY_TYPE_KEY`,`DLOAD_END_POINT`,`PREVIEW_END_POINT`,`FILE_MD5`,`FILE_SHA1`,`FILE_NAME`,`FILE_EXT`,`FILE_SIZE`,`FILE_MIME_TYPE`,`FILE_PATH`,
                    `FILE_PATH_LARGE`,`FILE_PATH_MED`,`FILE_PATH_SMALL`,`NAME`,`DESCRIPTION`,`DESCRIPTION_RAW`,`LANGCODE`,`CHANNEL`,`DATEMODIFIED`) VALUES (
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('ASSET_ID')).'",
					"'.crc32($oUser->getReqParamByKey('ASSET_ID')).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('CLIENT_ID')).'",
					"'.crc32($oUser->getReqParamByKey('CLIENT_ID')).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('KIVOTOS_ID')).'",
					"'.$tmp_kivotos_id_crc.'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('STREAM_ID')).'",
					"'.$tmp_stream_id_crc.'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('USER_ID')).'",
					"'.crc32($oUser->getReqParamByKey('USER_ID')).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('USER_ID')).'",
					"'.crc32($oUser->getReqParamByKey('USER_ID')).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("ASSET_TYPE")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("SPECIALTY_TYPE")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("ASSET_DLOAD_ENDPOINT")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("ASSET_PREVIEW_ENDPOINT")).'",
					UNHEX("'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("FILE_MD5")).'"),
					UNHEX("'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("FILE_SHA1")).'"),
					"'.self::$mysqli->real_escape_string($oUserEnvironment->paramTunnelEncrypt($oUser->getReqParamByKey("FILE_NAME"))).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("FILE_EXT")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("FILE_SIZE")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("FILE_MIME_TYPE")).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->paramTunnelEncrypt($oUser->getReqParamByKey("FILE_PATH"))).'",
					"'.self::$mysqli->real_escape_string($tmp_FILE_PATH_LARGE).'",
					"'.self::$mysqli->real_escape_string($tmp_FILE_PATH_MED).'",
					"'.self::$mysqli->real_escape_string($tmp_FILE_PATH_SMALL).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("NAME")).'",
					"'.self::$mysqli->real_escape_string($tmp_formatted_content).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("DESCRIPTION")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("LANGCODE")).'",
					"'.self::$mysqli->real_escape_string(strtoupper($oUser->getReqParamByKey("CHANNEL"))).'",
					"'.$ts.'");';
					
					self::$query .= 'INSERT INTO `file_system_activity_log`(`CLIENT_ID`,`KIVOTOS_ID`,`STREAM_ID`,`USER_ID`,`ASSET_ID`,`DOWNLOAD_END_POINT`,`FILE_EXT`,`FILE_SIZE`,`DATEMODIFIED`) VALUES (
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('CLIENT_ID')).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('KIVOTOS_ID')).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('STREAM_ID')).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('USER_ID')).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('ASSET_ID')).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("ASSET_DLOAD_ENDPOINT")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("FILE_EXT")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("FILE_SIZE")).'",
					"'.$ts.'");';
					
					self::$query .= 'INSERT INTO `log_sys_user` (`ACTIVITY_ID`,`CLIENT_ID`,`CLIENT_ID_CRC32`,`KIVOTOS_ID`,`KIVOTOS_ID_CRC32`,`STREAM_ID`,`STREAM_ID_CRC32`,`USER_ID`,`USER_ID_CRC32`,`ASSET_ID`,`ASSET_ID_CRC32`,
																 `ACTIVITY_DESCRIPTION`,`PHPSESSION`,`IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`) VALUES (
					"'.$tmp_activityid.'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("CLIENT_ID")).'",
					"'.crc32($oUser->getReqParamByKey("CLIENT_ID")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("KIVOTOS_ID")).'",
					"'.$tmp_kivotos_id_crc.'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('STREAM_ID')).'",
					"'.$tmp_stream_id_crc.'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("USER_ID")).'",
					"'.crc32($oUser->getReqParamByKey("USER_ID")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('ASSET_ID')).'",
					"'.crc32($oUser->getReqParamByKey('ASSET_ID')).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
					"'.session_id().'",
					"'.$_SERVER['REMOTE_ADDR'].'",
					"'.$_SERVER['HTTP_USER_AGENT'].'",
					"'.self::$mysqli->real_escape_string(strtoupper($oUser->getReqParamByKey("CHANNEL"))).'");';

                    #error_log("database (2973) use dataaug here...");
					$tmp_search_str = $dataAugmenter->getData('USER',0,'FIRSTNAME_BLOB','DATA_AUG_01').$dataAugmenter->getData('USER',0,'LASTNAME_BLOB','DATA_AUG_01').$tmp_activity_descript;
                    #error_log("database (2975) use dataaug DONE...");

					self::$query .= 'INSERT INTO `log_sys_user_search` (`SEARCH_ID`,`SEARCH_CONTENT`,`CLIENT_ID`,`CLIENT_ID_CRC32`,`USER_ID`,`USER_ID_CRC32`,`KIVOTOS_ID`,`KIVOTOS_ID_CRC32`,`ASSET_ID`,`ASSET_ID_CRC32`,`STREAM_ID`,`STREAM_ID_CRC32`,`CONTENT_LENGTH`,`ACTIVITY_DESCRIPTION`) VALUES
					("'.$tmp_activityid.'",
					"'.self::$mysqli->real_escape_string(strtolower($oUser->searchCleanStr($tmp_search_str))).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("CLIENT_ID")).'",
					"'.crc32($oUser->getReqParamByKey("CLIENT_ID")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("USER_ID")).'",
					"'.crc32($oUser->getReqParamByKey("USER_ID")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("KIVOTOS_ID")).'",
					"'.$tmp_kivotos_id_crc.'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('ASSET_ID')).'",
					"'.crc32($oUser->getReqParamByKey('ASSET_ID')).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('STREAM_ID')).'",
					"'.$tmp_stream_id_crc.'",
					"'.strlen($oUser->searchCleanStr($tmp_search_str)).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'");';
					
					$tmp_assetSearch_str = $oUser->getReqParamByKey("NAME").$oUser->getReqParamByKey("DESCRIPTION").$oUser->getReqParamByKey("FILE_EXT");
					self::$query .= 'INSERT INTO `assets_search` (`SEARCH_ID`,`SEARCH_CONTENT`,`CLIENT_ID`,`CLIENT_ID_CRC32`,`KIVOTOS_ID`,`ASSET_ID`,`STREAM_ID`,`CONTENT_LENGTH`,`NAME`,`DESCRIPTION`,`DATEMODIFIED`) VALUES
					("'.$tmp_activityid.'",
					"'.self::$mysqli->real_escape_string(strtolower($oUser->searchCleanStr($tmp_assetSearch_str))).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("CLIENT_ID")).'",
					"'.crc32($oUser->getReqParamByKey("CLIENT_ID")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("KIVOTOS_ID")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('ASSET_ID')).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey('STREAM_ID')).'",
					"'.strlen($oUser->searchCleanStr($tmp_assetSearch_str)).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("NAME")).'",
					"'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("DESCRIPTION")).'",
					"'.$ts.'");';
					
					#error_log("database (864) query->".self::$query);
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
					if(self::$mysqli->error){
						self::$query_exception_result = "save_asset_content=error=".self::$mysqli->error;
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}else{


                        do{
                        } while (self::$mysqli->more_results() && self::$mysqli->next_result());

                        //
                        // INCREMENT FEEDER_STREAM_COUNT FOR $oUser->retrieve_Form_Data("I_FEED_STREAM_ID")
                        $force_profile_select_align = true;
                        $db_resp_process_serial = "HALLELUJAH Christ is victor!";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                        $db_resp_serial_key = 'STREAM_COUNT';
                        $db_resp_target_profiles = 'STREAM';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                        $db_resp_profile_field_cnt = '1';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.
                        $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                        //
                        // QUERY CONSTRUCTION
                        $tmp_SELECT_ARRAY = array();
                        $tmp_SELECT_ARRAY[0] = '`comm_stream`.`FEEDER_STREAM_COUNT`';

                        self::$query = 'SELECT '.$tmp_SELECT_ARRAY[0].' FROM `comm_stream` WHERE `comm_stream`.`STREAM_ID`="'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("I_FEED_STREAM_ID")).'" AND `comm_stream`.`STREAM_ID_CRC32`="'.crc32($oUser->getReqParamByKey("I_FEED_STREAM_ID")).'" LIMIT 1;';

                        $oDB_RESP->process(self::$mysqli,$queryType,$tmp_SELECT_ARRAY,self::$query);

                        $tmp_count = $oDB_RESP->return_data_element($oDB_RESP->return_serial('STREAM_COUNT'), 'STREAM', 'FEEDER_STREAM_COUNT');
                        $tmp_count++;

                        //error_log("database (2667) new feeder stream count=[".$tmp_count."] for this stream");

                        self::$query = 'UPDATE `comm_stream`
                        SET
                        `FEEDER_STREAM_COUNT` = "'.self::$mysqli->real_escape_string($tmp_count).'",
                        `DATEMODIFIED` = "'.$ts.'"
                        WHERE `STREAM_ID` = "'.self::$mysqli->real_escape_string($oUser->getReqParamByKey("I_FEED_STREAM_ID")).'" AND `STREAM_ID_CRC32`="'.crc32($oUser->getReqParamByKey("I_FEED_STREAM_ID")).'" LIMIT 1;
                        ';

                        self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);

                        if(self::$mysqli->error){
                            self::$query_exception_result = "error";
                            throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                        }else {

                            do{
                            } while (self::$mysqli->more_results() && self::$mysqli->next_result());

                            $oUser->save_Form_Data('MENTION_ARRAY', $oInputTransformer->return_mention_id());
                            $oUser->save_Form_Data('KIVOTOS_ID', $oUser->getReqParamByKey("KIVOTOS_ID"));
                            $oUser->save_Form_Data('STREAM_ID', $oUser->getReqParamByKey("STREAM_ID"));
                            $oUser->save_Form_Data('ASSET_ID', $oUser->getReqParamByKey("ASSET_ID"));
                            $oUser->save_Form_Data('CLIENT_ID', $oUser->getReqParamByKey("CLIENT_ID"));
                            $oUser->save_Form_Data('ASSET_TYPE', $oUser->getReqParamByKey("ASSET_TYPE"));
                            $oUser->save_Form_Data('SPECIALTY_TYPE', $oUser->getReqParamByKey("SPECIALTY_TYPE"));

                            //
                            // BRING IN THE MESSENGER
                            // Luke 1:19, 26; Daniel 8:16; 9:21-22
                            $oGabriel = new messenger_from_north($this, $oUser, $oUserEnvironment, $oDB_RESP);
                            $oGabriel->scroll_messages($queryType);
                            $oGabriel->deliver_scroll();

                            return "success";

                        }

					}

				break;
				case 'update_kivotos_remove_useraccess':
					$ID_ARRAY[0] = $oUser->retrieve_Form_Data("REMOVEACCESS_USER_ID");
					$IDTYPE_ARRAY[0] = "USER";

                    $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                    $dataAugmenter = new dataAugmentation(self::$mysqli,$oUserEnvironment,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);
					#$dataAugmenter = new dataAugmentation(self::$mysqli,$oUserEnvironment,$ID_ARRAY,$IDTYPE_ARRAY);
					
					$tmp_activity_descript = $dataAugmenter->getData('USER',0,'FIRSTNAME_BLOB')." ".$dataAugmenter->getData('USER',0,'LASTNAME_BLOB',0)." has lost access to the kivot&oacute;s (".$oUser->retrieve_Form_Data("NAME").").";
					$tmp_activityid = $oUser->generateNewKey(70);
					
					
					/*
					self::$frm_input_ARRAY["REMOVEACCESS_USER_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'uid'));
		self::$frm_input_ARRAY["KIVOTOS_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'kid'));
		self::$frm_input_ARRAY["CLIENT_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'cid'));
		self::$frm_input_ARRAY["ACCESS_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'aid'));
		self::$frm_input_ARRAY["NAME"]
					*/
					//
					// DELETE EXISTING USER-CLIENT RECORD IF EXISTS
					self::$query = 'DELETE from `kivotos_access` where `ACCESS_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ACCESS_ID")).'" AND `KIVOTOS_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" AND `KIVOTOS_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" AND USER_ID="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("REMOVEACCESS_USER_ID")).'" AND USER_ID_CRC32="'.crc32($oUser->retrieve_Form_Data("REMOVEACCESS_USER_ID")).'" LIMIT 1;';
					
					self::$query .= 'INSERT INTO `log_sys_user` (`ACTIVITY_ID`,`CLIENT_ID`,`CLIENT_ID_CRC32`,`KIVOTOS_ID`,`KIVOTOS_ID_CRC32`,`USER_ID`,`USER_ID_CRC32`,`ACTIVITY_DESCRIPTION`,`PHPSESSION`,
																 `IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`) VALUES (
					"'.$tmp_activityid.'",
					"'.$oUser->retrieve_Form_Data("CLIENT_ID").'",
					"'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
					"'.$oUser->retrieve_Form_Data("KIVOTOS_ID").'",
					"'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
					"'.$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID').'",
					"'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
					"'.session_id().'",
					"'.$_SERVER['REMOTE_ADDR'].'",
					"'.$_SERVER['HTTP_USER_AGENT'].'",
					"'.strtoupper($oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")).'"
					);';
					
					$tmp_search_str = $oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME').$oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME').$tmp_activity_descript;
					self::$query .= 'INSERT INTO `log_sys_user_search` (`SEARCH_ID`,
                    `SEARCH_CONTENT`,
                    `CLIENT_ID`,
                    `CLIENT_ID_CRC32`,
                    `USER_ID`,
                    `USER_ID_CRC32`,
                    `KIVOTOS_ID`,
                    `KIVOTOS_ID_CRC32`,
                    `CONTENT_LENGTH`,`ACTIVITY_DESCRIPTION`)
                    VALUES
                    ("'.$tmp_activityid.'",
                     "'.self::$mysqli->real_escape_string(strtolower($oUser->searchCleanStr($tmp_search_str))).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
                    "'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
                    "'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
                    "'.strlen($oUser->searchCleanStr($tmp_search_str)).'","'.self::$mysqli->real_escape_string($tmp_activity_descript).'");';
					
					error_log("database (165) query->".self::$query);
					
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
					if(self::$mysqli->error){
						self::$query_exception_result="update_kivotos_add_useraccess=false";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}else{
						return 'update_kivotos_remove_useraccess=success';	
					}
					
				break;
				case 'update_kivotos_add_useraccess':
					/*self::$frm_input_ARRAY["GRANTACCESS_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'grantUserAccess_ID'));
		self::$frm_input_ARRAY["KIVOTOS_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'kid'));
		self::$frm_input_ARRAY["CLIENT_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'cid'));
		self::$frm_input_ARRAY["NAME"]*/
					$ID_ARRAY[0] = $oUser->retrieve_Form_Data("GRANTACCESS_ID");
					$IDTYPE_ARRAY[0] = "USER";

                    $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                    $dataAugmenter = new dataAugmentation(self::$mysqli,$oUserEnvironment,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);
					#$dataAugmenter = new dataAugmentation(self::$mysqli,$oUserEnvironment,$ID_ARRAY,$IDTYPE_ARRAY);
					
					$tmp_activity_descript = $dataAugmenter->getData('USER',0,'FIRSTNAME_BLOB')." ".$dataAugmenter->getData('USER',0,'LASTNAME_BLOB',0)." has been given exclusive access to the kivot&oacute;s (".$oUser->retrieve_Form_Data("NAME").").";
					$tmp_activityid = $oUser->generateNewKey(70);
					$tmp_accessid = $oUser->generateNewKey(50);
					
					//
					// DELETE EXISTING USER-CLIENT RECORD IF EXISTS
					self::$query = 'DELETE from `kivotos_access` where `KIVOTOS_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" AND `KIVOTOS_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" AND USER_ID="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("GRANTACCESS_ID")).'" AND USER_ID_CRC32="'.crc32($oUser->retrieve_Form_Data("GRANTACCESS_ID")).'" LIMIT 1;';
					
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
					
					if(self::$mysqli->error){
						self::$query_exception_result="update_user_client_access=false";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}	
					
					self::$query = NULL;
					
					self::$query = 'INSERT INTO `kivotos_access` (`ACCESS_ID`,`KIVOTOS_ID`,`KIVOTOS_ID_CRC32`,`USER_ID`,`USER_ID_CRC32`) VALUES (
								"'.$tmp_accessid.'",
								"'.$oUser->retrieve_Form_Data("KIVOTOS_ID").'",
								"'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
								"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("GRANTACCESS_ID")).'",
								"'.crc32($oUser->retrieve_Form_Data("GRANTACCESS_ID")).'");';
					
					self::$query .= 'INSERT INTO `log_sys_user` (`ACTIVITY_ID`,`CLIENT_ID`,`CLIENT_ID_CRC32`,`KIVOTOS_ID`,`KIVOTOS_ID_CRC32`,`USER_ID`,`USER_ID_CRC32`,`ACTIVITY_DESCRIPTION`,`PHPSESSION`,
																 `IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`) VALUES (
					"'.$tmp_activityid.'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'",
					"'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
					"'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
					"'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
					"'.session_id().'",
					"'.$_SERVER['REMOTE_ADDR'].'",
					"'.$_SERVER['HTTP_USER_AGENT'].'",
					"'.strtoupper($oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")).'"
					);';
					
					$tmp_search_str = $oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME').$oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME').$tmp_activity_descript;
					self::$query .= 'INSERT INTO `log_sys_user_search` (`SEARCH_ID`,
                    `SEARCH_CONTENT`,
                    `CLIENT_ID`,
                    `CLIENT_ID_CRC32`,
                    `USER_ID`,
                    `USER_ID_CRC32`,
                    `KIVOTOS_ID`,
                    `KIVOTOS_ID_CRC32`,
                    `CONTENT_LENGTH`,`ACTIVITY_DESCRIPTION`)
                    VALUES
                    ("'.$tmp_activityid.'",
                     "'.self::$mysqli->real_escape_string(strtolower($oUser->searchCleanStr($tmp_search_str))).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
                    "'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
                    "'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
                    "'.strlen($oUser->searchCleanStr($tmp_search_str)).'","'.self::$mysqli->real_escape_string($tmp_activity_descript).'");';
					
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
					if(self::$mysqli->error){
						self::$query_exception_result="update_kivotos_add_useraccess=false";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}
					
					return 'update_kivotos_add_useraccess=success';
				break;
				case 'update_kivotos_assigned':
					/*
					tmp_IDTYPE_ARRAY options [USER|KIVOTOS|ASSET|COMMENT|]
					
					self::$frm_input_ARRAY["ASSIGNED_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'assigned_ID'));
					self::$frm_input_ARRAY["KIVOTOS_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'kid'));
					self::$frm_input_ARRAY["CLIENT_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'cid'));
					self::$frm_input_ARRAY["NAME"]
					
					*/
					
					$ID_ARRAY[0] = $oUser->retrieve_Form_Data("ASSIGNED_ID");
					$IDTYPE_ARRAY[0] = "USER";

                    $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                    $dataAugmenter = new dataAugmentation(self::$mysqli,$oUserEnvironment,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);
					#$dataAugmenter = new dataAugmentation(self::$mysqli,$oUserEnvironment,$ID_ARRAY,$IDTYPE_ARRAY);
					
					$tmp_activity_descript = "The kivot&oacute;s (<span class='a_log_topic_name'>".$oUser->retrieve_Form_Data("NAME")."</span>) has been assigned to ".$dataAugmenter->getData('USER',0,'FIRSTNAME_BLOB')." ".$dataAugmenter->getData('USER',0,'LASTNAME_BLOB',0).".";
					$tmp_activityid = $oUser->generateNewKey(70);
					
					self::$query = 'UPDATE `kivotos` SET 
					`ASSIGNED_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ASSIGNED_ID")).'",
					`ASSIGNED_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("ASSIGNED_ID")).'",
					`DATEMODIFIED`="'.$ts.'" 
					WHERE `KIVOTOS_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" AND 
					`KIVOTOS_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" LIMIT 1;';
					
					self::$query .= 'INSERT INTO `log_sys_user` (`ACTIVITY_ID`,`CLIENT_ID`,`CLIENT_ID_CRC32`,`KIVOTOS_ID`,`KIVOTOS_ID_CRC32`,`USER_ID`,`USER_ID_CRC32`,`ACTIVITY_DESCRIPTION`,`PHPSESSION`,
																 `IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`) VALUES (
					"'.$tmp_activityid.'",
					"'.$oUser->retrieve_Form_Data("CLIENT_ID").'",
					"'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
					"'.$oUser->retrieve_Form_Data("KIVOTOS_ID").'",
					"'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
					"'.$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID').'",
					"'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
					"'.session_id().'",
					"'.$_SERVER['REMOTE_ADDR'].'",
					"'.$_SERVER['HTTP_USER_AGENT'].'",
					"'.strtoupper($oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")).'"
					);';
					
					$tmp_search_str = $oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME').$oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME').$tmp_activity_descript;
					self::$query .= 'INSERT INTO `log_sys_user_search` (`SEARCH_ID`,
                    `SEARCH_CONTENT`,
                    `CLIENT_ID`,
                    `CLIENT_ID_CRC32`,
                    `USER_ID`,
                    `USER_ID_CRC32`,
                    `KIVOTOS_ID`,
                    `KIVOTOS_ID_CRC32`,
                    `CONTENT_LENGTH`,`ACTIVITY_DESCRIPTION`)
                    VALUES
                    ("'.$tmp_activityid.'",
                     "'.self::$mysqli->real_escape_string(strtolower($oUser->searchCleanStr($tmp_search_str))).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
                    "'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
                    "'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
                    "'.strlen($oUser->searchCleanStr($tmp_search_str)).'","'.self::$mysqli->real_escape_string($tmp_activity_descript).'");';
					
					#error_log("database (169) query->".self::$query);
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
					if(self::$mysqli->error){
						self::$query_exception_result="update_kivotos_assigned=false";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}
					
					return 'update_kivotos_assigned=success';	
					
					
				break;
				case 'update_kivotos_visibility':
					$tmp_isprivate = $oUser->retrieve_Form_Data("ISPRIVATE");
					switch($tmp_isprivate){
						case 1:
							$tmp_activity_descript = "The kivot&oacute;s (<span class='a_log_topic_name'>".$oUser->retrieve_Form_Data("NAME")."</span>) has been flagged as private.";
						break;
						default:
							$tmp_isprivate = 0;
							$tmp_activity_descript = "The kivot&oacute;s (<span class='a_log_topic_name'>".$oUser->retrieve_Form_Data("NAME")."</span>) has been flagged as visible.";
						break;
					}
					
					$tmp_activityid = $oUser->generateNewKey(70);
					
					self::$query = 'UPDATE `kivotos` SET 
					`ISPRIVATE`="'.self::$mysqli->real_escape_string($tmp_isprivate).'",
					`DATEMODIFIED`="'.$ts.'" 
					WHERE `KIVOTOS_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" AND 
					`KIVOTOS_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" LIMIT 1;';
					
					self::$query .= 'INSERT INTO `log_sys_user` (`ACTIVITY_ID`,`CLIENT_ID`,`CLIENT_ID_CRC32`,`KIVOTOS_ID`,`KIVOTOS_ID_CRC32`,`USER_ID`,`USER_ID_CRC32`,`ACTIVITY_DESCRIPTION`,`PHPSESSION`,
																 `IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`) VALUES (
					"'.$tmp_activityid.'",
					"'.$oUser->retrieve_Form_Data("CLIENT_ID").'",
					"'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
					"'.$oUser->retrieve_Form_Data("KIVOTOS_ID").'",
					"'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
					"'.$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID').'",
					"'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
					"'.session_id().'",
					"'.$_SERVER['REMOTE_ADDR'].'",
					"'.$_SERVER['HTTP_USER_AGENT'].'",
					"'.strtoupper($oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")).'"
					);';
					
					$tmp_search_str = $oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME').$oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME').$tmp_activity_descript;
					self::$query .= 'INSERT INTO `log_sys_user_search` (`SEARCH_ID`,
                    `SEARCH_CONTENT`,
                    `CLIENT_ID`,
                    `CLIENT_ID_CRC32`,
                    `USER_ID`,
                    `USER_ID_CRC32`,
                    `KIVOTOS_ID`,
                    `KIVOTOS_ID_CRC32`,
                    `CONTENT_LENGTH`,`ACTIVITY_DESCRIPTION`)
                    VALUES
                    ("'.$tmp_activityid.'",
                     "'.self::$mysqli->real_escape_string(strtolower($oUser->searchCleanStr($tmp_search_str))).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
                    "'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
                    "'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
                    "'.strlen($oUser->searchCleanStr($tmp_search_str)).'","'.self::$mysqli->real_escape_string($tmp_activity_descript).'");';
					
					#error_log("database (169) query->".self::$query);
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
					if(self::$mysqli->error){
						self::$query_exception_result="update_kivotos_visibility=false";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}
					
					return 'update_kivotos_visibility=success';	
					
					
				break;
				case 'get_kivotos_details_simple':
					//
					// KIVOTOS
					self::$query = 'SELECT `kivotos`.`KIVOTOS_ID`,`kivotos`.`ISACTIVE` ,`kivotos`.`ISPRIVATE`, `kivotos`.`CLIENT_ID`, `kivotos`.`CREATOR_ID`,`kivotos`.`ASSIGNED_ID`, `kivotos`.`SEARCH_ID`, `kivotos`.`NAME`,`kivotos`.`DESCRIPTION`,`kivotos`.`DUE_DATE`,`kivotos`.`STATE`,`kivotos`.`DATEMODIFIED`,`kivotos`.`DATECREATED` FROM `kivotos` WHERE `kivotos`.`KIVOTOS_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" AND `kivotos`.`KIVOTOS_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" LIMIT 1;';

					self::$query .= 'SELECT `clients`.`CLIENT_ID`, `clients`.`COMPANYNAME_BLOB`, `clients`.`LANGCODE`, `clients`.`DATECREATED`  FROM `clients`;';

					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

					//
					// CLEAR RESULT ARRAY
					array_splice(self::$result_ARRAY, 0);

					$ROWCNT=0;
					do {
						if (self::$result = self::$mysqli->store_result()) {
							while ($row = self::$result->fetch_row()) {
								foreach($row as $fieldPos=>$value){
									//
									// STORE RESULT
									self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;

								}
								$ROWCNT++;
							}
							self::$result->free();
						}

						if (self::$mysqli->more_results()) {
							//
							// END OF RECORD. MORE TO FOLLOW.
						}
					} while (self::$mysqli->more_results() && self::$mysqli->next_result());

					return self::$result_ARRAY;


				break;
				case 'update_kivotos_duedate':
						
					$tmp_activity_descript = "The due date of the kivot&oacute;s (<span class='a_log_topic_name'>".$oUser->retrieve_Form_Data("NAME")."</span>) has been updated to <span class='a_log_kivotos_duedate'>".$oUser->retrieve_Form_Data("DUE_DATE")."</span>.";
					$tmp_activityid = $oUser->generateNewKey(70);
					
					self::$query = 'UPDATE `kivotos` SET 
					`DUE_DATE`="'.self::$mysqli->real_escape_string(date("Y-m-d H:i:s", strtotime($oUser->retrieve_Form_Data("DUE_DATE")))).'",
					`DATEMODIFIED`="'.$ts.'" 
					WHERE `KIVOTOS_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" AND 
					`KIVOTOS_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" LIMIT 1;';
					
					self::$query .= 'INSERT INTO `log_sys_user` (`ACTIVITY_ID`,`CLIENT_ID`,`CLIENT_ID_CRC32`,`KIVOTOS_ID`,`KIVOTOS_ID_CRC32`,`USER_ID`,`USER_ID_CRC32`,`ACTIVITY_DESCRIPTION`,`PHPSESSION`,
																 `IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`) VALUES (
					"'.$tmp_activityid.'",
					"'.$oUser->retrieve_Form_Data("CLIENT_ID").'",
					"'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
					"'.$oUser->retrieve_Form_Data("KIVOTOS_ID").'",
					"'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
					"'.$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID').'",
					"'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
					"'.session_id().'",
					"'.$_SERVER['REMOTE_ADDR'].'",
					"'.$_SERVER['HTTP_USER_AGENT'].'",
					"'.strtoupper($oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")).'",
					);';
					
					$tmp_search_str = $oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME').$oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME').$tmp_activity_descript;
					self::$query .= 'INSERT INTO `log_sys_user_search` (`SEARCH_ID`,
                    `SEARCH_CONTENT`,
                    `CLIENT_ID`,
                    `CLIENT_ID_CRC32`,
                    `USER_ID`,
                    `USER_ID_CRC32`,
                    `KIVOTOS_ID`,
                    `KIVOTOS_ID_CRC32`,
                    `CONTENT_LENGTH`,`ACTIVITY_DESCRIPTION`)
                    VALUES
                    ("'.$tmp_activityid.'",
                     "'.self::$mysqli->real_escape_string(strtolower($oUser->searchCleanStr($tmp_search_str))).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
                    "'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
                    "'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
                    "'.strlen($oUser->searchCleanStr($tmp_search_str)).'","'.self::$mysqli->real_escape_string($tmp_activity_descript).'");';
					
					#error_log("database (169) query->".self::$query);
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
					if(self::$mysqli->error){
						self::$query_exception_result="update_kivotos_duedate=false";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}
					
					return 'update_kivotos_duedate=success';		
				break;
				case 'update_kivotos_status':
					/*
					self::$frm_input_ARRAY["KIVOTOS_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'kid'));
		self::$frm_input_ARRAY["NAME"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'kivotosName'));
		self::$frm_input_ARRAY["STATUS"] 
					*/
					
					foreach($oUser->kivotosState as $tmp_type=>$tmp_id){
						if($oUser->retrieve_Form_Data("STATUS")==$tmp_id){
							$tmp_Status = $tmp_type;
						}
					}
					
					//
					// HOW DO YOU WANT TO HANDLE THE LANG ENGINE FOR THIS?
					if(!isset($tmp_Status)){
						$tmp_Status = "unknown";
					}
						
					$tmp_activity_descript = "The status of the kivot&oacute;s (<span class='a_log_topic_name'>".$oUser->retrieve_Form_Data("NAME")."</span>) has been updated to <span class='a_log_kivotos_status'>".$tmp_Status."</span>.";
					$tmp_activityid = $oUser->generateNewKey(70);
					
					self::$query = 'UPDATE `kivotos` SET 
					`STATE`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("STATUS")).'",
					`DATEMODIFIED`="'.$ts.'" 
					WHERE `KIVOTOS_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" AND 
					`KIVOTOS_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" LIMIT 1;';
					
					self::$query .= 'INSERT INTO `log_sys_user` (`ACTIVITY_ID`,`CLIENT_ID`,`CLIENT_ID_CRC32`,`KIVOTOS_ID`,`KIVOTOS_ID_CRC32`,`USER_ID`,`USER_ID_CRC32`,`ACTIVITY_DESCRIPTION`,`PHPSESSION`,
																 `IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`) VALUES (
					"'.$tmp_activityid.'",
					"'.$oUser->retrieve_Form_Data("CLIENT_ID").'",
					"'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
					"'.$oUser->retrieve_Form_Data("KIVOTOS_ID").'",
					"'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
					"'.$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID').'",
					"'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
					"'.session_id().'",
					"'.$_SERVER['REMOTE_ADDR'].'",
					"'.$_SERVER['HTTP_USER_AGENT'].'",
					"'.strtoupper($oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")).'"
					);';
					
					$tmp_search_str = $oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME').$oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME').$tmp_activity_descript;
					self::$query .= 'INSERT INTO `log_sys_user_search` (`SEARCH_ID`,
                    `SEARCH_CONTENT`,
                    `CLIENT_ID`,
                    `CLIENT_ID_CRC32`,
                    `USER_ID`,
                    `USER_ID_CRC32`,
                    `KIVOTOS_ID`,
                    `KIVOTOS_ID_CRC32`,
                    `CONTENT_LENGTH`,`ACTIVITY_DESCRIPTION`)
                    VALUES
                    ("'.$tmp_activityid.'",
                     "'.self::$mysqli->real_escape_string(strtolower($oUser->searchCleanStr($tmp_search_str))).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
                    "'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
                    "'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'",
                    "'.strlen($oUser->searchCleanStr($tmp_search_str)).'","'.self::$mysqli->real_escape_string($tmp_activity_descript).'");';

					#error_log("database (169) query->".self::$query);
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
					if(self::$mysqli->error){
						self::$query_exception_result="admin_client_delete=false";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}
					
					return 'update_kivotos_status=success';					
					
				break;
				case 'get_kivotos_search_ajax':
				
					$val = $oUser->searchCleanStr($oUser->retrieve_Form_Data("Q"));
					
					self::$query = 'SELECT `kivotos_search`.`KIVOTOS_ID`,`kivotos_search`.`NAME` ,`kivotos_search`.`DESCRIPTION` FROM `kivotos_search` 
					WHERE `kivotos_search`.`SEARCH_CONTENT` LIKE "%'.self::$mysqli->real_escape_string($val).'%";';
					
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
					
					//
					// CLEAR RESULT ARRAY
					array_splice(self::$result_ARRAY, 0);
					
					if(self::$mysqli->error){
						self::$query_exception_result = "get_all_kivotos=error";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}else{
						
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						$ROWCNT=0;
						while ($row = self::$result->fetch_row()) {
							foreach($row as $fieldPos=>$value){
								//
								// STORE RESULT
								self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
								
							}
							$ROWCNT++;
						}
						self::$result->free();
						
					}
					
					return self::$result_ARRAY;
				
				break;
				case 'get_all_kivotos':
					self::$query = 'SELECT `kivotos`.`KIVOTOS_ID`,`kivotos`.`ISACTIVE` ,`kivotos`.`ISPRIVATE`, `kivotos`.`CLIENT_ID`, `kivotos`.`CREATOR_ID`, 
					`kivotos`.`ASSIGNED_ID`, `kivotos`.`SEARCH_ID`, `kivotos`.`NAME`,`kivotos`.`DESCRIPTION`,`kivotos`.`DATEMODIFIED`,`kivotos`.`DATECREATED` FROM `kivotos` WHERE 
					`kivotos`.`ISACTIVE`="1" ORDER BY DATECREATED DESC;';
					
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
					
					//
					// CLEAR RESULT ARRAY
					array_splice(self::$result_ARRAY, 0);
					
					if(self::$mysqli->error){
						self::$query_exception_result = "get_all_kivotos=error";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}else{
						
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						$ROWCNT=0;
						while ($row = self::$result->fetch_row()) {
							foreach($row as $fieldPos=>$value){
								//
								// STORE RESULT
								self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
								
							}
							$ROWCNT++;
						}
						self::$result->free();
						
					}
					
					return self::$result_ARRAY;
					
					
				break;
				case 'create_kivotos':
					
					/*
					self::$frm_input_ARRAY["CLIENT_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'cid'));
					self::$frm_input_ARRAY["NAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'kivotosname');
					self::$frm_input_ARRAY["DESCRIPTION"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'description');
					self::$frm_input_ARRAY["ASSIGN_USERID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'user_assign'));
					self::$frm_input_ARRAY["ISPRIVATE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'isprivate');
					*/
					
					$this->sysLangLoad("TEXT_STRENGTHEN_WEB|LIST_FTAF|TEXT_HOME_PAGE_COPY_SECT01", $oUserEnvironment, $oUser);
					
					//error_log("database (137) TEXT_STRENGTHEN_WEB ->".$oUser->getLangElem('TEXT_STRENGTHEN_WEB'));
					
					$tmp_activity_descript = "The kivot&oacute;s (<span class='a_log_topic_name'>".$oUser->retrieve_Form_Data("NAME")."</span>) has been created in the e<span class='the_V'>V</span>ifweb client extranet.";
					$tmp_activityid = $oUser->generateNewKey(70);
					$tmp_kivotosid = $oUser->generateNewKey(70);
					$tmp_searchid = $oUser->generateNewKey(70);

					//
                    // FORMAT LINKS AND MENTIONS IN DESCRIPTION
                    $oInputTransformer = new transformer($oUserEnvironment, $this, $oUser);
                    $tmp_content_format_ARRAY = $oInputTransformer->returnTransformedInput('LINKS', $oUser->retrieve_Form_Data("DESCRIPTION"));  // 2 DIM ARRAY RETURN

                    $tmp_formatted_content = $tmp_content_format_ARRAY['STYLED_CONTENT'];  // GET LINKED CONTENT (PROXY AND INTERNAL)

                    //
                    // PROCESS MENTIONS
                    $oInputTransformer = $this->process_mentions($tmp_formatted_content, $oUser, $oUserEnvironment, $oDB_RESP, $oInputTransformer, $oUser->retrieve_Form_Data("STREAM_MENTIONS_EID"), $queryType);

                    $tmp_formatted_content = $oInputTransformer->formatted_content;

                    self::$query = $tmp_content_format_ARRAY['QUERY'];
					self::$query .= 'INSERT INTO `kivotos` (`KIVOTOS_ID`,`KIVOTOS_ID_CRC32`,`CLIENT_ID`,`CLIENT_ID_CRC32`,`CREATOR_ID`,`CREATOR_ID_CRC32`,`ASSIGNED_ID`,`ASSIGNED_ID_CRC32`,`SEARCH_ID`,`ISPRIVATE`,
														   `NAME`,`DESCRIPTION`,`DESCRIPTION_RAW`,`DATEMODIFIED`) VALUES (
					"'.$tmp_kivotosid.'",
					"'.crc32($tmp_kivotosid).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'",
					"'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
					"'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ASSIGN_USERID")).'",
					"'.crc32($oUser->retrieve_Form_Data("ASSIGN_USERID")).'",
					"'.$tmp_searchid.'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ISPRIVATE")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("NAME")).'",
					"'.self::$mysqli->real_escape_string($tmp_formatted_content).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("DESCRIPTION")).'",
					"'.$ts.'");';
					
					self::$query .= 'INSERT INTO `kivotos_search` (`SEARCH_ID`,`SEARCH_CONTENT`,`CLIENT_ID`,`CLIENT_ID_CRC32`,`CONTENT_LENGTH`,`KIVOTOS_ID`,`NAME`,`DESCRIPTION`,`DATEMODIFIED`) VALUES (
					"'.$tmp_searchid.'",
					"'.self::$mysqli->real_escape_string(strtolower($oUser->searchCleanStr($oUser->retrieve_Form_Data("NAME").$oUser->retrieve_Form_Data("DESCRIPTION")))).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'",
					"'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
					"'.strlen($oUser->searchCleanStr($oUser->retrieve_Form_Data("NAME").$oUser->retrieve_Form_Data("DESCRIPTION"))).'",
					"'.$tmp_kivotosid.'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("NAME")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("DESCRIPTION")).'",
					"'.$ts.'");';
					
					self::$query .= 'INSERT INTO `log_sys_user` (`ACTIVITY_ID`,`CLIENT_ID`,`CLIENT_ID_CRC32`,`KIVOTOS_ID`,`KIVOTOS_ID_CRC32`,`USER_ID`,`USER_ID_CRC32`,
																 `ACTIVITY_DESCRIPTION`,`PHPSESSION`,`IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`) VALUES (
					"'.$tmp_activityid.'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'",
					"'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
					"'.$tmp_kivotosid.'",
					"'.crc32($tmp_kivotosid).'",
					"'.$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID').'",
					"'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
					"'.session_id().'",
					"'.$_SERVER['REMOTE_ADDR'].'",
					"'.$_SERVER['HTTP_USER_AGENT'].'",
					"'.strtoupper($oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")).'");';
					
					$tmp_search_str = $oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME').$oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME').$tmp_activity_descript;
					self::$query .= 'INSERT INTO `log_sys_user_search` (`SEARCH_ID`,
                    `SEARCH_CONTENT`,
                    `CLIENT_ID`,
                    `CLIENT_ID_CRC32`,
                    `USER_ID`,
                    `USER_ID_CRC32`,
                    `KIVOTOS_ID`,
                    `KIVOTOS_ID_CRC32`,
                    `CONTENT_LENGTH`,`ACTIVITY_DESCRIPTION`)
                    VALUES
                    ("'.$tmp_activityid.'",
                     "'.self::$mysqli->real_escape_string(strtolower($oUser->searchCleanStr($tmp_search_str))).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'",
                    "'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
                    "'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
                    "'.self::$mysqli->real_escape_string($tmp_kivotosid).'",
                    "'.crc32($tmp_kivotosid).'",
                    "'.strlen($oUser->searchCleanStr($tmp_search_str)).'","'.self::$mysqli->real_escape_string($tmp_activity_descript).'");';

					#error_log("database (179) query->".self::$query);
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

					if(self::$mysqli->error){
						self::$query_exception_result = "create_kivotos=error";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}else{

                        do{
                        } while (self::$mysqli->more_results() && self::$mysqli->next_result());

                        $oUser->save_Form_Data('MENTION_ARRAY', $oInputTransformer->return_mention_id());
                        $oUser->save_Form_Data('KIVOTOS_ID', $tmp_kivotosid);

                        //
                        // BRING IN THE MESSENGER
                        // Luke 1:19, 26; Daniel 8:16; 9:21-22
                        $oGabriel = new messenger_from_north($this, $oUser, $oUserEnvironment, $oDB_RESP);
                        $oGabriel->scroll_messages($queryType);
                        $oGabriel->deliver_scroll();
                        return "kid=".$tmp_kivotosid;
					}
					
				break;
				case 'user_client_access':
					self::$query = 'SELECT `users_client_assoc`.`CLIENT_ID`, `users_client_assoc`.`USER_ID` FROM `users_client_assoc` WHERE 
					`users_client_assoc`.`USER_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("USERID")).'" AND
					`users_client_assoc`.`USER_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("USERID")).'";';
					self::$query .= 'SELECT `clients`.`CLIENT_ID`, `clients`.`ISACTIVE`, `clients`.`COMPANYNAME_BLOB`, `clients`.`DATEMODIFIED`, `clients`.`DATECREATED` FROM `clients` WHERE
					`clients`.`ISACTIVE`="1" OR `clients`.`ISACTIVE`="3";';	

					//error_log("database (5771) query->".self::$query);
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
					//
					// CLEAR RESULT ARRAY
					array_splice(self::$result_ARRAY, 0);
					
					$ROWCNT=0;
					do {
						if (self::$result = self::$mysqli->store_result()) {
							while ($row = self::$result->fetch_row()) {
								foreach($row as $fieldPos=>$value){
									//
									// STORE RESULT
									self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
									
								}
								$ROWCNT++;
							}
							self::$result->free();
						}
				
						if (self::$mysqli->more_results()) {
							//
							// END OF RECORD. MORE TO FOLLOW.
						}
					} while (self::$mysqli->more_results() && self::$mysqli->next_result());
			
					return self::$result_ARRAY;
				
				break;
				case 'admin_client_delete':
					$tmp_activity_descript = "The client (<span class='a_log_topic_name'>".$oUser->retrieve_Form_Data("CLIENT_ID")."</span>) has been deleted from the e<span class='the_V'>V</span>ifweb client extranet.";
					$tmp_activityid = $oUser->generateNewKey(70);
					
					self::$query = 'UPDATE `clients` SET 
					`ISACTIVE`="9",
					`DATEMODIFIED`="'.$ts.'" 
					WHERE `CLIENT_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'" AND 
					`CLIENT_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'" LIMIT 1;';
					
					self::$query .= 'INSERT INTO `log_sys_admin` (`ACTIVITY_ID`,`USERID`,`USERID_CRC32`,`USER_FIRSTNAME`,`USER_FIRSTNAME_BLOB`,`USER_LASTNAME`,`USER_LASTNAME_BLOB`,`PHPSESSION`,`IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`,`ACTIVITY_DESCRIPTION`,`ACTIVITY_DESCRIPTION_BLOB`) VALUES (
					"'.$tmp_activityid.'",
					"'.$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID').'",
					"'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
					"'.session_id().'",
					"'.$_SERVER['REMOTE_ADDR'].'",
					"'.$_SERVER['HTTP_USER_AGENT'].'",
					"'.strtoupper($oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'");';
					
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
					if(self::$mysqli->error){
						self::$query_exception_result="admin_client_delete=false";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}
					
					return 'admin_client_delete=success';
				
				break;
				case 'admin_load_client':
					self::$query = 'SELECT `clients`.`CLIENT_ID`, `clients`.`ISACTIVE`, `clients`.`COMPANYNAME_BLOB`, `clients`.`DATEMODIFIED`, `clients`.`DATECREATED` FROM `clients` WHERE
					`clients`.`CLIENT_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'" AND `clients`.`CLIENT_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'" LIMIT 1;';	
					
					
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
					
					//
					// CLEAR RESULT ARRAY
					array_splice(self::$result_ARRAY, 0);
					
					if(self::$mysqli->error){
						self::$query_exception_result = "error";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}else{
						
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						$ROWCNT=0;
						while ($row = self::$result->fetch_row()) {
							foreach($row as $fieldPos=>$value){
								//
								// STORE RESULT
								//error_log("evifweb /database.inc.php (823) rowcnt[".$ROWCNT."] fieldPos[".$fieldPos."] value [".$value."]");
								self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
								
							}
							$ROWCNT++;
						}
						self::$result->free();
						
					}
					
					return self::$result_ARRAY;
					
					
				break;
				case 'admin_account_delete':
					$ID_ARRAY[0] = $oUser->retrieve_Form_Data("USERID");
					$IDTYPE_ARRAY[0] = "USER";

                    $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                    $dataAugmenter = new dataAugmentation(self::$mysqli,$oUserEnvironment,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);
					#$dataAugmenter = new dataAugmentation(self::$mysqli,$oUserEnvironment,$ID_ARRAY,$IDTYPE_ARRAY);
					
					$tmp_activity_descript = $dataAugmenter->getData('USER',0,'FIRSTNAME_BLOB')." ".$dataAugmenter->getData('USER',0,'LASTNAME_BLOB')." has been deleted from the e<span class='the_V'>V</span>ifweb client extranet.";
					$tmp_activityid = $oUser->generateNewKey(70);
					
					self::$query = 'UPDATE `users` SET 
					`ISACTIVE`="9",
					`DATEMODIFIED`="'.$ts.'" 
					WHERE `USERID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("USERID")).'" AND 
					`USERID_CRC32`="'.crc32($oUser->retrieve_Form_Data("USERID")).'" LIMIT 1;';
					
					self::$query .= 'INSERT INTO `log_sys_admin` (`ACTIVITY_ID`,`USERID`,`USERID_CRC32`,`USER_FIRSTNAME`,`USER_FIRSTNAME_BLOB`,`USER_LASTNAME`,`USER_LASTNAME_BLOB`,`PHPSESSION`,`IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`,`ACTIVITY_DESCRIPTION`,`ACTIVITY_DESCRIPTION_BLOB`) VALUES (
					"'.$tmp_activityid.'",
					"'.$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID').'",
					"'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
					"'.session_id().'",
					"'.$_SERVER['REMOTE_ADDR'].'",
					"'.$_SERVER['HTTP_USER_AGENT'].'",
					"'.strtoupper($oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'");';
					
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
					if(self::$mysqli->error){
						self::$query_exception_result="admin_accnt_delete=false";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}
					
					return 'admin_accnt_delete=success';
				
				break;
				case 'admin_account_unlock':
					$ID_ARRAY[0] = $oUser->retrieve_Form_Data("USERID");
					$IDTYPE_ARRAY[0] = "USER";

                    $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                    $dataAugmenter = new dataAugmentation(self::$mysqli,$oUserEnvironment,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);
					#$dataAugmenter = new dataAugmentation(self::$mysqli,$oUserEnvironment,$ID_ARRAY,$IDTYPE_ARRAY);
					
					$tmp_activity_descript = "Access to the e<span class='the_V'>V</span>ifweb client extranet has been restored for ".$dataAugmenter->getData('USER',0,'FIRSTNAME_BLOB')." ".$dataAugmenter->getData('USER',0,'LASTNAME_BLOB').".";
					$tmp_activityid = $oUser->generateNewKey(70);
					
					self::$query = 'UPDATE `users` SET 
					`ISACTIVE`="1",
					`DATEMODIFIED`="'.$ts.'" 
					WHERE `USERID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("USERID")).'" AND 
					`USERID_CRC32`="'.crc32($oUser->retrieve_Form_Data("USERID")).'" LIMIT 1;';
					
					self::$query .= 'INSERT INTO `log_sys_admin` (`ACTIVITY_ID`,`USERID`,`USERID_CRC32`,`USER_FIRSTNAME`,`USER_FIRSTNAME_BLOB`,`USER_LASTNAME`,`USER_LASTNAME_BLOB`,`PHPSESSION`,`IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`,`ACTIVITY_DESCRIPTION`,`ACTIVITY_DESCRIPTION_BLOB`) VALUES (
					"'.$tmp_activityid.'",
					"'.$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID').'",
					"'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
					"'.session_id().'",
					"'.$_SERVER['REMOTE_ADDR'].'",
					"'.$_SERVER['HTTP_USER_AGENT'].'",
					"'.strtoupper($oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'");';
					
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
					if(self::$mysqli->error){
						self::$query_exception_result="admin_account_lock=false";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}
					
					return 'accnt_lock=success';
				
				break;
				case 'admin_account_lock':
					$tmp_activity_descript = $oUser->retrieve_Form_Data("FIRSTNAME")." ".$oUser->retrieve_Form_Data("LASTNAME")." has been locked out of the e<span class='the_V'>V</span>ifweb client extranet.";
					$tmp_activityid = $oUser->generateNewKey(70);
					
					self::$query = 'UPDATE `users` SET 
					`ISACTIVE`="6",
					`DATEMODIFIED`="'.$ts.'" 
					WHERE `USERID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("USERID")).'" AND 
					`USERID_CRC32`="'.crc32($oUser->retrieve_Form_Data("USERID")).'" AND `EMAIL`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("EMAIL")).'" AND `EMAIL_CRC32`="'.crc32($oUser->retrieve_Form_Data("EMAIL")).'" LIMIT 1;';
					
					self::$query .= 'DELETE from `sessions` where `USERID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("USERID")).'" AND `USERID_CRC32`="'.crc32($oUser->retrieve_Form_Data("USERID")).'";';
					self::$query .= 'INSERT INTO `log_sys_admin` (`ACTIVITY_ID`,`USERID`,`USERID_CRC32`,`USER_FIRSTNAME`,`USER_FIRSTNAME_BLOB`,`USER_LASTNAME`,`USER_LASTNAME_BLOB`,`PHPSESSION`,`IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`,`ACTIVITY_DESCRIPTION`,`ACTIVITY_DESCRIPTION_BLOB`) VALUES (
					"'.$tmp_activityid.'",
					"'.$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID').'",
					"'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
					"'.session_id().'",
					"'.$_SERVER['REMOTE_ADDR'].'",
					"'.$_SERVER['HTTP_USER_AGENT'].'",
					"'.strtoupper($oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'");';
					
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
					if(self::$mysqli->error){
						self::$query_exception_result="admin_account_lock=false";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}
					
					return 'accnt_lock=success';
					
					
				break;
				case 'remove_client_access':
					$ID_ARRAY[0] = $oUser->retrieve_Form_Data("CLIENT_ID");
					$IDTYPE_ARRAY[0] = "CLIENT";
					$ID_ARRAY[1] = $oUser->retrieve_Form_Data("USERID");
					$IDTYPE_ARRAY[1] = "USER";
                    $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                    $dataAugmenter = new dataAugmentation(self::$mysqli,$oUserEnvironment,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);
					#$dataAugmenter = new dataAugmentation(self::$mysqli,$oUserEnvironment,$ID_ARRAY,$IDTYPE_ARRAY);
				
					$tmp_activity_descript = $dataAugmenter->getData('USER',0,'FIRSTNAME_BLOB')." ".$dataAugmenter->getData('USER',0,'LASTNAME_BLOB')." has lost access to resources belonging to ".$dataAugmenter->getData('CLIENT',0,'COMPANY_NAME').".";
					$tmp_activityid = $oUser->generateNewKey(70);
					
					//
					// TO GIVE CLIENT ACCESS TO ALL CLIENTS, WILL HAVE TO LOOP THROUGH ALL CLIENT RESULTS AND BUILD INSERT SQL.
					self::$query = 'DELETE from `users_client_assoc` where `CLIENT_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'" AND `CLIENT_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'" AND 
					`USER_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("USERID")).'" AND `USER_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("USERID")).'" LIMIT 1;';
					
					self::$query .= 'INSERT INTO `log_sys_admin` (`ACTIVITY_ID`,`USERID`,`USERID_CRC32`,`USER_FIRSTNAME`,`USER_FIRSTNAME_BLOB`,`USER_LASTNAME`,`USER_LASTNAME_BLOB`,`PHPSESSION`,`IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`,`ACTIVITY_DESCRIPTION`,`ACTIVITY_DESCRIPTION_BLOB`) VALUES (
									"'.$tmp_activityid.'",
									"'.$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID').'",
									"'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
									"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
									"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
									"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
									"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
									"'.session_id().'",
									"'.$_SERVER['REMOTE_ADDR'].'",
									"'.$_SERVER['HTTP_USER_AGENT'].'",
									"'.strtoupper($oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")).'",
									"'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
									"'.self::$mysqli->real_escape_string($tmp_activity_descript).'");';


					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
					if(self::$mysqli->error){
						self::$query_exception_result="update_user_client_access=false";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}			
					
					return 'uid='.$oUser->retrieve_Form_Data("USERID");
					
				break;
				case 'update_user_client_access':
					/*
					self::$frm_input_ARRAY["USERID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'uid');
					self::$frm_input_ARRAY["FIRSTNAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'fname_signup_mobile');
					self::$frm_input_ARRAY["LASTNAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'lname_signup_mobile');
					self::$frm_input_ARRAY["CLIENT_TO_ACCESS"]
					*/
					
					$ID_ARRAY[0] = $oUser->retrieve_Form_Data("CLIENT_TO_ACCESS");
					$IDTYPE_ARRAY[0] = "CLIENT";
                    $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                    $dataAugmenter = new dataAugmentation(self::$mysqli,$oUserEnvironment,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);
					#$dataAugmenter = new dataAugmentation(self::$mysqli,$oUserEnvironment,$ID_ARRAY,$IDTYPE_ARRAY);
					
					
					$tmp_activity_descript = $oUser->retrieve_Form_Data("FIRSTNAME")." ".$oUser->retrieve_Form_Data("LASTNAME")." has been granted access to resources for ".$dataAugmenter->getData('CLIENT',0,'COMPANY_NAME')." in the e<span class='the_V'>V</span>ifweb client extranet.";
					$tmp_activityid = $oUser->generateNewKey(70);
					
					if($oUser->retrieve_Form_Data("CLIENT_TO_ACCESS")==""){
						return "update_user_client_access=false";
					}
					
					switch($oUser->retrieve_Form_Data("CLIENT_TO_ACCESS")){
						case "ALL":
							
							//
							// TO GIVE CLIENT ACCESS TO ALL CLIENTS, WILL HAVE TO LOOP THROUGH ALL CLIENT RESULTS AND BUILD INSERT SQL.
							self::$query = 'DELETE from `users_client_assoc` where USER_ID="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("USERID")).'" AND USER_ID_CRC32="'.crc32($oUser->retrieve_Form_Data("USERID")).'";';
							
							self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
							
							if(self::$mysqli->error){
								self::$query_exception_result="update_user_client_access=false";
								throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
							
							}							
							
							//
							// HAVE A EVIF ACCOUNT OR CLIENT ACCOUNT TO GRANT ACCESS TO ALL CLIENTS
							switch($oUser->retrieve_Form_Data("USER_PERMISSIONS_ID")){
								case 420:
								case 410:
								case 380:
								case 350:
								case 320:
								case 300:
								case 200:
									
									//
									// BY CLEARING OUT THE CLIENT RELATION LOOKUP TABLE FOR THIS USERID ABOVE, ALLOW SYSTEM DEFAULT ACCESS FOR EVIFWEB USER.
									// NOTHING ELSE TO DO HERE
									self::$query = 'INSERT INTO `log_sys_admin` (`ACTIVITY_ID`,`USERID`,`USERID_CRC32`,`USER_FIRSTNAME`,`USER_FIRSTNAME_BLOB`,`USER_LASTNAME`,`USER_LASTNAME_BLOB`,`PHPSESSION`,`IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`,`ACTIVITY_DESCRIPTION`,`ACTIVITY_DESCRIPTION_BLOB`) VALUES (
									"'.$tmp_activityid.'",
									"'.$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID').'",
									"'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
									"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
									"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
									"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
									"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
									"'.session_id().'",
									"'.$_SERVER['REMOTE_ADDR'].'",
									"'.$_SERVER['HTTP_USER_AGENT'].'",
									"'.strtoupper($oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")).'",
									"'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
									"'.self::$mysqli->real_escape_string($tmp_activity_descript).'");';
								
									error_log("database (185) query->".self::$query);
									self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
									
									if(self::$mysqli->error){
										self::$query_exception_result="update_user_client_access=false";
										throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
									
									}
					
									return 'success';
									
								break;
								case 100:
								case 50:
									//
									// WE NEED TO GET A LIST OF CURRENT CLIENTS
									self::$query = 'SELECT `clients`.`CLIENT_ID` FROM `clients` WHERE `clients`.`ISACTIVE`="1" OR `clients`.`ISACTIVE`="3";';
									
									self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
									
									//
									// CLEAR RESULT ARRAY
									array_splice(self::$result_ARRAY, 0);
						
									$ROWCNT=0;
									if(self::$mysqli->error){
										self::$query_exception_result="update_user_client_access=false";
										throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
									
									}else{
										//
										// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
										while ($row = self::$result->fetch_row()) {
											foreach($row as $fieldPos=>$value){
												//
												// STORE RESULT
												error_log("evifweb /database.inc.php (226) rowcnt[".$ROWCNT."] fieldPos[".$fieldPos."] value [".$value."]");
												self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
												
											}
											$ROWCNT++;
										}
										self::$result->free();										
										
									}
									
									self::$query = NULL;
									$tmp_loop_size = sizeof(self::$result_ARRAY);
									for($i=0;$i<$tmp_loop_size;$i++){
										self::$query .= 'INSERT INTO `users_client_assoc` (`CLIENT_ID`,`CLIENT_ID_CRC32`,`USER_ID`,`USER_ID_CRC32`) VALUES (
										"'.self::$result_ARRAY[$i][0].'",
										"'.crc32(self::$result_ARRAY[$i][0]).'",
										"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("USERID")).'",
										"'.crc32($oUser->retrieve_Form_Data("USERID")).'");';
										
									}
									
									self::$query .= 'INSERT INTO `log_sys_admin` (`ACTIVITY_ID`,`USERID`,`USERID_CRC32`,`USER_FIRSTNAME`,`USER_FIRSTNAME_BLOB`,`USER_LASTNAME`,`USER_LASTNAME_BLOB`,`PHPSESSION`,`IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`,`ACTIVITY_DESCRIPTION`,`ACTIVITY_DESCRIPTION_BLOB`) VALUES (
									"'.$tmp_activityid.'",
									"'.$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID').'",
									"'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
									"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
									"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
									"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
									"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
									"'.session_id().'",
									"'.$_SERVER['REMOTE_ADDR'].'",
									"'.$_SERVER['HTTP_USER_AGENT'].'",
									"'.strtoupper($oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")).'",
									"'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
									"'.self::$mysqli->real_escape_string($tmp_activity_descript).'");';
								
								
									error_log("database (253) query->".self::$query);
									self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
									if(self::$mysqli->error){
										self::$query_exception_result="update_user_client_access=false";
										throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
									
									}
					
									return 'success';
									
								break;
									
							}
						
						
						
						
						break;
						default:
							
							//
							// DELETE EXISTING USER-CLIENT RECORD IF EXISTS
							self::$query = 'DELETE from `users_client_assoc` where CLIENT_ID="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_TO_ACCESS")).'" AND CLIENT_ID_CRC32="'.crc32($oUser->retrieve_Form_Data("CLIENT_TO_ACCESS")).'" AND USER_ID="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("USERID")).'" AND USER_ID_CRC32="'.crc32($oUser->retrieve_Form_Data("USERID")).'" LIMIT 1;';
							
							self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
							
							if(self::$mysqli->error){
								self::$query_exception_result="update_user_client_access=false";
								throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
							
							}	
							
							self::$query = NULL;
							
							self::$query = 'INSERT INTO `users_client_assoc` (`CLIENT_ID`,`CLIENT_ID_CRC32`,`USER_ID`,`USER_ID_CRC32`) VALUES (
										"'.$oUser->retrieve_Form_Data("CLIENT_TO_ACCESS").'",
										"'.crc32($oUser->retrieve_Form_Data("CLIENT_TO_ACCESS")).'",
										"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("USERID")).'",
										"'.crc32($oUser->retrieve_Form_Data("USERID")).'");';
							
							//
							// JUST GRANT ACCESS TO ONE ACCOUNT
							self::$query .= 'INSERT INTO `log_sys_admin` (`ACTIVITY_ID`,`USERID`,`USERID_CRC32`,`USER_FIRSTNAME`,`USER_FIRSTNAME_BLOB`,`USER_LASTNAME`,`USER_LASTNAME_BLOB`,`PHPSESSION`,`IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`,`ACTIVITY_DESCRIPTION`,`ACTIVITY_DESCRIPTION_BLOB`) VALUES (
							"'.$tmp_activityid.'",
							"'.$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID').'",
							"'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
							"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
							"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
							"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
							"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
							"'.session_id().'",
							"'.$_SERVER['REMOTE_ADDR'].'",
							"'.$_SERVER['HTTP_USER_AGENT'].'",
							"'.strtoupper($oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")).'",
							"'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
							"'.self::$mysqli->real_escape_string($tmp_activity_descript).'");';
						
						
							error_log("database (312) query->".self::$query);
							self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
			
							if(self::$mysqli->error){
								self::$query_exception_result="update_user_client_access=false";
								throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
							
							}
			
							return 'success';
								
						break;
						
					}
					
					
				break;
				case 'update_user_profile_data':
				/*
				self::$frm_input_ARRAY["USERID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'uid');
		self::$frm_input_ARRAY["FIRSTNAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'fname_signup_mobile');
		self::$frm_input_ARRAY["LASTNAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'lname_signup_mobile');
		self::$frm_input_ARRAY["JOBTITLE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'jobtitle');
		self::$frm_input_ARRAY["EMAIL"]
				*/
					$tmp_activity_descript = $oUser->retrieve_Form_Data("FIRSTNAME")." ".$oUser->retrieve_Form_Data("LASTNAME")." has been updated with new profile data.";
					$tmp_activityid = $oUser->generateNewKey(70);
					$tmp_stream_mention = "@".self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("FIRSTNAME")).self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("LASTNAME"));
					
					self::$query = 'UPDATE `users` SET 
					`EMAIL`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("EMAIL")).'",
					`EMAIL_CRC32`="'.crc32($oUser->retrieve_Form_Data("EMAIL")).'",
					`FIRSTNAME`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("FIRSTNAME")).'",
					`FIRSTNAME_BLOB`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("FIRSTNAME")).'",
					`LASTNAME`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("LASTNAME")).'",
					`LASTNAME_BLOB`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("LASTNAME")).'",
					`STREAM_MENTION`="'.$tmp_stream_mention.'",
					`JOBTITLE`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("JOBTITLE")).'",
					`JOBTITLE_BLOB`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("JOBTITLE")).'",
					`DATEMODIFIED`="'.$ts.'" 
					WHERE `USERID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("USERID")).'" AND 
					`USERID_CRC32`="'.crc32($oUser->retrieve_Form_Data("USERID")).'" LIMIT 1;';

					//
                    // WE NEED TO INSERT/MANAGE @MENTION REFERENCE IN MENTION TABLE
                    #$tmp_query = 'SELECT WHERE STREAM_MENTION=xxxxx OR (USER_ID=xxxxxx AND USER_ID_CRC32=xxxxx)';
                    $tmp_SELECT_ARRAY[0] = '`comm_stream_mention`.`STREAM_MENTION`,
                                `comm_stream_mention`.`STREAM_MENTION_CRC32`,
                                `comm_stream_mention`.`USER_ID`,
                                `comm_stream_mention`.`USER_ID_CRC32`,
                                `comm_stream_mention`.`ISACTIVE`,
                                `comm_stream_mention`.`DATEMODIFIED`,
                                `comm_stream_mention`.`DATECREATED`';

                    //
                    // LET'S BUILD THE QUERY FOR EXTRACTING USER DATA BASED ON @MENTION.
                    // THIS NEEDS TO BE FAST. SO WILL NEED TO SETUP/MANAGE USER LOOKUP TABLE FOR MENTION DATA.
                    $tmp_mention_query = 'SELECT ' . $tmp_SELECT_ARRAY[0] . ' FROM `comm_stream_mention` WHERE 
                            `comm_stream_mention`.`USER_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("USERID")).'" AND 
                            `comm_stream_mention`.`USER_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("USERID")).'" AND 
                            `comm_stream_mention`.`ISACTIVE`="1";';

                    //
                    // PROCESS $tmp_query
                    //
                    // WE HAVE LOOKUP QUERY. WE SHOULD PROCESS OOP. THIS IS A SELECT WITH RESULT RETURN.
                    $force_profile_select_align = true;
                    $db_resp_process_serial = "jesus_is_lord!";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = 'COMM_STREAM_MENTION';
                    $db_resp_target_profiles = 'COMM_STREAM_MENTION';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '7';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.
                    $oDB_RESP = new database_response_manager($oUserEnvironment, $this);
                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt, $force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    $oDB_RESP->process(self::$mysqli,$queryType,$tmp_SELECT_ARRAY,$tmp_mention_query);

                    //
                    // IF RESULTS 0...PERFORM INSERT.
                    $tmp_profile_array = explode("|", $db_resp_target_profiles);
                    //error_log("database (3875) serial[".$db_resp_process_serial."] profilesize[".sizeof($tmp_profile_array)."]");
                    $tmp_loop_size = $oDB_RESP->return_sizeof($db_resp_process_serial, $tmp_profile_array);
                    if($tmp_loop_size>0){
                        for($i=0;$i<$tmp_loop_size;$i++){
                            if($oDB_RESP->return_data_element($db_resp_process_serial, 'COMM_STREAM_MENTION', 'STREAM_MENTION', $i) == $tmp_stream_mention){
                                // DO NOTHING

                            }else{

                                //
                                // BUILD UPDATE QUERY TO BE ADDED TO MULTI-QUERY
                                // PERFORM UPDATE ON PRIMARY KEY WHERE USER_ID=xxxxx or where STREAM_MENTION = old STREAM_MENTION
                                self::$query .= 'UPDATE `comm_stream_mention`
                                SET
                                `STREAM_MENTION` = "'.self::$mysqli->real_escape_string(strtolower($tmp_stream_mention)).'",
                                `STREAM_MENTION_CRC32` = "'.crc32(strtolower($tmp_stream_mention)).'",
                                `DATEMODIFIED` = "'.$ts.'"
                                WHERE `USER_ID` = "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("USERID")).'" AND 
                                `USER_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data("USERID")).'";';

                                // ALL NEW RECORDS WILL RUN THIS UPDATE SECTION. "INSERT" WILL NEVER BE RUN BY THE UPDATE METHOD...EXCEPT FOR THE TEST DATA.

                                # TABLES TO UPDATE. comm_stream_mention
                            }


                        }

                    }else{

                        //
                        // BUILD INSERT QUERY TO BE ADDED TO MULTI-QUERY (THIS WILL ONLY BE USED FOR THE TEST DATA WHICH IS MISSING STREAM META DATA)
                        self::$query .= 'INSERT INTO `comm_stream_mention` (`STREAM_MENTION`, `STREAM_MENTION_CRC32`, `USER_ID`, `USER_ID_CRC32`, `DATEMODIFIED`)
                        VALUES
                        ("'.self::$mysqli->real_escape_string(strtolower($tmp_stream_mention)).'",
                        "'.crc32(strtolower($tmp_stream_mention)).'",
                        "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("USERID")).'",
                        "'.crc32($oUser->retrieve_Form_Data("USERID")).'",
                        "'.$ts.'");';

                    }


					self::$query .= 'INSERT INTO `log_sys_admin` (`ACTIVITY_ID`,`USERID`,`USERID_CRC32`,`USER_FIRSTNAME`,`USER_FIRSTNAME_BLOB`,`USER_LASTNAME`,`USER_LASTNAME_BLOB`,`PHPSESSION`,`IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`,`ACTIVITY_DESCRIPTION`,`ACTIVITY_DESCRIPTION_BLOB`) VALUES (
					"'.$tmp_activityid.'",
					"'.$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID').'",
					"'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
					"'.session_id().'",
					"'.$_SERVER['REMOTE_ADDR'].'",
					"'.$_SERVER['HTTP_USER_AGENT'].'",
					"'.strtoupper($oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'");';

                    //
                    // OK..NOW WE SMOKE TEST THIS...OK LET'S MAKE SOME DATA HAPPEN....
					error_log("database (3709) query->".self::$query);
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
					if(self::$mysqli->error){
						self::$query_exception_result="update_user_profile_data=false";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}



					return 'success';
				
				break;
				case 'update_user_permission_id':
					$tmp_userPermissionTypeArray = array('Basic Client Account' => 50,'Client Admin' => 100,
													 'Media' => 200,'Creative' => 300,'Technology' => 320, 'eCRM' => 325,
													 'Account Services' => 350,'Admin - Accnt Services' =>380,
													 'Finance' => 390, 'HR' => 395,
													 'Translation' => 405,'System Admin' => 410,'System Admin 420' => 420
					);
					
					foreach($tmp_userPermissionTypeArray as $tmp_type=>$tmp_id){
						if($tmp_id==$oUser->retrieve_Form_Data("USER_PERMISSIONS_ID")){
							$tmp_permType = $tmp_type;
						}                        
                    }
				
					$tmp_activity_descript = "Permissions for ".$oUser->retrieve_Form_Data("FIRSTNAME")." ".$oUser->retrieve_Form_Data("LASTNAME")." have been updated to <span class='a_log_user_perm_type'>".$tmp_permType."</span>.";
					$tmp_activityid = $oUser->generateNewKey(70);
					
					self::$query = 'UPDATE `users` SET 
					`USER_PERMISSIONS_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("USER_PERMISSIONS_ID")).'",
					`DATEMODIFIED`="'.$ts.'" 
					WHERE `USERID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("USERID")).'" AND 
					`USERID_CRC32`="'.crc32($oUser->retrieve_Form_Data("USERID")).'" LIMIT 1;';
				
					self::$query .= 'INSERT INTO `log_sys_admin` (`ACTIVITY_ID`,`USERID`,`USERID_CRC32`,`USER_FIRSTNAME`,`USER_FIRSTNAME_BLOB`,`USER_LASTNAME`,`USER_LASTNAME_BLOB`,`PHPSESSION`,`IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`,`ACTIVITY_DESCRIPTION`,`ACTIVITY_DESCRIPTION_BLOB`) VALUES (
					"'.$tmp_activityid.'",
					"'.$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID').'",
					"'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
					"'.session_id().'",
					"'.$_SERVER['REMOTE_ADDR'].'",
					"'.$_SERVER['HTTP_USER_AGENT'].'",
					"'.strtoupper($oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'");';
					
					#error_log("database (163) query->".self::$query);
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
					if(self::$mysqli->error){
						self::$query_exception_result="update_user_permission_id=false";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}
					
					return 'success';
					
				break;
				case 'sys_get_asset':
		
					# SELECT * from assets where ASSET_ID=xxxx
					# SELECT USER_ID from users_client_assoc where CLIENT_ID=xxxx
					self::$query = 'SELECT `assets`.`ASSET_ID`, `assets`.`CLIENT_ID`,`assets`.`KIVOTOS_ID`,`assets`.`USER_ID`,`assets`.`ISACTIVE`,`assets`.`ASSET_TYPE_KEY`,`assets`.`FILE_NAME`,`assets`.`FILE_EXT`,`assets`.`FILE_SIZE`,`assets`.`FILE_PATH`,`assets`.`AUTHORIZED_IP`,`assets`.`AUTHORIZED_USERS`,`assets`.`LANGCODE`,`assets`.`DATEMODIFIED`,`assets`.`DATECREATED` FROM `assets` WHERE 
					`assets`.`ASSET_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ASSET_ID")).'" AND `assets`.`ASSET_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("ASSET_ID")).'" AND
					`assets`.`KIVOTOS_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" AND `assets`.`KIVOTOS_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("KIVOTOS_ID")).'" AND
					`assets`.`CLIENT_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'" AND `assets`.`CLIENT_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'" 
					LIMIT 1;';
					
					//
					// GET USERS APPROVED FOR CLIENT RESOURCE ACCESS
					self::$query .= 'SELECT `users_client_assoc`.`USER_ID` FROM `users_client_assoc` WHERE 
					`users_client_assoc`.`CLIENT_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CLIENT_ID")).'" AND 
					`users_client_assoc`.`CLIENT_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("CLIENT_ID")).'";';
					
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
					//
					// CLEAR RESULT ARRAY
					array_splice(self::$result_ARRAY, 0);
					
					$ROWCNT=0;
					do {
						if (self::$result = self::$mysqli->store_result()) {
							while ($row = self::$result->fetch_row()) {
								foreach($row as $fieldPos=>$value){
									//
									// STORE RESULT
									self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
									
								}
								$ROWCNT++;
							}
							self::$result->free();
						}
				
						if (self::$mysqli->more_results()) {
							//
							// END OF RECORD. MORE TO FOLLOW.
						}
					} while (self::$mysqli->more_results() && self::$mysqli->next_result());
			
					return self::$result_ARRAY;	
					
				break;
				case 'sys_get_user_account_data':
					self::$query = 'SELECT `users`.`USERID`,`users`.`EMAIL` ,`users`.`ISACTIVE`, `users`.`USER_PERMISSIONS_ID`, `users`.`FIRSTNAME_BLOB`, `users`.`LASTNAME_BLOB`, `users`.`JOBTITLE_BLOB`, `users`.`LANGCODE`,`users`.`LASTLOGIN`,`users`.`LASTLOGIN_IP`,`users`.`IMAGE_NAME`,`users`.`IMAGE_WIDTH`,`users`.`IMAGE_HEIGHT`,`users`.`ABOUT_BLOB`,`users`.`DATEMODIFIED`,`users`.`DATECREATED` FROM `users` WHERE 
					`users`.`USERID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("USERID")).'" AND `users`.`USERID_CRC32`="'.crc32($oUser->retrieve_Form_Data("USERID")).'" LIMIT 1;';
					self::$query .= 'SELECT `users_client_assoc`.`CLIENT_ID`, `users_client_assoc`.`USER_ID` FROM `users_client_assoc` WHERE 
					`users_client_assoc`.`USER_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("USERID")).'" AND
					`users_client_assoc`.`USER_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("USERID")).'";';
					self::$query .= 'SELECT `clients`.`CLIENT_ID`, `clients`.`ISACTIVE`, `clients`.`COMPANYNAME_BLOB`, `clients`.`DATEMODIFIED`, `clients`.`DATECREATED` FROM `clients` WHERE
					`clients`.`ISACTIVE`="1" OR `clients`.`ISACTIVE`="3";';	
					
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
					//
					// CLEAR RESULT ARRAY
					array_splice(self::$result_ARRAY, 0);
					
					$ROWCNT=0;
					do {
						if (self::$result = self::$mysqli->store_result()) {
							while ($row = self::$result->fetch_row()) {
								foreach($row as $fieldPos=>$value){
									//
									// STORE RESULT
									self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
									
								}
								$ROWCNT++;
							}
							self::$result->free();
						}
				
						if (self::$mysqli->more_results()) {
							//
							// END OF RECORD. MORE TO FOLLOW.
						}
					} while (self::$mysqli->more_results() && self::$mysqli->next_result());
			
					return self::$result_ARRAY;
					
				
				break;
				case 'sys_get_users':
					self::$query = 'SELECT `clients`.`CLIENT_ID`, `clients`.`ISACTIVE`, `clients`.`COMPANYNAME_BLOB`, `clients`.`DATEMODIFIED`, `clients`.`DATECREATED` FROM `clients` WHERE
					`clients`.`ISACTIVE`="1" OR `clients`.`ISACTIVE`="3";';	  #[1=ACTIVE, 3=ARCHIVED]
					
					self::$query .= 'SELECT `users_client_assoc`.`CLIENT_ID`, `users_client_assoc`.`USER_ID` FROM `users_client_assoc`;';
					
					self::$query .= 'SELECT `users`.`USERID`, `users`.`ISACTIVE`, `users`.`USER_PERMISSIONS_ID`, `users`.`FIRSTNAME_BLOB`, `users`.`LASTNAME_BLOB`, `users`.`JOBTITLE_BLOB`, `users`.`LANGCODE`,`users`.`LASTLOGIN`,`users`.`LASTLOGIN_IP`,`users`.`IMAGE_NAME`,`users`.`IMAGE_WIDTH`,`users`.`IMAGE_HEIGHT`,`users`.`ABOUT_BLOB`,`users`.`DATEMODIFIED`,`users`.`DATECREATED` FROM `users` WHERE `ISACTIVE`!="9";';
					
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
					//
					// CLEAR RESULT ARRAY
					array_splice(self::$result_ARRAY, 0);
					
					$ROWCNT=0;
					do {
						if (self::$result = self::$mysqli->store_result()) {
							while ($row = self::$result->fetch_row()) {
								foreach($row as $fieldPos=>$value){
									//
									// STORE RESULT
									#error_log("database (698) row[".$ROWCNT."] field[".$fieldPos."] value[".$value."]");
									self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
									
								}
								$ROWCNT++;
							}
							self::$result->free();
						}
				
						if (self::$mysqli->more_results()) {
							//
							// END OF RECORD. MORE TO FOLLOW.
						}
					} while (self::$mysqli->more_results() && self::$mysqli->next_result());
			
					return self::$result_ARRAY;
					
				break;
				case 'sys_get_clients':
					self::$query = 'SELECT `clients`.`CLIENT_ID`, `clients`.`ISACTIVE`, `clients`.`COMPANYNAME`, `clients`.`DATEMODIFIED`, `clients`.`DATECREATED` FROM `clients` WHERE
					`clients`.`ISACTIVE`="1" OR `clients`.`ISACTIVE`="3";';		# [1=ACTIVE, 3=ARCHIVED, 9=DELETED]
					
					//
					// PROCESS QUERY
					//error_log("evifweb database (583) session query->".self::$query);
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
					//error_log("evifweb database (585) num_rows->".self::$result->num_rows);
					
					//
					// CLEAR RESULT ARRAY
					array_splice(self::$result_ARRAY, 0);
					
					$ROWCNT=0;
					if(self::$mysqli->error){
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}else{
						
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						while ($row = self::$result->fetch_row()) {
							foreach($row as $fieldPos=>$value){
								//
								// STORE RESULT
								#error_log("database (73) ->".$value);
								self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
								
							}
							$ROWCNT++;
						}
						self::$result->free();
					}
					
					return self::$result_ARRAY;
					
				break;
				case 'sys_new_client':
					$tmp_clientid = $oUser->generateNewKey(50);
					$tmp_activityid = $oUser->generateNewKey(70);
					
					$tmp_activity_descript = "A new client (<span class='a_log_topic_name'>".$oUser->retrieve_Form_Data("COMPANYNAME")."</span>) has been added to the e<span class='the_V'>V</span>ifweb client extranet.";
					/*
					clients
					CLIENT_ID (CHAR 50)
					COMPANYNAME (VARCHAR 100)
					
					
					*/
					
					self::$query = 'INSERT INTO `clients` (`CLIENT_ID`,`CLIENT_ID_CRC32`, `COMPANYNAME`, `COMPANYNAME_BLOB`, `DATEMODIFIED`) VALUES 
								("'.$tmp_clientid.'",
								 "'.crc32($tmp_clientid).'",
								 "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("COMPANYNAME")).'",
								 "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("COMPANYNAME")).'",
								"'.$ts.'");';
								
					self::$query .= 'INSERT INTO `log_sys_admin` (`ACTIVITY_ID`,`USERID`,`USERID_CRC32`,`USER_FIRSTNAME`,`USER_FIRSTNAME_BLOB`,`USER_LASTNAME`,`USER_LASTNAME_BLOB`,`PHPSESSION`,`IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`,`ACTIVITY_DESCRIPTION`,`ACTIVITY_DESCRIPTION_BLOB`) VALUES (
					"'.$tmp_activityid.'",
					"'.$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID').'",
					"'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
					"'.session_id().'",
					"'.$_SERVER['REMOTE_ADDR'].'",
					"'.$_SERVER['HTTP_USER_AGENT'].'",
					"'.strtoupper($oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'");';
					
					error_log("database (819) query->".self::$query);
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
					if(self::$mysqli->error){
						self::$query_exception_result="sys_new_client=false";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}
					
					return 'cid='.$tmp_clientid;
				break;
				case 'sys_lang_edit':
					$tmp_activity_descript = "The language type (<span class='a_log_topic_name'>".$oUser->retrieve_Form_Data("COUNTRY_ISO_NAME")."</span>) has been updated.";
					$tmp_activityid = $oUser->generateNewKey(70);
					
					self::$query = 'UPDATE `sys_lang_type` SET 
					`COUNTRY_ISO_CODE`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("COUNTRY_ISO_CODE")).'",
					`COUNTRY_ISO_NAME`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("COUNTRY_ISO_NAME")).'",
					`NATIVE_NAME`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("NATIVE_NAME")).'",
					`NATIVE_NAME_BLOB`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("NATIVE_NAME")).'",
					`RTL_FLAG`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("RTL_FLAG")).'",
					`DATEMODIFIED`="'.$ts.'" 
					WHERE `LANG_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("LANG_ID")).'" LIMIT 1;';
					
					self::$query .= 'INSERT INTO `log_sys_admin` (`ACTIVITY_ID`,`USERID`,`USERID_CRC32`,`USER_FIRSTNAME`,`USER_FIRSTNAME_BLOB`,`USER_LASTNAME`,`USER_LASTNAME_BLOB`,`PHPSESSION`,`IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`,`ACTIVITY_DESCRIPTION`,`ACTIVITY_DESCRIPTION_BLOB`) VALUES (
					"'.$tmp_activityid.'",
					"'.$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID').'",
					"'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
					"'.session_id().'",
					"'.$_SERVER['REMOTE_ADDR'].'",
					"'.$_SERVER['HTTP_USER_AGENT'].'",
					"'.strtoupper($oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'");';
					
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
					if(self::$mysqli->error){
						self::$query_exception_result="sys_lang_edit=false";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}
					
					return 'success';
					
			
				break;
				case 'sys_lang_data_get':
					self::$query = 'SELECT `sys_lang_type`.`LANG_ID`, `sys_lang_type`.`COUNTRY_ISO_CODE`, `sys_lang_type`.`COUNTRY_ISO_NAME`,
					`sys_lang_type`.`NATIVE_NAME`,`sys_lang_type`.`NATIVE_NAME_BLOB`, `sys_lang_type`.`RTL_FLAG`, `sys_lang_type`.`DATEMODIFIED`, `sys_lang_type`.`DATECREATED` FROM `sys_lang_type` WHERE
					`sys_lang_type`.`COUNTRY_ISO_CODE`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("COUNTRY_ISO_CODE")).'";';
				
					//
					// PROCESS QUERY
					//error_log("evifweb database (583) session query->".self::$query);
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
					//error_log("evifweb database (585) num_rows->".self::$result->num_rows);
										
					//
					// CLEAR RESULT ARRAY
					array_splice(self::$result_ARRAY, 0);
					
					$ROWCNT=0;
					if(self::$mysqli->error){
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}else{
						
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						while ($row = self::$result->fetch_row()) {
							foreach($row as $fieldPos=>$value){
								//
								// STORE RESULT
								self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
								
							}
							$ROWCNT++;
						}
						self::$result->free();
					}
					
					return self::$result_ARRAY;
					
				break;
				case 'sync_LANGCODE':
					self::$query = 'UPDATE `users` SET 
							`LANGCODE`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("LANGCODE")).'", 
							`DATEMODIFIED`="'.$ts.'" 
							WHERE `USERID`="'.$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID').'" AND 
							`USERID_CRC32`="'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'" LIMIT 1;';
						
					
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
					//error_log("evifweb database (585) num_rows->".self::$result->num_rows);
					
					if(self::$mysqli->error){
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}
					
					return NULL;
				
				break;
				case 'sys_lang_element_edit':
				
					$tmp_activityid = $oUser->generateNewKey(70);
					
					//
					// DO WE HAVE ENGLISH? IF ENGLISH, JUST UPDATE.
					switch($oUser->retrieve_Form_Data("COUNTRY_ISO_CODE")){
						case 'en':
						
							$tmp_activity_descript = "The english language element (<span class='a_log_topic_name'>".$oUser->retrieve_Form_Data("ELEMENT_REF_KEY")."</span>) for ISO code [".$oUser->retrieve_Form_Data("COUNTRY_ISO_CODE")."] has been updated with the content of: <span class='a_log_lang_content'>".$oUser->retrieve_Form_Data("ELEMENT_CONTENT")."</span>.";

							self::$query = 'UPDATE `sys_lang_elements` SET 
							`ELEMENT_NAME`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ELEMENT_NAME")).'",
							`ELEMENT_DESCRIPTION`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ELEMENT_DESCRIPTION")).'",
							`ELEMENT_REF_KEY`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ELEMENT_REF_KEY")).'",
							`ELEMENT_CONTENT`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ELEMENT_CONTENT")).'",
							`ELEMENT_CONTENT_BLOB`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ELEMENT_CONTENT")).'",
							`DATEMODIFIED`="'.$ts.'" 
							WHERE `ELEMENT_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ELEMENT_ID")).'" AND 
							`ELEMENT_REF_KEY`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ELEMENT_REF_KEY")).'" AND
							`ELEMENT_REF_KEY_CRC32`="'.crc32($oUser->retrieve_Form_Data("ELEMENT_REF_KEY")).'" AND
							`COUNTRY_ISO_CODE`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("COUNTRY_ISO_CODE")).'" AND `ISO_CODE_CRC32`="'.crc32($oUser->retrieve_Form_Data("COUNTRY_ISO_CODE")).'" LIMIT 1;';
						
							self::$query .= 'INSERT INTO `log_sys_admin` (`ACTIVITY_ID`,`USERID`,`USERID_CRC32`,`USER_FIRSTNAME`,`USER_FIRSTNAME_BLOB`,`USER_LASTNAME`,`USER_LASTNAME_BLOB`,`PHPSESSION`,`IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`,`ACTIVITY_DESCRIPTION`,`ACTIVITY_DESCRIPTION_BLOB`) VALUES (
							"'.$tmp_activityid.'",
							"'.$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID').'",
							"'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
							"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
							"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
							"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
							"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
							"'.session_id().'",
							"'.$_SERVER['REMOTE_ADDR'].'",
							"'.$_SERVER['HTTP_USER_AGENT'].'",
							"'.strtoupper($oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")).'",
							"'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
							"'.self::$mysqli->real_escape_string($tmp_activity_descript).'");';
						break;
						default:
							
							//
							// WE HAVE FOREIGN LANG. INSERT OR UPDATE? DO WE HAVE ELEMENTID?
							if($oUser->retrieve_Form_Data("ELEMENT_ID")==""){
								
								$tmp_elementid = $oUser->generateNewKey(50);
								$tmp_activity_descript = "A new language element (<span class='a_log_topic_name'>".$oUser->retrieve_Form_Data("ELEMENT_REF_KEY")."</span>) for ISO code [".strtoupper($oUser->retrieve_Form_Data("COUNTRY_ISO_CODE"))."] has been added to the e<span class='the_V'>V</span>ifweb client extranet with the content of <span class='a_log_lang_content'>".$oUser->retrieve_Form_Data("ELEMENT_CONTENT")."</span>.";

								//
								// INSERT.
								self::$query = 'INSERT INTO `sys_lang_elements` (`ELEMENT_ID`,`ELEMENT_REF_KEY`,`ELEMENT_REF_KEY_CRC32`,`COUNTRY_ISO_CODE`, `ISO_CODE_CRC32`,`ELEMENT_CONTENT`,`ELEMENT_CONTENT_BLOB`,`ELEMENT_NAME`,`ELEMENT_DESCRIPTION`,`DATEMODIFIED`) VALUES 
								("'.$tmp_elementid.'",
								 "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ELEMENT_REF_KEY")).'",
								"'.crc32($oUser->retrieve_Form_Data("ELEMENT_REF_KEY")).'",
								 "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("COUNTRY_ISO_CODE")).'",
								 "'.crc32($oUser->retrieve_Form_Data("COUNTRY_ISO_CODE")).'",
								"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ELEMENT_CONTENT")).'",
								"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ELEMENT_CONTENT")).'",
								"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ELEMENT_NAME")).'",
								"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ELEMENT_DESCRIPTION")).'",
								"'.$ts.'");';
								
								self::$query .= 'INSERT INTO `log_sys_admin` (`ACTIVITY_ID`,`USERID`,`USERID_CRC32`,`USER_FIRSTNAME`,`USER_FIRSTNAME_BLOB`,`USER_LASTNAME`,`USER_LASTNAME_BLOB`,`PHPSESSION`,`IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`,`ACTIVITY_DESCRIPTION`,`ACTIVITY_DESCRIPTION_BLOB`) VALUES (
								"'.$tmp_activityid.'",
								"'.$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID').'",
								"'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
								"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
								"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
								"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
								"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
								"'.session_id().'",
								"'.$_SERVER['REMOTE_ADDR'].'",
								"'.$_SERVER['HTTP_USER_AGENT'].'",
								"'.strtoupper($oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")).'",
								"'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
								"'.self::$mysqli->real_escape_string($tmp_activity_descript).'");';
							}else{
								
								$tmp_activity_descript = "A language element (<span class='a_log_topic_name'>".$oUser->retrieve_Form_Data("ELEMENT_REF_KEY")."</span>) for ISO code [".strtoupper($oUser->retrieve_Form_Data("COUNTRY_ISO_CODE"))."] has been updated with the content of <span class='a_log_lang_content'>".$oUser->retrieve_Form_Data("ELEMENT_CONTENT")."</span>.";

								//
								// UPDATE.
								self::$query = 'UPDATE `sys_lang_elements` SET 
								`ELEMENT_CONTENT`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ELEMENT_CONTENT")).'",
								`ELEMENT_CONTENT_BLOB`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ELEMENT_CONTENT")).'",
								`DATEMODIFIED`="'.$ts.'" 
								WHERE `ELEMENT_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ELEMENT_ID")).'" AND 
								`COUNTRY_ISO_CODE`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("COUNTRY_ISO_CODE")).'" AND `ISO_CODE_CRC32`="'.crc32($oUser->retrieve_Form_Data("COUNTRY_ISO_CODE")).'" LIMIT 1;';
								
								self::$query .= 'INSERT INTO `log_sys_admin` (`ACTIVITY_ID`,`USERID`,`USERID_CRC32`,`USER_FIRSTNAME`,`USER_FIRSTNAME_BLOB`,`USER_LASTNAME`,`USER_LASTNAME_BLOB`,`PHPSESSION`,`IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`,`ACTIVITY_DESCRIPTION`,`ACTIVITY_DESCRIPTION_BLOB`) VALUES (
								"'.$tmp_activityid.'",
								"'.$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID').'",
								"'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
								"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
								"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
								"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
								"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
								"'.session_id().'",
								"'.$_SERVER['REMOTE_ADDR'].'",
								"'.$_SERVER['HTTP_USER_AGENT'].'",
								"'.strtoupper($oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")).'",
								"'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
								"'.self::$mysqli->real_escape_string($tmp_activity_descript).'");';
							}
							
							
							
						break;
					}
				
					
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
					if(self::$mysqli->error){
						self::$query_exception_result="sys_lang_element_edit=false";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}
					
					return 'success';
				
				break;
				case 'sys_lang_elem_get':
				
					/*
		self::$frm_input_ARRAY["ELEMENT_ID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'elemid');					# ENGLISH ELEMENT
		self::$frm_input_ARRAY["ELEMENT_REF_KEY"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'refkey');				# ENGLISH KEY
		self::$frm_input_ARRAY["COUNTRY_ISO_CODE"]																					# WILDCARD ISO
					
					*/
					//
					// RETRIEVE ELEMENTS FOR LANG. THIS QUERY WILL RETURN ENGLISH VERSION OF ELEMENT...AS ENGLISH IS THE PRIMARY KEY...AND THE FOREIGN LANG MATCHING KEY MIGHT NOT EVEN EXIST YET.
					self::$query = 'SELECT `sys_lang_elements`.`ELEMENT_ID`,`sys_lang_elements`.`COUNTRY_ISO_CODE`,`sys_lang_elements`.`ELEMENT_REF_KEY`,`sys_lang_elements`.`ELEMENT_CONTENT_BLOB`,
					`sys_lang_elements`.`ELEMENT_NAME`,`sys_lang_elements`.`ELEMENT_DESCRIPTION`,`sys_lang_elements`.`DATEMODIFIED`,
					`sys_lang_elements`.`DATECREATED` FROM `sys_lang_elements` WHERE `sys_lang_elements`.`ELEMENT_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ELEMENT_ID")).'" LIMIT 1;';
					
					//
					// REQUEST FOR FOREIGN LANG [COUNTRY_ISO_CODE] ELEMENT CONTENT BY KEY AND ISO_CODE. MIGHT AS WELL GO AHEAD AND GET THIS REQUEST IN AT THE SAME TIME.
					self::$query .= 'SELECT `sys_lang_elements`.`ELEMENT_ID`,`sys_lang_elements`.`COUNTRY_ISO_CODE`,`sys_lang_elements`.`ISO_CODE_CRC32`,`sys_lang_elements`.`ELEMENT_REF_KEY`,`sys_lang_elements`.`ELEMENT_CONTENT_BLOB`,
					`sys_lang_elements`.`ELEMENT_NAME`,`sys_lang_elements`.`ELEMENT_DESCRIPTION`,`sys_lang_elements`.`DATEMODIFIED`,
					`sys_lang_elements`.`DATECREATED` FROM `sys_lang_elements` WHERE 
					`sys_lang_elements`.`ELEMENT_REF_KEY`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ELEMENT_REF_KEY")).'" AND
					`sys_lang_elements`.`ELEMENT_REF_KEY_CRC32`="'.crc32($oUser->retrieve_Form_Data("ELEMENT_REF_KEY")).'" AND
					`sys_lang_elements`.`COUNTRY_ISO_CODE`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("COUNTRY_ISO_CODE")).'" AND 
					`sys_lang_elements`.`ISO_CODE_CRC32`="'.crc32($oUser->retrieve_Form_Data("COUNTRY_ISO_CODE")).'" LIMIT 1;';
					
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
					//
					// CLEAR RESULT ARRAY
					array_splice(self::$result_ARRAY, 0);
					
					$ROWCNT=0;
					do {
						if (self::$result = self::$mysqli->store_result()) {
							while ($row = self::$result->fetch_row()) {
								foreach($row as $fieldPos=>$value){
									//
									// STORE RESULT
									self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
									
								}
								$ROWCNT++;
							}
							self::$result->free();
						}
				
						if (self::$mysqli->more_results()) {
							//
							// END OF RECORD. MORE TO FOLLOW.
						}
					} while (self::$mysqli->more_results() && self::$mysqli->next_result());
			
					return self::$result_ARRAY;
					
				break;
				case 'sys_lang_elements_get':
					
					//
					// RETRIEVE ELEMENTS FOR LANG
					self::$query = 'SELECT `sys_lang_elements`.`ELEMENT_ID`,`sys_lang_elements`.`COUNTRY_ISO_CODE`,`sys_lang_elements`.`ELEMENT_REF_KEY`,`sys_lang_elements`.`ELEMENT_CONTENT_BLOB`,
					`sys_lang_elements`.`ELEMENT_NAME`,`sys_lang_elements`.`ELEMENT_DESCRIPTION`,`sys_lang_elements`.`DATEMODIFIED`,
					`sys_lang_elements`.`DATECREATED` FROM `sys_lang_elements` WHERE `sys_lang_elements`.`COUNTRY_ISO_CODE`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("COUNTRY_ISO_CODE")).'" AND 
					`sys_lang_elements`.`ISO_CODE_CRC32`="'.crc32($oUser->retrieve_Form_Data("COUNTRY_ISO_CODE")).'" ORDER BY `sys_lang_elements`.`DATECREATED` ASC;';
					
					
					self::$query .= 'SELECT `sys_lang_type`.`LANG_ID`, `sys_lang_type`.`COUNTRY_ISO_CODE`, `sys_lang_type`.`COUNTRY_ISO_NAME`,
					`sys_lang_type`.`NATIVE_NAME_BLOB`, `sys_lang_type`.`RTL_FLAG`, `sys_lang_type`.`DATEMODIFIED`, `sys_lang_type`.`DATECREATED` FROM `sys_lang_type` WHERE
					`sys_lang_type`.`COUNTRY_ISO_CODE`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("COUNTRY_ISO_CODE")).'";';
					
					//
					// ALL LANG KEY TO ENG
					self::$query .= 'SELECT `sys_lang_elements`.`ELEMENT_ID`,`sys_lang_elements`.`COUNTRY_ISO_CODE`,`sys_lang_elements`.`ISO_CODE_CRC32`, `sys_lang_elements`.`ELEMENT_REF_KEY`,`sys_lang_elements`.`ELEMENT_CONTENT_BLOB`,
					`sys_lang_elements`.`ELEMENT_NAME`,`sys_lang_elements`.`ELEMENT_DESCRIPTION`,`sys_lang_elements`.`DATEMODIFIED`,
					`sys_lang_elements`.`DATECREATED` FROM `sys_lang_elements` WHERE `sys_lang_elements`.`COUNTRY_ISO_CODE`="en" AND 
					`sys_lang_elements`.`ISO_CODE_CRC32`="'.crc32('en').'" ORDER BY `sys_lang_elements`.`DATECREATED` ASC;';
										
					//
					// PROCESS QUERY
					//error_log("evifweb database (583) session query->".self::$query);
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					//error_log("evifweb database (585) num_rows->".self::$result->num_rows);
					
					//
					// CLEAR RESULT ARRAY
					array_splice(self::$result_ARRAY, 0);
					
					$ROWCNT=0;
					if(self::$mysqli->error){
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}else{
						
						do {
								if (self::$result = self::$mysqli->store_result()) {
									while ($row = self::$result->fetch_row()) {
										foreach($row as $fieldPos=>$value){
											//
											// STORE RESULT
											#error_log("/services/ database.inc.php (2424) ROWCNT[".$ROWCNT."] FIELDPOS[".$fieldPos."] VALUE[".$value."]");
											self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
											
										}
										$ROWCNT++;
									}
									self::$result->free();
								}
						
								if (self::$mysqli->more_results()) {
									//
									// END OF RECORD. MORE TO FOLLOW.
								}
							} while (self::$mysqli->more_results() && self::$mysqli->next_result());
					}
			
					return self::$result_ARRAY;		
					
				
				break;
				case 'sys_lang_new':
					$tmp_langid = $oUser->generateNewKey(25);
					$tmp_activityid = $oUser->generateNewKey(70);
					$tmp_activity_descript = "A new language (<span class='a_log_topic_name'>".$oUser->retrieve_Form_Data("NATIVE_NAME")."</span>) has been added to the e<span class='the_V'>V</span>ifweb client extranet. ".$oUser->retrieve_Form_Data("COUNTRY_ISO_NAME")." (".strtoupper($oUser->retrieve_Form_Data("COUNTRY_ISO_CODE")).") translation content can now be created.";
					# updated ELEMENT_REF_KEY (of ELEMENT_ID) to ELEMENT_CONTENT for COUNTRY_ISO_CODE
					
					self::$query = 'INSERT INTO `sys_lang_type` (`LANG_ID`, `COUNTRY_ISO_CODE`,`COUNTRY_ISO_NAME`,`NATIVE_NAME`,`NATIVE_NAME_BLOB`,`RTL_FLAG`,`DATEMODIFIED`) VALUES 
					("'.$tmp_langid.'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("COUNTRY_ISO_CODE")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("COUNTRY_ISO_NAME")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("NATIVE_NAME")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("NATIVE_NAME")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("RTL_FLAG")).'",
					"'.$ts.'");';
					
					self::$query .= 'INSERT INTO `log_sys_admin` (`ACTIVITY_ID`,`USERID`,`USERID_CRC32`,`USER_FIRSTNAME`,`USER_FIRSTNAME_BLOB`,`USER_LASTNAME`,`USER_LASTNAME_BLOB`,`PHPSESSION`,`IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`,`ACTIVITY_DESCRIPTION`,`ACTIVITY_DESCRIPTION_BLOB`) VALUES (
					"'.$tmp_activityid.'",
					"'.$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID').'",
					"'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
					"'.session_id().'",
					"'.$_SERVER['REMOTE_ADDR'].'",
					"'.$_SERVER['HTTP_USER_AGENT'].'",
					"'.strtoupper($oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'");';
					
					//
					// PROCESS QUERY
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					if(self::$mysqli->error){
						self::$query_exception_result="sys_lang_new=false";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}else{
						return "success";
					}


				break;
				case 'sys_lang_get':
					self::$query = 'SELECT `sys_lang_type`.`LANG_ID`, `sys_lang_type`.`COUNTRY_ISO_CODE`, `sys_lang_type`.`COUNTRY_ISO_NAME`,
					`sys_lang_type`.`NATIVE_NAME_BLOB`, `sys_lang_type`.`RTL_FLAG`, `sys_lang_type`.`DATEMODIFIED`, `sys_lang_type`.`DATECREATED` FROM `sys_lang_type`;';
					
					self::$query .= 'SELECT `sys_lang_elements`.`COUNTRY_ISO_CODE`, COUNT(*) AS `ELEMENTS` FROM `sys_lang_elements` GROUP BY `COUNTRY_ISO_CODE`;';
										
					//
					// PROCESS QUERY
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					
					//
					// CLEAR RESULT ARRAY
					array_splice(self::$result_ARRAY, 0);
					
					$ROWCNT = 0;
					do {
						if (self::$result = self::$mysqli->store_result()) {
							while ($row = self::$result->fetch_row()) {
								foreach($row as $fieldPos=>$value){
									//
									// STORE RESULT
									#error_log("evifweb /database.inc.php (97) rowcnt[".$ROWCNT."] fieldPos[".$fieldPos."] value [".$value."]");
									self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
									
								}
								$ROWCNT++;
							}
							self::$result->free();
						}
				
						if (self::$mysqli->more_results()) {
							//
							// END OF RECORD. MORE TO FOLLOW.
						}
					} while (self::$mysqli->more_results() && self::$mysqli->next_result());
			
					return self::$result_ARRAY;				
				break;
				case 'sys_lang_element_new':
					//
					// PREPARE HASHES
					$tmp_elementid = $oUser->generateNewKey(50);
					$tmp_activityid = $oUser->generateNewKey(70);
					$tmp_activity_descript = "A new language element (<span class='a_log_topic_name'>".$oUser->retrieve_Form_Data("ELEMENT_REF_KEY")."</span>) for ISO code [".strtoupper($oUser->retrieve_Form_Data("COUNTRY_ISO_CODE"))."] has been added to the e<span class='the_V'>V</span>ifweb client extranet with the content of: <span class='a_log_lang_content'>".$oUser->retrieve_Form_Data("ELEMENT_CONTENT")."</span>.";
					/*
					
					self::$frm_input_ARRAY["ELEMENT_NAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'elementname');
		self::$frm_input_ARRAY["ELEMENT_DESCRIPTION"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'elementdescript');
		self::$frm_input_ARRAY["ELEMENT_REF_KEY"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'refkey');
		self::$frm_input_ARRAY["ELEMENT_CONTENT"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'elementcontent');
		self::$frm_input_ARRAY["COUNTRY_ISO_CODE"] 
		
		*/
					//
					// BUILD QUERY
					self::$query = 'INSERT INTO `sys_lang_elements` (`ELEMENT_ID`, `COUNTRY_ISO_CODE`, `ISO_CODE_CRC32`,`ELEMENT_REF_KEY`,`ELEMENT_REF_KEY_CRC32`,`ELEMENT_CONTENT`,`ELEMENT_CONTENT_BLOB`,`ELEMENT_NAME`,`ELEMENT_DESCRIPTION`,`DATEMODIFIED`) VALUES 
					("'.$tmp_elementid.'",
					 "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("COUNTRY_ISO_CODE")).'",
					 "'.crc32($oUser->retrieve_Form_Data("COUNTRY_ISO_CODE")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ELEMENT_REF_KEY")).'",
					"'.crc32($oUser->retrieve_Form_Data("ELEMENT_REF_KEY")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ELEMENT_CONTENT")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ELEMENT_CONTENT")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ELEMENT_NAME")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ELEMENT_DESCRIPTION")).'",
					"'.$ts.'");';
					
					self::$query .= 'INSERT INTO `log_sys_admin` (`ACTIVITY_ID`,`USERID`,`USERID_CRC32`,`USER_FIRSTNAME`,`USER_FIRSTNAME_BLOB`,`USER_LASTNAME`,`USER_LASTNAME_BLOB`,`PHPSESSION`,`IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`,`ACTIVITY_DESCRIPTION`,`ACTIVITY_DESCRIPTION_BLOB`) VALUES (
					"'.$tmp_activityid.'",
					"'.$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID').'",
					"'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
					"'.session_id().'",
					"'.$_SERVER['REMOTE_ADDR'].'",
					"'.$_SERVER['HTTP_USER_AGENT'].'",
					"'.strtoupper($oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'");';
					
					//
					// PROCESS QUERY
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					if(self::$mysqli->error){
						self::$query_exception_result="sys_lang_element_new=false";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}else{
						return "success";
					}
					
					
				break;
				case 'contact_home':
					//
					// PREPARE HASHES
					$tmp_contactid = $oUser->generateNewKey(50);
					$tmp_msgsourceid_user = $oUser->generateNewKey(70);
					$tmp_msgsourceid_admin = $oUser->generateNewKey(70);
					$tmp_msgsourceid_sms = $oUser->generateNewKey(70);
					
					//
					// BUILD QUERY
					self::$query = 'INSERT INTO `log_contact_req` (`CONTACTID`, `CONTACTID_CRC32`, `FIRSTNAME`,`LASTNAME`,`EMAIL`,`MOBILENUMBER`,`MESSAGE`,`PHPSESSION_ID`,`LANGCODE`,`HTTP_USER_AGENT`,`REMOTE_ADDR`,`CHK_WEB_WORK`,`CHK_EMAIL_WORK`,`CHK_COPYWRITING`,`CHK_WP_INTEGRATIONS`,`CHK_APP_DEV`,`CHK_BROWSER_TESTING`,`CHK_REPORTING_ANALYTICS`,`CHK_MOBILE`,`CHK_SEO`,`CHK_SOAP`,`CHK_REDESIGN`,`CHK_MIGRATION`,`CHK_BACKUP`,
`CHK_OPTIN`,`CHK_GATEWAY`,`CHK_SOCIAL`,`CHK_SCA`,`CHK_CMS`,`CHK_DESIGN`,`CHK_EXTRANET`,`CHK_EMAIL_COPYWRITING`,`CHK_DATA_CAPTURE`,`CHK_HTML_EMAIL_DES`,`CHK_HYGENE`,`CHK_EMAIL_CODING`,`CHK_AUTOMATION`,
`CHK_CAMP_MGMT`,`CHK_LP`,`CHK_CAMP_REPORTING`,`CHK_EMAIL_SOCIAL`,`CHK_IP_REP`,`CHK_FTAF`,`CHK_SEGMENTATION`,`DATECREATED`) VALUES 
					("'.$tmp_contactid.'",
					 "'.crc32($tmp_contactid).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("FIRSTNAME")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("LASTNAME")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("EMAIL")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("MOBILENUMBER")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("MESSAGE")).'",
					"'.session_id().'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("LANGCODE")).'",
					"'.self::$mysqli->real_escape_string($_SERVER['HTTP_USER_AGENT']).'",
					"'.$_SERVER['REMOTE_ADDR'].'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_WEB_WORK")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_EMAIL_WORK")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_COPYWRITING")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_WP_INTEGRATIONS")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_APP_DEV")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_BROWSER_TESTING")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_REPORTING_ANALYTICS")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_MOBILE")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_SEO")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_SOAP")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_REDESIGN")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_MIGRATION")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_BACKUP")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_OPTIN")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_GATEWAY")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_SOCIAL")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_SCA")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_CMS")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_DESIGN")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_EXTRANET")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_EMAIL_COPYWRITING")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_DATA_CAPTURE")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_HTML_EMAIL_DES")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_HYGENE")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_EMAIL_CODING")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_AUTOMATION")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_CAMP_MGMT")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_LP")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_CAMP_REPORTING")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_EMAIL_SOCIAL")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_IP_REP")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_FTAF")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_SEGMENTATION")).'",
					"'.$ts.'");';
					
					/*
					
CREATE TABLE `sys_msg_queue` (
  `MSG_SOURCEID` char(70) NOT NULL,
  `MSG_SOURCEID_CRC32` bigint(11) UNSIGNED NOT NULL,
  `MSG_KEYID` char(25) NOT NULL,
  `MSG_KEYID_CRC32` bigint(11) UNSIGNED NOT NULL,
  `ISACTIVE` tinyint(1) NOT NULL DEFAULT '1',
  `LANGCODE` char(2) NOT NULL DEFAULT 'EN',
  `EMAIL` varchar(100) NOT NULL,
  `RECIPIENTNAME` varchar(100) NOT NULL,
  `USERID` char(50) NOT NULL,
  `ACTIVATION_KEY` char(50) NOT NULL,
  `PWD_RESET` tinyint(1) NOT NULL DEFAULT '0',
  `ERROR_INFO` varchar(255) NOT NULL,
  `DATEMODIFIED` datetime NOT NULL,
  `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Message queue.';

`CHK_COPYWRITING`,`CHK_WP_INTEGRATIONS`,`CHK_APP_DEV`,`CHK_BROWSER_TESTING`,`CHK_REPORTING_ANALYTICS`,`CHK_MOBILE`,`CHK_SEO`,`CHK_SOAP`,`CHK_REDESIGN`,`CHK_MIGRATION`,`CHK_BACKUP`,
`CHK_OPTIN`,`CHK_GATEWAY`,`CHK_SOCIAL`,`CHK_SCA`,`CHK_CMS`,`CHK_DESIGN`,`CHK_EXTRANET`,`CHK_EMAIL_COPYWRITING`,`CHK_DATA_CAPTURE`,`CHK_HTML_EMAIL_DES`,`CHK_HYGENE`,`CHK_EMAIL_CODING`,`CHK_AUTOMATION`,
`CHK_CAMP_MGMT`,`CHK_LP`,`CHK_CAMP_REPORTING`,`CHK_EMAIL_SOCIAL`,`CHK_IP_REP`,`CHK_FTAF`,`CHK_SEGMENTATION`
<input type="hidden" name="CHK_COPYWRITING" id="CHK_COPYWRITING" value="0">
			<input type="hidden" name="CHK_WP_INTEGRATIONS" id="CHK_WP_INTEGRATIONS" value="0">
            <input type="hidden" name="CHK_APP_DEV" id="CHK_APP_DEV" value="0">
            <input type="hidden" name="CHK_BROWSER_TESTING" id="CHK_BROWSER_TESTING" value="0">
            <input type="hidden" name="CHK_REPORTING_ANALYTICS" id="CHK_REPORTING_ANALYTICS" value="0">
            <input type="hidden" name="CHK_MOBILE" id="CHK_MOBILE" value="0">
            <input type="hidden" name="CHK_SEO" id="CHK_SEO" value="0">
            <input type="hidden" name="CHK_SOAP" id="CHK_SOAP" value="0">
            <input type="hidden" name="CHK_REDESIGN" id="CHK_REDESIGN" value="0">
            <input type="hidden" name="CHK_MIGRATION" id="CHK_MIGRATION" value="0">
            <input type="hidden" name="CHK_BACKUP" id="CHK_BACKUP" value="0">
            <input type="hidden" name="CHK_OPTIN" id="CHK_OPTIN" value="0">
            <input type="hidden" name="CHK_GATEWAY" id="CHK_GATEWAY" value="0">
            <input type="hidden" name="CHK_SOCIAL" id="CHK_SOCIAL" value="0">
            <input type="hidden" name="CHK_SCA" id="CHK_SCA" value="0">
            <input type="hidden" name="CHK_CMS" id="CHK_CMS" value="0">
            <input type="hidden" name="CHK_DESIGN" id="CHK_DESIGN" value="0">
            <input type="hidden" name="CHK_EXTRANET" id="CHK_EXTRANET" value="0">
            
            <input type="hidden" name="CHK_EMAIL_COPYWRITING" id="CHK_EMAIL_COPYWRITING" value="0">
            <input type="hidden" name="CHK_DATA_CAPTURE" id="CHK_DATA_CAPTURE" value="0">
            <input type="hidden" name="CHK_HTML_EMAIL_DES" id="CHK_HTML_EMAIL_DES" value="0">
            <input type="hidden" name="CHK_HYGENE" id="CHK_HYGENE" value="0">
            <input type="hidden" name="CHK_EMAIL_CODING" id="CHK_EMAIL_CODING" value="0">
            <input type="hidden" name="CHK_AUTOMATION" id="CHK_AUTOMATION" value="0">
            <input type="hidden" name="CHK_CAMP_MGMT" id="CHK_CAMP_MGMT" value="0">
            <input type="hidden" name="CHK_LP" id="CHK_LP" value="0">
            <input type="hidden" name="CHK_CAMP_REPORTING" id="CHK_CAMP_REPORTING" value="0">
            <input type="hidden" name="CHK_EMAIL_SOCIAL" id="CHK_EMAIL_SOCIAL" value="0">
            <input type="hidden" name="CHK_IP_REP" id="CHK_IP_REP" value="0">
            <input type="hidden" name="CHK_FTAF" id="CHK_FTAF" value="0">
            <input type="hidden" name="CHK_SEGMENTATION" id="CHK_SEGMENTATION" value="0">


					*/

					self::$query .= 'INSERT INTO `sys_msg_queue` (`MSG_SOURCEID`,`MSG_SOURCEID_CRC32`,`MSG_KEYID`,`MSG_KEYID_CRC32`,`EMAIL`,`RECIPIENTNAME`,`LANGCODE`,`DATEMODIFIED`) VALUES ("'.$tmp_msgsourceid_user.'","'.crc32($tmp_msgsourceid_user).'","CONTACT_CONFIRM","'.crc32('CONTACT_CONFIRM').'","'.self::$mysqli->real_escape_string(strtolower($oUser->retrieve_Form_Data('EMAIL'))).'","'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('FIRSTNAME')).'","'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("LANGCODE")).'","'.$ts.'");';
					self::$query .= 'INSERT INTO `sys_msg_queue` (`MSG_SOURCEID`,`MSG_SOURCEID_CRC32`,`MSG_KEYID`,`MSG_KEYID_CRC32`,`EMAIL`,`RECIPIENTNAME`,`CONTACTID`,`DATEMODIFIED`) VALUES ("'.$tmp_msgsourceid_admin.'","'.crc32($tmp_msgsourceid_admin).'","ADMIN_CONTACT_CONFIRM","'.crc32('ADMIN_CONTACT_CONFIRM').'","'.self::$mysqli->real_escape_string($oUserEnvironment->getEnvParam('ADMIN_NOTIFICATIONS_EMAIL')).'","'.self::$mysqli->real_escape_string($oUserEnvironment->getEnvParam('ADMIN_NOTIFICATIONS_RECIPIENTNAME')).'","'.$tmp_contactid.'","'.$ts.'");';
					self::$query .= 'INSERT INTO `sys_msg_queue` (`MSG_SOURCEID`,`MSG_SOURCEID_CRC32`,`MSG_KEYID`,`MSG_KEYID_CRC32`,`EMAIL`,`RECIPIENTNAME`,`CONTACTID`,`DATEMODIFIED`) VALUES ("'.$tmp_msgsourceid_sms.'","'.crc32($tmp_msgsourceid_sms).'","ADMIN_SMS_NOTIFICATION","'.crc32('ADMIN_SMS_NOTIFICATION').'","'.self::$mysqli->real_escape_string($oUserEnvironment->getEnvParam('SMS_NOTIFICATIONS_ENDPOINT')).'","'.self::$mysqli->real_escape_string($oUserEnvironment->getEnvParam('ADMIN_NOTIFICATIONS_RECIPIENTNAME')).'","'.$tmp_contactid.'","'.$ts.'");';
					
					//
					// PROCESS QUERY
					//error_log("evifweb database (112) contact_home query->".self::$query);
					self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
					if(self::$mysqli->error){
						self::$query_exception_result="contactus=false";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}else{
						return "success";
					}
							
				break;
				case 'email_unique':
					self::$query = 'SELECT `users`.`EMAIL` FROM `users` WHERE `users`.`EMAIL`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('EMAIL')).'" AND `users`.`EMAIL_CRC32`="'.crc32($oUser->retrieve_Form_Data('EMAIL')).'" LIMIT 1;';
										
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
					switch(self::$result->num_rows){
						case 0:
							return "unique=true";
						break;
						default:
							return "unique=false";
						break;
					}
				
				
				break;
				case 'signup_main':
					/*
					signup_main

self::$frm_input_ARRAY["FIRSTNAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'fname');
		self::$frm_input_ARRAY["LASTNAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'lname');
		self::$frm_input_ARRAY["EMAIL"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'email');
		self::$frm_input_ARRAY["PWDHASH"] = md5(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'pwd'));
		self::$frm_input_ARRAY["JOBTITLE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'jobtitle');
		self::$frm_input_ARRAY["COMPANYNAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'companyname');
		self::$frm_input_ARRAY["LANGCODE"]

========
session_id()
IP
DATECREATED



CREATE TABLE `users` (
  `USERID` char(50) NOT NULL,
  `USERID_CRC32` bigint(11) UNSIGNED NOT NULL,
  `CLIENTID` char(50) NOT NULL,
  `CLIENTID_CRC32` bigint(11) UNSIGNED NOT NULL,
  `ISACTIVE` tinyint(1) NOT NULL DEFAULT '5',
  `USER_PERMISSIONS_ID` int(11) NOT NULL DEFAULT '100',
  `FIRSTNAME` varchar(100) NOT NULL,
  `LASTNAME` varchar(100) NOT NULL,
  `COMPANYNAME` varchar(100) NOT NULL,
  `JOBTITLE` varchar(100) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `EMAIL_CRC32` bigint(11) UNSIGNED NOT NULL,
  `PWDHASH` varchar(255) NOT NULL,
  `LANGCODE` char(2) NOT NULL DEFAULT 'EN',
  `LASTLOGIN` datetime NOT NULL,
  `LASTLOGIN_IP` varchar(100) NOT NULL,
  `LOGIN_CNT` int(11) NOT NULL DEFAULT '0',
  `IMAGE_NAME` char(70) NOT NULL DEFAULT 'sys_profile.jpg',
  `IMAGE_WIDTH` int(11) NOT NULL DEFAULT '64',
  `IMAGE_HEIGHT` int(11) NOT NULL DEFAULT '64',
  `ABOUT` varchar(300) NOT NULL,
  `DATEMODIFIED` datetime NOT NULL,
  `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Users table.';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USERID`),
  ADD KEY `USERID_CRC` (`USERID_CRC32`),
  ADD KEY `ISACTIVE` (`ISACTIVE`),
  ADD KEY `CLIENTID` (`CLIENTID`),
  ADD KEY `CLIENTID_CRC` (`CLIENTID_CRC32`);


CREATE TABLE `users_activation` (
  `ACTIVATEKEY` char(50) NOT NULL,
  `ACTIVATEKEY_CRC32` bigint(11) UNSIGNED NOT NULL,
  `USERID` char(50) NOT NULL,
  `USERID_CRC32` bigint(11) UNSIGNED NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `ISACTIVE` tinyint(1) NOT NULL DEFAULT '0',
  `LANGCODE` char(2) NOT NULL DEFAULT 'EN',
  `DATEMODIFIED` datetime NOT NULL,
  `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Management of state of account activation.';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users_activation`
--
ALTER TABLE `users_activation`
  ADD PRIMARY KEY (`ACTIVATEKEY`),
  ADD KEY `KEY_CRC` (`ACTIVATEKEY_CRC32`),
  ADD KEY `USERID` (`USERID`),
  ADD KEY `USERID_CRC` (`USERID_CRC32`);
					
					*/
					
					
					//
					// PERFORM CHECK FOR UNIQUE EMAIL self::$frm_input_ARRAY["EMAIL"]
					self::$query = 'SELECT `users`.`EMAIL` FROM `users` WHERE `users`.`EMAIL`="'.self::$mysqli->real_escape_string(strtolower($oUser->retrieve_Form_Data("EMAIL"))).'" AND 
					`users`.`EMAIL_CRC32`="'.crc32(strtolower($oUser->retrieve_Form_Data("EMAIL"))).'";';
					
					
										
					//
					// PROCESS QUERY
					//error_log("evifweb database (583) session query->".self::$query);
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
					//error_log("evifweb database (585) num_rows->".self::$result->num_rows);
					
					$ROWCNT=0;
					if(self::$mysqli->error){
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}else{
						
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						while ($row = self::$result->fetch_row()) {
							foreach($row as $fieldPos=>$value){
								//
								// STORE RESULT
								self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
								
							}
							$ROWCNT++;
						}
						self::$result->free();
					}
					
					if($ROWCNT>0){
						return "newuser=err_dup_email";
					}else{
					
						//
						// PREPARE HASHES
						$tmp_userid = $oUser->generateNewKey(50);
						$tmp_activationkey = $oUser->generateNewKey(50);
						$tmp_message_sourceid = $oUser->generateNewKey(70);
						$options = [
									'cost' => 9,
								];
								
						$tmp_pwdhash = password_hash($oUser->retrieve_Form_Data('PWDHASH'), PASSWORD_BCRYPT, $options);
											
						//
						// PREPARE QUERY
						self::$query = 'INSERT INTO `users` (`USERID`,`USERID_CRC32`,`FIRSTNAME`,`FIRSTNAME_BLOB`,`LASTNAME`,`LASTNAME_BLOB`,`COMPANYNAME`,`COMPANYNAME_BLOB`,`JOBTITLE`,`JOBTITLE_BLOB`,`EMAIL`,`EMAIL_CRC32`,`PWDHASH`,`LANGCODE`,`DATEMODIFIED`) VALUES 
						("'.$tmp_userid.'",
						"'.crc32($tmp_userid).'",
						"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("FIRSTNAME")).'",
						"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("FIRSTNAME")).'",
						"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("LASTNAME")).'",
						"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("LASTNAME")).'",
						"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("COMPANYNAME")).'",
						"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("COMPANYNAME")).'",
						"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("JOBTITLE")).'",
						"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("JOBTITLE")).'",
						"'.self::$mysqli->real_escape_string(strtolower($oUser->retrieve_Form_Data("EMAIL"))).'",
						"'.crc32($oUser->retrieve_Form_Data("EMAIL")).'",
						"'.$tmp_pwdhash.'",
						"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("LANGCODE")).'",
						"'.$ts.'");';
						
						
						self::$query .= 'INSERT INTO `users_activation` (`ACTIVATEKEY`, `ACTIVATEKEY_CRC32`,`USERID`,`USERID_CRC32`, `EMAIL`,`LANGCODE`, `DATEMODIFIED`) VALUES ("'.$tmp_activationkey.'", "'.crc32($tmp_activationkey).'","'.$tmp_userid.'", "'.crc32($tmp_userid).'", "'.self::$mysqli->real_escape_string(strtolower($oUser->retrieve_Form_Data("EMAIL"))).'", "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("LANGCODE")).'", "'.$ts.'");';
						
						
						/*
						
	CREATE TABLE `sys_msg_queue` (
	  `MSG_SOURCEID` char(70) NOT NULL,
	  `MSG_SOURCEID_CRC32` bigint(11) UNSIGNED NOT NULL,
	  `MSG_KEYID` char(25) NOT NULL,
	  `MSG_KEYID_CRC32` bigint(11) UNSIGNED NOT NULL,
	  `ISACTIVE` tinyint(1) NOT NULL DEFAULT '1',
	  `LANGCODE` char(2) NOT NULL DEFAULT 'EN',
	  `EMAIL` varchar(100) NOT NULL,
	  `RECIPIENTNAME` varchar(100) NOT NULL,
	  `USERID` char(50) DEFAULT NULL,
	  `ACTIVATION_KEY` char(50) DEFAULT NULL,
	  `CONTACTID` char(50) DEFAULT NULL,
	  `PWD_RESET` tinyint(1) NOT NULL DEFAULT '0',
	  `ERROR_INFO` varchar(255) DEFAULT NULL,
	  `DATEMODIFIED` datetime NOT NULL,
	  `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
	) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Message queue.';
						*/
						self::$query .= 'INSERT INTO `sys_msg_queue` (`MSG_SOURCEID`, `MSG_SOURCEID_CRC32`,`MSG_KEYID`,`MSG_KEYID_CRC32`,`LANGCODE`,`EMAIL`, `RECIPIENTNAME`, `USERID`, `ACTIVATION_KEY`,`DATEMODIFIED`) VALUES ("'.$tmp_message_sourceid.'","'.crc32($tmp_message_sourceid).'","ACCOUNT_ACTIVATE","'.crc32('ACCOUNT_ACTIVATE').'","'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("LANGCODE")).'","'.self::$mysqli->real_escape_string(strtolower($oUser->retrieve_Form_Data("EMAIL"))).'","'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("FIRSTNAME")).' '.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("LASTNAME")).'","'.self::$mysqli->real_escape_string($tmp_userid).'","'.self::$mysqli->real_escape_string($tmp_activationkey).'","'.$ts.'");';
											
						//
						// PROCESS QUERY
						self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
						
						$ROWCNT=0;
						do {
							if(self::$mysqli->error){
								if($ROWCNT>0){
									self::$query_exception_result='newuser=false';
									$oUser->transactionStatusUpdate('error','signup_main');
								}else{
									self::$query_exception_result='newuser=falseall';
									$oUser->transactionStatusUpdate('error','signup_main');
								}
								
								throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.'] on email='.strtolower($oUser->retrieve_Form_Data('EMAIL')));
								
							}
							$ROWCNT++;
					
							if (self::$mysqli->more_results()) {
								//
								// END OF RECORD. MORE TO FOLLOW.
							}
						} while (self::$mysqli->more_results() && self::$mysqli->next_result());
					
						if(self::$mysqli->error){
							self::$query_exception_result='newuser=false';	
							$oUser->transactionStatusUpdate('error','signup_main');
							throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.'] on email='.strtolower($oUser->retrieve_Form_Data('EMAIL')));
						}			
						
						$oUserEnvironment->oSESSION_MGR->setSessionParam('FORM_EMAIL',$oUser->retrieve_Form_Data('EMAIL'));
	
						return 'newuser=success';
					}
				break;
				case 'activate_account':
					/*
					CREATE TABLE `users` (
  `USERID` char(50) NOT NULL,
  `USERID_CRC32` bigint(11) UNSIGNED NOT NULL,
  `CLIENTID` char(50) NOT NULL,
  `CLIENTID_CRC32` bigint(11) UNSIGNED NOT NULL,
  `ISACTIVE` tinyint(1) NOT NULL DEFAULT '5',
  `USER_PERMISSIONS_ID` int(11) NOT NULL DEFAULT '100',
  `FIRSTNAME` varchar(100) NOT NULL,
  `LASTNAME` varchar(100) NOT NULL,
  `COMPANYNAME` varchar(100) NOT NULL,
  `JOBTITLE` varchar(100) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `EMAIL_CRC32` bigint(11) UNSIGNED NOT NULL,
  `PWDHASH` varchar(255) NOT NULL,
  `LANGCODE` char(2) NOT NULL DEFAULT 'EN',
  `LASTLOGIN` datetime NOT NULL,
  `LASTLOGIN_IP` varchar(100) NOT NULL,
  `LOGIN_CNT` int(11) NOT NULL DEFAULT '0',
  `IMAGE_NAME` char(70) NOT NULL DEFAULT 'sys_profile.jpg',
  `IMAGE_WIDTH` int(11) NOT NULL DEFAULT '64',
  `IMAGE_HEIGHT` int(11) NOT NULL DEFAULT '64',
  `ABOUT` varchar(300) NOT NULL,
  `DATEMODIFIED` datetime NOT NULL,
  `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Users table.';


CREATE TABLE `users_activation` (
  `ACTIVATEKEY` char(50) NOT NULL,
  `ACTIVATEKEY_CRC32` bigint(11) UNSIGNED NOT NULL,
  `USERID` char(50) NOT NULL,
  `USERID_CRC32` bigint(11) UNSIGNED NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `ISACTIVE` tinyint(1) NOT NULL DEFAULT '0',
  `LANGCODE` char(2) NOT NULL DEFAULT 'EN',
  `DATEMODIFIED` datetime NOT NULL,
  `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Management of state of account activation.';


--
-- Indexes for table `users_activation`
--
ALTER TABLE `users_activation`
  ADD PRIMARY KEY (`ACTIVATEKEY`),
  ADD KEY `KEY_CRC` (`ACTIVATEKEY_CRC32`),
  ADD KEY `USERID` (`USERID`),
  ADD KEY `USERID_CRC` (`USERID_CRC32`);
					*/
					
					//
					// SELECT ...
					self::$query = 'SELECT `users_activation`.`ACTIVATEKEY`,`users_activation`.`ACTIVATEKEY_CRC32`,`users_activation`.`USERID`,`users_activation`.`USERID_CRC32`,`users_activation`.`ISACTIVE`,`users`.`USERID`,`users`.`ISACTIVE`,`users`.`EMAIL` FROM `users_activation` INNER JOIN `users` ON `users_activation`.`USERID` = `users`.`USERID` WHERE `users_activation`.`ACTIVATEKEY`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('ACTIVATEKEY')).'" AND `users_activation`.`ACTIVATEKEY_CRC32`="'.crc32($oUser->retrieve_Form_Data('ACTIVATEKEY')).'" AND `users_activation`.`USERID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('USERID')).'" AND `users_activation`.`USERID_CRC32`="'.crc32($oUser->retrieve_Form_Data('USERID')).'";';
					
					//error_log('/services/database.inc.php (1184) :: '.self::$query);
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
					switch(self::$result->num_rows){
						case 1:
							#error_log('(965) :: OK TO ACTIVATE '.self::$result->num_rows);
							#$row = self::$result->fetch_all(MYSQLI_NUM);
							$row = self::$result->fetch_array();
							#error_log('(966) :: query output '.$row[0][self::$queryDescript_ARRAY['users_activation_KEY']].'|'.$row[0][self::$queryDescript_ARRAY['users_activation_USERNAME']].'|'.$row[0][self::$queryDescript_ARRAY['users_activation_ISACTIVE']].'|'.$row[0][self::$queryDescript_ARRAY['users_USERID_SOURCE']].'|'.$row[0][self::$queryDescript_ARRAY['users_ISACTIVE']]);
							
							switch($row[0][self::$queryDescript_ARRAY['users_activation_ISACTIVE']]){
								case 0:
									//
									// ACTIVATE ACCOUNT. BUILD QUERIES
									self::$query = 'UPDATE `users` SET `ISACTIVE`="4",`DATEMODIFIED`="'.$ts.'" 
									WHERE `USERID`="'.$row["USERID"].'" AND 
									`USERID_CRC32`="'.crc32($row["USERID"]).'" LIMIT 1;';
									
									self::$query .= 'UPDATE `users_activation` SET `ISACTIVE`="1",`DATEMODIFIED`="'.$ts.'" 
									WHERE `ACTIVATEKEY`="'.$row["ACTIVATEKEY"].'" AND 
									`ACTIVATEKEY_CRC32`="'.$row["ACTIVATEKEY_CRC32"].'" AND 
									`USERID`="'.$row["USERID"].'" AND
									`USERID_CRC32`="'.$row["USERID_CRC32"].'" LIMIT 1;';
									
									#error_log("(1203) USERNAME: ".$row["USERNAME"]);
									#error_log('/services/ database.inc.php (1204) :: '.self::$query);
									//
									// PROCESS QUERY
									self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
									
									$ROWCNT=0;
									do {
										if(self::$mysqli->error){
											if($ROWCNT>0){
												self::$query_exception_result='accountactivate=false';
											}else{
												self::$query_exception_result='accountactivate=falseall';
											}
											
											throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
											
										}
										$ROWCNT++;
								
										if (self::$mysqli->more_results()) {
											//
											// END OF RECORD. MORE TO FOLLOW.
										}
									} while (self::$mysqli->more_results() && self::$mysqli->next_result());
								
									if(self::$mysqli->error){
										self::$query_exception_result='accountactivate=false';	
										throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
									}
								
									//
									// CLOSE CONNECTION
									//$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection(self::$mysqli);
									
									$oUserEnvironment->oSESSION_MGR->setSessionParam('FORM_EMAIL',$row["EMAIL"]);
									return 'accountactivate=true';
							
								break;
								default:
									//
									// ACCOUNT IS ALREADY ACTIVATED. NO FURTHER UPDATES NEEDED. SAVE THE RESOURCES
									$oUserEnvironment->oSESSION_MGR->setSessionParam('FORM_EMAIL',$row["EMAIL"]);
									return 'accountactivate=donealready';
								break;
							}
						break;
						case 0:
							//
							// POTENTIAL HACK ATTEMPT OR SYSTEM ERR
							error_log('(7161) :: ACTIVATION ERROR :: NUMROW=0|accountactivate=dataerror_null|'.$row["ACTIVATEKEY"]);
							return 'accountactivate=dataerror_null';
						break;
						default:
							//
							// POTENTIAL SYSTEM ERR
							error_log('(7176) :: ACTIVATION ERROR :: NUMROW='.self::$result->num_rows.'|accountactivate=dataerror_redun|'.$row["ACTIVATEKEY"]);
							return 'accountactivate=dataerror_redun';
						break;
					}
				
				break;
				case 'user_signin':
				
									/*
					CREATE TABLE `users` (
  `USERID` char(50) NOT NULL,
  `USERID_CRC32` bigint(11) UNSIGNED NOT NULL,
  `CLIENTID` char(50) NOT NULL,
  `CLIENTID_CRC32` bigint(11) UNSIGNED NOT NULL,
  `ISACTIVE` tinyint(1) NOT NULL DEFAULT '5',
  `USER_PERMISSIONS_ID` int(11) NOT NULL DEFAULT '100',
  `FIRSTNAME` varchar(100) NOT NULL,
  `LASTNAME` varchar(100) NOT NULL,
  `COMPANYNAME` varchar(100) NOT NULL,
  `JOBTITLE` varchar(100) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `EMAIL_CRC32` bigint(11) UNSIGNED NOT NULL,
  `PWDHASH` varchar(255) NOT NULL,
  `LANGCODE` char(2) NOT NULL DEFAULT 'EN',
  `LASTLOGIN` datetime NOT NULL,
  `LASTLOGIN_IP` varchar(100) NOT NULL,
  `LOGIN_CNT` int(11) NOT NULL DEFAULT '0',
  `IMAGE_NAME` char(70) NOT NULL DEFAULT 'sys_profile.jpg',
  `IMAGE_WIDTH` int(11) NOT NULL DEFAULT '64',
  `IMAGE_HEIGHT` int(11) NOT NULL DEFAULT '64',
  `ABOUT` varchar(300) NOT NULL,
  `DATEMODIFIED` datetime NOT NULL,
  `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Users table.';
		
					
					*/
					self::$query = 'SELECT `users`.`USERID`,`users`.`ISACTIVE`,`users`.`USER_PERMISSIONS_ID`,`users`.`FIRSTNAME`,`users`.`LASTNAME`,`users`.`COMPANYNAME`,`users`.`JOBTITLE`,`users`.`EMAIL`,`users`.`PWDHASH`,`users`.`LANGCODE`,`users`.`LASTLOGIN`,`users`.`LASTLOGIN_IP`,`users`.`LOGIN_CNT`,`users`.`IMAGE_NAME`,`users`.`IMAGE_WIDTH`,`users`.`IMAGE_HEIGHT`,`users`.`ABOUT` FROM `users` WHERE `users`.`EMAIL`="'.self::$mysqli->real_escape_string(strtolower($oUser->retrieve_Form_Data('EMAIL'))).'" AND `users`.`EMAIL_CRC32`="'.crc32(strtolower($oUser->retrieve_Form_Data('EMAIL'))).'" LIMIT 1;';
					
					#error_log('evifweb database.inc.php (969) query :: '.self::$query);
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
					if(self::$mysqli->error){
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}else{
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						//error_log("services /database.inc.php (291) about to process singlet...");
						$ROWCNT=0;
						while ($row = self::$result->fetch_row()) {
							foreach($row as $fieldPos=>$value){
								//
								// STORE RESULT
								//error_log("evifweb /database.inc.php (432) rowcnt[".$ROWCNT."] fieldPos[".$fieldPos."] value [".$value."]");
								self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
								
							}
							$ROWCNT++;
						}
						self::$result->free();
						/*
						
CREATE TABLE `sessions` (
  `SESSIONID` char(26) NOT NULL,
  `SESSIONID_CRC32` bigint(11) UNSIGNED NOT NULL,
  `USERID` char(50) NOT NULL,
  `USERID_CRC32` bigint(11) UNSIGNED NOT NULL,
  `REMOTE_ADDR` varchar(30) NOT NULL,
  `ISACTIVE` tinyint(1) NOT NULL DEFAULT '1',
  `DATEMODIFIED` datetime NOT NULL,
  `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Session management.';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`SESSIONID`),
  ADD KEY `SESSIONID_CRC` (`SESSIONID_CRC32`),
  ADD KEY `USERID` (`USERID`,`USERID_CRC32`);
						
						*/
						//
						// VERIFY LOGIN
						$tmp_loop_size = sizeof(self::$result_ARRAY);
						for ($usrcnt=0; $usrcnt < $tmp_loop_size; $usrcnt++) {
							if(password_verify($oUser->retrieve_Form_Data('PWDHASH'), self::$result_ARRAY[$usrcnt][8])){
								
								if(self::$result_ARRAY[$usrcnt][1]=="1" || self::$result_ARRAY[$usrcnt][1]=="4"){
									$tmp_newlogincnt = self::$result_ARRAY[$usrcnt][12]+1;
									
									// 
									// BUILD FOLLOW QUERY TO UPDATE LAST LOGIN DATE AND LOGIN COUNT
									self::$query = 'UPDATE `users` SET `users`.`LASTLOGIN`="'.$ts.'",`users`.`LASTLOGIN_IP`="'.$_SERVER['REMOTE_ADDR'].'",`users`.`LOGIN_CNT`="'.$tmp_newlogincnt.'",`users`.`DATEMODIFIED`="'.$ts.'" WHERE `users`.`USERID`="'.self::$result_ARRAY[$usrcnt][0].'" AND `users`.`USERID_CRC32`="'.crc32(self::$result_ARRAY[$usrcnt][0]).'" LIMIT 1;';
									self::$query .= 'DELETE from `sessions` where SESSIONID="'.session_id().'" AND SESSIONID_CRC32="'.crc32(session_id()).'" LIMIT 1;';
									self::$query .= 'INSERT INTO `sessions` (`SESSIONID`,`SESSIONID_CRC32`,`USERID`,`USERID_CRC32`,`REMOTE_ADDR`,`DATEMODIFIED`) VALUES ("'.session_id().'","'.crc32(session_id()).'","'.self::$result_ARRAY[$usrcnt][0].'","'.crc32(self::$result_ARRAY[$usrcnt][0]).'","'.$_SERVER['REMOTE_ADDR'].'","'.$ts.'");';
									
									//
									// FLAG SESSION FOR ONE-TIME IMMEDIATE LOGIN APPROVAL. TOGGLED TO FALSE AFTER USE. 
									$oUserEnvironment->oSESSION_MGR->setSessionParam("FRESH_SESSION_ALERT", true);
									
									//
									// PROCESS QUERY
									//error_log("evifweb database (467) query->".self::$query);
									#error_log("evifweb database (669) query->".self::$query);
									self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
									
								
								}else{
									
									//
									// 	
									
								}
								
								//
								// CLOSE CONNECTION
								//$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection(self::$mysqli);
								
								//
								// RETURN RESULT SET ARRAY
								return self::$result_ARRAY;
								
								$usrcnt=1000;
							
							}
						}
						
						//
						// IF WE GET THIS FAR...NO SUCCESS LOGIN
						//
						// CLOSE CONNECTION
						//$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection(self::$mysqli);
						return false;
						
					}
					
				break;
				case 'validate_session':
					//
					// QUERY SESSION TABLE FOR QUALIFYING MATCHING SESSIONID
					self::$query = 'SELECT `sessions`.`SESSIONID`,`sessions`.`USERID` FROM `sessions` WHERE `sessions`.`SESSIONID`="'.session_id().'" AND `sessions`.`SESSIONID_CRC32`="'.crc32(session_id()).'" AND `sessions`.`USERID`="'.$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID').'" AND  `sessions`.`USERID_CRC32`="'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'" AND `sessions`.`REMOTE_ADDR`="'.$_SERVER['REMOTE_ADDR'].'" AND DATE_SUB(CURDATE(),'.$oUserEnvironment->getEnvParam('SESSION_EXPIRE').') <= `sessions`.`DATEMODIFIED` LIMIT 1;';
										
					//
					// PROCESS QUERY
					#error_log("evifweb database (2385) session query->".self::$query);
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
					//error_log("evifweb database (585) num_rows->".self::$result->num_rows);
					
					$ROWCNT=0;
					if(self::$mysqli->error){
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}else{
						
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						while ($row = self::$result->fetch_row()) {
							foreach($row as $fieldPos=>$value){
								//
								// STORE RESULT
								#error_log("services /database.inc.php (296) rowcnt[".$ROWCNT."] fieldPos[".$fieldPos."] value [".$value."]");
								self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
								
							}
							$ROWCNT++;
						}
						self::$result->free();
						
						#error_log("evifweb database (1099) valid session rowcount->".$ROWCNT." on query->".self::$query);
						switch($ROWCNT){
							case 1:
								//
								// UPDATE SESSIONS WITH CURRENT ACTIVITY
								self::$query = 'UPDATE `sessions` SET `sessions`.`DATEMODIFIED`="'.$ts.'" WHERE `sessions`.`SESSIONID`="'.session_id().'" AND 
								`sessions`.`SESSIONID_CRC32`="'.crc32(session_id()).'" AND
								`sessions`.`USERID`="'.$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID').'" AND 
								`sessions`.`USERID_CRC32`="'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'" LIMIT 1;';
								
								//
								// PROCESS QUERY
								//error_log("evifweb database (597) query->".self::$query);
								self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
								
								//
								// CLOSE CONNECTION
								//$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection(self::$mysqli);
								
								return "authorized";
							break;
							default:
								//
								// CLOSE CONNECTION
								//$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection(self::$mysqli);
								
								return "validate_session=error";
							break;
						}						

					}
					
				break;
				case 'new_sys_message':
					/*
	
CREATE TABLE `sys_messages` (
  `MSG_KEYID` char(25) NOT NULL,
  `MSG_KEYID_CRC32` bigint(11) NOT NULL,
  `ISACTIVE` tinyint(1) NOT NULL DEFAULT '1',
  `LANGCODE` char(2) NOT NULL DEFAULT 'EN',
  `MSG_NAME` varchar(100) NOT NULL,
  `MSG_SUBJECT` varchar(100) NOT NULL,
  `MSG_HTML` blob NOT NULL,
  `MSG_TEXT` blob NOT NULL,
  `MSG_DESCRIPTION` varchar(500) NOT NULL,
  `DATEMODIFIED` datetime NOT NULL,
  `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='MESSAGE CONTENT';
	
	*/
	
					
					//
					// BUILD QUERY
					self::$query = 'INSERT INTO `sys_messages` (`MSG_KEYID`,`MSG_KEYID_CRC32`,`MSG_NAME`,`MSG_SUBJECT`,`MSG_HTML`,`MSG_TEXT`,`MSG_DESCRIPTION`,`DATEMODIFIED`) VALUES 
					("'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('MSG_KEYID')).'",
					"'.crc32($oUser->retrieve_Form_Data('MSG_KEYID')).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('MSG_NAME')).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('MSG_SUBJECT')).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('MSG_HTML')).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('MSG_TEXT')).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('MSG_DESCRIPTION')).'",
					"'.$ts.'");';
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
					
					if(self::$mysqli->error){
						self::$query_exception_result='new_sysmsg=false';	
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.'] on un='.strtolower($oUser->getReqParamByKey('USERNAME')));
					}
					
					//
					// CLOSE CONNECTION
					//$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection(self::$mysqli);										
					return 'new_sysmsg=true';
					
					
					
				
				break;
				case 'get_sys_msgs':
					//
					// BUILD QUERY
					if($oUser->retrieve_Form_Data("MSG_KEYID")!=""){
						self::$query = 'SELECT `sys_messages`.`MSG_KEYID`,`sys_messages`.`ISACTIVE`,`sys_messages`.`LANGCODE`,`sys_messages`.`MSG_NAME`,`sys_messages`.`MSG_SUBJECT`,`sys_messages`.`MSG_HTML`,`sys_messages`.`MSG_TEXT`,`sys_messages`.`MSG_DESCRIPTION`,`sys_messages`.`DATEMODIFIED`,`sys_messages`.`DATECREATED` FROM `sys_messages` WHERE (`sys_messages`.`ISACTIVE`="1" OR `sys_messages`.`ISACTIVE`="3") AND `sys_messages`.`MSG_KEYID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('MSG_KEYID')).'" AND `sys_messages`.`MSG_KEYID_CRC32`="'.crc32($oUser->retrieve_Form_Data('MSG_KEYID')).'" LIMIT 1;';
					}else{
						self::$query = 'SELECT `sys_messages`.`MSG_KEYID`,`sys_messages`.`ISACTIVE`,`sys_messages`.`LANGCODE`,`sys_messages`.`MSG_NAME`,`sys_messages`.`MSG_SUBJECT`,`sys_messages`.`MSG_HTML`,`sys_messages`.`MSG_TEXT`,`sys_messages`.`MSG_DESCRIPTION`,`sys_messages`.`DATEMODIFIED`,`sys_messages`.`DATECREATED` FROM `sys_messages` WHERE `sys_messages`.`ISACTIVE`="1" OR `sys_messages`.`ISACTIVE`="3";';
					}
					
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
					
					//
					// CLEAR RESULT ARRAY
					array_splice(self::$result_ARRAY, 0);
					
					if(self::$mysqli->error){
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}else{
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						$ROWCNT=0;
						while ($row = self::$result->fetch_row()) {
							foreach($row as $fieldPos=>$value){
								//
								// STORE RESULT
								//error_log("services /database.inc.php (296) rowcnt[".$ROWCNT."] fieldPos[".$fieldPos."] value [".$value."]");
								self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
								
							}
							$ROWCNT++;
						}
						self::$result->free();
				
						//
						// CLOSE CONNECTION
						//$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection(self::$mysqli);
						
						//
						// RETURN RESULT SET ARRAY
						return self::$result_ARRAY;
					}
				
				break;
				case 'edit_sys_message':
				
				/*
				
		self::$frm_input_ARRAY["MSG_NAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'msgname');
		self::$frm_input_ARRAY["MSG_SUBJECT"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'msgsubjct');
		self::$frm_input_ARRAY["MSG_DESCRIPTION"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'description');
		self::$frm_input_ARRAY["MSG_HTML"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'html_v');
		self::$frm_input_ARRAY["MSG_TEXT"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'text_v');
		self::$frm_input_ARRAY["LANGCODE"]
		*/
					self::$query = 'UPDATE `sys_messages` SET 
					`MSG_NAME`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('MSG_NAME')).'",
					`MSG_SUBJECT`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('MSG_SUBJECT')).'",
					`MSG_HTML`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('MSG_HTML')).'",
					`MSG_TEXT`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('MSG_TEXT')).'",
					`MSG_DESCRIPTION`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('MSG_DESCRIPTION')).'",
					`LANGCODE`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('LANGCODE')).'",
					`DATEMODIFIED`="'.$ts.'" 
					WHERE `MSG_KEYID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('MSG_KEYID')).'" AND `MSG_KEYID_CRC32`="'.crc32($oUser->retrieve_Form_Data('MSG_KEYID')).'" LIMIT 1;';
					#error_log(self::$query);
					
					//
					// PROCESS QUERY
					//error_log(self::$query);
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
					
					if(self::$mysqli->error){
						self::$query_exception_result='edit_sysmsg=false';	
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.'] on un='.strtolower($oUser->getReqParamByKey('USERNAME')));
					}
					
					//
					// CLOSE CONNECTION
					$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection(self::$mysqli);	
					
					return 'edit_sysmsg=true';
				
				break;
				case 'get_msg_queue':
					/*
					
CREATE TABLE `sys_msg_queue` (
  `MSG_SOURCEID` char(70) NOT NULL,
  `MSG_SOURCEID_CRC32` bigint(11) UNSIGNED NOT NULL,
  `MSG_KEYID` char(25) NOT NULL,
  `MSG_KEYID_CRC32` bigint(11) UNSIGNED NOT NULL,
  `ISACTIVE` tinyint(1) NOT NULL DEFAULT '1',
  `LANGCODE` char(2) NOT NULL DEFAULT 'EN',
  `EMAIL` varchar(100) NOT NULL,
  `RECIPIENTNAME` varchar(100) NOT NULL,
  `USERID` char(50) DEFAULT NULL,
  `ACTIVATION_KEY` char(50) DEFAULT NULL,
  `CONTACTID` char(50) DEFAULT NULL,
  `PWD_RESET` tinyint(1) NOT NULL DEFAULT '0',
  `ERROR_INFO` varchar(255) DEFAULT NULL,
  `DATEMODIFIED` datetime NOT NULL,
  `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Message queue.';
					*/
					self::$query = 'SELECT `sys_msg_queue`.`MSG_SOURCEID`,`sys_msg_queue`.`MSG_KEYID`,`sys_msg_queue`.`ISACTIVE`,`sys_msg_queue`.`LANGCODE`,`sys_msg_queue`.`EMAIL`,`sys_msg_queue`.`RECIPIENTNAME`,`sys_msg_queue`.`USERID`,`sys_msg_queue`.`ACTIVATION_KEY`,`sys_msg_queue`.`CONTACTID`,`sys_msg_queue`.`REQUESTID`,`sys_msg_queue`.`PWD_RESET`,`sys_msg_queue`.`DATECREATED` FROM `sys_msg_queue` WHERE `sys_msg_queue`.`ISACTIVE`="1" OR `sys_msg_queue`.`ISACTIVE`="3";';					
					
					//
					// PROCESS QUERY
					//error_log("evifweb database (809) query->".self::$query);
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
					if(self::$mysqli->error){
						self::$query_exception_result = "error";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}else{
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						$ROWCNT=0;
						while ($row = self::$result->fetch_row()) {
							foreach($row as $fieldPos=>$value){
								//
								// STORE RESULT
								//error_log("evifweb /database.inc.php (823) rowcnt[".$ROWCNT."] fieldPos[".$fieldPos."] value [".$value."]");
								self::$result_MSGQUEUE_ARRAY[$ROWCNT][$fieldPos]=$value;
								
							}
							$ROWCNT++;
						}
						self::$result->free();
				
						//
						// CLOSE CONNECTION
						$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection(self::$mysqli);
						
						//
						// RETURN RESULT SET ARRAY
						return self::$result_MSGQUEUE_ARRAY;
						
					}
					
				break;
				case 'log_msg_send':
				
				/*
				
CREATE TABLE `sys_msg_queue` (
  `MSG_SOURCEID` char(70) NOT NULL,
  `MSG_SOURCEID_CRC32` bigint(11) UNSIGNED NOT NULL,
  `MSG_KEYID` char(25) NOT NULL,
  `MSG_KEYID_CRC32` bigint(11) UNSIGNED NOT NULL,
  `ISACTIVE` tinyint(1) NOT NULL DEFAULT '1',
  `LANGCODE` char(2) NOT NULL DEFAULT 'EN',
  `EMAIL` varchar(100) NOT NULL,
  `RECIPIENTNAME` varchar(100) NOT NULL,
  `USERID` char(50) DEFAULT NULL,
  `ACTIVATION_KEY` char(50) DEFAULT NULL,
  `CONTACTID` char(50) DEFAULT NULL,
  `PWD_RESET` tinyint(1) NOT NULL DEFAULT '0',
  `ERROR_INFO` varchar(255) DEFAULT NULL,
  `DATEMODIFIED` datetime NOT NULL,
  `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Message queue.';
				*/
					switch($oUser->msg_delivery_status){
						case 'success':
							//error_log("(861) record success");
							
							self::$query = 'UPDATE `sys_msg_queue` SET 
							`ISACTIVE`="0",
							`ERROR_INFO`="'.$oUser->msg_delivery_status.'",
							`DATEMODIFIED`="'.$ts.'" 
							WHERE `MSG_SOURCEID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('MSG_SOURCEID')).'" AND 
							`MSG_SOURCEID_CRC32`="'.crc32($oUser->retrieve_Form_Data('MSG_SOURCEID')).'"  AND 
							`MSG_KEYID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('MSG_KEYID')).'"  AND 
							`MSG_KEYID_CRC32`="'.crc32($oUser->retrieve_Form_Data('MSG_KEYID')).'"
							LIMIT 1;';							
							
							
							//error_log("evifweb database (874) msg stat update query->".self::$query);
							self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
							
							if(self::$mysqli->error){
								self::$query_exception_result = "error";
								throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
							
							}else{
								
								//
								// SUCCESS
								return "success";
								
							}
							
						break;
						default:
							//error_log("(864) record failure");
							self::$query = 'UPDATE `sys_msg_queue` SET 
							`ISACTIVE`="6",
							`ERROR_INFO`="'.$oUser->msg_delivery_status.'",
							`DATEMODIFIED`="'.$ts.'" 
							WHERE `MSG_SOURCEID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('MSG_SOURCEID')).'" AND 
							`MSG_SOURCEID_CRC32`="'.crc32($oUser->retrieve_Form_Data('MSG_SOURCEID')).'"  AND 
							`MSG_KEYID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('MSG_KEYID')).'"  AND 
							`MSG_KEYID_CRC32`="'.crc32($oUser->retrieve_Form_Data('MSG_KEYID')).'"
							LIMIT 1;';						
							
							self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
							
							if(self::$mysqli->error){
								self::$query_exception_result = "error";
								throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
							
							}else{
								
								//
								// SUCCESS
								return "error";
								
							}
						 break;
						
					}
				

//					
//					//
//					// PROCESS QUERY
//					error_log(self::$query);
//					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
//					
//					if(self::$mysqli->error){
//						self::$query_exception_result='edit_sysmsg=false';	
//						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.'] on un='.strtolower($oUser->getReqParamByKey('USERNAME')));
//					}
					
					//
					// CLOSE CONNECTION
					$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection(self::$mysqli);	
					
					return 'edit_sysmsg=true';
				
				break;
				case 'log_msg_assem_err':
					error_log("evifweb database (909) msg assembly error MSG_SOURCEID ->".$oUser->retrieve_Form_Data('MSG_SOURCEID'));
					self::$query = 'UPDATE `sys_msg_queue` SET 
							`ISACTIVE`="6",
							`ERROR_INFO`="Message assembly error.",
							`DATEMODIFIED`="'.$ts.'" 
							WHERE `MSG_SOURCEID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('MSG_SOURCEID')).'" AND 
							`MSG_SOURCEID_CRC32`="'.crc32($oUser->retrieve_Form_Data('MSG_SOURCEID')).'"  AND 
							`MSG_KEYID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('MSG_KEYID')).'"  AND 
							`MSG_KEYID_CRC32`="'.crc32($oUser->retrieve_Form_Data('MSG_KEYID')).'"
							LIMIT 1;';	
							
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
					
					if(self::$mysqli->error){
						self::$query_exception_result = "error";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}else{
						
						//
						// SUCCESS
						return "error";
						
					}
				
				break;
				case 'get_contact_data':
					//error_log('evifweb database (977) get_contact_data MSG_SOURCEID->'.$oUser->retrieve_Form_Data('MSG_SOURCEID'));
					/*
					
CREATE TABLE `log_contact_req` (
  `CONTACTID` char(50) NOT NULL,
  `CONTACTID_CRC32` bigint(11) UNSIGNED NOT NULL,
  `FIRSTNAME` varchar(100) NOT NULL,
  `LASTNAME` varchar(100) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `MOBILENUMBER` varchar(25) NOT NULL,
  `MESSAGE` blob NOT NULL,
  `PHPSESSION_ID` varchar(50) NOT NULL,
  `LANGCODE` char(2) NOT NULL DEFAULT 'EN',
  `HTTP_USER_AGENT` varchar(500) NOT NULL,
  `REMOTE_ADDR` varchar(30) NOT NULL,
  `CHK_WEB_WORK` int(11) NOT NULL DEFAULT '0',
  `CHK_EMAIL_WORK` int(11) NOT NULL DEFAULT '0',
  `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='A log of contact requests.';


log_contact_req`.`FIRSTNAME`,`log_contact_req`.`LASTNAME`,`log_contact_req`.`EMAIL`,`log_contact_req`.`MOBILENUMBER`,`log_contact_req`.`MESSAGE`,`log_contact_req`.`PHPSESSION_ID`,`log_contact_req`.`LANGCODE`,`log_contact_req`.`HTTP_USER_AGENT`,`log_contact_req`.`REMOTE_ADDR`,`log_contact_req`.`CHK_WEB_WORK`,`log_contact_req`.`CHK_EMAIL_WORK`, CHK_DESIGN
					
					*/
					
					self::$query = 'SELECT `log_contact_req`.`FIRSTNAME`,`log_contact_req`.`LASTNAME`,`log_contact_req`.`EMAIL`,`log_contact_req`.`MOBILENUMBER`,`log_contact_req`.`MESSAGE`,`log_contact_req`.`PHPSESSION_ID`,`log_contact_req`.`LANGCODE`,`log_contact_req`.`HTTP_USER_AGENT`,`log_contact_req`.`REMOTE_ADDR`,`log_contact_req`.`CHK_WEB_WORK`,`log_contact_req`.`CHK_EMAIL_WORK`, `log_contact_req`.`CHK_COPYWRITING`, `log_contact_req`.`CHK_WP_INTEGRATIONS`, `log_contact_req`.`CHK_APP_DEV`,`log_contact_req`.`CHK_BROWSER_TESTING`,`log_contact_req`.`CHK_REPORTING_ANALYTICS`,`log_contact_req`.`CHK_MOBILE`,`log_contact_req`.`CHK_SEO`,`log_contact_req`.`CHK_SOAP`, `log_contact_req`.`CHK_REDESIGN`,`log_contact_req`.`CHK_MIGRATION`,`log_contact_req`.`CHK_BACKUP`,
`log_contact_req`.`CHK_OPTIN`, `log_contact_req`.`CHK_GATEWAY`,`log_contact_req`.`CHK_SOCIAL`,`log_contact_req`.`CHK_SCA`,`log_contact_req`.`CHK_CMS`,`log_contact_req`.`CHK_DESIGN`,`log_contact_req`.`CHK_EXTRANET`, `log_contact_req`.`CHK_EMAIL_COPYWRITING`,`log_contact_req`.`CHK_DATA_CAPTURE`,`log_contact_req`.`CHK_HTML_EMAIL_DES`,`log_contact_req`.`CHK_HYGENE`, `log_contact_req`.`CHK_EMAIL_CODING`, `log_contact_req`.`CHK_AUTOMATION`, `log_contact_req`.`CHK_CAMP_MGMT`, `log_contact_req`.`CHK_LP`,`log_contact_req`.`CHK_CAMP_REPORTING`, `log_contact_req`.`CHK_EMAIL_SOCIAL`,`log_contact_req`.`CHK_IP_REP`,`log_contact_req`.`CHK_FTAF`,`log_contact_req`.`CHK_SEGMENTATION`, `log_contact_req`.`DATECREATED` FROM `log_contact_req` WHERE `log_contact_req`.`CONTACTID`="'.$oUser->retrieve_Form_Data('CONTACTID').'" AND `log_contact_req`.`CONTACTID_CRC32`="'.crc32($oUser->retrieve_Form_Data('CONTACTID')).'";';
					
					//
					// EXECUTE QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
					
					//
					// CLEAR RESULT ARRAY
					array_splice(self::$result_ARRAY, 0);
					
					$ROWCNT=0;
					if(self::$mysqli->error){
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}else{
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						while ($row = self::$result->fetch_row()) {
							foreach($row as $fieldPos=>$value){
								//
								// STORE RESULT
								error_log("evifweb /database.inc.php (1016) rowcnt[".$ROWCNT."] fieldPos[".$fieldPos."] value [".$value."]");
								self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
								
							}
							$ROWCNT++;
						}
						self::$result->free();
					
					}
				
					return self::$result_ARRAY;
					
				break;
				case 'email_unsub':
				/*
				
CREATE TABLE `email_unsub` (
  `EMAIL` varchar(100) NOT NULL,
  `EMAIL_CRC32` bigint(11) UNSIGNED NOT NULL,
  `UNSUB_COUNT` int(11) NOT NULL DEFAULT '1',
  `IPADDRESS` varchar(30) NOT NULL,
  `HTTP_USER_AGENT` varchar(500) NOT NULL,
  `DATEMODIFIED` datetime NOT NULL,
  `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Email unsubscribes.';
				
				*/
					//
					// CHECK THE UNSUB DATABASE TO SEE IF EMAIL EXISTS ALREADY.
					self::$query = 'SELECT `email_unsub`.`EMAIL`,`email_unsub`.`UNSUB_COUNT` FROM `email_unsub` WHERE 
					`email_unsub`.`EMAIL`="'.self::$mysqli->real_escape_string(strtolower(trim($oUser->retrieve_Form_Data('EMAIL')))).'" AND `email_unsub`.`EMAIL_CRC32`="'.crc32(strtolower(trim($oUser->retrieve_Form_Data('EMAIL')))).'" LIMIT 1;';					
					
					//
					// PROCESS QUERY
					//error_log("evifweb database (809) query->".self::$query);
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
					if(self::$mysqli->error){
						self::$query_exception_result = "email_unsub=error";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}else{
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						$ROWCNT=0;
						while ($row = self::$result->fetch_row()) {
							foreach($row as $fieldPos=>$value){
								//
								// STORE RESULT
								//error_log("evifweb /database.inc.php (823) rowcnt[".$ROWCNT."] fieldPos[".$fieldPos."] value [".$value."]");
								self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
								
							}
							$ROWCNT++;
						}
						self::$result->free();
						
						/*
						CREATE TABLE `log_email_unsub` (
                          `UNSUBID` char(70) NOT NULL,
                          `EMAIL` varchar(100) NOT NULL,
                          `EMAIL_CRC32` bigint(11) UNSIGNED NOT NULL,
                          `SESSIONID` char(26) NOT NULL,
                          `IPADDRESS` varchar(30) NOT NULL,
                          `HTTP_USER_AGENT` varchar(500) NOT NULL,
                          `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
                        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
						*/
						
						$tmp_unsub_id = $oUser->generateNewKey(70);
						switch($ROWCNT){
							case 0:
								//
								// EMAIL DOES NOT EXISTS. INSERT.
								error_log("evifweb database email_unsub (1201) email does not exist in unsub.");
								self::$query = 'INSERT INTO `email_unsub` (`EMAIL`,`EMAIL_CRC32`,`IPADDRESS`,`HTTP_USER_AGENT`,`DATEMODIFIED`) VALUES (
									"'.self::$mysqli->real_escape_string(strtolower(trim($oUser->retrieve_Form_Data('EMAIL')))).'",
									"'.crc32(strtolower(trim($oUser->retrieve_Form_Data('EMAIL')))).'",
									"'.$_SERVER['REMOTE_ADDR'].'",
									"'.self::$mysqli->real_escape_string($_SERVER['HTTP_USER_AGENT']).'",
									"'.$ts.'");';
								
								self::$query .= 'INSERT INTO `log_email_unsub` (`UNSUBID`,`EMAIL`,`EMAIL_CRC32`,`MSG_SOURCEID`,`SESSIONID`,`IPADDRESS`,`HTTP_USER_AGENT`) VALUES (
												"'.$tmp_unsub_id.'",
												"'.self::$mysqli->real_escape_string(strtolower(trim($oUser->retrieve_Form_Data('EMAIL')))).'",
												"'.crc32(strtolower(trim($oUser->retrieve_Form_Data('EMAIL')))).'",
												"'.self::$mysqli->real_escape_string(trim($oUser->retrieve_Form_Data('MSG_SOURCEID'))).'",
												"'.session_id().'",
												"'.$_SERVER['REMOTE_ADDR'].'",
												"'.self::$mysqli->real_escape_string($_SERVER['HTTP_USER_AGENT']).'");';
					
					
								//
								// PROCESS QUERY
								//error_log("evifweb database (112) contact_home query->".self::$query);
								self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
								if(self::$mysqli->error){
									self::$query_exception_result="unsub=error";
									throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
								
								}else{
									return "unsub=success";
								}

							break;
							default:
								//
								// EMAIL EXISTS ALREADY. UPDATE DATEMODIFIED TIMESTAMP...AND HELL...INCREMENT AN OPT OUT COUNTER AS WELL.
								error_log("evifweb database email_unsub (1208) email exist in ubnsub.");
								
								//
								// INCREMENT UNSUB COUNT
								self::$result_ARRAY[0][1]++;

								self::$query = 'UPDATE `email_unsub` SET `UNSUB_COUNT`="'.self::$result_ARRAY[0][1].'",`DATEMODIFIED`="'.$ts.'" 
									WHERE `EMAIL`="'.self::$mysqli->real_escape_string(strtolower(trim($oUser->retrieve_Form_Data('EMAIL')))).'" AND 
									`EMAIL_CRC32`="'.crc32(strtolower(trim($oUser->retrieve_Form_Data('EMAIL')))).'" LIMIT 1;';
								
								self::$query .= 'INSERT INTO `log_email_unsub` (`UNSUBID`,`EMAIL`,`EMAIL_CRC32`,`MSG_SOURCEID`,`SESSIONID`,`IPADDRESS`,`HTTP_USER_AGENT`) VALUES (
												"'.$tmp_unsub_id.'",
												"'.self::$mysqli->real_escape_string(strtolower(trim($oUser->retrieve_Form_Data('EMAIL')))).'",
												"'.crc32(strtolower(trim($oUser->retrieve_Form_Data('EMAIL')))).'",
												"'.self::$mysqli->real_escape_string(trim($oUser->retrieve_Form_Data('MSG_SOURCEID'))).'",
												"'.session_id().'",
												"'.$_SERVER['REMOTE_ADDR'].'",
												"'.self::$mysqli->real_escape_string($_SERVER['HTTP_USER_AGENT']).'");';
					
					
								//
								// PROCESS QUERY
								//error_log("evifweb database (112) contact_home query->".self::$query);
								self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
								if(self::$mysqli->error){
									self::$query_exception_result="unsub=error";
									throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
								
								}else{
									return "unsub=success";
								}
											
								
								return "unsub=success";
							break;
						
						}
									
						//
						// CLOSE CONNECTION
						$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection(self::$mysqli);
					
					}
					
				break;
				case 'get_unsub_suppression':
					self::$query = 'SELECT `email_unsub`.`EMAIL` FROM `email_unsub`;';					
					
					//
					// PROCESS QUERY
					//error_log("evifweb database (809) query->".self::$query);
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
					if(self::$mysqli->error){
						self::$query_exception_result = "error";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}else{
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						$ROWCNT=0;
						while ($row = self::$result->fetch_row()) {
							foreach($row as $fieldPos=>$value){
								//
								// STORE RESULT
								//error_log("evifweb /database.inc.php (823) rowcnt[".$ROWCNT."] fieldPos[".$fieldPos."] value [".$value."]");
								self::$result_UNSUB_ARRAY[$value]=1;
								
							}
							$ROWCNT++;
						}
						self::$result->free();
				
						//
						// CLOSE CONNECTION
						$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection(self::$mysqli);
						
						//
						// RETURN RESULT SET ARRAY
						return self::$result_UNSUB_ARRAY;
						
					}
					
					
				break;
				case 'admin_initiated_pwd_reset':
				/*self::$frm_input_ARRAY["EMAIL"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'EMAIL');
		self::$frm_input_ARRAY["LANGCODE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'LANGCODE');
		self::$frm_input_ARRAY["FIRSTNAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'FIRSTNAME');
		self::$frm_input_ARRAY["LASTNAME"]*/
		
					$tmp_activity_descript = $oUser->retrieve_Form_Data("FIRSTNAME")." ".$oUser->retrieve_Form_Data("LASTNAME")." (".$oUser->retrieve_Form_Data("EMAIL").") has been flagged to receive a password reset notification.";
					$tmp_activityid = $oUser->generateNewKey(70);
					
					//
					// LOG ADMIN ACTIVITY
					self::$query = 'INSERT INTO `log_sys_admin` (`ACTIVITY_ID`,`USERID`,`USERID_CRC32`,`USER_FIRSTNAME`,`USER_FIRSTNAME_BLOB`,`USER_LASTNAME`,`USER_LASTNAME_BLOB`,`PHPSESSION`,`IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`,`ACTIVITY_DESCRIPTION`,`ACTIVITY_DESCRIPTION_BLOB`) VALUES (
					"'.$tmp_activityid.'",
					"'.$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID').'",
					"'.crc32($oUserEnvironment->oSESSION_MGR->getSessionParam('USERID')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
					"'.self::$mysqli->real_escape_string($oUserEnvironment->oSESSION_MGR->getSessionParam('LASTNAME')).'",
					"'.session_id().'",
					"'.$_SERVER['REMOTE_ADDR'].'",
					"'.$_SERVER['HTTP_USER_AGENT'].'",
					"'.strtoupper($oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
					"'.self::$mysqli->real_escape_string($tmp_activity_descript).'");';
					
					#error_log("database (164) query->".self::$query);
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
					
					if(self::$mysqli->error){
						self::$query_exception_result="admin_initiated_pwd_reset=false";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}
					
				case 'pwd_reset':
				/*
				
CREATE TABLE `users` (
  `USERID` char(50) NOT NULL,
  `USERID_CRC32` bigint(11) UNSIGNED NOT NULL,
  `CLIENTID` char(50) NOT NULL,
  `CLIENTID_CRC32` bigint(11) UNSIGNED NOT NULL,
  `ISACTIVE` tinyint(1) NOT NULL DEFAULT '5',
  `USER_PERMISSIONS_ID` int(11) NOT NULL DEFAULT '100',
  `FIRSTNAME` varchar(100) NOT NULL,
  `LASTNAME` varchar(100) NOT NULL,
  `COMPANYNAME` varchar(100) NOT NULL,
  `JOBTITLE` varchar(100) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `EMAIL_CRC32` bigint(11) UNSIGNED NOT NULL,
  `PWDHASH` varchar(255) NOT NULL,
  `LANGCODE` char(2) NOT NULL DEFAULT 'EN',
  `LASTLOGIN` datetime DEFAULT NULL,
  `LASTLOGIN_IP` varchar(100) DEFAULT NULL,
  `LOGIN_CNT` int(11) NOT NULL DEFAULT '0',
  `IMAGE_NAME` char(70) NOT NULL DEFAULT 'sys_profile.jpg',
  `IMAGE_WIDTH` int(11) NOT NULL DEFAULT '64',
  `IMAGE_HEIGHT` int(11) NOT NULL DEFAULT '64',
  `ABOUT` varchar(300) DEFAULT NULL,
  `DATEMODIFIED` datetime NOT NULL,
  `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Users table.';
				
				
				*/
					//
					// CHECK TO SEE IF WE HAVE EMAIL ADDRESS ON RECORD FOR AN ACCOUNT.
					self::$query = 'SELECT `users`.`USERID`,`users`.`FIRSTNAME` FROM `users` WHERE 
					`users`.`EMAIL`="'.self::$mysqli->real_escape_string(strtolower(trim($oUser->retrieve_Form_Data('EMAIL')))).'" AND 
					`users`.`EMAIL_CRC32`="'.crc32(strtolower(trim($oUser->retrieve_Form_Data('EMAIL')))).'";';					
					
					//
					// PROCESS QUERY
					//error_log("evifweb database (809) query->".self::$query);
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
					if(self::$mysqli->error){
						self::$query_exception_result = "error";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}else{
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						$ROWCNT=0;
						while ($row = self::$result->fetch_row()) {
							foreach($row as $fieldPos=>$value){
								//
								// STORE RESULT
								//error_log("evifweb /database.inc.php (823) rowcnt[".$ROWCNT."] fieldPos[".$fieldPos."] value [".$value."]");
								self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
								
							}
							$ROWCNT++;
						}
						self::$result->free();
						
					}
					
					/*
					
CREATE TABLE `sys_pswd_reset` (
  `REQUESTID` char(50) NOT NULL,
  `REQUESTID_CRC32` bigint(11) UNSIGNED NOT NULL,
  `USERID` char(50) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `ISACTIVE` tinyint(1) NOT NULL DEFAULT '1',
  `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Password reset requests.'
					
					*/
					switch($ROWCNT){
						case 1:
							//
							// WE HAVE USER. SEND PASSWORD RESET LINK.
							$tmp_requestid = $oUser->generateNewKey(50);
							$tmp_msgsourceid = $oUser->generateNewKey(70);
							
							self::$query = 'INSERT INTO `sys_pswd_reset` (`REQUESTID`,`REQUESTID_CRC32`,`USERID`,`EMAIL`) VALUES ("'.$tmp_requestid.'","'.crc32($tmp_requestid).'","'.self::$result_ARRAY[0][0].'","'.self::$mysqli->real_escape_string(strtolower(trim($oUser->retrieve_Form_Data('EMAIL')))).'");';
							
							self::$query .= 'INSERT INTO `sys_msg_queue` (`MSG_SOURCEID`,`MSG_SOURCEID_CRC32`,`MSG_KEYID`,`MSG_KEYID_CRC32`,`REQUESTID`,`PWD_RESET`,`EMAIL`,`RECIPIENTNAME`,`DATEMODIFIED`) VALUES ("'.$tmp_msgsourceid.'","'.crc32($tmp_msgsourceid).'","PASSWORD_RESET","'.crc32('PASSWORD_RESET').'","'.$tmp_requestid.'","1","'.self::$mysqli->real_escape_string(strtolower($oUser->retrieve_Form_Data('EMAIL'))).'","'.self::$mysqli->real_escape_string(self::$result_ARRAY[0][1]).'","'.$ts.'");';
							
							
							//
							// PROCESS QUERY
							//error_log("evifweb database (1427) query->".self::$query);
							self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
							
							if(self::$mysqli->error){
								self::$query_exception_result = "error";
								throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
							}
							
							return "pwd_reset=success";
							
							
						break;
						default:
									
							//
							// NO EMAIL ON FILE =  RETURN ERROR
							return "pwd_reset=error";
						break;
					}

					
				
				break;
									/*
					
CREATE TABLE `sys_pswd_reset` (
  `REQUESTID` char(50) NOT NULL,
  `REQUESTID_CRC32` bigint(11) UNSIGNED NOT NULL,
  `USERID` char(50) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `ISACTIVE` tinyint(1) NOT NULL DEFAULT '1',
  `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Password reset requests.'
					
					*/
				case 'get_pwd_reset_data':
					self::$query = 'SELECT `sys_pswd_reset`.`REQUESTID`,`sys_pswd_reset`.`USERID`,`sys_pswd_reset`.`EMAIL` FROM `sys_pswd_reset` WHERE `sys_pswd_reset`.`REQUESTID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('REQUESTID')).'" AND `sys_pswd_reset`.`REQUESTID_CRC32`="'.crc32($oUser->retrieve_Form_Data('REQUESTID')).'" AND DATE_SUB(CURDATE(),'.$oUserEnvironment->getEnvParam('PWD_RESET_LINK_EXPIRE').') <= `sys_pswd_reset`.`DATECREATED` LIMIT 1;';					
					
					//
					// PROCESS QUERY
					error_log("evifweb database (1472) query->".self::$query);
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
					if(self::$mysqli->error){
						self::$query_exception_result = "error";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}else{
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						$ROWCNT=0;
						while ($row = self::$result->fetch_row()) {
							foreach($row as $fieldPos=>$value){
								//
								// STORE RESULT
								//error_log("evifweb /database.inc.php (823) rowcnt[".$ROWCNT."] fieldPos[".$fieldPos."] value [".$value."]");
								self::$result_PWD_ARRAY[$ROWCNT][$fieldPos]=$value;
								
							}
							$ROWCNT++;
						}
						self::$result->free();
						
					}
					
					
					switch($ROWCNT){
						case 1:
							return self::$result_PWD_ARRAY;
						break;
						default:
							return "pwddata=expired";
						break;
					}
					
					
				break;
				/*
				
CREATE TABLE `sys_pswd_reset` (
  `REQUESTID` char(50) NOT NULL,
  `REQUESTID_CRC32` bigint(11) UNSIGNED NOT NULL,
  `USERID` char(50) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `ISACTIVE` tinyint(1) NOT NULL DEFAULT '1',
  `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Password reset requests.';
				*/
				case 'pwd_reset_req_validate':
					//
					// CHECK FOR VALID REQUESTID
					self::$query = 'SELECT `sys_pswd_reset`.`REQUESTID` FROM `sys_pswd_reset` WHERE `sys_pswd_reset`.`REQUESTID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('REQUESTID')).'" AND `sys_pswd_reset`.`REQUESTID_CRC32`="'.crc32($oUser->retrieve_Form_Data('REQUESTID')).'" AND DATE_SUB(CURDATE(),'.$oUserEnvironment->getEnvParam('PWD_RESET_LINK_EXPIRE').') <= `sys_pswd_reset`.`DATECREATED` LIMIT 1;';					
					
					//
					// PROCESS QUERY
					//error_log("evifweb database (1472) query->".self::$query);
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
					if(self::$mysqli->error){
						self::$query_exception_result = "error";
						throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
					
					}else{
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						$ROWCNT=0;
						while ($row = self::$result->fetch_row()) {
							foreach($row as $fieldPos=>$value){
								//
								// STORE RESULT
								//error_log("evifweb /database.inc.php (823) rowcnt[".$ROWCNT."] fieldPos[".$fieldPos."] value [".$value."]");
								self::$result_PWD_ARRAY[$ROWCNT][$fieldPos]=$value;
								
							}
							$ROWCNT++;
						}
						self::$result->free();
						
					}
					
					switch($ROWCNT){
						case 1:
							
							return true;
						break;
						default:
							//error_log("evifweb database (1563) rowcnt is not 1[".$ROWCNT."] return false...");
							$oUser->transactionStatusUpdate('error','pwd_reset_lnk_expire');
							return false;
						break;
						
					}
					
				break;
				case 'pwd_update':
				
				/*
				self::$frm_input_ARRAY["PWD_HASH"] = md5(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'pwd'));
		self::$frm_input_ARRAY["PWD_HASH_CONFIRM"] = md5(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'pwdconfirm'));
		self::$frm_input_ARRAY["REQUESTID"]
		
		
		
CREATE TABLE `sys_pswd_reset` (
  `REQUESTID` char(50) NOT NULL,
  `REQUESTID_CRC32` bigint(11) UNSIGNED NOT NULL,
  `USERID` char(50) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `ISACTIVE` tinyint(1) NOT NULL DEFAULT '1',
  `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Password reset requests.';
				*/
					//
					// UPDATE USER TABLE WITH NEW PWDHASH PARAMETER FOR USER
					if($oUser->retrieve_Form_Data('PWD_HASH')==$oUser->retrieve_Form_Data('PWD_HASH_CONFIRM')){
						self::$query = 'SELECT `sys_pswd_reset`.`REQUESTID`,`sys_pswd_reset`.`USERID`,`sys_pswd_reset`.`EMAIL` FROM `sys_pswd_reset` WHERE 
						`sys_pswd_reset`.`REQUESTID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('REQUESTID')).'" AND 
						`sys_pswd_reset`.`REQUESTID_CRC32`="'.crc32($oUser->retrieve_Form_Data('REQUESTID')).'" LIMIT 1;';					
					
						//
						// PROCESS QUERY
						error_log("evifweb database (1472) query->".self::$query);
						self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
						if(self::$mysqli->error){
							self::$query_exception_result = "error";
							throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
						
						}else{
							//
							// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
							$ROWCNT=0;
							while ($row = self::$result->fetch_row()) {
								foreach($row as $fieldPos=>$value){
									//
									// STORE RESULT
									error_log("evifweb /database.inc.php (1612) rowcnt[".$ROWCNT."] fieldPos[".$fieldPos."] value [".$value."]");
									self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
									
								}
								$ROWCNT++;
							}
							self::$result->free();
							
						}
						
						/*
						self::$frm_input_ARRAY["PWD_HASH"] = md5(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'pwd'));
		self::$frm_input_ARRAY["PWD_HASH_CONFIRM"] = md5(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'pwdconfirm'));
		self::$frm_input_ARRAY["REQUESTID"]
						*/
						
						//
						// CHECK RESULTS
						switch(sizeof(self::$result_ARRAY)){
							case 1:
								//
								// UPDARTE PASSWORD HASH FOR RETURNED USERID
								$options = [
								'cost' => 9,
							];
							
							
							$tmp_pwdhash = password_hash($oUser->retrieve_Form_Data('PWD_HASH'), PASSWORD_BCRYPT, $options);
							
							self::$query = 'UPDATE `users` SET `PWDHASH`="'.$tmp_pwdhash.'",`DATEMODIFIED`="'.$ts.'" 
									WHERE `USERID`="'.self::$result_ARRAY[0][1].'" AND `USERID_CRC32`="'.crc32(self::$result_ARRAY[0][1]).'" LIMIT 1;';
									
							//
							// PROCESS QUERY
							self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
								
							if(self::$mysqli->error){
								self::$query_exception_result = "error";
								throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
							}
							
							break;
							default:
								return "pwd_update=false"; 
							break;
						
						}
						
						return "pwd_update=success"; 
					
					}else{
						
						return "pwd_update=false";
					}
					
					
					 
				break;
				case 'get_email_from_mid':
					self::$query = 'SELECT `sys_msg_queue`.`EMAIL` FROM `sys_msg_queue` WHERE 
						`sys_msg_queue`.`MSG_SOURCEID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('MSG_SOURCEID')).'" AND 
						`sys_msg_queue`.`MSG_SOURCEID_CRC32`="'.crc32($oUser->retrieve_Form_Data('MSG_SOURCEID')).'" LIMIT 1;';					
					
						//
						// PROCESS QUERY
						//error_log("evifweb database (1678) query->".self::$query);
						self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
						if(self::$mysqli->error){
							self::$query_exception_result = "error";
							throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
						
						}else{
							//
							// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
							$ROWCNT=0;
							while ($row = self::$result->fetch_row()) {
								foreach($row as $fieldPos=>$value){
									//
									// STORE RESULT
									//error_log("evifweb /database.inc.php (1612) rowcnt[".$ROWCNT."] fieldPos[".$fieldPos."] value [".$value."]");
									self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
									
								}
								$ROWCNT++;
							}
							self::$result->free();
							
						}
						
					if($ROWCNT>0){
						return self::$result_ARRAY[0][0];
					}else{
						return false;	
					}
						  
				
				break;
				default:
					//
					// HOOOSTON...VE HAF PROBLEM!
					throw new Exception('Key['.$queryType.'] provided for dbQuery() does not exist in the system.');
				break;
			}
		}catch( Exception $e ) {
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('database_integration->dbQuery()', LOG_EMERG, $e->getMessage());
			
			//
			// CLOSE CONNECTION
			$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection(self::$mysqli);
			
			return self::$query_exception_result;
		}

	}

	private function return_CRC32($val){

	    if(!isset($val) || $val==""){
	        return 0;
        }else{

	        return crc32($val);
        }
    }
		
	private function sysLangLoad($tmp_pipeArray, $oUserEnvironment, $oUser){
		
		self::$query = 'SELECT `sys_settings`.`ISOCODE` FROM `sys_settings` LIMIT 1;';
		self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
		
		//
		// CLEAR RESULT ARRAY
		array_splice(self::$result_ARRAY, 0);
		
		if(self::$mysqli->error){
			self::$query_exception_result = "error";
			throw new Exception('eVifweb database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
		
		}else{
			
			//
			// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
			$ROWCNT=0;
			while ($row = self::$result->fetch_row()) {
				foreach($row as $fieldPos=>$value){
					//
					// STORE RESULT
					self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
					
				}
				$ROWCNT++;
			}
			self::$result->free();
			
		}
		
		self::$oDB_RESP = $oUser->prepLangElem($tmp_pipeArray, self::$result_ARRAY[0][0]);
		
	}

    public function prepare_proxy_sql($protocol,$link,$oUser){

        # $tmp_sql_prep_ARRAY[0]=$new_proxy_link, $tmp_sql_prep_ARRAY[1]=SQL
        $tmp_proxy_id = $oUser->generateNewKey(100);
        $tmp_output_array = array();

        //
        // BUILD QUERY.
        $tmp_output_array[1] = 'INSERT INTO `sys_uri_proxy`
        (`PROXY_ID`,
        `PROXY_ID_CRC32`,
        `URI`,
        `URI_CRC32`,
        `USER_ID`,
        `CLIENT_ID`)
        VALUES
        ("'.$tmp_proxy_id.'",
        "'.crc32($tmp_proxy_id).'",
        "'.$protocol.'://'.$link.'",
        "'.crc32($protocol.'://'.$link).'",
        "'.$oUser->return_oENV_priv_content('getSessionParam','USERID').'",
        "'.$oUser->retrieve_Form_Data("CLIENT_ID").'");';

        //
        // EVIFWEB PROXY ENDPOINT SHOULD BE SOMETHING LIKE THIS ::
        # evifweb.com/resource/proxy/
        # ?urid=xxxxxxx

        # EXTERNAL_URI_PROXY_PATH

        // NEW LINK
        $tmp_output_array[0] = $oUser->return_oENV_priv_content('getEnvParam','EXTERNAL_URI_PROXY_PATH')."?urid=".$tmp_proxy_id;
        //error_log("database (7454) prepare_proxy_sql LINK [".$tmp_output_array[0]."]");
        //error_log("database (7455) prepare_proxy_sql SQL [".$tmp_output_array[1]."]");
        return $tmp_output_array;
    }
	
	public function __destruct() {

	}
}

?>