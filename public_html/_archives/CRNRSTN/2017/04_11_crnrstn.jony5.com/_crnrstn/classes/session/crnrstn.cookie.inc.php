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

class crnrstn_cookie_manager {
	
	public static $cookie_ARRAY = array();
	public $configSerial;
	public static $tmp_cookie_name;
	public static $cookieValue_Encrypted;
	public static $cookieName_Encrypted;
	private static $oSESSION_MGR;
	private static $cookieName_ChecksumSeed = 'CRNRSTN';				// MAKE THIS WHATEVER YOU WANT
	public static $thisCookieCrawler_ARRAY = array();
	private static $oLogger;
	
	public function __construct($oEnv,$name=NULL,$value=NULL,$expire=NULL,$path=NULL,$domain=NULL,$secure=NULL,$httponly=NULL) {
		
		
		$this->configSerial = $oEnv->configSerial;

		//
		// INSTANTIATE LOGGER
		if(!isset(self::$oLogger)){
			self::$oLogger = new crnrstn_logging();
		}
		
		//
		// INSTANTIATE SESSION MANAGER TO RUN COOKIES THROUGH SESSION ENCRYPTION
		if(!isset(self::$oSESSION_MGR)){
			self::$oSESSION_MGR = new crnrstn_session_manager();
		}
		
		//
		// IF WE HAVE COOKIE NAME, ADD THE COOKIE
		if(isset($name)){
		
			//
			// Because the expire argument is integer, it cannot be skipped with an empty string, use a zero (0) instead.
			if(!isset($expire)){
				$expire=0;
			}

			//
			// SET THE COOKIE
			setcookie ($name,$value,$expire,$path,$domain,$secure,$httponly);
			
		}
	}
	
	##
	## METHOD NOTES/IDEAS
	# - addCookie ([cookie-name],[optional-cookie-value],[optional-cookie-expire],[optional-cookie-path],[optional-cookie-domain],[optional-cookie-secure],[optional-cookie-httponly])
	# - addRawCookie ([cookie-name],[optional-cookie-value],[optional-cookie-expire],[optional-cookie-path],[optional-cookie-domain],[optional-cookie-secure],[optional-cookie-httponly])
	#	* If output exists prior to calling this function, setcookie() will fail and return FALSE. 
	#	* Because the expire argument is integer, it cannot be skipped with an empty string, 
	#	  use a zero (0) instead. [http://www.php.net]
	#	* Like other headers, cookies must be sent before any output from your script (this is a protocol 
	#	  restriction). This requires that you place calls to this function prior to any output, including <html> 
	#	  and <head> tags as well as any whitespace. [http://www.php.net]
	#	* Consider integrating an output buffer into your cookie management. What are the performance 
	#	  implications (e.g. higher server cache requirements)...if any?
	#	* Support for multidimensional arrays (multiple values) in cookie [crnrstn supports cookie 
	#	  arrays up to 4 dimensions...e.g. cookieName[0][0][3][4]
	# 	* ob_start() :: Some web servers (e.g. Apache) change the working directory of a script when calling the callback 
	#	  function. You can change it back by e.g. chdir(dirname($_SERVER['SCRIPT_FILENAME'])) in the callback function. [http://www.php.net]
	#	* If you wish to assign multiple values to a single cookie, just add [] to the cookie name. [http://www.php.net]
	#	* The time the cookie expires. This is a Unix timestamp so is in number of seconds since the epoch. In other 
	#	  words, you'll most likely set this with the time() function plus the number of seconds before you want 
	#	  it to expire. Or you might use mktime(). time()+60*60*24*30 will set the cookie to expire in 30 days. If set 
	#	  to 0, or omitted, the cookie will expire at the end of the session (when the browser closes). [http://www.php.net]
	
