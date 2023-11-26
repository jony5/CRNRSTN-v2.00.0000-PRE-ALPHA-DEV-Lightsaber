<?php
/* 
// J5
// Code is Poetry */

class database_integration {
	private static $oLogger;
	
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
	
	public function svc_searchResultsSuggest($oUser, $oUserEnvironment, $contentType){
		return $this->dbQuery($contentType, $oUserEnvironment, $oUser);
	}
	
	public function svc_getSearchResultsFull($oUser, $oUserEnvironment, $contentType){
		return $this->dbQuery($contentType, $oUserEnvironment, $oUser);
	}
	
	public function updateContent_CRNRSTN($oUser, $oUserEnvironment , $contentType){
		return $this->dbQuery($contentType, $oUserEnvironment, $oUser);
	}
	
	public function svc_getClass($oService, $oWebServiceEnvironment){
		return $this->dbQuery('svc_getclass', $oWebServiceEnvironment, $oService);
	}
	
	public function svc_getClass_PlusNav($oService, $oWebServiceEnvironment){
		return $this->dbQuery('svc_getclass_PlusNav', $oWebServiceEnvironment, $oService);
	}
	
	public function svc_getClassComments($oService, $oWebServiceEnvironment){
		return $this->dbQuery('svc_getClassComments', $oWebServiceEnvironment, $oService);
	}
	
	public function svc_getMethod($oService, $oWebServiceEnvironment){
		return $this->dbQuery('svc_getmethod', $oWebServiceEnvironment, $oService);
	}
	
	public function svc_getMethod_PlusNav($oService, $oWebServiceEnvironment){
		return $this->dbQuery('svc_getmethod_PlusNav', $oWebServiceEnvironment, $oService);
	}
	
	public function svc_getMethodComments($oService, $oWebServiceEnvironment){
		return $this->dbQuery('svc_getMethodComments', $oWebServiceEnvironment, $oService);
	}
	
	public function svc_getNav($oService, $oWebServiceEnvironment){
		return $this->dbQuery('svc_getnav', $oWebServiceEnvironment, $oService);
	}
	
	public function svc_getToolTip($oService, $oWebServiceEnvironment){
		return $this->dbQuery('svc_getToolTip', $oWebServiceEnvironment, $oService);
	}
		
	public function svc_getAllToolTips($oUser, $oUserEnvironment){
		return $this->dbQuery('svc_getAllToolTips', $oUserEnvironment, $oUser);
	}
	
	public function svc_postUserFeedback($oUser, $oUserEnvironment){
		return $this->dbQuery('svc_postUserFeedback', $oUserEnvironment, $oUser);
	}
	
	public function svc_getCommInsertStatus($oService, $oWebServiceEnvironment){
		return $this->dbQuery('svc_getCommInsertStatus', $oWebServiceEnvironment, $oService);
	}
	
	public function svc_getUserCommentbyID($oService, $oWebServiceEnvironment){
		return $this->dbQuery('svc_getUserCommentbyID', $oWebServiceEnvironment, $oService);
	}
	
	public function svc_postUserComment($oService, $oWebServiceEnvironment){
		return $this->dbQuery('svc_postUserComment', $oWebServiceEnvironment, $oService);
	}
	
	public function svc_deleteUserComment($oService, $oWebServiceEnvironment){
		return $this->dbQuery('svc_deleteUserComment', $oWebServiceEnvironment, $oService);
	}
	
	public function svc_updateUserComment($oService, $oWebServiceEnvironment){
		return $this->dbQuery('svc_updateUserComment', $oWebServiceEnvironment, $oService);
	}
	
	public function svc_submitExamples($oService, $oWebServiceEnvironment){
		return $this->dbQuery('svc_submitExamples', $oWebServiceEnvironment, $oService);
	}
	
	public function svc_isValidLoginData($oUser, $oUserEnvironment){
		return $this->dbQuery('svc_isValidLoginData', $oUserEnvironment, $oUser);
	}
	
	public function svc_isUnUnique($oUser, $oUserEnvironment){
		//
		// CHECK FOR USERNAME COLLISION
		return $this->dbQuery('svc_isUserUnique', $oUserEnvironment, $oUser);
	}
	
	public function svc_activateNewUser($oUser, $oUserEnvironment){
		return $this->dbQuery('svc_activateNewUser', $oUserEnvironment, $oUser);
	}
	
	public function svc_creatNewUser($oUser, $oUserEnvironment){
		return $this->dbQuery('svc_creatNewUser', $oUserEnvironment, $oUser);
	}
	
	public function svc_updateUserSettings($oUser, $oUserEnvironment){
		return $this->dbQuery('svc_updateUserSettings', $oUserEnvironment, $oUser);
	}
	
	public function svc_updateUserProfile($oUser, $oUserEnvironment){
		return $this->dbQuery('svc_updateUserProfile', $oUserEnvironment, $oUser);
	}

	public function svc_retrieveUserAccnt_PlusNav($oUser, $oUserEnvironment){
		return $this->dbQuery('svc_retrieveUserAccnt_PlusNav', $oUserEnvironment, $oUser);
	}
	
	public function svc_retrieveUserAccnt($oUser, $oUserEnvironment){
		return $this->dbQuery('svc_retrieveUserAccnt', $oUserEnvironment, $oUser);
	}
	
