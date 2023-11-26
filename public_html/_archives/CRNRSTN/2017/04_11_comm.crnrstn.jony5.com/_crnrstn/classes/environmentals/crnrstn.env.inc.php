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

class crnrstn_environmentals {
	private static $resource_ARRAY = array();
	private static $resourceKey;
	private static $requestProtocol;
	private static $oLogger;
	public $configSerial;
	public $grant_accessIP_ARRAY = array();
	public $deny_accessIP_ARRAY = array();
	public $log_profl_ARRAY = array();
	public $log_endpt_ARRAY = array();
	
	public static $oMYSQLI;
	public $getHandle_resource_ARRAY = array();
	public $oMYSQLI_CONN_MGR;
	public $oCOOKIE_MGR;
	public $oSESSION_MGR;
	public $oHTTP_MGR;
	public $oSOAP_MGR;

	public $oCRNRSTN_IPSECURITY_MGR;
	public $oCRNRSTN_CIPHER_MGR;
	public $oMYSQLI_ARRAY = array();
	
	public $test;
		
	public function __construct($oCRNRSTN,$instanceType=NULL) {
		//
		// APPARENTLY NEED TO INITIALIZE SESSION_MGR IN THE CONSTRUCTOR
		
//		//
//		// AUTHORIZATION TO ACCESS SESSION RESOURCES GRANTED. INSTANTIATE SESSION MANAGER WITH ENVIRONMENT KEY AND POPULATE.
//		if(!isset($this->oSESSION_MGR)){
//			$this->oSESSION_MGR = new crnrstn_session_manager($this);
//		}
		
		$this->configSerial = $oCRNRSTN->configSerial;
		$this->log_profl_ARRAY = $oCRNRSTN->get_log_profl_ARRAY();
		$this->log_endpt_ARRAY = $oCRNRSTN->get_log_endpt_ARRAY();
		#error_log("crnrstn.env.inc.php (64) Did we successfully get from crnrstn :: ".sizeof($this->log_profl_ARRAY));
		#error_log("crnrstn.env.inc.php (40) about to test for instanceType: ".$instanceType);
		if(!($instanceType=='simple_configcheck')){
		#if(2==2){
			#error_log("crnrstn.env.inc.php (42) Entering main part of __construct :: ".$this->configSerial);
			
			//
			// INSTANTIATE LOGGER
			if(!isset(self::$oLogger)){
				self::$oLogger = new crnrstn_logging();
			}
			
			//
			// AUTHORIZATION TO ACCESS SESSION RESOURCES GRANTED. INSTANTIATE SESSION MANAGER WITH ENVIRONMENT KEY AND POPULATE.
			if(!isset($this->oSESSION_MGR)){
				$this->oSESSION_MGR = new crnrstn_session_manager($this);
			}
						
			#if(!($this->oSESSION_MGR->issetSessionParam('_CRNRSTN_ENV_KEY'))){
			#error_log("crnrstn.env.inc.php (83) DO I HAVE configSERIAL:".$this->oSESSION_MGR->configSerial);
			if(!(isset($_SESSION[$this->oSESSION_MGR->configSerial.'CRNRSTN'.crc32('_CRNRSTN_ENV_KEY')]))){ 
			#if(($oCRNRSTN->oSESSION_MGR->getSessionKey()=='')){
				#error_log("crnrstn.env.inc.php (86) _CRNRSTN_ENV_KEY not yet initialized");
				// 
				// DETERMINE THE KEY TO BE USED IN THE CURRENT ENVIRONMENT, AND INITIALIZE ENV SPECIFIC PARAMETERS
				try{
					//
					//	DETERMINE KEY FOR ENVIRONMENT
					self::$resourceKey = $oCRNRSTN->getServerEnv();
					#error_log("crnrstn.env.inc.php (93) resourceKey: ".self::$resourceKey);
					if(!self::$resourceKey){
						//
						// HOOOSTON...VE HAF PROBLEM!
						throw new Exception('CRNRSTN environmental configuration error :: unable to detect environment on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].').');
					}
					
					//
					// INITIALIZE LOGGING PROFILE FOR CURRENT ENVIRONMENT
					$_SESSION[$this->configSerial.'CRNRSTN'.self::$resourceKey.'LOG_PROFILE'] = $this->log_profl_ARRAY[self::$resourceKey];
					$_SESSION[$this->configSerial.'CRNRSTN'.self::$resourceKey.'LOG_ENDPOINT'] = $this->log_endpt_ARRAY[self::$resourceKey];
					#error_log("crnrstn.env.inc.php (104) log_endpt_ARRAY: ".$this->log_endpt_ARRAY[self::$resourceKey]);
					$_SESSION['CRNRSTN_CONFIG_SERIAL'] = $this->configSerial;
					$_SESSION['CRNRSTN_RESOURCE_KEY'] = self::$resourceKey;
					#error_log("crnrstn.env.inc.php (106) resourceKey = ".self::$resourceKey." | log_profl_ARRAY[resourcekey] = ".$this->log_profl_ARRAY[self::$resourceKey]);
					#error_log("crnrstn.env.inc.php (107) _CRNRSTN_ENV_KEY: ".$_SESSION[$this->oSESSION_MGR->configSerial.'CRNRSTN'.crc32('_CRNRSTN_ENV_KEY')]);
					#error_log("crnrstn.env.inc.php (108) log_profl_ARRAY: ".$this->log_profl_ARRAY[self::$resourceKey].",log_endpt_ARRAY: ".$this->log_endpt_ARRAY[self::$resourceKey]);
					//
					// INSTANTIATE ENVIRONMENTAL IP ACCESS AUTHORIZATION MANAGEMENT CLASS OBJECT AND CLONE FROM CRNRSTN
					if(!isset($this->oCRNRSTN_IPSECURITY_MGR)){
						#error_log("crnrstn.env.inc.php (113) clientIpAddress: ".$oCRNRSTN->oCRNRSTN_IPSECURITY_MGR->clientIpAddress());
						$this->oCRNRSTN_IPSECURITY_MGR = new crnrstn_ip_auth_manager($oCRNRSTN->oCRNRSTN_IPSECURITY_MGR->clientIpAddress());
					}
					
					$this->oCRNRSTN_IPSECURITY_MGR = clone $oCRNRSTN->oCRNRSTN_IPSECURITY_MGR;
					unset($oCRNRSTN->oCRNRSTN_IPSECURITY_MGR);
					
					//
					// PROCESS IP ADDRESS ACCESS AND RESTRICTION FOR SELECTED ENVIRONMENT
					$this->grant_accessIP_ARRAY =  $oCRNRSTN->grant_accessIP_ARRAY;
					if(is_file($this->grant_accessIP_ARRAY[self::$resourceKey])){
						#error_log("crnrstn.env.inc.php (63) Processing grant exclusive access include file :: ".$this->grant_accessIP_ARRAY[self::$resourceKey]);
						//
						// EXTRACT ACCESS-BY-IP AUTHORIZATION PROFILE FROM FILE
						include_once($this->grant_accessIP_ARRAY[self::$resourceKey]);
							
					}else{
						//
						// SEND DATABASE CONFIGURATION PARAMETERS TO THE CONNECTION MANAGER
						#error_log("crnrstn.env.inc.php (131) We have IPs to process for env ".self::$resourceKey." and NOT an include file...see: ".$this->grant_accessIP_ARRAY[self::$resourceKey]);
						$this->oCRNRSTN_IPSECURITY_MGR->grantAccessWKey(self::$resourceKey, $this->grant_accessIP_ARRAY[self::$resourceKey]);
					}
					
					//
					//	PROCESS ACCESS RESTRICTIONS
					$this->deny_accessIP_ARRAY =  $oCRNRSTN->deny_accessIP_ARRAY;
					if(is_file($this->deny_accessIP_ARRAY[self::$resourceKey])){
						#error_log("crnrstn.env.inc.php (92) Processing deny access include file :: ".$this->deny_accessIP_ARRAY[self::$resourceKey]);
						//
						// EXTRACT ACCESS-BY-IP AUTHORIZATION PROFILE FROM FILE
						#error_log("crnrstn.env.inc.php (142) we have include file for IP deny access.");
						include_once($this->deny_accessIP_ARRAY[self::$resourceKey]);
							
					}else{
						//
						// SEND DATABASE CONFIGURATION PARAMETERS TO THE CONNECTION MANAGER
						#error_log("crnrstn.env.inc.php (86) We have IPs to process and NOT an include file...see: ".$this->deny_accessIP_ARRAY[self::$resourceKey]);
						#error_log("crnrstn.env.inc.php (149) we have IPs for IP deny access.");
						$this->oCRNRSTN_IPSECURITY_MGR->denyAccessWKey(self::$resourceKey, $this->deny_accessIP_ARRAY[self::$resourceKey]);
					}
					
					//
					// INSTANTIATE CIPHER MANAGEMENT CLASS OBJECT AND CLONE FROM CRNRSTN
					if(!isset($this->oCRNRSTN_CIPHER_MGR)){
						#error_log("crnrstn.env.inc.php (73) passing in configSerial of ".$this->configSerial." to cipher_manager");
						$this->oCRNRSTN_CIPHER_MGR = new crnrstn_cipher_manager($this->configSerial);
					}
					
					$this->oCRNRSTN_CIPHER_MGR = clone $oCRNRSTN->oCRNRSTN_CIPHER_MGR;
					unset($oCRNRSTN->oCRNRSTN_CIPHER_MGR);
					
					#error_log("crnrstn.env.inc.php (161) resourceKey used in session name is ".self::$resourceKey." and config serial is ".$this->configSerial);
					#error_log("crnrstn.env.inc.php (162) session value: ".$_SESSION[$this->configSerial.'CRNRSTN'.self::$resourceKey.crc32('SESSION_MCRYPT_CIPHER')]);
					//
					// IF WE HAVE SESSION CIPHER FOR THIS ENVIRONMENT, SAVE
					if($_SESSION[$this->configSerial.'CRNRSTN'.self::$resourceKey.crc32('SESSION_MCRYPT_CIPHER')]!=''){
					#if($_SESSION[$this->configSerial.'CRNRSTN'.crc32('SESSION_MCRYPT_CIPHER')]!=''){
						#echo "SAVE EXISTING SESSION CIPHER - SERIAL: ".$this->configSerial." RESOURCE KEY: ".self::$resourceKey." CIPHER: ".$_SESSION['CRNRSTN'.self::$resourceKey.crc32('SESSION_MCRYPT_CIPHER')]."<br>";
						#$_SESSION[$this->configSerial.'CRNRSTN'.crc32('SESSION_MCRYPT_CIPHER')] = $_SESSION[$this->configSerial.'CRNRSTN'.self::$resourceKey.crc32('SESSION_MCRYPT_CIPHER')];
						#error_log("crnrstn.env.inc.php (131) Juggling SESSION_MCRYPT_CIPHER for what purpose...: ".$_SESSION[$this->configSerial.'CRNRSTN'.self::$resourceKey.crc32('SESSION_MCRYPT_CIPHER')]);
						$_SESSION[$this->configSerial.'CRNRSTN'.crc32('SESSION_MCRYPT_CIPHER')] = $_SESSION[$this->configSerial.'CRNRSTN'.self::$resourceKey.crc32('SESSION_MCRYPT_CIPHER')];
						#error_log("crnrstn.env.inc.php (170) SESSION_MCRYPT_CIPHER: ".$_SESSION[$this->configSerial.'CRNRSTN'.crc32('SESSION_MCRYPT_CIPHER')]);
					} 
					
					#echo "CHECK SESSION FOR COOKIE CIPHER - SERIAL: ".$this->configSerial." RESOURCE KEY: ".self::$resourceKey."<br>";
					
					//
					// IF WE HAVE COOKIE CIPHER FOR THIS ENVIRONMENT, SAVE
					if($_SESSION[$this->configSerial.'CRNRSTN'.self::$resourceKey.crc32('COOKIE_MCRYPT_CIPHER')]!=''){
					#if($_SESSION[$this->configSerial.'CRNRSTN'.crc32('COOKIE_MCRYPT_CIPHER')]!=''){
						#echo "SAVE EXISTING COOKIE CIPHER - SERIAL: ".$this->configSerial." RESOURCE KEY: ".self::$resourceKey." CIPHER: ".$_SESSION['CRNRSTN'.self::$resourceKey.crc32('COOKIE_MCRYPT_CIPHER')]."<br>";						
						#$_SESSION[$this->configSerial.'CRNRSTN'.crc32('COOKIE_MCRYPT_CIPHER')] = $_SESSION[$this->configSerial.'CRNRSTN'.self::$resourceKey.crc32('COOKIE_MCRYPT_CIPHER')];
						#error_log("crnrstn.env.inc.php (143) Juggling COOKIE_MCRYPT_CIPHER for what purpose...:".$_SESSION[$this->configSerial.'CRNRSTN'.self::$resourceKey.crc32('COOKIE_MCRYPT_CIPHER')]);
						$_SESSION[$this->configSerial.'CRNRSTN'.crc32('COOKIE_MCRYPT_CIPHER')] = $_SESSION[$this->configSerial.'CRNRSTN'.self::$resourceKey.crc32('COOKIE_MCRYPT_CIPHER')];
					}
						
					//
					// UPDATE IP ACCESS AUTHORIZATION MANAGER WITH THE RELEVANT ENVIRONMENTAL DATA
					#echo '<br>authorizeEnvAccess for '.self::$resourceKey.'<br>';
					if(!$this->oCRNRSTN_IPSECURITY_MGR->authorizeEnvAccess($this, self::$resourceKey)){
						
						//
						// WE COULD USE A MORE GRACEFUL WAY TO TRANSITION TO ERR...BUT THIS WORKS
						// THE METHOD returnSrvrRespStatus() CONTAINS SOME CUSTOM HTML FOR OUTPUT IF YOU WANT TO TWEAK IT
						#echo "NO ACCESS FOR YOU :: 403 :: ".self::$resourceKey;
						#die();
						#error_log("crnrstn.env.inc.php (196) NO ACCESS FOR YOU :: 403 :: ".self::$resourceKey);
						$this->returnSrvrRespStatus(403);
						#error_log("crnrstn.env.inc.php (198) session_destroying...");
						#session_destroy();
						exit();
					}
					
					#echo "key :: ".$this->oSESSION_MGR->getSessionKey();
					#echo "<br>";
					$this->getHandle_resource_ARRAY = $oCRNRSTN->getHandle_resource_ARRAY();
					#error_log("crnrstn.env.inc.php (170) Check sizeof getHandle_resource_ARRAY: ".sizeof($this->getHandle_resource_ARRAY));
					#echo "<br>";
					// 
					// TRANSFER DATA (JUST FOR THIS PARTICULAR ENV) FROM oCRNRSTN RESOURCE ARRAY TO oENV RESOURCE ARRAY
					foreach($this->getHandle_resource_ARRAY[$this->oSESSION_MGR->getSessionKey()] as $key=>$value){
						self::set($key, $value);
						
						$this->oSESSION_MGR->setSessionParam($key, $value);
					}
					
					//
					// INITIALIZE oENV CLASS OBJECT WITH ANY WILDCARDS
					if(isset($this->getHandle_resource_ARRAY[crc32('*')])){
					foreach($this->getHandle_resource_ARRAY[crc32('*')] as $key=>$value){
						self::set($key, $value);
						$this->oSESSION_MGR->setSessionParam($key, $value);
					}
					}
					
					//
					// INSTANTIATE ENVIRONMENTAL DB CONNECTION MANAGEMENT CLASS OBJECT AND CLONE FROM CRNRSTN
					if(!isset($this->oMYSQLI_CONN_MGR)){
						$this->oMYSQLI_CONN_MGR = new crnrstn_mysqli_conn_manager();
					}
					
					$this->oMYSQLI_CONN_MGR = clone $oCRNRSTN->oMYSQLI_CONN_MGR;
					
					//
					// INITIALIZE ENVIRONMENTAL KEY FOR SESSION PERSISTENCE
					#error_log("crnrstn.env.inc.php (194) **ALERT** Setting Session key to ".$this->oSESSION_MGR->getSessionKey());

					$this->oSESSION_MGR->setSessionKey($this->oSESSION_MGR, $this->oSESSION_MGR->getSessionKey());
					
					//
					// WE TOOK WHAT WE NEEDED FROM oCRNRSTN. FREE RESOURCES HELD BY UNNECESSARY/REDUNDANT CONFIGURATION PARAMETERS.
					unset($oCRNRSTN);
					
					//
					// UPDATE oMYSQLI CONNECTION MANAGER WITH THE RELEVANT ENVIRONMENTAL DATA
					#error_log("crnrstn.env.inc.php (204) calling setEnvironment");
					$this->oMYSQLI_CONN_MGR->setEnvironment($this);
					
					//
					// INSTANTIATE COOKIE MANAGER
					if(!isset($this->oCOOKIE_MGR)){
						$this->oCOOKIE_MGR = new crnrstn_cookie_manager($this);
					}
					
					//
					// INSTANTIATE HTTP MANAGER
					if(!isset($this->oHTTP_MGR)){
						$this->oHTTP_MGR = new crnrstn_http_manager();
					}
					
				} catch( Exception $e ) {
					//
					// SEND THIS THROUGH THE LOGGER OBJECT
					self::$oLogger->captureNotice('environmentals->__construct()', LOG_CRIT, $e->getMessage());
					
					//
					// RETURN NOTHING
					$this->returnSrvrRespStatus(500);
					die();
				}
			
			}else{
				#error_log("crnrstn.env.inc.php (275) session parameter _CRNRSTN_ENV_KEY initialized");
				//
				// INSTANTIATE SESSION MANAGER
				if(!isset($this->oSESSION_MGR)){
					$this->oSESSION_MGR = new crnrstn_session_manager($this);
					#echo '162 :: '.self::$resourceKey.$oCRNRSTN->oSESSION_MGR->getSessionKey().'<br>';
				}
				
				//
				// INSTANTIATE ENVIRONMENTAL IP ACCESS AUTHORIZATION MANAGEMENT CLASS OBJECT AND CLONE FROM CRNRSTN
				if(!isset($this->oCRNRSTN_IPSECURITY_MGR)){
					$this->oCRNRSTN_IPSECURITY_MGR = new crnrstn_ip_auth_manager($oCRNRSTN->oCRNRSTN_IPSECURITY_MGR->clientIpAddress());
				}
				
				$this->oCRNRSTN_IPSECURITY_MGR = clone $oCRNRSTN->oCRNRSTN_IPSECURITY_MGR;
				unset($oCRNRSTN->oCRNRSTN_IPSECURITY_MGR);
				########################
				self::$resourceKey = $oCRNRSTN->getServerEnv();
				//
				// PROCESS IP ADDRESS ACCESS AND RESTRICTION FOR SELECTED ENVIRONMENT
				$this->grant_accessIP_ARRAY =  $oCRNRSTN->grant_accessIP_ARRAY;
				if(is_file($this->grant_accessIP_ARRAY[self::$resourceKey])){
					#error_log("crnrstn.env.inc.php (63) Processing grant exclusive access include file :: ".$this->grant_accessIP_ARRAY[self::$resourceKey]);
					//
					// EXTRACT ACCESS-BY-IP AUTHORIZATION PROFILE FROM FILE
					include_once($this->grant_accessIP_ARRAY[self::$resourceKey]);
						
				}else{
					//
					// SEND DATABASE CONFIGURATION PARAMETERS TO THE CONNECTION MANAGER
					#error_log("crnrstn.env.inc.php (131) We have IPs to process for env ".self::$resourceKey." and NOT an include file...see: ".$this->grant_accessIP_ARRAY[self::$resourceKey]);
					$this->oCRNRSTN_IPSECURITY_MGR->grantAccessWKey(self::$resourceKey, $this->grant_accessIP_ARRAY[self::$resourceKey]);
				}
				
				//
				//	PROCESS ACCESS RESTRICTIONS
				$this->deny_accessIP_ARRAY =  $oCRNRSTN->deny_accessIP_ARRAY;
				if(is_file($this->deny_accessIP_ARRAY[self::$resourceKey])){
					#error_log("crnrstn.env.inc.php (92) Processing deny access include file :: ".$this->deny_accessIP_ARRAY[self::$resourceKey]);
					//
					// EXTRACT ACCESS-BY-IP AUTHORIZATION PROFILE FROM FILE
					#error_log("crnrstn.env.inc.php (142) we have include file for IP deny access.");
					include_once($this->deny_accessIP_ARRAY[self::$resourceKey]);
						
				}else{
					//
					// SEND DATABASE CONFIGURATION PARAMETERS TO THE CONNECTION MANAGER
					#error_log("crnrstn.env.inc.php (86) We have IPs to process and NOT an include file...see: ".$this->deny_accessIP_ARRAY[self::$resourceKey]);
					#error_log("crnrstn.env.inc.php (149) we have IPs for IP deny access.");
					$this->oCRNRSTN_IPSECURITY_MGR->denyAccessWKey(self::$resourceKey, $this->deny_accessIP_ARRAY[self::$resourceKey]);
				}
				
				//
				// INSTANTIATE CIPHER MANAGEMENT CLASS OBJECT AND CLONE FROM CRNRSTN
				if(!isset($this->oCRNRSTN_CIPHER_MGR)){
					#error_log("crnrstn.env.inc.php (73) passing in configSerial of ".$this->configSerial." to cipher_manager");
					$this->oCRNRSTN_CIPHER_MGR = new crnrstn_cipher_manager($this->configSerial);
				}
				########################
				
				//
				// UPDATE IP ACCESS AUTHORIZATION MANAGER WITH THE RELEVANT ENVIRONMENTAL DATA
				if(!$this->oCRNRSTN_IPSECURITY_MGR->authorizeEnvAccess($this, $this->oSESSION_MGR->getSessionKey())){
					
					//
					// [##ENHANCEMENT##]WE COULD USE A MORE GRACEFUL WAY TO TRANSITION TO ERR...BUT THIS WORKS
					$this->returnSrvrRespStatus(403);
					die();
				}
				
				//
				// INSTANTIATE CIPHER MANAGEMENT CLASS OBJECT AND CLONE FROM CRNRSTN
				if(!isset($this->oCRNRSTN_CIPHER_MGR)){
					#error_log("(205) passing in configSerial of ".$this->configSerial." to cipher_manager");
					$this->oCRNRSTN_CIPHER_MGR = new crnrstn_cipher_manager($this->configSerial);
				}
				
				$this->oCRNRSTN_CIPHER_MGR = clone $oCRNRSTN->oCRNRSTN_CIPHER_MGR;
				unset($oCRNRSTN->oCRNRSTN_CIPHER_MGR);
			
				//
				// INITIALIZE ERROR REPORTING FOR THIS ENVIRONMENT
				$oCRNRSTN->initializeErrorReporting($this->oSESSION_MGR->getSessionKey());
				
				//
				// INSTANTIATE ENVIRONMENTAL DB CONNECTION MANAGEMENT CLASS OBJECT AND CLONE FROM CRNRSTN
				if(!isset($this->oMYSQLI_CONN_MGR)){
					$this->oMYSQLI_CONN_MGR = new crnrstn_mysqli_conn_manager();
				}
				
				$this->oMYSQLI_CONN_MGR = clone $oCRNRSTN->oMYSQLI_CONN_MGR;
				unset($oCRNRSTN->oMYSQLI_CONN_MGR);
				
				//
				// UPDATE oMYSQLI CONNECTION MANAGER WITH THE RELEVANT ENVIRONMENTAL DATA
				#error_log("crnrstn.env.inc.php (283) calling setEnvironment");
				$this->oMYSQLI_CONN_MGR->setEnvironment($this);
				
				//
				// INSTANTIATE COOKIE MANAGER
				if(!isset($this->oCOOKIE_MGR)){
					$this->oCOOKIE_MGR = new crnrstn_cookie_manager($this);
				}
				
				//
				// INSTANTIATE HTTP MANAGER
				if(!isset($this->oHTTP_MGR)){
					$this->oHTTP_MGR = new crnrstn_http_manager();
				}
				
				//
				// WE TOOK WHAT WE NEEDED FROM oCRNRSTN. FREE RESOURCES HELD BY UNNECESSARY/REDUNDANT CONFIGURATION PARAMETERS.
				unset($oCRNRSTN);
			}
		}
	}
	
