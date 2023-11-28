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
//
// BEGIN INITIALIZATION OF ENVIRONMENTALLY
// RELEVANT RESOURCE WILDCARDS.

    // # # # # #
    // ### NEW WILD CARD RESOURCE
    $oWCR_BLUEHOST_JONY5 = $this->define_wildcard_resource('BLUEHOST_JONY5', 'CRNRSTN::INTEGRATIONS::WCR');
    $oWCR_BLUEHOST_JONY5->add_attribute('EMAIL_SEND_ACTIVE', true);

    // # REQUIRED BY SOAP CONNECTION MANAGER
    $oWCR_BLUEHOST_JONY5->add_attribute('CRNRSTN_SOAP_SVC_AUTH_KEY', '12345678987ftygyugyugg676t@5');
    $oWCR_BLUEHOST_JONY5->add_attribute('CRNRSTN_SOAP_SVC_ENCRYPTION_KEY', '5jfu8chH#5%BNufn49fn4k3nvn9mmN!)000m32N3jN#');
    $oWCR_BLUEHOST_JONY5->add_attribute('CRNRSTN_SOAP_SVC_USERNAME', '0364087231749672543475966333893875');
    $oWCR_BLUEHOST_JONY5->add_attribute('CRNRSTN_SOAP_SVC_PASSWORD', '83g#k487fg5hY%@i4fs84jfmdld8!~lf;|Qkeiur84');
    $oWCR_BLUEHOST_JONY5->add_attribute('WSDL_URI', 'http://jony5.com/_crnrstn/soa/?wsdl');

    $oWCR_BLUEHOST_JONY5->add_attribute('SOA_NAMESPACE', 'http://www.w3.org/2003/05/soap-encoding');
    $oWCR_BLUEHOST_JONY5->add_attribute('WSDL_CACHE_TTL', 80);
    $oWCR_BLUEHOST_JONY5->add_attribute('NUSOAP_USECURL', true);
    $oWCR_BLUEHOST_JONY5->add_attribute('SOAP_ENCRYPT_CIPHER', 'sm4');
    $oWCR_BLUEHOST_JONY5->add_attribute('SOAP_ENCRYPT_OPTIONS', OPENSSL_RAW_DATA);
    $oWCR_BLUEHOST_JONY5->add_attribute('SOAP_ENCRYPT_HMAC_ALG', 'haval256,5');

    //$oWCR_BLUEHOST_JONY5->add_attribute('LOCAL_DIR_FILEPATH', '/var/www/html/_backup_test/_tmp/');
    //$oWCR_BLUEHOST_JONY5->add_attribute('LOCAL_MKDIR_MODE', 775);

    // # EMAIL AND FTP ATTRIBUTE NAMES MATCH INTERNAL SYSTEM AND 3RD PARTY VALUES.
    $oWCR_BLUEHOST_JONY5->add_attribute('EMAIL_PROTOCOL', 'MAIL');     //SMTP, MAIL, QMAIL, SENDMAIL
