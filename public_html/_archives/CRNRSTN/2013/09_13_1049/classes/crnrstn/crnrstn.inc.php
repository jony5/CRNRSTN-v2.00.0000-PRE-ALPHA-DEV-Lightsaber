<?php
#
# [INSERT HEADER FROM MOST RECENT DEVELOPMENT ON MAC BOOK PRO ONCE YOU GET THE DATA FROM THAT HARD DRIVE.]
#

# syslog() Priorities (in descending order)
# Constant		Description
# LOG_EMERG		system is unusable
# LOG_ALERT		action must be taken immediately
# LOG_CRIT		critical conditions
# LOG_ERR		error conditions
# LOG_WARNING	warning conditions
# LOG_NOTICE	normal, but significant, condition
# LOG_INFO		informational message
# LOG_DEBUG		debug-level message

class crnrstn {
	private static $serverBestFit = 0;
	private static $serverAppKey;
	private static $envDetectRequiredCnt = 2;
	private static $env_detect_ARRAY = array();
	private static $handle_env_ARRAY = array();
	private static $handle_srvr_ARRAY = array();
	
	public static $handle_resource_ARRAY = array();
	
	private static $oLOGGER;
	private static $oMYSQLI;

	public $oMYSQLI_CONN_MGR;
	public $oMYSQLI_IPSECURITY_MGR;
	
	private static $mysqliIndex = 0;
	
	public function __construct($srvr_ARRAY) {
		//
		// INSTANTIATE LOGGER
		self::$oLOGGER = new logging('__construct class crnrstn ::');
		
		//
		// CHECK SERVER SUPER GLOBAL ARRAY FOR DATA
		try{
			if(!array_key_exists('SERVER_ADDR', $srvr_ARRAY)){
				throw new Exception('CRNRSTN initialization error :: $_SERVER[] super global has not been passed to the crnrstn class object successfully on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].').');
			}
		} catch( Exception $e ) {
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLOGGER->captureNotice(LOG_EMERG, $e->getMessage());
			#print $e->getMessage();
		}
		
		//
		// STORE SUPER GLOBAL ARRAY WITH SERVER DATA TO SUPPORT ENVIRONMENTAL DETECTION
		self::$handle_srvr_ARRAY=$srvr_ARRAY;
		
		//
		// INITIALIZE DATABASE CONNECTION MANAGER. [##ENHANCEMENT##]IF MySQL < 4.1.3, NEED TO USE MYSQL PROCEEDURALLY
		$this->oMYSQLI_CONN_MGR = new mysqli_connection_manager();
		
		//
		// INITIALIZE IP ADDRESS SECURITY MANAGER
		$this->oMYSQLI_IPSECURITY_MGR = new ip_auth_manager(self::$handle_srvr_ARRAY['REMOTE_ADDR']);
	}

	public function addEnvironment($key, $errorReporting){
		$this->addServerEnv($key, $errorReporting);
	}

	public static function addServerEnv($key, $errRptProfl) {
        self::$handle_env_ARRAY[$key] = $errRptProfl;
		self::$env_detect_ARRAY[$key] = 0;
    }
	
	public function addDatabase($env, $host, $un=NULL, $pwd=NULL, $db=NULL, $port=NULL){
		//
		// HANDLE PATH TO DATABASE CONFIG FILE (E.G. ONLY 2 PARAMS PROVIDED)
		if($db==NULL){
			if(is_file($host)){
				//
				// EXTRACT DATABASE CONFIGURATION FROM FILE
				include_once($host);
				
			}else{
				//
				// WE COULD NOT FIND THE DATABASE CONFIGURATION FILE
				self::$oLOGGER->captureNotice(LOG_ERR, 'Could not find/interpret the database config file parameter for an addDatabase() method called in the crnrstn configuration.');			
			}
			
		}else{
			//
			// SEND DATABASE CONFIGURATION PARAMETERS TO THE CONNECTION MANAGER
			$this->oMYSQLI_CONN_MGR->addConnection($env, $host, $un, $pwd, $db, $port);
		}
	}
	
	public function grantExclusiveAccess($env, $ip){
		//
		// HANDLE PATH TO DATABASE CONFIG FILE (E.G. ONLY 2 PARAMS PROVIDED)
		if(is_file($ip)){
			//
			// EXTRACT ACCESS-BY-IP AUTHORIZATION PROFILE FROM FILE
			include_once($ip);
			
		}else{
			//
			// SEND DATABASE CONFIGURATION PARAMETERS TO THE CONNECTION MANAGER
			$this->oMYSQLI_IPSECURITY_MGR->grantAccess($env, $ip);
		}
	}
	
