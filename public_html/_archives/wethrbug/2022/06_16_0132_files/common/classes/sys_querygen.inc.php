<?php
/*
// J5
// Code is Poetry */

/*
// CLASS :: boring_query_handler
// AUTHOR :: Jonathan 'J5' Harris <jharris@evifweb.com>
// VERSION :: 1.0.0
// DATE :: 11.1.2019 @ 16:00:55
*/
class boring_query_handler {

	private static $oLogger;
    private static $oEnv;
    private static $oUser;
    private static $oDB_RESP;
    private static $dataAugmenter;
	private static $query;
    private static $queryArray = array();
	private static $queryType;
	private static $mysqli;

	public function __construct($mysqli) {
		// 
		// INSTANTIATE LOGGER
		self::$oLogger = new crnrstn_logging();
		
		try{
			if(!isset($mysqli)){

                //
                // HOOOSTON...VE HAF PROBLEM!
				throw new Exception('Query Helper Error :: missing db connection object for constructor.');

			}else{
			
				//
				// INITIALIZE NAV OBJECT
                self::$mysqli = $mysqli;
			
			}

		} catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('boring_query_handler->__construct()', LOG_ERR, $e->getMessage());
			
			//
			// RETURN FALSE
			return false;
		}
	}

	public function returnSelectArrayBusiness($processType, $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter=false, $persistQuery=false){

        try{

            self::$oEnv = $oEnv;
            self::$oUser = $oUser;
            self::$dataAugmenter = $dataAugmenter;
            self::$queryType = $queryType;
            self::$oDB_RESP = $oDB_RESP;


            if(!$persistQuery){
                self::$query = '';
            }

            switch($processType){
                case 'RETRIEVE_NEXT_FOR_PUBLISH':

                    $this->generateSQLArray_retrieve_next_lang_element_for_publish();

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Query helper missing known [processType] parameter for returnQueryBusiness(). Provided with : '.$processType);

                    break;

            }

            return self::$queryArray;

        } catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('boring_query_handler->returnQueryBusiness()', LOG_ERR, $e->getMessage());

            //
            // RETURN FALSE
            return false;
        }

    }

    public function returnSelectArrayProfiles($processType){

        switch($processType) {
            case 'RETRIEVE_NEXT_FOR_PUBLISH':

                return 'LANG_PACKS|MINISTRY_LANG_ELEMENTS_PUBLISHED|SITE_LANG_ELEMENTS_EN|TRANSLATOR_LANGS|SITE_LANG_ELEMENTS|MINISTRY_LANG_ELEMENTS_SAINT_SAVED';

            break;
        }
    }

    public function returnSelectArrayFieldCnt($processType){

        switch($processType) {
            case 'RETRIEVE_NEXT_FOR_PUBLISH':

                return '12|27|17|6|17|27';

            break;
        }
    }

	public function returnQueryBusiness($processType, $queryType, $oEnv, $oUser, $oDB_RESP, $dataAugmenter=false, $persistQuery=false){

        try{

            self::$oEnv = $oEnv;
            self::$oUser = $oUser;
            self::$dataAugmenter = $dataAugmenter;
            self::$queryType = $queryType;
            self::$oDB_RESP = $oDB_RESP;


            if(!$persistQuery){
                self::$query = '';
            }

            switch($processType){
                case 'LANG_ELEMENT_PUBLISH':

                    $this->generateSQL_publish_language_element();

                break;
                case 'LANG_ELEMENT_DELETE':

                    $this->generateSQL_delete_language_element();

                break;
                case 'LANG_ELEMENT_UPDATE':

                    $this->generateSQL_update_language_element();

                break;
                case 'LANG_ELEMENT_NEW':

                    $this->generateSQL_new_language_element();

                break;
                case 'LANG_ELEMENT_TRANSLATION_UPDATE':

                    $this->generateSQL_update_language_translation_element();

                break;
                case 'LANG_ELEMENT_TRANSLATION_NEW':

                    $this->generateSQL_new_language_translation_element();

                break;
                case 'SEARCH_ENTRY_COMPONENT_DELETE':
                    $this->generateSQL_delete_search_content_component();

                break;
                case 'SEARCH_ENTRY_DELETE':

                    $this->generateSQL_mod_isactive_search_content();

                break;
                case 'SEARCH_ENTRY_UPDATE':

                    $this->generateSQL_update_search_content();

                break;
                case 'SEARCH_ENTRY_TRANSLATION_UPDATE':

                    $this->generateSQL_update_translation_search_content();

                break;
                case 'SEARCH_ENTRY_TRANSLATION_NEW':

                    $this->generateSQL_new_translation_search_content();

                break;
                case 'SEARCH_ENTRY_NEW':

                    $this->generateSQL_new_search_content();

                break;
                case 'SYNC_EVENTS_TO_DAY':

                    $tmp_fullscrn_profile_id = $oUser->retrieve_Form_Data('PROFILE_ID');
                    $tmp_fullscrn_page_id = $oUser->retrieve_Form_Data('PAGE_ID');
                    $tmp_component_id = $oUser->retrieve_Form_Data('COMPONENT_ID');
                    $tmp_day_id = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('DAY_ID'));

                    $tmp_date_day = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('DATE_DAY'));
                    $tmp_date_month = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('DATE_MONTH'));
                    $tmp_date_year = self::$mysqli->real_escape_string($oUser->retrieve_Form_Data('DATE_YEAR'));

                    $tmp_day_delete = $oUser->retrieve_Form_Data('DAY_DELETE_AUTHORIZED');

                    /*
                     `wthrbg_component_schedule_event`.`EVENT_ID`,
                                `wthrbg_component_schedule_event`.`ELEMENT_ID`,
                     * */

                   // self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial('DATA_AUG_05'), 'COMPONENT_DAY_EVENTS_0', 'PROFILE_NAME_BLOB', $i)

                    $tmp_events_loop_count = self::$oDB_RESP->return_sizeof(self::$oDB_RESP->return_serial('DATA_AUG_05'), 'COMPONENT_DAY_EVENTS_0');

                    for($i=0;$i<$tmp_events_loop_count;$i++){

                        $tmp_event_id = self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial('DATA_AUG_05'), 'COMPONENT_DAY_EVENTS_0', 'EVENT_ID', $i);
                        $tmp_event_element_id = self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial('DATA_AUG_05'), 'COMPONENT_DAY_EVENTS_0', 'ELEMENT_ID', $i);
                        $tmp_event_date = self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial('DATA_AUG_05'), 'COMPONENT_DAY_EVENTS_0', 'DATE', $i);

                        if($tmp_day_delete=='1' || $tmp_day_delete==1){

                            $tmp_ISACTIVE = 0;
                            $this->generateSQL_sync_event_to_day($tmp_fullscrn_profile_id, $tmp_fullscrn_page_id, $tmp_component_id, $tmp_day_id, $tmp_event_id, $tmp_event_element_id, $tmp_event_date, $tmp_date_day, $tmp_date_month, $tmp_date_year, $tmp_ISACTIVE);

                        }else{
                            if($tmp_day_delete=='0' || $tmp_day_delete==0) {

                                $tmp_ISACTIVE = 1;
                                $this->generateSQL_sync_event_to_day($tmp_fullscrn_profile_id, $tmp_fullscrn_page_id, $tmp_component_id, $tmp_day_id, $tmp_event_id, $tmp_event_element_id, $tmp_event_date, $tmp_date_day, $tmp_date_month, $tmp_date_year, $tmp_ISACTIVE);

                            }else{

                                $this->generateSQL_sync_event_to_day($tmp_fullscrn_profile_id, $tmp_fullscrn_page_id, $tmp_component_id, $tmp_day_id, $tmp_event_id, $tmp_event_element_id, $tmp_event_date, $tmp_date_day, $tmp_date_month, $tmp_date_year);


                            }

                        }

                    }

                break;
                case 'ACTIVITY_LOG':

                    $tmp_element_id = $oUser->retrieve_Form_Data('ELEMENT_ID');
                    $tmp_fullscrn_profile_id = $oUser->retrieve_Form_Data('PROFILE_ID');
                    $tmp_mini_profile_id = null;
                    $tmp_fullscrn_page_id = $oUser->retrieve_Form_Data('PAGE_ID');
                    $tmp_component_id = $oUser->retrieve_Form_Data('COMPONENT_ID');
                    $tmp_obs_client_id = null;

                    $this->generateSQL_log_sys_user($tmp_element_id, $tmp_fullscrn_profile_id, $tmp_mini_profile_id, $tmp_fullscrn_page_id, $tmp_component_id, $tmp_obs_client_id);

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Query helper missing known [processType] parameter for returnQueryBusiness(). Provided with : '.$processType);

                break;

            }


            return self::$query;


        } catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('boring_query_handler->returnQueryBusiness()', LOG_ERR, $e->getMessage());

            //
            // RETURN FALSE
            return false;
        }


    }

    private function generateSQL_delete_search_content_component(){

        try{

            $ts = date("Y-m-d H:i:s", time());

            if(self::$oUser->retrieve_Form_Data('COMPONENT_ID')!='' && self::$oUser->retrieve_Form_Data('PAGE_ID')!='') {

                self::$query .= 'UPDATE `wthrbg_lang_elem_search`
                SET
                `ISACTIVE` = "0",
                `DATEMODIFIED` = "'.$ts.'"
                WHERE `COMPONENT_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('COMPONENT_ID')).'"
                  AND `COMPONENT_ID_CRC32` = "'.crc32(self::$oUser->retrieve_Form_Data('COMPONENT_ID')).'"
                  AND `PAGE_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PAGE_ID')).'"
                  AND `PAGE_ID_CRC32` = "'.crc32(self::$oUser->retrieve_Form_Data('PAGE_ID')).'"
                  AND `ISACTIVE` = "1";
                ';

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Query helper unable to build delete language element query due to unsatisfied nested if() statement algorithm.');

            }


        } catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('boring_query_handler->generateSQL_delete_search_content_component()', LOG_ERR, $e->getMessage());

            //
            // RETURN FALSE
            return false;
        }


    }

    private function generateSQL_mod_isactive_search_content($element_id=null, $isactive=null){

        try{

            $ts = date("Y-m-d H:i:s", time());

            if(isset($element_id) && isset($isactive)){

                self::$query .= 'UPDATE `wthrbg_lang_elem_search`
                SET
                `ISACTIVE` = "'.$isactive.'",
                `DATEMODIFIED` = "'.$ts.'"
                WHERE `ELEMENT_ID` = "'.self::$mysqli->real_escape_string($element_id).'"
                AND `ELEMENT_ID_CRC32` = "'.crc32($element_id).'"
                AND `ISACTIVE` != "'.$isactive.'"
                LIMIT 1;
                ';

            }else{

                if(self::$oUser->retrieve_Form_Data('ELEMENT_ID')!='') {

                    self::$query .= 'UPDATE `wthrbg_lang_elem_search`
                    SET
                    `ISACTIVE` = "0",
                    `DATEMODIFIED` = "'.$ts.'"
                    WHERE `ELEMENT_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'"
                      AND `ELEMENT_ID_CRC32` = "'.crc32(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'"
                      AND `ISACTIVE` = "1"
                      LIMIT 1
                      ;
                    ';


                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Query helper unable to build delete language element query due to unsatisfied nested if() statement algorithm.');

                }

            }

        } catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('boring_query_handler->generateSQL_mod_isactive_search_content()', LOG_ERR, $e->getMessage());

            //
            // RETURN FALSE
            return false;
        }


    }

    private function generateSQLArray_retrieve_next_lang_element_for_publish(){

        /*
        Draft Content ::

        COMPLETION_STATE = 'SAINT_SAVED'
        DRAFT_OWNER = 'SAINT'
        DATEPUBLISHED = [publish date]

        DATEPUBLISHED > DATEDRAFTED   ...it will be...

        Published Content ::

        COMPLETION_STATE = 'PUBLISHED'
        DRAFT_OWNER = 'SAINT'
        DATEPUBLISHED = [publish date]

        DATEPUBLISHED > DATEDRAFTED   ...it will be...
	    */

        try{
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

            // MINISTRY_LANG_ELEMENTS_PUBLISHED
            $tmp_SELECT_ARRAY[1] = 'SELECT `wthrbg_lang_elem_components`.`ELEMENT_ID`,
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
            $tmp_SELECT_ARRAY[2] = 'SELECT `wthrbg_sys_lang_elements`.`ELEMENT_ID`,
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
            $tmp_SELECT_ARRAY[3] = 'SELECT `wthrbg_translator_lang_id`.`RELATION_ID`,
                        `wthrbg_translator_lang_id`.`USERID`,
                        `wthrbg_translator_lang_id`.`LANG_ID`,
                        `wthrbg_translator_lang_id`.`ISACTIVE`,
                        `wthrbg_translator_lang_id`.`DATEMODIFIED`,
                        `wthrbg_translator_lang_id`.`DATECREATED`
                    FROM `wthrbg_translator_lang_id`
                    WHERE `wthrbg_translator_lang_id`.`ISACTIVE`="1";
';

            // SITE_LANG_ELEMENTS
            $tmp_SELECT_ARRAY[4] = 'SELECT `wthrbg_sys_lang_elements`.`ELEMENT_ID`,
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
                    AND `wthrbg_lang_elem_components`.`COMPLETION_STATE`= "SAINT_SAVED"
                    ;
';
            self::$queryArray = $tmp_SELECT_ARRAY;


        } catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('boring_query_handler->generateSQL_publish_language_element()', LOG_ERR, $e->getMessage());

            //
            // RETURN FALSE
            return false;
        }

    }


    private function generateSQL_publish_language_element(){

        /*

        Published Content ::

        COMPLETION_STATE = 'PUBLISHED'
        DRAFT_OWNER = 'SAINT'
        DATEPUBLISHED = [publish date]

        DATEPUBLISHED > DATEDRAFTED   ...it will be...
	    */

        try{

            $ts = date("Y-m-d H:i:s", time());
            $userid = self::$oEnv->oSESSION_MGR->getSessionParam('USERID');

            if(self::$oUser->retrieve_Form_Data('ELEMENT_ID')!='' && self::$oUser->retrieve_Form_Data('LANG_ID')!='' && self::$oUser->retrieve_Form_Data('PROFILE_ID')!='' && self::$oUser->retrieve_Form_Data('PAGE_ID')!='') {

                self::$query = 'UPDATE `wthrbg_lang_elem_components`
                SET
                `COMPLETION_STATE` = "PUBLISHED",
                `DRAFT_OWNER` = "SAINT",
                `DATEPUBLISHED` = "'.$ts.'",
                `MODIFIER_ID` = "'.$userid.'",
                `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                `DATEMODIFIED` = "'.$ts.'"
                WHERE `ELEMENT_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'"
                AND `ELEMENT_ID_CRC32` = "'.crc32(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'"
                AND `PROFILE_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'"
                AND `PROFILE_ID_CRC32` = "'.crc32(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'"
                AND `PAGE_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PAGE_ID')).'"
                AND `PAGE_ID_CRC32` = "'.crc32(self::$oUser->retrieve_Form_Data('PAGE_ID')).'"
                LIMIT 1;
                ';

            }else{

                if(self::$oUser->retrieve_Form_Data('ELEMENT_ID')!='' && self::$oUser->retrieve_Form_Data('LANG_ID')!='' && self::$oUser->retrieve_Form_Data('PROFILE_ID')!='' && self::$oUser->retrieve_Form_Data('PAGE_ID')=='') {

                    self::$query = 'UPDATE `wthrbg_lang_elem_components`
                    SET
                    `COMPLETION_STATE` = "PUBLISHED",
                    `DRAFT_OWNER` = "SAINT",
                    `DATEPUBLISHED` = "'.$ts.'",
                    `MODIFIER_ID` = "'.$userid.'",
                    `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    `MODIFIER_SESSION_ID` = "' . session_id() . '",
                    `DATEMODIFIED` = "'.$ts.'"
                    WHERE `ELEMENT_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'"
                    AND `ELEMENT_ID_CRC32` = "'.crc32(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'"
                    AND `PROFILE_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'"
                    AND `PROFILE_ID_CRC32` = "'.crc32(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'"
                    LIMIT 1;
                    ';

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Query helper unable to build update language element query due to unsatisfied nested if() statement algorithm.');

                }

            }

        } catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('boring_query_handler->generateSQL_publish_language_element()', LOG_ERR, $e->getMessage());

            //
            // RETURN FALSE
            return false;
        }

    }

    private function generateSQL_delete_language_element(){

        try{

            $ts = date("Y-m-d H:i:s", time());
            $userid = self::$oEnv->oSESSION_MGR->getSessionParam('USERID');

            if(self::$oUser->copy_content_field==''){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Query helper unable to build update search query due to missing oUser->copy_content_field data.');

            }

            if(self::$oUser->retrieve_Form_Data('ELEMENT_ID')!='' && self::$oUser->retrieve_Form_Data('LANG_ID')!='' && self::$oUser->retrieve_Form_Data('PROFILE_ID')!='' && self::$oUser->retrieve_Form_Data('PAGE_ID')!='') {

                self::$query = 'UPDATE `wthrbg_lang_elem_components`
                SET
                `ISACTIVE` = "0",
                `MODIFIER_ID` = "'.$userid.'",
                `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                `DATEMODIFIED` = "'.$ts.'"
                WHERE `ELEMENT_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'"
                AND `ELEMENT_ID_CRC32` = "'.crc32(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'"
                AND `PROFILE_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'"
                AND `PROFILE_ID_CRC32` = "'.crc32(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'"
                AND `PAGE_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PAGE_ID')).'"
                AND `PAGE_ID_CRC32` = "'.crc32(self::$oUser->retrieve_Form_Data('PAGE_ID')).'"
                LIMIT 1;
                ';

            }else{

                if(self::$oUser->retrieve_Form_Data('ELEMENT_ID')!='' && self::$oUser->retrieve_Form_Data('LANG_ID')!='' && self::$oUser->retrieve_Form_Data('PROFILE_ID')!='' && self::$oUser->retrieve_Form_Data('PAGE_ID')=='') {

                    self::$query = 'UPDATE `wthrbg_lang_elem_components`
                    SET
                    `ISACTIVE` = "0",
                    `MODIFIER_ID` = "'.$userid.'",
                    `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    `MODIFIER_SESSION_ID` = "' . session_id() . '",
                    `DATEMODIFIED` = "'.$ts.'"
                    WHERE `ELEMENT_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'"
                    AND `ELEMENT_ID_CRC32` = "'.crc32(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'"
                    AND `PROFILE_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'"
                    AND `PROFILE_ID_CRC32` = "'.crc32(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'"
                    LIMIT 1;
                    ';

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Query helper unable to build update language element query due to unsatisfied nested if() statement algorithm.');

                }

            }


        } catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('boring_query_handler->generateSQL_delete_language_element()', LOG_ERR, $e->getMessage());

            //
            // RETURN FALSE
            return false;
        }

    }

    private function generateSQL_update_language_element(){

        try{

            $ts = date("Y-m-d H:i:s", time());
            $userid = self::$oEnv->oSESSION_MGR->getSessionParam('USERID');
            $tmp_content = self::$oUser->retrieve_Form_Data(self::$oUser->copy_content_field);

            $tmp_hash_algo = self::$oEnv->getEnvParam('COPY_HASH_ALGO');
            $tmp_copy_hash = hash($tmp_hash_algo, $tmp_content);

            if(self::$oUser->copy_content_field==''){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Query helper unable to build update search query due to missing oUser->copy_xxxxx_xxxxx data.');

            }

            if(self::$oUser->retrieve_Form_Data('ELEMENT_ID')!='' && self::$oUser->retrieve_Form_Data('LANG_ID')!='' && self::$oUser->retrieve_Form_Data('PROFILE_ID')!='' && self::$oUser->retrieve_Form_Data('PAGE_ID')!='') {

                self::$query = 'UPDATE `wthrbg_lang_elem_components`
                SET
                `COPY_HASH` = "'.$tmp_copy_hash.'",
                `LANG_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('LANG_ID')).'",
                `COMPLETION_STATE` = "SAINT_SAVED",
                `DRAFT_OWNER` = "SAINT",
                `DATEDRAFTED` = "'.$ts.'",
                `ELEMENT_CONTENT` = "'.self::$mysqli->real_escape_string($tmp_content).'",
                `ELEMENT_CONTENT_BLOB` = "'.self::$mysqli->real_escape_string($tmp_content).'",
                `MODIFIER_ID` = "'.$userid.'",
                `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                `DATEMODIFIED` = "'.$ts.'"
                WHERE `ELEMENT_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'"
                AND `ELEMENT_ID_CRC32` = "'.crc32(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'"
                AND `PROFILE_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'"
                AND `PROFILE_ID_CRC32` = "'.crc32(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'"
                AND `PAGE_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PAGE_ID')).'"
                AND `PAGE_ID_CRC32` = "'.crc32(self::$oUser->retrieve_Form_Data('PAGE_ID')).'"
                LIMIT 1;
                ';

            }else{

                if(self::$oUser->retrieve_Form_Data('ELEMENT_ID')!='' && self::$oUser->retrieve_Form_Data('LANG_ID')!='' && self::$oUser->retrieve_Form_Data('PROFILE_ID')!='' && self::$oUser->retrieve_Form_Data('PAGE_ID')=='') {

                    self::$query = 'UPDATE `wthrbg_lang_elem_components`
                    SET
                    `COPY_HASH` = "'.$tmp_copy_hash.'",
                    `LANG_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('LANG_ID')).'",
                    `COMPLETION_STATE` = "SAINT_SAVED",
                    `DRAFT_OWNER` = "SAINT",
                    `DATEDRAFTED` = "'.$ts.'",
                    `ELEMENT_CONTENT` = "'.self::$mysqli->real_escape_string($tmp_content).'",
                    `ELEMENT_CONTENT_BLOB` = "'.self::$mysqli->real_escape_string($tmp_content).'",
                    `MODIFIER_ID` = "'.$userid.'",
                    `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    `MODIFIER_SESSION_ID` = "' . session_id() . '",
                    `DATEMODIFIED` = "'.$ts.'"
                    WHERE `ELEMENT_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'"
                    AND `ELEMENT_ID_CRC32` = "'.crc32(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'"
                    AND `PROFILE_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'"
                    AND `PROFILE_ID_CRC32` = "'.crc32(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'"
                    LIMIT 1;
                    ';

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Query helper unable to build update language element query due to unsatisfied nested if() statement algorithm.');

                }

            }

        } catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('boring_query_handler->generateSQL_update_language_element()', LOG_ERR, $e->getMessage());

            //
            // RETURN FALSE
            return false;
        }


    }

    public function retrieveCurrentHash(){

	    return self::$oUser->retrieve_Form_Data('CURRENT_COPY_HASH');
    }

    private function generateSQL_update_language_translation_element(){

        try{

            $ts = date("Y-m-d H:i:s", time());
            $userid = self::$oEnv->oSESSION_MGR->getSessionParam('USERID');
            $tmp_content = self::$oUser->retrieve_Form_Data(self::$oUser->copy_content_field);

            $tmp_hash_algo = self::$oEnv->getEnvParam('COPY_HASH_ALGO');
            $tmp_copy_hash = hash($tmp_hash_algo, $tmp_content);
            self::$oUser->save_Form_Data('CURRENT_COPY_HASH', $tmp_copy_hash);

            if(self::$oUser->copy_content_field==''){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Query helper unable to build update search query due to missing oUser->copy_xxxxx_xxxxx data.');
            }

            if(self::$oUser->retrieve_Form_Data('ELEMENT_ID_TRANSLATION')!='' && self::$oUser->retrieve_Form_Data('LANG_ID_TRANSLATOR')!='' && self::$oUser->retrieve_Form_Data('PROFILE_ID')!='' && self::$oUser->retrieve_Form_Data('PAGE_ID')!='') {

                self::$query = 'UPDATE `wthrbg_lang_elem_components`
                SET
                `COPY_HASH` = "'.$tmp_copy_hash.'",
                `COMPLETION_STATE` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('COMPLETION_STATE')).'",
                `LANG_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('LANG_ID_TRANSLATOR')).'",
                `SOURCE_LANG_ELEMENT_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'",
                `DRAFT_OWNER` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('DRAFT_OWNER')).'",
                `DATEDRAFTED` = "'.$ts.'",
                `ELEMENT_CONTENT` = "'.self::$mysqli->real_escape_string($tmp_content).'",
                `ELEMENT_CONTENT_BLOB` = "'.self::$mysqli->real_escape_string($tmp_content).'",
                `MODIFIER_ID` = "'.$userid.'",
                `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                `DATEMODIFIED` = "'.$ts.'"
                WHERE `ELEMENT_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('ELEMENT_ID_TRANSLATION')).'"
                AND `ELEMENT_ID_CRC32` = "'.crc32(self::$oUser->retrieve_Form_Data('ELEMENT_ID_TRANSLATION')).'"
                AND `PROFILE_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'"
                AND `PROFILE_ID_CRC32` = "'.crc32(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'"
                AND `PAGE_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PAGE_ID')).'"
                AND `PAGE_ID_CRC32` = "'.crc32(self::$oUser->retrieve_Form_Data('PAGE_ID')).'"
                LIMIT 1;
                ';

            }else{

                if(self::$oUser->retrieve_Form_Data('ELEMENT_ID_TRANSLATION')!='' && self::$oUser->retrieve_Form_Data('LANG_ID_TRANSLATOR')!='' && self::$oUser->retrieve_Form_Data('PROFILE_ID')!='' && self::$oUser->retrieve_Form_Data('PAGE_ID')=='') {

                    self::$query = 'UPDATE `wthrbg_lang_elem_components`
                    SET
                    `COPY_HASH` = "'.$tmp_copy_hash.'",
                    `COMPLETION_STATE` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('COMPLETION_STATE')).'",
                    `LANG_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('LANG_ID_TRANSLATOR')).'",
                    `SOURCE_LANG_ELEMENT_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'",
                    `DRAFT_OWNER` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('DRAFT_OWNER')).'",
                    `DATEDRAFTED` = "'.$ts.'",
                    `ELEMENT_CONTENT` = "'.self::$mysqli->real_escape_string($tmp_content).'",
                    `ELEMENT_CONTENT_BLOB` = "'.self::$mysqli->real_escape_string($tmp_content).'",
                    `MODIFIER_ID` = "'.$userid.'",
                    `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    `MODIFIER_SESSION_ID` = "' . session_id() . '",
                    `DATEMODIFIED` = "'.$ts.'"
                    WHERE `ELEMENT_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('ELEMENT_ID_TRANSLATION')).'"
                    AND `ELEMENT_ID_CRC32` = "'.crc32(self::$oUser->retrieve_Form_Data('ELEMENT_ID_TRANSLATION')).'"
                    AND `PROFILE_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'"
                    AND `PROFILE_ID_CRC32` = "'.crc32(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'"
                    LIMIT 1;
                    ';

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Query helper unable to build update language element query due to unsatisfied nested if() statement algorithm.');

                }

            }

        } catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('boring_query_handler->generateSQL_update_language_element()', LOG_ERR, $e->getMessage());

            //
            // RETURN FALSE
            return false;
        }

    }

    private function generateSQL_new_language_translation_element(){

        try{

            $ts = date("Y-m-d H:i:s", time());
            $userid = self::$oEnv->oSESSION_MGR->getSessionParam('USERID');
            $tmp_content = self::$oUser->retrieve_Form_Data(self::$oUser->copy_content_field);

            $tmp_hash_algo = self::$oEnv->getEnvParam('COPY_HASH_ALGO');
            $tmp_copy_hash = hash($tmp_hash_algo, $tmp_content);
            self::$oUser->save_Form_Data('CURRENT_COPY_HASH', $tmp_copy_hash);

            if(self::$oUser->copy_content_field=='' || self::$oUser->copy_profile_type=='' || self::$oUser->copy_component_type==''){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Query helper unable to build update search query due to missing oUser->copy_xxxxx_xxxxx data.');

            }

            if(self::$oUser->retrieve_Form_Data('COMPONENT_ID')!='' && self::$oUser->retrieve_Form_Data('ELEMENT_ID_TRANSLATION')!='' && self::$oUser->retrieve_Form_Data('COPY_ID')!='' && self::$oUser->retrieve_Form_Data('LANG_ID_TRANSLATOR')!='' && self::$oUser->retrieve_Form_Data('PROFILE_ID')!='' && self::$oUser->retrieve_Form_Data('PAGE_ID')!='') {

                self::$query .= 'INSERT INTO `wthrbg_lang_elem_components`
                (`ELEMENT_ID`,
                 `ELEMENT_ID_CRC32`,
                `COPY_HASH`,
                `COPY_ID`,
                `COPY_ID_CRC32`,
                `COMPONENT_ID`,
                `COMPONENT_ID_CRC32`,
                `LANG_ID`,
                `SOURCE_LANG_ELEMENT_ID`,
                `COMPLETION_STATE`,
                `DRAFT_OWNER`,
                `DATEDRAFTED`,
                `PROFILE_ID`,
                `PROFILE_ID_CRC32`,
                `PAGE_ID`,
                `PAGE_ID_CRC32`,
                `PROFILE_TYPE`,
                `COMPONENT_TYPE`,
                `ELEMENT_CONTENT`,
                `ELEMENT_CONTENT_BLOB`,
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
                ("'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('ELEMENT_ID_TRANSLATION')).'",
                "'.crc32(self::$oUser->retrieve_Form_Data('ELEMENT_ID_TRANSLATION')).'",
                "'.$tmp_copy_hash.'",
                "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('COPY_ID')).'",
                "'.crc32(self::$oUser->retrieve_Form_Data('COPY_ID')).'",
                "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('COMPONENT_ID')).'",
                "'.crc32(self::$oUser->retrieve_Form_Data('COMPONENT_ID')).'",
                "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('LANG_ID_TRANSLATOR')).'",
                "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'",
                "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('COMPLETION_STATE')).'",
                "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('DRAFT_OWNER')).'",
                "'.$ts.'",
                "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'",
                "'.crc32(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'",
                "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PAGE_ID')).'",
                "'.crc32(self::$oUser->retrieve_Form_Data('PAGE_ID')).'",
                "'.self::$oUser->copy_profile_type.'",
                "'.self::$oUser->copy_component_type.'",
                "'.self::$mysqli->real_escape_string($tmp_content).'",
                "'.self::$mysqli->real_escape_string($tmp_content).'",
                "'.$userid.'",
                INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                "' . session_id() . '",
                "'.$userid.'",
                INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                "' . session_id() . '",
                "'.$ts.'");
                ';

            }else{
                //
                // HEADER AND TITLE HAVE NO COMPONENT_ID
                if(self::$oUser->retrieve_Form_Data('COMPONENT_ID')=='' && self::$oUser->retrieve_Form_Data('ELEMENT_ID_TRANSLATION')!='' && self::$oUser->retrieve_Form_Data('COPY_ID')!='' && self::$oUser->retrieve_Form_Data('LANG_ID_TRANSLATOR')!='' && self::$oUser->retrieve_Form_Data('PROFILE_ID')!='' && self::$oUser->retrieve_Form_Data('PAGE_ID')!='') {

                    self::$query .= 'INSERT INTO `wthrbg_lang_elem_components`
                    (`ELEMENT_ID`,
                     `ELEMENT_ID_CRC32`,
                    `COPY_HASH`,
                    `COPY_ID`,
                    `COPY_ID_CRC32`,
                    `LANG_ID`,
                    `SOURCE_LANG_ELEMENT_ID`,
                    `COMPLETION_STATE`,
                    `DRAFT_OWNER`,
                    `DATEDRAFTED`,
                    `PROFILE_ID`,
                    `PROFILE_ID_CRC32`,
                    `PAGE_ID`,
                    `PAGE_ID_CRC32`,
                    `PROFILE_TYPE`,
                    `COMPONENT_TYPE`,
                    `ELEMENT_CONTENT`,
                    `ELEMENT_CONTENT_BLOB`,
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
                    ("'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('ELEMENT_ID_TRANSLATION')).'",
                    "'.crc32(self::$oUser->retrieve_Form_Data('ELEMENT_ID_TRANSLATION')).'",
                    "'.$tmp_copy_hash.'",
                    "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('COPY_ID')).'",
                    "'.crc32(self::$oUser->retrieve_Form_Data('COPY_ID')).'",
                    "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('LANG_ID_TRANSLATOR')).'",
                    "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'",
                    "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('COMPLETION_STATE')).'",
                    "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('DRAFT_OWNER')).'",
                    "'.$ts.'",
                    "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'",
                    "'.crc32(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'",
                    "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PAGE_ID')).'",
                    "'.crc32(self::$oUser->retrieve_Form_Data('PAGE_ID')).'",
                    "'.self::$oUser->copy_profile_type.'",
                    "'.self::$oUser->copy_component_type.'",
                    "'.self::$mysqli->real_escape_string($tmp_content).'",
                    "'.self::$mysqli->real_escape_string($tmp_content).'",
                    "'.$userid.'",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "' . session_id() . '",
                    "'.$userid.'",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "' . session_id() . '",
                    "'.$ts.'");
                    ';

                }else{

                    if(self::$oUser->retrieve_Form_Data('COMPONENT_ID')=='' && self::$oUser->retrieve_Form_Data('ELEMENT_ID_TRANSLATION')!='' && self::$oUser->retrieve_Form_Data('COPY_ID')!='' && self::$oUser->retrieve_Form_Data('LANG_ID_TRANSLATOR')!='' && self::$oUser->retrieve_Form_Data('PROFILE_ID')!='' && self::$oUser->retrieve_Form_Data('PAGE_ID')=='') {

                        self::$query .= 'INSERT INTO `wthrbg_lang_elem_components`
                        (`ELEMENT_ID`,
                         `ELEMENT_ID_CRC32`,
                        `COPY_HASH`,
                        `COPY_ID`,
                        `COPY_ID_CRC32`,
                        `LANG_ID`,
                        `SOURCE_LANG_ELEMENT_ID`,
                        `COMPLETION_STATE`,
                        `DRAFT_OWNER`,
                        `DATEDRAFTED`,
                        `PROFILE_ID`,
                        `PROFILE_ID_CRC32`,
                        `PROFILE_TYPE`,
                        `COMPONENT_TYPE`,
                        `ELEMENT_CONTENT`,
                        `ELEMENT_CONTENT_BLOB`,
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
                        ("'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('ELEMENT_ID_TRANSLATION')).'",
                        "'.crc32(self::$oUser->retrieve_Form_Data('ELEMENT_ID_TRANSLATION')).'",
                        "'.$tmp_copy_hash.'",
                        "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('COPY_ID')).'",
                        "'.crc32(self::$oUser->retrieve_Form_Data('COPY_ID')).'",
                        "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('LANG_ID_TRANSLATOR')).'",
                        "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'",
                        "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('COMPLETION_STATE')).'",
                        "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('DRAFT_OWNER')).'",
                        "'.$ts.'",
                        "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'",
                        "'.crc32(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'",
                        "'.self::$oUser->copy_profile_type.'",
                        "'.self::$oUser->copy_component_type.'",
                        "'.self::$mysqli->real_escape_string($tmp_content).'",
                        "'.self::$mysqli->real_escape_string($tmp_content).'",
                        "'.$userid.'",
                        INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        "' . session_id() . '",
                        "'.$userid.'",
                        INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        "' . session_id() . '",
                        "'.$ts.'");
                        ';

                    }else {

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        //$tmp_situation = 'COMPONENT_ID=' . self::$oUser->retrieve_Form_Data('COMPONENT_ID') . '|ELEMENT_ID=' . self::$oUser->retrieve_Form_Data('ELEMENT_ID') . '|COPY_ID=' . self::$oUser->retrieve_Form_Data('COPY_ID') . '|LANG_ID=' . self::$oUser->retrieve_Form_Data('LANG_ID') . '|PROFILE_ID=' . self::$oUser->retrieve_Form_Data('PROFILE_ID') . '|PAGE_ID=' . self::$oUser->retrieve_Form_Data('PAGE_ID');
                        throw new Exception('Query helper unable to build new language element query due to unsatisfied nested if() statement algorithm.');

                    }
                }

            }


        } catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('boring_query_handler->generateSQL_new_language_translation_element()', LOG_ERR, $e->getMessage());

            //
            // RETURN FALSE
            return false;
        }

    }

    private function generateSQL_new_language_element(){

        try{

            $ts = date("Y-m-d H:i:s", time());
            $userid = self::$oEnv->oSESSION_MGR->getSessionParam('USERID');
            $tmp_content = self::$oUser->retrieve_Form_Data(self::$oUser->copy_content_field);

            $tmp_hash_algo = self::$oEnv->getEnvParam('COPY_HASH_ALGO');
            $tmp_copy_hash = hash($tmp_hash_algo, $tmp_content);

            if(self::$oUser->copy_content_field=='' || self::$oUser->copy_profile_type=='' || self::$oUser->copy_component_type==''){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Query helper unable to build update search query due to missing oUser->copy_xxxxx_xxxxx data.');

            }

            if(self::$oUser->retrieve_Form_Data('COMPONENT_ID')!='' && self::$oUser->retrieve_Form_Data('ELEMENT_ID')!='' && self::$oUser->retrieve_Form_Data('COPY_ID')!='' && self::$oUser->retrieve_Form_Data('LANG_ID')!='' && self::$oUser->retrieve_Form_Data('PROFILE_ID')!='' && self::$oUser->retrieve_Form_Data('PAGE_ID')!='') {

                self::$query .= 'INSERT INTO `wthrbg_lang_elem_components`
                (`ELEMENT_ID`,
                `ELEMENT_ID_CRC32`,
                `COPY_HASH`,
                `COPY_ID`,
                `COPY_ID_CRC32`,
                `COMPONENT_ID`,
                `COMPONENT_ID_CRC32`,
                `LANG_ID`,
                `IS_NATIVE_LANG`,
                `COMPLETION_STATE`,
                `PROFILE_ID`,
                `PROFILE_ID_CRC32`,
                `PAGE_ID`,
                `PAGE_ID_CRC32`,
                `DRAFT_OWNER`,
                `DATEDRAFTED`,
                `PROFILE_TYPE`,
                `COMPONENT_TYPE`,
                `ELEMENT_CONTENT`,
                `ELEMENT_CONTENT_BLOB`,
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
                ("'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'",
                "'.crc32(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'",
                "'.$tmp_copy_hash.'",
                "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('COPY_ID')).'",
                "'.crc32(self::$oUser->retrieve_Form_Data('COPY_ID')).'",
                "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('COMPONENT_ID')).'",
                "'.crc32(self::$oUser->retrieve_Form_Data('COMPONENT_ID')).'",
                "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('LANG_ID')).'",
                "1",
                "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('COMPLETION_STATE')).'",
                "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'",
                "'.crc32(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'",
                "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PAGE_ID')).'",
                "'.crc32(self::$oUser->retrieve_Form_Data('PAGE_ID')).'",
                "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('DRAFT_OWNER')).'",
                "'.$ts.'",
                "'.self::$oUser->copy_profile_type.'",
                "'.self::$oUser->copy_component_type.'",
                "'.self::$mysqli->real_escape_string($tmp_content).'",
                "'.self::$mysqli->real_escape_string($tmp_content).'",
                "'.$userid.'",
                INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                "' . session_id() . '",
                "'.$userid.'",
                INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                "' . session_id() . '",
                "'.$ts.'");
                ';

            }else{

                //
                // HEADER AND TITLE HAVE NO COMPONENT_ID
                if(self::$oUser->retrieve_Form_Data('COMPONENT_ID')=='' && self::$oUser->retrieve_Form_Data('ELEMENT_ID')!='' && self::$oUser->retrieve_Form_Data('COPY_ID')!='' && self::$oUser->retrieve_Form_Data('LANG_ID')!='' && self::$oUser->retrieve_Form_Data('PROFILE_ID')!='' && self::$oUser->retrieve_Form_Data('PAGE_ID')!='') {

                    self::$query .= 'INSERT INTO `wthrbg_lang_elem_components`
                    (`ELEMENT_ID`,
                     `ELEMENT_ID_CRC32`,
                    `COPY_HASH`,
                    `COPY_ID`,
                    `COPY_ID_CRC32`,
                    `LANG_ID`,
                    `IS_NATIVE_LANG`,
                    `COMPLETION_STATE`,
                    `PROFILE_ID`,
                    `PROFILE_ID_CRC32`,
                    `PAGE_ID`,
                    `PAGE_ID_CRC32`,
                    `DRAFT_OWNER`,
                    `DATEDRAFTED`,
                    `PROFILE_TYPE`,
                    `COMPONENT_TYPE`,
                    `ELEMENT_CONTENT`,
                    `ELEMENT_CONTENT_BLOB`,
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
                    ("'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'",
                    "'.crc32(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'",
                    "'.$tmp_copy_hash.'",
                    "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('COPY_ID')).'",
                    "'.crc32(self::$oUser->retrieve_Form_Data('COPY_ID')).'",
                    "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('LANG_ID')).'",
                    "1",
                    "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('COMPLETION_STATE')).'",
                    "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'",
                    "'.crc32(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'",
                    "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PAGE_ID')).'",
                    "'.crc32(self::$oUser->retrieve_Form_Data('PAGE_ID')).'",       
                    "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('DRAFT_OWNER')).'",
                    "'.$ts.'",
                    "'.self::$oUser->copy_profile_type.'",
                    "'.self::$oUser->copy_component_type.'",
                    "'.self::$mysqli->real_escape_string($tmp_content).'",
                    "'.self::$mysqli->real_escape_string($tmp_content).'",
                    "'.$userid.'",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "' . session_id() . '",
                    "'.$userid.'",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "' . session_id() . '",
                    "'.$ts.'");
                    ';

                }else{

                    if(self::$oUser->retrieve_Form_Data('COMPONENT_ID')=='' && self::$oUser->retrieve_Form_Data('ELEMENT_ID')!='' && self::$oUser->retrieve_Form_Data('COPY_ID')!='' && self::$oUser->retrieve_Form_Data('LANG_ID')!='' && self::$oUser->retrieve_Form_Data('PROFILE_ID')!='' && self::$oUser->retrieve_Form_Data('PAGE_ID')=='') {

                        self::$query .= 'INSERT INTO `wthrbg_lang_elem_components`
                        (`ELEMENT_ID`,
                         `ELEMENT_ID_CRC32`,
                        `COPY_HASH`,
                        `COPY_ID`,
                        `COPY_ID_CRC32`,
                        `LANG_ID`,
                        `IS_NATIVE_LANG`,
                        `COMPLETION_STATE`,
                        `PROFILE_ID`,
                        `PROFILE_ID_CRC32`,
                        `DRAFT_OWNER`,
                        `DATEDRAFTED`,
                        `PROFILE_TYPE`,
                        `COMPONENT_TYPE`,
                        `ELEMENT_CONTENT`,
                        `ELEMENT_CONTENT_BLOB`,
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
                        ("'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'",
                        "'.crc32(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'",
                        "'.$tmp_copy_hash.'",
                        "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('COPY_ID')).'",
                        "'.crc32(self::$oUser->retrieve_Form_Data('COPY_ID')).'",
                        "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('LANG_ID')).'",
                        "1",
                        "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('COMPLETION_STATE')).'",
                        "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'",
                        "'.crc32(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'",
                        "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('DRAFT_OWNER')).'",
                        "'.$ts.'",
                        "'.self::$oUser->copy_profile_type.'",
                        "'.self::$oUser->copy_component_type.'",
                        "'.self::$mysqli->real_escape_string($tmp_content).'",
                        "'.self::$mysqli->real_escape_string($tmp_content).'",
                        "'.$userid.'",
                        INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        "' . session_id() . '",
                        "'.$userid.'",
                        INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        "' . session_id() . '",
                        "'.$ts.'");
                        ';

                    }else {

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        //$tmp_situation = 'COMPONENT_ID=' . self::$oUser->retrieve_Form_Data('COMPONENT_ID') . '|ELEMENT_ID=' . self::$oUser->retrieve_Form_Data('ELEMENT_ID') . '|COPY_ID=' . self::$oUser->retrieve_Form_Data('COPY_ID') . '|LANG_ID=' . self::$oUser->retrieve_Form_Data('LANG_ID') . '|PROFILE_ID=' . self::$oUser->retrieve_Form_Data('PROFILE_ID') . '|PAGE_ID=' . self::$oUser->retrieve_Form_Data('PAGE_ID');
                        throw new Exception('Query helper unable to build new language element query due to unsatisfied nested if() statement algorithm.');

                    }
                }

            }


        } catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('boring_query_handler->generateSQL_new_language_element()', LOG_ERR, $e->getMessage());

            //
            // RETURN FALSE
            return false;
        }

    }

    private function generateSQL_update_translation_search_content(){

        try{

            $ts = date("Y-m-d H:i:s", time());
            $tmp_content = self::$oUser->retrieve_Form_Data(self::$oUser->copy_content_field);

            if(self::$oUser->copy_content_field==''){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Query helper unable to build update search query due to missing oUser->copy_content_field data.');

            }

            $tmp_hash_algo = self::$oEnv->getEnvParam('COPY_HASH_ALGO');
            $tmp_copy_hash = hash($tmp_hash_algo, $tmp_content);

            self::$query .= 'UPDATE `wthrbg_lang_elem_search`
                SET
                `SEARCH_CONTENT` = "'.self::$mysqli->real_escape_string(strtolower(self::$oUser->searchCleanStr($tmp_content))).'",
                `SEARCH_HASH` = "'.$tmp_copy_hash.'",
                `LANG_ID` = "'.self::$mysqli->real_escape_string(strtolower(self::$oUser->retrieve_Form_Data('LANG_ID_TRANSLATOR'))).'",
                `SEARCH_CONTENT_DISPLAY` = "'.self::$oUser->searchTruncStr($tmp_content, 2000).'",
                `SEARCH_CONTENT_BLOB` = "'.self::$mysqli->real_escape_string($tmp_content).'",
                `DATEMODIFIED` = "'.$ts.'"
                WHERE `ELEMENT_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('ELEMENT_ID_TRANSLATION')).'"
                  AND `ELEMENT_ID_CRC32` = "'.crc32(self::$oUser->retrieve_Form_Data('ELEMENT_ID_TRANSLATION')).'"
                  LIMIT 1
                  ;
                ';


        } catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('boring_query_handler->generateSQL_update_translation_search_content()', LOG_ERR, $e->getMessage());

            //
            // RETURN FALSE
            return false;
        }

    }

    private function generateSQL_update_search_content(){

        try{

            $ts = date("Y-m-d H:i:s", time());
            $tmp_content = self::$oUser->retrieve_Form_Data(self::$oUser->copy_content_field);

            if(self::$oUser->copy_content_field==''){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Query helper unable to build update search query due to missing oUser->copy_content_field data.');

            }

            $tmp_hash_algo = self::$oEnv->getEnvParam('COPY_HASH_ALGO');
            $tmp_copy_hash = hash($tmp_hash_algo, $tmp_content);

            self::$query .= 'UPDATE `wthrbg_lang_elem_search`
                SET
                `SEARCH_CONTENT` = "'.self::$mysqli->real_escape_string(strtolower(self::$oUser->searchCleanStr($tmp_content))).'",
                `SEARCH_HASH` = "'.$tmp_copy_hash.'",
                `LANG_ID` = "'.self::$mysqli->real_escape_string(strtolower(self::$oUser->retrieve_Form_Data('LANG_ID'))).'",
                `SEARCH_CONTENT_DISPLAY` = "'.self::$oUser->searchTruncStr($tmp_content, 2000).'",
                `SEARCH_CONTENT_BLOB` = "'.self::$mysqli->real_escape_string($tmp_content).'",
                `DATEMODIFIED` = "'.$ts.'"
                WHERE `ELEMENT_ID` = "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'"
                  AND `ELEMENT_ID_CRC32` = "'.crc32(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'"
                  LIMIT 1
                  ;
                ';


        } catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('boring_query_handler->generateSQL_update_search_content()', LOG_ERR, $e->getMessage());

            //
            // RETURN FALSE
            return false;
        }


    }

    private function generateSQL_new_translation_search_content(){

        try{

            $ts = date("Y-m-d H:i:s", time());
            $tmp_search_id = self::$oUser->generateNewKey(70);
            $tmp_content = self::$oUser->retrieve_Form_Data(self::$oUser->copy_content_field);
            $tmp_component_id = self::$oUser->retrieve_Form_Data('COMPONENT_ID');
            $tmp_page_id = self::$oUser->retrieve_Form_Data('PAGE_ID');
            $tmp_profile_id = self::$oUser->retrieve_Form_Data('PROFILE_ID');

            $tmp_hash_algo = self::$oEnv->getEnvParam('COPY_HASH_ALGO');
            $tmp_copy_hash = hash($tmp_hash_algo, $tmp_content);

            if($tmp_component_id!='' && $tmp_page_id!='' && $tmp_profile_id!=''){

                self::$query .= 'INSERT INTO `wthrbg_lang_elem_search`
                (`SEARCH_ID`,
                `SEARCH_CONTENT`,
                `SEARCH_HASH`,
                `LANG_ID`,
                `PROFILE_ID`,
                `PAGE_ID`,
                `PAGE_ID_CRC32`, 
                `ELEMENT_ID`,
                `ELEMENT_ID_CRC32`,
                `COMPONENT_ID`,
                `COMPONENT_ID_CRC32`,
                `COPY_ID`,
                `SEARCH_CONTENT_DISPLAY`,
                `SEARCH_CONTENT_BLOB`,
                `PROFILE_TYPE`,
                `COMPONENT_TYPE`,
                `DATEMODIFIED`)
                VALUES
                ("'.$tmp_search_id.'",
                "'.self::$mysqli->real_escape_string(strtolower(self::$oUser->searchCleanStr($tmp_content))).'", 
                "'.$tmp_copy_hash.'",
                "'.self::$mysqli->real_escape_string(strtolower(self::$oUser->retrieve_Form_Data('LANG_ID_TRANSLATOR'))).'",
                "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'",
                "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PAGE_ID')).'",
                "'.crc32(self::$oUser->retrieve_Form_Data('PAGE_ID')).'",
                "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('ELEMENT_ID_TRANSLATION')).'",
                "'.crc32(self::$oUser->retrieve_Form_Data('ELEMENT_ID_TRANSLATION')).'",
                "'.self::$mysqli->real_escape_string($tmp_component_id).'",
                "'.crc32($tmp_component_id).'",
                "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('COPY_ID')).'",
                "'.self::$oUser->searchTruncStr($tmp_content, 2000).'",
                "'.self::$mysqli->real_escape_string($tmp_content).'",
                "'.self::$oUser->copy_profile_type.'",
                "'.self::$oUser->copy_component_type.'",
                "'.$ts.'");
                ';

            }else{

                if($tmp_component_id=='' && $tmp_page_id!='' && $tmp_profile_id!=''){
                    self::$query .= 'INSERT INTO `wthrbg_lang_elem_search`
                    (`SEARCH_ID`,
                    `SEARCH_CONTENT`,
                    `SEARCH_HASH`,
                    `LANG_ID`,
                    `PROFILE_ID`,
                    `PAGE_ID`,
                    `PAGE_ID_CRC32`,
                    `ELEMENT_ID`,
                    `ELEMENT_ID_CRC32`,
                    `COPY_ID`,
                    `SEARCH_CONTENT_DISPLAY`,
                    `SEARCH_CONTENT_BLOB`,
                    `PROFILE_TYPE`,
                    `COMPONENT_TYPE`,
                    `DATEMODIFIED`)
                    VALUES
                    ("'.$tmp_search_id.'",
                    "'.self::$mysqli->real_escape_string(strtolower(self::$oUser->searchCleanStr($tmp_content))).'",
                    "'.$tmp_copy_hash.'",
                    "'.self::$mysqli->real_escape_string(strtolower(self::$oUser->retrieve_Form_Data('LANG_ID_TRANSLATOR'))).'",
                    "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'",
                    "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PAGE_ID')).'",
                    "'.crc32(self::$oUser->retrieve_Form_Data('PAGE_ID')).'",
                    "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('ELEMENT_ID_TRANSLATION')).'",
                    "'.crc32(self::$oUser->retrieve_Form_Data('ELEMENT_ID_TRANSLATION')).'",
                    "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('COPY_ID')).'",
                    "'.self::$oUser->searchTruncStr($tmp_content, 2000).'",
                    "'.self::$mysqli->real_escape_string($tmp_content).'",
                    "'.self::$oUser->copy_profile_type.'",
                    "'.self::$oUser->copy_component_type.'",
                    "'.$ts.'");
                    ';

                }else{

                    if($tmp_component_id=='' && $tmp_page_id=='' && $tmp_profile_id!=''){
                        self::$query .= 'INSERT INTO `wthrbg_lang_elem_search`
                        (`SEARCH_ID`,
                        `SEARCH_CONTENT`,
                        `SEARCH_HASH`,
                        `LANG_ID`,
                        `PROFILE_ID`,
                        `ELEMENT_ID`,
                        `ELEMENT_ID_CRC32`,
                        `COPY_ID`,
                        `SEARCH_CONTENT_DISPLAY`,
                        `SEARCH_CONTENT_BLOB`,
                        `PROFILE_TYPE`,
                        `COMPONENT_TYPE`,
                        `DATEMODIFIED`)
                        VALUES
                        ("'.$tmp_search_id.'",
                        "'.self::$mysqli->real_escape_string(strtolower(self::$oUser->searchCleanStr($tmp_content))).'",
                        "'.$tmp_copy_hash.'",
                        "'.self::$mysqli->real_escape_string(strtolower(self::$oUser->retrieve_Form_Data('LANG_ID_TRANSLATOR'))).'",
                        "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'",
                        "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('ELEMENT_ID_TRANSLATION')).'",
                        "'.crc32(self::$oUser->retrieve_Form_Data('ELEMENT_ID_TRANSLATION')).'",
                        "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('COPY_ID')).'",
                        "'.self::$oUser->searchTruncStr($tmp_content, 2000).'",
                        "'.self::$mysqli->real_escape_string($tmp_content).'",
                        "'.self::$oUser->copy_profile_type.'",
                        "'.self::$oUser->copy_component_type.'",
                        "'.$ts.'");
                        ';

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Query helper unable to build insert search query.');

                    }


                }


            }

        } catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('boring_query_handler->generateSQL_new_search_content()', LOG_ERR, $e->getMessage());

            //
            // RETURN FALSE
            return false;
        }

    }

    private function generateSQL_new_search_content(){

	    try{

            $ts = date("Y-m-d H:i:s", time());
            $tmp_search_id = self::$oUser->generateNewKey(70);
            $tmp_content = self::$oUser->retrieve_Form_Data(self::$oUser->copy_content_field);
            $tmp_component_id = self::$oUser->retrieve_Form_Data('COMPONENT_ID');
            $tmp_page_id = self::$oUser->retrieve_Form_Data('PAGE_ID');
            $tmp_profile_id = self::$oUser->retrieve_Form_Data('PROFILE_ID');

            $tmp_hash_algo = self::$oEnv->getEnvParam('COPY_HASH_ALGO');
            $tmp_copy_hash = hash($tmp_hash_algo, $tmp_content);

            if($tmp_component_id!='' && $tmp_page_id!='' && $tmp_profile_id!=''){

                self::$query .= 'INSERT INTO `wthrbg_lang_elem_search`
                (`SEARCH_ID`,
                `SEARCH_CONTENT`,
                `SEARCH_HASH`,
                `LANG_ID`,
                `PROFILE_ID`,
                `PAGE_ID`,
                `PAGE_ID_CRC32`,
                `ELEMENT_ID`,
                `ELEMENT_ID_CRC32`,
                `COMPONENT_ID`,
                `COMPONENT_ID_CRC32`,
                `COPY_ID`,
                `SEARCH_CONTENT_DISPLAY`,
                `SEARCH_CONTENT_BLOB`,
                `PROFILE_TYPE`,
                `COMPONENT_TYPE`,
                `DATEMODIFIED`)
                VALUES
                ("'.$tmp_search_id.'",
                "'.self::$mysqli->real_escape_string(strtolower(self::$oUser->searchCleanStr($tmp_content))).'",
                "'.$tmp_copy_hash.'",
                "'.self::$mysqli->real_escape_string(strtolower(self::$oUser->retrieve_Form_Data('LANG_ID'))).'",
                "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'",
                "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PAGE_ID')).'",
                "'.crc32(self::$oUser->retrieve_Form_Data('PAGE_ID')).'",
                "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'",
                "'.crc32(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'",
                "'.self::$mysqli->real_escape_string($tmp_component_id).'",
                "'.crc32($tmp_component_id).'",
                "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('COPY_ID')).'",
                "'.self::$oUser->searchTruncStr($tmp_content, 2000).'",
                "'.self::$mysqli->real_escape_string($tmp_content).'",
                "'.self::$oUser->copy_profile_type.'",
                "'.self::$oUser->copy_component_type.'",
                "'.$ts.'");
                ';

            }else{

                if($tmp_component_id=='' && $tmp_page_id!='' && $tmp_profile_id!=''){
                    self::$query .= 'INSERT INTO `wthrbg_lang_elem_search`
                    (`SEARCH_ID`,
                    `SEARCH_CONTENT`,
                    `SEARCH_HASH`,
                    `LANG_ID`,
                    `PROFILE_ID`,
                    `PAGE_ID`,
                    `PAGE_ID_CRC32`,
                    `ELEMENT_ID`,
                    `ELEMENT_ID_CRC32`,
                    `COPY_ID`,
                    `SEARCH_CONTENT_DISPLAY`,
                    `SEARCH_CONTENT_BLOB`,
                    `PROFILE_TYPE`,
                    `COMPONENT_TYPE`,
                    `DATEMODIFIED`)
                    VALUES
                    ("'.$tmp_search_id.'",
                    "'.self::$mysqli->real_escape_string(strtolower(self::$oUser->searchCleanStr($tmp_content))).'",
                    "'.$tmp_copy_hash.'",
                    "'.self::$mysqli->real_escape_string(strtolower(self::$oUser->retrieve_Form_Data('LANG_ID'))).'",
                    "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'",
                    "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PAGE_ID')).'",
                    "'.crc32(self::$oUser->retrieve_Form_Data('PAGE_ID')).'",
                    "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'",
                    "'.crc32(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'",
                    "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('COPY_ID')).'",
                    "'.self::$oUser->searchTruncStr($tmp_content, 2000).'",
                    "'.self::$mysqli->real_escape_string($tmp_content).'",
                    "'.self::$oUser->copy_profile_type.'",
                    "'.self::$oUser->copy_component_type.'",
                    "'.$ts.'");
                    ';

                }else{

                    if($tmp_component_id=='' && $tmp_page_id=='' && $tmp_profile_id!=''){
                        self::$query .= 'INSERT INTO `wthrbg_lang_elem_search`
                        (`SEARCH_ID`,
                        `SEARCH_CONTENT`,
                        `SEARCH_HASH`,
                        `LANG_ID`,
                        `PROFILE_ID`,
                        `ELEMENT_ID`,
                        `ELEMENT_ID_CRC32`,
                        `COPY_ID`,
                        `SEARCH_CONTENT_DISPLAY`,
                        `SEARCH_CONTENT_BLOB`,
                        `PROFILE_TYPE`,
                        `COMPONENT_TYPE`,
                        `DATEMODIFIED`)
                        VALUES
                        ("'.$tmp_search_id.'",
                        "'.self::$mysqli->real_escape_string(strtolower(self::$oUser->searchCleanStr($tmp_content))).'",
                        "'.$tmp_copy_hash.'",
                        "'.self::$mysqli->real_escape_string(strtolower(self::$oUser->retrieve_Form_Data('LANG_ID'))).'",
                        "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('PROFILE_ID')).'",
                        "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'",
                        "'.crc32(self::$oUser->retrieve_Form_Data('ELEMENT_ID')).'",
                        "'.self::$mysqli->real_escape_string(self::$oUser->retrieve_Form_Data('COPY_ID')).'",
                        "'.self::$oUser->searchTruncStr($tmp_content, 2000).'",
                        "'.self::$mysqli->real_escape_string($tmp_content).'",
                        "'.self::$oUser->copy_profile_type.'",
                        "'.self::$oUser->copy_component_type.'",
                        "'.$ts.'");
                        ';

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Query helper unable to build insert search query.');

                    }


                }


            }


        } catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('boring_query_handler->generateSQL_new_search_content()', LOG_ERR, $e->getMessage());

            //
            // RETURN FALSE
            return false;
        }

    }

    private function generateSQL_sync_event_to_day($fullscrn_profile_id, $fullscrn_page_id, $component_id, $day_id, $event_id, $event_element_id, $event_date, $date_day, $date_month, $date_year, $ISACTIVE=null){

        try{

            $ts = date("Y-m-d H:i:s", time());
            $userid = self::$oEnv->oSESSION_MGR->getSessionParam('USERID');

            //
            // DATE FORMATTING
            $tmp_date_hour = date("H", strtotime($event_date));
            $tmp_date_min = date("i", strtotime($event_date));
            $tmp_date_AMPM = date("A", strtotime($event_date));

            $tmp_event_date = date("Y-m-d H:i:s", strtotime($date_year.'-'.$date_month.'-'.$date_day.' '.$tmp_date_hour.':'.$tmp_date_min.':00 '.$tmp_date_AMPM));

            if(isset($ISACTIVE)){
                self::$query .= 'UPDATE `wthrbg_component_schedule_event`
                SET
                `DATE` = "'.$tmp_event_date.'",
                `ISACTIVE` = "'.$ISACTIVE.'",
                `MODIFIER_ID` = "'.$userid.'",
                `MODIFIER_IP_V6` = INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                `DATEMODIFIED` = "'.$ts.'"
                WHERE `EVENT_ID` = "'.self::$mysqli->real_escape_string($event_id).'"
                AND `ELEMENT_ID` = "'.self::$mysqli->real_escape_string($event_element_id).'"
                AND `ELEMENT_ID_CRC32` = "'.crc32($event_element_id).'"
                AND `DAY_ID` = "'.self::$mysqli->real_escape_string($day_id).'"
                AND `COMPONENT_ID` = "'.self::$mysqli->real_escape_string($component_id).'"
                AND `COMPONENT_ID_CRC32` = "'.crc32($component_id).'"
                AND `PAGE_ID` = "'.self::$mysqli->real_escape_string($fullscrn_page_id).'"
                AND `PROFILE_ID` = "'.$fullscrn_profile_id.'"
                LIMIT 1
                ;
                ';

                $this->generateSQL_mod_isactive_search_content($event_element_id, $ISACTIVE);

                //
                //  UPDATE LANG_ELEMENT TBL
                self::$query .= 'UPDATE `wthrbg_lang_elem_components`
                SET
                `ISACTIVE` = "'.$ISACTIVE.'",
                `MODIFIER_ID` = "'.$userid.'",
                `MODIFIER_IP_V6` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                `DATEMODIFIED` = "'.$ts.'"
                WHERE `ELEMENT_ID` = "'.self::$mysqli->real_escape_string($event_element_id).'"
                AND `ELEMENT_ID_CRC32` = "'.crc32($event_element_id).'"
                AND `COMPONENT_ID` = "'.self::$mysqli->real_escape_string($component_id).'"
                AND `COMPONENT_ID_CRC32` = "'.crc32($component_id).'"
                AND `PAGE_ID` = "'.self::$mysqli->real_escape_string($fullscrn_page_id).'"
                AND `PAGE_ID_CRC32` = "'.crc32($fullscrn_page_id).'"
                AND `PROFILE_ID` = "'.self::$mysqli->real_escape_string($fullscrn_profile_id).'"
                AND `PROFILE_ID_CRC32` = "'.crc32($fullscrn_profile_id).'"
                LIMIT 1
                ;
                ';

            }else{

                self::$query .= 'UPDATE `wthrbg_component_schedule_event`
                SET
                `DATE` = "'.self::$mysqli->real_escape_string($tmp_event_date).'",
                `MODIFIER_ID` = "'.$userid.'",
                `MODIFIER_IP_V6` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                `MODIFIER_IP` = INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                `MODIFIER_SESSION_ID` = "' . session_id() . '",
                `DATEMODIFIED` = "'.$ts.'"
                WHERE `EVENT_ID` = "'.self::$mysqli->real_escape_string($event_id).'"
                AND `ELEMENT_ID` = "'.self::$mysqli->real_escape_string($event_element_id).'"
                AND `ELEMENT_ID_CRC32` = "'.crc32($event_element_id).'"
                AND `DAY_ID` = "'.self::$mysqli->real_escape_string($day_id).'"
                AND `COMPONENT_ID` = "'.self::$mysqli->real_escape_string($component_id).'"
                AND `COMPONENT_ID_CRC32` = "'.crc32($component_id).'"
                AND `PAGE_ID` = "'.self::$mysqli->real_escape_string($fullscrn_page_id).'"
                AND `PROFILE_ID` = "'.self::$mysqli->real_escape_string($fullscrn_profile_id).'"
                LIMIT 1
                ;
                ';

            }


        } catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('boring_query_handler->generateSQL_sync_event_to_day()', LOG_ERR, $e->getMessage());

            //
            // RETURN FALSE
            return false;
        }


    }

    private function generateSQL_log_sys_user($element_id=null, $fullscrn_profile_id=null, $mini_profile_id=null, $fullscrn_page_id=null, $component_id=null, $obs_client_id=null){

	    try{

            $tmp_activityid = self::$oUser->generateNewKey(70);
            $userid = self::$oEnv->oSESSION_MGR->getSessionParam('USERID');

            //
            // ASSUMING EITHER CLIENT UPDATE OR PAGE/OVERLAY RELATED UPDATE
            if(isset($obs_client_id)){

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
                "'.$userid.'",
                "'.crc32($userid).'",
                "'.self::$mysqli->real_escape_string($obs_client_id).'",
                "'.crc32($obs_client_id).'",
                "'.self::$mysqli->real_escape_string(self::$oUser->searchTruncStr(self::$oUser->sys_activity_description, 1000)).'",
                "'.self::$mysqli->real_escape_string(self::$oUser->sys_activity_description).'",
                "' . session_id() . '",
                INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                "'.$_SERVER['HTTP_USER_AGENT'].'",
                "'.strtoupper(self::$oEnv->oSESSION_MGR->getSessionParam("DEVICETYPE")).'");
                ';

            }else{

                if($element_id!='' && $fullscrn_profile_id!='' && $fullscrn_page_id!='' && $component_id!=''){
                    self::$query .= 'INSERT INTO `wthrbg_log_sys_user`
                    (`ACTIVITY_ID`,
                    `MODIFIER_ID`,
                    `MODIFIER_ID_CRC32`,
                    `ELEMENT_ID`,
                    `ELEMENT_ID_CRC32`,
                    `FULL_SCRN_PROFILE_ID`,
                    `FULL_SCRN_PROFILE_ID_CRC32`,
                    `FULL_SCRN_PAGE_ID`,
                    `FULL_SCRN_PAGE_ID_CRC32`,
                    `COMPONENT_ID`,
                    `COMPONENT_ID_CRC32`,
                    `ACTIVITY_DESCRIPTION`,
                    `ACTIVITY_DESCRIPTION_BLOB`,
                    `PHPSESSION`,           
                    `IPADDRESS_V6`,
                    `IPADDRESS`,
                    `HTTP_USER_AGENT`,
                    `CHANNEL`)
                    VALUES
                    ("'.$tmp_activityid.'",
                    "'.$userid.'",
                    "'.crc32($userid).'",
                    "'.self::$mysqli->real_escape_string($element_id).'",
                    "'.crc32($element_id).'",
                    "'.self::$mysqli->real_escape_string($fullscrn_profile_id).'",
                    "'.crc32($fullscrn_profile_id).'",
                    "'.self::$mysqli->real_escape_string($fullscrn_page_id).'",
                    "'.crc32($fullscrn_page_id).'",
                    "'.self::$mysqli->real_escape_string($component_id).'",
                    "'.crc32($component_id).'",
                    "'.self::$mysqli->real_escape_string(self::$oUser->searchTruncStr(self::$oUser->sys_activity_description, 1000)).'",
                    "'.self::$mysqli->real_escape_string(self::$oUser->sys_activity_description).'",
                    "' . session_id() . '",
                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                    "'.$_SERVER['HTTP_USER_AGENT'].'",
                    "'.strtoupper(self::$oEnv->oSESSION_MGR->getSessionParam("DEVICETYPE")).'");
                    ';

                }else{

                    if($element_id=='' && $fullscrn_profile_id!='' && $fullscrn_page_id!='' && $component_id==''){

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
                        "'.$userid.'",
                        "'.crc32($userid).'",
                        "'.self::$mysqli->real_escape_string($fullscrn_profile_id).'",
                        "'.crc32($fullscrn_profile_id).'",
                        "'.self::$mysqli->real_escape_string($fullscrn_page_id).'",
                        "'.crc32($fullscrn_page_id).'",
                        "'.self::$mysqli->real_escape_string(self::$oUser->searchTruncStr(self::$oUser->sys_activity_description, 1000)).'",
                        "'.self::$mysqli->real_escape_string(self::$oUser->sys_activity_description).'",
                        "' . session_id() . '",
                        INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        "'.$_SERVER['HTTP_USER_AGENT'].'",
                        "'.strtoupper(self::$oEnv->oSESSION_MGR->getSessionParam("DEVICETYPE")).'");
                        ';


                    }else{

                        if($element_id!='' && $fullscrn_profile_id!='' && $fullscrn_page_id!='' && $component_id==''){

                            self::$query .= 'INSERT INTO `wthrbg_log_sys_user`
                            (`ACTIVITY_ID`,
                            `MODIFIER_ID`,
                            `MODIFIER_ID_CRC32`,
                            `ELEMENT_ID`,
                            `ELEMENT_ID_CRC32`,
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
                            "'.$userid.'",
                            "'.crc32($userid).'",
                            "'.self::$mysqli->real_escape_string($element_id).'",
                            "'.crc32($element_id).'",
                            "'.self::$mysqli->real_escape_string($fullscrn_profile_id).'",
                            "'.crc32($fullscrn_profile_id).'",
                            "'.self::$mysqli->real_escape_string($fullscrn_page_id).'",
                            "'.crc32($fullscrn_page_id).'",
                            "'.self::$mysqli->real_escape_string(self::$oUser->searchTruncStr(self::$oUser->sys_activity_description, 1000)).'",
                            "'.self::$mysqli->real_escape_string(self::$oUser->sys_activity_description).'",
                            "' . session_id() . '",
                            INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                            "'.$_SERVER['HTTP_USER_AGENT'].'",
                            "'.strtoupper(self::$oEnv->oSESSION_MGR->getSessionParam("DEVICETYPE")).'");
                            ';


                        }else{

                            if($element_id=='' && $fullscrn_profile_id!='' && $fullscrn_page_id!='' && $component_id!='') {

                                self::$query .= 'INSERT INTO `wthrbg_log_sys_user`
                                (`ACTIVITY_ID`,
                                `MODIFIER_ID`,
                                `MODIFIER_ID_CRC32`,
                                `FULL_SCRN_PROFILE_ID`,
                                `FULL_SCRN_PROFILE_ID_CRC32`,
                                `FULL_SCRN_PAGE_ID`,
                                `FULL_SCRN_PAGE_ID_CRC32`,
                                `COMPONENT_ID`,
                                `COMPONENT_ID_CRC32`,
                                `ACTIVITY_DESCRIPTION`,
                                `ACTIVITY_DESCRIPTION_BLOB`,
                                `PHPSESSION`,
                                `IPADDRESS_V6`,
                                `IPADDRESS`,
                                `HTTP_USER_AGENT`,
                                `CHANNEL`)
                                VALUES
                                ("'.$tmp_activityid.'",
                                "'.$userid.'",
                                "'.crc32($userid).'",
                                "'.self::$mysqli->real_escape_string($fullscrn_profile_id).'",
                                "'.crc32($fullscrn_profile_id).'",
                                "'.self::$mysqli->real_escape_string($fullscrn_page_id).'",
                                "'.crc32($fullscrn_page_id).'",
                                "'.self::$mysqli->real_escape_string($component_id).'",
                                "'.crc32($component_id).'",
                                "'.self::$mysqli->real_escape_string(self::$oUser->searchTruncStr(self::$oUser->sys_activity_description, 1000)).'",
                                "'.self::$mysqli->real_escape_string(self::$oUser->sys_activity_description).'",
                                "' . session_id() . '",
                                INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                "'.$_SERVER['HTTP_USER_AGENT'].'",
                                "'.strtoupper(self::$oEnv->oSESSION_MGR->getSessionParam("DEVICETYPE")).'");
                                ';

                            }else{

                                if($element_id=='' && $fullscrn_profile_id=='' && $fullscrn_page_id=='' && $component_id=='') {

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
                                    "'.$userid.'",
                                    "'.crc32($userid).'",
                                    "'.self::$mysqli->real_escape_string(self::$oUser->searchTruncStr(self::$oUser->sys_activity_description, 1000)).'",
                                    "'.self::$mysqli->real_escape_string(self::$oUser->sys_activity_description).'",
                                    "' . session_id() . '",
                                    INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                    INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                                    "'.$_SERVER['HTTP_USER_AGENT'].'",
                                    "'.strtoupper(self::$oEnv->oSESSION_MGR->getSessionParam("DEVICETYPE")).'");
                                    ';

                                }else{

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    throw new Exception('Unknown or unhandled method parameter state. No query generated.');

                                }
                            }

                        }

                    }

                }

            }

        } catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('boring_query_handler->generateSQL_log_sys_user()', LOG_ERR, $e->getMessage());

            //
            // RETURN FALSE
            return false;
        }

    }

	public function __destruct() {
		
	}
}