//        $oWCR_BLUEHOST_JONY5->add_attribute('SMTP_AUTH', true);
//        $oWCR_BLUEHOST_JONY5->add_attribute('SMTP_SERVER', 'mail.DOMAIN.com;mail.DOMAIN.com');
//        $oWCR_BLUEHOST_JONY5->add_attribute('SMTP_PORT_OUTGOING', '587');
//        $oWCR_BLUEHOST_JONY5->add_attribute('SMTP_USERNAME', 'website_admin@DOMAIN.com');
//        $oWCR_BLUEHOST_JONY5->add_attribute('SMTP_PASSWORD', 'password123456789987654321');
//        $oWCR_BLUEHOST_JONY5->add_attribute('SMTP_KEEPALIVE', false);
//        $oWCR_BLUEHOST_JONY5->add_attribute('SMTP_SECURE', '');
//        $oWCR_BLUEHOST_JONY5->add_attribute('SMTP_AUTOTLS', true);
//        $oWCR_BLUEHOST_JONY5->add_attribute('SMTP_TIMEOUT', 5);
//        $oWCR_BLUEHOST_JONY5->add_attribute('DIBYA_SAHOO_SSL_CERT_BYPASS', true); // PER PHP +5.6, SEE RESEARCH [lnum 2906] [file /_crnrstn/class/environment/crnrstn.environment.inc.php]
//        $oWCR_BLUEHOST_JONY5->add_attribute('SENDMAIL_PATH', '/usr/sbin/sendmail');
//        $oWCR_BLUEHOST_JONY5->add_attribute('USE_SENDMAIL_OPTIONS', true);

    $oWCR_BLUEHOST_JONY5->add_attribute('FROM_EMAIL', 'website_admin@DOMAIN.com');
    $oWCR_BLUEHOST_JONY5->add_attribute('FROM_NAME', 'CRNRSTN :: v2.00.0000 Mailer');
    $oWCR_BLUEHOST_JONY5->add_attribute('REPLYTO_EMAIL_PIPED', 'website_admin@DOMAIN.com');
    $oWCR_BLUEHOST_JONY5->add_attribute('REPLYTO_NAME_PIPED', 'Website Administrator');

    $oWCR_BLUEHOST_JONY5->add_attribute('WORDWRAP', 79);
    $oWCR_BLUEHOST_JONY5->add_attribute('ISHTML', true);
    $oWCR_BLUEHOST_JONY5->add_attribute('PRIORITY', 'NORMAL');
    $oWCR_BLUEHOST_JONY5->add_attribute('DUP_SUPPRESS', true);
    $oWCR_BLUEHOST_JONY5->add_attribute('CHARSET', 'iso-8859-1');
    $oWCR_BLUEHOST_JONY5->add_attribute('MESSAGE_ENCODING', '8bit');
    $oWCR_BLUEHOST_JONY5->add_attribute('ALLOW_EMPTY', false);

    //
    // EXCEPTION HANDLING NOTIFICATIONS EMAIL ENDPOINTS
    $oWCR_BLUEHOST_JONY5->add_attribute('RECIPIENTS_EMAIL_PIPED', 'Jonathan J5 Harris c00000101@gmail.com||jharris@eVifweb.com||j5@jony5.com');
    $oWCR_BLUEHOST_JONY5->add_attribute('RECIPIENTS_NAME_PIPED', '||Jonathan Harris||J5');

    /*
    WHAT ABOUT LIKE THIS....
    $oWCR_BLUEHOST_JONY5->add_attribute('RECIPIENTS_EMAIL', 'Jonathan J5 Harris c00000101@gmail.com');

    $oWCR_BLUEHOST_JONY5->add_attribute('RECIPIENTS_EMAIL', 'jharris@eVifweb.com',);
    $oWCR_BLUEHOST_JONY5->add_attribute('RECIPIENTS_NAME', 'Jonathan Harris');

    $oWCR_BLUEHOST_JONY5->add_attribute('RECIPIENTS_EMAIL', 'j5@jony5.com');
    $oWCR_BLUEHOST_JONY5->add_attribute('RECIPIENTS_NAME', 'J5');

    */

    //$oCRNRSTN_oWCR_ARRAY[$oWCR_BLUEHOST_JONY5->return_resource_key()] = $oWCR_BLUEHOST_JONY5;


    //
    // NEW WILD CARD RESOURCE
    $oWCR_BLUEHOST_EVIFWEB = $this->define_wildcard_resource('BLUEHOST_EVIFWEB', 'CRNRSTN::INTEGRATIONS::WCR');
    $oWCR_BLUEHOST_EVIFWEB->add_attribute('EMAIL_SEND_ACTIVE', true);

    //REQUIRED BY SOAP CONNECTION MANAGER
    $oWCR_BLUEHOST_EVIFWEB->add_attribute('CRNRSTN_SOAP_SVC_AUTH_KEY', '12345678987ftygyugyugg676t@5');
    $oWCR_BLUEHOST_EVIFWEB->add_attribute('CRNRSTN_SOAP_SVC_ENCRYPTION_KEY', '5jfu8chH#5%BNufn49fn4k3nvn9mmN!)000m32N3jN#');
    $oWCR_BLUEHOST_EVIFWEB->add_attribute('CRNRSTN_SOAP_SVC_USERNAME', '0364087231749672543475966333893875');
    $oWCR_BLUEHOST_EVIFWEB->add_attribute('CRNRSTN_SOAP_SVC_PASSWORD', '83g#k487fg5hY%@i4fs84jfmdld8!~lf;|Qkeiur84');
    $oWCR_BLUEHOST_EVIFWEB->add_attribute('WSDL_URI', 'http://www.jony5.com/_crnrstn/soa/?wsdl');
    $oWCR_BLUEHOST_EVIFWEB->add_attribute('SOA_NAMESPACE', 'http://www.w3.org/2003/05/soap-encoding');
    $oWCR_BLUEHOST_EVIFWEB->add_attribute('WSDL_CACHE_TTL', 80);
    $oWCR_BLUEHOST_EVIFWEB->add_attribute('NUSOAP_USECURL', true);
    $oWCR_BLUEHOST_EVIFWEB->add_attribute('SOAP_ENCRYPT_CIPHER', 'sm4');
    $oWCR_BLUEHOST_EVIFWEB->add_attribute('SOAP_ENCRYPT_OPTIONS', OPENSSL_RAW_DATA);
    $oWCR_BLUEHOST_EVIFWEB->add_attribute('SOAP_ENCRYPT_HMAC_ALG', 'haval256,5');

    //$oWCR_BLUEHOST_EVIFWEB->add_attribute('LOCAL_DIR_FILEPATH', '/var/www/html/_backup_test/_tmp/');
    //$oWCR_BLUEHOST_EVIFWEB->add_attribute('LOCAL_MKDIR_MODE', 775);