	public function denyAccess($env, $ip){
		//
		// HANDLE PATH TO DATABASE CONFIG FILE (E.G. ONLY 2 PARAMS PROVIDED)
		if(is_file($ip)){
			//
			// EXTRACT ACCESS-BY-IP AUTHORIZATION PROFILE FROM FILE
			include_once($ip);
				
		}else{
			//
			// SEND DATABASE CONFIGURATION PARAMETERS TO THE CONNECTION MANAGER
			$this->oMYSQLI_IPSECURITY_MGR->denyAccess($env, $ip);
		}
	}
	
	public function requiredDetectionMatches($value=''){
		//
		// HOW MANY SERVER KEYS ARE REQUIRED TO MATCH IN ORDER TO SUCCESSFULLY 
		// CONFIGURE CRNRSTN THROUGHOUT ALL OF YOUR ENVIRONMENTS
		if($value==''){
			//
			// WE WANT THE ENVIRONMENT WITH MOST MATCHES. DELAY ENV DETECTION UNTIL INSTANTIATION OF ENV CLASS OBJECT
			self::$envDetectRequiredCnt = NULL;
		}else{
			//
			// NON-ZERO VALUE HAS BEEN RECIEVED. THE ENV CONFIG THAT MEETS THIS REQUIREMENT FIRST IS USED FOR ENV INITIALIZATION
			self::$envDetectRequiredCnt = $value + 0;
		}
	}
		
	public function defineEnvResource($env, $key, $value){
		$this->addEnvResource($env, $key, $value); 
	}

	public static function addEnvResource($env, $key, $value) {
        self::$handle_resource_ARRAY[$env][$key] = $value;
		
		//
		// FOR FASTEST DISCOVERY, RUN ENVIRONMENTAL DETECTION IN PARALLEL WITH INITIALIZATION OF RESOURCE DEFINITIONS.
		// THIS MEANS THERE SHOULD/WOULD BE A NON-NULL / NON ZERO INTEGER PASSED TO $oCRNRSTN->requiredDetectionMatches(2) IN THE
		// CRNRSTN CONFIG FILE. OTHERWISE, WE MUST TRAVERSE ALL ENV CONFIG DEFINITIONS AND THEN TAKE BEST FIT PER SERVER SETTINGS.
		if(self::detectServerEnv($env, $key, $value)){
			//
			// IF NULL/ZED COUNT, HOLD OFF ON DEFINING APPLICATION ENV KEY UNTIL ALL ENV RESOURCES HAVE BEEN 
			// PROCESSED...E.G. WAIT FOR ENV INSTANTIATION OF CLASS OBJECT BEFORE DETECTING ENVIRONMENT.
			if(self::$envDetectRequiredCnt > 0 && self::$serverAppKey==''){
				self::$serverAppKey = $env;
			}
		}
    }
	
	public static function getServerEnv() {
		//
		// DO WE NEED TO PERFORM OUR OWN ENV DETECTION BASED UPON CONFIG FILE ACCURACY AS MEASURED DURING INITIALIZATION?
		// DEFINE MIN. STANDARDS BY PASSING AN INTEGER TO $oCRNRSTN->requiredDetectionMatches() IN ORDER TO GAIN A MINOR EFFECIENCY
		if(!(self::$envDetectRequiredCnt > 0)){			
			//
			// RETURN SERVER APPLICATION KEY BASED UPON A BEST FIT SCENARIO. FOR ANY TIES...FIRST COME FIRST SERVED.
			foreach (self::$handle_resource_ARRAY as $env=>$resource_ARRAY) {
				foreach($resource_ARRAY as $key=>$value){
					if(self::$env_detect_ARRAY[$env]>0 && self::$env_detect_ARRAY[$env]>self::$serverBestFit){
						self::$serverBestFit = self::$env_detect_ARRAY[$env];
						self::$serverAppKey = $env;
					}
				}
			}
		}
		
		try{
			//
			// WE SHOULD HAVE THIS VALUE BY NOW. IF NULL, HOOOSTON...VE HAF PROBLEM.
			if(self::$serverAppKey==""){
				throw new Exception('CRNRSTN environmentalal initialization error :: Environmental detection failed to match a sufficient number of parameters to your servers configuration to successfully initialize crnrstn on server '.self::$handle_srvr_ARRAY['SERVER_NAME'].' ('.self::$handle_srvr_ARRAY['SERVER_ADDR'].')');
			}
		} catch( Exception $e ) {
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLOGGER->captureNotice(LOG_ALERT, $e->getMessage());
			
			//
			// RETURN NOTHING
			return false;
		}
		
		//
		// INITIALIZE ERROR REPORTING FOR THIS ENVIRONMENT
		self::initializeErrorReporting(self::$serverAppKey);
		
		return self::$serverAppKey;
	}
	
