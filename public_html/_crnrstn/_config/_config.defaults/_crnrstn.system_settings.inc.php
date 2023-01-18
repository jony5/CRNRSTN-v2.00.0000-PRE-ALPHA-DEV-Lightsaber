<?php
/*
// J5
// Code is Poetry */

//
// CRNRSTN :: GENERAL SETTINGS
// TODO :: MULTI-LANGUAGE SUPPORT
$this->config_add_system_resource(CRNRSTN_RESOURCE_ALL, 'hash_algo', 'sha256', 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');
$this->config_add_system_resource(CRNRSTN_RESOURCE_ALL, 'chmod_perms', 775, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');
$this->config_add_system_resource(CRNRSTN_RESOURCE_ALL, 'salt_length', 64, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');
$this->config_add_system_resource(CRNRSTN_RESOURCE_ALL, 'ssdtla_session_data_ttl', 10, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');
$tmp_ARRAY = array('crnrstn_inactivity_refresh_ttl', 'crnrstn_ssdtla_module_sync_ttl',
    'crnrstn_share_module_inactivity_close_ttl', 'crnrstn_page_load_ttl, bassdrive_is_live_ttl',
    'the_situation_with_bassdrive_ttl', 'bassdrive_title_ttl', 'bassdrive_locale_city_province_ttl',
    'bassdrive_locale_nation_ttl', 'stream_relays_ttl', 'social_media_connects_ttl', 'relay_performance_ttl', 'lifestyle_banner_ttl');
$this->config_add_system_resource(CRNRSTN_RESOURCE_ALL, 'interact_ui_ttl', $tmp_ARRAY, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

$tmp_ARRAY = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec');
$this->config_add_system_resource(CRNRSTN_RESOURCE_ALL, 'interact_ui_month_abbrev', $tmp_ARRAY, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

$tmp_ARRAY = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
$this->config_add_system_resource(CRNRSTN_RESOURCE_ALL, 'interact_ui_month', $tmp_ARRAY, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

$tmp_ARRAY = array('Sun', 'Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat');
$this->config_add_system_resource(CRNRSTN_RESOURCE_ALL, 'interact_ui_day_abbrev', $tmp_ARRAY, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

$tmp_ARRAY = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
$this->config_add_system_resource(CRNRSTN_RESOURCE_ALL, 'interact_ui_day', $tmp_ARRAY, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

//
// CRNRSTN :: INTERACT UI SETTINGS
$this->config_add_system_resource('BLUEHOST_JONY5', 'depeche_mode', CRNRSTN_DEBUG_OFF, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');                  // where CRNRSTN JS :: DEBUG MODES = [CRNRSTN_DEBUG_OFF, 100, 200, 300, 420, 500];
$this->config_add_system_resource('BLUEHOST_EVIFWEB', 'depeche_mode', 100, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');                              // where CRNRSTN JS :: DEBUG MODES = [CRNRSTN_DEBUG_OFF, 100, 200, 300, 420, 500];
$this->config_add_system_resource('LOCALHOST_CHAD_MACBOOKPRO', 'depeche_mode', 300, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');                     // where CRNRSTN JS :: DEBUG MODES = [CRNRSTN_DEBUG_OFF, 100, 200, 300, 420, 500];
$this->config_add_system_resource('BLUEHOST_JONY5', 'debug_logging_output_channel', 'DOM', 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');              // where CHANNEL = ['CONSOLE', 'DOM', 'ALERT'];
$this->config_add_system_resource('BLUEHOST_EVIFWEB', 'debug_logging_output_channel', 'CONSOLE', 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');        // where CHANNEL = ['CONSOLE', 'DOM', 'ALERT'];
$this->config_add_system_resource('LOCALHOST_CHAD_MACBOOKPRO', 'debug_logging_output_channel', 'DOM', 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');   // where CHANNEL = ['CONSOLE', 'DOM', 'ALERT'];
$this->config_add_system_resource(CRNRSTN_RESOURCE_ALL, 'page_load_ttl', 3, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');
$this->config_add_system_resource(CRNRSTN_RESOURCE_ALL, 'ssdtla_module_sync_ttl', 33, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');
$this->config_add_system_resource(CRNRSTN_RESOURCE_ALL, 'share_module_inactivity_close_ttl', 2, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');
$this->config_add_system_resource(CRNRSTN_RESOURCE_ALL, 'inactivity_refresh_ttl', 300, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

//
// CRNRSTN :: DOCUMENTATION
$this->config_add_system_resource(CRNRSTN_RESOURCE_ALL, 'share_component_is_active', true, 'CRNRSTN::RESOURCE::DOCUMENTATION_DEFAULTS');

/*
SYSTEM DEFAULTS TO SUPPORT ::


===
======
country_iso_code
Return the client detected language preferences for the current
session. CRNRSTN :: will honor ISO 639-1:2002 ...by default <---???.
======
PAGE LOAD TTL = 2;
this.max_xhr_retrys = 5;

public function add_system_resource(
                        $data_key,
                        $data_value,
                        $data_type_family = 'CRNRSTN::RESOURCE',
                        $data_auth_profile = CRNRSTN_AUTHORIZE_RUNTIME_ONLY,
                        $data_index = NULL,
                        $env_key = NULL,
              = = = = > $default_ttl = 60){


this.content_stage_max_width = 850;

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
private static $version_crnrstn = '';
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
//$this->config_set_QWERTY(CRNRSTN_RESOURCE_ALL, 'WSDL_CACHE_TTL', '80');	# REQUIRED BY CRNRSTN :: SOAP CONNECTION MANAGER
//$this->config_set_QWERTY(CRNRSTN_RESOURCE_ALL, 'SOA_NAMESPACE', 'http://www.w3.org/2003/05/soap-encoding');   # USED BY CRNRSTN :: SOAP CONNECTION MANAGER