	public function getEnvKey(){
		#error_log("crnrstn.env.inc.php (345) resourceKey: ".self::$resourceKey);
		if(isset($_SESSION['CRNRSTN_RESOURCE_KEY'])){
			return $_SESSION['CRNRSTN_RESOURCE_KEY'];
		}else{
			return self::$resourceKey;
		}
	}
	
	public function getEnvSerial(){
		return 	$this->configSerial;
	}
	
	public function set($key, $value) {
        self::$resource_ARRAY[$key] = $value;
    }
	
	public function returnSrvrRespStatus($errorCode){
		//
		// http://php.net/manual/en/function.http-response-code.php
		// Source: Wikipedia "List_of_HTTP_status_codes"
		$http_status_codes = array(100 => "Continue", 101 => "Switching Protocols", 102 => "Processing", 200 => "OK", 201 => "Created", 202 => "Accepted", 203 => "Non-Authoritative Information", 204 => "No Content", 205 => "Reset Content", 206 => "Partial Content", 207 => "Multi-Status", 300 => "Multiple Choices", 301 => "Moved Permanently", 302 => "Found", 303 => "See Other", 304 => "Not Modified", 305 => "Use Proxy", 306 => "(Unused)", 307 => "Temporary Redirect", 308 => "Permanent Redirect", 400 => "Bad Request", 401 => "Unauthorized", 402 => "Payment Required", 403 => "Forbidden", 404 => "Not Found", 405 => "Method Not Allowed", 406 => "Not Acceptable", 407 => "Proxy Authentication Required", 408 => "Request Timeout", 409 => "Conflict", 410 => "Gone", 411 => "Length Required", 412 => "Precondition Failed", 413 => "Request Entity Too Large", 414 => "Request-URI Too Long", 415 => "Unsupported Media Type", 416 => "Requested Range Not Satisfiable", 417 => "Expectation Failed", 418 => "I'm a teapot", 419 => "Authentication Timeout", 420 => "Enhance Your Calm", 422 => "Unprocessable Entity", 423 => "Locked", 424 => "Failed Dependency", 424 => "Method Failure", 425 => "Unordered Collection", 426 => "Upgrade Required", 428 => "Precondition Required", 429 => "Too Many Requests", 431 => "Request Header Fields Too Large", 444 => "No Response", 449 => "Retry With", 450 => "Blocked by Windows Parental Controls", 451 => "Unavailable For Legal Reasons", 494 => "Request Header Too Large", 495 => "Cert Error", 496 => "No Cert", 497 => "HTTP to HTTPS", 499 => "Client Closed Request", 500 => "Internal Server Error", 501 => "Not Implemented", 502 => "Bad Gateway", 503 => "Service Unavailable", 504 => "Gateway Timeout", 505 => "HTTP Version Not Supported", 506 => "Variant Also Negotiates", 507 => "Insufficient Storage", 508 => "Loop Detected", 509 => "Bandwidth Limit Exceeded", 510 => "Not Extended", 511 => "Network Authentication Required", 598 => "Network read timeout error", 599 => "Network connect timeout error");
		
		#http_response_code($errorCode);
		#session_destroy();
		header('HTTP/1.1 '.$errorCode.' '.$http_status_codes[$errorCode]);
		
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<title>'.$errorCode.' '.$http_status_codes[$errorCode].'</title>
<style type="text/css">
<!--
body{margin:0;font-size:.7em;font-family:Verdana, Arial, Helvetica, sans-serif;background:#EEEEEE;}
fieldset{padding:0 15px 10px 15px;} 
h1{font-size:2.4em;margin:0;color:#FFF;}
h2{font-size:1.7em;margin:0;color:#CC0000;} 
h3{font-size:1.2em;margin:10px 0 0 0;color:#000000;} 
#header{width:96%;margin:0 0 0 0;padding:6px 2% 6px 2%;font-family:"trebuchet MS", Verdana, sans-serif;color:#FFF;
background-color:#555555;}
#content{margin:0 0 0 2%;position:relative;}
.content-container{background:#FFF;width:96%;margin-top:8px;padding:10px;position:relative;}
-->
</style>
</head>
<body>
<div id="header"><h1>Server Error</h1></div>
<div id="content">
 <div class="content-container"><fieldset>
  <h2>'.$errorCode.' '.$http_status_codes[$errorCode].'</h2>
 </fieldset></div>
</div>
</body>
</html>';
		
		exit();
	}
	
    public function get($key) {

		//
		// PULL FROM SESSION CACHE
		return $this->oSESSION_MGR->getSessionParam($key);
		
//		if($this->oSESSION_MGR->getSessionParam($key)!=''){
//			#echo '<br>success :: '.$key.' -- '.self::$sessionController->getSessionParam($key).'<br>';
//			error_log("KEY: ".$key." VALUE: ".$this->oSESSION_MGR->getSessionParam($key));
//			return $this->oSESSION_MGR->getSessionParam($key);
//		}else{
//			
//			//
//			// UNABLE TO USE SESSION CACHE. ATTEMPT TO EXTRACT FROM CONFIG
//			try{
//				if(array_key_exists($key, self::$resource_ARRAY)){
//					return self::$resource_ARRAY[$key];
//				}else{
//					//
//					// HOOOSTON...VE HAF PROBLEM!
//					throw new Exception('Environmental !!config data access error :: environmentals object::get() failed to locate an initialized resource key ('.$key.'), so no data for that parameter could be returned on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].').');
//				}
//				
//			} catch( Exception $e ) {
//				if(!isset(self::$oLogger)){
//					self::$oLogger = new crnrstn_logging();
//				}
//				
//				//
//				// SEND THIS THROUGH THE LOGGER OBJECT
//				self::$oLogger->captureNotice('environmentals->get()', LOG_ERR, $e->getMessage());
//				
//				//
//				// RETURN NOTHING
//				return false;
//			}
//		}
    }
	
	//
	// RETURN HTTP/S PATH OF CURRENT SCRIPT
	public function currentLocation(){
		if($_SERVER['HTTPS']){
			self::$requestProtocol='https://';
		}else{
			self::$requestProtocol='http://';
		}
		
		return self::$requestProtocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	}
	
	//
	// RETURN INDICATION OF ENVIRONMENTAL CONFIGURATION
	public function isConfigured($oCRNRSTN){
		
		$this->configSerial = $oCRNRSTN->configSerial;
		
		//
		// INSTANTIATE SESSION MANAGER
		if(!isset($this->oSESSION_MGR)){
			$this->oSESSION_MGR = new crnrstn_session_manager($this);
		}
		
		#if(isset($_SESSION[$this->configSerial.'CRNRSTN'.crc32('_CRNRSTN_ENV_KEY')])){
		if(3==2){
		#if($this->oSESSION_MGR->issetSessionParam('_CRNRSTN_ENV_KEY') && $this->oSESSION_MGR->getSessionParam('_CRNRSTN_ENV_KEY')!=''){
			#error_log("crnrstn.env.inc.php (472) Running isConfigured(oCRNRSTN) and _CRNRSTN_ENV_KEY is set to: ".$_SESSION[$this->oSESSION_MGR->configSerial.'CRNRSTN'.crc32('_CRNRSTN_ENV_KEY')]." :: ".$this->configSerial);
			self::$resourceKey = $oCRNRSTN->getServerEnv();
			//
			// INSTANTIATE ENVIRONMENTAL IP ACCESS AUTHORIZATION MANAGEMENT CLASS OBJECT AND CLONE FROM CRNRSTN
			if(!isset($this->oCRNRSTN_IPSECURITY_MGR)){
				$this->oCRNRSTN_IPSECURITY_MGR = new crnrstn_ip_auth_manager($oCRNRSTN->oCRNRSTN_IPSECURITY_MGR->clientIpAddress());
			}
			
			$this->oCRNRSTN_IPSECURITY_MGR = clone $oCRNRSTN->oCRNRSTN_IPSECURITY_MGR;
			unset($oCRNRSTN->oCRNRSTN_IPSECURITY_MGR);
			
			//
			// UPDATE IP ACCESS AUTHORIZATION MANAGER WITH THE RELEVANT ENVIRONMENTAL DATA
			#error_log("crnrstn.env.inc.php (469) Calling authorizeEnvAccess from isConfigured()...");
			if(!$this->oCRNRSTN_IPSECURITY_MGR->authorizeEnvAccess($this, $this->oSESSION_MGR->getSessionKey())){
				//
				// IF NOT AUTHORIZED, RETURN FALSE TO FORCE RECONFIGURATION OF CRNRSTN
				#error_log("crnrstn.env.inc.php (469) authorizeEnvAccess :: I'm false");
				return false;
			}
			
			//
			// INSTANTIATE CIPHER MANAGEMENT CLASS OBJECT AND CLONE FROM CRNRSTN
			if(!isset($this->oCRNRSTN_CIPHER_MGR)){
				#error_log("crnrstn.env.inc.php (363) passing in configSerial of ".$this->configSerial." to cipher_manager");
				$this->oCRNRSTN_CIPHER_MGR = new crnrstn_cipher_manager($this->configSerial);
			}
			
			$this->oCRNRSTN_CIPHER_MGR = clone $oCRNRSTN->oCRNRSTN_CIPHER_MGR;
			unset($oCRNRSTN->oCRNRSTN_CIPHER_MGR);
			
			#echo '<br>resourcekey is '.self::$resourceKey.'<br>sessionKey in session is '.$this->oSESSION_MGR->getSessionKey().'<br>';
			//
			// INITIALIZE ERROR REPORTING FOR THIS ENVIRONMENT
			$oCRNRSTN->initializeErrorReporting($this->oSESSION_MGR->getSessionKey());
					
			
			//
			// INSTANTIATE ENVIRONMENTAL DB CONNECTION MANAGEMENT CLASS OBJECT AND CLONE FROM CRNRSTN
			if(!isset($this->oMYSQLI_CONN_MGR)){
				$this->oMYSQLI_CONN_MGR = new crnrstn_mysqli_conn_manager();
			}
			
			$this->oMYSQLI_CONN_MGR = clone $oCRNRSTN->oMYSQLI_CONN_MGR;
			unset($oCRNRSTN->oMYSQLI_CONN_MGR);
			
			//
			// UPDATE oMYSQLI CONNECTION MANAGER WITH THE RELEVANT ENVIRONMENTAL DATA
			#error_log("crnrstn.env.inc.php (445) calling setEnvironment");
			$this->oMYSQLI_CONN_MGR->setEnvironment($this);
			
			//
			// INSTANTIATE COOKIE MANAGER
			if(!isset($this->oCOOKIE_MGR)){
				$this->oCOOKIE_MGR = new crnrstn_cookie_manager($this);
			}
			
			//
			// INSTANTIATE HTTP MANAGER
			if(!isset($this->oHTTP_MGR)){
				$this->oHTTP_MGR = new crnrstn_http_manager();
			}
			
			//
			// WE TOOK WHAT WE NEEDED FROM oCRNRSTN. FREE RESOURCES HELD BY UNNECESSARY/REDUNDANT CONFIGURATION PARAMETERS.
			unset($oCRNRSTN);
		
			return true;
		}else{
			#error_log("crnrstn.env.inc.php (466) Ran isConfigured(oCRNRSTN) and _CRNRSTN_ENV_KEY is NOT set in session.");
			return false;
		}
	}

	public function __destruct() {
		
	}
}
?>