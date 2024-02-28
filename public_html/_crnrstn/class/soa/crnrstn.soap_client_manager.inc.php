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
#  CLASS :: crnrstn_soap_client_manager
#  VERSION :: 2.00.0000
#  DATE :: September 22, 2020 @ 1859hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: CRNRSTN :: SOAP Client.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_soap_client_manager {

    private static $oCRNRSTN_n;
	public $result;
	
	protected $cache;
    protected $wsdl;
    protected $client;
    protected $err;

    protected $WSDL_uri;
    protected $cache_TTL;
    protected $use_CURL;
	
	public function __construct($oCRNRSTN_n, $wsdl_uri, $cache_ttl=NULL, $useCURL=NULL){

	    self::$oCRNRSTN_n = $oCRNRSTN_n;
        $cache_ttl_default = self::$oCRNRSTN_n->cache_ttl_default;
        $useCURL_default = self::$oCRNRSTN_n->useCURL_default;

        $this->WSDL_uri = $wsdl_uri;

        if(!isset($cache_ttl)){

            $this->cache_TTL = $cache_ttl_default;

        }else{

            if($cache_ttl==''){

                $this->cache_TTL = $cache_ttl_default;

            }else{

                $this->cache_TTL = $cache_ttl;
            }
        }

        if(!isset($useCURL)){

            $this->use_CURL = $useCURL_default;

        }else{

            if($useCURL==''){

                $this->use_CURL = $useCURL_default;

            }else{

                $this->use_CURL = $useCURL;
            }

        }

        error_log(__LINE__ .' soap client $this->cache_TTL=[' . $this->cache_TTL.'] $this->WSDL_uri=' . $this->WSDL_uri);

        //
        // INITIALIZE CLIENT WITH WSDL
        if($this->WSDL_uri != self::$oCRNRSTN_n->current_location()){	// AVOID INFINITE LOOP WHERE WEB SERVICE STANDS ON CRNRSTN

		    try{

                $this->cache = new wsdlcache('.', $this->cache_TTL);

                $this->wsdl = $this->cache->get($this->WSDL_uri);
				if(is_null($this->wsdl)){


                    $this->wsdl = new wsdl($this->WSDL_uri);

                    $this->err = $this->wsdl->getError();
					if($this->err){

                        error_log(__LINE__ .' soap client OOPS [' . $this->err.'] $this->WSDL_uri=' . $this->WSDL_uri);

						//
						// HOOOSTON...VE HAF PROBLEM!
						throw new Exception('WSDL Constructor Error :: ' . $this->err.' :: WSDL :: ' . $this->WSDL_uri);

					}

                    $this->cache->put($this->wsdl);
					
				}else{

                    $this->wsdl->clearDebug();
                    $this->wsdl->debug('Retrieved from cache');

				}

                error_log(__LINE__ .' soap client new nusoap_client next $this->WSDL_uri=' . $this->WSDL_uri);

				/*
                * @param    string $username
                * @param    string $password
                * @param	string $authtype (basic|digest|certificate|ntlm)
                * @param	array $certRequest (keys must be cainfofile (optional), sslcertfile, sslkeyfile, passphrase, verifypeer (optional), verifyhost (optional): see corresponding options in cURL docs)
                * @access   public

                function setCredentials($username, $password, $authtype = 'basic', $certRequest = array()){
				...
				 * */

				//
				// INSTANTIATE A SOAP CLIENT CLASS OBJECT.
                # nusoap_client ::  __construct($endpoint, $wsdl = false, $proxyhost = false, $proxyport = false, $proxyusername = false, $proxypassword = false, $timeout = 0, $response_timeout = 30, $portName = ''){
                $this->client = new nusoap_client($this->wsdl, true);

                //error_log(__LINE__ .' soap client new nusoap_client die() '.gettype($this->client));
                //die();
                $this->err = $this->client->getError();
				if($this->err){

					//
					// HOOOSTON...VE HAF PROBLEM!
					throw new Exception('SOAP Client Constructor Error :: ' . $this->err);

				}

                $this->client->setUseCurl($this->use_CURL);
				
			}catch (Exception $e){

                self::$oCRNRSTN_n->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);
				
				return false;

			}

		}

	}
	
	//
	// SEND SOAP REQUEST TO WEB SERVICE
	public function sendRequest_SOAP($methodName, $params){
		
		//
		// SEND SOAP REQUEST
		try{

			$this->result = $this->client->call($methodName, $params);
			
			//
			// CHECK FOR A FAULT
			if($this->client->fault){

                //error_log(__LINE__ . ' soap client request client fault.');

                //
				// HOOOSTON...VE HAF PROBLEM!
				throw new Exception('SOAP Client returnContent() Fault :: ' . $this->result);
				
			}else{
				
				//
				// CHECK FOR ERRORS
				$this->err = $this->client->getError();
				
				if($this->err){

                    //error_log(__LINE__ . ' soap client request $this->err=' . $this->err);

                    //
					// HOOOSTON...VE HAF PROBLEM!
					throw new Exception('SOAP Client returnContent() Error :: ' . $this->err);
					
				}else{

                    //error_log(__LINE__ . ' soap client request $this->result=' . print_r($this->result, true));

                    //
					// RETURN RESULT
					return $this->result;

				}

			}
			
		}catch(Exception $e){

            //self::$oCRNRSTN_USR->error_log($this->returnClientRequest(), __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);
            //self::$oCRNRSTN_USR->error_log($this->returnClientResponse(), __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);
            //self::$oCRNRSTN_USR->error_log($this->returnClientGetDebug(), __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);
            //error_log(__LINE__ . ' soap client request $this->result=' . $this->returnClientResponse());

            //
			// SEND THIS THROUGH THE LOGGER OBJECT
            self::$oCRNRSTN_n->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

		}

		/*
        $this->contentOutput_ARRAY[3] = $this->returnClientRequest();   #SOAP Request Details(Content) ::
        $this->contentOutput_ARRAY[5] = $this->returnClientResponse();  #SOAP Response Details(Content) ::
        $this->contentOutput_ARRAY[7] = $this->returnClientGetDebug();  #SOAP Debug(Content) ::

        //
        // CHECK FOR A FAULT
        //if($client->fault){
        if($oUSER->returnSoapFault()){
            echo '<h2 class="the_R">SOAP Fault ::</h2>';
            echo '<div class="content_results_subtitle_divider"></div><p><pre style="font-size:10px;border-bottom:2px solid #F90000;padding-bottom:10px;">';
            print_r($result);
            echo '</pre></p>';

        }else{
            //
            // CHECK FOR ERRORS
            //$err = $client->getError();
            $err = $oUSER->returnSoapError();
            if($err){
                //
                // DISPLAY THE ERROR
                echo '<h2 class="the_R">SOAP Error</h2><pre style="border-bottom:2px solid #F90000;padding-bottom:10px;">' . $err . '</pre>';

            }else{
                //
                // DISPLAY THE RESULT (CONTENT)
                echo '<div class="cb_15"></div><h3 class="content_results_subtitle">Web Services Result ::</h3>';
                echo '<div class="content_results_subtitle_divider"></div><p><pre style="height:100px;font-size:10px;overflow:scroll;border-bottom:2px solid #333;padding-bottom:10px;">';
                #print_r($oUSER->returnSoapResult());
                print_r($oUSER->contentOutput_ARRAY[1]);
                //print_r($result);
                echo '</pre></p>';



            }
        }

        echo '<div class="cb_15"></div><h3 class="content_results_subtitle">SOAP Request Details ::</h3>';
        echo '<p><pre style="font-size:10px;overflow:scroll;border-bottom:2px solid #333;padding-bottom:10px;height:100px;">' . htmlspecialchars($oUSER->contentOutput_ARRAY[3], ENT_QUOTES).'</pre></p>';

        echo '<h3 class="content_results_subtitle">SOAP Response Details ::</h3>';
        echo '<p><pre style="font-size:10px;overflow:scroll;border-bottom:2px solid #333;padding-bottom:10px;height:100px;">' . htmlspecialchars($oUSER->contentOutput_ARRAY[5], ENT_QUOTES).'</pre></p>';

        echo '<h3 class="content_results_subtitle">SOAP Debug ::</h3>';
        echo '<p><pre style="font-size:10px;height:300px;overflow:scroll;border-bottom:2px solid #333;padding-bottom:10px;height:100px;">' . htmlspecialchars($oUSER->contentOutput_ARRAY[7], ENT_QUOTES).'</pre></p>';

		 * */

		return $this->result;

	}

	public function returnError(){

		return $this->client->getError();

	}
	
	public function returnResult(){

		return $this->result;

	}
	
	public function returnClientRequest(){

		return $this->client->request;

	}
	
	public function returnClientResponse(){

		return $this->client->response;

	}
	
	public function returnClientGetDebug(){

		return $this->client->getDebug();

	}

	public function isset_soap_client(){

	    if(isset($this->client)){

	        if(is_object($this->client)){

                return true;

            }else{

                return false;

            }

        }else{

	        return false;

        }

    }
	
	public function __destruct(){

	}
}