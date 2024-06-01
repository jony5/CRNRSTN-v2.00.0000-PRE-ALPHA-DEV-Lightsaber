<?php
/*
// J5
// Code is Poetry */
#  CRNRSTN Suite :: An Open Source PHP Class Library to facilitate the operation of an application across multiple hosting environments.
#  Copyright (C) 2012-2018 eVifweb Development
#  VERSION :: 1.0.1
#  RELEASE DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#  AUTHOR :: Jonathan 'J5' Harris, Lead Full Stack Developer
#  URI :: https://crnrstn.jony5.com/
#  OVERVIEW :: CRNRSTN is an open source PHP class library that facilitates the operation of an application within multiple server 
#		environments (e.g. localhost, stage, preprod, and production). With this tool, data and functionality with 
#		characteristics that inherently create distinctions from one environment to the next...such as IP address restrictions, 
#		error logging profiles, and database authentication credentials...can all be managed through one framework for an entire 
#		application. Once CRNRSTN has been configured for your different hosting environments, seamlessly release a web 
#		application from one environment to the next without having to change your code-base to account for environmentally 
#		specific parameters; and manage this all from one place within the CRNRSTN Suite ::
#
#  MIT LICENSE :: Copyright 2018 Jonathan J5 Harris
#		Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated 
#		documentation files (the "Software"), to deal in the Software without restriction, including without limitation the 
#		rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to 
#		permit persons to whom the Software is furnished to do so, subject to the following conditions:
#
#		The above copyright notice and this permission notice shall be included in all copies or substantial portions 
#		of the Software.
#
#		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE 
#		WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS 
#		OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT 
#		OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
#
/*
// CLASS :: crnrstn_mysqli_conn
// AUTHOR :: Jonathan 'J5' Harris <jharris@evifweb.com>
// VERSION :: 1.0.1
*/
class crnrstn_mysqli_conn {
	private static $db_host;				// = $host;
	private static $db_db;					// = $dbname;
	private static $db_un;					// = $un;
	private static $db_pwd;					// = $pwd;
	private static $db_port;				// = $port;
	private static $mysqli;
	
	public static $queryResult_ARRAY = array();
	public $oSESSION_MGR;
	public $result;
	
	private static $oLogger;

	public function __construct($host, $un, $pwd, $db, $port=NULL) {
		
		// 
		// INSTANTIATE LOGGER
		self::$oLogger = new crnrstn_logging();
		
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
				self::$mysqli = new mysqli(self::$db_host, self::$db_un, self::$db_pwd, self::$db_db, self::$db_port);
			}else{
				self::$mysqli = new mysqli(self::$db_host, self::$db_un, self::$db_pwd, self::$db_db);
			}
			
			if (self::$mysqli->connect_error) {
				
				//
				// HOOOSTON...VE HAF PROBLEM!
				throw new Exception('CRNRSTN mysqli connection error :: failed to connect to MySQL: (' . self::$mysqli->connect_errno . ') ' . self::$mysqli->connect_error.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].').');
			}
			
			
			return self::$mysqli;
			
		} catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('mysqli_conn->connReturn()', LOG_ERR, $e->getMessage());
			
			//
			// RETURN FALSE
			return false;
		}
	}

	public function __destruct() {
		
	}
}


/*
// CLASS :: crnrstn_mysqli_conn_manager
// AUTHOR :: Jonathan 'J5' Harris <jharris@evifweb.com>
// VERSION :: 1.0.1
*/
class crnrstn_mysqli_conn_manager {
	
	public $crnrstnConfigSerial;
	
	private static $db_env = array();
	private static $db_host = array();			// = $host;
	private static $db_un = array();			// = $un;
	private static $db_pwd = array();			// = $pwd;
	private static $db_db = array();			// = $dbname;	
	private static $db_port = array();			// = $port;
	
	private static $cache_db_pwd;				// = $pwd;
	private static $cache_db_port;				// = $port;
	
	private static $mysqli;
	
	private static $appEnvKey;
	
	private static $oLogger;
	public $oSESSION_MGR;
		
