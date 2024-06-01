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
// CLASS :: crnrstn_cookie_manager
// AUTHOR :: Jonathan 'J5' Harris <jharris@evifweb.com>
// VERSION :: 1.0.1
*/
class crnrstn_cookie_manager {
	
	public static $cookie_ARRAY = array();
	public $configSerial;
	public static $tmp_cookie_name;
	public static $cookieValue_Encrypted;
	public static $cookieName_Encrypted;
	private static $cookieName_ChecksumSeed = 'CRNRSTN';				// SEED CHARS VALID FOR COOKIE NAME
	public static $thisCookieCrawler_ARRAY = array();
	private static $oLogger;
	
	public function __construct($name=NULL,$value=NULL,$expire=NULL,$path=NULL,$domain=NULL,$secure=NULL,$httponly=NULL) {

		//
		// INSTANTIATE LOGGER
		self::$oLogger = new crnrstn_logging(); 
		
		//
		// IF WE HAVE COOKIE NAME, ADD THE COOKIE
		if(isset($name)){

			//
			// BECAUSE THE EXPIRE ARGUMENT IS INTEGER, IT CANNOT BE SKIPPED WITH AN EMPTY STRNG, USE A ZERO (0) INSTEAD.
			if(!isset($expire)){
				$expire=0;
			}
			
			//
			// CHECK FOR INITIALIZATION OF COOKIE ENCRYPTION IN THIS SESSION
			if(isset($_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]["_CRNRSTN_COOKIE_ENCRYPT_CIPHER"])){
			
				//
				// SET THE COOKIE
				self::$cookieValue_Encrypted = $this->cookieParamEncrypt($value);
				self::$cookieName_Encrypted = self::$cookieName_ChecksumSeed.crc32($name);
								
				return setcookie (self::$cookieName_Encrypted,self::$cookieValue_Encrypted,$expire,$path,$domain,$secure,$httponly);
				
			}else{
			
				//
				// SET THE COOKIE
				return setcookie ($name,$value,$expire,$path,$domain,$secure,$httponly);
			}

			//
			// SET THE COOKIE
			setcookie ($name,$value,$expire,$path,$domain,$secure,$httponly);
			
		}
	}
	
	public function addCookie($name,$value=NULL,$expire=NULL,$path=NULL,$domain=NULL,$secure=NULL,$httponly=NULL){
		try{
			if(isset($name)){
				
				//
				// BECAUSE THE EXPIRE ARGUMENT IS INTEGER, IT CANNOT BE SKIPPED WITH AN EMPTY STRNG, USE A ZERO (0) INSTEAD.
				if(!isset($expire)){
					$expire=0;
				}
				
				//
				// CHECK FOR INITIALIZATION OF COOKIE ENCRYPTION IN THIS SESSION
				if(isset($_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]["_CRNRSTN_COOKIE_ENCRYPT_CIPHER"])){
				
					//
					// SET THE COOKIE
					self::$cookieValue_Encrypted = $this->cookieParamEncrypt($value);
					self::$cookieName_Encrypted = self::$cookieName_ChecksumSeed.crc32($name);
									
					return setcookie (self::$cookieName_Encrypted,self::$cookieValue_Encrypted,$expire,$path,$domain,$secure,$httponly);
					
				}else{
						
					//
					// SET THE COOKIE
					return setcookie ($name,$value,$expire,$path,$domain,$secure,$httponly);
				}
				
			}else{
				
				//
				// HOOOSTON...VE HAF PROBLEM!
				throw new Exception('CRNRSTN Cookie Management Notice :: A cookie failed to be initialized due to missing NAME parameter.');
			}
			
		}catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('cookie_manager->addCookie()', LOG_NOTICE, $e->getMessage());
		}
	}
	
	public function addRawCookie($name,$value=NULL,$expire=NULL,$path=NULL,$domain=NULL,$secure=NULL,$httponly=NULL){
		try{
			if(isset($name)){
				
				//
				// BECAUSE THE EXPIRE ARGUMENT IS INTEGER, IT CANNOT BE SKIPPED WITH AN EMPTY STRNG, USE A ZERO (0) INSTEAD.
				if(!isset($expire)){
					$expire=0;
				}
				
				if(isset($_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]["_CRNRSTN_COOKIE_ENCRYPT_CIPHER"])){
					
					self::$cookieValue_Encrypted = $this->cookieParamEncrypt($value);
					self::$cookieName_Encrypted = self::$cookieName_ChecksumSeed.crc32($name);
					
					setrawcookie (self::$cookieName_Encrypted,self::$cookieValue_Encrypted,$expire,$path,$domain,$secure,$httponly);
					
				}else{
					
					//
					// SET THE RAW COOKIE. CLEAR TEXT
					setrawcookie ($name,$value,$expire,$path,$domain,$secure,$httponly);
				
				}
				
				
			}else{
				
				//
				// HOOOSTON...VE HAF PROBLEM!
				throw new Exception('CRNRSTN Cookie Management Notice :: A raw cookie failed to be initialized due to missing NAME parameter.');
			}
			
		}catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('cookie_manager->addRawCookie()', LOG_NOTICE, $e->getMessage());
		}
	}
	
	public function deleteCookie($name,$path=NULL){
		
		//
		// CHECK FOR REQUIRED INFORMATION
		try{
			if(isset($name)){
				
				//
				// OK TO ATTEMPT DELETION OF COOKIE
				// CHECK FOR COOPKIE ENCRYPTION LAYER
				if(isset($_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]["_CRNRSTN_COOKIE_ENCRYPT_CIPHER"])){
					
					//
					// OK TO ATTEMPT DELETION OF COOKIE
					self::$cookieName_Encrypted = self::$cookieName_ChecksumSeed.crc32($name);
					setcookie (self::$cookieName_Encrypted,'', 1 ,$path);
				}else{
				
					//
					// NO COOKIE ENCRYPTION. SET COOKIE. 
					setcookie ($name,'', 1,$path);
					
				}
			}else{
				
				//
				// HOOOSTON...VE HAF PROBLEM!
				throw new Exception('CRNRSTN Cookie Management Notice :: Failed to delete cookie due to missing NAME parameter.');
			}
		}catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('cookie_manager->deleteCookie()', LOG_NOTICE, $e->getMessage());
		}
	}
	
	public function getCookie($name){
		
		//
		// CHECK FOR REQUIRED INFORMATION
		try{
			if(isset($name)){
				
				//
				// OK TO ATTEMPT TO GET COOKIE
				// CHECK FOR INITIALIZATION OF COOKIE ENCRYPTION IN THIS SESSION
				if(isset($_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]["_CRNRSTN_COOKIE_ENCRYPT_CIPHER"])){
					self::$cookieName_Encrypted = self::$cookieName_ChecksumSeed.crc32($name);

					if(isset($_COOKIE[self::$cookieName_Encrypted])){
						self::$cookieValue_Encrypted = $_COOKIE[self::$cookieName_Encrypted];
						return trim($this->cookieParamDecrypt(self::$cookieValue_Encrypted));
					}else{
						
						//
						// $_COOKIE NOT SET WITH THIS PARAMTER NAME. IS THE CALLING SCRIPT AT A $path THAT PROVIDES VISIBILITY TO THE COOKIE FOR WHICH YOU ARE SEARCHING?
						return false;
					}
				
				}else{
					
					//
					// NO ENCRYPTION. RETURN COOKIE.
					return $_COOKIE[$name];
				}

			}else{
				
				//
				// HOOOSTON...VE HAF PROBLEM!
				throw new Exception('CRNRSTN Cookie Management Notice :: Failed to get cookie due to missing NAME parameter.');
			}
		}catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('cookie_manager->getCookie()', LOG_ERR, $e->getMessage());
		}
	}

	private function cookieParamEncrypt($val){
		
		try{
			if(isset($_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]["_CRNRSTN_COOKIE_ENCRYPT_CIPHER"])){
				#
				# Source: http://php.net/manual/en/function.openssl-encrypt.php
				#
				$ivlen = openssl_cipher_iv_length($cipher=$_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]["_CRNRSTN_COOKIE_ENCRYPT_CIPHER"]);
				$iv = openssl_random_pseudo_bytes($ivlen);
				$ciphertext_raw = openssl_encrypt($val, $_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]["_CRNRSTN_COOKIE_ENCRYPT_CIPHER"], $_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]["_CRNRSTN_COOKIE_ENCRYPT_SECRET_KEY"], $options=$_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]["_CRNRSTN_COOKIE_ENCRYPT_OPTIONS"], $iv);
				$hmac = hash_hmac($_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]["_CRNRSTN_COOKIE_ENCRYPT_HMAC_ALG"], $ciphertext_raw, $_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]["_CRNRSTN_COOKIE_ENCRYPT_SECRET_KEY"], $as_binary=true);
				$ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
				
				return $ciphertext;
			}else{
				return $val;
			}

		}catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('session_manager->cookieParamEncrypt()', LOG_EMERG, $e->getMessage());
		}
	
	}
	
	
	private function cookieParamDecrypt($val){
		try{
			
			if(isset($_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]["_CRNRSTN_COOKIE_ENCRYPT_CIPHER"])){
				#
				# Source: http://php.net/manual/en/function.openssl-encrypt.php
				#
				$c = base64_decode($val);
				$ivlen = openssl_cipher_iv_length($cipher=$_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]["_CRNRSTN_COOKIE_ENCRYPT_CIPHER"]);
				$iv = substr($c, 0, $ivlen);
				$hmac = substr($c, $ivlen, $sha2len=32);
				$ciphertext_raw = substr($c, $ivlen+$sha2len);
				$original_plaintext = openssl_decrypt($ciphertext_raw, $_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]["_CRNRSTN_COOKIE_ENCRYPT_CIPHER"], $_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]["_CRNRSTN_COOKIE_ENCRYPT_SECRET_KEY"], $options=$_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]["_CRNRSTN_COOKIE_ENCRYPT_OPTIONS"], $iv);
				$calcmac = hash_hmac($_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]["_CRNRSTN_COOKIE_ENCRYPT_HMAC_ALG"], $ciphertext_raw, $_SESSION["CRNRSTN_".crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]["CRNRSTN_".$_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]["_CRNRSTN_COOKIE_ENCRYPT_SECRET_KEY"], $as_binary=true);
				
				if (hash_equals($hmac, $calcmac))//PHP 5.6+ timing attack safe comparison
				{
					return $original_plaintext;
				}else{
					
					//
					// HOOOSTON...VE HAF PROBLEM!
					throw new Exception('CRNRSTN Cookie Param Decrypt Notice :: Oops. Something went wrong. Hash_equals comparison failed during data decryption.');
				}
			
			}else{
				
				//
				// NO ENCRYPTION. RETURN VAL
				return $val;
			}
			
		}catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('session_manager->cookieParamDecrypt()', LOG_CRIT, $e->getMessage());
		}

	}	
	
	public function deleteAllCookies($path=NULL){
		
		//
		// LETS TRY WORKING WITH A HANDLE.
		self::$cookie_ARRAY=array_keys($_COOKIE);
		for ($x=0;$x<count(self::$cookie_ARRAY);$x++){
			setcookie(self::$cookie_ARRAY[$x],"", 1,$path);
		}
		
		return true;
	}

	public function __destruct() {

	}
}

?>