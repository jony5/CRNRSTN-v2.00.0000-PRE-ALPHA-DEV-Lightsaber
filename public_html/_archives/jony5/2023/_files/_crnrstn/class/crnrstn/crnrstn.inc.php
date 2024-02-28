<?php
/*
// J5
// Code is Poetry */
#  CRNRSTN Suite :: An Open Source PHP Class Library to facilitate the operation of an application across multiple hosting environments.
#  Copyright (C) 2012-2018 eVifweb Development
#  VERSION :: 1.0.1
#  RELEASE DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#  AUTHOR :: Jonathan 'J5' Harris, Lead Full Stack Developer
#  URI :: http://crnrstn.evifweb.com/
#  OVERVIEW :: CRNRSTN is an open source PHP class library that facilitates the operation of an application within multiple server 
#		environments (e.g. localhost, stage, preprod, and production). With this tool, data and functionality with 
#		characteristics that inherently create distinctions from one environment to the next...such as IP address restrictions, 
#		error logging profiles, and database authentication credentials...can all be managed through one framework for an entire 
#		application. Once CRNRSTN has been configured for your different hosting environments, seamlessly release a web 
#		application from one environment to the next without having to change your code-base to account for environmentally 
#		specific parameters; and manage this all from one place within the CRNRSTN Suite ::

#  MIT LICENSE :: Copyright 2018 Jonathan J5 Harris
#		Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated 
#		documentation files (the "Software"), to deal in the Software without restriction, including without limitation the 
#		rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to 
#		permit persons to whom the Software is furnished to do so, subject to the following conditions:

#		The above copyright notice and this permission notice shall be included in all copies or substantial portions 
#		of the Software.

#		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE 
#		WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS 
#		OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT 
#		OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

/*
// CLASS :: crnrstn
// AUTHOR :: Jonathan 'J5' Harris <jharris@evifweb.com>
// VERSION :: 1.0.1
*/
class crnrstn {

	private static $oLogger;
	public static $log_profl_ARRAY = array();
	public static $log_endpt_ARRAY = array();
	
	public $configSerial;
	
	public $opensslSessEncryptCipher = array();
	public $opensslSessEncryptSecretKey = array();
	public $opensslSessEncryptOptions = array();
	public $sessHmac_algorithm = array();
	
	public $opensslCookieEncryptCipher = array();
	public $opensslCookieEncryptSecretKey = array();
	public $opensslCookieEncryptOptions = array();
	public $cookieHmac_algorithm = array();
	
	public $oensslTunnelEncryptCipher = array();
	public $opensslTunnelEncryptSecretKey = array();
	public $opensslTunnelEncryptOptions = array();
	public $tunnelHmac_algorithm = array();
	
	private static $handle_srvr_ARRAY = array();

	private static $env_detect_ARRAY = array();
	public $handle_env_ARRAY = array();
	private static $env_name_ARRAY = array();
	
	public $grant_accessIP_ARRAY = array();
	public $deny_accessIP_ARRAY = array();

	public $oMYSQLI_CONN_MGR;

	private static $database_extension_type_ARRAY = array();

	private static $envDetectRequiredCnt;
	
	public static $handle_resource_ARRAY = array();
	
	private static $serverAppKey = array();
	
	private static $env_select_ARRAY = array();
	
	private static $envMatchCount;
	private static $envChecksum;

	public $debugMode;
	public $starttime;

