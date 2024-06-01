<?php
/*
// J5
// Code is Poetry */
#  CRNRSTN Suite :: An Open Source PHP Class Library to facilitate the operation of an application across multiple hosting environments.
#  Copyright (C) 2012-2018 eVifweb Development
#  VERSION :: 1.0.1
#  RELEASE DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#  AUTHOR :: Jonathan 'J5' Harris, CEO, CTO, Lead Full Stack Developer, jharris@eVifweb.com, eVifweb@gmail.com.
#  URI :: https://crnrstn.jony5.com/
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
#		OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.ncluding without limitation the rights to use, copy, 
#			  modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the 
#			  Software is furnished to do so, subject to the following conditions:

#			  The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

#			  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE 
#			  WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT 
#			  HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, 
#			  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

/*
// CLASS :: crnrstn_session_manager
// AUTHOR :: Jonathan 'J5' Harris <jharris@evifweb.com>
// VERSION :: 1.0.1
*/
class crnrstn_session_manager {

	//
	//CONFIG SERIAL AND ENCRYPTION KEY FOR CRNRSTN SESSION VALUES
	public $configSerial;
	public $resourceKey;
	private static $cacheSessionParam_ARRAY = array();
	private static $CRNRSTN_ENCRYPT_CIPHER;
	
	private static $oLogger;
	private static $oCOOKIE_MGR;
	private static $encryptableDataTypes = array();
	private static $oSessionEnvironment;
	
	public function __construct($oCRNRSTN_ENV=NULL){
			
		if(isset($oCRNRSTN_ENV)){
			self::$oSessionEnvironment = $oCRNRSTN_ENV;
			
			//
			// INITIALIZE CONFIG SERIAL FOR SESSION SERIALIZATION
			$this->configSerial = self::$oSessionEnvironment->configSerial;	
			$this->resourceKey =  self::$oSessionEnvironment->returnResouceKey();
					
			//
			// INSTANTIATE LOGGER
			self::$oLogger = new crnrstn_logging($oCRNRSTN_ENV->debugMode);

		}else{
			
			//
			// INSTANTIATE LOGGER - NO DEBUG
			self::$oLogger = new crnrstn_logging();
		}
		
		//
		// INITIALIZE ARRAY OF ENCRYPTABLE DATATYPES
		self::$encryptableDataTypes = array('string','integer','double','float','int');
		
		//
		// Function Source ::
		// http://php.net/manual/en/function.hash-equals.php#115635
		// To transparently support decryption dependency with hash_equals on older versions of PHP:
		if(!function_exists('hash_equals')) {
		  function hash_equals($str1, $str2) {
			if(strlen($str1) != strlen($str2)) {
			  return false;
			} else {
			  $res = $str1 ^ $str2;
			  $ret = 0;
			  for($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);
			  return !$ret;
			}
		  }
		}


	}

