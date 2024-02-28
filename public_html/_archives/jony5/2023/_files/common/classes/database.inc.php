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

           // error_log("database (471) key[".$tmp_serial_key_ARRAY[$ii]."] count=".$tmp_key_count_ARRAY[self::$result_profile_serial_handle_ARRAY[$tmp_serial_key_ARRAY[$ii]]][$tmp_serial_key_ARRAY[$ii]]);
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
                    error_log("database (1053) process next result set ".$select_query_cnt);
                }

            } while ($heavy_mysqli->more_results() && $heavy_mysqli->next_result());

        }

        error_log("database (1060) done processing multi-query. rows=".$ROWCNT);
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
                //$tmp_USER_ID_pointer_array = self::$oSQLMapper->return_value_pointer_array($serial,$profile,'USER_ID',$i);
                //$tmp_CLIENT_ID_pointer_array = self::$oSQLMapper->return_value_pointer_array($serial,$profile,'CLIENT_ID',$i);
                $tmp_USER_ID_pointer_array = self::$oSQLMapper->return_value_pointer_array($serial,$profile,'PROFILE_ID',$i);
                $tmp_CLIENT_ID_pointer_array = self::$oSQLMapper->return_value_pointer_array($serial,$profile,'LANG_ID',$i);


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



class database_integration {
	private static $oLogger;
    private static $oDB_RESP;
    private static $mysqli;
    private static $result_MSGQUEUE_ARRAY = array();
    private static $result_UNSUB_ARRAY = array();
    private static $result_PWD_ARRAY = array();
    public $recursive_target_id_omit_flag = array();

	private static $query;
	private static $query_elements;
	private static $result;
	private static $result_ARRAY = array();
	private static $queryDescript_ARRAY = array();
	private static $query_exception_result = false;
	
	public function __construct() {
		//
		// INSTANTIATE LOGGER
		if(!isset(self::$oLogger)){
			self::$oLogger = new crnrstn_logging();
		}
	}

    public function processUserRequest($queryType ,$oUser, $oUserEnvironment){

        return $this->executeQueryType($queryType, $oUser, $oUserEnvironment);

    }
	
	public function getDailyPodcast($oUser, $oUserEnvironment , $contentType){

		return $this->dbQuery($contentType, $oUserEnvironment, $oUser);

	}

    public function bassdrive_stream_social_sync($oUser, $oUserEnvironment, $contentType){

        return $this->dbQuery($contentType, $oUserEnvironment, $oUser);

    }

    public function bassdrive_stream_colors_sync($oUser, $oUserEnvironment, $contentType){

        return $this->dbQuery($contentType, $oUserEnvironment, $oUser);

    }

    public function bassdrive_stream_lookup_sync($oUser, $oUserEnvironment, $contentType){

        return $this->dbQuery($contentType, $oUserEnvironment, $oUser);

    }

	public function bassdrive_colors_presentation($oUser, $oUserEnvironment, $contentType){

        return $this->dbQuery($contentType, $oUserEnvironment, $oUser);

    }

    public function bassdrive_history_output($oUser, $oUserEnvironment, $contentType){

        return $this->dbQuery($contentType, $oUserEnvironment, $oUser);

    }

	public function bassdrive_colors_algorithm_output($oUser, $oUserEnvironment, $contentType){

        return $this->dbQuery($contentType, $oUserEnvironment, $oUser);

    }

    public function return_stream_social_association_ARRAY($oUser, $oUserEnvironment, $contentType){

        return $this->dbQuery($contentType, $oUserEnvironment, $oUser);

    }

    public function return_bassdrive_log_ojson($oUser, $oUserEnvironment, $contentType){

        return $this->dbQuery($contentType, $oUserEnvironment, $oUser);

    }

    public function return_bassdrive_ojson($oUser, $oUserEnvironment, $contentType){

        return $this->dbQuery($contentType, $oUserEnvironment, $oUser);

    }

	public function ttl_bassdriveData($oUser, $oUserEnvironment, $contentType){

        return $this->dbQuery($contentType, $oUserEnvironment, $oUser);

    }

    public function expire_ttl_bassdriveData($oUser, $oUserEnvironment, $contentType){

        return $this->dbQuery($contentType, $oUserEnvironment, $oUser);

    }

    public function bassdrive_stream_initialization($oUser, $oUserEnvironment, $contentType){

        return $this->dbQuery($contentType, $oUserEnvironment, $oUser);

    }

    public function bassdrive_serialize_streams($oUser, $oUserEnvironment, $query_ARRAY){

        try{

            //
            // OPEN CONNECTION
            self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->returnConnection();
            self::$query = '';
            $tmp_query_count = 0;

            foreach($query_ARRAY as $index => $query_string){

                if($tmp_query_count < 500){

                    self::$query .= $query_string;

                }

                $tmp_query_count++;

            }

            //
            // PROCESS QUERY
            self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

            if(self::$mysqli->error){

                throw new Exception('jony5 database_integration :: bassdrive :: bassdrive_serialize_streams ERROR :: ['.self::$mysqli->error.']');

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('database_integration->executeQueryType()', LOG_EMERG, $e->getMessage());

            return 'JONY5 CRON FIRED ERR :: '.$e->getMessage();

        }

    }

    public function bassdrive_stream_history_update($oUser, $oCRNRSTN_ENV){

        date_default_timezone_set('America/New_York');
        $ts = date("Y-m-d H:i:s", time());

        $tmp_html = $oUser->bassdrive_rebuild_stream_history_output();
        $tmp_log_activity = $oUser->bassdrive_history_activity_log();

        //error_log(__LINE__ . 'database html out len='.strlen($tmp_html));

        if(strlen($tmp_html) > 8000){

            //
            // OPEN CONNECTION
            self::$mysqli = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection();

            //
            // UPDATE TABLE
            self::$query = 'UPDATE `bassdrive_stream_history`
            SET
            `RAW_HTML` = "' . self::$mysqli->real_escape_string($tmp_html) . '",
            `DATEMODIFIED` = "'.$ts.'"
            WHERE `ID` = 1 LIMIT 1;
            ';

            //
            // PROCESS QUERY
            self::$result = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);

            if(self::$mysqli->error){

                throw new Exception('JONY5 database_integration :: bassdrive_stream_history_update() ERROR :: ['.self::$mysqli->error.']');

            }else{

                return $tmp_log_activity;

            }

        }else{

            return NULL;

        }

        //http://jony5.com/_proxy/bassdrive_colors/?action=rebuild&cnt=4555

    }

	public function bassdrive_log_insert($oUser, $oCRNRSTN_ENV, $contentType, $programTitle){

	    try{

            date_default_timezone_set('America/New_York');
            $ts = date("Y-m-d H:i:s", time());

            $serial = $oUser->generateNewKey(64);

            //
            // OPEN CONNECTION
            self::$mysqli = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection();

            self::$query = 'INSERT INTO `log_bassdrive_program`
            (`SERIAL`,
            `PROGRAM_TITLE`,
            `STREAM_RELAY_JSON`,
            `DATEMODIFIED`)
            VALUES
            (
            "'.$serial.'",
            "'.self::$mysqli->real_escape_string($programTitle).'",
            "'.self::$mysqli->real_escape_string($oUser->bassdrive_stream_ojson).'",                    
            "'.$ts.'");
            ';
            //
            // PROCESS QUERY
            self::$result = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);

            if(self::$mysqli->error){

                throw new Exception('JONY5 database_integration :: '.$contentType.' ERROR :: ['.self::$mysqli->error.']');

            }else{

                //
                // CLOSE CONNECTION
                $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->closeConnection(self::$mysqli);

                return NULL;

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('database_integration->executeQueryType()', LOG_EMERG, $e->getMessage());

            //
            // CLOSE CONNECTION
            $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->closeConnection(self::$mysqli);

            return 'JONY5 CRON FIRED ERR :: '.$e->getMessage();

        }

    }


    public function bassdrive_track($oUser, $oCRNRSTN_ENV, $contentType, $programTitle){

        try{

            date_default_timezone_set('America/New_York');
            $ts = date("Y-m-d H:i:s", time());

            $serial = $oUser->generateNewKey(64);

            //
            // OPEN CONNECTION
            self::$mysqli = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection();

            self::$query = 'INSERT INTO `log_bassdrive_program`
                        (`SERIAL`,
                        `PROGRAM_TITLE`,
                        `STREAM_RELAY_JSON`,
                        `DATEMODIFIED`)
                        VALUES
                        (
                        "'.$serial.'",
                        "'.self::$mysqli->real_escape_string($programTitle).'",
                        "'.self::$mysqli->real_escape_string($oUser->relay_ojson).'",                    
                        "'.$ts.'");
                        ';
            //
            // PROCESS QUERY
            self::$result = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);

            if(self::$mysqli->error){

                throw new Exception('JONY5 database_integration :: '.$contentType.' ERROR :: ['.self::$mysqli->error.']');

            }else{

                //
                // REBUILD AND CACHE HTML OUTPUT
                $db_result = $oUser->bassdrive_stream_history_update();

                //
                // CLOSE CONNECTION
                $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->closeConnection(self::$mysqli);

                //
                // RETURN RESULT SET ARRAY
                return 'success - ['.$programTitle.'] @ '. $ts .  '<br>:: :: :: :: ::<br>' . $db_result;

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('database_integration->executeQueryType()', LOG_EMERG, $e->getMessage());

            //
            // CLOSE CONNECTION
            $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->closeConnection(self::$mysqli);

            return 'JONY5 CRON FIRED ERR :: '.$e->getMessage();

        }

    }
	
	public function rotateDailyPodcast($oUser, $oUserEnvironment , $contentType){

		return $this->dbQuery($contentType, $oUserEnvironment, $oUser);

	}

	public function svc_postUserFeedback($oUser, $oUserEnvironment){

		return $this->dbQuery('post_feedback', $oUserEnvironment, $oUser);

	}

