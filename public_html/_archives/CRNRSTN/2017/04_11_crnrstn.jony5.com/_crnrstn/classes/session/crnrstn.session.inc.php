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

/*
	In order to kill the session altogether, like to log the user out, the session id must also be unset. If a cookie 
	is used to propagate the session id (default behavior), then the session cookie must be deleted. setcookie() may be 
	used for that.
*/

class crnrstn_session_manager {

	//
	// SERIAL AND ENCRYPTION KEY FOR CRNRSTN SESSION VALUES
	public $configSerial;
	private static $cacheSessionParam_ARRAY = array();
	private static $CRNRSTN_ENCRYPT_NACL;
	private static $CRNRSTN_ENCRYPT_CIPHER;
	
	private static $oLogger;
	private static $oCOOKIE_MGR;
	private static $encryptableDataTypes = array();
	private static $oSessionEnvironment;
	
	public function __construct($oENV=NULL){
		
		//
		// INSTANTIATE LOGGER
		if(!isset(self::$oLogger)){
			self::$oLogger = new crnrstn_logging();
		}
		
		if(isset($oENV)){
			self::$oSessionEnvironment = $oENV;
			
			//
			// INITIALIZE CONFIG SERIAL FOR SESSION SERIALIZATION
			$this->configSerial = self::$oSessionEnvironment->configSerial;	
			
			//
			// BEFORE SETTING SESSION NACL, NEED TO CHECK TO SEE IF MATCHES EXISTING.
			// IF DIFFERENT, NEED TO ITERATE THROUGH ALL SESSION PARAMS TO RE-ENCRYPT WITH NEW NACL
			// IF NACL CHANGES W/O UPDATE TO SESSION ENCRYPTED DATA, ALL DATA WILL BECOME GARBAGE.
			$tmp_key = self::$oSessionEnvironment->getEnvKey();
			#error_log("crnrstn.session.inc.php (66) tmp_key: ".$tmp_key);
			if($tmp_key!=''){
				#error_log("crnrstn.session.inc.php (44) Set session key to ".$tmp_key);
				self::$CRNRSTN_ENCRYPT_NACL = $tmp_key;
				$_SESSION['CRNRSTN_ENCRYPT_NACL'] = self::$CRNRSTN_ENCRYPT_NACL;
				#error_log("crnrstn.session.inc.php (70) **ALERT** Setting session key to value of: ".self::$CRNRSTN_ENCRYPT_NACL);
				$this->setSessionKey($this, self::$CRNRSTN_ENCRYPT_NACL);
			}
		}
		
		//
		// INITIALIZE ARRAY OF ENCRYPTABLE DATATYPES
		self::$encryptableDataTypes = array('string','integer','double','float','int');
		
		//
		// INITIALIZE CONFIG SERIAL FOR SESSION SERIALIZATION
		$this->configSerial = self::$oSessionEnvironment->getEnvSerial();
		#error_log("************".$this->configSerial."*************");
	}
	
	public function setSessionParam($sessParam, $val){
		#error_log("crnrstn.session.inc.php (86) Setting a session param (".$sessParam.") with value (".$val.") and config serial: ".$this->configSerial);
		if(!isset($_SESSION[$this->configSerial.'CRNRSTN'.crc32('SESSION_MCRYPT_CIPHER')])){
			//
			// NO ENCRYPTION
			#error_log("crnrstn.session.inc.php (90) NO ENCRYPTION!");
			$_SESSION[$this->configSerial.'CRNRSTN'.crc32('SESSION_MCRYPT_CIPHER')] = crc32('CLEARTEXT');
		
		}
		
		if(in_array(gettype($val),self::$encryptableDataTypes)){
			//
			// UPDATE THE SESSION PARAMETER WITH THE VALUE
			#error_log("crnrstn.session.inc.php (98) Encrypt parameter ".$sessParam." in session with value: ".$val);
			#self::$cacheSessionParam_ARRAY[$sessParam] = trim($val);
			#error_log("crnrstn.session.inc.php (101) Value of cache for ".$sessParam.": ".self::$cacheSessionParam_ARRAY[$sessParam]);
			//
			// CLEAR POTENTIAL CACHE TO FORCE REFRESH
			unset(self::$cacheSessionParam_ARRAY[$sessParam]);
			$_SESSION[$this->configSerial.'CRNRSTN'.crc32($sessParam)] = $this->sessionParamEncrypt($val);
			$_SESSION[$this->configSerial.'CRNRSTN_ENCRYPT'.crc32($sessParam)] = 1;
			$_SESSION[$this->configSerial.'CRNRSTN_DTYPE'.crc32($sessParam)] = gettype($val);
			
		}else{
			//
			// NOT ENCRYPTABLE
			#self::$cacheSessionParam_ARRAY[$sessParam] = trim($val);
			unset(self::$cacheSessionParam_ARRAY[$sessParam]);
			$_SESSION[$this->configSerial.'CRNRSTN'.crc32($sessParam)] = $val;
			$_SESSION[$this->configSerial.'CRNRSTN_ENCRYPT'.crc32($sessParam)] = 0;
		}

		return true;
	}
	
