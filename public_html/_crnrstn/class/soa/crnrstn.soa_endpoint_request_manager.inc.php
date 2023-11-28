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
#         AUTHOR :: Jonathan 'J5' Harris, CEO, CTO, Lead Full Stack Developer.
#            URI :: http://crnrstn.evifweb.com/
#       OVERVIEW :: CRNRSTN :: An Open Source PHP Class Library that stands on top of a robust web services oriented
#                   architecture to both facilitate, augment, and enhance (with stability) the operations of a code base
#                   for a web application across multiple hosting environments.
#
#                   Copyright (C) 2012-2023 eVifweb development.
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
#                   For example, stand on top of the CRNRSTN :: SOAP services layer to organize and strengthen the
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
#  CLASS :: crnrstn_soa_endpoint_request_manager
#  VERSION :: 2.00.0000
#  DATE :: September 22, 2020 @ 1501hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: CRNRSTN :: SOAP Server Request Manager.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#  NUMBERS 20:17 - PLEASE LET US PASS THROUGH YOUR LAND. WE WILL NOT
#                  PASS THROUGH FIELD OR THROUGH VINEYARD, NOR WILL
#                  WE WATER FROM ANY WELL; WE WILL GO ALONG THE KING'S
#                  HIGHWAY, NOT TURNING ASIDE TO THE RIGHT OR TO THE
#                  LEFT, UNTIL WE PASS THROUGH YOUR TERRITORY.
#
class crnrstn_soa_endpoint_request_manager {

	public $soapResponse_ARRAY = array();
	
	protected $oLogger;
    public $oCRNRSTN_USR;
    private static $oSoapRequest;
    protected $oLog_ProfileManager;

    protected $SOAP_request_isEncrypted = false;
    protected $SOAP_request_sendSuppression = true;
    protected $SOAP_request_flag_sendSuppression_ARRAY = array();
    protected $SOAP_startTime;

    protected $tmp_starttime;
    protected $tmp_starttime_ARRAY;
    protected $tmp_precise_timestamp;

    protected $profile_endpoint_data_ARRAY = array();
	
