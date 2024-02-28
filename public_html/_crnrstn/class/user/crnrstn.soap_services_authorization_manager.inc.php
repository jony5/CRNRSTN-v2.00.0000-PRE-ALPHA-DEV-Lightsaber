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
#  CLASS :: crnrstn_soap_services_authorization_manager
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: Thursday November 12, 2020 @ 1645hrs
#  DESCRIPTION :: Manage CRNRSTN :: SOAP Services layer
#                 authorization keys.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_soap_services_authorization_manager {

    private static $oCRNRSTN_ENV;

    public $serial;
    public $services_authorization_group_key;
    public $ISACTIVE = false;
    protected $resource_key;

    protected $ip_auth_denial_ARRAY = array();
    protected $ip_auth_ARRAY = array();

    protected $soap_services_auth_key_ARRAY = array();
    protected $soap_services_resource_denyaccess_ARRAY = array();
    protected $soap_services_resource_access_ARRAY = array();

    protected $encryptCipher;
    protected $encryptSecretKey;
    protected $encryptOptions;
    protected $hmac_alg;

    public function __construct($env_key, $SOAP_AuthKey, $oCRNRSTN_ENV){

        self::$oCRNRSTN_ENV = $oCRNRSTN_ENV;

        $this->serial = self::$oCRNRSTN_ENV->generate_new_key(50);

        $tmp_resource_key = self::$oCRNRSTN_ENV->return_env_key_hash();

        if(self::$oCRNRSTN_ENV->hash($env_key) == $tmp_resource_key){

            $this->resource_key = $tmp_resource_key;
            $this->ISACTIVE = true;

            $this->soap_services_auth_key_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $SOAP_AuthKey;

            self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);

        }

    }

    public function return_soap_services_IP_access_ARRAY(){

        return $this->ip_auth_ARRAY;

    }

    public function return_soap_services_IP_denyaccess_ARRAY(){

        return $this->ip_auth_denial_ARRAY;

    }

    public function return_soap_services_auth_key_ARRAY(){

        return $this->soap_services_auth_key_ARRAY;

    }

    public function return_soap_services_resource_denyaccess_ARRAY(){

        return $this->soap_services_resource_denyaccess_ARRAY;

    }

    public function return_soap_services_resource_access_ARRAY(){

        return $this->soap_services_resource_access_ARRAY;

    }

    public function sync_IP_denyAccess($ip){

        $this->ip_auth_denial_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $ip;

        self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);

    }

    public function sync_IP_exclusiveAccess($ip){

        $this->ip_auth_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $ip;

        self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);

    }

    public function sync_update_permissions($integer_constant){

//        foreach($soap_services_resource_access_ARRAY as $key => $resource){
//
//            $this->soap_services_resource_access_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $resource;
//
//        }
//
//        foreach($soap_services_resource_denyaccess_ARRAY as $key => $resource){
//
//            $this->soap_services_resource_denyaccess_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $resource;
//
//        }

        $tmp_bit_state_nomination = 'CRNRSTN_SOAP_AUTH_MGR_' . $this->serial;
        self::$oCRNRSTN_ENV->initialize_serialized_bit($tmp_bit_state_nomination, $integer_constant);

        self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);

    }

    public function sync_soap_encryption_config($encryptCipher, $encryptSecretKey, $hmac_alg, $encryptOptions){

        $this->encryptCipher = $encryptCipher;
        $this->encryptSecretKey = $encryptSecretKey;
        $this->hmac_alg = $hmac_alg;
        $this->encryptOptions = $encryptOptions;

    }

    //
    // SOAP SERVICE $authorized_resource_pipe
    public function update_permissions($integer_constant){

        if($this->ISACTIVE === true){

            //$this->oCRNRSTN_BITWISE->set($integer_constant);
            //$this->oCRNRSTN_BITWISE->toggle($integer_constant);
            //$this->oCRNRSTN_BITWISE->read($integer_constant);
            //$this->oCRNRSTN_BITWISE->remove($integer_constant)
            //$this->oCRNRSTN_BITWISE->stringout()
            //self::$oCRNRSTN_ENV->set($integer_constant, true);

            // REMOVE WHEN DONE
//          $this->soap_services_resource_denyaccess_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $tmp_clean_profile;
//          $this->soap_services_resource_access_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = trim($tmp_resource_access_profile_ARRAY[$i]);

//
//            $tmp_resource_access_profile_ARRAY = explode('|', $authorized_resource_pipe);
//            $tmp_cnt = sizeof($tmp_resource_access_profile_ARRAY);
//            $tmp_accept_array = array();
//            $tmp_deny_array = array();
//
//            for ($i = 0; $i < $tmp_cnt; $i++){
//
//                //
//                // CHECK FOR NOT
//                $pos_silo_tilde = strpos($tmp_resource_access_profile_ARRAY[$i], '~');
//
//                if($pos_silo_tilde !== false){
//
//                    //
//                    // HONOR THE NEGATION
//                    // STRIP ~ AND TRIM
//                    $tmp_clean_silo_negation = self::$oCRNRSTN_ENV->proper_replace('~', '', $tmp_resource_access_profile_ARRAY[$i]);
//                    $tmp_clean_profile = trim($tmp_clean_silo_negation);
//
//                    error_log(__LINE__ . ' env - negation of resource ' . $tmp_clean_profile . ' added [' . self::$oCRNRSTN_ENV->config_serial_hash . '][' . $this->resource_key . '][' . $this->serial . '].');
//
//                }else{
//
//                    $this->soap_services_resource_access_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = trim($tmp_resource_access_profile_ARRAY[$i]);
//
//                }
//
//                if(isset($this->services_authorization_group_key)){
//
//                    if($pos_silo_tilde !== false){
//
//                        //
//                        // HONOR THE NEGATION
//                        // STRIP ~ AND TRIM
//                        $tmp_clean_silo_negation = self::$oCRNRSTN_ENV->proper_replace('~', '', $tmp_resource_access_profile_ARRAY[$i]);
//                        $tmp_clean_profile = trim($tmp_clean_silo_negation);
//                        $tmp_deny_array[] = $tmp_clean_profile;
//
//                        error_log(__LINE__ . ' env - negation of resource ' . $tmp_clean_profile . ' added [' . self::$oCRNRSTN_ENV->config_serial_hash . '][' . $this->resource_key . '][' . $this->serial . '].');
//
//                    }else{
//
//                        $tmp_accept_array[] = trim($tmp_resource_access_profile_ARRAY[$i]);
//
//                    }
//
//                }
//
//            }

            if(isset($this->services_authorization_group_key)){

                $tmp_bit_state_nomination = 'CRNRSTN_SOAP_AUTH_MGR_' . $this->serial;
                self::$oCRNRSTN_ENV->initialize_serialized_bit($tmp_bit_state_nomination, $integer_constant);

                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);
                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth_update_permissions($this->serial, $this->services_authorization_group_key, $integer_constant);

            }else{

                $tmp_bit_state_nomination = 'CRNRSTN_SOAP_AUTH_MGR_' . $this->serial;
                self::$oCRNRSTN_ENV->initialize_serialized_bit($tmp_bit_state_nomination, $integer_constant);

                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);

            }

        }

    }

    public function override_soap_encryption_config($encryptCipher, $encryptSecretKey, $hmac_alg, $encryptOptions){

        if($this->ISACTIVE === true){

            $this->encryptCipher = $encryptCipher;
            $this->encryptSecretKey = $encryptSecretKey;
            $this->hmac_alg = $hmac_alg;
            $this->encryptOptions = $encryptOptions;

            if(isset($this->services_authorization_group_key)){

                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);
                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth_soap_encryption_config($this->serial, $this->services_authorization_group_key, $this->encryptCipher, $this->encryptSecretKey, $this->hmac_alg, $this->encryptOptions);

            }else{

                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);

            }

        }

    }

    public function IP_exclusiveAccess($ip){

        if($this->ISACTIVE === true){

            $this->ip_auth_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $ip;

            if(isset($this->services_authorization_group_key)){

                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);
                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth_IP_exclusiveAccess($this->serial, $this->services_authorization_group_key, $ip);

            }else{

                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);

            }

        }

    }

    public function IP_denyAccess($ip){

        if($this->ISACTIVE === true){

            $this->ip_auth_denial_ARRAY[self::$oCRNRSTN_ENV->config_serial_hash][$this->resource_key][$this->serial][] = $ip;

            if(isset($this->services_authorization_group_key)){

                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);
                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth_IP_denyAccess($this->serial, $this->services_authorization_group_key, $this->ip_auth_denial_ARRAY);

            }else{

                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);

            }

        }

    }

    public function init_services_authorization_group_key(){

        if($this->ISACTIVE === true){

            $this->services_authorization_group_key = self::$oCRNRSTN_ENV->generate_new_key(50);

        }

    }

    public function sync_to_services_authorization_group_key($services_authorization_group_key){

        if($this->ISACTIVE === true){

            $this->services_authorization_group_key = $services_authorization_group_key;

        }

    }

    public function __destruct(){

    }

}