	private function dbQuery($queryType, $oUserEnvironment, $oUser){
		try{
			error_log('/crnrstn/ database.inc.php (127) ** NOT THIS DB CLASS. USE /services/ ** queryType sent to user database_integrations class object :: '.$queryType);
			$ts = date("Y-m-d H:i:s", time()-60*60*6);
			
			//
			// OPEN CONNECTION
			$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->returnConnection();
						
			switch($queryType){
				case 'searchall':
					self::$query = '';
					$skip_str_ARRAY = array('a', 'the', 'i', 'and', 'but');
					
					$tmp_search_params = $oUser->getReqParamByKey('SEARCH_PARAM');
					$pos = strpos($tmp_search_params, '"');
					if($pos===false){
						
						//
						// SEARCH ON INDIVIDUAL WORDS
						#$tmp_search_param_ARRAY = explode(' ',$mysqli->real_escape_string($tmp_search_params));
						$tmp_search_param_ARRAY = explode(' ',$tmp_search_params);
						
						//
						// BUILD QUERY
						foreach($tmp_search_param_ARRAY as $key=>$val){
							if(!in_array($val, $skip_str_ARRAY)){
								$val = $oUser->getReqParamByKey('SEARCH_PARAM_SEARCH');
								
								//
								// CRNRSTN CONTENT :: RETURN ALL RESULTS
								if(strtolower($oUser->getReqParamByKey('FILTER'))=='all' || $oUser->getReqParamByKey('FILTER')==''){
									self::$query .= 'SELECT `crnrstn_class`.`NAME`,`crnrstn_class`.`DESCRIPTION`,`crnrstn_class`.`URI` FROM `crnrstn_class` WHERE `crnrstn_class`.`NAME` LIKE "%'.$val.'%" OR `crnrstn_class`.`DESCRIPTION_SEARCH` LIKE "%'.$val.'%";';
									self::$query .= 'SELECT `crnrstn_method`.`NAME`,`crnrstn_method`.`DESCRIPTION`,`crnrstn_method`.`URI` FROM `crnrstn_method` WHERE `crnrstn_method`.`NAME` LIKE "%'.$val.'%" OR `crnrstn_method`.`DESCRIPTION_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_method`.`DEFINITION_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_method`.`RETURNED_SEARCH` LIKE "%'.$val.'%";';
									self::$query .= 'SELECT `crnrstn_examples`.`TITLE`,`crnrstn_examples`.`DESCRIPTION`,`crnrstn_examples`.`URI` FROM `crnrstn_examples` WHERE `crnrstn_examples`.`TITLE_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_examples`.`EXAMPLE_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_examples`.`DESCRIPTION_SEARCH` LIKE "%'.$val.'%";';
									self::$query .= 'SELECT `crnrstn_params`.`NAME`,`crnrstn_params`.`DESCRIPTION`,`crnrstn_params`.`URI` FROM `crnrstn_params` WHERE `crnrstn_params`.`NAME` LIKE "%'.$val.'%" OR `crnrstn_params`.`DESCRIPTION_SEARCH` LIKE "%'.$val.'%";';
									self::$query .= 'SELECT `crnrstn_techspecs`.`TECHSPEC_CONTENT`,`crnrstn_techspecs`.`URI` FROM `crnrstn_techspecs` WHERE `crnrstn_techspecs`.`TECHSPEC_SEARCH` LIKE "%'.$val.'%";';
								
									//
									// UGC CONTENT :: INTEGRATION OF PAGINATION INTO SQL?
									if($oUser->getReqParamByKey('USERNAME')!=''){
										self::$query .= 'SELECT `crnrstn_ugc_search`.`NOTEID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH`,`crnrstn_ugc_search`.`SUBJECT`,`crnrstn_ugc_search`.`CLASSID_SOURCE`,`crnrstn_ugc_search`.`METHODID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH` FROM `crnrstn_ugc_search` WHERE (`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_ugc_search`.`SUBJECT` LIKE "%'.$val.'%") AND (`crnrstn_ugc_search`.`ISACTIVE`="1" || `crnrstn_ugc_search`.`ISACTIVE`="2");';
										#self::$query .= 'SELECT `crnrstn_ugc_search`.`NOTEID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH`,`crnrstn_ugc_search`.`SUBJECT`,`crnrstn_ugc_search`.`CLASSID_SOURCE`,`crnrstn_ugc_search`.`METHODID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH` FROM `crnrstn_ugc_search`;';
									}else{
										self::$query .= 'SELECT `crnrstn_ugc_search`.`NOTEID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH`,`crnrstn_ugc_search`.`SUBJECT`,`crnrstn_ugc_search`.`CLASSID_SOURCE`,`crnrstn_ugc_search`.`METHODID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH` FROM `crnrstn_ugc_search` WHERE (`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_ugc_search`.`SUBJECT` LIKE "%'.$val.'%") AND `crnrstn_ugc_search`.`ISACTIVE`="2";';
										#self::$query .= 'SELECT `crnrstn_ugc_search`.`NOTEID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH`,`crnrstn_ugc_search`.`SUBJECT`,`crnrstn_ugc_search`.`CLASSID_SOURCE`,`crnrstn_ugc_search`.`METHODID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH` FROM `crnrstn_ugc_search`;';
									}
								}else{
									if(strtolower($oUser->getReqParamByKey('FILTER'))=='ugc'){
										if($oUser->getReqParamByKey('USERNAME')!=''){
											self::$query .= 'SELECT `crnrstn_ugc_search`.`NOTEID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH`,`crnrstn_ugc_search`.`SUBJECT`,`crnrstn_ugc_search`.`CLASSID_SOURCE`,`crnrstn_ugc_search`.`METHODID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH` FROM `crnrstn_ugc_search` WHERE (`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_ugc_search`.`SUBJECT` LIKE "%'.$val.'%") AND (`crnrstn_ugc_search`.`ISACTIVE`="1" || `crnrstn_ugc_search`.`ISACTIVE`="2");';
											#self::$query .= 'SELECT `crnrstn_ugc_search`.`NOTEID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH`,`crnrstn_ugc_search`.`SUBJECT`,`crnrstn_ugc_search`.`CLASSID_SOURCE`,`crnrstn_ugc_search`.`METHODID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH` FROM `crnrstn_ugc_search`;';
										}else{
											self::$query .= 'SELECT `crnrstn_ugc_search`.`NOTEID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH`,`crnrstn_ugc_search`.`SUBJECT`,`crnrstn_ugc_search`.`CLASSID_SOURCE`,`crnrstn_ugc_search`.`METHODID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH` FROM `crnrstn_ugc_search` WHERE (`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_ugc_search`.`SUBJECT` LIKE "%'.$val.'%") AND `crnrstn_ugc_search`.`ISACTIVE`="2";';
											#self::$query .= 'SELECT `crnrstn_ugc_search`.`NOTEID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH`,`crnrstn_ugc_search`.`SUBJECT`,`crnrstn_ugc_search`.`CLASSID_SOURCE`,`crnrstn_ugc_search`.`METHODID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH` FROM `crnrstn_ugc_search`;';
										}	
									}else{
										if(strtolower($oUser->getReqParamByKey('FILTER'))=='code'){
											self::$query .= 'SELECT `crnrstn_examples`.`TITLE`,`crnrstn_examples`.`DESCRIPTION`,`crnrstn_examples`.`URI` FROM `crnrstn_examples` WHERE `crnrstn_examples`.`TITLE_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_examples`.`EXAMPLE_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_examples`.`DESCRIPTION_SEARCH` LIKE "%'.$val.'%";';
										}else{
											self::$query .= 'SELECT `crnrstn_class`.`NAME`,`crnrstn_class`.`DESCRIPTION`,`crnrstn_class`.`URI` FROM `crnrstn_class` WHERE `crnrstn_class`.`NAME` LIKE "%'.$val.'%" OR `crnrstn_class`.`DESCRIPTION_SEARCH` LIKE "%'.$val.'%";';
											self::$query .= 'SELECT `crnrstn_method`.`NAME`,`crnrstn_method`.`DESCRIPTION`,`crnrstn_method`.`URI` FROM `crnrstn_method` WHERE `crnrstn_method`.`NAME` LIKE "%'.$val.'%" OR `crnrstn_method`.`DESCRIPTION_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_method`.`DEFINITION_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_method`.`RETURNED_SEARCH` LIKE "%'.$val.'%";';									
											self::$query .= 'SELECT `crnrstn_params`.`NAME`,`crnrstn_params`.`DESCRIPTION`,`crnrstn_params`.`URI` FROM `crnrstn_params` WHERE `crnrstn_params`.`NAME` LIKE "%'.$val.'%" OR `crnrstn_params`.`DESCRIPTION_SEARCH` LIKE "%'.$val.'%";';
											self::$query .= 'SELECT `crnrstn_techspecs`.`TECHSPEC_CONTENT`,`crnrstn_techspecs`.`URI` FROM `crnrstn_techspecs` WHERE `crnrstn_techspecs`.`TECHSPEC_SEARCH` LIKE "%'.$val.'%";';	
										}
									}
								}
							}
						}
					}else{
						#$val = $mysqli->real_escape_string($tmp_search_params);
						$val = $tmp_search_params;
						if(!in_array($val, $skip_str_ARRAY)){
							
							$val = $oUser->getReqParamByKey('SEARCH_PARAM_SEARCH');
							
							//
							// CRNRSTN CONTENT :: RETURN ALL RESULTS
							if(strtolower($oUser->getReqParamByKey('FILTER'))=='all' || $oUser->getReqParamByKey('FILTER')==''){
							
								self::$query .= 'SELECT `crnrstn_class`.`NAME`,`crnrstn_class`.`DESCRIPTION`,`crnrstn_class`.`URI` FROM `crnrstn_class` WHERE `crnrstn_class`.`NAME` LIKE "%'.$val.'%" OR `crnrstn_class`.`DESCRIPTION_SEARCH` LIKE "%'.$val.'%";';
								self::$query .= 'SELECT `crnrstn_method`.`NAME`,`crnrstn_method`.`DESCRIPTION`,`crnrstn_method`.`URI` FROM `crnrstn_method` WHERE `crnrstn_method`.`NAME` LIKE "%'.$val.'%" OR `crnrstn_method`.`DESCRIPTION_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_method`.`DEFINITION_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_method`.`RETURNED_SEARCH` LIKE "%'.$val.'%";';
								self::$query .= 'SELECT `crnrstn_examples`.`TITLE`,`crnrstn_examples`.`DESCRIPTION`,`crnrstn_examples`.`URI` FROM `crnrstn_examples` WHERE `crnrstn_examples`.`TITLE_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_examples`.`EXAMPLE_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_examples`.`DESCRIPTION_SEARCH` LIKE "%'.$val.'%";';								
								self::$query .= 'SELECT `crnrstn_params`.`NAME`,`crnrstn_params`.`DESCRIPTION`,`crnrstn_params`.`URI` FROM `crnrstn_params` WHERE `crnrstn_params`.`NAME` LIKE "%'.$val.'%" OR `crnrstn_params`.`DESCRIPTION_SEARCH` LIKE "%'.$val.'%";';
								self::$query .= 'SELECT `crnrstn_techspecs`.`TECHSPEC_CONTENT`,`crnrstn_techspecs`.`URI` FROM `crnrstn_techspecs` WHERE `crnrstn_techspecs`.`TECHSPEC_SEARCH` LIKE "%'.$val.'%";';
							
								//
								// UGC CONTENT :: INTEGRATION OF PAGINATION INTO SQL?
								if($oUser->getReqParamByKey('USERNAME')!=''){
									self::$query .= 'SELECT `crnrstn_ugc_search`.`NOTEID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH`,`crnrstn_ugc_search`.`SUBJECT`,`crnrstn_ugc_search`.`CLASSID_SOURCE`,`crnrstn_ugc_search`.`METHODID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH` FROM `crnrstn_ugc_search` WHERE (`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_ugc_search`.`SUBJECT` LIKE "%'.$val.'%") AND (`crnrstn_ugc_search`.`ISACTIVE`="1" || `crnrstn_ugc_search`.`ISACTIVE`="2");';
									#self::$query .= 'SELECT `crnrstn_ugc_search`.`NOTEID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH`,`crnrstn_ugc_search`.`SUBJECT`,`crnrstn_ugc_search`.`CLASSID_SOURCE`,`crnrstn_ugc_search`.`METHODID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH` FROM `crnrstn_ugc_search`;';
								}else{
									self::$query .= 'SELECT `crnrstn_ugc_search`.`NOTEID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH`,`crnrstn_ugc_search`.`SUBJECT`,`crnrstn_ugc_search`.`CLASSID_SOURCE`,`crnrstn_ugc_search`.`METHODID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH` FROM `crnrstn_ugc_search` WHERE (`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_ugc_search`.`SUBJECT` LIKE "%'.$val.'%") AND `crnrstn_ugc_search`.`ISACTIVE`="2";';
									#self::$query .= 'SELECT `crnrstn_ugc_search`.`NOTEID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH`,`crnrstn_ugc_search`.`SUBJECT`,`crnrstn_ugc_search`.`CLASSID_SOURCE`,`crnrstn_ugc_search`.`METHODID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH` FROM `crnrstn_ugc_search`;';
								}
							}else{
								if(strtolower($oUser->getReqParamByKey('FILTER'))=='ugc'){
									if($oUser->getReqParamByKey('USERNAME')!=''){
										self::$query .= 'SELECT `crnrstn_ugc_search`.`NOTEID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH`,`crnrstn_ugc_search`.`SUBJECT`,`crnrstn_ugc_search`.`CLASSID_SOURCE`,`crnrstn_ugc_search`.`METHODID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH` FROM `crnrstn_ugc_search` WHERE (`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_ugc_search`.`SUBJECT` LIKE "%'.$val.'%") AND (`crnrstn_ugc_search`.`ISACTIVE`="1" || `crnrstn_ugc_search`.`ISACTIVE`="2");';
										#self::$query .= 'SELECT `crnrstn_ugc_search`.`NOTEID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH`,`crnrstn_ugc_search`.`SUBJECT`,`crnrstn_ugc_search`.`CLASSID_SOURCE`,`crnrstn_ugc_search`.`METHODID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH` FROM `crnrstn_ugc_search`;';
									}else{
										self::$query .= 'SELECT `crnrstn_ugc_search`.`NOTEID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH`,`crnrstn_ugc_search`.`SUBJECT`,`crnrstn_ugc_search`.`CLASSID_SOURCE`,`crnrstn_ugc_search`.`METHODID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH` FROM `crnrstn_ugc_search` WHERE (`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_ugc_search`.`SUBJECT` LIKE "%'.$val.'%") AND `crnrstn_ugc_search`.`ISACTIVE`="2";';
										#self::$query .= 'SELECT `crnrstn_ugc_search`.`NOTEID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH`,`crnrstn_ugc_search`.`SUBJECT`,`crnrstn_ugc_search`.`CLASSID_SOURCE`,`crnrstn_ugc_search`.`METHODID_SOURCE`,`crnrstn_ugc_search`.`NOTE_ELEM_SEARCH` FROM `crnrstn_ugc_search`;';
									}	
								}else{
									if(strtolower($oUser->getReqParamByKey('FILTER'))=='code'){
										self::$query .= 'SELECT `crnrstn_examples`.`TITLE`,`crnrstn_examples`.`DESCRIPTION`,`crnrstn_examples`.`URI` FROM `crnrstn_examples` WHERE `crnrstn_examples`.`TITLE_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_examples`.`EXAMPLE_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_examples`.`DESCRIPTION_SEARCH` LIKE "%'.$val.'%";';
									}else{
										self::$query .= 'SELECT `crnrstn_class`.`NAME`,`crnrstn_class`.`DESCRIPTION`,`crnrstn_class`.`URI` FROM `crnrstn_class` WHERE `crnrstn_class`.`NAME` LIKE "%'.$val.'%" OR `crnrstn_class`.`DESCRIPTION_SEARCH` LIKE "%'.$val.'%";';
										self::$query .= 'SELECT `crnrstn_method`.`NAME`,`crnrstn_method`.`DESCRIPTION`,`crnrstn_method`.`URI` FROM `crnrstn_method` WHERE `crnrstn_method`.`NAME` LIKE "%'.$val.'%" OR `crnrstn_method`.`DESCRIPTION_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_method`.`DEFINITION_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_method`.`RETURNED_SEARCH` LIKE "%'.$val.'%";';									
										self::$query .= 'SELECT `crnrstn_params`.`NAME`,`crnrstn_params`.`DESCRIPTION`,`crnrstn_params`.`URI` FROM `crnrstn_params` WHERE `crnrstn_params`.`NAME` LIKE "%'.$val.'%" OR `crnrstn_params`.`DESCRIPTION_SEARCH` LIKE "%'.$val.'%";';
										self::$query .= 'SELECT `crnrstn_techspecs`.`TECHSPEC_CONTENT`,`crnrstn_techspecs`.`URI` FROM `crnrstn_techspecs` WHERE `crnrstn_techspecs`.`TECHSPEC_SEARCH` LIKE "%'.$val.'%";';	
									}
								}
							}
						}
					}
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query);
					if($mysqli->error){
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					
					}else{
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						$ROWCNT=0;
						do {
							if (self::$result = $mysqli->store_result()) {
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
					
							if ($mysqli->more_results()) {
								//
								// END OF RECORD. MORE TO FOLLOW.
							}
						} while ($mysqli->next_result());
						
						//
						// CLOSE CONNECTION
						$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);
						
						//
						// RETURN RESULT SET ARRAY
						return self::$result_ARRAY;
					}
				
				break;
				case 'suggestsearch':
					self::$query = '';
					$skip_str_ARRAY = array('a', 'the', 'i', 'and', 'but');

					$tmp_search_params = $oUser->getReqParamByKey('SEARCH_PARAM');
					$pos = strpos($tmp_search_params, '"');
					if($pos===false){
					
						//
						// SEARCH ON INDIVIDUAL WORDS
						#$tmp_search_param_ARRAY = explode(' ',$mysqli->real_escape_string($tmp_search_params));
						$tmp_search_param_ARRAY = explode(' ',$tmp_search_params);
						
						//
						// BUILD QUERY
						foreach($tmp_search_param_ARRAY as $key=>$val){
							if(!in_array($val, $skip_str_ARRAY)){	
								$val = $oUser->getReqParamByKey('SEARCH_PARAM_SEARCH');
								self::$query .= 'SELECT `crnrstn_class`.`NAME`,`crnrstn_class`.`DESCRIPTION` FROM `crnrstn_class` WHERE `crnrstn_class`.`NAME` LIKE "%'.$val.'%" OR `crnrstn_class`.`DESCRIPTION_SEARCH` LIKE "%'.$val.'%";';
								self::$query .= 'SELECT `crnrstn_method`.`NAME`,`crnrstn_method`.`DESCRIPTION` FROM `crnrstn_method` WHERE `crnrstn_method`.`NAME` LIKE "%'.$val.'%" OR `crnrstn_method`.`DESCRIPTION_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_method`.`DEFINITION_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_method`.`RETURNED_SEARCH` LIKE "%'.$val.'%";';
								self::$query .= 'SELECT `crnrstn_examples`.`TITLE`,`crnrstn_examples`.`DESCRIPTION` FROM `crnrstn_examples` WHERE `crnrstn_method`.`TITLE_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_method`.`EXAMPLE_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_method`.`DESCRIPTION_SEARCH` LIKE "%'.$val.'%";';
								self::$query .= 'SELECT `crnrstn_params`.`NAME`,`crnrstn_params`.`DESCRIPTION` FROM `crnrstn_params` WHERE `crnrstn_method`.`NAME` LIKE "%'.$val.'%" OR `crnrstn_method`.`DESCRIPTION_SEARCH` LIKE "%'.$val.'%";';
								self::$query .= 'SELECT `crnrstn_techspecs`.`NAME` FROM `crnrstn_techspecs` WHERE `crnrstn_techspecs`.`TECHSPEC_SEARCH` LIKE "%'.$val.'%";';
							}
						}
					}else{
						#$val = $mysqli->real_escape_string($tmp_search_params);
						$val = $tmp_search_params;
						if(!in_array($val, $skip_str_ARRAY)){
							$val = $oUser->getReqParamByKey('SEARCH_PARAM_SEARCH');
							self::$query .= 'SELECT `crnrstn_class`.`NAME`,`crnrstn_class`.`DESCRIPTION`,`crnrstn_class`.`URI` FROM `crnrstn_class` WHERE `crnrstn_class`.`NAME` LIKE "%'.$val.'%" OR `crnrstn_class`.`DESCRIPTION_SEARCH` LIKE "%'.$val.'%";';
							self::$query .= 'SELECT `crnrstn_method`.`NAME`,`crnrstn_method`.`DESCRIPTION` FROM `crnrstn_method` WHERE `crnrstn_method`.`NAME` LIKE "%'.$val.'%" OR `crnrstn_method`.`DESCRIPTION_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_method`.`DEFINITION_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_method`.`RETURNED_SEARCH` LIKE "%'.$val.'%";';
							self::$query .= 'SELECT `crnrstn_examples`.`TITLE`,`crnrstn_examples`.`DESCRIPTION` FROM `crnrstn_examples` WHERE `crnrstn_method`.`TITLE_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_method`.`EXAMPLE_SEARCH` LIKE "%'.$val.'%" OR `crnrstn_method`.`DESCRIPTION_SEARCH` LIKE "%'.$val.'%";';
							self::$query .= 'SELECT `crnrstn_params`.`NAME`,`crnrstn_params`.`DESCRIPTION` FROM `crnrstn_params` WHERE `crnrstn_method`.`NAME` LIKE "%'.$val.'%" OR `crnrstn_method`.`DESCRIPTION_SEARCH` LIKE "%'.$val.'%";';
							self::$query .= 'SELECT `crnrstn_techspecs`.`NAME` FROM `crnrstn_techspecs` WHERE `crnrstn_techspecs`.`TECHSPEC_SEARCH` LIKE "%'.$val.'%";';
						}
					}
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query);
					if($mysqli->error){
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					
					}else{
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						$ROWCNT=0;
						do {
							if (self::$result = $mysqli->store_result()) {
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
					
							if ($mysqli->more_results()) {
								//
								// END OF RECORD. MORE TO FOLLOW.
							}
						} while ($mysqli->next_result());
						
						//
						// CLOSE CONNECTION
						$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);
						
						//
						// RETURN RESULT SET ARRAY
						return self::$result_ARRAY;
					}	
								
				break;
				case 'svc_getclass':
				case 'svc_getclass_PlusNav':
				case 'svc_getClassComments':
					//
					// BUILD QUERY
					if($queryType!='svc_getClassComments'){
						self::$query = 'SELECT `crnrstn_class`.`NAME`,`crnrstn_class`.`DESCRIPTION`,`crnrstn_class`.`VERSION`,`crnrstn_class`.`URI`,`crnrstn_class`.`LANGCODE`,`crnrstn_class`.`DATEMODIFIED`,`crnrstn_method`.`METHODID_SOURCE`,`crnrstn_method`.`NAME`,`crnrstn_method`.`DESCRIPTION`,`crnrstn_method`.`DEFINITION`,`crnrstn_method`.`RETURNED_VALUE`,`crnrstn_method`.`URI`,`crnrstn_method`.`LANGCODE`,`crnrstn_method`.`ISACTIVE`,`crnrstn_method`.`DATEMODIFIED`,`crnrstn_techspecs`.`TECHSPECID_SOURCE`,`crnrstn_techspecs`.`TECHSPEC_CONTENT`,`crnrstn_techspecs`.`LANGCODE`,`crnrstn_techspecs`.`ISACTIVE`,`crnrstn_techspecs`.`DATEMODIFIED`,`crnrstn_examples`.`EXAMPLEID_SOURCE`,`crnrstn_examples`.`TITLE`,`crnrstn_examples`.`EXAMPLE_FORMATTED`,`crnrstn_examples`.`EXAMPLE_RAW`,`crnrstn_examples`.`DESCRIPTION`,`crnrstn_examples`.`EXAMPLE_ELEM_TT`,`crnrstn_examples`.`LANGCODE`,`crnrstn_examples`.`ISACTIVE`,`crnrstn_examples`.`DATEMODIFIED` FROM ((`crnrstn_class` LEFT OUTER JOIN `crnrstn_method` ON `crnrstn_class`.`CLASSID` = `crnrstn_method`.`CLASSID`) LEFT OUTER JOIN `crnrstn_examples` ON `crnrstn_class`.`CLASSID` = `crnrstn_examples`.`CLASSID`) LEFT OUTER JOIN `crnrstn_techspecs` ON `crnrstn_class`.`CLASSID` = `crnrstn_techspecs`.`CLASSID` WHERE (((`crnrstn_class`.`CLASSID`)="'.crc32($oUser->getReqParamByKey('CLASSID')).'" AND (`crnrstn_class`.`CLASSID_SOURCE`)="'.$mysqli->real_escape_string($oUser->getReqParamByKey('CLASSID')).'" AND (`crnrstn_class`.`ISACTIVE`)="1"));';
					}
					
					//
					// APPEND NAV DATA
					if($queryType=='svc_getclass_PlusNav'){
						self::$query .= 'SELECT `crnrstn_class`.`CLASSID`,`crnrstn_class`.`NAME`,`crnrstn_class`.`URI`,`crnrstn_class`.`LANGCODE`,`crnrstn_method`.`METHODID`,`crnrstn_method`.`NAME`,`crnrstn_method`.`URI`,`crnrstn_method`.`ISACTIVE` FROM `crnrstn_class` LEFT OUTER JOIN `crnrstn_method` ON `crnrstn_class`.`CLASSID` = `crnrstn_method`.`CLASSID` WHERE `crnrstn_class`.`ISACTIVE`="1" ORDER BY `crnrstn_class`.`NAV_POSITION`,`crnrstn_method`.`NAV_POSITION`;';
					}
					
					#`ISACTIVE`="0"	= [USER DELETED]
					#`ISACTIVE`="1" = [USERS ONLY]
					#`ISACTIVE`="2" = [ALL ACCESS]
					#`ISACTIVE`="3" = [ADMIN HIDDEN]
					$tmp_indexStart = $oUser->getReqParamByKey('INDEXSIZE')*($oUser->getReqParamByKey('PAGEINDEX')-1);
					if(strlen($oUser->getReqParamByKey('USERNAME'))>4){
						//
						// APPEND COMMENT DATA
						$dyn_tble_comments = '';
						$dyn_tble_users = '';
						$dyn_tble_comments = 'crnrstn_'.$mysqli->real_escape_string($oUser->getReqParamByKey('CLASSID')).'_comments';
						$dyn_tble_users = 'crnrstn_'.$mysqli->real_escape_string($oUser->getReqParamByKey('CLASSID')).'_users';
						
						self::$query .= 'SELECT `'.$dyn_tble_comments.'`.`NOTEID_SOURCE`,`'.$dyn_tble_comments.'`.`USERNAME`,`'.$dyn_tble_comments.'`.`REPLYTO_NOTEID`,`'.$dyn_tble_comments.'`.`SUBJECT`,`'.$dyn_tble_comments.'`.`NOTE_STYLED`,`'.$dyn_tble_comments.'`.`NOTE_ELEM_TT`,`'.$dyn_tble_comments.'`.`LANGCODE`,`'.$dyn_tble_comments.'`.`DATEMODIFIED`,`'.$dyn_tble_comments.'`.`DATECREATED`,`'.$dyn_tble_users.'`.`USERID_SOURCE`,`'.$dyn_tble_users.'`.`USERNAME_DISPLAY`,`'.$dyn_tble_users.'`.`IMAGE_NAME`,`'.$dyn_tble_users.'`.`IMAGE_WIDTH`,`'.$dyn_tble_users.'`.`IMAGE_HEIGHT`,`'.$dyn_tble_users.'`.`EXTERNAL_URI_FORMATTED` FROM `'.$dyn_tble_comments.'` LEFT OUTER JOIN `'.$dyn_tble_users.'` ON `'.$dyn_tble_comments.'`.`USERNAME` = `'.$dyn_tble_users.'`.`USERNAME` WHERE `'.$dyn_tble_comments.'`.`ISACTIVE`="1" ORDER BY `'.$dyn_tble_comments.'`.`DATECREATED` DESC LIMIT '.$tmp_indexStart.','.$oUser->getReqParamByKey('INDEXSIZE').';';
						self::$query .= 'SELECT COUNT(*) AS INDEXTOTAL FROM `'.$dyn_tble_comments.'` WHERE `'.$dyn_tble_comments.'`.`ISACTIVE`="1";';
						
					}else{
						//
						// APPEND COMMENT DATA [DO NOT PULL. XML ONLY.]
//						$dyn_tble_comments = '';
//						$dyn_tble_users = '';
//						$dyn_tble_comments = 'crnrstn_'.$mysqli->real_escape_string($oUser->getReqParamByKey('CLASSID')).'_comments';
//						$dyn_tble_users = 'crnrstn_'.$mysqli->real_escape_string($oUser->getReqParamByKey('CLASSID')).'_users';
//						
//						self::$query .= 'SELECT `'.$dyn_tble_comments.'`.`NOTEID_SOURCE`,`'.$dyn_tble_comments.'`.`USERNAME`, 
//						`'.$dyn_tble_comments.'`.`REPLYTO_NOTEID`, 
//						`'.$dyn_tble_comments.'`.`SUBJECT`,`'.$dyn_tble_comments.'`.`NOTE_STYLED`, 
//						`'.$dyn_tble_comments.'`.`NOTE_ELEM_TT`,`'.$dyn_tble_comments.'`.`LANGCODE`, 
//						`'.$dyn_tble_comments.'`.`DATEMODIFIED`,`'.$dyn_tble_comments.'`.`DATECREATED`, 
//						`'.$dyn_tble_users.'`.`USERID_SOURCE`,`'.$dyn_tble_users.'`.`USERNAME_DISPLAY`,
//						`'.$dyn_tble_users.'`.`IMAGE_NAME`,`'.$dyn_tble_users.'`.`IMAGE_WIDTH`,
//						`'.$dyn_tble_users.'`.`IMAGE_HEIGHT`,
//						`'.$dyn_tble_users.'`.`EXTERNAL_URI_FORMATTED`
//						FROM `'.$dyn_tble_comments.'` 
//						LEFT OUTER JOIN `'.$dyn_tble_users.'` ON `'.$dyn_tble_comments.'`.`USERNAME` = `'.$dyn_tble_users.'`.`USERNAME` 
//						WHERE `'.$dyn_tble_comments.'`.`ISACTIVE`="2" ORDER BY `'.$dyn_tble_comments.'`.`DATECREATED` DESC LIMIT '.$tmp_indexStart.','.$oUser->getReqParamByKey('INDEXSIZE').';
//						';
//						
//						self::$query .= 'SELECT COUNT(*) AS INDEXTOTAL FROM `'.$dyn_tble_comments.'` 
//						WHERE `'.$dyn_tble_comments.'`.`ISACTIVE`="2";
//						';
						
					}
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query);
					if($mysqli->error){
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					
					}else{
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						$ROWCNT=0;
						do {
							if (self::$result = $mysqli->store_result()) {
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
					
							if ($mysqli->more_results()) {
								//
								// END OF RECORD. MORE TO FOLLOW.
							}
						} while ($mysqli->next_result());
						
						//
						// CLOSE CONNECTION
						$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);
						
						//
						// RETURN RESULT SET ARRAY
						return self::$result_ARRAY;
					}
				break;
				case 'svc_getmethod':
				case 'svc_getmethod_PlusNav':
				case 'svc_getMethodComments':
					//
					// BUILD QUERY
					if($queryType!='svc_getMethodComments'){
						self::$query = 'SELECT `crnrstn_method`.`NAME`,`crnrstn_method`.`DESCRIPTION`,`crnrstn_method`.`DEFINITION`,`crnrstn_method`.`RETURNED_VALUE`,`crnrstn_method`.`URI`,`crnrstn_method`.`LANGCODE`,`crnrstn_method`.`DATEMODIFIED`,`crnrstn_params`.`PARAMETERID_SOURCE`,`crnrstn_params`.`NAME`,`crnrstn_params`.`ISREQUIRED`,`crnrstn_params`.`DESCRIPTION`,`crnrstn_params`.`LANGCODE`,`crnrstn_params`.`ISACTIVE`,`crnrstn_params`.`DATEMODIFIED`,`crnrstn_techspecs`.`TECHSPECID_SOURCE`,`crnrstn_techspecs`.`TECHSPEC_CONTENT`,`crnrstn_techspecs`.`LANGCODE`,`crnrstn_techspecs`.`DATEMODIFIED`,`crnrstn_techspecs`.`ISACTIVE`,`crnrstn_examples`.`EXAMPLEID_SOURCE`,`crnrstn_examples`.`TITLE`,`crnrstn_examples`.`DESCRIPTION`,`crnrstn_examples`.`EXAMPLE_FORMATTED`,`crnrstn_examples`.`EXAMPLE_RAW`,`crnrstn_examples`.`EXAMPLE_ELEM_TT`,`crnrstn_examples`.`LANGCODE`,`crnrstn_examples`.`ISACTIVE`,`crnrstn_examples`.`DATEMODIFIED`,`crnrstn_class`.`NAME` FROM ((((`crnrstn_method` LEFT OUTER JOIN `crnrstn_techspecs` ON `crnrstn_method`.`METHODID` = `crnrstn_techspecs`.`METHODID`) LEFT OUTER JOIN `crnrstn_params` ON `crnrstn_method`.`METHODID` = `crnrstn_params`.`METHODID`) LEFT OUTER JOIN `crnrstn_examples` ON `crnrstn_method`.`METHODID` = `crnrstn_examples`.`METHODID`) LEFT OUTER JOIN `crnrstn_class` ON `crnrstn_method`.`CLASSID` = `crnrstn_class`.`CLASSID`) WHERE `crnrstn_method`.`METHODID`="'.crc32($oUser->getReqParamByKey('METHODID')).'" AND `crnrstn_method`.`METHODID_SOURCE`="'.$mysqli->real_escape_string($oUser->getReqParamByKey('METHODID')).'" AND `crnrstn_method`.`ISACTIVE`="1";';
					}
										
