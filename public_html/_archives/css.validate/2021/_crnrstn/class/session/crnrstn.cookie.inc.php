<?php
/*
// J5
// Code is Poetry */
#
#  CRNRSTN ::
#  VERSION :: 2.00.0000 PRE-ALPHA-DEV
#  DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#  AUTHOR :: Jonathan 'J5' Harris, Lead Full Stack Developer
#  URI :: http://crnrstn.evifweb.com/
#  DESCRIPTION :: CRNRSTN :: An Open Source PHP Class Library providing a robust services interface layer to both
#       facilitate, augment, and enhance the operations of code base for an application across multiple hosting
#       environments. Copyright (C) 2012-2021 eVifweb development.
#  OVERVIEW :: CRNRSTN :: is an open source PHP class library that facilitates the operation of an application within
#       multiple server environments (e.g. localhost, stage, preprod, and production). With this tool, data and
#       functionality with characteristics that inherently create distinctions from one environment to the next...such
#       as IP address restrictions, error logging profiles, and database authentication credentials...can all be
#       managed through one framework for an entire application. Once CRNRSTN :: has been configured for your different
#       hosting environments, seamlessly release a web application from one environment to the next without having to
#       change your code-base to account for environmentally specific parameters. Receive the benefit of a robust and
#       polished framework for bubbling up exception notifications through any output of your choosing. Take advantage
#       of the CRNRSTN :: SOAP Services layer supporting many to 1 proxy messaging relationships between slave and
#       master servers; regarding server communications i.e. notifications, some architectures will depend on one
#       master to support the communications needs of many slaves with respect their roles and responsibilities in
#       regards to sending an email. With CRNRSTN ::, slaves configured to log exceptions via EMAIL_PROXY will send
#       all of their internal system notifications to one master server (proxy) which server would posses the (if
#       necessary) SMTP credentials for authorization to access and execute more restricted communications
#       protocols of the network.
#  LICENSE :: MIT
#		Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
#		documentation files (the "Software"), to deal in the Software without restriction, including without limitation
#       the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software,
#       and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
#
#		The above copyright notice and this permission notice shall be included in all copies or substantial portions
#		of the Software.
#
#		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
#       TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
#       THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF
#       CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
#       DEALINGS IN THE SOFTWARE.
#
# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: crnrstn_cookie_manager
#  VERSION :: 2.00.0000
#  DATE :: September 11, 2012 @ 1720hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: Cookie management on top of the CRNRSTN :: Cookie Encryption Layer.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_cookie_manager {
	
	public static $cookie_ARRAY = array();
	public $config_serial;
	public static $tmp_cookie_name;
	public static $cookieValue_Encrypted;
	public static $cookieName_Encrypted;
	private static $cookieName_ChecksumSeed = 'CRNRSTN';				// SEED CHARS VALID FOR COOKIE NAME
	public static $thisCookieCrawler_ARRAY = array();
	protected $oLogger;

	private static $oCRNRSTN_USR;
	
	public function __construct($name = NULL, $value = NULL, $expire = NULL, $path = NULL, $domain = NULL, $secure = NULL, $httponly = NULL){
		
		//
		// IF WE HAVE COOKIE NAME, ADD THE COOKIE
		if(isset($name)){

			//
			// BECAUSE THE EXPIRE ARGUMENT IS INTEGER, IT CANNOT BE SKIPPED WITH AN EMPTY STRING, USE A ZERO (0) INSTEAD.
			if(!isset($expire)){
				$expire=0;
			}
			
			//
			// CHECK FOR INITIALIZATION OF COOKIE ENCRYPTION IN THIS SESSION
			if(isset($_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]['_CRNRSTN_COOKIE_ENCRYPT_CIPHER'])){
			
				//
				// SET THE COOKIE
				self::$cookieValue_Encrypted = $this->cookieParamEncrypt($value);
				self::$cookieName_Encrypted = self::$cookieName_ChecksumSeed.self::$oCRNRSTN_USR->crcINT($name);
								
				return setcookie (self::$cookieName_Encrypted,self::$cookieValue_Encrypted,$expire,$path,$domain,$secure,$httponly);
				
			}else{
			
				//
				// SET THE COOKIE
				return setcookie ($name, $value, $expire, $path, $domain, $secure, $httponly);

			}

		}

        return true;

	}

    public function initialize_oCRNRSTN_USR($oCRNRSTN_USR){

        self::$oCRNRSTN_USR = $oCRNRSTN_USR;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(self::$oCRNRSTN_USR->CRNRSTN_debugMode, __CLASS__, self::$oCRNRSTN_USR->log_silo_profile, self::$oCRNRSTN_USR);

    }
	
	public function addCookie($name, $value=NULL, $expire=NULL, $path=NULL, $domain=NULL, $secure=NULL, $httponly=NULL){

	    try{

			if(isset($name)){
				
				//
				// BECAUSE THE EXPIRE ARGUMENT IS INTEGER, IT CANNOT BE SKIPPED WITH AN EMPTY STRING, USE A ZERO (0) INSTEAD.
				if(!isset($expire)){
					$expire = 0;
				}
				
				//
				// CHECK FOR INITIALIZATION OF COOKIE ENCRYPTION IN THIS SESSION
				if(isset($_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]['_CRNRSTN_COOKIE_ENCRYPT_CIPHER'])){
				
					//
					// SET THE COOKIE
					self::$cookieValue_Encrypted = $this->cookieParamEncrypt($value);
					self::$cookieName_Encrypted = self::$cookieName_ChecksumSeed.self::$oCRNRSTN_USR->crcINT($name);
									
					return setcookie (self::$cookieName_Encrypted,self::$cookieValue_Encrypted,$expire,$path,$domain,$secure,$httponly);
					
				}else{
						
					//
					// SET THE COOKIE
					return setcookie ($name,$value,$expire,$path,$domain,$secure,$httponly);
				}
				
			}else{
				
				//
				// HOOOSTON...VE HAF PROBLEM!
				throw new Exception('A cookie failed to be initialized due to missing NAME parameter.');

			}
			
		}catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

			return false;

		}

	}
	
	public function addRawCookie($name,$value=NULL,$expire=NULL,$path=NULL,$domain=NULL,$secure=NULL,$httponly=NULL){

	    try{

			if(isset($name)){
				
				//
				// BECAUSE THE EXPIRE ARGUMENT IS INTEGER, IT CANNOT BE SKIPPED WITH AN EMPTY STRING, USE A ZERO (0) INSTEAD.
				if(!isset($expire)){
					$expire=0;
				}
				
				if(isset($_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]['_CRNRSTN_COOKIE_ENCRYPT_CIPHER'])){
					
					self::$cookieValue_Encrypted = $this->cookieParamEncrypt($value);
					self::$cookieName_Encrypted = self::$cookieName_ChecksumSeed.self::$oCRNRSTN_USR->crcINT($name);
					
					setrawcookie (self::$cookieName_Encrypted,self::$cookieValue_Encrypted,$expire,$path,$domain,$secure,$httponly);
					
				}else{
					
					//
					// SET THE RAW COOKIE. CLEAR TEXT
					setrawcookie ($name,$value,$expire,$path,$domain,$secure,$httponly);
				
				}
				
			}else{
				
				//
				// HOOOSTON...VE HAF PROBLEM!
				throw new Exception('A raw cookie failed to be initialized due to missing NAME parameter.');

			}
			
		}catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

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
				if(isset($_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]['_CRNRSTN_COOKIE_ENCRYPT_CIPHER'])){
					
					//
					// OK TO ATTEMPT DELETION OF COOKIE
					self::$cookieName_Encrypted = self::$cookieName_ChecksumSeed.self::$oCRNRSTN_USR->crcINT($name);
					setcookie (self::$cookieName_Encrypted,'', 1 ,$path);
					
				}else{
				
					//
					// NO COOKIE ENCRYPTION. SET COOKIE. 
					setcookie ($name,'', 1,$path);
					
				}

			}else{
				
				//
				// HOOOSTON...VE HAF PROBLEM!
				throw new Exception('Failed to delete cookie due to missing NAME parameter.');

			}

		}catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

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
				if(isset($_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]['_CRNRSTN_COOKIE_ENCRYPT_CIPHER'])){

				    self::$cookieName_Encrypted = self::$cookieName_ChecksumSeed.self::$oCRNRSTN_USR->crcINT($name);

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
				throw new Exception('Failed to get cookie due to missing NAME parameter.');

			}

		}catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

			return false;

		}
		
	}

	private function cookieParamEncrypt($val){
		
		try{

			if(isset($_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]['_CRNRSTN_COOKIE_ENCRYPT_CIPHER'])){
				#
				# Source: http://php.net/manual/en/function.openssl-encrypt.php
				#
				$ivlen = openssl_cipher_iv_length($cipher=$_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]['_CRNRSTN_COOKIE_ENCRYPT_CIPHER']);
				$iv = openssl_random_pseudo_bytes($ivlen);
				$ciphertext_raw = openssl_encrypt($val, $_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]['_CRNRSTN_COOKIE_ENCRYPT_CIPHER'], $_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]['_CRNRSTN_COOKIE_ENCRYPT_SECRET_KEY'], $options=$_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]['_CRNRSTN_COOKIE_ENCRYPT_OPTIONS'], $iv);
				$hmac = hash_hmac($_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]['_CRNRSTN_COOKIE_ENCRYPT_HMAC_ALG'], $ciphertext_raw, $_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]['_CRNRSTN_COOKIE_ENCRYPT_SECRET_KEY'], $as_binary=true);
				$ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
				
				return $ciphertext;

			}else{

				return $val;

			}

		}catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

			return false;

		}
	
	}

	private function cookieParamDecrypt($val){
		try{
			
			if(isset($_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]['_CRNRSTN_COOKIE_ENCRYPT_CIPHER'])){
				#
				# Source: http://php.net/manual/en/function.openssl-encrypt.php
				#
				$c = base64_decode($val);
				$ivlen = openssl_cipher_iv_length($cipher=$_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]['_CRNRSTN_COOKIE_ENCRYPT_CIPHER']);
				$iv = substr($c, 0, $ivlen);
				$hmac = substr($c, $ivlen, $sha2len=32);
				$ciphertext_raw = substr($c, $ivlen+$sha2len);
				$original_plaintext = openssl_decrypt($ciphertext_raw, $_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]['_CRNRSTN_COOKIE_ENCRYPT_CIPHER'], $_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]['_CRNRSTN_COOKIE_ENCRYPT_SECRET_KEY'], $options = $_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]['_CRNRSTN_COOKIE_ENCRYPT_OPTIONS'], $iv);
				$calcmac = hash_hmac($_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]['_CRNRSTN_COOKIE_ENCRYPT_HMAC_ALG'], $ciphertext_raw, $_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$_SESSION['CRNRSTN_'.self::$oCRNRSTN_USR->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY']]['_CRNRSTN_COOKIE_ENCRYPT_SECRET_KEY'], $as_binary = true);
				
				if (hash_equals($hmac, $calcmac))//PHP 5.6+ timing attack safe comparison
				{
					return $original_plaintext;

				}else{
					
					//
					// HOOOSTON...VE HAF PROBLEM!
					throw new Exception('Oops. Something went wrong. Hash_equals comparison failed during data decryption.');

				}
			
			}else{
				
				//
				// NO ENCRYPTION. RETURN VAL
				return $val;

			}
			
		}catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

			return false;

		}

	}	
	
	public function deleteAllCookies($path=NULL){
		
		//
		// LETS TRY WORKING WITH A HANDLE.
		self::$cookie_ARRAY=array_keys($_COOKIE);
		for ($x=0;$x<count(self::$cookie_ARRAY);$x++){
			setcookie(self::$cookie_ARRAY[$x],'', 1,$path);
		}
		
		return true;

	}

	public function __destruct() {

	}

}