	public function __construct($configSerial) {
		
		// 
		// INSTANTIATE LOGGER
		self::$oLogger = new crnrstn_logging();
		
		$this->crnrstnConfigSerial = $configSerial;
		
		$this->oSESSION_MGR = new crnrstn_session_manager();
	}

	public function addConnection($env, $host, $un, $pwd, $db, $port=NULL){
		
		//
		// STORE CONNECTION CONFIG PARAMETERS IN MULTI-DIMENSIONAL ARRAY
		self::$db_env[crc32($this->crnrstnConfigSerial)][crc32($env)][crc32($host)][crc32($db)][crc32($un)] 		= $env;		
		self::$db_host[crc32($this->crnrstnConfigSerial)][crc32($env)][crc32($host)][crc32($db)][crc32($un)] 		= $host;
		self::$db_un[crc32($this->crnrstnConfigSerial)][crc32($env)][crc32($host)][crc32($db)][crc32($un)] 			= $un;
		self::$db_pwd[crc32($this->crnrstnConfigSerial)][crc32($env)][crc32($host)][crc32($db)][crc32($un)] 		= $pwd;
		self::$db_db[crc32($this->crnrstnConfigSerial)][crc32($env)][crc32($host)][crc32($db)][crc32($un)] 			= $db;		
		self::$db_port[crc32($this->crnrstnConfigSerial)][crc32($env)][crc32($host)][crc32($db)][crc32($un)] 		= $port;
	}
	
