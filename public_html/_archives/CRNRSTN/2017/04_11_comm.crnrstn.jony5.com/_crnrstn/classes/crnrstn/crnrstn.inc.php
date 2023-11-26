<?php
/*
// J5
// Code is Poetry */
#  CRNRSTN Suite :: An Open Source PHP Class Library to configure an applications' code-base to run in multiple hosting environments.
#  Copyright (C) 2016 Jonathan 'J5' Harris.
#  VERSION :: 1.0.0
#  AUTHOR :: J5
#  URI :: http://crnrstn.jony5.com/
#  OVERVIEW :: Once CRNRSTN has been configured for your different hosting environments, seamlessly release a web application from
#              one environment to the next without having to change your code-base to account for environmentally specific parameters.
#  LICENSE :: This program is free software: you can redistribute it and/or modify
#             it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of 
#             the License, or (at your option) any later version.

#  This program is distributed in the hope that it will be useful,
#  but WITHOUT ANY WARRANTY; without even the implied warranty of
#  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#  GNU General Public License for more details.

#  You should have received a copy of the GNU General Public License
#  along with this program. This license can also be downloaded from
#  my web site at (http://crnrstn.jony5.com/license.txt).  
#  If not, see <http://www.gnu.org/licenses/>

class crnrstn {
	private static $serverBestFit = 0;
	private static $serverAppKey;
	private static $envDetectRequiredCnt;
	private static $env_detect_ARRAY = array();
	private static $handle_env_ARRAY = array();
	private static $handle_srvr_ARRAY = array();
	private static $env_name_ARRAY = array();
	public $grant_accessIP_ARRAY = array();
	public $deny_accessIP_ARRAY = array();
	
	public static $handle_resource_ARRAY = array();
	
	private static $oLogger;
	public static $log_profl_ARRAY = array();
	public static $log_endpt_ARRAY = array();
	private static $oMYSQLI;
	
	public $configSerial;
	public $oMYSQLI_CONN_MGR;
	public $oCRNRSTN_IPSECURITY_MGR;
	#public $oSESSION_MGR;
	public $oCRNRSTN_CIPHER_MGR;
	
	private static $mysqliIndex = 0;
			
	public function __construct($srvr_ARRAY, $serial) {
		#error_log("crnrstn.inc.php (30) Initializing config serialization with :".$serial);
		$this->configSerial = $serial;
		//
		// INSTANTIATE LOGGER
		if(!isset(self::$oLogger)){
			self::$oLogger = new crnrstn_logging();
		}
				
		//
		// INSTANTIATE SESSION MANAGER
		#if(!isset($this->oSESSION_MGR)){
		#	$this->oSESSION_MGR = new crnrstn_session_manager($this);
		#}
		
		//
		// CHECK SERVER SUPER GLOBAL ARRAY FOR DATA
		try{
			if(!array_key_exists('SERVER_ADDR', $srvr_ARRAY)){
				//
				// HOOOSTON...VE HAF PROBLEM!
				throw new Exception('CRNRSTN initialization error :: $_SERVER[] super global has not been passed to the crnrstn class object successfully on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].').');
			}
		} catch( Exception $e ) {
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('crnrstn->__construct()', LOG_EMERG, $e->getMessage());
		}
		
		//
		// STORE SUPER GLOBAL ARRAY WITH SERVER DATA TO SUPPORT ENVIRONMENTAL DETECTION
		self::$handle_srvr_ARRAY=$srvr_ARRAY;
		
		//
		// INITIALIZE DATABASE CONNECTION MANAGER. [##ENHANCEMENT##]IF MySQL < 4.1.3, NEED TO USE MYSQL PROCEEDURALLY
		if(!isset($this->oMYSQLI_CONN_MGR)){
			$this->oMYSQLI_CONN_MGR = new crnrstn_mysqli_conn_manager();
		}
		
		//
		// INITIALIZE IP ADDRESS SECURITY MANAGER
		if(!isset($this->oCRNRSTN_IPSECURITY_MGR)){
			$this->oCRNRSTN_IPSECURITY_MGR = new crnrstn_ip_auth_manager(self::$handle_srvr_ARRAY['REMOTE_ADDR']);
		}
		
		//
		// INITIALIZE CIPHER SECURITY MANAGER
		if(!isset($this->oCRNRSTN_CIPHER_MGR)){
			#error_log("crnrstn.inc.php (100) passing in configSerial of ".$this->configSerial." to cipher_manager");
			$this->oCRNRSTN_CIPHER_MGR = new crnrstn_cipher_manager($this->configSerial);
		}
	}

