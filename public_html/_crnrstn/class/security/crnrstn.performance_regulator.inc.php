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
#  CLASS :: crnrstn_performance_regulator
#  VERSION :: 1.00.0000
#  DATE :: March 22, 2021 @ 0226 hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: Oversight of CPU, memory and server resource utilization
#                 and runtime management.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_performance_regulator {

    public $oCRNRSTN;

    public $process_id;
    public $operating_system;
    public $starttime;

    public $system_integer_meta_lookup_ARRAY = array();
    public $system_integer_meta_cache_ARRAY = array();
    private static $config_relevant_ini_values_ARRAY = array();

    protected $php_ini_val = array();
    private static $process_id_perf_stat_ARRAY = array();
    private static $spool_resource_override = true;
    private static $ddo_config_ugc_input_audit = false;
    private static $spool_access_ARRAY = array();
    private static $resource_spool_ARRAY = array();

    private static $disk_write_authorization = false;
    protected $max_disk_storage_utilization;
    protected $max_disk_storage_utilization_warning;
    protected $byte_capacity;
    protected $hard_disk_volume_size_bytes;
    protected $disk_capacity_bytes_ARRAY = array();
    protected $disk_size_bytes_ARRAY = array();

    public function __construct($oCRNRSTN){

        $this->starttime = $oCRNRSTN->starttime;
        $this->max_disk_storage_utilization = $oCRNRSTN->max_disk_storage_utilization();
        $this->max_disk_storage_utilization_warning = $oCRNRSTN->max_disk_storage_utilization_warning();

        $this->snapshot_ini_values($oCRNRSTN);

        $this->oCRNRSTN = $oCRNRSTN;

        self::$config_relevant_ini_values_ARRAY = array('default_socket_timeout', 'file_uploads',
            'max_execution_time', 'max_input_time', 'memory_limit', 'post_max_size',
            'precision', 'realpath_cache_size', 'realpath_cache_ttl', 'upload_max_filesize',
            'max_file_uploads', 'variables_order');

        /*
        $this->monitor_pid_performance(true);

        $tmp_mem_arr = $this->getServerMemoryUsage(false);
        $server_load = $this->getServerLoad();
        $peak_mem_usage = memory_get_peak_usage(true);

        error_log(__LINE__ .' '. __METHOD__ .' memory_limit=' . $this->ini_get('memory_limit'));


        $tmp_mem_arr = $this->getServerMemoryUsage(false);
        $peak_mem_usage = memory_get_peak_usage(true);

        error_log(__LINE__ .' '. __METHOD__ .' getServerMemoryUsage :: $peak_mem_usage=' . $peak_mem_usage . ' |total=' . $tmp_mem_arr['total'].' | free=' . $tmp_mem_arr['free']);
        error_log(__LINE__ .' '. __METHOD__ .' getServerMemoryUsage :: $server_load=' . $server_load.'% |mem=' . $this->getServerMemoryUsage().'%');

        //
        //
        //$this->process_id = getmygid();
        //$this->process_id = getmyinode();
        //$this->process_id = getmyuid();

        /*
        https://www.php.net/manual/en/function.getmypid.php#59889

        $this->process_id_perf_stat_ARRAY = $this->getpidinfo($this->process_id);

         * SOURCE :: https://www.php.net/manual/en/function.getmypid.php#118865
        On windows, you can get a list of PID's using this single line statement:
        <?php $pids = array_column(array_map('str_getcsv', explode("\n",trim(`tasklist /FO csv /NH`))), 1); ? >
         *

        //
        // SOURCE :: https://www.php.net/manual/en/function.getmypid.php
        // AUTHOR :: https://www.php.net/manual/en/function.getmypid.php#93753
        # Get all active PIDs.
        //$pids = explode( "\n", trim( `ps -e | awk '{print $1}'` )


        CRNRSTN :: PERFORMANCE MONITOR ATTRIBUTES
        starttime and snapshot at initialization of profile

        walltime
        memory_used     // in bytes
        memory_total    // in bytes
        memory_free     // in bytes
        memory_limit
        cpu_load

        default_socket_timeout int
        Default timeout (in seconds) for socket based streams. Specifying a negative value means an infinite timeout.

        file_uploads bool
        Whether or not to allow HTTP file uploads. See also the upload_max_filesize, upload_tmp_dir, and post_max_size directives.

        max_execution_time int
        This sets the maximum time in seconds a script is allowed to run before it is terminated by the parser. This helps prevent poorly written scripts from tying up the server. The default setting is 30. When running PHP from the command line the default setting is 0.
        On non Windows systems, the maximum execution time is not affected by system calls, stream operations etc. Please see the set_time_limit() function for more details.
        Your web server can have other timeout configurations that may also interrupt PHP execution. Apache has a Timeout directive and IIS has a CGI timeout function. Both default to 300 seconds. See your web server documentation for specific details.

        max_input_time int
        This sets the maximum time in seconds a script is allowed to parse input data, like POST and GET. Timing begins at the moment PHP is invoked at the server and ends when execution begins. The default setting is -1, which means that max_execution_time is used instead. Set to 0 to allow unlimited time.

        memory_limit int
        This sets the maximum amount of memory in bytes that a script is allowed to allocate. This helps prevent poorly written scripts for eating up all available memory on a server. Note that to have no memory limit, set this directive to -1.
        When an int is used, the value is measured in bytes. Shorthand notation, as described in this FAQ, may also be used.

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

        upload_max_filesize int
        The maximum size of an uploaded file.
        When an int is used, the value is measured in bytes. Shorthand notation, as described in this FAQ, may also be used.

        max_file_uploads int
        The maximum number of files allowed to be uploaded simultaneously. Starting with PHP 5.3.4, upload fields left blank on submission do not count towards this limit.

        variables_order string
        Sets the order of the EGPCS (Environment, Get, Post, Cookie, and Server) variable parsing. For example, if variables_order is set to "SP" then PHP will create the superglobals $_SERVER and $_POST, but not create $_ENV, $_GET, and $_COOKIE. Setting to "" means no superglobals will be set.
        Warning :: In both the CGI and FastCGI SAPIs, $_SERVER is also populated by values from the environment; S is always equivalent to ES regardless of the placement of E elsewhere in this directive.
        Note: The content and order of $_REQUEST is also affected by this directive.

        //$memory_total_ARRAY
        $used_mem = (int) $tmp_mem_arr['total'] - (int) $tmp_mem_arr['free'];
        error_log(__LINE__ .' '. __METHOD__ .' getServerMemoryUsage :: $peak_mem_usage=' . $peak_mem_usage.' |used=' . $used_mem.' |total=' . $tmp_mem_arr['total'].' | free=' . $tmp_mem_arr['free']);
        error_log(__LINE__ .' '. __METHOD__ .' getServerMemoryUsage :: $server_load=' . $server_load.'% |mem=' . $this->getServerMemoryUsage().'%');

        */

    }