	private function prepDatabaseConfig($host=NULL, $db=NULL, $un=NULL, $port=NULL, $pwd=NULL){
		
		//
		// IF HASHED INPUT PARAMETERS MATCH WHAT HAS BEEN STORED IN SESSION, PREPARATION IS COMPLETE.
		if($this->oSESSION_MGR->getSessionParam('_CRNRSTN_DB_CNFG') == md5($host.'::'.$db.'::'.$un.'::'.$port.'::'.$pwd)){
			return true;
		}
		
		//
		// $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection();
		if($host==NULL){

			//
			// IF NO PARAMS OR CACHE, LOCALLY CACHE FIRST SOLUTION FROM *MULTI-DEM ARRAY
			// *CRNRSTN ENVIRONMENTAL DETECTION + VALUES FROM THE CONFIGURATION FILE		
			if(!($this->oSESSION_MGR->issetSessionParam('_CRNRSTN_DB_HOST'))){
				
				if(isset(self::$db_host[crc32($this->crnrstnConfigSerial)])){
					foreach (self::$db_host[crc32($this->crnrstnConfigSerial)][self::$appEnvKey] as $tmp_db_host=>$tmp_host_array) {
						foreach($tmp_host_array as $tmp_db_db=>$tmp_db_array){
							foreach($tmp_db_array as $tmp_un=>$oMYSQLI){
	
								//
								// INITIALIZE/REFRESH SESSION PARAMETERS
								$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_ENV', self::$appEnvKey);
								$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_HOST', $tmp_db_host);
								$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_DB', $tmp_db_db);
								$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_UN', $tmp_un);
								
								//
								// INITIALIZE/REFRESH OPTIMIZATION HASH (IN SESSION) TO STREAMLINE PREPARATION OF DATABASE CONNECTION
								$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_CNFG', md5($host.'::'.$db.'::'.$un.'::'.$port.'::'.$pwd));
								
								return true;
							}
						}
					}
				}else{
					return false;
				}	
				
			}else{
				
				//
				// INITIALIZE/REFRESH OPTIMIZATION HASH (IN SESSION) TO STREAMLINE PREPARATION OF DATABASE CONNECTION
				$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_CNFG', md5($host.'::'.$db.'::'.$un.'::'.$port.'::'.$pwd));
							
				//
				// IF NO VALUES PASSED, BUT CACHE HAS BEEN SET...USE CACHE.
				return true;
			}
			
		}else{
			
			//
			//  $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection('host');
			if($db==NULL){
				if(!($this->oSESSION_MGR->issetSessionParam('_CRNRSTN_DB_DB'))){
					foreach (self::$db_host[self::$appEnvKey] as $tmp_db_host=>$tmp_host_array) {
						if($tmp_db_host==crc32($host)){
							foreach($tmp_host_array as $tmp_db_db=>$tmp_db_array){
								foreach($tmp_db_array as $tmp_un=>$oMYSQLI){
							
									//
									// INITIALIZE/REFRESH SESSION PARAMETERS
									$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_ENV', self::$appEnvKey);
									$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_HOST', $tmp_db_host);
									$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_DB', $tmp_db_db);
									$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_UN', $tmp_un);
							
									//
									// INITIALIZE/REFRESH OPTIMIZATION HASH (IN SESSION) TO STREAMLINE PREPARATION OF DATABASE CONNECTION
									$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_CNFG', md5($host.'::'.$db.'::'.$un.'::'.$port.'::'.$pwd));
							
									return true;
								}
							}
						}
					}
				}else{
					
					//
					// CHECK FOR CHANGES FROM SESSION IN HOST::DB
					if($this->oSESSION_MGR->getSessionParam('_CRNRSTN_DB_HOST')==crc32($host)){
						
						//
						// INITIALIZE/REFRESH OPTIMIZATION HASH (IN SESSION) TO STREAMLINE PREPARATION OF DATABASE CONNECTION
						$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_CNFG', md5($host.'::'.$db.'::'.$un.'::'.$port.'::'.$pwd));

						//
						// USE LOCAL OBJECT CACHE...SINCE IT HAS ALREADY BEEN SET
						return true;
						
					}else{
						
						//
						// SOMETHING CHANGED. SESSION NO LONGER MATCHES returnConnection() INPUT PARAMS.
						return false;
					}					
				}
				
			}else{
				
				if($un==NULL){
					
					//
					//  $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection('host', 'database');
					if(!($this->oSESSION_MGR->issetSessionParam('_CRNRSTN_DB_UN'))){
						foreach (self::$db_host[self::$appEnvKey] as $tmp_db_host=>$tmp_host_array) {
							if($tmp_db_host==crc32($host)){
								foreach($tmp_host_array as $tmp_db_db=>$tmp_db_array){
									if($tmp_db_db==crc32($db)){
										foreach($tmp_db_array as $tmp_un=>$oMYSQLI){
											
											//	
											// INITIALIZE/REFRESH SESSION PARAMETERS
											$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_ENV', self::$appEnvKey);
											$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_HOST', $tmp_db_host);
											$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_DB', $tmp_db_db);
											$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_UN', $tmp_un);
											
											//
											// INITIALIZE/REFRESH OPTIMIZATION HASH (IN SESSION) TO STREAMLINE PREPARATION OF DATABASE CONNECTION
											$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_CNFG', md5($host.'::'.$db.'::'.$un.'::'.$port.'::'.$pwd));						
				
											return true;
										}
									}
								}
							}
						}
					}else{
						
						//
						// CHECK FOR CHANGES FROM SESSION IN HOST::DB
						if($this->oSESSION_MGR->getSessionParam('_CRNRSTN_DB_HOST')==crc32($host) && $this->oSESSION_MGR->getSessionParam('_CRNRSTN_DB_DB')==crc32($db)){
							
							//
							// INITIALIZE/REFRESH OPTIMIZATION HASH (IN SESSION) TO STREAMLINE PREPARATION OF DATABASE CONNECTION
							$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_CNFG', md5($host.'::'.$db.'::'.$un.'::'.$port.'::'.$pwd));

							//
							// USE LOCAL OBJECT CACHE...SINCE IT HAS ALREADY BEEN SET
							return true;
							
						}else{
							
							//
							// SOMETHING CHANGED. SESSION NO LONGER MATCHES returnConnection() INPUT PARAMS.
							return false;
						}
					}
					
				}else{
					if($port==NULL && $pwd==NULL){
						
						//
						//  $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection('host', 'database', 'user');
						if(crc32($un)!=$this->oSESSION_MGR->getSessionParam('_CRNRSTN_DB_UN')){
							foreach (self::$db_host[self::$appEnvKey] as $tmp_db_host=>$tmp_host_array) {
								if($tmp_db_host==crc32($host)){
									foreach($tmp_host_array as $tmp_db_db=>$tmp_db_array){
										if($tmp_db_db==crc32($db)){
											foreach($tmp_db_array as $tmp_un=>$oMYSQLI){
												if($tmp_un==crc32($un)){
												
													//
													// INITIALIZE/REFRESH SESSION PARAMETERS
													$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_ENV', self::$appEnvKey);
													$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_HOST', $tmp_db_host);
													$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_DB', $tmp_db_db);
													$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_UN', $tmp_un);
												
													//
													// INITIALIZE/REFRESH OPTIMIZATION HASH (IN SESSION) TO STREAMLINE PREPARATION OF DATABASE CONNECTION
													$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_CNFG', md5($host.'::'.$db.'::'.$un.'::'.$port.'::'.$pwd));
													
													return true;
												}
											}
										}
									}
								}
							}
						}else{
							
							//
							// CHECK FOR CHANGES FROM SESSION IN HOST::DB
							if($this->oSESSION_MGR->getSessionParam('_CRNRSTN_DB_HOST')==crc32($host) && $this->oSESSION_MGR->getSessionParam('_CRNRSTN_DB_DB')==crc32($db)){
								
								//
								// INITIALIZE/REFRESH OPTIMIZATION HASH (IN SESSION) TO STREAMLINE PREPARATION OF DATABASE CONNECTION
								$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_CNFG', md5($host.'::'.$db.'::'.$un.'::'.$port.'::'.$pwd));
	
								//
								// USE LOCAL OBJECT CACHE...SINCE IT HAS ALREADY BEEN SET
								return true;
								
							}else{
								
								//
								// SOMETHING CHANGED. SESSION NO LONGER MATCHES returnConnection() INPUT PARAMS.
								return false;
							}
						}						
						
					}else{
						if($pwd==NULL && $port!=NULL){
							
							//
							// CRNRSTN ENVIRONMENTAL DETECTION + METHOD PARAMETERS + VALUES FROM THE CONFIGURATION FILE
							// $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection('host', 'database', 'user', 'port');
							if(crc32($un)!=$this->oSESSION_MGR->getSessionParam('_CRNRSTN_DB_UN')){
								foreach (self::$db_host[self::$appEnvKey] as $tmp_db_host=>$tmp_host_array) {
									if($tmp_db_host==crc32($host)){
										foreach($tmp_host_array as $tmp_db_db=>$tmp_db_array){
											if($tmp_db_db==crc32($db)){
												foreach($tmp_db_array as $tmp_un=>$oMYSQLI){
													if($tmp_un==crc32($un)){
														
														//
														// INITIALIZE/REFRESH SESSION PARAMETERS
														$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_ENV', self::$appEnvKey);
														$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_HOST', $tmp_db_host);
														$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_DB', $tmp_db_db);
														$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_UN', $tmp_un);
														
														//
														// LOG NOTICE IF PORT FROM PARAMETER DIFFERS FROM CONFIG FILE. USE VALUE FROM PARAMETER
														if($port!=self::$db_port[self::$appEnvKey][$tmp_db_host][$tmp_db_db][$tmp_un]){
															self::$oLogger->captureNotice('mysqli_conn_manager->prepDatabaseConfig()', LOG_NOTICE, 'Database port from crnrstn configuration file differs from the programmatically provided value of ('.$port.').');
														}
														
														//
														// INITIALIZE/REFRESH OPTIMIZATION HASH (IN SESSION) TO STREAMLINE PREPARATION OF DATABASE CONNECTION
														$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_CNFG', md5($host.'::'.$db.'::'.$un.'::'.$port.'::'.$pwd));
							
														return true;
													}
												}
											}
										}
									}
								}
							}else{
								
								//
								// INITIALIZE/REFRESH OPTIMIZATION HASH (IN SESSION) TO STREAMLINE PREPARATION OF DATABASE CONNECTION
								$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_CNFG', md5($host.'::'.$db.'::'.$un.'::'.$port.'::'.$pwd));
								
								//
								// USE LOCAL OBJECT CACHE...SINCE IT HAS ALREADY BEEN SET
								return true;
							}								
							
						}else{
							
							//
							// $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection('host', 'database', 'user', 'port', 'pwd');
							$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_ENV', self::$appEnvKey);
							$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_HOST', crc32($host));
							$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_DB', crc32($db));
							$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_UN', crc32($un));
							
							self::$db_host[self::$appEnvKey][crc32($host)][crc32($db)][crc32($un)] = $host;
							self::$db_un[self::$appEnvKey][crc32($host)][crc32($db)][crc32($un)] = $un;
							self::$db_db[self::$appEnvKey][crc32($host)][crc32($db)][crc32($un)] = $db;
							
							//
							// INITIALIZE/REFRESH OPTIMIZATION HASH (IN SESSION) TO STREAMLINE PREPARATION OF DATABASE CONNECTION
							$this->oSESSION_MGR->setSessionParam('_CRNRSTN_DB_CNFG', md5($host.'::'.$db.'::'.$un.'::'.$port.'::'.$pwd));

							return true;
						}				
					}
				}
			}
		}
		
		return false;
	}
	
