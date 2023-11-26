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
	
	public function trkOpen($oUser, $oUserEnvironment){
		return $this->dbQuery('trkOpen', $oUserEnvironment, $oUser);
	}
	
	public function trkClick($oUser, $oUserEnvironment){
		return $this->dbQuery('trkClick', $oUserEnvironment, $oUser);
	}
	
	private function dbQuery($queryType, $oUserEnvironment, $oUser){
		try{
			$ts = date("Y-m-d H:i:s", time()-60*60*6);
			
			//
			// OPEN CONNECTION
			#$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->returnConnection('localhost', 'comm_stage');
			$mysqli = $oUserEnvironment->oMYSQLI_CONN_MGR->returnConnection();
						
			switch($queryType){
				case 'trkOpen':
					//
					//	BUILD QUERY 
					self::$query = 'INSERT INTO `msg_log_open` 
					(`EMAIL`,`EMAIL_CRC32`,`MSG_SOURCEID`,`BATCH_SOURCEID`,`MSG_KEYID`,`REMOTE_ADDR`) VALUES 
					("'.$mysqli->real_escape_string($oUser->sspwbwf_e).'",
					"'.crc32($oUser->sspwbwf_e).'",
					"'.$mysqli->real_escape_string($oUser->sspwbwf_x_msg).'",
					"'.$mysqli->real_escape_string($oUser->sspwbwf_x_btch).'",
					"'.$mysqli->real_escape_string($oUser->sspwbwf_type).'",
					INET_ATON("'.$oUser->ipaddress.'"));';
	
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);

					if($mysqli->error){
						self::$query_exception_result='trkopen=false';
						throw new Exception('CRNRSTN database_integration ['.self::$query_exception_result.'] :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					}
	
					//
					// CLOSE CONNECTION
					$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);
					return true;
					
				break;
				case 'trkClick':
					//
					//	BUILD QUERY 
					self::$query = 'INSERT INTO `msg_log_click` 
					(`EMAIL`,`EMAIL_CRC32`,`MSG_SOURCEID`,`BATCH_SOURCEID`,`MSG_KEYID`,`LINK_NAME`,`LINK_URI`,
					`REMOTE_ADDR`) VALUES 
					("'.$mysqli->real_escape_string($oUser->sspwbwf_e).'",
					"'.crc32($oUser->sspwbwf_e).'",
					"'.$mysqli->real_escape_string($oUser->sspwbwf_x_msg).'",
					"'.$mysqli->real_escape_string($oUser->sspwbwf_x_btch).'",
					"'.$mysqli->real_escape_string($oUser->sspwbwf_type).'",
					"'.$mysqli->real_escape_string($oUser->sspwbfb_lnk).'",
					"'.$mysqli->real_escape_string($oUser->sspwbfb_uri).'",
					INET_ATON("'.$oUser->ipaddress.'"));';
	
					//
					// PROCESS QUERY
					self::$result = $oUserEnvironment->oMYSQLI_CONN_MGR->processQuery($mysqli, self::$query);

					if($mysqli->error){
						self::$query_exception_result='trkclick=false';
						throw new Exception('CRNRSTN database_integration ['.self::$query_exception_result.'] :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
					}
	
					//
					// CLOSE CONNECTION
					$oUserEnvironment->oMYSQLI_CONN_MGR->closeConnection($mysqli);
					return true;
					
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
	
	public function __destruct() {

	}
}

?>