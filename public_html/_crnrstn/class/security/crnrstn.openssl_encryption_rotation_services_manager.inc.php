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
# # C # R # N # R # S # T # N # : : # # # #
#
#  CLASS :: crnrstn_openssl_encryption_rotation_services_manager
#  VERSION :: 1.00.0000
#  DATE :: June 3, 2022 @ 1500hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: Support cookie, session, database and tunnel encryption
#                 layer profiles.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_openssl_encryption_rotation_services_manager {

    protected $oLogger;
    public $oCRNRSTN;

    /*
    self::$openssl_digests_include_aliases = true;
    self::$openssl_digests = openssl_get_md_methods(self::$openssl_digests_include_aliases);

    // $secret_key = openssl_digest($secret_key, $digests[n], true)
    */

    public function __construct($oCRNRSTN){

        $this->oCRNRSTN = $oCRNRSTN;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN);

        //$this->oCRNRSTN->error_log('[' . __CLASS__ . '] READY TO WORK 4 U.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

    }

    public function config_load_static_application_data($data_type){
        // Monday, November 20, 2023 @ 0505 hrs.

        switch($data_type){
            case 'system_hmac_algorithm_preferred_ARRAY':

                return array('sha256' => 'sha256', 'sha224' => 'sha224', 'sha384' => 'sha384', 'sha512' => 'sha512',
                'sha512-224' => 'sha512-224', 'sha512-256' => 'sha512-256', 'RSA-SHA224' => 'RSA-SHA224',
                'RSA-SHA256' => 'RSA-SHA256', 'RSA-SHA384' => 'RSA-SHA384', 'RSA-SHA512' => 'RSA-SHA512',
                'RSA-SHA512/224' => 'RSA-SHA512/224', 'RSA-SHA512/256' => 'RSA-SHA512/256', 'md5' => 'md5',
                'sha1' => 'sha1', 'RSA-MD5' => 'RSA-MD5', 'RSA-SHA1' => 'RSA-SHA1', 'ripemd256' => 'ripemd256',
                'gost' => 'gost', 'snefru256' => 'snefru256', 'ripemd128' => 'ripemd128', 'tiger128,4' => 'tiger128,4');

            break;
            case 'system_openssl_cipher_preferred_ARRAY':

                return array('aes-256-ofb' => 'aes-256-ofb', 'aes-256-ccm' => 'aes-256-ccm', 'aes-192-ocb' => 'aes-192-ocb',
                'aes-128-ocb' => 'aes-128-ocb', 'aes-128-ctr' => 'aes-128-ctr', 'aes-192-ccm' => 'aes-192-ccm',
                'aes-256-xts' => 'aes-256-xts', 'aria-256-cfb' => 'aria-256-cfb', 'aria-256-ofb' => 'aria-256-ofb',
                'camellia-256-cbc' => 'camellia-256-cbc', 'camellia-192-cfb' => 'camellia-192-cfb',
                'cast5-cbc' => 'cast5-cbc', 'aria256' => 'aria256', 'blowfish' => 'blowfish',
                'camellia256' => 'camellia256', 'camellia192' => 'camellia192');

            break;
            case 'system_openssl_digest_preferred_ARRAY':

                return array('sha512' => 'sha512', 'sha512-256' => 'sha512-256',
                'sha3-256' => 'sha3-256', 'rsa-sha256' => 'rsa-sha256', 'sha256' => 'sha256', 'rsa-sha512' => 'rsa-sha512');

            break;
            default:

                error_log(__LINE__ . ' env Unknown SWITCH CASE received. ['. strval($data_type) . '].');

            break;

        }

    }

    public function _____xxxxxxxx(){

        try{

            //
            // HOOOSTON...VE HAF PROBLEM!
            throw new Exception('This is the exception.');

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE.
            // TODO :: WILL BE REAL NICE WHEN THIS RETURN SUPPORTS SOAP FORMAT...SHOULD SOAP BE THE STANDARD?
            // SOAP WOULD BE THE STANDARD IF CRNRSTN :: WAS MORE LIKE, $oCRNRSTN = new nusoap_base();
            // $this->exception_return($channel, $msg,....);
            return false;

        }

    }

    public function __destruct(){

    }

}