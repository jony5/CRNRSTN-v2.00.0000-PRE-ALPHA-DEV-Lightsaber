<?php
/**
* @package CRNRSTN

// J5
// Code is Poetry */
# # C # R # N # R # S # T # N # : : # # # #
#
#        CRNRSTN :: An open source PHP class library supporting enterprise application development that is framed within
#                   the context of mature/rigid RTM protocols.
#        VERSION :: 2.00.0000 PRE-ALPHA-DEV (Lightsaber)
#      TIMESTAMP :: Tuesday, November 28, 2023 @ 16:20:00.065620.
#  DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#         AUTHOR :: Jonathan 'J5' Harris, CEO, CTO, Lead Full Stack Developer, jharris@eVifweb.com, J00000101@gmail.com.
#            URI :: http://crnrstn.evifweb.com/
#       OVERVIEW :: CRNRSTN :: An Open Source PHP Class Library that stands on top of a robust web services oriented
#                   architecture to both facilitate, augment, and enhance (with stability) the operations of a code base
#                   for a web application across multiple hosting environments.
#
#                   CRNRSTN :: is powered by eVifweb; CRNRSTN :: is powered by eCRM Strategy and Execution,
#                   Web Design & Development, and Only The Best Coffee.
#
#                   Copyright (c) 2012-2024 :: eVifweb development :: All Rights Reserved.
#    DESCRIPTION :: CRNRSTN :: is an open source PHP class library that will facilitate and spread (via SOAP services)
#                   operations of a web application across multiple servers or environments (e.g. localhost, stage,
#                   preprod, and production). With this tool, data and functionality possessing characteristics that
#                   inherently create distinctions between one environment and another can all be managed through one
#                   framework for an entire application. IP address restrictions, error logging profiles, and database
#                   authentication credentials are a few areas within an application's architecture where
#                   CRNRSTN :: was designed to excel.
#
#                   Once CRNRSTN :: has been configured to support all of a web application's running servers, one can
#                   seamlessly RTM the codebase of the web site without having to modify the configuration to account
#                   for any unique and environmentally specific parameters. Receive the benefit of a robust and polished
#                   framework that will bubble up logs from exception notifications to any output channel (email, hidden
#                   HTML comment, native default,...etc.) of one's own choosing.
#
#                   Stand on top of the CRNRSTN :: SOAP Services Layer to, for example, organize and strengthen the
#                   communications architecture of any web application. By supporting many-to-one proxy messaging
#                   relationships between slaves and a master "communications server", CRNRSTN :: can streamline and
#                   simplify the management of web application communications; one can configure everything from SMTP
#                   credentials to the character count for line wrapping in the text versions of multi-part HTML email.
#
#                   This is the "King's Highway" for sending email communications.
#        LICENSE :: MIT
#                   Permission is hereby granted, free of charge, to any person obtaining
#                   a copy of this software and associated documentation files (the
#                   "Software"), to deal in the Software without restriction, including
#                   without limitation the rights to use, copy, modify, merge, publish,
#                   distribute, sublicense, and/or sell copies of the Software, and to
#                   permit persons to whom the Software is furnished to do so, subject to
#                   the following conditions:
#
#                   The above copyright notice and this permission notice shall be
#                   included in all copies or substantial portions of the Software.
#
#                   THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
#                   EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
#                   MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
#                   IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
#                   CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
#                   TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
#                   SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
#
# # C # R # N # R # S # T # N # : : # # # #
#
#  CLASS :: crnrstn_cookie_manager
#  VERSION :: 2.00.0000
#  DATE :: September 11, 2012 @ 1720hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: Cookie management on top of the CRNRSTN :: Cookie
#                 Encryption Layer.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_cookie_manager {

    public $oCRNRSTN;

	public static $cookie_ARRAY = array();
	public $config_serial;
	public static $tmp_cookie_name;
	public static $cookieValue_Encrypted;
	public static $cookieName_Encrypted;
	private static $cookieName_ChecksumSeed = 'CRNRSTN';				// SEED CHARS VALID FOR COOKIE NAME.
	public static $thisCookieCrawler_ARRAY = array();

    public function __construct($oCRNRSTN){
		
	    $this->oCRNRSTN = $oCRNRSTN;
	
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
			
		}catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
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
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
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
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
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

		}catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
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

                    // public function preach($data_attribute = 'data_value', $data_key = NULL, $data_type_family = 'CRNRSTN::RESOURCE', $data_auth_request = CRNRSTN_AUTHORIZE_RUNTIME, $index = 0){
                    if($this->oCRNRSTN->oSESSION_MGR->oCRNRSTN_SESSION_DDO->preach('isset', 'encrypt_cipher', 'CRNRSTN::RESOURCE::COOKIE_ENCRYPTION') == true){

                        //
                        // EXTRACT DATA FROM THE CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO).
                        $tmp_encrypt_cipher = $this->oCRNRSTN->oSESSION_MGR->oCRNRSTN_SESSION_DDO->preach('data_value', $this->oCRNRSTN->hash_ddo_memory_pointer('encrypt_cipher', 'CRNRSTN::RESOURCE::COOKIE_ENCRYPTION', CRNRSTN_RESOURCE_ALL), true);
                        $tmp_encrypt_secret_key = $this->oCRNRSTN->oSESSION_MGR->oCRNRSTN_SESSION_DDO->preach('data_value', $this->oCRNRSTN->hash_ddo_memory_pointer('encrypt_secret_key', 'CRNRSTN::RESOURCE::COOKIE_ENCRYPTION', CRNRSTN_RESOURCE_ALL), true);
                        $tmp_encrypt_options = $this->oCRNRSTN->oSESSION_MGR->oCRNRSTN_SESSION_DDO->preach('data_value', $this->oCRNRSTN->hash_ddo_memory_pointer('encrypt_options', 'CRNRSTN::RESOURCE::COOKIE_ENCRYPTION', CRNRSTN_RESOURCE_ALL), true);
                        $tmp_hmac_alg = $this->oCRNRSTN->oSESSION_MGR->oCRNRSTN_SESSION_DDO->preach('data_value', $this->oCRNRSTN->hash_ddo_memory_pointer('hmac_alg', 'CRNRSTN::RESOURCE::COOKIE_ENCRYPTION', CRNRSTN_RESOURCE_ALL), true);

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

		}catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
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

                if($this->oCRNRSTN->oCRNRSTN_ENV->oSESSION_MGR->oCRNRSTN_SESSION_DDO->preach('isset', $this->oCRNRSTN->hash_ddo_memory_pointer('encrypt_cipher', 'CRNRSTN::RESOURCE::DATABASE_ENCRYPTION', CRNRSTN_RESOURCE_ALL), false)){

                    //
                    // EXTRACT DATA FROM THE CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO).
                    $tmp_encrypt_cipher = $this->oCRNRSTN->oSESSION_MGR->oCRNRSTN_SESSION_DDO->preach('data_value', $this->oCRNRSTN->hash_ddo_memory_pointer('encrypt_cipher', 'CRNRSTN::RESOURCE::DATABASE_ENCRYPTION', CRNRSTN_RESOURCE_ALL), false);
                    $tmp_encrypt_secret_key = $this->oCRNRSTN->oSESSION_MGR->oCRNRSTN_SESSION_DDO->preach('data_value', $this->oCRNRSTN->hash_ddo_memory_pointer('encrypt_secret_key', 'CRNRSTN::RESOURCE::DATABASE_ENCRYPTION', CRNRSTN_RESOURCE_ALL), false);
                    $tmp_encrypt_options = $this->oCRNRSTN->oSESSION_MGR->oCRNRSTN_SESSION_DDO->preach('data_value', $this->oCRNRSTN->hash_ddo_memory_pointer('encrypt_options', 'CRNRSTN::RESOURCE::DATABASE_ENCRYPTION', CRNRSTN_RESOURCE_ALL), false);
                    $tmp_hmac_alg = $this->oCRNRSTN->oSESSION_MGR->oCRNRSTN_SESSION_DDO->preach('data_value', $this->oCRNRSTN->hash_ddo_memory_pointer('hmac_alg', 'CRNRSTN::RESOURCE::DATABASE_ENCRYPTION', CRNRSTN_RESOURCE_ALL), false);

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
                        //$tmp_open_ssl_digest_profile = $this->oCRNRSTN->oCRNRSTN_ENV->return_openssl_digest_method();
                        $tmp_open_ssl_digest_profile = $this->oCRNRSTN->get_resource('openssl_cipher', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');
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

                    if(hash_equals($hmac, $calcmac))//PHP 5.6+ timing attack safe comparison
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

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
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