					//
					// APPEND NAV DATA
					if($queryType=='svc_getmethod_PlusNav'){
						self::$query .= 'SELECT `crnrstn_class`.`CLASSID`,`crnrstn_class`.`NAME`,`crnrstn_class`.`URI`,`crnrstn_class`.`LANGCODE`,`crnrstn_method`.`METHODID`,`crnrstn_method`.`NAME`,`crnrstn_method`.`URI`,`crnrstn_method`.`ISACTIVE` FROM `crnrstn_class` LEFT OUTER JOIN `crnrstn_method` ON `crnrstn_class`.`CLASSID` = `crnrstn_method`.`CLASSID` WHERE `crnrstn_class`.`ISACTIVE`="1" ORDER BY `crnrstn_class`.`NAV_POSITION`,`crnrstn_method`.`NAV_POSITION`;';
					}
					
					$tmp_indexStart = $oUser->getReqParamByKey('INDEXSIZE')*($oUser->getReqParamByKey('PAGEINDEX')-1);
					if(strlen($oUser->getReqParamByKey('USERNAME'))>4){
						//
						// APPEND COMMENT DATA
						$dyn_tble_comments = '';
						$dyn_tble_users = '';
						$dyn_tble_comments = 'crnrstn_'.$mysqli->real_escape_string($oUser->getReqParamByKey('METHODID')).'_comments';
						$dyn_tble_users = 'crnrstn_'.$mysqli->real_escape_string($oUser->getReqParamByKey('METHODID')).'_users';
						
						self::$query .= 'SELECT `'.$dyn_tble_comments.'`.`NOTEID_SOURCE`,`'.$dyn_tble_comments.'`.`USERNAME`,`'.$dyn_tble_comments.'`.`REPLYTO_NOTEID`,`'.$dyn_tble_comments.'`.`SUBJECT`,`'.$dyn_tble_comments.'`.`NOTE_STYLED`,`'.$dyn_tble_comments.'`.`NOTE_ELEM_TT`,`'.$dyn_tble_comments.'`.`LANGCODE`,`'.$dyn_tble_comments.'`.`DATEMODIFIED`,`'.$dyn_tble_comments.'`.`DATECREATED`,`'.$dyn_tble_users.'`.`USERID_SOURCE`,`'.$dyn_tble_users.'`.`USERNAME_DISPLAY`,`'.$dyn_tble_users.'`.`IMAGE_NAME`,`'.$dyn_tble_users.'`.`IMAGE_WIDTH`,`'.$dyn_tble_users.'`.`IMAGE_HEIGHT`,`'.$dyn_tble_users.'`.`EXTERNAL_URI_FORMATTED` FROM `'.$dyn_tble_comments.'` LEFT OUTER JOIN `'.$dyn_tble_users.'` ON `'.$dyn_tble_comments.'`.`USERNAME` = `'.$dyn_tble_users.'`.`USERNAME` WHERE `'.$dyn_tble_comments.'`.`ISACTIVE`="1" ORDER BY `'.$dyn_tble_comments.'`.`DATECREATED` DESC LIMIT '.$tmp_indexStart.','.$oUser->getReqParamByKey('INDEXSIZE').';';
						self::$query .= 'SELECT COUNT(*) AS INDEXTOTAL FROM `'.$dyn_tble_comments.'` WHERE `'.$dyn_tble_comments.'`.`ISACTIVE`="1";';
						
					}else{
						//
						// APPEND COMMENT DATA [DO NOT PULL. XML ONLY.]
//						$dyn_tble_comments = '';
//						$dyn_tble_users = '';
//						$dyn_tble_comments = 'crnrstn_'.$mysqli->real_escape_string($oUser->getReqParamByKey('METHODID')).'_comments';
//						$dyn_tble_users = 'crnrstn_'.$mysqli->real_escape_string($oUser->getReqParamByKey('METHODID')).'_users';
//						
//						self::$query .= 'SELECT `'.$dyn_tble_comments.'`.`NOTEID_SOURCE`,`'.$dyn_tble_comments.'`.`USERNAME`, 
//						`'.$dyn_tble_comments.'`.`REPLYTO_NOTEID`, 
//						`'.$dyn_tble_comments.'`.`SUBJECT`,`'.$dyn_tble_comments.'`.`NOTE_STYLED`, 
//						`'.$dyn_tble_comments.'`.`NOTE_ELEM_TT`,`'.$dyn_tble_comments.'`.`LANGCODE`, 
//						`'.$dyn_tble_comments.'`.`DATEMODIFIED`,`'.$dyn_tble_comments.'`.`DATECREATED`, 
//						`'.$dyn_tble_users.'`.`USERID_SOURCE`,`'.$dyn_tble_users.'`.`USERNAME_DISPLAY`,
//						`'.$dyn_tble_users.'`.`IMAGE_NAME`,`'.$dyn_tble_users.'`.`IMAGE_WIDTH`,
//						`'.$dyn_tble_users.'`.`IMAGE_HEIGHT`,
//						`'.$dyn_tble_users.'`.`EXTERNAL_URI_FORMATTED`
//						FROM `'.$dyn_tble_comments.'` 
//						LEFT OUTER JOIN `'.$dyn_tble_users.'` ON `'.$dyn_tble_comments.'`.`USERNAME` = `'.$dyn_tble_users.'`.`USERNAME` 
//						WHERE `'.$dyn_tble_comments.'`.`ISACTIVE`="2" ORDER BY `'.$dyn_tble_comments.'`.`DATECREATED` DESC LIMIT '.$tmp_indexStart.','.$oUser->getReqParamByKey('INDEXSIZE').';
//						';
//						
//						self::$query .= 'SELECT COUNT(*) AS INDEXTOTAL FROM `'.$dyn_tble_comments.'` 
//						WHERE `'.$dyn_tble_comments.'`.`ISACTIVE`="2";
//						';
					}
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query);
					if($mysqli->error){
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					
					}else{
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						$ROWCNT=0;
						do {
							if (self::$result = $mysqli->store_result()) {
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
					
							if ($mysqli->more_results()) {
								//
								// END OF RECORD. MORE TO FOLLOW.
							}
						} while ($mysqli->next_result());
						
						//
						// CLOSE CONNECTION
						$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);
						
						//
						// RETURN RESULT SET ARRAY
						return self::$result_ARRAY;
					}
				break;
				case 'svc_getnav':
					//
					// BUILD QUERY
					self::$query = 'SELECT `crnrstn_class`.`CLASSID`,`crnrstn_class`.`NAME`,`crnrstn_class`.`URI`,`crnrstn_class`.`LANGCODE`,`crnrstn_method`.`METHODID`,`crnrstn_method`.`NAME`,`crnrstn_method`.`URI`,`crnrstn_method`.`ISACTIVE` FROM `crnrstn_class` LEFT OUTER JOIN `crnrstn_method` ON `crnrstn_class`.`CLASSID` = `crnrstn_method`.`CLASSID` WHERE `crnrstn_class`.`ISACTIVE`="1" ORDER BY `crnrstn_class`.`NAV_POSITION`,`crnrstn_method`.`NAV_POSITION`;';
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query);
					if($mysqli->error){
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					
					}else{
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						$ROWCNT=0;
						do {
							if (self::$result = $mysqli->store_result()) {
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
					
							if ($mysqli->more_results()) {
								//
								// END OF RECORD. MORE TO FOLLOW.
							}
						} while ($mysqli->next_result());
						
						//
						// CLOSE CONNECTION
						$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);
						
						//
						// RETURN RESULT SET ARRAY
						return self::$result_ARRAY;
					}
					
				break;
				case 'svc_getToolTip':
					//
					// BUILD QUERY
					self::$query = 'SELECT `code_element_define`.`ELEMENTID_SOURCE`,`code_element_define`.`ELEM_TYPEID_SOURCE`,`code_element_define`.`NAME`,`code_element_define`.`PHP_VERSION`,`code_element_define`.`DESCRIPTION_SHORT`,`code_element_define`.`DESCRIPTION_FULL`,`code_element_define`.`RELATED_FUNC_LIST`,`code_element_define`.`LANGCODE`,`code_element_define`.`ISACTIVE` FROM `code_element_define` WHERE `code_element_define`.`ELEMENTID`="'.crc32($oUser->getReqParam('ELEMENTID')).'" AND `code_element_define`.`ELEMENTID_SOURCE`="'.$mysqli->real_escape_string($oUser->getReqParam('ELEMENTID')).'" LIMIT 1;';
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query);
					if($mysqli->error){
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					
					}else{
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						$ROWCNT=0;
						do {
							if (self::$result = $mysqli->store_result()) {
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
					
							if ($mysqli->more_results()) {
								//
								// END OF RECORD. MORE TO FOLLOW.
							}
						} while ($mysqli->next_result());
						
						//
						// CLOSE CONNECTION
						$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);
						
						//
						// RETURN RESULT SET ARRAY
						return self::$result_ARRAY;
					}
					
				break;
				case 'svc_getCommInsertStatus':
					if(strlen($oUser->returnCommentParam('CLASSID_SOURCE'))==20){
						$tmp_tblname = 'crnrstn_'.$mysqli->real_escape_string($oUser->returnCommentParam('CLASSID_SOURCE')).'_users';
					}else{
						$tmp_tblname = 'crnrstn_'.$mysqli->real_escape_string($oUser->returnCommentParam('METHODID_SOURCE')).'_users';
					}
					
					//
					// BUILD QUERY
					self::$query = 'SELECT `'.$tmp_tblname.'`.`USERNAME` FROM `'.$tmp_tblname.'` WHERE `'.$tmp_tblname.'`.`USERNAME`="'.$mysqli->real_escape_string($oUser->returnCommentParam('USERNAME')).'" AND `'.$tmp_tblname.'`.`USERID_SOURCE`="'.md5($oUser->returnCommentParam('USERNAME')).'" LIMIT 1;';
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query);
					if($mysqli->error){
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					
					}else{	
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						$ROWCNT=0;
						do {
							if (self::$result = $mysqli->store_result()) {
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
					
							if ($mysqli->more_results()) {
								//
								// END OF RECORD. MORE TO FOLLOW.
							}
						} while ($mysqli->next_result());
						
						//
						// CLOSE CONNECTION
						$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);
					
						//
						// RETURN RESULT SET ARRAY
						return self::$result_ARRAY;
					}
					
				break;
				case 'svc_getUserCommentbyID':
					
					//
					// APPEND COMMENT DATA
					$dyn_tble_comments = '';
					$dyn_tble_users = '';
					$dyn_tble_comments = 'crnrstn_'.$mysqli->real_escape_string($oUser->returnCommentParam('PAGE_ELEMENT_ID')).'_comments';
					$dyn_tble_users = 'crnrstn_'.$mysqli->real_escape_string($oUser->returnCommentParam('PAGE_ELEMENT_ID')).'_users';

					//
					// BUILD QUERY
					self::$query = 'SELECT `'.$dyn_tble_comments.'`.`NOTEID_SOURCE`,`'.$dyn_tble_comments.'`.`USERNAME`,`'.$dyn_tble_comments.'`.`REPLYTO_NOTEID`,`'.$dyn_tble_comments.'`.`SUBJECT`,`'.$dyn_tble_comments.'`.`NOTE_STYLED`,`'.$dyn_tble_comments.'`.`NOTE_RAW`,`'.$dyn_tble_comments.'`.`NOTE_ELEM_TT`,`'.$dyn_tble_comments.'`.`STYLED_CHAR_CNT`,`'.$dyn_tble_comments.'`.`RAW_CHAR_CNT`,`'.$dyn_tble_comments.'`.`LANGCODE`,`'.$dyn_tble_comments.'`.`DATEMODIFIED`,`'.$dyn_tble_comments.'`.`DATECREATED`,`'.$dyn_tble_users.'`.`USERID_SOURCE`,`'.$dyn_tble_users.'`.`USERNAME_DISPLAY`,`'.$dyn_tble_users.'`.`IMAGE_NAME`,`'.$dyn_tble_users.'`.`IMAGE_WIDTH`,`'.$dyn_tble_users.'`.`IMAGE_HEIGHT`,`'.$dyn_tble_users.'`.`EXTERNAL_URI_FORMATTED` FROM `'.$dyn_tble_comments.'` LEFT OUTER JOIN `'.$dyn_tble_users.'` ON `'.$dyn_tble_comments.'`.`USERNAME` = `'.$dyn_tble_users.'`.`USERNAME` WHERE `'.$dyn_tble_comments.'`.`NOTEID_SOURCE`="'.$mysqli->real_escape_string($oUser->returnCommentParam('NOTEID_SOURCE')).'" ORDER BY `'.$dyn_tble_comments.'`.`DATECREATED` DESC;';
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query);
					if($mysqli->error){
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					
					}else{
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						$ROWCNT=0;
						do {
							if (self::$result = $mysqli->store_result()) {
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
					
							if ($mysqli->more_results()) {
								//
								// END OF RECORD. MORE TO FOLLOW.
							}
						} while ($mysqli->next_result());
						
						//
						// CLOSE CONNECTION
						$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);
						
						//
						// RETURN RESULT SET ARRAY
						return self::$result_ARRAY;
					}
					
				break;
				case 'svc_isValidLoginData':
					//
					// BUILD QUERY
					self::$query = 'SELECT `users`.`USERNAME`,`users`.`ISACTIVE`,`users`.`USERNAME_DISPLAY`,`users`.`EMAIL`,`users`.`USER_PERMISSIONS_ID`,`users`.`LANGCODE`,`users`.`LOGIN_CNT`,`users`.`SESSION_PERSIST`,`users`.`IMAGE_NAME`,`users`.`IMAGE_WIDTH`,`users`.`IMAGE_HEIGHT`,`users`.`EXTERNAL_URI_FORMATTED` FROM `users` WHERE `users`.`USERNAME`="'.$mysqli->real_escape_string(strtolower($oUser->getReqParamByKey('USERNAME'))).'" AND `users`.`USERNAME_CRC32`="'.crc32(strtolower($oUser->getReqParamByKey('USERNAME'))).'" AND `users`.`PWDHASH`="'.$oUser->getReqParamByKey('PWDHASH').'" LIMIT 1;';
					#error_log('(755) :: '.self::$query);
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query);
					if($mysqli->error){
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					
					}else{
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						$ROWCNT=0;
						do {
							if (self::$result = $mysqli->store_result()) {
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
					
							if ($mysqli->more_results()) {
								//
								// END OF RECORD. MORE TO FOLLOW.
							}
						} while ($mysqli->next_result());
						
						//
						// INCRMENT LOGIN COUNT
						self::$result_ARRAY[0][5]++;
						
						// 
						// BUILD FOLLOW QUERY TO UPDATE LAST LOGIN DATE AND LOGIN COUNT
						self::$query = 'UPDATE `users` SET `users`.`LASTLOGIN`="'.$ts.'",`users`.`LOGIN_CNT`="'.self::$result_ARRAY[0][5].'",`users`.`DATEMODIFIED`="'.$ts.'" WHERE `users`.`USERNAME`="'.self::$result_ARRAY[0][0].'" AND `users`.`USERNAME_CRC32`="'.crc32(self::$result_ARRAY[0][0]).'" AND `USERID_SOURCE`="'.md5(self::$result_ARRAY[0][0]).'" AND `USERID`="'.crc32(md5(self::$result_ARRAY[0][0])).'" LIMIT 1;';
						
						//
						// PROCESS QUERY
						self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
					
						//
						// CLOSE CONNECTION
						$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);
						
						//
						// RETURN RESULT SET ARRAY
						return self::$result_ARRAY;
					}
				break;
				case 'svc_getAllToolTips':
					//
					// BUILD QUERY
					self::$query_elements = 'SELECT `code_element_define`.`ELEMENTID_SOURCE`,`code_element_define`.`ELEM_TYPEID_SOURCE`,`code_element_define`.`NAME`,`code_element_define`.`DESCRIPTION_SHORT` FROM `code_element_define` WHERE `code_element_define`.`ISACTIVE`="1";';
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query_elements);
					if($mysqli->error){
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					
					}else{
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						$ROWCNT=0;
						do {
							if (self::$result = $mysqli->store_result()) {
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
					
							if ($mysqli->more_results()) {
								//
								// END OF RECORD. MORE TO FOLLOW.
							}
						} while ($mysqli->next_result());
						
						//
						// CLOSE CONNECTION
						$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);
						
						//
						// RETURN RESULT SET ARRAY
						return self::$result_ARRAY;
					}
					
				break;
				case 'svc_isUserUnique':
					//
					// BUILD QUERY
					self::$query = 'SELECT USERNAME FROM users WHERE USERNAME="'.strtolower($mysqli->real_escape_string($oUser->getReqParamByKey('USERNAME'))).'" AND USERNAME_CRC32="'.crc32(strtolower($mysqli->real_escape_string($oUser->getReqParamByKey('USERNAME')))).'" LIMIT 1;';
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query);
					if($mysqli->error){
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					
					}else{
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						$ROWCNT=0;
						do {
							if (self::$result = $mysqli->store_result()) {
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
					
							if ($mysqli->more_results()) {
								//
								// END OF RECORD. MORE TO FOLLOW.
							}
						} while ($mysqli->next_result());
						
						//
						// CLOSE CONNECTION
						$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);
						
						//
						// RETURN RESULT SET ARRAY
						return self::$result_ARRAY;
					}
					
				break;
				case 'svc_creatNewUser':
					//
					// PREPARE HASHES
					$seednum_b = microtime().rand();
					$seednum_full = md5(strtolower($oUser->getReqParamByKey('USERNAME')));
					$seednum_a = substr($seednum_full,0,30);
					$seednum_b = md5($seednum_b);
					$seednum_key = $seednum_a.substr($seednum_b,0,20);
										
					//
					// PREPARE QUERY
					self::$query = 'INSERT INTO `crnrstn_stage`.`users` (`USERNAME`,`USERID_SOURCE`,`USERNAME_CRC32`,`USERID`,`FIRSTNAME`,`LASTNAME`,`USERNAME_DISPLAY`,`EMAIL`,`EMAIL_CRC32`,`PWDHASH`,`LASTLOGIN`,`SESSION_PERSIST`,`DATEMODIFIED`) VALUES ("'.$mysqli->real_escape_string(strtolower($oUser->getReqParamByKey('USERNAME'))).'","'.$seednum_full.'","'.crc32(strtolower($oUser->getReqParamByKey('USERNAME'))).'","'.crc32($seednum_full).'","'.$oUser->getReqParamByKey('FIRSTNAME').'","'.$oUser->getReqParamByKey('LASTNAME').'","'.$mysqli->real_escape_string($oUser->getReqParamByKey('USERNAME')).'","'.$mysqli->real_escape_string(strtolower($oUser->getReqParamByKey('EMAIL'))).'","'.crc32(strtolower($oUser->getReqParamByKey('EMAIL'))).'","'.$oUser->getReqParamByKey('PWDHASH').'","'.$ts.'","'.$mysqli->real_escape_string($oUser->getReqParamByKey('SESSION_PERSIST')).'","'.$ts.'");';
					self::$query .= 'INSERT INTO `crnrstn_stage`.`users_activation` (`KEY`, `KEY_CRC32`, `USERNAME`, `USERNAME_CRC32`, `EMAIL`, `DATEMODIFIED`) VALUES ("'.$seednum_key.'", "'.crc32($seednum_key).'", "'.$mysqli->real_escape_string(strtolower($oUser->getReqParamByKey('USERNAME'))).'", "'.crc32(strtolower($oUser->getReqParamByKey('USERNAME'))).'", "'.$mysqli->real_escape_string(strtolower($oUser->getReqParamByKey('EMAIL'))).'", "'.$ts.'");';

					
					#error_log('(921) svc_creatNewUser :: '.self::$query);
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query);
					
					$ROWCNT=0;
					do {
						if($mysqli->error){
							if($ROWCNT>0){
								self::$query_exception_result='newuser=false';
							}else{
								self::$query_exception_result='newuser=falseall';
							}
							
							throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.'] on un='.strtolower($oUser->getReqParamByKey('USERNAME')));
							
						}
						$ROWCNT++;
				
						if ($mysqli->more_results()) {
							//
							// END OF RECORD. MORE TO FOLLOW.
						}
					} while ($mysqli->next_result());
				
					if($mysqli->error){
						self::$query_exception_result='newuser=false';	
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.'] on un='.strtolower($oUser->getReqParamByKey('USERNAME')));
					}					
					
					//
					// CLOSE CONNECTION
					$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);					
					return 'newuser='.$seednum_key;
					
				break;
				case 'svc_activateNewUser':
				
					self::$queryDescript_ARRAY = array('users_activation_KEY' => 0,'users_activation_KEY_CRC32' => 1,
					'users_activation_USERNAME' => 2,'users_activation_USERNAME_CRC32' => 3, 'users_activation_ISACTIVE' => 4,
					'users_USERID_SOURCE' => 5,'users_ISACTIVE' => 6,'users_SESSION_PERSIST' => 7);
					
					//
					// SELECT ...
					self::$query = 'SELECT `users_activation`.`KEY`,`users_activation`.`KEY_CRC32`,
					`users_activation`.`USERNAME`,`users_activation`.`USERNAME_CRC32`,
					`users_activation`.`ISACTIVE`,`users`.`USERID_SOURCE`,`users`.`ISACTIVE`,`users`.`SESSION_PERSIST`
					FROM `users_activation` INNER JOIN `users` ON 
					`users_activation`.`USERNAME` = `users`.`USERNAME` WHERE 
					`users_activation`.`KEY`="'.$mysqli->real_escape_string($oUser->getReqParamByKey('KEY')).'" AND 
					`users_activation`.`KEY_CRC32`="'.$mysqli->real_escape_string($oUser->getReqParamByKey('KEY_CRC32')).'" AND 
					`users_activation`.`USERNAME`="'.$mysqli->real_escape_string($oUser->getReqParamByKey('USERNAME')).'" AND 
					 `users_activation`.`USERNAME_CRC32`="'.$mysqli->real_escape_string($oUser->getReqParamByKey('USERNAME_CRC32')).'"
					;';
					
					#error_log('(955) :: '.self::$query);
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
					switch(self::$result->num_rows){
						case 1:
							#error_log('(965) :: OK TO ACTIVATE '.self::$result->num_rows);
							$row = self::$result->fetch_all(MYSQLI_NUM);
							#error_log('(966) :: query output '.$row[0][self::$queryDescript_ARRAY['users_activation_KEY']].'|'.$row[0][self::$queryDescript_ARRAY['users_activation_USERNAME']].'|'.$row[0][self::$queryDescript_ARRAY['users_activation_ISACTIVE']].'|'.$row[0][self::$queryDescript_ARRAY['users_USERID_SOURCE']].'|'.$row[0][self::$queryDescript_ARRAY['users_ISACTIVE']]);
							
							switch($row[0][self::$queryDescript_ARRAY['users_activation_ISACTIVE']]){
								case 0:
									//
									// ACTIVATE ACCOUNT. BUILD QUERIES
									self::$query = 'UPDATE `users` SET `ISACTIVE`="1",`DATEMODIFIED`="'.$ts.'" 
									WHERE `USERNAME`="'.$row[0][self::$queryDescript_ARRAY['users_activation_USERNAME']].'" AND 
									`USERID_SOURCE`="'.md5($row[0][self::$queryDescript_ARRAY['users_activation_USERNAME']]).'" AND 
									`USERNAME_CRC32`="'.crc32($row[0][self::$queryDescript_ARRAY['users_activation_USERNAME']]).'" AND
									`USERID`="'.crc32(md5($row[0][self::$queryDescript_ARRAY['users_activation_USERNAME']])).'" LIMIT 1;';
									
									self::$query .= 'UPDATE `users_activation` SET `ISACTIVE`="1",`DATEMODIFIED`="'.$ts.'" 
									WHERE `KEY`="'.$row[0][self::$queryDescript_ARRAY['users_activation_KEY']].'" AND 
									`KEY_CRC32`="'.$row[0][self::$queryDescript_ARRAY['users_activation_KEY_CRC32']].'" AND 
									`USERNAME`="'.$row[0][self::$queryDescript_ARRAY['users_activation_USERNAME']].'" AND
									`USERNAME_CRC32`="'.$row[0][self::$queryDescript_ARRAY['users_activation_USERNAME_CRC32']].'" LIMIT 1;';
									
									#error_log('(991) :: '.self::$query);
									//
									// PROCESS QUERY
									self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query);
									
									$ROWCNT=0;
									do {
										if($mysqli->error){
											if($ROWCNT>0){
												self::$query_exception_result='accountactivate=false';
											}else{
												self::$query_exception_result='accountactivate=falseall';
											}
											
											throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
											
										}
										$ROWCNT++;
								
										if ($mysqli->more_results()) {
											//
											// END OF RECORD. MORE TO FOLLOW.
										}
									} while ($mysqli->next_result());
								
									if($mysqli->error){
										self::$query_exception_result='accountactivate=false';	
										throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
									}
								
									//
									// CLOSE CONNECTION
									$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);					
									return 'accountactivate=true&persist='.$row[0][self::$queryDescript_ARRAY['users_SESSION_PERSIST']];
							
								break;
								default:
									//
									// ACCOUNT IS ALREADY ACTIVATED. NO FURTHER UPDATES NEEDED. SAVE THE RESOURCES
									return 'accountactivate=donealready&persist='.$row[0][self::$queryDescript_ARRAY['users_SESSION_PERSIST']];
								break;
							}
						break;
						case 0:
							//
							// POTENTIAL HACK ATTEMPT OR SYSTEM ERR
							#error_log('(1037) :: ACTIVATION ERROR :: NUMROW=0|accountactivate=dataerror_null|'.$row[0][self::$queryDescript_ARRAY['users_activation_KEY']]);
							return 'accountactivate=dataerror_null';
						break;
						default:
							//
							// POTENTIAL SYSTEM ERR
							#error_log('(1043) :: ACTIVATION ERROR :: NUMROW='.self::$result->num_rows.'|accountactivate=dataerror_redun|'.$row[0][self::$queryDescript_ARRAY['users_activation_KEY']]);
							return 'accountactivate=dataerror_redun';
						break;
					}
					
				break;
				case 'svc_updateUserSettings':
					//
					// BUILD QUERY
					if($oUser->getReqParamByKey('DEACTIVATE')=='true'){
						self::$query = 'UPDATE `users` SET `ISACTIVE`="0",`DATEMODIFIED`="'.$ts.'" WHERE `USERNAME`="'.$mysqli->real_escape_string($oUser->getReqParamByKey('USERNAME')).'" AND `USERID_SOURCE`="'.md5(strtolower($oUser->getReqParamByKey('USERNAME'))).'" AND `USERID`="'.crc32(md5(strtolower($oUser->getReqParamByKey('USERNAME')))).'" LIMIT 1;';
						$tmp_response = 'accountdeactivate=true';
					}else{
				
						if(strlen($oUser->getReqParamByKey('PWDHASH'))>10){
							self::$query = 'UPDATE `users` SET `FIRSTNAME`="'.$oUser->getReqParamByKey('FIRSTNAME').'",`LASTNAME`="'.$oUser->getReqParamByKey('LASTNAME').'",`EMAIL`="'.$mysqli->real_escape_string(strtolower($oUser->getReqParamByKey('EMAIL'))).'",`EMAIL_CRC32`="'.crc32(strtolower($oUser->getReqParamByKey('EMAIL'))).'",`PWDHASH`="'.$oUser->getReqParamByKey('PWDHASH').'",`DATEMODIFIED`="'.$ts.'" WHERE `USERNAME`="'.$mysqli->real_escape_string($oUser->getReqParamByKey('USERNAME')).'" AND `USERID_SOURCE`="'.md5(strtolower($oUser->getReqParamByKey('USERNAME'))).'" AND `USERID`="'.crc32(md5(strtolower($oUser->getReqParamByKey('USERNAME')))).'" LIMIT 1;';
						}else{
							self::$query = 'UPDATE `users` SET `FIRSTNAME`="'.$oUser->getReqParamByKey('FIRSTNAME').'",`LASTNAME`="'.$oUser->getReqParamByKey('LASTNAME').'",`EMAIL`="'.$mysqli->real_escape_string(strtolower($oUser->getReqParamByKey('EMAIL'))).'",`EMAIL_CRC32`="'.crc32(strtolower($oUser->getReqParamByKey('EMAIL'))).'",`DATEMODIFIED`="'.$ts.'" WHERE `USERNAME`="'.$mysqli->real_escape_string($oUser->getReqParamByKey('USERNAME')).'" AND `USERID_SOURCE`="'.md5(strtolower($oUser->getReqParamByKey('USERNAME'))).'" AND `USERID`="'.crc32(md5(strtolower($oUser->getReqParamByKey('USERNAME')))).'" LIMIT 1;';
						}
						
						$tmp_response = 'updatesettings=true';
					}
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
					if($mysqli->error){
						self::$query_exception_result='updatesettings=false';
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					
					}else{
						//
						// CLOSE CONNECTION
						$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);					
						return $tmp_response;
						
					}
				break;
				case 'svc_updateUserProfile':
					//
					// BEGIN TRANSACTION
					//$mysqli->autocommit(FALSE);
					
					//
					// BUILD QUERY
					if(strlen($oUser->getReqParamByKey('IMAGE_NAME'))>10){
						self::$query = 'UPDATE `users` SET `IMAGE_NAME`="'.$oUser->getReqParamByKey('IMAGE_NAME').'",`IMAGE_WIDTH`="'.$oUser->getReqParamByKey('IMAGE_WIDTH').'",`IMAGE_HEIGHT`="'.$oUser->getReqParamByKey('IMAGE_HEIGHT').'",`ABOUT`="'.$oUser->getReqParamByKey('ABOUT').'",`EXTERNAL_URI_RAW`="'.$mysqli->real_escape_string($oUser->getReqParamByKey('EXTERNAL_URI_RAW')).'",`EXTERNAL_URI_FORMATTED`="'.$mysqli->real_escape_string($oUser->getReqParamByKey('EXTERNAL_URI_FORMATTED')).'",`DATEMODIFIED`="'.$ts.'" WHERE `USERNAME`="'.$mysqli->real_escape_string($oUser->getReqParamByKey('USERNAME')).'" AND `USERID_SOURCE`="'.$oUser->getReqParamByKey('USERID_SOURCE').'" AND `USERID`="'.crc32($oUser->getReqParamByKey('USERID_SOURCE')).'" LIMIT 1;';
						#self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
						if(strlen($oUser->getReqParamByKey('ELEMENTID_PIPED'))>10){
							
							$tmp_elementid_ARRAY = explode('|',$oUser->getReqParamByKey('ELEMENTID_PIPED'));
							foreach($tmp_elementid_ARRAY as $key=>$val){
								$dyn_tble_users = 'crnrstn_'.$mysqli->real_escape_string($val).'_users';
								self::$query .= 'UPDATE `'.$dyn_tble_users.'` SET `IMAGE_NAME`="'.$oUser->getReqParamByKey('IMAGE_NAME').'",`IMAGE_WIDTH`="'.$oUser->getReqParamByKey('IMAGE_WIDTH').'",`IMAGE_HEIGHT`="'.$oUser->getReqParamByKey('IMAGE_HEIGHT').'",`EXTERNAL_URI_FORMATTED`="'.$mysqli->real_escape_string($oUser->getReqParamByKey('EXTERNAL_URI_FORMATTED')).'",`DATEMODIFIED`="'.$ts.'" WHERE `USERNAME`="'.$mysqli->real_escape_string($oUser->getReqParamByKey('USERNAME')).'" AND `USERID_SOURCE`="'.$oUser->getReqParamByKey('USERID_SOURCE').'" AND `USERNAME_CRC32`="'.crc32($oUser->getReqParamByKey('USERNAME')).'" AND `USERID`="'.crc32($oUser->getReqParamByKey('USERID_SOURCE')).'" LIMIT 1;';
								#self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
							}
						 }
						 
					}else{
						self::$query = 'UPDATE `users` SET `ABOUT`="'.$mysqli->real_escape_string($oUser->getReqParamByKey('ABOUT')).'",`EXTERNAL_URI_RAW`="'.$mysqli->real_escape_string($oUser->getReqParamByKey('EXTERNAL_URI_RAW')).'",`EXTERNAL_URI_FORMATTED`="'.$mysqli->real_escape_string($oUser->getReqParamByKey('EXTERNAL_URI_FORMATTED')).'",`DATEMODIFIED`="'.$ts.'" WHERE `USERNAME`="'.$mysqli->real_escape_string($oUser->getReqParamByKey('USERNAME')).'" AND `USERID_SOURCE`="'.$oUser->getReqParamByKey('USERID_SOURCE').'" AND `USERNAME_CRC32`="'.crc32($oUser->getReqParamByKey('USERNAME')).'" AND `USERID`="'.crc32($oUser->getReqParamByKey('USERID_SOURCE')).'" LIMIT 1;';
						
						if(strlen($oUser->getReqParamByKey('ELEMENTID_PIPED'))>10){
							
							$tmp_elementid_ARRAY = explode('|',$oUser->getReqParamByKey('ELEMENTID_PIPED'));
							foreach($tmp_elementid_ARRAY as $key=>$val){
								$dyn_tble_users = 'crnrstn_'.$mysqli->real_escape_string($val).'_users';
								self::$query .= 'UPDATE `'.$dyn_tble_users.'` SET `EXTERNAL_URI_FORMATTED`="'.$mysqli->real_escape_string($oUser->getReqParamByKey('EXTERNAL_URI_FORMATTED')).'",`DATEMODIFIED`="'.$ts.'" WHERE `USERNAME`="'.$mysqli->real_escape_string($oUser->getReqParamByKey('USERNAME')).'" AND `USERID_SOURCE`="'.$oUser->getReqParamByKey('USERID_SOURCE').'" AND `USERNAME_CRC32`="'.crc32($oUser->getReqParamByKey('USERNAME')).'" AND `USERID`="'.crc32($oUser->getReqParamByKey('USERID_SOURCE')).'" LIMIT 1;';
								#self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
							}
						}
					}
					
					//
					// PROCESS QUERY (OR PREPARE TRANSACTION FOR COMMIT)
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query);
					
					//
					// COMMIT TRANSACTION
					//$mysqli->commit();
					
					$ROWCNT=0;
					do {
						if($mysqli->error){
//							//
//							// ROLL BACK DUE TO ERROR
							//$mysqli->rollback();
							if($ROWCNT>0){
								self::$query_exception_result='updateuserprofile=false';
							}else{
								self::$query_exception_result='updateuserprofile=falseall';
							}
							
							throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
							
						}
						$ROWCNT++;
				
						if ($mysqli->more_results()) {
							//
							// END OF RECORD. MORE TO FOLLOW.
						}
					} while ($mysqli->next_result());
				
					if($mysqli->error){
//						//
//						// ROLL BACK DUE TO ERROR
						//$mysqli->rollback();
						self::$query_exception_result='updateuserprofile=false';	
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					}
				
					//
					// CLOSE CONNECTION
					$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);					
					return 'updateuserprofile=true';
				
				break;
				case 'svc_retrieveUserAccnt':
				case 'svc_retrieveUserAccnt_PlusNav':
					//
					// BUILD QUERY
					self::$query = 'SELECT `users`.`USERNAME`,`users`.`USERID_SOURCE`,`users`.`USERNAME_DISPLAY`,`users`.`FIRSTNAME`,`users`.`LASTNAME`,`users`.`EMAIL`,`users`.`USER_PERMISSIONS_ID`,`users`.`LANGCODE`,`users`.`LASTLOGIN`,`users`.`SESSION_PERSIST`,`users`.`IMAGE_NAME`,`users`.`IMAGE_WIDTH`,`users`.`IMAGE_HEIGHT`,`users`.`ABOUT`,`users`.`EXTERNAL_URI_RAW`,`users`.`EXTERNAL_URI_FORMATTED` FROM `users` WHERE `users`.`USERNAME`="'.$mysqli->real_escape_string($oUser->getReqParamByKey('USERNAME')).'" AND `users`.`USERNAME_CRC32`="'.crc32($oUser->getReqParamByKey('USERNAME')).'" LIMIT 1;';
					self::$query .= 'SELECT `user_comments`.`NOTEID_SOURCE`,`user_comments`.`SUBJECT`,`user_comments`.`NOTE_BACKLOG`,`user_comments`.`CLASSID_SOURCE`,`user_comments`.`METHODID_SOURCE`,`user_comments`.`REPLYTO_NOTEID`,`user_comments`.`PAGE_ELEMENT_NAME`,`user_comments`.`PAGE_ELEMENT_URI`,`user_comments`.`DATEMODIFIED`,`user_comments`.`DATECREATED` FROM `user_comments` WHERE `user_comments`.`USERNAME`="'.$mysqli->real_escape_string($oUser->getReqParamByKey('USERNAME')).'" AND `user_comments`.`USERNAME_CRC32`="'.crc32($oUser->getReqParamByKey('USERNAME')).'" AND `user_comments`.`ISACTIVE`="1" ORDER BY `user_comments`.`DATECREATED` DESC;';
					
					if($queryType=='svc_retrieveUserAccnt_PlusNav'){
						self::$query .= 'SELECT `crnrstn_class`.`CLASSID`,`crnrstn_class`.`NAME`,`crnrstn_class`.`URI`,`crnrstn_class`.`LANGCODE`,`crnrstn_method`.`METHODID`,`crnrstn_method`.`NAME`,`crnrstn_method`.`URI`,`crnrstn_method`.`ISACTIVE` FROM `crnrstn_class` LEFT OUTER JOIN `crnrstn_method` ON `crnrstn_class`.`CLASSID` = `crnrstn_method`.`CLASSID` WHERE `crnrstn_class`.`ISACTIVE`="1" ORDER BY `crnrstn_class`.`NAV_POSITION`,`crnrstn_method`.`NAV_POSITION`;';
					}
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query);
					if($mysqli->error){
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					
					}else{
						//
						// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
						$ROWCNT=0;
						do {
							if (self::$result = $mysqli->store_result()) {
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
					
							if ($mysqli->more_results()) {
								//
								// END OF RECORD. MORE TO FOLLOW.
							}
						} while ($mysqli->next_result());
						
						//
						// CLOSE CONNECTION
						$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);
						
						//
						// RETURN RESULT SET ARRAY
						return self::$result_ARRAY;
					}
				break;
				case 'svc_postUserFeedback':
