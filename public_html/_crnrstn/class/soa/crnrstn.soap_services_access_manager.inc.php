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
#         AUTHOR :: Jonathan '5' Harris, CEO, CTO, Lead Full Stack Developer, jharris@eVifweb.com, eVifweb@gmail.com.
#            URI :: https://crnrstn.jony5.com
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
#  CLASS :: crnrstn_soap_services_access_manager
#  VERSION :: 1.00.0000
#  DATE :: Friday, November 13, 2020 @ 1352 hrs.
#  AUTHOR :: Jonathan '5' Harris, jharris@eVifweb.com, eVifweb@gmail.com.
#  URI :: http://eVifweb.jony5.com
#  DESCRIPTION :: Manage SOAP handshake and alignment to and with
#                 CRNRSTN :: SOAP Services layer and determine
#                 authorization for access unto the same.
#  LICENSE :: MIT | https://crnrstn.jony5.com/licensing/
#
class crnrstn_soap_services_access_manager {

    private static $oCRNRSTN_ENV;

    protected $encryptCipher;
    protected $encryptSecretKey;
    protected $encryptOptions;
    protected $hmac_alg;
    public $CRNRSTN_NUSOAP_SVC_debugMode;
    public $ISACTIVE = false;

    protected $SOAP_oAuth_ARRAY = array();
    protected $SOAP_oClient_ARRAY = array();

    public $serial;

    public function __construct($env_key, $CRNRSTN_NUSOAP_SVC_debugMode, $oCRNRSTN_ENV){

        if($oCRNRSTN_ENV->hash($env_key) == $oCRNRSTN_ENV->return_env_key_hash()){

            self::$oCRNRSTN_ENV = $oCRNRSTN_ENV;
            $this->serial = self::$oCRNRSTN_ENV->generate_new_key(50);

            error_log(__LINE__ . ' ' . $env_key . ' crnrstn_soap_services_access_manager (env) construct() is DISABLED for ' . $this->serial . '.');

//            $this->ISACTIVE = true;
//
//            $this->CRNRSTN_NUSOAP_SVC_debugMode = $CRNRSTN_NUSOAP_SVC_debugMode;
//
//            self::$oCRNRSTN_ENV->update_SOAP_services_access_manager($this);

            $this->resource_key = '';

        }else{

            //error_log(__LINE__ . ' ' . __METHOD__ . ' $env_key is not match ...so construct end...' . $env_key);

        }

    }

