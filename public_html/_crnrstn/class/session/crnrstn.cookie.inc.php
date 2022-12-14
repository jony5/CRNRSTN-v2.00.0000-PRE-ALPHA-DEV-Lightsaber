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

	public $oCRNRSTN;

    public function __construct($oCRNRSTN){
		
	    $this->oCRNRSTN = $oCRNRSTN;
	    
        $this->oLogger = new crnrstn_logging(__CLASS__, $oCRNRSTN);
	 
	}
	
	public function addCookie($name, $value, $expire, $path, $domain, $secure, $httponly){

	    try{

			if(isset($name)){

                //
                // SET THE COOKIE
                return setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);

			}else{
				
				//
				// HOOOSTON...VE HAF PROBLEM!
				throw new Exception('A cookie failed to be initialized due to missing NAME parameter.');

			}
			
		}catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

			return false;

		}

	}
	
	public function addRawCookie($name, $value, $expire, $path, $domain, $secure, $httponly){

	    try{

			if(isset($name)){

                //
                // SET THE RAW COOKIE. CLEAR TEXT
                return setrawcookie($name, $value, $expire, $path, $domain, $secure, $httponly);

			}else{
				
				//
				// HOOOSTON...VE HAF PROBLEM!
				throw new Exception('A raw cookie failed to be initialized due to missing NAME parameter.');

			}

		}catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

	    }
	    
	}
	
	public function deleteCookie($name, $path){
		
		//
		// CHECK FOR REQUIRED INFORMATION
		try{

			if(isset($name)){
				
                //
                // NO COOKIE ENCRYPTION. SET COOKIE.
                return setcookie($name, '', 1, $path);

			}else{
				
				//
				// HOOOSTON...VE HAF PROBLEM!
				throw new Exception('Failed to delete cookie due to missing NAME parameter.');

			}

		}catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

		}

	}
	
	public function getCookie($name){
		
		//
		// CHECK FOR REQUIRED INFORMATION
		try{

			if(isset($name)){

                //
                // NO ENCRYPTION. RETURN COOKIE.
                return $_COOKIE[$name];

			}else{
				
				//
				// HOOOSTON...VE HAF PROBLEM!
				throw new Exception('Failed to get cookie due to missing NAME parameter.');

			}

		}catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

			return false;

		}
		
	}

	private function param_cookie_encrypt($data = NULL, $cipher_override = NULL, $secret_key_override = NULL, $hmac_algorithm_override = NULL, $options_bitwise_override = NULL){
		
		try{

            if(isset($data)){

                //
                // DATA TYPE MUST BE ENCRYPTABLE...AND SAFE FOR URI
                //if(in_array(gettype($data), $this->oCRNRSTN->oCRNRSTN_ENV->encryptableDataTypes)){
                if(isset($this->oCRNRSTN->oCRNRSTN_ENV->encryptableDataTypes[gettype($data)])){

                    if($this->oCRNRSTN->oSESSION_MGR->oCRNRSTN_SESSION_DDO->preach('isset', $this->oCRNRSTN->return_ddo_key('encrypt_cipher', 'CRNRSTN::RESOURCE::COOKIE_ENCRYPTION', CRNRSTN_RESOURCE_ALL), true)) {

                        //
                        // EXTRACT DATA FROM SESSION DDO
                        $tmp_encrypt_cipher = $this->oCRNRSTN->oSESSION_MGR->oCRNRSTN_SESSION_DDO->preach('value', $this->oCRNRSTN->return_ddo_key('encrypt_cipher', 'CRNRSTN::RESOURCE::COOKIE_ENCRYPTION', CRNRSTN_RESOURCE_ALL), true);
                        $tmp_encrypt_secret_key = $this->oCRNRSTN->oSESSION_MGR->oCRNRSTN_SESSION_DDO->preach('value', $this->oCRNRSTN->return_ddo_key('encrypt_secret_key', 'CRNRSTN::RESOURCE::COOKIE_ENCRYPTION', CRNRSTN_RESOURCE_ALL), true);
                        $tmp_encrypt_options = $this->oCRNRSTN->oSESSION_MGR->oCRNRSTN_SESSION_DDO->preach('value', $this->oCRNRSTN->return_ddo_key('encrypt_options', 'CRNRSTN::RESOURCE::COOKIE_ENCRYPTION', CRNRSTN_RESOURCE_ALL), true);
                        $tmp_hmac_alg = $this->oCRNRSTN->oSESSION_MGR->oCRNRSTN_SESSION_DDO->preach('value', $this->oCRNRSTN->return_ddo_key('hmac_alg', 'CRNRSTN::RESOURCE::COOKIE_ENCRYPTION', CRNRSTN_RESOURCE_ALL), true);

                        #
                        # Source: http://php.net/manual/en/function.openssl-encrypt.php
                        #
                        $ivlen = openssl_cipher_iv_length($cipher = $tmp_encrypt_cipher);
                        $iv = openssl_random_pseudo_bytes($ivlen);
                        $ciphertext_raw = openssl_encrypt($data, $tmp_encrypt_cipher, $tmp_encrypt_secret_key, $options = $tmp_encrypt_options, $iv);
                        $hmac = hash_hmac($tmp_hmac_alg, $ciphertext_raw, $tmp_encrypt_secret_key, $as_binary = true);
                        $ciphertext = base64_encode($iv . $hmac . $ciphertext_raw);

                        return $ciphertext;

                    }else{

                        return $data;

                    }

                }else{

                    //
                    // NOT ENCRYPTABLE
                    return NULL;

                }

            }else{

                //
                // NOT ENCRYPTABLE
                return NULL;

            }

		}catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

			return false;

		}

        return NULL;

	}

	private function param_cookie_decrypt($data = NULL, $uri_passthrough = false, $cipher_override =  NULL, $secret_key_override = NULL, $hmac_algorithm_override = NULL, $options_bitwise_override = NULL){

        try{

            if(!isset($data) || $data == ''){

                return NULL;

            }else{

                if($uri_passthrough == true){

                    //
                    // BACK OUT OF URL ENCODING
                    $data = urldecode($data);

                }

                if($this->oCRNRSTN->oCRNRSTN_ENV->oSESSION_MGR->oCRNRSTN_SESSION_DDO->preach('isset', $this->oCRNRSTN->return_ddo_key('encrypt_cipher', 'CRNRSTN::RESOURCE::DATABASE_ENCRYPTION', CRNRSTN_RESOURCE_ALL), false)){

                    //
                    // EXTRACT DATA FROM SESSION DDO
                    $tmp_encrypt_cipher = $this->oCRNRSTN->oSESSION_MGR->oCRNRSTN_SESSION_DDO->preach('value', $this->oCRNRSTN->return_ddo_key('encrypt_cipher', 'CRNRSTN::RESOURCE::DATABASE_ENCRYPTION', CRNRSTN_RESOURCE_ALL), false);
                    $tmp_encrypt_secret_key = $this->oCRNRSTN->oSESSION_MGR->oCRNRSTN_SESSION_DDO->preach('value', $this->oCRNRSTN->return_ddo_key('encrypt_secret_key', 'CRNRSTN::RESOURCE::DATABASE_ENCRYPTION', CRNRSTN_RESOURCE_ALL), false);
                    $tmp_encrypt_options = $this->oCRNRSTN->oSESSION_MGR->oCRNRSTN_SESSION_DDO->preach('value', $this->oCRNRSTN->return_ddo_key('encrypt_options', 'CRNRSTN::RESOURCE::DATABASE_ENCRYPTION', CRNRSTN_RESOURCE_ALL), false);
                    $tmp_hmac_alg = $this->oCRNRSTN->oSESSION_MGR->oCRNRSTN_SESSION_DDO->preach('value', $this->oCRNRSTN->return_ddo_key('hmac_alg', 'CRNRSTN::RESOURCE::DATABASE_ENCRYPTION', CRNRSTN_RESOURCE_ALL), false);

                    //
                    // ENABLE CIPHER OVERRIDE :: v2.0.0
                    if(!isset($cipher_override)){

                        $cipher = $tmp_encrypt_cipher;

                    }else{

                        $cipher = $cipher_override;

                    }

                    if(!isset($secret_key_override)){

                        $secret_key = $tmp_encrypt_secret_key;

                    }else{

                        $secret_key = $secret_key_override;
                        $tmp_open_ssl_digest_profile = $this->oCRNRSTN->oCRNRSTN_ENV->return_openssl_digest_method();
                        $secret_key = openssl_digest($secret_key, $tmp_open_ssl_digest_profile, true);

                    }

                    //
                    // ENABLE OPTIONS BITWISE OVERRIDE :: v2.0.0
                    if(!isset($options_bitwise_override)){

                        $options_bitwise = $tmp_encrypt_options;

                    }else{

                        $options_bitwise = $options_bitwise_override;

                    }

                    //
                    // ENABLE HMAC ALG OVERRIDE :: v2.0.0
                    if(!isset($hmac_algorithm_override)){

                        $hmac_algorithm = $tmp_hmac_alg;

                    }else{

                        $hmac_algorithm = $hmac_algorithm_override;

                    }

                    #
                    # Source: http://php.net/manual/en/function.openssl-encrypt.php
                    #
                    $c = base64_decode($data);
                    $ivlen = openssl_cipher_iv_length($cipher);
                    $iv = substr($c, 0, $ivlen);
                    $hmac = substr($c, $ivlen, $sha2len = 32);
                    $ciphertext_raw = substr($c, $ivlen + $sha2len);
                    $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $secret_key, $options = $options_bitwise, $iv);
                    $calcmac = hash_hmac($hmac_algorithm, $ciphertext_raw, $secret_key, $as_binary = true);

                    if (hash_equals($hmac, $calcmac))//PHP 5.6+ timing attack safe comparison
                    {
                        return $original_plaintext;

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('CRNRSTN :: Tunnel Param Decrypt Notice :: Oops. Something went wrong. Hash_equals comparison failed during data decryption.');

                    }

                }else{

                    //
                    // NO ENCRYPTION. RETURN VAL
                    return $data;

                }

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

	}	
	
	public function deleteAllCookies($path){
		
		//
		// LETS TRY WORKING WITH A HANDLE.
		self::$cookie_ARRAY=array_keys($_COOKIE);

		for($x = 0; $x < count(self::$cookie_ARRAY); $x++){

			setcookie(self::$cookie_ARRAY[$x], '', 1, $path);

		}
		
		return true;

	}

	public function __destruct() {

	}

}