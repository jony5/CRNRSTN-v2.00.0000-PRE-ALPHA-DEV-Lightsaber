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
        try{

            //
            // WE HAVE OOP GAME TO RUN. BREAK OFF CLEAN SERIAL AND INITIALIZE RESPONSE OBJECT FOR CLEAN CONSISTENT IMPLEMENTATION ANYWHERE.
            if (sizeof($id_array) == 0) {
                //
                // DO NOTHING

            }else{

                //
                // BUILD QUERY
                $db_resp_target_profiles = "";
                $db_resp_profile_field_cnt = "";

                $tmp_type_cnt_ARRAY = array();

                $tmp_loop_size = sizeof($id_array);
                for ($i = 0; $i < $tmp_loop_size; $i++) {

                    /*
                    tmp_IDTYPE_ARRAY options [OBS_CLIENT|MINI_PROFILE|FULLSCRN_PROFILE|STREAM|]
                    */

                    if(!isset($tmp_type_cnt_ARRAY[$idtype_array[$i]])){
                        $tmp_type_cnt_ARRAY[$idtype_array[$i]] = 0;
                    }

                    switch ($idtype_array[$i]) {
                        case 'LANG_PACK_TRANSLATOR':
                        case 'LANG_PACK':
                            $tmp_SELECT_ARRAY[$i] = 'SELECT `wthrbg_lang_packs`.`LANGPACK_ID`,
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
                            WHERE `wthrbg_lang_packs`.`LANG_ID`="'.strtolower($mysqli->real_escape_string($id_array[$i])).'" 
                            LIMIT 1;';

                            if ($db_resp_profile_field_cnt == "") {
                                $db_resp_target_profiles = $idtype_array[$i].'_' . $tmp_type_cnt_ARRAY[$idtype_array[$i]];
                                $db_resp_profile_field_cnt = '12';
                            } else {
                                $db_resp_target_profiles .= '|'.$idtype_array[$i].'_' . $tmp_type_cnt_ARRAY[$idtype_array[$i]];
                                $db_resp_profile_field_cnt .= '|12';

                            }

                            $tmp_type_cnt_ARRAY[$idtype_array[$i]] += 1;

                        break;
                        case 'LANG_ELEMENT':
                            $tmp_SELECT_ARRAY[$i] = 'SELECT `wthrbg_lang_elem_components`.`ELEMENT_ID`,
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
                            WHERE `wthrbg_lang_elem_components`.`ELEMENT_ID`="'.$mysqli->real_escape_string($id_array[$i]).'" 
                            AND `wthrbg_lang_elem_components`.`ELEMENT_ID_CRC32`="'.crc32($id_array[$i]).'" 
                            LIMIT 1;';

                            if ($db_resp_profile_field_cnt == "") {
                                $db_resp_target_profiles = $idtype_array[$i].'_' . $tmp_type_cnt_ARRAY[$idtype_array[$i]];
                                $db_resp_profile_field_cnt = '29';
                            } else {
                                $db_resp_target_profiles .= '|'.$idtype_array[$i].'_' . $tmp_type_cnt_ARRAY[$idtype_array[$i]];
                                $db_resp_profile_field_cnt .= '|29';

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

                $oDB_RESP->process($mysqli,'dataAugmentation::__construct()', $tmp_SELECT_ARRAY);

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