	public function getSessionParam($sessParam){
		
		#echo "Getting a session param using config serial: ".$this->configSerial."<br>";
		#error_log("********** getSessionParam THIS PARAM: ".$sessParam." ************");
		//
		// RETURN THE VALUE ASSIGNED TO A PARTICULAR SESSION PARAMETER
		if(isset($_SESSION[$this->configSerial.'CRNRSTN'.crc32($sessParam)])){
			if($_SESSION[$this->configSerial.'CRNRSTN_ENCRYPT'.crc32($sessParam)]>0){
				switch($_SESSION[$this->configSerial.'CRNRSTN_DTYPE'.crc32($sessParam)]){
					case 'string':
						if(isset(self::$cacheSessionParam_ARRAY[$sessParam])){
							#error_log("/crnrstn/ crnrstn.session.inc.php (103) Using private static array for ".$sessParam);
							return self::$cacheSessionParam_ARRAY[$sessParam];
						}else{
							#error_log("/crnrstn/ crnrstn.session.inc.php (106) Using sessionParamDecrypt for ".$sessParam);
							self::$cacheSessionParam_ARRAY[$sessParam] = trim($this->sessionParamDecrypt($_SESSION[$this->configSerial.'CRNRSTN'.crc32($sessParam)], $_SESSION[$this->configSerial.'CRNRSTN'.crc32('SESSION_MCRYPT_CIPHER')]));
							return self::$cacheSessionParam_ARRAY[$sessParam];
						}
					break;
					case 'integer':
						if(isset(self::$cacheSessionParam_ARRAY[$sessParam])){
							return (integer) self::$cacheSessionParam_ARRAY[$sessParam];
						}else{
							self::$cacheSessionParam_ARRAY[$sessParam] = trim($this->sessionParamDecrypt($_SESSION[$this->configSerial.'CRNRSTN'.crc32($sessParam)], $_SESSION[$this->configSerial.'CRNRSTN'.crc32('SESSION_MCRYPT_CIPHER')]));
							return (integer) self::$cacheSessionParam_ARRAY[$sessParam];
						}
					break;
					case 'int':
						if(isset(self::$cacheSessionParam_ARRAY[$sessParam])){
							return (int) self::$cacheSessionParam_ARRAY[$sessParam];
						}else{
							self::$cacheSessionParam_ARRAY[$sessParam] = trim($this->sessionParamDecrypt($_SESSION[$this->configSerial.'CRNRSTN'.crc32($sessParam)], $_SESSION[$this->configSerial.'CRNRSTN'.crc32('SESSION_MCRYPT_CIPHER')]));
							return (int) self::$cacheSessionParam_ARRAY[$sessParam];
						}
					break;
					case 'double':
						if(isset(self::$cacheSessionParam_ARRAY[$sessParam])){
							return (double) self::$cacheSessionParam_ARRAY[$sessParam];
						}else{
							self::$cacheSessionParam_ARRAY[$sessParam] = trim($this->sessionParamDecrypt($_SESSION[$this->configSerial.'CRNRSTN'.crc32($sessParam)], $_SESSION[$this->configSerial.'CRNRSTN'.crc32('SESSION_MCRYPT_CIPHER')]));
							return (double) self::$cacheSessionParam_ARRAY[$sessParam];
						}
					break;
					case 'float':
						if(isset(self::$cacheSessionParam_ARRAY[$sessParam])){
							return (float) self::$cacheSessionParam_ARRAY[$sessParam];
						}else{
							self::$cacheSessionParam_ARRAY[$sessParam] = trim($this->sessionParamDecrypt($_SESSION[$this->configSerial.'CRNRSTN'.crc32($sessParam)], $_SESSION[$this->configSerial.'CRNRSTN'.crc32('SESSION_MCRYPT_CIPHER')]));
							return (float) self::$cacheSessionParam_ARRAY[$sessParam];
						}
					break;
				}
			
			}else{
				return $_SESSION[$this->configSerial.'CRNRSTN'.crc32($sessParam)];
			}
		}else{
			#error_log("crnrstn.session.inc.php (169) return false");
			return false;
		}
	}

