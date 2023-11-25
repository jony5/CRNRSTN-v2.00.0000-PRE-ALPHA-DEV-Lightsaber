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
# # C # R # N # R # S # T # N # : : # # # #
#
#  CLASS :: crnrstn_unit_test_manager
#  VERSION :: 1.00.0000
#  DATE :: May 19, 2022 @ 1350hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: Unit tests execution and support.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_unit_test_manager {

    protected $oLogger;
    public $oCRNRSTN_USR;

    public $unit_test_profile_ARRAY = array();
    public $unit_test_serialization_ARRAY = array();
    public $runtime_ARRAY = array();
    public $result_ARRAY = array();

    private static $curl_raw_data_ARRAY = array();
    private static $openssl_raw_data_ARRAY = array();
    private static $openssl_cipher;
    private static $openssl_algorithm;
    private static $openssl_secret_key;
    private static $openssl_options;

    public function __construct($oCRNRSTN_USR) {

        $this->oCRNRSTN_USR = $oCRNRSTN_USR;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN_USR);

    }

    private function generate_test_string_dataset($data_size, $force_overwrite){

        $tmp_dataset_filepath = $this->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT') . $this->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR');

    }

    private function return_prepared_test_data($data_type, $data_size, $force_overwrite = true){

        $data_out = '';

        try{

            switch($data_type){
                case 'string':

                    $this->generate_test_string_dataset($data_size, $force_overwrite);

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('CRNRSTN :: Unknown unit test data type requested: ' . $data_type . ' [size=' . $data_size . '] on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ').');

                break;

            }

        }catch(Exception $e){

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return $data_out;

    }

    private function init_unit_test_data_set($unit_test_profile, $iterator = 0){

        try{

            switch ($unit_test_profile) {
                case 'openssl_mysql_storage_performance':

                    //
                    // EMPTY STRING
                    self::$openssl_raw_data_ARRAY[$unit_test_profile][$this->unit_test_serialization_ARRAY[$unit_test_profile][$iterator]][] = '';

                    //
                    // STRING (10)
                    self::$openssl_raw_data_ARRAY[$unit_test_profile][$this->unit_test_serialization_ARRAY[$unit_test_profile][$iterator]][] = $this->return_prepared_test_data('string', 10);

                    //
                    // STRING (100)
                    self::$openssl_raw_data_ARRAY[$unit_test_profile][$this->unit_test_serialization_ARRAY[$unit_test_profile][$iterator]][] = $this->return_prepared_test_data('string', 100);

                    //
                    // STRING (255)
                    self::$openssl_raw_data_ARRAY[$unit_test_profile][$this->unit_test_serialization_ARRAY[$unit_test_profile][$iterator]][] = $this->return_prepared_test_data('string', 255);

                    //
                    // STRING (1,000)
                    self::$openssl_raw_data_ARRAY[$unit_test_profile][$this->unit_test_serialization_ARRAY[$unit_test_profile][$iterator]][] = $this->return_prepared_test_data('string', 1000);

                    //
                    // STRING (2,000)
                    self::$openssl_raw_data_ARRAY[$unit_test_profile][$this->unit_test_serialization_ARRAY[$unit_test_profile][$iterator]][] = $this->return_prepared_test_data('string', 2000);

                    //
                    // STRING (15,000)
                    self::$openssl_raw_data_ARRAY[$unit_test_profile][$this->unit_test_serialization_ARRAY[$unit_test_profile][$iterator]][] = $this->return_prepared_test_data('string', 15000);

                    //
                    // STRING (100,000)
                    self::$openssl_raw_data_ARRAY[$unit_test_profile][$this->unit_test_serialization_ARRAY[$unit_test_profile][$iterator]][] = $this->return_prepared_test_data('string', 100000);

                    //
                    // STRING (1,000,000)
                    self::$openssl_raw_data_ARRAY[$unit_test_profile][$this->unit_test_serialization_ARRAY[$unit_test_profile][$iterator]][] = $this->return_prepared_test_data('string', 1000000);

                    //
                    // STRING (3,000,000)
                    self::$openssl_raw_data_ARRAY[$unit_test_profile][$this->unit_test_serialization_ARRAY[$unit_test_profile][$iterator]][] = $this->return_prepared_test_data('string', 3000000);

                    //
                    // STRING (5,000,000)
                    self::$openssl_raw_data_ARRAY[$unit_test_profile][$this->unit_test_serialization_ARRAY[$unit_test_profile][$iterator]][] = $this->return_prepared_test_data('string', 5000000);

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('CRNRSTN :: Unknown unit test profile provided: ' . $unit_test_profile . ' on server ' . $_SERVER['SERVER_NAME'].' (' . $_SERVER['SERVER_ADDR'].').');

                break;
            }



        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE.
            return false;

        }

    }

    private function execute_unit_test_curl(){

        foreach(self::$curl_raw_data_ARRAY as $unit_test_profile => $serialARRAY0){

            foreach($serialARRAY0 as $serial => $uri){

                //
                // GET START TIME
                $this->runtime_ARRAY[$unit_test_profile][$this->oCRNRSTN_USR->hash($uri, 'md5')] = $this->oCRNRSTN_USR->monitoring_delta_time_for($serial);

                //
                // EXECUTE TEST AND STORE RESULT
                $this->result_ARRAY[$unit_test_profile][$this->oCRNRSTN_USR->hash($uri, 'md5')] = $this->oCRNRSTN_USR->get_url_content($uri);

                //
                // GET END TIME
                $this->runtime_ARRAY[$unit_test_profile][$this->oCRNRSTN_USR->hash($uri, 'md5')] = $this->oCRNRSTN_USR->monitoring_delta_time_for($serial);

            }

        }

    }

    public function execute_unit_test(){

        try{

            //
            // FOR EACH UNIT TEST PROFILE
            foreach($this->unit_test_serialization_ARRAY as $test_profile => $array0){

                switch ($test_profile){
                    case 'curl':

                        //$this->unit_test_serialization_ARRAY[$unit_test_profile][] = $tmp_serial;
                        //$this->unit_test_profile_ARRAY[$tmp_serial] = $unit_test_profile;

                        //self::$curl_raw_data_ARRAY[$unit_test_profile][$tmp_serial];

                        $this->execute_unit_test_curl();

                    break;
                    default:

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('CRNRSTN :: Unknown unit test execution profile type: ' . $test_profile . ' on server ' . $_SERVER['SERVER_NAME'].' (' . $_SERVER['SERVER_ADDR'].').');

                    break;

                }

            }

        }catch(Exception $e){

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function byte_processing(){

        $tmp_test_byte_processing_ARRAY = array(
            '5 YiB',
            "42 MiB",
            '256 TiB',
            '256 KiB',
            '256 BYTES',
            '256 GiB',
            "43MB",
            '256TiB',
            "42.4442 KB",
            "42.4442 GB",
            '255.878 EB',
            "42.8790YB",
            '255.8782TiB',
            17592199997952,
            17592199,
            '17592199997952',
            '17592199',
            "312839038 Yottabyte",
            "312839038 YB",
            "312839038 Exabyte",
            "312839038 EB",
            "312839038 Terabyte",
            "312839038 TB",
            "312839038 Yotta byte",
            "312839038 Yotta bytes",
            "312839038YB",
            "312839038 Exa byte",
            "312839038 Yottabytes",
            "312839038 Exabytes",
            "312839038 Terabytes",
            "312839038byte",
            "312839038bytes",
            "312839038 byte",
            "312839038 bytes",
            "312839038 KB",
            "4324324234B",
            "4324324234 B",
            "not numeric",
            array(),
            43249.431,
            null,
            "312839038 Gibibyte",
            "312839038 Tebibyte",
            "312839038 Pebibyte",
            "312839038 Exbibyte",
            "312839038 Zebibyte",
            "312839038 Gibibytes",
            "312839038 Tebibytes",
            "312839038 Pebibytes",
            "312839038 Exbibytes",
            "312839038 Zebibytes",
            "312839038 Gibi byte",
            "312839038 Tebi b yte",
            "312839038 P ebi byte",
            "312839038 Exbi byte",
            "312839038 Zebi byte",
            "312839038 Gibi by tes",
            "312839038 T ebi byte s",
            "312839038 Pe bi b ytes",
            "312839038 Exbi by tes",
            "312839038 Zeb i b ytes",
            '255.8782T iB',
            '255.8782GiB',
            '255.8782 Ki B',
            '255.8782MiB',
            '255.8782 MiB',
            ''
        );

        $tmp_str_html_out = '';

        foreach($tmp_test_byte_processing_ARRAY as $byte_input){

            if(is_numeric($byte_input)){

                //echo var_export($byte_input, true) . " is numeric.", PHP_EOL;
                $tmp_bytes_int_converted = $this->oCRNRSTN->format_bytes($byte_input);
                $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr ' . print_r(var_export($byte_input, true), true) . ' is numeric. ' . print_r($tmp_bytes_int_converted, true));

            }else{

                //echo var_export($byte_input, true) . " is NOT numeric.", PHP_EOL;
                $tmp_bytes_int_converted = $this->oCRNRSTN->format_bytes($byte_input);
                $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr ' . print_r(var_export($byte_input, true), true) . ' is NOT numeric. ' . print_r($tmp_bytes_int_converted, true));

            }

            if(is_int($byte_input)){

                //echo var_export($byte_input, true) . " is integer.", PHP_EOL;
                $tmp_bytes_int_converted = $this->oCRNRSTN->format_bytes($byte_input);
                $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr ' . print_r(var_export($byte_input, true), true) . ' is integer. ' . print_r($tmp_bytes_int_converted, true));

            }else{

                //echo var_export($byte_input, true) . " is NOT integer.", PHP_EOL;
                $tmp_bytes_int_converted = $this->oCRNRSTN->format_bytes($byte_input);
                $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr ' . print_r(var_export($byte_input, true), true) . ' is NOT integer. ' . print_r($tmp_bytes_int_converted, true));

            }

            if(is_double($byte_input)){

                //echo var_export($byte_input, true) . " is integer.", PHP_EOL;
                $tmp_bytes_int_converted = $this->oCRNRSTN->format_bytes($byte_input);
                $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr ' . print_r(var_export($byte_input, true), true) . ' is double. ' . print_r($tmp_bytes_int_converted, true));

            }else{

                //echo var_export($byte_input, true) . " is NOT integer.", PHP_EOL;
                $tmp_bytes_int_converted = $this->oCRNRSTN->format_bytes($byte_input);
                $this->oCRNRSTN->concat_log_string($tmp_str_html_out, __LINE__ . ' ui html mgr ' . print_r(var_export($byte_input, true), true) . ' is NOT double. ' . print_r($tmp_bytes_int_converted, true));

            }

        }

        return $tmp_str_html_out;

    }

    public function isset_report($unit_test_profile){

        if(isset($this->runtime_ARRAY[$unit_test_profile])){

            return true;

        }else{

            return false;

        }

    }

    public function return_report($unit_test_profile, $output_mode = 'HTML_INJECTION'){

        switch($unit_test_profile){
            case 'curl':

                $tmp_output = '';

                //error_log(print_r('unit test 284 return_report() raw data array = ' . self::$curl_raw_data_ARRAY, true));

                foreach($this->result_ARRAY[$unit_test_profile] as $serial => $raw_output){

                    switch($output_mode){
                        case 'HTML_INJECTION':

                            //$raw_output = html_entity_decode($raw_output);
                            //$raw_output = htmlspecialchars_decode($raw_output);
                            //$raw_output = htmlentities($raw_output);
                            //$raw_output = htmlspecialchars($raw_output);
                            //$raw_output = html

                        break;

                    }

                    $tmp_output .= '<div style="width:100%; height:10px; background-color:#B1B1B1;"></div>';
                    $tmp_output .= '<div style="font-weight: bold; font-size: 16px; padding: 10px 0 10px 0;">' . self::$curl_raw_data_ARRAY[$unit_test_profile][$serial] . '</div>';
                    $tmp_output .= '<div style="width:100%; height:2px; background-color:#CD1010;"></div>';
                    $tmp_output .= '<div class="crnrstn_cb_20"></div>';
                    $tmp_output .= '<div style="width:100%; height:10px; background-color:#B1B1B1;"></div>';

                    $tmp_output .= $raw_output;
                    $tmp_output .= '<div class="crnrstn_cb_10"></div>';

                }

                return $tmp_output;

            break;
            default:

                return '<h1 style="padding:20px 0 20px 0; font-style: italic;">hello report[' . $unit_test_profile . ']</h1>';

            break;

        }

    }

    public function return_automation_initialization($unit_test_profile, $output_mode = 'HTML_INJECTION'){

        try{

            switch($unit_test_profile){
                case 'curl':
                    return '<!-- CRNRSTN :: v' . $this->oCRNRSTN_USR->version_crnrstn() . ' :: UNIT TEST JS :: ' . $this->oCRNRSTN_USR->return_micro_time() . ' --><script> //<!--

// -->
</script>';
                break;
                case 'openssl_mysql_storage_performance':

                    return '<!-- CRNRSTN :: v' . $this->oCRNRSTN_USR->version_crnrstn() . ' :: UNIT TEST JS :: ' . $this->oCRNRSTN_USR->return_micro_time() . ' --><script> //<!--

        function crnrstn_add_unittest_openssl_dataset_input(){

            //
            // APPEND NEW INPUT TO FORM
            $(\'<input type="text" name="crnrstn_add_unittest_openssl_dataset_input" style="width:150px;" value="" placeholder="' . $this->oCRNRSTN->multi_lang_content_return('TEXT_PLACEHOLDER_CHAR_COUNT'). '">\').appendTo($(\'#crnrstn_unittest_openssl_dataset_input_wrapper\'));

        }

// -->
</script>';

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('CRNRSTN :: Unknown unit test profile provided: ' . $unit_test_profile . ' on server ' . $_SERVER['SERVER_NAME'].' (' . $_SERVER['SERVER_ADDR'].').');

                break;

            }

        }catch(Exception $e){

            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function rtime($unit_test_profile, $uri_hash_serial){

        switch($unit_test_profile){
            case 'curl':

                $tmp_rtime = $this->runtime_ARRAY[$unit_test_profile][$uri_hash_serial];

                return $tmp_rtime . ' secs';

            break;
            default:

                return 'unknown profile';

            break;

        }

    }

    //
    // CONFIGURE UNIT TEST PROFILE INPUT PARAMETER PROFILES ::
    public function configure_unit_test($unit_test_profile, $param_1 = NULL, $param_2 = NULL, $param_3 = NULL, $param_4 = NULL, $param_5 = NULL){

        try{

            switch($unit_test_profile){
                case 'curl':
                    // where,
                    // $param_1 = $crnrstn_curl_uri_endpoint (optional)
                    // $param_2 = $tmp_crnrstn_curl_batch_count

                    //$tmp_serial = $this->oCRNRSTN_USR->generate_new_key(64, -2);
                    $tmp_serial = $this->oCRNRSTN_USR->hash($param_1, 'md5');
                    $this->unit_test_serialization_ARRAY[$unit_test_profile][] = $tmp_serial;

                    $this->unit_test_profile_ARRAY[$tmp_serial] = $unit_test_profile;

                    if(isset($param_1)){

                        self::$curl_raw_data_ARRAY[$unit_test_profile][$tmp_serial] = $param_1;

                    }

                    if(isset($param_2)){

                        if($param_2 > 0){

                            for($i = 0; $i < $param_2; $i++){

                                $tmp_serial = $this->oCRNRSTN_USR->generate_new_key(64, -2);
                                $this->unit_test_serialization_ARRAY[$unit_test_profile][] = $tmp_serial;

                                $this->unit_test_profile_ARRAY[$tmp_serial] = $unit_test_profile;

                                self::$curl_raw_data_ARRAY[$unit_test_profile][$tmp_serial] = $this->oCRNRSTN_USR->return_form_submitted_value('crnrstn_curl_batch_uri_' . $i);

                            }

                        }

                    }

                break;
                case 'openssl_storage_performance':
                    // where,
                    // $param_1 = $openssl_raw_data  (optional)
                    // $param_2 = $openssl_cipher
                    // $param_3 = $openssl_algorithm
                    // $param_4 = $openssl_secret_key
                    // $param_5 = $openssl_options

                    $tmp_serial = $this->oCRNRSTN_USR->generate_new_key(64, -2);
                    $this->unit_test_serialization_ARRAY[$unit_test_profile][] = $tmp_serial;

                    $this->unit_test_profile_ARRAY[$tmp_serial] = $unit_test_profile;

                    if(isset($param_1)){

                        self::$openssl_raw_data_ARRAY[$unit_test_profile][$tmp_serial] = $param_1;

                    }else{

                        $this->init_unit_test_data_set($unit_test_profile);

                    }

                    self::$openssl_cipher = $param_2;
                    self::$openssl_algorithm = $param_3;
                    self::$openssl_secret_key = $param_4;
                    self::$openssl_options = $param_5;

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('CRNRSTN :: Unknown unit test profile provided: ' . $unit_test_profile . ' on server ' . $_SERVER['SERVER_NAME'].' (' . $_SERVER['SERVER_ADDR'].').');

                break;
            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER.
            $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE.
            return false;

        }

    }

    public function __destruct(){

    }

}