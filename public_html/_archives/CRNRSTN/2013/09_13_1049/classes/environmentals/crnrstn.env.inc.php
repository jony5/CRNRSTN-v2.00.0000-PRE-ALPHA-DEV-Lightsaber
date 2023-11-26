<?php
#
# [INSERT HEADER FROM MOST RECENT DEVELOPMENT ON MAC BOOK PRO ONCE YOU GET THE DATA FROM THAT HARD DRIVE.]
#

class environmentals{
	private static $resource_ARRAY = array();
	private static $resourceKey;
	
	private static $oLOGGER;
	public static $oMYSQLI;
	public static $oMYSQLI_CONN_MGR;
	public static $oMYSQLI_IPSECURITY_MGR;
	public $oMYSQLI_ARRAY = array();
	
	public function __construct($oCRNRSTN) {
		//
		// INSTANTIATE LOGGER
		self::$oLOGGER = new logging('__construct class environmentals ::');
		
		// 
		// # 1 - RUN METHOD TO DETERMINE CURRENT ENVIRONMENT
		// DETERMINE THE KEY TO BE USED IN THE CURRENT ENVIRONMENT. VALUE MAY BE RETURNED FROM STATIC OR AS RESULT OF LOOPING
		// THROUGH CONFIGS WITH PROMISING VARIABLE MATCHES AS CREATED DURING CRNRSTN RESOURCE DEFINITION TO DETERMINE BEST FIT.
		// USER DEFINED ENVIRONMENTAL CONSTANTS THAT HAVE ZERO RESOURCE KEY MATCHES WITH THE PRESENT SERVER SETTINGS ARE SKIPPED.
		try{
			self::$resourceKey = $oCRNRSTN->getServerEnv();
			if(!self::$resourceKey){
				throw new Exception('CRNRSTN environmental configuration error :: unable to detect environment on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].').');
			}
			
			// 
			// # 2 - APPLY ENV DETECTION RESULTS TO oCRNRSTN OBJECT TO EXTRACT RELEVANT DATA
			// # 3 - INITIALIZE oENV CLASS OBJECT WITH THE RELEVANT ENVIRONMENTAL DATA
			// INITIALIZE oENV CLASS OBJECT WITH RELEVANT RESOURCE DATA PER THE ASSIGNED AND APPROPRIATELY DETECTED ENV RESOURCE KEY
			foreach($oCRNRSTN::$handle_resource_ARRAY[self::$resourceKey] as $key=>$value){
				self::$resource_ARRAY[$key]=$value;
			}
			
			//
			// INSTANTIATE ENVIRONMENTAL DB CONNECTION MANAGEMENT CLASS OBJECT AND CLONE FROM CRNRSTN
			$this->oMYSQLI_CONN_MGR = new mysqli_connection_manager();
			$this->oMYSQLI_CONN_MGR = clone $oCRNRSTN->oMYSQLI_CONN_MGR;
			unset($oCRNRSTN->oMYSQLI_CONN_MGR);
			
			//
			// INSTANTIATE ENVIRONMENTAL IP ACCESS AUTHORIZATION MANAGEMENT CLASS OBJECT AND CLONE FROM CRNRSTN
			$this->oMYSQLI_IPSECURITY_MGR = new ip_auth_manager($oCRNRSTN->oMYSQLI_IPSECURITY_MGR->clientIpAddress());
			$this->oMYSQLI_IPSECURITY_MGR = clone $oCRNRSTN->oMYSQLI_IPSECURITY_MGR;
			unset($oCRNRSTN->oMYSQLI_IPSECURITY_MGR);
			
			//
			// UPDATE oMYSQLI CONNECTION MANAGER WITH THE RELEVANT ENVIRONMENTAL DATA
			$this->oMYSQLI_CONN_MGR->setEnvironment(self::$resourceKey, $oCRNRSTN);
			
			//
			// UPDATE IP ACCESS AUTHORIZATION MANAGER WITH THE RELEVANT ENVIRONMENTAL DATA
			if(!$this->oMYSQLI_IPSECURITY_MGR->authorizeEnvAccess(self::$resourceKey)){
				//throw new Exception('CRNRSTN environmental access authorization error :: access denied to requested resource on '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].').');
				//self::$oLOGGER->captureNotice(LOG_NOTICE, 'CRNRSTN environmental access authorization error :: access denied to requested resource on '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].').');
				
				//
				// WE NEED A MORE GRACEFUL WAY TO TRANSITION TO ERR...BUT THIS WORKS
				$oCRNRSTN->returnSrvrRespStatus(403);
				die();
			}
		} catch( Exception $e ) {
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLOGGER->captureNotice(LOG_CRIT, $e->getMessage());
						
			//
			// RETURN NOTHING
			return false;
		}
	}
	
	public static function set($key, $value) {
        self::$resource_ARRAY[$key] = $value;
    }

    public static function get($key) {
		try{
			if(array_key_exists($key, self::$resource_ARRAY)){
				return self::$resource_ARRAY[$key];
			}else{
				throw new Exception('Environmental config data access error :: {environmentals object}::get() failed to locate an initialized resource key ('.$key.'), so no data for that parameter could be returned on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].').');
			}
			
		} catch( Exception $e ) {
			//
			// SEND THIS THROUGH THE LOGGER OBJECT...THAT IS STILL TBD
			self::$oLOGGER->captureNotice(LOG_ERR, $e->getMessage());
			#print $e->getMessage();
			
			//
			// RETURN NOTHING
			return false;
		}
    }

	public function __destruct() {
		
	}
}
?>