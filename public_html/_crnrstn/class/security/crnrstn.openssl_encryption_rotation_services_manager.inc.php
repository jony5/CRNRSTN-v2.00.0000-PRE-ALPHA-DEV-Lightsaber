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

    public $oCRNRSTN;

    /*
    self::$openssl_digests_include_aliases = true;
    self::$openssl_digests = openssl_get_md_methods(self::$openssl_digests_include_aliases);

    // $secret_key = openssl_digest($secret_key, $digests[n], true)
    */

    public function __construct($oCRNRSTN){

        $this->oCRNRSTN = $oCRNRSTN;
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