	public function setSessionParam($sessParam, $val=NULL){
		
		if(in_array(gettype($val),self::$encryptableDataTypes)){
			
			//
			// CLEAR POTENTIAL CACHE TO FORCE REFRESH
			unset(self::$cacheSessionParam_ARRAY[$sessParam]);
			$_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$this->resourceKey]['CRNRSTN_'.crc32($sessParam)] = $this->sessionParamEncrypt($val);
			$_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$this->resourceKey]['CRNRSTN_ENCRYPT_'.crc32($sessParam)] = 1;
			$_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$this->resourceKey]['CRNRSTN_DTYPE_'.crc32($sessParam)] = gettype($val);
						
		}else{
			
			//
			// NOT ENCRYPTABLE
			unset(self::$cacheSessionParam_ARRAY[$sessParam]);
			$_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$this->resourceKey]['CRNRSTN_'.crc32($sessParam)] = $val;
			$_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$this->resourceKey]['CRNRSTN_ENCRYPT_'.crc32($sessParam)] = 0;
		}

		return true;
	}
	
	public function getSessionParam($sessParam){
		$this->resourceKey = $_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY'];
		
		//
		// RETURN THE VALUE ASSIGNED TO A PARTICULAR SESSION PARAMETER AND ENSURE THAT THE APPROPRIATE TYPE IS CAST
		if(isset($_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$this->resourceKey]['CRNRSTN_'.crc32($sessParam)])){
			if($_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$this->resourceKey]['CRNRSTN_ENCRYPT_'.crc32($sessParam)]>0){
				switch($_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$this->resourceKey]['CRNRSTN_DTYPE_'.crc32($sessParam)]){
					case 'string':
						if(isset(self::$cacheSessionParam_ARRAY[$sessParam])){
							return self::$cacheSessionParam_ARRAY[$sessParam];
						}else{
							self::$cacheSessionParam_ARRAY[$sessParam] = trim($this->sessionParamDecrypt($_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$this->resourceKey]['CRNRSTN_'.crc32($sessParam)]));
							return self::$cacheSessionParam_ARRAY[$sessParam];
						}
					break;
					case 'integer':
						if(isset(self::$cacheSessionParam_ARRAY[$sessParam])){
							return (integer) self::$cacheSessionParam_ARRAY[$sessParam];
						}else{
							self::$cacheSessionParam_ARRAY[$sessParam] = trim($this->sessionParamDecrypt($_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$this->resourceKey]['CRNRSTN_'.crc32($sessParam)]));
							return (integer) self::$cacheSessionParam_ARRAY[$sessParam];
						}
					break;
					case 'int':
						if(isset(self::$cacheSessionParam_ARRAY[$sessParam])){
							return (int) self::$cacheSessionParam_ARRAY[$sessParam];
						}else{
							self::$cacheSessionParam_ARRAY[$sessParam] = trim($this->sessionParamDecrypt($_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$this->resourceKey]['CRNRSTN_'.crc32($sessParam)]));
							return (int) self::$cacheSessionParam_ARRAY[$sessParam];
						}
					break;
					case 'double':
						if(isset(self::$cacheSessionParam_ARRAY[$sessParam])){
							return (double) self::$cacheSessionParam_ARRAY[$sessParam];
						}else{
							self::$cacheSessionParam_ARRAY[$sessParam] = trim($this->sessionParamDecrypt($_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$this->resourceKey]['CRNRSTN_'.crc32($sessParam)]));
							return (double) self::$cacheSessionParam_ARRAY[$sessParam];
						}
					break;
					case 'float':
						if(isset(self::$cacheSessionParam_ARRAY[$sessParam])){
							return (float) self::$cacheSessionParam_ARRAY[$sessParam];
						}else{
							self::$cacheSessionParam_ARRAY[$sessParam] = trim($this->sessionParamDecrypt($_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$this->resourceKey]['CRNRSTN_'.crc32($sessParam)]));
							return (float) self::$cacheSessionParam_ARRAY[$sessParam];
						}
					break;
                    case 'boolean':
                        if(isset(self::$cacheSessionParam_ARRAY[$sessParam])){
                            return (boolean) self::$cacheSessionParam_ARRAY[$sessParam];
                        }else{
                            self::$cacheSessionParam_ARRAY[$sessParam] = trim($this->sessionParamDecrypt($_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$this->resourceKey]['CRNRSTN_'.crc32($sessParam)]));
                            return (boolean) self::$cacheSessionParam_ARRAY[$sessParam];
                        }
                    break;
				}
			
			}else{
				
				//
				// NO ENCRYPTION APPLIED TO PARAM. RETURN SESSION VALUE.
				return $_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$this->resourceKey]['CRNRSTN_'.crc32($sessParam)];
			}
		}else{
			return false;
		}
	}
	
	public function issetSessionParam($sessParam){
		$this->resourceKey = $_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY'];
		
		//
		// RETURN THE VALUE ASSIGNED TO A PARTICULAR SESSION PARAMETER
		if(isset($_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$this->resourceKey]['CRNRSTN_'.crc32($sessParam)])){
			
			//
			// IF SESSION ENCRYPTION IS ENABLED, WE HAVE TO DECRYPT BEFORE WE CAN CHECK IF EMPTY
			if($_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$this->resourceKey]['CRNRSTN_ENCRYPT_'.crc32($sessParam)]>0){
				if(isset(self::$cacheSessionParam_ARRAY[$sessParam])){
					if(self::$cacheSessionParam_ARRAY[$sessParam]!=""){
						return true;
					}else{
						return false;
					}
				}else{
					self::$cacheSessionParam_ARRAY[$sessParam] = trim($this->sessionParamDecrypt($_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$this->resourceKey]['CRNRSTN_'.crc32($sessParam)]));
					
					if(self::$cacheSessionParam_ARRAY[$sessParam]!=""){
						return true;
					}else{
						return false;
					}
				}
			
			}else{
				
				//
				// NO ENCRYPTION APPLIED TO PARAM. CHECK IF EMPTY.
				if($_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$this->resourceKey]['CRNRSTN_'.crc32($sessParam)]!=""){
					return true;
				}else{
					return false;
				}
			}
		}else{
			return false;
		}
	}	
	
	public function getSessionKey(){
		return $_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY'];
		
	}
	
	public function setSessionIp($key, $ip){
		$_SESSION['CRNRSTN_'.crc32($this->configSerial).crc32($key)] = md5($ip);
	}
	
	public function getSessionIp(){
		if(isset($_SESSION['CRNRSTN_'.crc32($this->configSerial).crc32('SESSION_IP')])){
			return $_SESSION['CRNRSTN_'.crc32($this->configSerial).crc32('SESSION_IP')];
		}else{
			return false;
		}
	}

	private function sessionParamEncrypt($val){		
		try{
			if(isset($_SESSION["CRNRSTN_".crc32($this->configSerial)]["CRNRSTN_".$this->resourceKey]["_CRNRSTN_SESS_ENCRYPT_CIPHER"])){
				
				#
				# Source: http://php.net/manual/en/function.openssl-encrypt.php
				#
				$ivlen = openssl_cipher_iv_length($cipher=$_SESSION["CRNRSTN_".crc32($this->configSerial)]["CRNRSTN_".$this->resourceKey]["_CRNRSTN_SESS_ENCRYPT_CIPHER"]);
				$iv = openssl_random_pseudo_bytes($ivlen);
				$ciphertext_raw = openssl_encrypt($val, $_SESSION["CRNRSTN_".crc32($this->configSerial)]["CRNRSTN_".$this->resourceKey]["_CRNRSTN_SESS_ENCRYPT_CIPHER"], $_SESSION["CRNRSTN_".crc32($this->configSerial)]["CRNRSTN_".$this->resourceKey]["_CRNRSTN_SESS_ENCRYPT_SECRET_KEY"], $options=$_SESSION["CRNRSTN_".crc32($this->configSerial)]["CRNRSTN_".$this->resourceKey]["_CRNRSTN_SESS_ENCRYPT_OPTIONS"], $iv);
				$hmac = hash_hmac($_SESSION["CRNRSTN_".crc32($this->configSerial)]["CRNRSTN_".$this->resourceKey]["_CRNRSTN_SESS_ENCRYPT_HMAC_ALG"], $ciphertext_raw, $_SESSION["CRNRSTN_".crc32($this->configSerial)]["CRNRSTN_".$this->resourceKey]["_CRNRSTN_SESS_ENCRYPT_SECRET_KEY"], $as_binary=true);
				$ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
				
				return $ciphertext;
			}else{
				
				return $val;
			}

		}catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('session_manager->sessionParamEncrypt()', LOG_EMERG, $e->getMessage());
		}
	}
	 
	private function sessionParamDecrypt($val){
		try{
			
			if(isset($_SESSION["CRNRSTN_".crc32($this->configSerial)]["CRNRSTN_".$this->resourceKey]["_CRNRSTN_SESS_ENCRYPT_CIPHER"])){

				#
				# Source: http://php.net/manual/en/function.openssl-encrypt.php
				#
				$c = base64_decode($val);
				$ivlen = openssl_cipher_iv_length($cipher=$_SESSION["CRNRSTN_".crc32($this->configSerial)]["CRNRSTN_".$this->resourceKey]["_CRNRSTN_SESS_ENCRYPT_CIPHER"]);
				$iv = substr($c, 0, $ivlen);
				$hmac = substr($c, $ivlen, $sha2len=32);
				$ciphertext_raw = substr($c, $ivlen+$sha2len);
				$original_plaintext = openssl_decrypt($ciphertext_raw, $_SESSION["CRNRSTN_".crc32($this->configSerial)]["CRNRSTN_".$this->resourceKey]["_CRNRSTN_SESS_ENCRYPT_CIPHER"], $_SESSION["CRNRSTN_".crc32($this->configSerial)]["CRNRSTN_".$this->resourceKey]["_CRNRSTN_SESS_ENCRYPT_SECRET_KEY"], $options=$_SESSION["CRNRSTN_".crc32($this->configSerial)]["CRNRSTN_".$this->resourceKey]["_CRNRSTN_SESS_ENCRYPT_OPTIONS"], $iv);
				$calcmac = hash_hmac($_SESSION["CRNRSTN_".crc32($this->configSerial)]["CRNRSTN_".$this->resourceKey]["_CRNRSTN_SESS_ENCRYPT_HMAC_ALG"], $ciphertext_raw, $_SESSION["CRNRSTN_".crc32($this->configSerial)]["CRNRSTN_".$this->resourceKey]["_CRNRSTN_SESS_ENCRYPT_SECRET_KEY"], $as_binary=true);
				
				if (hash_equals($hmac, $calcmac))//PHP 5.6+ timing attack safe comparison
				{
					return $original_plaintext;
				}else{
					
					//
					// HOOOSTON...VE HAF PROBLEM!
					throw new Exception('CRNRSTN Session Param Decrypt Notice :: Oops. Something went wrong. Hash_equals comparison failed during data decryption.');
				}
			
			}else{
				
				//
				// NO ENCRYPTION. RETURN VAL
				return $val;
			}
			
		}catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('session_manager->sessionParamDecrypt()', LOG_EMERG, $e->getMessage());
		}
	}

	public function __destruct() {
		
	}
}

?>