    public function isAuthorized_oAuth($CRNRSTN_SOAP_SVC_AUTH_KEY, $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES){

        //
        // SUPPORT FOR OPEN PROXY
        $tmp_is_authorized = true;

        error_log(__LINE__ . ' env - checking oAuth [' . $CRNRSTN_SOAP_SVC_AUTH_KEY . '][' . $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES . ']');
        foreach($this->SOAP_oAuth_ARRAY as $serial => $SOAP_oAuth){

            $wildcard_honor = false;

            if(!isset($mandatory_match_fulfilled_flag)){

                $mandatory_match_fulfilled_flag = false;

            }

            if($SOAP_oAuth->ISACTIVE == true){

                //
                // NOT JUST IS VALID CHECK.
                // AGGREGATE ALL AUTH CHECKS HERE (LIST THEM), AND THEN, TRACE ALL DATA DEPENDENCIES...BRING THEM HERE.
                $tmp_return_soap_services_auth_key_ARRAY = $SOAP_oAuth->return_soap_services_auth_key_ARRAY();

                //self::$oCRNRSTN_ENV->print_r('AUTH KEY=' . print_r($tmp_return_soap_services_auth_key_ARRAY, true), 'CRNRSTN :: v' . $oCRNRSTN_USR->version_crnrstn() . ' SOAP AUTH :: ', __LINE__, __METHOD__, __FILE__);

                //$tmp_bit_state_nomination = 'CRNRSTN_SOAP_AUTH_MGR_' . $this->serial;
                //self::$oCRNRSTN_ENV->initialize_serialized_bit($tmp_bit_state_nomination, $integer_constant);

                //$tmp_return_soap_services_resource_denyaccess_ARRAY = $SOAP_oAuth->return_soap_services_resource_denyaccess_ARRAY();
                //$tmp_return_soap_services_resource_access_ARRAY = $SOAP_oAuth->return_soap_services_resource_access_ARRAY();

                //error_log(__LINE__ . ' SERVER env die() - [' . $serial . '] ::' . print_r($tmp_return_soap_services_auth_key_ARRAY, true));

                //$tmp_requested_resources_ARRAY = explode('|', $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES);

                if((in_array(CRNRSTN_RESOURCE_ALL, $tmp_return_soap_services_auth_key_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oAuth->serial])) || (in_array(CRNRSTN_RESOURCE_ALL, $tmp_return_soap_services_auth_key_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oAuth->serial]))){

                    //
                    // WILDCARD AUTH KEY PROVIDED. ANY AUTH KEY (INCLUDING NULL) IS ACCEPTABLE.
                    $wildcard_honor = true;

                }

                if(isset($tmp_return_soap_services_auth_key_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oAuth->serial])){

                    foreach($tmp_return_soap_services_auth_key_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oAuth->serial] as $key0 => $auth_key){

                        //error_log(__LINE__ . ' env - [' . $auth_key . ']==[' . $CRNRSTN_SOAP_SVC_AUTH_KEY . ']');
                        if($auth_key == $CRNRSTN_SOAP_SVC_AUTH_KEY || ($wildcard_honor == true)){
                            //
                            // WE HAVE CRNRSTN :: SOAP SERVICES LAYER oAuth OBJECT TO VERIFY THIS REQUEST AGAINST
                            //error_log(__LINE__ . ' SERVER env - soap_services_auth_key [' . $SOAP_oAuth->serial . '] VALIDATION GOING IN FOR ' . $auth_key);
                            $mandatory_match_fulfilled_flag = true;
//
//                            //
//                            // DENY ACCESS
//                            if(isset($tmp_return_soap_services_resource_denyaccess_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oAuth->serial])){
//
//                                //error_log(__LINE__ . ' SERVER env - we have tmp_return_soap_services_resource_denyaccess_ARRAY data[' . sizeof($tmp_return_soap_services_resource_denyaccess_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oAuth->serial]) . '].');
//                                foreach($tmp_return_soap_services_resource_denyaccess_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()] as $key1 => $SOAP_resource){
//
//                                    //error_log(__LINE__ . ' SERVER env - looking to honor denial of ' . $SOAP_resource . ', if requested.');
//
//                                    //
//                                    // IS THE CLIENT ASKING FOR RESOURCES WHICH ARE DENIED TO THIS AUTHORIZATION KEY?
//                                    if(in_array($SOAP_resource, $tmp_requested_resources_ARRAY)){
//
//                                        error_log(__LINE__ . ' SERVER env - ACCESS DENIED ON ACCOUNT OF THE ' . $SOAP_resource . ' CRNRSTN :: SOAP SERVICES RESOURCE THAT IS REQUESTED...NOTE THAT ' . $SOAP_resource . ' HAS ALSO BEEN CONFIGURED AT THIS PROXY PROFILE TO BE DENIED TO THIS AUTH KEY.');
//                                        $tmp_is_authorized = false;
//
//                                    }
//
//                                }
//
//                            }

                            //if($tmp_is_authorized){

                            $tmp_SOAP_resource = true;

                            //$tmp_bit_state_nomination = 'CRNRSTN_SOAP_AUTH_MGR_' . $this->serial;
                            //self::$oCRNRSTN_ENV->initialize_serialized_bit($tmp_bit_state_nomination, $integer_constant);

                            //error_log(__LINE__ . ' ' . __METHOD__ . ' ' . self::$oCRNRSTN_ENV->print_r_str('hello 0101010010101!', 'BIT DRIVEN CLIENT AUTH :: isAuthorized_oAuth()', NULL, __LINE__, __METHOD__, __FILE__));
                            //die();

                            //
                            // CHECK FOR FLIPPED BITS
                            $tmp_bit_state_nomination = 'CRNRSTN_SOAP_AUTH_MGR_' . $SOAP_oAuth->serial;
                            $tmp_soap_auth_resource_ARRAY = self::$oCRNRSTN_ENV->return_set_serialized_bits($tmp_bit_state_nomination, self::$oCRNRSTN_ENV->system_resource_constants_ARRAY());

//                          error_log(__LINE__ . ' env '. print_r($tmp_soap_auth_resource_ARRAY, true));
//                          die();

                            if(isset($tmp_return_soap_services_resource_access_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oAuth->serial])){

                                // $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES is the new $tmp_requested_resources_ARRAY.
                                // HOW MANY CONSTANTS YOU HOLDING??
                                $tmp_requested_resources_ARRAY = $tmp_return_soap_services_resource_access_ARRAY = array();
                                foreach($tmp_requested_resources_ARRAY as $key2 => $resource_req){

                                    error_log(__LINE__ . ' env - $resource_req=' . $resource_req);
                                    $tmp_SOAP_resource = false;

                                    foreach($tmp_return_soap_services_resource_access_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oAuth->serial] as $key1 => $SOAP_resource){
                                        error_log(__LINE__ . ' env - $SOAP_resource=' . print_r($SOAP_resource, true));

                                        if($SOAP_resource == $resource_req){

                                            error_log(__LINE__ . ' SERVER env - soap_services_auth_key GRANT RESOURCE ACCESS = TRUE for ' . $SOAP_resource);
                                            $tmp_SOAP_resource = true;

                                        }

                                    }

                                    //
                                    // ALL REQUESTED RESOURCES MUST BE LISTED AS AUTHORIZED FOR THIS AUTHORIZATION KEY.
                                    if(!($tmp_SOAP_resource == true)){

                                        error_log(__LINE__ .' SERVER env - ACCESS DENIED ON ACCOUNT OF RESOURCE REQUESTED NOT BEING FOUND WITHIN THE PROXY PROFILE CONFIGURATION FOR THIS AUTH KEY.');
                                        $tmp_is_authorized = false;

                                    }

                                }

                            }

