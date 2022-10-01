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
#  CLASS :: crnrstn_performance_regulator
#  VERSION :: 1.00.0000
#  DATE :: March 22, 2021 @ 0226 hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: Oversight of CPU, memory and server resource utilization and runtime management.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_performance_regulator{

    protected $oLogger;

    public $process_id;
    public $operating_system;
    public $starttime;

    public $system_integer_meta_lookup_ARRAY = array();
    public $system_integer_meta_cache_ARRAY = array();
    private static $config_relevant_ini_values_ARRAY = array();

    protected $php_ini_val = array();

    protected $max_storage_utilization;
    protected $max_storage_utilization_warning;
    protected $byte_capacity;
    protected $hard_disk_volume_size_bytes;
    protected $disk_capacity_bytes_ARRAY = array();
    protected $disk_size_bytes_ARRAY = array();

    public function __construct($oCRNRSTN) {

        $this->starttime = $oCRNRSTN->starttime;
        $this->max_storage_utilization = $oCRNRSTN->max_storage_utilization;
        $this->max_storage_utilization_warning = $oCRNRSTN->max_storage_utilization_warning;

        $this->snapshot_ini_values($oCRNRSTN);

        $this->oCRNRSTN = $oCRNRSTN;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN);

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
        <?php $pids = array_column(array_map('str_getcsv', explode("\n",trim(`tasklist /FO csv /NH`))), 1); ?>.
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
//        switch($profile_name) {
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

    public function grant_permissions_fwrite($filepath, $minimum_bytes_required){

        if($this->return_available_byte_capacity($filepath, $minimum_bytes_required)){

            return true;

        }

        return false;

    }

    public function get_performance_metric($profile_name, $env_key = CRNRSTN_RESOURCE_ALL){

        $profile_name = strtolower($profile_name);

        switch($profile_name){
            case 'maximum_disk_use_warning':

                return $this->max_storage_utilization_warning;

            break;
            case 'maximum_disk_use':

                return $this->max_storage_utilization;

            break;

        }

        return '';

    }

    private function snapshot_ini_values($oCRNRSTN){

        foreach (self::$config_relevant_ini_values_ARRAY as $key => $ini_value_nom ){

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

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function return_available_byte_capacity($filepath, $required_bytes = 0){

        //
        // TOTAL AVAILABLE STORAGE SIZE AT DESTINATION (bytes)
        $this->hard_disk_bytes_capacity_total = $this->return_disk_free_space($filepath);
        $this->hard_disk_bytes_volume_size = $this->return_hard_disk_size($filepath);
        $this->hard_disk_bytes_capacity_total_pretty = $this->oCRNRSTN->format_bytes($this->hard_disk_bytes_capacity_total, 5);
        $required_bytes_pretty = $this->oCRNRSTN->format_bytes($required_bytes, 4);

        //
        // CALCULATE PERCENTAGE UTILIZATION OF REQUEST
        $percentage_utilization_ask = 100 - ((($required_bytes + ($this->hard_disk_bytes_volume_size - $this->hard_disk_bytes_capacity_total)) / $this->hard_disk_bytes_volume_size) * 100);

        //
        // DISK FULL WARNING
        if($percentage_utilization_ask > $this->max_storage_utilization_warning){

            $this->oCRNRSTN->error_log('WARNING: maximum permitted disk storage will be reached soon. ' . $this->oCRNRSTN->number_format_keep_precision($percentage_utilization_ask, 3) . '% of the disk volume is used. ' . $this->oCRNRSTN->number_format_keep_precision($this->max_storage_utilization, 3) . '% is the configured maximum. For the record, ' . $this->oCRNRSTN->format_bytes($this->hard_disk_bytes_capacity_total) . ' are available at ' . $filepath . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
            $this->oCRNRSTN->print_r('WARNING: maximum permitted disk storage will be reached soon. ' . $this->oCRNRSTN->number_format_keep_precision($percentage_utilization_ask, 3) . '% of the disk volume is used. ' . $this->oCRNRSTN->number_format_keep_precision($this->max_storage_utilization, 3) . '% is the configured maximum. For the record, ' . $this->oCRNRSTN->format_bytes($this->hard_disk_bytes_capacity_total) . ' are available at ' . $filepath . '.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

            return false;

        }

//        else{
//
//            $this->oCRNRSTN->error_log('FAKEY-WARNING: maximum permitted disk storage will NOT be reached soon. ' . $this->oCRNRSTN->number_format_keep_precision($percentage_utilization_ask, 3) . '% of the disk volume is used. ' . $this->oCRNRSTN->number_format_keep_precision($this->max_storage_utilization, 3) . '% is the configured maximum. For the record, ' . $this->oCRNRSTN->format_bytes($this->hard_disk_bytes_capacity_total) . ' are available at ' . $filepath . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
//            $this->oCRNRSTN->print_r('FAKEY-WARNING: maximum permitted disk storage will NOT be reached soon. ' . $this->oCRNRSTN->number_format_keep_precision($percentage_utilization_ask, 3) . '% of the disk volume is used. ' . $this->oCRNRSTN->number_format_keep_precision($this->max_storage_utilization, 3) . '% is the configured maximum. For the record, ' . $this->oCRNRSTN->format_bytes($this->hard_disk_bytes_capacity_total) . ' are available at ' . $filepath . '.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
//
//        }

        //
        // DISK FULL ERROR
        if($percentage_utilization_ask > $this->max_storage_utilization){

            $this->oCRNRSTN->error_log('DISK FULL ERROR: Maximum storage utilization has been reached with an additional request which would result in ' . $this->oCRNRSTN->number_format_keep_precision($percentage_utilization_ask, 3) . '% usage of the disk volume. ' . $this->oCRNRSTN->number_format_keep_precision($this->max_storage_utilization, 3) . '% is the currently configured maximum. For the record, ' . $this->oCRNRSTN->format_bytes($this->hard_disk_bytes_capacity_total) . ' are available at ' . $filepath . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
            $this->oCRNRSTN->print_r('DISK FULL ERROR: Maximum storage utilization has been reached with an additional request which would result in ' . $this->oCRNRSTN->number_format_keep_precision($percentage_utilization_ask, 3) . '% usage of the disk volume. ' . $this->oCRNRSTN->number_format_keep_precision($this->max_storage_utilization, 3) . '% is the currently configured maximum. For the record, ' . $this->oCRNRSTN->format_bytes($this->hard_disk_bytes_capacity_total) . ' are available at ' . $filepath . '.', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);

            return false;

        }

//        else{
//
//            $this->oCRNRSTN->error_log('FAKEY-DISK FULL ERROR: Maximum storage utilization has NOT been reached with an additional request which would result in ' . $this->oCRNRSTN->number_format_keep_precision($percentage_utilization_ask, 3) . '% usage of the disk volume. ' . $this->oCRNRSTN->number_format_keep_precision($this->max_storage_utilization, 3) . '% is the currently configured maximum. For the record, ' . $this->oCRNRSTN->format_bytes($this->hard_disk_bytes_capacity_total) . ' are available at ' . $filepath . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
//            $this->oCRNRSTN->print_r('FAKEY-DISK FULL ERROR: Maximum storage utilization has NOT been reached with an additional request which would result in ' . $this->oCRNRSTN->number_format_keep_precision($percentage_utilization_ask, 3) . '% usage of the disk volume. ' . $this->oCRNRSTN->number_format_keep_precision($this->max_storage_utilization, 3) . '% is the currently configured maximum. For the record, ' . $this->oCRNRSTN->format_bytes($this->hard_disk_bytes_capacity_total) . ' are available at ' . $filepath . '.', 'Image Processing.', CRNRSTN_UI_PHPNIGHT, __LINE__, __METHOD__, __FILE__);
//
//        }

        //
        // RETURN PERCENTAGE DISK UTILIZATION...IF THE EXPECTED $required_bytes BYTES WOULD BE BURNED TO DISK
        return $percentage_utilization_ask;

    }

    private function _getServerLoadLinuxData(){
        if (is_readable("/proc/stat")) {

            $stats = @file_get_contents("/proc/stat");

            if ($stats !== false) {

                // Remove double spaces to make it easier to extract values with explode()
                $stats = preg_replace("/[[:blank:]]+/", " ", $stats);

                // Separate lines
                $stats = str_replace(array("\r\n", "\n\r", "\r"), "\n", $stats);
                $stats = explode("\n", $stats);

                // Separate values and find line for main CPU load
                foreach ($stats as $statLine){

                    $statLineData = explode(" ", trim($statLine));

                    // Found!
                    if((count($statLineData) >= 5) && ($statLineData[0] == "cpu")){

                        return array(
                            $statLineData[1],
                            $statLineData[2],
                            $statLineData[3],
                            $statLineData[4],
                        );

                    }
                }
            }
        }

        return null;

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.sys-getloadavg.php
    // AUTHOR :: stanislav dot eckert at vizson dot de :: https://www.php.net/manual/en/function.sys-getloadavg.php#118673
    // Returns server load in percent (just number, without percent sign)
    private function getServerLoad(){

        $load = null;

        if (stristr(PHP_OS, "win")){

            $cmd = "wmic cpu get loadpercentage /all";
            @exec($cmd, $output);

            if ($output){

                foreach ($output as $line){

                    if ($line && preg_match("/^[0-9]+\$/", $line)){

                        $load = $line;

                        break;
                    }

                }

            }

        }else{

            if (is_readable("/proc/stat")){

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
    private function getServerMemoryUsage($getPercentage=true){

        $memoryTotal = null;
        $memoryFree = null;

        if ($this->operating_system == 'WIN') {
            // Get total physical memory (this is in bytes)
            $cmd = "wmic ComputerSystem get TotalPhysicalMemory";
            @exec($cmd, $outputTotalPhysicalMemory);

            // Get free physical memory (this is in kibibytes!)
            $cmd = "wmic OS get FreePhysicalMemory";
            @exec($cmd, $outputFreePhysicalMemory);

            if ($outputTotalPhysicalMemory && $outputFreePhysicalMemory) {
                // Find total value
                foreach ($outputTotalPhysicalMemory as $line) {
                    if ($line && preg_match("/^[0-9]+\$/", $line)) {
                        $memoryTotal = $line;
                        break;
                    }
                }

                // Find free value
                foreach ($outputFreePhysicalMemory as $line) {
                    if ($line && preg_match("/^[0-9]+\$/", $line)) {
                        $memoryFree = $line;
                        $memoryFree *= 1024;  // convert from kibibytes to bytes
                        break;
                    }
                }
            }
        }
        else
        {
            if (is_readable("/proc/meminfo"))
            {
                $stats = @file_get_contents("/proc/meminfo");

                if ($stats !== false) {
                    // Separate lines
                    $stats = str_replace(array("\r\n", "\n\r", "\r"), "\n", $stats);
                    $stats = explode("\n", $stats);

                    // Separate values and find correct lines for total and free mem
                    foreach ($stats as $statLine) {
                        $statLineData = explode(":", trim($statLine));

                        //
                        // Extract size (TODO: It seems that (at least) the two values for total and free memory have the unit "kB" always. Is this correct?
                        //

                        // Total memory
                        if (count($statLineData) == 2 && trim($statLineData[0]) == "MemTotal") {
                            $memoryTotal = trim($statLineData[1]);
                            $memoryTotal = explode(" ", $memoryTotal);
                            $memoryTotal = $memoryTotal[0];
                            $memoryTotal *= 1024;  // convert from kibibytes to bytes
                        }

                        // Free memory
                        if (count($statLineData) == 2 && trim($statLineData[0]) == "MemFree") {
                            $memoryFree = trim($statLineData[1]);
                            $memoryFree = explode(" ", $memoryFree);
                            $memoryFree = $memoryFree[0];
                            $memoryFree *= 1024;  // convert from kibibytes to bytes
                        }
                    }
                }
            }
        }

        if (is_null($memoryTotal) || is_null($memoryFree)) {
            return null;
        } else {
            if ($getPercentage) {
                return (100 - ($memoryFree * 100 / $memoryTotal));
            } else {

                return array(
                    "total" => $memoryTotal,
                    "free" => $memoryFree,
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

    public function return_constants_integer($int_constant){

        //
        // WORK IN PROGRESS.
        // NEED TO TAKE STRING 'CRNRSTN_RESOURCE_ALL' AND RETURN INTEGER CONSTANT CRNRSTN_RESOURCE_ALL
        $tmp_str_out = '';

        if(in_array($int_constant, $this->system_integer_meta_lookup_ARRAY)){

            //error_log(__LINE__ .  '  performance $int_constant[' . $int_constant . '] from cache.');
            return $this->system_integer_meta_cache_ARRAY[$int_constant]['INTEGER'];

        }

        switch($int_constant){
            case CRNRSTN_DEBUG_OFF:

                $tmp_str_out = 'CRNRSTN_DEBUG_OFF';

            break;
            case CRNRSTN_DEBUG_NATIVE_ERR_LOG:

                $tmp_str_out = 'CRNRSTN_DEBUG_NATIVE_ERR_LOG';

            break;
            case CRNRSTN_DEBUG_AGGREGATION_ON:

                $tmp_str_out = 'CRNRSTN_DEBUG_AGGREGATION_ON';

            break;
            case CRNRSTN_LOG_NONE:

                $tmp_str_out = 'CRNRSTN_LOG_NONE';

            break;
            case CRNRSTN_LOG_ALL:

                $tmp_str_out = 'CRNRSTN_LOG_ALL';

            break;
            case CRNRSTN_AUTHORIZED_ACCOUNT:

                $tmp_str_out = 'CRNRSTN_AUTHORIZED_ACCOUNT';

            break;
            case CRNRSTN_INTEGER_LENGTH:

                $tmp_str_out = 'CRNRSTN_INTEGER_LENGTH';

            break;
            case CRNRSTN_SETTINGS_APACHE:

                $tmp_str_out = 'CRNRSTN_SETTINGS_APACHE';

            break;
            case CRNRSTN_SETTINGS_MYSQLI:

                $tmp_str_out = 'CRNRSTN_SETTINGS_MYSQLI';

            break;
            case CRNRSTN_SETTINGS_PHP:

                $tmp_str_out = 'CRNRSTN_SETTINGS_PHP';

            break;
            case CRNRSTN_SETTINGS_CRNRSTN:

                $tmp_str_out = 'CRNRSTN_SETTINGS_CRNRSTN';

            break;
            case CRNRSTN_SETTINGS_WORDPRESS:

                $tmp_str_out = 'CRNRSTN_SETTINGS_WORDPRESS';

            break;
            case CRNRSTN_SETTINGS_CLIENT:

                $tmp_str_out = 'CRNRSTN_SETTINGS_CLIENT';

            break;
            case CRNRSTN_INPUT_OPTIONAL:

                $tmp_str_out = 'CRNRSTN_INPUT_OPTIONAL';

            break;
            case CRNRSTN_INPUT_REQUIRED:

                $tmp_str_out = 'CRNRSTN_INPUT_REQUIRED';

            break;
            case CRNRSTN_INPUT_PASSWORD:

                $tmp_str_out = 'CRNRSTN_INPUT_PASSWORD';

            break;
            case CRNRSTN_INPUT_IS_EMAIL:

                $tmp_str_out = 'CRNRSTN_INPUT_IS_EMAIL';

            break;
            case CRNRSTN_INPUT_CHAR_RESTRICTIONS:

                $tmp_str_out = 'CRNRSTN_INPUT_CHAR_RESTRICTIONS';

            break;
            case CRNRSTN_INPUT_CHAR_LIMITS:

                $tmp_str_out = 'CRNRSTN_INPUT_CHAR_LIMITS';

            break;
            case CRNRSTN_INPUT_IS_FILE_IMAGE:

                $tmp_str_out = 'CRNRSTN_INPUT_IS_FILE_IMAGE';

            break;
            case CRNRSTN_INPUT_IS_FILE_IMAGE_PNG:

                $tmp_str_out = 'CRNRSTN_INPUT_IS_FILE_IMAGE_PNG';

            break;
            case CRNRSTN_INPUT_IS_FILE_IMAGE_JPEG:

                $tmp_str_out = 'CRNRSTN_INPUT_IS_FILE_IMAGE_JPEG';

            break;
            case CRNRSTN_INPUT_IS_FILE_IMAGE_GIF:

                $tmp_str_out = 'CRNRSTN_INPUT_IS_FILE_IMAGE_GIF';

            break;
            case CRNRSTN_INPUT_IS_FILE_DOCUMENT:

                $tmp_str_out = 'CRNRSTN_INPUT_IS_FILE_DOCUMENT';

            break;
            case CRNRSTN_INPUT_IS_FILE_ZIP:

                $tmp_str_out = 'CRNRSTN_INPUT_IS_FILE_ZIP';

            break;
            case CRNRSTN_DATABASE:

                $tmp_str_out = 'CRNRSTN_DATABASE';

            break;
            case CRNRSTN_DATABASE_CONNECTION:

                $tmp_str_out = 'CRNRSTN_DATABASE_CONNECTION';

            break;
            case CRNRSTN_DATABASE_QUERY:

                $tmp_str_out = 'CRNRSTN_DATABASE_QUERY';

            break;
            case CRNRSTN_DATABASE_QUERY_SILO:

                $tmp_str_out = 'CRNRSTN_DATABASE_QUERY_SILO';

            break;
            case CRNRSTN_DATABASE_QUERY_DYNAMIC:

                $tmp_str_out = 'CRNRSTN_DATABASE_QUERY_DYNAMIC';

            break;
            case CRNRSTN_DATABASE_RESULT:

                $tmp_str_out = 'CRNRSTN_DATABASE_RESULT';

            break;
            case CRNRSTN_GABRIEL:

                $tmp_str_out = 'CRNRSTN_GABRIEL';

            break;
            case CRNRSTN_SMTP_AUTHENTICATION:

                $tmp_str_out = 'CRNRSTN_SMTP_AUTHENTICATION';

            break;
            case CRNRSTN_EMAIL_CRNRSTN_SOURCE:

                $tmp_str_out = 'CRNRSTN_EMAIL_CRNRSTN_SOURCE';

            break;
            case CRNRSTN_EMAIL_USER_SOURCE:

                $tmp_str_out = 'CRNRSTN_EMAIL_USER_SOURCE';

            break;
            case CRNRSTN_ELECTRUM:

                $tmp_str_out = 'CRNRSTN_ELECTRUM';

            break;
            case CRNRSTN_ELECTRUM_THREAD:

                $tmp_str_out = 'CRNRSTN_ELECTRUM_THREAD';

            break;
            case CRNRSTN_ELECTRUM_COMM:

                $tmp_str_out = 'CRNRSTN_ELECTRUM_COMM';

            break;
            case CRNRSTN_ELECTRUM_FTP:

                $tmp_str_out = 'CRNRSTN_ELECTRUM_FTP';

            break;
            case CRNRSTN_ELECTRUM_LOCALDIR:

                $tmp_str_out = 'CRNRSTN_ELECTRUM_LOCALDIR';

            break;
            case CRNRSTN_FILE_MANAGEMENT:

                $tmp_str_out = 'CRNRSTN_FILE_MANAGEMENT';

            break;
            case CRNRSTN_SOAP:

                $tmp_str_out = 'CRNRSTN_SOAP';

            break;
            case CRNRSTN_SOAP_SERVER:

                $tmp_str_out = 'CRNRSTN_SOAP_SERVER';

            break;
            case CRNRSTN_SOAP_CLIENT:

                $tmp_str_out = 'CRNRSTN_SOAP_CLIENTCRNRSTN_SOAP_CLIENT';

            break;
            case CRNRSTN_PROXY_KINGS_HIGHWAY:

                $tmp_str_out = 'CRNRSTN_PROXY_KINGS_HIGHWAY';

            break;
            case CRNRSTN_PROXY_EMAIL:

                $tmp_str_out = 'CRNRSTN_PROXY_EMAIL';

            break;
            case CRNRSTN_PROXY_ELECTRUM:

                $tmp_str_out = 'CRNRSTN_PROXY_ELECTRUM';

            break;
            case CRNRSTN_PROXY_AUTHENTICATE:

                $tmp_str_out = 'CRNRSTN_PROXY_AUTHENTICATE';

            break;
            case CRNRSTN_UI_RANDOM:

                $tmp_str_out = 'CRNRSTN_UI_RANDOM';

            break;
            case CRNRSTN_UI_PHPNIGHT:

                $tmp_str_out = 'CRNRSTN_UI_PHPNIGHT';

            break;
            case CRNRSTN_UI_DARKNIGHT:

                $tmp_str_out = 'CRNRSTN_UI_DARKNIGHT';

            break;
            case CRNRSTN_UI_PHP:

                $tmp_str_out = 'CRNRSTN_UI_PHP';

            break;
            case CRNRSTN_UI_GREYSKYS:

                $tmp_str_out = 'CRNRSTN_UI_GREYSKYS';

            break;
            case CRNRSTN_UI_HTML:

                $tmp_str_out = 'CRNRSTN_UI_HTML';

            break;
            case CRNRSTN_UI_DAYLIGHT:

                $tmp_str_out = 'CRNRSTN_UI_DAYLIGHT';

            break;
            case CRNRSTN_UI_FEATHER:

                $tmp_str_out = 'CRNRSTN_UI_FEATHER';

            break;
            case CRNRSTN_UI_GLASS_LIGHT_COPY:

                $tmp_str_out = 'CRNRSTN_UI_GLASS_LIGHT_COPY';

            break;
            case CRNRSTN_UI_GLASS_DARK_COPY:

                $tmp_str_out = 'CRNRSTN_UI_GLASS_DARK_COPY';

            break;
            case CRNRSTN_UI_TERMINAL:

                $tmp_str_out = 'CRNRSTN_UI_TERMINAL';

            break;
            case CRNRSTN_UI_DESKTOP:

                $tmp_str_out = 'CRNRSTN_UI_DESKTOP';

            break;
            case CRNRSTN_UI_TABLET:

                $tmp_str_out = 'CRNRSTN_UI_TABLET';

            break;
            case CRNRSTN_UI_MOBILE:

                $tmp_str_out = 'CRNRSTN_UI_MOBILE';

            break;
            case CRNRSTN_UI_SOAP_DATA_TUNNEL:

                $tmp_str_out = 'CRNRSTN_UI_SOAP_DATA_TUNNEL';

            break;
            case CRNRSTN_UI_IMG_SOAP_DATA_TUNNEL:

                $tmp_str_out = 'CRNRSTN_UI_IMG_SOAP_DATA_TUNNEL';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str_out = 'CRNRSTN_UI_IMG_BASE64';

            break;
            case CRNRSTN_UI_IMG_BASE64_PNG:

                $tmp_str_out = 'CRNRSTN_UI_IMG_BASE64_PNG';

            break;
            case CRNRSTN_UI_IMG_BASE64_JPEG_HTML_WRAPPED:

                $tmp_str_out = 'CRNRSTN_UI_IMG_BASE64_JPEG_HTML_WRAPPED';

            break;
            case CRNRSTN_UI_IMG_BASE64_JPEG:

                $tmp_str_out = 'CRNRSTN_UI_IMG_BASE64_JPEG';

            break;
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str_out = 'CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED';

            break;
            case CRNRSTN_UI_IMG_BASE64_PNG_HTML_WRAPPED:

                $tmp_str_out = 'CRNRSTN_UI_IMG_BASE64_PNG_HTML_WRAPPED';

            break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str_out = 'CRNRSTN_UI_IMG_JPEG';

            break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str_out = 'CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED';

            break;
            case CRNRSTN_UI_IMG_PNG:

                $tmp_str_out = 'CRNRSTN_UI_IMG_PNG';

            break;
            case CRNRSTN_UI_IMG_PNG_HTML_WRAPPED:

                $tmp_str_out = 'CRNRSTN_UI_IMG_PNG_HTML_WRAPPED';

            break;
            case CRNRSTN_UI_CSS_MAIN_DESKTOP:

                $tmp_str_out = 'CRNRSTN_UI_CSS_MAIN_DESKTOP';

            break;
            case CRNRSTN_UI_CSS_MAIN_TABLET:

                $tmp_str_out = 'CRNRSTN_UI_CSS_MAIN_TABLET';

            break;
            case CRNRSTN_UI_CSS_MAIN_MOBILE:

                $tmp_str_out = 'CRNRSTN_UI_CSS_MAIN_MOBILE';

            break;
            case CRNRSTN_UI_JS_MAIN_DESKTOP:

                $tmp_str_out = 'CRNRSTN_UI_JS_MAIN_DESKTOP';

            break;
            case CRNRSTN_UI_JS_MAIN_TABLET:

                $tmp_str_out = 'CRNRSTN_UI_JS_MAIN_TABLET';

            break;
            case CRNRSTN_UI_JS_MAIN_MOBILE:

                $tmp_str_out = 'CRNRSTN_UI_JS_MAIN_MOBILE';

            break;
            case CRNRSTN_UI_JS_JQUERY_1_11_1:

                $tmp_str_out = 'CRNRSTN_UI_JS_JQUERY_1_11_1';

            break;
            case CRNRSTN_UI_JS_JQUERY:

                $tmp_str_out = 'CRNRSTN_UI_JS_JQUERY';

            break;
            case CRNRSTN_UI_JS_JQUERY_UI:

                $tmp_str_out = 'CRNRSTN_UI_JS_JQUERY_UI';

            break;
            case CRNRSTN_UI_JS_JQUERY_MOBILE:

                $tmp_str_out = 'CRNRSTN_UI_JS_JQUERY_MOBILE';

            break;
            case CRNRSTN_UI_JS_LIGHTBOX_DOT_JS:

                $tmp_str_out = 'CRNRSTN_UI_JS_LIGHTBOX_DOT_JS';

            break;
            case CRNRSTN_UI_JS_LIGHTBOX_DOT_JS_PLUS_JQUERY:

                $tmp_str_out = 'CRNRSTN_UI_JS_LIGHTBOX_DOT_JS_PLUS_JQUERY';

            break;
            case CRNRSTN_UI_TAG_ANALYTICS:

                $tmp_str_out = 'CRNRSTN_UI_TAG_ANALYTICS';

            break;
            case CRNRSTN_UI_TAG_ENGAGEMENT:

                $tmp_str_out = 'CRNRSTN_UI_TAG_ENGAGEMENT';

            break;
            case CRNRSTN_UI_FORM_INTEGRATION_PACKET:

                $tmp_str_out = 'CRNRSTN_UI_FORM_INTEGRATION_PACKET';

            break;
            case CRNRSTN_UI_COOKIE_PREFERENCE:

                $tmp_str_out = 'CRNRSTN_UI_COOKIE_PREFERENCE';

            break;
            case CRNRSTN_UI_COOKIE_YESNO:

                $tmp_str_out = 'CRNRSTN_UI_COOKIE_YESNO';

            break;
            case CRNRSTN_UI_COOKIE_NOTICE:

                $tmp_str_out = 'CRNRSTN_UI_COOKIE_NOTICE';

            break;
            case CRNRSTN_UI_INTERACT:

                $tmp_str_out = 'CRNRSTN_UI_INTERACT';

            break;
            case CRNRSTN_ASSET_MODE_BASE64:

                $tmp_str_out = 'CRNRSTN_ASSET_MODE_BASE64';

            break;
            case CRNRSTN_ASSET_MODE_PNG:

                $tmp_str_out = 'CRNRSTN_ASSET_MODE_PNG';

            break;
            case CRNRSTN_ASSET_MODE_JPEG:

                $tmp_str_out = 'CRNRSTN_ASSET_MODE_JPEG';

            break;
            case CRNRSTN_LOG_EMAIL:

                $tmp_str_out = 'CRNRSTN_LOG_EMAIL';

            break;
            case CRNRSTN_LOG_EMAIL_PROXY:

                $tmp_str_out = 'CRNRSTN_LOG_EMAIL_PROXY';

            break;
            case CRNRSTN_LOG_FILE:

                $tmp_str_out = 'CRNRSTN_LOG_FILE';

            break;
            case CRNRSTN_LOG_FILE_PROXY:

                $tmp_str_out = 'CRNRSTN_LOG_FILE_PROXY';

            break;
            case CRNRSTN_LOG_FILE_FTP:

                $tmp_str_out = 'CRNRSTN_LOG_FILE_FTP';

            break;
            case CRNRSTN_LOG_SCREEN_TEXT:

                $tmp_str_out = 'CRNRSTN_LOG_SCREEN_TEXT';

            break;
            case CRNRSTN_LOG_SCREEN:

                $tmp_str_out = 'CRNRSTN_LOG_SCREEN';

            break;
            case CRNRSTN_LOG_SCREEN_HTML:

                $tmp_str_out = 'CRNRSTN_LOG_SCREEN_HTML';

            break;
            case CRNRSTN_LOG_SCREEN_HTML_HIDDEN:

                $tmp_str_out = 'CRNRSTN_LOG_SCREEN_HTML_HIDDEN';

            break;
            case CRNRSTN_LOG_DEFAULT:

                $tmp_str_out = 'CRNRSTN_LOG_DEFAULT';

            break;
            case CRNRSTN_LOG_DEFAULT_PROXY:

                $tmp_str_out = 'CRNRSTN_LOG_DEFAULT_PROXY';

            break;
            case CRNRSTN_LOG_ELECTRUM:

                $tmp_str_out = 'CRNRSTN_LOG_ELECTRUM';

            break;
            case CRNRSTN_AUTHORIZE_RUNTIME_ONLY:

                $tmp_str_out = 'CRNRSTN_AUTHORIZE_RUNTIME_ONLY';

            break;
            case CRNRSTN_AUTHORIZE_ALL:

                $tmp_str_out = 'CRNRSTN_AUTHORIZE_ALL';

            break;
            case CRNRSTN_AUTHORIZE_DATABASE:

                $tmp_str_out = 'CRNRSTN_AUTHORIZE_DATABASE';

            break;
            case CRNRSTN_AUTHORIZE_SSDTLA:

                $tmp_str_out = 'CRNRSTN_AUTHORIZE_SSDTLA';

            break;
            case CRNRSTN_AUTHORIZE_PSSDTLA:

                $tmp_str_out = 'CRNRSTN_AUTHORIZE_PSSDTLA';

            break;
            case CRNRSTN_AUTHORIZE_SESSION:

                $tmp_str_out = 'CRNRSTN_AUTHORIZE_SESSION';

            break;
            case CRNRSTN_AUTHORIZE_COOKIE:

                $tmp_str_out = 'CRNRSTN_AUTHORIZE_COOKIE';

            break;
            case CRNRSTN_AUTHORIZE_SOAP:

                $tmp_str_out = 'CRNRSTN_AUTHORIZE_SOAP';

            break;
            case CRNRSTN_AUTHORIZE_GET:

                $tmp_str_out = 'CRNRSTN_AUTHORIZE_GET';

            break;
            case CRNRSTN_AUTHORIZE_ISEMAIL:

                $tmp_str_out = 'CRNRSTN_AUTHORIZE_ISEMAIL';

            break;
            case CRNRSTN_AUTHORIZE_ISPASSWORD:

                $tmp_str_out = 'CRNRSTN_AUTHORIZE_ISPASSWORD';

            break;
            case CRNRSTN_ENCRYPT_TUNNEL:

                $tmp_str_out = 'CRNRSTN_ENCRYPT_TUNNEL';

            break;
            case CRNRSTN_ENCRYPT_DATABASE:

                $tmp_str_out = 'CRNRSTN_ENCRYPT_DATABASE';

            break;
            case CRNRSTN_ENCRYPT_SESSION:

                $tmp_str_out = 'CRNRSTN_ENCRYPT_SESSION';

            break;
            case CRNRSTN_ENCRYPT_COOKIE:

                $tmp_str_out = 'CRNRSTN_ENCRYPT_COOKIE';

            break;
            case CRNRSTN_ENCRYPT_SOAP:

                $tmp_str_out = 'CRNRSTN_ENCRYPT_SOAP';

            break;
            case CRNRSTN_ENCRYPT_OERSL:

                $tmp_str_out = 'CRNRSTN_ENCRYPT_OERSL';

            break;
            case CRNRSTN_RESOURCE_ALL:

                $tmp_str_out = 'CRNRSTN_RESOURCE_ALL';

            break;
            case CRNRSTN_RESOURCE_BASSDRIVE:

                $tmp_str_out = 'CRNRSTN_RESOURCE_BASSDRIVE';

            break;
            case CRNRSTN_RESOURCE_NATIONAL_WEATHER_SERVICE:

                $tmp_str_out = 'CRNRSTN_RESOURCE_NATIONAL_WEATHER_SERVICE';

            break;
            case CRNRSTN_RESOURCE_CSS_VALIDATOR:

                $tmp_str_out = 'CRNRSTN_RESOURCE_CSS_VALIDATOR';

            break;
            case CRNRSTN_RESOURCE_DOCUMENTATION:

                $tmp_str_out = 'CRNRSTN_RESOURCE_DOCUMENTATION';

            break;
            case CRNRSTN_RESOURCE_IMAGE:

                $tmp_str_out = 'CRNRSTN_RESOURCE_IMAGE';

            break;
            case CRNRSTN_RESOURCE_DOCUMENT:

                $tmp_str_out = 'CRNRSTN_RESOURCE_DOCUMENT';

            break;
            case CRNRSTN_RESOURCE_OPENSOURCE:

                $tmp_str_out = 'CRNRSTN_RESOURCE_OPENSOURCE';

            break;
            case CRNRSTN_RESOURCE_NEWS_SYNDICATION:

                $tmp_str_out = 'CRNRSTN_RESOURCE_NEWS_SYNDICATION';

            break;
            case CRNRSTN_RESOURCE_ELECTRUM:

                $tmp_str_out = 'CRNRSTN_RESOURCE_ELECTRUM';

            break;
            case CRNRSTN_BARNEY:

                $tmp_str_out = 'CRNRSTN_BARNEY';

            break;
            case CRNRSTN_BARNEY_DATABASE:

                $tmp_str_out = 'CRNRSTN_BARNEY_DATABASE';

            break;
            case CRNRSTN_BARNEY_FILE:

                $tmp_str_out = 'CRNRSTN_BARNEY_FILE';

            break;
            case CRNRSTN_BARNEY_FTP:

                $tmp_str_out = 'CRNRSTN_BARNEY_FTP';

            break;
            case CRNRSTN_BARNEY_ELECTRUM:

                $tmp_str_out = 'CRNRSTN_BARNEY_ELECTRUM';

            break;
            case CRNRSTN_BARNEY_GABRIEL:

                $tmp_str_out = 'CRNRSTN_BARNEY_GABRIEL';

            break;
            case CRNRSTN_BARNEY_DISK:

                $tmp_str_out = 'CRNRSTN_BARNEY_DISK';

            break;
            case CRNRSTN_PERFORMANCE_MONITOR:

                $tmp_str_out = 'CRNRSTN_PERFORMANCE_MONITOR';

            break;
            case CRNRSTN_WORDPRESS_DEBUG:

                $tmp_str_out = 'CRNRSTN_WORDPRESS_DEBUG';

            break;
            case CRNRSTN_IP_SECURITY:

                $tmp_str_out = 'CRNRSTN_IP_SECURITY';

            break;
            case CRNRSTN_CSS_EMAIL_CLIENT_VALIDATE:

                $tmp_str_out = 'CRNRSTN_CSS_EMAIL_CLIENT_VALIDATE';

            break;
            default:

                $this->oCRNRSTN->error_log('MISSING STRING DATA ERROR: The integer constant [] needs string representation in the system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

            break;

        }

        $this->system_integer_meta_lookup_ARRAY[] = $int_constant;
        $this->system_integer_meta_cache_ARRAY[$int_constant]['STRING'] = $tmp_str_out;
        $this->system_integer_meta_cache_ARRAY[$int_constant]['INTEGER'] = $int_constant;

        return $this->system_integer_meta_cache_ARRAY[$int_constant]['INTEGER'];

    }

    public function return_constants_string($int_constant){

        $tmp_str_out = '';

        if(in_array($int_constant, $this->system_integer_meta_lookup_ARRAY)){

            //error_log(__LINE__ .  '  performance $int_constant[' . $int_constant . '] from cache.');
            return $this->system_integer_meta_cache_ARRAY[$int_constant]['STRING'];

        }

        switch($int_constant){
            case CRNRSTN_DEBUG_OFF:

                $tmp_str_out = 'CRNRSTN_DEBUG_OFF';

            break;
            case CRNRSTN_DEBUG_NATIVE_ERR_LOG:

                $tmp_str_out = 'CRNRSTN_DEBUG_NATIVE_ERR_LOG';

            break;
            case CRNRSTN_DEBUG_AGGREGATION_ON:

                $tmp_str_out = 'CRNRSTN_DEBUG_AGGREGATION_ON';

            break;
            case CRNRSTN_LOG_NONE:

                $tmp_str_out = 'CRNRSTN_LOG_NONE';

            break;
            case CRNRSTN_LOG_ALL:

                $tmp_str_out = 'CRNRSTN_LOG_ALL';

            break;
            case CRNRSTN_AUTHORIZED_ACCOUNT:

                $tmp_str_out = 'CRNRSTN_AUTHORIZED_ACCOUNT';

            break;
            case CRNRSTN_INTEGER_LENGTH:

                $tmp_str_out = 'CRNRSTN_INTEGER_LENGTH';

            break;
            case CRNRSTN_SETTINGS_APACHE:

                $tmp_str_out = 'CRNRSTN_SETTINGS_APACHE';

            break;
            case CRNRSTN_SETTINGS_MYSQLI:

                $tmp_str_out = 'CRNRSTN_SETTINGS_MYSQLI';

            break;
            case CRNRSTN_SETTINGS_PHP:

                $tmp_str_out = 'CRNRSTN_SETTINGS_PHP';

            break;
            case CRNRSTN_SETTINGS_CRNRSTN:

                $tmp_str_out = 'CRNRSTN_SETTINGS_CRNRSTN';

            break;
            case CRNRSTN_SETTINGS_WORDPRESS:

                $tmp_str_out = 'CRNRSTN_SETTINGS_WORDPRESS';

            break;
            case CRNRSTN_SETTINGS_CLIENT:

                $tmp_str_out = 'CRNRSTN_SETTINGS_CLIENT';

            break;
            case CRNRSTN_INPUT_OPTIONAL:

                $tmp_str_out = 'CRNRSTN_INPUT_OPTIONAL';

            break;
            case CRNRSTN_INPUT_REQUIRED:

                $tmp_str_out = 'CRNRSTN_INPUT_REQUIRED';

            break;
            case CRNRSTN_INPUT_PASSWORD:

                $tmp_str_out = 'CRNRSTN_INPUT_PASSWORD';

            break;
            case CRNRSTN_INPUT_IS_EMAIL:

                $tmp_str_out = 'CRNRSTN_INPUT_IS_EMAIL';

            break;
            case CRNRSTN_INPUT_CHAR_RESTRICTIONS:

                $tmp_str_out = 'CRNRSTN_INPUT_CHAR_RESTRICTIONS';

            break;
            case CRNRSTN_INPUT_CHAR_LIMITS:

                $tmp_str_out = 'CRNRSTN_INPUT_CHAR_LIMITS';

            break;
            case CRNRSTN_INPUT_IS_FILE_IMAGE:

                $tmp_str_out = 'CRNRSTN_INPUT_IS_FILE_IMAGE';

            break;
            case CRNRSTN_INPUT_IS_FILE_IMAGE_PNG:

                $tmp_str_out = 'CRNRSTN_INPUT_IS_FILE_IMAGE_PNG';

            break;
            case CRNRSTN_INPUT_IS_FILE_IMAGE_JPEG:

                $tmp_str_out = 'CRNRSTN_INPUT_IS_FILE_IMAGE_JPEG';

            break;
            case CRNRSTN_INPUT_IS_FILE_IMAGE_GIF:

                $tmp_str_out = 'CRNRSTN_INPUT_IS_FILE_IMAGE_GIF';

            break;
            case CRNRSTN_INPUT_IS_FILE_DOCUMENT:

                $tmp_str_out = 'CRNRSTN_INPUT_IS_FILE_DOCUMENT';

            break;
            case CRNRSTN_INPUT_IS_FILE_ZIP:

                $tmp_str_out = 'CRNRSTN_INPUT_IS_FILE_ZIP';

            break;
            case CRNRSTN_DATABASE:

                $tmp_str_out = 'CRNRSTN_DATABASE';

            break;
            case CRNRSTN_DATABASE_CONNECTION:

                $tmp_str_out = 'CRNRSTN_DATABASE_CONNECTION';

            break;
            case CRNRSTN_DATABASE_QUERY:

                $tmp_str_out = 'CRNRSTN_DATABASE_QUERY';

            break;
            case CRNRSTN_DATABASE_QUERY_SILO:

                $tmp_str_out = 'CRNRSTN_DATABASE_QUERY_SILO';

            break;
            case CRNRSTN_DATABASE_QUERY_DYNAMIC:

                $tmp_str_out = 'CRNRSTN_DATABASE_QUERY_DYNAMIC';

            break;
            case CRNRSTN_DATABASE_RESULT:

                $tmp_str_out = 'CRNRSTN_DATABASE_RESULT';

            break;
            case CRNRSTN_GABRIEL:

                $tmp_str_out = 'CRNRSTN_GABRIEL';

            break;
            case CRNRSTN_SMTP_AUTHENTICATION:

                $tmp_str_out = 'CRNRSTN_SMTP_AUTHENTICATION';

            break;
            case CRNRSTN_EMAIL_CRNRSTN_SOURCE:

                $tmp_str_out = 'CRNRSTN_EMAIL_CRNRSTN_SOURCE';

            break;
            case CRNRSTN_EMAIL_USER_SOURCE:

                $tmp_str_out = 'CRNRSTN_EMAIL_USER_SOURCE';

            break;
            case CRNRSTN_ELECTRUM:

                $tmp_str_out = 'CRNRSTN_ELECTRUM';

            break;
            case CRNRSTN_ELECTRUM_THREAD:

                $tmp_str_out = 'CRNRSTN_ELECTRUM_THREAD';

            break;
            case CRNRSTN_ELECTRUM_COMM:

                $tmp_str_out = 'CRNRSTN_ELECTRUM_COMM';

            break;
            case CRNRSTN_ELECTRUM_FTP:

                $tmp_str_out = 'CRNRSTN_ELECTRUM_FTP';

            break;
            case CRNRSTN_ELECTRUM_LOCALDIR:

                $tmp_str_out = 'CRNRSTN_ELECTRUM_LOCALDIR';

            break;
            case CRNRSTN_FILE_MANAGEMENT:

                $tmp_str_out = 'CRNRSTN_FILE_MANAGEMENT';

            break;
            case CRNRSTN_SOAP:

                $tmp_str_out = 'CRNRSTN_SOAP';

            break;
            case CRNRSTN_SOAP_SERVER:

                $tmp_str_out = 'CRNRSTN_SOAP_SERVER';

            break;
            case CRNRSTN_SOAP_CLIENT:

                $tmp_str_out = 'CRNRSTN_SOAP_CLIENTCRNRSTN_SOAP_CLIENT';

            break;
            case CRNRSTN_PROXY_KINGS_HIGHWAY:

                $tmp_str_out = 'CRNRSTN_PROXY_KINGS_HIGHWAY';

            break;
            case CRNRSTN_PROXY_EMAIL:

                $tmp_str_out = 'CRNRSTN_PROXY_EMAIL';

            break;
            case CRNRSTN_PROXY_ELECTRUM:

                $tmp_str_out = 'CRNRSTN_PROXY_ELECTRUM';

            break;
            case CRNRSTN_PROXY_AUTHENTICATE:

                $tmp_str_out = 'CRNRSTN_PROXY_AUTHENTICATE';

            break;
            case CRNRSTN_UI_PHPNIGHT:

                $tmp_str_out = 'CRNRSTN_UI_PHPNIGHT';

            break;
            case CRNRSTN_UI_DARKNIGHT:

                $tmp_str_out = 'CRNRSTN_UI_DARKNIGHT';

            break;
            case CRNRSTN_UI_PHP:

                $tmp_str_out = 'CRNRSTN_UI_PHP';

            break;
            case CRNRSTN_UI_GREYSKYS:

                $tmp_str_out = 'CRNRSTN_UI_GREYSKYS';

            break;
            case CRNRSTN_UI_HTML:

                $tmp_str_out = 'CRNRSTN_UI_HTML';

            break;
            case CRNRSTN_UI_DAYLIGHT:

                $tmp_str_out = 'CRNRSTN_UI_DAYLIGHT';

            break;
            case CRNRSTN_UI_FEATHER:

                $tmp_str_out = 'CRNRSTN_UI_FEATHER';

            break;
            case CRNRSTN_UI_GLASS_LIGHT_COPY:

                $tmp_str_out = 'CRNRSTN_UI_GLASS_LIGHT_COPY';

            break;
            case CRNRSTN_UI_GLASS_DARK_COPY:

                $tmp_str_out = 'CRNRSTN_UI_GLASS_DARK_COPY';

            break;
            case CRNRSTN_UI_TERMINAL:

                $tmp_str_out = 'CRNRSTN_UI_TERMINAL';

            break;
            case CRNRSTN_UI_DESKTOP:

                $tmp_str_out = 'CRNRSTN_UI_DESKTOP';

            break;
            case CRNRSTN_UI_TABLET:

                $tmp_str_out = 'CRNRSTN_UI_TABLET';

            break;
            case CRNRSTN_UI_MOBILE:

                $tmp_str_out = 'CRNRSTN_UI_MOBILE';

            break;
            case CRNRSTN_UI_SOAP_DATA_TUNNEL:

                $tmp_str_out = 'CRNRSTN_UI_SOAP_DATA_TUNNEL';

            break;
            case CRNRSTN_UI_IMG_SOAP_DATA_TUNNEL:

                $tmp_str_out = 'CRNRSTN_UI_IMG_SOAP_DATA_TUNNEL';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str_out = 'CRNRSTN_UI_IMG_BASE64';

            break;
            case CRNRSTN_UI_IMG_BASE64_PNG:

                $tmp_str_out = 'CRNRSTN_UI_IMG_BASE64_PNG';

            break;
            case CRNRSTN_UI_IMG_BASE64_JPEG_HTML_WRAPPED:

                $tmp_str_out = 'CRNRSTN_UI_IMG_BASE64_JPEG_HTML_WRAPPED';

            break;
            case CRNRSTN_UI_IMG_BASE64_JPEG:

                $tmp_str_out = 'CRNRSTN_UI_IMG_BASE64_JPEG';

            break;
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str_out = 'CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED';

            break;
            case CRNRSTN_UI_IMG_BASE64_PNG_HTML_WRAPPED:

                $tmp_str_out = 'CRNRSTN_UI_IMG_BASE64_PNG_HTML_WRAPPED';

            break;
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_str_out = 'CRNRSTN_UI_IMG_JPEG';

            break;
            case CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED:

                $tmp_str_out = 'CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED';

            break;
            case CRNRSTN_UI_IMG_PNG:

                $tmp_str_out = 'CRNRSTN_UI_IMG_PNG';

            break;
            case CRNRSTN_UI_IMG_PNG_HTML_WRAPPED:

                $tmp_str_out = 'CRNRSTN_UI_IMG_PNG_HTML_WRAPPED';

            break;
            case CRNRSTN_UI_CSS_MAIN_DESKTOP:

                $tmp_str_out = 'CRNRSTN_UI_CSS_MAIN_DESKTOP';

            break;
            case CRNRSTN_UI_CSS_MAIN_TABLET:

                $tmp_str_out = 'CRNRSTN_UI_CSS_MAIN_TABLET';

            break;
            case CRNRSTN_UI_CSS_MAIN_MOBILE:

                $tmp_str_out = 'CRNRSTN_UI_CSS_MAIN_MOBILE';

            break;
            case CRNRSTN_UI_JS_MAIN_DESKTOP:

                $tmp_str_out = 'CRNRSTN_UI_JS_MAIN_DESKTOP';

            break;
            case CRNRSTN_UI_JS_MAIN_TABLET:

                $tmp_str_out = 'CRNRSTN_UI_JS_MAIN_TABLET';

            break;
            case CRNRSTN_UI_JS_MAIN_MOBILE:

                $tmp_str_out = 'CRNRSTN_UI_JS_MAIN_MOBILE';

            break;
            case CRNRSTN_UI_JS_JQUERY_1_11_1:

                $tmp_str_out = 'CRNRSTN_UI_JS_JQUERY_1_11_1';

            break;
            case CRNRSTN_UI_JS_JQUERY:

                $tmp_str_out = 'CRNRSTN_UI_JS_JQUERY';

            break;
            case CRNRSTN_UI_JS_JQUERY_UI:

                $tmp_str_out = 'CRNRSTN_UI_JS_JQUERY_UI';

            break;
            case CRNRSTN_UI_JS_JQUERY_MOBILE:

                $tmp_str_out = 'CRNRSTN_UI_JS_JQUERY_MOBILE';

            break;
            case CRNRSTN_UI_JS_LIGHTBOX_DOT_JS:

                $tmp_str_out = 'CRNRSTN_UI_JS_LIGHTBOX_DOT_JS';

            break;
            case CRNRSTN_UI_JS_LIGHTBOX_DOT_JS_PLUS_JQUERY:

                $tmp_str_out = 'CRNRSTN_UI_JS_LIGHTBOX_DOT_JS_PLUS_JQUERY';

            break;
            case CRNRSTN_UI_TAG_ANALYTICS:

                $tmp_str_out = 'CRNRSTN_UI_TAG_ANALYTICS';

            break;
            case CRNRSTN_UI_TAG_ENGAGEMENT:

                $tmp_str_out = 'CRNRSTN_UI_TAG_ENGAGEMENT';

            break;
            case CRNRSTN_UI_FORM_INTEGRATION_PACKET:

                $tmp_str_out = 'CRNRSTN_UI_FORM_INTEGRATION_PACKET';

            break;
            case CRNRSTN_UI_COOKIE_PREFERENCE:

                $tmp_str_out = 'CRNRSTN_UI_COOKIE_PREFERENCE';

            break;
            case CRNRSTN_UI_COOKIE_YESNO:

                $tmp_str_out = 'CRNRSTN_UI_COOKIE_YESNO';

            break;
            case CRNRSTN_UI_COOKIE_NOTICE:

                $tmp_str_out = 'CRNRSTN_UI_COOKIE_NOTICE';

            break;
            case CRNRSTN_UI_INTERACT:

                $tmp_str_out = 'CRNRSTN_UI_INTERACT';

            break;
            case CRNRSTN_ASSET_MODE_BASE64:

                $tmp_str_out = 'CRNRSTN_ASSET_MODE_BASE64';

            break;
            case CRNRSTN_ASSET_MODE_PNG:

                $tmp_str_out = 'CRNRSTN_ASSET_MODE_PNG';

            break;
            case CRNRSTN_ASSET_MODE_JPEG:

                $tmp_str_out = 'CRNRSTN_ASSET_MODE_JPEG';

            break;
            case CRNRSTN_LOG_EMAIL:

                $tmp_str_out = 'CRNRSTN_LOG_EMAIL';

            break;
            case CRNRSTN_LOG_EMAIL_PROXY:

                $tmp_str_out = 'CRNRSTN_LOG_EMAIL_PROXY';

            break;
            case CRNRSTN_LOG_FILE:

                $tmp_str_out = 'CRNRSTN_LOG_FILE';

            break;
            case CRNRSTN_LOG_FILE_PROXY:

                $tmp_str_out = 'CRNRSTN_LOG_FILE_PROXY';

            break;
            case CRNRSTN_LOG_FILE_FTP:

                $tmp_str_out = 'CRNRSTN_LOG_FILE_FTP';

            break;
            case CRNRSTN_LOG_SCREEN_TEXT:

                $tmp_str_out = 'CRNRSTN_LOG_SCREEN_TEXT';

            break;
            case CRNRSTN_LOG_SCREEN:

                $tmp_str_out = 'CRNRSTN_LOG_SCREEN';

            break;
            case CRNRSTN_LOG_SCREEN_HTML:

                $tmp_str_out = 'CRNRSTN_LOG_SCREEN_HTML';

            break;
            case CRNRSTN_LOG_SCREEN_HTML_HIDDEN:

                $tmp_str_out = 'CRNRSTN_LOG_SCREEN_HTML_HIDDEN';

            break;
            case CRNRSTN_LOG_DEFAULT:

                $tmp_str_out = 'CRNRSTN_LOG_DEFAULT';

            break;
            case CRNRSTN_LOG_DEFAULT_PROXY:

                $tmp_str_out = 'CRNRSTN_LOG_DEFAULT_PROXY';

            break;
            case CRNRSTN_LOG_ELECTRUM:

                $tmp_str_out = 'CRNRSTN_LOG_ELECTRUM';

            break;
            case CRNRSTN_AUTHORIZE_RUNTIME_ONLY:

                $tmp_str_out = 'CRNRSTN_AUTHORIZE_RUNTIME_ONLY';

            break;
            case CRNRSTN_AUTHORIZE_ALL:

                $tmp_str_out = 'CRNRSTN_AUTHORIZE_ALL';

            break;
            case CRNRSTN_AUTHORIZE_DATABASE:

                $tmp_str_out = 'CRNRSTN_AUTHORIZE_DATABASE';

            break;
            case CRNRSTN_AUTHORIZE_SSDTLA:

                $tmp_str_out = 'CRNRSTN_AUTHORIZE_SSDTLA';

            break;
            case CRNRSTN_AUTHORIZE_PSSDTLA:

                $tmp_str_out = 'CRNRSTN_AUTHORIZE_PSSDTLA';

            break;
            case CRNRSTN_AUTHORIZE_SESSION:

                $tmp_str_out = 'CRNRSTN_AUTHORIZE_SESSION';

            break;
            case CRNRSTN_AUTHORIZE_COOKIE:

                $tmp_str_out = 'CRNRSTN_AUTHORIZE_COOKIE';

            break;
            case CRNRSTN_AUTHORIZE_SOAP:

                $tmp_str_out = 'CRNRSTN_AUTHORIZE_SOAP';

            break;
            case CRNRSTN_AUTHORIZE_GET:

                $tmp_str_out = 'CRNRSTN_AUTHORIZE_GET';

            break;
            case CRNRSTN_AUTHORIZE_ISEMAIL:

                $tmp_str_out = 'CRNRSTN_AUTHORIZE_ISEMAIL';

            break;
            case CRNRSTN_AUTHORIZE_ISPASSWORD:

                $tmp_str_out = 'CRNRSTN_AUTHORIZE_ISPASSWORD';

            break;
            case CRNRSTN_ENCRYPT_TUNNEL:

                $tmp_str_out = 'CRNRSTN_ENCRYPT_TUNNEL';

            break;
            case CRNRSTN_ENCRYPT_DATABASE:

                $tmp_str_out = 'CRNRSTN_ENCRYPT_DATABASE';

            break;
            case CRNRSTN_ENCRYPT_SESSION:

                $tmp_str_out = 'CRNRSTN_ENCRYPT_SESSION';

            break;
            case CRNRSTN_ENCRYPT_COOKIE:

                $tmp_str_out = 'CRNRSTN_ENCRYPT_COOKIE';

            break;
            case CRNRSTN_ENCRYPT_SOAP:

                $tmp_str_out = 'CRNRSTN_ENCRYPT_SOAP';

            break;
            case CRNRSTN_ENCRYPT_OERSL:

                $tmp_str_out = 'CRNRSTN_ENCRYPT_OERSL';

            break;
            case CRNRSTN_RESOURCE_ALL:

                $tmp_str_out = 'CRNRSTN_RESOURCE_ALL';

            break;
            case CRNRSTN_RESOURCE_BASSDRIVE:

                $tmp_str_out = 'CRNRSTN_RESOURCE_BASSDRIVE';

            break;
            case CRNRSTN_RESOURCE_NATIONAL_WEATHER_SERVICE:

                $tmp_str_out = 'CRNRSTN_RESOURCE_NATIONAL_WEATHER_SERVICE';

            break;
            case CRNRSTN_RESOURCE_CSS_VALIDATOR:

                $tmp_str_out = 'CRNRSTN_RESOURCE_CSS_VALIDATOR';

            break;
            case CRNRSTN_RESOURCE_DOCUMENTATION:

                $tmp_str_out = 'CRNRSTN_RESOURCE_DOCUMENTATION';

            break;
            case CRNRSTN_RESOURCE_IMAGE:

                $tmp_str_out = 'CRNRSTN_RESOURCE_IMAGE';

            break;
            case CRNRSTN_RESOURCE_DOCUMENT:

                $tmp_str_out = 'CRNRSTN_RESOURCE_DOCUMENT';

            break;
            case CRNRSTN_RESOURCE_OPENSOURCE:

                $tmp_str_out = 'CRNRSTN_RESOURCE_OPENSOURCE';

            break;
            case CRNRSTN_RESOURCE_NEWS_SYNDICATION:

                $tmp_str_out = 'CRNRSTN_RESOURCE_NEWS_SYNDICATION';

            break;
            case CRNRSTN_RESOURCE_ELECTRUM:

                $tmp_str_out = 'CRNRSTN_RESOURCE_ELECTRUM';

            break;
            case CRNRSTN_BARNEY:

                $tmp_str_out = 'CRNRSTN_BARNEY';

            break;
            case CRNRSTN_BARNEY_DATABASE:

                $tmp_str_out = 'CRNRSTN_BARNEY_DATABASE';

            break;
            case CRNRSTN_BARNEY_FILE:

                $tmp_str_out = 'CRNRSTN_BARNEY_FILE';

            break;
            case CRNRSTN_BARNEY_FTP:

                $tmp_str_out = 'CRNRSTN_BARNEY_FTP';

            break;
            case CRNRSTN_BARNEY_ELECTRUM:

                $tmp_str_out = 'CRNRSTN_BARNEY_ELECTRUM';

            break;
            case CRNRSTN_BARNEY_GABRIEL:

                $tmp_str_out = 'CRNRSTN_BARNEY_GABRIEL';

            break;
            case CRNRSTN_BARNEY_DISK:

                $tmp_str_out = 'CRNRSTN_BARNEY_DISK';

            break;
            case CRNRSTN_PERFORMANCE_MONITOR:

                $tmp_str_out = 'CRNRSTN_PERFORMANCE_MONITOR';

            break;
            case CRNRSTN_WORDPRESS_DEBUG:

                $tmp_str_out = 'CRNRSTN_WORDPRESS_DEBUG';

            break;
            case CRNRSTN_IP_SECURITY:

                $tmp_str_out = 'CRNRSTN_IP_SECURITY';

            break;
            case CRNRSTN_CSS_EMAIL_CLIENT_VALIDATE:

                $tmp_str_out = 'CRNRSTN_CSS_EMAIL_CLIENT_VALIDATE';

            break;
            default:

                $this->oCRNRSTN->error_log('MISSING STRING DATA ERROR: The integer constant [] needs string representation in the system.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

            break;

        }

        $this->system_integer_meta_lookup_ARRAY[] = $int_constant;
        $this->system_integer_meta_cache_ARRAY[$int_constant]['STRING'] = $tmp_str_out;
        $this->system_integer_meta_cache_ARRAY[$int_constant]['INTEGER'] = $int_constant;

        return $tmp_str_out;

    }

    public function __destruct() {


    }

}