	public function closeConnection($mysqli){
		if($mysqli){
			return $mysqli->close();
		}else{
			return false;	
		}
	}
	
	public function returnConnection($host=NULL, $db=NULL, $un=NULL, $port=NULL, $pwd=NULL){
		#$mysqli = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection('host', 'database', 'user', 'port', 'password');
		#$mysqli = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection('host', 'database', 'user', 'port');
		#$mysqli = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection('host', 'database', 'user');
		#$mysqli = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection('host', 'database');
		#$mysqli = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection('host');
		#$mysqli = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection();
		
		//
		// ESTABLISH DATABASE CONNECTIVITY PARAMETERS
		try{
			if($this->prepDatabaseConfig($host, $db, $un, $port, $pwd)){
				if($port!=''){
					self::$cache_db_port = (int) $port;
				}else{
					self::$cache_db_port = self::$db_port[crc32($this->crnrstnConfigSerial)][$this->oSESSION_MGR->getSessionParam('_CRNRSTN_DB_ENV')][$this->oSESSION_MGR->getSessionParam('_CRNRSTN_DB_HOST')][$this->oSESSION_MGR->getSessionParam('_CRNRSTN_DB_DB')][$this->oSESSION_MGR->getSessionParam('_CRNRSTN_DB_UN')];
				}
				
				if($pwd!=''){
					self::$cache_db_pwd = $pwd;
				}else{
					self::$cache_db_pwd = self::$db_pwd[crc32($this->crnrstnConfigSerial)][$this->oSESSION_MGR->getSessionParam('_CRNRSTN_DB_ENV')][$this->oSESSION_MGR->getSessionParam('_CRNRSTN_DB_HOST')][$this->oSESSION_MGR->getSessionParam('_CRNRSTN_DB_DB')][$this->oSESSION_MGR->getSessionParam('_CRNRSTN_DB_UN')];
				}

				//
				// INSTANTIATE MYSQLI CONNECTION CLASS
				$oMYSQLI = new crnrstn_mysqli_conn(self::$db_host[crc32($this->crnrstnConfigSerial)][$this->oSESSION_MGR->getSessionParam('_CRNRSTN_DB_ENV')][$this->oSESSION_MGR->getSessionParam('_CRNRSTN_DB_HOST')][$this->oSESSION_MGR->getSessionParam('_CRNRSTN_DB_DB')][$this->oSESSION_MGR->getSessionParam('_CRNRSTN_DB_UN')],
											self::$db_un[crc32($this->crnrstnConfigSerial)][$this->oSESSION_MGR->getSessionParam('_CRNRSTN_DB_ENV')][$this->oSESSION_MGR->getSessionParam('_CRNRSTN_DB_HOST')][$this->oSESSION_MGR->getSessionParam('_CRNRSTN_DB_DB')][$this->oSESSION_MGR->getSessionParam('_CRNRSTN_DB_UN')],
											self::$cache_db_pwd,
											self::$db_db[crc32($this->crnrstnConfigSerial)][$this->oSESSION_MGR->getSessionParam('_CRNRSTN_DB_ENV')][$this->oSESSION_MGR->getSessionParam('_CRNRSTN_DB_HOST')][$this->oSESSION_MGR->getSessionParam('_CRNRSTN_DB_DB')][$this->oSESSION_MGR->getSessionParam('_CRNRSTN_DB_UN')],
											self::$cache_db_port);
				
				//
				// ESTABLISH A CONNECTION AND RETURN CONNECTION HANDLE
				self::$mysqli = $oMYSQLI->connReturn();
				
				return self::$mysqli;
			}else{
				
				//
				// HOOOSTON...VE HAF PROBLEM!
				throw new Exception('CRNRSTN mysqli connection manager error :: failed to prepDatabaseConfig() for MySQL on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].').');
			}
			
		} catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('mysqli_conn_manager->returnConnection()', LOG_ERR, $e->getMessage());
			
			//
			// RETURN NOTHING
			return false;
		}
	}
	
	public function processQuery($mysqli, $query, $resultMode=NULL){
		try{
			if(isset($resultMode)){
				
				switch($resultMode){
					case MYSQLI_USE_RESULT:
						if($result = $mysqli->query($query, MYSQLI_USE_RESULT)){
							return $result;
						}else{
							
							//
							// HOOOSTON...VE HAF PROBLEM!
							throw new Exception('CRNRSTN mysqli query error :: failed to execute query(). '.$mysqli->error);
						}
					break;
					case MYSQLI_STORE_RESULT:
						if($result = $mysqli->query($query, MYSQLI_STORE_RESULT)){
							return $result;
						}else{
							
							//
							// HOOOSTON...VE HAF PROBLEM!
							throw new Exception('CRNRSTN mysqli query error :: failed to execute query(). '.$mysqli->error);
						}
					break;
					case MYSQLI_ASYNC:
						if($result = $mysqli->query($query, MYSQLI_ASYNC)){
							return $result;
						}else{
							
							//
							// HOOOSTON...VE HAF PROBLEM!
							throw new Exception('CRNRSTN mysqli query error :: failed to execute query(). '.$mysqli->error);
						}
					break;
				}
				
			}else{

				if($result = $mysqli->query($query)){

					return $result;

				}else{
					
					//
					// HOOOSTON...VE HAF PROBLEM!
					throw new Exception('CRNRSTN mysqli query error :: failed to execute query(). '.$mysqli->error);

				}
			}
			
		}catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('mysqli_conn_manager->processQuery()', LOG_ERR, $e->getMessage());
			
			//
			// RETURN NOTHING
			return false;

		}
	}
	
	public function processMultiQuery($mysqli, $query){
		try{
			if($mysqli){
				if ($mysqli->multi_query($query)) {
					
					//
					// JUST RETURN MYSQLI CONNECTION OBJECT TO HAVE RESULT EXTRACTED LATER.
					return $mysqli;
				}else{
					
					//
					// HOOOSTON...VE HAF PROBLEM!
					throw new Exception('Unable to process multi-query. ['.$mysqli->error.']');
				}
			}else{
				throw new Exception('Unable to process multi-query due to provided mysqli object is false.');
			}
			
		} catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('mysqli_conn_manager->processMultiQuery()', LOG_ERR, $e->getMessage());
			
			//
			// RETURN NOTHING
			return $mysqli;
		}
	}
		
	public function setEnvironment($oCRNRSTN_ENV){
		
		//
		// SET ENVIRONMENT FOR DATABASE CONNECTION MANAGEMENT
		self::$appEnvKey = $oCRNRSTN_ENV->oSESSION_MGR->getSessionKey();
	}

	public function __destruct() {
		
	}
}