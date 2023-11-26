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
	
	public function retrieveMsgQueue($oUser, $oUserEnvironment){
		return $this->dbQuery('retrieveMsgQueue', $oUserEnvironment, $oUser);
	}
	
	public function processBatchResults($oUser, $oUserEnvironment){
		return $this->dbQuery('processBatchResults', $oUserEnvironment, $oUser);
	}
	
	private function dbQuery($queryType, $oUserEnvironment, $oUser){
		try{
			$ts = date("Y-m-d H:i:s", time()-60*60*6);
			
			//
			// OPEN CONNECTION
			$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->returnConnection();
						
			switch($queryType){
				case 'retrieveMsgQueue':
					//
					// BUILD QUERY
					self::$query = 'SELECT `msg_content`.`MSG_KEYID`,`msg_content`.`ISACTIVE`,`msg_content`.`LANGCODE`,`msg_content`.`MSG_NAME`,`msg_content`.`MSG_SUBJECT`,`msg_content`.`MSG_HTML`,`msg_content`.`MSG_TEXT` FROM `msg_content` WHERE `msg_content`.`ISACTIVE`="1";';
					
					//
					// PROCESS QUERY
					error_log("/services/database.msg.inc.php (48) processMultiQuery: ".self::$query);
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
					}
					
					//
					// 
					for($i=0;$i<sizeof(self::$result_ARRAY);$i++){
						$tmp_query_cond .= '(`msg_queue`.`MSG_KEYID`="'.self::$result_ARRAY[$i][0].'" AND `msg_queue`.`MSG_KEYID_CRC32`="'.crc32(self::$result_ARRAY[$i][0]).'" AND `msg_queue`.`ISACTIVE`="1") OR ';
					}
					
					//
					// TRIM TRAILING "OR"
					$tmp_len = strlen($tmp_query_cond);
					$tmp_len = $tmp_len - 3;
					$tmp_query_cond = substr($tmp_query_cond, 0, $tmp_len);
					
					self::$query = 'SELECT `msg_content`.`MSG_KEYID`,`msg_content`.`ISACTIVE`,`msg_content`.`LANGCODE`,`msg_content`.`MSG_NAME`,`msg_content`.`MSG_SUBJECT`,`msg_content`.`MSG_HTML`,`msg_content`.`MSG_TEXT` FROM `msg_content` WHERE `msg_content`.`ISACTIVE`="1";';
					self::$query .= 'SELECT `msg_queue`.`MSG_SOURCEID`,`msg_queue`.`MSG_KEYID`,`msg_queue`.`ISACTIVE`,`msg_queue`.`LANGCODE`,`msg_queue`.`EMAIL`,`msg_queue`.`USERNAME_DISPLAY`,`msg_queue`.`ACTIVATION_KEY`,`msg_queue`.`NOTEID_SOURCE`,`msg_queue`.`REPLYTO_NOTEID`,`msg_queue`.`PWD_RESET`,`msg_queue`.`DATEMODIFIED`,`msg_queue`.`DATECREATED` FROM `msg_queue` WHERE ('.$tmp_query_cond.') LIMIT 2000;';
					
					//
					// PROCESS QUERY
					error_log("/services/database.msg.inc.php (99) processMultiQuery: ".self::$query);
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query);
					
					$ROWCNT=0;
					do {
						if($mysqli->error){
							if($ROWCNT>0){
								self::$query_exception_result='batchprocess=false';
							}else{
								self::$query_exception_result='batchprocess=falseall';
							}
							
							throw new Exception('CRNRSTN database_integration ['.self::$query_exception_result.'] :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
							
						}
						
						if(self::$result = $mysqli->store_result()) {
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
				
					if($mysqli->error){
						self::$query_exception_result='batchprocess=false';	
						throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					}
					
					//
					// BUILD QUERY
					self::$query = '';
					for($ii=0;$ii<sizeof(self::$result_ARRAY);$ii++){
						if(sizeof(self::$result_ARRAY[$ii])==12){
							self::$query .= 'UPDATE `msg_queue` SET `msg_queue`.`ISACTIVE`="3", `msg_queue`.`DATEMODIFIED`="'.$ts.'" 
							WHERE `msg_queue`.`MSG_SOURCEID`="'.self::$result_ARRAY[$ii][0].'" AND 
							`msg_queue`.`MSG_SOURCEID_CRC32`="'.crc32(self::$result_ARRAY[$ii][0]).'" AND 
							`msg_queue`.`MSG_KEYID`="'.self::$result_ARRAY[$ii][1].'" AND
							`msg_queue`.`MSG_KEYID_CRC32`="'.crc32(self::$result_ARRAY[$ii][1]).'" AND
							`msg_queue`.`ISACTIVE`="1" LIMIT 1;';
						}
					}
					
					//
					// PROCESS QUERY
					error_log("/services/database.msg.inc.php (155) processMultiQuery: ".self::$query);
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query);
					
					$ROWCNT=0;
					do {
						if($mysqli->error){
							if($ROWCNT>0){
								self::$query_exception_result='batchprocesslock=false';
							}else{
								self::$query_exception_result='batchprocesslock=falseall';
							}
							
							throw new Exception('CRNRSTN database_integration ['.self::$query_exception_result.'] :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
							
						}
						$ROWCNT++;
				
						if ($mysqli->more_results()) {
							//
							// END OF RECORD. MORE TO FOLLOW.
						}
					} while ($mysqli->next_result());
				
					if($mysqli->error){
						self::$query_exception_result='batchprocesslock=false';	
						throw new Exception('CRNRSTN database_integration ['.self::$query_exception_result.'] :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					}
	
					//
					// CLOSE CONNECTION
					$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);
					
					//
					// RETURN RESULT SET ARRAY
					return self::$result_ARRAY;
					
				break;
				case 'processBatchResults':
					self::$query = '';
					
					//
					// PROCESS RESULTS [UPDATE MESSAGE QUEUE DATABASE FLAGS]
					for($msgcnt=0;$msgcnt<sizeof($oUser->msg_batch_request);$msgcnt++){
						#error_log('(194) curl_multi_getcontent.msg_batch_response['.$msgcnt.'] :: '.$oUser->msg_batch_response[$msgcnt]);
						switch($oUser->msg_batch_response[$msgcnt]){
							case 'success':
								//
								//	BUILD QUERY :: CURL HTTP POST TRANSACTION SUCCESS
								self::$query .= 'UPDATE `msg_queue` SET `msg_queue`.`ISACTIVE`="0", `msg_queue`.`DATEMODIFIED`="'.$ts.'" 
								WHERE `msg_queue`.`MSG_SOURCEID`="'.$oUser->msg_batch_request[$msgcnt]['SERIAL_MSG'].'" AND 
								`msg_queue`.`MSG_SOURCEID_CRC32`="'.crc32($oUser->msg_batch_request[$msgcnt]['SERIAL_MSG']).'" AND 
								`msg_queue`.`MSG_KEYID`="'.$oUser->msg_batch_request[$msgcnt]['MSG_KEYID'].'" AND
								`msg_queue`.`MSG_KEYID_CRC32`="'.crc32($oUser->msg_batch_request[$msgcnt]['MSG_KEYID']).'" AND
								(`msg_queue`.`ISACTIVE`="3" OR `msg_queue`.`ISACTIVE`="6" ) AND
								`msg_queue`.`EMAIL`="'.$oUser->msg_batch_request[$msgcnt]['MSG_EMAIL'].'" LIMIT 1;';
							break;
							default:
								//
								// BUILD QUERY :: CURL HTTP POST TRANSACTION ERROR 
								self::$query .= 'UPDATE `msg_queue` SET `msg_queue`.`ISACTIVE`="6", 
								`msg_queue`.`ERROR_INFO`="'.$oUser->msg_batch_response[$msgcnt].'", 
								`msg_queue`.`DATEMODIFIED`="'.$ts.'" 
								WHERE `msg_queue`.`MSG_SOURCEID`="'.$oUser->msg_batch_request[$msgcnt]['SERIAL_MSG'].'" AND 
								`msg_queue`.`MSG_SOURCEID_CRC32`="'.crc32($oUser->msg_batch_request[$msgcnt]['SERIAL_MSG']).'" AND 
								`msg_queue`.`MSG_KEYID`="'.$oUser->msg_batch_request[$msgcnt]['MSG_KEYID'].'" AND
								`msg_queue`.`MSG_KEYID_CRC32`="'.crc32($oUser->msg_batch_request[$msgcnt]['MSG_KEYID']).'" AND
								(`msg_queue`.`ISACTIVE`="3" OR `msg_queue`.`ISACTIVE`="6" ) AND
								`msg_queue`.`EMAIL`="'.$oUser->msg_batch_request[$msgcnt]['MSG_EMAIL'].'" LIMIT 1;';
							break;
						}
					}
					
					//
					// PROCESS QUERY
					error_log("/services/ database.msg.inc.php (229) processMultiQuery: ".self::$query);
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, self::$query);
					
					$ROWCNT=0;
					do {
						if($mysqli->error){
							if($ROWCNT>0){
								self::$query_exception_result='batchprocessclose=false';
							}else{
								self::$query_exception_result='batchprocessclose=falseall';
							}
							
							throw new Exception('CRNRSTN database_integration ['.self::$query_exception_result.'] :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
							
						}
						$ROWCNT++;
				
						if ($mysqli->more_results()) {
							//
							// END OF RECORD. MORE TO FOLLOW.
						}
					} while ($mysqli->next_result());
				
					if($mysqli->error){
						self::$query_exception_result='batchprocessclose=false';
						throw new Exception('CRNRSTN database_integration ['.self::$query_exception_result.'] :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					}
	
					//
					// CLOSE CONNECTION
					$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);
					return 'batchprocessclose=true';
					
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