	public function __construct($oCRNRSTN_USR){

	    $this->oCRNRSTN_USR = $oCRNRSTN_USR;

        $this->tmp_starttime = $this->oCRNRSTN_USR->starttime;
        $this->tmp_starttime_ARRAY = explode('.', $this->tmp_starttime);
        $this->tmp_precise_timestamp = date('Y-m-d H:i:s', $this->tmp_starttime_ARRAY[0]);
        $this->tmp_precise_timestamp .= '.' . $this->tmp_starttime_ARRAY[1];

        //
        // INSTANTIATE LOGGER  CLASS OBJECT
        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN_USR);

	}

	public function tunnelEncryptCalibrationRequest($oSoapRequest){

        self::$oSoapRequest = $oSoapRequest;

        error_log(__LINE__ .' SERVER - tunnelEncryptCalibrationRequest() REQUEST RECEIVED self::$oSoapRequest['.print_r($oSoapRequest, true).'].');

        $this->tmp_starttime = $this->oCRNRSTN_USR->starttime;
        $this->tmp_starttime_ARRAY = explode('.', $this->tmp_starttime);
        $this->tmp_precise_timestamp = date('Y-m-d H:i:s', $this->tmp_starttime_ARRAY[0]);
        $this->tmp_precise_timestamp .= '.' . $this->tmp_starttime_ARRAY[1];

        $tmp_CRNRSTN_PACKET_IS_ENCRYPTED = $this->return_requestParam('CRNRSTN_PACKET_IS_ENCRYPTED', __METHOD__);
        //$tmp_CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES = $this->return_requestParam('CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES', __METHOD__);
        //$tmp_CRNRSTN_SOAP_SVC_METHOD_REQUESTED = $this->return_requestParam('CRNRSTN_SOAP_SVC_METHOD_REQUESTED', __METHOD__);
        //$tmp_CRNRSTN_SOAP_ACTION_TYPE = $this->return_requestParam('CRNRSTN_SOAP_ACTION_TYPE', __METHOD__);
        $tmp_SOAP_ENCRYPT_CIPHER = $this->return_requestParam('SOAP_ENCRYPT_CIPHER', __METHOD__);
        $tmp_SOAP_ENCRYPT_SECRET_KEY = $this->return_requestParam('SOAP_ENCRYPT_SECRET_KEY', __METHOD__);
        $tmp_SOAP_ENCRYPT_HMAC_ALG = $this->return_requestParam('SOAP_ENCRYPT_HMAC_ALG', __METHOD__);
        $tmp_SOAP_ENCRYPT_OPTIONS = $this->return_requestParam('SOAP_ENCRYPT_OPTIONS', __METHOD__);
        $tmp_SERVER_NAME_SOAP_CLIENT = $this->return_requestParam('SERVER_NAME_SOAP_CLIENT', __METHOD__);
        $tmp_SERVER_ADDRESS_SOAP_CLIENT = $this->return_requestParam('SERVER_ADDRESS_SOAP_CLIENT', __METHOD__);

        if($tmp_SERVER_ADDRESS_SOAP_CLIENT == ''){

            $tmp_SERVER_ADDRESS_SOAP_CLIENT = $this->oCRNRSTN_USR->client_ip();

        }

        if($tmp_CRNRSTN_PACKET_IS_ENCRYPTED != 'FALSE'){

            //
            // UNABLE TO DECRYPT DUE TO UNKNOWN CLIENT ENCRYPTION PROFILE AT PROXY
            //error_log(__LINE__ .' SERVER - tunnelEncryptCalibrationRequest() UNABLE TO DECRYPT DUE TO UNKNOWN CLIENT ENCRYPTION PROFILE AT PROXY');
            $tmp_array = array(
                'CRNRSTN_PACKET_IS_ENCRYPTED' => 'FALSE',
                'SOAP_SERVICES_AUTH_STATUS' => 'REQUEST REJECTED',
                'STATUS_CODE' => '418',
                'STATUS_MESSAGE' => 'The CRNRSTN :: SOAP Services Layer understood the request, but is expecting clear text data to initiate this handshake . ',
                'ISERROR_CODE' => '418',
                'ISERROR_MESSAGE' => '418 I\'m a teapot.',
                'SERVER_NAME_SOAP_SERVER' => $_SERVER['SERVER_NAME'],
                'SERVER_ADDRESS_SOAP_SERVER' => $_SERVER['SERVER_ADDR'],
                'SERVER_NAME_SOAP_CLIENT' => $tmp_SERVER_NAME_SOAP_CLIENT,
                'SERVER_ADDRESS_SOAP_CLIENT' => $tmp_SERVER_ADDRESS_SOAP_CLIENT,
                'DATE_RECEIVED_SOAP_REQUEST' => $this->tmp_precise_timestamp,
                'DATE_CREATED_SOAP_RESPONSE' => $this->oCRNRSTN_USR->return_micro_time(),
                'SOAP_OPERATION_RUNTIME_SECONDS' => $this->oCRNRSTN_USR->wall_time()

            );

        }else{

            //$tmp_SOAP_ENCRYPT_SECRET_KEY = $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY');
            //error_log(__LINE__ .' SERVER - tunnelEncryptCalibrationRequest() SUCCESS.');
            //error_log(__LINE__ .' SERVER - tunnelEncryptCalibrationRequest [' . $tmp_SOAP_ENCRYPT_CIPHER.'][' . $tmp_SOAP_ENCRYPT_SECRET_KEY.'][' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'][' . $tmp_SOAP_ENCRYPT_OPTIONS.']');

            error_log(__LINE__ .' SERVER - SEND TO CLIENT=> SOAP_ENCRYPT_HMAC_ALG=' . $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'));
            error_log(__LINE__ .' SERVER - SEND TO CLIENT=> SOAP_ENCRYPT_CIPHER=' . $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'));

            //
            // SERVER SOAP RESPONSE - SUCCESS
            $tmp_array = array(
                'CRNRSTN_PACKET_IS_ENCRYPTED' => 'TRUE',
                'SOAP_SERVICES_AUTH_STATUS' => $this->oCRNRSTN_USR->data_encrypt('AUTHORIZATION GRANTED', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS),
                'SOAP_ENCRYPT_CIPHER' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS),
                'SOAP_ENCRYPT_HMAC_ALG' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS),
                'SOAP_ENCRYPT_OPTIONS' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS'), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS),
                'STATUS_CODE' => $this->oCRNRSTN_USR->data_encrypt('200', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS),
                'STATUS_MESSAGE' => $this->oCRNRSTN_USR->data_encrypt('Success.', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS),
                'ISERROR_CODE' => $this->oCRNRSTN_USR->data_encrypt('420', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS),
                'ISERROR_MESSAGE' => $this->oCRNRSTN_USR->data_encrypt('Enhance Your Calm.', CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS),
                'SERVER_NAME_SOAP_SERVER' => $this->oCRNRSTN_USR->data_encrypt($_SERVER['SERVER_NAME'], CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS),
                'SERVER_ADDRESS_SOAP_SERVER' => $this->oCRNRSTN_USR->data_encrypt($_SERVER['SERVER_ADDR'], CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS),
                'SERVER_NAME_SOAP_CLIENT' => $this->oCRNRSTN_USR->data_encrypt($tmp_SERVER_NAME_SOAP_CLIENT, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS),
                'SERVER_ADDRESS_SOAP_CLIENT' => $this->oCRNRSTN_USR->data_encrypt($tmp_SERVER_ADDRESS_SOAP_CLIENT, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS),
                'DATE_RECEIVED_SOAP_REQUEST' => $this->oCRNRSTN_USR->data_encrypt($this->tmp_precise_timestamp, CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS),
                'DATE_CREATED_SOAP_RESPONSE' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->return_micro_time(), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS),
                'SOAP_OPERATION_RUNTIME_SECONDS' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->wall_time(), CRNRSTN_ENCRYPT_SOAP, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS)
            );
        }

        return $tmp_array;

    }

	public function mayItakeTheKingsHighway($oSoapRequest){

        self::$oSoapRequest = $oSoapRequest;
        error_log(__LINE__ .' SERVER - mayItakeTheKingsHighway() REQUEST RECEIVED. ['.print_r(self::$oSoapRequest, true).']');

        $tmp_SERVER_NAME_SOAP_CLIENT = $this->return_requestParam('SERVER_NAME_SOAP_CLIENT', __METHOD__);
        error_log(__LINE__ .' SERVER - mayItakeTheKingsHighway() $tmp_SERVER_NAME_SOAP_CLIENT=' . $tmp_SERVER_NAME_SOAP_CLIENT);

        $tmp_SERVER_ADDRESS_SOAP_CLIENT = $this->return_requestParam('SERVER_ADDRESS_SOAP_CLIENT', __METHOD__);
        error_log(__LINE__ .' SERVER - mayItakeTheKingsHighway() $tmp_SERVER_ADDRESS_SOAP_CLIENT=' . $tmp_SERVER_ADDRESS_SOAP_CLIENT);

        if($tmp_SERVER_ADDRESS_SOAP_CLIENT == ''){

            $tmp_SERVER_ADDRESS_SOAP_CLIENT = $this->oCRNRSTN_USR->client_ip();

        }

        if($this->return_requestParam('CRNRSTN_PACKET_IS_ENCRYPTED', __METHOD__) != 'TRUE'){

            $this->tmp_starttime = $this->oCRNRSTN_USR->starttime;
            $this->tmp_starttime_ARRAY = explode('.', $this->tmp_starttime);
            $this->tmp_precise_timestamp = date('Y-m-d H:i:s', $this->tmp_starttime_ARRAY[0]);
            $this->tmp_precise_timestamp .= '.' . $this->tmp_starttime_ARRAY[1];

            //
            // DO NOT WORK WITH UNENCRYPTED SOAP DATA. RETURN ERROR SOAP RESPONSE.
            $tmp_array = array(
                'CRNRSTN_PACKET_IS_ENCRYPTED' => 'FALSE',
                'SOAP_SERVICES_AUTH_STATUS' => 'ACCESS DENIED',
                'STATUS_CODE' => '401',
                'STATUS_MESSAGE' => 'The CRNRSTN :: SOAP Services Layer understood the request, but is expecting to receive encrypted data for the completion of this handshake.',
                'ISERROR_CODE' => '401',
                'ISERROR_MESSAGE' => '401 Unauthorized.',
                'SERVER_NAME_SOAP_SERVER' => $_SERVER['SERVER_NAME'],
                'SERVER_ADDRESS_SOAP_SERVER' => $_SERVER['SERVER_ADDR'],
                'SERVER_NAME_SOAP_CLIENT' => $tmp_SERVER_NAME_SOAP_CLIENT,
                'SERVER_ADDRESS_SOAP_CLIENT' => $tmp_SERVER_ADDRESS_SOAP_CLIENT,
                'DATE_RECEIVED_SOAP_REQUEST' => $this->tmp_precise_timestamp,
                'DATE_CREATED_SOAP_RESPONSE' => $this->oCRNRSTN_USR->return_micro_time(),
                'SOAP_OPERATION_RUNTIME_SECONDS' => $this->oCRNRSTN_USR->wall_time()
            );

        }else{

            $this->tmp_starttime = $this->oCRNRSTN_USR->starttime;
            $this->tmp_starttime_ARRAY = explode('.', $this->tmp_starttime);
            $this->tmp_precise_timestamp = date('Y-m-d H:i:s', $this->tmp_starttime_ARRAY[0]);
            $this->tmp_precise_timestamp .= '.' . $this->tmp_starttime_ARRAY[1];

            /*
             [Sat Apr 24 04:54:40.242828 2021] [:error] [pid 42928] [client 172.16.195.132:58262]
            227 SERVER - decrypt un with

            [AES-256-CTR]
            [wE15$3du*4kvd.a"}|R0-+3kl,X1~8-^?+3$dbVVm%flKnd]
            [ripemd256]
            [1]
            [6GqJuRLglPhSqZiT9QognLzenXTTKMblq7p6Sd3hLizFZQWdUeElX1aY4l4NXOAbugVS6kaXyvXKfgEeK%2F4B5ZNj4F6o%2Bu93xGU%3D]

             * */

            error_log(__LINE__ .' SERVER - decrypt un with [' . $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER').'][' . $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY').'][' . $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG').'][' . $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS').'] [' . $this->return_requestParam('CRNRSTN_SOAP_SVC_USERNAME', __METHOD__).']');
            $tmp_CRNRSTN_SOAP_SVC_USERNAME = $this->oCRNRSTN_USR->data_decrypt($this->return_requestParam('CRNRSTN_SOAP_SVC_USERNAME', __METHOD__), CRNRSTN_ENCRYPT_SOAP, true, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS'));
            $tmp_CRNRSTN_SOAP_SVC_PASSWORD = $this->oCRNRSTN_USR->data_decrypt($this->return_requestParam('CRNRSTN_SOAP_SVC_PASSWORD', __METHOD__), CRNRSTN_ENCRYPT_SOAP, true, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS'));

            $_SESSION['CRNRSTN_SOAP_SVC_USERNAME'] = $tmp_CRNRSTN_SOAP_SVC_USERNAME;

            //error_log(__LINE__ .' SERVER - mayItakeTheKingsHighway decrypt with [' . $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER').'][' . $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY').'][' . $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG').'][' . $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS').']');
            $tmp_CRNRSTN_SOAP_SVC_AUTH_KEY = $this->oCRNRSTN_USR->data_decrypt($this->return_requestParam('CRNRSTN_SOAP_SVC_AUTH_KEY', __METHOD__), CRNRSTN_ENCRYPT_SOAP, true, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS'));
            $tmp_CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES = $this->oCRNRSTN_USR->data_decrypt($this->return_requestParam('CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES', __METHOD__), CRNRSTN_ENCRYPT_SOAP, true,  $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS'));
            $tmp_CRNRSTN_SOAP_SVC_METHOD_REQUESTED = $this->oCRNRSTN_USR->data_decrypt($this->return_requestParam('CRNRSTN_SOAP_SVC_METHOD_REQUESTED', __METHOD__), CRNRSTN_ENCRYPT_SOAP, true,  $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS'));
            $tmp_CRNRSTN_SOAP_ACTION_TYPE = $this->oCRNRSTN_USR->data_decrypt($this->return_requestParam('CRNRSTN_SOAP_ACTION_TYPE', __METHOD__), CRNRSTN_ENCRYPT_SOAP, true,  $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS'));

            error_log(__LINE__ .' SERVER [' . $tmp_CRNRSTN_SOAP_SVC_AUTH_KEY.'][' . $tmp_CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES.'][' . $tmp_CRNRSTN_SOAP_SVC_METHOD_REQUESTED.'][' . $tmp_CRNRSTN_SOAP_ACTION_TYPE.']');

            if($this->oCRNRSTN_USR->isAuthorized_SOAP_request($tmp_CRNRSTN_SOAP_SVC_AUTH_KEY, $tmp_CRNRSTN_SOAP_SVC_USERNAME, $tmp_CRNRSTN_SOAP_SVC_PASSWORD, $tmp_CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES, $tmp_CRNRSTN_SOAP_SVC_METHOD_REQUESTED, $tmp_CRNRSTN_SOAP_ACTION_TYPE)){

                //error_log(__LINE__ .' SERVER - USERNAME(1/2)=' . $tmp_CRNRSTN_SOAP_SVC_USERNAME);
                $tmp_array = array(
                    'CRNRSTN_PACKET_IS_ENCRYPTED' => 'TRUE',
                    'CRNRSTN_SOAP_SVC_AUTH_KEY' => $this->oCRNRSTN_USR->data_encrypt($tmp_CRNRSTN_SOAP_SVC_AUTH_KEY, CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'CRNRSTN_SOAP_SVC_USERNAME' => $this->oCRNRSTN_USR->data_encrypt($tmp_CRNRSTN_SOAP_SVC_USERNAME, CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'SOAP_SERVICES_AUTH_STATUS' => $this->oCRNRSTN_USR->data_encrypt('AUTHORIZATION GRANTED', CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'SOAP_ENCRYPT_CIPHER' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->return_SOAP_svc_oClient_meta('SOAP_ENCRYPT_CIPHER', $tmp_CRNRSTN_SOAP_SVC_USERNAME, $tmp_CRNRSTN_SOAP_SVC_PASSWORD), CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'SOAP_ENCRYPT_SECRET_KEY' => $this->oCRNRSTN_USR->data_encrypt('this -is the new secret K3y!', CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'SOAP_ENCRYPT_HMAC_ALG' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->return_SOAP_svc_oClient_meta('SOAP_ENCRYPT_HMAC_ALG', $tmp_CRNRSTN_SOAP_SVC_USERNAME, $tmp_CRNRSTN_SOAP_SVC_PASSWORD), CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'SOAP_ENCRYPT_OPTIONS' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->return_SOAP_svc_oClient_meta('SOAP_ENCRYPT_OPTIONS', $tmp_CRNRSTN_SOAP_SVC_USERNAME, $tmp_CRNRSTN_SOAP_SVC_PASSWORD), CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'STATUS_CODE' => $this->oCRNRSTN_USR->data_encrypt('200', CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'STATUS_MESSAGE' => $this->oCRNRSTN_USR->data_encrypt('Success.', CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'ISERROR_CODE' => $this->oCRNRSTN_USR->data_encrypt('420', CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'ISERROR_MESSAGE' => $this->oCRNRSTN_USR->data_encrypt('Enhance Your Calm.', CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'SERVER_NAME_SOAP_SERVER' => $this->oCRNRSTN_USR->data_encrypt($_SERVER['SERVER_NAME'], CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'SERVER_ADDRESS_SOAP_SERVER' => $this->oCRNRSTN_USR->data_encrypt($_SERVER['SERVER_ADDR'], CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'SERVER_NAME_SOAP_CLIENT' => $this->oCRNRSTN_USR->data_encrypt($tmp_SERVER_NAME_SOAP_CLIENT, CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'SERVER_ADDRESS_SOAP_CLIENT' => $this->oCRNRSTN_USR->data_encrypt($tmp_SERVER_ADDRESS_SOAP_CLIENT, CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'),  $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'DATE_RECEIVED_SOAP_REQUEST' => $this->oCRNRSTN_USR->data_encrypt($this->tmp_precise_timestamp, CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'DATE_CREATED_SOAP_RESPONSE' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->return_micro_time(), CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'SOAP_OPERATION_RUNTIME_SECONDS' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->wall_time(), CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS'))
                );

                //error_log(__LINE__ .' SERVER - USERNAME(2/2)=' . $tmp_CRNRSTN_SOAP_SVC_USERNAME);

            }else{

                $tmp_array = array(
                    'CRNRSTN_PACKET_IS_ENCRYPTED' => 'FALSE',
                    'CRNRSTN_SOAP_SVC_USERNAME' => $tmp_CRNRSTN_SOAP_SVC_USERNAME,
                    'SOAP_SERVICES_AUTH_STATUS' => 'ACCESS DENIED',
                    'STATUS_CODE' => '401',
                    'STATUS_MESSAGE' => 'The CRNRSTN :: SOAP Services Layer understood the request, but is refusing to authorise it.',
                    'ISERROR_CODE' => '401',
                    'ISERROR_MESSAGE' => '401 Unauthorized.',
                    'SERVER_NAME_SOAP_SERVER' => $_SERVER['SERVER_NAME'],
                    'SERVER_ADDRESS_SOAP_SERVER' => $_SERVER['SERVER_ADDR'],
                    'SERVER_NAME_SOAP_CLIENT' => $tmp_SERVER_NAME_SOAP_CLIENT,
                    'SERVER_ADDRESS_SOAP_CLIENT' => $tmp_SERVER_ADDRESS_SOAP_CLIENT,
                    'DATE_RECEIVED_SOAP_REQUEST' => $this->tmp_precise_timestamp,
                    'DATE_CREATED_SOAP_RESPONSE' => $this->oCRNRSTN_USR->return_micro_time(),
                    'SOAP_OPERATION_RUNTIME_SECONDS' => $this->oCRNRSTN_USR->wall_time()
                );

            }

        }

        return $tmp_array;

    }

	public function takeTheKingsHighway($oSoapRequest){

	    try{

            self::$oSoapRequest = $oSoapRequest;

            $this->tmp_starttime_ARRAY = explode('.', $this->tmp_starttime);
            $this->tmp_precise_timestamp = date('Y-m-d H:i:s', $this->tmp_starttime_ARRAY[0]);
            $this->tmp_precise_timestamp .= '.' . $this->tmp_starttime_ARRAY[1];

            $tmp_CRNRSTN_PACKET_IS_ENCRYPTED = $this->return_requestParam('CRNRSTN_PACKET_IS_ENCRYPTED', __METHOD__);
            $tmp_SERVER_NAME_SOAP_CLIENT = $this->return_requestParam('SERVER_NAME_SOAP_CLIENT', __METHOD__);
            $tmp_SERVER_ADDRESS_SOAP_CLIENT = $this->return_requestParam('SERVER_ADDRESS_SOAP_CLIENT', __METHOD__);

            if($tmp_SERVER_ADDRESS_SOAP_CLIENT == ''){

                $tmp_SERVER_ADDRESS_SOAP_CLIENT = $this->oCRNRSTN_USR->client_ip();

            }

            if($tmp_CRNRSTN_PACKET_IS_ENCRYPTED != 'TRUE'){

                //
                // RECEIVE SOAP DATA PACK WITH BATCH DATA FOR STRAIGHT EMAIL OUT
                $tmp_array = array(
                    'CRNRSTN_PACKET_IS_ENCRYPTED' => 'FALSE',
                    'SOAP_SERVICES_AUTH_STATUS' => 'ACCESS DENIED',
                    'TOTAL_EMAILS_RECEIVED' => '0',
                    'TOTAL_EMAILS_SENT' => '0',
                    'TOTAL_EMAILS_SUPPRESSED' => '0',
                    'TOTAL_EMAILS_ERROR' => '0',
                    'ACTIVITY_STATUS_MESSAGE' => 'SOAP request rejected by proxy due to lack of encryption.',
                    'oACTIVITY_STATUS_REPORT' => '',
                    'STATUS_CODE' => '401',
                    'STATUS_MESSAGE' => 'The CRNRSTN :: SOAP Services Layer understood the SOAP request, but, due to lack of encryption therein, is refusing to authorise it.',
                    'ISERROR_CODE' => '401',
                    'ISERROR_MESSAGE' => '401 Unauthorized.',
                    'SERVER_NAME_SOAP_SERVER' => $_SERVER['SERVER_NAME'],
                    'SERVER_ADDRESS_SOAP_SERVER' => $_SERVER['SERVER_ADDR'],
                    'SERVER_NAME_SOAP_CLIENT' => $tmp_SERVER_NAME_SOAP_CLIENT,
                    'SERVER_ADDRESS_SOAP_CLIENT' => $tmp_SERVER_ADDRESS_SOAP_CLIENT,
                    'DATE_RECEIVED_SOAP_REQUEST' => $this->tmp_precise_timestamp,
                    'DATE_CREATED_SOAP_RESPONSE' => $this->oCRNRSTN_USR->return_micro_time(),
                    'SOAP_OPERATION_RUNTIME_SECONDS' => $this->oCRNRSTN_USR->wall_time()

                );

            }else{

                error_log(__LINE__ .' SERVER - [' . $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER').'][' . $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY').'][' . $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG').'][' . $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS').']');
                error_log(__LINE__ .' - S.E.R.M. Connectivity Test - CRNRSTN_SOAP_SVC_AUTH_KEY='.self::$oSoapRequest['CRNRSTN_SOAP_SVC_AUTH_KEY']);
                //error_log(__LINE__ .' - S.E.R.M. Connectivity Test - CRNRSTN_SOAP_SVC_AUTH_KEY=' . $tmp_key);

                $tmp_CRNRSTN_SOAP_SVC_USERNAME = $this->oCRNRSTN_USR->data_decrypt(self::$oSoapRequest['CRNRSTN_SOAP_SVC_USERNAME'], CRNRSTN_ENCRYPT_SOAP, true, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS'));
                $tmp_CRNRSTN_SOAP_SVC_PASSWORD = $this->oCRNRSTN_USR->data_decrypt(self::$oSoapRequest['CRNRSTN_SOAP_SVC_PASSWORD'], CRNRSTN_ENCRYPT_SOAP, true, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS'));

                $_SESSION['CRNRSTN_SOAP_SVC_USERNAME'] = $tmp_CRNRSTN_SOAP_SVC_USERNAME;

                $tmp_SOAP_ENCRYPT_CIPHER = $this->oCRNRSTN_USR->return_SOAP_svc_oClient_meta('SOAP_ENCRYPT_CIPHER', $tmp_CRNRSTN_SOAP_SVC_USERNAME, $tmp_CRNRSTN_SOAP_SVC_PASSWORD);
                $tmp_SOAP_ENCRYPT_SECRET_KEY = $this->oCRNRSTN_USR->return_SOAP_svc_oClient_meta('SOAP_ENCRYPT_SECRET_KEY', $tmp_CRNRSTN_SOAP_SVC_USERNAME, $tmp_CRNRSTN_SOAP_SVC_PASSWORD);
                $tmp_SOAP_ENCRYPT_HMAC_ALG = $this->oCRNRSTN_USR->return_SOAP_svc_oClient_meta('SOAP_ENCRYPT_HMAC_ALG', $tmp_CRNRSTN_SOAP_SVC_USERNAME, $tmp_CRNRSTN_SOAP_SVC_PASSWORD);
                $tmp_SOAP_ENCRYPT_OPTIONS = $this->oCRNRSTN_USR->return_SOAP_svc_oClient_meta('SOAP_ENCRYPT_OPTIONS', $tmp_CRNRSTN_SOAP_SVC_USERNAME, $tmp_CRNRSTN_SOAP_SVC_PASSWORD);

                $tmp_CRNRSTN_SOAP_SVC_AUTH_KEY = $this->oCRNRSTN_USR->data_decrypt($this->return_requestParam('CRNRSTN_SOAP_SVC_AUTH_KEY', __METHOD__), CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                error_log(__LINE__ .' SERVER :: CRNRSTN_SOAP_SVC_AUTH_KEY=' . $tmp_CRNRSTN_SOAP_SVC_AUTH_KEY);
                $tmp_CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES = $this->oCRNRSTN_USR->data_decrypt($this->return_requestParam('CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES', __METHOD__), CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                $tmp_CRNRSTN_SOAP_SVC_METHOD_REQUESTED = $this->oCRNRSTN_USR->data_decrypt($this->return_requestParam('CRNRSTN_SOAP_SVC_METHOD_REQUESTED', __METHOD__), CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                $tmp_CRNRSTN_SOAP_ACTION_TYPE = $this->oCRNRSTN_USR->data_decrypt($this->return_requestParam('CRNRSTN_SOAP_ACTION_TYPE', __METHOD__), CRNRSTN_ENCRYPT_SOAP, true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                if($this->oCRNRSTN_USR->isAuthorized_SOAP_request($tmp_CRNRSTN_SOAP_SVC_AUTH_KEY, $tmp_CRNRSTN_SOAP_SVC_USERNAME, $tmp_CRNRSTN_SOAP_SVC_PASSWORD, $tmp_CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES, $tmp_CRNRSTN_SOAP_SVC_METHOD_REQUESTED, $tmp_CRNRSTN_SOAP_ACTION_TYPE)){

                    //
                    // RECEIVE SOAP DATA OBJECT WITH DATA FOR STRAIGHT EMAIL OUT
                    $tmp_data_tunnel_session_serial = $this->oCRNRSTN_USR->generate_new_key();  // 32
                    $this->oSoapDataTransportLayer = new crnrstn_decoupled_data_object($this->oCRNRSTN_USR, $tmp_data_tunnel_session_serial, 'SOAP_DTL_SERIAL');

                    $this->oSoapDataTransportLayer->set_decryption_profile($tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                    if(isset(self::$oSoapRequest['oRECIPIENT'])){

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['oRECIPIENT'], 'oRECIPIENT', 'tns:oEmailArray')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('oRECIPIENT :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');

                        }

                    }

                    if(isset(self::$oSoapRequest['oSENDER'])){

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['oSENDER'], 'oSENDER', 'tns:oEmailArray')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('oSENDER :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');

                        }

                    }

                    if(isset(self::$oSoapRequest['oREPLYTO'])){

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['oREPLYTO'], 'oREPLYTO', 'tns:oEmailArray')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('oREPLYTO :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');

                        }

                    }

                    if(isset(self::$oSoapRequest['oCC'])){

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['oCC'], 'oCC', 'tns:oEmailArray')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('oCC :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');

                        }

                    }

                    if(isset(self::$oSoapRequest['oBCC'])){

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['oBCC'], 'oBCC', 'tns:oEmailArray')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('oBCC :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');

                        }

                    }

                    if(isset(self::$oSoapRequest['MESSAGE_SUBJECT'])){

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['MESSAGE_SUBJECT'], 'MESSAGE_SUBJECT', 'tns:oSOAP_Data')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('MESSAGE_SUBJECT :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');

                        }

                    }

                    if(isset(self::$oSoapRequest['MESSAGE_BODY_HTML'])){

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['MESSAGE_BODY_HTML'], 'MESSAGE_BODY_HTML', 'tns:oSOAP_Data')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('MESSAGE_BODY_HTML :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');

                        }

                    }

                    if(isset(self::$oSoapRequest['MESSAGE_BODY_TEXT'])){

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['MESSAGE_BODY_TEXT'], 'MESSAGE_BODY_TEXT', 'tns:oSOAP_Data')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('MESSAGE_BODY_TEXT :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');

                        }

                    }

                    if(isset(self::$oSoapRequest['EMAIL_PROTOCOL'])){

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['EMAIL_PROTOCOL'], 'EMAIL_PROTOCOL', 'tns:oSOAP_Data')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('EMAIL_PROTOCOL :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');

                        }

                    }

                    if(isset(self::$oSoapRequest['TRY_OTHER_EMAIL_METHODS_ON_ERR'])){

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['TRY_OTHER_EMAIL_METHODS_ON_ERR'], 'TRY_OTHER_EMAIL_METHODS_ON_ERR', 'tns:oSOAP_Data')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('TRY_OTHER_EMAIL_METHODS_ON_ERR :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');


                        }

                    }

                    if(isset(self::$oSoapRequest['SMTP_AUTH'])){

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['SMTP_AUTH'], 'SMTP_AUTH', 'tns:oSOAP_Data')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('SMTP_AUTH :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');


                        }

                    }

                    if(isset(self::$oSoapRequest['SMTP_SERVER'])){

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['SMTP_SERVER'], 'SMTP_SERVER', 'tns:oSOAP_Data')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('SMTP_SERVER :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');

                        }

                    }

                    if(isset(self::$oSoapRequest['SMTP_PORT_OUTGOING'])){

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['SMTP_PORT_OUTGOING'], 'SMTP_PORT_OUTGOING', 'tns:oSOAP_Data')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('SMTP_PORT_OUTGOING :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');

                        }

                    }

                    if(isset(self::$oSoapRequest['SMTP_USERNAME'])){

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['SMTP_USERNAME'], 'SMTP_USERNAME', 'tns:oSOAP_Data')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('SMTP_USERNAME :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');

                        }

                    }

                    if(isset(self::$oSoapRequest['SMTP_PASSWORD'])){

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['SMTP_PASSWORD'], 'SMTP_PASSWORD', 'tns:oSOAP_Data')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('SMTP_PASSWORD :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');

                        }

                    }

                    if(isset(self::$oSoapRequest['SMTP_KEEPALIVE'])){

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['SMTP_KEEPALIVE'], 'SMTP_KEEPALIVE', 'tns:oSOAP_Data')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('SMTP_KEEPALIVE :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');

                        }

                    }

                    if(isset(self::$oSoapRequest['SMTP_SECURE'])){

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['SMTP_SECURE'], 'SMTP_SECURE', 'tns:oSOAP_Data')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('SMTP_SECURE :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');

                        }

                    }

                    if(isset(self::$oSoapRequest['SMTP_AUTOTLS'])){

                        error_log(__LINE__ .' SERVER - SMTP_AUTOTLS run consume_SOAP_data_object().');

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['SMTP_AUTOTLS'], 'SMTP_AUTOTLS', 'tns:oSOAP_Data')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('SMTP_AUTOTLS :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');

                        }

                    }

                    if(isset(self::$oSoapRequest['SMTP_TIMEOUT'])){

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['SMTP_TIMEOUT'], 'SMTP_TIMEOUT', 'tns:oSOAP_Data')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('SMTP_TIMEOUT :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');

                        }

                    }

                    if(isset(self::$oSoapRequest['DIBYA_SAHOO_SSL_CERT_BYPASS'])){

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['DIBYA_SAHOO_SSL_CERT_BYPASS'], 'DIBYA_SAHOO_SSL_CERT_BYPASS', 'tns:oSOAP_Data')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('DIBYA_SAHOO_SSL_CERT_BYPASS :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');

                        }

                    }

                    if(isset(self::$oSoapRequest['SENDMAIL_PATH'])){

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['SENDMAIL_PATH'], 'SENDMAIL_PATH', 'tns:oSOAP_Data')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('SENDMAIL_PATH :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');

                        }

                    }

                    if(isset(self::$oSoapRequest['USE_SENDMAIL_OPTIONS'])){

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['USE_SENDMAIL_OPTIONS'], 'USE_SENDMAIL_OPTIONS', 'tns:oSOAP_Data')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('USE_SENDMAIL_OPTIONS :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');

                        }

                    }

                    if(isset(self::$oSoapRequest['WORDWRAP'])){

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['WORDWRAP'], 'WORDWRAP', 'tns:oSOAP_Data')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('WORDWRAP :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');

                        }

                    }

                    if(isset(self::$oSoapRequest['ISHTML'])){

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['ISHTML'], 'ISHTML', 'tns:oSOAP_Data')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('ISHTML :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');

                        }

                    }

                    if(isset(self::$oSoapRequest['PRIORITY'])){

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['PRIORITY'], 'PRIORITY', 'tns:oSOAP_Data')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('PRIORITY :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');

                        }

                    }

                    if(isset(self::$oSoapRequest['DUP_SUPPRESS'])){

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['DUP_SUPPRESS'], 'DUP_SUPPRESS', 'tns:oSOAP_Data')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('DUP_SUPPRESS :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');

                        }

                    }

                    if(isset(self::$oSoapRequest['CHARSET'])){

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['CHARSET'], 'CHARSET', 'tns:oSOAP_Data')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('CHARSET :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');

                        }

                    }

                    if(isset(self::$oSoapRequest['MESSAGE_ENCODING'])){

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['MESSAGE_ENCODING'], 'MESSAGE_ENCODING', 'tns:oSOAP_Data')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('MESSAGE_ENCODING :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');

                        }

                    }

                    if(isset(self::$oSoapRequest['ALLOW_EMPTY'])){

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['ALLOW_EMPTY'], 'ALLOW_EMPTY', 'tns:oSOAP_Data')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('ALLOW_EMPTY :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');

                        }

                    }

                    if(isset(self::$oSoapRequest['SERVER_NAME_SOAP_CLIENT'])){

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['SERVER_NAME_SOAP_CLIENT'], 'SERVER_NAME_SOAP_CLIENT', 'xsd:string')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('SERVER_NAME_SOAP_CLIENT :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');

                        }

                    }

                    if(isset(self::$oSoapRequest['SERVER_ADDRESS_SOAP_CLIENT'])){

                        if(!$this->oSoapDataTransportLayer->consume_SOAP_data_object(self::$oSoapRequest['SERVER_ADDRESS_SOAP_CLIENT'], 'SERVER_ADDRESS_SOAP_CLIENT', 'xsd:string')){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('SERVER_ADDRESS_SOAP_CLIENT :: Data contained within a SOAP request [from username ' . $tmp_CRNRSTN_SOAP_SVC_USERNAME.'] that was received by CRNRSTN :: could not be decrypted using cipher[' . $tmp_SOAP_ENCRYPT_CIPHER.'] and algorithm[' . $tmp_SOAP_ENCRYPT_HMAC_ALG.'].');

                        }

                    }

                    //
                    // SEND EMAIL
                    $tmp_array = $this->fire_SOAP_triggered_EMAIL('takeTheKingsHighway');

                    /*
                    //
                    // oEmailSendReport
                    $tmp_array = array(
                        'CRNRSTN_PACKET_IS_ENCRYPTED' => 'TRUE',
                        'CRNRSTN_SOAP_SVC_AUTH_KEY' => $tmp_CRNRSTN_SOAP_SVC_AUTH_KEY,
                        'CRNRSTN_SOAP_SVC_USERNAME' => $tmp_CRNRSTN_SOAP_SVC_USERNAME,
                        'TOTAL_EMAILS_RECEIVED' => $this->oSoapDataTransportLayer->count('RECIPIENT_EMAIL'),
                        'TOTAL_EMAILS_SENT' => '0',
                        'TOTAL_EMAILS_SUPPRESSED' => '0',
                        'TOTAL_EMAILS_ERROR' => '0',
                        'ACTIVITY_STATUS_MESSAGE' => '',
                        'oACTIVITY_STATUS_REPORT' => '',
                        'STATUS_CODE' => '200',
                        'STATUS_MESSAGE' => 'Success.',
                        'ISERROR_CODE' => '420',
                        'ISERROR_MESSAGE' => 'Enhance Your Calm.',
                        'SERVER_NAME_SOAP_SERVER' => $_SERVER['SERVER_NAME'],
                        'SERVER_ADDRESS_SOAP_SERVER' => $_SERVER['SERVER_ADDR'],
                        'SERVER_NAME_SOAP_CLIENT' => $tmp_SERVER_NAME_SOAP_CLIENT,
                        'SERVER_ADDRESS_SOAP_CLIENT' => $tmp_SERVER_ADDRESS_SOAP_CLIENT,
                        'DATE_RECEIVED_SOAP_REQUEST' => $this->tmp_precise_timestamp,
                        'DATE_CREATED_SOAP_RESPONSE' => $this->oCRNRSTN_USR->return_micro_time(),
                        'SOAP_OPERATION_RUNTIME_SECONDS' => $this->oCRNRSTN_USR->wall_time()

                    );
                    */

                }else{

                    /*
                    'CRNRSTN_PACKET_IS_ENCRYPTED' => array( 'name' => 'CRNRSTN_PACKET_IS_ENCRYPTED',  'type' => 'xsd:string' ),
                    'CRNRSTN_SOAP_SVC_AUTH_KEY' => array( 'name' => 'CRNRSTN_SOAP_SVC_AUTH_KEY',  'type' => 'xsd:string' ),
                    'CRNRSTN_SOAP_SVC_USERNAME' => array( 'name' => 'CRNRSTN_SOAP_SVC_USERNAME',  'type' => 'xsd:string' ),
                    'SOAP_SERVICES_AUTH_STATUS' => array( 'name' => 'SOAP_SERVICES_AUTH_STATUS',  'type' => 'xsd:string' ),

                    'ACTIVITY_STATUS_MESSAGE' => array( 'name' => 'ACTIVITY_STATUS_MESSAGE',  'type' => 'xsd:string' ),
                    'oACTIVITY_STATUS_REPORT' => array( 'name' => 'oACTIVITY_STATUS_REPORT', 'type' => 'tns:oStatusReportArray' ),
                    'STATUS_CODE' => array( 'name' => 'STATUS_CODE',  'type' => 'xsd:string' ),
                    'STATUS_MESSAGE' => array( 'name' => 'STATUS_MESSAGE',  'type' => 'xsd:string' ),
                    'ISERROR_CODE' => array( 'name' => 'ISERROR_CODE',  'type' => 'xsd:string' ),
                    'ISERROR_MESSAGE' => array( 'name' => 'ISERROR_MESSAGE',  'type' => 'xsd:string' ),
                    'DATE_RECEIVED_SOAP_REQUEST' => array( 'name' => 'DATE_RECEIVED_SOAP_REQUEST',  'type' => 'xsd:string' ),
                    'SERVER_NAME_SOAP_SERVER' => array( 'name' => 'SERVER_NAME_SOAP_SERVER',  'type' => 'xsd:string' ),
                    'SERVER_ADDRESS_SOAP_SERVER' => array( 'name' => 'SERVER_ADDRESS_SOAP_SERVER',  'type' => 'xsd:string' ),
                    'SOAP_OPERATION_RUNTIME_SECONDS' => array( 'name' => 'SOAP_OPERATION_RUNTIME_SECONDS',  'type' => 'xsd:string' ),
                    'DATE_CREATED_SOAP_RESPONSE' => array( 'name' => 'DATE_CREATED_SOAP_RESPONSE',  'type' => 'xsd:string' ),
                    'SERVER_NAME_SOAP_CLIENT' => array( 'name' => 'SERVER_NAME_SOAP_CLIENT',  'type' => 'xsd:string' ),
                    'SERVER_ADDRESS_SOAP_CLIENT' => array( 'name' => 'SERVER_ADDRESS_SOAP_CLIENT',  'type' => 'xsd:string' )
                    */

                    $tmp_array = array(
                        'CRNRSTN_PACKET_IS_ENCRYPTED' => 'FALSE',
                        'CRNRSTN_SOAP_SVC_USERNAME' => $tmp_CRNRSTN_SOAP_SVC_USERNAME,
                        'SOAP_SERVICES_AUTH_STATUS' => 'ACCESS DENIED',
                        'STATUS_CODE' => '401',
                        'STATUS_MESSAGE' => 'The CRNRSTN :: SOAP Services Layer understood the request, but is refusing to authorise it.',
                        'ISERROR_CODE' => '401',
                        'ISERROR_MESSAGE' => '401 Unauthorized.',
                        'SERVER_NAME_SOAP_SERVER' => $_SERVER['SERVER_NAME'],
                        'SERVER_ADDRESS_SOAP_SERVER' => $_SERVER['SERVER_ADDR'],
                        'SERVER_NAME_SOAP_CLIENT' => $tmp_SERVER_NAME_SOAP_CLIENT,
                        'SERVER_ADDRESS_SOAP_CLIENT' => $tmp_SERVER_ADDRESS_SOAP_CLIENT,
                        'DATE_RECEIVED_SOAP_REQUEST' => $this->tmp_precise_timestamp,
                        'DATE_CREATED_SOAP_RESPONSE' => $this->oCRNRSTN_USR->return_micro_time(),
                        'SOAP_OPERATION_RUNTIME_SECONDS' => $this->oCRNRSTN_USR->wall_time()
                    );

                }

            }

            /*
            $logDataToWrite = print_r(self::$oSoapRequest, true);

            error_log(__LINE__ .' SERVER - ' . $logDataToWrite);
            $path = '/var/www/html/_debug_output/error.log';
            $fp = fopen($path, 'a');
            fwrite($fp, $logDataToWrite);
            fclose($fp);
            */

            return $tmp_array;


        }catch(Exception $e){

	        error_log(__LINE__ .' SERVER - catching exception....'. __METHOD__);

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $tmp_ = $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);
            error_log(__LINE__ .' SERVER - catching exception....'.print_r($tmp_, true));

            return $tmp_;


        }

    }

    public function returnCRNRSTN_UI_GLOBAL_SYNC($oSoapRequest){

        self::$oSoapRequest = $oSoapRequest;
        error_log(__LINE__ .' SERVER - returnCRNRSTN_UI_GLOBAL_SYNC() REQUEST RECEIVED self::$oSoapRequest['.print_r($oSoapRequest, true).'].');

        $tmp_SERVER_NAME_SOAP_CLIENT = $this->return_requestParam('SERVER_NAME_SOAP_CLIENT', __METHOD__);
        $tmp_SERVER_ADDRESS_SOAP_CLIENT = $this->return_requestParam('SERVER_ADDRESS_SOAP_CLIENT', __METHOD__);

        error_log(__LINE__ .' SERVER - returnCRNRSTN_UI_GLOBAL_SYNC() REQUEST RECEIVED CLIENT[' . $tmp_SERVER_NAME_SOAP_CLIENT.'][' . $tmp_SERVER_ADDRESS_SOAP_CLIENT.'].');

        if($tmp_SERVER_ADDRESS_SOAP_CLIENT == ''){

            $tmp_SERVER_ADDRESS_SOAP_CLIENT = $this->oCRNRSTN_USR->client_ip();

        }

        if($this->return_requestParam('CRNRSTN_PACKET_IS_ENCRYPTED', __METHOD__) != 'TRUE'){
            $this->SOAP_request_isEncrypted = false;
            $this->tmp_starttime = $this->oCRNRSTN_USR->starttime;
            $this->tmp_starttime_ARRAY = explode('.', $this->tmp_starttime);
            $this->tmp_precise_timestamp = date('Y-m-d H:i:s', $this->tmp_starttime_ARRAY[0]);
            $this->tmp_precise_timestamp .= '.' . $this->tmp_starttime_ARRAY[1];

            //
            // DO NOT WORK WITH UNENCRYPTED SOAP DATA. RETURN ERROR SOAP RESPONSE.
            $tmp_array = array(
                'CRNRSTN_PACKET_IS_ENCRYPTED' => 'FALSE',
                'SOAP_SERVICES_AUTH_STATUS' => 'ACCESS DENIED',
                'STATUS_CODE' => '401',
                'STATUS_MESSAGE' => 'The CRNRSTN :: SOAP Services Layer understood the request, but is expecting to receive encrypted data for the completion of this handshake.',
                'ISERROR_CODE' => '401',
                'ISERROR_MESSAGE' => '401 Unauthorized.',
                'SERVER_NAME_SOAP_SERVER' => $_SERVER['SERVER_NAME'],
                'SERVER_ADDRESS_SOAP_SERVER' => $_SERVER['SERVER_ADDR'],
                'SERVER_NAME_SOAP_CLIENT' => $tmp_SERVER_NAME_SOAP_CLIENT,
                'SERVER_ADDRESS_SOAP_CLIENT' => $tmp_SERVER_ADDRESS_SOAP_CLIENT,
                'DATE_RECEIVED_SOAP_REQUEST' => $this->tmp_precise_timestamp,
                'DATE_CREATED_SOAP_RESPONSE' => $this->oCRNRSTN_USR->return_micro_time(),
                'SOAP_OPERATION_RUNTIME_SECONDS' => $this->oCRNRSTN_USR->wall_time()
            );

        }else{

            $this->SOAP_request_isEncrypted = true;
            $this->tmp_starttime = $this->oCRNRSTN_USR->starttime;
            $this->tmp_starttime_ARRAY = explode('.', $this->tmp_starttime);
            $this->tmp_precise_timestamp = date('Y-m-d H:i:s', $this->tmp_starttime_ARRAY[0]);
            $this->tmp_precise_timestamp .= '.' . $this->tmp_starttime_ARRAY[1];

            //error_log(__LINE__ .' SERVER - decrypt un with [' . $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER').'][' . $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY').'][' . $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG').'][' . $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS').'] [' . $this->return_requestParam('CRNRSTN_SOAP_SVC_USERNAME', __METHOD__).']');
            $tmp_CRNRSTN_SOAP_SVC_USERNAME = $this->oCRNRSTN_USR->data_decrypt($this->return_requestParam('CRNRSTN_SOAP_SVC_USERNAME', __METHOD__), CRNRSTN_ENCRYPT_SOAP, true, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS'));
            $tmp_CRNRSTN_SOAP_SVC_PASSWORD = $this->oCRNRSTN_USR->data_decrypt($this->return_requestParam('CRNRSTN_SOAP_SVC_PASSWORD', __METHOD__), CRNRSTN_ENCRYPT_SOAP, true, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS'));

            $_SESSION['CRNRSTN_SOAP_SVC_USERNAME'] = $tmp_CRNRSTN_SOAP_SVC_USERNAME;

            //error_log(__LINE__ .' SERVER - mayItakeTheKingsHighway decrypt with [' . $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER').'][' . $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY').'][' . $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG').'][' . $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS').']');
            $tmp_CRNRSTN_SOAP_SVC_AUTH_KEY = $this->oCRNRSTN_USR->data_decrypt($this->return_requestParam('CRNRSTN_SOAP_SVC_AUTH_KEY', __METHOD__), CRNRSTN_ENCRYPT_SOAP, true, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS'));
            $tmp_CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES = $this->oCRNRSTN_USR->data_decrypt($this->return_requestParam('CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES', __METHOD__), CRNRSTN_ENCRYPT_SOAP, true,  $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS'));
            $tmp_CRNRSTN_SOAP_SVC_METHOD_REQUESTED = $this->oCRNRSTN_USR->data_decrypt($this->return_requestParam('CRNRSTN_SOAP_SVC_METHOD_REQUESTED', __METHOD__), CRNRSTN_ENCRYPT_SOAP, true,  $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS'));
            $tmp_CRNRSTN_SOAP_ACTION_TYPE = $this->oCRNRSTN_USR->data_decrypt($this->return_requestParam('CRNRSTN_SOAP_ACTION_TYPE', __METHOD__), CRNRSTN_ENCRYPT_SOAP, true,  $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS'));

            error_log(__LINE__ .' SERVER [' . $tmp_CRNRSTN_SOAP_SVC_AUTH_KEY.'][' . $tmp_CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES.'][' . $tmp_CRNRSTN_SOAP_SVC_METHOD_REQUESTED.'][' . $tmp_CRNRSTN_SOAP_ACTION_TYPE.']');

            if($this->oCRNRSTN_USR->isAuthorized_SOAP_request($tmp_CRNRSTN_SOAP_SVC_AUTH_KEY, $tmp_CRNRSTN_SOAP_SVC_USERNAME, $tmp_CRNRSTN_SOAP_SVC_PASSWORD, $tmp_CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES, $tmp_CRNRSTN_SOAP_SVC_METHOD_REQUESTED, $tmp_CRNRSTN_SOAP_ACTION_TYPE)){

                error_log(__LINE__ .' SERVER - isAuthorized_SOAP_request USERNAME(1/2)=' . $tmp_CRNRSTN_SOAP_SVC_USERNAME);
                //die();
                $tmp_array = array(
                    'CRNRSTN_PACKET_IS_ENCRYPTED' => 'TRUE',
                    'CRNRSTN_SOAP_SVC_AUTH_KEY' => $this->oCRNRSTN_USR->data_encrypt($tmp_CRNRSTN_SOAP_SVC_AUTH_KEY, CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'CRNRSTN_SOAP_SVC_USERNAME' => $this->oCRNRSTN_USR->data_encrypt($tmp_CRNRSTN_SOAP_SVC_USERNAME, CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'SOAP_SERVICES_AUTH_STATUS' => $this->oCRNRSTN_USR->data_encrypt('AUTHORIZATION GRANTED', CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'SOAP_ENCRYPT_CIPHER' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->return_SOAP_svc_oClient_meta('SOAP_ENCRYPT_CIPHER', $tmp_CRNRSTN_SOAP_SVC_USERNAME, $tmp_CRNRSTN_SOAP_SVC_PASSWORD), CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'SOAP_ENCRYPT_SECRET_KEY' => $this->oCRNRSTN_USR->data_encrypt('this -is the new secret K3y!', CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'SOAP_ENCRYPT_HMAC_ALG' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->return_SOAP_svc_oClient_meta('SOAP_ENCRYPT_HMAC_ALG', $tmp_CRNRSTN_SOAP_SVC_USERNAME, $tmp_CRNRSTN_SOAP_SVC_PASSWORD), CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'SOAP_ENCRYPT_OPTIONS' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->return_SOAP_svc_oClient_meta('SOAP_ENCRYPT_OPTIONS', $tmp_CRNRSTN_SOAP_SVC_USERNAME, $tmp_CRNRSTN_SOAP_SVC_PASSWORD), CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'STATUS_CODE' => $this->oCRNRSTN_USR->data_encrypt('200', CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'STATUS_MESSAGE' => $this->oCRNRSTN_USR->data_encrypt('Success.', CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'ISERROR_CODE' => $this->oCRNRSTN_USR->data_encrypt('420', CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'ISERROR_MESSAGE' => $this->oCRNRSTN_USR->data_encrypt('Enhance Your Calm.', CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'SERVER_NAME_SOAP_SERVER' => $this->oCRNRSTN_USR->data_encrypt($_SERVER['SERVER_NAME'], CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'SERVER_ADDRESS_SOAP_SERVER' => $this->oCRNRSTN_USR->data_encrypt($_SERVER['SERVER_ADDR'], CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'SERVER_NAME_SOAP_CLIENT' => $this->oCRNRSTN_USR->data_encrypt($tmp_SERVER_NAME_SOAP_CLIENT, CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'SERVER_ADDRESS_SOAP_CLIENT' => $this->oCRNRSTN_USR->data_encrypt($tmp_SERVER_ADDRESS_SOAP_CLIENT, CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'),  $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'DATE_RECEIVED_SOAP_REQUEST' => $this->oCRNRSTN_USR->data_encrypt($this->tmp_precise_timestamp, CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'DATE_CREATED_SOAP_RESPONSE' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->return_micro_time(), CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS')),
                    'SOAP_OPERATION_RUNTIME_SECONDS' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->wall_time(), CRNRSTN_ENCRYPT_SOAP, $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_CIPHER'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_SECRET_KEY'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_HMAC_ALG'), $this->oCRNRSTN_USR->return_SOAP_svc_config_param('SOAP_ENCRYPT_OPTIONS'))
                );

                //error_log(__LINE__ .' SERVER - USERNAME(2/2)=' . $tmp_CRNRSTN_SOAP_SVC_USERNAME);

            }else{

                $tmp_array = array(
                    'CRNRSTN_PACKET_IS_ENCRYPTED' => 'FALSE',
                    'CRNRSTN_SOAP_SVC_USERNAME' => $tmp_CRNRSTN_SOAP_SVC_USERNAME,
                    'SOAP_SERVICES_AUTH_STATUS' => 'ACCESS DENIED',
                    'STATUS_CODE' => '401',
                    'STATUS_MESSAGE' => 'The CRNRSTN :: SOAP Services Layer understood the request, but is refusing to authorise it.',
                    'ISERROR_CODE' => '401',
                    'ISERROR_MESSAGE' => '401 Unauthorized.',
                    'SERVER_NAME_SOAP_SERVER' => $_SERVER['SERVER_NAME'],
                    'SERVER_ADDRESS_SOAP_SERVER' => $_SERVER['SERVER_ADDR'],
                    'SERVER_NAME_SOAP_CLIENT' => $tmp_SERVER_NAME_SOAP_CLIENT,
                    'SERVER_ADDRESS_SOAP_CLIENT' => $tmp_SERVER_ADDRESS_SOAP_CLIENT,
                    'DATE_RECEIVED_SOAP_REQUEST' => $this->tmp_precise_timestamp,
                    'DATE_CREATED_SOAP_RESPONSE' => $this->oCRNRSTN_USR->return_micro_time(),
                    'SOAP_OPERATION_RUNTIME_SECONDS' => $this->oCRNRSTN_USR->wall_time()
                );

            }

        }

        return $tmp_array;

    }

    private function fire_SOAP_triggered_EMAIL($source_method){

        $tmp_sent_suppression = array();
        $config_data_ARRAY = array();

        //
        // PHPMAILER DEFAULT VALUES
        $tmp_DUP_SUPPRESS = true;  // CRNRSTN DEFAULT
        $tmp_ALLOW_EMPTY = false;
        $tmp_SMTP_KEEPALIVE = false;
        $tmp_isHTML = true;
        $tmp_SMTP_TIMEOUT = 300;
        $tmp_PRIORITY = 3;
        $tmp_WORDWRAP = 52;
        $tmp_EMAIL_PROTOCOL = 'mail';
        $tmp_TRY_OTHER_EMAIL_METHODS_ON_ERR = true;
        $tmp_SMTP_AUTH = false;
        $tmp_SMTP_SERVER = 'localhost';
        $tmp_SMTP_PORT_OUTGOING = 25;
        $tmp_SMTP_USERNAME = '';
        $tmp_SMTP_PASSWORD = '';
        $tmp_CHARSET = 'iso-8859-1';
        $tmp_MESSAGE_ENCODING = '8bit';
        $tmp_SMTP_SECURE = '';
        $tmp_SMTP_AUTOTLS = true;
        $tmp_FROM_EMAIL = 'root@localhost';
        $tmp_FROM_NAME = 'Root User';
        $tmp_RECIPIENT_EMAIL = array();
        $tmp_RECIPIENT_NAME = array();
        $tmp_REPLYTO_EMAIL = array();
        $tmp_REPLYTO_NAME = array();
        $tmp_CC_EMAIL = array();
        $tmp_CC_NAME = array();
        $tmp_BCC_EMAIL = array();
        $tmp_BCC_NAME = array();
        $tmp_SENDMAIL_PATH = '/usr/sbin/sendmail';
        $tmp_USE_SENDMAIL_OPTIONS = true;
        $tmp_DIBYA_SAHOO_SSL_CERT_BYPASS = true;

        $this->oLog_ProfileManager = $this->oCRNRSTN_USR->return_oLog_ProfileManager();

        //
        // NEED TO ACCESS EMAIL PROFILE TO COMPLETE.
        $tmp_olog_profile = $this->oLog_ProfileManager->return_olog_profile(CRNRSTN_LOG_EMAIL);

        if(!is_object($tmp_olog_profile)){

            $tmp_CRNRSTN_SOAP_SVC_USERNAME = '12345678';
            $tmp_SERVER_NAME_SOAP_CLIENT = 12345678;
            $tmp_SERVER_ADDRESS_SOAP_CLIENT = '12345678';
            $tmp_array = array(
                'CRNRSTN_PACKET_IS_ENCRYPTED' => 'FALSE',
                'CRNRSTN_SOAP_SVC_USERNAME' => $tmp_CRNRSTN_SOAP_SVC_USERNAME,
                'SOAP_SERVICES_AUTH_STATUS' => 'ACCESS DENIED',
                'STATUS_CODE' => '401',
                'STATUS_MESSAGE' => 'The CRNRSTN :: SOAP Services Layer understood the request, but the EMAIL profile at the proxy is not configured...therefore the request cannot be fulfilled.',
                'ISERROR_CODE' => '401',
                'ISERROR_MESSAGE' => '401 Unauthorized.',
                'SERVER_NAME_SOAP_SERVER' => $_SERVER['SERVER_NAME'],
                'SERVER_ADDRESS_SOAP_SERVER' => $_SERVER['SERVER_ADDR'],
                'SERVER_NAME_SOAP_CLIENT' => $tmp_SERVER_NAME_SOAP_CLIENT,
                'SERVER_ADDRESS_SOAP_CLIENT' => $tmp_SERVER_ADDRESS_SOAP_CLIENT,
                'DATE_RECEIVED_SOAP_REQUEST' => $this->tmp_precise_timestamp,
                'DATE_CREATED_SOAP_RESPONSE' => $this->oCRNRSTN_USR->return_micro_time(),
                'SOAP_OPERATION_RUNTIME_SECONDS' => $this->oCRNRSTN_USR->wall_time()
            );

            return $tmp_array;

        }else{

            $this->profile_endpoint_data_ARRAY = $tmp_olog_profile->return_profile_endpoint_data();
            $tmp_size = sizeof($this->profile_endpoint_data_ARRAY);

            //
            // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
            foreach($this->profile_endpoint_data_ARRAY as $config_version => $chunkArray0){

                //error_log(__LINE__ .' env - should be (more than one) ' . $tmp_size.'...config_version=' . $config_version);

                foreach($chunkArray0 as $data_attribute => $chunkArray1){

                    foreach($chunkArray1 as $content_count => $attribute_content){

                        error_log(__LINE__ .' --DIE-- env - [' . $config_version.'] [' . $data_attribute.'] [' . $content_count.'] [' . $attribute_content.']');

                        die();
                        switch($data_attribute){
                            case 'RECIPIENT_EMAIL':

                                $tmp_RECIPIENT_EMAIL[] = $attribute_content;

                            break;
                            case 'RECIPIENT_NAME':

                                $tmp_RECIPIENT_NAME[] = $attribute_content;

                            break;
                            case 'FROM_EMAIL':

                                $tmp_FROM_EMAIL = $attribute_content;

                            break;
                            case 'FROM_NAME':

                                $tmp_FROM_NAME = $attribute_content;

                            break;
                            case 'REPLYTO_EMAIL':

                                $tmp_REPLYTO_EMAIL[] = $attribute_content;

                            break;
                            case 'REPLYTO_NAME':

                                $tmp_REPLYTO_NAME[] = $attribute_content;

                            break;
                            case 'CC_EMAIL':

                                $tmp_CC_EMAIL[] = $attribute_content;

                            break;
                            case 'CC_NAME':

                                $tmp_CC_NAME[] = $attribute_content;

                            break;
                            case 'BCC_EMAIL':

                                $tmp_BCC_EMAIL[] = $attribute_content;

                            break;
                            case 'BCC_NAME':

                                $tmp_BCC_NAME[] = $attribute_content;

                            break;
                            case 'SMTP_KEEPALIVE':

                                $tmp_SMTP_KEEPALIVE = (bool) $oCRNRSTN_n->tidy_boolean($attribute_content);

                            break;
                            case 'DUP_SUPPRESS':

                                $tmp_DUP_SUPPRESS = (bool) $oCRNRSTN_n->tidy_boolean($attribute_content);

                            break;
                            case 'ALLOW_EMPTY':

                                $tmp_ALLOW_EMPTY = (bool) $oCRNRSTN_n->tidy_boolean($attribute_content);

                            break;
                            case 'ISHTML':

                                $tmp_isHTML = (bool) $oCRNRSTN_n->tidy_boolean($attribute_content);

                            break;
                            case 'SMTP_TIMEOUT':

                                $tmp_SMTP_TIMEOUT = (int) $attribute_content;

                            break;
                            case 'PRIORITY':

                                $tmp_PRIORITY = $attribute_content;

                                $priority = trim(strtoupper($tmp_PRIORITY));

                                switch($priority){
                                    case '1':
                                    case 1:
                                    case 'HIGH':

                                        $tmp_PRIORITY = 1;

                                    break;
                                    case '3':
                                    case 3:
                                    case 'NORMAL':

                                        $tmp_PRIORITY = 3;

                                    break;
                                    case '5':
                                    case 5:
                                    case 'LOW':

                                        $tmp_PRIORITY = 5;

                                    break;
                                    default:

                                        $tmp_PRIORITY = 3;

                                        //
                                        // HOOOSTON...VE HAF PROBLEM!
                                        $oCRNRSTN_n->error_log('The provided priority level of "' . $tmp_PRIORITY.'" is invalid; NORMAL priority has been applied. Options include, "HIGH" or 1, "NORMAL" or 3 and "LOW" or 5.', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                    break;

                                }

                            break;
                            case 'WORDWRAP':

                                $tmp_WORDWRAP = (int) $attribute_content;

                            break;
                            case 'EMAIL_PROTOCOL':

                                $tmp_EMAIL_PROTOCOL = trim(strtoupper($attribute_content));

                            break;
                            case 'CHARSET':

                                $tmp_CHARSET = $attribute_content;

                            break;
                            case 'MESSAGE_ENCODING':

                                $tmp_MESSAGE_ENCODING = $attribute_content;

                            break;
                            case 'SMTP_SECURE':

                                $tmp_SMTP_SECURE = strtolower(trim($attribute_content));

                            break;
                            case 'SMTP_AUTOTLS':

                                $tmp_SMTP_AUTOTLS = (bool) $oCRNRSTN_n->tidy_boolean($attribute_content);

                            break;
                            case 'SMTP_AUTH':

                                $tmp_SMTP_AUTH = (bool) $oCRNRSTN_n->tidy_boolean($attribute_content);

                            break;
                            case 'SMTP_SERVER':

                                $tmp_SMTP_SERVER = $attribute_content;

                            break;
                            case 'SMTP_PORT_OUTGOING':

                                $tmp_SMTP_PORT_OUTGOING = $attribute_content;

                            break;
                            case 'SMTP_USERNAME':

                                $tmp_SMTP_USERNAME = $attribute_content;

                            break;
                            case 'SMTP_PASSWORD':

                                $tmp_SMTP_PASSWORD = $attribute_content;

                            break;
                            case 'SENDMAIL_PATH':

                                $tmp_SENDMAIL_PATH = $attribute_content;

                            break;
                            case 'USE_SENDMAIL_OPTIONS':

                                $tmp_USE_SENDMAIL_OPTIONS = (bool) $oCRNRSTN_n->tidy_boolean($attribute_content);

                            break;
                            case 'DIBYA_SAHOO_SSL_CERT_BYPASS':

                                $tmp_DIBYA_SAHOO_SSL_CERT_BYPASS = (bool) $oCRNRSTN_n->tidy_boolean($attribute_content);

                            break;
                            case 'TRY_OTHER_EMAIL_METHODS_ON_ERR':

                                $tmp_TRY_OTHER_EMAIL_METHODS_ON_ERR = (bool) $oCRNRSTN_n->tidy_boolean($attribute_content);

                            break;

                        }

                    }

                }

            }


            $tmp_oGabriel_serial = $oCRNRSTN_n->generate_new_key(50);

            switch(get_class($oCRNRSTN_n)){
                case 'crnrstn_user':

                    if($tmp_SMTP_AUTH){

                        //
                        // SMTP AUTH
                        $oCRNRSTN_GABRIEL = $oCRNRSTN_n->initialize_oGabriel($tmp_oGabriel_serial, $tmp_EMAIL_PROTOCOL, $tmp_SMTP_USERNAME, $tmp_SMTP_PASSWORD, $tmp_SMTP_PORT_OUTGOING);

                    }else{

                        //
                        // ANY NON-AUTH
                        $oCRNRSTN_GABRIEL = $oCRNRSTN_n->initialize_oGabriel($tmp_oGabriel_serial, $tmp_EMAIL_PROTOCOL);

                    }

                break;
                case 'crnrstn_environment':
                case 'crnrstn':

                    $tmp_recipient_cnt = sizeof($tmp_RECIPIENT_EMAIL);

                    for ($i = 0; $i < $tmp_recipient_cnt; $i++){

                        if(!($tmp_DUP_SUPPRESS && isset($tmp_sent_suppression[strtolower($tmp_RECIPIENT_EMAIL[$i])]))){

                            if($tmp_DUP_SUPPRESS){

                                $tmp_sent_suppression[strtolower($tmp_RECIPIENT_EMAIL[$i])] = 1;

                            }

                            $oCRNRSTN_GABRIEL = new crnrstn_messenger_from_north($tmp_oGabriel_serial, $tmp_EMAIL_PROTOCOL, $tmp_SMTP_USERNAME, $tmp_SMTP_PASSWORD, $tmp_SMTP_PORT_OUTGOING, $oCRNRSTN_n);

                            $crnrstn_phpmailer = new \PHPMailer\crnrstn_PHPMailer\crnrstn_PHPMailer($oCRNRSTN_n);
                            $crnrstn_phpmailer->Mailer = strtolower($tmp_EMAIL_PROTOCOL);  // "mail", "qmail", "sendmail", or "smtp".
                            $crnrstn_phpmailer->Timeout = $tmp_SMTP_TIMEOUT;
                            $crnrstn_phpmailer->SMTPKeepAlive = $tmp_SMTP_KEEPALIVE;
                            $crnrstn_phpmailer->Priority = $tmp_PRIORITY;
                            $crnrstn_phpmailer->CharSet = $tmp_CHARSET;
                            $crnrstn_phpmailer->Encoding = $tmp_MESSAGE_ENCODING;
                            $crnrstn_phpmailer->SMTPSecure = $tmp_SMTP_SECURE;
                            $crnrstn_phpmailer->SMTPAutoTLS = $tmp_SMTP_AUTOTLS;
                            $crnrstn_phpmailer->Sendmail = $tmp_SENDMAIL_PATH;
                            $crnrstn_phpmailer->UseSendmailOptions = $tmp_USE_SENDMAIL_OPTIONS;

                            if($tmp_isHTML){

                                $crnrstn_phpmailer->isHTML();

                            }

                            $crnrstn_phpmailer->WordWrap = $tmp_WORDWRAP;
                            $crnrstn_phpmailer->AllowEmpty = $tmp_ALLOW_EMPTY;

                            $crnrstn_phpmailer->setFrom($tmp_FROM_EMAIL, $tmp_FROM_NAME);
                            //error_log(__LINE__ . ' env - Adding setFrom:' . $tmp_FROM_NAME . ' ' . $tmp_FROM_EMAIL);
                            //$crnrstn_phpmailer->From = $config_data_ARRAY[$config_vs]['FROM_EMAIL'][0];
                            //$crnrstn_phpmailer->FromName = $config_data_ARRAY[$config_vs]['FROM_NAME'][0];

                            $tmp_e_cnt = sizeof($tmp_REPLYTO_EMAIL);
                            if($tmp_e_cnt > 0){

                                for($e_pos=0; $e_pos<$tmp_e_cnt; $e_pos++){

                                    $crnrstn_phpmailer->addReplyTo($tmp_REPLYTO_EMAIL[$e_pos], $tmp_REPLYTO_NAME[$e_pos]);
                                    error_log(__LINE__ . ' env - Adding ReplyTo:' . $tmp_REPLYTO_NAME[$e_pos] . ' ' . $tmp_REPLYTO_EMAIL[$e_pos]);

                                }

                            }

                            $tmp_e_cnt = sizeof($tmp_CC_EMAIL);
                            if($tmp_e_cnt > 0){

                                for($e_pos=0; $e_pos<$tmp_e_cnt; $e_pos++){

                                    $crnrstn_phpmailer->addCC($tmp_CC_EMAIL[$e_pos], $tmp_CC_NAME[$e_pos]);
                                    error_log(__LINE__ . ' env - Adding CC:' . $tmp_CC_NAME[$e_pos] . ' ' . $tmp_CC_EMAIL[$e_pos]);

                                }

                            }

                            $tmp_e_cnt = sizeof($tmp_BCC_EMAIL);
                            if($tmp_e_cnt > 0){

                                for($e_pos=0; $e_pos<$tmp_e_cnt; $e_pos++){

                                    $crnrstn_phpmailer->addBCC($tmp_BCC_EMAIL[$e_pos], $tmp_BCC_NAME[$e_pos]);
                                    error_log(__LINE__ . ' env - Adding BCC:' . $tmp_BCC_NAME[$e_pos] . ' ' . $tmp_BCC_EMAIL[$e_pos]);

                                }

                            }

                            switch($tmp_EMAIL_PROTOCOL){
                                case 'SMTP':

                                    if($tmp_SMTP_AUTH){

                                        $crnrstn_phpmailer->SMTPAuth = true;
                                        $crnrstn_phpmailer->Username = $tmp_SMTP_USERNAME;
                                        $crnrstn_phpmailer->Password = $tmp_SMTP_PASSWORD;
                                        $crnrstn_phpmailer->Host = $tmp_SMTP_SERVER;
                                        $crnrstn_phpmailer->Port = $tmp_SMTP_PORT_OUTGOING;

                                    }

                                    if($tmp_DIBYA_SAHOO_SSL_CERT_BYPASS){

                                        //
                                        // WORK AROUND FOR PHPMAILER SSL CERT VERIFICATION *ERRORS INTRODUCED
                                        // THROUGH THE STRICTER SSL BEHAVIOR THAT CAME WITH THE RELEASE OF PHP 5.6
                                        // SOURCE :: https://pepipost.com/tutorials/phpmailer-smtp-error-could-not-connect-to-smtp-host/
                                        // AUTHOR :: https://pepipost.com/tutorials/author/dibya-sahoo/
                                        // DETAIL :: https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting#certificate-verification-failure
                                        // * You may not see this error; In implicit encryption mode (SMTPS) it may be
                                        // hidden because there isn't a way for the channel to show messages - SMTP+STARTTLS
                                        // is generally easier to debug because of this.
                                        $crnrstn_phpmailer->SMTPOptions = array(
                                            'ssl' => array(
                                                'verify_peer' => false,
                                                'verify_peer_name' => false,
                                                'allow_self_signed' => true
                                            )
                                        );

                                        error_log(__LINE__ .' env - DIBYA_SAHOO_SSL_CERT_BYPASS HAS BEEN APPLIED.');

                                    }else{

                                        error_log(__LINE__ .' env - DIBYA_SAHOO_SSL_CERT_BYPASS HAS BEEN BYPASSED.');

                                    }

                                break;
                                case 'SENDMAIL':

                                    $crnrstn_phpmailer->isSendmail();

                                break;
                                case 'QMAIL':

                                    $crnrstn_phpmailer->isQmail();

                                break;
                                case 'MAIL':

                                    $crnrstn_phpmailer->isMail();

                                break;

                            }

                            //
                            // CONSTANTS
                            $tmp_php_trace_TEXT = $oCRNRSTN_n->return_PHP_exception_trace_pretty($exception_obj->getTraceAsString(), 'TEXT');
                            $tmp_log_constant_TEXT = $oCRNRSTN_n->return_log_priority_pretty($syslog_constant);
                            $tmp_crnrstn_trace_TEXT = $this->oLog_output_manager->return_log_trace_output_str('EMAIL_TEXT');
                            $crnrstn_phpmailer->Subject = 'Exception Notification from ' . $_SERVER['SERVER_NAME'].' via CRNRSTN ::';

                            if($tmp_isHTML){

                                $tmp_php_trace_HTML = $oCRNRSTN_n->return_PHP_exception_trace_pretty($exception_obj->getTraceAsString(), 'HTML');
                                $tmp_log_constant_HTML = $oCRNRSTN_n->return_log_priority_pretty($syslog_constant, 'HTML');
                                $tmp_crnrstn_trace_HTML = $this->oLog_output_manager->return_log_trace_output_str('EMAIL_HTML');

                            }

                            if(isset($tmp_RECIPIENT_NAME[$i])){

                                $tmp_name = $tmp_RECIPIENT_NAME[$i];

                            }else{

                                $tmp_name = '';

                            }

                            error_log(__LINE__ . ' env - Adding Recipient:' . $tmp_name . ' ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private'));
                            $crnrstn_phpmailer->AddAddress($tmp_RECIPIENT_EMAIL[$i], $tmp_name);

                            //
                            // PREPARE TEXT VERSION
                            $tmp_TEXT_Body = $oCRNRSTN_GABRIEL->return_CRNRSTN_SysMsgTEXTBody('EXCEPTION_NOTIFICATION');
                            $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{SYSTEM_LOG_INTEGER_CONSTANT}', $tmp_log_constant_TEXT, $tmp_TEXT_Body);
                            $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{MESSAGE}', $tmp_exception_msg, $tmp_TEXT_Body);
                            $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{LINE_NUM}', $tmp_exception_linenum, $tmp_TEXT_Body);
                            $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{METHOD}', $exception_method, $tmp_TEXT_Body);
                            $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{PHP_TRACE}', $tmp_php_trace_TEXT, $tmp_TEXT_Body);
                            $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{SYSTEM_TIME}', $exception_systemtime, $tmp_TEXT_Body);
                            $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{PROCESS_RUN_TIME}', $exception_runtime, $tmp_TEXT_Body);
                            $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{EMAIL}', $tmp_RECIPIENT_EMAIL[$i], $tmp_TEXT_Body);
                            $tmp_TEXT_Body = $oCRNRSTN_n->proper_replace('{LOG_TRACE}', $tmp_crnrstn_trace_TEXT, $tmp_TEXT_Body);

                            $crnrstn_phpmailer->AltBody = $tmp_TEXT_Body;

                            if($tmp_isHTML){

                                //
                                // PREPARE HTML VERSION
                                $tmp_HTML_Body = $oCRNRSTN_GABRIEL->return_CRNRSTN_SysMsgHTMLBody('EXCEPTION_NOTIFICATION');
                                $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{SYSTEM_LOG_INTEGER_CONSTANT}', $tmp_log_constant_HTML, $tmp_HTML_Body);
                                $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{MESSAGE}', $tmp_exception_msg, $tmp_HTML_Body);
                                $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{LINE_NUM}', $tmp_exception_linenum, $tmp_HTML_Body);
                                $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{METHOD}', $exception_method, $tmp_HTML_Body);
                                $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{PHP_TRACE}', $tmp_php_trace_HTML, $tmp_HTML_Body);
                                $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{SYSTEM_TIME}', $exception_systemtime, $tmp_HTML_Body);
                                $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{PROCESS_RUN_TIME}', $exception_runtime, $tmp_HTML_Body);
                                $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{EMAIL}', $tmp_RECIPIENT_EMAIL[$i], $tmp_HTML_Body);
                                $tmp_HTML_Body = $oCRNRSTN_n->proper_replace('{LOG_TRACE}', $tmp_crnrstn_trace_HTML, $tmp_HTML_Body);

                                $crnrstn_phpmailer->Body = $tmp_HTML_Body;

                            }

                            error_log(__LINE__ .' env - crnrstn_phpmailer->send()');

                            $crnrstn_phpmailer->Mailer = strtolower($tmp_EMAIL_PROTOCOL);  // "mail", "qmail", "sendmail", or "smtp".

                            if(!$crnrstn_phpmailer->Send()){

                                if($tmp_TRY_OTHER_EMAIL_METHODS_ON_ERR){

                                    $oCRNRSTN_n->error_log('An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Graceful degradation to secondary email send protocol is commencing due to: ' . $crnrstn_phpmailer->ErrorInfo, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                                    error_log(__LINE__ . ' - An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Graceful degradation to secondary email send protocol is commencing due to: ' . $crnrstn_phpmailer->ErrorInfo);

                                    $crnrstn_phpmailer = $this->next_mail_protocol_option($crnrstn_phpmailer);
                                    if(!$crnrstn_phpmailer->Send()){

                                        $oCRNRSTN_n->error_log('An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Graceful degradation to tertiary email send protocol is commencing due to: ' . $crnrstn_phpmailer->ErrorInfo, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                                        error_log(__LINE__ . ' - An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Graceful degradation to tertiary email send protocol is commencing due to: ' . $crnrstn_phpmailer->ErrorInfo);

                                        $crnrstn_phpmailer = $this->next_mail_protocol_option($crnrstn_phpmailer);
                                        if(!$crnrstn_phpmailer->Send()){

                                            $oCRNRSTN_n->error_log('An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Graceful degradation to quatiary email send protocol is commencing due to: ' . $crnrstn_phpmailer->ErrorInfo, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                                            error_log(__LINE__ . ' - An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Graceful degradation to quatiary email send protocol is commencing due to: ' . $crnrstn_phpmailer->ErrorInfo);

                                            $crnrstn_phpmailer = $this->next_mail_protocol_option($crnrstn_phpmailer);
                                            if(!$crnrstn_phpmailer->Send()){

                                                $oCRNRSTN_n->error_log('An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Graceful degradation to pentiary email send protocol is commencing due to: ' . $crnrstn_phpmailer->ErrorInfo, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                                                error_log(__LINE__ . ' - An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Graceful degradation to pentiary email send protocol is commencing due to: ' . $crnrstn_phpmailer->ErrorInfo);

                                                $crnrstn_phpmailer = $this->next_mail_protocol_option($crnrstn_phpmailer);
                                                if(!$crnrstn_phpmailer->Send()){

                                                    //
                                                    // ...on my usage of the term "hexapolynomial"...as being of the
                                                    // same ilk as usages (contained also herein) of secondary,
                                                    // tertiary, etc...I feel pretty good standing in this shadow.
                                                    //
                                                    // - J5, November 9, 2020 0845hrs
                                                    //
                                                    // SOURCE :: https://ieeexplore.ieee.org/abstract/document/9195628
                                                    // AUTHOR :: https://ieeexplore.ieee.org/author/37086360445
                                                    // This paper discusses twice continuously differentiable and three times
                                                    // continuously differentiable approximations with polynomial and
                                                    // non-polynomial splines. To construct the approximation, a polynomial and
                                                    // non-polynomial local basis of the second level and the sixth order
                                                    // approximation is constructed. We call the approximation a second level
                                                    // approximation because it uses the first and the second derivatives of the
                                                    // function. The non-polynomial approximation has the properties of
                                                    // polynomial and trigonometric functions. Here we have also constructed a
                                                    // non-polynomial interpolating spline which has the first, the second and
                                                    // the third continuous derivative. This approximation uses the values of
                                                    // the function at the nodes, the values of the first derivative of the
                                                    // function at the nodes and the values of the second derivative of the
                                                    // function at the ends of the interval [a, b]. The theorems of the
                                                    // approximations are given. Numerical examples are given.
                                                    //
                                                    // - I. G. Burova,
                                                    // St. Petersburg State University,
                                                    // Dept. of Computational Mathematics

                                                    $oCRNRSTN_n->error_log('An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Attempting final graceful degradation...hexapolynomial in nature...albeit CRNRSTN :: has, at this point, already measured and found to be wanting the fifth (5th) and final email send use case of the four (4) official and available protocols for things of this nature per /crnrstn_PHPMailer/. TLDR; ...an empty string will now be sent as the mailer protocol, and the results for which what one would hope...could only be the best. ' . $crnrstn_phpmailer->ErrorInfo, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                                                    error_log(__LINE__ . 'An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Attempting final graceful degradation...hexapolynomial in nature...albeit CRNRSTN :: has, at this point, already measured and found to be wanting the fifth (5th) and final email send use case of the four (4) official and available protocols for things of this nature per /crnrstn_PHPMailer/. TLDR; ...an empty string will now be sent as the mailer protocol, and the results for which what one would hope...could only be the best. ' . $crnrstn_phpmailer->ErrorInfo);

                                                    $crnrstn_phpmailer = $this->next_mail_protocol_option($crnrstn_phpmailer);
                                                    if(!$crnrstn_phpmailer->Send()){

                                                        $oCRNRSTN_n->error_log('An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . '. Abandoning email delivery efforts due to: ' . $crnrstn_phpmailer->ErrorInfo, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                                                        error_log(__LINE__ . ' - An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . '. Abandoning email delivery efforts due to: ' . $crnrstn_phpmailer->ErrorInfo);

                                                    }

                                                }

                                            }

                                        }else{

                                            error_log(__LINE__ . ' - A SUCCESS was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '.');

                                        }

                                    }else{

                                        error_log(__LINE__ . ' - A SUCCESS was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '.');

                                    }

                                }else{

                                    $oCRNRSTN_n->error_log('An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Abandoning email delivery efforts due to: ' . $crnrstn_phpmailer->ErrorInfo, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                                    error_log(__LINE__ . ' - An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Abandoning email delivery efforts due to: ' . $crnrstn_phpmailer->ErrorInfo);

                                }

                            }else{

                                error_log(__LINE__ . ' - A SUCCESS was experienced while attempting to send an email to ' . $oCRNRSTN_n->str_sanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '.');

                            }

                            array_splice($this->mail_protocol_flag_ARRAY, 0);

                            //
                            // CLEAR SEND DATA (ALSO ANY MESSAGE ATTACHMENTS CLEARED)
                            $crnrstn_phpmailer->ClearAddresses();

                        }

                    }

                    if(isset($tmp_SMTP_KEEPALIVE)){

                        if($tmp_SMTP_KEEPALIVE){

                            $crnrstn_phpmailer->smtpClose();

                        }

                    }

                    break;
            }


            $tmp_array = array(
                'CRNRSTN_PACKET_IS_ENCRYPTED' => 'TRUE',
                'CRNRSTN_SOAP_SVC_AUTH_KEY' => $tmp_CRNRSTN_SOAP_SVC_AUTH_KEY,
                'CRNRSTN_SOAP_SVC_USERNAME' => $tmp_CRNRSTN_SOAP_SVC_USERNAME,
                'TOTAL_EMAILS_RECEIVED' => $this->oSoapDataTransportLayer->count('RECIPIENT_EMAIL'),
                'TOTAL_EMAILS_SENT' => '0',
                'TOTAL_EMAILS_SUPPRESSED' => '0',
                'TOTAL_EMAILS_ERROR' => '0',
                'ACTIVITY_STATUS_MESSAGE' => '',
                'oACTIVITY_STATUS_REPORT' => '',
                'STATUS_CODE' => '200',
                'STATUS_MESSAGE' => 'Success.',
                'ISERROR_CODE' => '420',
                'ISERROR_MESSAGE' => 'Enhance Your Calm.',
                'SERVER_NAME_SOAP_SERVER' => $_SERVER['SERVER_NAME'],
                'SERVER_ADDRESS_SOAP_SERVER' => $_SERVER['SERVER_ADDR'],
                'SERVER_NAME_SOAP_CLIENT' => $tmp_SERVER_NAME_SOAP_CLIENT,
                'SERVER_ADDRESS_SOAP_CLIENT' => $tmp_SERVER_ADDRESS_SOAP_CLIENT,
                'DATE_RECEIVED_SOAP_REQUEST' => $this->tmp_precise_timestamp,
                'DATE_CREATED_SOAP_RESPONSE' => $this->oCRNRSTN_USR->return_micro_time(),
                'SOAP_OPERATION_RUNTIME_SECONDS' => $this->oCRNRSTN_USR->wall_time()

            );

            return $tmp_array;


        }

    }

    private function SOAP_monitor_time($monitor_key){

	    if(!isset($this->SOAP_startTime)){

            $this->SOAP_startTime = $this->oCRNRSTN_USR->return_micro_time();

        }

	    return $this->oCRNRSTN_USR->elapsed_delta_time($monitor_key);

    }

    public function sendElectrumPerformanceReport($oSoapRequest){

	    $this->SOAP_monitor_time('ELECTRUM_PERFORMANCE');
        self::$oSoapRequest = $oSoapRequest;

        $this->tmp_starttime = $this->oCRNRSTN_USR->starttime;
        $this->tmp_starttime_ARRAY = explode('.', $this->tmp_starttime);
        $this->tmp_precise_timestamp = date('Y-m-d H:i:s', $this->tmp_starttime_ARRAY[0]);
        $this->tmp_precise_timestamp .= '.' . $this->tmp_starttime_ARRAY[1];

        //
        // PROCESS ELECTRUM NOTICE
        $SOAP_server_response = $this->SOAPserver_processElectrumReportRequest();

        /*
        $tmp_key = $this->oCRNRSTN_USR->data_decrypt(self::$oSoapRequest['CRNRSTN_SOAP_SVC_AUTH_KEY'], CRNRSTN_ENCRYPT_SOAP);
        $tmp_RECIPIENT = self::$oSoapRequest['RECIPIENT'];

        $tmp_size = sizeof($tmp_RECIPIENT);
        $tmp_status_report_ARRAY = array();

        for($i=0;$i<$tmp_size;$i++){
            $tmp_EMAIL_PROXY_SERIAL = $this->oCRNRSTN_USR->data_decrypt($tmp_RECIPIENT[$i]['EMAIL_PROXY_SERIAL'], CRNRSTN_ENCRYPT_SOAP);
            $tmp_EMAILADDRESS = $this->oCRNRSTN_USR->data_decrypt($tmp_RECIPIENT[$i]['EMAILADDRESS'], CRNRSTN_ENCRYPT_SOAP);
            error_log('69 - S.E.R.M. Connectivity Test - EMAIL[' . $i.']=' . $tmp_EMAILADDRESS.' EMAIL_PROXY_SERIAL=' . $tmp_EMAIL_PROXY_SERIAL);

            array_push($tmp_status_report_ARRAY, array(
                'EMAIL_PROXY_SERIAL' => $this->oCRNRSTN_USR->data_encrypt($tmp_EMAIL_PROXY_SERIAL, CRNRSTN_ENCRYPT_SOAP),
                'SEND_STATUS' => $this->oCRNRSTN_USR->data_encrypt('Send success.', CRNRSTN_ENCRYPT_SOAP),
                'STATUS_DETAIL' =>$this->oCRNRSTN_USR->data_encrypt('1', CRNRSTN_ENCRYPT_SOAP)
            ));
        }

        $tmp_SYS_MESSAGE_TITLE_TEXT = $this->oCRNRSTN_USR->data_decrypt(self::$oSoapRequest['SYS_MESSAGE_TITLE_TEXT'], CRNRSTN_ENCRYPT_SOAP);

        error_log('67 - S.E.R.M. Connectivity Test - SYS_MESSAGE_TITLE_TEXT=' . $tmp_SYS_MESSAGE_TITLE_TEXT);

        //
        // RECEIVE SOAP DATA PACK WITH BATCH DATA FOR STRAIGHT EMAIL OUT
        $tmp_array = array(
            'CRNRSTN_SOAP_SVC_AUTH_KEY' => $this->oCRNRSTN_USR->data_encrypt($tmp_key, CRNRSTN_ENCRYPT_SOAP),
            'TOTAL_EMAILS_RECEIVED' => $this->oCRNRSTN_USR->data_encrypt('2', CRNRSTN_ENCRYPT_SOAP),
            'TOTAL_EMAILS_SENT' => $this->oCRNRSTN_USR->data_encrypt('2', CRNRSTN_ENCRYPT_SOAP),
            'TOTAL_EMAILS_ERROR' => $this->oCRNRSTN_USR->data_encrypt('0', CRNRSTN_ENCRYPT_SOAP),
            'oACTIVITY_STATUS_REPORT' => $tmp_status_report_ARRAY
        );
        */

        return $SOAP_server_response;

    }

    private function SOAPserver_sendEmail($tmp_oRECIPIENT){

	    $tmp_status_ARRAY = array();

        if($this->SOAP_request_sendSuppression){

            if(isset($this->SOAP_request_flag_sendSuppression_ARRAY[$tmp_oRECIPIENT['EMAIL_PROXY_SERIAL']])){

                error_log('129 SOAP SERVER SENT SUPPRESS FOR ' . $tmp_oRECIPIENT['EMAIL_PROXY_SERIAL']);
                //
                // SEND SUPPRESS
                $tmp_status_ARRAY = array(
                    'EMAIL_PROXY_SERIAL' => $tmp_oRECIPIENT['EMAIL_PROXY_SERIAL'],
                    'IS_SENT' => 'FALSE',
                    'SEND_TIMESTAMP' => '',
                    'SEND_STATUS' => 'SEND SUPPRESSED',
                    'STATUS_DETAIL' => 'The email send was duplicate suppressed by the CRNRSTN :: SOAP services layer.'
                );

            }else{
                error_log('140 SOAP SERVER - PROCESS SEND TO ' . $tmp_oRECIPIENT['EMAILADDRESS']);
                $this->SOAP_request_flag_sendSuppression_ARRAY[$tmp_oRECIPIENT['EMAIL_PROXY_SERIAL']] = 1;

                //
                // OK TO SEND
                $tmp_CRNRSTN_PROXY_EMAIL_PROTOCOL = $this->return_requestParam('CRNRSTN_PROXY_EMAIL_PROTOCOL', __METHOD__);
                $tmp_oSENDER = $this->return_requestParam('oSENDER', __METHOD__, true, 'oEmail');
                $tmp_oREPLYTO = $this->return_requestParam('oREPLYTO', __METHOD__, true, 'oEmail');
                $tmp_oCC = $this->return_requestParam('oCC', __METHOD__, true, 'oEmail');
                $tmp_oBCC = $this->return_requestParam('oBCC', __METHOD__, true, 'oEmail');

                $tmp_size_oSENDER = sizeof($tmp_oSENDER);
                $tmp_size_oREPLYTO = sizeof($tmp_oREPLYTO);
                $tmp_size_oCC = sizeof($tmp_oCC);
                $tmp_size_oBCC = sizeof($tmp_oBCC);

                //
                // EXTRACT EMAIL PROTOCOL [SMTP, QMAIL, SENDMAIL, MAIL] FROM WCR
                if($tmp_CRNRSTN_PROXY_EMAIL_PROTOCOL == ''){

                    $tmp_CRNRSTN_PROXY_EMAIL_PROTOCOL = trim(strtoupper($this->oCRNRSTN_USR->get_resource('EMAIL_PROTOCOL')));
                    $tmp_SMTP_AUTH = false;

                }

                if($tmp_CRNRSTN_PROXY_EMAIL_PROTOCOL == 'SMTP'){

                    $tmp_SMTP_AUTH = $this->oCRNRSTN_USR->get_resource('SYS_SMTP_AUTH', 'CRNRSTN::INTEGRATIONS');
                    $tmp_SMTP_SERVER = $this->oCRNRSTN_USR->get_resource('SYS_SMTP_SERVER', 'CRNRSTN::INTEGRATIONS');
                    $tmp_SMTP_PORT_OUTGOING = $this->oCRNRSTN_USR->get_resource('SYS_SMTP_PORT_OUTGOING', 'CRNRSTN::INTEGRATIONS');
                    $tmp_SMTP_USERNAME = $this->oCRNRSTN_USR->get_resource('SYS_SMTP_USERNAME', 'CRNRSTN::INTEGRATIONS');
                    $tmp_SMTP_PASSWORD = $this->oCRNRSTN_USR->get_resource('SYS_SMTP_PASSWORD', 'CRNRSTN::INTEGRATIONS');

                }

                $tmp_oGabriel_serial = $this->oCRNRSTN_USR->generate_new_key(50);

                if($tmp_SMTP_AUTH){

                    //
                    // SMTP AUTH
                    $oCRNRSTN_GABRIEL = $this->oCRNRSTN_USR->initialize_oGabriel($tmp_oGabriel_serial, $tmp_CRNRSTN_PROXY_EMAIL_PROTOCOL, $tmp_SMTP_USERNAME, $tmp_SMTP_PASSWORD, $tmp_SMTP_PORT_OUTGOING);

                }else{

                    //
                    // ANY NON-AUTH
                    $oCRNRSTN_GABRIEL = $this->oCRNRSTN_USR->initialize_oGabriel($tmp_oGabriel_serial, $tmp_CRNRSTN_PROXY_EMAIL_PROTOCOL);

                }

                if(isset($tmp_SMTP_SERVER)){
                    if($tmp_SMTP_SERVER!=''){

                        $this->oCRNRSTN_USR->addHostServers($oCRNRSTN_GABRIEL, $tmp_SMTP_SERVER);

                    }
                }

                //
                // PASS RECIPIENT TO oMESSENGER FROM THE NORTH FOR BUILD OUT
                // ADD AS BULK EMAIL FOR SINGULARITY OF DELIVERY AND CUSTOMIZATION
                if(isset($tmp_oRECIPIENT['FIRSTNAME'])){

                    $tmp_name = trim($tmp_oRECIPIENT['FIRSTNAME']);

                    if(isset($tmp_oRECIPIENT['LASTNAME'])){

                        $tmp_name .= ' '.trim($tmp_oRECIPIENT['LASTNAME']);

                    }

                }else{

                    $tmp_name = '';

                }

                error_log('219 - SERVER addAddressBulk=[name::' . $tmp_name.']' . $tmp_oRECIPIENT['EMAILADDRESS'].' to oCRNRSTN_GABRIEL[' . $oCRNRSTN_GABRIEL->messenger_serial.']');
                $email_experience_tracker = $this->oCRNRSTN_USR->addAddressBulk($oCRNRSTN_GABRIEL, $tmp_oRECIPIENT['EMAILADDRESS'], $tmp_name);

                //
                // LOAD REMAINING SYSTEM MESSAGING META FROM SOAP (OR WCR @ PROXY)
                if($tmp_size_oSENDER<1){

                    $tmp_FROM_EMAIL = $this->oCRNRSTN_USR->get_resource('SYS_FROM_EMAIL', 'CRNRSTN::INTEGRATIONS');
                    $tmp_FROM_NAME = $this->oCRNRSTN_USR->get_resource('SYS_FROM_NAME', 'CRNRSTN::INTEGRATIONS');

                    $this->oCRNRSTN_USR->addFromBulk($oCRNRSTN_GABRIEL, $email_experience_tracker, $tmp_FROM_EMAIL, $tmp_FROM_NAME);

                }else{

                    if(isset($tmp_oSENDER[0]['FIRSTNAME'])){

                        $tmp_name = trim($tmp_oSENDER[0]['FIRSTNAME']);

                        if(isset($tmp_oSENDER[0]['LASTNAME'])){

                            $tmp_name .= ' '.trim($tmp_oSENDER[0]['LASTNAME']);

                        }

                    }else{

                        $tmp_name = '';

                    }

                    error_log('249 - SERVER SENDER name[' . $tmp_name.'] email[' . $tmp_oSENDER[0]['EMAILADDRESS'].']');
                    $this->oCRNRSTN_USR->addFromBulk($oCRNRSTN_GABRIEL, $email_experience_tracker, $tmp_oSENDER[0]['EMAILADDRESS'], $tmp_name);

                }

                if($tmp_size_oREPLYTO<1){

                    $tmp_REPLYTO_EMAIL = $this->oCRNRSTN_USR->get_resource('SYS_REPLYTO_EMAIL', 'CRNRSTN::INTEGRATIONS');
                    $tmp_REPLYTO_NAME = $this->oCRNRSTN_USR->get_resource('SYS_REPLYTO_NAME', 'CRNRSTN::INTEGRATIONS');
                    error_log('258 - SERVER SYS_REPLYTO_EMAIL name[' . $tmp_REPLYTO_NAME.'] email[' . $tmp_REPLYTO_EMAIL.']');

                    $this->oCRNRSTN_USR->addReplyToBulk($oCRNRSTN_GABRIEL, $email_experience_tracker, $tmp_REPLYTO_EMAIL, $tmp_REPLYTO_NAME);

                }else{

                    for($i=0; $i<$tmp_size_oREPLYTO; $i++){

                        if(isset($tmp_oREPLYTO[$i]['FIRSTNAME'])){

                            $tmp_name = trim($tmp_oREPLYTO[$i]['FIRSTNAME']);

                            if(isset($tmp_oREPLYTO[$i]['LASTNAME'])){

                                $tmp_name .= ' '.trim($tmp_oREPLYTO[$i]['LASTNAME']);

                            }

                        }else{

                            $tmp_name = '';

                        }
                        error_log('258 - SERVER SYS_REPLYTO_EMAIL name[' . $tmp_name.'] email[' . $tmp_oREPLYTO[$i]['EMAILADDRESS'].']');
                        $this->oCRNRSTN_USR->addReplyToBulk($oCRNRSTN_GABRIEL, $email_experience_tracker, $tmp_oREPLYTO[$i]['EMAILADDRESS'], $tmp_name);

                    }
                }

                if($tmp_size_oCC>0){

                    for($i=0; $i<$tmp_size_oCC; $i++){

                        if(isset($tmp_oCC[$i]['FIRSTNAME'])){

                            $tmp_name = trim($tmp_oCC[$i]['FIRSTNAME']);

                            if(isset($tmp_oCC[$i]['LASTNAME'])){

                                $tmp_name .= ' '.trim($tmp_oCC[$i]['LASTNAME']);

                            }

                        }else{

                            $tmp_name = '';

                        }

                        $this->oCRNRSTN_USR->addCCBulk($oCRNRSTN_GABRIEL, $email_experience_tracker, $tmp_oCC[$i]['EMAILADDRESS'], $tmp_name);

                    }
                }

                if($tmp_size_oBCC>0){

                    for($i=0; $i<$tmp_size_oBCC; $i++){

                        if(isset($tmp_oBCC[$i]['FIRSTNAME'])){

                            $tmp_name = trim($tmp_oBCC[$i]['FIRSTNAME']);

                            if(isset($tmp_oBCC[$i]['LASTNAME'])){

                                $tmp_name .= ' '.trim($tmp_oBCC[$i]['LASTNAME']);

                            }

                        }else{

                            $tmp_name = '';

                        }

                        $this->oCRNRSTN_USR->addBCCBulk($oCRNRSTN_GABRIEL, $email_experience_tracker, $tmp_oBCC[$i]['EMAILADDRESS'], $tmp_name);

                    }
                }

                $tmp_is_html = trim(strtoupper($this->return_requestParam('IS_HTML', __METHOD__)));
                if($tmp_is_html != ''){

                    if($tmp_is_html == 'TRUE'){

                        $tmp_DEFAULT_ISHTML = true;

                    }else{

                        $tmp_DEFAULT_ISHTML = false;

                    }

                }else{

                    $tmp_DEFAULT_ISHTML = $this->oCRNRSTN_USR->get_resource('ISHTML', 'CRNRSTN::INTEGRATIONS');

                }

                $this->oCRNRSTN_USR->isHTMLBulk($oCRNRSTN_GABRIEL, $email_experience_tracker, $tmp_DEFAULT_ISHTML);

                $tmp_priority = trim(strtoupper($this->return_requestParam('PRIORITY', __METHOD__)));
                if($tmp_priority != ''){

                    $tmp_DEFAULT_PRIORITY = $tmp_priority;

                }else{

                    $tmp_DEFAULT_PRIORITY = $this->oCRNRSTN_USR->get_resource('PRIORITY', 'CRNRSTN::INTEGRATIONS');

                }
                $this->oCRNRSTN_USR->setPriorityBulk($oCRNRSTN_GABRIEL, $email_experience_tracker, $tmp_DEFAULT_PRIORITY);


                $tmp_word_wrap = trim($this->return_requestParam('WORDWRAP', __METHOD__));

                if($tmp_word_wrap != ''){

                    $tmp_DEFAULT_WORDWRAP = $tmp_word_wrap;

                }else{

                    $tmp_DEFAULT_WORDWRAP = $this->oCRNRSTN_USR->get_resource('WORDWRAP', 'CRNRSTN::INTEGRATIONS');

                }
                $this->oCRNRSTN_USR->wordWrapBulk($oCRNRSTN_GABRIEL, $email_experience_tracker, $tmp_DEFAULT_WORDWRAP);

                $this->oCRNRSTN_USR->addSubjectBulk($oCRNRSTN_GABRIEL, $email_experience_tracker, $this->return_requestParam('MESSAGE_SUBJECT', __METHOD__));

                error_log('386 - SERVER ADD BODY HTML/TEXT ['.strlen($oCRNRSTN_GABRIEL->return_CRNRSTN_SysMsgBody('HTML', 'ELECTRUM_PERFORMANCE_REPORT')).']['.strlen($oCRNRSTN_GABRIEL->return_CRNRSTN_SysMsgBody('TEXT', 'ELECTRUM_PERFORMANCE_REPORT')).']');
                $this->oCRNRSTN_USR->addHTMLver_Bulk($oCRNRSTN_GABRIEL, $email_experience_tracker, $oCRNRSTN_GABRIEL->return_CRNRSTN_SysMsgBody('HTML', 'ELECTRUM_PERFORMANCE_REPORT'));
                $this->oCRNRSTN_USR->addTEXTver_Bulk($oCRNRSTN_GABRIEL, $email_experience_tracker, $oCRNRSTN_GABRIEL->return_CRNRSTN_SysMsgBody('TEXT', 'ELECTRUM_PERFORMANCE_REPORT'));

                $this->oCRNRSTN_USR->addDynamicContent_MULTIPART($oCRNRSTN_GABRIEL, $email_experience_tracker, '{SYS_REMOTE_ADDR}', $this->return_requestParam('SYS_REMOTE_ADDR', __METHOD__));
                $this->oCRNRSTN_USR->addDynamicContent_MULTIPART($oCRNRSTN_GABRIEL, $email_experience_tracker, '{SYS_SERVER_NAME}', $this->return_requestParam('SYS_SERVER_NAME', __METHOD__));
                $this->oCRNRSTN_USR->addDynamicContent_MULTIPART($oCRNRSTN_GABRIEL, $email_experience_tracker, '{SYS_SYSTEM_TIME}', $this->return_requestParam('SYS_SYSTEM_TIME', __METHOD__));
                $this->oCRNRSTN_USR->addDynamicContent_MULTIPART($oCRNRSTN_GABRIEL, $email_experience_tracker, '{PROCESS_RUN_TIME}', $this->return_requestParam('SYS_PROCESS_RUN_TIME', __METHOD__));
                $this->oCRNRSTN_USR->addDynamicContent_MULTIPART($oCRNRSTN_GABRIEL, $email_experience_tracker, '{START_TIME}', $this->return_requestParam('ELECTRUM_START_TIME', __METHOD__));
                $this->oCRNRSTN_USR->addDynamicContent_MULTIPART($oCRNRSTN_GABRIEL, $email_experience_tracker, '{END_TIME}', $this->return_requestParam('ELECTRUM_END_TIME', __METHOD__));
                $this->oCRNRSTN_USR->addDynamicContent_MULTIPART($oCRNRSTN_GABRIEL, $email_experience_tracker, '{PRETTY_RUN_TIME}', $this->return_requestParam('ELECTRUM_PRETTY_RUN_TIME', __METHOD__));
                $this->oCRNRSTN_USR->addDynamicContent_MULTIPART($oCRNRSTN_GABRIEL, $email_experience_tracker, '{TOTAL_COUNT_VALID_FOR_TRANSFER}', $this->return_requestParam('ELECTRUM_TOTAL_COUNT_VALID_FOR_TRANSFER', __METHOD__));
                $this->oCRNRSTN_USR->addDynamicContent_MULTIPART($oCRNRSTN_GABRIEL, $email_experience_tracker, '{TOTAL_COUNT_DESTINATION_ENDPOINTS}', $this->return_requestParam('ELECTRUM_TOTAL_COUNT_DESTINATION_ENDPOINTS', __METHOD__));
                $this->oCRNRSTN_USR->addDynamicContent_MULTIPART($oCRNRSTN_GABRIEL, $email_experience_tracker, '{TOTAL_COUNT_FILES_TRANSFERRED}', $this->return_requestParam('ELECTRUM_TOTAL_COUNT_FILES_TRANSFERRED', __METHOD__));
                $this->oCRNRSTN_USR->addDynamicContent_MULTIPART($oCRNRSTN_GABRIEL, $email_experience_tracker, '{TOTAL_COUNT_FILES_SKIPPED}', $this->return_requestParam('ELECTRUM_TOTAL_COUNT_FILES_SKIPPED', __METHOD__));
                $this->oCRNRSTN_USR->addDynamicContent_MULTIPART($oCRNRSTN_GABRIEL, $email_experience_tracker, '{TOTAL_FILESIZE_FILES_TRANSFERRED}', $this->return_requestParam('ELECTRUM_TOTAL_FILESIZE_FILES_TRANSFERRED', __METHOD__));
                $this->oCRNRSTN_USR->addDynamicContent_MULTIPART($oCRNRSTN_GABRIEL, $email_experience_tracker, '{ENDPOINT_FILESIZE_FILES_TRANSFERRED}', $this->return_requestParam('ELECTRUM_ENDPOINT_FILESIZE_FILES_TRANSFERRED', __METHOD__));
                $this->oCRNRSTN_USR->addDynamicContent_MULTIPART($oCRNRSTN_GABRIEL, $email_experience_tracker, '{TOTAL_ERRORS_FILES_TRANSFERRED}', $this->return_requestParam('ELECTRUM_TOTAL_ERRORS_FILES_TRANSFERRED', __METHOD__));
                $this->oCRNRSTN_USR->addDynamicContent_MULTIPART($oCRNRSTN_GABRIEL, $email_experience_tracker, '{TOTAL_COUNT_ENDPOINT_CONNECTION_ERROR}',  $this->return_requestParam('ELECTRUM_TOTAL_COUNT_ENDPOINT_CONNECTION_ERROR', __METHOD__));
                $this->oCRNRSTN_USR->addDynamicContent_MULTIPART($oCRNRSTN_GABRIEL, $email_experience_tracker, '{PERCENTAGE_FILES_SUCCESSFUL_TRANSFERRED}', $this->return_requestParam('ELECTRUM_PERCENTAGE_FILES_SUCCESSFUL_TRANSFERRED', __METHOD__));
                $this->oCRNRSTN_USR->addDynamicContent_MULTIPART($oCRNRSTN_GABRIEL, $email_experience_tracker, '{EMAIL}', $tmp_oRECIPIENT['EMAILADDRESS']);

                //
                // TO HANDLE DYNAMIC CONTENT FOR HTML AND TEXT SEPARATELY
                $this->oCRNRSTN_USR->addDynamicContent_HTML($oCRNRSTN_GABRIEL, $email_experience_tracker, '{SYS_MESSAGE_TITLE_HTML}', $this->return_requestParam('SYS_MESSAGE_TITLE_HTML', __METHOD__));
                $this->oCRNRSTN_USR->addDynamicContent_HTML($oCRNRSTN_GABRIEL, $email_experience_tracker, '{SYS_MESSAGE_HTML}', $this->return_requestParam('SYS_MESSAGE_HTML', __METHOD__));
                $this->oCRNRSTN_USR->addDynamicContent_HTML($oCRNRSTN_GABRIEL, $email_experience_tracker, '{SYS_LOG_INTEGER_CONSTANT}', $this->oCRNRSTN_USR->return_log_priority_pretty(LOG_NOTICE, 'HTML'));
                $this->oCRNRSTN_USR->addDynamicContent_HTML($oCRNRSTN_GABRIEL, $email_experience_tracker, '{ELECTRUM_DATA_SOURCE_HTML}', $this->return_requestParam('ELECTRUM_DATA_SOURCE_HTML', __METHOD__));
                $this->oCRNRSTN_USR->addDynamicContent_HTML($oCRNRSTN_GABRIEL, $email_experience_tracker, '{ELECTRUM_DATA_DESTINATION_HTML}', $this->return_requestParam('ELECTRUM_DATA_DESTINATION_HTML', __METHOD__));
                $this->oCRNRSTN_USR->addDynamicContent_HTML($oCRNRSTN_GABRIEL, $email_experience_tracker, '{ELECTRUM_DATA_HANDLING_PROFILE_HTML}', $this->return_requestParam('ELECTRUM_DATA_HANDLING_PROFILE_HTML', __METHOD__));
                $this->oCRNRSTN_USR->addDynamicContent_HTML($oCRNRSTN_GABRIEL, $email_experience_tracker, '{ELECTRUM_ERRORS_TRACE_HTML}', $this->return_requestParam('ELECTRUM_ERRORS_TRACE_HTML', __METHOD__));

                $this->oCRNRSTN_USR->addDynamicContent_TEXT($oCRNRSTN_GABRIEL, $email_experience_tracker, '{SYS_MESSAGE_TITLE_TEXT}', $this->return_requestParam('SYS_MESSAGE_TITLE_TEXT', __METHOD__));
                $this->oCRNRSTN_USR->addDynamicContent_TEXT($oCRNRSTN_GABRIEL, $email_experience_tracker, '{SYS_MESSAGE_TEXT}', $this->return_requestParam('SYS_MESSAGE_TEXT', __METHOD__));
                $this->oCRNRSTN_USR->addDynamicContent_TEXT($oCRNRSTN_GABRIEL, $email_experience_tracker, '{SYS_LOG_INTEGER_CONSTANT}', $this->oCRNRSTN_USR->return_log_priority_pretty(LOG_NOTICE));
                $this->oCRNRSTN_USR->addDynamicContent_TEXT($oCRNRSTN_GABRIEL, $email_experience_tracker, '{ELECTRUM_DATA_SOURCE_TEXT}', $this->return_requestParam('ELECTRUM_DATA_SOURCE_TEXT', __METHOD__));
                $this->oCRNRSTN_USR->addDynamicContent_TEXT($oCRNRSTN_GABRIEL, $email_experience_tracker, '{ELECTRUM_DATA_DESTINATION_TEXT}', $this->return_requestParam('ELECTRUM_DATA_DESTINATION_TEXT', __METHOD__));
                $this->oCRNRSTN_USR->addDynamicContent_TEXT($oCRNRSTN_GABRIEL, $email_experience_tracker, '{ELECTRUM_DATA_HANDLING_PROFILE_TEXT}', $this->return_requestParam('ELECTRUM_DATA_HANDLING_PROFILE_TEXT', __METHOD__));
                $this->oCRNRSTN_USR->addDynamicContent_TEXT($oCRNRSTN_GABRIEL, $email_experience_tracker, '{ELECTRUM_ERRORS_TRACE_TEXT}', $this->return_requestParam('ELECTRUM_ERRORS_TRACE_TEXT', __METHOD__));


                /*
                {MESSAGE_TITLE}
{SYSTEM_LOG_INTEGER_CONSTANT}
SYSTEM MESSAGE ::
{MESSAGE}
Sending IP Address ::
{REMOTE_ADDR} ({SERVER_NAME})
System Timestamp ::
{SYSTEM_TIME}
Process Runtime ::
{PROCESS_RUN_TIME} seconds
Start Time :: {START_TIME}
End Time :: {END_TIME}
Total Run Time :: {PRETTY_RUN_TIME}
Number of files transferred :: {TOTAL_COUNT_FILES_TRANSFERRED}
Number of files skipped :: {TOTAL_COUNT_FILES_SKIPPED}
Total file size of transferred data :: {TOTAL_FILESIZE_FILES_TRANSFERRED}
Number of file transfer errors experienced :: {TOTAL_ERRORS_FILES_TRANSFERRED}
Number of endpoint connection errors experienced :: {TOTAL_COUNT_ENDPOINT_CONNECTION_ERROR}
Percentage of files successfully transferred :: {PERCENTAGE_FILES_SUCCESSFUL_TRANSFERRED}


{ELECTRUM_DATA_SOURCE_TEXT}
{ELECTRUM_DATA_DESTINATION_TEXT}
{ELECTRUM_DATA_HANDLING_PROFILE_TEXT}

= = = = = = = = = = = = = = = = = = = = = = = = = {ELECTRUM_ERRORS_TRACE_TITLE_TEXT}
{ELECTRUM_ERRORS_TRACE_TEXT}
This email was sent to {}.

                 * */

                //
                // STRAIGHT SEND
                error_log(__LINE__ . ' SOAP SERVER - HOOKED UP EMAIL SEND oCRNRSTN_GABRIEL[' . $oCRNRSTN_GABRIEL->messenger_serial . ']');
                $send_result_array = $this->oCRNRSTN_USR->oGabriel_Send($oCRNRSTN_GABRIEL);        // SEND ALL READY EMAIL (AND CLEAR SENT EMAIL MESSAGE DATA)
                $send_ts = $this->oCRNRSTN_USR->return_micro_time();

                $tmp_ogabriel_cnt = sizeof($send_result_array);
                for($i=0; $i<$tmp_ogabriel_cnt; $i++){

                    $tmp_attempt_send_cnt = sizeof($send_result_array[$i]['is_success']);
                    for($send_cnt=0; $send_cnt<$tmp_attempt_send_cnt; $send_cnt++){

                        if($send_result_array[$i]['is_success'][$send_cnt]){

                            $tmp_status_ARRAY = array(
                                'EMAIL_PROXY_SERIAL' => $tmp_oRECIPIENT['EMAIL_PROXY_SERIAL'],
                                'IS_SENT' => 'TRUE',
                                'SEND_TIMESTAMP' => $send_ts,
                                'SEND_STATUS' => 'SEND SUCCESS',
                                'STATUS_DETAIL' => 'The CRNRSTN :: SOAP services layer has registered successful email send along with the following PHPMailer status message :: ' . $send_result_array[$i]['status_msg'][$send_cnt]
                            );

                        }else{

                            $tmp_status_ARRAY = array(
                                'EMAIL_PROXY_SERIAL' => $tmp_oRECIPIENT['EMAIL_PROXY_SERIAL'],
                                'IS_SENT' => 'FALSE',
                                'SEND_TIMESTAMP' => '',
                                'SEND_STATUS' => 'SEND ERROR',
                                'STATUS_DETAIL' => 'The CRNRSTN :: SOAP services layer has captured a PHPMailer send error for this email address with detail as follows :: ' . $send_result_array[$i]['status_msg'][$send_cnt]
                            );

                        }

                    }

                }

            }

        }else{

            //
            // STRAIGHT SEND
            error_log('395 SOAP SERVER - HOOK UP STRAIGHT EMAIL SEND.');

        }

        return $tmp_status_ARRAY;

/*
        array_push($tmp_status_report_ARRAY, array(
            'EMAIL_PROXY_SERIAL' => $this->oCRNRSTN_USR->data_encrypt($tmp_EMAIL_PROXY_SERIAL, CRNRSTN_ENCRYPT_SOAP),
            'IS_SENT'
            'SEND_TIMESTAMP' =>
            'SEND_STATUS' => $this->oCRNRSTN_USR->data_encrypt('SEND SUCCESS', CRNRSTN_ENCRYPT_SOAP),
            'STATUS_DETAIL' =>$this->oCRNRSTN_USR->data_encrypt('', CRNRSTN_ENCRYPT_SOAP)
        ));
*/

    }

    private function encrypt_email_oStatusReport($oStatusReport){

        $oStatusReport['EMAIL_PROXY_SERIAL'] = $this->oCRNRSTN_USR->data_encrypt($oStatusReport['EMAIL_PROXY_SERIAL'], CRNRSTN_ENCRYPT_SOAP);
        $oStatusReport['IS_SENT'] = $this->oCRNRSTN_USR->data_encrypt($oStatusReport['IS_SENT'], CRNRSTN_ENCRYPT_SOAP);
        $oStatusReport['SEND_TIMESTAMP'] = $this->oCRNRSTN_USR->data_encrypt($oStatusReport['SEND_TIMESTAMP'], CRNRSTN_ENCRYPT_SOAP);
        $oStatusReport['SEND_STATUS'] = $this->oCRNRSTN_USR->data_encrypt($oStatusReport['SEND_STATUS'], CRNRSTN_ENCRYPT_SOAP);
        $oStatusReport['STATUS_DETAIL'] = $this->oCRNRSTN_USR->data_encrypt($oStatusReport['STATUS_DETAIL'], CRNRSTN_ENCRYPT_SOAP);

        return $oStatusReport;

    }

    private function SOAPserver_processElectrumReportRequest(){

	    //
        // WE ARE AT THE SERVER [PROXY]. HANDLE THE REQUEST.
        $SOAP_server_response = array();
        $SOAP_send_success_cnt = 0;
        $SOAP_send_error_cnt = 0;
        $SOAP_send_suppress_cnt = 0;

        //
        //  oGABRIEL HERE. EXECUTE ELECTRUM PERFORMANCE REPORT HERE.
        $tmp_isEncrypted = trim(strtolower(self::$oSoapRequest['CRNRSTN_PACKET_IS_ENCRYPTED']));
        //error_log('447 - SOAP SERVER IS ENCRYPTED=' . $tmp_isEncrypted);
        if($tmp_isEncrypted == 'true'){

            $this->SOAP_request_isEncrypted = true;
            error_log('552 SOAP SERVER - CRNRSTN_SOAP_SVC_AUTH_KEY='.self::$oSoapRequest['CRNRSTN_SOAP_SVC_AUTH_KEY']);
            $tmp_auth_key = $this->oCRNRSTN_USR->data_decrypt(self::$oSoapRequest['CRNRSTN_SOAP_SVC_AUTH_KEY'], CRNRSTN_ENCRYPT_SOAP, true);

        }else{

            $this->SOAP_request_isEncrypted = false;
            $tmp_auth_key = self::$oSoapRequest['CRNRSTN_SOAP_SVC_AUTH_KEY'];

        }

        $crnrstn_proxy_auth_key = $this->oCRNRSTN_USR->get_resource('CRNRSTN_SOAP_SVC_AUTH_KEY');

        if($crnrstn_proxy_auth_key == $tmp_auth_key){
            //error_log('463 SOAP SERVER KEY MATCH SUCCESS[' . $tmp_auth_key.']');
            $tmp_status_report_ARRAY = array();

            $tmp_oRECIPIENT = $this->return_requestParam('oRECIPIENT', __METHOD__, true, 'oEmail');
            $tmp_size_oRECIPIENT = sizeof($tmp_oRECIPIENT);
            //error_log('468 SOAP SERVER oRECIPIENT[0-'.self::$oSoapRequest['oRECIPIENT'][0]['EMAILADDRESS'].'] COUNT[' . $tmp_size_oRECIPIENT.'] EMAIL POS[0]=' . $tmp_size_oRECIPIENT[0]['EMAILADDRESS']);

            if($tmp_size_oRECIPIENT<1){

                if($this->SOAP_request_isEncrypted){

                    //
                    // OBJECT :: oEmailSendReport
                    array_push($tmp_status_report_ARRAY, array(
                        'CRNRSTN_SOAP_SVC_AUTH_KEY' => $this->oCRNRSTN_USR->data_encrypt($tmp_auth_key, CRNRSTN_ENCRYPT_SOAP),
                        'TOTAL_EMAILS_RECEIVED' => $this->oCRNRSTN_USR->data_encrypt('0', CRNRSTN_ENCRYPT_SOAP),
                        'TOTAL_EMAILS_SENT' => $this->oCRNRSTN_USR->data_encrypt('0', CRNRSTN_ENCRYPT_SOAP),
                        'ACTIVITY_STATUS_MESSAGE' => $this->oCRNRSTN_USR->data_encrypt('The email recipient node of the SOAP request received by the CRNRSTN :: SOAP Services layer contains ' . $tmp_size_oRECIPIENT . ' records.', CRNRSTN_ENCRYPT_SOAP)
                    ));

                }else{

                    //
                    // OBJECT :: oEmailSendReport
                    array_push($tmp_status_report_ARRAY, array(
                        'CRNRSTN_SOAP_SVC_AUTH_KEY' => $tmp_auth_key,
                        'TOTAL_EMAILS_RECEIVED' => '0',
                        'TOTAL_EMAILS_SENT' => '0',
                        'ACTIVITY_STATUS_MESSAGE' => 'The email recipient node of the SOAP request received by the CRNRSTN :: SOAP Services layer contains ' . $tmp_size_oRECIPIENT . ' records.'
                    ));

                }

            }else{

                $tmp_SUPPRESS_DUPLICATE_RECIPIENT = trim(strtolower($this->return_requestParam('SUPPRESS_DUPLICATE_RECIPIENT', __METHOD__)));

                if($tmp_SUPPRESS_DUPLICATE_RECIPIENT==''){

                    $this->SOAP_request_sendSuppression = true;

                }else{

                    $this->SOAP_request_sendSuppression = $tmp_SUPPRESS_DUPLICATE_RECIPIENT;

                }

                if($tmp_SUPPRESS_DUPLICATE_RECIPIENT == 'true' || $tmp_SUPPRESS_DUPLICATE_RECIPIENT == ''){

                    //
                    // WE HAVE RECIPIENTS TO WHICH TO SEND COMMUNICATIONS
                    for($i=0; $i<$tmp_size_oRECIPIENT; $i++){

                        //
                        // OBJECT :: oStatusReport
                        //error_log('556 - SOAP SERVER SEND[' . $tmp_size_oRECIPIENT . '|' . $i . '] TO ' . $tmp_oRECIPIENT[$i]['EMAILADDRESS']);
                        $tmp_oStatusReport = $this->SOAPserver_sendEmail($tmp_oRECIPIENT[$i]);

                        if($tmp_oStatusReport['IS_SENT'] == 'TRUE'){

                            $SOAP_send_success_cnt++;

                        }else{

                            if($tmp_oStatusReport['SEND_STATUS'] == 'SEND SUPPRESSED'){

                                $SOAP_send_suppress_cnt++;

                            }else{

                                $SOAP_send_error_cnt++;

                            }

                        }

                        if($this->SOAP_request_isEncrypted){

                            $tmp_oStatusReport = $this->encrypt_email_oStatusReport($tmp_oStatusReport);

                        }

                        array_push($tmp_status_report_ARRAY, $tmp_oStatusReport);

                    }

                }else{

                    $this->SOAP_request_sendSuppression = false;

                    //
                    // WE HAVE RECIPIENTS TO WHICH TO SEND COMMUNICATIONS
                    for($i=0; $i<$tmp_size_oRECIPIENT; $i++){

                        //
                        // OBJECT :: oStatusReport
                        //error_log('596 - SOAP SERVER SEND TO ' . $tmp_oRECIPIENT[$i]['EMAILADDRESS']);
                        $tmp_oStatusReport = $this->SOAPserver_sendEmail($tmp_oRECIPIENT[$i]);

                        if($tmp_oStatusReport['IS_SENT'] == 'TRUE'){

                            $SOAP_send_success_cnt++;

                        }else{

                            $SOAP_send_error_cnt++;

                        }

                        if($this->SOAP_request_isEncrypted){

                            $tmp_oStatusReport = $this->encrypt_email_oStatusReport($tmp_oStatusReport);

                        }

                        array_push($tmp_status_report_ARRAY, $tmp_oStatusReport);

                    }

                }

            }

            /*
            for($i=0;$i<$tmp_size_oRECIPIENT;$i++){
                $tmp_EMAIL_PROXY_SERIAL = $this->oCRNRSTN_USR->data_decrypt($tmp_RECIPIENT[$i]['EMAIL_PROXY_SERIAL'], CRNRSTN_ENCRYPT_SOAP);
                $tmp_EMAILADDRESS = $this->oCRNRSTN_USR->data_decrypt($tmp_RECIPIENT[$i]['EMAILADDRESS'], CRNRSTN_ENCRYPT_SOAP);
                error_log('69 - S.E.R.M. Connectivity Test - EMAIL['.$i.']='.$tmp_EMAILADDRESS.' EMAIL_PROXY_SERIAL='.$tmp_EMAIL_PROXY_SERIAL);

                array_push($tmp_status_report_ARRAY, array(
                    'EMAIL_PROXY_SERIAL' => $this->oCRNRSTN_USR->data_encrypt($tmp_EMAIL_PROXY_SERIAL, CRNRSTN_ENCRYPT_SOAP),
                    'IS_SENT'
                    'SEND_TIMESTAMP'
                    'SEND_STATUS' => $this->oCRNRSTN_USR->data_encrypt('Send success.', CRNRSTN_ENCRYPT_SOAP),
                    'STATUS_DETAIL' =>$this->oCRNRSTN_USR->data_encrypt('1', CRNRSTN_ENCRYPT_SOAP)
                ));
            }
            */

            if($this->SOAP_request_isEncrypted){

                //
                // OBJECT :: oEmailSendReport
                $SOAP_server_response = array(
                    'CRNRSTN_SOAP_SVC_AUTH_KEY' => $this->oCRNRSTN_USR->data_encrypt($tmp_auth_key, CRNRSTN_ENCRYPT_SOAP),
                    'REQUEST_RECEIVED_TIMESTAMP' => $this->oCRNRSTN_USR->data_encrypt($this->SOAP_startTime, CRNRSTN_ENCRYPT_SOAP),
                    'REQUEST_COMPLETED_TIMESTAMP' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->return_micro_time(), CRNRSTN_ENCRYPT_SOAP),
                    'SOAP_OPERATION_RUNTIME_SECONDS' => $this->oCRNRSTN_USR->data_encrypt($this->SOAP_monitor_time('ELECTRUM_PERFORMANCE'), CRNRSTN_ENCRYPT_SOAP),
                    'TOTAL_EMAILS_RECEIVED' => $this->oCRNRSTN_USR->data_encrypt($tmp_size_oRECIPIENT, CRNRSTN_ENCRYPT_SOAP),
                    'TOTAL_EMAILS_SENT' => $this->oCRNRSTN_USR->data_encrypt($SOAP_send_success_cnt, CRNRSTN_ENCRYPT_SOAP),
                    'TOTAL_EMAILS_SUPPRESSED' => $this->oCRNRSTN_USR->data_encrypt($SOAP_send_suppress_cnt, CRNRSTN_ENCRYPT_SOAP),
                    'TOTAL_EMAILS_ERROR' => $this->oCRNRSTN_USR->data_encrypt($SOAP_send_error_cnt, CRNRSTN_ENCRYPT_SOAP),
                    'ACTIVITY_STATUS_MESSAGE' => $this->oCRNRSTN_USR->data_encrypt('CRNRSTN :: Electrum performance notification send processing completed successfully.', CRNRSTN_ENCRYPT_SOAP),
                    'oACTIVITY_STATUS_REPORT' => $tmp_status_report_ARRAY);

            }else{

                //
                // OBJECT :: oEmailSendReport
                $SOAP_server_response = array(
                    'CRNRSTN_SOAP_SVC_AUTH_KEY' => $tmp_auth_key,
                    'REQUEST_RECEIVED_TIMESTAMP' => $this->SOAP_startTime,
                    'REQUEST_COMPLETED_TIMESTAMP' => $this->oCRNRSTN_USR->return_micro_time(),
                    'SOAP_OPERATION_RUNTIME_SECONDS' => $this->SOAP_monitor_time('ELECTRUM_PERFORMANCE'),
                    'TOTAL_EMAILS_RECEIVED' => $tmp_size_oRECIPIENT,
                    'TOTAL_EMAILS_SENT' => $SOAP_send_success_cnt,
                    'TOTAL_EMAILS_SUPPRESSED' => $SOAP_send_suppress_cnt,
                    'TOTAL_EMAILS_ERROR' => $SOAP_send_error_cnt,
                    'ACTIVITY_STATUS_MESSAGE' => 'CRNRSTN :: Electrum performance notification send processing completed successfully.',
                    'oACTIVITY_STATUS_REPORT' => $tmp_status_report_ARRAY);

            }

        }else{

            /*
            'oEmailSendReport'
            'CRNRSTN_SOAP_SVC_AUTH_KEY' => array( 'name' => 'CRNRSTN_SOAP_SVC_AUTH_KEY',  'type' => 'xsd:string' ),
            'REQUEST_RECEIVED_TIMESTAMP' => array( 'name' => 'REQUEST_RECEIVED_TIMESTAMP',  'type' => 'xsd:string' ),
            'REQUEST_COMPLETED_TIMESTAMP' => array( 'name' => 'REQUEST_COMPLETED_TIMESTAMP',  'type' => 'xsd:string' ),
            'SOAP_OPERATION_RUNTIME_SECONDS' => array( 'name' => 'SOAP_OPERATION_RUNTIME_SECONDS',  'type' => 'xsd:string' ),
            'TOTAL_EMAILS_RECEIVED' => array( 'name' => 'TOTAL_EMAILS_RECEIVED',  'type' => 'xsd:string' ),
            'TOTAL_EMAILS_SENT' => array( 'name' => 'TOTAL_EMAILS_SENT',  'type' => 'xsd:string' ),
            'TOTAL_EMAILS_ERROR' => array( 'name' => 'TOTAL_EMAILS_ERROR',  'type' => 'xsd:string' ),
            'ACTIVITY_STATUS_MESSAGE' => array( 'name' => 'TOTAL_EMAILS_ERROR',  'type' => 'xsd:string' ),
            'oACTIVITY_STATUS_REPORT' => array( 'name' => 'ACTIVITY_STATUS_REPORT', 'type' => 'tns:oStatusReportArray' )

            'oStatusReport'
            'EMAIL_PROXY_SERIAL' => array( 'name' => 'EMAIL_PROXY_SERIAL',  'type' => 'xsd:string' ),
            'IS_SENT'
            'SEND_TIMESTAMP'
            'SEND_STATUS' => array( 'name' => 'SEND_STATUS',  'type' => 'xsd:string' ),
            'STATUS_DETAIL' => array( 'name' => 'STATUS_DETAIL',  'type' => 'xsd:string' )
            */

            //
            // OBJECT :: oEmailSendReport
            array_push($SOAP_server_response, array(
                'CRNRSTN_SOAP_SVC_AUTH_KEY' => $this->oCRNRSTN_USR->data_encrypt($tmp_auth_key, CRNRSTN_ENCRYPT_SOAP),
                'ACTIVITY_STATUS_MESSAGE' => '403 :: Unauthorized request received by the CRNRSTN :: SOAP Services layer.'
            ));

        }


        /*
        self::$oSoapRequest;
        self::$oSoapRequest['CRNRSTN_PACKET_IS_ENCRYPTED'] => 'TRUE',

        PHPMAILER REQS
        'CRNRSTN_SOAP_SVC_AUTH_KEY' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->get_resource('CRNRSTN_SOAP_SVC_AUTH_KEY'), CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'RECIPIENT' => $tmp_RECIPIENT_ARRAY,
        'SENDER' => $tmp_SENDER_ARRAY,
        'REPLYTO' => $tmp_REPLYTO_ARRAY,
        'CC' => $tmp_CC_ARRAY,
        'BCC' => $tmp_BCC_ARRAY,
        'MESSAGE_SUBJECT' => $this->oCRNRSTN_USR->data_encrypt('CRNRSTN :: Electrum performance report from '.$_SERVER['REMOTE_ADDR'].' ('.$_SERVER['SERVER_NAME'].')', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'WORDWRAP' => $this->oCRNRSTN_USR->data_encrypt('72', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'PRIORITY' => $this->oCRNRSTN_USR->data_encrypt('3', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'IS_HTML' => $this->oCRNRSTN_USR->data_encrypt('true', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),

        DYN CONTENT
        'SYS_MESSAGE_TITLE_HTML' => $this->oCRNRSTN_USR->data_encrypt('C<span style="color: #F90000;">R</span>NRSTN :: Electrum Performance Notification', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'SYS_MESSAGE_TITLE_TEXT' => $this->oCRNRSTN_USR->data_encrypt('CRNRSTN :: Electrum Performance Notification', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'SYS_LOG_INTEGER_CONSTANT' => $this->oCRNRSTN_USR->data_encrypt('LOG_INFO', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'SYS_MESSAGE_HTML' => $this->oCRNRSTN_USR->data_encrypt('<div style="font-weight: bold;">C<span style="color: #F90000;">R</span>NRSTN :: Electrum process has completed successfully.</div>', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'SYS_MESSAGE_TEXT' => $this->oCRNRSTN_USR->data_encrypt('CRNRSTN :: Electrum process has completed successfully.', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'SYS_REMOTE_ADDR' => $this->oCRNRSTN_USR->data_encrypt($_SERVER['REMOTE_ADDR'], CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'SYS_SERVER_NAME' => $this->oCRNRSTN_USR->data_encrypt($_SERVER['SERVER_NAME'], CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'SYS_SYSTEM_TIME' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->return_query_date_time_stamp(), CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'SYS_PROCESS_RUN_TIME' => $this->oCRNRSTN_USR->data_encrypt($this->oCRNRSTN_USR->wall_time(), CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'SYS_ACTIVITY_TRACE_TITLE' => $this->oCRNRSTN_USR->data_encrypt('CRNRSTN :: ELECTRUM EXCEPTION LOG TRACE', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'SYS_ACTIVITY_TRACE_CONTENT_HTML' => $this->oCRNRSTN_USR->data_encrypt('<div style="font-weight: bold;">Begin C<span style="color: #F90000;">R</span>NRSTN :: Electrum error log trace...</div>', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'SYS_ACTIVITY_TRACE_CONTENT_TEXT' => $this->oCRNRSTN_USR->data_encrypt('Begin CRNRSTN :: Electrum error log trace...', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'ELECTRUM_START_TIME' => $this->oCRNRSTN_USR->data_encrypt('{START_TIME_}', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'ELECTRUM_END_TIME' => $this->oCRNRSTN_USR->data_encrypt('{END_TIME_}', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'ELECTRUM_PRETTY_RUN_TIME' => $this->oCRNRSTN_USR->data_encrypt('{PRETTY_RUN_TIME_}', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'ELECTRUM_TOTAL_COUNT_FILES_TRANSFERRED' => $this->oCRNRSTN_USR->data_encrypt('{TOTAL_COUNT_FILES_TRANSFERRED_}', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'ELECTRUM_TOTAL_COUNT_FILES_SKIPPED' => $this->oCRNRSTN_USR->data_encrypt('{TOTAL_COUNT_FILES_SKIPPED_}', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'ELECTRUM_TOTAL_FILESIZE_FILES_TRANSFERRED' => $this->oCRNRSTN_USR->data_encrypt('{TOTAL_FILESIZE_FILES_TRANSFERRED_}', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'ELECTRUM_TOTAL_ERRORS_FILES_TRANSFERRED' => $this->oCRNRSTN_USR->data_encrypt('{TOTAL_ERRORS_FILES_TRANSFERRED_}', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'ELECTRUM_TOTAL_COUNT_ENDPOINT_CONNECTION_ERROR' => $this->oCRNRSTN_USR->data_encrypt('{TOTAL_COUNT_ENDPOINT_CONNECTION_ERROR_}', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'ELECTRUM_PERCENTAGE_FILES_SUCCESSFUL_TRANSFERRED' => $this->oCRNRSTN_USR->data_encrypt('{PERCENTAGE_FILES_SUCCESSFUL_TRANSFERRED_}', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'ELECTRUM_DATA_SOURCE_HTML' => $this->oCRNRSTN_USR->data_encrypt('{ELECTRUM_DATA_SOURCE_HTML_}', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'ELECTRUM_DATA_DESTINATION_HTML' => $this->oCRNRSTN_USR->data_encrypt('{ELECTRUM_DATA_DESTINATION_HTML_}', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'ELECTRUM_DATA_HANDLING_PROFILE_HTML' => $this->oCRNRSTN_USR->data_encrypt('{ELECTRUM_DATA_HANDLING_PROFILE_HTML_}', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'ELECTRUM_DATA_SOURCE_TEXT' => $this->oCRNRSTN_USR->data_encrypt('{ELECTRUM_DATA_SOURCE_TEXT_}', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'ELECTRUM_DATA_DESTINATION_TEXT' => $this->oCRNRSTN_USR->data_encrypt('{ELECTRUM_DATA_DESTINATION_TEXT_}', CRNRSTN_ENCRYPT_SOAP, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'ELECTRUM_DATA_HANDLING_PROFILE_TEXT' => $this->oCRNRSTN_USR->data_encrypt('{ELECTRUM_DATA_HANDLING_PROFILE_TEXT_}', CRNRSTN_ENCRYPT_SOAP)
	     */

        return $SOAP_server_response;
    }

    public function return_requestParam($key, $method, $isArray=false, $SOAP_object_type=NULL){

	    try{

	        if(isset(self::$oSoapRequest[$key])){

	            error_log(__LINE__ .' soa $key=['.$key.']'.print_r(self::$oSoapRequest[$key], true));

	            if($isArray){

                    $tmp_array = self::$oSoapRequest[$key];

                    $SOAP_object_type = trim(strtoupper($SOAP_object_type));
	                switch($SOAP_object_type){
	                    case 'OEMAIL':
                            $tmp_array = self::$oSoapRequest[$key];
                            $tmp_array_size = sizeof($tmp_array);
                            for($i_pos=0; $i_pos<$tmp_array_size; $i_pos++){

                                if($this->SOAP_request_isEncrypted == 'true'){
                                    //error_log('709 - SOAP SERVER['.$tmp_array_size.']['.$i_pos.'] - '.$tmp_array[$i_pos]['EMAILADDRESS']);
                                    $tmp_array[$i_pos]['EMAIL_PROXY_SERIAL'] = $this->oCRNRSTN_USR->data_decrypt($tmp_array[$i_pos]['EMAIL_PROXY_SERIAL'], CRNRSTN_ENCRYPT_SOAP, true);
                                    $tmp_array[$i_pos]['EMAILADDRESS'] = $this->oCRNRSTN_USR->data_decrypt($tmp_array[$i_pos]['EMAILADDRESS'], CRNRSTN_ENCRYPT_SOAP, true);

                                    if(isset($tmp_array[$i_pos]['FIRSTNAME'])){

                                        $tmp_array[$i_pos]['FIRSTNAME'] = $this->oCRNRSTN_USR->data_decrypt($tmp_array[$i_pos]['FIRSTNAME'], CRNRSTN_ENCRYPT_SOAP, true);

                                    }

                                    if(isset($tmp_array[$i_pos]['LASTNAME'])){

                                        $tmp_array[$i_pos]['LASTNAME'] = $this->oCRNRSTN_USR->data_decrypt($tmp_array[$i_pos]['LASTNAME'], CRNRSTN_ENCRYPT_SOAP, true);

                                    }

                                    //error_log('715 - SOAP SERVER['.$tmp_array_size.']['.$i_pos.'] - '.$tmp_array[$i_pos]['EMAILADDRESS']);
                                }else{
                                    //error_log('717 - SOAP RETURN FOR NOT IS ENCRYPTED....');
                                    return $tmp_array;

                                }

                            }

                        break;

                    }

                    return $tmp_array;

                }else{

                    if($this->SOAP_request_isEncrypted == 'true'){

                        $tmp_request_param = self::$oSoapRequest[$key];

                        error_log($this->oCRNRSTN_USR->print_r_str('DECRYPT PARAMS=' . print_r($this->oCRNRSTN_USR->return_data_decrypt_settings($tmp_request_param), CRNRSTN_ENCRYPT_SOAP, true), NULL, __LINE__, __METHOD__, __FILE__));
                        die();
                        return $this->oCRNRSTN_USR->data_decrypt($tmp_request_param, CRNRSTN_ENCRYPT_SOAP, true);

                    }else{

                        return self::$oSoapRequest[$key];

                    }

                }

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                //throw new Exception('The CRNRSTN :: SOAP service request manager was unable to find the "'.$key.'" parameter while running the '.$method.'() method.');

                return NULL;
            }

        }catch(Exception $e){

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE.
            return false;

        }

    }
	
	public function __destruct(){

	}
}