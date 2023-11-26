<?php
#
# [INSERT HEADER FROM MOST RECENT DEVELOPMENT ON MAC BOOK PRO ONCE YOU GET THE DATA FROM THAT HARD DRIVE.]
#

class mysqli_conn {
	private static $db_host;				// = $host;
	private static $db_db;					// = $dbname;
	private static $db_un;					// = $un;
	private static $db_pwd;					// = $pwd;
	private static $db_port;				// = $port;
	
	public $mysqli;
	
	private static $oLOGGER;

	public function __construct($host, $un, $pwd, $db, $port=NULL) {
		// 
		// INSTANTIATE LOGGER
		self::$oLOGGER = new logging('__construct class mysqli_conn ::');
		
		self::$db_host 		= $host;
		self::$db_db	 	= $db;
		self::$db_un 		= $un;
		self::$db_pwd 		= $pwd;
		self::$db_port 		= (int) $port;
	}
	
	public function connReturn(){
		//
		// ESTABLISH AND RETURN MYSQLI CONNECTION
		try{
			if(self::$db_port!=''){
				$mysqli = new mysqli(self::$db_host, self::$db_un, self::$db_pwd, self::$db_db, self::$db_port);
				#echo "<br>public function connReturn()-->".self::$db_host.", ".self::$db_un.", ".self::$db_pwd.", ".self::$db_db.", ".self::$db_port."<br>";
			}else{
				$mysqli = new mysqli(self::$db_host, self::$db_un, self::$db_pwd, self::$db_db);
				#echo "<br>public function connReturn()-->".self::$db_host.", ".self::$db_un.", ".self::$db_pwd.", ".self::$db_db."<br>";
			}		
			
			if ($mysqli->connect_errno) {
				throw new Exception('CRNRSTN mysqli connection error :: failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].').');
			}
			
			return $mysqli;
			
		} catch( Exception $e ) {
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLOGGER->captureNotice(LOG_ERR, $e->getMessage());
			
			//
			// RETURN NOTHING
			return false;
		}
	}

	public function __destruct() {
		
	}
}


class mysqli_connection_manager {
	private static $db_env = array();
	private static $db_host = array();			// = $host;
	private static $db_un = array();			// = $un;
	private static $db_pwd = array();			// = $pwd;
	private static $db_db = array();			// = $dbname;	
	private static $db_port = array();			// = $port;
	
	private static $cache_db_host;				// = $host;
	private static $cache_db_un;				// = $un;
	private static $cache_db_pwd;				// = $pwd;
	private static $cache_db_db;				// = $dbname;	
	private static $cache_db_port;				// = $port;
	
	public $mysqli;
	
	private static $appEnvKey;
	
	private static $oLOGGER;
	
	public function __construct() {
		// 
		// INSTANTIATE LOGGER
		self::$oLOGGER = new logging('__construct class mysqli_connection_manager ::');
	}

	public function addConnection($env, $host, $un, $pwd, $db, $port=NULL){
		//
		// STORE CONNECTION CONFIG PARAMETERS IN MULTI-DIMENSIONAL ARRAY
		self::$db_env[$env][$host][$db][$un] 		= $env;		
		self::$db_host[$env][$host][$db][$un] 		= $host;
		self::$db_un[$env][$host][$db][$un] 		= $un;
		self::$db_pwd[$env][$host][$db][$un] 		= $pwd;
		self::$db_db[$env][$host][$db][$un] 		= $db;		
		self::$db_port[$env][$host][$db][$un] 		= $port;
	}
	