	private static function initializeErrorReporting($key){
		error_reporting(self::$handle_env_ARRAY[$key]);
	}
	
	private static function detectServerEnv($env, $key, $value) { 
		//
		// CHECK THE ENVIRONMENTAL DETECTION KEYS FOR MATCHES AGAINST THE SERVER CONFIGURATION
		if(array_key_exists($key, self::$handle_srvr_ARRAY)){
			return self::isServerKeyMatch($env, $key, $value);
		}else{
			return false;
		}
	}
	
	private static function isServerKeyMatch($env, $key, $value){
		//
		// RUN VALUE COMPARISON FOR INCOMING VALUE AND DATA FROM THE SERVERS' SUPER GLOBAL VARIABLE ARRAY
		if($value == self::$handle_srvr_ARRAY[$key]){
			//
			// INCREMENT FOR EACH MATCH. 
			self::$env_detect_ARRAY[$env]++;
		}
		
		//
		// FIRST $ENV TO REACH $envDetectRequiredCnt...YOU KNOW YOU HAVE QUALIFIED MATCH.
		if(self::$env_detect_ARRAY[$env] >= self::$envDetectRequiredCnt){
			//
			// WE HAVE A ENVIRONMENTAL DEFINITION WITH A SUFFICIENT NUMBER OF SUCCESSFUL MATCHES TO THE RUNNING ENVIRONMENT 
			// AS DEFINED BY THE CRNRSTN CONFIG FILE
			return true;
		}else{
			//
			// EVIDENCE OF A MATCH...STILL NOT SUFFICIENT
			return false;
		}
	}
	
	public static function returnSrvrRespStatus($errorCode){
		//
		// http://php.net/manual/en/function.http-response-code.php
		// Source: Wikipedia "List_of_HTTP_status_codes"
		$http_status_codes = array(100 => "Continue", 101 => "Switching Protocols", 102 => "Processing", 200 => "OK", 201 => "Created", 202 => "Accepted", 203 => "Non-Authoritative Information", 204 => "No Content", 205 => "Reset Content", 206 => "Partial Content", 207 => "Multi-Status", 300 => "Multiple Choices", 301 => "Moved Permanently", 302 => "Found", 303 => "See Other", 304 => "Not Modified", 305 => "Use Proxy", 306 => "(Unused)", 307 => "Temporary Redirect", 308 => "Permanent Redirect", 400 => "Bad Request", 401 => "Unauthorized", 402 => "Payment Required", 403 => "Forbidden", 404 => "Not Found", 405 => "Method Not Allowed", 406 => "Not Acceptable", 407 => "Proxy Authentication Required", 408 => "Request Timeout", 409 => "Conflict", 410 => "Gone", 411 => "Length Required", 412 => "Precondition Failed", 413 => "Request Entity Too Large", 414 => "Request-URI Too Long", 415 => "Unsupported Media Type", 416 => "Requested Range Not Satisfiable", 417 => "Expectation Failed", 418 => "I'm a teapot", 419 => "Authentication Timeout", 420 => "Enhance Your Calm", 422 => "Unprocessable Entity", 423 => "Locked", 424 => "Failed Dependency", 424 => "Method Failure", 425 => "Unordered Collection", 426 => "Upgrade Required", 428 => "Precondition Required", 429 => "Too Many Requests", 431 => "Request Header Fields Too Large", 444 => "No Response", 449 => "Retry With", 450 => "Blocked by Windows Parental Controls", 451 => "Unavailable For Legal Reasons", 494 => "Request Header Too Large", 495 => "Cert Error", 496 => "No Cert", 497 => "HTTP to HTTPS", 499 => "Client Closed Request", 500 => "Internal Server Error", 501 => "Not Implemented", 502 => "Bad Gateway", 503 => "Service Unavailable", 504 => "Gateway Timeout", 505 => "HTTP Version Not Supported", 506 => "Variant Also Negotiates", 507 => "Insufficient Storage", 508 => "Loop Detected", 509 => "Bandwidth Limit Exceeded", 510 => "Not Extended", 511 => "Network Authentication Required", 598 => "Network read timeout error", 599 => "Network connect timeout error");
		header('HTTP/1.1 '.$errorCode.' '.$http_status_codes[$errorCode]);
	}
	