//
//
# REQUIRED BY SOAP CONNECTION MANAGER
    $oWCR_BLUEHOST_EVIFWEB->add_attribute('EMAIL_PROTOCOL', 'MAIL');     //SMTP, MAIL, QMAIL, SENDMAIL
//        $oWCR_BLUEHOST_EVIFWEB->add_attribute('SMTP_AUTH', true);
//        $oWCR_BLUEHOST_EVIFWEB->add_attribute('SMTP_SERVER', 'mail.DOMAIN.com;mail.DOMAIN.com');
//        $oWCR_BLUEHOST_EVIFWEB->add_attribute('SMTP_PORT_OUTGOING', '587');
//        $oWCR_BLUEHOST_EVIFWEB->add_attribute('SMTP_USERNAME', 'website_admin@DOMAIN.com');
//        $oWCR_BLUEHOST_EVIFWEB->add_attribute('SMTP_PASSWORD', 'password123456789987654321');
//        $oWCR_BLUEHOST_EVIFWEB->add_attribute('SMTP_KEEPALIVE', false);
//        $oWCR_BLUEHOST_EVIFWEB->add_attribute('SMTP_SECURE', '');
//        $oWCR_BLUEHOST_EVIFWEB->add_attribute('SMTP_AUTOTLS', true);
//        $oWCR_BLUEHOST_EVIFWEB->add_attribute('SMTP_TIMEOUT', 5);
//        $oWCR_BLUEHOST_EVIFWEB->add_attribute('DIBYA_SAHOO_SSL_CERT_BYPASS', true); // PER PHP +5.6, SEE RESEARCH [lnum 2906] [file /_crnrstn/class/environment/crnrstn.environment.inc.php]
//        $oWCR_BLUEHOST_EVIFWEB->add_attribute('SENDMAIL_PATH', '/usr/sbin/sendmail');
//        $oWCR_BLUEHOST_EVIFWEB->add_attribute('USE_SENDMAIL_OPTIONS', true);

    $oWCR_BLUEHOST_EVIFWEB->add_attribute('FROM_EMAIL', 'website_admin@DOMAIN.com');
    $oWCR_BLUEHOST_EVIFWEB->add_attribute('FROM_NAME', 'CRNRSTN :: v2.00.0000 Mailer');
    $oWCR_BLUEHOST_EVIFWEB->add_attribute('REPLYTO_EMAIL_PIPED', 'website_admin@DOMAIN.com');
    $oWCR_BLUEHOST_EVIFWEB->add_attribute('REPLYTO_NAME_PIPED', 'Website Administrator');

    $oWCR_BLUEHOST_EVIFWEB->add_attribute('WORDWRAP', 79);
    $oWCR_BLUEHOST_EVIFWEB->add_attribute('ISHTML', true);
    $oWCR_BLUEHOST_EVIFWEB->add_attribute('PRIORITY', 'NORMAL');
    $oWCR_BLUEHOST_EVIFWEB->add_attribute('DUP_SUPPRESS', true);
    $oWCR_BLUEHOST_EVIFWEB->add_attribute('CHARSET', 'iso-8859-1');
    $oWCR_BLUEHOST_EVIFWEB->add_attribute('MESSAGE_ENCODING', '8bit');
    $oWCR_BLUEHOST_EVIFWEB->add_attribute('ALLOW_EMPTY', false);

    //
    // EXCEPTION HANDLING NOTIFICATIONS EMAIL ENDPOINTS
    $oWCR_BLUEHOST_EVIFWEB->add_attribute('RECIPIENTS_EMAIL_PIPED', 'Jonathan J5 Harris c00000101@gmail.com|jharris@eVifweb.com|j5@jony5.com');
    $oWCR_BLUEHOST_EVIFWEB->add_attribute('RECIPIENTS_NAME_PIPED', '|Jonathan Harris|J5');

    //$oCRNRSTN_oWCR_ARRAY[$oWCR_BLUEHOST_EVIFWEB->return_resource_key()] = $oWCR_BLUEHOST_EVIFWEB;

    # # # #
    ### NEW WILD CARD RESOURCE
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO_FTP = $this->define_wildcard_resource('LOCALHOST_CHAD_MACBOOKPRO', 'CRNRSTN_ERR_LOG_FTP');
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO_FTP->add_attribute('FTP_SERVER', '172.16.225.128');
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO_FTP->add_attribute('FTP_USERNAME', 'jony5');
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO_FTP->add_attribute('FTP_PASSWORD', 'gY96sb21');
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO_FTP->add_attribute('FTP_PORT', 21);
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO_FTP->add_attribute('FTP_TIMEOUT', 90);
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO_FTP->add_attribute('FTP_IS_SSL', false);
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO_FTP->add_attribute('FTP_USE_PASV', true);
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO_FTP->add_attribute('FTP_USE_PASV_ADDR', false);
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO_FTP->add_attribute('FTP_DISABLE_AUTOSEEK', false);
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO_FTP->add_attribute('FTP_DIR_PATH', '/var/www/html/_backup_test/dest420_FTP_WCR/');
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO_FTP->add_attribute('FTP_MKDIR_MODE', 777);

    //$oCRNRSTN_oWCR_ARRAY[$oWCR_LOCALHOST_CHAD_MACBOOKPRO_FTP->return_resource_key()] = $oWCR_LOCALHOST_CHAD_MACBOOKPRO_FTP;

    # # # # #
    ### NEW WILD CARD RESOURCE
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO = $this->define_wildcard_resource('LOCALHOST_CHAD_MACBOOKPRO', 'CRNRSTN::INTEGRATIONS::WCR');

    $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('CRNRSTN_SOAP_SVC_AUTH_KEY', '9898e80wq8e008f8s8f80f8s0f');
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('CRNRSTN_SOAP_SVC_ENCRYPTION_KEY', 'uerrueworuu@re2wruruewuureuwuroruurw5uowerurworuwo');
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('CRNRSTN_SOAP_SVC_USERNAME', '03856145387465910978456438');
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('CRNRSTN_SOAP_SVC_PASSWORD', '7dj3m9d2m2d99dd2dm');
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('SOA_NAMESPACE', 'http://www.w3.org/2003/05/soap-encoding');
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('WSDL_URI', 'http://172.16.225.128/css.validate.jony5.com/_crnrstn/soa/?wsdl');
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('WSDL_CACHE_TTL', 80);
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('NUSOAP_USECURL', true);
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('SOAP_ENCRYPT_CIPHER', 'sm4');
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('SOAP_ENCRYPT_OPTIONS', OPENSSL_RAW_DATA);
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('SOAP_ENCRYPT_HMAC_ALG', 'haval256,5');

    $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('LOCAL_DIR_FILEPATH', '/var/www/html/_debug_output/');
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('LOCAL_MKDIR_MODE', 775);

    $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('EMAIL_SEND_ACTIVE', true);
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('EMAIL_PROTOCOL', 'MAIL');     //SMTP, MAIL, QMAIL, SENDMAIL
//        $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('SMTP_AUTH', true);
//        $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('SMTP_SERVER', 'mail.DOMAIN.com;mail.DOMAIN.com');
//        $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('SMTP_PORT_OUTGOING', '587');
//        $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('SMTP_USERNAME', 'website_admin@DOMAIN.com');
//        $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('SMTP_PASSWORD', 'password123456789987654321');
//        $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('SMTP_KEEPALIVE', false);
//        $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('SMTP_SECURE', '');
//        $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('SMTP_AUTOTLS', true);
//        $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('SMTP_TIMEOUT', 5);
//        $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('DIBYA_SAHOO_SSL_CERT_BYPASS', true); // PER PHP +5.6, SEE RESEARCH [lnum 2906] [file /_crnrstn/class/environment/crnrstn.environment.inc.php]
//        $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('SENDMAIL_PATH', '/usr/sbin/sendmail');
//        $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('USE_SENDMAIL_OPTIONS', true);

    $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('FROM_EMAIL', 'website_admin@DOMAIN.com');
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('FROM_NAME', 'CRNRSTN :: v2.00.0000 Mailer');
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('REPLYTO_EMAIL_PIPED', 'website_admin@DOMAIN.com');
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('REPLYTO_NAME_PIPED', 'Website Administrator');
    //$oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('CC_EMAIL_PIPED', 'CC_jharris@DOMAIN.com|CC2_jharris@DOMAIN.com');
    //$oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('CC_NAME_PIPED', '|CC2_CRNRSTN v2.0.0 :: Lead Developer');  // ONLY SECOND HAS NAME, HERE
    //$oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('BCC_EMAIL_PIPED', 'BCC_jharris@DOMAIN.com|BCC2_jharris@DOMAIN.com');
    //$oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('BCC_NAME_PIPED', 'BCC2_CRNRSTN v2.0.0 :: Lead Developer|');// ONLY FIRST HAS NAME, HERE
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('WORDWRAP', 79);
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('ISHTML', true);
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('PRIORITY', 'NORMAL');
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('DUP_SUPPRESS', true);
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('CHARSET', 'iso-8859-1');
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('MESSAGE_ENCODING', '8bit');
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('ALLOW_EMPTY', false);

    //
    // EXCEPTION HANDLING NOTIFICATIONS EMAIL ENDPOINTS
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('RECIPIENTS_EMAIL_PIPED', 'Jonathan J5 Harris c00000101@gmail.com|jharris@eVifweb.com|j5@jony5.com');
    $oWCR_LOCALHOST_CHAD_MACBOOKPRO->add_attribute('RECIPIENTS_NAME_PIPED', '|Jonathan Harris|J5');