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
#  CLASS :: crnrstn_session_manager
#  VERSION :: 1.00.0001
#  DATE :: September 11, 2012 @ 1720hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: Session management on top of the CRNRSTN :: Session Encryption Layer.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_session_manager {

	//
	//CONFIG SERIAL AND ENCRYPTION KEY FOR CRNRSTN SESSION VALUES
	public $config_serial;
    public $resourceKey;
	private static $cacheSessionParam_ARRAY = array();
	private static $CRNRSTN_ENCRYPT_CIPHER;
	
	protected $oLogger;
	private static $oCOOKIE_MGR;
	private static $encryptableDataTypes = array();
	private static $oCRNRSTN_USR;
	
	public function __construct($oCRNRSTN_n){

	    // $oCRNRSTN_n = $oCRNRSTN_ENV or $oCRNRSTN_USR

        //
        // INITIALIZE CONFIG SERIAL FOR SESSION SERIALIZATION
        //error_log('74 - sess '.get_class($oCRNRSTN_n));
        $this->config_serial = $oCRNRSTN_n->config_serial;
        $this->resourceKey =  $oCRNRSTN_n->return_resource_key();

        //
        // WE NEED THIS LOGGER FOR CRNRSTN :: INITIALIZATION...SO WE NEED CRNRSTN_ACTIVE_LOG_SILO
        // IN SESSION ASAP...SEE CRNRSTN :: CONSTRUCTOR
        //$tmp_log_silo_profile = $_SESSION['CRNRSTN_'.$oCRNRSTN_n->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_ACTIVE_LOG_SILO'];

        //
        // INSTANTIATE LOGGER - WILL BE OVERWRITTEN WITH oCRNRSTN_USR RECEPTION...BUT, LOGGER COULD BE USED BEFORE THEN
        // IF EXCEPTION THROWN DURING CONFIGURATION
        $this->oLogger = new crnrstn_logging($oCRNRSTN_n->CRNRSTN_debugMode, __CLASS__, $oCRNRSTN_n->log_silo_profile, $oCRNRSTN_n);
		
		//
		// INITIALIZE ARRAY OF ENCRYPTABLE DATATYPES
		self::$encryptableDataTypes = array('string', 'integer', 'double', 'float', 'int');
		
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

    public function initialize_oCRNRSTN_USR($oCRNRSTN_USR){

        self::$oCRNRSTN_USR = $oCRNRSTN_USR;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(self::$oCRNRSTN_USR->CRNRSTN_debugMode, __CLASS__, self::$oCRNRSTN_USR->log_silo_profile, self::$oCRNRSTN_USR);

    }
    
    

	public function set_session_param($sessParam, $val = NULL){

	    $tmp_data_type = gettype($val);
        $this->resourceKey = $_SESSION['CRNRSTN_'.$this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY'];

        if(in_array($tmp_data_type, self::$encryptableDataTypes)){

			//
			// CLEAR POTENTIAL CACHE TO FORCE REFRESH
			unset(self::$cacheSessionParam_ARRAY[$sessParam]);
			$_SESSION['CRNRSTN_'.$this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$this->resourceKey]['CRNRSTN_'.$this->crcINT($sessParam)] = $this->sessionParamEncrypt($val);
			$_SESSION['CRNRSTN_'.$this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$this->resourceKey]['CRNRSTN_ENCRYPT_'.$this->crcINT($sessParam)] = 1;
			$_SESSION['CRNRSTN_'.$this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$this->resourceKey]['CRNRSTN_DTYPE_'.$this->crcINT($sessParam)] = $tmp_data_type;
						
		}else{

            //
            // OBJECT CHECK
            if($tmp_data_type == 'object'){

                //
                // CLEAR POTENTIAL CACHE TO FORCE REFRESH
                unset(self::$cacheSessionParam_ARRAY[$sessParam]);
                $_SESSION['CRNRSTN_'.$this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$this->resourceKey]['CRNRSTN_'.$this->crcINT($sessParam)] = serialize($val);
                $_SESSION['CRNRSTN_'.$this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$this->resourceKey]['CRNRSTN_ENCRYPT_'.$this->crcINT($sessParam)] = 1;
                $_SESSION['CRNRSTN_'.$this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$this->resourceKey]['CRNRSTN_DTYPE_'.$this->crcINT($sessParam)] = $tmp_data_type;

            }else{

                //
                // NOT ENCRYPTABLE
                unset(self::$cacheSessionParam_ARRAY[$sessParam]);
                $_SESSION['CRNRSTN_'.$this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$this->resourceKey]['CRNRSTN_'.$this->crcINT($sessParam)] = $val;
                $_SESSION['CRNRSTN_'.$this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$this->resourceKey]['CRNRSTN_ENCRYPT_'.$this->crcINT($sessParam)] = 0;
                $_SESSION['CRNRSTN_'.$this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$this->resourceKey]['CRNRSTN_DTYPE_'.$this->crcINT($sessParam)] = $tmp_data_type;

            }

        }

		return true;

	}
	
	public function get_session_param($sessParam){

		$this->resourceKey = $_SESSION['CRNRSTN_'.$this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY'];

        //
		// RETURN THE VALUE ASSIGNED TO A PARTICULAR SESSION PARAMETER AND ENSURE THAT THE APPROPRIATE TYPE IS CAST
		if(isset($_SESSION['CRNRSTN_'.$this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$this->resourceKey]['CRNRSTN_'.$this->crcINT($sessParam)])){

			if($_SESSION['CRNRSTN_'.$this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$this->resourceKey]['CRNRSTN_ENCRYPT_'.$this->crcINT($sessParam)] > 0){

				switch($_SESSION['CRNRSTN_'.$this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$this->resourceKey]['CRNRSTN_DTYPE_'.$this->crcINT($sessParam)]){
					case 'string':

						if(isset(self::$cacheSessionParam_ARRAY[$sessParam])){

							return self::$cacheSessionParam_ARRAY[$sessParam];

						}else{

							self::$cacheSessionParam_ARRAY[$sessParam] = trim($this->sessionParamDecrypt($_SESSION['CRNRSTN_'.$this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$this->resourceKey]['CRNRSTN_' . $this->crcINT($sessParam)]));

							return self::$cacheSessionParam_ARRAY[$sessParam];

						}

					break;
					case 'integer':

						if(isset(self::$cacheSessionParam_ARRAY[$sessParam])){

							return (integer) self::$cacheSessionParam_ARRAY[$sessParam];

						}else{

							self::$cacheSessionParam_ARRAY[$sessParam] = trim($this->sessionParamDecrypt($_SESSION['CRNRSTN_'.$this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$this->resourceKey]['CRNRSTN_' . $this->crcINT($sessParam)]));

							return (integer) self::$cacheSessionParam_ARRAY[$sessParam];

						}

					break;
					case 'int':

						if(isset(self::$cacheSessionParam_ARRAY[$sessParam])){

							return (int) self::$cacheSessionParam_ARRAY[$sessParam];

						}else{

							self::$cacheSessionParam_ARRAY[$sessParam] = trim($this->sessionParamDecrypt($_SESSION['CRNRSTN_' . $this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$this->resourceKey]['CRNRSTN_' . $this->crcINT($sessParam)]));

							return (int) self::$cacheSessionParam_ARRAY[$sessParam];

						}

					break;
					case 'double':

						if(isset(self::$cacheSessionParam_ARRAY[$sessParam])){

							return (double) self::$cacheSessionParam_ARRAY[$sessParam];

						}else{

							self::$cacheSessionParam_ARRAY[$sessParam] = trim($this->sessionParamDecrypt($_SESSION['CRNRSTN_' . $this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$this->resourceKey]['CRNRSTN_' . $this->crcINT($sessParam)]));

							return (double) self::$cacheSessionParam_ARRAY[$sessParam];

						}

					break;
					case 'float':

						if(isset(self::$cacheSessionParam_ARRAY[$sessParam])){

							return (float) self::$cacheSessionParam_ARRAY[$sessParam];

						}else{

							self::$cacheSessionParam_ARRAY[$sessParam] = trim($this->sessionParamDecrypt($_SESSION['CRNRSTN_' . $this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$this->resourceKey]['CRNRSTN_' . $this->crcINT($sessParam)]));

							return (float) self::$cacheSessionParam_ARRAY[$sessParam];

						}

					break;
                    case 'boolean':

                        if(isset(self::$cacheSessionParam_ARRAY[$sessParam])){

                            return (boolean) self::$cacheSessionParam_ARRAY[$sessParam];

                        }else{

                            self::$cacheSessionParam_ARRAY[$sessParam] = trim($this->sessionParamDecrypt($_SESSION['CRNRSTN_' . $this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$this->resourceKey]['CRNRSTN_' . $this->crcINT($sessParam)]));

                            return (boolean) self::$cacheSessionParam_ARRAY[$sessParam];

                        }

                    break;
                    case 'object':

                        if(isset(self::$cacheSessionParam_ARRAY[$sessParam])){

                            return (object) self::$cacheSessionParam_ARRAY[$sessParam];

                        }else{

                            self::$cacheSessionParam_ARRAY[$sessParam] = unserialize($_SESSION['CRNRSTN_' . $this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$this->resourceKey]['CRNRSTN_' . $this->crcINT($sessParam)]);

                            return (object) self::$cacheSessionParam_ARRAY[$sessParam];

                        }

                    break;

				}
			
			}else{

				//
				// NO ENCRYPTION APPLIED TO PARAM. RETURN SESSION VALUE.
				return $_SESSION['CRNRSTN_' . $this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$this->resourceKey]['CRNRSTN_' . $this->crcINT($sessParam)];

			}

		}else{

			return false;

		}

		return false;

	}
	
	public function isset_session_param($sessParam){

		$this->resourceKey = $_SESSION['CRNRSTN_'.$this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY'];
		
		//
		// RETURN THE VALUE ASSIGNED TO A PARTICULAR SESSION PARAMETER
		if(isset($_SESSION['CRNRSTN_'.$this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$this->resourceKey]['CRNRSTN_'.$this->crcINT($sessParam)])){
			
			//
			// IF SESSION ENCRYPTION IS ENABLED, WE HAVE TO DECRYPT BEFORE WE CAN CHECK IF EMPTY
			if($_SESSION['CRNRSTN_'.$this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$this->resourceKey]['CRNRSTN_ENCRYPT_'.$this->crcINT($sessParam)]>0){

				if(isset(self::$cacheSessionParam_ARRAY[$sessParam])){

					if(self::$cacheSessionParam_ARRAY[$sessParam]!=""){

						return true;

					}else{

						return false;

					}

				}else{

                    if($_SESSION['CRNRSTN_'.$this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$this->resourceKey]['CRNRSTN_DTYPE_'.$this->crcINT($sessParam)] == 'object'){

                        self::$cacheSessionParam_ARRAY[$sessParam] = unserialize($_SESSION['CRNRSTN_'.$this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$this->resourceKey]['CRNRSTN_'.$this->crcINT($sessParam)]);

                        if(is_object(self::$cacheSessionParam_ARRAY[$sessParam])){

                            return true;

                        }else{

                            return false;

                        }

                    }else{

                        self::$cacheSessionParam_ARRAY[$sessParam] = trim($this->sessionParamDecrypt($_SESSION['CRNRSTN_'.$this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$this->resourceKey]['CRNRSTN_'.$this->crcINT($sessParam)]));

                        if(self::$cacheSessionParam_ARRAY[$sessParam]!=""){

                            return true;

                        }else{

                            return false;

                        }

                    }



				}
			
			}else{
				
				//
				// NO ENCRYPTION APPLIED TO PARAM. CHECK IF EMPTY.
				if($_SESSION['CRNRSTN_'.$this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_'.$this->resourceKey]['CRNRSTN_'.$this->crcINT($sessParam)]!=""){

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

		return $_SESSION['CRNRSTN_'.$this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY'];
		
	}
	
	public function setSessionIp($key, $ip){

		$_SESSION['CRNRSTN_'.$this->crcINT($this->config_serial).$this->crcINT($key)] = md5($ip);

	}
	
	public function getSessionIp(){

		if(isset($_SESSION['CRNRSTN_'.$this->crcINT($this->config_serial).$this->crcINT('SESSION_IP')])){

			return $_SESSION['CRNRSTN_'.$this->crcINT($this->config_serial).$this->crcINT('SESSION_IP')];

		}else{

			return false;

		}

	}

	private function sessionParamEncrypt($val){

		try{

			if(isset($_SESSION['CRNRSTN_'.$this->crcINT($this->config_serial)]['CRNRSTN_'.$this->resourceKey]['_CRNRSTN_SESS_ENCRYPT_CIPHER'])){
				
				#
				# Source: http://php.net/manual/en/function.openssl-encrypt.php
				#
				$ivlen = openssl_cipher_iv_length($cipher=$_SESSION['CRNRSTN_'.$this->crcINT($this->config_serial)]['CRNRSTN_'.$this->resourceKey]['_CRNRSTN_SESS_ENCRYPT_CIPHER']);
				$iv = openssl_random_pseudo_bytes($ivlen);
				$ciphertext_raw = openssl_encrypt($val, $_SESSION['CRNRSTN_'.$this->crcINT($this->config_serial)]['CRNRSTN_'.$this->resourceKey]['_CRNRSTN_SESS_ENCRYPT_CIPHER'], $_SESSION['CRNRSTN_'.$this->crcINT($this->config_serial)]['CRNRSTN_'.$this->resourceKey]['_CRNRSTN_SESS_ENCRYPT_SECRET_KEY'], $options=$_SESSION['CRNRSTN_'.$this->crcINT($this->config_serial)]['CRNRSTN_'.$this->resourceKey]['_CRNRSTN_SESS_ENCRYPT_OPTIONS'], $iv);
				$hmac = hash_hmac($_SESSION['CRNRSTN_'.$this->crcINT($this->config_serial)]['CRNRSTN_'.$this->resourceKey]['_CRNRSTN_SESS_ENCRYPT_HMAC_ALG'], $ciphertext_raw, $_SESSION['CRNRSTN_'.$this->crcINT($this->config_serial)]['CRNRSTN_'.$this->resourceKey]['_CRNRSTN_SESS_ENCRYPT_SECRET_KEY'], $as_binary=true);
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
	 
	private function sessionParamDecrypt($val){

		try{

			if(isset($_SESSION['CRNRSTN_'.$this->crcINT($this->config_serial)]['CRNRSTN_'.$this->resourceKey]['_CRNRSTN_SESS_ENCRYPT_CIPHER'])){

				#
				# Source: http://php.net/manual/en/function.openssl-encrypt.php
				#
				$c = base64_decode($val);
				$ivlen = openssl_cipher_iv_length($cipher=$_SESSION['CRNRSTN_'.$this->crcINT($this->config_serial)]['CRNRSTN_'.$this->resourceKey]['_CRNRSTN_SESS_ENCRYPT_CIPHER']);
				$iv = substr($c, 0, $ivlen);
				$hmac = substr($c, $ivlen, $sha2len=32);
				$ciphertext_raw = substr($c, $ivlen+$sha2len);
				$original_plaintext = openssl_decrypt($ciphertext_raw, $_SESSION['CRNRSTN_'.$this->crcINT($this->config_serial)]['CRNRSTN_'.$this->resourceKey]['_CRNRSTN_SESS_ENCRYPT_CIPHER'], $_SESSION['CRNRSTN_'.$this->crcINT($this->config_serial)]['CRNRSTN_'.$this->resourceKey]['_CRNRSTN_SESS_ENCRYPT_SECRET_KEY'], $options=$_SESSION['CRNRSTN_'.$this->crcINT($this->config_serial)]['CRNRSTN_'.$this->resourceKey]['_CRNRSTN_SESS_ENCRYPT_OPTIONS'], $iv);
				$calcmac = hash_hmac($_SESSION['CRNRSTN_'.$this->crcINT($this->config_serial)]['CRNRSTN_'.$this->resourceKey]['_CRNRSTN_SESS_ENCRYPT_HMAC_ALG'], $ciphertext_raw, $_SESSION['CRNRSTN_'.$this->crcINT($this->config_serial)]['CRNRSTN_'.$this->resourceKey]['_CRNRSTN_SESS_ENCRYPT_SECRET_KEY'], $as_binary=true);
				
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
                //error_log('316 session - NO ENCRYPTION. RETURN VAL.');
				return $val;

			}
			
		}catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

			return false;

		}

	}

    public function crcINT($value){

        $value = crc32($value);
        return sprintf("%u", $value);

    }

	public function __destruct() {

    }

}