                            //}

                        }

                    }

                }

                if($tmp_is_authorized == true){

                    $tmp_return_soap_services_IP_denyaccess_ARRAY = $SOAP_oAuth->return_soap_services_IP_denyaccess_ARRAY();

                    //
                    // CHECK IP ACCESS - DENY
                    if(isset($tmp_return_soap_services_IP_denyaccess_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oAuth->serial])){

                        foreach($tmp_return_soap_services_IP_denyaccess_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oAuth->serial] as $key1 => $ip){

                            error_log(__LINE__ . ' SERVER env - checking denyIPAccess() on ' . $ip);
                            if(self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->denyIPAccess($ip) == true){

                                error_log(__LINE__ . ' SERVER env - BY IP...YOU ARE TO BE DENIED...' . self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->clientIpAddress());
                                $tmp_is_authorized = false;

                            }

                        }

                    }

                }

                if($tmp_is_authorized == true){

                    $tmp_return_soap_services_IP_access_ARRAY = $SOAP_oAuth->return_soap_services_IP_access_ARRAY();

                    //
                    // CHECK IP ACCESS - EXCLUSIVE ACCESS
                    if(isset($tmp_return_soap_services_IP_access_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oAuth->serial])){

                        foreach($tmp_return_soap_services_IP_access_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oAuth->serial] as $key => $ip){

                            //if(is_array($ip)){

                            //    self::$oCRNRSTN_ENV->print_r($ip, '', NULL, __LINE__, __METHOD__, __FILE__);
                            //    error_log(__LINE__ . ' SERVER env - die()::[' . $key . '] ' . print_r($ip, true));
                            //    die();

                            //}

                            //error_log(__LINE__ . ' SERVER env checking exclusiveAccess() on ' . $ip);
                            if(self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->exclusiveAccess($ip) == true){

                                //error_log(__LINE__ . ' SERVER env - BY IP...YOU ARE TO BE GRANTED ACCESS...' . self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->clientIpAddress());

                            }else{

                                error_log(__LINE__ . ' SERVER env - BY IP...YOU ARE TO BE DENIED...' . self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->clientIpAddress());
                                $tmp_is_authorized = false;

                            }

                        }

                    }

                }

            }

        }

        if(($tmp_is_authorized == true) && isset($mandatory_match_fulfilled_flag)){

            if(!$mandatory_match_fulfilled_flag == true){

                error_log(__LINE__ . ' SERVER env - THIS IS NOT AN OPEN PROXY. ACCESS DENIED ON ACCOUNT OF AT LEAST ONE AUTH KEY BEING CONFIGURED AT PROXY, BUT NO SUBSEQUENT MANDATORY MATCH WAS FULFILLED BY THE CLIENT.');
                $tmp_is_authorized = false;

            }

        }

        error_log(__LINE__ . ' SERVER env - returning oAuth validation result of [' . $tmp_is_authorized . '].');
        return $tmp_is_authorized;

    }

    public function isAuthorized_oClient($USERNAME, $PASSWORD, $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES, $CRNRSTN_SOAP_SVC_METHOD_REQUESTED, $CRNRSTN_SOAP_ACTION_TYPE){

        //
        // SUPPORT FOR OPEN PROXY
        $tmp_is_authorized = true;

        error_log(__LINE__ . ' SERVER env - checking oClient [' . $USERNAME . '][' . $PASSWORD . '][' . $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES . '][' . $CRNRSTN_SOAP_SVC_METHOD_REQUESTED . '][' . $CRNRSTN_SOAP_ACTION_TYPE . ']');

        //
        // CONVERT STRING BACK INTO BITWISE
        self::$oCRNRSTN_ENV->serialized_bit_stringin('CRNRSTN_CLIENT_SOAP_PERMS_REQUESTED', $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES);

        if(self::$oCRNRSTN_ENV->is_serialized_bit_set('CRNRSTN_CLIENT_SOAP_PERMS_REQUESTED', CRNRSTN_RESOURCE_OPENSOURCE) == true){

            error_log(__LINE__ . ' SERVER env - serialized_bit_stringin SET CRNRSTN_RESOURCE_OPENSOURCE=TRUE');


        }else{

            error_log(__LINE__ . ' SERVER env - serialized_bit_stringin DID NOT SET CRNRSTN_RESOURCE_OPENSOURCE');

        }

        foreach($this->SOAP_oClient_ARRAY as $serial => $SOAP_oClient){

            if(!isset($mandatory_match_fulfilled_flag)){

                $mandatory_match_fulfilled_flag = false;

            }

            if($SOAP_oClient->ISACTIVE == true){

                //
                // NOT JUST IS VALID CHECK.
                // AGGREGATE ALL AUTH CHECKS HERE (LIST THEM), AND THEN, TRACE ALL DATA DEPENDENCIES...BRING THEM HERE.
                $tmp_return_soap_services_username_ARRAY = $SOAP_oClient->return_soap_services_username_ARRAY();
                $tmp_return_soap_services_password_ARRAY = $SOAP_oClient->return_soap_services_password_ARRAY();
                $tmp_return_soap_services_resource_denyaccess_ARRAY = $SOAP_oClient->return_soap_services_resource_denyaccess_ARRAY();
                $tmp_return_soap_services_resource_access_ARRAY = $SOAP_oClient->return_soap_services_resource_access_ARRAY();
                $tmp_return_soap_services_method_activate_ARRAY = $SOAP_oClient->return_soap_services_method_activate_ARRAY();
                $tmp_return_soap_services_method_deactivate_ARRAY = $SOAP_oClient->return_soap_services_method_deactivate_ARRAY();

                $tmp_requested_resources_ARRAY = explode('|', $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES);

                if(isset($tmp_return_soap_services_username_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial])){

                    foreach($tmp_return_soap_services_username_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial] as $key0 => $username){

                        self::$oCRNRSTN_ENV->print_r('[' . $username . '][' . $USERNAME . ']', 'SERVER (env) :: isAuthorized_oClient', NULL, __LINE__, __METHOD__, __FILE__);
                        if($username == $USERNAME){

                            if(self::$oCRNRSTN_ENV->validate_pwd_hash_login($tmp_return_soap_services_password_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial][$key0], $PASSWORD) == true){

                                error_log(__LINE__ . ' SERVER env - CRNRSTN :: SOAP SERVICES CLIENT LOGIN VALID. [' . $USERNAME . '][' . $PASSWORD . '][' . $tmp_return_soap_services_password_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial][$key0] . ']');

                            }else{

                                error_log(__LINE__ . ' SERVER env - CRNRSTN :: SOAP SERVICES CLIENT LOGIN INVALID. [' . $USERNAME . '][' . $PASSWORD . '][' . $tmp_return_soap_services_password_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial][$key0] . ']');

                            }

                            //
                            // WE HAVE CRNRSTN :: SOAP SERVICES LAYER oAuth OBJECT TO VERIFY THIS REQUEST AGAINST
                            error_log(__LINE__ . ' SERVER env - isAuthorized_oClient [' . $SOAP_oClient->serial . '] VALIDATION GOING IN FOR ' . $username);
                            $mandatory_match_fulfilled_flag = true;

                            //
                            // DENY ACCESS
                            if(isset($tmp_return_soap_services_resource_denyaccess_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial])){

                                error_log(__LINE__ . ' SERVER env - we have tmp_return_soap_services_resource_denyaccess_ARRAY data[' . sizeof($tmp_return_soap_services_resource_denyaccess_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial]) . '].');
                                foreach($tmp_return_soap_services_resource_denyaccess_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()] as $key1 => $SOAP_resource){

                                    error_log(__LINE__ . ' SERVER env - looking to honor denial of ' . $SOAP_resource . ', if requested.');

                                    //
                                    // IS THE CLIENT ASKING FOR RESOURCES WHICH ARE DENIED TO THIS AUTHORIZATION KEY?
                                    if(in_array($SOAP_resource, $tmp_requested_resources_ARRAY)){

                                        error_log(__LINE__ . ' SERVER env - ACCESS DENIED ON ACCOUNT OF THE ' . $SOAP_resource . ' CRNRSTN :: SOAP SERVICES RESOURCE THAT IS REQUESTED...NOTE THAT ' . $SOAP_resource . ' HAS ALSO BEEN CONFIGURED AT THIS PROXY PROFILE TO BE DENIED TO THIS CLIENT.');
                                        $tmp_is_authorized = false;

                                    }

                                }

                            }

                            if($tmp_is_authorized == true){

                                $tmp_SOAP_resource = true;

                                if(isset($tmp_return_soap_services_resource_access_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial])){

                                    foreach($tmp_requested_resources_ARRAY as $key2 => $resource_req){

                                        error_log(__LINE__ . ' env make false[' . $resource_req . ']');
                                        $tmp_SOAP_resource = false;

                                        foreach($tmp_return_soap_services_resource_access_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial] as $key1 => $SOAP_resource){

                                            error_log(__LINE__ . ' env make true if[' . $resource_req . ']==[' . $SOAP_resource . ']');

                                            if($SOAP_resource == $resource_req){

                                                error_log(__LINE__ . ' env - soap_services_auth_key GRANT RESOURCE ACCESS = TRUE for ' . $SOAP_resource);
                                                $tmp_SOAP_resource = true;

                                            }

                                        }

                                        //
                                        // ALL REQUESTED RESOURCES MUST BE LISTED AS AUTHORIZED FOR THIS AUTHORIZATION KEY.
                                        if(!($tmp_SOAP_resource == true)){

                                            error_log(__LINE__ . ' SERVER env - ACCESS DENIED ON ACCOUNT OF RESOURCE REQUESTED NOT BEING FOUND WITHIN THE PROXY PROFILE CONFIGURATION FOR THIS CLIENT.');
                                            $tmp_is_authorized = false;

                                        }

                                    }

                                }else{

                                    error_log(__LINE__ . ' SERVER env - NEW ARRAY STRUCT...NOT SEEING.');

                                }

                            }

                            //
                            // CRNRSTN :: SOAP SERVICES LAYER METHOD AUTHORIZATION
                            if($tmp_is_authorized == true){

                                $tmp_SOAP_resource = true;

                                if(isset($tmp_return_soap_services_method_activate_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial])){

                                    if(sizeof($tmp_return_soap_services_method_activate_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial]) > 0){

                                        $tmp_req_methods_ARRAY = explode('|', $CRNRSTN_SOAP_SVC_METHOD_REQUESTED);

                                        foreach($tmp_req_methods_ARRAY as $key2 => $method_req){
                                            error_log(__LINE__ . ' env make false [' . $method_req . ']');

                                            $tmp_SOAP_resource = false;

                                            foreach($tmp_return_soap_services_method_activate_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial] as $key1 => $SOAP_resource){
                                                error_log(__LINE__ . ' env make true if[' . $method_req . ']==[' . $SOAP_resource . ']');

                                                if($SOAP_resource == $method_req){

                                                    //error_log(__LINE__ . ' env - soap_services_auth_key GRANT RESOURCE ACCESS = TRUE for ' . $SOAP_resource);
                                                    $tmp_SOAP_resource = true;

                                                }

                                            }

                                            //
                                            // ALL REQUESTED RESOURCES MUST BE LISTED AS AUTHORIZED FOR THIS AUTHORIZATION KEY.
                                            if(!$tmp_SOAP_resource == true){

                                                error_log(__LINE__ . ' SERVER env - ACCESS DENIED ON ACCOUNT OF A REQUESTED METHOD NOT BEING FOUND WITHIN THE PROXY PROFILE CONFIGURATION FOR THIS CLIENT.');
                                                $tmp_is_authorized = false;

                                            }

                                        }

                                    }

                                }else{

                                    error_log(__LINE__ . ' SERVER env - NEW ARRAY STRUCT...NOT SEEING.');

                                }

                            }

                            //
                            // CRNRSTN :: SOAP SERVICES LAYER METHOD AUTHORIZATION
                            if($tmp_is_authorized == true){

                                $tmp_SOAP_resource = true;

                                if(isset($tmp_return_soap_services_method_deactivate_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial])){

                                    if(sizeof($tmp_return_soap_services_method_deactivate_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial]) > 0){

                                        $tmp_req_methods_ARRAY = explode('|', $CRNRSTN_SOAP_SVC_METHOD_REQUESTED);

                                        foreach($tmp_req_methods_ARRAY as $key2 => $method_req){

                                            $tmp_SOAP_resource = false;

                                            foreach($tmp_return_soap_services_method_deactivate_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial] as $key1 => $SOAP_resource){

                                                if($SOAP_resource == $method_req){

                                                    $tmp_SOAP_resource = true;

                                                }

                                            }

                                            //
                                            // ALL REQUESTED RESOURCES MUST BE LISTED AS AUTHORIZED FOR THIS AUTHORIZATION KEY.
                                            if(!$tmp_SOAP_resource == true){

                                                error_log(__LINE__ . ' SERVER env - ACCESS DENIED ON ACCOUNT OF A REQUESTED METHOD NOT BEING FOUND WITHIN THE PROXY PROFILE CONFIGURATION FOR THIS CLIENT.');
                                                $tmp_is_authorized = false;

                                            }

                                        }

                                    }

                                }else{

                                    error_log(__LINE__ . ' SERVER env - NEW ARRAY STRUCT...NOT SEEING.');

                                }

                            }

                        }

                    }

                }

                if($tmp_is_authorized == true){

                    $tmp_return_soap_services_IP_denyaccess_ARRAY = $SOAP_oClient->return_soap_services_IP_denyaccess_ARRAY();

                    //
                    // CHECK IP ACCESS - DENY
                    if(isset($tmp_return_soap_services_IP_denyaccess_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial])){

                        foreach($tmp_return_soap_services_IP_denyaccess_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial] as $key => $ip){

                            error_log(__LINE__ . ' SERVER env checking denyIPAccess() on ' . $ip);
                            if(self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->denyIPAccess($ip) == true){

                                error_log(__LINE__ . ' SERVER env - BY IP...YOU ARE TO BE DENIED...' . self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->clientIpAddress());
                                $tmp_is_authorized = false;

                            }

                        }

                    }

                }

                if($tmp_is_authorized == true){

                    $tmp_return_soap_services_IP_access_ARRAY = $SOAP_oClient->return_soap_services_IP_access_ARRAY();

                    //
                    // CHECK IP ACCESS - EXCLUSIVE ACCESS
                    if(isset($tmp_return_soap_services_IP_access_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial])){

                        foreach($tmp_return_soap_services_IP_access_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][self::$oCRNRSTN_ENV->return_env_key_hash()][$SOAP_oClient->serial] as $key => $ip){

                            //error_log(__LINE__ . ' SERVER env checking exclusiveAccess() on ' . $ip);
                            if(self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->exclusiveAccess($ip) == true){

                                //error_log(__LINE__ . ' SERVER env - BY IP...YOU ARE TO BE GRANTED ACCESS...' . self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->clientIpAddress());

                            }else{

                                error_log(__LINE__ . ' SERVER env - BY IP...YOU ARE TO BE DENIED...' . self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->clientIpAddress());
                                $tmp_is_authorized = false;

                            }

                        }

                    }

                }

            }else{

                //error_log(__LINE__ . ' SERVER env - $SOAP_oClient is NOT ACTIVE.');

            }

        }

        if(($tmp_is_authorized == true) && isset($mandatory_match_fulfilled_flag)){

            if(!$mandatory_match_fulfilled_flag){

                error_log(__LINE__ . ' SERVER env - THIS IS NOT AN OPEN PROXY. ACCESS DENIED ON ACCOUNT OF AT LEAST ONE AUTH KEY BEING CONFIGURED AT PROXY, BUT NO SUBSEQUENT MANDATORY MATCH WAS FULFILLED BY THE CLIENT.');
                $tmp_is_authorized = false;

            }

        }

        return $tmp_is_authorized;

    }

    public function return_soap_encryption_config_param($param_key){

        switch($param_key){
            case 'SOAP_ENCRYPT_CIPHER':

                return $this->encryptCipher;

            break;
            case 'SOAP_ENCRYPT_SECRET_KEY':

                return $this->encryptSecretKey;

            break;
            case 'SOAP_ENCRYPT_HMAC_ALG':

                return $this->hmac_alg;

            break;
            case 'SOAP_ENCRYPT_OPTIONS':

                return $this->encryptOptions;

            break;
            default:

                return false;

            break;

        }

    }

    public function init_soap_encryption_config($env_key, $encryptCipher, $encryptSecretKey, $hmac_alg, $encryptOptions){

        $encryptSecretKey = self::$oCRNRSTN_ENV->hash($encryptSecretKey, 'md5');

        if($this->ISACTIVE == true){

            //error_log(__LINE__ . ' env $env_key [' . $env_key . '] ACTIVE.');

            $this->encryptCipher = $encryptCipher;
            $this->encryptSecretKey = $encryptSecretKey;
            $this->hmac_alg = $hmac_alg;
            $this->encryptOptions = $encryptOptions;

            self::$oCRNRSTN_ENV->update_SOAP_services_access_manager($this);

        }else{

            //error_log(__LINE__ . ' env $env_key [' . $env_key . '] NOT ACTIVE.');

        }

    }

    public function generate_SOAPAuthKey($env_key, $SOAP_AuthKey = CRNRSTN_RESOURCE_ALL){

        if($this->ISACTIVE == true){

            $SOAP_oAuth = new crnrstn_soap_services_authorization_manager($env_key, $SOAP_AuthKey, self::$oCRNRSTN_ENV);

            $this->SOAP_oAuth_ARRAY[$SOAP_oAuth->serial] = $SOAP_oAuth;

            self::$oCRNRSTN_ENV->update_SOAP_services_access_manager($this);

            return $SOAP_oAuth;

        }else{

            $SOAP_oAuth_NULL = new crnrstn_soap_services_authorization_manager('AUTH::NULL', $SOAP_AuthKey, self::$oCRNRSTN_ENV);

            return $SOAP_oAuth_NULL;

        }

    }

    public function generate_SOAPAuthKeyInGroup($env_key, $SOAP_AuthKey = CRNRSTN_RESOURCE_ALL, $SOAP_oAuth = NULL){

        if($this->ISACTIVE == true){

            if(isset($SOAP_oAuth)){

                $tmp_SOAP_oAuth = new crnrstn_soap_services_authorization_manager($env_key, $SOAP_AuthKey, self::$oCRNRSTN_ENV);

                $tmp_SOAP_oAuth->sync_to_services_authorization_group_key($SOAP_oAuth->services_authorization_group_key);

                $this->SOAP_oAuth_ARRAY[$tmp_SOAP_oAuth->serial] = $tmp_SOAP_oAuth;
                //error_log(__LINE__ . ' SERVER env - gkey[' . $SOAP_oAuth->services_authorization_group_key . '][' . $tmp_SOAP_oAuth->serial . '] $SOAP_AuthKey=' . $SOAP_AuthKey);

                self::$oCRNRSTN_ENV->update_SOAP_services_access_manager($this);

                return $tmp_SOAP_oAuth;

            }else{

                $SOAP_oAuth = new crnrstn_soap_services_authorization_manager($env_key, $SOAP_AuthKey, self::$oCRNRSTN_ENV);

                $SOAP_oAuth->init_services_authorization_group_key();

                $this->SOAP_oAuth_ARRAY[$SOAP_oAuth->serial] = $SOAP_oAuth;
                //error_log(__LINE__ . ' SERVER env - origin gkey[' . $SOAP_oAuth->services_authorization_group_key . '][' . $SOAP_oAuth->serial . '] $SOAP_AuthKey=' . $SOAP_AuthKey);

                self::$oCRNRSTN_ENV->update_SOAP_services_access_manager($this);

                return $SOAP_oAuth;

            }

        }

    }

    public function addClient($env_key, $username, $password, $CRNRSTN_NUSOAP_SVC_debugMode = 0){

        if($this->ISACTIVE == true){

            $SOAP_oClient = new crnrstn_soap_services_client_manager($env_key, $username, $password, $CRNRSTN_NUSOAP_SVC_debugMode, self::$oCRNRSTN_ENV);

            $this->SOAP_oClient_ARRAY[$SOAP_oClient->serial] = $SOAP_oClient;

            self::$oCRNRSTN_ENV->update_SOAP_services_access_manager($this);

            return $SOAP_oClient;

        }else{

            $SOAP_oClient_NULL = new crnrstn_soap_services_client_manager('AUTH::NULL', $username, $password, $CRNRSTN_NUSOAP_SVC_debugMode, self::$oCRNRSTN_ENV);

            return $SOAP_oClient_NULL;

        }

    }

    public function addClientToGroup($env_key, $username, $password, $SOAP_oClient = NULL, $CRNRSTN_NUSOAP_SVC_debugMode = false){

        if($this->ISACTIVE == true){

            if(isset($SOAP_oClient)){

                $tmp_SOAP_oClient = new crnrstn_soap_services_client_manager($env_key, $username, $password, $CRNRSTN_NUSOAP_SVC_debugMode, self::$oCRNRSTN_ENV);

                $tmp_SOAP_oClient->sync_to_services_client_group($SOAP_oClient->services_client_group_key);

                $this->SOAP_oClient_ARRAY[$tmp_SOAP_oClient->serial] = $tmp_SOAP_oClient;

                self::$oCRNRSTN_ENV->update_SOAP_services_access_manager($this);

                return $tmp_SOAP_oClient;

            }else{

                $SOAP_oClient = new crnrstn_soap_services_client_manager($env_key, $username, $password, $CRNRSTN_NUSOAP_SVC_debugMode, self::$oCRNRSTN_ENV);

                $SOAP_oClient->init_services_client_group();

                $this->SOAP_oClient_ARRAY[$SOAP_oClient->serial] = $SOAP_oClient;

                self::$oCRNRSTN_ENV->update_SOAP_services_access_manager($this);

                return $SOAP_oClient;

            }

        }

    }

    public function __destruct(){

    }

}