	public function addEnvironment($key, $errorReporting){
		$this->addServerEnv(crc32($key), $errorReporting);
		return true;
	}

	public function addServerEnv($key, $errRptProfl) {
		#error_log("crnrstn.inc.php (95) ********key: ******** ".$key." *******************");
		try{
			if(!isset(self::$handle_env_ARRAY[$key])){
				self::$handle_env_ARRAY[$key] = $errRptProfl;
				self::$env_detect_ARRAY[$key] = 0;
				self::$env_name_ARRAY[crc32($key)] = $key;
			}else{
				//
				// 	THIS KEY HAS ALREADY BEEN INITIALIZED
				throw new Exception('CRNRSTN initialization notice :: This environmental key ('.$key.') has already been initialized.');
			}
		}catch( Exception $e ) {
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('crnrstn->addServerEnv()', LOG_INFO, $e->getMessage());
		}
    }
	
	public function initLogging($key, $loggingProfl=NULL, $loggingEndpoint=NULL){
		if($loggingProfl!=''){
			self::$log_profl_ARRAY[crc32($key)] = $loggingProfl;
			self::$log_endpt_ARRAY[crc32($key)] = $loggingEndpoint;
		}
		
		return true;
		#error_log("crnrstn.inc.php (135) initLogging count: ".sizeof(self::$log_profl_ARRAY).", log_endpt_ARRAY: ".self::$log_endpt_ARRAY[crc32($key)]);
	}
	
	public function initSessionEncryption($env, $cipherstrength=NULL, $ciphername=NULL){	
		#$env = $env.self::$configSerial;
		
		if($ciphername!=''){
			//
			// ACCEPT WHATEVER CIPHER HAS BEEN PROVIDED
			$this->oCRNRSTN_CIPHER_MGR->specifyCipherProfile('SESSION', $env, $ciphername);
			
		}else{
			//
			// IF NO CIPHER NAME PROVIDED, AUTO SELECT BASED ON OPTIONALLY PROVIDED STRENGTH PARAMETER
			$this->oCRNRSTN_CIPHER_MGR->autoSelectCipherProfile('SESSION', $env, $cipherstrength);
		}
		
		return true;
	} 
	
	public function initCookieEncryption($env, $cipherstrength=NULL, $ciphername=NULL){	
		#$env = $env.self::$configSerial;
		
		if($ciphername!=''){
			//
			// ACCEPT WHATEVER CIPHER HAS BEEN PROVIDED
			$this->oCRNRSTN_CIPHER_MGR->specifyCipherProfile('COOKIE', $env, $ciphername);
			
		}else{
			//
			// IF NO CIPHER NAME PROVIDED, AUTO SELECT BASED ON OPTIONALLY PROVIDED STRENGTH PARAMETER
			$this->oCRNRSTN_CIPHER_MGR->autoSelectCipherProfile('COOKIE', $env, $cipherstrength);

		}
	} 
	
	public function addDatabase($env, $host, $un=NULL, $pwd=NULL, $db=NULL, $port=NULL){
		#$env = $env.self::$configSerial;
		
		//
		// HANDLE PATH TO DATABASE CONFIG FILE (E.G. ONLY 2 PARAMS PROVIDED)
		if($db==NULL){
			#echo "FOR ENV ".$env.", CHECKING FOR FILE (".$host.")<br>";
			if(is_file($host)){
				//
				// EXTRACT DATABASE CONFIGURATION FROM FILE
				include_once($host);
				
			}else{
				#echo "FOR ENV ".$env.", THE DB HOST FILE (".$host.") IS NO FILE<br>";
				//
				// WE COULD NOT FIND THE DATABASE CONFIGURATION FILE
				#self::$oLogger->captureNotice('crnrstn->addDatabase()', LOG_ERR, 'Could not find/interpret the database config file parameter for an addDatabase() method called in the crnrstn configuration.');			
			}

		}else{
			//
			// SEND DATABASE CONFIGURATION PARAMETERS TO THE CONNECTION MANAGER
			$this->oMYSQLI_CONN_MGR->addConnection($env, $host, $un, $pwd, $db, $port);
		}
		
		return true;
	}
	