	private function prepDatabaseConfig($host=NULL, $db=NULL, $un=NULL, $port=NULL, $pwd=NULL){
		//
		// XXXXX->returnConnection();
		if($host==NULL){
			//
			// IF NO PARAMS OR CACHE, LOCALLY CACHE FIRST SOLUTION FROM *MULTI-DEM ARRAY
			// *CRNRSTN ENVIRONMENTAL DETECTION + VALUES FROM THE CONFIGURATION FILE		
			if(!isset(self::$cache_db_host)){
				foreach (self::$db_host[self::$appEnvKey] as $tmp_db_host=>$tmp_host_array) {
					#echo "<br>---temp_db_host----->>".$tmp_db_host;
					foreach($tmp_host_array as $tmp_db_db=>$tmp_db_array){
						#echo "---temp_db_db----->>".$tmp_db_db;
						foreach($tmp_db_array as $tmp_un=>$oMYSQLI){
							#echo "---tmp_un----->>".$tmp_un;
							//
							// IF NO VALUES AND NO CACHE...REFRESH THE MANAGER OBJECTS' LOCAL CACHE WITH FIRST MATCH
							self::$cache_db_host = self::$db_host[self::$appEnvKey][$tmp_db_host][$tmp_db_db][$tmp_un];
							self::$cache_db_db = self::$db_db[self::$appEnvKey][$tmp_db_host][$tmp_db_db][$tmp_un];		
							self::$cache_db_un = self::$db_un[self::$appEnvKey][$tmp_db_host][$tmp_db_db][$tmp_un];
							self::$cache_db_pwd = self::$db_pwd[self::$appEnvKey][$tmp_db_host][$tmp_db_db][$tmp_un];
							self::$cache_db_port = self::$db_port[self::$appEnvKey][$tmp_db_host][$tmp_db_db][$tmp_un];
							
							return true;
						}
					}
				}
				
			}else{
				//
				// IF NO VALUES PASSED, BUT CACHE HAS BEEN SET...USE CACHE.
				return true;
			}
			
		}else{
			//
			// XXXXX->returnConnection('host');
			if($db==NULL){
				if(!isset(self::$cache_db_db)){
					foreach (self::$db_host[self::$appEnvKey] as $tmp_db_host=>$tmp_host_array) {
						#echo "<br>---temp_db_host----->>".$tmp_db_host;
						if($tmp_db_host==$host){
							foreach($tmp_host_array as $tmp_db_db=>$tmp_db_array){
								#echo "---temp_db_db----->>".$tmp_db_db;
								foreach($tmp_db_array as $tmp_un=>$oMYSQLI){
									#echo "---tmp_un----->>".$tmp_un;
									//
									// IF NO VALUES AND NO CACHE...REFRESH THE MANAGER OBJECTS' LOCAL CACHE WITH FIRST MATCH
									self::$cache_db_host = self::$db_host[self::$appEnvKey][$tmp_db_host][$tmp_db_db][$tmp_un];
									self::$cache_db_db = self::$db_db[self::$appEnvKey][$tmp_db_host][$tmp_db_db][$tmp_un];		
									self::$cache_db_un = self::$db_un[self::$appEnvKey][$tmp_db_host][$tmp_db_db][$tmp_un];
									self::$cache_db_pwd = self::$db_pwd[self::$appEnvKey][$tmp_db_host][$tmp_db_db][$tmp_un];
									self::$cache_db_port = self::$db_port[self::$appEnvKey][$tmp_db_host][$tmp_db_db][$tmp_un];
									
									return true;
								}
							}
						}
					}
				}else{
					//
					// HOST PASSED. LOCAL OBJECT CACHE HAS ALREADY BEEN SET. USE CACHE.
					return true;
				}
				
			}else{
				if($un==NULL){
					//
					// XXXXX->returnConnection('host', 'database');
					if(!isset(self::$cache_db_un)){
						foreach (self::$db_host[self::$appEnvKey] as $tmp_db_host=>$tmp_host_array) {
							#echo "<br>---temp_db_host----->>".$tmp_db_host;
							if($tmp_db_host==$host){
								foreach($tmp_host_array as $tmp_db_db=>$tmp_db_array){
									#echo "---temp_db_db----->>".$tmp_db_db;
									if($tmp_db_db==$db){
										foreach($tmp_db_array as $tmp_un=>$oMYSQLI){
											#echo "---tmp_un----->>".$tmp_un;
											//
											// IF NO VALUES AND NO CACHE...REFRESH THE MANAGER OBJECTS' LOCAL CACHE WITH FIRST MATCH
											self::$cache_db_host = self::$db_host[self::$appEnvKey][$tmp_db_host][$tmp_db_db][$tmp_un];
											self::$cache_db_db = self::$db_db[self::$appEnvKey][$tmp_db_host][$tmp_db_db][$tmp_un];		
											self::$cache_db_un = self::$db_un[self::$appEnvKey][$tmp_db_host][$tmp_db_db][$tmp_un];
											self::$cache_db_pwd = self::$db_pwd[self::$appEnvKey][$tmp_db_host][$tmp_db_db][$tmp_un];
											self::$cache_db_port = self::$db_port[self::$appEnvKey][$tmp_db_host][$tmp_db_db][$tmp_un];
											
											return true;
										}
									}
								}
							}
						}
					}else{
						//
						// USE LOCAL OBJECT CACHE...SINCE IT HAS ALREADY BEEN SET
						return true;
					}
					
					
				}else{
					if($port==NULL && $pwd==NULL){
						//
						// CRNRSTN ENVIRONMENTAL DETECTION + METHOD PARAMETERS + VALUES FROM THE CONFIGURATION FILE
						// XXXXX->returnConnection('host', 'database', 'user');
						if(!isset(self::$cache_db_pw) || $un!=self::$cache_db_un){
							foreach (self::$db_host[self::$appEnvKey] as $tmp_db_host=>$tmp_host_array) {
								#echo "<br>---temp_db_host----->>".$tmp_db_host;
								if($tmp_db_host==$host){
									foreach($tmp_host_array as $tmp_db_db=>$tmp_db_array){
										#echo "---temp_db_db----->>".$tmp_db_db;
										if($tmp_db_db==$db){
											foreach($tmp_db_array as $tmp_un=>$oMYSQLI){
												#echo "---tmp_un----->>".$tmp_un;
												if($tmp_un==$un){
													//
													// IF NO VALUES AND NO CACHE...REFRESH THE MANAGER OBJECTS' LOCAL CACHE WITH FIRST MATCH
													self::$cache_db_host = self::$db_host[self::$appEnvKey][$tmp_db_host][$tmp_db_db][$tmp_un];
													self::$cache_db_db = self::$db_db[self::$appEnvKey][$tmp_db_host][$tmp_db_db][$tmp_un];		
													self::$cache_db_un = self::$db_un[self::$appEnvKey][$tmp_db_host][$tmp_db_db][$tmp_un];
													self::$cache_db_pwd = self::$db_pwd[self::$appEnvKey][$tmp_db_host][$tmp_db_db][$tmp_un];
													self::$cache_db_port = self::$db_port[self::$appEnvKey][$tmp_db_host][$tmp_db_db][$tmp_un];
													
													return true;
												}
											}
										}
									}
								}
							}
						}else{
							//
							// USE LOCAL OBJECT CACHE...SINCE IT HAS ALREADY BEEN SET
							return true;
						}						
						
					}else{
						if($pwd==NULL && $port!=NULL){
							//
							// CRNRSTN ENVIRONMENTAL DETECTION + METHOD PARAMETERS + VALUES FROM THE CONFIGURATION FILE
							// XXXXX->returnConnection('host', 'database', 'user', 'port');
							if(!isset(self::$cache_db_pwd)){
								foreach (self::$db_host[self::$appEnvKey] as $tmp_db_host=>$tmp_host_array) {
									#echo "<br>---temp_db_host----->>".$tmp_db_host;
									if($tmp_db_host==$host){
										foreach($tmp_host_array as $tmp_db_db=>$tmp_db_array){
											#echo "---temp_db_db----->>".$tmp_db_db;
											if($tmp_db_db==$db){
												foreach($tmp_db_array as $tmp_un=>$oMYSQLI){
													#echo "---tmp_un----->>".$tmp_un;
													if($tmp_un==$un){
														//
														// IF NO VALUES AND NO CACHE...REFRESH THE MANAGER OBJECTS' LOCAL CACHE WITH FIRST MATCH
														self::$cache_db_host = self::$db_host[self::$appEnvKey][$tmp_db_host][$tmp_db_db][$tmp_un];
														self::$cache_db_db = self::$db_db[self::$appEnvKey][$tmp_db_host][$tmp_db_db][$tmp_un];		
														self::$cache_db_un = self::$db_un[self::$appEnvKey][$tmp_db_host][$tmp_db_db][$tmp_un];
														self::$cache_db_pwd = self::$db_pwd[self::$appEnvKey][$tmp_db_host][$tmp_db_db][$tmp_un];
														#self::$cache_db_port = self::$db_port[self::$appEnvKey][$tmp_db_host][$tmp_db_db][$tmp_un];
														self::$cache_db_port = (int) $port;
														
														//
														// LOG NOTICE IF PORT FROM PARAMETER DIFFERS FROM CONFIG FILE. USE VALUE FROM PARAMETER
														if($port!=self::$db_port[self::$appEnvKey][$tmp_db_host][$tmp_db_db][$tmp_un]){
															self::$oLOGGER->captureNotice(LOG_NOTICE, 'Database port from crnrstn configuration file differs from the programmatically provided value of ('.$port.').');
														}
														
														return true;
													}
												}
											}
										}
									}
								}
							}else{
								//
								// USE LOCAL OBJECT CACHE...SINCE IT HAS ALREADY BEEN SET
								return true;
							}								
							
						}else{
							//
							// XXXXX->returnConnection('host', 'database', 'user', 'port', 'pwd');
							self::$cache_db_host = $host;
							self::$cache_db_db = $db;		
							self::$cache_db_un = $un;
							self::$cache_db_pwd = $pwd;
							self::$cache_db_port = (int) $port;

							return true;
						}				
					}
				}
			}
		}
	}
	