	public function issetSessionParam($sessParam){
		#echo "Checking if issetSessionParam using config serial: ".$this->configSerial."<br>";
		#error_log("crnrstn.session.inc.php (128) Checking issetSessionParam on ".$sessParam." with config serial ".$this->configSerial);
		if(isset($_SESSION[$this->configSerial.'CRNRSTN'.crc32($sessParam)])){
			#error_log("crnrstn.session.inc.php (130) issetSessionParam on ".$sessParam." evaluated to TRUE with value of: ".$_SESSION[$this->configSerial.'CRNRSTN'.crc32($sessParam)]);
			return true;
		}else{
			#error_log("crnrstn.session.inc.php (133) issetSessionParam on ".$sessParam." evaluated to FALSE");
			return false;
		}
	}
	
	public function setSessionKey($oSESSION_MGR, $val){
		#echo '<br>setSessionKey() called storing value of '.$val.' with session serial '.$oSESSION_MGR->configSerial.'<br>';
		#error_log("crnrstn.session.inc.php (189) setting param _CRNRSTN_ENV_KEY to value of ".$val);
		$_SESSION[$oSESSION_MGR->configSerial.'CRNRSTN'.crc32('_CRNRSTN_ENV_KEY')] = $val;
		#$oSESSION_MGR->setSessionParam('_CRNRSTN_ENV_KEY',$val);
	}
	
	public function getSessionKey(){
		#error_log("crnrstn.session.inc.php (146) **************** getSessionKey ****************** _CRNRSTN_ENV_KEY: ".$_SESSION[$this->configSerial.'CRNRSTN'.crc32('_CRNRSTN_ENV_KEY')]);
		#echo "Getting getSessionKey with session serial ".$this->configSerial." and returning :: ".$_SESSION[$this->configSerial.'CRNRSTN'.crc32('_CRNRSTN_ENV_KEY')]."<br>";
		return $_SESSION[$this->configSerial.'CRNRSTN'.crc32('_CRNRSTN_ENV_KEY')];
		#return $this->getSessionParam('_CRNRSTN_ENV_KEY');
	}
	
	public function getSessionNACL(){
		return self::$CRNRSTN_ENCRYPT_NACL;
	}
	
	public function setSessionIp($key, $ip){
		$_SESSION[$this->configSerial.'CRNRSTN'.crc32($key)] = md5($ip);
	}
	
	public function getSessionIp(){
		if(isset($_SESSION[$this->configSerial.'CRNRSTN'.crc32('SESSION_IP')])){
			return $_SESSION[$this->configSerial.'CRNRSTN'.crc32('SESSION_IP')];
		}else{
			return false;
		}
	}