	public function __construct($serial,$debugMode=0) {

		$this->starttime = $this->microtime_float();

		$this->debugMode = $debugMode;
				
		//
		// INSTANTIATE LOGGER
		self::$oLogger = new crnrstn_logging($this->debugMode);
        self::$oLogger->logDebug("crnrstn (97) SERVER/CRNRSTN start time [".$_SERVER['REQUEST_TIME']."]/[".$this->starttime."]");

        try{
			if(!array_key_exists('SERVER_ADDR', $_SERVER)){
				
				//
				// HOOOSTON...VE HAF PROBLEM!
				// SOURCE :: https://www.wired.com/2011/04/alt-text-spacecraft/
				self::$oLogger->logDebug("crnrstn :: ERROR :: unable to load CRNRSTN. _SERVER[] super global has not been initialized. If calling this program via script, try using cURL (/usr/bin/curl).");
				throw new Exception('CRNRSTN initialization error :: $_SERVER[] super global has not been initialized. If calling this program via script, try using cURL (/usr/bin/curl). SERVER_NAME(SERVER_ADDR)-> '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].').');
			}else{	
				
				//
				// STORE LOCAL COPY OF SUPER GLOBAL ARRAY WITH SERVER DATA TO SUPPORT ENVIRONMENTAL DETECTION. I GUESS I COULD JUST WORK WITH $_SERVER DIRECTLY...IF WE'RE TRYNG TO SHAVE GRAMS. WHAT DO YOU THINK?
				self::$handle_srvr_ARRAY=$_SERVER;
				
				//
				// STORE CONFIG SERIAL KEY AND INITIALIZE MATCH COUNT
				$this->configSerial = $serial;
				
				//
				// IF EARLY ENV DETECTION DURING defineEnvResource() DUE TO SPECIFIED requiredDetectionMatches(), STORE ENV HERE: 
				self::$serverAppKey[crc32($this->configSerial)] = "";

				//
				// INITIALIZE DATABASE CONNECTION MANAGER.
				$this->oMYSQLI_CONN_MGR = new crnrstn_mysqli_conn_manager($this->configSerial);
				self::$oLogger->logDebug("crnrstn :: instantiating mysqli database connection manager object. Ready to configure database authentication profiles.");

				//
				// INITIALIZE IP ADDRESS SECURITY MANAGER
				self::$oLogger->logDebug("crnrstn :: instantiating IP security manager object with client IP of [".self::$handle_srvr_ARRAY['REMOTE_ADDR']."] and phpsessionid[".session_id()."].");
				$this->oCRNRSTN_IPSECURITY_MGR = new crnrstn_ip_auth_manager(self::$handle_srvr_ARRAY['REMOTE_ADDR']);

			}
		} catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('crnrstn->__construct()', LOG_EMERG, $e->getMessage());
		}
		

	}

	public function addEnvironment($key, $errorReporting){
		self::$oLogger->logDebug("crnrstn :: addEnvironment() key [".$key."] converted to checksum [".crc32($key)."] and will be referenced as such from time to time.");
		$this->addServerEnv(crc32($this->configSerial), crc32($key), $errorReporting);
		return true;
	}


	private function addServerEnv($configSerial, $key, $errRptProfl) {
		try{
			if(!isset($this->handle_env_ARRAY[$configSerial][$key])){
				$this->handle_env_ARRAY[$configSerial][$key] = $errRptProfl;
				self::$env_detect_ARRAY[$configSerial][$key] = 0;
				self::$env_name_ARRAY[$configSerial][$key] = $key;
				self::$oLogger->logDebug("crnrstn :: storing environment [".$key."] in memory.");
			}else{
				
				//
				// 	THIS KEY HAS ALREADY BEEN INITIALIZED
				self::$oLogger->logDebug("crnrstn :: ERROR :: there are duplicate environment keys being passed to addEnvironment().");
				throw new Exception('CRNRSTN initialization warning :: This environmental key ('.$key.') has already been initialized.');
			}
		}catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('crnrstn->addServerEnv()', LOG_WARNING, $e->getMessage());
		}
    }
	
	public function initLogging($key, $loggingProfl=NULL, $loggingEndpoint=NULL){
		if($loggingProfl!=''){
			self::$log_profl_ARRAY[crc32($this->configSerial)][crc32($key)] = $loggingProfl;
			self::$log_endpt_ARRAY[crc32($this->configSerial)][crc32($key)] = $loggingEndpoint;
			self::$oLogger->logDebug("crnrstn :: logging profile initialized for [".$key."] to [".$loggingProfl."] and endpoint of [".$loggingEndpoint."]");
		}
		
		return true;

	}
	
	public function grantExclusiveAccess($env, $ipOrFile){
		$this->grant_accessIP_ARRAY[crc32($this->configSerial)][crc32($env)] = $ipOrFile;
		self::$oLogger->logDebug("crnrstn :: storing grantExclusiveAccess IP profile [".$ipOrFile."] in memory for environment key [".$env."].");
		return true;
	}
	
	public function denyAccess($env, $ipOrFile){
		$this->deny_accessIP_ARRAY[crc32($this->configSerial)][crc32($env)] = $ipOrFile;
		self::$oLogger->logDebug("crnrstn :: storing denyAccess IP profile [".$ipOrFile."] in memory for environment key [".$env."].");
		return true;
	}

    public function returnConfigSerial(){

        return $this->configSerial;

    }

    public function returnDbType($type_id=0){

        $databaseExtensionTypes = array(0 => 'MySQLi', 1 => 'MySQL', 2 => 'PostGreSQL', 3 => 'SYBASE', 4 => 'IBM-DB2', 5 => 'Oracle Database');

        if(isset($databaseExtensionTypes[$type_id])){

            return $databaseExtensionTypes[$type_id];
        }else{

            self::$oLogger->logDebug("crnrstn :: ERROR :: returnDbType() is being called with reference to a value(".$type_id.") that is outside permissible range of [0-5].");
            throw new Exception('CRNRSTN initialization warning :: returnDbType() is being called with reference to a value('.$type_id.') that is outside permissible range of [0-5]');

        }

    }

    public function specifyDatabaseExtension($env,$type){

        self::$oLogger->logDebug('crnrstn :: specifyDatabaseExtension() database type ['.$type.'] specified for environment ['.$env.'] on server ['.$_SERVER['SERVER_NAME'].']');
        self::$database_extension_type_ARRAY[crc32($this->configSerial)][crc32($env)] = $type;

    }

    public function addDatabase($env, $host, $un=NULL, $pwd=NULL, $db=NULL, $port=NULL){
		
		//
		// HANDLE PATH TO DATABASE CONFIG FILE (E.G. ONLY 2 PARAMS PROVIDED)
		if($db==NULL){
			if(is_file($host)){
				//
				// EXTRACT DATABASE CONFIGURATION FROM FILE
				self::$oLogger->logDebug("crnrstn :: addDatabase() for environment [".$env."]. including and evaluating file [".$host."].");
				include_once($host);
				
			}else{

				//
				// WE COULD NOT FIND THE DATABASE CONFIGURATION FILE
				#self::$oLogger->captureNotice('crnrstn->addDatabase()', LOG_ERR, 'Could not find/interpret the database config file parameter for an addDatabase() method called in the crnrstn configuration.');
				self::$oLogger->logDebug('crnrstn :: NOTICE :: addDatabase() $host parameter not recognized as a file for environment ['.$env."] on server [".$_SERVER['SERVER_NAME'].'] value-> ['.$host."].");
			}

		}else{
			
			//
			// SEND DATABASE CONFIGURATION PARAMETERS TO THE CONNECTION MANAGER
			#self::$oLogger->logDebug("crnrstn :: addDatabase() for environment [".$env."] sending database authentication profile [db->".$db." | un->".$un." |...etc.] to connection manager.");
			self::$oLogger->logDebug("crnrstn :: addDatabase() for environment [".$env."] sending database authentication profile [db->##### REDACTED ##### | un->##### REDACTED ##### |...etc.] to connection manager.");
			$this->oMYSQLI_CONN_MGR->addConnection($env, $host, $un, $pwd, $db, $port);
		}
		
		return true;
	}
	
	
	public function requiredDetectionMatches($value=''){
		
		//
		// HOW MANY SERVER KEYS ARE REQUIRED TO MATCH IN ORDER TO SUCCESSFULLY 
		// CONFIGURE CRNRSTN TO MATCH WITH ONE ENVIRONMENT
		if($value==''){
			
			//
			// WE WANT THE ENVIRONMENT WITH MOST MATCHES. DELAY ENV DETECTION UNTIL INSTANTIATION OF ENV CLASS OBJECT
			self::$envDetectRequiredCnt = NULL;
			self::$oLogger->logDebug("crnrstn :: requiredDetectionMatches will autodetect environment CRNRSTN profile with strongest correlation to _SERVER params.");
		}else{
			
			//
			// NON-ZERO VALUE HAS BEEN RECIEVED. THE ENV CONFIG THAT MEETS THIS REQUIREMENT FIRST IS USED FOR ENV INITIALIZATION
			self::$envDetectRequiredCnt = $value - 0;
			self::$oLogger->logDebug("crnrstn :: requiredDetectionMatches set to [".self::$envDetectRequiredCnt."] in memory.");
		}
		
		return true;
	}
	
	public function get_log_profl_ARRAY(){
		return self::$log_profl_ARRAY;	
	}
	
	public function get_log_endpt_ARRAY(){
		return self::$log_endpt_ARRAY;	
	}
	
	public function defineEnvResource($env, $key, $value){
		try{
			if($env=="" || $key==""){
				self::$oLogger->logDebug("crnrstn :: ERROR ::  attempt to defineEnvResource() but missing required parameters of env and/or key.");
				throw new Exception('CRNRSTN initialization ERROR :: defineEnvResource was called but was missing paramter information and so was not able to be initialized. envKey and resourceKey are required. envKey['.$env.'] resourceKey['.$key.']');
				
			}else{
				if(self::$serverAppKey[crc32($this->configSerial)]=="" || crc32($env)==self::$serverAppKey[crc32($this->configSerial)] || $env=="*"){
					self::$oLogger->logDebug("crnrstn :: defining resource [".$key."] with value [".$value."] for environment [".$env."] in memory.");
					$this->addEnvResource(crc32($this->configSerial), crc32($env), trim($key), trim($value)); 
				}
			}
		
		}catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('crnrstn->defineEnvResource()', LOG_ERR, $e->getMessage());
		}
		
	}
	
	public function addEnvResource($configSerial, $env, $key, $value) {

		self::$handle_resource_ARRAY[$configSerial][$env][$key] = $value;
		
		//
		// FOR FASTEST DISCOVERY, RUN ENVIRONMENTAL DETECTION IN PARALLEL WITH INITIALIZATION OF RESOURCE DEFINITIONS.
		// THIS MEANS THERE SHOULD/WOULD BE A NON-NULL / NON ZERO INTEGER PASSED TO $oCRNRSTN->requiredDetectionMatches(2) IN THE
		// CRNRSTN CONFIG FILE. OTHERWISE, WE MUST TRAVERSE ALL ENV CONFIG DEFINITIONS AND THEN TAKE BEST FIT PER SERVER SETTINGS.
		if(self::detectServerEnv($configSerial,$env, $key, $value)){
			
			//
			// IF NULL/ZED COUNT, HOLD OFF ON DEFINING APPLICATION ENV KEY UNTIL ALL ENV RESOURCES HAVE BEEN 
			// PROCESSED...E.G. WAIT FOR ENV INSTANTIATION OF CLASS OBJECT BEFORE DETECTING ENVIRONMENT.
			if((self::$env_select_ARRAY[$configSerial] != "" && $env == self::$env_select_ARRAY[$configSerial]) || self::$env_select_ARRAY[$configSerial]==""){
				if(self::$envDetectRequiredCnt > 0 && self::$serverAppKey[$configSerial]==''){
					self::$serverAppKey[$configSerial] = $env;
					self::$oLogger->logDebug("crnrstn :: environmental detection complete. setting application server app key for CRNRSTN config serial [".$configSerial."] to [".$env."].");
				}
			}
		}
    }
	
	private static function detectServerEnv($configSerial, $env, $key, $value) { 
	
		//
		// CHECK THE ENVIRONMENTAL DETECTION KEYS FOR MATCHES AGAINST THE SERVER CONFIGURATION
		if(array_key_exists($key, self::$handle_srvr_ARRAY)){
			self::$oLogger->logDebug("crnrstn :: we have a SERVER param [".$key."] to check value [".$value."] for match against actual SERVER[].");
			return self::isServerKeyMatch($configSerial, $env, $key, $value);
		}else{
			return false;
		}
	}
	
	private static function isServerKeyMatch($configSerial, $env, $key, $value){
		
		//
		// RUN VALUE COMPARISON FOR INCOMING VALUE AND DATA FROM THE SERVERS' SUPER GLOBAL VARIABLE ARRAY
		if($value == self::$handle_srvr_ARRAY[$key]){
			
			//
			// INCREMENT FOR EACH MATCH. 
			self::$env_detect_ARRAY[$configSerial][$env]++;
			self::$oLogger->logDebug("crnrstn :: SERVER match found for key [".$key."] with value [".$value."] Increment detection count [".self::$env_detect_ARRAY[$configSerial][$env]."] for environment [".$env."]. Need [".self::$envDetectRequiredCnt."] matches to detect environment (if 0, then must process all config data).");
		}
		
		//
		// FIRST $ENV TO REACH $envDetectRequiredCnt...YOU KNOW YOU HAVE QUALIFIED MATCH.
		if(self::$env_detect_ARRAY[$configSerial][$env] >= self::$envDetectRequiredCnt && self::$envDetectRequiredCnt>0){
			
			//
			// WE HAVE AN ENVIRONMENTAL DEFINITION WITH A SUFFICIENT NUMBER OF SUCCESSFUL MATCHES TO THE RUNNING ENVIRONMENT 
			// AS DEFINED BY THE CRNRSTN CONFIG FILE
			self::$env_select_ARRAY[$configSerial] = $env;
			self::$oLogger->logDebug("crnrstn :: environmental detection complete. CRNRSTN selected environmental profile [".$env."] running with CRNRSTN serialization of [".$configSerial."] and phpsession[".session_id()."].");
			return true;
		}else{
			
			//
			// EVIDENCE OF A MATCH...STILL NOT SUFFICIENT
			return false;
		}
	}
	
	public function initSessionEncryption($env, $encryptCipher, $encryptSecretKey, $encryptOptions, $hmac_alg){	
		try{
			if($env=="" || $encryptCipher=="" || $encryptSecretKey=="" || $hmac_alg==""){
				self::$oLogger->logDebug("crnrstn :: ERROR :: missing required information to configure initSessionEncryption().");
				throw new Exception('CRNRSTN initialization ERROR :: initSessionEncryption was called but was missing paramter information and so session encryption was not able to be initialized. Some parameters are required. env['.$env.'] encryptCipher['.$encryptCipher.'] encryptSecretKey[##### REDACTED #####] (optional)encryptOptions['.$encryptOptions.'] hmac_alg['.$hmac_alg.']');
				
			}else{
				$this->opensslSessEncryptCipher[crc32($this->configSerial)][crc32($env)] = $encryptCipher;
				$this->opensslSessEncryptSecretKey[crc32($this->configSerial)][crc32($env)] = $encryptSecretKey;
				$this->opensslSessEncryptOptions[crc32($this->configSerial)][crc32($env)] = $encryptOptions;
				$this->sessHmac_algorithm[crc32($this->configSerial)][crc32($env)] = $hmac_alg; #
				#self::$oLogger->logDebug("crnrstn :: session encryption initialized for environment [".$env."] to cipher [".$encryptCipher."] and hmac algorithm [".$hmac_alg."].");
				self::$oLogger->logDebug("crnrstn :: session encryption initialized for environment [".$env."] to cipher [##### REDACTED #####] and hmac algorithm [##### REDACTED #####].");
				return true;
			}
			
		}catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('crnrstn->initSessionEncryption()', LOG_ERR, $e->getMessage());
		}
	} 
	
	public function initCookieEncryption($env, $encryptCipher, $encryptSecretKey, $encryptOptions, $hmac_alg){	
		try{
			if($env=="" || $encryptCipher=="" || $encryptSecretKey=="" || $hmac_alg==""){
				self::$oLogger->logDebug("crnrstn :: ERROR :: missing required information to configure initCookieEncryption().");
				throw new Exception('CRNRSTN initialization ERROR :: initCookieEncryption was called but was missing paramter information and so cookie encryption was not able to be initialized. Some parameters are required. env['.$env.'] encryptCipher['.$encryptCipher.'] encryptSecretKey[xxx] (optional)encryptOptions['.$encryptOptions.'] hmac_alg['.$hmac_alg.']');
				
			}else{
				
				$this->opensslCookieEncryptCipher[crc32($this->configSerial)][crc32($env)] = $encryptCipher;
				$this->opensslCookieEncryptSecretKey[crc32($this->configSerial)][crc32($env)] = $encryptSecretKey;
				$this->opensslCookieEncryptOptions[crc32($this->configSerial)][crc32($env)] = $encryptOptions;
				$this->cookieHmac_algorithm[crc32($this->configSerial)][crc32($env)] = $hmac_alg;
				#self::$oLogger->logDebug("crnrstn :: cookie encryption initialized for environment [".$env."] to cipher [".$encryptCipher."] and hmac algorithm [".$hmac_alg."].");
				self::$oLogger->logDebug("crnrstn :: cookie encryption initialized for environment [".$env."] to cipher [##### REDACTED #####] and hmac algorithm [##### REDACTED #####].");
				return true;
			}
			
		}catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('crnrstn->initSessionEncryption()', LOG_ERR, $e->getMessage());
		}
			
			
	} 
	
	public function initTunnelEncryption($env, $encryptCipher, $encryptSecretKey, $encryptOptions, $hmac_alg){	
		try{
			if($env=="" || $encryptCipher=="" || $encryptSecretKey=="" || $hmac_alg==""){
				self::$oLogger->logDebug("crnrstn :: ERROR :: missing required information to configure initTunnelEncryption().");
				throw new Exception('CRNRSTN initialization ERROR :: initTunnelEncryption was called but was missing paramter information and so tunnel encryption was not able to be initialized. Some parameters are required. env['.$env.'] encryptCipher['.$encryptCipher.'] encryptSecretKey[##### REDACTED #####] (optional)encryptOptions['.$encryptOptions.'] hmac_alg['.$hmac_alg.']');
				
			}else{
				
				$this->opensslTunnelEncryptCipher[crc32($this->configSerial)][crc32($env)] = $encryptCipher;
				$this->opensslTunnelEncryptSecretKey[crc32($this->configSerial)][crc32($env)] = $encryptSecretKey;
				$this->opensslTunnelEncryptOptions[crc32($this->configSerial)][crc32($env)] = $encryptOptions;
				$this->tunnelHmac_algorithm[crc32($this->configSerial)][crc32($env)] = $hmac_alg;
				#self::$oLogger->logDebug("crnrstn :: tunnel encryption initialized for environment [".$env."] to cipher [".$encryptCipher."] and hmac algorithm [".$hmac_alg."].");
				self::$oLogger->logDebug("crnrstn :: tunnel encryption initialized for environment [".$env."] to cipher [##### REDACTED #####] and hmac algorithm [##### REDACTED #####].");
				return true;
			}
			
		}catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('crnrstn->initTunnelEncryption()', LOG_ERR, $e->getMessage());
		}
			
			
	} 
	
	public function setServerEnv(){
		self::$serverAppKey[crc32($this->configSerial)] = $_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_RESOURCE_KEY'];
		self::$oLogger->logDebug("crnrstn :: detected server environment [".self::$serverAppKey[crc32($this->configSerial)]."] pulled from session[".session_id()."] memory (not the config file) and used to reinitialize CRNRSTN in private static array.");
		return $_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_RESOURCE_KEY'];
		
	}
	
	public function getServerEnv() {
		
		//
		// DID WE DETERMINE ENVIRONMENT KEY THROUGH INITIALIZATION OF CRNRSTN? IF SO, THIS PARAMETER WILL BE SET. JUST USE IT.
		if(self::$serverAppKey[crc32($this->configSerial)]!=""){
			self::$oLogger->logDebug("crnrstn :: detected server environment [".self::$serverAppKey[crc32($this->configSerial)]."] returned from private static array.");
			return self::$serverAppKey[crc32($this->configSerial)];
		}else{
		
			//
			// SINCE ENV NOT DETERMINED THROUGH INITIAL INITIALIZATION, NEXT CHECK FOR  
			if(!(self::$envDetectRequiredCnt > 0)){
				
				//
				// RETURN SERVER APPLICATION KEY BASED UPON A BEST FIT SCENARIO. FOR ANY TIES...FIRST COME FIRST SERVED.
				foreach (self::$handle_resource_ARRAY as $serial=>$resource_ARRAY) {
					foreach($resource_ARRAY as $env=>$key){
						if(isset(self::$env_detect_ARRAY[$serial][$env])){
							if(self::$env_detect_ARRAY[$serial][$env]>0){
								if(self::$envMatchCount < self::$env_detect_ARRAY[$serial][$env]){
									self::$envMatchCount = self::$env_detect_ARRAY[$serial][$env];
									self::$serverAppKey[$serial] = $env;
									self::$oLogger->logDebug("crnrstn :: attempting to detect running environment. environment [".$env."] is new detection leader having [".self::$envMatchCount."] SERVER matches.");
								}
							
							}
						}
					}
				}
			}
		

			try{
				
				//
				// WE SHOULD HAVE THIS VALUE BY NOW. IF EMPTY, HOOOSTON...VE HAF PROBLEM!
				if(self::$serverAppKey[crc32($this->configSerial)] == ""){
					self::$oLogger->logDebug("crnrstn :: ERROR :: we have processed ALL defined environmental resources and were unable to detect running environment with CRNRSTN config serial [".$this->configSerial."].");
					throw new Exception('CRNRSTN initialization error :: Environmental detection failed to match a sufficient number of parameters (apparently, finding '.self::$envDetectRequiredCnt.' $_SERVER matches was too hard) to your servers configuration to successfully initialize CRNRSTN on server '.self::$handle_srvr_ARRAY['SERVER_NAME'].' ('.self::$handle_srvr_ARRAY['SERVER_ADDR'].')');
				}
			
			} catch( Exception $e ) {
				
				//
				// SEND THIS THROUGH THE LOGGER OBJECT
				self::$oLogger->captureNotice('crnrstn->getServerEnv()', LOG_ALERT, $e->getMessage());
				
				//
				// RETURN FALSE
				return false;
			}	
			
			self::$oLogger->logDebug("crnrstn :: returning detected environment [".self::$serverAppKey[crc32($this->configSerial)]."] as the selected running environment.");
			return self::$serverAppKey[crc32($this->configSerial)];
		}
	}
	
	public function getHandle_resource_ARRAY(){	
		return 	self::$handle_resource_ARRAY;
		
	}
	
	public function getDebugStr(){
		
		return 	self::$oLogger->debugStr;
	}
	
	public function clearDebugStr(){
		
		self::$oLogger->clearDebug();
	}
	
	public function getDebugMode(){
		
		return $this->debugMode;
	}
	
	public function getStartTime(){
		
		return $this->starttime;
	}
	
	public function debugTransfer($currDebugStr){
		
		//
		// DUE TO THE IMMINENT DELETION OF CRNRSTN_ENV...MOVE DEBUG OUTPUT HERE TO PERSIST
		self::$oLogger->transferDebug($currDebugStr);
			
	}
	
	//	
	// SOURCE :: http://www.php.net/manual/en/function.microtime.php
	private function microtime_float(){
	    list($usec, $sec) = explode(" ", microtime());
	    return ((float)$usec + (float)$sec);
	}
	
	public function __destruct() {

	}
}

?>