//					FID_SOURCE CHAR 32 						PRIMARY KEY
//					FID_CRC32 INT 11   						INDEX
//					FEEDBACK_SEARCH = VARCHAR 2000			INDEX
//					FB_BUGREPORT = TINYINT 1				INDEX
//					FB_FEATREQUEST = TINYINT 1				INDEX
//					FB_GENQUESTION = TINYINT 1				INDEX
//					FB_GENCOMMENT = TINYINT 1				INDEX
//					OPTIN = TINYINT 1						INDEX
//					HTTP_USER_AGENT_SEARCH = VARCHAR 500
//					NAME = VARCHAR 100
//					EMAIL = VARCHAR 100
//					FEEDBACK = BLOB
//					USERNAME = VARCHAR 100
//					CLASSID_SOURCE = CHAR 20
//					METHODID_SOURCE = CHAR 20
//					URI = VARCHAR 420
//					HTTP_USER_AGENT = TINY BLOB
//					HTTP_REFERER = UNSIGNED INT 11 			INET_ATON() & INET_NTOA()
//					REMOTE_ADDR = 							INET_ATON() & INET_NTOA()
					
					//
					// PREPARE HASHES
					$seednum = microtime().rand();
					$seednum_full = md5($seednum);
				
					self::$query = 'INSERT INTO `user_feedback` (`FID_SOURCE`,`FID_CRC32`,`FEEDBACK_SEARCH`,`FB_BUGREPORT`,`FB_FEATREQUEST`,`FB_GENQUESTION`,`FB_GENCOMMENT`,`FB_REPORTSPAM`,`OPTIN`,`HTTP_USER_AGENT_SEARCH`,`NAME`,`EMAIL`,`FEEDBACK`,`USERNAME`,`CLASSID_SOURCE`,`METHODID_SOURCE`,`URI`,`HTTP_USER_AGENT`,`HTTP_REFERER`,`REMOTE_ADDR`,`SERVER_ADDR`,`DATEMODIFIED`) VALUES ("'.$seednum_full.'","'.crc32($seednum_full).'","'.$oUser->getReqParamByKey('FEEDBACK_SEARCH').'","'.$mysqli->real_escape_string($oUser->getReqParamByKey('FB_BUGREPORT')).'","'.$mysqli->real_escape_string($oUser->getReqParamByKey('FB_FEATREQUEST')).'","'.$mysqli->real_escape_string($oUser->getReqParamByKey('FB_GENQUESTION')).'","'.$mysqli->real_escape_string($oUser->getReqParamByKey('FB_GENCOMMENT')).'","'.$mysqli->real_escape_string($oUser->getReqParamByKey('FB_REPORTSPAM')).'","'.$mysqli->real_escape_string($oUser->getReqParamByKey('OPTIN')).'","'.$mysqli->real_escape_string($oUser->getReqParamByKey('HTTP_USER_AGENT_SEARCH')).'","'.$mysqli->real_escape_string($oUser->getReqParamByKey('NAME')).'","'.$mysqli->real_escape_string($oUser->getReqParamByKey('EMAIL')).'","'.$oUser->getReqParamByKey('FEEDBACK').'","'.$mysqli->real_escape_string($oUser->getReqParamByKey('USERNAME')).'","'.$mysqli->real_escape_string($oUser->getReqParamByKey('CLASSID_SOURCE')).'","'.$mysqli->real_escape_string($oUser->getReqParamByKey('METHODID_SOURCE')).'","'.$mysqli->real_escape_string($oUser->getReqParamByKey('URI')).'","'.$oUser->getReqParamByKey('HTTP_USER_AGENT').'","'.$oUser->getReqParamByKey('HTTP_REFERER').'",INET_ATON("'.$oUser->getReqParamByKey('REMOTE_ADDR').'"),INET_ATON("'.$oUser->getReqParamByKey('SERVER_ADDR').'"),"'.$ts.'");';
				
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
					if($mysqli->error){
						self::$query_exception_result='submitfeedback=false';
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					
					}else{
	
						//
						// CLOSE CONNECTION
						$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);
						
						//
						// RETURN RESPONSE
						return 'submitfeedback=true';
						
					}
				break;
				case 'svc_postUserComment':					
					//
					// STRUCTURE FOR COMMENTS/USERS TABLE NAMES
					#crnrstn_[METHODID_SOURCE]_comments
					#crnrstn_[METHODID_SOURCE]_users
					
					if(strlen($oUser->returnCommentParam('CLASSID_SOURCE'))>10){
						$tmp_destid = $oUser->returnCommentParam('CLASSID_SOURCE');
					}else{
						$tmp_destid = $oUser->returnCommentParam('METHODID_SOURCE');
					}
					
					//
					// PREPARE HASHES
					$seednum = $tmp_destid.$oUser->returnCommentParam('USERNAME').microtime().rand();
					$seednum_full = md5($seednum);
					
					//
					// BUILD QUERY
					self::$query = 'INSERT INTO `crnrstn_'.$tmp_destid.'_comments` (`NOTEID_SOURCE`,`NOTEID_CRC32`,`USERNAME`,`USERNAME_CRC32`,`SUBJECT`,`NOTE_STYLED`,`NOTE_RAW`,`NOTE_ELEM_TT`,`NOTE_BACKLOG`,`STYLED_CHAR_CNT`,`RAW_CHAR_CNT`,`DATEMODIFIED`) VALUES ("'.$seednum_full.'","'.crc32($seednum_full).'","'.$mysqli->real_escape_string($oUser->returnCommentParam('USERNAME')).'","'.crc32($oUser->returnCommentParam('USERNAME')).'","'.$oUser->returnCommentParam('SUBJECT').'","'.$oUser->returnCommentParam('NOTE_STYLED').'","'.$oUser->returnCommentParam('NOTE_RAW').'","'.$oUser->returnCommentParam('NOTE_ELEM_TT').'","'.$oUser->returnCommentParam('NOTE_BACKLOG').'","'.$oUser->returnCommentParam('STYLED_CHAR_CNT').'","'.$oUser->returnCommentParam('RAW_CHAR_CNT').'","'.$ts.'");';
	
					$seednum_full_user = md5($oUser->returnCommentParam('USERNAME'));
					
					if($oUser->returnCommentParam('USER_ISUNIQUE')=='1'){
						self::$query .= 'INSERT INTO `crnrstn_'.$tmp_destid.'_users` (`USERNAME`,`USERID_SOURCE`,`USERNAME_CRC32`,`USERID`,`USERNAME_DISPLAY`,`IMAGE_NAME`,`IMAGE_WIDTH`,`IMAGE_HEIGHT`,`EXTERNAL_URI_FORMATTED`,`DATEMODIFIED`) VALUES ("'.$mysqli->real_escape_string($oUser->returnCommentParam('USERNAME')).'","'.$seednum_full_user.'","'.crc32(strtolower($oUser->returnCommentParam('USERNAME'))).'","'.crc32($seednum_full_user).'","'.$mysqli->real_escape_string($oUser->returnCommentParam('USERNAME_DISPLAY')).'","'.$oUser->returnCommentParam('IMAGE_NAME').'","'.$oUser->returnCommentParam('IMAGE_WIDTH').'","'.$oUser->returnCommentParam('IMAGE_HEIGHT').'","'.$mysqli->real_escape_string($oUser->returnCommentParam('EXTERNAL_URI_FORMATTED')).'","'.$ts.'");';
					}
										
					if(strlen($oUser->returnCommentParam('NOTE_ELEM_SEARCH'))>1){
						self::$query .= 'INSERT INTO `crnrstn_ugc_search` (`NOTEID_SOURCE`,`NOTEID_CRC32`,`NOTE_ELEM_SEARCH`,`SUBJECT`,`CLASSID_SOURCE`,`METHODID_SOURCE`,`DATEMODIFIED`) VALUES ("'.$seednum_full.'","'.crc32($seednum_full).'","'.$oUser->returnCommentParam('NOTE_ELEM_SEARCH').'","'.$oUser->returnCommentParam('SUBJECT_SEARCH').'","'.$mysqli->real_escape_string($oUser->returnCommentParam('CLASSID_SOURCE')).'","'.$mysqli->real_escape_string($oUser->returnCommentParam('METHODID_SOURCE')).'","'.$ts.'");';
					}
					
					self::$query .= 'INSERT INTO `user_comments` (`NOTEID_SOURCE`,`NOTEID_CRC32`,`USERNAME`,`USERNAME_CRC32`,`SUBJECT`,`NOTE_BACKLOG`,`CLASSID_SOURCE`,`METHODID_SOURCE`,`PAGE_ELEMENT_NAME`,`PAGE_ELEMENT_URI`,`DATEMODIFIED`) VALUES ("'.$seednum_full.'","'.crc32($seednum_full).'","'.$mysqli->real_escape_string($oUser->returnCommentParam('USERNAME')).'","'.crc32($oUser->returnCommentParam('USERNAME')).'","'.$oUser->returnCommentParam('SUBJECT').'","'.$oUser->returnCommentParam('NOTE_BACKLOG').'","'.$mysqli->real_escape_string($oUser->returnCommentParam('CLASSID_SOURCE')).'","'.$mysqli->real_escape_string($oUser->returnCommentParam('METHODID_SOURCE')).'","'.$mysqli->real_escape_string($oUser->returnCommentParam('PAGE_ELEMENT_NAME')).'","'.$mysqli->real_escape_string($oUser->returnCommentParam('PAGE_ELEMENT_URI')).'","'.$ts.'");';
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query);

					//
					// COMMIT TRANSACTION
					//$mysqli->commit();
					
					$ROWCNT=0;
					do {
						if($mysqli->error){
//							//
//							// ROLL BACK DUE TO ERROR
							//$mysqli->rollback();
							if($ROWCNT>0){
								self::$query_exception_result='usernotesubmit=false';
							}else{
								self::$query_exception_result='usernotesubmit=falseall';
							}
							
							throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
							
						}
						$ROWCNT++;
				
						if ($mysqli->more_results()) {
							//
							// END OF RECORD. MORE TO FOLLOW.
						}
					} while ($mysqli->next_result());
				
					if($mysqli->error){
//						//
//						// ROLL BACK DUE TO ERROR
						//$mysqli->rollback();
						self::$query_exception_result='usernotesubmit=false';
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					}
				
					//
					// CLOSE CONNECTION
					$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);					
					return 'usernotesubmit=true';
					
				break;
				case 'svc_updateUserComment':
				
					if(strlen($oUser->returnCommentParam('CLASSID_SOURCE'))>10){
						$tmp_destid = $oUser->returnCommentParam('CLASSID_SOURCE');
					}else{
						$tmp_destid = $oUser->returnCommentParam('METHODID_SOURCE');
					}
					
					//
					// BUILD QUERY
					self::$query = 'UPDATE `crnrstn_'.$tmp_destid.'_comments` SET `SUBJECT`="'.$oUser->returnCommentParam('SUBJECT').'",`NOTE_STYLED`="'.$oUser->returnCommentParam('NOTE_STYLED').'",`NOTE_RAW`="'.$oUser->returnCommentParam('NOTE_RAW').'",`NOTE_ELEM_TT`="'.$oUser->returnCommentParam('NOTE_ELEM_TT').'",`NOTE_BACKLOG`="'.$mysqli->real_escape_string($oUser->returnCommentParam('NOTE_BACKLOG')).'",`STYLED_CHAR_CNT`="'.$mysqli->real_escape_string($oUser->returnCommentParam('STYLED_CHAR_CNT')).'",`RAW_CHAR_CNT`="'.$mysqli->real_escape_string($oUser->returnCommentParam('RAW_CHAR_CNT')).'",`DATEMODIFIED`="'.$ts.'" WHERE `NOTEID_SOURCE`="'.$mysqli->real_escape_string($oUser->returnCommentParam('NOTEID_SOURCE')).'" AND `NOTEID_CRC32`="'.crc32($oUser->returnCommentParam('NOTEID_SOURCE')).'" AND `USERNAME`="'.$mysqli->real_escape_string($oUser->returnCommentParam('USERNAME')).'" LIMIT 1;';
					 
					self::$query .= 'UPDATE `user_comments` SET `SUBJECT`="'.$oUser->returnCommentParam('SUBJECT').'",`NOTE_BACKLOG`="'.$mysqli->real_escape_string($oUser->returnCommentParam('NOTE_BACKLOG')).'",`DATEMODIFIED`="'.$ts.'" WHERE `NOTEID_SOURCE`="'.$mysqli->real_escape_string($oUser->returnCommentParam('NOTEID_SOURCE')).'" AND `NOTEID_CRC32`="'.crc32($oUser->returnCommentParam('NOTEID_SOURCE')).'" AND `USERNAME`="'.$mysqli->real_escape_string($oUser->returnCommentParam('USERNAME')).'" LIMIT 1;';
					
					if(strlen($oUser->returnCommentParam('NOTE_ELEM_SEARCH'))>1){
						self::$query .= 'UPDATE `crnrstn_ugc_search` SET `NOTE_ELEM_SEARCH`="'.$oUser->returnCommentParam('NOTE_ELEM_SEARCH').'",`SUBJECT`="'.$oUser->returnCommentParam('SUBJECT_SEARCH').'",`DATEMODIFIED`="'.$ts.'" WHERE `NOTEID_SOURCE`="'.$mysqli->real_escape_string($oUser->returnCommentParam('NOTEID_SOURCE')).'" AND `NOTEID_CRC32`="'.crc32($oUser->returnCommentParam('NOTEID_SOURCE')).'" LIMIT 1;';
					}
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query);

					//
					// COMMIT TRANSACTION
					//$mysqli->commit();
					
					$ROWCNT=0;
					do {
						if($mysqli->error){
//							//
//							// ROLL BACK DUE TO ERROR
							//$mysqli->rollback();
							if($ROWCNT>0){
								self::$query_exception_result='usercommentupdate=false';
							}else{
								self::$query_exception_result='usercommentupdate=falseall';
							}
							
							throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
							
						}
						$ROWCNT++;
				
						if ($mysqli->more_results()) {
							//
							// END OF RECORD. MORE TO FOLLOW.
						}
					} while ($mysqli->next_result());
				
					if($mysqli->error){
//						//
//						// ROLL BACK DUE TO ERROR
						//$mysqli->rollback();
						self::$query_exception_result='usercommentupdate=false';
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					}
				
					//
					// CLOSE CONNECTION
					$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);					
					return 'usercommentupdate=true';
					
				break;
				case 'svc_deleteUserComment':
					if(strlen($oUser->returnCommentParam('CLASSID_SOURCE'))>10){
						$tmp_destid = $oUser->returnCommentParam('CLASSID_SOURCE');
					}else{
						$tmp_destid = $oUser->returnCommentParam('METHODID_SOURCE');
					}
					
					//
					// BUILD QUERY
					self::$query = 'UPDATE `crnrstn_'.$tmp_destid.'_comments` SET `ISACTIVE`="0",`DATEMODIFIED`="'.$ts.'" WHERE `NOTEID_SOURCE`="'.$mysqli->real_escape_string($oUser->returnCommentParam('NOTEID_SOURCE')).'" AND `NOTEID_CRC32`="'.crc32($oUser->returnCommentParam('NOTEID_SOURCE')).'" AND `USERNAME`="'.$mysqli->real_escape_string($oUser->returnCommentParam('USERNAME')).'" LIMIT 1;';
					self::$query .= 'UPDATE `user_comments` SET `ISACTIVE`="0",`DATEMODIFIED`="'.$ts.'" WHERE `NOTEID_SOURCE`="'.$mysqli->real_escape_string($oUser->returnCommentParam('NOTEID_SOURCE')).'" AND `NOTEID_CRC32`="'.crc32($oUser->returnCommentParam('NOTEID_SOURCE')).'" AND `USERNAME`="'.$mysqli->real_escape_string($oUser->returnCommentParam('USERNAME')).'" LIMIT 1;';
					self::$query .= 'UPDATE `crnrstn_ugc_search` SET `ISACTIVE`="0",`DATEMODIFIED`="'.$ts.'" WHERE `NOTEID_SOURCE`="'.$mysqli->real_escape_string($oUser->returnCommentParam('NOTEID_SOURCE')).'" AND `NOTEID_CRC32`="'.crc32($oUser->returnCommentParam('NOTEID_SOURCE')).'" LIMIT 1;';
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query);

					//
					// COMMIT TRANSACTION
					//$mysqli->commit();
					
					$ROWCNT=0;
					do {
						if($mysqli->error){
//							//
//							// ROLL BACK DUE TO ERROR
							//$mysqli->rollback();
							if($ROWCNT>0){
								self::$query_exception_result='usercommentdelete=false';
							}else{
								self::$query_exception_result='usercommentdelete=falseall';
							}
							
							throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
							
						}
						$ROWCNT++;
				
						if ($mysqli->more_results()) {
							//
							// END OF RECORD. MORE TO FOLLOW.
						}
					} while ($mysqli->next_result());
				
					if($mysqli->error){
//						//
//						// ROLL BACK DUE TO ERROR
						//$mysqli->rollback();
						self::$query_exception_result='usercommentdelete=false';
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					}
				
					//
					// CLOSE CONNECTION
					$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);					
					return 'usercommentdelete=true';

				break;
				case 'edit_class':
				
					if($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'class_remove_chk')==1){
						echo "deleting class...";
						die();
						
						self::$query = 'UPDATE `crnrstn_class` SET `ISACTIVE`="0",`DATEMODIFIED`="'.$ts.'" WHERE `CLASSID`="'.crc32($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'c')).'" AND `CLASSID_SOURCE`="'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'c')).'" LIMIT 1;';
						
						echo self::$query;
						die();
					}else{
						//
						// BUILD QUERY
						self::$query = 'UPDATE `crnrstn_class` SET `NAME`="'.$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'name').'",`NAME_SEARCH`="'.$this->search_FillerSanitize(strtolower($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'name'))).'",`DESCRIPTION`="'.htmlentities($this->clearDblBR($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'description'))).'",`DESCRIPTION_SEARCH`="'.$this->search_FillerSanitize($this->clearDblBR(strtolower($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'description')))).'",`VERSION`="'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'version')).'",`URI`="'.$mysqli->real_escape_string(strtolower(trim($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'uri')))).'",`LANGCODE`="'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'langcode')).'",`DATEMODIFIED`="'.$ts.'" WHERE `CLASSID`="'.crc32($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'c')).'" AND `CLASSID_SOURCE`="'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'c')).'" LIMIT 1;';
					}
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
					if($mysqli->error){
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					
					}else{
						//
						// CLOSE CONNECTION
						$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);					
						return 'delete=true';
					
					}
				break;
				case 'edit_techspec':
					//
					// BUILD QUERY
					for($i=0;$i<5000;$i++){						
						//
						// UPDATE EXISTING TECH SPECS
						if($oUserEnvironment->oHTTP_MGR->issetParam($_POST,'specificationid'.$i)){
							#error_log("(1500) we have specificationid content...".$i);
							//
							// UPDATE CLASS TECH SPECS
							if($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'specification'.$i)!=''){
								self::$query .= 'UPDATE `crnrstn_techspecs` SET `TECHSPEC_CONTENT`="'.htmlentities($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'specification'.$i)).'",`TECHSPEC_SEARCH`="'.$this->search_FillerSanitize(strtolower($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'specification'.$i))).'",`URI`="'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'uri')).'",`DATEMODIFIED`="'.$ts.'" WHERE `TECHSPECID`="'.crc32($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'specificationid'.$i)).'" AND `TECHSPECID_SOURCE`="'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'specificationid'.$i)).'" LIMIT 1;';
							}else{
								self::$query .= 'UPDATE `crnrstn_techspecs` SET `ISACTIVE`="0",`DATEMODIFIED`="'.$ts.'" WHERE `TECHSPECID`="'.crc32($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'specificationid'.$i)).'" AND `TECHSPECID_SOURCE`="'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'specificationid'.$i)).'" LIMIT 1;';
							}

						}else{
						
							//
							// NO ID. CHECK FOR CONTENT OF NEW SPECIFICATIONS
							#error_log("(1512) checking...is specification set...");
							if($oUserEnvironment->oHTTP_MGR->issetParam($_POST,'specification'.$i)){
								
								//
								// PREPARE HASHES
								$seednum = microtime().rand();
								$seednum_full = md5($seednum);
								$seednum_mini = substr($seednum_full,1,20);
					
								//
								// QUERY FOR NEW SPECIFICATION PROVIDED (CLASS)
								if($oUserEnvironment->oHTTP_MGR->issetParam($_POST,'c')!=''){
									self::$query .= 'INSERT INTO crnrstn_techspecs (`TECHSPECID`,`TECHSPECID_SOURCE`,`CLASSID`,`TECHSPEC_CONTENT`,`TECHSPEC_SEARCH`,`URI`,`DATEMODIFIED`) VALUES ("'.crc32($seednum_mini).'","'.$seednum_mini.'","'.crc32($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'c')).'","'.$this->clearDblBR($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'specification'.$i)).'","'.$this->search_FillerSanitize($this->clearDblBR(strtolower($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'specification'.$i)))).'","'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'uri')).'","'.$ts.'");';
								
								}else{
									//
									// QUERY FOR NEW SPECIFICATION PROVIDED (METHOD)
									if($oUserEnvironment->oHTTP_MGR->issetParam($_POST,'m')!=''){
										self::$query .= 'INSERT INTO crnrstn_techspecs (`TECHSPECID`,`TECHSPECID_SOURCE`,`METHODID`,`TECHSPEC_CONTENT`,`TECHSPEC_SEARCH`,`URI`,`DATEMODIFIED`) VALUES ("'.crc32($seednum_mini).'","'.$seednum_mini.'","'.crc32($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'm')).'","'.$this->clearDblBR($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'specification'.$i)).'","'.$this->search_FillerSanitize($this->clearDblBR(strtolower($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'specification'.$i)))).'","'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'uri')).'","'.$ts.'");';
									}
								}
							
							}else{
								//
								// END OF VALUES. EXIT LOOP
								$i=100000;
							}
						}
					}
					
					#error_log("(1543) query: ".self::$query);
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query);
					if($mysqli->error){
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					
					}else{
						//
						// CLOSE CONNECTION
						$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);					
						return true;
					
					}
				break;
				case 'svc_submitExamples':
					//
					// BUILD QUERY
					if($oUser->getReqParamByKey('EXAMPLEID')!=''){
						//
						// UPDATE EXISTING EXAMPLE
						if($oUser->getReqParamByKey('EXAMPLE_RAW')!=''){
							self::$query = 'UPDATE `crnrstn_examples` SET `TITLE`="'.$oUser->getReqParamByKey('TITLE').'",`TITLE_SEARCH`="'.$oUser->getReqParamByKey('TITLE_SEARCH').'",`EXAMPLE_FORMATTED`="'.$oUser->getReqParamByKey('EXAMPLE_FORMATTED').'",`EXAMPLE_RAW`="'.$oUser->getReqParamByKey('EXAMPLE_RAW').'",`EXAMPLE_SEARCH`="'.$oUser->getReqParamByKey('EXAMPLE_SEARCH').'",`DESCRIPTION`="'.$oUser->getReqParamByKey('DESCRIPTION').'",`DESCRIPTION_SEARCH`="'.$oUser->getReqParamByKey('DESCRIPTION_SEARCH').'",`URI`="'.$mysqli->real_escape_string($oUser->getReqParamByKey('URI')).'",`EXAMPLE_ELEM_TT`="'.$oUser->getReqParamByKey('EXAMPLE_ELEM_TT').'",`CHAR_CNT_FORMATTED`="'.$mysqli->real_escape_string($oUser->getReqParamByKey('CHAR_CNT_FORMATTED')).'",`CHAR_CNT_RAW`="'.$mysqli->real_escape_string($oUser->getReqParamByKey('CHAR_CNT_RAW')).'",`CHAR_CNT_SEARCH`="'.$mysqli->real_escape_string($oUser->getReqParamByKey('CHAR_CNT_SEARCH')).'",`DATEMODIFIED`="'.$ts.'" WHERE `EXAMPLEID`="'.$oUser->getReqParamByKey('EXAMPLEID').'" AND `EXAMPLEID_SOURCE`="'.$mysqli->real_escape_string($oUser->getReqParamByKey('EXAMPLEID_SOURCE')).'" LIMIT 1;';
							
						}else{
							self::$query = 'UPDATE `crnrstn_examples` SET `ISACTIVE`="0",`DATEMODIFIED`="'.$ts.'" WHERE `EXAMPLEID`="'.$oUser->getReqParamByKey('EXAMPLEID').'" AND `EXAMPLEID_SOURCE`="'.$mysqli->real_escape_string($oUser->getReqParamByKey('EXAMPLEID_SOURCE')).'" LIMIT 1;';
						}
						
					}else{
						if($oUser->getReqParamByKey('EXAMPLE_RAW')!=''){
							//
							// PREPARE HASHES
							$seednum = microtime().rand();
							$seednum_full = md5($seednum);
							$seednum_mini = substr($seednum_full,1,20);
							
							//
							// QUERY FOR NEW SPECIFICATION PROVIDED (CLASS)
							if($oUser->getReqParamByKey('CLASSID')!=''){
								self::$query = 'INSERT INTO `crnrstn_examples` (`EXAMPLEID`,`EXAMPLEID_SOURCE`,`CLASSID`,`TITLE`,`TITLE_SEARCH`,`EXAMPLE_FORMATTED`,`EXAMPLE_RAW`,`EXAMPLE_SEARCH`,`DESCRIPTION`,`DESCRIPTION_SEARCH`,`URI`,`EXAMPLE_ELEM_TT`,`CHAR_CNT_FORMATTED`,`CHAR_CNT_RAW`,`CHAR_CNT_SEARCH`,`DATEMODIFIED`) VALUES ("'.crc32($seednum_mini).'","'.$seednum_mini.'","'.$oUser->getReqParamByKey('CLASSID').'","'.$oUser->getReqParamByKey('TITLE').'","'.$oUser->getReqParamByKey('TITLE_SEARCH').'","'.$oUser->getReqParamByKey('EXAMPLE_FORMATTED').'","'.$oUser->getReqParamByKey('EXAMPLE_RAW').'","'.$oUser->getReqParamByKey('EXAMPLE_SEARCH').'","'.$oUser->getReqParamByKey('DESCRIPTION').'","'.$oUser->getReqParamByKey('DESCRIPTION_SEARCH').'","'.$mysqli->real_escape_string($oUser->getReqParamByKey('URI')).'","'.$oUser->getReqParamByKey('EXAMPLE_ELEM_TT').'","'.$mysqli->real_escape_string($oUser->getReqParamByKey('CHAR_CNT_FORMATTED')).'","'.$mysqli->real_escape_string($oUser->getReqParamByKey('CHAR_CNT_RAW')).'","'.$mysqli->real_escape_string($oUser->getReqParamByKey('CHAR_CNT_SEARCH')).'","'.$ts.'");';
							}else{
								//
								// QUERY FOR NEW SPECIFICATION PROVIDED (METHOD)
								if($oUser->getReqParamByKey('METHODID')!=''){
									self::$query = 'INSERT INTO `crnrstn_examples` (`EXAMPLEID`,`EXAMPLEID_SOURCE`,`METHODID`,`TITLE`,`TITLE_SEARCH`,`EXAMPLE_FORMATTED`,`EXAMPLE_RAW`,`EXAMPLE_SEARCH`,`DESCRIPTION`,`DESCRIPTION_SEARCH`,`URI`,`EXAMPLE_ELEM_TT`,`CHAR_CNT_FORMATTED`,`CHAR_CNT_RAW`,`CHAR_CNT_SEARCH`,`DATEMODIFIED`) VALUES ("'.crc32($seednum_mini).'","'.$seednum_mini.'","'.$oUser->getReqParamByKey('METHODID').'","'.$oUser->getReqParamByKey('TITLE').'","'.$oUser->getReqParamByKey('TITLE_SEARCH').'","'.$oUser->getReqParamByKey('EXAMPLE_FORMATTED').'","'.$oUser->getReqParamByKey('EXAMPLE_RAW').'","'.$oUser->getReqParamByKey('EXAMPLE_SEARCH').'","'.$oUser->getReqParamByKey('DESCRIPTION').'","'.$oUser->getReqParamByKey('DESCRIPTION_SEARCH').'","'.$mysqli->real_escape_string($oUser->getReqParamByKey('URI')).'","'.$mysqli->real_escape_string($oUser->getReqParamByKey('EXAMPLE_ELEM_TT')).'","'.$mysqli->real_escape_string($oUser->getReqParamByKey('CHAR_CNT_FORMATTED')).'","'.$mysqli->real_escape_string($oUser->getReqParamByKey('CHAR_CNT_RAW')).'","'.$mysqli->real_escape_string($oUser->getReqParamByKey('CHAR_CNT_SEARCH')).'","'.$ts.'");';
								}
							}
						}
					}
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query);
					if($mysqli->error){
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					
					}else{
						//
						// CLOSE CONNECTION
						$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);					
						return 'submit=true';
					
					}
				break;
				case 'new_function':
					//
					// PREPARE HASHES
					$seednum = microtime().rand();
					$seednum_full = md5($seednum);
					$seednum_mini = substr($seednum_full,1,20);
					
					#ELEMENT_TYPEID=[PHP_NATIVE_METHOD,PHP_LOGICAL_EXPRESS,PHP_SYSTEM_CONSTANTS,PHP_GLOBAL_ARRAYS]
					#$elemTypeID_SOURCE = 'PHP_NATIVE_METHOD';
					#$elemTypeID_SOURCE = 'PHP_LOGICAL_EXPRESS';
					#$elemTypeID_SOURCE = 'PHP_SYSTEM_CONSTANTS';
					$elemTypeID_SOURCE = 'PHP_GLOBAL_ARRAYS';		//THIS/POST/GET/COOKIE/
					
					//
					// BUILD QUERY
					self::$query = 'INSERT INTO code_element_define (`ELEMENTID`,`ELEMENTID_SOURCE`,`ELEM_TYPEID`,`ELEM_TYPEID_SOURCE`,`NAME`,`PHP_VERSION`,`DESCRIPTION_SHORT`,`DESCRIPTION_FULL`,`RELATED_FUNC_LIST`,`DATEMODIFIED`) VALUES ("'.crc32($seednum_mini).'","'.$seednum_mini.'","'.crc32($elemTypeID_SOURCE).'","'.$elemTypeID_SOURCE.'","'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'name')).'","'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'version')).'","'.htmlentities($this->clearDblBR(nl2br($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'description_short')))).'","'.htmlentities($this->clearDblBR(strtolower($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'description_full')))).'","'.htmlentities($this->clearDblBR(nl2br($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'see_also')))).'","'.$ts.'")';
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
					if($mysqli->error){
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					
					}else{
						//
						// CLOSE CONNECTION
						$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);					
						return true;
					
					}

				break;
				case 'edit_function':
					//
					// BUILD QUERY
					self::$query = 'UPDATE `code_element_define` SET `PHP_VERSION`="'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'version')).'",`DATEMODIFIED`="'.$ts.'" WHERE `ELEMENTID`="'.crc32($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'f')).'" AND `ELEMENTID_SOURCE`="'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'f')).'" LIMIT 1;';
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query);
					if($mysqli->error){
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					
					}else{
						//
						// CLOSE CONNECTION
						$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);					
						return true;
					}				
				
				break;
				case 'new_method':
					//
					// PREPARE HASHES
					$seednum = microtime().rand();
					$seednum_full = md5($seednum);
					$seednum_mini = substr($seednum_full,1,20);
					
					//
					// PREPARE URI IF NONE PROVIDED
					if($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'uri')==''){
						//
						// CONSTRUCT URI
						$tmpParens = array("(", ")");
						$tmpMethodName = strtolower(str_replace($tmpParens, "", $oUserEnvironment->oHTTP_MGR->extractData($_POST, 'name')));
						$tmpURI = 'crnrstn/documentation/classes/'.$oUserEnvironment->oSESSION_MGR->getSessionParam('newMethodClassName').'/'.$tmpMethodName.'/?m='.$seednum_mini;
						
					}else{
						$tmpURI = strtolower(trim($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'uri')));
					}
					
					//
					// BUILD QUERY
					self::$query = 'INSERT INTO crnrstn_method (`METHODID`,`METHODID_SOURCE`,`CLASSID`,`NAME`,`NAME_SEARCH`,`DESCRIPTION`,`DESCRIPTION_SEARCH`,`DEFINITION`,`DEFINITION_SEARCH`,`RETURNED_VALUE`,`RETURNED_SEARCH`,`URI`,`DATEMODIFIED`) VALUES ("'.crc32($seednum_mini).'","'.$seednum_mini.'","'.crc32($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'c')).'","'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'name')).'","'.$mysqli->real_escape_string($this->search_FillerSanitize(strtolower($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'name')))).'","'.htmlentities($this->clearDblBR(nl2br($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'description')))).'","'.$this->search_FillerSanitize($this->clearDblBR(strtolower($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'description')))).'","'.$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'definition').'","'.$this->search_FillerSanitize(strtolower($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'definition'))).'","'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'returnedvalue')).'","'.$mysqli->real_escape_string($this->search_FillerSanitize(strtolower($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'returnedvalue')))).'","'.$mysqli->real_escape_string($tmpURI).'","'.$ts.'")';
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
					if($mysqli->error){
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
						
					}else{
						//
						// CLOSE CONNECTION
						$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);					
						return true;
					
					}		
					
				break;
				case 'edit_method':
					//
					// BUILD QUERY
					if($oUserEnvironment->oHTTP_MGR->issetParam($_POST,'m')){
					
						//
						// ADD CHECKED BOXES TO QUERY
						self::$query = 'UPDATE `crnrstn_method` SET `NAME`="'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'name')).'",`NAME_SEARCH`="'.$mysqli->real_escape_string($this->search_FillerSanitize(strtolower($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'name')))).'",
						`DESCRIPTION`="'.htmlentities($this->clearDblBR(nl2br($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'description')))).'",`DESCRIPTION_SEARCH`="'.$this->search_FillerSanitize($this->clearDblBR(strtolower($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'description')))).'",`DEFINITION`="'.$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'definition').'",`DEFINITION_SEARCH`="'.$this->search_FillerSanitize(strtolower($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'definition'))).'",`RETURNED_VALUE`="'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'returnedvalue')).'",`RETURNED_SEARCH`="'.$mysqli->real_escape_string($this->search_FillerSanitize(strtolower($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'returnedvalue')))).'",`URI`="'.$mysqli->real_escape_string(strtolower(trim($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'uri')))).'",`DATEMODIFIED`="'.$ts.'" WHERE `METHODID`="'.crc32($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'm')).'" AND `METHODID_SOURCE`="'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'm')).'" LIMIT 1;';

					}else{
						//
						// NO METHODID FOR METHOD UPDATE. CLOSE CONNECTION
						$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);					
						return false;
					}
						
					#error_log("database.inc.php (1705) ".self::$query);
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query);
					if($mysqli->error){
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					
					}else{
						//
						// CLOSE CONNECTION
						$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);				
						return true;
					
					}
				
				break;
				case 'delete_method':
					//
					// BUILD QUERY
					for($i=0;$i<5000;$i++){						
						//
						// UPDATE EXISTING TECH SPECS
						if($oUserEnvironment->oHTTP_MGR->issetParam($_POST,'methodid'.$i)){
							if($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'method_remove_chk'.$i)==1){
								//
								// ADD TO QUERY FOR DELETION
								self::$query .= 'UPDATE `crnrstn_method` SET `ISACTIVE`="0",`DATEMODIFIED`="'.$ts.'" WHERE `METHODID`="'.crc32($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'methodid'.$i)).'" AND `METHODID_SOURCE`="'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'methodid'.$i)).'" LIMIT 1;';
							}
						
						}else{
							//
							// END OF VALUES. EXIT LOOP.
							$i=100000;
						}
					}
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query);
					if($mysqli->error){
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					
					}else{
						//
						// CLOSE CONNECTION
						$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);
						return true;
					
					}	
										
				break;
				case 'order_method':
					//
					// BUILD QUERY
					for($i=0;$i<5000;$i++){						
						//
						// UPDATE EXISTING TECH SPECS
						if($oUserEnvironment->oHTTP_MGR->issetParam($_POST,'methodid'.$i)){
							//
							// ADD CHECKED BOXES TO QUERY
							self::$query .= 'UPDATE `crnrstn_method` SET `NAV_POSITION`="'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'method_order'.$i)).'",`DATEMODIFIED`="'.$ts.'" WHERE `METHODID`="'.crc32($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'methodid'.$i)).'" AND `METHODID_SOURCE`="'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'methodid'.$i)).'" LIMIT 1;';
					
						}else{
							//
							// END OF VALUES. EXIT LOOP.
							$i=100000;
						}
					}
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query);
					if($mysqli->error){
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					
					}else{
						//
						// CLOSE CONNECTION
						$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);
						return true;
						
					}		
					
				break;
				case 'new_class':
					//
					// PREPARE HASHES
					$seednum = microtime().rand();
					$seednum_full = md5($seednum);
					$seednum_mini = substr($seednum_full,1,20);
					
					//
					// BUILD QUERY
					self::$query = 'INSERT INTO crnrstn_class (`CLASSID`,`CLASSID_SOURCE`,`NAME`,`NAME_SEARCH`,`DESCRIPTION`,`DESCRIPTION_SEARCH`,`VERSION`,`URI`,`DATEMODIFIED`) VALUES ("'.crc32($seednum_mini).'","'.$seednum_mini.'","'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'name')).'","'.$mysqli->real_escape_string($this->search_FillerSanitize(strtolower($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'name')))).'","'.htmlentities($this->clearDblBR($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'description'))).'","'.$this->search_FillerSanitize($this->clearDblBR(strtolower($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'description')))).'","'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'version')).'","'.$mysqli->real_escape_string(strtolower(trim($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'uri')))).'","'.$ts.'")';
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);
					if($mysqli->error){
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					
					}else{
						//
						// CLOSE CONNECTION
						$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);				
						return true;
					
					}				
					
				break;
				case 'method_parameters':
					//
					// BUILD QUERY
					for($i=0;$i<5000;$i++){						
						//
						// UPDATE EXISTING TECH SPECS
						if($oUserEnvironment->oHTTP_MGR->issetParam($_POST,'m')){
							if($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'param_id'.$i)!=''){
								if($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'param_name'.$i)!=''){
									//
									// UPDATE EXISTING PARAMETER + METADATA
									self::$query .= 'UPDATE `crnrstn_params` SET `NAME`="'.$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'param_name'.$i).'",`NAME_SEARCH`="'.$this->search_FillerSanitize(strtolower($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'param_name'.$i))).'",`ISREQUIRED`="'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'param_required'.$i)).'",`DESCRIPTION`="'.htmlentities($this->clearDblBR($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'param_description'.$i))).'",`DESCRIPTION_SEARCH`="'.$this->search_FillerSanitize($this->clearDblBR(strtolower($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'param_description'.$i)))).'",`URI`="'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'uri')).'",`DATEMODIFIED`="'.$ts.'" WHERE `PARAMETERID`="'.crc32($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'param_id'.$i)).'" AND `PARAMETERID_SOURCE`="'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'param_id'.$i)).'" LIMIT 1;';
								}else{
									//
									// DELETE PARAMATER
									self::$query .= 'UPDATE `crnrstn_params` SET `ISACTIVE`="0",`DATEMODIFIED`="'.$ts.'" WHERE `PARAMETERID`="'.crc32($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'param_id'.$i)).'" AND `PARAMETERID_SOURCE`="'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'param_id'.$i)).'" LIMIT 1;';
								}

							}else{
								//
								// PREPARE HASHES
								$seednum = microtime().rand();
								$seednum_full = md5($seednum);
								$seednum_mini = substr($seednum_full,1,20);
							
								//
								// ADD NEW PARAMETER TO DATABASE
								if($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'param_name'.$i)!=''){
									self::$query .= 'INSERT INTO crnrstn_params (`PARAMETERID`,`PARAMETERID_SOURCE`,`METHODID`,`NAME`,`NAME_SEARCH`,`ISREQUIRED`,`DESCRIPTION`,`DESCRIPTION_SEARCH`,`URI`,`DATEMODIFIED`) VALUES ("'.crc32($seednum_mini).'","'.$seednum_mini.'","'.crc32($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'm')).'","'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'param_name'.$i)).'","'.$mysqli->real_escape_string($this->search_FillerSanitize(strtolower($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'param_name'.$i)))).'","'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'param_required'.$i)).'","'.htmlentities($this->clearDblBR($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'param_description'.$i))).'","'.$this->search_FillerSanitize($this->clearDblBR(strtolower($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'param_description'.$i)))).'","'.$mysqli->real_escape_string($oUserEnvironment->oHTTP_MGR->extractData($_POST, 'uri')).'","'.$ts.'");';
								}
							}
						
						}else{
							//
							// END OF VALUES. EXIT LOOP.
							$i=100000;
						}
					}
					
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query);
					if($mysqli->error){
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					
					}else{
						//
						// CLOSE CONNECTION
						$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);
						return true;
						
					}				
					
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
	
	public function __destruct() {

	}
}

?>