	private function sessionParamEncrypt($val){
		
		$ALGORITHM=$_SESSION[$this->configSerial.'CRNRSTN'.crc32('SESSION_MCRYPT_CIPHER')];
		#error_log("crnrstn.session.inc.php (220) sessionParamEncrypt Algorithm: ".$ALGORITHM."|Value: ".$val);

		try{
			switch($ALGORITHM){
				case crc32("CLEARTEXT"):
					return $val;
				break;
				case crc32("cast-128"):
					return base64_encode(mcrypt_encrypt(MCRYPT_CAST_128, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_CAST_128, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
				break;
				case crc32("gost"):
					#error_log("(231) [ENCRYPT]  Inside ALGORITHM gost CRNRSTN_ENCRYPT_NACL: ".self::$CRNRSTN_ENCRYPT_NACL);
					return base64_encode(mcrypt_encrypt(MCRYPT_GOST, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_GOST, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
				break;
				case crc32("rijndael-128"):
					return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
				break;
				case crc32("twofish"):
					return base64_encode(mcrypt_encrypt(MCRYPT_TWOFISH, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_TWOFISH, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
				break;
				case crc32("cast-256"):
					return base64_encode(mcrypt_encrypt(MCRYPT_CAST_256, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_CAST_256, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
				break;
				case crc32("loki97"):
					return base64_encode(mcrypt_encrypt(MCRYPT_LOKI97, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_LOKI97, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
				break;
				case crc32("rijndael-192"):
					return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_192, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_192, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
				break;
				case crc32("saferplus"):
					return base64_encode(mcrypt_encrypt(MCRYPT_SAFERPLUS, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_SAFERPLUS, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
				break;
				case crc32("wake"):
					return base64_encode(mcrypt_encrypt(MCRYPT_WAKE, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_WAKE, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
				break;
				case crc32("blowfish-compat"):
					return base64_encode(mcrypt_encrypt(MCRYPT_BLOWFISH_COMPAT, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_BLOWFISH_COMPAT, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
				break;
				case crc32("des"):
					return base64_encode(mcrypt_encrypt(MCRYPT_3DES, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_3DES, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
				break;
				case crc32("rijndael-256"):
					return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
				break;
				case crc32("serpent"):
					return base64_encode(mcrypt_encrypt(MCRYPT_SERPENT, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_SERPENT, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
				break;
				case crc32("xtea"):
					return base64_encode(mcrypt_encrypt(MCRYPT_XTEA, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_XTEA, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
				break;
				case crc32("blowfish"):
					return base64_encode(mcrypt_encrypt(MCRYPT_BLOWFISH, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
				break;
				case crc32("enigma"):
					return base64_encode(mcrypt_encrypt(MCRYPT_ENIGMA, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_ENIGMA, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
				break;
				case crc32("rc2"):
					return base64_encode(mcrypt_encrypt(MCRYPT_RC2, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RC2, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
				break;
				case crc32("tripledes"):
					return base64_encode(mcrypt_encrypt(MCRYPT_TRIPLEDES, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_TRIPLEDES, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
				break;
				case crc32("arcfour"):
					return base64_encode(mcrypt_encrypt(MCRYPT_ARCFOUR, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_ARCFOUR, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
				break;
				default:
					//
					// HOOOSTON...VE HAF PROBLEM!
					throw new Exception('CRNRSTN Session Management Notice :: A mcrypt cipher encoding method could not be found for the provided cipher name ('.$ALGORITHM.').');
				break;	
			}
		}catch( Exception $e ) {
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('session_manager->sessionParamEncrypt()', LOG_EMERG, $e->getMessage());
		}
	}
	 
	private function sessionParamDecrypt($val){
	
		$ALGORITHM = $_SESSION[$this->configSerial.'CRNRSTN'.crc32('SESSION_MCRYPT_CIPHER')];
		#error_log("crnrstn.session.inc.php (301) sessionParamDecrypt Algorithm: ".$ALGORITHM."|Val: ".$val);
		try{
			switch($ALGORITHM){
				case crc32("CLEARTEXT"):
					return $val;
				break;
				case crc32("cast-128"):
					return mcrypt_decrypt(MCRYPT_CAST_128,  $_SESSION['CRNRSTN_ENCRYPT_NACL'], base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_CAST_128, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("gost"):
					#error_log("(311) [DECRYPT] Inside ALGORITHM gost private static CRNRSTN_ENCRYPT_NACL: ".self::$CRNRSTN_ENCRYPT_NACL);
					#error_log("(313) SESSION stored CRNRSTN_ENCRYPT_NACL: ".$_SESSION['CRNRSTN_ENCRYPT_NACL']);
					return mcrypt_decrypt(MCRYPT_GOST, $_SESSION['CRNRSTN_ENCRYPT_NACL'], base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_GOST, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("rijndael-128"):
					return mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $_SESSION['CRNRSTN_ENCRYPT_NACL'], base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("twofish"):
					return mcrypt_decrypt(MCRYPT_TWOFISH, $_SESSION['CRNRSTN_ENCRYPT_NACL'], base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_TWOFISH, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("cast-256"):
					return mcrypt_decrypt(MCRYPT_CAST_256, $_SESSION['CRNRSTN_ENCRYPT_NACL'], base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_CAST_256, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("loki97"):
					return mcrypt_decrypt(MCRYPT_LOKI97, $_SESSION['CRNRSTN_ENCRYPT_NACL'], base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_LOKI97, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("rijndael-192"):
					return mcrypt_decrypt(MCRYPT_RIJNDAEL_192, $_SESSION['CRNRSTN_ENCRYPT_NACL'], base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_192, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("saferplus"):
					return mcrypt_decrypt(MCRYPT_SAFERPLUS, $_SESSION['CRNRSTN_ENCRYPT_NACL'], base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_SAFERPLUS, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("wake"):
					return mcrypt_decrypt(MCRYPT_WAKE, $_SESSION['CRNRSTN_ENCRYPT_NACL'], base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_WAKE, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("blowfish-compat"):
					return mcrypt_decrypt(MCRYPT_BLOWFISH_COMPAT, $_SESSION['CRNRSTN_ENCRYPT_NACL'], base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_BLOWFISH_COMPAT, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("des"):
					return mcrypt_decrypt(MCRYPT_3DES, $_SESSION['CRNRSTN_ENCRYPT_NACL'], base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_3DES, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("rijndael-256"):
					return mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $_SESSION['CRNRSTN_ENCRYPT_NACL'], base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("serpent"):
					return mcrypt_decrypt(MCRYPT_SERPENT, $_SESSION['CRNRSTN_ENCRYPT_NACL'], base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_SERPENT, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("xtea"):
					return mcrypt_decrypt(MCRYPT_XTEA, $_SESSION['CRNRSTN_ENCRYPT_NACL'], base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_XTEA, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("blowfish"):
					return mcrypt_decrypt(MCRYPT_BLOWFISH, $_SESSION['CRNRSTN_ENCRYPT_NACL'], base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("enigma"):
					return mcrypt_decrypt(MCRYPT_ENIGMA, $_SESSION['CRNRSTN_ENCRYPT_NACL'], base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_ENIGMA, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("rc2"):
					#error_log("crnrstn.session.inc.php (355) CRNRSTN_ENCRYPT_NACL: ".$_SESSION['CRNRSTN_ENCRYPT_NACL']);
					return mcrypt_decrypt(MCRYPT_RC2, $_SESSION['CRNRSTN_ENCRYPT_NACL'], base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RC2, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("tripledes"):
					return mcrypt_decrypt(MCRYPT_TRIPLEDES, $_SESSION['CRNRSTN_ENCRYPT_NACL'], base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_TRIPLEDES, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("arcfour"):
					return mcrypt_decrypt(MCRYPT_ARCFOUR, $_SESSION['CRNRSTN_ENCRYPT_NACL'], base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_ARCFOUR, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
			
				default:
					//
					// HOOOSTON...VE HAF PROBLEM!
					throw new Exception('CRNRSTN Session Management Notice :: A mcrypt cipher decoding method could not be found for the provided cipher name ('.$ALGORITHM.').');
			}
			
		}catch( Exception $e ) {
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('session_manager->sessionParamDecrypt()', LOG_EMERG, $e->getMessage());
		}
	}

	public function cookieParamEncrypt($val){
		
		try{
			//
			// CHECK INITIALIZATION OF COOKIE CIPHER. IF IT HAS NOT BEEN SET, GO TO ERROR
			
			#error_log("crnrstn.session.inc.php (330) configSerial for cookie mcrypt cipher: ".$this->configSerial);
			if(!isset($_SESSION[$this->configSerial.'CRNRSTN'.crc32('COOKIE_MCRYPT_CIPHER')])){
				//
				// HOOOSTON...VE HAF PROBLEM!
				throw new Exception('CRNRSTN Cookie Management Notice :: A call to encrypt cookie information has been made, but there has been no initialization/specification of the cookie encryption algorithm.');
			}
			#echo "Value of encrypted cookie :: ".$val."<br>";
			$ALGORITHM=$_SESSION[$this->configSerial.'CRNRSTN'.crc32('COOKIE_MCRYPT_CIPHER')];
				
			try{
				switch($ALGORITHM){
					case crc32("CLEARTEXT"):
						return $val;
					break;
					case crc32("cast-128"):
						return base64_encode(mcrypt_encrypt(MCRYPT_CAST_128, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_CAST_128, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
					break;
					case crc32("gost"):
						return base64_encode(mcrypt_encrypt(MCRYPT_GOST, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_GOST, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
					break;
					case crc32("rijndael-128"):
						return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
					break;
					case crc32("twofish"):
						return base64_encode(mcrypt_encrypt(MCRYPT_TWOFISH, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_TWOFISH, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
					break;
					case crc32("cast-256"):
						return base64_encode(mcrypt_encrypt(MCRYPT_CAST_256, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_CAST_256, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
					break;
					case crc32("loki97"):
						return base64_encode(mcrypt_encrypt(MCRYPT_LOKI97, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_LOKI97, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
					break;
					case crc32("rijndael-192"):
						return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_192, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_192, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
					break;
					case crc32("saferplus"):
						return base64_encode(mcrypt_encrypt(MCRYPT_SAFERPLUS, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_SAFERPLUS, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
					break;
					case crc32("wake"):
						return base64_encode(mcrypt_encrypt(MCRYPT_WAKE, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_WAKE, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
					break;
					case crc32("blowfish-compat"):
						return base64_encode(mcrypt_encrypt(MCRYPT_BLOWFISH_COMPAT, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_BLOWFISH_COMPAT, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
					break;
					case crc32("des"):
						return base64_encode(mcrypt_encrypt(MCRYPT_3DES, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_3DES, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
					break;
					case crc32("rijndael-256"):
						return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
					break;
					case crc32("serpent"):
						return base64_encode(mcrypt_encrypt(MCRYPT_SERPENT, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_SERPENT, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
					break;
					case crc32("xtea"):
						return base64_encode(mcrypt_encrypt(MCRYPT_XTEA, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_XTEA, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
					break;
					case crc32("blowfish"):
						return base64_encode(mcrypt_encrypt(MCRYPT_BLOWFISH, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
					break;
					case crc32("enigma"):
						return base64_encode(mcrypt_encrypt(MCRYPT_ENIGMA, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_ENIGMA, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
					break;
					case crc32("rc2"):
						return base64_encode(mcrypt_encrypt(MCRYPT_RC2, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RC2, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
					break;
					case crc32("tripledes"):
						return base64_encode(mcrypt_encrypt(MCRYPT_TRIPLEDES, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_TRIPLEDES, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
					break;
					case crc32("arcfour"):
						return base64_encode(mcrypt_encrypt(MCRYPT_ARCFOUR, self::$CRNRSTN_ENCRYPT_NACL, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_ARCFOUR, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
					break;
					default:
						//
						// HOOOSTON...VE HAF PROBLEM!
						throw new Exception('CRNRSTN Cookie Management Notice :: A mcrypt cipher encoding method could not be found for the provided cipher name ('.$ALGORITHM.').');
					break;	
				}
			}catch( Exception $e ) {
				//
				// SEND THIS THROUGH THE LOGGER OBJECT
				self::$oLogger->captureNotice('session_manager->cookieParamEncrypt()', LOG_EMERG, $e->getMessage());
			}
		}catch( Exception $e ) {
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('session_manager->cookieParamEncrypt()', LOG_EMERG, $e->getMessage());
		}
	}
	 
	public function cookieParamDecrypt($val){
	
		$ALGORITHM = $_SESSION[$this->configSerial.'CRNRSTN'.crc32('COOKIE_MCRYPT_CIPHER')];

		try{
			switch($ALGORITHM){
				case crc32("CLEARTEXT"):
					return $val;
				break;
				case crc32("cast-128"):
					return mcrypt_decrypt(MCRYPT_CAST_128, self::$CRNRSTN_ENCRYPT_NACL, base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_CAST_128, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("gost"):
					return mcrypt_decrypt(MCRYPT_GOST, self::$CRNRSTN_ENCRYPT_NACL, base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_GOST, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("rijndael-128"):
					return mcrypt_decrypt(MCRYPT_RIJNDAEL_128, self::$CRNRSTN_ENCRYPT_NACL, base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("twofish"):
					return mcrypt_decrypt(MCRYPT_TWOFISH, self::$CRNRSTN_ENCRYPT_NACL, base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_TWOFISH, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("cast-256"):
					return mcrypt_decrypt(MCRYPT_CAST_256, self::$CRNRSTN_ENCRYPT_NACL, base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_CAST_256, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("loki97"):
					return mcrypt_decrypt(MCRYPT_LOKI97, self::$CRNRSTN_ENCRYPT_NACL, base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_LOKI97, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("rijndael-192"):
					return mcrypt_decrypt(MCRYPT_RIJNDAEL_192, self::$CRNRSTN_ENCRYPT_NACL, base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_192, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("saferplus"):
					return mcrypt_decrypt(MCRYPT_SAFERPLUS, self::$CRNRSTN_ENCRYPT_NACL, base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_SAFERPLUS, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("wake"):
					return mcrypt_decrypt(MCRYPT_WAKE, self::$CRNRSTN_ENCRYPT_NACL, base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_WAKE, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("blowfish-compat"):
					return mcrypt_decrypt(MCRYPT_BLOWFISH_COMPAT, self::$CRNRSTN_ENCRYPT_NACL, base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_BLOWFISH_COMPAT, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("des"):
					return mcrypt_decrypt(MCRYPT_3DES, self::$CRNRSTN_ENCRYPT_NACL, base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_3DES, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("rijndael-256"):
					return mcrypt_decrypt(MCRYPT_RIJNDAEL_256, self::$CRNRSTN_ENCRYPT_NACL, base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("serpent"):
					return mcrypt_decrypt(MCRYPT_SERPENT, self::$CRNRSTN_ENCRYPT_NACL, base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_SERPENT, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("xtea"):
					return mcrypt_decrypt(MCRYPT_XTEA, self::$CRNRSTN_ENCRYPT_NACL, base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_XTEA, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("blowfish"):
					return mcrypt_decrypt(MCRYPT_BLOWFISH, self::$CRNRSTN_ENCRYPT_NACL, base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("enigma"):
					return mcrypt_decrypt(MCRYPT_ENIGMA, self::$CRNRSTN_ENCRYPT_NACL, base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_ENIGMA, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("rc2"):
					return mcrypt_decrypt(MCRYPT_RC2, self::$CRNRSTN_ENCRYPT_NACL, base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RC2, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("tripledes"):
					return mcrypt_decrypt(MCRYPT_TRIPLEDES, self::$CRNRSTN_ENCRYPT_NACL, base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_TRIPLEDES, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
				case crc32("arcfour"):
					return mcrypt_decrypt(MCRYPT_ARCFOUR, self::$CRNRSTN_ENCRYPT_NACL, base64_decode($val), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_ARCFOUR, MCRYPT_MODE_ECB), MCRYPT_RAND)); 
				break;
			
				default:
					//
					// HOOOSTON...VE HAF PROBLEM!
					throw new Exception('CRNRSTN Cookie Management Notice :: A mcrypt cipher decoding method could not be found for the provided cipher name ('.$ALGORITHM.').');
			}
			
		}catch( Exception $e ) {
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('session_manager->cookieParamDecrypt()', LOG_EMERG, $e->getMessage());
		}
	}


	public function __destruct() {
		
	}
}
?>