<?php
/*
// J5
// Code is Poetry */

/*
// CLASS :: crnrstn_mysqli_conn
// AUTHOR :: Jonathan 'J5' Harris <jharris@evifweb.com>
// VERSION :: 1.0.0
*/
class dataAugmentation {

    public $oDB_RESP;
	public static $queryResult_ARRAY = array();
	public $oSESSION_MGR;
	public $result;
	
	private static $id = array();
	private static $idtype = array();
	private static $query;
	private static $db_resp_serial_key;
	private static $result_ARRAY = array();
	private static $tmp_dataStore = array();
	private static $oLogger;

	public function __construct($mysqli,$env, $id_array,$idtype_array, $oDB_RESP = NULL, $resp_handle = NULL) {

        //
        // INSTANTIATE LOGGER
        self::$oLogger = new crnrstn_logging();

        //
        // TO MAKE THIS BACKWARDS COMPATIBLE...AND NOT FORCE MYSELF TO HAVE TO DO A LOT OF WORK AT ONCE...WE JUST SPLIT OOP OFF WITH A CHECK ON THIS OBJECT
	    if(isset($oDB_RESP)){
	        try{

                //
                // WE HAVE OOP GAME TO RUN. BREAK OFF CLEAN SERIAL AND INITIALIZE RESPONSE OBJECT FOR CLEAN CONSISTENT IMPLEMENTATION ANYWHERE.
                if (sizeof($id_array) == 0) {
                    //
                    // DO NOTHING

                }else{

                    //
                    // BUILD QUERY
                    $tmp_query = "";
                    $db_resp_target_profiles = "";
                    $db_resp_profile_field_cnt = "";

                    $tmp_type_cnt_ARRAY = array();

                    $tmp_loop_size = sizeof($id_array);
                    for ($i = 0; $i < $tmp_loop_size; $i++) {

                        /*
                        tmp_IDTYPE_ARRAY options [USER|KIVOTOS|ASSET|STREAM|]
                        */
                        switch ($idtype_array[$i]) {
                            case 'USERS':
                            case 'USER':
                                if(!isset($tmp_type_cnt_ARRAY[$idtype_array[$i]])){
                                    $tmp_type_cnt_ARRAY[$idtype_array[$i]] = 0;
                                }

                                $tmp_SELECT_ARRAY[$i] = '`users`.`USERID`,`users`.`EMAIL` ,`users`.`ISACTIVE`, `users`.`USER_PERMISSIONS_ID`, `users`.`FIRSTNAME_BLOB`, `users`.`LASTNAME_BLOB`, `users`.`JOBTITLE_BLOB`, `users`.`LANGCODE`,`users`.`LASTLOGIN`,`users`.`LASTLOGIN_IP`,`users`.`IMAGE_NAME`,`users`.`IMAGE_WIDTH`,`users`.`IMAGE_HEIGHT`,`users`.`ABOUT_BLOB`,`users`.`DATEMODIFIED`,`users`.`DATECREATED`';

                                $tmp_query .= 'SELECT '.$tmp_SELECT_ARRAY[$i].' FROM `users` WHERE `users`.`USERID`="' . $mysqli->real_escape_string($id_array[$i]) . '" AND `users`.`USERID_CRC32`="' . crc32($id_array[$i]) . '" LIMIT 1;';

                                if ($db_resp_profile_field_cnt == "") {
                                    $db_resp_target_profiles = 'USER_' . $tmp_type_cnt_ARRAY[$idtype_array[$i]];
                                    $db_resp_profile_field_cnt = '16';
                                } else {
                                    $db_resp_target_profiles .= '|USER_' . $tmp_type_cnt_ARRAY[$idtype_array[$i]];
                                    $db_resp_profile_field_cnt .= '|16';

                                }

                                $tmp_type_cnt_ARRAY[$idtype_array[$i]] += 1;

                            break;
                            case 'KIVOTOS':

                                if(!isset($tmp_type_cnt_ARRAY[$idtype_array[$i]])){
                                    $tmp_type_cnt_ARRAY[$idtype_array[$i]] = 0;
                                }

                                $tmp_SELECT_ARRAY[$i] = '`kivotos`.`KIVOTOS_ID`,`kivotos`.`ISACTIVE` ,`kivotos`.`ISPRIVATE`, `kivotos`.`CLIENT_ID`, `kivotos`.`CREATOR_ID`,`kivotos`.`ASSIGNED_ID`, `kivotos`.`SEARCH_ID`, `kivotos`.`NAME`,`kivotos`.`DESCRIPTION`,`kivotos`.`DUE_DATE`,`kivotos`.`STATE`,`kivotos`.`DATEMODIFIED`,`kivotos`.`DATECREATED`';

                                $tmp_query .= 'SELECT '.$tmp_SELECT_ARRAY[$i].' FROM `kivotos` WHERE `kivotos`.`KIVOTOS_ID`="' . $mysqli->real_escape_string($id_array[$i]) . '" AND `kivotos`.`KIVOTOS_ID_CRC32`="' . crc32($id_array[$i]) . '" LIMIT 1;';

                                if ($db_resp_profile_field_cnt == "") {
                                    $db_resp_target_profiles = 'KIVOTOS_' . $tmp_type_cnt_ARRAY[$idtype_array[$i]];
                                    $db_resp_profile_field_cnt = '13';
                                } else {
                                    $db_resp_target_profiles .= '|KIVOTOS_' . $tmp_type_cnt_ARRAY[$idtype_array[$i]];
                                    $db_resp_profile_field_cnt .= '|13';

                                }

                                $tmp_type_cnt_ARRAY[$idtype_array[$i]] += 1;

                            break;
                            case 'CLIENTS':
                            case 'CLIENT':

                                if(!isset($tmp_type_cnt_ARRAY[$idtype_array[$i]])){
                                    $tmp_type_cnt_ARRAY[$idtype_array[$i]] = 0;
                                }

                                $tmp_SELECT_ARRAY[$i] = '`clients`.`CLIENT_ID`, `clients`.`COMPANYNAME_BLOB`, `clients`.`LANGCODE`, `clients`.`DATECREATED`';

                                $tmp_query .= 'SELECT '.$tmp_SELECT_ARRAY[$i].'  FROM `clients` WHERE `clients`.`CLIENT_ID`="' . $mysqli->real_escape_string($id_array[$i]) . '" AND `clients`.`CLIENT_ID_CRC32`="' . crc32($id_array[$i]) . '" LIMIT 1;';

                                if ($db_resp_profile_field_cnt == "") {
                                    $db_resp_target_profiles = 'CLIENT_' . $tmp_type_cnt_ARRAY[$idtype_array[$i]];
                                    $db_resp_profile_field_cnt = '4';
                                } else {
                                    $db_resp_target_profiles .= '|CLIENT_' .$tmp_type_cnt_ARRAY[$idtype_array[$i]];
                                    $db_resp_profile_field_cnt .= '|4';

                                }

                            $tmp_type_cnt_ARRAY[$idtype_array[$i]] += 1;

                            break;
                            case 'ASSET':
                                if(!isset($tmp_type_cnt_ARRAY[$idtype_array[$i]])){
                                    $tmp_type_cnt_ARRAY[$idtype_array[$i]] = 0;
                                }

                                $tmp_SELECT_ARRAY[$i] = '`assets`.`ASSET_ID`, `assets`.`CLIENT_ID`, `assets`.`KIVOTOS_ID`, `assets`.`STREAM_ID`, `assets`.`USER_ID`, `assets`.`ISACTIVE`, `assets`.`ASSET_TYPE_KEY`, `assets`.`SPECIALTY_TYPE_KEY`, `assets`.`DLOAD_END_POINT`, `assets`.`PREVIEW_END_POINT`, `assets`.`FILE_MD5`, `assets`.`FILE_SHA1`, `assets`.`FILE_NAME`, `assets`.`FILE_EXT`, `assets`.`FILE_SIZE`, `assets`.`FILE_PATH`, `assets`.`FILE_PATH_LARGE`, `assets`.`FILE_PATH_MED`, `assets`.`FILE_PATH_SMALL`, `assets`.`FILE_MIME_TYPE`, `assets`.`IMAGE_WIDTH`, `assets`.`IMAGE_HEIGHT`, `assets`.`AUTHORIZED_IP`, `assets`.`AUTHORIZED_USERS`, `assets`.`NAME`, `assets`.`DESCRIPTION`, `assets`.`DESCRIPTION_RAW`, `assets`.`NEXT_VERSION`, `assets`.`PREVIOUS_VERSIONS`, `assets`.`LANGCODE`, `assets`.`CHANNEL`, `assets`.`DATEMODIFIED`, `assets`.`DATECREATED`';

                                $tmp_query .= 'SELECT '.$tmp_SELECT_ARRAY[$i].' FROM `assets` WHERE `assets`.`ASSET_ID`="' . $mysqli->real_escape_string($id_array[$i]) . '" AND `assets`.`ASSET_ID_CRC32`="' . crc32($id_array[$i]) . '" LIMIT 1;';

                                if ($db_resp_profile_field_cnt == "") {
                                    $db_resp_target_profiles = 'ASSET_' . $tmp_type_cnt_ARRAY[$idtype_array[$i]];
                                    $db_resp_profile_field_cnt = '33';
                                } else {
                                    $db_resp_target_profiles .= '|ASSET_' . $tmp_type_cnt_ARRAY[$idtype_array[$i]];
                                    $db_resp_profile_field_cnt .= '|33';

                                }

                                $tmp_type_cnt_ARRAY[$idtype_array[$i]] += 1;

                            break;
                            case 'STREAM':
                                // SET THIS UP WHEN YOU ARE READY TO TEST
                            break;

                        }
                        #error_log("data aug (113) db_resp_target_profiles->".$db_resp_target_profiles);

                    }

                    //
                    // WE HAVE LOOKUP QUERY. WE SHOULD PROCESS OOP. THIS IS A SELECT WITH RESULT RETURN.
                    $force_profile_select_align = true;
                    $db_resp_process_serial = "My_Jesus_Christ_is_Lord!";           # SUPPORT FOR MULTIPLE REQUESTS WITHIN SINGLE PAGE...USING SAME $oDB_RESP OBJECT.
                    if(isset($resp_handle)){
                        self::$db_resp_serial_key = $resp_handle;
                    }else {

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Data augmentation object cannot be properly initialized due to missing resp_handle parameter in constructor.');
                    }

                    $oDB_RESP->initialize($db_resp_process_serial, self::$db_resp_serial_key, $db_resp_target_profiles, $db_resp_profile_field_cnt, $force_profile_select_align);  # HAD TO PULL INITIALIZATION OUT OF CONSTRUCTOR SO SAME OBJECT COULD BE REUSED N+1 TIMES WITHIN ONE PAGE

                    $oDB_RESP->process($mysqli,'dataAugmentation::__construct()',$tmp_SELECT_ARRAY,$tmp_query);

                    //
                    // THEORETICALLY, WE HAVE ALL THE DATA NOW. HOW TO EXPOSE....
                    # DIRECT ACCESS THROUGH DB_RESP OBJECT
                    $this->oDB_RESP = $oDB_RESP;

                }

            }catch( Exception $e ) {
                //
                // SEND THIS THROUGH THE LOGGER OBJECT
                self::$oLogger->captureNotice('database_integration->dbQuery()', LOG_EMERG, $e->getMessage());

            }

        }else {

            error_log("dataaugment (153) ** FYI :: LOOKS LIKE YOU STILL HAVE OLD CODE ARCHITECTURE RUNNING HERE. **");

            // THIS IS THE OLD WAY
            $queryIndex_ARRAY = array('kivotos_KIVOTOS_ID' => 0, 'kivotos_ISACTIVE' => 1,
                'kivotos_ISPRIVATE' => 2, 'kivotos_CLIENT_ID' => 3, 'kivotos_CREATOR_ID' => 4,
                'kivotos_ASSIGNED_ID' => 5, 'kivotos_SEARCH_ID' => 6, 'kivotos_NAME' => 7,
                'kivotos_DESCRIPTION' => 8, 'kivotos_DUE_DATE' => 9, 'kivotos_STATE' => 10, 'kivotos_DATEMODIFIED' => 11, 'kivotos_DATECREATED' => 12,

                'users_USERID' => 0, 'users_EMAIL' => 1,
                'users_ISACTIVE' => 2, 'users_USER_PERMISSIONS_ID' => 3, 'users_FIRSTNAME_BLOB' => 4,
                'users_LASTNAME_BLOB' => 5, 'users_JOBTITLE_BLOB' => 6, 'users_LANGCODE' => 7,
                'users_LASTLOGIN' => 8, 'users_LASTLOGIN_IP' => 9, 'users_IMAGE_NAME' => 10, 'users_IMAGE_WIDTH' => 11,
                'users_IMAGE_HEIGHT' => 12, 'users_ABOUT_BLOB' => 13, 'users_DATEMODIFIED' => 14, 'users_DATECREATED' => 15,

                'clients_CLIENT_ID' => 0, 'clients_COMPANYNAME_BLOB' => 1, 'clients_LANGCODE' => 2, 'clients_DATECREATED' => 3

            );


            if (sizeof($id_array) == 0) {
                //
                // DO NOTHING

            } else {

                //
                // BUILD QUERY
                self::$query = "";
                $tmp_loop_size = sizeof($id_array);
                for ($i = 0; $i < $tmp_loop_size; $i++) {

                    /*
                    tmp_IDTYPE_ARRAY options [USER|KIVOTOS|ASSET|COMMENT|]
                    */
                    switch ($idtype_array[$i]) {
                        case 'USER':
                            self::$query .= 'SELECT `users`.`USERID`,`users`.`EMAIL` ,`users`.`ISACTIVE`, `users`.`USER_PERMISSIONS_ID`, `users`.`FIRSTNAME_BLOB`, `users`.`LASTNAME_BLOB`, `users`.`JOBTITLE_BLOB`, `users`.`LANGCODE`,`users`.`LASTLOGIN`,`users`.`LASTLOGIN_IP`,`users`.`IMAGE_NAME`,`users`.`IMAGE_WIDTH`,`users`.`IMAGE_HEIGHT`,`users`.`ABOUT_BLOB`,`users`.`DATEMODIFIED`,`users`.`DATECREATED` FROM `users` 
						WHERE `users`.`USERID`="' . $mysqli->real_escape_string($id_array[$i]) . '" AND `users`.`USERID_CRC32`="' . crc32($id_array[$i]) . '" LIMIT 1;';

                            break;
                        case 'KIVOTOS':
                            self::$query .= 'SELECT `kivotos`.`KIVOTOS_ID`,`kivotos`.`ISACTIVE` ,`kivotos`.`ISPRIVATE`, `kivotos`.`CLIENT_ID`, `kivotos`.`CREATOR_ID`,`kivotos`.`ASSIGNED_ID`, `kivotos`.`SEARCH_ID`, `kivotos`.`NAME`,`kivotos`.`DESCRIPTION`,`kivotos`.`DUE_DATE`,`kivotos`.`STATE`,`kivotos`.`DATEMODIFIED`,`kivotos`.`DATECREATED` FROM `kivotos` 
						WHERE `kivotos`.`KIVOTOS_ID`="' . $mysqli->real_escape_string($id_array[$i]) . '" AND `kivotos`.`KIVOTOS_ID_CRC32`="' . crc32($id_array[$i]) . '" LIMIT 1;';

                            break;
                        case 'CLIENT':
                            self::$query .= 'SELECT `clients`.`CLIENT_ID`, `clients`.`COMPANYNAME_BLOB`, `clients`.`LANGCODE`, `clients`.`DATECREATED`  FROM `clients` WHERE `clients`.`CLIENT_ID`="' . $mysqli->real_escape_string($id_array[$i]) . '" AND `clients`.`CLIENT_ID_CRC32`="' . crc32($id_array[$i]) . '" LIMIT 1;';
                            break;
                        default:
                            error_log("data augment (202) WHY DO YOU HAVE NEW FUNCTIONALITY RUNNING THROUGH OLD ARCHITECTURE? CLEAN IT UP.  die().");
                            die();
                        break;

                    }

                }

                //
                // PROCESS QUERY
                #error_log("dataaug (75) query->".self::$query);
                $mysqli = $env->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query);

                //
                // CLEAR RESULT ARRAY
                array_splice(self::$result_ARRAY, 0);

                $ROWCNT = 0;
                do {
                    if ($result = $mysqli->store_result()) {
                        while ($row = $result->fetch_row()) {
                            foreach ($row as $fieldPos => $value) {
                                //
                                // STORE RESULT. ROOM FOR IMPROVEMENT. BUILD FINAL DATA STRUCT HERE...INSTEAD OF LOOPING THROUGH AGAIN LATER.
                                self::$result_ARRAY[$ROWCNT][$fieldPos] = $value;

                            }
                            $ROWCNT++;
                        }
                        $result->free();
                    }

                    if ($mysqli->more_results()) {
                        //
                        // END OF RECORD. MORE TO FOLLOW.
                    }
                    #} while ($mysqli->next_result());
                } while ($mysqli->more_results() && $mysqli->next_result());

                //
                // PROCESS DB OUTPUT INTO MEANINGFUL FORMAT
                $tmp_userCnt = 0;
                $tmp_kivotosCnt = 0;
                $tmp_clientCnt = 0;
                $tmp_loop_size = sizeof(self::$result_ARRAY);
                for ($i = 0; $i < $tmp_loop_size; $i++) {
                    switch (sizeof(self::$result_ARRAY[$i])) {
                        case 16:
                            //
                            // USER
                            self::$tmp_dataStore['USER'][$tmp_userCnt]['USERID'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['users_USERID']];
                            self::$tmp_dataStore['USER'][$tmp_userCnt]['EMAIL'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['users_EMAIL']];
                            self::$tmp_dataStore['USER'][$tmp_userCnt]['ISACTIVE'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['users_ISACTIVE']];
                            self::$tmp_dataStore['USER'][$tmp_userCnt]['USER_PERMISSIONS_ID'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['users_USER_PERMISSIONS_ID']];
                            self::$tmp_dataStore['USER'][$tmp_userCnt]['FIRSTNAME_BLOB'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['users_FIRSTNAME_BLOB']];
                            self::$tmp_dataStore['USER'][$tmp_userCnt]['LASTNAME_BLOB'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['users_LASTNAME_BLOB']];
                            self::$tmp_dataStore['USER'][$tmp_userCnt]['JOBTITLE_BLOB'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['users_JOBTITLE_BLOB']];
                            self::$tmp_dataStore['USER'][$tmp_userCnt]['LANGCODE'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['users_LANGCODE']];
                            self::$tmp_dataStore['USER'][$tmp_userCnt]['LASTLOGIN'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['users_LASTLOGIN']];
                            self::$tmp_dataStore['USER'][$tmp_userCnt]['LASTLOGIN_IP'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['users_LASTLOGIN_IP']];
                            self::$tmp_dataStore['USER'][$tmp_userCnt]['IMAGE_NAME'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['users_IMAGE_NAME']];
                            self::$tmp_dataStore['USER'][$tmp_userCnt]['IMAGE_WIDTH'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['users_IMAGE_WIDTH']];
                            self::$tmp_dataStore['USER'][$tmp_userCnt]['IMAGE_HEIGHT'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['users_IMAGE_HEIGHT']];
                            self::$tmp_dataStore['USER'][$tmp_userCnt]['ABOUT_BLOB'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['users_ABOUT_BLOB']];
                            self::$tmp_dataStore['USER'][$tmp_userCnt]['DATEMODIFIED'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['users_DATEMODIFIED']];
                            self::$tmp_dataStore['USER'][$tmp_userCnt]['DATECREATED'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['users_DATECREATED']];

                            $tmp_userCnt++;


                            break;
                        case 13:
                            //
                            // KIVOTOS
                            /*'kivotos_KIVOTOS_ID' => 0,'kivotos_ISACTIVE' => 1,
                        'kivotos_ISPRIVATE' => 2,'kivotos_CLIENT_ID' => 3, 'kivotos_CREATOR_ID' => 4,
                        'kivotos_ASSIGNED_ID' => 5,'kivotos_SEARCH_ID' => 6, 'kivotos_NAME' => 7,
                        'kivotos_DESCRIPTION' => 8, 'kivotos_DUE_DATE' => 9, 'kivotos_STATE'=>10, 'kivotos_DATEMODIFIED' => 11, 'kivotos_DATECREATED' => 12,*/
                            self::$tmp_dataStore['KIVOTOS'][$tmp_kivotosCnt]['KIVOTOS_ID'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['kivotos_KIVOTOS_ID']];
                            self::$tmp_dataStore['KIVOTOS'][$tmp_kivotosCnt]['ISACTIVE'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['kivotos_ISACTIVE']];
                            self::$tmp_dataStore['KIVOTOS'][$tmp_kivotosCnt]['ISPRIVATE'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['kivotos_ISPRIVATE']];
                            self::$tmp_dataStore['KIVOTOS'][$tmp_kivotosCnt]['CLIENT_ID'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['kivotos_CLIENT_ID']];
                            self::$tmp_dataStore['KIVOTOS'][$tmp_kivotosCnt]['CREATOR_ID'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['kivotos_CREATOR_ID']];
                            self::$tmp_dataStore['KIVOTOS'][$tmp_kivotosCnt]['ASSIGNED_ID'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['kivotos_ASSIGNED_ID']];
                            self::$tmp_dataStore['KIVOTOS'][$tmp_kivotosCnt]['SEARCH_ID'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['kivotos_SEARCH_ID']];
                            self::$tmp_dataStore['KIVOTOS'][$tmp_kivotosCnt]['NAME'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['kivotos_NAME']];
                            self::$tmp_dataStore['KIVOTOS'][$tmp_kivotosCnt]['DESCRIPTION'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['kivotos_DESCRIPTION']];
                            self::$tmp_dataStore['KIVOTOS'][$tmp_kivotosCnt]['DUE_DATE'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['kivotos_DUE_DATE']];
                            self::$tmp_dataStore['KIVOTOS'][$tmp_kivotosCnt]['STATE'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['kivotos_STATE']];
                            self::$tmp_dataStore['KIVOTOS'][$tmp_kivotosCnt]['DATEMODIFIED'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['kivotos_DATEMODIFIED']];
                            self::$tmp_dataStore['KIVOTOS'][$tmp_kivotosCnt]['DATECREATED'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['kivotos_DATECREATED']];

                            $tmp_kivotosCnt++;
                            break;
                        case 4:
                            self::$tmp_dataStore['CLIENT'][$tmp_clientCnt]['CLIENT_ID'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['clients_CLIENT_ID']];
                            self::$tmp_dataStore['CLIENT'][$tmp_clientCnt]['COMPANY_NAME'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['clients_COMPANYNAME_BLOB']];
                            self::$tmp_dataStore['CLIENT'][$tmp_clientCnt]['LANGCODE'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['clients_LANGCODE']];
                            self::$tmp_dataStore['CLIENT'][$tmp_clientCnt]['DATECREATED'] = self::$result_ARRAY[$i][$queryIndex_ARRAY['clients_DATECREATED']];

                            $tmp_clientCnt++;
                            break;

                    }
                }

            }

        }
		
	}

	public function return_oDB_RESP(){

	    return $this->oDB_RESP;
    }

	public function getData($type,$index,$field,$key=NULL){
		//
        // WHY CAN'T I USE THIS?? WOULD BE NICE FOR $INDEX=0 DEFAULT. WOULD HAVE TO REORDER METHOD PARAMS.
        // THIS ONLY SUPPORTS ONE RETURN PER SELECT KEY. WE NEED TO TEST FOR N+1.
        #error_log("LOOK INTO MAKING THIS MORE ROBUST...NEED TO DYNAMICALLY EXTRACT PROFILE NAMES AND THEN PLUG IN. die()");
        #die();
        if(!isset($this->oDB_RESP)){
            //
            // BACKWARDS COMPATIBLE NOW
            return self::$tmp_dataStore[$type][$index][$field];
        }else{
            if(isset($key)){
                #error_log("data aug (326) returned serial->".$this->oDB_RESP->return_serial($key)."|->".$type."|->".$index."|->".$field);
                return $this->oDB_RESP->return_data_element($this->oDB_RESP->return_serial($key), $type . '_' . $index, $field, 0);

            }else {
                #error_log("data aug (315) serial[" . $this->oDB_RESP->return_serial(self::$db_resp_serial_key) . "] select profile[" . $type . '_' . $index . "] field[" . $field . "] index[0]");
                return $this->oDB_RESP->return_data_element($this->oDB_RESP->return_serial(self::$db_resp_serial_key), $type . '_' . $index, $field, 0);
            }
        }
		
	}

	public function defaultLinkState($name){
		
		if(isset(self::$navFocus[$name])){
			if(self::$navFocus[$name]){
				
				return 'checked="checked"';
			
			}else{
				return false;	
			}
		}else{
			return false;	
			
		}
		
	}
	
	public function returnLinkURI($name){
		try{
			if(!isset($name)){
				
				throw new Exception('EVIFWEB miniNav error :: missing name input for returnLinkURI().');
			}else{
				
				return self::$navURI[$name];
				
			}
		} catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('miniNav->returnLinkURI()', LOG_ERR, $e->getMessage());
			
			//
			// RETURN FALSE
			return false;
		}			
	}
	
	public function loadLink($name){
		
		if(isset(self::$navURI[$name])){
			return true;
		}else{
			return false;
		}
	}
	
	public function loadMenu($menuType){
		
		if(isset(self::$navType[$menuType])){
			return true;
			
		}else{
			return false;	
		}
		
	}
	
	public function configureLink($name, $uri, $focus=false){
		try{
			if(!isset($name) || !isset($uri)){
				
				throw new Exception('EVIFWEB miniNav error :: missing name or URI input for configureLink().');
			}else{
				
				//
				// INITIALIZE THIS LINK
				self::$navURI[$name] = $uri;
				self::$navFocus[$name] = $focus;
				
			}
		} catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('miniNav->configureLink()', LOG_ERR, $e->getMessage());
			
			//
			// RETURN FALSE
			return false;
		}		
		
	}

	public function __destruct() {
		
	}
}

?>