	public function grantExclusiveAccess($env, $ip){
		
		#error_log("crnrstn.inc.php (182) grantExclusiveAccess env: ".$env);
		$this->grant_accessIP_ARRAY[crc32($env)] = $ip;
		
		#error_log(sizeof($this->grant_accessIP_ARRAY));
		//
		// HANDLE PATH TO IP ADDRESS AUTH CONFIG FILE
#		if(is_file($ip)){
			//
			// EXTRACT ACCESS-BY-IP AUTHORIZATION PROFILE FROM FILE
#			error_log("crnrstn.inc.php (186) EXTRACTING ACCESS BY IP from IP ADDRESS AUTH CONFIG FILE.");
#			include_once($ip);
			
#		}else{
			//
			// 
#			error_log("crnrstn.inc.php (192) EXTRACTING ACCESS BY IP :: ".$ip);
#			$this->oCRNRSTN_IPSECURITY_MGR->grantAccess($env, $ip);
#		}
		
		return true;
	}
	
	public function denyAccess($env, $ip){
		$this->deny_accessIP_ARRAY[crc32($env)] = $ip;
		#$env = $env.self::$configSerial;
	
		//
		// HANDLE PATH TO DATABASE CONFIG FILE (E.G. ONLY 2 PARAMS PROVIDED)
#		if(is_file($ip)){
			//
			// EXTRACT ACCESS-BY-IP AUTHORIZATION PROFILE FROM FILE
#			include_once($ip);
				
#		}else{
			//
			// SEND DATABASE CONFIGURATION PARAMETERS TO THE CONNECTION MANAGER
#			$this->oCRNRSTN_IPSECURITY_MGR->denyAccess($env, $ip);
#		}

		return true;
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
		
		return true;
	}
	
	public function defineEnvResource($env, $key, $value){
		$this->addEnvResource(crc32($env), trim($key), trim($value)); 
	}