//    public function grant_permissions($profile_name, $minimum_bytes_required){
//
//        switch($profile_name){
//            case 'fwrite':
//
//                if($this->return_available_byte_capacity($minimum_bytes_required)){
//
//                    return true;
//
//                }
//
//            break;
//
//        }
//
//        return false;
//
//    }

    public function isset_crnrstn_spool($data_attribute, $ddo_memory_pointer, $index = 0){

        switch($data_attribute){
            case 'data_value':
                // jony5@localdev:/var/log/apache2$ [Sun Dec 17 03:47:19.294698 2023] [:error] [pid 24011]
                // [client 172.16.225.1:61879] 4900 crnrstn_decoupled_data_object
                // DO WE GET THIS FAR? $data_attribute[data_value].
                // $data_key[058ebf2b0fd895c1071fe3c3255e2b57d41c58667ffc6c873e64d8151e512d45::version_php].
                // $data_authorization_profile[CRNRSTN_AUTHORIZE_RUNTIME].
                // $data_authorization_profile[8084].
                // $tmp_channel_ARRAY[Array\n(\n    [0] => 8084\n)\n].
                if(isset(self::$spool_access_ARRAY[$ddo_memory_pointer])){

                    error_log(__LINE__ . ' ' . __METHOD__ . ' $ddo_memory_pointer[' . $ddo_memory_pointer . '].');

                    if(isset(self::$spool_access_ARRAY[$ddo_memory_pointer][$index])){

                        return true;

                    }

                }

            break;

        }

        //error_log(__LINE__ . ' ' . __METHOD__ . ' $ddo_memory_pointer[' . $ddo_memory_pointer . ']. self::$spool_access_ARRAY[' . print_r(self::$spool_access_ARRAY, true) . '].');

        return false;

    }

    public function get_crnrstn_spool($data_attribute, $ddo_memory_pointer, $index = 0){

        switch($data_attribute){
            case 'data_value':

                if(isset(self::$spool_access_ARRAY[$ddo_memory_pointer])){

                    if(isset(self::$spool_access_ARRAY[$ddo_memory_pointer][$index])){

                        return self::$spool_access_ARRAY[$ddo_memory_pointer][$index];

                    }

                }

            break;

        }

        return '';

    }

    private function spool_ddo_input_data($data_profile, $data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $env_key){

        /*
        $tmp_input_data_redaction_ARRAY = array();

        TODO :: MAKE DATA HANDLING SAFE FOR RUNNING INTERNAL DATA AUDITS BY
        APPLYING AUDIT-SAFE CRNRSTN :: UGC DATA INPUT AUTHORIZATION
        PROFILES FOR MGGMT OF DATA REDACTION IN OUTPUT.
        -----
        CRNRSTN_AUTHORIZE_ISEMAIL
        CRNRSTN_AUTHORIZE_ISPASSWORD
        CRNRSTN_AUTHORIZE_ALL & CRNRSTN_AUTHORIZE_ISEMAIL
        CRNRSTN_AUTHORIZE_ALL & CRNRSTN_AUTHORIZE_ISPASSWORD
        CRNRSTN_AUTHORIZE_GET & CRNRSTN_AUTHORIZE_ISPASSWORD
        CRNRSTN_AUTHORIZE_POST & CRNRSTN_AUTHORIZE_ISPASSWORD
        CRNRSTN_AUTHORIZE_COOKIE & CRNRSTN_AUTHORIZE_ISPASSWORD
        CRNRSTN_AUTHORIZE_SESSION & CRNRSTN_AUTHORIZE_ISPASSWORD
        CRNRSTN_AUTHORIZE_DATABASE & CRNRSTN_AUTHORIZE_ISPASSWORD
        CRNRSTN_AUTHORIZE_SSDTLA & CRNRSTN_AUTHORIZE_ISPASSWORD
        CRNRSTN_AUTHORIZE_PSSDTLA & CRNRSTN_AUTHORIZE_ISPASSWORD
        CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_ISPASSWORD
        CRNRSTN_AUTHORIZE_SOAP & CRNRSTN_AUTHORIZE_ISPASSWORD

        */

        //
        // SERIALIZE STORAGE INDEX OF SPOOLED CONFIGURATION DATA.
        $tmp_spool_ddo_key = $this->oCRNRSTN->hash($data_key . strval($data_authorization_profile), 'sha256');
        $tmp_spool_ddo_key .= '::' . $data_key;

        $this->spool_ddo_data($data_profile,                'data_profile',                 $tmp_spool_ddo_key);
        $this->spool_ddo_data($data,                        'data',                         $tmp_spool_ddo_key);
        $this->spool_ddo_data($data_key,                    'data_key',                     $tmp_spool_ddo_key);
        $this->spool_ddo_data($data_type_family,            'data_type_family',             $tmp_spool_ddo_key);
        $this->spool_ddo_data($index,                       'index',                        $tmp_spool_ddo_key);
        $this->spool_ddo_data($data_authorization_profile,  'data_authorization_profile',   $tmp_spool_ddo_key);
        $this->spool_ddo_data($env_key,                     'env_key',                      $tmp_spool_ddo_key);
        $this->spool_ddo_data($ttl,                         'ttl',                          $tmp_spool_ddo_key);

        //
        // INIITIALIZE SPOOL EARLY-ACCESS DATA STRUCTURE.
        $tmp_ddo_memory_pointer = $this->oCRNRSTN->hash_ddo_memory_pointer($data_key, $data_type_family, $env_key);

        //error_log(__LINE__ . ' '. __METHOD__ . ' $env_key[' . $env_key . ']. data_key[' . print_r($data_key, true) . ']. $tmp_ddo_memory_pointer[' . $tmp_ddo_memory_pointer . '].');

        self::$spool_access_ARRAY[$tmp_ddo_memory_pointer][] = $data;

        return true;

    }

    private function spool_ddo_data($spool_data, $spool_key, $spool_pointer){

        $tmp_ARRAY = array();

        //
        // PREPARE THE INPUT DATA FOR SPOOLING.
        $tmp_ARRAY[$spool_pointer][$spool_key]['TYPE'] = $this->oCRNRSTN->gettype($spool_data, CRNRSTN_INTEGER);

        //
        // DATA TYPE.
        switch($tmp_ARRAY[$spool_pointer][$spool_key]['TYPE']){
            case CRNRSTN_STRING:
            case CRNRSTN_INT:
            case CRNRSTN_INTEGER:
            case CRNRSTN_BOOL:
            case CRNRSTN_BOOLEAN:
            case CRNRSTN_FLOAT:
            case CRNRSTN_DOUBLE:
            case CRNRSTN_RESOURCE:
            case CRNRSTN_RESOURCE_CLOSED:
            case CRNRSTN_UNKNOWN_TYPE:
            case CRNRSTN_NULL:
            case CRNRSTN_MIXED:

                $tmp_ARRAY[$spool_pointer][$spool_key]['DATA'] = $spool_data;
                $tmp_ARRAY[$spool_pointer][$spool_key]['LENGTH'] = strlen(strval($spool_data));

            break;
            case CRNRSTN_ARRAY:
            case CRNRSTN_OBJECT:

                //
                // SERIALIZE.
                $tmp_ARRAY[$spool_pointer][$spool_key]['DATA'] = serialize($spool_data);
                $tmp_ARRAY[$spool_pointer][$spool_key]['LENGTH'] = strlen($tmp_ARRAY[$spool_pointer][$spool_key]['DATA']);

            break;
            default:

                $tmp_err_msg = 'Unable to detect data type while replaying the CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER INPUT SPOOL.';

                //
                // HOOOSTON...VE HAF PROBLEM!
                $this->oCRNRSTN->error_log($tmp_err_msg, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

            break;

        }

        //
        // # # C # R # N # R # S # T # N # : : # # # #
        // CRNRSTN :: MULTI-CHANNEL DECOUPLED
        // DATA OBJECT (MC-DDO) SERVICES LAYER
        // INPUT SPOOLING. [INPUT]
        self::$resource_spool_ARRAY[] = $tmp_ARRAY;

    }

    public function config_load_config_spool(){

        /*
        CRNRSTN_STRING
        CRNRSTN_INT
        CRNRSTN_INTEGER
        CRNRSTN_BOOL
        CRNRSTN_BOOLEAN
        CRNRSTN_FLOAT
        CRNRSTN_DOUBLE
        CRNRSTN_ARRAY
        CRNRSTN_OBJECT
        CRNRSTN_RESOURCE
        CRNRSTN_RESOURCE_CLOSED
        CRNRSTN_UNKNOWN_TYPE
        CRNRSTN_NULL
        CRNRSTN_MIXED

        [Fri Nov 17 11:46:13.660173 2023] [:error] [pid 49133] [client 172.16.225.1:56802]
        21976 crnrstn spool_ARRAY[
        Array\n(\n
            [data_profile] => Array\n        (\n
                [TYPE] => 7\n
                [DATA] => __construct_integer\n
                [LENGTH] => 19\n        )\n\n)\n]. tmp_data_profile[]. tmp_data_key[]. tmp_env_key[]. die();

        [Fri Nov 17 14:55:02.575907 2023] [:error] [pid 49134] [client 172.16.225.1:59425]
        21192 crnrstn SPOOLING MEM USAGE [1.4893 KiB].
        resource_spool_ARRAY[
            Array\n(\n
                [0] => Array\n        (\n
                    [90ef84fa90545ce0db622b104aeaea2cec43616abd209e6b5918c4ae933a2523::CRNRSTN_debug_mode] =>
                        Array\n                (\n
                            [data_profile] => Array\n                        (\n
                                [TYPE] => 7\n
                                [DATA] => __construct_integer\n
                                [LENGTH] => 19\n                        )\n\n                )\n\n        )\n\n
                [1] => Array\n        (\n
                    [90ef84fa90545ce0db622b104aeaea2cec43616abd209e6b5918c4ae933a2523::CRNRSTN_debug_mode] =>
                        Array\n                (\n
                            [data] => Array\n                        (\n
                                [TYPE] => 9\n
                                [DATA] => 0\n
                                [LENGTH] => 1\n                        )\n\n                )\n\n        )\n\n
                [2] => Array\n        (\n
                    [90ef84fa90545ce0db622b104aeaea2cec43616abd209e6b5918c4ae933a2523::CRNRSTN_debug_mode] =>
                        Array\n                (\n
                            [data_key] => Array\n                        (\n
                                [TYPE] => 7\n
                                [DATA] => CRNRSTN_debug_mode\n
                                [LENGTH] => 18\n                        )\n\n                )\n\n        )\n\n
                [3] => Array\n        (\n
                    [90ef84fa90545ce0db622b104aeaea2cec43616abd209e6b5918c4ae933a2523::CRNRSTN_debug_mode] =>
                        Array\n                (\n
                            [data_type_family] => Array\n                        (\n
                                [TYPE] => 7\n
                                [DATA] => CRNRSTN::RESOURCE::CONFIGURATION\n
                                [LENGTH] => 32\n                        )\n\n                )\n\n        )\n\n
                [4] => Array\n        (\n
                    [90ef84fa90545ce0db622b104aeaea2cec43616abd209e6b5918c4ae933a2523::CRNRSTN_debug_mode] =>
                        Array\n                (\n
                            [index] => Array\n                        (\n
                                [TYPE] => 9\n
                                [DATA] => 0\n
                                [LENGTH] => 1\n                        )\n\n                )\n\n        )\n\n
                [5] => Array\n        (\n
                    [90ef84fa90545ce0db622b104aeaea2cec43616abd209e6b5918c4ae933a2523::CRNRSTN_debug_mode] =>
                        Array\n                (\n
                            [data_authorization_profile] => Array\n                        (\n
                                [TYPE] => 9\n
                                [DATA] => 8085\n
                                [LENGTH] => 4\n                        )\n\n                )\n\n        )\n\n
                [6] => Array\n        (\n
                    [90ef84fa90545ce0db622b104aeaea2cec43616abd209e6b5918c4ae933a2523::CRNRSTN_debug_mode] =>
                        Array\n                (\n
                            [env_key] => Array\n                        (\n
                                [TYPE] => 9\n
                                [DATA] => 8590\n
                                [LENGTH] => 4\n                        )\n\n                )\n\n        )\n\n
                [7] => Array\n        (\n
                    [90ef84fa90545ce0db622b104aeaea2cec43616abd209e6b5918c4ae933a2523::CRNRSTN_debug_mode] =>
                        Array\n                (\n
                            [ttl] => Array\n                        (\n
                                [TYPE] => 9\n
                                [DATA] => 80\n
                                [LENGTH] => 2\n                        )\n\n                )\n\n
        )\n\n)\n].

        */
        //
        // DEACTIVATE CRNRSTN :: CONFIGURATION UGC
        // INPUT VALIDATION SPOOLING.
        self::$spool_resource_override = false;
        $tmp_curr_pointer = NULL;

        //
        // PROCESS ALL SPOOLED UGC INPUT DATA
        // FROM CONFIGURATION INITIALIZATION.
        // # # C # R # N # R # S # T # N # : : # # # #
        // CRNRSTN :: MULTI-CHANNEL DECOUPLED
        // DATA OBJECT (MC-DDO) SERVICES LAYER
        // INPUT SPOOLING. [OUTPUT]
        foreach(self::$resource_spool_ARRAY as $spool_index => $spool_ARRAY0){

            foreach($spool_ARRAY0 as $spool_ddo_pointer => $spool_ARRAY1){

                if(!isset($tmp_curr_pointer)){

                    $tmp_curr_pointer = $spool_ddo_pointer;

                    $tmp_data_profile               = NULL;
                    $tmp_data                       = NULL;
                    $tmp_data_key                   = NULL;
                    $tmp_data_type_family           = NULL;
                    $tmp_index                      = NULL;
                    $tmp_data_authorization_profile = NULL;
                    $tmp_ttl                        = NULL;
                    $tmp_env_key                    = NULL;

                }

                //
                // REPLAY THE UGC INPUT.
                if($tmp_curr_pointer != $spool_ddo_pointer){


                    //
                    // THE CRNRSTN :: CONFIGURATION MANAGER WILL INPUT CLEAN UGC DATA
                    // OR LOOK FOR THE BEST AND MOST ELEGANT (PLEASE READ AS GRACEFUL)
                    // DEGRADATION PATHWAYS TO A VANILLA DEFAULT.
                    //
                    // ON CRITICAL ERR, $oCRNRSTN->config_ugc_input_clean_data() RETURNS
                    // NULL, AND A SYSTEM EXCEPTION IS THROWN. OTHERWISE, IF THE INPUT
                    // DATA IS NOT VALID BUT CAN BE OVERRIDDEN WITH A SETTINGS DEFAULT,
                    // AN ON THE FLY PATCH IS MADE, AND A SYSTEM NOTIFICATION WITH
                    // DETAILS ABOUT THE INTERNAL OVERRIDE IS QUIETLY CAPTURED.
                    //
                    // Friday, November 17, 2023 @ 2325 hrs.
                    //
                    //
                    // DID CRNRSTN :: RECEIVE UGC CONFIGURATION INPUT DATA THAT IS
                    // ASSIGNED TO THE CURRENTLY DETECTED ENVIRONMENT? IF NOT,
                    // RUN A BYPASS HERE IN ORDER TO RECEIVE A MINOR
                    // PERFORMANCE ACCELERATION BOOST.
                    if($this->oCRNRSTN->config_is_valid_detected_env($tmp_env_key) == true){

                        if($tmp_data_key == 'crnrstn_path_directory' || $tmp_data_key == 'crnrstn_system_directory'){

                            error_log(__LINE__ . ' ' . __METHOD__ . ' SPOOL REPLAY :: MC-DDO INPUT tmp_data_profile[' . $tmp_data_profile . ']. tmp_data[' . $tmp_data . ']. tmp_data_key[' .  $tmp_data_key . ']. tmp_data_type_family[' .  $tmp_data_type_family . ']. tmp_index[' .  $tmp_index . ']. tmp_data_authorization_profile[' . $tmp_data_authorization_profile . '].');

                        }

                        $this->oCRNRSTN->config_ugc_input_clean_data($tmp_data_profile, $tmp_data, $tmp_data_key, $tmp_data_type_family, $tmp_index, $tmp_data_authorization_profile, $tmp_ttl, false, $tmp_env_key);

                    }

                    $tmp_curr_pointer = $spool_ddo_pointer;

                    $tmp_data_profile               = NULL;
                    $tmp_data                       = NULL;
                    $tmp_data_key                   = NULL;
                    $tmp_data_type_family           = NULL;
                    $tmp_index                      = NULL;
                    $tmp_data_authorization_profile = NULL;
                    $tmp_ttl                        = NULL;
                    $tmp_env_key                    = NULL;

                }

                foreach($spool_ARRAY1 as $spool_data_key => $spool_ARRAY2){

                    switch($spool_data_key){
                        case 'data_profile':

                            switch($spool_ARRAY2['TYPE']){
                                case CRNRSTN_STRING:

                                    $tmp_data_profile = (string) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_INT:

                                    $tmp_data_profile = (int) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_INTEGER:

                                    $tmp_data_profile = (integer) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_BOOL:
                                case CRNRSTN_BOOLEAN:

                                    //
                                    // THIS CASE WILL NEVER RUN.
                                    $tmp_data_profile = $this->oCRNRSTN->tidy_boolean($spool_ARRAY2['DATA']);
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_FLOAT:

                                    $tmp_data_profile = (float) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_DOUBLE:

                                    $tmp_data_profile = (double) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_RESOURCE:

                                    //
                                    // THIS CASE WILL NEVER RUN.
                                    $tmp_data_profile = $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_RESOURCE_CLOSED:

                                    //
                                    // THIS CASE WILL NEVER RUN.
                                    $tmp_data_profile = $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_UNKNOWN_TYPE:

                                    $tmp_data_profile = $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_NULL:

                                    //
                                    // THIS CASE WILL NEVER RUN.
                                    $tmp_data_profile = NULL;
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_ARRAY:
                                case CRNRSTN_OBJECT:

                                    //
                                    // THIS CASE WILL NEVER RUN.
                                    //
                                    // UNSERIALIZE.
                                    $tmp_data_profile = unserialize($spool_ARRAY2['DATA']);
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                default:

                                    $tmp_err_msg = 'Unable to detect data type while replaying the CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER INPUT SPOOL.';

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    $this->oCRNRSTN->error_log($tmp_err_msg, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                                break;

                            }

                        break;
                        case 'data':

                            switch($spool_ARRAY2['TYPE']){
                                case CRNRSTN_STRING:

                                    $tmp_data = (string) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_INT:

                                    $tmp_data = (int) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_INTEGER:

                                    $tmp_data = (integer) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_BOOL:
                                case CRNRSTN_BOOLEAN:

                                    $tmp_data = $this->oCRNRSTN->tidy_boolean($spool_ARRAY2['DATA']);
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_FLOAT:

                                    $tmp_data = (float) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_DOUBLE:

                                    $tmp_data = (double) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_RESOURCE:

                                    $tmp_data = $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_RESOURCE_CLOSED:

                                    $tmp_data = $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_UNKNOWN_TYPE:

                                    $tmp_data = $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_NULL:

                                    $tmp_data = NULL;
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_ARRAY:
                                case CRNRSTN_OBJECT:

                                    //
                                    // UNSERIALIZE.
                                    $tmp_data = unserialize($spool_ARRAY2['DATA']);
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                default:

                                    $tmp_err_msg = 'Unable to detect data type while replaying the CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER INPUT SPOOL.';

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    $this->oCRNRSTN->error_log($tmp_err_msg, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                                break;

                            }

                        break;
                        case 'data_key':

                            switch($spool_ARRAY2['TYPE']){
                                case CRNRSTN_STRING:

                                    $tmp_data_key = (string) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_INT:

                                    $tmp_data_key = (int) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_INTEGER:

                                    $tmp_data_key = (integer) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_BOOL:
                                case CRNRSTN_BOOLEAN:

                                    //
                                    // THIS CASE WILL NEVER RUN.
                                    $tmp_data_key = $this->oCRNRSTN->tidy_boolean($spool_ARRAY2['DATA']);
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_FLOAT:

                                    $tmp_data_key = (float) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_DOUBLE:

                                    $tmp_data_key = (double) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_RESOURCE:

                                    //
                                    // THIS CASE WILL NEVER RUN.
                                    $tmp_data_key = $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_RESOURCE_CLOSED:

                                    //
                                    // THIS CASE WILL NEVER RUN.
                                    $tmp_data_key = $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_UNKNOWN_TYPE:

                                    $tmp_data_key = $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_NULL:

                                    //
                                    // THIS CASE WILL NEVER RUN.
                                    $tmp_data_key = NULL;
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_ARRAY:
                                case CRNRSTN_OBJECT:

                                    //
                                    // THIS CASE WILL NEVER RUN.
                                    //
                                    // UNSERIALIZE.
                                    $tmp_data_key = unserialize($spool_ARRAY2['DATA']);
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                default:

                                    $tmp_err_msg = 'Unable to detect data type while replaying the CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER INPUT SPOOL.';

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    $this->oCRNRSTN->error_log($tmp_err_msg, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                                break;

                            }

                        break;
                        case 'data_type_family':

                            switch($spool_ARRAY2['TYPE']){
                                case CRNRSTN_STRING:

                                    $tmp_data_type_family = (string) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_INT:

                                    $tmp_data_type_family = (int) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_INTEGER:

                                    $tmp_data_type_family = (integer) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_BOOL:
                                case CRNRSTN_BOOLEAN:

                                    //
                                    // THIS CASE WILL NEVER RUN.
                                    $tmp_data_type_family = $this->oCRNRSTN->tidy_boolean($spool_ARRAY2['DATA']);
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_FLOAT:

                                    $tmp_data_type_family = (float) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_DOUBLE:

                                    $tmp_data_type_family = (double) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_RESOURCE:

                                    //
                                    // THIS CASE WILL NEVER RUN.
                                    $tmp_data_type_family = $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_RESOURCE_CLOSED:

                                    //
                                    // THIS CASE WILL NEVER RUN.
                                    $tmp_data_type_family = $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_UNKNOWN_TYPE:

                                    $tmp_data_type_family = $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_NULL:

                                    $tmp_data_type_family = NULL;
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_ARRAY:
                                case CRNRSTN_OBJECT:

                                    //
                                    // THIS CASE WILL NEVER RUN.
                                    //
                                    // UNSERIALIZE.
                                    $tmp_data_type_family = unserialize($spool_ARRAY2['DATA']);
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                default:

                                    $tmp_err_msg = 'Unable to detect data type while replaying the CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER INPUT SPOOL.';

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    $this->oCRNRSTN->error_log($tmp_err_msg, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                                break;

                            }

                        break;
                        case 'index':

                            switch($spool_ARRAY2['TYPE']){
                                case CRNRSTN_STRING:

                                    $tmp_index = (string) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_INT:

                                    $tmp_index = (int) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_INTEGER:

                                    $tmp_index = (integer) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_BOOL:
                                case CRNRSTN_BOOLEAN:

                                    //
                                    // THIS CASE WILL NEVER RUN.
                                    $tmp_index = $this->oCRNRSTN->tidy_boolean($spool_ARRAY2['DATA']);
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_FLOAT:

                                    $tmp_index = (float) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_DOUBLE:

                                    $tmp_index = (double) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_RESOURCE:

                                    //
                                    // THIS CASE WILL NEVER RUN.
                                    $tmp_index = $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_RESOURCE_CLOSED:

                                    //
                                    // THIS CASE WILL NEVER RUN.
                                    $tmp_index = $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_UNKNOWN_TYPE:

                                    $tmp_index = $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_NULL:

                                    $tmp_index = NULL;
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_ARRAY:
                                case CRNRSTN_OBJECT:

                                    //
                                    // THIS CASE WILL NEVER RUN.
                                    //
                                    // UNSERIALIZE.
                                    $tmp_index = unserialize($spool_ARRAY2['DATA']);
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                default:

                                    $tmp_err_msg = 'Unable to detect data type while replaying the CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER INPUT SPOOL.';

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    $this->oCRNRSTN->error_log($tmp_err_msg, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                                break;

                            }

                        break;
                        case 'data_authorization_profile':

                            switch($spool_ARRAY2['TYPE']){
                                case CRNRSTN_STRING:

                                    $tmp_data_authorization_profile = (string) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_INT:

                                    $tmp_data_authorization_profile = (int) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_INTEGER:

                                    $tmp_data_authorization_profile = (integer) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_BOOL:
                                case CRNRSTN_BOOLEAN:

                                    //
                                    // THIS CASE WILL NEVER RUN.
                                    //
                                    // THIS CASE WILL NEVER RUN.
                                    $tmp_data_authorization_profile = $this->oCRNRSTN->tidy_boolean($spool_ARRAY2['DATA']);
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_FLOAT:

                                    $tmp_data_authorization_profile = (float) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_DOUBLE:

                                    $tmp_data_authorization_profile = (double) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_RESOURCE:

                                    //
                                    // THIS CASE WILL NEVER RUN.
                                    $tmp_data_authorization_profile = $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_RESOURCE_CLOSED:

                                    //
                                    // THIS CASE WILL NEVER RUN.
                                    $tmp_data_authorization_profile = $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_UNKNOWN_TYPE:

                                    $tmp_data_authorization_profile = $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_NULL:

                                    $tmp_data_authorization_profile = NULL;
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_ARRAY:
                                case CRNRSTN_OBJECT:

                                    //
                                    // UNSERIALIZE.
                                    $tmp_data_authorization_profile = unserialize($spool_ARRAY2['DATA']);
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                default:

                                    $tmp_err_msg = 'Unable to detect data type while replaying the CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER INPUT SPOOL.';

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    $this->oCRNRSTN->error_log($tmp_err_msg, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                                break;

                            }

                        break;
                        case 'ttl':

                            switch($spool_ARRAY2['TYPE']){
                                case CRNRSTN_STRING:

                                    $tmp_ttl = (string) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_INT:

                                    $tmp_ttl = (int) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_INTEGER:

                                    $tmp_ttl = (integer) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_BOOL:
                                case CRNRSTN_BOOLEAN:

                                    //
                                    // THIS CASE WILL NEVER RUN.
                                    $tmp_ttl = $this->oCRNRSTN->tidy_boolean($spool_ARRAY2['DATA']);
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_FLOAT:

                                    $tmp_ttl = (float) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_DOUBLE:

                                    $tmp_ttl = (double) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_RESOURCE:

                                    //
                                    // THIS CASE WILL NEVER RUN.
                                    $tmp_ttl = $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_RESOURCE_CLOSED:

                                    //
                                    // THIS CASE WILL NEVER RUN.
                                    $tmp_ttl = $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_UNKNOWN_TYPE:

                                    $tmp_ttl = $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_NULL:

                                    $tmp_ttl = NULL;
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_ARRAY:
                                case CRNRSTN_OBJECT:

                                    //
                                    // THIS CASE WILL NEVER RUN.
                                    //
                                    // UNSERIALIZE.
                                    $tmp_ttl = unserialize($spool_ARRAY2['DATA']);
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                default:

                                    $tmp_err_msg = 'Unable to detect data type while replaying the CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER INPUT SPOOL.';

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    $this->oCRNRSTN->error_log($tmp_err_msg, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                                break;

                            }

                        break;
                        case 'env_key':

                            switch($spool_ARRAY2['TYPE']){
                                case CRNRSTN_STRING:

                                    $tmp_env_key = (string) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_INT:

                                    $tmp_env_key = (int) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_INTEGER:

                                    $tmp_env_key = (integer) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_BOOL:
                                case CRNRSTN_BOOLEAN:

                                    //
                                    // THIS CASE WILL NEVER RUN.
                                    $tmp_env_key = $this->oCRNRSTN->tidy_boolean($spool_ARRAY2['DATA']);
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_FLOAT:

                                    $tmp_env_key = (float) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_DOUBLE:

                                    $tmp_env_key = (double) $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_RESOURCE:

                                    //
                                    // THIS CASE WILL NEVER RUN.
                                    $tmp_env_key = $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_RESOURCE_CLOSED:

                                    //
                                    // THIS CASE WILL NEVER RUN.
                                    $tmp_env_key = $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_UNKNOWN_TYPE:

                                    $tmp_env_key = $spool_ARRAY2['DATA'];
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_NULL:

                                    $tmp_env_key = NULL;
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                case CRNRSTN_ARRAY:
                                case CRNRSTN_OBJECT:

                                    //
                                    // THIS CASE WILL NEVER RUN.
                                    //
                                    // UNSERIALIZE.
                                    $tmp_env_key = unserialize($spool_ARRAY2['DATA']);
                                    $tmp_length = $spool_ARRAY2['LENGTH'];

                                break;
                                default:

                                    $tmp_err_msg = 'Unable to detect data type while replaying the CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER INPUT SPOOL.';

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    $this->oCRNRSTN->error_log($tmp_err_msg, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                                break;

                            }

                        break;

                    }

                }

            }

        }

        //error_log(__LINE__ . ' crnrstn SPOOLING MEM USAGE [' . $this->oCRNRSTN->format_bytes(self::$resource_spool_ARRAY, 4) . '].' );
        //[Sat Nov 18 01:35:42.426005 2023] [:error] [pid 49655] [client 172.16.225.1:57046] 22123 crnrstn SPOOLING MEM USAGE [28.9561 KiB].

        //
        // CLEAR ALL SPOOL SUPPORT CACHE ARRAYS.
        array_splice(self::$resource_spool_ARRAY, 0);
        array_splice(self::$spool_access_ARRAY, 0);

        //error_log(__LINE__ . ' crnrstn SPOOLING MEM USAGE [' . $this->oCRNRSTN->format_bytes(self::$resource_spool_ARRAY, 4) . '].' );
        //[Sat Nov 18 01:35:42.426238 2023] [:error] [pid 49655] [client 172.16.225.1:57046] 22129 crnrstn SPOOLING MEM USAGE [6 bytes].

    }

    public function init_disk_write_authorization($disk_write_authorization){

        self::$disk_write_authorization = $disk_write_authorization;

    }

    public function grant_permissions_fwrite($filepath, $minimum_bytes_required){

        if(!(self::$disk_write_authorization !== false)){

            //
            // TODO :: NEED MORE ROBUST STATUS NOTIFICATION CHANNEL HERE.
            // ALL WRITE BLOCK ERRORS WILL REPORT AS DISK FULL FOR NOW.
            return false;

        }

        if($this->return_available_byte_capacity($filepath, $minimum_bytes_required)){

            return true;

        }

        return false;

    }

    public function get_disk_free_space($path = CRNRSTN_ROOT){

        return $this->return_disk_free_space($path);

    }

    public function get_disk_size($path = CRNRSTN_ROOT){

        return $this->return_hard_disk_size($path);

    }

    public function get_disk_performance_metric($profile_name){

        $profile_name = strtolower($profile_name);

        switch($profile_name){
            case 'maximum_disk_use_warning':

                $tmp_max_disk_storage_utilization_warning = $this->oCRNRSTN->get_resource('max_disk_storage_utilization_warning', 0, 'CRNRSTN::RESOURCE::DISK_STORAGE');

                if(isset($tmp_max_disk_storage_utilization_warning)){

                    if(strlen($tmp_max_disk_storage_utilization_warning) > 0){

                        return (int) $tmp_max_disk_storage_utilization_warning;

                    }

                }

                return $this->max_disk_storage_utilization_warning;

            break;
            case 'maximum_disk_use':

                $tmp_max_disk_storage_utilization = $this->oCRNRSTN->get_resource('max_disk_storage_utilization', 0, 'CRNRSTN::RESOURCE::DISK_STORAGE');

                if(isset($tmp_max_disk_storage_utilization)){

                    if(strlen($tmp_max_disk_storage_utilization) > 0){

                        return (int) $tmp_max_disk_storage_utilization;

                    }

                }

                return $this->max_disk_storage_utilization;

            break;
            case 'disk_free_space':

                return $this->return_disk_free_space();

            break;
            case 'hard_disk_size':

                return $this->return_hard_disk_size();

            break;

        }

        return '';

    }

    private function snapshot_ini_values($oCRNRSTN){

        foreach(self::$config_relevant_ini_values_ARRAY as $key => $ini_value_nom ){

            $this->log_current_ini_value($ini_value_nom, $oCRNRSTN);

        }

    }

    private function log_current_ini_value($ini_value_nom, $oCRNRSTN){

        $this->php_ini_val[$ini_value_nom][] = $oCRNRSTN->ini_get($ini_value_nom);

    }

    private function monitor_pid_performance($return_pid_info = false){

        try{

            if(!($pid_info_array = $this->getpidinfo($this->process_id, 'aux'))){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('An error was experienced while attempting to initialize thread performance monitoring for PID, ' . $this->process_id.'.');

            }else{

                self::$process_id_perf_stat_ARRAY[] = $pid_info_array;

            }

            if($return_pid_info){

                return $pid_info_array;

            }else{

                return NULL;

            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function return_available_byte_capacity($filepath, $required_bytes = 0){

        //
        // TOTAL AVAILABLE STORAGE SIZE (BYTES) AT DESTINATION.
        $this->hard_disk_bytes_capacity_total = $this->return_disk_free_space($filepath);
        $this->hard_disk_bytes_volume_size = $this->return_hard_disk_size($filepath);
        $this->hard_disk_bytes_capacity_total_pretty = $this->oCRNRSTN->format_bytes($this->hard_disk_bytes_capacity_total, 5);
        $required_bytes_pretty = $this->oCRNRSTN->format_bytes($required_bytes, 4);
//        error_log(__LINE__ . ' ' . __CLASS__ . ' ***** capacity [' . $this->hard_disk_bytes_capacity_total . ']');
//        error_log(__LINE__ . ' ' . __CLASS__ . ' ***** volume_size [' . $this->hard_disk_bytes_volume_size . ']');
//        error_log(__LINE__ . ' ' . __CLASS__ . ' ***** required [' . $required_bytes . ']');

        error_log(__LINE__ . ' ' . __CLASS__ . ' ***** required [' . $required_bytes_pretty . ']. volume_size [' . $this->oCRNRSTN->format_bytes($this->hard_disk_bytes_volume_size, 5) . ']. capacity [' . $this->hard_disk_bytes_capacity_total_pretty . ']. ');

        //
        // CALCULATE PERCENTAGE UTILIZATION OF REQUEST.
        $percentage_utilization_ask = 100 - ((($required_bytes + ($this->hard_disk_bytes_volume_size - $this->hard_disk_bytes_capacity_total)) / $this->hard_disk_bytes_volume_size) * 100);
        //$percentage_utilization_ask =  (($required_bytes + ($this->hard_disk_bytes_volume_size - $this->hard_disk_bytes_capacity_total)) / $this->hard_disk_bytes_volume_size) * 100;

        error_log(__LINE__ . ' ' . __CLASS__ . ' maths[' . ((($required_bytes + ($this->hard_disk_bytes_volume_size - $this->hard_disk_bytes_capacity_total)) / $this->hard_disk_bytes_volume_size) * 100) . ']');
        //error_log(__LINE__ . ' ' . __CLASS__ . ' percentage_utilization_ask [' . $percentage_utilization_ask . ']');

        if($percentage_utilization_ask < 0){

            $percentage_utilization_ask = $percentage_utilization_ask * (-1);

        }

        if($percentage_utilization_ask > 100){

            $percentage_utilization_ask = 100;

        }

        //
        // GET SYSTEM CONFIGURATION SETTINGS FOR REGULATION OF MEMORY
        // UTILIZATION PERFORMANCE LIMITATIONS.
        $tmp_max_disk_storage_utilization_warning = $this->oCRNRSTN->get_resource('max_disk_storage_utilization_warning', 0, 'CRNRSTN::RESOURCE::DISK_STORAGE');
        $tmp_max_disk_storage_utilization = $this->oCRNRSTN->get_resource('max_disk_storage_utilization', 0, 'CRNRSTN::RESOURCE::DISK_STORAGE');

        if(isset($tmp_max_disk_storage_utilization_warning)){

            if(strlen($tmp_max_disk_storage_utilization_warning) > 0){

                $this->max_disk_storage_utilization_warning = $tmp_max_disk_storage_utilization_warning;

            }

        }

        if(isset($tmp_max_disk_storage_utilization)){

            if(strlen($tmp_max_disk_storage_utilization) > 0){

                $this->max_disk_storage_utilization = $tmp_max_disk_storage_utilization;

            }

        }

        //
        // DISK FULL WARNING.
        if($percentage_utilization_ask > $this->max_disk_storage_utilization_warning){

//            error_log(__LINE__ . ' ' . __CLASS__ . ' $percentage_utilization_ask[' . $percentage_utilization_ask . ']');
//
//            die();
            $this->oCRNRSTN->error_log('WARNING: maximum permitted disk storage will be reached soon. ' . $this->oCRNRSTN->number_format_keep_precision($percentage_utilization_ask, 3) . '% of the disk volume is used. ' . $this->oCRNRSTN->number_format_keep_precision($this->max_disk_storage_utilization, 3) . '% is the configured maximum. For the record, ' . $this->oCRNRSTN->format_bytes($this->hard_disk_bytes_capacity_total) . ' are available at ' . $filepath . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
            $this->oCRNRSTN->print_r('WARNING: maximum permitted disk storage will be reached soon. ' . $this->oCRNRSTN->number_format_keep_precision($percentage_utilization_ask, 3) . '% of the disk volume is used. ' . $this->oCRNRSTN->number_format_keep_precision($this->max_disk_storage_utilization, 3) . '% is the configured maximum. For the record, ' . $this->oCRNRSTN->format_bytes($this->hard_disk_bytes_capacity_total) . ' are available at ' . $filepath . '.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

        }

        error_log(__LINE__ . ' ' . __CLASS__ . ' $percentage_utilization_ask[' . $percentage_utilization_ask . '] fail%[' . $this->max_disk_storage_utilization . ']. warn%['.$this->max_disk_storage_utilization_warning . '].');

        //
        // DISK FULL ERROR.
        if($percentage_utilization_ask > $this->max_disk_storage_utilization){

            error_log(__LINE__ . ' ' . __CLASS__ . ' $required_bytes_pretty[' . $required_bytes_pretty . ']');

            $this->oCRNRSTN->error_log('DISK FULL ERROR: Maximum storage utilization has been reached with an additional request which would result in ' . $this->oCRNRSTN->number_format_keep_precision($percentage_utilization_ask, 3) . '% usage of the disk volume. ' . $this->oCRNRSTN->number_format_keep_precision($this->max_disk_storage_utilization, 3) . '% is the currently configured maximum. For the record, ' . $this->oCRNRSTN->format_bytes($this->hard_disk_bytes_capacity_total) . ' are available at ' . $filepath . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
            $this->oCRNRSTN->print_r('DISK FULL ERROR: Maximum storage utilization has been reached with an additional request which would result in ' . $this->oCRNRSTN->number_format_keep_precision($percentage_utilization_ask, 3) . '% usage of the disk volume. ' . $this->oCRNRSTN->number_format_keep_precision($this->max_disk_storage_utilization, 3) . '% is the currently configured maximum. For the record, ' . $this->oCRNRSTN->format_bytes($this->hard_disk_bytes_capacity_total) . ' are available at ' . $filepath . '.', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

            return false;

        }

        //
        // RETURN PERCENTAGE DISK UTILIZATION...IF THE
        // EXPECTED $required_bytes BYTES WOULD BE BURNED TO DISK.
        return $percentage_utilization_ask;

    }

    private function _getServerLoadLinuxData(){

        if(is_readable("/proc/stat")){

            $stats = @file_get_contents("/proc/stat");

            if($stats !== false){

                // Remove double spaces to make it easier to extract values with explode()
                $stats = preg_replace("/[[:blank:]]+/", " ", $stats);

                // Separate lines
                $stats = str_replace(array("\r\n", "\n\r", "\r"), "\n", $stats);
                $stats = explode("\n", $stats);

                // Separate values and find line for main CPU load
                foreach($stats as $statLine){

                    $statLineData = explode(" ", trim($statLine));

                    // Found!
                    if((count($statLineData) >= 5) && ($statLineData[0] == "cpu")){

                        return array(
                            $statLineData[1],
                            $statLineData[2],
                            $statLineData[3],
                            $statLineData[4]
                        );

                    }

                }

            }

        }

        return null;

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.getmypid.php
    // AUTHOR :: kroczu at interia dot pl :: https://www.php.net/manual/en/function.getmypid.php#59889
    private function getpidinfo($pid, $ps_opt = 'aux'){

        $ps = shell_exec('ps ' . $ps_opt . 'p ' . $pid);
        $ps = explode('\n', $ps);

        if(count($ps) < 2){

            $this->oCRNRSTN->error_log('We attempted to acquire PID information via shell_exec(), but the PID ' . $pid . ' doesn\'t seem to exist.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
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

    //
    // SOURCE :: https://www.php.net/manual/en/function.sys-getloadavg.php
    // AUTHOR :: stanislav dot eckert at vizson dot de :: https://www.php.net/manual/en/function.sys-getloadavg.php#118673
    // Returns server load in percent (just number, without percent sign)
    private function getServerLoad(){

        $load = null;

        if(stristr(PHP_OS, "win")){

            $cmd = "wmic cpu get loadpercentage /all";
            @exec($cmd, $output);

            if($output){

                foreach($output as $line){

                    if($line && preg_match("/^[0-9]+\$/", $line)){

                        $load = $line;

                        break;

                    }

                }

            }

        }else{

            if(is_readable("/proc/stat")){

                // Collect 2 samples - each with 1 second period
                // See: https://de.wikipedia.org/wiki/Load#Der_Load_Average_auf_Unix-Systemen
                $statData1 = $this->_getServerLoadLinuxData();
                sleep(1);
                $statData2 = $this->_getServerLoadLinuxData();

                if((!is_null($statData1)) && (!is_null($statData2))){

                    // Get difference
                    $statData2[0] -= $statData1[0];
                    $statData2[1] -= $statData1[1];
                    $statData2[2] -= $statData1[2];
                    $statData2[3] -= $statData1[3];

                    // Sum up the 4 values for User, Nice, System and Idle and calculate
                    // the percentage of idle time (which is part of the 4 values!)
                    $cpuTime = $statData2[0] + $statData2[1] + $statData2[2] + $statData2[3];

                    // Invert percentage to get CPU time, not idle time
                    $load = 100 - ($statData2[3] * 100 / $cpuTime);
                }

            }

        }

        return $load;

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.memory-get-usage.php
    // AUTHOR :: stanislav dot eckert at vizson dot de :: https://www.php.net/manual/en/function.memory-get-usage.php#120665
    private function getServerMemoryUsage($getPercentage = true){

        $memoryTotal = null;
        $memoryFree = null;

        if($this->operating_system == 'WIN'){
            // Get total physical memory (this is in bytes)

            $cmd = "wmic ComputerSystem get TotalPhysicalMemory";
            @exec($cmd, $outputTotalPhysicalMemory);

            //
            // Get free physical memory (this is in kibibytes!)
            $cmd = "wmic OS get FreePhysicalMemory";
            @exec($cmd, $outputFreePhysicalMemory);

            if($outputTotalPhysicalMemory && $outputFreePhysicalMemory){

                // Find total value
                foreach($outputTotalPhysicalMemory as $line){

                    if($line && preg_match("/^[0-9]+\$/", $line)){

                        $memoryTotal = $line;
                        break;

                    }

                }

                // Find free value
                foreach($outputFreePhysicalMemory as $line){

                    if($line && preg_match("/^[0-9]+\$/", $line)){

                        $memoryFree = $line;
                        $memoryFree *= 1024;  // convert from kibibytes to bytes
                        break;

                    }

                }

            }

        }else{

            if(is_readable("/proc/meminfo")){

                $stats = @file_get_contents("/proc/meminfo");

                if($stats !== false){
                    // Separate lines

                    $stats = str_replace(array("\r\n", "\n\r", "\r"), "\n", $stats);
                    $stats = explode("\n", $stats);

                    // Separate values and find correct lines for total and free mem
                    foreach($stats as $statLine){

                        $statLineData = explode(":", trim($statLine));

                        //
                        // Extract size (TODO: It seems that (at least) the two values for
                        // total and free memory have the unit "kB" always. Is this correct?

                        //
                        // Total memory
                        if(count($statLineData) == 2 && trim($statLineData[0]) == "MemTotal"){

                            $memoryTotal = trim($statLineData[1]);
                            $memoryTotal = explode(" ", $memoryTotal);
                            $memoryTotal = $memoryTotal[0];
                            $memoryTotal *= 1024;  // convert from kibibytes to bytes

                        }

                        //
                        // Free memory
                        if(count($statLineData) == 2 && trim($statLineData[0]) == "MemFree"){

                            $memoryFree = trim($statLineData[1]);
                            $memoryFree = explode(" ", $memoryFree);
                            $memoryFree = $memoryFree[0];
                            $memoryFree *= 1024;  // convert from kibibytes to bytes

                        }

                    }

                }

            }

        }

        if(is_null($memoryTotal) || is_null($memoryFree)){

            return null;

        }else{

            if($getPercentage){

                return (100 - ($memoryFree * 100 / $memoryTotal));

            }else{

                return array(
                    "total" => $memoryTotal,
                    "free" => $memoryFree
                );

            }

        }

    }

    private function return_hard_disk_size($path = CRNRSTN_ROOT, $env_key = CRNRSTN_RESOURCE_ALL){

        /*
        Caution: On Windows, dirname() assumes the currently set codepage, so for
        it to see the correct directory name with multibyte character
        paths, the matching codepage must be set. If path contains
        characters which are invalid for the current codepage, the
        behavior of dirname() is undefined.

        On other systems, dirname() assumes path to be encoded in an ASCII
        compatible encoding. Otherwise the behavior of the the function
        is undefined.

        */

        $path = dirname($path);

        $this->disk_size_bytes_ARRAY[$env_key][$path] = disk_total_space($path);

        //$this->oCRNRSTN->print_r('WE GOOD. CRNRSTN :: DISK TOTAL SIZE = ' . $this->oCRNRSTN->format_bytes($this->disk_size_bytes_ARRAY[$env_key][$path]) . '.', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

        return $this->disk_size_bytes_ARRAY[$env_key][$path];

    }

    private function return_disk_free_space($path = CRNRSTN_ROOT, $env_key = CRNRSTN_RESOURCE_ALL){

        /*
        Caution: On Windows, dirname() assumes the currently set codepage, so for
        it to see the correct directory name with multibyte character
        paths, the matching codepage must be set. If path contains
        characters which are invalid for the current codepage, the
        behavior of dirname() is undefined.

        On other systems, dirname() assumes path to be encoded in an ASCII
        compatible encoding. Otherwise the behavior of the the function
        is undefined.
        */

        $path = dirname($path);

        $this->disk_capacity_bytes_ARRAY[$env_key][$path] = disk_free_space($path);

        //$this->oCRNRSTN->print_r('WE GOOD. CRNRSTN :: DISK FREE SPACE = ' . $this->oCRNRSTN->format_bytes($this->disk_capacity_bytes_ARRAY[$env_key][$path]) . '.', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

        return $this->disk_capacity_bytes_ARRAY[$env_key][$path];

    }

    //
    // SOURCE :: https://gist.github.com/jefferyrdavis/5992282
    // COMMENT :: https://gist.github.com/jefferyrdavis/5992282?permalink_comment_id=2643413#gistcomment-2643413
    // AUTHOR :: FranciscoG :: https://gist.github.com/FranciscoG
    public function is_valid_zipcode($zipcode){

        //
        // SUPPORT FOR CRNRSTN :: WETHRBUG.
        //
        // Tuesday, October 3, 2023 @ 2019 hrs.
        return (preg_match('/^[0-9]{5}(-[0-9]{4})?$/', $zipcode)) ? true : false;

    }

    public function config_ugc_input_clean_data($data_profile, $data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key){

        /*
        SOURCE :: https://www.php.net/manual/en/function.ctype-digit.php
        AUTHOR :: info at directwebsolutions dot nl :: https://www.php.net/manual/en/function.ctype-digit.php#108712

        All basic PHP functions which I tried returned unexpected results. I would just like to check whether some
        variable only contains numbers. For example: when I spread my script to the public I cannot require users to
        only use numbers as string or as integer. For those situation I wrote my own function which handles all
        inconveniences of other functions and which is not depending on regular expressions. Some people strongly
        believe that regular functions slow down your script.

        The reason to write this function:
            1. is_numeric() accepts values like: +0123.45e6 (but you would expect it would not)
            2. is_int() does not accept HTML form fields (like: 123) because they are treated as strings (like: "123").
            3. ctype_digit() excepts all numbers to be strings (like: "123") and does not validate real integers (like: 123).
            4. Probably some functions would parse a boolean (like: true or false) as 0 or 1 and validate it in that manner.

        My function only accepts numbers regardless whether they are in string or in integer format.
        <?php

        //* Check input for existing only of digits (numbers)
        //* @author Tim Boormans <info@directwebsolutions.nl>
        //* @param $digit
        //* @return bool

        function is_digit($digit){

            if(is_int($digit)){

                return true;

            }elseif(is_string($digit)){

                return ctype_digit($digit);

            }else{
                // booleans, floats and others

                return false;

            }

        }

        TYPE HINTS ::
        Class/interface name	The value must be an instanceof the given class or interface.
        self	                The value must be an instanceof the same class as the one in which the type declaration is used. Can only be used in classes.
        parent	                The value must be an instanceof the parent of the class in which the type declaration is used. Can only be used in classes.
        array	                The value must be an array.
        callable	            The value must be a valid callable. Cannot be used as a class property type declaration.
        bool	                The value must be a boolean value.
        float	                The value must be a floating point number.
        int	                    The value must be an integer.
        string	                The value must be a string.
        iterable	            The value must be either an array or an instanceof Traversable.	    PHP 7.1.0
        object	                The value must be an object.	                                    PHP 7.2.0
        mixed	                The value can be any value.	                                        PHP 8.0.0

        */

        $tmp_exception_bypass = false;

        if(!isset($data_authorization_profile)){

            $data_authorization_profile = CRNRSTN_AUTHORIZE_RUNTIME;

        }

        if(!isset($env_key)){

            $env_key = CRNRSTN_RESOURCE_ALL;

        }

        if(!isset($ttl)){

            $ttl = $this->oCRNRSTN->cache_ttl_default;

        }

        //
        // CRNRSTN :: INITIALIZATION  RESOURCE SPOOL MANAGEMENT.
        if(($spool_resource !== false) || (self::$spool_resource_override !== false) || (self::$ddo_config_ugc_input_audit !== false)){

            //
            // CRNRSTN :: MULTI-CHANNEL DECOUPLED
            // DATA OBJECT (MC-DDO) INPUT SPOOLING
            // SERVICES LAYER.
            //
            // BEFORE THE DDO IS READY (E.G. SEE
            // CRNRSTN :: MC-DDO USE IN _CONSTRUCT()),
            // IT WILL BE NECESSARY TO SPOOL ANY
            // COLLECTED MC-DDO CONFIGURATION RESOURCES.
            //
            // THIS WILL ALSO FACILITATE AUDITING OF
            // CRNRSTN :: RUNTIME INPUT PERFORMANCE,
            // BEHAVIOR, AND RESOURCE REQUIREMENTS.
            //
            // CLEARING THE SYSTEM SPOOL:
            // -----
            // THE CRNRSTN :: SYSTEM SETTINGS CALL OF config_load_spool_system_init_resources();
            // [SEE, _crnrstn/_config/_config.defaults/_crnrstn.system_settings.inc.php]
            // WILL (1) PROCESS ALL SPOOLED UGC INPUT
            // RESOURCES INTO THE CRNRSTN :: MC-DDO
            // SERVICES LAYER AND (2) DEACTIVATE THE
            // INITIALIZED = ON STATE OF $spool_resource_override,
            // THE MASTER CONTROL TOGGLE OVERRIDE FOR THE
            // CRNRSTN :: RESOURCE INITIALIZATION SPOOL.
            //
            // Tuesday, November 7, 2023 @ 2040 hrs.
            $this->spool_ddo_input_data($data_profile, $data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $env_key);

            return true;

        }

        $tmp_force_data_err = false;
        $tmp_force_data_err_msg = $tmp_err_str = '';
        $tmp_ARRAY = array();

        //
        // MAYBE LEAVE THIS REDUNDANCY? SUPPORT
        // STRING MANIPULATIONS.
        //
        // Wednesday, October 11, 2023 @ 2348 hrs.
        $tmp_data = $data;

        switch($data_profile){
            case 'os_bit_size':

                $tmp_os_bit_size = $data;

                //
                // RECEIVE AND/OR FORCE A PURE INTEGER.
                if(!is_int($data)){

                    $tmp_int = (int) $data;
                    $tmp_os_bit_size = $tmp_int * 1;

                }

                //
                // GUARANTEE 32 OR 64.
                switch($tmp_os_bit_size){
                    case 32:

                        //
                        // CRNRSTN :: ONLY WORKS IN INTEGERS.
                        //
                        // "LETTERS...?
                        // ...WHAT ARE LETTERS?"
                        //
                        // - CRNRSTN :: LIGHTSABER. Friday, September 29, 2023 @ 1133 hrs.
                        $tmp_int = $tmp_os_bit_size;

                    break;
                    default:
                        //case 64:

                        $tmp_int = 64;

                    break;

                }

                //
                // THIS FINAL CHECK SHOULD BE FINE.
                if(!($tmp_int > 30)){

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    // # # C # R # N # R # S # T # N # : : # # # #
                    // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [OS BIT SIZE]
                    $this->oCRNRSTN->err_message_queue_push(NULL, 'CRNRSTN :: could not apply the ' . $data_key .
                        ', (' . $this->oCRNRSTN->gettype($tmp_int) . ') ' . strval($tmp_int) . '. ' . strval($data) .
                        ', was the value that was provided as method input to this environment. ' .
                        $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT'));

                    return NULL;

                }

                //
                // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: UGC DATA INPUT [OS BIT SIZE]
                $this->oCRNRSTN->input_data_value($tmp_int, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

            break;

            case 'bit':
            //case '__construct_bit':   //        MOVED TO case '__construct_mixed':
            case 'config_set_ui_theme_style_bit':
            case 'config_init_sys_resp_return_profile_bit':

                //
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: UGC DATA INPUT STANDARDIZATION [BIT]
                if(is_string($data)){

                    //
                    // LETTERS?
                    if(!is_numeric($data)){

                        //
                        // BECAUSE $tmp_data IS INITIALIZED
                        // WITH $data ABOVE, WE CAN LAZY UPDATE.
                        $tmp_data = $this->oCRNRSTN->return_int_const_profile($data, CRNRSTN_INTEGER);

                    }

                }

                //
                // THIS SHOULD BE A NUMBER.
                if(is_numeric($tmp_data)){

                    $tmp_int = (int) $data;

                }else{

                    //
                    // IT WOULD CERTAINLY APPEAR THAT THIS
                    // IS NOT A VALID NUMBER FOR THE
                    // REQUESTED OPERATION.
                    //
                    // WE SHALL RUN AN INVALID CALCULATION.
                    //
                    // THIS MAY BE THE ONLY WAY THAT AN
                    // APPLICATION WHICH ABSOLUTELY LOVES
                    // NUMBERS (AS MUCH AS CRNRSTN :: HAS
                    // BEEN LOVING THE NUMBERS LATELY, AND
                    // EVEN IN THE MIDST OF "THESE ECONOMIC
                    // TIMES" AT THAT)...COULD EVEN BE ABLE
                    // TO ACQUIRE AN AUTHENTIC NaN (PLEASE
                    // READ AS "BAD DATA", OR EVEN BETTER,
                    // ...A PROPER SHIT VALUE) VALUE THAT
                    // CAN BE RELIABLY RETURNED WITH
                    // CONFIDENCE BY CRNRSTN ::
                    //
                    // CRNRSTN :: <3's
                    //          ...CRNRSTN_INTEGER's 4LIFE!
                    //
                    // SEE, https://www.php.net/manual/en/function.is-nan.php
                    $tmp_int = sqrt(-1);

                }

                //
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: UGC DATA VALIDATION [BIT]
                switch($data_profile){
                    case 'config_init_sys_resp_return_profile_bit':
                        //$system_asset_mode

                        /**
                         * $oCRNRSTN->config_init_sys_resp_return_profile($env_key = CRNRSTN_RESOURCE_ALL, $system_asset_mode = CRNRSTN_ASSET_MODE_BASE64)
                         * DESCRIPTION :: Configure the HTML email image handling profile for CRNRSTN :: system notifications.
                         * OPTIONS ::
                         * CRNRSTN_ASSET_MODE_PNG:      ALL CRNRSTN :: system images load the PNG versions of the file.
                         * CRNRSTN_ASSET_MODE_JPEG:     ALL CRNRSTN :: system images load the JPG version of the file.
                         * CRNRSTN_ASSET_MODE_BASE64:   ALL CRNRSTN :: system images and all CRNRSTN :: integrated 3rd
                         *                              party JS Frameworks and CSS Frameworks load as embedded BASE64,
                         *                              SCRIPT, and STYLE tags...respectively...within the HTML. This
                         *                              makes mobile and tablet FAAAASST!
                         *
                         * NOTE: Please note that any one-off system image method call within the application can
                         * override these global configuration asset mode settings for BASE64, PNG, JPEG, or GIF
                         * resource return executions within the application.
                         *
                         */

                        if(!($this->oCRNRSTN->system_isset_output_profile_constants($tmp_int) == true)){

                            $tmp_int = $this->oCRNRSTN->return_system_output_profile_constant();

                            $tmp_force_data_err = true;
                            $tmp_force_data_err_msg = 'The requested CRNRSTN :: system response return profile, ' .
                                strval($data) . ', could not be found. The system output profile has manually been set to ' .
                                $this->oCRNRSTN->return_constant_profile_ARRAY($tmp_int, CRNRSTN_STRING) . '. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        }

                    break;
                    case 'config_set_ui_theme_style_bit':
                        // VALIDATION WILL HAPPEN BELOW.
                    break;

                }

                //
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: UGC DATA INPUT [BIT]
                switch($data_profile){
                    case 'config_set_ui_theme_style_bit':
                        // Sunday, October 8, 2023 @ 1304 hrs.

                        //
                        // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                        // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                        //
                        // Friday, October 13, 2023 @ 2310 hrs.
                        /*
                        Infinite* bits and bit handling in general.

                        *Not infinite, sorry.

                        Perceivably, the only limit to the bitmask class in storing bits would be
                        the maximum limit of the index number, on 32 bit integer systems 2^31 - 1,
                        so 2^31 * 31 - 1 = 66571993087 bits, assuming floats are 64 bit or something.
                        I'm sure that's enough enough bits for anything...I hope :D.

                        icy at digitalitcc dot com
                        https://www.php.net/manual/en/language.operators.bitwise.php
                        https://www.php.net/manual/en/language.operators.bitwise.php#50299

                        */

                        $tmp_valid_theme = false;
                        if(is_nan($tmp_int)){

                            $tmp_force_data_err = true;

                            //
                            // DEFAULT THEME DATA ON INPUT DATA ERROR.
                            $tmp_int = $this->oCRNRSTN->get_resource('default_interact_ui_theme', 0, 'CRNRSTN::RESOURCE::DEFAULT_THEME');

                            //if($this->oCRNRSTN->system_isset_theme_style_profile_constant($tmp_int) == true){
                            if($this->oCRNRSTN->isset_crnrstn('system_isset_theme_style_profile_constant', $tmp_int) == true){

                                //
                                // GRACEFUL DEGRADATION TO SETTINGS DEFAULT.
                                $tmp_err_str = 'CRNRSTN :: does not recognize the provided INTERACT UI client theme, ' .
                                    strval($data) . ' [' . strval($tmp_int) .
                                    ']. A theme has been taken from configuration settings; it will be manually set to, ' .
                                    $this->oCRNRSTN->return_constant_profile_ARRAY($tmp_int, CRNRSTN_STRING) . '. ' .
                                    $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                //
                                // LOAD CRNRSTN :: INTERACT UI THEME RESOURCE
                                // CONFIGURATION DATA FROM FILE.
                                $this->oCRNRSTN->apply_theme_style_profile($tmp_int);

                                //
                                // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                                // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                                // # # C # R # N # R # S # T # N # : : # # # #
                                // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                                $this->oCRNRSTN->initialize_bit($tmp_int, true);

                            }else{

                                //
                                // CRNRSTN :: GRACEFUL DEGRADATION - BLIND
                                // THEME SELECTION FROM SYSTEM MEMORY.
                                //
                                // Korn - Blind (Official HD Video)
                                // https://www.youtube.com/watch?v=SGK00Q7xx-s
                                //
                                // Saturday, December 2, 2023 @ 0430 hrs.
                                //$tmp_apply_theme_style_profile_ARRAY = $this->oCRNRSTN->return_theme_style_profile_ARRAY();
                                $tmp_apply_theme_style_profile_ARRAY = $this->oCRNRSTN->get_crnrstn('system_theme_style_constants_ARRAY');
                                foreach($tmp_apply_theme_style_profile_ARRAY as $int_const_index => $int_const_int){

                                    //
                                    // LOAD CRNRSTN :: INTERACT UI THEME RESOURCE
                                    // CONFIGURATION DATA FROM FILE.
                                    $this->oCRNRSTN->apply_theme_style_profile($int_const_index, NULL);

                                    //
                                    // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                                    // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                                    $this->oCRNRSTN->initialize_bit($int_const_index, true);

                                    break 1;

                                }

                                $tmp_err_str = 'CRNRSTN :: does not recognize the provided INTERACT UI client theme, ' .
                                    strval($data) . ' [' . strval($tmp_int) . '].  The theme will be manually set to, ' .
                                    $this->oCRNRSTN->return_constant_profile_ARRAY($int_const_index, CRNRSTN_STRING) . '. ' .
                                    $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                //
                                // HOOOSTON...VE HAF PROBLEM!
                                // # # C # R # N # R # S # T # N # : : # # # #
                                // CRNRSTN :: UGC DATA INPUT EXCEPTION [BIT]
                                $this->oCRNRSTN->err_message_queue_push(NULL, $tmp_err_str);

                                return NULL;

                            }

                        }else{

                            //
                            // WE HAVE A VALID NUMBER.
                            //if($this->oCRNRSTN->system_isset_theme_style_profile_constant($tmp_int) == true){
                            if($this->oCRNRSTN->isset_crnrstn('system_isset_theme_style_profile_constant', $tmp_int) == true){

                                //
                                // LOAD CRNRSTN :: INTERACT UI THEME RESOURCE
                                // CONFIGURATION DATA FROM FILE.
                                $this->oCRNRSTN->apply_theme_style_profile($tmp_int);

                                //
                                // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                                // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                                // # # C # R # N # R # S # T # N # : : # # # #
                                // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                                $this->oCRNRSTN->initialize_bit($tmp_int, true);

                            }else{

                                //
                                // DEFAULT THEME DATA ON INPUT DATA ERROR.
                                $tmp_default_interact_ui_theme = $this->oCRNRSTN->get_resource('default_interact_ui_theme', 0, 'CRNRSTN::RESOURCE::DEFAULT_THEME');
                                //if($this->oCRNRSTN->system_isset_theme_style_profile_constant($tmp_default_interact_ui_theme) == true){
                                if($this->oCRNRSTN->isset_crnrstn('system_isset_theme_style_profile_constant', $tmp_int) == true){

                                    //
                                    // GRACEFUL DEGRADATION TO SETTINGS DEFAULT.
                                    $tmp_err_str = 'CRNRSTN :: does not recognize the provided INTERACT UI client theme, ' .
                                        strval($data) . ' [' . strval($tmp_int) . ']. A theme has been taken from configuration settings; it will be manually set to, ' .
                                        $this->oCRNRSTN->return_constant_profile_ARRAY($tmp_default_interact_ui_theme, CRNRSTN_STRING) . '. ' .
                                        $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                    //
                                    // LOAD THE CRNRSTN :: INTERACT UI THEME RESOURCE
                                    // CONFIGURATION DATA FROM FILE.
                                    $this->oCRNRSTN->apply_theme_style_profile($tmp_default_interact_ui_theme);

                                    //
                                    // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                                    // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                                    $this->oCRNRSTN->initialize_bit($tmp_default_interact_ui_theme, true);

                                }else{

                                    //
                                    // CRNRSTN :: GRACEFUL DEGRADATION - BLIND
                                    // THEME SELECTION FROM SYSTEM MEMORY.
                                    //
                                    // Korn - Blind (Official HD Video)
                                    // https://www.youtube.com/watch?v=SGK00Q7xx-s
                                    //
                                    // Saturday, December 2, 2023 @ 0428 hrs.
                                    //$tmp_apply_theme_style_profile_ARRAY = $this->oCRNRSTN->return_theme_style_profile_ARRAY();
                                    $tmp_apply_theme_style_profile_ARRAY = $this->oCRNRSTN->get_crnrstn('system_theme_style_constants_ARRAY');
                                    foreach($tmp_apply_theme_style_profile_ARRAY as $int_const_index => $int_const_int){

                                        //
                                        // LOAD CRNRSTN :: INTERACT UI THEME RESOURCE
                                        // CONFIGURATION DATA FROM FILE.
                                        $this->oCRNRSTN->apply_theme_style_profile($int_const_index);

                                        //
                                        // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                                        // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                                        // # # C # R # N # R # S # T # N # : : # # # #
                                        // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                                        $this->oCRNRSTN->initialize_bit($int_const_index, true);

                                        break 1;

                                    }

                                    $tmp_err_str = 'CRNRSTN :: does not recognize the provided INTERACT UI client theme, ' .
                                        strval($data) . ' [' . strval($tmp_int) . '].  The theme has been manually set to, ' .
                                        $this->oCRNRSTN->return_constant_profile_ARRAY($int_const_index, CRNRSTN_STRING) . '. ' .
                                        $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT EXCEPTION [BIT]
                                    $this->oCRNRSTN->err_message_queue_push(NULL, $tmp_err_str);

                                    return NULL;

                                }

                            }

                        }

                    break;
                    case '__construct_bit':
                        // Sunday, October 15, 2023 @ 0747 hrs.

                        //
                        // SET CRNRSTN :: LOG SILO PROFILE.
                        //
                        // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                        // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                        $this->oCRNRSTN->set_crnrstn('log_silo_profile', $tmp_int);

                    break;
                    default:

                        //
                        // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                        // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                        $this->oCRNRSTN->initialize_bit($tmp_int, true);

                    break;

                }

                //
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [BIT]
                if(is_nan($tmp_int) || ($tmp_force_data_err == true)){

                    switch($data_profile){
                        case 'config_init_sys_resp_return_profile_bit':
                            //$system_asset_mode

                            $tmp_err_str = $tmp_force_data_err_msg;

                        break;
                        case 'config_set_ui_theme_style_bit':

                            $tmp_err_str = 'CRNRSTN :: could not flip the bit, ' . $data_key . '[(' .
                                $this->oCRNRSTN->gettype($tmp_int) . ') ' . strval($tmp_int) .
                                '], which supports selection of the default CRNRSTN :: INTERACT UI Theme for this environment. ' .
                                strval($data) . ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT') . ' ' . $tmp_force_data_err_msg;

                        break;
                        default:
                            //case 'bit':

                            $tmp_err_str = 'CRNRSTN :: could not flip the bit, ' . $data_key . '[(' .
                                $this->oCRNRSTN->gettype($tmp_int) . ') ' .
                                strval($tmp_int) . '], which supports this environment. ' . strval($data) .
                                ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;

                    }

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    // # # C # R # N # R # S # T # N # : : # # # #
                    // CRNRSTN :: UGC DATA INPUT EXCEPTION [BIT]
                    $this->oCRNRSTN->err_message_queue_push(NULL, $tmp_err_str);

                    return NULL;

                }

            break;

            case '__construct_datetime':

                //
                // LET US PUT A "LASER LINE" DOWN ON THE
                // STRING DATA TYPE REQUIREMENT AS WE
                // PUT A "LASER LINE" DOWN ON THE
                // [DATETIME] DATA TYPE REQUIREMENT.
                $tmp_datetime = strval($data);

                //
                // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: UGC DATA INPUT [DATETIME]
                $this->oCRNRSTN->input_data_value($tmp_datetime, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

            break;

            case 'string':
            case '__construct_string':
            case 'is_mobile_string':
            case 'is_tablet_string':
            case 'is_desktop_string':
            case 'config_init_http_string':
            case 'config_init_asset_map_favicon_string':
            case 'config_init_asset_map_css_string':
            case 'config_init_asset_map_js_string':
            case 'config_init_asset_map_system_img_string':
            case 'config_init_asset_map_social_img_string':
            case 'config_init_asset_map_meta_img_string':
            case 'initialize_apache_profile_string':
            case 'initialize_linux_profile_string':
            case 'initialize_openssl_profile_string':
            case 'initialize_php_profile_string':
            case 'version_soap_string':
            case 'soap_defencoding_string':
            case 'return_crnrstn_mysqli_string':

                //
                // TODO :: CONSIDER VALIDATION FOR php_profile, openssl_profile, linux_profile, apache_profile, etc...
                $tmp_empty_string_auth_ARRAY = array(
                    'config_init_asset_map_favicon_string'      => 1, 'config_init_asset_map_css_string'        => 1,
                    'config_init_asset_map_js_string'           => 1, 'config_init_asset_map_system_img_string' => 1,
                    'config_init_asset_map_social_img_string'   => 1, 'config_init_asset_map_meta_img_string'   => 1,
                    'initialize_apache_profile_string'          => 1, 'initialize_linux_profile_string'         => 1,
                    'initialize_openssl_profile_string'         => 1, 'initialize_php_profile_string'           => 1,
                    'version_soap_string'                       => 1, 'soap_defencoding_string'                 => 1,
                    'return_crnrstn_mysqli_string'              => 1);

                //
                // LET US PUT A "LASER LINE" DOWN ON THE
                // STRING DATA TYPE REQUIREMENT.
                //
                // Thursday, November 30, 2023 @ 0300 hrs.
                $tmp_str = strval($data);

                $tmp_str_len = strlen($tmp_str);
                if(($tmp_str_len < 1) && !isset($tmp_empty_string_auth_ARRAY[$data_profile])){

                    //
                    // # # C # R # N # R # S # T # N # : : # # # #
                    // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [STRING]
                    switch($data_profile){
                        case 'is_mobile_string':
                        case 'is_tablet_string':
                        case 'is_desktop_string':

                            $tmp_err_str = 'CRNRSTN :: could not identify the device type name for the current client connection from, ' .
                                $data_key . ', (' . $this->oCRNRSTN->gettype($tmp_str) . ') ' . strval($tmp_str) . '. ' . strval($data) .
                                ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        case 'config_init_asset_map_favicon_string':
                        case 'config_init_asset_map_css_string':
                        case 'config_init_asset_map_js_string':
                        case 'config_init_asset_map_system_img_string':
                        case 'config_init_asset_map_social_img_string':
                        case 'config_init_asset_map_meta_img_string':

                            $tmp_pattern_ARRAY = array('config_init_asset_map_', '_string', '_');
                            $tmp_replacements_ARRAY = array('', '', ' ');

                            //
                            // THIS IS SOME CRNRSTN :: SCREEN SCRAPING KIT THAT USES
                            // BASIC STRING PARSING TO GET A HANDLE ON A STRING
                            // PREFIX FOR BUSINESS PURPOSES.
                            //
                            // WE ARE NOT WORKING WITH NUMBERS HERE, BOYS.
                            //
                            // Thursday, November 30, 2023 @ 0311 hrs.
                            //
                            // 311 - Come Original
                            // https://www.youtube.com/watch?v=KWo-02Hsab4
                            $tmp_asset_type = $this->oCRNRSTN->extract_key_from_string($data_profile, '', false, $tmp_pattern_ARRAY, $tmp_replacements_ARRAY);

                            $tmp_err_str = 'CRNRSTN :: could not receive ' . $data_key .
                                ' input meta supporting configuration of the CRNRSTN :: RRS MAP ' .
                                strtoupper($tmp_asset_type) . ' asset mapping architecture. ' . strval($data) .
                                ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        case 'config_init_http_string':

                            $tmp_err_str = 'CRNRSTN :: could not add the environmental configuration ' . $data_key . ', (' .
                                $this->oCRNRSTN->gettype($tmp_str) . ') ' . strval($tmp_str) . '. ' . strval($data) .
                                ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        case 'return_crnrstn_mysqli_string':

                            $tmp_err_str = 'CRNRSTN :: could not set the MySQLi database ' . $data_key . ', (' .
                                $this->oCRNRSTN->gettype($tmp_str) . ') ' .
                                strval($tmp_str) . '. ' . strval($data) .
                                ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        case 'version_soap_string':
                        case 'soap_defencoding_string':

                            $tmp_err_str = 'CRNRSTN :: could not set the SOAP ' . $data_key . ', (' .
                                $this->oCRNRSTN->gettype($tmp_str) . ') ' .
                                strval($tmp_str) . '. ' . strval($data) .
                                ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        case '__construct_string':
                            //version_crnrstn

                            $tmp_err_str = 'CRNRSTN :: could not set the configuration ' . $data_key . ', (' .
                                $this->oCRNRSTN->gettype($tmp_str) . ') ' .
                                strval($tmp_str) . '. ' . strval($data) .
                                ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        default:
                            //case 'string':

                            $tmp_err_str = 'CRNRSTN :: could not apply the ' . $data_key . ', (' .
                                $this->oCRNRSTN->gettype($tmp_str) . ') ' .
                                strval($tmp_str) . '. ' . strval($data) .
                                ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;

                    }

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    // # # C # R # N # R # S # T # N # : : # # # #
                    // CRNRSTN :: UGC DATA INPUT EXCEPTION [STRING]
                    $this->oCRNRSTN->err_message_queue_push(NULL, $tmp_err_str);

                    return NULL;

                }

                //
                // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: UGC DATA INPUT [STRING]
                $this->oCRNRSTN->input_data_value($tmp_str, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

            break;

            case 'int':
            case 'integer':
            case 'electrum_integer':
            case 'wethrbug_integer':
            case '__construct_integer':
            case 'is_mobile_integer':
            case 'is_tablet_integer':
            case 'is_desktop_integer':
            //case 'config_add_environment_integer':            // MOVED TO case 'config_add_environment_integer_mode':
            case 'config_data_authorization_profile_integer':
            case 'config_init_channel_integer':
            case 'config_init_sys_resp_return_profile_integer':
            case 'system_output_head_html_integer':
            case 'system_output_footer_html_integer':

                //
                // THIS SHOULD BE A NUMBER.
                if(is_numeric($data)){

                    $tmp_int = (int) $data;

                }else{

                    //
                    // IT WOULD CERTAINLY APPEAR THAT THIS
                    // IS NOT A VALID NUMBER FOR THE
                    // REQUESTED OPERATION.
                    //
                    // WE SHALL RUN AN INVALID CALCULATION.
                    //
                    // THIS MAY BE THE ONLY WAY THAT AN
                    // APPLICATION WHICH ABSOLUTELY LOVES
                    // NUMBERS (AS MUCH AS CRNRSTN :: HAS
                    // BEEN LOVING THE NUMBERS LATELY, AND
                    // EVEN IN THE MIDST OF "THESE ECONOMIC
                    // TIMES" AT THAT)...COULD EVEN BE ABLE
                    // TO ACQUIRE AN AUTHENTIC NaN (PLEASE
                    // READ AS "BAD DATA", OR EVEN BETTER,
                    // ...A PROPER SHIT VALUE) VALUE THAT
                    // CAN BE RELIABLY RETURNED WITH
                    // CONFIDENCE BY CRNRSTN ::
                    //
                    // CRNRSTN :: <3's
                    //          ...CRNRSTN_INTEGER's 4LIFE!
                    //
                    // SEE, https://www.php.net/manual/en/function.is-nan.php
                    $tmp_int = sqrt(-1);

                }

                //
                // -1 = OPERATING SYSTEM RESTRICTED.
                // TODO :: RE-IMPLEMENT "-1 = OPERATING SYSTEM RESTRICTED" VALIDATION. Friday October 13, 2023 @ 2251 hrs.
                //if((!($tmp_int == -1) && ($tmp_int < 0)) || is_nan($tmp_int)){
                if(is_nan($tmp_int)){

                    //
                    // # # C # R # N # R # S # T # N # : : # # # #
                    // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [INTEGER]
                    switch($data_profile){
                        case 'system_output_head_html_integer':
                        case 'system_output_footer_html_integer':

                            switch($data_key){
                                case 'is_mobile_integer':
                                case 'is_tablet_integer':
                                case 'is_desktop_integer':

                                    $tmp_err_str = 'CRNRSTN :: could not identify the device type integer for the current client connection, (' .
                                        $this->oCRNRSTN->gettype($tmp_int) . ') ' . strval($tmp_int) . '. ' . strval($data) .
                                        ', was the value provided. ' . $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                break;
                                case 'crnrstn_head_resource_html_output_spool':

                                    $tmp_err_str = 'CRNRSTN :: could not identify the resource to spool for HTML <HEAD> output with the input, (' .
                                        $this->oCRNRSTN->gettype($tmp_int) . ') ' . strval($tmp_int) . '. ' . strval($data) .
                                        ', was the value provided. ' . $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                break;
                                case 'crnrstn_head_resource_html_output_build_acceleration_spool':

                                    $tmp_err_str = 'CRNRSTN :: BUILD ACCELERATION could not identify the resource to spool for HTML output with the input, (' .
                                        $this->oCRNRSTN->gettype($tmp_int) . ') ' . strval($tmp_int) . '. ' . strval($data) .
                                        ', was the value provided. ' . $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                break;
                                case 'crnrstn_footer_resource_html_output_spool':

                                    $tmp_err_str = 'CRNRSTN :: could not identify the resource to spool for HTML footer output with the input, (' .
                                        $this->oCRNRSTN->gettype($tmp_int) . ') ' . strval($tmp_int) . '. ' . strval($data) .
                                        ', was the value provided. ' . $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                break;

                            }

                        break;
                        case 'config_data_authorization_profile_integer':

                            $tmp_err_str = 'CRNRSTN :: could not set the default data authorization profile using the data,' .
                                strval($tmp_int) . '. The system will revert to the default, CRNRSTN_AUTHORIZE_RUNTIME[' .
                                strval(CRNRSTN_AUTHORIZE_RUNTIME) . ']. ' . strval($data) .
                                ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                            //
                            // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // CRNRSTN :: UGC DATA INPUT [INTEGER]
                            $this->oCRNRSTN->input_data_value(CRNRSTN_AUTHORIZE_RUNTIME, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                        break;
                        case 'config_init_channel_integer':

                            //
                            // THIS IS SOME CRNRSTN :: SCREEN SCRAPING KIT THAT USES
                            // BASIC STRING PARSING TO GET A HANDLE ON THE CHANNEL
                            // NAME PREFIX FOR BUSINESS PURPOSES.
                            //
                            // WE ARE NOT WORKING WITH NUMBERS HERE, BOYS.
                            //
                            // Thursday, November 30, 2023 @ 0311 hrs.
                            //
                            // 311 - Come Original
                            // https://www.youtube.com/watch?v=KWo-02Hsab4
                            $tmp_channel = $this->oCRNRSTN->extract_key_from_string($data_key, '_ttl');

                            $tmp_err_str = 'CRNRSTN :: could not apply the CRNRSTN :: RRS MAP channel [' . $tmp_channel . '] ' . $data_key . ', (' .
                                $this->oCRNRSTN->gettype($tmp_int) . ') ' . strval($tmp_int) . '. ' . strval($data) .
                                ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        case 'config_init_sys_resp_return_profile_integer':
                        case '__construct_integer':

                            /*
                            CRNRSTN_debug_mode
                            PHPMAILER_debug_mode

                            */

                            $tmp_exception_bypass = true;

                        break;
                        case 'wethrbug_integer':

                            $tmp_err_str = 'CRNRSTN :: could not apply the CRNRSTN :: WETHRBUG ' . $data_key . ', (' .
                                $this->oCRNRSTN->gettype($tmp_int) . ') ' . strval($tmp_int) . '. ' . strval($data) .
                                ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        case 'electrum_integer':

                            $tmp_err_str = 'CRNRSTN :: could not apply the CRNRSTN :: ELECTRUM ' . $data_key . ', (' .
                                $this->oCRNRSTN->gettype($tmp_int) . ') ' . strval($tmp_int) . '. ' . strval($data) .
                                ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        default:
                            //case 'integer':
                            //case 'int':

                            $tmp_err_str = 'CRNRSTN :: could not apply the ' . $data_key . ', (' .
                                $this->oCRNRSTN->gettype($tmp_int) . ') ' . strval($tmp_int) . '. ' . strval($data) .
                                ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;

                    }

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    // # # C # R # N # R # S # T # N # : : # # # #
                    // CRNRSTN :: UGC DATA INPUT EXCEPTION [INTEGER]
                    if(!($tmp_exception_bypass !== false)){

                        $this->oCRNRSTN->err_message_queue_push(NULL, $tmp_err_str);

                        return NULL;

                    }

                }

                //
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: UGC DATA VALIDATION [INTEGER]
                switch($data_key){
                    case 'CRNRSTN_debug_mode':

                        $tmp_int = $this->oCRNRSTN->return_valid_constant($tmp_int, 'crnrstn_debug_mode_ARRAY', CRNRSTN_DEBUG_OFF);
                        $this->oCRNRSTN->set_crnrstn('CRNRSTN_debug_mode', $tmp_int);

                    break;
                    case 'PHPMAILER_debug_mode':

                        $tmp_int = $this->oCRNRSTN->return_valid_constant($tmp_int, 'crnrstn_debug_mode_ARRAY', CRNRSTN_PHPMAILER_DEBUG_OFF);

                    break;
                    default:
                        //SILENCE IS GOLDEN.
                        //error_log(__LINE__ . ' ' .  __METHOD__ . ' UNKNOWN SWITCH CASE $data_key[' . $data_key . ']. $data_profile[' . $data_profile . '].');

                    break;

                }

                //
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: UGC DATA INPUT [INTEGER]
                switch($data_profile){
                    //case '__construct_integer':                       // MOVED TO [BIT].
                    //case 'config_add_environment_integer':            // MOVED TO case 'config_add_environment_integer_mode':
                    case 'config_init_channel_integer':

                        switch($data_key){
                            case 'get_ttl':
                            case 'post_ttl':
                            case 'cookie_ttl':
                            case 'session_ttl':
                            case 'database_ttl':
                            case 'ssdtla_ttl':
                            case 'pssdtla_ttl':
                            case 'runtime_ttl':
                            case 'soap_ttl':
                            case 'file_ttl':

                                //
                                // THIS IS SOME CRNRSTN :: SCREEN SCRAPING KIT THAT USES
                                // BASIC STRING PARSING TO GET A HANDLE ON THE CHANNEL
                                // NAME PREFIX FOR BUSINESS PURPOSES.
                                //
                                // WE ARE NOT WORKING WITH NUMBERS HERE, BOYS.
                                //
                                // Thursday, November 30, 2023 @ 0311 hrs.
                                //
                                // 311 - Come Original
                                // https://www.youtube.com/watch?v=KWo-02Hsab4
                                $tmp_channel = $this->oCRNRSTN->extract_key_from_string($data_key, '_ttl');

                                //
                                // THE USE OF self::$oCRNRSTN_RRS_MAP METHODS
                                // OUTSIDE OF THE CRNRSTN :: RRS MAP OBJECT IS DEPRECATED.
                                //
                                // PLEASE SEE,
                                //      $oCRNRSTN->set_channel_config($channel_constant, $attribute_name, $data);
                                //      $oCRNRSTN->get_channel_config($channel, $index_0 = NULL, $index_1 = NULL, $index_2 = NULL, $index_3 = NULL, $initialize = false);
                                //      $oCRNRSTN->isset_channel_config($channel_constant, $attribute_name, $return_type = CRNRSTN_BOOLEAN);
                                //      $oCRNRSTN->is_channel_active($channel_constant, $return_type = CRNRSTN_BOOLEAN)
                                //
                                // Friday, November 24, 2023 @ 1509 hrs.
                                //
                                // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA
                                // OBJECT (MC-DDO) SERVICES LAYER.
                                // # # C # R # N # R # S # T # N # : : # # # #
                                // CRNRSTN :: UGC DATA INPUT [INTEGER]
                                // APPLY CHANNEL SETTINGS TO RRS MAP OBJECT.
                                $this->oCRNRSTN->set_channel_config($tmp_channel, 'map_cache_ttl', $tmp_int);

                            break;
//                            case 'CRNRSTN_debug_mode':
//
//                                $this->oCRNRSTN->set_crnrstn('CRNRSTN_debug_mode', $tmp_int);
//
//                            break;
//                            case 'CRNRSTN_log_silo_profile':
//
//                                //
//                                // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
//                                // # # C # R # N # R # S # T # N # : : # # # #
//                                // CRNRSTN :: UGC DATA INPUT [INTEGER]
//                                $this->oCRNRSTN->input_data_value($tmp_int, 'CRNRSTN_log_silo_profile', $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);
//
//                            break;
//                            case 'PHPMAILER_debug_mode':
//
//                                //
//                                // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
//                                // # # C # R # N # R # S # T # N # : : # # # #
//                                // CRNRSTN :: UGC DATA INPUT [INTEGER]
//                                $this->oCRNRSTN->input_data_value($tmp_int, 'PHPMAILER_debug_mode', $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);
//
//                            break;
                            case 'err_reporting_profile':
                                // E.G., E_ALL & ~E_NOTICE & ~E_STRICT

                                //error_log(__LINE__ . ' crnrstn config_serial_hash[' . $this->config_serial_hash . ']. env_key_hash_config_ARRAY[' . print_r(self::$env_key_hash_config_ARRAY, true) . ']. env_err_reporting_profile_ARRAY[' . print_r($this->env_err_reporting_profile_ARRAY, true) . '].');
                                $this->oCRNRSTN->set_crnrstn('env_err_reporting_profile_ARRAY', $tmp_int);

                            break;
                            case 'crnrstn_debug_mode_override':

                                $this->oCRNRSTN->set_crnrstn('CRNRSTN_debug_mode', $tmp_int);

                            break;
                            case 'system_html_comments_mode':

                                //
                                // PLEASE SEE, $oCRNRSTN->config_add_environment() IN _crnrstn.config.inc.php.
                                //
                                // CONFIGURATION FILE EXCERPT:
                                // -----
                                // @param   integer $system_html_comments_mode manages the content format of HTML and TEXT
                                // comments in CRNRSTN :: system output. The system predefined integer constant options for
                                // this include:
                                //      CRNRSTN_HTML_COMMENTS_NONE                          (no comments)
                                //      CRNRSTN_HTML_COMMENTS_SILENT_GOLD                   (alias of CRNRSTN_HTML_COMMENTS_NONE)
                                //      CRNRSTN_HTML_COMMENTS_CDN_STABILITY_CONTROL_ENABLED (no timestamps in comments)
                                //      CRNRSTN_HTML_COMMENTS_ENLARGED_PHYLACTERIES         (alias of CRNRSTN_HTML_COMMENTS_FULL)
                                //      CRNRSTN_HTML_COMMENTS_FULL                          (this is the default)
                                //
                                // Thursday September 7, 2023 @ 0643 hrs.
                                $this->oCRNRSTN->set_crnrstn('env_html_comments_mode_ARRAY', $tmp_int);

                            break;
                            default:

                                error_log(__LINE__ . ' crnrstn MISSING SWITCH CASE[' . $data_key . ']. $data_profile[' . $data_profile . '].');

                            break;

                        }

                    break;
                    default:

                        //
                        // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: UGC DATA INPUT [INTEGER]
                        $this->oCRNRSTN->input_data_value($tmp_int, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                    break;

                }

            break;

            case 'byte':
            case 'bytes':
            case 'electrum_bytes':
            case 'config_init_channel_bytes':

                //
                // FORMAT BYTES.
                $tmp_bytes = $this->oCRNRSTN->format_bytes($data, NULL, NULL, true);

                //
                // -1 = SYSTEM LIMITED MAX FILE SIZE.
                if(!($tmp_bytes == -1) && !($tmp_bytes >= 0)){

                    //
                    // # # C # R # N # R # S # T # N # : : # # # #
                    // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [BYTES]
                    switch($data_profile){
                        case 'config_init_channel_bytes':

                            //
                            // THIS IS SOME CRNRSTN :: SCREEN SCRAPING KIT THAT
                            // USES BASIC STRING PARSING TO GET A HANDLE ON THE
                            // CHANNEL NAME FOR BUSINESS PURPOSES.
                            //
                            // WE ARE NOT WORKING WITH NUMBERS HERE, BOYS.
                            //
                            // Thursday, November 30, 2023 @ 0311 hrs.
                            //
                            // 311 - Come Original
                            // https://www.youtube.com/watch?v=KWo-02Hsab4
                            $tmp_channel = $this->oCRNRSTN->extract_key_from_string($data_key, '_max_bytes');
                            $tmp_err_str = 'CRNRSTN :: could not apply the CRNRSTN :: RRS MAP channel [' . $tmp_channel . '] ' .
                                $data_key . ', (' . $this->oCRNRSTN->gettype($tmp_bytes) . ') ' . strval($tmp_bytes) . '. ' .
                                strval($data) . ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        case 'electrum_bytes':

                            $tmp_err_str = 'CRNRSTN :: could not apply the CRNRSTN :: ELECTRUM ' . $data_key . ', (' .
                                $this->oCRNRSTN->gettype($tmp_bytes) . ') ' . strval($tmp_bytes) . '. ' . strval($data) .
                                ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        default:
                            //case 'byte':
                            //case 'bytes':

                            $tmp_err_str = 'CRNRSTN :: could not apply the ' . $data_key . ', (' .
                                $this->oCRNRSTN->gettype($tmp_bytes) . ') ' . strval($tmp_bytes) . '. ' .
                                strval($data) . ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;

                    }

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    // # # C # R # N # R # S # T # N # : : # # # #
                    // CRNRSTN :: UGC DATA INPUT EXCEPTION [BYTES]
                    $this->oCRNRSTN->err_message_queue_push(NULL, $tmp_err_str);

                    return NULL;

                }

                //
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: UGC DATA INPUT [BYTES]
                switch($data_profile){
                    case 'config_init_channel_bytes':

                        //
                        // THIS IS SOME CRNRSTN :: SCREEN SCRAPING KIT THAT
                        // USES BASIC STRING PARSING TO GET A HANDLE ON THE
                        // CHANNEL NAME FOR BUSINESS PURPOSES.
                        //
                        // WE ARE NOT WORKING WITH NUMBERS HERE, BOYS.
                        //
                        // Thursday, November 30, 2023 @ 0311 hrs.
                        //
                        // 311 - Come Original
                        // https://www.youtube.com/watch?v=KWo-02Hsab4
                        $tmp_channel = $this->oCRNRSTN->extract_key_from_string($data_key, '_max_bytes');

                        //
                        // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA
                        // OBJECT (MC-DDO) SERVICES LAYER.
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: UGC DATA INPUT [BYTES]
                        // APPLY CHANNEL SETTINGS TO RRS MAP OBJECT.
                        $this->oCRNRSTN->set_channel_config($tmp_channel, 'max_map_cache_bytes', $tmp_bytes);

                    break;
                    default:

                        //
                        // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: UGC DATA INPUT [BYTES]
                        $this->oCRNRSTN->input_data_value($tmp_bytes, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                    break;

                }

            break;

            case 'bool':
            case 'boolean':
            case 'electrum_boolean':
            case 'wethrbug_boolean':
            case 'config_init_js_css_minimization_boolean':
            case 'config_init_channel_boolean':
            case 'config_init_file_system_integrations_boolean':
            case 'config_init_asset_map_favicon_boolean':
            case 'config_init_asset_map_css_boolean':
            case 'config_init_asset_map_js_boolean':
            case 'config_init_asset_map_system_img_boolean':
            case 'config_init_asset_map_social_img_boolean':
            case 'config_init_asset_map_meta_img_boolean':
            case 'config_init_html_mode_email_boolean':
            case 'system_output_head_html_boolean':
            case 'system_output_footer_html_boolean':

                //
                // FORMAT BOOLEAN.
                $tmp_boolean = $this->oCRNRSTN->tidy_boolean($data);

                if(!(is_bool($tmp_boolean))){

                    //
                    // IT WOULD CERTAINLY APPEAR THAT THIS
                    // IS NOT A VALID NUMBER FOR THE
                    // REQUESTED OPERATION.
                    //
                    // WE SHALL RUN AN INVALID CALCULATION.
                    //
                    // THIS MAY BE THE ONLY WAY THAT AN
                    // APPLICATION WHICH ABSOLUTELY LOVES
                    // NUMBERS (AS MUCH AS CRNRSTN :: HAS
                    // BEEN LOVING THE NUMBERS LATELY, AND
                    // EVEN IN THE MIDST OF "THESE ECONOMIC
                    // TIMES" AT THAT)...COULD EVEN BE ABLE
                    // TO ACQUIRE AN AUTHENTIC NaN (PLEASE
                    // READ AS "BAD DATA", OR EVEN BETTER,
                    // ...A PROPER SHIT VALUE) VALUE THAT
                    // CAN BE RELIABLY RETURNED WITH
                    // CONFIDENCE BY CRNRSTN ::
                    //
                    // CRNRSTN :: <3's
                    //          ...CRNRSTN_INTEGER's 4LIFE!
                    //
                    // SEE, https://www.php.net/manual/en/function.is-nan.php
                    $tmp_boolean = sqrt(-1);

                    //
                    // # # C # R # N # R # S # T # N # : : # # # #
                    // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [BOOLEAN]
                    switch($data_profile){
                        case 'system_output_head_html_boolean':
                        case 'system_output_footer_html_boolean':

                            switch($data_key){
                                case 'crnrstn_head_resource_html_output_spool_is_dev_mode':

                                    $tmp_err_str = 'CRNRSTN :: could not determine if the development HTML spool output mode for <HEAD> is active with the input, (' .
                                        $this->oCRNRSTN->gettype($tmp_boolean) . ') ' . strval($tmp_boolean) . '. ' .
                                        strval($data) . ', was the value provided. The system will manually set this to FALSE. ' .
                                        $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                break;
                                case 'crnrstn_head_resource_html_output_build_acceleration_spool_is_dev_mode':

                                    $tmp_err_str = 'CRNRSTN :: BUILD ACCELERATION could not determine if the development HTML spool output mode is active with the input, (' .
                                        $this->oCRNRSTN->gettype($tmp_boolean) . ') ' . strval($tmp_boolean) . '. ' .
                                        strval($data) . ', was the value provided. The system will manually set this to FALSE. ' .
                                        $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                break;
                                case 'crnrstn_footer_resource_html_output_spool_is_dev_mode':

                                    $tmp_err_str = 'CRNRSTN :: could not determine if the development HTML spool output mode for the footer is active with the input, (' .
                                        $this->oCRNRSTN->gettype($tmp_boolean) . ') ' . strval($tmp_boolean) . '. ' .
                                        strval($data) . ', was the value provided. The system will manually set this to FALSE. ' .
                                        $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                break;

                            }

                        break;
                        case 'config_init_html_mode_email_boolean':

                            $tmp_err_str = 'CRNRSTN :: could not determine if HTML mode should be active for email with the data, ' .
                                $data_key . '[(' . $this->oCRNRSTN->gettype($tmp_boolean) . ') ' . strval($tmp_boolean) . ']. ' .
                                strval($data) . ', was the value provided. The system will run in PLAIN TEXT output mode for email. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        case 'config_init_js_css_minimization_boolean':

                            $tmp_err_str = 'CRNRSTN :: could not flip the bit, ' . $data_key . '[(' .
                                $this->oCRNRSTN->gettype($tmp_boolean) . ') ' . strval($tmp_boolean) .
                                '], which supports the JS/CSS framework minimization mode for this environment. ' .
                                strval($data) . ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        case 'config_init_asset_map_favicon_boolean':
                        case 'config_init_asset_map_css_boolean':
                        case 'config_init_asset_map_js_boolean':
                        case 'config_init_asset_map_system_img_boolean':
                        case 'config_init_asset_map_social_img_boolean':
                        case 'config_init_asset_map_meta_img_boolean':

                            $tmp_pattern_ARRAY = array('config_init_asset_map_', '_boolean', '_');
                            $tmp_replacements_ARRAY = array('', '', ' ');

                            //
                            // THIS IS SOME CRNRSTN :: SCREEN SCRAPING KIT THAT
                            // USES BASIC STRING PARSING TO GET A HANDLE ON THE
                            // ARCHITECTURE NAME FOR BUSINESS PURPOSES.
                            //
                            // WE ARE NOT WORKING WITH NUMBERS HERE, BOYS.
                            //
                            // Thursday, November 30, 2023 @ 0311 hrs.
                            //
                            // 311 - Come Original
                            // https://www.youtube.com/watch?v=KWo-02Hsab4
                            $tmp_asset_type = $this->oCRNRSTN->extract_key_from_string($data_profile, '', false, $tmp_pattern_ARRAY, $tmp_replacements_ARRAY);

                            $tmp_err_str = 'CRNRSTN :: could not receive ' . $data_key .
                                ' input meta supporting configuration of the CRNRSTN :: RRS MAP ' .
                                strtoupper($tmp_asset_type) . ' asset mapping architecture. ' . strval($data) .
                                ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        case 'config_init_file_system_integrations_boolean':

                            $tmp_err_str = 'CRNRSTN :: could not add the environmental configuration ' . $data_key .
                                ', (' . $this->oCRNRSTN->gettype($tmp_boolean) . ') ' . strval($tmp_boolean) . '. ' .
                                strval($data) . ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        case 'config_init_channel_boolean':

                            //
                            // THIS IS SOME CRNRSTN :: SCREEN SCRAPING KIT THAT USES
                            // BASIC STRING PARSING TO GET A HANDLE ON THE CHANNEL
                            // NAME PREFIX FOR BUSINESS PURPOSES.
                            //
                            // WE ARE NOT WORKING WITH NUMBERS HERE, BOYS.
                            //
                            // Thursday, November 30, 2023 @ 0311 hrs.
                            //
                            // 311 - Come Original
                            // https://www.youtube.com/watch?v=KWo-02Hsab4
                            $tmp_channel = $this->oCRNRSTN->extract_key_from_string($data_key, '_is_active');
                            $tmp_err_str = 'CRNRSTN :: could not apply the CRNRSTN :: RRS MAP channel [' .
                                $tmp_channel . '] ' . $data_key . ', (' . $this->oCRNRSTN->gettype($tmp_boolean) . ') ' .
                                strval($tmp_boolean) . '. ' . strval($data) . ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        case 'wethrbug_boolean':

                            $tmp_err_str = 'CRNRSTN :: could not apply the CRNRSTN :: WETHRBUG ' . $data_key . ', (' .
                                $this->oCRNRSTN->gettype($tmp_boolean) . ') ' . strval($tmp_boolean) . '. ' .
                                strval($data) . ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        case 'electrum_boolean':

                            $tmp_err_str = 'CRNRSTN :: could not apply the CRNRSTN :: ELECTRUM ' . $data_key . ', (' .
                                $this->oCRNRSTN->gettype($tmp_boolean) . ') ' . strval($tmp_boolean) . '. ' .
                                strval($data) . ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        default:
                            //case 'bool':
                            //case 'boolean':

                            $tmp_err_str = 'CRNRSTN :: could not apply the ' . $data_key . ', (' .
                                $this->oCRNRSTN->gettype($tmp_boolean) . ') ' . strval($tmp_boolean) . '. ' .
                                strval($data) . ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;

                    }

                    switch($data_profile){
                        case 'system_output_head_html_boolean':
                        case 'system_output_footer_html_boolean':

                            //
                            // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // CRNRSTN :: UGC DATA INPUT [BOOLEAN]
                            $this->oCRNRSTN->input_data_value(false, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                        break;

                    }

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    // # # C # R # N # R # S # T # N # : : # # # #
                    // CRNRSTN :: UGC DATA INPUT EXCEPTION [BOOLEAN]
                    $this->oCRNRSTN->err_message_queue_push(NULL, $tmp_err_str);

                    return NULL;

                }

                //
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: UGC DATA INPUT [BOOLEAN]
                switch($data_profile){
                    case 'config_init_html_mode_email_boolean':

                        if($data == true){

                            $this->oCRNRSTN->error_log('Activating the multi-part HTML output format for default system email communications.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                            //
                            // IF BIT NOT FLIPPED, TEXT VERSION EMAIL ONLY.

                            //
                            // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                            // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                            $this->oCRNRSTN->initialize_bit(CRNRSTN_SYSTEM_EMAIL_IS_HTML, true);

                        }

                        return true;

                    break;
                    case 'config_init_js_css_minimization_boolean':

                        if(!($data == true)){

                            //
                            // IF THE CONDITION OF THIS INTEGER IN ICY_DIGITALITCC-
                            // BITMASK IS AS IT IS FLIPPED IN ITS STATE, WE WILL
                            // TURN IT OFF.
                            if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_CSS_PROD_MIN) == true){

                                //
                                // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                                // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                                // # # C # R # N # R # S # T # N # : : # # # #
                                // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                                $this->oCRNRSTN->initialize_bit(CRNRSTN_JS_CSS_PROD_MIN, false);

                            }

                            return true;

                        }

                        if($data == true){

                            //
                            // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                            // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                            $this->oCRNRSTN->initialize_bit(CRNRSTN_JS_CSS_PROD_MIN, true);

                            return true;

                        }

                    break;
                    case 'config_init_asset_map_favicon_boolean':
                    case 'config_init_asset_map_css_boolean':
                    case 'config_init_asset_map_js_boolean':
                    case 'config_init_asset_map_system_img_boolean':
                    case 'config_init_asset_map_social_img_boolean':
                    case 'config_init_asset_map_meta_img_boolean':

                        $tmp_pattern_ARRAY = array('config_init_asset_map_', '_boolean', '_');
                        $tmp_replacements_ARRAY = array('', '', ' ');

                        //
                        // THIS IS SOME CRNRSTN :: SCREEN SCRAPING KIT THAT USES
                        // BASIC STRING PARSING TO GET A HANDLE ON A STRING
                        // PREFIX FOR BUSINESS PURPOSES.
                        //
                        // WE ARE NOT WORKING WITH NUMBERS HERE, BOYS.
                        //
                        // Thursday, November 30, 2023 @ 0311 hrs.
                        //
                        // 311 - Come Original
                        // https://www.youtube.com/watch?v=KWo-02Hsab4
                        $tmp_asset_type = $this->oCRNRSTN->extract_key_from_string($data_profile, '', false, $tmp_pattern_ARRAY, $tmp_replacements_ARRAY);

                        if($tmp_boolean == true){

                            //
                            // PREVIOUS ERROR_LOG MESSAGES:
                            //      "Activating CRNRSTN :: asset routing for system images."
                            //      "Activating CRNRSTN :: asset routing for system social images."
                            //      "Activating CRNRSTN :: asset routing for meta preview social images."
                            $this->oCRNRSTN->error_log('Activating CRNRSTN :: RESPONSE RETURN SERIALIZATION (RRS) system asset response route mapping for ' . strtoupper($tmp_asset_type) . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                            switch($tmp_asset_type){
                                case 'favicon':

                                    //
                                    // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                                    // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                                    $this->oCRNRSTN->initialize_bit(CRNRSTN_FAVICON_ASSET_MAPPING, true);

                                break;
                                case 'css':

                                    //
                                    // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                                    // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                                    $this->oCRNRSTN->initialize_bit(CRNRSTN_CSS_ASSET_MAPPING, true);

                                break;
                                case 'js':

                                    //
                                    // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                                    // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                                    $this->oCRNRSTN->initialize_bit(CRNRSTN_JS_ASSET_MAPPING, true);

                                break;
                                case 'system img':

                                    //
                                    // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                                    // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                                    $this->oCRNRSTN->initialize_bit(CRNRSTN_SYSTEM_IMG_ASSET_MAPPING, true);

                                break;
                                case 'social img':

                                    //
                                    // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                                    // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                                    $this->oCRNRSTN->initialize_bit(CRNRSTN_SOCIAL_IMG_ASSET_MAPPING, true);

                                break;
                                case 'meta img':

                                    //
                                    // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                                    // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                                    $this->oCRNRSTN->initialize_bit(CRNRSTN_META_IMG_ASSET_MAPPING, true);

                                break;
                                default:

                                    $tmp_err_str = 'CRNRSTN :: could not process ' . $data_key .
                                        ' input using the derived lookup value, "' . strtoupper($tmp_asset_type) . '". ' .
                                        strval($data_profile) . ', was the value provided to this internal operation. ' .
                                        $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT EXCEPTION [BOOLEAN]
                                    $this->oCRNRSTN->err_message_queue_push(NULL, $tmp_err_str);

                                    return NULL;

                                break;

                            }

                        }else{

                            switch($tmp_asset_type){
                                case 'favicon':

                                    //
                                    // IF THE CONDITION OF THIS INTEGER IN ICY_DIGITALITCC-
                                    // BITMASK IS AS IT IS FLIPPED IN ITS STATE, WE WILL
                                    // TURN IT OFF.
                                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_FAVICON_ASSET_MAPPING) == true){

                                        //
                                        // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                                        // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                                        // # # C # R # N # R # S # T # N # : : # # # #
                                        // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                                        $this->oCRNRSTN->initialize_bit(CRNRSTN_FAVICON_ASSET_MAPPING, false);

                                    }

                                break;
                                case 'css':

                                    //
                                    // IF THE CONDITION OF THIS INTEGER IN ICY_DIGITALITCC-
                                    // BITMASK IS AS IT IS FLIPPED IN ITS STATE, WE WILL
                                    // TURN IT OFF.
                                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_CSS_ASSET_MAPPING) == true){

                                        //
                                        // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                                        // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                                        // # # C # R # N # R # S # T # N # : : # # # #
                                        // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                                        $this->oCRNRSTN->initialize_bit(CRNRSTN_CSS_ASSET_MAPPING, false);

                                    }

                                break;
                                case 'js':

                                    //
                                    // IF THE CONDITION OF THIS INTEGER IN ICY_DIGITALITCC-
                                    // BITMASK IS AS IT IS FLIPPED IN ITS STATE, WE WILL
                                    // TURN IT OFF.
                                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_JS_ASSET_MAPPING) == true){

                                        //
                                        // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                                        // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                                        // # # C # R # N # R # S # T # N # : : # # # #
                                        // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                                        $this->oCRNRSTN->initialize_bit(CRNRSTN_JS_ASSET_MAPPING, false);

                                    }

                                break;
                                case 'system img':

                                    //
                                    // IF THE CONDITION OF THIS INTEGER IN ICY_DIGITALITCC-
                                    // BITMASK IS AS IT IS FLIPPED IN ITS STATE, WE WILL
                                    // TURN IT OFF.
                                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_SYSTEM_IMG_ASSET_MAPPING) == true){

                                        //
                                        // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                                        // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                                        // # # C # R # N # R # S # T # N # : : # # # #
                                        // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                                        $this->oCRNRSTN->initialize_bit(CRNRSTN_SYSTEM_IMG_ASSET_MAPPING, false);

                                    }

                                break;
                                case 'social img':

                                    //
                                    // IF THE CONDITION OF THIS INTEGER IN ICY_DIGITALITCC-
                                    // BITMASK IS AS IT IS FLIPPED IN ITS STATE, WE WILL
                                    // TURN IT OFF.
                                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_SOCIAL_IMG_ASSET_MAPPING) == true){

                                        //
                                        // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                                        // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                                        // # # C # R # N # R # S # T # N # : : # # # #
                                        // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                                        $this->oCRNRSTN->initialize_bit(CRNRSTN_SOCIAL_IMG_ASSET_MAPPING, false);

                                    }

                                break;
                                case 'meta img':

                                    //
                                    // IF THE CONDITION OF THIS INTEGER IN ICY_DIGITALITCC-
                                    // BITMASK IS AS IT IS FLIPPED IN ITS STATE, WE WILL
                                    // TURN IT OFF.
                                    //if($this->oCRNRSTN->is_bit_set(CRNRSTN_META_IMG_ASSET_MAPPING) == true){
                                    if($this->oCRNRSTN->tidy_boolean(CRNRSTN_META_IMG_ASSET_MAPPING, CRNRSTN_BOOLEAN, CRNRSTN_META_IMG_ASSET_MAPPING) == true){

                                        //
                                        // CRNRSTN :: ICY_DIGITALITCC-BITMASK INTEGER
                                        // STATE (BIT FLIP) MANAGEMENT SERVICES LAYER.
                                        // # # C # R # N # R # S # T # N # : : # # # #
                                        // CRNRSTN :: UGC DATA INPUT [ICY_DIGITALITCC-BITMASK]
                                        $this->oCRNRSTN->initialize_bit(CRNRSTN_META_IMG_ASSET_MAPPING, false);

                                    }

                                break;
                                default:

                                    $tmp_err_str = 'CRNRSTN :: could not process the deactivation of ' . $data_key .
                                        ' input using the derived lookup value, "' . strtoupper($tmp_asset_type) . '". ' .
                                        strval($data_profile) . ', was the value provided to this internal operation. ' .
                                        $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT EXCEPTION [BOOLEAN]
                                    $this->oCRNRSTN->err_message_queue_push(NULL, $tmp_err_str);

                                    return NULL;

                                break;

                            }

                        }

                    break;
                    case 'config_init_file_system_integrations_boolean':

                        $this->init_disk_write_authorization($tmp_boolean);

                    break;
                    case 'config_init_channel_boolean':

                        //
                        // THIS IS SOME CRNRSTN :: SCREEN SCRAPING KIT THAT USES
                        // BASIC STRING PARSING TO GET A HANDLE ON THE CHANNEL
                        // NAME PREFIX FOR BUSINESS PURPOSES.
                        //
                        // WE ARE NOT WORKING WITH NUMBERS HERE, BOYS.
                        //
                        // Thursday, November 30, 2023 @ 0311 hrs.
                        //
                        // 311 - Come Original
                        // https://www.youtube.com/watch?v=KWo-02Hsab4
                        $tmp_channel = $this->oCRNRSTN->extract_key_from_string($data_key, '_is_active');

                        //
                        // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA
                        // OBJECT (MC-DDO) SERVICES LAYER.
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: UGC DATA INPUT [BOOLEAN]
                        // APPLY CHANNEL SETTINGS TO RRS MAP OBJECT.
                        $this->oCRNRSTN->set_channel_config($tmp_channel, 'cache_is_active', $tmp_boolean);

                    break;
                    default:
                        //case 'electrum_boolean':
                        //case 'wethrbug_boolean':

                        //
                        // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: UGC DATA INPUT [BOOLEAN]
                        $this->oCRNRSTN->input_data_value($tmp_boolean, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                    break;

                }

            break;

            case 'sql_temporal_interval':
            case 'database_shard_sql_temporal_interval':

                //
                // -1 = NO EXPIRE. '1 MONTH', '1 YEAR', '5 WEEKS', (int) 100 == '100 SECONDS'
                // SEE DATABASE QUERY DATE SPAN HANDLES.

                //
                // FORMAT SQL DATE INTERVAL.
                $tmp_sql_interval = $this->oCRNRSTN->format_sql_interval($data);

                if(strlen($tmp_sql_interval) < 1){

                    //
                    // # # C # R # N # R # S # T # N # : : # # # #
                    // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [SQL INTERVAL]
                    switch($data_profile){
                        case 'database_shard_sql_temporal_interval':

                            $tmp_err_str = 'CRNRSTN :: could not apply the CRNRSTN :: DATABASE SHARDING ' . $data_key .
                                ', ' . strval($tmp_sql_interval) . '. ' .
                                strval($data) . ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        default:
                            //case 'sql_temporal_interval':

                            $tmp_err_str = 'CRNRSTN :: could not apply the ' . $data_key . ', (' .
                                $this->oCRNRSTN->gettype($tmp_sql_interval) . ') ' . strval($tmp_sql_interval) . '. ' .
                                strval($data) . ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;

                    }

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    // # # C # R # N # R # S # T # N # : : # # # #
                    // CRNRSTN :: UGC DATA INPUT EXCEPTION [SQL INTERVAL]
                    $this->oCRNRSTN->err_message_queue_push(NULL, $tmp_err_str);

                    return NULL;

                }

                //
                // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: UGC DATA INPUT [SQL INTERVAL]
                $this->oCRNRSTN->input_data_value($tmp_sql_interval, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

            break;

            case 'percentage':
            case 'electrum_percentage':
            case 'config_init_file_system_integrations_percentage':

                if(!isset($data)){

                    //
                    // NULL DEFAULT FROM CONFIGURATION METHOD.
                    switch($data_key){
                        case 'disk_percent_full_warning_override':

                            $data = $this->oCRNRSTN->get_crnrstn('max_disk_storage_utilization_warning');

                        break;
                        case 'disk_percent_full_max_override':

                            //$data = self::$max_disk_storage_utilization;
                            $data = $this->oCRNRSTN->get_crnrstn('max_disk_storage_utilization');

                        break;

                    }

                }

                $tmp_percentage = $this->oCRNRSTN->str_sanitize($data, 'clean_percentage_numbers');

                //
                // THIS SHOULD BE A NUMBER.
                if(!is_numeric($tmp_percentage)){

                    //
                    // IT WOULD CERTAINLY APPEAR THAT THIS
                    // IS NOT A VALID NUMBER FOR THE
                    // REQUESTED OPERATION.
                    //
                    // WE SHALL RUN AN INVALID CALCULATION.
                    //
                    // THIS MAY BE THE ONLY WAY THAT AN
                    // APPLICATION WHICH ABSOLUTELY LOVES
                    // NUMBERS (AS MUCH AS CRNRSTN :: HAS
                    // BEEN LOVING THE NUMBERS LATELY, AND
                    // EVEN IN THE MIDST OF "THESE ECONOMIC
                    // TIMES" AT THAT)...COULD EVEN BE ABLE
                    // TO ACQUIRE AN AUTHENTIC NaN (PLEASE
                    // READ AS "BAD DATA", OR EVEN BETTER,
                    // ...A PROPER SHIT VALUE) VALUE THAT
                    // CAN BE RELIABLY RETURNED WITH
                    // CONFIDENCE BY CRNRSTN ::
                    //
                    // CRNRSTN :: <3's
                    //          ...CRNRSTN_INTEGER's 4LIFE!
                    //
                    // Wednesday, November 29, 2023 @ 1615 hrs.
                    //
                    // SEE, https://www.php.net/manual/en/function.is-nan.php
                    $tmp_percentage = sqrt(-1);

                    //
                    // # # C # R # N # R # S # T # N # : : # # # #
                    // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [PERCENTAGE]
                    switch($data_profile){
                        case 'config_init_file_system_integrations_percentage':

                            $tmp_err_str = 'CRNRSTN :: could not apply the CRNRSTN :: DISK MANAGEMENT ' . $data_key .
                                ' percentage, (' . $this->oCRNRSTN->gettype($tmp_percentage) . ') ' .
                                strval($tmp_percentage) . '. ' . strval($data) . ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        case 'electrum_percentage':

                            $tmp_err_str = 'CRNRSTN :: could not apply the CRNRSTN :: ELECTRUM, ' . $data_key . ', (' .
                                $this->oCRNRSTN->gettype($tmp_percentage) . ') ' . strval($tmp_percentage) . '. ' .
                                $data . ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        default:
                            //case 'percentage':

                            $tmp_err_str = 'CRNRSTN :: could not apply the ' . $data_key . ', (' .
                                $this->oCRNRSTN->gettype($tmp_percentage) . ') ' . strval($tmp_percentage) . '. ' .
                                $data . ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;

                    }

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    $this->oCRNRSTN->err_message_queue_push(NULL, $tmp_err_str);

                    return NULL;

                }

                //
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: UGC DATA INPUT [PERCENTAGE]
                switch($data_profile){
                    case 'config_init_file_system_integrations_percentage':

                        switch($data_key){
                            case 'disk_percent_full_warning_override':

                                //
                                // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                // # # C # R # N # R # S # T # N # : : # # # #
                                // CRNRSTN :: UGC DATA INPUT [PERCENTAGE]
                                $this->oCRNRSTN->input_data_value($tmp_percentage, 'max_disk_storage_utilization_warning', $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                            break;
                            default:
                                //case 'disk_percent_full_max_override':

                                //
                                // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                // # # C # R # N # R # S # T # N # : : # # # #
                                // CRNRSTN :: UGC DATA INPUT [PERCENTAGE]
                                $this->oCRNRSTN->input_data_value($tmp_percentage, 'max_disk_storage_utilization', $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                            break;

                        }

                    break;
                    default:

                        //
                        // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: UGC DATA INPUT [PERCENTAGE]
                        $this->oCRNRSTN->input_data_value($tmp_percentage, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                    break;

                }

            break;

            case 'wethrbug_zipcode':

                $tmp_str = '';

                //
                // THIS SHOULD BE A STRING.
                if($this->is_valid_zipcode($data) == true){

                    $tmp_str = (string) $data;

                }

                if(strlen($tmp_str) < 5){

                    //
                    // # # C # R # N # R # S # T # N # : : # # # #
                    // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [ZIPCODE]
                    switch($data_profile){
                        case 'wethrbug_zipcode':

                            $tmp_err_str = 'CRNRSTN :: could not apply the CRNRSTN :: WETHRBUG ' . $data_key . ', (' .
                                $this->oCRNRSTN->gettype($tmp_str) . ') ' . $tmp_str . '. ' . strval($data) .
                                ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        default:
                            //case 'zipcode':

                            $tmp_err_str = 'CRNRSTN :: could not apply the ' . $data_key . ', (' .
                                $this->oCRNRSTN->gettype($tmp_str) . ') ' . $tmp_str . '. ' . strval($data) .
                                ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;

                    }

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    $this->oCRNRSTN->err_message_queue_push(NULL, $tmp_err_str);

                    return NULL;

                }

                //
                // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: UGC DATA INPUT [ZIPCODE]
                $this->oCRNRSTN->input_data_value($tmp_str, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

            break;

            case 'email':
            case 'account_email':
            case 'admin_email':

                /*
                DISPLAY_TOKEN       // j*****@j*****.com, c*****@g*****.com, j*****@e*****.com
                EMAIL
                NAME
                IS_ADMIN

                */

                $tmp_has_email = false;

                $tmp_str = trim((string) $data);
                $tmp_email_ARRAY = $this->oCRNRSTN->return_ugc_email_data_profile_ARRAY($tmp_str);

                //
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: UGC DATA INPUT [EMAIL]
                $tmp_email_count = sizeof($tmp_email_ARRAY);
                for($i = 0; $i < $tmp_email_count; $i++){

                    $tmp_email_account_ARRAY = array();

                    if(isset($tmp_email_ARRAY['EMAIL'][$i])){

                        $tmp_has_email = true;

                        switch($data_profile){
                            case 'admin_email':

                                $tmp_email_account_ARRAY['DISPLAY_TOKEN'] = $this->oCRNRSTN->str_sanitize($tmp_email_ARRAY['EMAIL'][$i], 'email_private');
                                $tmp_email_account_ARRAY['EMAIL'] = $tmp_email_ARRAY['EMAIL'][$i];
                                $tmp_email_account_ARRAY['IS_ADMIN'] = 1;

                            break;
                            default:
                                //case 'account_email':
                                //case 'email':

                                $tmp_email_account_ARRAY['DISPLAY_TOKEN'] = $this->oCRNRSTN->str_sanitize($tmp_email_ARRAY['EMAIL'][$i], 'email_private');
                                $tmp_email_account_ARRAY['EMAIL'] = $tmp_email_ARRAY['EMAIL'][$i];
                                $tmp_email_account_ARRAY['IS_ADMIN'] = 0;

                            break;

                        }

                    }

                    if(isset($tmp_email_ARRAY['RECIPIENT_NAME'][$i])){

                        $tmp_email_account_ARRAY['NAME'] = $tmp_email_ARRAY['RECIPIENT_NAME'][$i];

                    }

                    if(isset($tmp_email_account_ARRAY['EMAIL'])){

                        //
                        // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: UGC DATA INPUT [EMAIL]
                        $this->oCRNRSTN->input_data_value($tmp_email_account_ARRAY, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                    }

                }

                if(!($tmp_has_email !== false)){

                    //
                    // # # C # R # N # R # S # T # N # : : # # # #
                    // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [EMAIL]
                    switch($data_profile){
                        case 'admin_email':

                            $tmp_err_str = 'CRNRSTN :: could not apply the CRNRSTN :: WEB ADMINISTRATION ' . $data_key . '. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        case 'account_email':

                            $tmp_err_str = 'CRNRSTN :: could not apply the CRNRSTN :: WEB ACCOUNT ' . $data_key . '. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        default:
                            //case 'email':

                            $tmp_err_str = 'CRNRSTN :: could not apply the ' . $data_key . '. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;

                    }

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    $this->oCRNRSTN->err_message_queue_push(NULL, $tmp_err_str);

                    return NULL;

                }

            break;

            case '__construct_mixed':
            case 'config_add_resource_mixed':

                $tmp_ddo_write = false;

                //
                // INITIALIZE THE CRNRSTN :: SYSTEM RESOURCES
                // VALIDATION PROFILE ARRAY.
                if(!($this->oCRNRSTN->isset_crnrstn('system_resource_profile_ARRAY') == true)){

                    $this->oCRNRSTN->set_crnrstn('system_resource_profile_ARRAY', array(
                    'CRNRSTN_log_silo_profile'                          => array('validation_profile' => '_log_silo_profile', 'data_type_family'              => 'CRNRSTN::RESOURCE::CONFIGURATION'),
                    'max_disk_storage_utilization'                      => array('validation_profile' => '_percentage', 'data_type_family'              => 'CRNRSTN::RESOURCE::DISK_STORAGE'),
                    'max_disk_storage_utilization_warning'              => array('validation_profile' => '_percentage', 'data_type_family'              => 'CRNRSTN::RESOURCE::DISK_STORAGE'),
                    'system_file_active_attributes_profile'             => array('validation_profile' => '_array', 'data_type_family'                   => 'CRNRSTN::RESOURCE::LOCAL_FILE_SYSTEM'),
                    'default_interact_ui_theme'                         => array('validation_profile' => '_theme', 'data_type_family'                   => 'CRNRSTN::RESOURCE::DEFAULT_THEME'),
                    'default_css_unit_length'                           => array('validation_profile' => '_css_unit_length', 'data_type_family'         => 'CRNRSTN::RESOURCE::DEFAULT_UNIT_CSS'),
                    'data_channel_init_sequence'                        => array('validation_profile' => '_channel_init_sequence', 'data_type_family'   => 'CRNRSTN::RESOURCE::MULTI_CHANNEL'),
                    'byte_reporting_units'                              => array('validation_profile' => '_byte_unit_system', 'data_type_family'        => 'CRNRSTN::RESOURCE::FILE_SYSTEM_REPORTING'),
                    'byte_reporting_precision'                          => array('validation_profile' => '_integer', 'data_type_family'                 => 'CRNRSTN::RESOURCE::FILE_SYSTEM_REPORTING'),
                    'hmac_hash_algorithm'                               => array('validation_profile' => '_hmac_lib', 'data_type_family'                => 'CRNRSTN::RESOURCE::GENERAL_SETTINGS'),
                    'openssl_cipher'                                    => array('validation_profile' => '_openssl_cipher_lib', 'data_type_family'      => 'CRNRSTN::RESOURCE::GENERAL_SETTINGS'),
                    'openssl_digest'                                    => array('validation_profile' => '_openssl_digest_lib', 'data_type_family'      => 'CRNRSTN::RESOURCE::GENERAL_SETTINGS'),

                    'permissions_chmod'                                 => array('validation_profile' => '_chmod', 'data_type_family'                   => 'CRNRSTN::RESOURCE::GENERAL_SETTINGS'),
                    'salt_length'                                       => array('validation_profile' => '_integer', 'data_type_family'                 => 'CRNRSTN::RESOURCE::GENERAL_SETTINGS'),

                    'ddo_serializable_data_types'                       => array('validation_profile' => '_ddo_serializable_data_types', 'data_type_family' => 'CRNRSTN::RESOURCE::MULTI_CHANNEL'),
                    'object_serializable_data_channels'                 => array('validation_profile' => '_object_serializable_channels', 'data_type_family' => 'CRNRSTN::RESOURCE::MULTI_CHANNEL'),

                    'get_parameters_system_data'                        => array('validation_profile' => '_array', 'data_type_family'                   => 'CRNRSTN::RESOURCE::GET_CHANNEL_PARAMS'),
                    'crnrstn_system_files_color_class_ARRAY'            => array('validation_profile' => '_array', 'data_type_family'                   => 'CRNRSTN::RESOURCE::LOCAL_FILE_SYSTEM'),
                    'crnrstn_system_files_line_weight_class_ARRAY'      => array('validation_profile' => '_array', 'data_type_family'                   => 'CRNRSTN::RESOURCE::LOCAL_FILE_SYSTEM'),
                    'mem_rpt_general_system_footer'                     => array('validation_profile' => '_array', 'data_type_family'                   => 'CRNRSTN::RESOURCE::REPORTING'),
                    'mem_rpt_plaid_performance'                         => array('validation_profile' => '_array', 'data_type_family'                   => 'CRNRSTN::RESOURCE::REPORTING'),
                    'mem_rpt_system_page_return_statistics_module'      => array('validation_profile' => '_array', 'data_type_family'                   => 'CRNRSTN::RESOURCE::REPORTING'),
                    'mem_rpt_mit_license_modal'                         => array('validation_profile' => '_array', 'data_type_family'                   => 'CRNRSTN::RESOURCE::REPORTING'),
                    'mem_rpt_cache_usage_report'                        => array('validation_profile' => '_array', 'data_type_family'                   => 'CRNRSTN::RESOURCE::REPORTING'),
                    'interact_ui_ttl'                                   => array('validation_profile' => '_array', 'data_type_family'                   => 'CRNRSTN::RESOURCE::GENERAL_SETTINGS'),
                    'interact_ui_month_abbrev'                          => array('validation_profile' => '_array', 'data_type_family'                   => 'CRNRSTN::RESOURCE::GENERAL_SETTINGS'),
                    'interact_ui_month'                                 => array('validation_profile' => '_array', 'data_type_family'                   => 'CRNRSTN::RESOURCE::GENERAL_SETTINGS'),
                    'interact_ui_day_abbrev'                            => array('validation_profile' => '_array', 'data_type_family'                   => 'CRNRSTN::RESOURCE::GENERAL_SETTINGS'),
                    'interact_ui_day'                                   => array('validation_profile' => '_array', 'data_type_family'                   => 'CRNRSTN::RESOURCE::GENERAL_SETTINGS'),
                    'resource_footer_append_spool_override'             => array('validation_profile' => '_array', 'data_type_family'                   => 'CRNRSTN::RESOURCE::ASSET_INTEGRATIONS'),
                    'resource_head_append_spool_override'               => array('validation_profile' => '_array', 'data_type_family'                   => 'CRNRSTN::RESOURCE::ASSET_INTEGRATIONS'),
                    'system_file_max_ui_pageview_cnt'                   => array('validation_profile' => '_array', 'data_type_family'                   => 'CRNRSTN::RESOURCE::FILE_SYSTEM'),

                    'default_anchor_target'                             => array('validation_profile' => '_dom_tag_anchor', 'data_type_family'          => 'CRNRSTN::RESOURCE::HTML_DOM'),

                    'debug_logging_output_channel'                      => array('validation_profile' => '_dom_logging_channel', 'data_type_family'     => 'CRNRSTN::RESOURCE::GENERAL_SETTINGS'),
                    'header_response_option_cache_control'              => array('validation_profile' => '_string', 'data_type_family'                  => 'CRNRSTN::RESOURCE::GENERAL_SETTINGS'),
                    'header_response_option_x_frame_options'            => array('validation_profile' => '_string', 'data_type_family'                  => 'CRNRSTN::RESOURCE::GENERAL_SETTINGS'),
                    'crnrstn_system_404_image_url_replace'              => array('validation_profile' => '_string', 'data_type_family'                  => 'CRNRSTN::RESOURCE::HTTP_IMAGES'),
                    'override_interact_theme_sprite_icon_height'                                        => array('validation_profile'                   => '_string', 'data_type_family' => 'CRNRSTN::RESOURCE::SPRITE_ICON'),
                    'override_interact_theme_sprite_icon_background_color'                              => array('validation_profile'                   => '_string', 'data_type_family' => 'CRNRSTN::RESOURCE::SPRITE_ICON'),
                    'override_interact_theme_sprite_icon_mouseout_effect_dimmed_color'                  => array('validation_profile'                   => '_string', 'data_type_family' => 'CRNRSTN::RESOURCE::SPRITE_ICON'),
                    'override_interact_theme_sprite_icon_mouseout_effect_dimmed_color_opacity'          => array('validation_profile'                   => '_string', 'data_type_family' => 'CRNRSTN::RESOURCE::SPRITE_ICON'),
                    'override_interact_theme_sprite_icon_mouseover_effect_brighten_color_opacity'       => array('validation_profile'                   => '_string', 'data_type_family' => 'CRNRSTN::RESOURCE::SPRITE_ICON'),
                    'override_interact_theme_sprite_icon_mouseover_effect_magnification_zoom_percent'   => array('validation_profile'                   => '_string', 'data_type_family' => 'CRNRSTN::RESOURCE::SPRITE_ICON'),

                    'share_module_facebook_media_is_active'                         => array('validation_profile'                                       => '_boolean', 'data_type_family' => 'CRNRSTN::RESOURCE::SOCIAL'),
                    'share_module_linkedin_media_is_active'                         => array('validation_profile'                                       => '_boolean', 'data_type_family' => 'CRNRSTN::RESOURCE::SOCIAL'),
                    'share_module_reddit_media_is_active'                           => array('validation_profile'                                       => '_boolean', 'data_type_family' => 'CRNRSTN::RESOURCE::SOCIAL'),
                    'share_module_twitter_media_is_active'                          => array('validation_profile'                                       => '_boolean', 'data_type_family' => 'CRNRSTN::RESOURCE::SOCIAL'),
                    'share_component_is_active'                                     => array('validation_profile'                                       => '_boolean', 'data_type_family' => 'CRNRSTN::RESOURCE::DOCUMENTATION_DEFAULTS'),
                    'mouse_hover_color_affect_is_active'                            => array('validation_profile'                                       => '_boolean', 'data_type_family' => 'CRNRSTN::RESOURCE::SPRITE_ICON'),
                    'mouse_hover_zoom_affect_is_active'                             => array('validation_profile'                                       => '_boolean', 'data_type_family' => 'CRNRSTN::RESOURCE::SPRITE_ICON'),
                    'override_interact_theme_sprite_icon_thirdparty_tm_is_active'   => array('validation_profile'                                       => '_boolean', 'data_type_family' => 'CRNRSTN::RESOURCE::SPRITE_ICON')

                    ));

                }

                if($tmp_validation_profile = $this->oCRNRSTN->is_resource($data_key, $data_type_family)){

                    //
                    // # # C # R # N # R # S # T # N # : : # # # #
                    // CRNRSTN :: UGC DATA VALIDATION [MIXED]
                    switch($tmp_validation_profile){
                        case '_log_silo_profile':
                            // CRNRSTN_log_silo_profile

                            //
                            // CRNRSTN_log_silo_profile IS A UGC CUSTOM STRING OR INTEGER THAT
                            // IS USED TO GROUP ERROR LOGS FOR OUTPUT RETURN AS A BATCH OR SILO.
                            $this->oCRNRSTN->set_crnrstn('CRNRSTN_log_silo_profile', $data);

                        break;
                        case '_object_serializable_channels':
                            //if(isset(self::$object_serializable_channels_ARRAY[$channel])){

                            //
                            // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // DDO SETTINGS AND CONFIGURATION OVERRIDE.
                            //self::$object_serializable_channels_ARRAY = $data;
                            $this->oCRNRSTN->set_crnrstn('object_serializable_channels_ARRAY',  $data);

                        break;
                        case '_ddo_serializable_data_types':
                            //if(isset(self::$ddo_serializable_data_types_ARRAY[$data_type])){

                            //
                            // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // DDO SETTINGS AND CONFIGURATION OVERRIDE.
                            //self::$ddo_serializable_data_types_ARRAY = $data;
                            $this->oCRNRSTN->set_crnrstn('ddo_serializable_data_types_ARRAY',  $data);

                        break;
                        case '_dom_logging_channel':
                            //'debug_logging_output_channel', 'DOM', 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');              // where CHANNEL = ['CONSOLE', 'DOM', 'ALERT'];

                            //
                            // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // CRNRSTN :: UGC DATA INPUT [MIXED]
                            $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                            return $tmp_output;

                        break;
                        case '_dom_tag_anchor':
                            //'default_anchor_target', '_blank', 'CRNRSTN::RESOURCE::HTML_DOM');

                            //
                            // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // CRNRSTN :: UGC DATA INPUT [MIXED]
                            $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                            return $tmp_output;

                        break;
                        case '_boolean':

                            switch($data_key){
                                case 'share_module_facebook_media_is_active':
                                    //'share_module_facebook_media_is_active', true, 'CRNRSTN::RESOURCE::SOCIAL');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'share_module_linkedin_media_is_active':
                                    //'share_module_linkedin_media_is_active', true, 'CRNRSTN::RESOURCE::SOCIAL');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'share_module_reddit_media_is_active':
                                    //'share_module_reddit_media_is_active', true, 'CRNRSTN::RESOURCE::SOCIAL');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'share_module_twitter_media_is_active':
                                    //'share_module_twitter_media_is_active', true, 'CRNRSTN::RESOURCE::SOCIAL');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'share_component_is_active':
                                    //'share_component_is_active', true, 'CRNRSTN::RESOURCE::DOCUMENTATION_DEFAULTS');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'mouse_hover_color_affect_is_active':
                                    //'mouse_hover_color_affect_is_active', true, 'CRNRSTN::RESOURCE::SPRITE_ICON');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'mouse_hover_zoom_affect_is_active':
                                    //'mouse_hover_zoom_affect_is_active', true, 'CRNRSTN::RESOURCE::SPRITE_ICON');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'override_interact_theme_sprite_icon_thirdparty_tm_is_active':
                                    //$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'override_interact_theme_sprite_icon_thirdparty_tm_is_active', 1, 'CRNRSTN::RESOURCE::SPRITE_ICON');     // [1=ON, 0=OFF]

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                default:

                                    error_log(__LINE__ . ' crnrstn MISSING SWITCH CASE[' . $data_key . ']. $data_profile[' . $data_profile . '].');

                                break;

                            }

                        break;
                        case'_string':

                            switch($data_key){
                                case 'header_response_option_cache_control':
                                    //'header_response_option_cache_control', 'Cache-Control: public, max-age=31536000', 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'header_response_option_x_frame_options':
                                    //'header_response_option_x_frame_options', 'X-Frame-Options: SAMEORIGIN', 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'crnrstn_system_404_image_url_replace':
                                    //$tmp_404_image_url_replace = $this->return_creative('CRNRSTN_LOGO', );
                                    //'crnrstn_system_404_image_url_replace', $tmp_404_image_url_replace, 'CRNRSTN::RESOURCE::HTTP_IMAGES');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'override_interact_theme_sprite_icon_height':
                                    //'override_interact_theme_sprite_icon_height', '', 'CRNRSTN::RESOURCE::SPRITE_ICON');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'override_interact_theme_sprite_icon_background_color':
                                    //'override_interact_theme_sprite_icon_background_color', NULL, 'CRNRSTN::RESOURCE::SPRITE_ICON');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'override_interact_theme_sprite_icon_mouseout_effect_dimmed_color':
                                    //'override_interact_theme_sprite_icon_mouseout_effect_dimmed_color', NULL, 'CRNRSTN::RESOURCE::SPRITE_ICON');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'override_interact_theme_sprite_icon_mouseout_effect_dimmed_color_opacity':
                                    //'override_interact_theme_sprite_icon_mouseout_effect_dimmed_color_opacity', NULL, 'CRNRSTN::RESOURCE::SPRITE_ICON');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'override_interact_theme_sprite_icon_mouseover_effect_brighten_color_opacity':
                                    //'override_interact_theme_sprite_icon_mouseover_effect_brighten_color_opacity', NULL, 'CRNRSTN::RESOURCE::SPRITE_ICON');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'override_interact_theme_sprite_icon_mouseover_effect_magnification_zoom_percent':
                                    //'override_interact_theme_sprite_icon_mouseover_effect_magnification_zoom_percent', NULL, 'CRNRSTN::RESOURCE::SPRITE_ICON');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                default:

                                    error_log(__LINE__ . ' crnrstn MISSING SWITCH CASE[' . $data_key . ']. $data_profile[' . $data_profile . '].');

                                break;

                            }

                        break;
                        case '_chmod':

                            $tmp_data = octdec(str_pad($data, 4, '0', STR_PAD_LEFT));
                            $tmp_data = (int) $tmp_data;

                            //
                            // SOURCE :: https://stackoverflow.com/questions/50994126/php-how-to-check-if-a-valid-chmod-mode
                            // COMMENT :: https://stackoverflow.com/a/50994207
                            // AUTHOR :: Philipp :: https://stackoverflow.com/users/1043150/philipp
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // CRNRSTN :: UGC DATA VALIDATION [_chmod]
                            if(!(($tmp_data >= 0) && ($tmp_data <= 0777))){

                                //
                                // WE DO NOT HAVE A VALID CHMOD VALUE.
                                $tmp_force_data_err = true;

                                $tmp_data = $this->oCRNRSTN->get_crnrstn('permissions_chmod');
                                $tmp_err_str = 'CRNRSTN :: could not locate the provided chmod permissions as within the range of 0 and 777. The system permissions have been manually set to, (' . $this->oCRNRSTN->gettype($tmp_data) . ') ' . strval($tmp_data) . '. ' . $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                            }

                            //
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [_chmod]
                            if($tmp_force_data_err == true){

                                $this->oCRNRSTN->error_log($tmp_err_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                            }

                        break;
                        case '_openssl_cipher_lib':

                            $tmp_cipher = strtolower(trim($data));

                            //
                            // PERSIST THE RESULTS OF THIS COSTLY DECISION IN SESSION.
                            if(!$this->oCRNRSTN->isset_resource('data_value', $data_key, $data_type_family, CRNRSTN_CHANNEL_SESSION) == true){

                                //
                                // DO WE NEED TO [RUNTIME] LOAD THE
                                // SERVER OPENSSL CIPHERS?
                                if(!($this->oCRNRSTN->isset_crnrstn('openssl_ARRAY', 'CIPHER') == true)){

                                    //
                                    // LOAD AVAILABLE (ON THE SERVER)
                                    // OPENSSL CIPHERS.
                                    $this->oCRNRSTN->set_crnrstn('openssl_ARRAY', $this->oCRNRSTN->openssl_get_cipher_methods(false, false), 'CIPHER');
                                    $this->oCRNRSTN->set_crnrstn('openssl_ARRAY', $tmp_cipher, 'ISACTIVE', 'CIPHER', $data_key, $data_type_family);

                                    //
                                    // IS SESSION FIT WITH THE CACHE DATA?
                                    if(!$this->oCRNRSTN->isset_resource('data_value', $data_key, $data_type_family, CRNRSTN_CHANNEL_SESSION) == true){

                                        $tmp_force_data_err = true;
                                        $tmp_graceful_err = false;

                                        //
                                        // LOAD A CUSTOM CULLED SET OF BOUTIQUE OPENSSL
                                        // CIPHERS TO GET THE BEST RESULTS FOR THE SELECTION
                                        // OF A SYSTEM DEFAULT FROM WHAT ACTUALLY IS LOADED
                                        // ON THIS SERVER.
                                        $tmp_system_openssl_cipher_preferred_ARRAY = $this->oCRNRSTN->get_crnrstn('system_openssl_cipher_preferred_ARRAY');
                                        foreach($tmp_system_openssl_cipher_preferred_ARRAY as $openssl_cipher_index => $openssl_cipher_name){

                                            if($tmp_result = $this->oCRNRSTN->isset_crnrstn('openssl_ARRAY', 'CIPHER', 'OPTIONS', 'ISACTIVE', strtolower($openssl_cipher_name))){

                                                //
                                                // USE THIS SYSTEM VERIFIED AND
                                                // COMPATIBLE ALGORITHM.
                                                $tmp_cipher = $openssl_cipher_name;

                                                $tmp_graceful_err = true;

                                                break 1;

                                            }

                                        }

                                        //
                                        // # # C # R # N # R # S # T # N # : : # # # #
                                        // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [_openssl_cipher_lib]
                                        if($tmp_graceful_err == true){

                                            //
                                            // SET ENVIRONMENT OPENSSL PROFILE FROM LIST OF PREFERRED.
                                            $this->oCRNRSTN->set_openssl_cipher_profile($tmp_cipher, $data_key, $data_type_family);

                                            $tmp_err_str = 'CRNRSTN :: could not recognize the provided OpenSSL cipher, ' .
                                                strval($data) . ' , that is to be used when encrypting and decrypting data. The system OpenSSL cipher has been manually set to, "' .
                                                $tmp_cipher . '". ' . $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                        }else{

                                            //
                                            // SET THE ENVIRONMENT OPENSSL PROFILE
                                            // FROM THE CRNRSTN :: DEFAULT.
                                            $this->oCRNRSTN->set_openssl_cipher_profile(NULL, $data_key, $data_type_family);

                                            $tmp_err_str = 'CRNRSTN :: could not recognize the provided OpenSSL cipher, ' .
                                                strval($data) . ' , that is to be used when encrypting and decrypting data. No OpenSSL cipher could be selected. ' .
                                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                        }

                                        //error_log(__LINE__ . ' crnrstn $tmp_cipher[' . $tmp_cipher . ']. $data_key[' . $data_key . ']. self::$openssl_ARRAY[' . print_r(self::$openssl_ARRAY['CIPHER']['OPTIONS']['ISACTIVE'], true) . '].');

                                        //
                                        // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                        // # # C # R # N # R # S # T # N # : : # # # #
                                        // CRNRSTN :: UGC DATA INPUT [_openssl_cipher_lib]
                                        $tmp_output = $this->oCRNRSTN->input_data_value($tmp_cipher, $data_key, $data_type_family, $index, CRNRSTN_AUTHORIZE_SESSION, $ttl, $spool_resource, $env_key);
                                        $this->oCRNRSTN->input_data_value($this->oCRNRSTN->get_crnrstn('openssl_ARRAY', 'CIPHER', 'OPTIONS', 'ISACTIVE', strtolower(trim($tmp_cipher))), $data_key . '_index', $data_type_family, $index, CRNRSTN_AUTHORIZE_SESSION, $ttl, $spool_resource, $env_key);

                                        $tmp_ddo_write = true;

                                    }

                                }else{

                                    //
                                    // SET SESSION FROM RUNTIME.
                                    //$tmp_cipher = self::$openssl_ARRAY['CIPHER']['DEFAULT']['NAME'];
                                    $tmp_cipher = $this->oCRNRSTN->get_crnrstn('openssl_ARRAY', 'CIPHER', 'DEFAULT', 'NAME');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [_openssl_cipher_lib]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_cipher, $data_key, $data_type_family, $index, CRNRSTN_AUTHORIZE_SESSION, $ttl, $spool_resource, $env_key);
                                    //$this->oCRNRSTN->input_data_value(self::$openssl_ARRAY['CIPHER']['OPTIONS']['ISACTIVE'][strtolower(trim($tmp_cipher))], $data_key . '_index', $data_type_family, $index, CRNRSTN_AUTHORIZE_SESSION, $ttl, $spool_resource, $env_key);
                                    $this->oCRNRSTN->input_data_value($this->oCRNRSTN->get_crnrstn('openssl_ARRAY', 'CIPHER', 'OPTIONS', 'ISACTIVE', strtolower(trim($tmp_cipher))), $data_key . '_index', $data_type_family, $index, CRNRSTN_AUTHORIZE_SESSION, $ttl, $spool_resource, $env_key);

                                    $tmp_ddo_write = true;

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) POWER METHODS.
                                    // -----
                                    //      is_resource_serialization_active($data_type, $channel);
                                    //      $tmp_ = $this->oCRNRSTN->get_resource('err_reporting_profile', 0, 'CRNRSTN::RESOURCE::CONFIGURATION');
                                    //      $tmp_ = $this->get_resource_count('err_reporting_profile', 'CRNRSTN::RESOURCE::CONFIGURATION');
                                    //      if($this->isset_resource('data_value', 'err_reporting_profile', 'CRNRSTN::RESOURCE::CONFIGURATION') == true)

                                }

                            }else{

                                //
                                // THIS CRNRSTN :: DDO SESSION POWERED INITIALIZATION
                                // BY-PASSES SERVER SETTING LOOKUP AND PROCESSING.
                                //self::$openssl_ARRAY['CIPHER']['DEFAULT'][CRNRSTN_INTEGER] = $this->oCRNRSTN->get_resource($data_key . '_index', 0, $data_type_family, CRNRSTN_AUTHORIZE_SESSION);
                                //$tmp_cipher = self::$openssl_ARRAY['CIPHER']['DEFAULT']['NAME'] = $this->oCRNRSTN->get_resource($data_key, 0, $data_type_family, CRNRSTN_AUTHORIZE_SESSION);
                                $this->oCRNRSTN->set_crnrstn('openssl_ARRAY', $this->oCRNRSTN->get_resource($data_key . '_index', 0, $data_type_family, CRNRSTN_AUTHORIZE_SESSION), 'CIPHER', 'DEFAULT', CRNRSTN_INTEGER);
                                $this->oCRNRSTN->set_crnrstn('openssl_ARRAY', $this->oCRNRSTN->get_resource($data_key, 0, $data_type_family, CRNRSTN_AUTHORIZE_SESSION), 'CIPHER', 'DEFAULT', 'NAME');

                                //$tmp_cipher = $this->oCRNRSTN->get_resource($data_key, 0, $data_type_family, CRNRSTN_AUTHORIZE_SESSION);

                            }

                            //
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [_openssl_cipher_lib]
                            if($tmp_force_data_err == true){

                                $this->oCRNRSTN->error_log($tmp_err_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                            }

                        break;
                        case '_openssl_digest_lib':

                            $tmp_digest = strtolower(trim($data));

                            //
                            // PERSIST THE RESULTS OF THIS
                            // COSTLY DECISION IN SESSION.
                            if(!$this->oCRNRSTN->isset_resource('data_value', $data_key, $data_type_family, CRNRSTN_CHANNEL_SESSION) == true){

                                //
                                // DO WE NEED TO [RUNTIME] LOAD
                                // THE SERVER OPENSSL CIPHERS?
                                if(!($this->oCRNRSTN->isset_crnrstn('openssl_ARRAY', 'DIGEST_METHOD') == true)){

//                                    if(!isset($this->oCRNRSTN_ENV)){
//
//                                        //
//                                        // INITIALIZATION OF CRNRSTN :: ENVIRONMENT.
//                                        $this->oCRNRSTN_ENV = new crnrstn_environment($this);
//
//                                        //
//                                        // INITIALIZATION OF CRNRSTN :: USER.
//                                        $this->oCRNRSTN_USR = $this->oCRNRSTN_ENV->return_ENV_oCRNRSTN_USR();
//
//                                    }

                                    /*
                                    [Tue Oct 31 12:10:41.717870 2023] [:error] [pid 83474] [client 172.16.225.1:58155] 11570 crnrstn
                                    $tmp_data[aes-128-ocb].
                                    $data_key[openssl_cipher].
                                    self::$openssl_ARRAY[
                                        Array\n(\n
                                            [DEFAULT] => Array\n        (\n
                                                [INTEGER] => -1\n
                                                [NAME] => aes-128-ocb\n        )\n\n
                                            [OPTIONS] => Array\n        (\n
                                                [SERVER] => Array\n                (\n
                                                        [0] => blake2b512\n
                                                        [1] => blake2s256\n
                                                        [2] => md4\n
                                                        [3] => ripemd160\n
                                                        [4] => sha1\n                    [5] => sha224\n
                                                        [6] => sha256\n                    [7] => sha3-224\n
                                                        [8] => sha3-256\n                    [9] => sha3-384\n
                                                        [10] => sha3-512\n                    [11] => sha384\n
                                                        [12] => sha512\n                    [13] => sha512-224\n
                                                        [14] => sha512-256\n                    [15] => shake128\n
                                                        [16] => shake256\n                    [17] => sm3\n
                                                        [18] => whirlpool\n                    [19] => RSA-MD4\n                    [20] => RSA-MD5\n                    [21] => RSA-RIPEMD160\n                    [22] => RSA-SHA1\n                    [23] => RSA-SHA1-2\n                    [24] => RSA-SHA224\n                    [25] => RSA-SHA256\n                    [26] => RSA-SHA3-224\n                    [27] => RSA-SHA3-256\n                    [28] => RSA-SHA3-384\n                    [29] => RSA-SHA3-512\n                    [30] => RSA-SHA384\n                    [31] => RSA-SHA512\n                    [32] => RSA-SHA512/224\n                    [33] => RSA-SHA512/256\n                    [34] => RSA-SM3\n                    [35] => id-rsassa-pkcs1-v1_5-with-sha3-224\n                    [36] => id-rsassa-pkcs1-v1_5-with-sha3-256\n                    [37] => id-rsassa-pkcs1-v1_5-with-sha3-384\n                    [38] => id-rsassa-pkcs1-v1_5-with-sha3-512\n                    [39] => md4WithRSAEncryption\n                    [40] => md5WithRSAEncryption\n                    [41] => ripemd\n                    [42] => ripemd160WithRSA\n                    [43] => rmd160\n                    [44] => sha1WithRSAEncryption\n                    [45] => sha224WithRSAEncryption\n                    [46] => sha256WithRSAEncryption\n                    [47] => sha384WithRSAEncryption\n                    [48] => sha512-224WithRSAEncryption\n                    [49] => sha512-256WithRSAEncryption\n                    [50] => sha512WithRSAEncryption\n                    [51] => sm3WithRSAEncryption\n                    [52] => ssl3-md5\n                    [53] => ssl3-sha1\n                )\n\n            [ISACTIVE] => Array\n                (\n                    [blake2b512] => 0\n                    [blake2s256] => 1\n                    [md4] => 2\n                    [ripemd160] => 3\n                    [sha1] => 4\n                    [sha224] => 5\n                    [sha256] => 6\n                    [sha3-224] => 7\n                    [sha3-256] => 8\n                    [sha3-384] => 9\n                    [sha3-512] => 10\n                    [sha384] => 11\n                    [sha512] => 12\n                    [sha512-224] => 13\n                    [sha512-256] => 14\n                    [shake128] => 15\n                    [shake256] => 16\n                    [sm3] => 17\n                    [whirlpool] => 18\n                    [rsa-md4] => 19\n                    [rsa-md5] => 20\n                    [rsa-ripemd160] => 21\n                    [rsa-sha1] => 22\n                    [rsa-sha1-2] => 23\n                    [rsa-sha224] => 24\n                    [rsa-sha256] => 25\n                    [rsa-sha3-224] => 26\n                    [rsa-sha3-256] => 27\n                    [rsa-sha3-384] => 28\n                    [rsa-sha3-512] => 29\n                    [rsa-sha384] => 30\n                    [rsa-sha512] => 31\n                    [rsa-sha512/224] => 32\n                    [rsa-sha512/256] => 33\n                    [rsa-sm3] => 34\n                    [id-rsassa-pkcs1-v1_5-with-sha3-224] => 35\n                    [id-rsassa-pkcs1-v1_5-with-sha3-256] => 36\n                    [id-rsassa-pkcs1-v1_5-with-sha3-384] => 37\n                    [id-rsassa-pkcs1-v1_5-with-sha3-512] => 38\n                    [md4withrsaencryption] => 39\n                    [md5withrsaencryption] => 40\n                    [ripemd] => 41\n                    [ripemd160withrsa] => 42\n                    [rmd160] => 43\n                    [sha1withrsaencryption] => 44\n                    [sha224withrsaencryption] => 45\n                    [sha256withrsaencryption] => 46\n                    [sha384withrsaencryption] => 47\n                    [sha512-224withrsaencryption] => 48\n
                                                        [sha512-256withrsaencryption] => 49\n
                                                        [sha512withrsaencryption] => 50\n
                                                        [sm3withrsaencryption] => 51\n                    [ssl3-md5] => 52\n                    [ssl3-sha1] => 53\n                )\n\n        )\n\n)\n].

                                    */

                                    //
                                    // LOAD AVAILABLE (ON THE SERVER)
                                    // OPENSSL DIGEST METHODS.
                                    $tmp_openssl_get_md_methods_ARRAY = $this->oCRNRSTN->set_crnrstn('openssl_ARRAY', $this->oCRNRSTN->openssl_get_md_methods(), 'DIGEST_METHOD');

                                    //
                                    // UPDATE THE INTERNAL REFERENCE DATA STRUCTURE PER THE SERVER'S
                                    // AVAILABLE OPENSSL CIPHERS AND THE INPUT DATA.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA VALIDATION [_openssl_digest_lib]
                                    foreach((array) $tmp_openssl_get_md_methods_ARRAY as $digest_index => $digest_name){
                                        // TODO :: IS IT A GUARANTEE THAT THE SERVER HASH NAME WILL ALWAYS BE LOWERCASE?

                                        //error_log(__LINE__ . ' crnrstn [\'OPTIONS\'][\'SERVER\'] openssl_digest $digest_name[' . $digest_name . '].');

                                        $tmp_lower_hash = strtolower($digest_name);
                                        //self::$openssl_ARRAY['DIGEST_METHOD']['OPTIONS']['ISACTIVE'][$tmp_lower_hash] = $digest_index;

                                        //
                                        // STORE THIS OpenSSL CIPHER AS BEING
                                        // ACTIVE IN THE SYSTEM.
                                        $this->oCRNRSTN->set_crnrstn('openssl_ARRAY', $digest_index, 'DIGEST_METHOD', 'OPTIONS', 'ISACTIVE', $tmp_lower_hash);

                                        if($tmp_lower_hash == $tmp_digest){

                                            $tmp_digest = $digest_name;

                                            //self::$openssl_cipher_int = $digest_index;
                                            //self::$openssl_ARRAY['DIGEST_METHOD']['DEFAULT'][CRNRSTN_INTEGER] = $digest_index;
                                            //self::$openssl_ARRAY['DIGEST_METHOD']['DEFAULT']['NAME'] = $tmp_digest = $digest_name;

                                            $this->oCRNRSTN->set_crnrstn('openssl_cipher_int', $digest_index);
                                            $this->oCRNRSTN->set_crnrstn('openssl_ARRAY', $digest_index, 'DIGEST_METHOD', 'DEFAULT', CRNRSTN_INTEGER);
                                            $this->oCRNRSTN->set_crnrstn('openssl_ARRAY', $digest_name, 'DIGEST_METHOD', 'DEFAULT', 'NAME');

                                            //
                                            // SET ENVIRONMENT OPENSSL PROFILE.
                                            $this->oCRNRSTN->set_openssl_digest_profile($tmp_digest, $data_key, $data_type_family);

                                            //
                                            // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                            // # # C # R # N # R # S # T # N # : : # # # #
                                            // CRNRSTN :: UGC DATA INPUT [_openssl_digest_lib]
                                            $tmp_output = $this->oCRNRSTN->add_resource($data_key, $tmp_digest, $data_type_family, CRNRSTN_AUTHORIZE_SESSION, 0);
                                            $this->oCRNRSTN->add_resource($data_key . '_index', $digest_index, $data_type_family, CRNRSTN_AUTHORIZE_SESSION, 0);

                                            $tmp_ddo_write = true;

                                        }

                                    }

                                    if(!$this->oCRNRSTN->isset_resource('data_value', $data_key, $data_type_family, CRNRSTN_CHANNEL_SESSION) == true){

                                        $tmp_force_data_err = true;
                                        $tmp_graceful_err = false;

                                        //
                                        // LOAD A CUSTOM CULLED SET OF BOUTIQUE OPENSSL
                                        // DIGEST METHODS TO GET THE BEST RESULTS FOR
                                        // THE MANUAL SELECTION OF A SYSTEM DEFAULT FROM
                                        // WHAT ACTUALLY IS LOADED ON THIS SERVER.
                                        $tmp_system_openssl_digest_preferred_ARRAY = $this->oCRNRSTN->get_crnrstn('system_openssl_digest_preferred_ARRAY', 'DIGEST_METHOD', 'OPTIONS', 'SERVER');
                                        foreach($tmp_system_openssl_digest_preferred_ARRAY as $openssl_digest_index => $openssl_digest_name){

                                            if($this->oCRNRSTN->isset_crnrstn('openssl_ARRAY', 'DIGEST_METHOD', 'OPTIONS', 'ISACTIVE', strtolower($openssl_digest_index)) == true){

                                                //
                                                // USE THIS SYSTEM VERIFIED AND
                                                // COMPATIBLE ALGORITHM.
                                                $tmp_digest = $openssl_digest_name;

                                                $tmp_graceful_err = true;

                                                break 1;

                                            }

                                        }

                                        //
                                        // # # C # R # N # R # S # T # N # : : # # # #
                                        // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [_openssl_digest_lib]
                                        if($tmp_graceful_err == true){

                                            //
                                            // SET ENVIRONMENT OPENSSL DIGEST
                                            // PROFILE FROM LIST OF PREFERRED.
                                            $this->oCRNRSTN->set_openssl_digest_profile($tmp_digest, $data_key, $data_type_family);
                                            $tmp_err_str = 'CRNRSTN :: could not recognize the provided OpenSSL digest, ' .
                                                strval($data) . ' , that is to be used when encrypting and decrypting data. The system OpenSSL v' .
                                                $this->oCRNRSTN->version_openssl() . ' digest has been manually set to, "' .
                                                $tmp_digest . '". ' . $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                        }else{

                                            //
                                            // SET ENVIRONMENT OPENSSL DIGEST
                                            // PROFILE FROM DEFAULT.
                                            $this->oCRNRSTN->set_openssl_digest_profile(NULL, $data_key, $data_type_family);

                                            $tmp_err_str = 'CRNRSTN :: could not recognize the provided OpenSSL digest, ' . strval($data) .
                                                ' , that is to be used when encrypting and decrypting data. No OpenSSL digest could be selected. ' .
                                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                        }

                                        //error_log(__LINE__ . ' crnrstn $tmp_digest[' . $tmp_digest . ']. $data_key[' . $data_key . ']. self::$openssl_ARRAY[' . print_r(self::$openssl_ARRAY['DIGEST_METHOD']['OPTIONS']['ISACTIVE'], true) . '].');

                                        //
                                        // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                        // # # C # R # N # R # S # T # N # : : # # # #
                                        // CRNRSTN :: UGC DATA INPUT [_openssl_digest_lib]
                                        $tmp_output = $this->oCRNRSTN->input_data_value($tmp_digest, $data_key, $data_type_family, $index, CRNRSTN_AUTHORIZE_SESSION, $ttl, $spool_resource, $env_key);
                                        //$this->oCRNRSTN->input_data_value(self::$openssl_ARRAY['DIGEST_METHOD']['OPTIONS']['ISACTIVE'][strtolower(trim($tmp_digest))], $data_key . '_index', $data_type_family, $index, CRNRSTN_AUTHORIZE_SESSION, $ttl, $spool_resource, $env_key);
                                        $this->oCRNRSTN->input_data_value($this->oCRNRSTN->get_crnrstn('openssl_ARRAY', 'DIGEST_METHOD', 'OPTIONS', 'ISACTIVE', strtolower(trim($tmp_digest))), $data_key . '_index', $data_type_family, $index, CRNRSTN_AUTHORIZE_SESSION, $ttl, $spool_resource, $env_key);

                                        $tmp_ddo_write = true;

                                    }

                                }else{

                                    //
                                    // GET DIGEST FROM RUNTIME.
                                    $tmp_digest = $this->oCRNRSTN->get_crnrstn('openssl_ARRAY', 'DIGEST_METHOD', 'DEFAULT', 'NAME');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [_openssl_digest_lib]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_digest, $data_key, $data_type_family, $index, CRNRSTN_AUTHORIZE_SESSION, $ttl, $spool_resource, $env_key);
                                    //$this->oCRNRSTN->input_data_value(self::$openssl_ARRAY['DIGEST_METHOD']['OPTIONS']['ISACTIVE'][strtolower(trim($tmp_digest))], $data_key . '_index', $data_type_family, $index, CRNRSTN_AUTHORIZE_SESSION, $ttl, $spool_resource, $env_key);
                                    $this->oCRNRSTN->input_data_value($this->oCRNRSTN->get_crnrstn('openssl_ARRAY', 'DIGEST_METHOD', 'OPTIONS', 'ISACTIVE', strtolower(trim($tmp_digest))), $data_key . '_index', $data_type_family, $index, CRNRSTN_AUTHORIZE_SESSION, $ttl, $spool_resource, $env_key);

                                    $tmp_ddo_write = true;

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) POWER METHODS.
                                    // -----
                                    // is_resource_serialization_active($data_type, $channel);
                                    // $tmp_ = $this->oCRNRSTN->get_resource('err_reporting_profile', 0, 'CRNRSTN::RESOURCE::CONFIGURATION');
                                    // $tmp_ = $this->get_resource_count('err_reporting_profile', 'CRNRSTN::RESOURCE::CONFIGURATION');
                                    // if($this->isset_resource('data_value', 'err_reporting_profile', 'CRNRSTN::RESOURCE::CONFIGURATION') == true)

                                }

                            }else{

                                //
                                // THIS CRNRSTN :: DDO SESSION POWERED INITIALIZATION
                                // BY-PASSES SERVER SETTING LOOKUP AND PROCESSING.
                                //self::$openssl_ARRAY['DIGEST_METHOD']['DEFAULT'][CRNRSTN_INTEGER] = $this->oCRNRSTN->get_resource($data_key . '_index', 0, $data_type_family, CRNRSTN_AUTHORIZE_SESSION);
                                $this->oCRNRSTN->set_crnrstn('openssl_ARRAY', $this->oCRNRSTN->get_resource($data_key . '_index', 0, $data_type_family, CRNRSTN_AUTHORIZE_SESSION), 'DIGEST_METHOD', 'DEFAULT', CRNRSTN_INTEGER);
                                //$tmp_digest = self::$openssl_ARRAY['DIGEST_METHOD']['DEFAULT']['NAME'] = $this->oCRNRSTN->get_resource($data_key, 0, $data_type_family, CRNRSTN_AUTHORIZE_SESSION);
                                $tmp_digest = $this->oCRNRSTN->set_crnrstn('openssl_ARRAY', $this->oCRNRSTN->get_resource($data_key, 0, $data_type_family, CRNRSTN_AUTHORIZE_SESSION), 'DIGEST_METHOD', 'DEFAULT', 'NAME');

                            }

                            //
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [_openssl_digest_lib]
                            if($tmp_force_data_err == true){

                                $this->oCRNRSTN->error_log($tmp_err_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                            }

                        break;
                        case '_hmac_lib':

                            $tmp_hmac = strtolower(trim($data));

                            //
                            // PERSIST THE RESULTS OF THIS COSTLY DECISION IN SESSION.
                            if(!$this->oCRNRSTN->isset_resource('data_value', $data_key, $data_type_family, CRNRSTN_CHANNEL_SESSION) == true){

                                //
                                // DO WE NEED TO [RUNTIME] LOAD THE SERVER HMAC LIBRARY?
                                //if(self::$hmac_hash_algorithm_ARRAY['DEFAULT'][CRNRSTN_INTEGER] == -1){
                                if(!($this->oCRNRSTN->isset_crnrstn('hmac_hash_algorithm_ARRAY') == true)){

                                    //
                                    // LOAD AVAILABLE (ON THE SERVER)
                                    // HMAC HASH ALGORITHMS.
                                    //self::$hmac_hash_algorithm_ARRAY['OPTIONS']['SERVER'] = hash_algos();
                                    $tmp_hmac_hash_algorithm_ARRAY = $this->oCRNRSTN->set_crnrstn('hmac_hash_algorithm_ARRAY', hash_algos());

                                    //
                                    // UPDATE THE INTERNAL REFERENCE DATA STRUCTURE PER THE SERVER'S
                                    // AVAILABLE HMAC ALGORITHMS AND THE INPUT DATA.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA VALIDATION [_hmac_lib]
                                    foreach((array) $tmp_hmac_hash_algorithm_ARRAY['OPTIONS']['SERVER'] as $hash_index => $hash_name){
                                        // TODO :: IS IT A GUARANTEE THAT THE SERVER HASH NAME WILL ALWAYS BE LOWERCASE?

                                        $tmp_lower_hash = strtolower($hash_name);
                                        //self::$hmac_hash_algorithm_ARRAY['OPTIONS']['ISACTIVE'][$tmp_lower_hash] = $hash_index;

                                        //
                                        // STORE THIS HASH ALGORITHM AS BEING
                                        // ACTIVE IN THE SYSTEM.
                                        $this->oCRNRSTN->set_crnrstn('hmac_hash_algorithm_ARRAY', $hash_index, 'OPTIONS', 'ISACTIVE', $tmp_lower_hash);

                                        if($tmp_lower_hash == $tmp_hmac){

                                            $tmp_hmac = $hash_name;

                                            $this->oCRNRSTN->set_crnrstn('hmac_hash_algorithm_int', $hash_index);

                                            //self::$hmac_hash_algorithm_ARRAY['DEFAULT'][CRNRSTN_INTEGER] = $hash_index;
                                            $this->oCRNRSTN->set_crnrstn('hmac_hash_algorithm_ARRAY', $hash_index, 'DEFAULT', CRNRSTN_INTEGER);

                                            //self::$hmac_hash_algorithm_ARRAY['DEFAULT']['NAME'] = $tmp_hmac = $hash_name;
                                            $this->oCRNRSTN->set_crnrstn('hmac_hash_algorithm_ARRAY', $tmp_hmac, 'DEFAULT', 'NAME');

                                            /*
                                            //
                                            // RETURN PRE-INITIALIZATION DEFAULT:
                                            $tmp_hash_name = self::$hmac_hash_algorithm_ARRAY['DEFAULT']['NAME'];

                                            //
                                            // RETURN POST-INITIALIZATION DEFAULT:
                                            $tmp_hash_name = self::$hmac_hash_algorithm_ARRAY['OPTIONS']['SERVER'][self::$hmac_hash_algorithm_ARRAY['DEFAULT'][CRNRSTN_INTEGER]];

                                            //
                                            // RETURN SYSTEM AVAILABLE:
                                            // $tmp_hash_name = self::$hmac_hash_algorithm_ARRAY['OPTIONS']['SERVER'][self::$hmac_hash_algorithm_int];

                                            //$tmp_openssl_cipher_best_quality_ARRAY = $this->oCRNRSTN->openssl_get_cipher_methods();
                                            //$tmp_openssl_cipher_all_ARRAY = $this->oCRNRSTN->openssl_get_cipher_methods(false, false);

                                            //error_log(__LINE__ . ' crnrstn best openssl_cipher [' . print_r($tmp_openssl_cipher_best_quality_ARRAY, true) . '].');
                                            //error_log(__LINE__ . ' crnrstn all openssl_cipher [' . print_r($tmp_openssl_cipher_all_ARRAY, true) . '].');

                                            */

                                            //
                                            // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                            // # # C # R # N # R # S # T # N # : : # # # #
                                            // CRNRSTN :: UGC DATA INPUT [_hmac_lib]
                                            $tmp_output = $this->oCRNRSTN->add_resource($data_key, $tmp_hmac, $data_type_family, CRNRSTN_AUTHORIZE_SESSION, 0);
                                            $this->oCRNRSTN->add_resource($data_key .'_index', $hash_index, $data_type_family, CRNRSTN_AUTHORIZE_SESSION, 0);

                                            $tmp_ddo_write = true;

                                        }

                                    }

                                    if(!($this->oCRNRSTN->isset_resource('data_value', $data_key, $data_type_family, CRNRSTN_CHANNEL_SESSION) == true)){

                                        $tmp_force_data_err = true;
                                        $tmp_graceful_err = false;

                                        //
                                        // LOAD A CUSTOM CULLED SET OF BOUTIQUE HMAC
                                        // ALGORITHMS TO GET THE BEST RESULTS FOR THE
                                        // MANUAL SELECTION OF A SYSTEM DEFAULT FROM
                                        // WHAT ACTUALLY IS LOADED ON THIS SERVER.
                                        $tmp_system_hmac_algorithm_preferred_ARRAY = $this->oCRNRSTN->get_crnrstn('system_hmac_algorithm_preferred_ARRAY');
                                        foreach($tmp_system_hmac_algorithm_preferred_ARRAY as $hmac_alg_index => $hmac_alg_name){

                                            //if(isset(self::$hmac_hash_algorithm_ARRAY['OPTIONS']['ISACTIVE'][strtolower($hmac_alg_index)])){
                                            if($this->oCRNRSTN->isset_crnrstn('hmac_hash_algorithm_ARRAY', 'OPTIONS', 'ISACTIVE', strtolower($hmac_alg_index)) == true){

                                                //
                                                // USE THIS SYSTEM VERIFIED
                                                // AND COMPATIBLE ALGORITHM.
                                                $tmp_hmac = $hmac_alg_name;
                                                $tmp_graceful_err = true;

                                                //
                                                // # # C # R # N # R # S # T # N # : : # # # #
                                                // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [_hmac_lib]
                                                if($tmp_graceful_err == true){

                                                    $tmp_err_str = 'CRNRSTN :: could not recognize the provided HMAC library algorithm, ' .
                                                        strval($data) . ' , that is to be used when generating keyed hash values. The system HMAC library algorithm has been manually set to, "' . $tmp_hmac . '". ' .
                                                        $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                                }else{

                                                    $tmp_err_str = 'CRNRSTN :: could not recognize the provided HMAC library algorithm, ' .
                                                        strval($data) . ' , that is to be used when generating keyed hash values. No OpenSSL cipher could be selected. ' .
                                                        $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                                }

                                            }

                                        }

                                        //
                                        // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                        // # # C # R # N # R # S # T # N # : : # # # #
                                        // CRNRSTN :: UGC DATA INPUT [_hmac_lib]
                                        $tmp_output = $this->oCRNRSTN->input_data_value($tmp_hmac, $data_key, $data_type_family, $index, CRNRSTN_AUTHORIZE_SESSION, $ttl, $spool_resource, $env_key);
                                        //$this->oCRNRSTN->input_data_value(self::$hmac_hash_algorithm_ARRAY['OPTIONS']['ISACTIVE'][strtolower(trim($tmp_hmac))], $data_key . '_index', $data_type_family, $index, CRNRSTN_AUTHORIZE_SESSION, $ttl, $spool_resource, $env_key);
                                        $this->oCRNRSTN->input_data_value($this->oCRNRSTN->get_crnrstn('hmac_hash_algorithm_ARRAY', 'OPTIONS', 'ISACTIVE', strtolower(trim($tmp_hmac))), $data_key . '_index', $data_type_family, $index, CRNRSTN_AUTHORIZE_SESSION, $ttl, $spool_resource, $env_key);

                                        $tmp_ddo_write = true;

                                    }

                                }else{

                                    //
                                    // SET SESSION FROM RUNTIME.
                                    //$tmp_hmac = self::$hmac_hash_algorithm_ARRAY['DEFAULT']['NAME'];
                                    $tmp_hmac = $this->oCRNRSTN->get_crnrrstn('hmac_hash_algorithm_ARRAY', 'DEFAULT', 'NAME');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [_hmac_lib]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_hmac, $data_key, $data_type_family, $index, CRNRSTN_AUTHORIZE_SESSION, $ttl, $spool_resource, $env_key);
                                    //$this->oCRNRSTN->input_data_value(self::$hmac_hash_algorithm_ARRAY['OPTIONS']['ISACTIVE'][strtolower(trim($tmp_hmac))], $data_key . '_index', $data_type_family, $index, CRNRSTN_AUTHORIZE_SESSION, $ttl, $spool_resource, $env_key);
                                    $this->oCRNRSTN->input_data_value($this->oCRNRSTN->get_crnrstn('hmac_hash_algorithm_ARRAY', 'OPTIONS',  'ISACTIVE',  strtolower(trim($tmp_hmac))), $data_key . '_index', $data_type_family, $index, CRNRSTN_AUTHORIZE_SESSION, $ttl, $spool_resource, $env_key);

                                    $tmp_ddo_write = true;

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) POWER METHODS.
                                    // -----
                                    // is_resource_serialization_active($data_type, $channel);
                                    // $tmp_ = $this->oCRNRSTN->get_resource('err_reporting_profile', 0, 'CRNRSTN::RESOURCE::CONFIGURATION');
                                    // $tmp_ = $this->get_resource_count('err_reporting_profile', 'CRNRSTN::RESOURCE::CONFIGURATION');
                                    // if($this->isset_resource('data_value', 'err_reporting_profile', 'CRNRSTN::RESOURCE::CONFIGURATION') == true)

                                }

                            }else{

                                //
                                // THIS CRNRSTN :: DDO SESSION POWERED INITIALIZATION
                                // BY-PASSES SERVER SETTING LOOKUP AND PROCESSING.
                                //self::$hmac_hash_algorithm_ARRAY['DEFAULT'][CRNRSTN_INTEGER] = $this->oCRNRSTN->get_resource($data_key . '_index', 0, $data_type_family, CRNRSTN_AUTHORIZE_SESSION);
                                //$tmp_hmac = self::$hmac_hash_algorithm_ARRAY['DEFAULT']['NAME'] = $this->oCRNRSTN->get_resource($data_key, 0, $data_type_family, CRNRSTN_AUTHORIZE_SESSION);
                                $this->oCRNRSTN->set_crnrstn('hmac_hash_algorithm_ARRAY', $this->oCRNRSTN->get_resource($data_key . '_index', 0, $data_type_family, CRNRSTN_AUTHORIZE_SESSION), 'DEFAULT', CRNRSTN_INTEGER);
                                $this->oCRNRSTN->set_crnrstn('hmac_hash_algorithm_ARRAY', $this->oCRNRSTN->get_resource($data_key, 0, $data_type_family, CRNRSTN_AUTHORIZE_SESSION), 'DEFAULT', 'NAME');

                            }

                            if($tmp_force_data_err == true){

                                $this->oCRNRSTN->error_log($tmp_err_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                            }

                            /*
                            [Thu Oct 12 01:55:06.735017 2023] [:error] [pid 80241] [client 172.16.225.1:56141] 10387 crnrstn hmac [
                            Array(
                                [DEFAULT] => Array(
                                        [INTEGER] => 5
                                        [NAME] => sha256)
                                [OPTIONS] => Array(
                                        [SERVER] => Array(
                                            [0] => md2              [1] => md4              [2] => md5
                                            [3] => sha1             [4] => sha224           [5] => sha256
                                            [6] => sha384           [7] => sha512           [8] => ripemd128
                                            [9] => ripemd160        [10] => ripemd256       [11] => ripemd320
                                            [12] => whirlpool       [13] => tiger128,3      [14] => tiger160,3
                                            [15] => tiger192,3      [16] => tiger128,4      [17] => tiger160,4
                                            [18] => tiger192,4      [19] => snefru          [20] => snefru256
                                            [21] => gost            [22] => gost-crypto     [23] => adler32
                                            [24] => crc32           [25] => crc32b          [26] => fnv132
                                            [27] => fnv1a32         [28] => fnv164          [29] => fnv1a64
                                            [30] => joaat           [31] => haval128,3      [32] => haval160,3
                                            [33] => haval192,3      [34] => haval224,3      [35] => haval256,3
                                            [36] => haval128,4      [37] => haval160,4      [38] => haval192,4
                                            [39] => haval224,4      [40] => haval256,4      [41] => haval128,5
                                            [42] => haval160,5      [43] => haval192,5      [44] => haval224,5
                                            [45] => haval256,5
                                            )
                                [ISACTIVE] => Array(
                                        [sha256] => 5
                                        )
                                )
                            )].

                            */

                        break;
                        case '_integer':

                            //
                            // THIS SHOULD BE A NUMBER.
                            if(is_numeric($data)){

                                $tmp_int = (int) $data;

                            }else{

                                //
                                // IT WOULD CERTAINLY APPEAR THAT THIS
                                // IS NOT A VALID NUMBER FOR THE
                                // REQUESTED OPERATION.
                                //
                                // WE SHALL RUN AN INVALID CALCULATION.
                                //
                                // THIS MAY BE THE ONLY WAY THAT AN
                                // APPLICATION WHICH ABSOLUTELY LOVES
                                // NUMBERS (AS MUCH AS CRNRSTN :: HAS
                                // BEEN LOVING THE NUMBERS LATELY, AND
                                // EVEN IN THE MIDST OF "THESE ECONOMIC
                                // TIMES" AT THAT)...COULD EVEN BE ABLE
                                // TO ACQUIRE AN AUTHENTIC NaN (PLEASE
                                // READ AS "BAD DATA", OR EVEN BETTER,
                                // ...A PROPER SHIT VALUE) VALUE THAT
                                // CAN BE RELIABLY RETURNED WITH
                                // CONFIDENCE BY CRNRSTN ::
                                //
                                // CRNRSTN :: <3's
                                //          ...CRNRSTN_INTEGER's 4LIFE!
                                //
                                // SEE, https://www.php.net/manual/en/function.is-nan.php
                                $tmp_int = sqrt(-1);

                            }

                            //
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [_integer]
                            switch($data_key){
                                case 'max_email_send_30_day':
                                    //'max_email_send_30_day', 500, 'CRNRSTN::RESOURCE::COMMUNICATIONS');

                                    $tmp_force_data_err = true;
                                    $tmp_err_str = $data_profile . '[' . $data_key . '] could not be configured with the input, ' .
                                        strval($tmp_int) . '. ' . strval($data) . ', was the value that was provided as method input to this environment. ' .
                                        $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                break;
                                case 'max_length_plaid_performance_report':
                                    //'max_length_plaid_performance_report', 5, 'CRNRSTN::RESOURCE::APPLICATION_ACCELERATION');

                                    $tmp_force_data_err = true;
                                    $tmp_err_str = $data_profile . '[' . $data_key . '] could not be configured with the input, ' .
                                        strval($tmp_int) . '. ' . strval($data) . ', was the value that was provided as method input to this environment. ' .
                                        $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                break;
                                case 'ssdtla_session_data_ttl':
                                    //'ssdtla_session_data_ttl', 6000, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

                                    $tmp_force_data_err = true;
                                    $tmp_err_str = $data_profile . '[' . $data_key . '] could not be configured with the input, ' .
                                        strval($tmp_int) . '. ' . strval($data) . ', was the value that was provided as method input to this environment. ' .
                                        $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                break;
                                case 'page_load_ttl':
                                    //'page_load_ttl', 3, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

                                    $tmp_force_data_err = true;
                                    $tmp_err_str = $data_profile . '[' . $data_key . '] could not be configured with the input, ' .
                                        strval($tmp_int) . '. ' . strval($data) . ', was the value that was provided as method input to this environment. ' .
                                        $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                break;
                                case 'ssdtla_module_sync_ttl':
                                    //'ssdtla_module_sync_ttl', 33, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

                                    $tmp_force_data_err = true;
                                    $tmp_err_str = $data_profile . '[' . $data_key . '] could not be configured with the input, ' .
                                        strval($tmp_int) . '. ' . strval($data) . ', was the value that was provided as method input to this environment. ' .
                                        $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                break;
                                case 'share_module_inactivity_close_ttl':
                                    //'share_module_inactivity_close_ttl', 2, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

                                    $tmp_force_data_err = true;
                                    $tmp_err_str = $data_profile . '[' . $data_key . '] could not be configured with the input, ' .
                                        strval($tmp_int) . '. ' . strval($data) . ', was the value that was provided as method input to this environment. ' .
                                        $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                break;
                                case 'inactivity_refresh_ttl':
                                    //'inactivity_refresh_ttl', 300, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

                                    $tmp_force_data_err = true;
                                    $tmp_err_str = $data_profile . '[' . $data_key . '] could not be configured with the input, ' .
                                        strval($tmp_int) . '. ' . strval($data) . ', was the value that was provided as method input to this environment. ' .
                                        $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                break;
                                case 'client_debug_mode':
                                    //'client_debug_mode', CRNRSTN_DEBUG_OFF, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');                  // where CRNRSTN JS :: DEBUG MODES = [CRNRSTN_DEBUG_OFF, 100, 200, 300, 420, 500];

                                    $tmp_force_data_err = true;
                                    $tmp_err_str = $data_profile . '[' . $data_key . '] could not be configured with the input, ' .
                                        strval($tmp_int) . '. ' . strval($data) . ', was the value that was provided as method input to this environment. ' .
                                        $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                break;
                                case 'browser_cookie_privacy_accept_module':
                                    //'browser_cookie_privacy_accept_module', CRNRSTN_UI_COOKIE_YESNO, 'CRNRSTN::RESOURCE::COOKIE_PRIVACY');

                                    $tmp_force_data_err = true;
                                    $tmp_err_str = $data_profile . '[' . $data_key . '] could not be configured with the input, ' .
                                        strval($tmp_int) . '. ' . strval($data) . ', was the value that was provided as method input to this environment. ' .
                                        $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                break;
                                case 'salt_length':

                                    //
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA VALIDATION [_integer]
                                    if(!($tmp_int > 0) || is_nan($tmp_int)){

                                        $tmp_salt_string_length = $this->oCRNRSTN->get_resource('salt_length', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

                                        if((int) $tmp_salt_string_length < 1){

                                            $tmp_salt_string_length = $this->oCRNRSTN->get_crnrstn('salt_string_length');

                                        }

                                        $tmp_force_data_err = true;

                                        $tmp_err_str = 'The system salt string length could not be configured with the input, ' .
                                            strval($tmp_int) . '. ' . strval($data) . ', was the value that was provided as method input to this environment. The default salt string length has been manually set to, (' .
                                            $this->oCRNRSTN->gettype($tmp_salt_string_length) . ') ' . $tmp_salt_string_length . '. ' .
                                            $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                        $tmp_int = $tmp_salt_string_length;

                                    }else{

                                        $this->oCRNRSTN->set_crnrstn('salt_string_length', $tmp_int);

                                    }

                                break;
                                case 'byte_reporting_precision':

                                    //
                                    // -1 = OPERATING SYSTEM RESTRICTED.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA VALIDATION [_integer]
                                    if((!($tmp_int == -1) && !($tmp_int >= 0)) || is_nan($tmp_int)){

                                        $tmp_force_data_err = true;

                                        $tmp_byte_reporting_precision = $this->oCRNRSTN->get_resource('byte_reporting_precision', 0, 'CRNRSTN::RESOURCE::FILE_SYSTEM_REPORTING');

                                        if((int) $tmp_byte_reporting_precision < 1){

                                            $tmp_byte_reporting_precision = $this->oCRNRSTN->get_crnrstn('byte_reporting_precision');

                                        }

                                        $tmp_int = $tmp_byte_reporting_precision;
                                        $tmp_err_str = 'CRNRSTN :: could not configure byte reporting precision for the environment with the input, (' .
                                            $this->oCRNRSTN->gettype($tmp_int) . ') ' . strval($tmp_int) . '. ' . strval($data) .
                                            ', was the value that was provided as method input to this environment. System byte precision has been manually set to, (' .
                                            $this->oCRNRSTN->gettype($tmp_byte_reporting_precision) . ') ' . $tmp_byte_reporting_precision . '. ' .
                                            $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                    }

                                break;
                                default:

                                    //
                                    // Friday, October 13, 2023 @ 0234.56 hrs
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA VALIDATION [_integer]
                                    if(is_nan($tmp_int)){

                                        $tmp_force_data_err = true;
                                        $tmp_err_str = 'CRNRSTN :: could not apply the ' . $data_key . ', ' . strval($tmp_int) . '. ' .
                                            strval($data) . ', was the value that was provided as method input to this environment. ' .
                                            $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                        $this->oCRNRSTN->error_log($tmp_err_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                                        return NULL;

                                    }

                                break;

                            }

                            //
                            // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // CRNRSTN :: UGC DATA INPUT [_integer]
                            $tmp_output = $this->oCRNRSTN->input_data_value($tmp_int, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);
                            $tmp_ddo_write = true;

                            if($tmp_force_data_err == true){

                                $this->oCRNRSTN->error_log($tmp_err_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                            }

                        break;
                        case '_byte_unit_system':

                            $tmp_str = strtoupper(trim($data));

                            //
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // CRNRSTN :: UGC DATA VALIDATION [_byte_unit_system]
                            switch($tmp_str){
                                case 'ISO_80000':
                                case 'SI_METRIC':
                                    // SILENCE IS GOLDEN.
                                break;
                                default:
                                    //ISO_80000 WITH ERROR.

                                    $tmp_str = 'ISO_80000';
                                    $tmp_force_data_err = true;
                                    $tmp_force_data_err_msg = 'Unable to load system of units for byte reporting from the provided (' . $this->oCRNRSTN->gettype($data) . ') data, ' . strval($data) . '. The system of reporting for units of bytes has manually been set to "' . $tmp_str . '". ' . $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                break;

                            }

                            //
                            // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // CRNRSTN :: UGC DATA INPUT [_byte_unit_system]
                            $tmp_output = $this->oCRNRSTN->input_data_value($tmp_str, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);
                            $tmp_ddo_write = true;

                            if($tmp_force_data_err == true){

                                $this->oCRNRSTN->error_log($tmp_force_data_err_msg, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                            }

                        break;
                        case '_channel_init_sequence':

                            $tmp_str = '';
                            $tmp_flag_ARRAY = array();

                            //error_log(__LINE__ . ' crnrstn $data_profile[' . $data_profile . ']. $data_key[' . $data_key . ']. $data[' . print_r($data, true) . '].');

                            $tmp_data = strtoupper(trim((string) $data));
                            if(strlen($tmp_data) > 0){

                                //
                                // BREAK INPUT INTO DISTINCT LETTERS.
                                $tmp_char_ARRAY = str_split($data);

                                //
                                // IF THE CHAR VALUE (E.G. A LETTER) IS OFFICIAL, STRING CONCATENATE THE VALUE.
                                // # # C # R # N # R # S # T # N # : : # # # #
                                // CRNRSTN :: UGC DATA VALIDATION [_channel_init_sequence]
                                foreach($tmp_char_ARRAY as $char_index => $char){

                                    /*
                                    get_channel_config($channel, $index_0 = NULL, $index_1 = NULL)

                                    RETURN DATA STRUCTURE:
                                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_INTEGER] = CRNRSTN_CHANNEL_SOAP;
                                    $tmp_channel_ARRAY['SOURCEID'][CRNRSTN_STRING] = 'CRNRSTN_CHANNEL_SOAP';
                                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_INTEGER] = CRNRSTN_ENCRYPT_SOAP;
                                    $tmp_channel_ARRAY['ENCRYPTION']['PROFILE'][CRNRSTN_STRING] = 'CRNRSTN_ENCRYPT_SOAP';
                                    $tmp_channel_ARRAY['CHAR'] = 'O';
                                    $tmp_channel_ARRAY['NAME'] = 'soap';
                                    $tmp_channel_ARRAY['DESCRIPTION'] = 'O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1)';
                                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_INTEGER] = array(CRNRSTN_AUTHORIZE_GET => CRNRSTN_AUTHORIZE_GET);
                                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['PRIMARY'][CRNRSTN_STRING] = array('CRNRSTN_AUTHORIZE_GET' => CRNRSTN_AUTHORIZE_GET);
                                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_INTEGER] = array();
                                    $tmp_channel_ARRAY['AUTHORIZATION']['PROFILE']['AUTHORIZED'][CRNRSTN_STRING] = array();

                                    */
                                    if($tmp_channel_char = $this->oCRNRSTN->get_channel_config($char, 'CHAR')){

                                        $tmp_flag_ARRAY[$tmp_channel_char] = 1;
                                        $tmp_str .= $tmp_channel_char;

                                    }

                                }

                                $tmp_channel_master_ARRAY = $this->oCRNRSTN->get_crnrstn('channel_master_ARRAY');
                                $tmp_count = count($tmp_channel_master_ARRAY);
                                $tmp_added_count = 0;
                                $tmp_added_str = '';

                                //
                                // AFTER ALL IS DONE, LOOK TO APPEND ANY MISSING LETTERS.
                                if(!(strlen($tmp_str) == $tmp_count)){

                                    $tmp_data_channel_init_sequence = $this->oCRNRSTN->get_crnrstn('data_channel_init_sequence');

                                    $tmp_char_ARRAY = str_split($tmp_data_channel_init_sequence);
                                    foreach($tmp_char_ARRAY as $index_append => $char_append){

                                        if(!isset($tmp_flag_ARRAY[$char_append])){

                                            $tmp_added_count++;
                                            $tmp_str .= $char_append;
                                            $tmp_added_str .= $char_append;

                                        }

                                    }

                                    $tmp_force_data_err = true;
                                    $tmp_force_data_err_msg = 'Unable to load all ' . $tmp_count . ' CRNRSTN :: data channels from the provided (' . $this->oCRNRSTN->gettype($data) . ') data, ' . strval($data) . '. CRNRSTN :: has manually appended ' . $tmp_added_count . ' missing data channel, "' . $tmp_added_str . '". ' . $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                    if($tmp_added_count > 1){

                                        $tmp_force_data_err_msg = 'Unable to load all ' . $tmp_count . ' CRNRSTN :: data channels from the provided (' . $this->oCRNRSTN->gettype($data) . ') data, ' . strval($data) . '. CRNRSTN :: has manually appended ' . $tmp_added_count . ' missing data channels, "' . $tmp_added_str . '". ' . $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                    }

                                }

                            }else{

                                //
                                // MISSING CHANNEL SEQUENCE DATA.
                                $tmp_force_data_err = true;
                                $tmp_force_data_err_msg = 'Unable to load the CRNRSTN :: data channel sequence from system settings with the provided (' . $this->oCRNRSTN->gettype($data) . ') data, ' . strval($data) . '. The multi-channel initialization sequence for the CRNRSTN :: RESPONSE RETURN SERIALIZATION (RRS) MAPPING SERVICES LAYER has manually set to, "' . self::$data_channel_init_sequence . '". ' . $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                $tmp_str = $this->oCRNRSTN->get_crnrstn('data_channel_init_sequence');

                            }

                            //
                            // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // CRNRSTN :: UGC DATA INPUT [_channel_init_sequence]
                            $tmp_output = $this->oCRNRSTN->input_data_value($tmp_str, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);
                            $tmp_ddo_write = true;

                            if($tmp_force_data_err == true){

                                $this->oCRNRSTN->error_log($tmp_force_data_err_msg, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                            }

                        break;
                        case '_css_unit_length':

                            $tmp_force_data_err = true;
                            $tmp_data = strtolower(trim((string) $data));
                            if(strlen($tmp_data) > 0){

                                $tmp_force_data_err = false;

                                //
                                // # # C # R # N # R # S # T # N # : : # # # #
                                // CRNRSTN :: UGC DATA VALIDATION [_css_unit_length]
                                if(!isset($this->oINTERACT_UI_HTML_MGR->css_length_units_ARRAY[$tmp_data])){

                                    $tmp_data = $this->oCRNRSTN->get_crnrstn('static_css_length_unit');
                                    $tmp_css_length_units_ARRAY = $this->oCRNRSTN->get_crnrstn('css_length_units_ARRAY');

                                    $tmp_force_data_err = true;
                                    $tmp_force_data_err_msg = 'Unable to find a valid CSS unit of length matching the provided, (' .
                                        $this->oCRNRSTN->gettype($data) . ') ' . strval($data) . '. The default CRNRSTN :: INTERACT UI system of CSS length units has manually set to, "' .
                                        $tmp_data . '" / ' . $tmp_css_length_units_ARRAY[$tmp_data] . '. ' .
                                        $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                }

                            }

                            if($tmp_force_data_err == true){

                                $this->oCRNRSTN->error_log($tmp_force_data_err_msg, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                            }

                        break;
                        case '_theme':

                            $tmp_theme_style_ARRAY = $this->oCRNRSTN->return_constant_profile_ARRAY($data);

                            $tmp_data = $tmp_theme_style_int = $tmp_theme_style_ARRAY[CRNRSTN_INTEGER];

                            //
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // CRNRSTN :: UGC DATA VALIDATION [_theme]
                            if($this->oCRNRSTN->system_isset_output_profile_constants($tmp_theme_style_int) == true){

                                $tmp_theme_style_ARRAY = $this->oCRNRSTN->return_constant_profile_ARRAY($tmp_theme_style_int);
                                $tmp_data = $tmp_theme_style_ARRAY[CRNRSTN_INTEGER];

                                $tmp_force_data_err = true;
                                $tmp_force_data_err_msg = 'Unable to find a CRNRSTN :: INTERACT UI Theme with the provided, (' .
                                    $this->oCRNRSTN->gettype($data) . ') ' . strval($data) . '. ' . $tmp_theme_style_ARRAY[CRNRSTN_STRING] .
                                    '[' . $tmp_theme_style_ARRAY[CRNRSTN_INTEGER] . '] has been manually set to be the system default CRNRSTN :: INTERACT UI Theme. ' .
                                    $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                            }

                            if($tmp_force_data_err == true){

                                $this->oCRNRSTN->error_log($tmp_force_data_err_msg, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                            }

                        break;
                        case '_array':

                            switch($data_key){
                                case 'ddo_serializable_data_types':
                                    // $tmp_ddo_serializable_resources_ARRAY = array('object' => 1, 'array' => 1);
                                    // 'ddo_serializable_data_types', $tmp_ddo_serializable_resources_ARRAY, 'CRNRSTN::RESOURCE::MULTI_CHANNEL');
                                    //
                                    // self::$datatype_master_ARRAY = array('int' => 'int', 'integer' => 'integer', 'bool' => 'bool',
                                    // 'boolean' => 'boolean', 'float' => 'float', 'double' => 'double', 'real' => 'real', 'string' => 'string',
                                    // 'array' => 'array', 'object' => 'object', 'NULL' => 'NULL');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'object_serializable_data_channels':
                                    //$tmp_object_serializable_channels_ARRAY = array('get' => 'G', 'post' => 'P', 'session' => 'H', 'ssdtla' => 'S',
                                    //'pssdtla' => 'J', 'cookie' => 'C', 'database' => 'D', 'soap' => 'O');
                                    //'object_serializable_data_channels', $tmp_object_serializable_channels_ARRAY, 'CRNRSTN::RESOURCE::MULTI_CHANNEL');
                                    //
                                    // self::$channel_master_ARRAY = array();

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'get_parameters_system_data':
                                    //$tmp_get_parameters_system_data_ARRAY = array($this->session_salt(), 'crnrstn_bst', 'crnrstn_smk', 'crnrstn_sid',
                                    //'crnrstn_sk', 'crnrstn_r', 'crnrstn_l', 'crnrstn_css_valptrn', 'crnrstn_encrypt_tunnel', 'utm_source', 'utm_medium',
                                    //'utm_campaign', 'fbclid');
                                    //'get_parameters_system_data', $tmp_get_parameters_system_data_ARRAY, 'CRNRSTN::RESOURCE::GET_CHANNEL_PARAMS');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'crnrstn_system_files_color_class_ARRAY':
                                    //$tmp_color_class_ARRAY = array('COMPRESSION' => '#FFF', 'TEXT-BASED::HTML' => '#FFF', 'TEXT-BASED::CSS' => '#FFF',
                                    //'TEXT-BASED::JS' => '#FFF', 'TEXT-BASED::JSON' => '#FFF', 'TEXT-BASED::XML' => '#FFF', 'TEXT-BASED::IMG' => '#FFF',
                                    //'TEXT-BASED::CSV' => '#FFF', 'TEXT-BASED::RTF' => '#FFF', 'TEXT-BASED::TXT' => '#FFF', 'SYSTEM::BAT' => '#FFF',
                                    //'MYSQLI:SQL' => '#FFF', 'PHP::INI' => '#FFF', 'CRNRSTN::PHP::BASE64' => '#FFF', 'SERVER::HTACCESS' => '#FFF',
                                    //'IMAGE::FAVICON' => '#FFF', 'IMAGE::PNG' => '#FFF', 'IMAGE::GIF' => '#FFF', 'IMAGE::JPEG' => '#FFF',
                                    //'IMAGE::BMP' => '#FFF', 'IMAGE::TIF' => '#FFF', 'IMAGE::SVG' => '#FFF', 'IMAGE' => '#FFF', 'AUDIO' => '#FFF',
                                    //'VIDEO::MPEG' => '#FFF', 'VIDEO::QT' => '#FFF', 'VIDEO::AVI' => '#FFF', 'VIDEO::MP4' => '#FFF',
                                    //'SERVER::SCRIPT' => '#FFF', 'EXECUTABLE' => '#FFF');
                                    //'crnrstn_system_files_color_class_ARRAY', $tmp_color_class_ARRAY, 'CRNRSTN::RESOURCE::LOCAL_FILE_SYSTEM');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'crnrstn_system_files_line_weight_class_ARRAY':
                                    //$tmp_color_class_ARRAY = array('COMPRESSION' => 'HEAVY', 'TEXT-BASED::HTML' => 'HEAVY', 'TEXT-BASED::CSS' => 'HEAVY',
                                    //'TEXT-BASED::JS' => 'HEAVY', 'TEXT-BASED::JSON' => 'HEAVY', 'TEXT-BASED::XML' => 'HEAVY', 'TEXT-BASED::IMG' => 'HEAVY',
                                    //'TEXT-BASED::CSV' => 'HEAVY', 'TEXT-BASED::RTF' => 'HEAVY', 'TEXT-BASED::TXT' => 'HEAVY', 'SYSTEM::BAT' => 'HEAVY',
                                    //'MYSQLI:SQL' => 'HEAVY', 'PHP::INI' => 'HEAVY', 'CRNRSTN::PHP::BASE64' => 'HEAVY', 'SERVER::HTACCESS' => 'HEAVY',
                                    //'IMAGE::FAVICON' => 'HEAVY', 'IMAGE::PNG' => 'HEAVY', 'IMAGE::GIF' => 'HEAVY', 'IMAGE::JPEG' => 'HEAVY',
                                    //'IMAGE::BMP' => 'HEAVY', 'IMAGE::TIF' => 'HEAVY', 'IMAGE::SVG' => 'HEAVY', 'IMAGE' => 'HEAVY', 'AUDIO' => 'HEAVY',
                                    //'VIDEO::MPEG' => 'HEAVY', 'VIDEO::QT' => 'HEAVY', 'VIDEO::AVI' => 'HEAVY', 'VIDEO::MP4' => 'HEAVY',
                                    //'SERVER::SCRIPT' => 'HEAVY', 'EXECUTABLE' => 'HEAVY');
                                    //'crnrstn_system_files_line_weight_class_ARRAY', $tmp_color_class_ARRAY, 'CRNRSTN::RESOURCE::LOCAL_FILE_SYSTEM');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'mem_rpt_general_system_footer':
                                    //$tmp_general_system_footer_ARRAY = array(0);
                                    //'mem_rpt_general_system_footer', $tmp_plaid_performance_ARRAY, 'CRNRSTN::RESOURCE::REPORTING');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'mem_rpt_plaid_performance':
                                    //$tmp_plaid_performance_ARRAY = array(0, 1, 5);
                                    //'mem_rpt_plaid_performance', $tmp_plaid_performance_ARRAY, 'CRNRSTN::RESOURCE::REPORTING');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'mem_rpt_system_page_return_statistics_module':
                                    //$tmp_page_return_statistics_ARRAY = array(0, 1, 5, 6, 2, 4, 9, 10);
                                    //'mem_rpt_system_page_return_statistics_module', $tmp_page_return_statistics_ARRAY, 'CRNRSTN::RESOURCE::REPORTING');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'mem_rpt_mit_license_modal':
                                    //$tmp_mit_license_ARRAY = array(0, 1);
                                    //'mem_rpt_mit_license_modal', $tmp_mit_license_ARRAY, 'CRNRSTN::RESOURCE::REPORTING');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'mem_rpt_cache_usage_report':
                                    //$tmp_cache_usage_ARRAY = array(0, 1, 2, 9, 10);
                                    //'mem_rpt_cache_usage_report', $tmp_cache_usage_ARRAY, 'CRNRSTN::RESOURCE::REPORTING');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'interact_ui_ttl':
                                    //$tmp_interact_ui_ttl_ARRAY = array('crnrstn_inactivity_refresh_ttl', 'crnrstn_ssdtla_module_sync_ttl',
                                    //'crnrstn_share_module_inactivity_close_ttl', 'crnrstn_page_load_ttl, bassdrive_is_live_ttl',
                                    //'the_situation_with_bassdrive_ttl', 'bassdrive_title_ttl', 'bassdrive_locale_city_province_ttl',
                                    //'bassdrive_locale_nation_ttl', 'stream_relays_ttl', 'social_media_connects_ttl', 'relay_performance_ttl', 'lifestyle_banner_ttl');
                                    //'interact_ui_ttl', $tmp_interact_ui_ttl_ARRAY, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'interact_ui_month_abbrev':
                                    //$tmp_interact_ui_month_abbrev_ARRAY = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct',
                                    //'Nov', 'Dec');
                                    //'interact_ui_month_abbrev', $tmp_interact_ui_month_abbrev_ARRAY, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'interact_ui_month':
                                    //$tmp_interact_ui_month_ARRAY = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
                                    //'September', 'October', 'November', 'December');
                                    //'interact_ui_month', $tmp_interact_ui_month_ARRAY, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'interact_ui_day_abbrev':
                                    //$tmp_interact_ui_day_abbrev_ARRAY = array('Sun', 'Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat');
                                    //'interact_ui_day_abbrev', $tmp_interact_ui_day_abbrev_ARRAY, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'interact_ui_day':
                                    //$tmp_interact_ui_day_ARRAY = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
                                    //'interact_ui_day', $tmp_interact_ui_day_ARRAY, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'resource_footer_append_spool_override':
                                    //$tmp_footer_append_spool_override_ARRAY = array(CRNRSTN_CLIENT_SSDTLA_DEBUG => '1');
                                    //'resource_footer_append_spool_override', $tmp_footer_append_spool_override_ARRAY, 'CRNRSTN::RESOURCE::ASSET_INTEGRATIONS');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'resource_head_append_spool_override':
                                    //$tmp_head_append_spool_override_ARRAY = array(CRNRSTN_RESOURCE_DOCUMENTATION => '1');
                                    //'resource_head_append_spool_override', $tmp_head_append_spool_override_ARRAY, 'CRNRSTN::RESOURCE::ASSET_INTEGRATIONS');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'system_file_max_ui_pageview_cnt':
                                    //$tmp_system_file_max_ui_pageview_cnt_ARRAY = array(CRNRSTN_CHANNEL_DESKTOP => 75, CRNRSTN_CHANNEL_TABLET => 20 , CRNRSTN_CHANNEL_MOBILE => 20);
                                    //'system_file_max_ui_pageview_cnt', $tmp_system_file_max_ui_pageview_cnt_ARRAY, 'CRNRSTN::RESOURCE::INTERACT_UI::FILE_SYSTEM');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'crnrstn_hidden_file_extensions':
                                    //$tmp_hidden_file_extensions_ARRAY = array('.htaccess', '.php', '.sql');
                                    //'crnrstn_hidden_file_extensions', $tmp_hidden_file_extensions_ARRAY, 'CRNRSTN::RESOURCE::LOCAL_FILE_SYSTEM');

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [MIXED]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    return $tmp_output;

                                break;
                                case 'system_file_active_attributes_profile':

                                    //
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA VALIDATION [_array]
                                    if(!is_array($data)){

                                        $tmp_force_data_err = true;

                                        //
                                        // INITIALIZATION WITH EMPTY ARRAY.
                                        $tmp_data_ARRAY = $tmp_ARRAY;

                                    }

                                    if(is_array($data)){

                                        $tmp_data_ARRAY = $data;

                                    }

                                    //
                                    // BUILD OUT WITH PROPER DATA STRUCTURE AGAINST THE SYSTEM MASTER ARRAY.
                                    if($tmp_force_data_err == true){

                                        $tmp_force_data_err_msg = 'Incorrect data type (' . $this->oCRNRSTN->gettype($data) . ') provided. Array data is expected for the file system settings array, ' . $data_key . '. ' . strval($data) . ', was the value provided.';

                                    }else{

                                        $tmp_force_data_err_msg = 'Incomplete or incorrect (' . $this->oCRNRSTN->gettype($data) . ') data was provided for the file system settings array, ' . $data_key . '. The following changes had to be made: ';

                                    }

                                    $tmp_system_file_attributes_master_ARRAY = $this->oCRNRSTN->get_crnrstn('system_file_attributes_master_ARRAY');

                                    foreach($tmp_system_file_attributes_master_ARRAY as $master_attribute => $master_state_int){

                                        if(isset($tmp_data_ARRAY[$master_attribute])){

                                            if(is_numeric($data[$master_attribute])){

                                                $tmp_int = (int) $data[$master_attribute];

                                                switch($tmp_int){
                                                    case 1:

                                                        $tmp_ARRAY[$master_attribute] = 1;

                                                    break;
                                                    default:

                                                        //
                                                        // CLEAN UP UNKNOWN VALUES THAT ARE
                                                        // WITHIN THE INPUT DATA STRUCTURE.
                                                        // ALSO...ZERO WILL BE SET TO ZERO.
                                                        //
                                                        // Friday, October 13, 2023 @ 2343 hrs.
                                                        $tmp_ARRAY[$master_attribute] = 0;

                                                    break;

                                                }

                                            }

                                        }else{

                                            //
                                            // REPAIR INCOMPLETE INPUT DATA STRUCTURE
                                            // WITH MASTER DATA. SET TO ZERO (ZED).
                                            $tmp_ARRAY[$master_attribute] = 0;

                                            if($tmp_force_data_err == true){

                                                $tmp_force_data_err_msg .= 'Added file attribute, "' . $master_attribute . '"=' . $tmp_ARRAY[$master_attribute] . '. ';

                                            }else{

                                                $tmp_force_data_err_msg .= 'Added missing file attribute, "' . $master_attribute . '"=' . $tmp_ARRAY[$master_attribute] . '. ';

                                            }

                                        }

                                    }

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [STRING]
                                    $tmp_output = $this->oCRNRSTN->input_data_value($tmp_ARRAY, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);
                                    $tmp_ddo_write = true;

                                    if($tmp_force_data_err == true){

                                        $tmp_force_data_err_msg .= $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                        $this->oCRNRSTN->error_log($tmp_force_data_err_msg, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                                    }

                                break;
                                default:

                                    $tmp_system_resource_profile_ARRAY = $this->oCRNRSTN->get_crnrstn('system_resource_profile_ARRAY');
                                    error_log(__LINE__ . ' crnrstn unknown system resource validation data_key[' . $data_key . ']. validation_profile[' . $tmp_system_resource_profile_ARRAY[$data_key] . '].');

                                break;

                            }

                        break;
                        case '_percentage':

                            $tmp_data = $tmp_percentage = $this->oCRNRSTN->str_sanitize($data, 'clean_percentage_numbers');

                            //
                            // THIS SHOULD BE A NUMBER.
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // CRNRSTN :: UGC DATA VALIDATION [_percentage]
                            if(!is_numeric($tmp_percentage)){

                                //
                                // IT WOULD CERTAINLY APPEAR THAT THIS
                                // IS NOT A VALID NUMBER FOR THE
                                // REQUESTED OPERATION.
                                //
                                // WE SHALL RUN AN INVALID CALCULATION.
                                //
                                // THIS MAY BE THE ONLY WAY THAT AN
                                // APPLICATION WHICH ABSOLUTELY LOVES
                                // NUMBERS (AS MUCH AS CRNRSTN :: HAS
                                // BEEN LOVING THE NUMBERS LATELY, AND
                                // EVEN IN THE MIDST OF "THESE ECONOMIC
                                // TIMES" AT THAT)...COULD EVEN BE ABLE
                                // TO ACQUIRE AN AUTHENTIC NaN (PLEASE
                                // READ AS "BAD DATA", OR EVEN BETTER,
                                // ...A PROPER SHIT VALUE) VALUE THAT
                                // CAN BE RELIABLY RETURNED WITH
                                // CONFIDENCE BY CRNRSTN ::
                                //
                                // CRNRSTN :: <3's
                                //          ...CRNRSTN_INTEGER's 4LIFE!
                                //
                                // SEE, https://www.php.net/manual/en/function.is-nan.php
                                $tmp_percentage = sqrt(-1);

                                //
                                // # # C # R # N # R # S # T # N # : : # # # #
                                // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [PERCENTAGE]
                                switch($data_key){
                                    case 'max_disk_storage_utilization_warning':

                                        $tmp_data = $this->oCRNRSTN->get_crnrstn('max_disk_storage_utilization_warning');
                                        $tmp_force_data_err = true;
                                        $tmp_err_str = 'CRNRSTN :: could not apply the CRNRSTN :: DISK MANAGEMENT ' . $data_key . ' percentage, ' .
                                            strval($tmp_percentage) . '. ' . strval($data) . ', was the value that was provided as method input to this environment. CRNRSTN :: has manually set the DISK WRITE WARNING percentage to ' .
                                            $tmp_data . '. ' . $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                    break;
                                    case 'max_disk_storage_utilization':

                                        $tmp_data = $this->oCRNRSTN->get_crnrstn('max_disk_storage_utilization');
                                        $tmp_force_data_err = true;
                                        $tmp_err_str = 'CRNRSTN :: could not apply the CRNRSTN :: DISK MANAGEMENT ' . $data_key . ' percentage, ' .
                                            strval($tmp_percentage) . '. ' . strval($data) . ', was the value that was provided as method input to this environment. CRNRSTN :: has manually set the DISK WRITE BLOCK percentage to ' .
                                            $tmp_data . '. ' . $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                    break;
                                    default:

                                        error_log(__LINE__ . ' crnrstn MISSING SWITCH CASE[' . $data_key . ']. $data_profile[' . $data_profile . '].');

                                    break;

                                }

                                if($tmp_force_data_err == true){

                                    $this->oCRNRSTN->error_log($tmp_err_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                                }

                            }

                        break;
                        default:
                            //SILENCE IS GOLDEN.

                            error_log(__LINE__ . ' crnrstn MISSING SWITCH CASE[' . $data_key . ']. $data_profile[' . $data_profile . '].');

                        break;

                    }

                    if(!($tmp_ddo_write !== false)){

                        //
                        // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: UGC DATA INPUT [MIXED]
                        $tmp_output = $this->oCRNRSTN->input_data_value($tmp_data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                    }

                    return $tmp_output;

                }

                //
                // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: UGC DATA INPUT [MIXED]
                $tmp_output = $this->oCRNRSTN->input_data_value($data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);
                $tmp_ddo_write = true;

                return $tmp_output;

            break;

            case 'ini_set_ini_set':
            case 'config_ini_set_ini_set':
            case 'ini_get_ini_get':

                error_log(__LINE__  . ' ' . __METHOD__ . ' INPUT UGC $tmp_ugc_option_name[' . $tmp_ugc_option_name  . ']. $data_key[' . $data_key . '].');

                //
                // STANDARDIZE UGC INPUT.
                switch($data_profile){
                    case 'ini_get_ini_get':

                            $tmp_ugc_option_name = $data;
                            error_log(__LINE__  . ' ' . __METHOD__ . ' INPUT UGC $tmp_ugc_option_name[' . $tmp_ugc_option_name  . ']. $data_key[' . $data_key . '].');

                    break;
                    case 'config_ini_set_ini_set':
                    case 'ini_set_ini_set':

                            $tmp_ugc_option_name = $data_key;
                            $tmp_ugc_option_value = $data;
                            error_log(__LINE__  . ' ' . __METHOD__ . ' INPUT UGC $tmp_ugc_option_value[' . $tmp_ugc_option_value  . ']. $tmp_ugc_option_name[' . $tmp_ugc_option_name . '].');

                    break;
                    default:

                        error_log(__LINE__ . ' ' . __METHOD__ . ' UNKNOWN SWITCH CASE RECEIVED[' . strval($data_profile) . '].');

                    break;

                }

                //
                // THIS SHOULD BE A VALID PHP.INI PARAMETER
                // WITH VALID DATA (IF PROVIDED/REQUIRED).
                //
                // SEE, List of php.ini directives:
                // https://www.php.net/manual/en/ini.list.php
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: UGC DATA VALIDATION [php.ini]
                //[Sat Nov 18 02:46:22.920498 2023] [:error] [pid 49131] [client 172.16.225.1:61576] 11063 crntsn PHP INI VALIDATION [post_max_size]. [30M]. die();
                if(!($tmp_result = $this->oCRNRSTN->is_valid_php_ini($data_key, $tmp_ini))){

                    $tmp_force_data_err = true;

                    //
                    // # # C # R # N # R # S # T # N # : : # # # #
                    // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [PHP_INI]
                    switch($data_profile){
                        case 'ini_get_ini_get':

                            $tmp_err_str = 'CRNRSTN :: could not update internal system references to the PHP ini directive, ' .
                                $data_key . ', (' . $this->oCRNRSTN->gettype($tmp_ini) . ') ' . $tmp_ini . '. ' . strval($data) .
                                ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        case 'config_ini_set_ini_set':

                            $tmp_err_str = 'CRNRSTN :: could not apply the PHP ini directive, ' . $data_key . ', (' .
                                $this->oCRNRSTN->gettype($tmp_ini) . ') ' . $tmp_ini . '. ' . strval($data) .
                                ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        case 'ini_set_ini_set':

                            $tmp_err_str = 'CRNRSTN :: could not apply the PHP ini directive, ' . $data_key . ', (' .
                                $this->oCRNRSTN->gettype($tmp_ini) . ') ' . $tmp_ini . '. ' . strval($data) .
                                ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');


                        break;
                        default:

                            $tmp_err_str = __LINE__ . ' ' . __METHOD__ . ' UNKNOWN SWITCH CASE RECEIVED[' . strval($data_profile) . '].';

                        break;

                    }

                    $this->oCRNRSTN->error_log($tmp_err_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);


                }



                //
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: UGC DATA EXECUTION LAYER [PHP_INI]
                switch($data_profile){
                    case 'ini_get_ini_get':

                        //
                        // IF THE UGC INPUT IS GOOD...
                        if(!($tmp_force_data_err !== false)){

                            return $tmp_result;

                        }


                    break;
                    case 'config_ini_set_ini_set':


                    break;
                    case 'ini_set_ini_set':


                    break;

                }

                //
                // php.ini directives
                // https://www.php.net/manual/en/ini.list.php#ini.list
                // $this->ini_set_ARRAY[$option] = ini_get($option);

                $tmp_ini = ini_get($option);


                //
                // LET US PUT A "LASER LINE" DOWN ON THE
                // STRING DATA TYPE REQUIREMENT AS WE
                // PUT A "LASER LINE" DOWN ON THE
                // [PHP_INI] DATA TYPE REQUIREMENT.
                $tmp_ini = strval($data);
                $tmp_prev_val = false;


                //
                // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: UGC DATA INPUT [PHP_INI]
                switch($data_profile){
                    case 'ini_get_ini_get':

                        $this->oCRNRSTN->input_data_value($tmp_ini, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                        //
                        // INI_GET CURRENT VALUE IS THE PREVIOUS VALUE.
                        $tmp_prev_val = ini_get($data_key);

                    break;
                    default:
                        // config_ini_set_ini_set
                        // ini_set_ini_set

                        //
                        // DO NOT WRITE DATA FOR PHP INI UNLESS IT IS VALID.
                        if(!($tmp_force_data_err !== false)){

                            //
                            // PHP INI.
                            // Returns the old value on success, false on failure.
                            $tmp_prev_val = ini_set($data_key, $tmp_ini);

                        }

                        //
                        // DO NOT WRITE DATA TO THE CRNRSTN :: MULTI-CHANNEL DDO
                        // UNLESS PHP SAYS IT IS NATIVE VALID; ALSO, CRNRSTN ::
                        // SHOULD HAVE NO OBJECTIONS.
                        if(($tmp_prev_val !== false) && (!($tmp_force_data_err !== false))){

                            //
                            // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // CRNRSTN :: UGC DATA INPUT [PHP_INI]
                            $this->oCRNRSTN->input_data_value($tmp_ini, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);
                            $this->oCRNRSTN->input_data_value($tmp_prev_val, $data_key . '_prev', $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                            return $tmp_prev_val;

                        }else{

                            $tmp_force_data_err = true;

                        }

                    break;

                }

                return $tmp_prev_val;

            break;

            case 'config_add_environment_integer_mode':

                    switch($data_key){
                        case 'crnrstn_debug_mode_override':
                            // public function config_add_environment($env_key, $err_reporting_profile = E_ALL & ~E_NOTICE & ~E_STRICT, $crnrstn_debug_mode_override = CRNRSTN_DEBUG_OFF, $system_html_comments_mode = CRNRSTN_HTML_COMMENTS_FULL){
                            // WHERE $crnrstn_debug_mode_override = [CRNRSTN_DEBUG_OFF, CRNRSTN_DEBUG_NATIVE_ERR_LOG, CRNRSTN_DEBUG_AGGREGATION_ON]

                            $tmp_int = $this->oCRNRSTN->return_valid_constant($data, 'crnrstn_debug_mode_ARRAY', CRNRSTN_DEBUG_OFF);

                            $this->oCRNRSTN->set_crnrstn('CRNRSTN_debug_mode', $tmp_int);

                        break;
                        case 'err_reporting_profile':
                            // WHERE THE DEFAULT IS E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED
                            $tmp_int = $this->oCRNRSTN->return_valid_constant($data, 'env_err_reporting_profile_ARRAY', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

                            $this->oCRNRSTN->set_crnrstn('env_err_reporting_profile_ARRAY', $tmp_int);

                        break;
                        case 'system_html_comments_mode':
                            // WHERE $system_html_comments_mode = [CRNRSTN_HTML_COMMENTS_FULL, CRNRSTN_HTML_COMMENTS_NONE, CRNRSTN_HTML_COMMENTS_CDN_STABILITY_CONTROL_ENABLED]

                            $tmp_int = $this->oCRNRSTN->return_valid_constant($data, 'env_html_comments_mode_ARRAY', CRNRSTN_HTML_COMMENTS_FULL);

                            $this->oCRNRSTN->set_crnrstn('env_html_comments_mode_ARRAY', $tmp_int);

                        break;
                        default:

                            error_log(__LINE__ . ' ' . __METHOD__ . ' Unknown SWITCH CASE received. ['. strval($data_key) . '].');

                        break;

                    }

            break;

            case 'config_load_system_settings_file_path':
            case 'config_load_system_overrides_file_path':
            case 'config_set_ui_theme_style_file_path':
            case 'config_include_social_media_file_path':
            case 'config_include_wild_card_resources_file_path':
            case 'config_include_encryption_file_path':
            case 'config_include_system_resources_file_path':
            case 'config_include_seo_analytics_file_path':
            case 'config_include_seo_engagement_file_path':

                //
                // EXPERIMENTAL (UNTIL WINDOWS TESTED) SANITIZATION OF
                // DIRECTORY FILE PATH SLASHES FOR SYSTEM COMPATIBILITY.
                $tmp_file_path = $this->oCRNRSTN->str_sanitize($data, DIRECTORY_SEPARATOR);

                //
                // THIS SHOULD BE A FILE.
                if(!is_file($tmp_file_path)){

                    $tmp_force_data_err = true;

                }

                if($tmp_force_data_err == true){

                    //
                    // # # C # R # N # R # S # T # N # : : # # # #
                    // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [FILE PATH]
                    switch($data_profile){
                        case 'config_load_system_settings_file_path':

                            //
                            // WE COULD NOT FIND THE CONFIGURATION FILE
                            $this->oCRNRSTN->error_log('File not found. File path data is not recognized as a file. [' .
                                $tmp_file_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
                            $tmp_err_str = 'CRNRSTN :: could not load the system settings configuration file, ' . $data_key .
                                ', (' . $this->oCRNRSTN->gettype($tmp_file_path) . ') ' . strval($tmp_file_path) . '. ' .
                                strval($data) . ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        case 'config_load_system_overrides_file_path':

                            //
                            // WE COULD NOT FIND THE CONFIGURATION FILE
                            $this->oCRNRSTN->error_log('File not found. File path data is not recognized as a file. [' .
                                $tmp_file_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
                            $tmp_err_str = 'CRNRSTN :: could not load the system overrides configuration file, ' . $data_key . ', (' .
                                $this->oCRNRSTN->gettype($tmp_file_path) . ') ' . strval($tmp_file_path) . '. ' . strval($data) .
                                ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        case 'config_set_ui_theme_style_file_path':

                            //
                            // WE COULD NOT FIND THE CONFIGURATION FILE
                            $this->oCRNRSTN->error_log('File not found. File path data is not recognized as a file. [' .
                                $tmp_file_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
                            $tmp_err_str = 'CRNRSTN :: could not load the CRNRSTN :: INTERACT UI theme settings configuration file, ' .
                                $data_key . ', (' . $this->oCRNRSTN->gettype($tmp_file_path) . ') ' . strval($tmp_file_path) . '. ' .
                                strval($data) . ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        case 'config_include_social_media_file_path':

                            //
                            // WE COULD NOT FIND THE CONFIGURATION FILE.
                            $this->oCRNRSTN->error_log('File path data not recognized as a file. [' . $tmp_file_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
                            $tmp_err_str = 'CRNRSTN :: could not load the social media settings configuration file, ' .
                                $data_key . ', (' . $this->oCRNRSTN->gettype($tmp_file_path) . ') ' . strval($tmp_file_path) . '. ' .
                                strval($data) . ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        case 'config_include_wild_card_resources_file_path':

                            //
                            // WE COULD NOT FIND THE CONFIGURATION FILE.
                            $this->oCRNRSTN->error_log('File path data not recognized as a file. [' . $tmp_file_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
                            $tmp_err_str = 'CRNRSTN :: could not load the CRNRSTN :: WILD CARD RESOURCES (WCR) settings configuration file, ' .
                                $data_key . ', (' . $this->oCRNRSTN->gettype($tmp_file_path) . ') ' . strval($tmp_file_path) . '. ' .
                                strval($data) . ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        case 'config_include_sql_silo_file_path':

                            //
                            // WE COULD NOT FIND THE CONFIGURATION FILE.
                            $this->oCRNRSTN->error_log('File path data not recognized as a file. [' . $tmp_file_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
                            $tmp_err_str = 'CRNRSTN :: could not load the CRNRSTN :: SQL silo settings configuration file, ' .
                                $data_key . ', (' . $this->oCRNRSTN->gettype($tmp_file_path) . ') ' . strval($tmp_file_path) . '. ' .
                                strval($data) . ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        case 'config_add_database_file_path':

                            //
                            // WE COULD NOT FIND THE CONFIGURATION FILE.
                            $this->oCRNRSTN->error_log('File path data not recognized as a file. [' . $tmp_file_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
                            $tmp_err_str = 'CRNRSTN :: could not load the database authentication settings configuration file, ' .
                                $data_key . ', (' . $this->oCRNRSTN->gettype($tmp_file_path) . ') ' . strval($tmp_file_path) . '. ' .
                                strval($data) . ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        case 'config_include_encryption_file_path':

                            //
                            // WE COULD NOT FIND THE CONFIGURATION FILE.
                            $this->oCRNRSTN->error_log('File path data not recognized as a file. [' . $tmp_file_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
                            $tmp_err_str = 'CRNRSTN :: could not load the OpenSSL v' . $this->oCRNRSTN->version_openssl() .
                                ' encryption profile configuration file, ' . $data_key . ', (' . $this->oCRNRSTN->gettype($tmp_file_path) . ') ' .
                                strval($tmp_file_path) . '. ' . strval($data) . ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        case 'config_include_system_resources_file_path':

                            //
                            // WE COULD NOT FIND THE CONFIGURATION FILE.
                            $this->oCRNRSTN->error_log('File path data not recognized as a file. [' . $tmp_file_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
                            $tmp_err_str = 'CRNRSTN :: could not load the system resources settings configuration file, ' .
                                $data_key . ', (' . $this->oCRNRSTN->gettype($tmp_file_path) . ') ' . strval($tmp_file_path) . '. ' .
                                strval($data) . ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        case 'config_include_seo_analytics_file_path':

                            //
                            // WE COULD NOT FIND THE CONFIGURATION FILE.
                            $this->oCRNRSTN->error_log('File path data not recognized as a file. [' . $tmp_file_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
                            $tmp_err_str = 'CRNRSTN :: could not load the SEO ANALYTICS settings configuration file, ' .
                                $data_key . ', (' . $this->oCRNRSTN->gettype($tmp_file_path) . ') ' . strval($tmp_file_path) . '. ' .
                                strval($data) . ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        case 'config_include_seo_engagement_file_path':

                            //
                            // WE COULD NOT FIND THE CONFIGURATION FILE.
                            $this->oCRNRSTN->error_log('File path data not recognized as a file. [' . $tmp_file_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
                            $tmp_err_str = 'CRNRSTN :: could not load the SEO ENGAGEMENT settings configuration file, ' .
                                $data_key . ', (' . $this->oCRNRSTN->gettype($tmp_file_path) . ') ' . strval($tmp_file_path) . '. ' .
                                strval($data) . ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        default:
                            //case 'file_path':

                            $tmp_err_str = 'CRNRSTN :: could not load the file in configuration for ' . $data_key . ', (' .
                                $this->oCRNRSTN->gettype($tmp_file_path) . ') ' . strval($tmp_file_path) . '. ' . strval($data) .
                                ', was the value that was provided as method input to this environment. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;

                    }

                    $this->oCRNRSTN->err_message_queue_push(NULL, $tmp_err_str);

                    return NULL;

                }

                //
                // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: UGC DATA INPUT [FILE PATH]
                switch($data_profile){
                    case 'config_load_system_settings_file_path':

                        //
                        // EXTRACT RESOURCE CONFIGURATION FROM FILE.
                        $this->oCRNRSTN->error_log('Including and evaluating the CRNRSTN :: system settings configuration file, ' .
                            $tmp_file_path . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                        //public function crnrstn_include_file($calling_method, $file_path, $file_method_name = 'include_once', $hash_algorithm = NULL, $hash_output_binary = false, $enable_file_validation = true){
                        $this->oCRNRSTN->crnrstn_include_file(__METHOD__, $tmp_file_path, 'include_once', NULL, false, false);

                    break;
                    case 'config_load_system_overrides_file_path':

                        //
                        // EXTRACT RESOURCE CONFIGURATION FROM FILE.
                        $this->oCRNRSTN->error_log('Including and evaluating the CRNRSTN :: system setting overrides configuration file, ' .
                            $tmp_file_path . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                        $this->oCRNRSTN->crnrstn_include_file(__METHOD__, $tmp_file_path, 'include_once', NULL, false, false);

                        //
                        // INITIALIZE CHANNEL REPORTING, QUEUE DATA MAPPING
                        // SEQUENCE (E.G. "GPHSJCDROF") FOR ACTIVE CHANNELS.
                        $this->oCRNRSTN->config_init_channel_map();

                        //
                        // APPLY SYSTEM SETTINGS OVERRIDES.
                        $this->oCRNRSTN->destruct_output .= '<pre><code>[' . $this->oCRNRSTN->return_micro_time()  . '] [lnum ' .  __LINE__ . '] [methd ' . __METHOD__ . '] [rtime ' . $this->oCRNRSTN->wall_time() . '] crnrstn BEGIN C<span style="color:#F90000;">R</span>NRSTN :: SYSTEM OVERRIDES. CALLING init_system_overrides().</code></pre>';
                        $this->oCRNRSTN->init_system_overrides();
                        $this->oCRNRSTN->destruct_output .= '<pre><code>[' . $this->oCRNRSTN->return_micro_time()  . '] [lnum ' .  __LINE__ . '] [methd ' . __METHOD__ . '] [rtime ' . $this->oCRNRSTN->wall_time() . '] crnrstn COMPLETED C<span style="color:#F90000;">R</span>NRSTN :: SYSTEM OVERRIDES.</code></pre>';

                    break;
                    case 'config_set_ui_theme_style_file_path':

                        $tmp_theme_attributes_ARRAY = array();

                        //
                        // EXTRACT RESOURCE CONFIGURATION FROM FILE.
                        $this->oCRNRSTN->error_log('Including and evaluating the CRNRSTN :: INTERACT UI theme settings configuration file, ' . $tmp_file_path . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                        $this->oCRNRSTN->crnrstn_include_file(__METHOD__, $tmp_file_path, 'include_once', NULL, false, false);

                        //
                        // INITIALIZE CRNRSTN :: INTERACT UI THEME PROFILE.
                        $this->theme_attributes_ARRAY = $tmp_theme_attributes_ARRAY;

                    break;
                    case 'config_include_social_media_file_path':

                        //
                        // EXTRACT RESOURCE CONFIGURATION FROM FILE.
                        $this->oCRNRSTN->error_log('Including and evaluating the CRNRSTN :: social media settings configuration file, ' . $tmp_file_path . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                        $this->oCRNRSTN->crnrstn_include_file(__METHOD__, $tmp_file_path, 'include_once', NULL, false, false);

                    break;
                    case 'config_include_wild_card_resources_file_path':

                        //
                        // EXTRACT RESOURCE CONFIGURATION FROM FILE.
                        $this->oCRNRSTN->error_log('Including and evaluating the CRNRSTN :: WILD CARD RESOURCES (WCR) settings configuration file, ' . $tmp_file_path . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                        $this->oCRNRSTN->crnrstn_include_file(__METHOD__, $tmp_file_path, 'include_once', NULL, false, false);

                    break;
                    case 'config_include_sql_silo_file_path':

                        //
                        // EXTRACT RESOURCE CONFIGURATION FROM FILE.
                        $this->oCRNRSTN->error_log('Including and evaluating the CRNRSTN :: SQL silo settings configuration file, ' . $tmp_file_path . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                        $this->oCRNRSTN->crnrstn_include_file(__METHOD__, $tmp_file_path, 'include_once', NULL, false, false);

                    break;
                    case 'config_add_database_file_path':

                        //
                        // EXTRACT RESOURCE CONFIGURATION FROM FILE.
                        $this->oCRNRSTN->error_log('Including and evaluating the database authentication settings configuration file, ' . $tmp_file_path . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                        $this->oCRNRSTN->crnrstn_include_file(__METHOD__, $tmp_file_path, 'include_once', NULL, false, false);

                    break;
                    case 'config_include_encryption_file_path':

                        //
                        // EXTRACT RESOURCE CONFIGURATION FROM FILE.
                        $this->oCRNRSTN->error_log('Including and evaluating the OpenSSL v' . $this->oCRNRSTN->version_openssl() . ' encryption profile settings configuration file, ' . $tmp_file_path . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                        $this->oCRNRSTN->crnrstn_include_file(__METHOD__, $tmp_file_path, 'include_once', NULL, false, false);

                    break;
                    case 'config_include_system_resources_file_path':

                        //
                        // EXTRACT RESOURCE CONFIGURATION FROM FILE.
                        $this->oCRNRSTN->error_log('Including and evaluating the system resources settings configuration file, ' . $tmp_file_path . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                        $this->oCRNRSTN->crnrstn_include_file(__METHOD__, $tmp_file_path, 'include_once', NULL, false, false);

                    break;
                    case 'config_include_seo_analytics_file_path':

                        //
                        // EXTRACT RESOURCE CONFIGURATION FROM FILE.
                        $this->oCRNRSTN->error_log('Including and evaluating the CRNRSTN :: SEO ANALYTICS settings configuration file, ' . $tmp_file_path . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                        $this->oCRNRSTN->crnrstn_include_file(__METHOD__, $tmp_file_path, 'include_once', NULL, false, false);

                    break;
                    case 'config_include_seo_engagement_file_path':

                        //
                        // EXTRACT RESOURCE CONFIGURATION FROM FILE.
                        $this->oCRNRSTN->error_log('Including and evaluating the CRNRSTN :: SEO ENGAGEMENT settings configuration file, ' . $tmp_file_path . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                        $this->oCRNRSTN->crnrstn_include_file(__METHOD__, $tmp_file_path, 'include_once', NULL, false, false);

                    break;
                    default:
                        //case 'file_path':
                        $this->oCRNRSTN->error_log('CRNRSTN :: is including and evaluating, ' . $tmp_file_path . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                        $this->oCRNRSTN->crnrstn_include_file(__METHOD__, $tmp_file_path, 'include_once', NULL, false, false);

                    break;

                }

                //
                // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: UGC DATA INPUT [DATABASE]
                $this->oCRNRSTN->input_data_value($tmp_file_path, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

            break;

            case 'config_set_timezone_default_timezone':
            case 'config_set_timezone_default_timezone_current':

                //
                // LIST OF SUPPORTED TIMEZONES.
                // SEE, https://www.php.net/manual/en/timezones.php
                // SEE, https://raw.githubusercontent.com/leon-do/Timezones/main/timezone.json
                // OR CALL $
                //
                $tmp_timezone = trim(strtolower($data));

                //
                // FOR PERFORMANCE REASONS, THIS SYNTAX ARRAY IS CALLED FROM
                // A STATIC STRUCT. FOR JUST-IN-TIME SYSTEM GENERATION,
                // PLEASE SEE, $this->return_timezone_syntax_array();
                //if(!isset(self::$timezone_syntax_ARRAY[$tmp_timezone])){
                if(!($this->oCRNRSTN->isset_crnrstn('timezone_syntax_ARRAY', $tmp_timezone) == true)){

                    //
                    // # # C # R # N # R # S # T # N # : : # # # #
                    // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [TIMEZONE]
                    switch($data_profile){
                        case 'config_set_timezone_default_timezone_current':

                            $tmp_err_str = 'CRNRSTN :: could not sync with the current timezone, "' .
                                $tmp_timezone . '", for this environment. "' . strval($data) . '", was the value provided. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        case 'config_set_timezone_default_timezone':

                            $tmp_err_str = 'CRNRSTN :: could not apply the timezone, "' . $tmp_timezone . '", that was provided to this environment. "' .
                                strval($data) . '", was the value provided. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        break;
                        default:

                            error_log(__LINE__ . ' ' . __METHOD__ . ' Unknown SWITCH CASE received [' . $data . '].');
                            $this->oCRNRSTN->error_log('Unknown SWITCH CASE received [' . $data . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                        break;
                    }

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    // # # C # R # N # R # S # T # N # : : # # # #
                    // CRNRSTN :: UGC DATA INPUT EXCEPTION [TIMEZONE]
                    $this->oCRNRSTN->err_message_queue_push(NULL, $tmp_err_str);

                    return NULL;

                }

                if($data_profile == 'config_set_timezone_default_timezone'){

                    //
                    // SET TIMEZONE.
                    $tmp_result = date_default_timezone_set($tmp_timezone);

                    //
                    // RETURNS FALSE IF THE TIMEZONE_ID ISN'T VALID, OR TRUE OTHERWISE.
                    if($tmp_result == false){

                        $tmp_err_str = 'CRNRSTN :: could not apply the timezone, "' . $tmp_timezone . '", that was provided to this environment. ' .
                            strval($data) . ', was the value provided. ' .
                            $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: UGC DATA INPUT EXCEPTION [TIMEZONE]
                        $this->oCRNRSTN->err_message_queue_push(NULL, $tmp_err_str);

                        return NULL;

                    }

                }

                //
                // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: UGC DATA INPUT [TIMEZONE]
                $this->oCRNRSTN->input_data_value($tmp_timezone, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

            break;

            case 'config_ip_grant_exclusive_access_ip_config':
            case 'config_ip_deny_access_ip_config':

                //
                // IP OR FILE PATH?
                $tmp_pos_path_str =  strpos($data,'_crnrstn.ip_authorization_manager.');

                //
                // HANDLE FILE PATH.
                if($tmp_pos_path_str !== false){

                    //
                    // EXPERIMENTAL (UNTIL WINDOWS TESTED) SANITIZATION OF
                    // DIRECTORY FILE PATH SLASHES FOR SYSTEM COMPATIBILITY.
                    $tmp_file_path = $this->oCRNRSTN->str_sanitize($data, DIRECTORY_SEPARATOR);

                    //
                    // THIS SHOULD BE A FILE.
                    if(is_file($tmp_file_path)){

                        switch($data_profile){
                            case 'config_grant_exclusive_access_file_path':

                                //
                                // EXTRACT RESOURCE CONFIGURATION FROM FILE.
                                $this->oCRNRSTN->error_log('Including and evaluating the CRNRSTN :: IP ADDRESS exclusive access settings configuration file, ' .
                                    $tmp_file_path . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                                $this->oCRNRSTN->crnrstn_include_file(__METHOD__, $tmp_file_path, 'include_once', NULL, false, false);

                            break;
                            case 'config_deny_access_file_path':

                                //
                                // EXTRACT RESOURCE CONFIGURATION FROM FILE.
                                $this->oCRNRSTN->error_log('Including and evaluating the CRNRSTN :: IP ADDRESS deny access settings configuration file, ' .
                                    $tmp_file_path . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                                $this->oCRNRSTN->crnrstn_include_file(__METHOD__, $tmp_file_path, 'include_once', NULL, false, false);

                            break;
                            default:

                                error_log(__LINE__ . ' ' . __METHOD__ . ' Unknown SWITCH CASE received [' . $data . '].');
                                $this->oCRNRSTN->error_log('Unknown SWITCH CASE received [' . $data . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                            break;

                        }

                    }else{

                        //
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [IP ADDRESS ACCESS]
                        switch($data_profile){
                            case 'config_grant_exclusive_access_file_path':

                                //
                                // WE COULD NOT FIND THE CONFIGURATION FILE.
                                $this->oCRNRSTN->error_log('File path data not recognized as a file. [' . $tmp_file_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
                                $tmp_err_str = 'CRNRSTN :: could not load the IP address "grant exclusive access" settings configuration file, ' .
                                    $data_key . ', (' . $this->oCRNRSTN->gettype($tmp_file_path) . ') ' . strval($tmp_file_path) . '. ' .
                                    strval($data) . ', was the value that was provided as method input to this environment. ' .
                                    $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                            break;
                            case 'config_deny_access_file_path':

                                //
                                // WE COULD NOT FIND THE CONFIGURATION FILE.
                                $this->oCRNRSTN->error_log('File path data not recognized as a file. [' .
                                    $tmp_file_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
                                $tmp_err_str = 'CRNRSTN :: could not load the IP address "deny access" settings configuration file, ' .
                                    $data_key . ', (' . $this->oCRNRSTN->gettype($tmp_file_path) . ') ' . strval($tmp_file_path) . '. ' .
                                    strval($data) . ', was the value that was provided as method input to this environment. ' .
                                    $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                            break;
                            default:

                                error_log(__LINE__ . ' ' . __METHOD__ . ' Unknown SWITCH CASE received [' . $data . '].');
                                $this->oCRNRSTN->error_log('Unknown SWITCH CASE received [' . $data . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                            break;

                        }

                        $this->oCRNRSTN->err_message_queue_push(NULL, $tmp_err_str);

                        return NULL;

                    }

                }else{

                    //
                    // IP ADDRESS UGC INPUT.

                    //
                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                    // # # C # R # N # R # S # T # N # : : # # # #
                    // CRNRSTN :: UGC DATA INPUT [IP ADDRESS ACCESS]
                    switch($data_key){
                        case 'config_grant_exclusive_access_file_path':
                            // RECEIVES UGC INPUT THAT IS EITHER A FILE PATH OR IP ADDRESS DATA.
                            // HERE...IP ADDRESS DATA.
                            //
                            // COMMA-DELIMITED IP ADDRESS / IP RANGE.
                            return $this->oCRNRSTN->set_crnrstn('ip_grant_exclusive_access', $data);

                            //
                            // NOTE :: THE CRNRSTN :: IP ADDRESS SECURITY POLICY ARTICULATES AN O.G.
                            //         METHOD FROM CRNRSTN :: v1.0.0, self::$oCRNRSTN_IP_MGR->exclusiveAccess($ip).
                            //
                            // Friday, December 1, 2023 @ 1133 hrs.

                        break;
                        case 'config_deny_access_file_path':
                            // RECEIVES UGC INPUT THAT IS EITHER A FILE PATH OR IP ADDRESS DATA.
                            // HERE...IP ADDRESS DATA.
                            //
                            // COMMA-DELIMITED IP ADDRESS / IP RANGE.
                            return $this->oCRNRSTN->set_crnrstn('ip_deny_access', $data);

                            //
                            // NOTE :: THE CRNRSTN :: IP ADDRESS SECURITY POLICY ARTICULATES AN O.G.
                            //         METHOD FROM CRNRSTN :: v1.0.0, self::$oCRNRSTN_IP_MGR->denyAccess($ip);
                            //
                            // Friday, December 1, 2023 @ 1134 hrs.

                        break;
                        default:

                            error_log(__LINE__ . ' ' . __METHOD__ . ' Unknown SWITCH CASE received [' . $data . '].');
                            $this->oCRNRSTN->error_log('Unknown SWITCH CASE received [' . $data . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                        break;

                    }

//                    //
//                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
//                    // # # C # R # N # R # S # T # N # : : # # # #
//                    // CRNRSTN :: UGC DATA INPUT [IP ADDRESS ACCESS]
//                    switch($data_profile){
//                        case 'config_grant_exclusive_access_file_path':
//
//                            if($tmp_force_data_err == true){
//
//                                //
//                                // IP ADDRESS / IP RANGE.
//
//
//                            }else{
//
//                                //
//                                // EXTRACT RESOURCE CONFIGURATION FROM FILE.
//                                $this->oCRNRSTN->error_log('Including and evaluating the IP address "grant exclusive access" settings configuration file, ' . $tmp_file_path . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
//
//                                $this->oCRNRSTN->crnrstn_include_file(__METHOD__, $tmp_file_path);
//
//                                $this->grant_accessIP_ARRAY[$this->config_serial_hash][$this->hash(self::$hmac_hash_algorithm_ARRAY['OPTIONS']['SERVER'][self::$hmac_hash_algorithm_ARRAY['DEFAULT'][CRNRSTN_INTEGER]], $env_key)] = $ip_or_file;
//
//                            }
//
//                            $this->oCRNRSTN->error_log('TODO :: FINISH INTEGRATIONS INTO CRNRSTN :: LIGHTSABER FOR ALL IP ADDRESS MGMT STUFF.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
//
//                        break;
//                        case 'config_deny_access_file_path':
//
//                            if($tmp_force_data_err == true){
//
//                                //
//                                // IP ADDRESS / IP RANGE.
//
//
//                            }else{
//
//                                //
//                                // EXTRACT RESOURCE CONFIGURATION FROM FILE.
//                                $this->oCRNRSTN->error_log('Including and evaluating the IP address "deny access" settings configuration file, ' . $tmp_file_path . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
//
//                                $this->oCRNRSTN->crnrstn_include_file(__METHOD__, $tmp_file_path);
//
//                            }
//
//                        break;
//                        default:
//                            //SILENCE IS GOLDEN.
//                        break;
//
//                    }
//
//                    $this->oCRNRSTN->input_data_value($tmp_file_path, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                }

            break;

            case 'config_add_database_database':
            case 'config_add_database_connection_database':

                //
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: UGC DATA VALIDATION INPUT AND
                // ERROR MESSAGE [DATABASE]
                switch($data_key){
                    case 'host':
                    case 'db_host_or_file_path':

                        //
                        // IP OR FILE PATH?
                        $tmp_pos_path_str =  strpos($data,'_crnrstn.db.config.inc.php');

                        //
                        // HANDLE FILE PATH.
                        if($tmp_pos_path_str !== false){

                            //
                            // EXPERIMENTAL (UNTIL WINDOWS TESTED) SANITIZATION OF
                            // DIRECTORY FILE PATH SLASHES FOR SYSTEM COMPATIBILITY.
                            $tmp_file_path = $this->oCRNRSTN->str_sanitize($data, DIRECTORY_SEPARATOR);

                            //
                            // THIS SHOULD BE A FILE.
                            if(is_file($tmp_file_path)){

                                //
                                // EXTRACT RESOURCE CONFIGURATION FROM FILE.
                                $this->oCRNRSTN->error_log('Including and evaluating the CRNRSTN :: DATABASE settings configuration file, ' .
                                    $tmp_file_path . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
                                $this->oCRNRSTN->crnrstn_include_file(__METHOD__, $tmp_file_path, 'include_once', NULL, false, false);

                            }else{

                                //
                                // PROCESS UGC INPUT OF DATABASE HOST.

                                //
                                // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                // # # C # R # N # R # S # T # N # : : # # # #
                                // CRNRSTN :: UGC DATA INPUT [DATABASE]
                                $this->oCRNRSTN->input_data_value($data, 'host', $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                            }

                        }

                    break;
                    case 'un':

                        if(isset($data)){

                            //
                            // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // CRNRSTN :: UGC DATA INPUT [DATABASE]
                            $this->oCRNRSTN->input_data_value($data, 'un', $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                        }

                    break;
                    case 'pwd':

                        if(isset($data)){

                            //
                            // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // CRNRSTN :: UGC DATA INPUT [DATABASE]
                            $this->oCRNRSTN->input_data_value($data, 'pwd', $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                        }

                    break;
                    case 'db':

                        if(isset($data)){

                            //
                            // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // CRNRSTN :: UGC DATA INPUT [DATABASE]
                            $this->oCRNRSTN->input_data_value($data, 'db', $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                        }

                    break;
                    case 'port':

                        if(isset($data)){

                            //
                            // THIS SHOULD BE A NUMBER.
                            if(is_numeric($data)){

                                $tmp_int = (int) $data;

                                //
                                // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                // # # C # R # N # R # S # T # N # : : # # # #
                                // CRNRSTN :: UGC DATA INPUT [DATABASE]
                                $this->oCRNRSTN->input_data_value($tmp_int, 'port', $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                            }else{

                                //
                                // IT WOULD CERTAINLY APPEAR THAT THIS
                                // IS NOT A VALID NUMBER FOR THE
                                // REQUESTED OPERATION.
                                //
                                // WE SHALL RUN AN INVALID CALCULATION.
                                //
                                // THIS MAY BE THE ONLY WAY THAT AN
                                // APPLICATION WHICH ABSOLUTELY LOVES
                                // NUMBERS (AS MUCH AS CRNRSTN :: HAS
                                // BEEN LOVING THE NUMBERS LATELY, AND
                                // EVEN IN THE MIDST OF "THESE ECONOMIC
                                // TIMES" AT THAT)...COULD EVEN BE ABLE
                                // TO ACQUIRE AN AUTHENTIC NaN (PLEASE
                                // READ AS "BAD DATA", OR EVEN BETTER,
                                // ...A PROPER SHIT VALUE) VALUE THAT
                                // CAN BE RELIABLY RETURNED WITH
                                // CONFIDENCE BY CRNRSTN ::
                                //
                                // CRNRSTN :: <3's
                                //          ...CRNRSTN_INTEGER's 4LIFE!
                                //
                                // SEE, https://www.php.net/manual/en/function.is-nan.php
                                $tmp_int = sqrt(-1);

                                $tmp_err_str = 'CRNRSTN :: could not apply the database port, ' . $tmp_int . '. ' .
                                    strval($data) . ', was the value that was provided as method input to this environment. ' .
                                    $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                $this->oCRNRSTN->err_message_queue_push(NULL, $tmp_err_str);

                                return NULL;

                            }

                        }

                    break;
                    default:
                        //SILENCE IS GOLDEN.
                        error_log(__LINE__ . ' ' . __METHOD__ . ' Unknown SWITCH CASE received [' . $data . '].');
                        $this->oCRNRSTN->error_log('Unknown SWITCH CASE received [' . $data . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                    break;

                }

//                //
//                // HANDLE FILE PATH.
//                if($tmp_pos_path_str !== false){
//
//                    //
//                    // EXPERIMENTAL (UNTIL WINDOWS TESTED) SANITIZATION OF
//                    // DIRECTORY FILE PATH SLASHES FOR SYSTEM COMPATIBILITY.
//                    $tmp_file_path = $this->oCRNRSTN->str_sanitize($data, DIRECTORY_SEPARATOR);
//
//                    //
//                    // THIS SHOULD BE A FILE.
//                    if(is_file($tmp_file_path)){
//
//                        //
//                        // TRACK ACCESSED CONFIGURATION FILES.
//                        // ACQUIRE FILE VERSIONING HASH.
//                        self::$system_files_version_hash_ARRAY[$tmp_file_path] = $this->oCRNRSTN->hash_file($tmp_file_path, NULL, false, true, $tmp_file_path);
//
//
//                    }else{
//
//                        //
//                        // # # C # R # N # R # S # T # N # : : # # # #
//                        // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [DATABASE]
//                        switch($data_key){
//                            case 'host_or_creds_path':
//
//                                //
//                                // WE COULD NOT FIND THE CONFIGURATION FILE.
//                                $this->oCRNRSTN->error_log('File path data not recognized as a file. [' . $tmp_file_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
//                                $tmp_err_str = 'CRNRSTN :: could not load the IP address "grant exclusive access" settings configuration file, ' . $data_key . ', (' . $this->oCRNRSTN->gettype($tmp_file_path) . ') ' . strval($tmp_file_path) . '. ' . strval($data) . ', was the value that was provided as method input to this environment. ' . $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');
//
//                            break;
//                            default:
//                                //case 'config_deny_access_file_path':
//
//                                //
//                                // WE COULD NOT FIND THE CONFIGURATION FILE.
//                                $this->oCRNRSTN->error_log('File path data not recognized as a file. [' . $tmp_file_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
//                                $tmp_err_str = 'CRNRSTN :: could not load the IP address "deny access" settings configuration file, ' . $data_key . ', (' . $this->oCRNRSTN->gettype($tmp_file_path) . ') ' . strval($tmp_file_path) . '. ' . strval($data) . ', was the value that was provided as method input to this environment. ' . $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');
//
//                            break;
//
//                        }
//
//                        $this->oCRNRSTN->err_message_queue_push(NULL, $tmp_err_str);
//
//                        return NULL;
//
//                    }
//
//                }else{
//
//                    //
//                    // IP ADDRESS UGC INPUT.
//
//                    //
//                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
//                    // # # C # R # N # R # S # T # N # : : # # # #
//                    // CRNRSTN :: UGC DATA INPUT [DATABASE]
//                    switch($data_key){
//                        case 'crnrstn_database_config_file_path':
//
//                            //
//                            // IP ADDRESS / IP RANGE.
//                            return $this->ip_exclusive_access($data);
//
//                        break;
//                        default:
//                            //case 'config_deny_access_file_path':
//
//                            //
//                            // IP ADDRESS / IP RANGE.
//                            return $this->ip_deny_access($data);
//
//                        break;
//
//                    }
//
//                }

            break;

            case 'config_include_sql_silo_query_silo':

                //
                // EXPERIMENTAL (UNTIL WINDOWS TESTED) SANITIZATION OF
                // DIRECTORY FILE PATH SLASHES FOR SYSTEM COMPATIBILITY.
                $tmp_file_path = $this->oCRNRSTN->str_sanitize($data, DIRECTORY_SEPARATOR);

                //
                // # # C # R # N # R # S # T # N # : : # # # #
                // CRNRSTN :: UGC DATA VALIDATION, INPUT, AND
                // ERROR MESSAGE [QUERY SILO]
                if(is_file($tmp_file_path)){

                    //
                    // EXTRACT RESOURCE CONFIGURATION FROM FILE.
                    $this->oCRNRSTN->error_log('Including and evaluating the CRNRSTN :: QUERY SILO settings configuration file, ' . $tmp_file_path . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                    $this->oCRNRSTN->crnrstn_include_file(__METHOD__, $tmp_file_path, 'include_once', NULL, false, false);

                    //
                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                    // # # C # R # N # R # S # T # N # : : # # # #
                    // CRNRSTN :: UGC DATA INPUT [QUERY SILO]
                    $this->oCRNRSTN->input_data_value($tmp_file_path, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                    //
                    // INSTANTIATE THE CRNRSTN :: DATABASE QUERY SILO CLASS OBJECT.
                    //
                    // Friday, December 1, 2023 @ 1254 hrs.
                    $this->oCRNRSTN->set_crnrstn('init_query_silo');

                }else{

                    //
                    // # # C # R # N # R # S # T # N # : : # # # #
                    // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [QUERY SILO]
                    $this->oCRNRSTN->error_log('File not found. File path data is not recognized as a file. [' . $tmp_file_path . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
                    $tmp_err_str = 'CRNRSTN :: could not load the CRNRSTN :: DATABASE QUERY SILO class definition and configuration file, ' . $data_key . ', (' . $this->oCRNRSTN->gettype($tmp_file_path) . ') ' . strval($tmp_file_path) . '. ' . strval($data) . ', was the value that was provided as method input to this environment. ' . $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                    $this->oCRNRSTN->err_message_queue_push(NULL, $tmp_err_str);

                    return NULL;

                }

            break;

            case 'config_admin_email_admin_email':

                switch($data_key){
                    case 'email_data':

                        //
                        // FORMAT EMAIL DATA INTO ARRAY.
                        $tmp_email_ARRAY = $this->oCRNRSTN->return_ugc_email_data_profile_ARRAY($data);
                        $tmp_count_email = count($tmp_email_ARRAY['EMAIL']);

                        for($i = 0; $i < $tmp_count_email; $i++){

                            //error_log(__LINE__ . ' crnrstn name[' . trim($tmp_email_ARRAY['RECIPIENT_NAME'][$i]) . '] email[' . $this->oCRNRSTN->str_sanitize($tmp_email_ARRAY['EMAIL'][$i], 'email_private') . '].');

                            //
                            // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // CRNRSTN :: UGC DATA INPUT [ADMIN EMAIL]
                            $this->oCRNRSTN->input_data_value($tmp_email_ARRAY['EMAIL'][$i], 'system_admin_email', $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);
                            $this->oCRNRSTN->input_data_value($this->oCRNRSTN->str_sanitize($tmp_email_ARRAY['EMAIL'][$i], 'email_private'), 'system_admin_email_display', $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);
                            $this->oCRNRSTN->input_data_value($tmp_email_ARRAY['RECIPIENT_NAME'][$i], 'system_admin_email_recipient_name', $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                            if(strlen($tmp_email_ARRAY['RECIPIENT_NAME'][$i]) > 0){

                                $this->oCRNRSTN->error_log('Storing administrative contact profile information [' .
                                    $tmp_email_ARRAY['RECIPIENT_NAME'][$i] . ', ' . $this->oCRNRSTN->str_sanitize($tmp_email_ARRAY['EMAIL'][$i], 'email_private') .
                                    '] in memory for environment key [' . $env_key . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                            }else{

                                $this->oCRNRSTN->error_log('Storing administrative contact profile information [' .
                                    $this->oCRNRSTN->str_sanitize($tmp_email_ARRAY['EMAIL'][$i], 'email_private') .
                                    '] in memory for environment key [' . $env_key . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                            }

                        }

                        //
                        // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: UGC DATA INPUT [ADMIN EMAIL]
                        $this->oCRNRSTN->input_data_value($data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                    break;
                    case 'max_login_attempts':

                        //
                        // THIS SHOULD BE A NUMBER.
                        if(is_numeric($data)){

                            $tmp_int = (int) $data;

                            //
                            // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // CRNRSTN :: UGC DATA INPUT [ADMIN EMAIL]
                            $this->oCRNRSTN->input_data_value($tmp_int, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                        }else{

                            //
                            // IT WOULD CERTAINLY APPEAR THAT THIS
                            // IS NOT A VALID NUMBER FOR THE
                            // REQUESTED OPERATION.
                            //
                            // WE SHALL RUN AN INVALID CALCULATION.
                            //
                            // THIS MAY BE THE ONLY WAY THAT AN
                            // APPLICATION WHICH ABSOLUTELY LOVES
                            // NUMBERS (AS MUCH AS CRNRSTN :: HAS
                            // BEEN LOVING THE NUMBERS LATELY, AND
                            // EVEN IN THE MIDST OF "THESE ECONOMIC
                            // TIMES" AT THAT)...COULD EVEN BE ABLE
                            // TO ACQUIRE AN AUTHENTIC NaN (PLEASE
                            // READ AS "BAD DATA", OR EVEN BETTER,
                            // ...A PROPER SHIT VALUE) VALUE THAT
                            // CAN BE RELIABLY RETURNED WITH
                            // CONFIDENCE BY CRNRSTN ::
                            //
                            // CRNRSTN :: <3's
                            //          ...CRNRSTN_INTEGER's 4LIFE!
                            //
                            // SEE, https://www.php.net/manual/en/function.is-nan.php
                            $tmp_int = sqrt(-1);

                            //
                            // LOAD SYSTEM SETTINGS DEFAULT DUE TO BAD UGC INPUT DATA.
                            $tmp_int_default = $this->oCRNRSTN->get_resource('max_login_attempts', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

                            $tmp_err_str = 'CRNRSTN :: could not determine max login attempts with the input, (' .
                                $this->oCRNRSTN->gettype($tmp_int) . ') ' . strval($tmp_int) . '. ' . strval($data) .
                                ', was the value provided. The system will manually set max login attempts to the settings default of ' .
                                $tmp_int_default . '. ' . $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');
                            $this->oCRNRSTN->error_log($tmp_err_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                            //
                            // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // CRNRSTN :: UGC DATA INPUT [ADMIN EMAIL]
                            $this->oCRNRSTN->input_data_value($tmp_int_default, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                        }

                    break;
                    case 'timeout_user_inactive':

                        //
                        // THIS SHOULD BE A NUMBER.
                        if(is_numeric($data)){

                            $tmp_int = (int) $data;

                            //
                            // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // CRNRSTN :: UGC DATA INPUT [ADMIN EMAIL]
                            $this->oCRNRSTN->input_data_value($tmp_int, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                        }else{

                            //
                            // IT WOULD CERTAINLY APPEAR THAT THIS
                            // IS NOT A VALID NUMBER FOR THE
                            // REQUESTED OPERATION.
                            //
                            // WE SHALL RUN AN INVALID CALCULATION.
                            //
                            // THIS MAY BE THE ONLY WAY THAT AN
                            // APPLICATION WHICH ABSOLUTELY LOVES
                            // NUMBERS (AS MUCH AS CRNRSTN :: HAS
                            // BEEN LOVING THE NUMBERS LATELY, AND
                            // EVEN IN THE MIDST OF "THESE ECONOMIC
                            // TIMES" AT THAT)...COULD EVEN BE ABLE
                            // TO ACQUIRE AN AUTHENTIC NaN (PLEASE
                            // READ AS "BAD DATA", OR EVEN BETTER,
                            // ...A PROPER SHIT VALUE) VALUE THAT
                            // CAN BE RELIABLY RETURNED WITH
                            // CONFIDENCE BY CRNRSTN ::
                            //
                            // CRNRSTN :: <3's
                            //          ...CRNRSTN_INTEGER's 4LIFE!
                            //
                            // SEE, https://www.php.net/manual/en/function.is-nan.php
                            $tmp_int = sqrt(-1);

                            //
                            // LOAD SYSTEM SETTINGS DEFAULT DUE TO BAD UGC INPUT DATA.
                            $tmp_int_default = $this->oCRNRSTN->get_resource('timeout_user_inactive', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

                            $tmp_err_str = 'CRNRSTN :: could not determine the seconds of inactivity before session timeout with the input, (' .
                                $this->oCRNRSTN->gettype($tmp_int) . ') ' . strval($tmp_int) . '. ' . strval($data) .
                                ', was the value provided. The system will manually set the inactivity timeout to the settings default of ' .
                                $tmp_int_default . '. ' . $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');
                            $this->oCRNRSTN->error_log($tmp_err_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                            //
                            // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // CRNRSTN :: UGC DATA INPUT [ADMIN EMAIL]
                            $this->oCRNRSTN->input_data_value($tmp_int_default, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                        }

                    break;

                }

            break;

            case 'apply_encryption_profile_encryption':

                //
                // NOTE: THE DATATYPE FAMILY IS LOCATED IN
                // AN ARRAY WHICH WILL COME WITH THIS DATA
                // SET AND BE STORED. WE WILL PASS THE
                // INTEGER CONSTANT IN AS DATA_TYPE_FAMILY
                // FOR THE ENCRYPTION SERVICES
                // CONFIGURATION FOR INPUT SIMPLICITY AT
                // THE POINT OF CAPTURE.
                //
                // Friday, October 3, 2023 @ 0540 hrs.
                $tmp_int_const = $data_type_family;
                $data_type_family = $this->oCRNRSTN->return_encryption_data_type_family($tmp_int_const);

                switch($tmp_int_const){
                    case CRNRSTN_ENCRYPT_GET:
                    case CRNRSTN_ENCRYPT_POST:
                    case CRNRSTN_ENCRYPT_COOKIE:
                    case CRNRSTN_ENCRYPT_SESSION:
                    case CRNRSTN_ENCRYPT_DATABASE:
                    case CRNRSTN_ENCRYPT_TUNNEL:
                    case CRNRSTN_ENCRYPT_SOAP:
                    case CRNRSTN_ENCRYPT_FILE:
                    case CRNRSTN_ENCRYPT_OERSL:

                        switch($data_key){
                            case 'encrypt_cipher':
                                // The cipher method. For a list of available cipher
                                // methods, use openssl_get_cipher_methods().

                                if($this->oCRNRSTN->is_valid_openssl_cipher($data, $data_key, $data_type_family) == true){

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [ENCRYPTION]
                                    $this->oCRNRSTN->input_data_value($data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                }else{

                                    $tmp_cipher = $this->oCRNRSTN->get_openssl_cipher_profile($data_key, $data_type_family, true);

                                    //
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [ENCRYPTION]
                                    $tmp_err_str = 'CRNRSTN :: could not verify the OpenSSL v' .
                                        $this->oCRNRSTN->version_openssl() . ' cipher, "' . $data .
                                        '", for this environment. "' . strval($data) . '", was the value provided. The OpenSSL cipher will manually be set to, "' .
                                        $tmp_cipher . '".' . $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');
                                    $this->oCRNRSTN->error_log($tmp_err_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [ENCRYPTION]
                                    $this->oCRNRSTN->input_data_value($tmp_cipher, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                }

                            break;
                            case 'encrypt_secret_key':
                                // The passphrase. If the passphrase is shorter than
                                // expected, it is silently padded with NUL characters;
                                // if the passphrase is longer than expected, it is
                                // silently truncated.

                                $tmp_str_len = strlen($data);

                                if($tmp_str_len < 10){

                                    //
                                    // TOO SMALL.

                                    //
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [ENCRYPTION]
                                    $tmp_err_str = 'CRNRSTN :: does not recommend use of a passphrase/secret key for OpenSSL v' .
                                        $this->oCRNRSTN->version_openssl() . ' that is less than 10 characters. A "' . strlen($data) .
                                        '" character string was provided. ' . $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');
                                    $this->oCRNRSTN->error_log($tmp_err_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [ENCRYPTION]
                                    $this->oCRNRSTN->input_data_value($data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                }else{

                                    if($tmp_str_len > 32){

                                        //
                                        // TOO BIG. THIS WILL BE TRUNCATED TO 32 BY OpenSSL.
                                        //
                                        // # # C # R # N # R # S # T # N # : : # # # #
                                        // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [ENCRYPTION]
                                        $tmp_err_str = 'CRNRSTN :: does not recommend use of a ' . strlen($data) .
                                            ' character long passphrase/secret key for OpenSSL v' .
                                            $this->oCRNRSTN->version_openssl() . '. A "' . strlen($data) .
                                            '" character long passphrase/secret key was provided, and this will be silently truncated to 32 chars by OpenSSL.' .
                                            $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');
                                        $this->oCRNRSTN->error_log($tmp_err_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                                        //
                                        // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                        // # # C # R # N # R # S # T # N # : : # # # #
                                        // CRNRSTN :: UGC DATA INPUT [ENCRYPTION]
                                        $this->oCRNRSTN->input_data_value($data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                    }

                                }

                            break;
                            case 'encrypt_options':
                                // options is a bitwise disjunction of the flags
                                // OPENSSL_RAW_DATA and OPENSSL_ZERO_PADDING.

                                //
                                // THIS SHOULD BE A NUMBER.
                                if(is_numeric($data)){

                                    $tmp_int = (int) $data;

                                }else{

                                    //
                                    // IT WOULD CERTAINLY APPEAR THAT THIS
                                    // IS NOT A VALID NUMBER FOR THE
                                    // REQUESTED OPERATION.
                                    //
                                    // WE SHALL RUN AN INVALID CALCULATION.
                                    //
                                    // THIS MAY BE THE ONLY WAY THAT AN
                                    // APPLICATION WHICH ABSOLUTELY LOVES
                                    // NUMBERS (AS MUCH AS CRNRSTN :: HAS
                                    // BEEN LOVING THE NUMBERS LATELY, AND
                                    // EVEN IN THE MIDST OF "THESE ECONOMIC
                                    // TIMES" AT THAT)...COULD EVEN BE ABLE
                                    // TO ACQUIRE AN AUTHENTIC NaN (PLEASE
                                    // READ AS "BAD DATA", OR EVEN BETTER,
                                    // ...A PROPER SHIT VALUE) VALUE THAT
                                    // CAN BE RELIABLY RETURNED WITH
                                    // CONFIDENCE BY CRNRSTN ::
                                    //
                                    // CRNRSTN :: <3's
                                    //          ...CRNRSTN_INTEGER's 4LIFE!
                                    //
                                    // SEE, https://www.php.net/manual/en/function.is-nan.php
                                    $tmp_int = sqrt(-1);

                                    //
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [ENCRYPTION]
                                    $tmp_err_str = 'CRNRSTN :: cannot use the provided options integer value, ' . $tmp_int .
                                        ', for OpenSSL v' . $this->oCRNRSTN->version_openssl() . '. ' . strval($data) .
                                        ', was the value provided. This will be manually set to OPENSSL_RAW_DATA[' . OPENSSL_RAW_DATA .
                                        ']. Options is a bitwise disjunction of the flags OPENSSL_RAW_DATA[' . OPENSSL_RAW_DATA . '] and OPENSSL_ZERO_PADDING[' .
                                        OPENSSL_ZERO_PADDING . ']. ' . $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');
                                    $this->oCRNRSTN->error_log($tmp_err_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                                    $tmp_int = OPENSSL_RAW_DATA;

                                }

                                //
                                // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                // # # C # R # N # R # S # T # N # : : # # # #
                                // CRNRSTN :: UGC DATA INPUT [ENCRYPTION]
                                $this->oCRNRSTN->input_data_value($tmp_int, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                            break;
                            case 'hmac_alg':

                                if($this->oCRNRSTN->is_valid_hmac_algorithm($data, $data_key, $data_type_family) == true){

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [ENCRYPTION]
                                    $this->oCRNRSTN->input_data_value($data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                }else{

                                    $tmp_hmac_algorithm = $this->oCRNRSTN->get_hmac_algorithm_profile($data_key, $data_type_family, true);

                                    //
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [ENCRYPTION]
                                    $tmp_err_str = 'CRNRSTN :: could not verify the HMAC Algorithm, "' . $data . '", for this environment. "' . strval($data) . '", was the value provided. The hmac algorithm will manually be set to, "' .  $tmp_hmac_algorithm . '".' . $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');
                                    $this->oCRNRSTN->error_log($tmp_err_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                                    //
                                    // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                    // # # C # R # N # R # S # T # N # : : # # # #
                                    // CRNRSTN :: UGC DATA INPUT [ENCRYPTION]
                                    $this->oCRNRSTN->input_data_value($tmp_hmac_algorithm, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                                }

                            break;
                            case 'data_profile_ARRAY':
                                // $tmp_data_profile_ARRAY['data_type_family'] = 'CRNRSTN::RESOURCE::TUNNEL_ENCRYPTION';
                                // $tmp_data_profile_ARRAY['data_type_title'] = 'CRNRSTN :: TUNNEL';
                                // $tmp_data_profile_ARRAY['data_type_encryption_channel'] = CRNRSTN_ENCRYPT_TUNNEL;

                                //
                                // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                // # # C # R # N # R # S # T # N # : : # # # #
                                // CRNRSTN :: UGC DATA INPUT [ENCRYPTION]
                                $this->oCRNRSTN->input_data_value($data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                            break;

                        }

                    break;

                }


//                    $tmp_digest = $this->oCRNRSTN->get_resource('openssl_digest', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');
//                    $tmp_cipher = $this->oCRNRSTN->get_resource('openssl_cipher', 0, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');
//
//                    self::$oCRNRSTN_CONFIG_MGR->input_data_value($encrypt_cipher, 'encrypt_cipher', $data_type_family, NULL, CRNRSTN_AUTHORIZE_RUNTIME, $env_key);
//                    self::$oCRNRSTN_CONFIG_MGR->input_data_value(openssl_digest($encrypt_secret_key, $tmp_digest, true), 'encrypt_secret_key', $data_type_family, NULL, CRNRSTN_AUTHORIZE_RUNTIME, $env_key);
//                    self::$oCRNRSTN_CONFIG_MGR->input_data_value($encrypt_options, 'encrypt_options', $data_type_family, NULL, CRNRSTN_AUTHORIZE_RUNTIME, $env_key);
//                    self::$oCRNRSTN_CONFIG_MGR->input_data_value($hmac_alg, 'hmac_alg', $data_type_family, NULL, CRNRSTN_AUTHORIZE_RUNTIME, $env_key);
//

            break;

            case 'config_init_logging_soap_logging_soap_service':

                //
                // FOR STABILITY, IF THE CRNRSTN :: SOAP SERVICES
                // LOGGING SERVICES LAYER OUTPUT PROFILE (INTEGER CONSTANT
                // OR BIT FIELD INTEGER REPRESENTATION) IS UNKNOWN, THE
                // RECOMMENDED BEHAVIOR FOR THROWN EXCEPTIONS SHOULD BE TO
                // FALL BACK TO CRNRSTN_LOG_DEFAULT. THIS WILL OUTPUT VIA
                // THE PHP NATIVE ERROR_LOG() A SLIGHTLY ENHANCED VERSION
                // OF THE PHP NATIVE SYSTEM STACK ERROR MESSAGE. NO OTHER
                // $oCRNRSTN->ERROR_LOG() OUTPUT WOULD BE SENT.
                switch($data_key){
                    case 'system_logging_output_profile':


                        //
                        // THIS SHOULD BE A NUMBER.
                        if(is_numeric($data)){

                            $tmp_int = (int) $data;

                            if(!($this->oCRNRSTN->isset_crnrstn('system_log_output_profile_constants_ARRAY', $tmp_int) == true)){

                                //
                                // IF NOT A VALID CRNRSTN :: LOGGING OUTPUT PROFILE CONSTANT, PASS
                                // THE LOGGING PROFILE INPUT THROUGH A STANDARDIZATION FILTER.
                                $tmp_int = $this->oCRNRSTN->get_system_logging_config($data, CRNRSTN_INTEGER);

                            }

                        }else{

                            //
                            // IT WOULD CERTAINLY APPEAR THAT THIS
                            // IS NOT A VALID NUMBER FOR THE
                            // REQUESTED OPERATION.
                            //
                            // IF NOT A NUMBER, PASS THE LOGGING PROFILE INPUT
                            // THROUGH A STANDARDIZATION FILTER.
                            $tmp_int = $this->oCRNRSTN->get_system_logging_config($data, CRNRSTN_INTEGER);

                        }

                    break;
                    case 'system_logging_profile_meta':

                        //
                        // ANY INPUT VALIDATION HERE WOULD NEED TO BE
                        // DONE THROUGH THE CRNRSTN :: SOAP SERVICES
                        // LOGGING SERVICES LAYER OUTPUT PROFILE
                        // OBJECT'S OWN UNIQUE LOGGING
                        // INITIALIZATION PROTOCOLS.
                        //
                        // Sunday, December 3, 2023 @ 0218 hrs.

                    break;
                    default:

                        $this->oCRNRSTN->error_log(__LINE__ . ' crnrstn MISSING SWITCH CASE[' . $data_key . ']. $data_profile[' . $data_profile . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
                        error_log(__LINE__ . ' crnrstn MISSING SWITCH CASE[' . $data_key . ']. $data_profile[' . $data_profile . '].');

                    break;

                }

                //
                // LET'S STRENGTHEN AND ENRICH THE
                // CRNRSTN :: SOAP SERVICES LOGGING
                // SERVICES LAYER.
                //
                // Sunday, December 3, 2023 @ 0045 hrs.
                switch($data_key){
                    case 'system_logging_output_profile':

                        //
                        // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: UGC DATA INPUT [CRNRSTN_LOGGING]
                        $this->oCRNRSTN->input_data_value($tmp_int, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                    break;
                    case 'profile_meta':

                        //
                        // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                        // # # C # R # N # R # S # T # N # : : # # # #
                        // CRNRSTN :: UGC DATA INPUT [CRNRSTN_LOGGING]
                        $this->oCRNRSTN->input_data_value($data, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                    break;
                    default:

                        $this->oCRNRSTN->error_log(__LINE__ . ' crnrstn MISSING SWITCH CASE[' . $data_key . ']. $data_profile[' . $data_profile . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
                        error_log(__LINE__ . ' crnrstn MISSING SWITCH CASE[' . $data_key . ']. $data_profile[' . $data_profile . '].');

                    break;

                }

                //
                // PROCESS BITWISE DATA DO THIS AFTER ENVIRONMENTAL DETECTION
                //self::$oCRNRSTN_BITFLIP_MGR->oCRNRSTN_BITWISE->set($logging_output_profile, true);
                //error_log(__LINE__ .' '. __METHOD__ .' crnrstn_environment to receive logging array[' . $this->crcINT($this->config_serial).'][' . $this->crcINT($env_key).']=[' . $logging_output_profile . ']');
                self::$system_logging_output_profile_ARRAY[$this->config_serial_hash][$tmp_env_hash][] = $logging_output_profile;

                if(isset($profile_meta)){

                    self::$sys_logging_meta_ARRAY[$this->config_serial_hash][$tmp_env_hash][] = $profile_meta;

                }else{

                    self::$sys_logging_meta_ARRAY[$this->config_serial_hash][$tmp_env_hash][] = '0';

                }

                //
                // PROCESS META DATA
                $this->oCRNRSTN->error_log('Logging profile data has been received for [' . $env_key . '].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

            break;
            case  'config_custom_error_handler_boolean':
            case  'config_custom_error_handler_integer':

                switch($data_key){
                    case 'crnrstn_error_handling':
                        //BOOLEAN

                        //
                        // FORMAT BOOLEAN.
                        $tmp_boolean = $this->oCRNRSTN->tidy_boolean($data);

                        if(!(is_bool($tmp_boolean))) {

                            //
                            // IT WOULD CERTAINLY APPEAR THAT THIS
                            // IS NOT A VALID NUMBER FOR THE
                            // REQUESTED OPERATION.
                            //
                            // WE SHALL RUN AN INVALID CALCULATION.
                            //
                            // THIS MAY BE THE ONLY WAY THAT AN
                            // APPLICATION WHICH ABSOLUTELY LOVES
                            // NUMBERS (AS MUCH AS CRNRSTN :: HAS
                            // BEEN LOVING THE NUMBERS LATELY, AND
                            // EVEN IN THE MIDST OF "THESE ECONOMIC
                            // TIMES" AT THAT)...COULD EVEN BE ABLE
                            // TO ACQUIRE AN AUTHENTIC NaN (PLEASE
                            // READ AS "BAD DATA", OR EVEN BETTER,
                            // ...A PROPER SHIT VALUE) VALUE THAT
                            // CAN BE RELIABLY RETURNED WITH
                            // CONFIDENCE BY CRNRSTN ::
                            //
                            // CRNRSTN :: <3's
                            //          ...CRNRSTN_INTEGER's 4LIFE!
                            //
                            // SEE, https://www.php.net/manual/en/function.is-nan.php
                            $tmp_boolean = sqrt(-1);

                            //
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [CRNRSTN_ERROR_HANDLING]
                            $tmp_err_str = 'CRNRSTN :: could not determine if custom error handling has been requested with the input, (' .
                                $this->oCRNRSTN->gettype($tmp_boolean) . ') ' . strval($tmp_boolean) . '. ' .
                                strval($data) . ', was the value provided. The system will manually set this to FALSE. ' .
                                $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                            $this->oCRNRSTN->err_message_queue_push(NULL, $tmp_err_str);

                            //
                            // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // CRNRSTN :: UGC DATA INPUT [CRNRSTN_ERROR_HANDLING]
                            $this->oCRNRSTN->input_data_value(false, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                            return NULL;

                        }else{

                            //
                            // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // CRNRSTN :: UGC DATA INPUT [CRNRSTN_ERROR_HANDLING]
                            $this->oCRNRSTN->input_data_value($tmp_boolean, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                        }

                    break;
                    case 'err_reporting_profile':
                        //INTEGER

                        //
                        // THIS SHOULD BE A NUMBER.
                        if(is_numeric($data)){

                            $tmp_int = (int) $data;

                        }else{

                            //
                            // IT WOULD CERTAINLY APPEAR THAT THIS
                            // IS NOT A VALID NUMBER FOR THE
                            // REQUESTED OPERATION.
                            //
                            // WE SHALL RUN AN INVALID CALCULATION.
                            //
                            // THIS MAY BE THE ONLY WAY THAT AN
                            // APPLICATION WHICH ABSOLUTELY LOVES
                            // NUMBERS (AS MUCH AS CRNRSTN :: HAS
                            // BEEN LOVING THE NUMBERS LATELY, AND
                            // EVEN IN THE MIDST OF "THESE ECONOMIC
                            // TIMES" AT THAT)...COULD EVEN BE ABLE
                            // TO ACQUIRE AN AUTHENTIC NaN (PLEASE
                            // READ AS "BAD DATA", OR EVEN BETTER,
                            // ...A PROPER SHIT VALUE) VALUE THAT
                            // CAN BE RELIABLY RETURNED WITH
                            // CONFIDENCE BY CRNRSTN ::
                            //
                            // CRNRSTN :: <3's
                            //          ...CRNRSTN_INTEGER's 4LIFE!
                            //
                            // SEE, https://www.php.net/manual/en/function.is-nan.php
                            $tmp_int = sqrt(-1);

                        }

                        if(is_nan($tmp_int)){

                            //$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'custom_error_reporting_profile', NULL, 'CRNRSTN::RESOURCE::CUSTOM_ERROR_HANDLING');
                            // $tmp_ = $this->get_resource('err_reporting_profile', 0, 'CRNRSTN::RESOURCE::CONFIGURATION');
                            // $tmp_ = $this->get_resource_count('err_reporting_profile', 'CRNRSTN::RESOURCE::CONFIGURATION');

                            if($this->oCRNRSTN->isset_resource('data_value', 'custom_error_reporting_profile', 'CRNRSTN::RESOURCE::CUSTOM_ERROR_HANDLING') == true){

                                $tmp_settings_err_int = $this->oCRNRSTN->get_resource('custom_error_reporting_profile', 0, 'CRNRSTN::RESOURCE::CUSTOM_ERROR_HANDLING');

                                if($tmp_settings_err_int != NULL){

                                    //
                                    // THIS SHOULD BE A NUMBER.
                                    if(is_numeric($tmp_settings_err_int)){

                                        $tmp_int = (int) $tmp_settings_err_int;

                                    }else{

                                        //
                                        // IT WOULD CERTAINLY APPEAR THAT THIS
                                        // IS NOT A VALID NUMBER FOR THE
                                        // REQUESTED OPERATION.
                                        //
                                        // WE SHALL RUN AN INVALID CALCULATION.
                                        //
                                        // THIS MAY BE THE ONLY WAY THAT AN
                                        // APPLICATION WHICH ABSOLUTELY LOVES
                                        // NUMBERS (AS MUCH AS CRNRSTN :: HAS
                                        // BEEN LOVING THE NUMBERS LATELY, AND
                                        // EVEN IN THE MIDST OF "THESE ECONOMIC
                                        // TIMES" AT THAT)...COULD EVEN BE ABLE
                                        // TO ACQUIRE AN AUTHENTIC NaN (PLEASE
                                        // READ AS "BAD DATA", OR EVEN BETTER,
                                        // ...A PROPER SHIT VALUE) VALUE THAT
                                        // CAN BE RELIABLY RETURNED WITH
                                        // CONFIDENCE BY CRNRSTN ::
                                        //
                                        // CRNRSTN :: <3's
                                        //          ...CRNRSTN_INTEGER's 4LIFE!
                                        //
                                        // SEE, https://www.php.net/manual/en/function.is-nan.php
                                        $tmp_int = sqrt(-1);

                                    }

                                    $tmp_settings_err_int_override = NULL;
                                    if(!is_nan($tmp_int)){

                                        $tmp_settings_err_int_override = $tmp_int;

                                    }

                                }

                            }

                            if(!isset($tmp_settings_err_int_override)){

                                //
                                // # # C # R # N # R # S # T # N # : : # # # #
                                // CRNRSTN :: UGC DATA VALIDATION ERROR MESSAGE [INTEGER]
                                $tmp_err_str = 'CRNRSTN :: could not understand the provided error reporting profile according to the input, (' .
                                    $this->oCRNRSTN->gettype($tmp_int) . ') ' . strval($tmp_int) . '. ' .
                                    strval($data) . ', was the value provided. ' .
                                    $this->oCRNRSTN->data_report($data, 'CRNRSTN :: MC-DDO INPUT DATA REPORT');

                                $this->oCRNRSTN->err_message_queue_push(NULL, $tmp_err_str);

                                return NULL;

                            }else{


                                //
                                // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                                // # # C # R # N # R # S # T # N # : : # # # #
                                // CRNRSTN :: UGC DATA INPUT [CRNRSTN_LOGGING]
                                $this->oCRNRSTN->input_data_value($tmp_settings_err_int_override, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                            }

                        }else{

                            //
                            // CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (MC-DDO) SERVICES LAYER.
                            // # # C # R # N # R # S # T # N # : : # # # #
                            // CRNRSTN :: UGC DATA INPUT [CRNRSTN_LOGGING]
                            $this->oCRNRSTN->input_data_value($tmp_int, $data_key, $data_type_family, $index, $data_authorization_profile, $ttl, $spool_resource, $env_key);

                        }

                    break;

                }

            break;
            default:

                error_log(__LINE__ . ' crnrstn MISSING SWITCH CASE[' . $data_key . ']. $data_profile[' . $data_profile . '].');
                return NULL;

            break;

        }

        return true;

    }

    public function crnrstn_custom_error_handler(){

        //
        // APPLY SERVER ERROR HANDLING PER
        // SETTINGS RECEIVED THROUGH $oCRNRSTN->config_custom_error_handler();
        $tmp_is_active_bool = $this->oCRNRSTN->get_resource('crnrstn_error_handling', 0, 'CRNRSTN::RESOURCE::CUSTOM_ERROR_HANDLING');

        if($tmp_is_active_bool == true){

            $this->oCRNRSTN->error_log('Resetting error handling at this server to the PHP defaults.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);
            restore_error_handler();

            $tmp_err_reporting_profile = (int) $this->oCRNRSTN->get_resource('err_reporting_profile', 0, 'CRNRSTN::RESOURCE::CUSTOM_ERROR_HANDLING');

            if(is_numeric($tmp_err_reporting_profile)){

                $this->oCRNRSTN->error_log('Initializing CRNRSTN :: to handle errors at this server per a custom error level constants reporting profile represented as an aggregate by the integer value, ' . $tmp_err_reporting_profile . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);
                $this->oCRNRSTN->apply_CRNRSTN_asErrorHandler($tmp_err_reporting_profile);

                return $tmp_err_reporting_profile;

            }else{

                $this->oCRNRSTN->error_log('Due to an invalid error reporting profile, (' . $this->oCRNRSTN->gettype($tmp_err_reporting_profile) . ') ' . strval($tmp_err_reporting_profile) . ', the default PHP error level constants reporting profile will remain in place. For PHP 5.3 or later, the default is E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);

                return NULL;
            }

        }else{

            $this->oCRNRSTN->error_log('Resetting error handling at this server to the PHP defaults. For PHP 5.3 or later, the default is E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);
            restore_error_handler();

            return NULL;

        }

    }

    public function __destruct(){


    }

}