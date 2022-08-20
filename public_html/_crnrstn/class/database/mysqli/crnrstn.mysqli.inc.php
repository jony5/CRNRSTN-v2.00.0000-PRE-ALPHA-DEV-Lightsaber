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
#  CLASS :: crnrstn_mysqli_conn
#  VERSION :: 2.00.0000
#  DATE :: September 11, 2012 @ 1720hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: A MySQLi database connection.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_mysqli_conn {

    private static $db_host;                // = $host;
    private static $db_db;                  // = $dbname;
    private static $db_un;                  // = $un;
    private static $db_pwd;                 // = $pwd;
    private static $db_port;                // = $port;
    private static $mysqli;

    //public $oSESSION_MGR;
    public $result;

    protected $oLogger;
    public $oCRNRSTN_USR;

    public function __construct($host, $un, $pwd, $db, $port = NULL, $oCRNRSTN_USR = NULL) {

        $this->oCRNRSTN_USR = $oCRNRSTN_USR;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN_USR);

        self::$db_host 		= $host;
        self::$db_db	 	= $db;
        self::$db_un 		= $un;
        self::$db_pwd 		= $pwd;
        self::$db_port 		= (int) $port;

    }

    public function connReturn(){

        //
        // ESTABLISH AND RETURN MYSQLI CONNECTION
        try{

            if(self::$db_port != ''){

                self::$mysqli = new mysqli(self::$db_host, self::$db_un, self::$db_pwd, self::$db_db, self::$db_port);

            }else{

                self::$mysqli = new mysqli(self::$db_host, self::$db_un, self::$db_pwd, self::$db_db);

            }

            if (self::$mysqli->connect_error){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('CRNRSTN :: mysqli connection error :: failed to connect to MySQL: (' . self::$mysqli->connect_errno . ') ' . self::$mysqli->connect_error.' on server ' . $_SERVER['SERVER_NAME'].' (' . $_SERVER['SERVER_ADDR'].').');

            }

            return self::$mysqli;

        } catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

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
#  CLASS :: crnrstn_mysqli_conn_manager
#  VERSION :: 2.00.0000
#  DATE :: September 28, 2013 @ 1720hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: A database connections manager.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_mysqli_conn_manager {
	
	public $config_serial_crc;
	
	private static $db_env_ARRAY = array();
	private static $db_host_ARRAY = array();      // $host;
	private static $db_un_ARRAY = array();        // $un;
	private static $db_pwd_ARRAY = array();       // $pwd;
	private static $db_db_ARRAY = array();        // $dbname;
	private static $db_port_ARRAY = array();      // $port;
    private static $db_profile_is_selected_ARRAY =  array();

    private static $host;			        // runtime return $host;
    private static $un;			            // runtime return $un;
    private static $pwd;			        // runtime return $pwd;
    private static $db;			            // runtime return $dbname;
    private static $port;			        // runtime return $port;
    private static $profile_is_selected;    // initialization optimization for single database architecture
	
	private static $cache_db_pwd;				// = $pwd;
	private static $cache_db_port;				// = $port;

    private static $tmp_oCRNRSTN_SESSION_oDDO_ARRAY = array();
    private static $tmp_oDDO;

    private static $mysqli;
	
	private static $appEnvKey;
	
	protected $oLogger;
    public $oCRNRSTN;
    public $oCRNRSTN_USR;

	public function __construct($oCRNRSTN) {

	    $this->oCRNRSTN = $this->oCRNRSTN_USR = $oCRNRSTN;

        $this->config_serial_crc = $oCRNRSTN->config_serial_crc;

        //$this->oCRNRSTN->print_r('config_serial_crc=[' . $this->config_serial_crc . '] for ' . __CLASS__ . '.', NULL, CRNRSTN_UI_DARKNIGHT, __LINE__, __METHOD__, __FILE__);

	}

    private function wp_db_name(){

        $tmp_dirty_db_ = $this->oCRNRSTN_USR->get_resource('DB_NAME', 0, $this->oCRNRSTN_USR->return_wcr_wp_key());
        $tmp_dirty_un = $this->oCRNRSTN_USR->get_resource('DB_USER', 0, $this->oCRNRSTN_USR->return_wcr_wp_key());
        $tmp_dirty_host = $this->oCRNRSTN_USR->get_resource('DB_HOST', 0, $this->oCRNRSTN_USR->return_wcr_wp_key());

        if(isset(self::$db_db_ARRAY[$this->config_serial_crc][$this->oCRNRSTN_USR->env_key_crc][$this->crcINT($tmp_dirty_host)][$this->crcINT($tmp_dirty_db_)][$this->crcINT($tmp_dirty_un)])){

            $tmp_str = self::$db_db_ARRAY[$this->config_serial_crc][$this->oCRNRSTN_USR->env_key_crc][$this->crcINT($tmp_dirty_host)][$this->crcINT($tmp_dirty_db_)][$this->crcINT($tmp_dirty_un)];

            $this->oCRNRSTN_USR->error_log('CRNRSTN :: is returning the database name, ' . $tmp_str . ', for a WordPress related request from a private, static, multi-dimensional, and signed integer indexed array pointer.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_WORDPRESS);

            return $tmp_str;

        }else{

            return false;

        }

    }

    private function wp_db_user(){

        $tmp_dirty_db_ = $this->oCRNRSTN_USR->get_resource('DB_NAME', 0, $this->oCRNRSTN_USR->return_wcr_wp_key());
        $tmp_dirty_un = $this->oCRNRSTN_USR->get_resource('DB_USER', 0, $this->oCRNRSTN_USR->return_wcr_wp_key());
        $tmp_dirty_host = $this->oCRNRSTN_USR->get_resource('DB_HOST', 0,$this->oCRNRSTN_USR->return_wcr_wp_key());

        if(isset(self::$db_un[$this->config_serial_crc][$this->crcINT($this->oCRNRSTN_USR->env_key)][$this->crcINT($tmp_dirty_host)][$this->crcINT($tmp_dirty_db_)][$this->crcINT($tmp_dirty_un)])){

            $tmp_str = self::$db_un[$this->config_serial_crc][$this->crcINT($this->oCRNRSTN_USR->env_key)][$this->crcINT($tmp_dirty_host)][$this->crcINT($tmp_dirty_db_)][$this->crcINT($tmp_dirty_un)];

            $this->oCRNRSTN_USR->error_log('CRNRSTN :: is returning the database account username, ' . $tmp_str . ', for a WordPress related request from a private, static, multi-dimensional, and signed integer indexed array pointer.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_WORDPRESS);

            return $tmp_str;

        }else{

            return false;

        }

    }

    private function wp_db_password(){

        $tmp_dirty_db_ = $this->oCRNRSTN_USR->get_resource('DB_NAME', 0, $this->oCRNRSTN_USR->return_wcr_wp_key());
        $tmp_dirty_un = $this->oCRNRSTN_USR->get_resource('DB_USER', 0, $this->oCRNRSTN_USR->return_wcr_wp_key());
        $tmp_dirty_host = $this->oCRNRSTN_USR->get_resource('DB_HOST', 0, $this->oCRNRSTN_USR->return_wcr_wp_key());

        if(isset(self::$db_pwd[$this->config_serial_crc][$this->crcINT($this->oCRNRSTN_USR->env_key)][$this->crcINT($tmp_dirty_host)][$this->crcINT($tmp_dirty_db_)][$this->crcINT($tmp_dirty_un)])){

            $tmp_str = self::$db_pwd[$this->config_serial_crc][$this->crcINT($this->oCRNRSTN_USR->env_key)][$this->crcINT($tmp_dirty_host)][$this->crcINT($tmp_dirty_db_)][$this->crcINT($tmp_dirty_un)];

            $this->oCRNRSTN_USR->error_log('CRNRSTN :: is returning the database account (' . $this->wp_db_user() . ') password, ##REDACTED##, for a WordPress related request from a private, static, multi-dimensional, and signed integer indexed array pointer.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_WORDPRESS);

            return $tmp_str;

        }else{

            return false;

        }

    }

    private function wp_db_host(){

        $tmp_dirty_db_ = $this->oCRNRSTN_USR->get_resource('DB_NAME', 0, $this->oCRNRSTN_USR->return_wcr_wp_key());
        $tmp_dirty_un = $this->oCRNRSTN_USR->get_resource('DB_USER', 0, $this->oCRNRSTN_USR->return_wcr_wp_key());
        $tmp_dirty_host = $this->oCRNRSTN_USR->get_resource('DB_HOST', 0, $this->oCRNRSTN_USR->return_wcr_wp_key());

        if(isset(self::$db_host[$this->config_serial_crc][$this->crcINT($this->oCRNRSTN_USR->env_key)][$this->crcINT($tmp_dirty_host)][$this->crcINT($tmp_dirty_db_)][$this->crcINT($tmp_dirty_un)])){

            $tmp_str = self::$db_host[$this->config_serial_crc][$this->crcINT($this->oCRNRSTN_USR->env_key)][$this->crcINT($tmp_dirty_host)][$this->crcINT($tmp_dirty_db_)][$this->crcINT($tmp_dirty_un)];

            $this->oCRNRSTN_USR->error_log('CRNRSTN :: is returning the database host, ' . $tmp_str . ', for a WordPress related request from a private, static, multi-dimensional, and signed integer indexed array pointer.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_WORDPRESS);

            return $tmp_str;

        }else{

            return false;

        }

    }

    private function return_dataset_nomination_prefix($output_format = NULL, $var0 = NULL, $var1 = NULL, $var2 = NULL, $var3 = NULL, $var4 = NULL, $var5 = NULL, $var6 = NULL, $var7 = NULL, $var8 = NULL, $var9 = NULL, $var10 = NULL, $var11 = NULL){

	    if(!isset($output_format)){

            $output_format = 'array';

        }

	    $tmp_str_out = '';
        $tmp_array_str_unit_ARRAY = array();
        $tmp_array_out_ARRAY = array();

        if(isset($var0)){

            $tmp_crc = $this->crcINT($var0);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        if(isset($var1)){

            $tmp_crc = $this->crcINT($var1);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        if(isset($var2)){

            $tmp_crc = $this->crcINT($var2);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        if(isset($var3)){

            $tmp_crc = $this->crcINT($var3);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        if(isset($var4)){

            $tmp_crc = $this->crcINT($var4);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        if(isset($var5)){

            $tmp_crc = $this->crcINT($var5);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        if(isset($var6)){

            $tmp_crc = $this->crcINT($var6);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        if(isset($var7)){

            $tmp_crc = $this->crcINT($var7);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        if(isset($var8)){

            $tmp_crc = $this->crcINT($var8);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        if(isset($var9)){

            $tmp_crc = $this->crcINT($var9);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        if(isset($var10)){

            $tmp_crc = $this->crcINT($var10);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        if(isset($var11)){

            $tmp_crc = $this->crcINT($var11);
            $tmp_str_out .= $tmp_crc . '::';
            $tmp_array_str_unit_ARRAY[] = $tmp_crc;

        }

        $tmp_array_out_ARRAY['str_out'] = $tmp_str_out;
        $tmp_array_out_ARRAY['str_section_array'] = $tmp_array_str_unit_ARRAY;

        if($output_format == 'array') {

            return $tmp_array_out_ARRAY;

        }

        //
        // $output_format = 'string'
        return $tmp_array_out_ARRAY['str_out'];

    }

	public function add_connection($env_key, $host, $un, $pwd, $db, $port = NULL){

	    /*
	    NOTES :: Thursday, August 4, 2022 @ 0450 hrs
	    NOMINATION OF CERTAIN DATA ARTIFACTS CAN BE HARD CODED TO SOME "MAINSTREAM"
	    STANDARD. APART FROM INCREASING THE PORTABILITY OF CRNRSTN ::, THIS WILL
	    ALSO SPEED UP THE ADOPTION OF CRNRSTN :: WITHIN THE BUSINESS CONTEXT. THUS, EVEN BY PER CHANCE
	    A MERE GLANCE AT THIS SHIT RIGHT HERE, AND CRNRSTN :: WILL *UNDENIABLY* BE PERCEIVED AND
	    EXPONENTIALLY MORE READILY RECEIVED AS ONE ITSELF BEING FOUND TO BE IN FASHION WITH AND IN ALL
	    ACCORDANCE UNTO WELL KNOWN INDUSTRY STANDARDS...NO FUNNY STUFF...A MORE THAN SUITABLE
	    BUSINESS FACING SERVICES ORIENTED ARCHITECTURE OF ONLY THE HIGHEST QUALITY AND WHICH WHILE
	    HAVING LACK OF WARRANTY OF MERCHANTABILITY OR SUITABILITY FIT FOR A PURPOSE GUARANTEE,...SAID
	    SOA WOULD AND COULD NEVER HAVE ITS LIGHT BE DIMMED ON ACCOUNT THEREOF WITH RESPECT TO THE
	    LACK OF ANY WARRANTY OF MERCHANTABILITY OR SUITABILITY FIT FOR A PURPOSE GUARANTEE.

	    EMAIL
	        - PHPMAILER
	        - MAIL()
	    DATABASE
	        - REQUEST PROCESSING
	        - RESPONSE HANDLING
	    FILE HANDLING
	        - PERMISSIONS MANAGEMENT
	        - DIRECTORY rw
	    CONNECTIONS
	        - FTP
	        - SFTP
	        - SMTP
	        - DATABASE

	    CONNECTIONS :: DATABASE
        string $hostname = ini_get("mysqli.default_host"),
        string $username = ini_get("mysqli.default_user"),
        string $password = ini_get("mysqli.default_pw"),
        string $database = "",
        int $port = ini_get("mysqli.default_port"),
        string $socket = ini_get("mysqli.default_socket")

	    $tmp_array_out_ARRAY['str_out'] = $tmp_str_out;
        $tmp_array_out_ARRAY['str_section_array'] = $tmp_array_str_unit_ARRAY;

	    return $tmp_array_out_ARRAY;

	     * */

        //
        // Wednesday, August 10, 0628 hrs
        // PASSING NULL FOR INDEX ALLOWS FOR N+1 PROFILES...BASICALLY ARRAY APPENDS. PASSING 0, SAYS WRITE TO INDEX 0!
        // SEE CUT OFF IN prepDatabaseConfig() FOR N+1 SUPPORT TESTING. GOT TO CIRCLE BACK AROUND FOR THAT.

        // public function add_system_resource($env_key, $data_key, $data_value, $data_type_family = 'CRNRSTN::RESOURCE', $data_auth_profile = CRNRSTN_AUTHORIZE_RUNTIME_ONLY){
        $this->oCRNRSTN->add_system_resource($env_key, 'env_key',  $env_key, 'CRNRSTN_SYSTEM_RESOURCE::CRNRSTN_DATABASE', CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
        $this->oCRNRSTN->add_system_resource($env_key, 'host',  $host, 'CRNRSTN_SYSTEM_RESOURCE::CRNRSTN_DATABASE', CRNRSTN_AUTHORIZE_RUNTIME_ONLY);
        $this->oCRNRSTN->add_system_resource($env_key, 'un', $un, 'CRNRSTN_SYSTEM_RESOURCE::CRNRSTN_DATABASE');
        $this->oCRNRSTN->add_system_resource($env_key, 'pwd', $pwd, 'CRNRSTN_SYSTEM_RESOURCE::CRNRSTN_DATABASE');
        $this->oCRNRSTN->add_system_resource($env_key, 'db', $db, 'CRNRSTN_SYSTEM_RESOURCE::CRNRSTN_DATABASE');
        $this->oCRNRSTN->add_system_resource($env_key, 'port', $port, 'CRNRSTN_SYSTEM_RESOURCE::CRNRSTN_DATABASE');

	}
	
	private function prepDatabaseConfig($host = NULL, $db = NULL, $un = NULL, $port = NULL, $pwd = NULL){

	    try{

            //
            // IS CUSTOM CONFIG?
            $tmp_config_hash_ARRAY = array();
            $tmp_is_custom_config = false;
            $tmp_stripe_key_ARRAY = $this->oCRNRSTN->return_stripe_key_array('$host', '$db', '$un', '$port', '$pwd');
            $tmp_custom_db_config_status_ARRAY = $this->oCRNRSTN->return_regression_stripe_ARRAY('HAS_STRING_DATA', $tmp_stripe_key_ARRAY, $host, $db, $un, $port, $pwd);

            //error_log(__LINE__ . ' mysqli ' . __METHOD__ . ':: [' . print_r($tmp_custom_db_config_status_ARRAY, true) . ']');
            //die();
            $tmp_custom_db_config_status = $tmp_custom_db_config_status_ARRAY['string'];
            $tmp_custom_db_config_status_ARRAY = $tmp_custom_db_config_status_ARRAY['index_array'];

            if(strlen($tmp_custom_db_config_status > 0)){

                $tmp_is_custom_config = true;

            }

            $tmp_data_family_str = 'CRNRSTN_SYSTEM_RESOURCE::CRNRSTN_DATABASE';
            $tmp_db_profile_cnt = $this->oCRNRSTN->get_resource_count('db', $tmp_data_family_str, $this->oCRNRSTN->get_server_env());

            if(!$tmp_is_custom_config && $tmp_db_profile_cnt == 1){

                //
                // ONLY ONE DATABASE CONFIGURATION FOR CRNRSTN ::. NOT THE SAME AS N+1 WORDPRESS CONFIG.
                self::$host = $this->oCRNRSTN->get_resource('host', 0, $tmp_data_family_str);
                self::$db = $this->oCRNRSTN->get_resource('db', 0, $tmp_data_family_str);
                self::$un = $this->oCRNRSTN->get_resource('un', 0, $tmp_data_family_str);
                self::$pwd = $this->oCRNRSTN->get_resource('pwd', 0, $tmp_data_family_str);
                self::$port = $this->oCRNRSTN->get_resource('port', 0, $tmp_data_family_str);

                $tmp_db_configuration_hash_salt = $this->return_dataset_nomination_prefix('string', self::$host, self::$db, self::$un, self::$pwd, self::$port);
                $tmp_db_configuration_hash_salt_md5 = md5($tmp_db_configuration_hash_salt);

                //
                // HAVE WE SEEN THIS BEFORE?
                if(!in_array($tmp_db_configuration_hash_salt_md5, $tmp_config_hash_ARRAY)){

                    //$this->oCRNRSTN_USR->print_r('We do not have hash ' . $tmp_db_configuration_hash_salt_md5 . ' in the $tmp_config_hash_ARRAY array[' . print_r($tmp_config_hash_ARRAY, true) . '].', 'oDDO Testing', CRNRSTN_UI_DARKNIGHT, __LINE__, __METHOD__, __FILE__);
                    $tmp_config_hash_ARRAY[] = $tmp_db_configuration_hash_salt_md5;

                    $this->oCRNRSTN->add_system_resource($this->oCRNRSTN_USR->get_server_env(), '_CRNRSTN_DB_CNFG_HASH_ARRAY', $tmp_config_hash_ARRAY, $tmp_data_family_str, CRNRSTN_AUTHORIZE_RUNTIME_ONLY);

                }

                return true;

            }

            error_log(__LINE__ . ' mysqli ' . __METHOD__ . ' WE CAN COME BACK LATER TO SUPPORT N+1 DATABASE CONNECTION PROFILES. die();');
            die();
            //if($tmp_profile_cnt > 0){

                for($i = 0; $i < $tmp_profile_cnt; $i++){

                    if(!isset(self::$db)){

                         self::$profile_is_selected = 1;

//                        self::$db_host_ARRAY[] = self::$host;
//                        self::$db_un_ARRAY[] = self::$un;
//                        self::$db_pwd_ARRAY[] = self::$pwd;
//                        self::$db_db_ARRAY[] = self::$db;
//                        self::$db_port_ARRAY[] = self::$port;

                    }else{

                        //
                        // HONOR ANY PARAMETER OVERRIDES
                        // $host = NULL, $db = NULL, $un = NULL, $port = NULL, $pwd = NULL
                        //if(isset($host) || $tmp_is_custom_config){
                        if(isset($host)){

                            self::$host = $host;
                            //self::$host = $tmp_oDDO->preach('value', $tmp_dataset_prefix_str . 'HOSTNAME', false, $i, false);

                        }

                        if(isset($un) || $tmp_is_custom_config){

                            self::$un = $un;
                            //self::$un = $tmp_oDDO->preach('value', $tmp_dataset_prefix_str . 'USERNAME', false, $i, false);

                        }

                        if(isset($pwd) || $tmp_is_custom_config){

                            if($pwd != $tmp_oDDO->preach('value', $tmp_dataset_prefix_str . 'PASSWORD', false, $i, false)){

                                self::$pwd = $db;

                            }else{

                                self::$pwd = $tmp_oDDO->preach('value', $tmp_dataset_prefix_str . 'PASSWORD', false, $i, false);

                            }

                        }

                        if(isset($db) || $tmp_is_custom_config){

                            if($db != $tmp_oDDO->preach('value', $tmp_dataset_prefix_str . 'DATABASE', false, $i, false)){

                                self::$db = $db;

                            }else{

                                self::$db = $tmp_oDDO->preach('value', $tmp_dataset_prefix_str . 'DATABASE', false, $i, false);

                            }

                        }

                        if(isset($port) || $tmp_is_custom_config){

                            if($port != $tmp_oDDO->preach('value', $tmp_dataset_prefix_str . 'PORT', false, $i, false)){

                                self::$port = $port;

                            }else{

                                self::$port = $tmp_oDDO->preach('value', $tmp_dataset_prefix_str . 'PORT', false, $i, false);

                            }

                        }

                    }

                }

//                if(self::$profile_is_selected == 2){
//
//                    self::$db_host_ARRAY[] = self::$host;
//                    self::$db_un_ARRAY[] = self::$un;
//                    self::$db_pwd_ARRAY[] = self::$pwd;
//                    self::$db_db_ARRAY[] = self::$db;
//                    self::$db_port_ARRAY[] = self::$port;
//
//                    self::$profile_is_selected = 0;
//
//                }

            //}

            $tmp_db_configuration_hash_salt = $this->return_dataset_nomination_prefix('string', self::$host , self::$db , self::$un , self::$port, self::$pwd);
            $tmp_db_configuration_hash_salt_md5 = md5($tmp_db_configuration_hash_salt);

            //
            // IF HASHED INPUT PARAMETERS MATCH WHAT HAS BEEN STORED IN SESSION, PREPARATION IS COMPLETE.
            $tmp_database_hash_config_ARRAY = $this->oCRNRSTN_USR->get_session_param('_CRNRSTN_DB_CNFG_HASH_ARRAY');

            if(is_array($tmp_database_hash_config_ARRAY)){

                if(in_array($tmp_db_configuration_hash_salt_md5, $tmp_database_hash_config_ARRAY)){

                    error_log(__LINE__ . ' mysqli SALT [' . $tmp_db_configuration_hash_salt_md5 . '] FOUND IN ARRAY[' . print_r($tmp_database_hash_config_ARRAY, true) . '].');
                    die();
                    return true;

                }else{

                    /*
                    if($this->oCRNRSTN_USR->isset_data_key('CRNRSTN_DEVICE_DETECTED')){

                    replaces

                    if($this->oCRNRSTN_USR->isset_session_param('CRNRSTN_DEVICE_DETECTED')){

                    ===

                    $this->oCRNRSTN_USR->get_resource('un', $tmp_data_family_str);

                    replaces

                    $this->oCRNRSTN_USR->get_session_param('CRNRSTN_DEVICE_DETECTED')

                    ===

                    //oCRNRSTN->input_data_value($data_value, $data_key, $data_type_family = 'CRNRSTN::RESOURCE', $index = NULL, $data_auth_profile = CRNRSTN_AUTHORIZE_RUNTIME_ONLY, $env_key = NULL){
                    $this->oCRNRSTN_USR->input_data_value(CRNRSTN_UI_DESKTOP, 'CRNRSTN_DEVICE_DETECTED', NULL, 0);

                    replaces

                    //$this->oCRNRSTN_USR->set_session_param('CRNRSTN_DEVICE_DETECTED', CRNRSTN_UI_DESKTOP);

                   */

                    //
                    // NEED TO INITIALIZE DATABASE CONFIGURATION
                    $tmp_database_hash_config_ARRAY[] = $tmp_db_configuration_hash_salt_md5;

                    $this->oCRNRSTN_USR->input_data_value($tmp_database_hash_config_ARRAY, '_CRNRSTN_DB_CNFG_HASH_ARRAY', NULL, 0);
                    //$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_CNFG_HASH_ARRAY', $tmp_database_hash_config_ARRAY);

                    //$tmp_database_hash_config_ARRAY = $this->oCRNRSTN_USR->get_session_param('_CRNRSTN_DB_CNFG_HASH_ARRAY');
                    $tmp_database_hash_config_ARRAY = $this->oCRNRSTN_USR->get_resource('_CRNRSTN_DB_CNFG_HASH_ARRAY');

                    if(in_array($tmp_db_configuration_hash_salt_md5, $tmp_database_hash_config_ARRAY)){

                        error_log(__LINE__ . ' mysqli SALT [' . $tmp_db_configuration_hash_salt_md5 . '] FOUND IN ARRAY[' . print_r($tmp_database_hash_config_ARRAY, true) . '].');
                        die();
                        return true;

                    }else {

                        if (!is_array($tmp_database_hash_config_ARRAY)) {

                            error_log(__LINE__ . ' mysqli SALT [' . $tmp_db_configuration_hash_salt_md5 . '] NOT FOUND IN [' . print_r($tmp_database_hash_config_ARRAY, true) . '].');
                            die();
                            $tmp_database_hash_config_ARRAY = array();

                        }

                        error_log(__LINE__ . ' mysqli SALT [' . $tmp_db_configuration_hash_salt_md5 . '] FOUND IN ARRAY[' . print_r($tmp_database_hash_config_ARRAY, true) . '].');
                        die();

                    }

//                //
//                // INITIALIZE/REFRESH SESSION PARAMETERS
//                $this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_ENV', self::$appEnvKey);
//                $this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_HOST', $tmp_db_host);
//                $this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_DB', $tmp_db_db);
//                $this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_UN', $tmp_un);
//
//                //
//                // INITIALIZE/REFRESH OPTIMIZATION HASH (IN SESSION) TO STREAMLINE PREPARATION OF DATABASE CONNECTION
//                $this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_CNFG', md5($host.'::' . $db.'::' . $un.'::' . $port.'::' . $pwd));


                }

            }else{

                $tmp_database_hash_config_ARRAY = array();

                //
                // NEED TO INITIALIZE DATABASE CONFIGURATION
                $tmp_database_hash_config_ARRAY[] = $tmp_db_configuration_hash_salt_md5;

                $this->oCRNRSTN_USR->input_data_value($tmp_database_hash_config_ARRAY, '_CRNRSTN_DB_CNFG_HASH_ARRAY', NULL, 0);
                //$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_CNFG_HASH_ARRAY', $tmp_database_hash_config_ARRAY);

                $tmp_database_hash_config_ARRAY = $this->oCRNRSTN_USR->get_resource('_CRNRSTN_DB_CNFG_HASH_ARRAY');
                //$tmp_database_hash_config_ARRAY = $this->oCRNRSTN_USR->get_session_param('_CRNRSTN_DB_CNFG_HASH_ARRAY');

                if(in_array($tmp_db_configuration_hash_salt_md5, $tmp_database_hash_config_ARRAY)){

                    error_log(__LINE__ . ' mysqli SALT [' . $tmp_db_configuration_hash_salt_md5 . '] FOUND IN ARRAY[' . print_r($tmp_database_hash_config_ARRAY, true) . '].');
                    die();
                    return true;

                }else {

                    if (!is_array($tmp_database_hash_config_ARRAY)) {

                        error_log(__LINE__ . ' mysqli SALT [' . $tmp_db_configuration_hash_salt_md5 . '] NOT FOUND IN [' . print_r($tmp_database_hash_config_ARRAY, true) . '].');
                        die();

                    }

                    error_log(__LINE__ . ' mysqli SALT [' . $tmp_db_configuration_hash_salt_md5 . '] FOUND IN ARRAY[' . print_r($tmp_database_hash_config_ARRAY, true) . '].');
                    die();

                }


            }

            error_log(__LINE__ . ' mysqli prep total database count=' . $tmp_oDDO->count($tmp_dataset_prefix_str . 'DATABASE', false));

            if($tmp_profile_cnt < 1){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to locate any database configuration data for this connection.');

            }

            if($tmp_profile_cnt > 0){

                error_log(__LINE__ . ' mysqli ' . __METHOD__ . ' only 1 database for this environment. ' . $tmp_oDDO->preach('value', $tmp_dataset_prefix_str . 'DATABASE', false, 0, false));

                for($i = 0; $i < $tmp_profile_cnt; $i++){


                }
            }

            if($tmp_profile_cnt <> 1){

                error_log(__LINE__ . ' mysqli ' . __METHOD__ . ':: ' . $tmp_cnt . ' database found for this environment.');

            }

            die();




        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }


        //
		// $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection();
		if($host == NULL){

			//
			// IF NO PARAMS OR CACHE, LOCALLY CACHE FIRST SOLUTION FROM *MULTI-DEM ARRAY
			// *CRNRSTN ENVIRONMENTAL DETECTION + VALUES FROM THE CONFIGURATION FILE		
			if(!($this->oCRNRSTN_USR->isset_session_param('_CRNRSTN_DB_HOST'))){
				
				if(isset(self::$db_host[$this->config_serial_crc])){

					foreach (self::$db_host[$this->config_serial_crc][self::$appEnvKey] as $tmp_db_host => $tmp_host_array) {

						foreach($tmp_host_array as $tmp_db_db => $tmp_db_array){

							foreach($tmp_db_array as $tmp_un => $oMYSQLI){

                                error_log(__LINE__ . ' mysqli conn mgr ' . __METHOD__ . ':: [$tmp_db_db=' . $tmp_db_db . '][' . print_r(self::$db_host[$this->config_serial_crc][self::$appEnvKey], true) . '].');

                                //
								// INITIALIZE/REFRESH SESSION PARAMETERS
                                $this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_ENV', self::$appEnvKey);
                                $this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_HOST', $tmp_db_host);
                                $this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_DB', $tmp_db_db);
                                $this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_UN', $tmp_un);
								
								//
								// INITIALIZE/REFRESH OPTIMIZATION HASH (IN SESSION) TO STREAMLINE PREPARATION OF DATABASE CONNECTION
                                $this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_CNFG', md5($host.'::' . $db.'::' . $un.'::' . $port.'::' . $pwd));
								
								return true;

							}

						}

					}

				}else{

					return false;

				}
				
			}else{
				
				//
				// INITIALIZE/REFRESH OPTIMIZATION HASH (IN SESSION) TO STREAMLINE PREPARATION OF DATABASE CONNECTION
                $this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_CNFG', md5($host.'::' . $db.'::' . $un.'::' . $port.'::' . $pwd));

                error_log(__LINE__ . ' mysqli conn mgr ' . __METHOD__ . ':: [$tmp_db_db=' . $db . '].');

                //
				// IF NO VALUES PASSED, BUT CACHE HAS BEEN SET...USE CACHE.
				return true;

			}
			
		}else{
			
			//
			//  $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection('host');
			if($db == NULL){

				if(!($this->oCRNRSTN_USR->isset_session_param('_CRNRSTN_DB_DB'))){

					foreach (self::$db_host[self::$appEnvKey] as $tmp_db_host => $tmp_host_array) {

						if($tmp_db_host == $this->crcINT($host)){

							foreach($tmp_host_array as $tmp_db_db => $tmp_db_array){

								foreach($tmp_db_array as $tmp_un => $oMYSQLI){
							
									//
									// INITIALIZE/REFRESH SESSION PARAMETERS
									$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_ENV', self::$appEnvKey);
									$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_HOST', $tmp_db_host);
									$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_DB', $tmp_db_db);
									$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_UN', $tmp_un);
							
									//
									// INITIALIZE/REFRESH OPTIMIZATION HASH (IN SESSION) TO STREAMLINE PREPARATION OF DATABASE CONNECTION
									$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_CNFG', md5($host.'::' . $db.'::' . $un.'::' . $port.'::' . $pwd));
							
									return true;

								}

							}

						}

					}

				}else{
					
					//
					// CHECK FOR CHANGES FROM SESSION IN HOST::DB
					if($this->oCRNRSTN_USR->get_session_param('_CRNRSTN_DB_HOST') == $this->crcINT($host)){
						
						//
						// INITIALIZE/REFRESH OPTIMIZATION HASH (IN SESSION) TO STREAMLINE PREPARATION OF DATABASE CONNECTION
						$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_CNFG', md5($host.'::' . $db.'::' . $un.'::' . $port.'::' . $pwd));

						//
						// USE LOCAL OBJECT CACHE...SINCE IT HAS ALREADY BEEN SET
						return true;
						
					}else{
						
						//
						// SOMETHING CHANGED. SESSION NO LONGER MATCHES returnConnection() INPUT PARAMS.
						return false;

					}

				}
				
			}else{
				
				if($un == NULL){
					
					//
					//  $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection('host', 'database');
					if(!($this->oCRNRSTN_USR->isset_session_param('_CRNRSTN_DB_UN'))){

						foreach (self::$db_host[self::$appEnvKey] as $tmp_db_host => $tmp_host_array) {

							if($tmp_db_host == $this->crcINT($host)){

								foreach($tmp_host_array as $tmp_db_db => $tmp_db_array){

									if($tmp_db_db == $this->crcINT($db)){

										foreach($tmp_db_array as $tmp_un => $oMYSQLI){
											
											//	
											// INITIALIZE/REFRESH SESSION PARAMETERS
											$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_ENV', self::$appEnvKey);
											$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_HOST', $tmp_db_host);
											$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_DB', $tmp_db_db);
											$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_UN', $tmp_un);
											
											//
											// INITIALIZE/REFRESH OPTIMIZATION HASH (IN SESSION) TO STREAMLINE PREPARATION OF DATABASE CONNECTION
											$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_CNFG', md5($host.'::' . $db.'::' . $un.'::' . $port.'::' . $pwd));
				
											return true;

										}

									}

								}

							}

						}

					}else{
						
						//
						// CHECK FOR CHANGES FROM SESSION IN HOST::DB
						if($this->oCRNRSTN_USR->get_session_param('_CRNRSTN_DB_HOST') == $this->crcINT($host) && $this->oCRNRSTN_USR->get_session_param('_CRNRSTN_DB_DB') == $this->crcINT($db)){
							
							//
							// INITIALIZE/REFRESH OPTIMIZATION HASH (IN SESSION) TO STREAMLINE PREPARATION OF DATABASE CONNECTION
							$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_CNFG', md5($host.'::' . $db.'::' . $un.'::' . $port.'::' . $pwd));

							//
							// USE LOCAL OBJECT CACHE...SINCE IT HAS ALREADY BEEN SET
							return true;
							
						}else{
							
							//
							// SOMETHING CHANGED. SESSION NO LONGER MATCHES returnConnection() INPUT PARAMS.
							return false;

						}

					}
					
				}else{

					if($port == NULL && $pwd == NULL){
						
						//
						// $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection('host', 'database', 'user');
						if($this->crcINT($un) != $this->oCRNRSTN_USR->get_session_param('_CRNRSTN_DB_UN')){

							foreach (self::$db_host[self::$appEnvKey] as $tmp_db_host => $tmp_host_array) {

								if($tmp_db_host == $this->crcINT($host)){

									foreach($tmp_host_array as $tmp_db_db => $tmp_db_array){

										if($tmp_db_db == $this->crcINT($db)){

											foreach($tmp_db_array as $tmp_un => $oMYSQLI){

												if($tmp_un == $this->crcINT($un)){
												
													//
													// INITIALIZE/REFRESH SESSION PARAMETERS
													$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_ENV', self::$appEnvKey);
													$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_HOST', $tmp_db_host);
													$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_DB', $tmp_db_db);
													$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_UN', $tmp_un);
												
													//
													// INITIALIZE/REFRESH OPTIMIZATION HASH (IN SESSION) TO STREAMLINE PREPARATION OF DATABASE CONNECTION
													$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_CNFG', md5($host.'::' . $db.'::' . $un.'::' . $port.'::' . $pwd));
													
													return true;

												}

											}

										}

									}

								}

							}

						}else{
							
							//
							// CHECK FOR CHANGES FROM SESSION IN HOST::DB
							if($this->oCRNRSTN_USR->get_session_param('_CRNRSTN_DB_HOST') == $this->crcINT($host) && $this->oCRNRSTN_USR->get_session_param('_CRNRSTN_DB_DB') == $this->crcINT($db)){
								
								//
								// INITIALIZE/REFRESH OPTIMIZATION HASH (IN SESSION) TO STREAMLINE PREPARATION OF DATABASE CONNECTION
								$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_CNFG', md5($host.'::' . $db.'::' . $un.'::' . $port.'::' . $pwd));
	
								//
								// USE LOCAL OBJECT CACHE...SINCE IT HAS ALREADY BEEN SET
								return true;
								
							}else{
								
								//
								// SOMETHING CHANGED. SESSION NO LONGER MATCHES returnConnection() INPUT PARAMS.
								return false;

							}

						}
						
					}else{

						if($pwd == NULL && $port != NULL){
							
							//
							// CRNRSTN ENVIRONMENTAL DETECTION + METHOD PARAMETERS + VALUES FROM THE CONFIGURATION FILE
							// $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection('host', 'database', 'user', 'port');
							if($this->crcINT($un) != $this->oCRNRSTN_USR->get_session_param('_CRNRSTN_DB_UN')){

								foreach (self::$db_host[self::$appEnvKey] as $tmp_db_host => $tmp_host_array) {

									if($tmp_db_host == $this->crcINT($host)){

										foreach($tmp_host_array as $tmp_db_db => $tmp_db_array){

											if($tmp_db_db == $this->crcINT($db)){

												foreach($tmp_db_array as $tmp_un => $oMYSQLI){

													if($tmp_un == $this->crcINT($un)){
														
														//
														// INITIALIZE/REFRESH SESSION PARAMETERS
														$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_ENV', self::$appEnvKey);
														$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_HOST', $tmp_db_host);
														$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_DB', $tmp_db_db);
														$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_UN', $tmp_un);
														
														//
														// LOG NOTICE IF PORT FROM PARAMETER DIFFERS FROM CONFIG FILE. USE VALUE FROM PARAMETER
														if($port != self::$db_port[self::$appEnvKey][$tmp_db_host][$tmp_db_db][$tmp_un]){

                                                            $this->oCRNRSTN_USR->error_log('Database port from CRNRSTN :: configuration file differs from the programmatically provided value of (' . $port.').', __LINE__, __METHOD__, __FILE__, CRNRSTN_DATABASE_CONNECTION);

                                                        }
														
														//
														// INITIALIZE/REFRESH OPTIMIZATION HASH (IN SESSION) TO STREAMLINE PREPARATION OF DATABASE CONNECTION
														$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_CNFG', md5($host.'::' . $db.'::' . $un.'::' . $port.'::' . $pwd));
							
														return true;

													}

												}

											}

										}

									}

								}

							}else{
								
								//
								// INITIALIZE/REFRESH OPTIMIZATION HASH (IN SESSION) TO STREAMLINE PREPARATION OF DATABASE CONNECTION
								$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_CNFG', md5($host.'::' . $db.'::' . $un.'::' . $port.'::' . $pwd));
								
								//
								// USE LOCAL OBJECT CACHE...SINCE IT HAS ALREADY BEEN SET
								return true;

							}								
							
						}else{
							
							//
							// $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection('host', 'database', 'user', 'port', 'pwd');
							$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_ENV', self::$appEnvKey);
							$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_HOST', $this->crcINT($host));
							$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_DB', $this->crcINT($db));
							$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_UN', $this->crcINT($un));
							
							self::$db_host[self::$appEnvKey][$this->crcINT($host)][$this->crcINT($db)][$this->crcINT($un)] = $host;
							self::$db_un[self::$appEnvKey][$this->crcINT($host)][$this->crcINT($db)][$this->crcINT($un)] = $un;
							self::$db_db[self::$appEnvKey][$this->crcINT($host)][$this->crcINT($db)][$this->crcINT($un)] = $db;
							
							//
							// INITIALIZE/REFRESH OPTIMIZATION HASH (IN SESSION) TO STREAMLINE PREPARATION OF DATABASE CONNECTION
							$this->oCRNRSTN_USR->set_session_param('_CRNRSTN_DB_CNFG', md5($host.'::' . $db.'::' . $un.'::' . $port.'::' . $pwd));

							return true;

						}

					}

				}

			}

		}
		
		return false;

	}
	
	public function closeConnection($mysqli){

		if($mysqli){

			return $mysqli->close();

		}else{

			return false;

		}

	}
	
	public function returnConnection($host = NULL, $db = NULL, $un = NULL, $port = NULL, $pwd = NULL){
		#$mysqli = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection('host', 'database', 'user', 'port', 'password');
		#$mysqli = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection('host', 'database', 'user', 'port');
		#$mysqli = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection('host', 'database', 'user');
		#$mysqli = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection('host', 'database');
		#$mysqli = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection('host');
		#$mysqli = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection();
		
		//
		// ESTABLISH DATABASE CONNECTIVITY PARAMETERS
		try{

			if($this->prepDatabaseConfig($host, $db, $un, $port, $pwd)){

				if($port != ''){

					self::$cache_db_port = (int) $port;

				}else{

					self::$cache_db_port = self::$port;

				}
				
				if($pwd != ''){

					self::$cache_db_pwd = $pwd;

				}else{

					self::$cache_db_pwd = self::$pwd;

				}

				//
				// INSTANTIATE MYSQLI CONNECTION CLASS OBJECT
				$oMYSQLI = new crnrstn_mysqli_conn(self::$host, self::$un, self::$cache_db_pwd, self::$db, self::$cache_db_port, $this->oCRNRSTN_USR);
				
				//
				// ESTABLISH A CONNECTION AND RETURN CONNECTION HANDLE
				self::$mysqli = $oMYSQLI->connReturn();
				
				return self::$mysqli;

			}else{
				
				//
				// HOOOSTON...VE HAF PROBLEM!
				throw new Exception('CRNRSTN :: mysqli connection manager error :: failed to prepDatabaseConfig() for MySQL on server ' . $_SERVER['SERVER_NAME'].' (' . $_SERVER['SERVER_ADDR'].').');

			}
			
		} catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
			// RETURN NOTHING
			return false;

		}

	}

	public function get_conn_auth_data_wp($type){

        switch ($type){
            case 'db_name':

                return $this->wp_db_name();

            break;
            case 'db_user':

                return $this->wp_db_user();

            break;
            case 'db_password':

                return $this->wp_db_password();

            break;
            case 'db_host':

                return $this->wp_db_host();

            break;

        }

        return false;

    }
	
	public function processQuery($mysqli, $query, $resultMode = NULL){

		try{

			if(isset($resultMode)){
				
				switch($resultMode){
					case MYSQLI_USE_RESULT:

						if($result = $mysqli->query($query, MYSQLI_USE_RESULT)){

							return $result;

						}else{
							
							//
							// HOOOSTON...VE HAF PROBLEM!
							throw new Exception('CRNRSTN :: mysqli query error :: failed to execute query(). ' . $mysqli->error);

						}

					break;
					case MYSQLI_STORE_RESULT:

						if($result = $mysqli->query($query, MYSQLI_STORE_RESULT)){

							return $result;

						}else{
							
							//
							// HOOOSTON...VE HAF PROBLEM!
							throw new Exception('CRNRSTN :: mysqli query error :: failed to execute query(). ' . $mysqli->error);

						}

					break;
					case MYSQLI_ASYNC:

						if($result = $mysqli->query($query, MYSQLI_ASYNC)){

							return $result;

						}else{
							
							//
							// HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('CRNRSTN :: mysqli query error :: failed to execute query(). ' . $mysqli->error);

						}

					break;

				}
				
			}else{

				if($result = $mysqli->query($query)){

					return $result;

				}else{
					
					//
					// HOOOSTON...VE HAF PROBLEM!
					throw new Exception('CRNRSTN :: mysqli query error :: failed to execute query(). ' . $mysqli->error);

				}

			}
			
		}catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

			//
			// RETURN FALSE. SHOULD WE RETURN MYSQLI OBJ, THO?
			return false;

		}

		return false;

	}
	
	public function processMultiQuery($mysqli, $query){

		try{

			if($mysqli){

				if ($mysqli->multi_query($query)) {
					
					//
					// JUST RETURN MYSQLI CONNECTION OBJECT TO HAVE RESULT EXTRACTED LATER.
					return $mysqli;

				}else{
					
					//
					// HOOOSTON...VE HAF PROBLEM!
					throw new Exception('Unable to process multi-query. [' . $mysqli->error.'] You may also want to check the path provided to add_database() in the CRNRSTN :: configuration file for this environment to confirm the database access credentials being used.');

				}

			}else{

				throw new Exception('Unable to process multi-query due to provided mysqli object is false.');

			}
			
		} catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

			//
			// RETURN NOTHING
			return $mysqli;

		}

	}
		
//	public function setEnvironment($oCRNRSTN_ENV){
//
//		//
//		// SET ENVIRONMENT FOR DATABASE CONNECTION MANAGEMENT
//		self::$appEnvKey = $oCRNRSTN_ENV->oSESSION_MGR->getSessionKey();
//
//	}

    private function crcINT($value){

        $value = crc32($value);
        return sprintf("%u", $value);

    }

	public function __destruct() {
		
	}

}