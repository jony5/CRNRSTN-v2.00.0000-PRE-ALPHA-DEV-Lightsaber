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

            //error_log('database (77) ** result_profile_results_ARRAY UNDEFINED ** at position['.$pos.'] with serial['.$serial.'|'.$serial_crc.'] within the SELECT profile['.$profile.'|'.$profile_crc.'], and this has not been found. Response serial='.$serial);

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

            //error_log('database (103) ** result_profile_results_ARRAY Field['.$field.'/'.$field_crc.'] UNDEFINED at position['.$pos.'] with serial['.$serial.'|'.$serial_crc.'] within the SELECT profile['.$profile.'|'.$profile_crc.'], and this has not been found. Response serial=');

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

    public function returnProfileSQL($resp_serial, $profile_pos){

        $tmp_array = self::$sql_select_ARRAY[$resp_serial];

        return $tmp_array[$profile_pos];
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

                        $tmp_single_field_array[1] = $this->sanitizeFieldname($tmp_single_field_array[1]);

                        //
                        // FOR EACH FIELD
                        # array[serial][select_CNT][field_position] = fieldname;
                        self::$query_resp_field_viaPos[$resp_serial][$i][$ii] = $tmp_single_field_array[1];                 // STORE FIELD NAME ACCESSED BY POSITION

                        # array[serial][select_CNT][field name] = field position;
                        # [$resp_serial][SELECT_STATMENT][FIRSTNAME] = 3
                        self::$resp_fieldPosition_viaFieldName[$resp_serial][$i][crc32($tmp_single_field_array[1])] = $ii;        // STORE POSITION. NEED ACCESS BY FIELD NAME.

                    }else{

                        //error_log('223 - '.$tmp_field_chop_array[$ii]);

                        $tmp_single_field_array = explode('.', $tmp_field_chop_array[$ii]);

                        # $i = SELECT statement
                        # $ii = FIELD POSITION
                        # $tmp_single_field_array[1] = FIELD NAME FOR ACCESS

                        //
                        // FOR EACH FIELD
                        # array[serial][select_CNT][field_position] = fieldname;
                        $tmp_single_field_array[1] = $this->sanitizeFieldname($tmp_single_field_array[1]);

                        self::$query_resp_field_viaPos[$resp_serial][$i][$ii] = $tmp_single_field_array[1];                 // STORE FIELD NAME ACCESSED BY POSITION
                        //error_log('224 database.inc looking for DATECREATED['.$tmp_single_field_array[1].']');

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

    private function sanitizeFieldname($str){

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

    public function __destruct() {

    }

}

/*
// CLASS :: ojson_controller
// AUTHOR :: Jonathan 'J5' Harris <jharris@evifweb.com>
// VERSION :: 1.0.0
// DATE :: 11.25.2019 @ 0903
*/
class ojson_controller {

    private static $oLogger;
    private static $oData;
    private static $oEnv;

    private static $json_errors = array();
    public $last_error_ARRAY = array();
    private static $ojson_ARRAY = array();
    public $last_error_code_ARRAY = array();
    public $last_error_code;
    public $ojson_response_key_ARRAY = array();
    public $ojson_response_value_ARRAY = array();
    public $key_val_cnt_ARRAY = array();

    public function __construct($oEnv, $oDB) {
        try{
            //
            // INSTANTIATE LOGGER
            self::$oLogger = new crnrstn_logging();

            // SOURCE :: https://stackoverflow.com/questions/689185/json-decode-returns-null-after-webservice-call
            // AUTHOR :: https://stackoverflow.com/users/354217/larrybattle
            self::$json_errors = array(
                JSON_ERROR_NONE => 'No error has occurred',
                JSON_ERROR_DEPTH => 'The maximum stack depth has been exceeded',
                JSON_ERROR_STATE_MISMATCH => 'Invalid or malformed JSON',
                JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded',
                JSON_ERROR_SYNTAX => 'Syntax error',
                JSON_ERROR_UTF8 => 'Malformed UTF-8 characters, possibly incorrectly encoded (added PHP 5.3.3)',
                JSON_ERROR_RECURSION => 'One or more recursive references in the value to be encoded (added PHP 5.5.0)',
                JSON_ERROR_INF_OR_NAN => 'One or more NAN or INF values in the value to be encoded (added PHP 5.5.0)',
                JSON_ERROR_UNSUPPORTED_TYPE => 'A value of a type that cannot be encoded was given (added PHP 5.5.0)',
                JSON_ERROR_INVALID_PROPERTY_NAME => 'A property name that cannot be encoded was given (added PHP 7.0.0)',
                JSON_ERROR_UTF16 => 'Malformed UTF-16 characters, possibly incorrectly encoded'
            );

            //
            // INSTANTIATE RESULT MAPPER. THIS CLASS IS ONLY USED INTERNALLY...HERE. I DON'T THINK THERE ARE ANY PUBLIC CALLS. WOULD IT EVEN MAKE SENSE?
            // YEP. NO PUBLIC CALLS TO SELECT MAPPER OBJECT. DON'T NEED TO DOCUMENT.

            if(isset($oEnv) && isset($oDB)){

                self::$oEnv = $oEnv;
                self::$oData = $oDB;
            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('ERR :: CRNRSTN_ENV and ojson_controller:: are required parameters for ojson_controller::__construct().');

            }

        }catch( Exception $e ) {
            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('ojson_controller->__construct()', LOG_EMERG, $e->getMessage());

        }

    }


    public function init($ojson_serial){

        $this->key_val_cnt_ARRAY[$ojson_serial] = 0;

    }

    public function return_ojson_decode($ojson_serial){

        return self::$ojson_ARRAY[$ojson_serial];

    }

    public function consume_json_packet($ojson_serial, $ojson_packet_string){

        $ojson_packet_string = utf8_encode($ojson_packet_string);

        //
        // KEEP LINE BREAKS AND DECODE
        self::$ojson_ARRAY[$ojson_serial] = $this->json_decode_nice($ojson_packet_string, false);

        $this->last_error_code_ARRAY[$ojson_serial] = json_last_error();
        $this->last_error_code = json_last_error();
        $this->last_error_ARRAY[$ojson_serial] = self::$json_errors[json_last_error()];

        //if ($this->last_error_code === JSON_ERROR_NONE) {

        //}

    }

    public function return_ojson_last_err_code($ojson_serial=null){

        if(isset($ojson_serial)){
            //
            // RETURN LAST ERROR CODE PER SERIAL
            return $this->last_error_code_ARRAY[$ojson_serial];

        }else{

            //
            // JUST RETURN LAST ERROR CODE
            return $this->last_error_code;
        }

    }

    public function return_ojson_last_err_copy($ojson_serial=null){

        if(isset($ojson_serial)){
            //
            // RETURN LAST ERROR COPY PER SERIAL
            return $this->last_error_ARRAY[$ojson_serial];

        }else{

            //
            // JUST RETURN LAST ERROR COPY
            return self::$json_errors[$this->last_error_code];
        }

    }

    public function add_ojson_response_value($json_serial, $json_key, $json_value){

        $tmp_keyval_cnt = $this->key_val_cnt_ARRAY[$json_serial];

        $this->ojson_response_key_ARRAY[$json_serial][$tmp_keyval_cnt] = $json_key;
        $this->ojson_response_value_ARRAY[$json_serial][$tmp_keyval_cnt] = $json_value;

        $tmp_keyval_cnt ++;
        $this->key_val_cnt_ARRAY[$json_serial] = $tmp_keyval_cnt;

    }

    public function return_ojson_response_array($ojson_serial){

        $tmp_return_array = array();

        $tmp_loop_size = $this->key_val_cnt_ARRAY[$ojson_serial];
        for($i=0;$i<$tmp_loop_size;$i++){

            $tmp_return_array[$this->ojson_response_key_ARRAY[$ojson_serial][$i]] = $this->ojson_response_value_ARRAY[$ojson_serial][$i];

        }

        return $tmp_return_array;

    }

    // SOURCE :: https://www.php.net/manual/en/function.json-decode.php
    // AUTHOR :: https://www.php.net/manual/en/function.json-decode.php#112084
    private function json_decode_nice($json, $assoc = TRUE){
        $json = str_replace(array("\n","\r"),"\\n",$json);
        $json = preg_replace('/([{,]+)(\s*)([^"]+?)\s*:/','$1"$3":',$json);
        $json = preg_replace('/(,)\s*}$/','}',$json);
        return json_decode($json,$assoc);
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
    private static $oJsonController;

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

    private static $staticParam_ARRAY = array();

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

    public function addStaticParam($key, $val){

        self::$staticParam_ARRAY[$key] = $val;
    }

    public function getStaticParam($key){

        try{

            if(isset($key) && isset(self::$staticParam_ARRAY[$key])){

                return self::$staticParam_ARRAY[$key];
            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('ERR :: KEY and/or staticParam_ARRAY[KEY] NOT INITIALIZED IN database_response_manager :: database_response_manager::getStaticParam(?->'.$key.'<-).');

            }

        }catch( Exception $e ) {
            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('database_response_manager->getStaticParam()', LOG_EMERG, $e->getMessage());

        }

    }


    public function add_ojson_response_value($json_serial, $json_key, $json_value){

        self::$oJsonController->add_ojson_response_value($json_serial, $json_key, $json_value);

    }

    public function return_ojson_response_array($ojson_serial){

        return self::$oJsonController->return_ojson_response_array($ojson_serial);

    }

    public function retrieve_ojson_decoded($ojson_serial){


        return self::$oJsonController->return_ojson_decode($ojson_serial);
    }

    public function init_ojson_controller($ojson_serial){

        if(!isset(self::$oJsonController)){

            self::$oJsonController = new ojson_controller(self::$oEnv, self::$oData);

        }

        self::$oJsonController->init($ojson_serial);

    }

    public function ojson_injest($ojson_serial, $ojson_packet_string){

        self::$oJsonController->consume_json_packet($ojson_serial, $ojson_packet_string);

    }

    public function ojson_last_err($CONSTANT_INT_RETURN=false, $ojson_serial=null){

        if(isset($ojson_serial)){

            if($CONSTANT_INT_RETURN){

                return self::$oJsonController->return_ojson_last_err_code($ojson_serial);

            }else{

                return self::$oJsonController->return_ojson_last_err_copy($ojson_serial);

            }

        }else{

            if($CONSTANT_INT_RETURN){

                // json_last_error()
                // $json_errors[json_last_error()];

                return self::$oJsonController->return_ojson_last_err_code();

            }else{

                return self::$oJsonController->return_ojson_last_err_copy();

            }

        }

    }

    public function returnProfileSQL($serial, $profile_pos){


        return self::$oSQLMapper->returnProfileSQL(crc32($serial), $profile_pos);


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
                // EXTRACT BASED ON RESPONSE QUEUE
                if(is_int($key)){
                    return self::$resp_serial_ARRAY[$key];

                }

                //
                // THIS SHOULD BE DECENTLY FAST vs THE FOREACH() WE HAD PREVIOUSLY :: https://gist.github.com/ksimka/21a6ff74b41451c430e8
                $keypos = array_search($key, self::$resp_serial_key_ARRAY);

                if(!($keypos===false)){   // NOT SURE ABOUT THIS BUT WE WILL TRY IT OUT. NICE.
                    if(isset(self::$resp_serial_ARRAY[$keypos])){

                        return self::$resp_serial_ARRAY[$keypos];

                    }else{

                        return '';

                    }
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

            if(isset(self::$rekey_profile_response_ARRAY[crc32($serial)][crc32($profile)][$current_id][crc32($fieldname)])){

                return self::$rekey_profile_response_ARRAY[crc32($serial)][crc32($profile)][$current_id][crc32($fieldname)];

            }else{

                return '';
            }
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
                throw new Exception('AV Overlay database_response_manager::return_sizeof() :: result_profile_count_ARRAY not set for serial['.$serial.'] profile['.$profile.']');

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
            throw new Exception('AV Overlay database_response_manager :: '.$queryType.' ERROR :: ['.$heavy_mysqli->error.']');

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
                    // NOPE...WILL NOT ALWAYS INCREMENT...IF NO RESULTS...NO INCREMENT.
                    $select_query_cnt++;
                    //error_log("database (1315) process next result set ".$select_query_cnt);
                }

            } while ($heavy_mysqli->more_results() && $heavy_mysqli->next_result());

        }

        //error_log("database (1327) done processing multi-query. rows=".$ROWCNT);
    }

    public function consume_mysqli_single_result($result, $heavy_mysqli, $queryType){

        self::$queryType = $queryType;

        if($heavy_mysqli->error){
            self::$query_exception_result = $queryType."=error";
            throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.$heavy_mysqli->error.']');

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
    private static $queryMakerForAllMonatony;
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
        self::$oLogger = new crnrstn_logging();

    }

    public function processRequest($queryType ,$oUser, $oEnv, $oDB_RESP=NULL){
        //
        // WILL ALWAYS RETURN $oDB_RESP OBJECT. CHECK OBJECT FOR DATA OR ERROR.
        return $this->executeRequest($queryType, $oUser, $oEnv, $oDB_RESP);
    }

    public function processUserRequest($queryType ,$oUser, $oEnv, $oDB_RESP=NULL){
        return $this->executeQueryType($queryType, $oUser, $oEnv, $oDB_RESP=NULL);
    }

    private function executeRequest($queryType, $oUser, $oEnv, $oDB_RESP)
    {
        try {
            //error_log('database.inc.php (1594) evifweb queryType sent to user database_integrations class object :: ' . $queryType . ' from [' . $_SERVER['REMOTE_ADDR'] . ']');
            $ts = date("Y-m-d H:i:s", time());

            //
            // IF WE EVER NEED TO CONNECT TO MORE THAN 1 DATABASE IN A REQUEST....NEED TO WIRE IN MYSQLI CONN RESET BOOLEAN
            // FOR NOW, THE PERFORMANCE BOOST FROM MAINTAINING CONNECTION PERSIST IS WORTH IT. CAN ADD MULTI-DB SUPPORT LATER.
            if (isset(self::$mysqli)) {
                if (self::$mysqli->ping()) {
                    //error_log("database (1093) mysqli->Our connection is ok!");
                } else {
                    //error_log("database (1095) mysqli->I will open a new connection now! ping()==FALSE");
                    //
                    // OPEN CONNECTION
                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->returnConnection();
                }
            } else {
                //error_log("database (1101) mysqli->I will open a new connection now! ...mysqli not set");
                //
                // OPEN CONNECTION
                self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->returnConnection();
            }

            if (!isset($oDB_RESP)) {

                if (!isset(self::$oDB_RESP)) {
                    //error_log("database (1294) executeRequest() NOTICE :: We are instantiating a CLEAN oDB_RESP object for querytype[" . $queryType . "] Why not recycle?");

                    self::$oDB_RESP = new database_response_manager($oEnv, $this);
                    $oDB_RESP = self::$oDB_RESP;
                } else {
                    $oDB_RESP = self::$oDB_RESP;
                }
            }

            if (!isset(self::$queryMakerForAllMonatony)) {
                //
                // INSTANTIATE QUERY HELPER
                self::$queryMakerForAllMonatony = new boring_query_handler(self::$mysqli);

            }

            switch ($queryType) {
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
                        $tmp_SELECT_ARRAY[$tmp_sel_count] = 'SELECT `wthrbg_sys_lang_elements`.`ELEMENT_REF_KEY`, `wthrbg_sys_lang_elements`.`COUNTRY_ISO_CODE`, `wthrbg_sys_lang_elements`.`ELEMENT_CONTENT_BLOB` AS `ELEMENT_CONTENT` FROM `wthrbg_sys_lang_elements` WHERE 
                        `wthrbg_sys_lang_elements`.`ELEMENT_REF_KEY`="'.self::$mysqli->real_escape_string($tmp_ELEMENT_KEY_ARRAY[$i]).'" AND
                        `wthrbg_sys_lang_elements`.`ELEMENT_REF_KEY_CRC32`="'.crc32($tmp_ELEMENT_KEY_ARRAY[$i]).'" AND
                        `wthrbg_sys_lang_elements`.`COUNTRY_ISO_CODE`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("COUNTRY_ISO_CODE")).'" AND 
                        `wthrbg_sys_lang_elements`.`ISO_CODE_CRC32`="'.crc32($oUser->retrieve_Form_Data("COUNTRY_ISO_CODE")).'" LIMIT 1;';

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

            }

        }catch( Exception $e ) {
            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('database_integration->dbQuery()', LOG_EMERG, $e->getMessage());

            //
            // CLOSE CONNECTION
            $oEnv->oMYSQLI_CONN_MGR->closeConnection(self::$mysqli);

            return self::$query_exception_result;
        }
    }

    private function executeQueryType($queryType, $oUser, $oEnv, $oDB_RESP)
    {
        try {
            //error_log('database.inc.php (1526) jony5 executeQueryType() sent to user database_integrations class object :: ' . $queryType . ' from [' . $_SERVER['REMOTE_ADDR'] . ']');
            #$ts = date("Y-m-d H:i:s", time()-60*60*4);
            $ts = date("Y-m-d H:i:s", time());

            //
            // IF WE EVER NEED TO CONNECT TO MORE THAN 1 DATABASE IN A REQUEST....NEED TO WIRE IN MYSQLI CONN RESET BOOLEAN
            // FOR NOW, THE PERFORMANCE BOOST FROM MAINTAINING CONNECTION PERSIST IS WORTH IT. CAN ADD MULTI-DB SUPPORT LATER.
            if (isset(self::$mysqli)) {
                if (self::$mysqli->ping()) {
                    //error_log("database (1439) mysqli->Our connection is ok!");
                } else {
                    //error_log("database (1441) mysqli->I will open a new connection now! ping()==FALSE");
                    //
                    // OPEN CONNECTION
                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->returnConnection();
                }
            } else {
                //error_log("database (1447) mysqli->I will open a new connection now! ...mysqli not set");

                //
                // OPEN CONNECTION
                self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->returnConnection();
            }

            if (!isset($oDB_RESP)) {

                if (!isset(self::$oDB_RESP)) {
                    // error_log("database (1830) executeRequest() NOTICE :: We are instantiating a CLEAN oDB_RESP object for querytype[" . $queryType . "] Why not recycle?");
                    self::$oDB_RESP = new database_response_manager($oEnv, $this);
                    $oDB_RESP = self::$oDB_RESP;
                } else {
                    $oDB_RESP = self::$oDB_RESP;
                }
            }

            if (!isset(self::$queryMakerForAllMonatony)) {
                //
                // INSTANTIATE QUERY HELPER
                self::$queryMakerForAllMonatony = new boring_query_handler(self::$mysqli);

            }

            switch ($queryType) {
                case 'locale_ugc_search':

                    //
                    // WE NEED TO QUERY THE DATABASE TO MAKE CSV_LINE/DB_ROW COMPARISONS FOR THE PURPOSE OF INSERT/UPDATE
                    $force_profile_select_align = true;
                    $db_resp_process_serial = "!jesus_is_my_dear_lord!";        # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();         //$oUser->return_serial_handle();
                    $db_resp_target_profiles = 'LOCALE_SEARCH|LOCALE_TYPO_SEARCH';                 # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '13|20';                          # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION :: GET ALL USERS. ALL USER-CLIENT RELATIONS. AND CLIENT DATA.
                    $tmp_SELECT_ARRAY = array();

                    $tmp_ugc_query = $oUser->retrieve_Form_Data('USER_QUERY');

                    $tmp_pos_comma = strpos($tmp_ugc_query, ',');

                    //
                    // IF NO COMMA
                    if(($tmp_pos_comma===false)){

                        //
                        // SEARCH CITY DATA...FIRST.
                        $tmp_city_ugc_query = $oUser->searchCleanStr($tmp_ugc_query);
                        $tmp_state_ugc_query = '';

                        //
                        // LOCALE_SEARCH
                        $tmp_SELECT_ARRAY[0] = 'SELECT `wthrbg_citystate_search`.`SEARCH_ID`,
                            `wthrbg_citystate_search`.`ZG_GEO_ID`,
                            `wthrbg_citystate_search`.`ZG_CITY`,
                            `wthrbg_citystate_search`.`ZG_STATE`,
                            `wthrbg_citystate_search`.`ZG_ZIPCODE`,
                            `wthrbg_citystate_search`.`ZG_GEOPOINT`,
                            `wthrbg_citystate_search`.`SPROV_POSTAL`,
                            `wthrbg_citystate_search`.`SPROV_NAME`,
                            `wthrbg_citystate_search`.`SPROV_GEOPOINT`,
                            `wthrbg_citystate_search`.`SPROV_WIKIPEDIA`,
                            `wthrbg_citystate_search`.`SPROV_NAME_ALT`,
                            `wthrbg_citystate_search`.`SPROV_ABBREV`,
                            `wthrbg_citystate_search`.`DATEMODIFIED`
                        FROM `wthrbg_citystate_search`
                        WHERE `wthrbg_citystate_search`.`ISACTIVE`="1" 
                        AND `wthrbg_citystate_search`.`SEARCH_CONTENT_CITY` LIKE \'%'.self::$mysqli->real_escape_string($tmp_city_ugc_query).'%\'
                        ORDER BY `wthrbg_citystate_search`.`ZG_CITY` LIMIT 30;
                        ';

                        //
                        // LOCALE_TYPO_SEARCH
                        $tmp_SELECT_ARRAY[1] = 'SELECT `wthrbg_citystate_typo_search`.`SEARCH_ID`,
                            `wthrbg_citystate_typo_search`.`SEARCH_CONTENT_CITY`,
                            `wthrbg_citystate_typo_search`.`SEARCH_CONTENT_STATE`,
                            `wthrbg_citystate_typo_search`.`DATESEARCHSYNC`,
                            `wthrbg_citystate_typo_search`.`ZG_CITY`,
                            `wthrbg_citystate_typo_search`.`ZG_CITY_LOOKUP`,
                            `wthrbg_citystate_typo_search`.`ZG_STATE`,
                            `wthrbg_citystate_typo_search`.`ZG_ZIPCODE`,
                            `wthrbg_citystate_typo_search`.`ZG_GEO_ID`,
                            `wthrbg_citystate_typo_search`.`ZG_GEOPOINT`,
                            `wthrbg_citystate_typo_search`.`SPROV_POSTAL`,
                            `wthrbg_citystate_typo_search`.`SPROV_POSTAL_LOOKUP`,
                            `wthrbg_citystate_typo_search`.`SPROV_NAME`,
                            `wthrbg_citystate_typo_search`.`SPROV_NAME_LOOKUP`,
                            `wthrbg_citystate_typo_search`.`SPROV_GEOPOINT`,
                            `wthrbg_citystate_typo_search`.`SPROV_WIKIPEDIA`,
                            `wthrbg_citystate_typo_search`.`SPROV_NAME_ALT`,
                            `wthrbg_citystate_typo_search`.`SPROV_ABBREV`,
                            `wthrbg_citystate_typo_search`.`DATEMODIFIED`,
                            `wthrbg_citystate_typo_search`.`DATECREATED`
                        FROM `wthrbg_citystate_typo_search`
                        WHERE `wthrbg_citystate_typo_search`.`ISACTIVE`="1" 
                        AND `wthrbg_citystate_typo_search`.`SPROV_NAME` IS NOT NULL
                        AND `wthrbg_citystate_typo_search`.`SEARCH_CONTENT_CITY` LIKE \'%'.self::$mysqli->real_escape_string($tmp_city_ugc_query).'%\'
                        ORDER BY `wthrbg_citystate_typo_search`.`ZG_CITY` LIMIT 30;
                        ';

                    }else{

                        //
                        // SPLIT SEARCH BETWEEN CITY AND STATE
                        $tmp_ugc_citystate_ARRAY = explode(',', $tmp_ugc_query);
                        $tmp_city_ugc_query = $oUser->searchCleanStr($tmp_ugc_citystate_ARRAY[0]);
                        $tmp_state_ugc_query = $oUser->searchCleanStr($tmp_ugc_citystate_ARRAY[1]);

                        if(strlen($tmp_state_ugc_query)<3){
                            $tmp_state_ugc_query = strtoupper($tmp_state_ugc_query);

                            //
                            // LOCALE_SEARCH
                            $tmp_SELECT_ARRAY[0] = 'SELECT `wthrbg_citystate_search`.`SEARCH_ID`,
                                `wthrbg_citystate_search`.`ZG_GEO_ID`,
                                `wthrbg_citystate_search`.`ZG_CITY`,
                                `wthrbg_citystate_search`.`ZG_STATE`,
                                `wthrbg_citystate_search`.`ZG_ZIPCODE`,
                                `wthrbg_citystate_search`.`ZG_GEOPOINT`,
                                `wthrbg_citystate_search`.`SPROV_POSTAL`,
                                `wthrbg_citystate_search`.`SPROV_NAME`,
                                `wthrbg_citystate_search`.`SPROV_GEOPOINT`,
                                `wthrbg_citystate_search`.`SPROV_WIKIPEDIA`,
                                `wthrbg_citystate_search`.`SPROV_NAME_ALT`,
                                `wthrbg_citystate_search`.`SPROV_ABBREV`,
                                `wthrbg_citystate_search`.`DATEMODIFIED`
                            FROM `wthrbg_citystate_search`
                            WHERE `wthrbg_citystate_search`.`ISACTIVE`="1" 
                            AND `wthrbg_citystate_search`.`SEARCH_CONTENT_CITY` LIKE \'%'.self::$mysqli->real_escape_string($tmp_city_ugc_query).'%\'
                            AND `wthrbg_citystate_search`.`SEARCH_CONTENT_STATE` LIKE \'%'.self::$mysqli->real_escape_string($tmp_state_ugc_query).'%\'
                            ORDER BY `wthrbg_citystate_search`.`ZG_CITY` LIMIT 30;
                            ';

                            //
                            // LOCALE_TYPO_SEARCH
                            $tmp_SELECT_ARRAY[1] = 'SELECT `wthrbg_citystate_typo_search`.`SEARCH_ID`,
                            `wthrbg_citystate_typo_search`.`SEARCH_CONTENT_CITY`,
                            `wthrbg_citystate_typo_search`.`SEARCH_CONTENT_STATE`,
                            `wthrbg_citystate_typo_search`.`DATESEARCHSYNC`,
                            `wthrbg_citystate_typo_search`.`ZG_CITY`,
                            `wthrbg_citystate_typo_search`.`ZG_CITY_LOOKUP`,
                            `wthrbg_citystate_typo_search`.`ZG_STATE`,
                            `wthrbg_citystate_typo_search`.`ZG_ZIPCODE`,
                            `wthrbg_citystate_typo_search`.`ZG_GEO_ID`,
                            `wthrbg_citystate_typo_search`.`ZG_GEOPOINT`,
                            `wthrbg_citystate_typo_search`.`SPROV_POSTAL`,
                            `wthrbg_citystate_typo_search`.`SPROV_POSTAL_LOOKUP`,
                            `wthrbg_citystate_typo_search`.`SPROV_NAME`,
                            `wthrbg_citystate_typo_search`.`SPROV_NAME_LOOKUP`,
                            `wthrbg_citystate_typo_search`.`SPROV_GEOPOINT`,
                            `wthrbg_citystate_typo_search`.`SPROV_WIKIPEDIA`,
                            `wthrbg_citystate_typo_search`.`SPROV_NAME_ALT`,
                            `wthrbg_citystate_typo_search`.`SPROV_ABBREV`,
                            `wthrbg_citystate_typo_search`.`DATEMODIFIED`,
                            `wthrbg_citystate_typo_search`.`DATECREATED`
                        FROM `wthrbg_citystate_typo_search`
                        WHERE `wthrbg_citystate_typo_search`.`ISACTIVE`="1" 
                            AND `wthrbg_citystate_typo_search`.`SPROV_NAME` IS NOT NULL
                            AND `wthrbg_citystate_typo_search`.`SEARCH_CONTENT_CITY` LIKE \'%'.self::$mysqli->real_escape_string($tmp_city_ugc_query).'%\'
                            AND `wthrbg_citystate_typo_search`.`SEARCH_CONTENT_STATE` LIKE \'%'.self::$mysqli->real_escape_string($tmp_state_ugc_query).'%\'
                            ORDER BY `wthrbg_citystate_typo_search`.`ZG_CITY` LIMIT 30;
                        ';

                        }else{

                            //
                            // LOCALE_SEARCH
                            $tmp_SELECT_ARRAY[0] = 'SELECT `wthrbg_citystate_search`.`SEARCH_ID`,
                                `wthrbg_citystate_search`.`ZG_GEO_ID`,
                                `wthrbg_citystate_search`.`ZG_CITY`,
                                `wthrbg_citystate_search`.`ZG_STATE`,
                                `wthrbg_citystate_search`.`ZG_ZIPCODE`,
                                `wthrbg_citystate_search`.`ZG_GEOPOINT`,
                                `wthrbg_citystate_search`.`SPROV_POSTAL`,
                                `wthrbg_citystate_search`.`SPROV_NAME`,
                                `wthrbg_citystate_search`.`SPROV_GEOPOINT`,
                                `wthrbg_citystate_search`.`SPROV_WIKIPEDIA`,
                                `wthrbg_citystate_search`.`SPROV_NAME_ALT`,
                                `wthrbg_citystate_search`.`SPROV_ABBREV`,
                                `wthrbg_citystate_search`.`DATEMODIFIED`
                            FROM `wthrbg_citystate_search`
                            WHERE `wthrbg_citystate_search`.`ISACTIVE`="1" 
                            AND `wthrbg_citystate_typo_search`.`SEARCH_CONTENT_CITY` LIKE \'%'.self::$mysqli->real_escape_string($tmp_city_ugc_query).'%\'
                            AND `wthrbg_citystate_typo_search`.`SEARCH_CONTENT_STATE` LIKE \'%'.self::$mysqli->real_escape_string($tmp_state_ugc_query).'%\'
                            ORDER BY `wthrbg_citystate_search`.`ZG_CITY` LIMIT 30;
                        ';

                        //
                        // LOCALE_TYPO_SEARCH
                        $tmp_SELECT_ARRAY[1] = 'SELECT `wthrbg_citystate_typo_search`.`SEARCH_ID`,
                            `wthrbg_citystate_typo_search`.`SEARCH_CONTENT_CITY`,
                            `wthrbg_citystate_typo_search`.`SEARCH_CONTENT_STATE`,
                            `wthrbg_citystate_typo_search`.`DATESEARCHSYNC`,
                            `wthrbg_citystate_typo_search`.`ZG_CITY`,
                            `wthrbg_citystate_typo_search`.`ZG_CITY_LOOKUP`,
                            `wthrbg_citystate_typo_search`.`ZG_STATE`,
                            `wthrbg_citystate_typo_search`.`ZG_ZIPCODE`,
                            `wthrbg_citystate_typo_search`.`ZG_GEO_ID`,
                            `wthrbg_citystate_typo_search`.`ZG_GEOPOINT`,
                            `wthrbg_citystate_typo_search`.`SPROV_POSTAL`,
                            `wthrbg_citystate_typo_search`.`SPROV_POSTAL_LOOKUP`,
                            `wthrbg_citystate_typo_search`.`SPROV_NAME`,
                            `wthrbg_citystate_typo_search`.`SPROV_NAME_LOOKUP`,
                            `wthrbg_citystate_typo_search`.`SPROV_GEOPOINT`,
                            `wthrbg_citystate_typo_search`.`SPROV_WIKIPEDIA`,
                            `wthrbg_citystate_typo_search`.`SPROV_NAME_ALT`,
                            `wthrbg_citystate_typo_search`.`SPROV_ABBREV`,
                            `wthrbg_citystate_typo_search`.`DATEMODIFIED`,
                            `wthrbg_citystate_typo_search`.`DATECREATED`
                        FROM `wthrbg_citystate_typo_search`
                        WHERE `wthrbg_citystate_typo_search`.`ISACTIVE`="1" 
                        AND `wthrbg_citystate_typo_search`.`SPROV_NAME` IS NOT NULL
                        AND `wthrbg_citystate_typo_search`.`SEARCH_CONTENT_CITY` LIKE \'%'.self::$mysqli->real_escape_string($tmp_city_ugc_query).'%\'
                        AND `wthrbg_citystate_typo_search`.`SEARCH_CONTENT_STATE` LIKE \'%'.self::$mysqli->real_escape_string($tmp_state_ugc_query).'%\'
                        ORDER BY `wthrbg_citystate_typo_search`.`ZG_CITY` LIMIT 30;
                        ';

                        }

                    }

                    $oDB_RESP->process(self::$mysqli, $queryType, $tmp_SELECT_ARRAY);
                    //$oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'STATE_PROVINCE', 'POSTAL');  # POSTAL = GA

                    return $oDB_RESP;

                break;
                case 'locale_typosearch_mysql_import':

                    return 'Dataset INSERT not authorized to prevent dup entry.';

                    /*
                    self::$http_param_handle["US_CITY_STATE_PROV_DATA"] = $contents;
                    self::$http_param_handle["RAW_RESPONSE_LENGTH"] = $tmp_str_len;
                    self::$http_param_handle["RAW_RESPONSE_FILESIZE"] = filesize($filename);
                     * */

                    //$tmp_RAW_CONTENT = $oUser->retrieve_Form_Data('US_CITY_STATE_PROV_DATA');
                    $tmp_txt_extract_ARRAY = $oUser->parseMiscTXTtoARRAY($oUser->retrieve_Form_Data('US_CITY_STATE_PROV_DATA'));
                    self::$query = '';

                    $tmp_txt_chunck_cnt = sizeof($tmp_txt_extract_ARRAY);

                    for($i=0;$i<$tmp_txt_chunck_cnt;$i++){

                        //
                        // DO I HAVE RELEVANT DATA?
                        $pos = strpos($tmp_txt_extract_ARRAY[$i], "</strong>");
                        if ($pos === false) {

                            //
                            // TXT HAS NO GOOD CITY

                        }else{

                            //
                            // PROCESS OUT GOOD CITY DATA FOR SQL INSERT
                            /*
                                SEARCH_ID				char(70)
                                SEARCH_ID_CRC32			bigint(11) unsigned
                                ISACTIVE				tinyint(1) default 1
                                SEARCH_CONTENT_CITY		varchar(500)  // PUT THE WILD TYPO CITY NAME HERE
                                SEARCH_CONTENT_STATE	varchar(500) // POPULATE FROM STATE DATA
                                DATASEARCHSYNC			datetime
                                ZG_CITY_LOOKUP          varchar(100)  // PUT THE WILD PROPER CITY NAME HERE
                                ZG_CITY					varchar(100)  // PUT THE FK PROPER CITY NAME HERE
                                ZG_STATE				char(2)
                                ZG_ZIPCODE				char(10)
                                ZG_GEO_ID				char(70)
                                ZG_GEOPOINT				varchar(25)
                                SPROV_POSTAL_LOOKUP		char(2)
                                SPROV_POSTAL			char(2)
                                SPROV_NAME				varchar(100)
                                SPROV_NAME_LOOKUP	    varchar(100)
                                SPROV_GEOPOINT			varchar(100)
                                SPROV_WIKIPEDIA			varchar(255)
                                SPROV_NAME_ALT			varchar(100)
                                SPROV_ABBREV			varchar(20)
                                DATEMODIFIED
                                DATECREATED
                             * */

                            $tmp_SEARCH_ID = $oUser->generateNewKey(70);
                            $tmp_SEARCH_CONTENT_CITY = $oUser->returnTxtParseData('SEARCH_CONTENT_CITY', $tmp_txt_extract_ARRAY[$i]);
                            $tmp_SPROV_POSTAL = $oUser->returnTxtParseData('SPROV_POSTAL', $tmp_txt_extract_ARRAY[$i]);
                            $tmp_ZG_CITY_LOOKUP = $oUser->returnTxtParseData('ZG_CITY_LOOKUP', $tmp_txt_extract_ARRAY[$i]);
                            $tmp_SPROV_NAME = $oUser->returnTxtParseData('SPROV_NAME', $tmp_txt_extract_ARRAY[$i]);

                            self::$query .= 'INSERT INTO `wthrbg_citystate_typo_search`
                            (`SEARCH_ID`,
                            `SEARCH_ID_CRC32`,
                            `SEARCH_CONTENT_CITY`,
                            `ZG_CITY_LOOKUP`,
                            `SPROV_POSTAL_LOOKUP`,
                            `SPROV_NAME_LOOKUP`,
                            `DATEMODIFIED`)
                            VALUES
                            ("'.$tmp_SEARCH_ID.'",
                            "'.crc32($tmp_SEARCH_ID).'",
                            "'.self::$mysqli->real_escape_string($tmp_SEARCH_CONTENT_CITY).'",
                            "'.self::$mysqli->real_escape_string($tmp_ZG_CITY_LOOKUP).'",
                            "'.self::$mysqli->real_escape_string($tmp_SPROV_POSTAL).'",
                            "'.self::$mysqli->real_escape_string($tmp_SPROV_NAME).'",
                            "'.$ts.'");
                            ';

                        }

                    }

                    //
                    // EXECUTE QUERY
                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        self::$query_exception_result = "error";
                        throw new Exception('Wethrbug database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }


                    /*

                    # '<strong>'.$tmp_proper_city_name.'</strong>'
                    # '<em>'.$tmp_typo_city_name.'</em>'
                    # '('.$tmp_state_name_long ','
                    # $tmp_state_name_postal.'\n)'

                     <table width="100%">
                        <tbody>
                                <tr>
                                    <th class="letter" colspan="3" id="A">A</th>
                                </tr>
                                            <tr>
                                    <td><strong>Abbeville</strong></td>
                                    <td>Commonly misspelled as <em>Abbevile</em></td>
                                    <td>(Georgia, GA
                     )</td>
                                </tr>
                                        <tr>
                                    <td><strong>Abbeville</strong></td>
                                    <td>Commonly misspelled as <em>Abeville</em></td>
                                    <td>(Georgia, GA
                     )</td>
                                </tr>
                                        <tr>
                                    <td><strong>
                     * */



                    return 'locale_typosearch_mysql_import='.sizeof($tmp_txt_extract_ARRAY);


                break;
                case 'locale_typosearch_mysql_buildout':

                    //
                    // WE NEED TO QUERY THE DATABASE TO MAKE CSV_LINE/DB_ROW COMPARISONS FOR THE PURPOSE OF INSERT/UPDATE
                    $force_profile_select_align = true;
                    $db_resp_process_serial = "!jesus_is_my_dear_lord!";        # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();         //$oUser->return_serial_handle();
                    $db_resp_target_profiles = 'MASTER_CITY_PROVINCE';                 # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '17';                          # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION :: GET ALL USERS. ALL USER-CLIENT RELATIONS. AND CLIENT DATA.
                    $tmp_SELECT_ARRAY = array();
                    self::$query = '';

                    //
                    // MASTER_CITY_PROVINCE
                    $tmp_SELECT_ARRAY[0] = 'SELECT `wthrbg_citystate_search`.`SEARCH_ID`,
                        `wthrbg_citystate_search`.`SEARCH_CONTENT_CITY`,
                        `wthrbg_citystate_search`.`SEARCH_CONTENT_STATE`,
                        `wthrbg_citystate_search`.`DATESEARCHSYNC`,
                        `wthrbg_citystate_search`.`ZG_CITY`,
                        `wthrbg_citystate_search`.`ZG_STATE`,
                        `wthrbg_citystate_search`.`ZG_ZIPCODE`,
                        `wthrbg_citystate_search`.`ZG_GEO_ID`,
                        `wthrbg_citystate_search`.`ZG_GEOPOINT`,
                        `wthrbg_citystate_search`.`SPROV_POSTAL`,
                        `wthrbg_citystate_search`.`SPROV_NAME`,
                        `wthrbg_citystate_search`.`SPROV_GEOPOINT`,
                        `wthrbg_citystate_search`.`SPROV_WIKIPEDIA`,
                        `wthrbg_citystate_search`.`SPROV_NAME_ALT`,
                        `wthrbg_citystate_search`.`SPROV_ABBREV`,
                        `wthrbg_citystate_search`.`DATEMODIFIED`,
                        `wthrbg_citystate_search`.`DATECREATED`
                    FROM `wthrbg_citystate_search`
                    WHERE `wthrbg_citystate_search`.`ISACTIVE`="1"
                    AND (`wthrbg_citystate_search`.`DATESEARCHSYNC` IS NULL OR DATE_SUB(CURDATE(), INTERVAL 2 WEEK) >= `wthrbg_citystate_search`.`DATESEARCHSYNC`)
                    ORDER BY `wthrbg_citystate_search`.`DATESEARCHSYNC` ASC, `wthrbg_citystate_search`.`ZG_STATE`, `wthrbg_citystate_search`.`ZG_CITY` LIMIT 1000;
';

                    $oDB_RESP->process(self::$mysqli, $queryType, $tmp_SELECT_ARRAY);

                    //$oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'MASTER_CITY_PROVINCE', 'ZG_CITY');  # POSTAL = GA
                    $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial(), 'MASTER_CITY_PROVINCE');
                    for($i=0;$i<$tmp_loop_size;$i++){
                        $tmp_SEARCH_CONTENT_STATE = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'MASTER_CITY_PROVINCE', 'SEARCH_CONTENT_STATE', $i);
                        $tmp_SEARCH_ID = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'MASTER_CITY_PROVINCE', 'SEARCH_ID', $i);
                        $tmp_ZG_CITY = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'MASTER_CITY_PROVINCE', 'ZG_CITY', $i);
                        $tmp_ZG_STATE = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'MASTER_CITY_PROVINCE', 'ZG_STATE', $i);
                        $tmp_ZG_ZIPCODE = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'MASTER_CITY_PROVINCE', 'ZG_ZIPCODE', $i);
                        $tmp_ZG_GEO_ID = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'MASTER_CITY_PROVINCE', 'ZG_GEO_ID', $i);
                        $tmp_ZG_GEOPOINT = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'MASTER_CITY_PROVINCE', 'ZG_GEOPOINT', $i);
                        $tmp_SPROV_POSTAL = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'MASTER_CITY_PROVINCE', 'SPROV_POSTAL', $i);
                        $tmp_SPROV_NAME = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'MASTER_CITY_PROVINCE', 'SPROV_NAME', $i);
                        $tmp_SPROV_GEOPOINT = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'MASTER_CITY_PROVINCE', 'SPROV_GEOPOINT', $i);
                        $tmp_SPROV_WIKIPEDIA = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'MASTER_CITY_PROVINCE', 'SPROV_WIKIPEDIA', $i);
                        $tmp_SPROV_NAME_ALT = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'MASTER_CITY_PROVINCE', 'SPROV_NAME_ALT', $i);
                        $tmp_SPROV_ABBREV = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'MASTER_CITY_PROVINCE', 'SPROV_ABBREV', $i);

                        self::$query .= 'UPDATE `wthrbg_citystate_typo_search`
                        SET
                        `SEARCH_CONTENT_STATE` = "'.self::$mysqli->real_escape_string($tmp_SEARCH_CONTENT_STATE).'",
                        `ZG_CITY` = "'.self::$mysqli->real_escape_string($tmp_ZG_CITY).'",
                        `ZG_STATE` = "'.self::$mysqli->real_escape_string($tmp_ZG_STATE).'",
                        `ZG_ZIPCODE` = "'.self::$mysqli->real_escape_string($tmp_ZG_ZIPCODE).'",
                        `ZG_GEO_ID` = "'.self::$mysqli->real_escape_string($tmp_ZG_GEO_ID).'",
                        `ZG_GEOPOINT` = "'.self::$mysqli->real_escape_string($tmp_ZG_GEOPOINT).'",
                        `SPROV_POSTAL` = "'.self::$mysqli->real_escape_string($tmp_SPROV_POSTAL).'",
                        `SPROV_NAME` = "'.self::$mysqli->real_escape_string($tmp_SPROV_NAME).'",
                        `SPROV_GEOPOINT` = "'.self::$mysqli->real_escape_string($tmp_SPROV_GEOPOINT).'",
                        `SPROV_WIKIPEDIA` = "'.self::$mysqli->real_escape_string($tmp_SPROV_WIKIPEDIA).'",
                        `SPROV_NAME_ALT` = "'.self::$mysqli->real_escape_string($tmp_SPROV_NAME_ALT).'",
                        `SPROV_ABBREV` = "'.self::$mysqli->real_escape_string($tmp_SPROV_ABBREV).'",
                        `DATEMODIFIED` = "'.$ts.'"
                        WHERE `ZG_CITY_LOOKUP` = "'.$tmp_ZG_CITY.'"
                        AND `SPROV_POSTAL_LOOKUP` = "'.$tmp_SPROV_POSTAL.'"
                        ;
                        ';

                        self::$query .= 'UPDATE `wthrbg_citystate_search`
                        SET
                        `DATESEARCHSYNC` = "'.$ts.'"
                        WHERE `SEARCH_ID` = "'.$tmp_SEARCH_ID.'" 
                        AND `SEARCH_ID_CRC32` = "'.crc32($tmp_SEARCH_ID).'" 
                        LIMIT 1;
                        ';

                    }

                    //
                    // EXECUTE QUERY
                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        self::$query_exception_result = "error";
                        throw new Exception('Wethrbug database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }

                    return 'locale_typosearch_mysql_buildout=success|'.$tmp_loop_size;

                break;
                case 'locale_search_mysql_buildout':

                    //
                    // WE NEED TO QUERY THE DATABASE TO MAKE CSV_LINE/DB_ROW COMPARISONS FOR THE PURPOSE OF INSERT/UPDATE
                    $force_profile_select_align = true;
                    $db_resp_process_serial = "!jesus_is_my_dear_lord!";        # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();         //$oUser->return_serial_handle();
                    $db_resp_target_profiles = 'STATE_PROVINCE|ZIPCODE_GEO|LOCALE_SEARCH';                 # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '16|18|16';                          # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION :: GET ALL USERS. ALL USER-CLIENT RELATIONS. AND CLIENT DATA.
                    $tmp_SELECT_ARRAY = array();

                    //
                    // STATE_PROVINCE
                    $tmp_SELECT_ARRAY[0] = 'SELECT `wthrbg_state_province`.`STATE_ID`,
                        `wthrbg_state_province`.`POSTAL`,
                        `wthrbg_state_province`.`NAME`,
                        `wthrbg_state_province`.`GEOPOINT`,
                        `wthrbg_state_province`.`WIKIPEDIA`,
                        `wthrbg_state_province`.`NAME_ALT`,
                        `wthrbg_state_province`.`TYPE`,
                        `wthrbg_state_province`.`REGION`,
                        `wthrbg_state_province`.`REGION_BIG`,
                        `wthrbg_state_province`.`ABBREV`,
                        `wthrbg_state_province`.`STATE_PROV_CHECKSUM`,
                        `wthrbg_state_province`.`STATE_PROV_RAW_LINE`,
                        `wthrbg_state_province`.`RAW_RESPONSE_LENGTH`,
                        `wthrbg_state_province`.`UPDATE_COUNT`,
                        `wthrbg_state_province`.`DATEMODIFIED`,
                        `wthrbg_state_province`.`DATECREATED`
                    FROM `wthrbg_state_province`
                    WHERE `wthrbg_state_province`.`ISACTIVE`="1";
';

                    //
                    // ZIPCODE_GEO
                    $tmp_SELECT_ARRAY[1] = 'SELECT `wthrbg_zipcode_geo`.`GEO_ID`,
                        `wthrbg_zipcode_geo`.`ZIPCODE`,
                        `wthrbg_zipcode_geo`.`CITY`,
                        `wthrbg_zipcode_geo`.`STATE`,
                        `wthrbg_zipcode_geo`.`LATITUDE_STR`,
                        `wthrbg_zipcode_geo`.`LONGITUDE_STR`,
                        `wthrbg_zipcode_geo`.`LATITUDE_FLOAT`,
                        `wthrbg_zipcode_geo`.`LONGITUDE_FLOAT`,
                        `wthrbg_zipcode_geo`.`TIMEZONE`,
                        `wthrbg_zipcode_geo`.`DAYLIGHT_SAVINGS`,
                        `wthrbg_zipcode_geo`.`GEOPOINT`,
                        `wthrbg_zipcode_geo`.`GEOZIP_CHECKSUM`,
                        `wthrbg_zipcode_geo`.`GEOZIP_RAW_LINE`,
                        `wthrbg_zipcode_geo`.`RAW_RESPONSE_LENGTH`,
                        `wthrbg_zipcode_geo`.`UPDATE_COUNT`,
                        `wthrbg_zipcode_geo`.`DATESEARCHSYNC`,
                        `wthrbg_zipcode_geo`.`DATEMODIFIED`,
                        `wthrbg_zipcode_geo`.`DATECREATED`
                    FROM `wthrbg_zipcode_geo`
                    WHERE `wthrbg_zipcode_geo`.`ISACTIVE`="1" 
                    AND (`wthrbg_zipcode_geo`.`DATESEARCHSYNC` IS NULL OR DATE_SUB(CURDATE(), INTERVAL 2 WEEK) >= `wthrbg_zipcode_geo`.`DATESEARCHSYNC`)
                    ORDER BY `wthrbg_zipcode_geo`.`DATESEARCHSYNC` ASC, `wthrbg_zipcode_geo`.`STATE`, `wthrbg_zipcode_geo`.`CITY` LIMIT 1000;
';
                    //
                    // LOCALE_SEARCH
                    $tmp_SELECT_ARRAY[2] = 'SELECT `wthrbg_citystate_search`.`SEARCH_ID`,
                        `wthrbg_citystate_search`.`SEARCH_CONTENT_CITY`,
                        `wthrbg_citystate_search`.`SEARCH_CONTENT_STATE`,
                        `wthrbg_citystate_search`.`ZG_GEO_ID`,
                        `wthrbg_citystate_search`.`ZG_CITY`,
                        `wthrbg_citystate_search`.`ZG_STATE`,
                        `wthrbg_citystate_search`.`ZG_ZIPCODE`,
                        `wthrbg_citystate_search`.`ZG_GEOPOINT`,
                        `wthrbg_citystate_search`.`SPROV_POSTAL`,
                        `wthrbg_citystate_search`.`SPROV_NAME`,
                        `wthrbg_citystate_search`.`SPROV_GEOPOINT`,
                        `wthrbg_citystate_search`.`SPROV_WIKIPEDIA`,
                        `wthrbg_citystate_search`.`SPROV_NAME_ALT`,
                        `wthrbg_citystate_search`.`SPROV_ABBREV`,
                        `wthrbg_citystate_search`.`ISACTIVE`,
                        `wthrbg_citystate_search`.`DATEMODIFIED`
                    FROM `wthrbg_citystate_search`
                    WHERE `wthrbg_citystate_search`.`ISACTIVE`="1" 
                    AND (`wthrbg_citystate_search`.`DATESEARCHSYNC` IS NULL OR DATE_SUB(CURDATE(), INTERVAL 2 WEEK) >= `wthrbg_citystate_search`.`DATESEARCHSYNC`)
                    ORDER BY `wthrbg_citystate_search`.`DATESEARCHSYNC` ASC,`wthrbg_citystate_search`.`ZG_STATE`,`wthrbg_citystate_search`.`ZG_CITY` LIMIT 1025;
                    ';

                    //error_log('2104 database call main SELECT...');
                    $oDB_RESP->process(self::$mysqli, $queryType, $tmp_SELECT_ARRAY);

                    //error_log('2106 database KEYBYID main SELECT...');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'STATE_PROVINCE', 'POSTAL');  # POSTAL = GA
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'LOCALE_SEARCH', 'ZG_GEO_ID');
                    //error_log('2108 database we finish KEYBYID main SELECT!');

                    //
                    // RESET PREVIOUS RESULT SET SITUATION OF CONNECTION OBJECT
                    do{
                    } while (self::$mysqli->more_results() && self::$mysqli->next_result());

                    //
                    // TRUNCATE LOOKUP TABLE - PUT THIS IN SEPARATE JOB
                    //error_log('2116 database TRUNCATE search table...');
                    //self::$query = 'TRUNCATE `wthrbg_citystate_search`;';

                    //self::$result = $oEnv->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
                    self::$query = '';

                    $tmp_locale_cnt = $oDB_RESP->return_sizeof($oDB_RESP->return_serial(), 'ZIPCODE_GEO');

                    for($i=0;$i<$tmp_locale_cnt;$i++){

                        //
                        // HANDS ON LOCALE DATA
                        #zipcode_geo_CITY
                        #zipcode_geo_STATE = GA
                        #zipcode_geo_GEOPOINT = 32.790622,-80.38489
                        $zipcode_geo_GEO_ID = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'ZIPCODE_GEO', 'GEO_ID', $i);
                        $zipcode_geo_CITY = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'ZIPCODE_GEO', 'CITY', $i);
                        $zipcode_geo_STATE = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'ZIPCODE_GEO', 'STATE', $i);
                        $zipcode_geo_ZIPCODE = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'ZIPCODE_GEO', 'ZIPCODE', $i);
                        $zipcode_geo_GEOPOINT = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'ZIPCODE_GEO', 'GEOPOINT', $i);

                        $sprov_POSTAL = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'STATE_PROVINCE', $zipcode_geo_STATE, 'POSTAL');
                        $sprov_NAME = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'STATE_PROVINCE', $zipcode_geo_STATE, 'NAME');
                        $sprov_GEOPOINT = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'STATE_PROVINCE', $zipcode_geo_STATE, 'GEOPOINT');
                        $sprov_WIKIPEDIA = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'STATE_PROVINCE', $zipcode_geo_STATE, 'WIKIPEDIA');
                        $sprov_NAME_ALT = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'STATE_PROVINCE', $zipcode_geo_STATE, 'NAME_ALT');
                        $sprov_ABBREV = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'STATE_PROVINCE', $zipcode_geo_STATE, 'ABBREV');

                        $citystate_SEARCH_ID = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'LOCALE_SEARCH', $zipcode_geo_GEO_ID, 'SEARCH_ID');

                        $tmp_SEARCH_CONTENT_CITY = $oUser->searchCleanStr($zipcode_geo_CITY);
                        $tmp_SEARCH_CONTENT_STATE = $oUser->searchCleanStr($zipcode_geo_STATE.$sprov_POSTAL.$sprov_NAME.$sprov_NAME_ALT.$sprov_ABBREV);

                        if(strlen($citystate_SEARCH_ID)<60){  #char(70)

                            $tmp_search_id = $oUser->generateNewKey(70);
                            self::$query .= 'INSERT INTO `wthrbg_citystate_search`
                            (`SEARCH_ID`,
                            `SEARCH_ID_CRC32`,
                            `SEARCH_CONTENT_CITY`,
                            `SEARCH_CONTENT_STATE`,
                            `ZG_CITY`,
                            `ZG_STATE`,
                            `ZG_ZIPCODE`,
                            `ZG_GEO_ID`,
                            `ZG_GEOPOINT`,
                            `SPROV_POSTAL`,
                            `SPROV_NAME`,
                            `SPROV_GEOPOINT`,
                            `SPROV_WIKIPEDIA`,
                            `SPROV_NAME_ALT`,
                            `SPROV_ABBREV`,
                            `DATESEARCHSYNC`,
                            `DATEMODIFIED`)
                            VALUES
                            ("'.$tmp_search_id.'",
                            "'.crc32($tmp_search_id).'",
                            "'.self::$mysqli->real_escape_string($tmp_SEARCH_CONTENT_CITY).'",
                            "'.self::$mysqli->real_escape_string($tmp_SEARCH_CONTENT_STATE).'",
                            "'.self::$mysqli->real_escape_string($zipcode_geo_CITY).'",
                            "'.self::$mysqli->real_escape_string($zipcode_geo_STATE).'",
                            "'.self::$mysqli->real_escape_string($zipcode_geo_ZIPCODE).'",
                            "'.self::$mysqli->real_escape_string($zipcode_geo_GEO_ID).'",
                            "'.self::$mysqli->real_escape_string($zipcode_geo_GEOPOINT).'",
                            "'.self::$mysqli->real_escape_string($sprov_POSTAL).'",
                            "'.self::$mysqli->real_escape_string($sprov_NAME).'",
                            "'.self::$mysqli->real_escape_string($sprov_GEOPOINT).'",
                            "'.self::$mysqli->real_escape_string($sprov_WIKIPEDIA).'",
                            "'.self::$mysqli->real_escape_string($sprov_NAME_ALT).'",
                            "'.self::$mysqli->real_escape_string($sprov_ABBREV).'",
                            "'.$ts.'",
                            "'.$ts.'");
                            ';

                        }else{

                            self::$query .= 'UPDATE `wthrbg_citystate_search`
                            SET
                            `SEARCH_CONTENT_CITY` = "'.self::$mysqli->real_escape_string($tmp_SEARCH_CONTENT_CITY).'",
                            `SEARCH_CONTENT_STATE` = "'.self::$mysqli->real_escape_string($tmp_SEARCH_CONTENT_STATE).'",
                            `ZG_CITY` = "'.self::$mysqli->real_escape_string($zipcode_geo_CITY).'",
                            `ZG_STATE` = "'.self::$mysqli->real_escape_string($zipcode_geo_STATE).'",
                            `ZG_ZIPCODE` = "'.self::$mysqli->real_escape_string($zipcode_geo_ZIPCODE).'",
                            `ZG_GEOPOINT` = "'.self::$mysqli->real_escape_string($zipcode_geo_GEOPOINT).'",
                            `SPROV_POSTAL` = "'.self::$mysqli->real_escape_string($sprov_POSTAL).'",
                            `SPROV_NAME` = "'.self::$mysqli->real_escape_string($sprov_NAME).'",
                            `SPROV_GEOPOINT` = "'.self::$mysqli->real_escape_string($sprov_GEOPOINT).'",
                            `SPROV_WIKIPEDIA` = "'.self::$mysqli->real_escape_string($sprov_WIKIPEDIA).'",
                            `SPROV_NAME_ALT` = "'.self::$mysqli->real_escape_string($sprov_NAME_ALT).'",
                            `SPROV_ABBREV` = "'.self::$mysqli->real_escape_string($sprov_ABBREV).'",
                            `DATESEARCHSYNC`= "'.$ts.'",
                            `DATEMODIFIED` = "'.$ts.'"
                            WHERE `SEARCH_ID` = "'.$citystate_SEARCH_ID.'"
                            AND `SEARCH_ID_CRC32` = "'.crc32($citystate_SEARCH_ID).'"
                            LIMIT 1;
                            ';

                        }

                        self::$query .= 'UPDATE `wthrbg_zipcode_geo`
                        SET
                        `DATESEARCHSYNC` = "'.$ts.'"
                        WHERE `GEO_ID` = "'.$zipcode_geo_GEO_ID.'" 
                        AND `GEO_ID_CRC32` = "'.crc32($zipcode_geo_GEO_ID).'" 
                        LIMIT 1;
                        ';

                    }

                    //
                    // EXECUTE QUERY
                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        self::$query_exception_result = "error";
                        throw new Exception('Wethrbug database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }

                    return $tmp_locale_cnt.' @ '.$ts;
                    
                break;  
                case 'us_state_province_data_sync':

                    #self::$db_response_serial_handle_ARRAY[] = 'US_STATE_PROV';
                    #self::$http_param_handle["US_STATE_PROV_DATA"] = $tmp_endpoint_response_ARRAY[1];
                    #self::$http_param_handle["RAW_RESPONSE_LENGTH"] = $tmp_str_len;

                    /*
                     ## Geo Point;
                     * Geo Shape;
                     * scalerank;
                     * featurecla;
                     * Adm1 Code;
                     * Diss Me;
                     * Adm1 Cod 1;
                     * Iso 3166 2;
                     ## wikipedia;
                     * Sr Sov A3;
                     * Sr Adm0 A3;
                     * Iso A2;
                     * Adm0 Sr;
                     * Admin0 Lab;
                     ## name;
                     ## Name Alt;
                     * Name Local;
                     ## type;
                     * Type En;
                     * Code Local;
                     * Code Hasc;
                     * note;
                     * Hasc Maybe;
                     ## region;
                     * Region Cod;
                     ## Region Big;
                     * Big Code;
                     * Provnum Ne;
                     * Gadm Level;
                     * Check Me;
                     * Scaleran 1;
                     * datarank;
                     ## abbrev;
                     ## postal;
                     * Area Sqkm;
                     * sameascity;
                     * labelrank;
                     * Featurec 1;
                     * admin;
                     * Name Len;
                     * mapcolor9;
                     * mapcolor13

                     * */


                    self::$query = '';
                    $tmp_geo_state_province_array = array();
                    $tmp_csv_record_count = 0;
                    $tmp_hash_algo = $oEnv->getEnvParam('COPY_HASH_ALGO');
                    $tmp_delim = $oEnv->getEnvParam('US_STATE_PROV_CSV_FIELD_DELIM');
                    $tmp_field_header = $oEnv->getEnvParam('US_STATE_PROV_CSV_RESP_HEADER_DELIM');

                    $oUser->record_change_csv_line_us_geo_zip($tmp_field_header);
                    $tmp_raw_csv_response_data = $oUser->retrieve_Form_Data('US_STATE_PROV_DATA');
                    $tmp_raw_response_length = $oUser->retrieve_Form_Data('RAW_RESPONSE_LENGTH');

                    //
                    // WE NEED TO QUERY THE DATABASE TO MAKE CSV_LINE/DB_ROW COMPARISONS FOR THE PURPOSE OF INSERT/UPDATE
                    $force_profile_select_align = true;
                    $db_resp_process_serial = "!jesus_is_my_dear_lord!";        # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();         //$oUser->return_serial_handle();
                    $db_resp_target_profiles = 'GEO_STATE_PROV';                 # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '5';                          # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION :: GET ALL USERS. ALL USER-CLIENT RELATIONS. AND CLIENT DATA.
                    $tmp_SELECT_ARRAY = array();

                    // GEO_STATE_PROV
                    $tmp_SELECT_ARRAY[0] = 'SELECT `wthrbg_state_province`.`STATE_ID`,
                        `wthrbg_state_province`.`POSTAL`,
                        `wthrbg_state_province`.`STATE_PROV_CHECKSUM`,
                        `wthrbg_state_province`.`STATE_PROV_RAW_LINE`,
                        `wthrbg_state_province`.`UPDATE_COUNT`
                    FROM `wthrbg_state_province`
                    WHERE `wthrbg_state_province`.`ISACTIVE`="1";
';

                    $oDB_RESP->process(self::$mysqli,$queryType, $tmp_SELECT_ARRAY);

                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'GEO_STATE_PROV', 'POSTAL');

                    $tmp_mem = $oUser->get_server_memory_usage();
                    //self::$oLogger->captureNotice('database.inc.php', LOG_NOTICE, 'Database SELECT * from wthrbg_state_province complete in memory ['.$tmp_mem.'].');

                    //
                    // RESET PREVIOUS RESULT SET SITUATION OF CONNECTION OBJECT
                    do{
                    } while (self::$mysqli->more_results() && self::$mysqli->next_result());

                    //
                    // AS WE ITERATE THROUGH CSV FILE, LET'S BATCH MYSQL INSERTS/UPDATES TO KEEP MEMORY REQUIREMENTS LOW
                    $tmp_delta_cnt = 0;
                    $tmp_batch_count = $perm_batch_count = $tmp_batch_count = 0;
                    $tmp_csv_record_cnt = sizeof($tmp_geo_state_province_array);
                    $tmp_max_batch = $oEnv->getEnvParam('MYSQLI_MAX_QUERY_BATCH_COUNT');

                    // SOURCE :: https://stackoverflow.com/questions/1462720/iterate-over-each-line-in-a-string-in-php
                    // AUTHOR :: https://stackoverflow.com/users/118898/kyril
                    foreach(preg_split("/((\r?\n)|(\r\n?))/", $tmp_raw_csv_response_data) as $str_line){

                        if($str_line!=""){
                            $tmp_csv_record_count++;
                            $tmp_geo_state_province_array = $oUser->process_new_line_us_state_province($str_line, $tmp_hash_algo, $tmp_delim);

                            //
                            // IS THERE A CHECKSUM DIFFERENCE?
                            if($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'GEO_STATE_PROV', $tmp_geo_state_province_array['RAW_POSTAL'], 'STATE_PROV_CHECKSUM') != $tmp_geo_state_province_array['STATE_PROV_CHECKSUM']){
                                $tmp_delta_cnt++;
                                $tmp_batch_count++;

                                //
                                // RECORD IS EITHER NEW OR UPDATED.
                                if($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'GEO_STATE_PROV', $tmp_geo_state_province_array['RAW_POSTAL'], 'STATE_PROV_CHECKSUM')==''){

                                    $tmp_state_id = $oUser->generateNewKey(70);

                                    //
                                    // NEW RECORD
                                    self::$query .= 'INSERT INTO `wthrbg_state_province`
                                    (`STATE_ID`,
                                    `POSTAL`,
                                    `POSTAL_CRC32`,
                                    `NAME`,
                                    `GEOPOINT`,
                                    `WIKIPEDIA`,
                                    `NAME_ALT`,
                                    `TYPE`,
                                    `REGION`,
                                    `REGION_BIG`,
                                    `ABBREV`,
                                    `STATE_PROV_CHECKSUM`,
                                    `STATE_PROV_RAW_LINE`,
                                    `RAW_RESPONSE_LENGTH`,
                                    `DATEMODIFIED`)
                                    VALUES
                                    ("'.$tmp_state_id.'",
                                    "'.self::$mysqli->real_escape_string($tmp_geo_state_province_array['RAW_POSTAL']).'",
                                    "'.crc32($tmp_geo_state_province_array['RAW_POSTAL']).'",
                                    "'.self::$mysqli->real_escape_string($tmp_geo_state_province_array['RAW_NAME']).'",
                                    "'.self::$mysqli->real_escape_string($tmp_geo_state_province_array['RAW_GEOPOINT']).'",
                                    "'.self::$mysqli->real_escape_string($tmp_geo_state_province_array['RAW_WIKIPEDIA']).'",
                                    "'.self::$mysqli->real_escape_string($tmp_geo_state_province_array['RAW_NAME_ALT']).'",
                                    "'.self::$mysqli->real_escape_string($tmp_geo_state_province_array['RAW_TYPE']).'",
                                    "'.self::$mysqli->real_escape_string($tmp_geo_state_province_array['RAW_REGION']).'",
                                    "'.self::$mysqli->real_escape_string($tmp_geo_state_province_array['RAW_REGION_BIG']).'",
                                    "'.self::$mysqli->real_escape_string($tmp_geo_state_province_array['RAW_ABBREV']).'",
                                    "'.$tmp_geo_state_province_array['STATE_PROV_CHECKSUM'].'",
                                    "'.self::$mysqli->real_escape_string($tmp_geo_state_province_array['RAW_STATE_PROV_RAW_LINE']).'",
                                    "'.$tmp_raw_response_length.'",
                                    "'.$ts.'");
                                    ';

                                    $oUser->record_change_csv_line_us_state_prov($tmp_geo_state_province_array['RAW_STATE_PROV_RAW_LINE']);

                                }else{

                                    //
                                    // UPDATE RECORD
                                    $tmp_state_id = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'GEO_STATE_PROV', $tmp_geo_state_province_array['RAW_POSTAL'], 'STATE_ID');
                                    $tmp_update_cnt = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'GEO_STATE_PROV', $tmp_geo_state_province_array['RAW_POSTAL'], 'UPDATE_COUNT');
                                    $tmp_update_cnt++;

                                    self::$query .= 'UPDATE `wthrbg_state_province`
                                    SET
                                    `POSTAL` = "'.self::$mysqli->real_escape_string($tmp_geo_state_province_array['RAW_POSTAL']).'",
                                    `POSTAL_CRC32` = "'.crc32($tmp_geo_state_province_array['RAW_POSTAL']).'",
                                    `NAME` = "'.self::$mysqli->real_escape_string($tmp_geo_state_province_array['RAW_NAME']).'",
                                    `GEOPOINT` = "'.self::$mysqli->real_escape_string($tmp_geo_state_province_array['RAW_GEOPOINT']).'",
                                    `WIKIPEDIA` = "'.self::$mysqli->real_escape_string($tmp_geo_state_province_array['RAW_WIKIPEDIA']).'",
                                    `NAME_ALT` = "'.self::$mysqli->real_escape_string($tmp_geo_state_province_array['RAW_NAME_ALT']).'",
                                    `TYPE` = "'.self::$mysqli->real_escape_string($tmp_geo_state_province_array['RAW_TYPE']).'",
                                    `REGION` = "'.self::$mysqli->real_escape_string($tmp_geo_state_province_array['RAW_REGION']).'",
                                    `REGION_BIG` = "'.self::$mysqli->real_escape_string($tmp_geo_state_province_array['RAW_REGION_BIG']).'",
                                    `ABBREV` = "'.self::$mysqli->real_escape_string($tmp_geo_state_province_array['RAW_ABBREV']).'",
                                    `STATE_PROV_CHECKSUM` = "'.$tmp_geo_state_province_array['STATE_PROV_CHECKSUM'].'",
                                    `STATE_PROV_RAW_LINE` = "'.self::$mysqli->real_escape_string($tmp_geo_state_province_array['RAW_STATE_PROV_RAW_LINE']).'",
                                    `RAW_RESPONSE_LENGTH` = "'.$tmp_raw_response_length.'",
                                    `UPDATE_COUNT` = "'.$tmp_update_cnt.'",
                                    `DATEMODIFIED` = "'.$ts.'"
                                    WHERE `STATE_ID` = "'.$tmp_state_id.'"
                                    AND `POSTAL` = "'.self::$mysqli->real_escape_string($tmp_geo_state_province_array['RAW_POSTAL']).'"
                                    AND `POSTAL_CRC32` = "'.crc32($tmp_geo_state_province_array['RAW_POSTAL']).'"
                                    LIMIT 1
                                    ;
                                    ';

                                    $oUser->record_change_csv_line_us_state_prov($tmp_geo_state_province_array['RAW_STATE_PROV_RAW_LINE']);

                                }

                                //
                                // BATCH QUERIES AT x PER REQUEST
                                if(($tmp_batch_count+1)>$tmp_max_batch){

                                    $perm_batch_count++;

                                    //
                                    // EXECUTE QUERY
                                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                                    if(self::$mysqli->error){
                                        self::$query_exception_result = "error";
                                        throw new Exception('Wethrbug database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                                    }

                                    //
                                    // RESET PREVIOUS RESULT SET SITUATION OF CONNECTION OBJECT
                                    do{
                                    } while (self::$mysqli->more_results() && self::$mysqli->next_result());

                                    $tmp_batch_count = 0;
                                    self::$query = '';

                                    $tmp_mem = $oUser->get_server_memory_usage();
                                    //self::$oLogger->captureNotice('database.inc.php', LOG_NOTICE, 'Batch ['.$perm_batch_count.'] processing in memory ['.$tmp_mem.'].');


                                }

                            }
                        }

                    }

                    if($tmp_delta_cnt<2 || $tmp_batch_count<2){

                        if(self::$query!=''){
                            $last_batch_cnt = $tmp_batch_count;

                            self::$result = $oEnv->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);

                            if(self::$mysqli->error){
                                self::$query_exception_result = "error";
                                throw new Exception('Wethrbug database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                            }

                        }else{


                            //
                            // CLEAR OUT /NEW/ DIRECTORY
                            $oUser->remove_new_us_state_prov_csv();

                            return 'success - no mysql delta to csv source';
                        }

                    }else {

                        if ($tmp_batch_count > 0) {
                            $last_batch_cnt = $tmp_batch_count;

                            //
                            // EXECUTE QUERY
                            self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                            if (self::$mysqli->error) {
                                self::$query_exception_result = "error";
                                throw new Exception('Wethrbug database_integration :: ' . $queryType . ' ERROR :: [' . self::$mysqli->error . ']');

                            }
                        }

                    }

                    //
                    // LOG DELTAS TO FILE
                    $oUser->log_csv_deltas_to_us_state_prov();

                    //
                    // CLEAR OUT /NEW/ DIRECTORY
                    $oUser->remove_new_us_state_prov_csv();

                    self::$oLogger->captureNotice('user->sync_us_geo_zipcode_data()', LOG_NOTICE, 'success['.$tmp_delta_cnt.' out of '.sizeof($tmp_geo_state_province_array).'] in '.$oEnv->wallTime().' seconds at '.date("Y-m-d H:i:s", time()).'.');
                    return '<h2 style="padding:20px;"><b>'.$perm_batch_count.' batche(s) of query count [maxsize='.$tmp_max_batch.'] records [last batchsize='.$last_batch_cnt.'] touched ['.$tmp_delta_cnt.' out of '.$tmp_csv_record_count.'] in '.$oEnv->wallTime().' seconds at '.date("Y-m-d H:i:s", time()).'.</b></h2>';

                break;
                case 'us_geo_zip_data_sync':

                    self::$query = '';
                    $tmp_geo_zip_array = array();
                    $tmp_csv_record_count = 0;
                    $tmp_hash_algo = $oEnv->getEnvParam('COPY_HASH_ALGO');
                    $tmp_delim = $oEnv->getEnvParam('US_GOV_ZIPCODE_CSV_FIELD_DELIM');
                    $tmp_field_header = $oEnv->getEnvParam('US_GOV_ZIPCODE_CSV_RESP_HEADER_DELIM');

                    $oUser->record_change_csv_line_us_geo_zip($tmp_field_header);
                    $tmp_raw_csv_response_data = $oUser->retrieve_Form_Data('US_GEO_ZIP_DATA');
                    $tmp_raw_response_length = $oUser->retrieve_Form_Data('RAW_RESPONSE_LENGTH');

                    //
                    // WE NEED TO QUERY THE DATABASE TO MAKE CSV_LINE/DB_ROW COMPARISONS FOR THE PURPOSE OF INSERT/UPDATE
                    $force_profile_select_align = true;
                    $db_resp_process_serial = "!jesus_is_my_dear_lord!";        # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();         //$oUser->return_serial_handle();
                    $db_resp_target_profiles = 'GEO_ZIP';                 # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '4';                          # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION :: GET ALL USERS. ALL USER-CLIENT RELATIONS. AND CLIENT DATA.
                    $tmp_SELECT_ARRAY = array();

                    // GEO_ZIP
                    $tmp_SELECT_ARRAY[0] = 'SELECT `wthrbg_zipcode_geo`.`GEO_ID`,
                        `wthrbg_zipcode_geo`.`ZIPCODE`,
                        `wthrbg_zipcode_geo`.`GEOZIP_CHECKSUM`,
                        `wthrbg_zipcode_geo`.`UPDATE_COUNT`
                    FROM `wthrbg_zipcode_geo`
                    WHERE `wthrbg_zipcode_geo`.`ISACTIVE`="1";
';

                    $oDB_RESP->process(self::$mysqli,$queryType, $tmp_SELECT_ARRAY);

                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'GEO_ZIP', 'ZIPCODE');

                    $tmp_mem = $oUser->get_server_memory_usage();
                    //self::$oLogger->captureNotice('database.inc.php', LOG_NOTICE, 'Database SELECT * from wthrbg_zipcode_geo complete in memory ['.$tmp_mem.'].');

                    //
                    // RESET PREVIOUS RESULT SET SITUATION OF CONNECTION OBJECT
                    do{
                    } while (self::$mysqli->more_results() && self::$mysqli->next_result());

                    //
                    // AS WE ITERATE THROUGH CSV FILE, LET'S BATCH MYSQL INSERTS/UPDATES TO KEEP MEMORY REQUIREMENTS LOW
                    $tmp_delta_cnt = 0;
                    $tmp_batch_count = $perm_batch_count = $tmp_batch_count = 0;
                    $tmp_csv_record_cnt = sizeof($tmp_geo_zip_array);
                    $tmp_max_batch = $oEnv->getEnvParam('MYSQLI_MAX_QUERY_BATCH_COUNT');

                    // SOURCE :: https://stackoverflow.com/questions/1462720/iterate-over-each-line-in-a-string-in-php
                    // AUTHOR :: https://stackoverflow.com/users/118898/kyril
                    foreach(preg_split("/((\r?\n)|(\r\n?))/", $tmp_raw_csv_response_data) as $str_line){

                        if($str_line!=""){

                            $tmp_csv_record_count++;
                            $tmp_geo_zip_array = $oUser->process_new_line_us_geo_zip($str_line, $tmp_hash_algo, $tmp_delim);

                            //
                            // IS THERE A CHECKSUM DIFFERENCE?
                            if($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'GEO_ZIP', $tmp_geo_zip_array['RAW_ZIPCODE'], 'GEOZIP_CHECKSUM') != $tmp_geo_zip_array['GEOZIP_CHECKSUM']){
                                $tmp_delta_cnt++;
                                $tmp_batch_count++;

                                //
                                // RECORD IS EITHER NEW OR UPDATED.
                                if($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'GEO_ZIP', $tmp_geo_zip_array['RAW_ZIPCODE'], 'GEOZIP_CHECKSUM')==''){

                                    $tmp_geo_id = $oUser->generateNewKey(70);

                                    //
                                    // NEW RECORD
                                    self::$query .= 'INSERT INTO `wthrbg_zipcode_geo`
                                    (`GEO_ID`,
                                    `GEO_ID_CRC32`,
                                    `ZIPCODE`,
                                    `ZIPCODE_CRC32`,
                                    `CITY`,
                                    `STATE`,
                                    `LATITUDE_STR`,
                                    `LONGITUDE_STR`,
                                    `LATITUDE_FLOAT`,
                                    `LONGITUDE_FLOAT`,
                                    `TIMEZONE`,
                                    `DAYLIGHT_SAVINGS`,
                                    `GEOPOINT`,
                                    `GEOZIP_CHECKSUM`,
                                    `GEOZIP_RAW_LINE`,
                                    `RAW_RESPONSE_LENGTH`,
                                    `DATEMODIFIED`)
                                    VALUES
                                    ("'.$tmp_geo_id.'",
                                    "'.crc32($tmp_geo_id).'",
                                    "'.self::$mysqli->real_escape_string($tmp_geo_zip_array['RAW_ZIPCODE']).'",
                                    "'.crc32($tmp_geo_zip_array['RAW_ZIPCODE']).'",
                                    "'.self::$mysqli->real_escape_string($tmp_geo_zip_array['RAW_CITY']).'",
                                    "'.self::$mysqli->real_escape_string($tmp_geo_zip_array['RAW_STATE']).'",
                                    "'.self::$mysqli->real_escape_string($tmp_geo_zip_array['RAW_LATITUDE']).'",
                                    "'.self::$mysqli->real_escape_string($tmp_geo_zip_array['RAW_LONGITUDE']).'",
                                    "'.self::$mysqli->real_escape_string($tmp_geo_zip_array['RAW_LATITUDE']).'",
                                    "'.self::$mysqli->real_escape_string($tmp_geo_zip_array['RAW_LONGITUDE']).'",
                                    "'.self::$mysqli->real_escape_string($tmp_geo_zip_array['RAW_TIMEZONE']).'",
                                    "'.self::$mysqli->real_escape_string($tmp_geo_zip_array['RAW_DST_FLAG']).'",
                                    "'.self::$mysqli->real_escape_string($tmp_geo_zip_array['RAW_GEOPOINT']).'",
                                    "'.$tmp_geo_zip_array['GEOZIP_CHECKSUM'].'",
                                    "'.self::$mysqli->real_escape_string($tmp_geo_zip_array['RAW_GEOZIP_RAW_LINE']).'",
                                    "'.$tmp_raw_response_length.'",
                                    "'.$ts.'");
                                    ';

                                    $oUser->record_change_csv_line_us_geo_zip($tmp_geo_zip_array['RAW_GEOZIP_RAW_LINE']);

                                }else{

                                    //
                                    // UPDATE RECORD
                                    $tmp_geo_id = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'GEO_ZIP', $tmp_geo_zip_array['RAW_ZIPCODE'], 'GEO_ID');
                                    $tmp_update_cnt = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'GEO_ZIP', $tmp_geo_zip_array['RAW_ZIPCODE'], 'UPDATE_COUNT');
                                    $tmp_update_cnt++;

                                    self::$query .= 'UPDATE `wthrbg_zipcode_geo`
                                    SET
                                    `ZIPCODE` = "'.self::$mysqli->real_escape_string($tmp_geo_zip_array['RAW_ZIPCODE']).'",
                                    `ZIPCODE_CRC32` = "'.crc32($tmp_geo_zip_array['RAW_ZIPCODE']).'",
                                    `CITY` = "'.self::$mysqli->real_escape_string($tmp_geo_zip_array['RAW_CITY']).'",
                                    `STATE` = "'.self::$mysqli->real_escape_string($tmp_geo_zip_array['RAW_STATE']).'",
                                    `LATITUDE_STR` = "'.self::$mysqli->real_escape_string($tmp_geo_zip_array['RAW_LATITUDE']).'",
                                    `LONGITUDE_STR` = "'.self::$mysqli->real_escape_string($tmp_geo_zip_array['RAW_LONGITUDE']).'",
                                    `LATITUDE_FLOAT` = "'.self::$mysqli->real_escape_string($tmp_geo_zip_array['RAW_LATITUDE']).'",
                                    `LONGITUDE_FLOAT` = "'.self::$mysqli->real_escape_string($tmp_geo_zip_array['RAW_LONGITUDE']).'",
                                    `TIMEZONE` = "'.self::$mysqli->real_escape_string($tmp_geo_zip_array['RAW_TIMEZONE']).'",
                                    `DAYLIGHT_SAVINGS` = "'.self::$mysqli->real_escape_string($tmp_geo_zip_array['RAW_DST_FLAG']).'",
                                    `GEOPOINT` = "'.self::$mysqli->real_escape_string($tmp_geo_zip_array['RAW_GEOPOINT']).'",
                                    `GEOZIP_CHECKSUM` = "'.$tmp_geo_zip_array['GEOZIP_CHECKSUM'].'",
                                    `GEOZIP_RAW_LINE` = "'.self::$mysqli->real_escape_string($tmp_geo_zip_array['RAW_GEOZIP_RAW_LINE']).'",
                                    `RAW_RESPONSE_LENGTH` = "'.$tmp_raw_response_length.'",
                                    `UPDATE_COUNT` = "'.$tmp_update_cnt.'",
                                    `DATEMODIFIED` = "'.$ts.'"
                                    WHERE `GEO_ID` = "'.$tmp_geo_id.'"
                                    AND  `GEO_ID_CRC32` = "'.crc32($tmp_geo_id).'"
                                    AND `ZIPCODE` = "'.self::$mysqli->real_escape_string($tmp_geo_zip_array['RAW_ZIPCODE']).'"
                                    AND `ZIPCODE_CRC32` = "'.crc32($tmp_geo_zip_array['RAW_ZIPCODE']).'"
                                    LIMIT 1
                                    ;
                                    ';

                                    $oUser->record_change_csv_line_us_geo_zip($tmp_geo_zip_array['RAW_GEOZIP_RAW_LINE']);

                                }

                                //
                                // BATCH QUERIES AT x PER REQUEST
                                if(($tmp_batch_count+1)>$tmp_max_batch){

                                    $perm_batch_count++;

                                    //
                                    // EXECUTE QUERY
                                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                                    if(self::$mysqli->error){
                                        self::$query_exception_result = "error";
                                        throw new Exception('Wethrbug database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                                    }

                                    //
                                    // RESET PREVIOUS RESULT SET SITUATION OF CONNECTION OBJECT
                                    do{
                                    } while (self::$mysqli->more_results() && self::$mysqli->next_result());

                                    $tmp_batch_count = 0;
                                    self::$query = '';

                                    $tmp_mem = $oUser->get_server_memory_usage();
                                    //self::$oLogger->captureNotice('database.inc.php', LOG_NOTICE, 'Batch ['.$perm_batch_count.'] processing in memory ['.$tmp_mem.'].');


                                }

                            }
                        }

                    }

                    if($tmp_delta_cnt<2 || $tmp_batch_count<2){

                        if(self::$query!=''){
                            $last_batch_cnt = $tmp_batch_count;

                            self::$result = $oEnv->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);

                            if(self::$mysqli->error){
                                self::$query_exception_result = "error";
                                throw new Exception('Wethrbug database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                            }

                        }else{


                            //
                            // CLEAR OUT /NEW/ DIRECTORY
                            $oUser->remove_new_us_geo_zip_csv();

                            return 'success - no mysql delta to csv source';
                        }

                    }else {

                        if ($tmp_batch_count > 0) {
                            $last_batch_cnt = $tmp_batch_count;

                            //
                            // EXECUTE QUERY
                            self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                            if (self::$mysqli->error) {
                                self::$query_exception_result = "error";
                                throw new Exception('Wethrbug database_integration :: ' . $queryType . ' ERROR :: [' . self::$mysqli->error . ']');

                            }
                        }

                    }

                    //
                    // LOG DELTAS TO FILE
                    $oUser->log_csv_deltas_to_us_geo_zip();

                    //
                    // CLEAR OUT /NEW/ DIRECTORY
                    $oUser->remove_new_us_geo_zip_csv();

                    self::$oLogger->captureNotice('user->sync_us_geo_zipcode_data()', LOG_NOTICE, 'success['.$tmp_delta_cnt.' out of '.sizeof($tmp_geo_zip_array).'] in '.$oEnv->wallTime().' seconds at '.date("Y-m-d H:i:s", time()).'.');
                    return '<h2 style="padding:20px;"><b>'.$perm_batch_count.' batche(s) of query count [maxsize='.$tmp_max_batch.'] records [last batchsize='.$last_batch_cnt.'] touched ['.$tmp_delta_cnt.' out of '.$tmp_csv_record_count.'] in '.$oEnv->wallTime().' seconds at '.date("Y-m-d H:i:s", time()).'.</b></h2>';

                break;
                case 'processWethrbug_zip_submit':

                    $force_profile_select_align = true;
                    $db_resp_process_serial = "!jesus_is_my_dear_lord!";        # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();         //$oUser->return_serial_handle();
                    $db_resp_target_profiles = 'GEO_ZIP_DATA|STATE_PROVINCE';                 # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '18|16';                          # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    /*
                     * self::$http_param_handle["ZIPCODE"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'zipcode'));
                    self::$http_param_handle["MOBILENUMBER"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'mobilenumber'));
                    self::$http_param_handle["POSTID"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'postid');
                    self::$http_param_handle["ACTION_TYPE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'action_type');
                    self::$http_param_handle["LANG_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'LANG_ID'));
                    */

                    $tmp_ZIPCODE = $oUser->retrieve_Form_Data('ZIPCODE');
                    $tmp_MOBILENUMBER = $oUser->retrieve_Form_Data('MOBILENUMBER');
                    $tmp_LANG_ID = $oUser->retrieve_Form_Data('LANG_ID');
                    $tmp_ACTION_TYPE = $oUser->retrieve_Form_Data('ACTION_TYPE');
                    $tmp_CITY_PROVINCE = $oUser->retrieve_Form_Data('CITY_PROVINCE');

                    if($tmp_CITY_PROVINCE!="" && $tmp_ZIPCODE==""){

                        //
                        // PROCESS BEST CASE FOR CITY STATE UGC DATA

                    }else{

                        if($tmp_ZIPCODE!=""){

                            //
                            // QUERY CONSTRUCTION :: GET ALL USERS. ALL USER-CLIENT RELATIONS. AND CLIENT DATA.
                            $tmp_SELECT_ARRAY = array();

                            // GEO_ZIP_DATA
                            $tmp_SELECT_ARRAY[0] = 'SELECT `wthrbg_zipcode_geo`.`GEO_ID`,
                                `wthrbg_zipcode_geo`.`ZIPCODE`,
                                `wthrbg_zipcode_geo`.`CITY`,
                                `wthrbg_zipcode_geo`.`STATE`,
                                `wthrbg_zipcode_geo`.`ISACTIVE`,
                                `wthrbg_zipcode_geo`.`LATITUDE_STR`,
                                `wthrbg_zipcode_geo`.`LONGITUDE_STR`,
                                `wthrbg_zipcode_geo`.`LATITUDE_FLOAT`,
                                `wthrbg_zipcode_geo`.`LONGITUDE_FLOAT`,
                                `wthrbg_zipcode_geo`.`TIMEZONE`,
                                `wthrbg_zipcode_geo`.`DAYLIGHT_SAVINGS`,
                                `wthrbg_zipcode_geo`.`GEOPOINT`,
                                `wthrbg_zipcode_geo`.`GEOZIP_CHECKSUM`,
                                `wthrbg_zipcode_geo`.`GEOZIP_RAW_LINE`,
                                `wthrbg_zipcode_geo`.`RAW_RESPONSE_LENGTH`,
                                `wthrbg_zipcode_geo`.`UPDATE_COUNT`,
                                `wthrbg_zipcode_geo`.`DATEMODIFIED`,
                                `wthrbg_zipcode_geo`.`DATECREATED`
                            FROM `wthrbg_zipcode_geo`
                            WHERE `wthrbg_zipcode_geo`.`ISACTIVE`="1"
                            AND `wthrbg_zipcode_geo`.`ZIPCODE`= "'.self::$mysqli->real_escape_string($tmp_ZIPCODE).'"
                            AND `wthrbg_zipcode_geo`.`ZIPCODE_CRC32`= "'.crc32($tmp_ZIPCODE).'"
                            ;
                            ';

                            //
                            // STATE_PROVINCE
                            $tmp_SELECT_ARRAY[1] = 'SELECT `wthrbg_state_province`.`STATE_ID`,
                                `wthrbg_state_province`.`POSTAL`,
                                `wthrbg_state_province`.`NAME`,
                                `wthrbg_state_province`.`GEOPOINT`,
                                `wthrbg_state_province`.`WIKIPEDIA`,
                                `wthrbg_state_province`.`NAME_ALT`,
                                `wthrbg_state_province`.`TYPE`,
                                `wthrbg_state_province`.`REGION`,
                                `wthrbg_state_province`.`REGION_BIG`,
                                `wthrbg_state_province`.`ABBREV`,
                                `wthrbg_state_province`.`STATE_PROV_CHECKSUM`,
                                `wthrbg_state_province`.`STATE_PROV_RAW_LINE`,
                                `wthrbg_state_province`.`RAW_RESPONSE_LENGTH`,
                                `wthrbg_state_province`.`UPDATE_COUNT`,
                                `wthrbg_state_province`.`DATEMODIFIED`,
                                `wthrbg_state_province`.`DATECREATED`
                            FROM `wthrbg_state_province`
                            WHERE `wthrbg_state_province`.`ISACTIVE`="1";
                            ';


                            $oDB_RESP->process(self::$mysqli, $queryType, $tmp_SELECT_ARRAY);

                            $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'GEO_ZIP_DATA', 'ZIPCODE');
                            $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'STATE_PROVINCE', 'POSTAL');

                            //
                            // ALL DONE, PROCESSED AND READY FOR USE. RETURN RESPONSE OBJECT.
                            return $oDB_RESP;


                        }else{

                            //
                            // NO DATA?



                        }


                    }

                    //self::$oLogger->captureNotice('database->processWethrbug_zip_submit SWITCH case', LOG_NOTICE, 'success - zipcode is '.$tmp_ZIPCODE.' at '.date("Y-m-d H:i:s", time()).'.');


                break;
                case 'get_site_activity_logs':

                    $force_profile_select_align = true;
                    $db_resp_process_serial = "!jesus_is_my_dear_lord!";        # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();         //$oUser->return_serial_handle();
                    $db_resp_target_profiles = 'LANG_PACKS|SYS_LOGS|SYSTEM_USERS|SYSTEM_USER_TYPES|OVERLAY_PAGES|OVERLAY_PROFILES_MINI|OVERLAY_PROFILES_FULLSCRN';                 # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '12|17|25|16|18|23|16';                          # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION :: GET ALL USERS. ALL USER-CLIENT RELATIONS. AND CLIENT DATA.
                    $tmp_SELECT_ARRAY = array();

                    // LANG_PACKS
                    $tmp_SELECT_ARRAY[0] = 'SELECT `wthrbg_lang_packs`.`LANGPACK_ID`,
                        `wthrbg_lang_packs`.`LANG_ID`,
                        `wthrbg_lang_packs`.`NAME`,
                        `wthrbg_lang_packs`.`NATIVE_NAME`,
                        `wthrbg_lang_packs`.`NATIVE_NAME_BLOB`,
                        `wthrbg_lang_packs`.`ISACTIVE`,
                        `wthrbg_lang_packs`.`RTL_FLAG`,
                        `wthrbg_lang_packs`.`FONT_SIZE_PERCENTAGE`,
                        `wthrbg_lang_packs`.`TIMER_FONT_SIZE_PERCENTAGE`,
                        `wthrbg_lang_packs`.`COPY_PADDING_TOP_PX`,
                        `wthrbg_lang_packs`.`DATEMODIFIED`,
                        `wthrbg_lang_packs`.`DATECREATED`
                    FROM `wthrbg_lang_packs`  
                    WHERE `wthrbg_lang_packs`.`ISACTIVE`="1";
';

                    // SYS_LOGS
                    $tmp_SELECT_ARRAY[1] = 'SELECT `wthrbg_log_sys_user`.`ACTIVITY_ID`,
                        `wthrbg_log_sys_user`.`DATECREATED`,
                        `wthrbg_log_sys_user`.`MODIFIER_ID`,
                        `wthrbg_log_sys_user`.`ELEMENT_ID`,
                        `wthrbg_log_sys_user`.`ELEMENT_REF_KEY_CRC32`,
                        `wthrbg_log_sys_user`.`OBSCLIENT_ID`,
                        `wthrbg_log_sys_user`.`FULL_SCRN_PROFILE_ID`,
                        `wthrbg_log_sys_user`.`FULL_SCRN_PAGE_ID`,
                        `wthrbg_log_sys_user`.`MINI_PROFILE_ID`,
                        `wthrbg_log_sys_user`.`COMPONENT_ID`,
                        `wthrbg_log_sys_user`.`ACTIVITY_DESCRIPTION`,
                        `wthrbg_log_sys_user`.`ACTIVITY_DESCRIPTION_BLOB`,
                        `wthrbg_log_sys_user`.`PHPSESSION`,
                        `wthrbg_log_sys_user`.`IPADDRESS_V6`,
                        `wthrbg_log_sys_user`.`IPADDRESS`,
                        `wthrbg_log_sys_user`.`HTTP_USER_AGENT`,
                        `wthrbg_log_sys_user`.`CHANNEL`
                    FROM `wthrbg_log_sys_user` ORDER BY `wthrbg_log_sys_user`.`DATECREATED` DESC LIMIT 50;
';

                    //
                    // SYSTEM_USERS
                    $tmp_SELECT_ARRAY[2] = 'SELECT `wthrbg_users`.`USERID`,
                        `wthrbg_users`.`EMAIL`,
                        `wthrbg_users`.`ISACTIVE`,
                        `wthrbg_users`.`USER_PERMISSIONS_ID`,
                        `wthrbg_users`.`FIRSTNAME`,
                        `wthrbg_users`.`FIRSTNAME_BLOB`,
                        `wthrbg_users`.`LASTNAME`,
                        `wthrbg_users`.`LASTNAME_BLOB`,
                        `wthrbg_users`.`STREAM_MENTION`,
                        `wthrbg_users`.`USER_MENTION_NOTIFICATION_ON`,
                        `wthrbg_users`.`LOCALITY_MENTION_NOTIFICATION_ON`,
                        `wthrbg_users`.`WATCH_NOTIFICATION_ON`,
                        `wthrbg_users`.`LOCALITY`,
                        `wthrbg_users`.`LOCALITY_BLOB`,
                        `wthrbg_users`.`LANGCODE`,
                        `wthrbg_users`.`LASTLOGIN`,
                        `wthrbg_users`.`LASTLOGIN_IP`,
                        `wthrbg_users`.`LOGIN_CNT`,
                        `wthrbg_users`.`IMAGE_NAME`,
                        `wthrbg_users`.`IMAGE_WIDTH`,
                        `wthrbg_users`.`IMAGE_HEIGHT`,
                        `wthrbg_users`.`ABOUT`,
                        `wthrbg_users`.`ABOUT_BLOB`,
                        `wthrbg_users`.`DATEMODIFIED`,
                        `wthrbg_users`.`DATECREATED`
                    FROM `wthrbg_users`;
                    ';

                    //
                    // SYSTEM_USER_TYPES
                    $tmp_SELECT_ARRAY[3] = 'SELECT `wthrbg_sys_user_types`.`TYPE_ID`,
                        `wthrbg_sys_user_types`.`USER_PERMISSIONS_ID`,
                        `wthrbg_sys_user_types`.`ISACTIVE`,
                        `wthrbg_sys_user_types`.`NAME`,
                        `wthrbg_sys_user_types`.`DESCRIPTION`,
                        `wthrbg_sys_user_types`.`SEQUENCE`,
                        `wthrbg_sys_user_types`.`CREATOR_ID`,
                        `wthrbg_sys_user_types`.`CREATOR_IP_V6`,
                        `wthrbg_sys_user_types`.`CREATOR_IP`,
                        `wthrbg_sys_user_types`.`CREATOR_SESSION_ID`,
                        `wthrbg_sys_user_types`.`MODIFIER_ID`,
                        `wthrbg_sys_user_types`.`MODIFIER_IP_V6`,
                        `wthrbg_sys_user_types`.`MODIFIER_IP`,
                        `wthrbg_sys_user_types`.`MODIFIER_SESSION_ID`,
                        `wthrbg_sys_user_types`.`DATEMODIFIED`,
                        `wthrbg_sys_user_types`.`DATECREATED`
                    FROM `wthrbg_sys_user_types`;
                    ';

                    //
                    // OVERLAY_PAGES
                    $tmp_SELECT_ARRAY[4] = 'SELECT `wthrbg_overlay_fullscrn_pages`.`PAGE_ID`,
                        `wthrbg_overlay_fullscrn_pages`.`PROFILE_ID`,
                        `wthrbg_overlay_fullscrn_pages`.`ISACTIVE`,
                        `wthrbg_overlay_fullscrn_pages`.`PAGE_NAME`,
                        `wthrbg_overlay_fullscrn_pages`.`PAGE_NAME_BLOB`,
                        `wthrbg_overlay_fullscrn_pages`.`BGCOLOR_HEX`,
                        `wthrbg_overlay_fullscrn_pages`.`OPACITY`,
                        `wthrbg_overlay_fullscrn_pages`.`SEQUENCE`,
                        `wthrbg_overlay_fullscrn_pages`.`CREATOR_ID`,
                        `wthrbg_overlay_fullscrn_pages`.`CREATOR_IP_V6`,
                        `wthrbg_overlay_fullscrn_pages`.`CREATOR_IP`,
                        `wthrbg_overlay_fullscrn_pages`.`CREATOR_SESSION_ID`,
                        `wthrbg_overlay_fullscrn_pages`.`MODIFIER_ID`,
                        `wthrbg_overlay_fullscrn_pages`.`MODIFIER_IP_V6`,
                        `wthrbg_overlay_fullscrn_pages`.`MODIFIER_IP`,
                        `wthrbg_overlay_fullscrn_pages`.`MODIFIER_SESSION_ID`,
                        `wthrbg_overlay_fullscrn_pages`.`DATEMODIFIED`,
                        `wthrbg_overlay_fullscrn_pages`.`DATECREATED`
                    FROM `wthrbg_overlay_fullscrn_pages`;
                    ';

                    //
                    // OVERLAY_PROFILES_MINI
                    $tmp_SELECT_ARRAY[5] = 'SELECT `wthrbg_overlay_mini_profile`.`PROFILE_ID`,
                    `wthrbg_overlay_mini_profile`.`ISACTIVE`,
                    `wthrbg_overlay_mini_profile`.`PROFILE_NAME`,
                    `wthrbg_overlay_mini_profile`.`PROFILE_NAME_BLOB`,
                    `wthrbg_overlay_mini_profile`.`OPACITY`,
                    `wthrbg_overlay_mini_profile`.`BGCOLOR_HEX`,
                    `wthrbg_overlay_mini_profile`.`OVERLAY_HEIGHT`,
                    `wthrbg_overlay_mini_profile`.`OVERLAY_WIDTH`,
                    `wthrbg_overlay_mini_profile`.`INNER_CONTENT_WIDTH`,
                    `wthrbg_overlay_mini_profile`.`MARGIN_LEFT`,
                    `wthrbg_overlay_mini_profile`.`MARGIN_RIGHT`,
                    `wthrbg_overlay_mini_profile`.`ABS_PX_FROM_TOP`,
                    `wthrbg_overlay_mini_profile`.`ABS_PX_FROM_LEFT`,
                    `wthrbg_overlay_mini_profile`.`CREATOR_ID`,
                    `wthrbg_overlay_mini_profile`.`CREATOR_IP_V6`,
                    `wthrbg_overlay_mini_profile`.`CREATOR_IP`,
                    `wthrbg_overlay_mini_profile`.`CREATOR_SESSION_ID`,
                    `wthrbg_overlay_mini_profile`.`MODIFIER_ID`,
                    `wthrbg_overlay_mini_profile`.`MODIFIER_IP_V6`,
                    `wthrbg_overlay_mini_profile`.`MODIFIER_IP`,
                    `wthrbg_overlay_mini_profile`.`MODIFIER_SESSION_ID`,
                    `wthrbg_overlay_mini_profile`.`DATEMODIFIED`,
                    `wthrbg_overlay_mini_profile`.`DATECREATED`
                FROM `wthrbg_overlay_mini_profile`;
                ';

                    //
                    // OVERLAY_PROFILES_FULLSCRN
                    $tmp_SELECT_ARRAY[6] = 'SELECT `wthrbg_overlay_fullscrn_profile`.`PROFILE_ID`,
                        `wthrbg_overlay_fullscrn_profile`.`ISACTIVE`,
                        `wthrbg_overlay_fullscrn_profile`.`PROFILE_NAME`,
                        `wthrbg_overlay_fullscrn_profile`.`PROFILE_NAME_BLOB`,
                        `wthrbg_overlay_fullscrn_profile`.`OPACITY`,
                        `wthrbg_overlay_fullscrn_profile`.`BGCOLOR_HEX`,
                        `wthrbg_overlay_fullscrn_profile`.`CREATOR_ID`,
                        `wthrbg_overlay_fullscrn_profile`.`CREATOR_IP_V6`,
                        `wthrbg_overlay_fullscrn_profile`.`CREATOR_IP`,
                        `wthrbg_overlay_fullscrn_profile`.`CREATOR_SESSION_ID`,
                        `wthrbg_overlay_fullscrn_profile`.`MODIFIER_ID`,
                        `wthrbg_overlay_fullscrn_profile`.`MODIFIER_IP_V6`,
                        `wthrbg_overlay_fullscrn_profile`.`MODIFIER_IP`,
                        `wthrbg_overlay_fullscrn_profile`.`MODIFIER_SESSION_ID`,
                        `wthrbg_overlay_fullscrn_profile`.`DATEMODIFIED`,
                        `wthrbg_overlay_fullscrn_profile`.`DATECREATED`
                    FROM `wthrbg_overlay_fullscrn_profile`;
                    ';

                    $oDB_RESP->process(self::$mysqli,$queryType, $tmp_SELECT_ARRAY);

                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'LANG_PACKS', 'LANG_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'OVERLAY_PROFILES_FULLSCRN', 'PROFILE_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'OVERLAY_PROFILES_MINI', 'PROFILE_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'OVERLAY_PAGES', 'PAGE_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'SYSTEM_USER_TYPES', 'USER_PERMISSIONS_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'SYSTEM_USERS', 'USERID');

                    //
                    // ALL DONE, PROCESSED AND READY FOR USE. RETURN RESPONSE OBJECT.
                    return $oDB_RESP;

                    break;
                case 'content_publish_proxy':
                    // action_type [skip, edit, publish]
                    $tmp_userid = $oEnv->oSESSION_MGR->getSessionParam('USERID');
                    $tmp_ACTION_TYPE = $oUser->retrieve_Form_Data('ACTION_TYPE');
                    $tmp_LANG_ID = $oUser->retrieve_Form_Data('LANG_ID');
                    $tmp_LANG_ID_TRANSLATOR = $oUser->retrieve_Form_Data('LANG_ID_TRANSLATOR');
                    $tmp_POSTID = $oUser->retrieve_Form_Data('POSTID');
                    $tmp_ELEMENT_ID = $oUser->retrieve_Form_Data('ELEMENT_ID');
                    $tmp_COPY_ID = $oUser->retrieve_Form_Data('COPY_ID');
                    $tmp_COMPONENT_ID = $oUser->retrieve_Form_Data('COMPONENT_ID');
                    $tmp_PAGE_ID = $oUser->retrieve_Form_Data('PAGE_ID');
                    $tmp_PROFILE_ID = $oUser->retrieve_Form_Data('PROFILE_ID');
                    $tmp_ELEMENT_SKIP_PIPE_STR = $oUser->retrieve_Form_Data('ELEMENT_SKIP_PIPE_STR');

                    $tmp_content_null = true;

                    switch($tmp_ACTION_TYPE){
                        case 'skip':

                            if($tmp_ELEMENT_SKIP_PIPE_STR==''){

                                $tmp_ELEMENT_SKIP_PIPE_STR = $tmp_ELEMENT_ID;

                            }else{

                                $tmp_ELEMENT_SKIP_PIPE_STR = $tmp_ELEMENT_SKIP_PIPE_STR.'|'.$tmp_ELEMENT_ID;

                            }

                            //error_log('Skipping element_id->'.$tmp_ELEMENT_ID.'-- ELEMENT_SKIP_PIPE_STR: ['.$tmp_ELEMENT_SKIP_PIPE_STR.']');
                            //$oUser->collectNewElementID('ELEMENT_SKIP_PIPE_STR', $oEnv->paramTunnelEncrypt($tmp_ELEMENT_SKIP_PIPE_STR));
                            $oUser->collectNewElementID('ELEMENT_SKIP_PIPE_STR', $tmp_ELEMENT_SKIP_PIPE_STR);

                            //
                            // FIND NEXT ITEM FOR PUBLISH AND LOAD [ELEMENT_ID, COPY_ID, LANG_ID] FOR RETURN

                            $force_profile_select_align = true;
                            $db_resp_process_serial = "!jesus_is_my_dear_lord!";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                            $db_resp_serial_key = $oUser->return_serial_handle();         //$oUser->return_serial_handle();
                            $db_resp_target_profiles = self::$queryMakerForAllMonatony->returnSelectArrayProfiles('RETRIEVE_NEXT_FOR_PUBLISH');       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                            $db_resp_profile_field_cnt = self::$queryMakerForAllMonatony->returnSelectArrayFieldCnt('RETRIEVE_NEXT_FOR_PUBLISH');         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                            $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                            //
                            // QUERY CONSTRUCTION ::
                            $tmp_SELECT_ARRAY = array();

                            //
                            // FIND NEXT ITEM FOR PUBLISH AND LOAD [ELEMENT_ID, COPY_ID, LANG_ID] FOR RETURN

                            $tmp_SELECT_ARRAY = self::$queryMakerForAllMonatony->returnSelectArrayBusiness('RETRIEVE_NEXT_FOR_PUBLISH', $queryType, $oEnv, $oUser, $oDB_RESP);

                            $oDB_RESP->process(self::$mysqli,$queryType, $tmp_SELECT_ARRAY);

                            $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'TRANSLATOR_LANGS', 'USERID|LANG_ID');
                            $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'SITE_LANG_ELEMENTS', 'ELEMENT_REF_KEY|COUNTRY_ISO_CODE');
                            $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'COPY_ID|LANG_ID');
                            $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'MINISTRY_LANG_ELEMENTS_PUBLISHED', 'COPY_ID|LANG_ID');

                            $tmp_loop_size_MINISTRY_LANG_ELEMENTS_SAINT_SAVED = $oDB_RESP->return_sizeof($oDB_RESP->return_serial(), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED');
                            $tmp_loop_size_LANG_PACKS = $oDB_RESP->return_sizeof($oDB_RESP->return_serial(), 'LANG_PACKS');

                            //error_log('Number of drafts available for review: '.$tmp_loop_size_MINISTRY_LANG_ELEMENTS_SAINT_SAVED);
                            if($tmp_loop_size_MINISTRY_LANG_ELEMENTS_SAINT_SAVED>0) {

                                $tmp_skipped_array = explode('|',$tmp_ELEMENT_SKIP_PIPE_STR);

                                for ($i = 0; $i < $tmp_loop_size_MINISTRY_LANG_ELEMENTS_SAINT_SAVED; $i++) {

                                    //
                                    // DO WE HAVE A MATCH = USER KNOWS DRAFT LANG AND AT LEAST 1 OTHER PUBLISHED LANGUAGE WITH SAME COPY_ID

                                    // USER KNOWS DRAFT LANG?
                                    $tmp_content_good_for_publish_review = false;
                                    //error_log('Check user knows language->'.$oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'LANG_ID', $i));
                                    if ($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'TRANSLATOR_LANGS', $tmp_userid . '|' . $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'LANG_ID', $i), 'LANG_ID') != "") {

                                        $tmp_draft_copy_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'COPY_ID', $i);
                                        $tmp_draft_lang_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'LANG_ID', $i);
                                        $tmp_LANG_ID_TRANSLATOR = $tmp_draft_lang_id;

                                        //error_log('2118 database userid = '.$tmp_userid.'| saint saved draft lang id = '.$tmp_draft_lang_id);
                                        // 'LANG_PACKS|LANG_REQUESTS|MINISTRY_LANG_ELEMENTS_PUBLISHED|SITE_LANG_ELEMENTS_EN|TRANSLATOR_LANGS|SITE_LANG_ELEMENTS|MINISTRY_LANG_ELEMENTS_SAINT_SAVED';

                                        //
                                        // USER KNOWS AT LEAST ONE PUBLISHED PARENT LANG? THEN CAN CHECK AGAINST ANY APPROVED...AND APPROVE...OR EDIT.
                                        // FOR EACH OTHER PUBLISHED LANG...IS THERE TRANSLATOR MATCH? IF SO...DISPLAY PUBLISHED ORIGINAL.
                                        //
                                        // FOR EACH AVAILABLE SYSTEM LANG_ID..
                                        for ($ii = 0; $ii < $tmp_loop_size_LANG_PACKS; $ii++) {
                                            # if((TRANSLATOR_LANGS[$tmp_userid|$tmp_lplid]) == TRUE AND (PUBLISHED_LANGID[COPY_ID|$tmp_lplid]) == TRUE)){
                                            # MINISTRY_LANG_ELEMENTS_PUBLISHED.[copy_id|lplid]!=''
                                            $tmp_lplid = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'LANG_PACKS', 'LANG_ID', $ii);
                                            //error_log('2130 database userid = '.$tmp_userid.'| saint saved Draft LANG_ID=['.$tmp_draft_lang_id.']'.$tmp_lplid);
                                            //error_log('2131 :: Test for ready for publish...draft lid-['.$tmp_draft_lang_id.'] LANG_PACK lid-['.$tmp_lplid.']');
                                            // if(($tmp_draft_lang_id != $tmp_lplid) && ($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'TRANSLATOR_LANGS', $tmp_userid.'|'.$tmp_lplid, 'LANG_ID')!="") && (($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_PUBLISHED', $tmp_draft_copy_id.'|'.$tmp_lplid, 'LANG_ID')!="") || (($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', $tmp_draft_copy_id.'|'.$tmp_lplid, 'LANG_ID')!="") && ($oEnv->oSESSION_MGR->getSessionParam("USER_PERMISSIONS_ID")>399)))) {
                                            if ((($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'TRANSLATOR_LANGS', $tmp_userid . '|' . $tmp_lplid, 'LANG_ID') != "") && ($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'MINISTRY_LANG_ELEMENTS_PUBLISHED', $tmp_draft_copy_id . '|' . $tmp_lplid, 'LANG_ID') != "")) || ((($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', $tmp_draft_copy_id . '|' . $tmp_lplid, 'LANG_ID') != "") && ($oEnv->oSESSION_MGR->getSessionParam("USER_PERMISSIONS_ID") > 399)))) {
                                                // DISPLAY THIS PUBLISHED CONTENT FOR REVIEW OF DRAFT
                                                $tmp_content_good_for_publish_review = true;
                                                error_log('2136 database :: SOMETHING IS recognized - Ready for publish...draft lid-['.$tmp_draft_lang_id.'] LANG_PACK lid-['.$tmp_lplid.']');
                                            }

                                        }

                                        if ($tmp_content_good_for_publish_review) {

                                            $tmp_mle_element_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'ELEMENT_ID', $i);

                                            if (!in_array($tmp_mle_element_id, $tmp_skipped_array)) {

                                                $tmp_content_null = false;

                                                $tmp_profile_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'PROFILE_ID', $i);
                                                $tmp_mle_lang_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'LANG_ID', $i);
                                                $tmp_mle_copy_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'COPY_ID', $i);

                                                $oUser->collectNewElementID('LANG_ID', $tmp_mle_lang_id);
                                                $oUser->collectNewElementID('LANG_ID_TRANSLATOR', $tmp_LANG_ID_TRANSLATOR);
                                                $oUser->collectNewElementID('COPY_ID', $tmp_mle_copy_id);
                                                $oUser->collectNewElementID('ELEMENT_ID', $tmp_mle_element_id);

                                                //error_log('2148 - NEW ['.$tmp_mle_lang_id.'] CONTENT TO REVIEW FOR PUBLISH->'.$tmp_mle_element_id);

                                                $i = $tmp_loop_size_MINISTRY_LANG_ELEMENTS_SAINT_SAVED + 1;

                                            }

                                        }

                                    }else{

                                        //error_log('2169 - User does not know language...');
                                    }

                                }

                                if($tmp_content_null){
                                    $oUser->responseString = 'content_publish_'.$tmp_ACTION_TYPE.'=success_null';
                                    return $oUser;

                                }

                            }else{
                                //
                                // NO MORE TO PUBLISH. SHOULD REDIRECT TO DASHBOARD.
                                //error_log('2162 - No more fresh content to publish...');
                                $oUser->responseString = 'content_publish_'.$tmp_ACTION_TYPE.'=success_null';
                                return $oUser;

                            }

                            break;
                        case 'edit':

                            //
                            // REDIRECT TO PUBLISH/EDIT/ PAGE

                            $oUser->collectNewElementID('LANG_ID', $tmp_LANG_ID);
                            $oUser->collectNewElementID('LANG_ID_TRANSLATOR', $tmp_LANG_ID_TRANSLATOR);
                            $oUser->collectNewElementID('COPY_ID', $tmp_COPY_ID);
                            $oUser->collectNewElementID('ELEMENT_ID', $tmp_ELEMENT_ID);

                            break;
                        case 'publish':

                            $ID_ARRAY[0] = $tmp_PROFILE_ID;
                            $IDTYPE_ARRAY[0] = "FULLSCRN_PROFILE";

                            $ID_ARRAY[1] = $tmp_PAGE_ID;
                            $IDTYPE_ARRAY[1] = "FULLSCRN_PAGE";

                            $ID_ARRAY[2] = $tmp_LANG_ID;
                            $IDTYPE_ARRAY[2] = "LANG_PACK";

                            $ID_ARRAY[3] = $tmp_ELEMENT_ID;
                            $IDTYPE_ARRAY[3] = "LANG_ELEMENT";

                            if($ID_ARRAY[0]=='' || $ID_ARRAY[1]==''){

                                self::$query_exception_result = "error";
                                throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: [paramTunnelDecrypt() NULL ERROR...probably!]');
                            }

                            $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                            $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                            $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME_BLOB'));
                            $tmp_page_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PAGE',0,'PAGE_NAME_BLOB'));
                            $tmp_lang_pack_nomen = self::$mysqli->real_escape_string($dataAugmenter->getData('LANG_PACK',0,'NATIVE_NAME_BLOB'));
                            $tmp_lang_pack_name = self::$mysqli->real_escape_string($dataAugmenter->getData('LANG_PACK',0,'NAME'));
                            $tmp_lang_element_content = self::$mysqli->real_escape_string($dataAugmenter->getData('LANG_ELEMENT',0,'ELEMENT_CONTENT_BLOB'));

                            $oUser->sys_activity_description = 'Draft '.$tmp_lang_pack_nomen.' ('.$tmp_lang_pack_name.') content ['.$tmp_lang_element_content.'] has been published in the page ('.$tmp_page_name.') of the overlay profile, '.$tmp_profile_name.'.';

                            //
                            // UPDATE STATE OF ELEMENT CONTENT

                            self::$query = self::$queryMakerForAllMonatony->returnQueryBusiness('LANG_ELEMENT_PUBLISH', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            $tmp_q .= self::$queryMakerForAllMonatony->returnQueryBusiness('ACTIVITY_LOG', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);
                            //error_log('2246->'.$tmp_q);
                            self::$query .= $tmp_q;
                            self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                            if(self::$mysqli->error){
                                self::$query_exception_result = "error";
                                throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                            }else{

                                do{
                                } while (self::$mysqli->more_results() && self::$mysqli->next_result());

                                $force_profile_select_align = true;
                                $db_resp_process_serial = "!jesus_is_my_dear_lord!";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                                $db_resp_serial_key = $oUser->return_serial_handle();         //$oUser->return_serial_handle();
                                $db_resp_target_profiles = self::$queryMakerForAllMonatony->returnSelectArrayProfiles('RETRIEVE_NEXT_FOR_PUBLISH');       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                                $db_resp_profile_field_cnt = self::$queryMakerForAllMonatony->returnSelectArrayFieldCnt('RETRIEVE_NEXT_FOR_PUBLISH');         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                                $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                                //
                                // QUERY CONSTRUCTION ::
                                $tmp_SELECT_ARRAY = array();

                                //
                                // FIND NEXT ITEM FOR PUBLISH AND LOAD [ELEMENT_ID, COPY_ID, LANG_ID] FOR RETURN

                                $tmp_SELECT_ARRAY = self::$queryMakerForAllMonatony->returnSelectArrayBusiness('RETRIEVE_NEXT_FOR_PUBLISH', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                                $oDB_RESP->process(self::$mysqli,$queryType, $tmp_SELECT_ARRAY);

                                $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'TRANSLATOR_LANGS', 'USERID|LANG_ID');
                                $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'SITE_LANG_ELEMENTS', 'ELEMENT_REF_KEY|COUNTRY_ISO_CODE');
                                $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'COPY_ID|LANG_ID');
                                $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'MINISTRY_LANG_ELEMENTS_PUBLISHED', 'COPY_ID|LANG_ID');

                                $tmp_loop_size_MINISTRY_LANG_ELEMENTS_SAINT_SAVED = $oDB_RESP->return_sizeof($oDB_RESP->return_serial(), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED');
                                $tmp_loop_size_LANG_PACKS = $oDB_RESP->return_sizeof($oDB_RESP->return_serial(), 'LANG_PACKS');

                                if($tmp_loop_size_MINISTRY_LANG_ELEMENTS_SAINT_SAVED>0) {

                                    $tmp_skipped_array = explode('|',$tmp_ELEMENT_SKIP_PIPE_STR);

                                    for ($i = 0; $i < $tmp_loop_size_MINISTRY_LANG_ELEMENTS_SAINT_SAVED; $i++) {

                                        //
                                        // DO WE HAVE A MATCH = USER KNOWS DRAFT LANG AND AT LEAST 1 OTHER PUBLISHED LANGUAGE WITH SAME COPY_ID

                                        // USER KNOWS DRAFT LANG?
                                        $tmp_content_good_for_publish_review = false;
                                        if ($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'TRANSLATOR_LANGS', $tmp_userid . '|' . $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'LANG_ID', $i), 'LANG_ID') != "") {

                                            $tmp_draft_copy_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'COPY_ID', $i);
                                            $tmp_draft_lang_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'LANG_ID', $i);
                                            $tmp_LANG_ID_TRANSLATOR = $tmp_draft_lang_id;

                                            //error_log('121 dashboard userid = '.$tmp_userid.'| saint saved draft lang id = '.$tmp_draft_lang_id);
                                            // 'LANG_PACKS|LANG_REQUESTS|MINISTRY_LANG_ELEMENTS_PUBLISHED|SITE_LANG_ELEMENTS_EN|TRANSLATOR_LANGS|SITE_LANG_ELEMENTS|MINISTRY_LANG_ELEMENTS_SAINT_SAVED';

                                            //
                                            // USER KNOWS AT LEAST ONE PUBLISHED PARENT LANG? THEN CAN CHECK AGAINST ANY APPROVED...AND APPROVE...OR EDIT.
                                            // FOR EACH OTHER PUBLISHED LANG...IS THERE TRANSLATOR MATCH? IF SO...DISPLAY PUBLISHED ORIGINAL.
                                            //
                                            // FOR EACH AVAILABLE SYSTEM LANG_ID..
                                            for ($ii = 0; $ii < $tmp_loop_size_LANG_PACKS; $ii++) {
                                                # if((TRANSLATOR_LANGS[$tmp_userid|$tmp_lplid]) == TRUE AND (PUBLISHED_LANGID[COPY_ID|$tmp_lplid]) == TRUE)){
                                                # MINISTRY_LANG_ELEMENTS_PUBLISHED.[copy_id|lplid]!=''
                                                $tmp_lplid = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'LANG_PACKS', 'LANG_ID', $ii);
                                                //error_log('121 dashboard userid = '.$tmp_userid.'| saint saved Draft LANG_ID=['.$tmp_draft_lang_id.']'.$tmp_lplid);
                                                //error_log('133 :: Test for ready for publish...draft lid-['.$tmp_draft_lang_id.'] LANG_PACK lid-['.$tmp_lplid.']');
                                                // if(($tmp_draft_lang_id != $tmp_lplid) && ($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'TRANSLATOR_LANGS', $tmp_userid.'|'.$tmp_lplid, 'LANG_ID')!="") && (($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_PUBLISHED', $tmp_draft_copy_id.'|'.$tmp_lplid, 'LANG_ID')!="") || (($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', $tmp_draft_copy_id.'|'.$tmp_lplid, 'LANG_ID')!="") && ($oEnv->oSESSION_MGR->getSessionParam("USER_PERMISSIONS_ID")>399)))) {
                                                if ((($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'TRANSLATOR_LANGS', $tmp_userid . '|' . $tmp_lplid, 'LANG_ID') != "") && ($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'MINISTRY_LANG_ELEMENTS_PUBLISHED', $tmp_draft_copy_id . '|' . $tmp_lplid, 'LANG_ID') != "")) || ((($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', $tmp_draft_copy_id . '|' . $tmp_lplid, 'LANG_ID') != "") && ($oEnv->oSESSION_MGR->getSessionParam("USER_PERMISSIONS_ID") > 399)))) {
                                                    // DISPLAY THIS PUBLISHED CONTENT FOR REVIEW OF DRAFT
                                                    $tmp_content_good_for_publish_review = true;
                                                    //error_log('138 :: SOMETHING IS recognized - Ready for publish...draft lid-['.$tmp_draft_lang_id.'] LANG_PACK lid-['.$tmp_lplid.']');
                                                }

                                            }

                                            if ($tmp_content_good_for_publish_review) {

                                                $tmp_mle_element_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'ELEMENT_ID', $i);

                                                //if(!isset($tmp_skipped_array[$tmp_mle_element_id])){
                                                if (!in_array($tmp_mle_element_id, $tmp_skipped_array)) {

                                                    $tmp_content_null = false;

                                                    $tmp_profile_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'PROFILE_ID', $i);
                                                    $tmp_mle_lang_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'LANG_ID', $i);
                                                    $tmp_mle_copy_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'COPY_ID', $i);

                                                    $oUser->collectNewElementID('LANG_ID', $tmp_mle_lang_id);
                                                    $oUser->collectNewElementID('LANG_ID_TRANSLATOR', $tmp_LANG_ID_TRANSLATOR);
                                                    $oUser->collectNewElementID('COPY_ID', $tmp_mle_copy_id);
                                                    $oUser->collectNewElementID('ELEMENT_ID', $tmp_mle_element_id);

                                                    $i = $tmp_loop_size_MINISTRY_LANG_ELEMENTS_SAINT_SAVED + 1;

                                                }

                                            }

                                        }

                                    }

                                    if($tmp_content_null){
                                        $oUser->responseString = 'content_publish_'.$tmp_ACTION_TYPE.'=success_null';
                                        return $oUser;

                                    }

                                }else{
                                    //
                                    // NO MORE TO PUBLISH. SHOULD REDIRECT TO DASHBOARD.
                                    //error_log('2315 - No more fresh content to publish...');
                                    $oUser->responseString = 'content_publish_'.$tmp_ACTION_TYPE.'=success_null';
                                    return $oUser;

                                }

                            }

                            break;

                    }

                    $oUser->responseString = 'content_publish_'.$tmp_ACTION_TYPE.'=success';
                    return $oUser;

                    break;
                case 'language_translation_user_submit_capture':

                    $tmp_userid = $oEnv->oSESSION_MGR->getSessionParam('USERID');
                    $tmp_action_update = true;
                    $oUser->save_Form_Data('COMPLETION_STATE', 'SAINT_SAVED');
                    $oUser->save_Form_Data('DRAFT_OWNER', 'SAINT');

                    $tmp_translation_reference_key = $oUser->retrieve_Form_Data('ELEMENT_REF_KEY');
                    $tmp_translation_element_id = $oUser->retrieve_Form_Data('ELEMENT_ID');
                    $tmp_translation_element_id_translation = $oUser->retrieve_Form_Data('ELEMENT_ID_TRANSLATION');

                    if($tmp_translation_element_id_translation==''){
                        $tmp_action_update = false;
                        $tmp_translation_element_id_translation = $oUser->generateNewKey(70);
                        $oUser->save_Form_Data('ELEMENT_ID_TRANSLATION', $tmp_translation_element_id_translation);

                    }

                    $tmp_translation_copy_id = $oUser->retrieve_Form_Data('COPY_ID');
                    $tmp_translation_lang_id_translation = $oUser->retrieve_Form_Data('LANG_ID');
                    $tmp_translator_lang_id = $oUser->retrieve_Form_Data('LANG_ID_TRANSLATOR');
                    $tmp_translation_component_type = $oUser->retrieve_Form_Data('COMPONENT_TYPE');
                    $tmp_translation_component_id = $oUser->retrieve_Form_Data('COMPONENT_ID');
                    $tmp_translation_page_id = $oUser->retrieve_Form_Data('PAGE_ID');
                    $tmp_translation_profile_id = $oUser->retrieve_Form_Data('PROFILE_ID');
                    $tmp_translation_profile_type = $oUser->retrieve_Form_Data('PROFILE_TYPE');
                    $tmp_translation_new_copy = $oUser->retrieve_Form_Data('TRANSLATION_NEW_COPY');

                    $tmp_translation_draft_owner_old = $oUser->retrieve_Form_Data('DRAFT_OWNER');
                    $oUser->save_Form_Data('DRAFT_OWNER', 'SAINT');
                    $tmp_translation_completion_state_old = $oUser->retrieve_Form_Data('COMPLETION_STATE');
                    $oUser->save_Form_Data('COMPLETION_STATE', 'SAINT_SAVED');

                    if($tmp_translation_reference_key==''){

                        //
                        // MINISTRY CONTENT TRANSLATION
                        // SAVE NEW TRANSLATION

                        //$oUser->save_Form_Data('COPY_ID', $tmp_translation_copy_id);

                        $oUser->copy_content_field = 'TRANSLATION_NEW_COPY';
                        $oUser->copy_profile_type = $tmp_translation_profile_type;
                        $oUser->copy_component_type = $tmp_translation_component_type;

                        if($tmp_translation_page_id!=''){

                            //
                            // FULL SCREEN OVERLAY
                            $ID_ARRAY[0] = $oUser->retrieve_Form_Data('PROFILE_ID');
                            $IDTYPE_ARRAY[0] = "FULLSCRN_PROFILE";

                            $ID_ARRAY[1] = $oUser->retrieve_Form_Data('PAGE_ID');
                            $IDTYPE_ARRAY[1] = "FULLSCRN_PAGE";

                            $ID_ARRAY[2] = $tmp_translation_lang_id_translation;
                            $IDTYPE_ARRAY[2] = "LANG_PACK";

                            $ID_ARRAY[3] = $tmp_translator_lang_id;
                            $IDTYPE_ARRAY[3] = "LANG_PACK_TRANSLATOR";

                            $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                            $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                            $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME_BLOB'));
                            $tmp_page_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PAGE',0,'PAGE_NAME_BLOB'));

                            $tmp_lang_pack_nomen = self::$mysqli->real_escape_string($dataAugmenter->getData('LANG_PACK',0,'NATIVE_NAME_BLOB'));
                            $tmp_lang_pack_name = self::$mysqli->real_escape_string($dataAugmenter->getData('LANG_PACK',0,'NAME'));

                            $tmp_lang_pack_nomen_translator = self::$mysqli->real_escape_string($dataAugmenter->getData('LANG_PACK_TRANSLATOR',0,'NATIVE_NAME_BLOB'));
                            $tmp_lang_pack_name_translator = self::$mysqli->real_escape_string($dataAugmenter->getData('LANG_PACK_TRANSLATOR',0,'NAME'));

                            $oUser->sys_activity_description = 'Draft '.$tmp_lang_pack_nomen_translator.' ('.$tmp_lang_pack_name_translator.') translation content ['.$tmp_translation_new_copy.'] has been saved for the '.$tmp_lang_pack_nomen.' ('.$tmp_lang_pack_name.') on the full screen overlay page ('.$tmp_page_name.') of the profile, '.$tmp_profile_name.'.';

                        }else{

                            //
                            // MINI OVERLAY
                            $ID_ARRAY[0] = $oUser->retrieve_Form_Data('PROFILE_ID');
                            $IDTYPE_ARRAY[0] = "MINI_PROFILE";

                            $ID_ARRAY[1] = $tmp_translation_lang_id_translation;
                            $IDTYPE_ARRAY[1] = "LANG_PACK";

                            $ID_ARRAY[2] = $tmp_translator_lang_id;
                            $IDTYPE_ARRAY[2] = "LANG_PACK_TRANSLATOR";

                            $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                            $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                            $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME_BLOB'));
                            $tmp_page_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PAGE',0,'PAGE_NAME_BLOB'));

                            $tmp_lang_pack_nomen = self::$mysqli->real_escape_string($dataAugmenter->getData('LANG_PACK',0,'NATIVE_NAME_BLOB'));
                            $tmp_lang_pack_name = self::$mysqli->real_escape_string($dataAugmenter->getData('LANG_PACK',0,'NAME'));

                            $tmp_lang_pack_nomen_translator = self::$mysqli->real_escape_string($dataAugmenter->getData('LANG_PACK_TRANSLATOR',0,'NATIVE_NAME_BLOB'));
                            $tmp_lang_pack_name_translator = self::$mysqli->real_escape_string($dataAugmenter->getData('LANG_PACK_TRANSLATOR',0,'NAME'));

                            $oUser->sys_activity_description = 'Draft '.$tmp_lang_pack_nomen_translator.' ('.$tmp_lang_pack_name_translator.') translation content ('.$tmp_translation_new_copy.') has been saved for the '.$tmp_lang_pack_nomen.' ('.$tmp_lang_pack_name.') in the mini overlay component of the profile, '.$tmp_profile_name.'.';

                        }

                        //
                        // QUERY CONSTRUCTION ::
                        if($tmp_action_update){

                            self::$query = self::$queryMakerForAllMonatony->returnQueryBusiness('LANG_ELEMENT_TRANSLATION_UPDATE', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('SEARCH_ENTRY_TRANSLATION_UPDATE', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                        }else{

                            self::$query = self::$queryMakerForAllMonatony->returnQueryBusiness('LANG_ELEMENT_TRANSLATION_NEW', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('SEARCH_ENTRY_TRANSLATION_NEW', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                        }

                        self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('ACTIVITY_LOG', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                        self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                        if(self::$mysqli->error){
                            $oUser->responseString = 'error';
                            self::$query_exception_result = "error";
                            throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                        }else{

                            $oUser->responseString = 'language_translation_user_submit_capture=success';

                        }

                        //
                        // RETRIEVE NEXT MINISTRY CONTENT TRANSLATION
                        $tmp_serial_handle = 'TRANSLATION_DATA';
                        $oDB_RESP = $oUser->getTranslationData($tmp_serial_handle);

                        $tmp_userid = $oEnv->oSESSION_MGR->getSessionParam('USERID');
                        $tmp_loop_size_MINISTRY_LANG_ELEMENTS = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED');

                        if($tmp_loop_size_MINISTRY_LANG_ELEMENTS==0){

                            //
                            // MINISTRY TRANSLATIONS COMPLETE

                        }else{
                            for($i=0; $i<$tmp_loop_size_MINISTRY_LANG_ELEMENTS; $i++){

                                //
                                // DO WE HAVE A MATCH
                                if($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'TRANSLATOR_LANGS', $tmp_userid.'|'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'LANG_ID', $i), 'LANG_ID')!="") {

                                    $tmp_profile_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'PROFILE_ID', $i);
                                    $tmp_mle_lang_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'LANG_ID', $i);
                                    $tmp_mle_element_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'ELEMENT_ID', $i);
                                    $tmp_mle_copy_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'COPY_ID', $i);

                                    if($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_REQUESTS', $tmp_profile_id, 'LANG_ID')!="" && $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_REQUESTS', $tmp_profile_id, 'LANG_ID')!=$tmp_mle_lang_id) {

                                        //
                                        // INITIALIZE REDIRECT PARAMS
                                        $oUser->collectNewElementID('NEXT_TRANSLATION_ELEMENT_ID', $oEnv->paramTunnelEncrypt($tmp_mle_element_id));
                                        $oUser->collectNewElementID('NEXT_TRANSLATION_COPY_ID', $oEnv->paramTunnelEncrypt($tmp_mle_copy_id));
                                        $oUser->collectNewElementID('NEXT_TRANSLATION_LANG_ID', $oEnv->paramTunnelEncrypt($tmp_mle_lang_id));

                                        $i = $tmp_loop_size_MINISTRY_LANG_ELEMENTS + 1;

                                        $cnt_MAX_MINISTRY_ELEM_4_TRANSLATE++;
                                    }

                                }

                            }

                        }

                        return $oUser;

                    }else{

                        //
                        // CMS CONTENT TRANSLATION
                        // SAVE NEW TRANSLATION

                        //
                        // RETRIEVE NEXT MINISTRY CONTENT TRANSLATION

                        //
                        // INITIALIZE REDIRECT PARAMS
                        //$oUser->collectNewElementID('NEXT_TRANSLATION_REFERENCE_KEY', $tmp_);
                        //$oUser->collectNewElementID('NEXT_TRANSLATION_LANG_ID', $tmp_);

                    }

                    $oUser->responseString = 'language_translation_user_submit_capture=success';
                    return $oUser;

                    break;
                case 'xhr_sync':

                    /*
                      self::$http_param_handle["JSON_SERIAL_JS_HANDLE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_json_serial_js_handle');
                    self::$http_param_handle["JSON_OBJECT_TYPE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_json_object_type');
                    self::$http_param_handle["INPUT_DOM_ELEMENT_TYPE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_input_dom_element_type');
                    self::$http_param_handle["INPUT_DOM_ELEMENT_ID"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_input_dom_element_id');
                    self::$http_param_handle["POSTID"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'postid');
                    self::$http_param_handle["ELEMENT_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_element_id'));
                    self::$http_param_handle["ELEMENT_ID_TRANSLATION"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_element_id_translation'));
                    self::$http_param_handle["COPY_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_copy_id'));
                    self::$http_param_handle["COMPONENT_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_component_id'));
                    self::$http_param_handle["PAGE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_page_id'));
                    self::$http_param_handle["PROFILE_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_profile_id'));
                    self::$http_param_handle["COPY_HASH"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_copy_hash');
                    self::$http_param_handle["LANG_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_lang_id'));
                    self::$http_param_handle["LANG_ID_TRANSLATOR"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_lang_id_translator'));
                    self::$http_param_handle["DRAFT_STATE"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_draft_state'));
                    self::$http_param_handle["PROFILE_TYPE"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_profile_type'));
                    self::$http_param_handle["COMPONENT_TYPE"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_component_type'));
                    self::$http_param_handle["ELEMENT_COPY"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_element_copy');
                    self::$http_param_handle["XCP_LOCK"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_lock'));
                    self::$http_param_handle["ISACTIVE"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_isactive'));
                    self::$http_param_handle["COMPLETION_STATE"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_completion_state'));
                    self::$http_param_handle["DRAFT_OWNER"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_draft_owner'));
                    self::$http_param_handle["DATEDRAFTED"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'xcp_datedrafted'));


                     * */

                    self::$oDB_RESP->init_ojson_controller($queryType);

                    //$json = file_get_contents('php://input');

                    //error_log('json->'.$json);

                    //self::$oDB_RESP->ojson_injest($queryType, $json);
                    //$tmp_last_error = self::$oDB_RESP->ojson_last_err(true, $queryType);

                    //if ($tmp_last_error === JSON_ERROR_NONE) {

                    //do something with $json. It's ready to use

                    //$tmp_ojson_decode_output = self::$oDB_RESP->retrieve_ojson_decoded($queryType);

                    //$tmp_json_object_array = $tmp_ojson_decode_output->{'json_packet'};

                    //foreach($tmp_json_object_array as $key => $oJson_packet){

                    //error_log('2017 - foreach() into $tmp_json_object_array. Here val->{ELEMENT_COPY} = '.$oUser->encoding($oJson_packet->{'ELEMENT_COPY'}).' | val->{JSON_OBJECT_TYPE} = '.$oJson_packet->{'JSON_OBJECT_TYPE'});

                    //switch($oJson_packet->{'JSON_OBJECT_TYPE'}){
                    $tmp_JSON_OBJECT_TYPE = $oUser->retrieve_Form_Data('JSON_OBJECT_TYPE');

                    switch($tmp_JSON_OBJECT_TYPE){
                        case 'LANG_ELEM_DRAFT_SYNC':

                            //
                            // LANG ELEMENT SYNC - SINGLE SERVING
                            // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
                            //$tmp_JSON_SERIAL_JS_HANDLE = $oJson_packet->{'JSON_SERIAL_JS_HANDLE'};
                            $tmp_JSON_SERIAL_JS_HANDLE = $oUser->retrieve_Form_Data('JSON_SERIAL_JS_HANDLE');
                            $tmp_JSON_OBJECT_TYPE = $oUser->retrieve_Form_Data('JSON_OBJECT_TYPE');
                            $tmp_INPUT_DOM_ELEMENT_TYPE = $oUser->retrieve_Form_Data('INPUT_DOM_ELEMENT_TYPE');
                            $tmp_INPUT_DOM_ELEMENT_ID = $oUser->retrieve_Form_Data('INPUT_DOM_ELEMENT_ID');
                            $tmp_ELEMENT_ID = $oUser->retrieve_Form_Data('ELEMENT_ID');
                            $tmp_ELEMENT_ID_TRANSLATION = $oUser->retrieve_Form_Data('ELEMENT_ID_TRANSLATION');
                            $tmp_COPY_ID = $oUser->retrieve_Form_Data('COPY_ID');
                            $tmp_COMPONENT_ID = $oUser->retrieve_Form_Data('COMPONENT_ID');
                            $tmp_PAGE_ID = $oUser->retrieve_Form_Data('PAGE_ID');
                            $tmp_PROFILE_ID = $oUser->retrieve_Form_Data('PROFILE_ID');
                            $tmp_LANG_ID = $oUser->retrieve_Form_Data('LANG_ID');
                            $tmp_LANG_ID_TRANSLATOR = $oUser->retrieve_Form_Data('LANG_ID_TRANSLATOR');
                            $tmp_ISACTIVE = $oUser->retrieve_Form_Data('ISACTIVE');
                            $tmp_DRAFT_OWNER = $oUser->retrieve_Form_Data('DRAFT_OWNER');
                            $tmp_PROFILE_TYPE = $oUser->retrieve_Form_Data('PROFILE_TYPE');
                            $tmp_COMPONENT_TYPE = $oUser->retrieve_Form_Data('COMPONENT_TYPE');
                            $tmp_ELEMENT_COPY = $oUser->retrieve_Form_Data('ELEMENT_COPY');

                            $tmp_COMPLETION_STATE = $oUser->retrieve_Form_Data('COMPLETION_STATE');
                            $tmp_DRAFT_OWNER = $oUser->retrieve_Form_Data('DRAFT_OWNER');
                            $tmp_DATEDRAFTED = $oUser->retrieve_Form_Data('DATEDRAFTED');
                            $tmp_DATEPUBLISHED = $oUser->retrieve_Form_Data('DATEPUBLISHED');

                            $tmp_datedrafted_secs = strtotime($tmp_DATEDRAFTED);
                            $tmp_datepublished_secs = strtotime($tmp_DATEPUBLISHED);

                            if($tmp_DATEDRAFTED=='' || ($tmp_DATEPUBLISHED=='' && ($tmp_DRAFT_OWNER=='AUTO' || $tmp_DRAFT_OWNER==''))){
                                $tmp_DATEDRAFTED = $ts;
                                $tmp_COMPLETION_STATE = 'AUTO_SAVED';
                                $tmp_DRAFT_OWNER = 'AUTO';


                            }else{

                                $tmp_DATEDRAFTED = $ts;
                                $tmp_COMPLETION_STATE = 'EDIT_UNSAVED';
                                $tmp_DRAFT_OWNER = 'AUTO';

                            }

                            $oUser->save_Form_Data('DATEDRAFTED', $tmp_DATEDRAFTED);
                            $oUser->save_Form_Data('DRAFT_OWNER', 'AUTO');
                            $oUser->save_Form_Data('COMPLETION_STATE', $tmp_COMPLETION_STATE);

                            //error_log('2066 JSON - SERVER  ['.$tmp_ELEMENT_ID_TRANSLATION.'] for ['.$tmp_ELEMENT_ID.'] AND ELEMENT_COPY='.$oUser->encoding($tmp_ELEMENT_COPY));

                            //$tmp_LAST_ERROR_CODE = self::$oDB_RESP->ojson_last_err(true, $queryType);
                            //$tmp_LAST_ERROR_COPY = self::$oDB_RESP->ojson_last_err(false, $queryType);

                            //
                            // PROCESS REQUEST
                            if($tmp_ELEMENT_ID_TRANSLATION == ''){
                                //error_log('2128 NEW TRANSLATION...');
                                //
                                // NEW ELEMENT COPY FOR DRAFT SAVE
                                $tmp_ELEMENT_ID_TRANSLATION = $oUser->generateNewKey(70);

                                //$tmp_element_id = $tmp_ELEMENT_ID;
                                //$tmp_subtitle_id = $oUser->generateNewKey(70);

                                $oUser->save_Form_Data('ELEMENT_ID_TRANSLATION', $tmp_ELEMENT_ID_TRANSLATION);

                                $oUser->collectNewElementID('COMPONENT_ID', $tmp_COMPONENT_ID);
                                $oUser->collectNewElementID('COPY_ID', $tmp_COPY_ID);
                                $oUser->collectNewElementID('ELEMENT_ID', $tmp_ELEMENT_ID);
                                $oUser->collectNewElementID('ELEMENT_ID_TRANSLATION', $tmp_ELEMENT_ID_TRANSLATION);

                                $oUser->copy_content_field = 'ELEMENT_COPY';
                                $oUser->copy_profile_type = $tmp_PROFILE_TYPE;
                                $oUser->copy_component_type = $tmp_COMPONENT_TYPE;

                                $ID_ARRAY[0] = $tmp_PROFILE_ID;
                                $IDTYPE_ARRAY[0] = "FULLSCRN_PROFILE";

                                $ID_ARRAY[1] = $tmp_PAGE_ID;
                                $IDTYPE_ARRAY[1] = "FULLSCRN_PAGE";

                                $ID_ARRAY[2] = $tmp_LANG_ID_TRANSLATOR;
                                $IDTYPE_ARRAY[2] = "LANG_PACK";

                                if($ID_ARRAY[0]=='' || $ID_ARRAY[1]==''){

                                    self::$query_exception_result = "error";
                                    throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: [paramTunnelDecrypt() NULL ERROR]');
                                }

                                $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                                $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                                $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME_BLOB'));
                                $tmp_page_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PAGE',0,'PAGE_NAME_BLOB'));
                                $tmp_lang_pack_nomen = self::$mysqli->real_escape_string($dataAugmenter->getData('LANG_PACK',0,'NATIVE_NAME_BLOB'));
                                $tmp_lang_pack_name = self::$mysqli->real_escape_string($dataAugmenter->getData('LANG_PACK',0,'NAME'));

                                $oUser->sys_activity_description = 'New '.$tmp_lang_pack_nomen.' ('.$tmp_lang_pack_name.') draft translation copy ['.$tmp_ELEMENT_COPY.'] has been added to the page ('.$tmp_page_name.') of the overlay profile, '.$tmp_profile_name.'.';

                                self::$query = self::$queryMakerForAllMonatony->returnQueryBusiness('LANG_ELEMENT_TRANSLATION_NEW', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                                self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('SEARCH_ENTRY_TRANSLATION_NEW', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                                self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('ACTIVITY_LOG', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                                self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                                if(self::$mysqli->error){
                                    self::$query_exception_result = "error";
                                    throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                                }else{
                                    //$tmp_ojson_response_ARRAY = array("tmp_ELEMENT_ID" => $tmp_ELEMENT_ID, "ELEMENT_COPY" => $tmp_ELEMENT_COPY);
                                    //$tmp_json_string_output = json_encode($tmp_ojson_response_ARRAY, JSON_UNESCAPED_UNICODE);
                                    //$oUser->xhr_response_json = $tmp_json_string_output;
                                    //return $oUser;

                                    //
                                    // BUILD JSON RESPONSE
                                    $tmp_LAST_ERROR_CODE = '';
                                    $tmp_LAST_ERROR_COPY = '';
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'JSON_SERIAL_JS_HANDLE', $tmp_JSON_SERIAL_JS_HANDLE);
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'JSON_OBJECT_TYPE', $tmp_JSON_OBJECT_TYPE);
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'INPUT_DOM_ELEMENT_TYPE', $tmp_INPUT_DOM_ELEMENT_TYPE);
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'INPUT_DOM_ELEMENT_ID', $tmp_INPUT_DOM_ELEMENT_ID);
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'ELEMENT_ID', $oEnv->paramTunnelEncrypt($tmp_ELEMENT_ID));
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'ELEMENT_ID_TRANSLATION', $oEnv->paramTunnelEncrypt($tmp_ELEMENT_ID_TRANSLATION));
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'COPY_ID', $oEnv->paramTunnelEncrypt($tmp_COPY_ID));
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'COMPONENT_ID', $oEnv->paramTunnelEncrypt($tmp_COMPONENT_ID));
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'PAGE_ID', $oEnv->paramTunnelEncrypt($tmp_PAGE_ID));
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'PROFILE_ID', $oEnv->paramTunnelEncrypt($tmp_PROFILE_ID));
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'LANG_ID', $oEnv->paramTunnelEncrypt($tmp_LANG_ID));
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'LANG_ID_TRANSLATOR', $oEnv->paramTunnelEncrypt($tmp_LANG_ID_TRANSLATOR));
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'COMPLETION_STATE', $oEnv->paramTunnelEncrypt($tmp_COMPLETION_STATE));
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'DRAFT_OWNER', $tmp_DRAFT_OWNER);
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'ISACTIVE', $oEnv->paramTunnelEncrypt($tmp_ISACTIVE));
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'PROFILE_TYPE', $oEnv->paramTunnelEncrypt($tmp_PROFILE_TYPE));
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'COMPONENT_TYPE', $oEnv->paramTunnelEncrypt($tmp_COMPONENT_TYPE));
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'COPY_HASH', self::$queryMakerForAllMonatony->retrieveCurrentHash());

                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'ELEMENT_COPY', $tmp_ELEMENT_COPY);
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'LAST_ERROR_CODE', $tmp_LAST_ERROR_CODE);
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'LAST_ERROR_COPY', $tmp_LAST_ERROR_COPY);

                                    //
                                    // COMPILE JSON RESPONSE ARRAY
                                    $tmp_ojson_response_ARRAY = self::$oDB_RESP->return_ojson_response_array($queryType);
                                    //$tmp_ojson_response_ARRAY = array("INPUT_DOM_ELEMENT_TYPE" => $oJson_packet->{'INPUT_DOM_ELEMENT_TYPE'}, "INPUT_DOM_ELEMENT_ID" => $oJson_packet->{'INPUT_DOM_ELEMENT_ID'}, 'ELEMENT_COPY' => $oJson_packet->{'ELEMENT_COPY'}, 'LAST_ERR' => $tmp_last_error, 'COMPONENT_ID' => "420", 'PAGE_ID' => "4", 'e' => "5");

                                    $tmp_json_string_output = json_encode($tmp_ojson_response_ARRAY, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);

                                    sleep(3);

                                    $oUser->xhr_response_json = $tmp_json_string_output;
                                    return $oUser;
                                }


                            }else{
                                //error_log('2232 UPDATE TRANSLATION...');

                                $oUser->save_Form_Data('DATEDRAFTED', $ts);

                                $oUser->collectNewElementID('COMPONENT_ID', $tmp_COMPONENT_ID);
                                $oUser->collectNewElementID('COPY_ID', $tmp_COPY_ID);
                                $oUser->collectNewElementID('ELEMENT_ID', $tmp_ELEMENT_ID);

                                $oUser->copy_content_field = 'ELEMENT_COPY';
                                $oUser->copy_profile_type = $tmp_PROFILE_TYPE;
                                $oUser->copy_component_type = $tmp_COMPONENT_TYPE;

                                //
                                // QUERY CONSTRUCTION ::
                                self::$query = self::$queryMakerForAllMonatony->returnQueryBusiness('LANG_ELEMENT_TRANSLATION_UPDATE', $queryType, $oEnv, $oUser, $oDB_RESP);

                                self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('SEARCH_ENTRY_TRANSLATION_UPDATE', $queryType, $oEnv, $oUser, $oDB_RESP);

                                if($tmp_DRAFT_OWNER == 'SAINT_SAVED'){
                                    self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('ACTIVITY_LOG', $queryType, $oEnv, $oUser, $oDB_RESP);

                                }

                                self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                                if(self::$mysqli->error){
                                    $oUser->responseString = 'error';
                                    self::$query_exception_result = "error";
                                    throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                                }else{

                                    //
                                    // BUILD JSON RESPONSE
                                    $tmp_LAST_ERROR_CODE = '';
                                    $tmp_LAST_ERROR_COPY = '';
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'JSON_SERIAL_JS_HANDLE', $tmp_JSON_SERIAL_JS_HANDLE);
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'JSON_OBJECT_TYPE', $tmp_JSON_OBJECT_TYPE);
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'INPUT_DOM_ELEMENT_TYPE', $tmp_INPUT_DOM_ELEMENT_TYPE);
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'INPUT_DOM_ELEMENT_ID', $tmp_INPUT_DOM_ELEMENT_ID);
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'ELEMENT_ID', $oEnv->paramTunnelEncrypt($tmp_ELEMENT_ID));
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'ELEMENT_ID_TRANSLATION', $oEnv->paramTunnelEncrypt($tmp_ELEMENT_ID_TRANSLATION));
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'COPY_ID', $oEnv->paramTunnelEncrypt($tmp_COPY_ID));
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'COMPONENT_ID', $oEnv->paramTunnelEncrypt($tmp_COMPONENT_ID));
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'COMPLETION_STATE', $oEnv->paramTunnelEncrypt($tmp_COMPLETION_STATE));
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'PAGE_ID', $oEnv->paramTunnelEncrypt($tmp_PAGE_ID));
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'PROFILE_ID', $oEnv->paramTunnelEncrypt($tmp_PROFILE_ID));
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'LANG_ID', $oEnv->paramTunnelEncrypt($tmp_LANG_ID));
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'LANG_ID_TRANSLATOR', $oEnv->paramTunnelEncrypt($tmp_LANG_ID_TRANSLATOR));
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'DRAFT_OWNER', $tmp_DRAFT_OWNER);
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'PROFILE_TYPE', $oEnv->paramTunnelEncrypt($tmp_PROFILE_TYPE));
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'COMPONENT_TYPE', $oEnv->paramTunnelEncrypt($tmp_COMPONENT_TYPE));
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'COPY_HASH', self::$queryMakerForAllMonatony->retrieveCurrentHash());

                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'ELEMENT_COPY', $tmp_ELEMENT_COPY);
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'LAST_ERROR_CODE', $tmp_LAST_ERROR_CODE);
                                    self::$oDB_RESP->add_ojson_response_value($queryType, 'LAST_ERROR_COPY', $tmp_LAST_ERROR_COPY);

                                    $tmp_ojson_response_ARRAY = self::$oDB_RESP->return_ojson_response_array($queryType);
                                    //$tmp_ojson_response_ARRAY = array("INPUT_DOM_ELEMENT_TYPE" => $oJson_packet->{'INPUT_DOM_ELEMENT_TYPE'}, "INPUT_DOM_ELEMENT_ID" => $oJson_packet->{'INPUT_DOM_ELEMENT_ID'}, 'ELEMENT_COPY' => $oJson_packet->{'ELEMENT_COPY'}, 'LAST_ERR' => $tmp_last_error, 'COMPONENT_ID' => "420", 'PAGE_ID' => "4", 'e' => "5");

                                    $tmp_json_string_output = json_encode($tmp_ojson_response_ARRAY, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
                                    //error_log('2253 database.inc.php ->'.$tmp_json_string_output);
                                    sleep(3);

                                    $oUser->xhr_response_json = $tmp_json_string_output;
                                    return $oUser;
                                }

                            }

                            break;
                        default:

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            //throw new Exception('JSON_OBJECT_TYPE ['.$oJson_packet->{'JSON_OBJECT_TYPE'}.'] is not being handled properly in switch() where case=xhr_sync: within database.inc.php.');
                            throw new Exception('JSON_OBJECT_TYPE ['.$tmp_JSON_OBJECT_TYPE.'] is not being handled properly in switch() where case=xhr_sync: within database.inc.php.');

                            break;

                    }

                    //}

                    //} else {
                    //yep, it's not JSON. Log error or alert someone or do nothing
                    $oUser->xhr_response_json = '{"ELEMENT_COPY":"'.self::$oDB_RESP->ojson_last_err(false, $queryType).'","COMPONENT_ID":"404- yep, it\'s not JSON"}';
                    return $oUser;
                    //}

                    break;
                case 'get_translation_select_data':
                    /*
                    self::$http_param_handle["TRANSLATION_REFERENCE_KEY"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_GET, 'rk'));
                    self::$http_param_handle["TRANSLATION_ELEMENT_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_GET, 'eid'));
                    self::$http_param_handle["TRANSLATION_COPY_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_GET, 'cpyid'));
                    self::$http_param_handle["TRANSLATION_LANG_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_GET, 'lang_id'));
                    self::$http_param_handle["TRANSLAT_LANG_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_GET, 'lit'));

                    //
                    // MINISTRY CONTENT
                    // eid='.self::$oEnv->paramTunnelEncrypt($tmp_mle_element_id).'
                    // &cpyid='.$oEnv->paramTunnelEncrypt($tmp_mle_copy_id).'
                    // &lang_id='.$oEnv->paramTunnelEncrypt($tmp_mle_lang_id).'">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS', 'ELEMENT_CONTENT_BLOB', $i).'</a></li>';
                    // &lit=

                    //
                    // CMS CONTENT
                    // rk='.$oEnv->paramTunnelEncrypt($tmp_elem_reference_key).'
                    // &lang_id='.$oEnv->paramTunnelEncrypt($tmp_translator_lang_id).'">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'SITE_LANG_ELEMENTS_EN', 'ELEMENT_CONTENT_BLOB', $ii).'</a></li>';
                    // &lit=

                     * */

                    $force_profile_select_align = true;
                    $db_resp_process_serial = "!jesus_is_my_dear_lord!";        # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();         //$oUser->return_serial_handle();

                    //
                    // QUERY CONSTRUCTION
                    $tmp_SELECT_ARRAY = array();

                    $tmp_translation_reference_key = $oUser->retrieve_Form_Data("REFERENCE_KEY");
                    $tmp_translation_element_id = $oUser->retrieve_Form_Data("ELEMENT_ID");
                    $tmp_translation_copy_id = $oUser->retrieve_Form_Data("COPY_ID");
                    $tmp_translation_lang_id = $oUser->retrieve_Form_Data("LANG_ID_TRANSLATION");
                    $tmp_translation_lang_id_translator = $oUser->retrieve_Form_Data("LANG_ID_TRANSLATOR");

                    $oDB_RESP->addStaticParam('LANG_ID_TRANSLATOR', $tmp_translation_lang_id_translator);

                    if($tmp_translation_reference_key==''){
                        //
                        // MINISTRY CONTENT
                        $db_resp_target_profiles = 'LANG_PACKS|LANG_REQUESTS|MINISTRY_LANG_ELEMENTS_FOR_PUBLISH|TRANSLATOR_LANGS|MINISTRY_LANG_ELEMENTS_TRANSLATION|MINISTRY_LANG_ELEMENTS_PUBLISHED';                 # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                        $db_resp_profile_field_cnt = '12|15|27|6|27|27';                          # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                        $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                        // LANG_PACKS
                        $tmp_SELECT_ARRAY[0] = 'SELECT `wthrbg_lang_packs`.`LANGPACK_ID`,
                            `wthrbg_lang_packs`.`LANG_ID`,
                            `wthrbg_lang_packs`.`NAME`,
                            `wthrbg_lang_packs`.`NATIVE_NAME`,
                            `wthrbg_lang_packs`.`NATIVE_NAME_BLOB`,
                            `wthrbg_lang_packs`.`ISACTIVE`,
                            `wthrbg_lang_packs`.`RTL_FLAG`,
                            `wthrbg_lang_packs`.`FONT_SIZE_PERCENTAGE`,
                            `wthrbg_lang_packs`.`TIMER_FONT_SIZE_PERCENTAGE`,
                            `wthrbg_lang_packs`.`COPY_PADDING_TOP_PX`,
                            `wthrbg_lang_packs`.`DATEMODIFIED`,
                            `wthrbg_lang_packs`.`DATECREATED`
                        FROM `wthrbg_lang_packs`  
                        WHERE `wthrbg_lang_packs`.`ISACTIVE`="1";
';
                        // LANG_REQUESTS
                        $tmp_SELECT_ARRAY[1] = 'SELECT `wthrbg_profile_lang_requests`.`REQUEST_ID`,
                            `wthrbg_profile_lang_requests`.`FULLSCRN_PROFILE_ID`,
                            `wthrbg_profile_lang_requests`.`MINI_PROFILE_ID`,
                            `wthrbg_profile_lang_requests`.`LANG_ID`,
                            `wthrbg_profile_lang_requests`.`ISACTIVE`,
                            `wthrbg_profile_lang_requests`.`CREATOR_ID`,
                            INET6_NTOA(`wthrbg_profile_lang_requests`.`CREATOR_IP_V6`) AS CREATOR_IP_V6,
                            INET_NTOA(`wthrbg_profile_lang_requests`.`CREATOR_IP`) AS CREATOR_IP,
                            `wthrbg_profile_lang_requests`.`CREATOR_SESSION_ID`,
                            `wthrbg_profile_lang_requests`.`MODIFIER_ID`,
                            INET6_NTOA(`wthrbg_profile_lang_requests`.`MODIFIER_IP_V6`) AS MODIFIER_IP_V6,
                            INET_NTOA(`wthrbg_profile_lang_requests`.`MODIFIER_IP`) AS MODIFIER_IP,
                            `wthrbg_profile_lang_requests`.`MODIFIER_SESSION_ID`,
                            `wthrbg_profile_lang_requests`.`DATEMODIFIED`,
                            `wthrbg_profile_lang_requests`.`DATECREATED`
                        FROM `wthrbg_profile_lang_requests`
                        WHERE `wthrbg_profile_lang_requests`.`ISACTIVE`="1";
';

                        // MINISTRY_LANG_ELEMENTS_FOR_PUBLISH
                        $tmp_SELECT_ARRAY[2] = 'SELECT `wthrbg_lang_elem_components`.`ELEMENT_ID`,
                        `wthrbg_lang_elem_components`.`COPY_ID`,
                        `wthrbg_lang_elem_components`.`COMPONENT_ID`,
                        `wthrbg_lang_elem_components`.`PAGE_ID`,
                        `wthrbg_lang_elem_components`.`PROFILE_ID`,
                        `wthrbg_lang_elem_components`.`COPY_HASH`,
                        `wthrbg_lang_elem_components`.`LANG_ID`,
                        `wthrbg_lang_elem_components`.`ISACTIVE`,
                        `wthrbg_lang_elem_components`.`COMPLETION_STATE`,
                        `wthrbg_lang_elem_components`.`DRAFT_OWNER`,
                        `wthrbg_lang_elem_components`.`DATEDRAFTED`,
                        `wthrbg_lang_elem_components`.`DATEPUBLISHED`,
                        `wthrbg_lang_elem_components`.`PROFILE_TYPE`,
                        `wthrbg_lang_elem_components`.`COMPONENT_TYPE`,
                        `wthrbg_lang_elem_components`.`COMPONENT_SEQUENCE`,
                        `wthrbg_lang_elem_components`.`ELEMENT_CONTENT`,
                        `wthrbg_lang_elem_components`.`ELEMENT_CONTENT_BLOB`,
                        `wthrbg_lang_elem_components`.`CREATOR_ID`,
                        INET6_NTOA(`wthrbg_lang_elem_components`.`CREATOR_IP_V6`) AS CREATOR_IP_V6,
                        INET_NTOA(`wthrbg_lang_elem_components`.`CREATOR_IP`) AS CREATOR_IP,
                        `wthrbg_lang_elem_components`.`CREATOR_SESSION_ID`,
                        `wthrbg_lang_elem_components`.`MODIFIER_ID`,
                        INET6_NTOA(`wthrbg_lang_elem_components`.`MODIFIER_IP_V6`) AS MODIFIER_IP_V6,
                        INET_NTOA(`wthrbg_lang_elem_components`.`MODIFIER_IP`) AS MODIFIER_IP,
                        `wthrbg_lang_elem_components`.`MODIFIER_SESSION_ID`,
                        `wthrbg_lang_elem_components`.`DATEMODIFIED`,
                        `wthrbg_lang_elem_components`.`DATECREATED`
                        FROM `wthrbg_lang_elem_components`
                        WHERE `wthrbg_lang_elem_components`.`ELEMENT_ID`="'.self::$mysqli->real_escape_string($tmp_translation_element_id).'"
                        AND `wthrbg_lang_elem_components`.`ELEMENT_ID_CRC32`="'.crc32($tmp_translation_element_id).'"
                        AND `wthrbg_lang_elem_components`.`COPY_ID`="'.self::$mysqli->real_escape_string($tmp_translation_copy_id).'"
                        AND `wthrbg_lang_elem_components`.`COPY_ID_CRC32`="'.crc32($tmp_translation_copy_id).'"
                        LIMIT 1;
';
                        //error_log('9080 ->'.$tmp_SELECT_ARRAY[2]);
                        // TRANSLATOR_LANGS
                        $tmp_SELECT_ARRAY[3] = 'SELECT `wthrbg_translator_lang_id`.`RELATION_ID`,
                            `wthrbg_translator_lang_id`.`USERID`,
                            `wthrbg_translator_lang_id`.`LANG_ID`,
                            `wthrbg_translator_lang_id`.`ISACTIVE`,
                            `wthrbg_translator_lang_id`.`DATEMODIFIED`,
                            `wthrbg_translator_lang_id`.`DATECREATED`
                        FROM `wthrbg_translator_lang_id`
                        WHERE `wthrbg_translator_lang_id`.`ISACTIVE`="1";
';

                        // MINISTRY_LANG_ELEMENTS_TRANSLATION
                        $tmp_SELECT_ARRAY[4] = 'SELECT `wthrbg_lang_elem_components`.`ELEMENT_ID`,
                        `wthrbg_lang_elem_components`.`COPY_ID`,
                        `wthrbg_lang_elem_components`.`COMPONENT_ID`,
                        `wthrbg_lang_elem_components`.`PAGE_ID`,
                        `wthrbg_lang_elem_components`.`PROFILE_ID`,
                        `wthrbg_lang_elem_components`.`COPY_HASH`,
                        `wthrbg_lang_elem_components`.`LANG_ID`,
                        `wthrbg_lang_elem_components`.`ISACTIVE`,
                        `wthrbg_lang_elem_components`.`COMPLETION_STATE`,
                        `wthrbg_lang_elem_components`.`DRAFT_OWNER`,
                        `wthrbg_lang_elem_components`.`DATEDRAFTED`,
                        `wthrbg_lang_elem_components`.`DATEPUBLISHED`,
                        `wthrbg_lang_elem_components`.`PROFILE_TYPE`,
                        `wthrbg_lang_elem_components`.`COMPONENT_TYPE`,
                        `wthrbg_lang_elem_components`.`COMPONENT_SEQUENCE`,
                        `wthrbg_lang_elem_components`.`ELEMENT_CONTENT`,
                        `wthrbg_lang_elem_components`.`ELEMENT_CONTENT_BLOB`,
                        `wthrbg_lang_elem_components`.`CREATOR_ID`,
                        INET6_NTOA(`wthrbg_lang_elem_components`.`CREATOR_IP_V6`) AS CREATOR_IP_V6,
                        INET_NTOA(`wthrbg_lang_elem_components`.`CREATOR_IP`) AS CREATOR_IP,
                        `wthrbg_lang_elem_components`.`CREATOR_SESSION_ID`,
                        `wthrbg_lang_elem_components`.`MODIFIER_ID`,
                        INET6_NTOA(`wthrbg_lang_elem_components`.`MODIFIER_IP_V6`) AS MODIFIER_IP_V6,
                        INET_NTOA(`wthrbg_lang_elem_components`.`MODIFIER_IP`) AS MODIFIER_IP,
                        `wthrbg_lang_elem_components`.`MODIFIER_SESSION_ID`,
                        `wthrbg_lang_elem_components`.`DATEMODIFIED`,
                        `wthrbg_lang_elem_components`.`DATECREATED`
                        FROM `wthrbg_lang_elem_components`
                        WHERE `wthrbg_lang_elem_components`.`COPY_ID`="'.self::$mysqli->real_escape_string($tmp_translation_copy_id).'"
                        AND `wthrbg_lang_elem_components`.`COPY_ID_CRC32`="'.crc32($tmp_translation_copy_id).'"
                        ;
';

                        // MINISTRY_LANG_ELEMENTS_PUBLISHED
                        $tmp_SELECT_ARRAY[5] = 'SELECT `wthrbg_lang_elem_components`.`ELEMENT_ID`,
                        `wthrbg_lang_elem_components`.`COPY_ID`,
                        `wthrbg_lang_elem_components`.`COMPONENT_ID`,
                        `wthrbg_lang_elem_components`.`PAGE_ID`,
                        `wthrbg_lang_elem_components`.`PROFILE_ID`,
                        `wthrbg_lang_elem_components`.`COPY_HASH`,
                        `wthrbg_lang_elem_components`.`LANG_ID`,
                        `wthrbg_lang_elem_components`.`ISACTIVE`,
                        `wthrbg_lang_elem_components`.`COMPLETION_STATE`,
                        `wthrbg_lang_elem_components`.`DRAFT_OWNER`,
                        `wthrbg_lang_elem_components`.`DATEDRAFTED`,
                        `wthrbg_lang_elem_components`.`DATEPUBLISHED`,
                        `wthrbg_lang_elem_components`.`PROFILE_TYPE`,
                        `wthrbg_lang_elem_components`.`COMPONENT_TYPE`,
                        `wthrbg_lang_elem_components`.`COMPONENT_SEQUENCE`,
                        `wthrbg_lang_elem_components`.`ELEMENT_CONTENT`,
                        `wthrbg_lang_elem_components`.`ELEMENT_CONTENT_BLOB`,
                        `wthrbg_lang_elem_components`.`CREATOR_ID`,
                        INET6_NTOA(`wthrbg_lang_elem_components`.`CREATOR_IP_V6`) AS CREATOR_IP_V6,
                        INET_NTOA(`wthrbg_lang_elem_components`.`CREATOR_IP`) AS CREATOR_IP,
                        `wthrbg_lang_elem_components`.`CREATOR_SESSION_ID`,
                        `wthrbg_lang_elem_components`.`MODIFIER_ID`,
                        INET6_NTOA(`wthrbg_lang_elem_components`.`MODIFIER_IP_V6`) AS MODIFIER_IP_V6,
                        INET_NTOA(`wthrbg_lang_elem_components`.`MODIFIER_IP`) AS MODIFIER_IP,
                        `wthrbg_lang_elem_components`.`MODIFIER_SESSION_ID`,
                        `wthrbg_lang_elem_components`.`DATEMODIFIED`,
                        `wthrbg_lang_elem_components`.`DATECREATED`
                        FROM `wthrbg_lang_elem_components`
                        WHERE `wthrbg_lang_elem_components`.`ISACTIVE`="1" 
                        AND `wthrbg_lang_elem_components`.`COMPLETION_STATE`="PUBLISHED"
                        AND `wthrbg_lang_elem_components`.`COPY_ID`="'.self::$mysqli->real_escape_string($tmp_translation_copy_id).'"
                        AND `wthrbg_lang_elem_components`.`COPY_ID_CRC32`="'.crc32($tmp_translation_copy_id).'"
                      ;
';
                        $oDB_RESP->process(self::$mysqli,$queryType, $tmp_SELECT_ARRAY);

                        $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'LANG_PACKS', 'LANG_ID');
                        $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'TRANSLATOR_LANGS', 'USERID|LANG_ID');
                        $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'LANG_REQUESTS', 'FULLSCRN_PROFILE_ID');
                        $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'LANG_REQUESTS', 'MINI_PROFILE_ID');
                        $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'MINISTRY_LANG_ELEMENTS_TRANSLATION', 'LANG_ID');
                        $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'MINISTRY_LANG_ELEMENTS_PUBLISHED', 'COPY_ID|LANG_ID');

                    }else{
                        //
                        // CMS CONTENT

                        $db_resp_target_profiles = 'LANG_PACKS|SITE_LANG_ELEMENTS_EN|TRANSLATOR_LANGS|SITE_LANG_ELEMENTS';
                        $db_resp_profile_field_cnt = '11|17|6|17';

                        $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE


                        // LANG_PACKS
                        $tmp_SELECT_ARRAY[0] = 'SELECT `wthrbg_lang_packs`.`LANGPACK_ID`,
                            `wthrbg_lang_packs`.`LANG_ID`,
                            `wthrbg_lang_packs`.`NAME`,
                            `wthrbg_lang_packs`.`NATIVE_NAME`,
                            `wthrbg_lang_packs`.`ISACTIVE`,
                            `wthrbg_lang_packs`.`RTL_FLAG`,
                            `wthrbg_lang_packs`.`FONT_SIZE_PERCENTAGE`,
                            `wthrbg_lang_packs`.`TIMER_FONT_SIZE_PERCENTAGE`,
                            `wthrbg_lang_packs`.`COPY_PADDING_TOP_PX`,
                            `wthrbg_lang_packs`.`DATEMODIFIED`,
                            `wthrbg_lang_packs`.`DATECREATED`
                        FROM `wthrbg_lang_packs`  
                        WHERE `wthrbg_lang_packs`.`ISACTIVE`="1";
';
                        // SITE_LANG_ELEMENTS_EN
                        $tmp_SELECT_ARRAY[1] = 'SELECT `wthrbg_sys_lang_elements`.`ELEMENT_ID`,
                            `wthrbg_sys_lang_elements`.`ELEMENT_REF_KEY`,
                            `wthrbg_sys_lang_elements`.`COUNTRY_ISO_CODE`,
                            `wthrbg_sys_lang_elements`.`ELEMENT_CONTENT`,
                            `wthrbg_sys_lang_elements`.`ELEMENT_CONTENT_BLOB`,
                            `wthrbg_sys_lang_elements`.`ELEMENT_NAME`,
                            `wthrbg_sys_lang_elements`.`ELEMENT_NAME_BLOB`,
                            `wthrbg_sys_lang_elements`.`ELEMENT_DESCRIPTION`,
                            `wthrbg_sys_lang_elements`.`ELEMENT_DESCRIPTION_BLOB`,
                            `wthrbg_sys_lang_elements`.`CREATOR_ID`,
                            `wthrbg_sys_lang_elements`.`CREATOR_IP`,
                            `wthrbg_sys_lang_elements`.`CREATOR_SESSION_ID`,
                            `wthrbg_sys_lang_elements`.`MODIFIER_ID`,
                            `wthrbg_sys_lang_elements`.`MODIFIER_IP`,
                            `wthrbg_sys_lang_elements`.`MODIFIER_SESSION_ID`,
                            `wthrbg_sys_lang_elements`.`DATEMODIFIED`,
                            `wthrbg_sys_lang_elements`.`DATECREATED`
                        FROM `wthrbg_sys_lang_elements` 
                        WHERE `wthrbg_sys_lang_elements`.`COUNTRY_ISO_CODE`="en";
';
                        // TRANSLATOR_LANGS
                        $tmp_SELECT_ARRAY[2] = 'SELECT `wthrbg_translator_lang_id`.`RELATION_ID`,
                            `wthrbg_translator_lang_id`.`USERID`,
                            `wthrbg_translator_lang_id`.`LANG_ID`,
                            `wthrbg_translator_lang_id`.`ISACTIVE`,
                            `wthrbg_translator_lang_id`.`DATEMODIFIED`,
                            `wthrbg_translator_lang_id`.`DATECREATED`
                        FROM `wthrbg_translator_lang_id`
                        WHERE `wthrbg_translator_lang_id`.`ISACTIVE`="1";
';

                        // SITE_LANG_ELEMENTS
                        $tmp_SELECT_ARRAY[3] = 'SELECT `wthrbg_sys_lang_elements`.`ELEMENT_ID`,
                            `wthrbg_sys_lang_elements`.`ELEMENT_REF_KEY`,
                            `wthrbg_sys_lang_elements`.`COUNTRY_ISO_CODE`,
                            `wthrbg_sys_lang_elements`.`ELEMENT_CONTENT`,
                            `wthrbg_sys_lang_elements`.`ELEMENT_CONTENT_BLOB`,
                            `wthrbg_sys_lang_elements`.`ELEMENT_NAME`,
                            `wthrbg_sys_lang_elements`.`ELEMENT_NAME_BLOB`,
                            `wthrbg_sys_lang_elements`.`ELEMENT_DESCRIPTION`,
                            `wthrbg_sys_lang_elements`.`ELEMENT_DESCRIPTION_BLOB`,
                            `wthrbg_sys_lang_elements`.`CREATOR_ID`,
                            `wthrbg_sys_lang_elements`.`CREATOR_IP`,
                            `wthrbg_sys_lang_elements`.`CREATOR_SESSION_ID`,
                            `wthrbg_sys_lang_elements`.`MODIFIER_ID`,
                            `wthrbg_sys_lang_elements`.`MODIFIER_IP`,
                            `wthrbg_sys_lang_elements`.`MODIFIER_SESSION_ID`,
                            `wthrbg_sys_lang_elements`.`DATEMODIFIED`,
                            `wthrbg_sys_lang_elements`.`DATECREATED`
                        FROM `wthrbg_sys_lang_elements` 
                        WHERE `wthrbg_sys_lang_elements`.`COUNTRY_ISO_CODE`!="en";
';

                        $oDB_RESP->process(self::$mysqli,$queryType, $tmp_SELECT_ARRAY);

                        $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'LANG_PACKS', 'LANG_ID');
                        $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'TRANSLATOR_LANGS', 'USERID|LANG_ID');
                        $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'SITE_LANG_ELEMENTS', 'ELEMENT_REF_KEY|COUNTRY_ISO_CODE');


                    }

                    //
                    // ALL DONE, PROCESSED AND READY FOR USE. RETURN RESPONSE OBJECT.
                    return $oDB_RESP;

                    break;
                case 'get_translation_data':

                    $force_profile_select_align = true;
                    $db_resp_process_serial = "!jesus_is_my_dear_lord!";        # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();         //$oUser->return_serial_handle();
                    $db_resp_target_profiles = 'LANG_PACKS|LANG_REQUESTS|MINISTRY_LANG_ELEMENTS_PUBLISHED|SITE_LANG_ELEMENTS_EN|TRANSLATOR_LANGS|SITE_LANG_ELEMENTS|MINISTRY_LANG_ELEMENTS_SAINT_SAVED|MINISTRY_LANG_ELEMENTS_TRANSLATION_EXCLUDE';                 # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '12|15|27|17|6|17|27|27';                          # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION :: GET ALL USERS. ALL USER-CLIENT RELATIONS. AND CLIENT DATA.
                    $tmp_SELECT_ARRAY = array();

                    // LANG_PACKS
                    $tmp_SELECT_ARRAY[0] = 'SELECT `wthrbg_lang_packs`.`LANGPACK_ID`,
                        `wthrbg_lang_packs`.`LANG_ID`,
                        `wthrbg_lang_packs`.`NAME`,
                        `wthrbg_lang_packs`.`NATIVE_NAME`,
                        `wthrbg_lang_packs`.`NATIVE_NAME_BLOB`,
                        `wthrbg_lang_packs`.`ISACTIVE`,
                        `wthrbg_lang_packs`.`RTL_FLAG`,
                        `wthrbg_lang_packs`.`FONT_SIZE_PERCENTAGE`,
                        `wthrbg_lang_packs`.`TIMER_FONT_SIZE_PERCENTAGE`,
                        `wthrbg_lang_packs`.`COPY_PADDING_TOP_PX`,
                        `wthrbg_lang_packs`.`DATEMODIFIED`,
                        `wthrbg_lang_packs`.`DATECREATED`
                    FROM `wthrbg_lang_packs`  
                    WHERE `wthrbg_lang_packs`.`ISACTIVE`="1";
';
                    // |LANG_REQUESTS|
                    $tmp_SELECT_ARRAY[1] = 'SELECT `wthrbg_profile_lang_requests`.`REQUEST_ID`,
                        `wthrbg_profile_lang_requests`.`FULLSCRN_PROFILE_ID`,
                        `wthrbg_profile_lang_requests`.`MINI_PROFILE_ID`,
                        `wthrbg_profile_lang_requests`.`LANG_ID`,
                        `wthrbg_profile_lang_requests`.`ISACTIVE`,
                        `wthrbg_profile_lang_requests`.`CREATOR_ID`,
                        INET6_NTOA(`wthrbg_profile_lang_requests`.`CREATOR_IP_V6`) AS CREATOR_IP_V6,
                        INET_NTOA(`wthrbg_profile_lang_requests`.`CREATOR_IP`) AS CREATOR_IP,
                        `wthrbg_profile_lang_requests`.`CREATOR_SESSION_ID`,
                        `wthrbg_profile_lang_requests`.`MODIFIER_ID`,
                        INET6_NTOA(`wthrbg_profile_lang_requests`.`MODIFIER_IP_V6`) AS MODIFIER_IP_V6,
                        INET_NTOA(`wthrbg_profile_lang_requests`.`MODIFIER_IP`) AS MODIFIER_IP,
                        `wthrbg_profile_lang_requests`.`MODIFIER_SESSION_ID`,
                        `wthrbg_profile_lang_requests`.`DATEMODIFIED`,
                        `wthrbg_profile_lang_requests`.`DATECREATED`
                    FROM `wthrbg_profile_lang_requests`
                    WHERE `wthrbg_profile_lang_requests`.`ISACTIVE`="1";
';
                    // MINISTRY_LANG_ELEMENTS_PUBLISHED
                    $tmp_SELECT_ARRAY[2] = 'SELECT `wthrbg_lang_elem_components`.`ELEMENT_ID`,
                    `wthrbg_lang_elem_components`.`COPY_ID`,
                    `wthrbg_lang_elem_components`.`COMPONENT_ID`,
                    `wthrbg_lang_elem_components`.`PAGE_ID`,
                    `wthrbg_lang_elem_components`.`PROFILE_ID`,
                    `wthrbg_lang_elem_components`.`COPY_HASH`,
                    `wthrbg_lang_elem_components`.`LANG_ID`,
                    `wthrbg_lang_elem_components`.`ISACTIVE`,
                    `wthrbg_lang_elem_components`.`COMPLETION_STATE`,
                    `wthrbg_lang_elem_components`.`DRAFT_OWNER`,
                    `wthrbg_lang_elem_components`.`DATEDRAFTED`,
                    `wthrbg_lang_elem_components`.`DATEPUBLISHED`,
                    `wthrbg_lang_elem_components`.`PROFILE_TYPE`,
                    `wthrbg_lang_elem_components`.`COMPONENT_TYPE`,
                    `wthrbg_lang_elem_components`.`COMPONENT_SEQUENCE`,
                    `wthrbg_lang_elem_components`.`ELEMENT_CONTENT`,
                    `wthrbg_lang_elem_components`.`ELEMENT_CONTENT_BLOB`,
                    `wthrbg_lang_elem_components`.`CREATOR_ID`,
                    INET6_NTOA(`wthrbg_lang_elem_components`.`CREATOR_IP_V6`) AS CREATOR_IP_V6,
                    INET_NTOA(`wthrbg_lang_elem_components`.`CREATOR_IP`) AS CREATOR_IP,
                    `wthrbg_lang_elem_components`.`CREATOR_SESSION_ID`,
                    `wthrbg_lang_elem_components`.`MODIFIER_ID`,
                    INET6_NTOA(`wthrbg_lang_elem_components`.`MODIFIER_IP_V6`) AS MODIFIER_IP_V6,
                    INET_NTOA(`wthrbg_lang_elem_components`.`MODIFIER_IP`) AS MODIFIER_IP,
                    `wthrbg_lang_elem_components`.`MODIFIER_SESSION_ID`,
                    `wthrbg_lang_elem_components`.`DATEMODIFIED`,
                    `wthrbg_lang_elem_components`.`DATECREATED`
                    FROM `wthrbg_lang_elem_components`
                    WHERE `wthrbg_lang_elem_components`.`ISACTIVE`="1" 
                    AND `wthrbg_lang_elem_components`.`COMPLETION_STATE`="PUBLISHED"
                  ;
';
                    // SITE_LANG_ELEMENTS_EN
                    $tmp_SELECT_ARRAY[3] = 'SELECT `wthrbg_sys_lang_elements`.`ELEMENT_ID`,
                        `wthrbg_sys_lang_elements`.`ELEMENT_REF_KEY`,
                        `wthrbg_sys_lang_elements`.`COUNTRY_ISO_CODE`,
                        `wthrbg_sys_lang_elements`.`ELEMENT_CONTENT`,
                        `wthrbg_sys_lang_elements`.`ELEMENT_CONTENT_BLOB`,
                        `wthrbg_sys_lang_elements`.`ELEMENT_NAME`,
                        `wthrbg_sys_lang_elements`.`ELEMENT_NAME_BLOB`,
                        `wthrbg_sys_lang_elements`.`ELEMENT_DESCRIPTION`,
                        `wthrbg_sys_lang_elements`.`ELEMENT_DESCRIPTION_BLOB`,
                        `wthrbg_sys_lang_elements`.`CREATOR_ID`,
                        `wthrbg_sys_lang_elements`.`CREATOR_IP`,
                        `wthrbg_sys_lang_elements`.`CREATOR_SESSION_ID`,
                        `wthrbg_sys_lang_elements`.`MODIFIER_ID`,
                        `wthrbg_sys_lang_elements`.`MODIFIER_IP`,
                        `wthrbg_sys_lang_elements`.`MODIFIER_SESSION_ID`,
                        `wthrbg_sys_lang_elements`.`DATEMODIFIED`,
                        `wthrbg_sys_lang_elements`.`DATECREATED`
                    FROM `wthrbg_sys_lang_elements` 
                    WHERE `wthrbg_sys_lang_elements`.`COUNTRY_ISO_CODE`="en";
';
                    // TRANSLATOR_LANGS
                    $tmp_SELECT_ARRAY[4] = 'SELECT `wthrbg_translator_lang_id`.`RELATION_ID`,
                        `wthrbg_translator_lang_id`.`USERID`,
                        `wthrbg_translator_lang_id`.`LANG_ID`,
                        `wthrbg_translator_lang_id`.`ISACTIVE`,
                        `wthrbg_translator_lang_id`.`DATEMODIFIED`,
                        `wthrbg_translator_lang_id`.`DATECREATED`
                    FROM `wthrbg_translator_lang_id`
                    WHERE `wthrbg_translator_lang_id`.`ISACTIVE`="1";
';

                    // SITE_LANG_ELEMENTS
                    $tmp_SELECT_ARRAY[5] = 'SELECT `wthrbg_sys_lang_elements`.`ELEMENT_ID`,
                        `wthrbg_sys_lang_elements`.`ELEMENT_REF_KEY`,
                        `wthrbg_sys_lang_elements`.`COUNTRY_ISO_CODE`,
                        `wthrbg_sys_lang_elements`.`ELEMENT_CONTENT`,
                        `wthrbg_sys_lang_elements`.`ELEMENT_CONTENT_BLOB`,
                        `wthrbg_sys_lang_elements`.`ELEMENT_NAME`,
                        `wthrbg_sys_lang_elements`.`ELEMENT_NAME_BLOB`,
                        `wthrbg_sys_lang_elements`.`ELEMENT_DESCRIPTION`,
                        `wthrbg_sys_lang_elements`.`ELEMENT_DESCRIPTION_BLOB`,
                        `wthrbg_sys_lang_elements`.`CREATOR_ID`,
                        `wthrbg_sys_lang_elements`.`CREATOR_IP`,
                        `wthrbg_sys_lang_elements`.`CREATOR_SESSION_ID`,
                        `wthrbg_sys_lang_elements`.`MODIFIER_ID`,
                        `wthrbg_sys_lang_elements`.`MODIFIER_IP`,
                        `wthrbg_sys_lang_elements`.`MODIFIER_SESSION_ID`,
                        `wthrbg_sys_lang_elements`.`DATEMODIFIED`,
                        `wthrbg_sys_lang_elements`.`DATECREATED`
                    FROM `wthrbg_sys_lang_elements` 
                    WHERE `wthrbg_sys_lang_elements`.`COUNTRY_ISO_CODE`!="en";
';

                    // MINISTRY_LANG_ELEMENTS_SAINT_SAVED
                    $tmp_SELECT_ARRAY[6] = 'SELECT `wthrbg_lang_elem_components`.`ELEMENT_ID`,
                    `wthrbg_lang_elem_components`.`COPY_ID`,
                    `wthrbg_lang_elem_components`.`COMPONENT_ID`,
                    `wthrbg_lang_elem_components`.`PAGE_ID`,
                    `wthrbg_lang_elem_components`.`PROFILE_ID`,
                    `wthrbg_lang_elem_components`.`COPY_HASH`,
                    `wthrbg_lang_elem_components`.`LANG_ID`,
                    `wthrbg_lang_elem_components`.`ISACTIVE`,
                    `wthrbg_lang_elem_components`.`COMPLETION_STATE`,
                    `wthrbg_lang_elem_components`.`DRAFT_OWNER`,
                    `wthrbg_lang_elem_components`.`DATEDRAFTED`,
                    `wthrbg_lang_elem_components`.`DATEPUBLISHED`,
                    `wthrbg_lang_elem_components`.`PROFILE_TYPE`,
                    `wthrbg_lang_elem_components`.`COMPONENT_TYPE`,
                    `wthrbg_lang_elem_components`.`COMPONENT_SEQUENCE`,
                    `wthrbg_lang_elem_components`.`ELEMENT_CONTENT`,
                    `wthrbg_lang_elem_components`.`ELEMENT_CONTENT_BLOB`,
                    `wthrbg_lang_elem_components`.`CREATOR_ID`,
                    INET6_NTOA(`wthrbg_lang_elem_components`.`CREATOR_IP_V6`) AS CREATOR_IP_V6,
                    INET_NTOA(`wthrbg_lang_elem_components`.`CREATOR_IP`) AS CREATOR_IP,
                    `wthrbg_lang_elem_components`.`CREATOR_SESSION_ID`,
                    `wthrbg_lang_elem_components`.`MODIFIER_ID`,
                    INET6_NTOA(`wthrbg_lang_elem_components`.`MODIFIER_IP_V6`) AS MODIFIER_IP_V6,
                    INET_NTOA(`wthrbg_lang_elem_components`.`MODIFIER_IP`) AS MODIFIER_IP,
                    `wthrbg_lang_elem_components`.`MODIFIER_SESSION_ID`,
                    `wthrbg_lang_elem_components`.`DATEMODIFIED`,
                    `wthrbg_lang_elem_components`.`DATECREATED`
                    FROM `wthrbg_lang_elem_components`
                    WHERE `wthrbg_lang_elem_components`.`ISACTIVE`="1" 
                    AND `wthrbg_lang_elem_components`.`COMPLETION_STATE`= "SAINT_SAVED"
                    ;
';

                    // MINISTRY_LANG_ELEMENTS_TRANSLATION_EXCLUDE
                    $tmp_SELECT_ARRAY[7] = 'SELECT `wthrbg_lang_elem_components`.`ELEMENT_ID`,
                    `wthrbg_lang_elem_components`.`COPY_ID`,
                    `wthrbg_lang_elem_components`.`COMPONENT_ID`,
                    `wthrbg_lang_elem_components`.`PAGE_ID`,
                    `wthrbg_lang_elem_components`.`PROFILE_ID`,
                    `wthrbg_lang_elem_components`.`COPY_HASH`,
                    `wthrbg_lang_elem_components`.`LANG_ID`,
                    `wthrbg_lang_elem_components`.`ISACTIVE`,
                    `wthrbg_lang_elem_components`.`COMPLETION_STATE`,
                    `wthrbg_lang_elem_components`.`DRAFT_OWNER`,
                    `wthrbg_lang_elem_components`.`DATEDRAFTED`,
                    `wthrbg_lang_elem_components`.`DATEPUBLISHED`,
                    `wthrbg_lang_elem_components`.`PROFILE_TYPE`,
                    `wthrbg_lang_elem_components`.`COMPONENT_TYPE`,
                    `wthrbg_lang_elem_components`.`COMPONENT_SEQUENCE`,
                    `wthrbg_lang_elem_components`.`ELEMENT_CONTENT`,
                    `wthrbg_lang_elem_components`.`ELEMENT_CONTENT_BLOB`,
                    `wthrbg_lang_elem_components`.`CREATOR_ID`,
                    INET6_NTOA(`wthrbg_lang_elem_components`.`CREATOR_IP_V6`) AS CREATOR_IP_V6,
                    INET_NTOA(`wthrbg_lang_elem_components`.`CREATOR_IP`) AS CREATOR_IP,
                    `wthrbg_lang_elem_components`.`CREATOR_SESSION_ID`,
                    `wthrbg_lang_elem_components`.`MODIFIER_ID`,
                    INET6_NTOA(`wthrbg_lang_elem_components`.`MODIFIER_IP_V6`) AS MODIFIER_IP_V6,
                    INET_NTOA(`wthrbg_lang_elem_components`.`MODIFIER_IP`) AS MODIFIER_IP,
                    `wthrbg_lang_elem_components`.`MODIFIER_SESSION_ID`,
                    `wthrbg_lang_elem_components`.`DATEMODIFIED`,
                    `wthrbg_lang_elem_components`.`DATECREATED`
                    FROM `wthrbg_lang_elem_components`
                    WHERE `wthrbg_lang_elem_components`.`ISACTIVE`="1" 
                    AND 
                          (`wthrbg_lang_elem_components`.`COMPLETION_STATE`= "SAINT_SAVED"
                            OR `wthrbg_lang_elem_components`.`COMPLETION_STATE`= "PUBLISHED"
                            OR `wthrbg_lang_elem_components`.`COMPLETION_STATE`= "CHECKED_OUT")
                    ;
';

                    $oDB_RESP->process(self::$mysqli,$queryType, $tmp_SELECT_ARRAY);

                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'TRANSLATOR_LANGS', 'USERID|LANG_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'LANG_REQUESTS', 'FULLSCRN_PROFILE_ID|LANG_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'LANG_REQUESTS', 'MINI_PROFILE_ID|LANG_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'SITE_LANG_ELEMENTS', 'ELEMENT_REF_KEY|COUNTRY_ISO_CODE');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'COPY_ID|LANG_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'MINISTRY_LANG_ELEMENTS_PUBLISHED', 'COPY_ID|LANG_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'MINISTRY_LANG_ELEMENTS_TRANSLATION_EXCLUDE', 'COPY_ID|LANG_ID');

                    //
                    // ALL DONE, PROCESSED AND READY FOR USE. RETURN RESPONSE OBJECT.
                    return $oDB_RESP;

                    break;
                case 'update_desired_languages':

                    $tmp_userid = $oEnv->oSESSION_MGR->getSessionParam('USERID');
                    $tmp_activityid = $oUser->generateNewKey(70);

                    $tmp_pipe_encrypt_lang_id = $oUser->retrieve_Form_Data('PIPED_ENCRYPT_LANG_ID');
                    $tmp_fullscrn_profile_id = $oUser->retrieve_Form_Data('PROFILE_ID');
                    $tmp_mini_profile_id = $oUser->retrieve_Form_Data('MINI_PROFILE_ID');

                    //error_log('1763->'.$tmp_pipe_encrypt_lang_id);

                    //
                    // BREAK OUT LANG ID
                    $tmp_encrypt_lang_id_ARRAY = explode('|', $tmp_pipe_encrypt_lang_id);
                    $tmp_loop_size = sizeof($tmp_encrypt_lang_id_ARRAY);

                    self::$query = '';
                    $tmp_lang_descript = '';

                    if($tmp_fullscrn_profile_id!=''){

                        for($i=0;$i<$tmp_loop_size;$i++){
                            $tmp_requestid = $oUser->generateNewKey(70);
                            $tmp_lang_id = $oEnv->paramTunnelDecrypt($tmp_encrypt_lang_id_ARRAY[$i]);
                            $tmp_lang_descript .= $tmp_lang_id.', ';

                            self::$query .= 'INSERT INTO `wthrbg_profile_lang_requests`
                            (`REQUEST_ID`,
                            `FULLSCRN_PROFILE_ID`,
                            `FULLSCRN_PROFILE_ID_CRC32`,
                            `LANG_ID`,
                            `CREATOR_ID`,
                            `CREATOR_IP_V6`,
                            `CREATOR_IP`,
                            `CREATOR_SESSION_ID`,
                            `MODIFIER_ID`,
                            `MODIFIER_IP_V6`,
                            `MODIFIER_IP`,
                            `MODIFIER_SESSION_ID`,
                            `DATEMODIFIED`)
                            VALUES
                            ("'.$tmp_requestid.'",
                            "'.self::$mysqli->real_escape_string($tmp_fullscrn_profile_id).'",
                            "'.crc32($tmp_fullscrn_profile_id).'",
                            "'.self::$mysqli->real_escape_string($tmp_lang_id).'",
                            "'.$tmp_userid.'",
                            INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            "' . session_id() . '",
                            "'.$tmp_userid.'",
                            INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            "' . session_id() . '",
                            "'.$ts.'");
                            ';

                        }

                        //error_log('1809->'.$tmp_lang_descript);

                        $tmp_query_prep = 'DELETE FROM `wthrbg_profile_lang_requests`
                        WHERE `FULLSCRN_PROFILE_ID` = "'.$tmp_fullscrn_profile_id.'"
                        AND `FULLSCRN_PROFILE_ID_CRC32` = "'.crc32($tmp_fullscrn_profile_id).'"
                        ;
                        ';

                        self::$result = $oEnv->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, $tmp_query_prep);

                        if(self::$mysqli->error){
                            self::$query_exception_result = "error";
                            throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                        }

                        $ID_ARRAY[0] = $tmp_fullscrn_profile_id;
                        $IDTYPE_ARRAY[0] = "FULLSCRN_PROFILE";

                        if($ID_ARRAY[0]==''){

                            self::$query_exception_result = "error";
                            throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: [paramTunnelDecrypt() NULL ERROR]');
                        }

                        $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                        $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                        $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME_BLOB'));

                        $tmp_lang_descript = rtrim($tmp_lang_descript, ', ');

                        $oUser->sys_activity_description = 'Requested language translations ('.$tmp_lang_descript.') for the full screen overlay profile, '.$tmp_profile_name.', have been updated.';

                        self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('ACTIVITY_LOG', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                        self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                        if(self::$mysqli->error){
                            self::$query_exception_result = "error";
                            throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                        }else{

                            $oUser->responseString = 'update_desired_languages=success';
                            return $oUser;
                        }

                    }else{

                        if($tmp_mini_profile_id!=''){
                            for($i=0;$i<$tmp_loop_size;$i++){

                                $tmp_requestid = $oUser->generateNewKey(70);
                                $tmp_lang_id = $oEnv->paramTunnelDecrypt($tmp_encrypt_lang_id_ARRAY[$i]);
                                $tmp_lang_descript .= $tmp_lang_id.', ';

                                self::$query .= 'INSERT INTO `wthrbg_profile_lang_requests`
                                (`REQUEST_ID`,
                                `MINI_PROFILE_ID`,
                                `MINI_PROFILE_ID_CRC32`,
                                `LANG_ID`,
                                `CREATOR_ID`,
                                `CREATOR_IP_V6`,
                                `CREATOR_IP`,
                                `CREATOR_SESSION_ID`,
                                `MODIFIER_ID`,
                                `MODIFIER_IP_V6`,
                                `MODIFIER_IP`,
                                `MODIFIER_SESSION_ID`,
                                `DATEMODIFIED`)
                                VALUES
                                ("'.$tmp_requestid.'",
                                "'.self::$mysqli->real_escape_string($tmp_mini_profile_id).'",
                                "'.crc32($tmp_mini_profile_id).'",
                                "'.self::$mysqli->real_escape_string($tmp_lang_id).'",
                                "'.$tmp_userid.'",
                                INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                "' . session_id() . '",
                                "'.$tmp_userid.'",
                                INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                "' . session_id() . '",
                                "'.$ts.'");
                                ';

                            }

                            $tmp_query_prep = 'DELETE FROM `wthrbg_profile_lang_requests`
                            WHERE `MINI_PROFILE_ID` = "'.$tmp_mini_profile_id.'"
                            AND `MINI_PROFILE_ID_CRC32` = "'.crc32($tmp_mini_profile_id).'"
                            ;
                            ';

                            self::$result = $oEnv->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, $tmp_query_prep);

                            if(self::$mysqli->error){
                                self::$query_exception_result = "error";
                                throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                            }

                            $ID_ARRAY[0] = $tmp_mini_profile_id;
                            $IDTYPE_ARRAY[0] = "MINI_PROFILE";

                            if($ID_ARRAY[0]==''){

                                self::$query_exception_result = "error";
                                throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: [paramTunnelDecrypt() NULL ERROR]');
                            }

                            $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                            $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                            $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('MINI_PROFILE',0,'PROFILE_NAME_BLOB'));

                            $tmp_lang_descript = rtrim($tmp_lang_descript, ', ');

                            $oUser->sys_activity_description = 'Requested language translations ('.$tmp_lang_descript.') for the full screen overlay profile, '.$tmp_profile_name.', have been updated.';

                            self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('ACTIVITY_LOG', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                            if(self::$mysqli->error){
                                self::$query_exception_result = "error";
                                throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                            }else{

                                $oUser->responseString = 'update_desired_languages=success';
                                return $oUser;
                            }
                        }

                    }

                    break;
                case 'update_schedule_time_format':

                    $tmp_userid = $oEnv->oSESSION_MGR->getSessionParam('USERID');
                    $tmp_activityid = $oUser->generateNewKey(70);

                    $tmp_page_id = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PAGE_ID'));
                    $tmp_profile_id = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID'));
                    $tmp_schedule_id = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('SCHEDULE_ID'));
                    $tmp_component_id = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('COMPONENT_ID'));
                    $tmp_time_format = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('TIME_FORMAT'));
                    $tmp_time_format_en = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('TIME_FORMAT_EN'));

                    $ID_ARRAY[0] = $tmp_profile_id;
                    $IDTYPE_ARRAY[0] = "FULLSCRN_PROFILE";

                    $ID_ARRAY[1] = $tmp_page_id;
                    $IDTYPE_ARRAY[1] = "FULLSCRN_PAGE";

                    if($ID_ARRAY[0]=='' || $ID_ARRAY[1]==''){

                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: [paramTunnelDecrypt() NULL ERROR]');
                    }

                    $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                    $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                    $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME_BLOB'));
                    $tmp_page_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PAGE',0,'PAGE_NAME_BLOB'));

                    $tmp_activitydescription = 'The time format has been updated to ['.$tmp_time_format_en.'] for a schedule on the page ('.$tmp_page_name.') of the overlay profile, '.$tmp_profile_name.'.';

                    self::$query = 'UPDATE `wthrbg_component_schedule`
                                SET
                                `TIME_FORMAT` = "'.$tmp_time_format.'",
                                `MODIFIER_ID` = "'.$tmp_userid.'",
                                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                                `DATEMODIFIED` = "'.$ts.'"
                                WHERE `SCHEDULE_ID` = "'.$tmp_schedule_id.'"
                                AND `COMPONENT_ID` = "'.$tmp_component_id.'"
                                AND `COMPONENT_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('COMPONENT_ID')).'"
                                AND `PROFILE_ID` = "'.$tmp_profile_id.'"
                                AND `PROFILE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                                AND `PAGE_ID` = "'.$tmp_page_id.'"
                                AND `PAGE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'"
                                LIMIT 1
                                ;
                                ';

                    self::$query .= 'UPDATE `wthrbg_fullscrn_page_components`
                                SET
                                `MODIFIER_ID` = "'.$tmp_userid.'",
                                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                                `DATEMODIFIED` = "'.$ts.'"
                                WHERE `COMPONENT_ID` = "'.$tmp_component_id.'"
                                  AND `COMPONENT_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('COMPONENT_ID')).'"
                                  AND `PAGE_ID` = "'.$tmp_page_id.'"
                                  AND `PAGE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'"
                                  AND `PROFILE_ID` = "'.$tmp_profile_id.'"
                                  AND `PROFILE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                                  LIMIT 1
                                  ;
                                ';

                    self::$query .= 'INSERT INTO `wthrbg_log_sys_user`
                                (`ACTIVITY_ID`,
                                 `FULL_SCRN_PROFILE_ID`,
                                `FULL_SCRN_PROFILE_ID_CRC32`,
                                `FULL_SCRN_PAGE_ID`,
                                `FULL_SCRN_PAGE_ID_CRC32`,
                                 `COMPONENT_ID`,
                                `COMPONENT_ID_CRC32`,
                                `MODIFIER_ID`,
                                `MODIFIER_ID_CRC32`,
                                `ACTIVITY_DESCRIPTION`,
                                `ACTIVITY_DESCRIPTION_BLOB`,
                                `PHPSESSION`,
                                `IPADDRESS_V6`,
                                `IPADDRESS`,
                                `HTTP_USER_AGENT`,
                                `CHANNEL`)
                                VALUES
                                ("'.$tmp_activityid.'",
                                "'.$tmp_profile_id.'",
                                "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'",
                                "'.$tmp_page_id.'",
                                "'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'",
                                "'.$tmp_component_id.'",
                                "'.crc32($oUser->retrieve_Form_Data('COMPONENT_ID')).'",
                                "'.$tmp_userid.'",
                                "'.crc32($tmp_userid).'",
                                "'.self::$mysqli->real_escape_string($oUser->searchTruncStr($tmp_activitydescription, 1000)).'",
                                "'.self::$mysqli->real_escape_string($tmp_activitydescription).'",
                                "' . session_id() . '",
                                INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                "'.$_SERVER['HTTP_USER_AGENT'].'",
                                "'.strtoupper($oEnv->oSESSION_MGR->getSessionParam("DEVICETYPE")).'");
                                ';

                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else{

                        $oUser->responseString = 'update_schedule_time_format=success';
                        return $oUser;
                    }


                    break;
                case 'update_schedule_date_format':

                    $tmp_userid = $oEnv->oSESSION_MGR->getSessionParam('USERID');
                    $tmp_activityid = $oUser->generateNewKey(70);

                    $tmp_page_id = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PAGE_ID'));
                    $tmp_profile_id = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID'));
                    $tmp_schedule_id = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('SCHEDULE_ID'));
                    $tmp_component_id = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('COMPONENT_ID'));
                    $tmp_date_format = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('DATE_FORMAT'));
                    $tmp_date_format_en = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('DATE_FORMAT_EN'));

                    $ID_ARRAY[0] = $tmp_profile_id;
                    $IDTYPE_ARRAY[0] = "FULLSCRN_PROFILE";

                    $ID_ARRAY[1] = $tmp_page_id;
                    $IDTYPE_ARRAY[1] = "FULLSCRN_PAGE";

                    if($ID_ARRAY[0]=='' || $ID_ARRAY[1]==''){

                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: [paramTunnelDecrypt() NULL ERROR]');
                    }

                    $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                    $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                    $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME_BLOB'));
                    $tmp_page_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PAGE',0,'PAGE_NAME_BLOB'));

                    $tmp_activitydescription = 'The date format has been updated to ['.$tmp_date_format_en.'] for a schedule on the page ('.$tmp_page_name.') of the overlay profile, '.$tmp_profile_name.'.';

                    self::$query = 'UPDATE `wthrbg_component_schedule`
                                SET
                                `DATE_FORMAT` = "'.$tmp_date_format.'",
                                `MODIFIER_ID` = "'.$tmp_userid.'",
                                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                                `DATEMODIFIED` = "'.$ts.'"
                                WHERE `SCHEDULE_ID` = "'.$tmp_schedule_id.'"
                                AND `COMPONENT_ID` = "'.$tmp_component_id.'"
                                AND `COMPONENT_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('COMPONENT_ID')).'"
                                AND `PROFILE_ID` = "'.$tmp_profile_id.'"
                                AND `PROFILE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                                AND `PAGE_ID` = "'.$tmp_page_id.'"
                                AND `PAGE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'"
                                LIMIT 1
                                ;
                                ';

                    self::$query .= 'UPDATE `wthrbg_fullscrn_page_components`
                                SET
                                `MODIFIER_ID` = "'.$tmp_userid.'",
                                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                                `DATEMODIFIED` = "'.$ts.'"
                                WHERE `COMPONENT_ID` = "'.$tmp_component_id.'"
                                  AND `COMPONENT_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('COMPONENT_ID')).'"
                                  AND `PAGE_ID` = "'.$tmp_page_id.'"
                                  AND `PAGE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'"
                                  AND `PROFILE_ID` = "'.$tmp_profile_id.'"
                                  AND `PROFILE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                                  LIMIT 1
                                  ;
                                ';

                    self::$query .= 'INSERT INTO `wthrbg_log_sys_user`
                                (`ACTIVITY_ID`,
                                 `FULL_SCRN_PROFILE_ID`,
                                `FULL_SCRN_PROFILE_ID_CRC32`,
                                `FULL_SCRN_PAGE_ID`,
                                `FULL_SCRN_PAGE_ID_CRC32`,
                                 `COMPONENT_ID`,
                                `COMPONENT_ID_CRC32`,
                                `MODIFIER_ID`,
                                `MODIFIER_ID_CRC32`,
                                `ACTIVITY_DESCRIPTION`,
                                `ACTIVITY_DESCRIPTION_BLOB`,
                                `PHPSESSION`,
                                `IPADDRESS_V6`,
                                `IPADDRESS`,
                                `HTTP_USER_AGENT`,
                                `CHANNEL`)
                                VALUES
                                ("'.$tmp_activityid.'",
                                "'.$tmp_profile_id.'",
                                "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'",
                                "'.$tmp_page_id.'",
                                "'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'",
                                "'.$tmp_component_id.'",
                                "'.crc32($oUser->retrieve_Form_Data('COMPONENT_ID')).'",
                                "'.$tmp_userid.'",
                                "'.crc32($tmp_userid).'",
                                "'.self::$mysqli->real_escape_string($oUser->searchTruncStr($tmp_activitydescription, 1000)).'",
                                "'.self::$mysqli->real_escape_string($tmp_activitydescription).'",
                                "' . session_id() . '",
                                INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                "'.$_SERVER['HTTP_USER_AGENT'].'",
                                "'.strtoupper($oEnv->oSESSION_MGR->getSessionParam("DEVICETYPE")).'");
                                ';

                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else{

                        $oUser->responseString = 'update_schedule_date_format=success';
                        return $oUser;
                    }

                    break;
                case 'sys_get_components':

                    //
                    // DO WE HAVE THIS OBS_ID?
                    $force_profile_select_align = true;
                    $db_resp_process_serial = "!jesus_is_my_dear_lord!";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();         //$oUser->return_serial_handle();
                    $db_resp_target_profiles = 'COMPONENT_TYPES';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '15';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION ::
                    $tmp_SELECT_ARRAY = array();

                    $tmp_SELECT_ARRAY[0] = 'SELECT `wthrbg_sys_page_component_types`.`TYPE_ID`,
                        `wthrbg_sys_page_component_types`.`TYPE_KEY`,
                        `wthrbg_sys_page_component_types`.`NAME`,
                        `wthrbg_sys_page_component_types`.`DESCRIPTION`,
                        `wthrbg_sys_page_component_types`.`DESCRIPTION_BLOB`,
                        `wthrbg_sys_page_component_types`.`URI_PATH_NEW`,
                        `wthrbg_sys_page_component_types`.`ISACTIVE`,
                        `wthrbg_sys_page_component_types`.`CREATOR_ID`,
                        `wthrbg_sys_page_component_types`.`CREATOR_IP`,
                        `wthrbg_sys_page_component_types`.`CREATOR_SESSION_ID`,
                        `wthrbg_sys_page_component_types`.`MODIFIER_ID`,
                        `wthrbg_sys_page_component_types`.`MODIFIER_IP`,
                        `wthrbg_sys_page_component_types`.`MODIFIER_SESSION_ID`,
                        `wthrbg_sys_page_component_types`.`DATEMODIFIED`,
                        `wthrbg_sys_page_component_types`.`DATECREATED`
                    FROM `wthrbg_sys_page_component_types`
                    WHERE `wthrbg_sys_page_component_types`.`ISACTIVE`="1" 
                    ORDER BY `wthrbg_sys_page_component_types`.`NAME`;
                    ';

                    $oDB_RESP->process(self::$mysqli,$queryType, $tmp_SELECT_ARRAY);

                    return $oDB_RESP;

                    break;
                case 'sys_add_new_user_type':

                    $tmp_userid = $oEnv->oSESSION_MGR->getSessionParam('USERID');

                    $tmp_typeid = $oUser->generateNewKey(70);
                    $tmp_activityid = $oUser->generateNewKey(70);

                    $tmp_user_permissions_id = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('USER_PERMISSIONS_ID'));
                    $tmp_name = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('NAME'));
                    $tmp_description = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('DESCRIPTION'));

                    $oUser->sys_activity_description = 'A new user type ('.$tmp_name.' - '.$tmp_description.') has been added to the system.';

                    self::$query = 'INSERT INTO `wthrbg_sys_user_types`
                    (`TYPE_ID`,
                    `USER_PERMISSIONS_ID`,
                    `NAME`,
                    `DESCRIPTION`,
                    `CREATOR_ID`,
                    `CREATOR_IP_V6`,
                    `CREATOR_IP`,
                    `CREATOR_SESSION_ID`,
                    `MODIFIER_ID`,
                    `MODIFIER_IP`,
                    `MODIFIER_IP_V6`,
                    `MODIFIER_SESSION_ID`,
                    `DATEMODIFIED`)
                    VALUES
                    ("'.$tmp_typeid.'",
                    "'.self::$mysqli->real_escape_string($tmp_user_permissions_id).'",
                    "'.self::$mysqli->real_escape_string($tmp_name).'",
                    "'.self::$mysqli->real_escape_string($tmp_description).'",
                    "'.$tmp_userid.'",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "' . session_id() . '",
                    "'.$tmp_userid.'",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "' . session_id() . '",
                    "'.$ts.'");
                    ';

                    self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('ACTIVITY_LOG', $queryType, $oEnv, $oUser, $oDB_RESP);

                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else{

                        return 'sys_add_new_user_type=success';
                    }

                    break;
                case 'sys_add_new_component':

                    $tmp_userid = $oEnv->oSESSION_MGR->getSessionParam('USERID');

                    $tmp_typeid = $oUser->generateNewKey(70);
                    $tmp_activityid = $oUser->generateNewKey(70);

                    /*
                    self::$http_param_handle["NAME"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'component_name');
                    self::$http_param_handle["DESCRIPTION"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'component_description');
                    self::$http_param_handle["KEY"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'component_key');
                     * */

                    $tmp_component_name = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('NAME'));
                    $tmp_component_description = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('DESCRIPTION'));
                    $tmp_component_key = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('TYPE_KEY'));
                    $tmp_component_uri_new = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('URI_NEW'));

                    $tmp_activitydescription = 'A new component ('.$tmp_component_name.') has been added to the system and is keyed as '.$tmp_component_key.'.';

                    //
                    // QUERY CONSTRUCTION ::
                    self::$query = 'INSERT INTO `wthrbg_sys_page_component_types`
                    (`TYPE_ID`,
                    `TYPE_KEY`,
                    `NAME`,
                    `DESCRIPTION`,
                    `DESCRIPTION_BLOB`,
                    `URI_PATH_NEW`,
                    `CREATOR_ID`,
                    `CREATOR_IP_V6`,
                    `CREATOR_IP`,
                    `CREATOR_SESSION_ID`,
                    `MODIFIER_ID`,
                    `MODIFIER_IP_V6`,
                    `MODIFIER_IP`,
                    `MODIFIER_SESSION_ID`,
                    `DATEMODIFIED`)
                    VALUES
                    ("'.$tmp_typeid.'",
                    "'.$tmp_component_key.'",
                    "'.$tmp_component_name.'",
                    "'.$tmp_component_description.'",
                    "'.$tmp_component_description.'",
                    "'.$tmp_component_uri_new.'",
                    "'.$tmp_userid.'",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "' . session_id() . '",
                    "'.$tmp_userid.'",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "' . session_id() . '",
                    "'.$ts.'");';

                    self::$query .= 'INSERT INTO `wthrbg_log_sys_user`
                    (`ACTIVITY_ID`,
                    `MODIFIER_ID`,
                    `MODIFIER_ID_CRC32`,
                    `ACTIVITY_DESCRIPTION`,
                    `ACTIVITY_DESCRIPTION_BLOB`,
                    `PHPSESSION`,
                    `IPADDRESS_V6`,
                    `IPADDRESS`,
                    `HTTP_USER_AGENT`,
                    `CHANNEL`)
                    VALUES
                    ("'.$tmp_activityid.'",
                    "'.$tmp_userid.'",
                    "'.crc32($tmp_userid).'",
                    "'.self::$mysqli->real_escape_string($oUser->searchTruncStr($tmp_activitydescription, 1000)).'",
                    "'.self::$mysqli->real_escape_string($tmp_activitydescription).'",
                    "' . session_id() . '",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "'.$_SERVER['HTTP_USER_AGENT'].'",
                    "'.strtoupper($oEnv->oSESSION_MGR->getSessionParam("DEVICETYPE")).'");
                    ';

                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else{

                        return 'sys_add_new_component=success';
                    }

                    break;
                case 'insert_subtitle_element':

                    $tmp_userid = $oEnv->oSESSION_MGR->getSessionParam('USERID');

                    $tmp_page_id = $oUser->retrieve_Form_Data('PAGE_ID');
                    $tmp_profile_id = $oUser->retrieve_Form_Data('PROFILE_ID');
                    $tmp_component_id = $oUser->retrieve_Form_Data('COMPONENT_ID');
                    $tmp_component_count = $oUser->retrieve_Form_Data('COMPONENT_COUNT');
                    $tmp_element_id = $oUser->retrieve_Form_Data('ELEMENT_ID');
                    $tmp_action_type = $oUser->retrieve_Form_Data('ACTION_TYPE');
                    $tmp_component_type_key = $oUser->retrieve_Form_Data('COMPONENT_TYPE_KEY');  // [SCHEDULE, BULLET_LIST, PARAGRAPH, ETC..]

                    $tmp_subtitle_copy = $oUser->retrieve_Form_Data('SUBTITLE_COPY');
                    $tmp_subtitle_delete = $oUser->retrieve_Form_Data('SUBTITLE_DELETE');
                    $tmp_subtitle_id = $oUser->retrieve_Form_Data('SUBTITLE_ID');
                    //$tmp_subtitle_alignment = $oUser->retrieve_Form_Data('SUBTITLE_ALIGNMENT');

                    //error_log('database.inc.php (2124) action_type->'.$tmp_action_type);
                    switch($tmp_action_type) {
                        case 'delete_subtitle':

                            $oUser->collectNewElementID('COMPONENT_ID', $tmp_component_id);
                            $oUser->collectNewElementID('ELEMENT_ID', $tmp_element_id);
                            $oUser->collectNewElementID('PARAGRAPH_ID', $tmp_subtitle_id);

                            $oUser->copy_content_field = 'SUBTITLE_COPY';
                            $oUser->copy_profile_type = 'FULLSCRN';
                            $oUser->copy_component_type = $tmp_component_type_key;

                            if($tmp_component_count==''){
                                $tmp_component_count = 0;

                            }

                            $ID_ARRAY[0] = $tmp_profile_id;
                            $IDTYPE_ARRAY[0] = "FULLSCRN_PROFILE";

                            $ID_ARRAY[1] = $tmp_page_id;
                            $IDTYPE_ARRAY[1] = "FULLSCRN_PAGE";

                            if($ID_ARRAY[0]=='' || $ID_ARRAY[1]==''){

                                self::$query_exception_result = "error";
                                throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: [paramTunnelDecrypt() NULL ERROR]');
                            }

                            $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                            $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                            $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME_BLOB'));
                            $tmp_page_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PAGE',0,'PAGE_NAME_BLOB'));

                            $oUser->sys_activity_description = 'A subtitle ['.$tmp_subtitle_copy.'] has been deleted from the page ('.$tmp_page_name.') of the overlay profile, '.$tmp_profile_name.'.';

                            //
                            // QUERY CONSTRUCTION ::
                            self::$query = 'UPDATE `wthrbg_fullscrn_page_components`
                            SET
                            `ISACTIVE` = "0",
                            `MODIFIER_ID` = "'.$tmp_userid.'",
                            `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_SESSION_ID` = "' . session_id() . '",
                            `DATEMODIFIED` = "'.$ts.'"
                            WHERE `COMPONENT_ID` = "'.self::$mysqli->real_escape_string($tmp_component_id).'"
                            AND `COMPONENT_ID_CRC32` = "'.crc32($tmp_component_id).'"
                            AND `PAGE_ID` = "'.self::$mysqli->real_escape_string($tmp_page_id).'"
                            AND `PAGE_ID_CRC32` = "'.crc32($tmp_page_id).'"
                            AND `PROFILE_ID` = "'.self::$mysqli->real_escape_string($tmp_profile_id).'"
                            AND `PROFILE_ID_CRC32` = "'.crc32($tmp_profile_id).'"
                            LIMIT 1;
                            ';

                            self::$query .= 'UPDATE `wthrbg_component_subtitle`
                            SET
                            `ISACTIVE` = "0",
                            `MODIFIER_ID` = "'.$tmp_userid.'",
                            `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_SESSION_ID` = "' . session_id() . '",
                            `DATEMODIFIED` = "'.$ts.'"
                            WHERE `SUBTITLE_ID` = "'.self::$mysqli->real_escape_string($tmp_subtitle_id).'"
                            AND `ELEMENT_ID` = "'.self::$mysqli->real_escape_string($tmp_element_id).'"
                            AND `ELEMENT_ID_CRC32` = "'.crc32($tmp_element_id).'"
                            AND `COMPONENT_ID` = "'.self::$mysqli->real_escape_string($tmp_component_id).'"
                            AND `COMPONENT_ID_CRC32` = "'.crc32($tmp_component_id).'"
                            AND `PAGE_ID` = "'.self::$mysqli->real_escape_string($tmp_page_id).'"
                            AND `PAGE_ID_CRC32` = "'.crc32($tmp_page_id).'"
                            AND `PROFILE_ID` = "'.self::$mysqli->real_escape_string($tmp_profile_id).'"
                            AND `PROFILE_ID_CRC32` = "'.crc32($tmp_profile_id).'"
                            LIMIT 1;
                            ';

                            self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('LANG_ELEMENT_DELETE', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('SEARCH_ENTRY_DELETE', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('ACTIVITY_LOG', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                            if(self::$mysqli->error){
                                $oUser->responseString = 'error';
                                self::$query_exception_result = "error";
                                throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                            }else{

                                $oUser->responseString = 'delete_subtitle=success';
                                return $oUser;
                            }

                            break;
                        case 'edit_subtitle':

                            $oUser->collectNewElementID('COMPONENT_ID', $tmp_component_id);
                            $oUser->collectNewElementID('ELEMENT_ID', $tmp_element_id);
                            $oUser->collectNewElementID('SUBTITLE_ID', $tmp_subtitle_id);

                            $oUser->copy_content_field = 'SUBTITLE_COPY';
                            $oUser->copy_profile_type = 'FULLSCRN';
                            $oUser->copy_component_type = $tmp_component_type_key;

                            if($tmp_component_count==''){
                                $tmp_component_count = 0;

                            }

                            $ID_ARRAY[0] = $tmp_profile_id;
                            $IDTYPE_ARRAY[0] = "FULLSCRN_PROFILE";

                            $ID_ARRAY[1] = $tmp_page_id;
                            $IDTYPE_ARRAY[1] = "FULLSCRN_PAGE";

                            if($ID_ARRAY[0]=='' || $ID_ARRAY[1]==''){

                                self::$query_exception_result = "error";
                                throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: [paramTunnelDecrypt() NULL ERROR]');
                            }

                            $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                            $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                            $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME_BLOB'));
                            $tmp_page_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PAGE',0,'PAGE_NAME_BLOB'));

                            $oUser->sys_activity_description = 'A subtitle has been updated to ['.$tmp_subtitle_copy.'] on the page ('.$tmp_page_name.') of the overlay profile, '.$tmp_profile_name.'.';

                            //
                            // QUERY CONSTRUCTION ::
                            self::$query = 'UPDATE `wthrbg_fullscrn_page_components`
                            SET
                            `MODIFIER_ID` = "'.$tmp_userid.'",
                            `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_SESSION_ID` = "' . session_id() . '",
                            `DATEMODIFIED` = "'.$ts.'"
                            WHERE `COMPONENT_ID` = "'.self::$mysqli->real_escape_string($tmp_component_id).'"
                            AND `COMPONENT_ID_CRC32` = "'.crc32($tmp_component_id).'"
                            AND `PAGE_ID` = "'.self::$mysqli->real_escape_string($tmp_page_id).'"
                            AND `PAGE_ID_CRC32` = "'.crc32($tmp_page_id).'"
                            AND `PROFILE_ID` = "'.self::$mysqli->real_escape_string($tmp_profile_id).'"
                            AND `PROFILE_ID_CRC32` = "'.crc32($tmp_profile_id).'"
                            LIMIT 1;
                            ';

                            self::$query .= 'UPDATE `wthrbg_component_subtitle`
                            SET
                            `MODIFIER_ID` = "'.$tmp_userid.'",
                            `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_SESSION_ID` = "' . session_id() . '",
                            `DATEMODIFIED` = "'.$ts.'"
                            WHERE `SUBTITLE_ID` = "'.self::$mysqli->real_escape_string($tmp_subtitle_id).'"
                            AND `ELEMENT_ID` = "'.self::$mysqli->real_escape_string($tmp_element_id).'"
                            AND `ELEMENT_ID_CRC32` = "'.crc32($tmp_element_id).'"
                            AND `COMPONENT_ID` = "'.self::$mysqli->real_escape_string($tmp_component_id).'"
                            AND `COMPONENT_ID_CRC32` = "'.crc32($tmp_component_id).'"
                            AND `PAGE_ID` = "'.self::$mysqli->real_escape_string($tmp_page_id).'"
                            AND `PAGE_ID_CRC32` = "'.crc32($tmp_page_id).'"
                            AND `PROFILE_ID` = "'.self::$mysqli->real_escape_string($tmp_profile_id).'"
                            AND `PROFILE_ID_CRC32` = "'.crc32($tmp_profile_id).'"
                            LIMIT 1;
                            ';

                            self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('LANG_ELEMENT_UPDATE', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('SEARCH_ENTRY_UPDATE', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('ACTIVITY_LOG', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                            if(self::$mysqli->error){
                                $oUser->responseString = 'error';
                                self::$query_exception_result = "error";
                                throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                            }else{

                                $oUser->responseString = 'edit_subtitle=success';
                                return $oUser;
                            }

                            break;
                        case 'new_subtitle':

                            //
                            // CREATE NEW PARAGRAPH
                            $tmp_component_id = $oUser->generateNewKey(70);
                            $tmp_copy_id = $oUser->generateNewKey(70);
                            $tmp_element_id = $oUser->generateNewKey(70);
                            $tmp_subtitle_id = $oUser->generateNewKey(70);

                            $oUser->save_Form_Data('COMPONENT_ID', $tmp_component_id);
                            $oUser->save_Form_Data('COPY_ID', $tmp_copy_id);
                            $oUser->save_Form_Data('ELEMENT_ID', $tmp_element_id);
                            $oUser->save_Form_Data('SUBTITLE_ID', $tmp_subtitle_id);

                            $oUser->collectNewElementID('COMPONENT_ID', $tmp_component_id);
                            $oUser->collectNewElementID('COPY_ID', $tmp_copy_id);
                            $oUser->collectNewElementID('ELEMENT_ID', $tmp_element_id);
                            $oUser->collectNewElementID('SUBTITLE_ID', $tmp_subtitle_id);

                            $oUser->copy_content_field = 'SUBTITLE_COPY';
                            $oUser->copy_profile_type = 'FULLSCRN';
                            $oUser->copy_component_type = $tmp_component_type_key;

                            if($tmp_component_count==''){
                                $tmp_component_count = 0;

                            }

                            $ID_ARRAY[0] = $tmp_profile_id;
                            $IDTYPE_ARRAY[0] = "FULLSCRN_PROFILE";

                            $ID_ARRAY[1] = $tmp_page_id;
                            $IDTYPE_ARRAY[1] = "FULLSCRN_PAGE";

                            if($ID_ARRAY[0]=='' || $ID_ARRAY[1]==''){

                                self::$query_exception_result = "error";
                                throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: [paramTunnelDecrypt() NULL ERROR]');
                            }

                            $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                            $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                            $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME_BLOB'));
                            $tmp_page_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PAGE',0,'PAGE_NAME_BLOB'));

                            $oUser->sys_activity_description = 'A new subtitle ['.$tmp_subtitle_copy.'] has been added to the page ('.$tmp_page_name.') of the overlay profile, '.$tmp_profile_name.'.';

                            //
                            // QUERY CONSTRUCTION ::
                            self::$query = 'INSERT INTO `wthrbg_fullscrn_page_components`
                            (`COMPONENT_ID`,
                             `COMPONENT_ID_CRC32`,
                            `PROFILE_ID`,
                            `PROFILE_ID_CRC32`,
                            `PAGE_ID`,
                            `PAGE_ID_CRC32`,
                            `COMPONENT_TYPE_KEY`,
                            `PAGE_SEQUENCE`,
                            `CREATOR_ID`,
                            `CREATOR_IP_V6`,
                            `CREATOR_IP`,
                            `CREATOR_SESSION_ID`,
                            `MODIFIER_ID`,
                            `MODIFIER_IP_V6`,
                            `MODIFIER_IP`,
                            `MODIFIER_SESSION_ID`,
                            `DATEMODIFIED`)
                            VALUES
                            ("'.$tmp_component_id.'",
                            "'.crc32($tmp_component_id).'",
                            "'.self::$mysqli->real_escape_string($tmp_profile_id).'",
                            "'.crc32($tmp_profile_id).'",
                            "'.self::$mysqli->real_escape_string($tmp_page_id).'",
                            "'.crc32($tmp_page_id).'",
                            "'.self::$mysqli->real_escape_string($tmp_component_type_key).'",
                            "'.self::$mysqli->real_escape_string($tmp_component_count).'",
                            "'.$tmp_userid.'",
                            INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            "' . session_id() . '",
                            "'.$tmp_userid.'",
                            INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            "' . session_id() . '",
                            "'.$ts.'");
                            ';

                            self::$query .= 'INSERT INTO `wthrbg_component_subtitle`
                            (`SUBTITLE_ID`,
                            `ELEMENT_ID`,
                            `ELEMENT_ID_CRC32`,
                            `COMPONENT_ID`,
                            `COMPONENT_ID_CRC32`,
                            `PAGE_ID`,
                            `PAGE_ID_CRC32`,
                            `PROFILE_ID`,
                            `PROFILE_ID_CRC32`,
                            `CREATOR_ID`,
                            `CREATOR_IP_V6`,
                            `CREATOR_IP`,
                            `CREATOR_SESSION_ID`,
                            `MODIFIER_ID`,
                            `MODIFIER_IP_V6`,
                            `MODIFIER_IP`,
                            `MODIFIER_SESSION_ID`,
                            `DATEMODIFIED`)
                            VALUES
                            ("'.$tmp_subtitle_id.'",
                            "'.$tmp_element_id.'",
                            "'.crc32($tmp_element_id).'",
                            "'.$tmp_component_id.'",
                            "'.crc32($tmp_component_id).'",
                            "'.$tmp_page_id.'",
                            "'.crc32($tmp_page_id).'",
                            "'.$tmp_profile_id.'",
                            "'.crc32($tmp_profile_id).'",
                            "'.$tmp_userid.'",
                            INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            "' . session_id() . '",
                            "'.$tmp_userid.'",
                            INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            "' . session_id() . '",
                            "'.$ts.'");
                            ';

                            self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('LANG_ELEMENT_NEW', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('SEARCH_ENTRY_NEW', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('ACTIVITY_LOG', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            break;


                    }

                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        $oUser->responseString = 'error';
                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else{

                        $oUser->responseString = 'insert_subtitle_element=success';

                        return $oUser;
                    }

                    break;
                case 'insert_paragraph_element':

                    $tmp_userid = $oEnv->oSESSION_MGR->getSessionParam('USERID');

                    $tmp_page_id = $oUser->retrieve_Form_Data('PAGE_ID');
                    $tmp_profile_id = $oUser->retrieve_Form_Data('PROFILE_ID');
                    $tmp_component_id = $oUser->retrieve_Form_Data('COMPONENT_ID');
                    $tmp_component_count = $oUser->retrieve_Form_Data('COMPONENT_COUNT');
                    $tmp_element_id = $oUser->retrieve_Form_Data('ELEMENT_ID');
                    $tmp_action_type = $oUser->retrieve_Form_Data('ACTION_TYPE');
                    $tmp_component_type_key = $oUser->retrieve_Form_Data('COMPONENT_TYPE_KEY');  // [SCHEDULE, BULLET_LIST, PARAGRAPH, ETC..]

                    $tmp_paragraph_copy = $oUser->retrieve_Form_Data('PARAGRAPH_COPY');
                    $tmp_paragraph_is_bold = $oUser->retrieve_Form_Data('PARAGRAPH_COPY_IS_BOLD');
                    $tmp_paragraph_is_blockquote = $oUser->retrieve_Form_Data('PARAGRAPH_COPY_IS_BLOCKQUOTE');
                    $tmp_paragraph_delete = $oUser->retrieve_Form_Data('PARAGRAPH_DELETE');
                    $tmp_paragraph_id = $oUser->retrieve_Form_Data('PARAGRAPH_ID');

                    //error_log('database.inc.php (2124) action_type->'.$tmp_action_type);
                    switch($tmp_action_type) {
                        case 'delete_paragraph':

                            //$oUser->save_Form_Data('COMPONENT_ID', $tmp_component_id);
                            //$oUser->save_Form_Data('ELEMENT_ID', $tmp_element_id);
                            //$oUser->save_Form_Data('PARAGRAPH_ID', $tmp_paragraph_id);

                            $oUser->collectNewElementID('COMPONENT_ID', $tmp_component_id);
                            $oUser->collectNewElementID('ELEMENT_ID', $tmp_element_id);
                            $oUser->collectNewElementID('PARAGRAPH_ID', $tmp_paragraph_id);

                            $oUser->copy_content_field = 'PARAGRAPH_COPY';
                            $oUser->copy_profile_type = 'FULLSCRN';
                            $oUser->copy_component_type = $tmp_component_type_key;

                            if($tmp_component_count==''){
                                $tmp_component_count = 0;

                            }

                            $ID_ARRAY[0] = $tmp_profile_id;
                            $IDTYPE_ARRAY[0] = "FULLSCRN_PROFILE";

                            $ID_ARRAY[1] = $tmp_page_id;
                            $IDTYPE_ARRAY[1] = "FULLSCRN_PAGE";

                            if($ID_ARRAY[0]=='' || $ID_ARRAY[1]==''){

                                self::$query_exception_result = "error";
                                throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: [paramTunnelDecrypt() NULL ERROR]');
                            }

                            $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                            $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                            $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME_BLOB'));
                            $tmp_page_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PAGE',0,'PAGE_NAME_BLOB'));

                            $oUser->sys_activity_description = 'A paragraph ['.$tmp_paragraph_copy.'] has been deleted from the page ('.$tmp_page_name.') of the overlay profile, '.$tmp_profile_name.'.';

                            //
                            // QUERY CONSTRUCTION ::
                            self::$query = 'UPDATE `wthrbg_fullscrn_page_components`
                            SET
                            `ISACTIVE` = "0",
                            `MODIFIER_ID` = "'.$tmp_userid.'",
                            `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_SESSION_ID` = "' . session_id() . '",
                            `DATEMODIFIED` = "'.$ts.'"
                            WHERE `COMPONENT_ID` = "'.self::$mysqli->real_escape_string($tmp_component_id).'"
                            AND `COMPONENT_ID_CRC32` = "'.crc32($tmp_component_id).'"
                            AND `PAGE_ID` = "'.self::$mysqli->real_escape_string($tmp_page_id).'"
                            AND `PAGE_ID_CRC32` = "'.crc32($tmp_page_id).'"
                            AND `PROFILE_ID` = "'.self::$mysqli->real_escape_string($tmp_profile_id).'"
                            AND `PROFILE_ID_CRC32` = "'.crc32($tmp_profile_id).'"
                            LIMIT 1;
                            ';

                            self::$query .= 'UPDATE `wthrbg_component_paragraph`
                            SET
                            `ISACTIVE` = "0",
                            `MODIFIER_ID` = "'.$tmp_userid.'",
                            `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_SESSION_ID` = "' . session_id() . '",
                            `DATEMODIFIED` = "'.$ts.'"
                            WHERE `PARAGRAPH_ID` = "'.self::$mysqli->real_escape_string($tmp_paragraph_id).'"
                            AND `ELEMENT_ID` = "'.self::$mysqli->real_escape_string($tmp_element_id).'"
                            AND `ELEMENT_ID_CRC32` = "'.crc32($tmp_element_id).'"
                            AND `COMPONENT_ID` = "'.self::$mysqli->real_escape_string($tmp_component_id).'"
                            AND `COMPONENT_ID_CRC32` = "'.crc32($tmp_component_id).'"
                            AND `PAGE_ID` = "'.self::$mysqli->real_escape_string($tmp_page_id).'"
                            AND `PAGE_ID_CRC32` = "'.crc32($tmp_page_id).'"
                            AND `PROFILE_ID` = "'.self::$mysqli->real_escape_string($tmp_profile_id).'"
                            AND `PROFILE_ID_CRC32` = "'.crc32($tmp_profile_id).'"
                            LIMIT 1;
                            ';

                            self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('LANG_ELEMENT_DELETE', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('SEARCH_ENTRY_DELETE', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('ACTIVITY_LOG', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                            if(self::$mysqli->error){
                                $oUser->responseString = 'error';
                                self::$query_exception_result = "error";
                                throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                            }else{

                                $oUser->responseString = 'delete_paragraph=success';
                                return $oUser;
                            }

                            break;
                        case 'edit_paragraph':

                            //$oUser->save_Form_Data('COMPONENT_ID', $tmp_component_id);
                            //$oUser->save_Form_Data('ELEMENT_ID', $tmp_element_id);
                            //$oUser->save_Form_Data('PARAGRAPH_ID', $tmp_paragraph_id);

                            $oUser->collectNewElementID('COMPONENT_ID', $tmp_component_id);
                            $oUser->collectNewElementID('ELEMENT_ID', $tmp_element_id);
                            $oUser->collectNewElementID('PARAGRAPH_ID', $tmp_paragraph_id);

                            $oUser->copy_content_field = 'PARAGRAPH_COPY';
                            $oUser->copy_profile_type = 'FULLSCRN';
                            $oUser->copy_component_type = $tmp_component_type_key;

                            if($tmp_component_count==''){
                                $tmp_component_count = 0;

                            }

                            $ID_ARRAY[0] = $tmp_profile_id;
                            $IDTYPE_ARRAY[0] = "FULLSCRN_PROFILE";

                            $ID_ARRAY[1] = $tmp_page_id;
                            $IDTYPE_ARRAY[1] = "FULLSCRN_PAGE";

                            if($ID_ARRAY[0]=='' || $ID_ARRAY[1]==''){

                                self::$query_exception_result = "error";
                                throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: [paramTunnelDecrypt() NULL ERROR]');
                            }

                            $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                            $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                            $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME_BLOB'));
                            $tmp_page_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PAGE',0,'PAGE_NAME_BLOB'));

                            $oUser->sys_activity_description = 'A paragraph has been updated to ['.$tmp_paragraph_copy.'] on the page ('.$tmp_page_name.') of the overlay profile, '.$tmp_profile_name.'.';

                            //
                            // QUERY CONSTRUCTION ::
                            self::$query = 'UPDATE `wthrbg_fullscrn_page_components`
                            SET
                            `MODIFIER_ID` = "'.$tmp_userid.'",
                            `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_SESSION_ID` = "' . session_id() . '",
                            `DATEMODIFIED` = "'.$ts.'"
                            WHERE `COMPONENT_ID` = "'.self::$mysqli->real_escape_string($tmp_component_id).'"
                            AND `COMPONENT_ID_CRC32` = "'.crc32($tmp_component_id).'"
                            AND `PAGE_ID` = "'.self::$mysqli->real_escape_string($tmp_page_id).'"
                            AND `PAGE_ID_CRC32` = "'.crc32($tmp_page_id).'"
                            AND `PROFILE_ID` = "'.self::$mysqli->real_escape_string($tmp_profile_id).'"
                            AND `PROFILE_ID_CRC32` = "'.crc32($tmp_profile_id).'"
                            LIMIT 1;
                            ';

                            self::$query .= 'UPDATE `wthrbg_component_paragraph`
                            SET
                            `IS_BOLD` = "'.self::$mysqli->real_escape_string($tmp_paragraph_is_bold).'",
                            `MODIFIER_ID` = "'.$tmp_userid.'",
                            `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_SESSION_ID` = "' . session_id() . '",
                            `DATEMODIFIED` = "'.$ts.'"
                            WHERE `PARAGRAPH_ID` = "'.self::$mysqli->real_escape_string($tmp_paragraph_id).'"
                            AND `ELEMENT_ID` = "'.self::$mysqli->real_escape_string($tmp_element_id).'"
                            AND `ELEMENT_ID_CRC32` = "'.crc32($tmp_element_id).'"
                            AND `COMPONENT_ID` = "'.self::$mysqli->real_escape_string($tmp_component_id).'"
                            AND `COMPONENT_ID_CRC32` = "'.crc32($tmp_component_id).'"
                            AND `PAGE_ID` = "'.self::$mysqli->real_escape_string($tmp_page_id).'"
                            AND `PAGE_ID_CRC32` = "'.crc32($tmp_page_id).'"
                            AND `PROFILE_ID` = "'.self::$mysqli->real_escape_string($tmp_profile_id).'"
                            AND `PROFILE_ID_CRC32` = "'.crc32($tmp_profile_id).'"
                            LIMIT 1;
                            ';

                            self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('LANG_ELEMENT_UPDATE', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('SEARCH_ENTRY_UPDATE', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('ACTIVITY_LOG', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                            if(self::$mysqli->error){
                                $oUser->responseString = 'error';
                                self::$query_exception_result = "error";
                                throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                            }else{

                                $oUser->responseString = 'edit_paragraph=success';
                                return $oUser;
                            }

                            break;
                        case 'new_paragraph':

                            //
                            // CREATE NEW PARAGRAPH
                            $tmp_component_id = $oUser->generateNewKey(70);
                            $tmp_copy_id = $oUser->generateNewKey(70);
                            $tmp_element_id = $oUser->generateNewKey(70);
                            $tmp_paragraph_id = $oUser->generateNewKey(70);

                            $oUser->save_Form_Data('COMPONENT_ID', $tmp_component_id);
                            $oUser->save_Form_Data('COPY_ID', $tmp_copy_id);
                            $oUser->save_Form_Data('ELEMENT_ID', $tmp_element_id);
                            $oUser->save_Form_Data('PARAGRAPH_ID', $tmp_paragraph_id);

                            $oUser->collectNewElementID('COMPONENT_ID', $tmp_component_id);
                            $oUser->collectNewElementID('COPY_ID', $tmp_copy_id);
                            $oUser->collectNewElementID('ELEMENT_ID', $tmp_element_id);
                            $oUser->collectNewElementID('PARAGRAPH_ID', $tmp_paragraph_id);

                            $oUser->copy_content_field = 'PARAGRAPH_COPY';
                            $oUser->copy_profile_type = 'FULLSCRN';
                            $oUser->copy_component_type = $tmp_component_type_key;

                            if($tmp_component_count==''){
                                $tmp_component_count = 0;

                            }

                            $ID_ARRAY[0] = $tmp_profile_id;
                            $IDTYPE_ARRAY[0] = "FULLSCRN_PROFILE";

                            $ID_ARRAY[1] = $tmp_page_id;
                            $IDTYPE_ARRAY[1] = "FULLSCRN_PAGE";

                            if($ID_ARRAY[0]=='' || $ID_ARRAY[1]==''){

                                self::$query_exception_result = "error";
                                throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: [paramTunnelDecrypt() NULL ERROR]');
                            }

                            $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                            $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                            $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME_BLOB'));
                            $tmp_page_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PAGE',0,'PAGE_NAME_BLOB'));

                            $oUser->sys_activity_description = 'A new paragraph ['.$tmp_paragraph_copy.'] has been added to the page ('.$tmp_page_name.') of the overlay profile, '.$tmp_profile_name.'.';

                            //
                            // QUERY CONSTRUCTION ::
                            self::$query = 'INSERT INTO `wthrbg_fullscrn_page_components`
                            (`COMPONENT_ID`,
                             `COMPONENT_ID_CRC32`,
                            `PROFILE_ID`,
                            `PROFILE_ID_CRC32`,
                            `PAGE_ID`,
                            `PAGE_ID_CRC32`,
                            `COMPONENT_TYPE_KEY`,
                            `PAGE_SEQUENCE`,
                            `CREATOR_ID`,
                            `CREATOR_IP_V6`,
                            `CREATOR_IP`,
                            `CREATOR_SESSION_ID`,
                            `MODIFIER_ID`,
                            `MODIFIER_IP_V6`,
                            `MODIFIER_IP`,
                            `MODIFIER_SESSION_ID`,
                            `DATEMODIFIED`)
                            VALUES
                            ("'.$tmp_component_id.'",
                            "'.crc32($tmp_component_id).'",
                            "'.self::$mysqli->real_escape_string($tmp_profile_id).'",
                            "'.crc32($tmp_profile_id).'",
                            "'.self::$mysqli->real_escape_string($tmp_page_id).'",
                            "'.crc32($tmp_page_id).'",
                            "'.self::$mysqli->real_escape_string($tmp_component_type_key).'",
                            "'.self::$mysqli->real_escape_string($tmp_component_count).'",
                            "'.$tmp_userid.'",
                            INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            "' . session_id() . '",
                            "'.$tmp_userid.'",
                            INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            "' . session_id() . '",
                            "'.$ts.'");
                            ';

                            self::$query .= 'INSERT INTO `wthrbg_component_paragraph`
                            (`PARAGRAPH_ID`,
                            `ELEMENT_ID`,
                            `ELEMENT_ID_CRC32`,
                            `COMPONENT_ID`,
                            `COMPONENT_ID_CRC32`,
                            `PAGE_ID`,
                            `PAGE_ID_CRC32`,
                            `PROFILE_ID`,
                            `PROFILE_ID_CRC32`,
                            `IS_BOLD`,
                            `CREATOR_ID`,
                            `CREATOR_IP_V6`,
                            `CREATOR_IP`,
                            `CREATOR_SESSION_ID`,
                            `MODIFIER_ID`,
                            `MODIFIER_IP_v6`,
                            `MODIFIER_IP`,
                            `MODIFIER_SESSION_ID`,
                            `DATEMODIFIED`)
                            VALUES
                            ("'.$tmp_paragraph_id.'",
                            "'.$tmp_element_id.'",
                            "'.crc32($tmp_element_id).'",
                            "'.$tmp_component_id.'",
                            "'.crc32($tmp_component_id).'",
                            "'.$tmp_page_id.'",
                            "'.crc32($tmp_page_id).'",
                            "'.$tmp_profile_id.'",
                            "'.crc32($tmp_profile_id).'",
                            "'.self::$mysqli->real_escape_string($tmp_paragraph_is_bold).'",
                            "'.$tmp_userid.'",
                            INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            "' . session_id() . '",
                            "'.$tmp_userid.'",
                            INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            "' . session_id() . '",
                            "'.$ts.'");
                            ';

                            self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('LANG_ELEMENT_NEW', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('SEARCH_ENTRY_NEW', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('ACTIVITY_LOG', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            break;


                    }

                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        $oUser->responseString = 'error';
                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else{

                        $oUser->responseString = 'insert_paragraph_element=success';

                        return $oUser;
                    }

                    break;
                case 'insert_bullet_element':

                    $tmp_userid = $oEnv->oSESSION_MGR->getSessionParam('USERID');

                    $tmp_page_id = $oUser->retrieve_Form_Data('PAGE_ID');
                    $tmp_profile_id = $oUser->retrieve_Form_Data('PROFILE_ID');
                    $tmp_component_id = $oUser->retrieve_Form_Data('COMPONENT_ID');
                    $tmp_component_count = $oUser->retrieve_Form_Data('COMPONENT_COUNT');
                    $tmp_bulletlist_bullet_element_id = $oUser->retrieve_Form_Data('ELEMENT_ID');
                    $tmp_action_type = $oUser->retrieve_Form_Data('ACTION_TYPE');
                    $tmp_component_type_key = $oUser->retrieve_Form_Data('COMPONENT_TYPE_KEY');  // [SCHEDULE, BULLET_LIST, ETC..]

                    $tmp_bullet_copy = $oUser->retrieve_Form_Data('BULLET_COPY');
                    $tmp_bullet_sequence = $oUser->retrieve_Form_Data('BULLET_SEQUENCE');
                    $tmp_bullet_type = $oUser->retrieve_Form_Data('BULLET_BULLET_TYPE');
                    $tmp_bulletlist_isordered = $oUser->retrieve_Form_Data('BULLETLIST_IS_ORDERED');
                    $tmp_bullet_copy_is_bold = $oUser->retrieve_Form_Data('BULLET_COPY_IS_BOLD');
                    $tmp_bullet_point_delete = $oUser->retrieve_Form_Data('BULLET_POINT_DELETE');
                    $tmp_bulletlist_delete = $oUser->retrieve_Form_Data('BULLETLIST_DELETE');
                    $tmp_bullet_bullet_id = $oUser->retrieve_Form_Data('BULLET_ID');

                    //error_log('database.inc.php (2127) action_type->'.$tmp_action_type);

                    switch($tmp_action_type){
                        case 'delete_bulletlist':

                            $oUser->save_Form_Data('ELEMENT_ID', $tmp_bulletlist_bullet_element_id);
                            $oUser->save_Form_Data('BULLETPOINT_ID', $tmp_bullet_bullet_id);

                            $oUser->collectNewElementID('ELEMENT_ID', $tmp_bulletlist_bullet_element_id);
                            $oUser->collectNewElementID('BULLETPOINT_ID', $tmp_bullet_bullet_id);

                            $oUser->copy_content_field = 'BULLET_COPY';
                            $oUser->copy_profile_type = 'FULLSCRN';
                            $oUser->copy_component_type = $tmp_component_type_key;

                            $ID_ARRAY[0] = $tmp_profile_id;
                            $IDTYPE_ARRAY[0] = "FULLSCRN_PROFILE";

                            $ID_ARRAY[1] = $tmp_page_id;
                            $IDTYPE_ARRAY[1] = "FULLSCRN_PAGE";

                            if($ID_ARRAY[0]=='' || $ID_ARRAY[1]==''){

                                self::$query_exception_result = "error";
                                throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: [paramTunnelDecrypt() NULL ERROR]');
                            }

                            $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                            $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                            $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME_BLOB'));
                            $tmp_page_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PAGE',0,'PAGE_NAME_BLOB'));

                            $oUser->sys_activity_description = 'A bullet list has been deleted from the page ('.$tmp_page_name.') of the overlay profile, '.$tmp_profile_name.'.';

                            //
                            // QUERY CONSTRUCTION ::
                            self::$query = 'UPDATE `wthrbg_lang_elem_components`
                            SET
                            `ISACTIVE` = "0",
                            `MODIFIER_ID` = "'.$tmp_userid.'",
                            `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_SESSION_ID` = "' . session_id() . '",
                            `DATEMODIFIED` = "'.$ts.'"
                            WHERE `COMPONENT_ID` = "'.self::$mysqli->real_escape_string($tmp_component_id).'"
                            AND `COMPONENT_ID_CRC32` = "'. crc32($tmp_component_id).'"
                            AND `PROFILE_ID` = "'.self::$mysqli->real_escape_string($tmp_profile_id).'"
                            AND `PROFILE_ID_CRC32` = "'.crc32($tmp_profile_id).'"
                            AND `PAGE_ID` = "'.self::$mysqli->real_escape_string($tmp_page_id).'"
                            AND `PAGE_ID_CRC32` = "'.crc32($tmp_page_id).'"
                            AND `ISACTIVE` = "1";
                            ';

                            self::$query .= 'UPDATE `wthrbg_component_bulletlist`
                            SET
                            `ISACTIVE` = "0",
                            `MODIFIER_ID` = "'.$tmp_userid.'",
                            `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_SESSION_ID` = "' . session_id() . '",
                            `DATEMODIFIED` = "'.$ts.'"
                            WHERE `COMPONENT_ID` = "'.self::$mysqli->real_escape_string($tmp_component_id).'"
                            AND `COMPONENT_ID_CRC32` = "'.crc32($tmp_component_id).'"
                            AND `PAGE_ID` = "'.self::$mysqli->real_escape_string($tmp_page_id).'"
                            AND `PAGE_ID_CRC32` = "'.crc32($tmp_page_id).'"
                            AND `PROFILE_ID` = "'.self::$mysqli->real_escape_string($tmp_profile_id).'"
                            AND `PROFILE_ID_CRC32` = "'.crc32($tmp_profile_id).'"
                            LIMIT 1
                            ;
                            ';

                            self::$query .= 'UPDATE `wthrbg_component_bulletlist_bullets`
                            SET
                            `ISACTIVE` = "0",
                            `MODIFIER_ID` = "'.$tmp_userid.'",
                            `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_SESSION_ID` = "' . session_id() . '",
                            `DATEMODIFIED` = "'.$ts.'"
                            WHERE `COMPONENT_ID` = "'.self::$mysqli->real_escape_string($tmp_component_id).'"
                            AND `COMPONENT_ID_CRC32` = "'.crc32($tmp_component_id).'"
                            AND `PAGE_ID` = "'.self::$mysqli->real_escape_string($tmp_page_id).'"
                            AND `PAGE_ID_CRC32` = "'.crc32($tmp_page_id).'"
                            AND `PROFILE_ID` = "'.self::$mysqli->real_escape_string($tmp_profile_id).'"
                            AND `PROFILE_ID_CRC32` = "'.crc32($tmp_profile_id).'"
                            AND `ISACTIVE` = "1";
                            ';

                            self::$query .= 'UPDATE `wthrbg_fullscrn_page_components`
                            SET
                            `ISACTIVE` = "0",
                            `MODIFIER_ID` = "'.$tmp_userid.'",
                            `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_SESSION_ID` = "' . session_id() . '",
                            `DATEMODIFIED` = "'.$ts.'"
                            WHERE `COMPONENT_ID` = "'.self::$mysqli->real_escape_string($tmp_component_id).'"
                            AND `COMPONENT_ID_CRC32` = "'.crc32($tmp_component_id).'"
                            AND `PAGE_ID` = "'.self::$mysqli->real_escape_string($tmp_page_id).'"
                            AND `PAGE_ID_CRC32` = "'.crc32($tmp_page_id).'"
                            AND `PROFILE_ID` = "'.self::$mysqli->real_escape_string($tmp_profile_id).'"
                            AND `PROFILE_ID_CRC32` = "'.crc32($tmp_profile_id).'"
                            LIMIT 1
                            ;
                            ';

                            self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('SEARCH_ENTRY_COMPONENT_DELETE', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('ACTIVITY_LOG', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                            if(self::$mysqli->error){
                                $oUser->responseString = 'error';
                                self::$query_exception_result = "error";
                                throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                            }else{

                                $oUser->responseString = 'delete_bulletlist=success';

                                return $oUser;
                            }

                            break;
                        case 'edit_bulletlist_bullet':

                            $oUser->save_Form_Data('ELEMENT_ID', $tmp_bulletlist_bullet_element_id);
                            $oUser->save_Form_Data('BULLETPOINT_ID', $tmp_bullet_bullet_id);

                            $oUser->collectNewElementID('ELEMENT_ID', $tmp_bulletlist_bullet_element_id);
                            $oUser->collectNewElementID('BULLETPOINT_ID', $tmp_bullet_bullet_id);

                            $oUser->copy_content_field = 'BULLET_COPY';
                            $oUser->copy_profile_type = 'FULLSCRN';
                            $oUser->copy_component_type = $tmp_component_type_key;

                            $ID_ARRAY[0] = $tmp_profile_id;
                            $IDTYPE_ARRAY[0] = "FULLSCRN_PROFILE";

                            $ID_ARRAY[1] = $tmp_page_id;
                            $IDTYPE_ARRAY[1] = "FULLSCRN_PAGE";

                            if($ID_ARRAY[0]=='' || $ID_ARRAY[1]==''){

                                self::$query_exception_result = "error";
                                throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: [paramTunnelDecrypt() NULL ERROR]');
                            }

                            $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                            $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                            $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME_BLOB'));
                            $tmp_page_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PAGE',0,'PAGE_NAME_BLOB'));

                            //
                            // DELETE BULLET POINT AND IT'S COPY AND IT'S SEARCH CONTENT
                            if($tmp_bullet_point_delete=='1' || $tmp_bullet_point_delete==1){

                                $oUser->sys_activity_description = 'A bullet point ['.$tmp_bullet_copy.'] has been deleted from the page ('.$tmp_page_name.') of the overlay profile, '.$tmp_profile_name.'.';

                                //
                                // QUERY CONSTRUCTION ::
                                self::$query = 'UPDATE `wthrbg_lang_elem_components`
                                SET
                                `ISACTIVE` = "0",
                                `MODIFIER_ID` = "'.$tmp_userid.'",
                                `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                                `DATEMODIFIED` = "'.$ts.'"
                                WHERE `ELEMENT_ID` = "'.self::$mysqli->real_escape_string($tmp_bulletlist_bullet_element_id).'"
                                AND `ELEMENT_ID_CRC32` = "'. crc32($oUser->retrieve_Form_Data('ELEMENT_ID')).'"
                                AND `PROFILE_ID` = "'.self::$mysqli->real_escape_string($tmp_profile_id).'"
                                AND `PROFILE_ID_CRC32` = "'.crc32($tmp_profile_id).'"
                                AND `PAGE_ID` = "'.self::$mysqli->real_escape_string($tmp_page_id).'"
                                AND `PAGE_ID_CRC32` = "'.crc32($tmp_page_id).'"
                                LIMIT 1;
                                ';

                                self::$query .= 'UPDATE `wthrbg_component_bulletlist`
                                SET
                                `MODIFIER_ID` = "'.$tmp_userid.'",
                                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                                `DATEMODIFIED` = "'.$ts.'"
                                WHERE `COMPONENT_ID` = "'.self::$mysqli->real_escape_string($tmp_component_id).'"
                                AND `COMPONENT_ID_CRC32` = "'.crc32($tmp_component_id).'"
                                AND `PAGE_ID` = "'.self::$mysqli->real_escape_string($tmp_page_id).'"
                                AND `PAGE_ID_CRC32` = "'.crc32($tmp_page_id).'"
                                AND `PROFILE_ID` = "'.self::$mysqli->real_escape_string($tmp_profile_id).'"
                                AND `PROFILE_ID_CRC32` = "'.crc32($tmp_profile_id).'"
                                LIMIT 1
                                ;
                                ';

                                self::$query .= 'UPDATE `wthrbg_component_bulletlist_bullets`
                                SET
                                `ISACTIVE` = "0",
                                `MODIFIER_ID` = "'.$tmp_userid.'",
                                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                                `DATEMODIFIED` = "'.$ts.'"
                                WHERE `BULLET_ID` = "'.self::$mysqli->real_escape_string($tmp_bullet_bullet_id).'"
                                AND `ELEMENT_ID` = "'.self::$mysqli->real_escape_string($tmp_bulletlist_bullet_element_id).'"
                                AND `ELEMENT_ID_CRC32` = "'.crc32($tmp_bulletlist_bullet_element_id).'"
                                AND `PAGE_ID` = "'.self::$mysqli->real_escape_string($tmp_page_id).'"
                                AND `PROFILE_ID` = "'.self::$mysqli->real_escape_string($tmp_profile_id).'"
                                LIMIT 1;
                                ';

                                self::$query .= 'UPDATE `wthrbg_fullscrn_page_components`
                                SET
                                `MODIFIER_ID` = "'.$tmp_userid.'",
                                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                                `DATEMODIFIED` = "'.$ts.'"
                                WHERE `COMPONENT_ID` = "'.self::$mysqli->real_escape_string($tmp_component_id).'"
                                  AND `COMPONENT_ID_CRC32` = "'.crc32($tmp_component_id).'"
                                  AND `PAGE_ID` = "'.self::$mysqli->real_escape_string($tmp_page_id).'"
                                  AND `PAGE_ID_CRC32` = "'.crc32($tmp_page_id).'"
                                  AND `PROFILE_ID` = "'.self::$mysqli->real_escape_string($tmp_profile_id).'"
                                  AND `PROFILE_ID_CRC32` = "'.crc32($tmp_profile_id).'"
                                  LIMIT 1
                                  ;
                                ';

                                self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('SEARCH_ENTRY_DELETE', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                                self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('ACTIVITY_LOG', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                                self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                                if(self::$mysqli->error){
                                    $oUser->responseString = 'error';
                                    self::$query_exception_result = "error";
                                    throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                                }else{

                                    $oUser->responseString = 'delete_bulletlist_bullet=success';

                                    return $oUser;
                                }

                            }else{

                                $oUser->sys_activity_description = 'A bullet point ['.$tmp_bullet_copy.'] has been updated on the page ('.$tmp_page_name.') of the overlay profile, '.$tmp_profile_name.'.';

                                //
                                // QUERY CONSTRUCTION ::
                                self::$query = self::$queryMakerForAllMonatony->returnQueryBusiness('LANG_ELEMENT_UPDATE', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                                self::$query .= 'UPDATE `wthrbg_component_bulletlist_bullets`
                                SET
                                `DESCRIPTION_IS_BOLD` = "'.$tmp_bullet_copy_is_bold.'",
                                `MODIFIER_ID` = "'.$tmp_userid.'",
                                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                                `DATEMODIFIED` = "'.$ts.'"
                                WHERE `BULLET_ID` = "'.self::$mysqli->real_escape_string($tmp_bullet_bullet_id).'"
                                AND `ELEMENT_ID` = "'.self::$mysqli->real_escape_string($tmp_bulletlist_bullet_element_id).'"
                                AND `ELEMENT_ID_CRC32` = "'.crc32($tmp_bulletlist_bullet_element_id).'"
                                AND `COMPONENT_ID` = "'.self::$mysqli->real_escape_string($tmp_component_id).'"
                                AND `COMPONENT_ID_CRC32` = "'.crc32($tmp_component_id).'"
                                AND `PAGE_ID` = "'.self::$mysqli->real_escape_string($tmp_page_id).'"
                                AND `PROFILE_ID` = "'.self::$mysqli->real_escape_string($tmp_profile_id).'"
                                LIMIT 1;
                                ';

                                self::$query .= 'UPDATE `wthrbg_component_bulletlist`
                                SET
                                `MODIFIER_ID` = "'.$tmp_userid.'",
                                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                                `DATEMODIFIED` = "'.$ts.'"
                                WHERE `COMPONENT_ID` = "'.$tmp_component_id.'"
                                  AND `COMPONENT_ID_CRC32` = "'.crc32($tmp_component_id).'"
                                  AND `PAGE_ID` = "'.$tmp_page_id.'"
                                  AND `PAGE_ID_CRC32` = "'.crc32($tmp_page_id).'"
                                  AND `PROFILE_ID` = "'.$tmp_profile_id.'"
                                  AND `PROFILE_ID_CRC32` = "'.crc32($tmp_profile_id).'"
                                  LIMIT 1
                                  ;
                                ';

                                self::$query .= 'UPDATE `wthrbg_fullscrn_page_components`
                                SET
                                `MODIFIER_ID` = "'.$tmp_userid.'",
                                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                                `DATEMODIFIED` = "'.$ts.'"
                                WHERE `COMPONENT_ID` = "'.self::$mysqli->real_escape_string($tmp_component_id).'"
                                  AND `COMPONENT_ID_CRC32` = "'.crc32($tmp_component_id).'"
                                  AND `PAGE_ID` = "'.self::$mysqli->real_escape_string($tmp_page_id).'"
                                  AND `PAGE_ID_CRC32` = "'.crc32($tmp_page_id).'"
                                  AND `PROFILE_ID` = "'.self::$mysqli->real_escape_string($tmp_profile_id).'"
                                  AND `PROFILE_ID_CRC32` = "'.crc32($tmp_profile_id).'"
                                  LIMIT 1
                                  ;
                                ';

                                self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('SEARCH_ENTRY_UPDATE', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                                self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('ACTIVITY_LOG', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                                self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                                if(self::$mysqli->error){
                                    self::$query_exception_result = "error";
                                    throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                                }else{

                                    $oUser->responseString = 'edit_schedule_event=success';
                                    return $oUser;
                                }


                            }

                            break;
                        case 'new_bullet_point':

                            if($tmp_component_id!=''){

                                //
                                // ADD BULLET POINT TO EXISTING LIST
                                $tmp_copy_id = $oUser->generateNewKey(70);
                                $tmp_element_id = $oUser->generateNewKey(70);
                                $tmp_bulletpoint_id = $oUser->generateNewKey(70);

                                $oUser->save_Form_Data('COPY_ID', $tmp_copy_id);
                                $oUser->save_Form_Data('ELEMENT_ID', $tmp_element_id);
                                $oUser->save_Form_Data('BULLETPOINT_ID', $tmp_bulletpoint_id);

                                $oUser->collectNewElementID('COPY_ID', $tmp_copy_id);
                                $oUser->collectNewElementID('ELEMENT_ID', $tmp_element_id);
                                $oUser->collectNewElementID('BULLETPOINT_ID', $tmp_bulletpoint_id);

                                $oUser->copy_content_field = 'BULLET_COPY';
                                $oUser->copy_profile_type = 'FULLSCRN';
                                $oUser->copy_component_type = $tmp_component_type_key;

                                $ID_ARRAY[0] = $tmp_profile_id;
                                $IDTYPE_ARRAY[0] = "FULLSCRN_PROFILE";

                                $ID_ARRAY[1] = $tmp_page_id;
                                $IDTYPE_ARRAY[1] = "FULLSCRN_PAGE";

                                if($ID_ARRAY[0]=='' || $ID_ARRAY[1]==''){

                                    self::$query_exception_result = "error";
                                    throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: [paramTunnelDecrypt() NULL ERROR]');
                                }

                                $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                                $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                                $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME_BLOB'));
                                $tmp_page_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PAGE',0,'PAGE_NAME_BLOB'));

                                $oUser->sys_activity_description = 'A new bullet point ['.$tmp_bullet_copy.'] has been added to the page ('.$tmp_page_name.') of the overlay profile, '.$tmp_profile_name.'.';

                                self::$query = 'INSERT INTO `wthrbg_component_bulletlist_bullets`
                                (`BULLET_ID`,
                                `ELEMENT_ID`,
                                `ELEMENT_ID_CRC32`,
                                `COMPONENT_ID`,
                                `COMPONENT_ID_CRC32`,
                                `PAGE_ID`,
                                `PAGE_ID_CRC32`,
                                `PROFILE_ID`,
                                `PROFILE_ID_CRC32`,
                                `DESCRIPTION_IS_BOLD`,
                                `SEQUENCE`,
                                `CREATOR_ID`,
                                `CREATOR_IP_V6`,
                                `CREATOR_IP`,
                                `CREATOR_SESSION_ID`,
                                `MODIFIER_ID`,
                                `MODIFIER_IP_V6`,
                                `MODIFIER_IP`,
                                `MODIFIER_SESSION_ID`,
                                `DATEMODIFIED`)
                                VALUES
                                ("'.$tmp_bulletpoint_id.'",
                                "'.$tmp_element_id.'",
                                "'.crc32($tmp_element_id).'",
                                "'.self::$mysqli->real_escape_string($tmp_component_id).'",
                                "'.crc32($tmp_component_id).'",
                                "'.self::$mysqli->real_escape_string($tmp_page_id).'",
                                "'.crc32($tmp_page_id).'",
                                "'.self::$mysqli->real_escape_string($tmp_profile_id).'",
                                "'.crc32($tmp_profile_id).'",
                                "'.self::$mysqli->real_escape_string($tmp_bullet_copy_is_bold).'",
                                "'.self::$mysqli->real_escape_string($tmp_bullet_sequence).'",
                                "'.$tmp_userid.'",
                                INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                "' . session_id() . '",
                                "'.$tmp_userid.'",
                                INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                "' . session_id() . '",
                                "'.$ts.'");
                                ';

                                self::$query .= 'UPDATE `wthrbg_fullscrn_page_components`
                                SET
                                `MODIFIER_ID` = "'.$tmp_userid.'",
                                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                                `DATEMODIFIED` = "'.$ts.'"
                                WHERE `COMPONENT_ID` = "'.self::$mysqli->real_escape_string($tmp_component_id).'"
                                  AND `COMPONENT_ID_CRC32` = "'.crc32($tmp_component_id).'"
                                  AND `PAGE_ID` = "'.self::$mysqli->real_escape_string($tmp_page_id).'"
                                  AND `PAGE_ID_CRC32` = "'.crc32($tmp_page_id).'"
                                  AND `PROFILE_ID` = "'.self::$mysqli->real_escape_string($tmp_profile_id).'"
                                  AND `PROFILE_ID_CRC32` = "'.crc32($tmp_profile_id).'"
                                  LIMIT 1
                                  ;
                                ';

                                self::$query .= 'UPDATE `wthrbg_component_bulletlist`
                                SET
                                `MODIFIER_ID` = "'.$tmp_userid.'",
                                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                                `DATEMODIFIED` = "'.$ts.'"
                                WHERE `COMPONENT_ID` = "'.$tmp_component_id.'"
                                  AND `COMPONENT_ID_CRC32` = "'.crc32($tmp_component_id).'"
                                  AND `PAGE_ID` = "'.$tmp_page_id.'"
                                  AND `PAGE_ID_CRC32` = "'.crc32($tmp_page_id).'"
                                  AND `PROFILE_ID` = "'.$tmp_profile_id.'"
                                  AND `PROFILE_ID_CRC32` = "'.crc32($tmp_profile_id).'"
                                  LIMIT 1
                                  ;
                                ';

                                self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('LANG_ELEMENT_NEW', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                                self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('SEARCH_ENTRY_NEW', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                                self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('ACTIVITY_LOG', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            }else{

                                //
                                // CREATE NEW LIST AND ADD A BULLET
                                $tmp_component_id = $oUser->generateNewKey(70);
                                $tmp_copy_id = $oUser->generateNewKey(70);
                                $tmp_element_id = $oUser->generateNewKey(70);
                                $tmp_bulletlist_id = $oUser->generateNewKey(70);
                                $tmp_bulletpoint_id = $oUser->generateNewKey(70);

                                $oUser->save_Form_Data('COMPONENT_ID', $tmp_component_id);
                                $oUser->save_Form_Data('COPY_ID', $tmp_copy_id);
                                $oUser->save_Form_Data('ELEMENT_ID', $tmp_element_id);
                                $oUser->save_Form_Data('BULLETLIST_ID', $tmp_bulletlist_id);
                                $oUser->save_Form_Data('BULLETPOINT_ID', $tmp_bulletpoint_id);

                                $oUser->collectNewElementID('COMPONENT_ID', $tmp_component_id);
                                $oUser->collectNewElementID('COPY_ID', $tmp_copy_id);
                                $oUser->collectNewElementID('ELEMENT_ID', $tmp_element_id);
                                $oUser->collectNewElementID('BULLETLIST_ID', $tmp_bulletlist_id);
                                $oUser->collectNewElementID('BULLETPOINT_ID', $tmp_bulletpoint_id);

                                $oUser->copy_content_field = 'BULLET_COPY';
                                $oUser->copy_profile_type = 'FULLSCRN';
                                $oUser->copy_component_type = $tmp_component_type_key;

                                if($tmp_component_count==''){
                                    $tmp_component_count = 0;

                                }

                                $ID_ARRAY[0] = $tmp_profile_id;
                                $IDTYPE_ARRAY[0] = "FULLSCRN_PROFILE";

                                $ID_ARRAY[1] = $tmp_page_id;
                                $IDTYPE_ARRAY[1] = "FULLSCRN_PAGE";

                                if($ID_ARRAY[0]=='' || $ID_ARRAY[1]==''){

                                    self::$query_exception_result = "error";
                                    throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: [paramTunnelDecrypt() NULL ERROR]');
                                }

                                $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                                $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                                $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME_BLOB'));
                                $tmp_page_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PAGE',0,'PAGE_NAME_BLOB'));

                                $oUser->sys_activity_description = 'A new bullet point list (with the first bullet being ['.$tmp_bullet_copy.']) has been added to the page ('.$tmp_page_name.') of the overlay profile, '.$tmp_profile_name.'.';

                                //
                                // QUERY CONSTRUCTION ::
                                self::$query = 'INSERT INTO `wthrbg_fullscrn_page_components`
                                (`COMPONENT_ID`,
                                 `COMPONENT_ID_CRC32`,
                                `PROFILE_ID`,
                                `PROFILE_ID_CRC32`,
                                `PAGE_ID`,
                                `PAGE_ID_CRC32`,
                                `COMPONENT_TYPE_KEY`,
                                `PAGE_SEQUENCE`,
                                `CREATOR_ID`,
                                `CREATOR_IP_V6`,
                                `CREATOR_IP`,
                                `CREATOR_SESSION_ID`,
                                `MODIFIER_ID`,
                                `MODIFIER_IP_V6`,
                                `MODIFIER_IP`,
                                `MODIFIER_SESSION_ID`,
                                `DATEMODIFIED`)
                                VALUES
                                ("'.$tmp_component_id.'",
                                "'.crc32($tmp_component_id).'",
                                "'.self::$mysqli->real_escape_string($tmp_profile_id).'",
                                "'.crc32($tmp_profile_id).'",
                                "'.self::$mysqli->real_escape_string($tmp_page_id).'",
                                "'.crc32($tmp_page_id).'",
                                "'.self::$mysqli->real_escape_string($tmp_component_type_key).'",
                                "'.self::$mysqli->real_escape_string($tmp_component_count).'",
                                "'.$tmp_userid.'",
                                INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                "' . session_id() . '",
                                "'.$tmp_userid.'",
                                INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                "' . session_id() . '",
                                "'.$ts.'");
                                ';

                                self::$query .= 'INSERT INTO `wthrbg_component_bulletlist`
                                (`BULLET_LIST_ID`,
                                `COMPONENT_ID`,
                                `COMPONENT_ID_CRC32`,
                                `PAGE_ID`,
                                `PAGE_ID_CRC32`,
                                `PROFILE_ID`,
                                `PROFILE_ID_CRC32`,
                                `CREATOR_ID`,
                                `CREATOR_IP_V6`,
                                `CREATOR_IP`,
                                `CREATOR_SESSION_ID`,
                                `MODIFIER_ID`,
                                `MODIFIER_IP_V6`,
                                `MODIFIER_IP`,
                                `MODIFIER_SESSION_ID`,
                                `DATEMODIFIED`)
                                VALUES
                                ("'.$tmp_bulletlist_id.'",
                                "'.self::$mysqli->real_escape_string($tmp_component_id).'",
                                "'.crc32($tmp_component_id).'",
                                "'.self::$mysqli->real_escape_string($tmp_page_id).'",
                                "'.crc32($tmp_page_id).'",
                                "'.self::$mysqli->real_escape_string($tmp_profile_id).'",
                                "'.crc32($tmp_profile_id).'",
                                "'.$tmp_userid.'",
                                INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                "' . session_id() . '",
                                "'.$tmp_userid.'",
                                INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                "' . session_id() . '",
                                "'.$ts.'");
                                ';

                                self::$query .= 'INSERT INTO `wthrbg_component_bulletlist_bullets`
                                (`BULLET_ID`,
                                `ELEMENT_ID`,
                                `ELEMENT_ID_CRC32`,
                                `COMPONENT_ID`,
                                `COMPONENT_ID_CRC32`,
                                `PAGE_ID`,
                                 `PAGE_ID_CRC32`,
                                `PROFILE_ID`,
                                 `PROFILE_ID_CRC32`,
                                `DESCRIPTION_IS_BOLD`,
                                `SEQUENCE`,
                                `CREATOR_ID`,
                                `CREATOR_IP_V6`,
                                `CREATOR_IP`,
                                `CREATOR_SESSION_ID`,
                                `MODIFIER_ID`,
                                `MODIFIER_IP_V6`,
                                `MODIFIER_IP`,
                                `MODIFIER_SESSION_ID`,
                                `DATEMODIFIED`)
                                VALUES
                                ("'.$tmp_bulletpoint_id.'",
                                "'.$tmp_element_id.'",
                                "'.crc32($tmp_element_id).'",
                                "'.self::$mysqli->real_escape_string($tmp_component_id).'",
                                "'.crc32($tmp_component_id).'",
                                "'.self::$mysqli->real_escape_string($tmp_page_id).'",
                                "'.crc32($tmp_page_id).'",
                                "'.self::$mysqli->real_escape_string($tmp_profile_id).'",
                                "'.crc32($tmp_profile_id).'",
                                "'.self::$mysqli->real_escape_string($tmp_bullet_copy_is_bold).'",
                                "'.self::$mysqli->real_escape_string($tmp_bullet_sequence).'",
                                "'.$tmp_userid.'",
                                INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                "' . session_id() . '",
                                "'.$tmp_userid.'",
                                INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                "' . session_id() . '",
                                "'.$ts.'");
                                ';

                                self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('LANG_ELEMENT_NEW', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                                self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('SEARCH_ENTRY_NEW', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                                self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('ACTIVITY_LOG', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            }

                            break;
                        default:
                            self::$query_exception_result = "error";
                            throw new Exception('AV Overlay database_integration :: Missing valid case=\'insert_bullet_element\' action_type ['.$tmp_action_type.'] ERROR');

                            break;

                    }

                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else{
                        $oUser->responseString = 'insert_bullet_element=success';
                        return $oUser;
                    }

                    break;
                case 'insert_schedule_element':

                    $tmp_userid = $oEnv->oSESSION_MGR->getSessionParam('USERID');

                    $tmp_page_id = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PAGE_ID'));
                    $tmp_profile_id = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID'));
                    $tmp_schedule_id = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('SCHEDULE_ID'));
                    $tmp_component_id = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('COMPONENT_ID'));
                    $tmp_component_count = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('COMPONENT_COUNT'));
                    $tmp_schedule_event_element_id = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('ELEMENT_ID'));
                    $tmp_event_id = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('EVENT_ID'));
                    $tmp_day_id = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('DAY_ID'));
                    $tmp_action_type = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('ACTION_TYPE'));
                    $tmp_component_type_key = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('COMPONENT_TYPE_KEY'));
                    $tmp_date_format = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('DATE_FORMAT'));
                    $tmp_time_format = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('TIME_FORMAT'));

                    switch($tmp_time_format){
                        case 'H:i':
                        case 'Hi':
                            $tmp_time_format_MODE = '24';
                            break;
                        default:
                            $tmp_time_format_MODE = '12';
                            break;

                    }

                    $tmp_date_day = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('DATE_DAY'));
                    $tmp_date_month = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('DATE_MONTH'));
                    $tmp_date_year = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('DATE_YEAR'));

                    $tmp_event_hour = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('EVENT_HOUR'));
                    $tmp_event_minute = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('EVENT_MINUTE'));
                    $tmp_event_ampm = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('EVENT_AMPM'));
                    $tmp_event_description = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('EVENT_DESCRIPTION'));
                    $tmp_event_description_bold = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('EVENT_DESCRIPTION_BOLD'));

                    $tmp_lang_id = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('LANG_ID'));

                    //error_log('database.inc.php (2672) action_type->'.$tmp_action_type);

                    switch($tmp_action_type){
                        case 'delete_schedule':

                            $ID_ARRAY[0] = $tmp_profile_id;
                            $IDTYPE_ARRAY[0] = "FULLSCRN_PROFILE";

                            $ID_ARRAY[1] = $tmp_page_id;
                            $IDTYPE_ARRAY[1] = "FULLSCRN_PAGE";

                            if($ID_ARRAY[0]=='' || $ID_ARRAY[1]==''){

                                self::$query_exception_result = "error";
                                throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: [paramTunnelDecrypt() NULL ERROR]');
                            }

                            $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                            $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                            $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME_BLOB'));
                            $tmp_page_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PAGE',0,'PAGE_NAME_BLOB'));

                            //
                            // DELETE EVENT AND IT'S COPY AND IT'S SEARCH CONTENT
                            $oUser->sys_activity_description = 'A schedule component has been deleted from the page ('.$tmp_page_name.') of the overlay profile, '.$tmp_profile_name.'.';

                            //
                            // UPDATES TO THE FOLLOWING TABLES
                            # wthrbg_component_schedule
                            # wthrbg_component_schedule_day
                            # wthrbg_component_schedule_event
                            # wthrbg_fullscrn_page_components
                            # wthrbg_lang_elem_components
                            # wthrbg_lang_elem_search

                            //
                            // INSERTS TO THE FOLLOWING TABLES
                            # wthrbg_log_sys_user

                            //
                            // QUERY CONSTRUCTION ::
                            self::$query = 'UPDATE `wthrbg_lang_elem_components`
                            SET
                            `ISACTIVE` = "0",
                            `MODIFIER_ID` = "'.$tmp_userid.'",
                            `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_SESSION_ID` = "' . session_id() . '",
                            `DATEMODIFIED` = "'.$ts.'"
                            WHERE `COMPONENT_ID` = "'.$tmp_component_id.'"
                            AND `COMPONENT_ID_CRC32` = "'. crc32($oUser->retrieve_Form_Data('COMPONENT_ID')).'"
                            AND `PAGE_ID` = "'.$tmp_page_id.'"
                            AND `PAGE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'"
                            AND `PROFILE_ID` = "'.$tmp_profile_id.'"
                            AND `PROFILE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                            AND `ISACTIVE` = "1";
                            ';

                            self::$query .= 'UPDATE `wthrbg_fullscrn_page_components`
                            SET
                            `ISACTIVE` = "0",
                            `MODIFIER_ID` = "'.$tmp_userid.'",
                            `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_SESSION_ID` = "' . session_id() . '",
                            `DATEMODIFIED` = "'.$ts.'"
                            WHERE `COMPONENT_ID` = "'.$tmp_component_id.'"
                            AND `COMPONENT_ID_CRC32` = "'. crc32($oUser->retrieve_Form_Data('COMPONENT_ID')).'"
                            AND `PAGE_ID` = "'.$tmp_page_id.'"
                            AND `PAGE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'"
                            AND `PROFILE_ID` = "'.$tmp_profile_id.'"
                            AND `PROFILE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                            LIMIT 1;
                            ';

                            self::$query .= 'UPDATE `wthrbg_component_schedule_event`
                            SET
                            `ISACTIVE` = "0",
                            `MODIFIER_ID` = "'.$tmp_userid.'",
                            `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_SESSION_ID` = "' . session_id() . '",
                            `DATEMODIFIED` = "'.$ts.'"
                            WHERE `COMPONENT_ID` = "'.$tmp_component_id.'"
                            AND `COMPONENT_ID_CRC32` = "'. crc32($oUser->retrieve_Form_Data('COMPONENT_ID')).'"
                            AND `PAGE_ID` = "'.$tmp_page_id.'"
                            AND `PROFILE_ID` = "'.$tmp_profile_id.'"
                            AND `ISACTIVE` = "1";
                            ';

                            self::$query .= 'UPDATE `wthrbg_component_schedule_day`
                            SET
                            `ISACTIVE` = "0",
                            `MODIFIER_ID` = "'.$tmp_userid.'",
                            `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_SESSION_ID` = "' . session_id() . '",
                            `DATEMODIFIED` = "'.$ts.'"
                            WHERE `COMPONENT_ID` = "'.$tmp_component_id.'"
                            AND `COMPONENT_ID_CRC32` = "'. crc32($oUser->retrieve_Form_Data('COMPONENT_ID')).'"
                            AND `PAGE_ID` = "'.$tmp_page_id.'"
                            AND `PAGE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'"
                            AND `PROFILE_ID` = "'.$tmp_profile_id.'"
                            AND `PROFILE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                            AND `ISACTIVE` = "1";
                            ';

                            self::$query .= 'UPDATE `wthrbg_component_schedule`
                            SET
                            `ISACTIVE` = "0",
                            `MODIFIER_ID` = "'.$tmp_userid.'",
                            `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_SESSION_ID` = "' . session_id() . '",
                            `DATEMODIFIED` = "'.$ts.'"
                            WHERE `COMPONENT_ID` = "'.$tmp_component_id.'"
                            AND `COMPONENT_ID_CRC32` = "'. crc32($oUser->retrieve_Form_Data('COMPONENT_ID')).'"
                            AND `PAGE_ID` = "'.$tmp_page_id.'"
                            AND `PAGE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'"
                            AND `PROFILE_ID` = "'.$tmp_profile_id.'"
                            AND `PROFILE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                            LIMIT 1;
                            ';

                            self::$query .= 'UPDATE `wthrbg_lang_elem_search`
                            SET
                            `ISACTIVE` = "0",
                            `DATEMODIFIED` = "'.$ts.'"
                            WHERE `COMPONENT_ID` = "'.$tmp_component_id.'"
                            AND `COMPONENT_ID_CRC32` = "'. crc32($oUser->retrieve_Form_Data('COMPONENT_ID')).'"
                            AND `PAGE_ID` = "'.$tmp_page_id.'"
                            AND `PAGE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'"
                            AND `PROFILE_ID` = "'.$tmp_profile_id.'"
                            AND `ISACTIVE` = "1";
                            ';

                            self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('ACTIVITY_LOG', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                            if(self::$mysqli->error){
                                self::$query_exception_result = "error";
                                throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                            }else{

                                $oUser->responseString = 'delete_schedule=success';
                                return $oUser;
                            }

                            break;
                        case 'edit_schedule_event':

                            $tmp_event_delete = $oUser->retrieve_Form_Data('EVENT_DELETE_AUTHORIZED');

                            $oUser->copy_content_field = 'EVENT_DESCRIPTION';

                            $ID_ARRAY[0] = $tmp_profile_id;
                            $IDTYPE_ARRAY[0] = "FULLSCRN_PROFILE";

                            $ID_ARRAY[1] = $tmp_page_id;
                            $IDTYPE_ARRAY[1] = "FULLSCRN_PAGE";

                            $ID_ARRAY[2] = $tmp_day_id;
                            $IDTYPE_ARRAY[2] = "COMPONENT_DAY";

                            $ID_ARRAY[3] = $tmp_lang_id;
                            $IDTYPE_ARRAY[3] = "LANG_PACK";

                            if($ID_ARRAY[0]=='' || $ID_ARRAY[1]==''){

                                self::$query_exception_result = "error";
                                throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: [paramTunnelDecrypt() NULL ERROR]');
                            }

                            $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                            $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                            $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME_BLOB'));
                            $tmp_page_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PAGE',0,'PAGE_NAME_BLOB'));
                            $tmp_date = self::$mysqli->real_escape_string($dataAugmenter->getData('COMPONENT_DAY',0,'DATE'));
                            $tmp_lang_pack_nomen = self::$mysqli->real_escape_string($dataAugmenter->getData('LANG_PACK',0,'NATIVE_NAME_BLOB'));
                            $tmp_lang_pack_name = self::$mysqli->real_escape_string($dataAugmenter->getData('LANG_PACK',0,'NAME'));

                            //
                            // DATE FORMATTING
                            $tmp_date_day = date("j", strtotime($tmp_date));
                            $tmp_date_month = date("n", strtotime($tmp_date));
                            $tmp_date_year = date("Y", strtotime($tmp_date));

                            if($tmp_time_format_MODE =='12'){

                                $tmp_event_date = date("Y-m-d H:i:s", strtotime($tmp_date_year.'-'.$tmp_date_month.'-'.$tmp_date_day.' '.$tmp_event_hour.':'.$tmp_event_minute.':00 '.$tmp_event_ampm));

                            }else{
                                $tmp_event_date = date("Y-m-d H:i:s", strtotime($tmp_date_year.'-'.$tmp_date_month.'-'.$tmp_date_day.' '.$tmp_event_hour.':'.$tmp_event_minute.':00'));

                            }

                            //
                            // DELETE EVENT AND IT'S COPY AND IT'S SEARCH CONTENT
                            if($tmp_event_delete=='1' || $tmp_event_delete==1){
                                $oUser->sys_activity_description = 'An event ['.$tmp_event_description.' at '.$tmp_event_date.'] has been deleted from a schedule on the page ('.$tmp_page_name.') of the overlay profile, '.$tmp_profile_name.'.';

                                //
                                // QUERY CONSTRUCTION ::
                                self::$query = 'UPDATE `wthrbg_lang_elem_components`
                                SET
                                `ISACTIVE` = "0",
                                `MODIFIER_ID` = "'.$tmp_userid.'",
                                `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                                `DATEMODIFIED` = "'.$ts.'"
                                WHERE `ELEMENT_ID` = "'.$tmp_schedule_event_element_id.'"
                                AND `ELEMENT_ID_CRC32` = "'. crc32($oUser->retrieve_Form_Data('ELEMENT_ID')).'"
                                AND `PROFILE_ID` = "'.$tmp_profile_id.'"
                                AND `PROFILE_ID_CRC32` = "'.crc32($tmp_profile_id).'"
                                AND `PAGE_ID` = "'.$tmp_page_id.'"
                                AND `PAGE_ID_CRC32` = "'.crc32($tmp_page_id).'"
                                LIMIT 1;
                                ';

                                self::$query .= 'UPDATE `wthrbg_component_schedule_event`
                                SET
                                `ISACTIVE` = "0",
                                `MODIFIER_ID` = "'.$tmp_userid.'",
                                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                                `DATEMODIFIED` = "'.$ts.'"
                                WHERE `ELEMENT_ID` = "'.$tmp_schedule_event_element_id.'"
                                AND `ELEMENT_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('ELEMENT_ID')).'"
                                AND `PROFILE_ID` = "'.$tmp_profile_id.'"
                                AND `PAGE_ID` = "'.$tmp_page_id.'"
                                LIMIT 1;
                                ';

                                self::$query .= 'UPDATE `wthrbg_component_schedule`
                                SET
                                `MODIFIER_ID` = "'.$tmp_userid.'",
                                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                                `DATEMODIFIED` = "'.$ts.'"
                                WHERE `COMPONENT_ID` = "'.$tmp_component_id.'"
                                  AND `COMPONENT_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('COMPONENT_ID')).'"
                                  AND `PROFILE_ID` = "'.$tmp_profile_id.'"
                                  AND `PROFILE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                                  AND `PAGE_ID` = "'.$tmp_page_id.'"
                                  AND `PAGE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'"
                                  LIMIT 1
                                  ;
                                ';

                                self::$query .= 'UPDATE `wthrbg_fullscrn_page_components`
                                SET
                                `MODIFIER_ID` = "'.$tmp_userid.'",
                                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                                `DATEMODIFIED` = "'.$ts.'"
                                WHERE `COMPONENT_ID` = "'.$tmp_component_id.'"
                                AND `COMPONENT_ID_CRC32` = "'. crc32($oUser->retrieve_Form_Data('COMPONENT_ID')).'"
                                AND `PAGE_ID` = "'.$tmp_page_id.'"
                                AND `PAGE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'"
                                AND `PROFILE_ID` = "'.$tmp_profile_id.'"
                                AND `PROFILE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                                LIMIT 1;
                                ';

                                self::$query .= 'UPDATE `wthrbg_component_schedule_day`
                                SET
                                `MODIFIER_ID` = "'.$tmp_userid.'",
                                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                                `DATEMODIFIED` = "'.$ts.'"
                                WHERE `DAY_ID` = "'.$tmp_day_id.'"
                                AND `DAY_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('DAY_ID')).'"
                                AND `COMPONENT_ID` = "'.$tmp_component_id.'"
                                AND `COMPONENT_ID_CRC32` = "'. crc32($oUser->retrieve_Form_Data('COMPONENT_ID')).'"
                                AND `PAGE_ID` = "'.$tmp_page_id.'"
                                AND `PAGE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'"
                                AND `PROFILE_ID` = "'.$tmp_profile_id.'"
                                AND `PROFILE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                                LIMIT 1;
                                ';

                                self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('SEARCH_ENTRY_DELETE', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                                self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('ACTIVITY_LOG', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                                self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                                if(self::$mysqli->error){
                                    self::$query_exception_result = "error";
                                    throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                                }else{

                                    $oUser->responseString = 'edit_schedule_event=success';
                                    return $oUser;
                                }

                            }else{

                                $oUser->sys_activity_description = 'A scheduled event has been updated with '.$tmp_lang_pack_nomen.' ('.$tmp_lang_pack_name.') copy as ['.$tmp_event_description.' at '.$tmp_event_date.'] on the page ('.$tmp_page_name.') of the overlay profile, '.$tmp_profile_name.'.';

                                //
                                // QUERY CONSTRUCTION ::
                                self::$query = self::$queryMakerForAllMonatony->returnQueryBusiness('LANG_ELEMENT_UPDATE', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                                self::$query .= 'UPDATE `wthrbg_component_schedule_event`
                                SET
                                `DATE` = "'.$tmp_event_date.'",
                                `DESCRIPTION_IS_BOLD` = "'.$tmp_event_description_bold.'",
                                `MODIFIER_ID` = "'.$tmp_userid.'",
                                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                                `DATEMODIFIED` = "'.$ts.'"
                                WHERE `ELEMENT_ID` = "'.$tmp_schedule_event_element_id.'"
                                AND `ELEMENT_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('ELEMENT_ID')).'"
                                AND `PROFILE_ID` = "'.$tmp_profile_id.'"
                                AND `PAGE_ID` = "'.$tmp_page_id.'"
                                LIMIT 1;
                                ';

                                self::$query .= 'UPDATE `wthrbg_component_schedule`
                                SET
                                `MODIFIER_ID` = "'.$tmp_userid.'",
                                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                                `DATEMODIFIED` = "'.$ts.'"
                                WHERE `COMPONENT_ID` = "'.$tmp_component_id.'"
                                  AND `COMPONENT_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('COMPONENT_ID')).'"
                                  AND `PROFILE_ID` = "'.$tmp_profile_id.'"
                                  AND `PROFILE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                                  AND `PAGE_ID` = "'.$tmp_page_id.'"
                                  AND `PAGE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'"
                                  LIMIT 1
                                  ;
                                ';

                                self::$query .= 'UPDATE `wthrbg_fullscrn_page_components`
                                SET
                                `MODIFIER_ID` = "'.$tmp_userid.'",
                                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                                `DATEMODIFIED` = "'.$ts.'"
                                WHERE `COMPONENT_ID` = "'.$tmp_component_id.'"
                                AND `COMPONENT_ID_CRC32` = "'. crc32($oUser->retrieve_Form_Data('COMPONENT_ID')).'"
                                AND `PAGE_ID` = "'.$tmp_page_id.'"
                                AND `PAGE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'"
                                AND `PROFILE_ID` = "'.$tmp_profile_id.'"
                                AND `PROFILE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                                LIMIT 1;
                                ';

                                self::$query .= 'UPDATE `wthrbg_component_schedule_day`
                                SET
                                `MODIFIER_ID` = "'.$tmp_userid.'",
                                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                                `DATEMODIFIED` = "'.$ts.'"
                                WHERE `DAY_ID` = "'.$tmp_day_id.'"
                                AND `DAY_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('DAY_ID')).'"
                                AND `COMPONENT_ID` = "'.$tmp_component_id.'"
                                AND `COMPONENT_ID_CRC32` = "'. crc32($oUser->retrieve_Form_Data('COMPONENT_ID')).'"
                                AND `PAGE_ID` = "'.$tmp_page_id.'"
                                AND `PAGE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'"
                                AND `PROFILE_ID` = "'.$tmp_profile_id.'"
                                AND `PROFILE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                                LIMIT 1;
                                ';

                                self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('SEARCH_ENTRY_UPDATE', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                                self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('ACTIVITY_LOG', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                                self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                                if(self::$mysqli->error){
                                    self::$query_exception_result = "error";
                                    throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                                }else{

                                    $oUser->responseString = 'edit_schedule_event=success';
                                    return $oUser;
                                }

                            }

                            break;
                        case 'new_schedule_event':

                            //
                            // ADD EVENT TO EXISTING SCHEDULE
                            $tmp_eventid = $oUser->generateNewKey(70);
                            $tmp_elementid = $oUser->generateNewKey(70);
                            $tmp_copyid = $oUser->generateNewKey(70);

                            //$oUser->save_Form_Data('SEARCH_ID', $tmp_searchid);
                            $oUser->save_Form_Data('ELEMENT_ID', $tmp_elementid);
                            $oUser->save_Form_Data('EVENT_ID', $tmp_eventid);
                            $oUser->save_Form_Data('COPY_ID', $tmp_copyid);

                            $oUser->copy_content_field = 'EVENT_DESCRIPTION';
                            $oUser->copy_profile_type = 'FULLSCRN';
                            $oUser->copy_component_type = 'SCHEDULE';

                            $tmp_hash_algo = $oEnv->getEnvParam('COPY_HASH_ALGO');
                            $tmp_copy_hash = hash($tmp_hash_algo, $oUser->retrieve_Form_Data('EVENT_DESCRIPTION'));
                            $oUser->copy_content_field = 'EVENT_DESCRIPTION';

                            $oUser->collectNewElementID('EVENT_ID', $tmp_eventid);

                            $ID_ARRAY[0] = $tmp_profile_id;
                            $IDTYPE_ARRAY[0] = "FULLSCRN_PROFILE";

                            $ID_ARRAY[1] = $tmp_page_id;
                            $IDTYPE_ARRAY[1] = "FULLSCRN_PAGE";

                            $ID_ARRAY[2] = $oUser->retrieve_Form_Data('DAY_ID');
                            $IDTYPE_ARRAY[2] = "COMPONENT_DAY";

                            $ID_ARRAY[3] = $tmp_lang_id;
                            $IDTYPE_ARRAY[3] = "LANG_PACK";

                            if($ID_ARRAY[0]=='' || $ID_ARRAY[1]==''){

                                self::$query_exception_result = "error";
                                throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: [paramTunnelDecrypt() NULL ERROR]');
                            }

                            $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                            $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                            $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME_BLOB'));
                            $tmp_page_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PAGE',0,'PAGE_NAME_BLOB'));
                            $tmp_date = self::$mysqli->real_escape_string($dataAugmenter->getData('COMPONENT_DAY',0,'DATE'));
                            $tmp_lang_pack_nomen = self::$mysqli->real_escape_string($dataAugmenter->getData('LANG_PACK',0,'NATIVE_NAME_BLOB'));
                            $tmp_lang_pack_name = self::$mysqli->real_escape_string($dataAugmenter->getData('LANG_PACK',0,'NAME'));

                            //
                            // DATE FORMATTING
                            $tmp_date_day = date("j", strtotime($tmp_date));
                            $tmp_date_month = date("n", strtotime($tmp_date));
                            $tmp_date_year = date("Y", strtotime($tmp_date));

                            $tmp_event_time_format = '12';
                            if($tmp_event_time_format=='12'){

                                $tmp_event_date = date("Y-m-d H:i:s", strtotime($tmp_date_year.'-'.$tmp_date_month.'-'.$tmp_date_day.' '.$tmp_event_hour.':'.$tmp_event_minute.':00 '.$tmp_event_ampm));

                            }else{
                                $tmp_event_date = date("Y-m-d H:i:s", strtotime($tmp_date_year.'-'.$tmp_date_month.'-'.$tmp_date_day.' '.$tmp_event_hour.':'.$tmp_event_minute.':00 '.$tmp_event_ampm));

                            }

                            $oUser->sys_activity_description = 'A new event written in '.$tmp_lang_pack_nomen.' ('.$tmp_lang_pack_name.') copy  ['.$tmp_event_description.' at '.$tmp_event_date.'] has been added to a schedule on the page ('.$tmp_page_name.') of the overlay profile, '.$tmp_profile_name.'.';

                            self::$query = 'INSERT INTO `wthrbg_component_schedule_event`
                            (`EVENT_ID`,
                            `ELEMENT_ID`,
                            `ELEMENT_ID_CRC32`,
                            `DAY_ID`,
                            `COMPONENT_ID`,
                            `COMPONENT_ID_CRC32`,
                            `PAGE_ID`,
                            `PROFILE_ID`,
                            `PROFILE_ID_CRC32`,
                            `DATE`,
                            `DESCRIPTION_IS_BOLD`,
                            `CREATOR_ID`,
                            `CREATOR_IP_V6`,
                            `CREATOR_IP`,
                            `CREATOR_SESSION_ID`,
                            `MODIFIER_ID`,
                            `MODIFIER_IP_V6`,
                            `MODIFIER_IP`,
                            `MODIFIER_SESSION_ID`,
                            `DATEMODIFIED`)
                            VALUES
                            ("'.$tmp_eventid.'",
                            "'.$tmp_elementid.'",
                            "'.crc32($tmp_elementid).'",
                            "'.$tmp_day_id.'",
                            "'.$tmp_component_id.'",
                            "'. crc32($oUser->retrieve_Form_Data('COMPONENT_ID')).'",
                            "'.$tmp_page_id.'",
                            "'.$tmp_profile_id.'",
                            "'.crc32($tmp_profile_id).'",
                            "'.$tmp_event_date.'",
                            "'.$tmp_event_description_bold.'",
                            "'.$tmp_userid.'",
                            INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            "' . session_id() . '",
                            "'.$tmp_userid.'",
                            INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            "' . session_id() . '",
                            "'.$ts.'");
                            ';

                            self::$query .= 'UPDATE `wthrbg_component_schedule`
                            SET
                            `MODIFIER_ID` = "'.$tmp_userid.'",
                            `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_SESSION_ID` = "' . session_id() . '",
                            `DATEMODIFIED` = "'.$ts.'"
                            WHERE `COMPONENT_ID` = "'.$tmp_component_id.'"
                              AND `COMPONENT_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('COMPONENT_ID')).'"
                              AND `PROFILE_ID` = "'.$tmp_profile_id.'"
                              AND `PROFILE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                              AND `PAGE_ID` = "'.$tmp_page_id.'"
                              AND `PAGE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'"
                              LIMIT 1
                              ;
                            ';

                            self::$query .= 'UPDATE `wthrbg_fullscrn_page_components`
                            SET
                            `MODIFIER_ID` = "'.$tmp_userid.'",
                            `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_SESSION_ID` = "' . session_id() . '",
                            `DATEMODIFIED` = "'.$ts.'"
                            WHERE `COMPONENT_ID` = "'.$tmp_component_id.'"
                            AND `COMPONENT_ID_CRC32` = "'. crc32($oUser->retrieve_Form_Data('COMPONENT_ID')).'"
                            AND `PAGE_ID` = "'.$tmp_page_id.'"
                            AND `PAGE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'"
                            AND `PROFILE_ID` = "'.$tmp_profile_id.'"
                            AND `PROFILE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                            LIMIT 1;
                            ';

                            self::$query .= 'UPDATE `wthrbg_component_schedule_day`
                            SET
                            `MODIFIER_ID` = "'.$tmp_userid.'",
                            `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_SESSION_ID` = "' . session_id() . '",
                            `DATEMODIFIED` = "'.$ts.'"
                            WHERE `DAY_ID` = "'.$tmp_day_id.'"
                            AND `DAY_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('DAY_ID')).'"
                            AND `COMPONENT_ID` = "'.$tmp_component_id.'"
                            AND `COMPONENT_ID_CRC32` = "'. crc32($oUser->retrieve_Form_Data('COMPONENT_ID')).'"
                            AND `PAGE_ID` = "'.$tmp_page_id.'"
                            AND `PAGE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'"
                            AND `PROFILE_ID` = "'.$tmp_profile_id.'"
                            AND `PROFILE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                            LIMIT 1;
                            ';

                            //
                            // QUERY CONSTRUCTION ::
                            self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('LANG_ELEMENT_NEW', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('SEARCH_ENTRY_NEW', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('ACTIVITY_LOG', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                            if(self::$mysqli->error){
                                self::$query_exception_result = "error";
                                throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                            }else{
                                $oUser->responseString = 'insert_schedule_element=success';
                                return $oUser;
                            }


                            break;
                        case 'edit_schedule_day':

                            $tmp_day_delete = $oUser->retrieve_Form_Data('DAY_DELETE_AUTHORIZED');

                            if($tmp_day_delete=='1'|| $tmp_day_delete==1){
                                $tmp_ISACTIVE = 0;

                            }else{
                                if($tmp_day_delete=='0'|| $tmp_day_delete==0){
                                    $tmp_ISACTIVE = 1;

                                }

                            }

                            $ID_ARRAY[0] = $tmp_profile_id;
                            $IDTYPE_ARRAY[0] = "FULLSCRN_PROFILE";

                            $ID_ARRAY[1] = $tmp_page_id;
                            $IDTYPE_ARRAY[1] = "FULLSCRN_PAGE";

                            $ID_ARRAY[2] = $oUser->retrieve_Form_Data('DAY_ID');
                            $IDTYPE_ARRAY[2] = "COMPONENT_DAY_EVENTS";

                            if($ID_ARRAY[0]=='' || $ID_ARRAY[1]==''){

                                self::$query_exception_result = "error";
                                throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: [paramTunnelDecrypt() NULL ERROR]');
                            }

                            $tmp_data_aug_resp_serial_key = 'DATA_AUG_05';
                            $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                            $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME_BLOB'));
                            $tmp_page_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PAGE',0,'PAGE_NAME_BLOB'));

                            //
                            // DATE FORMATTING
                            $tmp_day_date = date("Y-m-d H:i:s", mktime(0, 0, 0, $tmp_date_month, $tmp_date_day, $tmp_date_year));

                            self::$query = 'UPDATE `wthrbg_component_schedule`
                                SET
                                `MODIFIER_ID` = "'.$tmp_userid.'",
                                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                                `DATEMODIFIED` = "'.$ts.'"
                                WHERE `COMPONENT_ID` = "'.$tmp_component_id.'"
                                  AND `COMPONENT_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('COMPONENT_ID')).'"
                                  AND `PROFILE_ID` = "'.$tmp_profile_id.'"
                                  AND `PROFILE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                                  AND `PAGE_ID` = "'.$tmp_page_id.'"
                                  AND `PAGE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'"
                                  LIMIT 1
                                  ;
                                ';

                            self::$query .= 'UPDATE `wthrbg_fullscrn_page_components`
                                SET
                                `MODIFIER_ID` = "'.$tmp_userid.'",
                                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                                `DATEMODIFIED` = "'.$ts.'"
                                WHERE `COMPONENT_ID` = "'.$tmp_component_id.'"
                                AND `COMPONENT_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('COMPONENT_ID')).'"
                                  AND `PAGE_ID` = "'.$tmp_page_id.'"
                                  AND `PAGE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'"
                                  AND `PROFILE_ID` = "'.$tmp_profile_id.'"
                                  AND `PROFILE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                                  LIMIT 1
                                  ;
                                ';

                            if(isset($tmp_ISACTIVE)){

                                if($tmp_ISACTIVE==0 || $tmp_ISACTIVE=='0'){
                                    $oUser->sys_activity_description = 'A day ['.$tmp_day_date.'] has been deleted from a schedule on the page ('.$tmp_page_name.') of the overlay profile, '.$tmp_profile_name.'.';


                                }else{
                                    $oUser->sys_activity_description = 'A day ['.$tmp_day_date.'] has been updated on the page ('.$tmp_page_name.') of the overlay profile, '.$tmp_profile_name.'.';

                                }

                                self::$query .= 'UPDATE `wthrbg_component_schedule_day`
                                SET
                                `DATE` = "'.$tmp_day_date.'",
                                `ISACTIVE` = "'.$tmp_ISACTIVE.'",
                                `DAY_DAY` = "'.$tmp_date_day.'",
                                `DAY_MONTH` = "'.$tmp_date_month.'",
                                `DAY_YEAR` = "'.$tmp_date_year.'",                            
                                `MODIFIER_ID` = "'.$tmp_userid.'",
                                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                                `DATEMODIFIED` = "'.$ts.'"
                                WHERE `DAY_ID` = "'.$tmp_day_id.'"
                                AND `DAY_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('DAY_ID')).'"
                                AND `COMPONENT_ID` = "'.$tmp_component_id.'"
                                AND `COMPONENT_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('COMPONENT_ID')).'"
                                AND `PAGE_ID` = "'.$tmp_page_id.'"
                                AND `PAGE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'"
                                AND `PROFILE_ID` = "'.$tmp_profile_id.'"
                                AND `PROFILE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                                LIMIT 1
                                ;
                                ';


                            }else{

                                $oUser->sys_activity_description = 'A day ['.$tmp_day_date.'] has been updated on the page ('.$tmp_page_name.') of the overlay profile, '.$tmp_profile_name.'.';

                                self::$query .= 'UPDATE `wthrbg_component_schedule_day`
                                SET
                                `DATE` = "'.$tmp_day_date.'",
                                `DAY_DAY` = "'.$tmp_date_day.'",
                                `DAY_MONTH` = "'.$tmp_date_month.'",
                                `DAY_YEAR` = "'.$tmp_date_year.'",                            
                                `MODIFIER_ID` = "'.$tmp_userid.'",
                                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                                `DATEMODIFIED` = "'.$ts.'"
                                WHERE `DAY_ID` = "'.$tmp_day_id.'"
                                AND `DAY_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('DAY_ID')).'"
                                AND `COMPONENT_ID` = "'.$tmp_component_id.'"
                                AND `COMPONENT_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('COMPONENT_ID')).'"
                                AND `PAGE_ID` = "'.$tmp_page_id.'"
                                AND `PAGE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'"
                                AND `PROFILE_ID` = "'.$tmp_profile_id.'"
                                AND `PROFILE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                                LIMIT 1
                                ;
                                ';

                            }

                            //
                            // WE NEED UPDATE QUERIES FOR ALL EVENTS ON THIS DAY
                            self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('SYNC_EVENTS_TO_DAY', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('ACTIVITY_LOG', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                            if(self::$mysqli->error){
                                self::$query_exception_result = "error";
                                throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                            }else{
                                $oUser->responseString = 'insert_schedule_element=success';
                                return $oUser;
                            }

                            break;
                        case 'new_schedule_day':

                            if($tmp_component_id!=''){

                                //
                                // ADD DAY TO EXISTING SCHEDULE
                                $tmp_dayid = $oUser->generateNewKey(70);
                                $oUser->collectNewElementID('DAY_ID', $tmp_dayid);
                                $oUser->save_Form_Data('DAY_ID', $tmp_dayid);

                                $ID_ARRAY[0] = $tmp_profile_id;
                                $IDTYPE_ARRAY[0] = "FULLSCRN_PROFILE";

                                $ID_ARRAY[1] = $tmp_page_id;
                                $IDTYPE_ARRAY[1] = "FULLSCRN_PAGE";

                                if($ID_ARRAY[0]=='' || $ID_ARRAY[1]==''){

                                    self::$query_exception_result = "error";
                                    throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: [paramTunnelDecrypt() NULL ERROR]');
                                }

                                $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                                $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                                $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME_BLOB'));
                                $tmp_page_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PAGE',0,'PAGE_NAME_BLOB'));

                                //
                                // DATE FORMATTING
                                $tmp_day_date = date("Y-m-d H:i:s", mktime(0, 0, 0, $tmp_date_month, $tmp_date_day, $tmp_date_year));

                                $oUser->sys_activity_description = 'A new day ['.$tmp_day_date.'] has been added to a schedule on the page ('.$tmp_page_name.') of the overlay profile, '.$tmp_profile_name.'.';

                                self::$query = 'UPDATE `wthrbg_component_schedule`
                                SET
                                `MODIFIER_ID` = "'.$tmp_userid.'",
                                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                                `DATEMODIFIED` = "'.$ts.'"
                                WHERE `COMPONENT_ID` = "'.$tmp_component_id.'"
                                AND `COMPONENT_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('COMPONENT_ID')).'"
                                AND `PROFILE_ID` = "'.$tmp_profile_id.'"
                                AND `PROFILE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                                AND `PAGE_ID` = "'.$tmp_page_id.'"
                                AND `PAGE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'"
                                LIMIT 1
                                ;
                                ';

                                self::$query .= 'INSERT INTO `wthrbg_component_schedule_day`
                                (`DAY_ID`,
                                `DAY_ID_CRC32`,
                                `PROFILE_ID`,
                                `PROFILE_ID_CRC32`,
                                `PAGE_ID`,
                                `PAGE_ID_CRC32`,
                                `COMPONENT_ID`,
                                `COMPONENT_ID_CRC32`,
                                `DATE`,
                                `DAY_DAY`,
                                `DAY_MONTH`,
                                `DAY_YEAR`,
                                `CREATOR_ID`,
                                `CREATOR_IP_V6`,
                                `CREATOR_IP`,
                                `CREATOR_SESSION_ID`,
                                `MODIFIER_ID`,
                                `MODIFIER_IP_V6`,
                                `MODIFIER_IP`,
                                `MODIFIER_SESSION_ID`,
                                `DATEMODIFIED`)
                                VALUES
                                ("'.$tmp_dayid.'",
                                "'.crc32($tmp_dayid).'",
                                "'.$tmp_profile_id.'",
                                "'.crc32($tmp_profile_id).'",
                                "'.$tmp_page_id.'",
                                "'.crc32($tmp_page_id).'",
                                "'.$tmp_component_id.'",
                                "'.crc32($oUser->retrieve_Form_Data('COMPONENT_ID')).'",
                                "'.$tmp_day_date.'",
                                "'.$tmp_date_day.'",
                                "'.$tmp_date_month.'",
                                "'.$tmp_date_year.'",
                                "'.$tmp_userid.'",
                                INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                "' . session_id() . '",
                                "'.$tmp_userid.'",
                                INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                "' . session_id() . '",
                                "'.$ts.'");
                                ';

                                self::$query .= 'UPDATE `wthrbg_fullscrn_page_components`
                                SET
                                `MODIFIER_ID` = "'.$tmp_userid.'",
                                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                                `DATEMODIFIED` = "'.$ts.'"
                                WHERE `COMPONENT_ID` = "'.$tmp_component_id.'"
                                AND `COMPONENT_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('COMPONENT_ID')).'"
                                AND `PAGE_ID` = "'.$tmp_page_id.'"
                                AND `PAGE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'"
                                AND `PROFILE_ID` = "'.$tmp_profile_id.'"
                                AND `PROFILE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                                LIMIT 1
                                ;
                                ';

                                self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('ACTIVITY_LOG', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            }else{
                                //
                                // CREATE NEW SCHEDULE AND ADD DAY
                                $tmp_component_id = $oUser->generateNewKey(70);
                                $tmp_scheduleid = $oUser->generateNewKey(70);
                                $tmp_dayid = $oUser->generateNewKey(70);
                                $oUser->save_Form_Data('COMPONENT_ID', $tmp_component_id);
                                $oUser->save_Form_Data('SCHEDULE_ID', $tmp_scheduleid);
                                $oUser->save_Form_Data('DAY_ID', $tmp_dayid);
                                $oUser->collectNewElementID('COMPONENT_ID', $tmp_component_id);
                                $oUser->collectNewElementID('SCHEDULE_ID', $tmp_scheduleid);
                                $oUser->collectNewElementID('DAY_ID', $tmp_dayid);

                                if($tmp_component_count==''){
                                    $tmp_component_count = 0;

                                }

                                $ID_ARRAY[0] = $tmp_profile_id;
                                $IDTYPE_ARRAY[0] = "FULLSCRN_PROFILE";

                                $ID_ARRAY[1] = $tmp_page_id;
                                $IDTYPE_ARRAY[1] = "FULLSCRN_PAGE";

                                if($ID_ARRAY[0]=='' || $ID_ARRAY[1]==''){

                                    self::$query_exception_result = "error";
                                    throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: [paramTunnelDecrypt() NULL ERROR]');
                                }

                                $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                                $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                                $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME_BLOB'));
                                $tmp_page_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PAGE',0,'PAGE_NAME_BLOB'));

                                //
                                // DATE FORMATTING
                                $tmp_day_date = date("Y-m-d H:i:s", mktime(0, 0, 0, $tmp_date_month, $tmp_date_day, $tmp_date_year));

                                $oUser->sys_activity_description = 'A new schedule has been created starting with '.$tmp_day_date.' on the page ('.$tmp_page_name.') of the overlay profile, '.$tmp_profile_name.'.';

                                //
                                // QUERY CONSTRUCTION ::
                                self::$query = 'INSERT INTO `wthrbg_component_schedule`
                                (`SCHEDULE_ID`,
                                 `COMPONENT_ID`,
                                 `COMPONENT_ID_CRC32`,
                                `PROFILE_ID`,
                                `PROFILE_ID_CRC32`,
                                `PAGE_ID`,
                                `PAGE_ID_CRC32`,
                                `CREATOR_ID`,
                                `CREATOR_IP_V6`,
                                `CREATOR_IP`,
                                `CREATOR_SESSION_ID`,
                                `MODIFIER_ID`,
                                `MODIFIER_IP_V6`,
                                `MODIFIER_IP`,
                                `MODIFIER_SESSION_ID`,
                                `DATEMODIFIED`)
                                VALUES
                                ("'.$tmp_scheduleid.'",
                                "'.$tmp_component_id.'",
                                "'.crc32($tmp_component_id).'",
                                "'.$tmp_profile_id.'",
                                "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'",
                                "'.$tmp_page_id.'",
                                "'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'",
                                "'.$tmp_userid.'",
                                INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                "' . session_id() . '",
                                "'.$tmp_userid.'",
                                INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                "' . session_id() . '",
                                "'.$ts.'");
                                ';

                                self::$query .= 'INSERT INTO `wthrbg_component_schedule_day`
                                (`DAY_ID`,
                                `DAY_ID_CRC32`,
                                `PROFILE_ID`,
                                `PROFILE_ID_CRC32`,
                                `PAGE_ID`,
                                `PAGE_ID_CRC32`,
                                `COMPONENT_ID`,
                                `COMPONENT_ID_CRC32`,
                                `DATE`,
                                `DAY_DAY`,
                                `DAY_MONTH`,
                                `DAY_YEAR`,
                                `CREATOR_ID`,
                                `CREATOR_IP_V6`,
                                `CREATOR_IP`,
                                `CREATOR_SESSION_ID`,
                                `MODIFIER_ID`,
                                `MODIFIER_IP_V6`,
                                `MODIFIER_IP`,
                                `MODIFIER_SESSION_ID`,
                                `DATEMODIFIED`)
                                VALUES
                                ("'.$tmp_dayid.'",
                                "'.crc32($tmp_dayid).'",
                                "'.$tmp_profile_id.'",
                                "'.crc32($tmp_profile_id).'",
                                "'.$tmp_page_id.'",
                                "'.crc32($tmp_page_id).'",
                                "'.$tmp_component_id.'",
                                "'.crc32($tmp_component_id).'",
                                "'.$tmp_day_date.'",
                                "'.$tmp_date_day.'",
                                "'.$tmp_date_month.'",
                                "'.$tmp_date_year.'",
                                "'.$tmp_userid.'",
                                INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                "' . session_id() . '",
                                "'.$tmp_userid.'",
                                INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                "' . session_id() . '",
                                "'.$ts.'");
                                ';

                                self::$query .= 'INSERT INTO `wthrbg_fullscrn_page_components`
                                (`COMPONENT_ID`,
                                 `COMPONENT_ID_CRC32`,
                                `PROFILE_ID`,
                                `PROFILE_ID_CRC32`,
                                `PAGE_ID`,
                                `PAGE_ID_CRC32`,
                                `COMPONENT_TYPE_KEY`,
                                `PAGE_SEQUENCE`,
                                `CREATOR_ID`,
                                `CREATOR_IP_V6`,
                                `CREATOR_IP`,
                                `CREATOR_SESSION_ID`,
                                `MODIFIER_ID`,
                                `MODIFIER_IP_V6`,
                                `MODIFIER_IP`,
                                `MODIFIER_SESSION_ID`,
                                `DATEMODIFIED`)
                                VALUES
                                ("'.$tmp_component_id.'",
                                "'.crc32($tmp_component_id).'",
                                "'.$tmp_profile_id.'",
                                "'.crc32($tmp_profile_id).'",
                                "'.$tmp_page_id.'",
                                "'.crc32($tmp_page_id).'",
                                "'.$tmp_component_type_key.'",
                                "'.$tmp_component_count.'",
                                "'.$tmp_userid.'",
                                INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                "' . session_id() . '",
                                "'.$tmp_userid.'",
                                INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                "' . session_id() . '",
                                "'.$ts.'");
                                ';

                                self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('ACTIVITY_LOG', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                            }

                            break;
                        default:
                            self::$query_exception_result = "error";
                            throw new Exception('AV Overlay database_integration :: Missing valid case=\'insert_schedule_element\' action_type ['.$tmp_action_type.'] ERROR');

                            break;

                    }

                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else{
                        $oUser->responseString = 'insert_schedule_element=success';
                        return $oUser;
                    }

                    break;
                case 'sys_get_colors':

                    //
                    // DO WE HAVE THIS OBS_ID?
                    $force_profile_select_align = true;
                    $db_resp_process_serial = "!jesus_is_my_dear_lord!";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();         //$oUser->return_serial_handle();
                    $db_resp_target_profiles = 'DE_COLORES';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '14';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION ::
                    $tmp_SELECT_ARRAY = array();

                    $tmp_SELECT_ARRAY[0] = 'SELECT `wthrbg_colors_hex`.`COLOR_ID`,
                        `wthrbg_colors_hex`.`COLOR_APPLICATION_KEY`,
                        `wthrbg_colors_hex`.`COLOR_HEX`,
                        `wthrbg_colors_hex`.`ISACTIVE`,
                        `wthrbg_colors_hex`.`COLOR_NAME`,
                        `wthrbg_colors_hex`.`COLOR_NAME_BLOB`,
                        `wthrbg_colors_hex`.`CREATOR_ID`,
                        `wthrbg_colors_hex`.`CREATOR_IP`,
                        `wthrbg_colors_hex`.`CREATOR_SESSION_ID`,
                        `wthrbg_colors_hex`.`MODIFIER_ID`,
                        `wthrbg_colors_hex`.`MODIFIER_IP`,
                        `wthrbg_colors_hex`.`MODIFIER_SESSION_ID`,
                        `wthrbg_colors_hex`.`DATEMODIFIED`,
                        `wthrbg_colors_hex`.`DATECREATED`
                    FROM `wthrbg_colors_hex`
                    WHERE `wthrbg_colors_hex`.`ISACTIVE`="1" 
                    ORDER BY `wthrbg_colors_hex`.`COLOR_NAME`;
                    ';

                    $oDB_RESP->process(self::$mysqli,$queryType, $tmp_SELECT_ARRAY);

                    return $oDB_RESP;

                    break;
                case 'sys_user_type_get':

                    //
                    // DO WE HAVE THIS OBS_ID?
                    $force_profile_select_align = true;
                    $db_resp_process_serial = "!jesus_is_my_dear_lord!";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();         //$oUser->return_serial_handle();
                    $db_resp_target_profiles = 'USER_TYPES|LANG_PACKS';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '14|12';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION ::
                    $tmp_SELECT_ARRAY = array();
                    $tmp_SELECT_ARRAY[0] = 'SELECT `wthrbg_sys_user_types`.`TYPE_ID`,
                        `wthrbg_sys_user_types`.`USER_PERMISSIONS_ID`,
                        `wthrbg_sys_user_types`.`NAME`,
                        `wthrbg_sys_user_types`.`DESCRIPTION`,
                        `wthrbg_sys_user_types`.`CREATOR_ID`,
                        `wthrbg_sys_user_types`.`CREATOR_IP_V6`,
                        `wthrbg_sys_user_types`.`CREATOR_IP`,
                        `wthrbg_sys_user_types`.`CREATOR_SESSION_ID`,
                        `wthrbg_sys_user_types`.`MODIFIER_ID`,
                        `wthrbg_sys_user_types`.`MODIFIER_IP_V6`,
                        `wthrbg_sys_user_types`.`MODIFIER_IP`,
                        `wthrbg_sys_user_types`.`MODIFIER_SESSION_ID`,
                        `wthrbg_sys_user_types`.`DATEMODIFIED`,
                        `wthrbg_sys_user_types`.`DATECREATED`
                    FROM `wthrbg_sys_user_types`
                    WHERE  `wthrbg_sys_user_types`.`ISACTIVE`="1" 
                    ORDER BY `wthrbg_sys_user_types`.`SEQUENCE` ASC;
                    ';

                    $tmp_SELECT_ARRAY[1] = 'SELECT `wthrbg_lang_packs`.`LANGPACK_ID`,
                        `wthrbg_lang_packs`.`LANG_ID`,
                        `wthrbg_lang_packs`.`NAME`,
                        `wthrbg_lang_packs`.`NATIVE_NAME`,
                        `wthrbg_lang_packs`.`NATIVE_NAME_BLOB`,
                        `wthrbg_lang_packs`.`ISACTIVE`,
                        `wthrbg_lang_packs`.`RTL_FLAG`,
                        `wthrbg_lang_packs`.`FONT_SIZE_PERCENTAGE`,
                        `wthrbg_lang_packs`.`TIMER_FONT_SIZE_PERCENTAGE`,
                        `wthrbg_lang_packs`.`COPY_PADDING_TOP_PX`,
                        `wthrbg_lang_packs`.`DATEMODIFIED`,
                        `wthrbg_lang_packs`.`DATECREATED`
                    FROM `wthrbg_lang_packs` WHERE `wthrbg_lang_packs`.`ISACTIVE`="1";
                    ';

                    $oDB_RESP->process(self::$mysqli,$queryType, $tmp_SELECT_ARRAY);

                    return $oDB_RESP;

                    break;
                case 'sys_add_new_color':
                    $tmp_userid = $oEnv->oSESSION_MGR->getSessionParam('USERID');

                    $tmp_colorid = $oUser->generateNewKey(70);
                    $tmp_activityid = $oUser->generateNewKey(70);

                    $tmp_color_app_key = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('COLOR_APPLICATION_KEY'));
                    $tmp_color_hex = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('COLOR_HEX'));
                    $tmp_color_name = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('COLOR_NAME'));

                    $tmp_activitydescription = 'A new '.strtolower($tmp_color_app_key).' specific system color ('.$tmp_color_name.') has been added.';

                    //
                    // QUERY CONSTRUCTION ::
                    self::$query = 'INSERT INTO `wthrbg_colors_hex`
                    (`COLOR_ID`,
                    `COLOR_APPLICATION_KEY`,
                    `COLOR_HEX`,
                    `COLOR_HEX_CRC32`,
                    `COLOR_NAME`,
                    `COLOR_NAME_BLOB`,
                    `CREATOR_ID`,
                    `CREATOR_IP_V6`,
                    `CREATOR_IP`,
                    `CREATOR_SESSION_ID`,
                    `MODIFIER_ID`,
                    `MODIFIER_IP_V6`,
                    `MODIFIER_IP`,
                    `MODIFIER_SESSION_ID`,
                    `DATEMODIFIED`)
                    VALUES
                    ("'.$tmp_colorid.'",
                    "'.$tmp_color_app_key.'",
                    "'.$tmp_color_hex.'",
                    "'.crc32($tmp_color_hex).'",
                    "'.$tmp_color_name.'",
                    "'.$tmp_color_name.'",
                    "'.$tmp_userid.'",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "' . session_id() . '",
                    "'.$tmp_userid.'",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "' . session_id() . '",
                    "'.$ts.'");
                    ';

                    self::$query .= 'INSERT INTO `wthrbg_log_sys_user`
                    (`ACTIVITY_ID`,
                    `MODIFIER_ID`,
                    `MODIFIER_ID_CRC32`,
                    `ACTIVITY_DESCRIPTION`,
                    `ACTIVITY_DESCRIPTION_BLOB`,
                    `PHPSESSION`,
                    `IPADDRESS_V6`,
                    `IPADDRESS`,
                    `HTTP_USER_AGENT`,
                    `CHANNEL`)
                    VALUES
                    ("'.$tmp_activityid.'",
                    "'.$tmp_userid.'",
                    "'.crc32($tmp_userid).'",
                    "'.self::$mysqli->real_escape_string($oUser->searchTruncStr($tmp_activitydescription, 1000)).'",
                    "'.self::$mysqli->real_escape_string($tmp_activitydescription).'",
                    "' . session_id() . '",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "'.$_SERVER['HTTP_USER_AGENT'].'",
                    "'.strtoupper($oEnv->oSESSION_MGR->getSessionParam("DEVICETYPE")).'");
                    ';

                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else{

                        return 'sys_add_new_color=success';
                    }

                    break;
                case 'update_page_bg_opacity':

                    $tmp_userid = $oEnv->oSESSION_MGR->getSessionParam('USERID');

                    $tmp_activityid = $oUser->generateNewKey(70);

                    $ID_ARRAY[0] = $oUser->retrieve_Form_Data('PROFILE_ID');
                    $IDTYPE_ARRAY[0] = "FULLSCRN_PROFILE";

                    $ID_ARRAY[1] = $oUser->retrieve_Form_Data('PAGE_ID');
                    $IDTYPE_ARRAY[1] = "FULLSCRN_PAGE";

                    if($ID_ARRAY[0]=='' || $ID_ARRAY[1]==''){

                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: [paramTunnelDecrypt() NULL ERROR]');
                    }

                    $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                    $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                    $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME_BLOB'));
                    $tmp_page_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PAGE',0,'PAGE_NAME_BLOB'));
                    $tmp_page_new_opacity = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('OPACITY'));

                    $tmp_activitydescription = 'The background opacity for a full screen page ('.$tmp_page_name.') of the profile ('.$tmp_profile_name.') has been updated with a fresh value ('.$tmp_page_new_opacity.').';

                    //
                    // QUERY CONSTRUCTION ::
                    self::$query = 'UPDATE `wthrbg_overlay_fullscrn_pages`
                    SET
                    `OPACITY` = "'.$tmp_page_new_opacity.'",
                    `MODIFIER_ID` = "'.$tmp_userid.'",
                    `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    `MODIFIER_SESSION_ID` = "' . session_id() . '",
                    `DATEMODIFIED` = "'.$ts.'"
                    WHERE `PAGE_ID` = "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PAGE_ID')).'"
                    AND `PAGE_ID_CRC32` = "'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'"
                    LIMIT 1;
                    ';

                    self::$query .= 'INSERT INTO `wthrbg_log_sys_user`
                    (`ACTIVITY_ID`,
                    `MODIFIER_ID`,
                    `MODIFIER_ID_CRC32`,
                    `FULL_SCRN_PROFILE_ID`,
                    `FULL_SCRN_PROFILE_ID_CRC32`,
                    `FULL_SCRN_PAGE_ID`,
                    `FULL_SCRN_PAGE_ID_CRC32`,
                    `ACTIVITY_DESCRIPTION`,
                    `ACTIVITY_DESCRIPTION_BLOB`,
                    `PHPSESSION`,
                    `IPADDRESS_V6`,
                    `IPADDRESS`,
                    `HTTP_USER_AGENT`,
                    `CHANNEL`)
                    VALUES
                    ("'.$tmp_activityid.'",
                    "'.$tmp_userid.'",
                    "'.crc32($tmp_userid).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID')).'",
                    "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PAGE_ID')).'",
                    "'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'",
                    "'.self::$mysqli->real_escape_string($oUser->searchTruncStr($tmp_activitydescription, 1000)).'",
                    "'.self::$mysqli->real_escape_string($tmp_activitydescription).'",
                    "' . session_id() . '",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "'.$_SERVER['HTTP_USER_AGENT'].'",
                    "'.strtoupper($oEnv->oSESSION_MGR->getSessionParam("DEVICETYPE")).'");
                    ';

                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else{

                        return 'update_page_bg_opacity=success';
                    }

                    break;
                case 'update_page_bg_color':

                    $tmp_userid = $oEnv->oSESSION_MGR->getSessionParam('USERID');

                    $tmp_activityid = $oUser->generateNewKey(70);

                    $ID_ARRAY[0] = $oUser->retrieve_Form_Data('PROFILE_ID');
                    $IDTYPE_ARRAY[0] = "FULLSCRN_PROFILE";

                    $ID_ARRAY[1] = $oUser->retrieve_Form_Data('PAGE_ID');
                    $IDTYPE_ARRAY[1] = "FULLSCRN_PAGE";

                    $ID_ARRAY[2] = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('BG_COLOR_HEX'));
                    $IDTYPE_ARRAY[2] = "SYS_COLOR";

                    /*
                    wthrbg_colors_hex
                    COLOR_ID char(7)
                    COLOR_ID_CRC32 int(11) unsigned
                    COLOR_NAME varchar(50)
                    COLOR_NAME_BLOB blob
                    `CREATOR_ID` = <{MODIFIER_ID: }>,
                    `CREATOR_IP` = <{MODIFIER_IP: }>,
                    `CREATOR_SESSION_ID` = <{MODIFIER_SESSION_ID: }>,
                    `MODIFIER_ID` = <{MODIFIER_ID: }>,
                    `MODIFIER_IP` = <{MODIFIER_IP: }>,
                    `MODIFIER_SESSION_ID` = <{MODIFIER_SESSION_ID: }>,
                    DATEMODIFIED
                    DATECREATED
                     * */

                    if($ID_ARRAY[0]=='' || $ID_ARRAY[1]==''){

                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: [paramTunnelDecrypt() NULL ERROR]');
                    }

                    $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                    $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                    $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME_BLOB'));
                    $tmp_page_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PAGE',0,'PAGE_NAME_BLOB'));
                    $tmp_page_new_bgcolor = self::$mysqli->real_escape_string($dataAugmenter->getData('SYS_COLOR',0,'COLOR_NAME_BLOB'));

                    $tmp_activitydescription = 'The background color for a full screen overlay page ('.$tmp_page_name.') of the profile ('.$tmp_profile_name.') has been updated with a fresh value ('.$tmp_page_new_bgcolor.').';

                    //
                    // QUERY CONSTRUCTION ::
                    self::$query = 'UPDATE `wthrbg_overlay_fullscrn_pages`
                    SET
                    `BGCOLOR_HEX` = "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('BG_COLOR_HEX')).'",
                    `MODIFIER_ID` = "'.$tmp_userid.'",
                    `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    `MODIFIER_SESSION_ID` = "' . session_id() . '",
                    `DATEMODIFIED` = "' . $ts. '"
                    WHERE `PAGE_ID` = "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PAGE_ID')).'";
                    ';

                    self::$query .= 'INSERT INTO `wthrbg_log_sys_user`
                    (`ACTIVITY_ID`,
                    `MODIFIER_ID`,
                    `MODIFIER_ID_CRC32`,
                    `FULL_SCRN_PROFILE_ID`,
                    `FULL_SCRN_PROFILE_ID_CRC32`,
                    `ACTIVITY_DESCRIPTION`,
                    `ACTIVITY_DESCRIPTION_BLOB`,
                    `PHPSESSION`,
                    `IPADDRESS_V6`,
                    `IPADDRESS`,
                    `HTTP_USER_AGENT`,
                    `CHANNEL`)
                    VALUES
                    ("'.$tmp_activityid.'",
                    "'.$tmp_userid.'",
                    "'.crc32($tmp_userid).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID')).'",
                    "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'",
                    "'.self::$mysqli->real_escape_string($oUser->searchTruncStr($tmp_activitydescription, 1000)).'",
                    "'.self::$mysqli->real_escape_string($tmp_activitydescription).'",
                    "' . session_id() . '",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "'.$_SERVER['HTTP_USER_AGENT'].'",
                    "'.strtoupper($oEnv->oSESSION_MGR->getSessionParam("DEVICETYPE")).'");
                    ';

                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else{

                        return 'update_page_bg_color=success';
                    }

                    break;
                case 'obs_fullscrn_page_new_title':

                    $tmp_userid = $oEnv->oSESSION_MGR->getSessionParam('USERID');
                    $tmp_element_id = $oUser->generateNewKey(70);
                    $tmp_copy_id = $oUser->generateNewKey(70);
                    $tmp_activityid = $oUser->generateNewKey(70);

                    $oUser->save_Form_Data('ELEMENT_ID', $tmp_element_id);
                    $oUser->save_Form_Data('COPY_ID', $tmp_copy_id);

                    $tmp_title_copy = $oUser->retrieve_Form_Data('TITLE_COPY');
                    $oUser->copy_content_field = 'TITLE_COPY';
                    $oUser->copy_profile_type = 'FULLSCRN';
                    $oUser->copy_component_type = 'PAGE_TITLE';

                    $tmp_lang_id = $oUser->retrieve_Form_Data('LANG_ID');
                    $tmp_profile_id = $oUser->retrieve_Form_Data('PROFILE_ID');
                    $tmp_page_id = $oUser->retrieve_Form_Data('PAGE_ID');

                    $tmp_hash_algo = $oEnv->getEnvParam('COPY_HASH_ALGO');
                    $tmp_copy_hash = hash($tmp_hash_algo, $tmp_title_copy);

                    $ID_ARRAY[0] = $oUser->retrieve_Form_Data('PROFILE_ID');
                    $IDTYPE_ARRAY[0] = "FULLSCRN_PROFILE";

                    $ID_ARRAY[1] = $oUser->retrieve_Form_Data('PAGE_ID');
                    $IDTYPE_ARRAY[1] = "FULLSCRN_PAGE";

                    $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                    $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                    $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME_BLOB'));
                    $tmp_page_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PAGE',0,'PAGE_NAME_BLOB'));

                    $oUser->sys_activity_description = 'Title copy ['.$tmp_title_copy.'] has been added to the full screen overlay page ('.$tmp_page_name.') of the profile, '.$tmp_profile_name.'.';

                    //
                    // QUERY CONSTRUCTION ::
                    self::$query = self::$queryMakerForAllMonatony->returnQueryBusiness('LANG_ELEMENT_NEW', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                    self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('SEARCH_ENTRY_NEW', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                    self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('ACTIVITY_LOG', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else{

                        return 'new_page_title=success';
                    }

                    break;
                case 'obs_fullscrn_page_edit_title':

                    $tmp_title_copy = $oUser->retrieve_Form_Data('TITLE_COPY');
                    $oUser->copy_content_field = 'TITLE_COPY';

                    $ID_ARRAY[0] = $oUser->retrieve_Form_Data('PROFILE_ID');
                    $IDTYPE_ARRAY[0] = "FULLSCRN_PROFILE";

                    $ID_ARRAY[1] = $oUser->retrieve_Form_Data('PAGE_ID');
                    $IDTYPE_ARRAY[1] = "FULLSCRN_PAGE";

                    $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                    $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                    $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME_BLOB'));
                    $tmp_page_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PAGE',0,'PAGE_NAME_BLOB'));

                    $oUser->sys_activity_description = 'Title copy has been updated to ['.$tmp_title_copy.'] for the full screen overlay page ('.$tmp_page_name.') of the profile, '.$tmp_profile_name.'.';

                    //
                    // QUERY CONSTRUCTION ::
                    self::$query = self::$queryMakerForAllMonatony->returnQueryBusiness('LANG_ELEMENT_UPDATE', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                    self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('SEARCH_ENTRY_UPDATE', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                    self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('ACTIVITY_LOG', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else{

                        return 'edit_page_title=success';
                    }

                    break;
                case 'obs_fullscrn_page_edit_header':

                    $tmp_userid = $oEnv->oSESSION_MGR->getSessionParam('USERID');

                    $tmp_header_copy = $oUser->retrieve_Form_Data('HEADER_COPY');
                    $oUser->copy_content_field = 'HEADER_COPY';

                    $ID_ARRAY[0] = $oUser->retrieve_Form_Data('PROFILE_ID');
                    $IDTYPE_ARRAY[0] = "FULLSCRN_PROFILE";

                    $ID_ARRAY[1] = $oUser->retrieve_Form_Data('PAGE_ID');
                    $IDTYPE_ARRAY[1] = "FULLSCRN_PAGE";

                    $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                    $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                    $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME_BLOB'));
                    $tmp_page_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PAGE',0,'PAGE_NAME_BLOB'));

                    $oUser->sys_activity_description = 'Header copy has been updated for the full screen overlay page ('.$tmp_page_name.') of the profile, '.$tmp_profile_name.'.';

                    //
                    // QUERY CONSTRUCTION ::
                    self::$query = self::$queryMakerForAllMonatony->returnQueryBusiness('LANG_ELEMENT_UPDATE', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                    self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('SEARCH_ENTRY_UPDATE', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                    self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('ACTIVITY_LOG', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else{

                        return 'edit_page_header=success';
                    }

                    break;
                case 'obs_fullscrn_page_new_header':

                    $tmp_element_id = $oUser->generateNewKey(70);
                    $tmp_copy_id = $oUser->generateNewKey(70);

                    $oUser->save_Form_Data('ELEMENT_ID', $tmp_element_id);
                    $oUser->save_Form_Data('COPY_ID', $tmp_copy_id);

                    $tmp_header_copy = $oUser->retrieve_Form_Data('HEADER_COPY');
                    $oUser->copy_content_field = 'HEADER_COPY';
                    $oUser->copy_profile_type = 'FULLSCRN';
                    $oUser->copy_component_type = 'PAGE_HEADER';

                    $ID_ARRAY[0] = $oUser->retrieve_Form_Data('PROFILE_ID');
                    $IDTYPE_ARRAY[0] = "FULLSCRN_PROFILE";

                    $ID_ARRAY[1] = $oUser->retrieve_Form_Data('PAGE_ID');
                    $IDTYPE_ARRAY[1] = "FULLSCRN_PAGE";

                    $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                    $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                    $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME_BLOB'));
                    $tmp_page_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PAGE',0,'PAGE_NAME_BLOB'));

                    $oUser->sys_activity_description = 'Header copy ['.$tmp_header_copy.'] has been added to the full screen overlay page ('.$tmp_page_name.') of the profile, '.$tmp_profile_name.'.';

                    //
                    // QUERY CONSTRUCTION ::
                    self::$query = self::$queryMakerForAllMonatony->returnQueryBusiness('LANG_ELEMENT_NEW', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                    self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('SEARCH_ENTRY_NEW', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                    self::$query .= self::$queryMakerForAllMonatony->returnQueryBusiness('ACTIVITY_LOG', $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter);

                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else{

                        return 'new_page_header=success';
                    }

                    break;
                case 'get_obs_fullscrn_page_data':
                    //
                    // DO WE HAVE THIS OBS_ID?
                    $force_profile_select_align = true;
                    $db_resp_process_serial = "!jesus_is_my_dear_lord!!!!<-";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();         //$oUser->return_serial_handle();
                    $db_resp_target_profiles = 'COMPONENT_TYPES|LANG_PACKS|DE_COLORES|FULLSCRN_PAGE|LANG_ELEM|PAGE_COMPONENTS|PAGE_SCHEDULES|PAGE_DAYS|PAGE_EVENTS|BULLET_LIST|BULLET_BULLETS|PARAGRAPH|SUB_TITLE';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '15|12|14|15|27|15|15|17|17|16|15|17|15';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION ::
                    $tmp_SELECT_ARRAY = array();
                    $tmp_SELECT_ARRAY[0] = 'SELECT `wthrbg_sys_page_component_types`.`TYPE_ID`,
                        `wthrbg_sys_page_component_types`.`TYPE_KEY`,
                        `wthrbg_sys_page_component_types`.`NAME`,
                        `wthrbg_sys_page_component_types`.`DESCRIPTION`,
                        `wthrbg_sys_page_component_types`.`DESCRIPTION_BLOB`,
                        `wthrbg_sys_page_component_types`.`URI_PATH_NEW`,
                        `wthrbg_sys_page_component_types`.`ISACTIVE`,
                        `wthrbg_sys_page_component_types`.`CREATOR_ID`,
                        `wthrbg_sys_page_component_types`.`CREATOR_IP`,
                        `wthrbg_sys_page_component_types`.`CREATOR_SESSION_ID`,
                        `wthrbg_sys_page_component_types`.`MODIFIER_ID`,
                        `wthrbg_sys_page_component_types`.`MODIFIER_IP`,
                        `wthrbg_sys_page_component_types`.`MODIFIER_SESSION_ID`,
                        `wthrbg_sys_page_component_types`.`DATEMODIFIED`,
                        `wthrbg_sys_page_component_types`.`DATECREATED`
                    FROM `wthrbg_sys_page_component_types`
                    WHERE `wthrbg_sys_page_component_types`.`ISACTIVE`="1" 
                    ORDER BY `wthrbg_sys_page_component_types`.`NAME`
                    ;';

                    $tmp_SELECT_ARRAY[1] = 'SELECT `wthrbg_lang_packs`.`LANGPACK_ID`,
                        `wthrbg_lang_packs`.`LANG_ID`,
                        `wthrbg_lang_packs`.`NAME`,
                        `wthrbg_lang_packs`.`NATIVE_NAME`,
                        `wthrbg_lang_packs`.`NATIVE_NAME_BLOB`,
                        `wthrbg_lang_packs`.`ISACTIVE`,
                        `wthrbg_lang_packs`.`RTL_FLAG`,
                        `wthrbg_lang_packs`.`FONT_SIZE_PERCENTAGE`,
                        `wthrbg_lang_packs`.`TIMER_FONT_SIZE_PERCENTAGE`,
                        `wthrbg_lang_packs`.`COPY_PADDING_TOP_PX`,
                        `wthrbg_lang_packs`.`DATEMODIFIED`,
                        `wthrbg_lang_packs`.`DATECREATED`
                    FROM `wthrbg_lang_packs` WHERE `wthrbg_lang_packs`.`ISACTIVE`="1";
                    ';

                    $tmp_SELECT_ARRAY[2] = 'SELECT `wthrbg_colors_hex`.`COLOR_ID`,
                        `wthrbg_colors_hex`.`COLOR_APPLICATION_KEY`,
                        `wthrbg_colors_hex`.`COLOR_HEX`,
                        `wthrbg_colors_hex`.`ISACTIVE`,
                        `wthrbg_colors_hex`.`COLOR_NAME`,
                        `wthrbg_colors_hex`.`COLOR_NAME_BLOB`,
                        `wthrbg_colors_hex`.`CREATOR_ID`,
                        `wthrbg_colors_hex`.`CREATOR_IP`,
                        `wthrbg_colors_hex`.`CREATOR_SESSION_ID`,
                        `wthrbg_colors_hex`.`MODIFIER_ID`,
                        `wthrbg_colors_hex`.`MODIFIER_IP`,
                        `wthrbg_colors_hex`.`MODIFIER_SESSION_ID`,
                        `wthrbg_colors_hex`.`DATEMODIFIED`,
                        `wthrbg_colors_hex`.`DATECREATED`
                    FROM `wthrbg_colors_hex`
                    WHERE `wthrbg_colors_hex`.`ISACTIVE`="1" 
                    ORDER BY `wthrbg_colors_hex`.`COLOR_NAME`;
                    ';

                    $tmp_SELECT_ARRAY[3] = 'SELECT `wthrbg_overlay_fullscrn_pages`.`PAGE_ID`,
                        `wthrbg_overlay_fullscrn_pages`.`PROFILE_ID`,
                        `wthrbg_overlay_fullscrn_pages`.`PAGE_NAME`,
                        `wthrbg_overlay_fullscrn_pages`.`PAGE_NAME_BLOB`,
                        `wthrbg_overlay_fullscrn_pages`.`BGCOLOR_HEX`,
                        `wthrbg_overlay_fullscrn_pages`.`OPACITY`,
                        `wthrbg_overlay_fullscrn_pages`.`SEQUENCE`,
                        `wthrbg_overlay_fullscrn_pages`.`CREATOR_ID`,
                        `wthrbg_overlay_fullscrn_pages`.`CREATOR_IP`,
                        `wthrbg_overlay_fullscrn_pages`.`CREATOR_SESSION_ID`,
                        `wthrbg_overlay_fullscrn_pages`.`MODIFIER_ID`,
                        `wthrbg_overlay_fullscrn_pages`.`MODIFIER_IP`,
                        `wthrbg_overlay_fullscrn_pages`.`MODIFIER_SESSION_ID`,
                        `wthrbg_overlay_fullscrn_pages`.`DATEMODIFIED`,
                        `wthrbg_overlay_fullscrn_pages`.`DATECREATED`
                    FROM `wthrbg_overlay_fullscrn_pages` 
                    WHERE  `wthrbg_overlay_fullscrn_pages`.`PAGE_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PAGE_ID')).'" 
                    AND `wthrbg_overlay_fullscrn_pages`.`PAGE_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'" LIMIT 1;
                    ';

                    //
                    // LANG_ELEM
                    $tmp_SELECT_ARRAY[4] = 'SELECT `wthrbg_lang_elem_components`.`ELEMENT_ID`,
                    `wthrbg_lang_elem_components`.`COPY_ID`,
                    `wthrbg_lang_elem_components`.`COMPONENT_ID`,
                    `wthrbg_lang_elem_components`.`PAGE_ID`,
                    `wthrbg_lang_elem_components`.`PROFILE_ID`,
                    `wthrbg_lang_elem_components`.`COPY_HASH`,
                    `wthrbg_lang_elem_components`.`LANG_ID`,
                    `wthrbg_lang_elem_components`.`ISACTIVE`,
                    `wthrbg_lang_elem_components`.`COMPLETION_STATE`,
                    `wthrbg_lang_elem_components`.`DRAFT_OWNER`,
                    `wthrbg_lang_elem_components`.`DATEDRAFTED`,
                    `wthrbg_lang_elem_components`.`DATEPUBLISHED`,
                    `wthrbg_lang_elem_components`.`PROFILE_TYPE`,
                    `wthrbg_lang_elem_components`.`COMPONENT_TYPE`,
                    `wthrbg_lang_elem_components`.`COMPONENT_SEQUENCE`,
                    `wthrbg_lang_elem_components`.`ELEMENT_CONTENT`,
                    `wthrbg_lang_elem_components`.`ELEMENT_CONTENT_BLOB`,
                    `wthrbg_lang_elem_components`.`CREATOR_ID`,
                    INET6_NTOA(`wthrbg_lang_elem_components`.`CREATOR_IP_V6`) AS CREATOR_IP_V6,
                    INET_NTOA(`wthrbg_lang_elem_components`.`CREATOR_IP`) AS CREATOR_IP,
                    `wthrbg_lang_elem_components`.`CREATOR_SESSION_ID`,
                    `wthrbg_lang_elem_components`.`MODIFIER_ID`,
                    INET6_NTOA(`wthrbg_lang_elem_components`.`MODIFIER_IP_V6`) AS MODIFIER_IP_V6,
                    INET_NTOA(`wthrbg_lang_elem_components`.`MODIFIER_IP`) AS MODIFIER_IP,
                    `wthrbg_lang_elem_components`.`MODIFIER_SESSION_ID`,
                    `wthrbg_lang_elem_components`.`DATEMODIFIED`,
                    `wthrbg_lang_elem_components`.`DATECREATED`
                    FROM `wthrbg_lang_elem_components`
                    WHERE `wthrbg_lang_elem_components`.`PROFILE_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID')).'" 
                    AND `wthrbg_lang_elem_components`.`PROFILE_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'" 
                    AND `wthrbg_lang_elem_components`.`PAGE_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PAGE_ID')).'" 
                    AND `wthrbg_lang_elem_components`.`PAGE_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'" 
                    AND `wthrbg_lang_elem_components`.`ISACTIVE`="1"
                    ;';

                    //
                    // PAGE_COMPONENTS
                    $tmp_SELECT_ARRAY[5] = 'SELECT `wthrbg_fullscrn_page_components`.`COMPONENT_ID`,
                    `wthrbg_fullscrn_page_components`.`PROFILE_ID`,
                    `wthrbg_fullscrn_page_components`.`PAGE_ID`,
                    `wthrbg_fullscrn_page_components`.`COMPONENT_TYPE_KEY`,
                    `wthrbg_fullscrn_page_components`.`PAGE_SEQUENCE`,
                    `wthrbg_fullscrn_page_components`.`PROFILE_SEQUENCE`,
                    `wthrbg_fullscrn_page_components`.`ISACTIVE`,
                    `wthrbg_fullscrn_page_components`.`CREATOR_ID`,
                    `wthrbg_fullscrn_page_components`.`CREATOR_IP`,
                    `wthrbg_fullscrn_page_components`.`CREATOR_SESSION_ID`,
                    `wthrbg_fullscrn_page_components`.`MODIFIER_ID`,
                    `wthrbg_fullscrn_page_components`.`MODIFIER_IP`,
                    `wthrbg_fullscrn_page_components`.`MODIFIER_SESSION_ID`,
                    `wthrbg_fullscrn_page_components`.`DATEMODIFIED`,
                    `wthrbg_fullscrn_page_components`.`DATECREATED`
                    FROM `wthrbg_fullscrn_page_components`
                    WHERE `wthrbg_fullscrn_page_components`.`PROFILE_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID')).'" 
                    AND `wthrbg_fullscrn_page_components`.`PROFILE_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                    AND `wthrbg_fullscrn_page_components`.`PAGE_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PAGE_ID')).'" 
                    AND `wthrbg_fullscrn_page_components`.`PAGE_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'" 
                    AND `wthrbg_fullscrn_page_components`.`ISACTIVE`="1"
                    ORDER BY `wthrbg_fullscrn_page_components`.`PAGE_SEQUENCE`
                    ;';

                    //
                    // PAGE_SCHEDULES
                    $tmp_SELECT_ARRAY[6] = 'SELECT `wthrbg_component_schedule`.`SCHEDULE_ID`,
                        `wthrbg_component_schedule`.`COMPONENT_ID`,
                        `wthrbg_component_schedule`.`PROFILE_ID`,
                        `wthrbg_component_schedule`.`PAGE_ID`,
                        `wthrbg_component_schedule`.`ISACTIVE`,
                        `wthrbg_component_schedule`.`DATE_FORMAT`,
                        `wthrbg_component_schedule`.`TIME_FORMAT`,
                        `wthrbg_component_schedule`.`CREATOR_ID`,
                        `wthrbg_component_schedule`.`CREATOR_IP`,
                        `wthrbg_component_schedule`.`CREATOR_SESSION_ID`,
                        `wthrbg_component_schedule`.`MODIFIER_ID`,
                        `wthrbg_component_schedule`.`MODIFIER_IP`,
                        `wthrbg_component_schedule`.`MODIFIER_SESSION_ID`,
                        `wthrbg_component_schedule`.`DATEMODIFIED`,
                        `wthrbg_component_schedule`.`DATECREATED`
                    FROM `wthrbg_component_schedule`
                    WHERE `wthrbg_component_schedule`.`PROFILE_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID')).'" 
                    AND `wthrbg_component_schedule`.`PROFILE_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                    AND `wthrbg_component_schedule`.`PAGE_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PAGE_ID')).'" 
                    AND `wthrbg_component_schedule`.`PAGE_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'" 
                    AND `wthrbg_component_schedule`.`ISACTIVE`="1"
                    ;';

                    //
                    // PAGE_DAYS
                    $tmp_SELECT_ARRAY[7] = 'SELECT `wthrbg_component_schedule_day`.`DAY_ID`,
                    `wthrbg_component_schedule_day`.`PROFILE_ID`,
                    `wthrbg_component_schedule_day`.`PAGE_ID`,
                    `wthrbg_component_schedule_day`.`COMPONENT_ID`,
                    `wthrbg_component_schedule_day`.`ISACTIVE`,
                    `wthrbg_component_schedule_day`.`DATE`,
                    `wthrbg_component_schedule_day`.`DAY_DAY`,
                    `wthrbg_component_schedule_day`.`DAY_MONTH`,
                    `wthrbg_component_schedule_day`.`DAY_YEAR`,
                    `wthrbg_component_schedule_day`.`CREATOR_ID`,
                    `wthrbg_component_schedule_day`.`CREATOR_IP`,
                    `wthrbg_component_schedule_day`.`CREATOR_SESSION_ID`,
                    `wthrbg_component_schedule_day`.`MODIFIER_ID`,
                    `wthrbg_component_schedule_day`.`MODIFIER_IP`,
                    `wthrbg_component_schedule_day`.`MODIFIER_SESSION_ID`,
                    `wthrbg_component_schedule_day`.`DATEMODIFIED`,
                    `wthrbg_component_schedule_day`.`DATECREATED`
                    FROM `wthrbg_component_schedule_day`
                    WHERE `wthrbg_component_schedule_day`.`PROFILE_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID')).'" 
                    AND `wthrbg_component_schedule_day`.`PROFILE_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                    AND `wthrbg_component_schedule_day`.`PAGE_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PAGE_ID')).'" 
                    AND `wthrbg_component_schedule_day`.`PAGE_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'" 
                    AND `wthrbg_component_schedule_day`.`ISACTIVE`="1"
                    ORDER BY `wthrbg_component_schedule_day`.`DATE`
                    ;';

                    //
                    // PAGE_EVENTS
                    $tmp_SELECT_ARRAY[8] = 'SELECT `wthrbg_component_schedule_event`.`EVENT_ID`,
                   `wthrbg_component_schedule_event`.`ELEMENT_ID`,                 
                   `wthrbg_component_schedule_event`.`DAY_ID`,
                    `wthrbg_component_schedule_event`.`COMPONENT_ID`,
                    `wthrbg_component_schedule_event`.`PAGE_ID`,
                    `wthrbg_component_schedule_event`.`PROFILE_ID`,
                    `wthrbg_component_schedule_event`.`DATE`,
                    `wthrbg_component_schedule_event`.`DESCRIPTION_IS_BOLD`,
                    `wthrbg_component_schedule_event`.`ISACTIVE`,
                    `wthrbg_component_schedule_event`.`CREATOR_ID`,
                    `wthrbg_component_schedule_event`.`CREATOR_IP`,
                    `wthrbg_component_schedule_event`.`CREATOR_SESSION_ID`,
                    `wthrbg_component_schedule_event`.`MODIFIER_ID`,
                    `wthrbg_component_schedule_event`.`MODIFIER_IP`,
                    `wthrbg_component_schedule_event`.`MODIFIER_SESSION_ID`,
                    `wthrbg_component_schedule_event`.`DATEMODIFIED`,
                    `wthrbg_component_schedule_event`.`DATECREATED`
                    FROM `wthrbg_component_schedule_event`
                    WHERE `wthrbg_component_schedule_event`.`PROFILE_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID')).'" 
                    AND `wthrbg_component_schedule_event`.`PAGE_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PAGE_ID')).'" 
                    AND `wthrbg_component_schedule_event`.`ISACTIVE`="1"
                    ORDER BY `wthrbg_component_schedule_event`.`DATE`
                    ;';

                    //
                    // BULLET_LIST
                    $tmp_SELECT_ARRAY[9] = 'SELECT `wthrbg_component_bulletlist`.`BULLET_LIST_ID`,
                    `wthrbg_component_bulletlist`.`COMPONENT_ID`,
                    `wthrbg_component_bulletlist`.`PAGE_ID`,
                    `wthrbg_component_bulletlist`.`PROFILE_ID`,
                    `wthrbg_component_bulletlist`.`ISACTIVE`,
                    `wthrbg_component_bulletlist`.`ISORDERED`,
                    `wthrbg_component_bulletlist`.`BULLET_STYLE_ORDERED`,
                    `wthrbg_component_bulletlist`.`BULLET_STYLE_NOT_ORDERED`,
                    `wthrbg_component_bulletlist`.`CREATOR_ID`,
                    `wthrbg_component_bulletlist`.`CREATOR_IP`,
                    `wthrbg_component_bulletlist`.`CREATOR_SESSION_ID`,
                    `wthrbg_component_bulletlist`.`MODIFIER_ID`,
                    `wthrbg_component_bulletlist`.`MODIFIER_IP`,
                    `wthrbg_component_bulletlist`.`MODIFIER_SESSION_ID`,
                    `wthrbg_component_bulletlist`.`DATEMODIFIED`,
                    `wthrbg_component_bulletlist`.`DATECREATED`
                    FROM `wthrbg_component_bulletlist`
                    WHERE `wthrbg_component_bulletlist`.`PROFILE_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID')).'" 
                    AND `wthrbg_component_bulletlist`.`PROFILE_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                    AND `wthrbg_component_bulletlist`.`PAGE_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PAGE_ID')).'" 
                    AND `wthrbg_component_bulletlist`.`PAGE_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'" 
                    AND `wthrbg_component_bulletlist`.`ISACTIVE`="1"
                    ;';

                    //
                    // BULLET_BULLETS
                    $tmp_SELECT_ARRAY[10] = 'SELECT `wthrbg_component_bulletlist_bullets`.`BULLET_ID`,
                    `wthrbg_component_bulletlist_bullets`.`ELEMENT_ID`,
                    `wthrbg_component_bulletlist_bullets`.`COMPONENT_ID`,
                    `wthrbg_component_bulletlist_bullets`.`PAGE_ID`,
                    `wthrbg_component_bulletlist_bullets`.`PROFILE_ID`,
                    `wthrbg_component_bulletlist_bullets`.`ISACTIVE`,
                    `wthrbg_component_bulletlist_bullets`.`DESCRIPTION_IS_BOLD`,
                    `wthrbg_component_bulletlist_bullets`.`SEQUENCE`,
                    `wthrbg_component_bulletlist_bullets`.`CREATOR_ID`,
                    `wthrbg_component_bulletlist_bullets`.`CREATOR_IP`,
                    `wthrbg_component_bulletlist_bullets`.`CREATOR_SESSION_ID`,
                    `wthrbg_component_bulletlist_bullets`.`MODIFIER_ID`,
                    `wthrbg_component_bulletlist_bullets`.`MODIFIER_IP`,
                    `wthrbg_component_bulletlist_bullets`.`MODIFIER_SESSION_ID`,
                    `wthrbg_component_bulletlist_bullets`.`DATEMODIFIED`,
                    `wthrbg_component_bulletlist_bullets`.`DATECREATED`
                    FROM `wthrbg_component_bulletlist_bullets`
                    WHERE `wthrbg_component_bulletlist_bullets`.`PROFILE_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID')).'" 
                    AND `wthrbg_component_bulletlist_bullets`.`PROFILE_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                    AND `wthrbg_component_bulletlist_bullets`.`PAGE_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PAGE_ID')).'" 
                    AND `wthrbg_component_bulletlist_bullets`.`PAGE_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'" 
                    AND `wthrbg_component_bulletlist_bullets`.`ISACTIVE`="1"
                    ORDER BY `wthrbg_component_bulletlist_bullets`.`SEQUENCE` 
                    ;';

                    //
                    // PARAGRAPH
                    $tmp_SELECT_ARRAY[11] = 'SELECT `wthrbg_component_paragraph`.`PARAGRAPH_ID`,
                    `wthrbg_component_paragraph`.`ELEMENT_ID`,
                    `wthrbg_component_paragraph`.`COMPONENT_ID`,
                    `wthrbg_component_paragraph`.`PAGE_ID`,
                    `wthrbg_component_paragraph`.`PROFILE_ID`,
                    `wthrbg_component_paragraph`.`ISACTIVE`,
                    `wthrbg_component_paragraph`.`IS_BOLD`,
                    `wthrbg_component_paragraph`.`IS_BLOCKQUOTE`,
                    `wthrbg_component_paragraph`.`COPY_ALIGNMENT`,
                    `wthrbg_component_paragraph`.`CREATOR_ID`,
                    `wthrbg_component_paragraph`.`CREATOR_IP`,
                    `wthrbg_component_paragraph`.`CREATOR_SESSION_ID`,
                    `wthrbg_component_paragraph`.`MODIFIER_ID`,
                    `wthrbg_component_paragraph`.`MODIFIER_IP`,
                    `wthrbg_component_paragraph`.`MODIFIER_SESSION_ID`,
                    `wthrbg_component_paragraph`.`DATEMODIFIED`,
                    `wthrbg_component_paragraph`.`DATECREATED`
                    FROM `wthrbg_component_paragraph`
                    WHERE `wthrbg_component_paragraph`.`PROFILE_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID')).'" 
                    AND `wthrbg_component_paragraph`.`PROFILE_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                    AND `wthrbg_component_paragraph`.`PAGE_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PAGE_ID')).'" 
                    AND `wthrbg_component_paragraph`.`PAGE_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'" 
                    AND `wthrbg_component_paragraph`.`ISACTIVE`="1"
                    ;';

                    //
                    // SUB_TITLE
                    $tmp_SELECT_ARRAY[12] = 'SELECT `wthrbg_component_subtitle`.`SUBTITLE_ID`,
                        `wthrbg_component_subtitle`.`ELEMENT_ID`,
                        `wthrbg_component_subtitle`.`COMPONENT_ID`,
                        `wthrbg_component_subtitle`.`PAGE_ID`,
                        `wthrbg_component_subtitle`.`PROFILE_ID`,
                        `wthrbg_component_subtitle`.`ISACTIVE`,
                        `wthrbg_component_subtitle`.`COPY_ALIGNMENT`,
                        `wthrbg_component_subtitle`.`CREATOR_ID`,
                        `wthrbg_component_subtitle`.`CREATOR_IP`,
                        `wthrbg_component_subtitle`.`CREATOR_SESSION_ID`,
                        `wthrbg_component_subtitle`.`MODIFIER_ID`,
                        `wthrbg_component_subtitle`.`MODIFIER_IP`,
                        `wthrbg_component_subtitle`.`MODIFIER_SESSION_ID`,
                        `wthrbg_component_subtitle`.`DATEMODIFIED`,
                        `wthrbg_component_subtitle`.`DATECREATED`
                    FROM `wthrbg_component_subtitle`
                    WHERE `wthrbg_component_subtitle`.`PROFILE_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID')).'" 
                    AND `wthrbg_component_subtitle`.`PROFILE_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                    AND `wthrbg_component_subtitle`.`PAGE_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PAGE_ID')).'" 
                    AND `wthrbg_component_subtitle`.`PAGE_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data('PAGE_ID')).'" 
                    AND `wthrbg_component_subtitle`.`ISACTIVE`="1"
                    ;';

                    $oDB_RESP->process(self::$mysqli,$queryType, $tmp_SELECT_ARRAY);

                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'LANG_PACKS', 'LANG_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'DE_COLORES', 'COLOR_HEX');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'PAGE_SCHEDULES', 'COMPONENT_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'COMPONENT_TYPES', 'TYPE_KEY');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'PAGE_EVENTS', 'DAY_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'PAGE_DAYS', 'COMPONENT_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'BULLET_LIST', 'COMPONENT_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'BULLET_BULLETS', 'COMPONENT_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'PARAGRAPH', 'COMPONENT_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'LANG_ELEM', 'ELEMENT_ID');

                    $ID_ARRAY[0] = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'FULLSCRN_PAGE', 'PROFILE_ID'); //$oUser->retrieve_Form_Data('PROFILE_ID');
                    $IDTYPE_ARRAY[0] = "FULLSCRN_PROFILE";
                    $tmp_data_aug_resp_serial_key = 'DATA_AUG_00';
                    $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                    $oDB_RESP = $dataAugmenter->return_oDB_RESP();

                    return $oDB_RESP;

                    break;
                case 'create_fullscrn_overlay_page':

                    $tmp_userid = $oEnv->oSESSION_MGR->getSessionParam('USERID');
                    $tmp_page_id = $oUser->generateNewKey(70);
                    $oUser->collectNewElementID('PAGE_ID', $tmp_page_id);

                    $tmp_activityid = $oUser->generateNewKey(70);

                    //
                    // NEED TO CALCULATE SEQUENCE OR SOMETHING....MAYBE SEND FROM POST PAGE.
                    $tmp_sequence = 0;

                    $ID_ARRAY[0] = $oUser->retrieve_Form_Data('PROFILE_ID');
                    $IDTYPE_ARRAY[0] = "FULLSCRN_PROFILE";
                    $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                    $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                    $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME'));

                    $tmp_activitydescription = 'A new page ('.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PAGE_NAME')).') has been added to the full screen overlay profile ('.$tmp_profile_name.').';

                    //
                    // QUERY CONSTRUCTION ::
                    self::$query = 'INSERT INTO `wthrbg_overlay_fullscrn_pages`
                    (`PAGE_ID`,
                    `PAGE_ID_CRC32`,
                    `PROFILE_ID`,
                    `PROFILE_ID_CRC32`,
                    `PAGE_NAME`,
                    `PAGE_NAME_BLOB`,
                    `BGCOLOR_HEX`,
                    `OPACITY`,
                    `SEQUENCE`,
                    `CREATOR_ID`,
                    `CREATOR_IP_V6`,
                    `CREATOR_IP`,
                    `CREATOR_SESSION_ID`,
                    `MODIFIER_ID`,
                    `MODIFIER_IP_V6`,
                    `MODIFIER_IP`,
                    `MODIFIER_SESSION_ID`,
                    `DATEMODIFIED`)
                    VALUES
                    ("'.$tmp_page_id.'",
                    "'.crc32($tmp_page_id).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID')).'",
                    "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PAGE_NAME')).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PAGE_NAME')).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('BGCOLOR_HEX')).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('OPACITY')).'",
                    "'.$tmp_sequence.'",
                    "'.$tmp_userid.'",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "' . session_id() . '",
                    "'.$tmp_userid.'",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "' . session_id() . '",
                    "'.$ts.'");
                    ';


                    self::$query .= 'INSERT INTO `wthrbg_log_sys_user`
                    (`ACTIVITY_ID`,
                    `MODIFIER_ID`,
                    `MODIFIER_ID_CRC32`,
                    `FULL_SCRN_PROFILE_ID`,
                    `FULL_SCRN_PROFILE_ID_CRC32`,
                    `ACTIVITY_DESCRIPTION`,
                    `ACTIVITY_DESCRIPTION_BLOB`,
                    `PHPSESSION`,
                    `IPADDRESS_V6`,
                    `IPADDRESS`,
                    `HTTP_USER_AGENT`,
                    `CHANNEL`)
                    VALUES
                    ("'.$tmp_activityid.'",
                    "'.$tmp_userid.'",
                    "'.crc32($tmp_userid).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID')).'",
                    "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'",
                    "'.self::$mysqli->real_escape_string($oUser->searchTruncStr($tmp_activitydescription, 1000)).'",
                    "'.self::$mysqli->real_escape_string($tmp_activitydescription).'",
                    "' . session_id() . '",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "'.$_SERVER['HTTP_USER_AGENT'].'",
                    "'.strtoupper($oEnv->oSESSION_MGR->getSessionParam("DEVICETYPE")).'");
                    ';


                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else{

                        return 'create_fullscrn_overlay_page=success';
                    }


                    break;
                case 'get_obs_mini_profile_data':

                    //
                    // DO WE HAVE THIS OBS_ID?
                    $force_profile_select_align = true;
                    $db_resp_process_serial = "!jesus_is_my_dear_lord!";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();         //$oUser->return_serial_handle();
                    $db_resp_target_profiles = 'OBS_CLIENT|MINI_PROFILE|LANG_PACKS';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '24|22|12';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION ::
                    $tmp_SELECT_ARRAY = array();
                    $tmp_SELECT_ARRAY[0] = 'SELECT `wthrbg_obs_clients`.`OBSCLIENT_ID`,
                        `wthrbg_obs_clients`.`OBS_ID`,
                        `wthrbg_obs_clients`.`ISACTIVE`,
                        `wthrbg_obs_clients`.`FULLSCRN_PROFILE_ID`,
                        `wthrbg_obs_clients`.`MINI_PROFILE_ID`,
                        `wthrbg_obs_clients`.`OBS_ID_DISPLAY`,
                        `wthrbg_obs_clients`.`XML_INDEX_DIR_FILE_PATH`,
                        `wthrbg_obs_clients`.`ISVISIBLE_FULLSCRN`,
                        `wthrbg_obs_clients`.`ISVISIBLE_MINI`,
                        `wthrbg_obs_clients`.`MINI_DISPLAY_MODE`,
                        `wthrbg_obs_clients`.`CURRENT_WALL_TIME`,
                        `wthrbg_obs_clients`.`CURRENT_LANG_PACK_FULLSCRN`,
                        `wthrbg_obs_clients`.`CURRENT_LANG_PACK_MINI`,
                        `wthrbg_obs_clients`.`LAST_CONTACT`,
                        `wthrbg_obs_clients`.`FULLSCRN_VIEW_STATE`,
                        `wthrbg_obs_clients`.`MINI_VIEW_STATE`,
                        `wthrbg_obs_clients`.`CREATOR_ID`,
                        `wthrbg_obs_clients`.`CREATOR_IP`,
                        `wthrbg_obs_clients`.`CREATOR_SESSION_ID`,
                        `wthrbg_obs_clients`.`MODIFIER_ID`,
                        `wthrbg_obs_clients`.`MODIFIER_IP`,
                        `wthrbg_obs_clients`.`MODIFIER_SESSION_ID`,
                        `wthrbg_obs_clients`.`DATEMODIFIED`,
                        `wthrbg_obs_clients`.`DATECREATED`
                    FROM `wthrbg_obs_clients` WHERE  `wthrbg_obs_clients`.`ISACTIVE`="1" 
                    AND `wthrbg_obs_clients`.`FULLSCRN_PROFILE_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID')).'";
                    ';

                    $tmp_SELECT_ARRAY[1] = 'SELECT `wthrbg_overlay_mini_profile`.`PROFILE_ID`,
                        `wthrbg_overlay_mini_profile`.`PROFILE_ID_CRC32`,
                        `wthrbg_overlay_mini_profile`.`ISACTIVE`,
                        `wthrbg_overlay_mini_profile`.`PROFILE_NAME`,
                        `wthrbg_overlay_mini_profile`.`PROFILE_NAME_BLOB`,
                        `wthrbg_overlay_mini_profile`.`OPACITY`,
                        `wthrbg_overlay_mini_profile`.`BGCOLOR_HEX`,
                        `wthrbg_overlay_mini_profile`.`OVERLAY_HEIGHT`,
                        `wthrbg_overlay_mini_profile`.`OVERLAY_WIDTH`,
                        `wthrbg_overlay_mini_profile`.`INNER_CONTENT_WIDTH`,
                        `wthrbg_overlay_mini_profile`.`MARGIN_LEFT`,
                        `wthrbg_overlay_mini_profile`.`MARGIN_RIGHT`,
                        `wthrbg_overlay_mini_profile`.`ABS_PX_FROM_TOP`,
                        `wthrbg_overlay_mini_profile`.`ABS_PX_FROM_LEFT`,
                        `wthrbg_overlay_mini_profile`.`CREATOR_ID`,
                        `wthrbg_overlay_mini_profile`.`CREATOR_IP`,
                        `wthrbg_overlay_mini_profile`.`CREATOR_SESSION_ID`,
                        `wthrbg_overlay_mini_profile`.`MODIFIER_ID`,
                        `wthrbg_overlay_mini_profile`.`MODIFIER_IP`,
                        `wthrbg_overlay_mini_profile`.`MODIFIER_SESSION_ID`,
                        `wthrbg_overlay_mini_profile`.`DATEMODIFIED`,
                        `wthrbg_overlay_mini_profile`.`DATECREATED`
                        FROM `wthrbg_overlay_mini_profile` 
                        WHERE `wthrbg_overlay_mini_profile`.`PROFILE_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                        AND `wthrbg_overlay_mini_profile`.`PROFILE_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                        AND `wthrbg_overlay_mini_profile`.`ISACTIVE`="1";
                        ';

                    $tmp_SELECT_ARRAY[2] = 'SELECT `wthrbg_lang_packs`.`LANGPACK_ID`,
                        `wthrbg_lang_packs`.`LANG_ID`,
                        `wthrbg_lang_packs`.`NAME`,
                        `wthrbg_lang_packs`.`NATIVE_NAME`,
                        `wthrbg_lang_packs`.`NATIVE_NAME_BLOB`,
                        `wthrbg_lang_packs`.`ISACTIVE`,
                        `wthrbg_lang_packs`.`RTL_FLAG`,
                        `wthrbg_lang_packs`.`FONT_SIZE_PERCENTAGE`,
                        `wthrbg_lang_packs`.`TIMER_FONT_SIZE_PERCENTAGE`,
                        `wthrbg_lang_packs`.`COPY_PADDING_TOP_PX`,
                        `wthrbg_lang_packs`.`DATEMODIFIED`,
                        `wthrbg_lang_packs`.`DATECREATED`
                    FROM `wthrbg_lang_packs` WHERE `wthrbg_lang_packs`.`ISACTIVE`="1";
                    ';

                    $oDB_RESP->process(self::$mysqli,$queryType, $tmp_SELECT_ARRAY);

                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'LANG_PACKS', 'LANG_ID');

                    return $oDB_RESP;

                    break;
                case 'get_obs_fullscrn_profile_data':

                    //
                    // DO WE HAVE THIS OBS_ID?
                    $force_profile_select_align = true;
                    $db_resp_process_serial = "!jesus_is_my_dear_lord!";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();         //$oUser->return_serial_handle();
                    $db_resp_target_profiles = 'OBS_CLIENT|FULL_SCRN_PROFILE|LANG_PACKS|FULLSCRN_PAGES|DE_COLORES|LANG_REQUESTS';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '24|14|12|16|14|15';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE
                    //
                    // QUERY CONSTRUCTION ::
                    $tmp_SELECT_ARRAY = array();
                    $tmp_SELECT_ARRAY[0] = 'SELECT `wthrbg_obs_clients`.`OBSCLIENT_ID`,
                        `wthrbg_obs_clients`.`OBS_ID`,
                        `wthrbg_obs_clients`.`ISACTIVE`,
                        `wthrbg_obs_clients`.`FULLSCRN_PROFILE_ID`,
                        `wthrbg_obs_clients`.`MINI_PROFILE_ID`,
                        `wthrbg_obs_clients`.`OBS_ID_DISPLAY`,
                        `wthrbg_obs_clients`.`XML_INDEX_DIR_FILE_PATH`,
                        `wthrbg_obs_clients`.`ISVISIBLE_FULLSCRN`,
                        `wthrbg_obs_clients`.`ISVISIBLE_MINI`,
                        `wthrbg_obs_clients`.`MINI_DISPLAY_MODE`,
                        `wthrbg_obs_clients`.`CURRENT_WALL_TIME`,
                        `wthrbg_obs_clients`.`CURRENT_LANG_PACK_FULLSCRN`,
                        `wthrbg_obs_clients`.`CURRENT_LANG_PACK_MINI`,
                        `wthrbg_obs_clients`.`LAST_CONTACT`,
                        `wthrbg_obs_clients`.`FULLSCRN_VIEW_STATE`,
                        `wthrbg_obs_clients`.`MINI_VIEW_STATE`,
                        `wthrbg_obs_clients`.`CREATOR_ID`,
                        `wthrbg_obs_clients`.`CREATOR_IP`,
                        `wthrbg_obs_clients`.`CREATOR_SESSION_ID`,
                        `wthrbg_obs_clients`.`MODIFIER_ID`,
                        `wthrbg_obs_clients`.`MODIFIER_IP`,
                        `wthrbg_obs_clients`.`MODIFIER_SESSION_ID`,
                        `wthrbg_obs_clients`.`DATEMODIFIED`,
                        `wthrbg_obs_clients`.`DATECREATED`
                    FROM `wthrbg_obs_clients` WHERE  `wthrbg_obs_clients`.`ISACTIVE`="1" 
                    AND 
                    (`wthrbg_obs_clients`.`FULLSCRN_PROFILE_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID')).'" 
                    OR `wthrbg_obs_clients`.`FULLSCRN_PROFILE_ID`="demo");
                    ';

                    $tmp_SELECT_ARRAY[1] = 'SELECT `wthrbg_overlay_fullscrn_profile`.`PROFILE_ID`,
                        `wthrbg_overlay_fullscrn_profile`.`ISACTIVE`,
                        `wthrbg_overlay_fullscrn_profile`.`PROFILE_NAME`,
                        `wthrbg_overlay_fullscrn_profile`.`PROFILE_NAME_BLOB`,
                        `wthrbg_overlay_fullscrn_profile`.`OPACITY`,
                        `wthrbg_overlay_fullscrn_profile`.`BGCOLOR_HEX`,
                        `wthrbg_overlay_fullscrn_profile`.`CREATOR_ID`,
                        `wthrbg_overlay_fullscrn_profile`.`CREATOR_IP`,
                        `wthrbg_overlay_fullscrn_profile`.`CREATOR_SESSION_ID`,
                        `wthrbg_overlay_fullscrn_profile`.`MODIFIER_ID`,
                        `wthrbg_overlay_fullscrn_profile`.`MODIFIER_IP`,
                        `wthrbg_overlay_fullscrn_profile`.`MODIFIER_SESSION_ID`,
                        `wthrbg_overlay_fullscrn_profile`.`DATEMODIFIED`,
                        `wthrbg_overlay_fullscrn_profile`.`DATECREATED` 
                        FROM `wthrbg_overlay_fullscrn_profile` 
                        WHERE `wthrbg_overlay_fullscrn_profile`.`PROFILE_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                        AND `wthrbg_overlay_fullscrn_profile`.`PROFILE_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                        AND `wthrbg_overlay_fullscrn_profile`.`ISACTIVE`="1";
                        ';

                    $tmp_SELECT_ARRAY[2] = 'SELECT `wthrbg_lang_packs`.`LANGPACK_ID`,
                        `wthrbg_lang_packs`.`LANG_ID`,
                        `wthrbg_lang_packs`.`NAME`,
                        `wthrbg_lang_packs`.`NATIVE_NAME`,
                        `wthrbg_lang_packs`.`NATIVE_NAME_BLOB`,
                        `wthrbg_lang_packs`.`ISACTIVE`,
                        `wthrbg_lang_packs`.`RTL_FLAG`,
                        `wthrbg_lang_packs`.`FONT_SIZE_PERCENTAGE`,
                        `wthrbg_lang_packs`.`TIMER_FONT_SIZE_PERCENTAGE`,
                        `wthrbg_lang_packs`.`COPY_PADDING_TOP_PX`,
                        `wthrbg_lang_packs`.`DATEMODIFIED`,
                        `wthrbg_lang_packs`.`DATECREATED`
                    FROM `wthrbg_lang_packs` 
                    WHERE `wthrbg_lang_packs`.`ISACTIVE`="1";
                    ';


                    $tmp_SELECT_ARRAY[3] = 'SELECT `wthrbg_overlay_fullscrn_pages`.`PAGE_ID`,
                        `wthrbg_overlay_fullscrn_pages`.`PROFILE_ID`,
                        `wthrbg_overlay_fullscrn_pages`.`ISACTIVE`,
                        `wthrbg_overlay_fullscrn_pages`.`PAGE_NAME`,
                        `wthrbg_overlay_fullscrn_pages`.`PAGE_NAME_BLOB`,
                        `wthrbg_overlay_fullscrn_pages`.`BGCOLOR_HEX`,
                        `wthrbg_overlay_fullscrn_pages`.`OPACITY`,
                        `wthrbg_overlay_fullscrn_pages`.`SEQUENCE`,
                        `wthrbg_overlay_fullscrn_pages`.`CREATOR_ID`,
                        `wthrbg_overlay_fullscrn_pages`.`CREATOR_IP`,
                        `wthrbg_overlay_fullscrn_pages`.`CREATOR_SESSION_ID`,
                        `wthrbg_overlay_fullscrn_pages`.`MODIFIER_ID`,
                        `wthrbg_overlay_fullscrn_pages`.`MODIFIER_IP`,
                        `wthrbg_overlay_fullscrn_pages`.`MODIFIER_SESSION_ID`,
                        `wthrbg_overlay_fullscrn_pages`.`DATEMODIFIED`,
                        `wthrbg_overlay_fullscrn_pages`.`DATECREATED`
                    FROM `wthrbg_overlay_fullscrn_pages` 
                    WHERE `wthrbg_overlay_fullscrn_pages`.`ISACTIVE`="1"
                    AND `wthrbg_overlay_fullscrn_pages`.`PROFILE_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID')).'" 
                    AND `wthrbg_overlay_fullscrn_pages`.`PROFILE_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'" 
                    ORDER BY `wthrbg_overlay_fullscrn_pages`.`SEQUENCE` ASC;
                    ';

                    $tmp_SELECT_ARRAY[4] = 'SELECT `wthrbg_colors_hex`.`COLOR_ID`,
                        `wthrbg_colors_hex`.`COLOR_APPLICATION_KEY`,
                        `wthrbg_colors_hex`.`COLOR_HEX`,
                        `wthrbg_colors_hex`.`ISACTIVE`,
                        `wthrbg_colors_hex`.`COLOR_NAME`,
                        `wthrbg_colors_hex`.`COLOR_NAME_BLOB`,
                        `wthrbg_colors_hex`.`CREATOR_ID`,
                        `wthrbg_colors_hex`.`CREATOR_IP`,
                        `wthrbg_colors_hex`.`CREATOR_SESSION_ID`,
                        `wthrbg_colors_hex`.`MODIFIER_ID`,
                        `wthrbg_colors_hex`.`MODIFIER_IP`,
                        `wthrbg_colors_hex`.`MODIFIER_SESSION_ID`,
                        `wthrbg_colors_hex`.`DATEMODIFIED`,
                        `wthrbg_colors_hex`.`DATECREATED`
                    FROM `wthrbg_colors_hex`
                    WHERE `wthrbg_colors_hex`.`ISACTIVE`="1" 
                    ORDER BY `wthrbg_colors_hex`.`COLOR_NAME`;
                    ';

                    $tmp_SELECT_ARRAY[5] = 'SELECT `wthrbg_profile_lang_requests`.`REQUEST_ID`,
                        `wthrbg_profile_lang_requests`.`FULLSCRN_PROFILE_ID`,
                        `wthrbg_profile_lang_requests`.`MINI_PROFILE_ID`,
                        `wthrbg_profile_lang_requests`.`LANG_ID`,
                        `wthrbg_profile_lang_requests`.`ISACTIVE`,
                        `wthrbg_profile_lang_requests`.`CREATOR_ID`,
                        INET6_NTOA(`wthrbg_profile_lang_requests`.`CREATOR_IP_V6`) AS CREATOR_IP_V6,
                        INET_NTOA(`wthrbg_profile_lang_requests`.`CREATOR_IP`) AS CREATOR_IP,
                        `wthrbg_profile_lang_requests`.`CREATOR_SESSION_ID`,
                        `wthrbg_profile_lang_requests`.`MODIFIER_ID`,
                        INET6_NTOA(`wthrbg_profile_lang_requests`.`MODIFIER_IP_V6`) AS MODIFIER_IP_V6,
                        INET_NTOA(`wthrbg_profile_lang_requests`.`MODIFIER_IP`) AS MODIFIER_IP,
                        `wthrbg_profile_lang_requests`.`MODIFIER_SESSION_ID`,
                        `wthrbg_profile_lang_requests`.`DATEMODIFIED`,
                        `wthrbg_profile_lang_requests`.`DATECREATED`
                    FROM `wthrbg_profile_lang_requests`
                    WHERE ((`wthrbg_profile_lang_requests`.`FULLSCRN_PROFILE_ID`= "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID')).'" 
                    AND `wthrbg_profile_lang_requests`.`FULLSCRN_PROFILE_ID_CRC32`= "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'" )
                    OR (`wthrbg_profile_lang_requests`.`MINI_PROFILE_ID`= "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID')).'"
                    AND `wthrbg_profile_lang_requests`.`MINI_PROFILE_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'" ))
                    AND `wthrbg_profile_lang_requests`.`ISACTIVE`="1" 
                    ORDER BY `wthrbg_profile_lang_requests`.`LANG_ID` DESC;
                    ';

                    $oDB_RESP->process(self::$mysqli,$queryType, $tmp_SELECT_ARRAY);

                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'LANG_PACKS', 'LANG_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'LANG_REQUESTS', 'LANG_ID');

                    return $oDB_RESP;

                    break;
                case 'obs_client_mini_display_mode':

                    $tmp_userid = $oEnv->oSESSION_MGR->getSessionParam('USERID');
                    $tmp_obs_client_id = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('OBSCLIENT_ID'));
                    $tmp_mini_display_mode = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('MINI_DISPLAY_MODE'));
                    $tmp_postid = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('POSTID'));

                    $ID_ARRAY[0] = $tmp_obs_client_id;
                    $IDTYPE_ARRAY[0] = "OBS_CLIENT";

                    $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                    $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                    $tmp_obsclient_name = self::$mysqli->real_escape_string($dataAugmenter->getData('OBS_CLIENT',0,'OBS_ID_DISPLAY'));

                    $tmp_obsclient_name = self::$mysqli->real_escape_string($dataAugmenter->getData('OBS_CLIENT',0,'OBS_ID_DISPLAY'));

                    $ID_ARRAY[0] = self::$mysqli->real_escape_string($dataAugmenter->getData('OBS_CLIENT',0,'MINI_PROFILE_ID'));
                    $IDTYPE_ARRAY[0] = "MINI_PROFILE";
                    $tmp_data_aug_resp_serial_key = 'DATA_AUG_02';
                    $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                    $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('MINI_PROFILE',0,'PROFILE_NAME'));

                    $tmp_activityid = $oUser->generateNewKey(70);

                    switch($tmp_mini_display_mode){
                        case 'SCROLL':

                            $tmp_mode_name = 'Horizontal Scroll';

                            break;
                        case 'FULL':

                            $tmp_mode_name = 'Full Content Display';

                            break;
                        case 'SLEEP':

                            $tmp_mode_name = 'Sleep';

                            break;
                        case 'SLEEP_ALT':

                            $tmp_mode_name = 'Sleep / Alternate';

                            break;
                        case 'SLEEP_SCROLL':

                            $tmp_mode_name = 'Sleep / Horizontal Scroll';

                            break;
                        case 'SLEEP_FULL':

                            $tmp_mode_name = 'Sleep / Full Content Display';

                            break;
                        case 'HIDDEN':

                            $tmp_mode_name = 'Hidden';

                            break;

                    }


                    $tmp_activitydescription = 'The mini overlay display mode for the OBS client ('.$tmp_obsclient_name.') has been changed to <i>'.$tmp_mode_name.'</i>. It is loaded with the profile: '.$tmp_profile_name.'.';

                    self::$query = 'UPDATE `wthrbg_obs_clients`
                    SET
                    `MINI_DISPLAY_MODE` = "'.$tmp_mini_display_mode.'",
                    `MODIFIER_ID` = "'.$tmp_userid.'",
                    `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    `MODIFIER_SESSION_ID` = "' . session_id() . '",
                    `DATEMODIFIED` = "' . $ts . '"
                    WHERE `OBSCLIENT_ID` = "'.$tmp_obs_client_id.'" 
                    LIMIT 1;
                    ';

                    self::$query .= 'INSERT INTO `wthrbg_log_sys_user`
                    (`ACTIVITY_ID`,
                    `MODIFIER_ID`,
                    `MODIFIER_ID_CRC32`,
                    `OBSCLIENT_ID`,
                    `OBSCLIENT_ID_CRC32`,
                    `ACTIVITY_DESCRIPTION`,
                    `ACTIVITY_DESCRIPTION_BLOB`,
                    `PHPSESSION`,
                    `IPADDRESS_V6`,
                    `IPADDRESS`,
                    `HTTP_USER_AGENT`,
                    `CHANNEL`)
                    VALUES
                    ("'.$tmp_activityid.'",
                    "'.$tmp_userid.'",
                    "'.crc32($tmp_userid).'",
                    "'.$tmp_obs_client_id.'",
                    "'.crc32($tmp_obs_client_id).'",
                    "'.self::$mysqli->real_escape_string($oUser->searchTruncStr($tmp_activitydescription, 1000)).'",
                    "'.self::$mysqli->real_escape_string($tmp_activitydescription).'",
                    "' . session_id() . '",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "'.$_SERVER['HTTP_USER_AGENT'].'",
                    "'.strtoupper($oEnv->oSESSION_MGR->getSessionParam("DEVICETYPE")).'");
                    ';

                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else{

                        return 'radio_select_mini_display_mode=success';
                    }

                    break;
                case 'obs_client_fullscrn_overlay_visibility':

                    $tmp_userid = $oEnv->oSESSION_MGR->getSessionParam('USERID');
                    $tmp_obs_client_id = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('OBSCLIENT_ID'));

                    $tmp_postid = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('POSTID'));

                    $ID_ARRAY[0] = $tmp_obs_client_id;
                    $IDTYPE_ARRAY[0] = "OBS_CLIENT";

                    $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                    $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                    //$oUser->storeDataAugment('DATA_AUG_01', $dataAugmenter);
                    $tmp_obsclient_name = self::$mysqli->real_escape_string($dataAugmenter->getData('OBS_CLIENT',0,'OBS_ID_DISPLAY'));

                    $ID_ARRAY[0] = $tmp_obs_client_id;
                    $IDTYPE_ARRAY[0] = "OBS_CLIENT";

                    $ID_ARRAY[1] = self::$mysqli->real_escape_string($dataAugmenter->getData('OBS_CLIENT',0,'FULLSCRN_PROFILE_ID'));
                    $IDTYPE_ARRAY[1] = "FULLSCRN_PROFILE";

                    $tmp_data_aug_resp_serial_key = 'DATA_AUG_02';
                    $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                    $oUser->storeDataAugment('DATA_AUG_02', $dataAugmenter);

                    $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME'));

                    $tmp_activityid = $oUser->generateNewKey(70);

                    if($tmp_postid=='btn_show_fullscrn_overlay'){

                        $tmp_isvisible = 1;
                        $tmp_activitydescription = 'The full screen overlay profile for the OBS client ('.$tmp_obsclient_name.') has been made visible. It is loaded with the profile: '.$tmp_profile_name.'.';

                    }else{
                        $tmp_isvisible = 0;
                        $tmp_activitydescription = 'The full screen overlay profile for the OBS client ('.$tmp_obsclient_name.') has been hidden. It is loaded with the profile: '.$tmp_profile_name.'.';

                    }

                    self::$query = 'UPDATE `wthrbg_obs_clients`
                    SET
                    `ISVISIBLE_FULLSCRN` = "'.$tmp_isvisible.'",
                    `MODIFIER_ID` = "'.$tmp_userid.'",
                    `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    `MODIFIER_SESSION_ID` = "' . session_id() . '",
                    `DATEMODIFIED` = "' . $ts . '"
                    WHERE `OBSCLIENT_ID` = "'.$tmp_obs_client_id.'" 
                    LIMIT 1;
                    ';

                    self::$query .= 'INSERT INTO `wthrbg_log_sys_user`
                    (`ACTIVITY_ID`,
                    `MODIFIER_ID`,
                    `MODIFIER_ID_CRC32`,
                    `OBSCLIENT_ID`,
                    `OBSCLIENT_ID_CRC32`,
                    `ACTIVITY_DESCRIPTION`,
                    `ACTIVITY_DESCRIPTION_BLOB`,
                    `PHPSESSION`,
                    `IPADDRESS_V6`,
                    `IPADDRESS`,
                    `HTTP_USER_AGENT`,
                    `CHANNEL`)
                    VALUES
                    ("'.$tmp_activityid.'",
                    "'.$tmp_userid.'",
                    "'.crc32($tmp_userid).'",
                    "'.$tmp_obs_client_id.'",
                    "'.crc32($tmp_obs_client_id).'",
                    "'.self::$mysqli->real_escape_string($oUser->searchTruncStr($tmp_activitydescription, 1000)).'",
                    "'.self::$mysqli->real_escape_string($tmp_activitydescription).'",
                    "' . session_id() . '",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "'.$_SERVER['HTTP_USER_AGENT'].'",
                    "'.strtoupper($oEnv->oSESSION_MGR->getSessionParam("DEVICETYPE")).'");
                    ';

                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else{

                        //
                        // XML SYNC
                        $this->syncXML('full', $queryType, $oUser, $oEnv);

                        return $tmp_postid.'=success';
                    }

                    break;
                case 'obs_client_mini_overlay_visibility':

                    $tmp_userid = $oEnv->oSESSION_MGR->getSessionParam('USERID');
                    $tmp_obs_client_id = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('OBSCLIENT_ID'));
                    $tmp_postid = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('POSTID'));

                    $ID_ARRAY[0] = $tmp_obs_client_id;
                    $IDTYPE_ARRAY[0] = "OBS_CLIENT";

                    $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                    $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                    $tmp_obsclient_name = self::$mysqli->real_escape_string($dataAugmenter->getData('OBS_CLIENT',0,'OBS_ID_DISPLAY'));

                    $tmp_obsclient_name = self::$mysqli->real_escape_string($dataAugmenter->getData('OBS_CLIENT',0,'OBS_ID_DISPLAY'));

                    $ID_ARRAY[0] = self::$mysqli->real_escape_string($dataAugmenter->getData('OBS_CLIENT',0,'MINI_PROFILE_ID'));
                    $IDTYPE_ARRAY[0] = "MINI_PROFILE";
                    $tmp_data_aug_resp_serial_key = 'DATA_AUG_02';
                    $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                    $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('MINI_PROFILE',0,'PROFILE_NAME'));

                    $tmp_activityid = $oUser->generateNewKey(70);

                    if($tmp_postid=='btn_show_mini_overlay'){

                        $tmp_isvisible = 1;
                        $tmp_activitydescription = 'The mini overlay profile for the OBS client ('.$tmp_obsclient_name.') has been made visible. It is loaded with the profile: '.$tmp_profile_name.'.';

                    }else{
                        $tmp_isvisible = 0;
                        $tmp_activitydescription = 'The mini overlay profile for the OBS client ('.$tmp_obsclient_name.') has been hidden. It is loaded with the profile: '.$tmp_profile_name.'.';

                    }

                    self::$query = 'UPDATE `wthrbg_obs_clients`
                    SET
                    `ISVISIBLE_MINI` = "'.$tmp_isvisible.'",
                    `MODIFIER_ID` = "'.$tmp_userid.'",
                    `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    `MODIFIER_SESSION_ID` = "' . session_id() . '",
                    `DATEMODIFIED` = "' . $ts . '"
                    WHERE `OBSCLIENT_ID` = "'.$tmp_obs_client_id.'" 
                    LIMIT 1;
                    ';

                    self::$query .= 'INSERT INTO `wthrbg_log_sys_user`
                    (`ACTIVITY_ID`,
                    `MODIFIER_ID`,
                    `MODIFIER_ID_CRC32`,
                    `OBSCLIENT_ID`,
                    `OBSCLIENT_ID_CRC32`,
                    `ACTIVITY_DESCRIPTION`,
                    `ACTIVITY_DESCRIPTION_BLOB`,
                    `PHPSESSION`,
                    `IPADDRESS_V6`,
                    `IPADDRESS`,
                    `HTTP_USER_AGENT`,
                    `CHANNEL`)
                    VALUES
                    ("'.$tmp_activityid.'",
                    "'.$tmp_userid.'",
                    "'.crc32($tmp_userid).'",
                    "'.$tmp_obs_client_id.'",
                    "'.crc32($tmp_obs_client_id).'",
                    "'.self::$mysqli->real_escape_string($oUser->searchTruncStr($tmp_activitydescription, 1000)).'",
                    "'.self::$mysqli->real_escape_string($tmp_activitydescription).'",
                    "' . session_id() . '",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "'.$_SERVER['HTTP_USER_AGENT'].'",
                    "'.strtoupper($oEnv->oSESSION_MGR->getSessionParam("DEVICETYPE")).'");
                    ';

                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else{

                        return $tmp_postid.'=success';
                    }
                    break;
                case 'obs_client_profile_update_fullscrn':

                    $tmp_userid = $oEnv->oSESSION_MGR->getSessionParam('USERID');
                    $tmp_obs_client_id = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('OBSCLIENT_ID'));
                    $tmp_profile_id = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID'));

                    $ID_ARRAY[0] = $tmp_obs_client_id;
                    $IDTYPE_ARRAY[0] = "OBS_CLIENT";

                    $ID_ARRAY[1] = $tmp_profile_id;
                    $IDTYPE_ARRAY[1] = "FULLSCRN_PROFILE";

                    $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                    //error_log('8243 - dataAugmentation-> OBS_CLIENT['.$tmp_obs_client_id.'] FULLSCRN_PROFILE['.$tmp_profile_id.']');
                    $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                    $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_NAME'));
                    $tmp_obsclient_name = self::$mysqli->real_escape_string($dataAugmenter->getData('OBS_CLIENT',0,'OBS_ID_DISPLAY'));

                    $tmp_activityid = $oUser->generateNewKey(70);
                    $tmp_activitydescription = 'A full screen overlay profile ('.$tmp_profile_name.') has been applied to the OBS client, '.$tmp_obsclient_name.'.';

                    self::$query = 'UPDATE `wthrbg_obs_clients`
                    SET
                    `FULLSCRN_PROFILE_ID` = "'.$tmp_profile_id.'",
                    `MODIFIER_ID` = "'.$tmp_userid.'",
                    `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    `MODIFIER_SESSION_ID` = "' . session_id() . '",
                    `DATEMODIFIED` = "' . $ts . '"
                    WHERE `OBSCLIENT_ID` = "'.$tmp_obs_client_id.'" 
                    LIMIT 1;
                    ';

                    //error_log('8262 - Full screen profile update SQL->'.self::$query);

                    self::$query .= 'INSERT INTO `wthrbg_log_sys_user`
                    (`ACTIVITY_ID`,
                    `MODIFIER_ID`,
                    `MODIFIER_ID_CRC32`,
                    `FULL_SCRN_PROFILE_ID`,
                    `FULL_SCRN_PROFILE_ID_CRC32`,
                    `ACTIVITY_DESCRIPTION`,
                    `ACTIVITY_DESCRIPTION_BLOB`,
                    `PHPSESSION`,
                    `IPADDRESS_V6`,
                    `IPADDRESS`,
                    `HTTP_USER_AGENT`,
                    `CHANNEL`)
                    VALUES
                    ("'.$tmp_activityid.'",
                    "'.$tmp_userid.'",
                    "'.crc32($tmp_userid).'",
                    "'.$tmp_profile_id.'",
                    "'.crc32($tmp_profile_id).'",
                    "'.self::$mysqli->real_escape_string($oUser->searchTruncStr($tmp_activitydescription, 1000)).'",
                    "'.self::$mysqli->real_escape_string($tmp_activitydescription).'",
                    "' . session_id() . '",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "'.$_SERVER['HTTP_USER_AGENT'].'",
					"'.strtoupper($oEnv->oSESSION_MGR->getSessionParam("DEVICETYPE")).'");
                    ';

                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else{

                        return 'obs_client_profile_update_fullscrn=success';
                    }

                    break;
                case 'obs_client_profile_update_mini':

                    $tmp_userid = $oEnv->oSESSION_MGR->getSessionParam('USERID');
                    $tmp_obs_client_id = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('OBSCLIENT_ID'));
                    $tmp_profile_id = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID'));

                    $ID_ARRAY[0] = $tmp_obs_client_id;
                    $IDTYPE_ARRAY[0] = "OBS_CLIENT";

                    $ID_ARRAY[1] = $tmp_profile_id;
                    $IDTYPE_ARRAY[1] = "MINI_PROFILE";

                    $tmp_data_aug_resp_serial_key = 'DATA_AUG_01';
                    $dataAugmenter = new dataAugmentation(self::$mysqli,$oEnv,$ID_ARRAY,$IDTYPE_ARRAY,$oDB_RESP,$tmp_data_aug_resp_serial_key);

                    $tmp_profile_name = self::$mysqli->real_escape_string($dataAugmenter->getData('MINI_PROFILE',0,'PROFILE_NAME'));
                    $tmp_obsclient_name = self::$mysqli->real_escape_string($dataAugmenter->getData('OBS_CLIENT',0,'OBS_ID_DISPLAY'));

                    $tmp_activityid = $oUser->generateNewKey(70);
                    $tmp_activitydescription = 'A mini overlay profile ('.$tmp_profile_name.') has been applied to the OBS client, '.$tmp_obsclient_name.'.';

                    self::$query = 'UPDATE `wthrbg_obs_clients`
                    SET
                    `MINI_PROFILE_ID` = "'.$tmp_profile_id.'",
                    `MODIFIER_ID` = "'.$tmp_userid.'",
                    `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    `MODIFIER_SESSION_ID` = "' . session_id() . '",
                    `DATEMODIFIED` = "' . $ts . '"
                    WHERE `OBSCLIENT_ID` = "'.$tmp_obs_client_id.'" 
                    LIMIT 1;
                    ';

                    self::$query .= 'INSERT INTO `wthrbg_log_sys_user`
                    (`ACTIVITY_ID`,
                    `MODIFIER_ID`,
                    `MODIFIER_ID_CRC32`,
                    `MINI_PROFILE_ID`,
                    `MINI_PROFILE_ID_CRC32`,
                    `ACTIVITY_DESCRIPTION`,
                    `ACTIVITY_DESCRIPTION_BLOB`,
                    `PHPSESSION`,
                    `IPADDRESS_V6`,
                    `IPADDRESS`,
                    `HTTP_USER_AGENT`,
                    `CHANNEL`)
                    VALUES
                    ("'.$tmp_activityid.'",
                    "'.$tmp_userid.'",
                    "'.crc32($tmp_userid).'",
                    "'.$tmp_profile_id.'",
                    "'.crc32($tmp_profile_id).'",
                    "'.self::$mysqli->real_escape_string($oUser->searchTruncStr($tmp_activitydescription, 1000)).'",
                    "'.self::$mysqli->real_escape_string($tmp_activitydescription).'",
                    "' . session_id() . '",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "'.$_SERVER['HTTP_USER_AGENT'].'",
					"'.strtoupper($oEnv->oSESSION_MGR->getSessionParam("DEVICETYPE")).'");
                    ';

                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else{

                        return 'obs_client_profile_update_mini=success';
                    }

                    break;
                case 'create_fullscrn_overlay':

                    $tmp_userid = $oEnv->oSESSION_MGR->getSessionParam('USERID');

                    $tmp_activityid = $oUser->generateNewKey(70);
                    $tmp_profileid = $oUser->generateNewKey(70);
                    $tmp_configid = $oUser->generateNewKey(70);
                    $oUser->collectNewElementID('FULLSCRN_PROFILE_ID', $tmp_profileid);

                    $tmp_activitydescription = 'A new fullscreen overlay profile ('.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_NAME')).') has been created.';

                    self::$query = 'INSERT INTO `wthrbg_overlay_fullscrn_profile`
                    (`PROFILE_ID`,
                    `PROFILE_ID_CRC32`,
                    `PROFILE_NAME`,
                    `PROFILE_NAME_BLOB`,
                    `OPACITY`,
                    `BGCOLOR_HEX`,
                    `CREATOR_ID`,
                    `CREATOR_IP_V6`,
                    `CREATOR_IP`,
                    `CREATOR_SESSION_ID`,
                    `MODIFIER_ID`,
                    `MODIFIER_IP_V6`,
                    `MODIFIER_IP`,
                    `MODIFIER_SESSION_ID`,
                    `DATEMODIFIED`)
                    VALUES
                    ("'.$tmp_profileid.'",
                    "'.crc32($tmp_profileid).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_NAME')).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_NAME')).'",
                     "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('OPACITY')).'",
                     "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('BGCOLOR_HEX')).'",
                    "'.$tmp_userid.'",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "' . session_id() . '",
                    "'.$tmp_userid.'",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "' . session_id() . '",
                    "'.$ts.'");
                    ';

                    // wthrbg_overlay_fullscrn_config
                    self::$query .= 'INSERT INTO `wthrbg_overlay_fullscrn_config`
                    (`CONFIG_ID`,
                    `PROFILE_ID`,
                    `PROFILE_ID_CRC32`,
                    `CREATOR_ID`,
                    `CREATOR_IP_V6`,
                    `CREATOR_IP`,
                    `CREATOR_SESSION_ID`,
                    `MODIFIER_ID`,
                    `MODIFIER_IP_V6`,
                    `MODIFIER_IP`,
                    `MODIFIER_SESSION_ID`,
                    `DATEMODIFIED`)
                    VALUES
                    ("'.$tmp_configid.'",
                    "'.$tmp_profileid.'",
                    "'.crc32($tmp_profileid).'",
                    "'.$tmp_userid.'",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "' . session_id() . '",
                    "'.$tmp_userid.'",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "' . session_id() . '",
                    "'.$ts.'");
                    ';

                    self::$query .= 'INSERT INTO `wthrbg_log_sys_user`
                    (`ACTIVITY_ID`,
                    `MODIFIER_ID`,
                    `MODIFIER_ID_CRC32`,
                    `FULL_SCRN_PROFILE_ID`,
                    `FULL_SCRN_PROFILE_ID_CRC32`,
                    `ACTIVITY_DESCRIPTION`,
                    `ACTIVITY_DESCRIPTION_BLOB`,
                    `PHPSESSION`,
                    `IPADDRESS_V6`,
                    `IPADDRESS`,
                    `HTTP_USER_AGENT`,
                    `CHANNEL`)
                    VALUES
                    ("'.$tmp_activityid.'",
                    "'.$tmp_userid.'",
                    "'.crc32($tmp_userid).'",
                    "'.$tmp_profileid.'",
                    "'.crc32($tmp_profileid).'",
                    "'.self::$mysqli->real_escape_string($oUser->searchTruncStr($tmp_activitydescription, 1000)).'",
                    "'.self::$mysqli->real_escape_string($tmp_activitydescription).'",
                    "' . session_id() . '",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "'.$_SERVER['HTTP_USER_AGENT'].'",
					"'.strtoupper($oEnv->oSESSION_MGR->getSessionParam("DEVICETYPE")).'");
                    ';

                    //
                    // PROCESS QUERY
                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
                    }

                    return 'create_fullscrn_overlay=success';


                    break;
                case 'obs_client_return_current_status':

                    //
                    // DO WE HAVE THIS OBS_ID?
                    $force_profile_select_align = true;
                    $db_resp_process_serial = "!jesus_is_my_dear_lord!";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();         //$oUser->return_serial_handle();
                    $db_resp_target_profiles = 'OBS_CLIENT|FULL_SCRN_PROFILE|MINI_PROFILE|LANG_PACKS';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '24|14|21|12';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION ::
                    $tmp_SELECT_ARRAY = array();
                    $tmp_SELECT_ARRAY[0] = 'SELECT `wthrbg_obs_clients`.`OBSCLIENT_ID`,
                        `wthrbg_obs_clients`.`OBS_ID`,
                        `wthrbg_obs_clients`.`ISACTIVE`,
                        `wthrbg_obs_clients`.`FULLSCRN_PROFILE_ID`,
                        `wthrbg_obs_clients`.`MINI_PROFILE_ID`,
                        `wthrbg_obs_clients`.`OBS_ID_DISPLAY`,
                        `wthrbg_obs_clients`.`XML_INDEX_DIR_FILE_PATH`,
                        `wthrbg_obs_clients`.`ISVISIBLE_FULLSCRN`,
                        `wthrbg_obs_clients`.`ISVISIBLE_MINI`,
                        `wthrbg_obs_clients`.`MINI_DISPLAY_MODE`,
                        `wthrbg_obs_clients`.`CURRENT_WALL_TIME`,
                        `wthrbg_obs_clients`.`CURRENT_LANG_PACK_FULLSCRN`,
                        `wthrbg_obs_clients`.`CURRENT_LANG_PACK_MINI`,
                        `wthrbg_obs_clients`.`LAST_CONTACT`,
                        `wthrbg_obs_clients`.`FULLSCRN_VIEW_STATE`,
                        `wthrbg_obs_clients`.`MINI_VIEW_STATE`,
                        `wthrbg_obs_clients`.`CREATOR_ID`,
                        `wthrbg_obs_clients`.`CREATOR_IP`,
                        `wthrbg_obs_clients`.`CREATOR_SESSION_ID`,
                        `wthrbg_obs_clients`.`MODIFIER_ID`,
                        `wthrbg_obs_clients`.`MODIFIER_IP`,
                        `wthrbg_obs_clients`.`MODIFIER_SESSION_ID`,
                        `wthrbg_obs_clients`.`DATEMODIFIED`,
                        `wthrbg_obs_clients`.`DATECREATED`
                    FROM `wthrbg_obs_clients` WHERE `wthrbg_obs_clients`.`OBS_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('OBS_ID')).'" 
                                               AND `wthrbg_obs_clients`.`OBS_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data('OBS_ID')).'" 
                                                LIMIT 1;';

                    $tmp_SELECT_ARRAY[1] = 'SELECT `wthrbg_overlay_fullscrn_profile`.`PROFILE_ID`,
                        `wthrbg_overlay_fullscrn_profile`.`ISACTIVE`,
                        `wthrbg_overlay_fullscrn_profile`.`PROFILE_NAME`,
                        `wthrbg_overlay_fullscrn_profile`.`PROFILE_NAME_BLOB`,
                        `wthrbg_overlay_fullscrn_profile`.`OPACITY`,
                        `wthrbg_overlay_fullscrn_profile`.`BGCOLOR_HEX`,
                        `wthrbg_overlay_fullscrn_profile`.`CREATOR_ID`,
                        `wthrbg_overlay_fullscrn_profile`.`CREATOR_IP`,
                        `wthrbg_overlay_fullscrn_profile`.`CREATOR_SESSION_ID`,
                        `wthrbg_overlay_fullscrn_profile`.`MODIFIER_ID`,
                        `wthrbg_overlay_fullscrn_profile`.`MODIFIER_IP`,
                        `wthrbg_overlay_fullscrn_profile`.`MODIFIER_SESSION_ID`,
                        `wthrbg_overlay_fullscrn_profile`.`DATEMODIFIED`,
                        `wthrbg_overlay_fullscrn_profile`.`DATECREATED` 
                        FROM `wthrbg_overlay_fullscrn_profile` WHERE `wthrbg_overlay_fullscrn_profile`.`ISACTIVE`="1" 
                        ORDER BY `wthrbg_overlay_fullscrn_profile`.`DATECREATED` DESC;
                                        ';

                    $tmp_SELECT_ARRAY[2] = 'SELECT `wthrbg_overlay_mini_profile`.`PROFILE_ID`,
                        `wthrbg_overlay_mini_profile`.`ISACTIVE`,
                        `wthrbg_overlay_mini_profile`.`PROFILE_NAME`,
                        `wthrbg_overlay_mini_profile`.`PROFILE_NAME_BLOB`,
                        `wthrbg_overlay_mini_profile`.`OPACITY`,
                        `wthrbg_overlay_mini_profile`.`BGCOLOR_HEX`,
                        `wthrbg_overlay_mini_profile`.`OVERLAY_HEIGHT`,
                        `wthrbg_overlay_mini_profile`.`OVERLAY_WIDTH`,
                        `wthrbg_overlay_mini_profile`.`INNER_CONTENT_WIDTH`,
                        `wthrbg_overlay_mini_profile`.`MARGIN_LEFT`,
                        `wthrbg_overlay_mini_profile`.`MARGIN_RIGHT`,
                        `wthrbg_overlay_mini_profile`.`ABS_PX_FROM_TOP`,
                        `wthrbg_overlay_mini_profile`.`ABS_PX_FROM_LEFT`,
                        `wthrbg_overlay_mini_profile`.`CREATOR_ID`,
                        `wthrbg_overlay_mini_profile`.`CREATOR_IP`,
                        `wthrbg_overlay_mini_profile`.`CREATOR_SESSION_ID`,
                        `wthrbg_overlay_mini_profile`.`MODIFIER_ID`,
                        `wthrbg_overlay_mini_profile`.`MODIFIER_IP`,
                        `wthrbg_overlay_mini_profile`.`MODIFIER_SESSION_ID`,
                        `wthrbg_overlay_mini_profile`.`DATEMODIFIED`,
                        `wthrbg_overlay_mini_profile`.`DATECREATED`
                    FROM `wthrbg_overlay_mini_profile` WHERE `wthrbg_overlay_mini_profile`.`ISACTIVE`="1" 
                    ORDER BY `wthrbg_overlay_mini_profile`.`DATECREATED` DESC;
                                        ';

                    $tmp_SELECT_ARRAY[3] = 'SELECT `wthrbg_lang_packs`.`LANGPACK_ID`,
                        `wthrbg_lang_packs`.`LANG_ID`,
                        `wthrbg_lang_packs`.`NAME`,
                        `wthrbg_lang_packs`.`NATIVE_NAME`,
                        `wthrbg_lang_packs`.`NATIVE_NAME_BLOB`,
                        `wthrbg_lang_packs`.`ISACTIVE`,
                        `wthrbg_lang_packs`.`RTL_FLAG`,
                        `wthrbg_lang_packs`.`FONT_SIZE_PERCENTAGE`,
                        `wthrbg_lang_packs`.`TIMER_FONT_SIZE_PERCENTAGE`,
                        `wthrbg_lang_packs`.`COPY_PADDING_TOP_PX`,
                        `wthrbg_lang_packs`.`DATEMODIFIED`,
                        `wthrbg_lang_packs`.`DATECREATED`
                    FROM `wthrbg_lang_packs` WHERE `wthrbg_lang_packs`.`ISACTIVE`="1";
                    ';

                    $oDB_RESP->process(self::$mysqli,$queryType, $tmp_SELECT_ARRAY);

                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'FULL_SCRN_PROFILE', 'PROFILE_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'MINI_PROFILE', 'PROFILE_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'LANG_PACKS', 'LANG_ID');

                    return $oDB_RESP;


                    break;
                case 'get_obs_client_profile_data':

                    //
                    // DO WE HAVE THIS OBS_ID?
                    $force_profile_select_align = true;
                    $db_resp_process_serial = "!jesus_is_my_dear_lord!";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();         //$oUser->return_serial_handle();
                    $db_resp_target_profiles = 'OBS_CLIENT|FULL_SCRN_PROFILE|MINI_PROFILE|LANG_PACKS|DE_COLORES';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '24|14|21|12|14';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION ::
                    $tmp_SELECT_ARRAY = array();
                    $tmp_SELECT_ARRAY[0] = 'SELECT `wthrbg_obs_clients`.`OBSCLIENT_ID`,
                        `wthrbg_obs_clients`.`OBS_ID`,
                        `wthrbg_obs_clients`.`ISACTIVE`,
                        `wthrbg_obs_clients`.`FULLSCRN_PROFILE_ID`,
                        `wthrbg_obs_clients`.`MINI_PROFILE_ID`,
                        `wthrbg_obs_clients`.`OBS_ID_DISPLAY`,
                        `wthrbg_obs_clients`.`XML_INDEX_DIR_FILE_PATH`,
                        `wthrbg_obs_clients`.`ISVISIBLE_FULLSCRN`,
                        `wthrbg_obs_clients`.`ISVISIBLE_MINI`,
                        `wthrbg_obs_clients`.`MINI_DISPLAY_MODE`,
                        `wthrbg_obs_clients`.`CURRENT_WALL_TIME`,
                        `wthrbg_obs_clients`.`CURRENT_LANG_PACK_FULLSCRN`,
                        `wthrbg_obs_clients`.`CURRENT_LANG_PACK_MINI`,
                        `wthrbg_obs_clients`.`LAST_CONTACT`,
                        `wthrbg_obs_clients`.`FULLSCRN_VIEW_STATE`,
                        `wthrbg_obs_clients`.`MINI_VIEW_STATE`,
                        `wthrbg_obs_clients`.`CREATOR_ID`,
                        `wthrbg_obs_clients`.`CREATOR_IP`,
                        `wthrbg_obs_clients`.`CREATOR_SESSION_ID`,
                        `wthrbg_obs_clients`.`MODIFIER_ID`,
                        `wthrbg_obs_clients`.`MODIFIER_IP`,
                        `wthrbg_obs_clients`.`MODIFIER_SESSION_ID`,
                        `wthrbg_obs_clients`.`DATEMODIFIED`,
                        `wthrbg_obs_clients`.`DATECREATED`
                    FROM `wthrbg_obs_clients` WHERE `wthrbg_obs_clients`.`OBSCLIENT_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('OBSCLIENT_ID')).'" 
                                               AND `wthrbg_obs_clients`.`ISACTIVE`="1" LIMIT 1;';

                    $tmp_SELECT_ARRAY[1] = 'SELECT `wthrbg_overlay_fullscrn_profile`.`PROFILE_ID`,
                        `wthrbg_overlay_fullscrn_profile`.`ISACTIVE`,
                        `wthrbg_overlay_fullscrn_profile`.`PROFILE_NAME`,
                        `wthrbg_overlay_fullscrn_profile`.`PROFILE_NAME_BLOB`,
                        `wthrbg_overlay_fullscrn_profile`.`OPACITY`,
                        `wthrbg_overlay_fullscrn_profile`.`BGCOLOR_HEX`,
                        `wthrbg_overlay_fullscrn_profile`.`CREATOR_ID`,
                        `wthrbg_overlay_fullscrn_profile`.`CREATOR_IP`,
                        `wthrbg_overlay_fullscrn_profile`.`CREATOR_SESSION_ID`,
                        `wthrbg_overlay_fullscrn_profile`.`MODIFIER_ID`,
                        `wthrbg_overlay_fullscrn_profile`.`MODIFIER_IP`,
                        `wthrbg_overlay_fullscrn_profile`.`MODIFIER_SESSION_ID`,
                        `wthrbg_overlay_fullscrn_profile`.`DATEMODIFIED`,
                        `wthrbg_overlay_fullscrn_profile`.`DATECREATED` 
                        FROM `wthrbg_overlay_fullscrn_profile` WHERE `wthrbg_overlay_fullscrn_profile`.`ISACTIVE`="1" 
                        ORDER BY `wthrbg_overlay_fullscrn_profile`.`DATECREATED` DESC;
                                        ';

                    $tmp_SELECT_ARRAY[2] = 'SELECT `wthrbg_overlay_mini_profile`.`PROFILE_ID`,
                        `wthrbg_overlay_mini_profile`.`ISACTIVE`,
                        `wthrbg_overlay_mini_profile`.`PROFILE_NAME`,
                        `wthrbg_overlay_mini_profile`.`PROFILE_NAME_BLOB`,
                        `wthrbg_overlay_mini_profile`.`OPACITY`,
                        `wthrbg_overlay_mini_profile`.`BGCOLOR_HEX`,
                        `wthrbg_overlay_mini_profile`.`OVERLAY_HEIGHT`,
                        `wthrbg_overlay_mini_profile`.`OVERLAY_WIDTH`,
                        `wthrbg_overlay_mini_profile`.`INNER_CONTENT_WIDTH`,
                        `wthrbg_overlay_mini_profile`.`MARGIN_LEFT`,
                        `wthrbg_overlay_mini_profile`.`MARGIN_RIGHT`,
                        `wthrbg_overlay_mini_profile`.`ABS_PX_FROM_TOP`,
                        `wthrbg_overlay_mini_profile`.`ABS_PX_FROM_LEFT`,
                        `wthrbg_overlay_mini_profile`.`CREATOR_ID`,
                        `wthrbg_overlay_mini_profile`.`CREATOR_IP`,
                        `wthrbg_overlay_mini_profile`.`CREATOR_SESSION_ID`,
                        `wthrbg_overlay_mini_profile`.`MODIFIER_ID`,
                        `wthrbg_overlay_mini_profile`.`MODIFIER_IP`,
                        `wthrbg_overlay_mini_profile`.`MODIFIER_SESSION_ID`,
                        `wthrbg_overlay_mini_profile`.`DATEMODIFIED`,
                        `wthrbg_overlay_mini_profile`.`DATECREATED`
                    FROM `wthrbg_overlay_mini_profile` WHERE `wthrbg_overlay_mini_profile`.`ISACTIVE`="1" 
                    ORDER BY `wthrbg_overlay_mini_profile`.`DATECREATED` DESC;
                                        ';

                    $tmp_SELECT_ARRAY[3] = 'SELECT `wthrbg_lang_packs`.`LANGPACK_ID`,
                        `wthrbg_lang_packs`.`LANG_ID`,
                        `wthrbg_lang_packs`.`NAME`,
                        `wthrbg_lang_packs`.`NATIVE_NAME`,
                        `wthrbg_lang_packs`.`NATIVE_NAME_BLOB`,
                        `wthrbg_lang_packs`.`ISACTIVE`,
                        `wthrbg_lang_packs`.`RTL_FLAG`,
                        `wthrbg_lang_packs`.`FONT_SIZE_PERCENTAGE`,
                        `wthrbg_lang_packs`.`TIMER_FONT_SIZE_PERCENTAGE`,
                        `wthrbg_lang_packs`.`COPY_PADDING_TOP_PX`,
                        `wthrbg_lang_packs`.`DATEMODIFIED`,
                        `wthrbg_lang_packs`.`DATECREATED`
                    FROM `wthrbg_lang_packs` WHERE `wthrbg_lang_packs`.`ISACTIVE`="1";
                    ';

                    $tmp_SELECT_ARRAY[4] = 'SELECT `wthrbg_colors_hex`.`COLOR_ID`,
                        `wthrbg_colors_hex`.`COLOR_APPLICATION_KEY`,
                        `wthrbg_colors_hex`.`COLOR_HEX`,
                        `wthrbg_colors_hex`.`ISACTIVE`,
                        `wthrbg_colors_hex`.`COLOR_NAME`,
                        `wthrbg_colors_hex`.`COLOR_NAME_BLOB`,
                        `wthrbg_colors_hex`.`CREATOR_ID`,
                        `wthrbg_colors_hex`.`CREATOR_IP`,
                        `wthrbg_colors_hex`.`CREATOR_SESSION_ID`,
                        `wthrbg_colors_hex`.`MODIFIER_ID`,
                        `wthrbg_colors_hex`.`MODIFIER_IP`,
                        `wthrbg_colors_hex`.`MODIFIER_SESSION_ID`,
                        `wthrbg_colors_hex`.`DATEMODIFIED`,
                        `wthrbg_colors_hex`.`DATECREATED`
                    FROM `wthrbg_colors_hex`
                    WHERE `wthrbg_colors_hex`.`ISACTIVE`="1" 
                    ORDER BY `wthrbg_colors_hex`.`COLOR_NAME`;
                    ';

                    $oDB_RESP->process(self::$mysqli,$queryType, $tmp_SELECT_ARRAY);

                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'FULL_SCRN_PROFILE', 'PROFILE_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'MINI_PROFILE', 'PROFILE_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'LANG_PACKS', 'LANG_ID');

                    return $oDB_RESP;
                    break;
                case 'get_obs_client_data':

                    //
                    // DO WE HAVE THIS OBS_ID?
                    $force_profile_select_align = true;
                    $db_resp_process_serial = "!jesus_is_my_dear_lord!!!!";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();         //$oUser->return_serial_handle();
                    $db_resp_target_profiles = 'OBS_CLIENT';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '20';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION ::
                    $tmp_SELECT_ARRAY = array();
                    $tmp_SELECT_ARRAY[0] = 'SELECT `wthrbg_obs_clients`.`OBSCLIENT_ID`,
                        `wthrbg_obs_clients`.`OBS_ID`,
                        `wthrbg_obs_clients`.`ISACTIVE`,
                        `wthrbg_obs_clients`.`FULLSCRN_PROFILE_ID`,
                        `wthrbg_obs_clients`.`MINI_PROFILE_ID`,
                        `wthrbg_obs_clients`.`OBS_ID_DISPLAY`,
                        `wthrbg_obs_clients`.`XML_INDEX_DIR_FILE_PATH`,
                        `wthrbg_obs_clients`.`CURRENT_WALL_TIME`,
                        `wthrbg_obs_clients`.`CURRENT_LANG_PACK_FULLSCRN`,
                        `wthrbg_obs_clients`.`CURRENT_LANG_PACK_MINI`,
                        `wthrbg_obs_clients`.`FULLSCRN_VIEW_STATE`,
                        `wthrbg_obs_clients`.`MINI_VIEW_STATE`,
                        `wthrbg_obs_clients`.`CREATOR_ID`,
                        `wthrbg_obs_clients`.`CREATOR_IP`,
                        `wthrbg_obs_clients`.`CREATOR_SESSION_ID`,
                        `wthrbg_obs_clients`.`MODIFIER_ID`,
                        `wthrbg_obs_clients`.`MODIFIER_IP`,
                        `wthrbg_obs_clients`.`MODIFIER_SESSION_ID`,
                        `wthrbg_obs_clients`.`DATEMODIFIED`,
                        `wthrbg_obs_clients`.`DATECREATED`
                    FROM `wthrbg_obs_clients` WHERE `wthrbg_obs_clients`.`ISACTIVE`="1";';

                    $oDB_RESP->process(self::$mysqli,$queryType, $tmp_SELECT_ARRAY);

                    return $oDB_RESP;

                    break;
                case 'sync_server_return_index_dir_path':

                    /*
                    self::$http_param_handle["OBS_ID"] = self::$oEnv->oHTTP_MGR->extractData($_GET, 'obs_id');
                    self::$http_param_handle["CURRENT_WALL_TIME"] = self::$oEnv->oHTTP_MGR->extractData($_GET, 't');
                    self::$http_param_handle["XML_REQUESTED"] = self::$oEnv->oHTTP_MGR->extractData($_GET, 'xml');
                    self::$http_param_handle["MINI_VIEW_STATE"] = md5(self::$oEnv->oHTTP_MGR->extractData($_GET, 'mini_vs'));
                    self::$http_param_handle["FULLSCRN_VIEW_STATE"] = md5(self::$oEnv->oHTTP_MGR->extractData($_GET, 'fullscrn_vs'));
                    */

                    $tmp_obs_id = strtolower($oUser->retrieve_Form_Data('OBS_ID'));
                    $tmp_obs_id_DISPLAY = $oUser->retrieve_Form_Data('OBS_ID');
                    $tmp_curr_lang_pack_fullscrn = $oUser->retrieve_Form_Data('LANG_PACK_FULLSCRN');
                    $tmp_curr_lang_pack_mini = $oUser->retrieve_Form_Data('LANG_PACK_MINI');

                    if($tmp_obs_id!=''){

                        //
                        // WE HAVE AN OBS CLIENT. GET REMAINING DATA AND PROCESS.
                        $tmp_walltime = $oUser->retrieve_Form_Data('CURRENT_WALL_TIME');
                        $tmp_mini_viewstate = $oUser->retrieve_Form_Data('MINI_VIEW_STATE');
                        $tmp_fullscrn_viewstate = $oUser->retrieve_Form_Data('FULLSCRN_VIEW_STATE');

                        //
                        // DO WE HAVE THIS OBS_ID?
                        $force_profile_select_align = true;
                        $db_resp_process_serial = "!jesus_is_my_dear_lord!!!";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                        $db_resp_serial_key = $oUser->return_serial_handle();         //$oUser->return_serial_handle();
                        $db_resp_target_profiles = 'OBS_CLIENT';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                        $db_resp_profile_field_cnt = '16';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                        $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                        //
                        // QUERY CONSTRUCTION ::
                        $tmp_SELECT_ARRAY = array();
                        $tmp_SELECT_ARRAY[0] = 'SELECT `wthrbg_obs_clients`.`OBSCLIENT_ID`,
                            `wthrbg_obs_clients`.`OBS_ID`,
                            `wthrbg_obs_clients`.`FULLSCRN_PROFILE_ID`,
                            `wthrbg_obs_clients`.`MINI_PROFILE_ID`,
                            `wthrbg_obs_clients`.`OBS_ID_DISPLAY`,
                            `wthrbg_obs_clients`.`CURRENT_LANG_PACK_FULLSCRN`,
                            `wthrbg_obs_clients`.`CURRENT_LANG_PACK_MINI`,
                            `wthrbg_obs_clients`.`XML_INDEX_DIR_FILE_PATH`,
                            `wthrbg_obs_clients`.`CREATOR_ID`,
                            `wthrbg_obs_clients`.`CREATOR_IP`,
                            `wthrbg_obs_clients`.`CREATOR_SESSION_ID`,
                            `wthrbg_obs_clients`.`MODIFIER_ID`,
                            `wthrbg_obs_clients`.`MODIFIER_IP`,
                            `wthrbg_obs_clients`.`MODIFIER_SESSION_ID`,
                            `wthrbg_obs_clients`.`DATEMODIFIED`,
                            `wthrbg_obs_clients`.`DATECREATED`
                        FROM `wthrbg_obs_clients` WHERE `wthrbg_obs_clients`.`ISACTIVE`="1" AND 
                        `wthrbg_obs_clients`.`OBS_ID`="'.self::$mysqli->real_escape_string(strtolower($tmp_obs_id)).'" AND `wthrbg_obs_clients`.`OBS_ID_CRC32`="'.crc32(strtolower($tmp_obs_id)).'" LIMIT 1;';

                        $oDB_RESP->process(self::$mysqli,$queryType, $tmp_SELECT_ARRAY);

                        //
                        // VERIFY OBS ID
                        $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial(), 'OBS_CLIENT');

                        if($tmp_loop_size<1){

                            $tmp_obsclientid = $oUser->generateNewKey(70);
                            $tmp_obsstateid = $oUser->generateNewKey(70);
                            $tmp_config_id = $oUser->generateNewKey(70);

                            if(strlen($oEnv->oSESSION_MGR->getSessionParam('USERID'))==50){

                                $tmp_userid = $oEnv->oSESSION_MGR->getSessionParam('USERID');

                            }else{

                                $tmp_userid = 'HTTP_GET_PUSH_CREATED';

                            }

                            //
                            //  WE NEED THE DIR PATH TO XML INDEX FILE

                            # ESTABLISH PROFILE INDEX FILE NAME
                            # COPY TEMPLATE XML TO LOCATION...OR WRITE NEW?
                            # UPDATE DATABASE (INSERT)

                            /*
                            $tmp_filename_index = 'profile_index.xml';
                            $tmp_path_profile_index_xml = 'common/xml/';
                            $tmp_filename_DIR_PATH = $oUSER->getEnvParam('DOCUMENT_ROOT') . $oUSER->getEnvParam('DOCUMENT_ROOT_DIR') . '/' . $tmp_path_profile_index_xml . $tmp_filename_index;

                            $tmp_client_dir = substr(self::$oUser->retrieve_Form_Data("CLIENT_ID"), 0, -25);
                            $tmp_client_subdir = '/'.date('Y').'/'.date('m').'/'.date('d');
                            $tmp_serialize = self::$oUser->generateNewKey(50);

                            * */
                            $tmp_demo_filename_index = 'profile_index.xml';
                            $tmp_demo_path_profile_index_xml = 'common/xml/';
                            $tmp_DIR_PATH = $oUser->getEnvParam('DOCUMENT_ROOT') . $oUser->getEnvParam('DOCUMENT_ROOT_DIR');
                            $tmp_file_prefix = date('Y').'_'.date('m').'_'.date('d').'_';
                            $tmp_filename_base = $this->search_FillerSanitize($tmp_obs_id);
                            $tmp_serialize_post = '_'.$oUser->generateNewKey(10).'.xml';

                            $tmp_dir_deep = $oUser->returnOverlayDeepDir();
                            $xml_index_dir_path = $tmp_dir_deep.$tmp_file_prefix.$tmp_filename_base.$tmp_serialize_post;

                            if(!file_exists($tmp_DIR_PATH.$xml_index_dir_path)){
                                //
                                // COPY DEMO INDEX XML TO LOCATION AND NAME
                                if (!copy($tmp_DIR_PATH.'/'.$tmp_demo_path_profile_index_xml.$tmp_demo_filename_index, $tmp_DIR_PATH.$xml_index_dir_path)) {
                                    throw new Exception('Unable to copy demo xml to location['.$tmp_DIR_PATH.$xml_index_dir_path.'].');

                                }

                            }

                            //
                            // NEW OBS CLIENT
                            self::$query = 'INSERT INTO `wthrbg_obs_clients`
                            (`OBSCLIENT_ID`,
                            `OBSCLIENT_ID_CRC32`,
                            `OBS_ID`,
                            `OBS_ID_CRC32`,
                            `OBS_ID_DISPLAY`,
                            `XML_INDEX_DIR_FILE_PATH`,
                            `CREATOR_ID`,
                            `CREATOR_IP_V6`,
                            `CREATOR_IP`,
                            `CREATOR_SESSION_ID`,
                            `MODIFIER_ID`,
                            `MODIFIER_IP_V6`,
                            `MODIFIER_IP`,
                            `MODIFIER_SESSION_ID`,
                            `DATEMODIFIED`)
                            VALUES
                            ("'.$tmp_obsclientid.'",
                            "'.crc32($tmp_obsclientid).'",
                            "'.self::$mysqli->real_escape_string($tmp_obs_id).'",
                            "'.crc32($tmp_obs_id).'",
                            "'.self::$mysqli->real_escape_string($tmp_obs_id_DISPLAY).'",
                            "'.$xml_index_dir_path.'",
                            "'.$tmp_userid.'",
                            INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            "' . session_id() . '",
                            "'.$tmp_userid.'",
                            INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            "' . session_id() . '",
                            "'.$ts.'");
                            ';

                            self::$query .= 'INSERT INTO `wthrbg_overlay_state`
                            (`STATE_ID`,
                            `OBSCLIENT_ID`,
                            `OBSCLIENT_ID_CRC32`,
                            `OBS_ID`,
                            `OBS_ID_CRC32`,
                            `CREATOR_ID`,
                            `CREATOR_IP_V6`,
                            `CREATOR_IP`,
                            `CREATOR_SESSION_ID`,
                            `MODIFIER_ID`,
                            `MODIFIER_IP_V6`,
                            `MODIFIER_IP`,
                            `MODIFIER_SESSION_ID`,
                            `DATEMODIFIED`)
                            VALUES
                            ("'.$tmp_obsstateid.'",
                            "'.$tmp_obsclientid.'",
                            "'.crc32($tmp_obsclientid).'",
                            "'.self::$mysqli->real_escape_string($tmp_obs_id).'",
                            "'.crc32($tmp_obs_id).'",
                            "'.$tmp_userid.'",
                            INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            "' . session_id() . '",
                            "'.$tmp_userid.'",
                            INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            "' . session_id() . '",
                            "'.$ts.'");
                            ';


                            /*
                            // wthrbg_overlay_fullscrn_config
                            self::$query .= 'INSERT INTO `wthrbg_overlay_fullscrn_config`
                            (`CONFIG_ID`,
                            `PROFILE_ID`,
                            `PROFILE_ID_CRC32`,
                            `CREATOR_ID`,
                            `CREATOR_IP_V6`,
                            `CREATOR_IP`,
                            `CREATOR_SESSION_ID`,
                            `MODIFIER_ID`,
                            `MODIFIER_IP_V6`,
                            `MODIFIER_IP`,
                            `MODIFIER_SESSION_ID`,
                            `DATEMODIFIED`)
                            VALUES
                            ("'.$tmp_config_id.'",
                             "'.$oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'OBS_CLIENT', 'FULLSCRN_PROFILE_ID').'",
                             "'.crc32($oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'OBS_CLIENT', 'FULLSCRN_PROFILE_ID')).'",
                            "'.$tmp_userid.'",
                            INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            "' . session_id() . '",
                            "'.$tmp_userid.'",
                            INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            "' . session_id() . '",
                            "'.$ts.'");
                            ';

                            */

                            self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                            if(self::$mysqli->error){
                                self::$query_exception_result = "error";
                                throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                            }else{

                                //
                                // SUCCESS
                                return $xml_index_dir_path;

                            }

                        }else{

                            for ($OBSclient_cnt=0; $OBSclient_cnt < $tmp_loop_size; $OBSclient_cnt++) {

                                //
                                // WE HAVE OBS CLIENT - SYNC WITH CURRENT CLIENT STATE
                                /*
                                $tmp_walltime = $oUser->retrieve_Form_Data('CURRENT_WALL_TIME');
                                $tmp_mini_viewstate = $oUser->retrieve_Form_Data('MINI_VIEW_STATE');
                                $tmp_fullscrn_viewstate = $oUser->retrieve_Form_Data('FULLSCRN_VIEW_STATE');

                                $tmp_curr_lang_pack_fullscrn = $oUser->retrieve_Form_Data('LANG_PACK_FULLSCRN');
                    $tmp_curr_lang_pack_mini = $oUser->retrieve_Form_Data('LANG_PACK_MINI');
                                 * */

                                if(strlen($oEnv->oSESSION_MGR->getSessionParam('USERID'))==50){

                                    $tmp_userid = $oEnv->oSESSION_MGR->getSessionParam('USERID');

                                }else{

                                    $tmp_userid = $tmp_obs_id_DISPLAY;

                                }

                                self::$query = 'UPDATE `wthrbg_obs_clients`
                                    SET
                                    `CURRENT_WALL_TIME` = "'.self::$mysqli->real_escape_string($tmp_walltime).'",
                                    `CURRENT_LANG_PACK_FULLSCRN` =  "'.self::$mysqli->real_escape_string($tmp_curr_lang_pack_fullscrn).'",
                                    `CURRENT_LANG_PACK_MINI` =  "'.self::$mysqli->real_escape_string($tmp_curr_lang_pack_mini).'",
                                    `LAST_CONTACT` = "'.$ts.'",
                                    `FULLSCRN_VIEW_STATE` = "'.self::$mysqli->real_escape_string($tmp_fullscrn_viewstate).'",
                                    `MINI_VIEW_STATE` = "'.self::$mysqli->real_escape_string($tmp_mini_viewstate).'",
                                    `MODIFIER_ID` = "'.self::$mysqli->real_escape_string($tmp_userid).'",
                                    `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                    `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                    `MODIFIER_SESSION_ID` =  "' . session_id() . '",
                                    `DATEMODIFIED` = "'.$ts.'"
                                    WHERE `OBSCLIENT_ID` = "'.$oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'OBS_CLIENT', 'OBSCLIENT_ID').'" AND 
                                    `OBS_ID` = "'.$oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'OBS_CLIENT', 'OBS_ID').'" AND
                                    `OBS_ID_CRC32` = "'.crc32($oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'OBS_CLIENT', 'OBS_ID')).'"
                                    LIMIT 1;
                                    ';

                                self::$result = $oEnv->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);

                                if(self::$mysqli->error){
                                    self::$query_exception_result = "error";
                                    throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                                }

                                // OBJECT IS TO RETURN DIR PATH TO THE PROFILE INDEX XML
                                return $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'OBS_CLIENT', 'XML_INDEX_DIR_FILE_PATH', $OBSclient_cnt);

                            }

                        }

                    }else{

                        return 'demo';
                    }

                    break;
                case 'get_user_stream_data':

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

                            self::$query = 'UPDATE `wthrbg_sys_msg_queue` SET 
							`ISACTIVE`="0",
							`ERROR_INFO`="'.$oUser->msg_delivery_status.'",
							`DATEMODIFIED`="'.$ts.'" 
							WHERE `MSG_SOURCEID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('MSG_SOURCEID')).'" AND 
							`MSG_SOURCEID_CRC32`="'.crc32($oUser->retrieve_Form_Data('MSG_SOURCEID')).'"  AND 
							`MSG_KEYID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('MSG_KEYID')).'"  AND 
							`MSG_KEYID_CRC32`="'.crc32($oUser->retrieve_Form_Data('MSG_KEYID')).'"
							LIMIT 1;';


                            //error_log("evifweb database (874) msg stat update query->".self::$query);
                            self::$result = $oEnv->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);

                            if(self::$mysqli->error){
                                self::$query_exception_result = "error";
                                throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                            }else{

                                //
                                // SUCCESS
                                return "success";

                            }

                            break;
                        default:
                            //error_log("(864) record failure");
                            self::$query = 'UPDATE `wthrbg_sys_msg_queue` SET 
							`ISACTIVE`="6",
							`ERROR_INFO`="'.$oUser->msg_delivery_status.'",
							`DATEMODIFIED`="'.$ts.'" 
							WHERE `MSG_SOURCEID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('MSG_SOURCEID')).'" AND 
							`MSG_SOURCEID_CRC32`="'.crc32($oUser->retrieve_Form_Data('MSG_SOURCEID')).'"  AND 
							`MSG_KEYID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('MSG_KEYID')).'"  AND 
							`MSG_KEYID_CRC32`="'.crc32($oUser->retrieve_Form_Data('MSG_KEYID')).'"
							LIMIT 1;';

                            self::$result = $oEnv->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);

                            if(self::$mysqli->error){
                                self::$query_exception_result = "error";
                                throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                            }else{

                                //
                                // SUCCESS
                                return "error";

                            }
                            break;

                    }

                    break;
                case 'log_msg_assem_err':
                    //error_log("evifweb database (909) msg assembly error MSG_SOURCEID ->".$oUser->retrieve_Form_Data('MSG_SOURCEID'));
                    self::$query = 'UPDATE `wthrbg_sys_msg_queue` SET 
							`ISACTIVE`="6",
							`ERROR_INFO`="Message assembly error.",
							`DATEMODIFIED`="'.$ts.'" 
							WHERE `MSG_SOURCEID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('MSG_SOURCEID')).'" AND 
							`MSG_SOURCEID_CRC32`="'.crc32($oUser->retrieve_Form_Data('MSG_SOURCEID')).'"  AND 
							`MSG_KEYID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('MSG_KEYID')).'"  AND 
							`MSG_KEYID_CRC32`="'.crc32($oUser->retrieve_Form_Data('MSG_KEYID')).'"
							LIMIT 1;';

                    self::$result = $oEnv->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else{

                        //
                        // SUCCESS
                        return "error";

                    }

                    break;
                case 'get_sys_msgs':
                    //
                    // BUILD QUERY
                    //if($oUser->retrieve_Form_Data("MSG_KEYID")!=""){
                    if(3==2){
                        self::$query = 'SELECT `wthrbg_sys_messages`.`MSG_KEYID`,`wthrbg_sys_messages`.`ISACTIVE`,`wthrbg_sys_messages`.`LANGCODE`,`wthrbg_sys_messages`.`MSG_NAME`,`wthrbg_sys_messages`.`MSG_SUBJECT`,`wthrbg_sys_messages`.`MSG_HTML`,`wthrbg_sys_messages`.`MSG_TEXT`,`wthrbg_sys_messages`.`MSG_DESCRIPTION`,`wthrbg_sys_messages`.`DATEMODIFIED`,`wthrbg_sys_messages`.`DATECREATED` FROM `wthrbg_sys_messages` WHERE (`wthrbg_sys_messages`.`ISACTIVE`="1" OR `wthrbg_sys_messages`.`ISACTIVE`="3") AND `wthrbg_sys_messages`.`MSG_KEYID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('MSG_KEYID')).'" AND `wthrbg_sys_messages`.`MSG_KEYID_CRC32`="'.crc32($oUser->retrieve_Form_Data('MSG_KEYID')).'" LIMIT 1;';
                    }else{
                        self::$query = 'SELECT `wthrbg_sys_messages`.`MSG_KEYID`,`wthrbg_sys_messages`.`ISACTIVE`,`wthrbg_sys_messages`.`LANGCODE`,`wthrbg_sys_messages`.`MSG_NAME`,`wthrbg_sys_messages`.`MSG_SUBJECT`,`wthrbg_sys_messages`.`MSG_HTML`,`wthrbg_sys_messages`.`MSG_TEXT`,`wthrbg_sys_messages`.`MSG_DESCRIPTION`,`wthrbg_sys_messages`.`DATEMODIFIED`,`wthrbg_sys_messages`.`DATECREATED` FROM `wthrbg_sys_messages` WHERE `wthrbg_sys_messages`.`ISACTIVE`="1" OR `wthrbg_sys_messages`.`ISACTIVE`="3";';
                    }

                    //
                    // PROCESS QUERY
                    self::$result = $oEnv->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);

                    //
                    // CLEAR RESULT ARRAY
                    array_splice(self::$result_ARRAY, 0);

                    if(self::$mysqli->error){
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

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
                        // RETURN RESULT SET ARRAY
                        return self::$result_ARRAY;
                    }

                    break;
                case 'get_msg_queue':
                    /*

CREATE TABLE `wthrbg_sys_msg_queue` (
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
                    self::$query = 'SELECT `wthrbg_sys_msg_queue`.`MSG_SOURCEID`,`wthrbg_sys_msg_queue`.`MSG_KEYID`,`wthrbg_sys_msg_queue`.`ISACTIVE`,`wthrbg_sys_msg_queue`.`LANGCODE`,`wthrbg_sys_msg_queue`.`EMAIL`,`wthrbg_sys_msg_queue`.`RECIPIENTNAME`,`wthrbg_sys_msg_queue`.`USERID`,`wthrbg_sys_msg_queue`.`ACTIVATION_KEY`,`wthrbg_sys_msg_queue`.`CONTACTID`,`wthrbg_sys_msg_queue`.`REQUESTID`,`wthrbg_sys_msg_queue`.`PWD_RESET`,`wthrbg_sys_msg_queue`.`DATECREATED` FROM `wthrbg_sys_msg_queue` WHERE `wthrbg_sys_msg_queue`.`ISACTIVE`="1" OR `wthrbg_sys_msg_queue`.`ISACTIVE`="3";';

                    //
                    // PROCESS QUERY
                    //error_log("evifweb database (809) query->".self::$query);
                    self::$result = $oEnv->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        self::$query_exception_result = "error";
                        throw new Exception('AV overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

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
                        // RETURN RESULT SET ARRAY
                        return self::$result_MSGQUEUE_ARRAY;

                    }

                    break;
                case 'get_unsub_suppression':
                    self::$query = 'SELECT `wthrbg_email_unsub`.`EMAIL` FROM `wthrbg_email_unsub`;';

                    //
                    // PROCESS QUERY
                    //error_log("evifweb database (809) query->".self::$query);
                    self::$result = $oEnv->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
                    if(self::$mysqli->error){
                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

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
                        // RETURN RESULT SET ARRAY
                        return self::$result_UNSUB_ARRAY;

                    }

                    break;
                case 'accnt_activate_resend':
                    self::$query = 'SELECT `wthrbg_sys_msg_queue`.`MSG_SOURCEID`,
                        `wthrbg_sys_msg_queue`.`MSG_KEYID`,
                        `wthrbg_sys_msg_queue`.`ISACTIVE`,
                        `wthrbg_sys_msg_queue`.`LANGCODE`,
                        `wthrbg_sys_msg_queue`.`EMAIL`,
                        `wthrbg_sys_msg_queue`.`RECIPIENTNAME`,
                        `wthrbg_sys_msg_queue`.`USERID`,
                        `wthrbg_sys_msg_queue`.`ACTIVATION_KEY`,
                        `wthrbg_sys_msg_queue`.`CONTACTID`,
                        `wthrbg_sys_msg_queue`.`REQUESTID`,
                        `wthrbg_sys_msg_queue`.`PWD_RESET`,
                        `wthrbg_sys_msg_queue`.`SUBJECT_LINE`,
                        `wthrbg_sys_msg_queue`.`BODY_HTML`,
                        `wthrbg_sys_msg_queue`.`BODY_TEXT`,
                        `wthrbg_sys_msg_queue`.`ERROR_INFO`,
                        `wthrbg_sys_msg_queue`.`DATEMODIFIED`,
                        `wthrbg_sys_msg_queue`.`DATECREATED`
                    FROM `wthrbg_sys_msg_queue`
                    WHERE `wthrbg_sys_msg_queue`.`EMAIL`="'.self::$mysqli->real_escape_string(strtolower($oUser->retrieve_Form_Data('EMAIL'))).'" 
                         ORDER BY `wthrbg_sys_msg_queue`.`DATECREATED` DESC LIMIT 1;';

                    //error_log(self::$query);
                    self::$result = $oEnv->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
                    if(self::$mysqli->error){
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

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

                        //
                        // DO WE BUILD QUERY?
                        $tmp_loop_size = sizeof(self::$result_ARRAY);

                        if($tmp_loop_size==0){
                            return 'accnt_activate_resend=unknown';
                        }else{

                            for ($usrcnt=0; $usrcnt < $tmp_loop_size; $usrcnt++) {
                                $tmp_message_sourceid = $oUser->generateNewKey(70);

                                //
                                // BUILD ACTIVATION EMAIL RESEND QUERY
                                self::$query = 'INSERT INTO `wthrbg_sys_msg_queue` (`MSG_SOURCEID`, `MSG_SOURCEID_CRC32`,`MSG_KEYID`,`MSG_KEYID_CRC32`,`LANGCODE`,`EMAIL`, `RECIPIENTNAME`, `USERID`, `ACTIVATION_KEY`,`DATEMODIFIED`) 
                                VALUES ("'.$tmp_message_sourceid.'",
                                "'.crc32($tmp_message_sourceid).'",
                                "ACCOUNT_ACTIVATE","'.crc32('ACCOUNT_ACTIVATE').'",
                                "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("LANGCODE")).'",
                                "'.self::$result_ARRAY[$usrcnt][4].'",
                                "'.self::$result_ARRAY[$usrcnt][5].'",
                                "'.self::$result_ARRAY[$usrcnt][6].'",
                                "'.self::$result_ARRAY[$usrcnt][7].'",
                                "'.$ts.'");';

                                self::$result = $oEnv->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
                                if(self::$mysqli->error){
                                    throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                                }else {

                                    return 'accnt_activate_resend=success';
                                }

                            }

                        }
                    }

                    break;
                case 'user_signin':
                    $force_profile_select_align = true;
                    $db_resp_process_serial = "!jesus_is_my_dear_lord!! ";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();         //$oUser->return_serial_handle();
                    $db_resp_target_profiles = 'USER_ACCOUNT';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.
                    $db_resp_profile_field_cnt = '16';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION ::
                    $tmp_SELECT_ARRAY = array();
                    $tmp_SELECT_ARRAY[0] = 'SELECT `wthrbg_users`.`USERID`,
                    `wthrbg_users`.`ISACTIVE`,
                    `wthrbg_users`.`USER_PERMISSIONS_ID`,
                    `wthrbg_users`.`FIRSTNAME`,
                    `wthrbg_users`.`LASTNAME`,
                    `wthrbg_users`.`LOCALITY`,
                    `wthrbg_users`.`EMAIL`,
                    `wthrbg_users`.`PWDHASH`,
                    `wthrbg_users`.`LANGCODE`,
                    `wthrbg_users`.`LASTLOGIN`,
                    INET6_NTOA(`wthrbg_users`.`LASTLOGIN_IP`) AS LASTLOGIN_IP,
                    `wthrbg_users`.`LOGIN_CNT`,
                    `wthrbg_users`.`IMAGE_NAME`,
                    `wthrbg_users`.`IMAGE_WIDTH`,
                    `wthrbg_users`.`IMAGE_HEIGHT`,
                    `wthrbg_users`.`ABOUT` FROM `wthrbg_users` 
                    WHERE `wthrbg_users`.`EMAIL`="'.self::$mysqli->real_escape_string(strtolower($oUser->retrieve_Form_Data('EMAIL'))).'" AND `wthrbg_users`.`EMAIL_CRC32`="'.crc32(strtolower($oUser->retrieve_Form_Data('EMAIL'))).'" LIMIT 1;';

                    $oDB_RESP->process(self::$mysqli,$queryType, $tmp_SELECT_ARRAY);

                    //
                    // VERIFY LOGIN
                    $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial(), 'USER_ACCOUNT');

                    for ($usrcnt=0; $usrcnt < $tmp_loop_size; $usrcnt++) {
                        $tmp_pwdhash = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'USER_ACCOUNT', 'PWDHASH', $usrcnt);
                        $tmp_isactive = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'USER_ACCOUNT', 'ISACTIVE', $usrcnt);
                        $tmp_logincnt = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'USER_ACCOUNT', 'LOGIN_CNT', $usrcnt);
                        $tmp_userid = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'USER_ACCOUNT', 'USERID', $usrcnt);
                        //$tmp_permissions_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'USER_ACCOUNT', 'USER_PERMISSIONS_ID', $usrcnt);

                        if(password_verify($oUser->retrieve_Form_Data('PWDHASH'), $tmp_pwdhash)){

                            if($tmp_isactive=="1" || $tmp_isactive=="4"){
                                $tmp_newlogincnt = ($tmp_logincnt*1)+1;

                                self::$query = 'UPDATE `wthrbg_users` SET `wthrbg_users`.`LASTLOGIN`="'.$ts.'",`wthrbg_users`.`LASTLOGIN_IP`= INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),`wthrbg_users`.`LOGIN_CNT`="'.$tmp_newlogincnt.'",`wthrbg_users`.`DATEMODIFIED`="'.$ts.'" WHERE `wthrbg_users`.`USERID`="'.$tmp_userid.'" AND `wthrbg_users`.`USERID_CRC32`="'.crc32($tmp_userid).'" LIMIT 1;';
                                self::$query .= 'DELETE from `wthrbg_sessions` where SESSIONID="'.session_id().'" AND SESSIONID_CRC32="'.crc32(session_id()).'" LIMIT 1;';
                                self::$query .= 'INSERT INTO `wthrbg_sessions` (`SESSIONID`,`SESSIONID_CRC32`,`USERID`,`USERID_CRC32`,`REMOTE_ADDR`,`DATEMODIFIED`) VALUES ("'.session_id().'","'.crc32(session_id()).'","'.$tmp_userid.'","'.crc32($tmp_userid).'", INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),"'.$ts.'");';

                                //
                                // FLAG SESSION FOR ONE-TIME IMMEDIATE LOGIN APPROVAL. TOGGLED TO FALSE AFTER USE.
                                $oEnv->oSESSION_MGR->setSessionParam("FRESH_SESSION_ALERT", true);
                                //$oEnv->oSESSION_MGR->setSessionParam("USERID", self::$result_ARRAY[$usrcnt][0]);
                                //$oEnv->oSESSION_MGR->setSessionParam("USER_PERMISSIONS_ID", self::$result_ARRAY[$usrcnt][2]);

                                //
                                // PROCESS QUERY
                                self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                                //return $oDB_RESP;

                            }else{

                                //if(self::$result_ARRAY[$usrcnt][1]=="5" ){

                                //
                                // ACCOUNT NOT ACTIVATED OR SOMETHING.
                                //return self::$result_ARRAY;
                                //return $oDB_RESP;
                                //return 'signin=error';
                                //}

                            }

                            //
                            // RETURN RESULT SET ARRAY
                            //return self::$result_ARRAY;
                            return $oDB_RESP;

                        }else{
                            //return 'signin=error';
                            //error_log('1702 PASSWORD VERIFIED BAD!');
                            return $oDB_RESP;
                        }
                    }

                    //
                    // ALL DONE, PROCESSED AND READY FOR USE. RETURN RESPONSE OBJECT.
                    //return $oDB_RESP;

                    break;
                case 'validate_session':
                    //
                    // QUERY SESSION TABLE FOR QUALIFYING MATCHING SESSIONID
                    self::$query = 'SELECT `wthrbg_sessions`.`SESSIONID`,`wthrbg_sessions`.`USERID` FROM `wthrbg_sessions` WHERE `wthrbg_sessions`.`SESSIONID`="'.session_id().'" AND `wthrbg_sessions`.`SESSIONID_CRC32`="'.crc32(session_id()).'" AND `wthrbg_sessions`.`USERID`="'.$oEnv->oSESSION_MGR->getSessionParam('USERID').'" AND  `wthrbg_sessions`.`USERID_CRC32`="'.crc32($oEnv->oSESSION_MGR->getSessionParam('USERID')).'" AND `wthrbg_sessions`.`REMOTE_ADDR` = INET6_ATON("'.$_SERVER['REMOTE_ADDR'].'") AND DATE_SUB(CURDATE(),'.$oEnv->getEnvParam('SESSION_EXPIRE').') <= `wthrbg_sessions`.`DATEMODIFIED` LIMIT 1;';

                    //
                    // PROCESS QUERY
                    #error_log("evifweb database (2385) session query->".self::$query);
                    self::$result = $oEnv->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
                    //error_log("evifweb database (585) num_rows->".self::$result->num_rows);

                    $ROWCNT=0;
                    if(self::$mysqli->error){
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else{

                        //
                        // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
                        while ($row = self::$result->fetch_row()) {
                            foreach($row as $fieldPos=>$value){
                                //
                                // STORE RESULT
                                #error_log("services /database.inc.php (296) rowcnt[".$ROWCNT."] fieldPos[".$fieldPos."] value [".$value."]");
                                //self::$result_ARRAY[$ROWCNT][$fieldPos]=$value;

                            }
                            $ROWCNT++;
                        }
                        self::$result->free();

                        #error_log("evifweb database (1099) valid session rowcount->".$ROWCNT." on query->".self::$query);
                        switch($ROWCNT){
                            case 1:
                                //
                                // UPDATE SESSIONS WITH CURRENT ACTIVITY
                                self::$query = 'UPDATE `wthrbg_sessions` SET `wthrbg_sessions`.`DATEMODIFIED`="'.$ts.'" WHERE `wthrbg_sessions`.`SESSIONID`="'.session_id().'" AND 
								`wthrbg_sessions`.`SESSIONID_CRC32`="'.crc32(session_id()).'" AND
								`wthrbg_sessions`.`USERID`="'.$oEnv->oSESSION_MGR->getSessionParam('USERID').'" AND 
								`wthrbg_sessions`.`USERID_CRC32`="'.crc32($oEnv->oSESSION_MGR->getSessionParam('USERID')).'" LIMIT 1;';

                                //
                                // PROCESS QUERY
                                //error_log("evifweb database (597) query->".self::$query);
                                self::$result = $oEnv->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);

                                return "authorized";
                                break;
                            default:

                                return "validate_session=error";
                                break;
                        }

                    }

                    break;
                case 'user_signin_old':

                    self::$query = 'SELECT `wthrbg_users`.`USERID`,`wthrbg_users`.`ISACTIVE`,`wthrbg_users`.`USER_PERMISSIONS_ID`,`wthrbg_users`.`FIRSTNAME`,`wthrbg_users`.`LASTNAME`,`wthrbg_users`.`LOCALITY`,`wthrbg_users`.`EMAIL`,`wthrbg_users`.`PWDHASH`,`wthrbg_users`.`LANGCODE`,`wthrbg_users`.`LASTLOGIN`, INET6_NTOA(`wthrbg_users`.`LASTLOGIN_IP`) AS LASTLOGIN_IP,`wthrbg_users`.`LOGIN_CNT`,`wthrbg_users`.`IMAGE_NAME`,`wthrbg_users`.`IMAGE_WIDTH`,`wthrbg_users`.`IMAGE_HEIGHT`,`wthrbg_users`.`ABOUT` FROM `wthrbg_users` 
                    WHERE `wthrbg_users`.`EMAIL`="'.self::$mysqli->real_escape_string(strtolower($oUser->retrieve_Form_Data('EMAIL'))).'" AND `wthrbg_users`.`EMAIL_CRC32`="'.crc32(strtolower($oUser->retrieve_Form_Data('EMAIL'))).'" LIMIT 1;';

                    //error_log('AV Overlay database.inc.php (1670) query :: '.self::$query);

                    //
                    // PROCESS QUERY
                    self::$result = $oEnv->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
                    if(self::$mysqli->error){
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

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

                        //
                        // VERIFY LOGIN
                        $tmp_loop_size = sizeof(self::$result_ARRAY);
                        for ($usrcnt=0; $usrcnt < $tmp_loop_size; $usrcnt++) {
                            if(password_verify($oUser->retrieve_Form_Data('PWDHASH'), self::$result_ARRAY[$usrcnt][8])){

                                //error_log('1702 PASSWORD VERIFIED GOOD!');

                                if(self::$result_ARRAY[$usrcnt][1]=="1" || self::$result_ARRAY[$usrcnt][1]=="4"){
                                    $tmp_newlogincnt = self::$result_ARRAY[$usrcnt][12]+1;

                                    //
                                    // BUILD FOLLOW QUERY TO UPDATE LAST LOGIN DATE AND LOGIN COUNT
                                    self::$query = 'UPDATE `wthrbg_users` SET `wthrbg_users`.`LASTLOGIN`="'.$ts.'",`wthrbg_users`.`LASTLOGIN_IP`= INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),`wthrbg_users`.`LOGIN_CNT`="'.$tmp_newlogincnt.'",`wthrbg_users`.`DATEMODIFIED`="'.$ts.'" WHERE `wthrbg_users`.`USERID`="'.self::$result_ARRAY[$usrcnt][0].'" AND `wthrbg_users`.`USERID_CRC32`="'.crc32(self::$result_ARRAY[$usrcnt][0]).'" LIMIT 1;';
                                    self::$query .= 'DELETE from `wthrbg_sessions` where SESSIONID="'.session_id().'" AND SESSIONID_CRC32="'.crc32(session_id()).'" LIMIT 1;';
                                    self::$query .= 'INSERT INTO `wthrbg_sessions` (`SESSIONID`,`SESSIONID_CRC32`,`USERID`,`USERID_CRC32`,`REMOTE_ADDR`,`DATEMODIFIED`) VALUES ("'.session_id().'","'.crc32(session_id()).'","'.self::$result_ARRAY[$usrcnt][0].'","'.crc32(self::$result_ARRAY[$usrcnt][0]).'", INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),"'.$ts.'");';

                                    //
                                    // FLAG SESSION FOR ONE-TIME IMMEDIATE LOGIN APPROVAL. TOGGLED TO FALSE AFTER USE.
                                    $oEnv->oSESSION_MGR->setSessionParam("FRESH_SESSION_ALERT", true);
                                    $oEnv->oSESSION_MGR->setSessionParam("USERID", self::$result_ARRAY[$usrcnt][0]);
                                    $oEnv->oSESSION_MGR->setSessionParam("USER_PERMISSIONS_ID", self::$result_ARRAY[$usrcnt][2]);

                                    //
                                    // PROCESS QUERY
                                    //error_log("evifweb database (467) query->".self::$query);
                                    //error_log("AV overlay database (1716) query->".self::$query);
                                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                                }else{

                                    //if(self::$result_ARRAY[$usrcnt][1]=="5" ){

                                    //
                                    // ACCOUNT NOT ACTIVATED OR SOMETHING.
                                    return self::$result_ARRAY;

                                    //}

                                }

                                //
                                // RETURN RESULT SET ARRAY
                                return self::$result_ARRAY;

                                $usrcnt=1000;

                            }else{

                                //error_log('1702 PASSWORD VERIFIED BAD!');
                            }
                        }

                        //
                        // IF WE GET THIS FAR...NO SUCCESS LOGIN
                        return false;

                    }

                    break;
                case 'admin_initiated_pwd_reset':
                    /*self::$frm_input_ARRAY["EMAIL"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'EMAIL');
            self::$frm_input_ARRAY["LANGCODE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'LANGCODE');
            self::$frm_input_ARRAY["FIRSTNAME"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'FIRSTNAME');
            self::$frm_input_ARRAY["LASTNAME"]*/

                    $tmp_activitydescription = $oUser->retrieve_Form_Data("FIRSTNAME")." ".$oUser->retrieve_Form_Data("LASTNAME")." (".$oUser->retrieve_Form_Data("EMAIL").") has been flagged to receive a password reset notification.";
                    $tmp_activityid = $oUser->generateNewKey(70);

                    //
                    // LOG ADMIN ACTIVITY
                    self::$query = 'INSERT INTO `log_sys_admin` (`ACTIVITY_ID`,`USERID`,`USERID_CRC32`,`USER_FIRSTNAME`,`USER_FIRSTNAME_BLOB`,`USER_LASTNAME`,`USER_LASTNAME_BLOB`,`PHPSESSION`,`IPADDRESS`,`HTTP_USER_AGENT`,`CHANNEL`,`ACTIVITY_DESCRIPTION`,`ACTIVITY_DESCRIPTION_BLOB`) VALUES (
					"'.$tmp_activityid.'",
					"'.$oEnv->oSESSION_MGR->getSessionParam('USERID').'",
					"'.crc32($oEnv->oSESSION_MGR->getSessionParam('USERID')).'",
					"'.self::$mysqli->real_escape_string($oEnv->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
					"'.self::$mysqli->real_escape_string($oEnv->oSESSION_MGR->getSessionParam('FIRSTNAME')).'",
					"'.self::$mysqli->real_escape_string($oEnv->oSESSION_MGR->getSessionParam('LASTNAME')).'",
					"'.self::$mysqli->real_escape_string($oEnv->oSESSION_MGR->getSessionParam('LASTNAME')).'",
					"'.session_id().'",
					"'.$_SERVER['REMOTE_ADDR'].'",
					"'.$_SERVER['HTTP_USER_AGENT'].'",
					"'.strtoupper($oEnv->oSESSION_MGR->getSessionParam("DEVICETYPE")).'",
					"'.self::$mysqli->real_escape_string($tmp_activitydescription).'",
					"'.self::$mysqli->real_escape_string($tmp_activitydescription).'");';

                    #error_log("database (164) query->".self::$query);
                    self::$result = $oEnv->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        self::$query_exception_result="admin_initiated_pwd_reset=false";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }

                case 'pwd_reset':

                    //
                    // CHECK TO SEE IF WE HAVE EMAIL ADDRESS ON RECORD FOR AN ACCOUNT.
                    self::$query = 'SELECT `wthrbg_users`.`USERID`,`wthrbg_users`.`FIRSTNAME` FROM `wthrbg_users` WHERE 
					`wthrbg_users`.`EMAIL`="'.self::$mysqli->real_escape_string(strtolower(trim($oUser->retrieve_Form_Data('EMAIL')))).'" AND 
					`wthrbg_users`.`EMAIL_CRC32`="'.crc32(strtolower(trim($oUser->retrieve_Form_Data('EMAIL')))).'";';

                    //
                    // PROCESS QUERY
                    //error_log("evifweb database (809) query->".self::$query);
                    self::$result = $oEnv->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
                    if(self::$mysqli->error){
                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

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

                    switch($ROWCNT){
                        case 1:
                            //
                            // WE HAVE USER. SEND PASSWORD RESET LINK.
                            $tmp_requestid = $oUser->generateNewKey(50);
                            $tmp_msgsourceid = $oUser->generateNewKey(70);

                            self::$query = 'INSERT INTO `wthrbg_sys_pswd_reset` (`REQUESTID`,`REQUESTID_CRC32`,`USERID`,`EMAIL`) VALUES ("'.$tmp_requestid.'","'.crc32($tmp_requestid).'","'.self::$result_ARRAY[0][0].'","'.self::$mysqli->real_escape_string(strtolower(trim($oUser->retrieve_Form_Data('EMAIL')))).'");';

                            self::$query .= 'INSERT INTO `wthrbg_sys_msg_queue` (`MSG_SOURCEID`,`MSG_SOURCEID_CRC32`,`MSG_KEYID`,`MSG_KEYID_CRC32`,`REQUESTID`,`PWD_RESET`,`EMAIL`,`RECIPIENTNAME`,`DATEMODIFIED`) VALUES ("'.$tmp_msgsourceid.'","'.crc32($tmp_msgsourceid).'","PASSWORD_RESET","'.crc32('PASSWORD_RESET').'","'.$tmp_requestid.'","1","'.self::$mysqli->real_escape_string(strtolower($oUser->retrieve_Form_Data('EMAIL'))).'","'.self::$mysqli->real_escape_string(self::$result_ARRAY[0][1]).'","'.$ts.'");';

                            //
                            // PROCESS QUERY
                            //error_log("1748 AV overlay database (1427) query->".self::$query);
                            self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                            if(self::$mysqli->error){
                                self::$query_exception_result = "error";
                                throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
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
                case 'get_pwd_reset_data':
                    self::$query = 'SELECT `sys_pswd_reset`.`REQUESTID`,`sys_pswd_reset`.`USERID`,`sys_pswd_reset`.`EMAIL` FROM `sys_pswd_reset` WHERE `sys_pswd_reset`.`REQUESTID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('REQUESTID')).'" AND `sys_pswd_reset`.`REQUESTID_CRC32`="'.crc32($oUser->retrieve_Form_Data('REQUESTID')).'" AND DATE_SUB(CURDATE(),'.$oEnv->getEnvParam('PWD_RESET_LINK_EXPIRE').') <= `sys_pswd_reset`.`DATECREATED` LIMIT 1;';

                    //
                    // PROCESS QUERY
                    //error_log("evifweb database (1472) query->".self::$query);
                    self::$result = $oEnv->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
                    if(self::$mysqli->error){
                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

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
                    self::$query = 'SELECT `sys_pswd_reset`.`REQUESTID` FROM `sys_pswd_reset` WHERE `sys_pswd_reset`.`REQUESTID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('REQUESTID')).'" AND `sys_pswd_reset`.`REQUESTID_CRC32`="'.crc32($oUser->retrieve_Form_Data('REQUESTID')).'" AND DATE_SUB(CURDATE(),'.$oEnv->getEnvParam('PWD_RESET_LINK_EXPIRE').') <= `sys_pswd_reset`.`DATECREATED` LIMIT 1;';

                    //
                    // PROCESS QUERY
                    //error_log("evifweb database (1472) query->".self::$query);
                    self::$result = $oEnv->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
                    if(self::$mysqli->error){
                        self::$query_exception_result = "error";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

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
                    self::$frm_input_ARRAY["PWD_HASH"] = md5(self::$oEnv->oHTTP_MGR->extractData($_POST, 'pwd'));
            self::$frm_input_ARRAY["PWD_HASH_CONFIRM"] = md5(self::$oEnv->oHTTP_MGR->extractData($_POST, 'pwdconfirm'));
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
                        //error_log("evifweb database (1472) query->".self::$query);
                        self::$result = $oEnv->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
                        if(self::$mysqli->error){
                            self::$query_exception_result = "error";
                            throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

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

                        /*
                        self::$frm_input_ARRAY["PWD_HASH"] = md5(self::$oEnv->oHTTP_MGR->extractData($_POST, 'pwd'));
        self::$frm_input_ARRAY["PWD_HASH_CONFIRM"] = md5(self::$oEnv->oHTTP_MGR->extractData($_POST, 'pwdconfirm'));
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

                                self::$query = 'UPDATE `wthrbg_users` SET `PWDHASH`="'.$tmp_pwdhash.'",`DATEMODIFIED`="'.$ts.'" 
									WHERE `USERID`="'.self::$result_ARRAY[0][1].'" AND `USERID_CRC32`="'.crc32(self::$result_ARRAY[0][1]).'" LIMIT 1;';

                                //
                                // PROCESS QUERY
                                self::$result = $oEnv->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);

                                if(self::$mysqli->error){
                                    self::$query_exception_result = "error";
                                    throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
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
                case 'contact_home':
                    //
                    // PREPARE HASHES
                    $tmp_contactid = $oUser->generateNewKey(50);
                    $tmp_msgsourceid_user = $oUser->generateNewKey(70);
                    $tmp_msgsourceid_admin = $oUser->generateNewKey(70);
                    $tmp_msgsourceid_sms = $oUser->generateNewKey(70);

                    //
                    // BUILD QUERY
                    self::$query = 'INSERT INTO `wthrbg_log_contact_req` (`CONTACTID`, `CONTACTID_CRC32`, `FIRSTNAME`,`LASTNAME`,`EMAIL`,`MOBILENUMBER`,`MESSAGE`,`PHPSESSION_ID`,`LANGCODE`,`HTTP_USER_AGENT`,`REMOTE_ADDR`,`CHK_ASSIST_ACCNT_CREATION`,`CHK_ASSIST_OBS_INTEGRATE`,`DATECREATED`) VALUES 
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
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_ASSIST_ACCNT_CREATION")).'",
					"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("CHK_ASSIST_OBS_INTEGRATE")).'",
					"'.$ts.'");';

                    self::$query .= 'INSERT INTO `wthrbg_sys_msg_queue` (`MSG_SOURCEID`,`MSG_SOURCEID_CRC32`,`MSG_KEYID`,`MSG_KEYID_CRC32`,`EMAIL`,`RECIPIENTNAME`,`LANGCODE`,`DATEMODIFIED`) VALUES ("'.$tmp_msgsourceid_user.'","'.crc32($tmp_msgsourceid_user).'","CONTACT_CONFIRM","'.crc32('CONTACT_CONFIRM').'","'.self::$mysqli->real_escape_string(strtolower($oUser->retrieve_Form_Data('EMAIL'))).'","'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('FIRSTNAME')).'","'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("LANGCODE")).'","'.$ts.'");';
                    self::$query .= 'INSERT INTO `wthrbg_sys_msg_queue` (`MSG_SOURCEID`,`MSG_SOURCEID_CRC32`,`MSG_KEYID`,`MSG_KEYID_CRC32`,`EMAIL`,`RECIPIENTNAME`,`CONTACTID`,`DATEMODIFIED`) VALUES ("'.$tmp_msgsourceid_admin.'","'.crc32($tmp_msgsourceid_admin).'","ADMIN_CONTACT_CONFIRM","'.crc32('ADMIN_CONTACT_CONFIRM').'","'.self::$mysqli->real_escape_string($oEnv->getEnvParam('ADMIN_NOTIFICATIONS_EMAIL')).'","'.self::$mysqli->real_escape_string($oEnv->getEnvParam('ADMIN_NOTIFICATIONS_RECIPIENTNAME')).'","'.$tmp_contactid.'","'.$ts.'");';
                    self::$query .= 'INSERT INTO `wthrbg_sys_msg_queue` (`MSG_SOURCEID`,`MSG_SOURCEID_CRC32`,`MSG_KEYID`,`MSG_KEYID_CRC32`,`EMAIL`,`RECIPIENTNAME`,`CONTACTID`,`DATEMODIFIED`) VALUES ("'.$tmp_msgsourceid_sms.'","'.crc32($tmp_msgsourceid_sms).'","ADMIN_SMS_NOTIFICATION","'.crc32('ADMIN_SMS_NOTIFICATION').'","'.self::$mysqli->real_escape_string($oEnv->getEnvParam('SMS_NOTIFICATIONS_ENDPOINT')).'","'.self::$mysqli->real_escape_string($oEnv->getEnvParam('ADMIN_NOTIFICATIONS_RECIPIENTNAME')).'","'.$tmp_contactid.'","'.$ts.'");';

                    //
                    // PROCESS QUERY
                    //error_log("evifweb database (112) contact_home query->".self::$query);
                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
                    if(self::$mysqli->error){
                        self::$query_exception_result="contactus=false";
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else{
                        return "success";
                    }

                    break;
                case 'signup_main':

                    //
                    // PERFORM CHECK FOR UNIQUE EMAIL self::$frm_input_ARRAY["EMAIL"]
                    self::$query = 'SELECT `wthrbg_users`.`EMAIL` FROM `wthrbg_users` WHERE `wthrbg_users`.`EMAIL`="'.self::$mysqli->real_escape_string(strtolower($oUser->retrieve_Form_Data("EMAIL"))).'" AND 
					`wthrbg_users`.`EMAIL_CRC32`="'.crc32(strtolower($oUser->retrieve_Form_Data("EMAIL"))).'";';

                    //
                    // PROCESS QUERY
                    //error_log("evifweb database (583) session query->".self::$query);
                    self::$result = $oEnv->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
                    //error_log("evifweb database (585) num_rows->".self::$result->num_rows);

                    $ROWCNT=0;
                    if(self::$mysqli->error){
                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

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
                        $tmp_stream_mention = "@".self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("FIRSTNAME")).self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("LASTNAME"));

                        //
                        // PREPARE QUERY
                        self::$query = 'INSERT INTO `wthrbg_users` (`USERID`,`USERID_CRC32`,`FIRSTNAME`,`FIRSTNAME_BLOB`,`LASTNAME`,`LASTNAME_BLOB`,`LOCALITY`,`LOCALITY_BLOB`,`USER_PERMISSIONS_ID`,`EMAIL`,`EMAIL_CRC32`,`STREAM_MENTION`,`PWDHASH`,`LANGCODE`,`DATEMODIFIED`) VALUES 
						("'.$tmp_userid.'",
						"'.crc32($tmp_userid).'",
						"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("FIRSTNAME")).'",
						"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("FIRSTNAME")).'",
						"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("LASTNAME")).'",
						"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("LASTNAME")).'",
						"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("LOCALITY")).'",
						"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("LOCALITY")).'",
						"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("SERVICE")).'",
						"'.self::$mysqli->real_escape_string(strtolower($oUser->retrieve_Form_Data("EMAIL"))).'",
						"'.crc32($oUser->retrieve_Form_Data("EMAIL")).'",
						"'.$tmp_stream_mention.'",
						"'.$tmp_pwdhash.'",
						"'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("LANGCODE")).'",
						"'.$ts.'");';

                        $tmp_translationid = $oUser->generateNewKey(70);

                        self::$query .= 'INSERT INTO `wthrbg_users_activation` (`ACTIVATEKEY`, `ACTIVATEKEY_CRC32`,`USERID`,`USERID_CRC32`, `EMAIL`,`LANGCODE`, `DATEMODIFIED`) VALUES ("'.$tmp_activationkey.'", "'.crc32($tmp_activationkey).'","'.$tmp_userid.'", "'.crc32($tmp_userid).'", "'.self::$mysqli->real_escape_string(strtolower($oUser->retrieve_Form_Data("EMAIL"))).'", "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("LANGCODE")).'", "'.$ts.'");';

                        self::$query .= 'INSERT INTO `wthrbg_sys_msg_queue` (`MSG_SOURCEID`, `MSG_SOURCEID_CRC32`,`MSG_KEYID`,`MSG_KEYID_CRC32`,`LANGCODE`,`EMAIL`, `RECIPIENTNAME`, `USERID`, `ACTIVATION_KEY`,`DATEMODIFIED`) VALUES ("'.$tmp_message_sourceid.'","'.crc32($tmp_message_sourceid).'","ACCOUNT_ACTIVATE","'.crc32('ACCOUNT_ACTIVATE').'","'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("LANGCODE")).'","'.self::$mysqli->real_escape_string(strtolower($oUser->retrieve_Form_Data("EMAIL"))).'","'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("FIRSTNAME")).' '.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("LASTNAME")).'","'.self::$mysqli->real_escape_string($tmp_userid).'","'.self::$mysqli->real_escape_string($tmp_activationkey).'","'.$ts.'");';

                        $tmp_piped = $oUser->retrieve_Form_Data("LANG_ID_PIPED");

                        if($tmp_piped!=''){
                            $tmp_pipe_ARRAY = explode('|', $tmp_piped);

                            foreach($tmp_pipe_ARRAY as $key => $val){
                                $tmp_lang_id = $oEnv->paramTunnelDecrypt($val);
                                $tmp_translationid = $oUser->generateNewKey(70);

                                self::$query .= 'INSERT INTO `wthrbg_translator_lang_id`
                                (`RELATION_ID`,
                                `USERID`,
                                `LANG_ID`,
                                `DATEMODIFIED`)
                                VALUES
                                ("'.$tmp_translationid.'",
                                "'.$tmp_userid.'",
                                "'.self::$mysqli->real_escape_string($tmp_lang_id).'",
                                "'.$ts.'");
                                ';
                            }
                        }else{

                            $tmp_translationid = $oUser->generateNewKey(70);

                            self::$query .= 'INSERT INTO `wthrbg_translator_lang_id`
                                (`RELATION_ID`,
                                `USERID`,
                                `LANG_ID`,
                                `DATEMODIFIED`)
                                VALUES
                                ("'.$tmp_translationid.'",
                                "'.$tmp_userid.'",
                                "'.self::$mysqli->real_escape_string(strtolower($oUser->retrieve_Form_Data("LANGCODE"))).'",
                                "'.$ts.'");
                                ';

                        }

                        //
                        // PROCESS QUERY
                        //error_log('1791 signup QUERY->'.self::$query);
                        self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

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

                                throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.'] on email='.strtolower($oUser->retrieve_Form_Data('EMAIL')));

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
                            throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.'] on email='.strtolower($oUser->retrieve_Form_Data('EMAIL')));
                        }

                        $oEnv->oSESSION_MGR->setSessionParam('FORM_EMAIL',$oUser->retrieve_Form_Data('EMAIL'));

                        return 'newuser=success';
                    }

                    break;
                case 'activate_account':
                    //
                    // SELECT ...
                    self::$query = 'SELECT `wthrbg_users_activation`.`ACTIVATEKEY`,`wthrbg_users_activation`.`ACTIVATEKEY_CRC32`,`wthrbg_users_activation`.`USERID`,`wthrbg_users_activation`.`USERID_CRC32`,`wthrbg_users_activation`.`ISACTIVE`,`wthrbg_users`.`USERID`,`wthrbg_users`.`ISACTIVE`,`wthrbg_users`.`EMAIL` FROM `wthrbg_users_activation` INNER JOIN `wthrbg_users` ON `wthrbg_users_activation`.`USERID` = `wthrbg_users`.`USERID` WHERE `wthrbg_users_activation`.`ACTIVATEKEY`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('ACTIVATEKEY')).'" AND `wthrbg_users_activation`.`ACTIVATEKEY_CRC32`="'.crc32($oUser->retrieve_Form_Data('ACTIVATEKEY')).'" AND `wthrbg_users_activation`.`USERID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('USERID')).'" AND `wthrbg_users_activation`.`USERID_CRC32`="'.crc32($oUser->retrieve_Form_Data('USERID')).'";';

                    //error_log('/services/database.inc.php (1184) :: '.self::$query);

                    //
                    // PROCESS QUERY
                    self::$result = $oEnv->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
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
                                    self::$query = 'UPDATE `wthrbg_users` SET `ISACTIVE`="4",`DATEMODIFIED`="'.$ts.'" 
									WHERE `USERID`="'.$row["USERID"].'" AND 
									`USERID_CRC32`="'.crc32($row["USERID"]).'" LIMIT 1;';

                                    self::$query .= 'UPDATE `wthrbg_users_activation` SET `ISACTIVE`="1",`DATEMODIFIED`="'.$ts.'" 
									WHERE `ACTIVATEKEY`="'.$row["ACTIVATEKEY"].'" AND 
									`ACTIVATEKEY_CRC32`="'.$row["ACTIVATEKEY_CRC32"].'" AND 
									`USERID`="'.$row["USERID"].'" AND
									`USERID_CRC32`="'.$row["USERID_CRC32"].'" LIMIT 1;';

                                    #error_log("(1203) USERNAME: ".$row["USERNAME"]);
                                    #error_log('/services/ database.inc.php (1204) :: '.self::$query);
                                    //
                                    // PROCESS QUERY
                                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                                    $ROWCNT=0;
                                    do {
                                        if(self::$mysqli->error){
                                            if($ROWCNT>0){
                                                self::$query_exception_result='accountactivate=false';
                                            }else{
                                                self::$query_exception_result='accountactivate=falseall';
                                            }

                                            throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                                        }
                                        $ROWCNT++;

                                        if (self::$mysqli->more_results()) {
                                            //
                                            // END OF RECORD. MORE TO FOLLOW.
                                        }
                                    } while (self::$mysqli->more_results() && self::$mysqli->next_result());

                                    if(self::$mysqli->error){
                                        self::$query_exception_result='accountactivate=false';
                                        throw new Exception('AV Overlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');
                                    }

                                    $oEnv->oSESSION_MGR->setSessionParam('FORM_EMAIL',$row["EMAIL"]);
                                    return 'accountactivate=true';

                                    break;
                                default:
                                    //
                                    // ACCOUNT IS ALREADY ACTIVATED. NO FURTHER UPDATES NEEDED. SAVE THE RESOURCES
                                    $oEnv->oSESSION_MGR->setSessionParam('FORM_EMAIL',$row["EMAIL"]);
                                    return 'accountactivate=donealready';
                                    break;
                            }
                            break;
                        case 0:
                            //
                            // POTENTIAL HACK ATTEMPT OR SYSTEM ERR
                            //error_log('(7161) :: ACTIVATION ERROR :: NUMROW=0|accountactivate=dataerror_null|'.$row["ACTIVATEKEY"]);
                            return 'accountactivate=dataerror_null';
                            break;
                        default:
                            //
                            // POTENTIAL SYSTEM ERR
                            //error_log('(7176) :: ACTIVATION ERROR :: NUMROW='.self::$result->num_rows.'|accountactivate=dataerror_redun|'.$row["ACTIVATEKEY"]);
                            return 'accountactivate=dataerror_redun';
                            break;
                    }

                    break;
                case 'sync_LANGCODE':
                    self::$query = 'UPDATE `wthrbg_users` SET 
							`LANGCODE`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("LANGCODE")).'", 
							`DATEMODIFIED`="'.$ts.'" 
							WHERE `USERID`="'.$oEnv->oSESSION_MGR->getSessionParam('USERID').'" AND 
							`USERID_CRC32`="'.crc32($oEnv->oSESSION_MGR->getSessionParam('USERID')).'" LIMIT 1;';


                    // self::$result = $oEnv->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);

                    if(self::$mysqli->error){
                        throw new Exception('avoverlay database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }

                    return NULL;

                    break;
                case 'sys_lang_get':
                    self::$query = 'SELECT `wthrbg_sys_lang_type`.`LANG_ID`, `wthrbg_sys_lang_type`.`COUNTRY_ISO_CODE`, `wthrbg_sys_lang_type`.`COUNTRY_ISO_NAME`,
					`wthrbg_sys_lang_type`.`NATIVE_NAME_BLOB`, `wthrbg_sys_lang_type`.`RTL_FLAG`, `wthrbg_sys_lang_type`.`DATEMODIFIED`, `wthrbg_sys_lang_type`.`DATECREATED` FROM `wthrbg_sys_lang_type`;';

                    self::$query .= 'SELECT `wthrbg_sys_lang_elements`.`COUNTRY_ISO_CODE`, COUNT(*) AS `ELEMENTS` FROM `wthrbg_sys_lang_elements` GROUP BY `COUNTRY_ISO_CODE`;';

                    //
                    // PROCESS QUERY
                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

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
                                self::$query = 'UPDATE `wthrbg_overlay_state` SET `MINI_STATE`="0",
                       `MODIFIER_ID` = "' . $tmp_modifierid . '",
                       `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                       `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        `MODIFIER_SESSION_ID` = "' . session_id() . '",
                        `DATEMODIFIED`="' . $ts . '" 
					     LIMIT 1;';
                                break;
                            case 'hidetmr_r':
                            case 'hidetmr_k':
                            case 'hidetmr_p':
                                self::$query = 'UPDATE `wthrbg_overlay_state` SET `MINI_TIMER_STATE`="0",
                       `MODIFIER_ID` = "' . $tmp_modifierid . '",
                       `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                       `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        `MODIFIER_SESSION_ID` = "' . session_id() . '",
                        `DATEMODIFIED`="' . $ts . '" 
					     LIMIT 1;';
                                break;
                            case 'showtmr':
                                self::$query = 'UPDATE `wthrbg_overlay_state` SET `MINI_TIMER_STATE`="1",
                       `MODIFIER_ID` = "' . $tmp_modifierid . '",
                       `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                       `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        `MODIFIER_SESSION_ID` = "' . session_id() . '",
                        `DATEMODIFIED`="' . $ts . '" 
					     LIMIT 1;';
                                break;
                            case 'show_overlay':
                                self::$query = 'UPDATE `wthrbg_overlay_state` SET `MINI_STATE`="1",
                       `MODIFIER_ID` = "' . $tmp_modifierid . '",
                       `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
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

                        $tmp_activitydescription = "A ".$tmp_type." overlay UPDATE (<span class='a_log_topic_name'>".$queryType."</span>) has been received.";

                        self::$query .= 'INSERT INTO `wthrbg_log_sys_user`
                        (`ACTIVITY_ID`,
                        `MODIFIER_ID`,
                        `MODIFIER_ID_CRC32`,
                        `ACTIVITY_DESCRIPTION`,
                        `ACTIVITY_DESCRIPTION_BLOB`,
                        `PHPSESSION`,
                        `IPADDRESS_V6`,
                        `IPADDRESS`,
                        `HTTP_USER_AGENT`,
                        `CHANNEL`)
                        VALUES (
                        "'.$tmp_activityid.'",
                        "'.$tmp_modifierid.'",
                        "'.crc32($tmp_modifierid).'",
                        "'.self::$mysqli->real_escape_string($oUser->searchTruncStr($tmp_activitydescription, 1000)).'",
                        "'.self::$mysqli->real_escape_string($tmp_activitydescription).'",
                        "'.session_id().'",
                        INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        "'.$_SERVER['HTTP_USER_AGENT'].'",
                        "D");';

                        self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                        #error_log("database (1125) query->".self::$query);
                        if(self::$mysqli->error){

                            self::$query_exception_result = "overlay_update=error";
                            throw new Exception('jony5 database_integration :: mini overlay :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                        }else {

                            //do {
                            //} while (self::$mysqli->more_results() && self::$mysqli->next_result());

                            //
                            // XML SYNC
                            //$this->syncXML($tmp_type, $queryType, $oUser, $oEnv);

                            return 'success';
                        }

                    }

                    if(isset($tmp_ISACTIVE) && $tmp_type=='full') {
                        self::$query = 'UPDATE `wthrbg_overlay_state` SET `FULLSCREEN_STATE`="'.$tmp_ISACTIVE.'",
                        `MODIFIER_ID` = "' . $tmp_modifierid . '",
                        `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        `MODIFIER_SESSION_ID` = "' . session_id() . '",
                        `DATEMODIFIED`="' . $ts . '" 
                        LIMIT 1;';

                        $tmp_activityid = $oUser->generateNewKey(70);

                        $tmp_activitydescription = "A ".$tmp_type." overlay UPDATE (<span class='a_log_topic_name'>".$queryType."</span>) has been received.";

                        self::$query .= 'INSERT INTO `wthrbg_log_sys_user`
                        (`ACTIVITY_ID`,
                        `MODIFIER_ID`,
                        `MODIFIER_ID_CRC32`,
                        `ACTIVITY_DESCRIPTION`,
                        `ACTIVITY_DESCRIPTION_BLOB`,
                        `PHPSESSION`,
                        `IPADDRESS_V6`,
                        `IPADDRESS`,
                        `HTTP_USER_AGENT`,
                        `CHANNEL`)
                        VALUES (
                        "'.$tmp_activityid.'",
                        "'.$tmp_modifierid.'",
                        "'.crc32($tmp_modifierid).'",
                        "'.self::$mysqli->real_escape_string($oUser->searchTruncStr($tmp_activitydescription, 1000)).'",
                        "'.self::$mysqli->real_escape_string($tmp_activitydescription).'",
                        "'.session_id().'",
                        INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        "'.$_SERVER['HTTP_USER_AGENT'].'",
                        "D");';

                        self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                        #error_log("database (1125) query->".self::$query);
                        if(self::$mysqli->error){

                            self::$query_exception_result = "overlay_update=error";
                            throw new Exception('avoverlay database_integration :: full screen overlay :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                        }else {

                            //do {
                            //} while (self::$mysqli->more_results() && self::$mysqli->next_result());

                            //
                            // XML SYNC
                            //$this->syncXML($tmp_type, $queryType, $oUser,$oEnv);

                            return 'success';
                        }

                    }

                    return 'err';

                    break;
                case 'activate_full_profile':
                    error_log('Die...who uses this still??');
                    die();
                    $tmp_activityid = $oUser->generateNewKey(70);
                    $tmp_modifierid = $oUser->generateNewKey(70);

                    $tmp_activitydescription = "A full screen overlay profile (<span class='a_log_topic_name'>".$oUser->retrieve_Form_Data('NAME')."</span>) has been made active.";

                    self::$query = 'UPDATE `wthrbg_overlay_state` SET `FULLSCREEN_PROFILE_ID`="'.$oUser->retrieve_Form_Data('PROFILE_ID').'",
                       `MODIFIER_ID` = "' . $tmp_modifierid . '",
                       `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                       `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        `MODIFIER_SESSION_ID` = "' . session_id() . '",
                        `DATEMODIFIED`="' . $ts . '" 
					     LIMIT 1;';

                    self::$query .= 'INSERT INTO `wthrbg_log_sys_user`
                    (`ACTIVITY_ID`,
                    `MODIFIER_ID`,
                    `MODIFIER_ID_CRC32`,
                    `FULL_SCRN_PROFILE_ID`,
                    `FULL_SCRN_PROFILE_ID_CRC32`,
                    `ACTIVITY_DESCRIPTION`,
                    `ACTIVITY_DESCRIPTION_BLOB`,
                    `PHPSESSION`,
                    `IPADDRESS_V6`,
                    `IPADDRESS`,
                    `HTTP_USER_AGENT`,
                    `CHANNEL`)
                    VALUES (
                    "'.$tmp_activityid.'",
                    "'.$tmp_modifierid.'",
                    "'.crc32($tmp_modifierid).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID')).'",
                    "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'",
                    "'.self::$mysqli->real_escape_string($oUser->searchTruncStr($tmp_activitydescription, 1000)).'",
                    "'.self::$mysqli->real_escape_string($tmp_activitydescription).'",
                    "'.session_id().'",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "'.$_SERVER['HTTP_USER_AGENT'].'",
                    "D");';

                    //error_log(self::$query);

                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

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

                    $tmp_activitydescription = "A mini overlay profile (<span class='a_log_topic_name'>".$oUser->retrieve_Form_Data('NAME')."</span>) has been made active.";

                    self::$query = 'UPDATE `wthrbg_overlay_state` SET `MINI_PROFILE_ID`="'.$oUser->retrieve_Form_Data('PROFILE_ID').'",
                       `MODIFIER_ID` = "' . $tmp_modifierid . '",
                       `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                       `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        `MODIFIER_SESSION_ID` = "' . session_id() . '",
                        `DATEMODIFIED`="' . $ts . '" 
					     LIMIT 1;';

                    self::$query .= 'INSERT INTO `wthrbg_log_sys_user`
                    (`ACTIVITY_ID`,
                    `MODIFIER_ID`,
                    `MODIFIER_ID_CRC32`,
                    `MINI_PROFILE_ID`,
                    `MINI_PROFILE_ID_CRC32`,
                    `ACTIVITY_DESCRIPTION`,
                    `ACTIVITY_DESCRIPTION_BLOB`,
                    `PHPSESSION`,
                    `IPADDRESS_V6`,
                    `IPADDRESS`,
                    `HTTP_USER_AGENT`,
                    `CHANNEL`)
                    VALUES (
                    "'.$tmp_activityid.'",
                    "'.$tmp_modifierid.'",
                    "'.crc32($tmp_modifierid).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID')).'",
                    "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'",
                    "'.self::$mysqli->real_escape_string($oUser->searchTruncStr($tmp_activitydescription, 1000)).'",
                    "'.self::$mysqli->real_escape_string($tmp_activitydescription).'",
                    "'.session_id().'",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "'.$_SERVER['HTTP_USER_AGENT'].'",
                    "D");';

                    //error_log(self::$query);

                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);
                    if(self::$mysqli->error){

                        self::$query_exception_result = "mini_overlay_select=error";
                        throw new Exception('jony5 database_integration :: '.$queryType.' ERROR :: ['.self::$mysqli->error.']');

                    }else {
                        return 'success';
                    }

                    break;
                case 'new_fullscreen_profile':
                    /*
                     * self::$http_param_handle["PROFILE_NAME"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'profilename');
                        self::$http_param_handle["PAGE_HEADER"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'pagehdr');
                        self::$http_param_handle["PAGE_TITLE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'pagetitle');
                        self::$http_param_handle["PAGE_CODE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'pagecode');
                        self::$http_param_handle["FONT_SIZE"] = self::$oEnv->oHTTP_MGR->extractData($_POST, 'fontsize');
                        self::$http_param_handle["LANG_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'lang_code'));

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

                    $tmp_activitydescription = "A new full screen overlay profile (<span class='a_log_topic_name'>".$oUser->retrieve_Form_Data('PROFILE_NAME')."</span>) has been created.";

                    self::$query = 'INSERT INTO `wthrbg_overlay_fullscrn_profile`
                    (`PROFILE_ID`,
                    `PROFILE_ID_CRC32`,
                    `PROFILE_NAME`,
                    `PROFILE_NAME_BLOB`,
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
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("PROFILE_NAME")).'",
                    "'.$tmp_creatorid.'",
                    INET_ATON("'.$_SERVER['REMOTE_ADDR'].'"),
                    "'.session_id().'",
                    "'.$tmp_modifierid.'",
                    INET_ATON("'.$_SERVER['REMOTE_ADDR'].'"),
                    "'.session_id().'",
                    "'.$ts.'");';

                    self::$query .= 'INSERT INTO `wthrbg_lang_copy`
                    (`COPY_ID`,
                    `PROFILE_ID`,
                    `PROFILE_TYPE`,
                    `LANG_ID`,
                    `FONT_SIZE`,
                    `PAGE_HEADER`,
                    `PAGE_HEADER_BLOB`,
                    `PAGE_TITLE`,
                    `PAGE_TITLE_BLOB`,
                    `PAGE00_CODE_BLOB`,
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

                    self::$query .= 'INSERT INTO `wthrbg_log_sys_user`
                    (`ACTIVITY_ID`,
                    `MODIFIER_ID`,
                    `MODIFIER_ID_CRC32`,
                    `FULL_SCRN_PROFILE_ID`,
                    `FULL_SCRN_PROFILE_ID_CRC32`,
                    `ACTIVITY_DESCRIPTION`,
                    `ACTIVITY_DESCRIPTION_BLOB`,
                    `PHPSESSION`,
                    `IPADDRESS_V6`,
                    `IPADDRESS`,
                    `HTTP_USER_AGENT`,
                    `CHANNEL`)
                    VALUES (
                    "'.$tmp_activityid.'",
                    "'.$tmp_modifierid.'",
                    "'.crc32($tmp_modifierid).'",
                    "'.self::$mysqli->real_escape_string($tmp_profileid).'",
                    "'.crc32($tmp_profileid).'",
                    "'.self::$mysqli->real_escape_string($oUser->searchTruncStr($tmp_activitydescription, 1000)).'",
                    "'.self::$mysqli->real_escape_string($tmp_activitydescription).'",
                    "'.session_id().'",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "'.$_SERVER['HTTP_USER_AGENT'].'",
                    "D");';

                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

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

                    $tmp_activitydescription = "A new mini overlay profile (<span class='a_log_topic_name'>".$oUser->retrieve_Form_Data('PROFILE_NAME')."</span>) has been created.";

                    /*
                    self::$query = 'INSERT INTO `wthrbg_overlay_mini_profile`
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
                    */

                    self::$query = 'INSERT INTO `wthrbg_overlay_mini_profile` 
                    (`PROFILE_ID`,`PROFILE_ID_CRC32`,`PROFILE_NAME`,`PROFILE_NAME_BLOB`,`OVERLAY_HEIGHT`,`OVERLAY_WIDTH`,`INNER_CONTENT_WIDTH`,`MARGIN_LEFT`,`MARGIN_RIGHT`,`ABS_PX_FROM_TOP`,`ABS_PX_FROM_LEFT`,`CREATOR_ID`,`CREATOR_IP`,`CREATOR_SESSION_ID`,`MODIFIER_ID`,`MODIFIER_IP`,`MODIFIER_SESSION_ID`,`DATEMODIFIED`)
                    VALUES (
                    "'.$tmp_profileid.'",
                    "'.crc32($tmp_profileid).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("PROFILE_NAME")).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("PROFILE_NAME")).'",
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

                    self::$query .= 'INSERT INTO `wthrbg_lang_copy`
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

                    self::$query .= 'INSERT INTO `wthrbg_log_sys_user`
                    (`ACTIVITY_ID`,
                    `MODIFIER_ID`,
                    `MODIFIER_ID_CRC32`,
                    `MINI_PROFILE_ID`,
                    `MINI_PROFILE_ID_CRC32`,
                    `ACTIVITY_DESCRIPTION`,
                    `ACTIVITY_DESCRIPTION_BLOB`,
                    `PHPSESSION`,
                    `IPADDRESS_V6`,
                    `IPADDRESS`,
                    `HTTP_USER_AGENT`,
                    `CHANNEL`)
                    VALUES (
                    "'.$tmp_activityid.'",
                    "'.$tmp_modifierid.'",
                    "'.crc32($tmp_modifierid).'",
                    "'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('PROFILE_ID')).'",
                    "'.crc32($oUser->retrieve_Form_Data('PROFILE_ID')).'",
                    "'.self::$mysqli->real_escape_string($oUser->searchTruncStr($tmp_activitydescription, 1000)).'",
                    "'.self::$mysqli->real_escape_string($tmp_activitydescription).'",
                    "'.session_id().'",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "'.$_SERVER['HTTP_USER_AGENT'].'",
                    "D");';

                    //error_log('2137 query->'.self::$query);

                    self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

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
                case 'get_overlay_mgmt_state_for_XML':

                    /*
                    LANG_PACKS [wthrbg_lang_packs]
                    FULLSCRN_PAGES
                    FULLSCRN_PROFILES
                    MINI_PROFILES
                    SYS_COLORS_HEX
                    COMPONENT_BULLETLIST
                    COMPONENT_BLIST_BULLETS
                    COMPONENT_PARAGRAPH
                    COMPONENT_SCHEDULE
                    COMPONENT_SCHED_DAY
                    COMPONENT_SCHED_EVENT
                    COMPONENT_SUBTITLE
                    PAGE_COMPONENTS [wthrbg_fullscrn_page_components]
                    LANG_ELEM_COMPONENTS [wthrbg_lang_elem_components]
                    */

                    $tmp_POST_ID = $oUser->returnNewElementID('POST_ID');

                    switch($tmp_POST_ID){
                        case 'obs_client_fullscrn_overlay_visibility':
                            $tmp_select_profile = 'FULL_OVERLAY_XML';

                            break;
                        default:
                            self::$query_exception_result = "get_overlay_mgmt_state_for_XML=error=Unknown switch(".$tmp_POST_ID.") case";
                            throw new Exception('jony5 database_integration :: '.$queryType.' ERROR :: [Unknown switch('.$tmp_POST_ID.') case provided.]');

                            break;
                    }

                    $force_profile_select_align = true;
                    $db_resp_process_serial = "!jesus_is_my_dear_lord!";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    $db_resp_serial_key = $oUser->return_serial_handle();         //$oUser->return_serial_handle();
                    //$db_resp_target_profiles = 'LANG_PACKS|FULLSCRN_PAGES|FULLSCRN_PROFILES|MINI_PROFILES|SYS_COLORS_HEX|COMPONENT_BULLETLIST|COMPONENT_BLIST_BULLETS|COMPONENT_PARAGRAPH|COMPONENT_SCHEDULE
                    //|COMPONENT_SCHED_DAY|COMPONENT_SUBTITLE|PAGE_COMPONENTS|LANG_ELEM_COMPONENTS';
                    //$db_resp_profile_field_cnt = '11|18|16|23|16|18|18|19|17|19|19|17|17|29';         # WOULD THIS BE THE BEST PLACE TO SPECIFY PROFILE FILED COUNT AS INDICATION OF QUERY RESULT PROFILE TYPE? AN UPDATE TO SQL=UPDATE HERE.

                    //$oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    //
                    // QUERY CONSTRUCTION
                    $tmp_SELECT_ARRAY = array();

                    switch($tmp_select_profile){
                        case 'FULL_OVERLAY_XML':
                            $db_resp_target_profiles = 'LANG_PACKS|FULLSCRN_PAGES|FULLSCRN_PROFILES|SYS_COLORS_HEX|COMPONENT_BULLETLIST|COMPONENT_BLIST_BULLETS|COMPONENT_PARAGRAPH|COMPONENT_SCHEDULE|COMPONENT_SCHED_DAY|COMPONENT_SCHED_EVENT|COMPONENT_SUBTITLE|PAGE_COMPONENTS|LANG_ELEM_COMPONENTS|OBS_CLIENTS|FULLSCRN_CONFIG|OVERLAY_STATE|LANG_REQUESTS|MINI_PROFILES';
                            $db_resp_profile_field_cnt = '11|19|18|16|18|18|19|17|19|19|17|17|29|26|12|27|14|25';

                            $oDB_RESP->initialize($db_resp_process_serial, $db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt,$force_profile_select_align);

                            break;
                        default:
                            self::$query_exception_result = "get_overlay_mgmt_state_for_XML=error=Unknown select profile switch(".$tmp_select_profile.") case";
                            throw new Exception('jony5 database_integration :: '.$queryType.' ERROR :: [Unknown select profile switch('.$tmp_select_profile.') case provided.]');

                            break;

                    }

                    switch($tmp_select_profile){
                        case 'FULL_OVERLAY_XML':

                            $dataAugmenter = $oUser->returnDataAugment('DATA_AUG_02');
                            $tmp_PROFILE_ID = $dataAugmenter->getData('FULLSCRN_PROFILE',0,'PROFILE_ID');
                            $tmp_OBSCLIENT_ID = $dataAugmenter->getData('OBS_CLIENT',0,'OBSCLIENT_ID');

                            //
                            // LANG_PACKS
                            $tmp_SELECT_ARRAY[0] = 'SELECT `wthrbg_lang_packs`.`LANGPACK_ID`,
                                `wthrbg_lang_packs`.`LANG_ID`,
                                `wthrbg_lang_packs`.`NAME`,
                                `wthrbg_lang_packs`.`NATIVE_NAME`,
                                `wthrbg_lang_packs`.`ISACTIVE`,
                                `wthrbg_lang_packs`.`RTL_FLAG`,
                                `wthrbg_lang_packs`.`FONT_SIZE_PERCENTAGE`,
                                `wthrbg_lang_packs`.`TIMER_FONT_SIZE_PERCENTAGE`,
                                `wthrbg_lang_packs`.`COPY_PADDING_TOP_PX`,
                                `wthrbg_lang_packs`.`DATEMODIFIED`,
                                `wthrbg_lang_packs`.`DATECREATED`
                            FROM `wthrbg_lang_packs`  WHERE `wthrbg_lang_packs`.`ISACTIVE`="1";
                            ';

                            // wthrbg_overlay_fullscrn_pages
                            //
                            // FULLSCRN_PAGES
                            $tmp_SELECT_ARRAY[1] = 'SELECT `wthrbg_overlay_fullscrn_pages`.`PAGE_ID`,
                                `wthrbg_overlay_fullscrn_pages`.`PROFILE_ID`,
                                `wthrbg_overlay_fullscrn_pages`.`ISACTIVE`,
                                `wthrbg_overlay_fullscrn_pages`.`PAGE_NAME`,
                                `wthrbg_overlay_fullscrn_pages`.`PAGE_NAME_BLOB`,
                                `wthrbg_overlay_fullscrn_pages`.`BGCOLOR_HEX`,
                                `wthrbg_overlay_fullscrn_pages`.`COPYCOLOR_HEX`,
                                `wthrbg_overlay_fullscrn_pages`.`OPACITY`,
                                `wthrbg_overlay_fullscrn_pages`.`SEQUENCE`,
                                `wthrbg_overlay_fullscrn_pages`.`CREATOR_ID`,
                                `wthrbg_overlay_fullscrn_pages`.`CREATOR_IP_V6`,
                                `wthrbg_overlay_fullscrn_pages`.`CREATOR_IP`,
                                `wthrbg_overlay_fullscrn_pages`.`CREATOR_SESSION_ID`,
                                `wthrbg_overlay_fullscrn_pages`.`MODIFIER_ID`,
                                `wthrbg_overlay_fullscrn_pages`.`MODIFIER_IP_V6`,
                                `wthrbg_overlay_fullscrn_pages`.`MODIFIER_IP`,
                                `wthrbg_overlay_fullscrn_pages`.`MODIFIER_SESSION_ID`,
                                `wthrbg_overlay_fullscrn_pages`.`DATEMODIFIED`,
                                `wthrbg_overlay_fullscrn_pages`.`DATECREATED`
                            FROM `wthrbg_overlay_fullscrn_pages` 
                            WHERE `wthrbg_overlay_fullscrn_pages`.`PROFILE_ID` = "'.$tmp_PROFILE_ID.'"
                            AND `wthrbg_overlay_fullscrn_pages`.`PROFILE_ID_CRC32`= "'.crc32($tmp_PROFILE_ID).'"
                            AND `wthrbg_overlay_fullscrn_pages`.`ISACTIVE` ="1"
                            ORDER BY `wthrbg_overlay_fullscrn_pages`.`SEQUENCE` DESC;
                            ';

                            // wthrbg_overlay_fullscrn_profile
                            //
                            // FULLSCRN_PROFILES
                            $tmp_SELECT_ARRAY[2] = 'SELECT `wthrbg_overlay_fullscrn_profile`.`PROFILE_ID`,
                                `wthrbg_overlay_fullscrn_profile`.`ISACTIVE`,
                                `wthrbg_overlay_fullscrn_profile`.`PROFILE_NAME`,
                                `wthrbg_overlay_fullscrn_profile`.`PROFILE_NAME_BLOB`,
                                `wthrbg_overlay_fullscrn_profile`.`DIR_XML_ENDPOINT`,
                                `wthrbg_overlay_fullscrn_profile`.`HTTP_XML_ENDPOINT`,
                                `wthrbg_overlay_fullscrn_profile`.`OPACITY`,
                                `wthrbg_overlay_fullscrn_profile`.`BGCOLOR_HEX`,
                                `wthrbg_overlay_fullscrn_profile`.`CREATOR_ID`,
                                `wthrbg_overlay_fullscrn_profile`.`CREATOR_IP_V6`,
                                `wthrbg_overlay_fullscrn_profile`.`CREATOR_IP`,
                                `wthrbg_overlay_fullscrn_profile`.`CREATOR_SESSION_ID`,
                                `wthrbg_overlay_fullscrn_profile`.`MODIFIER_ID`,
                                `wthrbg_overlay_fullscrn_profile`.`MODIFIER_IP_V6`,
                                `wthrbg_overlay_fullscrn_profile`.`MODIFIER_IP`,
                                `wthrbg_overlay_fullscrn_profile`.`MODIFIER_SESSION_ID`,
                                `wthrbg_overlay_fullscrn_profile`.`DATEMODIFIED`,
                                `wthrbg_overlay_fullscrn_profile`.`DATECREATED`
                            FROM `wthrbg_overlay_fullscrn_profile`
                            WHERE `wthrbg_overlay_fullscrn_profile`.`PROFILE_ID` = "'.$tmp_PROFILE_ID.'"
                            AND `wthrbg_overlay_fullscrn_profile`.`PROFILE_ID_CRC32`= "'.crc32($tmp_PROFILE_ID).'"
                            LIMIT 1;
                            ';

                            //
                            // SYS_COLORS_HEX
                            $tmp_SELECT_ARRAY[3] = 'SELECT `wthrbg_colors_hex`.`COLOR_ID`,
                                `wthrbg_colors_hex`.`COLOR_APPLICATION_KEY`,
                                `wthrbg_colors_hex`.`COLOR_HEX`,
                                `wthrbg_colors_hex`.`ISACTIVE`,
                                `wthrbg_colors_hex`.`COLOR_NAME`,
                                `wthrbg_colors_hex`.`COLOR_NAME_BLOB`,
                                `wthrbg_colors_hex`.`CREATOR_ID`,
                                `wthrbg_colors_hex`.`CREATOR_IP_V6`,
                                `wthrbg_colors_hex`.`CREATOR_IP`,
                                `wthrbg_colors_hex`.`CREATOR_SESSION_ID`,
                                `wthrbg_colors_hex`.`MODIFIER_ID`,
                                `wthrbg_colors_hex`.`MODIFIER_IP_V6`,
                                `wthrbg_colors_hex`.`MODIFIER_IP`,
                                `wthrbg_colors_hex`.`MODIFIER_SESSION_ID`,
                                `wthrbg_colors_hex`.`DATEMODIFIED`,
                                `wthrbg_colors_hex`.`DATECREATED`
                            FROM `wthrbg_colors_hex` WHERE `wthrbg_colors_hex`.`ISACTIVE`="1";
                            ';

                            //
                            // COMPONENT_BULLETLIST
                            $tmp_SELECT_ARRAY[4] = 'SELECT `wthrbg_component_bulletlist`.`BULLET_LIST_ID`,
                                `wthrbg_component_bulletlist`.`COMPONENT_ID`,
                                `wthrbg_component_bulletlist`.`PAGE_ID`,
                                `wthrbg_component_bulletlist`.`PROFILE_ID`,
                                `wthrbg_component_bulletlist`.`ISACTIVE`,
                                `wthrbg_component_bulletlist`.`ISORDERED`,
                                `wthrbg_component_bulletlist`.`BULLET_STYLE_ORDERED`,
                                `wthrbg_component_bulletlist`.`BULLET_STYLE_NOT_ORDERED`,
                                `wthrbg_component_bulletlist`.`CREATOR_ID`,
                                `wthrbg_component_bulletlist`.`CREATOR_IP_V6`,
                                `wthrbg_component_bulletlist`.`CREATOR_IP`,
                                `wthrbg_component_bulletlist`.`CREATOR_SESSION_ID`,
                                `wthrbg_component_bulletlist`.`MODIFIER_ID`,
                                `wthrbg_component_bulletlist`.`MODIFIER_IP_V6`,
                                `wthrbg_component_bulletlist`.`MODIFIER_IP`,
                                `wthrbg_component_bulletlist`.`MODIFIER_SESSION_ID`,
                                `wthrbg_component_bulletlist`.`DATEMODIFIED`,
                                `wthrbg_component_bulletlist`.`DATECREATED`
                            FROM `wthrbg_component_bulletlist`
                            WHERE `wthrbg_component_bulletlist`.`PROFILE_ID` = "'.$tmp_PROFILE_ID.'"
                            AND `wthrbg_component_bulletlist`.`PROFILE_ID_CRC32`= "'.crc32($tmp_PROFILE_ID).'"
                            AND `wthrbg_component_bulletlist`.`ISACTIVE` = "1";
                            ';

                            //
                            // COMPONENT_BLIST_BULLETS
                            $tmp_SELECT_ARRAY[5] = 'SELECT `wthrbg_component_bulletlist_bullets`.`BULLET_ID`,
                                `wthrbg_component_bulletlist_bullets`.`ELEMENT_ID`,
                                `wthrbg_component_bulletlist_bullets`.`COMPONENT_ID`,
                                `wthrbg_component_bulletlist_bullets`.`PAGE_ID`,
                                `wthrbg_component_bulletlist_bullets`.`PROFILE_ID`,
                                `wthrbg_component_bulletlist_bullets`.`ISACTIVE`,
                                `wthrbg_component_bulletlist_bullets`.`DESCRIPTION_IS_BOLD`,
                                `wthrbg_component_bulletlist_bullets`.`SEQUENCE`,
                                `wthrbg_component_bulletlist_bullets`.`CREATOR_ID`,
                                `wthrbg_component_bulletlist_bullets`.`CREATOR_IP_V6`,
                                `wthrbg_component_bulletlist_bullets`.`CREATOR_IP`,
                                `wthrbg_component_bulletlist_bullets`.`CREATOR_SESSION_ID`,
                                `wthrbg_component_bulletlist_bullets`.`MODIFIER_ID`,
                                `wthrbg_component_bulletlist_bullets`.`MODIFIER_IP_V6`,
                                `wthrbg_component_bulletlist_bullets`.`MODIFIER_IP`,
                                `wthrbg_component_bulletlist_bullets`.`MODIFIER_SESSION_ID`,
                                `wthrbg_component_bulletlist_bullets`.`DATEMODIFIED`,
                                `wthrbg_component_bulletlist_bullets`.`DATECREATED`
                            FROM `wthrbg_component_bulletlist_bullets`
                            WHERE `wthrbg_component_bulletlist_bullets`.`PROFILE_ID` = "'.$tmp_PROFILE_ID.'"
                            AND `wthrbg_component_bulletlist_bullets`.`PROFILE_ID_CRC32`= "'.crc32($tmp_PROFILE_ID).'"
                            AND `wthrbg_component_bulletlist_bullets`.`ISACTIVE` = "1"
                            ;
                            ';

                            //
                            // COMPONENT_PARAGRAPH
                            $tmp_SELECT_ARRAY[6] = 'SELECT `wthrbg_component_paragraph`.`PARAGRAPH_ID`,
                                `wthrbg_component_paragraph`.`ELEMENT_ID`,
                                `wthrbg_component_paragraph`.`COMPONENT_ID`,
                                `wthrbg_component_paragraph`.`PAGE_ID`,
                                `wthrbg_component_paragraph`.`PROFILE_ID`,
                                `wthrbg_component_paragraph`.`ISACTIVE`,
                                `wthrbg_component_paragraph`.`IS_BOLD`,
                                `wthrbg_component_paragraph`.`IS_BLOCKQUOTE`,
                                `wthrbg_component_paragraph`.`COPY_ALIGNMENT`,
                                `wthrbg_component_paragraph`.`CREATOR_ID`,
                                `wthrbg_component_paragraph`.`CREATOR_IP_V6`,
                                `wthrbg_component_paragraph`.`CREATOR_IP`,
                                `wthrbg_component_paragraph`.`CREATOR_SESSION_ID`,
                                `wthrbg_component_paragraph`.`MODIFIER_ID`,
                                `wthrbg_component_paragraph`.`MODIFIER_IP_V6`,
                                `wthrbg_component_paragraph`.`MODIFIER_IP`,
                                `wthrbg_component_paragraph`.`MODIFIER_SESSION_ID`,
                                `wthrbg_component_paragraph`.`DATEMODIFIED`,
                                `wthrbg_component_paragraph`.`DATECREATED`
                            FROM `wthrbg_component_paragraph`
                            WHERE `wthrbg_component_paragraph`.`PROFILE_ID` = "'.$tmp_PROFILE_ID.'"
                            AND `wthrbg_component_paragraph`.`PROFILE_ID_CRC32`= "'.crc32($tmp_PROFILE_ID).'"
                            AND `wthrbg_component_paragraph`.`ISACTIVE` = "1"
                            ;
                            ';

                            //
                            // COMPONENT_SCHEDULE
                            $tmp_SELECT_ARRAY[7] = 'SELECT `wthrbg_component_schedule`.`SCHEDULE_ID`,
                                `wthrbg_component_schedule`.`COMPONENT_ID`,
                                `wthrbg_component_schedule`.`PAGE_ID`,
                                `wthrbg_component_schedule`.`PROFILE_ID`,
                                `wthrbg_component_schedule`.`ISACTIVE`,
                                `wthrbg_component_schedule`.`DATE_FORMAT`,
                                `wthrbg_component_schedule`.`TIME_FORMAT`,
                                `wthrbg_component_schedule`.`CREATOR_ID`,
                                `wthrbg_component_schedule`.`CREATOR_IP_V6`,
                                `wthrbg_component_schedule`.`CREATOR_IP`,
                                `wthrbg_component_schedule`.`CREATOR_SESSION_ID`,
                                `wthrbg_component_schedule`.`MODIFIER_ID`,
                                `wthrbg_component_schedule`.`MODIFIER_IP_V6`,
                                `wthrbg_component_schedule`.`MODIFIER_IP`,
                                `wthrbg_component_schedule`.`MODIFIER_SESSION_ID`,
                                `wthrbg_component_schedule`.`DATEMODIFIED`,
                                `wthrbg_component_schedule`.`DATECREATED`
                            FROM `wthrbg_component_schedule`
                            WHERE `wthrbg_component_schedule`.`PROFILE_ID` = "'.$tmp_PROFILE_ID.'"
                            AND `wthrbg_component_schedule`.`PROFILE_ID_CRC32`= "'.crc32($tmp_PROFILE_ID).'";
                            ';

                            //
                            // COMPONENT_SCHED_DAY
                            $tmp_SELECT_ARRAY[8] = 'SELECT `wthrbg_component_schedule_day`.`DAY_ID`,
                                `wthrbg_component_schedule_day`.`COMPONENT_ID`,
                                `wthrbg_component_schedule_day`.`PAGE_ID`,
                                `wthrbg_component_schedule_day`.`PROFILE_ID`,
                                `wthrbg_component_schedule_day`.`DATE`,
                                `wthrbg_component_schedule_day`.`ISACTIVE`,
                                `wthrbg_component_schedule_day`.`DAY_DAY`,
                                `wthrbg_component_schedule_day`.`DAY_MONTH`,
                                `wthrbg_component_schedule_day`.`DAY_YEAR`,
                                `wthrbg_component_schedule_day`.`CREATOR_ID`,
                                `wthrbg_component_schedule_day`.`CREATOR_IP_V6`,
                                `wthrbg_component_schedule_day`.`CREATOR_IP`,
                                `wthrbg_component_schedule_day`.`CREATOR_SESSION_ID`,
                                `wthrbg_component_schedule_day`.`MODIFIER_ID`,
                                `wthrbg_component_schedule_day`.`MODIFIER_IP_V6`,
                                `wthrbg_component_schedule_day`.`MODIFIER_IP`,
                                `wthrbg_component_schedule_day`.`MODIFIER_SESSION_ID`,
                                `wthrbg_component_schedule_day`.`DATEMODIFIED`,
                                `wthrbg_component_schedule_day`.`DATECREATED`
                            FROM `wthrbg_component_schedule_day`
                            WHERE `wthrbg_component_schedule_day`.`PROFILE_ID` = "'.$tmp_PROFILE_ID.'"
                            AND `wthrbg_component_schedule_day`.`PROFILE_ID_CRC32`= "'.crc32($tmp_PROFILE_ID).'";
                            ';

                            //
                            // COMPONENT_SCHED_EVENT
                            $tmp_SELECT_ARRAY[9] = 'SELECT `wthrbg_component_schedule_event`.`EVENT_ID`,
                                `wthrbg_component_schedule_event`.`ELEMENT_ID`,
                                `wthrbg_component_schedule_event`.`DAY_ID`,
                                `wthrbg_component_schedule_event`.`COMPONENT_ID`,
                                `wthrbg_component_schedule_event`.`PAGE_ID`,
                                `wthrbg_component_schedule_event`.`PROFILE_ID`,
                                `wthrbg_component_schedule_event`.`DATE`,
                                `wthrbg_component_schedule_event`.`DESCRIPTION_IS_BOLD`,
                                `wthrbg_component_schedule_event`.`ISACTIVE`,
                                `wthrbg_component_schedule_event`.`CREATOR_ID`,
                                `wthrbg_component_schedule_event`.`CREATOR_IP_V6`,
                                `wthrbg_component_schedule_event`.`CREATOR_IP`,
                                `wthrbg_component_schedule_event`.`CREATOR_SESSION_ID`,
                                `wthrbg_component_schedule_event`.`MODIFIER_ID`,
                                `wthrbg_component_schedule_event`.`MODIFIER_IP_V6`,
                                `wthrbg_component_schedule_event`.`MODIFIER_IP`,
                                `wthrbg_component_schedule_event`.`MODIFIER_SESSION_ID`,
                                `wthrbg_component_schedule_event`.`DATEMODIFIED`,
                                `wthrbg_component_schedule_event`.`DATECREATED`
                            FROM `wthrbg_component_schedule_event`
                            WHERE `wthrbg_component_schedule_event`.`PROFILE_ID` = "'.$tmp_PROFILE_ID.'"
                            AND `wthrbg_component_schedule_event`.`PROFILE_ID_CRC32`= "'.crc32($tmp_PROFILE_ID).'";
                            ';

                            //
                            // COMPONENT_SUBTITLE
                            $tmp_SELECT_ARRAY[10] = 'SELECT `wthrbg_component_subtitle`.`SUBTITLE_ID`,
                                `wthrbg_component_subtitle`.`ELEMENT_ID`,
                                `wthrbg_component_subtitle`.`COMPONENT_ID`,
                                `wthrbg_component_subtitle`.`PAGE_ID`,
                                `wthrbg_component_subtitle`.`PROFILE_ID`,
                                `wthrbg_component_subtitle`.`ISACTIVE`,
                                `wthrbg_component_subtitle`.`COPY_ALIGNMENT`,
                                `wthrbg_component_subtitle`.`CREATOR_ID`,
                                `wthrbg_component_subtitle`.`CREATOR_IP_V6`,
                                `wthrbg_component_subtitle`.`CREATOR_IP`,
                                `wthrbg_component_subtitle`.`CREATOR_SESSION_ID`,
                                `wthrbg_component_subtitle`.`MODIFIER_ID`,
                                `wthrbg_component_subtitle`.`MODIFIER_IP_V6`,
                                `wthrbg_component_subtitle`.`MODIFIER_IP`,
                                `wthrbg_component_subtitle`.`MODIFIER_SESSION_ID`,
                                `wthrbg_component_subtitle`.`DATEMODIFIED`,
                                `wthrbg_component_subtitle`.`DATECREATED`
                            FROM `wthrbg_component_subtitle`
                            WHERE `wthrbg_component_subtitle`.`PROFILE_ID` = "'.$tmp_PROFILE_ID.'"
                            AND `wthrbg_component_subtitle`.`PROFILE_ID_CRC32`= "'.crc32($tmp_PROFILE_ID).'";
                            ';

                            //
                            // PAGE_COMPONENTS [wthrbg_fullscrn_page_components]
                            $tmp_SELECT_ARRAY[11] = 'SELECT `wthrbg_fullscrn_page_components`.`COMPONENT_ID`,
                                `wthrbg_fullscrn_page_components`.`PAGE_ID`,
                                `wthrbg_fullscrn_page_components`.`PROFILE_ID`,
                                `wthrbg_fullscrn_page_components`.`ISACTIVE`,
                                `wthrbg_fullscrn_page_components`.`COMPONENT_TYPE_KEY`,
                                `wthrbg_fullscrn_page_components`.`PAGE_SEQUENCE`,
                                `wthrbg_fullscrn_page_components`.`PROFILE_SEQUENCE`,
                                `wthrbg_fullscrn_page_components`.`CREATOR_ID`,
                                `wthrbg_fullscrn_page_components`.`CREATOR_IP_V6`,
                                `wthrbg_fullscrn_page_components`.`CREATOR_IP`,
                                `wthrbg_fullscrn_page_components`.`CREATOR_SESSION_ID`,
                                `wthrbg_fullscrn_page_components`.`MODIFIER_ID`,
                                `wthrbg_fullscrn_page_components`.`MODIFIER_IP_V6`,
                                `wthrbg_fullscrn_page_components`.`MODIFIER_IP`,
                                `wthrbg_fullscrn_page_components`.`MODIFIER_SESSION_ID`,
                                `wthrbg_fullscrn_page_components`.`DATEMODIFIED`,
                                `wthrbg_fullscrn_page_components`.`DATECREATED`
                            FROM `wthrbg_fullscrn_page_components`
                            WHERE `wthrbg_fullscrn_page_components`.`PROFILE_ID` = "'.$tmp_PROFILE_ID.'"
                            AND `wthrbg_fullscrn_page_components`.`PROFILE_ID_CRC32`= "'.crc32($tmp_PROFILE_ID).'"
                            ORDER BY `wthrbg_fullscrn_page_components`.`PAGE_SEQUENCE` DESC;
                            ';

                            //
                            // LANG_ELEM_COMPONENTS [wthrbg_lang_elem_components]
                            $tmp_SELECT_ARRAY[12] = 'SELECT `wthrbg_lang_elem_components`.`ELEMENT_ID`,
                                `wthrbg_lang_elem_components`.`COPY_ID`,
                                `wthrbg_lang_elem_components`.`COMPONENT_ID`,
                                `wthrbg_lang_elem_components`.`PAGE_ID`,
                                `wthrbg_lang_elem_components`.`PROFILE_ID`,
                                `wthrbg_lang_elem_components`.`COPY_HASH`,
                                `wthrbg_lang_elem_components`.`LANG_ID`,
                                `wthrbg_lang_elem_components`.`ISACTIVE`,
                                `wthrbg_lang_elem_components`.`IS_NATIVE_LANG`,
                                `wthrbg_lang_elem_components`.`SOURCE_LANG_ELEMENT_ID`,
                                `wthrbg_lang_elem_components`.`COMPLETION_STATE`,
                                `wthrbg_lang_elem_components`.`DRAFT_OWNER`,
                                `wthrbg_lang_elem_components`.`DATEDRAFTED`,
                                `wthrbg_lang_elem_components`.`DATEPUBLISHED`,
                                `wthrbg_lang_elem_components`.`PROFILE_TYPE`,
                                `wthrbg_lang_elem_components`.`COMPONENT_TYPE`,
                                `wthrbg_lang_elem_components`.`COMPONENT_SEQUENCE`,
                                `wthrbg_lang_elem_components`.`ELEMENT_CONTENT`,
                                `wthrbg_lang_elem_components`.`ELEMENT_CONTENT_BLOB`,
                                `wthrbg_lang_elem_components`.`CREATOR_ID`,
                                `wthrbg_lang_elem_components`.`CREATOR_IP_V6`,
                                `wthrbg_lang_elem_components`.`CREATOR_IP`,
                                `wthrbg_lang_elem_components`.`CREATOR_SESSION_ID`,
                                `wthrbg_lang_elem_components`.`MODIFIER_ID`,
                                `wthrbg_lang_elem_components`.`MODIFIER_IP_V6`,
                                `wthrbg_lang_elem_components`.`MODIFIER_IP`,
                                `wthrbg_lang_elem_components`.`MODIFIER_SESSION_ID`,
                                `wthrbg_lang_elem_components`.`DATEMODIFIED`,
                                `wthrbg_lang_elem_components`.`DATECREATED`
                            FROM `wthrbg_lang_elem_components`
                            WHERE `wthrbg_lang_elem_components`.`PROFILE_ID` = "'.$tmp_PROFILE_ID.'"
                            AND `wthrbg_lang_elem_components`.`PROFILE_ID_CRC32`= "'.crc32($tmp_PROFILE_ID).'";
                            ';

                            // wthrbg_obs_clients
                            //
                            // OBS_CLIENTS
                            $tmp_SELECT_ARRAY[13] = 'SELECT `wthrbg_obs_clients`.`OBSCLIENT_ID`,
                                `wthrbg_obs_clients`.`OBS_ID`,
                                `wthrbg_obs_clients`.`ISACTIVE`,
                                `wthrbg_obs_clients`.`FULLSCRN_PROFILE_ID`,
                                `wthrbg_obs_clients`.`MINI_PROFILE_ID`,
                                `wthrbg_obs_clients`.`OBS_ID_DISPLAY`,
                                `wthrbg_obs_clients`.`XML_INDEX_DIR_FILE_PATH`,
                                `wthrbg_obs_clients`.`ISVISIBLE_FULLSCRN`,
                                `wthrbg_obs_clients`.`ISVISIBLE_MINI`,
                                `wthrbg_obs_clients`.`MINI_DISPLAY_MODE`,
                                `wthrbg_obs_clients`.`CURRENT_WALL_TIME`,
                                `wthrbg_obs_clients`.`CURRENT_LANG_PACK_FULLSCRN`,
                                `wthrbg_obs_clients`.`CURRENT_LANG_PACK_MINI`,
                                `wthrbg_obs_clients`.`LAST_CONTACT`,
                                `wthrbg_obs_clients`.`FULLSCRN_VIEW_STATE`,
                                `wthrbg_obs_clients`.`MINI_VIEW_STATE`,
                                `wthrbg_obs_clients`.`CREATOR_ID`,
                                `wthrbg_obs_clients`.`CREATOR_IP_V6`,
                                `wthrbg_obs_clients`.`CREATOR_IP`,
                                `wthrbg_obs_clients`.`CREATOR_SESSION_ID`,
                                `wthrbg_obs_clients`.`MODIFIER_ID`,
                                `wthrbg_obs_clients`.`MODIFIER_IP_V6`,
                                `wthrbg_obs_clients`.`MODIFIER_IP`,
                                `wthrbg_obs_clients`.`MODIFIER_SESSION_ID`,
                                `wthrbg_obs_clients`.`DATEMODIFIED`,
                                `wthrbg_obs_clients`.`DATECREATED`
                            FROM `wthrbg_obs_clients` 
                            WHERE `wthrbg_obs_clients`.`OBSCLIENT_ID` = "'.$tmp_OBSCLIENT_ID.'"
                            LIMIT 1;
                            ';

                            //
                            // FULLSCRN_CONFIG
                            $tmp_SELECT_ARRAY[14] = 'SELECT `wthrbg_overlay_fullscrn_config`.`PAGE_ROTATION_SECS`,
                            `wthrbg_overlay_fullscrn_config`.`LANG_PACK_ROTATION_SECS`,
                            `wthrbg_overlay_fullscrn_config`.`DEFAULT_ABS_PX_FROM_TOP`,
                            `wthrbg_overlay_fullscrn_config`.`DEFAULT_MARGIN_LEFT`,
                            `wthrbg_overlay_fullscrn_config`.`DEFAULT_ABS_PX_FROM_LEFT`,
                            `wthrbg_overlay_fullscrn_config`.`DEFAULT_MARGIN_RIGHT`,
                            `wthrbg_overlay_fullscrn_config`.`DEFAULT_ABS_PX_FROM_RIGHT`,
                            `wthrbg_overlay_fullscrn_config`.`DEFAULT_WIDTH`,
                            `wthrbg_overlay_fullscrn_config`.`DEFAULT_HEIGHT`,
                            `wthrbg_overlay_fullscrn_config`.`DEFAULT_CONTENT_WIDTH`,
                            `wthrbg_overlay_fullscrn_config`.`DEFAULT_CONTENT_HEIGHT`,
                            `wthrbg_overlay_fullscrn_config`.`DATECREATED`
                            FROM `wthrbg_overlay_fullscrn_config` LIMIT 1;
                            ';

                            //
                            // OVERLAY_STATE
                            $tmp_SELECT_ARRAY[15] = 'SELECT `wthrbg_overlay_state`.`STATE_ID`,
                                `wthrbg_overlay_state`.`OBSCLIENT_ID`,
                                `wthrbg_overlay_state`.`OBS_ID`,
                                `wthrbg_overlay_state`.`INDEX_ENDPOINT`,
                                `wthrbg_overlay_state`.`MINI_STATE`,
                                `wthrbg_overlay_state`.`MINI_COPY_STATE`,
                                `wthrbg_overlay_state`.`MINI_TIMER_STATE`,
                                `wthrbg_overlay_state`.`MINI_PROFILE_ID`,
                                `wthrbg_overlay_state`.`MINI_PROFILE_HASH`,
                                `wthrbg_overlay_state`.`MINI_PROFILE_ENDPOINT`,
                                `wthrbg_overlay_state`.`MINI_LASTMODIFIED`,
                                `wthrbg_overlay_state`.`FULLSCREEN_STATE`,
                                `wthrbg_overlay_state`.`FULLSCREEN_COPY_STATE`,
                                `wthrbg_overlay_state`.`FULLSCREEN_PROFILE_ID`,
                                `wthrbg_overlay_state`.`FULLSCREEN_PROFILE_HASH`,
                                `wthrbg_overlay_state`.`FULLSCREEN_PROFILE_ENDPOINT`,
                                `wthrbg_overlay_state`.`FULLSCREEN_LASTMODIFIED`,
                                `wthrbg_overlay_state`.`CREATOR_ID`,
                                `wthrbg_overlay_state`.`CREATOR_IP_V6`,
                                `wthrbg_overlay_state`.`CREATOR_IP`,
                                `wthrbg_overlay_state`.`CREATOR_SESSION_ID`,
                                `wthrbg_overlay_state`.`MODIFIER_ID`,
                                INET6_NTOA(`wthrbg_overlay_state`.`MODIFIER_IP_V6`) AS MODIFIER_IP_V6,
                                INET_NTOA(`wthrbg_overlay_state`.`MODIFIER_IP`) AS MODIFIER_IP,
                                `wthrbg_overlay_state`.`MODIFIER_SESSION_ID`,
                                `wthrbg_overlay_state`.`DATEMODIFIED`,
                                `wthrbg_overlay_state`.`DATECREATED`
                                FROM `wthrbg_overlay_state` WHERE `wthrbg_overlay_state`.`OBSCLIENT_ID`="'.$tmp_OBSCLIENT_ID.'"                     
                                LIMIT 1;
                            ';

                            //error_log('11396 - OVERLAY_STATE.FULLSCREEN_LASTMODIFIED fails...->'.$tmp_SELECT_ARRAY[15]);

                            //wthrbg_profile_lang_requests
                            // LANG_REQUESTS
                            $tmp_SELECT_ARRAY[16] = 'SELECT `wthrbg_profile_lang_requests`.`REQUEST_ID`,
                                `wthrbg_profile_lang_requests`.`FULLSCRN_PROFILE_ID`,
                                `wthrbg_profile_lang_requests`.`LANG_ID`,
                                `wthrbg_profile_lang_requests`.`ISACTIVE`,
                                `wthrbg_profile_lang_requests`.`CREATOR_ID`,
                                `wthrbg_profile_lang_requests`.`CREATOR_IP_V6`,
                                `wthrbg_profile_lang_requests`.`CREATOR_IP`,
                                `wthrbg_profile_lang_requests`.`CREATOR_SESSION_ID`,
                                `wthrbg_profile_lang_requests`.`MODIFIER_ID`,
                                `wthrbg_profile_lang_requests`.`MODIFIER_IP_V6`,
                                `wthrbg_profile_lang_requests`.`MODIFIER_IP`,
                                `wthrbg_profile_lang_requests`.`MODIFIER_SESSION_ID`,
                                `wthrbg_profile_lang_requests`.`DATEMODIFIED`,
                                `wthrbg_profile_lang_requests`.`DATECREATED`
                            FROM `wthrbg_profile_lang_requests`
                            WHERE `wthrbg_profile_lang_requests`.`FULLSCRN_PROFILE_ID` = "'.$tmp_PROFILE_ID.'"
                            AND `wthrbg_profile_lang_requests`.`FULLSCRN_PROFILE_ID_CRC32`= "'.crc32($tmp_PROFILE_ID).'";
                            ';

                            //
                            // MINI_PROFILES
                            $tmp_SELECT_ARRAY[17] = 'SELECT `wthrbg_overlay_mini_profile`.`PROFILE_ID`,
                                `wthrbg_overlay_mini_profile`.`ISACTIVE`,
                                `wthrbg_overlay_mini_profile`.`PROFILE_NAME`,
                                `wthrbg_overlay_mini_profile`.`PROFILE_NAME_BLOB`,
                                `wthrbg_overlay_mini_profile`.`DIR_XML_ENDPOINT`,
                                `wthrbg_overlay_mini_profile`.`HTTP_XML_ENDPOINT`,
                                `wthrbg_overlay_mini_profile`.`OPACITY`,
                                `wthrbg_overlay_mini_profile`.`BGCOLOR_HEX`,
                                `wthrbg_overlay_mini_profile`.`OVERLAY_HEIGHT`,
                                `wthrbg_overlay_mini_profile`.`OVERLAY_WIDTH`,
                                `wthrbg_overlay_mini_profile`.`INNER_CONTENT_WIDTH`,
                                `wthrbg_overlay_mini_profile`.`MARGIN_LEFT`,
                                `wthrbg_overlay_mini_profile`.`MARGIN_RIGHT`,
                                `wthrbg_overlay_mini_profile`.`ABS_PX_FROM_TOP`,
                                `wthrbg_overlay_mini_profile`.`ABS_PX_FROM_LEFT`,
                                `wthrbg_overlay_mini_profile`.`CREATOR_ID`,
                                `wthrbg_overlay_mini_profile`.`CREATOR_IP_V6`,
                                `wthrbg_overlay_mini_profile`.`CREATOR_IP`,
                                `wthrbg_overlay_mini_profile`.`CREATOR_SESSION_ID`,
                                `wthrbg_overlay_mini_profile`.`MODIFIER_ID`,
                                `wthrbg_overlay_mini_profile`.`MODIFIER_IP_V6`,
                                `wthrbg_overlay_mini_profile`.`MODIFIER_IP`,
                                `wthrbg_overlay_mini_profile`.`MODIFIER_SESSION_ID`,
                                `wthrbg_overlay_mini_profile`.`DATEMODIFIED`,
                                `wthrbg_overlay_mini_profile`.`DATECREATED`
                            FROM `wthrbg_overlay_mini_profile`
                            WHERE `wthrbg_overlay_fullscrn_profile`.`ISACTIVE` = "1";
                            ';

                            break;
                        default:
                            self::$query_exception_result = "get_overlay_mgmt_state_for_XML=error=Unknown select profile switch(".$tmp_select_profile.") case";
                            throw new Exception('jony5 database_integration :: '.$queryType.' ERROR :: [Unknown select profile (query gen) switch('.$tmp_select_profile.') case provided.]');

                            break;

                    }

                    /*

                    //
                    // OVERLAY_MGMT
                    $tmp_SELECT_ARRAY[0] = 'SELECT `wthrbg_overlay_state`.`STATE_ID`,
                    `wthrbg_overlay_state`.`MINI_STATE`,
                    `wthrbg_overlay_state`.`MINI_COPY_STATE`,
                    `wthrbg_overlay_state`.`MINI_TIMER_STATE`,
                    `wthrbg_overlay_state`.`MINI_PROFILE_ID`,
                    `wthrbg_overlay_state`.`MINI_PROFILE_HASH`,
                    `wthrbg_overlay_state`.`MINI_PROFILE_ENDPOINT`,
                    `wthrbg_overlay_state`.`MINI_LASTMODIFIED`,
                    `wthrbg_overlay_state`.`FULLSCREEN_STATE`,
                    `wthrbg_overlay_state`.`FULLSCREEN_COPY_STATE`,
                    `wthrbg_overlay_state`.`FULLSCREEN_PROFILE_ID`,
                    `wthrbg_overlay_state`.`FULLSCREEN_PROFILE_HASH`,
                    `wthrbg_overlay_state`.`FULLSCREEN_PROFILE_ENDPOINT`,
                    `wthrbg_overlay_state`.`FULLSCREEN_LASTMODIFIED`,
                    `wthrbg_overlay_state`.`MODIFIER_ID`,
                    INET6_NTOA(`wthrbg_overlay_state`.`MODIFIER_IP_V6`) AS MODIFIER_IP_V6,
                    INET_NTOA(`wthrbg_overlay_state`.`MODIFIER_IP`) AS MODIFIER_IP,
                    `wthrbg_overlay_state`.`MODIFIER_SESSION_ID`,
                    `wthrbg_overlay_state`.`DATEMODIFIED`,
                    `wthrbg_overlay_state`.`DATECREATED`
                    FROM `wthrbg_overlay_state` WHERE `wthrbg_overlay_state`.`STATE_ID`="1" LIMIT 1;
                ';

                    //
                    // MINI_PROFILE
                    $tmp_SELECT_ARRAY[1] = 'SELECT `wthrbg_overlay_mini_profile`.`PROFILE_ID`,
                    `wthrbg_overlay_mini_profile`.`PROFILE_ID_CRC32`,
                    `wthrbg_overlay_mini_profile`.`ISACTIVE`,
                    `wthrbg_overlay_mini_profile`.`PROFILE_NAME`,
                    `wthrbg_overlay_mini_profile`.`PROFILE_NAME_BLOB`,
                    `wthrbg_overlay_mini_profile`.`OVERLAY_HEIGHT`,
                    `wthrbg_overlay_mini_profile`.`OVERLAY_WIDTH`,
                    `wthrbg_overlay_mini_profile`.`INNER_CONTENT_WIDTH`,
                    `wthrbg_overlay_mini_profile`.`MARGIN_LEFT`,
                    `wthrbg_overlay_mini_profile`.`MARGIN_RIGHT`,
                    `wthrbg_overlay_mini_profile`.`ABS_PX_FROM_TOP`,
                    `wthrbg_overlay_mini_profile`.`ABS_PX_FROM_LEFT`,
                    `wthrbg_overlay_mini_profile`.`CREATOR_ID`,
                    `wthrbg_overlay_mini_profile`.`CREATOR_IP`,
                    `wthrbg_overlay_mini_profile`.`CREATOR_SESSION_ID`,
                    `wthrbg_overlay_mini_profile`.`MODIFIER_ID`,
                    `wthrbg_overlay_mini_profile`.`MODIFIER_IP`,
                    `wthrbg_overlay_mini_profile`.`MODIFIER_SESSION_ID`,
                    `wthrbg_overlay_mini_profile`.`DATEMODIFIED`,
                    `wthrbg_overlay_mini_profile`.`DATECREATED`
                    FROM `wthrbg_overlay_mini_profile` WHERE `wthrbg_overlay_mini_profile`.`ISACTIVE`="1";
                ';

                    //
                    // MINI_CONFIG
                    $tmp_SELECT_ARRAY[2] = 'SELECT `wthrbg_overlay_mini_config`.`ID`,
                    `wthrbg_overlay_mini_config`.`OPACITY`,
                    `wthrbg_overlay_mini_config`.`HEXCOLOR`,
                    `wthrbg_overlay_mini_config`.`COPY_HEXCOLOR`,
                    `wthrbg_overlay_mini_config`.`TIMER_HEXCOLOR`,
                    `wthrbg_overlay_mini_config`.`LANG_PACK_ROTATION_SECS`,
                    `wthrbg_overlay_mini_config`.`DEFAULT_ABS_PX_FROM_TOP`,
                    `wthrbg_overlay_mini_config`.`DEFAULT_MARGIN_LEFT`,
                    `wthrbg_overlay_mini_config`.`DEFAULT_ABS_PX_FROM_LEFT`,
                    `wthrbg_overlay_mini_config`.`DEFAULT_MARGIN_RIGHT`,
                    `wthrbg_overlay_mini_config`.`DEFAULT_ABS_PX_FROM_RIGHT`,
                    `wthrbg_overlay_mini_config`.`DEFAULT_WIDTH`,
                    `wthrbg_overlay_mini_config`.`DEFAULT_HEIGHT`,
                    `wthrbg_overlay_mini_config`.`DEFAULT_CONTENT_WIDTH`,
                    `wthrbg_overlay_mini_config`.`COPY_DISPLAY_AREA_WIDTH_PX`,
                    `wthrbg_overlay_mini_config`.`COPY_DISPLAY_AREA_HEIGHT_PX`,
                    `wthrbg_overlay_mini_config`.`DATECREATED`
                    FROM `wthrbg_overlay_mini_config` LIMIT 1;
';

                    //
                    // FULLSCRN_CONFIG
                    $tmp_SELECT_ARRAY[3] = 'SELECT `wthrbg_overlay_fullscrn_config`.`OPACITY`,
                    `wthrbg_overlay_fullscrn_config`.`HEXCOLOR`,
                    `wthrbg_overlay_fullscrn_config`.`COPY_HEXCOLOR`,
                    `wthrbg_overlay_fullscrn_config`.`LANG_PACK_ROTATION_SECS`,
                    `wthrbg_overlay_fullscrn_config`.`DEFAULT_ABS_PX_FROM_TOP`,
                    `wthrbg_overlay_fullscrn_config`.`DEFAULT_MARGIN_LEFT`,
                    `wthrbg_overlay_fullscrn_config`.`DEFAULT_ABS_PX_FROM_LEFT`,
                    `wthrbg_overlay_fullscrn_config`.`DEFAULT_MARGIN_RIGHT`,
                    `wthrbg_overlay_fullscrn_config`.`DEFAULT_ABS_PX_FROM_RIGHT`,
                    `wthrbg_overlay_fullscrn_config`.`DEFAULT_WIDTH`,
                    `wthrbg_overlay_fullscrn_config`.`DEFAULT_HEIGHT`,
                    `wthrbg_overlay_fullscrn_config`.`DEFAULT_CONTENT_WIDTH`,
                    `wthrbg_overlay_fullscrn_config`.`DEFAULT_CONTENT_HEIGHT`,
                    `wthrbg_overlay_fullscrn_config`.`DATECREATED`
                    FROM `wthrbg_overlay_fullscrn_config` LIMIT 1;
';

                    //
                    // FULLSCRN_PROFILE
                    $tmp_SELECT_ARRAY[4] = 'SELECT `wthrbg_overlay_fullscrn_profile`.`PROFILE_ID`,
                        `wthrbg_overlay_fullscrn_profile`.`PROFILE_ID_CRC32`,
                        `wthrbg_overlay_fullscrn_profile`.`ISACTIVE`,
                        `wthrbg_overlay_fullscrn_profile`.`PROFILE_NAME`,
                        `wthrbg_overlay_fullscrn_profile`.`PROFILE_NAME_BLOB`,
                        `wthrbg_overlay_fullscrn_profile`.`CREATOR_ID`,
                        `wthrbg_overlay_fullscrn_profile`.`CREATOR_IP`,
                        `wthrbg_overlay_fullscrn_profile`.`CREATOR_SESSION_ID`,
                        `wthrbg_overlay_fullscrn_profile`.`MODIFIER_ID`,
                        `wthrbg_overlay_fullscrn_profile`.`MODIFIER_IP`,
                        `wthrbg_overlay_fullscrn_profile`.`MODIFIER_SESSION_ID`,
                        `wthrbg_overlay_fullscrn_profile`.`DATEMODIFIED`,
                        `wthrbg_overlay_fullscrn_profile`.`DATECREATED`
                    FROM `wthrbg_overlay_fullscrn_profile`  WHERE `wthrbg_overlay_fullscrn_profile`.`ISACTIVE`="1";

';

                    //
                    // LANG_PACKS
                    //
                    //
                    $tmp_SELECT_ARRAY[6] = 'SELECT `wthrbg_lang_copy`.`COPY_ID`,
                        `wthrbg_lang_copy`.`PROFILE_ID`,
                        `wthrbg_lang_copy`.`PROFILE_TYPE`,
                        `wthrbg_lang_copy`.`ISACTIVE`,
                        `wthrbg_lang_copy`.`LANG_ID`,
                        `wthrbg_lang_copy`.`FONT_SIZE`,
                        `wthrbg_lang_copy`.`MESSAGE_TITLE`,
                        `wthrbg_lang_copy`.`MESSAGE_TITLE_BLOB`,
                        `wthrbg_lang_copy`.`MESSAGE_NUMBER`,
                        `wthrbg_lang_copy`.`MESSAGE_NUMBER_BLOB`,
                        `wthrbg_lang_copy`.`CONFERENCE_TITLE`,
                        `wthrbg_lang_copy`.`CONFERENCE_TITLE_BLOB`,
                        `wthrbg_lang_copy`.`PAGE00_HEADER`,
                        `wthrbg_lang_copy`.`PAGE00_HEADER_BLOB`,
                        `wthrbg_lang_copy`.`PAGE00_TITLE`,
                        `wthrbg_lang_copy`.`PAGE00_TITLE_BLOB`,
                        `wthrbg_lang_copy`.`PAGE00_CODE_BLOB`,
                        `wthrbg_lang_copy`.`PAGE01_HEADER`,
                        `wthrbg_lang_copy`.`PAGE01_HEADER_BLOB`,
                        `wthrbg_lang_copy`.`PAGE01_TITLE`,
                        `wthrbg_lang_copy`.`PAGE01_TITLE_BLOB`,
                        `wthrbg_lang_copy`.`PAGE01_CODE_BLOB`,
                        `wthrbg_lang_copy`.`PAGE02_HEADER`,
                        `wthrbg_lang_copy`.`PAGE02_HEADER_BLOB`,
                        `wthrbg_lang_copy`.`PAGE02_TITLE`,
                        `wthrbg_lang_copy`.`PAGE02_TITLE_BLOB`,
                        `wthrbg_lang_copy`.`PAGE02_CODE_BLOB`,
                        `wthrbg_lang_copy`.`PAGE03_HEADER`,
                        `wthrbg_lang_copy`.`PAGE03_HEADER_BLOB`,
                        `wthrbg_lang_copy`.`PAGE03_TITLE`,
                        `wthrbg_lang_copy`.`PAGE03_TITLE_BLOB`,
                        `wthrbg_lang_copy`.`PAGE03_CODE_BLOB`,
                        `wthrbg_lang_copy`.`PAGE04_HEADER`,
                        `wthrbg_lang_copy`.`PAGE04_HEADER_BLOB`,
                        `wthrbg_lang_copy`.`PAGE04_TITLE`,
                        `wthrbg_lang_copy`.`PAGE04_TITLE_BLOB`,
                        `wthrbg_lang_copy`.`PAGE04_CODE_BLOB`,
                        `wthrbg_lang_copy`.`DATE_COPY`,
                        `wthrbg_lang_copy`.`DATE_COPY_BLOB`,
                        `wthrbg_lang_copy`.`CREATOR_ID`,
                        `wthrbg_lang_copy`.`CREATOR_IP`,
                        `wthrbg_lang_copy`.`CREATOR_SESSION_ID`,
                        `wthrbg_lang_copy`.`MODIFIER_ID`,
                        `wthrbg_lang_copy`.`MODIFIER_IP`,
                        `wthrbg_lang_copy`.`MODIFIER_SESSION_ID`,
                        `wthrbg_lang_copy`.`DATEMODIFIED`,
                        `wthrbg_lang_copy`.`DATECREATED`
                    FROM `wthrbg_lang_copy`  WHERE `wthrbg_lang_copy`.`ISACTIVE`="1";
                    ';
                     */

                    $oDB_RESP->process(self::$mysqli, $queryType, $tmp_SELECT_ARRAY);

                    //
                    // THIS METHOD PERFORMS A CUSTOM META UPDATE

                    // # LANG_PACKS
                    //        # FULLSCRN_PAGES
                    //        # FULLSCRN_PROFILES
                    //        # SYS_COLORS_HEX
                    //
                    //        # COMPONENT_BULLETLIST
                    //        # COMPONENT_BLIST_BULLETS
                    //        # COMPONENT_PARAGRAPH
                    //        # COMPONENT_SCHEDULE
                    //        # COMPONENT_SCHED_DAY
                    //        # COMPONENT_SCHED_EVENT
                    //        # COMPONENT_SUBTITLE
                    //        # PAGE_COMPONENTS
                    //
                    //        # LANG_ELEM_COMPONENTS
                    //        # OBS_CLIENTS
                    //        # FULLSCRN_CONFIG
                    //        # OVERLAY_STATE
                    //        # LANG_REQUESTS

                    // KEY BY ID FOR EASY EXTRACTION
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'FULLSCRN_PROFILES', 'PROFILE_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'LANG_PACKS', 'LANG_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'SYS_COLORS_HEX', 'COLOR_HEX');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'COMPONENT_SCHEDULE', 'COMPONENT_ID|SCHEDULE_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'LANG_ELEM_COMPONENTS', 'ELEMENT_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'COMPONENT_SUBTITLE', 'COMPONENT_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'COMPONENT_PARAGRAPH', 'COMPONENT_ID');
                    $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'MINI_PROFILES', 'PROFILE_ID');
                    //$oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'OVERLAY_STATE', 'OBSCLIENT_ID');
                    //$oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'COMPONENT_BULLETLIST', 'COMPONENT_ID');
                    //$oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'COMPONENT_BLIST_BULLETS', 'COMPONENT_ID');

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
            $oEnv->oMYSQLI_CONN_MGR->closeConnection(self::$mysqli);

            return self::$query_exception_result;
        }
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

    private function strip_underscore($str){
        #$string = 'The quick brown fox jumped over the lazy dog.';
        $patterns = array();
        $patterns[0] = "_";

        $replacements = array();
        $replacements[0] = ' ';

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

    private function xmlFileEndpointPrep($oDB_RESP, $serial_handle, $oUser, $type, $endpoint, $filetype){

        if($endpoint == '' || 1==1){

            //
            // WRITE PROFILE XML
            #YYYYMMDDHHMMSS_[PROFILE-NAME-SEARCH-CLEANED]_[FULL-MINI]_HASH(5).xml
            $tmp_filename_date = date('Ymdhis');
            $tmp_filename_hash = $oUser->generateNewKey(10);
            $tmp_path_profile_index_xml = 'common/xml/';
            $tmp_path_profile_xml = 'common/xml/_profile/';
            $tmp_profile_subdir = $oUser->returnOverlayDeepDir();

            if($type == 'full'){
                $dbresponse_key = 'FULLSCRN_PROFILES';

            }else{
                $dbresponse_key = 'MINI_PROFILES';

            }

            $tmp_filename_root = $this->search_FillerSanitize(strtolower($oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), $dbresponse_key, 'PROFILE_NAME')));

            $tmp_filename_profile = $tmp_filename_date . '_' . $tmp_filename_root . '_' . $type . '_' . $tmp_filename_hash . '.xml';
            $tmp_filename_index = $tmp_filename_date . '_' . $tmp_filename_root . '_' . $type . '_' . $tmp_filename_hash . '_index.xml';

            //$tmp_filename_index_DIR = $oUser->getEnvParam('DOCUMENT_ROOT') . $oUser->getEnvParam('DOCUMENT_ROOT_DIR') . '/' . $tmp_path_profile_index_xml . $tmp_filename_index;
            $tmp_filename_index_DIR = $tmp_path_profile_index_xml . $tmp_filename_index;

            //$tmp_filename_index_HTTP = $oUser->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oUser->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $tmp_path_profile_index_xml . $tmp_filename_profile;

            //$tmp_filename_profile_DIR = $oUser->getEnvParam('DOCUMENT_ROOT') . $oUser->getEnvParam('DOCUMENT_ROOT_DIR') . $tmp_profile_subdir . $tmp_filename_profile;
            //$tmp_filename_profile_HTTP = $oUser->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oUser->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . substr($tmp_profile_subdir, 1) . $tmp_filename_profile;
            $tmp_filename_profile_DIR = $tmp_profile_subdir . $tmp_filename_profile;
            $tmp_filename_profile_HTTP = substr($tmp_profile_subdir, 1) . $tmp_filename_profile;

            switch($filetype){
                case 'PROFILE_DIR_FILE':
                    $endpoint = $tmp_filename_profile_DIR;

                    break;
                case 'PROFILE_HTTP_FILE_ENDPOINT':
                    $endpoint = $tmp_filename_profile_HTTP;

                    break;
                case 'INDEX_DIR_FILE':
                    $endpoint = $tmp_filename_index_DIR;

                    break;
                case 'INDEX_HTTP_FILE_ENDPOINT':
                    //$endpoint = $tmp_filename_index_HTTP;

                    break;
            }

        }

        //error_log('RETURNED ENDPOINT FOR '.$filetype.' :: '.$endpoint);
        return $endpoint;

    }

    // $this->syncXML('full', $queryType, $oUser, $oEnv);
    private function syncXML($type, $postid, $oUser, $oEnv){
        try {

            $ts = date("Y-m-d H:i:s", time());
            $tmp_userid = $oEnv->oSESSION_MGR->getSessionParam('USERID');

            $oUser->collectNewElementID('POST_ID', $postid);
            $oUser->collectNewElementID('OVERLAY_TYPE', $type);

            switch($type) {
                case 'full':

                    //
                    // RETRIEVE DATA
                    $serial_handle = 'OVERLAY_DATUM';
                    $oDB_RESP = $oUser->getOverlayStateDatum($serial_handle);

                    break;
                case 'mini':

                    //
                    // RETRIEVE DATA
                    $serial_handle = 'OVERLAY_DATUM';
                    $oDB_RESP = $oUser->getOverlayStateDatum($serial_handle);

                    break;

            }

            # # # # #
            //
            // BUILD XML & FILE HANDLING PREPARATION
            // ARRAY['INDEX']['DIR_FILE'] = INDEX FILE DIR PATH; ARRAY['PROFILE']['DIR_FILE'] = PROFILE FILE DIR PATH
            // ARRAY['INDEX']['XML'] = INDEX XML; ARRAY['PROFILE']['XML'] = PROFILE XML
            // ARRAY['PROFILE']['PROFILE_ID']; ARRAY['PROFILE']['CONFIG_HASH']; ARRAY['PROFILE']['HTTP_FILE_ENDPOINT'];
            // ARRAY['INDEX']['CONFIG_HASH']; ARRAY['INDEX']['FILE_ENDPOINT'];
            $xml_output_ARRAY = array();

            //
            // CONFIRM FILE ENDPOINT INTEGRITY
            $xml_output_ARRAY['PROFILE']['DIR_FILE_ENDPOINT'] = $this->xmlFileEndpointPrep($oDB_RESP, $serial_handle, $oUser, $type, $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'FULLSCRN_PROFILES', 'DIR_XML_ENDPOINT'),'PROFILE_DIR_FILE');
            $xml_output_ARRAY['PROFILE']['HTTP_FILE_ENDPOINT'] = $this->xmlFileEndpointPrep($oDB_RESP, $serial_handle, $oUser, $type, $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'FULLSCRN_PROFILES', 'HTTP_XML_ENDPOINT'),'PROFILE_HTTP_FILE_ENDPOINT');
            $xml_output_ARRAY['INDEX']['DIR_FILE_ENDPOINT'] = $this->xmlFileEndpointPrep($oDB_RESP, $serial_handle, $oUser, $type, $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'OBS_CLIENTS', 'XML_INDEX_DIR_FILE_PATH'),'INDEX_DIR_FILE');

            //error_log('11897 - HTTP_FILE_ENDPOINT->'.$xml_output_ARRAY['PROFILE']['HTTP_FILE_ENDPOINT']);
            $xml_output_ARRAY = $oUser->buildXMLOutput($oDB_RESP, $serial_handle, $type, $xml_output_ARRAY);

            # # # # #
            //
            // BURN FILE - PROFILE
            if (file_exists($oUser->getEnvParam('DOCUMENT_ROOT').$oUser->getEnvParam('DOCUMENT_ROOT_DIR').'/'.$xml_output_ARRAY['PROFILE']['DIR_FILE_ENDPOINT'])) {
                //
                // DELETE THE FILE
                unlink($oUser->getEnvParam('DOCUMENT_ROOT').$oUser->getEnvParam('DOCUMENT_ROOT_DIR').'/'.$xml_output_ARRAY['PROFILE']['DIR_FILE_ENDPOINT']);

                //
                // UPDATE XML FILE WITH NEW DATA
                $file_handle = fopen($oUser->getEnvParam('DOCUMENT_ROOT').$oUser->getEnvParam('DOCUMENT_ROOT_DIR').'/'.$xml_output_ARRAY['PROFILE']['DIR_FILE_ENDPOINT'], 'a');
                $tmp_prof_xml_status = fwrite($file_handle, $xml_output_ARRAY['PROFILE']['XML']);
                fclose($file_handle);

            } else {

                //
                // UPDATE XML FILE WITH NEW DATA
                $file_handle = fopen($oUser->getEnvParam('DOCUMENT_ROOT').$oUser->getEnvParam('DOCUMENT_ROOT_DIR').'/'.$xml_output_ARRAY['PROFILE']['DIR_FILE_ENDPOINT'], 'a');
                $tmp_prof_xml_status = fwrite($file_handle, $xml_output_ARRAY['PROFILE']['XML']);
                fclose($file_handle);

            }

            if($tmp_prof_xml_status!== false){

                # # # # #
                //
                // BURN FILE - INDEX
                if (file_exists($oUser->getEnvParam('DOCUMENT_ROOT').$oUser->getEnvParam('DOCUMENT_ROOT_DIR').'/'.$xml_output_ARRAY['INDEX']['DIR_FILE_ENDPOINT'])) {
                    //
                    // DELETE THE FILE
                    unlink($oUser->getEnvParam('DOCUMENT_ROOT').$oUser->getEnvParam('DOCUMENT_ROOT_DIR').'/'.$xml_output_ARRAY['INDEX']['DIR_FILE_ENDPOINT']);

                    //
                    // UPDATE XML FILE WITH NEW DATA
                    $file_handle = fopen($oUser->getEnvParam('DOCUMENT_ROOT').$oUser->getEnvParam('DOCUMENT_ROOT_DIR').'/'.$xml_output_ARRAY['INDEX']['DIR_FILE_ENDPOINT'], 'a');
                    $tmp_index_xml_status = fwrite($file_handle, $xml_output_ARRAY['INDEX']['XML']);
                    fclose($file_handle);

                } else {

                    //
                    // UPDATE XML FILE WITH NEW DATA
                    $file_handle = fopen($oUser->getEnvParam('DOCUMENT_ROOT').$oUser->getEnvParam('DOCUMENT_ROOT_DIR').'/'.$xml_output_ARRAY['INDEX']['DIR_FILE_ENDPOINT'], 'a');
                    $tmp_index_xml_status = fwrite($file_handle, $xml_output_ARRAY['INDEX']['XML']);
                    fclose($file_handle);

                }

                if($tmp_index_xml_status!== false){

                    # # # # #
                    //
                    // UPDATE DATABASE
                    switch($type){
                        case 'full':

                            //
                            // SYNC DB STATE
                            self::$query = 'UPDATE `wthrbg_overlay_state` SET 
                            `FULLSCREEN_PROFILE_ID`= "' . $xml_output_ARRAY['PROFILE']['PROFILE_ID'] . '",
                            `FULLSCREEN_PROFILE_HASH` = "' . $xml_output_ARRAY['PROFILE']['CONFIG_HASH'] . '",
                            `FULLSCREEN_PROFILE_ENDPOINT` = "' . $xml_output_ARRAY['PROFILE']['HTTP_FILE_ENDPOINT'] . '",
                            `MODIFIER_ID` = "'.$tmp_userid.'",
                            `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_SESSION_ID` = "' . session_id() . '",
                            `FULLSCREEN_LASTMODIFIED` = "' . $ts . '" ,
                            `DATEMODIFIED`="' . $ts . '" 
                            WHERE `wthrbg_overlay_state`.`OBSCLIENT_ID`="'.$oUser->retrieve_Form_Data('OBSCLIENT_ID').'"
                            AND `wthrbg_overlay_state`.`OBSCLIENT_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data('OBSCLIENT_ID')).'"
                            LIMIT 1;';

                            self::$query .= 'UPDATE `wthrbg_obs_clients`
                            SET
                            `XML_INDEX_DIR_FILE_PATH` = "'.$xml_output_ARRAY['INDEX']['DIR_FILE_ENDPOINT'].'",
                            `MODIFIER_ID` = "'.$tmp_userid.'",
                            `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_SESSION_ID` = "' . session_id() . '",
                            `DATEMODIFIED` = "' . $ts . '"
                            WHERE `wthrbg_obs_clients`.`OBSCLIENT_ID` = "'.$oUser->retrieve_Form_Data('OBSCLIENT_ID').'" 
                            AND `wthrbg_obs_clients`.`OBSCLIENT_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data('OBSCLIENT_ID')).'"
                            LIMIT 1;
                            ';

                            self::$query .= 'UPDATE `wthrbg_overlay_fullscrn_profile`
                            SET
                            `DIR_XML_ENDPOINT` = "' . $xml_output_ARRAY['PROFILE']['DIR_FILE_ENDPOINT'] . '",
                            `HTTP_XML_ENDPOINT` = "' . $xml_output_ARRAY['PROFILE']['HTTP_FILE_ENDPOINT'] . '",
                            `MODIFIER_ID` = "'.$tmp_userid.'",
                            `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_SESSION_ID` = "' . session_id() . '",
                            `DATEMODIFIED` = "' . $ts . '"
                            WHERE `PROFILE_ID` = "' . $xml_output_ARRAY['PROFILE']['PROFILE_ID'] . '" 
                            AND `PROFILE_ID_CRC32` = "' . crc32($xml_output_ARRAY['PROFILE']['PROFILE_ID']) . '" LIMIT 1;
                            ';

                            self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                            if (self::$mysqli->error) {
                                throw new Exception('AV Service database_integration :: FULLSCREEN OVERLAY XML-DB SYNC ERROR :: [' . self::$mysqli->error . ']');
                            }

                            break;
                        case 'mini':

                            //
                            // SYNC DB STATE
                            self::$query = 'UPDATE `wthrbg_overlay_state` SET 
                            `MINI_PROFILE_ID`="' . $xml_output_ARRAY['PROFILE']['PROFILE_ID'] . '",
                            `MINI_PROFILE_HASH` = "' . $xml_output_ARRAY['PROFILE']['CONFIG_HASH'] . '",
                            `MINI_PROFILE_ENDPOINT` = "' . $xml_output_ARRAY['PROFILE']['HTTP_FILE_ENDPOINT'] . '",
                            `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_SESSION_ID` = "' . session_id() . '",
                            `MINI_LASTMODIFIED` = "' . $ts . '" ,
                            `DATEMODIFIED`="' . $ts . '" 
                            WHERE `wthrbg_overlay_state`.`OBSCLIENT_ID`="'.$oUser->retrieve_Form_Data('OBSCLIENT_ID').'"
                            AND `wthrbg_overlay_state`.`OBSCLIENT_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data('OBSCLIENT_ID')).'"
                            LIMIT 1;';

                            self::$query .= 'UPDATE `wthrbg_obs_clients`
                            SET
                            `XML_INDEX_DIR_FILE_PATH` = "'.$xml_output_ARRAY['INDEX']['DIR_FILE'].'",
                            `MODIFIER_ID` = "'.$tmp_userid.'",
                            `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_SESSION_ID` = "' . session_id() . '",
                            `DATEMODIFIED` = "' . $ts . '"
                            WHERE `wthrbg_obs_clients`.`OBSCLIENT_ID` = "'.$oUser->retrieve_Form_Data('OBSCLIENT_ID').'" 
                            AND `wthrbg_obs_clients`.`OBSCLIENT_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data('OBSCLIENT_ID')).'"
                            LIMIT 1;
                            ';

                            self::$query .= 'UPDATE `wthrbg_overlay_mini_profile`
                            SET
                            `DIR_XML_ENDPOINT` = ' . $xml_output_ARRAY['PROFILE']['DIR_FILE_ENDPOINT'] . ',
                            `HTTP_XML_ENDPOINT` = ' . $xml_output_ARRAY['PROFILE']['HTTP_FILE_ENDPOINT'] . ',
                            `MODIFIER_ID` = "'.$tmp_userid.'",
                            `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            `MODIFIER_SESSION_ID` = "' . session_id() . '",
                            `DATEMODIFIED` = "' . $ts . '"
                            WHERE `PROFILE_ID` = "' . $xml_output_ARRAY['PROFILE']['PROFILE_ID'] . '" 
                            AND `PROFILE_ID_CRC32` = "' . crc32($xml_output_ARRAY['PROFILE']['PROFILE_ID']) . '" LIMIT 1;
                            ';

                            self::$mysqli = $oEnv->oMYSQLI_CONN_MGR->processMultiQuery(self::$mysqli, self::$query);

                            if (self::$mysqli->error) {
                                throw new Exception('AV Service database_integration :: MINI OVERLAY XML-DB SYNC ERROR :: [' . self::$mysqli->error . ']');
                            }

                            break;

                    }

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unable to build overlay index XML output file :: '.$xml_output_ARRAY['INDEX']['DIR_FILE']);

                }

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to build overlay profile XML output file :: '.$xml_output_ARRAY['PROFILE']['DIR_FILE']);

            }

            //
            // WE DONE, BRO
            return true;


            //
            // INITIALIZE & CLOSE CLIENT NODE
            $xmlFileNEW = ('<?xml version="1.0" encoding="UTF-8"?><obs_overlay_profile><profile>');
            $xmlFileCLOSE = ('</profile></obs_overlay_profile>');
            $xmlIndexFileNEW = ('<?xml version="1.0" encoding="iso-8859-1"?><obs_overlay_profile_index><profile_index>');
            $xmlIndexFileCLOSE = ('</profile_index></obs_overlay_profile_index>');

            $tmp_XML_LANG_PACKS_A = ('<lang_pack_translations>');
            $tmp_XML_LANG_PACKS_Z = ('</lang_pack_translations>');
            $xmlProfile_OUTPUT = ('');
            $tmp_path_profile_index_xml = 'common/xml/';
            $tmp_path_profile_xml = 'common/xml/_profiles/';

            $xmlProfile_OUTPUT = $xmlProfile_OUTPUT . $xmlFileNEW;

            switch ($type) {
                case 'full':

                    $tmp_PROFILE_ID = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PROFILES', 'PROFILE_ID');
                    $tmp_master_overlay_visible_BOOL = $this->int_to_string_BOOL_conversion($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENTS', 'ISVISIBLE_FULLSCRN'));
                    //$tmp_copy_overlay_visible_BOOL = $this->int_to_string_BOOL_conversion($oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'OBS_CLIENTS', 'FULLSCREEN_COPY_STATE'));

                    //error_log('Profile ID->'.$tmp_PROFILE_ID.' AND VISIBILITY='.$tmp_master_overlay_visible_BOOL);
                    return true;

                    //$tmp_pid = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'FULLSCREEN_PROFILE_ID');
                    $tmp_lastmodified_FULL = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENTS', 'FULLSCREEN_LASTMODIFIED');
                    //$tmp_lastmodified_MINI = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENTS', 'MINI_LASTMODIFIED');

                    $tmp_master_overlay_display_area_width_in_px = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'DEFAULT_WIDTH');
                    $tmp_master_overlay_display_area_height_in_px = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'DEFAULT_HEIGHT');
                    $tmp_copy_display_area_width_in_px = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'DEFAULT_CONTENT_WIDTH');
                    $tmp_copy_display_area_height_in_px = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'DEFAULT_CONTENT_HEIGHT');
                    $tmp_master_overlay_bgcolor = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'HEXCOLOR');
                    $tmp_master_overlay_bgopacity = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'OPACITY');
                    $tmp_overlay_copy_color = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'COPY_HEXCOLOR');
                    $tmp_lang_pack_rotation_interval_secs = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'LANG_PACK_ROTATION_SECS');
                    $tmp_name = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PROFILE', $tmp_pid, 'PROFILE_NAME');

                    $tmp_XML_out_section_A = ('<pid>' . $tmp_PROFILE_ID . '</pid>
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

                    $xmlProfile_OUTPUT = $xmlProfile_OUTPUT . $tmp_XML_out_section_A . $tmp_XML_LANG_PACKS_A;

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
                                    $tmp_copy00_fullscrn_body = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'PAGE00_CODE_BLOB', $ii);
                                    $tmp_copy01_fullscrn_body = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'PAGE01_CODE_BLOB', $ii);
                                    $tmp_copy02_fullscrn_body = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'PAGE02_CODE_BLOB', $ii);
                                    $tmp_copy03_fullscrn_body = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'PAGE03_CODE_BLOB', $ii);
                                    $tmp_copy04_fullscrn_body = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'PAGE04_CODE_BLOB', $ii);

                                    $tmp_copy_fullscrn_font_size_percentage = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_IDS', 'FONT_SIZE_PERCENTAGE', $i);

                                    $tmp_lang_hash = hash('sha1', $tmp_copy_fullscrn_header . $tmp_copy_fullscrn_title . $tmp_copy00_fullscrn_body.$tmp_copy01_fullscrn_body.$tmp_copy02_fullscrn_body.$tmp_copy03_fullscrn_body.$tmp_copy04_fullscrn_body.$tmp_copy_fullscrn_font_size_percentage);

                                    /*
                                     <lang_pack>
                                        <lang_id>en</lang_id>
                                        <overlay_pages>
                                            <page>
                                                <header><![CDATA[]]></header>
                                                <title><![CDATA[]]></title>
                                                <content_body><![CDATA[]]></content_body>
                                                <font_size_percentage></font_size_percentage>
                                                <bgcolor></bgcolor>
                                                <bgopacity></bgopacity>
                                                <copycolor></copycolor>
                                                <page_sequence></page_sequence>
                                                <cleartext_endpoint>NULL</cleartext_endpoint>
                                                <content_hash></content_hash>
                                            </page>
                                            <page></page>
                                            <page></page>
                                            <page></page>
                                        </overlay_pages>
                                    </lang_pack>
                                     */

                                    $tmp_XML_out_LANG_PACK = ('
                        <lang_pack>
                            <lang_id>' . $tmp_LANG_ID . '</lang_id>
                            <copy_fullscrn_header><![CDATA[' . $tmp_copy_fullscrn_header . ']]></copy_fullscrn_header>
                            <copy_fullscrn_title><![CDATA[' . $tmp_copy_fullscrn_title . ']]></copy_fullscrn_title>
                            <copy00_fullscrn_body><![CDATA[<div class="cb_20"></div>' . $tmp_copy00_fullscrn_body . ']]></copy00_fullscrn_body>
                            <copy01_fullscrn_body><![CDATA[<div class="cb_20"></div>' . $tmp_copy01_fullscrn_body . ']]></copy01_fullscrn_body>
                            <copy02_fullscrn_body><![CDATA[<div class="cb_20"></div>' . $tmp_copy02_fullscrn_body . ']]></copy02_fullscrn_body>
                            <copy03_fullscrn_body><![CDATA[<div class="cb_20"></div>' . $tmp_copy03_fullscrn_body . ']]></copy03_fullscrn_body>
                            <copy04_fullscrn_body><![CDATA[<div class="cb_20"></div>' . $tmp_copy04_fullscrn_body . ']]></copy04_fullscrn_body>
                            <copy_fullscrn_font_size_percentage>' . $tmp_copy_fullscrn_font_size_percentage . '</copy_fullscrn_font_size_percentage>
                            <cleartext_endpoint>NULL</cleartext_endpoint>
                            <copy_hash>' . $tmp_lang_hash . '</copy_hash>
                        </lang_pack>');

                                    $xmlProfile_OUTPUT = $xmlProfile_OUTPUT . $tmp_XML_out_LANG_PACK;
                                }
                            }

                        }
                    }

                    $tmp_doc_hash = hash('sha1', $xmlProfile_OUTPUT);

                    $tmp_XML_hash = ('<config_hash>' . $tmp_doc_hash . '</config_hash>');

                    $xmlProfile_OUTPUT = $xmlProfile_OUTPUT . $tmp_XML_LANG_PACKS_Z . $tmp_XML_hash . $xmlFileCLOSE;

                    $tmp_profile_hash = hash('sha1', $xmlProfile_OUTPUT);

                    //error_log('2651 XML FULL-> '.$xmlProfile_OUTPUT);

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
                        $tmp_prof_xml_status = fwrite($file_handle, $xmlProfile_OUTPUT);
                        fclose($file_handle);

                    } else {
                        //
                        // UPDATE XML FILE WITH NEW DATA
                        $file_handle = fopen($tmp_filename_profile_PATH, 'a');
                        $tmp_prof_xml_status = fwrite($file_handle, $xmlProfile_OUTPUT);
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

                        $xmlProfile_OUTPUT = $xmlIndexFileNEW . $tmp_XML_DELTA_PROFILE_INDEX;

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

                        $xmlProfile_OUTPUT = $xmlProfile_OUTPUT . $tmp_XML_DELTA_PROFILE_INDEX . $xmlIndexFileCLOSE;

                        if (file_exists($tmp_filename_index)) {
                            //
                            // DELETE THE FILE
                            unlink($tmp_filename_index);

                            //
                            // UPDATE XML FILE WITH NEW DATA
                            $file_handle = fopen($tmp_filename_index, 'a');
                            $tmp_prof_xml_status = fwrite($file_handle, $xmlProfile_OUTPUT);
                            fclose($file_handle);

                        } else {
                            //
                            // UPDATE XML FILE WITH NEW DATA
                            $file_handle = fopen($tmp_filename_index, 'a');
                            $tmp_prof_xml_status = fwrite($file_handle, $xmlProfile_OUTPUT);
                            fclose($file_handle);

                        }

                    } else {

                        return false;

                    }

                    if ($tmp_prof_xml_status !== false) {
                        /*
    CREATE TABLE `wthrbg_overlay_state` (
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
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='View state of overlay compon
                        */

                        //
                        // SYNC DB STATE
                        self::$query = 'UPDATE `wthrbg_overlay_state` SET `FULLSCREEN_PROFILE_ID`="' . $tmp_pid . '",
                       `FULLSCREEN_PROFILE_HASH` = "' . $tmp_profile_hash . '",
                       `FULLSCREEN_PROFILE_ENDPOINT` = "' . $tmp_filename_profile_HTTP . '",
                       `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                       `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        `MODIFIER_SESSION_ID` = "' . session_id() . '",
                        `FULLSCREEN_LASTMODIFIED` = "' . $ts . '" ,
                        `DATEMODIFIED`="' . $ts . '" 
					     LIMIT 1;';

                        self::$result = $oEnv->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
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

                    $xmlProfile_OUTPUT = $xmlProfile_OUTPUT.$tmp_XML_out_section_A.$tmp_XML_LANG_PACKS_A;

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
                                 * `wthrbg_lang_copy`.`MESSAGE_TITLE`,
                                                        `wthrbg_lang_copy`.`MESSAGE_TITLE_BLOB`,
                                                        `wthrbg_lang_copy`.`MESSAGE_NUMBER`,
                                                        `wthrbg_lang_copy`.`MESSAGE_NUMBER_BLOB`,
                                                        `wthrbg_lang_copy`.`CONFERENCE_TITLE`,
                                                        `wthrbg_lang_copy`.`CONFERENCE_TITLE_BLOB`,
                                                        `wthrbg_lang_copy`.`PAGE_HEADER`,
                                                        `wthrbg_lang_copy`.`PAGE_HEADER_BLOB`,
                                                        `wthrbg_lang_copy`.`PAGE_TITLE`,
                                                        `wthrbg_lang_copy`.`PAGE_TITLE_BLOB`,
                                                        `wthrbg_lang_copy`.`PAGE00_CODE_BLOB`,
                                                        `wthrbg_lang_copy`.`DATE_COPY`,
                                                        `wthrbg_lang_copy`.`DATE_COPY_BLOB`,
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

                                    $xmlProfile_OUTPUT = $xmlProfile_OUTPUT . $tmp_XML_out_LANG_PACK;
                                }
                            }

                        }
                    }

                    $tmp_doc_hash = hash('sha1', $xmlProfile_OUTPUT);

                    $tmp_XML_hash = ('<config_hash>' . $tmp_doc_hash . '</config_hash>');

                    $xmlProfile_OUTPUT = $xmlProfile_OUTPUT . $tmp_XML_LANG_PACKS_Z . $tmp_XML_hash . $xmlFileCLOSE;

                    $tmp_profile_hash = hash('sha1', $xmlProfile_OUTPUT);

                    //error_log('2781 XML MINI-> '.$xmlProfile_OUTPUT);

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
                        $tmp_prof_xml_status = fwrite($file_handle, $xmlProfile_OUTPUT);
                        fclose($file_handle);

                    } else {

                        //
                        // UPDATE XML FILE WITH NEW DATA
                        $file_handle = fopen($tmp_filename_profile_PATH, 'a');
                        $tmp_prof_xml_status = fwrite($file_handle, $xmlProfile_OUTPUT);
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

                        $xmlProfile_OUTPUT = $xmlIndexFileNEW . $tmp_XML_DELTA_PROFILE_INDEX;

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

                        $xmlProfile_OUTPUT = $xmlProfile_OUTPUT . $tmp_XML_DELTA_PROFILE_INDEX . $xmlIndexFileCLOSE;

                        if (file_exists($tmp_filename_index)) {
                            //
                            // DELETE THE FILE
                            unlink($tmp_filename_index);

                            //
                            // UPDATE XML FILE WITH NEW DATA
                            $file_handle = fopen($tmp_filename_index, 'a');
                            $tmp_prof_xml_status = fwrite($file_handle, $xmlProfile_OUTPUT);
                            fclose($file_handle);

                        } else {
                            //
                            // UPDATE XML FILE WITH NEW DATA
                            $file_handle = fopen($tmp_filename_index, 'a');
                            $tmp_prof_xml_status = fwrite($file_handle, $xmlProfile_OUTPUT);
                            fclose($file_handle);

                        }

                    } else {

                        return false;

                    }

                    if ($tmp_prof_xml_status !== false) {
                        //
                        // SYNC DB STATE
                        self::$query = 'UPDATE `wthrbg_overlay_state` SET `MINI_PROFILE_ID`="' . $tmp_pid . '",
                       `MINI_PROFILE_HASH` = "' . $tmp_profile_hash . '",
                       `MINI_PROFILE_ENDPOINT` = "' . $tmp_filename_profile_HTTP . '",
                       `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                       `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        `MODIFIER_SESSION_ID` = "' . session_id() . '",
                        `MINI_LASTMODIFIED` = "' . $ts . '" ,
                        `DATEMODIFIED`="' . $ts . '" 
					     LIMIT 1;';

                        self::$result = $oEnv->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);

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


    // $this->syncXML('full', $queryType, $oUser, $oEnv);
    private function syncXML_OLD($type, $postid, $oUser, $oEnv)
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
            $xmlProfile_OUTPUT = ('');
            $tmp_path_profile_index_xml = 'common/xml/';
            $tmp_path_profile_xml = 'common/xml/_profiles/';

            $xmlProfile_OUTPUT = $xmlProfile_OUTPUT . $xmlFileNEW;

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

                    $xmlProfile_OUTPUT = $xmlProfile_OUTPUT . $tmp_XML_out_section_A . $tmp_XML_LANG_PACKS_A;

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
                                    $tmp_copy00_fullscrn_body = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'PAGE00_CODE_BLOB', $ii);
                                    $tmp_copy01_fullscrn_body = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'PAGE01_CODE_BLOB', $ii);
                                    $tmp_copy02_fullscrn_body = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'PAGE02_CODE_BLOB', $ii);
                                    $tmp_copy03_fullscrn_body = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'PAGE03_CODE_BLOB', $ii);
                                    $tmp_copy04_fullscrn_body = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'PAGE04_CODE_BLOB', $ii);

                                    $tmp_copy_fullscrn_font_size_percentage = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_IDS', 'FONT_SIZE_PERCENTAGE', $i);

                                    $tmp_lang_hash = hash('sha1', $tmp_copy_fullscrn_header . $tmp_copy_fullscrn_title . $tmp_copy00_fullscrn_body.$tmp_copy01_fullscrn_body.$tmp_copy02_fullscrn_body.$tmp_copy03_fullscrn_body.$tmp_copy04_fullscrn_body.$tmp_copy_fullscrn_font_size_percentage);

                                    /*
                                     <lang_pack>
                                        <lang_id>en</lang_id>
                                        <overlay_pages>
                                            <page>
                                                <copy_fullscrn_header><![CDATA[]]></copy_fullscrn_header>
                                                <copy_fullscrn_title><![CDATA[]]></copy_fullscrn_title>
                                                <copy_fullscrn_body><![CDATA[]]></copy_fullscrn_body>
                                                <copy_fullscrn_font_size_percentage></copy_fullscrn_font_size_percentage>
                                                <cleartext_endpoint>NULL</cleartext_endpoint>
                                                <copy_hash></copy_hash>
                                            </page>
                                            <page></page>
                                            <page></page>
                                            <page></page>
                                        </overlay_pages>
                                    </lang_pack>
                                     * */

                                    $tmp_XML_out_LANG_PACK = ('
                        <lang_pack>
                            <lang_id>' . $tmp_LANG_ID . '</lang_id>
                            <copy_fullscrn_header><![CDATA[' . $tmp_copy_fullscrn_header . ']]></copy_fullscrn_header>
                            <copy_fullscrn_title><![CDATA[' . $tmp_copy_fullscrn_title . ']]></copy_fullscrn_title>
                            <copy00_fullscrn_body><![CDATA[<div class="cb_20"></div>' . $tmp_copy00_fullscrn_body . ']]></copy00_fullscrn_body>
                            <copy01_fullscrn_body><![CDATA[<div class="cb_20"></div>' . $tmp_copy01_fullscrn_body . ']]></copy01_fullscrn_body>
                            <copy02_fullscrn_body><![CDATA[<div class="cb_20"></div>' . $tmp_copy02_fullscrn_body . ']]></copy02_fullscrn_body>
                            <copy03_fullscrn_body><![CDATA[<div class="cb_20"></div>' . $tmp_copy03_fullscrn_body . ']]></copy03_fullscrn_body>
                            <copy04_fullscrn_body><![CDATA[<div class="cb_20"></div>' . $tmp_copy04_fullscrn_body . ']]></copy04_fullscrn_body>
                            <copy_fullscrn_font_size_percentage>' . $tmp_copy_fullscrn_font_size_percentage . '</copy_fullscrn_font_size_percentage>
                            <cleartext_endpoint>NULL</cleartext_endpoint>
                            <copy_hash>' . $tmp_lang_hash . '</copy_hash>
                        </lang_pack>');

                                    $xmlProfile_OUTPUT = $xmlProfile_OUTPUT . $tmp_XML_out_LANG_PACK;
                                }
                            }

                        }
                    }

                    $tmp_doc_hash = hash('sha1', $xmlProfile_OUTPUT);

                    $tmp_XML_hash = ('<config_hash>' . $tmp_doc_hash . '</config_hash>');

                    $xmlProfile_OUTPUT = $xmlProfile_OUTPUT . $tmp_XML_LANG_PACKS_Z . $tmp_XML_hash . $xmlFileCLOSE;

                    $tmp_profile_hash = hash('sha1', $xmlProfile_OUTPUT);


                    //error_log('2651 XML FULL-> '.$xmlProfile_OUTPUT);

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
                        $tmp_prof_xml_status = fwrite($file_handle, $xmlProfile_OUTPUT);
                        fclose($file_handle);

                    } else {
                        //
                        // UPDATE XML FILE WITH NEW DATA
                        $file_handle = fopen($tmp_filename_profile_PATH, 'a');
                        $tmp_prof_xml_status = fwrite($file_handle, $xmlProfile_OUTPUT);
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

                        $xmlProfile_OUTPUT = $xmlIndexFileNEW . $tmp_XML_DELTA_PROFILE_INDEX;

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

                        $xmlProfile_OUTPUT = $xmlProfile_OUTPUT . $tmp_XML_DELTA_PROFILE_INDEX . $xmlIndexFileCLOSE;

                        if (file_exists($tmp_filename_index)) {
                            //
                            // DELETE THE FILE
                            unlink($tmp_filename_index);

                            //
                            // UPDATE XML FILE WITH NEW DATA
                            $file_handle = fopen($tmp_filename_index, 'a');
                            $tmp_prof_xml_status = fwrite($file_handle, $xmlProfile_OUTPUT);
                            fclose($file_handle);

                        } else {
                            //
                            // UPDATE XML FILE WITH NEW DATA
                            $file_handle = fopen($tmp_filename_index, 'a');
                            $tmp_prof_xml_status = fwrite($file_handle, $xmlProfile_OUTPUT);
                            fclose($file_handle);

                        }


                    } else {

                        return false;

                    }

                    if ($tmp_prof_xml_status !== false) {
                        /*
                        CREATE TABLE `wthrbg_overlay_state` (
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
                        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='View state of overlay compon
                        */

                        //
                        // SYNC DB STATE
                        self::$query = 'UPDATE `wthrbg_overlay_state` SET `FULLSCREEN_PROFILE_ID`="' . $tmp_pid . '",
                       `FULLSCREEN_PROFILE_HASH` = "' . $tmp_profile_hash . '",
                       `FULLSCREEN_PROFILE_ENDPOINT` = "' . $tmp_filename_profile_HTTP . '",
                       `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                       `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        `MODIFIER_SESSION_ID` = "' . session_id() . '",
                        `FULLSCREEN_LASTMODIFIED` = "' . $ts . '" ,
                        `DATEMODIFIED`="' . $ts . '" 
					     LIMIT 1;';

                        self::$result = $oEnv->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);
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

                    $xmlProfile_OUTPUT = $xmlProfile_OUTPUT.$tmp_XML_out_section_A.$tmp_XML_LANG_PACKS_A;

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
                                 * `wthrbg_lang_copy`.`MESSAGE_TITLE`,
                                                        `wthrbg_lang_copy`.`MESSAGE_TITLE_BLOB`,
                                                        `wthrbg_lang_copy`.`MESSAGE_NUMBER`,
                                                        `wthrbg_lang_copy`.`MESSAGE_NUMBER_BLOB`,
                                                        `wthrbg_lang_copy`.`CONFERENCE_TITLE`,
                                                        `wthrbg_lang_copy`.`CONFERENCE_TITLE_BLOB`,
                                                        `wthrbg_lang_copy`.`PAGE_HEADER`,
                                                        `wthrbg_lang_copy`.`PAGE_HEADER_BLOB`,
                                                        `wthrbg_lang_copy`.`PAGE_TITLE`,
                                                        `wthrbg_lang_copy`.`PAGE_TITLE_BLOB`,
                                                        `wthrbg_lang_copy`.`PAGE00_CODE_BLOB`,
                                                        `wthrbg_lang_copy`.`DATE_COPY`,
                                                        `wthrbg_lang_copy`.`DATE_COPY_BLOB`,
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

                                    $xmlProfile_OUTPUT = $xmlProfile_OUTPUT . $tmp_XML_out_LANG_PACK;
                                }
                            }

                        }
                    }

                    $tmp_doc_hash = hash('sha1', $xmlProfile_OUTPUT);

                    $tmp_XML_hash = ('<config_hash>' . $tmp_doc_hash . '</config_hash>');

                    $xmlProfile_OUTPUT = $xmlProfile_OUTPUT . $tmp_XML_LANG_PACKS_Z . $tmp_XML_hash . $xmlFileCLOSE;

                    $tmp_profile_hash = hash('sha1', $xmlProfile_OUTPUT);

                    //error_log('2781 XML MINI-> '.$xmlProfile_OUTPUT);

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
                        $tmp_prof_xml_status = fwrite($file_handle, $xmlProfile_OUTPUT);
                        fclose($file_handle);

                    } else {

                        //
                        // UPDATE XML FILE WITH NEW DATA
                        $file_handle = fopen($tmp_filename_profile_PATH, 'a');
                        $tmp_prof_xml_status = fwrite($file_handle, $xmlProfile_OUTPUT);
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

                        $xmlProfile_OUTPUT = $xmlIndexFileNEW . $tmp_XML_DELTA_PROFILE_INDEX;

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

                        $xmlProfile_OUTPUT = $xmlProfile_OUTPUT . $tmp_XML_DELTA_PROFILE_INDEX . $xmlIndexFileCLOSE;

                        if (file_exists($tmp_filename_index)) {
                            //
                            // DELETE THE FILE
                            unlink($tmp_filename_index);

                            //
                            // UPDATE XML FILE WITH NEW DATA
                            $file_handle = fopen($tmp_filename_index, 'a');
                            $tmp_prof_xml_status = fwrite($file_handle, $xmlProfile_OUTPUT);
                            fclose($file_handle);

                        } else {
                            //
                            // UPDATE XML FILE WITH NEW DATA
                            $file_handle = fopen($tmp_filename_index, 'a');
                            $tmp_prof_xml_status = fwrite($file_handle, $xmlProfile_OUTPUT);
                            fclose($file_handle);

                        }

                    } else {

                        return false;

                    }

                    if ($tmp_prof_xml_status !== false) {
                        //
                        // SYNC DB STATE
                        self::$query = 'UPDATE `wthrbg_overlay_state` SET `MINI_PROFILE_ID`="' . $tmp_pid . '",
                       `MINI_PROFILE_HASH` = "' . $tmp_profile_hash . '",
                       `MINI_PROFILE_ENDPOINT` = "' . $tmp_filename_profile_HTTP . '",
                       `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                       `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        `MODIFIER_SESSION_ID` = "' . session_id() . '",
                        `MINI_LASTMODIFIED` = "' . $ts . '" ,
                        `DATEMODIFIED`="' . $ts . '" 
					     LIMIT 1;';

                        self::$result = $oEnv->oMYSQLI_CONN_MGR->processQuery(self::$mysqli, self::$query);

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


    public function __destruct() {

    }
}