	public static function unitTest_Include_All_Parameters_Even_DB_Passwords(){

		echo '<div style="padding-bottom:10px; padding-top:10px; font-size:13px;"><strong>Test of Environmental Detection :: </strong> Real-time super global server settings matched to programatic configuration parameters within an instantiation of the crnrstn class.</div>';
		//
		// FOR EACH CRNRSTN CONFIGURED ENVIRONMENT, WHERE ARE THE SERVER SETTING MATCHES	
		foreach (self::$handle_resource_ARRAY as $env=>$resource_ARRAY) {
			$matchCount=0;
			echo '<div style="padding-bottom:10px;  font-size:13px;"><strong>Programatic environmental configuration matches for :: </strong>addEnvironment("'.$env.'")</div>';
			echo '<table border="1" width="100%">';
			echo '<tr><td width="280" style="font-size:11px; color:#000;"><strong>Programatic Constant [NAME]</strong></td><td style="font-size:11px; color:#000;"><strong>Programatic Constant [VALUE]</strong></td><td width="165" align="center" style="font-size:11px; color:#000;"><strong>[Compare to this server]</strong></td></tr>';

			foreach($resource_ARRAY as $key=>$value){
				foreach (self::$handle_srvr_ARRAY as $server_super_global_param=>$server_resource) {
					if($server_super_global_param==$key){
						if($value==$server_resource){
							$isMatchedResponse='<span style="font-weight:bold; color:#00CC00; font-size:11px;">this server setting matches</span>';
							$matchCount++;
						}else{
							$isMatchedResponse='<span style="font-size:11px;"><a href="'.$_SERVER['PHP_SELF'].'#'.$key.'" target="_self" style="font-weight:bold; color:#FF0000;">not matched on this server</a></span>';
						}
						
						echo '<tr><td width="280" style="font-size:11px; color:#000;"><strong>'.$key.'</strong> =</td><td><textarea cols="95" rows="1" style="font-size:11px; width:100%;">'.$value.'</textarea></td><td width="165" align="center">'.$isMatchedResponse.'</td></tr>';
					}					
				}	
			}
			echo '<tr><td width="280" style="font-size:11px; color:#000;"><strong>Total CRNRSTN Server Config Matches</strong></td><td style="font-size:12px;"><strong>'.$matchCount.'</strong> settings for this environment ('.$env.') align to <a href="'.$_SERVER['PHP_SELF'].'#serverConfig" target="_self">this servers\' configuration</a>.</td><td></td></tr>';
			echo '</table>';	
			echo '<div style=" padding:10px 0px 0px 0px; width:100%; border-bottom-width: 1px;border-bottom-style: dashed;border-bottom-color:#FF0000;"></div>';
			echo '<div style=" padding:10px 0px 0px 0px; width:100%;"></div>';
		}	
	
	
		echo '<div id="serverConfig" style="padding-bottom:10px; font-size:13px;"><strong>Current Server Settings</strong> (as extracted from super global $_SERVER[ ] &amp; unmodified) ::</div>';
		echo '<table border="1" width="100%">';
		foreach (self::$handle_srvr_ARRAY as $server_super_global_param=>$server_resource) {
			echo '<tr><td width="280" style="font-size:11px; color:#000;"><strong id="'.$server_super_global_param.'">'.$server_super_global_param.'</strong> =</td><td><textarea cols="95" rows="1" style="font-size:11px; width:100%;">'.$server_resource.'</textarea></td></div></tr>';
		}
		echo '</table>';	
		echo '<div style=" padding:10px 0px 0px 0px; width:100%; border-bottom-width: 1px;border-bottom-style: dashed;border-bottom-color:#FF0000;"></div>';
		echo '<div style=" padding:10px 0px 0px 0px; width:100%;"></div>';
			
		foreach (self::$handle_resource_ARRAY as $env=>$resource_ARRAY) {
			echo '<div style="padding-bottom:10px;padding-top:10px; font-size:13px;"><strong>Programatic Environmental Configuration for :: </strong>'.$env.'</div>';
			echo '<table border="1" width="100%">';
			foreach($resource_ARRAY as $key=>$value){
				echo '<tr><td width="280" style="font-size:11px; color:#000;"><strong>'.$key.'</strong> =</td><td><textarea cols="95" rows="1" style="font-size:11px; width:100%;">'.$value.'</textarea></td></div></tr>';
			}
			echo '</table>';	
			echo '<div style=" padding:10px 0px 0px 0px; width:100%; border-bottom-width: 1px;border-bottom-style: dashed;border-bottom-color:#FF0000;"></div>';
			echo '<div style=" padding:10px 0px 0px 0px; width:100%;"></div>';
		}
	}
	
