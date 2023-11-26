<?php
#
# [INSERT HEADER FROM MOST RECENT DEVELOPMENT ON MAC BOOK PRO ONCE YOU GET THE DATA FROM THAT HARD DRIVE.]
#

class mysqli_conn {
	private static $db_host;					// = $host;
	private static $db_dbname;					// = $dbname;
	private static $db_un;						// = $un;
	public static $db_pwd;						// = $pwd;
	private static $db_port;					// = $port;
	private static $db_tblprefix;				// = $tblprefix;
	
	private static $mysqli;
	
	private static $oLOGGER;

	public function __construct($host, $un, $pwd, $db, $port, $tblprefix) {
		//
		// INSTANTIATE LOGGER
		self::$oLOGGER = new logging('__construct class mysqli_conn ::');
		
		self::$db_host = $host;
		self::$db_dbname = $db;
		self::$db_un = $un;
		self::$db_pwd = $pwd;
		self::$db_port = $port;
		self::$db_tblprefix = $tblprefix;
	}
	
	public function connReturn(){
		//
		// ESTABLISH AND RETURN MYSQLI CONNECTION
		try{
			if(self::$db_port!=''){
				$mysqli = new mysqli(self::$db_host, self::$db_un, self::$db_pwd, self::$db_dbname, self::$db_port);
				echo self::$db_host.", ".self::$db_un.", ".self::$db_pwd.", ".self::$db_dbname.", ".self::$db_port;
			}else{
				$mysqli = new mysqli(self::$db_host, self::$db_un, self::$db_pwd, self::$db_dbname);
				echo self::$db_host.", ".self::$db_un.", ".self::$db_pwd.", ".self::$db_dbname;
			}		
			
			if ($mysqli->connect_errno) {
				throw new Exception('CRNRSTN mysqli connection error :: failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].').');
			}	
			
			return $mysqli;
			
		} catch( Exception $e ) {
			//
			// SEND THIS THROUGH THE LOGGER OBJECT...THAT IS STILL TBD
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
	private static $oDBNAME_ARRAY = array();
	private static $oHOST_ARRAY = array();
	private static $resourceKey;
	
	#private static $oMYSQLI;
	public static $oMYSQLI_ARRAY = array();
	
	public function __construct($env, $oCRNRSTN) {
		//
		// BASED ON DETECTED ENVIRONMENT, IF DB INFO AVAILABLE...INITIALIZE DATABASE CONNECTIVITY ARRAY		
		foreach ($oCRNRSTN::$oMYSQLI_CONN_MGR_ARRAY as $dbenv=>$oHOST_ARRAY) {
			if($env==$dbenv){
				foreach($oHOST_ARRAY as $host=>$oDBNAME_ARRAY){
					foreach($oDBNAME_ARRAY as $dbname=>$oMYSQLI){
						//
						// STORE ALL DB CONNECTION OBJECT INSTANTIATIONS FOR THE DETECTED ENVIRONMENT TO AN OBJECT ARRAY
						self::$oMYSQLI_ARRAY[$host][$dbname] = $oMYSQLI;
						echo $oMYSQLI::$db_pwd."----<br>";
					}
				}
			}
		}
	}

	public function __destruct() {
		
	}
}




?>