	public function addEnvResource($env, $key, $value) {
		#echo "ADD to handle_resource_ARRAY[".$env."][".$key."] :: ".$value."<br>";
		#error_log("crnrstn.inc.php (267) config session param [".$env."][".$key."] :: ".$value);
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
				#echo "<br>SETTING SERVER APP KEY TO :: ".$env."<br>";
				#error_log("crnrstn.inc.php (280) env detect complete. setting serverAppKey to ".$env);
				self::$serverAppKey = $env;
			}
		}
    }
	
	public function getServerEnv() {
		//
		// DO WE NEED TO PERFORM OUR OWN ENV DETECTION BASED UPON CONFIG FILE ACCURACY AS MEASURED DURING INITIALIZATION?
		// DEFINE MIN. STANDARDS BY PASSING AN INTEGER TO $oCRNRSTN->requiredDetectionMatches() IN ORDER TO GAIN A MINOR EFFECIENCY
		#error_log("crnrstn.inc.php (290) getServerEnv with serverAppKey: ".self::$serverAppKey);
		if(!(self::$envDetectRequiredCnt > 0) || self::$serverAppKey==""){		// ADDED EMPTY STRING CHECK FOR FAILURE OF ENV DETECT BY INTEGER MATCH
			//
			// RETURN SERVER APPLICATION KEY BASED UPON A BEST FIT SCENARIO. FOR ANY TIES...FIRST COME FIRST SERVED.
			foreach (self::$handle_resource_ARRAY as $env=>$resource_ARRAY) {
				foreach($resource_ARRAY as $key=>$value){
					if ( ! isset(self::$env_detect_ARRAY[$env])) {
					   self::$env_detect_ARRAY[$env] = null;
					}
					if(self::$env_detect_ARRAY[$env]>0 && self::$env_detect_ARRAY[$env]>self::$serverBestFit){
						self::$serverBestFit = self::$env_detect_ARRAY[$env];
						self::$serverAppKey = $env;
					}
				}
			}
		}

		try{
			//
			// WE SHOULD HAVE THIS VALUE BY NOW. IF NULL, HOOOSTON...VE HAF PROBLEM!. $_SERVER['SERVER_NAME']
			if(self::$serverAppKey == ""){
				throw new Exception('CRNRSTN environmental initialization error :: Environmental detection failed to match a sufficient number of parameters to your servers configuration to successfully initialize CRNRSTN on server '.self::$handle_srvr_ARRAY['SERVER_NAME'].' ('.self::$handle_srvr_ARRAY['SERVER_ADDR'].')');
			}
		
		} catch( Exception $e ) {
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('crnrstn->getServerEnv()', LOG_ALERT, $e->getMessage());
			
			//
			// RETURN NOTHING
			return false;
		}
		
		//
		// INITIALIZE ERROR REPORTING FOR THIS ENVIRONMENT
		self::initializeErrorReporting(self::$serverAppKey);
		
		return self::$serverAppKey;
	}
	
	public function getHandle_resource_ARRAY(){
		
		return 	self::$handle_resource_ARRAY;
		
	}
	
	public function get_log_profl_ARRAY(){
		return self::$log_profl_ARRAY;	
	}
	
	public function get_log_endpt_ARRAY(){
		return self::$log_endpt_ARRAY;	
	}
	
	public function initializeErrorReporting($key){
		#echo '<br>err report key = '.$key.'<br>';
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
		#error_log("crnrstn.inc.php (366) $_SERVER key match for env: ".$env." |envDetectRequiredCnt: ".self::$envDetectRequiredCnt." |Env Match Count:  ".self::$env_detect_ARRAY[$env]);
		if(self::$env_detect_ARRAY[$env] >= self::$envDetectRequiredCnt){
			//
			// WE HAVE A ENVIRONMENTAL DEFINITION WITH A SUFFICIENT NUMBER OF SUCCESSFUL MATCHES TO THE RUNNING ENVIRONMENT 
			// AS DEFINED BY THE CRNRSTN CONFIG FILE
			#error_log("crnrstn.inc.php (371) We have matchcount of ".self::$env_detect_ARRAY[$env]." with environment ".$env);
			return true;
		}else{
			//
			// EVIDENCE OF A MATCH...STILL NOT SUFFICIENT
			return false;
		}
	}

	public function unitTest_Include_All_Parameters_Even_DB_Passwords(){

		echo '<div style="padding-bottom:10px; padding-top:10px; font-size:13px;"><strong>Test of Environmental Detection :: </strong> Real-time super global server settings matched to programatic configuration parameters within an instantiation of the crnrstn class.</div>';
		//
		// FOR EACH CRNRSTN CONFIGURED ENVIRONMENT, WHERE ARE THE SERVER SETTING MATCHES	
		foreach (self::$handle_resource_ARRAY as $env=>$resource_ARRAY) {
			$matchCount=0;
			echo '<div style="padding-bottom:10px;  font-size:13px;"><strong>Programatic environmental configuration matches for :: </strong>addEnvironment("'.self::$env_name_ARRAY[$env].'")</div>';
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
	
	public function unitTest_Expose_Server_Config_Only(){

		echo '<div style="padding-bottom:10px; padding-top:10px; font-size:13px;"><strong>Test of Environmental Detection :: </strong> Real-time super global server settings matched to programatic configuration parameters within an instantiation of the crnrstn class.</div>';
		//
		// FOR EACH CRNRSTN CONFIGURED ENVIRONMENT, WHERE ARE THE SERVER SETTING MATCHES	
		foreach (self::$handle_resource_ARRAY as $env=>$resource_ARRAY) {
			$matchCount=0;
			echo '<div style="padding-bottom:10px;  font-size:13px;"><strong>Programatic environmental configuration matches for :: </strong>addEnvironment("'.self::$env_name_ARRAY[$env].'")</div>';
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