	public static function unitTest_Expose_Server_Config_Only(){

		echo '<div style="padding-bottom:10px; padding-top:10px; font-size:13px;"><strong>Test of Environmental Detection :: </strong> Real-time super global server settings matched to programatic configuration parameters within an instantiation of the crnrstn class.</div>';
		//
		// FOR EACH CRNRSTN CONFIGURED ENVIRONMENT, WHERE ARE THE SERVER SETTING MATCHES	
		foreach (self::$handle_resource_ARRAY as $env=>$resource_ARRAY) {
			$matchCount=0;
			echo '<div style="padding-bottom:10px;  font-size:13px;"><strong>Programatic environmental configuration matches for :: </strong>addEnvironment("'.$env.'")</div>';
			echo '<table border="1" width="100%">';
			echo '<tr><td width="280" style="font-size:11px; color:#000;"><strong>Programatic Constant [NAME]</strong></td><td style="font-size:11px; color:#000;"><strong>Programatic Constant [VALUE]</strong></td><td width="165" align="center" style="font-size:11px; color:#000;"><strong>[Compare to this server]</strong></td></tr>';

			foreach($resource_ARRAY as $key=>$value){
				foreach (self::$handle_srvr_ARRAY as $server_super_global_param=>$server_resource) {
					if($server_super_global_param==$key){
						if($value==$server_resource){
							$isMatchedResponse='<span style="font-weight:bold; color:#00CC00; font-size:11px;">this server setting matches</span>';
							$matchCount++;
						}else{
							$isMatchedResponse='<span style="font-size:11px;"><a href="'.$_SERVER['PHP_SELF'].'#'.$key.'" target="_self" style="font-weight:bold; color:#FF0000;">not matched on this server</a></span>';
						}
						
						echo '<tr><td width="280" style="font-size:11px; color:#000;"><strong>'.$key.'</strong> =</td><td><textarea cols="95" rows="1" style="font-size:11px; width:100%;">'.$value.'</textarea></td><td width="165" align="center">'.$isMatchedResponse.'</td></tr>';
					}					
				}	
			}
			echo '<tr><td width="280" style="font-size:11px; color:#000;"><strong>Total CRNRSTN Server Config Matches</strong></td><td style="font-size:12px;"><strong>'.$matchCount.'</strong> settings for this environment ('.$env.') align to <a href="'.$_SERVER['PHP_SELF'].'#serverConfig" target="_self">this servers\' configuration</a>.</td><td></td></tr>';
			echo '</table>';	
			echo '<div style=" padding:10px 0px 0px 0px; width:100%; border-bottom-width: 1px;border-bottom-style: dashed;border-bottom-color:#FF0000;"></div>';
			echo '<div style=" padding:10px 0px 0px 0px; width:100%;"></div>';
		}	
	
	
		echo '<div id="serverConfig" style="padding-bottom:10px; font-size:13px;"><strong>Current Server Settings</strong> (as extracted from super global $_SERVER[ ] &amp; unmodified) ::</div>';
		echo '<table border="1" width="100%">';
		foreach (self::$handle_srvr_ARRAY as $server_super_global_param=>$server_resource) {
			echo '<tr><td width="280" style="font-size:11px; color:#000;"><strong id="'.$server_super_global_param.'">'.$server_super_global_param.'</strong> =</td><td><textarea cols="95" rows="1" style="font-size:11px; width:100%;">'.$server_resource.'</textarea></td></div></tr>';
		}
		echo '</table>';	
		echo '<div style=" padding:10px 0px 0px 0px; width:100%; border-bottom-width: 1px;border-bottom-style: dashed;border-bottom-color:#FF0000;"></div>';
		echo '<div style=" padding:10px 0px 0px 0px; width:100%;"></div>';
		
	}
	
	public function __destruct() {

	}
}
?>