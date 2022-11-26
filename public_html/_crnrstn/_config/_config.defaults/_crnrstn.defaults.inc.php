<?php

/*
SYSTEM DEFAULTS TO SUPPORT ::
PAGE LOAD TTL = 2;
this.max_xhr_retrys = 5;

$tmp_header_options_ARRAY[] = 'Cache-Control: public, max-age=604800';

$tmp_array[] = 'Content-Type: text/html; charset=UTF-8';
$tmp_array[] = 'X-Powered-By: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();

protected $wcr_wp_profile_version_key = 'CRNRSTN::WP::INTEGRATIONS';
public $country_iso_code = 'en';

public $cache_ttl_default = 80;
public $useCURL_default = true;
protected $max_login_attempts = 10;
protected $max_seconds_inactive = 600;
protected $ssdtl_packet_ttl = -1;

// J5, my boy!
// INITIALIZE ALPHA SHIFT CRYPT KEY
$this->initialize_alpha_shift_crypt('JFIVEMYBOY');
protected $system_hash_algo = 'sha256';
private static $version_crnrstn = '2.00.0000 PRE-ALPHA-DEV (Lightsaber)';
public $system_database_table_prefix = 'crnrstn_';
public $system_http_get_param_prefix = 'crnrstn_';
public $max_storage_utilization = 85;
public $max_storage_utilization_warning = 70;

$oWCR->add_attribute('EMAIL_SEND_ACTIVE', true);

//        $oWCR->add_attribute('SMTP_KEEPALIVE', false);
//        $oWCR->add_attribute('SMTP_SECURE', '');
//        $oWCR->add_attribute('SMTP_AUTOTLS', true);
//        $oWCR->add_attribute('SMTP_TIMEOUT', 5);
//        $oWCR->add_attribute('DIBYA_SAHOO_SSL_CERT_BYPASS', true); // PER PHP +5.6, SEE RESEARCH [lnum 2906] [file /_crnrstn/class/environmentals/crnrstn.env.inc.php]
//        $oWCR->add_attribute('SENDMAIL_PATH', '/usr/sbin/sendmail');
//        $oWCR->add_attribute('USE_SENDMAIL_OPTIONS', true);

$oWCR->add_attribute('WORDWRAP', 79);
$oWCR->add_attribute('ISHTML', true);
$oWCR->add_attribute('PRIORITY', 'NORMAL');
$oWCR->add_attribute('DUP_SUPPRESS', true);
$oWCR->add_attribute('CHARSET', 'iso-8859-1');
$oWCR->add_attribute('MESSAGE_ENCODING', '8bit');
$oWCR->add_attribute('ALLOW_EMPTY', false);

$oWCR->add_attribute('SOA_NAMESPACE', 'http://www.w3.org/2003/05/soap-encoding');
$oWCR->add_attribute('WSDL_CACHE_TTL', 80);
$oWCR->add_attribute('NUSOAP_USECURL', true);

$oWCR->add_attribute('EMAIL_PROTOCOL', 'MAIL');     //SMTP, MAIL, QMAIL, SENDMAIL

$oWCR->add_attribute('FTP_TIMEOUT', 90);
$oWCR->add_attribute('FTP_IS_SSL', false);
$oWCR->add_attribute('FTP_USE_PASV', true);
$oWCR->add_attribute('FTP_USE_PASV_ADDR', false);
$oWCR->add_attribute('FTP_DISABLE_AUTOSEEK', false);
$oWCR->add_attribute('FTP_MKDIR_MODE', 777);

*/

// BEGIN DEFAULTS FOR ALL ENVIRONMENTS :: AS DESIGNATED BY PASSING CRNRSTN_RESOURCE_ALL AS ENV KEY PARAMETER
$this->config_set_QWERTY(CRNRSTN_RESOURCE_ALL, 'WSDL_CACHE_TTL', '80');	# REQUIRED BY CRNRSTN :: SOAP CONNECTION MANAGER
$this->config_set_QWERTY(CRNRSTN_RESOURCE_ALL, 'SOA_NAMESPACE', 'http://www.w3.org/2003/05/soap-encoding');   # USED BY CRNRSTN :: SOAP CONNECTION MANAGER