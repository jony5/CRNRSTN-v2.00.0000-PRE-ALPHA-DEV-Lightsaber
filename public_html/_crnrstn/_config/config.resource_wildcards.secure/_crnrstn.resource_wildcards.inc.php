<?php
# # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # #
# BEGIN INITIALIZATION OF ENVIRONMENTALLY
# RELEVANT RESOURCE WILDCARDS

switch($this->env_key){
    case 'BLUEHOST':
        # # # # #
        ### NEW WILD CARD RESOURCE
        $oWCR = $this->define_wildcard_resource('CRNRSTN::INTEGRATIONS');
        $oWCR->add_attribute('EMAIL_SEND_ACTIVE', true);

        # REQUIRED BY SOAP CONNECTION MANAGER
        $oWCR->add_attribute('CRNRSTN_SOAP_SVC_AUTH_KEY', '12345678987ftygyugyugg676t@5');
        $oWCR->add_attribute('CRNRSTN_SOAP_SVC_ENCRYPTION_KEY', '5jfu8chH#5%BNufn49fn4k3nvn9mmN!)000m32N3jN#');
        $oWCR->add_attribute('CRNRSTN_SOAP_SVC_USERNAME', '0364087231749672543475966333893875');
        $oWCR->add_attribute('CRNRSTN_SOAP_SVC_PASSWORD', '83g#k487fg5hY%@i4fs84jfmdld8!~lf;|Qkeiur84');
        $oWCR->add_attribute('WSDL_URI', 'http://jony5.com/_crnrstn/soa/?wsdl');

        $oWCR->add_attribute('SOA_NAMESPACE', 'http://www.w3.org/2003/05/soap-encoding');
        $oWCR->add_attribute('WSDL_CACHE_TTL', 80);
        $oWCR->add_attribute('NUSOAP_USECURL', true);
        $oWCR->add_attribute('SOAP_ENCRYPT_CIPHER', 'sm4');
        $oWCR->add_attribute('SOAP_ENCRYPT_OPTIONS', OPENSSL_RAW_DATA);
        $oWCR->add_attribute('SOAP_ENCRYPT_HMAC_ALG', 'haval256,5');
        # REQUIRED BY SOAP CONNECTION MANAGER

        //$oWCR->add_attribute('LOCAL_DIR_FILEPATH', '/var/www/html/_backup_test/_tmp/');
        //$oWCR->add_attribute('LOCAL_MKDIR_MODE', 775);

        $oWCR->add_attribute('EMAIL_PROTOCOL', 'MAIL');     //SMTP, MAIL, QMAIL, SENDMAIL
//        $oWCR->add_attribute('SMTP_AUTH', true);
//        $oWCR->add_attribute('SMTP_SERVER', 'mail.DOMAIN.com;mail.DOMAIN.com');
//        $oWCR->add_attribute('SMTP_PORT_OUTGOING', '587');
//        $oWCR->add_attribute('SMTP_USERNAME', 'website_admin@DOMAIN.com');
//        $oWCR->add_attribute('SMTP_PASSWORD', 'password123456789987654321');
//        $oWCR->add_attribute('SMTP_KEEPALIVE', false);
//        $oWCR->add_attribute('SMTP_SECURE', '');
//        $oWCR->add_attribute('SMTP_AUTOTLS', true);
//        $oWCR->add_attribute('SMTP_TIMEOUT', 5);
//        $oWCR->add_attribute('DIBYA_SAHOO_SSL_CERT_BYPASS', true); // PER PHP +5.6, SEE RESEARCH [lnum 2906] [file /_crnrstn/class/environmentals/crnrstn.env.inc.php]
//        $oWCR->add_attribute('SENDMAIL_PATH', '/usr/sbin/sendmail');
//        $oWCR->add_attribute('USE_SENDMAIL_OPTIONS', true);

        $oWCR->add_attribute('FROM_EMAIL', 'website_admin@DOMAIN.com');
        $oWCR->add_attribute('FROM_NAME', 'CRNRSTN :: v2.00.0000 Mailer');
        $oWCR->add_attribute('REPLYTO_EMAIL_PIPED', 'website_admin@DOMAIN.com');
        $oWCR->add_attribute('REPLYTO_NAME_PIPED', 'Website Administrator');

        $oWCR->add_attribute('WORDWRAP', 79);
        $oWCR->add_attribute('ISHTML', true);
        $oWCR->add_attribute('PRIORITY', 'NORMAL');
        $oWCR->add_attribute('DUP_SUPPRESS', true);
        $oWCR->add_attribute('CHARSET', 'iso-8859-1');
        $oWCR->add_attribute('MESSAGE_ENCODING', '8bit');
        $oWCR->add_attribute('ALLOW_EMPTY', false);

        //
        // EXCEPTION HANDLING NOTIFICATIONS EMAIL ENDPOINTS
        $oWCR->add_attribute('RECIPIENTS_EMAIL_PIPED', 'Jonathan J5 Harris c00000101@gmail.com||jharris@evifweb.com||j5@jony5.com');
        $oWCR->add_attribute('RECIPIENTS_NAME_PIPED', '||Jonathan Harris||J5');

        /*
        WHAT ABOUT LIKE THIS....
        $oWCR->add_attribute('RECIPIENTS_EMAIL', 'Jonathan J5 Harris c00000101@gmail.com');

        $oWCR->add_attribute('RECIPIENTS_EMAIL', 'jharris@evifweb.com',);
        $oWCR->add_attribute('RECIPIENTS_NAME', 'Jonathan Harris');

        $oWCR->add_attribute('RECIPIENTS_EMAIL', 'j5@jony5.com');
        $oWCR->add_attribute('RECIPIENTS_NAME', 'J5');

        */

        $oWildCardResource_ARRAY[$oWCR->return_resource_key()] = $oWCR;

    break;
    case 'BLUEHOST_WWW':
        # # # # #
        ### NEW WILD CARD RESOURCE
        $oWCR = $this->define_wildcard_resource('CRNRSTN::INTEGRATIONS');
        $oWCR->add_attribute('EMAIL_SEND_ACTIVE', true);

        # REQUIRED BY SOAP CONNECTION MANAGER
        $oWCR->add_attribute('CRNRSTN_SOAP_SVC_AUTH_KEY', '12345678987ftygyugyugg676t@5');
        $oWCR->add_attribute('CRNRSTN_SOAP_SVC_ENCRYPTION_KEY', '5jfu8chH#5%BNufn49fn4k3nvn9mmN!)000m32N3jN#');
        $oWCR->add_attribute('CRNRSTN_SOAP_SVC_USERNAME', '0364087231749672543475966333893875');
        $oWCR->add_attribute('CRNRSTN_SOAP_SVC_PASSWORD', '83g#k487fg5hY%@i4fs84jfmdld8!~lf;|Qkeiur84');
        $oWCR->add_attribute('WSDL_URI', 'http://www.jony5.com/_crnrstn/soa/?wsdl');

        $oWCR->add_attribute('SOA_NAMESPACE', 'http://www.w3.org/2003/05/soap-encoding');
        $oWCR->add_attribute('WSDL_CACHE_TTL', 80);
        $oWCR->add_attribute('NUSOAP_USECURL', true);
        $oWCR->add_attribute('SOAP_ENCRYPT_CIPHER', 'sm4');
        $oWCR->add_attribute('SOAP_ENCRYPT_OPTIONS', OPENSSL_RAW_DATA);
        $oWCR->add_attribute('SOAP_ENCRYPT_HMAC_ALG', 'haval256,5');
        # REQUIRED BY SOAP CONNECTION MANAGER

        //$oWCR->add_attribute('LOCAL_DIR_FILEPATH', '/var/www/html/_backup_test/_tmp/');
        //$oWCR->add_attribute('LOCAL_MKDIR_MODE', 775);

        $oWCR->add_attribute('EMAIL_PROTOCOL', 'MAIL');     //SMTP, MAIL, QMAIL, SENDMAIL
//        $oWCR->add_attribute('SMTP_AUTH', true);
//        $oWCR->add_attribute('SMTP_SERVER', 'mail.DOMAIN.com;mail.DOMAIN.com');
//        $oWCR->add_attribute('SMTP_PORT_OUTGOING', '587');
//        $oWCR->add_attribute('SMTP_USERNAME', 'website_admin@DOMAIN.com');
//        $oWCR->add_attribute('SMTP_PASSWORD', 'password123456789987654321');
//        $oWCR->add_attribute('SMTP_KEEPALIVE', false);
//        $oWCR->add_attribute('SMTP_SECURE', '');
//        $oWCR->add_attribute('SMTP_AUTOTLS', true);
//        $oWCR->add_attribute('SMTP_TIMEOUT', 5);
//        $oWCR->add_attribute('DIBYA_SAHOO_SSL_CERT_BYPASS', true); // PER PHP +5.6, SEE RESEARCH [lnum 2906] [file /_crnrstn/class/environmentals/crnrstn.env.inc.php]
//        $oWCR->add_attribute('SENDMAIL_PATH', '/usr/sbin/sendmail');
//        $oWCR->add_attribute('USE_SENDMAIL_OPTIONS', true);

        $oWCR->add_attribute('FROM_EMAIL', 'website_admin@DOMAIN.com');
        $oWCR->add_attribute('FROM_NAME', 'CRNRSTN :: v2.00.0000 Mailer');
        $oWCR->add_attribute('REPLYTO_EMAIL_PIPED', 'website_admin@DOMAIN.com');
        $oWCR->add_attribute('REPLYTO_NAME_PIPED', 'Website Administrator');

        $oWCR->add_attribute('WORDWRAP', 79);
        $oWCR->add_attribute('ISHTML', true);
        $oWCR->add_attribute('PRIORITY', 'NORMAL');
        $oWCR->add_attribute('DUP_SUPPRESS', true);
        $oWCR->add_attribute('CHARSET', 'iso-8859-1');
        $oWCR->add_attribute('MESSAGE_ENCODING', '8bit');
        $oWCR->add_attribute('ALLOW_EMPTY', false);

        //
        // EXCEPTION HANDLING NOTIFICATIONS EMAIL ENDPOINTS
        $oWCR->add_attribute('RECIPIENTS_EMAIL_PIPED', 'Jonathan J5 Harris c00000101@gmail.com|jharris@evifweb.com|j5@jony5.com');
        $oWCR->add_attribute('RECIPIENTS_NAME_PIPED', '|Jonathan Harris|J5');

        $oWildCardResource_ARRAY[$oWCR->return_resource_key()] = $oWCR;

    break;
    case 'LOCALHOST_MACBOOKPRO':
    case 'LOCALHOST_CHAD_MACBOOKPRO':

        //CRNRSTN_ERR_LOG_FTP
        # # # #
        ### NEW WILD CARD RESOURCE
        $oWCR = $this->define_wildcard_resource('CRNRSTN_ERR_LOG_FTP');
        $oWCR->add_attribute('FTP_SERVER', '172.16.225.128');
        $oWCR->add_attribute('FTP_USERNAME', 'jony5');
        $oWCR->add_attribute('FTP_PASSWORD', 'gY96sb21');
        $oWCR->add_attribute('FTP_PORT', 21);
        $oWCR->add_attribute('FTP_TIMEOUT', 90);
        $oWCR->add_attribute('FTP_IS_SSL', false);
        $oWCR->add_attribute('FTP_USE_PASV', true);
        $oWCR->add_attribute('FTP_USE_PASV_ADDR', false);
        $oWCR->add_attribute('FTP_DISABLE_AUTOSEEK', false);
        $oWCR->add_attribute('FTP_DIR_PATH', '/var/www/html/_backup_test/dest420_FTP_WCR/');
        $oWCR->add_attribute('FTP_MKDIR_MODE', 777);

        $oWildCardResource_ARRAY[$oWCR->return_resource_key()] = $oWCR;

        # # # # #
        ### NEW WILD CARD RESOURCE
        $oWCR = $this->define_wildcard_resource('CRNRSTN::INTEGRATIONS');

        $oWCR->add_attribute('CRNRSTN_SOAP_SVC_AUTH_KEY', '9898e80wq8e008f8s8f80f8s0f');
        $oWCR->add_attribute('CRNRSTN_SOAP_SVC_ENCRYPTION_KEY', 'uerrueworuu@re2wruruewuureuwuroruurw5uowerurworuwo');
        $oWCR->add_attribute('CRNRSTN_SOAP_SVC_USERNAME', '03856145387465910978456438');
        $oWCR->add_attribute('CRNRSTN_SOAP_SVC_PASSWORD', '7dj3m9d2m2d99dd2dm');
        $oWCR->add_attribute('SOA_NAMESPACE', 'http://www.w3.org/2003/05/soap-encoding');
        $oWCR->add_attribute('WSDL_URI', 'http://172.16.225.128/css.validate.jony5.com/_crnrstn/soa/?wsdl');
        $oWCR->add_attribute('WSDL_CACHE_TTL', 80);
        $oWCR->add_attribute('NUSOAP_USECURL', true);
        $oWCR->add_attribute('SOAP_ENCRYPT_CIPHER', 'sm4');
        $oWCR->add_attribute('SOAP_ENCRYPT_OPTIONS', OPENSSL_RAW_DATA);
        $oWCR->add_attribute('SOAP_ENCRYPT_HMAC_ALG', 'haval256,5');

        $oWCR->add_attribute('LOCAL_DIR_FILEPATH', '/var/www/html/_debug_output/');
        $oWCR->add_attribute('LOCAL_MKDIR_MODE', 775);

        $oWCR->add_attribute('EMAIL_SEND_ACTIVE', true);
        $oWCR->add_attribute('EMAIL_PROTOCOL', 'MAIL');     //SMTP, MAIL, QMAIL, SENDMAIL
//        $oWCR->add_attribute('SMTP_AUTH', true);
//        $oWCR->add_attribute('SMTP_SERVER', 'mail.DOMAIN.com;mail.DOMAIN.com');
//        $oWCR->add_attribute('SMTP_PORT_OUTGOING', '587');
//        $oWCR->add_attribute('SMTP_USERNAME', 'website_admin@DOMAIN.com');
//        $oWCR->add_attribute('SMTP_PASSWORD', 'password123456789987654321');
//        $oWCR->add_attribute('SMTP_KEEPALIVE', false);
//        $oWCR->add_attribute('SMTP_SECURE', '');
//        $oWCR->add_attribute('SMTP_AUTOTLS', true);
//        $oWCR->add_attribute('SMTP_TIMEOUT', 5);
//        $oWCR->add_attribute('DIBYA_SAHOO_SSL_CERT_BYPASS', true); // PER PHP +5.6, SEE RESEARCH [lnum 2906] [file /_crnrstn/class/environmentals/crnrstn.env.inc.php]
//        $oWCR->add_attribute('SENDMAIL_PATH', '/usr/sbin/sendmail');
//        $oWCR->add_attribute('USE_SENDMAIL_OPTIONS', true);

        $oWCR->add_attribute('FROM_EMAIL', 'website_admin@DOMAIN.com');
        $oWCR->add_attribute('FROM_NAME', 'CRNRSTN :: v2.00.0000 Mailer');
        $oWCR->add_attribute('REPLYTO_EMAIL_PIPED', 'website_admin@DOMAIN.com');
        $oWCR->add_attribute('REPLYTO_NAME_PIPED', 'Website Administrator');
        //$oWCR->add_attribute('CC_EMAIL_PIPED', 'CC_jharris@DOMAIN.com|CC2_jharris@DOMAIN.com');
        //$oWCR->add_attribute('CC_NAME_PIPED', '|CC2_CRNRSTN v2.0.0 :: Lead Developer');  // ONLY SECOND HAS NAME, HERE
        //$oWCR->add_attribute('BCC_EMAIL_PIPED', 'BCC_jharris@DOMAIN.com|BCC2_jharris@DOMAIN.com');
        //$oWCR->add_attribute('BCC_NAME_PIPED', 'BCC2_CRNRSTN v2.0.0 :: Lead Developer|');// ONLY FIRST HAS NAME, HERE
        $oWCR->add_attribute('WORDWRAP', 79);
        $oWCR->add_attribute('ISHTML', true);
        $oWCR->add_attribute('PRIORITY', 'NORMAL');
        $oWCR->add_attribute('DUP_SUPPRESS', true);
        $oWCR->add_attribute('CHARSET', 'iso-8859-1');
        $oWCR->add_attribute('MESSAGE_ENCODING', '8bit');
        $oWCR->add_attribute('ALLOW_EMPTY', false);

        //
        // EXCEPTION HANDLING NOTIFICATIONS EMAIL ENDPOINTS
        $oWCR->add_attribute('RECIPIENTS_EMAIL_PIPED', 'Jonathan J5 Harris c00000101@gmail.com|jharris@evifweb.com|j5@jony5.com');
        $oWCR->add_attribute('RECIPIENTS_NAME_PIPED', '|Jonathan Harris|J5');

        $oWildCardResource_ARRAY[$oWCR->return_resource_key()] = $oWCR;

    break;
    case 'LOCALHOST_PC':

    break;
    default:

        //
        // HOOOSTON...VE HAF PROBLEM!
        throw new Exception('An unknown...and hence unhandled...environmental reference key,"' . $this->env_key . '", has been provided for this environment. CRNRSTN :: configuration resource wildcards cannot be initialized without an acknowledged key.');

    break;
}