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
# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: crnrstn
#  VERSION :: 2.00.0000
#  DATE :: September 28, 2013 @ 2115hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: The first class instantiated in the joining of the "wall of server" to the "wall of application".
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn {

	protected $oLogger;
    public $oMYSQLI_CONN_MGR;
	private static $oLog_ProfileManager;
	private static $oCommRichMediaProvider;
	public $oCRNRSTN_BITFLIP_MGR;
	public $oCRNRSTN_PERFORMANCE_REGULATOR;

    private static $lang_content_ARRAY = array();
    private static $sys_logging_profile_ARRAY = array();
    private static $sys_logging_meta_ARRAY = array();

    //
    // IS THERE A BETTER WAY TO HANDLE THIS DATA?
    private static $sys_logging_endpoint_ARRAY = array();
    private static $sys_logging_wcr_ARRAY = array();
    private static $sys_logging_update_profile_ARRAY = array();
    private static $sys_logging_update_endpoint_ARRAY = array();
    /////

	public $config_serial;
	public $os_bit_size;
    public $process_id;
    public $operating_system;
	
	public $opensslSessEncryptCipher = array();
	public $opensslSessEncryptSecretKey = array();
	public $opensslSessEncryptOptions = array();
	public $sessHmac_algorithm = array();
	public $opensslCookieEncryptCipher = array();
	public $opensslCookieEncryptSecretKey = array();
	public $opensslCookieEncryptOptions = array();
	public $cookieHmac_algorithm = array();
	
	public $opensslTunnelEncryptCipher = array();
	public $opensslTunnelEncryptSecretKey = array();
	public $opensslTunnelEncryptOptions = array();
	public $tunnelHmac_algorithm = array();

	private static $env_detect_ARRAY = array();
	public $handle_env_ARRAY = array();
	public $handle_env_cleartext_ARRAY = array();
	private static $env_name_ARRAY = array();
	public $ini_set_ARRAY = array();
	
	public $grant_accessIP_ARRAY = array();
	public $deny_accessIP_ARRAY = array();
	public $add_admin_creds_ARRAY = array();

	private static $database_extension_type_ARRAY = array();

	private static $envDetectRequiredCnt;
	
	public static $handle_resource_ARRAY = array();
	
	private static $serverAppKey = array();
	
	private static $env_select_ARRAY = array();
	
	private static $envMatchCount;
	public $CRNRSTN_debugMode;
	public $PHPMAILER_debugMode;
    public $log_silo_profile;
	public $starttime;
    public $cache_ttl_default = 80;
    public $useCURL_default = true;
	public $oLog_output_ARRAY = array();
	public $oWildCardResource_ARRAY = array();
	public $wildCardResource_filePath_ARRAY = array();
	public $destruct_output = '';
	public $sys_notices_creative_mode = 'ALL_IMAGE';
    public $crnrstn_resources_http_path;
    private static $encryptableDataTypes = array();
    public $system_resource_constants = array();
    public $system_style_profile_constants = array();
    public $system_output_profile_constants = array();
    public $system_output_channel_constants = array();
    public $creativeElementsKeys = array();
    public $weighted_elements_keys_ARRAY = array();
    private static $system_creative_http_path_ARRAY = array();
    private static $crnrstn_tmp_dir;
    private static $m_starttime = array();
    private static $requestProtocol;

    public $crnrstn_as_error_handler_ARRAY = array();
    public $crnrstn_as_error_handler_constants_ARRAY = array();

    public $log_initial_profile_ARRAY = array();
    protected $log_initial_profile_meta_ARRAY = array();
    public $soap_permissions_file_path_ARRAY = array();
    public $wp_config_file_path_ARRAY = array();
    public $analytics_config_file_path_ARRAY = array();
    public $engagement_config_file_path_ARRAY = array();
    public $response_header_attribute_ARRAY = array();

    public $version_crnrstn = '2.00.0000 PRE-ALPHA-DEV';
    public $version_apache;
    public $version_apache_sysimg;
    public $version_php;
    public $version_mysqli;

    public function __construct($config_filepath, $CRNRSTN_config_serial, $CRNRSTN_debugMode=0, $PHPMAILER_debugMode = 0, $CRNRSTN_loggingProfile = CRNRSTN_LOG_DEFAULT){

        $this->starttime = $_SERVER['REQUEST_TIME_FLOAT'];

        //
        // TODO :: MAKE THIS WINDOWS COMPATIBLE
        // PROCESS ID :: SITUATIONAL AWARENESS
        $this->initialize_os();
        $this->process_id = getmypid();

        //
        // SOURCE :: https://www.youtube.com/watch?v=eiWClZrJSZY
        // TITLE :: Warren G Ft. Nate Dogg - Regulate (Dirty+Lyrics)
        // AUTHOR :: R.I.P. NATE DOGG [1969-2011] | WARREN G.
        $this->oCRNRSTN_PERFORMANCE_REGULATOR = new crnrstn_performance_regulator($this);

        //
        // CRNRSTN :: BITWISE ENGINE INITIALIZATION OF CONSTANTS STORED WITHIN
        // INTEGER ARRAY WITH ALL THE BITS AND THE FLIPS
        $this->initialize_bitwise();
        $this->initialize_integer_length();

        $this->CRNRSTN_debugMode = $CRNRSTN_debugMode;
        $this->PHPMAILER_debugMode = $PHPMAILER_debugMode;

        $this->initialize_language();

        //
        // INITIALIZE ARRAY OF ENCRYPTABLE DATATYPES
        self::$encryptableDataTypes = array('string', 'integer', 'double', 'float', 'int');

        //
        // INITIALIZE GROUPED CONSTANTS ARRAYS
        $this->system_resource_constants = array(CRNRSTN_RESOURCE_ALL, CRNRSTN_RESOURCE_OPENSOURCE, CRNRSTN_LOG_EMAIL, CRNRSTN_LOG_EMAIL_PROXY, CRNRSTN_LOG_FILE, CRNRSTN_LOG_FILE_FTP, CRNRSTN_LOG_SCREEN_TEXT, CRNRSTN_LOG_SCREEN, CRNRSTN_LOG_SCREEN_HTML, CRNRSTN_LOG_SCREEN_HTML_HIDDEN, CRNRSTN_LOG_DEFAULT, CRNRSTN_LOG_ELECTRUM);
        $this->system_style_profile_constants = array(CRNRSTN_UI_PHPNIGHT, CRNRSTN_UI_HTML, CRNRSTN_UI_PHP, CRNRSTN_UI_FEATHER);
        $this->system_output_profile_constants = array(CRNRSTN_ASSET_MODE_PNG, CRNRSTN_ASSET_MODE_JPEG, CRNRSTN_ASSET_MODE_BASE64);
        $this->system_output_channel_constants = array(CRNRSTN_UI_DESKTOP, CRNRSTN_UI_TABLET, CRNRSTN_UI_MOBILE);

        $this->creativeElementsKeys = array('CRNRSTN ::', 'LINUX_PENGUIN', 'REDHAT_BAR', 'REDHAT_CIRCLE', 'APACHE_POWER_VERSION', 'CRNRSTN_R', '5', 'REDHAT_POWER', 'MYSQL_DOLPHIN', 'PHP_ELLIPSE', 'CRNRSTN_R_WALL', 'POW_BY_PHP', 'ZEND_LOGO', 'ZEND_FRAMEWORK', 'ZEND_FRAMEWORK_3');
        $this->generate_weighted_elements_keys(count($this->creativeElementsKeys));

        $this->response_header_attribute_ARRAY['log'] = '';
        $this->initialize_apache_profile();
        $this->initialize_php_profile();

        //
        // SET BITS FOR LOGGING PROFILE SILO
        $this->log_silo_profile = $CRNRSTN_loggingProfile;
        $this->oCRNRSTN_BITFLIP_MGR->initialize_bit($this->log_silo_profile, true);

        //
        // FORCE RE-SERIALIZATION OF SESSION UPON CONFIG CHANGE
        $serial = $CRNRSTN_config_serial . '_420.00' . filesize($config_filepath) . '.' . filemtime($config_filepath) . '.0';
        $this->config_serial = $serial;

        //
        // SUPPORT FOR ENRICHED DEBUGGING/LOG TRACE
        if (isset($_SESSION['CRNRSTN_CONFIG_SERIAL'])) {

            $_SESSION['CRNRSTN_CONFIG_SERIAL_BCKUP'] = $_SESSION['CRNRSTN_CONFIG_SERIAL'];

        }

        $_SESSION['CRNRSTN_CONFIG_SERIAL'] = $serial;
        $_SESSION['CRNRSTN_' . $this->crcINT($serial)]['CRNRSTN_START_TIME'] = $this->starttime;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging($this->CRNRSTN_debugMode, __CLASS__, $this->log_silo_profile, $this);
        $this->error_log('SERVER / CRNRSTN :: start time [' . $this->starttime . ']', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        $this->error_log('TODO :: VERIFY COMPLETE oCRNRSTN DESTRUCTION. STILL ALIVE! Trace log stuff at no_cars_tification_go() 11/12/2020 0410hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: EVALUATE CONFIG FILE INCLUDES PER SOAP INCLUDES STANDARDS. 11/12/2020 0412hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: CONFIRM EXCLUSIVE USE OF ONLY-GET-WHAT-YOU-NEED-TO-oCRNRSTN_ENV ON NEW CONFIGURATION INCLUDES WITHIN CRNRSTN [oWCR, PROXY, etc.] ::. 11/13/2020 1159hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: SET NUSOAP PHP DEBUG MODE, $NUSOAP_debugMode (CRNRSTN :: SOAP SERVICES) THROUGH CRNRSTN :: CONFIG FILE. 11/14/2020 2114hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: WRAP NUSOAP PHP SERVER ENDPOINT IN CRNRSTN_USR...AND PREPARE TO SUPPORT DYNAMIC WSDL ENDPOINTS ::. 11/14/2020 2114hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: PREFIX NUSOAP PHP SERVER WSDL ENDPOINT WITH --> CONFIGURABLE ALLOW/DENY IP ADDRESS CHECK. 11/15/2020 0705hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: TEST NULL PASSTHROUGH FROM CLIENT TO SERVER. 11/23/2020 1120hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: DECOUPLE SOAP ENDPOINT VERSION DIRECTORY NAME (E.G. /2.0.0/) FROM ACTUAL SERVICE INVOKATION. 1/15/2021 @ 1400hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: TTL FUNCTIONALITY ADDED TO ELECTRUM DESTINATION FTP/DIR PROFILE TO SUPPORT ROTATION. 1/25/2021 1228hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: FACILITATE GRACEFUL ROTATION OF ENCRYPTION PROFILES. 1/27/2021 1145hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: ENSURE GRANULAR APPLICATION OF METHOD FALSE PATHWAY :: $oCRNRSTN_USR->electrum_deleteSourceData_OnSuccess(). 2/4/2021 @1636hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: // https://www.php.net/manual/en/language.operators.bitwise.php#108679 2/4/2021 1637hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: // https://www.php.net/manual/en/language.operators.bitwise.php // https://www.php.net/manual/en/language.operators.bitwise.php#108679 // https://stackoverflow.com/questions/12380478/bits-counting-algorithm-brian-kernighan-in-an-integer-time-complexity & // https://stackoverflow.com/questions/16848931/how-to-fastest-count-the-number-of-set-bits-in-php 2/4/2021 1637hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: // apache_get_version() & https://en.wikipedia.org/wiki/XML-RPC 2/10/2021 2231hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: // https://www.percona.com/blog/2008/01/10/php-vs-bigint-vs-float-conversion-caveat/ 2/14/2021 0326hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: PHPMailer is "Compatible with PHP 5.5 and later, including PHP 8.0". Make sure NuSOAP, MobileDetect, and CRNRSTN :: are as well. 3/10/2021 0547hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: CONSIDER USE OF STATIC METHODS AND SHIPPING CALCULATIONS API INTEGRATIONS DONE SAME TIME AS PAYMENT GATEWAY INTEGRATIONS ::. 3/10/2021 0547hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: May 10, 2021 1809hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: CRNRSTN :: FORCE SESSION REFRESH ON *ALL MODIFIED* LINKED RESOURCES IN THE CONFIG-CHAIN. 11/13/2021 2102hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: LOGIN ERR CONSIDER TRACKING STALE PASSWORD...FORCED RESET...EVEN CERTAIN STRING PATTERN BEHAVIOR. 5/13/2021 2102hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: EXPOSE $this->lscpu_output FROM BITWISE MANAGER TO oCRNRSTN_USR [CPU MHz, Vendor ID, Byte Order...] 5/19/2021 1613hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: FORCE DATABASE CONFIG ENV MISALIGNMENT, AND THEN CATCH IT @ LINE 303 HERE _crnrstn/class/database/mysqli/crnrstn.mysqli.inc.php] 9/17/2021 1023hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        //
        // LOGGING PROFILE MANAGER
        $sys_logging_profile_pack = $this->return_sys_logging_init_profile_pack();
        self::$oLog_ProfileManager = new crnrstn_logging_oprofile_manager($sys_logging_profile_pack, $this);

        try {

            if (!array_key_exists('SERVER_ADDR', $_SERVER)) {

                //
                // HOOOSTON...VE HAF PROBLEM!
                // SOURCE :: https://www.wired.com/2011/04/alt-text-spacecraft/
                $this->error_log('ERROR :: unable to load CRNRSTN. _SERVER[] super global has not been initialized. If calling this program via script, try using cURL (/usr/bin/curl).', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                throw new Exception('CRNRSTN :: initialization error :: $_SERVER[] super global has not been initialized. If calling this program via script, try using cURL (/usr/bin/curl). SERVER_NAME(SERVER_ADDR)-> ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ').');

            } else {

                //
                // STORE CONFIG SERIAL KEY AND INITIALIZE MATCH COUNT
                $_SESSION['CRNRSTN_' . $this->crcINT($this->config_serial)]['CRNRSTN_EXCEPTION_PREFIX'] = '';

                //
                // IF EARLY ENV DETECTION DURING define_env_resource() DUE TO SPECIFIED required_detection_matches(),
                // STORE ENV HERE:
                self::$serverAppKey[$this->crcINT($this->config_serial)] = "";

                //
                // INITIALIZE DATABASE CONNECTION MANAGER.
                $this->oMYSQLI_CONN_MGR = new crnrstn_mysqli_conn_manager($this->config_serial);
                $this->error_log('Instantiating mysqli database connection manager object. Ready to configure database authentication profiles.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                //
                // INITIALIZE IP ADDRESS SECURITY MANAGER
                $this->error_log('instantiating IP security manager object with client IP of [' . $_SERVER['REMOTE_ADDR'] . '] and phpsessionid[' . session_id() . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                $this->oCRNRSTN_IPSECURITY_MGR = new crnrstn_ip_auth_manager();

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    private function generate_weighted_elements_keys($cnt){

        // $this->creativeElementsKeys =
        // array('CRNRSTN ::', 'LINUX_PENGUIN', 'REDHAT_BAR', 'REDHAT_CIRCLE', 'APACHE_POWER_VERSION',
        // 'CRNRSTN_R', '5', 'REDHAT_POWER', 'MYSQL_DOLPHIN', 'PHP_ELLIPSE', 'CRNRSTN_R_WALL',
        // 'POW_BY_PHP', 'ZEND_LOGO', 'ZEND_FRAMEWORK', 'ZEND_FRAMEWORK_3');
        $output_ratio_ARRAY = array(1, 10, 2, 6, 5, 3, 1, 8, 7, 7, 6, 7, 5, 5, 5);

        for($i = 0; $i < $cnt; $i++){

            if(!isset($output_ratio_ARRAY[$i])){

                $output_ratio_ARRAY[$i] = 1;

            }

            for($ii = 0; $ii < $output_ratio_ARRAY[$i]; $ii++){

                $this->weighted_elements_keys_ARRAY[] = $this->creativeElementsKeys[$i];

            }

        }

    }

    public function serialized_is_bit_set($const_nom, $integer_const){

        return $this->oCRNRSTN_BITFLIP_MGR->serialized_is_bit_set($const_nom, $integer_const);

    }

    public function is_bit_set($integer_const){

        return $this->oCRNRSTN_BITFLIP_MGR->is_bit_set($integer_const);

    }

    public function return_encryptable_data_types(){

        return self::$encryptableDataTypes;

    }

    public function return_sys_logging_profile(){

        return self::$sys_logging_profile_ARRAY;

    }

    public function return_sys_logging_meta(){

        return self::$sys_logging_meta_ARRAY;

    }

    private function initialize_os(){

        if (stristr(PHP_OS, "win")) {

            $this->operating_system = 'WIN';

        }else{

            $this->operating_system = strtoupper(PHP_OS);

        }

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.getmypid.php
    // AUTHOR :: kroczu at interia dot pl :: https://www.php.net/manual/en/function.getmypid.php#59889
    private function getpidinfo($pid, $ps_opt="aux"){

        $ps=shell_exec("ps ".$ps_opt."p ".$pid);
        $ps=explode("\n", $ps);

        if(count($ps)<2){

            $this->error_log('We attempted to acquire PID information via shell_exec(), but the PID '.$pid.' doesn\'t seem to exist.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
            //trigger_error("PID ".$pid." doesn't exists", E_USER_WARNING);

            return false;

        }

        foreach($ps as $key=>$val){

            //error_log(__LINE__.' '.__METHOD__.' ['.$key.']'.$ps[$key]);
            $ps[$key] = explode(" ", $ps[$key]);

        }

        foreach($ps[0] as $key => $val){
           // error_log(__LINE__.' '.__METHOD__.' $key['.$key.']'.' $val['.$val.'] '.$ps[1][$key]);

            $pidinfo[$val] = $ps[1][$key];

            unset($ps[1][$key]);

        }

        if(is_array($ps[1])){
            $pidinfo[$val].=" ".implode(" ", $ps[1]);
            //error_log(__LINE__.' '.__METHOD__.' $val['.$val.'] '.$pidinfo[$val]);

        }

        return $pidinfo;

    }

    public function initialize_integer_length(){

        $tmp_os_bit_size = (int) $this->oCRNRSTN_BITFLIP_MGR->os_bit_size;

        $this->os_bit_size = $tmp_os_bit_size;

    }

	private function initialize_bitwise(){

        /*
        NOTES (3/8/2021 0609hrs) ::

        On 32-bit builds, a string can be as large as up to 2GB (2147483647 bytes maximum)

        The name of a constant follows the same rules as any label
        in PHP. A valid constant name starts with a letter or
        underscore, followed by any number of letters, numbers, or
        underscores. As a regular expression, it would be expressed
        thusly: ^[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*$

        Warning :: Use functions from the gmp extension for bitwise manipulation on
        numbers beyond PHP_INT_MAX.

        */

        $this->oCRNRSTN_BITFLIP_MGR = new crnrstn_bitflip_manager();

        //$this->log_silo_profile

        //
        //const CRNRSTN_UI_PHPNIGHT;
        //const CRNRSTN_UI_HTML;
        //const CRNRSTN_UI_PHP;


        //
        // VALIDATE UGC CONSTANT NAMES BEFORE DEFINITION ESTABLISHED

    }

    public function set_timezone_default($timezone_id){

        //
        // List of Supported Timezones
        // https://www.php.net/manual/en/timezones.php

        return date_default_timezone_set($timezone_id);

    }

	public function set_developer_output_mode($theme_style = CRNRSTN_UI_PHPNIGHT){

        //
        // FLAG - STATE IS OFF
        //$this->oCRNRSTN_BITWISE->set($integer_constant);
        //$this->oCRNRSTN_BITWISE->toggle($integer_constant);
        //$this->oCRNRSTN_BITWISE->read($integer_constant);
        //$this->oCRNRSTN_BITWISE->remove($integer_constant)
        //$this->oCRNRSTN_BITWISE->stringout()
        //$this->oCRNRSTN_BITFLIP_MGR->set($integer_constant, true);

        $this->oCRNRSTN_BITFLIP_MGR->initialize_bit($theme_style, true);

    }

	public function return_oLog_ProfileManager(){

        return self::$oLog_ProfileManager;

    }

    public function hello_world($type, $is_bastard = true){

        try{

            if($is_bastard){

                $str = 'Hello World.';  // bastard dialect

            }else{

                $str = 'Good morrow, fellow subjects of the Crown.';

            }

            error_log(__LINE__.' '.get_class().' exception! '.$str);
            throw new Exception('CRNRSTN '.$this->version_crnrstn.' :: '.$str.' This is an exception handling test from '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].').');

        } catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function return_sys_logging_init_profile_pack(){

        $tmp_array = array();

        if(isset(self::$sys_logging_profile_ARRAY[$this->crcINT($this->config_serial)][CRNRSTN_LOG_ALL])){

            //
            // PARALLEL STORAGE IN USE BY ENVIRONMENTAL CLASS OBJECT
            $tmp_array['sys_logging_profile_ARRAY'] = self::$sys_logging_profile_ARRAY[$this->crcINT($this->config_serial)][CRNRSTN_LOG_ALL];
            $tmp_array['sys_logging_meta_ARRAY'] = self::$sys_logging_meta_ARRAY[$this->crcINT($this->config_serial)][CRNRSTN_LOG_ALL];
            $tmp_array['sys_logging_wcr_ARRAY'] = $this->oWildCardResource_ARRAY[$this->crcINT($this->config_serial)][CRNRSTN_LOG_ALL];

        }

        return $tmp_array;

    }

    public function add_soap($envKey, $soap_permissions_file_path){

        //error_log(__LINE__.' crnrstn - ['.$envKey.']['.$soap_permissions_file_path.']');
        $this->soap_permissions_file_path_ARRAY[$this->crcINT($this->config_serial)][$this->crcINT($envKey)][] = $soap_permissions_file_path;

    }

    public function add_wordpress($envKey, $crnrstn_wp_config_file_path){

        $this->wp_config_file_path_ARRAY[$this->crcINT($this->config_serial)][$this->crcINT($envKey)][] = $crnrstn_wp_config_file_path;

    }

    public function add_analytics_seo($envKey, $crnrstn_analytics_config_file_path){

        $this->analytics_config_file_path_ARRAY[$this->crcINT($this->config_serial)][$this->crcINT($envKey)][] = $crnrstn_analytics_config_file_path;

    }

    public function add_engagement_tag_seo($envKey, $crnrstn_engagement_config_file_path){

        $this->engagement_config_file_path_ARRAY[$this->crcINT($this->config_serial)][$this->crcINT($envKey)][] = $crnrstn_engagement_config_file_path;

    }

    public function embryonic_init_crnrstn_tmp_dir($dir_path){

        if(is_dir($dir_path)){

            self::$crnrstn_tmp_dir = rtrim($dir_path,DIRECTORY_SEPARATOR);
            $this->error_log('Embryonic /tmp directory path '.$dir_path.' has been stored.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        }else{

            $this->error_log('Skipping embryonic /tmp directory path, '.$dir_path.'. This has not been applied.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        }

    }

    public function return_tmp(){

        if(isset(self::$crnrstn_tmp_dir)){

            return self::$crnrstn_tmp_dir;

        }else{

            return false;

        }

    }

	public function embryonic_init_logging($CRNRSTN_loggingProfile, $CRNRSTN_loggingMeta = NULL){

        $this->oCRNRSTN_BITFLIP_MGR->initialize_bit($CRNRSTN_loggingProfile, true);

        self::$sys_logging_profile_ARRAY[$this->crcINT($this->config_serial)][CRNRSTN_LOG_ALL][] = $CRNRSTN_loggingProfile;

        if(isset($CRNRSTN_loggingMeta)){

            self::$sys_logging_meta_ARRAY[$this->crcINT($this->config_serial)][CRNRSTN_LOG_ALL][] = $CRNRSTN_loggingMeta;

        }else{

            self::$sys_logging_meta_ARRAY[$this->crcINT($this->config_serial)][CRNRSTN_LOG_ALL][] = '0';

        }

        //
        // PROCESS META DATA
        $this->error_log('Embryonic logging profile data (int) '.$CRNRSTN_loggingProfile.' has been received.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

    }

    public function save_wildcard_resource($oWildCardResource){

       $this->augmentWCR_array($oWildCardResource);

    }

    private function augmentWCR_array($oWCR){

        $tmp_array = array();

        $tmp_array[$oWCR->return_resource_key()] = $oWCR;
        $this->oWildCardResource_ARRAY[$this->crcINT($this->config_serial)][CRNRSTN_LOG_ALL][] = $tmp_array;

    }

    public function return_m_start_time(){

	    return self::$m_starttime;

    }

	public function removePreviousSessEnvDetectData(){

	    $tmp_session_array = array();

        if(isset($_SESSION['CRNRSTN_CONFIG_SERIAL_BCKUP'])) {

	        foreach($_SESSION as $key => $value) {

                if($key == 'CRNRSTN_' . $this->crcINT($_SESSION['CRNRSTN_CONFIG_SERIAL_BCKUP'])) {

                    $this->error_log('Removing memory leak associated with data stored behind obsolete SESSION key[' . $key . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                }else{

                    $tmp_session_array[$key] = $value;

                }

            }

            $_SESSION = $tmp_session_array;

        }

    }

    public function embryonic_init_creative_http_dir($http_uri_dir){

        //
        // ENSURE THERE IS A TRAILING FORWARD SLASH
        $tmp_str = rtrim($http_uri_dir,'/');

        $tmp_str = $tmp_str .  '/';

        $this->crnrstn_resources_http_path = $tmp_str;

    }

	public function returnSystemCreative($envKey){

        //
        // TODO :: THIS FUNCTIONALITY SHOULD BE ADAPTED FOR WHITE LABEL FOR ALL SYSTEM NOTIFICATIONS.
        try{

            if(isset(self::$system_creative_http_path_ARRAY[$this->crcINT($this->config_serial)][$envKey])){

                return self::$system_creative_http_path_ARRAY[$this->crcINT($this->config_serial)][$envKey];

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to locate a CRNRSTN :: system images HTTP path related to the serialization of this CRNRSTN configuration file and the environment, "'.$envKey.'".');

            }

//
//            switch($this->sys_notices_creative_mode){
//                case 'ALL_HTML':
//                case 'ALL_HTML_HEADER_OFF':
//                case 'ALL_IMAGE':
//                case 'ALL_IMAGE_HEADER_OFF':
//
//                    if(isset(self::$crnrstn_resources_http_path_ARRAY[$this->crcINT($this->config_serial)][$envKey])){
//
//                        return self::$crnrstn_resources_http_path_ARRAY[$this->crcINT($this->config_serial)][$envKey];
//
//                    }else{
//
//                        //
//                        // HOOOSTON...VE HAF PROBLEM!
//                        throw new Exception('Unable to locate a CRNRSTN :: system images HTTP path related to the serialization of this CRNRSTN configuration file and the environment, "'.$envKey.'".');
//
//                    }
//
//                break;
//                //case 'ALL_HTML':
//                //case 'ALL_HTML_HEADER_OFF':
//
//                //    return '';
//
//                //break;
//                default:
//
//                    return '';
//
//                break;
//
//            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

	public function init_sys_assets_transport_mode($integer_constant = CRNRSTN_ASSET_MODE_BASE64){

        $this->oCRNRSTN_BITFLIP_MGR->initialize_bit($integer_constant, true);

        return true;

    }

    public function initSystemNotices_imgHTTP_DIR($envKey, $crnrstn_images_http_dir){

	    //
        // GUARANTEE TRAILING SLASH
        $pos_fslash = strpos($crnrstn_images_http_dir, '/');

        if ($pos_fslash !== false) {

            $slashChar = '/';

        } else {

            $slashChar = '\\';

        }

        $crnrstn_images_http_dir = rtrim($crnrstn_images_http_dir, $slashChar);
        $crnrstn_images_http_dir .= $slashChar;

        self::$system_creative_http_path_ARRAY[$this->crcINT($this->config_serial)][$this->crcINT($envKey)] = $crnrstn_images_http_dir;

        return true;

    }

    public function embryonic_init_crnrstn_err_handle($isActive = true, $errorTypesProfile=NULL){

        if($isActive){

            if(isset($errorTypesProfile)){

                //
                // SOURCE :: https://stackoverflow.com/questions/1241728/can-i-try-catch-a-warning
                // AUTHOR :: https://stackoverflow.com/users/117260/philippe-gerber
                // SET TO THE USER DEFINED ERROR HANDLER
                $old_error_handler = set_error_handler(function($errno, $errstr, $errfile, $errline, $errcontext) {

                    try{

                        // error was suppressed with the @-operator
                        if (0 === error_reporting()) {
                            return false;
                        }

                        $errstr = $_SESSION['CRNRSTN_'.$this->crcINT($this->config_serial)]['CRNRSTN_EXCEPTION_PREFIX'].$errstr;
                        $_SESSION['CRNRSTN_'.$this->crcINT($this->config_serial)]['CRNRSTN_EXCEPTION_PREFIX'] = '';

                        throw new ErrorException($errstr, 0, $errno, $errfile, $errline);

                    } catch (Exception $e) {

                        //
                        // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
                        $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

                        return false;

                    }

                }, (int) $errorTypesProfile);

            }else{

                $old_error_handler = set_error_handler(function($errno, $errstr, $errfile, $errline, $errcontext) {

                    try{

                        // error was suppressed with the @-operator
                        if (0 === error_reporting()) {
                            return false;
                        }

                        $errstr = $_SESSION['CRNRSTN_'.$this->crcINT($this->config_serial)]['CRNRSTN_EXCEPTION_PREFIX'].$errstr;
                        $_SESSION['CRNRSTN_'.$this->crcINT($this->config_serial)]['CRNRSTN_EXCEPTION_PREFIX'] = '';

                        throw new ErrorException($errstr, 0, $errno, $errfile, $errline);

                    } catch (Exception $e) {

                        //
                        // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
                        $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

                        return false;

                    }

                });

            }

        }else{

            //
            // RESTORE ERROR HANDLING TO NATIVE PHP
            return restore_error_handler();

        }

        return true;

    }

	public function set_CRNRSTN_asErrorHandler($envKey, $isActive = true, $errorTypesProfile=NULL){

	    $this->crnrstn_as_error_handler_ARRAY[$this->crcINT($this->config_serial)][$this->crcINT($envKey)] = $isActive;
	    $this->crnrstn_as_error_handler_constants_ARRAY[$this->crcINT($this->config_serial)][$this->crcINT($envKey)] = $errorTypesProfile;

        return true;

    }

	public function add_wildcards($envKey, $filepathWildCardResource){

        $this->wildCardResource_filePath_ARRAY[$this->crcINT($this->config_serial)][$this->crcINT($envKey)] = $filepathWildCardResource;

        return true;

    }

	public function add_environment($envKey, $errorReporting){

        $this->error_log('addEnvironment() key ['.$envKey.'] converted to checksum ['.$this->crcINT($envKey).'] and will be referenced as such from time to time.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

		$this->addServerEnv($this->crcINT($this->config_serial), $envKey, $errorReporting);

		return true;

	}

	private function addServerEnv($config_serial, $envKey, $errRptProfl) {

		try{

            $envKey_crc = $this->crcINT($envKey);

			if(!isset($this->handle_env_ARRAY[$config_serial][$envKey_crc])){

			    $this->handle_env_cleartext_ARRAY[$config_serial][$envKey_crc] = $envKey;
				$this->handle_env_ARRAY[$config_serial][$envKey_crc] = $errRptProfl;
				self::$env_detect_ARRAY[$config_serial][$envKey_crc] = 0;
				self::$env_name_ARRAY[$config_serial][$envKey_crc] = $envKey_crc;

                $this->error_log('storing environment ['.$envKey.'|'.$envKey_crc.'] in memory.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

			}else{
				
				//
				// 	THIS KEY HAS ALREADY BEEN INITIALIZED
                $this->error_log('ERROR :: there are duplicate environment keys being passed to addEnvironment().', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

				throw new Exception('CRNRSTN initialization warning :: This environmental key ('.$envKey.'|'.$envKey_crc.') has already been initialized.');

			}

		}catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

		}
    }

    public function initLogging_details($envKey, $output_profile_key, $output_profile_data = NULL){

        self::$sys_logging_update_profile_ARRAY[$this->crcINT($this->config_serial)][$this->crcINT($envKey)][] = $output_profile_key;
        self::$sys_logging_update_endpoint_ARRAY[$this->crcINT($this->config_serial)][$this->crcINT($envKey)][] = $output_profile_data;

        return true;

    }

    public function init_logging($envKey, $CRNRSTN_loggingProfile = CRNRSTN_LOG_DEFAULT, $CRNRSTN_loggingMeta = NULL){

        //
        // PROCESS BITWISE DATA DO THIS AFTER ENVIRONMENTAL DETECTION
        //$this->oCRNRSTN_BITFLIP_MGR->oCRNRSTN_BITWISE->set($CRNRSTN_loggingProfile, true);
       // error_log(__LINE__.' '.__METHOD__.' crnrstn_environment to receive logging array['.$this->crcINT($this->config_serial).']['.$this->crcINT($envKey).']=['.$CRNRSTN_loggingProfile.']');
        self::$sys_logging_profile_ARRAY[$this->crcINT($this->config_serial)][$this->crcINT($envKey)][] = $CRNRSTN_loggingProfile;

        if(isset($CRNRSTN_loggingMeta)){

            self::$sys_logging_meta_ARRAY[$this->crcINT($this->config_serial)][$this->crcINT($envKey)][] = $CRNRSTN_loggingMeta;

        }else{

            self::$sys_logging_meta_ARRAY[$this->crcINT($this->config_serial)][$this->crcINT($envKey)][] = '0';

        }

        //
        // PROCESS META DATA
        $this->error_log('Logging profile data has been received for ['.$envKey.'].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        return true;

    }

    public function return_logging_profile($envKey){

        return self::$sys_logging_profile_ARRAY[$this->crcINT($this->config_serial)][$envKey];

    }

    public function return_logging_meta($envKey){

        return self::$sys_logging_meta_ARRAY[$this->crcINT($this->config_serial)][$envKey];

    }

    public function _____initLogging($envKey, $loggingProfilePipe=NULL, $loggingEndpointPipe=NULL, $wcrProfilePipe=NULL){

        if(isset($loggingProfilePipe)){

            if($loggingProfilePipe!=''){

                $tmp_str_append = ' to the pipe profile of ['.$loggingProfilePipe.']';

                self::$sys_logging_profile_ARRAY[$this->crcINT($this->config_serial)][$this->crcINT($envKey)][] = $this->break_piped_str_to_array($loggingProfilePipe, 'strtoupper', 'trim');

                if(isset($loggingEndpointPipe)){

                    if($loggingEndpointPipe!=''){

                        $tmp_str_append .= ' and the endpoint of [##### REDACTED #####]';

                        self::$sys_logging_endpoint_ARRAY[$this->crcINT($this->config_serial)][$this->crcINT($envKey)][] = $this->break_piped_str_to_array($loggingEndpointPipe, NULL, 'trim');

                    }
                }

                if(isset($wcrProfilePipe)){

                    if($wcrProfilePipe!=''){

                        $tmp_str_append .= ' and Wild Card Resource key to '.$wcrProfilePipe;

                        self::$sys_logging_wcr_ARRAY[$this->crcINT($this->config_serial)][$this->crcINT($envKey)][] = $this->break_piped_str_to_array($wcrProfilePipe, NULL, 'trim');

                    }
                }

                $tmp_str_append .= '.';
                $this->error_log('Logging profile initialization data received for ['.$envKey.']'.$tmp_str_append, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

            }

        }
		
		return true;

	}
	
	public function grant_exclusive_access($envKey, $ipOrFile){

		$this->grant_accessIP_ARRAY[$this->crcINT($this->config_serial)][$this->crcINT($envKey)] = $ipOrFile;

		$this->error_log('storing grant_exclusive_access IP profile ['.$ipOrFile.'] in memory for environment key ['.$envKey.'].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

		return true;

	}
	
	public function deny_access($envKey, $ipOrFile){

        //$this->hello_world('of_exception!');

        $this->deny_accessIP_ARRAY[$this->crcINT($this->config_serial)][$this->crcINT($envKey)] = $ipOrFile;

        $this->error_log('storing deny_access IP profile ['.$ipOrFile.'] in memory for environment key ['.$envKey.'].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

		return true;

	}

    public function returnConfigSerial(){

        return $this->config_serial;

    }

    public function returnDbType($type_id=0){

        try{

            $databaseExtensionTypes = array(0 => 'MySQLi', 1 => 'MySQL', 2 => 'PostGreSQL', 3 => 'SYBASE', 4 => 'IBM-DB2', 5 => 'Oracle Database');

            if(isset($databaseExtensionTypes[$type_id])){

                return $databaseExtensionTypes[$type_id];

            }else{

                $this->error_log('ERROR :: returnDbType() is being called with reference to a value('.$type_id.') that is outside permissible range of [0-5].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                throw new Exception('CRNRSTN :: initialization warning :: returnDbType() is being called with reference to a value('.$type_id.') that is outside permissible range of [0-5]');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function specifyDatabaseExtension($envKey, $type){

        $this->error_log('crnrstn :: specifyDatabaseExtension() database type ['.$type.'] specified for environment ['.$envKey.'] on server ['.$_SERVER['SERVER_NAME'].']', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        self::$database_extension_type_ARRAY[$this->crcINT($this->config_serial)][$this->crcINT($envKey)] = $type;

    }

    public function add_database($envKey, $host_or_creds_path, $un = NULL, $pwd = NULL, $db = NULL, $port = NULL){
		
		//
		// HANDLE PATH TO DATABASE CONFIG FILE (E.G. ONLY 2 PARAMS PROVIDED)
		if($db==NULL){

			if(is_file($host_or_creds_path)){

				//
				// EXTRACT DATABASE CONFIGURATION FROM FILE
                $this->error_log('addDatabase() for environment ['.$envKey.']. including and evaluating file ['.$host_or_creds_path.'].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                include_once($host_or_creds_path);
				
			}else{

				//
				// WE COULD NOT FIND THE DATABASE CONFIGURATION FILE
                $this->error_log('NOTICE :: addDatabase() $host parameter not recognized as a file for environment ['.$envKey.'] on server ['.$_SERVER['SERVER_NAME'].'] value-> ['.$host_or_creds_path.'].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

			}

		}else{
			
			//
			// SEND DATABASE CONFIGURATION PARAMETERS TO THE CONNECTION MANAGER
            $this->error_log('addDatabase() for environment ['.$envKey.'] sending database authentication profile [db->##### REDACTED ##### | un->##### REDACTED ##### |...etc.] to connection manager.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

			$this->oMYSQLI_CONN_MGR->addConnection($envKey, $host_or_creds_path, $un, $pwd, $db, $port);

		}
		
		return true;

	}

	public function add_administration($envKey, $email_or_creds_path, $pwd = NULL, $ttl = 120, $max_login_attempts = 10){

        //
        // HANDLE PATH TO DATABASE CONFIG FILE (E.G. ONLY 2 PARAMS PROVIDED)
        if($pwd == NULL){

            if(is_file($email_or_creds_path)){

                //
                // EXTRACT ADMINISTRATIVE CONFIGURATION FROM FILE
                $this->error_log('addAdministration() for environment ['.$envKey.']. including and evaluating file ['.$email_or_creds_path.'].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                include_once($email_or_creds_path);

            }else{

                //
                // WE COULD NOT FIND THE ADMINISTRATIVE CONFIGURATION FILE
                $this->error_log('NOTICE :: addAdministration() $email parameter not recognized as a file for environment ['.$envKey.'] on server ['.$_SERVER['SERVER_NAME'].'] value-> ['.$email_or_creds_path.'].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

            }

        }else{

            //
            // STORE ADMINISTRATOR CONFIGURATION PARAMETERS
            $this->error_log('addAdministration() for environment ['.$envKey.'] storing Administrative authentication profile [email->'.$this->strSanitize($email_or_creds_path, 'email_private').'| pwd->##### REDACTED ##### |$ttl->'.$ttl.'|$max_login_attempts->'.$max_login_attempts.'.] within CRNRSTN ::.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

            $this->add_administrator($envKey, $email_or_creds_path, $pwd, $ttl, $max_login_attempts);

        }

        return true;

    }

    public function set_max_login_attempts($envKey, $max_login_attempts){

        $this->add_admin_creds_ARRAY[$this->crcINT($this->config_serial)][$this->crcINT($envKey)]['max_login_attempts'][] = $max_login_attempts;

    }

    public function set_timeout_user_inactive($envKey, $secs){

        $this->add_admin_creds_ARRAY[$this->crcINT($this->config_serial)][$this->crcINT($envKey)]['seconds_inactive'][] = $secs;

    }

    private function add_administrator($envKey, $email, $pwd, $ttl){

        $this->add_admin_creds_ARRAY[$this->crcINT($this->config_serial)][$this->crcINT($envKey)]['email'][] = $email;
        $this->add_admin_creds_ARRAY[$this->crcINT($this->config_serial)][$this->crcINT($envKey)]['pwdhash'][] = md5($pwd);
        $this->add_admin_creds_ARRAY[$this->crcINT($this->config_serial)][$this->crcINT($envKey)]['ttl'][] = $ttl;

        $this->error_log('add_administrator() storing administrative credential profile information for email ['.$this->strSanitize($email, 'email_private').'] in memory for environment key ['.$envKey.'].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        return true;

    }

	public function required_detection_matches($value=''){
		
		//
		// HOW MANY SERVER KEYS ARE REQUIRED TO MATCH IN ORDER TO SUCCESSFULLY 
		// CONFIGURE CRNRSTN TO MATCH WITH ONE ENVIRONMENT
		if($value==''){
			
			//
			// WE WANT THE ENVIRONMENT WITH MOST MATCHES. DELAY ENV DETECTION UNTIL INSTANTIATION OF ENV CLASS OBJECT
			self::$envDetectRequiredCnt = NULL;

            $this->error_log('required_detection_matches will autodetect environment CRNRSTN profile with strongest correlation to _SERVER params.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

		}else{
			
			//
			// NON-ZERO VALUE HAS BEEN RECIEVED. THE ENV CONFIG THAT MEETS THIS REQUIREMENT FIRST IS USED FOR ENV INITIALIZATION
			self::$envDetectRequiredCnt = $value - 0;

            $this->error_log('required_detection_matches set to ['.self::$envDetectRequiredCnt.'] in memory.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

		}
		
		return true;

	}
	
	public function define_env_resource($envKey, $key, $value){

		try{

			if($envKey=="" || $key==""){

                $this->error_log('ERROR ::  attempt to define_env_resource() but missing required parameters of env and/or key.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

				throw new Exception('CRNRSTN initialization ERROR :: define_env_resource was called but was missing parameter information and so was not able to be initialized. envKey and resourceKey are required. envKey['.$envKey.'] resourceKey['.$key.']');
				
			}else{

				if(self::$serverAppKey[$this->crcINT($this->config_serial)]=="" || $this->crcINT($envKey)==self::$serverAppKey[$this->crcINT($this->config_serial)] || $envKey=="*"){

                    $this->error_log('defining resource ['.$key.'] with value ['.$value.'] for environment ['.$envKey.'] in memory.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

					$this->addEnvResource($this->crcINT($this->config_serial), $this->crcINT($envKey), trim($key), trim($value));

				}

			}
		
		}catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

		}
		
	}
	
	public function addEnvResource($config_serial, $envKey, $key, $value) {

		self::$handle_resource_ARRAY[$config_serial][$envKey][$key] = $value;
		
		//
		// FOR FASTEST DISCOVERY, RUN ENVIRONMENTAL DETECTION IN PARALLEL WITH INITIALIZATION OF RESOURCE DEFINITIONS.
		// THIS MEANS THERE SHOULD/WOULD BE A NON-NULL / NON ZERO INTEGER PASSED TO $oCRNRSTN->required_detection_matches(2) IN THE
		// CRNRSTN CONFIG FILE. OTHERWISE, WE MUST TRAVERSE ALL ENV CONFIG DEFINITIONS AND THEN TAKE BEST FIT PER SERVER SETTINGS.
		if($this->detectServerEnv($config_serial, $envKey, $key, $value)){
			
			//
			// IF NULL/ZED COUNT, HOLD OFF ON DEFINING APPLICATION ENV KEY UNTIL ALL ENV RESOURCES HAVE BEEN 
			// PROCESSED...E.G. WAIT FOR ENV INSTANTIATION OF CLASS OBJECT BEFORE DETECTING ENVIRONMENT.
			if((self::$env_select_ARRAY[$config_serial] != "" && $envKey == self::$env_select_ARRAY[$config_serial]) || self::$env_select_ARRAY[$config_serial]==""){

				if(self::$envDetectRequiredCnt > 0 && self::$serverAppKey[$config_serial]==''){

					self::$serverAppKey[$config_serial] = $envKey;

                    $this->error_log('environmental detection complete. setting application server app key for CRNRSTN config serial ['.$config_serial.'] to ['.$envKey.'].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

				}
			}
		}
    }
	
	private function detectServerEnv($config_serial, $envKey, $key, $value) {
	
		//
		// CHECK THE ENVIRONMENTAL DETECTION KEYS FOR MATCHES AGAINST THE SERVER CONFIGURATION
		if(array_key_exists($key, $_SERVER)){

            $this->error_log('we have a SERVER param ['.$key.'] to check value ['.$value.'] for match against actual SERVER[].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

			return $this->isServerKeyMatch($config_serial, $envKey, $key, $value);

		}else{

			return false;

		}
	}
	
	private function isServerKeyMatch($config_serial, $envKey, $key, $value){
		
		//
		// RUN VALUE COMPARISON FOR INCOMING VALUE AND DATA FROM THE SERVERS' SUPER GLOBAL VARIABLE ARRAY
		if($value == $_SERVER[$key]){
			
			//
			// INCREMENT FOR EACH MATCH. 
			self::$env_detect_ARRAY[$config_serial][$envKey]++;
            $this->error_log('SERVER match found for key ['.$key.'] with value ['.$value.'] Increment detection count ['.self::$env_detect_ARRAY[$config_serial][$envKey].'] for environment ['.$envKey.']. Need ['.self::$envDetectRequiredCnt.'] matches to detect environment (if 0, then must process all config data).', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

		}
		
		//
		// FIRST $ENV TO REACH $envDetectRequiredCnt...YOU KNOW YOU HAVE QUALIFIED MATCH.
		if(self::$env_detect_ARRAY[$config_serial][$envKey] >= self::$envDetectRequiredCnt && self::$envDetectRequiredCnt>0){
			
			//
			// WE HAVE AN ENVIRONMENTAL DEFINITION WITH A SUFFICIENT NUMBER OF SUCCESSFUL MATCHES TO THE RUNNING ENVIRONMENT 
			// AS DEFINED BY THE CRNRSTN CONFIG FILE
			self::$env_select_ARRAY[$config_serial] = $envKey;

            $this->error_log('environmental detection complete. CRNRSTN selected environmental profile ['.$envKey.'] running with CRNRSTN serialization of ['.$config_serial.'] and phpsession['.session_id().'].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

			return true;

		}else{
			
			//
			// EVIDENCE OF A MATCH...STILL NOT SUFFICIENT
			return false;

		}
	}
	
	public function init_session_encryption($envKey, $encryptCipher, $encryptSecretKey, $encryptOptions, $hmac_alg){

	    try{

			if($envKey=="" || $encryptCipher=="" || $encryptSecretKey=="" || $hmac_alg==""){

                $this->error_log('ERROR :: missing required information to configure initSessionEncryption().', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

				throw new Exception('CRNRSTN initialization ERROR :: initSessionEncryption was called but was missing parameter information and so session encryption was not able to be initialized. Some parameters are required. env['.$envKey.'] encryptCipher['.$encryptCipher.'] encryptSecretKey[##### REDACTED #####] (optional)encryptOptions['.$encryptOptions.'] hmac_alg['.$hmac_alg.']');
				
			}else{

				$this->opensslSessEncryptCipher[$this->crcINT($this->config_serial)][$this->crcINT($envKey)] = $encryptCipher;
				$this->opensslSessEncryptSecretKey[$this->crcINT($this->config_serial)][$this->crcINT($envKey)] = $encryptSecretKey;
				$this->opensslSessEncryptOptions[$this->crcINT($this->config_serial)][$this->crcINT($envKey)] = $encryptOptions;
				$this->sessHmac_algorithm[$this->crcINT($this->config_serial)][$this->crcINT($envKey)] = $hmac_alg; #
                $this->error_log('session encryption initialized for environment ['.$envKey.'] to cipher [##### REDACTED #####] and hmac algorithm [##### REDACTED #####].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

				return true;

			}
			
		}catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

			return false;

	    }
	}
	
	public function init_cookie_encryption($envKey, $encryptCipher, $encryptSecretKey, $encryptOptions, $hmac_alg){

	    try{

			if($envKey=="" || $encryptCipher=="" || $encryptSecretKey=="" || $hmac_alg==""){

                $this->error_log('ERROR :: missing required information to configure init_cookie_encryption().', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

				throw new Exception('CRNRSTN initialization ERROR :: init_cookie_encryption was called but was missing parameter information and so cookie encryption was not able to be initialized. Some parameters are required. env['.$envKey.'] encryptCipher['.$encryptCipher.'] encryptSecretKey[xxx] (optional)encryptOptions['.$encryptOptions.'] hmac_alg['.$hmac_alg.']');
				
			}else{
				
				$this->opensslCookieEncryptCipher[$this->crcINT($this->config_serial)][$this->crcINT($envKey)] = $encryptCipher;
				$this->opensslCookieEncryptSecretKey[$this->crcINT($this->config_serial)][$this->crcINT($envKey)] = $encryptSecretKey;
				$this->opensslCookieEncryptOptions[$this->crcINT($this->config_serial)][$this->crcINT($envKey)] = $encryptOptions;
				$this->cookieHmac_algorithm[$this->crcINT($this->config_serial)][$this->crcINT($envKey)] = $hmac_alg;
                $this->error_log('cookie encryption initialized for environment ['.$envKey.'] to cipher [##### REDACTED #####] and hmac algorithm [##### REDACTED #####].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

				return true;

			}
			
		}catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

			return false;

		}
	} 
	
	public function init_tunnel_encryption($envKey, $encryptCipher, $encryptSecretKey, $encryptOptions, $hmac_alg){

	    try{

			if($envKey=="" || $encryptCipher=="" || $encryptSecretKey=="" || $hmac_alg==""){

                $this->error_log('ERROR :: missing required information to configure init_tunnel_encryption().', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                throw new Exception('CRNRSTN initialization ERROR :: init_tunnel_encryption was called but was missing parameter information and so tunnel encryption was not able to be initialized. Some parameters are required. env['.$envKey.'] encryptCipher['.$encryptCipher.'] encryptSecretKey[##### REDACTED #####] (optional)encryptOptions['.$encryptOptions.'] hmac_alg['.$hmac_alg.']');
				
			}else{
				
				$this->opensslTunnelEncryptCipher[$this->crcINT($this->config_serial)][$this->crcINT($envKey)] = $encryptCipher;
				$this->opensslTunnelEncryptSecretKey[$this->crcINT($this->config_serial)][$this->crcINT($envKey)] = $encryptSecretKey;
				$this->opensslTunnelEncryptOptions[$this->crcINT($this->config_serial)][$this->crcINT($envKey)] = $encryptOptions;
				$this->tunnelHmac_algorithm[$this->crcINT($this->config_serial)][$this->crcINT($envKey)] = $hmac_alg;
                $this->error_log('tunnel encryption initialized for environment ['.$envKey.'] to cipher [##### REDACTED #####] and hmac algorithm [##### REDACTED #####].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

				return true;

			}
			
		}catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

			return false;

	    }
	} 
	
	public function setServerEnv(){

		self::$serverAppKey[$this->crcINT($this->config_serial)] = $_SESSION['CRNRSTN_' . $this->crcINT($this->config_serial)]['CRNRSTN_RESOURCE_KEY'];

        $this->error_log('detected server environment [' . self::$serverAppKey[$this->crcINT($this->config_serial)].'] pulled from session['.session_id().'] memory (not the config file) and used to reinitialize CRNRSTN :: in private static array.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

		return $_SESSION['CRNRSTN_' . $this->crcINT($this->config_serial)]['CRNRSTN_RESOURCE_KEY'];
		
	}
	
	public function getServerEnv() {
		
		//
		// DID WE DETERMINE ENVIRONMENT KEY THROUGH INITIALIZATION OF CRNRSTN? IF SO, THIS PARAMETER WILL BE SET. JUST USE IT.
		if(self::$serverAppKey[$this->crcINT($this->config_serial)] != ""){

            $this->error_log('detected server environment ['.self::$serverAppKey[$this->crcINT($this->config_serial)].'] returned from private static array.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

			return self::$serverAppKey[$this->crcINT($this->config_serial)];

		}else{
		
			//
			// SINCE ENV NOT DETERMINED THROUGH INITIAL INITIALIZATION, NEXT CHECK FOR  
			if(!(self::$envDetectRequiredCnt > 0)){
				
				//
				// RETURN SERVER APPLICATION KEY BASED UPON A BEST FIT SCENARIO. FOR ANY TIES...FIRST COME FIRST SERVED.
				foreach (self::$handle_resource_ARRAY as $serial=>$resource_ARRAY) {

					foreach($resource_ARRAY as $env=>$key){

						if(isset(self::$env_detect_ARRAY[$serial][$env])){

							if(self::$env_detect_ARRAY[$serial][$env] > 0){

								if(self::$envMatchCount < self::$env_detect_ARRAY[$serial][$env]){

									self::$envMatchCount = self::$env_detect_ARRAY[$serial][$env];
									self::$serverAppKey[$serial] = $env;

                                    $this->error_log('attempting to detect running environment. environment ['.$env.'] is new detection leader having ['.self::$envMatchCount.'] SERVER matches.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

								}
							}
						}
					}
				}
			}

			try{
				
				//
				// WE SHOULD HAVE THIS VALUE BY NOW. IF EMPTY, HOOOSTON...VE HAF PROBLEM!
				if(self::$serverAppKey[$this->crcINT($this->config_serial)] == ""){

                    $this->error_log('ERROR :: we have processed ALL defined environmental resources and were unable to detect running environment with CRNRSTN config serial ['.$this->config_serial.'].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                    //
                    // HOOOSTON...VE HAF PROBLEM!
					throw new Exception('CRNRSTN initialization error :: Environmental detection failed to match a sufficient number of parameters (apparently, finding '.self::$envDetectRequiredCnt.' $_SERVER matches was too hard) to your servers configuration to successfully initialize CRNRSTN on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')');

				}
			
			}catch( Exception $e ) {

                //
                // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
                $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

                //
				// RETURN FALSE
				return false;

			}

            $this->error_log('returning detected environment ['.self::$serverAppKey[$this->crcINT($this->config_serial)].'] as the selected running environment.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

			return self::$serverAppKey[$this->crcINT($this->config_serial)];

		}
	}
	
	public function getHandle_resource_ARRAY(){

		return 	self::$handle_resource_ARRAY;
		
	}

	public function getDebugMode(){
		
		return $this->CRNRSTN_debugMode;

	}
	
	public function getStartTime(){
		
		return $this->starttime;

	}

    public function wall_time(){

        $timediff = $this->microtime_float() - $this->starttime;

        return substr($timediff,0,-8);

    }

    public function return_loggingProfile(){

        return $this->log_initial_profile_ARRAY;

    }

    public function return_endpointProfile(){

        return $this->log_initial_profile_meta_ARRAY;

    }

    //
    // METHOD TAKEN FROM NUSOAP.PHP - http://sourceforge.net/projects/nusoap/
    /**
     * returns the time in ODBC canonical form with microseconds
     *
     * @return string The time in ODBC canonical form with microseconds
     * @access public
     */
	private function microtime_float(){

	    //list($usec, $sec) = explode(" ", microtime());
	    //return ((float)$usec + (float)$sec);

        if (function_exists('gettimeofday')) {
            $tod = gettimeofday();
            $sec = $tod['sec'];
            $usec = $tod['usec'];
        } else {
            $sec = time();
            $usec = 0;
        }

        return $sec. '.' . sprintf('%06d', $usec);

	}

    public function get_micro_time(){

        return $this->oLogger->returnMicroTime();

    }

    public function chunkPageData($tmp_page_content, $max_len){

        $oChunkRestrictData = new crnrstn_chunk_restrictor($tmp_page_content, $max_len, $this);

        return $oChunkRestrictData;

    }

    //
    // METHOD SOURCE :: Stack Overflow ::  https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
    // Contributor :: https://stackoverflow.com/users/1698153/scott
    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function generate_new_key($len = 32, $char_selection = NULL){

        $token = "";

        if(isset($char_selection)){

            $codeAlphabet = $char_selection;

            $max = strlen($codeAlphabet); // edited

            if (function_exists('random_int')) {

                for ($i = 0; $i < $len; $i++) {

                    $token .= $codeAlphabet[random_int(0, $max - 1)];

                }

            } else {

                for ($i = 0; $i < $len; $i++) {

                    $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max - 1)];

                }

            }

        }else{

            $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
            $codeAlphabet .= "0123456789";

            $max = strlen($codeAlphabet); // edited

            if (function_exists('random_int')) {

                for ($i = 0; $i < $len; $i++) {

                    $token .= $codeAlphabet[random_int(0, $max - 1)];

                }

            } else {

                for ($i = 0; $i < $len; $i++) {

                    $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max - 1)];

                }

            }

        }

        return $token;

    }

    //
    // METHOD SOURCE :: Stack Overflow :: https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
    // Contributor :: https://stackoverflow.com/users/4895359/yumoji
    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    private function crypto_rand_secure($min, $max){
        $range = $max - $min;
        if ($range < 1) return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int)($log / 8) + 1; // length in bytes
        $bits = (int)$log + 1; // length in bits
        $filter = (int)(1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);
        return $min + $rnd;
    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function elapsed_delta_time_for($watchKey, $decimal = 8){

        return $this->monitoringDeltaTimeFor($watchKey, $decimal);

    }

    public function monitoringDeltaTimeFor($watchKey, $decimal=8){

        if(!isset(self::$m_starttime[$watchKey])){

            self::$m_starttime[$watchKey] = $this->microtime_float();

            $timediff = self::$m_starttime[$watchKey] - self::$m_starttime[$watchKey];

            $len = $decimal * -1;

            return substr($timediff,0, $len);

            //return 0.0;

        }else{

            $timediff = $this->microtime_float() - self::$m_starttime[$watchKey];

            $len = $decimal * -1;

            return substr($timediff,0, $len);

            //return substr($timediff,0,-8);

        }

    }

    public function return_pretty_delta_time($delta_secs, $microsecs=0, $mode='ELAPSED_VERBOSE'){

        $microsecs = '0.'.$microsecs;
        switch($mode){
            case 'ELAPSED':

                $tmp_output = $this->elapsed($delta_secs, $microsecs);

                break;
            case 'ELAPSED_VERBOSE':

                $tmp_output = $this->elapsed_verbose($delta_secs, $microsecs);

                break;

        }

        return $tmp_output;

    }

    # SOURCE :: http://php.net/manual/en/function.time.php
    private function elapsed_from_current($secs){
        $ts = time();
        $delta_secs = $ts-$secs;

        $bit = array(
            self::$lang_content_ARRAY['Y'] => $delta_secs / 31556926 % 12,
            self::$lang_content_ARRAY['W'] => $delta_secs / 604800 % 52,
            self::$lang_content_ARRAY['D'] => $delta_secs / 86400 % 7,
            self::$lang_content_ARRAY['H'] => $delta_secs / 3600 % 24,
            self::$lang_content_ARRAY['M'] => $delta_secs / 60 % 60,
            self::$lang_content_ARRAY['S'] => $delta_secs % 60
        );

        //
        // LET'S CONFIRM LANG OPERATION
        //error_log("(146) Y->".self::$lang_content_ARRAY['Y']);      // shows 1...not y...

        foreach($bit as $k => $v){
            if($v > 0){
                //
                // PUT IN CURFEW FOR TIME GRANULARITY
                if($k==self::$lang_content_ARRAY['Y'] || $k==self::$lang_content_ARRAY['W'] || ($k==self::$lang_content_ARRAY['D'] && $v>1)){

                    //
                    // RETURN DEFAULT DATE FORMAT
                    if(isset($format_override)){

                        return date($format_override, $secs);

                    }else{

                        return date("m.d.Y @ H:i:s", $secs);
                    }

                }else{
                    $ret[] = $v . $k;
                }
            }
        }

        if(!isset($ret)){
            $ret[] = 'just now.';
        }else{
            if(sizeof($ret)==0){

                $ret[] = 'just now.';
            }else{
                $ret[] = self::$lang_content_ARRAY['AGO'];
            }
        }

        return join(' ', $ret);

    }

    private function elapsed($delta_secs, $microsecs=0){

        $bit = array(
            self::$lang_content_ARRAY['Y'] => $delta_secs / 31556926 % 12,
            self::$lang_content_ARRAY['W'] => $delta_secs / 604800 % 52,
            self::$lang_content_ARRAY['D'] => $delta_secs / 86400 % 7,
            self::$lang_content_ARRAY['H'] => $delta_secs / 3600 % 24,
            self::$lang_content_ARRAY['M'] => $delta_secs / 60 % 60,
            self::$lang_content_ARRAY['S'] => ($delta_secs % 60) + $microsecs
        );

        //
        // LET'S CONFIRM LANG OPERATION
        //error_log("(146) Y->".self::$lang_content_ARRAY['Y']);      // shows 1...not y...

        foreach($bit as $k => $v){
            if($v > 0){
                //
                // PUT IN CURFEW FOR TIME GRANULARITY
                if($k==self::$lang_content_ARRAY['Y'] || $k==self::$lang_content_ARRAY['W'] || ($k==self::$lang_content_ARRAY['D'] && $v>1)){

                    //
                    // RETURN DEFAULT DATE FORMAT
                    if(isset($format_override)){

                        return date($format_override, $delta_secs);

                    }else{

                        return date("m.d.Y @ H:i:s", $delta_secs);
                    }

                }else{
                    $ret[] = $v . $k;
                }
            }
        }

        if(!isset($ret)){
            $ret[] = 'just now.';
        }else{
            if(sizeof($ret)==0){

                $ret[] = 'just now.';
            }else{
                $ret[] = self::$lang_content_ARRAY['AGO'];
            }
        }

        return join(' ', $ret);

    }

    # SOURCE :: http://php.net/manual/en/function.time.php
    private function elapsed_verbose($delta_secs, $microsecs=0){

        //
        // THIS SHOULD BE EXPOSED TO THE LANGUAGE ENGINE OF THE EVIFWEB CLIENT EXTRANET. NOT HARD CODED ENGLISH....OH MY. WHAT A REQUIREMENT THIS IS.
        // RE-CRNRSTN, IT MAY NOT BE APPROPRIATE TO PUSH LANG CONSIDERATIONS. WELL, MAYBE....THIS WOULD BE A FIRST FOR CRNRSTN...
        // I DON'T WANT TO PROCEED UNTIL I AM CLEAR ABOUT LANG SUPPORT DIRECTION FOR THIS. THERE ARE IMPLICATIONS.
        // TO REALLY TAKE CARE OF THE PEOPLE, DON'T FORGET SINGULAR AND PLURAL SUPPORT FOR MULTIPLE LANG...SO 2x THE NUMBER OF FORMATS...

        //
        // WE NEED TO APPROACH THIS DIFFERENTLY TO ALLOW FOR PLURAL
        $bit = array(
            '0'        => $delta_secs / 31556926 % 12,
            '1'        => $delta_secs / 604800 % 52,
            '2'        => $delta_secs / 86400 % 7,
            '3'        => $delta_secs / 3600 % 24,
            '4'        => $delta_secs / 60 % 60,
            '5'        => ($delta_secs % 60) + $microsecs
        );

        $bit_singular = array(
            '0'     => ' '.self::$lang_content_ARRAY['YEAR'],
            '1'     => ' '.self::$lang_content_ARRAY['WEEK'],
            '2'     => ' '.self::$lang_content_ARRAY['DAY'],
            '3'     => ' '.self::$lang_content_ARRAY['HOUR'],
            '4'     => ' '.self::$lang_content_ARRAY['MINUTE'],
            '5'     => ' '.self::$lang_content_ARRAY['SECOND']
        );

        $bit_plural = array(
            '0'     => ' '.self::$lang_content_ARRAY['YEARS'],
            '1'     => ' '.self::$lang_content_ARRAY['WEEKS'],
            '2'     => ' '.self::$lang_content_ARRAY['DAYS'],
            '3'     => ' '.self::$lang_content_ARRAY['HOURS'],
            '4'     => ' '.self::$lang_content_ARRAY['MINUTES'],
            '5'     => ' '.self::$lang_content_ARRAY['SECONDS']
        );

        foreach($bit as $k => $v){
            if($v > 1){
                $ret[] = $v . $bit_plural[$k];
                //error_log("finite (194) test ->".$bit_plural[$k]);

            }else{

                if($v == 1){
                    $ret[] = $v . $bit_singular[$k];
                    //error_log("finite (200) test ->".$bit_singular[$k]);
                }
            }
        }

//        foreach($bit_singular as $k => $v){
//            if($v > 1)$ret[] = $v . $k . 's';           // APPENDING AN S FOR PLURAL IS PRIMARILY ENGLISH. WE CAN'T RELY ON THIS APPEND OUR PURPOSES.
//            if($v == 1)$ret[] = $v . $k;
//        }

        if(isset($ret)){

            array_splice($ret, count($ret)-1, 0, self::$lang_content_ARRAY['AND']);

            $tmp_output = trim(join(' ', $ret));

            $tmp_output = ltrim($tmp_output, 'and');

        }else{

            $tmp_output = $this->wall_time();

            $tmp_output .= ' secs';

        }

        return $tmp_output;

    }

    private function elapsed_verbose_from_current($secs){
        $ts = time();
        $delta_secs = $ts-$secs;

        //
        // THIS SHOULD BE EXPOSED TO THE LANGUAGE ENGINE OF THE EVIFWEB CLIENT EXTRANET. NOT HARD CODED ENGLISH....OH MY. WHAT A REQUIREMENT THIS IS.
        // RE-CRNRSTN, IT MAY NOT BE APPROPRIATE TO PUSH LANG CONSIDERATIONS. WELL, MAYBE....THIS WOULD BE A FIRST FOR CRNRSTN...
        // I DON'T WANT TO PROCEED UNTIL I AM CLEAR ABOUT LANG SUPPORT DIRECTION FOR THIS. THERE ARE IMPLICATIONS.
        // TO REALLY TAKE CARE OF THE PEOPLE, DON'T FORGET SINGULAR AND PLURAL SUPPORT FOR MULTIPLE LANG...SO 2x THE NUMBER OF FORMATS...

        //
        // WE NEED TO APPROACH THIS DIFFERENTLY TO ALLOW FOR PLURAL
        $bit = array(
            '0'        => $delta_secs / 31556926 % 12,
            '1'        => $delta_secs / 604800 % 52,
            '2'        => $delta_secs / 86400 % 7,
            '3'        => $delta_secs / 3600 % 24,
            '4'        => $delta_secs / 60 % 60,
            '5'        => $delta_secs % 60
        );

        $bit_singular = array(
            '0'     => ' '.self::$lang_content_ARRAY['YEAR'],
            '1'     => ' '.self::$lang_content_ARRAY['WEEK'],
            '2'     => ' '.self::$lang_content_ARRAY['DAY'],
            '3'     => ' '.self::$lang_content_ARRAY['HOUR'],
            '4'     => ' '.self::$lang_content_ARRAY['MINUTE'],
            '5'     => ' '.self::$lang_content_ARRAY['SECOND']
        );

        $bit_plural = array(
            '0'     => ' '.self::$lang_content_ARRAY['YEARS'],
            '1'     => ' '.self::$lang_content_ARRAY['WEEKS'],
            '2'     => ' '.self::$lang_content_ARRAY['DAYS'],
            '3'     => ' '.self::$lang_content_ARRAY['HOURS'],
            '4'     => ' '.self::$lang_content_ARRAY['MINUTES'],
            '5'     => ' '.self::$lang_content_ARRAY['SECONDS']
        );

        foreach($bit as $k => $v){
            if($v > 1){
                $ret[] = $v . $bit_plural[$k];
                //error_log("finite (194) test ->".$bit_plural[$k]);

            }else{

                if($v == 1){
                    $ret[] = $v . $bit_singular[$k];
                    //error_log("finite (200) test ->".$bit_singular[$k]);
                }
            }
        }

//        foreach($bit_singular as $k => $v){
//            if($v > 1)$ret[] = $v . $k . 's';           // APPENDING AN S FOR PLURAL IS PRIMARILY ENGLISH. WE CAN'T RELY ON THIS APPEND OUR PURPOSES.
//            if($v == 1)$ret[] = $v . $k;
//        }

        array_splice($ret, count($ret)-1, 0, self::$lang_content_ARRAY['AND']);
        $ret[] = self::$lang_content_ARRAY['AGO'];

        return join(' ', $ret);

    }

    public function return_lang_content_ARRAY(){

        return self::$lang_content_ARRAY;

    }

    private function initialize_language(){

        self::$lang_content_ARRAY['YEAR'] = 'year';
        self::$lang_content_ARRAY['YEARS'] = 'years';
        self::$lang_content_ARRAY['Y'] = 'y';
        self::$lang_content_ARRAY['WEEK'] = 'week';
        self::$lang_content_ARRAY['WEEKS'] = 'weeks';
        self::$lang_content_ARRAY['W'] = 'w';
        self::$lang_content_ARRAY['DAY'] = 'day';
        self::$lang_content_ARRAY['DAYS'] = 'days';
        self::$lang_content_ARRAY['D'] = 'd';
        self::$lang_content_ARRAY['HOUR'] = 'hour';
        self::$lang_content_ARRAY['HOURS'] = 'hours';
        self::$lang_content_ARRAY['H'] = 'h';
        self::$lang_content_ARRAY['MINUTE'] = 'minute';
        self::$lang_content_ARRAY['MINUTES'] = 'minutes';
        self::$lang_content_ARRAY['M'] = 'm';
        self::$lang_content_ARRAY['SECOND'] = 'second';
        self::$lang_content_ARRAY['SECONDS'] = 'seconds';
        self::$lang_content_ARRAY['S'] = 's';
        self::$lang_content_ARRAY['AND'] = 'and';
        self::$lang_content_ARRAY['AGO'] = 'ago';

        #error_log("finite (101)->".print_r(self::$lang_content_ARRAY['WEEKS']));

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function get_resource($resourceKey, $wildCardResourceKey){

        return $this->getEnvParam($resourceKey, $wildCardResourceKey);

    }

    public function catchException($exception_obj, $syslog_constant = LOG_DEBUG, $method = NULL, $namespace = NULL, $output_profile = NULL, $output_profile_override_meta = NULL, $wcr_override_pipe = NULL){

        $tmp_err_trace_str = $this->return_PHPExceptionTracePretty($exception_obj->getTraceAsString());

        if(strlen($tmp_err_trace_str)>0){

            $this->error_log('PHP native exception output log trace received ::'.$tmp_err_trace_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        }

        //
        // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
        $this->oLogger->catchException($exception_obj, $syslog_constant, $method, $namespace, $output_profile, $output_profile_override_meta, $wcr_override_pipe, $this);

    }

    public function return_PHPExceptionTracePretty($exception_obj_trace_str, $format = 'ERROR_LOG'){

        switch($format){
            case 'HTML':

                $exception_obj_trace_str = $this->proper_replace('\n', '<br>', $exception_obj_trace_str);
                $exception_obj_trace_str = $this->proper_replace('
', '<br>', $exception_obj_trace_str);

                break;
            case 'TEXT':

                $exception_obj_trace_str = $this->proper_replace('\n', '
', $exception_obj_trace_str);

                break;
            default:

                //
                // DO NOTHING :: STRAIGHT UNPROCESSED PHP NATIVE OUT


                break;

        }

        return $exception_obj_trace_str;

    }

    public function return_logPriorityPretty($logPriority, $format='TEXT'){

        $tmp_output_format = trim(strtoupper($format));

        if($tmp_output_format == 'HTML'){
            //'LOG_EMERG</span>:: system is unusable.</span>'

            switch($logPriority){
                case 0:
                    $tmp_priority_const = 'LOG_EMERG';
                    $tmp_priority_msg = ':: system is unusable.';
                    break;
                case 1:
                    $tmp_priority_const = 'LOG_ALERT';
                    $tmp_priority_msg = ':: action must be taken immediately.';
                    break;
                case 2:
                    $tmp_priority_const = 'LOG_CRIT';
                    $tmp_priority_msg = ':: critical conditions encountered.';
                    break;
                case 3:
                    $tmp_priority_const = 'LOG_ERR';
                    $tmp_priority_msg = ':: error conditions encountered.';
                    break;
                case 4:
                    $tmp_priority_const = 'LOG_WARNING';
                    $tmp_priority_msg = ':: warning conditions encountered.';
                    break;
                case 5:
                    $tmp_priority_const = 'LOG_NOTICE';
                    $tmp_priority_msg = ':: normal, but significant, condition encountered.';
                    break;
                case 6:
                    $tmp_priority_const = 'LOG_INFO';
                    $tmp_priority_msg = ':: informational message.';
                    break;
                case 7:
                    $tmp_priority_const = 'LOG_DEBUG';
                    $tmp_priority_msg = ':: debug-level message.';
                    break;
                default:
                    $tmp_priority_const = 'UNKNOWN';
                    $tmp_priority_msg = '';
                    break;
            }

            $tmp_priority = '<span style="font-family:Arial, Helvetica, sans-serif; font-size:15px; text-align:left; color:#F90000; font-weight: bold;">'.$tmp_priority_const.'</span>&nbsp;<span style="font-family:Arial, Helvetica, sans-serif; font-size:15px; text-align:left; color:#000; font-weight: bold;">'.$tmp_priority_msg.'</span>';

        }else{

            switch($logPriority){
                case 0:
                    $tmp_priority = 'LOG_EMERG :: system is unusable.';
                    break;
                case 1:
                    $tmp_priority = 'LOG_ALERT :: action must be taken immediately';
                    break;
                case 2:
                    $tmp_priority = 'LOG_CRIT :: critical conditions encountered';
                    break;
                case 3:
                    $tmp_priority = 'LOG_ERR :: error conditions encountered';
                    break;
                case 4:
                    $tmp_priority = 'LOG_WARNING :: warning conditions encountered';
                    break;
                case 5:
                    $tmp_priority = 'LOG_NOTICE :: normal, but significant, condition encountered';
                    break;
                case 6:
                    $tmp_priority = 'LOG_INFO :: informational message';
                    break;
                case 7:
                    $tmp_priority = 'LOG_DEBUG :: debug-level message';
                    break;
                default:
                    $tmp_priority = 'UNKNOWN';
                    break;
            }

        }

        return $tmp_priority;

    }

    public function proper_replace($pattern, $replacement, $original_str){

        $pattern_array = array();
        $replacement_array = array();

        $pattern_array[0] = $pattern;
        $replacement_array[0] = $replacement;

        $original_str = str_replace($pattern_array, $replacement_array, $original_str);

        return $original_str;

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     * [EMAIL, FILE, SCREEN_TEXT, SCREEN|SCREEN_HTML, SCREEN_HTML_HIDDEN, DEFAULT]
     * LIVE WIRE
     */
    public function error_log($str, $line_num = NULL, $method = NULL, $file = NULL, $log_silo_key=NULL){

        $tmp_oLog = $this->oLogger->error_log($str, $line_num, $method, $file, $log_silo_key, $this);

        if(is_object($tmp_oLog)){

            $this->oLog_output_ARRAY[] = $tmp_oLog;

        }

        return true;

    }

    private function return_set_bits($constants_int_ARRAY){

        //$this->oCRNRSTN_BITWISE->set($integer_constant);
        //$this->oCRNRSTN_BITWISE->toggle($integer_constant);
        //$this->oCRNRSTN_BITWISE->read($integer_constant);
        //$this->oCRNRSTN_BITWISE->remove($integer_constant)
        //$this->oCRNRSTN_BITWISE->stringout()
        //$this->oCRNRSTN_BITFLIP_MGR->set($integer_constant, true);

        $tmp_array = array();

        foreach($constants_int_ARRAY as $key => $int_constant){

            if($this->oCRNRSTN_BITFLIP_MGR->is_bit_set($int_constant)){

                $tmp_array[] = $int_constant;

            }

        }

        return $tmp_array;

    }

    public function print_r_str($expression, $title=NULL, $theme_style = NULL, $line_num = NULL, $method = NULL, $file = NULL){

        if(!isset($theme_style)){

            //
            // SET A DEFAULT
            $theme_style = CRNRSTN_UI_PHPNIGHT;

            $theme_style_ARRAY = $this->return_set_bits($this->system_style_profile_constants);

            if(count($theme_style_ARRAY) > 0){

                $theme_style = $theme_style_ARRAY[0];   // FIRST MATCH

            }

        }

        $tmp_meta = '['.$this->get_micro_time().' '.date('T').'] [rtime '. $this->wall_time().' secs]';

        if(!isset($method) || $method==''){

            if(isset($file)){

                $tmp_meta .= ' [file '.$file.']';

            }

        }else{

            $tmp_meta .= ' [methd '.$method.']';

        }

        if(isset($line_num)){

            $tmp_meta .= ' [lnum '.$line_num.']';

        }

        $tmp_print_r = print_r($expression, true);

        $tmp_print_r = $this->proper_replace('\r\n', '\n', $tmp_print_r);
        $lines = preg_split('#\r?\n#', trim($tmp_print_r));
        $tmp_line_cnt = sizeof($lines);

        $lineHTML = implode('<br />', range(1, $tmp_line_cnt+0));
        $tmp_linecnt_html_out = '<div style="line-height:20px; position:absolute; padding-right:5px; font-size:14px; font-family: Verdana, Arial, Helvetica, sans-serif; color:#00FF00; border-right:1px solid #333333; background-color:#161616; padding-top:25px; padding-bottom:25px; padding-left:4px;">'.$lineHTML.'</div>';

        if(isset($title) && $title != ''){

            $tmp_title = '<div style="display:block; clear:both; height:4px; line-height:1px; overflow:hidden; width:100%; font-size:1px;"></div><div style="float:left; padding:5px 0 0 30px; text-align:left; font-family: Courier New, Courier, monospace; font-size:11px;">';
            $tmp_title .= $title;
            $tmp_title .= '</div><div style="display:block; clear:both; height:0px; line-height:1px; overflow:hidden; width:100%; font-size:1px;"></div>';

        }else{

            $tmp_title = '<div style="display:block; clear:both; height:4px; line-height:1px; overflow:hidden; width:100%; font-size:1px;"></div><div style="float:left; padding:5px 0 0 30px; text-align:left; font-family: Courier New, Courier, monospace; font-size:11px;">';
            $tmp_title .= 'Begin print_r() output by C<span style="color:#F00;">R</span>NRSTN ::';
            $tmp_title .= '</div><div style="display:block; clear:both; height:0px; line-height:1px; overflow:hidden; width:100%; font-size:1px;"></div>';

        }

        $tmp_hash = $this->generate_new_key(10);

        switch($theme_style){
            case CRNRSTN_UI_PHP:

                $tmp_out = '
                <div id="crnrstn_print_r_output_'.$tmp_hash.'" class="crnrstn_print_r_output"  style="width:100%;">
                '.$tmp_title.'
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#CCC; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                '.$tmp_linecnt_html_out.'
                <div style="background-color:#CCC; color:#DEDECB; width:3000px; padding:10px; margin-top:0; margin-left:10px; padding-left:35px; line-height:20px;">
                <code>';

                break;
            case CRNRSTN_UI_HTML:

                $tmp_out = '
                <div id="crnrstn_print_r_output_'.$tmp_hash.'" class="crnrstn_print_r_output"  style="width:100%;">
                '.$tmp_title.'
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#FFF; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                '.$tmp_linecnt_html_out.'
                <div style="background-color:#FFF; color:#DEDECB; width:3000px; padding:10px; margin-top:0; margin-left:10px; padding-left:35px; line-height:20px;">
                <code>';

                break;
            case CRNRSTN_UI_PHPNIGHT:

                $tmp_out = '
                <div id="crnrstn_print_r_output_'.$tmp_hash.'" class="crnrstn_print_r_output"  style="width:100%;">
                '.$tmp_title.'
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#000; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                '.$tmp_linecnt_html_out.'
                <div style="background-color:#000; color:#DEDECB; width:3000px; padding:10px; margin-top:0; margin-left:10px; padding-left:35px; line-height:20px;">
                <code>';

                break;
            default:

                $tmp_out = '
                <div id="crnrstn_print_r_output_'.$tmp_hash.'" class="crnrstn_print_r_output"  style="width:100%;">
                '.$tmp_title.'
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#E6E6E6; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                '.$tmp_linecnt_html_out.'
                <div style="background-color:#E6E6E6; color:#DEDECB; width:3000px; padding:10px; margin-top:0; margin-left:10px; padding-left:35px; line-height:20px;">
                <code>';

                break;

        }

        $tmp_str_out = '<div style="background-color: #FFF; padding: 10px 20px 10px 20px;">';
        $tmp_str_out .= $tmp_out;

        $output = $this->highlightText($tmp_print_r, $theme_style);
        $output = $this->proper_replace('<br />', '
', $output);

        if($output == '<span style="color: #DEDECB"></span>' || $output == '<span style="color: #000000"></span>' || $output == '<span style="color: #CC0000"></span>'){

            $output = '<span style="color: #DEDECB">&nbsp;</span>';

        }

        if($tmp_str_out == '<span style="color: #000"></span>'){

            $tmp_str_out = '<span style="color: #000">&nbsp;</span>';

        }

        $tmp_str_out .= '<pre>';
        $tmp_str_out .=  print_r($output, true);
        $tmp_str_out .= '</pre>';

        $component_crnrstn_title = $this->return_component_branding_creative();

        $tmp_str_out .= '</code></div></div>
        <div style="width:100%;">
            <div style="display:block; clear:both; height:4px; line-height:1px; overflow:hidden; width:100%; font-size:1px;"></div>

            '.$component_crnrstn_title.'

            <div style="float:right; max-width:88%; max-width:82%; padding:4px 0 5px 0; text-align:right; font-family: Courier New, Courier, monospace; font-size:11px;">'.$tmp_meta.'</div>
                
            <div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px;"></div>
        </div>
        </div></div></div>';

        $tmp_str_out .= '<div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px;"></div>
';

        return $tmp_str_out;

    }

    public function print_r($expression, $title=NULL, $theme_style = NULL, $line_num = NULL, $method = NULL, $file = NULL){

        if(!isset($theme_style)){

            //
            // SET A DEFAULT
            $theme_style = CRNRSTN_UI_PHPNIGHT;

            $theme_style_ARRAY = $this->return_set_bits($this->system_style_profile_constants);

            if(count($theme_style_ARRAY) > 0){

                $theme_style = $theme_style_ARRAY[0];   // FIRST MATCH

            }

        }

        $tmp_meta = '['.$this->get_micro_time().' '.date('T').'] [rtime '. $this->wall_time().' secs]';

        if(!isset($method) || $method==''){

            if(isset($file)){

                $tmp_meta .= ' [file '.$file.']';

            }

        }else{

            $tmp_meta .= ' [methd '.$method.']';

        }

        if(isset($line_num)){

            $tmp_meta .= ' [lnum '.$line_num.']';

        }

        $tmp_print_r = print_r($expression, true);

        $tmp_print_r = $this->proper_replace('\r\n', '\n', $tmp_print_r);
        $lines = preg_split('#\r?\n#', trim($tmp_print_r));
        $tmp_line_cnt = sizeof($lines);

        $lineHTML = implode('<br />', range(1, $tmp_line_cnt+0));
        $tmp_linecnt_html_out = '<div style="line-height:20px; position:absolute; padding-right:5px; font-size:14px; font-family: Verdana, Arial, Helvetica, sans-serif; color:#00FF00; border-right:1px solid #333333; background-color:#161616; padding-top:25px; padding-bottom:25px; padding-left:4px;">'.$lineHTML.'</div>';

        if(isset($title) && $title != ''){

            $tmp_title = '<div style="display:block; clear:both; height:4px; line-height:1px; overflow:hidden; width:100%; font-size:1px;"></div><div style="float:left; padding:5px 0 0 30px; text-align:left; font-family: Courier New, Courier, monospace; font-size:11px;">';
            $tmp_title .= $title;
            $tmp_title .= '</div><div style="display:block; clear:both; height:0px; line-height:1px; overflow:hidden; width:100%; font-size:1px;"></div>';

        }else{

            $tmp_title = '<div style="display:block; clear:both; height:4px; line-height:1px; overflow:hidden; width:100%; font-size:1px;"></div><div style="float:left; padding:5px 0 0 30px; text-align:left; font-family: Courier New, Courier, monospace; font-size:11px;">';
            $tmp_title .= 'Begin print_r() output by C<span style="color:#F00;">R</span>NRSTN ::';
            $tmp_title .= '</div><div style="display:block; clear:both; height:0px; line-height:1px; overflow:hidden; width:100%; font-size:1px;"></div>';

        }

        $tmp_hash = $this->generate_new_key(10);

        switch($theme_style){
            case CRNRSTN_UI_PHP:

                $tmp_out = '
                <div id="crnrstn_print_r_output_'.$tmp_hash.'" class="crnrstn_print_r_output"  style="width:100%;">
                '.$tmp_title.'
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#CCC; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                '.$tmp_linecnt_html_out.'
                <div style="background-color:#CCC; color:#DEDECB; width:3000px; padding:10px; margin-top:0; margin-left:10px; padding-left:35px; line-height:20px;">
                <code>';

            break;
            case CRNRSTN_UI_HTML:

                $tmp_out = '
                <div id="crnrstn_print_r_output_'.$tmp_hash.'" class="crnrstn_print_r_output"  style="width:100%;">
                '.$tmp_title.'
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#FFF; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                '.$tmp_linecnt_html_out.'
                <div style="background-color:#FFF; color:#DEDECB; width:3000px; padding:10px; margin-top:0; margin-left:10px; padding-left:35px; line-height:20px;">
                <code>';

            break;
            case CRNRSTN_UI_PHPNIGHT:

                $tmp_out = '
                <div id="crnrstn_print_r_output_'.$tmp_hash.'" class="crnrstn_print_r_output"  style="width:100%;">
                '.$tmp_title.'
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#000; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                '.$tmp_linecnt_html_out.'
                <div style="background-color:#000; color:#DEDECB; width:3000px; padding:10px; margin-top:0; margin-left:10px; padding-left:35px; line-height:20px;">
                <code>';

            break;
            default:

                $tmp_out = '
                <div id="crnrstn_print_r_output_'.$tmp_hash.'" class="crnrstn_print_r_output"  style="width:100%;">
                '.$tmp_title.'
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#E6E6E6; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                '.$tmp_linecnt_html_out.'
                <div style="background-color:#E6E6E6; color:#DEDECB; width:3000px; padding:10px; margin-top:0; margin-left:10px; padding-left:35px; line-height:20px;">
                <code>';

            break;

        }

        echo '<div style="background-color: #FFF; padding: 10px 20px 10px 20px;">';
        echo $tmp_out;

        $output = $this->highlightText($tmp_print_r, $theme_style);
        $output = $this->proper_replace('<br />', '
', $output);

        if($output == '<span style="color: #DEDECB"></span>' || $output == '<span style="color: #000000"></span>' || $output == '<span style="color: #CC0000"></span>'){

            $output = '<span style="color: #DEDECB">&nbsp;</span>';

        }

        if($output == '<span style="color: #000"></span>'){

            $output = '<span style="color: #000">&nbsp;</span>';

        }

        echo '<pre>';
        print_r($output);
        echo '</pre>';

        $component_crnrstn_title = $this->return_component_branding_creative();

        echo '</code></div></div>
        <div style="width:100%;">
            <div style="display:block; clear:both; height:4px; line-height:1px; overflow:hidden; width:100%; font-size:1px;"></div>

            '.$component_crnrstn_title.'

            <div style="float:right; max-width:88%; max-width:82%; padding:4px 0 5px 0; text-align:right; font-family: Courier New, Courier, monospace; font-size:11px;">'.$tmp_meta.'</div>
                
            <div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px;"></div>
        </div>
        </div></div></div>';

        echo '<div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px;"></div>';

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.base64-encode.php
    // AUTHOR :: luke at lukeoliff.com :: https://www.php.net/manual/en/function.base64-encode.php#105200
    public function base64_encode_image ($filename, $filetype) {

        if (is_file($filename) || (is_string($filename) && $filename != '')) {

            $imgbinary = fread(fopen($filename, "r"), $this->find_filesize($filename));

            return 'data:image/' . $filetype . ';base64,' . base64_encode($imgbinary);

        }

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.filesize.php
    // AUTHOR :: C0nw0nk :: https://www.php.net/manual/en/function.filesize.php#119435
    private function find_filesize($file){

        if(substr(PHP_OS, 0, 3) == "WIN"){

            exec('for %I in ("'.$file.'") do @echo %~zI', $output);
            $return = $output[0];

        }else{

            $return = filesize($file);

            // SOURCE :: https://www.php.net/manual/en/function.filesize.php
            // AUTHOR :: synnus at gmail dot com :: https://www.php.net/manual/en/function.filesize.php#121437
            //$fsobj = new COM("Scripting.FileSystemObject");
            //$f = $fsobj->GetFile($file);
            //$return = $f->Size;

        }

        return $return;

    }

    private function return_component_branding_creative($strip_formatting = false){

        $tmp_weighted_elements_keys_ARRAY = array();

        $output_ratio_ARRAY = array(1, 10, 2, 6, 5, 8, 1, 8, 7, 7, 6, 7, 5, 5, 5);

        $tmp_ratio_cnt = sizeof($output_ratio_ARRAY);

        for($i = 0; $i < $tmp_ratio_cnt; $i++){

            for($ii = 0; $ii < $output_ratio_ARRAY[$i]; $ii++){

                $tmp_weighted_elements_keys_ARRAY[] = $this->creativeElementsKeys[$i];

            }

        }

        $tmp_cnt = sizeof($tmp_weighted_elements_keys_ARRAY);
        $tmp_cnt--;
        $tmp_int = rand(0, $tmp_cnt);

        if($strip_formatting){

            if($tmp_int == 0){

                $creative = '<div style="padding:4px 0 5px 5px; text-align:left; font-family: Courier New, Courier, monospace; font-size:11px;">C<span style="color:#F00;">R</span>NRSTN :: v'.$this->version_crnrstn.'</div>';

            }else{

                $creative = '<span style="font-family: Courier New, Courier, monospace; font-size:11px;">'.$this->return_creative($tmp_weighted_elements_keys_ARRAY[$tmp_int]).'</span>';

            }

        }else{

            if($tmp_int == 0){

                $creative = '<div style="float:left; padding:4px 0 5px 5px; text-align:left; font-family: Courier New, Courier, monospace; font-size:11px;">C<span style="color:#F00;">R</span>NRSTN :: v'.$this->version_crnrstn.'</div>';

            }else{

                $creative = '<div style="float:left; padding:4px 0 5px 5px; text-align:left; font-family: Courier New, Courier, monospace; font-size:11px;">'.$this->return_creative($tmp_weighted_elements_keys_ARRAY[$tmp_int]).'</div>';

            }

        }

        return $creative;

    }

    private function getEnvParam($paramName, $wildCardKey=NULL){

        try{

            //
            // CHECK FOR EXISTENCE OF PARAMETER WITHIN WILD CARD RESOURCE
            if(isset($wildCardKey)){

                if(isset($this->oWildCardResource_ARRAY[$this->crcINT($this->config_serial)][CRNRSTN_LOG_ALL])) {

                    $tmp_oWCR_ARRAY = $this->oWildCardResource_ARRAY[$this->crcINT($this->config_serial)][CRNRSTN_LOG_ALL];

                    if(!isset($tmp_oWCR_ARRAY[$wildCardKey])){

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('The requested WCR (wild card resource), "'.$wildCardKey.'", has not been configured for this environment (e.g. NULL WCR array index, here)...albeit there are other environments CRNRSTN :: is currently configured to support here which have had at least one (1) WCR defined and initialized therein (so...there is that).');

                    }else{

                        $tmp_oWCR = $tmp_oWCR_ARRAY[$wildCardKey];

                        if ($tmp_oWCR->issetAttribute($wildCardKey, $paramName)) {

                            //
                            // PARAM HAS BEEN DEFINED WITHIN WILD CARD RESOURCE
                            return $tmp_oWCR->get_attribute($wildCardKey, $paramName);

                        } else {

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('The "'.$paramName.'" parameter has been requested from wild card resource (i.e. WCR), "'.$wildCardKey.'", but this parameter was not found to have been initialized therein via oWCR->addAttribute().');

                        }

                    }

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('The wild card resource (i.e. WCR), "'.$wildCardKey.'", has been requested, but no WCR of the kind has been configured for this environment.');

                }

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function define_wildcard_resource($key){

        $oWildCardResource = new crnrstn_wildcard_resource($key, $this);

        return $oWildCardResource;

    }

    private function break_piped_str_to_array($piped_str, $method_as_string=NULL, $trim_method_as_string=NULL){

        try{

            $tmp_array = array();

            $tmp_array_from_pipe_ARRAY = explode('|',$piped_str);

            foreach($tmp_array_from_pipe_ARRAY as $key => $value){

                if(isset($method_as_string)){

                    $value = $this->run_method_against_content($method_as_string, $value);

                }

                if(isset($trim_method_as_string)){

                    $value = $this->run_method_against_content($trim_method_as_string, $value);

                }

                $tmp_array[] = $value;

            }

            return $tmp_array;


        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    private function run_method_against_content($method_as_string, $value){

        $method_as_string = trim(strtolower($method_as_string));

        $method_as_string = $this->proper_replace('(', '', $method_as_string);
        $method_as_string = $this->proper_replace(')', '', $method_as_string);
        $method_as_string = $this->proper_replace(' ', '', $method_as_string);

        try{

            switch($method_as_string){
                case 'strtoupper':

                    $value = strtoupper($value);

                break;
                case 'strtolower':

                    $value = strtolower($value);

                break;
                case 'trim':

                    $value = trim($value);

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('CRNRSTN :: has not been configured to support the native PHP method, '.$method_as_string);

                break;

            }

            return $value;

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function ini_get($ini_setting){

        $this->ini_set_ARRAY[$ini_setting] = ini_get($ini_setting);

        return $this->ini_set_ARRAY[$ini_setting];

    }

    public function ini_set($ini_setting, $ini_value){

        $this->ini_set_ARRAY[$ini_setting] = $ini_value;

        return ini_set($ini_setting, $ini_value);

    }

    public function tidy_boolean($val){

        if(is_bool($val) === true){

            return $val;

        }else{

            if(!isset($val)){

                return false;

            }else{

                return $this->boolean_conversion($val);

            }

        }

    }

    /**
     * Check "Booleanic" Conditions :)
     *
     * @param  [mixed]  $variable  Can be anything (string, bool, integer, etc.)
     * @return [boolean]           Returns TRUE  for "1", "true", "on" and "yes"
     *                             Returns FALSE for "0", "false", "off" and "no"
     *                             Returns NULL otherwise.
     *
     * SOURCE :: https://www.php.net/manual/en/function.is-bool.php
     * AUTHOR :: Julio Marchi :: https://www.php.net/manual/en/function.is-bool.php#124179
     */
    public function boolean_conversion($variable=NULL){

        if (!isset($variable)) return null;
        return filter_var($variable, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

    }

    public function strSanitize($str, $type){

        $patterns = array();
        $replacements = array();

        $type = strtolower($type);

        try {

            switch ($type) {
                case 'email_private':
                    $tmp_new_post_at_ARRAY = array();
                    $clean_str = '';
                    $last_dot_flag = false;
                    $tmp_at_split_ARRAY = explode('@', $str);
                    $tmp_post_at_len = strlen($tmp_at_split_ARRAY[1]);
                    $tmp_str_ARRAY = $this->str_split_unicode($str);
                    $tmp_post_at_str_ARRAY = $this->str_split_unicode($tmp_at_split_ARRAY[1]);
                    $tmp_post_at_str_rev_ARRAY = array_reverse($tmp_post_at_str_ARRAY);

                    //
                    // PREP POST @ SITUATION
                    for($i=0;$i<$tmp_post_at_len;$i++){

                        if(!$last_dot_flag){
                            if($tmp_post_at_str_rev_ARRAY[$i]=='.'){
                                $last_dot_flag = true;

                            }

                            $tmp_new_post_at_ARRAY[] = $tmp_post_at_str_rev_ARRAY[$i];

                            if($last_dot_flag){

                                $i = $tmp_post_at_len+420;
                                $tmp_new_post_at_ARRAY = array_reverse($tmp_new_post_at_ARRAY);

                            }

                        }

                    }

                    $tmp_str_len = sizeof($tmp_str_ARRAY);
                    for($i=0; $i<$tmp_str_len; $i++){

                        if($i==0){

                            $clean_str .= $tmp_str_ARRAY[$i].'*****';

                        }else{

                            if($tmp_str_ARRAY[$i] == '@'){

                                $at_flag = true;
                                $tmp_plus_one = $i+1;
                                $clean_str .= $tmp_str_ARRAY[$i].$tmp_str_ARRAY[$tmp_plus_one].'*****';
                                $clean_str .= implode($tmp_new_post_at_ARRAY);
                                $i = $tmp_str_len + 420;

                            }
                        }
                    }

                    return $clean_str;

                break;
                case 'http_protocol_simple':

                    $patterns[0] = '_';
                    $patterns[1] = '$';
                    $patterns[2] = ' ';
                    $replacements[0] = '';
                    $replacements[1] = '';
                    $replacements[2] = '';

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unable to determine string sanitization algorithm [' . $type . '] for the content[' . $str . '].');

                break;

            }

            $str = str_replace($patterns, $replacements, $str);

            return $str;


        } catch (Exception $e) {

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function return_creative($creative_element_key, $image_output_mode = NULL, $creative_mode = NULL){

        //
        // INSTANTIATE CRNRSTN SYSTEM EMAIL CONTENT HELPER CLASS
        self::$oCommRichMediaProvider = new crnrstn_image_v_html_content_manager($this);

        return self::$oCommRichMediaProvider->return_creative($creative_element_key, $image_output_mode, $creative_mode);

    }

    public function string_sanitize($str, $type){

        return $this->strSanitize($str, $type);

    }

    public function create_pwd_hash_for_storage($user_submitted_password){

        /**
         * CONSIDER RUNNING benchmark_bestPasswordHashCost() AND THEN UPDATE
         * THIS METHOD, ACCORDINGLY FOR 'cost' => ???
         * You want to set the highest cost that you can without slowing down
         * you server too much. 8-10 is a good baseline, and more is good if your servers
         * are fast enough. benchmark_bestPasswordHashCost() aims for ≤ 50 milliseconds
         * stretching time, which is a good baseline for systems handling interactive logins.
         */

        $options = [
            'cost' => 9,
        ];

        return password_hash($user_submitted_password, PASSWORD_BCRYPT, $options);

    }

    //
    // RETURN HTTP/S PATH OF CURRENT SCRIPT
    public function current_location(){

        if(isset($_SERVER['HTTPS'])){

            if($_SERVER['HTTPS'] && ($_SERVER['HTTPS'] != 'off')){

                self::$requestProtocol='https://';

            }else{

                if(isset($_SERVER['HTTP_X_FORWARDED_PROTO'])){

                    if( !empty( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' ){

                        self::$requestProtocol='https://';

                    }else{

                        self::$requestProtocol='http://';

                    }

                }else{

                    self::$requestProtocol='http://';

                }
            }

        }else{

            self::$requestProtocol='http://';

        }

        return self::$requestProtocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

    }

    public function proper_version($system = 'CRNRSTN'){

        error_log(__LINE__.' user $system='.$system);

        $system = trim(strtoupper($system));

        switch($system){
            case 'APACHE':

                return 'Apache v' . $this->version_apache;

                break;
            case 'MYSQLI':

                return 'MySQLi v' . $this->version_crnrstn;

                break;
            case 'PHP':

                return 'php v' . $this->version_php;

                break;
            case 'SOAP':

                return 'SOAP v' . $this->version_soap;

                break;
            default:

                return 'CRNRSTN :: v' . $this->version_crnrstn;

                break;

        }

    }

    public function param_tunnel_encrypt($data=NULL, $cipher_override=NULL, $secret_key_override=NULL, $hmac_algorithm_override=NULL, $options_bitwise_override=NULL){

        try{

            if(isset($data)){

                //
                // DATA TYPE MUST BE ENCRYPTABLE...AND SAFE FOR URI
                if(in_array(gettype($data), self::$encryptableDataTypes)){

                    $tmp_encrypt_val = $this->tunnelParamEncrypt($data, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);

                    //
                    // MAKE SAFE FOR URI PASSTHROUGH.
                    $tmp_encrypt_val = urlencode($tmp_encrypt_val);

                    return $tmp_encrypt_val;

                }else{

                    //
                    // NOT ENCRYPTABLE
                    return NULL;

                }

            }else{

                //
                // NOT ENCRYPTABLE
                return NULL;

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

        return NULL;

    }

    public function param_tunnel_decrypt($data=NULL, $uri_passthrough=false, $cipher_override=NULL, $secret_key_override=NULL, $hmac_algorithm_override=NULL, $options_bitwise_override=NULL){

        try{

            if(!isset($data) || $data == ''){

                return NULL;

            }else{

                if($uri_passthrough == true){

                    //
                    // BACK OUT OF URL ENCODING
                    $data = urldecode($data);

                }

                return trim($this->tunnelParamDecrypt($data, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override));
            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

        return NULL;
    }

    private function tunnelParamEncrypt($val, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override){

        try{

            if(isset($cipher_override)){

                $secret_key = $secret_key_override;
                $cipher = $cipher_override;
                $hmac_algorithm = $hmac_algorithm_override;
                $options_bitwise = $options_bitwise_override;

                #
                # Source: http://php.net/manual/en/function.openssl-encrypt.php
                #
                $ivlen = openssl_cipher_iv_length($cipher);
                $iv = openssl_random_pseudo_bytes($ivlen);
                $ciphertext_raw = openssl_encrypt($val, $cipher, $secret_key, $options=$options_bitwise, $iv);
                $hmac = hash_hmac($hmac_algorithm, $ciphertext_raw, $secret_key, $as_binary=true);
                $ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );

                return $ciphertext;

            }else{

                return $val;

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

        return NULL;

    }

    private function tunnelParamDecrypt($val, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override){

        try{

            if(isset($cipher_override)){

                $secret_key = $secret_key_override;
                $cipher = $cipher_override;
                $hmac_algorithm = $hmac_algorithm_override;
                $options_bitwise = $options_bitwise_override;

                #
                # Source: http://php.net/manual/en/function.openssl-encrypt.php
                #
                $c = base64_decode($val);
                $ivlen = openssl_cipher_iv_length($cipher);
                $iv = substr($c, 0, $ivlen);
                $hmac = substr($c, $ivlen, $sha2len=32);
                $ciphertext_raw = substr($c, $ivlen+$sha2len);
                $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $secret_key, $options=$options_bitwise, $iv);
                $calcmac = hash_hmac($hmac_algorithm, $ciphertext_raw, $secret_key, $as_binary=true);

                if (hash_equals($hmac, $calcmac))//PHP 5.6+ timing attack safe comparison
                {

                    return $original_plaintext;

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('CRNRSTN :: Tunnel Param Decrypt Notice :: Oops. Something went wrong. Hash_equals comparison failed during data decryption.');

                }

            }else{

                //
                // NO ENCRYPTION. RETURN VAL
                return $val;

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

        return NULL;

    }

    //
    // SOURCE :: https://stackoverflow.com/questions/2510434/format-bytes-to-kilobytes-megabytes-gigabytes
    // AUTHOR :: https://stackoverflow.com/users/227532/leo
    public function formatBytes($bytes, $precision = 2, $SI_output=false) {

        //
        // CRNRSTN v2.0.0 :: MODS
        // SEE :: https://en.wikipedia.org/wiki/Binary_prefix
        // SEE ALSO :: ISO/IEC 80000 family of standards (November 1, 2009)
        // https://en.wikipedia.org/wiki/ISO/IEC_80000#Information_science_and_technology
        // SEE COMMENT BY DEVATOR [https://stackoverflow.com/users/659731/devator] JUST
        // BENEATH THE METHOD [formatBytes()] AUTHOR'S RESPONSE AT SOURCE LINK. THIS IS MY
        // IMPETUS TO INCLUDE THE ABOVE LINKS TO ADDITIONAL MATERIAL FROM WIKIPEDIA.
        if($SI_output){

            // SI :: metric prefix
            $units = array('bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
            $units_power = 1000;

        }else{

            // IEC :: ISO 80000 or IEC 80000
            $units = array('bytes', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB');
            $units_power = 1024;

        }

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log($units_power));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow($units_power, $pow);

        $tmp_number = round($bytes, $precision);
        $tmp_number = $this->number_format_keep_precision($tmp_number);

        return  $tmp_number. ' ' . $units[$pow];

    }

    public function number_format_keep_precision($number, $dec_places=0, $dec_point = '.', $thou_separate = ','){

        if($dec_places>0){

            return number_format($number , $dec_places , $dec_point, $thou_separate);

        }else{

            //
            // SOURCE :: https://www.php.net/manual/en/function.number-format.php
            // AUTHOR :: stm555 at hotmail dot com :: https://www.php.net/manual/en/function.number-format.php#52311
            $broken_number = explode($dec_point,$number);
            if(isset($broken_number[1])){

                return number_format($broken_number[0] , 0 , $dec_point, $thou_separate).$dec_point.$broken_number[1];

            }else{

                return number_format($broken_number[0] , 0 , $dec_point, $thou_separate);

            }

        }

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.highlight-string.php
    // AUTHOR :: stanislav dot eckert at vizson dot de :: https://www.php.net/manual/en/function.highlight-string.php#118550
    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function highlightText($text, $theme_style = NULL)   // [EDIT] CRNRSTN v2.00.0000 FOR CRNRSTN_UI_PHPNIGHT :: J5
    {

        if ($theme_style == CRNRSTN_UI_PHP) {

            ini_set('highlight.comment', '#008000');
            ini_set('highlight.default', '#000');
            ini_set('highlight.html', '#808080');
            ini_set('highlight.keyword', '#00B; font-weight: bold');
            ini_set('highlight.string', '#D00');

        } else if ($theme_style == CRNRSTN_UI_HTML) {

            ini_set('highlight.comment', 'green');
            ini_set('highlight.default', '#C00');
            ini_set('highlight.html', '#000');
            ini_set('highlight.keyword', 'black; font-weight: bold');
            ini_set('highlight.string', '#00F');

        } else if ($theme_style == CRNRSTN_UI_PHPNIGHT)                        // [EDIT] CRNRSTN :: v2.00.0000 :: J5 :: April 13, 2021 2004hrs
        {
            ini_set('highlight.comment', '#FC0');
            ini_set('highlight.default', '#DEDECB');
            ini_set('highlight.html', '#808080');
            ini_set('highlight.keyword', '#8FE28F; font-weight: normal');
            ini_set('highlight.string', '#F66');

        }

        $text = trim($text);
        $text = highlight_string("<?php " . $text, true);  // highlight_string() requires opening PHP tag or otherwise it will not colorize the text
        $text = trim($text);
        $text = preg_replace("|^\\<code\\>\\<span style\\=\"color\\: #[a-fA-F0-9]{0,6}\"\\>|", "", $text, 1);  // remove prefix
        $text = preg_replace("|\\</code\\>\$|", "", $text, 1);  // remove suffix 1
        $text = trim($text);  // remove line breaks
        $text = preg_replace("|\\</span\\>\$|", "", $text, 1);  // remove suffix 2
        $text = trim($text);  // remove line breaks
        $text = preg_replace("|^(\\<span style\\=\"color\\: #[a-fA-F0-9]{0,6}\"\\>)(&lt;\\?php&nbsp;)(.*?)(\\</span\\>)|", "\$1\$3\$4", $text);  // remove custom added "<?php "

        return $text;
    }

    //
    // SOURCE :: http://php.net/manual/en/function.mkdir.php
    // AUTHOR :: kungla at gmail dot com :: http://php.net/manual/en/function.mkdir.php#68207
    public function mkdir_r($dirName, $mode=777){

        try{

            $mode = octdec( str_pad($mode,4,'0',STR_PAD_LEFT) );
            $mode = (int)$mode;

            $dirs = explode('/', $dirName);
            $dir='';
            foreach ($dirs as $part) {
                $dir.=$part.'/';
                if (!is_dir($dir) && strlen($dir)>0) {
                    if(!mkdir($dir, $mode)){
                        $error = error_get_last();

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception($error['message']. ' mkdir_r() failed to mkdir :: ' . $dir);

                    }
                }
            }

            return true;

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }
    }

    public function crcINT($value){

        $value = crc32($value);
        return sprintf("%u", $value);

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.str-split.php
    // AUTHOR :: qeremy [atta] gmail [dotta] com :: https://www.php.net/manual/en/function.str-split.php#113274
    public function str_split_unicode($str, $length = 1) {

        $tmp = preg_split('~~u', $str, -1, PREG_SPLIT_NO_EMPTY);

        if ($length > 1) {

            $chunks = array_chunk($tmp, $length);

            foreach ($chunks as $i => $chunk) {

                $chunks[$i] = join('', (array) $chunk);

            }

            $tmp = $chunks;

        }

        return $tmp;

    }

    //    private function fileMove_DF($ftp_stream, $SOURCE_filePath, $oEndpoint_serial_SOURCE, $oEndpoint_serial_DESTINATION, $oElectrum_STATS, $SOURCE_filePath_ORIGINAL=NULL){
    public function file_local_send_by_ftp($ftp_stream_target, $file_source_path, $oEndpoint_serial_SOURCE, $oEndpoint_serial_DESTINATION, $oElectrum_STATS){

        $continue_process = false;
        $tmp_stats_DESTINATION_ARRAY = array();
        $tmp_stats_dest_path = '';
        #$tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH']
        #$tmp_stats_DESTINATION_ARRAY['MKSUB_DIR']
        #$tmp_stats_DESTINATION_ARRAY['DESTINATION_FILEPATH']
        #$tmp_stats_DESTINATION_ARRAY['SPLIT_DIR']

        //$tmp_stats_DESTINATION_ARRAY = $oElectrum_STATS->return_DF_destination_stats_array($oEndpoint_serial_SOURCE, $oEndpoint_serial_DESTINATION, $file_source_path);
        //$tmp_stats_dest_path = $oElectrum_STATS->return_destination_stats_path($oEndpoint_serial_SOURCE, $oEndpoint_serial_DESTINATION);
        //self::$oCRNRSTN_USR->error_log('oWheel :: Run ftp_mksubdirs=>[ftp_root_dir_path='.$ftp_root_dir_path.'][tmp_mksubdir_destination_path='.$tmp_mksubdir_destination_path.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

        if(is_dir($file_source_path)){

            //self::$oCRNRSTN_USR->error_log('oWheel :: Run ftp_mksubdirs=>[source_filepath='.$file_source_path.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');
            error_log(__LINE__.' '.__METHOD__.' crnrstn die().');
            die();
            //$this->ftp_mksubdirs($ftp_stream_target, $tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH'], $tmp_stats_DESTINATION_ARRAY['MKSUB_DIR']);

            $continue_process = true;

        }else{

            error_log(__LINE__.' '.__METHOD__.' crnrstn die().');
            die();
            if(isset($SOURCE_filePath_ORIGINAL)){

                $SOURCE_filepath_for_DESTINATION = $SOURCE_filePath_ORIGINAL;

            }else{

                $SOURCE_filepath_for_DESTINATION = $file_source_path;

            }

            $tmp_slashChar = $this->return_slashChar($tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH']);

            $tmp_split_ARRAY = explode($tmp_slashChar, $tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH']);
            $tmp_split_cnt = sizeof($tmp_split_ARRAY);

            $tmp_dir_split_ARRAY = explode($tmp_split_ARRAY[$tmp_split_cnt-2], $tmp_stats_DESTINATION_ARRAY['DESTINATION_FILEPATH']);

            $tmp_dir_sect_ARRAY = explode($tmp_slashChar, $tmp_dir_split_ARRAY[1]);
            $tmp_sect_cnt = sizeof($tmp_dir_sect_ARRAY);

            #$tmp_dir_sect_ARRAY[$tmp_sect_cnt-2] = wethrbug
            $tmp_dest_file_section_ARRAY = explode($tmp_dir_sect_ARRAY[$tmp_sect_cnt-2], $SOURCE_filepath_for_DESTINATION);

            # [tmp_dir_split_ARRAY[1]=/a_custom_folder_name/20201013_16-52-26/wethrbug/
            $tmp_sect_array = explode($tmp_slashChar, $tmp_dir_split_ARRAY[1]);
            $tmp_cnt = sizeof($tmp_sect_array);

            $tmp_cut_dir = $tmp_sect_array[$tmp_cnt-2];

            $tmp_source_sect_ARRAY = explode($tmp_cut_dir, $file_source_path);
            //$tmp_dir = dirname($tmp_source_sect_ARRAY[1]);

            $tmp_file_dest = rtrim($tmp_dir_split_ARRAY[1], $tmp_slashChar).$tmp_dest_file_section_ARRAY[1];
            $tmp_file_cap = basename($tmp_file_dest);

            $tmp_file_dirpath_final = rtrim($tmp_file_dest,$tmp_file_cap);
            $tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH'] = rtrim($tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH'], $tmp_slashChar);
            //$tmp_dfile = $tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH'].$SOURCE_filepath_for_DESTINATION;
            $tmp_dfile = $tmp_stats_dest_path;
            $tmp_dfile = rtrim($tmp_dfile, $tmp_slashChar);
            //self::$oCRNRSTN_USR->error_log('oWheel :: SLASH CHAR = '.$tmp_slashChar, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

            $tmp_dfile_array = explode($tmp_slashChar, $tmp_stats_DESTINATION_ARRAY['DESTINATION_FILEPATH']);
            $tmp_dfile_sect_cnt = sizeof($tmp_dfile_array);

            //self::$oCRNRSTN_USR->error_log('oWheel :: EXPLODE ['.$tmp_stats_DESTINATION_ARRAY['DESTINATION_FILEPATH'].'] ON '.$tmp_dfile_sect_cnt, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

            $tmp_dfile_bi_path_ARRAY = explode($tmp_dfile_array[$tmp_dfile_sect_cnt-2], $SOURCE_filepath_for_DESTINATION);

            $tmp_dfile .= $tmp_dfile_bi_path_ARRAY[1];
            //self::$oCRNRSTN_USR->error_log('oWheel :: Run ftp_mksubdirs=> [DESTINATION_FILEPATH]='.$tmp_stats_DESTINATION_ARRAY['DESTINATION_FILEPATH'].' | [FTP_DIR_PATH]='.$tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH']. ' on tmp_split_ARRAY[tmp_split_cnt-2]='.$tmp_split_ARRAY[$tmp_split_cnt-2], __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');
            //self::$oCRNRSTN_USR->error_log('oWheel :: Run ftp_mksubdirs @ '. $tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH'].' for =>['.$tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH'].$tmp_file_dirpath_final, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

            if($this->ftp_mksubdirs($ftp_stream_target, $tmp_slashChar, $tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH'].$tmp_file_dirpath_final)){

                //self::$oCRNRSTN_USR->error_log('oWheel :: ftp_mksubdirs SUCCESS', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

            }else{

                $error = error_get_last();

                //
                // WE USE FTP_CHDIR TO SEE IF WE NEED TO CALL FTP_MKDIR. IT IS OK (OR EXPECTED) TO GET FTP_CHDIR ERRORS HERE.
                $pos_ignore_err = strpos($error['message'],'ftp_chdir()');
                if($pos_ignore_err===false){

                    self::$oCRNRSTN_USR->error_log('oWheel :: ftp_mksubdirs ERROR :: '.$error['message'], __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

                }
            }

            if(substr($tmp_dfile, -1) == $tmp_slashChar){

                $tmp_dfile = rtrim($tmp_dfile, $tmp_slashChar).$tmp_slashChar;
                $tmp_dfile_fname = basename($SOURCE_filepath_for_DESTINATION);
                $tmp_dfile = $tmp_dfile.$tmp_dfile_fname;

            }

            //self::$oCRNRSTN_USR->error_log('oWheel :: SEE ['.$SOURCE_filepath_for_DESTINATION.']. Now run ftp_put LOCAL FILE=>['.$SOURCE_filepath_for_DESTINATION.'] to DEST FILE=>['.$tmp_dfile.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

            if(ftp_put($ftp_stream_target, $tmp_dfile, $SOURCE_filepath_for_DESTINATION, FTP_BINARY)) {

                $continue_process = true;
                //self::$oCRNRSTN_USR->error_log('oWheel FF - 2/2 (or DF 1 of 1) :: Successfully uploaded LOCAL FILE=>['.$SOURCE_filepath_for_DESTINATION.'] to DEST FILE=>['.$tmp_dfile.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

            }else{

                $error = error_get_last();
                self::$oCRNRSTN_USR->error_log('oWheel FF - 2/2 (or DF 1 of 1) :: ERROR uploading LOCAL FILE=>['.$SOURCE_filepath_for_DESTINATION.'] to DEST FILE=>['.$tmp_dfile.'] :: '.$error['message'], __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

                $this->is_error_on_transfer = true;
                $this->error_on_transfer_message = $error['message'].' <= Error experienced while pushing local file ['.$SOURCE_filepath_for_DESTINATION.'] to FTP destination[{FTP_OR_LOCAL_DETAIL}] as file=>['.$tmp_dfile.'].';

            }

        }

        return $continue_process;

    }

    public function initialize_php_profile(){

        //
        // PHP VERSION
        // PHP_VERSION_ID is available as of PHP 5.2.7
        if (!defined('PHP_VERSION_ID')) {

            $version = explode('.', PHP_VERSION);

            $patch = '';
            $tmp_array = str_split($version[2]);
            $tmp_size = sizeof($tmp_array);

            for($i = 0; $i < $tmp_size; $i++){

                if(is_numeric($tmp_array[$i])){

                    $patch .= $tmp_array[$i];

                }else{

                    $i = $tmp_size + 1;

                }

            }

            if(strlen($patch) > 0){

                define('PHP_RELEASE_VERSION', (int) $patch);

            }else{

                define('PHP_RELEASE_VERSION', 0);

            }

            define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + (int) $patch));
            define('PHP_MAJOR_VERSION',   $version[0]);
            define('PHP_MINOR_VERSION',   $version[1]);
            //define('PHP_RELEASE_VERSION', $version[2]);

            $this->version_php = PHP_MAJOR_VERSION.'.'.PHP_MINOR_VERSION.'.'.PHP_RELEASE_VERSION;

        }else{

            //
            // WE ARE AT LEAST PHP v5.2.7
            $this->version_php =  PHP_MAJOR_VERSION.'.'.PHP_MINOR_VERSION.'.'.PHP_RELEASE_VERSION;

        }

        //
        // SELECT PHP INI SETTINGS
        /*
        ini_get('post_max_size')
        ini_get('display_errors')
        ini_get('register_globals')

        allow_url_fopen bool
        This option enables the URL-aware fopen wrappers that enable accessing URL object like files. Default wrappers are provided for the access of remote files using the ftp or http protocol, some extensions like zlib may register additional wrappers.

        allow_url_include bool
        This option allows the use of URL-aware fopen wrappers with the following functions: include, include_once, require, require_once.

        default_charset string
        "UTF-8" is the default value and its value is used as the default character encoding for htmlentities(), html_entity_decode() and htmlspecialchars() if the encoding parameter is omitted. The value of default_charset will also be used to set the default character set for iconv functions if the iconv.input_encoding, iconv.output_encoding and iconv.internal_encoding configuration options are unset, and for mbstring functions if the mbstring.http_input mbstring.http_output mbstring.internal_encoding configuration option is unset.
        All versions of PHP will use this value as the charset within the default Content-Type header sent by PHP if the header isn't overridden by a call to header().
        Setting default_charset to an empty value is not recommended.

        default_mimetype string
        By default, PHP will output a media type using the Content-Type header. To disable this, simply set it to be empty.
        PHP's built-in default media type is set to text/html.

        default_socket_timeout int
        Default timeout (in seconds) for socket based streams. Specifying a negative value means an infinite timeout.

        fbsql.batchsize???

        file_uploads bool
        Whether or not to allow HTTP file uploads. See also the upload_max_filesize, upload_tmp_dir, and post_max_size directives.

        log_errors_max_len int
        Set the maximum length of log_errors in bytes. In error_log information about the source is added. The default is 1024 and 0 allows to not apply any maximum length at all. This length is applied to logged errors, displayed errors and also to $php_errormsg, but not to explicitly called functions such as error_log().
        When an int is used, the value is measured in bytes. Shorthand notation, as described in this FAQ, may also be used.

        max_execution_time int
        This sets the maximum time in seconds a script is allowed to run before it is terminated by the parser. This helps prevent poorly written scripts from tying up the server. The default setting is 30. When running PHP from the command line the default setting is 0.
        On non Windows systems, the maximum execution time is not affected by system calls, stream operations etc. Please see the set_time_limit() function for more details.
        Your web server can have other timeout configurations that may also interrupt PHP execution. Apache has a Timeout directive and IIS has a CGI timeout function. Both default to 300 seconds. See your web server documentation for specific details.

        max_input_vars int
        How many input variables may be accepted (limit is applied to $_GET, $_POST and $_COOKIE superglobal separately). Use of this directive mitigates the possibility of denial of service attacks which use hash collisions. If there are more input variables than specified by this directive, an E_WARNING is issued, and further input variables are truncated from the request.

        max_input_time int
        This sets the maximum time in seconds a script is allowed to parse input data, like POST and GET. Timing begins at the moment PHP is invoked at the server and ends when execution begins. The default setting is -1, which means that max_execution_time is used instead. Set to 0 to allow unlimited time.

        memcache.chunk_size int
        Data will be transferred in chunks of this size, setting the value lower requires more network writes. Try increasing this value to 32768 if noticing otherwise inexplicable slowdowns.

        memcache.protocol string

        memory_limit int
        This sets the maximum amount of memory in bytes that a script is allowed to allocate. This helps prevent poorly written scripts for eating up all available memory on a server. Note that to have no memory limit, set this directive to -1.
        When an int is used, the value is measured in bytes. Shorthand notation, as described in this FAQ, may also be used.

        mysql.allow_persistent bool
        Whether to allow persistent connections to MySQL.

        mysql.max_persistent int
        The maximum number of persistent MySQL connections per process.

        mysql.max_links int
        The maximum number of MySQL connections per process, including persistent connections.

        mysql.default_port string
        The default TCP port number to use when connecting to the database server if no other port is specified. If no default is specified, the port will be obtained from the MYSQL_TCP_PORT environment variable, the mysql-tcp entry in /etc/services or the compile-time MYSQL_PORT constant, in that order. Win32 will only use the MYSQL_PORT constant.

        mysql.default_socket string
        The default socket name to use when connecting to a local database server if no other socket name is specified.

        mysql.default_host string
        The default server host to use when connecting to the database server if no other host is specified. Doesn't apply in SQL safe mode.

        mysql.default_user string
        The default user name to use when connecting to the database server if no other name is specified. Doesn't apply in SQL safe mode.

        mysql.default_password string
        The default password to use when connecting to the database server if no other password is specified. Doesn't apply in SQL safe mode.

        mysql.connect_timeout int
        Connect timeout in seconds. On Linux this timeout is also used for waiting for the first answer from the server.

        mysqli.allow_persistent int
        Enable the ability to create persistent connections using mysqli_connect().

        mysqli.max_persistent int
        Maximum of persistent connections that can be made. Set to 0 for unlimited.

        mysqli.max_links int
        The maximum number of MySQL connections per process.

        mysqli.default_port int
        The default TCP port number to use when connecting to the database server if no other port is specified. If no default is specified, the port will be obtained from the MYSQL_TCP_PORT environment variable, the mysql-tcp entry in /etc/services or the compile-time MYSQL_PORT constant, in that order. Win32 will only use the MYSQL_PORT constant.

        mysqli.default_socket string
        The default socket name to use when connecting to a local database server if no other socket name is specified.

        mysqli.default_host string
        The default server host to use when connecting to the database server if no other host is specified.

        mysqli.default_user string
        The default user name to use when connecting to the database server if no other name is specified.

        mysqli.default_pw string
        The default password to use when connecting to the database server if no other password is specified.

        mysqlnd.collect_statistics bool
        Enables the collection of various client statistics which can be accessed through mysqli_get_client_stats(), mysqli_get_connection_stats(), and are shown in mysqlnd section of the output of the phpinfo() function as well.
        This configuration setting enables all MySQL Native Driver statistics except those relating to memory management.

        mysqlnd.collect_memory_statistics bool
        Enable the collection of various memory statistics which can be accessed through mysqli_get_client_stats(), mysqli_get_connection_stats(), and are shown in mysqlnd section of the output of the phpinfo() function as well.
        This configuration setting enables the memory management statistics within the overall set of MySQL Native Driver statistics.

        mysqlnd.log_mask int
        Defines which queries will be logged. The default 0, which disables logging. Define using an integer, and not with PHP constants. For example, a value of 48 (16 + 32) will log slow queries which either use 'no good index' (SERVER_QUERY_NO_GOOD_INDEX_USED = 16) or no index at all (SERVER_QUERY_NO_INDEX_USED = 32). A value of 2043 (1 + 2 + 8 + ... + 1024) will log all slow query types.
        The types are as follows: SERVER_STATUS_IN_TRANS=1, SERVER_STATUS_AUTOCOMMIT=2, SERVER_MORE_RESULTS_EXISTS=8, SERVER_QUERY_NO_GOOD_INDEX_USED=16, SERVER_QUERY_NO_INDEX_USED=32, SERVER_STATUS_CURSOR_EXISTS=64, SERVER_STATUS_LAST_ROW_SENT=128, SERVER_STATUS_DB_DROPPED=256, SERVER_STATUS_NO_BACKSLASH_ESCAPES=512, and SERVER_QUERY_WAS_SLOW=1024.

        mysqlnd.mempool_default_size int
        Default size of the mysqlnd memory pool, which is used by result sets.

        mysqlnd.net_read_timeout int
        mysqlnd and the MySQL Client Library, libmysqlclient use different networking APIs. mysqlnd uses PHP streams, whereas libmysqlclient uses its own wrapper around the operating level network calls. PHP, by default, sets a read timeout of 60s for streams. This is set via php.ini, default_socket_timeout. This default applies to all streams that set no other timeout value. mysqlnd does not set any other value and therefore connections of long running queries can be disconnected after default_socket_timeout seconds resulting in an error message 2006 - MySQL Server has gone away. The MySQL Client Library sets a default timeout of 24 * 3600 seconds (1 day) and waits for other timeouts to occur, such as TCP/IP timeouts. mysqlnd now uses the same very long timeout. The value is configurable through a new php.ini setting: mysqlnd.net_read_timeout. mysqlnd.net_read_timeout gets used by any extension (ext/mysql, ext/mysqli, PDO_MySQL) that uses mysqlnd. mysqlnd tells PHP Streams to use mysqlnd.net_read_timeout. Please note that there may be subtle differences between MYSQL_OPT_READ_TIMEOUT from the MySQL Client Library and PHP Streams, for example MYSQL_OPT_READ_TIMEOUT is documented to work only for TCP/IP connections and, prior to MySQL 5.1.2, only for Windows. PHP streams may not have this limitation. Please check the streams documentation, if in doubt.

        mysqlnd.net_cmd_buffer_size int
        mysqlnd allocates an internal command/network buffer of mysqlnd.net_cmd_buffer_size (in php.ini) bytes for every connection. If a MySQL Client Server protocol command, for example, COM_QUERY (normal query), does not fit into the buffer, mysqlnd will grow the buffer to the size required for sending the command. Whenever the buffer gets extended for one connection, command_buffer_too_small will be incremented by one.
        If mysqlnd has to grow the buffer beyond its initial size of mysqlnd.net_cmd_buffer_size bytes for almost every connection, you should consider increasing the default size to avoid re-allocations.
        The default buffer size is 4096 bytes, which is the smallest value possible.
        The value can also be set using mysqli_options(link, MYSQLI_OPT_NET_CMD_BUFFER_SIZE, size).

        mysqlnd.net_read_buffer_size int
        Maximum read chunk size in bytes when reading the body of a MySQL command packet. The MySQL client server protocol encapsulates all its commands in packets. The packets consist of a small header and a body with the actual payload. The size of the body is encoded in the header. mysqlnd reads the body in chunks of MIN(header.size, mysqlnd.net_read_buffer_size) bytes. If a packet body is larger than mysqlnd.net_read_buffer_size bytes, mysqlnd has to call read() multiple times.
        The value can also be set using mysqli_options(link, MYSQLI_OPT_NET_READ_BUFFER_SIZE, size).

        post_max_size int
        Sets max size of post data allowed. This setting also affects file upload. To upload large files, this value must be larger than upload_max_filesize. Generally speaking, memory_limit should be larger than post_max_size. When an int is used, the value is measured in bytes. Shorthand notation, as described in this FAQ, may also be used. If the size of post data is greater than post_max_size, the $_POST and $_FILES superglobals are empty. This can be tracked in various ways, e.g. by passing the $_GET variable to the script processing the data, i.e. <form action="edit.php?processed=1">, and then checking if $_GET['processed'] is set.
        Note: PHP allows shortcuts for byte values, including K (kilo), M (mega) and G (giga). PHP will do the conversions automatically if you use any of these. Be careful not to exceed the 32 bit signed integer limit (if you're using 32bit versions) as it will cause your script to fail.

        precision int
        The number of significant digits displayed in floating point numbers. -1 means that an enhanced algorithm for rounding such numbers will be used.

        realpath_cache_size int
        Determines the size of the realpath cache to be used by PHP. This value should be increased on systems where PHP opens many files, to reflect the quantity of the file operations performed.
        The size represents the total number of bytes in the path strings stored, plus the size of the data associated with the cache entry. This means that in order to store longer paths in the cache, the cache size must be larger. This value does not directly control the number of distinct paths that can be cached.
        The size required for the cache entry data is system dependent.

        realpath_cache_ttl int
        Duration of time (in seconds) for which to cache realpath information for a given file or directory. For systems with rarely changing files, consider increasing the value.

        session.name string
        session.name specifies the name of the session which is used as cookie name. It should only contain alphanumeric characters. Defaults to PHPSESSID. See also session_name().

        session.gc_maxlifetime int
        session.gc_maxlifetime specifies the number of seconds after which data will be seen as 'garbage' and potentially cleaned up. Garbage collection may occur during session start (depending on session.gc_probability and session.gc_divisor).
        Note: If different scripts have different values of session.gc_maxlifetime but share the same place for storing the session data then the script with the minimum value will be cleaning the data. In this case, use this directive together with session.save_path.

        session.use_cookies bool
        session.use_cookies specifies whether the module will use cookies to store the session id on the client side. Defaults to 1 (enabled).

        session.use_only_cookies bool
        session.use_only_cookies specifies whether the module will only use cookies to store the session id on the client side. Enabling this setting prevents attacks involved passing session ids in URLs. Defaults to 1 (enabled) since PHP 5.3.0.

        session.cookie_lifetime int
        session.cookie_lifetime specifies the lifetime of the cookie in seconds which is sent to the browser. The value 0 means "until the browser is closed." Defaults to 0. See also session_get_cookie_params() and session_set_cookie_params().
        Note: The expiration timestamp is set relative to the server time, which is not necessarily the same as the time in the client's browser.

        session.cookie_path string
        session.cookie_path specifies path to set in the session cookie. Defaults to /. See also session_get_cookie_params() and session_set_cookie_params().

        session.cookie_domain string
        session.cookie_domain specifies the domain to set in the session cookie. Default is none at all meaning the host name of the server which generated the cookie according to cookies specification. See also session_get_cookie_params() and session_set_cookie_params().

        session.cookie_secure bool
        session.cookie_secure specifies whether cookies should only be sent over secure connections. Defaults to off. See also session_get_cookie_params() and session_set_cookie_params().

        session.cookie_httponly bool
        Marks the cookie as accessible only through the HTTP protocol. This means that the cookie won't be accessible by scripting languages, such as JavaScript. This setting can effectively help to reduce identity theft through XSS attacks (although it is not supported by all browsers).

        session.cookie_samesite string  (Available as of PHP 7.3.0.)
        Allows servers to assert that a cookie ought not to be sent along with cross-site requests. This assertion allows user agents to mitigate the risk of cross-origin information leakage, and provides some protection against cross-site request forgery attacks. Note that this is not supported by all browsers. An empty value means that no SameSite cookie attribute will be set. Lax and Strict mean that the cookie will not be sent cross-domain for POST requests; Lax will sent the cookie for cross-domain GET requests, while Strict will not.

        session.cache_limiter string
        session.cache_limiter specifies the cache control method used for session pages. It may be one of the following values: nocache, private, private_no_expire, or public. Defaults to nocache. See also the session_cache_limiter() documentation for information about what these values mean.

        session.cache_expire int
        session.cache_expire specifies time-to-live for cached session pages in minutes, this has no effect for nocache limiter. Defaults to 180. See also session_cache_expire().

        session.sid_length int (Available as of PHP 7.1.0.)
        session.sid_length allows you to specify the length of session ID string. Session ID length can be between 22 to 256. The default is 32. If you need compatibility you may specify 32, 40, etc. Longer session ID is harder to guess. At least 32 chars are recommended.
        Tip :: Compatibility Note: Use 32 instead of session.hash_function=0 (MD5) and session.hash_bits_per_character=4, session.hash_function=1 (SHA1) and session.hash_bits_per_character=6. Use 26 instead of session.hash_function=0 (MD5) and session.hash_bits_per_character=5. Use 22 instead of session.hash_function=0 (MD5) and session.hash_bits_per_character=6. You must configure INI values to have at least 128 bits in session ID. Do not forget to set an appropriate value for session.sid_bits_per_character, otherwise you will have weaker session ID.
        Note: This setting is introduced in PHP 7.1.0.

        session.sid_bits_per_character int (Available as of PHP 7.1.0.)
        session.sid_per_character allows you to specify the number of bits in encoded session ID character. The possible values are '4' (0-9, a-f), '5' (0-9, a-v), and '6' (0-9, a-z, A-Z, "-", ","). The default is 4. The more bits results in stronger session ID. 5 is recommended value for most environments.
        Note: This setting is introduced in PHP 7.1.0.

        session.upload_progress.enabled bool
        Enables upload progress tracking, populating the $_SESSION variable. Defaults to 1, enabled.

        session.upload_progress.cleanup bool
        Cleanup the progress information as soon as all POST data has been read (i.e. upload completed). Defaults to 1, enabled.
        Note: It is highly recommended to keep this feature enabled.

        session.upload_progress.prefix string
        A prefix used for the upload progress key in the $_SESSION. This key will be concatenated with the value of $_POST[ini_get("session.upload_progress.name")] to provide a unique index. Defaults to "upload_progress_".

        session.upload_progress.name string
        The name of the key to be used in $_SESSION storing the progress information. See also session.upload_progress.prefix. If $_POST[ini_get("session.upload_progress.name")] is not passed or available, upload progressing will not be recorded. Defaults to "PHP_SESSION_UPLOAD_PROGRESS".

        session.upload_progress.freq mixed
        Defines how often the upload progress information should be updated. This can be defined in bytes (i.e. "update progress information after every 100 bytes"), or in percentages (i.e. "update progress information after receiving every 1% of the whole filesize"). Defaults to "1%".

        session.upload_progress.min_freq int
        The minimum delay between updates, in seconds. Defaults to "1" (one second).

        SMTP string
        Used under Windows only: host name or IP address of the SMTP server PHP should use for mail sent with the mail() function.

        smtp_port int
        Used under Windows only: Number of the port to connect to the server specified with the SMTP setting when sending mail with mail(); defaults to 25.

        upload_max_filesize int
        The maximum size of an uploaded file.
        When an int is used, the value is measured in bytes. Shorthand notation, as described in this FAQ, may also be used.

        max_file_uploads int
        The maximum number of files allowed to be uploaded simultaneously. Starting with PHP 5.3.4, upload fields left blank on submission do not count towards this limit.

        variables_order string
        Sets the order of the EGPCS (Environment, Get, Post, Cookie, and Server) variable parsing. For example, if variables_order is set to "SP" then PHP will create the superglobals $_SERVER and $_POST, but not create $_ENV, $_GET, and $_COOKIE. Setting to "" means no superglobals will be set.
        Warning :: In both the CGI and FastCGI SAPIs, $_SERVER is also populated by values from the environment; S is always equivalent to ES regardless of the placement of E elsewhere in this directive.
        Note: The content and order of $_REQUEST is also affected by this directive.

        zend.multibyte bool
        Enables parsing of source files in multibyte encodings. Enabling zend.multibyte is required to use character encodings like SJIS, BIG5, etc that contain special characters in multibyte string data. ISO-8859-1 compatible encodings like UTF-8, EUC, etc do not require this option.
        Enabling zend.multibyte requires the mbstring extension to be available.
        */

    }

    public function initialize_apache_profile(){

        $tmp_SERVER_SOFTWARE = strtolower(trim($_SERVER['SERVER_SOFTWARE']));

        $version_ARRAY = explode('apache/', $tmp_SERVER_SOFTWARE);

        $version = explode('.', $version_ARRAY[1]);

        //
        // POWERED BY APACHE IMAGE DRIVER
        //$this->version_apache_sysimg = (double) $version[0].'.'.$version[1];
        if(isset($version[1])){ 

            $this->version_apache_sysimg = (double) $version[0].'.'.$version[1];

        }else{

            $this->version_apache_sysimg = (double) $version[0];

        }

        $patch = '';
        $tmp_array = str_split($version[2]);
        $tmp_size = sizeof($tmp_array);

        for($i = 0; $i < $tmp_size; $i++){

            if(is_numeric($tmp_array[$i])){

                $patch .= $tmp_array[$i];

            }else{

                $i = $tmp_size + 1;

            }

        }

        if(strlen($patch) > 0){

            $this->version_apache = $version[0].'.'.$version[1].'.'.$patch;

        }else{

            $this->version_apache = $version[0].'.'.$version[1];

        }

        //
        // SELECT APACHE SERVER SETTINGS

        /*

        HTTP_HOST
        HTTP_CONNECTION
        HTTP_USER_AGENT
        HTTP_ACCEPT
        HTTP_ACCEPT_ENCODING
        HTTP_ACCEPT_LANGUAGE
        HTTP_COOKIE
        SERVER_SIGNATURE
        SERVER_SOFTWARE
        SERVER_NAME
        SERVER_ADDR
        SERVER_PORT
        REMOTE_ADDR
        DOCUMENT_ROOT
        REQUEST_SCHEME
        SCRIPT_FILENAME
        GATEWAY_INTERFACE
        SERVER_PROTOCOL
        REQUEST_METHOD
        QUERY_STRING
        REQUEST_URI
        SCRIPT_NAME
         * */

    }

    public function __destruct() {

	}

}

# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: crnrstn_bitflip_manager
#  VERSION :: 1.00.0000
#  DATE :: March 4, 2021 @ 0529hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: Bit flip management.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_bitflip_manager {

    protected $oLogger;
    protected $oCRNRSTN_USR;
    protected $oCRNRSTN_BITWISE;

    protected $oCRNRSTN_BITS_ARRAY = array();

    public $lscpu_output;
    public $uname_output;
    public $getconf_output;

    protected $bit_value_array = array();

    public $os_bit_size;

    private static $bitflag_constant_serial_ARRAY = array();

    private static $crnrstn_bits_position_by_serial_ARRAY = array();

    public function __construct() {

        $this->initialize_cpu_profile();

        $this->initialize_bitwise_constants();

    }

    public function init_oCRNRSTN_USR($oCRNRSTN_USR){

        $this->oCRNRSTN_USR = $oCRNRSTN_USR;

    }

    public function return_serialized_bit_value($bitwise_object_array_index_serial, $integer_constant){

        if(!isset($this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . strtoupper(md5($bitwise_object_array_index_serial))])){

            return false;

        }else{

            $oCRNRSTN_BITMASK = $this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . strtoupper(md5($bitwise_object_array_index_serial))];

            $tmp_val = $this->return_bit_value($integer_constant);

            return $tmp_val;

        }

    }

    public function return_bit_constant($const_nom){

        //return $this->return_bit_value($const_nom);

        return constant($const_nom);

    }

    public function serialized_is_bit_set($const_nom, $integer_const){

        if(!isset($this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . strtoupper(md5($const_nom))])){

            return false;

        }else{

            //error_log(__LINE__.' '.__METHOD__.' we think the array['.$const_nom.'] index holds a oCRNRSTN_BITMASK object.');

            $oCRNRSTN_BITMASK = $this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . strtoupper(md5($const_nom))];

            //return $oCRNRSTN_BITMASK->read(constant($integer_const));
            return $oCRNRSTN_BITMASK->read($integer_const);

        }

    }

    public function serialized_bit_stringout($const_nom){

        $tmp_str = '';

        if(!isset($this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . strtoupper(md5($const_nom))])){

            return false;

        }else{

            //error_log(__LINE__.' '.__METHOD__.' we think the array['.$const_nom.'] index holds a oCRNRSTN_BITMASK object.');

            $oCRNRSTN_BITMASK = $this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . strtoupper(md5($const_nom))];

            $tmp_str = $oCRNRSTN_BITMASK->stringout();

            return $tmp_str;

        }

    }

    public function serialized_bit_stringin($const_nom, $bits_stringin){

        if(!isset($this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . strtoupper(md5($const_nom))])){

            //
            // SOURCE :: https://www.php.net/manual/en/language.operators.bitwise.php
            // AUTHOR :: icy at digitalitcc dot com :: https://www.php.net/manual/en/language.operators.bitwise.php#50299
            $oCRNRSTN_BITMASK = new crnrstn_bitmask();

            $this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . strtoupper(md5($const_nom))] = $oCRNRSTN_BITMASK;

        }

        $oCRNRSTN_BITMASK = $this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . strtoupper(md5($const_nom))];

        $oCRNRSTN_BITMASK->stringin($bits_stringin);

        $this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . strtoupper(md5($const_nom))] = $oCRNRSTN_BITMASK;

        return true;

    }

    public function initialize_serialized_bit($const_nom, $integer_const, $default_state = true){

        if(!isset($this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . strtoupper(md5($const_nom))])){

            //
            // SOURCE :: https://www.php.net/manual/en/language.operators.bitwise.php
            // AUTHOR :: icy at digitalitcc dot com :: https://www.php.net/manual/en/language.operators.bitwise.php#50299
            $oCRNRSTN_BITMASK = new crnrstn_bitmask();

            //error_log(__LINE__.' '.__METHOD__.' NEW bitmask object flipping['.$integer_const.'] to array index, '.strtoupper(md5($const_nom)));
            $this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . strtoupper(md5($const_nom))] = $oCRNRSTN_BITMASK;

        }

        $oCRNRSTN_BITMASK = $this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . strtoupper(md5($const_nom))];

        //
        // WILL BASICALLY RETURN AN INT++ FOR EACH UNIQUE CONSTANT PROVIDED.
        // USING BITMASK OBJECT FROM icy at digitalitcc dot com TO MANAGE ACTUAL
        // STORAGE, FLIP, AND RETRIEVAL...THEREFORE WE DON'T REALLY CARE ABOUT THE
        // INTEGER BEING STORED...JUST MAKE IT UNIQUE...LIKE, AUTO-INCREMENT UNIQUE.
        $tmp_val = $this->return_bit_value($integer_const);

        if($default_state){

            //
            // FLAG - STATE IS ON
            $oCRNRSTN_BITMASK->set($integer_const);

        }else{

            //
            // FLAG - STATE IS OFF
            $oCRNRSTN_BITMASK->set($integer_const);
            $oCRNRSTN_BITMASK->toggle($integer_const);

        }

        //error_log(__LINE__.' '.__METHOD__.' we put back into the array['.strtoupper(md5($const_nom)).']...a oCRNRSTN_BITMASK object.');

        $this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . strtoupper(md5($const_nom))] = $oCRNRSTN_BITMASK;

        return $tmp_val;

    }

    public function toggle_bit($integer_constant, $target_state = NULL){

        if(!isset($this->oCRNRSTN_BITWISE)){

            return false;

        }else{

            if(is_bool($target_state)){

                if($target_state == true){

                    if(!($this->oCRNRSTN_BITWISE->read($integer_constant))){

                        //
                        // FLIP TO 1
                        $this->oCRNRSTN_BITWISE->toggle($integer_constant);

                        return $this->toggle_bit($integer_constant);

                    }

                }else{

                    if($this->oCRNRSTN_BITWISE->read($integer_constant)){

                        //
                        // FLIP TO 0
                        $this->oCRNRSTN_BITWISE->toggle($integer_constant);

                    }

                }

            }else{

                //
                // FLIP IT ::
                // https://www.youtube.com/watch?v=eBShN8qT4lk
                // TITLE :: Beastie Boys - (You Gotta) Fight For Your Right (To Party) (Official Music Video)
                $this->oCRNRSTN_BITWISE->toggle($integer_constant);

            }

            return $this->oCRNRSTN_BITWISE->read($integer_constant);

        }

    }

    public function toggle_serialized_bit($const_nom, $integer_constant, $target_state = NULL){

        if(!isset($this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . strtoupper(md5($const_nom))])){

            return false;

        }

        $oCRNRSTN_BITMASK = $this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . strtoupper(md5($const_nom))];

        if(is_bool($target_state)){

            if($target_state == true){

                if(!($oCRNRSTN_BITMASK->read($integer_constant))){

                    //
                    // FLIP TO 1
                    $oCRNRSTN_BITMASK->toggle($integer_constant);

                }

            }else{

                if($oCRNRSTN_BITMASK->read($integer_constant)){

                    //
                    // FLIP TO 0
                    $oCRNRSTN_BITMASK->toggle($integer_constant);

                }

            }

        }else{

            //
            // FLIP IT ::
            // https://www.youtube.com/watch?v=eBShN8qT4lk
            // TITLE :: Beastie Boys - (You Gotta) Fight For Your Right (To Party) (Official Music Video)
            $oCRNRSTN_BITMASK->toggle($integer_constant);

        }

        $this->oCRNRSTN_BITS_ARRAY['CRNRSTN_' . strtoupper(md5($const_nom))] = $oCRNRSTN_BITMASK;

        return $oCRNRSTN_BITMASK->read($integer_constant);

    }

    public function initialize_bit($constant_nom, $default_state = false, $constant_value = NULL){

        if(!isset($this->oCRNRSTN_BITWISE)){

            //
            // SOURCE :: https://www.php.net/manual/en/language.operators.bitwise.php
            // AUTHOR :: icy at digitalitcc dot com :: https://www.php.net/manual/en/language.operators.bitwise.php#50299
            $this->oCRNRSTN_BITWISE = new crnrstn_bitmask();

        }

        if(is_int($constant_nom)){

            //
            // USE PROVIDED CONST NOM AS (INT) VALUE IF INTEGER PASSED IN AS CONSTANT NAME
            $constant_value = $constant_nom;

        }

        //
        // USING BITMASK OBJECT FROM icy at digitalitcc dot com TO MANAGE ACTUAL
        // STORAGE, FLIP, AND RETRIEVAL. THIS HERE WILL HONOR THE CONSTANT VALUES.
        $tmp_val = $this->return_bit_value($constant_nom, $constant_value);

        if($default_state){

            //
            // FLAG - STATE IS ON
            $this->oCRNRSTN_BITWISE->set($tmp_val);

        }else{

            //
            // FLAG - STATE IS OFF
            $this->oCRNRSTN_BITWISE->set($tmp_val);
            $this->oCRNRSTN_BITWISE->toggle($tmp_val);

        }

        return $tmp_val;

    }

    public function is_bit_set($integer_const){

        return $this->oCRNRSTN_BITWISE->read($integer_const);

    }

    public function bit_stringout(){

        return $this->oCRNRSTN_BITWISE->stringout();

    }

    public function bit_stringin($int_string){

        return $this->oCRNRSTN_BITWISE->stringin($int_string);

    }


    private function return_bit_value($bit_nom, $constant_value_override = null){

        if(isset($constant_value_override)){

            //
            // BIT_NOM IS THE STRING USED TO TRACK THE EXISTENCE OF UNIQUE
            // GLOBAL CONSTANTS AND THE INTEGER VALUE ASSIGNED TO THE SAME
            if(!isset($this->bit_value_array[$bit_nom])){

                $this->bit_value_array[$bit_nom] = $constant_value_override;

            }

            return $this->bit_value_array[$bit_nom];

        }else{

            if(!isset($this->bit_value_array[$bit_nom])){

                $this->bit_value_array[$bit_nom] = 1;

                $tmp_cnt = count($this->bit_value_array[$bit_nom]);

                $this->bit_value_array[$bit_nom] = $tmp_cnt;

            }

            return $this->bit_value_array[$bit_nom];

        }

    }

    private function initialize_bitwise_constants(){

        $const_file_path = dirname(__FILE__) . '/crnrstn.constants_load.inc.php';

        if(is_file($const_file_path)){

            //
            // WE USE THIS INTEGER TO THROW A LOGICAL SWITCH IN THE REQUIRE() FILE.
            $crnrstn_initialize_bits = 1;

            //
            // INCLUDE CRNRSTN :: CONSTANTS DEFINITION FILE
            //$this->error_log('addDatabase() for environment ['.$envKey.']. including and evaluating file ['.$host_or_creds_path.'].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
            require($const_file_path);

        }else{

            //
            // WE COULD NOT FIND THE DATABASE CONFIGURATION FILE
            error_log('CRNRSTN :: ERROR :: Constants definition include file ('.$const_file_path.') not recognized as a file on server ['.$_SERVER['SERVER_NAME'].'].');

        }

    }

    private function initialize_cpu_profile(){

        if(substr(PHP_OS, 0, 3) == "WIN"){

            // I DO NOT HAVE WINDOWS COMMANDS YET.
            //exec('for %I in ("'.$file.'") do @echo %~zI', $output);
            //$return = $output[0];
            $this->os_bit_size = (int)64;

        }else {

            $this->lscpu_output = shell_exec("lscpu");
            $this->uname_output = shell_exec("uname -m");
            $this->getconf_output = (int)shell_exec("getconf LONG_BIT");
            //$this->getconf_output = 128;

            if (is_numeric($this->getconf_output)) {

                $this->os_bit_size = (int)$this->getconf_output;
                //error_log(__LINE__.' '.__METHOD__.' os_bit_size='.$this->os_bit_size);

            } else {

                $pos_64 = strpos($this->uname_output, '64');

                if ($pos_64 !== false) {

                    $this->os_bit_size = (int)64;
                    //error_log(__LINE__.' '.__METHOD__.' os_bit_size='.$this->os_bit_size);

                } else {

                    $this->os_bit_size = (int)32;
                    //error_log(__LINE__.' '.__METHOD__.' os_bit_size='.$this->os_bit_size);

                }

            }

        }

    }

    //
    // METHOD SOURCE :: Stack Overflow ::  https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
    // Contributor :: https://stackoverflow.com/users/1698153/scott
    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function generate_new_key($len = 32)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet .= "0123456789";
        $max = strlen($codeAlphabet); // edited

        if (function_exists('random_int')) {
            for ($i = 0; $i < $len; $i++) {
                $token .= $codeAlphabet[random_int(0, $max - 1)];
            }
        } else {
            for ($i = 0; $i < $len; $i++) {
                $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max - 1)];
            }
        }

        return $token;

    }

    //
    // METHOD SOURCE :: Stack Overflow :: https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
    // Contributor :: https://stackoverflow.com/users/4895359/yumoji
    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    private function crypto_rand_secure($min, $max){
        $range = $max - $min;
        if ($range < 1) return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int)($log / 8) + 1; // length in bytes
        $bits = (int)$log + 1; // length in bits
        $filter = (int)(1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);
        return $min + $rnd;
    }

    public function __destruct() {


    }

}

/*
    Infinite* bits and bit handling in general.

    *Not infinite, sorry.

    Perceivably, the only limit to the bitmask class in storing bits would be
    the maximum limit of the index number, on 32 bit integer systems 2^31 - 1,
    so 2^31 * 31 - 1 = 66571993087 bits, assuming floats are 64 bit or something.
    I'm sure that's enough enough bits for anything.. I hope :D.
*/

//
// SOURCE :: https://www.php.net/manual/en/language.operators.bitwise.php
// AUTHOR :: icy at digitalitcc dot com :: https://www.php.net/manual/en/language.operators.bitwise.php#50299
class crnrstn_bitmask{
    protected $bitmask = array();

    public function set( $bit ) // Set some bit
    {
        $key = (int) ($bit / CRNRSTN_INTEGER_LENGTH);
        $bit = (int) fmod($bit,CRNRSTN_INTEGER_LENGTH);
        @$this->bitmask[$key] |= 1 << $bit;
    }

    public function remove( $bit ) // Remove some bit
    {
        $key = (int) ($bit / CRNRSTN_INTEGER_LENGTH);
        $bit = (int) fmod($bit,CRNRSTN_INTEGER_LENGTH);
        $this->bitmask[$key] &= ~ (1 << $bit);
        if(!$this->bitmask[$key])
            unset($this->bitmask[$key]);
    }

    public function toggle( $bit ) // Toggle some bit
    {
        $key = (int) ($bit / CRNRSTN_INTEGER_LENGTH);
        $bit = (int) fmod($bit,CRNRSTN_INTEGER_LENGTH);
        @$this->bitmask[$key] ^= 1 << $bit;
        if(!$this->bitmask[$key])
            unset($this->bitmask[$key]);
    }

    public function read( $bit ) // Read some bit
    {
        $key = (int) ($bit / CRNRSTN_INTEGER_LENGTH);
        $bit = (int) fmod($bit,CRNRSTN_INTEGER_LENGTH);
        return @$this->bitmask[$key] & (1 << $bit);
    }

    public function stringin($string) // Read a string of bits that can be up to the maximum amount of bits long.
    {
        $this->bitmask = array();
        $array = str_split( strrev($string), CRNRSTN_INTEGER_LENGTH );
        foreach( $array as $key => $value )
        {
            if($value = bindec(strrev($value)))
                $this->bitmask[$key] = $value;
        }
    }

    public function stringout() // Print out a string of your nice little bits
    {
        $string = "";

        $keys = array_keys($this->bitmask);

        sort($keys, SORT_NUMERIC);

        for($i = array_pop($keys);$i >= 0;$i--)
        {

            if(isset($this->bitmask[$i])) {

                $string .= sprintf("%0" . CRNRSTN_INTEGER_LENGTH . "b", $this->bitmask[$i]);
                //error_log(__LINE__.' BITMASK index is set i=['.$i.'] $string=['.$string.']');

            }else{

                //error_log(__LINE__.' BITMASK index i NOT SET i=['.$i.'] $string=['.$string.']');

            }

        }

        //return print_r(__METHOD__.' $keys='.print_r($keys, true), true);

        return $string;

    }

    public function clear() // Purge!
    {
        $this->bitmask = array();
    }

    public function debug() // See what's going on in your bitmask array
    {
        var_dump($this->bitmask);
    }

}