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

class crnrstn_soap_manager {
	public $result;
	
	private static $cache;
	private static $wsdl;
	private static $client;
	private static $err;
	
	private static $tmpWSDL;
	private static $tmpTTL;
	private static $oLogger;
	private static $oSoapEnvironment;
	
	public function __construct($userEnv,$wsdl_uri_key,$cache_ttl_key) {
	
		self::$oSoapEnvironment = $userEnv;
		
		//
		// INSTANTIATE LOGGER
		if(!isset(self::$oLogger)){
			self::$oLogger = new crnrstn_logging();
		}
		
		//
		// INITIALIZE THE WSDL
		self::$tmpWSDL = self::$oSoapEnvironment->get($wsdl_uri_key);
		self::$tmpTTL =  self::$oSoapEnvironment->get($cache_ttl_key);
		if(self::$tmpWSDL!=self::$oSoapEnvironment->currentLocation()){	// AVOID INIFINITE LOOP WHERE WEB SERVICE STANDS ON CRNRSTN
			try{
				# # # # # # # # # # # # # # # # # # # #
				# INSPIRATION :: WDSLCLIENT4.PHP,v 1.6 2005/05/12 21:42:06 SNICHOL EEP
				# WSDL CLIENT SAMPLE, BASED ON SOAP BUILDERS ROUND 2 INTEROP
				# SERVICE :: WSDL || PAYLOAD :: RPC/ENCODED || TRANSPORT :: HTTP || AUTHENTICATION :: NONE
				# # # # # # # # # # # # # # # # # # # #
				#error_log("crnrstn.soap.inc.php (40) tmpWSDL value: ".self::$tmpWSDL);
				self::$cache = new wsdlcache('.',self::$tmpTTL);
				self::$wsdl = self::$cache->get(self::$tmpWSDL);
				
				if (is_null(self::$wsdl)) {
					self::$wsdl = new wsdl(self::$tmpWSDL);
					
					self::$err = self::$wsdl->getError();
					if (self::$err) {
						//
						// HOOOSTON...VE HAF PROBLEM!
						throw new Exception('WSDL Constructor Error :: '.self::$err.' :: WSDL :: '.self::$tmpWSDL);
					}
					
					self::$cache->put(self::$wsdl);
					
				} else {
					self::$wsdl->clearDebug();
					self::$wsdl->debug('Retrieved from cache');
				}
				
				//
				// INSTANTIATE SOAP CLIENT
				self::$client = new nusoap_client(self::$wsdl, true);
	
				self::$err = self::$client->getError();
				if (self::$err) {
					//
					// HOOOSTON...VE HAF PROBLEM!
					throw new Exception('SOAP Client Constructor Error :: '.self::$err);
				}
				
				self::$client->setUseCurl(self::$oSoapEnvironment->get('NUSOAP_USECURL'));
				
			} catch ( Exception $e ) {
				//
				// SEND THIS THROUGH THE LOGGER OBJECT
				self::$oLogger->captureNotice('CRNRSTN Error Notification :: soap initialization failed', LOG_NOTICE, $e->getMessage());
				
				return false;
			}
		}
	}
	
	//
	// RECEIVE METHOD NAME + PARAMETERS AND SEND SOAP REQUEST TO WEB SERVICE
	public function returnContent($methodName,$params){
		
		//
		// SEND SOAP REQUEST
		try{
			$this->result = self::$client->call($methodName, $params);
			
			//
			// CHECK FOR A FAULT
			if (self::$client->fault) {
				//
				// HOOOSTON...VE HAF PROBLEM!
				throw new Exception('SOAP Client returnContent() Fault :: '.$this->result);
				
			} else {
				//
				// CHECK FOR ERRORS
				self::$err = self::$client->getError();
				
				if (self::$err) {
					//
					// HOOOSTON...VE HAF PROBLEM!
					#error_log("*** WE HAVE SOAP ERROR HERE *** returnClientResponse: ".$this->returnClientResponse());
					throw new Exception('SOAP Client returnContent() Error :: '.self::$err);
					
				} else {
					//
					// RETURN RESULT
					return $this->result;			
				}
			}
			
		}catch( Exception $e ) {
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('session_manager->returnContent()', LOG_ERR, $e->getMessage());
		}
		
		return $this->result;
	}
	
	public function returnFault(){
		return self::$client->fault;
	}
	
	public function returnError(){
		return self::$client->getError();
	}
	
	public function returnResult(){
		return $this->result;
	}
	
	public function returnClientRequest(){
		return self::$client->request;
	}
	
	public function returnClientResponse(){
		return self::$client->response;
	}
	
	public function returnClientGetDebug(){
		return self::$client->getDebug();
	}
	
	public function __destruct() {

	}
}

?>