    private function executeQueryType($queryType, $oUser, $oUserEnvironment)
    {
        try {
            error_log('database.inc.php (1526) jony5 queryType sent to user database_integrations class object :: ' . $queryType . ' from [' . $_SERVER['REMOTE_ADDR'] . ']');
            #$ts = date("Y-m-d H:i:s", time()-60*60*4);
            $ts = date("Y-m-d H:i:s", time());

            //
            // IF WE EVER NEED TO CONNECT TO MORE THAN 1 DATABASE IN A REQUEST....NEED TO WIRE IN MYSQLI CONN RESET BOOLEAN
            // FOR NOW, THE PERFORMANCE BOOST FROM MAINTAINING CONNECTION PERSIST IS WORTH IT. CAN ADD MULTI-DB SUPPORT LATER.
            //if (isset(self::$mysqli)) {
                if (!self::$mysqli->ping()) {

                    //error_log("database (1441) mysqli->I will open a new connection now! ping()==FALSE");
                    //
                    // OPEN CONNECTION
                    self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->returnConnection();

                }

            //} else {
                //error_log("database (1447) mysqli->I will open a new connection now! ...mysqli not set");

                //
                // OPEN CONNECTION
            //    self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->returnConnection();
            //}

            if (!isset($oDB_RESP)) {

                if (!isset(self::$oDB_RESP)) {
                   // error_log("database (1830) executeRequest() NOTICE :: We are instantiating a CLEAN oDB_RESP object for querytype[" . $queryType . "] Why not recycle?");
                    self::$oDB_RESP = new database_response_manager($oUserEnvironment, $this);
                    $oDB_RESP = self::$oDB_RESP;
                } else {
                    $oDB_RESP = self::$oDB_RESP;
                }
            }

            $tmp_query = '';

            switch ($queryType) {
                case 'showovrly_fullscrn':
                case 'hideovrly_fullscrn':
                case 'bluescrn':
                case 'whitescrn':
                case 'blackscrn':
                case 'hideovrly_rt':
                case 'hideovrly_kt':
                case 'hideovrly_pt':
                case 'hidetmr_r':
                case 'hidetmr_k':
                case 'hidetmr_p':
                case 'showtmr':
                case 'show_overlay':

                    $tmp_ISACTIVE = NULL;
                    $tmp_modifierid = $oUser->generateNewKey(70);


                /*
                      <div class="admin_section_title">Manage Mini Overlay</div>
                        <div class="mgmt_lnk_btn" onclick="applyUpdate(this);" avreqid="hideovrly_rt">HIDE OVERLAY - RESET TIMER</div>
                        <div class="mgmt_lnk_btn" onclick="applyUpdate(this);" avreqid="hideovrly_kt">HIDE OVERLAY - KEEP UP WITH TIMER</div>
                        <div class="mgmt_lnk_btn" onclick="applyUpdate(this);" avreqid="hideovrly_pt">HIDE OVERLAY - PAUSE TIMER</div>

                        <div class="admin_section_title">Timer Controls</div>
                        <div class="mgmt_lnk_btn" onclick="applyUpdate(this);" avreqid="hidetmr_r">HIDE TIMER AND RESET TO 00:00</div>
                        <div class="mgmt_lnk_btn" onclick="applyUpdate(this);" avreqid="hidetmr_k">HIDE TIMER AND KEEP UP WITH IT</div>
                        <div class="mgmt_lnk_btn" onclick="applyUpdate(this);" avreqid="hidetmr_p

                        MINI_STATE tinyint (1)
                        [1=FULLACTIVE,
                        5=ACTIVESANSTIMER,
                        8=ACTIVESANSTIMERRESETONDISPLAY,
                        7=ACTIVESANSTIMERBUTKEEPTIME
                        6=ACTIVESANSTIMERPAUSETIME

                        0=HIDDENTIMERNOTOUCHY,
                        3=HIDDENRESETTIMERONDISPLAY,
                        2=HIDDENPAUSETIMER]

                        FULLSCREEN_STATE tinyint (1)
                        [1=FULLACTIVE,
                        5=WHITEOUT,
                        8=HIDDEN,
                        9=BLUEOUT,
                        7=BLACKOUT]
                */

                    switch($queryType) {
                        case 'showovrly_fullscrn':
                        case 'hideovrly_fullscrn':
                        case 'bluescrn':
                        case 'whitescrn':
                        case 'blackscrn':

                            $tmp_type = 'full';
                        break;
                        default:

                            $tmp_type = 'mini';

                        break;
                    }

                    switch($queryType) {
                        case 'showovrly_fullscrn':
                            $tmp_ISACTIVE = '1';
                        break;
                        case 'hideovrly_fullscrn':
                            $tmp_ISACTIVE = '3';
                        break;
                        case 'bluescrn':
                            $tmp_ISACTIVE = '4';
                        break;
                        case 'whitescrn':
                            $tmp_ISACTIVE = '5';
                        break;
                        case 'blackscrn':
                            $tmp_ISACTIVE = '6';
                        break;
                        case 'hideovrly_rt':
                            $tmp_ISACTIVE = '3';
                        break;
                        case 'hideovrly_kt':
                            $tmp_ISACTIVE = '0';
                        break;
                        case 'hideovrly_pt':
                            $tmp_ISACTIVE = '2';
                        break;
                        case 'hidetmr_r':
                            $tmp_ISACTIVE = '8';
                        break;
                        case 'hidetmr_k':
                            $tmp_ISACTIVE = '7';
                        break;
                        case 'hidetmr_p':
                            $tmp_ISACTIVE = '6';
                        break;
                        case 'showtmr':
                            $tmp_ISACTIVE = '4';
                        break;
                        case 'show_overlay':
                            $tmp_ISACTIVE = '5';
                        break;
                        default:

                            throw new Exception('jony5 database_integration :: '.$queryType.' ERROR :: [UNKNOWN ISACTIVE STATE ['.$queryType.'] SENT TO DATABASE.]');

                        break;

                    }

                    if(isset($tmp_ISACTIVE) && $tmp_type=='mini') {
                        switch($queryType){
                            case 'hideovrly_rt':
                            case 'hideovrly_kt':
                            case 'hideovrly_pt':
                            self::$query = 'UPDATE `cia00_overlay_state` SET `MINI_STATE`="0",
                       `MODIFIER_ID` = "' . $tmp_modifierid . '",
                       `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        `MODIFIER_SESSION_ID` = "' . session_id() . '",
                        `DATEMODIFIED`="' . $ts . '" 
					     LIMIT 1;';
                            break;
                            case 'hidetmr_r':
                            case 'hidetmr_k':
                            case 'hidetmr_p':
                            self::$query = 'UPDATE `cia00_overlay_state` SET `MINI_TIMER_STATE`="0",
                       `MODIFIER_ID` = "' . $tmp_modifierid . '",
                       `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        `MODIFIER_SESSION_ID` = "' . session_id() . '",
                        `DATEMODIFIED`="' . $ts . '" 
					     LIMIT 1;';
                                break;
                            case 'showtmr':
                                self::$query = 'UPDATE `cia00_overlay_state` SET `MINI_TIMER_STATE`="1",
                       `MODIFIER_ID` = "' . $tmp_modifierid . '",
                       `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        `MODIFIER_SESSION_ID` = "' . session_id() . '",
                        `DATEMODIFIED`="' . $ts . '" 
					     LIMIT 1;';
                                break;
                            case 'show_overlay':
                                self::$query = 'UPDATE `cia00_overlay_state` SET `MINI_STATE`="1",
                       `MODIFIER_ID` = "' . $tmp_modifierid . '",
                       `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        `MODIFIER_SESSION_ID` = "' . session_id() . '",
                        `DATEMODIFIED`="' . $ts . '" 
					     LIMIT 1;';
                                break;
                            default:
                                self::$query = '';
                                break;


                        }


                        $tmp_activityid = $oUser->generateNewKey(70);

                        $tmp_activity_descript = "A ".$tmp_type." overlay UPDATE (<span class='a_log_topic_name'>".$queryType."</span>) has been received.";

                        self::$query .= 'INSERT INTO `cia00_log_sys_user`
                        (`ACTIVITY_ID`,
                        `MODIFIER_ID`,
                        `MODIFIER_ID_CRC32`,
                        `ACTIVITY_DESCRIPTION`,
                        `ACTIVITY_DESCRIPTION_BLOB`,
                        `PHPSESSION`,
                        `IPADDRESS`,
                        `HTTP_USER_AGENT`,
                        `CHANNEL`)
                        VALUES (
                        "'.$tmp_activityid.'",
                        "'.$tmp_modifierid.'",
                        "'.crc32($tmp_modifierid).'",
                        "'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
                        "'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
                        "'.session_id().'",
                        INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        "'.$_SERVER['HTTP_USER_AGENT'].'",
                        "D");';

                        self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                        #error_log("database (1125) query->".self::$query);
                        if(self::$mysqli->error){

                            self::$query_exception_result = "overlay_update=error";
                            throw new Exception('jony5 database_integration :: mini overlay :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                        }else {

                            //do {
                            //} while (self::$mysqli->more_results() && self::$mysqli->next_result());

                            //
                            // XML SYNC
                            $this->syncXML($tmp_type, $queryType, $oUser, $oUserEnvironment);

                            return 'success';
                        }

                    }

                    if(isset($tmp_ISACTIVE) && $tmp_type=='full') {
                        self::$query = 'UPDATE `cia00_overlay_state` SET `FULLSCREEN_STATE`="'.$tmp_ISACTIVE.'",
                        `MODIFIER_ID` = "' . $tmp_modifierid . '",
                        `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        `MODIFIER_SESSION_ID` = "' . session_id() . '",
                        `DATEMODIFIED`="' . $ts . '" 
                        LIMIT 1;';

                        $tmp_activityid = $oUser->generateNewKey(70);

                        $tmp_activity_descript = "A ".$tmp_type." overlay UPDATE (<span class='a_log_topic_name'>".$queryType."</span>) has been received.";

                        self::$query .= 'INSERT INTO `cia00_log_sys_user`
                        (`ACTIVITY_ID`,
                        `MODIFIER_ID`,
                        `MODIFIER_ID_CRC32`,
                        `ACTIVITY_DESCRIPTION`,
                        `ACTIVITY_DESCRIPTION_BLOB`,
                        `PHPSESSION`,
                        `IPADDRESS`,
                        `HTTP_USER_AGENT`,
                        `CHANNEL`)
                        VALUES (
                        "'.$tmp_activityid.'",
                        "'.$tmp_modifierid.'",
                        "'.crc32($tmp_modifierid).'",
                        "'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
                        "'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
                        "'.session_id().'",
                        INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        "'.$_SERVER['HTTP_USER_AGENT'].'",
                        "D");';

                        self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                        #error_log("database (1125) query->".self::$query);
                        if(self::$mysqli->error){

                            self::$query_exception_result = "overlay_update=error";
                            throw new Exception('jony5 database_integration :: full screen  overlay :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                        }else {

                            //do {
                            //} while (self::$mysqli->more_results() && self::$mysqli->next_result());

                            //
                            // XML SYNC
                            $this->syncXML($tmp_type, $queryType, $oUser,$oUserEnvironment);

                            return 'success';
                        }


                    }



                    return 'err';

                break;
                case 'activate_full_profile':
                    $tmp_activityid = $oUser->generateNewKey(70);
                    $tmp_modifierid = $oUser->generateNewKey(70);

                    $tmp_activity_descript = "A full screen overlay profile (<span class='a_log_topic_name'>".$oUser->retrieve_Form_Data('NAME')."</span>) has been made active.";

                    self::$query = 'UPDATE `cia00_overlay_state` SET `FULLSCREEN_PROFILE_ID`="'.$oUser->retrieve_Form_Data('PROFILE_ID').'",
                       `MODIFIER_ID` = "' . $tmp_modifierid . '",
                       `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        `MODIFIER_SESSION_ID` = "' . session_id() . '",
                        `DATEMODIFIED`="' . $ts . '" 
					     LIMIT 1;';

                    self::$query .= 'INSERT INTO `cia00_log_sys_user`
                    (`ACTIVITY_ID`,
                    `MODIFIER_ID`,
                    `MODIFIER_ID_CRC32`,
                    `FULL_SCRN_PROFILE_ID`,
                    `FULL_SCRN_PROFILE_ID_CRC32`,
                    `ACTIVITY_DESCRIPTION`,
                    `ACTIVITY_DESCRIPTION_BLOB`,
                    `PHPSESSION`,
                    `IPADDRESS`,
                    `HTTP_USER_AGENT`,
                    `CHANNEL`)
                    VALUES (
                    "'.$tmp_activityid.'",
                    "'.$tmp_modifierid.'",
                    "'.crc32($tmp_modifierid).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID')).'",
                    "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'",
                    "'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
                    "'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
                    "'.session_id().'",
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "'.$_SERVER['HTTP_USER_AGENT'].'",
                    "D");';

                    //error_log(self::$query);

                    self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){

                        self::$query_exception_result = "full_overlay_select=error";
                        throw new Exception('jony5 database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else {
                        return 'success';
                    }

                break;
                case 'activate_mini_profile':
                    $tmp_activityid = $oUser->generateNewKey(70);
                    $tmp_modifierid = $oUser->generateNewKey(70);

                    $tmp_activity_descript = "A mini overlay profile (<span class='a_log_topic_name'>".$oUser->retrieve_Form_Data('NAME')."</span>) has been made active.";

                    self::$query = 'UPDATE `cia00_overlay_state` SET `MINI_PROFILE_ID`="'.$oUser->retrieve_Form_Data('PROFILE_ID').'",
                       `MODIFIER_ID` = "' . $tmp_modifierid . '",
                       `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        `MODIFIER_SESSION_ID` = "' . session_id() . '",
                        `DATEMODIFIED`="' . $ts . '" 
					     LIMIT 1;';

                    self::$query .= 'INSERT INTO `cia00_log_sys_user`
                    (`ACTIVITY_ID`,
                    `MODIFIER_ID`,
                    `MODIFIER_ID_CRC32`,
                    `MINI_PROFILE_ID`,
                    `MINI_PROFILE_ID_CRC32`,
                    `ACTIVITY_DESCRIPTION`,
                    `ACTIVITY_DESCRIPTION_BLOB`,
                    `PHPSESSION`,
                    `IPADDRESS`,
                    `HTTP_USER_AGENT`,
                    `CHANNEL`)
                    VALUES (
                    "'.$tmp_activityid.'",
                    "'.$tmp_modifierid.'",
                    "'.crc32($tmp_modifierid).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID')).'",
                    "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'",
                    "'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
                    "'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
                    "'.session_id().'",
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "'.$_SERVER['HTTP_USER_AGENT'].'",
                    "D");';

                    //error_log(self::$query);

                    self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
                    if(self::$mysqli->error){

                        self::$query_exception_result = "mini_overlay_select=error";
                        throw new Exception('jony5 database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else {
                        return 'success';
                    }

                break;
                case 'new_fullscreen_profile':
                    /*
                     * self::$http_param_handle["PROFILE_NAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'profilename');
                        self::$http_param_handle["PAGE_HEADER"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'pagehdr');
                        self::$http_param_handle["PAGE_TITLE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'pagetitle');
                        self::$http_param_handle["PAGE_CODE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'pagecode');
                        self::$http_param_handle["FONT_SIZE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'fontsize');
                        self::$http_param_handle["LANG_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'lang_code'));

                    "'.self::$mysqli->real_escape_string($this->clearDblBR($oUser->retrieve_Form_Data('PAGE_HEADER'))).'",
                    "'.self::$mysqli->real_escape_string($this->clearDblBR($oUser->retrieve_Form_Data('PAGE_HEADER'))).'",
                    "'.self::$mysqli->real_escape_string($this->clearDblBR($oUser->retrieve_Form_Data('PAGE_TITLE'))).'",
                    "'.self::$mysqli->real_escape_string($this->clearDblBR($oUser->retrieve_Form_Data('PAGE_TITLE'))).'",
                    "'.self::$mysqli->real_escape_string($this->clearDblBR($oUser->retrieve_Form_Data('PAGE_CODE'))).'",

                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("PAGE_HEADER")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("PAGE_TITLE")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("PAGE_CODE")).'",
                    * */

                    $tmp_profileid = $oUser->generateNewKey(70);
                    $tmp_copyid = $oUser->generateNewKey(70);
                    $tmp_creatorid = $oUser->generateNewKey(70);
                    $tmp_activityid = $oUser->generateNewKey(70);
                    $tmp_modifierid = $tmp_creatorid;

                    $tmp_activity_descript = "A new full screen overlay profile (<span class='a_log_topic_name'>".$oUser->retrieve_Form_Data('PROFILE_NAME')."</span>) has been created.";

                    self::$query = 'INSERT INTO `cia00_overlay_fullscrn_profile`
                    (`PROFILE_ID`,
                    `PROFILE_ID_CRC32`,
                    `PROFILE_NAME`,
                    `CREATOR_ID`,
                    `CREATOR_IP`,
                    `CREATOR_SESSION_ID`,
                    `MODIFIER_ID`,
                    `MODIFIER_IP`,
                    `MODIFIER_SESSION_ID`,
                    `DATEMODIFIED`)
                    VALUES (
                    "'.$tmp_profileid.'",
                    "'.crc32($tmp_profileid).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("PROFILE_NAME")).'",
                    "'.$tmp_creatorid.'",
                    INET_ATON("'.$_SERVER['REMOTE_ADDR'].'"),
                    "'.session_id().'",
                    "'.$tmp_modifierid.'",
                    INET_ATON("'.$_SERVER['REMOTE_ADDR'].'"),
                    "'.session_id().'",
                    "'.$ts.'");';

                    self::$query .= 'INSERT INTO `cia00_lang_copy`
                    (`COPY_ID`,
                    `PROFILE_ID`,
                    `PROFILE_TYPE`,
                    `LANG_ID`,
                    `FONT_SIZE`,
                    `PAGE_HEADER`,
                    `PAGE_HEADER_BLOB`,
                    `PAGE_TITLE`,
                    `PAGE_TITLE_BLOB`,
                    `PAGE_CODE_BLOB`,
                    `CREATOR_ID`,
                    `CREATOR_IP`,
                    `CREATOR_SESSION_ID`,
                    `MODIFIER_ID`,
                    `MODIFIER_IP`,
                    `MODIFIER_SESSION_ID`,
                    `DATEMODIFIED`)
                    VALUES (
                    "'.$tmp_copyid.'",
                    "'.$tmp_profileid.'",
                    "full",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("LANG_ID")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("FONT_SIZE")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("PAGE_HEADER")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("PAGE_HEADER")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("PAGE_TITLE")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("PAGE_TITLE")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("PAGE_CODE")).'",
                    "'.$tmp_creatorid.'",
                    INET_ATON("'.$_SERVER['REMOTE_ADDR'].'"),
                    "'.session_id().'",
                    "'.$tmp_modifierid.'",
                    INET_ATON("'.$_SERVER['REMOTE_ADDR'].'"),
                    "'.session_id().'",
                    "'.$ts.'");
';

                    self::$query .= 'INSERT INTO `cia00_log_sys_user`
                    (`ACTIVITY_ID`,
                    `MODIFIER_ID`,
                    `MODIFIER_ID_CRC32`,
                    `FULL_SCRN_PROFILE_ID`,
                    `FULL_SCRN_PROFILE_ID_CRC32`,
                    `ACTIVITY_DESCRIPTION`,
                    `ACTIVITY_DESCRIPTION_BLOB`,
                    `PHPSESSION`,
                    `IPADDRESS`,
                    `HTTP_USER_AGENT`,
                    `CHANNEL`)
                    VALUES (
                    "'.$tmp_activityid.'",
                    "'.$tmp_modifierid.'",
                    "'.crc32($tmp_modifierid).'",
                    "'.self::$mysqli->real_escape_string($tmp_profileid).'",
                    "'.crc32($tmp_profileid).'",
                    "'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
                    "'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
                    "'.session_id().'",
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "'.$_SERVER['HTTP_USER_AGENT'].'",
                    "D");';

                    self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        self::$query_exception_result = "new_fullscrn_profile=error=".self::$mysqli->error;
                        throw new Exception('jony5 database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else{

                        /*
                        do{
                        } while (self::$mysqli->more_results() && self::$mysqli->next_result());
                        */

                        return "success";
                    }

                break;
                case 'new_mini_profile':

                    $tmp_profileid = $oUser->generateNewKey(70);
                    $tmp_creatorid = $oUser->generateNewKey(70);
                    $tmp_copyid = $oUser->generateNewKey(70);
                    $tmp_activityid = $oUser->generateNewKey(70);
                    $tmp_modifierid = $tmp_creatorid;

                    $tmp_activity_descript = "A new mini overlay profile (<span class='a_log_topic_name'>".$oUser->retrieve_Form_Data('PROFILE_NAME')."</span>) has been created.";

                    self::$query = 'INSERT INTO `cia00_overlay_mini_profile` 
                    (`PROFILE_ID`,`PROFILE_ID_CRC32`,`PROFILE_NAME`,`MESSAGE_TITLE`,`MESSAGE_TITLE_BLOB`,`MESSAGE_NUMBER`,`MESSAGE_NUMBER_BLOB`,`MESSAGE_SPEAKER`,`MESSAGE_SPEAKER_BLOB`,`CONFERENCE_TITLE`,`CONFERENCE_TITLE_BLOB`,`OVERLAY_HEIGHT`,`OVERLAY_WIDTH`,`INNER_CONTENT_WIDTH`,`MARGIN_LEFT`,`MARGIN_RIGHT`,`ABS_PX_FROM_TOP`,`ABS_PX_FROM_LEFT`,`CREATOR_ID`,`CREATOR_IP`,`CREATOR_SESSION_ID`,`MODIFIER_ID`,`MODIFIER_IP`,`MODIFIER_SESSION_ID`,`DATEMODIFIED`)
                    VALUES (
                    "'.$tmp_profileid.'",
                    "'.crc32($tmp_profileid).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("PROFILE_NAME")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("MESSAGE_TITLE")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("MESSAGE_TITLE")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("MESSAGE_NUMBER")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("MESSAGE_NUMBER")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("MESSAGE_SPEAKER")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("MESSAGE_SPEAKER")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CONFERENCE_TITLE")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CONFERENCE_TITLE")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("OVERLAY_HEIGHT")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("OVERLAY_WIDTH")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("INNER_CONTENT_WIDTH")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("MARGIN_LEFT")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("MARGIN_RIGHT")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ABS_PX_FROM_TOP")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("ABS_PX_FROM_LEFT")).'",
                    "'.$tmp_creatorid.'",
                    INET_ATON("'.$_SERVER['REMOTE_ADDR'].'"),
                    "'.session_id().'",
                    "'.$tmp_modifierid.'",
                    INET_ATON("'.$_SERVER['REMOTE_ADDR'].'"),
                    "'.session_id().'",
                    "'.$ts.'");';

                    self::$query .= 'INSERT INTO `cia00_lang_copy`
                    (`COPY_ID`,
                    `PROFILE_ID`,
                    `PROFILE_TYPE`,
                    `LANG_ID`,
                    `MESSAGE_TITLE`,
                    `MESSAGE_TITLE_BLOB`,
                    `MESSAGE_NUMBER`,
                    `MESSAGE_NUMBER_BLOB`,
                    `CONFERENCE_TITLE`,
                    `CONFERENCE_TITLE_BLOB`,
                    `DATE_COPY`,
                    `DATE_COPY_BLOB`,
                    `CREATOR_ID`,
                    `CREATOR_IP`,
                    `CREATOR_SESSION_ID`,
                    `MODIFIER_ID`,
                    `MODIFIER_IP`,
                    `MODIFIER_SESSION_ID`,
                    `DATEMODIFIED`)
                    VALUES
                    (
                     "'.$tmp_copyid.'",
                    "'.$tmp_profileid.'",
                    "mini",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("LANG_ID")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("MESSAGE_TITLE")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("MESSAGE_TITLE")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("MESSAGE_NUMBER")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("MESSAGE_NUMBER")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CONFERENCE_TITLE")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CONFERENCE_TITLE")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("MESSAGE_DATE")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("MESSAGE_DATE")).'",
                    "'.$tmp_creatorid.'",
                    INET_ATON("'.$_SERVER['REMOTE_ADDR'].'"),
                    "'.session_id().'",
                    "'.$tmp_modifierid.'",
                    INET_ATON("'.$_SERVER['REMOTE_ADDR'].'"),
                    "'.session_id().'",
                    "'.$ts.'");
                    ';


                    self::$query .= 'INSERT INTO `cia00_log_sys_user`
                    (`ACTIVITY_ID`,
                    `MODIFIER_ID`,
                    `MODIFIER_ID_CRC32`,
                    `MINI_PROFILE_ID`,
                    `MINI_PROFILE_ID_CRC32`,
                    `ACTIVITY_DESCRIPTION`,
                    `ACTIVITY_DESCRIPTION_BLOB`,
                    `PHPSESSION`,
                    `IPADDRESS`,
                    `HTTP_USER_AGENT`,
                    `CHANNEL`)
                    VALUES (
                    "'.$tmp_activityid.'",
                    "'.$tmp_modifierid.'",
                    "'.crc32($tmp_modifierid).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID')).'",
                    "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'",
                    "'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
                    "'.self::$mysqli->real_escape_string($tmp_activity_descript).'",
                    "'.session_id().'",
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "'.$_SERVER['HTTP_USER_AGENT'].'",
                    "D");';

                    error_log('2137 query->'.self::$query);

                    self::$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        self::$query_exception_result = "new_mini_profile=error=".self::$mysqli->error;
                        throw new Exception('jony5 database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else{

                        /*
                        do{
                        } while (self::$mysqli->more_results() && self::$mysqli->next_result());
                        */

                        return "success";
                    }

                break;
                case 'get_overlay_mgmt_state':
                    $force_profile_select_align = true;
                    $db_resp_process_serial = "!jesus_is_my_dear_lord!";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();         //$oUser->return_serial_handle();
                    $db_resp_target_profiles = 'OVERLAY_MGMT|MINI_PROFILE|MINI_CONFIG|FULLSCRN_CONFIG|FULLSCRN_PROFILE|LANG_IDS|LANG_PACKS';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '19|27|17|14|17|11|26';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION :: GET ALL USERS. ALL USER-CLIENT RELATIONS. AND CLIENT DATA.
                    $tmp_SELECT_ARRAY = array();
                    $tmp_SELECT_ARRAY[0] = 'SELECT `cia00_overlay_state`.`STATE_ID`,
                    `cia00_overlay_state`.`MINI_STATE`,
                    `cia00_overlay_state`.`MINI_COPY_STATE`,
                    `cia00_overlay_state`.`MINI_TIMER_STATE`,
                    `cia00_overlay_state`.`MINI_PROFILE_ID`,
                    `cia00_overlay_state`.`MINI_PROFILE_HASH`,
                    `cia00_overlay_state`.`MINI_PROFILE_ENDPOINT`,
                    `cia00_overlay_state`.`MINI_LASTMODIFIED`,
                    `cia00_overlay_state`.`FULLSCREEN_STATE`,
                    `cia00_overlay_state`.`FULLSCREEN_COPY_STATE`,
                    `cia00_overlay_state`.`FULLSCREEN_PROFILE_ID`,
                    `cia00_overlay_state`.`FULLSCREEN_PROFILE_HASH`,
                    `cia00_overlay_state`.`FULLSCREEN_PROFILE_ENDPOINT`,
                    `cia00_overlay_state`.`FULLSCREEN_LASTMODIFIED`,
                    `cia00_overlay_state`.`MODIFIER_ID`,
                    `cia00_overlay_state`.`MODIFIER_IP`,
                    `cia00_overlay_state`.`MODIFIER_SESSION_ID`,
                    `cia00_overlay_state`.`DATEMODIFIED`,
                    `cia00_overlay_state`.`DATECREATED`
                    FROM `cia00_overlay_state` WHERE `cia00_overlay_state`.`STATE_ID`="1" LIMIT 1;
                ';

                    $tmp_SELECT_ARRAY[1] = 'SELECT `cia00_overlay_mini_profile`.`PROFILE_ID`,
                    `cia00_overlay_mini_profile`.`PROFILE_ID_CRC32`,
                    `cia00_overlay_mini_profile`.`ISACTIVE`,
                    `cia00_overlay_mini_profile`.`PROFILE_NAME`,
                    `cia00_overlay_mini_profile`.`MESSAGE_TITLE`,
                    `cia00_overlay_mini_profile`.`MESSAGE_TITLE_BLOB`,
                    `cia00_overlay_mini_profile`.`MESSAGE_NUMBER`,
                    `cia00_overlay_mini_profile`.`MESSAGE_NUMBER_BLOB`,
                    `cia00_overlay_mini_profile`.`MESSAGE_SPEAKER`,
                    `cia00_overlay_mini_profile`.`MESSAGE_SPEAKER_BLOB`,
                    `cia00_overlay_mini_profile`.`CONFERENCE_TITLE`,
                    `cia00_overlay_mini_profile`.`CONFERENCE_TITLE_BLOB`,
                    `cia00_overlay_mini_profile`.`OVERLAY_HEIGHT`,
                    `cia00_overlay_mini_profile`.`OVERLAY_WIDTH`,
                    `cia00_overlay_mini_profile`.`INNER_CONTENT_WIDTH`,
                    `cia00_overlay_mini_profile`.`MARGIN_LEFT`,
                    `cia00_overlay_mini_profile`.`MARGIN_RIGHT`,
                    `cia00_overlay_mini_profile`.`ABS_PX_FROM_TOP`,
                    `cia00_overlay_mini_profile`.`ABS_PX_FROM_LEFT`,
                    `cia00_overlay_mini_profile`.`CREATOR_ID`,
                    `cia00_overlay_mini_profile`.`CREATOR_IP`,
                    `cia00_overlay_mini_profile`.`CREATOR_SESSION_ID`,
                    `cia00_overlay_mini_profile`.`MODIFIER_ID`,
                    `cia00_overlay_mini_profile`.`MODIFIER_IP`,
                    `cia00_overlay_mini_profile`.`MODIFIER_SESSION_ID`,
                    `cia00_overlay_mini_profile`.`DATEMODIFIED`,
                    `cia00_overlay_mini_profile`.`DATECREATED`
                    FROM `cia00_overlay_mini_profile` WHERE `cia00_overlay_mini_profile`.`ISACTIVE`="1";
                ';

                    $tmp_SELECT_ARRAY[2] = 'SELECT `cia00_overlay_mini_config`.`ID`,
                    `cia00_overlay_mini_config`.`OPACITY`,
                    `cia00_overlay_mini_config`.`HEXCOLOR`,
                    `cia00_overlay_mini_config`.`COPY_HEXCOLOR`,
                    `cia00_overlay_mini_config`.`TIMER_HEXCOLOR`,
                    `cia00_overlay_mini_config`.`LANG_PACK_ROTATION_SECS`,
                    `cia00_overlay_mini_config`.`DEFAULT_ABS_PX_FROM_TOP`,
                    `cia00_overlay_mini_config`.`DEFAULT_MARGIN_LEFT`,
                    `cia00_overlay_mini_config`.`DEFAULT_ABS_PX_FROM_LEFT`,
                    `cia00_overlay_mini_config`.`DEFAULT_MARGIN_RIGHT`,
                    `cia00_overlay_mini_config`.`DEFAULT_ABS_PX_FROM_RIGHT`,
                    `cia00_overlay_mini_config`.`DEFAULT_WIDTH`,
                    `cia00_overlay_mini_config`.`DEFAULT_HEIGHT`,
                    `cia00_overlay_mini_config`.`DEFAULT_CONTENT_WIDTH`,
                    `cia00_overlay_mini_config`.`COPY_DISPLAY_AREA_WIDTH_PX`,
                    `cia00_overlay_mini_config`.`COPY_DISPLAY_AREA_HEIGHT_PX`,
                    `cia00_overlay_mini_config`.`DATECREATED`
                    FROM `cia00_overlay_mini_config` LIMIT 1;
';

                    $tmp_SELECT_ARRAY[3] = 'SELECT `cia00_overlay_fullscrn_config`.`OPACITY`,
                    `cia00_overlay_fullscrn_config`.`HEXCOLOR`,
                    `cia00_overlay_fullscrn_config`.`COPY_HEXCOLOR`,
                    `cia00_overlay_fullscrn_config`.`LANG_PACK_ROTATION_SECS`,
                    `cia00_overlay_fullscrn_config`.`DEFAULT_ABS_PX_FROM_TOP`,
                    `cia00_overlay_fullscrn_config`.`DEFAULT_MARGIN_LEFT`,
                    `cia00_overlay_fullscrn_config`.`DEFAULT_ABS_PX_FROM_LEFT`,
                    `cia00_overlay_fullscrn_config`.`DEFAULT_MARGIN_RIGHT`,
                    `cia00_overlay_fullscrn_config`.`DEFAULT_ABS_PX_FROM_RIGHT`,
                    `cia00_overlay_fullscrn_config`.`DEFAULT_WIDTH`,
                    `cia00_overlay_fullscrn_config`.`DEFAULT_HEIGHT`,
                    `cia00_overlay_fullscrn_config`.`DEFAULT_CONTENT_WIDTH`,
                    `cia00_overlay_fullscrn_config`.`DEFAULT_CONTENT_HEIGHT`,
                    `cia00_overlay_fullscrn_config`.`DATECREATED`
                    FROM `cia00_overlay_fullscrn_config` LIMIT 1;
';

                    $tmp_SELECT_ARRAY[4] = 'SELECT `cia00_overlay_fullscrn_profile`.`PROFILE_ID`,
                        `cia00_overlay_fullscrn_profile`.`PROFILE_ID_CRC32`,
                        `cia00_overlay_fullscrn_profile`.`ISACTIVE`,
                        `cia00_overlay_fullscrn_profile`.`PROFILE_NAME`,
                        `cia00_overlay_fullscrn_profile`.`PAGE_HEADER`,
                        `cia00_overlay_fullscrn_profile`.`PAGE_HEADER_BLOB`,
                        `cia00_overlay_fullscrn_profile`.`PAGE_TITLE`,
                        `cia00_overlay_fullscrn_profile`.`PAGE_TITLE_BLOB`,
                        `cia00_overlay_fullscrn_profile`.`PAGE_CODE_BLOB`,
                        `cia00_overlay_fullscrn_profile`.`CREATOR_ID`,
                        `cia00_overlay_fullscrn_profile`.`CREATOR_IP`,
                        `cia00_overlay_fullscrn_profile`.`CREATOR_SESSION_ID`,
                        `cia00_overlay_fullscrn_profile`.`MODIFIER_ID`,
                        `cia00_overlay_fullscrn_profile`.`MODIFIER_IP`,
                        `cia00_overlay_fullscrn_profile`.`MODIFIER_SESSION_ID`,
                        `cia00_overlay_fullscrn_profile`.`DATEMODIFIED`,
                        `cia00_overlay_fullscrn_profile`.`DATECREATED`
                    FROM `cia00_overlay_fullscrn_profile`  WHERE `cia00_overlay_fullscrn_profile`.`ISACTIVE`="1";

';


                    $tmp_SELECT_ARRAY[5] = 'SELECT `cia00_lang_packs`.`LANGPACK_ID`,
                        `cia00_lang_packs`.`LANG_ID`,
                        `cia00_lang_packs`.`NAME`,
                        `cia00_lang_packs`.`NATIVE_NAME`,
                        `cia00_lang_packs`.`ISACTIVE`,
                        `cia00_lang_packs`.`RTL_FLAG`,
                        `cia00_lang_packs`.`FONT_SIZE_PERCENTAGE`,
                        `cia00_lang_packs`.`TIMER_FONT_SIZE_PERCENTAGE`,
                        `cia00_lang_packs`.`COPY_PADDING_TOP_PX`,
                        `cia00_lang_packs`.`DATEMODIFIED`,
                        `cia00_lang_packs`.`DATECREATED`
                    FROM `cia00_lang_packs`  WHERE `cia00_lang_packs`.`ISACTIVE`="1";
';

                    $tmp_SELECT_ARRAY[6] = 'SELECT `cia00_lang_copy`.`COPY_ID`,
                        `cia00_lang_copy`.`PROFILE_ID`,
                        `cia00_lang_copy`.`PROFILE_TYPE`,
                        `cia00_lang_copy`.`ISACTIVE`,
                        `cia00_lang_copy`.`LANG_ID`,
                        `cia00_lang_copy`.`MESSAGE_TITLE`,
                        `cia00_lang_copy`.`MESSAGE_TITLE_BLOB`,
                        `cia00_lang_copy`.`MESSAGE_NUMBER`,
                        `cia00_lang_copy`.`MESSAGE_NUMBER_BLOB`,
                        `cia00_lang_copy`.`CONFERENCE_TITLE`,
                        `cia00_lang_copy`.`CONFERENCE_TITLE_BLOB`,
                        `cia00_lang_copy`.`PAGE_HEADER`,
                        `cia00_lang_copy`.`PAGE_HEADER_BLOB`,
                        `cia00_lang_copy`.`PAGE_TITLE`,
                        `cia00_lang_copy`.`PAGE_TITLE_BLOB`,
                        `cia00_lang_copy`.`PAGE_CODE_BLOB`,
                        `cia00_lang_copy`.`DATE_COPY`,
                        `cia00_lang_copy`.`DATE_COPY_BLOB`,
                        `cia00_lang_copy`.`CREATOR_ID`,
                        `cia00_lang_copy`.`CREATOR_IP`,
                        `cia00_lang_copy`.`CREATOR_SESSION_ID`,
                        `cia00_lang_copy`.`MODIFIER_ID`,
                        `cia00_lang_copy`.`MODIFIER_IP`,
                        `cia00_lang_copy`.`MODIFIER_SESSION_ID`,
                        `cia00_lang_copy`.`DATEMODIFIED`,
                        `cia00_lang_copy`.`DATECREATED`
                    FROM `cia00_lang_copy`  WHERE `cia00_lang_copy`.`ISACTIVE`="1";
';

                    $oDB_RESP->process(self::$mysqli,$queryType, $tmp_SELECT_ARRAY);

                    //
                    // ALL DONE, PROCESSED AND READY FOR USE. RETURN RESPONSE OBJECT.
                    return $oDB_RESP;

                break;

            }

        }catch( Exception $e ) {
            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('database_integration->executeQueryType()', LOG_EMERG, $e->getMessage());

            //
            // CLOSE CONNECTION
            $oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection(self::$mysqli);

            return self::$query_exception_result;
        }
    }

	private function dbQuery($queryType, $oUserEnvironment, $oUser){

		try{

            date_default_timezone_set('America/New_York');
            $ts = date("Y-m-d H:i:s", time());

            //
			// OPEN CONNECTION
			$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->returnConnection();

			switch($queryType){
                case 'bassdrive_stream_social_sync':

                    /*
                   bassdrive_stream_social_config
                   SOCIAL_ID                       char(64)
                   *LOG_JSON_SERIAL                 char(64)
                   *STREAM_KEY                      varchar(255)
                   STREAM_KEY_CRC32                varchar(255)
                   ISACTIVE                        tinyint(2)
                   *LOCALE_CITY_STATE_PROV_NATION   varchar(255)
                   */

                    if(isset(self::$result_ARRAY['bassdrive_stream_social_config'])){

                        //
                        // CLEAR RESULT ARRAY
                        array_splice(self::$result_ARRAY['bassdrive_stream_social_config'], 0);

                    }

                    self::$query = 'SELECT `bassdrive_stream_social_config`.`SOCIAL_ID`,
                        `bassdrive_stream_social_config`.`STREAM_KEY`,
                        `bassdrive_stream_social_config`.`LOG_JSON_SERIAL`,
                        `bassdrive_stream_social_config`.`LOCALE_CITY_STATE_PROV_NATION`,
                        `bassdrive_stream_social_config`.`LINK_SOUNDCLOUD`,
                        `bassdrive_stream_social_config`.`LINK_SOUNDCLOUD2`,
                        `bassdrive_stream_social_config`.`LINK_SOUNDCLOUD3`,
                        `bassdrive_stream_social_config`.`LINK_FACEBOOK`,
                        `bassdrive_stream_social_config`.`LINK_FACEBOOK2`,
                        `bassdrive_stream_social_config`.`LINK_FACEBOOK3`,
                        `bassdrive_stream_social_config`.`LINK_INSTAGRAM`,
                        `bassdrive_stream_social_config`.`LINK_INSTAGRAM2`,
                        `bassdrive_stream_social_config`.`LINK_INSTAGRAM3`,
                        `bassdrive_stream_social_config`.`LINK_TWITTER`,
                        `bassdrive_stream_social_config`.`LINK_TWITTER2`,
                        `bassdrive_stream_social_config`.`LINK_TWITTER3`,
                        `bassdrive_stream_social_config`.`LINK_MIXCLOUD`,
                        `bassdrive_stream_social_config`.`LINK_MIXCLOUD2`,
                        `bassdrive_stream_social_config`.`LINK_MIXCLOUD3`,
                        `bassdrive_stream_social_config`.`LINK_DISCOGS`,
                        `bassdrive_stream_social_config`.`LINK_DISCOGS2`,
                        `bassdrive_stream_social_config`.`LINK_DISCOGS3`,
                        `bassdrive_stream_social_config`.`LINK_BEATPORT`,
                        `bassdrive_stream_social_config`.`LINK_BEATPORT2`,
                        `bassdrive_stream_social_config`.`LINK_BEATPORT3`,
                        `bassdrive_stream_social_config`.`LINK_BANDCAMP`,
                        `bassdrive_stream_social_config`.`LINK_BANDCAMP2`,
                        `bassdrive_stream_social_config`.`LINK_BANDCAMP3`,
                        `bassdrive_stream_social_config`.`LINK_SPOTIFY`,
                        `bassdrive_stream_social_config`.`LINK_SPOTIFY2`,
                        `bassdrive_stream_social_config`.`LINK_SPOTIFY3`,
                        `bassdrive_stream_social_config`.`LINK_ROLLDABEATS`,
                        `bassdrive_stream_social_config`.`LINK_ROLLDABEATS2`,
                        `bassdrive_stream_social_config`.`LINK_ROLLDABEATS3`,
                        `bassdrive_stream_social_config`.`LINK_YOUTUBE`,
                        `bassdrive_stream_social_config`.`LINK_YOUTUBE2`,
                        `bassdrive_stream_social_config`.`LINK_YOUTUBE3`,
                        `bassdrive_stream_social_config`.`LINK_WWW`,
                        `bassdrive_stream_social_config`.`LINK_WWW2`,
                        `bassdrive_stream_social_config`.`LINK_WWW3`,
                        `bassdrive_stream_social_config`.`LINK_ARCHIVES`,
                        `bassdrive_stream_social_config`.`LINK_PROFILE`,
                        `bassdrive_stream_social_config`.`DATEMODIFIED`,
                        `bassdrive_stream_social_config`.`DATECREATED`
                    FROM `bassdrive_stream_social_config` 
                    WHERE `bassdrive_stream_social_config`.`STREAM_KEY` = "' . $oUser->stream_key . '"
                    AND  `bassdrive_stream_social_config`.`STREAM_KEY_CRC32` =  "' . crc32($oUser->stream_key) . '"
                    AND `bassdrive_stream_social_config`.`ISACTIVE` = 1 LIMIT 1
                    ;
                    ';

                    self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
                    if($mysqli->error){

                        throw new Exception('JONY5 database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');

                    }else{

                        //
                        // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
                        $ROWCNT=0;
                        while ($row = self::$result->fetch_row()) {

                            foreach($row as $fieldPos=>$value) {

                                //
                                // STORE RESULT
                                self::$result_ARRAY['bassdrive_stream_social_config'][$ROWCNT][$fieldPos] = $value;

                            }

                            $ROWCNT++;

                        }

                        self::$result->free();

                    }

                    if($ROWCNT < 1){

                        //
                        // INSERT NEW SOCIAL CONFIG
                        $tmp_stream_social_id = $oUser->generateNewKey(64);

                        self::$query = 'INSERT INTO `bassdrive_stream_social_config`
                        (`SOCIAL_ID`,
                        `STREAM_KEY`,
                        `STREAM_KEY_CRC32`,
                        `LOG_JSON_SERIAL`,
                        `LOCALE_CITY_STATE_PROV_NATION`,
                        `DATEMODIFIED`)
                        VALUES
                        ("' . $tmp_stream_social_id . '",
                        "' . $mysqli->real_escape_string($oUser->stream_key) . '",
                        "' . crc32($oUser->stream_key) . '",
                        "' . $mysqli->real_escape_string($oUser->stream_meta_ARRAY['STREAM_KEY'][$oUser->stream_key]['LOG_JSON_SERIAL']) . '",
                        "' . $mysqli->real_escape_string($oUser->stream_meta_ARRAY['STREAM_KEY'][$oUser->stream_key]['LOCALE_CITY_STATE_PROV_NATION']) . '",
                        "' . $ts . '");
                        ';

                        self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
                        if($mysqli->error){

                            throw new Exception('JONY5 database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');

                        }else{

                            return true;

                        }

                    }

                    return false;

                break;
                case 'bassdrive_stream_colors_sync':

                    /*
                    ########
                    bassdrive_stream_colors
                    COLORS_ID                       char(64)
                    *COLORS_NAME_KEY                 varchar(100)
                    COLORS_NAME_KEY_CRC32           int(11)
                    ISACTIVE                        tinyint(2)
                    *COLORS_IMG_FILENAME             varchar(100)
                    *COLORS_IMG_WIDTH                int(11)
                    *COLORS_IMG_HEIGHT               int(11)
                    */


                    if(isset(self::$result_ARRAY['bassdrive_stream_colors'])){

                        //
                        // CLEAR RESULT ARRAY
                        array_splice(self::$result_ARRAY['bassdrive_stream_colors'], 0);

                    }

                    self::$query = 'SELECT `bassdrive_stream_colors`.`COLORS_ID`,
                        `bassdrive_stream_colors`.`COLORS_NAME_KEY`,
                        `bassdrive_stream_colors`.`COLORS_NAME_KEY_CRC32`,
                        `bassdrive_stream_colors`.`COLORS_IMG_FILENAME`,
                        `bassdrive_stream_colors`.`COLORS_IMG_WIDTH`,
                        `bassdrive_stream_colors`.`COLORS_IMG_HEIGHT`,
                        `bassdrive_stream_colors`.`DATEMODIFIED`
                    FROM `bassdrive_stream_colors`
                    WHERE `bassdrive_stream_colors`.`COLORS_NAME_KEY` = "' . $mysqli->real_escape_string($oUser->stream_meta_ARRAY['COLORS_NAME_KEY'][$oUser->stream_key]['COLORS_NOMINATION']) . '"
                    AND `bassdrive_stream_colors`.`COLORS_NAME_KEY_CRC32` = "' . crc32($oUser->stream_meta_ARRAY['COLORS_NAME_KEY'][$oUser->stream_key]['COLORS_NOMINATION']) . '"
                    AND `bassdrive_stream_colors`.`ISACTIVE` = 1 LIMIT 1;
                    ';

                    self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
                    if($mysqli->error){

                        throw new Exception('JONY5 database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');

                    }else{

                        //
                        // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
                        $ROWCNT=0;
                        while ($row = self::$result->fetch_row()) {

                            foreach($row as $fieldPos=>$value) {

                                //
                                // STORE RESULT
                                self::$result_ARRAY['bassdrive_stream_colors'][$ROWCNT][$fieldPos] = $value;

                            }

                            $ROWCNT++;

                        }

                        self::$result->free();

                    }

                    if($ROWCNT < 1 && (strlen($oUser->stream_meta_ARRAY['COLORS_NAME_KEY'][$oUser->stream_key]['COLORS_IMG_FILENAME']) > 5)){

                        $tmp_stream_colors_id = $oUser->generateNewKey(64);

                        //
                        // INSERT NEW COLOR
                        self::$query = 'INSERT INTO `bassdrive_stream_colors`
                        (`COLORS_ID`,
                        `COLORS_NAME_KEY`,
                        `COLORS_NAME_KEY_CRC32`,
                        `COLORS_IMG_FILENAME`,
                        `COLORS_IMG_WIDTH`,
                        `COLORS_IMG_HEIGHT`,
                        `DATEMODIFIED`)
                        VALUES
                        ("' . $tmp_stream_colors_id . '",
                        "' . $mysqli->real_escape_string($oUser->stream_meta_ARRAY['COLORS_NAME_KEY'][$oUser->stream_key]['COLORS_NOMINATION']) . '",
                        "' . crc32($oUser->stream_meta_ARRAY['COLORS_NAME_KEY'][$oUser->stream_key]['COLORS_NOMINATION']) . '",
                        "' . $mysqli->real_escape_string($oUser->stream_meta_ARRAY['COLORS_NAME_KEY'][$oUser->stream_key]['COLORS_IMG_FILENAME']) . '",
                        "' . $mysqli->real_escape_string($oUser->stream_meta_ARRAY['COLORS_NAME_KEY'][$oUser->stream_key]['COLORS_IMG_WIDTH']) . '",
                        "' . $mysqli->real_escape_string($oUser->stream_meta_ARRAY['COLORS_NAME_KEY'][$oUser->stream_key]['COLORS_IMG_HEIGHT']) . '",
                        "' . $ts . '");
                        ';

                        self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
                        if($mysqli->error){

                            throw new Exception('JONY5 database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');

                        }else{

                            return true;

                        }

                    }

                    return false;

                break;
                case 'bassdrive_stream_lookup_sync':

                    /*
                     bassdrive_stream_lookup
                     STREAM_LOOKUP_ID                char(64)
                     ISACTIVE                        tinyint(2)
                     *STREAM_KEY                     varchar(255)
                     *STREAM_KEY_CRC32               int(11)
                     *STREAM_STRING_PATTERN          varchar(300)
                    */

                    if(isset(self::$result_ARRAY)){

                        //
                        // CLEAR RESULT ARRAY
                        array_splice(self::$result_ARRAY, 0);

                    }

                    $tmp_query_or = '';
                    $tmp_stream_pattern_ARRAY = array();
                    foreach($oUser->stream_pattern_ARRAY as $pattern => $key){

                        if($oUser->stream_key == $key){

                            $tmp_stream_pattern_ARRAY[$pattern] = 1;
                            $tmp_query_or .= '`bassdrive_stream_lookup`.`STREAM_STRING_PATTERN` = "' . $mysqli->real_escape_string($pattern) . '"  OR  ';

                        }

                    }

                    $tmp_query_or = rtrim($tmp_query_or,' OR ');

                    self::$query = 'SELECT `bassdrive_stream_lookup`.`STREAM_LOOKUP_ID`,
                        `bassdrive_stream_lookup`.`STREAM_STRING_PATTERN`,
                        `bassdrive_stream_lookup`.`STREAM_KEY`
                    FROM `bassdrive_stream_lookup`
                    WHERE `bassdrive_stream_lookup`.`ISACTIVE` = 1
                    AND `bassdrive_stream_lookup`.`STREAM_KEY` = "' . $oUser->stream_key . '"
                    AND `bassdrive_stream_lookup`.`STREAM_KEY_CRC32` = "' . crc32($oUser->stream_key) . '"
                    AND (' . $tmp_query_or . ');
                    ';

                    self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
                    if($mysqli->error){

                        throw new Exception('JONY5 database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');

                    }else{

                        //
                        // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
                        $ROWCNT=0;
                        while ($row = self::$result->fetch_row()) {

                            foreach($row as $fieldPos=>$value) {

                                //
                                // STORE RESULT
                                self::$result_ARRAY['bassdrive_stream_lookup'][$ROWCNT][$fieldPos] = $value;

                            }

                            $ROWCNT++;

                        }

                        self::$result->free();

                    }


                    self::$query = '';

                    if(isset(self::$result_ARRAY['bassdrive_stream_lookup'])){

                        foreach(self::$result_ARRAY['bassdrive_stream_lookup'] as $row => $field_ARRAY){

                            $tmp_pattern_match = false;

                            foreach($tmp_stream_pattern_ARRAY as $pattern => $val){

                                if($field_ARRAY[1] == $pattern){

                                    $tmp_pattern_match = true;
                                    error_log(__LINE__ . ' database match on $pattern['. $pattern .'!='.$field_ARRAY[1].']');

                                }else{

                                    error_log(__LINE__ . ' database NO match on $pattern['. $pattern .'!='.$field_ARRAY[1].']');

                                }

                            }

                            if(!$tmp_pattern_match){

                                $tmp_stream_lookup_id = $oUser->generateNewKey(64);

                                //
                                // ADD STRING PATTERN TO LOOKUP TABLE
                                self::$query .=  'INSERT INTO `bassdrive_stream_lookup`
                                (`STREAM_LOOKUP_ID`,
                                `STREAM_KEY`,
                                `STREAM_KEY_CRC32`,
                                `STREAM_STRING_PATTERN`,
                                `DATEMODIFIED`)
                                VALUES
                                ("' . $mysqli->real_escape_string($tmp_stream_lookup_id) . '",
                                "' . $mysqli->real_escape_string($oUser->stream_key) . '",
                                "' . crc32($oUser->stream_key) . '",
                                "' . $mysqli->real_escape_string($pattern) . '",
                                "' . $ts . '");
                                ';

                            }

                        }

                    }else{

                        foreach($oUser->stream_pattern_ARRAY as $pattern => $key){

                            if($oUser->stream_key == $key){

                                $tmp_stream_pattern_ARRAY[$pattern] = 1;
                                $tmp_query_or .= '`bassdrive_stream_lookup`.`STREAM_STRING_PATTERN` = "' . $mysqli->real_escape_string($pattern) . '"  OR  ';

                                $tmp_stream_lookup_id = $oUser->generateNewKey(64);

                                //
                                // ADD STRING PATTERN TO LOOKUP TABLE
                                self::$query .=  'INSERT INTO `bassdrive_stream_lookup`
                                (`STREAM_LOOKUP_ID`,
                                `STREAM_KEY`,
                                `STREAM_KEY_CRC32`,
                                `STREAM_STRING_PATTERN`,
                                `DATEMODIFIED`)
                                VALUES
                                ("' . $mysqli->real_escape_string($tmp_stream_lookup_id) . '",
                                "' . $mysqli->real_escape_string($oUser->stream_key) . '",
                                "' . crc32($oUser->stream_key) . '",
                                "' . $mysqli->real_escape_string($pattern) . '",
                                "' . $ts . '");
                                ';

                            }

                        }

                    }

                    if(strlen(self::$query)>10){

                        //
                        // PROCESS NEW PATTERN(S)
                        $mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query);
                        if($mysqli->error){

                            throw new Exception('JONY5 database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');

                        }else{

                            return true;

                        }

                    }else{

                        return false;

                    }

                break;
                case 'bassdrive_stream_initialization':

                    /*
                    ########
                    oUser = oBassDriveDatum
                    bassdrive_stream
                    STREAM_ID                       char(64)
                    ISACTIVE                        tinyint(2)
                    *STREAM_KEY                      varchar(255)
                    *COLORS_NAME_KEY                 varchar(100)

                     if(isset($tmp_meta_array['stream_flag_file_img'])){

                            $tmp_resp['COLORS_NAME_KEY'][$tmp_stream_key]['COLORS_IMG_FILENAME'] = $tmp_meta_array['stream_flag_file_img'];
                            $tmp_resp['COLORS_NAME_KEY'][$tmp_stream_key]['COLORS_IMG_WIDTH'] = $tmp_meta_array['stream_flag_img_width'];
                            $tmp_resp['COLORS_NAME_KEY'][$tmp_stream_key]['COLORS_IMG_HEIGHT'] = $tmp_meta_array['stream_flag_img_height'];
                            $tmp_resp['STREAM_KEY'][$tmp_stream_key]['LOCALE_CITY_STATE_PROV_NATION'] = $tmp_meta_array['stream_city_state_prov_nation'];

                        }

                        $tmp_resp['STREAM_KEY'][$tmp_stream_key]['LOG_JSON_SERIAL'] = $json_serial;
                    */

                    if(isset(self::$result_ARRAY['bassdrive_stream'])){

                        //
                        // CLEAR RESULT ARRAY
                        array_splice(self::$result_ARRAY['bassdrive_stream'], 0);

                    }

                    self::$query = 'SELECT `bassdrive_stream`.`STREAM_ID`,
                        `bassdrive_stream`.`STREAM_KEY`,
                        `bassdrive_stream`.`COLORS_NAME_KEY`
                    FROM `bassdrive_stream` 
                    WHERE `bassdrive_stream`.`STREAM_KEY` = "' . $mysqli->real_escape_string($oUser->stream_key) . '"
                    AND `bassdrive_stream`.`STREAM_KEY_CRC32` = "' . crc32($oUser->stream_key) . '" LIMIT 1;
                    ';

                    self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
                    if($mysqli->error){

                        throw new Exception('JONY5 database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');

                    }else{

                        //
                        // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
                        $ROWCNT=0;
                        while ($row = self::$result->fetch_row()) {

                            foreach($row as $fieldPos=>$value) {

                                //
                                // STORE RESULT
                                self::$result_ARRAY['bassdrive_stream'][$ROWCNT][$fieldPos] = $value;

                            }

                            $ROWCNT++;

                        }

                        self::$result->free();

                    }

                    if(!isset(self::$result_ARRAY['bassdrive_stream'])){

                        $tmp_stream_id = $oUser->generateNewKey(64);

                        //
                        // INSERT NEW STREAM KEY
                        self::$query = 'INSERT INTO `bassdrive_stream`
                        (`STREAM_ID`,
                        `STREAM_KEY`,
                        `STREAM_KEY_CRC32`,
                        `COLORS_NAME_KEY`,
                        `DATEMODIFIED`)
                        VALUES
                        ("' . $mysqli->real_escape_string($tmp_stream_id) . '",
                        "' . $mysqli->real_escape_string($oUser->stream_key) . '",
                        "' . crc32($oUser->stream_key) . '",
                        "' . $mysqli->real_escape_string($oUser->stream_meta_ARRAY['COLORS_NAME_KEY'][$oUser->stream_key]['COLORS_NOMINATION']) . '",
                        "' . $ts . '");
                        ';

                        self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
                        if($mysqli->error){

                            throw new Exception('JONY5 database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');

                        }else{

                            return true;

                        }

                    }else{

                        //error_log(__LINE__ . ' Bassdrive_stream result is found.');
                        return false;

                    }

                break;
                case 'return_stream_social_association_ARRAY':

                    $tmp_social_resp = array();

                    /*
                    ########
                    bassdrive_stream
                    STREAM_ID                       char(64)
                    ISACTIVE                        tinyint(2)
                    STREAM_KEY                      varchar(255)
                    COLORS_NAME_KEY                 varchar(100)
                    DATEMODIFIED
                    DATECREATED

                    bassdrive_stream_lookup
                    STREAM_LOOKUP_ID                char(64)
                    ISACTIVE                        tinyint(2)
                    STREAM_STRING_PATTERN           varchar(300)
                    STREAM_KEY                      varchar(255)
                    DATEMODIFIED
                    DATECREATED

                    ########
                    bassdrive_stream_colors
                    COLORS_ID                       char(64)
                    COLORS_NAME_KEY                 varchar(100)
                    COLORS_NAME_KEY_CRC32           int(11)
                    ISACTIVE                        tinyint(2)
                    COLORS_IMG_FILENAME             varchar(100)
                    COLORS_IMG_WIDTH                int(11)
                    COLORS_IMG_HEIGHT               int(11)
                    DATEMODIFIED
                    DATECREATED

                    ########
                    bassdrive_stream_social_config
                    SOCIAL_ID                       char(64)
                    LOG_JSON_SERIAL                 char(64)
                    STREAM_KEY                      varchar(255)
                    STREAM_KEY_CRC32                varchar(255)
                    ISACTIVE                        tinyint(2)
                    LOCALE_CITY_STATE_PROV_NATION   varchar(255)
                    LINK_SOUNDCLOUD                 varchar(300)
                    LINK_FACEBOOK                   varchar(300)
                    LINK_INSTAGRAM                  varchar(300)
                    LINK_TWITTER                    varchar(300)
                    LINK_WWW                        varchar(300)
                    DATEMODIFIED
                    DATECREATED


                    bassdrive_social_link stream_soundcloud
                    bassdrive_social_link stream_facebook
                    bassdrive_social_link stream_instagram
                    bassdrive_social_link stream_twitter
                    bassdrive_social_link stream_www
                    bassdrive_social_link stream_json

                    */

                    $tmp_social_resp['stream_log_json_serial'] = '';
                    $tmp_social_resp['stream_locale'] = '';

                    $tmp_social_resp['stream_soundcloud'] = '';
                    $tmp_social_resp['stream_soundcloud2'] = '';
                    $tmp_social_resp['stream_soundcloud3'] = '';
                    $tmp_social_resp['stream_facebook'] = '';
                    $tmp_social_resp['stream_facebook2'] = '';
                    $tmp_social_resp['stream_facebook3'] = '';
                    $tmp_social_resp['stream_instagram'] = '';
                    $tmp_social_resp['stream_instagram2'] = '';
                    $tmp_social_resp['stream_instagram3'] = '';
                    $tmp_social_resp['stream_twitter'] = '';
                    $tmp_social_resp['stream_twitter2'] = '';
                    $tmp_social_resp['stream_twitter3'] = '';
                    $tmp_social_resp['stream_mixcloud'] = '';
                    $tmp_social_resp['stream_mixcloud2'] = '';
                    $tmp_social_resp['stream_mixcloud3'] = '';
                    $tmp_social_resp['stream_discogs'] = '';
                    $tmp_social_resp['stream_discogs2'] = '';
                    $tmp_social_resp['stream_discogs3'] = '';
                    $tmp_social_resp['stream_beatport'] = '';
                    $tmp_social_resp['stream_beatport2'] = '';
                    $tmp_social_resp['stream_beatport3'] = '';
                    $tmp_social_resp['stream_bandcamp'] = '';
                    $tmp_social_resp['stream_bandcamp2'] = '';
                    $tmp_social_resp['stream_bandcamp3'] = '';
                    $tmp_social_resp['stream_spotify'] = '';
                    $tmp_social_resp['stream_spotify2'] = '';
                    $tmp_social_resp['stream_spotify3'] = '';
                    $tmp_social_resp['stream_rolldabeats'] = '';
                    $tmp_social_resp['stream_rolldabeats2'] = '';
                    $tmp_social_resp['stream_rolldabeats3'] = '';
                    $tmp_social_resp['stream_youtube'] = '';
                    $tmp_social_resp['stream_youtube2'] = '';
                    $tmp_social_resp['stream_youtube3'] = '';
                    $tmp_social_resp['stream_www'] = '';
                    $tmp_social_resp['stream_www2'] = '';
                    $tmp_social_resp['stream_www3'] = '';
                    $tmp_social_resp['stream_archives'] = '';
                    $tmp_social_resp['stream_profile'] = '';

                    $tmp_social_resp['stream_json'] = $oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . '_proxy/bassdrive/';
                    $tmp_social_resp['stream_history'] = $oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . '_proxy/bassdrive/?action=load_history';
                    $tmp_social_resp['stream_paypal'] = 'https://www.paypal.com/donate?hosted_button_id=GWNVTUTPEAA8C';
                    $tmp_social_resp['stream_log_json'] = '';

                    $tmp_social_resp['stream_colors_name'] = '';
                    $tmp_social_resp['stream_colors_filename'] = '';
                    $tmp_social_resp['stream_colors_width'] = '';
                    $tmp_social_resp['stream_colors_height'] = '';

                    if(isset(self::$result_ARRAY['bassdrive_stream_lookup'])){

                        //
                        // CLEAR RESULT ARRAY
                        array_splice(self::$result_ARRAY['bassdrive_stream_lookup'], 0);

                    }

                    self::$query = 'SELECT `bassdrive_stream_lookup`.`STREAM_LOOKUP_ID`,
                        `bassdrive_stream_lookup`.`STREAM_KEY`,
                        `bassdrive_stream_lookup`.`STREAM_STRING_PATTERN`
                    FROM `bassdrive_stream_lookup` 
                    WHERE `bassdrive_stream_lookup`.`ISACTIVE` = 1 ORDER BY `bassdrive_stream_lookup`.`STREAM_KEY` DESC;
                    ';

                    self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
                    if($mysqli->error){

                        throw new Exception('JONY5 database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');

                    }else{

                        //
                        // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
                        $ROWCNT=0;
                        while ($row = self::$result->fetch_row()) {

                            foreach($row as $fieldPos=>$value) {

                                //
                                // STORE RESULT
                                self::$result_ARRAY['bassdrive_stream_lookup'][$ROWCNT][$fieldPos]=$value;

                            }

                            $ROWCNT++;

                        }

                        self::$result->free();

                    }

                    $has_flag = false;
                    foreach(self::$result_ARRAY['bassdrive_stream_lookup'] as $row => $fieldARRAY) {

                        //error_log(__LINE__ . ' database SOCIAL LOOKUP ['.$fieldARRAY[2].']['.$oUser->stream_title.']');

                        $pos = stripos($oUser->stream_title, $fieldARRAY[2]);
                        if ($pos !== false && $has_flag == false) {

                            $has_flag = true;

                            $oUser->stream_key = $fieldARRAY[1];

                            self::$query = 'SELECT `bassdrive_stream_social_config`.`SOCIAL_ID`,
                                `bassdrive_stream_social_config`.`STREAM_KEY`,
                                `bassdrive_stream_social_config`.`LOG_JSON_SERIAL`,
                                `bassdrive_stream_social_config`.`LOCALE_CITY_STATE_PROV_NATION`,
                                `bassdrive_stream_social_config`.`LINK_SOUNDCLOUD`,
                                `bassdrive_stream_social_config`.`LINK_SOUNDCLOUD2`,
                                `bassdrive_stream_social_config`.`LINK_SOUNDCLOUD3`,
                                `bassdrive_stream_social_config`.`LINK_FACEBOOK`,
                                `bassdrive_stream_social_config`.`LINK_FACEBOOK2`,
                                `bassdrive_stream_social_config`.`LINK_FACEBOOK3`,
                                `bassdrive_stream_social_config`.`LINK_INSTAGRAM`,
                                `bassdrive_stream_social_config`.`LINK_INSTAGRAM2`,
                                `bassdrive_stream_social_config`.`LINK_INSTAGRAM3`,
                                `bassdrive_stream_social_config`.`LINK_TWITTER`,
                                `bassdrive_stream_social_config`.`LINK_TWITTER2`,
                                `bassdrive_stream_social_config`.`LINK_TWITTER3`,
                                `bassdrive_stream_social_config`.`LINK_MIXCLOUD`,
                                `bassdrive_stream_social_config`.`LINK_MIXCLOUD2`,
                                `bassdrive_stream_social_config`.`LINK_MIXCLOUD3`,
                                `bassdrive_stream_social_config`.`LINK_DISCOGS`,
                                `bassdrive_stream_social_config`.`LINK_DISCOGS2`,
                                `bassdrive_stream_social_config`.`LINK_DISCOGS3`,
                                `bassdrive_stream_social_config`.`LINK_BEATPORT`,
                                `bassdrive_stream_social_config`.`LINK_BEATPORT2`,
                                `bassdrive_stream_social_config`.`LINK_BEATPORT3`,
                                `bassdrive_stream_social_config`.`LINK_BANDCAMP`,
                                `bassdrive_stream_social_config`.`LINK_BANDCAMP2`,
                                `bassdrive_stream_social_config`.`LINK_BANDCAMP3`,
                                `bassdrive_stream_social_config`.`LINK_SPOTIFY`,
                                `bassdrive_stream_social_config`.`LINK_SPOTIFY2`,
                                `bassdrive_stream_social_config`.`LINK_SPOTIFY3`,
                                `bassdrive_stream_social_config`.`LINK_ROLLDABEATS`,
                                `bassdrive_stream_social_config`.`LINK_ROLLDABEATS2`,
                                `bassdrive_stream_social_config`.`LINK_ROLLDABEATS3`,
                                `bassdrive_stream_social_config`.`LINK_YOUTUBE`,
                                `bassdrive_stream_social_config`.`LINK_YOUTUBE2`,
                                `bassdrive_stream_social_config`.`LINK_YOUTUBE3`,
                                `bassdrive_stream_social_config`.`LINK_WWW`,
                                `bassdrive_stream_social_config`.`LINK_WWW2`,
                                `bassdrive_stream_social_config`.`LINK_WWW3`,
                                `bassdrive_stream_social_config`.`LINK_ARCHIVES`,
                                `bassdrive_stream_social_config`.`LINK_PROFILE`
                            FROM `bassdrive_stream_social_config`
                            WHERE `bassdrive_stream_social_config`.`STREAM_KEY` = "' . $mysqli->real_escape_string($oUser->stream_key) . '"
                            AND `bassdrive_stream_social_config`.`STREAM_KEY_CRC32` = "' . crc32($oUser->stream_key) . '"
                            AND `bassdrive_stream_social_config`.`ISACTIVE` = 1 LIMIT 1;
                            ';

                            //error_log(__LINE__ . ' database [stream_key='.$oUser->stream_key.'][stream_title='.$oUser->stream_title.']['.self::$query.']');

                            self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
                            if($mysqli->error){

                                throw new Exception('JONY5 database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');

                            }else{

                                //
                                // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
                                $ROWCNT=0;
                                while ($row = self::$result->fetch_row()) {

                                    foreach($row as $fieldPos=>$value) {

                                        //
                                        // STORE RESULT
                                        self::$result_ARRAY['bassdrive_stream_social_config'][$ROWCNT][$fieldPos]=$value;

                                    }

                                    $ROWCNT++;

                                }

                                self::$result->free();

                            }

                            self::$query = 'SELECT `bassdrive_stream`.`STREAM_ID`,
                                `bassdrive_stream`.`STREAM_KEY`,
                                `bassdrive_stream`.`COLORS_NAME_KEY`
                            FROM `bassdrive_stream`
                            WHERE `bassdrive_stream`.`STREAM_KEY` = "' . $mysqli->real_escape_string($oUser->stream_key) . '"
                            AND `bassdrive_stream`.`STREAM_KEY_CRC32` = "' . crc32($oUser->stream_key) . '"
                            AND `bassdrive_stream`.`ISACTIVE` = 1 LIMIT 1; ';

                            self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
                            if($mysqli->error){

                                throw new Exception('JONY5 database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');

                            }else{

                                //
                                // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
                                $ROWCNT=0;
                                while ($row = self::$result->fetch_row()) {

                                    foreach($row as $fieldPos=>$value) {

                                        //
                                        // STORE RESULT
                                        self::$result_ARRAY['bassdrive_stream'][$ROWCNT][$fieldPos]=$value;

                                    }

                                    $ROWCNT++;

                                }

                                self::$result->free();

                            }

                            self::$query = 'SELECT `bassdrive_stream_colors`.`COLORS_ID`,
                                `bassdrive_stream_colors`.`COLORS_NAME_KEY`,
                                `bassdrive_stream_colors`.`COLORS_IMG_FILENAME`,
                                `bassdrive_stream_colors`.`COLORS_IMG_WIDTH`,
                                `bassdrive_stream_colors`.`COLORS_IMG_HEIGHT`
                            FROM `bassdrive_stream_colors`;
                            ';

                            self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
                            if($mysqli->error){

                                throw new Exception('JONY5 database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');

                            }else{

                                //
                                // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
                                $ROWCNT=0;
                                while ($row = self::$result->fetch_row()) {

                                    foreach($row as $fieldPos=>$value) {

                                        //
                                        // STORE RESULT
                                        self::$result_ARRAY['bassdrive_stream_colors'][$ROWCNT][$fieldPos]=$value;

                                    }

                                    $ROWCNT++;

                                }

                                self::$result->free();

                            }

                            if(isset(self::$result_ARRAY['bassdrive_stream_social_config'])){

                                $tmp_social_resp['stream_log_json_serial'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][2];
                                $tmp_social_resp['stream_locale'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][3];

                                $tmp_social_resp['stream_soundcloud'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][4];
                                $tmp_social_resp['stream_soundcloud2'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][5];
                                $tmp_social_resp['stream_soundcloud3'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][6];
                                $tmp_social_resp['stream_facebook'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][7];
                                $tmp_social_resp['stream_facebook2'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][8];
                                $tmp_social_resp['stream_facebook3'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][9];
                                $tmp_social_resp['stream_instagram'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][10];
                                $tmp_social_resp['stream_instagram2'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][11];
                                $tmp_social_resp['stream_instagram3'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][12];
                                $tmp_social_resp['stream_twitter'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][13];
                                $tmp_social_resp['stream_twitter2'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][14];
                                $tmp_social_resp['stream_twitter3'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][15];
                                $tmp_social_resp['stream_mixcloud'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][16];
                                $tmp_social_resp['stream_mixcloud2'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][17];
                                $tmp_social_resp['stream_mixcloud3'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][18];
                                $tmp_social_resp['stream_discogs'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][19];
                                $tmp_social_resp['stream_discogs2'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][20];
                                $tmp_social_resp['stream_discogs3'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][21];
                                $tmp_social_resp['stream_beatport'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][22];
                                $tmp_social_resp['stream_beatport2'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][23];
                                $tmp_social_resp['stream_beatport3'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][24];
                                $tmp_social_resp['stream_bandcamp'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][25];
                                $tmp_social_resp['stream_bandcamp2'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][26];
                                $tmp_social_resp['stream_bandcamp3'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][27];
                                $tmp_social_resp['stream_spotify'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][28];
                                $tmp_social_resp['stream_spotify2'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][29];
                                $tmp_social_resp['stream_spotify3'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][30];
                                $tmp_social_resp['stream_rolldabeats'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][31];
                                $tmp_social_resp['stream_rolldabeats2'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][32];
                                $tmp_social_resp['stream_rolldabeats3'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][33];
                                $tmp_social_resp['stream_youtube'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][34];
                                $tmp_social_resp['stream_youtube2'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][35];
                                $tmp_social_resp['stream_youtube3'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][36];
                                $tmp_social_resp['stream_www'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][37];
                                $tmp_social_resp['stream_www2'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][38];
                                $tmp_social_resp['stream_www3'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][39];
                                $tmp_social_resp['stream_archives'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][40];
                                $tmp_social_resp['stream_profile'] = self::$result_ARRAY['bassdrive_stream_social_config'][0][41];

                                $tmp_social_resp['stream_log_json'] = $oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . '_proxy/bassdrive_colors/?stream='.$tmp_social_resp['stream_log_json_serial'];
                                $tmp_social_resp['stream_history'] = $oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . '_proxy/bassdrive/?action=load_history';

                            }

                            if(isset(self::$result_ARRAY['bassdrive_stream'])){

                                $tmp_social_resp['stream_colors_name'] = self::$result_ARRAY['bassdrive_stream'][0][2];

                            }

                            if(isset(self::$result_ARRAY['bassdrive_stream_colors'])){

                                foreach(self::$result_ARRAY['bassdrive_stream_colors'] as $row => $field_array){

                                    if($field_array[1] == $tmp_social_resp['stream_colors_name']){

                                        $tmp_social_resp['stream_colors_filename'] = $field_array[2];
                                        $tmp_social_resp['stream_colors_width'] = $field_array[3];
                                        $tmp_social_resp['stream_colors_height'] = $field_array[4];

                                        $tmp_social_resp['stream_colors_html'] = '<div id="nation_colors_wrapper" class="nation_colors_wrapper"><div style="padding-right:8px;"><img src="' . $oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/bassdrive_component_creative/' . $tmp_social_resp['stream_colors_filename'] . '" width="' . $tmp_social_resp['stream_colors_width'] . '" height="' . $tmp_social_resp['stream_colors_height'] . '" title="' . $tmp_social_resp['stream_colors_name'] . '" alt="' . $tmp_social_resp['stream_colors_name'] . '"></div></div>';

                                        //error_log(__LINE__ . ' database COLORS='. $field_array[2]);

                                    }

                                }

                            }

                            return $tmp_social_resp;

                        }


                    }
                    
                    return $tmp_social_resp;

                break;
                case 'return_bassdrive_log_ojson':

                    $auth_creds = $oUserEnvironment->oHTTP_MGR->extractData($_GET, 'stream');

                    self::$query = 'SELECT 
                        `log_bassdrive_program`.`STREAM_RELAY_JSON`
                    FROM `log_bassdrive_program` 
                    WHERE `log_bassdrive_program`.`SERIAL` = "' . $mysqli->real_escape_string($auth_creds) . '" LIMIT 1;
                    ';

                    self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
                    if($mysqli->error){

                        throw new Exception('JONY5 database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');

                    }else{

                        //
                        // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
                        $ROWCNT=0;
                        while ($row = self::$result->fetch_row()) {

                            foreach($row as $fieldPos=>$value) {

                                //
                                // STORE RESULT
                                self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;

                            }

                            $ROWCNT++;

                        }

                        self::$result->free();

                    }

                    return self::$result_ARRAY[0][0];

                break;
                case 'bassdrive_history_output':

                    $tmp_resp_array = array();
                    self::$query = 'SELECT `bassdrive_stream_history`.`RAW_HTML`,
                        `bassdrive_stream_history`.`DATEMODIFIED`
                    FROM `bassdrive_stream_history` 
                    WHERE `bassdrive_stream_history`.`ISACTIVE` = 1 LIMIT 1;
                    ';

                    self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
                    if($mysqli->error){

                        throw new Exception('JONY5 database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');

                    }else{

                        //
                        // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
                        $ROWCNT=0;
                        while ($row = self::$result->fetch_row()) {

                            foreach($row as $fieldPos=>$value) {

                                //
                                // STORE RESULT
                                self::$result_ARRAY['bassdrive_history_output'][$ROWCNT][$fieldPos]=$value;

                            }

                            $ROWCNT++;

                        }

                        self::$result->free();

                    }

                    return self::$result_ARRAY['bassdrive_history_output'][0][0];

                break;
                case 'bassdrive_colors_algorithm_output':

                    if($oUserEnvironment->oHTTP_MGR->issetParam($_GET, 'cnt')){

                        $cnt = $oUserEnvironment->oHTTP_MGR->extractData($_GET, 'cnt');

                        if(!is_numeric($cnt)){

                            $cnt = 4500;

                        }else{

                            if($cnt < 3500){

                                $cnt = 3500;

                            }

                        }

                    }else{

                        $cnt = 16000;

                    }

                    $tmp_resp_array = array();
                    self::$query = 'SELECT `log_bassdrive_program`.`ID`,
                        `log_bassdrive_program`.`SERIAL`,
                        `log_bassdrive_program`.`PROGRAM_TITLE`,
                        `log_bassdrive_program`.`STREAM_RELAY_JSON`,
                        `log_bassdrive_program`.`DATEMODIFIED`
                    FROM `log_bassdrive_program` 
                    WHERE `log_bassdrive_program`.`ISACTIVE` = 1
                    ORDER BY `log_bassdrive_program`.`ID` DESC LIMIT ' . $mysqli->real_escape_string($cnt) .   ';
                    ';

                    self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
                    if($mysqli->error){

                        throw new Exception('JONY5 database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');

                    }else{

                        //
                        // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
                        $ROWCNT=0;
                        while ($row = self::$result->fetch_row()) {

                            foreach($row as $fieldPos=>$value) {

                                //
                                // STORE RESULT
                                self::$result_ARRAY['log_bassdrive_program'][$ROWCNT][$fieldPos]=$value;

                            }

                            $ROWCNT++;

                        }

                        self::$result->free();

                    }

                    $tmp_resp_array = self::$result_ARRAY['log_bassdrive_program'];

                    $tmp_env_key = $oUserEnvironment->returnResouceKey();
                    //if($tmp_env_key == crc32('LOCALHOST_MAC')){
                    if(1 == 2){

                        $tmp_field_POS_ARRAY = array();

                        $tmp_field_POS_ARRAY['log_bassdrive_program']['ID'] = 0;
                        $tmp_field_POS_ARRAY['log_bassdrive_program']['SERIAL'] = 1;
                        $tmp_field_POS_ARRAY['log_bassdrive_program']['PROGRAM_TITLE'] = 2;
                        $tmp_field_POS_ARRAY['log_bassdrive_program']['STREAM_RELAY_JSON'] = 3;
                        $tmp_field_POS_ARRAY['log_bassdrive_program']['DATEMODIFIED'] = 4;

                        //
                        // LOCALHOST PROCESSING ONLY
                        foreach(self::$result_ARRAY['log_bassdrive_program'] as $row => $stream_log_ARRAY){

                            //error_log(__LINE__ . ' LOCALHOST PROCESSING ONLY :: '.$stream_log_ARRAY[$tmp_field_POS_ARRAY['log_bassdrive_program']['PROGRAM_TITLE']]);

                            $tmp_stream_title = $stream_log_ARRAY[$tmp_field_POS_ARRAY['log_bassdrive_program']['PROGRAM_TITLE']];
                            $tmp_log_json_serial = $stream_log_ARRAY[$tmp_field_POS_ARRAY['log_bassdrive_program']['SERIAL']];
                            //$tmp_stream_json = $stream_log_ARRAY[$tmp_field_POS_ARRAY['log_bassdrive_program']['STREAM_RELAY_JSON']];

                            $tmp_KEY = $oUser->process_stream_title($tmp_stream_title, $tmp_log_json_serial);

                            //return self::$result_ARRAY['log_bassdrive_program'];

                        }

                    }

                    //return self::$result_ARRAY['log_bassdrive_program'];
                    return $tmp_resp_array;

                break;
                case 'return_bassdrive_colors_presentation':

                    $oBassDriveDatum = new bassdrive_integration_data($oUser, $oUserEnvironment, $this);

                    self::$query = 'SELECT `log_bassdrive_program`.`ID`,
                        `log_bassdrive_program`.`PROGRAM_TITLE`,
                        `log_bassdrive_program`.`STREAM_RELAY_JSON`,
                        `log_bassdrive_program`.`DATEMODIFIED`,
                        `log_bassdrive_program`.`DATECREATED`
                    FROM `log_bassdrive_program` ORDER BY `log_bassdrive_program`.`ID` DESC LIMIT 4500;
                    ';

                    self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
                    if($mysqli->error){

                        throw new Exception('JONY5 database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');

                    }else{

                        //
                        // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
                        $ROWCNT=0;
                        while ($row = self::$result->fetch_row()) {

                            foreach($row as $fieldPos=>$value) {

                                //
                                // STORE RESULT
                                self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;

                            }

                            $ROWCNT++;

                        }

                        self::$result->free();

                    }

                    //
                    // VALIDATE TTL AND LOAD BASSDRIVE DATUM OBJECT
                    if(count(self::$result_ARRAY) > 0){

                        //
                        // CHECK CURRENT TIME AGAINST TTL FOR INDICATION OF DATA USE CASE TO IMPLEMENT
                        // self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
                        $ttl_secs = self::$result_ARRAY[0][1];
                        $bassdrive_json = self::$result_ARRAY[0][2];

                        $relay_endpoint = self::$result_ARRAY[0][0];
                        $broadcast_nation = self::$result_ARRAY[0][3];
                        $stream_info = self::$result_ARRAY[0][4];
                        $stream_social = '';
                        $bassdrive_stats_conn = self::$result_ARRAY[0][5];
                        $bassdrive_stats_throughput = self::$result_ARRAY[0][6];
                        $bassdrive_stats_throughput_unit = self::$result_ARRAY[0][7];
                        $bassdrive_stats_max_conn = self::$result_ARRAY[0][8];

                        $ttl_last_modified = self::$result_ARRAY[0][12];

                        $tmp_curr_date = strtotime('-' . $ttl_secs .' seconds');
                        $tmp_ttl_date = strtotime($ttl_last_modified);

                        if($tmp_curr_date > $tmp_ttl_date){

                            //
                            // TTL EXPIRE CONTENT
                            $oBassDriveDatum->refresh_expired_data($relay_endpoint, $broadcast_nation, $stream_info, $stream_social, $bassdrive_stats_conn, $bassdrive_stats_throughput, $bassdrive_stats_throughput_unit, $bassdrive_stats_max_conn);
                            $oBassDriveDatum->reset_cache_ttl();

                            //
                            // RETURN LATEST JSON OBJECT
                            return $oBassDriveDatum->bassdrive_stream_ojson;

                        }else{

                            error_log(__LINE__ . ' database :: RETURN bassdrive JSON from CACHE.');
                            //$oBassDriveDatum->load_data($broadcast_nation, $stream_info, $bassdrive_stats_conn, $bassdrive_stats_throughput, $bassdrive_stats_throughput_unit, $bassdrive_stats_max_conn);

                            //
                            // RETURN CACHE JSON OBJECT
                            return $bassdrive_json;

                        }

                    }

                break;
                case 'return_bassdrive_ojson':

                    $oBassDriveDatum = new bassdrive_integration_data($oUser, $oUserEnvironment, $this);

                    self::$query = 'SELECT `bassdrive_ttl_config`.`BASSDRIVE_ENDPOINT`,
                        `bassdrive_ttl_config`.`ENDPOINT_CACHE_TTL_SECS`,
                        `bassdrive_ttl_config`.`CURRENT_RELAY_JSON`,
                        `bassdrive_ttl_config`.`CURRENT_BROADCAST_NATION`,
                        `bassdrive_ttl_config`.`CURRENT_STREAM_INFO`,
                        `bassdrive_ttl_config`.`CURRENT_STREAM_SOCIAL`,
                        `bassdrive_ttl_config`.`CURRENT_STATS_CONNECTIONS`,
                        `bassdrive_ttl_config`.`CURRENT_STATS_THROUGHPUT`,
                        `bassdrive_ttl_config`.`CURRENT_STATS_THROUGHPUT_UNIT`,
                        `bassdrive_ttl_config`.`CURRENT_STATS_MAX_CONNECTIONS`,
                        `bassdrive_ttl_config`.`MODIFIED_SERVERADDR`,
                        `bassdrive_ttl_config`.`MODIFIED_BY_IP`,
                        `bassdrive_ttl_config`.`MODIFIED_BY_USERAGENT`,
                        `bassdrive_ttl_config`.`DATEMODIFIED`,
                        `bassdrive_ttl_config`.`DATECREATED`
                    FROM `bassdrive_ttl_config` LIMIT 1;
                    ';

                    self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
                    if($mysqli->error){

                        throw new Exception('JONY5 database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');

                    }else{

                        //
                        // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
                        $ROWCNT=0;
                        while ($row = self::$result->fetch_row()) {

                            foreach($row as $fieldPos=>$value) {

                                //
                                // STORE RESULT
                                self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;

                            }

                            $ROWCNT++;

                        }

                        self::$result->free();

                    }

                    //
                    // VALIDATE TTL AND LOAD BASSDRIVE DATUM OBJECT
                    if(count(self::$result_ARRAY) > 0){

                        //
                        // CHECK CURRENT TIME AGAINST TTL FOR INDICATION OF DATA USE CASE TO IMPLEMENT
                        // self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
                        $ttl_secs = self::$result_ARRAY[0][1];
                        $bassdrive_json = self::$result_ARRAY[0][2];

                        $relay_endpoint = self::$result_ARRAY[0][0];
                        $broadcast_nation = self::$result_ARRAY[0][3];
                        $stream_info = self::$result_ARRAY[0][4];
                        $stream_social = self::$result_ARRAY[0][5];
                        $bassdrive_stats_conn = self::$result_ARRAY[0][6];
                        $bassdrive_stats_throughput = self::$result_ARRAY[0][7];
                        $bassdrive_stats_throughput_unit = self::$result_ARRAY[0][8];
                        $bassdrive_stats_max_conn = self::$result_ARRAY[0][9];

                        $ttl_last_modified = self::$result_ARRAY[0][13];

                        $tmp_curr_date = strtotime('-' . $ttl_secs .' seconds');
                        $tmp_ttl_date = strtotime($ttl_last_modified);

                        if($tmp_curr_date > $tmp_ttl_date){

                            //error_log(__LINE__ . ' database :: TTL EXPIRE bassdrive [JSON REQUESTED] data from CACHE.');

                            //
                            // TTL EXPIRE CONTENT
                            $oBassDriveDatum->refresh_expired_data($relay_endpoint, $broadcast_nation, $stream_info, $stream_social, $bassdrive_stats_conn, $bassdrive_stats_throughput, $bassdrive_stats_throughput_unit, $bassdrive_stats_max_conn);
                            $oBassDriveDatum->reset_cache_ttl();

                            //
                            // RETURN LATEST JSON OBJECT
                            return $oBassDriveDatum->bassdrive_stream_ojson;

                        }else{

                            //error_log(__LINE__ . ' database :: RETURN bassdrive JSON from CACHE.');
                            //$oBassDriveDatum->load_data($broadcast_nation, $stream_info, $bassdrive_stats_conn, $bassdrive_stats_throughput, $bassdrive_stats_throughput_unit, $bassdrive_stats_max_conn);

                            //
                            // RETURN CACHE JSON OBJECT
                            return $bassdrive_json;

                        }

                    }

                    return $oBassDriveDatum;

                break;
                case 'expire_ttl_bassdriveData':

                    //$oUser is bassdrive_integration_data object.
                    /*
                    $oUser->bassdrive_stream_ojson;
                    $oUser->broadcast_nation;
                    $oUser->stream_info;
                    $oUser->bassdrive_stats;
                    $oUser->bassdrive_stats_conn;
                    $oUser->bassdrive_stats_throughput;
                    $oUser->bassdrive_stats_throughput_unit;
                    $oUser->bassdrive_stats_max_conn;
                    */

                    //$tmp_json = $this->properReplace(array("\r\n", "\r", "\n"), '<br>', $oUser->bassdrive_stream_ojson);

                    //error_log(__LINE__. ' database JSON['. $this->properReplace(array("\r\n", "\r", "\n"), '<br>', $oUser->bassdrive_stream_ojson) . ']');

                    self::$query = 'UPDATE `bassdrive_ttl_config`
                    SET
                    `CURRENT_RELAY_JSON` = "' . $mysqli->real_escape_string($oUser->bassdrive_stream_ojson) . '",
                    `CURRENT_BROADCAST_NATION` = "' . $mysqli->real_escape_string($oUser->broadcast_nation) . '",
                    `CURRENT_STREAM_INFO` = "' . $mysqli->real_escape_string($oUser->stream_info) . '",
                    `CURRENT_STREAM_SOCIAL` = "' . $mysqli->real_escape_string($oUser->stream_social) . '",
                    `CURRENT_STATS` = "' . $mysqli->real_escape_string($oUser->bassdrive_stats) . '",
                    `CURRENT_STATS_CONNECTIONS` = "' . $mysqli->real_escape_string($oUser->bassdrive_stats_conn) . '",
                    `CURRENT_STATS_THROUGHPUT` = "' . $mysqli->real_escape_string($oUser->bassdrive_stats_throughput) . '",
                    `CURRENT_STATS_THROUGHPUT_UNIT` = "' . $mysqli->real_escape_string($oUser->bassdrive_stats_throughput_unit) . '",
                    `CURRENT_STATS_MAX_CONNECTIONS` = "' . $mysqli->real_escape_string($oUser->bassdrive_stats_max_conn) . '",
                    `MODIFIED_SERVERADDR` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    `MODIFIED_BY_IP` = INET_ATON("' . $oUserEnvironment->oCRNRSTN_IPSECURITY_MGR->clientIpAddress() . '"),
                    `MODIFIED_BY_USERAGENT` = "' . $_SERVER['HTTP_USER_AGENT'] . '",
                    `DATEMODIFIED` = "' . $ts . '"
                    WHERE `ID` = 1 LIMIT 1;
                    ';

                    self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
                    if($mysqli->error){

                        throw new Exception('JONY5 database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');

                    }else{

                        return true;

                    }

                break;
                case 'ttl_bassdriveData':

                    $oBassDriveDatum = new bassdrive_integration_data($oUser, $oUserEnvironment, $this);

                    self::$query = 'SELECT `bassdrive_ttl_config`.`BASSDRIVE_ENDPOINT`,
                        `bassdrive_ttl_config`.`ENDPOINT_CACHE_TTL_SECS`,
                        `bassdrive_ttl_config`.`CURRENT_RELAY_JSON`,
                        `bassdrive_ttl_config`.`CURRENT_BROADCAST_NATION`,
                        `bassdrive_ttl_config`.`CURRENT_STREAM_INFO`,
                        `bassdrive_ttl_config`.`CURRENT_STREAM_SOCIAL`,
                        `bassdrive_ttl_config`.`CURRENT_STATS`,
                        `bassdrive_ttl_config`.`CURRENT_STATS_CONNECTIONS`,
                        `bassdrive_ttl_config`.`CURRENT_STATS_THROUGHPUT`,
                        `bassdrive_ttl_config`.`CURRENT_STATS_THROUGHPUT_UNIT`,
                        `bassdrive_ttl_config`.`CURRENT_STATS_MAX_CONNECTIONS`,
                        `bassdrive_ttl_config`.`MODIFIED_SERVERADDR`,
                        `bassdrive_ttl_config`.`MODIFIED_BY_IP`,
                        `bassdrive_ttl_config`.`MODIFIED_BY_USERAGENT`,
                        `bassdrive_ttl_config`.`DATEMODIFIED`,
                        `bassdrive_ttl_config`.`DATECREATED`
                    FROM `bassdrive_ttl_config` LIMIT 1;
                    ';

                    self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
                    if($mysqli->error){

                        throw new Exception('JONY5 database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');

                    }else{

                        //
                        // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
                        $ROWCNT=0;
                        while ($row = self::$result->fetch_row()) {

                            foreach($row as $fieldPos=>$value) {

                                //
                                // STORE RESULT
                                self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;

                            }

                            $ROWCNT++;

                        }

                        self::$result->free();

                    }

                    //
                    // VALIDATE TTL AND LOAD BASSDRIVE DATUM OBJECT
                    if(count(self::$result_ARRAY) > 0){

                        //
                        // CHECK CURRENT TIME AGAINST TTL FOR INDICATION OF DATA USE CASE TO IMPLEMENT
                        // self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
                        $ttl_secs = self::$result_ARRAY[0][1];

                        $relay_endpoint = self::$result_ARRAY[0][0];
                        $broadcast_nation = self::$result_ARRAY[0][3];
                        $stream_info = self::$result_ARRAY[0][4];
                        $stream_social = self::$result_ARRAY[0][5];
                        $bassdrive_stats = self::$result_ARRAY[0][6];
                        $bassdrive_stats_conn = self::$result_ARRAY[0][7];
                        $bassdrive_stats_throughput = self::$result_ARRAY[0][8];
                        $bassdrive_stats_throughput_unit = self::$result_ARRAY[0][9];
                        $bassdrive_stats_max_conn = self::$result_ARRAY[0][10];

                        $ttl_last_modified = self::$result_ARRAY[0][14];

                        $tmp_curr_date = strtotime('-' . $ttl_secs .' seconds');
                        $tmp_ttl_date = strtotime($ttl_last_modified);

                        if($tmp_curr_date > $tmp_ttl_date){

                            //error_log(__LINE__ . ' database :: TTL EXPIRE bassdrive stream data from CACHE.');

                            //
                            // TTL EXPIRE CONTENT
                            $oBassDriveDatum->refresh_expired_data($relay_endpoint, $broadcast_nation, $stream_info, $stream_social, $bassdrive_stats_conn, $bassdrive_stats_throughput, $bassdrive_stats_throughput_unit, $bassdrive_stats_max_conn);
                            $oBassDriveDatum->reset_cache_ttl();

                        }else{

                            //error_log(__LINE__ . ' database :: load bassdrive stream data from CACHE.');
                            $oBassDriveDatum->load_data($broadcast_nation, $stream_info, $stream_social, $bassdrive_stats, $bassdrive_stats_conn, $bassdrive_stats_throughput, $bassdrive_stats_throughput_unit, $bassdrive_stats_max_conn);

                        }

                    }

                    return $oBassDriveDatum;

                break;
				case 'getDailyPodcast':
					self::$query = 'SELECT `lsm_podcast_daily`.`TITLE`,`lsm_podcast_daily`.`URI` FROM `lsm_podcast_daily`';
					//error_log("(154) DATABASE RESULT QUERY: [".self::$query."]");

					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
					if($mysqli->error){
						throw new Exception('JONY5 database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					
					}else{
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						//error_log("(163) DATABASE RESULT EXISTS...");
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
						$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);
						
						//
						// RETURN RESULT SET ARRAY
						return self::$result_ARRAY;
					}
					
				break;
				case 'rotateDailyPodcast':
					//
					// GET ALL PODCASTS
					self::$query = 'SELECT `lsm_podcasts`.`ID`,`lsm_podcasts`.`TITLE`,`lsm_podcasts`.`URI`,`lsm_podcasts`.`VIEW_COUNT` FROM `lsm_podcasts`';
					//
					// PROCESS QUERY
					//error_log("rotate daily podcast query1->".self::$query);
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
					if($mysqli->error){

						throw new Exception('JONY5 database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					
					}else{
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						$ROWCNT=0;
						while ($row = self::$result->fetch_row()) {
							foreach($row as $fieldPos=>$value){
								//
								// STORE RESULT
								//error_log("jony5 /database.inc.php (207) rowcnt[".$ROWCNT."] fieldPos[".$fieldPos."] value [".$value."]");
								self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;
								
							}
							$ROWCNT++;
						}
						self::$result->free();

					}
					
					
					#error_log("(227) Sizeof: ".sizeof(self::$result_ARRAY));
					#error_log("(227) 931[1]: ".self::$result_ARRAY[931][1]);
					$tmp_podcast_index = rand(0, (sizeof(self::$result_ARRAY)-1));
					$tmp_viewcount = self::$result_ARRAY[$tmp_podcast_index][3];
					$tmp_viewcount++;
					self::$query = 'TRUNCATE `lsm_podcast_daily`;';
					self::$query .= 'INSERT INTO `lsm_podcast_daily` (`TITLE`, `URI`, `DATEMODIFIED`) VALUES ("'.trim(self::$result_ARRAY[$tmp_podcast_index][1]).'","'.trim(self::$result_ARRAY[$tmp_podcast_index][2]).'","'.$ts.'");';
					self::$query .= 'UPDATE `lsm_podcasts` SET `VIEW_COUNT`="'.$tmp_viewcount.'",`DATEMODIFIED`="'.$ts.'" 
									WHERE `ID`="'.self::$result_ARRAY[$tmp_podcast_index][0].'" LIMIT 1;';
									
					//
					// PROCESS QUERY
					//error_log("jony5 database rotate daily podcast: query->".self::$query);
					$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query);
					if($mysqli->error){
						throw new Exception('JONY5 database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					
					}
					
					//
					// CLOSE CONNECTION
					$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);
					
					//
					// RETURN RESULT SET ARRAY
					#error_log("jony5 database.inc (139) result_ARRAY[tmp_podcast_index1|2]->".self::$result_ARRAY[$tmp_podcast_index][1]."||".self::$result_ARRAY[$tmp_podcast_index][2]);
					$tmp_outputArray = array();
					$tmp_outputArray[0] = self::$result_ARRAY[$tmp_podcast_index][1];
					$tmp_outputArray[1] = self::$result_ARRAY[$tmp_podcast_index][2];
					
					return $tmp_outputArray;
					
				break;
				
				case 'crnrstn_signup':
					//
					// PREPARE QUERY
					self::$query = 'INSERT INTO `crnrstn_signup` (`FIRSTNAME`,`LASTNAME`,`EMAIL`) VALUES ("'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST,'fname')).'","'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST,'lname')).'","'.$mysqli->real_escape_string(strtolower($oUserEnvironment->oHTTP_MGR->extractData($_POST,'email'))).'");';
					//
					// PROCESS QUERY
					
				/*	$to      = 'c00000101@gmail.com';
					$subject = 'jony5.com Website crnrstn_signup db request';
					$messagetoSend = 'This is a triggered error notification from http://jony5.com
					
					Information about the event:
					- - - - - - - - - - - - - - - - - - - -
					Query: '.self::$query.'
					
					- - - - - - - - - - - - - - - - - - - -
					
					Sending IP Address: '.$_SERVER['REMOTE_ADDR'].'
					
					Please note that this information has not been saved anywhere.
					You may want to keep this email for your records.
					
					Thanks!';
					$headers = 'From: pixtwofl@box526.bluehost.com' . "\r\n" .
						'Reply-To: J00000101@GMAIL.COM' . "\r\n" .
						'X-Mailer: PHP/' . phpversion();
					
					mail($to, $subject, $messagetoSend, $headers);*/
					#error_log("database.inc.php (954) query: ".self::$query);
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
					#self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
					if($mysqli->error){
						throw new Exception('JONY5 database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
						return "signup=fail";
					}
					
					return "signup=success";
				
				break;
				case 'post_feedback':
					//
					// PREPARE HASH
					$seednum = microtime().rand();
					$seednum_full = md5($seednum);
					
					//
					// PREPARE QUERY
					self::$query = 'INSERT INTO `user_feedback` (`FID_SOURCE`,`FID_CRC32`,`FEEDBACK_SEARCH`,`FB_BUGREPORT`,`FB_FEATREQUEST`,`FB_GENQUESTION`,`FB_GENCOMMENT`,`FB_REPORTSPAM`,`OPTIN`,`NAME`,`EMAIL`,`FEEDBACK`,`URI`,`HTTP_USER_AGENT`,`HTTP_REFERER`,`REMOTE_ADDR`,`SERVER_ADDR`,`DATEMODIFIED`) VALUES ("'.$seednum_full.'","'.crc32($seednum_full).'","'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'FEEDBACK_SEARCH')).'","'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'FB_BUGREPORT')).'","'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'FB_FEATREQUEST')).'","'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'FB_GENQUESTION')).'","'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'FB_GENCOMMENT')).'","'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'FB_REPORTSPAM')).'","'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'OPTIN')).'","'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'name')).'","'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'email')).'","'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'feedback')).'","'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'uri')).'","'.$mysqli->real_escape_string($_SERVER['HTTP_USER_AGENT']).'","'.$mysqli->real_escape_string($_SERVER['HTTP_REFERER']).'",INET_ATON("'.$_SERVER['REMOTE_ADDR'].'"),INET_ATON("'.$_SERVER['SERVER_ADDR'].'"),"'.$ts.'");';
									
					#error_log("/jony5/ database.inc.php (993) query: ".self::$query);
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
					if($mysqli->error){
						throw new Exception('JONY5 database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
						return "feedback=fail";
					}
					
					return "feedback=success";
					
				break;
				default:
					//
					// HOOOSTON...VE HAF PROBLEM!
					throw new Exception('Key provided for dbQuery() does not exist in the system.');
				break;
			}

		}catch( Exception $e ) {

			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('database_integration->dbQuery()', LOG_EMERG, $e->getMessage());
			
			//
			// CLOSE CONNECTION
			$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);
			return self::$query_exception_result;

		}
		
		//
		// IF WE GET THIS FAR...
		$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);
		return NULL;
	}
	
	public function clearDblBR($str){
		return str_replace("<br /><br />", "<br />", $str);
	}
	
	private function search_FillerSanitize($str){
		#$string = 'The quick brown fox jumped over the lazy dog.';
		$patterns = array();
		$patterns[0] = "
";
		$patterns[1] = '"';
		$patterns[2] = '=';
		$patterns[3] = '{';
		$patterns[4] = '}';
		$patterns[5] = '(';
		$patterns[6] = ')';
		$patterns[7] = ' ';
		$patterns[8] = '	';
		$patterns[9] = ',';
		$patterns[10] = '\n';
		$patterns[11] = '\r';
		$patterns[12] = '\'';
		$patterns[13] = '/';
		$patterns[14] = '#';
		$patterns[15] = ';';
		$patterns[16] = ':';
		$patterns[17] = '>';
		$replacements = array();
		$replacements[0] = '';
		$replacements[1] = '';
		$replacements[2] = '';
		$replacements[3] = '';
		$replacements[4] = '';
		$replacements[5] = '';
		$replacements[6] = '';
		$replacements[7] = '';
		$replacements[8] = '';
		$replacements[9] = '';
		$replacements[10] = '';
		$replacements[11] = '';
		$replacements[12] = '';
		$replacements[13] = '';
		$replacements[14] = '';
		$replacements[15] = '';
		$replacements[16] = '';
		$replacements[17] = '';
		#$str = preg_replace($patterns, $replacements, $str);
		$str = str_replace($patterns, $replacements, $str);
		return $str;
	}

	private function int_to_string_BOOL_conversion($str){

	    if($str==0 || $str=='0' || $str==3 || $str=='3'){

	        return 'false';

        }else{

            return 'true';
        }

    }

	private function syncXML($type, $postid, $oUser, $oUserEnvironment)
    {
        try {

            //
            // RETRIEVE DATA
            $tmp_serial_handle = 'OVERLAY_DATUM';
            $oDB_RESP = $oUser->getOverlayStateDatum($tmp_serial_handle);

            //
            // THIS METHOD PERFORMS A CUSTOM META UPDATE
            $oDB_RESP->data_prep_flagUserAssociations($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS');

            //
            // KEY BY ID FOR PROFILE EXTRACTION
            $oDB_RESP->keyDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PROFILE', 'PROFILE_ID');
            $oDB_RESP->keyDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'PROFILE_ID');
            $oDB_RESP->keyDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'PROFILE_ID|LANG_ID');

            //
            // INITIALIZE & CLOSE CLIENT NODE
            $ts = date("Y-m-d H:i:s", time());
            $xmlFileNEW = ('<?xml version="1.0" encoding="UTF-8"?><obs_overlay_profile><profile>');
            $xmlFileCLOSE = ('</profile></obs_overlay_profile>');
            $xmlIndexFileNEW = ('<?xml version="1.0" encoding="iso-8859-1"?><obs_overlay_profile_index><profile_index>');
            $xmlIndexFileCLOSE = ('</profile_index></obs_overlay_profile_index>');
            $tmp_XML_LANG_PACKS_A = ('<lang_pack_translations>');
            $tmp_XML_LANG_PACKS_Z = ('</lang_pack_translations>');
            $xmlprofileNodes = ('');
            $tmp_path_profile_index_xml = 'social/fellowship/avsvc_overlay/_lib/xml/';
            $tmp_path_profile_xml = 'social/fellowship/avsvc_overlay/_lib/xml/_profiles/';

            $xmlprofileNodes = $xmlprofileNodes . $xmlFileNEW;

            switch ($type) {
                case 'full':

                    $tmp_pid = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'FULLSCREEN_PROFILE_ID');
                    $tmp_lastmodified_FULL = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'FULLSCREEN_LASTMODIFIED');
                    $tmp_lastmodified_MINI = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'MINI_LASTMODIFIED');

                    $tmp_type = $type;
                    $tmp_master_overlay_visible_BOOL = $this->int_to_string_BOOL_conversion($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'FULLSCREEN_STATE'));
                    $tmp_copy_overlay_visible_BOOL = $this->int_to_string_BOOL_conversion($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'FULLSCREEN_COPY_STATE'));
                    $tmp_master_overlay_display_area_width_in_px = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'DEFAULT_WIDTH');
                    $tmp_master_overlay_display_area_height_in_px = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'DEFAULT_HEIGHT');
                    $tmp_copy_display_area_width_in_px = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'DEFAULT_CONTENT_WIDTH');
                    $tmp_copy_display_area_height_in_px = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'DEFAULT_CONTENT_HEIGHT');
                    $tmp_master_overlay_bgcolor = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'HEXCOLOR');
                    $tmp_master_overlay_bgopacity = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'OPACITY');
                    $tmp_overlay_copy_color = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'COPY_HEXCOLOR');
                    $tmp_lang_pack_rotation_interval_secs = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'LANG_PACK_ROTATION_SECS');
                    $tmp_name = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PROFILE', $tmp_pid, 'PROFILE_NAME');

                    $tmp_XML_out_section_A = ('<pid>' . $tmp_pid . '</pid>
    <lastmodified>' . $tmp_lastmodified_FULL . '</lastmodified>
    <type>' . $tmp_type . '</type>
    <master_overlay_visible_BOOL>' . $tmp_master_overlay_visible_BOOL . '</master_overlay_visible_BOOL>
    <copy_overlay_visible_BOOL>' . $tmp_copy_overlay_visible_BOOL . '</copy_overlay_visible_BOOL>

    <master_overlay_display_area_width_in_px>' . $tmp_master_overlay_display_area_width_in_px . '</master_overlay_display_area_width_in_px>
    <master_overlay_display_area_height_in_px>' . $tmp_master_overlay_display_area_height_in_px . '</master_overlay_display_area_height_in_px>
    <copy_display_area_width_in_px>' . $tmp_copy_display_area_width_in_px . '</copy_display_area_width_in_px>
    <copy_display_area_height_in_px>' . $tmp_copy_display_area_height_in_px . '</copy_display_area_height_in_px>

    <master_overlay_bgcolor>' . $tmp_master_overlay_bgcolor . '</master_overlay_bgcolor>
    <master_overlay_bgopacity>' . $tmp_master_overlay_bgopacity . '</master_overlay_bgopacity>
    <overlay_copy_color>' . $tmp_overlay_copy_color . '</overlay_copy_color>

    <lang_pack_rotation_interval_secs>' . $tmp_lang_pack_rotation_interval_secs . '</lang_pack_rotation_interval_secs>

    <name>' . $tmp_name . '</name>');

                    $xmlprofileNodes = $xmlprofileNodes . $tmp_XML_out_section_A . $tmp_XML_LANG_PACKS_A;

                    $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_IDS');
                    // error_log('2610 tmp_loop_size->'.$tmp_loop_size);
                    for ($i = 0; $i < $tmp_loop_size; $i++) {

                        $tmp_LANG_ID = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_IDS', 'LANG_ID', $i);
                        //   error_log('2614 tmp_LANG_ID->'.$tmp_LANG_ID);
                        if ($oDB_RESP->ping_value_existence($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'LANG_ID', $tmp_LANG_ID)) {
                           // error_log('2616 value exists!->' . $tmp_LANG_ID);

                            $tmp_loop2_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS');
                            //
                            // LETS WORK ON GETTING THE DATA WE NEED TO SUPPORT THIS...THEN COME BACK...
                            for ($ii = 0; $ii < $tmp_loop2_size; $ii++) {
                                if($tmp_pid==$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'PROFILE_ID', $ii)) {
                                    $tmp_copy_fullscrn_header = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'PAGE_HEADER_BLOB', $ii);
                                    $tmp_copy_fullscrn_title = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'PAGE_TITLE_BLOB', $ii);
                                    $tmp_copy_fullscrn_body = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'PAGE_CODE_BLOB', $ii);
                                    $tmp_copy_fullscrn_font_size_percentage = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_IDS', 'FONT_SIZE_PERCENTAGE', $i);

                                    $tmp_lang_hash = hash('sha1', $tmp_copy_fullscrn_header . $tmp_copy_fullscrn_title . $tmp_copy_fullscrn_body . $tmp_copy_fullscrn_font_size_percentage);

                                    $tmp_XML_out_LANG_PACK = ('
                        <lang_pack>
                            <lang_id>' . $tmp_LANG_ID . '</lang_id>
                            <copy_fullscrn_header><![CDATA[' . $tmp_copy_fullscrn_header . ']]></copy_fullscrn_header>
                            <copy_fullscrn_title><![CDATA[' . $tmp_copy_fullscrn_title . ']]></copy_fullscrn_title>
                            <copy_fullscrn_body><![CDATA[<div class="cb_20"></div>' . $tmp_copy_fullscrn_body . ']]></copy_fullscrn_body>
                            <copy_fullscrn_font_size_percentage>' . $tmp_copy_fullscrn_font_size_percentage . '</copy_fullscrn_font_size_percentage>
                            <cleartext_endpoint>NULL</cleartext_endpoint>
                            <copy_hash>' . $tmp_lang_hash . '</copy_hash>
                        </lang_pack>');

                                    $xmlprofileNodes = $xmlprofileNodes . $tmp_XML_out_LANG_PACK;
                                }
                            }

                        }
                    }

                    $tmp_doc_hash = hash('sha1', $xmlprofileNodes);

                    $tmp_XML_hash = ('<config_hash>' . $tmp_doc_hash . '</config_hash>');

                    $xmlprofileNodes = $xmlprofileNodes . $tmp_XML_LANG_PACKS_Z . $tmp_XML_hash . $xmlFileCLOSE;

                    $tmp_profile_hash = hash('sha1', $xmlprofileNodes);


                    //error_log('2651 XML FULL-> '.$xmlprofileNodes);

                    //
                    // WRITE PROFILE XML
                    #YYYYMMDDHHMMSS_[PROFILE-NAME-SEARCH-CLEANED]_[FULL-MINI]_HASH(5).xml
                    $tmp_filename_date = date('Ymdhis');
                    $tmp_filename_name = $this->search_FillerSanitize(strtolower($tmp_name));
                    $tmp_filename_hash = $oUser->generateNewKey(5);

                    $tmp_filename_profile = $tmp_filename_date . '_' . $tmp_filename_name . '_' . $tmp_type . '_' . $tmp_filename_hash . '.xml';
                    $tmp_filename_index = 'profile_index.xml';

                    $tmp_filename_index = $oUser->getEnvParam('DOCUMENT_ROOT') . $oUser->getEnvParam('DOCUMENT_ROOT_DIR') . '/' . $tmp_path_profile_index_xml . $tmp_filename_index;
                    $tmp_filename_profile_PATH = $oUser->getEnvParam('DOCUMENT_ROOT') . $oUser->getEnvParam('DOCUMENT_ROOT_DIR') . '/' . $tmp_path_profile_xml . $tmp_filename_profile;
                    $tmp_filename_profile_HTTP = $oUser->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oUser->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $tmp_path_profile_xml . $tmp_filename_profile;

                    if (file_exists($tmp_filename_profile_PATH)) {
                        //
                        // DELETE THE FILE
                        unlink($tmp_filename_profile_PATH);

                        //
                        // UPDATE XML FILE WITH NEW DATA
                        $file_handle = fopen($tmp_filename_profile_PATH, 'a');
                        $tmp_prof_xml_status = fwrite($file_handle, $xmlprofileNodes);
                        fclose($file_handle);

                    } else {
                        //
                        // UPDATE XML FILE WITH NEW DATA
                        $file_handle = fopen($tmp_filename_profile_PATH, 'a');
                        $tmp_prof_xml_status = fwrite($file_handle, $xmlprofileNodes);
                        fclose($file_handle);

                    }

                    if ($tmp_prof_xml_status !== false) {
                        //
                        // PROCESS SUCCESS. BUILD INDEX.
                        $tmp_XML_DELTA_PROFILE_INDEX = ('<profile>
                        <requestor_id>jville</requestor_id>
                        <pid>' . $tmp_pid . '</pid>
                        <config_hash>' . $tmp_profile_hash . '</config_hash>
                        <profile_endpoint>' . $tmp_filename_profile_HTTP . '</profile_endpoint>
                        <profile_endpoint_prod>' . $tmp_filename_profile_HTTP . '</profile_endpoint_prod>
                        <cache_bust>Oh Lord Jesus!</cache_bust>
                        <lastmodified>' . $tmp_lastmodified_FULL . '</lastmodified>
                    </profile>');

                        $xmlprofileNodes = $xmlIndexFileNEW . $tmp_XML_DELTA_PROFILE_INDEX;

                        //
                        // COMPILE THE OTHER OVERLAY INDEX NODE - MINI
                        $tmp_index_other_pid = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'MINI_PROFILE_ID');
                        $tmp_index_other_endpoint = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'MINI_PROFILE_ENDPOINT');
                        $tmp_index_other_config_hash = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'MINI_PROFILE_HASH');
                       // $tmp_index_other_lastmodified = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'MINI_LASTMODIFIED');

                        $tmp_XML_DELTA_PROFILE_INDEX = ('<profile>
                        <requestor_id>jville</requestor_id>
                        <pid>' . $tmp_index_other_pid . '</pid>
                        <config_hash>' . $tmp_index_other_config_hash . '</config_hash>
                        <profile_endpoint>' . $tmp_index_other_endpoint . '</profile_endpoint>
                        <profile_endpoint_prod>' . $tmp_index_other_endpoint . '</profile_endpoint_prod>
                        <cache_bust>Oh Lord Jesus!</cache_bust>
                        <lastmodified>' . $tmp_lastmodified_MINI . '</lastmodified>
                    </profile>');

                        $xmlprofileNodes = $xmlprofileNodes . $tmp_XML_DELTA_PROFILE_INDEX . $xmlIndexFileCLOSE;

                        if (file_exists($tmp_filename_index)) {
                            //
                            // DELETE THE FILE
                            unlink($tmp_filename_index);

                            //
                            // UPDATE XML FILE WITH NEW DATA
                            $file_handle = fopen($tmp_filename_index, 'a');
                            $tmp_prof_xml_status = fwrite($file_handle, $xmlprofileNodes);
                            fclose($file_handle);

                        } else {
                            //
                            // UPDATE XML FILE WITH NEW DATA
                            $file_handle = fopen($tmp_filename_index, 'a');
                            $tmp_prof_xml_status = fwrite($file_handle, $xmlprofileNodes);
                            fclose($file_handle);

                        }


                    } else {

                        return false;

                    }

                    if ($tmp_prof_xml_status !== false) {
                        /*
    CREATE TABLE `cia00_overlay_state` (
      `STATE_ID` int(11) NOT NULL,
      `MINI_STATE` tinyint(1) NOT NULL DEFAULT '0',
      `MINI_COPY_STATE` tinyint(1) NOT NULL DEFAULT '1',
      `MINI_TIMER_STATE` tinyint(11) NOT NULL DEFAULT '1',
      `MINI_PROFILE_ID` char(70) NOT NULL,
      `MINI_PROFILE_HASH` varchar(50) DEFAULT NULL,
      `MINI_PROFILE_ENDPOINT` varchar(255) DEFAULT NULL,
      `MINI_LASTMODIFIED` datetime DEFAULT NULL,
      `FULLSCREEN_STATE` tinyint(1) NOT NULL DEFAULT '0',
      `FULLSCREEN_COPY_STATE` tinyint(1) DEFAULT '1',
      `FULLSCREEN_PROFILE_ID` char(70) NOT NULL,
      `FULLSCREEN_PROFILE_HASH` varchar(50) DEFAULT NULL,
      `FULLSCREEN_PROFILE_ENDPOINT` varchar(255) DEFAULT NULL,
      `FULLSCREEN_LASTMODIFIED` datetime DEFAULT NULL,
      `MODIFIER_ID` char(70) NOT NULL,
      `MODIFIER_IP` int(11) UNSIGNED NOT NULL,
      `MODIFIER_SESSION_ID` char(26) NOT NULL,
      `DATEMODIFIED` datetime NOT NULL,
      `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='View state of overlay compon*/

                        //
                        // SYNC DB STATE
                        self::$query = 'UPDATE `cia00_overlay_state` SET `FULLSCREEN_PROFILE_ID`="' . $tmp_pid . '",
                       `FULLSCREEN_PROFILE_HASH` = "' . $tmp_profile_hash . '",
                       `FULLSCREEN_PROFILE_ENDPOINT` = "' . $tmp_filename_profile_HTTP . '",
                       `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        `MODIFIER_SESSION_ID` = "' . session_id() . '",
                        `FULLSCREEN_LASTMODIFIED` = "' . $ts . '" ,
                        `DATEMODIFIED`="' . $ts . '" 
					     LIMIT 1;';

                        self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
                        if (self::$mysqli->error) {
                            throw new Exception('JONY5 database_integration :: FULLSCREEN OVERLAY XML SYNC ERROR :: [' . self::$mysqli->error . ']');
                        }

                        return true;
                    } else {
                        return false;

                    }

                    break;
                case 'mini':
                    $tmp_pid = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'MINI_PROFILE_ID');
                    $tmp_lastmodified_MINI = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'MINI_LASTMODIFIED');
                    $tmp_lastmodified_FULL = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'FULLSCREEN_LASTMODIFIED');
                    $tmp_type = $type;
                    $tmp_master_overlay_visible_BOOL = $this->int_to_string_BOOL_conversion($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'MINI_STATE'));
                    $timer_overlay_visible_BOOL = $this->int_to_string_BOOL_conversion($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'MINI_TIMER_STATE'));
                    $tmp_copy_overlay_visible_BOOL = $this->int_to_string_BOOL_conversion($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'MINI_COPY_STATE'));

                    $tmp_master_overlay_display_area_width_in_px = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_CONFIG', 'DEFAULT_WIDTH');
                    $tmp_master_overlay_display_area_height_in_px = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_CONFIG', 'DEFAULT_HEIGHT');
                    $tmp_copy_display_area_width_in_px = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_CONFIG', 'COPY_DISPLAY_AREA_WIDTH_PX');
                    $tmp_copy_display_area_height_in_px = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_CONFIG', 'COPY_DISPLAY_AREA_HEIGHT_PX');

                    $tmp_master_overlay_bgcolor = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_CONFIG', 'HEXCOLOR');
                    $tmp_master_overlay_bgopacity = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_CONFIG', 'OPACITY');
                    $tmp_overlay_copy_color = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_CONFIG', 'COPY_HEXCOLOR');
                    $tmp_timer_copy_color = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_CONFIG', 'TIMER_HEXCOLOR');

                    $tmp_lang_pack_rotation_interval_secs = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_CONFIG', 'LANG_PACK_ROTATION_SECS');
                    $tmp_name = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', $tmp_pid, 'PROFILE_NAME');

                    //
                    // TIMER STATE MANAGEMENT
                   // error_log('2895 timer mode = '.$postid);
                    switch ($postid) {
                        case 'hidetmr_p':
                            //   HIDE TIMER AND PAUSE
                        break;
                        case 'hidetmr_k':
                            //   HIDE TIMER AND KEEP IT GOING
                        break;
                        case 'hidetmr_r':
                            //   HIDE TIMER AND RESET
                        break;
                        case 'hideovrly_pt':
                            // HIDE AND PAUSE TIMER
                        break;
                        case 'hideovrly_kt':
                            // HIDE AND KEEP UP WITH TIMER
                        break;
                        case 'hideovrly_rt':
                            // HIDE AND RESET TIMER
                        break;
                        case 'show_overlay':
                            // SHOW TIMER SELECTED
                        break;
                        case 'reset_timer':
                            /*
                             <timer_mode>NULL</timer_mode>
                            <timer_override_parameter>NULL</timer_override_parameter>
                            <timer_override_transaction_hash>NULL</timer_override_transaction_hash>
                             * */
                            break;

                    }

                    $tmp_XML_out_section_A = ('<pid>' . $tmp_pid . '</pid>
    <lastmodified>' . $tmp_lastmodified_MINI . '</lastmodified>
    <type>' . $tmp_type . '</type>
    <master_overlay_visible_BOOL>' . $tmp_master_overlay_visible_BOOL . '</master_overlay_visible_BOOL>
    <timer_overlay_visible_BOOL>' . $timer_overlay_visible_BOOL . '</timer_overlay_visible_BOOL>
    <copy_overlay_visible_BOOL>' . $tmp_copy_overlay_visible_BOOL . '</copy_overlay_visible_BOOL>
    <timer_mode>'.$postid.'</timer_mode>
    <timer_override_parameter>NULL</timer_override_parameter>
    <timer_override_transaction_hash>NULL</timer_override_transaction_hash>
    <master_overlay_display_area_width_in_px>' . $tmp_master_overlay_display_area_width_in_px . '</master_overlay_display_area_width_in_px>
    <master_overlay_display_area_height_in_px>' . $tmp_master_overlay_display_area_height_in_px . '</master_overlay_display_area_height_in_px>
    <content_area_width_in_px>' . $tmp_copy_display_area_width_in_px . '</content_area_width_in_px>
    <timer_display_area_width_in_px>0</timer_display_area_width_in_px>
    <timer_display_area_height_in_px>0</timer_display_area_height_in_px>
    <copy_display_area_width_in_px>' . $tmp_copy_display_area_width_in_px . '</copy_display_area_width_in_px>
    <copy_display_area_height_in_px>' . $tmp_copy_display_area_height_in_px . '</copy_display_area_height_in_px>
    <master_overlay_bgcolor>' . $tmp_master_overlay_bgcolor . '</master_overlay_bgcolor>
    <master_overlay_bgopacity>' . $tmp_master_overlay_bgopacity . '</master_overlay_bgopacity>
    <overlay_copy_color>' . $tmp_overlay_copy_color . '</overlay_copy_color>
    <timer_copy_color>' . $tmp_timer_copy_color . '</timer_copy_color>
    <lang_pack_rotation_interval_secs>' . $tmp_lang_pack_rotation_interval_secs . '</lang_pack_rotation_interval_secs>
    <name>' . $tmp_name . '</name>');

                    $xmlprofileNodes = $xmlprofileNodes.$tmp_XML_out_section_A.$tmp_XML_LANG_PACKS_A;

                    $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_IDS');
                    //error_log('2610 tmp_loop_size->'.$tmp_loop_size);
                    for ($i = 0; $i < $tmp_loop_size; $i++) {

                        $tmp_LANG_ID = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_IDS', 'LANG_ID', $i);
                        //error_log('2614 tmp_LANG_ID->'.$tmp_LANG_ID);
                        if ($oDB_RESP->ping_value_existence($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'LANG_ID', $tmp_LANG_ID)) {

                            $tmp_loop2_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS');
                            //
                            // LETS WORK ON GETTING THE DATA WE NEED TO SUPPORT THIS...THEN COME BACK...
                            for ($ii = 0; $ii < $tmp_loop2_size; $ii++) {
                                /*
                                 * `cia00_lang_copy`.`MESSAGE_TITLE`,
                                                        `cia00_lang_copy`.`MESSAGE_TITLE_BLOB`,
                                                        `cia00_lang_copy`.`MESSAGE_NUMBER`,
                                                        `cia00_lang_copy`.`MESSAGE_NUMBER_BLOB`,
                                                        `cia00_lang_copy`.`CONFERENCE_TITLE`,
                                                        `cia00_lang_copy`.`CONFERENCE_TITLE_BLOB`,
                                                        `cia00_lang_copy`.`PAGE_HEADER`,
                                                        `cia00_lang_copy`.`PAGE_HEADER_BLOB`,
                                                        `cia00_lang_copy`.`PAGE_TITLE`,
                                                        `cia00_lang_copy`.`PAGE_TITLE_BLOB`,
                                                        `cia00_lang_copy`.`PAGE_CODE_BLOB`,
                                                        `cia00_lang_copy`.`DATE_COPY`,
                                                        `cia00_lang_copy`.`DATE_COPY_BLOB`,
                                 * */
                                if($tmp_pid==$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'PROFILE_ID', $ii)) {

                                    $tmp_copy_m_title = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'MESSAGE_TITLE_BLOB', $ii);
                                    $tmp_copy_m_message = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'MESSAGE_NUMBER_BLOB', $ii);
                                    $tmp_copy_m_conference = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'CONFERENCE_TITLE_BLOB', $ii);
                                    $tmp_copy_m_date = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'DATE_COPY_BLOB', $ii);
                                    $tmp_copy_m_font_size_percentage = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_IDS', 'FONT_SIZE_PERCENTAGE', $i);
                                    $tmp_copy_m_padding_top_px = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_IDS', 'COPY_PADDING_TOP_PX', $i);
                                    $tmp_timer_m_font_size_percentage = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_IDS', 'TIMER_FONT_SIZE_PERCENTAGE', $i);

                                    $tmp_lang_hash = hash('sha1', $tmp_copy_m_title . $tmp_copy_m_message . $tmp_copy_m_conference . $tmp_copy_m_date . $tmp_copy_m_font_size_percentage . $tmp_copy_m_padding_top_px . $tmp_timer_m_font_size_percentage);

                                    $tmp_XML_out_LANG_PACK = ('
                            <lang_pack>
                                <lang_id>' . $tmp_LANG_ID . '</lang_id>
                                <copy_m_title><![CDATA[' . $tmp_copy_m_title . ']]></copy_m_title>
                                <copy_m_message><![CDATA[' . $tmp_copy_m_message . ']]></copy_m_message>
                                <copy_m_conference><![CDATA[' . $tmp_copy_m_conference . ']]></copy_m_conference>
                                <copy_m_date><![CDATA[' . $tmp_copy_m_date . ']]></copy_m_date>
                                <copy_m_scroll_speed>50</copy_m_scroll_speed>
                                <copy_m_scroll_direction>right_to_left</copy_m_scroll_direction>
                                <copy_m_font_size_percentage>' . $tmp_copy_m_font_size_percentage . '</copy_m_font_size_percentage>
                                <copy_m_padding_top_px>' . $tmp_copy_m_padding_top_px . '</copy_m_padding_top_px>
                                <timer_m_font_size_percentage>' . $tmp_timer_m_font_size_percentage . '</timer_m_font_size_percentage>
                                <cleartext_endpoint>NULL</cleartext_endpoint>
                                <copy_hash>' . $tmp_lang_hash . '</copy_hash>
                            </lang_pack>');

                                    $xmlprofileNodes = $xmlprofileNodes . $tmp_XML_out_LANG_PACK;
                                }
                            }

                        }
                    }

                    $tmp_doc_hash = hash('sha1', $xmlprofileNodes);

                    $tmp_XML_hash = ('<config_hash>' . $tmp_doc_hash . '</config_hash>');

                    $xmlprofileNodes = $xmlprofileNodes . $tmp_XML_LANG_PACKS_Z . $tmp_XML_hash . $xmlFileCLOSE;

                    $tmp_profile_hash = hash('sha1', $xmlprofileNodes);

                    //error_log('2781 XML MINI-> '.$xmlprofileNodes);

                    //
                    // WRITE PROFILE XML
                    #YYYYMMDDHHMMSS_[PROFILE-NAME-SEARCH-CLEANED]_[FULL-MINI]_HASH(5).xml
                    $tmp_filename_date = date('Ymdhis');
                    $tmp_filename_name = $this->search_FillerSanitize(strtolower($tmp_name));
                    $tmp_filename_hash = $oUser->generateNewKey(5);

                    $tmp_filename_profile = $tmp_filename_date . '_' . $tmp_filename_name . '_' . $tmp_type . '_' . $tmp_filename_hash . '.xml';
                    $tmp_filename_index = 'profile_index.xml';

                    $tmp_filename_index = $oUser->getEnvParam('DOCUMENT_ROOT') . $oUser->getEnvParam('DOCUMENT_ROOT_DIR') . '/' . $tmp_path_profile_index_xml . $tmp_filename_index;
                    $tmp_filename_profile_PATH = $oUser->getEnvParam('DOCUMENT_ROOT') . $oUser->getEnvParam('DOCUMENT_ROOT_DIR') . '/' . $tmp_path_profile_xml . $tmp_filename_profile;
                    $tmp_filename_profile_HTTP = $oUser->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oUser->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $tmp_path_profile_xml . $tmp_filename_profile;


                    if (file_exists($tmp_filename_profile_PATH)) {
                        //
                        // DELETE THE FILE
                        unlink($tmp_filename_profile_PATH);

                        //
                        // UPDATE XML FILE WITH NEW DATA
                        $file_handle = fopen($tmp_filename_profile_PATH, 'a');
                        $tmp_prof_xml_status = fwrite($file_handle, $xmlprofileNodes);
                        fclose($file_handle);

                    } else {

                        //
                        // UPDATE XML FILE WITH NEW DATA
                        $file_handle = fopen($tmp_filename_profile_PATH, 'a');
                        $tmp_prof_xml_status = fwrite($file_handle, $xmlprofileNodes);
                        fclose($file_handle);

                    }


                    if ($tmp_prof_xml_status !== false) {
                        //
                        // PROCESS SUCCESS. BUILD INDEX.
                        $tmp_XML_DELTA_PROFILE_INDEX = ('<profile>
                        <requestor_id>jville</requestor_id>
                        <pid>' . $tmp_pid . '</pid>
                        <config_hash>' . $tmp_profile_hash . '</config_hash>
                        <profile_endpoint>' . $tmp_filename_profile_HTTP . '</profile_endpoint>
                        <profile_endpoint_prod>' . $tmp_filename_profile_HTTP . '</profile_endpoint_prod>
                        <cache_bust>Oh Lord Jesus!</cache_bust>
                        <lastmodified>' . $tmp_lastmodified_MINI . '</lastmodified>
                    </profile>');

                        $xmlprofileNodes = $xmlIndexFileNEW . $tmp_XML_DELTA_PROFILE_INDEX;

                        //
                        // COMPILE THE OTHER OVERLAY INDEX NODE - FULLSCREEN
                        $tmp_index_other_pid = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'FULLSCREEN_PROFILE_ID');
                        $tmp_index_other_endpoint = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'FULLSCREEN_PROFILE_ENDPOINT');
                        $tmp_index_other_config_hash = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'FULLSCREEN_PROFILE_HASH');
                        //$tmp_index_other_lastmodified = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'FULLSCREEN_LASTMODIFIED');

                        $tmp_XML_DELTA_PROFILE_INDEX = ('<profile>
                        <requestor_id>jville</requestor_id>
                        <pid>' . $tmp_index_other_pid . '</pid>
                        <config_hash>' . $tmp_index_other_config_hash . '</config_hash>
                        <profile_endpoint>' . $tmp_index_other_endpoint . '</profile_endpoint>
                        <profile_endpoint_prod>' . $tmp_index_other_endpoint . '</profile_endpoint_prod>
                        <cache_bust>Oh Lord Jesus!</cache_bust>
                        <lastmodified>' . $tmp_lastmodified_FULL . '</lastmodified>
                    </profile>');

                        $xmlprofileNodes = $xmlprofileNodes . $tmp_XML_DELTA_PROFILE_INDEX . $xmlIndexFileCLOSE;

                        if (file_exists($tmp_filename_index)) {
                            //
                            // DELETE THE FILE
                            unlink($tmp_filename_index);

                            //
                            // UPDATE XML FILE WITH NEW DATA
                            $file_handle = fopen($tmp_filename_index, 'a');
                            $tmp_prof_xml_status = fwrite($file_handle, $xmlprofileNodes);
                            fclose($file_handle);

                        } else {
                            //
                            // UPDATE XML FILE WITH NEW DATA
                            $file_handle = fopen($tmp_filename_index, 'a');
                            $tmp_prof_xml_status = fwrite($file_handle, $xmlprofileNodes);
                            fclose($file_handle);

                        }

                    } else {

                        return false;

                    }

                    if ($tmp_prof_xml_status !== false) {
                        //
                        // SYNC DB STATE
                        self::$query = 'UPDATE `cia00_overlay_state` SET `MINI_PROFILE_ID`="' . $tmp_pid . '",
                       `MINI_PROFILE_HASH` = "' . $tmp_profile_hash . '",
                       `MINI_PROFILE_ENDPOINT` = "' . $tmp_filename_profile_HTTP . '",
                       `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        `MODIFIER_SESSION_ID` = "' . session_id() . '",
                        `MINI_LASTMODIFIED` = "' . $ts . '" ,
                        `DATEMODIFIED`="' . $ts . '" 
					     LIMIT 1;';

                        self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);

                        if (self::$mysqli->error) {
                            throw new Exception('JONY5 database_integration :: MINI OVERLAY XML SYNC ERROR :: [' . self::$mysqli->error . ']');
                        }

                        return true;
                    } else {
                        return false;

                    }

                    break;
                default:
                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Overlay type provided for syncXML() does not exist in the system.');
                    break;

            }

        } catch (Exception $e) {
            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('database_response_manager->__construct()', LOG_EMERG, $e->getMessage());

        }

        return true;
    }

    function cleanupcharacters($mystring){
        $mystring = str_replace("&", "and", $mystring);
        return $mystring;
    }

    public function properReplace($pattern, $replacement, $original_str){

	    if(is_array($pattern)){

            $replacement_array[0] = $replacement;

            $original_str = str_replace($pattern, $replacement_array, $original_str);

        }else{

            $pattern_array[0] = $pattern;
            $replacement_array[0] = $replacement;

            $original_str = str_replace($pattern_array, $replacement_array, $original_str);

        }

        return $original_str;

    }

    public function __destruct() {

	}
}