	public function addCookie($name,$value=NULL,$expire=NULL,$path=NULL,$domain=NULL,$secure=NULL,$httponly=NULL){
		try{
			if(isset($name)){
				//
				// Because the expire argument is integer, it cannot be skipped with an empty string, use a zero (0) instead.
				if(!isset($expire)){
					$expire=0;
				}

				//
				// SET THE COOKIE
				return setcookie ($name,$value,$expire,$path,$domain,$secure,$httponly);
				
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
	
	public function addEncryptedCookie($name,$value=NULL,$expire=NULL,$path=NULL,$domain=NULL,$secure=NULL,$httponly=NULL){
		//
		// COOKIE WILL ASSUME ENCRYPTION CIPHER AS SPECIFIED IN THE CONFIG FILE with initEncryptionCipher().
		// Consequently, setting [optional-cipher-strength] = 0 (no encryption) will 
		// make this method behave like cookie_manager->addCookie()
		
		try{
			if(isset($name)){
				#echo "<br>We have a cookie name!<br>";
				#echo "NAME :: ".$name."<br><br>";
				#die();
				//
				// Because the expire argument is integer, it cannot be skipped with an empty string, use a zero (0) instead.
				if(!isset($expire)){
					$expire=0;
				}
				
				//
				// SET THE COOKIE
				self::$cookieValue_Encrypted = self::$oSESSION_MGR->cookieParamEncrypt($value);
				self::$cookieName_Encrypted = self::$cookieName_ChecksumSeed.crc32($name).$_SESSION[$this->configSerial.'CRNRSTN'.crc32('COOKIE_MCRYPT_CIPHER')];
				
				return setcookie (self::$cookieName_Encrypted,self::$cookieValue_Encrypted,$expire,$path,$domain,$secure,$httponly);
				
			}else{
				//
				// HOOOSTON...VE HAF PROBLEM!
				throw new Exception('CRNRSTN Cookie Management Notice :: An encrypted cookie failed to be initialized due to missing NAME parameter.');
			}
			
		}catch( Exception $e ) {
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('cookie_manager->addEncryptedCookie()', LOG_NOTICE, $e->getMessage());
		}
	}
	
	public function addRawCookie($name,$value=NULL,$expire=NULL,$path=NULL,$domain=NULL,$secure=NULL,$httponly=NULL){
		try{
			if(isset($name)){
				//
				// Because the expire argument is integer, it cannot be skipped with an empty string, use a zero (0) instead.
				if(!isset($expire)){
					$expire=0;
				}
			
				//
				// SET THE RAW COOKIE
				setrawcookie ($name,$value,$expire,$path,$domain,$secure,$httponly);
				
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
	
	# - deleteCookie([cookie-name])
	# 	* When deleting a cookie you should assure that the expiration date is in the past, to trigger the 
	#	  removal mechanism in your browser. 
	#   * Test this with multi-dimen arrays
	public function deleteCookie($name){
		//
		// CHECK FOR REQUIRED INFORMATION
		try{
			if(isset($name)){
				//
				// OK TO ATTEMPT DELETION OF COOKIE
				setcookie ($name,'', time() - 3600);
				#echo "deleted.........................".$name."<br>";
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
	
	public function deleteEncryptedCookie($name){

		//
		// CHECK FOR REQUIRED INFORMATION
		try{
			if(isset($name)){
			
				self::$cookieName_Encrypted = self::$cookieName_ChecksumSeed.crc32($name);
				//
				// OK TO ATTEMPT DELETION OF COOKIE
				setcookie (self::$cookieName_Encrypted,'', time() - 3600);

			}else{
				//
				// HOOOSTON...VE HAF PROBLEM!
				throw new Exception('CRNRSTN Cookie Management Notice :: Failed to delete encrypted cookie due to missing NAME parameter.');
			}
		}catch( Exception $e ) {
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('cookie_manager->deleteEncryptedCookie()', LOG_NOTICE, $e->getMessage());
		}
	}
	
	# - getCookie([cookie-name])
	public function getCookie($name){
		//
		// CHECK FOR REQUIRED INFORMATION
		try{
			if(isset($name)){
				//
				// OK TO ATTEMPT TO GET COOKIE
				return $_COOKIE[$name];

			}else{
				//
				// HOOOSTON...VE HAF PROBLEM!
				throw new Exception('CRNRSTN Cookie Management Notice :: Failed to get cookie due to missing NAME parameter.');
			}
		}catch( Exception $e ) {
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('cookie_manager->getCookie()', LOG_NOTICE, $e->getMessage());
		}
	}
	
	public function getEncryptedCookie($name){
		//
		// CHECK FOR REQUIRED INFORMATION
		try{
			if(isset($name)){
				//
				// OK TO ATTEMPT TO GET COOKIE
				self::$cookieName_Encrypted = self::$cookieName_ChecksumSeed.crc32($name).$_SESSION[$this->configSerial.'CRNRSTN'.crc32('COOKIE_MCRYPT_CIPHER')];
				if($_COOKIE[self::$cookieName_Encrypted]){
					self::$cookieValue_Encrypted = $_COOKIE[self::$cookieName_Encrypted];
					return trim(self::$oSESSION_MGR->cookieParamDecrypt(self::$cookieValue_Encrypted, $_SESSION[$this->configSerial.'CRNRSTN'.crc32('SESSION_MCRYPT_CIPHER')]));
				}else{
				
					return false;
				}
			}else{
				//
				// HOOOSTON...VE HAF PROBLEM!
				throw new Exception('CRNRSTN Cookie Management Notice :: Failed to get cookie (encrypted) due to missing NAME parameter.');
			}
		}catch( Exception $e ) {
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('cookie_manager->getEncryptedCookie()', LOG_NOTICE, $e->getMessage());
		}
	}	
	
	# - deleteAllCookies()
	public function deleteAllCookies(){
		
		//
		// LETS TRY WORKING WITH A HANDLE.
		self::$cookie_ARRAY=$_COOKIE;
		
		for($i=0;$i<sizeof(self::$cookie_ARRAY);$i++){
			self::$thisCookieCrawler_ARRAY = each(self::$cookie_ARRAY);
			 
			//
			// 	CLEAR OUT ALL NON-MULTIDIMENSAIONAL ARRAY COOKIES
			if(!is_array(self::$cookie_ARRAY[self::$thisCookieCrawler_ARRAY['key']]) && isset(self::$cookie_ARRAY[self::$thisCookieCrawler_ARRAY['key']])){
				$this->deleteCookie(self::$thisCookieCrawler_ARRAY['key']);
				
			}else{
				
				//
				// WE HAVE AT LEAST ONE 1-DIMENSION ARRAY TO TRAVERSE FROM THE $_COOKIE[] GLOBAL
				foreach (self::$cookie_ARRAY[self::$thisCookieCrawler_ARRAY['key']] as $tmp_cookie_name=>$tmp_cookie_value) {
					#echo "[".$tmp_cookie_name."]";
					
					//
					// 	EXPIRE SIMPLE COOKIES
					if(!is_array(self::$cookie_ARRAY[self::$thisCookieCrawler_ARRAY['key']][$tmp_cookie_name])){
						self::$tmp_cookie_name = self::$thisCookieCrawler_ARRAY['key']."[".$tmp_cookie_name."]";
						$this->deleteCookie(self::$tmp_cookie_name);
					}else{
						foreach (self::$cookie_ARRAY[self::$thisCookieCrawler_ARRAY['key']][$tmp_cookie_name] as $tmp_cookie_name_dim2=>$tmp_cookie_value_dim2) {
							#echo "--[".$tmp_cookie_name_dim2."]<br>";
							
							//
							// 	EXPIRE 1 DIMENSAIONAL ARRAY COOKIES
							if(!is_array(self::$cookie_ARRAY[self::$thisCookieCrawler_ARRAY['key']][$tmp_cookie_name][$tmp_cookie_name_dim2])){
								self::$tmp_cookie_name = self::$thisCookieCrawler_ARRAY['key']."[".$tmp_cookie_name."][".$tmp_cookie_name_dim2."]";
								#echo self::$tmp_cookie_name."<---]]]]]]<br>";
								$this->deleteCookie(self::$tmp_cookie_name);
							}else{
								foreach (self::$cookie_ARRAY[self::$thisCookieCrawler_ARRAY['key']][$tmp_cookie_name][$tmp_cookie_name_dim2] as $tmp_cookie_name_dim3=>$tmp_cookie_value_dim3) {
									#echo "--[[[[".$tmp_cookie_name_dim3."]<br>";
									
									//
									// 	EXPIRE 2 DIMENSAIONAL ARRAY COOKIES
									if(!is_array(self::$cookie_ARRAY[self::$thisCookieCrawler_ARRAY['key']][$tmp_cookie_name][$tmp_cookie_name_dim2][$tmp_cookie_name_dim3])){
										self::$tmp_cookie_name = self::$thisCookieCrawler_ARRAY['key']."[".$tmp_cookie_name."][".$tmp_cookie_name_dim2."][".$tmp_cookie_name_dim3."]";
										#echo self::$tmp_cookie_name."<---]]]]]]<br>";
										$this->deleteCookie(self::$tmp_cookie_name);
									}else{
										foreach (self::$cookie_ARRAY[self::$thisCookieCrawler_ARRAY['key']][$tmp_cookie_name][$tmp_cookie_name_dim2] as $tmp_cookie_name_dim3=>$tmp_cookie_value_dim3) {
											#echo "--[[[[".$tmp_cookie_name_dim3."]<br>";	
											
											//
											// 	EXPIRE 3 DIMENSAIONAL ARRAY COOKIES
											if(!is_array(self::$cookie_ARRAY[self::$thisCookieCrawler_ARRAY['key']][$tmp_cookie_name][$tmp_cookie_name_dim2][$tmp_cookie_name_dim3])){
												self::$tmp_cookie_name = self::$thisCookieCrawler_ARRAY['key']."[".$tmp_cookie_name."][".$tmp_cookie_name_dim2."][".$tmp_cookie_name_dim3."]";
												#echo self::$tmp_cookie_name."<---]]]]]]<br>";
												$this->deleteCookie(self::$tmp_cookie_name);
											}else{
												foreach (self::$cookie_ARRAY[self::$thisCookieCrawler_ARRAY['key']][$tmp_cookie_name][$tmp_cookie_name_dim2][$tmp_cookie_name_dim3] as $tmp_cookie_name_dim4=>$tmp_cookie_value_dim4) {
													#echo "--[[[[".$tmp_cookie_name_dim4."]<br>";
				
													//
													// 	EXPIRE 4 DIMENSAIONAL ARRAY COOKIES
													if(!is_array(self::$cookie_ARRAY[self::$thisCookieCrawler_ARRAY['key']][$tmp_cookie_name][$tmp_cookie_name_dim2][$tmp_cookie_name_dim3][$tmp_cookie_name_dim4])){
														self::$tmp_cookie_name = self::$thisCookieCrawler_ARRAY['key']."[".$tmp_cookie_name."][".$tmp_cookie_name_dim2."][".$tmp_cookie_name_dim3."][".$tmp_cookie_name_dim4."]";
														#echo self::$tmp_cookie_name."<---]]]]]]<br>";
														$this->deleteCookie(self::$tmp_cookie_name);
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
		
		return true;
	}
	
	public function getAllCookies(){
		return $_COOKIE;
	}
	
	public function __destruct() {

	}
}

?>