	public function returnConnection($host=NULL, $db=NULL, $un=NULL, $port=NULL, $pwd=NULL){
		#$mysqli = $oENV::$oMYSQLI_CONN_MGR->returnConnection('host', 'database', 'user', 'port', 'password');
		#$mysqli = $oENV::$oMYSQLI_CONN_MGR->returnConnection('host', 'database', 'user', 'port');
		#$mysqli = $oENV::$oMYSQLI_CONN_MGR->returnConnection('host', 'database', 'user');
		#$mysqli = $oENV::$oMYSQLI_CONN_MGR->returnConnection('host', 'database');
		#$mysqli = $oENV::$oMYSQLI_CONN_MGR->returnConnection('host');
		#$mysqli = $oENV::$oMYSQLI_CONN_MGR->returnConnection();
		
		//
		// ESTABLISH DATABASE CONNECTIVITY PARAMETERS
		try{
			if($this->prepDatabaseConfig($host, $db, $un, $port, $pwd)){
				//
				// INSTANTIATE MYSQLI CONNECTION CLASS
				$oMYSQLI = new mysqli_conn(self::$cache_db_host, self::$cache_db_un, self::$cache_db_pwd, self::$cache_db_db, self::$cache_db_port);
			
				//
				// ESTABLISH A CONNECTION AND RETURN CONNECTION HANDLE
				$mysqli = $oMYSQLI->connReturn();
				
				return $mysqli;
			}else{
				throw new Exception('CRNRSTN mysqli connection manager error :: failed to prepDatabaseConfig() for MySQL on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].').');
			}
			
		} catch( Exception $e ) {
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLOGGER->captureNotice(LOG_ERR, $e->getMessage());
			
			//
			// RETURN NOTHING
			return false;
		}
	}
		
	public function setEnvironment($env){
		//
		// SET ENVIRONMENT FOR DATABASE CONNECTION MANAGEMENT
		self::$appEnvKey = $env;
	}

	public function __destruct() {
		
	}
}




?>