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
    public $oCRNRSTN_ENV;
    public $oCRNRSTN_USR;
    public $oCRNRSTN_TRM;  // TODO :: INSTANTIATION IS CURRENTLY BOUND TO THIRD PARTY SERVICE; UNBIND BEFORE USE. Thursday, August 18, 2022 @ 2134 hrs
    private static $oCRNRSTN_CONFIG_MGR;
    public $oMYSQLI_CONN_MGR;
	private static $oLog_ProfileManager;
	private static $oCommRichMediaProvider;
	public $oCRNRSTN_BITFLIP_MGR;
	public $oCRNRSTN_PERFORMANCE_REGULATOR;
    public $oCRNRSTN_ASSET_MGR;
    public $oCRNRSTN_LANG_MGR;

    //
    // THIS CAN BE MORE ROBUST (A PRETTY HTML DOCUMENT), BUT WE SHOULD HANDLE SOAP
    // (RESPONSES TO OTHER SERVERS), AS WELL...RIGHT? ERR HERE ARE SUPER LOW-LEVEL THO.
    public $destruct_output = '';

    private static $lang_content_ARRAY = array();
    private static $sys_logging_profile_ARRAY = array();
    private static $sys_logging_meta_ARRAY = array();

    private static $crnrstn_session_salt;
	private static $config_serial;
	public $config_serial_crc;
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
	public $env_err_reporting_profile_ARRAY = array();
    public $env_key;
    public $env_key_crc;
	public $env_key_ARRAY = array();
	private static $env_name_ARRAY = array();
	public $ini_set_ARRAY = array();
	
	public $grant_accessIP_ARRAY = array();
	public $deny_accessIP_ARRAY = array();
	public $add_admin_creds_ARRAY = array();

	private static $database_extension_type_ARRAY = array();

    private static $server_env_key_ARRAY = array();
	private static $server_env_key_crc_ARRAY = array();

	private static $env_select_ARRAY = array();

    public $log_silo_profile;
	public $starttime;
    public $cache_ttl_default = 80;
    public $useCURL_default = true;
	public $oLog_output_ARRAY = array();
	public $oWildCardResource_ARRAY = array();
	public $wildCardResource_filePath_ARRAY = array();
    private static $encryptable_data_types_ARRAY = array();
    private static $arch_permissions_int_const_ARRAY = array();
    public $sys_notices_creative_mode = 'ALL_IMAGE';
    public $system_resource_constants = array();
    private static $system_files_version_hash_ARRAY = array();
    public $system_style_profile_constants = array();
    public $system_output_profile_constants = array();
    public $system_output_channel_constants = array();
    public $system_database_table_prefix = 'crnrstn_';
    public $system_http_get_param_prefix = 'crnrstn_';
    public $creativeElementsKeys = array();
    public $weighted_elements_keys_ARRAY = array();
    private static $system_creative_http_path_ARRAY = array();
    private static $crnrstn_tmp_dir;
    private static $m_starttime = array();
    private static $requestProtocol;
    private static $openssl_preferred_digest_ARRAY = array();
    private static $openssl_preferred_digest;

    public $log_initial_profile_ARRAY = array();
    protected $log_initial_profile_meta_ARRAY = array();
    public $soap_permissions_file_path_ARRAY = array();
    public $wp_config_file_path_ARRAY = array();
    public $analytics_config_file_path_ARRAY = array();
    public $engagement_config_file_path_ARRAY = array();
    public $response_header_attribute_ARRAY = array();

    private static $alpha_shift_key_ARRAY = array();
    private static $alpha_shift_key_int_ARRAY = array();
    private static $alpha_shift_key_01_ARRAY = array();

    private static $CRNRSTN_debug_mode;

    private static $version_crnrstn = '2.00.0000 PRE-ALPHA-DEV (Lightsaber)';

    public function __construct($config_filepath, $CRNRSTN_config_serial, $CRNRSTN_debug_mode = 0, $PHPMAILER_debug_mode = 0, $CRNRSTN_loggingProfile = CRNRSTN_LOG_DEFAULT){

        $this->starttime = $_SERVER['REQUEST_TIME_FLOAT'];

        //
        // FORCE RE-SERIALIZATION OF SESSION WITH CONFIG FILE CHANGE. THE (P)SSDTLA (THERE SHOULD ALSO BE A
        // COOKIE TENTACLE) CAN SUPPORT PRESERVATION OF THE SESSION EVEN WITH CHANGE IN PHPSESSION ID DUE TO
        // MODIFICATION OF THE CONFIG FILE...E.G. RTM.
        $config_serial = $CRNRSTN_config_serial . '_420.00' . filesize($config_filepath) . '.' . filemtime($config_filepath) . '.0';

        self::$config_serial = $config_serial;
        $this->config_serial_crc = $this->crcINT(self::$config_serial);
        self::$CRNRSTN_debug_mode = $CRNRSTN_debug_mode;

        //
        // INITIALIZE CRNRSTN :: CONFIGURATION MANAGER
        self::$oCRNRSTN_CONFIG_MGR = new crnrstn_config_manager($this);

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

        $this->initialize_language();

        //
        // INITIALIZE ARRAY OF ENCRYPTABLE DATATYPES
        self::$encryptable_data_types_ARRAY = array('string', 'integer', 'double', 'float', 'int');

        //
        // INITIALIZE INTEGER CONSTANTS ARRAY OF FLAGS FOR THE DATA ARCHITECTURE AUTHORIZATION OF DATA
        self::$arch_permissions_int_const_ARRAY = array(CRNRSTN_AUTHORIZE_RUNTIME_ONLY, CRNRSTN_AUTHORIZE_ALL, CRNRSTN_AUTHORIZE_DATABASE, CRNRSTN_AUTHORIZE_SSDTLA, CRNRSTN_AUTHORIZE_PSSDTLA, CRNRSTN_AUTHORIZE_SESSION, CRNRSTN_AUTHORIZE_COOKIE, CRNRSTN_AUTHORIZE_SOAP, CRNRSTN_AUTHORIZE_GET);

        //
        // J5, my boy!
        // INITIALIZE ALPHA SHIFT CRYPT KEY
        // SOURCE :: https://www.php.net/manual/en/function.range.php
        // SOURCE :: https://stackoverflow.com/questions/431912/way-to-get-all-alphabetic-chars-in-an-array-in-php
        // AUTHOR :: PEZ :: https://stackoverflow.com/users/44639/pez
        $this->initialize_alpha_shift_crypt('JFIVEMYBOY');

        //
        // INITIALIZE GROUPED CONSTANTS ARRAYS
        $this->system_resource_constants = array(CRNRSTN_RESOURCE_ALL, CRNRSTN_RESOURCE_OPENSOURCE, CRNRSTN_LOG_EMAIL, CRNRSTN_LOG_EMAIL_PROXY, CRNRSTN_LOG_FILE, CRNRSTN_LOG_FILE_FTP, CRNRSTN_LOG_SCREEN_TEXT, CRNRSTN_LOG_SCREEN, CRNRSTN_LOG_SCREEN_HTML, CRNRSTN_LOG_SCREEN_HTML_HIDDEN, CRNRSTN_LOG_DEFAULT, CRNRSTN_LOG_ELECTRUM);
        $this->system_style_profile_constants = array(CRNRSTN_UI_PHPNIGHT, CRNRSTN_UI_HTML, CRNRSTN_UI_PHP, CRNRSTN_UI_FEATHER);
        $this->system_output_profile_constants = array(CRNRSTN_ASSET_MODE_PNG, CRNRSTN_ASSET_MODE_JPEG, CRNRSTN_ASSET_MODE_BASE64);
        $this->system_output_channel_constants = array(CRNRSTN_UI_DESKTOP, CRNRSTN_UI_TABLET, CRNRSTN_UI_MOBILE);
        $this->creativeElementsKeys = array('CRNRSTN ::', 'LINUX_PENGUIN', 'REDHAT_LOGO', 'APACHE_FEATHER', 'APACHE_POWER_VERSION', 'CRNRSTN_R', '5', 'MYSQL_DOLPHIN', 'PHP_ELLIPSE', 'POW_BY_PHP', 'ZEND_LOGO', 'ZEND_FRAMEWORK', 'ZEND_FRAMEWORK_3', 'REDHAT_HAT_LOGO');
        $this->generate_weighted_elements_keys(count($this->creativeElementsKeys));

        //
        // SET BITS FOR LOGGING PROFILE SILO
        $this->log_silo_profile = $CRNRSTN_loggingProfile;
        $this->oCRNRSTN_BITFLIP_MGR->initialize_bit($this->log_silo_profile, true);

        //
        // SUPPORT FOR ENRICHED DEBUGGING/LOG TRACE
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(__CLASS__, $this);

        //
        // LOGGING PROFILE MANAGER
        $sys_logging_profile_pack = $this->return_sys_logging_init_profile_pack();
        self::$oLog_ProfileManager = new crnrstn_logging_oprofile_manager($sys_logging_profile_pack, $this);

        $this->initialize_config_manager();

        //
        // INITIALIZE MULTI-LANGUAGE SUPPORT
        $this->oCRNRSTN_LANG_MGR = new crnrstn_multi_language_manager($this);

        //
        // THIS COULD BE DEVELOPED A BIT MORE. SUFFICIENT FOR SUCH A LOW LEVEL ERR THOUGH
        if(strlen($CRNRSTN_config_serial) < 1){

            $tmp_serial = $this->generate_new_key(64, -2);

            //
            // MAYBE GENERATE A CONFIG SERIAL COPY-PASTE INTO CONFIG FILE PAGE WITH BASE64 CRNRSTN :: LOGO STUFF?
            // OR MAYBE DRIVE DEVELOPMENT FORWARD ON INTO ADMIN MANAGEMENT (ACCOUNT CREATION) AND PUSH THE WEB
            // TEMPLATE FOR SOMETHING ADMIN-NEWY-ISH BACK TO "HERE" FOR CONSISTENCY.
            $this->destruct_output .= '
<div style="padding: 10px 0 0 20px;"><div style="padding: 10px 0 20px 0;"><img src="' . $this->return_creative('BG_ELEMENT_LOGO_SIGNIN', CRNRSTN_UI_IMG_BASE64) . '" height="70" alt="CRNRSTN :: v' . self::$version_crnrstn . '" title="CRNRSTN :: v' . self::$version_crnrstn . '" ></div>
<div style="text-align: left; font-family:Courier New, Courier, monospace; font-size:15px; line-height:23px; border-bottom: 0px solid #FFF;">//
<br>// ' . $this->oCRNRSTN_LANG_MGR->get_lang_copy('PLEASE_ENTER_A_CONFIG_SERIAL') . ' [rtime ' . $this->wall_time() .' secs]  
<br>$CRNRSTN_config_serial = \'' . $tmp_serial . '\'</div>
<div style="height:50px; width:100%; clear:both; display: block; overflow: hidden;">&nbsp;</div>
<pre class="debug_output">' . $this->return_CRNRSTN_ASCII_ART(8) . '</pre></div>
<div style="display:block; clear:both; height:40px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;"></div>

<div style="float:right; width:100%; padding:20px 0 0 0; margin:0; text-align: right;">
    <div class="crnrstn_j5_wolf_pup_inner_wrap">
        ' . $this->return_creative('J5_WOLF_PUP_RAND', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED) . '
    </div>
</div>
';
            $this->error_log('Please specify a configuration serial (such as [$CRNRSTN_config_serial=\'' . $tmp_serial . '\']) in the CRNRSTN :: config file.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
            error_log('Please specify a configuration serial (such as [$CRNRSTN_config_serial=\'' . $tmp_serial . '\']) in the CRNRSTN :: config file.');

            exit();

        }

        //
        // TODO :: REPLACE ALL SESSION DEPENDENCIES WITH MORE ROBUST CLASS OBJECT TO SUPPORT DATABASE INTEGRATIONS
        // See crnrstn_config_manager. Saturday, August 13, 2022 1201 hrs. WHEN WAS THIS TODO ADDED?
        self::$oCRNRSTN_CONFIG_MGR->input_data_value($this->starttime, 'starttime');
        self::$oCRNRSTN_CONFIG_MGR->input_data_value(self::$version_crnrstn, 'version_crnrstn');
        self::$oCRNRSTN_CONFIG_MGR->input_data_value($CRNRSTN_debug_mode, 'CRNRSTN_debug_mode');
        self::$oCRNRSTN_CONFIG_MGR->input_data_value($PHPMAILER_debug_mode, 'PHPMAILER_debug_mode');
//        $tmp_test_return = self::$oCRNRSTN_CONFIG_MGR->retrieve_data_value('version_crnrstn');
//
//        error_log(__LINE__ . ' crnrstn '. __METHOD__ . ' [' . $tmp_test_return . '(strlen=' . strlen($tmp_test_return) . ')].');
//        die();

        $this->response_header_attribute_ARRAY['log'] = '';
        $this->initialize_apache_profile();
        $this->initialize_php_profile();
        $this->initialize_openssl_profile();
        $this->initialize_linux_profile();

        //
        // TODO :: THIS SHOULD BE MANAGED BY THE SESSION MANAGER...RIGHT?
        if(isset($_SESSION['CRNRSTN_CONFIG_SERIAL_CRC'])) {

            $_SESSION['CRNRSTN_CONFIG_SERIAL_CRC_KEEPTIDY'] = $_SESSION['CRNRSTN_CONFIG_SERIAL_CRC'];

        }

        /*
        TARGET/OPTIMAL CRNRSTN :: SESSION PROFILE
        {SOME KIND OF 64-128 CHAR STRING (CHECK THE TABLE YOU ASS HAT) THAT WILL TIE TO SESSION PRIMARY KEY IN SESSION DATABASE TABLE}
        {A CHECKSUM AGAINST THE SYSTEM'S ENVIRONMENTAL CONFIGURATION DATA PROFILE}
        {THE RUNNING ENVIRONMENT KEY :: USED FOR DATABASE SELECTION AND SESSION LOAD FAST TRACK}
        */
        $_SESSION['CRNRSTN_CONFIG_SERIAL_CRC'] = $this->config_serial_crc;

        //$_SESSION['CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_CRC']]['CRNRSTN_START_TIME'] = $this->starttime;

        // TODO :: THIS. Saturday, August 13, 2022 @ 1313 hrs
        // THIS WOULD BE THE EARLIEST WE COULD BE READY TO HIT THE DATABASE FOR DB DRIVEN CONFIGURATION.
        // WILL NEED TO STILL MONITOR (CONFIG FILE) FOR ANY DELTA AND SUBSEQUENT CONFIG FILE DRIVEN UPDATE
        // TO DB DRIVEN CONFIG.

        //$this->oCRNRSTN_SESSION_DDO = new crnrstn_decoupled_data_object($this, $config_serial, 'CRNRSTN_' . $this->config_serial_crc . 'CRNRSTN_CONFIG_SERIAL_CRC');
        //$this->oCRNRSTN_SESSION_DDO->add($this->starttime,'CRNRSTN_' . $this->config_serial_crc . 'CRNRSTN_START_TIME');
//
//        //
//        // INSTANTIATE LOGGER
//        $this->oLogger = new crnrstn_logging(__CLASS__, $this);
        $this->error_log('SERVER / CRNRSTN :: start time [' . $this->starttime . ']', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        $this->error_log('TODO :: VERIFY COMPLETE oCRNRSTN DESTRUCTION. STILL ALIVE! Trace log stuff at no_cars_tification_go() 11/12/2020 0410 hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: EVALUATE CONFIG FILE INCLUDES PER SOAP INCLUDES STANDARDS. 11/12/2020 0412 hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: CONFIRM EXCLUSIVE USE OF ONLY-GET-WHAT-YOU-NEED-TO-oCRNRSTN_ENV ON NEW CONFIGURATION INCLUDES WITHIN CRNRSTN [oWCR, PROXY, etc.] ::. 11/13/2020 1159 hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: SET NUSOAP PHP DEBUG MODE, $NUSOAP_debugMode (CRNRSTN :: SOAP SERVICES) THROUGH CRNRSTN :: CONFIG FILE. 11/14/2020 2114 hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: WRAP NUSOAP PHP SERVER ENDPOINT IN oCRNRSTN_USR...AND PREPARE TO SUPPORT DYNAMIC WSDL ENDPOINTS ::. 11/14/2020 2114 hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: PREFIX NUSOAP PHP SERVER WSDL ENDPOINT WITH --> CONFIGURABLE ALLOW/DENY IP ADDRESS CHECK. 11/15/2020 0705 hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: TEST NULL PASSTHROUGH FROM CLIENT TO SERVER. 11/23/2020 1120 hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: DECOUPLE SOAP ENDPOINT VERSION DIRECTORY NAME (E.G. /2.0.0/) FROM ACTUAL SERVICE INVOKATION. 1/15/2021 @ 1400 hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: TTL FUNCTIONALITY ADDED TO ELECTRUM DESTINATION FTP/DIR PROFILE TO SUPPORT ROTATION. 1/25/2021 1228 hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: FACILITATE GRACEFUL ROTATION OF ENCRYPTION PROFILES. 1/27/2021 1145 hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: ENSURE GRANULAR APPLICATION OF METHOD FALSE PATHWAY :: $oCRNRSTN_USR->electrum_deleteSourceData_OnSuccess(). 2/4/2021 @1636 hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: // https://www.php.net/manual/en/language.operators.bitwise.php#108679 2/4/2021 1637 hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: // https://www.php.net/manual/en/language.operators.bitwise.php // https://www.php.net/manual/en/language.operators.bitwise.php#108679 // https://stackoverflow.com/questions/12380478/bits-counting-algorithm-brian-kernighan-in-an-integer-time-complexity & // https://stackoverflow.com/questions/16848931/how-to-fastest-count-the-number-of-set-bits-in-php 2/4/2021 1637 hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: // apache_get_version() & https://en.wikipedia.org/wiki/XML-RPC 2/10/2021 2231 hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: // https://www.percona.com/blog/2008/01/10/php-vs-bigint-vs-float-conversion-caveat/ 2/14/2021 0326 hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: PHPMailer is "Compatible with PHP 5.5 and later, including PHP 8.0". Make sure NuSOAP, MobileDetect, and CRNRSTN :: are as well. 3/10/2021 0547 hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: CONSIDER USE OF STATIC METHODS AND SHIPPING CALCULATIONS API INTEGRATIONS DONE SAME TIME AS PAYMENT GATEWAY INTEGRATIONS ::. 3/10/2021 0547 hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: May 10, 2021 1809 hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: CRNRSTN :: FORCE SESSION REFRESH ON *ALL MODIFIED* LINKED RESOURCES IN THE CONFIG-CHAIN. 11/13/2021 2102 hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: LOGIN ERR CONSIDER TRACKING STALE PASSWORD...FORCED RESET...EVEN CERTAIN STRING PATTERN BEHAVIOR. 5/13/2021 2102 hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: EXPOSE $this->lscpu_output FROM BITWISE MANAGER TO oCRNRSTN_USR [CPU MHz, Vendor ID, Byte Order...] 5/19/2021 1613 hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: FORCE DATABASE CONFIG ENV MISALIGNMENT, AND THEN CATCH IT @ LINE 303 HERE _crnrstn/class/database/mysqli/crnrstn.mysqli.inc.php] 9/17/2021 1023 hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: MIGRATE crnrstn_bassdrive_stream_manager USE OF oCRNRSTN_USR->wp_db_name() TO CRNRSTN :: NATIVE SOLUTION 11/17/2021 0543 hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->error_log('TODO :: SERIALIZE (BEHIND THE SCENES) THE BATCH ID HANDLING FOR $this->oQUERY_PROFILE_MANAGER->loadQueryProfile() 11/17/2021 1235 hrs', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        try {

            if(!array_key_exists('SERVER_ADDR', $_SERVER)){

                //
                // HOOOSTON...VE HAF PROBLEM!
                // SOURCE :: https://www.wired.com/2011/04/alt-text-spacecraft/
                $this->error_log('ERROR :: unable to load CRNRSTN ::. $_SERVER[] super global has not been initialized. If calling this program via script, try using cURL (/usr/bin/curl).', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                throw new Exception('CRNRSTN :: initialization error :: $_SERVER[] super global has not been initialized. If calling this program via script, try using cURL (/usr/bin/curl). SERVER_NAME(SERVER_ADDR)-> ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ').');

            }else{

                //
                // TODO :: REARCHITECT THIS INTO CRNRSTN :: ADMINISTRATOR SETTINGS CONFIGURATION AND MANAGEMENT
                // SOURCE :: https://datatracker.ietf.org/doc/html/rfc8017#appendix-B
                // INITIALIZE ARRAY OF OPENSSL DIGEST METHODS (RECOMMENDED BY PKCS #1: RSA Cryptography
                // Specifications Version 2.2). For the EMSA-PKCS1-v1_5 encoding method, SHA-224, SHA-256,
                // SHA-384, SHA-512, SHA-512/224, and SHA-512/256 are RECOMMENDED for new applications.
                // MD2, MD5, and SHA-1 are recommended only for compatibility with existing applications
                // based on PKCS #1 v1.5.
                self::$openssl_preferred_digest_ARRAY = array('sha256', 'sha224', 'sha384', 'sha512', 'sha512-224', 'sha512-256', 'RSA-SHA224', 'RSA-SHA256', 'RSA-SHA384', 'RSA-SHA512', 'RSA-SHA512/224', 'RSA-SHA512/256', 'md5', 'sha1', 'RSA-MD5', 'RSA-SHA1');

                $this->initialize_digest_profile();

                //
                // STORE CONFIG SERIAL KEY AND INITIALIZE MATCH COUNT
                $_SESSION['CRNRSTN_' . $this->config_serial_crc]['CRNRSTN_EXCEPTION_PREFIX'] = '';

                //
                // IF EARLY ENV DETECTION DURING define_env_resource() DUE TO SPECIFIED required_detection_matches(),
                // STORE ENV HERE:
                self::$server_env_key_crc_ARRAY[$this->config_serial_crc] = '';

                //
                // INITIALIZE DATABASE CONNECTION MANAGER.
                $this->oMYSQLI_CONN_MGR = new crnrstn_mysqli_conn_manager($this);
                $this->error_log('Instantiating mysqli database connection manager object. Ready to configure database authentication profiles.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                //
                // INITIALIZE IP ADDRESS SECURITY MANAGER
                $this->error_log('Instantiating IP security manager object with client IP of [' . $_SERVER['REMOTE_ADDR'] . '] and phpsessionid[' . session_id() . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                $this->oCRNRSTN_IPSECURITY_MGR = new crnrstn_ip_auth_manager($this);

            }

        }catch (Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }


    public function client_request_listen(){

        return $this->oCRNRSTN_USR->client_request_listen();

    }

    public function sticky_uri_listener(){

        return $this->oCRNRSTN_USR->sticky_uri_listener();

    }

    public function init_form_handling($crnrstn_form_handle, $transport_protocol = 'POST', $tunnel_encrypt_hidden_input_data = NULL){

        return $this->oCRNRSTN_USR->init_form_handling($crnrstn_form_handle, $transport_protocol, $tunnel_encrypt_hidden_input_data);

    }

    public function init_input_listener($crnrstn_form_handle = NULL, $html_dom_form_input_name = NULL, $is_required = false){

        return $this->oCRNRSTN_USR->init_input_listener($crnrstn_form_handle, $html_dom_form_input_name, $is_required);

    }

    public function init_hidden_input_listener($crnrstn_form_handle = NULL, $html_dom_form_input_name = NULL, $is_required = false, $default_val = NULL, $html_dom_form_input_id = NULL){

        return $this->oCRNRSTN_USR->init_hidden_input_listener($crnrstn_form_handle, $html_dom_form_input_name, $is_required, $default_val, $html_dom_form_input_id);

    }

    // add_validation_redirect('crnrstn_signin_flagship', '*', '*', $err_uri, $success_uri);
    public function add_validation_redirect($crnrstn_form_handle = NULL, $html_dom_form_input_name_pipe_delim = NULL, $validation_key_pipe_delim = NULL, $on_error_redirect_uri = NULL, $on_success_redirect_uri = NULL){


        return NULL;

    }

    public function form_prepopulate_input_value($crnrstn_form_handle, $html_dom_form_input_name, $force_default = false, $default_value = NULL){

        return NULL;

    }

    public function init_validation_message($crnrstn_form_handle, $html_dom_form_input_name, $message_key, $err_msg = NULL, $success_msg = NULL, $info_msg = NULL){

        return $this->oCRNRSTN_USR->init_validation_message($crnrstn_form_handle, $html_dom_form_input_name, $message_key, $err_msg, $success_msg, $info_msg);

    }

    public function receive_form_integration_packet($uri_passthrough = false, $cipher_override = NULL, $secret_key_override = NULL){

        return $this->oCRNRSTN_USR->receive_form_integration_packet($uri_passthrough, $cipher_override, $secret_key_override);

    }

    public function isvalid_data_validation_check($transport_protocol = 'POST'){

        return $this->oCRNRSTN_USR->isvalid_data_validation_check($transport_protocol);

    }

    public function initialize_crnrstn_svc_http($user_auth_check = false, $uri_passthrough = false, $cipher_override = NULL, $secret_key_override = NULL, $hmac_algorithm_override = NULL, $options_bitwise_override = NULL){

        return $this->oCRNRSTN_ENV->oHTTP_MGR->initialize_crnrstn_svc_http($user_auth_check = false, $uri_passthrough = false, $cipher_override = NULL, $secret_key_override = NULL, $hmac_algorithm_override = NULL, $options_bitwise_override = NULL);

    }

    public function isset_crnrstn_svc_http(){

        return $this->oCRNRSTN_USR->isset_crnrstn_svc_http();

    }

    public function return_err_data_validation_check($transport_protocol = 'POST'){

        return $this->oCRNRSTN_USR->return_err_data_validation_check($transport_protocol);

    }

    public function return_SOAP_SVC_debugMode(){

        return $this->oCRNRSTN_ENV->return_SOAP_SVC_debugMode();

    }

    public function return_http_form_integration_input_val($getpost_input_name, $transport_protocol = NULL){

        return $this->oCRNRSTN_USR->return_http_form_integration_input_val($getpost_input_name, $transport_protocol);

    }

    public function is_configured(){

        if (isset(self::$server_env_key_crc_ARRAY[$this->config_serial_crc])) {

            //$this->oCRNRSTN_ENV = new crnrstn_environment($this, 'session_initialization_ping');
            $this->oCRNRSTN_ENV = new crnrstn_environment($this);
            $this->oCRNRSTN_USR = $this->oCRNRSTN_ENV->return_ENV_oCRNRSTN_USR();

            return true;

        }

        return false;

    }

    public function retrieve_data_value($data_key, $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL', $index = NULL){

        return self::$oCRNRSTN_CONFIG_MGR->retrieve_data_value($data_key, $data_type_family, $index);

    }

    public function arch_permissions_int_const_ARRAY(){

        return self::$arch_permissions_int_const_ARRAY;

    }

    public function CRNRSTN_debug_mode(){

        return self::$CRNRSTN_debug_mode;

    }

    public function PHPMAILER_debug_mode(){

        return self::$oCRNRSTN_CONFIG_MGR->retrieve_data_value('PHPMAILER_debug_mode');

    }

    public function version_crnrstn(){

        return self::$oCRNRSTN_CONFIG_MGR->retrieve_data_value('version_crnrstn');

    }

    public function version_apache(){

        return self::$oCRNRSTN_CONFIG_MGR->retrieve_data_value('version_apache');

    }

    public function version_apache_sysimg(){

        return self::$oCRNRSTN_CONFIG_MGR->retrieve_data_value('version_apache_sysimg');

    }

    public function version_php(){

        return self::$oCRNRSTN_CONFIG_MGR->retrieve_data_value('version_php');

    }

    public function version_soap(){

        return self::$oCRNRSTN_CONFIG_MGR->retrieve_data_value('version_soap');

    }

    public function version_mysqli(){

        return self::$oCRNRSTN_CONFIG_MGR->retrieve_data_value('version_mysqli');

    }

    public function version_openssl(){

        return self::$oCRNRSTN_CONFIG_MGR->retrieve_data_value('version_openssl');

    }

    public function version_linux(){

        return self::$oCRNRSTN_CONFIG_MGR->retrieve_data_value('version_linux');

    }

    public function country_iso_code(){

        //return self::$oCRNRSTN_CONFIG_MGR->retrieve_data_value('country_iso_code');
        return $this->oCRNRSTN_USR->country_iso_code;

    }

    public function return_prefixed_ddo_key($data_key, $env_key, $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL'){

        $tmp_dataset_prefix_str = $this->return_dataset_nomination_prefix('string', $this->config_serial_crc, $env_key, $data_type_family);

        if($data_key == 'db'){

            error_log(__LINE__ . ' crnrstn $data_key=[' . $data_key . '] $env_key=[' . $env_key . '] $data_type_family=[' . $data_type_family . '].');
            error_log(__LINE__ . ' crnrstn prefix=[' . $tmp_dataset_prefix_str . $data_key . '].');

        }

        return $tmp_dataset_prefix_str . $data_key;

    }

    private function generate_weighted_elements_keys($cnt){

        // $this->creativeElementsKeys =
        // array('CRNRSTN ::', 'LINUX_PENGUIN', 'REDHAT_LOGO', 'APACHE_POWER_VERSION', 'APACHE_FEATHER'
        // 'CRNRSTN_R', '5','MYSQL_DOLPHIN', 'PHP_ELLIPSE',
        // 'POW_BY_PHP', 'ZEND_LOGO', 'ZEND_FRAMEWORK', 'ZEND_FRAMEWORK_3', 'REDHAT_HAT_LOGO');
        $output_ratio_ARRAY = array(6, 10, 6, 8, 5, 3, 1, 7, 7, 7, 5, 5, 5, 3);

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

        return self::$encryptable_data_types_ARRAY;

    }

    public function return_sys_logging_profile(){

        return self::$sys_logging_profile_ARRAY;

    }

    public function return_sys_logging_meta(){

        return self::$sys_logging_meta_ARRAY;

    }

    private function initialize_os(){

        if(stristr(PHP_OS, 'win')){

            $this->operating_system = 'WIN';

        }else{

            $this->operating_system = strtoupper(PHP_OS);

        }

    }

    // OPENSSL_VERSION_NUMBER parser, works from OpenSSL v.0.9.5b+ (e.g. for use with version_compare())
    // OPENSSL_VERSION_NUMBER is a numeric release version identifier for OpenSSL
    // Syntax: MNNFFPPS: major minor fix patch status (HEX)
    // The status nibble meaning: 0 => development, 1 to e => betas, f => release
    // Examples:
    // - 0x000906023 => 0.9.6b beta 3
    // - 0x00090605f => 0.9.6e release
    // - 0x1000103f  => 1.0.1c
    /**
     * @param OpenSSL version identifier as hex value $openssl_version_number
     */
    private function get_openssl_version_number($patch_as_number = false, $openssl_version_number = null) {

        if (is_null($openssl_version_number)) $openssl_version_number = OPENSSL_VERSION_NUMBER;

        $openssl_numeric_identifier = str_pad((string)dechex($openssl_version_number),8,'0',STR_PAD_LEFT);

        $openssl_version_parsed = array();
        $preg = '/(?<major>[[:xdigit:]])(?<minor>[[:xdigit:]][[:xdigit:]])(?<fix>[[:xdigit:]][[:xdigit:]])';
        $preg .= '(?<patch>[[:xdigit:]][[:xdigit:]])(?<type>[[:xdigit:]])/';

        preg_match_all($preg, $openssl_numeric_identifier, $openssl_version_parsed);

        $openssl_version = false;
        if (!empty($openssl_version_parsed)) {

            $alphabet = array(1 => 'a', 2 => 'b', 3 => 'c', 4 => 'd', 5 => 'e', 6 => 'f', 7 => 'g', 8 => 'h', 9 => 'i',
                10 => 'j', 11 => 'k', 12 => 'l', 13 => 'm', 14 => 'n', 15 => 'o', 16 => 'p', 17 => 'q', 18 => 'r',
                19 => 's', 20 => 't', 21 => 'u', 22 => 'v', 23 => 'w', 24 => 'x', 25 => 'y', 26 => 'z');

            $openssl_version = intval($openssl_version_parsed['major'][0]) . '.';
            $openssl_version .= intval($openssl_version_parsed['minor'][0]) . '.';
            $openssl_version .= intval($openssl_version_parsed['fix'][0]);

            if (!$patch_as_number && array_key_exists(intval($openssl_version_parsed['patch'][0]), $alphabet)) {

                $openssl_version .= $alphabet[intval($openssl_version_parsed['patch'][0])]; // ideal for text comparison

            }else{

                $openssl_version .= '.'.intval($openssl_version_parsed['patch'][0]); // ideal for version_compare

            }

        }

        return $openssl_version;

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.getmypid.php
    // AUTHOR :: kroczu at interia dot pl :: https://www.php.net/manual/en/function.getmypid.php#59889
    private function getpidinfo($pid, $ps_opt = 'aux'){

        $ps = shell_exec('ps ' . $ps_opt . 'p ' . $pid);
        $ps = explode('\n', $ps);

        if(count($ps) < 2){

            $this->error_log('We attempted to acquire PID information via shell_exec(), but the PID ' . $pid . ' doesn\'t seem to exist.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
            //trigger_error('PID ' . $pid . ' doesn't exists', E_USER_WARNING);

            return false;

        }

        foreach($ps as $key => $val){

            //error_log(__LINE__ . ' ' . __METHOD__ . ' [' . $key . ']' . $ps[$key]);
            $ps[$key] = explode(' ', $ps[$key]);

        }

        foreach($ps[0] as $key => $val){

            // error_log(__LINE__ . ' ' . __METHOD__ . ' $key[' . $key . ']' . ' $val[' . $val . '] ' . $ps[1][$key]);
            $pidinfo[$val] = $ps[1][$key];

            unset($ps[1][$key]);

        }

        if(is_array($ps[1])){

            //error_log(__LINE__ . ' ' . __METHOD__ . ' $val[' . $val . '] ' . $pidinfo[$val]);
            $pidinfo[$val] .= ' ' . implode(' ', $ps[1]);

        }

        return $pidinfo;

    }

    public function initialize_integer_length(){

        $tmp_os_bit_size = (int) $this->oCRNRSTN_BITFLIP_MGR->os_bit_size;

        $this->os_bit_size = $tmp_os_bit_size;

    }

    public function return_config_serial($output_format){

        if($output_format === 'crc'){

            return $this->config_serial_crc;

        }

        return self::$config_serial;

    }

    private function initialize_config_manager(){

        foreach($_SERVER as $data_key => $value){

            self::$oCRNRSTN_CONFIG_MGR->input_data_value($value, $data_key);

        }

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

    public function generate_alpha_shift_key($salt, $is_config = false){

        $tmp_shift_key = '';
        $tmp_shift_index = -1;
        $tmp_shift_cnt = count(self::$alpha_shift_key_int_ARRAY);
        $salt_upper = strtoupper($salt);
        $tmp_shift_ARRAY = str_split($salt_upper);

        $tmp_len = count($tmp_shift_ARRAY);
        for($i = 0; $i < $tmp_len; $i++ ) {

            if(isset(self::$alpha_shift_key_int_ARRAY[$tmp_shift_ARRAY[$i]])){

                $tmp_shift_index++;
                foreach(self::$alpha_shift_key_01_ARRAY[self::$alpha_shift_key_int_ARRAY[$tmp_shift_ARRAY[$i]]] as $index_shift => $value){

                    $tmp_shift_key .= self::$alpha_shift_key_01_ARRAY[$value];

                }

            }

            error_log(__LINE__ . ' crnrstn ' . __METHOD__ . '::key=' . $tmp_shift_key . '. [index]===[cnt] | [' . $tmp_shift_index . '][' . $tmp_shift_cnt . ']');
            if($tmp_shift_index === $tmp_shift_cnt){

                error_log(__LINE__ . ' crnrstn [index]===[cnt] | [' . $tmp_shift_index . '][' . $tmp_shift_cnt . ']');
                break 1;

            }

        }

        if($is_config){

            error_log(__LINE__ . ' crnrstn generate_alpha_shift_key self::$tmp_shift_key[' . print_r($tmp_shift_key,true) . ']');

            self::$crnrstn_session_salt = $tmp_shift_key;

            return $salt;

        }

        error_log(__LINE__ . ' crnrstn generate_alpha_shift_key self::$tmp_shift_key[' . print_r($tmp_shift_key,true) . ']');

        return $tmp_shift_key;

    }

    private function initialize_alpha_shift_crypt($salt){

        //
        // J5, my boy!
        // INITIALIZE ALPHA SHIFT KEY
        // SOURCE :: https://www.php.net/manual/en/function.range.php
        // SOURCE :: https://stackoverflow.com/questions/431912/way-to-get-all-alphabetic-chars-in-an-array-in-php
        // AUTHOR :: PEZ :: https://stackoverflow.com/users/44639/pez
        $str_index = -1;
        $str_01 = 0;

        $tmp_salt_ARRAY = str_split($salt);

        foreach($tmp_salt_ARRAY as $index_salt => $letter_salt){

            foreach(range('A', 'Z') as $letter){

                $break_out = false;
                $str_index++;
                if(stripos($letter_salt, $letter) !== false){

                    self::$alpha_shift_key_int_ARRAY[$letter][] = $str_index;
                    self::$alpha_shift_key_01_ARRAY[$letter][] = $str_01;

                    $break_out = true;

                    self::$alpha_shift_key_ARRAY[] = $letter;

                }

                if($str_01 === 0){

                    $str_01 = 1;

                }else{

                    $str_01 = 0;

                }

                if($break_out){

                    break 1;

                }

            }

            $str_01 = 0;
            foreach(range(0, 9) as $letter){

                $break_out = false;
                $str_index++;
                if(strpos($letter_salt, $letter) !== false) {

                    self::$alpha_shift_key_int_ARRAY[$letter] = $str_index;
                    self::$alpha_shift_key_01_ARRAY[] = $str_01;

                    $break_out = true;

                    self::$alpha_shift_key_ARRAY[] = $letter;

                }

                if($str_01 === 0){

                    $str_01 = 1;

                }else{

                    $str_01 = 0;

                }

                if($break_out){

                    break 1;

                }

            }

        }

//        error_log(__LINE__ . ' crnrstn->' . __METHOD__ . ' $salt[' . print_r($salt,true) . ']');
//        error_log(__LINE__ . ' crnrstn self::$alpha_shift_key_ARRAY[' . print_r(self::$alpha_shift_key_ARRAY,true) . ']');
//        error_log(__LINE__ . ' crnrstn self::$alpha_shift_key_int_ARRAY[' . print_r(self::$alpha_shift_key_int_ARRAY,true) . ']');
//        error_log(__LINE__ . ' crnrstn self::$alpha_shift_key_01_ARRAY[' . print_r(self::$alpha_shift_key_01_ARRAY,true) . ']');

    }

    public function set_timezone_default($timezone_id){

        self::$oCRNRSTN_CONFIG_MGR->input_data_value($timezone_id, 'timezone_default');

        //
        // List of Supported Timezones
        // https://www.php.net/manual/en/timezones.php
        return date_default_timezone_set($timezone_id);

    }

	public function set_developer_output_mode($theme_style = CRNRSTN_UI_PHPNIGHT){

        self::$oCRNRSTN_CONFIG_MGR->input_data_value($theme_style, 'developer_output_mode');

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

            error_log(__LINE__ . ' ' . get_class() . ' exception! ' . $str);
            throw new Exception('CRNRSTN :: v' . self::$version_crnrstn . ' :: ' . $str . ' This is an exception handling test from ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ').');

        } catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }


    public function initSOAP_WSDL_connectionProfile($SOAP_endpoint, $WSDL_cache_ttl, $nusoap_useCURL){

        $this->WSDL_cache_ttl_ARRAY[$this->crcINT($SOAP_endpoint)] = $WSDL_cache_ttl;
        $this->nusoap_useCURL_ARRAY[$this->crcINT($SOAP_endpoint)] = $nusoap_useCURL;

    }

    public function initSOAP_tunnelEncryptProfile($SOAP_endpoint, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override){

        $this->secret_key_override_ARRAY[$this->crcINT($SOAP_endpoint)] = $secret_key_override;
        $this->cipher_override_ARRAY[$this->crcINT($SOAP_endpoint)] = $cipher_override;
        $this->hmac_algorithm_override_ARRAY[$this->crcINT($SOAP_endpoint)] = $hmac_algorithm_override;
        $this->options_bitwise_override_ARRAY[$this->crcINT($SOAP_endpoint)] = $options_bitwise_override;

    }

    public function SOAP_isset_soap_client(){

        if(isset($this->oSoapClient)){

            return $this->oSoapClient->isset_soap_client();

        }else{

            return false;

        }

    }

    public function SOAP_return_client_request(){

        try{

            if(isset($this->oSoapClient)){

                return $this->oSoapClient->returnClientRequest();

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No SOAP request has been sent, leaving the oSoapClient object uninstantiated and, therefore, unable to return a client request.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    public function SOAP_return_client_response(){

        try{

            if(isset($this->oSoapClient)){

                return $this->oSoapClient->returnClientResponse();

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No SOAP request has been sent, leaving the oSoapClient object uninstantiated and, therefore, unable to return a client response.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    public function SOAP_return_result(){

        try{

            if(isset($this->oSoapClient)){

                return $this->oSoapClient->returnResult();

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No SOAP request has been sent, leaving the oSoapClient object uninstantiated and, therefore, unable to return a result from a SOAP server.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    public function SOAP_return_client_get_debug(){

        try{

            if(isset($this->oSoapClient)){

                return $this->oSoapClient->returnClientGetDebug();

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No SOAP request has been sent, leaving the oSoapClient object uninstantiated and, therefore, unable to return any SOAP client debug information.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    public function SOAP_return_error(){

        try{

            if(isset($this->oSoapClient)){

                return $this->oSoapClient->returnError();

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No SOAP request has been sent, leaving the oSoapClient object uninstantiated and, therefore, unable to return any SOAP request error information.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    public function isAuthorized_SOAP_request($CRNRSTN_SOAP_SVC_AUTH_KEY, $USERNAME, $PASSWORD, $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES, $CRNRSTN_SOAP_SVC_METHOD_REQUESTED, $CRNRSTN_SOAP_ACTION_TYPE){

        return $this->oCRNRSTN_ENV->isAuthorized_SOAP_request($CRNRSTN_SOAP_SVC_AUTH_KEY, $USERNAME, $PASSWORD, $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES, $CRNRSTN_SOAP_SVC_METHOD_REQUESTED, $CRNRSTN_SOAP_ACTION_TYPE);

    }

    public function return_sys_logging_init_profile_pack(){

        $tmp_array = array();

        if(isset(self::$sys_logging_profile_ARRAY[$this->config_serial_crc][CRNRSTN_LOG_ALL])){

            //
            // PARALLEL STORAGE IN USE BY ENVIRONMENTAL CLASS OBJECT
            $tmp_array['sys_logging_profile_ARRAY'] = self::$sys_logging_profile_ARRAY[$this->config_serial_crc][CRNRSTN_LOG_ALL];
            $tmp_array['sys_logging_meta_ARRAY'] = self::$sys_logging_meta_ARRAY[$this->config_serial_crc][CRNRSTN_LOG_ALL];
            $tmp_array['sys_logging_wcr_ARRAY'] = $this->oWildCardResource_ARRAY[$this->config_serial_crc][CRNRSTN_LOG_ALL];

        }

        return $tmp_array;

    }

    public function add_soap($env_key, $soap_permissions_file_path){

        //
        // TODO :: WE NEED TO MOVE THIS BEHIND ADMIN LOGIN.
        //error_log(__LINE__ . ' crnrstn - [' . $env_key . '][' . $soap_permissions_file_path . ']');
        $this->soap_permissions_file_path_ARRAY[$this->config_serial_crc][$this->crcINT($env_key)][] = $soap_permissions_file_path;

    }

    public function add_wordpress($env_key, $crnrstn_wp_config_file_path){

        if(isset(self::$server_env_key_crc_ARRAY[$this->config_serial_crc])) {

            if ($env_key == CRNRSTN_RESOURCE_ALL || self::$server_env_key_crc_ARRAY[$this->config_serial_crc] == $this->crcINT($env_key)) {

                self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_wp_config_file_path, 'crnrstn_wp_config_file_path',NULL,NULL,CRNRSTN_AUTHORIZE_RUNTIME_ONLY, $env_key);

                //
                // TODO :: WE CAN RUN THIS (NOT DUMB STORE IT). WE KNOW THE ENVIRONMENT NOW.
                //$this->wp_config_file_path_ARRAY[$this->config_serial_crc][$this->crcINT($env_key)][] = $crnrstn_wp_config_file_path;

            }

        }

    }

    public function add_analytics_seo($env_key, $crnrstn_analytics_config_file_path){

        if(isset(self::$server_env_key_crc_ARRAY[$this->config_serial_crc])) {

            if ($env_key == CRNRSTN_RESOURCE_ALL || self::$server_env_key_crc_ARRAY[$this->config_serial_crc] == $this->crcINT($env_key)) {

                self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_analytics_config_file_path, 'crnrstn_analytics_config_file_path',NULL,NULL,CRNRSTN_AUTHORIZE_RUNTIME_ONLY, $env_key);

                //
                // TODO :: WE CAN RUN THIS (NOT DUMB STORE IT). WE KNOW THE ENVIRONMENT NOW.
                //$this->analytics_config_file_path_ARRAY[$this->config_serial_crc][$this->crcINT($env_key)][] = $crnrstn_analytics_config_file_path;

            }

        }

    }

    public function add_engagement_tag_seo($env_key, $crnrstn_engagement_config_file_path){

        if(isset(self::$server_env_key_crc_ARRAY[$this->config_serial_crc])) {

            if ($env_key == CRNRSTN_RESOURCE_ALL || self::$server_env_key_crc_ARRAY[$this->config_serial_crc] == $this->crcINT($env_key)) {

                self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_engagement_config_file_path, 'crnrstn_engagement_config_file_path',NULL,NULL,CRNRSTN_AUTHORIZE_RUNTIME_ONLY, $env_key);

                //
                // TODO :: WE CAN RUN THIS (NOT DUMB STORE IT). WE KNOW THE ENVIRONMENT NOW.
                $this->engagement_config_file_path_ARRAY[$this->config_serial_crc][$this->crcINT($env_key)][] = $crnrstn_engagement_config_file_path;

            }

        }

    }

    public function init_encryption($env_key, $crnrstn_openssl_config_file_path){

        try{

            if(isset(self::$server_env_key_crc_ARRAY[$this->config_serial_crc])){

                if(is_file($crnrstn_openssl_config_file_path)){

                    if($env_key == CRNRSTN_RESOURCE_ALL || self::$server_env_key_crc_ARRAY[$this->config_serial_crc] == $this->crcINT($env_key)){

                        //
                        // ACQUIRE FILE VERSIONING CHECKSUM
                        $tmp_file_md5 = md5_file($crnrstn_openssl_config_file_path);
                        self::$system_files_version_hash_ARRAY[$crnrstn_openssl_config_file_path] = $tmp_file_md5;

                        //
                        // EXTRACT RESOURCE CONFIGURATION FROM FILE
                        $this->error_log('Including and evaluating file [' . $crnrstn_openssl_config_file_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                        include_once($crnrstn_openssl_config_file_path);

                    }

                }else{

                    //
                    // WE COULD NOT FIND THE OPENSSL ENCRYPTION CONFIGURATION FILE
                    $this->error_log('NOTICE :: File path data not recognized as a file. [' . $crnrstn_openssl_config_file_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                }

            }

            //
            // WE DON'T HAVE THE ENVIRONMENT, BUT DETECTION WOULD HAVE ALREADY BEEN COMPLETED.
            //throw new Exception('Unable to process system resource for environment [' . self::$server_env_key_crc_ARRAY[$this->config_serial_crc] . '].');
            $this->error_log('NOTICE :: File path data not recognized as a file. [' . $crnrstn_openssl_config_file_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        } catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN NOTHING
            return false;

        }

    }

    public function define_system_resources($env_key, $crnrstn_resource_config_file_path){

        try{

            if(isset(self::$server_env_key_crc_ARRAY[$this->config_serial_crc])){

                if($env_key == CRNRSTN_RESOURCE_ALL || (self::$server_env_key_crc_ARRAY[$this->config_serial_crc] == $this->crcINT($env_key))) {

                    if (is_file($crnrstn_resource_config_file_path)) {

                        //
                        // ACQUIRE FILE VERSIONING CHECKSUM
                        $tmp_file_md5 = md5_file($crnrstn_resource_config_file_path);
                        self::$system_files_version_hash_ARRAY[$crnrstn_resource_config_file_path] = $tmp_file_md5;

                        //
                        // EXTRACT RESOURCE CONFIGURATION FROM FILE
                        $this->error_log('Including and evaluating file [' . $crnrstn_resource_config_file_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                        include_once($crnrstn_resource_config_file_path);

                    } else {

                        //
                        // WE COULD NOT FIND THE CONFIGURATION FILE
                        $this->error_log('NOTICE :: File path data not recognized as a file. [' . $crnrstn_resource_config_file_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        //throw new Exception('Unable to process system resource for environment [' . self::$server_env_key_crc_ARRAY[$this->config_serial_crc] . '].');

                    }

                }

            }

        } catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN NOTHING
            return false;

        }

    }

    public function embryonic_init_crnrstn_tmp_dir($dir_path){

        if(is_dir($dir_path)){

            self::$crnrstn_tmp_dir = rtrim($dir_path,DIRECTORY_SEPARATOR);
            $this->error_log('Embryonic /tmp directory path ' . $dir_path . ' has been stored.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        }else{

            $this->error_log('Skipping embryonic /tmp directory path, ' . $dir_path . '. This has not been applied.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

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

        self::$sys_logging_profile_ARRAY[$this->config_serial_crc][CRNRSTN_LOG_ALL][] = $CRNRSTN_loggingProfile;

        if(isset($CRNRSTN_loggingMeta)){

            self::$sys_logging_meta_ARRAY[$this->config_serial_crc][CRNRSTN_LOG_ALL][] = $CRNRSTN_loggingMeta;

        }else{

            self::$sys_logging_meta_ARRAY[$this->config_serial_crc][CRNRSTN_LOG_ALL][] = '0';

        }

        //
        // PROCESS META DATA
        $this->error_log('Embryonic logging profile data (int) ' . $CRNRSTN_loggingProfile . ' has been received.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

    }

    public function save_wildcard_resource($oWildCardResource){

       $this->augmentWCR_array($oWildCardResource);

    }

    private function augmentWCR_array($oWCR){

        $tmp_array = array();

        $tmp_array[$oWCR->return_resource_key()] = $oWCR;
        $this->oWildCardResource_ARRAY[$this->config_serial_crc][CRNRSTN_LOG_ALL][] = $tmp_array;

    }

    public function return_m_start_time(){

	    return self::$m_starttime;

    }

	public function remove_previous_sess_env_detect_data(){

	    $tmp_session_array = array();

        if(isset($_SESSION['CRNRSTN_CONFIG_SERIAL_CRC_KEEPTIDY'])) {

	        foreach($_SESSION as $key => $value) {

                if($key == 'CRNRSTN_' . $_SESSION['CRNRSTN_CONFIG_SERIAL_CRC_KEEPTIDY']){

                    $this->error_log('Removing memory leak associated with data stored behind obsolete SESSION key[' . $key . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                }else{

                    $tmp_session_array[$key] = $value;

                }

            }

            $_SESSION = $tmp_session_array;

        }

    }

	public function returnSystemCreative($env_key){

        //
        // TODO :: THIS FUNCTIONALITY SHOULD BE ADAPTED FOR WHITE LABEL FOR ALL SYSTEM NOTIFICATIONS.
        try{

            if(isset(self::$system_creative_http_path_ARRAY[$this->config_serial_crc][$env_key])){

                return self::$system_creative_http_path_ARRAY[$this->config_serial_crc][$env_key];

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to locate a CRNRSTN :: system images HTTP path related to the serialization of this CRNRSTN :: configuration file and the environment, "' . $env_key . '".');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

	public function init_sys_assets_transport_mode($system_asset_mode = CRNRSTN_ASSET_MODE_BASE64){

        self::$oCRNRSTN_CONFIG_MGR->input_data_value($system_asset_mode, 'crnrstn_sys_assets_transport_mode');

        $this->oCRNRSTN_BITFLIP_MGR->initialize_bit($system_asset_mode, true);

        return true;

    }

    public function init_sys_comm_img_HTTP_DIR($env_key, $crnrstn_images_http_dir){

        $tmp_env_key_crc = $this->crcINT($env_key);

        if(isset(self::$server_env_key_crc_ARRAY[$this->config_serial_crc])){

            if ($env_key == CRNRSTN_RESOURCE_ALL || self::$server_env_key_crc_ARRAY[$this->config_serial_crc] == $tmp_env_key_crc) {

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

                //
                // TODO :: FOLLOW THIS ARRAY AND REPLACE IT EVERYWHERE WITH THE $oCRNRSTN_CONFIG_MGR
                self::$system_creative_http_path_ARRAY[$this->config_serial_crc][$this->crcINT($env_key)] = $crnrstn_images_http_dir;

                self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_images_http_dir, 'crnrstn_resources_http_path', 'CRNRSTN_SYSTEM_RESOURCE::HTTP_IMAGES', 0, NULL, $env_key);

            }

        }

        return true;

    }

	public function set_CRNRSTN_as_err_handler($env_key, $crnrstn_is_active = true, $error_types_profile = NULL){

        $tmp_env_key_crc = $this->crcINT($env_key);
//	    $this->crnrstn_as_error_handler_ARRAY[$this->config_serial_crc][$tmp_env_key_crc] = $crnrstn_is_active;
//	    $this->crnrstn_as_error_handler_constants_ARRAY[$this->config_serial_crc][$tmp_env_key_crc] = $error_types_profile;

        try{

            if(isset(self::$server_env_key_crc_ARRAY[$this->config_serial_crc])){

                if($env_key == CRNRSTN_RESOURCE_ALL || self::$server_env_key_crc_ARRAY[$this->config_serial_crc] == $tmp_env_key_crc) {

                    self::$oCRNRSTN_CONFIG_MGR->input_data_value($crnrstn_is_active, 'is_active_CRNRSTN_as_err_handler', NULL, NULL, NULL, $env_key);
                    self::$oCRNRSTN_CONFIG_MGR->input_data_value($error_types_profile, 'profile_CRNRSTN_as_err_handler', NULL, NULL, NULL, $env_key);

                    if($crnrstn_is_active){

                        $this->error_log('Resetting error handling at this server to the PHP defaults.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);
                        restore_error_handler();

                        if(isset($error_types_profile)) {

                            $this->error_log('Initializing CRNRSTN :: to handle errors at this server per a custom error level constants reporting profile represented as an aggregate by the integer value, ' . $error_types_profile . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);
                            $this->apply_CRNRSTN_asErrorHandler($error_types_profile);

                        }else{

                            $this->error_log('Initializing CRNRSTN :: to handle errors at this server per the default PHP error level constants reporting profile. For PHP 5.3 or later, the default is E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);
                            $this->apply_CRNRSTN_asErrorHandler($error_types_profile);

                        }

                    } else {

                        $this->error_log('Resetting error handling at this server to the PHP defaults. For PHP 5.3 or later, the default is E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);
                        restore_error_handler();

                    }

                }

                return true;

            }

            //
            // WE DON'T HAVE THE ENVIRONMENT, BUT DETECTION WOULD HAVE ALREADY BEEN COMPLETED.
            //throw new Exception('Unable to process encryption profile for environment [' . self::$server_env_key_crc_ARRAY[$this->config_serial_crc] . '].');
            $this->error_log('Bypassed initialization of CRNRSTN :: as error handler for environment [' . $tmp_env_key_crc . '/' . $env_key . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        } catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN NOTHING
            return false;

        }

        return false;

    }

    private function apply_CRNRSTN_asErrorHandler($error_types_profile = NULL){

        if(isset($error_types_profile)){

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

                    $errstr = $_SESSION['CRNRSTN_' . $this->config_serial_crc]['CRNRSTN_EXCEPTION_PREFIX'] . $errstr;
                    $_SESSION['CRNRSTN_' . $this->config_serial_crc]['CRNRSTN_EXCEPTION_PREFIX'] = '';

                    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);

                } catch (Exception $e) {

                    //
                    // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
                    $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

                    return false;

                }

            }, (int) $error_types_profile);

        }else{

            $old_error_handler = set_error_handler(function($errno, $errstr, $errfile, $errline, $errcontext){

                try{

                    // error was suppressed with the @-operator
                    if(0 === error_reporting()){

                        return false;

                    }

                    $errstr = $_SESSION['CRNRSTN_' . $this->config_serial_crc]['CRNRSTN_EXCEPTION_PREFIX'] . $errstr;
                    $_SESSION['CRNRSTN_' . $this->config_serial_crc]['CRNRSTN_EXCEPTION_PREFIX'] = '';

                    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);

                } catch (Exception $e) {

                    //
                    // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
                    $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

                    return false;

                }

            });

        }

        return true;

    }

	public function add_wildcards($env_key, $filepathWildCardResource){

        $this->wildCardResource_filePath_ARRAY[$this->config_serial_crc][$this->crcINT($env_key)] = $filepathWildCardResource;

        return true;

    }

	public function add_environment($env_key, $err_reporting_profile){

        $this->error_log('Environment key [' . $env_key . '] converts to checksum [' . $this->crcINT($env_key) . '] and will be referenced as such from time to time. ', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        try{

            $env_key_crc = $this->crcINT($env_key);

            if(!isset($this->env_err_reporting_profile_ARRAY[$this->config_serial_crc][$env_key_crc])){

                $this->env_key_ARRAY[$this->config_serial_crc][$env_key_crc] = $env_key;
                $this->env_err_reporting_profile_ARRAY[$this->config_serial_crc][$env_key_crc] = $err_reporting_profile;
                self::$env_detect_ARRAY[$this->config_serial_crc][$env_key_crc] = 0;
                self::$env_name_ARRAY[$this->config_serial_crc][$env_key_crc] = $env_key_crc;

                $this->error_log('Storing environment [' . $env_key . '|' . $env_key_crc . '] in memory.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

            }else{

                //
                // 	THIS KEY HAS ALREADY BEEN INITIALIZED
                $this->error_log('ERROR :: there are duplicate environment keys being passed to addEnvironment().', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                throw new Exception('CRNRSTN :: initialization warning :: This environmental key (' . $env_key . '|' . $env_key_crc . ') has already been initialized.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

		return true;

	}

    public function init_logging($env_key, $CRNRSTN_loggingProfile = CRNRSTN_LOG_DEFAULT, $CRNRSTN_loggingMeta = NULL){

        //
        // PROCESS BITWISE DATA DO THIS AFTER ENVIRONMENTAL DETECTION
        //$this->oCRNRSTN_BITFLIP_MGR->oCRNRSTN_BITWISE->set($CRNRSTN_loggingProfile, true);
        //error_log(__LINE__ .' '. __METHOD__ .' crnrstn_environment to receive logging array[' . $this->crcINT($this->config_serial).'][' . $this->crcINT($env_key).']=[' . $CRNRSTN_loggingProfile . ']');
        self::$sys_logging_profile_ARRAY[$this->config_serial_crc][$this->crcINT($env_key)][] = $CRNRSTN_loggingProfile;

        if(isset($CRNRSTN_loggingMeta)){

            self::$sys_logging_meta_ARRAY[$this->config_serial_crc][$this->crcINT($env_key)][] = $CRNRSTN_loggingMeta;

        }else{

            self::$sys_logging_meta_ARRAY[$this->config_serial_crc][$this->crcINT($env_key)][] = '0';

        }

        //
        // PROCESS META DATA
        $this->error_log('Logging profile data has been received for [' . $env_key . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        return true;

    }

    public function return_logging_profile($env_key){

        return self::$sys_logging_profile_ARRAY[$this->config_serial_crc][$env_key];

    }

    public function return_logging_meta($env_key){

        return self::$sys_logging_meta_ARRAY[$this->config_serial_crc][$env_key];

    }
	
	public function grant_exclusive_access($env_key, $ipOrFile){

		$this->grant_accessIP_ARRAY[$this->config_serial_crc][$this->crcINT($env_key)] = $ipOrFile;

		$this->error_log('storing grant_exclusive_access IP profile [' . $ipOrFile . '] in memory for environment key [' . $env_key . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

		return true;

	}
	
	public function deny_access($env_key, $ipOrFile){

        $this->deny_accessIP_ARRAY[$this->config_serial_crc][$this->crcINT($env_key)] = $ipOrFile;

        $this->error_log('storing deny_access IP profile [' . $ipOrFile . '] in memory for environment key [' . $env_key . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

		return true;

	}

    public function returnDbType($type_id=0){

        try{

            $databaseExtensionTypes = array(0 => 'MySQLi', 1 => 'MySQL', 2 => 'PostGreSQL', 3 => 'SYBASE', 4 => 'IBM-DB2', 5 => 'Oracle Database', 6 => 'MSSQL');

            if(isset($databaseExtensionTypes[$type_id])){

                return $databaseExtensionTypes[$type_id];

            }else{

                $this->error_log('ERROR :: returnDbType() is being called with reference to a value(' . $type_id . ') that is outside permissible range of [0-6].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                throw new Exception('CRNRSTN :: initialization warning :: returnDbType() is being called with reference to a value(' . $type_id . ') that is outside permissible range of [0-6]');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function specifyDatabaseExtension($env_key, $type){

        $this->error_log('CRNRSTN :: Specify database extension. Database type=[' . $type . '] specified for environment=[' . $env_key . '] on server [' . $_SERVER['SERVER_NAME'] . ']', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        self::$database_extension_type_ARRAY[$this->config_serial_crc][$this->crcINT($env_key)] = $type;

    }

    public function add_database($env_key, $host_or_creds_path, $un = NULL, $pwd = NULL, $db = NULL, $port = NULL){

		//
		// HANDLE PATH TO DATABASE CONFIG FILE (E.G. ONLY 2 PARAMS PROVIDED)
		if($db == NULL){

            try{

                if(isset(self::$server_env_key_crc_ARRAY[$this->config_serial_crc])){

                    if($env_key == CRNRSTN_RESOURCE_ALL || self::$server_env_key_crc_ARRAY[$this->config_serial_crc] == $this->crcINT($env_key)) {

                        if (is_file($host_or_creds_path)) {

                            //
                            // ACQUIRE FILE VERSIONING CHECKSUM
                            $tmp_file_md5 = md5_file($host_or_creds_path);
                            self::$system_files_version_hash_ARRAY[$host_or_creds_path] = $tmp_file_md5;

                            //
                            // EXTRACT RESOURCE CONFIGURATION FROM FILE
                            $this->error_log('Including and evaluating file [' . $host_or_creds_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                            include_once($host_or_creds_path);

                        } else {

                            //
                            // WE COULD NOT FIND THE CONFIGURATION FILE
                            $this->error_log('NOTICE :: File path data not recognized as a file. [' . $host_or_creds_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                            //
                            // WE DON'T HAVE THE ENVIRONMENT, BUT DETECTION WOULD HAVE ALREADY BEEN COMPLETED.
                            //throw new Exception('Unable to process system resource for environment [' . self::$server_env_key_crc_ARRAY[$this->config_serial_crc] . '].');

                        }

                    }

                }

            } catch( Exception $e ) {

                //
                // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
                $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

                //
                // RETURN NOTHING
                return false;

            }

		}else{
			
			//
			// SEND DATABASE CONFIGURATION PARAMETERS TO THE CONNECTION MANAGER
            $this->error_log('addDatabase() for environment [' . $env_key . '] sending database authentication profile [db->##### REDACTED ##### | un->##### REDACTED ##### |...etc.] to connection manager.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

			$this->oMYSQLI_CONN_MGR->add_connection($env_key, $host_or_creds_path, $un, $pwd, $db, $port);

		}
		
		return true;

	}

	public function add_administration($env_key, $email_or_creds_path, $pwd = NULL, $ttl = 120, $max_login_attempts = 10){

        //
        // HANDLE PATH TO DATABASE CONFIG FILE (E.G. ONLY 2 PARAMS PROVIDED)
        if($pwd == NULL){

            try{

                if(isset(self::$server_env_key_crc_ARRAY[$this->config_serial_crc])){

                    if($env_key == CRNRSTN_RESOURCE_ALL || self::$server_env_key_crc_ARRAY[$this->config_serial_crc] == $this->crcINT($env_key)) {

                        if (is_file($email_or_creds_path)) {

                            //
                            // ACQUIRE FILE VERSIONING CHECKSUM
                            $tmp_file_md5 = md5_file($email_or_creds_path);
                            self::$system_files_version_hash_ARRAY[$email_or_creds_path] = $tmp_file_md5;

                            //
                            // EXTRACT RESOURCE CONFIGURATION FROM FILE
                            $this->error_log('Including and evaluating file [' . $email_or_creds_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                            include_once($email_or_creds_path);

                        } else {

                            //
                            // WE COULD NOT FIND THE CONFIGURATION FILE
                            $this->error_log('NOTICE :: File path data not recognized as a file. [' . $email_or_creds_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                            //
                            // WE DON'T HAVE THE ENVIRONMENT, BUT DETECTION WOULD HAVE ALREADY BEEN COMPLETED.
                            //throw new Exception('Unable to process system resource for environment [' . self::$server_env_key_crc_ARRAY[$this->config_serial_crc] . '].');

                        }

                    }

                }

            } catch( Exception $e ) {

                //
                // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
                $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

                //
                // RETURN NOTHING
                return false;

            }

        }else{

            //
            // STORE ADMINISTRATOR CONFIGURATION PARAMETERS
            $this->error_log('add_administration() for environment [' . $env_key . '] storing Administrative authentication profile [email->' . $this->strSanitize($email_or_creds_path, 'email_private') . '| pwd->##### REDACTED ##### |$ttl->' . $ttl . '|$max_login_attempts->' . $max_login_attempts . '.] within CRNRSTN ::.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

            $this->add_administrator($env_key, $email_or_creds_path, $pwd, $ttl, $max_login_attempts);

        }

        return true;

    }

    public function set_max_login_attempts($env_key, $max_login_attempts){

        self::$oCRNRSTN_CONFIG_MGR->input_data_value($max_login_attempts, 'max_login_attempts', NULL, NULL, NULL, $env_key);

    }

    public function set_timeout_user_inactive($env_key, $secs){

        self::$oCRNRSTN_CONFIG_MGR->input_data_value($secs, 'timeout_user_inactive', NULL, NULL, NULL, $env_key);

    }

    private function add_administrator($env_key, $email, $temporary_pwd, $ttl, $maxlogin_attempts = 10){

        self::$oCRNRSTN_CONFIG_MGR->input_data_value($email, 'email', NULL, NULL, CRNRSTN_AUTHORIZE_ISPASSWORD, $env_key);
        self::$oCRNRSTN_CONFIG_MGR->input_data_value(md5($temporary_pwd), 'pwd_hash', NULL, NULL, CRNRSTN_AUTHORIZE_ISEMAIL, $env_key);
        self::$oCRNRSTN_CONFIG_MGR->input_data_value($ttl, 'ttl', NULL, NULL, NULL, $env_key);
        self::$oCRNRSTN_CONFIG_MGR->input_data_value($maxlogin_attempts, 'maxlogin_attempts', NULL, NULL, NULL, $env_key);

        $this->error_log('Storing administrative credential profile information for email [' . $this->strSanitize($email, 'email_private') . '] in memory for environment key [' . $env_key . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        return true;

    }

    public function detect_environment($env_key, $data_key, $value, $required_server_matches = 1){

        if(!isset(self::$env_select_ARRAY[$this->config_serial_crc])){

            if($required_server_matches < 0){

                $required_server_matches = 0;

            }

            $env_key_crc = $this->crcINT($env_key);

            //
            // FOR FASTEST DISCOVERY, RUN ENVIRONMENTAL DETECTION AHEAD OF INITIALIZATION OF AS MANY RESOURCE
            // DEFINITIONS AS ARCHITECTURALLY POSSIBLE...IF WE DON'T SNAG THE ENV CONFIG FROM THE SSDTLA, FIRST!
            if($this->detectServerEnv($env_key_crc, $data_key, $value, $required_server_matches)){

                $this->env_key = $env_key;
                $this->env_key_crc = $env_key_crc;
                self::$server_env_key_ARRAY[$this->config_serial_crc] = $env_key;
                self::$server_env_key_crc_ARRAY[$this->config_serial_crc] = $env_key_crc;

                $_SESSION['CRNRSTN_ENV_KEY'] = $env_key;

                $this->error_log('Environmental detection complete. Setting application server app key for CRNRSTN :: config serial [' . $this->config_serial_crc . '] to [' . $env_key_crc . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

            }

        }

    }

    private function detectServerEnv($env_key_crc, $data_key, $value, $required_server_matches) {

        //
        // CHECK THE ENVIRONMENTAL DETECTION KEYS FOR MATCHES AGAINST THE SERVER CONFIGURATION
        if(array_key_exists($data_key, $_SERVER)){

            $this->error_log('We have a SERVER param [' . $data_key . '] to check value [' . $value . '] for match against actual SERVER[].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

            //error_log(__LINE__ . ' crnrstn ' . __METHOD__ . ' We have a SERVER param [' . $data_key . '] to check value [' . $value . '] for match against actual SERVER[].');

            return $this->isServerKeyMatch($env_key_crc, $data_key, $value, $required_server_matches);

        }else{

            return false;

        }

    }

    private function isServerKeyMatch($env_key_crc, $data_key, $value, $required_server_matches){

        //
        // RUN VALUE COMPARISON FOR INCOMING VALUE AND DATA FROM THE SERVERS' SUPER GLOBAL VARIABLE ARRAY
        //error_log(__LINE__ . ' crnrstn SERVER match [' . $data_key . '/' . $_SERVER[$data_key] . '] with value [' . $value . ']');
        if($value == $_SERVER[$data_key]){

            $this->error_log('SERVER match found for key [' . $data_key . '] with value [' . $value . '] Increment detection count [' . self::$env_detect_ARRAY[$this->config_serial_crc][$env_key_crc] . '] for environment [' . $env_key_crc . ']. Need [' . $required_server_matches . '] matches to detect environment (if 0, then must process all config data).', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
            //error_log(__LINE__ . ' crnrstn SERVER match found for key [' . $data_key . '] with value [' . $value . '] Increment detection count [' . self::$env_detect_ARRAY[$this->config_serial_crc][$env_key_crc] . ' of ' . $required_server_matches . '] for environment [' . $env_key_crc . '].');

            //
            // INCREMENT FOR EACH MATCH.
            self::$env_detect_ARRAY[$this->config_serial_crc][$env_key_crc]++;
            //error_log(__LINE__ . ' crnrstn Detection count [' . self::$env_detect_ARRAY[$this->config_serial_crc][$env_key_crc] . ' of ' . $required_server_matches . '].');

        }

        //
        // FIRST $ENV TO REACH $envDetectRequiredCnt...YOU KNOW YOU HAVE QUALIFIED MATCH.
        if(self::$env_detect_ARRAY[$this->config_serial_crc][$env_key_crc] >= $required_server_matches){

            //
            // WE HAVE AN ENVIRONMENTAL DEFINITION WITH A SUFFICIENT NUMBER OF SUCCESSFUL MATCHES TO THE RUNNING ENVIRONMENT
            // AS DEFINED BY THE CRNRSTN :: CONFIG FILE
            self::$env_select_ARRAY[$this->config_serial_crc] = $env_key_crc;

            $this->error_log('Environmental detection complete. CRNRSTN :: selected environmental profile [' . $env_key_crc . '] running with CRNRSTN :: serialization of [' . $this->config_serial_crc . '] and phpsession[' . session_id() . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
            //error_log(__LINE__ . ' crnrstn Environmental detection complete. CRNRSTN :: selected environmental profile [' . $env_key_crc . '] running with CRNRSTN :: serialization of [' . $this->config_serial_crc . '] and phpsession[' . session_id() . '].');

            return true;

        }else{

            //
            // EVIDENCE OF A MATCH...STILL NOT SUFFICIENT
            return false;

        }

    }

    public function retrieve_data_count($env_key, $data_key, $data_type_family = 'CRNRSTN::RESOURCE'){

        self::$oCRNRSTN_CONFIG_MGR->retrieve_data_count($data_key, $data_type_family, $env_key);

    }

    public function input_data_value_simple($data_key, $data_value){

        return self::$oCRNRSTN_CONFIG_MGR->input_data_value($data_value, $data_key);

    }

    public function add_system_resource($env_key, $data_key, $data_value, $data_type_family = 'CRNRSTN::RESOURCE', $data_auth_profile = CRNRSTN_AUTHORIZE_RUNTIME_ONLY){

        try{

            $tmp_stripe_key_ARRAY = $this->return_stripe_key_ARRAY('$env_key', '$data_key');
            $tmp_param_err_str_ARRAY = $this->return_regression_stripe_ARRAY('MISSING_STRING_DATA', $tmp_stripe_key_ARRAY, $env_key, $data_key);

            $tmp_env_key_crc = $this->crcINT($env_key);

            if($env_key == '' || $data_key == ''){

                $this->error_log('Attempted ' . __METHOD__ . '(' . $data_key .  ') but missing required parameters. ' . $tmp_param_err_str_ARRAY['string'], __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                throw new Exception('CRNRSTN :: initialization ERROR :: define_env_resource was called but was missing parameter information and so was not able to be initialized. env_key and resourceKey are required. env_key[' . $env_key . '] resourceKey[' . $data_key . ']');

            }else{

                if($env_key === '*'){

                    $env_key = CRNRSTN_RESOURCE_ALL;

                }

                if(($tmp_env_key_crc == self::$server_env_key_crc_ARRAY[$this->config_serial_crc]) || ($env_key === CRNRSTN_RESOURCE_ALL)){

                    //error_log(__LINE__ . ' crnrstn ' .  __METHOD__ . ':: input_data_value(), WHERE $data_key=' . $data_key . ' $env_key=[' . $env_key . '/' . self::$server_env_key_ARRAY[$this->config_serial_crc] . '.].');
                    $this->input_data_value($data_value, $data_key, $data_type_family, NULL, $data_auth_profile, self::$server_env_key_ARRAY[$this->config_serial_crc]);

                }

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function data_encrypt($data = NULL, $encryption_channel = CRNRSTN_ENCRYPT_TUNNEL, $cipher_override = NULL, $secret_key_override = NULL, $hmac_algorithm_override = NULL, $options_bitwise_override = NULL){

        return $this->oCRNRSTN_ENV->data_encrypt($data, $encryption_channel, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);

    }

    public function data_decrypt($data = NULL, $encryption_channel = CRNRSTN_ENCRYPT_TUNNEL, $uri_passthrough = false, $cipher_override =  NULL, $secret_key_override = NULL, $hmac_algorithm_override = NULL, $options_bitwise_override = NULL){

        return $this->oCRNRSTN_ENV->data_decrypt($data, $encryption_channel, $uri_passthrough, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);

    }

    public function return_branding_creative($strip_formatting = false, $output_mode = CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED){

        return $this->oCRNRSTN_ENV->return_component_branding_creative($strip_formatting, $output_mode);

    }

    public function get_lang_copy($data_key){

        return $this->oCRNRSTN_ENV->get_lang_copy($data_key);

    }

    public function get_resource($data_key, $index = NULL, $data_type_family = NULL, $soap_transport = false){

        // public function retrieve_data_value($data_key, $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL', $index = NULL, $env_key = NULL, $soap_transport = false){
        return self::$oCRNRSTN_CONFIG_MGR->retrieve_data_value($data_key, $data_type_family, $index, self::$server_env_key_ARRAY[$this->config_serial_crc], $soap_transport);

        // was here ->  return $this->oCRNRSTN_USR->get_resource($data_key, $index, $data_type_family, $soap_transport);   //<--  previous call
        //                  return $this->oCRNRSTN_ENV->retrieve_data_value($data_key, $index, $data_type_family, $this->env_key, $soap_transport);
        //                      return $this->oCRNRSTN->retrieve_data_value($data_key, $data_type_family, $index, $env_key, $soap_transport);
        // now here! ---------->    return self::$oCRNRSTN_CONFIG_MGR->retrieve_data_value($data_key, $data_type_family, $index, $this->env_key, $soap_transport);
        //                              return $this->oCRNRSTN_CONFIG_DDO->preach('value', $this->return_prefixed_ddo_key($data_key, $env_key, $data_type_family), $soap_transport, $index);

    }

    public function get_resource_count($data_key, $data_type_family, $env_key){

        return self::$oCRNRSTN_CONFIG_MGR->get_resource_count($data_key, $data_type_family, $env_key);

    }

    public function isset_data_key($data_key, $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL', $env_key = NULL){

        if(!isset($env_key)){

            if(isset(self::$server_env_key_ARRAY[$this->config_serial_crc])){

                $env_key = self::$server_env_key_ARRAY[$this->config_serial_crc];

            }

        }

        return self::$oCRNRSTN_CONFIG_MGR->isset_data_key($data_key, $data_type_family, $env_key);

    }

    //
    // CRNRSTN :: INTERNAL PAGE RETURN
    public function ui_module_out($module, $module_permissions_profile = CRNRSTN_AUTHORIZE_RUNTIME_ONLY){

        return $this->oCRNRSTN_USR->ui_module_out($module, $module_permissions_profile);

    }

    public function ui_content_module_out($integer_constant, $crnrstn_form_handle = NULL){

        return $this->oCRNRSTN_USR->ui_content_module_out($integer_constant, $crnrstn_form_handle);

    }

    public function output_regression_stripe_ARRAY($result_str, $result_array, $output_format = 'array'){

        $tmp_ARRAY = array();
        $tmp_ARRAY['string'] = $result_str;
        $tmp_ARRAY['index_array'] = $result_array;

        if($output_format != 'array'){

            return $tmp_ARRAY['string'];

        }

        return $tmp_ARRAY;

    }

    private function return_dataset_nomination_prefix($output_format = NULL, $var0 = NULL, $var1 = NULL, $var2 = NULL, $var3 = NULL, $var4 = NULL, $var5 = NULL, $var6 = NULL, $var7 = NULL, $var8 = NULL, $var9 = NULL, $var10 = NULL, $var11 = NULL){

        $tmp_var_index_pos = 0;
        $tmp_total_index = 0;

        if(!isset($output_format)){

            $output_format = 'array';

        }

        $tmp_str_out = '';
        $tmp_array_str_unit_ARRAY = array();
        $tmp_array_out_ARRAY = array();

        if(isset($var0)){

            $tmp_total_index++;
            $tmp_crc = $this->crcINT($var0);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var1)){

            $tmp_total_index++;
            $tmp_crc = $this->crcINT($var1);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var2)){

            $tmp_total_index++;
            $tmp_crc = $this->crcINT($var2);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var3)){

            $tmp_total_index++;
            $tmp_crc = $this->crcINT($var3);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var4)){

            $tmp_total_index++;
            $tmp_crc = $this->crcINT($var4);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var5)){

            $tmp_total_index++;
            $tmp_crc = $this->crcINT($var5);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var6)){

            $tmp_total_index++;
            $tmp_crc = $this->crcINT($var6);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var7)){

            $tmp_total_index++;
            $tmp_crc = $this->crcINT($var7);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var8)){

            $tmp_total_index++;
            $tmp_crc = $this->crcINT($var8);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var9)){

            $tmp_total_index++;
            $tmp_crc = $this->crcINT($var9);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var10)){

            $tmp_total_index++;
            $tmp_crc = $this->crcINT($var10);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var11)){

            $tmp_total_index++;
            $tmp_crc = $this->crcINT($var11);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        $tmp_array_out_ARRAY['string'] = $tmp_str_out;
        $tmp_array_out_ARRAY['index_array'] = $tmp_array_str_unit_ARRAY;

        if($output_format == 'array') {

            return $tmp_array_out_ARRAY;

        }

        //
        // $output_format = 'string'
        return $tmp_array_out_ARRAY['string'];

    }

    public function input_data_value($data_value, $data_key, $data_type_family = 'CRNRSTN::RESOURCE', $index = NULL, $data_auth_profile = CRNRSTN_AUTHORIZE_RUNTIME_ONLY, $env_key = NULL){

        self::$oCRNRSTN_CONFIG_MGR->input_data_value($data_value, $data_key, $data_type_family, NULL, $data_auth_profile, $env_key);

    }

    public function return_stripe_key_ARRAY($var_0, $var_1 = NULL, $var_2 = NULL, $var_3 = NULL, $var_4 = NULL, $var_5 = NULL, $var_6 = NULL, $var_7 = NULL, $var_8 = NULL, $var_9 = NULL, $var_10 = NULL, $var_11 = NULL){

        $key_count = 0;
        $tmp_str_ARRAY = array();
        $tmp_str_ARRAY[] = $var_0;

        $key_count++;
        if(isset($var_1)){

            $tmp_str_ARRAY[] = $var_1;

        }

        if($key_count > sizeof($tmp_str_ARRAY)) return $tmp_str_ARRAY;

        $key_count++;
        if(isset($var_2)){

            $tmp_str_ARRAY[] = $var_2;

        }

        if($key_count > sizeof($tmp_str_ARRAY)) return $tmp_str_ARRAY;

        $key_count++;
        if(isset($var_3)){

            $tmp_str_ARRAY[] = $var_3;

        }

        if($key_count > sizeof($tmp_str_ARRAY)) return $tmp_str_ARRAY;

        $key_count++;
        if(isset($var_4)){

            $tmp_str_ARRAY[] = $var_4;

        }

        if($key_count > sizeof($tmp_str_ARRAY)) return $tmp_str_ARRAY;

        $key_count++;
        if(isset($var_5)){

            $tmp_str_ARRAY[] = $var_5;

        }

        if($key_count > sizeof($tmp_str_ARRAY)) return $tmp_str_ARRAY;

        $key_count++;
        if(isset($var_6)){

            $tmp_str_ARRAY[] = $var_6;

        }

        if($key_count > sizeof($tmp_str_ARRAY)) return $tmp_str_ARRAY;

        $key_count++;
        if(isset($var_7)){

            $tmp_str_ARRAY[] = $var_7;

        }

        if($key_count > sizeof($tmp_str_ARRAY)) return $tmp_str_ARRAY;

        $key_count++;
        if(isset($var_8)){

            $tmp_str_ARRAY[] = $var_8;

        }

        if($key_count > sizeof($tmp_str_ARRAY)) return $tmp_str_ARRAY;

        $key_count++;
        if(isset($var_9)){

            $tmp_str_ARRAY[] = $var_9;

        }

        if($key_count > sizeof($tmp_str_ARRAY)) return $tmp_str_ARRAY;

        $key_count++;
        if(isset($var_10)){

            $tmp_str_ARRAY[] = $var_10;

        }

        if($key_count > sizeof($tmp_str_ARRAY)) return $tmp_str_ARRAY;

        $key_count++;
        if(isset($var_11)){

            $tmp_str_ARRAY[] = $var_11;

        }

        if($key_count > sizeof($tmp_str_ARRAY)) return $tmp_str_ARRAY;

        return $tmp_str_ARRAY;

    }

    public function return_regression_stripe_ARRAY($operation_type, $data_key_ARRAY, $var_0 = NULL, $var_1 = NULL, $var_2 = NULL, $var_3 = NULL, $var_4 = NULL, $var_5 = NULL, $var_6 = NULL, $var_7 = NULL, $var_8 = NULL, $var_9 = NULL, $var_10 = NULL, $var_11 = NULL){

        $tmp_total_index = count($data_key_ARRAY);
        $tmp_var_index_pos = 0;
        $tmp_str_out = '';
        $tmp_array_out_ARRAY = array();

        switch($operation_type){
            case 'HAS_STRING_DATA':

                if(isset($var_0)){

                    if(strlen($var_0) > 0){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is not an empty string. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(isset($var_1)){

                    if(strlen($var_1) > 0){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is not an empty string. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(isset($var_2)){

                    if(strlen($var_2) > 0){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is not an empty string. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(isset($var_3)){

                    if(strlen($var_3) > 0){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is not an empty string. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(isset($var_4)){

                    if(strlen($var_4) > 0){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is not an empty string. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(isset($var_5)){

                    if(strlen($var_5) > 0){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is not an empty string. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(isset($var_6)){

                    if(strlen($var_6) > 0){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is not an empty string. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(isset($var_7)){

                    if(strlen($var_7) > 0){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is not an empty string. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(isset($var_8)){

                    if(strlen($var_8) > 0){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is not an empty string. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(isset($var_9)){

                    if(strlen($var_9) > 0){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is not an empty string. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(isset($var_10)){

                    if(strlen($var_10) > 0){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is not an empty string. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(isset($var_11)){

                    if(strlen($var_11) > 0){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is not an empty string. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }

                if($tmp_var_index_pos >= $tmp_total_index) break 1;

            break;
            case 'MISSING_STRING_DATA':

                if(isset($var_0)){

                    if($var_0 == ''){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is empty. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }else{

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(isset($var_1)){

                    if($var_1 == ''){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is empty. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }else{

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(isset($var_2)){

                    if($var_2 == ''){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is empty. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }else{

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(isset($var_3)){

                    if($var_3 == ''){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is empty. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }else{

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(isset($var_4)){

                    if($var_4 == ''){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is empty. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }else{

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(isset($var_5)){

                    if($var_5 == ''){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is empty. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }else{

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(isset($var_6)){

                    if($var_6 == ''){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is empty. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }else{

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(isset($var_7)){

                    if($var_7 == ''){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is empty. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }else{

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(isset($var_8)){

                    if($var_8 == ''){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is empty. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }else{

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(isset($var_9)){

                    if($var_9 == ''){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is empty. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }else{

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(isset($var_10)){

                    if($var_10 == ''){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is empty. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }else{

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(isset($var_11)){

                    if($var_11 == ''){

                        $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is empty. ';
                        $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                    }

                }else{

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                if($tmp_var_index_pos >= $tmp_total_index) break 1;

            break;
            default:

                // $operation_type = 'IS_NULL'
                // CHECK FOR IS NULL
                if(!isset($var_0)){

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(!isset($var_1)){

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(!isset($var_2)){

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(!isset($var_3)){

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(!isset($var_4)){

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(!isset($var_5)){

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(!isset($var_6)){

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(!isset($var_7)){

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(!isset($var_8)){

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(!isset($var_9)){

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(!isset($var_10)){

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                $tmp_var_index_pos++;
                if($tmp_var_index_pos >= $tmp_total_index) break 1;

                if(!isset($var_11)){

                    $tmp_str_out .= $data_key_ARRAY[$tmp_var_index_pos] . ' is null. ';
                    $tmp_array_out_ARRAY[] = $data_key_ARRAY[$tmp_var_index_pos];

                }

                if($tmp_var_index_pos >= $tmp_total_index) break 1;

            break;

        }

        $tmp_final_out_ARRAY = array();
        $tmp_final_out_ARRAY['string'] = $tmp_str_out;
        $tmp_final_out_ARRAY['index_array'] = $tmp_array_out_ARRAY;

        return $tmp_final_out_ARRAY;

    }

    public function init_session_encryption($env_key, $encrypt_cipher, $encrypt_secret_key, $encrypt_options, $hmac_alg){

        $tmp_data_profile_ARRAY = array();

        $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::SESSION_ENCRYPTION';
        $tmp_data_profile_ARRAY['data_type_family'] = $data_type_family;
        $tmp_data_profile_ARRAY['data_type_title'] = 'CRNRSTN :: SESSION';

        return $this->apply_encryption_profile($env_key, $encrypt_cipher, $encrypt_secret_key, $encrypt_options, $hmac_alg, $tmp_data_profile_ARRAY);

    }

    public function init_cookie_encryption($env_key, $encrypt_cipher, $encrypt_secret_key, $encrypt_options, $hmac_alg){

        $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::COOKIE_ENCRYPTION';
        $tmp_data_profile_ARRAY['data_type_family'] = $data_type_family;
        $tmp_data_profile_ARRAY['data_type_title'] = 'CRNRSTN :: COOKIE';

        return $this->apply_encryption_profile($env_key, $encrypt_cipher, $encrypt_secret_key, $encrypt_options, $hmac_alg, $tmp_data_profile_ARRAY);

    }

    public function init_tunnel_encryption($env_key, $encrypt_cipher, $encrypt_secret_key, $encrypt_options, $hmac_alg){

        $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::TUNNEL_ENCRYPTION';
        $tmp_data_profile_ARRAY['data_type_family'] = $data_type_family;
        $tmp_data_profile_ARRAY['data_type_title'] = 'CRNRSTN :: TUNNEL';

        return $this->apply_encryption_profile($env_key, $encrypt_cipher, $encrypt_secret_key, $encrypt_options, $hmac_alg, $tmp_data_profile_ARRAY);

    }

    public function init_database_encryption($env_key, $encrypt_cipher, $encrypt_secret_key, $encrypt_options, $hmac_alg){

        $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::DATABASE_ENCRYPTION';
        $tmp_data_profile_ARRAY['data_type_family'] = $data_type_family;
        $tmp_data_profile_ARRAY['data_type_title'] = 'CRNRSTN :: DATABASE';

        return $this->apply_encryption_profile($env_key, $encrypt_cipher, $encrypt_secret_key, $encrypt_options, $hmac_alg, $tmp_data_profile_ARRAY);

    }

    public function init_soap_encryption($env_key, $encrypt_cipher, $encrypt_secret_key, $encrypt_options, $hmac_alg){

        $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::SOAP_ENCRYPTION';
        $tmp_data_profile_ARRAY['data_type_family'] = $data_type_family;
        $tmp_data_profile_ARRAY['data_type_title'] = 'CRNRSTN :: SOAP SERVICES';

        return $this->apply_encryption_profile($env_key, $encrypt_cipher, $encrypt_secret_key, $encrypt_options, $hmac_alg, $tmp_data_profile_ARRAY);

    }

    public function init_OERSL_encryption($env_key, $encrypt_cipher, $encrypt_secret_key, $encrypt_options, $hmac_alg){

        $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL::OERSL_ENCRYPTION';

        $tmp_data_profile_ARRAY['data_type_family'] = $data_type_family;
        $tmp_data_profile_ARRAY['data_type_title'] = 'CRNRSTN :: OpenSSL Encryption Rotation Services Layer (OERSL)';

        return $this->apply_encryption_profile($env_key, $encrypt_cipher, $encrypt_secret_key, $encrypt_options, $hmac_alg, $tmp_data_profile_ARRAY);

    }

    private function apply_encryption_profile($env_key, $encrypt_cipher, $encrypt_secret_key, $encrypt_options, $hmac_alg, $tmp_data_profile_ARRAY){

        try{

            $data_type_family = $tmp_data_profile_ARRAY['data_type_family'];
            $data_type_title = $tmp_data_profile_ARRAY['data_type_title'];

            $env_key_crc = $this->crcINT($env_key);

                if(isset(self::$server_env_key_crc_ARRAY[$this->config_serial_crc])){

                    if($env_key == CRNRSTN_RESOURCE_ALL || self::$server_env_key_crc_ARRAY[$this->config_serial_crc] == $this->crcINT($env_key)){

                        $tmp_stripe_key_ARRAY = $this->return_stripe_key_ARRAY('$env_key', '$encrypt_cipher', '$encrypt_secret_key', '$hmac_alg');
                        $tmp_param_err_str_ARRAY = $this->return_regression_stripe_ARRAY('MISSING_STRING_DATA', $tmp_stripe_key_ARRAY, $env_key, $encrypt_cipher, $encrypt_secret_key, $hmac_alg);

                        $tmp_param_missing_str = $tmp_param_err_str_ARRAY['string'];
                        $tmp_param_missing_ARRAY = $tmp_param_err_str_ARRAY['index_array'];

                        if(count($tmp_param_missing_ARRAY) > 0){

                            $this->error_log('Missing required ' . $data_type_title . ' encryption information to complete ' . __METHOD__ .'. '. $tmp_param_missing_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                            throw new Exception('CRNRSTN :: initialization ERROR :: ' . __METHOD__ . ' was called but was missing parameter information and so ' . $data_type_title . ' encryption was not able to be initialized. Some parameters are required. ' . $tmp_param_missing_str);

                        }else{

                            self::$oCRNRSTN_CONFIG_MGR->input_data_value($encrypt_cipher, 'encrypt_cipher', $data_type_family,NULL,CRNRSTN_AUTHORIZE_RUNTIME_ONLY, $env_key);
                            self::$oCRNRSTN_CONFIG_MGR->input_data_value($encrypt_secret_key, 'encrypt_secret_key', $data_type_family,NULL,CRNRSTN_AUTHORIZE_RUNTIME_ONLY, $env_key);
                            self::$oCRNRSTN_CONFIG_MGR->input_data_value($encrypt_options, 'encrypt_options', $data_type_family,NULL,CRNRSTN_AUTHORIZE_RUNTIME_ONLY, $env_key);
                            self::$oCRNRSTN_CONFIG_MGR->input_data_value($hmac_alg, 'hmac_alg', $data_type_family,NULL,CRNRSTN_AUTHORIZE_RUNTIME_ONLY, $env_key);

                            $this->error_log($data_type_title . ' encryption initialized for environment [' . $env_key_crc . '/' . $env_key . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                            return true;

                        }

                    }

                }

            //
            // WE DON'T HAVE THE ENVIRONMENT, BUT DETECTION WOULD HAVE ALREADY BEEN COMPLETED.
            //throw new Exception('Unable to process encryption profile for environment [' . self::$server_env_key_crc_ARRAY[$this->config_serial_crc] . '].');
            $this->error_log('Bypassed processing encryption initialized for environment [' . $env_key_crc . '/' . $env_key . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

			return false;

	    }

	}

	public function get_server_env($output = 'string'){

        try{

            //
            // DID WE DETERMINE ENVIRONMENT KEY THROUGH INITIALIZATION OF CRNRSTN? IF SO, THIS PARAMETER WILL BE SET. JUST USE IT.
            if(self::$server_env_key_crc_ARRAY[$this->config_serial_crc] != '') {

                $this->error_log('Detected server environment [' . self::$server_env_key_ARRAY[$this->config_serial_crc] . '] returned from private static array.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                if($output == 'crc'){

                    return self::$server_env_key_crc_ARRAY[$this->config_serial_crc];

                }

                return self::$server_env_key_ARRAY[$this->config_serial_crc];

            }
				
            //
            // WE SHOULD HAVE THIS VALUE BY NOW. IF EMPTY, HOOOSTON...VE HAF PROBLEM!
            if(self::$server_env_key_crc_ARRAY[$this->config_serial_crc] == ''){

                $this->error_log('ERROR :: we have processed ALL defined environmental resources and were unable to detect running environment with CRNRSTN :: config serial CRC [' . $this->config_serial_crc . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('CRNRSTN :: Initialization Error :: Environmental detection failed to match a sufficient number of $_SERVER parameters to the servers configuration and therefore DID NOT successfully initialize CRNRSTN :: on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ')');

            }

            $this->error_log('Returning detected environment [' . self::$server_env_key_ARRAY[$this->config_serial_crc] . '] as the selected running environment.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

            return self::$server_env_key_ARRAY[$this->config_serial_crc];

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

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

    /**
     * SOURCE :: NUSOAP.PHP - http://sourceforge.net/projects/nusoap/
     * returns the time in ODBC canonical form with microseconds
     *
     * @return string The time in ODBC canonical form with microseconds
     * @access public
     */
    private function microtime_float(){

	    //list($usec, $sec) = explode(' ', microtime());
	    //return ((float)$usec + (float)$sec);

        if(function_exists('gettimeofday')){

            $tod = gettimeofday();
            $sec = $tod['sec'];
            $usec = $tod['usec'];

        }else{

            $sec = time();
            $usec = 0;

        }

        return $sec . '.' . sprintf('%06d', $usec);

	}

    public function return_micro_time(){

        return $this->oLogger->returnMicroTime();

    }

    public function chunkPageData($tmp_page_content, $max_len){

        $oChunkRestrictData = new crnrstn_chunk_restrictor($tmp_page_content, $max_len, $this);

        return $oChunkRestrictData;

    }

    //
    // SOURCE :: https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
    // AUTHOR :: Scott :: https://stackoverflow.com/users/1698153/scott
    public function generate_new_key($len = 32, $char_selection = NULL){

        //
        // SEND -1 AS $char_selection FOR USE OF *ALL* CHARACTERS IN RANDOM KEY
        // GENERATION...EXCEPT THE SEQUENCE \e ESCAPE KEY (ESC or 0x1B (27) in
        // ASCII) AND NOT SPLITTING HAIRS BETWEEN SEQUENCE \n LINEFEED (LF or
        // 0x0A (10) in ASCII) AND SEQUENCE \r CARRIAGE RETURN (CR or 0x0D
        // (13) in ASCII) AND ALSO SCREW BOTH \f FORM FEED (FF or 0x0C (12) in
        // ASCII) AND \v VERTICAL TAB (VT or 0x0B (11) in ASCII) SEQUENCES.
        // https://www.php.net/manual/en/language.types.string.php#language.types.string.syntax.double
        $token = "";

        if(isset($char_selection) && ($char_selection != -1) && ($char_selection != -2) && ($char_selection != -3)){

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

            if($char_selection == -1){

                $codeAlphabet .= "{}[]:;\"\'|\\+=_- )(*&^%$#@!~
                `?/>.<,   '";

            }

            //
            // ADDED EXCLUSION TO -2 ABOVE WHEN CHECKING FOR $char_selection
            if($char_selection == -2){

                $codeAlphabet .= "{}[]:+=_- )(*&%$#@!~?.";

            }

            //
            // ADDED EXCLUSION TO -3 ABOVE WHEN CHECKING FOR $char_selection
            if($char_selection == -3){

                $codeAlphabet .= ":+=_- )(*$#@!~.";

            }

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
    // SOURCE :: https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
    // AUTHOR :: Scott :: https://stackoverflow.com/users/1698153/scott
    private function crypto_rand_secure($min, $max){

        $range = $max - $min;
        if ($range < 1) return $min; // not so random...

        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1

        do {

            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits

        } while ($rnd > $range);

        return $min + $rnd;

    }

    public function elapsed_delta_time_for($watchKey, $decimal = 8){

        return $this->monitoringDeltaTimeFor($watchKey, $decimal);

    }

    public function monitoringDeltaTimeFor($watchKey, $decimal = 8){

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

    public function return_pretty_delta_time($delta_secs, $microsecs = 0, $mode = 'ELAPSED_VERBOSE'){

        $microsecs = '0.' . $microsecs;
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
        //error_log("(146) Y->" . self::$lang_content_ARRAY['Y']);      // shows 1...not y...

        foreach($bit as $k => $v){

            if($v > 0){

                //
                // PUT IN CURFEW FOR TIME GRANULARITY
                if($k == self::$lang_content_ARRAY['Y'] || $k == self::$lang_content_ARRAY['W'] || ($k == self::$lang_content_ARRAY['D'] && $v > 1)){

                    //
                    // RETURN DEFAULT DATE FORMAT
                    if(isset($format_override)){

                        return date($format_override, $secs);

                    }else{

                        return date('m.d.Y @ H:i:s', $secs);

                    }

                }else{

                    $ret[] = $v . $k;

                }

            }

        }

        if(!isset($ret)){

            $ret[] = 'just now.';

        }else{

            if(sizeof($ret) == 0){

                $ret[] = 'just now.';

            }else{

                $ret[] = self::$lang_content_ARRAY['AGO'];

            }

        }

        return join(' ', $ret);

    }

    private function elapsed($delta_secs, $microsecs = 0){

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
        //error_log("(146) Y->" . self::$lang_content_ARRAY['Y']);      // shows 1...not y...

        foreach($bit as $k => $v){

            if($v > 0){
                //
                // PUT IN CURFEW FOR TIME GRANULARITY
                if($k == self::$lang_content_ARRAY['Y'] || $k == self::$lang_content_ARRAY['W'] || ($k == self::$lang_content_ARRAY['D'] && $v > 1)){

                    //
                    // RETURN DEFAULT DATE FORMAT
                    if(isset($format_override)){

                        return date($format_override, $delta_secs);

                    }else{

                        return date('m.d.Y @ H:i:s', $delta_secs);
                        
                    }

                }else{

                    $ret[] = $v . $k;

                }

            }

        }

        if(!isset($ret)){

            $ret[] = 'just now.';

        }else{

            if(sizeof($ret) == 0){

                $ret[] = 'just now.';

            }else{

                $ret[] = self::$lang_content_ARRAY['AGO'];

            }

        }

        return join(' ', $ret);

    }

    # SOURCE :: http://php.net/manual/en/function.time.php
    private function elapsed_verbose($delta_secs, $microsecs = 0){

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
                //error_log('finite (194) test ->' . $bit_plural[$k]);

            }else{

                if($v == 1){

                    $ret[] = $v . $bit_singular[$k];
                    //error_log('finite (200) test ->' . $bit_singular[$k]);

                }

            }

        }

//        foreach($bit_singular as $k => $v){
//            if($v > 1)$ret[] = $v . $k . 's';           // APPENDING AN S FOR PLURAL IS PRIMARILY ENGLISH. WE CAN'T RELY ON THIS APPEND FOR OUR PURPOSES.
//            if($v == 1)$ret[] = $v . $k;
//        }

        if(isset($ret)){

            array_splice($ret, count($ret) - 1, 0, self::$lang_content_ARRAY['AND']);

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
                //error_log('finite (194) test ->' . $bit_plural[$k]);

            }else{

                if($v == 1){

                    $ret[] = $v . $bit_singular[$k];
                    //error_log('finite (200) test ->' . $bit_singular[$k]);

                }

            }

        }

//        foreach($bit_singular as $k => $v){
//            if($v > 1)$ret[] = $v . $k . 's';           // APPENDING AN S FOR PLURAL IS PRIMARILY ENGLISH. WE CAN'T RELY ON THIS APPEND FOR OUR PURPOSES.
//            if($v == 1)$ret[] = $v . $k;
//        }

        array_splice($ret, count($ret) - 1, 0, self::$lang_content_ARRAY['AND']);
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

        #error_log('finite (101)->' . print_r(self::$lang_content_ARRAY['WEEKS']));

    }

    public function catch_exception($exception_obj, $syslog_constant = LOG_DEBUG, $method = NULL, $namespace = NULL, $output_profile = NULL, $output_profile_override_meta = NULL, $wcr_override_pipe = NULL){

        $tmp_err_trace_str = $this->return_PHPExceptionTracePretty($exception_obj->getTraceAsString());

        if(strlen($tmp_err_trace_str) > 0){

            $this->error_log('PHP native exception output log trace received ::' . $tmp_err_trace_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        }

        //
        // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
        $this->oLogger->catch_exception($exception_obj, $syslog_constant, $method, $namespace, $output_profile, $output_profile_override_meta, $wcr_override_pipe, $this);

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

    public function return_logPriorityPretty($logPriority, $format = 'TEXT'){

        $tmp_output_format = trim(strtoupper($format));

        if($tmp_output_format == 'HTML'){

            //<span>LOG_EMERG</span><span>:: system is unusable.</span>

            switch($logPriority){
                case 0:

                    $tmp_priority_const = 'LOG_EMERG';
                    $tmp_priority_msg = ':: system is unusable. ';

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
                    $tmp_priority_msg = ':: informational message. ';

                break;
                case 7:

                    $tmp_priority_const = 'LOG_DEBUG';
                    $tmp_priority_msg = ':: debug-level message. ';

                break;
                default:

                    $tmp_priority_const = 'UNKNOWN';
                    $tmp_priority_msg = '';

                break;

            }

            $tmp_priority = '<span style="font-family:Arial, Helvetica, sans-serif; font-size:15px; text-align:left; color:#F90000; font-weight: bold;">' . $tmp_priority_const . '</span>&nbsp;<span style="font-family:Arial, Helvetica, sans-serif; font-size:15px; text-align:left; color:#000; font-weight: bold;">' . $tmp_priority_msg . '</span>';

        }else{

            switch($logPriority){
                case 0:

                    $tmp_priority = 'LOG_EMERG :: system is unusable. ';

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

    public function error_log($str, $line_num = NULL, $method = NULL, $file = NULL, $log_silo_key = NULL){

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

    public function print_r_str($expression, $title = NULL, $theme_style = NULL, $line_num = NULL, $method = NULL, $file = NULL){

        if(!isset($theme_style)){

            //
            // SET A DEFAULT
            $theme_style = CRNRSTN_UI_PHPNIGHT;

            $theme_style_ARRAY = $this->return_set_bits($this->system_style_profile_constants);

            if(count($theme_style_ARRAY) > 0){

                $theme_style = $theme_style_ARRAY[0];   // FIRST MATCH

            }

        }

        $tmp_meta = '[' . $this->return_micro_time() . ' ' . date('T') . '] [rtime ' . $this->wall_time() . ' secs]';

        if(!isset($method) || $method == ''){

            if(isset($file)){

                $tmp_meta .= ' [file ' . $file . ']';

            }

        }else{

            $tmp_meta .= ' [methd ' . $method . ']';

        }

        if(isset($line_num)){

            $tmp_meta .= ' [lnum ' . $line_num . ']';

        }

        $tmp_print_r = print_r($expression, true);

        $tmp_print_r = $this->proper_replace('\r\n', '\n', $tmp_print_r);
        $lines = preg_split('#\r?\n#', trim($tmp_print_r));
        $tmp_line_cnt = sizeof($lines);

        $lineHTML = implode('<br />', range(1, $tmp_line_cnt + 0));
        $tmp_linecnt_html_out = '<div style="line-height:20px; position:absolute; padding-right:5px; font-size:14px; font-family: Verdana, Arial, Helvetica, sans-serif; color:#00FF00; border-right:1px solid #333333; background-color:#161616; padding-top:25px; padding-bottom:25px; padding-left:4px;">' . $lineHTML . '</div>';

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
                <div id="crnrstn_print_r_output_' . $tmp_hash . '" class="crnrstn_print_r_output" style="width:100%;">
                ' . $tmp_title . '
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#CCC; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                ' . $tmp_linecnt_html_out . '
                <div style="background-color:#CCC; color:#DEDECB; width:3000px; padding:10px; margin-top:0; margin-left:10px; padding-left:35px; line-height:20px;">
                <code>';

            break;
            case CRNRSTN_UI_HTML:

                $tmp_out = '
                <div id="crnrstn_print_r_output_' . $tmp_hash . '" class="crnrstn_print_r_output" style="width:100%;">
                ' . $tmp_title . '
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#FFF; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                ' . $tmp_linecnt_html_out . '
                <div style="background-color:#FFF; color:#DEDECB; width:3000px; padding:10px; margin-top:0; margin-left:10px; padding-left:35px; line-height:20px;">
                <code>';

            break;
            case CRNRSTN_UI_PHPNIGHT:

                $tmp_out = '
                <div id="crnrstn_print_r_output_' . $tmp_hash . '" class="crnrstn_print_r_output" style="width:100%;">
                ' . $tmp_title . '
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#000; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                ' . $tmp_linecnt_html_out . '
                <div style="background-color:#000; color:#DEDECB; width:3000px; padding:10px; margin-top:0; margin-left:10px; padding-left:35px; line-height:20px;">
                <code>';

            break;
            default:

                $tmp_out = '
                <div id="crnrstn_print_r_output_' . $tmp_hash . '" class="crnrstn_print_r_output" style="width:100%;">
                ' . $tmp_title . '
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#E6E6E6; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                ' . $tmp_linecnt_html_out . '
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

            ' . $component_crnrstn_title . '

            <div style="float:right; max-width:88%; max-width:82%; padding:4px 0 5px 0; text-align:right; font-family: Courier New, Courier, monospace; font-size:11px;">' . $tmp_meta . '</div>
                
            <div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px;"></div>
        </div>
        </div></div></div>';

        $tmp_str_out .= '<div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px;"></div>
';

        return $tmp_str_out;

    }

    public function print_r($expression, $title = NULL, $theme_style = NULL, $line_num = NULL, $method = NULL, $file = NULL){

        if(!isset($theme_style)){

            //
            // SET A DEFAULT
            $theme_style = CRNRSTN_UI_PHPNIGHT;

            $theme_style_ARRAY = $this->return_set_bits($this->system_style_profile_constants);

            if(count($theme_style_ARRAY) > 0){

                $theme_style = $theme_style_ARRAY[0];   // FIRST MATCH

            }

        }

        $tmp_meta = '[' . $this->return_micro_time() . ' ' . date('T') . '] [rtime ' . $this->wall_time() . ' secs]';

        if(!isset($method) || $method == ''){

            if(isset($file)){

                $tmp_meta .= ' [file ' . $file . ']';

            }

        }else{

            $tmp_meta .= ' [methd ' . $method . ']';

        }

        if(isset($line_num)){

            $tmp_meta .= ' [lnum ' . $line_num . ']';

        }

        $tmp_print_r = print_r($expression, true);

        $tmp_print_r = $this->proper_replace('\r\n', '\n', $tmp_print_r);
        $lines = preg_split('#\r?\n#', trim($tmp_print_r));
        $tmp_line_cnt = sizeof($lines);

        $lineHTML = implode('<br />', range(1, $tmp_line_cnt+0));
        $tmp_linecnt_html_out = '<div style="line-height:20px; position:absolute; padding-right:5px; font-size:14px; font-family: Verdana, Arial, Helvetica, sans-serif; color:#00FF00; border-right:1px solid #333333; background-color:#161616; padding-top:25px; padding-bottom:25px; padding-left:4px;">' . $lineHTML . '</div>';

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
                <div id="crnrstn_print_r_output_' . $tmp_hash . '" class="crnrstn_print_r_output"  style="width:100%;">
                ' . $tmp_title . '
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#CCC; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                ' . $tmp_linecnt_html_out . '
                <div style="background-color:#CCC; color:#DEDECB; width:3000px; padding:10px; margin-top:0; margin-left:10px; padding-left:35px; line-height:20px;">
                <code>';

            break;
            case CRNRSTN_UI_HTML:

                $tmp_out = '
                <div id="crnrstn_print_r_output_' . $tmp_hash . '" class="crnrstn_print_r_output"  style="width:100%;">
                ' . $tmp_title . '
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#FFF; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                ' . $tmp_linecnt_html_out . '
                <div style="background-color:#FFF; color:#DEDECB; width:3000px; padding:10px; margin-top:0; margin-left:10px; padding-left:35px; line-height:20px;">
                <code>';

            break;
            case CRNRSTN_UI_PHPNIGHT:

                $tmp_out = '
                <div id="crnrstn_print_r_output_' . $tmp_hash . '" class="crnrstn_print_r_output"  style="width:100%;">
                ' . $tmp_title . '
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#000; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                ' . $tmp_linecnt_html_out . '
                <div style="background-color:#000; color:#DEDECB; width:3000px; padding:10px; margin-top:0; margin-left:10px; padding-left:35px; line-height:20px;">
                <code>';

            break;
            default:

                $tmp_out = '
                <div id="crnrstn_print_r_output_' . $tmp_hash . '" class="crnrstn_print_r_output"  style="width:100%;">
                ' . $tmp_title . '
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#E6E6E6; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                ' . $tmp_linecnt_html_out . '
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

            ' . $component_crnrstn_title . '

            <div style="float:right; max-width:88%; max-width:82%; padding:4px 0 5px 0; text-align:right; font-family: Courier New, Courier, monospace; font-size:11px;">' . $tmp_meta . '</div>
                
            <div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px;"></div>
        </div>
        </div></div></div>';

        echo '<div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px;"></div>';

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.base64-encode.php
    // AUTHOR :: luke at lukeoliff.com :: https://www.php.net/manual/en/function.base64-encode.php#105200
    public function base64_encode_image($filename, $filetype){

        if (is_file($filename) || (is_string($filename) && $filename != '')) {

            $imgbinary = fread(fopen($filename, 'r'), $this->find_filesize($filename));

            return 'data:image/' . $filetype . ';base64,' . base64_encode($imgbinary);

        }

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.filesize.php
    // AUTHOR :: C0nw0nk :: https://www.php.net/manual/en/function.filesize.php#119435
    public function find_filesize($file){

        if(substr(PHP_OS, 0, 3) == 'WIN'){

            exec('for %I in ("' . $file . '") do @echo %~zI', $output);
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

    private function return_component_branding_creative($strip_formatting = false, $output_mode = NULL){

        $tmp_weighted_elements_keys_ARRAY = array();

        $output_ratio_ARRAY = array(6, 10, 6, 8, 5, 3, 1, 7, 7, 7, 5, 5, 5, 3);

        $tmp_ratio_cnt = sizeof($output_ratio_ARRAY);

        for($i = 0; $i < $tmp_ratio_cnt; $i++){

            for($ii = 0; $ii < $output_ratio_ARRAY[$i]; $ii++){

                $tmp_weighted_elements_keys_ARRAY[] = $this->creativeElementsKeys[$i];

            }

        }

        $tmp_cnt = sizeof($tmp_weighted_elements_keys_ARRAY);
        $tmp_cnt--;
        $tmp_int = rand(0, $tmp_cnt);

        //error_log(__LINE__ . ' crnrstn ' . __METHOD__ . '[' . $tmp_int . '][' . $tmp_weighted_elements_keys_ARRAY[$tmp_int] . ']');

        if($strip_formatting){

            if($tmp_weighted_elements_keys_ARRAY[$tmp_int] == 'CRNRSTN ::'){

                $creative = '<div style="padding:4px 0 5px 5px; text-align:left; font-family: Courier New, Courier, monospace; font-size:11px;">C<span style="color:#F00;">R</span>NRSTN :: v' . self::$version_crnrstn . '</div>';

            }else{

                error_log(__LINE__ . ' crnrstn ' . __METHOD__ . ' [img=' . $tmp_weighted_elements_keys_ARRAY[$tmp_int] . '][$output_mode=' . $output_mode . '].');
                $creative = '<span style="font-family: Courier New, Courier, monospace; font-size:11px;">' . $this->return_creative($tmp_weighted_elements_keys_ARRAY[$tmp_int], $output_mode) . '</span>';

            }

        }else{

            if($tmp_weighted_elements_keys_ARRAY[$tmp_int] == 'CRNRSTN ::'){

                $creative = '<div style="float:left; padding:4px 0 5px 5px; text-align:left; font-family: Courier New, Courier, monospace; font-size:11px;">C<span style="color:#F00;">R</span>NRSTN :: v' . self::$version_crnrstn . '</div>';

            }else{

                error_log(__LINE__ . ' crnrstn ' . __METHOD__ . ' [img=' . $tmp_weighted_elements_keys_ARRAY[$tmp_int] . '][$output_mode=' . $output_mode . '].');
                $creative = '<div style="float:left; padding:4px 0 5px 5px; text-align:left; font-family: Courier New, Courier, monospace; font-size:11px;">' . $this->return_creative($tmp_weighted_elements_keys_ARRAY[$tmp_int], $output_mode) . '</div>';

            }

        }

        return $creative;

    }
//
//    private function getEnvParam($paramName, $wildCardKey = NULL){
//
//        try{
//
//            //
//            // CHECK FOR EXISTENCE OF PARAMETER WITHIN WILD CARD RESOURCE
//            if(isset($wildCardKey)){
//
//                if(isset($this->oWildCardResource_ARRAY[$this->crcINT($this->config_serial)][CRNRSTN_LOG_ALL])) {
//
//                    $tmp_oWCR_ARRAY = $this->oWildCardResource_ARRAY[$this->crcINT($this->config_serial)][CRNRSTN_LOG_ALL];
//
//                    if(!isset($tmp_oWCR_ARRAY[$wildCardKey])){
//
//                        //
//                        // HOOOSTON...VE HAF PROBLEM!
//                        throw new Exception('The requested WCR (wild card resource), "' . $wildCardKey . '", has not been configured for this environment (e.g. NULL WCR array index, here)...albeit there are other environments CRNRSTN :: is currently configured to support here which have had at least one (1) WCR defined and initialized therein (so...there is that).');
//
//                    }else{
//
//                        $tmp_oWCR = $tmp_oWCR_ARRAY[$wildCardKey];
//
//                        if ($tmp_oWCR->issetAttribute($wildCardKey, $paramName)) {
//
//                            //
//                            // PARAM HAS BEEN DEFINED WITHIN WILD CARD RESOURCE
//                            return $tmp_oWCR->get_attribute($wildCardKey, $paramName);
//
//                        } else {
//
//                            //
//                            // HOOOSTON...VE HAF PROBLEM!
//                            throw new Exception('The "' . $paramName . '" parameter has been requested from wild card resource (i.e. WCR), "' . $wildCardKey . '", but this parameter was not found to have been initialized therein via oWCR->addAttribute().');
//
//                        }
//
//                    }
//
//                }else{
//
//                    //
//                    // HOOOSTON...VE HAF PROBLEM!
//                    throw new Exception('The wild card resource (i.e. WCR), "' . $wildCardKey . '", has been requested, but no WCR of the kind has been configured for this environment.');
//
//                }
//
//            }
//
//        } catch (Exception $e) {
//
//            //
//            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
//            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);
//
//            return false;
//
//        }
//
//    }

    public function define_wildcard_resource($resource_key){

        $oWildCardResource = new crnrstn_wildcard_resource($resource_key, $this);

        return $oWildCardResource;

    }

    private function break_piped_str_to_array($piped_str, $method_as_string = NULL, $trim_method_as_string = NULL){

        try{

            $tmp_array = array();

            $tmp_array_from_pipe_ARRAY = explode('|', $piped_str);

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
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

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
                    throw new Exception('CRNRSTN :: has not been configured to support the native PHP method, ' . $method_as_string);

                break;

            }

            return $value;

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function ini_get($ini_setting){

        $this->ini_set_ARRAY[$ini_setting] = ini_get($ini_setting);

        return $this->ini_set_ARRAY[$ini_setting];

    }

    public function ini_set($ini_setting, $ini_value){

        self::$oCRNRSTN_CONFIG_MGR->input_data_value($ini_value, $ini_setting, NULL, 0);

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
    public function boolean_conversion($variable = NULL){

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
                    for($i = 0; $i < $tmp_post_at_len; $i++){

                        if(!$last_dot_flag){

                            if($tmp_post_at_str_rev_ARRAY[$i] == '.'){

                                $last_dot_flag = true;

                            }

                            $tmp_new_post_at_ARRAY[] = $tmp_post_at_str_rev_ARRAY[$i];

                            if($last_dot_flag){

                                $i = $tmp_post_at_len + 420;
                                $tmp_new_post_at_ARRAY = array_reverse($tmp_new_post_at_ARRAY);

                            }

                        }

                    }

                    $tmp_str_len = sizeof($tmp_str_ARRAY);
                    for($i = 0; $i < $tmp_str_len; $i++){

                        if($i == 0){

                            $clean_str .= $tmp_str_ARRAY[$i] . '*****';

                        }else{

                            if($tmp_str_ARRAY[$i] == '@'){

                                $at_flag = true;
                                $tmp_plus_one = $i + 1;
                                $clean_str .= $tmp_str_ARRAY[$i] . $tmp_str_ARRAY[$tmp_plus_one] . '*****';
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

            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

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

                        self::$requestProtocol = 'https://';

                    }else{

                        self::$requestProtocol = 'http://';

                    }

                }else{

                    self::$requestProtocol = 'http://';

                }

            }

        }else{

            self::$requestProtocol = 'http://';

        }

        return self::$requestProtocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    }

    public function proper_version($system = 'CRNRSTN'){

        $system = trim(strtoupper($system));

        switch($system){
            case 'LINUX':

                return $this->version_linux();

            break;
            case 'APACHE':

                return 'Apache v' . $this->version_apache();

            break;
            case 'MYSQLI':

                return 'MySQLi v' . $this->version_mysqli();

            break;
            case 'PHP':

                return 'php v' . $this->version_php();

            break;
            case 'SOAP':

                return $this->version_soap();

            break;
            case 'OPENSSL':

                return 'OpenSSL v' . $this->version_openssl();

            break;
            case 'CRNRSTN':

                return 'CRNRSTN :: v' . $this->version_crnrstn();

            break;
            default:

                return 'UNKNOWN[' . $system . '] :: v[x].[y].[z]';

            break;

        }

    }

    //
    // SOURCE :: https://stackoverflow.com/questions/2510434/format-bytes-to-kilobytes-megabytes-gigabytes
    // AUTHOR :: Leo :: https://stackoverflow.com/users/227532/leo
    public function format_bytes($bytes, $precision = 2, $SI_output = false) {

        //
        // CRNRSTN v2.0.0 :: MODS
        // SEE :: https://en.wikipedia.org/wiki/Binary_prefix
        // SEE ALSO :: ISO/IEC 80000 family of standards (November 1, 2009)
        // https://en.wikipedia.org/wiki/ISO/IEC_80000#Information_science_and_technology
        // SEE COMMENT BY DEVATOR [https://stackoverflow.com/users/659731/devator] JUST
        // BENEATH THE METHOD [format_bytes()] AUTHOR'S RESPONSE AT SOURCE LINK. THIS IS MY
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

        return  $tmp_number . ' ' . $units[$pow];

    }

    public function number_format_keep_precision($number, $dec_places = 0, $dec_point = '.', $thou_separate = ','){

        if($dec_places > 0){

            return number_format($number, $dec_places, $dec_point, $thou_separate);

        }else{

            //
            // SOURCE :: https://www.php.net/manual/en/function.number-format.php
            // AUTHOR :: stm555 at hotmail dot com :: https://www.php.net/manual/en/function.number-format.php#52311
            $broken_number = explode($dec_point, $number);
            if(isset($broken_number[1])){

                return number_format($broken_number[0], 0, $dec_point, $thou_separate) . $dec_point . $broken_number[1];

            }else{

                return number_format($broken_number[0], 0, $dec_point, $thou_separate);

            }

        }

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.highlight-string.php
    // AUTHOR :: stanislav dot eckert at vizson dot de :: https://www.php.net/manual/en/function.highlight-string.php#118550
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

        } else if ($theme_style == CRNRSTN_UI_PHPNIGHT)                        // [EDIT] CRNRSTN :: v2.00.0000 :: J5 :: April 13, 2021 2004 hrs
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
        $text = preg_replace("|^\\<code\\>\\<span style\\=\"color\\: #[a-fA-F0-9]{0,6}\"\\>|", '', $text, 1);  // remove prefix
        $text = preg_replace("|\\</code\\>\$|", '', $text, 1);  // remove suffix 1
        $text = trim($text);  // remove line breaks
        $text = preg_replace("|\\</span\\>\$|", '', $text, 1);  // remove suffix 2
        $text = trim($text);  // remove line breaks
        $text = preg_replace("|^(\\<span style\\=\"color\\: #[a-fA-F0-9]{0,6}\"\\>)(&lt;\\?php&nbsp;)(.*?)(\\</span\\>)|", "\$1\$3\$4", $text);  // remove custom added "<?php "

        return $text;

    }

    //
    // SOURCE :: http://php.net/manual/en/function.mkdir.php
    // AUTHOR :: kungla at gmail dot com :: http://php.net/manual/en/function.mkdir.php#68207
    public function mkdir_r($dirName, $mode = 777){

        try{

            $mode = octdec(str_pad($mode,4,'0',STR_PAD_LEFT));
            $mode = (int)$mode;

            $dirs = explode('/', $dirName);
            $dir = '';

            foreach ($dirs as $part) {

                $dir .= $part . '/';

                if (!is_dir($dir) && strlen($dir) > 0) {

                    if(!mkdir($dir, $mode)){

                        $error = error_get_last();

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception($error['message'] . ' mkdir_r() failed to mkdir :: ' . $dir);

                    }

                }

            }

            return true;

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function crcINT($value){

        $value = crc32($value);
        return sprintf('%u', $value);

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
        //self::$oCRNRSTN_USR->error_log('oWheel :: Run ftp_mksubdirs=>[ftp_root_dir_path=' . $ftp_root_dir_path.'][tmp_mksubdir_destination_path=' . $tmp_mksubdir_destination_path.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

        if(is_dir($file_source_path)){

            //self::$oCRNRSTN_USR->error_log('oWheel :: Run ftp_mksubdirs=>[source_filepath=' . $file_source_path.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');
            error_log(__LINE__ . ' ' . __METHOD__ . ' crnrstn die().');
            die();
            //$this->ftp_mksubdirs($ftp_stream_target, $tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH'], $tmp_stats_DESTINATION_ARRAY['MKSUB_DIR']);

            $continue_process = true;

        }else{

            error_log(__LINE__ . ' ' . __METHOD__ . ' crnrstn die().');
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
            //self::$oCRNRSTN_USR->error_log('oWheel :: SLASH CHAR = ' . $tmp_slashChar, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

            $tmp_dfile_array = explode($tmp_slashChar, $tmp_stats_DESTINATION_ARRAY['DESTINATION_FILEPATH']);
            $tmp_dfile_sect_cnt = sizeof($tmp_dfile_array);

            //self::$oCRNRSTN_USR->error_log('oWheel :: EXPLODE [' . $tmp_stats_DESTINATION_ARRAY['DESTINATION_FILEPATH'].'] ON ' . $tmp_dfile_sect_cnt, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

            $tmp_dfile_bi_path_ARRAY = explode($tmp_dfile_array[$tmp_dfile_sect_cnt-2], $SOURCE_filepath_for_DESTINATION);

            $tmp_dfile .= $tmp_dfile_bi_path_ARRAY[1];
            //self::$oCRNRSTN_USR->error_log('oWheel :: Run ftp_mksubdirs=> [DESTINATION_FILEPATH]=' . $tmp_stats_DESTINATION_ARRAY['DESTINATION_FILEPATH'].' | [FTP_DIR_PATH]=' . $tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH']. ' on tmp_split_ARRAY[tmp_split_cnt-2]=' . $tmp_split_ARRAY[$tmp_split_cnt-2], __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');
            //self::$oCRNRSTN_USR->error_log('oWheel :: Run ftp_mksubdirs @ ' . $tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH'].' for =>[' . $tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH'].$tmp_file_dirpath_final, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

            if($this->ftp_mksubdirs($ftp_stream_target, $tmp_slashChar, $tmp_stats_DESTINATION_ARRAY['FTP_DIR_PATH'].$tmp_file_dirpath_final)){

                //self::$oCRNRSTN_USR->error_log('oWheel :: ftp_mksubdirs SUCCESS', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

            }else{

                $error = error_get_last();

                //
                // WE USE FTP_CHDIR TO SEE IF WE NEED TO CALL FTP_MKDIR. IT IS OK (OR EXPECTED) TO GET FTP_CHDIR ERRORS HERE.
                $pos_ignore_err = strpos($error['message'],'ftp_chdir()');
                if($pos_ignore_err===false){

                    self::$oCRNRSTN_USR->error_log('oWheel :: ftp_mksubdirs ERROR :: ' . $error['message'], __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

                }
            }

            if(substr($tmp_dfile, -1) == $tmp_slashChar){

                $tmp_dfile = rtrim($tmp_dfile, $tmp_slashChar).$tmp_slashChar;
                $tmp_dfile_fname = basename($SOURCE_filepath_for_DESTINATION);
                $tmp_dfile = $tmp_dfile.$tmp_dfile_fname;

            }

            //self::$oCRNRSTN_USR->error_log('oWheel :: SEE [' . $SOURCE_filepath_for_DESTINATION.']. Now run ftp_put LOCAL FILE=>[' . $SOURCE_filepath_for_DESTINATION.'] to DEST FILE=>[' . $tmp_dfile . ']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

            if(ftp_put($ftp_stream_target, $tmp_dfile, $SOURCE_filepath_for_DESTINATION, FTP_BINARY)) {

                $continue_process = true;
                //self::$oCRNRSTN_USR->error_log('oWheel FF - 2/2 (or DF 1 of 1) :: Successfully uploaded LOCAL FILE=>[' . $SOURCE_filepath_for_DESTINATION.'] to DEST FILE=>[' . $tmp_dfile . ']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

            }else{

                $error = error_get_last();
                self::$oCRNRSTN_USR->error_log('oWheel FF - 2/2 (or DF 1 of 1) :: ERROR uploading LOCAL FILE=>[' . $SOURCE_filepath_for_DESTINATION.'] to DEST FILE=>[' . $tmp_dfile . '] :: ' . $error['message'], __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FILE_TRANSFER');

                $this->is_error_on_transfer = true;
                $this->error_on_transfer_message = $error['message'].' <= Error experienced while pushing local file [' . $SOURCE_filepath_for_DESTINATION.'] to FTP destination[{FTP_OR_LOCAL_DETAIL}] as file=>[' . $tmp_dfile . '].';

            }

        }

        return $continue_process;

    }

    # #
    # SOURCE
    # http://patorjk.com/software/taag/#p=display&f=Doh&t=CRNRSTN%20%3A%3A
    public function return_CRNRSTN_ASCII_ART($index = NULL){

        $tmp_crnrstnART[0] = '      ___           <span style="color:#F00;">___</span>           ___           ___           ___                         ___              
     /\__\         <span style="color:#F00;">/\  \</span>         /\  \         /\  \         /\__\                       /\  \             
    /:/  /        <span style="color:#F00;">/::\  \</span>        \:\  \       /::\  \       /:/ _/_         ___          \:\  \            
   /:/  /        <span style="color:#F00;">/:/\:\__\</span>        \:\  \     /:/\:\__\     /:/ /\  \       /\__\          \:\  \      ::::::  ::::::           
  /:/  /  ___   <span style="color:#F00;">/:/ /:/  /</span>    _____\:\  \   /:/ /:/  /    /:/ /::\  \     /:/  /      _____\:\  \     ::::::  ::::::          
 /:/__/  /\__\ <span style="color:#F00;">/:/_/:/__/</span>___ /::::::::\__\ /:/_/:/__/___ /:/_/:/\:\__\   /:/__/      /::::::::\__\         
 \:\  \ /:/  / <span style="color:#F00;">\:\/:::::/  / </span>\:\~~\~~\/__/ \:\/:::::/  / \:\/:/ /:/  /  /::\  \      \:\~~\~~\/__/         
  \:\  /:/  /   <span style="color:#F00;">\::/~~/~~~~</span>   \:\  \        \::/~~/~~~~   \::/ /:/  /  /:/\:\  \      \:\  \          ::::::  ::::::         
   \:\/:/  /     <span style="color:#F00;">\:\~~\</span>        \:\  \        \:\~~\        \/_/:/  /   \/__\:\  \      \:\  \         ::::::  ::::::          
    \::/  /       <span style="color:#F00;">\:\__\</span>        \:\__\        \:\__\         /:/  /         \:\__\      \:\__\             
     \/__/         <span style="color:#F00;">\/__/</span>         \/__/         \/__/         \/__/           \/__/       \/__/      
	 
        
        
        
<!-- 
ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
TIMESTAMP :: ' . $this->return_micro_time() . '

CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Isometric3&t=CRNRSTN%20%3A%3A
DATE :: Sunday, Jul 31, 2022 @ 0949 hrs ::  
-->        
';

        $tmp_crnrstnART[8] = '      ___           <span style="color:#F00;">___</span>           ___           ___           ___                       ___              
     /  /\         <span style="color:#F00;">/  /\</span>         /__/\         /  /\         /  /\          ___        /__/\             
    /  /:/        <span style="color:#F00;">/  /::\</span>        \  \:\       /  /::\       /  /:/_        /  /\       \  \:\          ___           ___
   /  /:/        <span style="color:#F00;">/  /:/\:\</span>        \  \:\     /  /:/\:\     /  /:/ /\      /  /:/        \  \:\        /__/\         /__/\    
  /  /:/  ___   <span style="color:#F00;">/  /:/~/:/</span>    _____\__\:\   /  /:/~/:/    /  /:/ /::\    /  /:/     _____\__\:\       \__\/         \__\/  
 /__/:/  /  /\ <span style="color:#F00;">/__/:/ /:/___ /</span>__/::::::::\ /__/:/ /:/___ /__/:/ /:/\:\  /  /::\    /__/::::::::\         
 \  \:\ /  /:/ <span style="color:#F00;">\  \:\/:::::/</span> \  \:\~~\~~\/ \  \:\/:::::/ \  \:\/:/~/:/ /__/:/\:\   \  \:\~~\~~\/       ___           ___  
  \  \:\  /:/   <span style="color:#F00;">\  \::/~~~~</span>   \  \:\  ~~~   \  \::/~~~~   \  \::/ /:/  \__\/  \:\   \  \:\  ~~~       /__/\         /__/\   
   \  \:\/:/     <span style="color:#F00;">\  \:\</span>        \  \:\        \  \:\        \__\/ /:/        \  \:\   \  \:\           \__\/         \__\/   
    \  \::/       <span style="color:#F00;">\  \:\</span>        \  \:\        \  \:\         /__/:/          \__\/    \  \:\            
     \__\/         <span style="color:#F00;">\__\/</span>         \__\/         \__\/         \__\/                     \__\/             
        
        
        
        
<!-- 
ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
TIMESTAMP :: ' . $this->return_micro_time() . '

CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Isometric3&t=CRNRSTN%20%3A%3A
DATE :: Sunday, Jul 31, 2022 @ 0949 hrs ::  
-->        
';

        $tmp_crnrstnART[4] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">___</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">/\&nbsp;&nbsp;\</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">/::\&nbsp;&nbsp;\</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/::\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/:/&nbsp;_/_&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">/:/\:\__\</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/:/\:\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/:/&nbsp;/\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;___&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">/:/&nbsp;/:/&nbsp;&nbsp;/</span>&nbsp;&nbsp;&nbsp;&nbsp;_____\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;/:/&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;/:/&nbsp;/::\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_____\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;/:/__/&nbsp;&nbsp;/\__\&nbsp;<span&nbsp;style="color:#F00;">/:/_/:/__/</span>___&nbsp;/::::::::\__\&nbsp;/:/_/:/__/___&nbsp;/:/_/:/\:\__\&nbsp;&nbsp;&nbsp;/:/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/::::::::\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;\:\&nbsp;&nbsp;\&nbsp;/:/&nbsp;&nbsp;/&nbsp;<span&nbsp;style="color:#F00;">\:\/:::::/&nbsp;&nbsp;/&nbsp;</span>\:\~~\~~\/__/&nbsp;\:\/:::::/&nbsp;&nbsp;/&nbsp;\:\/:/&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;/::\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\~~\~~\/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;\:\&nbsp;&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">\::/~~/~~~~</span>&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\::/~~/~~~~&nbsp;&nbsp;&nbsp;\::/&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;/:/\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;\:\/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">\:\~~\</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\~~\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\/_/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;\/__\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;\::/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">\:\__\</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">\/__/</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
	&nbsp;<br>
<br>
        
        
        
<!-- 
ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
TIMESTAMP :: ' . $this->return_micro_time() . '

CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Isometric3&t=CRNRSTN%20%3A%3A
DATE :: Sunday, Jul 31, 2022 @ 0949 hrs ::  
-->        
';

        $tmp_crnrstnART[1] = '        CCCCCCCCCCCCC<span style="color:#F00;">RRRRRRRRRRRRRRRRR</span>   NNNNNNNN        NNNNNNNNRRRRRRRRRRRRRRRRR      SSSSSSSSSSSSSSS TTTTTTTTTTTTTTTTTTTTTTTNNNNNNNN        NNNNNNNN
     CCC::::::::::::C<span style="color:#F00;">R::::::::::::::::R</span>  N:::::::N       N::::::NR::::::::::::::::R   SS:::::::::::::::ST:::::::::::::::::::::TN:::::::N       N::::::N
   CC:::::::::::::::C<span style="color:#F00;">R::::::RRRRRR:::::R</span> N::::::::N      N::::::NR::::::RRRRRR:::::R S:::::SSSSSS::::::ST:::::::::::::::::::::TN::::::::N      N::::::N
  C:::::CCCCCCCC::::C<span style="color:#F00;">RR:::::R     R:::::R</span>N:::::::::N     N::::::NRR:::::R     R:::::RS:::::S     SSSSSSST:::::TT:::::::TT:::::TN:::::::::N     N::::::N
 C:::::C       CCCCCC  <span style="color:#F00;">R::::R     R:::::R</span>N::::::::::N    N::::::N  R::::R     R:::::RS:::::S            TTTTTT  T:::::T  TTTTTTN::::::::::N    N::::::N
C:::::C                <span style="color:#F00;">R::::R     R:::::R</span>N:::::::::::N   N::::::N  R::::R     R:::::RS:::::S                    T:::::T        N:::::::::::N   N::::::N      ::::::  ::::::
C:::::C                <span style="color:#F00;">R::::RRRRRR:::::R</span> N:::::::N::::N  N::::::N  R::::RRRRRR:::::R  S::::SSSS                 T:::::T        N:::::::N::::N  N::::::N      ::::::  ::::::
C:::::C                <span style="color:#F00;">R:::::::::::::RR</span>  N::::::N N::::N N::::::N  R:::::::::::::RR    SS::::::SSSSS            T:::::T        N::::::N N::::N N::::::N      ::::::  ::::::
C:::::C                <span style="color:#F00;">R::::RRRRRR:::::R</span> N::::::N  N::::N:::::::N  R::::RRRRRR:::::R     SSS::::::::SS          T:::::T        N::::::N  N::::N:::::::N
C:::::C                <span style="color:#F00;">R::::R</span>     <span style="color:#F00;">R:::::R</span>N::::::N   N:::::::::::N  R::::R     R:::::R       SSSSSS::::S         T:::::T        N::::::N   N:::::::::::N
C:::::C                <span style="color:#F00;">R::::R</span>     <span style="color:#F00;">R:::::R</span>N::::::N    N::::::::::N  R::::R     R:::::R            S:::::S        T:::::T        N::::::N    N::::::::::N
 C:::::C       CCCCCC  <span style="color:#F00;">R::::R</span>     <span style="color:#F00;">R:::::R</span>N::::::N     N:::::::::N  R::::R     R:::::R            S:::::S        T:::::T        N::::::N     N:::::::::N      ::::::  ::::::
  C:::::CCCCCCCC::::C<span style="color:#F00;">RR:::::R</span>     <span style="color:#F00;">R:::::R</span>N::::::N      N::::::::NRR:::::R     R:::::RSSSSSSS     S:::::S      TT:::::::TT      N::::::N      N::::::::N      ::::::  ::::::
   CC:::::::::::::::C<span style="color:#F00;">R::::::R</span>     <span style="color:#F00;">R:::::R</span>N::::::N       N:::::::NR::::::R     R:::::RS::::::SSSSSS:::::S      T:::::::::T      N::::::N       N:::::::N      ::::::  ::::::
     CCC::::::::::::C<span style="color:#F00;">R::::::R</span>     <span style="color:#F00;">R:::::R</span>N::::::N        N::::::NR::::::R     R:::::RS:::::::::::::::SS       T:::::::::T      N::::::N        N::::::N
        CCCCCCCCCCCCC<span style="color:#F00;">RRRRRRRR</span>     <span style="color:#F00;">RRRRRRR</span>NNNNNNNN         NNNNNNNRRRRRRRR     RRRRRRR SSSSSSSSSSSSSSS         TTTTTTTTTTT      NNNNNNNN         NNNNNNN
                                                                                                                                                       
        
        
        
<!-- 
ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
TIMESTAMP :: ' . $this->return_micro_time() . '

CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Isometric3&t=CRNRSTN%20%3A%3A
DATE :: Sunday, Jul 31, 2022 @ 0949 hrs ::  
-->        
';

        $tmp_crnrstnART[5] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CCCCCCCCCCCCC<span&nbsp;style="color:#F00;">RRRRRRRRRRRRRRRRR</span>&nbsp;&nbsp;&nbsp;NNNNNNNN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NNNNNNNNRRRRRRRRRRRRRRRRR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SSSSSSSSSSSSSSS&nbsp;TTTTTTTTTTTTTTTTTTTTTTTNNNNNNNN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NNNNNNNN<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CCC::::::::::::C<span&nbsp;style="color:#F00;">R::::::::::::::::R</span>&nbsp;&nbsp;N:::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::NR::::::::::::::::R&nbsp;&nbsp;&nbsp;SS:::::::::::::::ST:::::::::::::::::::::TN:::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N<br>
&nbsp;&nbsp;&nbsp;CC:::::::::::::::C<span&nbsp;style="color:#F00;">R::::::RRRRRR:::::R</span>&nbsp;N::::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::NR::::::RRRRRR:::::R&nbsp;S:::::SSSSSS::::::ST:::::::::::::::::::::TN::::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N<br>
&nbsp;&nbsp;C:::::CCCCCCCC::::C<span&nbsp;style="color:#F00;">RR:::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::R</span>N:::::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::NRR:::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::RS:::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SSSSSSST:::::TT:::::::TT:::::TN:::::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N<br>
&nbsp;C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CCCCCC&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::R</span>N::::::::::N&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;R::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::RS:::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TTTTTT&nbsp;&nbsp;T:::::T&nbsp;&nbsp;TTTTTTN::::::::::N&nbsp;&nbsp;&nbsp;&nbsp;N::::::N<br>
C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::R</span>N:::::::::::N&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;R::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::RS:::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N:::::::::::N&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::<br>
C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R::::RRRRRR:::::R</span>&nbsp;N:::::::N::::N&nbsp;&nbsp;N::::::N&nbsp;&nbsp;R::::RRRRRR:::::R&nbsp;&nbsp;S::::SSSS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N:::::::N::::N&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::<br>
C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R:::::::::::::RR</span>&nbsp;&nbsp;N::::::N&nbsp;N::::N&nbsp;N::::::N&nbsp;&nbsp;R:::::::::::::RR&nbsp;&nbsp;&nbsp;&nbsp;SS::::::SSSSS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;N::::N&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::<br>
C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R::::RRRRRR:::::R</span>&nbsp;N::::::N&nbsp;&nbsp;N::::N:::::::N&nbsp;&nbsp;R::::RRRRRR:::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SSS::::::::SS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;N::::N:::::::N<br>
C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R::::R</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R:::::R</span>N::::::N&nbsp;&nbsp;&nbsp;N:::::::::::N&nbsp;&nbsp;R::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SSSSSS::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;N:::::::::::N<br>
C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R::::R</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R:::::R</span>N::::::N&nbsp;&nbsp;&nbsp;&nbsp;N::::::::::N&nbsp;&nbsp;R::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;S:::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;N::::::::::N<br>
&nbsp;C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CCCCCC&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R::::R</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R:::::R</span>N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N:::::::::N&nbsp;&nbsp;R::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;S:::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N:::::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::<br>
&nbsp;&nbsp;C:::::CCCCCCCC::::C<span&nbsp;style="color:#F00;">RR:::::R</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R:::::R</span>N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::::NRR:::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::RSSSSSSS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;S:::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TT:::::::TT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::<br>
&nbsp;&nbsp;&nbsp;CC:::::::::::::::C<span&nbsp;style="color:#F00;">R::::::R</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R:::::R</span>N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N:::::::NR::::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::RS::::::SSSSSS:::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N:::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CCC::::::::::::C<span&nbsp;style="color:#F00;">R::::::R</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R:::::R</span>N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::NR::::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::RS:::::::::::::::SS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CCCCCCCCCCCCC<span&nbsp;style="color:#F00;">RRRRRRRR</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">RRRRRRR</span>NNNNNNNN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NNNNNNNRRRRRRRR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RRRRRRR&nbsp;SSSSSSSSSSSSSSS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TTTTTTTTTTT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NNNNNNNN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NNNNNNN<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
<br>
        
        
        
<!-- 
ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
TIMESTAMP :: ' . $this->return_micro_time() . '

CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Isometric3&t=CRNRSTN%20%3A%3A
DATE :: Sunday, Jul 31, 2022 @ 0949 hrs ::  
-->        
';

        $tmp_crnrstnART[2]= '

 ######  <span style="color:#F00;">########</span>  ##    ## ########   ######  ######## ##    ##     ##   ##  
##    ## <span style="color:#F00;">##     ##</span> ###   ## ##     ## ##    ##    ##    ###   ##    #### #### 
##       <span style="color:#F00;">##     ##</span> ####  ## ##     ## ##          ##    ####  ##     ##   ##  
##       <span style="color:#F00;">########</span>  ## ## ## ########   ######     ##    ## ## ##              
##       <span style="color:#F00;">##   ##</span>   ##  #### ##   ##         ##    ##    ##  ####     ##   ##  
##    ## <span style="color:#F00;">##    ##</span>  ##   ### ##    ##  ##    ##    ##    ##   ###    #### #### 
 ######  <span style="color:#F00;">##     ##</span> ##    ## ##     ##  ######     ##    ##    ##     ##   ##  

        
        
        
<!-- 
ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
TIMESTAMP :: ' . $this->return_micro_time() . '

CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Isometric3&t=CRNRSTN%20%3A%3A
DATE :: Sunday, Jul 31, 2022 @ 0949 hrs ::  
-->        
';

        $tmp_crnrstnART[6] = '<br>
<br>
&nbsp;######&nbsp;&nbsp;<span&nbsp;style="color:#F00;">########</span>&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;########&nbsp;&nbsp;&nbsp;######&nbsp;&nbsp;########&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;<br>
##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;<span&nbsp;style="color:#F00;">##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##</span>&nbsp;###&nbsp;&nbsp;&nbsp;##&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;###&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;####&nbsp;####&nbsp;<br>
##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##</span>&nbsp;####&nbsp;&nbsp;##&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;####&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;<br>
##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">########</span>&nbsp;&nbsp;##&nbsp;##&nbsp;##&nbsp;########&nbsp;&nbsp;&nbsp;######&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;##&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">##&nbsp;&nbsp;&nbsp;##</span>&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;####&nbsp;##&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;####&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;<br>
##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;<span&nbsp;style="color:#F00;">##&nbsp;&nbsp;&nbsp;&nbsp;##</span>&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;###&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;###&nbsp;&nbsp;&nbsp;&nbsp;####&nbsp;####&nbsp;<br>
&nbsp;######&nbsp;&nbsp;<span&nbsp;style="color:#F00;">##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##</span>&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;######&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;<br>
<br>
        
        
        
<!-- 
ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
TIMESTAMP :: ' . $this->return_micro_time() . '

CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Isometric3&t=CRNRSTN%20%3A%3A
DATE :: Sunday, Jul 31, 2022 @ 0949 hrs ::  
-->        
';

        $tmp_crnrstnART[3] = '

                                                                                         
   _|_|_|  <span style="color:#F00;">_|_|_|</span>    _|      _|  _|_|_|      _|_|_|  _|_|_|_|_|  _|      _|              
 _|        <span style="color:#F00;">_|    _|</span>  _|_|    _|  _|    _|  _|            _|      _|_|    _|      _|  _|  
 _|        <span style="color:#F00;">_|_|_|</span>    _|  _|  _|  _|_|_|      _|_|        _|      _|  _|  _|              
 _|        <span style="color:#F00;">_|    _|</span>  _|    _|_|  _|    _|        _|      _|      _|    _|_|              
   _|_|_|  <span style="color:#F00;">_|    _|</span>  _|      _|  _|    _|  _|_|_|        _|      _|      _|      _|  _|  
                                                                                         
                                                                                         
        
        
        
<!-- 
ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
TIMESTAMP :: ' . $this->return_micro_time() . '

CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Isometric3&t=CRNRSTN%20%3A%3A
DATE :: Sunday, Jul 31, 2022 @ 0949 hrs ::  
-->        
';

        $tmp_crnrstnART[7] = '<br>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;_|_|_|&nbsp;&nbsp;<span&nbsp;style="color:#F00;">_|_|_|</span>&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|_|_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|_|_|&nbsp;&nbsp;_|_|_|_|_|&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">_|&nbsp;&nbsp;&nbsp;&nbsp;_|</span>&nbsp;&nbsp;_|_|&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|_|&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;<br>
&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">_|_|_|</span>&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;_|_|_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">_|&nbsp;&nbsp;&nbsp;&nbsp;_|</span>&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;_|_|&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;_|_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;_|_|_|&nbsp;&nbsp;<span&nbsp;style="color:#F00;">_|&nbsp;&nbsp;&nbsp;&nbsp;_|</span>&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|_|_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
<br>
        
        
        
<!-- 
ASCII ARTWORK GENERATED BY CRNRSTN :: v' . self::$version_crnrstn . '
TIMESTAMP :: ' . $this->return_micro_time() . '

CREATIVE SOURCE :: http://patorjk.com/software/taag/#p=display&f=Isometric3&t=CRNRSTN%20%3A%3A
DATE :: Sunday, Jul 31, 2022 @ 0949 hrs ::  
-->        
';

        if(!isset($index)){

            return $tmp_crnrstnART[rand ( 0 , 3)];

        }else{

            return $tmp_crnrstnART[$index];

        }

    }

    private function initialize_php_profile(){

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
            define('PHP_MAJOR_VERSION', $version[0]);
            define('PHP_MINOR_VERSION', $version[1]);
            //define('PHP_RELEASE_VERSION', $version[2]);

            $tmp_version_php = PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION . '.' . PHP_RELEASE_VERSION;
            //$this->consume_ddo_system_param($tmp_version_php, 'version_php', 0);
            self::$oCRNRSTN_CONFIG_MGR->input_data_value($tmp_version_php, 'version_php');

        }else{

            //
            // WE ARE AT LEAST PHP v5.2.7
            $tmp_version_php =  PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION . '.' . PHP_RELEASE_VERSION;
            //$this->consume_ddo_system_param($tmp_version_php, 'version_php', 0);
            self::$oCRNRSTN_CONFIG_MGR->input_data_value($tmp_version_php, 'version_php');

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

    //
    // SOURCE :: https://www.php.net/manual/en/openssl.constversion.php
    // AUTHOR :: fontajos at phpeppershop dot com :: https://www.php.net/manual/en/openssl.constversion.php#119283
    // OPENSSL_VERSION_NUMBER parser, works from OpenSSL v.0.9.5b+ (e.g. for use with version_compare())
    // OPENSSL_VERSION_NUMBER is a numeric release version identifier for OpenSSL
    // Syntax: MNNFFPPS: major minor fix patch status (HEX)
    // The status nibble meaning: 0 => development, 1 to e => betas, f => release
    // Examples:
    // - 0x000906023 => 0.9.6b beta 3
    // - 0x00090605f => 0.9.6e release
    // - 0x1000103f  => 1.0.1c
    /**
     * @param OpenSSL version identifier as hex value $openssl_version_number
     */
    private function initialize_openssl_profile($patch_as_number = false, $openssl_version_number = null) {

        if (is_null($openssl_version_number)) $openssl_version_number = OPENSSL_VERSION_NUMBER;

        //$this->error_log('openssl_version_number ::' . $openssl_version_number, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        //error_log('[lnum 3993] [crnrstn] openssl_version_number ::' . $openssl_version_number);
        $openssl_numeric_identifier = str_pad((string)dechex($openssl_version_number),8,'0',STR_PAD_LEFT);
        //error_log('[lnum 3995] [crnrstn] openssl_numeric_identifier ::' . $openssl_numeric_identifier);

        $openssl_version_parsed = array();
        $preg = '/(?<major>[[:xdigit:]])(?<minor>[[:xdigit:]][[:xdigit:]])(?<fix>[[:xdigit:]][[:xdigit:]])';
        $preg .= '(?<patch>[[:xdigit:]][[:xdigit:]])(?<type>[[:xdigit:]])/';

        preg_match_all($preg, $openssl_numeric_identifier, $openssl_version_parsed);

        $openssl_version = false;
        if (!empty($openssl_version_parsed)) {
            $alphabet = array(1 => 'a', 2 => 'b', 3 => 'c', 4 => 'd', 5 => 'e', 6 => 'f', 7 => 'g', 8 => 'h', 9 => 'i',
                10 => 'j', 11 => 'k', 12 => 'l', 13 => 'm', 14 => 'n', 15 => 'o', 16 => 'p', 17 => 'q', 18 => 'r',
                19 => 's', 20 => 't', 21 => 'u', 22 => 'v', 23 => 'w', 24 => 'x', 25 => 'y', 26 => 'z');
            $openssl_version = intval($openssl_version_parsed['major'][0]) . '.';
            $openssl_version .= intval($openssl_version_parsed['minor'][0]) . '.';
            $openssl_version .= intval($openssl_version_parsed['fix'][0]);

            if (!$patch_as_number && array_key_exists(intval($openssl_version_parsed['patch'][0]), $alphabet)) {

                //error_log('[lnum 4097] [crnrstn] openssl_version ::' . $openssl_version . ' + ' . $alphabet[intval($openssl_version_parsed['patch'][0])]);
                $openssl_version .= $alphabet[intval($openssl_version_parsed['patch'][0])]; // ideal for text comparison

            }else{

                $tmp_val = intval($openssl_version_parsed['patch'][0]);

                if($tmp_val != 0){

                    //error_log('[lnum 4106] [crnrstn] openssl_version ::' . $openssl_version . ' + ' . intval($openssl_version_parsed['patch'][0]));
                    $openssl_version .= '.' . intval($openssl_version_parsed['patch'][0]); // ideal for version_compare

                }

            }

        }

        $tmp_version_openssl = $openssl_version;
        self::$oCRNRSTN_CONFIG_MGR->input_data_value($tmp_version_openssl, 'version_openssl');

    }

    public function return_openssl_digest_method(){

        return self::$openssl_preferred_digest;

    }

    private function initialize_digest_profile(){
        /*

        GENERATING LAMP ENVIRONMENT ::
        Ubuntu 18.04.1 LTS
        Apache v2.4.29
        MySQLi v5.7.38
        php v7.0.33
        OpenSSL v1.1.1
        NuSOAP v0.9.5

        $digests             = openssl_get_md_methods();
        $digests_and_aliases = openssl_get_md_methods(true);
        $digest_aliases      = array_diff($digests_and_aliases, $digests);

        $digests->Array(
            [0] => blake2b512
            [1] => blake2s256
            [2] => md4
            [3] => md5
            [4] => md5-sha1
            [5] => ripemd160
            [6] => sha1
            [7] => sha224
            [8] => sha256
            [9] => sha3-224
            [10] => sha3-256
            [11] => sha3-384
            [12] => sha3-512
            [13] => sha384
            [14] => sha512
            [15] => sha512-224
            [16] => sha512-256
            [17] => shake128
            [18] => shake256
            [19] => sm3
            [20] => whirlpool
        )

        $digest_aliases->Array(
            [0] => RSA-MD4
            [1] => RSA-MD5
            [2] => RSA-RIPEMD160
            [3] => RSA-SHA1
            [4] => RSA-SHA1-2
            [5] => RSA-SHA224
            [6] => RSA-SHA256
            [7] => RSA-SHA3-224
            [8] => RSA-SHA3-256
            [9] => RSA-SHA3-384
            [10] => RSA-SHA3-512
            [11] => RSA-SHA384
            [12] => RSA-SHA512
            [13] => RSA-SHA512/224
            [14] => RSA-SHA512/256
            [15] => RSA-SM3
            [18] => id-rsassa-pkcs1-v1_5-with-sha3-224
            [19] => id-rsassa-pkcs1-v1_5-with-sha3-256
            [20] => id-rsassa-pkcs1-v1_5-with-sha3-384
            [21] => id-rsassa-pkcs1-v1_5-with-sha3-512
            [23] => md4WithRSAEncryption
            [26] => md5WithRSAEncryption
            [27] => ripemd
            [29] => ripemd160WithRSA
            [30] => rmd160
            [32] => sha1WithRSAEncryption
            [34] => sha224WithRSAEncryption
            [36] => sha256WithRSAEncryption
            [42] => sha384WithRSAEncryption
            [45] => sha512-224WithRSAEncryption
            [47] => sha512-256WithRSAEncryption
            [48] => sha512WithRSAEncryption
            [52] => sm3WithRSAEncryption
            [53] => ssl3-md5
            [54] => ssl3-sha1
        )

        //
        // 06/29/2022 @ 1953 hrs
        self::$openssl_preferred_digest_ARRAY = array('sha256', 'sha224', 'sha384', 'sha512', 'sha512-224', 'sha512-256', 'RSA-SHA224', 'RSA-SHA256', 'RSA-SHA384', 'RSA-SHA512', 'RSA-SHA512/224', 'RSA-SHA512/256', 'md5', 'sha1', 'RSA-MD5', 'RSA-SHA1');

        [Wed Jun 29 22:52:40.959376 2022] [:error] [pid 39310] [client 172.16.225.1:65098]
        2677 env $secret_key[hello-there-mr-encryption-key] openssl_digest_profile->sha256

        [Wed Jun 29 22:52:40.959389 2022] [:error] [pid 39310] [client 172.16.225.1:65098]
        2679 env $secret_key[\x91Uz\xf1\xe3\x1e\xaa]\nJ2\xe2\n\xfd9\x99,\x10\xc7\xbe\t\xef0=\x9f\xe2d\x13y\xf8\x12@] openssl_digest_profile->sha256

        */

        $tmp_sys_digests_methods_ARRAY = openssl_get_md_methods();
        $tmp_found_digest_match = false;

        foreach(self::$openssl_preferred_digest_ARRAY as $index_pref_digest => $pref_digest_method){

            foreach($tmp_sys_digests_methods_ARRAY as $index_sys_digest => $sys_digest_method){

                if(strtolower($sys_digest_method) == strtolower($pref_digest_method)){

                    $this->error_log('The selected preferred OpenSSL digest is [' . $sys_digest_method . '][PREF=' . $index_pref_digest . '/SYS=' . $index_sys_digest . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                    $tmp_found_digest_match = true;
                    self::$openssl_preferred_digest = $sys_digest_method;
                    self::$oCRNRSTN_CONFIG_MGR->input_data_value(self::$openssl_preferred_digest, 'openssl_preferred_digest');

                    break 2;

                }

            }

        }

        if(!$tmp_found_digest_match){

            $tmp_digests_and_aliases = openssl_get_md_methods(true);
            $tmp_digest_aliases_ARRAY = array_diff($tmp_digests_and_aliases, $tmp_sys_digests_methods_ARRAY);

            foreach($tmp_digest_aliases_ARRAY as $index_sys_digest => $sys_digest_method){

                foreach(self::$openssl_preferred_digest_ARRAY as $index_pref_digest => $pref_digest_method){

                    if(strtoupper($sys_digest_method) == strtoupper($pref_digest_method)){

                        $this->error_log('The selected preferred OpenSSL digest (via alias) is [' . $sys_digest_method . '][PREF=' . $index_pref_digest . '/SYS=' . $index_sys_digest . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                        self::$openssl_preferred_digest = $sys_digest_method;

                        break 2;

                    }

                }

            }

        }

    }

    //
    // SOURCE :: https://stackoverflow.com/questions/58058663/how-to-get-the-ubuntu-version-via-php
    // AUTHOR :: Kevin :: https://stackoverflow.com/users/3859027/kevin
    private function initialize_linux_profile(){

        //error_log('[4031] crnrstn :: linux flavor :: ' . parse_ini_string(shell_exec('cat /etc/lsb-release'))['DISTRIB_RELEASE']);

        /*
        DISTRIB_ID=Ubuntu
        DISTRIB_RELEASE=18.04
        DISTRIB_CODENAME=bionic
        DISTRIB_DESCRIPTION="Ubuntu 18.04.1 LTS"
        */

        $tmp_version_linux = parse_ini_string(shell_exec('cat /etc/lsb-release'))['DISTRIB_DESCRIPTION'];

        self::$oCRNRSTN_CONFIG_MGR->input_data_value($tmp_version_linux, 'version_linux');

    }

    private function initialize_apache_profile(){

        $tmp_SERVER_SOFTWARE = strtolower(trim($_SERVER['SERVER_SOFTWARE']));

        $version_ARRAY = explode('apache/', $tmp_SERVER_SOFTWARE);

        $version = explode('.', $version_ARRAY[1]);

        //
        // POWERED BY APACHE IMAGE DRIVER
        //$this->version_apache_sysimg = (double) $version[0] . '.' . $version[1];
        if(isset($version[1])){ 

            $tmp_version_apache_sysimg = (double) $version[0] . '.' . $version[1];
            self::$oCRNRSTN_CONFIG_MGR->input_data_value($tmp_version_apache_sysimg, 'version_apache_sysimg');

        }else{

            $tmp_version_apache_sysimg = (double) $version[0];
            self::$oCRNRSTN_CONFIG_MGR->input_data_value($tmp_version_apache_sysimg, 'version_apache_sysimg');
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

            $tmp_version_apache = $version[0] . '.' . $version[1] . '.' . $patch;
            self::$oCRNRSTN_CONFIG_MGR->input_data_value($tmp_version_apache, 'version_apache_sysimg');

        }else{

            $tmp_version_apache = $version[0] . '.' . $version[1];
            self::$oCRNRSTN_CONFIG_MGR->input_data_value($tmp_version_apache, 'version_apache_sysimg');

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

    public function return_sticky_link($url, $meta_params_ARRAY =  NULL){

        $tmp_array = array();
        $tmp_flag_array = array();

        $tmp_array[] = 'crnrstn_l=crnrstn';
        $tmp_array[] = 'crnrstn_r=' . urlencode($this->data_encrypt($url));
        $tmp_flag_array['crnrstn_l'] = 1;
        $tmp_flag_array['crnrstn_r'] = 1;

        if(isset($meta_params_ARRAY)){

            if(is_array($meta_params_ARRAY)){

                foreach($meta_params_ARRAY as $key => $value){

                    if(!isset($tmp_flag_array[$key])){

                        $tmp_flag_array[$key] = 1;

                        $tmp_array[] = $value;

                    }

                }

            }else{

                if(is_string($meta_params_ARRAY)){

                    if(!isset($tmp_flag_array['crnrstn_m'])){

                        $tmp_flag_array['crnrstn_m'] = 1;

                        $tmp_array[] = 'crnrstn_m=' . urlencode($meta_params_ARRAY);

                    }

                }

            }

        }

        return $this->append_url_param($tmp_array);

    }

    public function explode_url($uri){

        /*
        parse_url()
        This function is intended specifically for the purpose of
        parsing URLs and not URIs. However, to comply with PHP's
        backwards compatibility requirements it makes an exception
        for the file:// scheme where triple slashes (file:///...)
        are allowed. For any other scheme this is invalid.

        This function may not give correct results for relative URLs.

        array(8) {
            ["scheme"]=>
            string(4) "http"
            ["host"]=>
            string(8) "hostname"
            ["port"]=>
            int(9090)
            ["user"]=>
            string(8) "username"
            ["pass"]=>
            string(8) "password"
            ["path"]=>
            string(5) "/path"
            ["query"]=>
            string(9) "arg=value"
            ["fragment"]=>
            string(6) "anchor"
        }


        $str = "first=value&arr[]=foo+bar&arr[]=baz";

        parse_str($str, $output);
        echo $output['first'];  // value
        echo $output['arr'][0]; // foo bar
        echo $output['arr'][1]; // baz

        */

        $tmp_scheme = '';
        $tmp_host = '';
        $tmp_path = '';
        $tmp_url_parse_array = $this->mb_parse_url($uri);

        $tmp_uri_ARRAY = array();

        if(isset($tmp_url_parse_array['scheme'])){

            $tmp_scheme = $tmp_url_parse_array['scheme'];

        }

        if(isset($tmp_url_parse_array['host'])){

            $tmp_host = $tmp_url_parse_array['host'];

        }

        if(isset($tmp_url_parse_array['path'])){

            $tmp_path = $tmp_url_parse_array['path'];

        }

        $tmp_uri_ARRAY['root'] = $tmp_scheme . '://' . $tmp_host . $tmp_path;

        //error_log(__LINE__ . ' user $tmp_url_parse_array=' . print_r($tmp_url_parse_array, true));

        if(isset($tmp_url_parse_array['query'])){

            parse_str($tmp_url_parse_array['query'], $params_ARRAY);

            $tmp_uri_ARRAY['param'] = $params_ARRAY;

        }else{

            $params_ARRAY = array();
            $tmp_uri_ARRAY['param'] = $params_ARRAY;

        }

        return $tmp_uri_ARRAY;

    }

    public function append_url_param($param_ARRAY, $tunnel_encrypt = true, $no_encrypt_param_ARRAY = NULL, $include_no_encrypt = true){

        //error_log(__LINE__ . ' user append_url_param=' . print_r($param_ARRAY, true));

        if($this->isSSL()){

            $tmp_lnk = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        }else{

            $tmp_lnk = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        }

        $tmp_lnk_explode_ARRAY = $this->explode_url($tmp_lnk);

        /*
        $tmp_lnk_explode_ARRAY['root']
        $tmp_lnk_explode_ARRAY['param']

        echo $tmp_lnk_explode_ARRAY['param']['first'];  // value
        echo $tmp_lnk_explode_ARRAY['param']['arr'][0]; // foo bar
        echo $tmp_lnk_explode_ARRAY['param']['arr'][1]; // baz
        */

        $tmp_flag_param_ARRAY = array();
        $tmp_encrypted_params_pipe = '';
        $tmp_return_str = $tmp_lnk_explode_ARRAY['root'];

        $param_concatenator = '?';

        //
        // ADD ANY *NEW* URL PARAMS
        foreach($param_ARRAY as $key => $value){

            //if(!isset($tmp_flag_param_ARRAY[$this->return_param_name($value)]) && ($key != 'crnrstn_encrypt_tunnel')){
            if($this->return_param_name($value) != 'crnrstn_encrypt_tunnel'){

                $tmp_flag_param_ARRAY[$this->return_param_name($value)] = 1;

                $tmp_return_str .= $param_concatenator . $this->url_param_append($value, $tunnel_encrypt);

                if($tunnel_encrypt){

                    $tmp_encrypted_params_pipe .= $key . '|';

                }

                if($param_concatenator == '?'){

                    $param_concatenator = '&';

                }

            }

        }

        if(isset($no_encrypt_param_ARRAY) && $include_no_encrypt == true){

            foreach($no_encrypt_param_ARRAY as $key => $value){

                //if(!isset($tmp_flag_param_ARRAY[$this->return_param_name($value)]) && ($key != 'crnrstn_encrypt_tunnel')){
                if($this->return_param_name($value) != 'crnrstn_encrypt_tunnel'){

                    $tmp_flag_param_ARRAY[$this->return_param_name($value)] = 1;

                    $tmp_return_str .= $param_concatenator . $this->url_param_append($value, false);

                    if($tunnel_encrypt){

                        $tmp_encrypted_params_pipe .= $key . '|';

                    }

                    if($param_concatenator == '?'){

                        $param_concatenator = '&';

                    }

                }

            }

        }

        //
        // KEEP ALL ORIGINAL URL PARAMS
        foreach($tmp_lnk_explode_ARRAY['param'] as $key00 => $value00){

            if(!isset($tmp_flag_param_ARRAY[$key00]) && ($key00 != 'crnrstn_encrypt_tunnel')){

                if(isset($no_encrypt_param_ARRAY) && $include_no_encrypt == false){

                    $tmp_spoiled = false;

                    foreach ($no_encrypt_param_ARRAY as $key01 => $value01) {

                        if ($key01 == $key00) {

                            $tmp_spoiled = true;

                        }

                    }

                    if(!$tmp_spoiled){

                        $tmp_flag_param_ARRAY[$key00] = 1;

                        $tmp_return_str .= $param_concatenator . $this->url_param_append($key00 . '=' . $value00, $tunnel_encrypt);

                        if($tunnel_encrypt){

                            $tmp_encrypted_params_pipe .= $key00 . '|';

                        }

                        if($param_concatenator == '?'){

                            $param_concatenator = '&';

                        }

                    }

                }else{

                    $tmp_flag_param_ARRAY[$key00] = 1;

                    $tmp_return_str .= $param_concatenator . $this->url_param_append($key00 . '=' . $value00, $tunnel_encrypt);

                    if($tunnel_encrypt){

                        $tmp_encrypted_params_pipe .= $key00 . '|';

                    }

                    if($param_concatenator == '?'){

                        $param_concatenator = '&';

                    }

                }

            }

        }

        if(isset($no_encrypt_param_ARRAY)){

            foreach($no_encrypt_param_ARRAY as $key => $value00){

                $tmp_flag_param_ARRAY[$this->return_param_name($value00)] = 1;

                $tmp_return_str .= $param_concatenator . $this->url_param_append($value00, false);

            }

        }

        if($tunnel_encrypt){

            $tmp_return_str .= $param_concatenator . 'crnrstn_encrypt_tunnel=' . urlencode($this->data_encrypt($tmp_encrypted_params_pipe));

        }

        return $tmp_return_str;

    }

    private function url_param_append($param_str, $tunnel_encrypt){

        if($tunnel_encrypt){

            $tmp_str = '';
            $tmp_array = explode('=', $param_str);

            $tmp_str .= $tmp_array[0];
            $tmp_str .= '=';

            if(isset($tmp_array[1])){

                //
                // EXCLUDE crnrstn_m FROM ENCRYPTION FOR LINK IDENTIFICATION WITHIN ANALYTICS
                if($tmp_array[0] != 'crnrstn_m'){

                    $tmp_str .= urlencode($this->data_encrypt($tmp_array[1]));

                }else{

                    $tmp_str .= $tmp_array[1];

                }

            }else{

                $tmp_str .= $this->data_encrypt('');

            }

            return $tmp_str;

        }else{

            $tmp_str = '';
            $tmp_array = explode('=', $param_str);

            $tmp_str .= $tmp_array[0];
            $tmp_str .= '=';

            if(isset($tmp_array[1])){

                $tmp_str .= urlencode($tmp_array[1]);

            }

            return $tmp_str;

        }

    }

    private function return_param_name($param_str){

        $tmp_array = explode('=', $param_str);

        return $tmp_array[0];

    }

    //
    // SOURCE :: https://stackoverflow.com/questions/5100189/use-php-to-check-if-page-was-accessed-with-ssl
    // AUTHOR :: https://stackoverflow.com/users/887067/saeven
    public function isSSL(){

        if(!empty($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] != 'off'))

            return true;

        if(!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
            return true;

        return false;

    }

    /**
     * UTF-8 aware parse_url() replacement.
     *
     * @return array
     *
     * SOURCE :: https://www.php.net/manual/en/function.parse-url.php
     * AUTHOR :: lauris () lauris ! lv :: https://www.php.net/manual/en/function.parse-url.php#114817
     */
    private function mb_parse_url($url){

        $enc_url = preg_replace_callback(
            '%[^:/@?&=#]+%usD',
            function ($matches)
            {
                return urlencode($matches[0]);
            },
            $url
        );

        $parts = parse_url($enc_url);

        if($parts === false){

            throw new \InvalidArgumentException('Malformed URL: ' . $url);

        }

        foreach($parts as $name => $value){

            $parts[$name] = urldecode($value);

        }

        return $parts;

    }

    private function output_agg_destruct_str(){

        if($this->destruct_output != ''){

            //
            // SET DEFAULT CONSTANT
            $style_theme = CRNRSTN_UI_PHPNIGHT;

            $tmp_theme_ARRAY = $this->return_set_bits($this->system_style_profile_constants);

            if(count($tmp_theme_ARRAY) > 0){

                $style_theme = $tmp_theme_ARRAY[0];     // WE TAKE THE FIRST

            }

            $this->oLog_output_ARRAY[] = $this->error_log('Process ' . __CLASS__ . '::__destruct initiated output of error log trace data.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);


            //$this->print_r($this->destruct_output, 'C<span style="color:#F00;">R</span>NRSTN Debug Mode 2 :: Error Log Trace Debug Output ::', $style_theme, __LINE__, __METHOD__, __FILE__);
            print_r('<div style="height:20px; width:100%; clear:both; display: block; overflow: hidden;">&nbsp;</div>');
            print_r($this->destruct_output);

        }

    }

    public function __destruct() {

        if(isset($this->oLogger)){

            $this->output_agg_destruct_str();

            $this->oLog_output_ARRAY[] = $this->error_log('goodbye crnrstn :: ' . __CLASS__ . '::' . __METHOD__ . ' called. [rtime ' . $this->wall_time() . ' secs]', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);

        }

        //error_log(__LINE__  . ' crnrstn->' . __METHOD__ . '() [rtime ' . $this->wall_time() . ' secs] [' . print_r(self::$system_files_version_hash_ARRAY, true) . ']');

    }

}

# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: crnrstn_config_manager
#  VERSION :: 1.00.0000
#  DATE :: August 13, 2022 @ 0118 hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: Manage all CRNRSTN :: input datum heavy lifting.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_config_manager {

    protected $oLogger;
    public $oCRNRSTN;

    public $oCRNRSTN_CONFIG_DDO;
    private static $arch_permissions_int_const_ARRAY = array();
    
    public $config_serial_crc;

    public function __construct($oCRNRSTN) {

        $this->oCRNRSTN = $oCRNRSTN;
        
        $this->config_serial_crc = $oCRNRSTN->config_serial_crc;
        $this->init_permissions_profile_bitwise();

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN);

        $this->oCRNRSTN_CONFIG_DDO = new crnrstn_decoupled_data_object($this->oCRNRSTN, $this->oCRNRSTN->generate_new_key(100, '01'),'CRNRSTN_SYSTEM_SERIALIZED_DDO');

    }

    private function init_permissions_profile_bitwise(){

        self::$arch_permissions_int_const_ARRAY = $this->oCRNRSTN->arch_permissions_int_const_ARRAY();

    }

    private function return_prefixed_ddo_key($resource_key, $env_key, $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL'){

        $tmp_dataset_prefix_str = $this->return_dataset_nomination_prefix('string', $this->config_serial_crc, $env_key, $data_type_family);
        return $tmp_dataset_prefix_str . $resource_key;

    }

    private function return_generic_permissions_int_profile(){
        
        /*
        CRNRSTN_AUTHORIZE_RUNTIME_ONLY
        CRNRSTN_AUTHORIZE_ALL
        CRNRSTN_AUTHORIZE_DATABASE
        CRNRSTN_AUTHORIZE_SSDTLA
        CRNRSTN_AUTHORIZE_PSSDTLA
        CRNRSTN_AUTHORIZE_SESSION
        CRNRSTN_AUTHORIZE_COOKIE
        CRNRSTN_AUTHORIZE_SOAP
        CRNRSTN_AUTHORIZE_GET

        self::$arch_permissions_int_const_ARRAY = array(CRNRSTN_AUTHORIZE_RUNTIME_ONLY, CRNRSTN_AUTHORIZE_ALL, CRNRSTN_AUTHORIZE_DATABASE, CRNRSTN_AUTHORIZE_SSDTLA, CRNRSTN_AUTHORIZE_PSSDTLA, CRNRSTN_AUTHORIZE_SESSION, CRNRSTN_AUTHORIZE_COOKIE, CRNRSTN_AUTHORIZE_SOAP, CRNRSTN_AUTHORIZE_GET);


        lnum 860
        oCRNRSTN_BITFLIP_MGR->initialize_bit(CRNRSTN_INT_CONST, true);

        $theme_style_ARRAY = $this->return_set_bits($this->system_style_profile_constants);

        if(count($theme_style_ARRAY) > 0){

            $theme_style = $theme_style_ARRAY[0];   // FIRST MATCH

        }

        */

        return CRNRSTN_AUTHORIZE_ALL;

    }

    public function get_resource_count($data_key, $data_type_family, $env_key){

        return $this->oCRNRSTN_CONFIG_DDO->count($this->return_prefixed_ddo_key($data_key, $env_key, $data_type_family));

    }

    public function input_data_value($data_val, $data_key, $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL', $index = NULL, $data_auth_profile = CRNRSTN_AUTHORIZE_ALL, $env_key = NULL){

        //
        // ESTABLISH AND RETURN MYSQLI CONNECTION
        try{

            if(!isset($env_key)){

                $env_key = $this->oCRNRSTN->crcINT(strlen($env_key));

            }

            if(!isset($data_auth_profile)){

                $data_auth_profile = $this->return_generic_permissions_int_profile();

            }

            //error_log(__LINE__ . ' '. __METHOD__ . ' [' . $this->return_prefixed_ddo_key($data_key, $env_key, $data_type_family) . '].');
            //$this->oCRNRSTN->print_r(' crnrstn config '. __METHOD__ . ' [' . $data_key . '(strlen=' . strlen($data_key) . ')][' . $this->return_prefixed_ddo_key($data_key, $env_key, $data_type_family) . '].', 'CRNRSTN :: CONFIGURATION TEST',NULL, __LINE__,__METHOD__,__FILE__);
            $this->oCRNRSTN->error_log('Receiving input: ' . $data_key . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

            $this->oCRNRSTN_CONFIG_DDO->add($data_val, $this->return_prefixed_ddo_key($data_key, $env_key, $data_type_family), $index, $data_auth_profile);

            //
            // HOOOSTON...VE HAF PROBLEM!
            //throw new Exception('CRNRSTN :: error :: on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ').');

        } catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

        return true;

    }

    public function retrieve_data_value($data_key, $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL', $index = NULL, $env_key = NULL, $soap_transport = false){

        //
        // ESTABLISH AND RETURN MYSQLI CONNECTION
        try{

            if(!isset($env_key)){

                $env_key = $this->oCRNRSTN->crcINT(strlen($env_key));

            }

            if(!isset($index)){

                $index = 0;

            }

            //error_log(__LINE__ . ' crnrstn config '. __METHOD__ . ' [' . $data_key . '(strlen=' . strlen($data_key) . ')][' . $this->return_prefixed_ddo_key($data_key, $env_key, $data_type_family) . '].');
            //$this->oCRNRSTN->print_r(' crnrstn config '. __METHOD__ . ' [' . $data_key . '(strlen=' . strlen($data_key) . ')][' . $this->return_prefixed_ddo_key($data_key, $env_key, $data_type_family) . '].', 'CRNRSTN :: CONFIGURATION TEST',NULL, __LINE__,__METHOD__,__FILE__);

            return $this->oCRNRSTN_CONFIG_DDO->preach('value', $this->return_prefixed_ddo_key($data_key, $env_key, $data_type_family), $soap_transport, $index);

            //
            // HOOOSTON...VE HAF PROBLEM!
            //throw new Exception('CRNRSTN :: error :: on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ').');

        } catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    public function retrieve_data_count($data_key, $data_type_family, $env_key){

        if(!isset($env_key)){

            $env_key = $this->oCRNRSTN->crcINT(strlen($env_key));

        }

        return $this->oCRNRSTN_CONFIG_DDO->count($this->return_prefixed_ddo_key($data_key, $env_key, $data_type_family));

    }

    public function isset_data_key($data_key, $data_type_family, $env_key){

        return $this->oCRNRSTN_CONFIG_DDO->preach('isset', $this->return_prefixed_ddo_key($data_key, $env_key, $data_type_family));

    }

    public function output_regression_stripe_ARRAY($result_str, $result_array, $output_format = 'array'){

        $tmp_ARRAY = array();
        $tmp_ARRAY['string'] = $result_str;
        $tmp_ARRAY['index_array'] = $result_array;

        if($output_format != 'array'){

            return $tmp_ARRAY['string'];

        }

        return $tmp_ARRAY;

    }

    private function return_dataset_nomination_prefix($output_format = NULL, $var0 = NULL, $var1 = NULL, $var2 = NULL, $var3 = NULL, $var4 = NULL, $var5 = NULL, $var6 = NULL, $var7 = NULL, $var8 = NULL, $var9 = NULL, $var10 = NULL, $var11 = NULL){

        $tmp_var_index_pos = 0;
        $tmp_total_index = 0;

        if(!isset($output_format)){

            $output_format = 'array';

        }

        $tmp_str_out = '';
        $tmp_array_str_unit_ARRAY = array();
        $tmp_array_out_ARRAY = array();

        if(isset($var0)){

            $tmp_total_index++;
            $tmp_crc = $this->oCRNRSTN->crcINT($var0);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var1)){

            $tmp_total_index++;
            $tmp_crc = $this->oCRNRSTN->crcINT($var1);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var2)){

            $tmp_total_index++;
            $tmp_crc = $this->oCRNRSTN->crcINT($var2);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var3)){

            $tmp_total_index++;
            $tmp_crc = $this->oCRNRSTN->crcINT($var3);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var4)){

            $tmp_total_index++;
            $tmp_crc = $this->oCRNRSTN->crcINT($var4);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var5)){

            $tmp_total_index++;
            $tmp_crc = $this->oCRNRSTN->crcINT($var5);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var6)){

            $tmp_total_index++;
            $tmp_crc = $this->oCRNRSTN->crcINT($var6);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var7)){

            $tmp_total_index++;
            $tmp_crc = $this->oCRNRSTN->crcINT($var7);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var8)){

            $tmp_total_index++;
            $tmp_crc = $this->oCRNRSTN->crcINT($var8);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var9)){

            $tmp_total_index++;
            $tmp_crc = $this->oCRNRSTN->crcINT($var9);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var10)){

            $tmp_total_index++;
            $tmp_crc = $this->oCRNRSTN->crcINT($var10);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        $tmp_var_index_pos++;
        if($tmp_var_index_pos > $tmp_total_index) return $this->output_regression_stripe_ARRAY($tmp_str_out, $tmp_array_str_unit_ARRAY, $output_format);

        if(isset($var11)){

            $tmp_total_index++;
            $tmp_crc = $this->oCRNRSTN->crcINT($var11);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        $tmp_array_out_ARRAY['string'] = $tmp_str_out;
        $tmp_array_out_ARRAY['index_array'] = $tmp_array_str_unit_ARRAY;

        if($output_format == 'array') {

            return $tmp_array_out_ARRAY;

        }

        //
        // $output_format = 'string'
        return $tmp_array_out_ARRAY['string'];

    }

    public function __destruct(){

    }

}


# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: crnrstn_openssl_encryption_layer_profile_manager
#  VERSION :: 1.00.0000
#  DATE :: June 3, 2022 @ 1500hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION ::  Support cookie, session, database and tunnel encryption layer profiles.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_openssl_encryption_layer_profile_manager {

    protected $oLogger;
    public $oCRNRSTN;

    /*
    self::$openssl_digests_include_aliases = true;
    self::$openssl_digests = openssl_get_md_methods(self::$openssl_digests_include_aliases);

    // $secret_key = openssl_digest($secret_key, $digests[n], true)
    */

    public function __construct($oCRNRSTN) {

        $this->oCRNRSTN = $oCRNRSTN;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN);

    }

    public function xxxxxxxx(){

        //
        // ESTABLISH AND RETURN MYSQLI CONNECTION
        try{

            //
            // HOOOSTON...VE HAF PROBLEM!
            throw new Exception('CRNRSTN :: error :: on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ').');

        } catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    public function __destruct(){

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
    public $oCRNRSTN_USR;
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

            //error_log(__LINE__ .' '. __METHOD__ .' we think the array[' . $const_nom . '] index holds a oCRNRSTN_BITMASK object.');

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

            //error_log(__LINE__ .' '. __METHOD__ .' we think the array['.$const_nom.'] index holds a oCRNRSTN_BITMASK object.');

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

            //error_log(__LINE__ .' '. __METHOD__ .' NEW bitmask object flipping['.$integer_const.'] to array index, '.strtoupper(md5($const_nom)));
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

        //error_log(__LINE__ .' '. __METHOD__ .' we put back into the array['.strtoupper(md5($const_nom)).']...a oCRNRSTN_BITMASK object.');

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
            //$this->error_log('addDatabase() for environment [' . $env_key . ']. including and evaluating file [' . $host_or_creds_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
            require($const_file_path);

        }else{

            //
            // WE COULD NOT FIND THE DATABASE CONFIGURATION FILE
            error_log('CRNRSTN :: ERROR :: Constants definition include file (' . $const_file_path . ') not recognized as a file on server [' . $_SERVER['SERVER_NAME'] . '].');

        }

    }

    private function initialize_cpu_profile(){

        if(substr(PHP_OS, 0, 3) == 'WIN'){

            // I DO NOT HAVE WINDOWS COMMANDS YET.
            //exec('for %I in ("'.$file.'") do @echo %~zI', $output);
            //$return = $output[0];
            $this->os_bit_size = (int) 64;

        }else {

            $this->lscpu_output = shell_exec('lscpu');
            $this->uname_output = shell_exec('uname -m');
            $this->getconf_output = (int) shell_exec('getconf LONG_BIT');
            //$this->getconf_output = 128;

            if(is_numeric($this->getconf_output)){

                $this->os_bit_size = (int) $this->getconf_output;
                //error_log(__LINE__ . ' ' . __METHOD__ . ' os_bit_size=' . $this->os_bit_size);

            }else{

                $pos_64 = strpos($this->uname_output, '64');

                if($pos_64 !== false){

                    $this->os_bit_size = (int) 64;
                    //error_log(__LINE__ .' '. __METHOD__ .' os_bit_size='.$this->os_bit_size);

                }else{

                    $this->os_bit_size = (int) 32;
                    //error_log(__LINE__ .' '. __METHOD__ .' os_bit_size='.$this->os_bit_size);

                }

            }

        }

    }

    //
    // SOURCE :: https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
    // AUTHOR :: Scott :: https://stackoverflow.com/users/1698153/scott
    public function generate_new_key($len = 32, $char_selection = NULL){

        //
        // SEND -1 AS $char_selection FOR USE OF *ALL* CHARACTERS IN RANDOM KEY
        // GENERATION...EXCEPT THE SEQUENCE \e ESCAPE KEY (ESC or 0x1B (27) in
        // ASCII) AND NOT SPLITTING HAIRS BETWEEN SEQUENCE \n LINEFEED (LF or
        // 0x0A (10) in ASCII) AND SEQUENCE \r CARRIAGE RETURN (CR or 0x0D
        // (13) in ASCII) AND ALSO SCREW BOTH \f FORM FEED (FF or 0x0C (12) in
        // ASCII) AND \v VERTICAL TAB (VT or 0x0B (11) in ASCII) SEQUENCES.
        // https://www.php.net/manual/en/language.types.string.php#language.types.string.syntax.double
        $token = "";

        if(isset($char_selection) && ($char_selection != -1) && ($char_selection != -2) && ($char_selection != -3)){

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

            if($char_selection == -1){

                $codeAlphabet .= "{}[]:;\"\'|\\+=_- )(*&^%$#@!~
                `?/>.<,   '";

            }

            if($char_selection == -2){

                $codeAlphabet .= "{}[]:|\\+=_- )(*&%$#@!~?/.,";

            }

            //
            // ADD EXCLUSION TO -3 ABOVE WHEN CHECKING FOR $char_selection
            if($char_selection == -3){

                $codeAlphabet .= ":+=_- )(*$#@!~.";

            }

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

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resource_key The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    //
    // SOURCE :: https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
    // AUTHOR :: Scott :: https://stackoverflow.com/users/1698153/scott
    // AUTHOR :: christophe dot weis at statec dot etat dot lu :: https://www.php.net/manual/en/function.openssl-random-pseudo-bytes.php#104322
    private function crypto_rand_secure($min, $max){

        $range = $max - $min;
        if ($range < 1) return $min; // not so random...

        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1

        do{

            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits

        }while($rnd > $range);

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

    public function set($bit) // Set some bit
    {
        $key = (int) ($bit / CRNRSTN_INTEGER_LENGTH);
        $bit = (int) fmod($bit,CRNRSTN_INTEGER_LENGTH);
        @$this->bitmask[$key] |= 1 << $bit;
    }

    public function remove($bit) // Remove some bit
    {
        $key = (int) ($bit / CRNRSTN_INTEGER_LENGTH);
        $bit = (int) fmod($bit,CRNRSTN_INTEGER_LENGTH);
        $this->bitmask[$key] &= ~ (1 << $bit);
        if(!$this->bitmask[$key])
            unset($this->bitmask[$key]);
    }

    public function toggle($bit) // Toggle some bit
    {
        $key = (int) ($bit / CRNRSTN_INTEGER_LENGTH);
        $bit = (int) fmod($bit,CRNRSTN_INTEGER_LENGTH);
        @$this->bitmask[$key] ^= 1 << $bit;
        if(!$this->bitmask[$key])
            unset($this->bitmask[$key]);
    }

    public function read($bit) // Read some bit
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

        for($i = array_pop($keys); $i >= 0; $i--)
        {

            if(isset($this->bitmask[$i])) {

                $string .= sprintf("%0" . CRNRSTN_INTEGER_LENGTH . "b", $this->bitmask[$i]);
                //error_log(__LINE__ .' BITMASK index is set i=['.$i.'] $string=['.$string.']');

            }else{

                //error_log(__LINE__ .' BITMASK index i NOT SET i=['.$i.'] $string=['.$string.']');

            }

        }

        //return print_r(__METHOD__ .' $keys='.print_r($keys, true), true);

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